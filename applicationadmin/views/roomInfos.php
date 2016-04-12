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
<div class="roomInfosDiv container">
<h3 class="headerLineBackground">房间 <?php echo $roomInfos['room_id'];?> 信息</h3>
<table border="0" cellpadding="5" cellspacing="5" width="90%">	
	<tr>
		<td width="20%" align="right">房间号：</td>
		<td>
		<?php echo $roomInfos['room_id'];?>
		</td>		
	</tr>
	
	<tr>
		<td width="20%" align="right">房间名称：</td>
		<td>
		<?php echo $roomInfos['room_alias'];?>
		</td>		
	</tr>
	
	
	<tr>
		<td width="20%" align="right">房间类型：</td>
		<td>
		<?php echo $roomInfos['room_type'] ? '高端定制' : '随机/生辰八字';?>
		</td>		
	</tr>	
	
	<tr>
		<td width="20%" align="right">房间开设时间：</td>
		<td>
		<?php echo date('Y-m-d H:i:s',$roomInfos['room_time']);?>
		</td>		
	</tr>	
	
	<tr>
		<td width="20%" align="right">房间开设管理员：</td>
		<td>
		<?php echo $userInfos['admin_user'];?>
		</td>		
	</tr>	
	
	<tr>
		<td width="20%" align="right">房间描述：</td>
		<td>
		<?php echo $roomInfos['room_description'];?>
		</td>		
	</tr>	
		<tr>
		<td width="20%" align="right">&nbsp;</td>
		<td>
		<a href="javascript:history.go(-1);">点击返回</a>
		</td>		
	</tr>			
</table>
</div>

</body>
</html>
