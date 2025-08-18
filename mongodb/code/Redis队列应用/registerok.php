<?php
$redis = new Redis();
$redis->connect('localhost');
$redis->auth('beijing');
//完成注册，插入到mysql数据库

//发送邮件到邮箱，让用户激活
//我们就把发送邮件的操作添加到一个队列里面（异步操作）
$username = $_POST['username'];
$email = $_POST['email'];
//把发送邮件的操作添加到链表里面（队列）
$redis->rpush('email',json_encode(['email'=>$email,'username'=>$username]));
echo 'register success';

?>