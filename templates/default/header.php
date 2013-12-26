<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="utf-8" />
	<title>title</title>
	<link rel="stylesheet" href="/static/css/base.css" />
	<script type="text/javascript" src="/static/js/jquery.min.js"></script>
	<script type="text/javascript" src="/static/js/modernizr.js"></script>	
</head>
<body>
	<div id="header">
		<div id="nav-top">
			<div id="logo">
			</div>
			<div class="left">
				<div class="menu-trigger">
					<div class="icon-menu">
					</div>
				</div>
				<div class="sidebar">
					<div class="sidebar-slider">
						<ul>
							<li class="nav nav-search">
								<div class="icon icon-search"></div>
								<a href="#">搜索</a>
							</li>
							<li class="nav nav-login">
								<div class="icon icon-login"></div>
								<a href="#">登陆</a>
							</li>
							<li class="nav nav-link">
								<div class="icon icon-link"></div>
								<a href="#">友链</a>
							</li>
							<li class="nav nav-about">
								<div class="icon icon-about"></div>
								<a href="#">关于</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="right">
				<div class="nav-pass<?php if($curUser != ''){echo ' hide';} ?>">
					<!--There is a bug here, a must be on one line-->
					<a class="login btn">登陆</a><a class="reg btn">注册</a>
				</div>
			</div>
		</div>
		<div id="pass-box-wrapper">
			<!--set perspective-->
			<div id="pass-box">
				<!--frontface-->
				<div id="login-box">
					<div id="login-avatar-wrapper">
						<div id="login-avatar">
							<span></span>
						</div>
						
					</div>
					<form id="login-form" method="post" action="" name="login">
						<ul>
							<li id="login-username">
								<label class="form-tip">ID</label>
								<input type="text" name="u" />
							</li>
							<li id="login-pwd">
								<label class="form-tip">PW</label>
								<input type="password" name="p" />
							</li>
						</ul>
						<div id="login-auth">
							<a onclick="return false;">登陆</a>
						</div>
					</form>
					<div id="register-link">
						没有账号？<a href="#">注册</a>
					</div>
					<div class="tooltip hide">
						<div class="tooltip-arrow"></div>
						<div class="tooltip-inner">
						</div>
					</div>
				</div>
				<!--backface-->
				<div id="reg-box">
					<div id="reg-avatar-wrapper">
						<div id="reg-avatar">
							<span></span>
						</div>
						
					</div>
					<form id="reg-form" method="post" action="" name="reg">
						<ul>
							<li id="reg-email">
								<label class="form-tip">EM</label>
								<input type="text" name="e" />
							</li>
							<li id="reg-username">
								<label class="form-tip">ID</label>
								<input type="text" name="u" />
							</li>
							<li id="reg-pwd">
								<label class="form-tip">PW</label>
								<input type="password" name="p" />
							</li>
							<!--<li id="reg-repeat-pwd">
								<label class="form-tip">RE</label>
								<input type="password" name="rp" />
							</li>-->
						</ul>
						<div id="reg-auth">
							<a onclick="return false;">注册</a>
						</div>
					</form>
					<div id="back-to-login">
						返回
						<a href="#">登陆</a>
					</div>
				</div>
			</div>
		</div>
	</div>


	<script type="text/javascript">
		if($("html").hasClass("csstransforms3d")){
			$("#pass-box-wrapper").addClass("flip");
			$("#register-link a").click(function(){
				$("#pass-box").addClass("flipIt");
			});
			$("#back-to-login").click(function(){
				$("#pass-box").removeClass("flipIt");
			});
			//$("#pass-box").hover(function(){
			//$(this).addClass("flipIt");
			//},function(){
			//	$(this).removeClass("flipIt");
			//});
		} else {
			$("#pass-box-wrapper").addClass("scroll");
		}
	</script>
	<script type="text/javascript" src="/static/js/pass.js"></script>

	
	
