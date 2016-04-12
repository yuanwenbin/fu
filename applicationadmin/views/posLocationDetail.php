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
</head>
<body class="roomList">
<div class="roomInfosDiv container">
<h3 class="headerLineBackground">牌位相关,房间号:<?php echo $result['location_room_id'];?>,牌位号:<?php echo $result['localtion_id'];?></h3>
<form action="<?php echo URL_APP_C;?>/Room/posLocationDeal" method="post" enctype="multipart/form-data">
<input type="hidden" name="localtion_id" value="<?php echo $result['localtion_id'];?>"  />
<table border="0" cellpadding="5" cellspacing="5" width="100%">	

	<tr>
		<td width="20%" align="right">牌位价格：</td>
		<td>
		<?php echo $result['location_price'];?>
		</td>		
	</tr>
	
	<tr>
		<td width="20%" align="right">牌位类型：</td>
		<td>
		<?php if($result['location_type']) {?>
		高端定制
		<?php }else{ ?>
		随机/生辰八字
		<?php } ?>
		</td>		
	</tr>	
	
	<tr>
		<td width="20%" align="right">牌位别名：</td>
		<td>
		<?php echo $result['location_alias'];?>
		</td>		
	</tr>
	
	<tr>
		<td width="20%" align="right">牌位销售状态：</td>
		<td>
		<?php
		if($result['location_number'] == 2) {
			echo '末出售';
		}elseif($result['location_number'] == 1)
		{
			echo '锁定中';
		}else
		{
			echo '已出售';
		}
		?>
		</td>		
	</tr>	
	
	<tr>
		<td width="20%" align="right">是否已付款：</td>
		<td>
		<?php 
		if($result['location_ispayment']) {
			echo '已付款';	
		}else
		{
			echo '末付款';
		}
		?>
		</td>		
	</tr>	
			
	<tr>
		<td width="20%" align="right">牌位原图片：</td>
		<td>
		<?php 
		if($result['location_pic']){?>
		<img src="<?php echo $front_domain .'/'. $result['location_pic'];?>" width="40" height="40" />
		<?php } ?>
		</td>		
	</tr>

	<tr>
		<td width="20%" align="right">牌位支付时间：</td>
		<td>
		<?php  echo $result['location_paytime'] ? date('Y-m-d H:i:s',$result['location_paytime']) : '';?>
		</td>		
	</tr>
	
		
	<tr>
		<td width="20%" align="right">牌位描述：</td>
		<td>
		<?php echo $result['location_details'];?>
		
		</td>		
	</tr>
	<tr>
		<td width="20%" align="right">&nbsp;</td>
		<td>
		<a href="javascript:history.go(-1);">返回</a>&nbsp;&nbsp;
		</td>		
	</tr>						
</table>
</form>
</div>

</body>
</html>
