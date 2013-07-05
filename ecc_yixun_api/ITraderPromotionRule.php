<?php 
class ITraderPromotionRule
{
	public static $errMsg='';
	public static $errCode=0; 
	
	/*  查找多个商品的价格
		输入信息 $userData array 用户信息
				 $wh_id    int   分仓id
		$userData = array(
			'uid' => 30562663,
			'Traderlevel' => 3,
			'product' => array(
				'34577' => array(
					'sellPrice' => 89800,
					'costPrice' => 79800
				),
				'66969' => array(
					'sellPrice' => 29800,
					'costPrice' => 29600
				)
			)
		); 
		返回信息 正确 errCode 为0 ，错误不为0
		array(
				'34577' => array(
                            'sp' => 89800,
                            'cp' => 79800,
                            'rp' => 89703,
                            'rule_id' => 5,
                            'rule_Type' => 4,
                            'benefit_type' => 1,
                            'traderPrice' => 97,
                            'desc' => '规则 诺基亚 N81 GSM手机 商品 34577 折扣'
				),
				'66969' => array(
							'sp' => 29800,
                            'cp' => 29600,
                            'rp' => 29703,
                            'rule_id' => 7,
                            'rule_Type' => 2,
                            'benefit_type' => 1,
                            'traderPrice' => 97,
                            'desc' => '规则 大家电中类 1226 折扣'
				)
			); 
	*/	
	public static function getRuleForProducts($userData, $wh_id = 1)
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
		if(!isset($userData['product']) || !is_array($userData['product']))
		{
			self::$errCode = 20;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[para userData[product] error]"; 
			return  false;		
		}	 
		
		$pidStr = '';
		$count = 0;
		$sendPidStrArray = array();
		$sendPidStrTemp = '';
		foreach($userData['product'] as $k => $v)
		{
			$pid = 0;
			$sellPrice = 0;
			$costPrice = 0;
			if(!isset($v['sellPrice']) || !isset($v['costPrice']))
			{
				self::$errCode = 20;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[para userData[product][price] is not exist]";  
				return false;
			}
			$pid = $k;
			$sellPrice = $v['sellPrice'];
			$costPrice = $v['costPrice'];
			$pidStr .=  $pid . '_sp' . $sellPrice . '_cp' . $costPrice . ',';
			$count++;
			if($count > 15)
			{
				$count = 0;
				$pidStr = preg_replace( "/,$/", "", $pidStr );
				$sendPidStrArray[] = $pidStr;
				$pidStr = '';
			} 
		}
		if($pidStr != '')
		{
			$pidStr = preg_replace( "/,$/", "", $pidStr );
		}
		if(count($sendPidStrArray) == 0 && $pidStr == '')
		{
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[para userData pidStr is null]"; 
			return false;		
		}
		$sendPidStrArray[] = $pidStr;
		 
		$ip = Config::getIP('traderPromotion');
		if (null == $ip)
		{
			self::$errCode = 18;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[getip(traderPromotion) failed]";
			return  false;
		}
		$addr = explode(":", $ip); 
		 
		$allProductInfo = array(); 
		foreach($sendPidStrArray as $v)
		{		
			$cmd = 'cmd=300&wh_id=' . $wh_id . '&uid=' . $userData['uid'] .'&l=' . $userData['Traderlevel'] . '&pids=' . $v . "\r\n";  
			$rspStr = NetUtil::tcpCmd($addr[0], $addr[1], $cmd, 1,  1, 0, "\n"); 
			if (false == $rspStr) {
				self::$errCode = 19;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[send package to promotion svr timeout]";
				return  false;
			}    
			$rspStr = preg_replace( "/,}}$/", "}}", $rspStr );  
			$ret = ToolUtil::gbJsonDecode($rspStr);  
			if($ret['errCode'] != 0)
			{
				self::$errCode = $ret['errCode'];
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $ret['errMsg'];
				return  false;
			}
			else
			{
				if(is_array($ret['data']))
				{
					foreach($ret['data'] as $k => $v)
					{
						if(empty($v))
						{
							unset($ret['data'][$k]);
						}
						$allProductInfo[$k] = $v;
					}
				}  
			}	
		}		
		return $allProductInfo;
	}
	
/*  查找多个商品的价格
		输入信息 $userData array 用户信息
				 $wh_id    int   分仓id
		$userData = array(
			'uid' => 30562663,
			'Traderlevel' => 3,
			'product' => array(
				'34577' => array(
					'sellPrice' => 89800,
					'costPrice' => 79800
				)
			)
		); 
		返回信息
		array(
				'34577' => array(
                            'sp' => 89800,
                            'cp' => 79800,
                            'rp' => 89703,
                            'rule_id' => 5,
                            'rule_Type' => 4,
                            'benefit_type' => 1,
                            'traderPrice' => 97,
                            'desc' => '规则 诺基亚 N81 GSM手机 商品 34577 折扣'
				)
			); 
	*/	
	public static function getRuleForProduct($userData, $wh_id = 1)
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
		if(!isset($userData['product']) || !is_array($userData['product']))
		{
			self::$errCode = 20;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[para userData[product] error]"; 
			return  false;		
		}	
		if(count($userData['product']) != 1)
		{
			self::$errCode = 20;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[para userData[product] number not unique]"; 		
			return  false;		
		}
		$pid = 0;
		$sellPrice = 0;
		$costPrice = 0;
		foreach($userData['product'] as $k => $v)
		{
			if(!isset($v['sellPrice']) || !isset($v['costPrice']))
			{
				self::$errCode = 20;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[para userData[product][price] is not exist]"; 
				return false;
			}
			$pid = $k;
			$sellPrice = $v['sellPrice'];
			$costPrice = $v['costPrice'];
			break;
		}
		$ip = Config::getIP('traderPromotion');
		if (null == $ip)
		{
			self::$errCode = 18;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[getip(traderPromotion) failed]";
			return  false;
		}
		$addr = explode(":", $ip); 
		 
		
		$cmd = 'cmd=100&wh_id=' . $wh_id . '&uid=' . $userData['uid'] .'&l=' . $userData['Traderlevel'] . '&pids=' . $pid . '_sp' . $sellPrice . '_cp' . $costPrice . "\r\n";  
		$rspStr = NetUtil::tcpCmd($addr[0], $addr[1], $cmd, 1,  1, 0, "\n"); 
		if (false == $rspStr) {
			self::$errCode = 19;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[send package to promotion svr timeout]";
			return  false;
		}  
		$rspStr = preg_replace( "/,}}$/", "}}", $rspStr ); 
		$ret = ToolUtil::gbJsonDecode($rspStr);
		if($ret['errCode'] != 0)
		{
			self::$errCode = $ret['errCode'];
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $ret['errMsg'];
			return  false;
		}
		else
		{
			if(is_array($ret['data']))
			{
				foreach($ret['data'] as $k => $v)
				{
					if(empty($v))
					{
						unset($ret['data'][$k]);
					}
				}
			}
			return $ret['data'];
		}	
	} 
}


