<?php
/**
 * IUsersTTC.php
 * 对TTC:t_users_的赠、查、删、改等操作
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	andyyao
 */

global $_TTC_CFG;

$_TTC_CFG['IUsersTTC']['TTCKEY']	= 'IUsersTTC';
$_TTC_CFG['IUsersTTC']['TABLE']	= 't_users_';
$_TTC_CFG['IUsersTTC']['TimeOut']	= 1;
$_TTC_CFG['IUsersTTC']['KEY']		= 'uid';
$_TTC_CFG['IUsersTTC']['FIELDS']	= array();//数据类型，int=1,string=2,binary=3
$_TTC_CFG['IUsersTTC']['FIELDS']['uid'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IUsersTTC']['FIELDS']['icsonid'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IUsersTTC']['FIELDS']['email'] = array('type' => 2, 'min' => 0, 'max' => 256);
$_TTC_CFG['IUsersTTC']['FIELDS']['mobile'] = array('type' => 2, 'min' => 0, 'max' => 16);
$_TTC_CFG['IUsersTTC']['FIELDS']['qq'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IUsersTTC']['FIELDS']['name'] = array('type' => 2, 'min' => 0, 'max' => 128);
$_TTC_CFG['IUsersTTC']['FIELDS']['nick'] = array('type' => 2, 'min' => 0, 'max' => 128);
$_TTC_CFG['IUsersTTC']['FIELDS']['face'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IUsersTTC']['FIELDS']['sex'] = array('type' => 2, 'min' => 0, 'max' => 1);
$_TTC_CFG['IUsersTTC']['FIELDS']['year'] = array('type' => 1, 'min' => -65536, 'max' => 32767);
$_TTC_CFG['IUsersTTC']['FIELDS']['month'] = array('type' => 1, 'min' => -128, 'max' => 127);
$_TTC_CFG['IUsersTTC']['FIELDS']['day'] = array('type' => 1, 'min' => -128, 'max' => 127);
$_TTC_CFG['IUsersTTC']['FIELDS']['identity'] = array('type' => 1, 'min' => -128, 'max' => 127);
$_TTC_CFG['IUsersTTC']['FIELDS']['level'] = array('type' => 1, 'min' => 0, 'max' => 255);
$_TTC_CFG['IUsersTTC']['FIELDS']['total_point'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IUsersTTC']['FIELDS']['valid_point'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IUsersTTC']['FIELDS']['idcard'] = array('type' => 2, 'min' => 0, 'max' => 32);
$_TTC_CFG['IUsersTTC']['FIELDS']['status'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IUsersTTC']['FIELDS']['phone'] = array('type' => 2, 'min' => 0, 'max' => 64);
$_TTC_CFG['IUsersTTC']['FIELDS']['fax'] = array('type' => 2, 'min' => 0, 'max' => 64);
$_TTC_CFG['IUsersTTC']['FIELDS']['city'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IUsersTTC']['FIELDS']['address'] = array('type' => 2, 'min' => 0, 'max' => 256);
$_TTC_CFG['IUsersTTC']['FIELDS']['zipcode'] = array('type' => 2, 'min' => 0, 'max' => 16);
$_TTC_CFG['IUsersTTC']['FIELDS']['updatetime'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IUsersTTC']['FIELDS']['regsrc'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IUsersTTC']['FIELDS']['regtime'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IUsersTTC']['FIELDS']['note'] = array('type' => 2, 'min' => 0, 'max' => 800);
$_TTC_CFG['IUsersTTC']['FIELDS']['is_manual_level'] = array('type' => 1, 'min' => -128, 'max' => 127);
$_TTC_CFG['IUsersTTC']['FIELDS']['type'] = array('type' => 1, 'min' => -128, 'max' => 127);
$_TTC_CFG['IUsersTTC']['FIELDS']['regIP'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IUsersTTC']['FIELDS']['exp_point'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IUsersTTC']['FIELDS']['reg_warehouse_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IUsersTTC']['FIELDS']['recomend_score'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IUsersTTC']['FIELDS']['refer_uid'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IUsersTTC']['FIELDS']['vip_rank'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IUsersTTC']['FIELDS']['web_power_group'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IUsersTTC']['FIELDS']['status_bits'] = array('type' => 1, 'min' => -9.2233720368548E+18, 'max' => 9223372036854775807);
$_TTC_CFG['IUsersTTC']['FIELDS']['retailerLevel'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IUsersTTC']['FIELDS']['cqq'] = array('type' => 1, 'min' => 0, 'max' => 1.844674407371E+19);
$_TTC_CFG['IUsersTTC']['FIELDS']['promotion_point'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IUsersTTC']['FIELDS']['cash_point'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);

class IUsersTTC
{
	/**
	 * 错误编码
	 */
	public static $errCode = 0;

	/**
	 * 错误消息
	 */
	public static $errMsg  = '';

	/**
	 * ttc记录Map
	 */
	public static $ttcMap  = array();

	public static function getErrCode() {
		return self::$errCode;
	}

	public static function getErrMsg() {
		return self::$errMsg;
	}

	/**
	 * 清除错误标识，在每个函数调用前调用
	 */
	private static function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}

	/**
	 * 增加一条TTC记录
	 * 
	 * @param	$param 格式: 
	 * 	array(
	 * 		'uid' =>  XXX,
	 * 		'icsonid' => 'XXX',
	 * 		'email' => 'XXX',
	 * 		'mobile' => 'XXX',
	 * 		'qq' =>  XXX,
	 * 		'name' => 'XXX',
	 * 		'nick' => 'XXX',
	 * 		'face' =>  XXX,
	 * 		'sex' => 'XXX',
	 * 		'year' =>  XXX,
	 * 		'month' =>  XXX,
	 * 		'day' =>  XXX,
	 * 		'identity' =>  XXX,
	 * 		'level' =>  XXX,
	 * 		'total_point' =>  XXX,
	 * 		'valid_point' =>  XXX,
	 * 		'idcard' => 'XXX',
	 * 		'status' =>  XXX,
	 * 		'phone' => 'XXX',
	 * 		'fax' => 'XXX',
	 * 		'city' =>  XXX,
	 * 		'address' => 'XXX',
	 * 		'zipcode' => 'XXX',
	 * 		'updatetime' =>  XXX,
	 * 		'regsrc' =>  XXX,
	 * 		'regtime' =>  XXX,
	 * 		'note' => 'XXX',
	 * 		'is_manual_level' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'regIP' => 'XXX',
	 * 		'exp_point' =>  XXX,
	 * 		'reg_warehouse_id' =>  XXX,
	 * 		'recomend_score' =>  XXX,
	 * 		'refer_uid' =>  XXX,
	 * 		'vip_rank' =>  XXX,
	 * 		'web_power_group' =>  XXX,
	 * 		'status_bits' =>  XXX,
	 * 		'retailerLevel' =>  XXX,
	 * 		'cqq' =>  XXX,
	 * 		'promotion_point' =>  XXX,
	 * 		'cash_point' =>  XXX,
	 * 		)
	 * 
	 * 返回值：正确返回true，错误返回false
	 */
	public static function insert($param)
	{
		self::clearErr();
		
		if(empty($param) || !is_array($param))
		{
			self::$errCode = 111;
			self::$errMsg  = 'param is empty';
		}
		$ttc = Config::getTTC('IUsersTTC');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->insert($param);
		if(false === $v)
		{
			self::$errCode = $ttc->errCode;
			self::$errMsg  = $ttc->errMsg;
			return false;
		}

		if(!empty(self::$ttcMap[$param['uid']]))
		{
			unset(self::$ttcMap[$param['uid']]);
		}

		return $v;
	}

	/**
	 * 更新一条TTC记录
	 * 
	 * @param	$param 格式: 
	 * 	array(
	 * 		'uid' =>  XXX,
	 * 		'icsonid' => 'XXX',
	 * 		'email' => 'XXX',
	 * 		'mobile' => 'XXX',
	 * 		'qq' =>  XXX,
	 * 		'name' => 'XXX',
	 * 		'nick' => 'XXX',
	 * 		'face' =>  XXX,
	 * 		'sex' => 'XXX',
	 * 		'year' =>  XXX,
	 * 		'month' =>  XXX,
	 * 		'day' =>  XXX,
	 * 		'identity' =>  XXX,
	 * 		'level' =>  XXX,
	 * 		'total_point' =>  XXX,
	 * 		'valid_point' =>  XXX,
	 * 		'idcard' => 'XXX',
	 * 		'status' =>  XXX,
	 * 		'phone' => 'XXX',
	 * 		'fax' => 'XXX',
	 * 		'city' =>  XXX,
	 * 		'address' => 'XXX',
	 * 		'zipcode' => 'XXX',
	 * 		'updatetime' =>  XXX,
	 * 		'regsrc' =>  XXX,
	 * 		'regtime' =>  XXX,
	 * 		'note' => 'XXX',
	 * 		'is_manual_level' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'regIP' => 'XXX',
	 * 		'exp_point' =>  XXX,
	 * 		'reg_warehouse_id' =>  XXX,
	 * 		'recomend_score' =>  XXX,
	 * 		'refer_uid' =>  XXX,
	 * 		'vip_rank' =>  XXX,
	 * 		'web_power_group' =>  XXX,
	 * 		'status_bits' =>  XXX,
	 * 		'retailerLevel' =>  XXX,
	 * 		'cqq' =>  XXX,
	 * 		'promotion_point' =>  XXX,
	 * 		'cash_point' =>  XXX,
	 * 		)
	 * 
	 * 返回值：正确返回true，错误返回false
	 */
	public static function update($param, $filter = array())
	{
		self::clearErr();
		
		if(empty($param) || !is_array($param))
		{
			self::$errCode = 111;
			self::$errMsg  = 'param is empty';
		}
		$ttc = Config::getTTC('IUsersTTC');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->update($param, $filter);
		if(false === $v)
		{
			self::$errCode = $ttc->errCode;
			self::$errMsg  = $ttc->errMsg;
			return false;
		}

		if(!empty(self::$ttcMap[$param['uid']]))
		{
			unset(self::$ttcMap[$param['uid']]);
		}

		return $v;
	}

	/**
	 * 删除一条TTC记录
	 * 
	 * @param   string  $key		数据库的主键
	 * 
	 * 返回值：正确返回true，错误返回false
	 */
	public static function remove($key, $filter= array())
	{
		self::clearErr();
		
		if(empty($key))
		{
			self::$errCode = 111;
			self::$errMsg  = 'key is empty';
		}
		$ttc = Config::getTTC('IUsersTTC');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->delete($key, $filter);
		if(false === $v)
		{
			self::$errCode = $ttc->errCode;
			self::$errMsg  = $ttc->errMsg;
			return false;
		}

		if(!empty(self::$ttcMap[$key]))
		{
			unset(self::$ttcMap[$key]);
		}

		return $v;
	}

	/**
	 * 取一条TTC记录
	 * 
	 * @param   string  $key		数据库的主键
	 * @param   array   $multikey	可选参数, 多字段key时必选, 形如array('field2' => 1, 'field3' => 2)
	 * 
	 * 返回值：正确返回数据，错误返回false
	 * 数据格式:
	 * 	array(
	 * 		'uid' =>  XXX,
	 * 		'icsonid' => 'XXX',
	 * 		'email' => 'XXX',
	 * 		'mobile' => 'XXX',
	 * 		'qq' =>  XXX,
	 * 		'name' => 'XXX',
	 * 		'nick' => 'XXX',
	 * 		'face' =>  XXX,
	 * 		'sex' => 'XXX',
	 * 		'year' =>  XXX,
	 * 		'month' =>  XXX,
	 * 		'day' =>  XXX,
	 * 		'identity' =>  XXX,
	 * 		'level' =>  XXX,
	 * 		'total_point' =>  XXX,
	 * 		'valid_point' =>  XXX,
	 * 		'idcard' => 'XXX',
	 * 		'status' =>  XXX,
	 * 		'phone' => 'XXX',
	 * 		'fax' => 'XXX',
	 * 		'city' =>  XXX,
	 * 		'address' => 'XXX',
	 * 		'zipcode' => 'XXX',
	 * 		'updatetime' =>  XXX,
	 * 		'regsrc' =>  XXX,
	 * 		'regtime' =>  XXX,
	 * 		'note' => 'XXX',
	 * 		'is_manual_level' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'regIP' => 'XXX',
	 * 		'exp_point' =>  XXX,
	 * 		'reg_warehouse_id' =>  XXX,
	 * 		'recomend_score' =>  XXX,
	 * 		'refer_uid' =>  XXX,
	 * 		'vip_rank' =>  XXX,
	 * 		'web_power_group' =>  XXX,
	 * 		'status_bits' =>  XXX,
	 * 		'retailerLevel' =>  XXX,
	 * 		'cqq' =>  XXX,
	 * 		'promotion_point' =>  XXX,
	 * 		'cash_point' =>  XXX,
	 * 		)
	 */
	public static function get($key, $filter = array(), $need = array(), $itemLimit = 0, $start = 0)
	{
		self::clearErr();
		
		if(empty($key))
		{
			self::$errCode = 111;
			self::$errMsg  = 'key is empty';
		}
		$ttc = Config::getTTC('IUsersTTC');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->get($key, $filter, $need , $itemLimit, $start );
		if(false === $v)
		{
			self::$errCode = $ttc->errCode;
			self::$errMsg  = $ttc->errMsg;
			return false;
		}

		return $v;
	}

	/**
	 * 批量取TTC记录
	 * 
	 * @param   string  $keys		数据库的主键数组
	 * 
	 * 返回值：正确返回数据，错误返回false
	 */
	public static function gets($keys, $filter=array(), $need=array())
	{
		self::clearErr();
		
		if(empty($keys) || !is_array($keys))
		{
			self::$errCode = 111;
			self::$errMsg  = 'keys is empty';
		}
		$ttc = Config::getTTC2('IUsersTTC');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->get($keys, $filter, $need);
		if(false === $v)
		{
			self::$errCode = $ttc->errCode;
			self::$errMsg  = $ttc->errMsg;
			return false;
		}

		return $v;
	}

	/**
	 * 清理缓存
	 * @param mix $key 第一个key
	 * @param array $filter 其它过滤条件
	 * @return boolean
	 */
	public static function purge($key, $filter = array())
	{
		self::clearErr();
		
		if(empty($key))
		{
			self::$errCode = 111;
			self::$errMsg  = 'key is empty';
		}
		$ttc = Config::getTTC('IUsersTTC');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}
		
		$v = $ttc->purge($key, $filter);
		if(false === $v)
		{
			self::$errCode = $ttc->errCode;
			self::$errMsg  = $ttc->errMsg;
			return false;
		}
		
		return true;
	}

	/**
	 * 取操作TTC影响的行数
	 * 
	 * 
	 * 返回值：正确返回>-1的行数，错误返回负数
	 */
	public static function getTTCAffectRows()
	{
		$ttc = Config::getTTC('IUsersTTC');
		if(!$ttc)
		{
			self::$errCode = -114;
			self::$errMsg  = 'get instance of TTC failed';
			return -1;
		}

		return $ttc->getAffectRows();
	}

}

//End Of Script

