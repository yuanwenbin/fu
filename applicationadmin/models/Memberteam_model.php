<?php
class Memberteam_model extends CI_Model
{
	/**
	 * 查看业务员分组
	 */
	function memberteamListModel()
	{
    	$sql = "select *  from fu_team order by id asc";
		$result = $this->db->query($sql);
		if($result->num_rows() < 1)
		{
			return '';
		}else {
			return $result->result_array();
		} 
	}
	
	/**
	 * 新增加记录
	 */
    function memberteamAddModel($tableName,$param, $insert_id='')
    {
        $value = '';
        $key = '';
        foreach($param as $k => $v)
        {
            $key .= $k . ',';
            $value .= "'" . $v . "',";
        }
        $key = substr($key,0,-1);
        $value = substr($value,0,-1);
        $sql = "insert into ".$tableName."(" . $key . ") values (" . $value . ")";
        $this->db->query($sql);
        if($insert_id)
        {
            return $this->db->insert_id();
        }
        return $this->db->affected_rows();
    }
    
    /**
     * 查询记录
     */   
    function memberteamQueryModel($tableName,$param = '')
    {
		 $where = " where 1=1 ";
		if($param)
		{
			foreach($param as $kk=>$vv)
			{
				$where .= " and " .$kk." = '" . $vv . "' and ";
			}
			$where = substr($where,0,-4);
		}
		$sql = "select * from " . $tableName.$where;
		$result = $this->db->query($sql);
		if($result->num_rows() < 1)
		{
			return '';
		}else {
			return $result->result_array();
		}
	
    }
    /**
     * 删除业务分组及相关的员工
     * @param unknown $admin_id
     */
    function memberteamDelDealModel($id)
    {
		$sqlTeam = "delete from fu_team where id = '" . $id . "'";
		$sqlMember = "delete from fu_member where member_team_id = '" . $id . "'";
		$this->db->query($sqlTeam);
		$this->db->query($sqlMember); 
		return true;
    }
    
    /**
     * 用户列表
     */
    function userList()
    {
        $sql = "select * from fu_admin";
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    
    /**
     * 业务员列表
     * @param int $page
     * @param int $pageSize
     * @
     */
    function memberteamListUserModel($page='',$pageSize='')
    {
    	$limit = "";
    	if($page && $pageSize)
    	{
    		$startNumber = ($page - 1) * $pageSize;
    		$limit .= " limit " .$startNumber .", " . $pageSize;	
    	}
        $sql = "select * from fu_member as fm left join fu_team as ft on fm.member_team_id = ft.id " . $limit;
		$result = $this->db->query($sql);
		if($result->num_rows() < 1)
		{
			return '';
		}else {
			return $result->result_array();
		}   
    } 
    
    /**
     * 业务员订单总数
     * @param unknown $param
     * $member_id 业务员id
     * $order_payment 订单支付状况
     * @return 总数
     */
    function orderTotalNumberModel($param)
    {
        $where = " where u.user_member_id = '". $param['user_member_id'] ."' ";
        if(isset($param['order_payment']))
        {
            $where .= " and oi.order_payment = '" . $param['order_payment'] . "'";
        }
    
        $sql = "select count(*) as total from fu_order_info as oi
				join fu_user as u on oi.order_user = u.body_id " . $where;
        $row = $this->db->query($sql)->row_array();
        return $row['total'];
    }

    /**
     * 业务员的总金额
     * @param array $param
     * $param['user_member_id']
     * $param['order_payment']
     */
    function orderTotalMoneyModel($param)
    {
        $andFields = "";
        if(isset($param['order_payment']))
        {
            $andFields .= " and fu_order_info.order_payment = '" .$param['order_payment'] ."'";
        }
        $sql = "select sum(fu_order_info.order_price) as total from fu_order_info as fu_order_info
					join fu_user as fu_user on fu_order_info.order_user = fu_user.body_id
					where fu_user.user_member_id = '" . $param['user_member_id'] . "' ". $andFields;
        $row = $this->db->query($sql)->row_array();
        return $row['total'];
    
    }  
    
    /**
     * 获取业务员信息
     * @param unknown $member_id
     */
    function getMemberTeam($member_id)
    {
      $sql = "select * from fu_member where member_id = '".$member_id."' limit 1";
      $result = $this->db->query($sql);
      if($result->num_rows() > 0)
      {
         return  $result->row_array();
      }else {
         return '';
      }
      
    }
    /**
     * 查询业务员的会员列表
     * @param string $member_id 业务员id
     * @param int $page
     * @param int $pageSize
     * @return array
     */
    function MemberteamUserListModel($member_id, $page='', $pageSize = '')
    {
        $limit = " ";
        if($page && $pageSize)
        {
            $startNumber = ($page-1) * $pageSize;
            $limit .= " limit " . $startNumber . "," . $pageSize;
        }
        $sql = "select *  from fu_user as fu_user
		        left join fu_order_info as fu_order_info
		        on fu_user.body_id = fu_order_info.order_user
		        where fu_user.user_member_id = '" . $member_id . "' and fu_user.user_location_id = '0' order by fu_user.user_id desc" . $limit;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return '';
        }
    } 

