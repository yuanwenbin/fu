<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Links extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Curlture_model');
		$this->isLogin();
	}
	
	/**
	 * 检测是否登陆
	 */
	function isLogin()
	{
	    if(!($this->session->userId) || ($this->session->userId) <= 0)
	    {
	        header("Location:".URL_APP_C."/Index/login");
	    }
	    return true;
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
			echo '<a href="'.URL_APP_C.'"/Links/addLinks">点击添加</a>';
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