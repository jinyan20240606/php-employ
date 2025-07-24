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

if(!function_exists('encrypt_password')){
    //密码加密函数
    function encrypt_password($string)
    {
        //加盐
        $salt = 'sanelm4lkmfds3prrf';
        return md5($salt . md5($string));
    }
}

if(!function_exists('curl_request')){
    //发送curl请求
    function curl_request($url, $type = false, $params = [], $https=false)
    {
        //调用curl_init() 初始化请求
        $ch = curl_init($url);
        //调用curl_setopt()设置请求选项
        if($type){
            //true 发送post请求  false 默认发送get请求
            //post请求  设置请求方式
            curl_setopt($ch, CURLOPT_POST, true);
            //设置请求参数
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }
        //如果是https请求，咱是发起方，跳过对目标服务器返回的证书的ssl证书验证，即使有问题也继续请求
        if($https){
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }
        //调用curl_exec() 发送请求 获取结果CURLOPT_RETURNTRANSFER，false只会返回状态码，true会返回结果
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
//        if(!$res){ // 一般详细错误信息不用给
//            //获取curl的错误信息
//            $error = curl_error($ch);
//            //错误码
//            $errno = curl_errno($ch);
//        }
        //调用curl_close() 关闭请求
        curl_close($ch);

        return $res;
    }
}
