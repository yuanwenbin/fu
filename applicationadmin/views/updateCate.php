<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>系统登陆后台</title>
	<link href="/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body class="roomList">
<div class="roomInfosDiv">
<h3 class="headerLineBackground">分类名称:<?php echo $cate[0]['cate_name'];?></h3>
<form action="/Article/updateCateDeal" method="post">
<input type="hidden" name="cate_id" value="<?php echo $cate[0]['cate_id'];?>"  />
<table border="0" cellpadding="5" cellspacing="5" width="90%">	

	<tr>
		<td width="20%" align="right">分类名称:</td>
		<td>
		<input type="text" name="cate_name" value="<?php echo $cate[0]['cate_name'];?>" />
		</td>		
	</tr>
	
	<tr>
		<td width="20%" align="right">分类排序:</td>
		<td>
		<input type="text" name="cate_sort" value="<?php echo $cate[0]['cate_sort'];?>" />
		</td>		
	</tr>
		
	<tr>
		<td width="20%" align="right">是否开放：</td>
		<td>
		<select name="cate_show">
		<?php if($cate[0]['cate_show']) {?>
		<option value="1" selected>是</option>
		<option value="0">否</option>
		<?php }else {?>
		<option value="0" selected>否</option>	
		<option value="1">是</option>
		<?php } ?>
		</select>
		</td>		
	</tr>
	

	<tr>
		<td width="20%" align="right">&nbsp;</td>
		<td>
		<input type="submit" name="submit" value="提交" />
		</td>		
	</tr>						
</table>
</form>
</div>
</body>
</html>
