<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>我的选号</title>
<meta name="keywords" content="seo keyword" />
<meta name="description" content="description" />
<link type="text/css" rel="stylesheet" href="/css/style.css">
<script src="/js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script type="text/javascript"> 
 var SysSecond; 
 var InterValObj; 
  
 $(document).ready(function() { 
  SysSecond = parseInt($("#remainSeconds").html()); //这里获取倒计时的起始时间 
  InterValObj = window.setInterval(SetRemainTime, 1000); //间隔函数，1秒执行 
 }); 
 
 //将时间减去1秒，计算天、时、分、秒 
 function SetRemainTime() { 
  if (SysSecond > 0) { 
   SysSecond = SysSecond - 1; 
   var second = Math.floor(SysSecond % 60);             // 计算秒     
   var minite = Math.floor((SysSecond / 60) % 60);      //计算分 
   var hour = Math.floor((SysSecond / 3600) % 24);      //计算小时 
   $("#remainTime").html(hour + "小时" + minite + "分" + second + "秒");

  } else {//剩余时间小于或等于0的时候，就停止间隔函数 
	$('#noEffect').html("&nbsp;失效");
   window.clearInterval(InterValObj);
   window.location.href="/Index/index";	
   //这里可以添加倒计时时间为0后需要执行的事件 
  } 
 } 
</script> 
</head>
<body class="bodyMyNo">
<!-- bof container-->
<div class="container">
	<!-- bof 11 -->
	<div class="sjTop">
	<ul>
	<li><a href="javascript:void(0);" class="hasNo"><img src="/images/sjBtn.png" /></a></li>
	<li><a href="javascript:void(0);"  class="hasNo"><img src="/images/bzBtn.png" /></a></li>
	<li><a href="javascript:void(0);"  class="hasNo"><img src="/images/gdBtn.png" /></a></li>
	<li><a href="/Choice/Index"><img src="/images/myNoImgBtn.png" /></a></li>
	</ul>
	<br class="clearBoth" />
	</div>
	<!-- eof 11 -->

	<!-- bof 22 -->
	<div class="myNoContent">
	<div class="timeTags">
	<table>
		<tr>
			<td><img src="/images/clock18.png" /></td>
			<td>
			<?php
				$effectTime = $result['orderInfo']['order_datetime'] + 7200;
				$effect = $effectTime - time();
			?>
			&nbsp;
			<div id="remainSeconds" style="display:none"><?php echo $effect;?></div>
			<font id="remainTime">
			<?php if($effect > 0){ 
					echo '加载中...';
				}else{
					echo '失效';
				} ?>
				</font> 
			</td>
		</tr>
	</table>
	</div>
	<div class="myNoChoice">
		<table>
			<tr>
				<td><img src="/images/no.png" /></td>
				<td>&nbsp;&nbsp;<span>
				<?php echo $result['posInfo']['location_alias'];?>
				<?php echo $result['posInfo']['location_area'];?>
				<?php echo $result['posInfo']['location_prefix'];?>
				<?php echo $result['posInfo']['location_code'];?>				
				(<?php echo $result['orderInfo']['order_location_id'];?>)</span></td>
			</tr>
		</table>
	</div>

	<div class="myNoChoice">
		<table>
			<tr>
				<td><img src="/images/status.png" /></td>
				<td id="noEffect">&nbsp;&nbsp;
				<?php 
				if($effect > 0){ ?>
				<img src="/images/affect.png" />
				<?php }else { ?>
				失效
				<?php } ?>
				</td>
			</tr>
		</table>
	</div>

	<div class="myNoChoice">
		<table>
			<tr>
				<td><img src="/images/level.png" /></td>
				<td>&nbsp;&nbsp;<img src="/images/high_<?php echo $result['orderInfo']['order_location_type'];?>.png" /></td>
			</tr>
		</table>
	</div>
	<p><a href="javascript:window.print();"><img src="/images/dyhm.png" /></a></p>
	</div>
	<!-- eof 22 -->

</div>
<!-- eof container -->
<script type="text/javascript">
$(document).ready(function(){
	$('.hasNo').click(function(){
		if(confirm("此页面是您已经选号信息，如果要重新登陆，点击确定"))
		{
			window.document.location.href="/Index/menus";	
		}
	});


});
</script>
</body>
</html>