<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $memberteaminfos[0]['member_username'];?>-系统登陆后台</title>
	<link href="<?php echo URL_APP;?>/css/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo URL_APP;?>/js/jquery-1.8.3.min.js"></script>
</head>
<body class="roomList">
<div class="roomInfosDiv container">
<h3>业务员修改:<?php echo $memberteaminfos[0]['member_username'];?></h3>
<form>
<input type="hidden" name="id" value="<?php echo $memberteaminfos[0]['member_id'];?>"  />
<table border="0" cellpadding="5" cellspacing="5" width="90%">	

	<tr>
		<td width="20%" align="right">业务员用户名：</td>
		<td>
		<input type="text" name="member_username" value="<?php echo $memberteaminfos[0]['member_username'];?>" />
		</td>		
	</tr>

	<tr>
		<td width="20%" align="right">业务员真名：</td>
		<td>
		<input type="text" name="member_realname" value="<?php echo $memberteaminfos[0]['member_realname'];?>" />
		</td>		
	</tr>

	<tr>
		<td width="20%" align="right">业务员密码：</td>
		<td>
		<input type="text" name="member_password" value="<?php echo $memberteaminfos[0]['member_password'];?>" />
		</td>		
	</tr>

	<tr>
		<td width="20%" align="right">业务员手机号码：</td>
		<td>
		<input type="text" name="member_telphone" value="<?php echo $memberteaminfos[0]['member_telphone'];?>" />
		</td>		
	</tr>

	<tr>
		<td width="20%" align="right">业务员电话号码</td>
		<td>
		<input type="text" name="member_phone" value="<?php echo $memberteaminfos[0]['member_phone'];?>" />
		</td>		
	</tr>

		<tr>
		<td width="20%" align="right">业务员状态：</td>
		<td>
		<select name="member_flag">
		<option value="1" <?php echo $memberteaminfos[0]['member_flag'] ? 'selected' : '';?>>开放</option>
		<option value="0" <?php echo !$memberteaminfos[0]['member_flag'] ? 'selected' : '';?>>冻结</option>
		</select>
		</td>		
	</tr>
	<tr>
		<td width="20%" align="right">&nbsp;</td>
		<td>
		<input type="submit" name="submit" value="提交修改" />
		&nbsp;&nbsp;<a href="javascript:history.go(-1);">返回</a>
		</td>		
	</tr>

</table>
</form>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$("input[name='submit']").click(function(){
		var id = $("input[name='id']").val();
		var member_username = $("input[name='member_username']").val();
		var member_realname = $("input[name='member_realname']").val();
		var member_password = $("input[name='member_password']").val();
		var member_telphone = $("input[name='member_telphone']").val();
		var member_phone = $("input[name='member_phone']").val();
		var member_flag = $("select[name='member_flag']").val();
		if(id=='' || member_username == '' || member_realname == '' || member_password == '' || member_telphone == '' || member_flag == '')
		{
			alert("请填写正确的资料");
			return false;
		}
		var url = "<?php echo URL_APP_C;?>/Memberteam/memberteamUpdateUserDeal";
		var param = {id:id,member_username:member_username,member_realname:member_realname,member_password:member_password,member_telphone:member_telphone,member_phone:member_phone,member_flag:member_flag};
		$.post(url,param, function(data){
			if(data.error)
			{
				alert(data.msg);
				return false;
			}
			window.location.href="<?php echo URL_APP_C;?>/Memberteam/memberteamListUser";
		},'json');
		return false;
	});
});
</script>
</body>
</html>
