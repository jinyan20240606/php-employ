<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Db extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //执行原生sql  查询
//        $res = \think\Db::query('select * from tpshop_goods where id = :id', ['id' => 33]);
//        dump($res);die;
        //执行原生sql  添加
        $res = \think\Db::execute('insert into tpshop_goods (goods_name, goods_price) values (:goods_name, :goods_price)', ['goods_name' => 'tp', 'goods_price' => 100]);
        dump($res);die;

        //Db类的方法：查询
        $goods = \think\Db::table('tpshop_goods')->where('id', 33)->find();
        //$goods = \app\admin\model\Goods::where('id', 33)->find();
        $goods = \think\Db::table('tpshop_goods')->select();
        //添加
        $res = \think\Db::table('tpshop_goods')->insert(['goods_name' => 'tp', 'goods_price' => 100]);
        //修改
        $res = \think\Db::table('tpshop_goods')->where('id', 33)->update(['goods_name' => 'tp', 'goods_price' => 100]);
        //删除
        $res = \think\Db::table('tpshop_goods')->where('id', 33)->delete();


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
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
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
