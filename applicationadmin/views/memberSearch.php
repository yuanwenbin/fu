<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>系统登陆后台-默认展示信息</title>
	<link href="/css/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
</head>
<body class="defaultInfos">
<div class="container">
<h4>会员查询</h4>

<!-- bof one -->
<div class="divInfos1 searchListPos">
<form method="get" action="/Member/memberSearch">
会员身份证号:
<input type="text" name="bodyId" value="" />
&nbsp;
<input type="submit" name="submit" value="查询" />
</form>
</div>
<!-- eof one -->

<!--  bof infos -->
<br />
请在上面框中输入要查询的会员身份证号
<!--  eof infos -->
</div>
<div class="footer">
所有权归本站所有
</div>
<script type="text/javascript">
$(document).ready(function(){
	/*
	$("input[name='submit']").click(function(){
		var bodyId = $("input[name='bodyId']").val();
		if(bodyId == '')
		{
			alert("请输入要查询的用户身份证号码");
			return false;
		}
		if(bodyId.length != 15 || bodyId.length != 18)
		{
			alert("请输入正确的用户身份证号码");
			return false;
		}
		return true;
	}); */
})
</script>
</body>
</html>