<?php
/**
 * ICPSSysLogTTC.php
 * 对TTC:t_cps_sys_log_的赠、查、删、改等操作
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	DaopingSun 2012/10/22 17:49
 */

global $_TTC_CFG;

$_TTC_CFG['ICPSSysLogTTC']['TTCKEY']	= 'ICPSSysLogTTC';
$_TTC_CFG['ICPSSysLogTTC']['TABLE']	= 't_cps_sys_log_';
$_TTC_CFG['ICPSSysLogTTC']['TimeOut']	= 1;
$_TTC_CFG['ICPSSysLogTTC']['KEY']		= 'mid';
$_TTC_CFG['ICPSSysLogTTC']['FIELDS']	= array();//数据类型，int=1,string=2,binary=3
$_TTC_CFG['ICPSSysLogTTC']['FIELDS']['mid'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['ICPSSysLogTTC']['FIELDS']['syslog_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['ICPSSysLogTTC']['FIELDS']['type'] = array('type' => 1, 'min' => 0, 'max' => 255);
$_TTC_CFG['ICPSSysLogTTC']['FIELDS']['err_code'] = array('type' => 2, 'min' => 0, 'max' => 15);
$_TTC_CFG['ICPSSysLogTTC']['FIELDS']['err_msg'] = array('type' => 2, 'min' => 0, 'max' => 65535);
$_TTC_CFG['ICPSSysLogTTC']['FIELDS']['debug_info'] = array('type' => 2, 'min' => 0, 'max' => 65535);
$_TTC_CFG['ICPSSysLogTTC']['FIELDS']['handler'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['ICPSSysLogTTC']['FIELDS']['update_time'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['ICPSSysLogTTC']['FIELDS']['add_time'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);

class ICPSSysLogTTC
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
	 * 		'mid' =>  XXX,
	 * 		'syslog_id' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'err_code' => 'XXX',
	 * 		'err_msg' => 'XXX',
	 * 		'debug_info' => 'XXX',
	 * 		'handler' => 'XXX',
	 * 		'update_time' =>  XXX,
	 * 		'add_time' =>  XXX,
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
		$ttc = Config::getTTC('ICPSSysLogTTC');
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

		if(!empty(self::$ttcMap[$param['mid']]))
		{
			unset(self::$ttcMap[$param['mid']]);
		}

		return $v;
	}

	/**
	 * 更新一条TTC记录
	 * 
	 * @param	$param 格式: 
	 * 	array(
	 * 		'mid' =>  XXX,
	 * 		'syslog_id' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'err_code' => 'XXX',
	 * 		'err_msg' => 'XXX',
	 * 		'debug_info' => 'XXX',
	 * 		'handler' => 'XXX',
	 * 		'update_time' =>  XXX,
	 * 		'add_time' =>  XXX,
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
		$ttc = Config::getTTC('ICPSSysLogTTC');
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

		if(!empty(self::$ttcMap[$param['mid']]))
		{
			unset(self::$ttcMap[$param['mid']]);
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
		$ttc = Config::getTTC('ICPSSysLogTTC');
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
	 * 		'mid' =>  XXX,
	 * 		'syslog_id' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'err_code' => 'XXX',
	 * 		'err_msg' => 'XXX',
	 * 		'debug_info' => 'XXX',
	 * 		'handler' => 'XXX',
	 * 		'update_time' =>  XXX,
	 * 		'add_time' =>  XXX,
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
		$ttc = Config::getTTC('ICPSSysLogTTC');
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
		$ttc = Config::getTTC2('ICPSSysLogTTC');
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
	 * 取操作TTC影响的行数
	 * 
	 * 
	 * 返回值：正确返回>-1的行数，错误返回负数
	 */
	public static function getTTCAffectRows()
	{
		$ttc = Config::getTTC('ICPSSysLogTTC');
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

