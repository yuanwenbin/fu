<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>组长-<?php echo $memberInfos['member_username']; ?>-统计中心</title>
	<link href="<?php echo URL_APP;?>/css/style.css?v=201512281041" rel="stylesheet" type="text/css" />
</head>
<body class="roomList">
<div class="roomListInfos membersUserList">
<h3 class="headerLineBackground">
组长-义工&nbsp;<font><?php echo $memberInfos['member_username']; ?></font>&nbsp;登记功德主列
</h3>

<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<?php if(!$userList) { ?>
	<tr><td align="center">没有相关数据</td></tr>
	<tr><td><hr /></td></tr>
	<?php }else{ ?>
	<tr>
		<th width="25%" align="center">客户称呼</th>
		<th width="25%" align="center">身份证号码</th>
		<th width="25%" align="center">手机号码</th>
		<th width="25%" align="center">登记时间</th>
	</tr>
	<?php
		foreach($userList as $k=>$v) { 
	?>
	<tr>
		<td widtd="25%" align="center"><?php echo $v['user_phone'] ? $v['user_phone'] : '无'; ?></td>
		<td widtd="25%" align="center">
		<?php echo $v['body_id']; ?>
		</td>

		<td widtd="25%" align="center"><?php echo $v['user_telphone'] ? $v['user_telphone'] : '无'; ?></td>
		<td widtd="25%" align="center">
		<?php 
		echo date('Y-m-d H:i:s', $v['user_datetime']);
		 ?>
		</td>
	</tr>
	<tr><td colspan="4"><hr /></td></tr>
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
	<a href="<?php echo URL_APP_C;?>/Memberteam/memberTeamRegisterUser?id=<?php echo $id; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>&nbsp;		
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
<a href="<?php echo URL_APP_C;?>/Memberteam/memberTeamRegisterUser?id=<?php echo $id; ?>&page=<?php echo $ii; ?>"><?php echo $ii; ?></a>&nbsp;
<?php } 
	 }
 ?>
</p>
<!--  eof 页码  -->

<p class="backBtnMember">
<a href="<?php echo URL_APP_C;?>/Memberteam/memberTeamOrder?id=<?php echo $id;?>">组长及旗下义工捐赠列表</a></p>
</div>


</body>
</html>
