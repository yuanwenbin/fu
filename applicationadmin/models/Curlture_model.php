<?php
class Curlture_model extends CI_Model
{
	function curltureList()
	{
		$sql = "select * from fu_curlture";
		$res = $this->db->query($sql);
		return  $res->result_array();
	}
	
	/**
	 * 
	 * @param unknown $tableName
	 * @param unknown $param
	 */
	function addCurltureDealModel($tableName, $param)
	{
		$keys = "";
		$values = "";
		foreach($param as $k=>$v)
		{
			$keys .= $k . ",";
			$values .= "'" . $v . "',";
		}
		$keys = substr($keys,0,-1);
		$values = substr($values,0,-1);
		$sql = "insert into " . $tableName . " (" .$keys . ") values (" . $values . ")";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	/**
	 * 删除
	 * @param unknown $tableName
	 * @param unknown $fields
	 */
	function delCurltureModel($tableName,$fields)
	{
		$str = "";
		foreach($fields as $k=>$v)
		{
			$str .= $k . " = '" .$v . "'";
		}
		$sql = "delete from " . $tableName . " where " . $str;
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	
}