<?php
$redis = new Redis();
$redis->connect('localhost');
$redis->auth('beijing');
function send_email($data){
	print_r($data);//执行发送邮件的代码；
}
//根据链表里面的队列执行发送邮件的操作
while(true){
	//从链表里面，获取元素，如果有就执行，如果没有就停止循环
	$info = $redis->lpop('email');
	if($info==false){
		//链表（队列）里面，没有东西，就停止循环
		continue;
	}
	//队列里面有任务,就执行
	send_email(json_decode($info));
}



?>