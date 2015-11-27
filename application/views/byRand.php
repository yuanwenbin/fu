<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>随机选号</title>
<meta name="keywords" content="seo keyword" />
<meta name="description" content="description" />
<link type="text/css" rel="stylesheet" href="/css/style.css">
<script src="/js/jquery-1.8.3.min.js" type="text/javascript"></script>
</head>
<body class="bodySj">
<!-- bof container-->
<div class="container">
	<!-- bof 11 -->
	<div class="sjTop">
	<ul>
	<li><a href="javascript:void(0);"><img src="/images/sjBtnImg.png" /></a></li>
	<li><a href="/Choice/byEight"><img src="/images/bzBtn.png" /></a></li>
	<li><a href="/Choice/byHigh"><img src="/images/gdBtn.png" /></a></li>
	<li><a href="javascript:void(0);" id="noChoice"><img src="/images/myNoBtn.png" /></a></li>
	</ul>
	<br class="clearBoth" />
	</div>
	<!-- eof 11 -->

	<!-- bof 22 -->
	<div class="sjBanner" id="lottery">
		<ul>
			<li  class="lottery-unit lottery-unit-0"><img src="/images/ico.png" /></li>
			<li  class="lottery-unit lottery-unit-1"><img src="/images/ico.png" /></li>
			<li  class="lottery-unit lottery-unit-2"><img src="/images/ico.png" /></li>
			<li class="lottery-unit lottery-unit-3"><img src="/images/ico.png" /></li>
		</ul>
		<br class="clearBoth" />
	</div>
	<!-- eof 22 -->

	<!-- bof 33 -->
	<div class="sjChoiceBtn">
	<a href="javascript:void(0);" class="startRand"><img src="/images/ksxh.jpg" /></a>
	
	<?php if($userInfo['user_selected']) {?>
	<a href="javascript:void(0);" class="cancelBtn" id="cancelBtn">
	<img src="/images/qxcx.jpg" />
	</a>
	<?php }else{?>
	<a href="javascript:void(0);" class="cancelBtn" id="cancelBtn_1">
	<img src="/images/qxcx_1.png" />
	</a>
	<?php }?>
	</div>
	<!-- eof 33 -->

	<!-- bof 44 -->
	<div class="sureBtn">
	
	<?php if($userInfo['user_selected']) {?>
	<a href="/Choice/byRandSubmit">
	<img src="/images/qdxh.jpg" />
	</a>
	<?php }else{?>
	<a href="javascript:void(0);">
	<img src="/images/qdxh_1.png" />
	</a>
	<?php }?>
	
	</div>
	<!-- eof 44 -->
</div>
<!-- eof container -->
<script type="text/javascript">

var lottery={
	index:-1,	//当前转动到哪个位置，起点位置
	count:0,	//总共有多少个位置
	timer:0,	//setTimeout的ID，用clearTimeout清除
	speed:20,	//初始转动速度
	times:0,	//转动次数
	cycle:1,	//转动基本次数：即至少需要转动多少次再进入抽奖环节
	prize:-1,	//中奖位置
	init:function(id){
		if ($("#"+id).find(".lottery-unit").length>0) {
			$lottery = $("#"+id);
			$units = $lottery.find(".lottery-unit");
			this.obj = $lottery;
			this.count = $units.length;
			$lottery.find(".lottery-unit-"+this.index).addClass("active");
		};
	},
	roll:function(){
		var index = this.index;
		var count = this.count;
		var lottery = this.obj;
		$(lottery).find(".lottery-unit-"+index).removeClass("active");
		index += 1;
		if (index>count-1) {
			index = 0;
		};
		$(lottery).find(".lottery-unit-"+index).addClass("active");
		this.index=index;
		//this.index=0
		
		return false;
	},
	stop:function(index){
		this.prize=index;
		this.prize=0;
	  $("#lottery ul li").removeClass("active");
		
		return false;
	}
};

function roll(){
	lottery.times += 1;
	lottery.roll();
	if (lottery.times > lottery.cycle+5 && lottery.prize==lottery.index) {
		clearTimeout(lottery.timer);
		lottery.prize=-1;
		lottery.times=0;
		click=false;
	}else{
		if (lottery.times<lottery.cycle) {
			//lottery.speed -= 20;
			lottery.speed = 20;
		}else if(lottery.times==lottery.cycle) {
			var index = Math.random()*(lottery.count)|0;
			lottery.prize = index;		
		}else{
			if (lottery.times > lottery.cycle+5 && ((lottery.prize==0 && lottery.index==7) || lottery.prize==lottery.index+1)) {
				//lottery.speed += 20;
				lottery.speed = 20;
			}else{
				//lottery.speed += 20;
				lottery.speed = 20;
			}
		}
		if (lottery.speed<20 || lottery.speed>20) {
			lottery.speed=20;
		};
		//console.log(lottery.times+'^^^^^^'+lottery.speed+'^^^^^^^'+lottery.prize);
		lottery.timer = setTimeout(roll,lottery.speed);
	}
	return false;
}

var click=false;



$(document).ready(function(){
	lottery.init('lottery');
    $(".startRand").click(function(){
		$('#lottery ul li').removeClass('active').eq(0).html("<img src=\"/images/ico.png\">");
		if (click) {
			return false;
		}else{
			lottery.speed=20;
			roll();
			click=true;
			lottery.stop();

			$.post('/Choice/byRandDo',{r:Math.random()},function(data){
				if(data.count == 1)
				{
					$('.cancelBtn').html("<img src=\"/images/qxcx.jpg\" />");
				    $('.sureBtn').html("<a href=\"/Choice/byRandSubmit\"><img src=\"/images/qdxh.jpg\" /></a>");
				    //显示号码
				    // $('#lottery ul li.active').html(data.msg);
				    $('#lottery ul li').removeClass('active').eq(0).addClass('active').html(data.msg);
					return false;
				}else
				{   
					$('#lottery ul li').removeClass('active').eq(0).addClass('active').html("选号中...");
					window.location.href="/Choice/byRandSubmit";
					return true;
				}				
			}, 'json');
			return true;

		}
    });
    // 选号提示 
    $('#noChoice').click(function(){
        alert("您暂未有选号噢，请选号！");
 	   return false;
    });
    //检测是否选号了 /Choice/byRandSubmit
    $('.cancelBtn').click(function(){
        $('#lottery ul li').removeClass('active').html("<img src=\"/images/ico.png\" />");
        $(this).html("<img src=\"/images/qxcx_1.png\" />");
        $('.sureBtn').html("<a href=\"javascript:void(0);\"><img src=\"/images/qdxh_1.png\" /></a>");
    });
	
});


</script>
</body>
</html>