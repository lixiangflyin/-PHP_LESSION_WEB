<?php
/**
 * IShippingTypeTTC.php
 * 对TTC:t_shipping_type的赠、查、删、改等操作
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	andyyao
 */

global $_TTC_CFG;

$_TTC_CFG['IShippingTypeTTC']['TTCKEY']	= 'IShippingTypeTTC';
$_TTC_CFG['IShippingTypeTTC']['TABLE']	= 't_shipping_type';
$_TTC_CFG['IShippingTypeTTC']['TimeOut']	= 1;
$_TTC_CFG['IShippingTypeTTC']['KEY']		= 'inner_id';
$_TTC_CFG['IShippingTypeTTC']['FIELDS']	= array();//数据类型，int=1,string=2,binary=3
$_TTC_CFG['IShippingTypeTTC']['FIELDS']['inner_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IShippingTypeTTC']['FIELDS']['char_id'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IShippingTypeTTC']['FIELDS']['name'] = array('type' => 2, 'min' => 0, 'max' => 50);
$_TTC_CFG['IShippingTypeTTC']['FIELDS']['description'] = array('type' => 2, 'min' => 0, 'max' => 500);
$_TTC_CFG['IShippingTypeTTC']['FIELDS']['period'] = array('type' => 2, 'min' => 0, 'max' => 50);
$_TTC_CFG['IShippingTypeTTC']['FIELDS']['is_show'] = array('type' => 1, 'min' => -128, 'max' => 127);
$_TTC_CFG['IShippingTypeTTC']['FIELDS']['order_num'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IShippingTypeTTC']['FIELDS']['is_pack'] = array('type' => 1, 'min' => -128, 'max' => 127);
$_TTC_CFG['IShippingTypeTTC']['FIELDS']['premium_rate'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IShippingTypeTTC']['FIELDS']['premium_base'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IShippingTypeTTC']['FIELDS']['state_query_type'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IShippingTypeTTC']['FIELDS']['company'] = array('type' => 2, 'min' => 0, 'max' => 50);
$_TTC_CFG['IShippingTypeTTC']['FIELDS']['query_url'] = array('type' => 2, 'min' => 0, 'max' => 500);
$_TTC_CFG['IShippingTypeTTC']['FIELDS']['updatetime'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IShippingTypeTTC']['FIELDS']['create_time'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);

class IShippingTypeTTC
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
	 * 		'inner_id' =>  XXX,
	 * 		'char_id' => 'XXX',
	 * 		'name' => 'XXX',
	 * 		'description' => 'XXX',
	 * 		'period' => 'XXX',
	 * 		'is_show' =>  XXX,
	 * 		'order_num' =>  XXX,
	 * 		'is_pack' =>  XXX,
	 * 		'premium_rate' =>  XXX,
	 * 		'premium_base' =>  XXX,
	 * 		'state_query_type' =>  XXX,
	 * 		'company' => 'XXX',
	 * 		'query_url' => 'XXX',
	 * 		'updatetime' =>  XXX,
	 * 		'create_time' =>  XXX,
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
		$ttc = Config::getTTC('IShippingTypeTTC');
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

		if(!empty(self::$ttcMap[$param['inner_id']]))
		{
			unset(self::$ttcMap[$param['inner_id']]);
		}

		return $v;
	}

	/**
	 * 更新一条TTC记录
	 * 
	 * @param	$param 格式: 
	 * 	array(
	 * 		'inner_id' =>  XXX,
	 * 		'char_id' => 'XXX',
	 * 		'name' => 'XXX',
	 * 		'description' => 'XXX',
	 * 		'period' => 'XXX',
	 * 		'is_show' =>  XXX,
	 * 		'order_num' =>  XXX,
	 * 		'is_pack' =>  XXX,
	 * 		'premium_rate' =>  XXX,
	 * 		'premium_base' =>  XXX,
	 * 		'state_query_type' =>  XXX,
	 * 		'company' => 'XXX',
	 * 		'query_url' => 'XXX',
	 * 		'updatetime' =>  XXX,
	 * 		'create_time' =>  XXX,
	 * 		)
	 * 
	 * 返回值：正确返回true，错误返回false
	 */
	public static function update($param,$filter=array())
	{
		self::clearErr();
		
		if(empty($param) || !is_array($param))
		{
			self::$errCode = 111;
			self::$errMsg  = 'param is empty';
		}
		$ttc = Config::getTTC('IShippingTypeTTC');
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

		if(!empty(self::$ttcMap[$param['inner_id']]))
		{
			unset(self::$ttcMap[$param['inner_id']]);
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
	public static function remove($key, $filter=array())
	{
		self::clearErr();
		
		if(empty($key))
		{
			self::$errCode = 111;
			self::$errMsg  = 'key is empty';
		}
		$ttc = Config::getTTC('IShippingTypeTTC');
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

		if(!empty(self::$ttcMap[$param['inner_id']]))
		{
			unset(self::$ttcMap[$param['inner_id']]);
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
		$ttc = Config::getTTC('IShippingTypeTTC');
		if(!$ttc)
		{
			self::$errCode = -114;
			self::$errMsg  = 'get instance of TTC failed';
			return -1;
		}

		return $ttc->getAffectRows();
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
	 * 		'inner_id' =>  XXX,
	 * 		'char_id' => 'XXX',
	 * 		'name' => 'XXX',
	 * 		'description' => 'XXX',
	 * 		'period' => 'XXX',
	 * 		'is_show' =>  XXX,
	 * 		'order_num' =>  XXX,
	 * 		'is_pack' =>  XXX,
	 * 		'premium_rate' =>  XXX,
	 * 		'premium_base' =>  XXX,
	 * 		'state_query_type' =>  XXX,
	 * 		'company' => 'XXX',
	 * 		'query_url' => 'XXX',
	 * 		'updatetime' =>  XXX,
	 * 		'create_time' =>  XXX,
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

		$ttc = Config::getTTC('IShippingTypeTTC');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->get($key, $multikey, !$multiItem);
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
		$ttc = Config::getTTC2('IShippingTypeTTC');
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

