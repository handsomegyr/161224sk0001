<?php
namespace Weixin\Model;

/**
 * 使用日期，有效期的信息
 */
class DateInfo
{

    /**
     * type
     * 使用时间的类型是1：固定日期区间，2：固定时长（自领取后按天算）
     * DATE_TYPE_FIX_TIME_RANGE 表示固定日期区间，
     * DATE_TYPE_FIX_TERM表示固定时长（自领取后按天算。
     * 是
     */
    public $type = NULL;

    /**
     * begin_timestamp
     * 固定日期区间专用，表示起用时间。
     * 从1970 年1 月1 日00:00:00 至起用时间的秒数，最终需转换为字符串形态传入，下同。（单位为秒）
     * 是
     */
    public $begin_timestamp = NULL;

    /**
     * end_timestamp
     * 固定日期区间专用，表示结束时间。（单位为秒）
     * 是
     */
    public $end_timestamp = NULL;

    /**
     * fixed_term
     * 固定时长专用，表示自领取后多少天内有效。（单位为天）
     * 是
     */
    public $fixed_term = NULL;

    /**
     * fixed_begin_term
     * 固定时长专用，表示自领取后多少天开始生效。（单位为天）
     * 是
     */
    public $fixed_begin_term = NULL;

    public function __construct($type, $begin_timestamp, $end_timestamp, $fixed_term, $fixed_begin_term)
    {
        // if (! is_int($type))
        // exit("DateInfo.type must be integer");
        $this->type = $type;
        // 固定日期区间
        if ($type === 1 || 'DATE_TYPE_FIX_TIME_RANGE' == $type) {
            if (! is_int($begin_timestamp) || ! is_int($end_timestamp))
                exit("begin_timestamp and  end_timestamp must be integer");
            $this->begin_timestamp = $begin_timestamp;
            $this->end_timestamp = $end_timestamp;
        } else 
            // 固定时长（自领取后多少天内有效）
            if ($type === 2 || 'DATE_TYPE_FIX_TERM' == $type) {
                if (! is_int($fixed_term) || ! is_int($fixed_begin_term))
                    exit("fixed_term must be integer");
                $this->fixed_term = $fixed_term;
                $this->fixed_begin_term = $fixed_begin_term;
            } else
                exit("DateInfo.tpye Error");
    }

    public function getParams()
    {
        $params = array();
        
        if ($this->isNotNull($this->type)) {
            $params['type'] = $this->type;
        }
        if ($this->isNotNull($this->begin_timestamp)) {
            $params['begin_timestamp'] = $this->begin_timestamp;
        }
        if ($this->isNotNull($this->end_timestamp)) {
            $params['end_timestamp'] = $this->end_timestamp;
        }
        if ($this->isNotNull($this->fixed_term)) {
            $params['fixed_term'] = $this->fixed_term;
        }
        if ($this->isNotNull($this->fixed_begin_term)) {
            $params['fixed_begin_term'] = $this->fixed_begin_term;
        }
        
        return $params;
    }

    protected function isNotNull($var)
    {
        return ! is_null($var);
    }
}