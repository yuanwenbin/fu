<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	// 身份证id
	private $bodyId = null;
	// 用户状态
	private $uflag = null;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Choice_model');
		$this->isUserLogin();
	}
	
	/**
	 * 禁止直接访问
	 */
	function index()
	{
		exit('error');
	}
	
	/**
	 * 验证传递的参数是否正确
	 * @param (bodyId) 身份证号
	 * flag = -1 身份证号码格式错误
	 */
	function isUserLogin()
	{
		$data = array();
		$data = array('error'=>1,'msg'=>'','flag'=>-1);
		// 身份证号码
		$bodyId = strip_addslashe($this->input->get_post('bodyId'));
		
		if(!$bodyId || (strlen($bodyId) != 15 && strlen($bodyId) != 18))
		{
			header('Content-type: application/json');
			$data['msg'] = '身份证号码不对';
			die(json_encode($data));
		}
		
		//$match = '/(^\d{14}$)|(^\d{17}](\d|X|x)$)/';
		$match = '/^\d{14}(\d|X|x)$/';
		$match_2 = '/^\d{17}(\d|X|x)$/';
		if(!preg_match($match, $bodyId) && !preg_match($match_2, $bodyId))
		{
			header('Content-type: application/json');
			$data['msg'] = '身份证号码不对';
			die(json_encode($data));
		}
		$this->bodyId = $bodyId;
		return true;
	}
	
	/**
	 * error = 0 成功
	 * error = 1 有误
	 *
	 * 以为当 error=0 即成功时有如下信息
	 * flag = 0 新用户 (uflag)
	 * flag = 1 有已经完成订单(uflag)
	 * flag = 2 有末支付的订单(uflag)
	 * flag = 3 随机用户，已经选择过一次(uflag)
	 */
	function checkUser()
	{
		$data = array();
		$data['error'] = 0;
		$data['msg'] = '';
		// 用户信息
		$customer = $this->Choice_model->searchUser('fu_user',array('body_id'=>$this->bodyId));
		// 如果存在
		if($customer)
		{
			// 用户ID
			$customerId = $customer['user_id'];
			/*
			 * 判断是否有订单及是否已经完成
			 */
			// 检测是否有订单
			$resInfo = $this->Choice_model->searchUser('fu_order_info',array('order_user'=>$this->bodyId));	
			// 如果有订单，且完成了的，则直接跳到订单详情
			if($resInfo)
			{
				// 有订单且完成
				if($resInfo['order_payment'] == 1)
				{
					$data['flag'] = 1;
					$this->uflag = 1;
 			 		// 订单详情
			 		$data['orderInfo'] = $resInfo;
			 		// 房间详情
			 		$roomInfo = $this->Choice_model->searchUser('fu_room_list',array('room_id'=>$resInfo['order_room_id']));
			 		$data['roomInfo'] = $roomInfo;
			 		// 牌位详情
			 		$posInfo = $this->Choice_model->searchUser('fu_location_list',array('localtion_id'=>$resInfo['order_location_id']));
			 		$data['posInfo'] = $posInfo;
			 		//用户详情
			 		$userInfo = $this->Choice_model->searchUser('fu_user',array('body_id'=>$resInfo['order_user']));
			 		$data['userInfo'] = $userInfo;
					return $data;
				}else
				{	
			 		// 订单有效时间
			 		$affectTime = time() - DATEHEADLINE;
			 		$order_datetime = $resInfo['order_datetime'];
			 		// 有详单，且失效,即当全新用户处理
			 		if($order_datetime < $affectTime)
			 		{
			 			// 保存入数据库，并删除,修改房间牌位状态,重置用户信息
			 			$table = 'fu_order_info_del_logs';
			 			$orderId = $resInfo['order_id'];
			 			unset($resInfo['order_id']);
			 			$param = $resInfo;
			 			$param['order_del_user'] = $this->bodyId;
			 			$param['order_del_time'] = time();
			 			// 插入删除日志表
			 			$affectRow = $this->Choice_model->insertOrder($table,$param);
			 			// 删除数据
			 			$this->Choice_model->delData('fu_order_info',array('order_id'=>$orderId));
			 			// 修改房间牌位状态
			 			$tableName = 'fu_location_list';
			 			$paramUpdate = array('location_number'=>2,'location_date'=>0);
			 			$where = array('localtion_id'=>$resInfo['order_location_id']);
			 			$this->Choice_model->changTable($tableName, $paramUpdate, $where);
			 				
			 			// 修改用户状态
			 			$paramUser = array('user_type'=>-1,'user_selected'=>0, 'user_selected_date'=>0, 'user_location_id'=>0);
			 			$whereUser = array('body_id'=>$this->bodyId);
			 			$this->Choice_model->changTable('fu_user', $paramUser, $whereUser);
						$this->uflag = 0;
						// 新用户
						$data = array('error'=>0,'msg'=>'成功登陆','flag'=>0);
						return $data;			 						 				 			
			 		}else
					{
			 			//有订单，且没支付
			 			$data['orderInfo'] = $resInfo;
			 			// 房间详情
			 			$roomInfo = $this->Choice_model->searchUser('fu_room_list',array('room_id'=>$resInfo['order_room_id']));
			 			$data['roomInfo'] = $roomInfo;
			 			// 牌位详情
			 			$posInfo = $this->Choice_model->searchUser('fu_location_list',array('localtion_id'=>$resInfo['order_location_id']));
			 			$data['posInfo'] = $posInfo;
			 			//用户详情
			 			$userInfo = $this->Choice_model->searchUser('fu_user',array('body_id'=>$resInfo['order_user']));
			 			$data['userInfo'] = $userInfo;
			 			// $customerId 为用户表自增id | $this->session->body_id 为身份证号码 | $this->session->customerId 为用户表的 user_id
						$data['flag'] = 2;
						$this->uflag = 2;
						return $data;
					}
				}
			}else
			{
	
			 	// 没有下个订单
			     $user_location_id = $customer['user_location_id'];
			     // 用户无选择过
			     if(!$user_location_id)
			     {
							// 新用户
							$data = array('error'=>0,'msg'=>'成功登陆','flag'=>0);
							$this->uflag = 0;
							return $data;
			     }else {
			         // 修改用户状态,如果此用户超过两小时，则为全新用户
			         $stopTime = time() - DATEHEADLINE;	
			         // 全新用户,选择过的，且失效	
			         if($customer['user_selected_date'] < $stopTime)
			         {		             
			             $paramUser = array('user_type'=>-1,'user_selected'=>0, 'user_selected_date'=>0, 'user_location_id'=>0);
			             // 修改牌位为未出售
			             $this->Choice_model->changTable('fu_location_list', array('location_number'=>2), array('localtion_id'=>$customer['user_location_id']));

									// 新用户
									$data = array('error'=>0,'msg'=>'成功登陆','flag'=>0);
									$this->uflag = 0;
									return $data;
			         }else {
									// 选择过的，且有效
									$paramUser = array('user_type'=>0,'user_selected_date'=>$customer['user_selected_date'], 'user_location_id'=>$customer['user_location_id']);
									$whereUser = array('body_id'=>$this->bodyId);
									$this->Choice_model->changTable('fu_user', $paramUser, $whereUser);	
									// 随机用户，有过选择的
									$data = array('error'=>0,'msg'=>'已经选择过一次了','flag'=>3);
									$this->uflag = 3;
									return $data;
			         }	 
	                 
			     }
			}


		}else
		{
			// 不存在,即全新的用户
			$data = array('error'=>1,'msg'=>'数据插入出错');
			$param = array();	
			$param['body_id'] = $this->bodyId;
			$param['user_datetime'] = time();
			$param['user_type'] = -1;
			$customerId = $this->Choice_model->insertOrder('fu_user',$param);
			if($customerId)
			{
				// 新用户
				$data = array('error'=>0,'msg'=>'成功登陆','flag'=>0);
				$this->uflag = 0;
			}else
			{
				$this->uflag = -1;	
			}
			
			return $data;
		}

	}
	
	/**
	 * 登陆
	 * error = 0 成功
	 * error = 1 有误
	 *
	 * 以为当 error=0 即成功时有如下信息
	 * flag = 0 新用户 (uflag)
	 * flag = 1 有已经完成订单(uflag)
	 * flag = 2 有末支付的订单(uflag)
	 * flag = 3 随机用户，已经选择过一次(uflag)
	 =============
	 {
    "error": 0,
    "msg": "成功登陆",
    "flag": 0
		}
		===========
		{
    "error": 0,
    "msg": "",
    "flag": 1,
    "orderInfo": {
        "order_id": "3",
        "order_user": "123455432112345543",
        "order_payment": "1",
        "order_status": "0",
        "order_admin": null,
        "order_room_id": "2",
        "order_location_id": "105",
        "order_location_type": "1",
        "order_datetime": "1447584992",
        "order_price": "8.88"
    },
    "roomInfo": {
        "room_id": "2",
        "room_number": "88",
        "room_flag": "1",
        "user_id": "1",
        "room_time": "1444731257",
        "room_full": "0",
        "room_alias": "大发房间",
        "room_description": "这是一个财运的房间，欢迎预订！！！"
    },
    "posInfo": {
        "localtion_id": "105",
        "location_room_id": "2",
        "location_price": "8.88",
        "location_details": null,
        "location_pic": "0",
        "location_type": "1",
        "location_number": "0",
        "location_date": "1447592192",
        "location_alias": null,
        "location_paytime": null,
        "location_ispayment": "0",
        "location_isshow": "1"
    },
    "userInfo": {
        "user_id": "4",
        "body_id": "123455432112345543",
        "user_location_id": "105",
        "user_type": "2",
        "user_selected": "2",
        "user_selected_date": "1447584992",
        "user_datetime": "1447584933",
        "user_name": "0",
        "user_birthday": "0",
        "user_time": "0"
    }
		}
		==================
	{
    "error": 0,
		"flag": 2
    "msg": "",
    "orderInfo": {
        "order_id": "16",
        "order_user": "987654321000000",
        "order_payment": "0",
        "order_status": "0",
        "order_admin": null,
        "order_room_id": "6",
        "order_location_id": "688",
        "order_location_type": "2",
        "order_datetime": "1448505591",
        "order_price": "9.90"
    },
    "roomInfo": {
        "room_id": "6",
        "room_number": "200",
        "room_flag": "1",
        "user_id": "1",
        "room_time": "1445393103",
        "room_full": "0",
        "room_alias": "测试房间",
        "room_description": "测试房间描述"
    },
    "posInfo": {
        "localtion_id": "688",
        "location_room_id": "6",
        "location_price": "9.90",
        "location_details": null,
        "location_pic": "0",
        "location_type": "0",
        "location_number": "1",
        "location_date": "1448512791",
        "location_alias": null,
        "location_paytime": null,
        "location_ispayment": "0",
        "location_isshow": "1"
    },
    "userInfo": {
        "user_id": "18",
        "body_id": "987654321000000",
        "user_location_id": "688",
        "user_type": "1",
        "user_selected": "2",
        "user_selected_date": "1448505591",
        "user_datetime": "1448505576",
        "user_name": "林小二",
        "user_birthday": "2015-11-26",
        "user_time": "2"
    }
	}
	=========
		{
    "error": 0,
    "msg": "已经选择过一次了",
    "flag": 3
		}
	 */
	function login()
	{
			$status = $this->checkUser();
			header('Content-type: application/json');			
			die(json_encode($status));
	}
	/**
	 * 与 login方法一样，订单详情页罢了
	 * @param $bodyId
	 */
	function details()
	{
	    $status = $this->checkUser();
	    header('Content-type: application/json');
	    die(json_encode($status));	    
	}
	/**
	 * 随机选号
		{
    "flag": 0,
    "error": 0,
    "msg": "随机选号页面"
		}
	 */
	 /*
	function byRand()
	{
		$status = $this->checkUser();
		if($this->uflag == 1 || $this->uflag == 2)
		{
			die(json_encode($status));
		}
		$data = array();
		$userInfo = $this->Choice_model->searchUser('fu_user', array('body_id'=>$this->bodyId));
		// 判断选择是否有过期的
		if($userInfo['user_selected_date'] < (time()-DATEHEADLINE))
		{
			$param['user_selected'] = 0;
			$param['user_selected_date'] = 0;
			$where = array('body_id'=>$this->bodyId, 'user_type'=>0);
			$this->Choice_model->changTable('fu_user', $param, $where);	
			$userInfo['user_selected'] = 0;
			$userInfo['user_selected_date'] = 0;
			$userInfo['user_type'] = 0;
		}
		$data['flag'] = 0;
	  $data['error'] = 0;
	  $data['msg'] = '随机选号页面';
		die(json_encode($data));
	}
	*/
	/**
	 * 随机选号处理
	 * error = 1,有错误观点
	 * error = 0，成功
	 * count = 1,还有一次机会,也可以提交
	 * count = 2 已经选择两次了，直接跳到详情页
	 */
	function byRandDo()
	{
		$status = $this->checkUser();
		if($this->uflag == 1 || $this->uflag == 2)
		{
			header('Content-type: application/json');
			die(json_encode($status));
		}

	 // 有选择过号，且有效
	 $userInfo = $this->Choice_model->searchUser('fu_user', array('body_id'=>$this->bodyId));
	 // 更新用户表
	 // $this->Choice_model->changTable('fu_user', array('user_selected'=>$userInfo['user_selected']+1), array('body_id'=>$this->bodyId));
	 // 生成号码
	 $randNo = $this->Choice_model->byRandModel();
	 if(!$randNo)
	 {
	 	 header('Content-type: application/json');
	     $data = array('error'=>1, 'msg'=>'没有了号码');
	     die(json_encode($data));
	 }
	 if(count($randNo)==1)
	 {
	     $arrIndex = 0;
	 }else {
	     $arrIndex = rand(0,count($randNo)-1);
	 }	
	 $data = array();
	 $data['error']=0;
	 // 选择的次数
	 $counts = $userInfo['user_selected']+1;
	 // 号码
	 $randoNumber = $randNo[$arrIndex]['localtion_id'];
	 // 查询牌位相关信息
	 $paramPos['localtion_id'] = $randoNumber;
	 $resPos = $this->Choice_model->searchUser('fu_location_list',$paramPos);
	 // 修改牌位状态
	 $this->Choice_model->changTable('fu_location_list', array('location_date'=>time(),'location_number'=>1), array('localtion_id'=>$randoNumber));
	 // 还有机会选择
	 if($counts < 2)
	 {
	     $data['count'] = 1;
	     $data['number'] = $randoNumber;
	     $data['flag'] = 0;
	     // 修改数据库用户表状态
	     $changeParams['user_selected'] = $data['count'];
	     $changeParams['user_selected_date'] =time();
	     // $changeParams['user_location_id'] =$randoNumber;
	     $changeParams['user_type'] =0;
	     //$this->Choice_model->changeApiModel($changeParams, $this->bodyId);
	     $this->Choice_model->changTable('fu_user', array('user_selected'=>1, 'user_type'=>0), array('body_id'=>$this->bodyId));
	     header('Content-type: application/json');
	     die(json_encode($data));    
	 }else {
	     // 已经选择两次了
	     $data['count'] = 2;
	     $data['number'] = $randoNumber;
	     $data['flag'] = 0;
	     // 选择过的牌位，恢复时间
	     $location_id = $userInfo['user_location_id'];
	     $this->Choice_model->changTable('fu_location_list', array('location_date'=>0,'location_number'=>2), array('localtion_id'=>$location_id));
	     $this->Choice_model->changTable('fu_user', array('user_selected'=>2,'user_location_id'=>$randoNumber,'user_selected_date'=>time(), 'user_type'=>0), array('body_id'=>$this->bodyId));
         // 插入订单
         $order = array();
	     $order['order_room_id'] = $resPos['location_room_id'];
	     $order['order_user'] = $this->bodyId;
	     $order['order_location_id'] = $randoNumber;
	     $order['order_location_type'] = 0; 
	     $order['order_datetime'] = time(); 
	     $order['order_price'] = $resPos['location_price'];
	     $this->Choice_model->insertOrder('fu_order_info',$order);
	     header('Content-type: application/json');
	     die(json_encode($data));  
	 }
	 
	}
	
    /**
     * 手动提交随机
     * $number 随机号
     */
	function randomSubmit()
	{
	    $status = $this->checkUser();
	    if($this->uflag == 1 || $this->uflag == 2)
	    {
	    	header('Content-type: application/json');
	        die(json_encode($status));
	    }	    
	    $bodyId = $this->bodyId;
	    $numberNo = $this->input->get_post('number');
	    // 查询牌位相关信息
	    $paramPos['localtion_id'] = $numberNo;
	    $resPos = $this->Choice_model->searchUser('fu_location_list',$paramPos);
	    // 插入订单
	    $order = array();
	    $order['order_room_id'] = $resPos['location_room_id'];
	    $order['order_user'] = $this->bodyId;
	    $order['order_location_id'] = $numberNo;
	    $order['order_location_type'] = 0;
	    $order['order_datetime'] = time();
	    $order['order_price'] = $resPos['location_price'];
	    $lastId = $this->Choice_model->insertOrder('fu_order_info',$order);
	    $data = array();
	    $data['flag'] = 0;
	    if($lastId)
	    {
	        $data['error'] = 0;
	        $data['msg'] = '成功提交';
	    }else {
	        $data['error'] = 1;
	        $data['msg'] = '提交失败';	      
	    }
	    $data['flag'] = 0;
	    header('Content-type: application/json');
	    die(json_encode($data));
	}
	
	/**
	 * 生辰八字
	 * $username,userbirth,stime
	 * $bodyId
	 */
	function byBirthday()
	{
	    $status = $this->checkUser();
	    if($this->uflag == 1 || $this->uflag == 2)
	    {
	    	header('Content-type: application/json');
	        die(json_encode($status));
	    }	
	    // 验证传递过来的三个字段，姓名，时辰，生日
	    $username = $this->input->get_post('username');
	    $userbirth = $this->input->get_post('userbirth');
	    $stime = $this->input->get_post('stime');
	    if(!$username || !$userbirth || !$stime)
	    {
	        $data = array('error'=>1, 'msg'=>'填写的姓名，时辰，生日不完整');
	        header('Content-type: application/json');
	        die(json_encode($data));
	    }
	    // 产生随机数
	    $randNo = $this->Choice_model->byRandModel();
	    if(!$randNo)
	    {
	        $data = array('error'=>1, 'msg'=>'没有相关号码了，请联系管理员！','flag'=>0);
	        header('Content-type: application/json');
	        die(json_encode($data));
	    }
	    if(count($randNo)==1)
	    {
	        $arrIndex = 0;
	    }else {
	        $arrIndex = rand(0,count($randNo)-1);
	    }
	    // 修改数据库用户表状态
	    $changeParams['user_selected'] = 2;
	    $changeParams['user_selected_date'] =time();
	    $changeParams['user_location_id'] =$randNo[$arrIndex]['localtion_id'];
	    $changeParams['user_type'] =1;
	    $changeParams['user_name'] =$username;
	    $changeParams['user_birthday'] =$userbirth;
	    $changeParams['user_time'] =$stime;
        // 修改数据库用户表状态
	    $this->Choice_model->changTable('fu_user',$changeParams,array('body_id'=>$this->bodyId));

	    // 修改牌位状态
	    $this->Choice_model->changTable('fu_location_list', array('location_date'=>time(),'location_number'=>1), array('localtion_id'=>$changeParams['user_location_id']));
	    
	    // 插入订单
	    // 查询牌位相关信息
	    $paramPos['localtion_id'] = $changeParams['user_location_id'];
	    $resPos = $this->Choice_model->searchUser('fu_location_list',$paramPos);
	    $order = array();
	    $order['order_room_id'] = $resPos['location_room_id'];
	    $order['order_user'] = $this->bodyId;
	    $order['order_location_id'] = $paramPos['localtion_id'];
	    $order['order_location_type'] = 2;
	    $order['order_datetime'] = time();
	    $order['order_price'] = $resPos['location_price'];
	    $lastId = $this->Choice_model->insertOrder('fu_order_info',$order);	 
	    $data = array();
	    $data['flag'] = 0;
	    if($lastId)
	    {
	        $data['error'] = 0;
	        $data['msg'] = '生辰八字提交成功';
	    }else {
	        $data['error'] = 1;
	        $data['msg'] = '生辰八字提交失败';	        
	    }
	    header('Content-type: application/json');
	    die(json_encode($data));
	}
	
	/**
	 * 高端定抽详情
	 * $bodyId
	 * $highNum 号码
	 */
	function byhigh()
	{
	    $status = $this->checkUser();
	    if($this->uflag == 1 || $this->uflag == 2)
	    {
	    	header('Content-type: application/json');
	        die(json_encode($status));
	    }	
	    $data = array();
	    $highNum = intval($this->input->get_post('highNum')); 
	    if(!$highNum)   
	    {
	        $data['error'] = 1;
	        $data['msg'] = '不存在该号码';
	        header('Content-type: application/json');
	        die(json_encode($data));
	    }
	    $data['flag'] = 0;
	    // 查询牌位相关信息
	    $paramPos['localtion_id'] = $highNum;
	    $resPos = $this->Choice_model->searchUser('fu_location_list',$paramPos);
	    // 查看详情
	    $roomInfos = $this->Choice_model->searchUser('fu_room_list',array('room_id'=>$resPos['location_room_id']));
	    $param = array('localtion_id'=>$highNum, 'location_type'=>1, 'location_isshow'=>1);
	    $posInfos = $this->Choice_model->searchUser('fu_location_list',$param);
	    $data['roomInfos'] = $roomInfos;
	    $data['posInfos'] = $posInfos;
	    $data['error'] = 0;
	    $data['msg']='号码详情';
	    header('Content-type: application/json');
	    die(json_encode($data));
	}
	
	/**
	 * 高端定制提交
	 */
	function byHighDo()
	{
	    $status = $this->checkUser();
	    if($this->uflag == 1 || $this->uflag == 2)
	    {
	    	header('Content-type: application/json');
	        die(json_encode($status));
	    }
	    $data = array();
	    $highNum = intval($this->input->get_post('highNum'));
	    if(!$highNum)
	    {
	        $data['error'] = 1;
	        $data['msg'] = '不存在该号码';
	        header('Content-type: application/json');
	        die(json_encode($data));
	    }
	    // 是否是正常未出售
	    $param = array('localtion_id'=>$highNum, 'location_type'=>1, 'location_number'=>2, 'location_isshow'=>1);
	    $posInfos = $this->Choice_model->searchUser('fu_location_list',$param);
	    
	    if(!$posInfos)
	    {
	        $data['error'] = 1;
	        $data['msg'] = '该号码已经被购买';
	        header('Content-type: application/json');
	        die(json_encode($data));
	    }	
	    // 1.插入订单表
	    $stime = time();
	    $orderParam = array('order_user'=>$this->bodyId,
	        'order_room_id'=>$posInfos['location_room_id'],
	        'order_location_id'=>$posInfos['localtion_id'],
	        'order_location_type'=>1,
	        'order_datetime'=>$stime,
	        'order_price'=>$posInfos['location_price']
	    );
	    $this->Choice_model->insertOrder('fu_order_info', $orderParam);
	    
	    // 2.修改用户表之前订过的牌位状态
	    $userPosInfos = $this->Choice_model->searchUser('fu_user',array('body_id'=>$this->bodyId));	    
	    if(!$userPosInfos['user_type'] && $userPosInfos['user_location_id'])
	    {
	        $userPosParam = array('location_number'=>2, 'location_date'=>0);
	        $this->Choice_model->changTable('fu_location_list', $userPosParam, array('localtion_id'=>$userPosInfos['user_location_id']));
	    }
	    // 3.修改用户表
	    $userParam = array('user_location_id'=>$posInfos['localtion_id'],
	        'user_type'=>2,
	        'user_selected'=>2,
	        'user_selected_date'=>$stime,
	    );
	    $this->Choice_model->changTable('fu_user', $userParam, array('body_id'=>$this->bodyId));
	    $posParam = array('location_number'=>1, 'location_date'=>$stime);
	    $this->Choice_model->changTable('fu_location_list', $posParam, array('localtion_id'=>$posInfos['localtion_id']));
	    
	    $data['flag'] = 0;
	    $data['error'] = 0;
	    $data['msg'] = '成功提交高端接口';
	    header('Content-type: application/json');
	    die(json_encode($data));
	}
	
}