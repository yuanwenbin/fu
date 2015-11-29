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
<h3>文章列表</h3>
<table border="0" cellpadding="5" cellspacing="0" width="100%">	
	<tr class='headerLineBackground'>
		<th width="30%" align="center">操作</th>
		<th width="25%" align="center">文章标题</th>
		<th width="25%" align="center">文章优化标题</th>
		<th width="15%" align="center">文章开启状态</th>
	</tr>
	<?php foreach($result as $k=>$v) {?>
	<tr <?php echo ($k%2) ? "class='headerLineBackground'" : '';?>>
		<td widtd="30%" align="center">
		<?php if(hasPerssion($_SESSION['role'], 'listArticleUpdate')){ ?>
		<a href="/Article/listArticleUpdate?id=<?php echo $v['article_id']; ?>">编辑
		</a>
		&nbsp;|
		<?php } ?>&nbsp;
		<?php if(hasPerssion($_SESSION['role'], 'listArticle')){ ?>
		<a href="/Article/listArticleDetails?id=<?php echo $v['article_id'];?>">查看</a> 
		&nbsp;|
		<?php } ?>&nbsp;
		<?php if(hasPerssion($_SESSION['role'], 'listArticleDel')){ ?>
        <a href="/Article/listArticleDel?id=<?php echo $v['article_id'];?>" onclick="javascript:return sureDel();">删除</a> 
		<?php } ?>
		</td>
		<td widtd="25%" align="center"><?php echo mb_substr($v['article_title'], 0, 8, 'utf-8'); ?></td>
		<td widtd="25%" align="center"><?php echo $v['article_headline'] ? mb_substr($v['article_headline'],0,8,'utf-8') : ''; ?></td>
		<td widtd="15%" align="center">
		<?php 
		if($v['article_flag'])
		{
			echo '开启';
		}else {
		    echo '不开启';   
		}
		?>	
		</td>	
	</tr>
	<?php } ?>	
	<tr>
	<td colspan="10" align="center">
	总记录数：<?php echo $total; ?>&nbsp;&nbsp;页码：<?php echo $page;?>/<?php echo $totalPage;?>&nbsp;&nbsp;
	<?php if(isset($indexPage) && $indexPage) {?>
	<a href="/Article/listArticle?page=1">首页</a>&nbsp;<a href="/Article/listArticle?page=<?php echo $page-1;?>">上一页</a>&nbsp;
	<?php } ?>
	
	<?php if(isset($endPage) && $endPage) {?>
	<a href="/Article/listArticle?page=<?php echo $page+1;?>">下一页</a>&nbsp;<a href="/Article/listArticle?page=<?php echo $totalPage;?>">末页</a>&nbsp;
	<?php } ?>	
	</td>
	</tr>		
</table>
</div>
<div class="footer">
所有权归本站所有
</div>
<script type="text/javascript">
function sureDel()
{
	if(confirm("确定要删除吗？"))
	{
		return true;
	}
	return false;
}
</script>
</body>
</html>
