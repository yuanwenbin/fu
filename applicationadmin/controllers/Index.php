<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	function __construct()
	{
		parent::__construct();
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
	 * 登陆页面
	 */
	public function login()
	{
		if(($this->session->userId) && ($this->session->userId) > 0)
		{
			header("Location:/Index/index");
		}
		$cookieUsername = get_cookie(COOKIE_USER);
		$cookiePassword = get_cookie(COOKIE_PASSWORD);
		if($cookieUsername && $cookiePassword) 
		{
			$username = authcode($cookieUsername);
			$password = authcode($cookiePassword);
			$this->load->model('Login_model');
			$res = $this->Login_model->loginCheck($username, $password);
			if($res)
			{
		        // 设置session等
		        $role = $res[1]['persion_controller'];
		        $data = array(
		        	'userId'=>$res[0]['admin_id'],
		        	'admin_user'=>$res[0]['admin_user'],
		        	'role'=>explode(',',$res[1]['persion_controller']),		
		        );
		        $this->session->set_userdata($data); 
		        $usernameSec = authcode($username,'ENCODE');
		        $passwordSec = authcode($password,'ENCODE');
		        set_cookie(COOKIE_USER, $usernameSec, COOKIE_EXPIRE,COOKIE_DOMAIN,COOKIE_PATH);
		        set_cookie(COOKIE_PASSWORD, $passwordSec, COOKIE_EXPIRE,COOKIE_DOMAIN,COOKIE_PATH);
		        header("Location:/Index/index");
			}
		}
		
	    $this->load->view('login');
	}
	
	/**
	 * 验证登陆
	 */
    function loginValidate()
    {
    	if(($this->session->userId) && ($this->session->userId) > 0)
    	{
    		header("Location:/Index/index");
    	}    	
        $username = $this->input->post_get('username');
        $password = $this->input->post_get('password');
        if($username == '' || $password == '')
        {
            header("Location:/Index/login");
        }
        if(strlen($username) < 5 || strlen($username) > 30 || strlen($password) < 5 || strlen($password) > 30)
        {
            header("Location:/Index/login");
        }
        $this->load->model('Login_model');
        $res = $this->Login_model->loginCheck($username, $password);
        if(!$res)
        {
            header("Location:/Index/login");
        }
        // 设置session等
        $data = array(
        	'userId'=>$res[0]['admin_id'],
        	'admin_user'=>$res[0]['admin_user'],
        	'role'=>explode(',',$res[1]['persion_controller']),			
        );
        $this->session->set_userdata($data); 
        $usernameSec = authcode($username,'ENCODE');
        $passwordSec = authcode($password,'ENCODE');
        set_cookie(COOKIE_USER, $usernameSec, COOKIE_EXPIRE,COOKIE_DOMAIN,COOKIE_PATH);
        set_cookie(COOKIE_PASSWORD, $passwordSec, COOKIE_EXPIRE,COOKIE_DOMAIN,COOKIE_PATH);
        header("Location:/Index/index");
    }
    /**
     * 成功登陆后首页
     */
    function index(){
		$this->isLogin();
		$this->load->view('index');
    }
    
    /**
     * 底部信息
     */
    function footer()
    {
    	$this->isLogin();
    	$this->load->view('footer');
    }
    
    /**
     * 退出登陆
     */
    function logout()
    {
    	$this->isLogin();
    	// 退出日志
    	if($this->session->userId)
    	{
    		$this->load->model('Login_model');
    		$this->Login_model->logLogout($this->session->admin_user, addslashes(serialize($_SERVER)), time());    		
    	}
    	$arr = array('userId','admin_user', 'role');
    	$this->session->unset_userdata($arr);
		delete_cookie(COOKIE_USER,COOKIE_DOMAIN,COOKIE_PATH);
		delete_cookie(COOKIE_PASSWORD,COOKIE_DOMAIN,COOKIE_PATH);
    	header("Location:/Index/login");
    }
    
    /**
     * 管理头部
     */
    function top()
    {
    	$this->isLogin();
    	$view['username'] = $this->session->userdata('admin_user');
    	$this->load->view('top', $view);
    }
    
    /**
     * 左侧栏目
     */
    function menu()
    {
    	$this->isLogin();
    	
    	
    	$this->load->view('menu');
    }
	
    /**
     * 默认右边展示信息
     */
    function infos()
    {
    	$this->isLogin();
    	$view['infos'] = $_SERVER;
    	$this->load->view('infos', $view);
    }
}
