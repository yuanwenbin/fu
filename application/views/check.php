<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>来访问登记查询</title>
	<link href="/css/style.css" rel="stylesheet" type="text/css" />
	<script src="/js/jquery-1.8.3.min.js" type="text/javascript"></script>
	<style type="text/css">
	.pages{width:100%;line-height:40px;text-align:center;}	
	.pages a{color:#333;border:1px solid #888;padding:0 5px;}
	.pages font{color:#ee0000;}
	</style>
</head>
<body class="roomList">
<div class="topBg">
<img src="/images/title_background.png" />
</div>
<div class="roomListInfos membersUserList">
<div class="headerLineBackground">
<form method="get" action="">
来访登记查询&nbsp;&nbsp; 
<select name="type">
<option value="user_telphone" <?php if($type=='user_telphone') echo 'selected';?>>手机号码</option>
<option value="user_phone"  <?php if($type=='user_phone') echo 'selected';?>>姓名</option>
<option value="body_id" <?php if($type=='body_id') echo 'selected';?>>身份证</option>
</select>&nbsp;&nbsp;
<input type="text" name="name" value="<?php echo $name;?>" />&nbsp;&nbsp;
<input type="submit" name="submit" value="查找" />
</form>
</div>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<?php if(isset($res) && $res) { ?>
	<tr>
		<th width="8%" align="center">称呼</th>
		<th width="13%" align="center">手机号码</th>
		<th width="23%" align="center">身份证号码</th>
		<th width="10%" align="center">业务员</th>
		<th width="5%" align="center">登记次数</th>
		<th width="15%" align="center">登记时间</th>
		<th width="15%" align="center">登记过期时间</th>
		<th width="5%" align="center">过期状态</th>
		<th width="6%" align="center">操作</th>
	</tr>
	<?php
		foreach($res as $k=>$v) { 
		    if(isset($v['order']['order_payment']) && $v['order']['order_payment'])
		    {
	?>
	<tr>
		<td widtd="8%" align="center"><?php echo $v['user_phone'] ? $v['user_phone'] :'无'; ?></td>
		<td widtd="13%" align="center">
		<?php echo $v['user_telphone'] ? $v['user_telphone'] : '无'; ?>
		</td>
		<td widtd="23%" align="center">
		<?php echo $v['body_id'] ? $v['body_id'] : '无'; ?>
		</td>
		<td widtd="10%" align="center">
		<?php 
		if(isset($v['member']) && $v['member'])
		{
		   if($v['member']['member_realname']) 
		   {
                echo $v['member']['member_realname'];
		   }elseif($v['member']['member_username']) {
		       echo $v['member']['member_username'];
		   }else {
		       echo '无';
		   }
		}else {
		  echo '无';   
		}
		?>
		</td>	
		
		<td widtd="5%" align="center">
		<?php echo $v['user_regtimes']; ?>
		</td>	
		
		<td widtd="15%" align="center">
		<?php echo date('Y-m-d H:i:s', $v['user_datetime']); ?>
		</td>			
		
	   <td widtd="15%" align="center">
		<?php echo '已完成购买'; ?>
		</td>	
		
		
				
		<td widtd="5%" align="center">
		<?php 
            echo '已完成';
		?>
		</td>
		<td widtd="6%" align="center">
		<?php 
            echo '已完成';
		?>
		</td>		
	</tr>
	<?php }else{ ?>
	<tr>
		<td widtd="8%" align="center"><?php echo $v['user_phone'] ? $v['user_phone'] :'无'; ?></td>
		<td widtd="13%" align="center">
		<?php echo $v['user_telphone'] ? $v['user_telphone'] : '无'; ?>
		</td>
		<td widtd="23%" align="center">
		<?php echo $v['body_id'] ? $v['body_id'] : '无'; ?>
		</td>
		<td widtd="10%" align="center">
		<?php 
		if(isset($v['member']) && $v['member'])
		{
		   if($v['member']['member_realname']) 
		   {
                echo $v['member']['member_realname'];
		   }elseif($v['member']['member_username']) {
		       echo $v['member']['member_username'];
		   }else {
		       echo '无';
		   }
		}else {
		  echo '无';   
		}
		?>
		</td>	
		
		<td widtd="5%" align="center">
		<?php echo $v['user_regtimes']; ?>
		</td>	
		
		<td widtd="15%" align="center">
		<?php echo date('Y-m-d H:i:s', $v['user_datetime']); ?>
		</td>			
		
	   <td widtd="15%" align="center">
		<?php echo date('Y-m-d H:i:s', $v['user_datetime']+$v['user_dateline']); ?>
		</td>	
		
		
				
		<td widtd="5%" align="center">
		<?php 
		$flag = $v['user_datetime']+$v['user_dateline'] - time();
		if($flag <= 0)
		{
		    echo '已过期';
		}else {
		    echo '未过期';
		}
		?>
		</td>
		<td widtd="6%" align="center" id="addDate_<?php echo $v['user_id'];?>">
		<?php 
            if($v['user_addtime']){
                echo '已经报备';
            }else {
		?>
		<a data-attr="<?php echo $v['user_id'];?>" href="javascript:void(0);" class="addDate">增加报备</a>
		<?php } ?>
		</td>		
	</tr>    
	<?php } } } ?>
</table>
<!--  bof 页码  -->

<!--  eof 页码  -->
<p class="backBtnMember"><a href="/Members/index">返回统计中心</a>
&nbsp;&nbsp;
<a href="/Index/menus">菜单中心</a></p>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $("input[name='submit").click(function(){
        var name = $("input[name='name'").val();
        if(name == '')
        {
            alert("请输入搜索的内容");
            return false;
        }
    });

    $(".addDate").click(function(){
        var userId = $(this).attr('data-attr');
        var url = "/Members/addDateline";
        var param = {user_id:userId};
        $.post(url,param,function(data){
            alert(data.msg);
            if(!data.error)
            {
                $("#addDate_"+data.id).html("已经报备");
            }
         }, 'json');
    });
	
})
</script>

</body>
</html>
