<?php
namespace App\Campaign\Controllers;

/**
 * 例子
 *
 * 授权地址
 * http://yoox.rice5.com.cn/campaign/aprilcarnival/weixinauthorizebefore?callbackUrl=http%3A%2F%2Fwww.baidu.com%2F
 *
 * http://yoox.rice5.com.cn/campaign/aprilcarnival/weixinauthorizebefore?operation4cookie=clear
 *
 * http://yoox.rice5.com.cn/campaign/aprilcarnival/weixinauthorizebefore?operation4cookie=get
 *
 * http://yoox.rice5.com.cn/campaign/aprilcarnival/weixinauthorizebefore?operation4cookie=store&FromUserName=xxxx&nickname=xx&headimgurl=xx
 *
 * http://yoox.rice5.com.cn/aprilcarnival/index.html
 *
 * http://yoox.rice5.com.cn/campaign/aprilcarnival/weixinauthorizebefore?operation4cookie=store&FromUserName=ok0K2vystcQkKolNr3anJd-soVuI&nickname=郭永荣&headimgurl=xx
 *
 * @author 郭永荣
 *        
 */
class AprilcarnivalController extends ControllerBase
{
    // 错误日志
    protected $modelErrorLog = null;
    // 活动相关
    protected $modelActivity = null;
    // 活动用户
    protected $modelActivityUser = null;
    // 活动黑名单用户
    protected $modelActivityBlackUser = null;
    
    // 抽奖中奖
    protected $modelLotteryExchange = null;
    // 抽奖服务
    protected $serviceLottery = null;
    
    // 活动ID
    protected $activity_id = '5ad0270c4a4fe4331b46e456';
    
    // 是否需要微信公众号关注
    private $is_need_subscribed = false;

    private $today = '';

    private $now = null;

    public function initialize()
    {
        $this->now = getCurrentTime();
        $this->today = date('Ymd', $this->now->sec);
        
        $this->modelErrorLog = new \App\Activity\Models\ErrorLog();
        $this->modelActivity = new \App\Activity\Models\Activity();
        $this->modelActivityUser = new \App\Activity\Models\User();
        $this->modelActivityBlackUser = new \App\Activity\Models\BlackUser();
        $this->modelLotteryExchange = new \App\Lottery\Models\Exchange();
        $this->serviceLottery = new \App\Lottery\Services\Api();
        
        try {
            parent::initialize();
        } catch (\Exception $e) {
            $this->modelErrorLog->log($this->activity_id, $e);
        }
    }

