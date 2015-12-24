<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $memberInfos['member_username']; ?>-统计中心</title>
	<link href="/css/style.css?v=000" rel="stylesheet" type="text/css" />
</head>
<body class="roomList">
<div class="roomListInfos members">
<h3 class="headerLineBackground">
业务员&nbsp;<font><?php echo $memberInfos['member_username']; ?></font>&nbsp;统计中心
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
</table>
<p class="backBtnMember">
<a href="/Memberteam/MemberteamUserList?id=<?php echo $memberInfos['member_id']; ?>">登记用户列表</a>
&nbsp;&nbsp;
<a href="/Memberteam/MemberteamOrderList?id=<?php echo $memberInfos['member_id']; ?>">订单列表</a></p>
</div>


</body>
</html>
