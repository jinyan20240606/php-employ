<?php
//1 声明命名空间
namespace app\index\controller;
//2 引入 基类控制器（通过use的方式加不加斜杠都可以）
use think\Controller;
//3 定义当前控制器类
class Test extends Controller
{
    public function index1($name1)
    {
        $a = 10;
        $b = 20;
        $c = 30;
        echo 'hello w1orld',$a,$b,$c,$name1;
    }
}

// http://www.tpshop1.com/index.php/Index/Test/index1/name1/1  是pathinfo式url请求方式