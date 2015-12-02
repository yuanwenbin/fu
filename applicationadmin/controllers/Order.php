<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {
	private $source = array(1=>'pc',2=>'android',3=>'ois',4=>'wap');
	function __construct()
	{
		parent::__construct();
		$this->load->model('Order_model');
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
	
	function orderList()
	{  
	    if(!hasPerssion($_SESSION['role'], 'orderList')){
	        exit('点击左栏目操作');
	    }
	    
	    $view = array();
	    $param = array();
	    $page = $this->input->get_post('page');
	    if(!$page)
	    {
	        $page = 1;
	    }
	    // 房间号
	    $order_room_id = $this->input->get_post('order_room_id');
	    if(!$order_room_id)
	    {
	        $view['result']['order_room_id'] = '';
	    }else
	    {
	        $param['order_room_id'] = $order_room_id;
	        $view['result']['order_room_id'] = $order_room_id;
	    }
	    // 牌位类型   
	    $order_location_type = $this->input->get_post('order_location_type');
	   if(is_null($order_location_type) || $order_location_type == 'all')
	   {
	       $view['result']['order_location_type'] = 'all';
	   }elseif($order_location_type>0) {
	       $param['order_location_type'] = intval($order_location_type);
	       $view['result']['order_location_type'] = intval($order_location_type);
	   }else {
	       $param['order_location_type'] = intval($order_location_type);
	       $view['result']['order_location_type'] = '0';	       
	   }

	    // 支付状态
	    $order_payment = $this->input->get_post('order_payment');
        if(is_null($order_payment) || $order_payment == 'all')
        {
            $view['result']['order_payment']='all';
        }elseif(intval($order_payment) == 1) {
            $param['order_payment'] = intval($order_payment);
            $view['result']['order_payment'] = intval($order_payment);
        }else {
            $param['order_payment'] = intval($order_payment);
            $view['result']['order_payment'] = '0';
        }
	    
	    //开始时间
	    $datetime = $this->input->get_post('datetime');
        if($datetime)
        {
            $param['order_datetime']=strtotime($datetime);
            $view['result']['datetime'] = strtotime($datetime);;  
        }else {
            $view['result']['datetime'] = '';
        }
	    // 截止时间
	    $datetimes = $this->input->get_post('datetimes');
	
	    if($datetimes)
	    {
	        $param['order_datetimes']=strtotime($datetimes);
	        $view['result']['datetimes'] = strtotime($datetimes);
	    }else {
	        $view['result']['datetimes'] = '';
	    }
	   
	    // 身份号码
	    $bodyId = $this->input->get_post('bodyId');
	    if($bodyId)
	    {
	        $view['result']['bodyId'] = addslashes(trim(strip_tags($bodyId)));
	        $param['order_user'] = addslashes(trim(strip_tags($bodyId)));
	    }else {
	        $view['result']['bodyId'] = '';
	    }
	    $resultList = array();
        // 总数
	    $totalNumber = $this->Order_model->orderTotal($param);
	    if($totalNumber)
	    {
	      $totalPage = ceil($totalNumber/PAGESIZE); 
	      if($page > $totalPage) 
	      {
	          $page = $totalPage;
	      }
	      $resultList = $this->Order_model->orderList($param, $page,PAGESIZE);
	    }else {
	        $page = 0;
	        $totalPage = 0;
	    }
	    $view['result']['totalNumber'] = $totalNumber;

	    $view['result']['page'] = $page;
	    $view['result']['totalPage'] = $totalPage;
        $view['result']['resultList'] = $resultList; 
        $view['source'] = $this->source;
        $view['username'] = $this->session->userdata('admin_user');
	    $this->load->view('orderList',$view);
	}

	/**
	 * 订单查询
	 */
	function orderSearch()
	{
		$this->load->view('orderSearch');
	}
	
	/**
	 * 订单相关详情
	 */
	function posInfos()
	{  
	    if(!hasPerssion($_SESSION['role'], 'orderList')){
	        exit('点击左栏目操作,无权限');
	    }
	    $view = array();
	    $id = $this->input->get_post('id');
	    if(!$id || intval($id) < 0)
	    {
	        exit('非法操作');
	    }
	    // 订单信息
	    $orderInfo = $this->Order_model->posInfosModel('fu_order_info', array('order_id'=>$id));
	    // 牌位信息
	    $posInfo = $this->Order_model->posInfosModel('fu_location_list', array('localtion_id'=>$orderInfo[0]['order_location_id']));
	    // 用户信息
	    $userInfo = $this->Order_model->posInfosModel('fu_user', array('body_id'=>$orderInfo[0]['order_user']));
	    // 房间信息
	    $roomInfo = $this->Order_model->posInfosModel('fu_room_list', array('room_id'=>$orderInfo[0]['order_room_id']));
	    $view['result']['orderInfo'] = $orderInfo[0];
	    $view['result']['posInfo'] = $posInfo[0];
	    $view['result']['userInfo'] = isset($userInfo[0]) && $userInfo[0] ? $userInfo[0] : '';
	    $view['result']['roomInfo'] = $roomInfo[0];
	    
	    $stime[1] = '子时(23:00-00:59)';
	    $stime[2] = '丑时(01:00-02:59)';
	    $stime[3] = '寅时(03:00-04:59)';
	    $stime[4] = '卯时(05:00-06:59)';
	    $stime[5] = '辰时(07:00-08:59)';
	    $stime[6] = '巳时(09:00-10:59)';
	    $stime[7] = '午时(11:00-12:59)';
	    $stime[8] = '未时(13:00-14:59)';
	    $stime[9] = '申时(15:00-16:59)';
	    $stime[10] = '酉时(17:00-18:59)';
	    $stime[11] = '戌时(19:00-20:59)';
	    $stime[12] = '亥时(21:00-22:59)';
	    $view['result']['stime'] =  $stime;
	    $view['username'] = $this->session->userdata('admin_user');
	    
	    $this->load->view('posInfos', $view);
	}
	
	/**
	 * 修改订单支付状态
	 */
	function posInfosDeal()
	{
	    if(!hasPerssion($_SESSION['role'], 'posInfosDeal')){
	        exit('点击左栏目操作,无权限');
	    }	    
		// 牌位号
		$location_id = intval($this->input->get_post('location_id'));
		// 支付状态
		$order_payment = intval($this->input->get_post('order_payment'));	
		$param['location_id'] = $location_id;
		$param['order_payment'] = $order_payment;
		$param['order_id'] = intval($this->input->get_post('order_id'));
		$this->Order_model->posInfosDealModel($param);
		return true;
	}

}