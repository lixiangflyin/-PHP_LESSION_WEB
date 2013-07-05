<?php
/**
 * IGiftCardBatchTTC.php
 * 对TTC:card_batch的赠、查、删、改等操作
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	root
 */

global $_TTC_CFG;

$_TTC_CFG['IGiftCardBatchTTC']['TTCKEY']	= 'IGiftCardBatchTTC';
$_TTC_CFG['IGiftCardBatchTTC']['TABLE']	= 'card_batch';
$_TTC_CFG['IGiftCardBatchTTC']['TimeOut']	= 1;
$_TTC_CFG['IGiftCardBatchTTC']['KEY']		= 'batch';
$_TTC_CFG['IGiftCardBatchTTC']['FIELDS']	= array();//数据类型，int=1,string=2,binary=3
$_TTC_CFG['IGiftCardBatchTTC']['FIELDS']['batch'] = array('type' => 1, 'min' => 0, 'max' => 4294967295, 'auto' => 1);
$_TTC_CFG['IGiftCardBatchTTC']['FIELDS']['category'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IGiftCardBatchTTC']['FIELDS']['amount'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IGiftCardBatchTTC']['FIELDS']['valid_time_from'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IGiftCardBatchTTC']['FIELDS']['valid_time_to'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IGiftCardBatchTTC']['FIELDS']['city'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IGiftCardBatchTTC']['FIELDS']['check_code'] = array('type' => 2, 'min' => 0, 'max' => 10);
$_TTC_CFG['IGiftCardBatchTTC']['FIELDS']['startno'] = array('type' => 2, 'min' => 0, 'max' => 50);
$_TTC_CFG['IGiftCardBatchTTC']['FIELDS']['endno'] = array('type' => 2, 'min' => 0, 'max' => 50);
$_TTC_CFG['IGiftCardBatchTTC']['FIELDS']['status'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IGiftCardBatchTTC']['FIELDS']['is_send'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IGiftCardBatchTTC']['FIELDS']['name'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IGiftCardBatchTTC']['FIELDS']['card_maker'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IGiftCardBatchTTC']['FIELDS']['comment'] = array('type' => 2, 'min' => 0, 'max' => 500);

class IGiftCardBatchTTC
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
	 * 		'batch' =>  XXX,
	 * 		'category' =>  XXX,
	 * 		'amount' =>  XXX,
	 * 		'valid_time_from' =>  XXX,
	 * 		'valid_time_to' =>  XXX,
	 * 		'city' =>  XXX,
	 * 		'check_code' => 'XXX',
	 * 		'startno' => 'XXX',
	 * 		'endno' => 'XXX',
	 * 		'status' =>  XXX,
	 * 		'is_send' =>  XXX,
	 * 		'name' => 'XXX',
	 * 		'card_maker' =>  XXX,
	 * 		'comment' => 'XXX',
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
		$ttc = Config::getTTC('IGiftCardBatchTTC');
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

		if(!empty(self::$ttcMap[$param['batch']]))
		{
			unset(self::$ttcMap[$param['batch']]);
		}

		return $v;
	}

	/**
	 * 更新一条TTC记录
	 * 
	 * @param	$param 格式: 
	 * 	array(
	 * 		'batch' =>  XXX,
	 * 		'category' =>  XXX,
	 * 		'amount' =>  XXX,
	 * 		'valid_time_from' =>  XXX,
	 * 		'valid_time_to' =>  XXX,
	 * 		'city' =>  XXX,
	 * 		'check_code' => 'XXX',
	 * 		'startno' => 'XXX',
	 * 		'endno' => 'XXX',
	 * 		'status' =>  XXX,
	 * 		'is_send' =>  XXX,
	 * 		'name' => 'XXX',
	 * 		'card_maker' =>  XXX,
	 * 		'comment' => 'XXX',
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
		$ttc = Config::getTTC('IGiftCardBatchTTC');
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

		if(!empty(self::$ttcMap[$param['batch']]))
		{
			unset(self::$ttcMap[$param['batch']]);
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
		$ttc = Config::getTTC('IGiftCardBatchTTC');
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
	 * 		'batch' =>  XXX,
	 * 		'category' =>  XXX,
	 * 		'amount' =>  XXX,
	 * 		'valid_time_from' =>  XXX,
	 * 		'valid_time_to' =>  XXX,
	 * 		'city' =>  XXX,
	 * 		'check_code' => 'XXX',
	 * 		'startno' => 'XXX',
	 * 		'endno' => 'XXX',
	 * 		'status' =>  XXX,
	 * 		'is_send' =>  XXX,
	 * 		'name' => 'XXX',
	 * 		'card_maker' =>  XXX,
	 * 		'comment' => 'XXX',
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
		$ttc = Config::getTTC('IGiftCardBatchTTC');
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
		$ttc = Config::getTTC2('IGiftCardBatchTTC');
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
		$ttc = Config::getTTC('IGiftCardBatchTTC');
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
		$ttc = Config::getTTC('IGiftCardBatchTTC');
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

