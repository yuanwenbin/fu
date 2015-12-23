<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $memberInfos['member_username']; ?>-统计中心</title>
	<link href="/css/style.css?v=100" rel="stylesheet" type="text/css" />
</head>
<body class="roomList">
<div class="roomListInfos membersUserList">
<h3 class="headerLineBackground">
业务员&nbsp;<font><?php echo $memberInfos['member_username']; ?></font>&nbsp;登记用户列表
</h3>

<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<?php if(!$userList) { ?>
	<tr><td align="center">没有相关数据</td></tr>
	<?php }else{ ?>
	<tr>
		<th width="18%" align="center">身份证号码</th>
		<th width="10%" align="center">手机号码</th>
		<th width="13%" align="center">选择号码</th>
		<th width="10%" align="center">是否支付</th>
		<th width="25%" align="center">用户类型</th>
		<th width="10%" align="center">价格</th>
		<th width="14%" align="center">下单时间</th>
	</tr>
	<?php
		foreach($userList as $k=>$v) { 
	?>
	<tr>
		<td widtd="18%" align="center"><?php echo $v['body_id']; ?></td>
		<td widtd="10%" align="center">
		<?php echo $v['user_telphone'] ? $v['user_telphone'] : $v['user_phone']; ?>
		</td>
		<td widtd="13%" align="center">
		<?php echo $v['order_location_id'] ? $v['order_location_id'] : '无'; ?>
		</td>
		<td widtd="10%" align="center">
		<?php echo $v['order_payment'] ? '是' : '无'; ?>
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
		无订单	
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
	<a href="/Memberteam/MemberteamUserList?id=<?php echo $id; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>&nbsp;		
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
<a href="/Memberteam/MemberteamUserList?id=<?php echo $id; ?>&page=<?php echo $ii; ?>"><?php echo $ii; ?></a>&nbsp;
<?php } 
	 }
 ?>
</p>
<!--  eof 页码  -->

<p class="backBtnMember">
<a href="/Memberteam/MemberteamOrderList?id=<?php echo $memberInfos['member_id'];?>">订单列表</a></p>
</div>


</body>
</html>
