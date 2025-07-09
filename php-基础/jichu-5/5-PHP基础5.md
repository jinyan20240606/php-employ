---
typora-copy-images-to: images
---

## 1.1  今日目标

1. 了解文件编程的作用；
2. 掌握指定目录的文件遍历；
3. 掌握文件内容的读写操作；
4. 掌握表单传值方式GET和POST的区别；
5. 掌握PHP接收表单传递数据的方式；
6. 理解复选框表单的设计思路；
7. 掌握PHP实现文件上传的方案；
8. 掌握PHP单文件上传函数的封装；



## 1.2  文件操作

**1、**将字符串写入文件

```php
<?php
$str="床前明月光，\r\n疑是地上霜。\r\n举头望明月，\r\n低头思故乡。";
file_put_contents('./test.txt',$str);  //将字符串写到文本中
```

小结：

1、 所有的“写”操作都是清空重写

2、在文本中换行是\r\n

```
\r:回车   光标移动到当前行的最前面
\n:换行	将光标下移动一行
按键盘的回车键做了两步，第一步将光标移动到当前行的最前面，第二步下移一行。
```

3、\r\n是特殊字符，必须放在双引号内



**2、**将整个文件读入一个字符串

```php
//方法一：
echo file_get_contents('./test.txt');   //将整个文件读入一个字符串 
//方法二：
readfile('./test.txt');	//读取输出文件内容

//注意：echo file_get_contents()==readfile()
```



**3、**打开文件并操作

```
fopen(地址,模式)	打开文件
模式：
r：读		read
w:写		 write
a:追加	append
```

例题：

```php
//3.1、打开文件写入
/*
$fp=fopen('./test.txt','w');    //打开文件返回文件指针（文件地址）
//var_dump($fp);		//resource(3) of type (stream) 
for($i=1;$i<=10;$i++)
	fputs($fp,'关关雎鸠'."\r\n");	//写一行
fclose($fp);	//关闭文件
*/

//3.2  打开文件读取
/*
$fp=fopen('./test.txt','r');	//打开文件读取
while($line=fgets($fp)){
	echo $line,'<br>';
}
*/

//3.3   打开文件追加
$fp=fopen('./test.txt','a');	//打开文件追加
fputs($fp,'在河之洲');			//在文件末尾追加
```



小结：

1、打开文件，返回文件指针（文件指针就是文件地址），资源类型

2、打开文件写、追加操作，如果文件不存在，就创建新的文件

3、打开文件读操作，文件不存在就报错

4、fputs()写一行，fgets()读一行，fclose()关闭文件

5、追加是在文件的末尾追加



**4、**是否是文件【is_file()】

```php
echo is_file('./test.txt')?'是文件':'不是文件';
```



**5、**判断文件或文件夹是否存在【file_exists()】

```php
echo file_exists('./test.txt')?'文件存在':'文件不存在';
```



**6、**删除文件【unlink】

```php
$path='./test.txt';
if(file_exists($path)){		//文件存在
	if(is_dir($path))		//如果是文件夹用rmdir()删除
		rmdir($path);
	elseif(is_file($Path))	//如果是文件用unlink()删除
		unlink($path);
}else{
	echo '文件夹或文件不存在';
}
```



**7、**二进制读取【fread(文件指针，文件大小)】

文件的存储有两种：字符流和二进制流

二进制流的读取按文件大小来读的。

```php
$path='./face.jpg';
$fp=fopen($path,'r');
header('content-type:image/jpeg');	//告知浏览器下面的代码通过jpg图片方式解析
echo fread($fp,filesize($path));	//二进制读取
```

多学一招：file_get_contents()也可以进行二进制读取

```php
header('content-type:image/jpeg');
echo file_get_contents('./face.jpg');
```

小结：

1、文本流有明确的结束符，二进制流没有明确的结束符，通过文件大小判断文件是否读取完毕

2、file_get_contents()既可以进行字符流读取，也可以进行二进制读取。



## 1.3  表单提交数据的两种方式

#### 1.3.1  两种方式

1、get

2、post

```html
<form method="post" action=""></form>
<form method="get" action=""></form>
```

#### 1.3.2  区别

1、外观上看

​	get提交在地址上可以看到参数

 ![1559791997833](images/1559791997833.png)

