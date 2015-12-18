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
<body class="roomList">
<div class="roomListInfos container">
<h3 class="headerLineBackground">
业务员分组列表
</h3>

<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<th width="20%" align="center">分组名</th>
		<th width="20%" align="center">增加管理员</th>
		<th width="15%" align="center">增加时间</th>
		<th width="45%" align="center">操作</th>
	</tr>
	<?php
	if(isset($result) && ($result)) {
	foreach($result as $key=>$val){
	?>
	<tr>
		<td width="20%" align="center">
		<?php echo $val['team_name']; ?>
		</td>
		<td width="20%" align="center">
		<?php echo $val['team_user_name']; ?>
		</td>
		<td width="15%" align="center">
		<?php echo date('Y-m-d H:i:s', $val['team_create']); ?>
		</td>
		<td width="45%" align="center">
		<?php if(hasPerssion($_SESSION['role'],'memberteamAdd')) { ?>
		<a href="/Memberteam/memberteamAdd">分组增加</a>&nbsp;&nbsp;
		<?php } ?>
		<?php if(hasPerssion($_SESSION['role'],'memberteamDel')) { ?>
		<a class="delTeam" href="/Memberteam/memberteamDelDeal?id=<?php echo $val['id'];?>">删除</a>&nbsp;&nbsp;
		<?php } ?>
		<?php if(hasPerssion($_SESSION['role'],'memberteamUpdate')) { ?>
		<a href="/Memberteam/memberteamUpdate?id=<?php echo $val['id'];?>">分组编辑</a>
		<?php } ?>	

		</td>
	</tr>
	<tr>
		<td colspan="4"><hr/></td>
	</tr>
	<?php } }else { ?>
	<tr>
		<td colspan="4">暂时没有相关内容</td>
	</tr>
	<?php } ?>
</table>
</div>
<script>
$(document).ready(function(){
	$(".delTeam").click(function(){
		if(confirm("你确定要删除吗？"))
		{
			return true;
		}
		return false;
	});	
});
</script>


</body>
</html>
