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
<body class="defaultInfos container">
<?php if(isset($url) && !empty($url)) {?>
<a href="<?php echo URL_APP;?>/index.php<?php echo $url;?>">操作成功!&nbsp;点击立即返回</a><br />
3 秒后将返回上一页
<script type="text/javascript">
function goBack()
{
	window.location.href="<?php echo URL_APP;?>/index.php<?php echo $url;?>";
}
setTimeout('goBack()', 3000);
</script>
<?php }else{?>
<a href="javascript:goBack();">操作成功!&nbsp;点击立即返回</a><br />
3 秒后将返回上一页
<script type="text/javascript">
function goBack()
{
	history.go(-1);
}
setTimeout('goBack()', 3000);
</script>
<?php } ?>
</body>
</html>