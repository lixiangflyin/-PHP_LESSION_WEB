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
$tm = Config::getTMem('service_statistic');
if (!$tm) {
	echo "tmem error";
}
$sql = "select id,account,followKF from service_apply where state!=3 and flag!=1 and createTime>" . (time() - 30 * 24 *3600);
$ret = $db_web->getRows($sql);
$ret_array = array();

if (!empty($ret)) {
	foreach($ret as $b) {
		$readCount = 0;
		$readCount = $tm->get(TMEM_BID_SERVICE_STATISTIC, $b['id'] . '_' . $b['account'] . "_view_count");
		if ($readCount >=3 ) {
			$sql = "update service_apply set flag = 1 where id=". $b['id'];
			$db_web->execSql($sql);
			$ret_array[] = $b;
			print $b['id'] . "\n";
		}
	}
}

$db = Config::getDB('b2b2c_kf_admin');
if(!$db) {
	print "DB web init error";
	die(0);
}
if (!empty($ret_array)) {
	foreach($ret_array as $row) {
		$sql= "INSERT INTO spf_workflows set complaint_id=".  $row['id'] . 
									",create_time=" . time() .
									",create_by= 'system'" .
									",workflow_type=8" .
									",workflow_detail='" . iconv("utf8", "gbk", "系统自动加急工单") . "'";
		$db->execSql($sql);
		if (!empty($row['followKF'])) {
			$sql= "INSERT INTO spf_messages set create_time=" . time() .
									",create_by='system'" .
									",msg_type=2" .
									", target_user='" . $row['followKF'] ."'" .
									",msg_detail='" . iconv("utf8", "gbk", '工单<a href="/index.php?biz=service&mod=deal&act=detail&id='. $row['id']  . '">' . $row['id'] ."</a> 被加急，系统自动催办") . "'";
			$db->execSql($sql);
		}
	}
}
exit(0);




		

