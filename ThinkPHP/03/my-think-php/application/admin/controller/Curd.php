<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Curd extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //查询列表数据
        $list = \app\admin\model\Goods::order('id desc')->select();
        return view('index', ['list' => $list]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return view();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //接收数据
        $params = input();
        //参数检测 略
        //添加数据
        \app\admin\model\Goods::create($params, true);
        //页面跳转
        $this->success('操作成功', 'index');
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //查询数据
        $goods = \app\admin\model\Goods::find($id);
        return view('read', ['goods' => $goods]);
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //查询数据
        $goods = \app\admin\model\Goods::find($id);
        return view('edit', ['goods' => $goods]);
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
        //接收数据
        $params = input();
        //参数检测 略
        //修改数据
        \app\admin\model\Goods::update($params, ['id' => $id], true);
        //页面跳转
        $this->success('操作成功', 'index');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //删除数据
        \app\admin\model\Goods::destroy($id);
        //页面跳转
        $this->success('操作成功', 'index');
    }
}
