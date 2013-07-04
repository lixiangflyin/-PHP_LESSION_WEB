<?php

/*
 * 角色管理等
 * ninojiang 2013-05-10
 */

require_once API_PATH . 'IUser.php';
require_once API_PATH . 'IRole.php';

IUser::init();
if(IUser::checkLogin() === false){
	return array('errno' => 500, 'msg' => '请重新登录');
}

//添加角色
function role_add(){
	global $_AUTH_CFG;
	
	if(!IUser::checkAuth(AUTH_ROLE_ADMIN)){
		return array('errno' => 1, 'msg' => '权限不够');
	}
	
	$data = array();
	if(!$_REQUEST['name']){
		return array('errno' => 1, 'msg' => '角色名不能为空');
	}
	$data['name'] = $_REQUEST['name'];
	
	if(strlen($data['name']) > 150){
		return array('errno' => 1, 'msg' => '角色名长度过长');
	}
	
	if(IUser::$rtx === ''){
		return array('errno' => 2, 'msg' => '您尚未设置RTX名');
	}
	$data['rtx'] = IUser::$rtx;

	
	$data['auth'] = array();
	if($_REQUEST['auth']){
		$tmp = explode(',', $_REQUEST['auth']);
		foreach($tmp AS $aid){
			$aid = intval($aid);
			if($_AUTH_CFG[$aid]){
				$data['auth'][] = $aid;
			}
		}
	}
	
	$ret = IRole::addRole($data);
	
	if($ret){
		return array('errno' => 0);
	}
}

//删除角色
function role_delete(){
	
	if(!IUser::checkAuth(AUTH_ROLE_ADMIN)){
		return array('errno' => 1, 'msg' => '权限不够');
	}
	
	if(!$_REQUEST['rid']){
		return array('errno' => 1, 'msg' => '角色ID不能为空');
	}
	$rid = $_REQUEST['rid'] + 0;
	
	IRole::deleteRoleById($rid);
	
	return array('errno' => 0); 
}

//修改角色
function role_modify(){
	global $_AUTH_CFG;
	
	if(!IUser::checkAuth(AUTH_ROLE_ADMIN)){
		return array('errno' => 1, 'msg' => '权限不够');
	}
	
	$data = array();
	if(!$_REQUEST['name']){
		return array('errno' => 1, 'msg' => '角色名不能为空');
	}
	
	$data['name'] = $_REQUEST['name'];
	
	if(strlen($data['name']) > 150){
		return array('errno' => 1, 'msg' => '角色名长度过长');
	}
	
	if(!$_REQUEST['role_id']){
		return array('errno' => 2, 'msg' => '角色ID不能为空');
	}
	$rid = $_REQUEST['role_id'] + 0;
	
	$data['auth'] = array();
	if($_REQUEST['auth']){
		$tmp = explode(',', $_REQUEST['auth']);
		foreach($tmp AS $aid){
			$aid = intval($aid);
			if($_AUTH_CFG[$aid]){
				$data['auth'][] = $aid;
			}
		}
	}
	
	$data['uid'] = IUser::$uid;
	
	$ret = IRole::editRole($rid, $data);
	
	if($ret){
		return array('errno' => 0);
	}
}

//角色列表
function role_getlist(){
	$page = intval($_REQUEST['page']);
	$page = $page < 1 ? 1 : $page;

	$list = IRole::getRoleList();
	$count = count($list);
		
	return array(
		'errno'	=> 0,
		'data'	=> array(
				'total'	=> $count,
				'list'	=> $list,
				'admin'	=> IUser::checkAuth(AUTH_ROLE_ADMIN)
		)
	); 
}

//权限列表
function role_getauthlist(){
	global $_AUTH_CFG;
	return array(
			'errno'	=> 0,
			'data'	=> $_AUTH_CFG
	);
}