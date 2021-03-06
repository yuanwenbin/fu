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
    <link type="text/css" href="<?php echo URL_APP;?>/css/jquery-ui-1.8.17.custom.css" rel="stylesheet" />
     <link type="text/css" href="<?php echo URL_APP;?>/css/jquery-ui-timepicker-addon.css" rel="stylesheet" />
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
<body class="roomList">
<div class="roomInfosDiv container">
<h3 class="headerLineBackground">牌位相关,福位号:<?php echo $result['location_room_id'];?>,牌位号:<?php echo $result['localtion_id'];?></h3>
<form action="<?php echo URL_APP_C;?>/Room/posLocationDeal" method="post" enctype="multipart/form-data">
<input type="hidden" name="localtion_id" value="<?php echo $result['localtion_id'];?>"  />
<input type="hidden" name="user_id" value="<?php echo isset($userInfo['user_id']) ? $userInfo['user_id'] : '';?>"  />
<table border="0" cellpadding="5" cellspacing="5" width="100%">	

	<tr>
		<td width="20%" align="right">牌位捐赠额：</td>
		<td>
		<input type="text" name="location_price" value="<?php echo $result['location_price'];?>" />
		</td>		
	</tr>
	
	<tr>
		<td width="20%" align="right">牌位类型：</td>
		<td>
		<select name="location_type">
		<?php if($result['location_type']) {?>
		<option value="1" selected>高端定制</option>
		<option value="0">随机/生辰八字</option>
		<?php }else {?>
		<option value="0" selected>随机/生辰八字</option>
		<option value="1">高端定制</option>
		<?php } ?>
		</select>
		</td>		
	</tr>	
	
	<tr>
		<td width="20%" align="right">牌位别名：</td>
		<td>
		<input type="text" name="location_alias" value="<?php echo $result['location_alias'];?>" />
		</td>		
	</tr>
	
	<tr>
		<td width="20%" align="right">该域名称：</td>
		<td>
		<input type="text" name="location_area" value="<?php echo $result['location_area'];?>" />
		</td>		
	</tr>	
	
	<tr>
		<td width="20%" align="right">牌位前缀：</td>
		<td>
		<input type="text" name="location_prefix" value="<?php echo $result['location_prefix'];?>" />
		</td>		
	</tr>	

	<tr>
		<td width="20%" align="right">牌位编码(别名)：</td>
		<td>
		<input type="text" name="location_code" value="<?php echo $result['location_code'];?>" />
		</td>		
	</tr>	
	
	<tr>
		<td width="20%" align="right">牌位销售状态：</td>
		<td>
		<?php if($result['location_status'] || $result['location_number'] == 2) {?>
		<select name="location_number">
		<option value="2" <?php if($result['location_number'] == 2) echo 'selected';?>>未出售</option>
		<option value="1" <?php if($result['location_number'] == 1) echo 'selected';?>>出售中</option>
        <option value="0"  <?php if(!$result['location_number']) echo 'selected';?>>已出售</option>
		</select>
		<input type="hidden" name="location_status" value="1" />
		 <?php }else{?>
		<?php if($result['location_number'] == 2) {?>
		未出售
	<?php }elseif($result['location_number'] == 1) {?>
		出售中
	<?php }else{ ?>
	已出售
<?php } ?> 
        <input type="hidden" name="location_number" value="<?php echo $result['location_number'];?>" />
        <input type="hidden" name="location_status" value="0" />
        <?php } ?>
		</td>		
	</tr>	
	
	<tr>
		<td width="20%" align="right">是否已付款：</td>
		<td>
		<?php if($result['location_ispayment']) {?>
		已付款
		<?php }else{ ?>
		未付款	
		<?php } ?>

		</td>		
	</tr>	
	
	<tr>
		<td width="20%" align="right">捐赠金额：</td>
		<td>
		<?php echo $result['location_price'];?>&nbsp;(对自动下单)
		</td>		
	</tr>
	
	<tr>
		<td width="20%" align="right">证书编号：</td>
		<td>
		<?php echo $result['location_sno'];?>
		</td>		
	</tr>	
	
	<tr>
		<td width="20%" align="right">是否已付款：</td>
		<td>
		<?php if($result['location_ispayment']) {?>
		已付款
		<?php }else{ ?>
		未付款	
		<?php } ?>

		</td>		
	</tr>		
	<!-- 	
	<tr>
		<td width="20%" align="right">牌位原图片：</td>
		<td>
		<?php 
		// if($result['location_pic']){?>
		<img src="<?php //echo $front_domain .'/'. $result['location_pic'];?>" width="40" height="40" />
		<?php //  } ?>
		</td>		
	</tr>
    -->	
	<tr>
		<td width="20%" align="right">牌位支付时间：</td>
		<td>
		<?php  echo $result['location_paytime'] ? date('Y-m-d H:i:s',$result['location_paytime']) : '无';?>
		</td>		
	</tr> 
	<!--  
	<tr>
		<td width="20%" align="right">牌位新图片：</td>
		<td>
		<input type="file" name="location_pic_new" value="" />&nbsp;(不修改则不理会)
		</td>		
	</tr>
		
	<tr>
		<td width="20%" align="right">牌位描述：</td>
		<td>
		<textarea rows="5" cols="60" name="location_details"><?php // echo $result['location_details'];?></textarea>
		
		</td>		
	</tr> -->
	<?php if(!$status && $sale < 2) {?>
	<tr>
		<td width="20%" align="right">用户身份证号：</td>
		<td>
		<?php echo $userInfo['body_id']; ?>
		</td>		
	</tr>
	<tr>
		<td width="20%" align="right">联系电话：</td>
		<td>
		<input type="text" name="user_telphone" value="<?php echo $userInfo['user_telphone']; ?>" />
		</td>		
	</tr>
	<tr>
		<td width="20%" align="right">所有人称呼：</td>
		<td>
		<?php echo isset($userInfo['user_phone']) && $userInfo['user_phone'] ? $userInfo['user_phone'] : ''; ?>
		</td>		
	</tr>			
	<?php } ?>
	<tr>
		<td width="20%" align="right">&nbsp;</td>
		<td>
		<a href="javascript:history.go(-1);">返回</a>&nbsp;&nbsp;<input type="submit" name="submit" value="提交编辑" />
		</td>		
	</tr>						
</table>
</form>
</div>

</body>
</html>
