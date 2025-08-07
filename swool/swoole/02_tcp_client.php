<?php
// tcp客户端
$client = new \Swoole\Client(SWOOLE_SOCK_TCP);

// 连接
// 参数3 超时时间 秒
$client->connect('127.0.0.1',6060,10);

// 发送数据
$client->send('我是一个客户端，我发过去的数据');

// 接受服务器端给过来的数据，设置最多接收9000字节数据
$buffer = $client->recv(9000);

// 关闭
$client->close();


echo $buffer."\n";

