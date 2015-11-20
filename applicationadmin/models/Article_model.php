<?php
class Article_model extends CI_Model
{
	/**
	 * @deprecated 增加文章入库
	 * @param string $article_title 文章标题
	 * @param int $article_flag 文章状态
	 * @param unknown $article_datetime
	 * @param unknown $article_headline
	 * @param unknown $article_keywords
	 * @param unknown $article_description
	 * @param unknown $article_click
	 * @param unknown $content
	 */
	function addArticleDeal($article_title,$article_flag,$article_datetime,$article_headline,$article_keywords,$article_description,$article_click,$content,$article_cate_id)
	{
		$sql = "insert into fu_article(article_title,article_flag,article_datetime,article_headline,
				article_keywords,article_description,article_click,article_content,article_cate_id) values(
				'".$article_title."', '".$article_flag."', '".$article_datetime."', '".$article_headline."',
				'".$article_keywords."','" . $article_description ."','".$article_click."','".$content."', '".$article_cate_id."')";
		$this->db->query($sql);	
		 return $this->db->affected_rows();
	}
	
	/**
	 * @deprecated 文章列表
	 * @param unknown $page
	 * @param unknown $pageSize
	 */
	function listArticle($page,$pageSize)
	{
		$startNumber = ($page-1) * $pageSize;	
		$sql = "select * from fu_article order by article_id desc limit " . $startNumber . ", " . $pageSize;
	    $res = $this->db->query($sql);
	    return $res->result_array();
	}
	/**
	 * 获取文章总数
	 */
	function listArticleTotal()
	{
		$sql = "select count(*) as total from fu_article";
		$result = $this->db->query($sql);
		$rowResult = $result->row();
		return $rowResult->total;
	}
	
	/**
	 * 删除文章
	 * @param unknown $id
	 */
	function listArticleDel($id)
	{
	    $sql = "delete from fu_article where article_id = " . $id;
	    $this->db->query($sql);
	    return $this->db->affected_rows();
	}
	
	/**
	 * 查看文章
	 * @param unknown $id
	 */
	function listArticleDetails($id)
	{
	    $sql = "select * from fu_article where article_id = " . $id;
	    $res = $this->db->query($sql);	
	    return $res->row();
	}
	
	/**
	 * 文章编辑处理
	 * @param unknown $id 
	 * @param unknown $article_title
	 * @param unknown $article_flag
	 * @param unknown $article_headline
	 * @param unknown $article_keywords
	 * @param unknown $article_description
	 * @param unknown $content
	 */
	function updateArticleDeal($id,$article_title,$article_flag,$article_headline,$article_keywords,$article_description,$content)
	{
	   $sql = "update fu_article set article_title ='".$article_title."', article_flag = " . $article_flag .
	           ", article_headline = '".$article_headline."', article_keywords = '".$article_keywords."',
	             article_description = '" . $article_description . "',article_content = '".$content."' where article_id = " . $id;
	   $this->db->query($sql);
	   return $this->db->affected_rows();
	}
	
	/**
	 * 文章分类查询
	 */
	function addCateModel()
	{
		$sql = "select * from fu_article_cate where cate_parent = 0";
		$res = $this->db->query($sql);
		if($res->num_rows() <= 0)
		{
		    return '';
		}
		$cate_arr = array();
		$cate_parent = $res->result_array();
		foreach($cate_parent as  $k=>$v)
		{
		    $cate_arr[]=$v;
		    $cate_id = $v['cate_id'];
		    $query = "select * from fu_article_cate where cate_parent = " . $cate_id;
		    $ress = $this->db->query($query);
		    $cates = $ress->result_array();
		    if($cates){
		        foreach($cates as $vv)
		        {
		          $cate_arr[] = $vv;
		        }
		     }
		}
		return $cate_arr;
	}
	
	/**
	 * 增加文章分类
	 * @param unknown $param
	 */
	function addCateDealModel($param)
	{
		$values = " ( ";
		$key = " ( ";
		foreach($param as $k=>$v)
		{
			$key .= $k . ",";
			$values .= "'".$v . "',";
		}

		$key = substr($key,0,-1) . ")";
		$values = substr($values,0, -1) . ")";
		$sql = "insert into fu_article_cate " . $key . " values " . $values;
	   $this->db->query($sql);
	   return $this->db->affected_rows();
	}
	
	/**
	 * 删除内容
	 * @param unknown $table
	 * @param unknown $key
	 * @param unknown $id
	 */
	function delCateModel($table,$key,$id)
	{
	    $sql = "delete from " . $table . " where " . $key . " = '" . $id . "'";
	    $this->db->query($sql);
	    return $this->db->affected_rows();
	}
	
	/**
	 * 
	 * @param unknown $tableName
	 * @param unknown $param
	 */
	function updateCateModel($tableName,$param)
	{
		$str = "";
		foreach($param as $k=>$v)
		{
			$str .= $k . " = '" . $v . "'"; 
		}
		$sql = "select * from " . $tableName . " where " . $str;
		$res = $this->db->query($sql);
		return  $res->result_array();
	} 
	
	/**
	 * 更新
	 * @param unknown $tableName
	 * @param unknown $param
	 * @param unknown $paramWhere
	 */
	function updateCateDealModel($tableName,$param,$paramWhere)
	{
		$where = " ";
		$fields = " ";
		foreach($paramWhere as $k=>$v)
		{
			$where .= $k . " = '" .$v. "' ";
		}
		foreach($param as $kk=>$vv)
		{
			$fields .= $kk . " = '" . $vv ."',";
		}
		$fields = substr($fields,0,-1);
		$sql = "update " . $tableName . " set " . $fields . " where " . $where;
		
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
}