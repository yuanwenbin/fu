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
<h3 class="headerLineBackground">选号系统开启状态</h3>
<form action="/Webset/websetSystemDeal" method="post">
<table border="0" cellspacing="0" cellpadding="0" width="98%">
	<tr>
		<td>
		修改状态：&nbsp;
		<select name="flag">
		<option value="1" <?php if($result->flag == 1) {echo "selected"; }?>>开启选号系统</option>
		<option value="0" <?php if(!$result->flag) {echo "selected"; }?>>关闭选号系统</option>
		</select>&nbsp;&nbsp;
		<input type="submit" name="submit" value="修改提交" />
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.go(-1);">返回</a>
		</td>
	</tr>

</table>
</form>
</div>


</body>
</html>
