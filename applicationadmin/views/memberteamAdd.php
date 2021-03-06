<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>系统登陆后台</title>
	<link href="<?php echo URL_APP;?>/css/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo URL_APP;?>/js/jquery-1.8.3.min.js"></script>
</head>
<body class="roomOpen">
<div class="container">
<h3>增加义工分组</h3>
<form action="<?php echo URL_APP_C;?>/Memberteam/memberteamAddDeal" method="post">
<table width="100%" border="0" cellpadding="5" cellspacing="0">

	<tr>
		<td width="20%" align="right"><label>义工分组名：</label></td>
		<td><input type="text" name="memberteamAdd" value="" style="width:300px;" /></td>
	</tr>

	<tr>
		<td width="20%" align="right"><label>义工登陆名：</label></td>
		<td><input type="text" name="member_username" value="" style="width:120px;" />(*)</td>
	</tr>

	<tr>
		<td width="20%" align="right"><label>义工登陆密码：</label></td>
		<td><input type="text" name="member_password" value="" style="width:120px;" />(*)</td>
	</tr>

	<tr>
		<td width="20%" align="right"><label>义工重复登陆密码：</label></td>
		<td><input type="text" name="member_password_s" value="" style="width:120px;" />(*)</td>
	</tr>

	<tr>
		<td width="20%" align="right"><label>义工真实姓名：</label></td>
		<td><input type="text" name="member_realname" value="" style="width:120px;" />(*)</td>
	</tr>

	<tr>
		<td width="20%" align="right"><label>义工手机号码：</label></td>
		<td><input type="text" name="member_telphone" value="" style="width:120px;" />(*)</td>
	</tr>

	<tr>
		<td width="20%" align="right"><label>义工电话号码：</label></td>
		<td><input type="text" name="member_phone" value="" style="width:120px;" /></td>
	</tr>
	
	<tr>
		<td width="20%" align="right">&nbsp;</td>
		<td>
		&nbsp;
		</td>
	</tr>
	<tr>
		<td width="20%" align="right">&nbsp;</td>
		<td>
		<input type="reset" name="reset" value="重置" />&nbsp;
		<input type="submit" name="submit" value="提交" />
		</td>
	</tr>
	<?php
	if($teamList) {
		foreach($teamList as $k=>$v) { ?>
		<tr>
			<td width="20%" align="right">已有分组名：</td>
			<td><?php echo $v['team_name']; ?></td>
		</tr>

	<?php
	} }
	?>
</table>
</form>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$("input[name='submit']").click(function(){
		var cate_name = $("input[name='memberteamAdd']").val();
		if(cate_name == '')
		{
			alert("请输入内容");
			return false;
		}
		var member_username = $("input[name='member_username']").val();
		var member_password = $("input[name='member_password']").val();
		var member_password_s = $("input[name='member_password_s']").val();
		var member_realname = $("input[name='member_realname']").val();
		var member_telphone = $("input[name='member_telphone']").val();
		if(member_username == '')
		{
			alert("用记名不能为空");
			return false;
		}
		if(member_password == '')
		{
			alert("密码不能为空");
			return false;
		}

		if(member_password != member_password_s)
		{
			alert("丙次密码不同");
			return false;
		}

		if(member_realname == '')
		{
			alert("真实姓名不能为空");
			return false;
		}
		if(member_telphone == '')
		{
			alert("手机号码不能为空");
			return false;
		}
		return true;

	});
});
</script>
</body>
</html>
