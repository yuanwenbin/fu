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
	<script type="text/javascript" src="<?php echo URL_APP;?>/js/jquery-1.8.3.min.js"></script>
</head>
<body class="roomOpen">
<div class="container">
<h3>增加管理员</h3>
<form method="post" action="<?php echo URL_APP_C;?>/User/userAddDeal">
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
		<p><input id="checkAll" type="checkbox" name="role[]" value="all" />超级权限(全选)</p>
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
		<p><input type="checkbox" name="role[]" value="order|orderList" />查看捐赠列表</p>
		<p><input type="checkbox" name="role[]" value="order|posInfosDeal" />订单修改</p>
		<p><input type="checkbox" name="role[]" value="order|delOrder" />订单删除</p>
		</td>
	</tr>

	<tr>
		<td width="15%" align="right">
		福位牌位权限&nbsp;</td>
		<td>
		<p><input type="checkbox" name="role[]" value="room|roomOpen" />福位牌位开设</p>
		<p><input type="checkbox" name="role[]" value="room|roomList" />福位查看</p>
		<p><input type="checkbox" name="role[]" value="room|updateRoom" />福位编辑</p>
		<p><input type="checkbox" name="role[]" value="room|delRoom" />福位删除</p>
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
		<p><input type="checkbox" name="role[]" value="tongji|exportOrder" />导出订单</p>
		<p><input type="checkbox" name="role[]" value="tongji|clearList" />清空无效订单</p>
		</td>
	</tr>

	<tr>
		<td width="15%" align="right">
		友情链接权限&nbsp;</td>
		<td>
		<p><input type="checkbox" name="role[]" value="links|linkList" />友情链接</p>
		</td>
	</tr>

	<tr>
		<td width="15%" align="right">
		道教文化权限&nbsp;</td>
		<td>
		<p><input type="checkbox" name="role[]" value="curlture|curlture" />道教文化</p>
		</td>
	</tr>
	<tr>
		<td width="15%" align="right">
		版权信息权限&nbsp;</td>
		<td>
		<p><input type="checkbox" name="role[]" value="copyright|copyright" />版权信息权限</p>
		</td>
	</tr>
	<tr>
		<td width="15%" align="right">
		关于我们&nbsp;</td>
		<td>
		<p><input type="checkbox" name="role[]" value="aboutus|aboutUsInfo" />关于我们</p>
		</td>
	</tr>	
	
	<tr>
		<td width="15%" align="right">
		密码权限&nbsp;
		</td>
		<td>
		<p><input type="checkbox" name="role[]" value="password|passwordCheckForRand" />查看随机密码</p>
		<p><input type="checkbox" name="role[]" value="password|passwordCheckForHigh" />查看高端密码</p>
		<p><input type="checkbox" name="role[]" value="password|passwordAddForRand" />设置随机密码</p>
		<p><input type="checkbox" name="role[]" value="password|passwordAddForHigh" />设置高端节密码</p>		
		</td>
	</tr>
	
	<tr>
		<td width="15%" align="right">
		捐赠额分类权限&nbsp;
		</td>
		<td>
		<p><input type="checkbox" name="role[]" value="price|priceList" />捐赠额查看</p>
		<p><input type="checkbox" name="role[]" value="price|priceAdd" />捐赠额增加</p>
		<p><input type="checkbox" name="role[]" value="price|priceDel" />捐赠额删除</p>
		<p><input type="checkbox" name="role[]" value="price|priceUpdate" />捐赠额修改</p>		
		</td>
	</tr>	
	
	<tr>
		<td width="15%" align="right">
		义工管理&nbsp;
		</td>
		<td>
		<p><input type="checkbox" name="role[]" value="memberteam|memberteamList" />分组查看</p>
		<p><input type="checkbox" name="role[]" value="memberteam|memberteamAdd" />分组增加</p>
		<p><input type="checkbox" name="role[]" value="memberteam|memberteamDel" />分组删除</p>
		<p><input type="checkbox" name="role[]" value="memberteam|memberteamUpdate" />分组编辑</p>	
		<p><input type="checkbox" name="role[]" value="memberteam|memberteamInfos" />分组详情</p>
		
		<p><input type="checkbox" name="role[]" value="memberteam|memberteamListUser" />义工列表</p>
		<p><input type="checkbox" name="role[]" value="memberteam|memberteamAddUser" />义工增加</p>
		<p><input type="checkbox" name="role[]" value="memberteam|memberteamDelUser" />义工删除</p>
		<p><input type="checkbox" name="role[]" value="memberteam|memberteamUpdateUser" />义工编辑</p>	
		<p><input type="checkbox" name="role[]" value="memberteam|memberteamSaleUser" />义工业绩查看</p>			
		</td>
	</tr>	
	
	<tr>
		<td width="15%" align="right">
		系统开启状态&nbsp;
		</td>
		<td>
		<p><input type="checkbox" name="role[]" value="webset|websetSystem" />广结善缘开启状态</p>
		<p><input type="checkbox" name="role[]" value="webset|websetCopy" />官网开启状态</p>	
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
	<td>&nbsp;&nbsp;<a href="<?php echo URL_APP_C;?>" target="_top">放弃返回</a>&nbsp;&nbsp;<input type="submit" name="submit" value="增加" /></td>
</tr>
</table>

</form>
</div>

<script type="text/javascript">

$(document).ready(function(){
	// 全选/反选择
	$("#checkAll").click(function(){
	    if($(this).attr("checked"))
	    {
	    	$("input[name='role[]']").attr("checked", true);  
	    }else
	    {
	    	$("input[name='role[]']").attr("checked", false);
	    }
	});
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
		var num = 0;
		for(var i=0; i<roles.length; i++)
		{
			if(roles[i].checked)
			{
				flag = 1;
				num++;
			}
		}
		if(!flag)
		{
			alert("你没有添加任何权限");
			return false;
		}
		if(num==roles.length)
		{
			$("#checkAll").attr("checked", true); 
		}else
		{
			$("#checkAll").attr("checked", false); 
		}
		return true;
	});
	
});

</script>
</body>
</html>
