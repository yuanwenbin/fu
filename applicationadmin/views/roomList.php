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
<h3 class="headerLineBackground">房间 列表 信息</h3>
<?php
if(!$roomList) { ?>
	暂时无相关房间，<a href="/Room/roomOpen">点击增加房间</a>
<?php }else {
?>
<table border="0" cellspacing="5" cellpadding="5" width="100%">
	<tr>
		<th width="10%" align="center">房间号</th>
		<th  width="10%" align="center">牌位数</th>
		<th  width="15%" align="center">是否开放</th>
		<th  width="18%" align="center">注册时间</th>
		<th  width="45%" align="center">操作</th>
	</tr>
	<?php 
	foreach($roomList as $key=>$val){
	?>
	<tr <?php echo ($key % 2) ? 'class="listRoomColumns"' : '';?>class="fuck">
		<td width="10%" align="center"><?php echo $val['room_id'];?></td>
		<td  width="10%" align="center"><?php echo $val['room_number'];?></td>
		<td  width="15%" align="center"><?php echo $val['room_flag'] == 1 ? '是' : '否';?></td>
		<td  width="18%" align="center"><?php echo date('Y-m-d H:i:s',$val['room_time']);?></td>
		<td  width="45%" align="center">
		<?php 
		if(hasPerssion($_SESSION['role'], 'delRoom')){ ?>
		&nbsp;<a onclick="return sureDel();" href="/Room/delRoom?roomId=<?php echo $val['room_id'];?>">删除</a>
		<?php } ?>
		<?php 
		if(hasPerssion($_SESSION['role'], 'roomInfos')){ ?>
		&nbsp;<a href="/Room/roomInfos?roomId=<?php echo $val['room_id'];?>">查看</a>
		<?php } ?>
		<?php 
		if(hasPerssion($_SESSION['role'], 'updateRoom')){ ?>
		&nbsp;<a href="/Room/updateRoom?roomId=<?php echo $val['room_id'];?>">编辑</a>
		<?php } ?>
		</td>	
	</tr>
	<?php } ?>
</table>
<?php } ?>
<p class="roomListPage">
共有房间数：<?php echo $roomTotal;?>
&nbsp;&nbsp;页码：<?php echo $page;?>/<?php echo $totalPage; ?>
<?php if($page > 1) {?>
&nbsp;&nbsp;<a href="/Room/roomList?page=1">首页</a>
&nbsp;&nbsp;<a href="/Room/roomList?page=<?php echo ($page - 1);?>">上一页</a>
<?php } ?>
<?php if($page < $totalPage) { ?>
&nbsp;&nbsp;<a href="/Room/roomList?page=<?php echo ($page+1);?>">下一页</a>
&nbsp;&nbsp;<a href="/Room/roomList?page=<?php echo $totalPage;?>">末页</a>
<?php } ?>
</p>
</div>

<script type="text/javascript">
function sureDel()
{
	if(confirm("你确定要删除吗？房间和相关的牌位都会删除，请谨慎操作!"))
	{
		return true;
	}
	return false;
}
</script>
</body>
</html>
