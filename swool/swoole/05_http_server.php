<?php
// 编写http服务
$http = new \Swoole\Http\Server('0.0.0.0',6060);

// 配置 可选
$http->set([
    // 启动时的worker进程数量
    'worker_num' => 1,
    # 静态资源配置选项
    // 虚拟目录指向的位置  只针对静态的资源 html htm css js 图片 视频，（php文件不处理）
    'document_root' => '/wwwdata/web', // v4.4.0以下版本, 此处必须为绝对路径
    'enable_static_handler' => true, // 启动静态资源服务器

]);
// 事件
$http->on('request',function (swoole_http_request $request, swoole_http_response $response){
    // 请求的文件路径
    $req_file = $request->server["request_uri"];
    // 指定真实文件路径
    $filepath = __DIR__.'/web/'.$req_file;
    // 状态码
    $status = 404;
    // 返回数据
    // JSON_UNESCAPED_UNICODE php5.4提供，解决中文乱码问题  256
    $html =  json_encode(['status'=>1000,'msg'=>'没有数据'],JSON_UNESCAPED_UNICODE);

    // 判断文件是否存在
    if(file_exists($filepath)){
        // 封装get POST，给下面执行php文件时的超全局getpost变量赋值
        $_GET = $request->get;
        $_POST = $request->post;
        $_FILES = $request->files;

        // 文件一定存在
        $status = 200;
        // 开启缓冲区-----，必须得include包含一下，需要执行php执行结果然后存到缓存区里，然后把php解析结果返到浏览器
                // php是在服务端执行的，如果不加缓冲区，直接在代码里include，只会在终端中输出echo结果 
                // 需要把echo结果拿到返给浏览器，利用缓冲区函数
        ob_start();
        include $filepath;
        // 读取缓冲区数据
        $html = ob_get_contents();
        // 清空缓冲区
        ob_clean();
    }
    // 状态码修改为404
    $response->status($status);
    $response->header('Content-Type','application/json;charset=utf-8');
    // 响应的内容
    $response->end($html);
});

// 启动服务
$http->start();