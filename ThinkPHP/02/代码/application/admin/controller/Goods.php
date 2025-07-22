<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;


class Goods extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //查询列表数据
        $list = \app\admin\model\Goods::select();
        //$this->assign('list', $list);
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
        //接收参数
        $params = input();
//        $params = $request->param();
//        $params = $this->request->param();
//        $params = request()->param();
//        dump($params);die;
        //参数检测 略 （表单验证）
        /*
        //1.独立验证
        // 定义验证规则
        $rule = [
            'goods_name|商品名称' => 'require',
            'goods_price|商品价格' => 'require|float|egt:0',
            'goods_number|商品数量' => 'require|integer|egt:0'
        ];
        //定义错误提示信息（可选）
        $msg = [
            'goods_price.float' => '商品价格必须是整数或者小数'
        ];
        //实例化验证类Validate
        $validate = new \think\Validate($rule, $msg);
        //执行验证
        if(!$validate->check($params)){
            //验证失败
            $error_msg = $validate->getError();
            $this->error($error_msg);
        }
        */
        //2.控制器验证
        // 定义验证规则
        $rule = [
            'goods_name|商品名称' => 'require',
            'goods_price|商品价格' => 'require|float|egt:0',
            'goods_number|商品数量' => 'require|integer|egt:0'
        ];
        //定义错误提示信息（可选）
        $msg = [
            'goods_price.float' => '商品价格必须是整数或者小数'
        ];
        //调用控制器的validate方法
        $validate = $this->validate($params, $rule, $msg);
        if($validate !== true){
            //验证失败， $validate 就是一个字符串错误信息
            $this->error($validate);
        }
        //添加数据到数据表  第二个参数true表示过滤非数据表字段
        \app\admin\model\Goods::create($params, true);
        //页面跳转
        $this->success('操作成功', 'admin/goods/index');
        //$this->error('操作失败');
        //$this->redirect( 'admin/goods/index');
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //查询一条数据
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
        return view();
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
