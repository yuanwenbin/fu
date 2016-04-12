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
	<script src="<?php echo URL_APP;?>/js/jquery-1.8.3.min.js" type="text/javascript"></script>
</head>
<body>
<div class="topBg">
<img src="<?php echo URL_APP;?>/images/title_background.png" />
</div>
<div class="register">
	<form>
	<table border="0" cellspacing="0" cellpadding="0" width="100%">
		<tr>
			<td width="140" align="right" height="28">登记身份证号码&nbsp;</td>
			<td  height="28"><input type="text" name="body_id" value="" />&nbsp;</td>
		</tr>
		<tr>
			<td width="140" align="right"  height="28">手机号码&nbsp;</td>
			<td  height="28"><input type="text" name="user_telphone" value="" />&nbsp;<font>(*)</font></td>
		</tr>
		<tr>
			<td width="140" align="right"  height="28">称呼&nbsp;</td>
			<td  height="28"><input type="text" name="user_phone" value="" /></td>
		</tr>
		<tr>
			<td width="140" align="right"  height="28">有效登记时间&nbsp;</td>
			<td>
			<select name="user_dateline">
			 <option value="1">24小时</option>
			 <option value="2">10天</option>
			</select>
			</td>
		</tr>		
		<tr>
			<td width="140" align="right"  height="28">&nbsp;</td>
			<td height="28">&nbsp;
			<input type="reset" name="reset" value="重置" />&nbsp;&nbsp;
			<input type="submit" name="submit" value="提交" />&nbsp;&nbsp;
			<a href="<?php echo URL_APP_C;?>/Index/menus">菜单中心</a>
			</td>
		</tr>
	</table>
	</form>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("input[name='submit']").click(function(){
		var body_id = $("input[name='body_id']").val();
		var user_telphone = $("input[name='user_telphone']").val();
		var user_phone = $("input[name='user_phone']").val();
		/*
		if(body_id == '')
		{
			alert("身份证号码不能为空");
			return false;
		}
		if(body_id.length != 15 && body_id.length != 18)
		{
			alert("请填写正确的身份证号!");
			return false;
		} */
		if(user_telphone == '')
		{
			alert("手机号码不能为空");
			return false;
		}
		if(user_telphone.length != 11)
		{
			alert("请填写正确的手机号!");
			return false;
		}
		var myreg = /^\d{11}$/; 
	 if(!myreg.test(user_telphone)) 
	 { 
			 alert('请输入有效的手机号码！'); 
			 return false; 
	 } 
		var url = "<?php echo URL_APP_C;?>/Index/registerDeal";
		var param = {body_id:body_id,user_telphone:user_telphone,user_phone:user_phone};
		$.post(url,param,function(data){
			alert(data.msg);
			if(data.error)
			{
				return false;
			}else
			{
				window.location.href="<?php echo URL_APP_C;?>/Index/menus";
				return true;
			}
		},'json');
		return false;
	});
});
</script>
</body>
</html>
