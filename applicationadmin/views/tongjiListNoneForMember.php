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
<body class="roomList">
<div class="roomListInfos container">
	<h3 class="headerLineBackground">义工统计</h3>

	<div class="tongJiSearch">
	    <form action="<?php echo URL_APP_C;?>/Tongji/tongjiListSearchMember" method="get"> 
	    &nbsp;&nbsp;
	    <select name="type">
	    <option value="1">按手机号码查找</option>
	    <option value="2">登陆用户名</option>
	    <option value="3">真实姓名</option>
	    </select>
	    查找内容：<input type="text" name="searchInfo" value="" />
	    &nbsp;&nbsp;

	    <input type="submit" name="submit" id="searchMember" value="业务员查找" />
	    </form>
	</div>		
	
	<div class="tongJiTop">
	<table width="100%" cellpadding="0" cellspacing="0">
	    <tr>
	    	<td width="18%" align="left"><span class="statusArea_0">已销售:</span>&nbsp;<span class="numberColor statusArea_0">
	    	<?php echo $payIds; ?>
	    	</span></td>
	    	<td width="18%" align="left"><span class="statusArea_1">锁定中:</span>&nbsp;<span class="statusArea_1" style="weight:bold;">
	    	<?php  echo $lockIds; ?>
	    	</span></td>	    	
	    </tr>               
	</table>
	</div>
	<?php if($data) { ?>
	<div class="tongjiArea">
		<ul>
		<?php foreach($data as $v) { ?>
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
	
	

	
	
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#searchMember").click(function(){
	    var tel = $("input[name='searchInfo'").val();
	    if(tel=='')
	    {
	        alert("请输入查找内容");
	        return false;
	    }
	});	

	
});
 </script>
</body>
</html>
