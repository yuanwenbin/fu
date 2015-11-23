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
</head>
<body class="roomOpen">
<h3>增加管理员</h3>
<form method="post" action="/User/userAddDeal">
<table width="100%" border="0" cellpadding="5" cellspacing="0">
<tr>
	<td width="15%" align="right">登陆名：</td>
	<td>
	<input type="text" name="admin_user" value="" class="article_title" />
	</td>
</tr>

<tr>
	<td width="15%" align="right">登陆密码：</td>
	<td>
    <input type="password" name="admin_password" value="" class="article_title" />
	</td>
</tr>

<tr>
	<td width="15%" align="right">重复输入登陆密码：</td>
	<td>
    <input type="password" name="admin_password_new" value="" class="article_title" />
	</td>
</tr>

<tr>
	<td width="15%" align="right">激活状态：</td>
	<td>
	<select name="admin_status">
	<option value="1" selected>是</option>
	<option value="0">否</option>
	</select>
	</td>
</tr>

<tr>
	<td width="15%" align="right">联系邮箱：</td>
	<td>
	<input type="email" name="admin_email" value="" class="article_title" />
	</td>
</tr>
</table>


<table  style="margin-top:30px;" width="88%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="15%" align="right">权限列表：</td>
		<td>
		<p><input type="checkbox" name="role[]" value="all" />超级权限(注意)</p>
		</td>
	</tr>

	<tr>
		<td width="15%" align="right">
		文章管理&nbsp;</td>
		<td>
		<p><input type="checkbox" name="role[]" value="article|addArticle" />发表文章</p>
		<p><input type="checkbox" name="role[]" value="article|listArticleDel" />删除文章</p>
		<p><input type="checkbox" name="role[]" value="article|listArticle" />查看文章</p>
		<p><input type="checkbox" name="role[]" value="article|listArticleUpdate" />编辑文章</p>
		<p><input type="checkbox" name="role[]" value="article|addCate" />增加文章分类</p>
		<p><input type="checkbox" name="role[]" value="article|listCate" />文章分类</p>
		</td>
	</tr>
	 
	<tr>
		<td width="15%" align="right">
		顾客列表&nbsp;</td>
		<td>
		<p><input type="checkbox" name="role[]" value="member|member" />顾客查看列表</p>
		</td>
	</tr>
	<tr>
		<td width="15%" align="right">
		订单权限&nbsp;
		</td>
		<td>
		<p><input type="checkbox" name="role[]" value="order|orderList" />查看订单列表</p>
		<p><input type="checkbox" name="role[]" value="order|posInfosDeal" />订单修改</p>
		</td>
	</tr>

	<tr>
		<td width="15%" align="right">
		房间牌位权限&nbsp;</td>
		<td>
		<p><input type="checkbox" name="role[]" value="room|roomOpen" />房间牌位开设</p>
		<p><input type="checkbox" name="role[]" value="room|roomList" />房间查看</p>
		<p><input type="checkbox" name="role[]" value="room|updateRoom" />房间编辑</p>
		<p><input type="checkbox" name="role[]" value="room|delRoom" />房间删除</p>
		<p><input type="checkbox" name="role[]" value="room|roomInfos" />牌位查看</p>
		<p><input type="checkbox" name="role[]" value="room|postionList" />牌位列表</p>
		<p><input type="checkbox" name="role[]" value="room|posLocation" />牌位编辑</p>
		<p><input type="checkbox" name="role[]" value="room|delPos" />牌位删除</p>
		<p><input type="checkbox" name="role[]" value="room|mutilDeal" />批量修改</p>
		</td>
	</tr>

	<tr>
		<td width="15%" align="right">
		统计权限&nbsp;</td>
		<td>
		<p><input type="checkbox" name="role[]" value="tongji|tongjiList" />查看统计</p>
		<p><input type="checkbox" name="role[]" value="tongji|clearList" />清空无效订单</p>
		</td>
	</tr>

	<tr>
		<td width="15%" align="right">
		友情链接权限&nbsp;</td>
		<td>
		<p><input type="checkbox" name="role[]" value="link|linkList" />友情链接</p>
		</td>
	</tr>

	<tr>
		<td width="15%" align="right">
		道教文化权限&nbsp;</td>
		<td>
		<p><input type="checkbox" name="role[]" value="curlture|curlture" />友情链接</p>
		</td>
	</tr>
	<tr>
		<td width="15%" align="right">
		版权信息权限&nbsp;</td>
		<td>
		<p><input type="checkbox" name="role[]" value="copyright|copyright" />版权信息权限</p>
		</td>
	</tr>
</table>


<table  width="100%" border="0" cellpadding="5" cellspacing="0">
<tr>
<td width="15%" align="right">&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
	<td width="15%" align="right">&nbsp;</td>
	<td>&nbsp;&nbsp;<a href="/" target="_top">放弃返回</a>&nbsp;&nbsp;<input type="submit" name="submit" value="增加" /></td>
</tr>
</table>

</form>
<script type="text/javascript">

$(document).ready(function(){
	$("input[name='submit']").click(function(){
		var admin_user = $("input[name='admin_user']").val();
		var admin_password = $("input[name='admin_password']").val();
		var admin_password_new = $("input[name='admin_password_new']").val(); 
		if(admin_user == '')
		{
			alert("请输入用户名！");
			return false;
		}
		if(admin_password == '')
		{
			alert("请输入密码！");
			return false;
		}
		if(admin_password != admin_password_new)
		{
			alert("丙次密码不一样！");
			return false;
		}
		var roles = $("input[type='checkbox']");
		var flag = 0;
		for(var i=0; i<roles.length; i++)
		{
			if(roles[i].checked)
			{
				flag = 1;
			}
		}
		if(!flag)
		{
			alert("你没有添加任何权限");
			return false;
		}
		return true;
	});
	
});

</script>
</body>
</html>
