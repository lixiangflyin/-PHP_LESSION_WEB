<?php
//定时插入告警工单
error_reporting(E_ALL ^ E_NOTICE);

set_time_limit(60);
date_default_timezone_set('Asia/Shanghai');

$path_info = pathinfo(__FILE__);
$parent_dir = substr($path_info['dirname'], 0, strrpos($path_info['dirname'], DIRECTORY_SEPARATOR) + 1);
define('ROOT_DIR', $parent_dir);

define('LIB_PATH', ROOT_DIR . 'lib/');
define('API_PATH', ROOT_DIR . 'api/');
define('DAO_PATH', ROOT_DIR . 'dao/');

require_once LIB_PATH . 'Config.php';
require_once LIB_PATH . 'DB.php';
require_once LIB_PATH . 'Logger.php';

require ROOT_DIR . 'inc/constant_web.inc.php';

$current_time = time();

$db_admin = Config::getDB('b2b2c_kf_admin');
if(!$db_admin) {
	print "DB admin init error";die(0);
}
$sql = "select biz_id from spf_assign_unsolved";
$biz_array = $db_admin->getRows($sql);
$ids = array();
if (!empty($biz_array)) {
	foreach($biz_array as $b) {
		$ids [] = $b['biz_id'];
	}
}
if (empty($ids)) {
	die(0);
}

$db_web = Config::getDB('b2b2c_kf_web');
if(!$db_web) {
	print "DB web init error";
	die(0);
}
$sql = " select id,type,createTime,acceptTime,state,followKF from service_apply where id in(" . implode(",", $ids) . ")";

$ret = $db_web->getRows($sql);
if(empty($ret)) {
	die(0);
}
$alarm_ids = array();
$_type_list = array(
		'1' => "订单催办",
		'2' => "订单修改",
		'3' => "订单取消",
		'4' =>  "投诉建议",
		'5' =>  "问题咨询",
		'6' =>  "建议反馈",
		'7' =>  "表扬"
);
$alarm_config = array(
						'1' => array('accept' => 30*60, 'finish' => 50 * 60),
						'2' => array('accept' => 5*60, 'finish' => 20 * 60),
						'3' => array('accept' => 5*60, 'finish' => 20 * 60),
						'4' => array('accept' => 20*60, 'finish' => 11 * 60 * 60),
						'5' => array('accept' => 5*60,  'finish' => 20 * 60),
						'6' => array('accept' => 5*60, 'finish' => 20 * 60),
						'7' => array('accept' => 5*60, 'finish' => 20 * 60)
);
					
foreach($ret as $row) {
	if($row['state'] == 1 && ($current_time - $row['createTime'] > $alarm_config[$row['type']]['accept'])) {
		$alarm_ids[] = array('id' =>$row['id'], 'followKF' => $row['followKF'], 'alarm_type' => 1);
		continue;
	}
	if($row['state'] == 2 && ($current_time - $row['createTime'] > $alarm_config[$row['type']]['finish'])) {
		$alarm_ids[] = array('id' =>$row['id'], 'followKF' => $row['followKF'], 'alarm_type' => 2);
		continue;
	}
}

$db_admin2 = Config::getDB('b2b2c_kf_admin');
if (!empty($alarm_ids)) {
	foreach($alarm_ids as $aid) {
		$sql_count = "select count(*) as total from spf_assign_overtime where complaint_id=" . $aid['id'] . " and followKF = '" . $aid['followKF'] . "'";
		$count = $db_admin->getRows($sql_count);
		if($count[0]['total'] == 0) {
			$sql ="insert into spf_assign_overtime set complaint_id=" . $aid['id'] . ", followKF = '" . $aid['followKF'] . "',
		 	type = " . $aid['alarm_type'] . ", create_time=" . $current_time;
			$db_admin2->execSql($sql);
		}
		
	}
}


exit(0);






		

