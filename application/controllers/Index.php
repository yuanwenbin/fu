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
		/**
				'customerId'=>'', // 用户自增 id
				'body_id'=>'', // 身份证号码
				'user_location_id'=>0, // 用户选择的牌位id
				'user_type'=>0, // 用户类型
				'user_selected'=>0, // 选择次数
				'user_selected_date'=>0, // 选择时间
				'isNew' => 1, // 是否是新用户
				'is_complete' => 0, // 是否完成
				'highFlag'=>'', // 是否验证过高端
				'price'=>'', // 价格标识
				'minPrice'=>'',  // 最小价格
				'maxPrice'=>'', // 大价格
				'count'=>0,	 // 选择的次数
				'randThird'=>0, // 是否是已经验证可以进行第三次随机选号
		 */
		// 判断是否有业务员登陆了
		if(!$this->session->member_id)
		{
			header("Location:". URL_APP_C ."/Index/member");
			exit;
		}

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
				'price'=>'',
				'minPrice'=>'',
				'maxPrice'=>'',
				'count'=>0,
				'randThird'=>0,
				'room_id'=>0,
		);
		foreach($data as $k=>$v)
		{
			unset($_SESSION[$k]);
		}
	
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
		// 判断是否有业务员登陆了
		if(!$this->session->member_id)
		{
			header("Location:". URL_APP_C ."/Index/member");
			exit;
		}
		// 身份证号码
		$bodyId = strip_addslashe($this->input->get_post('bodyId'));
		
		if(!$bodyId || (strlen($bodyId) != 15 && strlen($bodyId) != 18))
		{
			header("Location:". URL_APP_C ."/Index/index");
		}
		
		//$match = '/(^\d{14}$)|(^\d{17}](\d|X|x)$)/';
		$match = '/^\d{14}(\d|X|x)$/';
		$match_2 = '/^\d{17}(\d|X|x)$/';
		if(!preg_match($match, $bodyId) && !preg_match($match_2, $bodyId))
		{
			header("Location:". URL_APP_C ."/Index/index");
		}
		// 判断是否购买过，如果没有购买，则判断是不是超过了登记的次数和时间限制
		$orderInfo = $this->Index_model->searchInfos('fu_order_info',array('order_user'=>$bodyId));
		if(!$orderInfo)
		{
		    //判断是否超过登陆次数和时间限制
		    $regInfo = $this->Index_model->searchInfos('fu_user',array('body_id'=>$bodyId));
		    if($regInfo)
		    {
		      $userInfo = $regInfo[0];
		      if($userInfo['user_regtimes'] > 5)
		      {
		          $flag = $userInfo['user_datetime'] + $userInfo['user_dateline'] - time();
		          if($flag <= 0)
		          {
		              // 已经是用户了
		              echo "<!DOCTYPE html>";
		              echo "<html>";
		              echo "<head>";
		              echo "<meta charset=\"utf-8\">";
		              echo "<title>出错了</title>";
		              
		              echo "</head>";
		              echo "<body>";
		              
		              echo "<div>";
		             echo " 登记次数和时间受到限制，请联系管理员解冻<br />";
		              echo "<a href=\"/Index/menus\">点击返回菜单</a>";
		              echo "</div>";
		              echo "</body>";
		              echo "</html>";
		              exit;
		          }
		      }
		    }
		}
	

		$param['body_id'] = $bodyId;
		$this->session->set_userdata($param);
		// 设置 cookie
		$bodyIdEncode = authcode($bodyId,'ENCODE');
		set_cookie(COOKIE_CUSTOMER_BODYID_FRONT, $bodyIdEncode, COOKIE_EXPIRE_FRONT,COOKIE_DOMAIN_FRONT,COOKIE_PATH_FRONT);		
		header("Location:". URL_APP_C ."/Choice/Index");
	}
	
	/**
	 * 业务员登陆入口
	 */
	function member()
	{
		if($this->session->member_id)
		{
			header("Location:". URL_APP_C ."/Index/menus");
			exit;
		}
		// 显示登陆框	
		$this->load->view('member');
	}
	
	/**
	 * 业务登陆入口验证
	 */
	function memberValidate()
	{
		$data = array();
		$data['error'] = true;
		$data['msg'] = '非法操作';
		$username = addslashes($this->input->get_post('username'));
		$password = addslashes($this->input->get_post('password'));
		if($username == '' || $password == '')
		{
			die(json_encode($data));
		}
		$member = $this->Index_model->memberValidateModel($username,$password);
		if(!$member)
		{
			$data['msg'] = '账号密码出错';
			die(json_encode($data));
		}
		if(!$member['member_flag'])
		{
			$data['msg'] = '账号被冻结，请联系管理员解冻';
			die(json_encode($data));
		}
		$this->session->set_userdata($member);
		$data['error'] = false;
		$data['msg'] = '成功登陆';
		die(json_encode($data));		
	}
	
	/**
	 * 清空全部信息
	 */ 
	function logout()
	{
		// 判断是否有业务员登陆了
		if(!$this->session->member_id)
		{
			header("Location:". URL_APP_C ."/Index/member");
			exit;
		}		
		if(isset($_SESSION) && !empty($_SESSION))
		{
			foreach($_SESSION as $kk => $vv)
			{
				unset($_SESSION[$kk]);
			}
		}
		unset($_SESSION);
		header("Location:". URL_APP_C ."/Index/index");
	}
	
	function menus()
	{
		// 判断是否有业务员登陆了
		if(!$this->session->member_id)
		{
			header("Location:". URL_APP_C ."/Index/member");
			exit;
		}
		// 业务员选择
		$this->load->view('menus');		
	}
	
	/**
	 * 用户来访登记
	 */
	function register()
	{
		// 判断是否有业务员登陆了
		if(!$this->session->member_id)
		{
			header("Location:". URL_APP_C ."/Index/member");
			exit;
		}
		$this->load->view('register');	
	}
	
	/**
	 * 来访登记处理
	 */
	function registerDeal()
	{
		$data = array();
		$data['error'] = true;
		$data['msg'] = '非法操作';
		// 判断是否有业务员登陆了
		if(!$this->session->member_id)
		{
			die(json_encode($data));
		}	
		$body_id = strip_addslashe(trim($this->input->get_post('body_id')));
		$body_id = $body_id ? $body_id : 0;
		$user_telphone = strip_addslashe(trim($this->input->get_post('user_telphone'))); // 手机
		$user_phone = strip_addslashe(trim($this->input->get_post('user_phone'))); // 称呼
		$user_dateline = intval($this->input->get_post('user_dateline'));
		if($user_dateline==1)
		{
		    $user_dateline = 3600 * 24;
		}else {
		    $user_dateline = 3600 * 24 * 10;
		}
		// 身份证号码
		/*
		if(!$body_id || (strlen($body_id) != 15 || strlen($body_id) != 18))
		{
			$data['msg'] = '身份份证有误码00';
			die(json_encode($data));
		} */
		if(!$user_telphone || (strlen($user_telphone) != 11))
		{
			$data['msg'] = '手机号码误码';
			die(json_encode($data));
		}
		// 手机验证
		$telMatch = '/^\d{11}$/';
		if(!preg_match($telMatch, $user_telphone))
		{
			$data['msg'] = '手机号码误码';
			die(json_encode($data));
		}	
			
		//$match = '/(^\d{14}$)|(^\d{17}](\d|X|x)$)/';
	    if($body_id)
	    {
    		$match = '/^\d{14}(\d|X|x)$/';
    		$match_2 = '/^\d{17}(\d|X|x)$/';
    		if(!preg_match($match, $body_id) && !preg_match($match_2, $body_id))
    		{
    			$data['msg'] = '身份份证有误码';
    			die(json_encode($data));
    		}
	    }
		$body_id = addslashes($body_id); 
		$user_telphone = addslashes($user_telphone);
		$user_phone = $user_phone ? addslashes($user_phone) : '0';
		// 先判断用户是否已经登记过
		// $status = $this->Index_model->userCheck($body_id);
		$resUser = $this->Index_model->userCheckReg($body_id,$user_phone);
		// 存在的，则更新手机号，电话号码
		if($resUser)
		{
		    //判断是否多于五次并过期了
		    if($resUser['user_regtimes'] >= 5)
		    {
		        $allTime = $resUser['user_datetime'] + $resUser['user_dateline']; // 总有效时间
		        if($allTime < time())
		        {
		            $data['msg'] = '你的登记次数和有效时间已经达到了限制的次数了，请联系管理员处理';
		            die(json_encode($data));
		        }
		        
		    }
			$paramUpdate = array();
			$where = array();
			$paramUpdate['user_telphone'] = $user_telphone;
			$paramUpdate['user_regtimes'] = ($resUser['user_regtimes']+1) >=6 ? 6 : ($resUser['user_regtimes']+1);
			$paramUpdate['user_datetime'] = time(); 
			$paramUpdate['user_dateline'] = $user_dateline; // 有效登记时间
			if($user_phone)
			{
			 $paramUpdate['user_phone'] = $user_phone;
			}
			if($body_id)
			{
			    $paramUpdate['body_id'] = $body_id;			    
			}
			$where['user_id'] = $resUser['user_id'];
			$res = $this->Index_model->userUpdate('fu_user',$paramUpdate,$where);
			if($res)
			{
				$data['error'] = false;
				$data['msg'] = '此用户登记过，已经成功更新信息';				
			}else {
				$data['error'] = true;
				$data['msg'] = '此用户登记过，更新信息失败，请稍后重试';				
			}
			die(json_encode($data));
		}
		
		$param = array();
		$param['body_id'] = $body_id;
		$param['user_telphone'] = $user_telphone;
		$param['user_phone'] = $user_phone;
		$param['user_team_id'] = $this->session->member_team_id; 
		$param['user_member_id'] = $this->session->member_id; 
		$param['user_type'] = -1;
		$param['user_datetime'] = time();
		$param['user_dateline'] = $user_dateline;
		$res = $this->Index_model->bodyInsert($param);
		if($res)
		{
			$data['error'] = false;
			$data['msg'] = '登记成功';		
		}else {
			$data['msg'] = '登记失错，请重试';
		}
		die(json_encode($data));
	}
	
	/**
	 * 组长登陆
	 */
	function infoList()
	{
	    // 判断是否有业务员登陆了
	    if(!$this->session->member_id)
	    {
	        header("Location:". URL_APP_C ."/Index/member");
	        exit;
	    }
	    // 判断是否是组长
	    if(!$this->session->member_teamid)
	    {
	        header("Location:". URL_APP_C ."/Index/member");
	        exit;
	    }
	    // 书写统计中心
	    // 业务员总数
	    $paramMember['member_team_id'] = $this->session->member_team_id;
	    $memberCount = $this->Index_model->queryCountModel('fu_member',$paramMember);
 
	    $view['userCount'] =  $memberCount;
	    // 旗下业务员的用户总数
	    // $paramMemberUser['member_team_id'] = $this->session->member_id;
	    $paramMemberUser['member_team_id'] = $this->session->member_team_id;
	    // $memberUserList = $this->Index_model->searchInfos('fu_member',$paramMemberUser);
	    
	    $memberUserCount = 0;
	    $ids = '';
	    
	    if($memberCount)
	    {
	    	$memberUserList = $this->Index_model->searchInfos('fu_member',$paramMemberUser);
	    
		    if($memberUserList)
		    {
		        $ids .= "(";
		        foreach ($memberUserList as $kk=>$vv)
		        {
		            $ids .= "'" . $vv['member_id']."',";
		        }
		        $ids = substr($ids,0,-1) . ")";
		        // $memberUserCount = $this->Index_model->queryCountInModel('fu_user',$ids,'user_team_id');
		        $memberUserCount = $this->Index_model->queryCountInModel('fu_user',$ids,'user_member_id');
		    }
	    }
	    
	    
	    $view['memberUserCount'] =  $memberUserCount;
	     
	    // 订单数
	    $orderAllCount = 0;
	    $orderNotPayCount = 0;
	    $orderAllCountMoney = 0.00;
	    $orderNotPayCountMoney = 0.00;
	    if($memberUserCount)
	    {
	        // 组长旗下业务员的用户列表 
	        // $memberForUserList = $this->Index_model->queryCountInListModel('fu_user',$ids,'user_team_id');
	        $memberForUserList = $this->Index_model->queryCountInListModel('fu_user',$ids,'user_member_id');
	        // bof 
	        if($memberForUserList)
	        {
	        	$idss = "(";
	        	foreach($memberForUserList as $k=>$v)
	        	{
	        		$idss .= "'".$v['body_id'] ."',";
	        	}
	        	// 组长旗下业务员的用户body_id值
	        	$idss = substr($idss,0,-1) . ")";

        		$idStr = substr($idss,0,-1) . ")";
        		$orderAllCount = $this->Index_model->queryCountInModel('fu_order_info',$idStr,'order_user');
        		//总金额
        		$orderAllCountMoney = $this->Index_model->queryCountInMoneyModel('fu_order_info',$idStr,'order_user','order_price');
        
        		$orderNotPayCount = $this->Index_model->queryCountInModel('fu_order_info',$idStr,'order_user',array('order_payment'=>0));
        		// 末支付金额
        		$orderNotPayCountMoney = $this->Index_model->queryCountInMoneyModel('fu_order_info',$idStr,'order_user','order_price',array('order_payment'=>0));
	        
	        }	        
	        
	        
	        
	        // eof 
	        
	        /* 旧的，重复了
	        if($memberForUserList)
	        {
	            $idss = "(";
	            foreach($memberForUserList as $k=>$v)
	            {
	                $idss .= "'".$v['user_id'] ."',";
	            }
	            // 组长旗下业务员的用户user_id值
	            $idss = substr($idss,0,-1) . ")";
	            $userList = $this->Index_model->queryCountInListModel('fu_user',$idss,'user_id');
	            if($userList)
	            {
	                $idStr = "(";
	                foreach($userList as $kkk=>$vvv)
	                {
	                    $idStr .= "'" . $vvv['body_id'] . "',";
	                }
	                $idStr = substr($idStr,0,-1) . ")";
	                $orderAllCount = $this->Index_model->queryCountInModel('fu_order_info',$idStr,'order_user');
	                //总金额
	                $orderAllCountMoney = $this->Index_model->queryCountInMoneyModel('fu_order_info',$idStr,'order_user','order_price');
	                 
	                $orderNotPayCount = $this->Index_model->queryCountInModel('fu_order_info',$idStr,'order_user',array('order_payment'=>1));
	                // 末支付金额
	                $orderNotPayCountMoney = $this->Index_model->queryCountInMoneyModel('fu_order_info',$idStr,'order_user','order_price',array('order_payment'=>1));
	            }
	        }
	        */
	    }
	    $view['orderAllCount'] = $orderAllCount;
	    $view['orderNotPayCount'] = $orderNotPayCount;
	    $view['orderAllCountMoney'] = $orderAllCountMoney;
	    $view['orderNotPayCountMoney'] = $orderNotPayCountMoney;
	    $this->load->view('infoList', $view);	    	    	    
	}
	
	
	/**
	 * 组长及旗下的用户登记列表
	 */
	function indexUserListTeam()
	{
		// 判断是否有业务员登陆了
		if(!$this->session->member_id)
		{
			header("Location:". URL_APP_C ."/Index/member");
			exit;
		}
		// 判断是否是组长
		if(!$this->session->member_teamid)
		{
			header("Location:". URL_APP_C ."/Index/member");
			exit;
		}
		
		// 当前页
		$page = intval($this->input->get_post('page'));
		if($page < 1)
		{
			$page = 1;
		}
		$pageSize = 10;
		
		// 业务员 id 列表
		$paramMemberUser = array('member_team_id'=>$this->session->member_teamid);
		$members = $this->Index_model->searchInfos('fu_member',$paramMemberUser);
		$member_ids = " (";
		if($members)
		{
			foreach($members as $k=>$v)
			{
				$member_ids .= "'" . $v['member_id'] . "',";
			}
		}else {
			$member_ids .= "'-1',";
		}
		$member_ids = substr($member_ids,0,-1) . ")";
		$where = " user_location_id = '0' and user_member_id in " . $member_ids . " order by user_id desc ";
		// 登记用户总数
		$userCount = $this->Index_model->queryCountInModel('fu_user',$member_ids,'user_member_id', array('user_location_id' => '0')); 
		$totalPage = ceil($userCount/$pageSize);
		// 登记用户列表
		$userNotOrder = $this->Index_model->queryTotalListModel('fu_user',$where,$page,$pageSize); 
		
		
		$view['total'] = $userCount;
		$view['page'] = $page;
		$view['totalPage'] = $totalPage;
		$view['records'] = $userNotOrder;
		$view['userList'] = $userNotOrder;
		$this->load->view('indexUserListTeam',$view);
	}

	/**
	 * 组长及旗下业务员和其业务员的订单
	 */
	function orderListTeam()
	{
		// 判断是否有业务员登陆了
		if(!$this->session->member_id)
		{
			header("Location:". URL_APP_C ."/Index/member");
			exit;
		}
		// 判断是否是组长
		if(!$this->session->member_teamid)
		{
			header("Location:". URL_APP_C ."/Index/member");
			exit;
		}	
		// 当前页
		$page = intval($this->input->get_post('page'));
		if($page < 1)
		{
			$page = 1;
		}
		$pageSize = 10;
	
		// 业务员 id 列表
		$paramMemberUser = array('member_team_id'=>$this->session->member_teamid);
		$members = $this->Index_model->searchInfos('fu_member',$paramMemberUser);
		$member_ids = " (";
		if($members)
		{
			foreach($members as $k=>$v)
			{
				$member_ids .= "'" . $v['member_id'] . "',";
			}
		}else {
			$member_ids .= "'-1',";
		}
		// 业务员编号
		$member_ids = substr($member_ids,0,-1) . ")"; // ('1','3','4')
		$where = " in " . $member_ids;
		$orderListTotal = $this->Index_model->orderTeamListModel($where); // 总记录
		$memberOrderList = 0;
		$totalPage = ceil($orderListTotal/$pageSize);

		if($orderListTotal)
		{
			$memberOrderList = $this->Index_model->orderTeamListModel($where,$page,$pageSize);
		}
		$view['total'] = $orderListTotal;
		$view['page'] = $page;
		$view['totalPage'] = $totalPage;
		$view['memberOrderList'] = $memberOrderList;		
		$this->load->view('orderListTeam', $view);
	}
		
	/*
	public function login()
	{
		// 身份证号码
		$bodyId = strip_addslashe($this->input->get_post('bodyId'));
		
		if(!$bodyId || (strlen($bodyId) != 15 && strlen($bodyId) != 18))
		{
			header("Location:". URL_APP_C ."/Index/index");
		}
		
		//$match = '/(^\d{14}$)|(^\d{17}](\d|X|x)$)/';
		$match = '/^\d{14}(\d|X|x)$/';
		$match_2 = '/^\d{17}(\d|X|x)$/';
		if(!preg_match($match, $bodyId) && !preg_match($match_2, $bodyId))
		{
			header("Location:". URL_APP_C ."/Index/index");
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
						header("Location:". URL_APP_C ."/Choice/index");	
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
				header("Location:". URL_APP_C ."/Choice/index");		
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
		        header("Location:". URL_APP_C ."/Choice/index");
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
		header("Location:". URL_APP_C ."/Index/index");		
	}
	*/
}
