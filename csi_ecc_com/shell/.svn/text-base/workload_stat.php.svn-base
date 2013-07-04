<?php
//定时统计
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
require ROOT_DIR . 'inc/service/constant_web.inc.php';

//stat type 1=>每日分类统计，2=>每日不满意统计 , 3=>每日总量统计,4=>投诉归档, 5=>工作量统计, 6=>今天实时统计
$current_time = time();
$db = Config::getDB('b2b2c_kf_stat');
if(!$db) {
	print "DB init error";
	die(0);
}
if (!empty($argv[1])) {
	$start_time = strtotime($argv[1]);
	$end_time = $start_time + 3600 * 24;
} else {
	$start_time = mktime(0, 0, 0, date("m")  , date("d") - 1, date("Y"));
	$end_time = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
}

$sql = "select followKF, count(*) as total from base_stat where source = 1 and followKF != '' and createTime>" . $start_time . " and createTime<" . $end_time . " group by followKF";
$ret = $db->getRows($sql);

$date_str = date("Y-m-d", $start_time);
$insert_sql = "insert into daily_stat values ";
$total = 0;
$total_kf = 0;
foreach($ret as $row) {
	if($row['total'] > 20) {
		$total += $row['total'];
		$total_kf += 1;
	}
	$insert_sql .= "(null, 5, '" . $date_str . "', '" . $row['followKF'].  "', " . $row['total'] . "),";
}
if ($total_kf > 0) {
	$insert_sql .= "(null, 5, '" . $date_str . "','average', " . $total/$total_kf . ")";
} else {
	$insert_sql .= "(null, 5, '" . $date_str . "','average', 0)";
}
$db->execSql($insert_sql);
