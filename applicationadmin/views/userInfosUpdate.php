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
<body class="roomList">
<div class="roomInfosDiv container">
<h3 class="headerLineBackground">会员 <?php echo $user->admin_user;?> 信息</h3>
<form action="<?php echo URL_APP_C;?>/User/userInfosUpdateDeal" method="post">
<input type="hidden" name="admin_id" value="<?php echo $user->admin_id;?>" />
<table border="1" cellpadding="0" cellspacing="0" width="90%">	
	<tr>
		<td width="15%" align="right">登陆名：</td>
		<td>
		<input type="text" name="admin_user" value="<?php echo $user->admin_user;?>" />
		</td>		
	</tr>
	<tr>
		<td width="15%" align="right">密码：</td>
		<td>
		<input type="password" name="admin_password" value="" />(不修改则为空)
		</td>		
	</tr>
	
	<tr>
		<td width="15%" align="right">电子邮箱：</td>
		<td>
		<input type="email" name="admin_email" value="<?php echo $user->admin_email;?>" />
		</td>		
	</tr>
	
	
	<tr>
		<td width="15%" align="right">开启状态：</td>
		<td>
		<select name="admin_status">
		<?php if($user->admin_status) {?>
		<option value="1" selected>是</option>
		<option value="0">否</option>
		<?php } else {?>
		<option value="1">是</option>
		<option value="0" selected>否</option>		
		<?php }?>
		</select>
		</td>		
	</tr>	
</table>

