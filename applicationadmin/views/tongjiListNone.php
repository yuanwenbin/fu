<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>系统后台</title>
	<link href="<?php echo URL_APP;?>/css/style.css" rel="stylesheet" type="text/css" />
    <link type="text/css" href="<?php echo URL_APP;?>/css/jquery-ui-1.8.17.custom.css" rel="stylesheet" />
     <link type="text/css" href="<?php echo URL_APP;?>/css/jquery-ui-timepicker-addon.css" rel="stylesheet" />
     <style type="text/css">
	select{min-width:80px;}	
	.tongJiPage{width:90%; text-align:center;padding-top:20px;}
	</style>
    <script type="text/javascript" src="<?php echo URL_APP;?>/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?php echo URL_APP;?>/js/jquery-ui-1.8.17.custom.min.js"></script>
	<script type="text/javascript" src="<?php echo URL_APP;?>/js/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="<?php echo URL_APP;?>/js/jquery-ui-timepicker-zh-CN.js"></script>
    <script type="text/javascript">
   
    $(function () {
        $(".ui_timepicker").datetimepicker({
            //showOn: "button",
            //buttonImage: "./css/images/icon_calendar.gif",
            //buttonImageOnly: true,
            
            showSecond: true,
            timeFormat: 'hh:mm:ss',
            stepHour: 1,
            stepMinute: 1,
            stepSecond: 1
            
        })
    }) 
    </script>	
<body class="roomList">
<div class="roomListInfos container">
	<h3 class="headerLineBackground">房间牌位统计信息</h3>
	<div class="tongJiSearch">
	    <form action="<?php echo URL_APP_C;?>/Tongji/tongjiList" method="get"> 
	    <?php if(isset($roomList) && $roomList) {?>
	    &nbsp;&nbsp;房间:
	    <select name="roomList">
	    <option value=""></option> 
	    <?php foreach($roomList as $v){?>
	    <option value="<?php echo $v['room_id']; ?>" <?php if($v['room_id'] == $order_room_id) echo 'selected';?>><?php echo $v['room_alias']."&nbsp;".'('.$v['room_id'].')'; ?></option>
	    <?php }?>
	    	
	    </select> 
	    <?php } ?>
	    &nbsp;&nbsp;
	    牌位编号：<input type="text" name="location_info" value="" />
	    &nbsp;&nbsp;
	    开始时间:  
	    <input type="text" name="datetime" class="ui_timepicker" value="<?php echo isset($startTime) && !empty($startTime) ? date('Y-m-d H:i:s',$startTime) : '';?>" />
	        &nbsp;
	    结束时间:  
	    <input type="text" name="datetimes" class="ui_timepicker" value="<?php echo isset($endTime) && !empty($endTime) ? date('Y-m-d H:i:s',$endTime) : '';?>" />
	    &nbsp;
	    <input type="submit" name="submit" value="查找" />
	    </form>
	</div>

	<div class="tongJiTop">
	<table width="100%" cellpadding="0" cellspacing="0">
	    <tr>
			<td width="18%" align="left">房间总数:&nbsp;<span class="numberColor"><?php echo $room_list_count['total']; ?></span></td>

	    	<td width="18%" align="left">牌位总数:&nbsp;<span class="numberColor"><?php echo $posCount['total']; ?></span></td>
	    	<td width="18%" align="left">未销售:&nbsp;<span class="numberColor">
	    	<?php echo ($posCount['total'] - $complete - $posIng); ?></span></td>
	    	<td width="18%" align="left"><span class="statusArea_0">已销售:</span>&nbsp;<span class="numberColor statusArea_0">
	    	<?php echo $complete; ?>
	    	</span></td>
	    	<td width="18%" align="left"><span class="statusArea_1">锁定中:</span>&nbsp;<span class="statusArea_1" style="weight:bold;">
	    	<?php echo $posIng; ?>
	    	</span></td>	    	
	    </tr>               
	</table>
	</div>
	<?php if($list) { ?>
	<div class="tongjiArea">
		<ul>
		<?php foreach($list as $v) { ?>
		<li class="statusArea_<?php  echo $v['location_number'];?>">
		<a href="<?php echo URL_APP_C;?>/Room/posLocation?id=<?php echo $v['localtion_id'];?>">
		<?php echo $v['location_area']; ?><?php echo $v['location_prefix']; ?><?php echo strlen($v['location_code']) == 1 ? '0'.$v['location_code'] : $v['location_code']; ?>(<?php echo $v['localtion_id']; ?>)
		<?php if($v['location_status']) echo '*';?>
		</a></li>
		<?php } ?>
	</ul>
	<div style="clear:both;"></div>

	</div>
	<?php	} ?>
	
	
<!--  bof 页码  -->
<p class="pages">
 总页码：<?php echo $totalPages; ?>&nbsp;&nbsp; 页码列表：  
<?php 
if($page > 1) { 
	$fromPage = $page - 5;
	
	for($i = $fromPage; $i < $page;$i++) { 
		if($i < 1)
		{
			continue;
		}
?>
	<a href="<?php echo URL_APP_C;?>/Tongji/tongjiList?datetime=<?php echo isset($startTime) && !empty($startTime) ? date('Y-m-d H:i:s',$startTime) : '';?>&datetimes=<?php echo isset($endTime) && !empty($endTime) ? date('Y-m-d H:i:s',$endTime) : '';?>&page=<?php echo $i; ?>&roomList=<?php echo $order_room_id; ?>"><?php echo $i; ?></a>&nbsp;		
<?php } }
	$toPage = $page + 5;
	for($ii=$page; $ii<=$toPage;$ii++)
	{
		if($ii > $totalPages)
		{
			break;
		}
?>
<?php if($ii == $page) {?>
<font><?php echo $ii; ?></font>&nbsp;
<?php }else {?>
<a href="<?php echo URL_APP_C;?>/Tongji/tongjiList?datetime=<?php echo isset($startTime) && !empty($startTime) ? date('Y-m-d H:i:s',$startTime) : '';?>&datetimes=<?php echo isset($endTime) && !empty($endTime) ? date('Y-m-d H:i:s',$endTime) : '';?>&page=<?php echo $ii; ?>&roomList=<?php echo $order_room_id; ?>"><?php echo $ii; ?></a>&nbsp;
<?php } 
	 }
 ?>
</p>
<!--  eof 页码  -->	
	
	
</div>

</body>
</html>
