<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>系统登陆后台</title>
	<link href="<?php echo URL_APP;?>/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body class="roomList">
<div class="roomInfosDiv container">
<h3>文章列表</h3>
<table border="0" cellpadding="0" cellspacing="0" width="98%">	
	<tr class='headerLineBackground1'>
		<th width="30%" align="center">操作</th>
		<th width="25%" align="center">文章标题</th>
		<th width="25%" align="center">文章优化标题</th>
		<th width="15%" align="center">文章开启状态</th>
	</tr>
	<?php foreach($result as $k=>$v) {?>
	<tr <?php //echo ($k%2) ? "class='headerLineBackground1'" : '';?>>
		<td widtd="30%" align="center">
		<?php if(hasPerssion($_SESSION['role'], 'listArticleUpdate')){ ?>
		<a href="<?php echo URL_APP_C;?>/Article/listArticleUpdate?id=<?php echo $v['article_id']; ?>">编辑
		</a>
		&nbsp;|
		<?php } ?>&nbsp;
		<?php if(hasPerssion($_SESSION['role'], 'listArticle')){ ?>
		<a href="<?php echo URL_APP_C;?>/Article/listArticleDetails?id=<?php echo $v['article_id'];?>">查看</a> 
		&nbsp;|
		<?php } ?>&nbsp;
		<?php if(hasPerssion($_SESSION['role'], 'listArticleDel')){ ?>
        <a href="<?php echo URL_APP_C;?>/Article/listArticleDel?id=<?php echo $v['article_id'];?>" onclick="javascript:return sureDel();">删除</a> 
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
		<tr>
		<td colspan="4"><hr/></td>
	</tr>
	<?php } ?>	
		
</table>

<!--  bof 页码  -->
<p class="pages">
总记录数：<?php echo $total;?>&nbsp;&nbsp; 总页码：<?php echo $totalPage; ?>&nbsp;&nbsp; 页码列表：  
<?php 
if($page > 1) { 
	$fromPage = $page - 5;
	
	for($i = $fromPage; $i < $page;$i++) { 
		if($i < 1)
		{
			continue;
		}
?>
	<a href="<?php echo URL_APP_C;?>/Article/listArticle?page=<?php echo $i; ?>"><?php echo $i; ?></a>&nbsp;		
<?php } }
	$toPage = $page + 5;
	for($ii=$page; $ii<=$toPage;$ii++)
	{
		if($ii > $totalPage)
		{
			break;
		}
?>
<?php if($ii == $page) {?>
<font><?php echo $ii; ?></font>&nbsp;
<?php }else {?>
<a href="<?php echo URL_APP_C;?>/Article/listArticle?page=<?php echo $ii; ?>"><?php echo $ii; ?></a>&nbsp;
<?php } 
	 }
 ?>
</p>
<!--  eof 页码  -->
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
