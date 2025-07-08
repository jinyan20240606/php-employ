---
typora-copy-images-to: images
---

## 1.1  今日目标

1. 理解循环结构的应用场景；
2. 掌握while循环实现迭代原理；
3. 掌握for循环实现迭代原理；
4. 掌握foreach循环实现迭代原理；
5. 理解二维数组的遍历原理；
6. 理解循环控制的概念；
7. 掌握循环控制中continue和break的效果和区别；
8. 理解函数的作用；
9. 掌握自定义函数的定义；
10. 理解形参的工作原理以及作用；
11. 了解参数默认值的工作原理；
12. 了解强类型形参的作用；
13. 理解返回值return在函数中的实际含义；
14. 了解强类型返回值的作用；
15. 掌握函数的调用；
16. 掌握可变函数的使用方式；
17. 了解匿名函数的使用方式；
18. 知道如何在API中查找所需使用的系统函数；



## 1.2   循环

#### 1.2.1   for

```php
for(初始值;条件;增量){
	//循环体
}
```

注意：循环中千万不能出现死循环

思考：如下代码输出什么

例题一：

```php
<?php
for($i=1;$i<=10;$i+=2){
	echo "{$i}:锄禾日当午<br>";
}
/*
1:锄禾日当午
3:锄禾日当午
5:锄禾日当午
7:锄禾日当午
9:锄禾日当午
*/
```

例题二：

```php
<?php
for($i=1;$i<=10;){
	
}
//死循环，$i永远等于1，1永远小于10，条件永远为true
```

例题三

```php
<?php
for($i=1;;$i++){
}
//死循环，只要没有条件都是死循环
```

例题四

```php
<?php
for(;;){
}
//这是一个经典的死循环
```

#### 1.2.3  思考题

1、如下代码循环了几次？

```php
for($i=1;$i!=5;$i++){
    
}
//循环了4次
```

2、在循环N次循环体中，初始值执行了几次？条件执行了几次？增量执行了几次？

```
初始值执行了1次
条件执行了N+1次
增量执行了N次
```

3、在循环执行完毕后，$i的值是存在的。

```php
<?php
for($i=1;$i<=3;$i++){
}
echo $i;		//4
```



#### 1.2.4 while、do-while

语法

```php
while(条件){
}
-------------------------
do{
    
}while(条件)
```

小结：

1、for、while、do-while可以相互替换

2、如果明确知道循环多少次首先for循环，如要要循环到条件不成立为止选while或do-while

3、先判断再执行选while，先执行再判断选do-while

4、while循环条件不成立就不执行，do-while至少执行一次



#### 1.2.5  例题

1、使用三种循环实现从1加到100

```php
<?php
//1、for循环实现
$sum=0;
for($i=1;$i<=100;$i++){
	$sum+=$i;	//$sum=$sum+$i;
}
echo $sum;

//分析
/**
*
$i			$sum
1			1
2			1+2
3			1+2+3	
4			1+2+3+4
...
100			1+2+3+++100
*/
-------------------------------------------------
//2、while循环
$i=1;
$sum=0;		//保存和
while($i<=100){
	//方法一
	/*
	$sum+=$i;
	$i++;
	*/

	//方法二
	$sum+=$i++;
}
echo $sum;
--------------------------------------------------
    
//3、do-while循环
$i=1;
$sum=0;
do{
	$sum+=$i;
	$i++;
}while($i<=100);
echo $sum,'<br>';	//5050

//可以有如下更改
$i=1;
$sum=0;
do{
	$sum+=$i++;      //++后置
}while($i<=100);
echo $sum,'<br>';	//5050

//可以做如下更改
$i=1;
$sum=0;
do{
	$sum+=$i;
}while(++$i<=100);    //++前置
echo $sum,'<br>';		//5050
```

小结：

1、for、while、do-while可以相互替换

2、结合++前置和++后置考虑逻辑



#### 1.2.6  多语句表达式

初始值、增量可以由多条语句组成

例题：数字分解

```php
<?php
for($i=1,$j=9;$i<=$j;$i++,$j--){
	echo "10可以分成{$i}和{$j}<br>";
}
//运行结果
/*
10可以分成1和9
10可以分成2和8
10可以分成3和7
10可以分成4和6
10可以分成5和5
*/
```

小结：初始值、增量可以写多个表达式，但是条件一般只写一个，如果条件写多个，只是最后一个条件起作用



#### 1.2.7  双重循环

1、打印阶梯数字

