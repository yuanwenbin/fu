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
	 * 删除友情链接
	 */
	function delLinks()
	{
		if(!hasPerssion($_SESSION['role'], 'linkList')){
			exit('无权限,请点击左栏目操作');
		}
		$id = $this->uri->segment(3,1);
		$id = intval($id);
		if(!$id)
		{
			$this->load->view('failure');
		}else {
			$this->Curlture_model->delCurltureModel('fu_links',array('link_id'=>$id));
			$this->load->view('success');
		}
	}
}