<?php

require_once API_PATH . 'IUser.php';

IUser::init();
if(IUser::checkLogin() === false){
	return array('errno' => 500, 'msg' => '请重新登录');
}

//查询自己或者其他客服的待处理工单
function overtime_getuserunsolved(){
	global $_BIZ_CFG;
	$rtx = '';
	
	if($_REQUEST['kf']){
		if(IUser::$rtx === $_REQUEST['kf']){
			$rtx = IUser::$rtx;
		}else{
			if(IUser::$is_leader){
				$rtx = $_REQUEST['kf'];
			}
		}
	}else{
		if(IUser::$rtx){
			$rtx = IUser::$rtx;
		}
	}
	
	if($rtx === ''){
		return array('errno' => 0, 'data' => array());
	}
	
	$db = Config::getDB('b2b2c_kf_admin');
	
	$rows = $db->getRows('SELECT * FROM spf_assign_unsolved WHERE `assign_kf` = \'' .$rtx. '\';');
	
	if($rows){
		foreach($rows AS &$row){
			$row['source_str'] = $row['source'] == 1 ? "系统分单" : "转单";
			if($row['business'] == 'service'){
				$row['biz_name'] = '服务中心';
				$row['biz_type'] = $_BIZ_CFG[$row['business_type']];
			}
		}
	}
	
	return array('errno' => 0, 'data' => $rows);
}