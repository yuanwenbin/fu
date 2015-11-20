<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tongji extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Tongji_model');
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
	
	function tongjiList()
	{
	    if(!hasPerssion($_SESSION['role'], 'tongjiList')){
	        exit('无权限,请点击左栏目操作');
	    }	    
	    $startTime = $this->input->get_post('datetime');
	    $endTime = $this->input->get_post('datetimes');
	    $roomId = $this->input->get_post('roomList');
	    $param = array();

	    // 开始时间
	    if($startTime && $startTime != '')
	    {
	    	$param['startTime'] = strtotime($startTime)+7200;
	    	$startTime = strtotime($startTime);
	    }	    
		
	    // 结束时间
	    if($endTime && $endTime != '')
	    {
	    	$param['endTime'] = strtotime($endTime)-7200;
	    	$endTime = strtotime($endTime);
	    }	    
		
	    // 当前选择的号
	    $this->input->get_post('page');
        
	    $page = $this->input->get_post('page');
	    if(!$page)
	    {
	    	$page = 1;
	    }else {
	    	$page = intval($page) > 0 ? intval($page) : 1;
	    }
	    
	    
	    
	    // $param_1 = $param;

	    // 房间号
	    if($roomId)
	    {
	    	$param['order_room_id'] = intval($roomId);
	    	$view['order_room_id'] = intval($roomId);
	    }else {
	    	$view['order_room_id'] = '';
	    	$roomId = '';
	    }	    
	    //正在出售
	    //$param_1['location_number'] = 1;
	    //已经出售
	    //$param_2['location_number'] = 0;
	    // 总房间数
	    $roomCount = $this->Tongji_model->queryCount('fu_room_list');
	    //  总牌位数
	    if($roomId)
	    {
	        $location_room['location_room_id'] = $roomId;
	    }else {
	        $location_room= array();
	    }
	   
	    
	    $posCount = $this->Tongji_model->queryCount('fu_location_list',$location_room);
	        
	    // 正在/已经出售的牌位数
	    $totalNumber = $this->Tongji_model->tongjiTotalPos($param);
	   
        //已经出售
        //$totalNum = $this->Tongji_model->tongjiTotalPos($param);
        $param['page'] = $page;
        // 销售列表
        $list = $this->Tongji_model->orderList($param);
        
	    // 房间列表
	    $roomList = $this->Tongji_model->tongRoomList();
	 	
	    $view['roomList'] = $roomList; // 房间列表
	    $view['posIng'] = $totalNumber[0]; // 正在出售中
	    $view['room_list_count'] = $roomCount; // 总房间数
	    $view['posCount'] = $posCount; // 总牌位数
        $view['complete'] = $totalNumber[1]; // 已经完成数
        
	    $view['startTime'] = isset($startTime) && $startTime ?  $startTime : ''; // 开始时间
	    $view['endTime'] = isset($endTime) && ($endTime) ? $endTime : ''; // 结束时间
	    $view['list'] = $list;
	    $view['page'] = $page;
	    // if($startTime || $endTime || $roomId)
	     if($startTime || $endTime)
	    {      
	        $view['totalPages'] = ceil(($totalNumber[0]+$totalNumber[1])/PAGESIZEFORTONGJI);
	        $this->load->view('tongjiList', $view);
	    }else {
	        $view['totalPages'] = ceil($posCount['total']/PAGESIZEFORTONGJI);
	        $this->load->view('tongjiListNone', $view);
	    }
	     
	}
	
	/**
	 *清空无效订单
	 */
	function clearList()
	{
	    if(!hasPerssion($_SESSION['role'], 'clearList')){
	        exit('无权限,请点击左栏目操作');
	    }	    
	    $flag = $this->Tongji_model->clearListModel();
	    if($flag)
	    {
	        echo date('Y-m-d H:i:s', time()).' 操作成功';
	    }else {
	        echo '操作异常，稍后再试';
	    }
	}
	

}
