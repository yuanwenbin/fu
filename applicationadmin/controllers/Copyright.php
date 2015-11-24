<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Copyright extends CI_Controller {
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
	        header("Location:/Index/login");
	    }
	    return true;
	}
	
	/**
	 * 版本信息
	 */
	function copyrightInfo()
	{  
	    if(!hasPerssion($_SESSION['role'], 'copyrightInfo')){
	        exit('无权限,请点击左栏目操作');
	    }  
	    
		$res = $this->Curlture_model->copyrightInfoModel();
		if(!$res)
		{
			echo '暂时无内容,';
			echo '<a href="/Copyright/addCopyRight">点击添加内容</a>';
			exit;
		}else {
			$view = array();
			$view['result']= $res;
			
			$this->load->view('copyrightInfo', $view);
		}
	  //  
	}
	
	/**
	 * 增加版权信息
	 */
	function addCopyRight()
	{
		if(!hasPerssion($_SESSION['role'], 'copyrightInfo')){
			exit('无权限,请点击左栏目操作');
		}
		$this->load->view('addCopyRight');
	}
	
	/**
	 * 处理增加的信息
	 */
	function addCopyrightDeal()
	{
		$copy_content = $this->input->get_post('copy_content');
		if(!trim($copy_content))
		{
			$this->load->view('failure');
		}else {
			$copy_content = addslashes($copy_content);
			$res = $this->Curlture_model->addCopyrightDealModel($copy_content);
			$this->load->view('success');
		}
	}
	
	/**
	 * 删除版权信息
	 */
	function delCopyRight()
	{
		$id = $this->uri->segment(3,1);
		$id = intval($id);
		if(!$id)
		{
			$this->load->view('failure');
		}else {
			$this->Curlture_model->delCurltureModel('fu_copy',array('copy_id'=>$id));
			$this->load->view('success');
		}		
	}
}