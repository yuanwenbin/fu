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
<div class="roomListInfos container">
<h3 class="headerLineBackground">关于我们编辑</h3>
<form action="/Aboutus/addAboutusDeal" method="post">
<input type="hidden" name="about_id" value="<?php echo $result ? $result[0]['about_id'] : ''; ?>" />
<table border="0" cellspacing="0" cellpadding="0" width="98%">
	<tr>
		<td>
		&nbsp;&nbsp;&nbsp;<textarea name="about_content" cols="56" rows="5">
		<?php
		if($result)
		{
			echo $result[0]['about_content'];
		}
		?>
		</textarea>
		</td>
	</tr>
		<tr>
		<td>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="提交" />
		</td>
	</tr>
</table>
</form>
</div>


</body>
</html>
