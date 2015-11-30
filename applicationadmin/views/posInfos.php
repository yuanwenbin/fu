<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>订单详情-系统登陆后台</title>
	<link href="/css/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
</head>
<body class="roomList">
<div class="roomInfosDiv container">
<h3 class="headerLineBackground">订单详情</h3>
<table border="0" cellpadding="5" cellspacing="5" width="90%">	
	<tr>
		<td width="20%" align="right">房间号：</td>
		<td>
		<?php echo $result['orderInfo']['order_room_id'];?>
		</td>		
	</tr>
	
	<tr>
		<td width="20%" align="right">房间名称：</td>
		<td>
		<?php echo $result['roomInfo']['room_alias'];?>
		</td>		
	</tr>
	
	<tr>
		<td width="20%" align="right">用户名：</td>
		<td>
		<?php echo $result['orderInfo']['order_user'];?>
		</td>		
	</tr>
	
	<tr>
		<td width="20%" align="right">是否支付：</td>
		<td>
		<?php echo $result['orderInfo']['order_payment'] ? '是' : '否';?>
		</td>		
	</tr>	
	
	<tr>
		<td width="20%" align="right">修改支付状态：</td>
		<td>
		<input type="hidden" value="<?php echo $result['orderInfo']['order_location_id']; ?>" name="location_id" />
		<input type="hidden" value="<?php echo $result['orderInfo']['order_id']; ?>" name="id" />
		<?php if(!$result['orderInfo']['order_payment']){ ?>
		<select name="order_payment">
		<option value="1" selected>支付</option>
		</select>
		&nbsp;&nbsp;<a href="javascript:void(0);" id="modLocationId">去支付</a>
		<?php }else{?>
		&nbsp;&nbsp;<a href="javascript:void(0);">已经支付</a>
		<?php } ?>
		</td>		
	</tr>	
	<tr>
		<td width="20%" align="right">下单时间：</td>
		<td>
		<?php echo date('Y-m-d H:i:s',$result['orderInfo']['order_datetime']);?>
		</td>		
	</tr>	
	
	<tr>
		<td width="20%" align="right">牌位号码：</td>
		<td>
		<?php echo $result['orderInfo']['order_location_id'];?>
		</td>		
	</tr>	

	<tr>
		<td width="20%" align="right">牌位价格：</td>
		<td>
		<?php echo $result['orderInfo']['order_price'];?>
		</td>		
	</tr>
	
	<tr>
		<td width="20%" align="right">牌位类型：</td>
		<td>
		<?php
		if($result['orderInfo']['order_location_type'] == 2)
		{
			echo '生辰八字';
		}elseif($result['orderInfo']['order_location_type']==1)
		{
			echo '高端定制';
		}else
		{
			echo '随机';
		}
		?>
		</td>		
	</tr>	
 	<?php if($result['userInfo']['user_type'] == 1) { ?>
	<tr>
		<td width="20%" align="right">姓名：</td>
		<td>
		<?php echo $result['userInfo']['user_name'];?>
		</td>		
	</tr>
	<tr>
		<td width="20%" align="right">生日：</td>
		<td>
		<?php echo $result['userInfo']['user_birthday'];?>
		</td>		
	</tr>
	<tr>
		<td width="20%" align="right">时辰：</td>
		<td>
		<?php echo $result['userInfo']['user_time'];?>
		</td>		
	</tr>
	<?php } ?>
	<tr>
		<td width="20%" align="right">牌位别名：</td>
		<td>
		<?php echo $result['posInfo']['location_alias'];?>
		</td>		
	</tr>

	<tr>
		<td width="20%" align="right">牌位描述：</td>
		<td>
		<?php echo $result['posInfo']['location_details'];?>
		</td>		
	</tr>

		<tr>
		<td width="20%" align="right">&nbsp;</td>
		<td>
		<a href="javascript:history.go(-1);">点击返回</a>
		</td>		
	</tr>			
</table>
</div>
<div class="footer">
所有权归本站所有
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('#modLocationId').click(function(){
		var order_payment = $("select[name='order_payment']").val();
		var location_id = $("input[name='location_id']").val();
		var id = $("input[name='id']").val();
		var url = "/Order/posInfosDeal";
		var param = {order_payment:order_payment,location_id:location_id,order_id:id};
		$.post(url,param,function(data){
			window.document.location.href="/Order/posInfos?id="+id;
		});
	});
	
});
</script>
</body>
</html>
