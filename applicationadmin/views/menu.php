<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>系统登陆后台菜单</title>
	<link href="/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body class="adminMenu">

<ul class="menuList">
	<?php if(hasPerssion($_SESSION['role'],'room')) { ?>
	<li>
		<h2>房间/牌位管理中心</h3>
		<ul>
		<?php if(hasPerssion($_SESSION['role'],'roomList')) { ?>
			<li><a href="/Room/roomList" target="mainFrame">房间列表</a></li>
			<?php } ?>
			<?php if(hasPerssion($_SESSION['role'],'roomOpen')) { ?>
			<li><a href="/Room/roomOpen" target="mainFrame">房间开设</a></li>
			<?php } ?>
			<?php if(hasPerssion($_SESSION['role'],'roomInfos')) { ?>
			<li><a href="/Room/roomOpenPosition" target="mainFrame">房间牌位设置/修改</a></li>
			<li><a href="/Room/roomPosList" target="mainFrame">房间牌位查询</a></li>
			<?php } ?>
			<?php if(hasPerssion($_SESSION['role'],'mutilDeal')) { ?>
			<li><a href="/Room/roomPosMod" target="mainFrame">批量修改</a></li>
			<?php } ?>
		</ul>
	</li>
	<?php } ?>
	<?php if(hasPerssion($_SESSION['role'],'orderList')) { ?>
	<li>
		<h2>订单管理中心</h2>
		<ul>
			<li><a href="/Order/orderList" target="mainFrame">订单列表</a></li>
		</ul>
	</li>
	<?php } ?>
	<?php if(hasPerssion($_SESSION['role'],'article')) { ?>
	<li>
		<h2>文章管理中心</h2>
		<ul>
			<?php if(hasPerssion($_SESSION['role'],'addArticle')) { ?>
			<li><a href="/Article/addArticle" target="mainFrame">发表文章</a></li>
			<?php } ?>
			<?php if(hasPerssion($_SESSION['role'],'listArticle')) { ?>
			<li><a href="/Article/listArticle" target="mainFrame">文章列表</a></li>
			<?php } ?>
			<?php if(hasPerssion($_SESSION['role'],'addCate')) { ?>
			<li><a href="/Article/addCate" target="mainFrame">增加文章分类</a></li>
			<?php } ?>
			<?php if(hasPerssion($_SESSION['role'],'listCate')) { ?>
			<li><a href="/Article/listCate" target="mainFrame">查看文章分类列表</a></li>
			<?php } ?>						
		</ul>
	</li>
	<?php } ?>
	<?php if(hasPerssion($_SESSION['role'],'member')) { ?>
	<li>
		<h2>登录记录中心</h2>
		<ul>
			<li><a href="/Member/index" target="mainFrame">登录列表</a></li>
			<li><a href="/Member/memberSearch" target="mainFrame">登录查询</a></li>
		</ul>
	</li>
	 <?php } ?>
	 <?php if(hasPerssion($_SESSION['role'],'all')) { ?>
	<li>
		<h2>管理员中心</h2>
		<ul>
		    <li><a href="/User/userList" target="mainFrame">管理员列表</a></li>
			<li><a href="/User/userAdd" target="mainFrame">增加管理员</a></li>
		</ul>
	</li>	
	<?php } ?>
	<?php if(hasPerssion($_SESSION['role'],'tongji')) { ?>
	<li>
		<h2>统计中心</h2>
		<ul>
			<?php if(hasPerssion($_SESSION['role'],'tongjiList')) { ?>
		    <li><a href="/Tongji/tongjiList" target="mainFrame">统计状况</a></li>
			<?php } ?>
			<?php if(hasPerssion($_SESSION['role'],'clearList')) { ?>
			<li><a href="/Tongji/clearList" target="mainFrame">清空数据</a></li>
			<?php } ?>
		</ul>
	</li>	
	<?php } ?>
	
	<?php if(hasPerssion($_SESSION['role'],'link')) { ?>
	<li>
		<h2>友情链接</h2>
		<ul>

		    <li><a href="/Link/linkList" target="mainFrame">友情链接</a></li>

		</ul>
	</li>	
	<?php } ?>	
	
	<?php if(hasPerssion($_SESSION['role'],'copyright')) { ?>
	<li>
		<h2>版权信息</h2>
		<ul>

		    <li><a href="/Link/linkList" target="mainFrame">版权信息</a></li>

		</ul>
	</li>	
	<?php } ?>	
	
	<?php if(hasPerssion($_SESSION['role'],'curlture')) { ?>
	<li>
		<h2>道教文化</h2>
		<ul>

		    <li><a href="/Curlture/curlture" target="mainFrame">道教文化</a></li>

		</ul>
	</li>	
	<?php } ?>		

</ul>
</body>
</html>
