<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 是否有权限
 */
function hasPerssion($role,$controllers)
{
	if(!in_array('all',$_SESSION['role']) && !in_array($controllers,$_SESSION['role']))
	{
		return false;
	}else
	{
		return true;
	}
}
/**
 * 权限文件表
 */

// ------------------------------------------------------------------------
function perssion()
{
	$per = array();
	// 文章权限
	$per['article'] = array(
		'addArticle'=>'发表文章',
		'listArticleDel'=>'删除文章',
		'listArticle'=>'查看文章',
		'listArticleUpdate'=>'编辑文章',
	    'addCate'=>'增加文章分类',
	    'listCate'=>'分类列表',
	    'updateCate'=>'修改文章分类',
	    'delCate'=>'删除文件分类'
	);

	// 顾客权限
	$per['member'] = array(
		'member'=>'查看列表',	
	);

	// 订单权限
	$per['order'] = array(
		'orderList'=>'查看订单列表',	
		'orderSearch'=>'订单查询',
		'posInfosDeal'=>'订单修改',
	);

	// 房间牌位权限
	$per['room'] = array(
		'roomOpen'=>'房间牌位开设',	
		'roomList'=>'房间查看',
		'updateRoom'=>'房间编辑',
		'delRoom'=>'房间删除',
		'roomInfos'=>'牌位查看',
		'postionList'=>'牌位列表',
		'posLocation'=>'牌位编辑',
		'delPos'=>'牌位删除',
		'mutilDeal'=>'批量修改'
	);

	// 统计权限
	$per['tongji'] = array(
		'tongjiList'=>'查看统计',
		'clearList'=>'清空无效订单'
	);

	// 管理员权限
	$per['user'] = array(
		'userList'=>'管理员查看',
		'userAdd'=>'管理员增加',
		'userInfosUpdate'=>'管理员编辑',
		'userDel'=>'管理员删除',
	);

	// 友情链接权限
	$per['links'] = array(
		'linkList'=>'友情链接',
	);

	// 道教文化权限
	$per['curlture'] = array(
		'curlture'=>'道教文化',
	);

	// 版权信息权限
	$per['copyright'] = array(
		'copyrightInfo'=>'版权信息',
	);
	
	// 关于我们
	$per['aboutus'] = array(
			'aboutUsInfo'=>'关于我们',
	);

	// 密码管理
	$per['password'] = array(
			'passwordCheckForRand'=>'查看随机密码',
			'passwordCheckForHigh'=>'查看高端密码',
			'passwordAddForRand'=>'设置随机密码',
			'passwordAddForHigh'=>'设置高端节密码',
	);	
	// 价格分类管理
	$per['price'] = array(
			'priceList'=>'价格查看',
			'priceAdd'=>'价格增加',
			'priceDel'=>'价格删除',
			'priceUpdate'=>'价格修改',
	);

	// 业务员管理
	$per['memberteam'] = array(
	    'memberteamList'=>'分组查看',
	    'memberteamAdd'=>'分组增加',
	    'memberteamDel'=>'分组删除',
	    'memberteamUpdate'=>'分组编辑',
	    'memberteamInfos'=>'分组组长信息',
	    'memberteamListUser'=>'业务员列表',
	    'memberteamAddUser'=>'业务员增加',
	    'memberteamDelUser'=>'业务员删除',
	    'memberteamUpdateUser'=>'业务员编辑',
	    'memberteamSaleUser'=>'业务员业绩',
	);	
	
	// 关于我们
	$per['webset'] = array(
			'websetSystem'=>'选号系统开启状态',
			'websetCopy'=>'官网开启状态',
	);	
	return $per;
}
/*

if(!hasPerssion($_SESSION['role'], '')){
	exit('无权限,请点击左栏目操作');
}	

*/

