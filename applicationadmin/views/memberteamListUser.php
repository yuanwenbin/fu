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
</head>
<body class="roomList">
<div class="roomListInfos container">
<h3 class="headerLineBackground">
业务员列表
</h3>

<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<th width="15%" align="center">用户名</th>
		<th width="15%" align="center">手机号</th>
		<th width="15%" align="center">分组名</th>
		<th width="15%" align="center">真名</th>
		<th width="20%" align="center">开设时间</th>
		<th width="20%" align="center">操作</th>
	</tr>
	<?php 
	if(isset($memberteamListUser) && ($memberteamListUser)) {
	foreach($memberteamListUser as $key=>$val){
	?>
	<tr>
		<td width="15%" align="center">
		<?php echo $val['member_username']; ?>
		</td>
		<td width="15%" align="center">
		<?php echo $val['member_telphone']; ?>
		</td>
		<td width="15%" align="center">
		<?php echo $val['team_name']; ?>
		</td>
		<td width="15%" align="center">
		<?php echo $val['member_realname']; ?>
		</td>
		<td width="20%" align="center">
		<?php echo date('Y-m-d H:i:s',$val['member_create']); ?>
		</td>
		<td width="20%" align="center">
		<?php if(hasPerssion($_SESSION['role'],'memberteamAddUser')) { ?>
		<a href="/Memberteam/memberteamAddUser">增加</a>&nbsp;
		<?php } ?>
		<?php if(hasPerssion($_SESSION['role'],'memberteamDelUser')) { ?>
		<a href="/Memberteam/memberteamDelUser">删除</a>
		<?php } ?>
		<?php if(hasPerssion($_SESSION['role'],'memberteamSaleUser')) { ?>
		<a href="/Memberteam/memberteamSaleUser">业绩</a>
		<?php } ?>
		</td>
	</tr>
	<?php } } else {?>
	<tr>
		<td colspan="6">暂时没有相关内容</td>
	</tr>
	<?php } ?>
</table>
</div>


</body>
</html>
