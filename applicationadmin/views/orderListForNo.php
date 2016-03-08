<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>订单查询-默认展示信息</title>
	<link href="/css/style.css" rel="stylesheet" type="text/css" />
    <link type="text/css" href="/css/jquery-ui-1.8.17.custom.css" rel="stylesheet" />
     <link type="text/css" href="/css/jquery-ui-timepicker-addon.css" rel="stylesheet" />
     <style type="text/css">
	.pages{width:95%;}
	</style>
    <script type="text/javascript" src="/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="/js/jquery-ui-1.8.17.custom.min.js"></script>
	<script type="text/javascript" src="/js/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="/js/jquery-ui-timepicker-zh-CN.js"></script>
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
</head>
<body class="defaultInfos">
<div class="container">
<h2 class="headerLineBackground">订单列表</h2>
<!--  bof infos -->
<div class="roomListInfos orderListDiv">
<?php if(!$resultList){?>
没有数据
<?php } else { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<th width="12%" align="center">用户名</th>
	<th width="8%" align="center">房间号</th>
	<th width="20%" align="center">牌位号信息</th>
	<th width="10%" align="center">牌位类型</th>
	<th width="12%" align="center">下单时间</th>
	<th width="10%" align="center">金额</th>
	<th width="8%" align="center">是否支付</th>
	<th width="8%" align="center">订单来源</th>
	<th width="5%" align="center">操作</th>
	<th width="7%" align="center">操作员</th>

</tr>

<tr>
	<td width="12%" align="center"><?php echo $resultList['order_user']; ?></td>
	<td width="8%" align="center"><?php echo $resultList['order_room_id']; ?></td>
	<td width="16%" align="center">
	<?php  echo $resultList['room_alias'].'-'.$resultList['location_area'].$resultList['location_prefix']; ?>
	<?php echo strlen($resultList['location_code']) == 1 ? '0'.$resultList['location_code'] : $resultList['location_code']; ?>
	<?php echo '('.$resultList['order_location_id'].')'; ?>
	</td>
	<td width="10%" align="center">
	<?php if($resultList['order_location_type']==1){
		echo '高端定制';
	}elseif($resultList['order_location_type']==2){
		echo '生辰八字';
	}else{
		echo '随机';
	} 
	?>
	 </td>
	<td width="12%" align="center"><?php echo date('Y-m-d H:i:s', $resultList['order_datetime']); ?></td>
	<td width="10%" align="center"><?php echo $resultList['order_price']; ?></td>
	<td width="8%" align="center">
	<?php
	if($resultList['order_payment'])
	{
		echo '已支付';
	}else
	{
		echo '未支付';
	}
	?>
	</td>
	<td width="8%" align="center">
	<?php  echo $resultList['source']; ?> 
	</td>
	<td width="5%" align="center" class="orderListDetails">
	<a href="/Order/posInfos?id=<?php echo $resultList['order_id']; ?>">
	查看
	</a>
	</td>
	<td width="7%" align="center"><?php echo $resultList['order_admin']; ?></td>
</tr>
	<tr>
		<td colspan="10"><hr/></td>
	</tr>




</table>
<?php } ?>


</div>

<!--  eof infos -->
</div>

</body>
</html>