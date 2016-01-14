<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>系统登陆后台-默认展示信息</title>
	<link href="/css/style.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
	.pages{width:95%;}
	</style>
</head>
<body class="defaultInfos searchListPos">
<div class="container">
<h2 class="headerLineBackground">房间牌位查询</h2>

<!-- bof one -->
<div class="divInfosSearch">
<form method="get" action="/Room/roomPosListSearch">
查询房间:
<select name="roomId">
<option value="all" <?php if(!$room_id){echo "selected";}?>>全部</option>
<?php 
if(isset($roomList) && $roomList)
{
    foreach($roomList as $v){
?>
<option value="<?php echo $v['room_id'];?>" <?php if($room_id == $v['room_id']){echo "selected";}?>><?php echo $v['room_alias'];?>&nbsp;(<?php echo $v['room_id'];?>)</option>
<?php } } ?>
</select>
&nbsp;
牌位类型:
<select name="positionType">
<option value="all" <?php if($type == 'all'){echo 'selected';}?>>全部</option>
<option value="1" <?php if($type == 1){echo 'selected';}?>>高端定制</option>
<option value="2" <?php if($type == 2){echo 'selected';}?>>随机/生辰八字</option>
</select>
&nbsp;
销售状态：
<select name="status">
<option value="all" <?php if($status == 'all'){echo 'selected';}?>>全部</option>
<option value="2" <?php if($status == 2){echo 'selected';}?>>未出售</option>
<option value="1" <?php if($status == 1){echo 'selected';}?>>出售中</option>
<option value="3" <?php if($status == 3){echo 'selected';}?>>已出售</option>
</select>
&nbsp;
<input type="submit" name="submit" value="查询" />
</form>
</div>
<!-- eof one -->
<!--  bof infos -->
<div class="roomInfosDiv">

<table border="0" cellpadding="0" cellspacing="0" width="100%">	
	<tr class='headerLineBackground1'>
		<th width="10%" align="center">操作</th>
		<th width="15%" align="center">区域信息</th>
		<th width="11%" align="center">房间号</th>
		<th width="5%" align="center">牌位号</th>
		<th width="10%" align="center">牌位名称</th>
		<th width="5%" align="center">牌位价格</th>
		<th width="15%" align="center">牌位类型</th>
		<th width="5%" align="center">销售状态</th>
		<th width="10%" align="center">牌位失效时间</th>
		<th width="13%" align="center">牌位图片</th>
	</tr>
	<?php foreach($result as $k=>$v) {?>
	<tr <?php //echo ($k%2) ? "class='headerLineBackground1'" : '';?>>
		<td widtd="10%" align="center">
		<a href="/Room/posLocation?id=<?php echo $v['localtion_id']; ?>">编辑
		</a>
		&nbsp;|&nbsp;
		<?php if($v['location_number']!=2) { ?>
		不可删除
		<?php } else {?>
		<a href="/Room/delPos?id=<?php echo $v['localtion_id']; ?>" onclick="return sureDel();">删除</a>
		<?php } ?>
		</td>
		<td widtd="15%" align="center"><?php echo $v['location_area']; ?><?php echo $v['location_prefix']; ?><?php echo strlen($v['location_code']) == 1 ? '0'.$v['location_code'] : $v['location_code']; ?></td>
		<td widtd="11%" align="center"><?php echo $roomList[$v['location_room_id']]['room_alias'] . '('.$v['location_room_id'] . ')'; ?></td>
		<td widtd="5%" align="center"><?php echo $v['localtion_id']; ?></td>
		<td widtd="10%" align="center">
		<?php 
		if($v['location_alias'])
		{
			echo mb_substr($v['location_alias'],0,4,'utf-8');
		}
		?>	
		</td>
		<td widtd="5%" align="center"><?php echo $v['location_price']; ?></td>
		<td widtd="15%" align="center"><?php echo $v['location_type'] ? '高端定制' : '随机/生辰八字'; ?></td>
		<td widtd="5%" align="center"><?php echo $v['location_number']==2 ? '未售' : ($v['location_number'] == 1 ? '出售中' : '已售'); ?></td>
		<td widtd="10%" align="center">
		<?php 
		if($v['location_number'] == 1){
			if($v['location_date'])
			{
				echo date('Y-m-d H:i:s',$v['location_date']+7200);
			}else {
				echo '正在选号中';
			}
		}elseif($v['location_number'] == 0) 
		{
			echo '已售';	
		}else {
			echo '一直有效';
		}
		?>
		</td>
		<td widtd="13%" align="center">
		<?php 
		if($v['location_pic'])
		{
			echo "<img src='" . FRONT_DOMAIN . "/". $v['location_pic']."' width='20' height='20' />"; 
		}else {
			echo '无';
		}
		?>
		</td>	
	</tr>
	<tr>
		<td colspan="10"><hr/></td>
	</tr>
	<?php } ?>	
</table>

<!--  bof 页码  -->
<p class="pages">
总记录数：<?php echo $total;?>&nbsp;&nbsp; 总页码：<?php echo $pageTotal; ?>&nbsp;&nbsp; 页码列表：  
<?php 
if($page > 1) { 
	$fromPage = $page - 5;
	
	for($i = $fromPage; $i < $page;$i++) { 
		if($i < 1)
		{
			continue;
		}
?>
	<a href="/Room/roomPosListSearch?roomId=<?php echo $room_id; ?>&positionType=<?php echo $type;?>&status=<?php echo $status;?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>&nbsp;		
<?php } }
	$toPage = $page + 5;
	for($ii=$page; $ii<=$toPage;$ii++)
	{
		if($ii > $pageTotal)
		{
			break;
		}
?>
<?php if($ii == $page) {?>
<font><?php echo $ii; ?></font>&nbsp;
<?php }else {?>
<a href="/Room/roomPosListSearch?roomId=<?php echo $room_id; ?>&positionType=<?php echo $type;?>&status=<?php echo $status;?>&page=<?php echo $ii; ?>"><?php echo $ii; ?></a>&nbsp;
<?php } 
	 }
 ?>
</p>
<!--  eof 页码  -->
</div>
<!--  eof infos -->
</div>

</body>
</html>