<table style="margin-top:20px;" width="90%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="15%" align="right">以下是权限列表(不修改不理)：</td>
		<td>
		<p><input id="checkAll" type="checkbox" name="role[]" value="all" <?php if($perssion =='all'){ echo 'checked';} ?> />
		超级权限(全选)</p>
		</td>
	</tr>
	<?php
	$perssions = explode(',', $perssion);
	?>
	<tr>
		<td width="15%" align="right">
		文章管理&nbsp;</td>
		<td>
		<p><input type="checkbox" name="role[]" value="article|addArticle" <?php if($perssions[0] == 'all' || in_array('addArticle', $perssions)){ echo 'checked';}?> />发表文章</p>
		<p><input type="checkbox" name="role[]" value="article|listArticleDel"  <?php if($perssions[0] == 'all' || in_array('listArticleDel', $perssions)){ echo 'checked';}?> />删除文章</p>
		<p><input type="checkbox" name="role[]" value="article|listArticle" <?php if($perssions[0] == 'all' || in_array('listArticle', $perssions)){ echo 'checked';}?> />查看文章</p>
		<p><input type="checkbox" name="role[]" value="article|listArticleUpdate" <?php if($perssions[0] == 'all' || in_array('listArticleUpdate', $perssions)){ echo 'checked';}?> />编辑文章</p>

		<p><input type="checkbox" name="role[]" value="article|addCate" <?php if($perssions[0] == 'all' || in_array('addCate', $perssions)){ echo 'checked';}?> />增加文章分类</p>

		<p><input type="checkbox" name="role[]" value="article|listCate" <?php if($perssions[0] == 'all' || in_array('listCate', $perssions)){ echo 'checked';}?> />分类列表</p>

		<p><input type="checkbox" name="role[]" value="article|updateCate" <?php if($perssions[0] == 'all' || in_array('updateCate', $perssions)){ echo 'checked';}?> />修改文章分类</p>

		<p><input type="checkbox" name="role[]" value="article|delCate" <?php if($perssions[0] == 'all' || in_array('delCate', $perssions)){ echo 'checked';}?> />删除文件分类</p>


		</td>
	</tr>
	 
	<tr>
		<td width="15%" align="right">
		顾客列表&nbsp;</td>
		<td>
		<p><input type="checkbox" name="role[]" value="member|member" <?php if($perssions[0] == 'all' || in_array('member', $perssions)){ echo 'checked';}?> />顾客查看列表</p>
		</td>
	</tr>
	<tr>
		<td width="15%" align="right">
		订单权限&nbsp;
		</td>
		<td>
		<p><input type="checkbox" name="role[]" value="order|orderList" <?php if($perssions[0] == 'all' || in_array('orderList', $perssions)){ echo 'checked';}?> />查看捐赠列表</p>
		<p><input type="checkbox" name="role[]" value="order|posInfosDeal" <?php if($perssions[0] == 'all' || in_array('posInfosDeal', $perssions)){ echo 'checked';}?> />订单修改</p>
		<p><input type="checkbox" name="role[]" value="order|delOrder" <?php if($perssions[0] == 'all' || in_array('delOrder', $perssions)){ echo 'checked';}?> />订单删除</p>
		</td>
	</tr>

	<tr>
		<td width="15%" align="right">
		福位牌位权限&nbsp;</td>
		<td>
		<p><input type="checkbox" name="role[]" value="room|roomOpen" <?php if($perssions[0] == 'all' || in_array('roomOpen', $perssions)){ echo 'checked';}?> />福位牌位开设</p>
		<p><input type="checkbox" name="role[]" value="room|roomList" <?php if($perssions[0] == 'all' || in_array('roomList', $perssions)){ echo 'checked';}?> />福位查看</p>
		<p><input type="checkbox" name="role[]" value="room|updateRoom" <?php if($perssions[0] == 'all' || in_array('updateRoom', $perssions)){ echo 'checked';}?> />福位编辑</p>
		<p><input type="checkbox" name="role[]" value="room|delRoom" <?php if($perssions[0] == 'all' || in_array('delRoom', $perssions)){ echo 'checked';}?>  />福位删除</p>
		<p><input type="checkbox" name="role[]" value="room|roomInfos" <?php if($perssions[0] == 'all' || in_array('roomInfos', $perssions)){ echo 'checked';}?> />牌位查看</p>
		<p><input type="checkbox" name="role[]" value="room|postionList" <?php if($perssions[0] == 'all' || in_array('postionList', $perssions)){ echo 'checked';}?> />牌位列表</p>
		<p><input type="checkbox" name="role[]" value="room|posLocation" <?php if($perssions[0] == 'all' || in_array('posLocation', $perssions)){ echo 'checked';}?> />牌位编辑</p>
		<p><input type="checkbox" name="role[]" value="room|delPos" <?php if($perssions[0] == 'all' || in_array('delPos', $perssions)){ echo 'checked';}?> />牌位删除</p>
		<p><input type="checkbox" name="role[]" value="room|mutilDeal" <?php if($perssions[0] == 'all' || in_array('mutilDeal', $perssions)){ echo 'checked';}?> />批量修改</p>
		</td>
	</tr>

	<tr>
		<td width="15%" align="right">
		统计权限&nbsp;</td>
		<td>
		<p><input type="checkbox" name="role[]" value="tongji|tongjiList" <?php if($perssions[0] == 'all' || in_array('tongjiList', $perssions)){ echo 'checked';}?> />查看统计</p>
		<p><input type="checkbox" name="role[]" value="tongji|tongjiList" <?php if($perssions[0] == 'all' || in_array('exportOrder', $perssions)){ echo 'checked';}?> />导出订单</p>
		<p><input type="checkbox" name="role[]" value="tongji|clearList" <?php if($perssions[0] == 'all' || in_array('clearList', $perssions)){ echo 'checked';}?> />清空无效订单</p>
		</td>
	</tr>

		<tr>
		<td width="15%" align="right">
		友情链接&nbsp;</td>
		<td>
		<p><input type="checkbox" name="role[]" value="links|linkList" <?php if($perssions[0] == 'all' || in_array('linkList', $perssions)){ echo 'checked';}?> />友情链接</p>
		</td>
	</tr>

		<tr>
		<td width="15%" align="right">
		版权信息&nbsp;</td>
		<td>
		<p><input type="checkbox" name="role[]" value="copyright|copyrightInfo" <?php if($perssions[0] == 'all' || in_array('copyrightInfo', $perssions)){ echo 'checked';}?> />版权信息</p>
		</td>
	</tr>

		<tr>
		<td width="15%" align="right">
		关于我们&nbsp;</td>
		<td>
		<p><input type="checkbox" name="role[]" value="aboutus|aboutUsInfo" <?php if($perssions[0] == 'all' || in_array('aboutUsInfo', $perssions)){ echo 'checked';}?> />关于我们</p>
		</td>
	</tr>	
	
		<tr>
		<td width="15%" align="right">
		道教文化&nbsp;</td>
		<td>
		<p><input type="checkbox" name="role[]" value="curlture|curlture" <?php if($perssions[0] == 'all' || in_array('curlture', $perssions)){ echo 'checked';}?> />道教文化</p>
		</td>
	</tr>

	<tr>
		<td width="15%" align="right">
		密码权限&nbsp;
		</td>
		<td>
		<p><input type="checkbox" name="role[]" value="password|passwordCheckForRand" <?php if($perssions[0] == 'all' || in_array('passwordCheckForRand', $perssions)){ echo 'checked';}?> />查看随机密码</p>
		<p><input type="checkbox" name="role[]" value="password|passwordCheckForHigh" <?php if($perssions[0] == 'all' || in_array('passwordCheckForHigh', $perssions)){ echo 'checked';}?> />查看高端密码</p>
		<p><input type="checkbox" name="role[]" value="password|passwordAddForRand" <?php if($perssions[0] == 'all' || in_array('passwordAddForRand', $perssions)){ echo 'checked';}?> />设置随机密码</p>
		<p><input type="checkbox" name="role[]" value="password|passwordAddForHigh" <?php if($perssions[0] == 'all' || in_array('passwordAddForHigh', $perssions)){ echo 'checked';}?> />设置高端节密码</p>		
		</td>
	</tr>	
	
	
	<tr>
		<td width="15%" align="right">
		捐赠额分类权限&nbsp;
		</td>
		<td>
		<p><input type="checkbox" name="role[]" value="price|priceList" <?php if($perssions[0] == 'all' || in_array('priceList', $perssions)){ echo 'checked';}?> />捐赠额查看</p>
		<p><input type="checkbox" name="role[]" value="price|priceAdd" <?php if($perssions[0] == 'all' || in_array('priceAdd', $perssions)){ echo 'checked';}?> />捐赠额增加</p>
		<p><input type="checkbox" name="role[]" value="price|priceDel" <?php if($perssions[0] == 'all' || in_array('priceDel', $perssions)){ echo 'checked';}?> />捐赠额删除</p>
		<p><input type="checkbox" name="role[]" value="price|priceUpdate" <?php if($perssions[0] == 'all' || in_array('priceUpdate', $perssions)){ echo 'checked';}?> />捐赠额修改</p>		
		</td>
	</tr>	
	
	<tr>
		<td width="15%" align="right">
		义工管理&nbsp;
		</td>
		<td>
		<p><input type="checkbox" name="role[]" value="memberteam|memberteamList" <?php if($perssions[0] == 'all' || in_array('memberteamList', $perssions)){ echo 'checked';}?> />分组查看</p>
		<p><input type="checkbox" name="role[]" value="memberteam|memberteamAdd" <?php if($perssions[0] == 'all' || in_array('memberteamAdd', $perssions)){ echo 'checked';}?> />分组增加</p>
		<p><input type="checkbox" name="role[]" value="memberteam|memberteamDel" <?php if($perssions[0] == 'all' || in_array('memberteamDel', $perssions)){ echo 'checked';}?> />分组删除</p>
		<p><input type="checkbox" name="role[]" value="memberteam|memberteamUpdate" <?php if($perssions[0] == 'all' || in_array('memberteamUpdate', $perssions)){ echo 'checked';}?> />分组编辑</p>	
		<p><input type="checkbox" name="role[]" value="memberteam|memberteamInfos" <?php if($perssions[0] == 'all' || in_array('memberteamInfos', $perssions)){ echo 'checked';}?> />分组统计</p>
		
		<p><input type="checkbox" name="role[]" value="memberteam|memberteamListUser" <?php if($perssions[0] == 'all' || in_array('memberteamListUser', $perssions)){ echo 'checked';}?> />义工列表</p>
		<p><input type="checkbox" name="role[]" value="memberteam|memberteamAddUser" <?php if($perssions[0] == 'all' || in_array('memberteamAddUser', $perssions)){ echo 'checked';}?> />义工增加</p>
		<p><input type="checkbox" name="role[]" value="memberteam|memberteamDelUser" <?php if($perssions[0] == 'all' || in_array('memberteamDelUser', $perssions)){ echo 'checked';}?> />义工删除</p>
		<p><input type="checkbox" name="role[]" value="memberteam|memberteamUpdateUser" <?php if($perssions[0] == 'all' || in_array('memberteamUpdateUser', $perssions)){ echo 'checked';}?> />义工编辑</p>	
		<p><input type="checkbox" name="role[]" value="memberteam|memberteamSaleUser" <?php if($perssions[0] == 'all' || in_array('memberteamSaleUser', $perssions)){ echo 'checked';}?> />义工业绩查看</p>			
		</td>
	</tr>	
	
	<tr>
		<td width="15%" align="right">
		系统开启状态&nbsp;</td>
		<td>
		<p><input type="checkbox" name="role[]" value="webset|websetSystem" <?php if($perssions[0] == 'all' || in_array('websetSystem', $perssions)){ echo 'checked';}?> />广结善缘开启状态</p>
		<p><input type="checkbox" name="role[]" value="webset|websetCopy" <?php if($perssions[0] == 'all' || in_array('websetCopy', $perssions)){ echo 'checked';}?> />官网开启状态</p>
		</td>
	</tr>	
	
		<tr>
		<td width="15%" align="right">&nbsp;</td>
		<td>
		<a href="javascript:history.go(-1);">点击返回</a>&nbsp;&nbsp;&nbsp;
		<input name="submit" type="submit" value="提交" />
		</td>		
	</tr>			
</table>
</form>
</div>
<script>
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
