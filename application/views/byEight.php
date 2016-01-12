<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>生辰八字</title>
<meta name="keywords" content="seo keyword" />
<meta name="description" content="description" />
<link type="text/css" rel="stylesheet" href="/css/style.css">
<link href='/css/fullcalendar.css' rel='stylesheet' />
<style type="text/css">
.dib{display:inline-block;}
.date-zone {position: relative;width:200px;border: 1px solid #ccc;}
.calendarWrapper {position: absolute;top: 40px;left: 0;z-index:9999;background:#fff;}
.date-inp {border: 0 none;vertical-align: top;line-height: 25px;text-indent: 5px;}
.icon_date {cursor: pointer; margin-left: 220px;margin-top: -31px;position: absolute;}
.fc-button-today {display: none;}

#refuseContent{position:fixed;z-index:9999;display:none;height:145px;width:280px;border:1px solid #444;background:#fff;overflow-y:auto;}
.refuseContent{margin:15px;margin-top:35px;}
.refuseContent input{border:1px solid #444;padding:3px;}
#notice{text-align:center;color:#ff0000;line-height:28px;}
.myDiv{width:100%;height:100%;position:fixed;background:#000; background-color:rgba(0,,0,0.5);
filter:Alpha(opacity=50);-moz-opacity:0.5; 
opacity:0.5;z-index:9999;margin-top:-187px;}
</style>
<!--  <script type="text/javascript" src="/js/laydate.js"></script> -->

<script src="/js/jquery-1.8.3.min.js" type="text/javascript"></script>

<script src='/js/jquery-ui.custom.min.js'></script>
<script src='/js/fullcalendar.js'></script>
<script type="text/javascript">
/** 当天信息初始化 **/
$(function() {
    var dayDate = new Date();
    var d = $.fullCalendar.formatDate(dayDate, "dddd");
    var m = $.fullCalendar.formatDate(dayDate, "yyyy年MM月dd日");
    var lunarDate = lunar(dayDate);
});
/** calendar配置 **/
$(document).ready(
    function() {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth()+1;
        var y = date.getFullYear();
        $(".date-inp").val(y+"-"+m+"-"+d);
        $("#calendar").fullCalendar();
    });
/** 绑定事件到日期下拉框 **/
$(function() {
    $("#fc-dateSelect").delegate("select", "change", function() {
        var fcsYear = $("#fcs_date_year").val();
        var fcsMonth = $("#fcs_date_month").val();
        $("#calendar").fullCalendar('gotoDate', fcsYear, fcsMonth);
    });
});
</script>
</head>
<body class="bodyBz">
<div id="myDiv"></div>
<!-- bof container-->
<div class="container">
	<!-- bof 11 -->
	<div class="sjTop">
	<ul>
	<li><a href="/Choice/byRand"><img src="/images/sjBtn.png" /></a></li>
	<li><a href="javascript:void(0);"><img src="/images/bzBtnImg.png" /></a></li>
	<?php if($highFlag) {?>
	<li><a href="/Choice/byHigh"><img src="/images/gdBtn.png" /></a></li>
	<?php }else{?>
	<li><a href="javascript:void(0);"  class="refuseDevilery"><img src="/images/gdBtn.png" /></a></li>
	<?php } ?>
	<li><a href="javascript:void(0);" id="noChoice"><img src="/images/myNoBtn.png" /></a></li>
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

	<div class="bzFrom">
	<form id="bzForm">
	<table>
		<tr style="height:60px;">
			<td width="120"><img src="/images/name.png" /></td>
			<td><input type="text" name="username" value="" /></td>
		</tr>

		<tr style="height:60px;">
			<td width="120"><img src="/images/birthday.png" /></td>
				<td>
				<div class="demo1"><!-- 
		<input class="laydate-icon" id="demo" name="userbirth" value=""> -->
		
	<div class="date-zone">
		
		<input type="text" class="date-inp" name="datetimes">
		<span class="icon_date"><img src="/images/icon_date.png"></span>
		<div class="calendarWrapper">
		    <div id="calendar" class="dib"></div>
		</div>
	
	
	</div>		
		
		</td>
	</div>
		</tr>

		<tr style="height:60px;">
			<td width="120"><img src="/images/time.png" /></td>
			<td>
			<select name="stime" class="stime">
			<option value="子时(23:00-00:59)">子时(23:00-00:59)</option>
			<option value="丑时(01:00-02:59)">丑时(01:00-02:59)</option>
			<option value="寅时(03:00-04:59)">寅时(03:00-04:59)</option>
			<option value="卯时(05:00-06:59)">卯时(05:00-06:59)</option>
			<option value="辰时(07:00-08:59)">辰时(07:00-08:59)</option>
			<option value="巳时(09:00-10:59)">巳时(09:00-10:59)</option>
			<option value="午时(11:00-12:59)">午时(11:00-12:59)</option>
			<option value="未时(13:00-14:59)">未时(13:00-14:59)</option>
			<option value="申时(15:00-16:59)">申时(15:00-16:59)</option>
			<option value="酉时(17:00-18:59)">酉时(17:00-18:59)</option>
			<option value="戌时(19:00-20:59)">戌时(19:00-20:59)</option>
			<option value="亥时(21:00-22:59)">亥时(21:00-22:59)</option>
			</select>
			</td>
		</tr>

		<tr style="height:108px;">
			<td>&nbsp;</td>
			<td><a href="javascript:void(0);" id="eightBtn"><img src="/images/ksxh.jpg" /></a></td>
		</tr>
	</table>
	</form>
	</div>


</div>
<!-- eof container -->
<div id="refuseContent">
	
	<div class="refuseContent">
	<form action="" method="post">
	<table border="0" cellpadding="0" cellspacing="0" width="98%">
		<tr>
			<td width="30%" align="center">高端密码&nbsp;</td>
			<td width="62%"><input type="text" name="content" value=""></td>
		</tr>
		<tr>
			<td width="30%" align="center">&nbsp;&nbsp;</td>
			<td width="62%">&nbsp;</td>
		</tr>
		<tr>
			<td width="30%" align="center">&nbsp;</td>
			<td width="62%">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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

<script type="text/javascript">
$(document).ready(function(){
    // 选号提示 
    $('#noChoice').click(function(){
        alert("您暂未有选号噢，请选号！");
 	   return false;
    });
	$("#eightBtn").click(function(){
	var username = $("input[name='username']").val();
	var userbirth = $("input[name='datetimes']").val();
	var stime = $("select[name='stime']").val();
	if(username == '' || userbirth == '' || stime == '')
	{
		alert("请输入正确的姓名，生日，时辰，再选号");
		return false;
	}
	$.post('/Choice/byEightDeal', {username:username,userbirth:userbirth,stime:stime}, function(data){
		if(!data.error)
		{
			 window.document.location.href="/Choice/index";
		}else
		{
			 alert(data.msg);
			 return false; 
		}
	});	
});

});
//可以重新选择价格
$(document).ready(function(){
	$("select[name='selectPriceBox']").change(function(){
		var selectPrice = $(this).val();
		var url = "/Choice/selectRoom";
		var param = {price:selectPrice,type:0};
		$.post(url,param,function(data){
			if(!data.error)
			{
				window.location.href="/Choice/byEight";
			}else
			{
				alert(data.msg+",请重新切换或联系管理员!");
				window.location.href="/Choice/byEight";
			}	
		},'json');		
	});
});

// 新的双日历
$(function(){
	$(".calendarWrapper").hide();
	$(".icon_date").on('click', function(){
		$(".calendarWrapper").toggle();
	})

	$(".calendarWrapper").delegate('.fc-widget-content', 'click', function(event) {
		$(".date-inp").val($(this).data('date'));
		$(".calendarWrapper").hide();
	});
});


/*
!function(){
	laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
	laydate({elem: '#demo'});//绑定元素
}();

//日期范围限制
var start = {
    elem: '#start',
    format: 'YYYY-MM-DD',
    min: laydate.now(), //设定最小日期为当前日期
    max: '2099-06-16', //最大日期
    istime: true,
    istoday: false,
    choose: function(datas){
         end.min = datas; //开始日选好后，重置结束日的最小日期
         end.start = datas //将结束日的初始值设定为开始日
    }
};

var end = {
    elem: '#end',
    format: 'YYYY-MM-DD',
    min: laydate.now(),
    max: '2099-06-16',
    istime: true,
    istoday: false,
    choose: function(datas){
        start.max = datas; //结束日选好后，充值开始日的最大日期
    }
};
laydate(start);
laydate(end);

//自定义日期格式

laydate({
    elem: '#test1',
    format: 'YYYY年MM月DD日',
    festival: true, //显示节日
    choose: function(datas){ //选择日期完毕的回调
        alert('得到：'+datas);
    }
});

//日期范围限定在昨天到明天

laydate({
    elem: '#hello3',
    min: laydate.now(-1), //-1代表昨天，-2代表前天，以此类推
    max: laydate.now(+1) //+1代表明天，+2代表后天，以此类推
});
*/
//高端密码
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
		var url = "/Choice/highCheckPass";
		var param = {pass:pass};
		$.post(url,param,function(data){
			if(data.error)
			{
				$("#notice").html(data.msg);
			}else
			{
				window.location.href="/Choice/byHigh";
				$("#myDiv").removeClass('myDiv');
			}
		},'json');
	});
});

</script>
</body>
</html>