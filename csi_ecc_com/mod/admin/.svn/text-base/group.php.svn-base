<?php

/*
 * 分组管理等
 * ninojiang 2013-05-15
 */

require_once API_PATH . 'IUser.php';
require_once API_PATH . 'IGroup.php';

IUser::init();
if(IUser::checkLogin() === false){
	return array('errno' => 500, 'msg' => '请重新登录');
}


function group_add(){
	
	if(!IUser::checkAuth(AUTH_GROUP_ADMIN)){
		return array('errno' => 1, 'msg' => '权限不够');
	}
	
	$data = array();
	if(!$_REQUEST['name']){
		return array('errno' => 1, 'msg' => '分组名不能为空');
	}
	$data['name'] = $_REQUEST['name'];
	
	if(!$_POST['rtx']){
		return array('errno' => 1, 'msg' => '组长RTX不能为空');
	}
	if(!IUser::checkRtxUserExist($_POST['rtx'])){
		return array('errno' => 1, 'msg' => '组长RTX不存在');
	}
	$data['leader_rtx'] = $_POST['rtx'];
	
	if(IUser::$rtx === ''){
		return array('errno' => 2, 'msg' => '您尚未设置RTX名');
	}
	$data['creator_rtx'] = IUser::$rtx;
	
	$biz_list = IUser::getBusinessList();
	
	$data['bids'] = array();
	if($_REQUEST['bids']){
		$tmp = explode(',', $_REQUEST['bids']);
		foreach($tmp AS $bid){
			$bid = intval($bid);
			if($biz_list[$bid]){
				$data['bids'][] = $bid;
			}
		}
	}
	
	$ret = IGroup::addGroup($data);
	
	if($ret){
		return array('errno' => 0);
	}
}

function group_modify(){
	
	if(!IUser::checkAuth(AUTH_GROUP_ADMIN)){
		return array('errno' => 1, 'msg' => '权限不够');
	}
	
	$data = array();
	
	if(!$_REQUEST['group_id']){
		return array('errno' => 1, 'msg' => '分组ID不能为空');
	}
	$gid = intval($_REQUEST['group_id']);
	
	if(!$_REQUEST['name']){
		return array('errno' => 1, 'msg' => '分组名不能为空');
	}
	$data['name'] = $_REQUEST['name'];
	
	if(!$_POST['rtx']){
		return array('errno' => 1, 'msg' => '组长RTX不能为空');
	}
	if(!IUser::checkRtxUserExist($_POST['rtx'])){
		return array('errno' => 1, 'msg' => '组长RTX不存在');
	}
	$data['rtx'] = $_POST['rtx'];
	
	if(IUser::$rtx === ''){
		return array('errno' => 2, 'msg' => '您尚未设置RTX名');
	}
	
	$biz_list = IUser::getBusinessList();
	
	$data['bids'] = array();
	if($_REQUEST['bids']){
		$tmp = explode(',', $_REQUEST['bids']);
		foreach($tmp AS $bid){
			$bid = intval($bid);
			if($biz_list[$bid]){
				$data['bids'][] = $bid;
			}
		}
	}
	if(count($data['bids']) === 0){
		return array('errno' => 2, 'msg' => '业务参数错误');
	}
	
	$ret = IGroup::editGroup($gid, $data);
	
	if($ret){
		return array('errno' => 0);
	}else{
		return array('errno' => 2, 'msg' => '修改失败');
	}
}

function group_delete(){
	
	if(!IUser::checkAuth(AUTH_GROUP_ADMIN)){
		return array('errno' => 1, 'msg' => '权限不够');
	}
	
	if(!$_REQUEST['gid']){
		return array('errno' => 1, 'msg' => '分组ID不能为空');
	}
	$gids = $_REQUEST['gid'];
	$gids = explode(',', $gids);
	foreach($gids AS $gid){
		IGroup::deleteGroupById($gid);
	}
	
	return array('errno' => 0); 
}

//分组列表
function group_getlist(){
	$page = intval($_REQUEST['page']);
	$page = $page < 1 ? 1 : $page;

	$list = IGroup::getGroupList();
	
	//是否有查询关键字
	if($_REQUEST['query']){
		$s = trim($_REQUEST['query']);
		foreach($list AS $n => $item){
			if(!strstr($item['name'], $s) && !strstr($item['leader_rtx'], $s) && !strstr($item['biz_names'], $s)){
				unset($list[$n]);
			}
		}
		sort($list);
	}
	
	$count = count($list);
	
	return array(
		'errno'	=> 0,
		'data'	=> array(
				'total'	=> $count,
				'list'	=> $list,
				'admin'	=> IUser::checkAuth(AUTH_GROUP_ADMIN)
		)
	); 
}

function group_getallgroups(){
	$list = IGroup::getGroupList();
	return array(
		'errno'	=> 0,
		'data'	=> $list
	);
}

function group_getbizlist(){	
	return array(
			'errno'	=> 0,
			'data'	=> IUser::getBusinessList()
	);
}