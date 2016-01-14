<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Choice extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Choice_model');
	}
	// 是否登陆了
	function userIsLogin()
	{
		// 判断是否有业务员登陆了
		if(!$this->session->member_id)
		{
			header("Location:/Index/member");
			exit;
		}
		// 判断是否登陆了		
	    if(!$this->session->body_id)
	    {
	        header("Location:/Index/index");
	        exit;
	    }	
	}
	
	/**
	 * @deprecated 0-末登陆,1-新用户,2-有选择过的，且有效,3-有末支付的订单,4-有已经支付的订单
	 * 订单状态
	 */ 
	function orderStatus()
	{
		// 未登陆
		if(!$this->session->body_id)
		{
			return 0;
		}
		// 已经登陆，但已经有支付的订单
		if($this->session->is_complete)
		{
		    return 4;
		}
		// 已经登陆，但有未支付订单
		if(!$this->session->is_complete && ($this->session->is_choice == 2))
		{
			return 3;
		}
		// 选择过的，且有效
		if(!$this->session->is_complete && ($this->session->is_choice == 1))
		{
			return 2;
		}		
		// 新用户
		return 1;
	}
	/**
	 *  A.新用户(x) [isNew = 1, is_complete = 0,is_choice = 0]
        B.老用户
        	B-1.有订单
        		B-1-1.有已经支付完成的订单	(x)[isNew = 0, is_complete = 1, is_choice = 3]
        		B-1-2.有效订单且未支付	(x)  [isNew = 0, is_complete = 0,is_choice = 2]
        		B-1-3.无效的订单	(x) [isNew = 1, is_complete = 0,is_choice = 0] (全新用户了)
        	B-2.无订单(当作随机用)
        		B-2-1.进行过选择，且有效 [isNew = 0, is_complete = 0,is_choice = 1]
        		B-2-2.进行过选择，且无效 (x) [isNew = 1, is_complete = 0,is_choice = 0] (全新用户了)
        		B-2-3.没有进行过选择 [isNew = 1, is_complete = 0,is_choice = 0] (全新用户了)
	 */
	public function index()
	{	
		// 是否已经合法跳转
		$this->userIsLogin();
		// 用户信息
		$customer = $this->Choice_model->searchUser('fu_user',array('body_id'=>$this->session->body_id));
		 
		// 如果存在
		if($customer)
		{	
			$customerId = $customer['user_id'];
			/**
			 * 判断是否有订单及是否已经完成
			 */
			// 检测是否有订单
			 $resInfo = $this->Choice_model->searchUser('fu_order_info',array('order_user'=>$this->session->body_id));	
			 // 如果有订单，且完成了的，则直接跳到订单详情
			 if($resInfo)
			 {	
			 	// 有订单且完成
			 	if($resInfo['order_payment'] == 1)
			 	{
			 		// 订单详情
			 		$view['orderInfo'] = $resInfo;
			 		// 房间详情
			 		$roomInfo = $this->Choice_model->searchUser('fu_room_list',array('room_id'=>$resInfo['order_room_id']));
			 		$view['roomInfo'] = $roomInfo;
			 		// 牌位详情
			 		$posInfo = $this->Choice_model->searchUser('fu_location_list',array('localtion_id'=>$resInfo['order_location_id']));
			 		$view['posInfo'] = $posInfo;
			 		//用户详情
			 		$userInfo = $this->Choice_model->searchUser('fu_user',array('body_id'=>$resInfo['order_user']));
			 		$view['userInfo'] = $userInfo;
			 		// $customerId 为用户表自增id | $this->session->body_id 为身份证号码 | $this->session->customerId 为用户表的 user_id
			 		$data = array(
			 				'customerId'=>$userInfo['user_id'],
			 				'body_id'=>$this->session->body_id,
			 				'user_location_id'=>$resInfo['order_location_id'],
			 				'user_type'=>$userInfo['user_type'],
			 				'user_selected'=>2,
			 				'user_selected_date'=>$userInfo['user_selected_date'],
			 				'isNew' => 0,
			 				'is_complete' => 1,
			 		        'is_choice'=>3
			 		);
			 		$this->session->set_userdata($data);			 			
			 		$result['result'] = $view;  
			 		$this->load->view('complete', $result);			 		
			 	}else {
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
			 			$param['order_del_user'] = $this->session->body_id;
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
			 			$whereUser = array('body_id'=>$this->session->body_id);
			 			$this->Choice_model->changTable('fu_user', $paramUser, $whereUser);
			 		
			 			// session
			 			$data = array(
			 					'customerId'=>$customer['user_id'],
			 					'body_id'=>$this->session->body_id,
			 					'user_location_id'=>0,
			 					'user_type'=>0,
			 					'user_selected'=>0,
			 					'user_selected_date'=>0,
			 					'isNew' => 1,
			 					'is_complete' => 0,
			 			        'is_choice'=>0
			 			);
			 			$this->session->set_userdata($data);
			 			header("Location:/Choice/byRand");exit();
			 			$this->load->view('newUser');
			 				 			
			 		}else {
			 			//有订单，且没支付
			 			$view['orderInfo'] = $resInfo;
			 			// 房间详情
			 			$roomInfo = $this->Choice_model->searchUser('fu_room_list',array('room_id'=>$resInfo['order_room_id']));
			 			$view['roomInfo'] = $roomInfo;
			 			// 牌位详情
			 			$posInfo = $this->Choice_model->searchUser('fu_location_list',array('localtion_id'=>$resInfo['order_location_id']));
			 			$view['posInfo'] = $posInfo;
			 			//用户详情
			 			$userInfo = $this->Choice_model->searchUser('fu_user',array('body_id'=>$resInfo['order_user']));
			 			$view['userInfo'] = $userInfo;
			 			// $customerId 为用户表自增id | $this->session->body_id 为身份证号码 | $this->session->customerId 为用户表的 user_id
			 			$data = array(
			 					'customerId'=>$userInfo['user_id'],
			 					'body_id'=>$this->session->body_id,
			 					'user_location_id'=>$resInfo['order_location_id'],
			 					'user_type'=>$userInfo['user_type'],
			 					'user_selected'=>$userInfo['user_selected'],
			 					'user_selected_date'=>$userInfo['user_selected_date'],
			 					'isNew' => 0,
			 					'is_complete' => 0,
			 			        'is_choice'=>2
			 			);
			 			$this->session->set_userdata($data);
			 			$result['result'] = $view; 
			 			$this->load->view('uncomplete', $result);
			 					 			
			 		}			 					 		
			 	}			
			 	 	
			 }else 
			 {	
			 	// 没有下个订单
			     $user_location_id = $customer['user_location_id'];
			     // 用户无选择过
			     if(!$user_location_id)
			     {
			         $data = array(
			             'customerId'=>$customerId,
			             'body_id'=>$this->session->body_id,
			             'user_location_id'=>$customer['user_location_id'],
			             'user_type'=>0,
			             'user_selected'=>0,
			             'user_selected_date'=>0,
			             'isNew' => 1,
			             'is_complete' => 0,
			             'is_choice'=>0
			         );
			         $this->session->set_userdata($data);
			         header("Location:/Choice/byRand");exit();
			         $this->load->view('newUser');
			     }else {
			         // 修改用户状态,如果此用户超过两小时，则为全新用户
			         $stopTime = time() - DATEHEADLINE;	
			         // 全新用户,选择过的，且失效	
			         if($customer['user_selected_date'] < $stopTime)
			         {
			             $data = array(
			                 'customerId'=>$customerId,
			                 'body_id'=>$this->session->body_id,
			                 'user_location_id'=>0,
			                 'user_type'=>0,
			                 'user_selected'=>0,
			                 'user_selected_date'=>0,
			                 'isNew' => 1,
			                 'is_complete' => 0,
			                 'is_choice'=>0
			             );
			             $this->session->set_userdata($data);			             
			             $paramUser = array('user_type'=>-1,'user_selected'=>0, 'user_selected_date'=>0, 'user_location_id'=>0);
			             // 修改牌位为未出售
			             $this->Choice_model->changTable('fu_location_list', array('location_number'=>2,'location_date'=>0), array('localtion_id'=>$customer['user_location_id']));
			         }else {
			         	// 选择过的，且有效
			             $paramUser = array('user_type'=>0,'user_selected_date'=>$customer['user_selected_date'], 'user_location_id'=>$customer['user_location_id']);
			             $data = array(
			                 'customerId'=>$customerId,
			                 'body_id'=>$this->session->body_id,
			                 'user_location_id'=>$customer['user_location_id'],
			                 'user_type'=>0,
			                 'user_selected'=>$customer['user_selected'],
			                 'user_selected_date'=>0,
			                 'isNew' => 0,
			                 'is_complete' => 0,
			                 'is_choice'=>1
			             );
			             $this->session->set_userdata($data);
			         }	 
			         $whereUser = array('body_id'=>$this->session->body_id);
			         $this->Choice_model->changTable('fu_user', $paramUser, $whereUser);
			         header("Location:/Choice/byRand");exit();
			         $this->load->view('newUser');			                 
			     }
			 	/*
			 	$data = array(
			 			'customerId'=>$customerId,
			 			'body_id'=>$this->session->body_id,
			 			'user_location_id'=>$customer['user_location_id'],
			 			'user_type'=>0,
			 			'user_selected'=>$customer['user_selected'],
			 			'user_selected_date'=>0,
			 			'isNew' => 1,
			 			'is_complete' => 0
			 	);
			 	$this->session->set_userdata($data);
	 			// 修改用户状态,如果此用户超过两小时，则为全新用户
	 			$stopTime = time() - DATEHEADLINE;
	 			if($customer['user_datetime'] < $stopTime)
	 			{
	 				$paramUser = array('user_type'=>0,'user_selected'=>0, 'user_selected_date'=>0, 'user_location_id'=>0);
	 			}else {
	 				$paramUser = array('user_type'=>0,'user_selected'=>$customer['user_selected'], 'user_selected_date'=>0, 'user_location_id'=>$customer['user_location_id']);
	 			}
	 			$whereUser = array('body_id'=>$this->session->body_id);
	 			$this->Choice_model->changTable('fu_user', $paramUser, $whereUser);
			 	$this->load->view('newUser');	
			 	*/		 	
			 }			 		
		}else {	
			// 不存在,即全新的用户
			$param = array();	
			$param['body_id'] = $this->session->body_id;
			$param['user_datetime'] = time();
			$param['user_type'] = -1;
			$param['user_member_id'] = $this->session->member_id;
			$param['user_team_id'] = $this->session->member_team_id;
			$customerId = $this->Choice_model->insertOrder('fu_user',$param);
			if($customerId)
			{
				// session
				$data = array(
						'customerId'=>$customerId,
						'body_id'=>$this->session->body_id,
						'user_location_id'=>0,
						'user_type'=>0,
						'user_selected'=>0,
						'user_selected_date'=>0,
						'isNew' => 1,
						'is_complete' => 0,
				        'is_choice'=>0
				);
				$this->session->set_userdata($data);
				header("Location:/Choice/byRand");exit();
				$this->load->view('newUser');
			}else {
				exit('error!');
			}			
		}
		
		
		
		
	}
	
	/**
	 * 号码详情
	 */
	/*
	function byDetail()
	{
		$status = $this->orderStatus();
		if($status != 1)
		{
			header("Location:/Index/index");
		}	
		$userInfo = $this->Choice_model->searchUser('fu_user', array('body_id'=>$this->session->body_id));
		
		// 没选号
		if(!$userInfo['user_location_id'])
		{
			header("Location:/Index/index");
		}
		// 查询牌位
		$posInfo = $this->Choice_model->searchUser('fu_location_list', array('localtion_id'=>$userInfo['user_location_id']));
		// 查询房间
		$roomInfo = $this->Choice_model->searchUser('fu_room_list', array('room_id'=>$posInfo['location_room_id']));
		$view['result']['posInfo'] = $posInfo;
		$view['result']['roomInfo'] = $roomInfo;
		$this->load->view('submit', $view);
	}
	*/	
	/**
	 * 随机选号展示,以价格为准
	 */
	function byRand_bak()
	{	
	   // 是否已经合法跳转
	   $status = $this->orderStatus();
	   if($status && $status < 3)
	   {
	   		$userInfo = $this->Choice_model->searchUser('fu_user', array('body_id'=>$this->session->body_id));
	   		// 判断选择是否有过期的
	   		if($userInfo['user_selected_date'] < (time()-DATEHEADLINE))
	   		{
	   			$param['user_selected'] = 0;
	   			$param['user_selected_date'] = 0;
	   			$where = array('body_id'=>$this->session->body_id, 'user_type'=>0);
	   			$this->Choice_model->changTable('fu_user', $param, $where);	
	   			$userInfo['user_selected'] = 0;
	   			$userInfo['user_selected_date'] = 0;
	   			$userInfo['user_type'] = 0;
	   		}
	   		$view['userInfo'] = $userInfo;
	   		// 高端定位是否验证
	   		if($this->session->highFlag)
	   		{
				$view['highFlag'] = 1;
	   		}else {
	   			$view['highFlag'] = 0;
	   		}
	   		// 价格归档是否选择
	   		if($this->session->price)
	   		{	
	   			//设置过
	   			$view['maxPrice'] = $this->session->maxPrice;
	   			$view['price'] = 1;
	   		}else {
	   			// 没有设置过
	   			$view['price'] = 0;
	   			$view['maxPrice'] = -1;
	   		}
	   		$view['priceList'] = $this->checkPrice();
	   		
	   		$this->load->view('byRand',$view); 
	   }else {
	   		header("Location:/Index/index");
	   		exit;
	   }
	}
	
	/**
	 * 随机选号展示,以房间号为准
	 */
	function byRand()
	{
		// 是否已经合法跳转
		$status = $this->orderStatus();
		if($status && $status < 3)
		{
			$userInfo = $this->Choice_model->searchUser('fu_user', array('body_id'=>$this->session->body_id));
			// 判断选择是否有过期的
			if($userInfo['user_selected_date'] < (time()-DATEHEADLINE))
			{
				$param['user_selected'] = 0;
				$param['user_selected_date'] = 0;
				$where = array('body_id'=>$this->session->body_id, 'user_type'=>0);
				$this->Choice_model->changTable('fu_user', $param, $where);
				$userInfo['user_selected'] = 0;
				$userInfo['user_selected_date'] = 0;
				$userInfo['user_type'] = 0;
			}
			$view['userInfo'] = $userInfo;
			// 高端定位是否验证
			if($this->session->highFlag)
			{
				$view['highFlag'] = 1;
			}else {
				$view['highFlag'] = 0;
			}
			/*
			// 价格归档是否选择
			if($this->session->price)
			{
				//设置过
				$view['price'] = 1;
			}else {
				// 没有设置过
				$view['price'] = 0;
				$view['maxPrice'] = -1;
			}
			*/
			//房间号选择
			if($this->session->room_id)
			{
				//设置过
				$view['room_id'] = $this->session->room_id;
			}else {
				// 没有设置过
				$view['room_id'] = 0;
			}			
			$view['roomList'] = $this->checkRoom();
			$this->load->view('byRand',$view);
		}else {
			header("Location:/Index/index");
			exit;
		}
	}	
	/**
	 * 随机选号处理
	 */
	function byRandDo()
	{
		// 是否是非法操作
		if(!$this->orderStatus())
	    {
	        $arr = array('error'=>1, 'msg'=>'请先登陆!', 'count'=>3);
	        die(json_encode($arr));
	    }
	   
	    if($this->orderStatus() > 2)
	    {
	    	$arr = array('error'=>1, 'msg'=>'你已经选择过号码了！', 'count'=>3);
	    	die(json_encode($arr));	    	
	    }	 
	    $data = array('error'=>1, 'msg'=>'没有相关号码了，请联系管理员！', 'count'=>0, 'isjump'=>0);
		//禁止非随机用户访问
       if($this->session->user_type)
       {
       	if($this->session->user_type  == 1)
       	{
       		$data['msg'] = '你不是随机用户,而是生辰八字用户!';
       	}else {
       		$data['msg'] = '你不是随机用户,而是高端用户!';
       	}
       	$data['count'] = 3;
       	die(json_encode($data));
       }
      
       // 有选择过号，且有效
       $userInfo = $this->Choice_model->searchUser('fu_user', array('body_id'=>$this->session->body_id));
             
       // $this->session->set_userdata($param);
       $data['count'] = $userInfo['user_selected'];	
       $data['randThird'] = $this->session->randThird;
       if($userInfo['user_selected'] == 3)
       {
	       	$data['msg'] = '成功选择3次';
	       	$data['count'] = 3;
	       	$data['error'] = 0;
	       	die(json_encode($data));
       }else {
	       	if($data['count'] == 2)
	       	{
	       		$randThird = $this->session->randThird;
	       		if(!$randThird)
	       		{
	       			$data['msg'] = '先验证';
	       			$data['error'] = 0;
	       			die(json_encode($data));
	       		}
	       	}       	
       	    // 更新用户表 
       		$this->Choice_model->changTable('fu_user', array('user_selected'=>$userInfo['user_selected']+1), array('body_id'=>$this->session->body_id));
       		$data['count'] = $userInfo['user_selected']+1;
       }

       $randNo = $this->Choice_model->byRandModel($this->session->room_id);
   
       if(!$randNo)
       {
           die(json_encode($data));
       }
       if(count($randNo)==1)
       {
       		$arrIndex = 0;
       }else {
       		$arrIndex = rand(0,count($randNo)-1);
       }
     
       $data['error'] = 0;
       // $data['msg'] = $randNo[$arrIndex]['localtion_id'];
       $data['msg'] = $randNo[$arrIndex];
       // 修改数据库用户表状态
       $changeParams['user_selected'] = $data['count'];
       $changeParams['user_selected_date'] =time();	
    
       $changeParams['user_location_id'] =$randNo[$arrIndex]['localtion_id'];
       
       
       $changeParams['user_type'] =0;
       $this->Choice_model->byRandChangeModel($changeParams, $this->session->customerId);
       die(json_encode($data));
	}
	

	/**
	 * 随机用户提交
	 */
	function byRandSubmit()
	{
		// 是否已经合法跳转
		$status = $this->orderStatus();
		// 一定要是新用户
		/*
		if(!$status || $status > 2)
		{
			header("Location:/Index/index");
			exit;
		}
		*/
		if(!$status)
		{
		    header("Location:/Index/index");
		    exit;
		}		
		//禁止非随机用户访问 
		if($this->session->user_type)
		{
			header("Location:/Index/index");
			exit;
		}
		$customerId = $this->session->customerId;
		$fields = array('user_id'=>$customerId);
		$res = $this->Choice_model->searchUser('fu_user', $fields);
	
		// 没有相关用户时
		if(!$res)
		{
			header("Location:/Index/index");
			exit;
		}
		
		// 是否有订单
		$orderParam = array('order_user'=>$this->session->body_id);
		$orderInfo = $this->Choice_model->searchUser('fu_order_info', $orderParam);
		
		if($orderInfo)
		{
			// 已经有预订的,则判断是否有效订单,
			$affectTime = $orderInfo['order_datetime'] + DATEHEADLINE - time();

			// 订单失效
			if(!$orderInfo['order_status'] && $affectTime < 0)
			{
				header("Location:/Index/index");
				exit;
			}
			$fieldsRoom = array('localtion_id'=>$orderInfo['order_location_id']);
			$room_result = $this->Choice_model->searchUser('fu_location_list', $fieldsRoom);
	
			$view['fu_location_list'] = $room_result;
			$view['order'] = $orderInfo;
			$user_type = '随机用户';
			if($this->session->user_type == 1){
				$user_type = '生辰八字';
			}elseif($this->session->user_type == 2)
			{
				$user_type = '高端定制';
			}
			$view['user_type'] = $user_type;
			$view['tips'] = '你已经成功预订过了，请尽快付款';
			$result['result'] = $view;
			header("Location:/Choice/index");
			exit;
			$this->load->view('success', $result);
		}else {
			$fieldsRoom = array('localtion_id'=>$res['user_location_id']);
			$room_result = $this->Choice_model->searchUser('fu_location_list', $fieldsRoom);
			// 没有牌位
			if(!$room_result)
			{
				header("Location:/Index/index");
				exit;
			}
	
			$param = array();
			$param['order_user'] = $this->session->body_id;
			$param['order_room_id'] = $room_result['location_room_id'];
			$param['order_location_id'] = $res['user_location_id'];
			$param['order_location_type'] = $this->session->user_type;
			$param['order_datetime'] = time();
			$param['order_price'] = $room_result['location_price'];
			$affectRes = $this->Choice_model->insertOrder('fu_order_info',$param);
			if($affectRes)
			{
				$view['fu_location_list'] = $room_result;
				$view['order'] = $param;
				$user_type = '随机用户';
				if($this->session->user_type == 1){
					$user_type = '生辰八字';
				}elseif($this->session->user_type == 2)
				{
					$user_type = '高端定制';
				}
				$view['user_type'] = $user_type;
				$view['tips'] = '成功预订，请尽快付款';
				$result['result'] = $view;
				header("Location:/Choice/index");
				exit;
				// 此时提示成功，点击查看，即可返回 /Choice/index 
				$this->load->view('success', $result);
			}else
			{
			    header("Location:/Index/index");
			    exit;
				$this->load->view('error');
			}
			 
		}
	}
    /**
     * 完成的订单
     * @param string $table 表名
     * @param array $param 条件数组
     * @return true 为有订单,false为无订单
     */
	function orderComplete($table, $param)
	{  
		$this->userIsLogin();
	    return $this->Choice_model->searchUser($table,$param);  
	}
	
	/**
	 * 未完成的订单
	 * @param string $table 表名
	 * @param array $where 条件数组
	 * @return true 为有订单，false 为无订单
	 */
	function orderUncomplete($table,$where)
	{  
		$this->userIsLogin();
	    return $this->Choice_model->searchUncompleteOrder($table,$where);
	}

	/**
	 * 生辰八字
	 */
	function byEight()
	{
	    // 是否已经登陆
	    $status = $this->orderStatus();
	    //末登陆
	    if(!$status)
	    {  
	        header("Location:/Index/index");
	        exit;
	    }
	    if($status > 2)
	    {
	        header("Location:/Choice/index");
	        exit;	        
	    }
	    // 有完成订单
	    $completeParam = array('order_user'=>$this->session->body_id, 'order_payment'=>1);
	    $orderComplete = $this->orderComplete('fu_order_info', $completeParam);

	    if($orderComplete)
	    {
	        header("Location:/Choice/index");
	        exit;
	    }  
	    // 有末完成订单
	    $uncompleteParam = " order_user = '" . $this->session->body_id ."' and order_payment =0 and order_datetime > " . (time()-DATEHEADLINE);
	 
	    $orderUncomplete = $this->orderUncomplete('fu_order_info', $uncompleteParam);

 	    if($orderUncomplete)
	    {
	        header("Location:/Choice/index");
	        exit;
	    }
	    //从此开始书写八字内容
	    $view = array();
	    $view['body_id'] = $this->session->body_id;
	    $userInfo = $this->Choice_model->searchUser('fu_user', array('body_id'=>$this->session->body_id));
	    if($userInfo)
	    {
	        $view['user_name'] = $userInfo['user_name'];
	        $view['user_birthday'] = $userInfo['user_birthday'];
	        $view['user_time'] = $userInfo['user_time'];
	    }
	    // 判断选择是否有过期的
	    if($userInfo['user_selected_date'] < (time()-DATEHEADLINE))
	    {
	        $param['user_selected'] = 0;
	        $param['user_selected_date'] = 0;
	        $where = array('body_id'=>$this->session->body_id, 'user_type'=>0);
	        $this->Choice_model->changTable('fu_user', $param, $where);
	        $userInfo['user_selected'] = 0;
	        $userInfo['user_selected_date'] = 0;
	        $userInfo['user_type'] = 0;
	    }
	    if($this->session->highFlag)
	    {
	    	$view['highFlag'] = 1;
	    }else {
	    	$view['highFlag'] = 0;
	    }	
		/*
	    // 价格归档是否选择
	    if($this->session->price)
	    {
	        //设置过
	        $view['maxPrice'] = $this->session->maxPrice;
	        $view['price'] = 1;
	    }else {
	        // 没有设置过
	        $view['price'] = 0;
	        $view['maxPrice'] = -1;
	    }
	    $view['priceList'] = $this->checkPrice();	
	    */  
	    //房间号选择
	    if($this->session->room_id)
	    {
	    	//设置过
	    	$view['room_id'] = $this->session->room_id;
	    }else {
	    	// 没有设置过
	    	$view['room_id'] = 0;
	    }
	    $view['roomList'] = $this->checkRoom();	      
	   $this->load->view('byEight', $view);
	}
	
	/**
	 * 生辰八字处理
	 */
	function byEightDeal()
	{
	    $data = array('error'=>1, 'msg'=>'你已经选择过了!');
		// 验证传递过来的三个字段，姓名，时辰，生日
		$username = $this->input->get_post('username');
		$userbirth = $this->input->get_post('userbirth');
		$stime = $this->input->get_post('stime');
		if(!$username || !$userbirth || !$stime)
		{
		    $data = array('error'=>1, 'msg'=>'填写的姓名，时辰，生日不完整');
			die(json_encode($data));			
		}

		// 是否已经登陆
		$status = $this->orderStatus();
		//末登陆
		if(!$status  || $status > 2)
		{
            die(json_encode($data));
		}
		// 有完成订单
		$completeParam = array('order_user'=>$this->session->body_id, 'order_payment'=>1);
		$orderComplete = $this->orderComplete('fu_order_info', $completeParam);
		
		if($orderComplete)
		{
            die(json_encode($data));
		}
		// 有末完成订单
		$uncompleteParam = " order_user = " . $this->session->body_id ." and order_payment =0 and order_datetime > " . (time()-DATEHEADLINE);
		$orderUncomplete = $this->orderUncomplete('fu_order_info', $uncompleteParam);
		if($orderUncomplete)
		{
            die(json_encode($data));
		}
		// 接收处理
		// 产生随机数	
		$randNo = $this->Choice_model->byRandModel($this->session->room_id);
		if(!$randNo)
		{
		    $data = array('error'=>1, 'msg'=>'没有相关号码了，请联系管理员！');
		    die(json_encode($data));
		}
		if(count($randNo)==1)
		{
		    $arrIndex = 0;
		}else {
		    $arrIndex = rand(0,count($randNo)-1);
		}
		$data['error'] = 0;
		$data['msg'] = $randNo[$arrIndex]['localtion_id'];
		// 修改数据库用户表状态
		$changeParams['user_selected'] = 2;
		$changeParams['user_selected_date'] =time();
		$changeParams['user_location_id'] =$randNo[$arrIndex]['localtion_id'];
		$changeParams['user_type'] =1;
		$changeParams['user_name'] =$username;
		$changeParams['user_birthday'] =$userbirth;
		$changeParams['user_time'] =$stime;
		// 修改session
		$sessParam = array('is_complete'=>0,
							'is_choice'=>2);
		$this->session->set_userdata($sessParam);	
		// 修改用户状态，牌位信息
		$this->Choice_model->byRandChangeModel($changeParams, $this->session->customerId);
		// 插入订单表
		$fieldsRoom = array('localtion_id'=>$randNo[$arrIndex]['localtion_id']);
		$room_result = $this->Choice_model->searchUser('fu_location_list', $fieldsRoom);		
		$param = array();
		$param['order_user'] = $this->session->body_id;
		$param['order_room_id'] = $room_result['location_room_id'];
		$param['order_location_id'] = $randNo[$arrIndex]['localtion_id'];
		$param['order_location_type'] = 2;
		$param['order_datetime'] = time();
		$param['order_price'] = $room_result['location_price'];
		$affectRes = $this->Choice_model->insertOrder('fu_order_info',$param);		
        $data = array('error'=>0,'msg'=>'成功选择了');
		die(json_encode($data));
	}
	
	/**
	 * 房间号列表
	 * @param unknown $roomId
	 * @param array $param 
	 */
	function roomList($tableName, $param)
	{
		// 是否已经登陆
		$status = $this->orderStatus();
		//末登陆
		if(!$status)
		{
			header("Location:/Index/index");
			exit;
		}		
		$res = $this->Choice_model->searchMulti($tableName,$param);
		return $res;
	}
	
	
	
	/**
	 * 高端定制
	 */
	function byHigh()
	{
	    // 是否已经登陆
	    $status = $this->orderStatus();
	    //末登陆,有订单
	    if(!$status)
	    {
	        header("Location:/Index/index");
	        exit;
	    }
	
	    if(!($this->session->highFlag))
	    {	
	        header("Location:/Choice/byRand");
	        exit;
	    }
	    /*
	    if(!$status || $status > 2)
	    {
	        header("Location:/Index/index");
	        exit;
	    }	
	    */

	    // 有完成订单
	    $completeParam = array('order_user'=>$this->session->body_id, 'order_payment'=>1);
	    $orderComplete = $this->orderComplete('fu_order_info', $completeParam);
	 
	    if($orderComplete)
	    {
	        header("Location:/Choice/index");
	        exit;
	    }
	   
	    // 有末完成订单
	    $uncompleteParam = " order_user = '" . $this->session->body_id ."' and order_payment =0 and order_datetime > " . (time()-DATEHEADLINE);
	   
	    $orderUncomplete = $this->orderUncomplete('fu_order_info', $uncompleteParam);
	
	    if($orderUncomplete)
	    {
	        header("Location:/Choice/index");
	        exit;
	    }	    
        //从此开始书写高端内容
        // 查询高端定制座位
        // 房间是否开启
        $roomList = $this->roomList('fu_room_list', array('room_flag'=>1,'room_type'=>1));
        if($roomList)
        {
        	$roomIds = array();
        	$roomInfos = array();
        	foreach($roomList as $v)
        	{
        		$roomIds[] = $v['room_id'];
        		$roomInfos[$v['room_id']] = $v['room_alias'];
        	}
        	$roomId = $this->input->get_post('roomId');
        	if(!$roomId)
        	{
        		$roomId = $roomIds[0];
        	}
        	// 判断是否合格的房间
        	if(!in_array($roomId, $roomIds))
        	{
        		$roomId = $roomIds[0];
        	}
        	
        	$tableName = "fu_location_list";
        	$param = array('location_type'=>1, 'location_room_id'=>$roomId);
        	// $res = $this->Choice_model->searchMulti($tableName,$param);searchMultiFields
        	$fields = " localtion_id,location_number ";
        	// $price = array('minPrice' =>$this->session->minPrice, 'maxPrice' =>$this->session->maxPrice);
        	$res = $this->Choice_model->searchMultiFields($tableName,$param,$fields);
        	$view['roomList'] = $roomIds;
        	$view['roomId'] = $roomId;
        	$view['roomInfos'] = $roomInfos;
        	$view['result'] = $res; 
        	/*
        	// 价格归档是否选择
        	if($this->session->price)
        	{
        		//设置过
        		$view['maxPrice'] = $this->session->maxPrice;
        		$view['price'] = 1;
        	}else {
        		// 没有设置过
        		$view['price'] = 0;
        		$view['maxPrice'] = -1;
        	}
        	$view['priceList'] = $this->checkPrice();	
        	*/
        	//房间号选择
        	if($this->session->room_id)
        	{
        		//设置过
        		$view['room_id'] = $this->session->room_id;
        	}else {
        		// 没有设置过
        		$view['room_id'] = 0;
        	}
        	// $view['roomList'] = $this->checkRoom(1);   
        	     	
        	$this->load->view('byHigh', $view);        	
        }else {
        	// 没有相关房间
        	$this->load->view('error');
        }

    
	}
	
	/**
	 * 牌位详情,定制
	 */
	function locationDetail()
	{
		// 是否已经登陆
		$status = $this->orderStatus();
		//末登陆
		if(!$status || $status > 2)
		{
			header("Location:/Index/index");
			exit;
		}		
		
		$location_id = $this->input->get_post('id');
		if(!$location_id || intval($location_id) < 1)
		{
			header("Location:/Index/index");
			exit;
		}
		$param = array('localtion_id'=>intval($location_id), 'location_type'=>1, 'location_isshow'=>1);
		$posInfos = $this->Choice_model->searchUser('fu_location_list',$param);
		if(!$posInfos)
		{
			header("Location:/Index/index");
			exit;
		}
		$roomInfos = $this->Choice_model->searchUser('fu_room_list',array('room_id'=>$posInfos['location_room_id']));
		$view['result']['posInfos'] = $posInfos;
		$view['result']['roomInfos'] = $roomInfos;
		$view['result']['id'] = intval($location_id);
		$this->load->view('submitHigh', $view);
	}
	
	/**
	 * 下订单高端定位的
	 */
	function byHighSubmit()
	{	
		// 是否已经登陆
		$status = $this->orderStatus();	
		//末登陆
		if(!$status)
		{
		    header("Location:/Index/index");
		    exit;
		}		
		/*
		if(!$status || $status > 2)
		{
			header("Location:/Index/index");
			exit;
		}
		*/	
		$locationId = $this->input->get_post('locationId');
		if(!$locationId || intval($locationId) < 1)
		{
			header("Location:/Index/index");
			exit;
		}	
		// 是否是正常未出售
		$param = array('localtion_id'=>intval($locationId), 'location_type'=>1, 'location_number'=>2, 'location_isshow'=>1);
		$posInfos = $this->Choice_model->searchUser('fu_location_list',$param);	
		
		if(!$posInfos)	
		{
			header("Location:/Index/index");
			exit;
		}
		// 正常提交,并插入订单表和修改用户表,牌位表状态用及修改session状态
		// 1.插入订单表
		$stime = time();
		$orderParam = array('order_user'=>$this->session->body_id,
							'order_room_id'=>$posInfos['location_room_id'],
							'order_location_id'=>$posInfos['localtion_id'],
							'order_location_type'=>1,
							'order_datetime'=>$stime,
							'order_price'=>$posInfos['location_price']
							);	
		/*
		if($orderParam['order_location_id'] == 0 || $orderParam['order_room_id'] == 0)
		{
			header("Location:/Index/index");
		}
		*/
		$this->Choice_model->insertOrder('fu_order_info', $orderParam);
		// 2.修改用户表之前订过的牌位状态
		$userPosInfos = $this->Choice_model->searchUser('fu_user',array('body_id'=>$this->session->body_id));
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
		$this->Choice_model->changTable('fu_user', $userParam, array('body_id'=>$this->session->body_id));
		
		
		// 4.修改牌位表为出售中
		$posParam = array('location_number'=>1, 'location_date'=>$stime);
		$this->Choice_model->changTable('fu_location_list', $posParam, array('localtion_id'=>$posInfos['localtion_id']));
		header("Location:/Choice/index");
		exit;
		//$view['result'] = '成功提交订单';	
		//$this->load->view('success', $view);
	}
	
	/**
	 * 查询高端定位详情
	 */
	function highDetail()
	{
	    $data = array('error'=>1, 'msg'=>'非法操作');
	    // 是否已经登陆
	    $status = $this->orderStatus();
	    //末登陆
	    if(!$status)
	    {
            die(json_encode($data));
	    }
	    $localtion_id = $this->input->get_post('id');
	    if(!$localtion_id || intval($localtion_id) < 1)
	    {
	        die(json_encode($data));
	    }	    
	    $localtion_id = intval($localtion_id);

	    $param = array('localtion_id'=>$localtion_id,'location_type'=>1);
	    $locationInfos = $this->Choice_model->searchUser('fu_location_list', $param);	
	    if(!$locationInfos) 
	    {
	        die(json_encode($data));
	    }
	    $data['error'] = 0;
	    $data['msg'] = '成功';
	    // 位置
	    $data['position'] = $locationInfos['localtion_id'];
	    // 价格
	    $data['price'] = $locationInfos['location_price']; 
	    // 出售状态 
	    $data['sale'] = $locationInfos['location_number'];
	    $data['location_alias'] = $locationInfos['location_alias'] ? $locationInfos['location_alias'] : '';
	    $data['location_area'] = $locationInfos['location_area'] ? $locationInfos['location_area'] : '';
	    $data['location_prefix'] = $locationInfos['location_prefix'] ? $locationInfos['location_prefix'] : '';
	    $data['location_code'] = strlen($locationInfos['location_code']) == 1 ? '0'.$locationInfos['location_code'] : $locationInfos['location_code'];
	    if(!$data['location_code'])
	    {
	    	$data['location_code'] = '';
	    }
	    die(json_encode($data));
	}
	
	/**
	 * 高端验证
	 */
	function highCheckPass()
	{
		$data = array('error'=>true,'msg'=>'非法操作');
		if(!$this->session->body_id)
		{
			die(json_encode($data));
		}
		
	
		$pass = trim($this->input->get_post('pass'));
		if(!$pass && $pass != 0)
		{
			$data['msg'] = '密码不能为空';
			die(json_encode($data));
		}
		$pass = addslashes($pass);
		$res = $this->Choice_model->checkPass($pass,1);
		if($res)
		{
			$data = array('error'=>false,'msg'=>'正确');
			$param['highFlag'] = $pass;
			$this->session->set_userdata($param);
		}else {
			$data['msg'] = '密码错误';
		}
		die(json_encode($data));
	}
	
	/**
	 * 随机多次输入验证
	 */
	function randCheckPass()
	{
		$data = array('error'=>true,'msg'=>'非法操作');
		if(!$this->session->body_id)
		{
			die(json_encode($data));
		}
	
	
		$pass = trim($this->input->get_post('pass'));
		if(!$pass && $pass != 0)
		{
			$data['msg'] = '密码不能为空';
			die(json_encode($data));
		}
		$pass = addslashes($pass);
		$res = $this->Choice_model->checkPass($pass,0);
		if($res)
		{
			$param['randThird'] = 1;
			$this->session->set_userdata($param);
			$data = array('error'=>false,'msg'=>'正确');
		}else {
			$data['msg'] = '密码错误';
		}
		die(json_encode($data));
	}	
	
	/**
	 * 查询价格归档
	 */
	private  function checkPrice()
	{
		$res = $this->Choice_model->checkPriceModel();
		return $res;
	}
	
	/**
	 * 查询房间归档
	 * @param int $room_type房间号
	 */
	private  function checkRoom($room_type=0)
	{
		$res = $this->Choice_model->checkRoomModel($room_type);
		return $res;
	}
	
		
	
	/**
	 * 价格选择 
	 */
	function selectPrice()
	{
		
		$data = array('error'=>true,'msg'=>'非法操作');
		$status = $this->orderStatus();
		if($status == 0 || $status > 2)
		{
			die(json_encode($data));
		}
		$price = addslashes(trim($this->input->get_post('price')));	
		if($price == '')
		{
			die(json_encode($data));
		}	
		$priceArr = explode(',', $price);
		$param['minPrice'] = $priceArr[0];
		$param['maxPrice'] = $priceArr[1];
		$param['price'] =1;
		$this->session->set_userdata($param);
		$data = array('error'=>false);
		die(json_encode($data));
	}
	
	/**
	 * 房间选择 
	 */
	function selectRoom()
	{
	
		$data = array('error'=>true,'msg'=>'非法操作');
		$status = $this->orderStatus();
		if($status == 0 || $status > 2)
		{
			die(json_encode($data));
		}
		$room_id = intval(trim($this->input->get_post('price')));
		$type = intval(trim($this->input->get_post('type')));
		if($room_id == '' || !$room_id || !in_array($type, array(0,1)))
		{
			die(json_encode($data));
		}
		// 检查是否有可用的房间
		$checkExists = $this->Choice_model->checkRoomModel($type,$room_id);
		if(!$checkExists)
		{
			$data = array('error'=>true,'msg'=>'该区域牌位已经出售完了');
			die(json_encode($data));
		}
		$param['room_id'] =$room_id;
		$this->session->set_userdata($param);
		$data = array('error'=>false);
		die(json_encode($data));
	}	
}
