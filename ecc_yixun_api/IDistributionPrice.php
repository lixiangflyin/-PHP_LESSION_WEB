<?php
class IDistributionPrice
{
	public static $errMsg='';
	public static $errCode=0; 
	
	/*  查找多个商品的价格
		输入信息 $userData array 用户信息
				 $wh_id    int   分仓id
		$userData = array(
			'uid' => 30562663,
            'utype'=> 22,
            'pids' => array(2353,2234)
		); 
		返回信息 正确 errCode 为0 ，错误不为0
		array(
				'34577' => price,
				
				'66969' => price
				
			); 
	*/	
	public static function getPriceForProducts($userData, $wh_id = 1)
	{
		if(!is_array($userData))
		{
			self::$errCode = 20;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[para userData error]";		
			return  false;
		}
		if(!isset($userData['uid']) || $userData['uid'] <= 0)
		{
			self::$errCode = 20;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[para userData[uid] error]"; 
			return  false;		
		}	
		if(!isset($userData['utype']) || $userData['utype'] <= 0)
		{
			self::$errCode = 20;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[para userData[utype] error]"; 
			return  false;		
		}
		if(!isset($userData['pids']) || !is_array($userData['pids']))
        {
            self::$errCode = 20;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[para userData[pids] error]"; 
            return  false;      
        }   	 
		//TODO pids需要做长度限制

	    $ip = Config::getIP('RetailerMultiPrice');
        if (null == $ip) {
            self::$errCode = Config::$errCode;
            self::$errMsg = Config::$errMsg;
            return false;
        }

        $addr = explode(":", $ip);
        if ((false === $addr) || !is_array($addr) || (count($addr)< 2)) {
            self::$errCode = 100;
            self::$errMsg = 'get mp_core spp ip config failed';
            return false;
        }
		 
		//"cmd=1&stype=1&sid=345&data=183920,12342&whid=1\r\n",
		$cmd = 'cmd=1&stype='.$userData['utype'] .'&sid='. $userData['uid'].'&data='.implode(',',$userData['pids']).'&whid='.$wh_id. '&status=0&pageno=0&pagesize=0' . "\r\n";     
	
		$rspStr =NetUtil::tcpLongCmd($addr[0], $addr[1], $cmd, 1, 1);
		if (false == $rspStr) {
			self::$errCode = 19;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[send package to promotion svr timeout]";
			return  false;
		}    
		$rspStr = preg_replace( "/,}}$/", "}}", $rspStr );   
		$ret = ToolUtil::gbJsonDecode($rspStr);  
		if($ret['errno'] != 0)
		{
			self::$errCode = $ret['errno'];
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $ret['errmsg'];
			return  false;
		}
		else
		{
			$retProducts = array();
			if(is_array($ret['data']))
			{ 
				foreach($ret['data'] as $k => $v)
				{
					if(!empty($v))
					{ 
						$retProducts[$v['pid']] = $v['price'];
						$newkey = $v['pid'].'type';
						$retProducts[$newkey] = $v['pricetype'];
					}
				}
			} 
			return $retProducts;
		}		
	}
	
	public static function getSailPriceForProducts($userData, $wh_id = 1) {
		if (!is_array($userData)) {
			self::$errCode = 20;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[para userData error]";
			return false;
		}
		if (!isset($userData['uid']) || $userData['uid'] <= 0) {
			self::$errCode = 20;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[para userData[uid] error]";
			return false;
		}
		if (!isset($userData['utype']) || $userData['utype'] <= 0) {
			self::$errCode = 20;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[para userData[utype] error]";
			return false;
		}
		if (!isset($userData['pids']) || !is_array($userData['pids'])) {
			self::$errCode = 20;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[para userData[pids] error]";
			return false;
		}
		//TODO pids需要做长度限制
	
		$ip = Config::getIP('RetailerMultiPrice');
		if (null == $ip) {
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;
			return false;
		}
		
		$addr = explode(":", $ip);
		if ((false === $addr) || !is_array($addr) || (count($addr) < 2)) {
			self::$errCode = 100;
			self::$errMsg = 'get mp_core spp ip config failed';
			return false;
		}
	
		//"cmd=1&stype=1&sid=345&data=183920,12342&whid=1\r\n",
		$cmd = 'cmd=100&stype=' . $userData['utype'] . '&sid=' . $userData['uid'] . '&data=' . implode(',', $userData['pids']) . '&whid=' . $wh_id . '&status=0&pageno=0&pagesize=0' . "\r\n";
		$rspStr = NetUtil::tcpLongCmd($addr[0], $addr[1], $cmd, 1, 1);
		if (false == $rspStr) {
			self::$errCode = 19;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[send package to promotion svr timeout]";
			return false;
		}
		$rspStr = preg_replace("/,}}$/", "}}", $rspStr);
		$ret = ToolUtil::gbJsonDecode($rspStr);

		if ($ret['errno'] != 0) {
			self::$errCode = $ret['errno'];
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $ret['errmsg'];
			return false;
		}
		else {
			$retProducts = array();
			if (is_array($ret['data'])) {
				foreach ($ret['data'] as $k => $v) {
					if (!empty($v)) {
						$retProducts[$v['pid']] = $v['shipmentprice'];
					}
				}
			}
			return $retProducts;
		}
	}
	

}