​        post提交在地址栏上看不到参数

 ![1559792216632](images/1559792216632.png)

 

2、安全性

​	get不安全

​	post安全



3、提交原理

​	get提交是参数一个一个的提交

​	post提交是所有参数作为一个整体一起提交



4、提交数据大小

​	 get提交一般不超过255个字节

​	post提交的大小取决于服务器

```php
// 在php.ini中，可以配置post提交的大小
post_max_size = 8M
```



5、灵活性

​	get很灵活，只要有页面的跳转就可以传递参数

​	post不灵活，post提交需要有表单的参与

```
1、 html跳转
   <a href="index.php?name=tom&age=20">跳转</a>

2、JS跳转
<script type="text/javascript">
	location.href='index.php?name=tom&age=20';
	location.assign('index.php?name=tom&age=20');
	location.replace('index.php?name=tom&age=20');
</script>

3、PHP跳转
header('location:index.php?name=tom&age=22')
```

小结：

|              | GET                                                   | POST                                                         |
| ------------ | ----------------------------------------------------- | ------------------------------------------------------------ |
| 外观上       | 在地址上看到传递的参数和值                            | 地址栏上看不到数据                                           |
| 提交数据大小 | 提交少量数据，不同的浏览器最大值不一样，IE是255个字符 | 提交大量数据，可以通过更改php.ini配置文件来设置post提交数据的最大值 |
| 安全性       | 低                                                    | 高                                                           |
| 提交原理     | 提交的数据和数据之间在独立的                          | 将提交的数据变成XML格式提交                                  |
| 灵活性       | 很灵活，只要有页面的跳转就可以get传递数据             | 不灵活                                                       |



## 1.4  服务器接受数据的三种方式

通过名字获取名字对应的值

```
$_POST：数组类型，保存的POST提交的值
$_GET：数组类型，保存的GET提交的值
$_REQUEST：数组类型，保存的GET和POST提交的值
```

例题：

HTML页面

```html
<body>
<!--表单提交数据-->
<form method="get" action="./2-demo2.php">
	语文： <input type="text" name="ch"> <br />
	数学： <input type="text" name="math"> <br />
	<input type="submit" name="button" value="提交"> <br><br>
</form>
<!--超链接提交数据-->
<a href="2-demo2.php?ch=77&math=88">跳转</a> <br><br>
<!--js提交数据-->
<input type="button" value="点击" onclick="location.href='2-demo2.php?ch=66&math=55'"> <br><br>

<input type="button" value="点击" onclick="location.assign('2-demo2.php?ch=11&math=22')">
</body>
```

PHP页面

```php
<?php
//post数组中不为空
if(!empty($_POST)) {
	echo '这是post提交的数据<br>';
	echo '语文：'.$_POST['ch'],'<br>';
	echo '数学：'.$_POST['math'],'<br>';
}
echo '<hr>';
//获取get提交的数据
if(!empty($_GET)){
	echo '这是get提交的数据<br>';
	echo '语文：'.$_GET['ch'],'<br>';
	echo '数学：'.$_GET['math'],'<br>';
}
echo '<hr>';
//既能获取get又能获取post提交的数据
echo $_REQUEST['ch'],'<br>';
echo $_REQUEST['math'];
```



思考题

在一个请求中，既有get又有post，get和post传递的名字是一样的，这时候通过$_REQUET获取的数据是什么?

答：结果取决于配置文件

```php
request_order = "GP"  # 先获取GET，在获取POST值
```

例题

```php+HTML
<?php
if(!empty($_POST)){
	echo '姓名：'.$_REQUEST['username'],'<br>';
}
?>
<form method="post" action="?username=berry">
	姓名： <input type="text" name="username"><br />
	<input type="submit" name="button" value="提交">
</form>
分析：先获取GET的username,再获取post的username，后面的将前面的值覆盖
```

小结：

1、在开发的时候，如果明确是post提交就使用`$_POST`获取，如果明确get提交就用`$_GET`获取

2、request获取效率低，尽可能不要使用，除非提交的类型不确定的情况下才使用。



## 1.5  参数传递

#### 1.5.1  复选框值的传递

复选框的命名要注意带'[]'。

