<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:110:"C:\Users\jinyan1\Desktop\php-employ\ThinkPHP\02\my-think-php\public/../application/admin\view\goods\index.html";i:1753252678;s:95:"C:\Users\jinyan1\Desktop\php-employ\ThinkPHP\02\my-think-php\application\admin\view\layout.html";i:1562405956;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>后台管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="/static/admin/css/main.css" rel="stylesheet" type="text/css"/>
    <link href="/static/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/static/admin/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
    <script src="/static/admin/js/jquery-1.8.1.min.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
</head>
<body>
<!-- 上 -->
<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <ul class="nav pull-right">
                <li id="fat-menu" class="dropdown">
                    <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-user icon-white"></i> admin
                        <i class="icon-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="javascript:void(0);">修改密码</a></li>
                        <li class="divider"></li>
                        <li><a tabindex="-1" href="javascript:void(0);">安全退出</a></li>
                    </ul>
                </li>
            </ul>
            <a class="brand" href="index.html"><span class="first">后台管理系统</span></a>
            <ul class="nav">
                <li class="active"><a href="javascript:void(0);">首页</a></li>
                <li><a href="javascript:void(0);">系统管理</a></li>
                <li><a href="javascript:void(0);">权限管理</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- 左 -->
<div class="sidebar-nav">
    <a href="#error-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-exclamation-sign"></i>权限管理</a>
    <ul id="error-menu" class="nav nav-list collapse">
        <li><a href="javascript:void(0);">管理员列表</a></li>
        <li><a href="javascript:void(0);">管理员新增</a></li>
        <li><a href="javascript:void(0);">角色管理</a></li>
        <li><a href="javascript:void(0);">权限管理</a></li>
    </ul>
    <a href="#accounts-menu" class="nav-header" data-toggle="collapse"><i class="icon-exclamation-sign"></i>商品管理</a>
    <ul id="accounts-menu" class="nav nav-list collapse in">
        <li><a href="javascript:void(0);">商品列表</a></li>
        <li><a href="javascript:void(0);">商品新增</a></li>
        <li><a href="javascript:void(0);">商品类型</a></li>
        <li><a href="javascript:void(0);">商品分类</a></li>
    </ul>
    <a href="#accounts-menu" class="nav-header" data-toggle="collapse"><i class="icon-exclamation-sign"></i>订单管理</a>
    <ul id="accounts-menu" class="nav nav-list collapse">
        <li><a href="javascript:void(0);">订单列表</a></li>
        <li><a href="javascript:void(0);">订单新增</a></li>
    </ul>
    <a href="#accounts-menu" class="nav-header" data-toggle="collapse"><i class="icon-exclamation-sign"></i>会员管理</a>
    <ul id="accounts-menu" class="nav nav-list collapse">
        <li><a href="javascript:void(0);">用户列表</a></li>
        <li><a href="javascript:void(0);">用户新增</a></li>
    </ul>
    <a href="#dashboard-menu" class="nav-header" data-toggle="collapse"><i class="icon-exclamation-sign"></i>系统管理</a>
    <ul id="dashboard-menu" class="nav nav-list collapse">
        <li><a href="javascript:void(0);">密码修改</a></li>
    </ul>
</div>


    <!-- 右 -->
    <div class="content">
        <div class="header">
            <h1 class="page-title">商品列表</h1>
        </div>

        <div class="well">
            <!-- search button -->
            <form action="" method="get" class="form-search">
                <div class="row-fluid" style="text-align: left;">
                    <div class="pull-left span4 unstyled">
                        <p> 商品名称<?php echo (isset($name) && ($name !== '')?$name:'123'); ?>：<input class="input-medium" name="" type="text"></p>
                    </div>
                </div>
                <button type="submit" class="btn">查找</button>
                <a class="btn btn-primary" href="<?php echo url('admin/goods/create'); ?>">新增</a>
            </form>
        </div>
        <div class="well">
            <!-- table -->
            <table class="table table-bordered table-hover table-condensed">
                <thead>
                    <tr>
                        <th>编号</th>
                        <th>商品名称</th>
                        <th>商品价格</th>
                        <th>商品数量</th>
                        <th>商品logo</th>
                        <th>添加时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($list as $v): ?>
                    <tr class="success">
                        <td><?php echo $v['id']; ?></td>
                        <td><a href="<?php echo url('admin/goods/read', ['id'=>$v['id']]); ?>"><?php echo $v['goods_name']; ?></a></td>
                        <td><?php echo $v['goods_price']; ?></td>
                        <td><?php echo $v['goods_number']; ?></td>
                        <td><img src="<?php echo $v['goods_logo']; ?>"></td>
                        <td><?php echo $v['create_time']; ?></td>
                        <td>
                            <a href="<?php echo url('admin/goods/edit', ['id' => $v['id']]); ?>"> 编辑 </a>
                            <a href="javascript:void(0);" onclick="if(confirm('确认删除？')) location.href='<?php echo url('admin/goods/delete', ['id' => $v['id']]); ?>'"> 删除 </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
            <!-- pagination -->
            <div class="pagination">
                <ul>
                    <li><a href="#">Prev</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">Next</a></li>
                </ul>
            </div>
        </div>
        
        <!-- footer -->
        <footer>
            <?php echo \think\Request::instance()->get('page'); ?>
            <hr>
            <p>© 2017 <a href="javascript:void(0);" target="_blank">ADMIN</a></p>
        </footer>
    </div>


</body>
</html>