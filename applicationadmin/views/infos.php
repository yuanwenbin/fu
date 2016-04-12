<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>系统登陆后台-默认展示信息</title>
	<link href="<?php echo URL_APP;?>/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body class="defaultInfos">
<h4>管理中心</h4>

<!-- bof one -->
<div class="divInfos1">
<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<th colspan="2" align="left" class="headerLineBackground">系统信息</th>
	</tr>
	<tr>
		<td width="20%" align="left">服务器信息</td>
		<td><?php  echo $infos['SERVER_SOFTWARE']; ?></td>
	</tr>
</table>
</div>
<!-- eof one -->

</body>
</html>