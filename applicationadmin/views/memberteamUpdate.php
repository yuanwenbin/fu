<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $memberteamUpdate[0]['team_name'];?>-系统登陆后台</title>
	<link href="<?php echo URL_APP;?>/css/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo URL_APP;?>/js/jquery-1.8.3.min.js"></script>
</head>
<body class="roomList">
<div class="roomInfosDiv container">
<h3>分组修改:<?php echo $memberteamUpdate[0]['team_name'];?></h3>
<form>
<input type="hidden" name="id" value="<?php echo $memberteamUpdate[0]['id'];?>"  />
<table border="0" cellpadding="5" cellspacing="5" width="90%">	

	<tr>
		<td width="20%" align="right">分组名称：</td>
		<td>
		<input type="text" name="team_name" value="<?php echo $memberteamUpdate[0]['team_name'];?>" />
		&nbsp;<input type="submit" name="submit" value="提交修改" />
		</td>		
	</tr>

	<tr>
		<td width="20%" align="right">分组组长选择：</td>
		<td>
		<select name="member_teamid">
		<?php  foreach($memberLists as $vv) { ?>
			<option value="<?php echo $vv['member_id']; ?>" <?php if($memberteamUpdate[0]['id'] == $vv['member_teamid']) echo 'selected'; ?>>
			<?php echo $vv['member_username']; ?><?php if($memberteamUpdate[0]['id'] == $vv['member_teamid']) echo '-现在组长'; ?></option>
		<?php } ?>
		</select>(不修改，则不用理会)
		</td>		
	</tr>
	<?php 
	if($memberteamList) { ?>
	<tr>
	<td width="20%" align="right">&nbsp;</td>
	<td>现有分组列表如下:</td></tr>
	<?php
	foreach($memberteamList as $k=>$v) { ?>
	<tr>
		<td width="20%" align="right">分组名称：</td>
		<td>
		<?php echo $v['team_name']; ?>
		</td>	
	</tr>
	<?php } } ?>
</table>
</form>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$("input[name='submit']").click(function(){
		var team_name = $("input[name='team_name']").val();
		var id = $("input[name='id']").val();
		var member_teamid = $("select[name='member_teamid']").val();
		if(team_name=='')
		{
			alert("请输入分组名");
			return false;
		}
		if(id == '')
		{
			alert("非法操作");
			return false;
		}
		var param = {id:id,team_name:team_name,member_teamid:member_teamid};
		var url = "<?php echo URL_APP_C;?>/Memberteam/memberteamUpdateDeal";
		$.post(url,param,function(data){
			if(data.error)
			{
				alert(data.msg);
			}else
			{
				window.location.href="<?php echo URL_APP_C;?>/Memberteam/memberteamList";
				return true;
			}
		},'json');
		return false;
	});
});
</script>
</body>
</html>
