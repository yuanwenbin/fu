<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>都市祠堂<?php //echo $details ? $details[0]['article_title'] : '';?></title>
<meta name="Keywords" content="<?php //echo $details ? $details[0]['article_keywords'] : '';?>" />
<meta name="Description" content="<?php //echo $details ? $details[0]['article_description'] : '';?>" />
<meta name="robots" content="index, follow" />
<meta name="googlebot" content="index, follow" />
<link href="/css/style.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="/js/js.js" type="text/javascript"></script>
</head>
<body>
<div class="container">
  <!-- bof header -->
  <div class="header">
	<!-- bof headerTop -->
	<div class="headerTop">
	<img src="/images/topbg.png" />
	</div>
	<!-- eof headerTop -->
	<!-- bof menuTop -->
	<div class="menuTop">
	  <div class="menuTopList">
		<ul>
		  <li class="menuTopList_0">
		  <a href="/">首页</a></li>
		  <?php
		  if($cate['cate']) {
			foreach($cate['cate'] as $k=>$v)
		    {	
		        ?>
			  <li>
			  <?php if(!$v['sub']) {?>
			  <a href="/Index/details/<?php echo $v['parent']['cate_id'];?>">
			  <?php }else{?>
			  <a href="javascript:void(0)">
			  <?php } ?>
			  <?php echo $v['parent']['cate_name']; ?></a>
			  <?php
			  if($v['sub']){
				echo "<div class='subMenu'>";
				foreach($v['sub'] as $kk=>$vv) { ?>
				  
				  <p><a href="/Index/listitem/<?php echo $vv['cate_id']; ?>"><?php echo $vv['cate_name']; ?></a></p>
				  
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

	<?php //echo $details ? $details[0]['article_content'] : '';?>
	<div class="details_img">
	<img src="/images/image_1.jpg" />
	<img src="/images/image_2.jpg" />
	</div>
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