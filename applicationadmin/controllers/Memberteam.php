<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Memberteam extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Memberteam_model');
		$this->isLogin();
	}
	
	/**
	 * 检测是否登陆
	 */
	function isLogin()
	{
	    if(!($this->session->userId) || ($this->session->userId) <= 0)
	    {
	        header("Location:/Index/login");
	    }
	    return true;
	}
	
	/**
	 * 业务员分组
	 */
	function memberteamList()
	{
		if(!hasPerssion($_SESSION['role'], 'memberteamList')){
	        exit('无权限,请点击左栏目操作');
	    }
		$memberteamList = $this->Memberteam_model->memberteamListModel();
		if(!$memberteamList)
		{
			echo '暂时没有相关内容';
			if(hasPerssion($_SESSION['role'], 'memberteamAdd'))
			{
				echo '<a href="/Memberteam/memberteamAdd">点击添加业务员分组</a>';
			}
		}else {
			$view = array();
			$view['result'] = $memberteamList;
			$this->load->view('memberteamList',$view);
		}		
	}


	
	/**
	 * 增加业务员分组
	 */
	function memberteamAdd()
	{
		if(!hasPerssion($_SESSION['role'], 'memberteamAdd')){
			exit('无权限,请点击左栏目操作');
		}
		$view = array();
		$view['teamList'] = '';
		if(hasPerssion($_SESSION['role'], 'memberteamList')){
	       $memberteamList = $this->Memberteam_model->memberteamListModel();
		   if($memberteamList)
			{
				$view['teamList'] = $memberteamList;
			}
	    }
		$this->load->view('memberteamAdd', $view);		
	}
	
	/**
	 * 增加业务员分组处理
	 */
	function memberteamAddDeal()
	{
		if(!hasPerssion($_SESSION['role'], 'memberteamAdd')){
			exit('无权限,请点击左栏目操作');
		}
	
		$memberteamAdd = addslashes($this->input->get_post('memberteamAdd'));
		if(!$memberteamAdd)
		{
			$this->load->view('failure');
		}else {
			// 先检查是否存在重复的
			$res = $this->Memberteam_model->memberteamQueryModel('fu_team',array('team_name'=>$memberteamAdd));
			if($res)
			{
				exit('存在重复的分组名!请点击左栏目操作');
			}
			$param = array();
			$param['team_name'] = $memberteamAdd;
			$param['team_create'] = time();
			$param['team_user_id'] = $this->session->userId;
			$param['team_user_name'] = $this->session->admin_user;
			$affectRow = $this->Memberteam_model->memberteamAddModel('fu_team',$param);
			if($affectRow)
			{
				$this->load->view('success');
			}else
			{
				$this->load->view('failure');
			}
			
		}
		
	}
	
	/**
	 * 删除分组
	 */
	function memberteamDel()
	{
		if(!hasPerssion($_SESSION['role'], 'memberteamDel')){
			exit('无权限,请点击左栏目操作');
		}
		$memberteamList = $this->Memberteam_model->memberteamListModel();
		if(!$memberteamList)
		{
			echo '暂时没有相关内容';
			if(hasPerssion($_SESSION['role'], 'memberteamAdd'))
			{
				echo '<a href="/Memberteam/memberteamAdd">点击添加业务员分组</a>';
			}
		}else {
			$view = array();
			$view['result'] = $memberteamList;
			$this->load->view('memberteamDel',$view);
		}		
	}

	/**
	 * 删除分组处理
	 */
	function memberteamDelDeal()
	{
		if(!hasPerssion($_SESSION['role'], 'memberteamDel')){
			exit('无权限,请点击左栏目操作');
		}

		$id = intval($this->input->get_post('id'));
		if(!$id || $id < 1)
		{
			$this->load->view('failure');
		}else
		{
			$this->Memberteam_model->memberteamDelDealModel($id);
			$this->load->view('success');
		}
	}
	/**
	 * 分组编辑
	 */
	function memberteamUpdate()
	{
	    if(!hasPerssion($_SESSION['role'], 'memberteamUpdate')){
	        exit('无权限,请点击左栏目操作');
	    }	    
		exit("此功能暂时不开放");
	}
	/**
	 * 业务员列表
	 */
	function memberteamListUser()
	{
		if(!hasPerssion($_SESSION['role'], 'memberteamListUser')){
			exit('无权限,请点击左栏目操作');
		}	
		$memberteamListUser = $this->Memberteam_model->memberteamListUserModel();
		if(!$memberteamListUser)
		{
			echo '没有相关数据! ';
			if(!hasPerssion($_SESSION['role'], 'memberteamAddUser')){
				exit('请联系管理员');
			}
			echo "&nbsp;点击<a href=\"/Memberteam/memberteamAddUser\">添加</a>";
			exit();
		}
		$view['memberteamListUser'] = $memberteamListUser;
		$this->load->view('memberteamListUser', $view);
	}
	
	/**
	 * 增加业务员
	 */
	function memberteamAddUser()
	{
		if(!hasPerssion($_SESSION['role'], 'memberteamAddUser')){
			exit('无权限,请点击左栏目操作');
		}
		$memberteamList = $this->Memberteam_model->memberteamListModel();
		if(!$memberteamList)
		{
			echo ('没有相关分组');
			if(!hasPerssion($_SESSION['role'], 'memberteamAdd')){
				exit("，请先联系管理员添加业务员分组!");
			}else
			{
				echo "<a href=\"/Memberteam/memberteamAdd\">添加业务员分组</a>";
				exit();
			}
		}
		// 展示列表
		$view['memberteamList'] = $memberteamList;
		
		$this->load->view('memberteamAddUser',$view);
	}

	/**
	 * 增加业务员处理
	 */
	function memberteamAddUserDeal()
	{
		if(!hasPerssion($_SESSION['role'], 'memberteamAddUser')){
			exit('无权限,请点击左栏目操作');
		}
		
		$member_team_id = intval($this->input->get_post('member_team_id'));
		$member_username = addslashes($this->input->get_post('member_username'));
		$member_password = addslashes($this->input->get_post('member_password'));
		$member_realname = addslashes($this->input->get_post('member_realname'));
		$member_telphone = addslashes($this->input->get_post('member_telphone'));
		$member_phone = addslashes($this->input->get_post('member_phone'));
		$member_user_id = $this->session->userId;
		$member_user_name = $this->session->admin_user;
		$member_create = time();
		if(!$member_team_id || !$member_username || !$member_password || !$member_realname || !$member_telphone)
		{
			exit('非法操作');
		}
		$param = array('member_team_id'=>$member_team_id,
					   'member_username'=>$member_username,
						'member_password'=>$member_password,
						'member_realname'=>$member_realname,
						'member_telphone'=>$member_telphone,
						'member_phone'=>$member_phone,
						'member_user_id'=>$member_user_id,
						'member_user_name'=>$member_user_name,
						'member_create'=>$member_create
						);
		$affectRow = $this->Memberteam_model->memberteamAddModel('fu_member',$param);
		if($affectRow)
		{
			$this->load->view('success');
		}else
		{
			$this->load->view('failure');
		}
	}
	/**
	 * 删除业务员
	 */
	function memberteamDelUser()
	{
	    if(!hasPerssion($_SESSION['role'], 'memberteamDelUser')){
	        exit('无权限,请点击左栏目操作');
	    }	    
		exit('此功能暂不开放');
	}
	/**
	 * 编辑业务员
	 */
	function memberteamUpdateUser()
	{
	    if(!hasPerssion($_SESSION['role'], 'memberteamUpdateUser')){
	        exit('无权限,请点击左栏目操作');
	    }	    
		exit('此功能暂不开放');
	}
	
	/**
	 * 业务员业绩
	 */
	function memberteamSaleUser()
	{
	    if(!hasPerssion($_SESSION['role'], 'memberteamSaleUser')){
	        exit('无权限,请点击左栏目操作');
	    }	
        $id = intval(trim($this->input->get_post('id')));
        if(!$id || $id < 0)
        {
            exit('非法操作');
        }
        //会员总数
        $param['user_member_id'] = $id;
        $totalMembers = $this->Memberteam_model->orderTotalNumberModel($param);
        // 总金额
        $totalMoney = $this->Memberteam_model->orderTotalMoneyModel($param);
        // 已经支付金额
        $param['order_payment'] = 1;
        $totalMoneyPay = $this->Memberteam_model->orderTotalMoneyModel($param);
        $memberInfos = $this->Memberteam_model->getMemberTeam($id);
        if(!$memberInfos)
        {
            exit('没有相关记录');
        }
        $view['memberInfos'] = $memberInfos;
        $view['totalMembers'] = $totalMembers;
        $view['totalMoney'] = $totalMoney;
        $view['totalMoneyPay'] = $totalMoneyPay; 
        $this->load->view('memberteamSaleUser',$view);       
	}
	
	/**
	 * 业务员用户列表
	 */
	function MemberteamUserList()
	{
		if(!hasPerssion($_SESSION['role'], 'memberteamSaleUser')){
	        exit('无权限,请点击左栏目操作');
	    }
	    $id = intval(trim($this->input->get_post('id')));
	    if(!$id || $id < 0)
	    {
	        exit('非法操作');
	    }  
	    // 会员列表
	    $userList = $this->Memberteam_model->MemberteamUserListModel($id);
	    $view['userList'] = $userList;
	    $memberInfos = $this->Memberteam_model->getMemberTeam($id);
	    $view['memberInfos'] = $memberInfos;
	    $this->load->view('MemberteamUserList', $view);
	}

	/**
	 * 业务员订单列表
	 */
	function MemberteamOrderList()
	{
		if(!hasPerssion($_SESSION['role'], 'memberteamSaleUser')){
            exit('无权限,请点击左栏目操作');
	    }
	    $id = intval(trim($this->input->get_post('id')));
	    if(!$id || $id < 0)
	    {
	        exit('非法操作');
	    }
	    $order_payment = 'all'; // 是否支付
	    $orderList = $this->Memberteam_model->MemberteamOrderListModel($id, $order_payment);
	    $view['memberOrderList'] = $orderList;
	    $memberInfos = $this->Memberteam_model->getMemberTeam($id);
	    $view['memberInfos'] = $memberInfos;
	    $this->load->view('MemberteamOrderList', $view);
	}	
}