<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"E:\phpStudy\WWW\tpshop\public/../application/api\view\index\index.html";i:1562683761;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="/static/admin/js/jquery-1.8.1.min.js"></script>
</head>
<body>
<input type="button" id="index" value="index">
<input type="button" id="create" value="create">
<input type="button" id="save" value="save">
<input type="button" id="read" value="read">
<input type="button" id="edit" value="edit">
<input type="button" id="update" value="update">
<input type="button" id="delete" value="delete">
<script>
    $(function(){
        $('#index').click(function(){
            $.ajax({
                "url":"<?php echo url('api/goods/index'); ?>",
                "type":"get",
                "data":"",
                "dataType":"json",
                "success":function(res){
                    console.log(res);
                }
            });
        });
        $('#create').click(function(){
            $.ajax({
                "url":"<?php echo url('api/goods/create'); ?>",
                "type":"get",
                "data":"",
                "dataType":"json",
                "success":function(res){
                    console.log(res);
                }
            });
        });
        $('#save').click(function(){
            $.ajax({
                "url":"<?php echo url('api/goods/save'); ?>",
                "type":"post",
                "data":"",
                "dataType":"json",
                "success":function(res){
                    console.log(res);
                }
            });
        });
        $('#read').click(function(){
            $.ajax({
                "url":"<?php echo url('api/goods/read', ['id' => 33]); ?>",
                "type":"get",
                "data":"",
                "dataType":"json",
                "success":function(res){
                    console.log(res);
                }
            });
        });
        $('#edit').click(function(){
            $.ajax({
                "url":"<?php echo url('api/goods/edit', ['id' => 33]); ?>",
                "type":"get",
                "data":"",
                "dataType":"json",
                "success":function(res){
                    console.log(res);
                }
            });
        });
        $('#update').click(function(){
            $.ajax({
                "url":"<?php echo url('api/goods/update', ['id' => 33]); ?>",
                "type":"put",
                "data":"",
                "dataType":"json",
                "success":function(res){
                    console.log(res);
                }
            });
        });
        $('#delete').click(function(){
            $.ajax({
                "url":"<?php echo url('api/goods/delete', ['id' => 33]); ?>",
                "type":"delete",
                "data":"",
                "dataType":"json",
                "success":function(res){
                    console.log(res);
                }
            });
        });
    });
</script>
</body>
</html>