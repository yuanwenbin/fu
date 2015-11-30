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
<body class="roomOpen">
<div class="container">
<h3>开设房间、牌位中心</h3>
<form method="post" action="/Room/RoomOpenAdd">
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td width="20%" align="right"><label>新开设的房间号：</label></td>
		<td><?php echo $roomId; ?></td>
	</tr>
	<tr>
		<td width="20%" align="right"><label>牌位数：</label></td>
		<td><input type="number" name="number" value="" /></td>
	</tr>
	
	<tr>
		<td width="20%" align="right"><label>统一定位价：</label></td>
		<td><input type="text" name="price" value="" /></td>
	</tr>	

	<tr>
		<td width="20%" align="right"><label>是否开放：</label></td>
		<td>
		<select name="openFlag">
			<option value="1" selected>开放</option>
			<option value="0">关闭</option>
		</select>
		</td>
	</tr>

	<tr>
		<td width="20%" align="right"><label>房间别名：</label></td>
		<td><input type="text" name="alias" value="" /></td>
	</tr>

	<tr>
		<td width="20%" align="right"><label>房间描述：</label></td>
		<td><textarea rows="5" cols="60" name="description"></textarea></td>
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
		var num = $("input[name='number']").val();
		if(num == '' || isNaN(num))
		{
			alert("请输入你要的牌位数目!");
			return false;
		}
		
	});
});
</script>
</body>
</html>
