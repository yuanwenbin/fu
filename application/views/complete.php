<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>我的选号</title>
<meta name="keywords" content="seo keyword" />
<meta name="description" content="description" />
<link type="text/css" rel="stylesheet" href="<?php echo URL_APP;?>/css/style.css">
<script src="<?php echo URL_APP;?>/js/jquery-1.8.3.min.js" type="text/javascript"></script>
</head>
<body class="bodyMyNo">
<!-- bof container-->
<div class="container">
	<!-- bof 11 -->
	<div class="sjTop">
	<ul>
	<li><a href="javascript:void(0);" class="hasNo"><img src="<?php echo URL_APP;?>/images/sjBtn.png" /></a></li>
	<li><a href="javascript:void(0);"  class="hasNo"><img src="<?php echo URL_APP;?>/images/bzBtn.png" /></a></li>
	<li><a href="javascript:void(0);"  class="hasNo"><img src="<?php echo URL_APP;?>/images/gdBtn.png" /></a></li>
	<li><a href="<?php echo URL_APP_C;?>/Choice/Index"><img src="<?php echo URL_APP;?>/images/myNoImgBtn.png" /></a></li>
	</ul>
	<br class="clearBoth" />
	</div>
	<!-- eof 11 -->

	<!-- bof 22 -->
	<div class="myNoContent">
	<div class="timeTags">

	</div>
	<div class="myNoChoice">
		<table>
			<tr>
				<td><img src="<?php echo URL_APP;?>/images/no.png" /></td>
				<td>&nbsp;&nbsp;<span>
				<?php echo $result['posInfo']['location_alias'];?>
				<?php echo $result['posInfo']['location_area'];?>
				<?php echo $result['posInfo']['location_prefix'];?>
				<?php echo strlen($result['posInfo']['location_code']) == 1 ? '0':'';?>
				<?php echo $result['posInfo']['location_code'];?>
				(<?php echo $result['orderInfo']['order_location_id'];?>)</span></td>
			</tr>
		</table>
	</div>

	<div class="myNoChoice">
		<table>
			<tr>
				<td><img src="<?php echo URL_APP;?>/images/status.png" /></td>
				<td>&nbsp;&nbsp;
				已经完成
				</td>
			</tr>
		</table>
	</div>

	<div class="myNoChoice">
		<table>
			<tr>
				<td><img src="<?php echo URL_APP;?>/images/level.png" /></td>
				<td>&nbsp;&nbsp;<img src="<?php echo URL_APP;?>/images/high_<?php echo $result['orderInfo']['order_location_type'];?>.png" /></td>
			</tr>
		</table>
	</div>
	<p><a href="javascript:window.print();"><img src="<?php echo URL_APP;?>/images/dyhm.png" /></a></p>
	</div>
	<!-- eof 22 -->

</div>
<!-- eof container -->
<script type="text/javascript">
$(document).ready(function(){
	$('.hasNo').click(function(){
		if(confirm("此页面是您已经选号信息，如果要重新登陆，点击确定"))
		{
			window.document.location.href="<?php echo URL_APP_C;?>/Index/menus";	
		}
	});
});
</script>
</body>
</html>