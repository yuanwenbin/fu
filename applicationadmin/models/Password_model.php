<?php
class Password_model extends CI_Model
{
	/**
	 * 查看密码
	 */
	function passwordCheckModel($ps_flag = 0)
	{
		$sql = "select * from fu_password where ps_flag = " . $ps_flag . " order by ps_id desc limit 10";
		$result = $this->db->query($sql);
		return $result->result_array();
	}

	/**
	 * 增加密码
	 */
	function passwordAddDealModel($param)
	{
		$key = '';
		$val = '';
		foreach($param as $k=>$v)
		{
			$key .= $k . ',';
			$val .= "'" . $v . "',";
		}
		$key = substr($key,0,-1);
		$val = substr($val,0,-1);
		$sql = "insert into fu_password (" . $key . ") values (" . $val . ")";
		$this->db->query($sql);
		$affectedRow = $this->db->affected_rows();	
		// 清空多余数的数据，只保留各自最新十条数据
		if($affectedRow)
		{
			$delRand = "select ps_id from fu_password where ps_flag = 0 order by ps_id desc limit 10,20";
			$result = $this->db->query($delRand);
			$delRandRes = $result->result_array();
			if($delRandRes)
			{
				$kv = "(";
				foreach($delRandRes as $kk=>$vv)
				{
					$kv .= $vv['ps_id'] . ",";
				}
				$kv = substr($kv,0,-1) . ")";
				$delRandDeal = "delete from fu_password where ps_id in " . $kv; 
				$this->db->query($delRandDeal);
				
			}
			// 删除高端
			$delHigh = "select ps_id from fu_password where ps_flag = 1 order by ps_id desc limit 10,20";
			$resultHigh = $this->db->query($delHigh);
			$delHighRes = $resultHigh->result_array();
			if($delHighRes)
			{
				$kv = "(";
				foreach($delHighRes as $kk=>$vv)
				{
					$kv .= $vv['ps_id'] . ",";
				}
				$kv = substr($kv,0,-1) . ")";
				$delRandDeal = "delete from fu_password where ps_id in " . $kv; 
				$this->db->query($delRandDeal);	
			}
		}
		return $affectedRow;
	}

	
	
}