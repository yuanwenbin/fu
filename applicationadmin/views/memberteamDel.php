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
义工分组列表,可删除，删除会把相关义工也删除
</h3>

<table border="0" cellspacing="0" cellpadding="0" width="98%">
	<tr>
		<th width="25%" align="center">分组名</th>
		<th width="20%" align="center">增加管理员</th>
		<th width="20%" align="center">增加时间</th>
		<th width="30%" align="center">操作</th>
	</tr>
	<?php 
	foreach($result as $key=>$val){
	?>
	<tr>
		<td width="25%" align="center">
		<?php echo $val['team_name']; ?>
		</td>
		<td width="20%" align="center">
		<?php echo $val['team_user_name']; ?>
		</td>
		<td width="20%" align="center">
		<?php echo date('Y-m-d H:i:s', $val['team_create']); ?>
		</td>
		<td width="30%" align="center">
		<a class="delTeam" href="<?php echo URL_APP_C;?>/Memberteam/memberteamDelDeal?id=<?php echo $val['id'];?>">删除</a>
		</td>
	</tr>
	<tr>
		<td colspan="4"><hr/></td>
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
