<?php

namespace app\admin\controller;

use think\Controller;

class Login extends Controller
{
    //登录
    public function login()
    {
        //一个方法 处理两个业务逻辑：页面展示  表单提交
        if(request()->isPost()){
            //post请求  表单提交
            //接收参数  username  password  code
            $params = input();
            //参数检测 （表单验证）
            $rule = [
                'username|用户名' => 'require',
                'password|密码' => 'require',
                'code|验证码' => 'require'
                //'code|验证码' => 'require|captcha:login'
            ];
            $res = $this->validate($params, $rule);
            if($res !== true){
                $this->error($res);
            }
            //验证码手动校验
            if(!captcha_check($params['code'], 'login')){
                $this->error('验证码错误');
            }
            //查询管理员用户表
            $password = encrypt_password($params['password']);
            $manager = \app\admin\model\Manager::where('username', $params['username'])->where('password', $password)->find();
            //$manager = \app\admin\model\Manager::where(['username' => $params['username'], 'password' => $password])->find();
            if($manager){
                //登录成功
                //设置登录标识到session
                session('manager_info', $manager->toArray());
                //页面跳转
                $this->success('登录成功', 'admin/index/index');
            }else{
                //用户名或密码错误
                $this->error('用户名或密码错误');
            }
        }else{
            //get请求  页面展示
            //临时关闭全局模板布局
            $this->view->engine->layout(false);
            return view();
        }
    }

    //退出
    public function logout()
    {
        //清空session
        session(null);
        $this->redirect('admin/login/login');
    }
}
