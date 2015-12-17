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
			return array();
		}
		return $res->row_array();
	}
}