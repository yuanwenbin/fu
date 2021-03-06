<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>系统登陆后台-默认展示信息</title>
	<link href="<?php echo URL_APP;?>/css/style.css" rel="stylesheet" type="text/css" />
    <link type="text/css" href="<?php echo URL_APP;?>/css/jquery-ui-1.8.17.custom.css" rel="stylesheet" />
     <link type="text/css" href="<?php echo URL_APP;?>/css/jquery-ui-timepicker-addon.css" rel="stylesheet" />
     <style type="text/css">
	.pages{width:95%;}
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
</head>
<body class="defaultInfos">
<div class="container">
<h2 class="headerLineBackground">捐赠列表</h2>

<!-- bof one -->
<div class="divInfos1 searchListPos">
<form method="get" action="<?php echo URL_APP_C;?>/Order/orderList">
&nbsp;
牌位编号：<input type="text" name="location_info" value="">
&nbsp;
房间号:
<input name="order_room_id" type="number" style="width:60px;" value="<?php echo $result['order_room_id'];?>" />
&nbsp;
订单牌位类型:
<select name="order_location_type">
<option value="all" <?php if($result['order_location_type'] == 'all'){echo 'selected';}?>>全部</option>
<option value="0" <?php if($result['order_location_type'] != 'all' && $result['order_location_type'] == '0'){echo 'selected';}?>>随机牌位/生辰八字</option>
<option value="1" <?php if($result['order_location_type'] == 1){echo 'selected';}?>>高端定制</option>
</select>
&nbsp;
支付状态：
<select name="order_payment">
<?php
if($result['order_payment'] == 'all'){
?>
<option value="all" selected>全部</option>
<option value="0">未支付</option>
<option value="1">已支付</option>
<?php
}elseif($result['order_payment'] == 1)
{
?>
<option value="all">全部</option>
<option value="0">未支付</option>
<option value="1"  selected>已支付</option>
<?php
}else
{
?>
<option value="all">全部</option>
<option value="0"  selected>未支付</option>
<option value="1">已支付</option>
<?php
}
?>
</select>
&nbsp;
身份证号：
<input type="text" name="bodyId" value="<?php echo $result['bodyId'];?>" />
&nbsp;
开始时间:  
<input type="text" name="datetime" class="ui_timepicker" value="<?php echo $result['datetime'] ? date('Y-m-d H:i:s', $result['datetime']) : '';?>" />
    &nbsp;
结束时间:  
<input type="text" name="datetimes" class="ui_timepicker" value="<?php echo $result['datetimes'] ? date('Y-m-d H:i:s', $result['datetimes']) : '';?>" />
&nbsp;
<input type="submit" name="submit" value="查询" />
</form>
</div>
<!-- eof one -->

