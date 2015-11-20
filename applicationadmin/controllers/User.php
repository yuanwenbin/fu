<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
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
	 * 增加管理员
	 */
	function userAdd()
	{  
	    if(!hasPerssion($_SESSION['role'], 'all')){
	        exit('无权限,请点击左栏目操作');
	    }  
	  $this->load->view('userAdd');  
	}
	
	/**
	 * 增加管理员处理
	 */
	function userAddDeal()
	{
		if(!hasPerssion($_SESSION['role'], 'all')){
	        exit('无权限,请点击左栏目操作');
	    } 
	   $roles = $this->input->get_post('role');
	   $roleArr = array();
	   if(!$roles)
	   {
	       echo '权限没有选择！';
	       echo "&nbsp;<a href=\"javascript:history.go(-1);\">点击返回</a>";
	       exit;	       
	   }
	   $admin_user = $this->input->get_post('admin_user');
	   $admin_password = $this->input->get_post('admin_password');
	   if(!$admin_user || !$admin_password)
	   {
	       echo '输入出错！';
	       echo "&nbsp;<a href=\"javascript:history.go(-1);\">点击返回</a>";
	       exit;	       
	   }
	   $salt = rand(100000,999999);
	   $admin_password = md5($admin_password . $salt);
	   $admin_status = $this->input->get_post('admin_status');
	   $admin_email = $this->input->get_post('admin_email');
	   $admin_date = time();
	   $param['admin_user'] = addslashes($admin_user);
	   $param['admin_password'] = addslashes($admin_password);
	   $param['admin_status'] = intval($admin_status);
	   $param['admin_email'] = addslashes($admin_email);
	   $param['admin_datetime'] = $admin_date;
	   $param['admin_salt'] = $salt;
	   //用表表
	   $res = $this->User_model->userAddDeal('fu_admin',$param);
	   // 查找新的admin_id
	   if($res)
	   {
	       $admin_id = $this->User_model->newAdminId();
	   }
	   //权限表
	   if($roles[0] != 'all')
	   {
    	   foreach($roles as $v)
    	   {
    	       $role = explode('|', $v);
    	       array_push($roleArr,$role[1]);
    	       if(!in_array($role[0],$roleArr))
    	       {
    	           array_push($roleArr,$role[0]);
    	       }
    	   }
    	   $perssion = implode(',',$roleArr);
	   }else {
	       $perssion = 'all';
	   }
	   $pressArr['admin_id'] = $admin_id;
	   $pressArr['persion_controller'] = $perssion;
	   $ress = $this->User_model->userAddDeal('fu_admin_perssion',$pressArr);
	   
		if($res && $ress)
	    {
	        $this->load->view('success');
	    }else {
	        $this->load->view('failure');
	    }	
	}
	
	/**
	 * 管理员列表
	 */
	function userList()
	{
	    if(!hasPerssion($_SESSION['role'], 'all')){
	        exit('无权限,请点击左栏目操作');
	    }	    
	   $res = $this->User_model->userList();
	   if(!$res)
	   {
	       $this->load->view('failure');
	   }else {
	       $view['result'] = $res;
	       $this->load->view('userList', $view);
	   }
	}
	
	/**
	 * 删除员工
	 */
	function userDel()
	{
	    if(!hasPerssion($_SESSION['role'], 'all')){
	        exit('无权限,请点击左栏目操作');
	    }	    
	    $admin_id = $this->input->get_post('id');
	    if(!$admin_id)
	    {
	        echo '出错！';
	        echo "&nbsp;<a href=\"javascript:history.go(-1);\">点击返回</a>";
	        exit;	        
	    }
	    $admin_id = intval($admin_id);
		$userId = $this->session->userdata('userId');
	    if($admin_id == $userId)
	    {
	        echo '出错！不能删除自己';
	        echo "&nbsp;<a href=\"javascript:history.go(-1);\">点击返回</a>";
	        exit;	        
	    }
	    $res = $this->User_model->userDel($admin_id);
	    $ress = $this->User_model->userPerDel($admin_id);
	    if($res)
	    {
	        $this->load->view('success');
	    }else {
	        $this->load->view('failure');
	    }
	}
	
	function userInfos()
	{
	    if(!hasPerssion($_SESSION['role'], 'all')){
	        exit('无权限,请点击左栏目操作');
	    }	    
		$admin_id = $this->input->get_post('id');
	    if(!$admin_id)
	    {
	        echo '出错！';
	        echo "&nbsp;<a href=\"javascript:history.go(-1);\">点击返回</a>";
	        exit;	        
	    }
	    $res = $this->User_model->userInfos($admin_id);
	    
	    if($res)
	    {
	        $view['user'] = $res;
	        //查看权限
	        $ress = $this->User_model->perssionInfos($admin_id);
	        $view['perssion'] = $ress;
	        $view['perssionTree'] = perssion();
	        $this->load->view('userInfos', $view);
	    }else {
	        $this->load->view('failure');
	    }	    
	}
	
	function userInfosUpdate()
	{
	    if(!hasPerssion($_SESSION['role'], 'all')){
	        exit('无权限,请点击左栏目操作');
	    }	    
	    $admin_id = $this->input->get_post('id');
	    if(!$admin_id)
	    {
	        echo '出错！';
	        echo "&nbsp;<a href=\"javascript:history.go(-1);\">点击返回</a>";
	        exit;
	    }
	    $res = $this->User_model->userInfos(intval($admin_id));
	    if($res)
	    {
	        $view['user'] = $res;
	        //查看权限
	        $ress = $this->User_model->perssionInfos($admin_id);
	        $view['perssion'] = $ress;	
	        $this->load->view('userInfosUpdate', $view);
	    }else {
	        $this->load->view('failure');
	    }	    
	}
	
	function userInfosUpdateDeal()
	{
	    
	    if(!hasPerssion($_SESSION['role'], 'all')){
	        exit('无权限,请点击左栏目操作');
	    }	   
	    
	    $admin_id = $this->input->get_post('admin_id');
	    if(!$admin_id)
	    {
	        echo '出错！';
	        echo "&nbsp;<a href=\"javascript:history.go(-1);\">点击返回</a>";
	        exit;
	    }	
	    $admin_id = intval($admin_id);
	    $param['admin_user'] = addslashes($this->input->get_post('admin_user'));
	    $param['admin_email'] = addslashes($this->input->get_post('admin_email'));
	    $param['admin_status'] = intval($this->input->get_post('admin_status'));
	    if($this->input->get_post('admin_password'))
	    {
	        $param['admin_password'] = addslashes($this->input->get_post('admin_password'));
	        $param['admin_salt'] = rand(100000,999999);
	    }
	    
	    //修改权限
	    $perssion = '';
	    $roles = $this->input->get_post('role');
	    if($roles && $roles[0] != 'all')
	    {
	        $roleArr = array();
	        foreach($roles as $v)
	        {
	            $role = explode('|', $v);
	            array_push($roleArr,$role[1]);
	            if(!in_array($role[0],$roleArr))
	            {
	                array_push($roleArr,$role[0]);
	            }
	        }
	        $perssion = implode(',',$roleArr);
	    }elseif($roles[0] == 'all') {
	        $perssion = 'all';
	    }
	    if(!$perssion)
	    {
	        exit('你没有选择权限值');
	    }
	    //if($perssion)
	    //{
	        $res = $this->User_model->updatePerssion($admin_id,$perssion);
	   // }
	    // eof	    
	    
	    $res = $this->User_model->userInfosUpdateDeal($admin_id,$param);

	    
         $this->load->view('success');
	    
	}
	
}
