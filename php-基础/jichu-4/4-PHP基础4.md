---
typora-copy-images-to: images
---

## 1.1  今日目标

1. 掌握静态变量的工作原理；
2. 了解全局变量、局部变量和超全局变量的区别；
3. 了解两种错误处理机制；
4. 掌握错误相关信息的三种配置方式；
5. 掌握自定义函数实现错误处理；
6. 理解四种包含文件方式的区别；
7. 理解文件包含的运行原理；
8. 掌握文件包含的不同应用场景：



## 1.2  作用域

#### 1.2.1 变量作用域

1、全局变量：在函数外面

2、局部变量：在函数里面，默认情况下，函数内部是不会去访问函数外部的变量

3、超全局变量：可以在函数内部和函数外部访问

 ![1559615291159](images/1559615291159.png)

```PHP
<?php
$num=10;   
function fun() {
	echo $num;     //Notice: Undefined variable: num  
}
fun();
//函数内部默认不能访问函数外部的值
---------------------
<?php
$_POST['num']=10;   //将值付给超全局变量
function fun() {
	echo $_POST['num'];    //获取超全局的值   10
}
fun();
----------------------------
<?php
function fun() {
	$_GET['num']=10;  //将值付给超全局变量
}
fun();
echo $_GET['num'];  //打印超全局变量的值  10
```



在函数内部访问全局变量

```php
<?php
$num=10;  //全局变量
function fun() {
	echo $GLOBALS['num'];	//输出全局的$num
}
fun();
```

练习：如下代码输出什么

```php
<?php
function fun() {
	$GLOBALS['num']=10;  //将值付给全局的$num
}
fun();
echo $num;   //10
```



global关键字

```php
<?php
$num=10;
function fun() {
	global $num;   //将全局变量的$num的地址引入到函数内部  相当于$num=&GLOBALS['num']
	echo $num;	//10
	$num=100;
}
fun();
echo '<br>';
echo $num;    //100
-----------------------------------
<?php
$num=10;
function fun() {
	global $num;
	unset($num);  //销毁的是引用，不是具体的值
}
fun();
echo $num;    //10  
```

小结：

1、$GLOBALS保存的是全局变量的所有的值

```php
<?php
$a=10;
$b=20;
function show() {
	echo '<pre>';
	var_dump($GLOBALS);   //是一个数组，保存的是全局变量的所有的值
}
show();
```

2、global用于创建一个全局变量的引用



注意：常量没有作用域的概念

```php
<?php
/*
define('PI',3.14);
function fun() {
	echo PI;   //3.14
}
fun();
echo '<br>';
*/
-------------------------------------
function fun() {
	define('PI',3.14);
}
fun();
echo PI;   //3.14
```



#### 1.2.2  静态变量（static）

静态变量一般指的是静态局部变量。

静态变量只初始化一次

```php
<?php
function fun() {
	$num=10;	//普通变量每调用一次初始化一次，调用完毕销毁
	$num++;
	echo $num,'<br>';
}
fun();	//11
fun();	//11
--------------------------------
<?php
function fun() {
	static $num=10;	//静态变量只初始化一次，调用完毕吧不销毁，第二次调用的时候就不再初始化
	$num++;
	echo $num,'<br>';
}
fun();	//11
fun();	//12
```

常量和静态变量的区别

1、常量和静态变量都是初始化一次

2、常量不能改变值，静态变量可以改变值

3、常量没有作用域，静态变量有作用域

```php
<?php
function fun1() {
	define('num',10);
}
function fun2() {
	echo num;   //10
}
fun1();
fun2();
------------------------------------------------------------
<?php
function fun1() {
	static $num=10;
}
function fun2() {
	echo $num;  //Notice: Undefined variable: num 因为静态变量是有作用域的
}
fun1();
fun2();
```



#### 1.2.3  匿名函数use()

默认情况下，函数内部不能访问函数外部的变量，但在匿名函数中，可以通过use将外部变量引入匿名函数中

