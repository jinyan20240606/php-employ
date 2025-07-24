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
        echo encrypt_password('123456');die;

        $_SESSION['username'] = 'admin';
        $_SESSION['abc']['username'] = 'admin';
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

    public function tp02()
    {
        //推荐静态调用
        //查询多条数据  外层数组，里层是一个一个的对象
        $list = \app\admin\model\Goods::select();
        $list = \app\admin\model\Goods::all();
        $list = \app\admin\model\Goods::select('1,2,3');
        $list = \app\admin\model\Goods::select([1,2,3]);

        //查询一条数据
        $goods = \app\admin\model\Goods::find();
        $goods = \app\admin\model\Goods::find(32);
        $goods = \app\admin\model\Goods::get(33);

        //新增一条数据  第二个参数过滤非数据表字段
        \app\admin\model\Goods::create(['goods_name' => 'tp', 'goods_price'=>100], true);

        //实例化模型再调用
        //$model = new \app\admin\model\Goods();
        //查询多条
        $model = new \app\admin\model\Goods();
        $list = $model->select();
        //查询一条
        $model = new \app\admin\model\Goods();
        $goods = $model->find(32);
        //新增一条
        $model = new \app\admin\model\Goods();
        $model->goods_name = 'tp';
        $model->goods_price = 100;
        $model->allowField(true)->save();
        //新增多条（批量新增）
        $model = new \app\admin\model\Goods();
        $data = [
            ['goods_name' => 'tp123', 'goods_price' => 100],
            ['goods_name' => 'tp1234', 'goods_price' => 200],
        ];
        $model->saveAll($data);

        //表单验证
        //验证规则
        $rule = [
            // '字段名称|翻译中文名' => '验证规则|验证规则2:参数|规则3'
            'goods_name|商品名称' => 'require|max:100',
            'goods_price|商品价格' => 'require|float|egt:0',
            'goods_number|商品数量' => 'require|integer|egt:0',
        ];
        $msg = [
            // '字段名称.规格名称' =>  '错误信息'
             'goods_price.float' =>  '商品价格必须是整数或者小数'
        ];
        $params = input();
        //独立验证
        $validate = new \think\Validate($rule, $msg);
        if(!$validate->check($params)){
            //失败
            $error_msg = $validate->getError();
            $this->error($error_msg);
        }
        //控制器验证
        $res = $this->validate($params, $rule, $msg);
        if($res !== true){
            //失败  返回值就是错误信息
            $this->error($res);
        }
        //注意问题
        //1.静态调用  和 实例化模型再调用，不要写混了
        //2.完整的命名空间，app前面需要加上 反斜杠
        //3.富文本编辑器不显示（layout中多了三个js，是只有首页才用的）
        //4.富文本编辑器 输入的内容，数据表存的 &gt;&lt; 实体字符，在页面展示的是<p>
        //5. 熟悉表单验证的用法

    }

    public function xiugai()
    {
        //save方法
        //先查询再修改
        $goods = \app\admin\model\Goods::find(32);
        $goods->goods_price = '123.00';
        $goods->goods_number = 321;
        $res = $goods->allowField(true)->save();
//        dump($res);
        //（推荐）直接静态调用模型的update方法 （修改的数据，修改条件，过滤非数据表字段）
        //\app\admin\model\Goods::update(['goods_price'=>'123.00', 'goods_number'=>321, 'id'=>33], [], true);
        //\app\admin\model\Goods::update(['goods_price'=>'123.00', 'goods_number'=>321, 'id'=>33], ['id'=>33], true);
        $res2 = \app\admin\model\Goods::update(['goods_price'=>'123.00', 'goods_number'=>321], ['id'=>33], true);
//        dump($res2);die;

        //底层Db的update方法（通过where方法后使用update方法）
        //单个修改
        $res3 = \app\admin\model\Goods::where('id', 34)->update(['goods_price'=>'123.00', 'goods_number'=>321]);
        dump($res3);
        //批量修改
        $res4 = \app\admin\model\Goods::where('id', '>', 144)->update(['goods_price'=>'123.00', 'goods_number'=>321]);
        dump($res4);

        //区别：模型的update方法 和 底层的update方法
        //1.返回值不同：模型的返回模型对象， 底层的返回修改条数
        //2.包含的功能不同：模型的update 有过滤非数据表字段的功能，底层的没有
    }

    public function shanchu()
    {
        //查询并删除（调用模型的delete方法）
        /*$goods = \app\admin\model\Goods::find(147);
        if(empty($goods)){
            echo '数据已经不存在了';die;
        }
        $res = $goods->d
        dump($res);*/

        //通过where指定条件 再调用Query对象的delete方法
//        $res = \app\admin\model\Goods::where('id', 145)->delete();
//        dump($res);

        //静态destroy方法
        $res = \app\admin\model\Goods::destroy(144);
        dump($res);
        $res = \app\admin\model\Goods::destroy('142,143');
        dump($res);
        $res = \app\admin\model\Goods::destroy([140,141]);
        dump($res);
        $res = \app\admin\model\Goods::destroy(['goods_number'=>222]);
        dump($res);
    }

    public function test_session()
    {
        //设置
        session('username', 'admin');
        //读取
        dump( session('username') );
        //判断
        dump( session('?username') );
        //删除单个
        session('username', null);
        dump( session('username') );
        //删除所有
        session(null);

        //数组用法  点语法
        session('user', ['id' => 1, 'username' => 'admin']);
        dump(session('user.username'));
        session('user.email', 'admin@qq.com');
        dump(session('user'));
        session('user.email', null);
        dump(session('user'));

        //cookie  设置有效期
        cookie('name', 'zhangsan', 3600);
    }
}
