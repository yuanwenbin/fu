<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>长春古观</title>
<meta name="Keywords" content="<?php //echo $details ? $details[0]['article_keywords'] : '';?>" />
<meta name="Description" content="<?php //echo $details ? $details[0]['article_description'] : '';?>" />
<meta name="robots" content="index, follow" />
<meta name="googlebot" content="index, follow" />
<link href="/css/style.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="/js/js.js" type="text/javascript"></script>
<script type="text/javascript" src="/js/lrtk.js"></script>
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
       <li><a href="javascript:void(0);"><img src="/images/br02.jpg"></a></li>
       <li><a href="javascript:void(0);"><img src="/images/br02.jpg"></a></li>
       <li><a href="javascript:void(0);"><img src="/images/br02.jpg"></a></li>
       <li><a href="javascript:void(0);"><img src="/images/br02.jpg"></a></li>
       <li><a href="javascript:void(0);"><img src="/images/br02.jpg"></a></li>
       <li><a href="javascript:void(0);"><img src="/images/br02.jpg"></a></li>
    </ul>
  </div>
<!-- 代码 结束 -->
	<?php// echo $details ? $details[0]['article_content'] : '';?>
		<div class="details_1 details_ccgc">
		<p>长春观位于武昌大东门东北角双峰山南坡，黄鹄山(蛇山)中部，是我国道教著名十方丛林之一，为历代道教活动场所。称“江南一大福地”。观内崇奉道教全真派，以其创始人重阳祖师门人邱处机道号“长春子”命名。
以纪念道教全真派北七真之一，龙门宗的创始人丘处机。丘处机，(公元1148年-1227，字通密，号长春子)在元军南下时“一言止杀“济世救民之劝德。始称“长春观”。</p>
 
<p>长春观历史悠久，道学渊源，被武汉市列为一级文物保护单位。不仅是一座道教修身养性、礼神朝真的宗教活动场所，也是处风景清幽、建筑典雅的游览胜地。其历史悠久，风景清幽，山势峻美，福地洞天，就连远在江西的庐山历史上也设有长春观的下院。</p>
相传古代，此地为湖汊，因多松树而称之为“松岛”。楚地崇巫，甚有影响。故秦汉以后，此地有“先农坛”、“神祗坛”、“太极宫”之称，即王侯祭祀天地、祖先之地。据传道教始祖老子曾应弟子之邀赴庐阜“会五老”，到了江南鄂州即西转而到湖港之乡、双峰山麓的松岛。人们为了纪念他，建老子宫以示纪念。南宋的朱熹在他的《鄂州社稷坛记》中真实地记载了这块风水宝地：“城东黄鹄山，废营地一区。东西十丈，南北倍差，按政和五礼画为四坛”。</p>
 
<p>元初时，全真龙门派创始人丘处机，号长春子，创道教十方丛林制度多次受元太祖成吉思汗的封赏，掌管天下道教。于是丘处机便派弟子至荆湖之地的武汉创办道教丛林，弟子为纪其事，在松岛修建长春观，祭奉长春真人。每年农历正月十九为长春真人圣诞，长春观要举行隆重盛大的丘祖会，武汉民俗称之为“迎春会”，也称“燕九节”。《桃花扇》的作者孔尚任为此作有《燕九竹枝词》：“才是星桥又步云，真仙不遇心如结”，描绘了这一盛会。明时楚昭王朱桢过生日，至黄鹄山的长春观为其父朱元璋祈寿降香，取“长春观”长春二字改此山为长春山。清诗人王柏心在《过长春观鹿频炼师气诗》中道：“山川俯迎劫灰余，杰观盍开阆苑居；紫府琼台仍缥缈，亡都金阙故清虚”。乃言长春观几经战火，几经修复，历史沧桑。
长春观在三国时是一片茂密的竹林，被称为“紫竹岭”。“二十四孝”中孟宗“哭竹生笋”的故事就发生在长春观旁的螃蟹甲。长春观东院有孟宗祠是纪念此事的。志书中还言：“时有黄鹤飞腾于紫竹间”。长春观旁的白鹤井有白鹤泉一口，是仙鹤们饮水之处。又称吕仙炼丹井，（此井在五十年代修长江大桥后被封口，但仍存）</p>
 
<p>长春观在明世宗年间就“仙真代出，为湖北丛林特著，屋宇间，道友万数，香火辉煌”。观内珍藏之全套明版《正统道藏》，解放前是全国唯一四部之一。著名的音韵学者钱大昕，在长春观处武昌要冲，观宇建筑遭兵燹又屡次重建。清末太平军与清军曾三次争夺武昌城，长春观为其大帅指挥部，又因太平军信基督教，视佛、道二教为异端，逐毁长春观。清王朝在湖北督办军务的钦差大臣官文的七律诗《观焚》乃是绝好之见证：</p>
<p>
古观焚如岁月迁，问谁火里种青莲。
春风料峭双峰树，郁气氤氲万缕烟。
每意沧桑增阅历，欲寻洞府学神仙。
有缘到此空休返，且上回头普渡船。
 </p>
 <p>
1864 年，龙门第十六代宗师何合春从武当山下山来到此地，见神圣之地尽毁于一片废墟，甚是痛心。于是坐地化缘，发愿修复圣地。此举得到官文及江南提督军门李世宗捐助，进行了大规模修缮，使长春观“庙貌森严，回复旧观”。
 </p>
 <p>
长春观在近代中国革命史上也有着光辉灿烂的一页。早年的“辛亥革命”的策划者曾以道观为掩护居此处筹划起义事宜； 1926 年，北伐军叶挺独立师驻扎长春观，并在三皇殿设立前线指挥部。国民革命军总政治部副主任郭沫若曾在观内暂住。邓演达在此督战，衣袖被子弹击穿，俄国翻译纪德甫殉难在观内。为此，郭沫若挥泪痛悼北伐英烈：
</p>
  <p>
一弹穿头复贯胸，成仁心事底从容。
宾阳门外长春观，留待千秋史管彤。
 </p>
  <p>
长春观有闻名于世的“三绝”，那就是全国仅留一块的“天文图”、带有欧式风格的建筑、乾隆帝御赐“甘棠”石刻。全国在解放初留三块“天文图”碑，为道教天文学家所留，上刻有“谕旨”二字。一块在杭州玉皇山，一块在陕西某观，一块即在长春观。现前二块皆毁于文革，仅留长春观一块全图碑，乃为一绝，是极珍贵的天文学文物；二是清末长春观主持侯永德原本是左宗棠手下的一员将官，后出家为道人，主持长春观时受西方思潮影响，以欧式风格和中式风格相结合，修建了全国唯一的欧式建筑为主体的道教建筑——道藏阁，其屋檐上用水泥“堆塑”而成的传统花饰，其工艺现已失传，堪为一绝；再则是位于道藏阁前的乾隆亲书石刻“甘棠”二字，也是在道教建筑中为数不多的帝王题词，亦为一绝。
今之长春观，不仅是道教徒修身布道的著名活动场所，亦为武汉市之旅游胜地之一，被誉为闹市中的清静福地，常使人穿梭于历史与现代文明之间，感悟良多。
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