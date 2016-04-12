<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aboutus extends CI_Controller {
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
	 * 关于我们
	 */
	function aboutUsInfo()
	{  
	    if(!hasPerssion($_SESSION['role'], 'aboutus')){
	        exit('无权限,请点击左栏目操作');
	    }  
	    
		$res = $this->Curlture_model->aboutUsInfoModel();
	
			$view = array();
			$view['result']= $res;
			$this->load->view('aboutus', $view);
	}
	

	
	/**
	 * 处理关于我们
	 */
	function addAboutusDeal()
	{
		if(!hasPerssion($_SESSION['role'], 'aboutus')){
				exit('无权限,请点击左栏目操作');
		} 
		$about_content = $this->input->get_post('about_content');
		$about_id = intval($this->input->get_post('about_id'));
	
		if(!trim($about_content))
		{
			$this->load->view('failure');
		}else {
			$about_content = addslashes($about_content);
			$res = $this->Curlture_model->addAboutusDealModel($about_content,$about_id);
			$this->load->view('success');
		}
	}
	

}