```php+HTML
<body>
<?php
if(isset($_POST['button'])) {
	print_r($_POST['hobby']);
}
?>
<form method="post" action="">
	爱好： 
	<input type="checkbox" name="hobby[]" value='爬山'>爬山
	<input type="checkbox" name="hobby[]" value='抽烟'>抽烟
	<input type="checkbox" name="hobby[]" value='喝酒'>喝酒
	<input type="checkbox" name="hobby[]" value='烫头'>烫头
	<input type="submit" name="button" value="提交">
</form>
</body>
```

小结：

1、表单提交到本页面需要判断一下是否有post提交

2、数组的提交表单元素的名字必须带有[]。



#### 1.5.2  例题

```php+HTML
<body>
<?php
if(isset($_POST['button'])) {
	echo '姓名：'.$_POST['username'].'<br>';
	echo '密码：'.$_POST['pwd'].'<br>';
	echo '性别：'.$_POST['sex'].'<br>';
	echo '爱好：',isset($_POST['hobby'])?implode(',',$_POST['hobby']):'没有爱好','<br>';
	echo '籍贯：'.$_POST['jiguan'],'<br>';
	echo '留言：'.$_POST['words'];
}
?>
<form method="post" action="">
	姓名： <input type="text" name="username"> <br />
	密码： <input type="password" name="pwd"> <br />
	性别： <input type="radio" name="sex" value='1' checked>男
		   <input type="radio" name="sex" value='0'>女 <br />
	爱好： 
	<input type="checkbox" name="hobby[]" value='爬山'>爬山
	<input type="checkbox" name="hobby[]" value='抽烟'>抽烟
	<input type="checkbox" name="hobby[]" value='喝酒'>喝酒
	<input type="checkbox" name="hobby[]" value='烫头'>烫头 <br />
	籍贯：
	<select name="jiguan">
		<option value="021">上海</option>
		<option value="010">北京</option>
	</select> <br>
	留言： <textarea name="words" rows="5" cols="30"></textarea> <br />

	<input type="submit" name="button" value="提交">
</form>
</body>
```

运行结果

 ![1559800993931](images/1559800993931.png)



## 1.6  文件上传

开发中需要上传图片、音乐、视频等等，这种上传传递是二进制数据。

#### 1.6.1  客户端上传文件

文件域

```html 
<input type="file" name="image">
```

表单的enctype属性

​	默认情况下，表单传递是字符流，不能传递二进制流，通过设置表单的enctype属性传递复合数据。

enctype属性的值有：

1. application/x-www-form-urlencoded：【默认】，表示传递的是带格式的文本数据。
2. multipart/form-data：复合的表单数据（字符串，文件），文件上传必须设置此值
3. text/plain：用于向服务器传递无格式的文本数据，主要用户电子邮件

单词

```
multipart：复合
form-data：表单数组
```



#### 1.6.2  服务器接受文件

超全局变量`$_FILES`是一个二维数组，用来保存客户端上传到服务器的文件信息。二维数组的行是文件域的名称，列有5个。
1、`$_FILES[][‘name’]`：上传的文件名
2、`$_FILES[][‘type]`：上传的类型，这个类型是MIME类型（image/jpeg、image/gif、image/png）
3、`$_FILES[][‘size’]`：文件的大小，以字节为单位
4、`$_FILES[][‘tmp_name’]`：文件上传时的临时文件
5、`$_FILES[][‘error’]`：错误编码(值有0、1、2、3、4、6、7)0表示正确

 ![1559802500855](images/1559802500855.png)



`$_FILES[][‘error’]`详解

| 值   | 错误描述                                                     |
| ---- | ------------------------------------------------------------ |
| 0    | 正确                                                         |
| 1    | 文件大小超过了php.ini中允许的最大值    upload_max_filesize = 2M |
| 2    | 文件大小超过了表单允许的最大值                               |
| 3    | 只有部分文件上传                                             |
| 4    | 没有文件上传                                                 |
| 6    | 找不到临时文件                                               |
| 7    | 文件写入失败                                                 |

  ![1559803920217](images/1559803920217.png)



注意：MAX_FILE_SIZE必须在文件域的上面。

只要掌握的错误号：0和4



#### 1.6.3  将上传文件移动到指定位置

函数：

```php
move_uploaded_file(临时地址,目标地址)
```

代码

