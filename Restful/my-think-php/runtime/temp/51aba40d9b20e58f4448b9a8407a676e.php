<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"E:\phpStudy\WWW\tpshop\public/../application/admin\view\login\login.html";i:1562635348;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登录</title>
    <link href="/static/admin/css/login.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        .login-bg{
            background: url(/static/admin/img/login-bg-3.jpg) no-repeat center center fixed;
            background-size: 100% 100%;
        }
    </style>
    <script src='/static/admin/js/jquery-3.1.1.min.js'></script>
</head>
  
<body class="login-bg">
    <div class="login-box">
        <header>
            <h1>后台管理系统</h1>
        </header>
        <div class="login-main">
			<form action="<?php echo \think\Request::instance()->url(); ?>" class="form" method="post">
				<div class="form-item">
					<label class="login-icon">
						<i></i>
					</label>
					<input type="text" id='username' name="username" placeholder="这里输入登录名" required>
				</div>
                <div class="form-item">
                    <label class="login-icon">
                        <i></i>
                    </label>
                    <input type="password" id="password" name="password" placeholder="这里输入密码">
                </div>
                <div class="form-item verify">
                    <label class="login-icon">
                        <i></i>
                    </label>
                    <input type="text" id='verify' class="pull-left" name="code" placeholder="这里输入验证码">
                    <img class="pull-right" src="<?php echo captcha_src('login'); ?>" onclick="this.src='<?php echo captcha_src('login'); ?>?'+ Math.random()">
                    <div class="clear"></div>
                </div>
				<div class="form-item">
					<button type="button" class="login-btn">
						登&emsp;&emsp;录
					</button>
				</div>
			</form>
            <div class="msg"></div>
		</div>
    </div>
    <script type="text/javascript">
        $(function(){
            $('.login-btn').on('click',function(evt){
                if($('#username').val() == ''){
                    $('.msg').html('登录名不能为空');
                    return;
                }
                if($('#password').val() == ''){
                    $('.msg').html('密码不能为空');
                    return;
                }
                if($('#verify').val() == ''){
                    $('.msg').html('验证码不能为空');
                    return;
                }
                $('form').submit();

            });

        });
    </script>
</body>
</html>
