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
<?php
if(!$roomList) { ?>
	暂时无相关房间，<a href="/Room/roomOpen">点击增加房间</a>
<?php }else {
?>
<h3>请选择要编辑的房间牌位</h3>
<table border="0" cellspacing="5" cellpadding="5" width="100%">
	<tr>
		<th width="10%" align="center">房间号</th>
		<th  width="20%" align="center">房间名称</th>
		<th  width="65%" align="center">房间描述</th>

	</tr>
	<?php 
	foreach($roomList as $key=>$val){
	?>
	<tr <?php echo ($key % 2) ? 'class="listRoomColumns"' : '';?>class="fuck">
		<td width="10%" align="center"><a href="/Room/postionList?id=<?php echo $val['room_id'];?>"><?php echo $val['room_id'];?></a></td>
		<td  width="20%" align="center"><a href="/Room/postionList?id=<?php echo $val['room_id'];?>"><?php echo $val['room_alias'];?></a></td>
		<td  width="65%" align="center"><a href="/Room/postionList?id=<?php echo $val['room_id'];?>"><?php echo $val['room_description'];?></a></td>
	
	</tr>
	<?php } ?>
</table>
<?php } ?>
<p class="roomListPage">
共有房间数：<?php echo $roomTotal;?>
&nbsp;&nbsp;页码：<?php echo $page;?>/<?php echo $totalPage; ?>
<?php if($page > 1) {?>
&nbsp;&nbsp;<a href="/Room/roomOpenPosition?page=1">首页</a>
&nbsp;&nbsp;<a href="/Room/roomOpenPosition?page=<?php echo ($page - 1);?>">上一页</a>
<?php } ?>
<?php if($page < $totalPage) { ?>
&nbsp;&nbsp;<a href="/Room/roomOpenPosition?page=<?php echo ($page+1);?>">下一页</a>
&nbsp;&nbsp;<a href="/Room/roomOpenPosition?page=<?php echo $totalPage;?>">末页</a>
<?php } ?>
</p>
</div>

</body>
</html>
