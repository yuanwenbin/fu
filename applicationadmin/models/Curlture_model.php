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
	/**
	 * 友情链接
	 */
	function linksList()
	{
		$sql = "select * from fu_links";
		$res = $this->db->query($sql);
		return  $res->result_array();		
	}
	
	/**
	 * 增加友情链接内容
	 * @param unknown $content
	 */
	function addLinksDealModel($content)
	{
		$sql = "insert into fu_links (link_content) values ('" . $content . "')";
		$this->db->query($sql);
		return $this->db->affected_rows();		
	}
	
	/**
	 * 版权信息
	 */
	function copyrightInfoModel()
	{
		$sql = "select * from fu_copy order by copy_id desc";
		$res = $this->db->query($sql);
		return  $res->result_array();
	}
	
	/**
	 * 增加版权信息处理
	 * @param unknown $copy_content
	 */
	function addCopyrightDealModel($copy_content)
	{
		$sql = "insert into fu_copy (copy_content) values ('" . $copy_content . "')";
		$this->db->query($sql);
		return $this->db->affected_rows();		
	}
	
	/**
	 * 查询关于我们
	 */
	function aboutUsInfoModel()
	{
		$sql = "select * from fu_about_us order by about_id desc limit 1";
		$res = $this->db->query($sql);
		return  $res->result_array();
	}
	
	/**
	 * @param string $content 内容
	 * @param int $id id
	 */
	function addAboutusDealModel($content,$id='')
	{
		if($id)
		{
			$sql = "update fu_about_us set about_content = '".$content."' where about_id = " . $id;
		}else
		{
			$sql = "insert into fu_about_us(about_content) values('".$content."')";
		}
		$this->db->query($sql);
		return $this->db->affected_rows();	
	}
	
}