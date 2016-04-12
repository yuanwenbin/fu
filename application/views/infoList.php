<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>组长-统计中心</title>
	<link href="<?php echo URL_APP;?>/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body class="roomList">
<div class="topBg">
<img src="<?php echo URL_APP;?>/images/title_background.png" />
</div>
<div class="roomListInfos members">
<h3 class="headerLineBackground">
组长-业务员&nbsp;<font><?php echo $_SESSION['member_username']; ?></font>&nbsp;统计中心
</h3>

<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<td width="20%" align="right">旗下业务员总数：&nbsp;</td>
		<td width="20%" align="left"><?php echo $userCount;?></td>
	</tr>
	<tr>
		<td width="20%" align="right">旗下业务员用户总数：&nbsp;</td>
		<td width="20%" align="left"><?php echo $memberUserCount;?></td>
	</tr>
	<tr>
		<td width="20%" align="right">订单总数：&nbsp;</td>
		<td width="20%" align="left"><?php echo $orderAllCount;?></td>
	</tr>
	<tr>
		<td width="20%" align="right">订单已支付数量总数：&nbsp;</td>
		<td width="20%" align="left"><?php echo ($orderAllCount - $orderNotPayCount);?></td>
	</tr>

	<tr>
		<td width="20%" align="right">订单未支付数量总数：&nbsp;</td>
		<td width="20%" align="left"><?php echo $orderNotPayCount;?></td>
	</tr>

	<tr>
		<td width="20%" align="right">订单总金额数：&nbsp;</td>
		<td width="20%" align="left">
		<?php echo number_format($orderAllCountMoney,2); //echo $orderAllCountMoney; // echo number_format($orderAllCountMoney,2);?></td>
	</tr>

	<tr>
		<td width="20%" align="right">订单已支付金额数：&nbsp;</td>
		<td width="20%" align="left">
		<?php echo number_format(($orderAllCountMoney - $orderNotPayCountMoney),2);
		// number_format($orderAllCountMoney - $orderNotPayCountMoney);?>
		</td>
	</tr>

	<tr>
		<td width="20%" align="right">订单未支付金额数：&nbsp;</td>
		<td width="20%" align="left"><?php echo $orderNotPayCountMoney;// number_format($orderNotPayCountMoney);?></td>
	</tr>
	<tr>
		<td width="20%" align="right"><a href="<?php echo URL_APP_C;?>/Index/indexUserListTeam">本组登记用户列表</a>&nbsp;&nbsp;</td>
		<td width="20%" align="left">&nbsp;&nbsp;<a href="<?php echo URL_APP_C;?>/Index/orderListTeam">本组订单列表</a>
		&nbsp;&nbsp;
		<a href="<?php echo URL_APP_C;?>/Index/menus">菜单中心</a>
		</td>
	</tr>
</table>
</div>


</body>
</html>
