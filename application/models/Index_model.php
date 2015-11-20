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
}