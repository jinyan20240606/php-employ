<?php

namespace app\api\controller;

use think\Controller;
use think\Request;

class News extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //返回数据数组
        $res = ['code' => 200, 'msg'=>'success', 'data'=>'index'];
        //返回json格式数据
        //echo json_encode($res);die; //原生php写法
        return json($res); //TP框架的写法 封装好的json方法
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //返回数据数组
        $res = ['code' => 200, 'msg'=>'success', 'data'=>'create'];
        return json($res); //TP框架的写法
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //返回数据数组
        $res = ['code' => 200, 'msg'=>'success', 'data'=>'save'];
        return json($res); //TP框架的写法
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {

        //返回数据数组
        $res = ['code' => 200, 'msg'=>'success', 'data'=>'read'];
        return json($res); //TP框架的写法
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //返回数据数组
        $res = ['code' => 200, 'msg'=>'success', 'data'=>'edit'];
        return json($res); //TP框架的写法
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
        //返回数据数组
        $res = ['code' => 200, 'msg'=>'success', 'data'=>'update'];
        return json($res); //TP框架的写法
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //返回数据数组
        $res = ['code' => 200, 'msg'=>'success', 'data'=>'delete'];
        return json($res); //TP框架的写法
    }
}
