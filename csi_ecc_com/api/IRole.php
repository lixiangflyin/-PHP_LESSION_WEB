<?php

/*
 * 	ninojiang 2013-05-10
 */

class IRole{

	//添加角色
	public static function addRole($data){
		$db = Config::getDB('b2b2c_kf_admin');
		//$db->setCharset('UTF8');
		
		$ret = $db->insert('spf_roles', array(
				'name'			=> $data['name'],
				'creator_rtx'	=> $data['rtx'],
				'create_time'	=> TIMESTAMP,
				'last_time'		=> TIMESTAMP
		));
		
		if($ret){
			$rid = $db->getInsertId();
			foreach($data['auth'] AS $aid){
				$db->insert('spf_role_auth', array('role_id' => $rid, 'auth_id' => $aid));
			}
			
			return true;
		}
		return false;
	}
	
	//编辑角色
	public static function editRole($rid, $data){
		$db = Config::getDB('b2b2c_kf_admin');
		//$db->setCharset('UTF8');
		$rows = $db->getRows('SELECT * FROM spf_roles WHERE `rid`='.$rid.';');
		if($rows[0]){
			if($rows[0]['name'] != $data['name']){
				$db->execSql('UPDATE spf_roles SET `name` = \'' .$data['name'] . '\', `last_time` = '.time().' WHERE `rid` ='.$rid.';');
			}
			$db->execSql('DELETE FROM spf_role_auth WHERE `role_id`='.$rid.';');
			foreach($data['auth'] AS $aid){
				$db->insert('spf_role_auth', array('role_id' => $rid, 'auth_id' => $aid));
			}
			
			return true;
		}else{
			return false;
		}
	}
	
	//获取角色列表
	public static function getRoleList($showDetail = true){
		global $_AUTH_CFG;
		$roles = array();
		$auths = array();
		$auth_ids = array();
		
		$db = Config::getDB('b2b2c_kf_admin');
		//$db->setCharset('UTF8');
		
		$rows = $db->getRows('SELECT * FROM spf_role_auth;');
		if($rows){
			foreach($rows AS $row){
				if(!$auths[$row['role_id']]){
					$auths[$row['role_id']] = array();
				}
				$auths[$row['role_id']][] = $_AUTH_CFG[$row['auth_id']];
				
				if(!$auth_ids[$row['role_id']]){
					$auth_ids[$row['role_id']] = array();
				}
				$auth_ids[$row['role_id']][$row['auth_id']] = true;
			}
		}
		
		$rows = $db->getRows('SELECT * FROM spf_roles;');
		if($rows){
			foreach($rows AS $row){
				if($showDetail){
					$roles[] = array(
							'rid'			=> $row['rid'],
							'name'			=> $row['name'],
							'auth_ids'		=> $auth_ids[$row['rid']] ? $auth_ids[$row['rid']] : array(),
							'auths'			=> $auths[$row['rid']] ? implode('、 ', $auths[$row['rid']]) : '',
							'creator'		=> $row['creator_rtx'],
							'create_time'	=> $row['create_time'],
							'last_time'		=> $row['last_time']
					);
				}else{
					$roles[] = array(
							'rid'			=> $row['rid'],
							'name'			=> $row['name'],
							'auth_ids'		=> $auth_ids[$row['rid']],
							'auths'			=> $auths[$row['rid']] ? implode('、 ', $auths[$row['rid']]) : ''
					);
				}
			}
		}
		
		return $roles;
	}
	
	//获取用户角色名
	public static function getUserRole($uid){
		$roles = self::getRoleList(false);
		
		$db = Config::getDB('b2b2c_kf_admin');
		//$db->setCharset('UTF8');
		
		$userRoles = array();
		$userRoleIds = array();
		$rows = $db->getRows('SELECT `role_id` FROM spf_user_role WHERE `user_id` = '. $uid .';');

		if($rows){
			foreach($rows AS $row){
				foreach($roles AS $role){
					if($role['rid'] == $row['role_id']){
						$userRoles[] = $role['name'];
						$userRoleIds[] = $role['rid'];
						break;
					}
				}
			}
		}
		
		return array('role_ids' => $userRoleIds, 'roles' => implode('、', $userRoles));
	}
	
	//删除角色
	public static function deleteRoleById($rid){
		$db = Config::getDB('b2b2c_kf_admin');
		//$db->setCharset('UTF8');
		
		//删除用户角色关联
		$db->execSql('DELETE FROM spf_user_role WHERE `role_id` = ' .$rid);
		
		//删除角色权限关联
		$db->execSql('DELETE FROM spf_role_auth WHERE `role_id` = ' .$rid);
		
		//删除角色
		$db->execSql('DELETE FROM spf_roles WHERE `rid` = ' .$rid);
		
		return true;
	}
}	