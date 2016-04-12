<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curlture extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Curlture_model');
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
	 * 文化列表
	 */
	function curlture()
	{  
	    if(!hasPerssion($_SESSION['role'], 'curlture')){
	    	exit('点击左栏目操作,无权限');
	    }	
	    $listArr = array();    
	    $curltureLists = $this->Curlture_model->curltureList();
	    /*
	    if($curltureLists)
	    {
	    	foreach($curltureLists as $k=>$v)
	    	{
	    		$listArr[$v['curlture_cate']][] = $v;
	    	}
	    } */
	   // $view['listArr'] = $listArr;
	    $view['listArr'] = $curltureLists;
	    $curlture[0] = '道教典籍';
	    $curlture[1] = '道教斋醮';
	    // $curlture[2] = '道教音乐';
	    $curlture[3] = '道教艺术馆';
	    $view['curlture'] = $curlture;
	   $this->load->view('curlture',$view);
	}
	
	/**
	 * 增加
	 */
	function addCurlture()
	{
		if(!hasPerssion($_SESSION['role'], 'curlture')){
			exit('点击左栏目操作,无权限');
		}
		$view = array();
		$curlture[0] = '道教典籍';
		$curlture[1] = '道教斋醮';
		// $curlture[2] = '道教音乐';
		$curlture[3] = '道教艺术馆';
		$view['curlture'] = $curlture;
		$this->load->view('addCurlture',$view);		
	}
	
	/**
	 * 增加处理
	 */
	function addCurltureDeal()
	{
		if(!hasPerssion($_SESSION['role'], 'curlture')){
			exit('点击左栏目操作,无权限');
		}
			
		// 上传图片
		$filePic = '';
		if($_FILES['curlture_pic']['name'])
		{
			$filePic = fileUpload($_FILES['curlture_pic'], '../qiye/images/');
		}
		$param = array();
		$param['curlture_headline'] = addslashes($_POST['curlture_headline']);
		$param['curlture_content'] = addslashes($_POST['content']);
		$param['curlture_datetime'] = time();
		$param['curlture_cate'] = intval($_POST['curlture_cate']);
		$param['curlture_pic'] = $filePic;
		$param['curlture_seo_title'] = addslashes($_POST['curlture_seo_title']);
		$param['curlture_seo_keys'] = addslashes($_POST['curlture_seo_keys']);
		$param['curlture_seo_descritpion'] = addslashes($_POST['curlture_seo_descritpion']);
		$flag = $this->Curlture_model->addCurltureDealModel('fu_curlture',$param);
		if($flag)
		{
			$this->load->view('success');
		}else {
			$this->load->view('failure');
		}
	}
	
	/**
	 * 删除处理
	 */
	function delCurlture()
	{
		$id = intval($this->input->get_post('id'));
		
		if(!$id)
		{
			$this->load->view('failure');
		}else {
			$flag = $this->Curlture_model->delCurltureModel('fu_curlture',array('curlture_id'=>$id));
			
	
			$this->load->view('success');
			
		}
	}
}