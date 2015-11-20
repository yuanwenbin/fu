<?php
class Login_model extends CI_Model
{
	/**
	 * @deprecated 登陆
	 * @param string $username 用户名
	 * @param string $password 密码
	 * @return array 用户相关信息
	 */
	function loginCheck($username, $password)
	{
		$data = array();
		$sql = "select admin_salt from fu_admin where admin_user = '".$username."' and admin_status = 1 limit 1";
		$saltResult = $this->db->query($sql);
		if($saltResult->num_rows() <= 0)
		{
			return $data;
		}
		$saltRow = $saltResult->row();
		$salt = $saltRow->admin_salt;
		$newPassword = md5($password . $salt);
		$checkSQL = "select * from fu_admin where admin_user = '".$username."' and admin_password = '".$newPassword."' limit 1";
		$query = $this->db->query($checkSQL);
		if($query->num_rows() <= 0)
		{
			return $data;
		}
		$data = $query->result_array();
		$admin_id = $data[0]['admin_id'];
		$roleSQL = "select * from fu_admin_perssion where admin_id = " . $admin_id;
		$queryRole = $this->db->query($roleSQL);
		$dataRole = $queryRole->result_array();
		$data[1] = $dataRole[0];
		// 插入登陆日志
		$admin_user = $data[0]['admin_user'];
		$logs_infos = serialize($_SERVER);
		$logs_datetime = time();
		$insertSQL = "insert into fu_admin_logs(admin_user,logs_infos,logs_datetime) values 
				('".$admin_user."', '".addslashes($logs_infos)."', '".$logs_datetime."')";
		$this->db->query($insertSQL);
		return $data;
	}
	
	/**
	 * @deprecated 登出日志
	 * @param string $username 用户名
	 * @param string $logs_infos 日志信息
	 * @param int $datetime 时间
	 */
	function logLogout($username,$logs_infos, $datetime)
	{
		$insertSQL = "insert into fu_admin_logs(admin_user,logs_infos,logs_datetime) values
				('".$username."', '".$logs_infos."', '".$datetime."')";
		$this->db->query($insertSQL);
	}
		
}