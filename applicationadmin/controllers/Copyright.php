<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Copyright extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
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
	 * 友情链接
	 */
	function copyrightInfo()
	{  
	    if(!hasPerssion($_SESSION['role'], 'all')){
	        exit('无权限,请点击左栏目操作');
	    }  
			echo '内容整理中';
	  //$this->load->view('userAdd');  
	}
}