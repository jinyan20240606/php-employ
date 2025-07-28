# 品优购电商项目

- [品优购电商项目](#品优购电商项目)
- [一、项目介绍](#一项目介绍)
  - [1、项目开发流程](#1项目开发流程)
  - [2、主要电商模式](#2主要电商模式)
    - [2.1 B2B--企业对企业](#21-b2b--企业对企业)
    - [2.2 C2C--个人对个人](#22-c2c--个人对个人)
    - [2.3 B2C--企业对个人](#23-b2c--企业对个人)
    - [2.4 C2B--个人对企业](#24-c2b--个人对企业)
    - [2.5 O2O--线上到线下](#25-o2o--线上到线下)
    - [2.6 F2C--工厂到个人](#26-f2c--工厂到个人)
    - [2.7 B2B2C--企业-企业-个人](#27-b2b2c--企业-企业-个人)
  - [3、品优购商城](#3品优购商城)
  - [4、技术亮点](#4技术亮点)
- [二、系统设计](#二系统设计)
  - [1、数据表设计](#1数据表设计)
  - [2、模块设计](#2模块设计)
- [三、项目搭建](#三项目搭建)
  - [1、安装部署tp框架](#1安装部署tp框架)
    - [1.1 安装TP5.0框架](#11-安装tp50框架)
    - [1.2 配置虚拟站点](#12-配置虚拟站点)
    - [1.3 隐藏入口文件](#13-隐藏入口文件)
  - [2、模块划分](#2模块划分)
  - [3、路由配置](#3路由配置)
  - [4、数据库配置](#4数据库配置)
    - [4.1 导入数据表](#41-导入数据表)
    - [4.2 配置数据库连接信息](#42-配置数据库连接信息)
  - [5、搭建后台前端项目](#5搭建后台前端项目)
- [四、接口基础控制器类](#四接口基础控制器类)
  - [1、跨域](#1跨域)
    - [1.1 处理options预检请求](#11-处理options预检请求)
    - [1.2 处理跨域请求](#12-处理跨域请求)
  - [2、响应](#2响应)
- [五、基于JWT的Token登录认证](#五基于jwt的token登录认证)
  - [1、JWT简介](#1jwt简介)
  - [2、JWT 的原理](#2jwt-的原理)
  - [3、JWT 的数据结构](#3jwt-的数据结构)
    - [3.1 Header](#31-header)
    - [3.2 Payload](#32-payload)
    - [3.3 Signature](#33-signature)
    - [3.4 Base64URL](#34-base64url)
  - [4、JWT 的使用方式](#4jwt-的使用方式)
    - [token的注销机制](#token的注销机制)
  - [5、JWT 的几个特点](#5jwt-的几个特点)
    - [签名和加密理解](#签名和加密理解)
  - [6、功能实现](#6功能实现)
    - [6.1 JWT功能组件](#61-jwt功能组件)
    - [6.2 验证码接口](#62-验证码接口)
    - [6.3 登录接口](#63-登录接口)
    - [6.4 退出接口](#64-退出接口)
    - [6.5 登录检测](#65-登录检测)


# 一、项目介绍

## 1、项目开发流程

![1562855662334](img/1562855662334.png) 

产品经理：进行需求分析，整理需求文档（产品原型文档）（需求评审）

UI设计：根据需求文档，设计每一个页面，出设计图

前端：根据需求文档和设计图，编写前端html代码

后端：技术选型、架构设计、数据库设计、（开发文档）、开发项目功能、自测（单元测试）

测试：编写测试用例，逐个进行测试。（分多轮）

上线：项目部署到线上服务器

## 2、主要电商模式

### 2.1 B2B--企业对企业

>   B2B（ Business to Business）是指进行电子商务交易的供需双方都是商家（或企业、公司），她（他）们使用了互联网的技术或各种商务网络平台，完成商务交易的过程。电子商务是现代 B2B marketing的一种具体主要的表现形式。
>   案例：阿里巴巴、慧聪网

### 2.2 C2C--个人对个人

>   C2C即 Customer（Consumer） to Customer（Consumer），意思就是消费者个人间的电子商务行为。比如一个消费者有一台电脑，通过网络进行交易，把它出售给另外一个消费者，此种交易类型就称为C2C电子商务。
>   案例：淘宝、易趣、瓜子二手车

### 2.3 B2C--企业对个人

>   B2C是 Business-to-Customer 的缩写，而其中文简称为“商对客”。“商对客”是电子商务的一种模式，也就是通常说的直接面向消费者销售产品和服务商业零售模式。这种形式的电子商务一般以网络零售业为主，主要借助于互联网开展在线销售活动。B2C即企业通过互联网为消费者提供一个新型的购物环境--网上商店，消费者通过网络在网上购物、网上支付等消费行为。
>   案例：唯品会、乐蜂网

### 2.4 C2B--个人对企业

>   C2B（Consumer to Business，即消费者到企业），是互联网经济时代新的商业模式。这一模式改变了原有生产者（企业和机构）和消费者的关系，是一种消费者贡献价值（Create Value）， 企业和机构消费价值（Consume Value）。
>   C2B模式和我们熟知的供需模式（DSM, Demand Supply Model）恰恰相反，真正的C2B 应该先有消费者需求产生而后有企业生产，即先有消费者提出需求，后有生产企业按需求组织生产。通常情况为消费者根据自身需求定制产品和价格，或主动参与产品设计、生产和定价，产品、价格等彰显消费者的个性化需求，生产企业进行定制化生产。
>   案例：海尔商城、 尚品宅配

### 2.5 O2O--线上到线下

>   O2O即 Online To Offline（在线离线/线上到线下），是指将线下的商务机会与互联网结合，让互联网成为线下交易的平台，这个概念最早来源于美国。O2O的概念非常广泛，既可涉及到线上，又可涉及到线下,可以通称为O2O。主流商业管理课程均对O2O这种新型的商业模式有所介绍及关注。
>   案例：美团、饿了吗

### 2.6 F2C--工厂到个人

>   F2C指的是Factory to customer，即从厂商到消费者的电子商务模式。

### 2.7 B2B2C--企业-企业-个人

>   B2B2C是一种电子商务类型的网络购物商业模式，B是BUSINESS的简称，C是CUSTOMER的简称，第一个B指的是商品或服务的供应商，第二个B指的是从事电子商务的企业，C则是表示消费者。
>   第一个BUSINESS，并不仅仅局限于品牌供应商、影视制作公司和图书出版商，任何的商品供应商或服务供应商都能可以成为第一个BUSINESS；第二B是B2B2C模式的电子商务企业，通过统一的经营管理对商品和服务、消费者终端同时进行整合，是广大供应商和消费者之间的桥梁，为供应商和消费者提供优质的服务，是互联网电子商务服务供应商。C表示消费者，在第二个B构建的统一电子商务平台购物的消费者。
>   B2B2C的来源于目前的B2B、B2C模式的演变和完善，把B2C和C2C完美地结合起来，通过B2B2C模式的电子商务企业构建自己的物流供应链系统，提供统一的服务。
>   案例：京东商城、天猫商城

## 3、品优购商城

品优购电商平台属于B2B2C电商，类似于京东、天猫等运营模式，商家可以申请在平台上开店，运营商审核通过后拥有独立的商家后台。系统后台包括运营商后台、商家后台，使用ThinkPHP框架+Vue.js前后端分离解决方案。 

品优购前台由首页系统、商家首页、商品详细页、购物车系统、订单系统、支付系统、会员系统、评论系统、商品搜索、秒杀、用户中心等多个系统组成。品优购采用ThinkPHP5框架+Vue.js作为主体框架，详细讲解了实际开发中的各项解决方案。 

![img](file:///C:\Users\asus\AppData\Local\Temp\ksohtml\wps912C.tmp.jpg) 

 

## 4、技术亮点

 完全采用VueJS + Bootstrap 作为前端框架，前端架构融入分层设计思想。

采用ThinkPHP5作为后端框架。

融入CORS 跨域技术。

电商模式采用B2B2C模式，分为商家后台、运营商后台和网站前台三大部分。

前端上传图片采用无刷新方式（Ajax）

采用聚合平台短信接口实现短信的发送。

使用Cookie+Mysql的购物车解决方案。

使用第三方支付解决方案（支付宝）。

引入SPU和SKU概念。

 使用第三方登录解决方案

 

# 二、系统设计 

## 1、数据表设计

1. 你要理解针对需求，为什么要拆成这些表，表里的字段为什么是这些。
2. 理解
   1. 1个商品对应多个图片的，可以拆成2表(主键id跟相册维护一个表)也可以放在一个表里，字段维护
   2. sku单独一个表
   3. spu是产品包含了不同的规格，具体什么样规格的产品是sku
   4. 最小库存单元：具体商品具体规则参数的

| 表名             | 备注                |
| ---------------- | ------------------- |
| pyg_admin        | 后台管理员表        |
| pyg_role         | 后台角色表（对管理元做的一个角色分组表）          |
| pyg_auth         | 后台权限表（针对不同角色的权限管理）          |
| pyg_category     | 商品分类表 （多级分类关系）         |
| pyg_brand        | 商品品牌表（每个分类下有哪些品牌）          |
| pyg_goods        | 商品表（SPU表：就是商详里的产品）     |
| pyg_goods_images | 商品相册表          |
| pyg_attribute    | 商品属性表（不能选的，不影响价格的，固定型号参数，分辨率，尺寸等单独存张表）          |
| pyg_spec         | 商品规格名称表（可以选的，不固定的，颜色内存等影响价格的）      |
| pyg_spec_value   | 商品规格值表（组合起来的表）        |
| pyg_spec_goods   | 规格商品表（SKU表：如白色64g手机，每个规格商品可以单独设置价格） |
| pyg_cart         | 购物车表            |
| pyg_order        | 订单表              |
| pyg_order_goods  | 订单商品表          |
| pyg_pay_log      | 支付记录表          |
| pyg_user         | 前台用户表          |
| pyg_type         | 商品模型表（后台管理系统录入数据:添加一个手机，必须得定好手机这个实体的描述参数）          |
| pyg_address      | 收货地址表          |

## 2、模块设计

| 模块名       | 用途                                 |
| ------------ | ------------------------------------ |
| 后台前端项目 | 后台管理系统前端部分，前后端分离模式 |
| 后台接口模块 | 后台管理系统接口，前后端分离模式     |
| 前台模块     | 前台系统，mvc模式                    |
| 公共模块     | 主要存放公共模型类                   |
| 移动端模块   | 移动端h5前台系统，课外内容           |

# 三、项目搭建

## 1、安装部署tp框架

### 1.1 安装TP5.0框架

方式一：官网下载框架压缩包，解压。

方式二：通过composer安装

在工作目录（写代码的目录，比如phpStudy/WWW目录下），执行以下命令

```
composer create-project topthink/think pyg 5.0.*
```

![1562836036920](img/1562836036920.png) 

![1562836162612](img/1562836162612.png) 

### 1.2 配置虚拟站点

①通过phpStudy的“站点域名管理”进行配置或者直接修改apache的虚拟主机配置文件，

![img](img/wps6328.tmp.jpg) 

将站点域名指向项目目录下的public目录

主域名：www.pyg.com 主要用于访问前台

子域名：adminapi.pyg.com 专门用于访问后台接口

![1562836407986](img/1562836407986.png)  

②域名解析，修改hosts文件

![img](../../01-thinkphp/%E7%AC%94%E8%AE%B0/img/wps633A.tmp.jpg ) 

增加域名解析如下：

127.0.0.1      www.pyg.com

127.0.0.1      adminapi.pyg.com

③重启apache，在浏览器访问配置的虚拟站点

http://www.pyg.com

http://adminapi.pyg.com

两个域名均能打开以下界面，说明框架安装成功、虚拟站点配置成功。

![1562836681481](img/1562836681481.png) 

 

apache配置参考（不要照搬）：

```
<VirtualHost *:80>
    DocumentRoot "E:\phpStudy\WWW\tpshop\public"
    ServerName www.tpshop.com
    ServerAlias tpshop.com
  	<Directory "E:\phpStudy\WWW\tpshop\public">
      	Options FollowSymLinks ExecCGI
        AllowOverride All
        Order allow,deny
        Allow from all
        Require all granted
  	</Directory>
</VirtualHost>
```

### 1.3 隐藏入口文件

httpd.conf配置文件中加载mod_rewrite.so模块

将httpd.conf 和 虚拟站点配置文件的 AllowOverride None 将None改为 All

修改public目录下的.htaccess文件如下（index.php后加上英文问号?）

```php
<IfModule mod_rewrite.c>
  Options +FollowSymlinks -Multiviews
  RewriteEngine On

  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteRule ^(.*)$ index.php?/$1 [QSA,PT,L]
</IfModule>
```

![1562838529549](img/1562838529549.png) 

## 2、模块划分

后端项目模块：

| 模块名   | 说明         | 用途                                       |
| -------- | ------------ | ------------------------------------------ |
| admin    | 后台模块     | mvc模式，后台管理系统，后续提供参考代码    |
| adminapi | 后台接口模块 | 前后端分离模式，后台管理系统接口，课堂内容 |
| home     | 前台模块     | mvc模式，前台系统，课堂内容                |
| common   | 公共模块     | 主要存放公共模型类，课堂内容               |
| mobile   | 移动端模块   | 移动端h5前台系统，课外内容                 |

创建项目模块：

命令行下，切换到项目目录（比如phpStudy/WWW/pyg），分别执行以下命令

```php
php think build --module admin
php think build --module adminapi
php think build --module home
php think build --module common
php think build --module mobile
```

![1562837922830](img/1562837922830.png) 

## 3、路由配置

对adminapi 后台接口模块，配置域名路由

修改application/config.php 代码如下： 

开启调试模式：将app_debug配置值 由 false 改为 true

```php
'app_debug'      => true,
```

![1562839280991](img/1562839280991.png) 

开启域名路由功能：将url_domain_deploy配置值 由 false 改为 true

```php
'url_domain_deploy'      => true,
```

![1562837967024](img/1562837967024.png) 

修改application/route.php 代码如下：

- 域名路由2参不仅可以设置字符串模块名，也可以设置函数：函数内部，可以在子域名下，定制该子域名下新的路由规则。
  - 比如可以直接定义资源路由，等其他模块的路由

![1562839625834](img/1562839625834.png) 

修改application/adminapi/controller/Index.php控制器文件的index 方法

![1562838928527](img/1562838928527.png)

浏览器访问 http://adminapi.pyg.com



**注意：如果没有在adminapi域名下定义路由，则 adminapi.pyg.com 等同于 www.pyg.com**

## 4、数据库配置

### 4.1 导入数据表

新建pyg数据库（create database pyg character set utf8 collate utf8_general_ci）

![1562848007806](img/1562848007806.png) 

导入数据表(source sql路径)

![1562848049265](img/1562848049265.png) 

刷新之后，数据表如下：

![1562848079026](img/1562848079026.png) 

### 4.2 配置数据库连接信息

(见手册--数据库--连接数据库)

TP框架中，数据库的连接信息是通过配置文件来设置的。

修改application/database.php

![1562847788789](img/1562847788789.png) 

![1562847819547](img/1562847819547.png) 

测试： 修改application/adminapi/controller/Index.php 的index方法

查询数据

![1562899304864](img/1562899304864.png)

查询到数据，不报错，则说明数据库配置成功。

## 5、搭建后台前端项目

后台管理系统采用前后端分离模式。

后台前端项目（提供整套代码）：

解压项目到工作目录（比如phpStudy/WWW/pyg-vue）

修改src/assets/js/myaxios.js中的接口域名 为   上面步骤中配置的后台接口域名； 比如 http://adminapi.pyg.com

![1562854403264](img/1562854403264.png)

命令行下切换到项目目录，分别执行以下命令

```
npm install
npm run dev
```

浏览器访问  http://localhost:8080

# 四、接口基础控制器类

后台接口模块adminapi，用于对前后端分离项目提供接口服务，涉及到跨域问题。

## 1、跨域

跨域要处理2个方面：1是options请求的跨域允许，2是正常控制器的普通请求的跨域允许

### 1.1 处理options预检请求

跨域情况下，客户端先发送options预检请求，接口服务端需要对预检请求进行处理。只在入口中处理就行，不用在控制器中处理。

在入口文件 public/index.php中，增加代码如下：

```php
//处理跨域预检请求
if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
    //允许的源域名
    header("Access-Control-Allow-Origin: *");
    //允许的请求头信息
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
    //允许的请求类型
    header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE,OPTIONS,PATCH');
    exit;
}
```

![1562840695574](img/1562840695574.png) 

### 1.2 处理跨域请求

所有后台接口，都需要进行跨域处理。

创建接口基础控制器类：项目目录下，执行以下命令

```
php think make:controller adminapi/BaseApi --plain
```

控制器文件 application/adminapi/controller/BaseApi.php中

- 创建初始化方法 _initialize()：由于方法重写了，记得执行父类的初始化方法

```php
// 该方法是继承的父类控制器中构造函数中会自动执行this->_initialize();,我们继承控制器时，可以重写父类构造方法也可以重写_initialize方法(更推荐)

//初始化方法
public function _initialize()
{
    parent::_initialize();
    //允许的源域名
    header("Access-Control-Allow-Origin: *");
    //允许的请求头信息
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
    //允许的请求类型
    header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE,OPTIONS,PATCH');
}
```

## 2、响应

接口响应数据格式，统一约定为 包含code 、msg、data 三个字段的 json字符串。

在BaseApi控制器中，定义快速响应数据的方法如下：

```php
	/**
     * 通用响应
     * @param int $code 错误码
     * @param string $msg 错误描述
     * @param array $data 返回数据
     */
    public function response($code=200, $msg='success', $data=[])
    {
        $res = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        //以下两行二选一
        //echo json_encode($res, JSON_UNESCAPED_UNICODE);die;
        json($res)->send();die;
    }
    /**
     * 失败时响应
     * @param string $msg 错误描述
     * @param int $code 错误码
     */
    public function fail($msg='fail',$code=500)
    {
        return $this->response($code, $msg);
    }

    /**
     * 成功时响应
     * @param array $data 返回数据
     * @param int $code 错误码
     * @param string $msg 错误描述
     */
    public function ok($data=[], $code=200, $msg='success')
    {
        return $this->response($code, $msg, $data);
    }
```

测试：

修改application/adminapi/controller/Index.php 

继承BaseApi控制器类，

index方法中，测试 封装的快速响应方法

![1562841663201](img/1562841663201.png)

postman中或者浏览器中 get请求 访问 http://adminapi.pyg.com

![1562841762814](img/1562841762814.png) 

# 五、基于JWT的Token登录认证

## 1、JWT简介

常用登录态方案以下2种：本质上都是验证登录态，是否登录过

1. 有状态的：session登录认证方案：用户从客户端传递用户名、密码等信息，服务端认证后将信息存储在session中，将session_id放到cookie中。

以后访问其他页面，自动从cookie中取到session_id，再从session中取认证信息。

2. 无状态的：另一类解决方案，直接把状态及认证信息作为传输对象了(就不是session_id的载体形式了)，返回给客户端，存储到客户端。下次访问其他页面，需要从客户端传递认证信息回服务端。

JSON Web Token（缩写 JWT），是目前最流行的跨域认证解决方案。JWT就是这类方案的代表，将认证信息保存在客户端。

jwt是session的一种替代方案，只是存认证信息，并不能存密码秘密信息等

## 2、JWT 的原理

JWT 的原理是，服务器认证以后，生成一个 JSON格式的 对象，发回给客户端，就像下面这样。

> ```javascript
> {
>   "用户名": "admin",
>   "角色": "超级管理员",
>   "到期时间": "2019-07-13 00:00:00"
> }
> ```

以后，客户端与服务端通信的时候，都要发回这个 JSON 对象。服务器完全只靠这个对象认定用户身份。

为了防止用户篡改数据，服务器在生成这个对象的时候，会加上签名（详见后文）。如把信息中的角色篡改。

***服务器不再保存任何 session 数据，也就是服务器变成无状态了***，从而比较容易实现扩展。

## 3、JWT 的数据结构

实际的 JWT是一个很长的字符串，中间用点（`.`）分隔成三个部分。 就像下面这样：

```
eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjNmMmc1N2E5MmFhIn0.eyJpYXQiOjE1NjI4MzM0MDgsImlzcyI6Imh0dHA6XC9cL3d3dy5weWcuY29tIiwiYXVkIjoiaHR0cDpcL1wvd3d3LnB5Zy5jb20iLCJuYmYiOjE1NjI4MzM0MDcsImV4cCI6MTU2MjkxOTgwOCwianRpIjoiM2YyZzU3YTkyYWEiLCJ1c2VyX2lkIjoxfQ.NFq1qQ-Z5c4pwit8ZkyWEwX6SBXmnHJcc6ZDgSD5nhU
```

JWT 的三个部分依次如下。

> - Header（头部）
> - Payload（负载）
> - Signature（签名）

写成一行，就是下面的样子。

> ```javascript
> Header.Payload.Signature
> ```

### 3.1 Header

Header 部分是一个 JSON 对象，描述 JWT 的元数据，通常是下面的样子。

> ```javascript
> {
>   "alg": "HS256",
>   "typ": "JWT"
> }
> ```

上面代码中，`alg`属性表示签名的算法（algorithm），默认是 HMAC SHA256（写成 HS256）；`typ`属性表示这个令牌（token）的类型（type），JWT 令牌统一写为`JWT`。

最后，将上面的 JSON 对象使用 Base64URL 算法（详见后文）转成字符串。

### 3.2 Payload

Payload 部分也是一个 JSON 对象，用来存放实际需要传递的数据。JWT 规定了7个官方字段，供选用。

|       名称       | 说明     |                             解释                             |
| :--------------: | -------- | :----------------------------------------------------------: |
|   iss (issuer)   | 签发人   | issuer 请求实体，可以是发起请求的用户的信息，也可是jwt的签发者 |
|  sub (Subject)   | 主题     |                设置主题，类似于发邮件时的主题                |
|  aud (audience)  | 受众     |                    接收jwt的一方，接收人                     |
|   exp (expire)   | 过期时间 |                    token过期时间，时间戳                     |
| nbf (not before) | 生效时间 |          当前时间在nbf设定时间之前，该token无法使用          |
| iat (issued at)  | 签发时间 |                        token创建时间                         |
|   jti (JWT ID)   | 编号     |                   对当前token设置唯一标示                    |

除了官方字段，你还可以在这个部分定义私有字段，下面就是一个例子。

> ```javascript
> {
>   "sub": "除了帅一无所有",
>   "name": "张三",
>   "status": "1"
> }
> ```

注意，JWT 默认是不加密的，任何人都可以读到，所以不要把秘密信息放在这个部分。

这个 JSON 对象也要使用 Base64URL 算法转成字符串。

### 3.3 Signature

最终JWTroken结果的Signature 部分是对前两部分的签名，防止数据篡改。

> 签名和加密不是一回事，签名没有加密效果，只是验证数据的完整性和真实性

首先，需要指定一个密钥（secret）。这个密钥只有服务器才知道，不能泄露给用户。然后，使用 Header 里面指定的签名算法（默认是 HMAC SHA256），按照下面的公式产生签名。

```javascript
// 下面公式只是用来生成最终结果的第三段:签名（依赖header和payload生成）
HMACSHA256(
   base64UrlEncode(header) + "." +
   base64UrlEncode(payload), // 编码
   secret)
```

算出签名以后，把 Header、Payload、Signature 三个部分拼成一个字符串，每个部分之间用"点"（`.`）分隔，就可以返回给用户。

- **小结所以**：
  - JWT-token串的前2部分是header和payload都是编码非加密的相当于是明文的，不能存放私密信息
  - JWT-token串的第3部分是signature依赖的secret用来保证数据的完整性和真实性
    - 完整型：如果有人试图传输过程中修改 token 中的任何信息，那么重新计算的签名将与原始签名不匹配
      - 因为secret只有自己知道，不能泄露。
    - 真实性：验证 token 的来源是可信的。只有拥有正确密钥的一方才能生成有效的签名

### 3.4 Base64URL

- 只是编码，任何人都可以解码，不能加密

前面提到，Header 和 Payload 串型化的算法是 Base64URL。这个算法跟 Base64 算法基本类似，但有一些小的不同。

JWT 作为一个令牌（token），有些场合可能会放到 URL（比如 api.example.com/?token=xxx）。Base64 有三个字符`+`、`/`和`=`，在 URL 里面有特殊含义，所以要被替换掉：`=`被省略、`+`替换成`-`，`/`替换成`_` 。这就是 Base64URL 算法。

## 4、JWT 的使用方式

客户端收到服务器返回的 JWT，可以储存在 Cookie 里面，也可以储存在 localStorage。

此后，客户端每次与服务器通信，都要带上这个 JWT。你可以把它放在 Cookie 里面自动发送（cookie有跨域问题，避免不同域的请求登录），但是这样不能跨域，所以更好的做法是放在 HTTP 请求的头信息`Authorization`字段里面。

> ```javascript
> Authorization: Bearer <token>
> ```

另一种做法是，跨域的时候，JWT 就放在 POST 请求的数据体里面。

### token的注销机制

```js
// token使用流程图
用户登录
   ↓
生成 Token（带有效期）
   ↓
返回 Token 给客户端（如放在 Header 或 Cookie 中）
   ↓
每次请求携带 Token
   ↓
中间件校验 Token：
   - 签名是否合法？
   - 是否过期？
   - 是否在黑名单中？
   ↓
如果合法且未注销 → 正常处理请求
如果已注销或非法 → 返回 401 未授权
   ↓
用户点击“退出登录”
   ↓
将当前 Token 加入黑名单（缓存 Set）
   ↓
黑名单缓存设置与 Token 相同的过期时间
```

1. 为什么要加注销时，要加黑名单缓存，而不是直接删除？
   1. Token 是无状态的，不像 Session 那样可以主动销毁，因此我们需要通过 黑名单（Blacklist） 来记录那些“已注销”的 Token，防止它们继续使用
      1. 因为只要你携带的token还没过期，服务器判断合法就能放行，不能主动注销
2. 当黑名单中的 token 过期后，缓存系统会自动删除这些过期的 token
   1. `cache('delete_token', $delete_token, 86400); // 缓存有效期为1天`
3. 在实现 Token 注销功能时，通常你会将 token 的过期时间和黑名单的过期时间保持一致。这是因为：
   1. 如果 token 已经过期，那么即使它没有被加入黑名单，也无法再使用了（因为 JWT 中包含 exp 声明，验证时会检查是否过期）；
   2. 将黑名单中的 token 设置为与原始 token 相同的过期时间，可以确保：
      1. 在 token 有效期内，它可以被正确地加入黑名单并阻止后续访问；
      2. 当 token 自身过期后，黑名单中的记录也会随之失效，避免不必要的缓存堆积

## 5、JWT 的几个特点

（1）JWT 默认是不加密，但也是可以加密的。生成原始JWT-Token 以后，可以用密钥再加密一次如md5等再加密。

（2）JWT 不加密的情况下，不能将私密秘密数据写入 JWT。

（3）JWT 不仅可以用于认证，也可以用于交换信息。有效使用 JWT，可以降低服务器查询数据库的次数。

（4）JWT 的最大缺点是，由于服务器不保存 session 状态，因此无法在使用过程中失效某个 token，或者更改 token 的权限。也就是说，一旦 JWT 签发了，在到期之前就会始终有效，除非服务器部署额外的逻辑。
   - 一天有效期内你i想让这个token失效，比较难，因为他是无状态的，服务器控制不了(不像session方式，服务器可以控制session_id的有效期控制权限浏览器传过来的说失效就失效)，只要你客户端发的token有效期没过就在服务器这一直有效

（5）JWT 本身包含了认证信息，一旦泄露，任何人都可以获得该令牌的所有权限。为了减少盗用，JWT 的有效期应该设置得比较短。对于一些比较重要的权限，使用时应该再次对用户进行认证。

（6）为了减少盗用，JWT 不应该使用 HTTP 协议明码传输，要使用 HTTPS 协议传输。

### 签名和加密理解

1. 签名（Signing）：是为了确保数据的完整性以及验证数据来源的真实性。使用签名算法（例如 HS256、RS256等），可以生成一个签名来验证 token 是否被篡改过。但是，这并不意味着 payload 是加密的；任何人都可以解码并读取其内容
   1. 任何人都能查看 token 中的 payload 数据，因为它是 Base64 编码而非加密的
2. 加密（Encryption）：则是为了保护数据的隐私性，使得只有拥有正确密钥的人才能读取其中的信息


## 6、功能实现

### 6.1 JWT功能组件

使用composer安装 JWT 功能组件

```php
composer require lcobucci/jwt 3.3
```

封装JWT工具类 (参考 <https://github.com/lcobucci/jwt/tree/3.3>)

extend/tools/jwt/Token.php

```php
<?php
namespace tools\jwt;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;

/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2019/4/5
 * Time: 13:02
 */
class Token
{
    private static $_config = [
        'audience' => 'http://www.pyg.com',//接收人
        'id' => '3f2g57a92aa',//token的唯一标识，这里只是一个简单示例
        'sign' => 'pinyougou',//签名密钥
        'issuer' => 'http://adminapi.pyg.com',//签发人
        'expire' => 3600*24 //有效期
    ];

    //生成token
    public static function getToken($user_id){

        //签名对象
        $signer = new Sha256();
        //获取当前时间戳
        $time = time();
        //设置签发人、接收人、唯一标识、签发时间、立即生效、过期时间、用户id、签名
        $token = (new Builder())->issuedBy(self::$_config['issuer'])
            ->canOnlyBeUsedBy(self::$_config['audience'])
            ->identifiedBy(self::$_config['id'], true)
            ->issuedAt($time)
            ->canOnlyBeUsedAfter($time-1) // 立即生效
            ->expiresAt($time + self::$_config['expire']) // 过期时间
            ->with('user_id', $user_id)
            ->sign($signer, self::$_config['sign']) // 密钥
            ->getToken();
        return (string)$token;
    }

    //从请求信息中获取token令牌
    public static function getRequestToken()
    {
        if (empty($_SERVER['HTTP_AUTHORIZATION'])) {
            return false;
        }

        $header = $_SERVER['HTTP_AUTHORIZATION'];
        $method = 'bearer';
        //去除token中可能存在的bearer标识
        return trim(str_ireplace($method, '', $header));
    }

    //从请求头中的token中获取用户id （包含token的校验）
    public static function getUserId($token = null)
    {
        $user_id = null;

        $token = empty($token)?self::getRequestToken():$token;
        // 如果不为空
        if (!empty($token)) {
            //token的注销机制：为了注销token 加以下if判断代码：
            // cache('delete_token')是存储了所有已注销的token数组
            $delete_token = cache('delete_token') ?: [];
            if(in_array($token, $delete_token)){
                //token已被删除（注销）
                return $user_id;
            }
            $token = (new Parser())->parse((string) $token);
            //验证token
            $data = new ValidationData();
            $data->setIssuer(self::$_config['issuer']);//验证的签发人
            $data->setAudience(self::$_config['audience']);//验证的接收人
            $data->setId(self::$_config['id']);//验证token标识

            if (!$token->validate($data)) {
                //token验证失败
                return $user_id;
            }

            //验证签名
            $signer = new Sha256();
            if (!$token->verify($signer, self::$_config['sign'])) {
                //签名验证失败
                return $user_id;
            }
            //从token中获取用户id
            $user_id = $token->getClaim('user_id');
        }

        return $user_id;
    }
}
```

代理转发时的问题：修改public/.htaccess文件，通过apache重写，处理HTTP请求中的Authorization字段

（不处理，php中接收不到HTTP_AUTHORAZATION字段信息）

```
    RewriteCond %{HTTP:Authorization} ^(.+)$
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
```

测试： application/adminapi/controller/Index.php中index方法

静态调用封装的\tools\jwt\Token类的getToken方法，传递一个用户id值，生成token

静态调用封装的\tools\jwt\Token类的getUserId方法，传递一个token，获取用户id值

![1562845692441](img/1562845692441.png)



浏览器访问： http://adminapi.pyg.com

![1562845742553](img/1562845742553.png)

生成token，且根据token获取的用户id 与生成token时传递的用户id一致，说明Token类封装成功。

### 6.2 验证码接口

查看接口文档

验证码接口用于登录页面展示时，获取验证码图片地址及验证码标识

安装验证码功能组件（如果是官网下载的完整版框架，无需安装）

```
composer require topthink/think-captcha 1.*
```

设置路由，application/route.php中，adminapi域名路由部分，增加代码如下

```
//验证码图片
Route::get('captcha/:id', "\\think\\captcha\\CaptchaController@index");//访问图片需要
Route::get('captcha', 'adminapi/login/captcha');
```

![1562918881498](img/1562918881498.png)



创建Login控制器：项目目录下，执行以下命令

```
php think make:controller adminapi/Login --plain
```

application/adminapi/controller/Login.php中

继承BaseApi，创建captcha方法

```php
<?php

namespace app\adminapi\controller;

use think\Controller;

class Login extends BaseApi
{
    /**
     * 获取验证码图片地址
     */
    public function captcha()
    {
        //验证码标识
        $uniqid = uniqid(mt_rand(100000, 999999));
        //返回数据 验证码图片路径、验证码标识
        $data = [
            'src' => captcha_src($uniqid),
            'uniqid' => $uniqid
        ];
        $this->ok($data);
    }
}

```

测试：浏览器或者postman 访问  http://adminapi.pyg.com/captcha

![1562846632472](img/1562846632472.png)

```javascript
{
    "code":200,
    "msg":"success",
    "data":{
		"src":"http:\/\/adminapi.pyg.com\/captcha\/7873845d27250ede217.html",
		"uniqid":"7873845d27250ede217"
    }
}
```

可根据实际需要，对验证码进行自定义配置： application/config.php 

![1562919114954](img/1562919114954.png) 

通用处理（可选）

验证码组件，默认将验证码中的字符，存放在session中。

考虑到部分客户端（比如手机app） ，一般不使用session（显示验证码的请求和登录的请求，其session会话彼此独立）。

可修改组件源代码如下：

vendor/topthink/think-captcha/src/Captcha.php 的entry方法中

![1562847183540](img/1562847183540.png)

后续验证时，先从缓存取出对应的session_id， 并设置session_id。 见登录接口。



### 6.3 登录接口

①创建管理员模型（**注意** 管理员表为 pyg_admin  对应模型名称 为 Admin）

```
php think make:model common/Admin
```

②设置路由，application/route.php中，adminapi域名路由部分，增加代码如下

```
//登录
Route::post('login', 'adminapi/login/login');
```

![1562848263421](img/1562848263421.png)

③封装密码加密函数

注意：后台管理员表tpshop_admin中 初始的管理员密码，需要自己加密一个初始密码，更新到数据表

使用自定义的密码加密函数:

![1562851435674](img/1562851435674.png)  

使用加密函数对一个自定义的初始密码进行加密输出。

![1562851534428](img/1562851534428.png) 

 

效果：

![1562851595498](img/1562851595498.png)   

将此加密后的密码，复制，修改到tpshop_admin表的passwod字段。

 ④登录功能

application/adminapi/controller/Login.php中 创建login方法

```php
	/**
     * 登录接口
     */
    public function login()
    {
        //获取输入变量
        $param = input();
        $validate = $this->validate($param, [
            'username' => 'require',
            'password' => 'require',
            'code' => 'require',
            'uniqid' => 'require'
        ]);
        if($validate !== true){
            $this->fail($validate);
        }
        //根据验证码标识，从缓存取出session_id 并重新设置session_id
        session_id(cache('session_id_'.$param['uniqid']));
        //进行验证码校验 使用手动验证方法
        if (!captcha_check($param['code'], $param['uniqid'])) {
            //验证码错误
            $this->fail('验证码错误');
        }
        //根据用户名和密码（加密后的密码），查询管理员用户表
        $where = [
            'username' => $param['username'],
            'password' => encrypt_password($param['password'])
        ];
        $info = \app\common\model\Admin::where($where)->find();
        if(!$info){
            //用户名或者密码错误
            $this->fail('用户名或者密码错误');
        }
        $data['token'] = \tools\jwt\Token::getToken($info->id);
        $data['user_id'] = $info->id;
        $data['username'] = $info->username;
        $data['nickname'] = $info->nickname;
        $data['email'] = $info->email;
        //登录成功
        $this->ok($data);
    }
```

### 6.4 退出接口

①设置路由，application/route.php中，adminapi域名路由部分，增加代码如下

```
//验证码图片
Route::get('logout', 'adminapi/login/logout');
```

![1562848720369](img/1562848720369.png)

②创建logout方法

application/adminapi/controller/Login.php中 创建logout方法

```php
/**
 * 后台退出接口
 */
public function logout()
{
    //清空token  将需清空的token存入缓存，再次使用时，会读取缓存进行判断
    $token = \Token::getRequestToken();
    $delete_token = cache('delete_token') ?: [];
    // 数组末尾追加元素
    $delete_token[] = $token;
    cache('delete_token', $delete_token, 86400); // 缓存有效期为1天
    $this->ok();
}
```

### 6.5 登录检测

除了登录相关接口，其他接口都需要登录后才能访问。

在application/adminapi/controller/BaseApi.php中进行检测。

①设置无需检测方法列表

```
//无需进行登录检测的请求
protected $no_login = ['login/login', 'login/captcha'];
```

②进行检测

```php
 try{
     $path = strtolower($this->request->controller()) . '/' . $this->request->action();
     if(!in_array($path, $this->no_login)){
         $user_id = \tools\jwt\Token::getUserId();
         //登录验证
         if(empty($user_id)){
             $this->fail('未登录或Token无效', 403);
         }
         //将获取的用户id 设置到请求信息中
         $this->request->get(['user_id' => $user_id]);
         $this->request->post(['user_id' => $user_id]);
     }
 }catch(\Exception $e){
     $this->fail('服务异常，请检查token令牌', 403);
 }
```

测试： 将 index控制器继承 BaseApi，  浏览器访问  http://adminapi.pyg.com 

![1562923668783](img/1562923668783.png) 



总结：

项目搭建和配置、数据表设计、BaseApi基础控制器类（跨域处理、响应方法）

验证码接口、登录接口、退出接口、登录检测功能 