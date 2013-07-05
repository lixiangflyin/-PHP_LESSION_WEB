<?php
class IFreqLimit
{
	private static $BIZID = array(
	    'loginFail' => 6);
	public static $errCode = 0;
	public static $errMsg = '';

	/*
	//先对访问数量加1，然后检查是否受限

	$key: 抽象的键值，整数，一般为uid
	$bizid：频率限制svr分配给的业务id,新上业务需要找相关人申请bizid

	返回值：
	>0 : 已经受限
	=0 : 没有受限
	<0 : 出错
	*/
	public static function checkAndAdd($key, $bizid)
	{
		if (!isset($key) || !isset($bizid)) {
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[key or bizid is not set]";
			return -1;
		}
		//获取skey
		$ip = Config::getIP('freqlimit');
		if (null == $ip)
		{
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[getip(freqlimit) failed]";
			return  -1;
		}

		$addr = explode(":", $ip);

		$cmd = "cmd=100&key=" . $key . "&bizid=". $bizid . "\r\n";

		$rspStr = NetUtil::tcpCmd($addr[0], $addr[1], $cmd, 1, 1);

		if (false == $rspStr || "" == $rspStr)
		{
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[sessiond svr timeout]";
			return  -1;
		}

		parse_str($rspStr, $ret);
		return $ret['ret'];
	}


	/*
	//仅仅检查是否受限，不对访问次数+1

	$key: 抽象的键值，整数，一般为uid
	$bizid：频率限制svr分配给的业务id,新上业务需要找相关人申请bizid

	返回值：
	>0 : 已经受限
	=0 : 没有受限
	<0 : 出错
	*/
	public static function check($key, $bizid)
	{
		if (!isset($key) || !isset($bizid)) {
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[key or bizid is not set]";
			return -1;
		}
		//获取skey
		$ip = Config::getIP('freqlimit');
		if (null == $ip)
		{
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[getip(freqlimit) failed]";
			return  -1;
		}

		$addr = explode(":", $ip);

		$cmd = "cmd=101&key=" . $key . "&bizid=". $bizid . "\r\n";

		$rspStr = NetUtil::tcpCmd($addr[0], $addr[1], $cmd, 1, 1);

		if (false == $rspStr || "" == $rspStr)
		{
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[sessiond svr timeout]";
			return  -1;
		}

		parse_str($rspStr, $ret);
		return $ret['ret'];
	}

	/*
	//先对访问数量加1，然后返回是否受限

	$key: 抽象的键值，整数，一般为uid
	$bizid：频率限制svr分配给的业务id,新上业务需要找相关人申请bizid

	返回值：
	>0 : 已经受限
	=0 : 没有受限
	<0 : 出错
	*/
	public static function add($key, $bizid)
	{
		if (!isset($key) || !isset($bizid)) {
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[key or bizid is not set]";
			return -1;
		}
		//获取skey
		$ip = Config::getIP('freqlimit');
		if (null == $ip)
		{
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[getip(freqlimit) failed]";
			return  -1;
		}

		$addr = explode(":", $ip);

		$cmd = "cmd=102&key=" . $key . "&bizid=". $bizid . "\r\n";

		$rspStr = NetUtil::tcpCmd($addr[0], $addr[1], $cmd, 1, 1);

		if (false == $rspStr || "" == $rspStr)
		{
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[sessiond svr timeout]";
			return  -1;
		}

		parse_str($rspStr, $ret);
		return $ret['ret'];
	}

