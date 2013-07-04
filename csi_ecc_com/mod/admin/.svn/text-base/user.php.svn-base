<?php

require_once LIB_PATH . 'NetUtil.php';
require_once API_PATH . 'IUser.php';
require_once API_PATH . 'IGroup.php';
require_once DAO_PATH . 'service/IWorkflowDao.php';
require API_PATH . 'IAssign.php';


IUser::init();

function user_login(){
	//实际上没有登录过程
}

//签入
function user_signin(){
	if(IUser::$isLogin === false){
		return array('errno' => 500, 'msg' => '请重新登录');
	}
	
	$db = Config::getDB('b2b2c_kf_admin');
	//$db->setCharset('UTF8');
	
	//检查是否允许签入
	$rows = $db->getRows('SELECT a.`auth_id` FROM spf_user_role AS r LEFT JOIN spf_role_auth AS a ON r.role_id = a.role_id WHERE r.`user_id`=\''.IUser::$uid.'\';');
	if($rows){
		foreach($rows AS $row){
			$auth[] = intval($row['auth_id']);
		}
		if(!in_array(AUTH_SERVICE_REPLY, $auth)){
			return array('errno' => 1, 'msg' => '无回复权限的用户无法签入');
		}
	}else{
		return array('errno' => 1, 'msg' => '无角色用户无法签入');
	}

	$groups = IGroup::getGroupList();
	$gids = array();
	foreach($groups AS $group){
		$gids[] = intval($group['gid']);
	}
	
	if(!$_GET['gids']){
		return array('errno' => 1, 'msg' => '参数错误');
	}else{
		$find = false;
		$sgids = explode(',', $_GET['gids']);
		foreach($sgids AS $gid){
			$gid = intval($gid);
			if(!in_array($gid, $gids)){
				return array('errno' => 2, 'msg' => '签入分组参数错误');
			}else{
				$find = true;
			}
		}
		
		if($find){
			$db->execSql('DELETE FROM spf_user_group WHERE `user_id` = ' .IUser::$uid .';');
			$db->update('spf_users', array('is_working' => 1), '`uid`='.IUser::$uid);
			foreach($sgids AS $gid){
				$db->insert('spf_user_group', array(
						'user_id'	=> IUser::$uid,
						'group_id'	=> $gid
				));
			}
			
			//触发一次分单
			IAssign::Assign();
			//迁入工作流
			$workflow_data = array(
									'complaint_id' => 0,
									'create_time' => time(),
									'create_by'  => IUser::$rtx,
									'workflow_type' => 10,
									'workflow_detail' => '迁入'
			);
			IWorkflowDao::insert($workflow_data);
			return array('errno' => 0);
		}
	}
}

//签出
function user_signout(){
	if(IUser::$isLogin === false){
		return array('errno' => 500, 'msg' => '请重新登录');
	}
	$db = Config::getDB('b2b2c_kf_admin');
	//$db->setCharset('UTF8');
	$db->update('spf_users', array('is_working' => 0), '`uid`='. IUser::$uid);
	$db->execSql('DELETE FROM spf_user_group WHERE `user_id` =' .IUser::$uid);
	//迁出工作流
	$workflow_data = array(
							'complaint_id' => 0,
							'create_time' => time(),
							'create_by'  => IUser::$rtx,
							'workflow_type' => 11,
							'workflow_detail' => '迁出'
	);
	IWorkflowDao::insert($workflow_data);
	return array('errno' => 0);
}

function user_logout(){
	IUser::logout();
	header('Location: ' . WEB_ROOT_URL);
	exit();
}

function user_checklogin(){
	return IUser::checkLogin();
}

