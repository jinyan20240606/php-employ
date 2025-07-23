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
        echo '进来了-----';
        //查询列表数据
        $list = \app\admin\model\Goods::select();
        // dump($list[0]);
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
        // dump($params, '看下数据');
        // array(6) {
        //     ["/admin/goods/save_html"] => string(0) ""
        //     ["goods_name"] => string(0) ""
        //     ["goods_price"] => string(0) ""
        //     ["goods_number"] => string(0) ""
        //     ["cate_id"] => string(0) ""
        //     这个是富文本的字符串标签信息
        //     ["goods_introduce"] => string(150) "<p>233<strong>333发</strong>人人2025-07-23<img src="/ueditor/php/upload/image/20250723/1753253769.png" title="1753253769.png" alt="image.png"/></p>"
        //   }
        // exit;
//        $params = $request->param();
//        $params = $this->request->param();
//        $params = request()->param();
//        dump($params);die;
        //参数检测 略 （表单验证）
        /*
          参数验证2种方法：1.独立验证 2.控制器验证
        // 1. 独立验证
        // 定义验证规则
        $rule = [
            'goods_name|商品名称' => 'require',
            'goods_price|商品价格' => 'require|float|egt:0' // 大于等于0,
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
        // 2. 控制器验证：可以在控制器中调用validate方法，直接执行验证
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
            $this->error('参数格式错误啦啦：'.$validate);
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
