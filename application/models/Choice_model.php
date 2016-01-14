<?php
class Choice_model extends CI_Model
{
    /**
     * 随机选号
     */
    function byRandModel_bak($minPrice = '',$maxPrice = '')
    {
        $data = array();
        $where = " and ";
        if($minPrice== '')
        {
        	$minPrice = $this->session->minPrice;
        }
        if($maxPrice== '')
        {
        	$maxPrice = $this->session->maxPrice;
        } 
        $where .= " location_price >= " . $minPrice . " and location_price < " . $maxPrice;
        $sql = "select localtion_id from fu_location_list where location_type = 0 and location_number = 2 and location_isshow = 1 " . $where;
        
        $res = $this->db->query($sql);
        if(!$res)
        {
            return $data;
        }
        $resIdArr = $res->result_array();
        
        return $resIdArr;
    }
    
    /**
     * 随机选号
     */
    function byRandModel($room_id=0)
    {
    	$data = array();
    	if(!$room_id)
    	{
    		return $data;
    	}
    	$where = " and location_room_id = " . $room_id;

    	$sql = "select localtion_id,location_area,location_prefix,location_code
    			from fu_location_list 
    			where location_type = 0 and location_number = 2 
    			and location_isshow = 1 " . $where;
    
    	$res = $this->db->query($sql);
    	if($res->num_rows() < 1)
    	{
    		return array();
    	}
    	$resIdArr = $res->result_array();
    
    	return $resIdArr;
    }    
    
    /**
     * 修改用户状态
     * @param unknown $changeParams
     * @param unknown $customerId
     */
    /*
     * 
     * $changeParams['user_selected'] = $data['count'];
       $changeParams['user_selected_date'] =time();	
       $changeParams['user_location_id'] =$randNo[$arrIndex]['localtion_id'];
       $changeParams['user_type'] =0;
       $this->Choice_model->byRandChangeModel($changeParams, $this->session->customerId);
     */
    function byRandChangeModel($changeParams, $customerId,$byEight = '')
    {  
        $str = " ";
        foreach($changeParams as $k=>$v)
        {
           $str .= $k ." = '" . $v . "',"; 
        }
        $str = substr($str,0,-1);
        // 修改用户状态,即已经达到2次选择了
        if($changeParams['user_selected'] >= 2)
        {   
        	// 修改牌位信息,即查询上一次的号码修改为未出售
        	$userSQL = "select user_location_id from fu_user where user_id = '" . $customerId ."'";
        	$userRes = $this->db->query($userSQL);
        	if($userRes)
        	{
        		$userResRow = $userRes->row_array();
        		$location_id = $userResRow['user_location_id'];
        		// 把前一次的选号设置为原始末售状态
        		if($location_id > 0)
        		{
            		$sqlLocation = "update fu_location_list set location_date = 0,location_number = 2
                                    where localtion_id = " . $location_id;
            		$this->db->query($sqlLocation);
        		}
        	}        	
        }

        // 修改为出售状态
        $localSQL = "update fu_location_list set location_date = ".time().",
            location_number = 1 where localtion_id = " . $changeParams['user_location_id'];
        
        $this->db->query($localSQL);

        $sql = "update fu_user set " . $str . " where user_id = " . $customerId;

        $this->db->query($sql);            
    }
    
