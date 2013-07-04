<?php

/*
 * ninojiang
 * 2013-05-15
 */
 
require_once API_PATH . 'IUser.php';

class IGroup{
	/**
	 * 错误编码
	 */
	public static $errCode = 0;

	/**
	 * 错误消息
	 */
	public static $errMsg  = '';

	/**
	 * 清除错误标识，在每个函数调用前调用
	 */
	private static function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}
	
	//添加分组
	public static function addGroup($data){
		$db = Config::getDB('b2b2c_kf_admin');
		//$db->setCharset('UTF8');
		
		$ret = $db->insert('spf_groups', array(
				'name'			=> $data['name'],
				'leader_rtx'	=> $data['leader_rtx'],
				'creator_rtx'	=> $data['creator_rtx'],
				'create_time'	=> TIMESTAMP,
				'last_time'		=> TIMESTAMP
		));
		
		if($ret){
			$gid = $db->getInsertId();
			foreach($data['bids'] AS $bid){
				$db->insert('spf_group_biz', array('group_id' => $gid, 'biz_id' => $bid));
			}
			
			IUser::updateUserGroupLeader($data['leader_rtx']);
			
			return true;
		}
		return false;
	}
	
	//编辑分组
	public static function editGroup($gid, $data){
		$db = Config::getDB('b2b2c_kf_admin');
		//$db->setCharset('UTF8');
		$rows = $db->getRows('SELECT * FROM spf_groups WHERE `gid`='.$gid.';');
		if($rows[0]){			
			if($rows[0]['leader_rtx'] != ''){
				IUser::updateUserGroupLeader($rows[0]['leader_rtx']);
			}
			
			if($data['rtx'] != ''){
				IUser::updateUserGroupLeader($data['rtx']);
			}
			
			$db->execSql('UPDATE spf_groups SET `name` = \'' .$data['name'] . '\',`leader_rtx` = \'' .$data['rtx'] . '\', `last_time` = '.time().' WHERE `gid` ='.$gid.';');
			$db->execSql('DELETE FROM spf_group_biz WHERE `group_id`='.$gid.';');
			foreach($data['bids'] AS $bid){
				$db->insert('spf_group_biz', array('group_id' => $gid, 'biz_id' => $bid));
			}
			
			return true;
		}else{
			return false;
		}
	}
	//取到组长所对应的组以及业务
	public static function getGroup4Leader($username) {

		IUser::updateUserStatus();
		
		self::clearErr();
		$db = Config::getDB('b2b2c_kf_admin');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		
		$biz_list = IUser::getBusinessList();
		
		$list = array();
		$rows = $db->getRows("SELECT gid, name  FROM spf_groups WHERE leader_rtx='" . $username . "'");
		if(!empty($rows)){
			$group_biz = array();
			$gid_str = '';
			foreach($rows as $r) {
				$gid_str .= $r['gid'] . ",";
			}
			$gid_str = substr($gid_str, 0, -1);
			$bizs = $db->getRows('SELECT * FROM spf_group_biz where group_id in(' . $gid_str . ')');
			if($bizs){
				foreach($bizs AS $biz){
					if(!isset($group_biz[$biz['group_id']])){
						$group_biz[$biz['group_id']] = array('ids' => array(), 'names' => array());
					}
					
					if($biz_list[$biz['biz_id']]){
						$group_biz[$biz['group_id']]['ids'][] = $biz['biz_id'];
						$group_biz[$biz['group_id']]['names'][] = $biz_list[$biz['biz_id']];
					}
				}
			}
			
			foreach($rows AS $row){
				$row['biz_ids'] = $group_biz[$row['gid']] ? $group_biz[$row['gid']]['ids'] : array();
				$row['biz_names'] = $group_biz[$row['gid']] ? implode('、', $group_biz[$row['gid']]['names']) : '';
				$list[] = $row;
			}
		}
		
		return $list;
		
	}
	//取出所有分组
	public static function getGroupList(){
		
		self::clearErr();
		$db = Config::getDB('b2b2c_kf_admin');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		
		$biz_list = IUser::getBusinessList();
		
		$list = array();
		$rows = $db->getRows('SELECT * FROM spf_groups;');
		if($rows){
			$group_biz = array();
			$bizs = $db->getRows('SELECT * FROM spf_group_biz;');
			if($bizs){
				foreach($bizs AS $biz){
					if(!isset($group_biz[$biz['group_id']])){
						$group_biz[$biz['group_id']] = array('ids' => array(), 'names' => array());
					}
					
					if($biz_list[$biz['biz_id']]){
						$group_biz[$biz['group_id']]['ids'][] = $biz['biz_id'];
						$group_biz[$biz['group_id']]['names'][] = $biz_list[$biz['biz_id']];
					}
				}
			}
			
			foreach($rows AS $row){
				$row['biz_ids'] = $group_biz[$row['gid']] ? $group_biz[$row['gid']]['ids'] : array();
				$row['biz_names'] = $group_biz[$row['gid']] ? implode('、', $group_biz[$row['gid']]['names']) : '';
				
				$list[] = $row;
			}
		}
		
		return $list;
	}
	
	public static function findGroupById($gid) {
		$db = Config::getDB('b2b2c_kf_admin');
		$rows = $db->getRows('SELECT * FROM spf_groups WHERE `gid`='.$gid.';');
		if (!empty($rows)) {
			return $rows[0];
		} else {
			return false;
		}
	}
	
	public static function deleteGroupById($gid){
		$db = Config::getDB('b2b2c_kf_admin');
		//$db->setCharset('UTF8');
		
		$rows = $db->getRows('SELECT * FROM spf_groups WHERE `gid`='.$gid.';');
		if($rows[0]){
			IUser::updateUserGroupLeader($rows[0]['rtx']);
		}
		
		//删除用户分组关联
		$db->execSql('DELETE FROM spf_user_group WHERE `group_id` = ' .$gid);
		
		//删除分组业务关联
		$db->execSql('DELETE FROM spf_group_biz WHERE `group_id` = ' .$gid);
		
		//删除分组
		$db->execSql('DELETE FROM spf_groups WHERE `gid` = ' .$gid);
		
		return true;
	}
}