```php
<?php
$num=10;
$fun=function() use($num) {  //将$num引入到匿名函数中
	echo $num;	
};
$fun();   //10
```



思考：如何在函数内部访问函数外部变量

1、使用超全局变量

2、$GLOBALS

3、global

4、use将函数外部变量引入到匿名函数内部



练习：如果代码输出什么

```php
<?php
$num=10;
function test() {
	$num=20;
	$fun=function() use($num) {   //只能引入一层
		echo $num;
	};
	$fun();
}
test();    //20
```

多学一招：use可以引入值，也可以引入地址

```php
<?php
$num=10;
$fun=function()use(&$num){   //use可以传地址
	$num=100;
};
$fun();
echo $num;  //100
```



## 1.3  递归

函数内部自己调用自己

递归有两个元素，一个是递归点（从什么地方递归），第二递归出口

例题1：输出9 8 7 6 .....

```php
<?php
function printer($num) {
	echo $num,'&nbsp;';
	if($num==1)	//递归出口
		return;
	printer($num-1);	//递归点
}
printer(9);	//9 8 7 6 5 4 3 2 1 
```



例题2：从1加到100

```php
function cal($num) {
	if($num==1)
		return 1;
	return $num+cal($num-1);
}
echo cal(100);
//分析
/**
第$i次执行			结果
cal(100)			100+cal(99)
=					100+99+cal(98)
=					100+99+98+cal(97)
=					100+99+98+++++cal(1)
=					100+99+98++++1
*/
```



例题：打印前10个斐波那契数列

````php
//打印第5个斐波那契数
function fbnq($n) {
	if($n==1 || $n==2)
		return 1;
	return fbnq($n-1)+fbnq($n-2); //第n个斐波那契数等于前两个数之和
}
echo fbnq(5),'<br>';
/**
*分析：
fbnq(5)	=fbnq(4)+fbnq(3)
		=fbnq(3)*2+fbnq(2)
		=(fbnq(2)+fbnq(1))*2+fbnq(2)
		=(1+1)*2+1
		=5
*/
//打印前10个斐波那契数
for($i=1;$i<=10;$i++)
	echo fbnq($i),'&nbsp;';   //1 1 2 3 5 8 13 21 34 55 
````

小结：递归尽量少用，因为递归需要用到现场保护，现场保护是需要消耗资源的



## 1.4  包含文件

场景：

 ![1559630150559](images/1559630150559.png)

#### 1.4.1  包含文件的方式

1、require：包含多次

2、include：包含多次

3、require_once： 包含一次

4、include_once： 包含一次



 ![1559630561486](images/1559630561486.png)

 ![1559630588666](images/1559630588666.png)

小结：

1、require遇到错误抛出error类别的错误，停止执行

2、include遇到错误抛出warning类型的错误，继续执行

3、require_once、include_once只能包含一次

4、HTML类型的包含页面中存在PHP代码，如果包含到PHP中是可以被执行的

5、包含文件相当于把包含文件中的代码拷贝到主文件中执行，魔术常量除外，魔术常量获取的是所在文件的信息。

6、包含在编译时不执行、运行时加载到内存、独立编译包含文件



#### 1.4.2  包含文件的路径

```
./		当前目录
../		上一级目录
```

区分如下包含：

```php
require './head.html';   //在当前目录下查找
require 'head.html';	  //受include_path配置影响
```

 ![1559631648089](images/1559631648089.png)

include_path的使用场景：

如果包含文件的目录结构比较复杂，比如：在c:\aa\bb\cc\dd中有多个文件需要包含，可以将包含的路径设置成include_path，这样包含就只要写文件名就可以了

```php
<?php
set_include_path('c:\aa\bb\cc\dd');  //设置include_path
require 'head1.html';	  //受include_path配置影响
require 'head2.html';
```

include_path可以设置多个，路径之间用分号隔开

```php
set_include_path('c:\aa\bb\cc\dd;d:\\');
```

多学一招：

