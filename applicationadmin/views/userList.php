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
<div class="roomListInfos container">
<h3 class="headerLineBackground">管理员列表 信息</h3>

<table border="0" cellspacing="0" cellpadding="0" width="98%">
	<tr>
		<th width="10%" align="center">会员名</th>
		<th  width="10%" align="center">会员状态</th>
		<th  width="20%" align="center">电子邮件</th>
		<th  width="20%" align="center">注册时间</th>
		<th  width="35%" align="center">操作</th>
	</tr>
	<?php 
	foreach($result as $key=>$val){
	?>
	<tr>
		<td width="10%" align="center"><?php echo $val['admin_user'];?></td>
		<td  width="10%" align="center">
		<?php if($val['admin_status']){echo '是';}else{ echo '否';}?></td>
		<td  width="20%" align="center"><?php echo $val['admin_email'];?></td>
		<td  width="20%" align="center"><?php echo date('Y-m-d H:i:s',$val['admin_datetime']);?></td>
		<td  width="35%" align="center">
		&nbsp;<a onclick="return sureDel();" href="<?php echo URL_APP_C;?>/User/userDel?id=<?php echo $val['admin_id'];?>">删除</a>
		&nbsp;<a href="<?php echo URL_APP_C;?>/User/userInfos?id=<?php echo $val['admin_id'];?>">查看</a>
		&nbsp;<a href="<?php echo URL_APP_C;?>/User/userInfosUpdate?id=<?php echo $val['admin_id'];?>">编辑</a>
		</td>	
	</tr>
	<tr>
		<td colspan="5"><hr/></td>
	</tr>
	<?php } ?>
</table>
</div>

<script type="text/javascript">
function sureDel()
{
	if(confirm("确定要删除该员工吗!"))
	{
		return true;
	}
	return false;
}
</script>
</body>
</html>
