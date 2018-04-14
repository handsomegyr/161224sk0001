/**
 * @file 公共JS文件
 * @author Mayon
 */
(function(){
    /**
     * 微信分享
     */
    function wxShareInit(config, callback) {
        //通过config接口注入权限验证配置
        wx.config({
            debug: false,            // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
            appId: config.appId,              // 必填，公众号的唯一标识
            timestamp: config.timestamp,          // 必填，生成签名的时间戳
            nonceStr: config.nonceStr,           // 必填，生成签名的随机串
            signature: config.signature,          // 必填，签名，见附录1
            jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ', 'onMenuShareWeibo', 'onMenuShareQZone']
                                    // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
        });
        //通过ready接口处理成功验证
        wx.ready(function(){
            
            typeof callback == "function" && callback();
            // config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready函数中。
            var shareInfo = {};
            // 分享到朋友圈
            wx.onMenuShareTimeline({
                title: '我刚刚抽到了YOOX送我的新年大礼包，价值一个亿',  // 分享标题
                desc: shareDesc,   // 分享描述
                link: domain + '/2018cny/index.html',       // 分享链接
                imgUrl: domain + '/2018cny/img/share.jpg',  // 分享图标
                type: 'link',           // 分享类型,music、video或link，不填默认为link
                dataUrl: '',            // 如果type是music或video，则要提供数据链接，默认为空
                success: function () {  // 用户确认分享后执行的回调函数
                },
                cancel: function () {   // 用户取消分享后执行的回调函数
                }
            });
            // 分享给朋友
            wx.onMenuShareAppMessage({
                title: '我刚刚抽到了YOOX送我的新年大礼包，价值一个亿',  // 分享标题
                desc: shareDesc,   // 分享描述
                link: domain + '/2018cny/index.html',       // 分享链接
                imgUrl: domain + '/2018cny/img/share.jpg',  // 分享图标
                type: 'link',           // 分享类型,music、video或link，不填默认为link
                dataUrl: '',            // 如果type是music或video，则要提供数据链接，默认为空
                success: function () {  // 用户确认分享后执行的回调函数
                },
                cancel: function () {   // 用户取消分享后执行的回调函数
                }
            });
            // 分享到QQ
            wx.onMenuShareQQ({
                title: '我刚刚抽到了YOOX送我的新年大礼包，价值一个亿',  // 分享标题
                desc: shareDesc,   // 分享描述
                link: domain + '/2018cny/index.html',       // 分享链接
                imgUrl: domain + '/2018cny/img/share.jpg',  // 分享图标
                type: 'link',           // 分享类型,music、video或link，不填默认为link
                dataUrl: '',            // 如果type是music或video，则要提供数据链接，默认为空
                success: function () {  // 用户确认分享后执行的回调函数
                },
                cancel: function () {   // 用户取消分享后执行的回调函数
                }
            });
            // 分享到腾讯微博
            wx.onMenuShareWeibo({
                title: '我刚刚抽到了YOOX送我的新年大礼包，价值一个亿',  // 分享标题
                desc: shareDesc,   // 分享描述
                link: domain + '/2018cny/index.html',       // 分享链接
                imgUrl: domain + '/2018cny/img/share.jpg',  // 分享图标
                type: 'link',           // 分享类型,music、video或link，不填默认为link
                dataUrl: '',            // 如果type是music或video，则要提供数据链接，默认为空
                success: function () {  // 用户确认分享后执行的回调函数
                },
                cancel: function () {   // 用户取消分享后执行的回调函数
                }
            });
            // 分享到QQ空间
            wx.onMenuShareQZone({
                title: '我刚刚抽到了YOOX送我的新年大礼包，价值一个亿',  // 分享标题
                desc: shareDesc,   // 分享描述
                link: domain + '/2018cny/index.html',       // 分享链接
                imgUrl: domain + '/2018cny/img/share.jpg',  // 分享图标
                type: 'link',           // 分享类型,music、video或link，不填默认为link
                dataUrl: '',            // 如果type是music或video，则要提供数据链接，默认为空
                success: function () {  // 用户确认分享后执行的回调函数
                },
                cancel: function () {   // 用户取消分享后执行的回调函数
                }
            });
        });
        //通过error接口处理失败验证
        wx.error(function(res){
            // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
            console.info(res);
        });
    }

    // 长按
    $.fn.longPress = function(fn) {
        var timeout = undefined;
        var $this = this;
        for(var i = 0;i<$this.length;i++){
            $this[i].addEventListener('touchstart', function(event) {
                timeout = setTimeout(fn, 800);
                }, false);
            $this[i].addEventListener('touchend', function(event) {
                clearTimeout(timeout);
                }, false);
        }
    }

    // 复制
    function setText(text){
    　　var text = text || '';
    　　window.clipboardData.setData('text', text);
　　}

    function randomBg() {
        var sum = 6;
        var index = parseInt(Math.random() * sum);
        var $page2Bg = $('.page2-bg');
        $page2Bg.css('background-image', 'url("img/page2-bg' + index + '.jpg")');
    }

    function randomResultBg() {
        var sum = 8;
        var index = Math.floor(Math.random() * sum);
        $('.alert-result .result-img').html('<img src="img/result-img' + Math.floor(index/2) + '.png">');
        $('.alert-result .result-text').html(lottery_text[index]);
        $('#J_alertSave .save-detail').html('<img src="img/result-bg' + index + '.jpg">');
        shareDesc = lottery_text[index].replace('<br>','');
    }

    function slideToPage(index) {
        var _index = index || 1;
        var $pages = $('#J_pages');
        $pages.data('index', _index);
        if (_index == 1) {
            setTimeout(function () {
                slideToPage(2);
            }, 6000);
        } else if (_index == 2) {
            // 显示 nav
            $('.nav-bar').addClass('show');
        }
    }

    function showErrorTips(text) {
        $('.tips-info-text').html(text);
        openAlert('J_alertTips', true);
    }

    function shakeInput(input) {
        var className = 'shake';
        if (input.hasClass(className)) {
            input.removeClass(className);
        }
        clearTimeout();
        input.addClass('shake');
        setTimeout(function () {
            input.removeClass('shake');
        }, 420);
    }

    function closeAlert(id) {
        var selector = id ? ('#' + id) : '.alert';
        $(selector).removeClass('open').css('visibility', 'hidden');
    }

    function openAlert(id) {
        closeAlert(id);
        var $cur_alert = $('#' + id);
        console.info($cur_alert);
        $cur_alert.css('visibility', 'visible').addClass('open');
    }

    function showResult() {
        var $result;
        if (loterryInfo.prize_info.is_virtual) {
            if (loterryInfo.code_info.code) {
                $result = $('#J_alertResult2');
                $result.find('.gift-name').html(loterryInfo.prize_info.prize_name);
                $result.find('.gift-time').html(loterryInfo.code_info.end_time);
                $result.find('input[name="code"]').val(loterryInfo.code_info.code);
                openAlert('J_alertResult2');            // 虚拟奖品
            } else {
                closeAlert();                               // 打开前关闭所有弹窗
                showErrorTips('您没有中奖!');
                resetPage();
            }
        } else {
            $result = $('#J_alertResult1');
            $result.find('.gift-name').html(loterryInfo.prize_info.prize_name);
            openAlert('J_alertResult1');            // 实物奖品
        }
    }

    function lottery(event) {
        if (lottery_num >= lottery_limit) {
            showErrorTips('今天没有抽奖机会了');
            return false;
        }
        randomResultBg();
        $.ajax({
            url : domain + '/campaign/cny2018/lottery',
            type : 'GET',
            data : {},
            dataType : "json",
            contentType: "application/json",
            success : function (res) {
                console.info(res);
                lottery_num ++;
                $('.lottery_sum_number').html(lottery_limit - lottery_num > 0 ? lottery_limit - lottery_num : 0);
                if (res.success) {
                    loterryInfo = res.result;
                    showResult();
                } else {
                    closeAlert();                               // 打开前关闭所有弹窗
                    showErrorTips(res.error_msg);
                    resetPage();
                }
            },
            error : function (err) {
                console.info(err);
                resetPage();
            }
        });
    }

    function resetPage() {
        // reset page
        $('input').val('');
        $('.play-btn').show();
        $('.play-gif').html('');
    }

    function lotteryAgain() {
        if (lottery_num >= lottery_limit) {
            showErrorTips('今天没有抽奖机会了');
            return false;
        }
        closeAlert();
        resetPage();
    }

    function showRule() {
        openAlert('J_alertRule');
    }

    function showSave() {
        openAlert('J_alertSave');
    }

    function showShare() {
        openAlert('J_alertShare', true);
    }

    function sendPhone() {
        var $result = $('#J_alertResult2');
        var $mobile = $result.find('input[name="mobile"]');

        if (!$mobile.val()) {
            shakeInput($mobile);
            return false;
        }
        var data = {};
        data.exchange_id = loterryInfo.exchange_id;
        data.identity_id = loterryInfo.identity_id;
        data.mobile = $mobile.val();
        if(!/(^(([0\+]\d{2,3}-)?(0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$)|(^0{0,1}1[3|4|5|6|7|8|9][0-9]{9}$)/.test(data.mobile)) {
            shakeInput($mobile);
            $mobile.val('手机号不正确');
            return false;
        }
        var $btn = $(this);
        $btn.html('发送中').attr('disable','');
        $result.find('.send-loading').show();
        $.ajax({
            url : domain + '/campaign/cny2018/sendsms',
            type : 'GET',
            data : data,
            dataType : "json",
            contentType: "application/json",
            success : function (res) {
                console.info(res);
                $result.find('.send-loading').hide();
                if (res.success) {
                    //add billy
                    $btn.html('已发送');
                    $mobile.val('短信已发送成功!');
                } else {
                    console.info(res.error_msg);
                    shakeInput($mobile);
                    $mobile.val(res.error_msg);
                    $btn.html('发 送').removeAttr('disable');
                }
            },
            error : function (err) {
                console.info(err);
                shakeInput($mobile);
                $mobile.val('网络有误，重新再试');
                $btn.html('发 送').removeAttr('disable');
                $result.find('.send-loading').hide();
            }
        });
    }

    function sendInfo() {
        var $result = $('#J_alertResult1');
        var $mobile = $result.find('input[name="mobile"]');

        var $inputs = $result.find('input');
        for (var i = 0; i < 3; i++) {
            var $input = $inputs.eq(i);
            if (!$input.val()) {
                shakeInput($input);
                return false;
            }
        }
        var data = {};
        data.exchange_id = loterryInfo.exchange_id;
        data.identity_id = loterryInfo.identity_id;
        data.name = $result.find('input[name="name"]').val();
        data.mobile = $result.find('input[name="mobile"]').val();
        data.address = $result.find('input[name="address"]').val();
        if(!/(^(([0\+]\d{2,3}-)?(0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$)|(^0{0,1}1[3|4|5|6|7|8|9][0-9]{9}$)/.test(data.mobile)) {
            shakeInput($mobile);
            $mobile.val('手机号不正确');
            return false;
        }
        var $btn = $(this);
        $btn.html('提交中').attr('disable','');
        $result.find('.send-loading').show();
        $.ajax({
            url : domain + '/campaign/cny2018/recorduserinfo',
            type : 'GET',
            data : data,
            dataType : "json",
            contentType: "application/json",
            success : function (res) {
                console.info(res);
                $result.find('.send-loading').hide();
                if (res.success) {
                    $btn.html('已提交');
                } else {
                    shakeInput($mobile);
                    $mobile.val(res.error_msg);
                    $btn.html('提交信息').removeAttr('disable');
                }
            },
            error : function (err) {
                console.info(err);
                shakeInput($mobile);
                $mobile.val('网络有误，重新再试');
                $btn.html('提交信息').removeAttr('disable');
                $result.find('.send-loading').hide();
            }
        });
    }

    function getUserinfo(callback) {
        $.ajax({
            url : domain + '/campaign/cny2018/getcampaignuserinfo',
            type : 'POST',
            data : {},
            dataType : "json",
            contentType: "application/json",
            success : function (res) {
                console.info(res);
                if (res.success) {
                    user = res.result;
                    typeof callback == 'function' && callback();
                } else if (res.error_code == -40001 || res.error_code == -40002 || res.error_code == -40003 || res.error_code == -40499) {
                    console.info(res.error_msg);
                } else if (res.error_code == -40498) {
                    location.href = domain + '/campaign/cny2018/weixinauthorizebefore?callbackUrl='
                        + encodeURIComponent('http://yoox.rice5.com.cn/2018cny/index.html?show=2');
                }
            },
            error : function (err) {
                console.info(err);
            }
        });
    }

    function checkAuthorize(callback) {
        if (Weixin_userInfo) {  // 如果已经授权过,则拉取用户信息
            getUserinfo(callback);
        } else {                // 如果未授权,则跳转到授权地址
            location.href = domain + '/campaign/cny2018/weixinauthorizebefore?callbackUrl='
                + encodeURIComponent('http://yoox.rice5.com.cn/2018cny/index.html?show=2');
        }
    }

    function copy(){
        setText($(this).val());
    }

    function bind() {
        $('.J_closeAlert').on('click', function () {
            closeAlert($(this).parents('.alert').attr('id'));
        });
        $('#J_ruleTrigger').on('click', showRule);
        $('.J_shareTrigger').on('click', showShare);
        $('.J_saveTrigger').on('click', showSave);

        // $('#J_sendPhone').on('click', sendPhone);

        $('#J_sendInfo').on('click', sendInfo);
        $('.J_lotteryAgain').on('click', lotteryAgain);
        $('#J_code').longPress(copy);

        $('.play-btn').on('click', function (event) {
            checkAuthorize(function () {
                event.stopPropagation();
                $('.play-btn').hide();
                $('.play-gif').html('<img src="img/pink.gif">');
                setTimeout(lottery, 2000);
                return false;
            });
        });
    }

    function init() {
        var _init = function () {
            randomResultBg();           // for test
            // 界面初始化
            var $loader = $('#J_loading');
            var $main = $('#J_main');
            $loader.hide();
            $main.removeClass('hide');
            // setTimeout(function () {
                $main.addClass('init');
                // 界面跳转
                if (/show=2/.test(location.href)) {
                    checkAuthorize(function () {
                        slideToPage(2);
                    });
                } else {
                    slideToPage(1);
                }
            // }, 50);
            bind();
        };
        // for test
        _init();

        $.ajax({
            url : domain + '/weixin/index/getjssdkinfo',
            type : 'GET',
            data : {
                url : location.href
            },
            dataType : "json",
            contentType: "application/json",
            success : function (res) {
                console.info(res);
                if (res.success) {
                    wxShareInit(res.result, _init);
                } else {
                    console.info(res.error_msg);
                }
            },
            error : function (err) {
                console.info(err);
            }
        });
    }

    var domain = 'http://yoox.rice5.com.cn';
    var lottery_limit = 4;                        // 抽奖次数限制
    var lottery_num = 0;
    var lottery_text = [
        "在不断的自我怀疑中奋力前行，<br>2018，你的恒心和毅力是时候得到回报了。",
        "工作虽有压力和挑战，<br>2018会势如破竹，一丝不狗。",
        "抽中这张签，代表2018年你会<br>“很健康”如神犬一样行动机灵、体态轻盈。",
        "如果你仍然在坚持注意日常的保养和调理，<br>2018 狗年旺旺，身体壮壮。",
        "甜言蜜语不如好好行动，<br>即刻行动，爱情便能开花结狗。",
        "2017是耕耘和积累的一年，<br>你的 2018 会各种开花结狗。",
        "2018 年多买 YOOX，<br>买到就是赚到，立省三个亿。",
        "俗话说“狗来富”，<br>2018年的你入账平稳，红花不停。"
    ];
    var shareDesc = lottery_text[0];

    var Weixin_userInfo = $.cookie('Weixin_userInfo');
    var user;
    var loterryInfo;

    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(init, 1000);
    });

})();
