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
<h3 class="headerLineBackground">文章分类信息</h3>
<?php
if(!$cate_name) { ?>
	暂时无相关房间，<a href="<?php echo URL_APP_C;?>/Article/listCate">点击增加文章分类</a>
<?php }else {
?>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<th  width="10%" align="center">注册时间</th>
		<th width="27%" align="center">文章分类名称</th>
		<th  width="10%" align="center">上级</th>
		<th  width="10%" align="center">状态</th>
		<th  width="15%" align="center">排序</th>
		<th  width="25%" align="center">操作</th>
	</tr>
	<?php 
	foreach($cate_name as $key=>$val){
	?>
	<tr>
		<td width="10%" align="center"><?php echo $val['cate_id'];?></td>
		<td  width="27%" align="center"><?php echo $val['cate_name'];?></td>
		<td  width="10%" align="center">
		<?php 
		if($val['cate_parent'])
		{
			echo $cateList[$val['cate_parent']];
		}else
		{
			echo '无';
		}
		?>
		</td>
		<td  width="10%" align="center"><?php echo $val['cate_show'] ? '开放' : '关闭';?></td>
		<td  width="15%" align="center"><?php echo $val['cate_sort'];?></td>
		<td  width="25%" align="center">
		<?php 
		if(hasPerssion($_SESSION['role'], 'delCate')){ ?>
		&nbsp;<a onclick="return sureDel();" href="<?php echo URL_APP_C;?>/Article/delCate?cate_id=<?php echo $val['cate_id'];?>">删除</a>
		<?php } ?>
		<?php 
		if(hasPerssion($_SESSION['role'], 'updateCate')){ ?>
		&nbsp;<a href="<?php echo URL_APP_C;?>/Article/updateCate?cate_id=<?php echo $val['cate_id'];?>">编辑</a>
		<?php } ?>
		</td>	
	</tr>
	<tr>
		<td colspan="6"><hr/></td>
	</tr>
	<?php } ?>
</table>
<?php } ?>

</div>

<script type="text/javascript">
function sureDel()
{
	if(confirm("你确定要删除吗？文章分类和文章都会被删除，请谨慎操作!"))
	{
		return true;
	}
	return false;
}
</script>
</body>
</html>
