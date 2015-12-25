<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $this->session->member_username; ?>-组长-统计中心</title>
	<link href="/css/style.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
	.pages{width:100%;line-height:40px;text-align:center;}	
	.pages a{color:#333;border:1px solid #888;padding:0 5px;}
	.pages font{color:#ee0000;}
	</style>
</head>
<body class="roomList">
<div class="topBg">
<img src="/images/title_background.png" />
</div>
<div class="roomListInfos membersUserList">
<h3 class="headerLineBackground">
业务员组长&nbsp;<font><?php echo $this->session->member_username; ?></font>&nbsp;登记用户列表
</h3>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<?php if(!$userList) { ?>
	<tr><td align="center">没有相关数据</td></tr>
	<?php }else{ ?>
	<tr>
		<th width="20%" align="center">称呼</th>
		<th width="25%" align="center">手机号码</th>
		<th width="25%" align="center">身份证号码</th>
		<th width="30%" align="center">登记时间</th>
	</tr>
	<?php
		foreach($userList as $k=>$v) { 
	?>
	<tr>
		<td widtd="20%" align="center"><?php echo $v['user_phone'] ? $v['user_phone'] :'无'; ?></td>
		<td widtd="25%" align="center">
		<?php echo $v['user_telphone'] ? $v['user_telphone'] : '无'; ?>
		</td>
		<td widtd="25%" align="center">
		<?php echo $v['body_id'] ? $v['body_id'] : '无'; ?>
		</td>
		<td widtd="30%" align="center">
		<?php  
		echo date('Y-m-d H:i:s', $v['user_datetime']);
		?>
		
		</td>
	</tr>
	<?php } } ?>
</table>
<!--  bof 页码  -->
<p class="pages">
总记录数：<?php echo $total; ?>&nbsp;&nbsp;总页码：<?php echo $totalPage;?>&nbsp;&nbsp;页码列表：
<?php 
if($page > 1) { 
	$fromPage = $page - 5;
	
	for($i = $fromPage; $i < $page;$i++) { 
		if($i < 1)
		{
			continue;
		}
?>
	<a href="/Index/indexUserListTeam?page=<?php echo $i; ?>"><?php echo $i; ?></a>&nbsp;		
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
<a href="/Index/indexUserListTeam?page=<?php echo $ii; ?>"><?php echo $ii; ?></a>&nbsp;
<?php  
	} }
 ?>
</p>
<!--  eof 页码  -->
<p class="backBtnMember"><a href="/Index/infoList">返回统计中心</a>
&nbsp;&nbsp;
<a href="/Index/menus">菜单中心</a></p>
</div>


</body>
</html>