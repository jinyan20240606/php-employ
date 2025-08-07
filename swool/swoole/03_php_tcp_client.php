<?php

// 原生 php 发起一个tcp
// PHP 原生的函数，用于创建一个 TCP 客户端连接到指定的服务器（IP 和端口）
// 超时时间（秒），表示最多等待 10 秒
// 连接失败时的错误码（整数），如 110 表示超时
// 连接失败时的错误信息（字符串），如 "Connection timed out"

// socket当作成一个网络中的文件(unix中有句话是万物皆文件)
$socket = stream_socket_client('tcp://140.143.30.117:6060',$errno,$errstr,10);

// 发送数据  写文件的过程
fwrite($socket,"我是一个php");

// 接受
$buffer = fread($socket,9000);

// 关闭
fclose($socket);

echo $buffer;





