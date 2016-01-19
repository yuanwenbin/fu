<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webset extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Webset_model');
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
	 * 选择系统前台
	 */
	function websetSystem()
	{  
	    if(!hasPerssion($_SESSION['role'], 'websetSystem')){
	        exit('无权限,请点击左栏目操作');
	    }  
			$res = $this->Webset_model->websetQuery(1);
			$view = array();
			$view['result']= $res;
			$this->load->view('websetSystem', $view);		 
	}
	
	/**
	 * 选择修改处理
	 */
	function websetSystemDeal()
	{
	    if(!hasPerssion($_SESSION['role'], 'websetSystem')){
	        exit('无权限,请点击左栏目操作');
	    } 
			$flag = intval($this->input->get_post('flag'));
			if(!in_array($flag, array(0,1)))
			{
				$this->load->view('failure');
			}else
			{
				$res = $this->Webset_model->websetUpdateModel($flag,1);
				if($res)
				{
					$this->load->view('success');
				}else
				{
					$this->load->view('failure');
				}
			}
	}

	/**
	 * 选择官网
	 */
	function websetCopy()
	{  
	    if(!hasPerssion($_SESSION['role'], 'websetCopy')){
	        exit('无权限,请点击左栏目操作');
	    }  
			$res = $this->Webset_model->websetQuery(2);
			$view = array();
			$view['result']= $res;
			$this->load->view('websetCopy', $view);		 
	}	

	/**
	 * 选择官网修改处理
	 */
	function websetCopyDeal()
	{
	    if(!hasPerssion($_SESSION['role'], 'websetCopy')){
	        exit('无权限,请点击左栏目操作');
	    } 
			$flag = intval($this->input->get_post('flag'));
			if(!in_array($flag, array(0,1)))
			{
				$this->load->view('failure');
			}else
			{
				$res = $this->Webset_model->websetUpdateModel($flag,2);
				if($res)
				{
					$this->load->view('success');
				}else
				{
					$this->load->view('failure');
				}
			}
	}

}