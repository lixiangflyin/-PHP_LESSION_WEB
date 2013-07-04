<?php

/*
 * 	ninojiang 2013-05-08
 */

class IUser{
	
	public static $isLogin		= false;
	public static $username		= '';
	public static $uid			= 0;
	public static $rtx			= '';
	public static $showname		= '';
	public static $is_working 	= false;
	public static $is_leader	= false;
	
	public static function init(){
		self::checkLogin();
		if(self::$isLogin){
			$db = Config::getDB('b2b2c_kf_admin');
			//$db->setCharset('UTF8');
			$rows = $db->getRows('SELECT * FROM spf_users WHERE `icson_id`=\''.self::$username.'\';');
			if($rows[0]){
				//先检查最后活动时间
				/*
				if(TIMESTAMP - $rows[0]['last_time'] > KF_NOT_ACTIVE_TIME){
					self::logout();
					self::loginRedirect();
					return;
				}*/
				self::$uid = $rows[0]['uid'];
				self::$rtx = $rows[0]['rtx_id'];
				self::$showname = $rows[0]['show_name'];
				self::$is_working = $rows[0]['is_working'] == 1 ? true : false;
				self::$is_leader = $rows[0]['is_group_leader'] == 1 ? true : false;
				
				if(self::$rtx){
					setcookie('rtx', self::$rtx, time() + 86400);
				}
				
				$db->execSql('UPDATE spf_users SET `last_time` = ' .TIMESTAMP. ' WHERE `uid` = ' .self::$uid .';');
			}else{
				$ret = $db->insert('spf_users', array(
						'icson_id'		=> self::$username,
						'create_time'	=> TIMESTAMP,
						'last_time'		=> TIMESTAMP
				));
				if($ret){
					self::$uid = $db->getInsertId();
					self::$is_working = false;
				}
			}
			//$db->closeDB();
		}
	}
	
	public static function checkLogin(){
		if(isset($_COOKIE['username']) && isset($_COOKIE['sid']) && isset($_COOKIE['hid']) && isset($_COOKIE['time'])) {
	        $user	= $_COOKIE['username'];
	        $sid	= $_COOKIE['sid'];
			$hid	= $_COOKIE['hid'];
			$time	= $_COOKIE['time'];
	    } else {
	        self::logout();
	        return false;
	    }
		
		self::$username = $user;
		
		if(TIMESTAMP - $time < KF_NOT_ACTIVE_TIME && $hid === md5($sid . COOKIE_SECURE_KEY . $user)){
			setcookie('time', TIMESTAMP, TIMESTAMP + 86400);
			self::$isLogin	= true;
			self::$username	= $user;
			return true;
		}else{
			self::logout();
	        return false;
		}
		
		return false;
	}
	
	//用户签入的组
	public static function getSignInGroups(){
		$db = Config::getDB('b2b2c_kf_admin');
		//$db->setCharset('UTF8');

		$groups = array();
		if(self::$is_working){
			$rows = $db->getRows('SELECT g.gid, g.name FROM spf_user_group AS u LEFT JOIN spf_groups AS g ON u.group_id = g.gid WHERE u.`user_id`=\''.self::$uid.'\';');
			if($rows){
				foreach($rows AS $row){
					$groups[] = array(
							'gid'	=> intval($row['gid']),
							'name'	=> $row['name']
					);
				}
			}
		}
		
		return $groups;
	}
	
	//检查用户是否是组长
	public static function updateUserGroupLeader($rtx){
		$db = Config::getDB('b2b2c_kf_admin');
		//$db->setCharset('UTF8');
		
		$rows = $db->getRows('SELECT `gid` FROM spf_groups WHERE `leader_rtx` = \'' .$rtx . '\' LIMIT 1;');

		if($rows[0]){
			$db->execSql('UPDATE spf_users SET `is_group_leader`=1 WHERE `rtx_id` = \'' .$rtx . '\';');
		}else{
			$db->execSql('UPDATE spf_users SET `is_group_leader`=0 WHERE `rtx_id` = \'' .$rtx . '\';');
		}
	}
	
