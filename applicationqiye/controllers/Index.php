<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Qiye_model');
	}
	
	/**
	 * 导航菜单
	 * @return unknown
	 */
	public function menu()
	{
		$cate = $this->Qiye_model->menuModel();	
		return $cate;
	}
	

	/**
	 * 首页
	 */
	public function index()
	{  
		$view = array();
		$cate = $this->menu();
		$view['cate'] = $cate;
		$linksCopy = $this->Qiye_model->linksCopy();
		$view['linksCopy'] = $linksCopy;
		$this->load->view('index', $view);
	}
	
	/**
	 * 分类列表
	 */
	public function listitem()
	{
		$view = array();
		$cate = $this->menu();
		$view['cate'] = $cate;	
		$linksCopy = $this->Qiye_model->linksCopy();
		$view['linksCopy'] = $linksCopy;		
	    $id = $this->uri->segment(3,1);
	    $id = intval($id);
	    if($id==6)
	    {
	    	$this->load->view('chjs', $view);
	    }elseif($id == 7)
	    {
	    	$this->load->view('cityroom', $view);
	    }else {
	    	// 二级子栏目
	    	$subCate = $this->Qiye_model->subCate($id);
	    	if(!$subCate)
	    	{
	    		exit('没有相关内容，请先添加分类');
	    	}
	    	$cateName = $this->Qiye_model->subCateModel($id);
	    	// 文章总数
	    	$param = array('article_cate_id'=>$id,'article_flag'=>1);
	    	$totalNumber = $this->Qiye_model->totalRecordModel('fu_article',$param);
	    	
	    	// 总页码
	    	$totalPages = ceil($totalNumber/PAGESIZE);
	    	$page = $this->uri->segment(4,1);
	    	if($page < 1)
	    	{
	    		$page = 1;
	    	}elseif($page > $totalPages) {
	    		$page = $totalPages;
	    	}
	    	if($totalPages < 1)
	    	{
	    		exit('没有相关内容，请先添加分类');
	    	}
	    	$listArticles = $this->Qiye_model->listArticleModel($id,$page,PAGESIZE);
	    	$view['result']['subCate'] = $subCate;
	    	$view['result']['totalNumber'] = $totalNumber;
	    	$view['result']['totalPages'] = $totalPages;
	    	$view['page'] = $page;
	    	$view['parent_id'] = $id;
	    	$view['result']['listArticles'] = $listArticles;
	    	$view['cateName'] = $cateName;
	    	// print_r($view); exit;
	    	$linksCopy = $this->Qiye_model->linksCopy();
	    	$view['linksCopy'] = $linksCopy;
	    	$this->load->view('listitem',$view);
	    	
	    	
	    }
	    //print_r($id);
	}
	
	
	
	/**
	 * 文章详情页
	 */
	function details()
	{
		// 以下为以后用
		/*
		$view = array();
		$cate = $this->menu();
		$view['cate'] = $cate;
	    $id = $this->uri->segment(3,1);
	    $id = intval($id);
	    $details = $this->Qiye_model->detailsModel($id);
	    $view['details'] = $details;
		
	    $this->load->view('details', $view);	
	    */  
		$cate = $this->menu();
		$view['cate'] = $cate;
		$linksCopy = $this->Qiye_model->linksCopy();
		$view['linksCopy'] = $linksCopy;
		$id = $this->uri->segment(3,1);
		if($id ==1)
		{
			$this->load->view('details_1',$view);
		}elseif($id ==2)
		{
			// $this->load->view('details_2',$view);
			// 查询文化表
            $curlture[0] = '道教典籍';
            $curlture[1] = '道教斋醮';
            //$curlture[2] = '道教音乐';
            $curlture[3] = '道教艺术馆';
            $view['curlture'] = $curlture;
            $view['list'] = ''; 
		    $result = $this->Qiye_model->curltureModel();
		    if($result)
		    {
		        foreach($result as $k=>$v)
		        {
		            $view['list'][$v['curlture_cate']][] = $v;
		        }
		    } 
		    
		    $this->load->view('details_2',$view);
		}elseif($id ==3)
		{
			$this->load->view('details_3',$view);
		}elseif($id==4)
		{
			$this->load->view('details_4',$view);
		}else {
			$aboutUs = $this->Qiye_model->aboutUs();
			$view['aboutUs'] = $aboutUs;
			$this->load->view('details_5',$view);
		}
	}
	
	/**
	 * 列表文章详情页
	 */
	function listDetail()
	{
		$view = array();
		$cate = $this->menu();
		$view['cate'] = $cate;
		$linksCopy = $this->Qiye_model->linksCopy();
		$view['linksCopy'] = $linksCopy;
	    $id = $this->uri->segment(3,1);
	    $id = intval($id);
    	// 二级子栏目
    	$subCate = $this->Qiye_model->subCate($id);
    	if(!$subCate)
    	{
    		exit('没有相关内容，请先添加分类');
    	}
    	$cateName = $this->Qiye_model->subCateModel($id);
    	$aid = $this->uri->segment(4,0);
    	if(!$aid)
    	{
    		$view['article'] = '没有相关内容';
    	}else {
    		$article = $this->Qiye_model->detailsModel($aid);
    		
    		if($article)
    		{
    			$view['article'] = $article;
    		}else {
    			$view['article'] = '没有相关内容';
    		}
    	}
    	$view['result']['subCate'] = $subCate;

    	$view['parent_id'] = $id;

    	$view['cateName'] = $cateName;
    	//print_r($view); exit;
    	$this->load->view('listDetail',$view);
	    	
	 
	}
	
	/**
	 * 列表文章详情页
	 */
	function curlture()
	{  
	    $view = array();
	    $cate = $this->menu();
	    $view['cate'] = $cate;
	    $linksCopy = $this->Qiye_model->linksCopy();
	    $view['linksCopy'] = $linksCopy;
	    $id = $this->uri->segment(3,1);
	    $id = intval($id);
	    $article = $this->Qiye_model->curltureModel(array('curlture_id'=>$id));
	    $view['article'] = $article;
	    $curlture[0] = '道教典籍';
	    $curlture[1] = '道教斋醮';
	    //$curlture[2] = '道教音乐';
	    $curlture[3] = '道教艺术馆';
	    $view['curlture'] = $curlture;
	
	   
	    //print_r($view); exit;
	    $this->load->view('curlture',$view);
	
	
	}	



}
