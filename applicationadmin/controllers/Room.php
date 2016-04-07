<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Room extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Room_model');
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
	
	/**
	 * 房间开设
	 */
	function roomOpen()
	{
	    if(!hasPerssion($_SESSION['role'], 'roomOpen')){
	        exit('无权限,请点击左栏目操作');
	    }	    
		$view = array();
		// 获取房间号码
		$roomId = $this->Room_model->roomMax();
		if(!$roomId)
		{
			$roomId = 1;
		}else {
			$roomId = $roomId + 1;
		}
		$view['roomId'] = $roomId;
		$this->load->view('roomOpen', $view);
	}
	
	/**
	 * 增加房间处理
	 */
	function roomOpenAdd()
	{
	    if(!hasPerssion($_SESSION['role'], 'roomOpen')){
	       exit('无权限,请点击左栏目操作');
	    }	   
		$userId = $this->session->userId;
		$roomNumber = intval($this->input->post_get('number'));
		$openFlag = intval($this->input->post_get('openFlag'));
		$price = $this->input->post_get('price');
		$alias = addslashes($this->input->post_get('alias'));
		$type = intval($this->input->post_get('room_type'));
		$description = addslashes($this->input->post_get('description'));
		$datetime = time();
		/*
		if($roomNumber <= 0 || $openFlag < 0)
		{
			header("Location:/Index/index");
		} */
		// 区域名称
		$location_area = $this->input->post_get('location_area');

		//牌位前缀
		$location_prefix = $this->input->post_get('location_prefix');

		// 牌位开始编码
		$location_code = $this->input->post_get('location_code');
		
		// 对应的牌位数量
		$location_numbers = $this->input->post_get('location_numbers');
		
		// 价格
		$price = $this->input->post_get('price');
		
		// 对区域信息分别作判断
		if(count($location_area) != count($location_prefix) || count($location_area) != count($location_code) || count($location_area) != count($location_numbers) || count($price) != count($location_area))
		{
			echo '区域信息不对应 ';
			echo "<a href='/Room/roomOpen'>点击返回</a>";
			exit;
		}
		// 判断是否为空
		$isEqual = 1;
		foreach($location_area as $k=>$v)
		{
			if(!$v)
			{
				$isEqual = 0; 
				break;
			}else {
				$location_area[$k] = addslashes($v);
			}
		}	
		if($isEqual)	
		{
			foreach($location_prefix as $k=>$v)
			{
				if(!$v)
				{
					$isEqual = 0;
					break;
				}else {
					$location_prefix[$k] = addslashes($v);
				}
			}			
		}
		
		if($isEqual)
		{
			foreach($location_code as $k => $v)
			{
				if(!$v)
				{
					$isEqual = 0;
					break;
				}else {
					$location_code[$k] = addslashes($v);
				}
			}				
		}

		if($isEqual)
		{
			foreach($location_numbers as $k => $v)
			{
				if(!$v)
				{
					$isEqual = 0;
					break;
				}else {
					$location_numbers[$k] = addslashes($v);
				}
			}				
		}
		
		if(!$isEqual)
		{
			echo '区域信息没有填写完整 ';
			echo "<a href='/Room/roomOpen'>点击返回</a>";
			exit;			
		}
		
		$roomId = $this->Room_model->roomOpenAdd($userId,$roomNumber,$openFlag,$datetime,$alias,$description,$type);
		//增加牌位
		// $this->Room_model->roomOpenPosition($roomId,$roomNumber,$price,$openFlag);
		$this->Room_model->roomOpenPosition($roomId,$openFlag,$location_area,$location_prefix,$location_code,$location_numbers,$price,$type);
		$this->load->view('success');
	}
	
	/**
	 * 房间列表
	 */
	function roomList()
	{
	    if(!hasPerssion($_SESSION['role'], 'roomList')){
	        exit('无权限,请点击左栏目操作');
	    }		
		// 总房间数
		$roomTotal = $this->Room_model->roomTotal();
		if(!$roomTotal)
		{
			echo '暂时没有相关房间,请先开设房间';
			echo "<a href='/Room/roomOpen'>点击开设房间</a>";
			exit;
		}
		$totalPage = ceil($roomTotal/PAGESIZE);
		$page = $this->input->post_get('page');
		if(!$page)
		{
			$page = 1;
		}elseif($page > $totalPage)
		{
			$page = $totalPage;
		}
		
		$view['roomList'] = array();
		$roomList = $this->Room_model->roomList($page);
		if($roomList)
		{
			$view['roomList'] = $roomList;
			if($page > 1)
			{
				$view['indexPage'] = 1;
			}
			if($page < $totalPage)
			{
				$view['endPage'] = $totalPage;
			}	
			$view['total'] = $roomTotal;
			$view['page'] = $page;	
			$view['totalPage'] = $totalPage;
			$view['roomTotal'] = $roomTotal;
		}
		$posTotalArr = array();
		$posTotal= $this->Room_model->roomTongJiModel();
		if($posTotal)
		{
			foreach($posTotal as $ptotal)
			{
				$posTotalArr[$ptotal['location_room_id']] = $ptotal['total'];
			}
			
		}
		$view['posTotal'] = $posTotalArr;
		$this->load->view('roomList', $view);
	}
	
	/**
	 * 删除房间及牌位
	 */
	function delRoom()
	{
	    if(!hasPerssion($_SESSION['role'], 'delRoom')){
	        exit('无权限,请点击左栏目操作');
	    }
		$roomId = intval($this->input->post_get('roomId'));
		$delResult = $this->Room_model->delRoom($roomId);
		if($delResult)
		{
			$this->load->view('success');
		}else {
			$this->load->view('failure');
		}
	}
    /**
     * 房间对应的牌位列表
     */
	function roomInfos()
	{
	    if(!hasPerssion($_SESSION['role'], 'postionList')){
	        exit('无权限,请点击左栏目操作');
	    }	    
	    $roomId = intval($this->input->post_get('roomId'));
	    $result = $this->Room_model->roomInfos($roomId);
	    if(!$result)
	    {
	    	exit('出错了，暂时没有相关数据！');
	    }
	    $view['roomInfos'] = $result;
	    $adminInfos = $this->Room_model->adminUser($result['user_id']);
	    $view['userInfos'] = $adminInfos;
	    $this->load->view('roomInfos', $view);
	}  
	
	/**
	 * 房间编辑信息
	 */
	function updateRoom()
	{
	    if(!hasPerssion($_SESSION['role'], 'updateRoom')){
	        exit('点击左栏目操作,无权限');
	    }
		$roomId = intval($this->input->post_get('roomId'));
		$result = $this->Room_model->roomInfos($roomId);
		if(!$result)
		{
			exit('出错了，暂时没有相关数据！');
		}	
		$view['roomInfos'] = $result;
		$this->load->view('updateRoom', $view);
	}
	
	/**
	 * 处理房间信息
	 */
	function updateRoomDeal()
	{
	    if(!hasPerssion($_SESSION['role'], 'updateRoom')){
	        exit('无权限,请点击左栏目操作');
	    }	    
		$roomId = intval($this->input->post_get('room_id'));
		$room_flag = intval($this->input->post_get('room_flag'));
		$room_type = intval($this->input->post_get('room_type'));
		if(!$roomId || $roomId < 1)
		{
			exit('出错了，暂时没有相关数据！');
		}
		if(!in_array($room_type,array(0,1)))
		{
			exit('出错了，房间类型不对！');
		}
		$room_alias = addslashes($this->input->post_get('room_alias'));
		$room_description = addslashes($this->input->post_get('room_description'));
		
		$result = $this->Room_model->updateRoomDeal($roomId,$room_alias,$room_description,$room_flag,$room_type);
		// 同时修改牌位
		$resPos = $this->Room_model->updateTable('fu_location_list',array('location_isshow'=>$room_flag,'location_type'=>$room_type), array('location_room_id'=>$roomId));
		if($result)
		{
			$this->load->view('success');
		}else {
			$this->load->view('failure');
		}
	}
	
	function roomOpenPosition()
	{
	    if(!hasPerssion($_SESSION['role'], 'postionList')){
	        exit('无权限,请点击左栏目操作');
	    }
		// 总房间数
		$roomTotal = $this->Room_model->roomTotal();
		if(!$roomTotal)
		{
			echo '暂时没有相关房间,请先开设房间';
			echo "<a href='/Room/roomOpen'>点击开设房间</a>";
			exit;
		}
		$totalPage = ceil($roomTotal/PAGESIZE);
		$page = $this->input->post_get('page');
		if(!$page)
		{
			$page = 1;
		}elseif($page > $totalPage)
		{
			$page = $totalPage;
		}
		
		$view['roomList'] = array();
		$roomList = $this->Room_model->roomList($page);
		if($roomList)
		{
			$view['roomList'] = $roomList;
			if($page > 1)
			{
				$view['indexPage'] = 1;
			}
			if($page < $totalPage)
			{
				$view['endPage'] = $totalPage;
			}
			$view['total'] = $roomTotal;	
			$view['page'] = $page;	
			$view['totalPage'] = $totalPage;
			$view['roomTotal'] = $roomTotal;
		}
		$this->load->view('roomOpenPosition', $view);
	}
	
	/**
	 * 房间对应的牌位列表
	 */
	function postionList()
	{
		$roomId = intval($this->input->post_get('id'));
		$total = $this->Room_model->posTotal($roomId);	
		if(!$total)
		{
			echo '该房间暂时没有牌位，请删除该房间，然后';
			echo "<a href='/Room/roomOpen'>点击开设房间</a>";
			exit;			
		}
		$page = $this->input->post_get('page');
		$totalPage = ceil($total/PAGESIZE);
		if(!$page)
		{
			$page = 1;
		}elseif($page > $totalPage)
		{
			$page = $totalPage;
		}
		
		if($page > 1)
		{
			$view['indexPage'] = 1;
		}
		if($page < $totalPage)
		{
			$view['endPage'] = $totalPage;
		}
		$view['page'] = $page;
		$view['totalPage'] = $totalPage;
		$view['total'] = $total;
		$view['roomId'] = $roomId;
		$posList = $this->Room_model->posList($roomId,$page,PAGESIZE);	
		$view['result'] = $posList;
		$this->load->view('postionList', $view);
	}
	
	/**
	 * 牌位编辑
	 */
	function posLocation()
	{
	    if(!hasPerssion($_SESSION['role'], 'posLocation')){
	        exit('无权限,请点击左栏目操作');
	    }	    
		$locationId = $this->input->post_get('id');
		if($locationId < 1)
		{
			echo '没有相关数据！';
			echo "<a href=\"javascript:history.go(-1)\">点击返回</a>";	
			exit;		
		}
		$locationId = intval($locationId);
		$result = $this->Room_model->posLocation($locationId);
		if(!$result)
		{
			echo '没有相关数据！';
			echo "<a href=\"javascript:history.go(-1)\">点击返回</a>";
			exit;			
		}

		$view['result'] = $result;
		$view['status'] = $result['location_status'];
		$view['sale'] = $result['location_number'];
		$userInfo = array();
		$orderInfo = array();	
		if($result['location_status'] < 2) 
		{
		    $this->load->model('Order_model');
		    $rr = $this->Order_model->searchInfos('fu_order_info', array('order_location_id'=>$result['localtion_id']));
		    $orderInfo = isset($rr[0]) && ($rr[0]) ? $rr[0] : '';
		    $userBody = isset($orderInfo['order_user']) && $orderInfo['order_user'] ? $orderInfo['order_user'] : '';
		    $rrr = $this->Order_model->searchInfos('fu_user', array('body_id'=>$userBody));
		    $userInfo = isset($rrr[0]) && ($rrr[0]) ? $rrr[0] : '';
		}
		$view['orderInfo'] = $orderInfo;
		$view['userInfo'] = $userInfo;   
		$view['front_domain'] = FRONT_DOMAIN;
		$this->load->view('posLocation', $view);
	}
	
	/**
	 * 牌位查看
	 */
	function posLocationDetail()
	{
		$locationId = $this->input->post_get('id');
		if($locationId < 1)
		{
			echo '没有相关数据！';
			echo "<a href=\"javascript:history.go(-1)\">点击返回</a>";
			exit;
		}
		$locationId = intval($locationId);
		$result = $this->Room_model->posLocation($locationId);
		if(!$result)
		{
			echo '没有相关数据！';
			echo "<a href=\"javascript:history.go(-1)\">点击返回</a>";
			exit;
		}
	
		$view['result'] = $result;
		$view['front_domain'] = FRONT_DOMAIN;
		$this->load->view('posLocationDetail', $view);
	}	
	
	/**
	 * 处理牌位编辑
	 */
	function posLocationDeal()
	{
	    if(!hasPerssion($_SESSION['role'], 'posLocation')){
	        exit('无权限,请点击左栏目操作');
	    }	    
		$localtion_id = $this->input->post_get('localtion_id');
		$user_id = $this->input->post_get('user_id');
		$user_telphone = $this->input->post_get('user_telphone');
		$param['user_id'] = $user_id;
		$param['user_telphone'] = $user_telphone;
		if(!$localtion_id)
		{
			echo '出错了！';
			echo "<a href=\"javascript:history.go(-1);\">点击返回</a>";
			exit;
		}
		$location_price = $this->input->post_get('location_price');
		$location_type = $this->input->post_get('location_type');
		$location_alias = addslashes($this->input->post_get('location_alias'));
		$location_details = addslashes($this->input->post_get('location_details'));
		
		$location_area = addslashes($this->input->post_get('location_area'));
		$location_prefix = addslashes($this->input->post_get('location_prefix'));
		
		$location_code = addslashes($this->input->post_get('location_code'));
		$location_number = intval($this->input->post_get('location_number'));
		$location_status = intval($this->input->post_get('location_status'));
		if($location_status && $location_number == 2)
		{
		    $location_status = 0;
		}else {
		    $location_status = 1;
		}
		// $location_ispayment = intval($this->input->post_get('location_ispayment'));
		// $location_paytime = '';
		// 上传图片
		$filePic = '';
		if($_FILES['location_pic_new']['name'])
		{
			$filePic = fileUpload($_FILES['location_pic_new']);
		}
		// $result = $this->Room_model->posLocationDeal($localtion_id,$location_price,$location_type,$location_alias,$location_details,$filePic,$location_number,$location_ispayment,$location_paytime);
		$result = $this->Room_model->posLocationDeal($localtion_id,$location_price,$location_type,$location_alias,$location_details,$filePic,$location_area,$location_prefix,$location_code,$location_number,$location_status,$param);
		if($result)
		{
			$this->load->view('success');
		}else {
			$this->load->view('failure');
		}
	}
	
	/**
	 * 删除牌位
	 */
	function delPos()
	{
	    if(!hasPerssion($_SESSION['role'], 'delPos')){
	        exit('无权限,请点击左栏目操作');
	    }	    
		$localtion_id = $this->input->post_get('id');
		if(!$localtion_id)
		{
			echo '出错了！';
			echo "<a href=\"javascript:history.go(-1);\">点击返回</a>";
			exit;
		}
		$result = $this->Room_model->delPos($localtion_id);
		if($result)
		{
			$this->load->view('success');
		}else {
			$this->load->view('failure');
		}
	}
	
	/**
	 * 房间牌位信息查询
	 */
	function roomPosList()
	{
	    if(!hasPerssion($_SESSION['role'], 'postionList')){
	        exit('无权限,请点击左栏目操作');
	    }	    
		//$roomList = $this->Room_model->roomPosList();
		//$roomList = '';
		$view['room_id'] = 'all';
		$view['type'] = 'all';
		$view['status'] = 'all';
		// $view['roomList'] = $roomList;
		$this->roomPosListSearch();
	    //$this->load->view('roomPosList',$view);
	}
	
	/**
	 * 根据查询条件筛选出的房间牌位信息
	 */
	function roomPosListSearch()
	{
		$view = array();
		$param = array();
		// 房间号
		$room_id = $this->input->get_post('roomId');
		if(!$room_id)
		{
			$param['location_room_id'] = 'all';
			$view['room_id'] = 'all';
		}else {
			$param['location_room_id'] = $room_id;
			$view['room_id'] = $room_id;
		}
	    // 按条件选
	    $type =  intval($this->input->get_post('type')); 
	    $searchTxt =  $this->input->get_post('searchTxt');
	    if($type && $searchTxt)
	    {
	        $this->load->model('Order_model');
	        if($type == 1)
	        {
	           $res = $this->Order_model->searchInfos('fu_order_info',array('order_user'=>$searchTxt));
	           if($res)
	           {
	               $location_id = $res[0]['order_location_id'];
	               header("location:/Room/posLocation?id=" .$location_id);
	           }else {
	               echo "没有相关数据，&nbsp;<a href='/Room/roomPosList'>点击返回</a>";exit;
	           }
	        }elseif($type == 4)
	        {
	            // 不是数字
	            if(!is_numeric($searchTxt))
	            {
	                $resLocation = $this->Order_model->checkNoForCode($searchTxt);
	                if(!$resLocation)
	                {
	                    // 再次判断
	                    $length = strlen($searchTxt);
	                    $str = substr($searchTxt,0,-2);
	                    $str .= substr($searchTxt,-1,1);
	                    $locationListInfo = $this->Order_model->checkNoForCode($str);
	                    if(!$locationListInfo)
	                    {
	                        echo "没有相关数据，&nbsp;<a href='/Order/orderList'>点击返回</a>";
	                        exit;
	                    }
	                    header("location:/Room/posLocation?id=" .$locationListInfo['localtion_id']);
	                }
	            }else {
	                // 是数字
	                $searchTxt = intval($searchTxt);
	                $res = $this->Order_model->searchInfos('fu_location_list',array('localtion_id'=>$searchTxt));
	                if(!$res)
	                {
	                    echo "没有相关数据，&nbsp;<a href='/Room/roomPosList'>点击返回</a>";exit;
	                }else {
	                    header("location:/Room/posLocation?id=" .$searchTxt);
	                }
	            }
	        }else
	        {
	            if($type == 2)
	            {
	               $res = $this->Order_model->searchInfos('fu_user',array('user_telphone'=>$searchTxt));
	            }else{
	                $res = $this->Order_model->searchInfos('fu_user',array('user_phone'=>$searchTxt));
	            }
	            
	            if($res)
	            {
	               if(count($res) == 1)
	               {
	                $user_location_id = $res[0]['user_location_id'];
	                if(!$user_location_id)
	                {
	                     echo "没有相关数据，&nbsp;<a href='/Room/roomPosList'>点击返回</a>";exit;
	                }
	                header("location:/Room/posLocation?id=" .$user_location_id);
	               }else {
	                   echo '选择要查看的' . "<br />";
	                   foreach($res as $kk=>$vv)
	                   {
	                       echo "<a href='/Room/posLocation?id=".$vv['user_location_id']."'>".$vv['body_id']."</a><br />"; 
	                   }
	                   exit;
	               }
	                
	            }else {
	                 echo "没有相关数据，&nbsp;<a href='/Room/roomPosList'>点击返回</a>";exit;
	            }
	        }
	        
	    }
		// 牌位类型
		$positionType = $this->input->get_post('positionType');
		if(!$positionType)
		{
			$param['location_type'] = 'all';
			$view['type'] = 'all';
		}else {
			$param['location_type'] = $positionType;
			$view['type'] = $positionType;
			if($positionType == 2)
			{
				$param['location_type'] = '0';
			}
		}
	
		// 出售状态
		$status = $this->input->get_post('status');
		if(!$status)
		{
			$view['status'] = 'all';
			$param['location_number'] = 'all';
		}else {
			$view['status'] = $status;
			$param['location_number'] = $status;
			if($status == 3)
			{
				$param['location_number'] = '0';
			}
		}
		// 房间列表
		// $roomList = $this->Room_model->roomPosList();
		$roomList = $this->Room_model->roomPosListDetails();
		$roomArr = array();
		if($roomList)
		{
			foreach($roomList as $k=>$v)
			{
				$roomArr[$v['room_id']] = $v;
			}
		}
		$view['roomList'] = $roomArr;	
		// 获取牌位总数目
		$roomLocationTotal = $this->Room_model->roomLocationTotal($param);
		if(!$roomLocationTotal)
		{
			echo '没有相关数据！';
			echo "&nbsp;<a href=\"javascript:history.go(-1);\">点击返回</a>";
			exit;
		}
		//页码
		$page = $this->input->get_post('page');
		if(!$page)
		{
			$page = 1;
		}
		// 总页码
		$totalPage = ceil($roomLocationTotal/PAGESIZEPOS);
		if($page > $totalPage)
		{
			$page = $totalPage;
		}
		
		if($page > 1)
		{
			$view['indexPage'] = 1;
			$view['prePage'] = $page - 1;
		}
		
		if($page < $totalPage)
		{
			$view['endPage'] = $totalPage;
			$view['nextPage'] = $page+1;
		}
		
		$param['page'] = $page;
		$param['pageSize'] = PAGESIZEPOS;
		$result = $this->Room_model->roomPosListSearch($param);
		$view['total'] = $roomLocationTotal; 
		$view['page'] = $page;
		$view['pageTotal'] = $totalPage;
		$view['result'] = $result;
		$view['roomLocationTotal'] = $roomLocationTotal;
		$this->load->view('roomPosListSearch',$view);
	}	
	/**
	 * 批量修改展示页
	 */
	function roomPosMod()
	{
	    if(!hasPerssion($_SESSION['role'], 'posLocation')){
            exit('无权限,请点击左栏目操作');
	    }	    
	    $view['max_min'] = $this->Room_model->maxMinPos();
	    $this->load->view('roomPosMod', $view);
	}
	
	/**
	 * ajax批量处理
	 */
	function modifyInfo()
	{
	    if(!hasPerssion($_SESSION['role'], 'posLocation')){
	        $data = array('error'=>1,'msg'=>'无权限操作');
	        die(json_encode($data));
	    }	    
		$data = array('error'=>1,'msg'=>'非法操作');
		$start = $this->input->get_post('start');
		$end = $this->input->get_post('end');
		$type = $this->input->get_post('type');
		if(!$start || !$end)
		{	
			die(json_encode($data));
		}
		$start = intval($start);
		$end = intval($end);
		$max_min = $this->Room_model->maxMinPos();

		if($start < $max_min['min'] || $end > $max_min['max'] || $start > $end)
		{
			die(json_encode($data));
		}
		$param['start'] = $start;
		$param['end'] = $end;
		// 类型修改
		if($type && $type == 'type')
		{
			$location_type = intval($this->input->get_post('location_type'));
			$param['type'] = 'type';
			$param['location_type'] = $location_type;
			$res = $this->Room_model->modifyMuti($param);
			$data = array('error'=>0,'msg'=>'类型修改成功');
			die(json_encode($data));
		}elseif($type && $type == 'price')
		{
			// 价格
			$location_price = $this->input->get_post('price');
			$param['type'] = 'price';
			$param['location_price'] = $location_price;
			$res = $this->Room_model->modifyMuti($param);
			$data = array('error'=>0,'msg'=>'类型修改成功');
			die(json_encode($data));			
		}elseif($type && $type == 'details')
		{
			// 详情
			$location_details = $this->input->get_post('details');
			$param['type'] = 'details';
			$param['location_details'] = $location_details;
			$res = $this->Room_model->modifyMuti($param);
			$data = array('error'=>0,'msg'=>'类型修改成功');
			die(json_encode($data));			
		}
	}
	
}
