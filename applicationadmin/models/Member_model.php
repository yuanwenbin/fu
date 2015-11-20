<?php
class Member_model extends CI_Model
{
	/**
	 * 统计用户数目
	 */
	function total()
	{
		$sql = "select count(*) as total from fu_user";
		$result = $this->db->query($sql);
		$rowResult = $result->row();
		return $rowResult->total;
	}
	
	/**
	 * 会员列表
	 * @param unknown $page
	 * @param unknown $pageSize
	 */
	function memberList($page, $pageSize)
	{
		$startNumber = ($page - 1) * $pageSize;
		$sql = "select * from fu_user order by user_id desc limit " . $startNumber . ", " . $pageSize;
		$result = $this->db->query($sql);
		return $result->result_array(); 
	}
	
	/**
	 * 删除会员
	 * @param unknown $id
	 */
	function delMember($id,$locationId)
	{
		$this->db->trans_start();
		$sql = "delete from fu_user where user_id =" . $id;
		$updateSQL = "update fu_location_list set location_number = 2 where localtion_id = " . $locationId;
		$this->db->query($sql);
		$this->db->query($updateSQL);
		$this->db->trans_complete();
		// 操作失败
		if ($this->db->trans_status() === FALSE)
		{
			return '';
		}
		return 1;
	}
	
	/**
	 * 查找会员
	 * @param string $bodyId
	 */
	function memberSearch($bodyId)
	{
		$sql = "select * from fu_user where  body_id = '" . $bodyId . "'";
		$result = $this->db->query($sql);
		return $result->result_array();		
	}
}