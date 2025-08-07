<?php
// 参数1： 监听的网卡 0.0.0.0 监听服务器所有的网卡
// 参数2： 监听的端口号 1-1024系统保留 建议从5000开始  最多的端口号多65535
// 参数3： 是否开启使用多进程 默认就是使用多进程
// 参数4： 协议 tcp udp  默认就是tcp服务
$server = new \Swoole\Server('0.0.0.0', 6060);

// 配置 可选
$server->set([
    // 守护进程
    'daemonize' => 1,
    // 启动时的worker进程数量
    'worker_num' => 1
]);
// 监听的事件
// 接受到客户端消息的事件
// $data 接受到的数据
$server->on('Receive', function (swoole_server $server, int $fd, int $reactor_id, string $data) {
    // 向客户端发送数据
    $server->send($fd,"<header>头部</header>");

});
// 启动
$server->start();

