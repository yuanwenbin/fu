<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>随机选号</title>
<meta name="keywords" content="seo keyword" />
<meta name="description" content="description" />
<link type="text/css" rel="stylesheet" href="<?php echo URL_APP;?>/css/style.css">
<style type="text/css">
#refuseContent{position:fixed;z-index:9999;display:none;height:145px;width:280px;border:1px solid #444;background:#fff;overflow-y:auto;}
.refuseContent{margin:15px;margin-top:35px;}
.refuseContent input{border:1px solid #444;padding:3px;}
#notice{text-align:center;color:#ff0000;line-height:28px;}

#randContent{position:fixed;z-index:9999;display:none;height:145px;width:280px;border:1px solid #444;background:#fff;overflow-y:auto;}
.randContent{margin:15px;margin-top:35px;}
.randContent input{border:1px solid #444;padding:3px;}
#randnotice{text-align:center;color:#ff0000;line-height:28px;}

#priceNotice{text-align:center;color:#ff0000;line-height:28px;}

#priceContent{position:fixed;z-index:9999;display:block;height:100px;width:300px;border:1px solid #444;background:#fff;overflow-y:auto;}
.priceContent{margin:30px 0 0 15px;}
.priceContent select{border:1px solid #444;padding:3px;font-family:'Microsoft YaHei','微软雅黑','宋体','黑体',Verdana, Geneva, sans-serif;}
.priceContent select option{height:24px;line-height:24px;}
.priceContent input{font-family:'Microsoft YaHei','微软雅黑','宋体','黑体',Verdana, Geneva, sans-serif;}


.myDiv{width:100%;height:100%;position:fixed;background:#000; background-color:rgba(0,,0,0.5);
filter:Alpha(opacity=50);-moz-opacity:0.5; 
opacity:0.5;z-index:9999;margin-top:-187px;}
</style>
<script src="<?php echo URL_APP;?>/js/jquery-1.8.3.min.js" type="text/javascript"></script>
</head>
<body class="bodySj">
<div id="myDiv"></div>
<!-- bof container-->
<div class="container">
	<!-- bof 11 -->
	<div class="sjTop">
	<ul>
	<li><a href="javascript:void(0);"><img src="<?php echo URL_APP;?>/images/sjBtnImg.png" /></a></li>
	<li><a href="<?php echo URL_APP_C;?>/Choice/byEight"><img src="<?php echo URL_APP;?>/images/bzBtn.png" /></a></li>
	<?php if($highFlag) {?>
	<li><a href="<?php echo URL_APP_C;?>/Choice/byHigh"><img src="<?php echo URL_APP;?>/images/gdBtn.png" /></a></li>
	<?php }else{?>
	<li><a href="javascript:void(0);"  class="refuseDevilery"><img src="<?php echo URL_APP;?>/images/gdBtn.png" /></a></li>
	<?php } ?>
	<li><a href="javascript:void(0);" id="noChoice"><img src="<?php echo URL_APP;?>/images/myNoBtn.png" /></a></li>
	</ul>
	<br class="clearBoth" />
	<!-- bof selectPrice -->
	<?php // print_r($priceList); PRINT_R($maxPrice);?>
	<div class="selectPriceBox">
	类型切换：&nbsp;
	<?php if($roomList) { ?>
	<select name="selectPriceBox">
	<?php foreach($roomList as $kv) {?>
	<option value="<?php echo $kv['room_id']; ?>" <?php   if($room_id == $kv['room_id']) echo 'selected';?>>
	<?php echo $kv['room_alias']; ?></option>
	<?php }}else { ?>
	没有相关的数据，请联系理员
	<?php }?>
	</select>
	</div>
	<!-- eof selecPrice  -->
	</div>
	<!-- eof 11 -->
	
	<!-- bof 22 -->
	<div class="sjBanner" id="lottery">
		<ul>
			<li  class="lottery-unit lottery-unit-0"><img src="<?php echo URL_APP;?>/images/ico.png" /></li>
			<li  class="lottery-unit lottery-unit-1"><img src="<?php echo URL_APP;?>/images/ico.png" /></li>
			<li  class="lottery-unit lottery-unit-2"><img src="<?php echo URL_APP;?>/images/ico.png" /></li>
			<li class="lottery-unit lottery-unit-3"><img src="<?php echo URL_APP;?>/images/ico.png" /></li>
		</ul>
		<br class="clearBoth" />
	</div>
	<!-- eof 22 -->

	<!-- bof 33 -->
	<div class="sjChoiceBtn">
	<a href="javascript:void(0);" class="startRand" id="startRand"><img src="<?php echo URL_APP;?>/images/ksxh.jpg" /></a>
	
	<?php if($userInfo['user_selected']) {?>
	<a href="javascript:void(0);" class="cancelBtn" id="cancelBtn">
	<img src="<?php echo URL_APP;?>/images/qxcx.jpg" />
	</a>
	<?php }else{?>
	<a href="javascript:void(0);" class="cancelBtn" id="cancelBtn_1">
	<img src="<?php echo URL_APP;?>/images/qxcx_1.png" />
	</a>
	<?php }?>
	</div>
	<!-- eof 33 -->

	<!-- bof 44 -->
	<div class="sureBtn">
	
	<?php if($userInfo['user_selected']) {?>
	<a href="<?php echo URL_APP_C;?>/Choice/byRandSubmit">
	<img src="<?php echo URL_APP;?>/images/qdxh.jpg" />
	</a>
	<?php }else{?>
	<a href="javascript:void(0);">
	<img src="<?php echo URL_APP;?>/images/qdxh_1.png" />
	</a>
	<?php }?>
	
	</div>
	<!-- eof 44 -->
</div>
<!-- eof container -->

<!-- bof 捐赠额档次选择  -->
<?php if(!$room_id) { ?>
<div id="priceContent">
	
	<div class="priceContent">
	<form onSubmit="javascript:return false;">
	<label>类型：</label><select name="price">
	<?php foreach($roomList as $vv) {?>
	<option value="<?php echo $vv['room_id'];?>"><?php echo $vv['room_alias']; ?></option>
	<?php } ?>
	</select>&nbsp;&nbsp;
	<input type="submit" name="submitPrice" value="提交" />
	
	</form>
	<p id="priceNotice"></p>
	</div>   
	      
</div>
<?php } ?>
<!-- eof 捐赠额档次选择  -->

<!-- bof 高端验证入口  -->
<div id="refuseContent">
	
	<div class="refuseContent">
	<form action="" method="post">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="30%" align="center">高端密码&nbsp;</td>
			<td width="63%"><input type="text" name="content" value=""></td>
		</tr>
		<tr>
			<td width="30%" align="center">&nbsp;&nbsp;</td>
			<td width="63%">&nbsp;</td>
		</tr>
		<tr>
			<td width="30%" align="center">&nbsp;</td>
			<td width="63%">
			&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="javascript:void(0);" id="refuseCancel">取消</a>
			&nbsp;
			<a href="javascript:void(0);" id="refuseSubmit">提交</a>
			</td>
		</tr>
	</table>
		

	</form>
	<p id="notice"></p>
	</div>   
	      
</div>
<!-- eof 高端验证入口  -->

<!-- bof 随机验证入口  -->
<div id="randContent">
	
	<div class="randContent">
	<form action="" method="post">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="30%" align="center">&nbsp;随机密码</td>
			<td width="63%"><input type="text" name="randcontent" value=""></td>
		</tr>
		<tr>
			<td width="30%" align="center">&nbsp;&nbsp;</td>
			<td  width="63%">&nbsp;</td>
		</tr>
		<tr>
			<td width="30%" align="center">&nbsp;</td>
			<td width="63%">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="javascript:void(0);" id="randCancel">取消</a>
			&nbsp;
			<a href="javascript:void(0);" id="randSubmit">提交</a>
			</td>
		</tr>
	</table>
		

	</form>
	<p id="randnotice" data-attr="<?php echo $userInfo['user_selected']; ?>"></p>
	</div>   
	      
</div>
<!-- eof 随机验证入口  -->

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
		$('#lottery ul li').removeClass('active').eq(0).html("<img src=\"<?php echo URL_APP;?>/images/ico.png\">");
		if (click) {
			return false;
		}else{
			lottery.speed=20;
			roll();
			click=true;
			lottery.stop();

			$.post("<?php echo URL_APP_C;?>/Choice/byRandDo",{r:Math.random()},function(data){
				if(data.error)
				{
					//window.location.href="/Index/index";
					//return true;
				    alert(data.msg);
					return false;
				}
				$("#randnotice").attr({'data-attr':data.count});
				if(data.count == 1 )
				{
					$('.cancelBtn').html("<img src=\"<?php echo URL_APP;?>/images/qxcx.jpg\" />");
				    $('.sureBtn').html("<a href=\"<?php echo URL_APP_C;?>/Choice/byRandSubmit\"><img src=\"<?php echo URL_APP;?>/images/qdxh.jpg\" /></a>");
				    //显示号码
				    // $('#lottery ul li.active').html(data.msg);
				    var code = "";
				    if(data.msg.location_code && data.msg.location_code.length == 1)
				    {
				    	code = '0'+data.msg.location_code;
				    }else
				    {
				    	code = data.msg.location_code;
				    }
				    $('#lottery ul li').removeClass('active').eq(0).addClass('active').html(data.msg.location_area+data.msg.location_prefix+code);
					return false;
				}else if(data.count == 2)
				{
					$('.cancelBtn').html("<img src=\"<?php echo URL_APP;?>/images/qxcx.jpg\" />");
				    $('.sureBtn').html("<a href=\"<?php echo URL_APP_C;?>/Choice/byRandSubmit\"><img src=\"<?php echo URL_APP;?>/images/qdxh.jpg\" /></a>");
				    //显示号码
				    // $('#lottery ul li.active').html(data.msg);
				    if(data.msg != "先验证")
				    {
					    var code = "";
					    if(data.msg.location_code.length && data.msg.location_code.length == 1)
					    {
					    	code = '0'+data.msg.location_code;
					    }else
					    {
					    	code = data.msg.location_code;
					    }
				    	$('#lottery ul li').removeClass('active').eq(0).addClass('active').html(data.msg.location_area+data.msg.location_prefix+code);
				    }else
				    {
					    var code = "";
					    if(data.infos.location_code && data.infos.location_code.length == 1)
					    {
					    	code = '0'+data.infos.location_code;
					    }else
					    {
					    	code = data.infos.location_code;
					    }	
					    // alert("请先验证");	
					    $('.cancelBtn').trigger("click");
					    $('#lottery ul li').removeClass('active').eq(0).addClass('active').html(data.infos.location_area+data.infos.location_prefix+code);			    
				    	// $('#lottery ul li').removeClass('active').eq(0).addClass('active').html(data.msg);
				    }				
					if(parseInt(data.randThird) == 0)
					{
						alert(data.msg);
					}
				    return false;	
				}else
				{   
					$('#lottery ul li').removeClass('active').eq(0).addClass('active').html("选号中...");
					// $('#lottery ul li').removeClass('active').eq(0).addClass('active').html(data.msg);
					window.location.href="<?php echo URL_APP_C;?>/Choice/byRandSubmit";
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
        var dd = $("#randnotice").attr('data-attr');
        dd = parseInt(dd);
        // 验证
        if(dd==2)
        {
       		var  windowHeight=$(window).height(); 
        	var  windowWidth=$(window).width(); 
        	var tops = (windowHeight - 145)/2;
        	var widths = (windowWidth - 280)/2;
        	$("#myDiv").addClass('myDiv');
        	$("#randContent").css({top:tops,left:widths});
        	$("#randContent").show();		 
     

        	$("input[name='randcontent']").focus(function(){
        		$("#randnotice").html("");
        	});

        	$("#randCancel").click(function(){
        		$("#randContent").hide();	
        		$("#randnotice").html("");
        		$("#myDiv").removeClass('myDiv');
        	});

        	$("#randSubmit").click(function(){
        		var pass = $("input[name='randcontent']").val();
        		if(pass == '')
        		{
        			$("#randnotice").html("请输入密码");
        			return false;
        		}
        		 var url = "<?php echo URL_APP_C;?>/Choice/randCheckPass";
        		var param = {pass:pass};
        		$.post(url,param,function(data){
        			if(data.error)
        			{
        				$("#randnotice").html(data.msg);
        			}else
        			{
                		$("#randContent").hide();	
                		$("#randnotice").html("");
                		$("#myDiv").removeClass('myDiv');
                		//取消按钮
                        $('#lottery ul li').removeClass('active').html("<img src=\"<?php echo URL_APP;?>/images/ico.png\" />");
                        $('#cancelBtn_1').html("<img src=\"<?php echo URL_APP;?>/images/qxcx_1.png\" />");
                        $('.sureBtn').html("<a href=\"javascript:void(0);\"><img src=\"<?php echo URL_APP;?>/images/qdxh_1.png\" /></a>");
        			}
        		},'json');
        	});
        	return false;
        }
        $('#lottery ul li').removeClass('active').html("<img src=\"<?php echo URL_APP;?>/images/ico.png\" />");
        $(this).html("<img src=\"<?php echo URL_APP;?>/images/qxcx_1.png\" />");
        $('.sureBtn').html("<a href=\"javascript:void(0);\"><img src=\"<?php echo URL_APP;?>/images/qdxh_1.png\" /></a>");
    });
	
});

// 高端密码
$(document).ready(function(){
	$('.refuseDevilery').click(function(){
		var  windowHeight=$(window).height(); 
		var  windowWidth=$(window).width(); 
		var tops = (windowHeight - 145)/2;
		var widths = (windowWidth - 280)/2;
		$("#myDiv").addClass('myDiv');
		$("#refuseContent").css({top:tops,left:widths});
		$("#refuseContent").show();		 
	});

	$("input[name='content']").focus(function(){
		$("#notice").html("");
	});

	$("#refuseCancel").click(function(){
		$("#refuseContent").hide();	
		$("#notice").html("");
		$("#myDiv").removeClass('myDiv');
	});

	$("#refuseSubmit").click(function(){
		var pass = $("input[name='content']").val();
		if(pass == '')
		{
			$("#notice").html("请输入密码");
			return false;
		}
		var url = "<?php echo URL_APP_C;?>/Choice/highCheckPass";
		var param = {pass:pass};
		$.post(url,param,function(data){
			if(data.error)
			{
				$("#notice").html(data.msg);
			}else
			{
				window.location.href="<?php echo URL_APP_C;?>/Choice/byHigh";
				$("#myDiv").removeClass('myDiv');
			}
		},'json');
	});
});

// 捐赠额归档
$(document).ready(function(){
	// 如果没有设置 0－没有,1-设置过
	var room_id = "<?php echo $room_id; ?>";
	$("#priceNotice").html("");
	if(room_id == 0 || !room_id)
	{
		var  windowHeight=$(window).height(); 
		var  windowWidth=$(window).width(); 
		var tops = (windowHeight - 100)/2;
		var widths = (windowWidth - 300)/2;
		$("#myDiv").addClass('myDiv');
		$("#priceContent").css({top:tops,left:widths});
		$("#priceContent").show();
		$("input[name='submitPrice']").click(function(data){
			$("#priceNotice").html("");
			var url = "<?php echo URL_APP_C;?>/Choice/selectRoom";
			var price = $("select[name='price']").val();
			var param = {price:price,type:0};
			$.post(url,param,function(data){
				if(data.error)
				{
					$("#priceNotice").html(data.msg);
				}else
				{
					window.location.href="<?php echo URL_APP_C;?>/Choice/byRand";
				}	
			},'json');
			
			
		});			
	}

	// 可以重新选择捐赠额
	$("select[name='selectPriceBox']").change(function(){
		var selectPrice = $(this).val();
		var url = "<?php echo URL_APP_C;?>/Choice/selectRoom";
		var param = {price:selectPrice,type:0};
	
		$.post(url,param,function(data){
			if(!data.error)
			{
				window.location.href="<?php echo URL_APP_C;?>/Choice/byRand";
			}else
			{
				alert(data.msg+",请重新切换或联系管理员!");
				window.location.href="<?php echo URL_APP_C;?>/Choice/byRand";
			}	
		},'json');		
	});
	
});	

</script>
</body>
</html>