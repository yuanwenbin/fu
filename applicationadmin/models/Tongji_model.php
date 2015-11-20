<?php
class Tongji_model extends CI_Model
{    
    /**
     * 统计相关牌位数
     * @param unknown $param
     */
	
    function tongjiTotalPos($param)
    {
    	$startTime = "";
    	$endTime = "";
    	$order_room_id = '';
    	$data[0]=0; //出售中
    	$data[1]=0; // 已经出售
    	//是否选择了房间或日期
    	//$flag = 0;
    	if(isset($param['startTime']) && ($param['startTime']))
    	{
    		$startTime = " location_date >= " . $param['startTime'] . "  ";
    		unset($param['startTime']);
    	}
    	
    	if(isset($param['endTime']) && ($param['endTime']))
    	{
    		$endTime = "  location_date <= " . $param['endTime'] . "  ";
    		unset($param['endTime']);
    	}    	
        
    	if(isset($param['order_room_id']) && ($param['order_room_id']))
    	{
    	    $order_room_id = "  location_room_id = " . $param['order_room_id'] . "  ";
    	    unset($param['order_room_id']);
    	}
    	$sql = "select count(*) as total from fu_location_list ";
    	$sqlAfter1 = " location_number = 1";
    	$sqlAfter2 = " location_number = 0";
    	$sql_1 = ""; // 出售中
    	$sql_2 = ""; // 已经出售
    	if($startTime && $endTime && $order_room_id)
    	{
    	   // $flag = 1;
    	    $sql_1 = $sql ." where " .$startTime . " and " . $endTime . " and " . $order_room_id . " and " . $sqlAfter1;
    	    $sql_2 = $sql ." where " .$startTime . " and " . $endTime . " and " . $order_room_id . " and " . $sqlAfter2;
    	}elseif($startTime && $order_room_id)
    	{
    	    //$flag = 1;
    	    $sql_1 = $sql ." where " .$startTime . " and " . $order_room_id . " and " . $sqlAfter1;
    	    $sql_2 = $sql ." where " .$startTime . " and " . $order_room_id . " and " . $sqlAfter2;
    	}elseif($endTime && $order_room_id)
    	{
    	    //$flag = 1;
    	    $sql_1 = $sql ." where " .$endTime . " and " . $order_room_id . " and " . $sqlAfter1;
    	    $sql_2 = $sql ." where " .$endTime . " and " . $order_room_id . " and " . $sqlAfter2;
    	}elseif($startTime && $endTime){
    	    //$flag = 1;
    	    $sql_1 = $sql ." where " .$startTime . " and " . $endTime .  " and " . $sqlAfter1;
    	    $sql_2 = $sql ." where " .$startTime . " and " . $endTime .  " and " . $sqlAfter2;
    	}elseif($order_room_id)
    	{
    	    //$flag = 1;
    	    $sql_1 = $sql ." where " . $order_room_id . " and " . $sqlAfter1;
    	    $sql_2 = $sql ." where " . $order_room_id . " and " . $sqlAfter2;    	    
    	}elseif($startTime){
    	    //$flag = 1;
    	    $sql_1 = $sql ." where " .$startTime .  " and " . $sqlAfter1;
    	    $sql_2 = $sql ." where " .$startTime .  " and " . $sqlAfter2;    	    
    	}elseif($endTime){
    	    //$flag = 1;
    	    $sql_1 = $sql ." where " . $endTime .  " and " . $sqlAfter1;
    	    $sql_2 = $sql ." where " . $endTime .  " and " . $sqlAfter2;    	    
    	}else {
    	    $sql_1 = $sql ." where " . $sqlAfter1;
    	    $sql_2 = $sql ." where " . $sqlAfter2;
    	}

    	$res = $this->db->query($sql_1);
    	
    	if($res->num_rows() > 0)
    	{
    	    $rowResult = $res->row();
    	    $data[0] = $rowResult->total;    	    
    	}else {
    	    $data[0] = 0;
    	}
    	
    	$res1 = $this->db->query($sql_2);
    	if($res1->num_rows() > 0)
    	{
    	    $rowResult1 = $res1->row();
    	    $data[1] = $rowResult1->total;
    	}else {
    	    $data[1] = 0;
    	} 	
    	return $data;
    }
    
    /**
     * 分组统计
     */
    function tongjiGroupBy($param)
    {
    	
    	$where = " where ";
    	if(isset($param['startTime']) && ($param['startTime']))
    	{
    		$where .= " location_date > " . $param['startTime'] . " and ";
    		unset($param['startTime']);
    	}
    	 
    	if(isset($param['endTime']) && ($param['endTime']))
    	{
    		$where .= "  location_date < " . $param['endTime'] . " and ";
    		unset($param['endTime']);
    	}    	


    	if($param && is_array($param))
    	{
    		foreach($param as $key => $val)
    		{
    			$where .= " " . $key . " = '" . $val . "' and ";
    		}
    	}
    	$where = substr($where,0,-4);
    	$sql = "select count(*) as total,location_number from fu_location_list " . $where . " group by location_number";
        $res = $this->db->query($sql);
    	if($res)
    	{
    		$groupBy = array();
    		$groupByResult = $res->result_array();
    		foreach($groupByResult as $vv)
    		{
    			$groupBy[$vv['location_number']] = $vv['total'];
    		}
    		return $groupBy;
    	}else {
    		return '';
    	} 
    	   	
    }
    
