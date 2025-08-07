<?php
// 原生套接字实现tcp服务

// 服务器地址和端口
$host = '0.0.0.0'; // 监听所有网卡
$port = 8080;

// 1. 创建 TCP 套接字并绑定、监听
// STREAM_SERVER_BIND：绑定地址
// STREAM_SERVER_LISTEN：开始监听
$serverSocket = stream_socket_server(
    "tcp://{$host}:{$port}",
    $errorCode,
    $errorMsg,
    STREAM_SERVER_BIND | STREAM_SERVER_LISTEN
);

if (!$serverSocket) {
    die("创建服务器失败：{$errorMsg}（错误码：{$errorCode}）");
}

echo "TCP 服务器启动成功，监听 {$host}:{$port}...\n";

// 外层死循环：持续接收新连接
while (true) {
    // 2. 接收客户端连接（阻塞等待）
    // stream_socket_accept 会返回与客户端通信的新套接字
    $clientSocket = stream_socket_accept($serverSocket, -1); // -1 表示永久阻塞

    if ($clientSocket) {
        // 获取客户端地址
        $clientAddress = stream_socket_get_name($clientSocket, true);
        echo "新连接：{$clientAddress}\n";

        // 内层循环：与当前客户端通信
        while (true) {
            // 3. 接收客户端数据（最多 1024 字节）
            $data = fread($clientSocket, 1024);

            // 客户端断开连接（收到空数据）
            if ($data === false || $data === '') {
                echo "客户端 {$clientAddress} 断开连接\n";
                break;
            }

            // 处理数据（去除换行符，便于显示）
            $data = trim($data);
            echo "收到 {$clientAddress} 的数据：{$data}\n";

            // 4. 向客户端发送响应（回声）
            $response = "服务器已收到：{$data}\n";
            fwrite($clientSocket, $response);

            // 特殊指令：客户端发送 'quit' 则主动断开
            if (strtolower($data) === 'quit') {
                fwrite($clientSocket, "即将断开连接...\n");
                break;
            }
        }

        // 关闭与客户端的连接
        fclose($clientSocket);
    }
}

// 理论上不会执行到这里（外层是死循环）
fclose($serverSocket);
?>