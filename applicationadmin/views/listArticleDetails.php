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
</head>
<body class="roomList">
<div class="roomInfosDiv container">
<h2 class="headerLineBackground"><?php echo $result->article_title;?></h2>
<table border="0" cellpadding="5" cellspacing="5">	
	<tr>
		<td width="20%" align="right">开启状态：</td>
		<td>
		<?php 
		if($result->article_flag)
		{
		    echo '开启';
		}else {
		    echo '关闭';
		}
		?>
		</td>		
	</tr>
	
	<tr>
		<td width="20%" align="right">发表时间：</td>
		<td>
		<?php echo date('Y-m-d H:i:s', $result->article_datetime);?>
		</td>		
	</tr>
	
	<tr>
		<td width="20%" align="right">seo标题：</td>
		<td>
		<?php echo $result->article_headline;?>
		</td>		
	</tr>
	
	<tr>
		<td width="20%" align="right">seo关键词：</td>
		<td>
		<?php echo  $result->article_keywords;?>
		</td>		
	</tr>	
	
	<tr>
		<td width="20%" align="right">seo描述：</td>
		<td>
		<?php echo $result->article_description;?>
		</td>		
	</tr>	
	
	<tr>
		<td width="20%" align="right">文章点击数：</td>
		<td>
		<?php echo $result->article_click;?>
		</td>		
	</tr>	
	
	<tr>
		<td width="20%" align="right">文章内容：</td>
		<td>
		<?php echo $result->article_content;?>
		</td>		
	</tr>	
		<tr>
		<td width="20%" align="right">&nbsp;</td>
		<td>
		<a href="/Article/listArticleUpdate?id=<?php echo $result->article_id;?>">编辑</a>&nbsp;&nbsp;<a href="javascript:history.go(-1);">点击返回</a>
		</td>		
	</tr>			
</table>
</div>

</body>
</html>
