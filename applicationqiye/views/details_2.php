<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>道教文化<?php //echo $details ? $details[0]['article_title'] : '';?></title>
<meta name="Keywords" content="<?php //echo $details ? $details[0]['article_keywords'] : '';?>" />
<meta name="Description" content="<?php //echo $details ? $details[0]['article_description'] : '';?>" />
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

	<?php //echo $details ? $details[0]['article_content'] : '';?>
	<div class="curlture">
	  <!-- bof 1 -->
	  <div class="curlture_1">
		<div class="curltureHeader">
		<?php
			echo $curlture[0];
		?>
		</div>
		<!-- bof list -->
		<?php
		if(isset($list[0]) && $list[0]){
		?>
		<div class="curltureList">
			<ul>
				<?php
				foreach($list[0] as $v) { 
				?>
				<li><a href="<?php echo URL_APP_C;?>/Index/curlture/<?php echo $v['curlture_id'];?>"><?php echo $v['curlture_headline']; ?></a></li>

				<?php } ?>
			</ul>
			<div class="clearBoth"></div>
		</div>
		<?php } ?>
		<!-- eof list -->
	  </div>
	  <!-- eof 1 -->

	  <!-- bof 1 -->
	  <div class="curlture_1">
		<div class="curltureHeader">
		<?php
			echo $curlture[1];
		?>
		</div>
		<!-- bof list -->
		<?php
		if(isset($list[1]) && $list[1]){
		?>
		<div class="curltureList">
			<ul>
				<?php
				foreach($list[1] as $v) { 
				?>
				<li><a href="<?php echo URL_APP_C;?>/Index/curlture/<?php echo $v['curlture_id'];?>"><?php echo $v['curlture_headline']; ?></a></li>

				<?php } ?>
			</ul>
			<div class="clearBoth"></div>
		</div>
		<?php } ?>
		<!-- eof list -->		
	  </div>
	  <!-- eof 1 -->
	  
	  <!-- bof 1 
	
	  <div class="curlture_1">
		<div class="curltureHeader">
		<?php
			//echo $curlture[2];
		?>
		</div>
		 bof list -->
		<?php
		//if(isset($list[2]) && $list[2]){
		?> <!-- 
		<div class="curltureList">
			<ul> -->
				<?php
				//foreach($list[2] as $v) { 
				?><!--
				<li><a href="/Index/curlture/ -->
				<?php //echo $v['curlture_id'];?>
				<!--"> -->
				<?php// echo $v['curlture_headline']; ?>
				<!-- </a></li> -->

				<?php //} ?>
				<!-- 
			</ul>
			<div class="clearBoth"></div>
		</div> -->
		<?php //} ?>
		<!-- eof list 		
	  </div>
	   eof 1 -->

	  <!-- bof 1 -->
	  <div class="curlture_1">
		<div class="curltureHeader">
		<?php
			echo $curlture[3];
		?>
		</div>
		<!-- bof list -->
		<?php
		if(isset($list[3]) && $list[3]){
		?>
		<div class="curltureList" id="curltureListImg">
			<ul>
				<?php
				foreach($list[3] as $v) { 
				?>
				<li>
				<div>
				<a href="<?php echo URL_APP_C;?>/Index/curlture/<?php echo $v['curlture_id'];?>">
				<img src="<?php echo URL_APP;?><?php echo $v['curlture_pic']; ?>" width="195" height="135" /></a>
				</div>
				<p>
				<a href="<?php echo URL_APP_C;?>/Index/curlture/<?php echo $v['curlture_id'];?>">
				<?php echo $v['curlture_headline']; ?></a>
				</p>
				</li>

				<?php } ?>
			</ul>
			<div class="clearBoth"></div>
		</div>
		<?php } ?>
		<!-- eof list -->		
	  </div>
	  <!-- eof 1 -->


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