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
<table border="0" cellspacing="0" cellpadding="0" width="98%">
	<tr>
		<th width="10%" align="center">房间号</th>
		<th  width="20%" align="center">房间名称</th>
		<th  width="65%" align="center">房间描述</th>

	</tr>
	<?php 
	foreach($roomList as $key=>$val){
	?>
	<tr>
		<td width="10%" align="center"><a href="/Room/postionList?id=<?php echo $val['room_id'];?>"><?php echo $val['room_id'];?></a></td>
		<td  width="20%" align="center"><a href="/Room/postionList?id=<?php echo $val['room_id'];?>"><?php echo $val['room_alias'];?></a></td>
		<td  width="65%" align="center"><a href="/Room/postionList?id=<?php echo $val['room_id'];?>"><?php echo $val['room_description'];?></a></td>
	
	</tr>
	<tr>
	   <td colspan="3"><hr/></td>
	</tr>
	<?php } ?>
</table>
<?php } ?>

<!--  bof 页码  -->
<p class="pages">
总记录数：<?php echo $total;?>&nbsp;&nbsp; 总页码：<?php echo $totalPage; ?>&nbsp;&nbsp; 页码列表：  
<?php 
if($page > 1) { 
	$fromPage = $page - 5;
	
	for($i = $fromPage; $i < $page;$i++) { 
		if($i < 1)
		{
			continue;
		}
?>
	<a href="/Room/roomOpenPosition?page=<?php echo $i; ?>"><?php echo $i; ?></a>&nbsp;		
<?php } }
	$toPage = $page + 5;
	for($ii=$page; $ii<=$toPage;$ii++)
	{
		if($ii > $totalPage)
		{
			break;
		}
?>
<?php if($ii == $page) {?>
<font><?php echo $ii; ?></font>&nbsp;
<?php }else {?>
<a href="/Room/roomOpenPosition?page=<?php echo $ii; ?>"><?php echo $ii; ?></a>&nbsp;
<?php } 
	 }
 ?>
</p>
<!--  eof 页码  -->

</div>

</body>
</html>
