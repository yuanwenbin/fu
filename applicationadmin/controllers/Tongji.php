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
	        header("Location:".URL_APP_C."/Index/login");
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
	    $this->load->model('Order_model');
	    // bof牌位编号 
	    $location_info = trim($this->input->get_post('location_info'));
	   
	    if($location_info)
	    {
			if(!is_numeric($location_info))
			{	
				$resLocation = $this->Order_model->checkNoForCode($location_info);
				if(!$resLocation)
				{
					// 再次判断
					$length = strlen($location_info);
					$str = substr($location_info,0,-2);
					$str .= substr($location_info,-1,1);
					$resLocation = $this->Order_model->checkNoForCode($str);
				}
			}else {
				 $resLocation = $this->Order_model->posInfosModel('fu_location_list', array('localtion_id'=>$location_info));
				 if($resLocation)
				 {
				 	$resLocation = $resLocation[0];
				 }
			}
			if(!$resLocation)
			{
				echo "没有相关数据，&nbsp;<a href='".URL_APP_C."/Tongji/tongjiList'>点击返回</a>";
				exit;
			}
			$view = array();
			$view['list'] = $resLocation;
			$this->load->view('tongjiListForLocation',$view);
    	// eof牌位编号
	    }else {
		    $param = array();
		    $condition = array();
		    // 开始时间
		    if($startTime && $startTime != '')
		    {
		    	$param['startTime'] = strtotime($startTime);
		    	$startTime = strtotime($startTime);
		    	$condition['startTime'] = $startTime;
		    }	    
			
		    // 结束时间
		    if($endTime && $endTime != '')
		    {
		    	$param['endTime'] = strtotime($endTime);
		    	$endTime = strtotime($endTime);
		    	$condition['endTime'] = $endTime;
		    }	    
			
		    // 当前选择的号
		    $page = $this->input->get_post('page');
		    if(!$page)
		    {
		    	$page = 1;
		    }else {
		    	$page = intval($page) > 0 ? intval($page) : 1;
		    }
		    
	
		    // 福位号
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
		    // 总福位数
		    $roomCount = $this->Tongji_model->queryCount('fu_room_list');
		    //  总牌位数
		    if($roomId)
		    {
		        $location_room['location_room_id'] = $roomId;
		        $condition['location_room_id'] = $roomId;
		    }else {
		        $location_room= array();
		    }
		   
		    $posCount = $this->Tongji_model->queryCount('fu_location_list',$location_room);
		    
		    // 条件查询总数
		    $posCountCondition = $this->Tongji_model->queryCountCondtion('fu_location_list',$condition);
		        
		    // 正在/已经出售的牌位数
		    $totalNumber = $this->Tongji_model->tongjiTotalPos($param);
		   
	        //已经出售
	        //$totalNum = $this->Tongji_model->tongjiTotalPos($param);
	        $param['page'] = $page;
	        $condition['page'] = $page;
	        // 销售列表
	        $list = $this->Tongji_model->orderList($condition);
	        // print_r($list);
		    // 福位列表
		    $roomList = $this->Tongji_model->tongRoomList();
		 	$view['total'] = $posCount;
		    $view['roomList'] = $roomList; // 福位列表
		    $view['posIng'] = $totalNumber[0]; // 正在出售中
		    $view['room_list_count'] = $roomCount; // 总福位数
		    $view['posCount'] = $posCount; // 总牌位数
	        $view['complete'] = $totalNumber[1]; // 已经完成数
	        
		    $view['startTime'] = isset($startTime) && $startTime ?  $startTime : ''; // 开始时间
		    $view['endTime'] = isset($endTime) && ($endTime) ? $endTime : ''; // 结束时间
		    $view['list'] = $list;
		    $view['page'] = $page;
	
	        // $view['totalPages'] = ceil($posCount['total']/PAGESIZEFORTONGJI);  
		    $view['totalPages'] = ceil($posCountCondition['total']/PAGESIZEFORTONGJI);
	        $this->load->view('tongjiListNone', $view);
		 }
	     
	}
	
	function tongjiListSearch()
	{
	    if(!hasPerssion($_SESSION['role'], 'tongjiList')){
	        exit('无权限,请点击左栏目操作');
	    }
	    $telPhone = addslashes($this->input->get_post('location_info_tel')); 
	    $res = $this->Tongji_model->tongListSearchForTel($telPhone);
	    if(!$res)
	    {
	        header("Content-type:text/html;charset=utf-8");
	        exit('没有相关数据');
	    }
	    $view['res'] = $res;   
	   $this->load->view('tongjiListSearch', $view);
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
	/**
	 * 导出订单
	 */
	function exportOrder()
	{
	    if(!hasPerssion($_SESSION['role'], 'exportOrder')){
	        exit('无权限,请点击左栏目操作');
	    }
	    if (PHP_SAPI == 'cli'){
	        header("Content-type:html/text;charset=utf-8");
	        die('你的服务器不支持 cli ');
	    }
	    
	    /** Include PHPExcel */
	    require_once dirname(__FILE__) . '/phpexcel/PHPExcel.php';

	    
	    
	    // Create new PHPExcel object
	    $objPHPExcel = new PHPExcel();
	    
	    // Set document properties
	    $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
	    ->setLastModifiedBy("Maarten Balliauw")
	    ->setTitle("Office 2007 XLSX Test Document")
	    ->setSubject("Office 2007 XLSX Test Document")
	    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
	    ->setKeywords("office 2007 openxml php")
	    ->setCategory("Test result file");
	    
	    $objPHPExcel->setActiveSheetIndex(0)
	    ->setCellValue('A1', '身份证号')
	    ->setCellValue('B1', '手机号码')
	    ->setCellValue('C1', '牌位号信息')
	    ->setCellValue('D1', '牌位类型')
	    ->setCellValue('E1', '捐赠时间')
	    ->setCellValue('F1', '是否捐赠')
	    ->setCellValue('G1', '到期时间')
	    ->setCellValue('H1', '福位号')
	    ->setCellValue('I1', '义工')
	    ->setCellValue('J1', '所在的组')
	    ->setCellValue('K1', '时辰')
	    ->setCellValue('L1', '是否增加报备')
	    ->setCellValue('M1', '报备时间')
	    ->setCellValue('N1', '登记次数');
	    
	    //查找订单
	    $orderRes = $this->Tongji_model->exportOrder();
	    if($orderRes && isset($orderRes[0]) && $orderRes[0])
	    {
	       $num = 2;
	       foreach($orderRes as $v)
	       {
	           $order_location_type = '';// 订单类型
	           $order_pay_time = '否'; //支付
	           $birthday = ' '; //生辰
	           $order_datetime = ' '; // 到期时间
	           $user_dateline = '0天'; //增加报备时间
	           $user_regtimes = 0; //登记次数
	           $user_addtime = '否'; //是否增加报备
	           
	           if($v['user_addtime'])
	           {
	               $user_addtime = '是';
	           }
	           
	           if($v['user_regtimes'])
	           {
	               $user_regtimes = $v['user_regtimes'];
	           } 
	           
	           if($v['user_dateline'])
	           {
	               $user_dateline = $v['user_dateline']/24/3600 . '天';
	           }
	
	           if(!$v['order_location_type'])
	           {
	               $order_location_type = '随机';
	           }elseif($v['order_location_type'] == 1)
	           {
	               $order_location_type = '高端定制';
	           }else {
	               $order_location_type = '生辰八字';
	               $birthday .= $v['user_birthday'].'|'.$v['user_time'];
	           }
	           
	           if($v['order_payment'])
	           {
	               $order_pay_time = '是';
	           }else {
	               $order_datetime .= date('Y-m-d H:i:s',$v['order_datetime']+$v['user_dateline']);
	           }

	           $objPHPExcel->setActiveSheetIndex(0)
	           ->setCellValue('A'.$num, ' '.$v['order_user'])
	           ->setCellValue('B'.$num, ' ' . $v['user_telphone'])
	           ->setCellValue('C'.$num, ' '.$v['room_alias'].$v['location_area'].$v['location_prefix'].$v['location_code'].'('.$v['localtion_id'].')')
	           ->setCellValue('D'.$num, $order_location_type)
	           ->setCellValue('E'.$num, ' ' . date('Y-m-d H:i:s', $v['order_datetime']))
	           ->setCellValue('F'.$num, $order_pay_time)
	           ->setCellValue('G'.$num, $order_datetime)
	           ->setCellValue('H'.$num, $v['order_room_id'])
	           ->setCellValue('I'.$num, $v['member_realname'].'|' . $v['member_username'])
	           ->setCellValue('J'.$num, $v['team_name'])
	           ->setCellValue('K'.$num, $birthday)
	           ->setCellValue('L'.$num, $user_addtime)
	           ->setCellValue('M'.$num, $user_dateline)
	           ->setCellValue('N'.$num, $user_regtimes);

	           $num++;
	       }   
	    }
	    
	    // Add some data
	    /*
	    $objPHPExcel->setActiveSheetIndex(0)
	    ->setCellValue('A1', 'Hello')
	    ->setCellValue('B1', 'world!')
	    ->setCellValue('C1', 'Hello')
	    ->setCellValue('D1', 'world!');
	    
	    $objPHPExcel->setActiveSheetIndex(0)
	    ->setCellValue('A2', 'Hello22')
	    ->setCellValue('B2', 'world!2222222')
	    ->setCellValue('C2', 'Hello222222222')
	    ->setCellValue('D2', 'world!222');	    
	    */

	    
	    // Rename worksheet
	    $objPHPExcel->getActiveSheet()->setTitle('订单导出-'.date('Ymd-His', time()));
	    $fileName = '订单导出-'.date('Ymd-His', time()) . '.xlsx';
	    
	    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
	    $objPHPExcel->setActiveSheetIndex(0);
	    
	    
	    // Redirect output to a client’s web browser (Excel2007)
	    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	    header('Content-Disposition: attachment;filename="'.$fileName.'"');
	    header('Cache-Control: max-age=0');
	    // If you're serving to IE 9, then the following may be needed
	    header('Cache-Control: max-age=1');
	    
	    // If you're serving to IE over SSL, then the following may be needed
	    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	    header ('Pragma: public'); // HTTP/1.0
	    
	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	    $objWriter->save('php://output');
	    exit;	    	    
	}
	

}
