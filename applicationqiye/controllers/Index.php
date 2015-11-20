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
		
		$this->load->view('index', $view);
	}
	
	/**
	 * 分类列表
	 */
	public function listitem()
	{
	    
	    $id = $this->uri->segment(3,1);
			echo '<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>二级栏目内容待整理中</title>
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<meta name="robots" content="index, follow" />
<meta name="googlebot" content="index, follow" />
<link href="/css/style.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery-1.8.3.min.js" type="text/javascript"></script>

</head>
<body>';
			echo '内容有待整理中';
			echo "</body></html>";
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
		$id = $this->uri->segment(3,1);
		if($id ==1)
		{
			$this->load->view('details_1',$view);
		}elseif($id ==2)
		{
			$this->load->view('details_2',$view);
		}elseif($id ==3)
		{
			$this->load->view('details_3',$view);
		}elseif($id==4)
		{
			$this->load->view('details_4',$view);
		}else {
			$this->load->view('details_5',$view);
		}
	}



}