function user_setcookie(){
	$ticket = $_GET['session'];
	if($ticket){
		$soapResult_tmp = NetUtil::cURLHTTPGet(ICSON_LOGIN_API.'/session?format=json&SessionId='.$ticket);
		$ret = json_decode($soapResult_tmp, true);
		//var_dump($ret);
		if($ret['SessionId'] && $ret['AuthName']){
			setcookie('username', $ret['AuthName'], TIMESTAMP + 86400);
			setcookie('sid', $ret['SessionId'], TIMESTAMP + 86400);
			setcookie('hid', md5($ret['SessionId'] . COOKIE_SECURE_KEY . $ret['AuthName']), TIMESTAMP + 86400);
			setcookie('time', TIMESTAMP, TIMESTAMP + 86400);
			
			//header('Location: '.WEB_ROOT_URL.'page.php?menu=2&biz=admin&mod=user&act=home');
			header('Location: '.WEB_ROOT_URL.'page.php?menu=2&biz=service&mod=deal&act=unsolved');
		}else{
			exit('登录验证失败');
		}
		exit;
	}else{
		exit('参数错误');
	}
}

//获取用户信息，初始化左侧菜单
function user_getinfo(){
	//已等级系统的用户才会显示具体菜单
	$data = array();
	$data['uid'] = intval(IUser::$uid);
	$data['username'] = IUser::$rtx ? IUser::$rtx : IUser::$username;
	$data['rtx'] = IUser::$rtx;
	$data['is_working'] = IUser::$is_working;
	$data['is_leader'] = IUser::$is_leader;
	
	$auths = IUser::getAuth();
	$data['group_admin']	= in_array(AUTH_GROUP_ADMIN, $auths) ? true : false;
	$data['role_admin']		= in_array(AUTH_ROLE_ADMIN, $auths) ? true : false;
	$data['member_admin']	= in_array(AUTH_MEMBER_ADMIN, $auths) ? true : false;
	
	$data['groupstr'] = '无分组';

	$groups = IUser::getSignInGroups();
	$data['group'] = $groups;
	if($groups){
		$data['groupstr'] = '';
		foreach($groups AS $group){
			$data['groupstr'] .= $group['name'].' ';
		}
	}
	
	$data['assign_unsolved'] = 0;
	$data['unread_message_count'] = 0;
	$data['alarm_count'] = 0;
	if(IUser::$rtx){
		$db = Config::getDB('b2b2c_kf_admin');

		$rows = $db->getRows('SELECT * FROM spf_assign_unsolved WHERE `assign_kf` = \''. IUser::$rtx . '\';');
		$data['assign_unsolved'] = count($rows);
		
		$unread_message_count = $db->getRows('SELECT count(*) as total FROM spf_messages WHERE has_read = 0 and `target_user` = \''. IUser::$rtx . '\';');
		$data['unread_message_count'] = $unread_message_count[0]['total'];
		
		$alarm_count = $db->getRows('SELECT count(*) as total FROM spf_assign_overtime WHERE `followKF` = \''. IUser::$rtx . '\';');
		$data['alarm_count'] = $alarm_count[0]['total'];
	}
	
	return array(
		'errno'	=> 0,
		'data'	=> $data
	);
}

function user_getmyinfo(){
	$db = Config::getDB('b2b2c_kf_admin');
	//$db->setCharset('UTF8');
	
	$rows = $db->getRows('SELECT * FROM spf_users WHERE `uid` = '. IUser::$uid . ';');
	
	return array(
		'errno'	=> 0,
		'data'	=> $rows[0]
	);
}

function user_setmyinfo(){
	
	if(IUser::$isLogin === false){
		return array('errno' => 500, 'msg' => '请重新登录');
	}
	
	if(!$_REQUEST['rtx'] || !$_REQUEST['name']){
		return array('errno' => 1, 'msg' => '请填写完整');
	}
	
	$rtx = trim($_POST['rtx']);
	$name = trim($_REQUEST['name']);
	
	$db = Config::getDB('b2b2c_kf_admin');
	//$db->setCharset('UTF8');
	
	$rows = $db->getRows('SELECT * FROM spf_users WHERE `rtx_id` = \''. $rtx . '\' AND `uid` != '.IUser::$uid.';');
	if(count($rows) > 0){
		return array('errno' => 2, 'msg' => 'RTX已被使用');
	}
	
	$db->update('spf_users', array('rtx_id' => $rtx, 'show_name' => $name), '`uid`='.IUser::$uid);
	
	return array(
		'errno'	=> 0
	);
}