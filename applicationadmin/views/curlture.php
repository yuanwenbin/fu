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
<?php
if(!$listArr)
{
	echo '没有相关内容 ';
	echo "<a href='/Curlture/addCurlture'>点击添加</a>";
	exit;
}
?>
<div class="roomInfosDiv container">
<h3>道教文化列表</h3>
<table border="0" cellpadding="5" cellspacing="0" width="100%">	
	<tr class='headerLineBackground1'>
		<th width="20%" align="center">操作</th>
		<th width="50%" align="center">文化标题</th>
		<th width="25%" align="center">文化分类</th>

	</tr>
	<?php
	foreach($listArr as $k=>$v) { 

	?>
	<tr class=<?php if($k%2 != 0) echo 'headerLineBackground1'; ?>>
		<td width="20%" align="center">
		<a href="/Curlture/addCurlture">增加</a>&nbsp;|&nbsp;
		<a href="/Curlture/delCurlture?id=<?php echo $v['curlture_id']; ?>" onclick="javascript:return sureDel();">删除</a>
		</td>
		<td width="70%" align="center"><?php echo $v['curlture_headline']; ?></td>
		<td width="25%" align="center"><?php echo $curlture[$v['curlture_cate']]; ?></td>

	</tr> 	

	<?php } ?>
</table>
</div>
<div class="footer">
所有权归本站所有
</div>
<script type="text/javascript">
function sureDel()
{
	if(confirm("确定要删除吗？"))
	{
		return true;
	}
	return false;
}
</script>
</body>
</html>
