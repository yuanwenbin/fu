<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Article_model');
		$this->isLogin();
	}
	
	/**
	 * 检测是否登陆
	 */
	function isLogin()
	{
	    if(!($this->session->userId) || ($this->session->userId) <= 0)
	    {
	        header("Location:/Index/login");
	    }
	    return true;
	}
	
	/**
	 * 发表文章
	 */
	function addArticle()
	{    
	    if(!hasPerssion($_SESSION['role'], 'addArticle')){
	        exit('无权限,请点击左栏目操作');
	    }	
	    $view = array();
	    $view['cate_name'] = $this->Article_model->addCateModel();
	    
		$this->load->view('addArticle',$view);
	}
	
	/**
	 * 处理文章入库
	 */
	function addArticleDeal()
	{
	    if(!hasPerssion($_SESSION['role'], 'addArticle')){
	        exit('无权限,请点击左栏目操作');
	    }	    
		// 标题
		$article_title = $this->input->post_get('article_title');
		// 内容
		$content = $this->input->post_get('content');
		if(!$article_title || !$content)
		{
			$this->load->view('failure');
			exit;
		}
		$article_title = addslashes($article_title); 
		$content = addslashes($content);
		$article_flag = intval($this->input->post_get('article_flag'));
		$article_headline = addslashes($this->input->post_get('article_headline'));
		$article_keywords = addslashes($this->input->post_get('article_keywords'));
		$article_description = addslashes($this->input->post_get('article_description'));
		$article_click = 1;
		$article_datetime = time();
		
		$article_cate_id = addslashes($this->input->post_get('article_cate'));
		$res = $this->Article_model->addArticleDeal($article_title,$article_flag,$article_datetime,$article_headline,$article_keywords,$article_description,$article_click,$content,$article_cate_id);
		if($res)
		{
			$this->load->view('success');
		}else {
			$this->load->view('failure');
		}
	}
	
	/**
	 * 文章列表
	 */
	function listArticle()
	{
	    /*
	    if(!hasPerssion($_SESSION['role'], 'listArticle')){
	        exit('无权限,请点击左栏目操作');
	    } */	    
		$total = $this->Article_model->listArticleTotal();
		if(!$total)
		{
			echo '没有相关数据！';
			echo "&nbsp;<a href=\"javascript:history.go(-1);\">点击返回</a>";
			exit;			
		}
		$page = $this->input->get_post('page');
		if(!$page)
		{
			$page = 1;
		}else {
			$page = intval($page);
		}
		if($page > 1)
		{
		    $view['indexPage'] = 1;
		    $view['prePage'] = $page - 1;
		}
		$totalPage = ceil($total/PAGESIZE);
		if($page > $totalPage)
		{
		    $page = $totalPage;
		}
		if($page < $totalPage)
		{
		    $view['nextPage'] = $page + 1;
		    $view['endPage'] = $totalPage;
		}
		$view['total'] = $total;
		$view['page'] = $page;
		$result = $this->Article_model->listArticle($page,PAGESIZE);
		$view['result'] = $result;
        $view['totalPage'] = $totalPage;
		$this->load->view('listArticle', $view);
	}
	
	/**
	 * 删除文章
	 */
	function listArticleDel()
	{
	   $id = $this->input->get_post('id'); 
	   if(!$id)
	   {
	       echo '没有相关数据！';
	       echo "&nbsp;<a href=\"javascript:history.go(-1);\">点击返回</a>";
	       exit;
	   }
	   $id = intval($id);
	   $res = $this->Article_model->listArticleDel($id);

	   $this->load->view('success'); 
	
	}
	
	/**
	 * 查看文章
	 */
	function listArticleDetails()
	{
	    if(!hasPerssion($_SESSION['role'], 'listArticle')){
	        exit('无权限,请点击左栏目操作');
	    }	    
	    $id = $this->input->get_post('id');
	    if(!$id)
	    {
	        echo '没有相关数据！';
	        echo "&nbsp;<a href=\"javascript:history.go(-1);\">点击返回</a>";
	        exit;
	    }	
	    $id = intval($id);
	    $res = $this->Article_model->listArticleDetails($id);
	    if(!$res)
	    {
	        echo '没有相关数据！';
	        echo "&nbsp;<a href=\"javascript:history.go(-1);\">点击返回</a>";
	        exit;	      
	    }
	    $view['result'] = $res;
	    
	    $this->load->view('listArticleDetails',$view);
	}
	
	/**
	 * 文章编辑
	 */
	function listArticleUpdate()
	{
	    if(!hasPerssion($_SESSION['role'], 'listArticleUpdate')){
	        exit('无权限,请点击左栏目操作');
	    }	    
	    $id = $this->input->get_post('id');
		if(!$id)
	    {
	        echo '没有相关数据！';
	        echo "&nbsp;<a href=\"javascript:history.go(-1);\">点击返回</a>";
	        exit;
	    }
	    $id = intval($id);
	    $res = $this->Article_model->listArticleDetails($id);
	    if(!$res)
	    {
	        echo '没有相关数据！';
	        echo "&nbsp;<a href=\"javascript:history.go(-1);\">点击返回</a>";
	        exit;
	    }
	    $view['result'] = $res;
	    $this->load->view('listArticleUpdate',$view);
	}
	
	/**
	 * 文章编辑处理
	 */
	function updateArticleDeal()
	{
	    if(!hasPerssion($_SESSION['role'], 'listArticleUpdate')){
	        exit('无权限,请点击左栏目操作');
	    }	    
	    $id = $this->input->get_post('article_id');
	    if(!$id)
	    {
	        echo '没有相关数据！';
	        echo "&nbsp;<a href=\"javascript:history.go(-1);\">点击返回</a>";
	        exit;
	    }	
	    $id = intval($id);
	    // 标题
	    $article_title = $this->input->post_get('article_title');
	    // 内容
	    $content = $this->input->post_get('content');
	    if(!$article_title || !$content)
	    {
	        $this->load->view('failure');
	        exit;
	    }
	    $article_title = addslashes($article_title);
	    $content = addslashes($content);
	    $article_flag = intval($this->input->post_get('article_flag'));
	    $article_headline = addslashes($this->input->post_get('article_headline'));
	    $article_keywords = addslashes($this->input->post_get('article_keywords'));
	    $article_description = addslashes($this->input->post_get('article_description'));
	    $res = $this->Article_model->updateArticleDeal($id,$article_title,$article_flag,$article_headline,$article_keywords,$article_description,$content);
	    if($res)
	    {
	        $this->load->view('success');
	    }else {
	        $this->load->view('failure');
	    }	    
	}
	
	/**
	 * 增加文章分类
	 */
	function addCate()
	{
	    if(!hasPerssion($_SESSION['role'], 'addCate')){
	        exit('无权限,请点击左栏目操作');
	    }	
	    //code  
	    $view = array();
	    $view['cate_name'] = $this->Article_model->addCateModel();
	
	    $this->load->view('addCate', $view);
	}
	
	/**
	 * 增加文章分类处理
	 */
	function addCateDeal()
	{
		if(!hasPerssion($_SESSION['role'], 'addCate')){
			exit('无权限,请点击左栏目操作');
		}
		//code
		$data = array('error'=>1,'msg'=>'出错了，稍后重试');
		$cate_name = $this->input->get_post('cate_name');
		$cate_parent = intval($this->input->get_post('cate_parent'));
		$cate_sort = intval($this->input->get_post('cate_sort'));
		$cate_show = intval($this->input->get_post('cate_show'));
		if(!$cate_name)
		{
			$data['msg'] = '没有添加分类名称';
			die(json_encode($data));
		}
		$param = array('cate_name'=>$cate_name, 'cate_parent' => $cate_parent, 'cate_sort'=>$cate_sort,'cate_show'=>$cate_show);
		
		
		$res = $this->Article_model->addCateDealModel($param);
		if($res)
		{
			$data = array('error'=>0,'msg'=>'成功增加分类');
			die(json_encode($data));
		}
	}	
    
	/**
	 * 查看分类列表
	 */
	function listCate()
	{
	    if(!hasPerssion($_SESSION['role'], 'listCate')){
	        exit('无权限,请点击左栏目操作');
	    }	
	    //code     
	    $view = array();
	    $cateList = array();
	    $cate_name = $this->Article_model->addCateModel();
	    $view['cate_name'] = $cate_name;
	    foreach($cate_name as $kk=>$vv)
	    {
	        $cateList[$vv['cate_id']] = $vv['cate_name'];
	    }
	    $view['cateList'] = $cateList;
	    $this->load->view('listCate', $view);	    
	}
    
	/**
	 * 更新分类
	 */
	function updateCate()
	{
	    if(!hasPerssion($_SESSION['role'], 'updateCate')){
	        exit('无权限,请点击左栏目操作');
	    }
	    //code	 
	    $view = array();
	    $cate_id = intval($this->input->get_post('cate_id'));
	    if($cate_id && $cate_id > 0)
	    {
	    	$tableName = 'fu_article_cate';
	    	$param = array('cate_id'=>$cate_id);
	    	$cate = $this->Article_model->updateCateModel($tableName,$param);
	    	if($cate)
	    	{
	    		$view['cate'] = $cate;
	    	}
	    }
	    
	    $this->load->view('updateCate', $view);	        
	}

	/**
	 * 更新分类处理
	 */
	function updateCateDeal()
	{
	    if(!hasPerssion($_SESSION['role'], 'updateCate')){
	        exit('无权限,请点击左栏目操作');
	    }
	    //code
	    $cate_id = intval($this->input->get_post('cate_id'));
	    if(!$cate_id && $cate_id < 0)
	    {
	    	$this->load->view('failure');
	    }else {
	    	$cate_id = intval($this->input->get_post('cate_id'));
	    	$cate_name = addslashes($this->input->get_post('cate_name'));
	    	$cate_sort = intval($this->input->get_post('cate_sort'));
	    	$cate_show = intval($this->input->get_post('cate_show'));
	    	$paramWhere = array('cate_id'=>$cate_id);
	    	$param = array(
	    			'cate_id'=>$cate_id,
	    			'cate_name'=>$cate_name,
	    			'cate_sort'=>$cate_sort,
	    			'cate_show'=>$cate_show,
	    			);
	    	$res = $this->Article_model->updateCateDealModel('fu_article_cate',$param,$paramWhere);
	    	if($res)
	    	{
	    		$this->load->view('success');
	    	}else {
	    		$this->load->view('failure');
	    	}
	    }
		
	}	
	/**
	 * 删除分类
	 */
	function delCate()
	{
	    if(!hasPerssion($_SESSION['role'], 'delCate')){
	        exit('无权限,请点击左栏目操作');
	    }
	    //code
	    $cate_id = intval($this->input->get_post('cate_id'));
	    if(!$cate_id)
	    {
	        $this->load->view('failure');
	    }else {
	        $r = $this->Article_model->delCateModel('fu_article','article_cate_id',$cate_id);
	        $rr = $this->Article_model->delCateModel('fu_article_cate','cate_id',$cate_id);
	        if($r && $rr)
	        {
	            $this->load->view('success');
	        }else {
	            $this->load->view('failure');
	        }
	    }
	}	

}