```,
正斜（/） web中目录分隔用正斜  http://www.sina.com/index.php
反斜（\）物理地址的分隔用反斜，（windows中物理地址正斜和反斜都可以）  c:\web1\aa
```



## 1.5  错误处理

#### 1.5.1  错误的级别

1. notice：提示
2. warning：警告
3. error：致命错误

notice和warning报错后继续执行，error报错后停止执行



#### 1.5.2  错误的提示方法

方法一：显示在浏览器上

方法二：记录在日志中



#### 1.5.3  与错误处理有关的配置

在php.ini中

```
1. error_reporting = E_ALL：报告所有的错误
2. display_errors = On：将错误显示在浏览器上
3. log_errors = On：将错误记录在日志中
4. error_log=’地址’：错误日志保存的地址
```

在项目开发过程中有两个模式，开发模式，运行模式

```
开发模式：错误显示在浏览器上，不要记录在日志中
运行模式：错误不显示在浏览器上，记录是日志中
```

例题

```php
<?php
$debug=false;		//true:开发模式  false：运行模式
ini_set('error_reporting',E_ALL);	//所有的错误有报告
if($debug){
	ini_set('display_errors','on');	//错误显示是浏览器上
	ini_set('log_errors','off');	//错误不显示在日志中
}else{
	ini_set('display_errors','off');
	ini_set('log_errors','on');
	ini_set('error_log','./err.log');	//错误日志保存的地址
}

//测试
echo $num;
```

提示：ini_set()设置PHP的配置参数



#### 1.5.4  自定义错误处理(了解)

通过trigger_error产生一个用户级别的 error/warning/notice 信息

```php
<?php
$age=100;
if($age>80){
	//trigger_error('年龄不能超过80岁');  //默认触发了notice级别的错误
	//trigger_error('年龄不能超过80岁',E_USER_NOTICE);	//触发notice级别的错误
	//trigger_error('年龄不能超过80岁',E_USER_WARNING);
	trigger_error('年龄不能超过80岁',E_USER_ERROR);   //错误用户error错误
}
```

注意：用户级别的错误的常量名中一定要带有USER。



定义错误处理函数

```php
function error() {
	echo '这是自定义错误处理';
}
set_error_handler('error');	//注册错误处理函数,只要有错误就会自动的调用错误处理函数
echo $num;
```

运行结果

 ![1559635406021](images/1559635406021.png)



处理处理函数还可以带有参数

```php
/**
*自定义错误处理函数
*@param $errno int 错误类别
*@param $errstr string 错误信息
*@param $errfile string 文件地址
*@param $errline int 错误行号
*/
function error($errno,$errstr,$errfile,$errline) {
	switch($errno){
		case E_NOTICE:
		case E_USER_NOTICE:
			echo '记录在日志中，上班后在处理<br>';
			break;
		case E_WARNING:
		case E_USER_WARNING:	
			echo '给管理员发邮件<br>';
			break;
		case E_ERROR:
		case E_USER_ERROR:
			echo '给管理员打电话<br>';
			break;
	}
	echo "错误信息：{$errstr}<br>";
	echo "错误文件：{$errfile}<br>";
	echo "错误行号：{$errline}<br>";
}
set_error_handler('error');
echo $num;

//运行结果
记录在日志中，上班后在处理
错误信息：Undefined variable: num
错误文件：F:\wamp\www\4-demo.php
错误行号：50
```



## 1.6  文件编程

#### 1.6.1  文件夹操作

**1 、**创建文件夹【`mkdir(路径，权限，是否递归创建)`】

```
make:创建
directory：目录，文件夹
```

例题

```php
<?php
//1、创建目录
//mkdir('./aa');	//创建aa文件夹
//mkdir('./aa/bb');	//在aa目录下创建bb(aa目录必须存在)
mkdir('./aa/bb/cc/dd',0777,true);	//递归创建
```

小结：

1、0777表示是文件夹的权限，在Linux中会详细讲解

2、true表示递归创建，默认是false



**2、**删除文件夹【rmdir()】

