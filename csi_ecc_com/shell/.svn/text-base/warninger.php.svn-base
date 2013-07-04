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
$expire_time = $current_time + 3600 * 2 ;

$db_web = Config::getDB('b2b2c_kf_web');
if(!$db_web) {
	print "DB web init error";
	die(0);
}

$sql = "select id,followKF,nextTime from service_apply where state!=3 and followKF != '' and createTime>" . ($current_time -30 * 24 * 3600) . 
	   " and nextTime >= " . $current_time . " and nextTime <= " . $expire_time;
$ret = $db_web->getRows($sql);

$sql2 = "select id,followKF from service_apply where state=2 and followKF != '' and createTime>" . ($current_time -30 * 24 * 3600) . 
	   " and modifyTime>" . (time() - 3600);
$ret2 = $db_web->getRows($sql);


$db_admin = Config::getDB('b2b2c_kf_admin');
if(!$db_admin) {
	print "DB admin init error";die(0);
}
if (!empty($ret)) {
	foreach($ret as $row) {
		$insert_sql = "INSERT INTO spf_messages(create_by,create_time,msg_type,msg_detail,target_user) values('system'," . time() . ",3,'"
		 . iconv("utf8", "gbk", '工单<a href="/index.php?biz=service&mod=deal&act=detail&id='. $row['id'] .'">' . $row['id'] ."</a>  预计" . 
		date("Y-m-d H:i:s", $row['nextTime']). " 受理") . "','" . $row['followKF'] . "')";
		$db_admin->execSql($insert_sql);
	}
}

if (!empty($ret2)) {
	foreach($ret2 as $row) {
		$insert_sql = "INSERT INTO spf_messages(create_by,create_time,msg_type,msg_detail,target_user) values('system'," . time() . ",4,'"
		 . iconv("utf8", "gbk", '工单<a href="/index.php?biz=service&mod=deal&act=detail&id='. $row['id'] .'">' . $row['id'] ."</a> 超过1小时未响应，请回复安抚用户 受理") . "','" . $row['followKF'] . "')";
		$db_admin->execSql($insert_sql);
	}
}

		

