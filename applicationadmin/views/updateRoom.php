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
<h3 class="headerLineBackground">福位号:<?php echo $roomInfos['room_id'];?></h3>
<form action="<?php echo URL_APP_C;?>/Room/updateRoomDeal" method="post">
<input type="hidden" name="room_id" value="<?php echo $roomInfos['room_id'];?>"  />
<table border="0" cellpadding="5" cellspacing="5" width="90%">	

	<tr>
		<td width="20%" align="right">福位名称：</td>
		<td>
		<input type="text" name="room_alias" value="<?php echo $roomInfos['room_alias'];?>" />
		</td>		
	</tr>
	
		
	<tr>
		<td width="20%" align="right">福位是否开放：</td>
		<td>
		<select name="room_flag">
		<?php if($roomInfos['room_flag']) {?>
		<option value="1" selected>是</option>
		<option value="0">否</option>
		<?php }else {?>
		<option value="0" selected>否</option>	
		<option value="1">是</option>
		<?php } ?>
		</select>
		</td>		
	</tr>
	
	<tr>
		<td width="20%" align="right">福位类型：</td>
		<td>
		<select name="room_type">
		<?php if($roomInfos['room_type']) {?>
		<option value="1" selected>高端定制</option>
		<option value="0">生辰八字/随机</option>
		<?php }else {?>
		<option value="0" selected>生辰八字/随机</option>	
		<option value="1">高端定制</option>
		<?php } ?>
		</select>
		</td>		
	</tr>	
	
	<tr>
		<td width="20%" align="right">福位描述：</td>
		<td>
		<textarea rows="5" cols="60" name="room_description"><?php echo $roomInfos['room_description'];?></textarea>
		
		</td>		
	</tr>
	<tr>
		<td width="20%" align="right">&nbsp;</td>
		<td>
		<input type="submit" name="submit" value="提交" />
		</td>		
	</tr>						
</table>
</form>
</div>

</body>
</html>
