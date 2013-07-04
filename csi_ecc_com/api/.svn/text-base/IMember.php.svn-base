<?php

/*
 * 	ninojiang 2013-05-10
 */


class IMember{
	
	//取出所有成员
	public static function getMemberList(){
		$db = Config::getDB('b2b2c_kf_admin');
		//$db->setCharset('UTF8');
		
		$list = array();
		$rows = $db->getRows('SELECT * FROM spf_users;');
		if($rows){
			foreach($rows AS $row){
				$user_role = IRole::getUserRole($row['uid']);
				$list[] = array(
						'uid'		=> $row['uid'],
						'icson_id'	=> $row['icson_id'],
						'rtx_id'	=> $row['rtx_id'],
						'show_name'	=> $row['show_name'],
						'role_ids'	=> $user_role['role_ids'],
						'role'		=> $user_role['roles'],
						'create_time'	=> $row['create_time']
				);
			}
		}
		
		return $list;
	}
	
	//修改成员信息
	public static function editMember($uid, $data){
		$db = Config::getDB('b2b2c_kf_admin');
		//$db->setCharset('UTF8');
		
		$ret = $db->execSql('UPDATE spf_users SET `rtx_id` = \''.$data['rtx'] . '\', `show_name` =\'' . $data['name'] . '\' WHERE `uid` =' .$uid . ';');
		$db->execSql('DELETE FROM spf_user_role WHERE `user_id` = ' .$uid . ';');
		
		if($data['rids']){
			foreach($data['rids'] AS $rid){
				$db->execSql('INSERT INTO spf_user_role SET `user_id` = '.$uid .', `role_id` = '.$rid . ';');
			}
		}
		
	}
	
	/**
	 * 根据临时分组，查找到组内迁入的人
	 */
	 
	public static function getMemberByGroup($group_id){
		$db = Config::getDB('b2b2c_kf_admin');
		$filter = '';
		if (is_array($group_id)) {
			$filter = "in (" . implode(",", $group_id) . ")";
		} else {
			$filter = "= " . $group_id;
		}
		$list = array();
		$sql = 'SELECT u.uid,u.icson_id,u.rtx_id FROM spf_users u
								LEFT JOIN spf_user_group ug on u.uid=ug.user_id 
								WHERE ug.group_id ' . $filter;
		$rows = $db->getRows($sql);

		return $rows;
	}
	
}