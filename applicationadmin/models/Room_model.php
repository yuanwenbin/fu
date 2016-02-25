<?php
class Room_model extends CI_Model
{
	/**
	 * 获取最大的房间号
	 */
	function roomMax()
	{
		$sql = "select max(room_id) as roomId from fu_room_list";
		$roomResult = $this->db->query($sql);
		if($roomResult->num_rows() < 1)
		{
			return '';
		}else {
			$idResult= $roomResult->row();
			return $idResult->roomId;
		}
	}
	
	/**
	 * 
	 * @param int $userId 用户id
	 * @param int $number 房间数
	 * @param int $flag 是否开放房间，1开放,0-不开放
	 * @param int $datetime 设置房间时间
	 * @param int $alias 设置房间别名
	 * @param int $description 设置房间描述
	 */
	function roomOpenAdd($userId,$number,$flag,$datetime,$alias,$description,$type)
	{
		$sql = "insert into fu_room_list(room_number,room_flag,user_id,room_time,room_alias,room_description,room_type) values
				(".$number.", ".$flag.", ".$userId.", ".$datetime.",'".$alias."', '".$description."','".$type."')";
		$this->db->query($sql);
		return $this->roomMax();
	}
	
	/**
	 * @deprecated 房间的总数目
	 */
	function roomTotal()
	{
		$sql = "select count(*) as total from fu_room_list";
		$result = $this->db->query($sql);
		if($result->num_rows() <= 0)
		{
			return '';
		}
		$rowResult = $result->row();
		return $rowResult->total;
	}
	
	/**
	 * @deprecated 对应的房间牌位数目
	 * @param int $roomId 房间号
	 */
	function posTotal($roomId)
	{
		$sql = "select count(*) as total from fu_location_list where location_room_id=".$roomId;
		$result = $this->db->query($sql);
		if($result->num_rows() <= 0)
		{
			return '';
		}
		$rowResult = $result->row();
		return $rowResult->total;		
	}
	
