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
			if(hasPerssion($_SESSION['role'], 'memberteamList'))
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
	 * 友情链接
	 */
	function linkList()
	{  
		if(!hasPerssion($_SESSION['role'], 'linkList')){
	        exit('无权限,请点击左栏目操作');
	    }	
		$linkList = $this->Curlture_model->linksList();
		if(!$linkList)
		{
			echo '暂时没有相关内容,';
			echo '<a href="/Links/addLinks">点击添加</a>';
		}else {
			$view = array();
			$view['result'] = $linkList;
			$this->load->view('linkList',$view);
		}
	  //$this->load->view('userAdd');  
	}
	
	/**
	 * 增加友情链接
	 */
	function addLinks()
	{
		if(!hasPerssion($_SESSION['role'], 'linkList')){
			exit('无权限,请点击左栏目操作');
		}
		$this->load->view('addLinks');		
	}
	
	/**
	 * 增加友情链接处理
	 */
	function addLinksDeal()
	{
		if(!hasPerssion($_SESSION['role'], 'linkList')){
			exit('无权限,请点击左栏目操作');
		}
		$link_content = addslashes($this->input->get_post('friendLinks'));
		if(!$link_content)
		{
			$this->load->view('failure');
		}else {
			$this->Curlture_model->addLinksDealModel($link_content);
			$this->load->view('success');
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