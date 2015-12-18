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
		<div class="menusBottomRight"><a href="/Membersteam/index" class="myBack">管理后台</a></div>
		<br class="clearBoth" />
	</div>
	
</div>
<script type="text/javascript">
$(document).ready(function(){
	$(".myBack").click(function(){
		alert("非管理员，无权访问");
		return false;
	});
});
</script>
</body>
</html>
