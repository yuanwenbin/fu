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
	<script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/js/menu.js"></script>
</head>
<body class="adminMenu">

<ul class="menuList">
	<?php if(hasPerssion($_SESSION['role'],'room')) { ?>
	<li>
		<h2><a href="javascript:void(0);">房间/牌位管理中心</a></h2>
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
		<h2><a href="javascript:void(0);">订单管理中心</a></h2>
		<ul>
			<li><a href="/Order/orderList" target="mainFrame">订单列表</a></li>
		</ul>
	</li>
	<?php } ?>
	<?php if(hasPerssion($_SESSION['role'],'article')) { ?>
	<li>
		<h2><a href="javascript:void(0);">文章管理中心</a></h2>
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
		<h2><a href="javascript:void(0);">登录记录中心</a></h2>
		<ul>
			<li><a href="/Member/index" target="mainFrame">登录列表</a></li>
			<li><a href="/Member/memberSearch" target="mainFrame">登录查询</a></li>
		</ul>
	</li>
	 <?php } ?>
	 <?php if(hasPerssion($_SESSION['role'],'all')) { ?>
	<li>
		<h2><a href="javascript:void(0);">管理员中心</a></h2>
		<ul>
		    <li><a href="/User/userList" target="mainFrame">管理员列表</a></li>
			<li><a href="/User/userAdd" target="mainFrame">增加管理员</a></li>
		</ul>
	</li>	
	<?php } ?>
	<?php if(hasPerssion($_SESSION['role'],'tongji')) { ?>
	<li>
		<h2><a href="javascript:void(0);">统计中心</a></h2>
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
	
	<?php if(hasPerssion($_SESSION['role'],'links')) { ?>
	<li>
		<h2><a href="javascript:void(0);">友情链接</a></h2>
		<ul>

		    <li><a href="/Links/linkList" target="mainFrame">友情链接</a></li>

		</ul>
	</li>	
	<?php } ?>	
	
	<?php if(hasPerssion($_SESSION['role'],'copyright')) { ?>
	<li>
		<h2><a href="javascript:void(0);">版权信息</a></h2>
		<ul>

		    <li><a href="/Copyright/copyrightInfo" target="mainFrame">版权信息</a></li>

		</ul>
	</li>	
	<?php } ?>	
	
	<?php if(hasPerssion($_SESSION['role'],'curlture')) { ?>
	<li>
		<h2><a href="javascript:void(0);">道教文化</a></h2>
		<ul>

		    <li><a href="/Curlture/curlture" target="mainFrame">道教文化</a></li>

		</ul>
	</li>	
	<?php } ?>	
	
	<?php if(hasPerssion($_SESSION['role'],'aboutus')) { ?>
	<li>
		<h2><a href="javascript:void(0);">版权信息</a></h2>
		<ul>

		    <li><a href="/Aboutus/aboutUsInfo" target="mainFrame">关于我们</a></li>

		</ul>
	</li>	
	<?php } ?>	
		

	<?php if(hasPerssion($_SESSION['role'],'orderList')) { ?>
	<li>
		<h2><a href="javascript:void(0);">订单管理中心</a></h2>
		<ul>
			<li><a href="/Order/orderList" target="mainFrame">订单列表</a></li>
		</ul>
	</li>
	<?php } ?>
	
	<?php if(hasPerssion($_SESSION['role'],'password')) { ?>
	<li>
		<h2><a href="javascript:void(0);">密码管理</a></h2>
		<ul>
			<?php if(hasPerssion($_SESSION['role'],'passwordCheckForRand')) { ?>
			<li><a href="/Password/passwordCheckForRand" target="mainFrame">查看随机密码</a></li>
			<?php } ?>
			<?php if(hasPerssion($_SESSION['role'],'passwordCheckForHigh')) { ?>
			<li><a href="/Password/passwordCheckForHigh" target="mainFrame">查看高端密码</a></li>
			<?php } ?>
			<?php if(hasPerssion($_SESSION['role'],'passwordAddForRand')) { ?>
			<li><a href="/Password/passwordAddForRand" target="mainFrame">设置随机密码</a></li>
			<?php } ?>
			<?php if(hasPerssion($_SESSION['role'],'passwordAddForHigh')) { ?>
			<li><a href="/Password/passwordAddForHigh" target="mainFrame">设置高端节密码</a></li>
			<?php } ?>						
		</ul>
	</li>
	<?php } ?>	
	
	<?php if(hasPerssion($_SESSION['role'],'price')) { ?>
	<li>
		<h2><a href="javascript:void(0);">价格分类管理</a></h2>
		<ul>
			<?php if(hasPerssion($_SESSION['role'],'priceList')) { ?>
			<li><a href="/Price/priceList" target="mainFrame">价格查看</a></li>
			<?php } ?>
			<?php if(hasPerssion($_SESSION['role'],'priceAdd')) { ?>
			<li><a href="/Price/priceAdd" target="mainFrame">价格增加</a></li>
			<?php } ?>			
		</ul>
	</li>
	<?php } ?>	
	
	<?php if(hasPerssion($_SESSION['role'],'memberteam')) { ?>
	<li>
		<h2><a href="javascript:void(0);">业务员管理</a></h2>
		<ul>
			<?php if(hasPerssion($_SESSION['role'],'memberteamList')) { ?>
			<li><a href="/Memberteam/memberteamList" target="mainFrame">分组查看</a></li>
			<?php } ?>

			<?php if(hasPerssion($_SESSION['role'],'memberteamListUser')) { ?>
			<li><a href="/Memberteam/memberteamListUser" target="mainFrame">业务员列表</a></li>
			<?php } ?>
		</ul>
	</li>
	<?php } ?>			
	
</ul>
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
    $(".menuList ul li").click(function(){
        $(".menuList ul li").removeClass('currentList');
        $(this).addClass('currentList');
      });
	
});
</script>
