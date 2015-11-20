<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>00<?php //echo $details ? $details[0]['article_title'] : '';?></title>
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
		    {	?>
			  <li><a href="/Index/details/<?php echo $v['parent']['cate_id'];?>"><?php echo $v['parent']['cate_name']; ?></a>
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

	<?php // echo $details ? $details[0]['article_content'] : '';?>
		<div class="details_1">
			<div class="contantLeft">
			<p>
			<ul>
			<li>中国道教武汉长春观</li>
			<li>地址：武汉市武昌区武珞路269号</li>
			<li>邮编：430071</li>
			<li>电话：027-88842090 88870713 88871395</li>
			<li>传真：027-88842090</li>
			<li>网址：www.whccg.com</li>
			</ul>
			</p>
			</div>

			<div class="contantRight">
			<img src="/images/lxdt.jpg" />
			</div>
			<div class="clearBoth"></div>
		</div>
	</div>
	<!-- eof indexContent -->

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
  </div>
  <!-- eof body -->

  <!-- bof footer -->
  <div class="footer">
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