```php
<?php
for($i=1;$i<=9;$i++){	//循环行
	for($j=1;$j<=$i;$j++){	//循环列
		echo $j,'&nbsp;';
	}
	echo '<br>';
}
//运行结果
1 
1 2 
1 2 3 
1 2 3 4 
1 2 3 4 5 
1 2 3 4 5 6 
1 2 3 4 5 6 7 
1 2 3 4 5 6 7 8 
1 2 3 4 5 6 7 8 9 
```

2、打印九九乘法表

```php+HTML
<style type="text/css">
	table{
		width:980px;
	}
	table,td{
		border:solid 1px #0000FF;
		border-collapse:collapse;
	}
	td{
		height:40px;	
	}
</style>

<table>
<?php
for($i=1;$i<=9;$i++){	//行
	echo '<tr>';
	for($j=1;$j<=$i;$j++){	//列
		echo "<td>{$j}*{$i}=".($j*$i).'</td>';
	}
	echo '</tr>';
}
?>
</table>
```

运行结果

 ![1559532760670](images/1559532760670.png)

小结：规则：当前列*当前行



#### 1.28  foreach

foreach循环是用来遍历数组

语法

```php
//语法一
foreach(数组 as 值){
}
//语法二
foreach(数组 as 键=>值){
}
```

例题

```php
<?php
$stu=['tom','berry','ketty'];
foreach($stu as $v){
	echo $v,'<br>';
}
/**
tom
berry
ketty
*/
echo '<hr>';
-----------------------------------------------------------
foreach($stu as $k=>$v){
	echo "{$k}:{$v}<br>";
}
/**
0:tom
1:berry
2:ketty
*/
```



## 1.3  跳转语句

#### 1.3.1  语法

break：中断循环

continue：中断当前循环，进入下一个循环

例题：

```php
<?php
for($i=1; $i<=10; $i++) {
	if($i==5)
		break;  //中断循环
	echo "{$i}：锄禾日当午<br>";
}
//结果
1：锄禾日当午
2：锄禾日当午
3：锄禾日当午
4：锄禾日当午
--------------------------------------------------
<?php
for($i=1; $i<=10; $i++) {
	if($i==5)
		continue;  //跳出5，进入6循环
	echo "{$i}：锄禾日当午<br>";
}
1：锄禾日当午
2：锄禾日当午
3：锄禾日当午
4：锄禾日当午    //注意，没有打印第5句
6：锄禾日当午
7：锄禾日当午
8：锄禾日当午
9：锄禾日当午
10：锄禾日当午    
```



#### 1.3.2 中断多重循环

break和continue默认中断、跳出1重循环，如果调中断、跳出多重循环，在后面加一个数字。

```php
<?php
for($i=1; $i<=10; $i++) {
	for($j=1;$j<=$i;$j++){
		echo $j.'&nbsp;';
		if($j==5){
			break 2;   //中断2重循环
		}
	}	
	echo '<br>';
}
//运行结果
1 
1 2 
1 2 3 
1 2 3 4 
1 2 3 4 5 
```

练习

```php
<?php
for($i=1; $i<=10; $i++) {
	switch($i){
		case 5:
			break 2;
	}
	echo $i,'<br>';
}
//结果
1
2
3
4
```

小结：switch的本质是循环了一次的循环



## 1.4 替代语法

php中除了do-while以外，其他的语法结构都有替代语法

规则：左大括号变冒号,右大括号变endXXX

```PHP
//if的替代语法
    if():

    elseif():

    else:

    endif;
//switch替代语法
    switch():

    endswitch;
//for
    for():

    endfor;
//while
    while():

    endwhile;
//foreach
    foreach():

    endforeach;
```

例题：在混编的时候用替代语法

```php+HTML
<body>
<?php
for($i=1;$i<=10;$i++):
	if($i%2==0):
?>
	<?php echo $i;?>:锄禾日当午<br>
<?php
	endif;
endfor;
?>
</body>
//运行结果
2:锄禾日当午
4:锄禾日当午
6:锄禾日当午
8:锄禾日当午
10:锄禾日当午
```

小结：可以通过替代语法证明else if之间如果有空格是嵌套if语句。

```php
<?php
$score=80;
if($score>=90):
	echo 'A';
elseif($score>=80):    //elseif之间没有空格，如果有空格是嵌套if语句
	echo 'B';
else:
	echo 'C';
endif;
----------------------------------------
<?php
$score=80;
if($score>=90):
	echo 'A';
else:
	if($score>=80):
		echo 'B';
	
	else:
		echo 'C';
	endif;
endif;
```



