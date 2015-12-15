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


    function userAddDeal($tableName,$param)
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
     * 最新id
     */   
    function newAdminId()
    {
		$sql = "select max(admin_id) as admin_id from fu_admin";
		$result = $this->db->query($sql);
		if($result->num_rows() < 1)
		{
			return '';
		}else {
			$idResult= $result->row();
			return $idResult->admin_id;
		}
	
    }
    /**
     * 查看用户权限
     * @param unknown $admin_id
     */
    function perssionInfos($admin_id)
    {
    	$sql = "select persion_controller  from fu_admin_perssion where admin_id = " . $admin_id;
		$result = $this->db->query($sql);
		if($result->num_rows() < 1)
		{
			return '';
		}else {
			$idResult= $result->row();
			return $idResult->persion_controller;
		}   
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
     * 
     */
    function userDel($admin_id)
    {
        $sql = "delete from fu_admin where admin_id = " . $admin_id;
        $this->db->query($sql);
        return $this->db->affected_rows();        
    } 
    
    /**
     *
     */
    function userPerDel($admin_id)
    {
        $sql = "delete from fu_admin_perssion where admin_id = " . $admin_id;
        $this->db->query($sql);
        return $this->db->affected_rows();
    }    
    
    function userInfos($admin_id)
    {
        $sql = "select * from fu_admin where admin_id = " . $admin_id;
        $res = $this->db->query($sql);
        return $res->row();
    }
    
    function userInfosUpdateDeal($admin_id,$param)
    {
        if(isset($param['admin_password']) && !empty($param['admin_password']))
        {
            $sql = "update fu_admin set admin_user = '" .$param['admin_user']. "',
                admin_password = '".md5($param['admin_password'] . $param['admin_salt'])."',
                admin_salt = '" .$param['admin_salt']."',admin_email = '".$param['admin_email']."',
                admin_status = '" .$param['admin_status'] . "' where admin_id = " . $admin_id;
        }else {
            $sql = "update fu_admin set admin_user = '" .$param['admin_user']. "',
                admin_email = '".$param['admin_email']."',
                admin_status = '" .$param['admin_status'] . "' where admin_id = " . $admin_id;            
        }
        $this->db->query($sql);
        return $this->db->affected_rows();        
    }
    /**
     * 更新用户权限
     * @param unknown $admin_id
     * @param unknown $perssion
     */
    function updatePerssion($admin_id, $perssion)
    {
        $upSQL = "update fu_admin_perssion set persion_controller = '" .$perssion. "' where admin_id = " . $admin_id;  
        $this->db->query($upSQL);
        return $this->db->affected_rows();         
    }
}