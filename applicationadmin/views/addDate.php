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
<body class="roomList">
<div class="roomListInfos container">
<h3 class="headerLineBackground">
修改订单报备时间
</h3>
<form action="<?php echo URL_APP_C;?>/Order/addDateDeal" method="post">
<table border="0" cellspacing="0" cellpadding="0" width="90%" >
	<tr>
		<td>
		&nbsp;&nbsp;用户身份：<?php echo $res['order_user']; ?>
		&nbsp;&nbsp;上次增加报备时间：&nbsp;
		<?php echo intval($res['add_datetime']/(24*3600));?>&nbsp;天
		</td>
	</tr>
	<tr>
		<td>
		<input type="hidden" name="order_id" value="<?php echo $res['order_id']; ?>" />
		&nbsp;&nbsp;报备时间:&nbsp;<input  type="text" name="addDate" value="" />(以天为准,如一天,则输入1)
		&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="提交" />
		</td>
	</tr>
</table>
</form>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$("input[name='submit']").click(function(){
		var addDate = $("input[name='addDate']").val();
		if(addDate=='')
		{
			alert("请输入报备增加的天数");
			return false;
		}
	});

});
</script>
</body>
</html>