## 1.5  函数

1、函数就是一段代码块

2、函数可以实现模块化编程

#### 1.5.1  函数定义

```php
function 函数名(参数1，参数2，...){
    //函数体
}
```

通过函数名()调用函数

```php
<?php
//定义函数
function show() {
	echo '锄禾日当午<br>';
}
//调用
show();		//锄禾日当午
SHOW();		//锄禾日当午  函数名不区分大小写
```

小结：

1、变量名区分大小写

2、关键字、函数名不区分大小写



#### 1.5.2  可变函数

将函数名存储到变量中

```php
<?php
function show($args) {
	echo $args,'<br>';
}
$str='show';	//将函数名保存到变量中
$str('锄禾日当午');
```

例题：随机调用函数

```php
<?php
 //中文显示
function showChinese() {
	echo '锄禾日当午<br>';
}
//英文显示
function showEnglish() {
	echo 'chu he re dang wu<br>';
}
//测试
$fun=rand(1,10)%2?'showChinese':'showEnglish';   //可变变量
$fun();
```



#### 1.5.3 匿名函数

匿名函数就是没有名字的函数

```php
<?php
//匿名函数
$fun=function(){
	echo '锄禾日当午<br>';
};
//匿名函数调用
$fun();
```



#### 1.5.4  参数传递

函数的参数有形式参数和实际参数

形式参数是定义函数时候的参数，只起形式的作用，没有具体的值

实际参数的调用函数时候的参数，有具体的值

```php
<?php
function fun($num1,$num2) {
	echo $num1+$num2;
}
fun(10,20);		//30
```



默认情况下，参数的传递是值传递

```php
<?php
$num=10;
function fun($args) {
	$args=100;
}
fun($num);
echo $num;		//10
```

地址传递

```php
<?php
$num=10;
//地址传递
function fun(&$args) {   //&符表示取地址
	$args=100;
}
fun($num);
echo $num;		//100
```

小结

1、函数的参数默认是值传递

2、如果要传递地址，在参数前面加&

3、如果是地址传递，不能直接写值

```php
function fun(&$args) {
	$args=100;
}
fun(10);   //Fatal error: Only variables can be passed by reference (只有变量才能传递引用)
```



#### 1.5.5  参数默认值

1、在定义函数的时候给形参赋值就是参数的默认值

```php
<?php
//参数的默认值
function fun($name,$add='地址不详') {
	echo '姓名：'.$name,'<br>';
	echo '地址：'.$add,'<hr>';
}
//测试
fun('tom','北京');
fun('berry');
```

 ![1559548982814](images/1559548982814.png)



2、默认值必须是值，不能用变量代替

```php
<?php
$str='地址不详'
function fun($name,$add=$str) {   //错误，默认值可以使用变量
	echo '姓名：'.$name,'<br>';
	echo '地址：'.$add,'<hr>';
}
```



3、默认值可以使用常量

```php
<?php
define('ADD','地址不详');
function fun($name,$add=ADD) {    //默认值可以使用常量
	echo '姓名：'.$name,'<br>';
	echo '地址：'.$add,'<hr>';
}
//测试
fun('berry');
```



4、有默认值的写在后面，没有默认值的写在前面

```php
<?php
//没有默认值的写在前面，有默认值写在后面
function fun($name,$age='未知',$add='地址不详') {
	echo "姓名：{$name}<br>";
	echo "年龄：{$age}<br>";
	echo "地址：{$add}<br>";
}
fun('tom');
//运行结果
姓名：tom
年龄：未知
地址：地址不详
```



#### 1.5.6  参数个数不匹配

```php
<?php
function fun($num1,$num2) {
	echo $num1,'<br>';
	echo $num2,'<br>';
}
 //fun(10);	//实参少于形参（报错）
fun(10,20,30); //实参多于形参，只取前面对应的值
```

获取所有传递的参数

```php
<?php
function fun() {
	//echo func_num_args(),'<br>';	//获取参数的个数
	$args=func_get_args();	//获取参数数组
	print_r($args);
}
fun(10);
fun(10,20);
fun(10,20,30); 
```



#### 1.5.7  参数约束

1、定义变长参数（了解）

