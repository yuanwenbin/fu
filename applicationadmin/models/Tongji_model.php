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
        $where = "where";
    	if(isset($param['startTime']) && ($param['startTime']))
    	{
    		$where .= " location_date >= " . $param['startTime'] . "  and ";
    		
    	}
    	unset($param['startTime']);
    	if(isset($param['endTime']) && ($param['endTime']))
    	{
    		$where .= "  location_date <= " . $param['endTime'] . "  and ";
    		
    	}    	
    	unset($param['endTime']);
    	if(isset($param['order_room_id']) && ($param['order_room_id']))
    	{
    	    $where .= "  location_room_id = " . $param['order_room_id'] . "  and ";
    	   
    	}
    	/*
    	if($where == 'where')
    	{
    	    $where = "";
    	}else {
    	    $where = substr($where,0-4);
    	}
    	*/
    	// 正在出售
    	$sqlAfter1 = " location_number = 1"; 
    	// 已经出售
    	$sqlAfter2 = " location_number = 0";
    	$sql_1 = "select count(*) as total from fu_location_list " . $where . $sqlAfter1;
    	$sql_2 = "select count(*) as total from fu_location_list " . $where . $sqlAfter2;
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
    function tongjiTotalPos_s($param)
    {
    	$startTime = "";
    	$endTime = "";
    	$order_room_id = '';
    	$data[0]=0; //出售中
    	$data[1]=0; // 已经出售
    	//是否选择了福位或日期
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
    	$sqlAfter1 = " location_number = 1"; // 正在出售
    	$sqlAfter2 = " location_number = 0"; // 已经出售
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
     * 统计
     */
    function orderList($param)
    {
    	
    	$where = " where ";
    	if(isset($param['startTime']) && ($param['startTime']))
    	{
    		$where .= " location_date > " . $param['startTime'] . " and ";

    	}
    	unset($param['startTime']);
    	if(isset($param['endTime']) && ($param['endTime']))
    	{
    		$where .= "  location_date < " . $param['endTime'] . " and ";

    	}    	
    	unset($param['endTime']);
        $page = $param['page'];
        unset($param['page']);
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
    	$startNumber = ($page - 1) * PAGESIZEFORTONGJI;
    	$sql = "select * from fu_location_list " . $where . " limit " . $startNumber . "," . PAGESIZEFORTONGJI;
        $res = $this->db->query($sql);
    	if($res)
    	{
    		return $res->result_array();
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
    		
    	}
    	unset($param['startTime']);
    	if(isset($param['endTime']) && ($param['endTime']))
    	{
    		$where .= "  location_date < " . $param['endTime'] . " and ";
    		
    	}  
    	unset($param['endTime']);
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
    	$ids = '';
    	if($res->num_rows() > 0)
    	{
    		$affectRes = $res->result_array();
    		$ids = "(";
    		foreach($affectRes as $v)
    		{
    			$ids .= $v['order_location_id'] . ",";
    		}   
    		$ids = substr($ids,0,-1) . ")";
    		//$userSQL = "delete from fu_user where user_location_id in " . $ids;
    		$userSQL = "update fu_user set user_location_id = '0',user_type = '-1',user_selected='0',user_selected_date='0'
						where user_location_id in " . $ids;
    	}
 	
    	
    	
    	
    	$upSQL = "update fu_location_list set location_number = '2',location_date='0' where location_date < " . $affectTime . " and location_ispayment = '0'";
    	$delSql = "delete from fu_order_info where order_payment = '0' and order_datetime <  " . $affectTime;

    	$this->db->trans_start();
    	$this->db->query($upSQL);
    	$this->db->query($delSql);
    	
    	if($ids)
    	{
    		$this->db->query($userSQL);
    	}
    	
    	$this->db->trans_complete();
    	// 操作失败
    	if ($this->db->trans_status() === FALSE)
    	{
    		return '';
    	}
    	return 1;
    	/*
        $affectTime = time() - 7200;
        $sql = "select order_location_id from fu_order_info where order_payment = 0 and order_datetime < " . $affectTime;	echo $sql; exit;
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
		*/
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
     * 查询表统计
     * @param unknown $tableName
     */
    function queryCountCondtion($tableName, $param = array())
    {
        $sql = "select count(*) as total from " . $tableName;
        if($param)
        {
            $where = " where ";
            if(isset($param['startTime']) && $param['startTime'] != '')
            {
                $where .= " location_date >= " . $param['startTime'] . " and ";
            }
            unset($param['startTime']);
            if(isset($param['endTime']) && $param['endTime'] != '')
            {
                $where .= " location_date <= " . $param['endTime'] . " and ";
            }  
            unset($param['endTime']);
            if($param)
            {
                foreach($param as $k=>$v)
                {
                    $where .= $k . " = '". $v . "' and ";
                }
            }
            $where = substr($where, 0,-4);
            $sql .= $where;
        }
        $res = $this->db->query($sql);
        return $res->row_array();
    }    
    /**
     * 统计列表
     * @param unknown $param
     */
    function orderLists($param)
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

        
        $sql = "select * from fu_order_info";
        if($startTime && $endTime && $order_room_id)
        {
            // $sql .= " where " .$startTime . " and " . $endTime . " and " . $order_room_id . $limits;
        	$sql .= " where " .$startTime . " and " . $endTime . " and " . $order_room_id;
        }elseif($startTime && $endTime){
            // $sql .= " where " .$startTime . " and " . $endTime  . $limits;
        	$sql .= " where " .$startTime . " and " . $endTime;
        }elseif($startTime && $order_room_id)
        {
            // $sql .=" where " .$startTime . " and " . $order_room_id . $limits;
        	$sql .=" where " .$startTime . " and " . $order_room_id;
        }elseif($endTime && $order_room_id)
        {
            // $sql .=" where " .$endTime . " and " . $order_room_id . $limits;
        	$sql .=" where " .$endTime . " and " . $order_room_id;
        }elseif($startTime)
        {
            // $sql .= " where " .$startTime . $limits;
        	$sql .= " where " .$startTime;
        }elseif($endTime)
        {
            //$sql .=" where " .$endTime . $limits;
        	$sql .=" where " .$endTime;
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
    
    function exportOrder()
    {
        $sql = "select * from fu_order_info as oi left join fu_user as u on oi.order_user = u.body_id
                left join fu_room_list as rl on oi.order_room_id = rl.room_id
                left join fu_location_list as ll on oi.order_location_id = ll.localtion_id
                left join fu_member as m on u.user_member_id = m.member_id
                left join fu_team as t on t.id = m.member_team_id order by oi.order_id desc";
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    
    function tongListSearchForTel($tel)
    {
        $sql = "select * from fu_order_info,fu_user 
            where fu_order_info.order_location_id = fu_user.user_location_id
            and fu_user.user_telphone = '" .$tel."'";
        $res = $this->db->query($sql);
        if($res->num_rows() > 0)
        {
            return $res->result_array();
        }else {
            return array();
        }        
                
    }
    
    function tongListSearchMemberOrder($type, $memberInfo)
    {
        // 查找业务员
        if($type == 1)
        {
            $sql = "select * from fu_member where member_telphone = '".$memberInfo."' limit 1";
        }elseif($type == 2)
        {
            $sql = "select * from fu_member where member_username = '".$memberInfo."'  limit 1";
        }else
        {
            $sql = "select * from fu_member where member_realname = '".$memberInfo."'  limit 1";
        } 
        $res = $this->db->query($sql);
        if($res->num_rows() > 0)
        {
            $member = $res->row_array();
        }else {
            return array();
        }
        $memberId = $member['member_id'];
        // 查找业务
        $sqlQuery = "select * from fu_user as u,fu_order_info as oi,fu_location_list as ll
                     where u.body_id = oi.order_user
                     and oi.order_location_id = ll.localtion_id
                     and u.user_member_id = " . $memberId;
        $res = $this->db->query($sqlQuery);
        if($res->num_rows() > 0)
        {
           return $res->result_array();
        }else {
            return array();
        }
        
    }
 
}