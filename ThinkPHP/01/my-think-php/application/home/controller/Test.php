<?php

namespace app\home\controller;

use think\Controller;
use think\Request;

class Test extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        /*
        //获取请求对象的3种写法：
        //$request = Request::instance(); //对象方法
        $request = request();//函数
        $request = $this->request;//父类控制器的属性

        //接收参数多种写法： （获取输入变量）
        $params = $request->param();
//        echo '<pre>';
//        var_dump($params);
        dump($params); // dump封装的函数相当于上面2行
        //单独接收某一个
        $id = $request->param('id');
        dump($id);

        //input函数
        $data = input();
        dump($data);
        $name = input('name');
        dump($name);*/

        //request对象的 get  param   route 区别
        $request = request();
        $get = $request->get();
        $param = $request->param();
        $route = $request->route();
        dump($get);
        dump($param);
        dump($route);

        $id = $this->request->param('id');
        // dump($id);

    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request) // 依赖注入写法
    {
//        $request = request();
        $name = $request->param('name');
        dump($name);
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id, $name='') // 可以写多个，逗号隔开
    {
        //参数绑定  id不用再手动接收
        dump($id);
//        $id = input('id');
//        $id = request()->param('id');
    }

    /**
     * 利用视图：显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //渲染模板 的2种方法：view和fetch
//        return view();
//        return view('edit');
//        return $this->fetch();
//        return $this->fetch('edit'); // 指定模板文件名称，默认是当前方法名
        
        // 变量赋值的2种方法：
        // 方法1：变量赋值及渲染模板
//        $user = ['id' => 100, 'username' => 'zhangsan'];
//        $this->assign('user', $user);
//        return view();
//        return $this->fetch();

        // 方法2：使用 view进行变量赋值
//        $user = ['id' => 100, 'username' => 'zhangsan'];
//        $age = 30;
//        return view('edit', ['user' => $user, 'age' => $age]);//我用这个
//        return $this->fetch('edit', ['user' => $user, 'age' => $age]);

        //php的函数  compact
        $user = ['id' => 100, 'username' => 'zhangsan'];
        $age = 30;
        // 想要得到数组 ['user' => $user, 'age' => $age]
        dump(compact('user', 'age'));die; // 省去了'user'->$user对应
        // 利用view方法进行模板渲染
        return view('edit', compact('user', 'age'));


    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
