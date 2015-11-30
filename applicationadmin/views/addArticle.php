<?php
if(!$cate_name)
{
	echo "请先增加分类,<a href='/Article/addCate'>点击增加分类";
	exit;
}
?>
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
	<script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
	
		<style>
			form {
				margin: 0;
			}
			textarea {
				display: block;
			}
		</style>
		<link rel="stylesheet" href="/editor/themes/default/default.css" />
		<script charset="utf-8" src="/editor/kindeditor-min.js"></script>
		<script charset="utf-8" src="/editor/lang/zh_CN.js"></script>
		<script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="content"]', {
					allowFileManager : true
				});
				K('input[name=getHtml]').click(function(e) {
					alert(editor.html());
				});
				K('input[name=isEmpty]').click(function(e) {
					alert(editor.isEmpty());
				});
				K('input[name=getText]').click(function(e) {
					alert(editor.text());
				});
				K('input[name=selectedHtml]').click(function(e) {
					alert(editor.selectedHtml());
				});
				K('input[name=setHtml]').click(function(e) {
					editor.html('<h3>Hello KindEditor</h3>');
				});
				K('input[name=setText]').click(function(e) {
					editor.text('<h3>Hello KindEditor</h3>');
				});
				K('input[name=insertHtml]').click(function(e) {
					editor.insertHtml('<strong>插入HTML</strong>');
				});
				K('input[name=appendHtml]').click(function(e) {
					editor.appendHtml('<strong>添加HTML</strong>');
				});
				K('input[name=clear]').click(function(e) {
					editor.html('');
				});
			});
		</script>	
	
</head>
<body class="roomOpen">
<div class="container">
<h3>增加文章</h3>
<form method="post" action="/Article/addArticleDeal">
<table width="100%" border="0" cellpadding="5" cellspacing="0">
<tr>
	<td width="15%" align="right">文章标题：</td>
	<td>
	<input type="text" name="article_title" value="" class="article_title" />
	</td>
</tr>

<tr>
	<td width="15%" align="right">文章分类：</td>
	<td>
	<select name="article_cate">
	<?php
	foreach($cate_name as $k=>$v){
	?>
	<option value="<?php echo $v['cate_id'];?>">
	<?php
	if($v['cate_parent'])
	{
		echo "&nbsp;&nbsp;&nbsp;";
	}
	echo $v['cate_name']; ?></option>
	<?php } ?>
	</select>
	</td>	
</tr>

<tr>
	<td width="15%" align="right">文章是否展示：</td>
	<td>
	<select name="article_flag">
	<option value="1" selected>展示</option>
	<option value="0">不展示</option>
	</select>
	
	</td>
</tr>

<tr>
	<td width="15%" align="right">文章优化标题：</td>
	<td>
	<input type="text" name="article_headline" value="" class="article_title" />
	</td>
</tr>

<tr>
	<td width="15%" align="right">文章优化关键词：</td>
	<td>
	<input type="text" name="article_keywords" value="" class="article_title" />
	</td>
</tr>

<tr>
	<td width="15%" align="right">文章优化描述：</td>
	<td>
	<input type="text" name="article_description" value="" class="article_title" />
	</td>
</tr>

<tr>
	<td width="15%" align="right">文章内容：</td>
	<td>
	<textarea name="content" style="width:800px;height:400px;visibility:hidden;"></textarea>
	</td>
</tr>
<tr>
<td width="15%" align="right">&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
	<td width="15%" align="right">&nbsp;</td>
	<td>&nbsp;&nbsp;<a href="/" target="_top">放弃返回</a>&nbsp;&nbsp;<input type="submit" name="submit" value="提交" /></td>
</tr>
</table>

</form>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$("input[name='submit']").click(function(){
		var article_title = $("input[name='article_title']").val();
		var content = $("textarea[name='content']").val();
		if(article_title == '')
		{
			alert("请输入标题！");
			return false;
		}
		return true;
	});
	
});
</script>

</body>
</html>
