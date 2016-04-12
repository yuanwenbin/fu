<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>统计中心</title>
	<link href="<?php echo URL_APP;?>/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body class="roomList">
<div class="topBg">
<img src="<?php echo URL_APP;?>/images/title_background.png" />
</div>
<div class="roomListInfos members">
<h3 class="headerLineBackground">
业务员&nbsp;<font><?php echo $name; ?></font>&nbsp;统计中心
</h3>

<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<td width="20%" align="right">客户数：&nbsp;</td>
		<td width="20%" align="left"><?php echo $totalMembers;?></td>
	</tr>
	<tr>
		<td width="20%" align="right">全部金额数：&nbsp;</td>
		<td width="20%" align="left"><?php echo number_format($totalMoney,2);?></td>
	</tr>
	<tr>
		<td width="20%" align="right">已经支付金额：&nbsp;</td>
		<td width="20%" align="left"><?php echo number_format($totalMoneyPay,2);?></td>
	</tr>
	<tr>
		<td width="20%" align="right">未支付金额：&nbsp;</td>
		<td width="20%" align="left"><?php echo number_format(($totalMoney-$totalMoneyPay),2);?></td>
	</tr>
	<tr>
		<td width="20%" align="right"><a href="<?php echo URL_APP_C;?>/Members/userList">登记用户列表</a>&nbsp;&nbsp;</td>
		<td width="20%" align="left">&nbsp;&nbsp;<a href="<?php echo URL_APP_C;?>/Members/orderList">查看订单列表</a>
		&nbsp;&nbsp;
		<a href="<?php echo URL_APP_C;?>/Index/menus">菜单中心</a>
		</td>
	</tr>
</table>
</div>


</body>
</html>
