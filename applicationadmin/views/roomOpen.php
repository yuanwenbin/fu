<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>系统登陆后台</title>
	<link href="/css/style.css" rel="stylesheet" type="text/css" />
	<style>
	.location_area_div{margin-top:10px;margin-bottom:10px;}

	</style>
	<script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
</head>
<body class="roomOpen">
<div class="container">
<h3>开设房间、牌位中心</h3>
<form method="post" action="/Room/RoomOpenAdd">
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td width="20%" align="right"><label>新开设的房间号：</label></td>
		<td><?php echo $roomId; ?></td>
	</tr>
	<tr>
		<td width="20%" align="right"><label>牌位数：</label></td>
		<td><input type="number" name="number" value="" />&nbsp;(可为任意数字)</td>
	</tr>

</table>
	<!-- bof box -->
	<div class="location_area_div">
		<table width="100%" border="0" cellpadding="5" cellspacing="0">
		<tr>
			<td width="20%" align="right"><label>区位信息：</label></td>
			<td>
			区位名称：<input type="text" name="location_area[]" value="" />&nbsp;(如:A区)<br />
			牌位前缀：<input type="text" name="location_prefix[]" value="" />&nbsp;(如:1-)<br />
			起始号码：<input type="text" name="location_code[]" value="" />&nbsp;(即牌位开始号码)<br />
			牌位数量：<input type="text" name="location_numbers[]" value="" />&nbsp;<br />
			定位价位：<input type="text" name="price[]" value="" />&nbsp;&nbsp;
			<a id="location_area" href="javascript:void(0)">增加区位</a></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		</table>
	</div>
	<!-- eof box -->
	<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td width="20%" align="right"><label>是否开放：</label></td>
		<td>
		<select name="openFlag">
			<option value="1" selected>开放</option>
			<option value="0">关闭</option>
		</select>
		</td>
	</tr>

	<tr>
		<td width="20%" align="right"><label>房间别名：</label></td>
		<td><input type="text" name="alias" value="" /></td>
	</tr>

	<tr>
		<td width="20%" align="right"><label>房间描述：</label></td>
		<td><textarea rows="5" cols="60" name="description"></textarea></td>
	</tr>
	<tr>
		<td width="20%" align="right">&nbsp;</td>
		<td>
		&nbsp;
		</td>
	</tr>
	<tr>
		<td width="20%" align="right">&nbsp;</td>
		<td>
		<input type="reset" name="reset" value="重置" />&nbsp;
		<input type="submit" name="submit" value="提交" />
		</td>
	</tr>
</table>
</form>
</div>

<script type="text/javascript">
$(document).ready(function(){
	/*
	$("input[name='submit']").click(function(){
		var num = $("input[name='number']").val();
		if(num == '' || isNaN(num))
		{
			alert("请输入你要的牌位数目!");
			return false;
		}
		
	});*/
	$("#location_area").click(function(){
		var html = "<table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">";
		html += "<tr><td width=\"20%\" align=\"right\"><label>区位信息：</label></td>";
		html +=	"<td>区位名称：<input type=\"text\" name=\"location_area[]\" value=\"\" />&nbsp;<br />";
		html += "牌位前缀：<input type=\"text\" name=\"location_prefix[]\" value=\"\" />&nbsp;<br />";
		html +=	"起始号码：<input type=\"text\" name=\"location_code[]\" value=\"\" />&nbsp;(即牌位开始号码)<br />";
		html += "牌位数量：<input type=\"text\" name=\"location_numbers[]\" value=\"\" />&nbsp;<br />";
		html += "定位价格：<input type=\"text\" name=\"price[]\" value=\"\" />&nbsp;&nbsp;"; 
		html += "<a class=\"location_area_del\" href=\"javascript:void(0)\">删除区位</a></td>";
		html += "</tr><tr><td colspan=\"2\">&nbsp;</td></tr></table>";
		$('.location_area_div').append(html);
	});

	$('body').delegate('.location_area_del','click',function(){
		var len = $('.location_area_div').find('table').length;
		var lenIndex = len-1;
		if(lenIndex == 0)
		{
			return false;
		}
		$('.location_area_div').find('table').eq(lenIndex).remove();
	});


});
</script>
</body>
</html>
