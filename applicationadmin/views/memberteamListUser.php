<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>系统登陆后台</title>
	<link href="/css/style.css?v=20151223" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
</head>
<body class="roomList">
<div class="roomListInfos container">
<h3 class="headerLineBackground">
业务员列表
</h3>

<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<th width="10%" align="center">用户名</th>
		<th width="15%" align="center">手机号</th>
		<th width="15%" align="center">分组名</th>
		<th width="12%" align="center">真名</th>
		<th width="8%" align="center">状态</th>
		<th width="20%" align="center">开设时间</th>
		<th width="20%" align="center">操作</th>
	</tr>
	<?php 
	if(isset($memberteamListUser) && ($memberteamListUser)) {
	foreach($memberteamListUser as $key=>$val){
	?>
	<tr>
		<td width="10%" align="center">
		<?php echo $val['member_username']; ?>
		</td>
		<td width="15%" align="center">
		<?php echo $val['member_telphone']; ?>
		</td>
		<td width="15%" align="center">
		<?php echo $val['team_name']; ?>
		</td>
		<td width="12%" align="center">
		<?php echo $val['member_realname']; ?>
		</td>
		<td width="8%" align="center"> 
		<?php echo $val['member_flag'] ? '正常':'冻结'; ?>
		</td>		
		<td width="20%" align="center">
		<?php echo date('Y-m-d H:i:s',$val['member_create']); ?>
		</td>
		<td width="20%" align="center">
		<?php if(hasPerssion($_SESSION['role'],'memberteamAddUser')) { ?>
		<a href="/Memberteam/memberteamAddUser">增加</a>&nbsp;
		<?php } ?>
		<?php if(hasPerssion($_SESSION['role'],'memberteamDelUser')) { ?>
		<a href="/Memberteam/memberteamDelUser?id=<?php echo $val['member_id'];?>" class="sureDel">删除</a>
		<?php } ?>
		<?php if(hasPerssion($_SESSION['role'],'memberteamSaleUser')) { ?>
		<a  href="/Memberteam/memberteamSaleUser?id=<?php echo $val['member_id'];?>">业绩</a>
		<?php } ?>
		<?php if(hasPerssion($_SESSION['role'],'memberteamUpdateUser')) { ?>
		<a href="/Memberteam/memberteamUpdateUser?id=<?php echo $val['member_id'];?>">编辑</a>
		<?php } ?>
		</td> 
	</tr>
	<tr>
		<td colspan="7"><hr/></td>
	</tr>
	<?php }  } else {?>
	<tr>
		<td colspan="7">暂时没有相关内容</td>
	</tr>
	<?php } ?>
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
	<a href="/Memberteam/memberteamListUser?page=<?php echo $i; ?>"><?php echo $i; ?></a>&nbsp;		
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
<a href="/Memberteam/memberteamListUser?page=<?php echo $ii; ?>"><?php echo $ii; ?></a>&nbsp;
<?php } 
	 }
 ?>
</p>
<!--  eof 页码  -->
</div>
<script type="text/javascript">
$(document).ready(function(){
	$(".sureDel").click(function(){
		if(confirm("确定要删除吗？"))
		{
			return true;
		}
		return false;
	});		
});

</script>
</body>
</html>
