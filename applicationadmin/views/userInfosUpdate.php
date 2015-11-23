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
<div class="roomInfosDiv">
<h3 class="headerLineBackground">会员 <?php echo $user->admin_user;?> 信息</h3>
<form action="/User/userInfosUpdateDeal" method="post">
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
		<p><input type="checkbox" name="role[]" value="all" <?php if($perssion =='all'){ echo 'checked';} ?> />
		超级权限(如果不是超级用户，请取消选择)</p>
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
		<p><input type="checkbox" name="role[]" value="order|orderList" <?php if($perssions[0] == 'all' || in_array('orderList', $perssions)){ echo 'checked';}?> />查看订单列表</p>
		<p><input type="checkbox" name="role[]" value="order|posInfosDeal" <?php if($perssions[0] == 'all' || in_array('posInfosDeal', $perssions)){ echo 'checked';}?> />订单修改</p>
		</td>
	</tr>

	<tr>
		<td width="15%" align="right">
		房间牌位权限&nbsp;</td>
		<td>
		<p><input type="checkbox" name="role[]" value="room|roomOpen" <?php if($perssions[0] == 'all' || in_array('roomOpen', $perssions)){ echo 'checked';}?> />房间牌位开设</p>
		<p><input type="checkbox" name="role[]" value="room|roomList" <?php if($perssions[0] == 'all' || in_array('roomList', $perssions)){ echo 'checked';}?> />房间查看</p>
		<p><input type="checkbox" name="role[]" value="room|updateRoom" <?php if($perssions[0] == 'all' || in_array('updateRoom', $perssions)){ echo 'checked';}?> />房间编辑</p>
		<p><input type="checkbox" name="role[]" value="room|delRoom" <?php if($perssions[0] == 'all' || in_array('delRoom', $perssions)){ echo 'checked';}?>  />房间删除</p>
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
		<p><input type="checkbox" name="role[]" value="tongji|clearList" <?php if($perssions[0] == 'all' || in_array('clearList', $perssions)){ echo 'checked';}?> />清空无效订单</p>
		</td>
	</tr>


	<tr>
		<td width="15%" align="right">
		统计权限&nbsp;</td>
		<td>
		<p><input type="checkbox" name="role[]" value="tongji|tongjiList" <?php if($perssions[0] == 'all' || in_array('tongjiList', $perssions)){ echo 'checked';}?> />查看统计</p>
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
		道教文化&nbsp;</td>
		<td>
		<p><input type="checkbox" name="role[]" value="curlture|curlture" <?php if($perssions[0] == 'all' || in_array('curlture', $perssions)){ echo 'checked';}?> />道教文化</p>
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
</body>
</html>
