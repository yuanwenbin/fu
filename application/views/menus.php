<!DOCTYPE HTML>
<html id="loginBg">
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>系统登陆后台</title>
	<link href="/css/member.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
.userMemberinfos{text-align:center;}
	</style>
	<script src="/js/jquery-1.8.3.min.js" type="text/javascript"></script>
</head>
<body>
<div class="topBg">
<img src="/images/title_background.png" />
</div>
<div class="menusBox">
	<div class="menusTop">
		<div class="menusTopLeft"><a href="/Index/index">选号系统</a></div>
		<div class="menusTopRight"><a href="/Index/register">来访登记</a></div>
		<br class="clearBoth" />
	</div>
	<div  class="menusBottom">
		<div  class="menusBottomLeft"><a href="/Members/index">统计中心</a></div>
		<div class="menusBottomRight">
		<?php if($_SESSION['member_teamid']) { ?>
		<a href="/Index/infoList" class="myBack">管理后台</a>
		<?php }else { ?>
		
        &nbsp;
		
		<?php  }?>
		</div>
		<br class="clearBoth" />
		<div class="userMemberinfos">
		当前登陆用户：<?php echo $_SESSION['member_username'];?>&nbsp;&nbsp;
		<a href="/Index/logout">重新登陆？</a>
		</div>
	</div>
	

	
</div>
</body>
</html>