```php
<?php
// ...$hobby包含了除了前面两个参数以外的所有参数
function fun($name,$age,...$hobby) {
	echo '姓名：'.$name,'<br>';
	echo '年龄：'.$age,'<br>';
	print_r($hobby);
	echo '<hr>';
}
fun('tom',22);
fun('berry',25,'读书','睡觉');
```

运行结果

 ![1559550261505](images/1559550261505.png)

多学一招：

```php
function fun(...$args) {
	print_r($args);
	echo '<br>';
}
$num=[10,20];
echo '<pre>';
fun(...$num);   //将数组中的参数展开
//运行结果
/*
Array
(
    [0] => 10
    [1] => 20
)
*/
```



2、参数类型约束

```php
//类型约束
function fun(string $name,int $age) {
	echo "姓名：{$name},'<br>'";
	echo "年龄：{$age}<br>";
}
fun('tom',22);
//约束$name是字符串型，$age是整型
```



3、返回值约束

```PHP
function fun(int $num1,int $num2):int {  //必须返回整型
	return $num1+$num2;
}
echo fun(10,20);		//30
```

可以约束：string、int、float、bool、数组

```PHP
//约束返回类型是数组
function fun():array {
}
//约束return后面不能有返回值  必须在7.1以后的版本中才支持
function fun():void {    //void是空的意思
	return;
}
fun();
```



## 1.6  return

#### 1.6.1  终止脚本执行

```php
<?php
echo '锄禾日当午<br>';
return;			//终止脚本执行
echo '汗滴禾下土<br>';	//不执行
```

提醒：return只能中断当前页面，如果有包含文件，只能中断包含文件

例题：

6-demo.php

```php
<?php
echo '锄禾日当午<br>';
require './test.php';    //包含文件
echo '汗滴禾下土<br>';
```

test.php

```php
<?php
echo 'aaa<br>';
return;   //只能中断test.php
echo 'bbb<br>';
```

运行结果

 ![1559552969636](images/1559552969636.png)



如果要完全终止脚本执行，使用exit()、或die()

```php
echo 'aaa<br>';
exit();  //die()
echo 'bbb<br>';
```



#### 1.6.2、返回页面结果

test.php

```php
<?php
return array('name'=>'tom','sex'=>'男');
```

6-demo.php

```php
<?php
$stu=require './test.php';
print_r($stu);  //Array ( [name] => tom [sex] => 男 ) 
```

小结：在项目中引入配置文件就使用这种方法



#### 1.6.3 函数的返回和终止

return在函数中使用作用有二
1、终止函数执行

2、返回值

```php
function fun() {
	echo 'aaa';
	return ;		//终止函数执行
	echo 'bbb';
}
fun();   //aaa
----------------------------------
function fun() {
	return 10;	//返回值
}
echo fun();		//10
```



## 1.7  作业讲解

计算器

```php+HTML
<body>
<?php
$num1='';	//$num1的初始值
$num2='';	//$num2的初始值
$op='';		//操作符
$result='';	//结果
if(!empty($_POST)) {
	$num1=$_POST['num1'];
	$num2=$_POST['num2'];
	$op=$_POST['op'];		//操作符
	switch($op){
		case '+':
			$result=$num1+$num2;
			break;
		case '-':
			$result=$num1-$num2;
			break;
		case '*':
			$result=$num1*$num2;
			break;
		case '/':
			$result=$num1/$num2;
			break;
	}
}
?>
<form method="post" action="">
	<input type="text" name="num1" value='<?php echo $num1?>'>
	<select name="op">
		<option value="+" <?php echo $op=='+'?'selected':''?>>+</option>
		<option value="-" <?php echo $op=='-'?'selected':''?>>-</option>
		<option value="*" <?php echo $op=='*'?'selected':''?>>*</option>
		<option value="/" <?php echo $op=='/'?'selected':''?>>/</option>
	</select>
	<input type="text" name="num2" value='<?php echo $num2?>'>
	<input type="submit" name="button" value="=">
	<input type="text" name="result" value='<?php echo $result?>'>
</form>
</body>
```

运行结果

 ![1559526848995](images/1559526848995.png)



## 1.8  作业

1、 通过for循环将数组中值求和、求平均值

2、数组翻转

3、遍历二维数组

4、 循环输出1-100，其中3的倍数输出A，5的倍数输出B，15输出C。

5、  打印水仙花数  

6、  打印100以内的斐波那契数（迭代法）	1 1 2 3 5 8 13 21 .....

7、 打印星星

 ![1559302397252](images/1559302397252.png)

8、  生成颜色面板

 ![1559553900215](images/1559553900215.png)