	public static function checkLoginFail($ip_str_)
    {
    	if (!isset($ip_str_)) {
    		self::$errCode -1;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[ip is not set]";
			return -1;
		}

        $ip = ip2long($ip_str_);
        // IP 白名单逻辑
        global $LOGIN_FAIL_WHITE_LIST;
        if (isset($LOGIN_FAIL_WHITE_LIST))
        {
        	// 单个IP 列表集合验证
        	if (count($LOGIN_FAIL_WHITE_LIST['IPS']) > 0)
	    	{
		    	if (in_array($ip_str_, $LOGIN_FAIL_WHITE_LIST['IPS']))
		    	{
		    		return 0;
		    	}
	    	}
	    	// IP 区间段验证
	    	if (count($LOGIN_FAIL_WHITE_LIST['IP_SEC']) > 0)
	    	{
		    	foreach ($LOGIN_FAIL_WHITE_LIST['IP_SEC'] AS $item)
		    	{
		    		$begin = ip2long($item['BEGIN']);
		    		$end = ip2long($item['END']);
		    		if ($begin > $end)
		    		{
		    			continue;
		    		}
		    		if ($ip >= $begin && $ip <= $end)
		    		{
		    			return 0;
		    		}
		    	}
	    	}
        }

        global $_FREQ_LIMIT;
        $now = time();
        if (!isset ($_FREQ_LIMIT['LOGIN_FAIL']))
        {
             self::$errCode = -2;
             self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[LOGIN FAIL config is not set]" ;
             return -2;
        }
        $config = $_FREQ_LIMIT[ 'LOGIN_FAIL'];

        $limit = IUserReviewLimitTTC:: get($ip, array( 'biz_id' => $config['bizid'], 'type' => 0));
        // any error is allow to review
        if (false === $limit)
        {
             self::$errCode = -3;
             self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[connect to ttc fail]" ;

            return -3;
        }
        // the user not reviewed
        else if (0 < count($limit))
        {
            $last_time = $limit[0]['timestamp'];
            $count = $limit[0]['count'];

            // the last review time not less than the gap time.
            if ($last_time + $config['GAP'] > $now)
            {
                if ($count >= $config['MAX_COUNT'])
                {
                	self::$errCode = 1;
                	self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[beyond the limit]" ;

                    return 1;
                }
            }
        }

        return 0;
    }

    public static function addLoginFail($ip_str_)
    {
    	if (!isset($ip_str_)) {
    		self::$errCode -1;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[ip is not set]";
			return -1;
		}

        global $_FREQ_LIMIT;
        $now = time();
        $ip = ip2long($ip_str_);
        if (!isset ($_FREQ_LIMIT['LOGIN_FAIL']))
        {
             self::$errCode = -2;
             self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[LOGIN FAIL config is not set]" ;
             return -2;
        }
        $config = $_FREQ_LIMIT['LOGIN_FAIL'];

        $limit = IUserReviewLimitTTC:: get($ip, array( 'biz_id' => $config['bizid'], 'type' => 0));

        // any error is allow to review
        if (false === $limit)
        {
            self::$errCode = -3;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[connect to ttc fail]" ;

            return -3;
        }
        // the user not reviewed
        else if (0 === count($limit))
        {
            $ret = IUserReviewLimitTTC::insert(array( 'uid' => $ip, 'biz_id' => $config['bizid'], 'type' => 0, 'count' => 1, 'timestamp' => $now));
            if (false === $ret)
            {
            	self::$errCode = IUserReviewLimitTTC::$errCode;
            	self::$errMsg = IUserReviewLimitTTC::$errMsg;
            	return -4;
            }

            return 0;
        }
        else
        {
            $last_time = $limit[0]['timestamp'];
            $count = $limit[0]['count'];

            // the last review time not less than the gap time.
            if ($last_time + $config['GAP'] <= $now)
            {
                $ret = IUserReviewLimitTTC::update(array( 'uid' => $ip, 'count' => 1, 'timestamp' => $now), array('biz_id' => $config['bizid'], 'type' => 0));
                if (false === $ret)
	            {
	            	self::$errCode = IUserReviewLimitTTC::$errCode;
	            	self::$errMsg = IUserReviewLimitTTC::$errMsg;
	            	return -5;
	            }

                return 0;
            }
            else
            {
                $ret = IUserReviewLimitTTC::update(array( 'uid' => $ip, 'count' => $count+1), array( 'biz_id' => $config['bizid' ], 'type' => 0));
                if (false === $ret)
	            {
	            	self::$errCode = IUserReviewLimitTTC::$errCode;
	            	self::$errMsg = IUserReviewLimitTTC::$errMsg;
	            	return -6;
	            }
	            if ($count+1 === $config['MAX_COUNT'])
	            {
	            	Logger::err("[Limit] IP beyond the max count ip:{$ip_str_}");
	            	qp_itil_write(620585, "IP({$ip_str_})在wap用户登录失败次数超出限制({$config['MAX_COUNT']}), " . date("Y-m-d H:i:s"));
	            }

                return 0;
            }
        }
    }

