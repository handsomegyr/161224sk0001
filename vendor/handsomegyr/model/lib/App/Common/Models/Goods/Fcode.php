<?php
namespace App\Common\Models\Goods;

use App\Common\Models\Base\Base;

class Fcode extends Base
{

    function __construct()
    {
        $this->setModel(new \App\Common\Models\Goods\Mysql\Fcode());
    }
}