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
	    $sql = "select fu_article.* from fu_article,fu_article_cate where fu_article.article_cate_id = " . $id .
	           " and fu_article.article_flag = 1 and fu_article_cate.cate_show=1"; 
	    $res = $this->db->query($sql);
	    if($res->num_rows() <= 0)
	    {
	        return '';
	    }
	    return $res->result_array();
	}
	
	
	
	
}