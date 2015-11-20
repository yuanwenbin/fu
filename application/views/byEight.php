<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>生辰八字</title>
<meta name="keywords" content="seo keyword" />
<meta name="description" content="description" />
<link type="text/css" rel="stylesheet" href="/css/style.css">
<script type="text/javascript" src="/js/laydate.js"></script>
<script src="/js/jquery-1.8.3.min.js" type="text/javascript"></script>
</head>
<body class="bodyBz">
<!-- bof container-->
<div class="container">
	<!-- bof 11 -->
	<div class="sjTop">
	<ul>
	<li><a href="/Choice/byRand"><img src="/images/sjBtn.png" /></a></li>
	<li><a href="javascript:void(0);"><img src="/images/bzBtnImg.png" /></a></li>
	<li><a href="/Choice/byHigh"><img src="/images/gdBtn.png" /></a></li>
	<li><a href="javascript:void(0);" id="noChoice"><img src="/images/myNoBtn.png" /></a></li>
	</ul>
	<br class="clearBoth" />
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
				<td><div class="demo1">
		<input class="laydate-icon" id="demo" name="userbirth" value=""></td>
	</div>
		</tr>

		<tr style="height:60px;">
			<td width="120"><img src="/images/time.png" /></td>
			<td>
			<select name="stime" class="stime">
			<option value="1">子时(23:00-00:59)</option>
			<option value="2">丑时(01:00-02:59)</option>
			<option value="3">寅时(03:00-04:59)</option>
			<option value="4">卯时(05:00-06:59)</option>
			<option value="5">辰时(07:00-08:59)</option>
			<option value="6">巳时(09:00-10:59)</option>
			<option value="7">午时(11:00-12:59)</option>
			<option value="8">未时(13:00-14:59)</option>
			<option value="9">申时(15:00-16:59)</option>
			<option value="10">酉时(17:00-18:59)</option>
			<option value="11">戌时(19:00-20:59)</option>
			<option value="12">亥时(21:00-22:59)</option>
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
<script type="text/javascript">
$(document).ready(function(){
    // 选号提示 
    $('#noChoice').click(function(){
        alert("您暂未有选号噢，请选号！");
 	   return false;
    });
	$("#eightBtn").click(function(){
	var username = $("input[name='username']").val();
	var userbirth = $("input[name='userbirth']").val();
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
		}
	});
});

});



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

</script>
</body>
</html>