    /**
     * 查询业务员的订单列表
     * @param int $member_id
     * @param string $order_payment 订单状态
     * @param int $page
     * @param int $pageSize
     * @return array 记录数
     */
    function MemberteamOrderListModel($member_id, $order_payment='',$page='',$pageSize = '')
    {
        $where = " ";
        $limit = " ";
        if($order_payment != 'all')
        {
            $where = " and oi.order_payment = '".$order_payment."' ";
        }
        if($page && $pageSize)
        {
            $starPage = ($page - 1) * $pageSize;
            $limit .= " limit " . $starPage . ", " . $pageSize;
        }
        $sql = "select * from fu_order_info as oi join fu_location_list ll
						on oi.order_location_id = ll.localtion_id
						join fu_user as u on oi.order_user = u.body_id
						where  u.user_member_id = '".$member_id."' " . $where . " order by oi.order_id desc " . $limit;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return '';
        }
    } 

	function memberteamOrderTotalModel($member_id,$order_payment='')
	{
		$where = " ";
	
		if($order_payment != 'all')
		{
			$where = " and oi.order_payment = '".$order_payment."' ";
		}

		$sql = "select count(*) as total from fu_order_info as oi 
						join fu_user as u on oi.order_user = u.body_id
						where  u.user_member_id = '".$member_id."' " . $where . " order by oi.order_id desc ";
		$result = $this->db->query($sql);
		$rowResult = $result->row();
		return $rowResult->total;
	}

    /**
     * 查询表记录
     * @param unknown $tableName
     * @param unknown $param
     */
    function searchInfos($tableName, $param)
    {
    	$where = " where ";
    	foreach($param as $kk=>$vv)
    	{
    		$where .= $kk . " = '" .$vv . "' and ";
    	}
    	$where = substr($where,0,-4);
    	$sql = "select * from " . $tableName . $where;
    	$query = $this->db->query($sql);
    	if ($query->num_rows() > 0) {
    		return $query->result_array();
    	} else {
    		return '';
    	}
    }  

    
    /**
     * 查询表记录总数
     * @param unknown $tableName
     * @param unknown $param
     */
    function queryCountModel($tableName, $param = '')
    {
        $where = " where 1=1 ";
        if($param)
        {
	        foreach($param as $kk=>$vv)
	        {
	            $where .= " and " .$kk . " = '" .$vv . "'";
	        }
        }
        
        $sql = "select count(*) as total from " . $tableName . $where;
        $result = $this->db->query($sql);
        $rowResult = $result->row();
        return $rowResult->total; 
    } 

    /**
     * 查询 in 条件的数据总数
     * @param unknown $tableName
     * @param unknown $where
     * @param unknown $ins
     */
    function queryCountInModel($tableName,$where,$ins,$param = '')
    {
        if($param)
        {
           $str = " and ";
           foreach($param as $kk=>$vv)
           {
               $str .= $kk ."='" . $vv . "',";
           } 
           $str = substr($str, 0,-1);
           $whereStr = " where " . $ins . " in " . $where . $str;
        }else {
            $whereStr = " where " . $ins . " in " . $where;
        }
        $sql = "select count(*) as total from " . $tableName . $whereStr;
        $result = $this->db->query($sql);
        $rowResult = $result->row();
        return $rowResult->total;        
    }
    
    /**
     * 查询组长及旗下的订单列表
     */
    function orderTeamListModel($where,$page='',$pageSize='')
    {
    	// 分分页显示
    	if($page && $pageSize)
    	{
    		$startNum = ($page - 1) * $pageSize;
    		$sql = "select * from fu_order_info as fu_order_info  join fu_user as fu_user  on fu_user.body_id = fu_order_info.order_user
					where fu_user.user_member_id " . $where . " limit " . $startNum . "," . $pageSize;
    		$query = $this->db->query($sql);
    		if ($query->num_rows() > 0) {
    			return $query->result_array();
    		} else {
    			return '';
    		}
    	}
    	// 统计总计
    	$sql = "select count(*) as total from fu_order_info as fu_order_info  join fu_user as fu_user  on fu_user.body_id = fu_order_info.order_user
					where fu_user.user_member_id " . $where;
    	$result = $this->db->query($sql);
    	$rowResult = $result->row();
    	return $rowResult->total;
    }    
    
    /**
     * 查询数据
     * @param string $table
     * @param string $where
     * @param int $page
     * @param int $pageSize
     */
    function queryTotalListModel($table,$where,$page='',$pageSize = '')
    {
    	if($page && $pageSize)
    	{
    		$startNum = ($page - 1) * $pageSize;
    		$sql = "select * from " . $table . " where " . $where . " limit " . $startNum . ", " . $pageSize;
    	}else {
    		$sql = "select * from " . $table . " where " . $where;
    	}
    	$query = $this->db->query($sql);
    	if ($query->num_rows() > 0) {
    		return $query->result_array();
    	} else {
    		return '';
    	}
    }    
    
    /**
     * 查询 in 条件的数据总和
     * @param unknown $tableName
     * @param unknown $where
     * @param unknown $ins
     */
    function queryCountInMoneyModel($tableName,$where,$ins,$fields,$param = '')
    {
        if($param)
        {
            $str = " and ";
            foreach($param as $kk=>$vv)
            {
                $str .= $kk ."='" . $vv . "',";
            }
            $str = substr($str, 0,-1);
            $whereStr = " where " . $ins . " in " . $where . $str;
        }else {
            $whereStr = " where " . $ins . " in " . $where;
        }
        $sql = "select sum(".$fields.") as total from " . $tableName . $whereStr;
        $result = $this->db->query($sql);
        $rowResult = $result->row();
        return $rowResult->total;
    }    
    
    /**
     * 查询 in 条件的数据列表
     * @param unknown $tableName
     * @param unknown $where
     * @param unknown $ins
     */
    function queryCountInListModel($tableName,$where,$ins)
    {
        $whereStr = " where " . $ins . " in " . $where;
        $sql = "select * from " . $tableName . $whereStr;
        $query = $this->db->query($sql);
    	if ($query->num_rows() > 0) {
    		return $query->result_array();
    	} else {
    		return '';
    	}
    }    
    /**
     * 更新数据表
     * @param string $tableName 表名
     * @param array $param 要修改的值
     * @param array $where 条件
     */
    function updateInfosModel($tableName,$param,$where)
    {
    	$whereStr = " where ";
    	foreach($where as $k=>$v)
    	{
    		$whereStr .= $k . " = '" . $v . "' and ";
    	}
    	$whereStr = substr($whereStr,0,-4);
    	$paramStr = " set ";
    	foreach($param as $kk=>$vv)
    	{
    		$paramStr .= $kk ." = '" . $vv . "',";
    	}
    	$paramStr = substr($paramStr,0,-1);
    	$sql = "update " . $tableName .$paramStr .$whereStr; 
        $this->db->query($sql);
        return $this->db->affected_rows();  
    }
    
    /**
     * 删除记录
     * @param string $tableName
     * @param array $param
     */
    function delInfosModel($tableName, $param)
    {
    	$where = " where ";
    	foreach($param as $k=>$v)
    	{
    		$where .= $k ." = '" . $v."' and ";
    	}
    	$where = substr($where, 0,-4);
    	$sql = "delete from " . $tableName. $where;
    	$this->db->query($sql);
    	return $this->db->affected_rows();
    }
    
    /**
     * 检验是否已经存在同样的名称
     * @param unknown $tableName
     * @param unknown $param
     */
	function hasExists($tableName,$param)
	{
		$where = "";
		foreach($param as $k => $v)
		{
			$where .= $k . "!='" . $v."' and ";
		}
		$where = substr($where, 0,-4);
		$sql = " select * from " . $tableName . " where " . $where;
		$query = $this->db->query($sql);
		return $query->num_rows();
	}


}