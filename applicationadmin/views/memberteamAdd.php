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
<h3>增加业务员分组</h3>
<form action="/Memberteam/memberteamAddDeal" method="post">
<table width="100%" border="0" cellpadding="5" cellspacing="0">

	<tr>
		<td width="20%" align="right"><label>业务员分组名：</label></td>
		<td><input type="text" name="memberteamAdd" value="" style="width:300px;" /></td>
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
	<?php
	if($teamList) {
		foreach($teamList as $k=>$v) { ?>
		<tr>
			<td width="20%" align="right">已有分组名：</td>
			<td><?php echo $v['team_name']; ?></td>
		</tr>

	<?php
	} }
	?>
</table>
</form>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$("input[name='submit']").click(function(){
		var cate_name = $("input[name='memberteamAdd']").val();
		if(cate_name == '')
		{
			alert("请输入内容");
			return false;
		}


	});
});
</script>
</body>
</html>