    /**
     * 首页，任何人都能进入
     */
    public function indexAction()
    {
        try {
            $objID = new \MongoId('5986a0d24a4fe406dc40c6f1');
            die('index' . $objID->__toString());
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * 获取用户信息的接口
     */
    public function getcampaignuserinfoAction()
    {
        // http://yoox.rice5.com.cn/campaign/aprilcarnival/getcampaignuserinfo
        try {
            $this->view->disable();
            
            // 获取活动信息
            $activityInfo = $this->modelActivity->getActivityInfo2($this->activity_id, $this->now->sec);
            
            // 活动是否开始了
            if (empty($activityInfo['is_activity_started'])) {
                echo $this->error(- 40401, "活动未开始");
                return false;
            }
            // 活动是否暂停
            if (! empty($activityInfo['is_actvity_paused'])) {
                echo $this->error(- 40402, "活动已暂停");
                return false;
            }
            // 活动是否结束了
            if (! empty($activityInfo['is_activity_over'])) {
                echo $this->error(- 40403, "活动已结束");
                return false;
            }
            
            // 从cookie中直接获取
            $userInfo = empty($_COOKIE['Weixin_userInfo']) ? array() : json_decode($_COOKIE['Weixin_userInfo'], true);
            if (empty($userInfo)) {
                echo $this->error(- 40498, "用户信息为空");
                return false;
            }
            
            $FromUserName = trim($userInfo['FromUserName']);
            $nickname = trim($userInfo['nickname']);
            $headimgurl = trim($userInfo['headimgurl']);
            $timestamp = trim($userInfo['timestamp']);
            $signkey = trim($userInfo['signkey']);
            
            // 检查是否锁定，如果没有锁定加锁
            $key = cacheKey(__FILE__, __CLASS__, __METHOD__, $FromUserName);
            $objLock = new \iLock($key);
            if ($objLock->lock()) {
                echo $this->error(- 40499, "上次操作还未完成,请等待");
                return false;
            }
            
            // 记录该用户
            $memo = array(
                'is_got_prize' => false,
                'is_record_lottery_user_contact_info' => false
            );
            $userInfo = $this->getOrCreateActivityUser($FromUserName, $nickname, $headimgurl, 'redpack_user', 'thirdparty_user', $memo);
            
            // 是否是黑名单用户
            $blankUserInfo = $this->modelActivityBlackUser->getInfoByUser($FromUserName, $this->activity_id);
            
            // 根据具体的业务返回相应的信息
            // 获取从奖池数量
            $prizeRemainNum = 0; // $this->getPrizeRemainNum();
                                 
            // 返回值
                                 
            // 当天已经抽奖的次数
            $today_lottery_num = 0;
            if (isset($userInfo['memo'][$this->today])) {
                $today_lottery_num = intval($userInfo['memo'][$this->today]);
            }
            
            $ret = array(
                // 活动信息
                'activityInfo' => $activityInfo,
                // 用户信息
                'userInfo' => array(
                    // 是否关注
                    // 'is_subscribe' => empty($userInfo['memo']['is_subscribe']) ? 0 : 1,
                    // 是否是黑名单用户
                    'is_blankuser' => empty($blankUserInfo) ? 0 : 1,
                    // 奖池
                    'prizeRemainNum' => $prizeRemainNum,
                    // 是否已经中奖过
                    'is_got_prize' => empty($userInfo['memo']['is_got_prize']) ? 0 : 1,
                    // 是否已经填写了中奖联系信息
                    'is_record_lottery_user_contact_info' => empty($userInfo['memo']['is_record_lottery_user_contact_info']) ? 0 : 1,
                    // 抽奖机会，当worth为0是说明不能再抽奖了
                    'worth' => 1,
                    // 当天已经抽奖的次数
                    'today_lottery_num' => $today_lottery_num,
                    // 中奖奖品信息
                    'prizeInfo' => empty($userInfo['memo']['prizeInfo']) ? '' : $this->getPrizeInfo($userInfo['memo']['prizeInfo'])
                )
            );
            
            echo $this->result("OK", $ret);
            return true;
        } catch (\Exception $e) {
            $this->modelErrorLog->log($this->activity_id, $e);
            echo $this->error($e->getCode(), $e->getMessage());
            return false;
        }
    }

    /**
     * 抽奖接口
     */
    public function lotteryAction()
    {
        // http://yoox.rice5.com.cn/campaign/aprilcarnival/lottery?name=guoyongrong&mobile=13564100096&address=xxx
        try {
            $this->view->disable();
            // 获取活动信息
            $activityInfo = $this->modelActivity->getActivityInfo2($this->activity_id, $this->now->sec);
            
            // 活动是否开始了
            if (empty($activityInfo['is_activity_started'])) {
                echo $this->error(- 40401, "活动未开始");
                return false;
            }
            // 活动是否暂停
            if (! empty($activityInfo['is_actvity_paused'])) {
                echo $this->error(- 40402, "活动已暂停");
                return false;
            }
            // 活动是否结束了
            if (! empty($activityInfo['is_activity_over'])) {
                echo $this->error(- 40403, "活动已结束");
                return false;
            }
            
            // 从cookie中直接获取
            $userInfo = empty($_COOKIE['Weixin_userInfo']) ? array() : json_decode($_COOKIE['Weixin_userInfo'], true);
            if (empty($userInfo)) {
                echo $this->error(- 40498, "用户信息为空");
                return false;
            }
            
            $FromUserName = trim($userInfo['FromUserName']);
            $name = trim($this->get('name', ''));
            $mobile = trim($this->get('mobile', ''));
            $address = trim($this->get('address', ''));
            
            // 根据不同的奖品类别进行处理
            $nameCheck = false;
            $mobileCheck = false;
            $addressCheck = false;
            if ($nameCheck) {
                if (empty($name)) {
                    echo $this->error(- 40411, "请填写姓名");
                    return false;
                }
            }
            if ($mobileCheck) {
                if (empty($mobile)) {
                    echo $this->error(- 40412, "请填写手机号");
                    return false;
                }
                if (! isValidMobile($mobile)) {
                    echo $this->error(- 40413, "手机号格式不正确");
                    return false;
                }
            }
            if ($addressCheck) {
                if (empty($address)) {
                    echo $this->error(- 40414, "请填写地址");
                    return false;
                }
            }
            
            // 检查是否锁定，如果没有锁定加锁
            $key = cacheKey(__FILE__, __CLASS__, __METHOD__, $FromUserName);
            $objLock = new \iLock($key);
            if ($objLock->lock()) {
                echo $this->error(- 40499, "请等待");
                return false;
            }
            
            $userInfo = $this->modelActivityUser->getInfoByUserId($FromUserName, $this->activity_id);
            if (empty($userInfo)) {
                echo $this->error(- 40421, 'FromUserName不正确');
                return false;
            }
            
            // 是否是黑名单用户
            $blankUserInfo = $this->modelActivityBlackUser->getInfoByUser($FromUserName, $this->activity_id);
            if (! empty($blankUserInfo)) {
                echo $this->error(- 40422, '该用户已经禁用');
                return false;
            }
            
            // 检查是否已经领取了奖品
            if (! empty($userInfo['memo']['is_got_prize'])) {
                echo $this->error(- 40431, '该用户已领取');
                return false;
            }
            
            if (isset($userInfo['memo'][$this->today]) && intval($userInfo['memo'][$this->today]) >= 3) {
                echo $this->error(- 40433, '你的机会已经用完！<br>凌晨12点你将获得全新3次机会。<br>更多精品请关注我们的官方微信：yooxyooxyoox');
                return false;
            }
            
            // 将抽奖机会次数加一
            $this->incLotteryLimit4Daily($userInfo);
            
            // 抽奖处理
            // 记录抽奖用户的昵称和头像
            $user_info = array(
                'user_name' => $userInfo['nickname'],
                'user_headimgurl' => $userInfo['headimgurl']
            );
            // 抽奖用户联系方式
            $identityContact = array(
                'name' => '',
                'mobile' => '',
                'address' => ''
            );
            // 记录活动用户ID
            $memo = array(
                'activity_user_id' => $userInfo['_id']
            );
            $lotteryResult = $this->serviceLottery->doLottery($this->activity_id, $FromUserName, array(), array(), 'weixin', $user_info, $identityContact, $memo);
            
            // 抽奖成功的话
            if (empty($lotteryResult['error_code']) && ! empty($lotteryResult['result'])) {
                $successInfo = $lotteryResult['result'];
                $ret = $this->getPrizeInfo($successInfo);
                echo ($this->result("OK", $ret));
                fastcgi_finish_request();
                return true;
            } else {
                // 失败的话
                $e = new \Exception($lotteryResult['error_msg'], $lotteryResult['error_code']);
                $this->modelErrorLog->log($this->activity_id, $e);
                echo ($this->error(- 40432, '没有中奖'));
                return false;
            }
        } catch (\Exception $e) {
            $this->modelErrorLog->log($this->activity_id, $e);
            echo $this->error($e->getCode(), $e->getMessage());
            return false;
        }
    }

    /**
     * 记录中奖用户信息的接口
     */
    public function recorduserinfoAction()
    {
        // http://yoox.rice5.com.cn/campaign/aprilcarnival/recorduserinfo?exchange_id=5865f1edfcc2b60a008b456c&identity_id=xxxx&name=guoyongrong&mobile=13564100096&address=shanghai
        try {
            $this->view->disable();
            
            $name = trim($this->get('name', ''));
            $mobile = trim($this->get('mobile', ''));
            $address = trim($this->get('address', ''));
            $exchange_id = trim($this->get('exchange_id', ''));
            $identity_id = trim($this->get('identity_id', ''));
            
            if (empty($exchange_id)) {
                echo $this->error(- 40451, "中奖ID不能为空");
                return false;
            }
            
            if (empty($identity_id)) {
                echo $this->error(- 40452, "身份ID不能为空");
                return false;
            }
            
            // 根据不同的奖品类别进行处理
            $nameCheck = true;
            $mobileCheck = true;
            $addressCheck = true;
            if ($nameCheck) {
                if (empty($name)) {
                    echo $this->error(- 40453, "请填写姓名");
                    return false;
                }
            }
            if ($mobileCheck) {
                if (empty($mobile)) {
                    echo $this->error(- 40454, "请填写手机号");
                    return false;
                }
                if (! isValidMobile($mobile)) {
                    echo $this->error(- 40455, "手机号格式不正确");
                    return false;
                }
            }
            if ($addressCheck) {
                if (empty($address)) {
                    echo $this->error(- 40456, "请填写地址");
                    return false;
                }
            }
            $info = array(
                'is_valid' => true
            );
            
            if (! empty($name))
                $info['contact_name'] = $name;
            
            if (! empty($mobile))
                $info['contact_mobile'] = $mobile;
            
            if (! empty($address))
                $info['contact_address'] = $address;
            
            if (empty($info)) {
                echo $this->error(- 40457, "用户信息不能为空");
                return false;
            }
            
            // 判断是否中奖
            $exchangeInfo = $this->modelLotteryExchange->checkExchangeBy($identity_id, $exchange_id);
            if (empty($exchangeInfo)) {
                echo $this->error(- 40458, "该用户无此兑换信息");
                return false;
            }
            // 获取活动用户信息
            $userInfo = $this->modelActivityUser->getInfoById($exchangeInfo['memo']['activity_user_id']);
            if (empty($userInfo)) {
                echo $this->error(- 40458, "该用户无此兑换信息");
                return false;
            }
            
            // 检查手机号是否使用过了
            $isMobileExist = $this->modelLotteryExchange->findOne(array(
                'activity_id' => $userInfo['activity_id'],
                'contact_mobile' => $mobile,
                'prize_is_virtual' => false
            ));
            if (! empty($isMobileExist)) {
                echo $this->error(- 40461, "手机号已存在");
                return false;
            }
            // 记录中奖用户的信息
            $this->modelLotteryExchange->updateExchangeInfo($exchange_id, $info);
            
            echo ($this->result('处理完成'));
            return true;
        } catch (\Exception $e) {
            // $this->modelErrorLog->log($this->activity_id, $e);
            echo $this->error($e->getCode(), $e->getMessage());
            return false;
        }
    }

    protected function getOrCreateActivityUser($FromUserName, $nickname, $headimgurl, $redpack_user, $thirdparty_user, array $memo = array())
    {
        // 生成活动用户
        $userInfo = $this->modelActivityUser->getOrCreateByUserId($FromUserName, $nickname, $headimgurl, $redpack_user, $thirdparty_user, 1, 0, $this->activity_id, $memo);
        return $userInfo;
    }

    private function getPrizeInfo($successInfo)
    {
        $ret = array();
        $ret['exchange_id'] = $successInfo['_id'];
        $ret['identity_id'] = $successInfo['user_id'];
        $ret['prize_info']['prize_id'] = $successInfo['prize_id'];
        $ret['prize_info']['prize_code'] = $successInfo['prize_code'];
        $ret['prize_info']['prize_name'] = $successInfo['prize_name'];
        $ret['prize_info']['virtual_currency'] = empty($successInfo['prize_virtual_currency']) ? 0 : $successInfo['prize_virtual_currency'];
        $ret['prize_info']['category'] = empty($successInfo['prize_category']) ? 0 : $successInfo['prize_category'];
        $ret['prize_info']['is_virtual'] = empty($successInfo['prize_is_virtual']) ? false : true;
        $ret['code_info']['code'] = $successInfo['prize_virtual_code'];
        $ret['code_info']['pwd'] = $successInfo['prize_virtual_pwd'];
        if (! empty($successInfo['extend_prize_code'])) {
            $ret['code_info']['end_time'] = date('Y-m-d', $successInfo['extend_prize_code']['end_time']->sec);
        }
        return $ret;
    }

    protected function incLotteryLimit4Daily($userInfo)
    {
        // 更新活动用户
        if (! isset($userInfo['memo'][$this->today])) {
            $userInfo['memo'][$this->today] = 0;
        }
        $userInfo['memo'][$this->today] += 1;
        $query = array(
            '_id' => $userInfo['_id']
        );
        $this->modelActivityUser->update($query, array(
            '$set' => array(
                'memo' => $userInfo['memo']
            )
        ));
        return $userInfo;
    }
}

