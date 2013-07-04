<?php
//每日实时统计，各分类的处理情况
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
} else {
	$start_time = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
}
$stat_array = array();
foreach($_type_list as $k => $v) {
	$stat_array[1][$k] = 0;
	$stat_array[2][$k] = 0;
	$stat_array[3][$k] = 0;
}
$sql = "select type, state from base_stat where source = 1 and  createTime>" . $start_time ;
$ret = $db->getRows($sql);
if (!empty($ret)) {
	foreach($ret as $row) {
		$stat_array[$row['state']][$row['type']] += 1;
	}
}
$sql2 = "select avg(acceptTime-createTime) as at from base_stat where source=1 and state=3 and acceptTime>0 and createTime>" . $start_time ;
$res = $db->getRows($sql2);
$stat_array['acceptTime'] = $res[0]['at'];

$sql3 = "select avg(finishTime-createTime) as at from base_stat where source=1 and state=3 and finishTime>0 and createTime>" . $start_time ;
$res = $db->getRows($sql3);
$stat_array['dealTime'] = $res[0]['at'];

$sql3 = "select type, count(*) as total from base_stat where source=1 and ext3=1 and createTime>" . $start_time . " group by type";
$res1 = $db->getRows($sql3);
if (!empty($res1)) {
	$stat_array['expire'] = $res1;
}

$key = date("Hi");
$date_str = date("Y-m-d", $start_time);
$insert_sql = "insert into live_stat values ";
$value = json_encode($stat_array);
$insert_sql .= "(null, 'live_stat', '" . $date_str . "','" . $key . "', '" . $value ."')";
$db->execSql($insert_sql);
