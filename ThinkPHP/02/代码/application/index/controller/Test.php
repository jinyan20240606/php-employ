<?php
//1 声明命名空间
namespace app\index\controller;
//2 引入 基类控制器
use think\Controller;
//3 定义当前控制器类
class Test extends Controller
{
    public function index()
    {
        echo 'hello world';die;
    }
}