<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:120:"C:\Users\jinyan1\Desktop\php-employ\Pyg\my-think-php\public/../application/admin\view\category\product-category-add.html";i:1564542614;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<!--[if lt IE 9]>
	<script type="text/javascript" src="/static/admin/lib/html5.js"></script>
	<script type="text/javascript" src="/static/admin/lib/respond.min.js"></script>
	<![endif]-->
	<link href="/static/admin/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
	<link href="/static/admin/static/h-ui.admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
	<!--<link href="/static/admin/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />-->
	<link href="/static/admin/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
	<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui.admin/css/style.css" />
	<!--[if IE 6]>
	<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
	<script>DD_belatedPNG.fix('*');</script><![endif]-->
	<title>添加产品分类</title>
</head>
<body>
<article class="cl pd-20">
		<form action="<?php echo url('save'); ?>" method="post" class="form form-horizontal" id="form-add">
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>分类名称：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="" placeholder="" name="cate_name">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>上级分类：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<span class="select-box" style="width:150px;">
						<select name="pid" class="select" size="1">
							<option value="0">作为顶级分类</option>
							<?php foreach($p_cate as $v): ?>
							<option value="<?php echo $v['id']; ?>" <?php if(($v['id'] == $pid)): ?>selected="selected"<?php endif; ?>><?php echo str_repeat('&emsp;', $v['level']*2); ?><?php echo $v['cate_name']; ?></option>
							<?php endforeach; ?>
						</select>
					</span>
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>排序：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="50" placeholder="" name="sort">
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否热门：</label>
				<div class="formControls col-xs-8 col-sm-9 ">
					<div class="radio-box">
						<input name="is_hot" type="radio" id="hot-1" value="1" checked>
						<label for="hot-1">是</label>
					</div>
					<div class="radio-box">
						<input name="is_hot" type="radio" id="hot-2" value="0">
						<label for="hot-2">否</label>
					</div>
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否显示：</label>
				<div class="formControls col-xs-8 col-sm-9 ">
					<div class="radio-box">
						<input name="is_show" type="radio" id="show-1" value="1" checked>
						<label for="show-1">是</label>
					</div>
					<div class="radio-box">
						<input name="is_show" type="radio" id="show-2" value="0">
						<label for="show-2">否</label>
					</div>
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>分类logo：</label>
				<div class="formControls col-xs-8 col-sm-9">
				<span class="btn-upload form-group">
					<input class="input-text upload-url" type="text" name="uploadfile-2" id="uploadfile-2" readonly  datatype="*" nullmsg="请添加附件！" style="width:200px">
					<a href="javascript:void(0);" class="btn btn-primary upload-btn"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
					<input type="file" name="logo" class="input-file">
				</span>
				</div>
			</div>
			<div class="row cl">
				<div class="col-9 col-offset-2">
					<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
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
	<script type="text/javascript">
		$(function(){
			$("#form-add").validate({
				rules:{
					cate_name:{
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
</body>
</html>