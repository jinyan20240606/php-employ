<?php

namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Goods extends Model
{
    //特殊表  没有前缀、前缀与配置文件不一致、模型名称和数据表名不对应
    //需要设置table属性（真实的完整的表名称）
    //protected $table = 'tpshop_goods';
    //设置使用软删除 trait
    use SoftDelete;
    //use \traits\model\SoftDelete;
    protected $deleteTime = 'delete_time';
}
