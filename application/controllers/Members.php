<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Members extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Members_model');
	}
	
	/**
	 * 判断是否有业务员登陆了
	 */
	private function isLoginMember()
	{
		if(!$this->session->member_id)
		{
			header("Location:/Index/member");
			exit;
		}
		return true;
	}
	/**
	 * 统计总数页面
	 */
	public function index()
	{  
		// 判断业务员是否登陆了
		$this->isLoginMember();
        /*
		// 会员列表
		$userList = $this->Members_model->userListModel($this->session->member_id);
		// 订单列表
		$order_payment = 'all'; // 是否支付
		$orderList = $this->Members_model->orderListModel($this->session->member_id, $order_payment);
        */
		//会员总数
		$param['user_member_id'] = $this->session->member_id; 
		$totalMembers = $this->Members_model->orderTotalNumberModel($param);
		// 总金额
		$totalMoney = $this->Members_model->orderTotalMoneyModel($param);
		// 已经支付金额
		$param['order_payment'] = 1;
		$totalMoneyPay = $this->Members_model->orderTotalMoneyModel($param);
		$view['name'] = $this->session->member_username;
		$view['totalMembers'] = $totalMembers;
		$view['totalMoney'] = $totalMoney;
		$view['totalMoneyPay'] = $totalMoneyPay;
		$this->load->view('membersIndex', $view);
	}
	
	/**
	 * 用户列表
	 */
	function userList()
	{
	    // 判断业务员是否登陆了
	    $this->isLoginMember();	 
	    // 会员总数，没有下过订单的
	    $total = $this->Members_model->userListTotalModel($this->session->member_id,array('user_location_id'=>'0'));
	    $pageSize = 10;
	    $totalPage = ceil($total/$pageSize);
	    $page = intval($this->input->get_post('page'));
	    if(!$page)
	    {
	    	$page = 1;
	    }
	    
	    // 会员列表,登记的，没有下过订单的
	    $userList = $this->Members_model->userListRegisterModel($this->session->member_id, $page, $pageSize);
	    $view['userList'] = $userList;
	    $view['name'] = $this->session->member_username;
		$view['page'] = $page;
		$view['totalPage'] = $totalPage;
		$view['total'] = $total;
	    $this->load->view('memberUserList', $view);
	}
	
	/**
	 * 业务员订单列表
	 */
	function orderList()
	{
	    // 判断业务员是否登陆了
	    $this->isLoginMember();	  
	    $order_payment = 'all'; // 是否支付
	    //
	    $pageSize = 10;
	    //当前页码
	    $page = intval($this->input->get_post('page'));
	    if($page < 1)
	    {
	    	$page = 1;
	    }	
	    // 订单总数
	    $param['user_member_id'] = $this->session->member_id;
	    $orderListTotal = $this->Members_model->orderTotalNumberModel($param);	    
	    // 总页码
	    $totalPage = ceil($orderListTotal/$pageSize);	    
	    if($page > $totalPage) 
	    {
	    	$page = $totalPage;
	    }   
	    $orderList = $this->Members_model->orderListModel($this->session->member_id, $order_payment,$page,$pageSize);
	    $view['memberOrderList'] = $orderList;
	    $view['name'] = $this->session->member_username;

		$view['total'] = $orderListTotal;

	    $view['page'] = $page;
	    $view['totalPage'] = $totalPage;
	    $this->load->view('memberOrderList', $view);  
	}


}