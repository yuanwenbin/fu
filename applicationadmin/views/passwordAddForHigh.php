<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>系统登陆后台</title>
	<link href="/css/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
</head>
<body class="roomList">
<div class="roomListInfos container">
<h3 class="headerLineBackground">高端密码设置</h3>
<form action="/Password/passwordAddForHighDeal" method="post" onSubmit="return checkPassword();">
<table border="0" cellspacing="0" cellpadding="0" width="98%">
	<tr>
		<td>
		&nbsp;&nbsp;<input  type="text" name="randPassword" value="" />
		</td>
	</tr>
		<tr>
		<td>
		&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="提交" />
		</td>
	</tr>
</table>
</form>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$("input[name='submit']").click(function(){
		var randPass = $("input[name='randPassword']").val();
		if(randPass == '')
		{
			alert("请输入新密码");
			return false;
		}
		return true;	
	});

});
</script>
</body>
</html>
