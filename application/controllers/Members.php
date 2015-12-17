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
	 * 
	 */
	public function index()
	{  
		// 判断业务员是否登陆了
		$this->isLoginMember();

		// 会员列表
		$userList = $this->Members_model->userListModel($this->session->member_id);
		// 订单列表
		$order_payment = 'all'; // 是否支付
		$orderList = $this->Members_model->orderListModel($this->session->member_id, $order_payment);
		print_r($orderList);
	}


}