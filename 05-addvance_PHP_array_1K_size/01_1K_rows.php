<?php
/**
此程序模拟从数据库读取1000条数据所占用的内存空间
1000条数据 约占用 4MB 内存空间 

数组array存放时: 
object stdClass存放时: 4352KB

10K 条数据:
array: 38MB
object: 41MB

object比array占更大内存,因为object的功能比array的复杂
 */
define('TIME', 10000);
echo memory_get_usage(true)/1024,"KB\r\n";

/* $service_apply = (object)array (
		'id' => 1,
		'source' => 1,
		'biz' => 1,
		'siteId' => 1,
		'type' => 3,
		'orderNo' => 30063663,
		'account' => 2000633,
		'userType' => 1,
		'userName' => 'test',
		'userPhone' => '13719125344',
		'isVip' => 0,
		'optTeam' => 5,
		'creator' => 2000633,
		'followKF' => 'ianmeng',
		'censor' => 'ianmeng',
		'state' => 3,
		'flag' => 1,
		'approve' => 1,
		'checkup' => 2,
		'archive' => 'sadfdsafdsfsadf',
		'createTime' => 1368080532,
		'acceptTime' => 1368080535,
		'nextTime' => 1369884102,
		'finishTime' => 1369884938,
		'checkupTime' => 1370433695,
		'modifyTime' => 1370433695,
		'dealTime' => 1804403,
		'title' => 'sdfsdfds',
		'content' => 'sdfdsfdsfdsfsfsfdsfdsf',
		'attachment' => 'http://i1.sinaimg.cn/ent/2013/0514/U8551P28DT20130514231500.jpg,http://i2.sinaimg.cn/ent/s/u/2013-05-15/U2398P28T3D3920807F326DT20130515093935.jpg',
		'unsati_detail' => 'ÎÒ¾ÍÊÇ²»ÂúÒâ°¡Õ¦µÄÁË°¡',
		'est_comp_time' => 1368085535,
		'file_kf' => 'ianmeng',
		'file_time' => 1370433695,
		'hasReply' => 0,
		'ext1' => 1,
		'ext3' => 1 
);  */

function rand_str($len){
	$str = '';
	
	while ($len--){
		$str .= chr(mt_rand(65, 90));
	}
	return $str;
}

$s = rand_str(3);

$rows = array();
for($i=0; $i<TIME; $i++){
	$rows[] = array(
		'id' => rand(0, 9999999),
		'source' => rand(0, 3),
		'biz' => rand(0, 3),
		'siteId' => rand(0, 9999999),
		'type' => rand(0, 10),
		'orderNo' => rand(0, 9999999),
		'account' => rand(0, 9999999),
		'userType' => rand(0, 2),
		'userName' => rand_str(8),
		'userPhone' => rand_str(11),
		'isVip' => mt_rand(0, 1),
		'optTeam' => mt_rand(0, 10),
		'creator' => mt_rand(0, 999999),
		'followKF' => rand_str(8),
		'censor' => rand_str(6),
		'state' => mt_rand(0, 3),
		'flag' => mt_rand(0, 1),
		'approve' => mt_rand(0, 1),
		'checkup' => mt_rand(0, 3),
		'archive' => rand_str(8),
		'createTime' => rand(0, 9999999),
		'acceptTime' => rand(0, 9999999),
		'nextTime' => rand(0, 9999999),
		'finishTime' => rand(0, 9999999),
		'checkupTime' => rand(0, 9999999),
		'modifyTime' => rand(0, 9999999),
		'dealTime' => rand(0, 9999999),
		'title' => rand_str(15),
		'content' => rand_str(20),
		'attachment' => rand_str(50),
		'unsati_detail' => rand_str(20),
		'est_comp_time' => rand(0, 9999999),
		'file_kf' => rand_str(15),
		'file_time' => rand(0, 9999999),
		'hasReply' => mt_rand(0, 1),
		'ext1' => mt_rand(0, 1),
		'ext3' => mt_rand(0, 1)
	);
}
//$rows = (object)$rows;
echo memory_get_usage(true)/1024,"KB\r\n";
echo memory_get_peak_usage(true)/1024,"KB\r\n";

//xdebug_debug_zval('rows');