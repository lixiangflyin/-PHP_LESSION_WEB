<?php
//定时统计
error_reporting(E_ALL ^ E_NOTICE);

set_time_limit(120);
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

//stat type 1=>每日分类统计，2=>每日不满意统计 , 3=>每日总量统计,4=>投诉归档, 8=>咨询归档 , 5=>工作量统计, 6=>今天统计， 7=>结单状态统计
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
//每日分类统计，总和计算
$sql = "select type, count(*) as total from base_stat where source = 1 and createTime>" . $start_time . " and createTime<" . $end_time . " group by type";
$ret = $db->getRows($sql);
$stat_array = array();
foreach($_type_list as $k => $v) {
	$stat_array[$k] = 0;
}
if (!empty($ret)) {
	foreach($ret as $row) {
		$stat_array[$row['type']] = $row['total'];
	}
}
$date_str = date("Y-m-d", $start_time);
$insert_sql = "insert into daily_stat values ";
$total = 0;
foreach($stat_array as $k => $v) {
	$total += $v;
	$insert_sql .= "(null, 1, '" . $date_str . "', '" . $k.  "', " . $v . "),";
}
$insert_sql .= "(null, 3, '" . $date_str . "','total', " . $total . ")";
$db->execSql($insert_sql);

$sql2 = "select type, count(*) as total from base_stat where source = 1 and approve=2 and createTime>" . $start_time . " and createTime<" . $end_time . " group by type";
$ret2 = $db->getRows($sql2);
$stat_array2 = array();
foreach($_type_list as $k => $v) {
	$stat_array2[$k] = 0;
}
$approve_total = 0;
if (!empty($ret2)) {
	foreach($ret2 as $row) {
		$stat_array2[$row['type']] = $row['total'];
		$approve_total += $row['total'];
	}
}

$insert_sql2 = "insert into daily_stat values ";
foreach($stat_array2 as $k => $v) {
	$insert_sql2 .= "(null, 2, '" . $date_str . "', '" . $k.  "', " . $v . "),";
}

//$insert_sql2= substr($insert_sql2, 0, -1);
if ($total > 0) {
	$insert_sql2 .= "(null, 2, '" . $date_str . "','unapprove_precent', " . round($approve_total / $total, 2) * 100 . ")";
	$db->execSql($insert_sql2);
}

$sql3 = "select archive, count(*) as total from base_stat where source = 1 and state=3 and type=4 and createTime>" . $start_time . " and createTime<" . $end_time . " group by archive";
$ret3 = $db->getRows($sql3);
$stat_array3 = array();
foreach($_ARCHIVE_LIST as $k => $v) {
	if ($k > 1000) {
		$stat_array3[$k] = 0;
	}
}
if (!empty($ret3)) {
	foreach($ret3 as $row) {
		$temp = explode(":", $row['archive']);
		if (!empty($temp[1])) {
			$stat_array3[$temp[1]] = $row['total'];
		}
	}
}
$insert_sql3 = "insert into daily_stat values ";
foreach($stat_array3 as $k => $v) {
	$insert_sql3 .= "(null, 4, '" . $date_str . "', '" . $k.  "', " . $v . "),";
}

$insert_sql3= substr($insert_sql3, 0, -1);

$db->execSql($insert_sql3);

$sql3_1 = "select archive, count(*) as total from base_stat where source = 1 and state=3 and type=5 and createTime>" . $start_time . " and createTime<" . $end_time . " group by archive";
$ret3_1 = $db->getRows($sql3_1);
$stat_array3_1 = array();
foreach($_ARCHIVE_LIST as $k => $v) {
	if ($k > 1000) {
		$stat_array3_1[$k] = 0;
	}
}
if (!empty($ret3_1)) {
	foreach($ret3_1 as $row) {
		$temp = explode(":", $row['archive']);
		if (!empty($temp[1])) {
			$stat_array3_1[$temp[1]] = $row['total'];
		}
	}
}
$insert_sql3_1 = "insert into daily_stat values ";
foreach($stat_array3_1 as $k => $v) {
	$insert_sql3_1 .= "(null, 8, '" . $date_str . "', '" . $k.  "', " . $v . "),";
}

$insert_sql3_1= substr($insert_sql3_1, 0, -1);

$db->execSql($insert_sql3_1);

$sql4 = "select state, count(*) as total from base_stat where source = 1 and createTime>" . $start_time . " and createTime<" . $end_time . " group by state";
$ret4 = $db->getRows($sql4);
if (!empty($ret4)) {
$insert_sql4 = "insert into daily_stat values ";
foreach($ret4 as $row) {
	$insert_sql4 .= "(null, 7, '" . $date_str . "', '" . $row['state'].  "', " . $row['total'] . "),";
}
$insert_sql4 = substr($insert_sql4, 0, -1);
$db->execSql($insert_sql4);
}
exit(0);




		

