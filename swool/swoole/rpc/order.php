<?php
// -------- 专门做个Order的服务启动文件 ------

// 参数1： 监听的网卡 0.0.0.0 监听服务器所有的网卡
// 参数2： 监听的端口号 1-1024系统保留 建议从5000开始  最多的端口号多65535
// 参数3： 是否开启使用多进程 默认就是使用多进程
// 参数4： 协议 tcp udp  默认就是tcp服务
$server = new \Swoole\Server('0.0.0.0', 6061);

// 配置 可选
$server->set([
    // 守护进程
    'daemonize' => 0,
    // 启动时的worker进程数量
    'worker_num' => 1
]);
// 监听的事件
// 接受到客户端消息的事件
// $data 接受到的数据
$server->on('Receive', function (swoole_server $server, int $fd, int $reactor_id, string $data) {

    // static 变量在函数第一次调用时初始化，之后保持状态。是函数中的static用法
    static $import = true;
    if ($import) {
        // Order的php项目初始化逻辑------用代码启动的方式，不是用浏览器请求的方式
        define('APP_PATH', '/wwwdata/rpc/Order/application'); //框架目录
        define('RPC_RUN', true);

        $_REQUEST['argv_rpc'] = $data;

        // 加载 ThinkPHP 的入口文件 base.php，启动框架初始化  --------  用代码的方式启动框架，不是用浏览器请求的方式
        $path = '/wwwdata/rpc/Order/thinkphp/base.php'; //base文件所在路径
        include $path;
    }
    $import = false;
    // 每次请求都重新创建 App应用实例，避免上一次请求的状态污染（如请求、响应、容器等）
    // 在 Swoole 中，不能让框架单例长期驻留，必须每次请求重建
    $app = new \think\App();
    // 启动 ThinkPHP 的请求生命周期。框架会根据路由、控制器、方法处理请求
    $ret = $app->run();
    // 向客户端发送数据
    $server->send($fd, $ret);

});
// 启动
$server->start();

