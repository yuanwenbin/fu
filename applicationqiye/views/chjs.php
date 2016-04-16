<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>城隍介绍<?php //echo $details ? $details[0]['article_title'] : '';?></title>
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
	<div class="details_1 details_about_bam">
	<div class="details_1_top">
	<ul>
	<li class="details_1_top_0"><img src="<?php echo URL_APP;?>/images/zst03.jpg" /></li>
	<li><img src="<?php echo URL_APP;?>/images/zst04.jpg" /></li>
	<li><img src="<?php echo URL_APP;?>/images/zst05.jpg" /></li>
	<li><img src="<?php echo URL_APP;?>/images/zst06.jpg" /></li>
	</ul>
	<div class="clearBoth"></div>
	</div>
	<p>
	2014年10月，在省、市、区各级党委和政府的关心与支持下，原皇城水都地块重回长春观的怀抱。经区民族宗教委员会等相关政府部门的批准，武汉长春观决定在此地块兴建城隍庙，旨在树立城市形象，服务市民生活，弘扬道教文化，传播中华文明。
城隍庙，起源于古代的祭祀，为《周宫》八神之一。“城”原指挖土筑的高墙，“隍”原指没有水的护城壕。[1]  古人造城是为了保护城内百姓的安全，所以修了高大的城墙以及壕城。古人认为城和隍作为城市的保护神，自古以来，凡有城池者，就建有城隍庙。很多城市都有城隍庙，如北京，上海，西安，苏州等地，而目前偌大的武汉市，却没有这样一座护佑当地百姓的城隍庙，为此武汉长春观吴诚真方丈提出：长春观作为中国道教的十方丛林，中华文化的传承之所，又是江南一大福地，理应为这块千年福地的再现辉煌做出贡献，修建一处护佑荆楚百姓，同时可供信众进行祭祀活动的场所——城隍庙。
城隍庙位于长春观西苑原皇城水都地块，建成后将由道教博物馆、道教图书馆、道教音乐厅等组成。值得一提的是，特别建立都市祠堂一处，为有缘人留下一方神圣空间，可供各位道友、功德善主设立祖先牌位、福位（福位箱中可供奉祖先信物、遗物等），达到凝福聚运，专享“江南一大福地”风水庇佑之目的。
</p>
</div>


	<div class="details_1 details_about_bam">
	<div class="details_1_top">
	<ul>
	<li class="details_1_top_0"><img src="<?php echo URL_APP;?>/images/zst07.jpg" /></li>
	<li><img src="<?php echo URL_APP;?>/images/zst08.jpg" /></li>
	<li><img src="<?php echo URL_APP;?>/images/zst09.jpg" /></li>
	<li><img src="<?php echo URL_APP;?>/images/zst10.jpg" /></li>
	</ul>
	<div class="clearBoth"></div>
	</div>

	<div>
	<p>
	城隍庙位于长春观西苑原皇城水都地块，建成后将由道教博物馆、道教图书馆、道教音乐厅等组成。值得一提的是，特别建立都市祠堂一处，为有缘人留下一方神圣空间，可供各位道友、功德善主设立祖先牌位、福位（福位箱中可供奉祖先信物、遗物等），达到凝福聚运，专享“江南一大福地”风水庇佑之目的.
	</p>
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