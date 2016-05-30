<?php
class Price_model extends CI_Model
{
	/**
	 * 查看密码
	 */
	function priceListModel($id = '')
	{
		if($id == '')
		{
			$sql = "select * from fu_price order by price_min asc";
		}else {
			$sql = "select * from fu_price where id = " . $id;
		}
		$result = $this->db->query($sql);
		return $result->result_array();
	}

	/**
	 * 增加密码
	 */
	function priceAddDealModel($param)
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
		$sql = "insert into fu_price (" . $key . ") values (" . $val . ")";
		$this->db->query($sql);
		$affectedRow = $this->db->affected_rows();	
		return $affectedRow;
	}
	
	/**
	 * 删除捐赠额分档
	 * @param unknown $id
	 */
	function priceDelModel($id)
	{
		$sql = "delete from fu_price where id = " . $id;
		$this->db->query($sql);
		$affectedRow = $this->db->affected_rows();
		return $affectedRow;		
	}
	
	/**
	 * 修改捐赠额域间
	 * @param array $param
	 * @param string $id
	 */
	function priceUpdateDealModel($param,$id)
	{
		$where = "";
		foreach($param as $kk=>$vv)
		{
			$where .= $kk . "='" . $vv . "',";
		}
		$where = substr($where,0,-1);
		$sql = "update fu_price set " . $where . " where id ='" . $id . "'";
		$this->db->query($sql);
		$affectedRow = $this->db->affected_rows();
		return $affectedRow;		
	}
	
	function checkMaxMinPriceModel()
	{
		$data = array();
		$minSQL = "select min(location_price) as price_min from fu_location_list";
		$maxSQL = "select max(location_price) as price_max from fu_location_list";
		$resMin = $this->db->query($minSQL);
		$data['minVal'] = $resMin->row();
		
		$resMax = $this->db->query($maxSQL);
		$data['maxVal'] = $resMax->row();
		return $data;		
	}

	
	
}