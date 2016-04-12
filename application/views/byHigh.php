<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>高端定制</title>
<meta name="keywords" content="seo keyword" />
<meta name="description" content="description" />
<link type="text/css" rel="stylesheet" href="<?php echo URL_APP;?>/css/style.css">
<script src="<?php echo URL_APP;?>/js/jquery-1.8.3.min.js" type="text/javascript"></script>
</head>
<body class="bodyGd">
<!-- bof container-->
<div class="container">
	<!-- bof 11 -->
	<div class="sjTop">
	<ul>
	<li><a href="<?php echo URL_APP_C;?>/Choice/byRand"><img src="<?php echo URL_APP;?>/images/sjBtn.png" /></a></li>
	<li><a href="<?php echo URL_APP_C;?>/Choice/byEight"><img src="<?php echo URL_APP;?>/images/bzBtn.png" /></a></li>
	<li><a href="javascript:void(0);"><img src="<?php echo URL_APP;?>/images/gdBtnImg.png" /></a></li>
	<li><a href="javascript:void(0);" id="noChoice"><img src="<?php echo URL_APP;?>/images/myNoBtn.png" /></a></li>
	</ul>
	<br class="clearBoth" />
	<!-- bof selectPrice -->
	<?php // print_r($priceList); PRINT_R($maxPrice);?>
	  
	<div class="selectPriceBox"> 
    &nbsp;
	</div> 
	<!-- eof selecPrice  -->		
	</div>
	<!-- eof 11 -->

	<!-- bof flag -->
	<div class="tagAbout">
		<ul>
			<li class="myNoTag">&nbsp;</li>
			<li class="quyuTag"><font><?php echo $roomInfos[$roomId]; ?>(<?php echo $roomId; ?>)</font></li>
			<li class="fuweiTag"></li>
			<li class="myNoTagBtn"><a href=""><img src="<?php echo URL_APP;?>/images/ckxq.png" /></a></li>
		</ul>
		<br class="clearBoth" />
	</div>
	<!-- eof flag -->
	<!-- bof 22 --->
	<div class="flagTags">
	<img src="<?php echo URL_APP;?>/images/hi.png" />
	</div>
	<!-- eof 22 -->

	<!-- bof 33 -->
	<div class="areaTop">
	<ul>
		<?php if($roomList) {
				foreach($roomList as $k=>$v) { 
				    if($roomId == $v) {
				    ?>
		<li class="nowChoice">
		<a href="javascript:void(0);">
		<?php echo $roomInfos[$v]; ?>(<?php echo $v; ?>)</a></li>
		<?php }else{?>
		<li>
		<a href="<?php echo URL_APP_C;?>/Choice/byHigh?roomId=<?php echo $v; ?>">
		<?php echo $roomInfos[$v]; ?>(<?php echo $v; ?>)</a></li>		
		<?php }}}else{ ?>
		<li>暂无数据</li>	
		<?php } ?>
	</ul>
	<br class="clearBoth" />
	</div>
	<!-- eof 33 -->
	<div class="tags">
	<p style="display:none;" id="tips" data-ii=""></p>
	<ul>
	<?php if($result) {
	foreach($result as $vv){ ?>
	<li data-label="<?php echo $vv['localtion_id']; ?>" data-attr="<?php echo $vv['location_number']; ?>"><a href="javascript:void(0);">
	<img alt="点击在选号区显示相关信息" title="点击在选号区显示相关信息" src="<?php echo URL_APP;?>/images/ws_<?php echo $vv['location_number']; ?>.png" />
	</a></li>
	<?php } }else { ?>
	<li>暂无数据</li>
	<?php } ?>


	</ul>
	<br class="clearBoth" />
	</div>


</div>
<!-- eof container -->
<script type="text/javascript">
$(document).ready(function(){
    // 选号提示 
    $('#noChoice').click(function(){
        alert("您暂未有选号噢，请选号！");
 	   return false;
    });
	$('.tags ul li').click(function(){
		// 获取是否可以选择的
		var liAttr = $(this).attr('data-attr');
		if(liAttr < 2 || liAttr == '')
		{
			return false;
		}
		
		// 上一次的 li index
		var oldLi = $('#tips').attr('data-ii');
		// 上一次的 img
		var oldTips = $('#tips').html();
		if(oldLi != '')
		{
			$('.tags').find('li').eq(oldLi).html(oldTips);
		}
		// 当前的 li index
		var indexTags = $(this).index();
		// 当前的属性标签
		$('#tips').attr('data-ii', indexTags);
		// 新的 img
		var newImg = $(this).html();
		$('#tips').html(newImg);
		
		$(this).html('<a href="javascript:void(0);"><img src="<?php echo URL_APP;?>/images/ws_3.png" title="当前正在查看" alt="当前正在查看"></a>');


		var url = "<?php echo URL_APP_C;?>/Choice/highDetail";
		var id = $(this).attr('data-label');
		var param = {id:id};
		$.post(url,param,function(data){
			if(data.error)
			{
				alert(data.msg);
				return false;
			}else
			{
				$('.fuweiTag').html("<font>"+data.location_alias+data.location_area+data.location_prefix+data.location_code+"("+data.position+")"+"</font>");
				if(data.sale >1)
				{
					$('.myNoTagBtn a').attr({href:"<?php echo URL_APP_C;?>/Choice/locationDetail?id="+data.position});
				}else
					$('.myNoTagBtn a').attr({href:""});				{

				}
			}
		},'json');
	});
	// 提交
	$('.myNoTagBtn').click(function(){
		var href = $('.myNoTagBtn a').attr('href');
		if(href=='')
		{
			alert("请先选择末出售的牌位");
			return false;
		}
		return true;
	});

	// 可以重新选择价格
	$("select[name='selectPriceBox']").change(function(){
		var selectPrice = $(this).val();
		var url = "<?php echo URL_APP_C;?>/Choice/selectPrice";
		var param = {price:selectPrice};
		
		$.post(url,param,function(data){
			if(!data.error)
			{
				window.location.href="<?php echo URL_APP_C;?>/Choice/byHigh";
			}	
		},'json');		
	});	
});
</script>
</body>
</html>