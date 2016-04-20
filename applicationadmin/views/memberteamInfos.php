<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>系统登陆后台</title>
	<link href="<?php echo URL_APP;?>/css/style.css?v=201512281041" rel="stylesheet" type="text/css" />
</head>
<body class="roomOpen">
<div class="container">
<h3>
<?php echo $memberteamInfos[0]['member_realname'] ? $memberteamInfos[0]['member_realname'] : $memberteamInfos[0]['member_username']; ?>
-组长-义工统计</h3>
<form action="<?php echo URL_APP_C;?>/Memberteam/memberteamAddUserDeal" method="post">
<table width="100%" border="0" cellpadding="5" cellspacing="0">

	<tr>
		<td width="20%" align="right"><label>组长义工电话号码：</label></td>
		<td><?php echo $memberteamInfos[0]['member_telphone'];?></td>
	</tr>

	<tr>
		<td colspan="2"><hr /></td>
	</tr>

	<tr>
		<td width="20%" align="right"><label>旗下义工总数：</label></td>
		<td><?php echo $userCount;?></td>
	</tr>
	<tr>
		<td colspan="2"><hr /></td>
	</tr>
	<tr>
		<td width="20%" align="right"><label>旗下义工的用户总数：</label></td>
		<td><?php echo $memberUserCount;?></td>
	</tr>
	<tr>
		<td colspan="2"><hr /></td>
	</tr>
	<tr>
		<td width="20%" align="right"><label>订单总数：</label></td>
		<td><?php echo $orderAllCount;?></td>
	</tr>
	<tr>
		<td colspan="2"><hr /></td>
	</tr>
	<tr>
		<td width="20%" align="right"><label>订单已支付数：</label></td>
		<td><?php echo ($orderAllCount - $orderNotPayCount);?></td>
	</tr>
	<tr>
		<td colspan="2"><hr /></td>
	</tr>
	<tr>
		<td width="20%" align="right"><label>订单未支付数：</label></td>
		<td><?php echo $orderNotPayCount;?></td>
	</tr>
	<tr>
		<td colspan="2"><hr /></td>
	</tr>
	<tr>
		<td width="20%" align="right"><label>订单总金额：</label></td>
		<td><?php echo $orderAllCountMoney;?></td>
	</tr>
	<tr>
		<td colspan="2"><hr /></td>
	</tr>
	<tr>
		<td width="20%" align="right"><label>订单已支付金额：</label></td>
		<td>
		<?php echo number_format(($orderAllCountMoney - $orderNotPayCountMoney), 2);?>
		</td>
	</tr>
	<tr>
		<td colspan="2"><hr /></td>
	</tr>
	<tr>
		<td width="20%" align="right"><label>订单未支付金额：</label></td>
		<td><?php echo $orderNotPayCountMoney;?></td>
	</tr>
	<tr>
		<td colspan="2"><hr /></td>
	</tr>
	<tr>
		<td width="20%" align="right"><label>&nbsp;</td>
		<td><a href="javascript:history.go(-1);">点击返回</a></td>
	</tr>

</table>
</form>
</div>

</body>
</html>