    function tongjiList($param, $page,$pageSize)
    {
    	$where = "where";
        if(isset($param['startTime']) && ($param['startTime']))
    	{
    		$where .= " location_date > " . $param['startTime'] . " and ";
    		unset($param['startTime']);
    	}
    	 
    	if(isset($param['endTime']) && ($param['endTime']))
    	{
    		$where .= "  location_date < " . $param['endTime'] . " and ";
    		unset($param['endTime']);
    	}  

    	if($param && is_array($param))
    	{
    		foreach($param as $key => $val)
    		{
    			$where .= " " . $key . " = '" . $val . "' and ";
    		}
    	}
        if($where == 'where')
    	{
    		$where = '';
    	}else {
    		$where = substr($where,0,-4);
    	}
    	$sql = "select * from fu_location_list " . $where . "  order by location_date desc limit " . ($page - 1) * $pageSize . ", " . $pageSize;
    	$res = $this->db->query($sql);
    	if($res->num_rows() <= 0)
    	{
    		return 0;
    	}
    	return $res->result_array();
    }
    
    /**
     * 清空牌位
     */
    function clearListModel()
    {
        $affectTime = time() - 7200;
        $sql = "select order_location_id from fu_order_info where order_payment = 0 and order_datetime < " . $affectTime;
        $res = $this->db->query($sql);
       
        if($res->num_rows() < 1)
        {
            return 1;
        }
        $affectRes = $res->result_array();
        $ids = "(";
        foreach($affectRes as $v)
        {
            $ids .= $v['order_location_id'] . ",";
        }
        $ids = substr($ids,0,-1) . ")";
        $this->db->trans_start();
        $upSQL = "update fu_location_list set location_number = 2,location_date=0 where localtion_id in " . $ids;
        $delSql = "delete from fu_order_info where order_location_id in " . $ids;
        $userSQL = "delete from fu_user where user_location_id in " . $ids;
        $this->db->query($upSQL);
        $this->db->query($delSql);
        $this->db->query($userSQL);
        $this->db->trans_complete();
		// 操作失败
		if ($this->db->trans_status() === FALSE)
		{
			return '';
		}
		return 1;
    }
    /**
     * 查询表统计
     * @param unknown $tableName
     */
    function queryCount($tableName, $param = array())
    {
        $sql = "select count(*) as total from " . $tableName;
        if($param)
        {
            $where = " where ";
            $str = "";
            foreach($param as $k=>$v)
            {
                $str .= $k . " = '". $v . "' and ";
            }
            $str = substr($str, 0,-4);
            $sql .= $where . $str;
        }
        $res = $this->db->query($sql);
        return $res->row_array();
    }
    /**
     * 统计列表
     * @param unknown $param
     */
    function orderList($param)
    {
        $startTime = "";
        $endTime = "";
        $order_room_id = '';  
        $location_room_id = '';   
        $startNumber = ($param['page']-1) * PAGESIZEFORTONGJI;  
        $limits = " limit " . $startNumber . ", " . PAGESIZEFORTONGJI;
        if(isset($param['startTime']) && ($param['startTime']))
        {
            $startTime = " order_datetime >= " . $param['startTime'] . "  ";
            unset($param['startTime']);
        }
         
        if(isset($param['endTime']) && ($param['endTime']))
        {
            $endTime = "  order_datetime <= " . $param['endTime'] . "  ";
            unset($param['endTime']);
        }
        
        if(isset($param['order_room_id']) && ($param['order_room_id']))
        {
            $order_room_id = "  order_room_id = " . $param['order_room_id'] . "  ";
            $location_room_id = " where location_room_id=" . $param['order_room_id'] . " ";
            unset($param['order_room_id']);
        }        
        /*
        $sql = "select * from fu_order_info";
        if($startTime && $endTime && $order_room_id)
        {
            $sql .= " where " .$startTime . " and " . $endTime . " and " . $order_room_id . $limits;
        }elseif($startTime && $endTime){
            $sql .= " where " .$startTime . " and " . $endTime  . $limits;
        }elseif($startTime && $order_room_id)
        {
            $sql .=" where " .$startTime . " and " . $order_room_id . $limits;
        }elseif($endTime && $order_room_id)
        {
            $sql .=" where " .$endTime . " and " . $order_room_id . $limits;
        }elseif($order_room_id)
        {
            $sql .=" where " . $order_room_id . $limits;;
        }elseif($startTime)
        {
            $sql .= " where " .$startTime . $limits;
        }elseif($endTime)
        {
            $sql .=" where " .$endTime . $limits;
        }
        else{
            $sql = "select * from fu_location_list" . $limits;
        }     
        */
        
        $sql = "select * from fu_order_info";
        if($startTime && $endTime && $order_room_id)
        {
            $sql .= " where " .$startTime . " and " . $endTime . " and " . $order_room_id . $limits;
        }elseif($startTime && $endTime){
            $sql .= " where " .$startTime . " and " . $endTime  . $limits;
        }elseif($startTime && $order_room_id)
        {
            $sql .=" where " .$startTime . " and " . $order_room_id . $limits;
        }elseif($endTime && $order_room_id)
        {
            $sql .=" where " .$endTime . " and " . $order_room_id . $limits;
        }elseif($startTime)
        {
            $sql .= " where " .$startTime . $limits;
        }elseif($endTime)
        {
            $sql .=" where " .$endTime . $limits;
        }
        else{
            if($order_room_id)
            {
                $sql ="select * from fu_location_list " . $location_room_id . $limits;
            }else {
                $sql = "select * from fu_location_list" . $limits;
            }
        }        
        
        
        ///
        $res = $this->db->query($sql);
        if($res->row_array() > 0)
        {
            return $res->result_array();
        }
        return '';
    }
    
    function tongRoomList()
    {
    	$sql = "select * from fu_room_list";
    	$res = $this->db->query($sql);
    	return $res->result_array();
    }
 
}