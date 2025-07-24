<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
//定义路由
/*//后台登录页  login
Route::any('login', 'admin/login/login', ['ext' => 'html']);
//后台商品列表
Route::get('goods', 'admin/goods/index', ['ext' => 'html']);
//后台商品新增
Route::get('goods_create', 'admin/goods/create', ['ext' => 'html']);
//后台商品新增-保存
Route::post('goods_save', 'admin/goods/save', ['ext' => 'html']);
//后台商品修改
Route::get('goods_edit/:id', 'admin/goods/edit', ['ext' => 'html'], ['id' => '\d+']);
//后台商品修改-保存
Route::post('goods_update/:id', 'admin/goods/update', ['ext' => 'html'], ['id' => '\d+']);
//Route::rule('goods_update/:id', 'admin/goods/update', 'POST', ['ext' => 'html'], ['id' => '\d+']);
//后台商品详情
//Route::get('goods_read/:id', 'admin/goods/read', ['ext' => 'html'], ['id' => '\d+']);
//Route::rule('goods_read/:id', 'admin/goods/read', 'GET' , ['ext' => 'html'], ['id' => '\d+']);
//后台商品删除
//Route::get('goods_delete/:id', 'admin/goods/delete', ['ext' => 'html'], ['id' => '\d+']);*/

//路由分组
/*Route::group('admin', function(){
    //后台商品详情  goods_read/33.html   变成  goods_read_33.html
//    Route::get('goods_read/:id', 'admin/goods/read', ['ext' => 'html'], ['id' => '\d+']);
    Route::get('goods_read_<id>', 'admin/goods/read', ['ext' => 'html'], ['id' => '\d+']);
    //后台商品删除
    Route::get('goods_delete/:id', 'admin/goods/delete', ['ext' => 'html'], ['id' => '\d+']);
});


//路由分组
Route::group('home', function(){
    //前台登录   www.tpshop.com/home/login.html
    Route::get('login', 'home/login/login', ['ext' => 'html']);
});*/

//参数  子域名 ， 对应的模块
//Route::domain('admin', 'admin');

//Restful 接口路由
Route::resource('news', 'api/news');

//相当于定义了以下七个路由
//Route::get('news', 'api/news/index');
//Route::get('news/create', 'api/news/create');
//Route::post('news', 'api/news/save');
//Route::get('news/:id', 'api/news/read');
//Route::get('news/:id/edit', 'api/news/edit');
//Route::put('news/:id', 'api/news/update');
//Route::delete('news/:id', 'api/news/delete');
