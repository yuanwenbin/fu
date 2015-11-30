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
</head>
<body class="defaultInfos">
<h2 class="headerLineBackground">房间牌位查询</h2>

<!-- bof one -->
<div class="divInfos1 searchListPos">
<form method="get" action="/Room/roomPosListSearch">
查询房间号:
<select name="roomId">
<option value="all" <?php if(!$room_id){echo "selected";}?>>全部</option>
<?php 
if(isset($roomList) && $roomList)
{
    foreach($roomList as $v){
?>
<option value="<?php echo $v['room_id'];?>" <?php if($room_id == $v['room_id']){echo "selected";}?>><?php echo $v['room_id'];?></option>
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
<option value="2" <?php if($status == 2){echo 'selected';}?>>末出售</option>
<option value="1" <?php if($status == 1){echo 'selected';}?>>出售中</option>
<option value="3" <?php if($status == 3){echo 'selected';}?>>已出售</option>
</select>
&nbsp;
<input type="submit" name="submit" value="查询" />
</form>
</div>
<!-- eof one -->

<!--  bof infos -->
<br />
请按以上条件查询相关信息
<!--  eof infos -->

</body>
</html>