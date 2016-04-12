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
</head>
<body class="roomList">
<div class="roomListInfos container">
<h3 class="headerLineBackground"><?php echo $title; ?>,密码以第一条为准，只显示最新十条，多于十条，会自动清空旧的记录</h3>

<table border="0" cellspacing="0" cellpadding="0" width="98%">
	<tr>
		<th width="20%" align="center">密码</th>
		<th width="25%" align="center">密码类型</th>
		<th width="30%" align="center">时间</th>
		<th width="20%" align="center">管理员</th>
	</tr>
	<?php 
	foreach($listPassword as $key=>$val){
	?>
	<tr>
		<td width="20%" align="center">
		<?php echo $val['ps_password']; ?>
		</td>
		<td width="25%" align="center">
		<?php echo $val['ps_flag'] ? '高端密码':'随机密码'; ?>
		</td>
		<td width="30%" align="center">
		<?php echo date('Y-m-d H:i:s', $val['ps_datetime']); ?>
		</td>
		<td width="20%" align="center">
		<?php echo $val['ps_user']; ?>
		</td>
	</tr>
	<tr>
		<td colspan="4"><hr/></td>
	</tr>
	<?php } ?>
</table>
</div>


</body>
</html>