	public static function getAuth(){
		global $_ADMIN_CFG, $_AUTH_CFG;
		$auth = array();

		if(in_array(self::$username, $_ADMIN_CFG)){
			foreach($_AUTH_CFG AS $key => $val){
				$auth[] = $key;
			}
			return $auth;
		}
		
		$db = Config::getDB('b2b2c_kf_admin');
		//$db->setCharset('UTF8');
		$rows = $db->getRows('SELECT a.`auth_id` FROM spf_user_role AS r LEFT JOIN spf_role_auth AS a ON r.role_id = a.role_id WHERE r.`user_id`=\''.self::$uid.'\';');
		if($rows){
			foreach($rows AS $row){
				$auth[] = intval($row['auth_id']);
			}
		}
		
		return $auth;
	}
	
	public static function checkAuth($key){
		global $_AUTH_CFG;
	
		if(!$_AUTH_CFG[$key]){
			return false;
		}
		
		$auth = self::getAuth();
		if(in_array($key, $auth)){
			return true;
		}
		
		return false;
	}
	
	//退出
	public static function logout(){
		if(self::$uid){
			$db = Config::getDB('b2b2c_kf_admin');
			$db->execSql('UPDATE spf_users SET `is_working` = 0 WHERE `uid` = ' .self::$uid .';');
			$db->execSql('DELETE FROM spf_user_group WHERE `user_id` = ' .self::$uid .';');
		}else if(self::$username){
			$db = Config::getDB('b2b2c_kf_admin');
			$db->execSql('UPDATE spf_users SET `is_working` = 0 WHERE `icson_id` = \'' .self::$username .'\';');
		}
		
		self::$isLogin = false;
		self::$uid = 0;
		self::$username = '';
		setcookie('username', '', time() - 1);
	    setcookie('sid', '', time() - 1);
	    setcookie('hid', '', time() - 1);
		setcookie('time', '', time() - 1);
				
		return true;
	}
	
	//登录跳转
	public static function loginRedirect(){
		$url = WEB_ROOT_URL . 'json.php?biz=admin&mod=user&act=setcookie';
		$loginUrl = ICSON_LOGIN_WEB . urlencode($url);
		header('Location: ' . $loginUrl);
		exit();
	}
	
	//校验rtx合法性
	public static function checkRtxValidity($rtx){
		
		
		return true;
	}
	
	//检查rtx是否存在当前库
	public static function checkRtxUserExist($rtx){
		$db = Config::getDB('b2b2c_kf_admin');
		//$db->setCharset('UTF8');
		$rows = $db->getRows('SELECT `uid` FROM spf_users WHERE `rtx_id` = \'' . $rtx . '\' LIMIT 1;');
		if($rows[0]){
			return true;
		}
		return false;
	}
	
	public static function getUserNameByUID($uid){
		$db = Config::getDB('b2b2c_kf_admin');
		//$db->setCharset('UTF8');
		$rows = $db->getRows('SELECT `rtx_id`, `show_name`, `icson_id` FROM spf_users WHERE `uid` = ' . $uid . ';');
		if($rows[0]){
			return $rows[0]['show_name'] ? $rows[0]['show_name'] : ($rows[0]['rtx_id'] ? $rows[0]['rtx_id'] : $rows[0]['icson_id']);
		}
		return '';
	}
	
	
	public static function getUserGroupByUID(){
		
	}
	
	//根据子类生成业务类型
	public static function getBusinessList(){
		global $_BIZ_CFG, $_SERVICE_SUBTYPE;
		
		$list = array();
		foreach($_BIZ_CFG AS $id => $name){
			if(count($_SERVICE_SUBTYPE[$id]) > 0){
				foreach($_SERVICE_SUBTYPE[$id] AS $subid => $subname){
					$list[$id * 10000 + $subid] = $name.'-'.$subname;
				}
			}else{
				$list[$id * 10000] = $name;
			}
		}
		
		return $list;
	}
	
	//更新员工签入状态
	public static function updateUserStatus(){
		$last_active_time = time() - KF_NOT_ACTIVE_TIME;
		
		$db = Config::getDB('b2b2c_kf_admin');
		//$db->setCharset('UTF8');
		
		$rows = $db->getRows('SELECT `uid` FROM spf_users WHERE `last_time` < ' . $last_active_time . ' AND `is_working` = 1;');
		if($rows){
			$uids = array();
			foreach($rows AS $row){
				$uids[] = $row['uid'];
			}
			
			$where = implode(',', $uids);
			$db->execSql('DELETE FROM spf_user_group WHERE `user_id` IN (' . $where .');');
			$db->execSql('UPDATE spf_users SET `is_working` = 0 WHERE `uid` IN (' . $where .');');
		}
	}
}