<?php

/*
 * 成员管理等
 * ninojiang
 */
 
require_once API_PATH . 'IUser.php';
require_once API_PATH . 'IRole.php';
require_once API_PATH . 'IMember.php';

IUser::init();
if(IUser::checkLogin() === false){
	return array('errno' => 500, 'msg' => '请重新登录');
}

function member_getroleinfo(){
	
	$db = Config::getDB('b2b2c_kf_admin');
	//$db->setCharset('UTF8');
	
	$roles = array();
	$rows = $db->getRows('SELECT `rid`, `name` FROM spf_roles;');
	if($rows){
		foreach($rows AS $row){
			$roles[$row['rid']] = array('name' => $row['name'], 'count' => 0);
		}
	}
	
	$uids = array();
	$rows = $db->getRows('SELECT `role_id`, `user_id` FROM spf_user_role;');
	if($rows){
		foreach($rows AS $row){
			$uids[$row['user_id']] = true;
			$roles[$row['role_id']]['count'] ++;
		}
	}
	$rows = $db->getRows('SELECT count(*) AS ct FROM spf_users;');
	$count = $rows[0]['ct'];
	
	return array(
			'errno'	=> 0,
			'data'	=> array(
						'roles'	=> $roles,
						'count'	=> $count
			)
	);
}


function member_getlist(){
	//所有的成员
	$list = IMember::getMemberList();
	
	//是否有查询关键字
	if($_REQUEST['query']){
		$s = trim($_REQUEST['query']);
		foreach($list AS $n => $item){
			if(!strstr($item['icson_id'], $s) && !strstr($item['rtx_id'], $s) && !strstr($item['show_name'], $s)){
				unset($list[$n]);
			}
		}
		sort($list);
	}
	
	//是否有查询角色
	if($_REQUEST['rid']){
		$rid = intval($_REQUEST['rid']);
		if($rid > 0){
			foreach($list AS $n => $item){
				if(!in_array($rid, $item['role_ids'])){
					unset($list[$n]);
				}
			}
			sort($list);
		}
	}
	
	$page = intval($_REQUEST['page']);
	$page = $page < 1 ? 1 : $page;
	$pagesize = 15;
	$offset = ($page - 1) * $pagesize;
	$count = count($list);
	
	$list = array_slice($list, $offset, $pagesize, false);
	
	return array(
			'errno'	=> 0,
			'data'	=> array(
						'total'	=> $count,
						'page'	=> $page,
						'list'	=> $list,
						'admin'	=> IUser::checkAuth(AUTH_MEMBER_ADMIN)
			)
	);
}

function member_modify(){
	$db = Config::getDB('b2b2c_kf_admin');
	
	if(!IUser::checkAuth(AUTH_MEMBER_ADMIN)){
		return array('errno' => 1, 'msg' => '权限不够');
	}
	
	if(!$_REQUEST['uid']){
		return array('errno' => 1, 'msg' => '用户ID不能为空');
	}
	$uid = $_REQUEST['uid'] + 0;
	
	$rtx = trim($_POST['rtx']);
	
	$rows = $db->getRows('SELECT * FROM spf_users WHERE `rtx_id` = \''. $rtx . '\' AND `uid` != '.$uid.';');
	if(count($rows) > 0){
		return array('errno' => 2, 'msg' => 'RTX已被使用');
	}
	
	$name = trim($_REQUEST['name']);
	$rids = explode(',', $_REQUEST['rids']);
	
	$data = array(
			'rtx'	=> $rtx,
			'name'	=> $name,
			'rids'	=> array()
	);

	if($rids){
		$allroles = array();
		$rows = $db->getRows('SELECT * FROM spf_roles;');
		if($rows){
			foreach($rows AS $row){
				$allroles[$row['rid']] = $row['name'];
			}
		}
		foreach($rids AS $rid){
			if($allroles[$rid]){
				$data['rids'][] = $rid;
			}
		}
	}
	
	IMember::editMember($uid, $data);
	
	return array('errno' => 0); 
}

function member_delete(){
	
	if(!IUser::checkAuth(AUTH_MEMBER_ADMIN)){
		return array('errno' => 1, 'msg' => '权限不够');
	}
	
	if(!$_REQUEST['uid']){
		return array('errno' => 1, 'msg' => '用户ID不能为空');
	}
	$uids = $_REQUEST['uid'];
	$uids = explode(',', $uids);
	
	if(in_array(IUser::$uid, $uids)){
		return array('errno' => 1, 'msg' => '不能删除自己');
	}
	
	$db = Config::getDB('b2b2c_kf_admin');
	//$db->setCharset('UTF8');
	
	foreach($uids AS $uid){
		//删除用户角色关联
		$db->execSql('DELETE FROM spf_user_role WHERE `user_id` = ' .$uid);
		
		//删除用户组关联
		$db->execSql('DELETE FROM spf_user_group WHERE `user_id` = ' .$uid);
		
		//删除角色
		$db->execSql('DELETE FROM spf_users WHERE `uid` = ' .$uid);
	}
	
	return array('errno' => 0); 
}