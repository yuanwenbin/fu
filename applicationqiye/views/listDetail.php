<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $article[0]['article_title']; ?></title>
<meta name="Keywords" content="<?php echo $article ? $article[0]['article_keywords'] : '';?>" />
<meta name="Description" content="<?php echo $article ? $article[0]['article_description'] : '';?>" />
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

	  <!-- bof list -->
		<div class="listItemDetails">
			<!-- bof listLeft -->
			<div class="listLeft">
			<h2>分类目录</h2>
			<ul>
			<?php
			foreach($result['subCate'] as $k=>$v) { 
			?>
			<li><a href="/Index/listitem/<?php echo $v['cate_id'];?>"><?php echo $v['cate_name']; ?></a></li>
			<?php } ?>
			</ul>
			</div>
			<!-- eof listLeft -->
			<!-- bof listRight -->
			<div class="listRightDetails">
				<h1><?php echo $article[0]['article_title']; ?></h1>
				<p class="listRightDetailsTips">
				日期：<?php echo date('Y-m-d', $article[0]['article_datetime']); ?>&nbsp;&nbsp;
				<?php echo $cateName->cate_name; ?>
				</p>
				<!-- bof content -->
				<div>
				<?php echo $article[0]['article_content']; ?>
				</div>
				<!-- eof content -->
			</div>
			<!-- eof listRight -->
			<div class="clearBoth"></div>
		</div>
		<!-- eof list -->

	</div>
	<!-- eof indexContent -->


  </div>
  <!-- eof body -->

  <!-- bof footer -->
  <div class="footer" style="margin-top:200px;">
		<!-- bof link -->
	<div class="friendLinks">
		友情链接：
		<a href="">国家宗教局</a>
		<a href="">国家宗教局</a>
		<a href="">国家宗教局</a>
		<a href="">国家宗教局</a>
		<a href="">国家宗教局</a>
		<a href="">国家宗教局</a>
	</div>
	<!-- eof link -->
  <p>
	  <font>宫观介绍</font>&nbsp;|&nbsp;<font>道教典籍</font>&nbsp;|&nbsp;<font>联系我们</font>&nbsp;|&nbsp;<font>道德艺术馆</font>
  </p>
    <p>
	中国道教武汉长春观&nbsp;版权所有&nbsp;网站备案号：鄂ICP备123645号
	</p>
    <p>
	地址：湖北省武汉市武珞路269号&nbsp;电话027-88842090 88720727 网址：wwww.lin3615.net
	</p>
  </div>
  <!-- eof footer -->
</div>
</body>
</html>