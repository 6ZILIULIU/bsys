<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>后台管理系统</title>
	<link rel="stylesheet" type="text/css" href="/bsys/Public/jquery-easyui-1.7.0/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="/bsys/Public/jquery-easyui-1.7.0/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="/bsys/Public/jquery-easyui-1.7.0/themes/color.css">
	<link rel="stylesheet" type="text/css" href="/bsys/Public/static/css/common.css">

	<script type="text/javascript" src="/bsys/Public/jquery-easyui-1.7.0/jquery.min.js"></script>
	<script type="text/javascript" src="/bsys/Public/jquery-easyui-1.7.0/jquery.easyui.min.js"></script>
	<style>
		a{
			text-decoration:none;
			color:#dcdee0;
		}
		body{
			background-image: url("/bsys/Public/static/img/login.jpg");
		}
		/* .wrap{
			width:380px;
			height
		} */
	</style>
	<script>
			$(function(){
				onkeypress = function(){
					if(13 == event.keyCode){
						submitForm();
					}
				}

				$('#user').textbox({
                        // buttonText:'Search',
                        iconCls:'icon-man',
                        iconAlign:'left',
						prompt:'Account or Email Address'
                    })
				$('#pswd').passwordbox({
					prompt: 'Password',
					showEye: false,
					iconCls:'icon-lock',
                	iconAlign:'left'
				});

				$("input",$("#user").next("span")).focus();
			});
	</script>
</head>
<body>
	<div id="wrap" style="height:666px; width:480px;padding:36px 56px 48px;margin:170px auto;
	background: #fff;box-shadow:0 8px 16px 0px rgba(10, 14, 29, 0.04), 0px 8px 64px 0px rgba(10, 14, 29, 0.08)">
		<h1 style="text-align: center;padding-bottom: 40px;">Welcome Back</h1>
		<form id="ff" method="post" >
			<div style="margin-bottom:40px">
				<input id="user" name="userName" style="width:368px;height:60px;" >
			</div>
			<div style="margin-bottom:40px">
				<input id="pswd" name="password" style="width:368px;height:60px;">
			</div>
			<span style="float:right"><a href="#">Forget password?</a></span>
			<!-- <div style="margin-bottom:20px">
				<input class="easyui-textbox" name="subject" style="width:100%" data-options="label:'Subject:',required:true">
			</div>
			<div style="margin-bottom:20px">
				<input class="easyui-textbox" name="message" style="width:100%;height:60px" data-options="label:'Message:',multiline:true">
			</div>
			<div style="margin-bottom:20px">
				<select class="easyui-combobox" name="language" label="Language" style="width:100%"><option value="ar">Arabic</option><option value="bg">Bulgarian</option><option value="ca">Catalan</option><option value="zh-cht">Chinese Traditional</option><option value="cs">Czech</option><option value="da">Danish</option><option value="nl">Dutch</option><option value="en" selected="selected">English</option><option value="et">Estonian</option><option value="fi">Finnish</option><option value="fr">French</option><option value="de">German</option><option value="el">Greek</option><option value="ht">Haitian Creole</option><option value="he">Hebrew</option><option value="hi">Hindi</option><option value="mww">Hmong Daw</option><option value="hu">Hungarian</option><option value="id">Indonesian</option><option value="it">Italian</option><option value="ja">Japanese</option><option value="ko">Korean</option><option value="lv">Latvian</option><option value="lt">Lithuanian</option><option value="no">Norwegian</option><option value="fa">Persian</option><option value="pl">Polish</option><option value="pt">Portuguese</option><option value="ro">Romanian</option><option value="ru">Russian</option><option value="sk">Slovak</option><option value="sl">Slovenian</option><option value="es">Spanish</option><option value="sv">Swedish</option><option value="th">Thai</option><option value="tr">Turkish</option><option value="uk">Ukrainian</option><option value="vi">Vietnamese</option></select>
			</div> -->
		</form>
		<div style="text-align:center;padding:5px 0">
			<a href="javascript:void(0)" class="easyui-linkbutton" style="width:320px;height:56px;margin-top:20px;
			background: #007bfc;color: seashell;font-weight:700;font-size: 20px;" onclick="submitForm()" style="width:80px">登&#160;&#160;&#160;&#160;录</a>
			</br>
			<a href="javascript:void(0)"  onclick="register()" style="display:block;width:80px;margin-top:20px;float:right;">注册</a>
		</div>
	</div>
	<script>
		function submitForm(){
			$.ajax({
				type :"post",
				dataType:'json',
				url:"loginVerify",
				data: $('#ff').serialize(),
				success:function(r){
					// r = $.parseJSON(r);
					console.info(r);
					if(r){
						// $LoginAndRegdialog.dialog('close');
						$.messager.alert('提示','登陆成功</br>...正在为您跳转')
						setTimeout(function(){$(location).attr('href','index');}, 500);
						
					}
				},
				error:function(r){$.messager.alert('提示','用户不存在或密码错误');}
			});
		}
		function register(){
			location.href="/bsys/index.php/Admin/Login/register";
			// location.search = '?q=123';
			// location.port = "443";
			// console.log("完整URL："+location.href)
			// console.log("路径："+location.pathname)
			// console.log("主机名+端口号："+location.host)
			// console.log("主机名："+location.hostname)
			// console.log("端口号："+location.port)
			// console.log("?号后面的："+location.search)
			// console.log("#号后面的："+location.hash)
			// console.log("协议和主机地址和包括端口："+location.origin)
			// console.log("协议："+location.protocol)
			// location.replace("register"); 等于 // location.assign("register");
			
		}
	</script>
</body>
</html>