```php
//remove:移除

rmdir('./aa/bb/cc/dd');	//删除dd文件夹
```

提醒：

```
1、删除的文件夹必须是空的
2、PHP基于安全考虑，没有提供递归删除。
```



**3、**重命名文件夹【rename(旧名字，新名字)】

```php
rename('./aa','./aaa');	//将aa改为aaa
```



**4、**是否是文件夹【is_dir()】

```php
echo is_dir('./aaa')?'是文件夹':'不是文件夹';
```



**5、**打开文件夹、读取文件夹、关闭文件夹

```php
$folder=opendir('./');	//打开目录
//var_dump($folder);		//resource(3) of type (stream) 
while($f=readdir($folder)){	//读取文件夹
	if($f=='.' || $f=='..')
		continue;
	echo iconv('gbk','utf-8',$f),'<br>';  //将gbk转成utf-8
}
closedir($folder);		//关闭文件夹
```

小结：

```
1、opendir()返回资源类型
2、每个文件夹中都有.和..
3、iconv()用来做字符编码转换
```



## 1.7  作业讲解

1、 通过for循环将数组中值求和、求平均值

```php+HTML
<?php
//1、求数组的和、平均值
$num=[1,20,53,23,14,12,15];
$sum=0;
for($i=0,$n=count($num);$i<$n;$i++){
	$sum+=$num[$i];
}
echo '和是：'.$sum,'<br>';		//和是：138
echo '平均值：'.number_format($sum/count($num),1);   //精确到小数点后面1位  平均值：19.7
echo '<hr>';
```

2、数组翻转

```php
$stu=['tom','berry','ketty','rose','jake'];
for($i=0,$j=count($stu)-1;$i<$j;$i++,$j--){
	[$stu[$i],$stu[$j]]=[$stu[$j],$stu[$i]];   //元素交换
}
print_r($stu); //Array ( [0] => jake [1] => rose [2] => ketty [3] => berry [4] => tom ) 
```

3、遍历二维数组

```php
$stu=[
	[1,2,3,4],
	[10,20,30,40]
];
for($i=0;$i<count($stu);$i++){	//循环第一列
	for($j=0;$j<count($stu[$i]);$j++){   //循环第二列
		echo $stu[$i][$j],'&nbsp;';
	}
	echo '<br>';
}
//运行结果
1 2 3 4 
10 20 30 40 
```

4、 循环输出1-100，其中3的倍数输出A，5的倍数输出B，15输出C。

```php
for($i=1; $i<=100; $i++) {
	if($i%15==0)   //先写%15,，因为可以%15的值一定可以%3和%5
		echo 'C';
	elseif($i%3==0)
		echo 'A';
	elseif($i%5==0)
		echo 'B';
	else
		echo $i;

	echo '&nbsp;';
}
```

5、  打印水仙花数  

```php
for($i=100;$i<=999;$i++){
	$a=(int)($i/100);		//百位数
	$b=(int)(($i%100)/10);	//十位数
	$c=$i%10;				//个位数
	if($i==pow($a,3)+pow($b,3)+pow($c,3))
		echo $i,'<br>';
}
//pow($a,3)  表示$a的三次方
//运行结果
153
370
371
407
```

6、  打印100以内的斐波那契数（迭代法）1 1 2 3 5 8 13 21 .....

```php
$num1=1;   //第一个数
$num2=1;    //第二个数
echo $num1,'&nbsp;',$num2,'&nbsp;';
while(true){
	$num3=$num1+$num2;   //第三个数是前面两个数的和
	if($num3>100)		 //超过100就终止循环
		break;
	echo $num3,'&nbsp;';
	$num1=$num2;		//将$num2移给$num1
	$num2=$num3;		//将$num3移给$num2
}
//1 1 2 3 5 8 13 21 34 55 89 
```



## 1.8  作业

1、一只猴子看守一堆桃子，第一天吃了一半后又多吃了1个，第二天一样，到第十天的时候就剩下一个桃子，请问原来有几个桃子？

2、递归遍历整个文件夹