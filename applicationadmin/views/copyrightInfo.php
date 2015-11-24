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
<div class="roomListInfos">
<h3 class="headerLineBackground">版权 信息(以第一条为准)</h3>

<table border="0" cellspacing="5" cellpadding="5" width="100%">
	<tr>
		<th width="20%" align="center">操作</th>
		<th  width="75%" align="center">版权内容</th>
	</tr>
	<?php 
	foreach($result as $key=>$val){
	?>
	<tr <?php echo ($key % 2) ? 'class="listRoomColumns"' : '';?>class="fuck">
		<td width="20%" align="center">
		<a href="/Copyright/addCopyRight">增加版权</a>&nbsp;|&nbsp;
		<a href="/Copyright/delCopyRight/<?php echo $val['copy_id']; ?>" onclick="return sureDel();">删除版权 </a>
		</td>
		<td  width="75%" align="center">
		
		<?php echo $val['copy_content'];?>
		</td>
	</tr>
	<?php } ?>
</table>
</div>
<script type="text/javascript">
function sureDel()
{
	if(confirm("确定要删除吗?"))
	{
		return true;
	}
	return false;
}
</script>
</body>
</html>
