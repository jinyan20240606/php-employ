<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:114:"C:\Users\jinyan1\Desktop\php-employ\Pyg\my-think-php\public/../application/admin\view\brand\product-brand-add.html";i:1564542614;}*/ ?>
﻿<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="favicon.ico" >
<link rel="Shortcut Icon" href="favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/static/admin/lib/html5.js"></script>
<script type="text/javascript" src="/static/admin/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

<title>添加品牌 - 商品管理 - H-ui.admin v3.0</title>
</head>
<body>
<article class="cl pd-20">
	<form action="<?php echo url('save'); ?>" method="post" class="form form-horizontal" id="form-add" enctype="multipart/form-data">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>品牌名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="name" name="name" datatype="*2-16" nullmsg="品牌名称不能为空">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>品牌分类：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="select-box" style="width:150px;">
					<select name="" class="select" size="1" id="cate_one" data-url="<?php echo url('category/getSubCateByPid'); ?>">
						<option value="">选择一级分类</option>
						<?php foreach($categorys as $v): ?>
						<option value="<?php echo $v['id']; ?>"><?php echo $v['cate_name']; ?></option>
						<?php endforeach; ?>
					</select>
				</span>
				<span class="select-box" style="width:150px;">
					<select name="" class="select" size="1" id="cate_two">
						<option value="">选择二级分类</option>
					</select>
				</span>
				<span class="select-box" style="width:150px;">
					<select name="cate_id" class="select" size="1" id="cate_three">
						<option value="">选择三级分类</option>
					</select>
				</span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>品牌logo：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="btn-upload form-group">
					<input class="input-text upload-url" type="text" name="uploadfile-2" id="uploadfile-2" readonly  datatype="*" nullmsg="请添加附件！" style="width:200px">
					<a href="javascript:void(0);" class="btn btn-primary upload-btn"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
					<input type="file" name="logo" class="input-file">
				</span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">品牌描述：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="desc" name="desc" datatype="*2-16" nullmsg="">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">排序：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="sort" name="sort" datatype="*2-16" nullmsg="">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">品牌url：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="auth_c" name="url" datatype="*1-16" nullmsg="">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">是否热门：</label>
			<div class="formControls col-xs-8 col-sm-9 ">
				<div class="radio-box">
					<input name="is_hot" type="radio" id="nav-1" value="1" checked>
					<label for="nav-1">是</label>
				</div>
				<div class="radio-box">
					<input name="is_hot" type="radio" id="nav-2" value="0">
					<label for="nav-2">否</label>
				</div>
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<button type="submit" class="btn btn-success radius" id="save" name="admin-role-save"><i class="icon-ok"></i> 确定</button>
			</div>
		</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/static/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/admin/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/static/admin/static/h-ui.admin/js/H-ui.admin.page.js"></script>

<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/static/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/static/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/static/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/static/admin/logic/category.js"></script>
<script type="text/javascript">
$(function(){
	$("#form-add").validate({
		rules:{
			name:{
				required:true,
			},
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit(function(res){
				if(res.code == 200){
                    layer.msg('操作成功',{"icon":1,"time":"1000"},function(){
                        parent.location.reload();
                    });
				}else{
					layer.msg('操作失败:' + res.msg);
				}
			});

		}
	});
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>