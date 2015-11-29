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
<h2 class="headerLineBackground">会员列表 信息</h2>
<table border="0" cellspacing="5" cellpadding="5" width="100%">
	<tr>
		<th width="30%" align="center">会员身份证号</th>
		<th  width="10%" align="center">选择的牌位</th>
		<th  width="15%" align="center">会员类型</th>
		<th  width="10%" align="center">选择的次数</th>
		<th  width="30%" align="center">选号时间</th>
	</tr>
	<?php 
	foreach($result as $key=>$val){
	?>
	<tr <?php echo ($key % 2) ? 'class="listRoomColumns"' : '';?>class="fuck">
		<td width="30%" align="center"><?php echo $val['body_id'];?></td>
		<td  width="10%" align="center"><?php echo $val['user_location_id'] ? $val['user_location_id'] : '无 ';?></td>
		<td  width="15%" align="center">
		<?php 
		if($val['user_type'] == 2)
		{
			echo '高端用户';
		}elseif($val['user_type'] == 1)
		{
			echo '生辰八字';
		}elseif($val['user_type'] < 0)
		{
			echo '无';
		}else {
			echo '随机用户';
		}
		// echo $val['user_type'] == 2 ? '高端用户' : ($val['user_type'] == 1 ? '生辰八字': '随机用户');?>
		</td>
		<td  width="10%" align="center"><?php echo $val['user_selected'];?></td>
		<td  width="30%" align="center"><?php echo $val['user_selected_date'] ? date('Y-m-d H:i:s',$val['user_selected_date']) : '无';?></td>
	</tr>
	<?php } ?>
</table>

<p class="roomListPage">
共有会员数：<?php echo $total;?>
&nbsp;&nbsp;页码：<?php echo $page;?>/<?php echo $totalPage; ?>
<?php if($page > 1) {?>
&nbsp;&nbsp;<a href="/Member/index?page=1">首页</a>
&nbsp;&nbsp;<a href="/Member/index?page=<?php echo ($page - 1);?>">上一页</a>
<?php } ?>
<?php if($page < $totalPage) { ?>
&nbsp;&nbsp;<a href="/Member/index?page=<?php echo ($page+1);?>">下一页</a>
&nbsp;&nbsp;<a href="/Member/index?page=<?php echo $totalPage;?>">末页</a>
<?php } ?>
</p>
</div>
<div class="footer">
所有权归本站所有
</div>
<script type="text/javascript">
function sureDel()
{
	if(confirm("你确定要删除吗？请谨慎操作!"))
	{
		return true;
	}
	return false;
}
</script>
</body>
</html>
