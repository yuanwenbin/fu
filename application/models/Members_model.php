<?php
class Members_model extends CI_Model
{
	/**
	 * 查询义工的会员列表
	 * @param string $member_id 义工id
	 * @param int $page
	 * @param int $pageSize
	 * @return array
	 */
	function userListModel($member_id, $page='', $pageSize = '')
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
		        where fu_user.user_member_id = '" . $member_id . "' order by fu_user.user_id desc" . $limit;
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
				return $query->result_array();
		} else {
				return '';
		}
	}
	
	/**
	 * 查询义工的登记会员列表
	 * @param string $member_id 义工id
	 * @param int $page
	 * @param int $pageSize
	 * @return array
	 */
	function userListRegisterModel($member_id, $page='', $pageSize = '')
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
		        where fu_user.user_member_id = '" . $member_id . "'
				and fu_user.user_location_id = '0'
		        		order by fu_user.user_id desc" . $limit;
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return '';
		}
	}	
	
	/**
	 * 义工下的会员总数
	 * @param int $member_id
	 * @param array $param
	 * @return int
	 */
	function userListTotalModel($member_id, $param = array())
	{
		$str = "";
		if($param)
		{
			foreach($param as $k=>$v)
			{
				$str .= " and " .$k ."='" . $v . "'";
			}
		}
		$sql = "select count(*) as total from fu_user 
				where user_member_id = '" . $member_id ."'" . $str;
		$row = $this->db->query($sql)->row_array();
		return $row['total'];		
	}

	/**
	 * 查询义工的捐赠列表
	 * @param int $member_id
	 * @param string $order_payment 订单状态
	 * @param int $page
	 * @param int $pageSize
	 * @return array 记录数
	 */
	function orderListModel($member_id, $order_payment='',$page='',$pageSize = '')
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
	
	/**
	 * 义工订单总数
	 * @param unknown $param
	 * $member_id 义工id
	 * $order_payment 订单支付状况
	 * @return 总数
	 */
	function orderTotalNumberModel($param = array())
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
	 * 义工的总金额
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
	 * 
	 * @param unknown $tableName
	 * @param unknown $param
	 */
	function search($tableName, $param = array())
	{
	    $where = " where 1=1 ";
	    if($param)
	    {
    	    foreach($param as $kk=>$vv)
    	    {
    	        $where .= " and " . $kk . "='" . $vv . "'";
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
	
	function updateUserInfo($tableName,$param, $where)
	{
	    $sql = "update " . $tableName . " set ";
	    $updateStr = "";
	    $whereStr = " where 1 = 1 ";
	    foreach($param as $key=>$v)
	    {
	        $updateStr .= $key . "='" . $v . "',";
	    }
	    $updateStr = substr($updateStr, 0,-1);
	    foreach($where as $kk=>$vv)
	    {
	        $whereStr .= " and " . $kk . " = '" . $vv  . "'";
	    }
	    $sqlStr = $sql . $updateStr . $whereStr;
	    $this->db->query($sqlStr);
	    return $this->db->affected_rows();
	}



}