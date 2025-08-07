<?php
/*// 使用TCP服务器实现RPC微服务调用
// socket当作成一个网络中的文件
$socket = stream_socket_client('tcp://140.143.30.117:6060',$errno,$errstr,10);
// 发送数据  写文件的过程
fwrite($socket,"我是一个php");
// 接受
$header = fread($socket,9000);
// 关闭
fclose($socket);

// socket当作成一个网络中的文件
$socket = stream_socket_client('tcp://140.143.30.117:6061',$errno,$errstr,10);
// 发送数据  写文件的过程
fwrite($socket,"我是一个php");
// 接受
$body = fread($socket,9000);
// 关闭
fclose($socket);


// socket当作成一个网络中的文件
$socket = stream_socket_client('tcp://140.143.30.117:6062',$errno,$errstr,10);
// 发送数据  写文件的过程
fwrite($socket,"我是一个php");
// 接受
$footer = fread($socket,9000);
// 关闭
fclose($socket);*/
/*
echo $header;
echo $body;
echo $footer;*/

// socket当作成一个网络中的文件
$socket = stream_socket_client('tcp://140.143.30.117:6061',$errno,$errstr,10);
// 发送数据  写文件的过程
fwrite($socket,$_SERVER['PATH_INFO']); // 向order微服务发送当前页面路径的路径信息PATH_INFO 就是：/index.php 之后、? 之前的路径部分 
// 接受
$body = fread($socket,9000);
// 关闭
fclose($socket);



echo $body;