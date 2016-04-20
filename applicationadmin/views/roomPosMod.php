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
	<script type="text/javascript" src="<?php echo URL_APP;?>/js/jquery-1.8.3.min.js"></script>
</head>
<body class="roomList">
<div class="roomListInfos container">
<h3 class="headerLineBackground">批量修改</h3>
<div class="modMuch">
<?php 
if(hasPerssion($_SESSION['role'], 'posLocation')){ ?>	
	<div class="modBox">
		<p><a href="javascript:void(0);" id="modType">批量修改牌位类型</a></p>
		<input type="hidden" name="max" value="<?php echo $max_min['max'];?>" />
		<input type="hidden" name="min" value="<?php echo $max_min['min'];?>" />
		<div class="modType">
			&nbsp;&nbsp;开始位置:&nbsp;<input type="number" name="start" value="" />(最小值<?php echo $max_min['min'];?>)
			&nbsp;&nbsp;截止位置:&nbsp;<input type="number" name="end" value="" />
			(最大值<?php echo $max_min['max'];?>)&nbsp;&nbsp;
			牌位类型:&nbsp;<select name="location_type">
				<option value="1">高端定制</option>
				<option value="0">随机/生辰八字</option>
			</select>&nbsp;&nbsp;
			<input type="submit" name="subType" value="提交类型修改" />
		</div>
	</div>

	<div class="modBox">
		<p><a href="javascript:void(0);" id="modPrice">批量修改捐赠额</a></p>
		<div class="modPrice">
			&nbsp;&nbsp;开始位置:&nbsp;<input type="number" name="startPrice" value="" />(最小值<?php echo $max_min['min'];?>)
			&nbsp;&nbsp;截止位置:&nbsp;<input type="number" name="endPrice" value="" />
			(最大值<?php echo $max_min['max'];?>)&nbsp;&nbsp;
			捐赠额：&nbsp;<input type="number" name="price" value="" />&nbsp;&nbsp;
			<input type="submit" name="subPrice" value="提交捐赠额修改" />
		</div>
	</div>
	
	<div class="modBox">
		<p><a href="javascript:void(0);" id="modDetails">批量修改牌位详情</a></p>
		<div class="modDetails">
			&nbsp;&nbsp;开始位置:&nbsp;<input type="number" name="startDetails" value="" />(最小值<?php echo $max_min['min'];?>)
			&nbsp;&nbsp;截止位置:&nbsp;<input type="number" name="endDetails" value="" />
			(最大值<?php echo $max_min['max'];?>)&nbsp;&nbsp;
			详情说明：&nbsp;<input type="text" name="details" value="" style="width:368px;" />&nbsp;&nbsp;
			<input type="submit" name="subDetails" value="提交牌位详情修改" />
		</div>
	</div>	
	<?php }else{
		echo '无权限,请点击左栏目操作';
			}?>



</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$(".modPrice").hide();
	$(".modType").hide();
	$(".modDetails").hide();
	$("#modType").click(function(){
		$(".modType").toggle();
		$(".modPrice").hide();
		$(".modDetails").hide();
	});

	$("#modPrice").click(function(){
		$(".modPrice").toggle();
		$(".modType").hide();
		$(".modDetails").hide();
	});

	$("#modDetails").click(function(){
		$(".modDetails").toggle();
		$(".modPrice").hide();
		$(".modType").hide();
	});	
	// 最大值
	var maxValue = $("input[name='max']").val();
	// 最小值
	var minValue = $("input[name='min']").val();
	// url
	var url = "<?php echo URL_APP_C;?>/Room/modifyInfo";	
	// 类型提交
	$("input[name='subType']").click(function(){
		var start = $("input[name='start']").val();
		var end = $("input[name='end']").val();
		var location_type = $("select[name='location_type']").val();
		if(start == '' || end == "")
		{
			alert("请输入正确的起始和截止位置值");
			return false;
		}
		if(parseInt(start) < parseInt(minValue))
		{
			alert("起始值不能小于"+minValue);
			return false;
		}
		if(parseInt(end) > parseInt(maxValue))
		{
			alert("截止值不能大于"+maxValue);
			return false;
		}
		if(parseInt(start) > parseInt(end))
		{
			alert("截止值不能小于起始值");
			return false;
		}
		var param = {start:start,end:end,type:'type',location_type:location_type}
		$.post(url,param,function(data){
			alert(data.msg);
		},'json');
	});

	// 捐赠额提交
	$("input[name='subPrice']").click(function(){
		var start = $("input[name='startPrice']").val();
		var end = $("input[name='endPrice']").val();
		var price = $("input[name='price']").val();
		if(start == '' || end == "")
		{
			alert("请输入正确的起始和截止位置值");
			return false;
		}
		if(parseInt(start) < parseInt(minValue))
		{
			alert("起始值不能小于"+minValue);
			return false;
		}
		if(parseInt(end) > parseInt(maxValue))
		{
			alert("截止值不能大于"+maxValue);
			return false;
		}
		if(parseInt(start) > parseInt(end))
		{
			alert("截止值不能小于起始值");
			return false;
		}
		var param = {start:start,end:end,type:'price',price:price}
		$.post(url,param,function(data){
			alert(data.msg);
		},'json');

	});

	// 详情修改
	$("input[name='subDetails']").click(function(){
		var start = $("input[name='startDetails']").val();
		var end = $("input[name='endDetails']").val();
		var details = $("input[name='details']").val();
		if(start == '' || end == "")
		{
			alert("请输入正确的起始和截止位置值");
			return false;
		}
		if(parseInt(start) < parseInt(minValue))
		{
			alert("起始值不能小于"+minValue);
			return false;
		}
		if(parseInt(end) > parseInt(maxValue))
		{
			alert("截止值不能大于"+maxValue);
			return false;
		}
		if(parseInt(start) > parseInt(end))
		{
			alert("截止值不能小于起始值");
			return false;
		}
		
		var param = {start:start,end:end,type:'details',details:details}
		$.post(url,param,function(data){
			alert(data.msg);
		},'json');
	});		
});
</script>
</body>
</html>
