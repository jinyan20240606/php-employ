<?php

namespace app\index\controller;

use think\Db;
class Index {

    public function index() {
        return '你好世界';
    }

    public function test(){
        return '你现在好吗?';
    }

    public function test2(){

        return 'test2';
    }
}
