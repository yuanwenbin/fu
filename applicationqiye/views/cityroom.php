<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>都市祠堂<?php //echo $details ? $details[0]['article_title'] : '';?></title>
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

	
		<!-- bof indexContent -->
		<div class="indexContent">
			<div class="details_1 details_about_city">
				<div class="details_1_top">
					<div class="details_1_top_left">
						<h3><img src="<?php echo URL_APP;?>/images/headline.jpg" /></h3>
						<div>
						<p>第一次是在1956年由毛泽东等老一辈无产阶级革命家提出火化。如八宝山，国家领导人及社会名流逝世以后均以塔陵的形式供奉于殿堂内。</p>

						<p>第二次是在1982年提出公共墓地集中管理条例</p>

						<p>第三次是在1997年由朱镕基总理提出殡葬用地尽量少占地或者不占地，往立体化，空间化发展，中国人口占全世界22%，耕地面积仅占7%，改革的目的是节约土地，不占耕地。严格限制公墓面积和使用年限。非国家保护墓地外，其余应当限期迁移或深埋，不留坟头。（国务院628号令）</p>
						</div>
					</div>

					<div class="details_1_top_right">
					<img src="<?php echo URL_APP;?>/images/city1.jpg" />
					</div>
					<div class="clearBoth"></div>
				</div>

				<!-- bof -->
				<div class="cityRoom_bg">
					<img src="<?php echo URL_APP;?>/images/ct02.png" />
				</div>
				<!-- eof -->

				<!-- bof bottom -->
				<div class="details_1_top">
					<div class="details_1_bottom_left">
						<ul>
						<li><img src="<?php echo URL_APP;?>/images/city2.jpg" /></li>
						<li><img src="<?php echo URL_APP;?>/images/city3.jpg" /></li>
						<li><img src="<?php echo URL_APP;?>/images/city4.jpg" /></li>
						</ul>
					</div>	

					<div class="details_1_bottom_right">
						<p>一.观宫一体，众神护佑  </p>             

						<p>二.城市中心，祭祀方便</p> 

						<p>三.永续传承，免于搬迁    </p>       

						<p>四.风水宝地，时来运转  </p>    

						<p>五.提前准备，安享晚年</p> 
					</div>
					<div class="clearBoth"></div>
				</div>
				<!-- eof bottom -->

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