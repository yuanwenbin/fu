<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>系统自动下单</title>
	<link href="<?php echo URL_APP;?>/css/style.css" rel="stylesheet" type="text/css" />
	<style>
	.location_area_div{margin-top:10px;margin-bottom:10px;}

	</style>
	<script type="text/javascript" src="<?php echo URL_APP;?>/js/jquery-1.8.3.min.js"></script>
</head>
<body class="roomOpen">
<div class="container">
<h3>系统自动下单</h3>
<form method="post" action="">
	<!-- bof box -->
	<div class="location_area_div">
		<table width="100%" border="0" cellpadding="5" cellspacing="0">		
		<tr>
			<td width="20%" align="right"><label>牌位信息：</label></td>
			<td>
			牌位号码：<input type="text" name="localtion_id" value="" />&nbsp;(如:123 或  D区1-01)<br />
			出售状态：
				<select name="location_number">
					<option value="1" selected>出售中</option>
					<option value="0">已出售</option>
				</select><br />
				福位选择：
				<select name="room_no">
					<option value="0">--所有--</option>
					<?php foreach($roomList as $kk=>$vv) { ?>
					<option value="<?php echo $vv['room_id'];?>"><?php echo $vv['room_alias']. '(' . $vv['room_id'] . ')'; ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		</table>
	</div>
	<!-- eof box -->
	<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td width="20%" align="right"><label>用户信息：</label></td>
		<td>
			身份证号：<input type="text" name="body_id" value="" /><br />
			电话号码：<input type="text" name="user_telphone" value="" /><br />
			用户称呼：<input type="text" name="user_phone" value="" /><br />
			用户姓名：<input type="text" name="user_name" value="" />(对生辰八字来说,别的类型用户不填)<br />
			用户生日：<input type="text" name="user_birthday" value="" />(对生辰八字来说,别的类型用户不填,格式如: 2015-01-01)<br />
			出生时辰：
			<select name="stime" class="user_time">
			<option value="子时(23:00-00:59)">子时(23:00-00:59)</option>
			<option value="丑时(01:00-02:59)">丑时(01:00-02:59)</option>
			<option value="寅时(03:00-04:59)">寅时(03:00-04:59)</option>
			<option value="卯时(05:00-06:59)">卯时(05:00-06:59)</option>
			<option value="辰时(07:00-08:59)">辰时(07:00-08:59)</option>
			<option value="巳时(09:00-10:59)">巳时(09:00-10:59)</option>
			<option value="午时(11:00-12:59)">午时(11:00-12:59)</option>
			<option value="未时(13:00-14:59)">未时(13:00-14:59)</option>
			<option value="申时(15:00-16:59)">申时(15:00-16:59)</option>
			<option value="酉时(17:00-18:59)">酉时(17:00-18:59)</option>
			<option value="戌时(19:00-20:59)">戌时(19:00-20:59)</option>
			<option value="亥时(21:00-22:59)">亥时(21:00-22:59)</option>
			</select>
(对生辰八字来说,别的类型用户不必填)<br />
		</td>
	</tr>	

	<tr>
		<td width="20%" align="right"><label>订单信息：</label></td>
		<td>
		订单定位:
						<select name="order_location_type">
					<option value="1" selected>高端</option>
					<option value="0">随机</option>
					<option value="2">生辰八字</option>
				</select>
		</td>
	</tr>

	<tr>
		<td width="20%" align="right"><label>义工列表：</label></td>
		<td>
		业务人员:
					<select name="member_id">
					<?php foreach($memberList as $kv) { ?>
					<option value="<?php echo $kv['member_id']; ?>"><?php echo $kv['member_username']; ?></option>
					<?php } ?>
				</select>
		</td>
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
</table>
</form>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("input[name='submit']").click(function(){
		// 牌位号码
		var localtion_id = $("input[name='localtion_id']").val();
		if(localtion_id == '')
		{
			alert("请输入有效的牌位号码");
			return false;
		}
		// 身份证号
		var body_id = $("input[name='body_id']").val();
		if(body_id == '')
		{
			alert("身份证号码不能为空");
			return false;
		}
		if(body_id.length != 15 && body_id.length != 18)
		{
			alert("请填写正确的身份证号!");
			return false;
		}
		// 出售状态 
		var location_number = $("select[name='location_number']").val();
		// 用户姓名
		var user_name = $("input[name='user_name']").val();
		// 用户生日
		var user_birthday = $("input[name='user_birthday']").val();
		// 用户时辰
		var stime = $("select[name='stime']").val();
		// 订单类型
		var order_location_type = $("select[name='order_location_type']").val();
		// 会员id
		var member_id = $("select[name='member_id']").val();
		// 电话号码 
		var user_telphone = $("input[name='user_telphone']").val();
		// 称呼
		var user_phone = $("input[name='user_phone']").val();
		// 福位id
		var room_no = $("select[name='room_no']").val();	

		if(user_telphone=='')
		{
			alert("用户手机号码不能为空");
			return false;
		}

		var url = "<?php echo URL_APP_C;?>/Order/orderSelfAdd";
		var param = {localtion_id:localtion_id,body_id:body_id,location_number:location_number,user_name:user_name,user_birthday:user_birthday,stime:stime,order_location_type:order_location_type,member_id:member_id,user_telphone:user_telphone,user_phone:user_phone,room_no:room_no};
		$.post(url,param,function(data){
			alert(data.msg);	
			if(data.error)
			{
				return false;
			}
			window.location.href="<?php echo URL_APP_C;?>/Order/orderSelf";
		}, 'json');
		return false;
	});
});
</script>
</body>
</html>
