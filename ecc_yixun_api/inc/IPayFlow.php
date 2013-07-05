<?php
/**
 * IPayFlow.php
 * 对TTC:t_pay_flow的赠、查、删、改等操作
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	andyyao
 */

global $_TTC_CFG;

$_TTC_CFG['IPayFlow']['TTCKEY']	= 'IPayFlow';
$_TTC_CFG['IPayFlow']['TABLE']	= 't_pay_flow';
$_TTC_CFG['IPayFlow']['TimeOut']	= 1;
$_TTC_CFG['IPayFlow']['KEY']		= 'payflow';
$_TTC_CFG['IPayFlow']['FIELDS']	= array();//数据类型，int=1,string=2,binary=3
$_TTC_CFG['IPayFlow']['FIELDS']['payflow'] = array('type' => 2, 'min' => 0, 'max' => 64);
$_TTC_CFG['IPayFlow']['FIELDS']['order_char_id'] = array('type' => 2, 'min' => 0, 'max' => 32);
$_TTC_CFG['IPayFlow']['FIELDS']['uid'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IPayFlow']['FIELDS']['pay_id'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IPayFlow']['FIELDS']['status'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IPayFlow']['FIELDS']['updatetime'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);

class IPayFlow
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
	 * 		'payflow' => 'XXX',
	 * 		'order_char_id' => 'XXX',
	 * 		'uid' =>  XXX,
	 * 		'pay_id' =>  XXX,
	 * 		'status' =>  XXX,
	 * 		'updatetime' =>  XXX,
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
		$ttc = Config::getTTC('IPayFlow');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->insert($param);
		if(!$v)
		{
			self::$errCode = $ttc->errCode;
			self::$errMsg  = $ttc->errMsg;
			return false;
		}

		if(!empty(self::$ttcMap[$param['payflow']]))
		{
			unset(self::$ttcMap[$param['payflow']]);
		}

		return $v;
	}

	/**
	 * 更新一条TTC记录
	 * 
	 * @param	$param 格式: 
	 * 	array(
	 * 		'payflow' => 'XXX',
	 * 		'order_char_id' => 'XXX',
	 * 		'uid' =>  XXX,
	 * 		'pay_id' =>  XXX,
	 * 		'status' =>  XXX,
	 * 		'updatetime' =>  XXX,
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
		$ttc = Config::getTTC('IPayFlow');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->update($param, $filter);
		if(!$v)
		{
			self::$errCode = $ttc->errCode;
			self::$errMsg  = $ttc->errMsg;
			return false;
		}

		if(!empty(self::$ttcMap[$param['payflow']]))
		{
			unset(self::$ttcMap[$param['payflow']]);
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
		$ttc = Config::getTTC('IPayFlow');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->delete($key, $filter);
		if(!$v)
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
	 * 		'payflow' => 'XXX',
	 * 		'order_char_id' => 'XXX',
	 * 		'uid' =>  XXX,
	 * 		'pay_id' =>  XXX,
	 * 		'status' =>  XXX,
	 * 		'updatetime' =>  XXX,
	 * 		)
	 */
	public static function get($key, $filter = array(), $multiItem = false)
	{
		self::clearErr();
		
		if(empty($key))
		{
			self::$errCode = 111;
			self::$errMsg  = 'key is empty';
		}
		if(!empty(self::$ttcMap[$key]))
		{
			return self::$ttcMap[$key];
		}

		$ttc = Config::getTTC('IPayFlow');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->get($key, $filter, !$multiItem);
		if(!$v)
		{
			self::$errCode = $ttc->errCode;
			self::$errMsg  = $ttc->errMsg;
			return false;
		}

		if (count(self::$ttcMap) > 100)
		{
			self::$ttcMap = array();
		}

		self::$ttcMap[$key] = $v;

		return $v;
	}

	/**
	 * 批量取TTC记录
	 * 
	 * @param   string  $keys		数据库的主键数组
	 * 
	 * 返回值：正确返回数据，错误返回false
	 */
	public static function gets($keys)
	{
		self::clearErr();
		
		if(empty($keys) || !is_array($keys))
		{
			self::$errCode = 111;
			self::$errMsg  = 'keys is empty';
		}
		$ttc = Config::getTTC2('IPayFlow');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->get($keys);
		if(!$v)
		{
			self::$errCode = $ttc->errCode;
			self::$errMsg  = $ttc->errMsg;
			return false;
		}

		return $v;
	}

}

//End Of Script

