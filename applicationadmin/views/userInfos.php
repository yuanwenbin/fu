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
<h3 class="headerLineBackground">会员 <?php echo $user->admin_user;?> 信息</h3>
<table border="1" cellpadding="0" cellspacing="0" width="90%">	
	<tr>
		<td width="20%" align="right">是否开启：</td>
		<td>
		<?php echo $user->admin_status ? '是' : '否';?>
		</td>		
	</tr>
	
	<tr>
		<td width="20%" align="right">电子邮箱：</td>
		<td>
		<?php echo isset($user->admin_email) && !empty($user->admin_email) ? $user->admin_email : '';?>
		</td>		
	</tr>
	
	
	<tr>
		<td width="20%" align="right">增加时间：</td>
		<td>
		<?php echo date('Y-m-d H:i:s',$user->admin_datetime);?>
		</td>		
	</tr>	
	<tr>
		<td width="20%" align="right">用户拥有的权限：</td>
		<td>
		<?php
		if($perssion != 'all')
		{
			$perssArr = explode(',',$perssion);
			
			foreach($perssionTree as $k=>$v)
			{
				foreach($v as $kk=>$vv)
				{
					if(in_array($kk, $perssArr))
					{
						echo '<p>'.$vv.'</p>';
					}
				}
			}
		}else
		{
			echo '<p>此用户是超级用户，拥有所有功能权限</p>';
		}
		?>
		</td>		
	</tr>	
	
		<tr>
		<td width="20%" align="right">&nbsp;</td>
		<td>
		&nbsp;&nbsp;<a href="javascript:history.go(-1);">点击返回</a>
		</td>		
	</tr>			
</table>

</div>

</body>
</html>
