<?php
class Order_model extends CI_Model
{
    /**
     * 根据条件获取总数
     * @param unknown $param
     * @param unknown $startTime
     * @param unknown $endTime
     * @return string
     */
    function orderTotal($param=array())
    {
        $sql = "select count(*) as total from fu_order_info ";
        $datetime = '';
        $datetimes='';        
        if($param)
        {
            if(isset($param['order_datetime']) && $param['order_datetime'])
            {
                $datetime = " and order_datetime >= " .  $param['order_datetime'];
                unset($param['order_datetime']);
            }
            if(isset($param['order_datetimes']) && $param['order_datetimes'])
            {
                $datetimes = " and order_datetime <= " .  $param['order_datetimes'];
                unset($param['order_datetimes']);
            }            
        }
        $args = "where";
        if($param)
        {
            foreach ($param as $k=>$v)
            {
                $args .= " " . $k . " = '" . $v . "' and ";
            }
            $args = substr($args, 0, -4);
        }
        if($args != "where")
        {
            $sql .= $args . $datetime . $datetimes;
        }else {
            //无时间表
            if($datetime && $datetimes)
            {
                $sql .= " where " . substr($datetime,4) . $datetimes;
            }elseif($datetime && !$datetimes)
            {
                $sql .= " where " . substr($datetime,4);
            }elseif(!$datetime && $datetimes)
            {
                $sql .= " where " . substr($datetimes,4);
            }
        
        }            
       
        $result = $this->db->query($sql);
        if($result->num_rows() <= 0)
        {
            return '';
        }
        $rowResult = $result->row();
        return $rowResult->total;
    }
    
    function orderList($param, $page, $pageSize)
    {
       // $sql = "select * from fu_order_info ";
        $sql = "select * from fu_order_info ";
        $datetime = '';
        $datetimes='';

        if(isset($param['order_datetime']) && $param['order_datetime'])
        {
            $datetime = " and order_datetime >= " .  $param['order_datetime'];
            unset($param['order_datetime']);
        }
        if(isset($param['order_datetimes']) && $param['order_datetimes'])
        {
            $datetimes = " and order_datetime <= " .  $param['order_datetimes'];
            unset($param['order_datetimes']);
        }
        
        
        $args = "where";
        if($param)
        {
            foreach ($param as $k=>$v)
            {
                $args .= " " . $k . " = '" . $v . "' and ";
            }
            $args = substr($args, 0, -4);
        }
        if($args != "where")
        {
            $sql .= $args . $datetime . $datetimes;
        }else {
            //无时间表
            if($datetime && $datetimes)
            {
                $sql .= " where " . substr($datetime,4) . $datetimes;
            }elseif($datetime && !$datetimes)
            {
                $sql .= " where " . substr($datetime,4);
            }elseif(!$datetime && $datetimes)
            {
                $sql .= " where " . substr($datetimes,4);
            }
            
        }

        $sql .= " order by order_id desc";
        $sql .= " limit " . (($page-1) * $pageSize) . ", " . $pageSize;
        $result = $this->db->query($sql);
        return $result->result_array();
    }
    
    function posInfosModel($tableName,$param)
    {
        $where = " where ";
        foreach($param as $k=>$v)
        {
            $where .= $k . " = '" . $v . "' and ";
        }
        $where = substr($where,0,-4);
        $sql = "select * from " . $tableName . $where;
        $result = $this->db->query($sql);
        if($result->num_rows() <= 0)
        {
            return '';
        }        
        return $result->result_array();        
    }
    
    /**
     * 修改订单，牌位状态
     * @param unknown $param
     */
    function posInfosDealModel($param)
    {
    	$location_id = $param['location_id'] ;
    	$order_payment = $param['order_payment'];
    	$order_id = $param['order_id'];
    	
    	$this->db->trans_start();
    	$orderSQL = "update fu_order_info set order_payment = " . $order_payment . " where order_id = " . $order_id;

		$posSQL = "update fu_location_list set location_number = 0,location_ispayment=1,
		          location_paytime = '".time()."' where localtion_id = " . $location_id;
		
    	$this->db->query($orderSQL);
    	$this->db->query($posSQL);

    	$this->db->trans_complete();
    	// 操作失败
    	if ($this->db->trans_status() === FALSE)
    	{
    		return '';
    	}
    	return 1;	
    }
    
    /**
     * 查询表
     * @param unknown $tableName
     * @param unknown $param
     */
    function searchInfos($tableName, $param = '')
    {
    	$where = " where 1 = 1 ";
    	if($param)
    	{
    		foreach($param as $kk=>$vv)
    		{
    			$where .= " and " . $kk . " = '" .$vv . "'";
    		}
    	}
    	$sql = "select * from " . $tableName . $where;
    	$query = $this->db->query($sql);
    
    	if ($query->num_rows() > 0) {
    		return $query->result_array();
    	} else {
    		return '';
    	}
    }
	
    /**
     * 自助下单处理
     * @param unknown $fu_location_list
     * @param unknown $fu_order_info
     * @param unknown $fu_user
     */
    function multiUpdateInsert($fu_location_list,$fu_order_info,$fu_user)
    {
    	// 牌位修改
    	$localtion_id = $fu_location_list['localtion_id'];
    	unset($fu_location_list['localtion_id']);
    	$fu_location_list_str = '';
    	foreach($fu_location_list as $kv => $val)
    	{
    		$fu_location_list_str .= $kv . "='" . $val . "',";
    	}
    	$fu_location_list_str = substr($fu_location_list_str,0,-1);
    	$sql_location_list_sql = "update fu_location_list set " . $fu_location_list_str . " where localtion_id = " . $localtion_id;
    	
    	// 订单处理
    	$keys = "";
    	$vals = "";
    	foreach($fu_order_info as $kkvv => $vval)
    	{
    		$keys .= $kkvv . ",";
    		$vals .= "'" . $vval . "',";
    	}

    	$keys = substr($keys, 0,-1);
    	$vals = substr($vals, 0,-1);
    	$fu_order_info_sql = "INSERT INTO fu_order_info (".$keys.") VALUES (" . $vals . ")";    	
    	// 用户处理    	
    	$keys = "";
    	$vals = "";
    	foreach($fu_user as $kkvv => $vval)
    	{
    		$keys .= $kkvv . ",";
    		$vals .= "'" . $vval . "',";
    	}
    	$keys = substr($keys, 0,-1);
    	$vals = substr($vals, 0,-1);
    	$fu_user_sql = "INSERT INTO fu_user (".$keys.") VALUES (" . $vals . ")";    	
    	
    	$this->db->trans_start();
    	$this->db->query($sql_location_list_sql); // 牌位处理
    	$this->db->query($fu_order_info_sql); // 订单处理
    	$this->db->query($fu_user_sql); // 用户处理
    	$this->db->trans_complete();
    	
    	if ($this->db->trans_status() === FALSE)
    	{
    		return false;
    	}else {
    		return true;
    	}   	
    }
}