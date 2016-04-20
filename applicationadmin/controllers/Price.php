<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Price extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Price_model');
		$this->isLogin();
	}
	
	/**
	 * 检测是否登陆
	 */
	function isLogin()
	{
	    if(!($this->session->userId) || ($this->session->userId) <= 0)
	    {
	        header("Location:".URL_APP_C."/Index/login");
	    } 
	    return true;
	}
	/**
	 * 获取捐赠额最小值和最大值
	 * @return unknown
	 */	
	function checkMaxMinPrice()
	{
		$res = $this->Price_model->checkMaxMinPriceModel();
		if(!$res)
		{
			$data['minVal'] = 0.00;
			$data['maxVal'] = 0.00;
		}else {
			$data['minVal'] = isset($res['minVal']->price_min) && !empty($res['minVal']->price_min) ? $res['minVal']->price_min : 0.00;
			$data['maxVal'] = isset($res['maxVal']->price_max) && !empty($res['maxVal']->price_max) ? $res['maxVal']->price_max : 0.00;
		}
		
		return $data;
	}
	/**
	 * 查看捐赠额列表
	 */
	function priceList()
	{
	    if(!hasPerssion($_SESSION['role'], 'priceList')){
	        exit('无权限,请点击左栏目操作');
	    } 
		
		$res = $this->Price_model->priceListModel();
		if(!$res)
		{
			echo '没有相关数据 ';
			if(!hasPerssion($_SESSION['role'], 'priceList')){
				echo "请联系管理员设置 捐赠额分档";
			}else
			{
				echo "<a href='".URL_APP_C."/Price/priceAdd'>增加捐赠额分档</a>";
			}
			exit;
		}
		// 密码列表
		$view = array();
		$view['title'] = '分档捐赠额列表';
		$view['priceList'] = $res;
		$view['minMaxPrice'] = $this->checkMaxMinPrice();
		$this->load->view('priceList', $view);
	}
	 
	
	/**
	 * 增加捐赠额分档
	 */
	function priceAdd()
	{
	    if(!hasPerssion($_SESSION['role'], 'priceAdd')){
	        exit('无权限,请点击左栏目操作');
	    }
	    $view = array();
	    // 判断是否有查看捐赠额的权限
	    $hasList = 1;
	    if(!hasPerssion($_SESSION['role'], 'priceList')){
	    	$hasList = 0;
	    }
	    // 捐赠额分档是否有值
	    if($hasList)
	    {	
	    	$res = $this->Price_model->priceListModel();
	    	
	    	if($res)
	    	{
	    		$view['priceList'] = $res;
	    		$hasList = 1;
	    	}else {
	    		$hasList = 0;
	    	}
	    }
	    $view['hasList'] = $hasList;
	    $view['minMaxPrice'] = $this->checkMaxMinPrice();
		$this->load->view('priceAdd',$view);
	}

	/**
	 * 增加捐赠额分档设置处理
	 */
	 function priceAddDeal()
	 {
	    if(!hasPerssion($_SESSION['role'], 'priceAdd')){
	        exit('无权限,请点击左栏目操作');
	    }
		$param['price_min'] = addslashes($_POST['minPrice']);
		$param['price_max'] = addslashes($_POST['maxPrice']);
		$param['price_alias'] = addslashes($_POST['price_alias']);
		$param['price_create'] = time();
		$param['price_user'] = $this->session->admin_user;
		$param['price_user_id'] = $this->session->userId;
		
		if($param['price_min']== '' || $param['price_max'] == '')
		{
			exit('最小捐赠额和最大捐赠额不能为空!');
		}
		if($param['price_min'] >= $param['price_max'])
		{
			exit('最小捐赠额不能大于最大捐赠额!');
		}
		
		if($param['price_alias']== '')
		{
			exit('捐赠额名称不能为空!');
		}		
		$res = $this->Price_model->priceAddDealModel($param);
		 if($res)
		 {
				$this->load->view('success');
		 }else
		 {
				$this->load->view('failure');
		 }
	 }

	/**
	 * 删除捐赠额分档
	 */
	function priceDel()
	{
	    if(!hasPerssion($_SESSION['role'], 'priceDel')){
	        exit('无权限,请点击左栏目操作');
	    } 
		$id = intval($this->input->get_post('id'));	
		if(!$id || $id < 0)
		{
			exit('非法操作');
		}
		$res = $this->Price_model->priceDelModel($id);
		if($res)
		{
			$this->load->view('success');
		}else
		{
			$this->load->view('failure');
		}		
	}  
	
	/**
	 * 编辑捐赠额位
	 */
	function priceUpdate()
	{
		if(!hasPerssion($_SESSION['role'], 'priceUpdate')){
			exit('无权限,请点击左栏目操作');
		}	
		$id = intval($this->input->get_post('id'));
		if(!$id || $id < 0)
		{
			exit('非法操作');
		}	
		$res = $this->Price_model->priceListModel($id);
		if(!$res)
		{
			exit('没有相关数据');
		}
		$view['pricePerList'] = $res[0];
		$resAll = $this->Price_model->priceListModel();
		$view['priceList'] = $resAll;
		$view['minMaxPrice'] = $this->checkMaxMinPrice();
		$this->load->view('priceUpdate',$view);
	}
	
	/**
	 * 捐赠额修改设置
	 */
	function priceUpdateDeal()
	{
		if(!hasPerssion($_SESSION['role'], 'priceUpdate')){
			exit('无权限,请点击左栏目操作');
		}	
		$id = intval($this->input->get_post('id'));
		if($id < 0)
		{
			exit('非法操作');
		}	
		$price_min = addslashes($this->input->get_post('minPrice'));
		$price_max = addslashes($this->input->get_post('maxPrice'));
		$price_alias = addslashes($this->input->get_post('price_alias'));
		if($price_min == '' || $price_max == '')
		{
			exit('最小捐赠额和最大捐赠额不能为空!');
		}
		if($price_min >= $price_max)
		{
			exit('最小捐赠额不能大于最大捐赠额!');
		}
		if($price_alias == '')
		{
			exit('捐赠额名称不能为空!');
		}
		$param = array();
		$param['price_min'] = $price_min;
		$param['price_max'] = $price_max;
		$param['price_alias'] = $price_alias;
		
		$param['price_create'] = time();
		$param['price_user'] = $this->session->admin_user;
		$param['price_user_id'] = $this->session->userId;
		$affectRow = $this->Price_model->priceUpdateDealModel($param, $id);
		if($affectRow)
		{
			$this->load->view('success');
		}else
		{
			$this->load->view('failure');
		}
	}



}