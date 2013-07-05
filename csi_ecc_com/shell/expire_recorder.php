<?php
//定时统计应follow的工单，一小时未结单的受理中的工单
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
require_once LIB_PATH . 'Logger.php';

require ROOT_DIR . 'inc/constant_web.inc.php';

$current_time = time();
$db_web = Config::getDB('b2b2c_kf_web');
if(!$db_web) {
	print "DB web init error";
	die(0);
}
$sql = "select id from service_apply where state=1 and createTime>=" . ($current_time -5 * 24 * 3600) . 
	   " and est_deal_time <= " . $current_time;
$ret = $db_web->getRows($sql);
$ids = array();
if (!empty($ret)) {
	foreach($ret as $b) {
		$ids [] = $b['id'];
	}
}
if (!empty($ids)) {
	$update_sql = "update service_apply set ext1=( 1 | ext1) where id in (" . implode(",", $ids) . ")";
	$db_web->execSql($update_sql);
}

//$sql = "select id from service_apply where state!=3 and createTime>=" . ($current_time -5 * 24 * 3600) . 
//	   " and est_comp_time <= " . $current_time;
$sql = "select id from service_apply where state=3 and createTime>=" . ($current_time -5 * 24 * 3600) . 
	   " and finishTime>est_comp_time";
echo $sql;
$ret = $db_web->getRows($sql);
$ids = array();
if (!empty($ret)) {
	foreach($ret as $b) {
		$ids [] = $b['id'];
	}
}
if (!empty($ids)) {
	$update_sql = "update service_apply set ext3=1 where id in (" . implode(",", $ids) . ")";
	$db_web->execSql($update_sql);
}
$db = Config::getDB('b2b2c_kf_stat');
if(!$db) {
	print "DB web init error";
	die(0);
}
if (!empty($ids)) {
	$update_sql = "update base_stat set ext3=1 where billNo in (" . implode(",", $ids) . ")";
	//print $update_sql;
	$db->execSql($update_sql);
}
exit(0);




		

