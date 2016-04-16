<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $article[0]['curlture_headline']; ?></title>
<meta name="Keywords" content="<?php echo $article[0]['curlture_seo_keys'] ? $article[0]['curlture_seo_keys'] : '';?>" />
<meta name="Description" content="<?php echo $article[0]['curlture_seo_descritpion'] ? $article[0]['curlture_seo_descritpion'] : '';?>" />
<meta name="robots" content="index, follow" />
<meta name="googlebot" content="index, follow" />
<link href="<?php echo URL_APP;?>/css/style.css" rel="stylesheet" type="text/css" />
<script src="<?php echo URL_APP;?>/js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="<?php echo URL_APP;?>/js/js.js" type="text/javascript"></script>
</head>
<body>
<div class="container">
  <!-- bof header -->
  <div class="header">
	<!-- bof headerTop -->
	<div class="headerTop">
	<img src="<?php echo URL_APP;?>/images/topbg.png" />
	</div>
	<!-- eof headerTop -->
	<!-- bof menuTop -->
	<div class="menuTop">
	  <div class="menuTopList">
		<ul>
		  <li class="menuTopList_0">
		  <a href="<?php echo URL_APP_C;?>">首页</a></li>
		  <?php   
		  if($cate['cate']) {
			foreach($cate['cate'] as $k=>$v)
		    {	
		        ?>
			  <li>
			  <?php if(!$v['sub']) {?>
			  <a href="<?php echo URL_APP_C;?>/Index/details/<?php echo $v['parent']['cate_id'];?>">
			  <?php }else{?>
			  <a href="javascript:void(0)">
			  <?php } ?>
			  <?php echo $v['parent']['cate_name']; ?></a>
			  <?php
			  if($v['sub']){
				echo "<div class='subMenu'>";
				foreach($v['sub'] as $kk=>$vv) { ?>
				  
				  <p><a href="<?php echo URL_APP_C;?>/Index/listitem/<?php echo $vv['cate_id']; ?>"><?php echo $vv['cate_name']; ?></a></p>
				  
			 <?php } 
				echo "</div>";
			 } ?>
			  </li>
			<?php  
		    }
		  ?>

		  <?php } ?>
		  

		  
		</ul>
		<div class="clearBoth"></div>
	  </div>
	</div>
	<!-- eof menuTop -->
  </div>
  <!-- eof header -->

  <!-- bof body -->
  <div class="bodyContent">
	<!-- bof banner -->
	<!-- 
	<div class="indexBanner">
	<img src="/images/br01.png" />
	</div> -->
	<!-- eof banner -->
	
	<!-- bof indexContent -->
	<div class="indexContent">

	  <!-- bof list -->
		<div class="listItemDetails">
			<!-- bof listLeft -->
			<div class="listLeft">
			<h2>分类目录</h2>
			<ul>
			<?php
			foreach($curlture as $k=>$v) { 
			?>
			<li <?php echo ($k == $article[0]['curlture_cate']) ? "id='current'": '';?>>
			<a href="<?php echo URL_APP_C;?>/Index/details/2"><?php echo $v; ?></a></li>
			<?php } ?>
			</ul>
			</div>
			<!-- eof listLeft -->
			<!-- bof listRight -->
			<div class="listRightDetails">
				<h1><?php echo $article[0]['curlture_headline']; ?></h1>
				<p class="listRightDetailsTips">
				日期：<?php echo date('Y-m-d', $article[0]['curlture_datetime']); ?>&nbsp;&nbsp;
				<?php //echo $cateName->cate_name; ?>
				</p>
				<!-- bof content -->
				<div>
				<?php echo $article[0]['curlture_content']; ?>
				</div>
				<!-- eof content -->
			</div>
			<!-- eof listRight -->
			<div class="clearBoth"></div>
		</div>
		<!-- eof list -->

	</div>
	<!-- eof indexContent -->
	<!-- bof link -->
	<div class="friendLinks">
		友情链接：
		<?php
		if(isset($linksCopy) && $linksCopy['links']) {
			foreach($linksCopy['links'] as $linkv)
			{
				echo $linkv['link_content'];
			}
		}
		?>


	</div>
	<!-- eof link -->

  </div>
  <!-- eof body -->

  <!-- bof footer -->
  <div class="footer">
		<?php	
		if(isset($linksCopy) && $linksCopy['copyright']) {
			foreach($linksCopy['copyright'] as $linkc)
			{
				echo $linkc['copy_content'];
			}
					
		}
		?>
  </div>
  <!-- eof footer -->
</div>
</body>
</html>