    function changeApiModel($changeParams, $bodyId)
    {
        $str = " ";
        foreach($changeParams as $k=>$v)
        {
            $str .= $k ." = '" . $v . "',";
        }
        $str = substr($str,0,-1);
        /*
        // 修改为出售状态
        $localSQL = "update fu_location_list set location_date = ".$changeParams['user_selected_date'].",
            location_number = 1 where localtion_id = " . $changeParams['user_location_id'];
        
        $this->db->query($localSQL);
        */
        $sql = "update fu_user set " . $str . " where body_id = '" . $bodyId . "'";
        
        $this->db->query($sql);        
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
     * 查看单表
     * @param unknown $table
     * @param unknown $param
     * @return array 多条记录
     */
    function searchMulti($table,$param,$page='',$pageSize = '')
    {
    	$where = " ";
    	foreach($param as $k=>$v)
    	{
    		$where .= " " . $k . " = '" . $v . "' and";
    	}
    
    	$where = substr($where, 0, -4);
    	$limit = " ";
    	if($page && $pageSize)
    	{
    		$limit .= " limit " . ($page-1) * $pageSize . "," . $pageSize;
    	}
    	$sql = "select * from ".$table." where " . $where . $limit;
    	$res = $this->db->query($sql);
    	if($res)
    	{
    		return $res->result_array();
    	}else {
    		return '';
    	}
    } 
    
    /**
     * 查看单表,部分字段
     * @param unknown $table
     * @param unknown $param
     * @param string $fields 字段列表
     * @return array 多条记录
     */
    function searchMultiFields_bak($table,$param,$fields = '*', $price = '')
    {
        $where = " ";
        foreach($param as $k=>$v)
        {
            $where .= " " . $k . " = '" . $v . "' and";
        }
    
        $where = substr($where, 0, -4);
        if($price != '')
        {
        	$where .= " and location_price >= " . $price['minPrice'] . " and location_price < " . $price['maxPrice'];
        }
        $sql = "select * from ".$table." where " . $where;
        $res = $this->db->query($sql);
        if($res)
        {
            return $res->result_array();
        }else {
            return '';
        }
    }    

    /**
     * 查看单表,部分字段
     * @param unknown $table
     * @param unknown $param
     * @param string $fields 字段列表
     * @return array 多条记录
     */
    function searchMultiFields($table,$param,$fields = '*')
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
            return $res->result_array();
        }else {
            return '';
        }
    }
    
    function searchUncompleteOrder($table,$where)
    {
        $sql = "select * from " . $table . " where " .$where;

        $res = $this->db->query($sql);
        if($res)
        {
            return $res->row_array();
        }else {
            return '';
        }        
    }
    
    /**
     * 删除表数据
     * @param unknown $table
     * @param unknown $param
     */
    function delData($table, $param)
    {
        $str = "";
        foreach($param as $k=>$v)
        {
            $str .= $k . " = '" . $v . "' and ";
        }
        $str = substr($str, 0, -4);
        $sql = "delete from " . $table . " where " . $str;
        $this->db->query($sql);
        return $this->db->affected_rows();       
    }
    
    /**
     * 修改数据表数据
     * @param unknown $table
     * @param unknown $param
     */
    function changTable($table, $param, $where)
    {
        $str = "";
        foreach($param as $k=>$v)
        {
            $str .= $k . " = '" . $v . "',";
        }
        $whereStr = " ";
        foreach($where as $kk=>$vv)
        {
            $whereStr .= $kk . " = '" . $vv . "' and ";
        }
        $whereStr = substr($whereStr, 0, -4);
        $str = substr($str,0,-1);
        $sql = "update " . $table . " set " . $str . " where " . $whereStr;
        
        $this->db->query($sql);
        return $this->db->affected_rows();        
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
    
    /**
     * 查询密码
     * @param string $pass 密码
     * @param int $flag 密码类型
     * @return string
     */
    function checkPass($pass,$flag)
    {
    	$sql = "select  * from fu_password where ps_flag = " . $flag . " and ps_password = '" . $pass ."' order by ps_id desc limit 1";
    	$res = $this->db->query($sql);
    	if($res)
    	{
    		return $res->row_array();
    	}else {
    		return '';
    	}
    }
    
    /**
     * 查询价格归档
     */
    function checkPriceModel()
    {
    	$sql = "select * from fu_price order by price_min desc";
    	$result = $this->db->query($sql);
    	return $result->result_array();    	
    }
    
    /**
     * 查询房间号
     */
    function checkRoomModel($room_type=0,$room_id = 0)
    {
    	$and = " and r.room_type = 0 and l.location_type = 0 ";
    	if($room_type)
    	{
    		$and = " and r.room_type = 1 and l.location_type = 1 ";
    	}
    	if($room_id)
    	{
    		$and .= " and r.room_id = " . $room_id;
    	}
    	$sql = "select DISTINCT r.* from fu_room_list as r  join fu_location_list as l 
    			on  l.location_room_id = r.room_id
				and r.room_flag=1 and l.location_number = 2 " . $and;
    	$result = $this->db->query($sql);
    	return $result->result_array();
    }

}