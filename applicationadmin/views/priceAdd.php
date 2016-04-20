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
<h3 class="headerLineBackground">
捐赠额分档设置,最小捐赠额为：<?php echo $minMaxPrice['minVal'];?>,
最大捐赠额为：<?php echo $minMaxPrice['maxVal'];?></h3>
<form action="<?php echo URL_APP_C;?>/Price/priceAddDeal" method="post">
<table border="0" cellspacing="0" cellpadding="0" width="98%">
	<tr>
		<td>
		&nbsp;&nbsp;开始捐赠额:&nbsp;<input  type="text" name="minPrice" value="" />&nbsp;&nbsp;
		&nbsp;&nbsp;结束捐赠额:&nbsp;<input  type="text" name="maxPrice" value="" />&nbsp;&nbsp;
		&nbsp;&nbsp;捐赠额名称:&nbsp;<input  type="text" name="price_alias" value="" />&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="提交" />
		</td>
	</tr>
</table>
</form>
<?php if($hasList) { ?>
<p>捐赠额分档列表</p>
<table border="0" cellspacing="0" cellpadding="0" width="98%">
	<tr>
		<th width="30%" align="center">捐赠额分类</th>
		<th width="17%" align="center">捐赠额名称</th>
		<th width="18%" align="center">时间</th>
		<th width="15%" align="center">管理员</th>
		<th width="18%" align="center">操作</th>
	</tr>
	<?php 
	foreach($priceList as $key=>$val){
	?>
	<tr>
		<td width="30%" align="center">
		<?php echo $val['price_min'] .' - ' . $val['price_max']; ?>
		</td>
		<td width="17%" align="center">
		<?php echo $val['price_alias']; ?>
		</td>		
		<td width="18%" align="center">
		<?php echo date('Y-m-d H:i:s', $val['price_create']); ?>
		</td>
		<td width="15%" align="center">
		<?php echo $val['price_user']; ?>
		</td>
		<td width="18%" align="center">
		<?php if(hasPerssion($_SESSION['role'],'priceDel')) { ?>
		<a href="<?php echo URL_APP_C;?>/Price/priceDel?id=<?php echo $val['id']; ?>">删除</a>&nbsp;&nbsp;
		<?php } ?>
		<?php if(hasPerssion($_SESSION['role'],'priceUpdate')) { ?>
			<a href="<?php echo URL_APP_C;?>/Price/priceUpdate?id=<?php echo $val['id']; ?>">编辑</a>&nbsp;&nbsp;
			<?php } ?>			
		
		</td>
	</tr>
	<tr>
		<td colspan="5"><hr/></td>
	</tr>
	<?php } ?>
</table>
<?php } ?>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$("input[name='submit']").click(function(){
		var minPrice = $("input[name='minPrice']").val();
		var maxPrice = $("input[name='maxPrice']").val();
		var price_alias = $("input[name='price_alias']").val();
		if(minPrice == '')
		{
			alert("请输入开始捐赠额");
			return false;
		}

		if(maxPrice == '')
		{
			alert("请输入结束捐赠额");
			return false;
		}
		if(parseFloat(minPrice) >= parseFloat(maxPrice))
		{
			alert("开始捐赠额不能大于结束捐赠额");
			return false;
		}

		if(price_alias == '')
		{
			alert("请输入捐赠额别名");
			return false;
		}		
		return true;	
	});

});
</script>
</body>
</html>
