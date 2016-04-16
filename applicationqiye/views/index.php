<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>道教长春观城隍庙</title>
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<meta name="robots" content="index, follow" />
<meta name="googlebot" content="index, follow" />
<link href="<?php echo URL_APP;?>/css/style.css" rel="stylesheet" type="text/css" />
<script src="<?php echo URL_APP;?>/js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="<?php echo URL_APP;?>/js/js.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo URL_APP;?>/js/lrtk.js"></script>
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
		<!-- 代码 开始 -->
  <div id="playBox">
    <div class="pre"></div>
    <div class="next"></div>
    <div class="smalltitle">
      <ul>
        <li class="thistitle"></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ul>
    </div>
    <ul class="oUlplay">
       <li><a href="javascript:void(0);"><img src="<?php echo URL_APP;?>/images/br01.png"></a></li>
       <li><a href="javascript:void(0);"><img src="<?php echo URL_APP;?>/images/br01.png"></a></li>
       <li><a href="javascript:void(0);"><img src="<?php echo URL_APP;?>/images/br01.png"></a></li>
       <li><a href="javascript:void(0);"><img src="<?php echo URL_APP;?>/images/br01.png"></a></li>
       <li><a href="javascript:void(0);"><img src="<?php echo URL_APP;?>/images/br01.png"></a></li>
       <li><a href="javascript:void(0);"><img src="<?php echo URL_APP;?>/images/br01.png"></a></li>
    </ul>
  </div>
<!-- 代码 结束 -->
	<!-- eof banner -->
	
	<!-- bof indexContent -->
	<div class="indexContent">
	<img src="<?php echo URL_APP;?>/images/twjh.png" />
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