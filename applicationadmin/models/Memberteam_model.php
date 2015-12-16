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
    function memberteamAddModel($tableName,$param)
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
     */
    function memberteamListUserModel()
    {
        $sql = "select * from fu_member as fm left join fu_team as ft on fm.member_team_id = ft.id";
		$result = $this->db->query($sql);
		if($result->num_rows() < 1)
		{
			return '';
		}else {
			return $result->result_array();
		}   
    } 
    
   
    


}