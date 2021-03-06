<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>统计中心</title>
	<link href="<?php echo URL_APP;?>/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body class="roomList">
<div class="topBg">
<img src="<?php echo URL_APP;?>/images/title_background.png" />
</div>
<div class="roomListInfos membersUserList">
<h3 class="headerLineBackground">
义工组长&nbsp;<font><?php echo $this->session->member_username; ?></font>&nbsp;捐赠列表
</h3>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<?php if(!$memberOrderList) { ?>
	<tr><td align="center">没有相关数据</td></tr>
	<?php }else{ ?>
	<tr>
		<th width="9%" align="center">称呼</th>
		<th width="15%" align="center">身份证号码</th>
		<th width="10%" align="center">手机号码</th>
		<th width="9%" align="center">选择号码</th>
		<th width="8%" align="center">是否捐赠</th>
		<th width="25%" align="center">用户类型</th>
		<th width="10%" align="center">捐赠额</th>
		<th width="14%" align="center">捐赠时间</th>
	</tr>
	<?php
		foreach($memberOrderList as $k=>$v) { 
	?>
	<tr>
		<td widtd="9%" align="center"><?php echo $v['user_phone'] ? $v['user_phone'] : '无'; ?></td>
		<td widtd="15%" align="center"><?php echo $v['body_id']; ?></td>
		<td widtd="10%" align="center">
		<?php echo $v['user_telphone'] ? $v['user_telphone'] : '无'; ?>
		</td>
		<td widtd="9%" align="center">
		<?php echo $v['order_location_id'] ? $v['order_location_id'] : '无'; ?>
		</td>
		<td widtd="8%" align="center">
		<?php echo $v['order_payment'] ? '是' : '否'; ?>
		</td>
		<td widtd="25%" align="center">
		<?php if(!$v['user_type']) { ?>
		 随机用户
		<?php } else if($v['user_type'] == 1) {  ?>
		生辰用户,
		<?php echo $v['user_name'] .'-' . $v['user_birthday'] . '-' . $v['user_time'];?>
		<?php } else if($v['user_type'] == 2) { ?>
		高端用户
		<?php }else { ?>
		未确定
		<?php } ?>
		</td>
		<td widtd="10%" align="center"><?php echo $v['order_price']; ?></td>
		<td widtd="14%" align="center">
		<?php if($v['order_datetime']) { 
		echo date('Y-m-d H:i:s', $v['order_datetime']);
		 }else{ ?>
		&nbsp;	
		<?php } ?>
		</td>
	</tr>
	<?php } } ?>
</table>
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
	<a href="<?php echo URL_APP_C;?>/Index/orderListTeam?page=<?php echo $i; ?>"><?php echo $i; ?></a>&nbsp;		
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
<a href="<?php echo URL_APP_C;?>/Index/orderListTeam?page=<?php echo $ii; ?>"><?php echo $ii; ?></a>&nbsp;
<?php } 
	 }
 ?>
</p>
<!--  eof 页码  -->
<p class="backBtnMember"><a href="<?php echo URL_APP_C;?>/Index/infoList">返回统计中心</a>
&nbsp;&nbsp;
<a href="<?php echo URL_APP_C;?>/Index/menus">菜单中心</a></p>
</div>


</body>
</html>