	/**
	 * @deprecated 牌位列表
	 * @param int $roomId 房间号
	 * @param int $page 页码
	 * @param int $pageSize 每页大小
	 */
	function posList($roomId,$page,$pageSize)
	{
		$sql = "select * from fu_location_list where location_room_id = " . $roomId . " limit " .
				($page-1) * $pageSize . "," . $pageSize;
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	/**
	 * @param int $page 页码数
	 * 房间列表
	 */
	function roomList($page)
	{
		$startNumber = ($page - 1) * PAGESIZE;
		$sql = "select * from fu_room_list order by room_flag desc,room_id desc limit " . $startNumber . ", " . PAGESIZE;
		$res = $this->db->query($sql);
		return $res->result_array();
	}
	
	/**
	 * @deprecated 删除房间及牌位
	 * @param int $roomId 房间位
	 */
	function delRoom($roomId)
	{
		$this->db->trans_start();
		$sqlDel = "delete from fu_room_list where room_id = " . $roomId;
		$sqlDelPos = "delete from fu_location_list where location_room_id = " . $roomId;
		$this->db->query($sqlDel);
		$this->db->query($sqlDelPos);
		$this->db->trans_complete();
		// 操作失败
		if ($this->db->trans_status() === FALSE)
		{
			return '';
		}
		return 1;
	}
	
	/**
	 * @deprecated 牌位开设
	 * @param int $roomId 房间号
	 * @param int $roomNumber 牌位数
	 * @param float $price 价格
	 * @param int $location_isshow 是否显示
	 */
	// ($roomId,$openFlag,$location_area,$location_prefix,$location_code,$location_numbers,$price);
	/*
	function roomOpenPosition($roomId,$roomNumber,$price,$location_isshow)
	{
		$roomNum = '';
		$sql = "insert into fu_location_list(location_room_id,location_price,location_isshow) values ";
		for($i=0; $i<$roomNumber; $i++)
		{
			$roomNum .= "(" .$roomId . ",".$price.", ".$location_isshow."),";
		}
		$roomNum = substr($roomNum,0,-1);
		$sql .= $roomNum;
		$this->db->query($sql);
	}
	*/
	/**
	 * 
	 * @param int $roomId 房间号
	 * @param int $openFlag 是否显示
	 * @param array $location_area 区域名称 
	 * @param array $location_prefix 区域前缀
	 * @param array $location_code 开始代码
	 * @param array $location_numbers 开始数量
	 * @param array $price 开始价格
	 */
	function roomOpenPosition($roomId,$openFlag,$location_area,$location_prefix,$location_code,$location_numbers,$price,$type)
	{
		$roomNum = "";
		$sql = "insert into fu_location_list(location_room_id,location_price,location_isshow,location_area,location_prefix,location_code,location_type) values ";
		for($i=0; $i<count($location_area); $i++)
		{
			$numbers = $location_numbers[$i];
			$start_code = $location_code[$i];
			for($j=0;$j<$location_numbers[$i]; $j++)
			{
				$roomNum .= "('" .$roomId . "','".$price[$i]."', '".$openFlag."','".$location_area[$i]."','".$location_prefix[$i]."','".$start_code."','".$type."'),";
				$start_code++;
			}
		}
		$roomNum = substr($roomNum,0,-1);
		$sql .= $roomNum;
		$this->db->query($sql);		
	}
	/**
	 * @deprecated 房间相关信息
	 * @param int $roomId 房间号码
	 */
	function roomInfos($roomId)
	{
	    $sql = "select * from fu_room_list where room_id = " . $roomId;
	    $res = $this->db->query($sql);
	    return $res->row_array();	    
	}
	
	/**
	 * @deprecated 对应的房间牌位总数
	 * @param int $pageSize 每页大小
	 */
	function locationNumber($roomId)
	{
	    $sql = "select count(*) as total from fu_location_list where location_room_id = " . $roomId;
	    $res = $this->db->query($sql);
	    return $res->row_array();
	}
	
	/**
	 * @deprecated 查询相关管理员
	 * @param int $userId 用户ID
	 */
	function adminUser($userId)
	{
		$sql = "select * from fu_admin where admin_id =" . $userId;
		$res = $this->db->query($sql);
		return $res->row_array();
	}
	
	/**
	 * @deprecated 修改房间信息
	 * @param int $roomId 房间id
	 * @param string $room_alias 房间别名
	 * @param string $room_description 房间描述
	 * @param int $room_flag 是否开启
	 */
	function updateRoomDeal($roomId,$room_alias,$room_description,$room_flag, $room_type)
	{
		$sql = "update fu_room_list set room_alias = '".$room_alias."', room_description = '".$room_description."',
				room_flag = " . $room_flag . ",room_type = " . $room_type . " where room_id = " . $roomId;
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	/**
	 * @deprecated 牌位查询
	 * @param int $locationId 牌位号码
	 */
	function posLocation($locationId)
	{
		$sql = "select * from fu_location_list where localtion_id = " . $locationId;
		$res = $this->db->query($sql);
		return $res->row_array();
	}
	
	/**
	 * @deprecated 牌位设置
	 * @param int $localtion_id 牌位
	 * @param float $location_price 价格
	 * @param int $location_type 类型
	 * @param string $location_alias 名称
	 * @param string $location_details 描述
	 * @param string $filePic 图片名
	 */
	function posLocationDeal($localtion_id,$location_price,$location_type,$location_alias,$location_details,$filePic,$location_area,$location_prefix,$location_code,$location_number,$location_status)
	{
		/*
		$sql = "update fu_location_list set location_price = " . $location_price .",location_type = " . $location_type .
		",location_alias = '" . $location_alias . "',location_details = '".$location_details."', location_number = " . $location_number .
		", location_ispayment =" . $location_ispayment . ", location_paytime = " . $location_paytime;
		if($filePic)
		{
			$sql .= ",location_pic = '".$filePic."'";
		}
		if($location_number == 2)
		{
			$sql .= ",location_date = 0";	
		}
		$sql .= " where localtion_id = " . $localtion_id;
		$this->db->query($sql);
		return $this->db->affected_rows();
		*/
		$sql = "update fu_location_list set location_price = " . $location_price .",location_type = " . $location_type .
		",location_alias = '" . $location_alias . "',location_details = '".$location_details . "'," .
		"location_area = '" . $location_area . "', location_prefix = '" . $location_prefix . "',location_code = '" . $location_code . "',".
		"location_number = '" . $location_number ."',location_status = '".$location_status."'";
		if($filePic)
		{
			$sql .= ",location_pic = '".$filePic."'";
		}

		$sql .= " where localtion_id = " . $localtion_id;
		$this->db->query($sql);
		return $this->db->affected_rows();		
	}
	
	/**
	 * 房间信息统计
	 * 
	 */
	function roomTongJiModel()
	{
		// 更新用户表
		$sql = "SELECT location_room_id,count(*) as total FROM `fu_location_list` 
				GROUP BY location_room_id order by location_room_id asc";
		$result = $this->db->query($sql);
		if($result->num_rows() <= 0)
		{
			return '';
		}
		return $result->result_array(); 
	}
	
	/**
	 * @deprecated 删除牌位
	 * @param int $locationId 牌位
	 */
	function delPos($locationId)
	{
		$sql = "delete from fu_location_list where localtion_id = " . $locationId;
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	/**
	 * 获取房间号
	 */
	function roomPosList()
	{
	    $sql = "select room_id from fu_room_list";
	    $res = $this->db->query($sql);
	    return $res->result_array();
	}
	
	/**
	 * 获取房间信息
	 */
	function roomPosListDetails()
	{
		$sql = "select * from fu_room_list";
		$res = $this->db->query($sql);
		return $res->result_array();
	}	
	
	/**
	 * 
	 * @param array $param 条件查询
	 */
	function roomLocationTotal($param)
	{
		$where = "";
		foreach($param as $k=>$v)
		{
			if($v != 'all')
			{
				$where .= $k ."='" . $v ."' and ";
			}
		}
		$sql = "select count(*) as total from fu_location_list";
		if($where)
		{
			$where = " where " . substr($where,0,-4);
			$sql .= $where;
		}
		$result = $this->db->query($sql);
		$rowResult = $result->row();
		return $rowResult->total;
	}
	
	/**
	 * @deprecated 根据查询相关数据
	 * @param unknown $param
	 */
	function roomPosListSearch($param)
	{
		$where = "";
		foreach($param as $k=>$v)
		{
			if($k == 'page' || $k == 'pageSize')
			{
				continue;
			}
			if($v != 'all')
			{
				$where .= $k . " = '" . $v ."' and ";
			}
		}
		if($where)
		{
			$where = " where " . substr($where,0,-4);
		}
		$startNumber = ($param['page'] - 1) * $param['pageSize'];
		$sql = "select * from fu_location_list " . $where . " limit " . $startNumber . ", " . $param['pageSize'];
		$res = $this->db->query($sql);
		return $res->result_array();		
	}
	
	/**
	 * 更新表
	 * @param string $table
	 * @param array $param
	 * @param array $where
	 */
	function updateTable($table,$param, $where)
	{
		$str = " set ";
		foreach($param as $k=>$v)
		{
			$str .= $k . " = '" . $v . "',";
		}
		$str = substr($str,0,-1);
		$whereStr = " where ";
		foreach($where as $kk=>$vv)
		{
			$whereStr .= $kk . " = '" . $vv . "' and ";
		}
		$whereStr = substr($whereStr,0,-4);
		$sql = "update " . $table . " " .$str . " " . $whereStr;
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	/**
	 * 最大值，最小值
	 */
	function maxMinPos()
	{
	    $data = array('min'=>0,'max'=>0);
	    $minSQL = "select localtion_id from fu_location_list order by localtion_id asc limit 1";
	    $maxSQL = "select localtion_id from fu_location_list order by localtion_id desc limit 1";
	    $minResult = $this->db->query($minSQL);
	    if($minResult->num_rows() <= 0)
	    {
	        return $data;
	    }
	    $rowMinResult = $minResult->row();
	    
	    $data['min']=$rowMinResult->localtion_id;	

	    $maxResult = $this->db->query($maxSQL);

	    $rowMaxResult = $maxResult->row();
	    $data['max'] = $rowMaxResult->localtion_id;
	    return $data;
	    
	}
	
	/**
	 * 批量修改
	 * @param unknown $param
	 */
	function modifyMuti($param)
	{
		// 类型修改
		if($param['type'] == 'type')
		{
			$location_type = $param['location_type'];
			if(!$location_type)
			{
				$location_type = 0;
			}
			$sql = "update fu_location_list set location_type = " . $location_type . " where localtion_id >= " . $param['start'] . " 
					and localtion_id <= " . $param['end'] . " and location_number = 2";
			$this->db->query($sql);
			return $this->db->affected_rows();			
		}elseif($param['type'] == 'price')
		{
			// 修改价格
			$location_price = $param['location_price'];
			if(!$location_price)
			{
				$location_price = 0;
			}
			$sql = "update fu_location_list set location_price = " . $location_price . " where localtion_id >= " . $param['start'] . "
					and localtion_id <= " . $param['end'] . " and location_number = 2";
			$this->db->query($sql);
			return $this->db->affected_rows();			
		}elseif($param['type'] == 'details')
		{
			// 修改详情
			$location_details = $param['location_details'];
			if(!$location_details)
			{
				$location_details = '';
			}
			$sql = "update fu_location_list set location_details = '" . $location_details . "' where localtion_id >= " . $param['start'] . "
					and localtion_id <= " . $param['end'] . " and location_number = 2";
			$this->db->query($sql);
			return $this->db->affected_rows();			
		}
	}
	
	/**
	 * 查看单表
	 * @param unknown $table
	 * @param unknown $param
	 * @return array 单条记录
	 */
	function searchUser($table,$param)
	{
		$where = " ";
		foreach($param as $k=>$v)
		{
			$where .= " " . $k . " = '" . $v . "' and";
		}
	
		$where = substr($where, 0, -4);
	
		$sql = "select * from ".$table." where " . $where;
		$res = $this->db->query($sql);
		if($res)
		{
			return $res->row_array();
		}else {
			return '';
		}
	}

	/**
	 * 单表插入
	 * @param unknown $table
	 * @param unknown $param
	 */
	function insertOrder($table,$param)
	{
		$key = "";
		$value = "";
		foreach($param as $k=>$v)
		{
			$key .= $k . ",";
			$value .= "'" . $v . "',";
		}
		$key = substr($key,0,-1);
		$value = substr($value,0,-1);
		$sql = "insert into " . $table ."(".$key .") values (" . $value . ")";
		$this->db->query($sql);
		return $this->db->insert_id();
	}	
	
	
}