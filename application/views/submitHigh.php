<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>选择号详情</title>
<meta name="keywords" content="seo keyword" />
<meta name="description" content="description" />
<link type="text/css" rel="stylesheet" href="<?php echo URL_APP;?>/css/style.css">
<script src="<?php echo URL_APP;?>/js/jquery-1.8.3.min.js" type="text/javascript"></script>
</head>
<body class="bodyMyNo">
<!-- bof container-->
<div class="container">
	<!-- bof 11 -->
	<div class="sjTop">
	<ul>
	<li><a href="<?php echo URL_APP_C;?>/Choice/byRand"><img src="<?php echo URL_APP;?>/images/sjBtn.png" /></a></li>
	<li><a href="<?php echo URL_APP_C;?>/Choice/byEight"><img src="<?php echo URL_APP;?>/images/bzBtn.png" /></a></li>
	<li><a href="<?php echo URL_APP_C;?>/Choice/byHigh"><img src="<?php echo URL_APP;?>/images/gdBtn.png" /></a></li>
	<li><a href="javascript:void(0);"><img src="<?php echo URL_APP;?>/images/myNoBtn.png" /></a></li>
	</ul>
	<br class="clearBoth" />
	</div>
	<!-- eof 11 -->

	<!-- bof 22 -->
	<div class="details">
		<table>
			<tr>
				<td width="124"><img src="<?php echo URL_APP;?>/images/detailNo.png" /></td>
				<td width="170"><font class="myNo">
				<?php 
				if($result['posInfos']['location_alias'])
				{
					echo $result['posInfos']['location_alias']. "&nbsp;";
				}
				echo $result['posInfos']['location_area'] ? $result['posInfos']['location_area'] : '';
				echo $result['posInfos']['location_prefix'] ? $result['posInfos']['location_prefix'] : '';
				if($result['posInfos']['location_code'])
				{
					if(strlen($result['posInfos']['location_code']) == 1)
					{
						echo '0'.$result['posInfos']['location_code'];
					}else {
						echo $result['posInfos']['location_code'];
					}
				}
				echo '('.$result['posInfos']['localtion_id'].')';?>
				</font></td>
			</tr>

			<tr>
				<td  width="124"><img src="<?php echo URL_APP;?>/images/detailArea.png" /></td>
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
				<td width="124"><img src="<?php echo URL_APP;?>/images/detailInfo.png" /></td>
				<td width="170"><span>
				<?php echo $result['posInfos']['location_details'];?>
				</span></td>
			</tr>
		</table>
	</div>
	<!-- eof 22 -->
	<p class="sureBtnNo">
	<a href="<?php echo URL_APP_C;?>/Choice/byHighSubmit?locationId=<?php echo $result['posInfos']['localtion_id'];?>"><img src="<?php echo URL_APP;?>/images/qrhm.png" />
	</a>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="javascript:history.go(-1);"><img src="<?php echo URL_APP;?>/images/back.png" />
	</a>	
	</p>
</div>
<!-- eof container -->
</body>
</html>