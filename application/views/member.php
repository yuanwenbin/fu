<!DOCTYPE HTML>
<html id="loginBg">
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>系统登陆后台</title>
	<link href="<?php echo URL_APP;?>/css/member.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo URL_APP;?>/js/jquery-1.8.3.min.js"></script>
</head>
<body>
<div class="loginBox">
	&nbsp;
	<form>
	<table border="0" cellpadding="5" cellspacing="5" class="loginTxt">
	<tr>

		<td><input type="text" name="username" value="" maxlength="30" class="loginInput" /></td>
	</tr>
	<tr>

		<td><input type="password" name="password" value="" maxlength="30" class="loginInput2" /></td>
	</tr>
	<tr>

		<td>
			<input type="image" name="submit" src="<?php echo URL_APP;?>/images/loginBtnMember.png" class="loginInput3" />
					
		</td>
	</tr>
	</table>
	</form>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("input[name='submit']").click(function(){
		var username = $("input[name='username']").val();
		var password = $("input[name='password']").val();
		if(username == '' || password == '')
		{
			alert("账号和密码都不能为空!");
			return false;
		}
		var url = "<?php echo URL_APP_C;?>/Index/memberValidate";
		var param = {username:username,password:password};
		$.post(url,param,function(data){
			if(data.error)
			{
				alert(data.msg);
				return false;
			}else
			{
				window.location.href= "<?php echo URL_APP_C; ?>/Index/menus";
			}
		},'json');
		return false;	
	});

});
</script>
</body>
</html>
