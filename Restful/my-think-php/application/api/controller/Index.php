<?php
namespace app\api\controller;

class Index
{
    //将商品添加-保存 功能，改为接口
    //将 $this->error()  $this->success() 改为 return json([])形式即可
    public function index()
    {
        //接收参数
        $params = input();

        // 定义验证规则
        $rule = [
            'goods_name|商品名称' => 'require|token',
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
//            $this->error($validate);
            return json(['code' => 400, 'msg' => $validate]);
        }
        //文件上传
        //$params['goods_logo'] = $this->upload_logo();
        //添加数据到数据表  第二个参数true表示过滤非数据表字段
        \app\admin\model\Goods::create($params, true);
        //页面跳转
        return json(['code' => 200, 'msg' => 'success']);
        //$this->success('操作成功', 'admin/goods/index');
        //$this->error('操作失败');
        //$this->redirect( 'admin/goods/index');
    }

    //模拟 这是一个第三方的接口
    public function testapi()
    {
        //接收数据  id、page
        $params = input();
        //处理数据 ...略
        //返回数据
        return json(['code' => 200, 'msg' => 'success', 'data'=>$params]);
    }

    //模拟 本地方法，发送请求调用第三方的接口
    public function testrequest()
    {
        //接口地址  http://www.tpshop.com/api/index/testapi
        $url = "http://www.tpshop.com/api/index/testapi";
        /*
        // 一、请求方式 get
        //请求参数  id  page
        //$params = ['id' => 100, 'page' => 10];
        $url .= '?id=100&page=10';
        //发送请求
        //$res = curl_request($url, false, [], false);
        $res = curl_request($url);
        dump($res);die;*/

        // 二、请求方式 post
        //请求参数  id  page
        $params = ['id' => 100, 'page' => 10];
        //发送请求
        //$res = curl_request($url, true, $params, false);
        $res = curl_request($url, true, $params);
        //结果的处理
        if(!$res){
            echo '请求错误';die;
        }
        //解析结果  $res = '{"code"=>200,"msg"=>"success", "data"=>{}}';
        $arr = json_decode($res, true);
        dump($arr['data']);
        dump($res);die;
    }

    public function kuaidi()
    {
        //请求地址
        $url = "http://v.juhe.cn/exp/index?com=zto&no=73115984252335&key=ac2dde994cc76d4f15738f7f97af7ca4";
        //请求方式 get
        //请求参数 拼接到url中了
        //发送请求
        $res = curl_request($url);
        //对结果进行处理
        if(!$res){
            echo '请求错误';die;
        }
        //解析数据  json格式字符串
        $arr = json_decode($res, true);
        if($arr['resultcode'] != 200){
            echo $arr['reason'];die;
            echo '查询失败';die;
        }
        //获取物流进度数据
        $list = $arr['result']['list'];
        //dump($list);die;
        echo '时间-------------------进度<br>';
        foreach($list as $v){
            // $v['datetime']  $v['remark']
            echo $v['datetime'], '-----------', $v['remark'], '<br>';
        }
        die;

    }
}