    public static function removeLoginFail($ip_str_)
    {
    	if (!isset($ip_str_)) {
    		self::$errCode -1;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[ip is not set]";
			return -1;
		}

        global $_FREQ_LIMIT;
        $ip = ip2long($ip_str_);
        if (!isset ($_FREQ_LIMIT['LOGIN_FAIL']))
        {
             self::$errCode = -2;
             self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[LOGIN FAIL config is not set]" ;
             return -2;
        }
        $config = $_FREQ_LIMIT['LOGIN_FAIL'];

        $limit = IUserReviewLimitTTC:: get($ip, array( 'biz_id' => $config['bizid'], 'type' => 0));

        // any error is allow to review
        if (false === $limit)
        {
             self::$errCode = -3;
             self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[connect to ttc fail]" ;

            return -3;
        }
        // the user not reviewed
        else if (0 !== count($limit))
        {
            $ret = IUserReviewLimitTTC::remove($ip, array( 'biz_id' => $config['bizid'], 'type' => 0));
            if (false === $ret)
            {
            	self::$errCode = IUserReviewLimitTTC::$errCode;
            	self::$errMsg = IUserReviewLimitTTC::$errMsg;
            	return -4;
            }
        }
    }
    
    public static function addByStrKey($str_, $biz_)
    {
        if (!isset($str_) || !isset($biz_)) {
    		self::$errCode = -1;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[str or biz is not set]";
			return -1;
		}
		
    	$ret = SOA::FreqLimitSvr('add', array('biz' => $biz_, 'key' => $str_));
        Logger::INFO("addByStrKey, Key: {$str_} biz : {$biz_}, result : " . var_export($ret, true));
        if (false === $ret)
        {
    		self::$errCode = SOA::$errCode;
			self::$errMsg = SOA::$errMsg;

			return -1;
        }
        
        return $ret;
    }
    
    public static function checkAndAddByStrKey($str_, $biz_)
    {
        if (!isset($str_) || !isset($biz_)) {
    		self::$errCode = -1;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[str or biz is not set]";
			return -1;
		}
		
    	$ret = SOA::FreqLimitSvr('checkAndAdd', array('biz' => $biz_, 'key' => $str_));
        if (false === $ret)
        {
    		self::$errCode = SOA::$errCode;
			self::$errMsg = SOA::$errMsg;

			return -1;
        }
        
        return $ret;
    }
    
    public static function checkAndAddByIP($ip_str_, $biz_)
    {
    	if (!isset($ip_str_) || !isset($biz_)) {
    		self::$errCode = -1;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[ip or biz is not set]";
			return -1;
		}

        // IP 白名单逻辑
        $ret = self::checkWhiteIP($ip_str_);
        if (true === $ret)
        	return 0;
		
    	$ret = SOA::FreqLimitSvr('checkAndAdd', array('biz' => $biz_, 'key' => $ip_str_));
        if (false === $ret)
        {
    		self::$errCode = SOA::$errCode;
			self::$errMsg = SOA::$errMsg;

			return -1;
        }
        
        return $ret;
    }
    
    public static function checkByStr($str_, $biz_)
    {
    	if (!isset($str_) || !isset($biz_)) {
    		self::$errCode = -1;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[ip or biz is not set]";
			return -1;
		}

        $ret = SOA::FreqLimitSvr('check', array('biz' => $biz_, 'key' => $str_));
        if (false === $ret)
        {
    		self::$errCode = SOA::$errCode;
			self::$errMsg = SOA::$errMsg;
			
			return -1;
        }

        return $ret;
    }

