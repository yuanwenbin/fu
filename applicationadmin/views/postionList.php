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
<div class="roomInfosDiv container roomListInfos">
<h3>房间号:<?php echo $result[0]['location_room_id']; ?></h3>
<table border="0" cellpadding="0" cellspacing="0" width="98%">	
	<tr>
		<th width="10%" align="center">操作</th>
		<th width="5%" align="center">房间号</th>
		<th width="5%" align="center">牌位号</th>
		<th width="10%" align="center">牌位名称</th>
		<th width="5%" align="center">牌位价格</th>
		<th width="10%" align="center">牌位类型</th>
		<th width="5%" align="center">销售状态</th>
		<th width="10%" align="center">牌位失效时间</th>
		<th width="17%" align="center">牌位图片</th>
		<th width="15%" align="center">牌位描述</th>
	</tr>
	<?php foreach($result as $k=>$v) {?>
	<tr <?php // echo ($k%2) ? "class='headerLineBackground'" : '';?>>
		<td widtd="10%" align="center">
		<?php if(hasPerssion($_SESSION['role'], 'posLocation')){ ?>
		<a href="/Room/posLocation?id=<?php echo $v['localtion_id']; ?>">编辑
		</a>
		&nbsp;|
		<?php } ?>
		&nbsp;
		<?php if(hasPerssion($_SESSION['role'], 'delPos')){ ?>
		<?php if($v['location_number']!=2) { ?>
		不可删除
		<?php } else {?>
		<a href="/Room/delPos?id=<?php echo $v['localtion_id']; ?>" onclick="return sureDel();">删除</a>
		<?php } } ?>
		</td>
		<td widtd="5%" align="center"><?php echo $v['location_room_id']; ?></td>
		<td widtd="5%" align="center"><?php echo $v['localtion_id']; ?></td>
		<td widtd="10%" align="center">
		<?php 
		if($v['location_alias'])
		{
			echo mb_substr($v['location_alias'],0,4, 'utf-8');
		}
		?>	
		</td>
		<td widtd="5%" align="center"><?php echo $v['location_price']; ?></td>
		<td widtd="10%" align="center"><?php echo $v['location_type'] ? '高端定制' : '随机/生辰八字'; ?></td>
		<td widtd="5%" align="center"><?php echo $v['location_number']==2 ? '未售' : ($v['location_number'] == 1 ? '出售中' : '已售'); ?></td>
		<td widtd="10%" align="center">
		<?php 
		if($v['location_number'] == 1){
			echo date('Y-m-d H:i:s',$v['location_date']);
		}elseif($v['location_number'] == 0) 
		{
			echo '已售';	
		}else {
			echo '一直有效';
		}
		?>
		</td>
		<td widtd="17%" align="center">
		<?php 
		if($v['location_pic'])
		{
			echo "<img src='" . FRONT_DOMAIN . "/". $v['location_pic']."' width='20' height='20' />"; 
		}else {
			echo '无';
		}
		?>
		</td>
		<td widtd="15%" align="center">
		<?php 
		if($v['location_details'])
		{
			echo mb_substr($v['location_details'],0,10,'utf-8');
		}else {
			echo '无';
		}
		?>		
		</td>	
	</tr>
	<tr>
		<td colspan="10"><hr /></td>
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
	<a href="/Room/postionList?id=<?php echo $roomId; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>&nbsp;		
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
<a href="/Room/postionList?id=<?php echo $roomId; ?>&page=<?php echo $ii; ?>"><?php echo $ii; ?></a>&nbsp;
<?php } 
	 }
 ?>
</p>
<!--  eof 页码  -->

</div>

<script type="text/javascript">
function sureDel()
{
	if(confirm("确定要删除吗？"))
	{
		return true;
	}
	return false;
}
</script>
</body>
</html>
