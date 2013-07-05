<?php
/*
 * Author:hedyhe
 * Date:2013-01-17
 * 用于用户对自己2012年历史数据的查询在这里对ttc中数据进行查询，用于20120年终活动数据呈现
 * */
if (!defined("PHPLIB_ROOT")) {
	define('PHPLIB_ROOT', '/data/release/PHPLIB/');
}
require_once(PHPLIB_ROOT . "lib/Config.php");

class IUserPrizeInfo
{
	public static $errCode = 0;
	public static $errMsg = '';

	
	public static function getMedal($class3list) {
		if(count($class3list) == 0) {
			self::$errCode = -1;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "class3list is invalid";
			return false;
		}
		$MedalList = array (  '最感性纪录奖勋章' => 2,
							  '最马路骑士勋章'   => 3,
							  '最品质精英勋章'	 => 4,
							  '最生活达人勋章'	 => 5,
							  '最有爱心勋章奖'	 => 6,
							  '最通勤一族勋章'	 =>	7,
							  '最新潮玩家勋章'	 => 8,
							  '最贴心易粉勋章'	 => 9);
		$medal = '最贴心易粉勋章';
		foreach($class3list as $class3) {	
			$medaltemp = IUserPrizeInfoTTC::get($class3*1);
			//var_dump($class3);
			//var_dump($medaltemp);
			if (false == $medaltemp)
			{
				continue;
			} else {
				//var_dump($medaltemp);
				//trim()
				if($MedalList[trim($medaltemp[0]['prize_name'])] == 2) {
					$medal = trim($medaltemp[0]['prize_name']);
					break;
				} else {
					if($MedalList[trim($medaltemp[0]['prize_name'])] < $MedalList[$medal]) {
						
						$medal = trim($medaltemp[0]['prize_name']);
					}
				}
			}
			//var_dump($medal);
		}
		return $medal;
	}
	
}