```php+HTML
<body>
<?php
if(!empty($_POST)) {
	if($_FILES['face']['error']==0){  //上传正确
        //文件上传
		move_uploaded_file($_FILES['face']['tmp_name'],'./'.$_FILES['face']['name']);
	}else{
		echo '上传有误';
		echo '错误码:'.$_FILES['face']['error'];
	}
}
?>
<form method="post" action="" enctype='multipart/form-data'>
	<input type="file" name="face">
	<input type="submit" name="button" value="上传">
</form>
</body>
```

小结：上传的同名的文件要给覆盖



#### 1.6.4  与文件上传有关的配置

post_max_size = 8M：表单允许的最大值

upload_max_filesize = 2M：允许上传的文件大小

upload_tmp_dir =F:\wamp\tmp：指定临时文件地址，如果不知道操作系统指定

file_uploads = On：是否允许文件上传

max_file_uploads = 20：允许同时上传20个文件



## 1.7  优化文件上传

#### 1.7.1  更改文件名

方法一：通过时间戳做文件名

```php
<?php
$path='face.stu.jpg';
//echo strrchr($path,'.');	//从最后一个点开始截取，一直截取到最后
echo time().rand(100,999).strrchr($path,'.');   
```

方法二：通过uniqid()实现

```php
$path='face.stu.jpg';
echo uniqid().strrchr($path,'.'),'<br>';   //生成唯一的ID
echo uniqid('goods_').strrchr($path,'.'),'<br>';   //带有前缀
echo uniqid('goods_',true).strrchr($path,'.'),'<br>';  //唯一ID+随机数
```



#### 1.7.2  验证文件格式

方法一：判断文件的扩展名（不能识别文件伪装）

操作思路：将文件的后缀和允许的后缀对比

```php+HTML
<body>
<?php
if(!empty($_POST)) {
	$allow=array('.jpg','.png','.gif');	//允许的扩展名
	$ext=strrchr($_FILES['face']['name'],'.');  //上传文件扩展名
	if(in_array($ext,$allow))
		echo '允许上传';
	else
		echo '文件不合法';
}
?>
<form method="post" action="" enctype='multipart/form-data'>
	<input type="file" name="face">
	<input type="submit" name="button" value="上传">
</form>
</body>
```

注意：比较扩展名不能防止文件伪装。



方法二：通过`$_FIELS[]['type']`类型（不能识别文件伪装）

```php+HTML
<body>
<?php
if(!empty($_POST)) {
	$allow=array('image/jpeg','image/png','image/gif');	//允许的类别
	$mime=$_FILES['face']['type'];  //上传文件类型
	if(in_array($mime,$allow))
		echo '允许上传';
	else
		echo '文件不合法';
}
?>
<form method="post" action="" enctype='multipart/form-data'>
	<input type="file" name="face">
	<input type="submit" name="button" value="上传">
</form>
</body>
```

注意：比较`$_FIELS[]['type']`不能防止文件伪装。



方法三：php_fileinfo扩展（可以防止文件伪装）

​	在php.ini中开启fileinfo扩展

```php
extension=php_fileinfo.dll
```

注意：开启fileinfo扩展以后，就可以使用finfo_*的函数了

 ![1559807821961](images/1559807821961.png)



```php+HTML
<body>
<?php
if(!empty($_POST)) {
	//第一步：创建finfo资源
	$info=finfo_open(FILEINFO_MIME_TYPE);
	//var_dump($info);		//resource(2) of type (file_info) 
	//第二步：将finfo资源和文件做比较
	$mime=finfo_file($info,$_FILES['face']['tmp_name']);
	//第三步，比较是否合法
	$allow=array('image/jpeg','image/png','image/gif');	//允许的类别
	echo in_array($mime,$allow)?'合法':'不合法';
}
?>
<form method="post" action="" enctype='multipart/form-data'>
	<input type="file" name="face">
	<input type="submit" name="button" value="上传">
</form>
</body>
```

小结：验证文件格式有三种方法

1、可以验证扩展名（不可以防止文件伪装）

2、通过`$_FILES[]['type']`验证（不可以防止文件伪装）

3、通过file_info扩展（可以防止文件伪装）



#### 1.7.3  优化文件上传例题

步骤

第一步：验证是否有误

