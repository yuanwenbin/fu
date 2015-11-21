<?php
class Qiye_model extends CI_Model
{
	/**
	 * 导航
	 * @return Ambigous <multitype:, string>
	 */
	function menuModel()
	{

		$data = array();
		// 查询顶级分类
		$data = array();
		$sql = "select * from fu_article_cate where cate_parent = 0 and cate_show = 1 order by cate_sort desc, cate_id asc";
		$res = $this->db->query($sql);
		if($res->num_rows() <= 0)
		{
			$data['cate'] = '';
		}else {
			$cate = $res->result_array();
			foreach($cate as $k=>$v)
			{
				$cate_parent = $v['cate_id'];
				$data['cate'][$k]['parent'] = $v;
				$sqlSub = "select * from fu_article_cate where cate_parent = ".$cate_parent." and cate_show = 1 order by cate_sort desc, cate_id asc";
				$resSub = $this->db->query($sqlSub);
				$data['cate'][$k]['sub'] = $resSub->result_array();
			}
		}
		return $data;
	}
	/**
	 * 文章详情页
	 * @param unknown $id
	 */
	function detailsModel($id)
	{
	    $sql = "select fu_article.* from fu_article where fu_article.article_id = " . $id .
	           " and fu_article.article_flag = 1"; 
	    $res = $this->db->query($sql);
	    if($res->num_rows() <= 0)
	    {
	        return '';
	    }
	    return $res->result_array();
	}
	
	/**
	 * 查询子分类
	 * @param unknown $cate_id
	 */
	function subCate($cate_id)
	{
		// 获取上级分类
		$sql = "select cate_parent from fu_article_cate where cate_id = " . $cate_id . " and cate_show = 1 limit 1";
		$res = $this->db->query($sql);
		if($res->num_rows() <= 0)
		{
			return '';
		}
		$parents = $res->row();
		$cate_parent  = $parents->cate_parent;
		
		$sql = "select * from fu_article_cate where cate_parent = " . $cate_parent . " and cate_show = 1 order by cate_sort desc,cate_id asc ";
		
		$res = $this->db->query($sql);
		if($res->num_rows() <= 0)
		{
			return '';
		}
		return $res->result_array();
	}
	
	/**
	 * 查询当前分类名称
	 * @param unknown $cate_id
	 */
	function subCateModel($cate_id)
	{
		// 获取上级分类
		$sql = "select * from fu_article_cate where cate_id = " . $cate_id . " and cate_show = 1 limit 1";
		$res = $this->db->query($sql);
		if($res->num_rows() <= 0)
		{
			return '';
		}
		return 	$res->row();	
			
	}
	
	/**
	 * 文章列表页
	 * @param unknown $id
	 */
	function listArticleModel($id,$page=1,$pagesize=10)
	{
		$startPage = ($page - 1) * $pagesize;
		$sql = "select article_id,article_title,article_cate_id from fu_article where article_cate_id = " . $id . " and article_flag = 1 
				order by article_id desc limit " . $startPage . "," . $pagesize;
		
		$res = $this->db->query($sql);
		if($res->num_rows() <= 0)
		{
			return '';
		}
		return $res->result_array();
	}
	
	/**
	 * 查总数
	 * @param unknown $tableName
	 * @param unknown $param
	 */
	function totalRecordModel($tableName, $param = array())
	{
		if($param)
		{
			$where = " where ";
			foreach($param as $k => $v)
			{
				$where .= $k . " = '" . $v . "' and ";
			}
			$where = substr($where,0,-4);
			
			$sql = "select count(*) as total from " . $tableName .$where;
		}else {
			$sql = "select count(*) as total from " . $tableName;
		}
		$res = $this->db->query($sql);
		if($res->num_rows() <= 0)
		{
			return 0;
		}
		$totalNumber = $res->row();
		return $totalNumber->total;
	}
	
	
	
	
}