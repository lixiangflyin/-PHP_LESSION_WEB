<?php
class IIdGenerator
{
	public static $errCode = 0;
	public static $errMsg = '';

	/**
	 * 获取全局ID
	 * @param string $bizName
	 * @param int $need
	 * @return 连续的ID，返回第一个，之后自增即可。
	 */
	public static function getNewId($bizName, $need=1, $time=0)
	{
		$index = rand(0, 1);
		$ip = Config::getIP('IDGenerator_' . $index);
		if (null == $ip)
		{
			self::$errCode = 18;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[getip(IDGenerator) failed(bizName $bizName : {$ip} : IDGenerator_{$index} : time $time)]";
			return  false;
		}

		$addr = explode(":", $ip);
		$cmd = "cmd=100&bizid=" . $bizName . "&need=" .$need .  "\r\n";
		$rspStr = NetUtil::tcpCmd($addr[0], $addr[1], $cmd, 1, 1);
		if (false == $rspStr || "" == $rspStr) {
			if ($time < 3)
			{
				Logger::info("generate sequence fail and try again (bizName $bizName : {$ip} : IDGenerator_{$index} : time $time)");
				$time++;
				return self::getNewId($bizName, $need, $time);
			}
			else
			{
				self::$errCode = 19;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[IDGenerator svr timeout(bizName $bizName : {$ip} : IDGenerator_{$index} : time $time)]";

				return  false;
			}
		}

		$rspArr = array();
		parse_str($rspStr, $rspArr);
		if (!isset($rspArr['id'])) {
			self::$errCode = 20;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[IDGenerator failed(bizName $bizName : {$ip} : IDGenerator_{$index} : time $time)" . $rspStr['errMsg'] . "]";
			return  false;
		}

		//Logger::info("generate sequence success (bizName $bizName : {$ip} : IDGenerator_{$index} : time $time)");
		return intval($rspArr['id']);
	}
}