第二步：验证格式

第三步：验证大小

第四步：验证是否是http上传

第五步：上传实现

```php+HTML
<body>
<?php
/**
*验证错误
*如果有错，就返回错误，如果没错，就返回null
*/
function check($file) {
	//1：验证是否有误
	if($file['error']!=0){
		switch($file['error']) {
			case 1:
				return '文件大小超过了php.ini中允许的最大值,最大值是：'.ini_get('upload_max_filesize');
			case 2:
				return '文件大小超过了表单允许的最大值';
			case 3:
				return '只有部分文件上传';
			case 4:
				return '没有文件上传';
			case 6:
				return '找不到临时文件';
			case 7:
				return '文件写入失败';
			default:
				return '未知错误';
		}
	}
	//2、验证格式
	$info=finfo_open(FILEINFO_MIME_TYPE);
	$mime=finfo_file($info,$file['tmp_name']);
	$allow=array('image/jpeg','image/png','image/gif');	//允许的类别
	if(!in_array($mime,$allow)){
		return '只能上传'.implode(',',$allow).'格式';
	}
	//3、验证大小
	$size=123456789;
	if($file['size']>$size){
		return '文件大小不能超过'.number_format($size/1024,1).'K';
	}
	//4、验证是否是http上传
	if(!is_uploaded_file($file['tmp_name']))
		return '文件不是HTTP POST上传的<br>';

	return null;  //没有错误
}

//表单提交
if(!empty($_POST)) {
	//上传文件过程中有错误就显示错误
	if($error=check($_FILES['face'])){
		echo $error;
	}else{
		//文件上传，上传的文件保存到当天的文件夹中
		$foldername=date('Y-m-d');		//文件夹名称
		$folderpath="./uploads/{$foldername}";	//文件夹路径
		if(!is_dir($folderpath))
			mkdir($folderpath);
		$filename=uniqid('',true).strrchr($_FILES['face']['name'],'.');	//文件名
		$filepath="$folderpath/$filename";	//文件路径
		if(move_uploaded_file($_FILES['face']['tmp_name'],$filepath))
			echo "上传成功,路径是：{$foldername}/{$filename}";
		else
			echo '上传失败<br>';
	}

}
?>
<form method="post" action="" enctype='multipart/form-data'>
	<input type="file" name="face">
	<input type="submit" name="button" value="上传">
</form>
</body>
```

运行结果

 ![1559811953112](images/1559811953112.png)



小结：

1、将时间戳转换格式

```php
echo date('Y-m-d H:i:s',1231346),'<br>';		//将时间戳转成年-月-日 小时:分钟:秒
echo date('Y-m-d H:i:s'),'<br>';	//将当前的时间转成年-月-日 小时:分钟:秒
```

2、设置时区（php.ini）

 ![1559811342514](images/1559811342514.png)

```
PRC：中华人民共和国
```



3、PHP的执行可以不需要Apache的参与

 ![1559809731518](images/1559809731518.png)



## 1.8  作业

1、多文件上传

 ![1559812126896](images/1559812126896.png)



## 1.9  作业讲解

1、递归遍历文件夹

```php
<?php
//获取文件夹的子级
function getFile($path) {
	$folder=opendir($path);		//打开文件夹
	echo '<ul>';
	while($f=readdir($folder)){	//读取文件夹
		if($f=='.' || $f=='..')
			continue;
		echo '<li>'.iconv('gbk','utf-8',$f).'</li>';
		$subpath="{$path}/{$f}";	
		if(is_dir($subpath))	//如果子级还是文件夹，继续打开并读取
			getFile($subpath);
	}
	
	echo '</ul>';
}
//测试
getFile('./');
```

运行结果

 ![1559812920666](images/1559812920666.png)



2、一只猴子看守一堆桃子，第一天吃了一半后又多吃了1个，第二天一样，到第十天的时候就剩下一个桃子，请问原来有几个桃子？

分析

```
f(n)-(f(n)/2+1)=f(n+1)
=>f(n)/2-1=f(n+1)
=>f(n)=(f(n+1)+1)*2
```

代码实现

```php
<?php
function getTao($n) {
	if($n==10)
		return 1;
	return (getTao($n+1)+1)*2;
}
echo getTao(1);    //1534
```











