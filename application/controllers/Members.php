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
			header("Location:". URL_APP_C ."/Index/member");
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
  
	    $orderList = $this->Members_model->orderListModel($this->session->member_id, $order_payment,$page,$pageSize);
	    $view['memberOrderList'] = $orderList;
	    $view['name'] = $this->session->member_username;

		$view['total'] = $orderListTotal;

	    $view['page'] = $page;
	    $view['totalPage'] = $totalPage;
	    $this->load->view('memberOrderList', $view);  
	}
	/**
	 * 查询功能
	 */
	function check()
	{
	    // 判断业务员是否登陆了
	    $this->isLoginMember();	
	    $view = array();
	    $data = array();
	    $param = array('user_member_id'=>$this->session->member_id);
	    $type = $this->input->get_post('type');
	    $name = addslashes($this->input->get_post('name'));
	    $arr = array('user_telphone','user_phone','body_id');
	    if(in_array($type, $arr) && $name)
	    {
	        if($name)
	        {
	            $param[$type] = $name;
	            $res = $this->Members_model->search('fu_user',$param);
	            if($res)
	            {
	                foreach($res as $k=>$v)
	                {
	                    $data[$k] = $v;
	                    $data[$k]['order'] = '';
	                    $data[$k]['member'] = '';
	                    // 用户body_id
	                    $body_id = $v['body_id'];
	                    if($body_id)
	                    {
	                        $orderInfo = $this->Members_model->search('fu_order_info',array('order_user'=>$body_id));
	                        if($orderInfo)
	                        {
	                            $data[$k]['order'] = $orderInfo[0];
	                        }
	                    }
	                    // 业务员id
	                    $member_id = $v['user_member_id'];
	                    if($member_id)
	                    {
	                        $memberInfo = $this->Members_model->search('fu_member',array('member_id'=>$member_id));
	                        $data[$k]['member'] = $memberInfo[0];;
	                    }
	                }

	            }
	        }
	    }
	    
	    $view['type'] = $type;
	    $view['name'] = $name;
	    $view['res'] = $data;
	    $this->load->view('check', $view);
	}
	
    function addDateline()
    {
        $data['error'] = true;
        if(!$this->session->member_id){
            $data['msg'] = '请先登陆';
            die(json_encode($data));
        }
        $userId = intval($this->input->get_post('user_id'));
        if(!$userId || $userId < 0)
        {
            $data['msg'] = '非法操作';
            die(json_encode($data));
        }
        $param = array('user_id'=>$userId,'user_member_id'=>$this->session->member_id);
        $res = $this->Members_model->search('fu_user',$param);
        if(!$res)
        {
            $data['msg'] = '该用户不存在';
            die(json_encode($data));            
        }
        $userInfo = $res[0];
        if($userInfo['user_addtime'])
        {
            $data['msg'] = '该用户已经登记过报备时间了';
            die(json_encode($data));
        }
        $param = array();
        $where = array();
        $where = array('user_id'=>$userId);
        $param = array("user_datetime"=>time(),'user_addtime'=>1,'user_dateline'=>3600*24*10);
        $flag = $this->Members_model->updateUserInfo('fu_user',$param,$where);
        if($flag===false)
        {
            $data['msg'] = '增加报备时间失败';
            die(json_encode($data));
        }
        $data['error'] = false;
        $data['msg'] = '增加报备时间成功';
        $data['id'] = $userId;
        die(json_encode($data));        
    }

}