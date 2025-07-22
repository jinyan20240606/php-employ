<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
//use \app\admin\model\Goods;
//use \app\admin\model\Goods as GoodsModel;

class Test extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //手动实例化模型
        //$model = new \app\admin\model\Goods();
        //$model = new Goods();
        //$model = new GoodsModel();

        //查询多条数据

        $data = \app\admin\model\Goods::select();
        /*$data = \app\admin\model\Goods::all();
        $data = \app\admin\model\Goods::select('32,33,34');
        $data = \app\admin\model\Goods::select([32,33,34]);*/
        //dump($data);die;
        /*foreach($data as $v){
            //输出商品名称 goods_name
            //dump($v->goods_name);
            dump($v['goods_name']);
        }
        die;*/
        //返回结果  外层是数组，里面是对象
        //为了打印查看数据方便，可以将返回的结果 转化为标准的二维数组
        //1 foreach
        /*foreach($data as &$v){
            $v = $v->toArray();
        }
        unset($v);//$v没用了就销毁*/
        /*foreach($data as $k=>$v){
            $data[$k] = $v->toArray();
        }*/
        //dump($data);die;
        //2. 集合对象 \think\Collection
        $data = (new \think\Collection($data))->toArray();
        dump($data);die;
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //url生成
        dump( url('admin/test/index') );
        dump( url('admin/test/read', ['id' => 10, 'page' => 20]) );
        dump( url('admin/test/read', ['id' => 10, 'page' => 20], false) );
        dump( url('admin/test/read', ['id' => 10, 'page' => 20], true, true) );
        die;
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //where方法使用
        //$goods = \app\admin\model\Goods::where('id', '=', 33)->find();
        //$goods = \app\admin\model\Goods::where('id', 33)->find();
        //$goods = \app\admin\model\Goods::where('goods_price', '>', '100')->select();
        //$goods = \app\admin\model\Goods::find(33);
        //dump($goods);die;

        //注意：使用where方法后，只能调用  find  select方法，不能使用 get  all 方法
        //$goods = \app\admin\model\Goods::where('id', '=', 33)->find();
        //$goods = \app\admin\model\Goods::where('id', '=', 33)->get();
//        $goods = \app\admin\model\Goods::get(33);
//        dump($goods);die;

        //连表查询语法
        //SELECT t1.*, t2.username FROM `tpshop_address` as t1 left join tpshop_user as t2 on t1.user_id = t2.id where t1.id < 10;
//        $data = \app\admin\model\Address::alias('t1')
//            ->join('tpshop_user t2', 't1.user_id = t2.id', 'left')
//            ->where('t1.id', '<', 10)
//            ->field('t1.*, t2.username')
//            ->select();
//        dump($data);die;

        //统计查询
//        $count = \app\admin\model\Goods::where('id', '>', 35)->count();
//        dump($count);

        //字段值查询
        /*$goods_name = \app\admin\model\Goods::where('id', 33)->value('goods_name');
        dump($goods_name);

        $goods_names = \app\admin\model\Goods::where('id','>', 35)->column('goods_name');
        dump($goods_names);

        $goods_names = \app\admin\model\Goods::where('id','>', 35)->column('goods_name', 'id');
        dump($goods_names);*/

        //小结 where方法  常用连贯操作方法
        $goods = \app\admin\model\Goods::where('id', '>', '35')
            ->where('goods_name', 'like', '%iphone%')
            ->field('id,goods_name,goods_price')
            ->order('goods_number desc, goods_price asc')
            ->select();
        dump($goods);

        $goods = \app\admin\model\Goods::where('goods_name', 'like', '%iphone%')->select();
        dump($goods);
        //连表查询语法
        //SELECT t1.*, t2.username FROM `tpshop_address` as t1 left join tpshop_user as t2 on t1.user_id = t2.id where t1.id < 10;
        $data = \app\admin\model\Address::alias('t1')
            ->join('tpshop_user t2', 't1.user_id = t2.id', 'left')
            ->where('t1.id', '<', 10)
            ->field('t1.*, t2.username')
            ->select();
        dump($data);die;

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
        $goods = \app\admin\model\Goods::find(32);
        //$goods = \app\admin\model\Goods::get(33);
//        dump($goods);
//        dump($goods->goods_name);
//        dump($goods['goods_price']);
        //如果转化为数组，只能使用数组语法
        $goods = $goods->toArray();
        dump($goods);
        dump($goods['goods_name']);
        //dump($goods->goods_name); 会报错
        die;
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {

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

    public function tianjia()
    {
        //添加数据
        //save方法
        /*$goods_model = new \app\admin\model\Goods();
        $goods_model->goods_name = 'huawei';
        $goods_model->goods_price = '2999';
        $goods_model->save();
        dump($goods_model->id);*/

        //静态create方法
        /*$data = ['goods_name' => 'xiaomi', 'goods_price'=>'1799'];
        $goods = \app\admin\model\Goods::create($data);
        dump($goods->id);*/

        //批量添加
        /*$goods_model = new \app\admin\model\Goods();
        $data = [
            ['goods_name' => 'xiaomi1', 'goods_price'=>'1799'],
            ['goods_name' => 'xiaomi2', 'goods_price'=>'1799'],
        ];
        $res = $goods_model->saveAll($data);
        dump($res);*/
    }
}
