<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
// 这个判断是为了防止重复定义函数，特别是在多个文件中引入该函数时
if(!function_exists('encrypt_password')){
    //密码加密函数
    function encrypt_password($string)
    {
        //加盐
        $salt = 'sanelm4lkmfds3prrf';
        return md5($salt . md5($string));
    }
}