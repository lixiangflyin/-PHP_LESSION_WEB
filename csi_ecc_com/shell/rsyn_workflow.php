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
$db_web = Config::getDB('b2b2c_kf_web');
if(!$db_web) {
	print "DB web init error";
	die(0);
}
$sql = "select complaint_id, time_reply,replyer_id,content from service_reply where replyer_type=2 and time_reply > " . ($current_time - 60);
$ret = $db_web->getRows($sql);
if(empty($ret)) {
	die(0);
}				

$db_admin = Config::getDB('b2b2c_kf_admin');
if(!$db_admin) {
	print "DB admin init error";die(0);
}

foreach($ret as $row) {
	$sql = "insert into spf_workflows set workflow_type=3,complaint_id=" . $row['complaint_id'] . "," .
			"create_time=" . $row['time_reply'] . ", create_by=" . $row['replyer_id'] . ", workflow_detail='" . addslashes($row['content'])
			. "'";
	//print $row['complaint_id'] . "\n";
	$db_admin->execSql($sql);
}
exit(0);






		

