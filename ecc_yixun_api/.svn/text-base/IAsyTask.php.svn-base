<?php
Logger::init();
class IAsyTask
{
	public static $errCode = 0;
	public static $errMsg = '';
	
	//记录用户登录记录，同时同步用户经验值，积分等关键数据
	public static function userLogin($uid, $loginIP = '')
	{
		if ($uid < 0) {
			self::$errCode = 17;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[uid($uid) is invalid]";
			return false;
		}
		
		$ip = Config::getIP('asytask');
		if (null == $ip)
		{
			self::$errCode = 18;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[getip(asytask) failed]";
			return  false;
		}
		$addr = explode(":", $ip);
			
		$cmd = "cmd=100&uid=" . $uid . "&ip=" .$loginIP .  "\r\n";
		$rspStr = NetUtil::udpCmd($addr[0], $addr[1], $cmd, false, 1);
		if (false == $rspStr) {
			self::$errCode = 19;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[send package to asytask svr timeout]";
			return  false;
		}
		return true;
	}
	
	
	public static function purgeTTCData($ttcName, $key)
	{
		if ($ttcName == '') {
			self::$errCode = 16;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[ttcName($ttcName) is invalid]";
			return false;
		}
		if ($key == '') {
			self::$errCode = 17;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[key($key) is invalid]";
			return false;
		}
		$ip = Config::getIP('asytask');
		if (null == $ip)
		{
			self::$errCode = 18;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[getip(asytask) failed]";
			return  false;
		}
		$addr = explode(":", $ip);
			
		$cmd = "cmd=200&ttcname=" . $ttcName . "&ttckey=" .$key .  "\r\n";
		$rspStr = NetUtil::udpCmd($addr[0], $addr[1], $cmd, false, 1);
		Logger::info("cmd[".$cmd."]addr=[".print_r($addr, true)."]rspStr[".$rspStr."]");
		if (false == $rspStr) {
			self::$errCode = 19;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[send package to asytask svr timeout]";
			return  false;
		}
		return true;
	}
}

