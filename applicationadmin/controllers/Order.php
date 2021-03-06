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
	        header("Location:".URL_APP_C."/Index/login");
	    }
	    return true;
	}
	/**
	 * 增加订单有效期
	 */
	function addDate()
	{
	    if(!hasPerssion($_SESSION['role'], 'orderList')){
	        exit('点击左栏目操作');
	    }	
	    $order_id = intval($this->input->get_post('id'));  
	    if(!$order_id)
	    {
	        exit('非法操作!');
	    }
	    $res = $this->Order_model->searchInfos('fu_order_info', array('order_id'=>$order_id));  
	    if(!$res)
	    {
	        exit('没有相关数据');
	    }
	    $view = array();
	    $view['res'] = $res[0];
	    $this->load->view('addDate',$view);
	}
	/**
	 *增加订单有效期处理
	 */
	function addDateDeal()
	{
		if(!hasPerssion($_SESSION['role'], 'orderList')){
	        exit('点击左栏目操作');
	    }	
	    $order_id = intval($this->input->get_post('order_id'));  
	    if(!$order_id)
	    {
	        exit('非法操作!');
	    }
	    $res = $this->Order_model->searchInfos('fu_order_info', array('order_id'=>$order_id));  
	    if(!$res)
	    {
	        exit('没有相关数据');
	    }
	    $day = intval($this->input->get_post('addDate'));
	    $order_id = intval($this->input->get_post('order_id'));
	    if(!$day || $day < 0 || !$order_id)
	    {
	        $this->load->view('failure');
	    }else {
	        $day = $day * 3600*24;
	      $res = $this->Order_model->updateData('fu_order_info',array('add_datetime'=>$day),array('order_id'=>$order_id));
	      $view = array();
	      if($res)
	      {
	          $view['url'] = "/Order/orderList";
	          $this->load->view('success',$view);
	      }else {
	          $this->load->view('failure');
	      }
	    }
	}
	/**
	 * 捐赠列表
	 */
	function orderList()
	{  
	    if(!hasPerssion($_SESSION['role'], 'orderList')){
	        exit('点击左栏目操作');
	    }
	    // bof 牌位编号
	    $location_info = trim($this->input->get_post('location_info'));
	    if($location_info)
	    {  
	    	// 非数字
    		if(!is_numeric($location_info))
    		{	
    		    $flag = 1; // 表示直接查找 fu_location_list 表
    			$resLocation = $this->Order_model->checkNoForCode($location_info);
    			if(!$resLocation)
    			{
    				// 再次判断
    				$length = strlen($location_info);
    				$str = substr($location_info,0,-2);
    				$str .= substr($location_info,-1,1);
    				$locationListInfo = $this->Order_model->checkNoForCode($str);
    				if(!$locationListInfo)
    				{
    					echo "没有相关数据，&nbsp;<a href='".URL_APP_C."/Order/orderList'>点击返回</a>";
    					exit;
    				}
    				$resLocation = $this->Order_model->posInfosModel('fu_order_info', array('order_location_id'=>$locationListInfo['localtion_id']));
    				$flag = 0; // 查fu_order_info表
    			}
    		}else {
    			$resLocation = $this->Order_model->posInfosModel('fu_order_info', array('order_location_id'=>$location_info));
    			$flag = 0; // 查fu_order_info表
    		}
    		if(!$resLocation)
    		{
    			echo "没有相关数据，&nbsp;<a href='".URL_APP_C."/Order/orderList'>点击返回</a>";exit;
    		}
    		if($flag)
    		{
    		    $resLocation = $this->Order_model->posInfosModel('fu_order_info', array('order_location_id'=>$resLocation['localtion_id']));
    		}
    		$view = array();
    		// 是牌位列表还是订单列表查询  
    		$locationId = $resLocation[0]['order_location_id']; 
    		$location_list = $this->Order_model->searchInfos('fu_location_list', array('localtion_id'=>$locationId));
			$view['resultList'] = $resLocation[0];
			foreach($location_list[0] as $kk=>$vv)
			{
				$view['resultList'][$kk] = $vv;
			}
			$room_list = $this->Order_model->searchInfos('fu_room_list', array('room_id'=>$location_list[0]['location_room_id']));
			$view['resultList']['room_alias'] = $room_list[0]['room_alias'];
			$this->load->view('orderListForNo', $view);
	    //  eof 牌位编号
	    }else{
		    $view = array();
		    $param = array();
		    $page = intval($this->input->get_post('page'));
		    if(!$page)
		    {
		        $page = 1;
		    }
		    // 福位号
		    $order_room_id = $this->input->get_post('order_room_id');
		    if(!$order_room_id)
		    {
		        $view['result']['order_room_id'] = '';
		    }else
		    {
		        $param['order_room_id'] = addslashes($order_room_id);
		        $view['result']['order_room_id'] = addslashes($order_room_id);
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
		    $datetime = addslashes($this->input->get_post('datetime'));
	        if($datetime)
	        {
	            $param['order_datetime']=strtotime(addslashes($datetime));
	            $view['result']['datetime'] = strtotime(addslashes($datetime)); 
	        }else {
	            $view['result']['datetime'] = '';
	        }
		    // 截止时间
		    $datetimes = $this->input->get_post('datetimes');
		
		    if($datetimes)
		    {
		        $param['order_datetimes']=strtotime(addslashes($datetimes));
		        $view['result']['datetimes'] = strtotime(addslashes($datetimes));
		    }else {
		        $view['result']['datetimes'] = '';
		    }
		   
		    // 身份号码
		    $bodyId = $this->input->get_post('bodyId');
		    if($bodyId)
		    {
		        $view['result']['bodyId'] = trim(strip_tags($bodyId));
		        $param['order_user'] = trim(strip_tags($bodyId));
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
		    
		    if($resultList)
		    {
		        foreach ($resultList as $k=>$vv)
		        {
		            $roomInfos = $this->Order_model->posInfosModel('fu_room_list',array('room_id'=>$vv['order_room_id']));
		            $locationInfos = $this->Order_model->posInfosModel('fu_location_list',array('localtion_id'=>$vv['order_location_id']));
		            $resultList[$k]['roomInfos'] = $roomInfos[0];
		            $resultList[$k]['locationInfos'] = $locationInfos[0];
		        }
		    }
		    $view['result']['totalNumber'] = $totalNumber;
	
		    $view['result']['page'] = $page;
		    $view['result']['totalPage'] = $totalPage;
	        $view['result']['resultList'] = $resultList; 
	        $view['source'] = $this->source;
	        $view['username'] = $this->session->userdata('admin_user');
		    $this->load->view('orderList',$view);
	    }
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
	    // 福位信息
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
	
	/**
	 * 自助下单
	 */
	function orderSelf()
	{
		
		$this->load->model('Memberteam_model');
		$memberList = $this->Memberteam_model->memberteamQueryModel('fu_member',array('member_flag'=>1));
		$roomList = $this->Memberteam_model->memberteamQueryModel('fu_room_list',array('room_flag'=>1));
		$view = array();
		$view['memberList'] = $memberList;
		$view['roomList'] = $roomList;
		$this->load->view('orderSelf',$view);
	}
	
	/**
	 * 自助下单处理
	 */
	function orderSelfAdd()
	{
	    if(!hasPerssion($_SESSION['role'], 'orderList')){
	        exit('点击左栏目操作');
	    }	    
		$localtion_value = trim($this->input->get_post('localtion_id'));
		$room_no = intval(trim($this->input->get_post('room_no')));
		$data = array();
		$data['error'] = true;
		if(is_numeric($localtion_value))
		{
			$localtion_id = intval($localtion_value);
		}else {
			$location_row_info = $this->Order_model->checkNoForCode($localtion_value,$room_no);
			if(!$location_row_info)
			{
				$data['msg'] = '不存在该牌位编号';
				die(json_encode($data));
			}
			$localtion_id = $location_row_info['localtion_id'];	
		}

		$body_id = $this->input->get_post('body_id');
		$member_id = intval($this->input->get_post('member_id'));
		
		$location_number = intval($this->input->get_post('location_number'));
		$user_name = $this->input->get_post('user_name');
		$user_birthday = $this->input->get_post('user_birthday');
		$stime = $this->input->get_post('stime');
		$order_location_type = intval($this->input->get_post('order_location_type'));
		$createTime = time();
		
		$user_telphone = $this->input->get_post('user_telphone');
		$user_phone = $this->input->get_post('user_phone');
		

		if(!$localtion_id)
		{
			$data['msg'] = '信息有误，请输入牌位号码'; 
			echo json_encode($data);
			exit;
		}
		// 身份证号码
		if(!$body_id || (strlen($body_id) != 15 && strlen($body_id) != 18))
		{
			$data['msg'] = '信息有误，身份份证有误码';
			die(json_encode($data));
		}
		// 检查牌位号码
		$this->load->model('Order_model');
		$location_res = $this->Order_model->searchInfos("fu_location_list", array('localtion_id'=>$localtion_id));
		if(!$location_res)
		{
			$data['msg'] = "信息有误，不存在该牌位";
			die(json_encode($data));
		}
		$locationInfo = $location_res[0];
		if(!$locationInfo['location_number'])
		{
			$data['msg'] = "信息有误，该牌位已有人订了,请换别的牌位号";
			die(json_encode($data));			
		}
		if($locationInfo['location_status'])
		{
			$data['msg'] = "信息有误，该牌位是自己刷单的";
			die(json_encode($data));
		}
		// 金额
		$location_price = $this->input->get_post('location_price', true);
		//证书编号
		$location_sno = $this->input->get_post('location_sno',true);
		
		// 类型    0-随机,1-高端定制式
		$location_type = $locationInfo['location_type'];
		if($location_type == 1 && $order_location_type != 1)
		{
			$data["msg"] = '信息有误，该牌位是高端定制，但订单定位非高端定位';
			die(json_encode($data));
		}
		
		if(!$location_type && $order_location_type == 1)
		{
			$data['msg'] = '信息有误，该牌位是随机/生辰八字，但订单定位高端定位';
			die(json_encode($data));			
		}
		
		if($order_location_type == 2)
		{
			if(!$user_name || !$user_birthday || !$stime)
			{
				$data['msg'] = '信息有误，你的定位是生辰八字，请填写正确的姓名，生日，时辰';
				die(json_encode($data));				
			}
		}
		
		if(!$user_telphone)
		{
			$data['msg'] = '信息有误，客户电话号码不能为空';
			die(json_encode($data));
		}
		// 更新牌位
		$fu_location_list = array('localtion_id'=>$localtion_id, 'location_date'=>$createTime,'location_number'=>$location_number,'location_price'=>$location_price,'location_sno'=>$location_sno);
		
		// 插入订单
		$fu_order_info = array('order_user'=>$body_id,
								'order_room_id'=>$locationInfo['location_room_id'],
								'order_location_id'=>$localtion_id,
								'order_location_type'=>$order_location_type,
								'order_datetime'=>$createTime
								);
		// 插入用户
		$memberInfo = $this->Order_model->searchInfos("fu_member", array('member_id'=>$member_id));
		if(!$memberInfo)
		{
			$data["msg"] = '信息有误，此义工还没有分组';
			die(json_encode($data));			
		}
		if($order_location_type == 2)
		{
			$user_type = 1;
		}elseif($order_location_type == 1)
		{
			$user_type = 2;
		}else {
			$user_type = 0;
		}
		$fu_user = array('body_id'=>$body_id,
						 'user_location_id'=>$localtion_id,	
						'user_type'=>$user_type,
						'user_selected'=>2,
						'user_selected_date'=>$createTime,
						'user_datetime'=>$createTime,
						'user_name'=>'',
						'user_birthday'=>'',
						'user_time'=>'',
						'user_member_id'=>$member_id,
						'user_team_id'=>$memberInfo[0]['member_team_id'],
						'user_telphone'=>$user_telphone,
						'user_phone'=>$user_phone
		);
		// 生辰八字用户
		if($order_location_type == 2)
		{
			$fu_user['user_name'] = $user_name;
			$fu_user['user_birthday'] = $user_birthday;
			$fu_user['user_time'] = $stime;
		}
		$res = $this->Order_model->multiUpdateInsert($fu_location_list,$fu_order_info,$fu_user);
		if($res)
		{
			$data['error'] = false;
			$data['msg'] = '操作成功';
			die(json_encode($data));
		}else {
			$data['msg'] = '操作失败，请稍后再试';
			die(json_encode($data));
		}
		
		
	}
	
	function userInfoDeal()
	{
	    if(!hasPerssion($_SESSION['role'], 'orderList')){
	        exit('点击左栏目操作');
	    }
	    $this->load->model('User_model');
	    $user_id = intval($this->input->get_post('user_id'));
	    $user_phone = $this->input->get_post('user_phone');
	    $user_telphone = $this->input->get_post('user_telphone');
	    $param = array('user_phone'=>$user_phone, 'user_telphone'=>$user_telphone);
	    $where = array('user_id'=>$user_id);
	    $res = $this->User_model->updateInfos('fu_user',$param, $where);
	    if($res===false)
	    {
	        $this->load->view('failure');
	    }else {
	        $this->load->view('success');
	    }
	}
	
	function delOrder()
	{
	    $data['error'] = true;
	    if(!hasPerssion($_SESSION['role'], 'delOrder')){
	        $data['msg'] = '你没有权限';
	        die(json_encode($data));
	    }
	    $order_id = intval($this->input->get_post('order_id'));
	    if($order_id <= 0)
	    {
	        $data['msg'] = '非法操作';
	        die(json_encode($data));
	    }
	    $res = $this->Order_model->searchInfos('fu_order_info', array('order_id'=>$order_id));
	    if(!$res)
	    {
	        $data['msg'] = '该订单不存在';
	        die(json_encode($data));
	    }
	    $result = $this->Order_model->delOrder($order_id);
	    if($result)
	    {
	        $data['error'] = false;
	        $data['msg'] = '删除成功';
	        die(json_encode($data));
	    }else {
	        $data['msg'] = '删除失败';
	        die(json_encode($data));
	    }
	}

}