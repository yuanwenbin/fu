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
	<script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
</head>
<body class="roomOpen">
<div class="container">
<h3>增加文章分类</h3>
<form action="">
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td width="20%" align="right"><label>分类选择/名称：</label></td>
		<td>
		<select name="cate_parent">
			<option value="0" selected>顶级分类</option>
			<?php
			if($cate_name)
			{
				foreach($cate_name as $k=>$v){
			?>
			<option value="<?php echo $v['cate_id'];?>">
			<?php if($v['cate_parent']){ echo "&nbsp;&nbsp;&nbsp;";} ?>
			<?php echo $v['cate_name']; ?>
			</option>
			<?php } }  ?>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="cate_name" value="" />
		</td>
	</tr>
	<tr>
		<td width="20%" align="right"><label>分类排序：</label></td>
		<td><input type="number" name="cate_sort" value="255" /></td>
	</tr>

	<tr>
		<td width="20%" align="right"><label>是否开放：</label></td>
		<td>
		<select name="cate_show">
			<option value="1" selected>开放</option>
			<option value="0">关闭</option>
		</select>
		</td>
	</tr>


	<tr>
		<td width="20%" align="right">&nbsp;</td>
		<td>
		&nbsp;
		</td>
	</tr>
	<tr>
		<td width="20%" align="right">&nbsp;</td>
		<td>
		<input type="reset" name="reset" value="重置" />&nbsp;
		<input type="submit" name="submit" value="提交" />
		</td>
	</tr>
</table>
</form>
</div>
<div class="footer">
所有权归本站所有
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("input[name='submit']").click(function(){
		var cate_name = $("input[name='cate_name']").val();
		if(cate_name == '')
		{
			alert("请输入文章分类的名称");
			return false;
		}

		var cate_parent = $("select[name='cate_parent']").val();
		var cate_sort = $("input[name='cate_sort']").val();
		var cate_show = $("select[name='cate_show']").val();
		var url = "/Article/addCateDeal";

		var param = {cate_name:cate_name,cate_parent:cate_parent,cate_sort:cate_sort,cate_show:cate_show};
		$.post(url,param,function(data){
			alert(data.msg);
			if(!data.error){
			 window.document.location.href="/Article/addCate";
			}
		}, 'json');
		return false;
	});
});
</script>
</body>
</html>
