<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
	private $source = array(1=>'pc',2=>'android',3=>'ois',4=>'wap');
	function __construct()
	{
		parent::__construct();
		$this->load->model('Member_model');
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
	 * 会员列表
	 */
	function index()
	{
	    if(!hasPerssion($_SESSION['role'], 'member')){
	        exit('无权限,请点击左栏目操作');
	    }	    
		$page = $this->input->get_post('page');
		if(!$page)
		{
			$page = 1;
		}
		$page = intval($page);
		$total = $this->Member_model->total();
		if(!$total)
		{
			echo '没有相关数据！';
			echo "<a href=\"javascript:history.go(-1)\">点击返回</a>";
			exit;
		}
		$totalPage = ceil($total/PAGESIZE);
		$result = $this->Member_model->memberList($page,PAGESIZE);
		$view['total'] = $total;
		$view['result'] = $result;
		$view['totalPage'] = $totalPage;
		$view['page'] = $page;
		if($page > $totalPage)
		{
			$page = $totalPage;
		}
		if($page > 1)
		{
			$view['prePage'] = $page - 1;
			$view['indexPage'] = 1;
		}
		if($page < $totalPage)
		{
			$view['nextPage'] = $page+1;
			$view['endPage'] = $totalPage;
		}
		$view['source'] = $this->source;
		$this->load->view('memberIndex',$view);
		
	}
	
	/**
	 * 会员删除
	 */
	function delMember()
	{
	    /*
		$id = $this->input->get_post('id');
		$locationId = $this->input->get_post('locationId');
		if(!$id || !$locationId)
		{
			echo '没有相关数据！';
			echo "<a href=\"javascript:history.go(-1)\">点击返回</a>";
			exit;			
		}
		$id = intval($id);
		$locationId = intval($locationId);
		$res = $this->Member_model->delMember($id,$locationId);
		if($res)
		{
			$this->load->view('success');
		}else {
			$this->load->view('failure');
		} */
	}
	
	/**
	 * 查询会员
	 */
	function memberSearch()
	{
	    if(!hasPerssion($_SESSION['role'], 'member')){
	        exit('无权限,请点击左栏目操作');
	    }	    
		$bodyId = $this->input->get_post('bodyId');
		if(!$bodyId)
		{	
			$this->load->view('memberSearch');
		}else {
			$bodyId = addslashes($bodyId);
			$res = $this->Member_model->memberSearch($bodyId);
			if(!$res)
			{
				echo '没有相关数据！';
				echo "<a href=\"javascript:history.go(-1)\">点击返回</a>";
				exit;				
			}
			$view['result'] = $res;
			$view['source'] = $this->source;
			$this->load->view('memberSearchList',$view);
		}
		
	}


}