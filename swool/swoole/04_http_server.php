<?php
// 编写http服务
$http = new \Swoole\Http\Server('0.0.0.0',6060);

// 配置 可选
$http->set([
    // 启动时的worker进程数量
    'worker_num' => 1,
    # 静态资源配置选项 
    // 虚拟目录指向的位置  只针对静态的资源如： html htm css js 图片 视频
    'document_root' => '/wwwdata/web', // v4.4.0以下版本, 此处必须为绝对路径
    'enable_static_handler' => true, // 启动静态资源服务器

]);

// 事件
$http->on('request',function (swoole_http_request $request, swoole_http_response $response){
    // 状态码修改为404
    $response->status(404);
    // 响应头，告诉浏览是utf-8,因为浏览器默认是采取操作系统的编码一般是gbk编码，而php默认是utf-8编码，所以不加这个响应类型头会出现中文乱码
    $response->header('Content-Type','text/html;charset=utf-8');
    // 响应的内容
    $response->end('你好世界');
});

// 启动服务
$http->start();