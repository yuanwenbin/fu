<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>系统后台</title>
	<link href="/css/style.css" rel="stylesheet" type="text/css" />
    <link type="text/css" href="/css/jquery-ui-1.8.17.custom.css" rel="stylesheet" />
     <link type="text/css" href="/css/jquery-ui-timepicker-addon.css" rel="stylesheet" />
     <style type="text/css">
	select{min-width:80px;}	
	.tongJiPage{width:90%; text-align:center;padding-top:20px;}
	</style>

<body class="roomList">
<div class="roomListInfos container">
	<h3 class="headerLineBackground">牌位查询信息(红色已出售，黄色出售中，青色末出售)</h3>
	<?php if($list) { ?>
	<div class="tongjiArea">
		<ul>	
		<li class="statusArea_<?php  echo $list['location_number'];?>">
		<a href="/Room/posLocation?id=<?php echo $list['localtion_id'];?>">
		<?php echo $list['location_area']; ?><?php echo $list['location_prefix']; ?><?php echo strlen($list['location_code']) == 1 ? '0'.$list['location_code'] : $list['location_code']; ?>(<?php echo $list['localtion_id']; ?>)
		<?php if($list['location_status']) echo '*';?>
		</a></li>
	</ul>
	<div style="clear:both;"></div>

	</div>
	<?php	} ?>
	
	

	
	
</div>

</body>
</html>