<!--  bof infos -->
<div class="roomListInfos orderListDiv">
<?php if(!$result['totalNumber'] || !$result['resultList']){?>
没有数据
<?php } else { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<th width="15%" align="center">用户名</th>
	<th width="8%" align="center">房间号</th>
	<th width="20%" align="center">牌位号信息</th>
	<th width="10%" align="center">牌位类型</th>
	<th width="12%" align="center">捐赠时间</th>
	<!--  <th width="10%" align="center">金额</th> -->
	<th width="8%" align="center">是否捐赠</th>
	<th width="6%" align="center">订单来源</th>
	<th width="10%" align="center">操作</th>
	<th width="11%" align="center">到期时间</th>

</tr>
<?php
foreach($result['resultList'] as $k=>$v){
?>
<tr>
	<td width="15%" align="center"><?php echo $v['order_user']; ?></td>
	<td width="8%" align="center"><?php echo $v['order_room_id']; ?></td>
	<td width="20%" align="center">
	<?php echo $v['roomInfos']['room_alias'].'-'.$v['locationInfos']['location_area'].$v['locationInfos']['location_prefix']; ?>
	<?php echo strlen($v['locationInfos']['location_code']) == 1 ? '0'.$v['locationInfos']['location_code'] : $v['locationInfos']['location_code']; ?>
	<?php echo '('.$v['order_location_id'].')'; ?>
	</td>
	<td width="10%" align="center">
	<?php if($v['order_location_type']==1){
		echo '高端定制';
	}elseif($v['order_location_type']==2){
		echo '生辰八字';
	}else{
		echo '随机';
	} 
	?>
	 </td>
	<td width="12%" align="center"><?php echo date('Y-m-d H:i:s', $v['order_datetime']); ?></td>
	<!--  <td width="10%" align="center"><?php // echo $v['order_price']; ?></td> -->
	<td width="8%" align="center">
	<?php
	if($v['order_payment'])
	{
		echo '已支付';
	}else
	{
		echo '未支付';
	}
	?>
	</td>
	<td width="6%" align="center">
	<?php echo $v['source'] ? $source[$v['source']] :'管理员：' .$username; ?> 
	</td>
	<td width="10%" align="center" class="orderListDetails">
	<a href="<?php echo URL_APP_C;?>/Order/posInfos?id=<?php echo $v['order_id']; ?>">
	查看
	</a>&nbsp;&nbsp;
	<?php if(hasPerssion($_SESSION['role'],'delOrder')) { ?>
	<a data-attr="<?php echo $v['order_id']; ?>" class="del" href="javascript:void(0);">删除</a>		
	<?php } ?>
	
	<?php if(!$v['order_payment'] && hasPerssion($_SESSION['role'],'posInfosDeal')) {?>
	<a href="<?php echo URL_APP_C;?>/Order/addDate?id=<?php echo $v['order_id']; ?>">报备</a>
	<?php }?>
	</td>
	<td width="11%" align="center">
	<?php 
    if(!$v['order_payment'])
    {
        echo date('Y-m-d H:i:s', $v['order_datetime']+$v['add_datetime']+7200);   
    }
	?></td>
</tr>
	<tr>
		<td colspan="9"><hr/></td>
	</tr>
<?php } ?>



</table>
<?php } ?>


<!--  bof 页码  -->
<?php 
	$datetime = '';
	$datetimes = '';
	$datetime = isset($result['datetime']) && $result['datetime'] ? date('Y-m-d H:i:s', $result['datetime']) : '';
	$datetimes = isset($result['datetimes']) && $result['datetimes'] ? date('Y-m-d H:i:s', $result['datetimes']) : '';
	$preUrl="/Order/orderList?order_room_id=".$result['order_room_id']."&order_location_type=".$result['order_location_type'];
	$preUrl .= "&order_payment=".$result['order_payment']."&bodyId=".$result['bodyId']."&datetime=".$datetime."&datetimes=".$datetimes;
?>
<p class="pages">
总记录数：<?php echo $result['totalNumber'];?>&nbsp;&nbsp; 总页码：<?php echo $result['page'];?>/<?php echo $result['totalPage'];?>&nbsp;&nbsp; 页码列表：  
<?php 
if($result['page'] > 1) { 
	$fromPage = $result['page'] - 5;
	
	for($i = $fromPage; $i < $result['page'];$i++) { 
		if($i < 1)
		{
			continue;
		}
?>
	<a href="<?php echo URL_APP_C;?><?php echo $preUrl;?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>&nbsp;		
<?php } }
	$toPage = $result['page'] + 5;
	for($ii=$result['page']; $ii<=$toPage;$ii++)
	{
		if($ii > $result['totalPage'])
		{
			break;
		}
?>
<?php if($ii == $result['page']) {?>
<font><?php echo $ii; ?></font>&nbsp;
<?php }else {?>
<a href="<?php echo URL_APP_C;?><?php echo $preUrl;?>&page=<?php echo $ii; ?>"><?php echo $ii; ?></a>&nbsp;
<?php } 
	 }
 ?>
</p>
<!--  eof 页码  -->
</div>

<!--  eof infos -->
</div>
<script>
$(document).ready(function(){
    $(".del").click(function(){
        var order_id = $(this).attr('data-attr');
        var order_url = "<?php echo URL_APP_C;?>/Order/delOrder";
        var param = {order_id:order_id};
        if(confirm("你确定要删除该订单吗？删除后不可恢复"))
        {
            $.post(order_url,param,function(data){
               alert(data.msg);
               window.location.href="<?php echo URL_APP_C;?>/Order/orderList"; 
             },'json');
        }
    });
})
</script>
</body>
</html>