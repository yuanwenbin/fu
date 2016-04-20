<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>系统登陆后台菜单</title>
	<link href="<?php echo URL_APP;?>/css/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo URL_APP;?>/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="<?php echo URL_APP;?>/js/menu.js"></script>
</head>
<body class="adminMenu">

<ul class="menuList">
	<?php if(hasPerssion($_SESSION['role'],'room')) { ?>
	<li>
		<h2><a href="javascript:void(0);">福位/牌位管理中心</a></h2>
		<ul>
		<?php if(hasPerssion($_SESSION['role'],'roomList')) { ?>
			<li><a href="<?php echo URL_APP_C;?>/Room/roomList" target="mainFrame">福位列表</a></li>
			<?php } ?>
			<?php if(hasPerssion($_SESSION['role'],'roomOpen')) { ?>
			<li><a href="<?php echo URL_APP_C;?>/Room/roomOpen" target="mainFrame">福位开设</a></li>
			<?php } ?>
			<?php if(hasPerssion($_SESSION['role'],'roomInfos')) { ?>
			<li><a href="<?php echo URL_APP_C;?>/Room/roomOpenPosition" target="mainFrame">福位牌位设置/修改</a></li>
			<li><a href="<?php echo URL_APP_C;?>/Room/roomPosList" target="mainFrame">福位牌位查询</a></li>
			<?php } ?>
			<?php if(hasPerssion($_SESSION['role'],'mutilDeal')) { ?>
			<li><a href="<?php echo URL_APP_C;?>/Room/roomPosMod" target="mainFrame">批量修改</a></li>
			<?php } ?>
		</ul>
	</li>
	<?php } ?>
	<?php if(hasPerssion($_SESSION['role'],'orderList')) { ?>
	<li>
		<h2><a href="javascript:void(0);">捐赠管理中心</a></h2>
		<ul>
			<li><a href="<?php echo URL_APP_C;?>/Order/orderList" target="mainFrame">捐赠列表</a></li>
			<li><a href="<?php echo URL_APP_C;?>/Order/orderSelf" target="mainFrame">自助下单</a></li>
		</ul>
	</li>
	<?php } ?>
	<?php if(hasPerssion($_SESSION['role'],'article')) { ?>
	<li>
		<h2><a href="javascript:void(0);">文章管理中心</a></h2>
		<ul>
			<?php if(hasPerssion($_SESSION['role'],'addArticle')) { ?>
			<li><a href="<?php echo URL_APP_C;?>/Article/addArticle" target="mainFrame">发表文章</a></li>
			<?php } ?>
			<?php if(hasPerssion($_SESSION['role'],'listArticle')) { ?>
			<li><a href="<?php echo URL_APP_C;?>/Article/listArticle" target="mainFrame">文章列表</a></li>
			<?php } ?>
			<?php if(hasPerssion($_SESSION['role'],'addCate')) { ?>
			<li><a href="<?php echo URL_APP_C;?>/Article/addCate" target="mainFrame">增加文章分类</a></li>
			<?php } ?>
			<?php if(hasPerssion($_SESSION['role'],'listCate')) { ?>
			<li><a href="<?php echo URL_APP_C;?>/Article/listCate" target="mainFrame">查看文章分类列表</a></li>
			<?php } ?>						
		</ul>
	</li>
	<?php } ?>
	<?php if(hasPerssion($_SESSION['role'],'member')) { ?>
	<li>
		<h2><a href="javascript:void(0);">登录记录中心</a></h2>
		<ul>
			<li><a href="<?php echo URL_APP_C;?>/Member/index" target="mainFrame">登录列表</a></li>
			<li><a href="<?php echo URL_APP_C;?>/Member/memberSearch" target="mainFrame">登录查询</a></li>
		</ul>
	</li>
	 <?php } ?>
	 <?php if(hasPerssion($_SESSION['role'],'all')) { ?>
	<li>
		<h2><a href="javascript:void(0);">管理员中心</a></h2>
		<ul>
		    <li><a href="<?php echo URL_APP_C;?>/User/userList" target="mainFrame">管理员列表</a></li>
			<li><a href="<?php echo URL_APP_C;?>/User/userAdd" target="mainFrame">增加管理员</a></li>
		</ul>
	</li>	
	<?php } ?>
	<?php if(hasPerssion($_SESSION['role'],'tongji')) { ?>
	<li>
		<h2><a href="javascript:void(0);">统计中心</a></h2>
		<ul>
			<?php if(hasPerssion($_SESSION['role'],'tongjiList')) { ?>
		    <li><a href="<?php echo URL_APP_C;?>/Tongji/tongjiList" target="mainFrame">统计状况</a></li>
			<?php } ?>
			<?php if(hasPerssion($_SESSION['role'],'exportOrder')) { ?>
			<li><a href="<?php echo URL_APP_C;?>/Tongji/exportOrder" target="mainFrame">导出订单</a></li>
			<?php } ?>
			<?php if(hasPerssion($_SESSION['role'],'clearList')) { ?>
			<li><a href="<?php echo URL_APP_C;?>/Tongji/clearList" target="mainFrame">清空数据</a></li>
			<?php } ?>			
		</ul>
	</li>	
	<?php } ?>
	
	<?php if(hasPerssion($_SESSION['role'],'links')) { ?>
	<li>
		<h2><a href="javascript:void(0);">友情链接</a></h2>
		<ul>

		    <li><a href="<?php echo URL_APP_C;?>/Links/linkList" target="mainFrame">友情链接</a></li>

		</ul>
	</li>	
	<?php } ?>	
	
	<?php if(hasPerssion($_SESSION['role'],'copyright')) { ?>
	<li>
		<h2><a href="javascript:void(0);">版权信息</a></h2>
		<ul>

		    <li><a href="<?php echo URL_APP_C;?>/Copyright/copyrightInfo" target="mainFrame">版权信息</a></li>

		</ul>
	</li>	
	<?php } ?>	
	
	<?php if(hasPerssion($_SESSION['role'],'curlture')) { ?>
	<li>
		<h2><a href="javascript:void(0);">道教文化</a></h2>
		<ul>

		    <li><a href="<?php echo URL_APP_C;?>/Curlture/curlture" target="mainFrame">道教文化</a></li>

		</ul>
	</li>	
	<?php } ?>	
	
	<?php if(hasPerssion($_SESSION['role'],'aboutus')) { ?>
	<li>
		<h2><a href="javascript:void(0);">版权信息</a></h2>
		<ul>

		    <li><a href="<?php echo URL_APP_C;?>/Aboutus/aboutUsInfo" target="mainFrame">关于我们</a></li>

		</ul>
	</li>	
	<?php } ?>	
	
	<?php if(hasPerssion($_SESSION['role'],'password')) { ?>
	<li>
		<h2><a href="javascript:void(0);">密码管理</a></h2>
		<ul>
			<?php if(hasPerssion($_SESSION['role'],'passwordCheckForRand')) { ?>
			<li><a href="<?php echo URL_APP_C;?>/Password/passwordCheckForRand" target="mainFrame">查看随机密码</a></li>
			<?php } ?>
			<?php if(hasPerssion($_SESSION['role'],'passwordCheckForHigh')) { ?>
			<li><a href="<?php echo URL_APP_C;?>/Password/passwordCheckForHigh" target="mainFrame">查看高端密码</a></li>
			<?php } ?>
			<?php if(hasPerssion($_SESSION['role'],'passwordAddForRand')) { ?>
			<li><a href="<?php echo URL_APP_C;?>/Password/passwordAddForRand" target="mainFrame">设置随机密码</a></li>
			<?php } ?>
			<?php if(hasPerssion($_SESSION['role'],'passwordAddForHigh')) { ?>
			<li><a href="<?php echo URL_APP_C;?>/Password/passwordAddForHigh" target="mainFrame">设置高端节密码</a></li>
			<?php } ?>						
		</ul>
	</li>
	<?php } ?>	
	
	<?php if(hasPerssion($_SESSION['role'],'price')) { ?>
	<li>
		<h2><a href="javascript:void(0);">捐赠分类管理</a></h2>
		<ul>
			<?php if(hasPerssion($_SESSION['role'],'priceList')) { ?>
			<li><a href="<?php echo URL_APP_C;?>/Price/priceList" target="mainFrame">捐赠额查看</a></li>
			<?php } ?>
			<?php if(hasPerssion($_SESSION['role'],'priceAdd')) { ?>
			<li><a href="<?php echo URL_APP_C;?>/Price/priceAdd" target="mainFrame">捐赠额增加</a></li>
			<?php } ?>			
		</ul>
	</li>
	<?php } ?>	
	
	<?php if(hasPerssion($_SESSION['role'],'memberteam')) { ?>
	<li>
		<h2><a href="javascript:void(0);">义工管理</a></h2>
		<ul>
			<?php if(hasPerssion($_SESSION['role'],'memberteamList')) { ?>
			<li><a href="<?php echo URL_APP_C;?>/Memberteam/memberteamList" target="mainFrame">分组查看</a></li>
			<?php } ?>

			<?php if(hasPerssion($_SESSION['role'],'memberteamListUser')) { ?>
			<li><a href="<?php echo URL_APP_C;?>/Memberteam/memberteamListUser" target="mainFrame">义工列表</a></li>
			<?php } ?>
		</ul>
	</li>
	<?php } ?>		
	
	<?php if(hasPerssion($_SESSION['role'],'webset')) { ?>
	<li>
		<h2><a href="javascript:void(0);">系统开启状态</a></h2>
		<ul>
			<?php if(hasPerssion($_SESSION['role'],'websetSystem')) { ?>
			<li><a href="<?php echo URL_APP_C;?>/Webset/websetSystem" target="mainFrame">广结善缘开启状态</a></li>
			<?php } ?>

			<?php if(hasPerssion($_SESSION['role'],'websetCopy')) { ?>
			<li><a href="<?php echo URL_APP_C;?>/Webset/websetCopy" target="mainFrame">官网开启状态</a></li>
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
