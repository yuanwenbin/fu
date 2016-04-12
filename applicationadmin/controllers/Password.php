<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Password_model');
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
	 * 查看随机密码
	 */
	function passwordCheckForRand()
	{
	    if(!hasPerssion($_SESSION['role'], 'passwordCheckForRand')){
	        exit('无权限,请点击左栏目操作');
	    } 
			$ps_flag = 0;
			$res = $this->Password_model->passwordCheckModel($ps_flag);
			if(!$res)
			{
				echo '没有相关数据 ';
				if(!hasPerssion($_SESSION['role'], 'passwordAddForRand')){
	        echo "请联系管理员设置 随机密码";
				}else
				{
					 echo "<a href='".URL_APP_C."/Password/passwordAddForRand'>设置随机密码</a>";
				}
				exit;
			}
			// 密码列表
			$view = array();
			$view['title'] = '随机密码列表';
			$view['listPassword'] = $res;
			$this->load->view('passwordCheck', $view);
	}
	 
	/**
	 * 查看高端密码
	 */
	function passwordCheckForHigh()
	{
	    if(!hasPerssion($_SESSION['role'], 'passwordCheckForHigh')){
	        exit('无权限,请点击左栏目操作');
	    } 
			$ps_flag = 1;
			$res = $this->Password_model->passwordCheckModel($ps_flag);
			if(!$res)
			{
				echo '没有相关数据 ';
				if(!hasPerssion($_SESSION['role'], 'passwordAddForHigh')){
	        echo "请联系管理员设置 高端密码";
				}else
				{
					 echo "<a href='".URL_APP_C."/Password/passwordAddForHigh'>设置高端密码</a>";
				}
				exit;
			}
			// 密码列表
			$view = array();
			$view['title'] = '随机密码列表';
			$view['listPassword'] = $res;
			$this->load->view('passwordCheck', $view);
	}
	
	/**
	 * 设置随机密码
	 */
	function passwordAddForRand()
	{
	    if(!hasPerssion($_SESSION['role'], 'passwordAddForRand')){
	        exit('无权限,请点击左栏目操作');
	    }
			$this->load->view('passwordAddForRand');
	}

	/**
	 * 设置随机密码处理
	 */
	 function passwordAddForRandDeal()
	 {
	    if(!hasPerssion($_SESSION['role'], 'passwordAddForRand')){
	        exit('无权限,请点击左栏目操作');
	    }
			$param['ps_password'] = addslashes($_POST['randPassword']);
			$param['ps_datetime'] = time();
			$param['ps_flag'] = 0;
			$param['ps_user'] = $this->session->admin_user;
			$param['ps_user_id'] = $this->session->userId;
			$res = $this->Password_model->passwordAddDealModel($param);
		 if($res)
		 {
				$this->load->view('success');
		 }else
		 {
				$this->load->view('failure');
		 }
	 }

	/**
	 * 设置高端节密码
	 */
	function passwordAddForHigh()
	{
	    if(!hasPerssion($_SESSION['role'], 'passwordAddForHigh')){
	        exit('无权限,请点击左栏目操作');
	    } 
			$this->load->view('passwordAddForHigh');
	}  

	/**
	 * 设置高端密码处理
	 */
	 function passwordAddForHighDeal()
	 {
	    if(!hasPerssion($_SESSION['role'], 'passwordAddForRand')){
	        exit('无权限,请点击左栏目操作');
	    }
			$param['ps_password'] = addslashes($_POST['randPassword']);
			$param['ps_datetime'] = time();
			$param['ps_flag'] = 1;
			$param['ps_user'] = $this->session->admin_user;
			$param['ps_user_id'] = $this->session->userId;
			$res = $this->Password_model->passwordAddDealModel($param);
		 if($res)
		 {
				$this->load->view('success');
		 }else
		 {
				$this->load->view('failure');
		 }
	 }

}