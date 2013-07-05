<?php
class IIdGenerator4Order
{
	public static $errCode = 0;
	public static $errMsg = '';

	/**
	 * 获取全局ID
	 * @param string $bizName
	 * @param int $need
	 * @return 连续的ID，返回第一个，之后自增即可。
	 */
	public static function getNewId($uid, $bizName, $need=1, $time=0)
	{
		$index = rand(0, 1);
        $iPPort =  configcenter4_get_serv("ICSON_IDGenerator", 0, $uid);
        if($iPPort !== '0.0.0.0:0')
        {
            $ip = $iPPort;
        }
        else
        {
            Logger::info("IIdGenerator4Order get ip port failed from config_center!");

            $ip = Config::getIP('IDGenerator_' . $index);
            if (null == $ip)
            {
                self::$errCode = 18;
                self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[getip(IDGenerator) failed(bizName $bizName : {$ip} : IDGenerator_{$index}: uid : {$uid} : time $time)]";
                return  false;
            }
        }

		$addr = explode(":", $ip);
		$cmd = "cmd=100&bizid=" . $bizName . "&need=" .$need .  "\r\n";
        $time_start = microtime(true);
		$rspStr = NetUtil::tcpCmd($addr[0], $addr[1], $cmd, 1, 1);
        $time_end = microtime(true);
        $time_used = ($time_end - $time_start) * 1000;
		if (false == $rspStr || "" == $rspStr) {
			if ($time < 3)
			{
				Logger::info("generate sequence fail and try again (bizName $bizName : {$ip} : IDGenerator_{$index} : uid : {$uid} : time $time)");
				$time++;
				return self::getNewId($uid, $bizName, $need, $time);
			}
			else
			{
				self::$errCode = 19;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[IDGenerator svr timeout(bizName $bizName : {$ip} : IDGenerator_{$index} : uid : {$uid} : time $time)]";

                // 上报L5调用结果
                configcenter4_reportInfo("ICSON_IDGenerator", 0, $ip, -2/*调用超时*/, $time_used);

				return  false;
			}
		}

		$rspArr = array();
		parse_str($rspStr, $rspArr);
		if (!isset($rspArr['id'])) {
			self::$errCode = 20;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[IDGenerator failed(bizName $bizName : {$ip} : IDGenerator_{$index} : uid : {$uid} : time $time)" . $rspStr['errMsg'] . "]";
			return  false;
		}

        // 上报L5调用结果
        configcenter4_reportInfo("ICSON_IDGenerator", 0, $ip, 0, $time_used);

		//Logger::info("generate sequence success (bizName $bizName : {$ip} : IDGenerator_{$index} : time $time)");
		return intval($rspArr['id']);
	}
}