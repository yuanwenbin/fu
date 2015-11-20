<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>随机选号</title>
<meta name="keywords" content="seo keyword" />
<meta name="description" content="description" />
<link type="text/css" rel="stylesheet" href="/css/style.css">
<style type="text/css">
.g-mn { clear: both; }



.m-prodlist { width: 90px; }

.m-prod { float: left; width: 90px; padding-left: 22px; height: 89px; }

.m-prod-current { position: relative; z-index: 10; }
.m-prod-current .img { top: -100% !important; }

.m-prod-box { position: relative; background-image: url(images/prod_shadow.png); background-position: 100% 100%; background-repeat: no-repeat; background-color: transparent; padding-right: 28px; width: 90px; height: 89px; overflow: hidden; }
.m-prod-box .img { position: absolute; z-index: 1; left: 0; top: 0; }
.m-prod-box .brand { background-image: url(images/ico.png); background-position: 0 -80px; background-repeat: repeat; background-color: transparent; width: 46px; height: 58px; position: absolute; left: 1px; top: 1px; z-index: 3; text-align: center; font-weight: bold; font-size: 18px; line-height: 18px; color: #7c4f00; padding-top: 5px; }
.m-prod-box .brand span { font-size: 12px; display: block; text-decoration: line-through; }
.m-prod-box .brand2 { background-image: url(images/ico.png); background-position: 0 -160px; background-repeat: repeat; background-color: transparent; width: 46px; height: 52px; position: absolute; left: 1px; top: 1px; z-index: 3; text-align: center; font-weight: bold; font-size: 14px; line-height: 18px; color: #4d0803; padding-top: 12px; }
.m-prod-box .ctrl { position: absolute; left: 35px; bottom: 20px; z-index: 4; }
.m-prod-box .ctrl li { float: left; margin-right: 5px; }
.m-prod-box .ctrl .btn { display: block; width: 20px; height: 20px; text-indent: -30000px; overflow: hidden; background-image: url(images/ico.png); background-position: 0 0; background-repeat: repeat; background-color: transparent; }
.m-prod-box .ctrl .btn-1 { background-position: 0 0; }
.m-prod-box .ctrl .btn-2 { background-position: -40px 0; }
.m-prod-box .ctrl .btn-3 { background-position: -80px 0; }
.m-prod-box .ctrl .btn-4 { background-position: -120px 0; }
.m-prod-box .ctrl .btn-5 { background-position: -160px 0; }
.m-prod-box .ctrl a:hover { filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=80); opacity: 0.8; }

.m-prod-player { width: 90px; height: 34px; background-image: url(images/ico.png); background-position: -60px -80px; background-repeat: repeat; background-color: transparent; display: none; }
.m-prod-player .btn { display: block; width: 30px; height: 33px; background-image: url(images/ico.png); background-position: 0 0; background-repeat: repeat; background-color: transparent; float: left; text-indent: -30000px; overflow: hidden; }
.m-prod-player .btn-1 { background-position: -30px -28px; }
.m-prod-player .btn-2 { background-position: 10px -28px; }
.m-prod-player .btn-3 { background-position: -70px -28px; float: right; }
.m-prod-player a:hover { filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=60); opacity: 0.6; }
.m-prod-player .screen { line-height: 24px; float: left; width: 124px; height: 24px; padding: 5px 5px 0; text-align: center; color: #8c5e49; white-space: nowrap; overflow: hidden; }
.m-prod-player .screen span { margin: 0 15px; }
.m-prod-player .screen .scroll { width: 1000px; }
.m-prod-player .screen .scroll span { float: left; }

.m-prod-tips { background: #340d03; border: 6px solid #4d210e; color: #8c5e49; width: 158px; height: 144px; line-height: 24px; overflow: hidden; padding: 5px 12px; display: none; }
.m-prod-tips .ico { float: right; margin: -6px -12px -10px 0; }

.m-prodlist-3 {width:448px;margin:120px auto 0 auto;;}
.m-prodlist-3 .m-prod { margin-top:38px; position: relative; }
.m-prodlist-3 .m-prod-box { background-image: none; cursor: pointer; }
.m-prodlist-3 .drawbtn { float: right; margin: 50px 50px 0 0; }
.m-prodlist-3 .drawbtn:hover { filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=90); opacity: 0.9; }
.m-prodlist-3 .mask { position: absolute; left: 22px; top: 0; width: 90px; height: 89px; background: #281109; filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0); opacity: 0; z-index: 3; }
.m-prodlist-3 .mask01 { filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=80); opacity: 0.8; }
.m-prodlist-3 .mask02 { display: none; }
</style>
<script src="/js/jquery-1.8.3.min.js" type="text/javascript"></script>
</head>
<body class="bodySj">
<!-- bof container-->
<div class="container">
	<!-- bof 11 -->
	<div class="sjTop">
	<ul>
	<li><a href="/Choice/byRand"><img src="/images/sjBtnImg.png" /></a></li>
	<li><a href="/Choice/byEight"><img src="/images/bzBtn.png" /></a></li>
	<li><a href="/Choice/byHigh"><img src="/images/gdBtn.png" /></a></li>
	<li><a href="/Choice/index"><img src="/images/myNoBtn.png" /></a></li>
	</ul>
	<br class="clearBoth" />
	</div>
	<!-- eof 11 -->

	<!-- bof 22 -->
	<div class="sjBanner">
		<div class="m-prodlist m-prodlist-3" id="drawprod">
			<?php for($i=0; $i<=3; $i++) { ?>
			      		
					<div class="m-prod">
						<div class="m-prod-box">
							<div class="img"><img src="/images/ico.png" width="90" height="89" alt="妖精的旋律"></div>
						</div>
						<div class="mask"></div>
					</div>
				
			<?php } ?>
			<br class="clearBoth" />
			</div>	
        <!-- <button name="抽奖" type="button" id="drawbtn" class="drawbtn" value="抽奖">抽奖</button> -->
      
    </div>
	
	
	<!-- eof 22 -->

	<!-- bof 33 -->
	<div class="sjChoiceBtn">
	<a href="javascript:void(0);" class="startRand drawbtn" id="drawbtn"><img src="/images/ksxh.jpg" /></a>
	<a href="javascript:void(0);" class="cancelBtn"><img src="/images/qxcx.jpg" /></a>
	</div>
	<!-- eof 33 -->

	<!-- bof 44 -->
	<div class="sureBtn">
	<a href="/Choice/byRandSubmit"><img src="/images/qdxh.jpg" /></a>
	</div>
	<!-- eof 44 -->
</div>
<!-- eof container -->
<script type="text/javascript">
$.fn.draw = function(options){
  var $_this = $(this);
	var $dp = options.prod;
  var $i = 0; //index
  var $r = 0; //round
  var $s = 150; //spead
  function dr(){
  	//drawround
    if($_this.res!='' && $_this.res!=undefined && $i==0){
			dr2();
    }else{
      $dp.find(".mask").removeClass("mask01").eq($i).addClass("mask01");
      $i = $i >= 3 ? 0 : $i+1;
			setTimeout(dr,$s);
    }
  }
	function dr2(){
		$dp.find(".mask").removeClass("mask01").eq($i).addClass("mask01");
    $i = $i >= 3 ? 0 : $i+1;
    //$s = $s+200;
    if( $r < $_this.res + 4 ){
      $r++;
    }else{
      $i = 0;
      $r = 0;
      $s = 100;
      setTimeout(result,1000);
      return;
    }
		setTimeout(dr2,$s);
	}
  function getRes(){
		$_this.res = '';
		//赋结果值
  	setTimeout(function(){$_this.res = 1},1000);
  }
  function click(){
    $_this.bind("click",function(){
			getRes();
      dr();
      $_this.unbind("click");
    });
  }click();
  function result(){
	$dp.find(".mask").removeClass("mask01");
    click();
  }
}
// //////
$(document).ready(function(){
    $("#drawbtn").click(function(){
		//$(this).draw({
			$("#drawprod").draw({
			prod:$("#drawprod")
				/*
			setTimeout(function(){	
				$.post('/Choice/byRandDo',{},function(data){
					if(data.count == 1)
					{
						alert("您选择的号码是："+data.msg+",还有一次随机选择的机会，确认此号码");
						return false;
					}else
					{
						window.document.location.href="/Choice/byRandSubmit";
					}
					
				}, 'json');
			},8000);
			*/
		});

		/*	
		setTimeout(function(){	
			$.post('/Choice/byRandDo',{},function(data){
				if(data.count == 1)
				{
					alert("您选择的号码是："+data.msg+",还有一次随机选择的机会，确认此号码");
					return false;
				}else
				{
					window.document.location.href="/Choice/byRandSubmit";
				}
				
			}, 'json');
		},8000);
		*/
    });
	
});
/*
$("#drawbtn").draw({
	prod:$("#drawprod")
});
*/
</script>
</body>
</html>