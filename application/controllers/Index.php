<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Index_model');
	}
	public function index()
	{  
		$data = array(
				'customerId'=>'',
				'body_id'=>'',
				'user_location_id'=>0,
				'user_type'=>0,
				'user_selected'=>0,
				'user_selected_date'=>0,
				'isNew' => 1,
				'is_complete' => 0,
				'highFlag'=>'',
				'count'=>0,
		);
		foreach($data as $k=>$v)
		{
			unset($_SESSION[$k]);
		}
		unset($_SESSION);
		$bodyIdJiami = isset($_COOKIE[COOKIE_CUSTOMER_BODYID_FRONT]) && !empty($_COOKIE[COOKIE_CUSTOMER_BODYID_FRONT]) ? $_COOKIE[COOKIE_CUSTOMER_BODYID_FRONT] : '';
		if($bodyIdJiami)
		{
			$view['bodyId'] = authcode($bodyIdJiami);
		}else
		{
			$view['bodyId'] = '';
		}
		
		$this->load->view('index', $view);
	}
	
	public function login()
	{
		// 身份证号码
		$bodyId = strip_addslashe($this->input->get_post('bodyId'));
		
		if(!$bodyId || (strlen($bodyId) != 15 && strlen($bodyId) != 18))
		{
			header("Location:/Index/index");
		}
		
		//$match = '/(^\d{14}$)|(^\d{17}](\d|X|x)$)/';
		$match = '/^\d{14}(\d|X|x)$/';
		$match_2 = '/^\d{17}(\d|X|x)$/';
		if(!preg_match($match, $bodyId) && !preg_match($match_2, $bodyId))
		{
			header("Location:/Index/index");
		}
		$param['body_id'] = $bodyId;
		$this->session->set_userdata($param);
		// 设置 cookie
		$bodyIdEncode = authcode($bodyId,'ENCODE');
		set_cookie(COOKIE_CUSTOMER_BODYID_FRONT, $bodyIdEncode, COOKIE_EXPIRE_FRONT,COOKIE_DOMAIN_FRONT,COOKIE_PATH_FRONT);		
		header("Location:/Choice/Index");
	}
	/*
	public function login()
	{
		// 身份证号码
		$bodyId = strip_addslashe($this->input->get_post('bodyId'));
		
		if(!$bodyId || (strlen($bodyId) != 15 && strlen($bodyId) != 18))
		{
			header("location:/Index/index");
		}
		
		//$match = '/(^\d{14}$)|(^\d{17}](\d|X|x)$)/';
		$match = '/^\d{14}(\d|X|x)$/';
		$match_2 = '/^\d{17}(\d|X|x)$/';
		if(!preg_match($match, $bodyId) && !preg_match($match_2, $bodyId))
		{
			header("Location:/Index/index");
		}
	
		// 用户信息
		$customer = $this->Choice_model->searchUser('fu_user',array('body_id'=>$bodyId));
		
		// 设置cookie
		$bodyIdEncode = authcode($bodyId,'ENCODE');
		set_cookie(COOKIE_CUSTOMER_BODYID_FRONT, $bodyIdEncode, COOKIE_EXPIRE_FRONT,COOKIE_DOMAIN_FRONT,COOKIE_PATH_FRONT);		
		
		// 如果存在
		if($customer)
		{	*/
			/**
			 * 判断是否有订单及是否已经完成
			 */
			// 检测是否有订单
			/*
			$resInfo = $this->Choice_model->searchUser('fu_order_info',array('order_user'=>$bodyId));
			
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
							'body_id'=>$bodyId,
							'user_location_id'=>$resInfo['order_location_id'],
							'user_type'=>$userInfo['user_type'],
							'user_selected'=>0,
							'user_selected_date'=>$userInfo['user_selected_date'],
							'isNew' => 0,
							'is_complete' => 1
					);
					$this->session->set_userdata($data);
					
					exit('complete');			
					$this->load->view('complete', $view);
				}else {
					// 订单有效时间
					$affectTime = time() - 7200;
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
						$affectRow = $this->Choice_model->insertOrder($table,$param);
						// 删除数据
						$this->Choice_model->delData('fu_order_info',array('order_id'=>$orderId));
						// 修改房间牌位状态
						$tableName = 'fu_location_list';
						$paramUpdate = array('location_number'=>0);
						$where = array('localtion_id'=>$resInfo['order_location_id']);
						$this->Choice_model->changTable($tableName, $paramUpdate, $where);
						 
						// 修改用户状态
						$paramUser = array('user_type'=>0,'user_selected'=>0, 'user_selected_date'=>0);
						$whereUser = array('body_id'=>$this->session->body_id);
						$this->Choice_model->changTable('fu_user', $paramUser, $whereUser);
						
						// session
				        $data = array(
				        	'customerId'=>$customer['user_id'],
				        	'body_id'=>$bodyId,	
				        	'user_location_id'=>0,
			        		'user_type'=>0,
			        		'user_selected'=>0,
			        		'user_selected_date'=>0,
				            'isNew' => 1,
				        	'is_complete' => 0	
				        );
				        $this->session->set_userdata($data); 						
						header("Location:/Choice/index");	
						exit();					
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
								'body_id'=>$bodyId,
								'user_location_id'=>$resInfo['order_location_id'],
								'user_type'=>$userInfo['user_type'],
								'user_selected'=>0,
								'user_selected_date'=>$userInfo['user_selected_date'],
								'isNew' => 0,
								'is_complete' => 0
						);
						$this->session->set_userdata($data);
						exit('uncomplete');
						$this->load->view('uncomplete', $view);
						exit();						
					}
				}
			}else {	
				// 无订单,则按新用户处理
				// session
				$data = array(
						'customerId'=>$customer['user_id'],
						'body_id'=>$bodyId,
						'user_location_id'=>0,
						'user_type'=>0,
						'user_selected'=>0,
						'user_selected_date'=>0,
						'isNew' => 1,
						'is_complete' => 0
				);
				$this->session->set_userdata($data);
				// 修改用户状态
				$paramUser = array('user_type'=>0,'user_selected'=>0, 'user_selected_date'=>0);
				$whereUser = array('body_id'=>$bodyId);
				$this->Choice_model->changTable('fu_user', $paramUser, $whereUser);	
				header("Location:/Choice/index");		
			}
			
		}else 
		{
			// 不存在,即全新的用户
			$param = array();
			$param['body_id'] = $bodyId;
			$customerId = $this->Index_model->bodyInsert($param);
			if($customerId)
			{
				// session
		        $data = array(
		        	'customerId'=>$customerId,
		        	'body_id'=>$bodyId,	
		        	'user_location_id'=>0,
	        		'user_type'=>0,
	        		'user_selected'=>0,
	        		'user_selected_date'=>0,
		            'isNew' => 1,
		        	'is_complete' => 0	
		        );
		        $this->session->set_userdata($data); 
		        header("Location:/Choice/index");
		        exit();
			}
		}
		
	}
	*/
	/*
	public function test()
	{
		
		// print_r($this->session->customerId);
	    $arr = array('user_selected');
	    $this->session->unset_userdata($arr);
	    echo date('Y-m-d H:i:s', time());
	}
	
	// 退出
	function logout()
	{
		$arr = array('customerId','body_id', 'user_location_id', 'user_type', 'user_selected', 'user_selected_date', 'count');
		$this->session->unset_userdata($arr);
		delete_cookie(COOKIE_CUSTOMER_BODYID_FRONT,COOKIE_DOMAIN_FRONT,COOKIE_PATH_FRONT);
		delete_cookie(COOKIE_CUSTOMER_ID,COOKIE_DOMAIN_FRONT,COOKIE_PATH_FRONT);
		header("Location:/Index/index");		
	}
	*/
}
