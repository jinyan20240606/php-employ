<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:109:"C:\Users\jinyan1\Desktop\php-employ\Pyg\my-think-php\public/../application/admin\view\goods\product-edit.html";i:1564542576;}*/ ?>
<!--_meta 作为公共模版分离出去-->
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
<script>DD_belatedPNG.fix('*');</script><![endif]-->
<!--/meta 作为公共模版分离出去-->

<link href="/static/admin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
</head>
<body>
<article class="cl pd-20">
	<form action="<?php echo url('update'); ?>" method="post" class="form form-horizontal" id="form-add">
		<input type="hidden" name="id" value="<?php echo $goods['id']; ?>">
		<div id="tab-system" class="HuiTab">
			<div class="tabBar cl">
				<span>通用信息</span>
				<!--<span>商品相册</span>-->
				<span>商品模型</span>
				<span>其他信息</span>
			</div>
			<div class="tabCon">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品名称：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" name="goods_name" id="" placeholder="控制在50个字符以内" value="<?php echo $goods['goods_name']; ?>" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品简介：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<textarea class="textarea" name="goods_remark" placeholder="控制在200个字符以内"><?php echo $goods['goods_remark']; ?></textarea>
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品分类：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<span class="select-box" style="width:150px;">
							<select name="" class="select" size="1" id="cate_one">
								<option value="0">请选择一级分类</option>
								<?php foreach($category['cate_one'] as $v): ?>
								<option value="<?php echo $v['id']; ?>" <?php if(($v['id'] == $goods['category']['pid_path'][1])): ?>selected="selected"<?php endif; ?>><?php echo $v['cate_name']; ?></option>
								<?php endforeach; ?>
							</select>
						</span>
						<span class="select-box" style="width:150px;">
							<select name="" class="select" size="1" id="cate_two">
								<option value="0">请选择二级分类</option>
								<?php foreach($category['cate_two'] as $v): ?>
								<option value="<?php echo $v['id']; ?>" <?php if(($v['id'] == $goods['category']['pid_path'][2])): ?>selected="selected"<?php endif; ?>><?php echo $v['cate_name']; ?></option>
								<?php endforeach; ?>
							</select>
						</span>
						<span class="select-box" style="width:150px;">
							<select name="cate_id" class="select" size="1" id="cate_three">
								<option value="0">请选择三级分类</option>
								<?php foreach($category['cate_three'] as $v): ?>
								<option value="<?php echo $v['id']; ?>" <?php if(($v['id'] == $goods['cate_id'])): ?>selected="selected"<?php endif; ?>><?php echo $v['cate_name']; ?></option>
								<?php endforeach; ?>
							</select>
						</span>
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品品牌：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<span class="select-box" style="width:150px;">
							<select name="brand_id" class="select" size="1" id="brand">
								<option value="0">请选择商品品牌</option>
								<?php foreach($goods['category']['brands'] as $v): ?>
								<option value="<?php echo $v['id']; ?>" <?php if(($v['id'] == $goods['brand_id'])): ?>selected="selected"<?php endif; ?>><?php echo $v['name']; ?></option>
								<?php endforeach; ?>
							</select>
						</span>
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品价格：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" name="goods_price" id="website-Keywords" placeholder="" value="<?php echo $goods['goods_price']; ?>" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red"></span>市场价：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" name="market_price" id="" placeholder="" value="<?php echo $goods['market_price']; ?>" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red"></span>成本价：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" name="cost_price" id="" placeholder="" value="<?php echo $goods['cost_price']; ?>" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red"></span>logo图片：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<div class="uploader-thum-container">
							<div id="fileList" class="uploader-list"></div>
							<div id="filePicker">选择图片</div>
							<button id="btn-star" class="btn btn-default btn-uploadstar radius ml-10">开始上传</button>
							<input type="hidden" id="goods_logo" name="goods_logo" value="<?php echo $goods['goods_logo']; ?>">
						</div>
						<!--<span class="btn-upload form-group">
							<input class="input-text upload-url" type="text" name="uploadfile-2" id="uploadfile-2" readonly  datatype="*" nullmsg="请添加附件！" style="width:200px">
							<a href="javascript:void(0);" class="btn btn-primary upload-btn"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
							<input type="file" name="goods_logo" class="input-file">
						</span>-->
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>是否包邮：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<div class="radio-box">
							<input name="is_free_shipping" type="radio" id="nav-1" value="1" <?php if(($goods['is_free_shipping'] == '1')): ?>checked<?php endif; ?>>
							<label for="nav-1">是</label>
						</div>
						<div class="radio-box">
							<input name="is_free_shipping" type="radio" id="nav-2" value="0" <?php if(($goods['is_free_shipping'] == '0')): ?>checked<?php endif; ?>>
							<label for="nav-2">否</label>
						</div>
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red"></span>运费模板：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<span class="select-box" style="width:150px;">
							<select name="mould_id" class="select" size="1" id="">
								<option value="0">选择运费模板</option>
								<option value="1">以件计算</option>
								<option value="2">以体积计算</option>
								<option value="3">以重量计算</option>
							</select>
						</span>
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red"></span>商品重量：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" name="weight" id="" placeholder="务必设置商品重量, 用于计算物流费.以克为单位" value="" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red"></span>商品体积：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" name="volume" id="" placeholder="务必设置商品体积, 用于计算物流费.以立方米为单位" value="" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red"></span>总库存：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" name="goods_number" id="" placeholder="" value="<?php echo $goods['goods_number']; ?>" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red"></span>关键词：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" name="keywords" id="" placeholder="多个关键词，用空格隔开" value="<?php echo $goods['keywords']; ?>" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red"></span>详情描述：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<textarea name="goods_desc" id="editor" placeholder="" class="">
							<?php echo $goods['goods_desc']; ?>
						</textarea>
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">原相册图片：</label>
					<div class="goods_images" style="display: none;"></div>
					<div class="formControls col-xs-8 col-sm-9" >
						<?php foreach($goods['goods_images'] as $v): ?>
						<span>
						<img src="<?php echo $v['pics_sma']; ?>" style="max-width:200px;max-height:200px;"><a href="javascript:;" class="delpics" pics_id="<?php echo $v['id']; ?>">[-]</a>
						</span>
						<?php endforeach; ?>
					</div>
					<label class="form-label col-xs-4 col-sm-2"><a href="javascript:void(0);" class="add_file">[+]</a>相册图片：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<div class="uploader-list-container">
							<div class="queueList">
								<div id="dndArea" class="placeholder">
									<div id="filePicker-2"></div>
									<p>将照片拖到这里，单次最多可选300张</p>
								</div>
							</div>
							<div class="statusBar" style="display:none;">
								<div class="progress"> <span class="text">0%</span> <span class="percentage"></span> </div>
								<div class="info"></div>
								<div class="btns">
									<div id="filePicker2"></div>
									<div class="uploadBtn">开始上传</div>
								</div>
							</div>
						</div>
						<!--<span class="btn-upload form-group">-->
						<!--<input class="input-text upload-url" type="text" name="uploadfile-22" id="uploadfile-22" readonly  datatype="*" nullmsg="请添加附件！" style="width:200px">-->
						<!--<a href="javascript:void(0);" class="btn btn-primary upload-btn"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>-->
						<!--<input type="file" name="goods_image[]" class="input-file">-->
						<!--</span>-->
					</div>
				</div>
			</div>
			<!--<div class="tabCon">
			</div>-->
			<div class="tabCon">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">*<span class="c-red"></span>商品模型：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<span class="select-box" style="width:150px;">
							<select name="type_id" class="select" size="1" id="goods_type">
								<option value="0">选择商品模型</option>
								<?php foreach($type as $v): ?>
								<option value="<?php echo $v['id']; ?>" <?php if(($v['id'] == $goods['type_id'])): ?>selected<?php endif; ?>><?php echo $v['type_name']; ?></option>
								<?php endforeach; ?>
							</select>
						</span>
					</div>
				</div>
				<div class="row cl">
					<!-- ajax 返回规格-->
					<div id="ajax_spec_data" class="col-xs-8">
						<table class="table table-border table-bordered table-bg table-sort" id="goods_spec_table1">
							<tbody>
								<tr>
									<td colspan="2"><b>商品规格:</b></td>
								</tr>
								<?php foreach($goods['type']['specs'] as $v): ?>
								<tr class="spec_name" spec_id="<?php echo $v['id']; ?>">
									<td spec_name="<?php echo $v['spec_name']; ?>"><?php echo $v['spec_name']; ?></td>
									<td >
										<?php foreach($v['spec_values'] as $value): ?>
										<button type="button" spec_value_id="<?php echo $value['id']; ?>" class="btn <?php if(in_array(($value['id']), is_array($goods['value_ids'])?$goods['value_ids']:explode(',',$goods['value_ids']))): ?>btn-success<?php else: ?>btn-default<?php endif; ?>"><?php echo $value['spec_value']; ?></button>
										<?php endforeach; ?>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						<div id="goods_spec_table2">
							<table class="table table-border table-bordered table-bg table-sort" id="spec_input_tab">
								<tbody>
									<tr>
										<?php foreach($goods['type']['specs'] as $v): ?>
										<td><b><?php echo $v['spec_name']; ?></b></td>
										<?php endforeach; ?>
										<td><b>购买价</b></td>
										<td><b>成本价</b></td>
										<td><b>库存</b></td>
										<td><b>操作</b></td>
									</tr>
									<?php foreach($goods['spec_goods'] as $v): ?>
									<tr>
										<?php foreach($v['spec_values'] as $value): ?>
										<td><?php echo $value['spec_value']; ?></td>
										<?php endforeach; ?>
										<td>
											<input class="item_price" name="item[<?php echo $v['value_ids']; ?>][price]" value="<?php echo $v['price']; ?>">
											<input type="hidden" name="item[<?php echo $v['value_ids']; ?>][value_names]" value="<?php echo $v['value_names']; ?>">
											<input type="hidden" name="item[<?php echo $v['value_ids']; ?>][value_ids]" value="<?php echo $v['value_ids']; ?>">
										</td>
										<td><input class="item_cost_price" name="item[<?php echo $v['value_ids']; ?>][cost_price]" value="<?php echo $v['cost_price']; ?>"></td>
										<td><input class="item_store_count" name="item[<?php echo $v['value_ids']; ?>][store_count]" value="<?php echo $v['store_count']; ?>"></td>
										<td><button type="button" class="btn btn-default delete_item">移除</button></td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>

					</div>
					<div class="col-xs-4">
						<table class="table table-border table-bordered table-bg table-sort" id="goods_attr_table">
							<tbody>
								<tr>
									<td colspan="2"><b>商品属性</b>：  </td>
								</tr>
								<?php foreach($goods['type']['attrs'] as $v): ?>
								<tr class="attr_name" attr_id="<?php echo $v['id']; ?>">
									<td attr_name="<?php echo $v['attr_name']; ?>"><?php echo $v['attr_name']; ?>：</td>
									<td>
										<input type="hidden" name="attr[<?php echo $v['id']; ?>][attr_name]" value="<?php echo $v['attr_name']; ?>">
										<input type="hidden" name="attr[<?php echo $v['id']; ?>][id]" value="<?php echo $v['id']; ?>">
										<?php if((empty($v['attr_values']))): ?>
										<input type="text" name="attr[<?php echo $v['id']; ?>][attr_value]" value="<?php echo $goods['goods_attr'][$v['id']]['attr_value']; ?>" class="input-text">
										<?php else: ?>
										<select name="attr[<?php echo $v['id']; ?>][attr_value]" class="select">
											<option value="">请选择</option>
											<?php foreach($v['attr_values'] as $value): ?>
											<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
											<?php endforeach; ?>
										</select>
										<?php endif; ?>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="tabCon">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品分佣比：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" name="rate" id="" placeholder="0~0.25之间" value="0.1" class="input-text">
					</div>
				</div>
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
				<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
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
<script type="text/javascript" src="/static/admin/lib/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="/static/admin/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/static/admin/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/static/admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
$(function(){
	$('.HuiTab').Huitab();
	//商品分类
	$('#cate_one').change(function(){
		var pid = $(this).val();
		$.ajax({
			'url':'<?php echo url("category/getSubCateByPid"); ?>',
			'type':'post',
			'data':{'pid':pid},
			'dataType':'json',
			'success':function(response){
				if(response.code != 10000){
					alert(response.msg);return;
				}
				var str = '<option value="">请选择二级分类</option>';
				$.each(response.data, function(i,v){
					str += '<option value="' + v.id + '">' + v.cate_name + '</option>';
				});
				$('#cate_two').html(str);
			}
		});
	});
	$('#cate_two').change(function(){
		var pid = $(this).val();
		$.ajax({
			'url':'<?php echo url("category/getSubCateByPid"); ?>',
			'type':'post',
			'data':{'pid':pid},
			'dataType':'json',
			'success':function(response){
				if(response.code != 10000){
					alert(response.msg);return;
				}
				var str = '<option value="">请选择三级分类</option>';
				$.each(response.data, function(i,v){
					str += '<option value="' + v.id + '">' + v.cate_name + '</option>';
				});
				$('#cate_three').html(str);
			}
		});
	});
	$('#cate_three').change(function(){
		var cate_id = $(this).val();
		$.ajax({
			'url':'<?php echo url("brand/getBrandByCateId"); ?>',
			'type':'post',
			'data':{'cate_id':cate_id},
			'dataType':'json',
			'success':function(response){
				if(response.code != 10000){
					alert(response.msg);return;
				}
				var str = '<option value="">请选择商品品牌</option>';
				$.each(response.data, function(i,v){
					str += '<option value="' + v.id + '">' + v.name + '</option>';
				});
				$('#brand').html(str);
			}
		});
	});
	//商品模型
	$('#goods_type').change(function(){
		//获取选中类型的id
		var type_id = $(this).val();
		if(type_id == '') return;
		//发送ajax请求
		$.ajax({
			'url':"<?php echo url('type/getSpecAttr'); ?>",
			'type':'post',
			'data':{'type_id':type_id},
			'dataType':'json',
			'success':function(response){
				if(response.code != 200){
					alert(response.msg);
					return;
				}
				//根据获取的数据，拼接html代码，显示到页面
				var attrs =response.data.attrs;
				var specs =response.data.specs;
				//遍历数组，一条一条数据拼接处理
				var spec_html = '<tr><td colspan="2">商品规格</td></tr>';
				$.each(specs, function(i, v){
					//i 是数组中的索引，v是一条数据（json格式对象）
					//属性名称
					spec_html += '<tr class="spec_name" spec_id="'+v.id+'">';
					spec_html += '<td spec_name="' + v.spec_name + '">' + v.spec_name + '：</td>';
					spec_html += '<td>';
					$.each(v.spec_values, function(index,value){
						spec_html += '<button type="button" spec_value_id="' + value.id + '" class="btn btn-default">' + value.spec_value + '</button> ';
					});
					spec_html += '</td>';
					spec_html += '</tr>';
				});
				//将拼接好的html字符串，放到页面显示
				$('#goods_spec_table1').find('tbody').html(spec_html);

				var attrs_html = '<tr><td colspan="2"><b>商品属性</b>：  </td></tr>';
				$.each(attrs, function(i, v){
					//i 是数组中的索引，v是一条数据（json格式对象）
					//属性名称
					attrs_html += '<tr class="attr_name" attr_id="'+v.id+'">';
					attrs_html += '<td attr_name="' + v.attr_name + '">' + v.attr_name + '：</td>';
					attrs_html += '<td><input type="hidden" name="attr['+v.id+'][attr_name]" value="'+v.attr_name+'"><input type="hidden" name="attr['+v.id+'][id]" value="'+v.id+'">';
					if(v.attr_values.length == 0){
						attrs_html += '<input type="text" name="attr['+v.id+'][attr_value]" value="" class="input-text">';
					}else{
						attrs_html += '<select name="attr['+v.id+'][attr_value]" class="select"><option value="">请选择</option>';
						$.each(v.attr_values, function(index,value){
							attrs_html += '<option value="' + value + '">' + value + '</option>';
						});
						attrs_html += '</select>';
					}

					attrs_html += '</td>';
					attrs_html += '</tr>';
				});
				//将拼接好的html字符串，放到页面显示
				$('#goods_attr_table').find('tbody').html(attrs_html);
			}
		});
	});
	//商品相册
	$('.delpics').click(function(){
        var _this = this;
        //发送ajax请求
        $.ajax({
            'url':'<?php echo url("admin/goods/delpics"); ?>',
            'type':'post',
            'data':{'pics_id':$(this).attr('pics_id')},
            'dataType':'json',
            'success':function(response){
                console.log(response);
                if(response.code != 10000){
                    alert(response.msg);
                    return;
                }
                //删除成功，将当前图片从页面移除
                $(_this).parent().remove();
            }
        });
    });
	UE.getEditor('editor');
	$("#form-add").validate({
		rules:{
			goods_name:{
				required:true,
				minlength:4,
				maxlength:16
			}
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
<script>
	// 当domReady的时候开始初始化
	$(function() {
		var $wrap = $('.uploader-list-container'),
				// 图片容器
				$queue = $( '<ul class="filelist"></ul>' ).appendTo( $wrap.find( '.queueList' ) ),
				// 状态栏，包括进度和控制按钮
				$statusBar = $wrap.find( '.statusBar' ),
				// 文件总体选择信息。
				$info = $statusBar.find( '.info' ),
				// 上传按钮
				$upload = $wrap.find( '.uploadBtn' ),
				// 没选择文件之前的内容。
				$placeHolder = $wrap.find( '.placeholder' ),
				$progress = $statusBar.find( '.progress' ).hide(),
				// 添加的文件数量
				fileCount = 0,
				// 添加的文件总大小
				fileSize = 0,
				// 优化retina, 在retina下这个值是2
				ratio = window.devicePixelRatio || 1,
				// 缩略图大小
				thumbnailWidth = 110 * ratio,
				thumbnailHeight = 110 * ratio,
				// 可能有pedding, ready, uploading, confirm, done.
				state = 'pedding',
				// 所有文件的进度信息，key为file id
				percentages = {},
				// 判断浏览器是否支持图片的base64
				isSupportBase64 = ( function() {
					var data = new Image();
					var support = true;
					data.onload = data.onerror = function() {
						if( this.width != 1 || this.height != 1 ) {
							support = false;
						}
					}
					data.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
					return support;
				} )(),
				// 检测是否已经安装flash，检测flash的版本
				flashVersion = ( function() {
					var version;
					try {
						version = navigator.plugins[ 'Shockwave Flash' ];
						version = version.description;
					} catch ( ex ) {
						try {
							version = new ActiveXObject('ShockwaveFlash.ShockwaveFlash')
									.GetVariable('$version');
						} catch ( ex2 ) {
							version = '0.0';
						}
					}
					version = version.match( /\d+/g );
					return parseFloat( version[ 0 ] + '.' + version[ 1 ], 10 );
				} )(),
				supportTransition = (function(){
					var s = document.createElement('p').style,
							r = 'transition' in s ||
									'WebkitTransition' in s ||
									'MozTransition' in s ||
									'msTransition' in s ||
									'OTransition' in s;
					s = null;
					return r;
				})(),
				// WebUploader实例
				uploader;

		if ( !WebUploader.Uploader.support('flash') && WebUploader.browser.ie ) {

			// flash 安装了但是版本过低。
			if (flashVersion) {
				(function(container) {
					window['expressinstallcallback'] = function( state ) {
						switch(state) {
							case 'Download.Cancelled':
								alert('您取消了更新！')
								break;

							case 'Download.Failed':
								alert('安装失败')
								break;

							default:
								alert('安装已成功，请刷新！');
								break;
						}
						delete window['expressinstallcallback'];
					};

					var swf = 'expressInstall.swf';
					// insert flash object
					var html = '<object type="application/' +
							'x-shockwave-flash" data="' +  swf + '" ';

					if (WebUploader.browser.ie) {
						html += 'classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" ';
					}

					html += 'width="100%" height="100%" style="outline:0">'  +
							'<param name="movie" value="' + swf + '" />' +
							'<param name="wmode" value="transparent" />' +
							'<param name="allowscriptaccess" value="always" />' +
							'</object>';

					container.html(html);

				})($wrap);

				// 压根就没有安转。
			} else {
				$wrap.html('<a href="http://www.adobe.com/go/getflashplayer" target="_blank" border="0"><img alt="get flash player" src="http://www.adobe.com/macromedia/style_guide/images/160x41_Get_Flash_Player.jpg" /></a>');
			}

			return;
		} else if (!WebUploader.Uploader.support()) {
			alert( 'Web Uploader 不支持您的浏览器！');
			return;
		}

		// 实例化
		uploader = WebUploader.create({
			pick: {
				id: '#filePicker-2',
				label: '选择图片'
			},
			dnd: '#dndArea',
			swf: '/static/admin/lib/webuploader/0.1.5/Uploader.swf',
			server: '<?php echo url("admin/upload/image"); ?>',
			// runtimeOrder: 'flash',

			 accept: {
			     title: 'Images',
			     extensions: 'gif,jpg,jpeg,png',
			     mimeTypes: 'image/*'
			 },

			// 禁掉全局的拖拽功能。这样不会出现图片拖进页面的时候，把图片打开。
			disableGlobalDnd: true,
			fileNumLimit: 300,
			fileSizeLimit: 200 * 1024 * 1024,    // 200 M
			fileSingleSizeLimit: 50 * 1024 * 1024,    // 50 M
            fileVal:'image',
            formData: {
				image_type: 'goods'
            }
		});

		// 拖拽时不接受 js, txt 文件。
		uploader.on( 'dndAccept', function( items ) {
			var denied = false,
					len = items.length,
					i = 0,
					// 修改js类型
					unAllowed = 'text/plain;application/javascript ';

			for ( ; i < len; i++ ) {
				// 如果在列表里面
				if ( ~unAllowed.indexOf( items[ i ].type ) ) {
					denied = true;
					break;
				}
			}

			return !denied;
		});

		uploader.on('dialogOpen', function() {
			console.log('here');
		});

		// uploader.on('filesQueued', function() {
		//     uploader.sort(function( a, b ) {
		//         if ( a.name < b.name )
		//           return -1;
		//         if ( a.name > b.name )
		//           return 1;
		//         return 0;
		//     });
		// });

		// 添加“添加文件”的按钮，
		uploader.addButton({
			id: '#filePicker2',
			label: '继续添加'
		});

		uploader.on('ready', function() {
			window.uploader = uploader;
		});

		// 当有文件添加进来时执行，负责view的创建
		function addFile( file ) {
			var $li = $( '<li id="' + file.id + '">' +
							'<p class="title">' + file.name + '</p>' +
							'<p class="imgWrap"></p>'+
							'<p class="progress"><span></span></p>' +
							'</li>' ),

					$btns = $('<div class="file-panel">' +
							'<span class="cancel">删除</span>' +
							'<span class="rotateRight">向右旋转</span>' +
							'<span class="rotateLeft">向左旋转</span></div>').appendTo( $li ),
					$prgress = $li.find('p.progress span'),
					$wrap = $li.find( 'p.imgWrap' ),
					$info = $('<p class="error"></p>'),

					showError = function( code ) {
						switch( code ) {
							case 'exceed_size':
								text = '文件大小超出';
								break;

							case 'interrupt':
								text = '上传暂停';
								break;

							default:
								text = '上传失败，请重试';
								break;
						}

						$info.text( text ).appendTo( $li );
					};

			if ( file.getStatus() === 'invalid' ) {
				showError( file.statusText );
			} else {
				// @todo lazyload
				$wrap.text( '预览中' );
				uploader.makeThumb( file, function( error, src ) {
					var img;

					if ( error ) {
						$wrap.text( '不能预览' );
						return;
					}

					if( isSupportBase64 ) {
						img = $('<img src="'+src+'">');
						$wrap.empty().append( img );
					} else {
						$.ajax('lib/webuploader/0.1.5/server/preview.php', {
							method: 'POST',
							data: src,
							dataType:'json'
						}).done(function( response ) {
							if (response.result) {
								img = $('<img src="'+response.result+'">');
								$wrap.empty().append( img );
							} else {
								$wrap.text("预览出错");
							}
						});
					}
				}, thumbnailWidth, thumbnailHeight );

				percentages[ file.id ] = [ file.size, 0 ];
				file.rotation = 0;
			}

			file.on('statuschange', function( cur, prev ) {
				if ( prev === 'progress' ) {
					$prgress.hide().width(0);
				} else if ( prev === 'queued' ) {
					$li.off( 'mouseenter mouseleave' );
					$btns.remove();
				}

				// 成功
				if ( cur === 'error' || cur === 'invalid' ) {
					console.log( file.statusText );
					showError( file.statusText );
					percentages[ file.id ][ 1 ] = 1;
				} else if ( cur === 'interrupt' ) {
					showError( 'interrupt' );
				} else if ( cur === 'queued' ) {
					percentages[ file.id ][ 1 ] = 0;
				} else if ( cur === 'progress' ) {
					$info.remove();
					$prgress.css('display', 'block');
				} else if ( cur === 'complete' ) {
					$li.append( '<span class="success"></span>' );
				}

				$li.removeClass( 'state-' + prev ).addClass( 'state-' + cur );
			});

			$li.on( 'mouseenter', function() {
				$btns.stop().animate({height: 30});
			});

			$li.on( 'mouseleave', function() {
				$btns.stop().animate({height: 0});
			});

			$btns.on( 'click', 'span', function() {
				var index = $(this).index(),
						deg;

				switch ( index ) {
					case 0:
						uploader.removeFile( file );
						return;

					case 1:
						file.rotation += 90;
						break;

					case 2:
						file.rotation -= 90;
						break;
				}

				if ( supportTransition ) {
					deg = 'rotate(' + file.rotation + 'deg)';
					$wrap.css({
						'-webkit-transform': deg,
						'-mos-transform': deg,
						'-o-transform': deg,
						'transform': deg
					});
				} else {
					$wrap.css( 'filter', 'progid:DXImageTransform.Microsoft.BasicImage(rotation='+ (~~((file.rotation/90)%4 + 4)%4) +')');
					// use jquery animate to rotation
					// $({
					//     rotation: rotation
					// }).animate({
					//     rotation: file.rotation
					// }, {
					//     easing: 'linear',
					//     step: function( now ) {
					//         now = now * Math.PI / 180;

					//         var cos = Math.cos( now ),
					//             sin = Math.sin( now );

					//         $wrap.css( 'filter', "progid:DXImageTransform.Microsoft.Matrix(M11=" + cos + ",M12=" + (-sin) + ",M21=" + sin + ",M22=" + cos + ",SizingMethod='auto expand')");
					//     }
					// });
				}


			});

			$li.appendTo( $queue );
		}

		// 负责view的销毁
		function removeFile( file ) {
			var $li = $('#'+file.id);

			delete percentages[ file.id ];
			updateTotalProgress();
			$li.off().find('.file-panel').off().end().remove();
		}

		function updateTotalProgress() {
			var loaded = 0,
					total = 0,
					spans = $progress.children(),
					percent;

			$.each( percentages, function( k, v ) {
				total += v[ 0 ];
				loaded += v[ 0 ] * v[ 1 ];
			} );

			percent = total ? loaded / total : 0;


			spans.eq( 0 ).text( Math.round( percent * 100 ) + '%' );
			spans.eq( 1 ).css( 'width', Math.round( percent * 100 ) + '%' );
			updateStatus();
		}

		function updateStatus() {
			var text = '', stats;

			if ( state === 'ready' ) {
				text = '选中' + fileCount + '张图片，共' +
						WebUploader.formatSize( fileSize ) + '。';
			} else if ( state === 'confirm' ) {
				stats = uploader.getStats();
				if ( stats.uploadFailNum ) {
					text = '已成功上传' + stats.successNum+ '张照片至XX相册，'+
							stats.uploadFailNum + '张照片上传失败，<a class="retry" href="#">重新上传</a>失败图片或<a class="ignore" href="#">忽略</a>'
				}

			} else {
				stats = uploader.getStats();
				text = '共' + fileCount + '张（' +
						WebUploader.formatSize( fileSize )  +
						'），已上传' + stats.successNum + '张';

				if ( stats.uploadFailNum ) {
					text += '，失败' + stats.uploadFailNum + '张';
				}
			}

			$info.html( text );
		}

		function setState( val ) {
			var file, stats;

			if ( val === state ) {
				return;
			}

			$upload.removeClass( 'state-' + state );
			$upload.addClass( 'state-' + val );
			state = val;

			switch ( state ) {
				case 'pedding':
					$placeHolder.removeClass( 'element-invisible' );
					$queue.hide();
					$statusBar.addClass( 'element-invisible' );
					uploader.refresh();
					break;

				case 'ready':
					$placeHolder.addClass( 'element-invisible' );
					$( '#filePicker2' ).removeClass( 'element-invisible');
					$queue.show();
					$statusBar.removeClass('element-invisible');
					uploader.refresh();
					break;

				case 'uploading':
					$( '#filePicker2' ).addClass( 'element-invisible' );
					$progress.show();
					$upload.text( '暂停上传' );
					break;

				case 'paused':
					$progress.show();
					$upload.text( '继续上传' );
					break;

				case 'confirm':
					$progress.hide();
					$( '#filePicker2' ).removeClass( 'element-invisible' );
					$upload.text( '开始上传' );

					stats = uploader.getStats();
					if ( stats.successNum && !stats.uploadFailNum ) {
						setState( 'finish' );
						return;
					}
					break;
				case 'finish':
					stats = uploader.getStats();
					if ( stats.successNum ) {
						alert( '上传成功' );
					} else {
						// 没有成功的图片，重设
						state = 'done';
						location.reload();
					}
					break;
			}

			updateStatus();
		}

		uploader.onUploadProgress = function( file, percentage ) {
			var $li = $('#'+file.id),
					$percent = $li.find('.progress span');

			$percent.css( 'width', percentage * 100 + '%' );
			percentages[ file.id ][ 1 ] = percentage;
			updateTotalProgress();
		};

		uploader.onFileQueued = function( file ) {
			fileCount++;
			fileSize += file.size;

			if ( fileCount === 1 ) {
				$placeHolder.addClass( 'element-invisible' );
				$statusBar.show();
			}

			addFile( file );
			setState( 'ready' );
			updateTotalProgress();
		};

		uploader.onFileDequeued = function( file ) {
			fileCount--;
			fileSize -= file.size;

			if ( !fileCount ) {
				setState( 'pedding' );
			}

			removeFile( file );
			updateTotalProgress();

		};

		uploader.on( 'all', function( type ) {
			var stats;
			switch( type ) {
				case 'uploadFinished':
					setState( 'confirm' );
					break;

				case 'startUpload':
					setState( 'uploading' );
					break;

				case 'stopUpload':
					setState( 'paused' );
					break;

			}
		});
		// 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on( 'uploadSuccess', function( file, response ) {
            if(response.code == 200){
                $('.goods_images').append('<input type="hidden" name="goods_images[]" value="'+response.data+'">');
            }
        });
		uploader.onError = function( code ) {
			alert( 'Eroor: ' + code );
		};

		$upload.on('click', function() {
			if ( $(this).hasClass( 'disabled' ) ) {
				return false;
			}

			if ( state === 'ready' ) {
				uploader.upload();
			} else if ( state === 'paused' ) {
				uploader.upload();
			} else if ( state === 'uploading' ) {
				uploader.stop();
			}
		});

		$info.on( 'click', '.retry', function() {
			uploader.retry();
		} );

		$info.on( 'click', '.ignore', function() {
			alert( 'todo' );
		} );

		$upload.addClass( 'state-' + state );
		updateTotalProgress();
	});

	//	logo图片上传
	$(function(){
		var $list = $("#fileList"),
				$btn = $("#btn-star"),
				state = "pending";

		var uploader = WebUploader.create({
			auto: true,
			swf: '/static/admin/lib/webuploader/0.1.5/Uploader.swf',

			// 文件接收服务端。
			// server: '/static/admin/lib/webuploader/0.1.5/server/fileupload.php',
			server: '<?php echo url("admin/upload/logo"); ?>',

			// 选择文件的按钮。可选。
			// 内部根据当前运行是创建，可能是input元素，也可能是flash.
			pick: '#filePicker',

			// 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
			resize: false,
			// 只允许选择图片文件。
			accept: {
				title: 'Images',
				extensions: 'gif,jpg,jpeg,bmp,png',
				mimeTypes: 'image/*'
			},
			fileVal:'logo',
            formData: {
				image_type: 'goods'
            }
		});

		uploader.on( 'fileQueued', function( file ) {
			var $li = $(
					'<div id="' + file.id + '" class="item">' +
					'<div class="pic-box"><img></div>'+
					'<div class="info">' + file.name + '</div>' +
					'<p class="state">等待上传...</p>'+
					'</div>'
			),
			$img = $li.find('img');
			$list.html( $li );

			// 创建缩略图
			// 如果为非图片文件，可以不用调用此方法。
			// thumbnailWidth x thumbnailHeight 为 100 x 100
			uploader.makeThumb( file, function( error, src ) {
				if ( error ) {
					$img.replaceWith('<span>不能预览</span>');
					return;
				}
				$img.attr( 'src', src );
			}, 100, 100 );
		});
		// 文件上传过程中创建进度条实时显示。
		uploader.on( 'uploadProgress', function( file, percentage ) {
			var $li = $( '#'+file.id ),
					$percent = $li.find('.progress-box .sr-only');

			// 避免重复创建
			if ( !$percent.length ) {
				$percent = $('<div class="progress-box"><span class="progress-bar radius"><span class="sr-only" style="width:0%"></span></span></div>').appendTo( $li ).find('.sr-only');
			}
			$li.find(".state").text("上传中");
			$percent.css( 'width', percentage * 100 + '%' );
		});

		// 文件上传成功，给item添加成功class, 用样式标记上传成功。
		uploader.on( 'uploadSuccess', function( file, response ) {
			if(response.code == 200){
				$( '#'+file.id ).addClass('upload-state-success').find(".state").text("已上传");
				$('#goods_logo').val(response.data);
			}else{
				$( '#'+file.id ).addClass('upload-state-error').find(".state").text("上传出错");
			}
		});

		// 文件上传失败，显示上传出错。
		uploader.on( 'uploadError', function( file ) {
			$( '#'+file.id ).addClass('upload-state-error').find(".state").text("上传出错");
		});

		// 完成上传完了，成功或者失败，先删除进度条。
		uploader.on( 'uploadComplete', function( file ) {
			$( '#'+file.id ).find('.progress-box').fadeOut();
		});
		uploader.on('all', function (type) {
			if (type === 'startUpload') {
				state = 'uploading';
			} else if (type === 'stopUpload') {
				state = 'paused';
			} else if (type === 'uploadFinished') {
				state = 'done';
			}

			if (state === 'uploading') {
				$btn.text('暂停上传');
			} else {
				$btn.text('开始上传');
			}
		});

		$btn.on('click', function () {
			if (state === 'uploading') {
				uploader.stop();
			} else {
				uploader.upload();
			}
		});

	});

</script>
<script>
	/** 商品规格相关 js*/
	$(function(){
		$('#goods_spec_table1').on('click', 'button',function(){
			$(this).toggleClass('btn-success').toggleClass('btn-default');
			var spec_data = {};
			$('.spec_name').find('button.btn-success').each(function(i,v){
				var index = $(v).closest('tr').index();
				var spec_id = $(v).closest('tr').attr('spec_id');
				var spec_name = $(v).closest('tr').find('td:first').attr('spec_name');
				var spec_value_id = $(v).attr('spec_value_id');
				var spec_value = $(v).text();
				if(spec_data[index] == undefined) spec_data[index] = [];
				spec_data[index].push({spec_id:spec_id,spec_name:spec_name,spec_value_id:spec_value_id, spec_value:spec_value});
			});
			var spec_arr = [];
			for(var i in spec_data){
				spec_arr.push(spec_data[i]);
			}
			//计算笛卡尔积
			var result = spec_arr[0];
			for(var i=1; i<spec_arr.length; i++){
				var temp = [];
				$.each(result, function(j,v1){
					$.each(spec_arr[i], function(k,v2){
						if($.isArray(v1)){
							v1.push(v2);
							temp.push(v1);
						}else{
							temp.push([v1, v2])
						}

					});
				});
				result = temp;
			}
			var html = '';
			//拼接第一行
			html += '<tr>';
			if($.isArray(result[0]) == false){
				html += '<td><b>' + result[0].spec_name + '</b></td>';
			}else{
				$.each(result[0],function(i,v){
					html += '<td><b>' + v.spec_name + '</b></td>';
				});
			}
			html += '<td><b>购买价</b></td>';
			html += '<td><b>成本价</b></td>';
			html += '<td><b>库存</b></td>';
			html += '<td><b>操作</b></td>';
			html += '</tr>';
			//拼接批量填充行
			html += '<tr>';
			if($.isArray(result[0]) == false){
				html += '<td><b></b></td>';
			}else{
				$.each(result[0],function(i,v){
					html += '<td><b></b></td>';
				});
			}
			html += '<td><input id="item_price" value="0"></td>';
			html += '<td><input id="item_cost_price" value="0"></td>';
			html += '<td><input id="item_store_count" value="0"></td>';
			html += '<td><button id="item_fill" type="button" class="btn btn-success">批量填充</button></td>';
			html += '</tr>';
			//继续拼接
			$.each(result,function(i,v){
				html += '<tr>';
				if($.isArray(v) == false){
					var value_ids = v.spec_value_id;
					var value_names = v.spec_name + ':' + v.spec_value;
					html += '<td>' + v.spec_value + '</td>';
				}else{
					var value_ids = '';
					var value_names = '';
					$.each(v,function(i2,v2){
						html += '<td>' + v2.spec_value + '</td>';
						value_ids += v2.spec_value_id + '_';
						value_names += v2.spec_name + ':' + v2.spec_value + ' ';
					});
					value_ids = value_ids.slice(0, -1);
					value_names = value_names.slice(0, -1);
				}
				html += '<td><input class="item_price" name="item['+value_ids+'][price]" value="0"><input type="hidden" name="item['+value_ids+'][value_names]" value="'+value_names+'"><input type="hidden" name="item['+value_ids+'][value_ids]" value="'+value_ids+'"></td>';
				html += '<td><input class="item_cost_price" name="item['+value_ids+'][cost_price]" value="0"></td>';
				html += '<td><input class="item_store_count" name="item['+value_ids+'][store_count]" value="0"></td>';
				html += '<td><button type="button" class="btn btn-default delete_item">移除</button></td>';
				html += '</tr>';
			});
			$('#spec_input_tab').find('tbody').html(html);
		});

		$('#goods_spec_table2').on('click', '#item_fill', function(){
			var item_price = $('#item_price').val();
			var item_cost_price = $('#item_cost_price').val();
			var item_store_count = $('#item_store_count').val();
			$('.item_price').val(item_price);
			$('.item_cost_price').val(item_cost_price);
			$('.item_store_count').val(item_store_count);
		});
		$('#goods_spec_table2').on('click', '.delete_item', function(){
			$(this).closest('tr').remove();
		});
	})
</script>
</body>
</html>