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
		<ul>
			<li><img src="/images/ico.png" /></li>
			<li><img src="/images/ico.png" /></li>
			<li><img src="/images/ico.png" /></li>
			<li><img src="/images/ico.png" /></li>
		</ul>
		<br class="clearBoth" />
	</div>
	<!-- eof 22 -->

	<!-- bof 33 -->
	<div class="sjChoiceBtn">
	<a href="javascript:void(0);" class="startRand"><img src="/images/ksxh.jpg" /></a>
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
$(document).ready(function(){
    $(".startRand").click(function(){
        $.post('/Choice/byRandDo',{},function(data){
			/*
            if(data.error == 1)
            {
                alert("出错了，请联系");
            }else
            {
                alert(data.msg);
				window.document.location.href="/Choice/byRandSubmit";
            }
			*/
			if(data.count == 1)
			{
				alert("您选择的号码是："+data.msg+",还有一次随机选择的机会，确认此号码");
				return false;
			}else
			{
				window.document.location.href="/Choice/byRandSubmit";
			}
			
        }, 'json');
    });
	
});
</script>
</body>
</html>