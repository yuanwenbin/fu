<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>选择号详情</title>
<meta name="keywords" content="seo keyword" />
<meta name="description" content="description" />
<link type="text/css" rel="stylesheet" href="/css/style.css">
<script src="/js/jquery-1.8.3.min.js" type="text/javascript"></script>
</head>
<body class="bodyMyNo">
<!-- bof container-->
<div class="container">
	<!-- bof 11 -->
	<div class="sjTop">
	<ul>
	<li><a href="/Choice/byRand"><img src="/images/sjBtn.png" /></a></li>
	<li><a href="/Choice/byEight"><img src="/images/bzBtn.png" /></a></li>
	<li><a href="/Choice/byHigh"><img src="/images/gdBtn.png" /></a></li>
	<li><a href="javascript:void(0);"><img src="/images/myNoBtn.png" /></a></li>
	</ul>
	<br class="clearBoth" />
	</div>
	<!-- eof 11 -->

	<!-- bof 22 -->
	<div class="details">
		<table>
			<tr>
				<td width="124"><img src="/images/detailNo.png" /></td>
				<td width="170"><font class="myNo">
				<?php 
				if($result['posInfos']['location_alias'])
				{
					echo $result['posInfos']['location_alias']. "&nbsp;";
				}
				echo $result['posInfos']['location_area'];
				echo $result['posInfos']['location_prefix'];
				echo $result['posInfos']['location_code'];
				echo '('.$result['posInfos']['localtion_id'].')';?>
				</font></td>
			</tr>

			<tr>
				<td  width="124"><img src="/images/detailArea.png" /></td>
				<td width="170"><span>
				<?php 
				if($result['roomInfos']['room_alias'])
				{
					echo '('.$result['roomInfos']['room_alias'].')'."&nbsp;";
				}
				echo $result['posInfos']['location_room_id'];?>
				</span></td>
			</tr>

			<tr>
				<td width="124"><img src="/images/detailInfo.png" /></td>
				<td width="170"><span>
				<?php echo $result['posInfos']['location_details'];?>
				</span></td>
			</tr>
		</table>
	</div>
	<!-- eof 22 -->
	<p class="sureBtnNo">
	<a href="/Choice/byHighSubmit?locationId=<?php echo $result['posInfos']['localtion_id'];?>"><img src="/images/qrhm.png" />
	</a>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="javascript:history.go(-1);"><img src="/images/back.png" />
	</a>	
	</p>
</div>
<!-- eof container -->
</body>
</html>