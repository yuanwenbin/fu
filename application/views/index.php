<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登陆页面</title>
<meta name="keywords" content="seo keyword" />
<meta name="description" content="description" />
<link type="text/css" rel="stylesheet" href="<?php echo URL_APP;?>/css/style.css">
<script src="<?php echo URL_APP;?>/js/jquery-1.8.3.min.js" type="text/javascript"></script>
</head>
<body class="bodyLogin">
<div class="login">
<form method="post" action="<?php echo URL_APP_C;?>/Index/login">
	<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td align="center"><input type="text" name="bodyId" value="" class="bodyId" /></td>
	</tr>
	<tr>
		<td align="center"><p class="loginTips">
		<a href="<?php echo URL_APP_C;?>/Index/logout">清空信息</a>&nbsp;&nbsp;
		<a href="<?php echo URL_APP_C;?>/Index/menus">菜单中心</a>
		</p></td>
	</tr>
	<tr>
		<td  align="center"><input type="image" name="submit" src="<?php echo URL_APP;?>/images/loginBtn.png" /></td>
	</tr>
	
	</table>
</form>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("input[name='submit']").click(function(){
		var bodyId = $("input[name='bodyId']").val();
		
		if(bodyId == '')
		{
			alert("请填写身份证号!");
			return false;
		}
		if(bodyId.length != 15 && bodyId.length != 18)
		{
			alert("请填写正确的身份证号!");
			return false;
		}
		
	});
});
</script>
</body>
</html>