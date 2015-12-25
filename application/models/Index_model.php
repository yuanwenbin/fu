<?php
class Index_model extends CI_Model
{
	/**
	 * 查询是否已经存在用户
	 * @param string $bodyId
	 */
	/*
	function bodyIndex($bodyId)
	{
		$sql = "select * from fu_user where body_id = '".$bodyId."'";
		$res = $this->db->query($sql);
		return $res->row_array();
	}
	*/
	/**
	 * 插入用户
	 * @param unknown $param
	 */
	function bodyInsert($param)
	{
		$fields = "";
		$values= "";
		foreach($param as $k=>$v)
		{
			$fields .= $k . ",";
			$values .= "'" .$v . "',";
		}
		
		$fields = substr($fields,0,-1);
		$values = substr($values,0,-1);
		$sql = "insert into fu_user(" . $fields . ") values (" . $values . ")";
		$this->db->query($sql);
		return $this->db->insert_id();
	}
	
	/**
	 * 业务员登陆验证
	 * @param string $username
	 * @param string $password
	 */
	function memberValidateModel($username,$password)
	{
		$sql = "select * from fu_member where member_username = '".$username."' and member_password = '".$password."' limit 1";
		$res = $this->db->query($sql);
		if($res->num_rows() < 1)
		{
			$sql = "select * from fu_member where member_telphone = '".$username."' and member_password = '".$password."' limit 1";
			$res = $this->db->query($sql);
			if($res->num_rows())
			{
				return $res->row_array();
			}
			return array();
		}
		return $res->row_array();
	}
	
	/**
	 * 检查是否登记过
	 * @param unknown $bodyId
	 */
	function userCheck($bodyId)
	{
		$sql = "select * from fu_user where body_id = '".$bodyId."' limit 1";
		$res = $this->db->query($sql);
		if($res->num_rows() < 1)
		{
			return false;
		}
		return true;		
	}
	
	/**
	 * 更新用户信息
	 * @param unknown $tableName
	 * @param unknown $param
	 * @param unknown $where
	 */
	function userUpdate($tableName,$param,$where)
	{
		$fields = "";
		$whereStr = " where 1=1 ";
		foreach($param as $kk=>$vv)
		{
			$fields .= $kk . " = '" . $vv . "',";
		}
		$fields = substr($fields,0,-1);
		foreach($where as $k=>$v)
		{
			$whereStr .= " and " . $k . " = '" . $v ."' and ";
		}
		$whereStr = substr($whereStr,0,-4);
		$sql = "update " . $tableName . " set " . $fields . $whereStr;
		$res = $this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	/**
	 * 查询表记录总数
	 * @param unknown $tableName
	 * @param unknown $param
	 */
	function queryCountModel($tableName, $param)
	{
	    $where = " where ";
	    foreach($param as $kk=>$vv)
	    {
	        $where .= $kk . " = '" .$vv . "' and ";
	    }
	    $where = substr($where,0,-4);
	    $sql = "select count(*) as total from " . $tableName . $where;
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
}