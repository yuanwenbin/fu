<?php
class Members_model extends CI_Model
{
	/**
	 * 查询业务员的会员列表
	 * @param string $member_id 业务员id
	 * @param int $page
	 * @param int $pageSize
	 * @return array
	 */
	function userListModel($member_id, $page='', $pageSize = '')
	{
		$limit = " ";
		if($page && $pageSize)
		{
			$startNumber = ($page-1) * $pageSize;
			$limit .= " limit " . $startNumber . "," . $pageSize;
		}
		$sql = "select *  from fu_user as fu_user 
		        left join fu_order_info as fu_order_info
		        on fu_user.body_id = fu_order_info.order_user
		        where fu_user.user_member_id = '" . $member_id . "' order by fu_user.user_id desc" . $limit;
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
				return $query->result_array();
		} else {
				return '';
		}
	}
	
	/**
	 * 业务员下的会员总数
	 * @param int $member_id
	 * @return int
	 */
	function userListTotalModel($member_id)
	{
		$sql = "select count(*) as total from fu_user 
				where user_member_id = '" . $member_id ."'";
		$row = $this->db->query($sql)->row_array();
		return $row['total'];		
	}

	/**
	 * 查询业务员的订单列表
	 * @param int $member_id
	 * @param string $order_payment 订单状态
	 * @param int $page
	 * @param int $pageSize
	 * @return array 记录数
	 */
	function orderListModel($member_id, $order_payment='',$page='',$pageSize = '')
	{
		$where = " ";
		$limit = " ";
		if($order_payment != 'all')
		{
			$where = " and oi.order_payment = '".$order_payment."' ";
		}
		if($page && $pageSize)
		{
			$starPage = ($page - 1) * $pageSize;
			$limit .= " limit " . $starPage . ", " . $pageSize;
		}
		$sql = "select * from fu_order_info as oi join fu_location_list ll
						on oi.order_location_id = ll.localtion_id
						join fu_user as u on oi.order_user = u.body_id
						where  u.user_member_id = '".$member_id."' " . $where . " order by oi.order_id desc " . $limit;
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
				return $query->result_array();
		} else {
				return '';
		}
	}
	
	/**
	 * 业务员订单总数
	 * @param unknown $param
	 * $member_id 业务员id
	 * $order_payment 订单支付状况
	 * @return 总数
	 */
	function orderTotalNumberModel($param)
	{
		$where = " where u.user_member_id = '". $param['user_member_id'] ."' ";
		if(isset($param['order_payment']))
		{
			$where .= " and oi.order_payment = '" . $param['order_payment'] . "'";
		}
		
		$sql = "select count(*) as total from fu_order_info as oi 
				join fu_user as u on oi.order_user = u.body_id " . $where;
		$row = $this->db->query($sql)->row_array();
		return $row['total'];
	}
	
	/**
	 * 业务员的总金额
	 * @param array $param
	 * $param['user_member_id']
	 * $param['order_payment']
	 */
	function orderTotalMoneyModel($param)
	{
		$andFields = "";
		if(isset($param['order_payment']))
		{
			$andFields .= " and fu_order_info.order_payment = '" .$param['order_payment'] ."'";
		}
		$sql = "select sum(fu_order_info.order_price) as total from fu_order_info as fu_order_info
					join fu_user as fu_user on fu_order_info.order_user = fu_user.body_id
					where fu_user.user_member_id = '" . $param['user_member_id'] . "' ". $andFields;
		$row = $this->db->query($sql)->row_array();
		return $row['total'];		

	}



}