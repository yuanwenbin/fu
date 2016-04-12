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
</head>
<body class="adminTop">
<div class="topMenuTags">
    <div class="topBg"><img src="<?php echo URL_APP;?>/images/title_background.png" /></div>
    <div class="topMenuTagsLeft">
                欢迎光临：<span>
    <?php
    echo $username;
    ?>
    </span>
    &nbsp;&nbsp;
    <a href="<?php echo URL_APP_C;?>/Index/logout" target="_top">退出</a>&nbsp;&nbsp;
    <a href="<?php echo URL_APP_C;?>/Index/index" target="_top">返回首页</a>
    </div>
    <div class="topMenuTagsRight">
    <?php echo date('Y-m-d H:i:s', time());?>
    </div>
    <div class="clearBoth"></div>
</div>
</body>
</html>
