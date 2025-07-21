<?php
//1、IP和整形互换
/*
$ip='153.152.56.123';
echo ip2long($ip),'<br>';
echo long2ip(-1718077317);
*/

//2、单引号添加转义字符
/*
echo addslashes("aa'bb'"),'<br>';	//aa\'bb\'
*/

//3、字符串替换
//echo str_replace("'",'',"aa'bb'");	//aabb


//4、获取客户端地址
echo $_SERVER['REMOTE_ADDR'];