    public static function checkByIP($ip_str_, $biz_)
    {
    	if (!isset($ip_str_) || !isset($biz_)) {
    		self::$errCode = -1;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[ip or biz is not set]";
			return -1;
		}

        // IP 白名单逻辑
        $ret = self::checkWhiteIP($ip_str_);
        Logger::INFO("Check by white IP, IP: {$ip_str_}, result : " . var_export($ret, true));
        if (true === $ret)
        	return 0;

        $ret = SOA::FreqLimitSvr('check', array('biz' => $biz_, 'key' => $ip_str_));
        Logger::INFO("Check by IP, IP: {$ip_str_}, result : " . var_export($ret, true));
        if (false === $ret)
        {
    		self::$errCode = SOA::$errCode;
			self::$errMsg = SOA::$errMsg;
			
			return -1;
        }

        return $ret;
    }
    
    public static function delByStrKey($str_, $biz_)
    {
    	if (!isset($str_) || !isset($biz_)) {
    		self::$errCode = -1;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[str or biz is not set]";
			return -1;
		}
		
    	$ret = SOA::FreqLimitSvr('del', array('biz' => $biz_, 'key' => $str_));
        if (false === $ret)
        {
    		self::$errCode = SOA::$errCode;
			self::$errMsg = SOA::$errMsg;

			return -1;
        }
        
        return $ret;
    }

    public static function checkWhiteIP($ip_str_)
    {
   		global $LOGIN_FAIL_WHITE_LIST;
        if (isset($LOGIN_FAIL_WHITE_LIST))
        {
        	// 单个IP 列表集合验证
        	if (count($LOGIN_FAIL_WHITE_LIST['IPS']) > 0)
	    	{
		    	if (in_array($ip_str_, $LOGIN_FAIL_WHITE_LIST['IPS']))
		    	{
		    		return true;
		    	}
	    	}
	    	// IP 区间段验证
	    	if (count($LOGIN_FAIL_WHITE_LIST['IP_SEC']) > 0)
	    	{
		    	foreach ($LOGIN_FAIL_WHITE_LIST['IP_SEC'] AS $item)
		    	{
		    		$begin = ip2long($item['BEGIN']);
		    		$end = ip2long($item['END']);
		    		$ip = ip2long($ip_str_);
		    		if ($begin > $end)
		    		{
		    			continue;
		    		}
		    		if ($ip >= $begin && $ip <= $end)
		    		{
		    			return true;
		    		}
		    	}
	    	}
        }
        
        return false;
    }
    
    /**
     * 使用TMem的CAS模式实现频率控制，防止请求在短时间内重入
     * @param string $lock_key 频率控制的key
     * @param int $expire 有效期，以秒为单位
     */
    public static function checkFrequence($lock_key, $expire = 1) {
    	$cas = -1;
    	$expire_ts = 0;
    	$count = IDataCache::casGetData(IDataCache::getPrefix(IDataCache::BIZ_TYPE_FREQ_LIMIT) . $lock_key, $cas, $expire_ts);
    	if($count === false) {
    		if(IDataCache::$errCode === IDataCache::ERROR_NO_DATA || IDataCache::$errCode === IDataCache::ERROR_KEY_EXPIRED ) {
    			$ret = IDataCache::casSetData(IDataCache::getPrefix(IDataCache::BIZ_TYPE_FREQ_LIMIT) . $lock_key, 1, $cas, $expire);
    			if($ret === false) {
    				self::$errCode = IDataCache::$errCode;
    				self::$errMsg = IDataCache::$errMsg;
    				return false;
    			} else {
    				return true;
    			}
    		} else {
    			self::$errCode = IDataCache::$errCode;
    			self::$errMsg = IDataCache::$errMsg;
    			return false;
    		}
    	} else {
    		return false;
    	}
    }
}

