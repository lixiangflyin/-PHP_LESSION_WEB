<?php
/**
 * IRetailerOrderItemsTTC.php
 * 对TTC:t_order_items的赠、查、删、改等操作
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	root
 */

global $_TTC_CFG;

$_TTC_CFG['IRetailerOrderItemsTTC']['TTCKEY']	= 'IRetailerOrderItemsTTC';
$_TTC_CFG['IRetailerOrderItemsTTC']['TABLE']	= 't_order_items';
$_TTC_CFG['IRetailerOrderItemsTTC']['TimeOut']	= 1;
$_TTC_CFG['IRetailerOrderItemsTTC']['KEY']		= 'uid';
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']	= array();//数据类型，int=1,string=2,binary=3
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['uid'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['order_char_id'] = array('type' => 2, 'min' => 0, 'max' => 32);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['item_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['product_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['wh_id'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['product_char_id'] = array('type' => 2, 'min' => 0, 'max' => 32);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['name'] = array('type' => 2, 'min' => 0, 'max' => 640);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['flag'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['type'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['type2'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['weight'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['buy_num'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['points'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['points_pay'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['point_type'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['discount'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['price'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['cash_back'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['cost'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['warranty'] = array('type' => 2, 'min' => 0, 'max' => 1000);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['expect_num'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['create_time'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['product_type'] = array('type' => 1, 'min' => -128, 'max' => 127);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['use_virtual_stock'] = array('type' => 1, 'min' => -128, 'max' => 127);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['main_product_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['updatetime'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['edm_code'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['apportToPm'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['apportToMkt'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['OTag'] = array('type' => 2, 'min' => 0, 'max' => 200);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['shop_guide_cost'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['package_ids'] = array('type' => 2, 'min' => 0, 'max' => 1000);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['business_unit_cost'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['cost_pre'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['cost_type'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['guide_cost_pre'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRetailerOrderItemsTTC']['FIELDS']['business_unit_cost_pre'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);

class IRetailerOrderItemsTTC
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
	 * 		'uid' =>  XXX,
	 * 		'order_char_id' => 'XXX',
	 * 		'item_id' =>  XXX,
	 * 		'product_id' =>  XXX,
	 * 		'wh_id' =>  XXX,
	 * 		'product_char_id' => 'XXX',
	 * 		'name' => 'XXX',
	 * 		'flag' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'type2' =>  XXX,
	 * 		'weight' =>  XXX,
	 * 		'buy_num' =>  XXX,
	 * 		'points' =>  XXX,
	 * 		'points_pay' =>  XXX,
	 * 		'point_type' =>  XXX,
	 * 		'discount' =>  XXX,
	 * 		'price' =>  XXX,
	 * 		'cash_back' =>  XXX,
	 * 		'cost' =>  XXX,
	 * 		'warranty' => 'XXX',
	 * 		'expect_num' =>  XXX,
	 * 		'create_time' =>  XXX,
	 * 		'product_type' =>  XXX,
	 * 		'use_virtual_stock' =>  XXX,
	 * 		'main_product_id' =>  XXX,
	 * 		'updatetime' =>  XXX,
	 * 		'edm_code' => 'XXX',
	 * 		'apportToPm' =>  XXX,
	 * 		'apportToMkt' =>  XXX,
	 * 		'OTag' => 'XXX',
	 * 		'shop_guide_cost' =>  XXX,
	 * 		'package_ids' => 'XXX',
	 * 		'business_unit_cost' =>  XXX,
	 * 		'cost_pre' =>  XXX,
	 * 		'cost_type' =>  XXX,
	 * 		'guide_cost_pre' =>  XXX,
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
		$ttc = Config::getTTC('IRetailerOrderItemsTTC');
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
	 * 		'order_char_id' => 'XXX',
	 * 		'item_id' =>  XXX,
	 * 		'product_id' =>  XXX,
	 * 		'wh_id' =>  XXX,
	 * 		'product_char_id' => 'XXX',
	 * 		'name' => 'XXX',
	 * 		'flag' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'type2' =>  XXX,
	 * 		'weight' =>  XXX,
	 * 		'buy_num' =>  XXX,
	 * 		'points' =>  XXX,
	 * 		'points_pay' =>  XXX,
	 * 		'point_type' =>  XXX,
	 * 		'discount' =>  XXX,
	 * 		'price' =>  XXX,
	 * 		'cash_back' =>  XXX,
	 * 		'cost' =>  XXX,
	 * 		'warranty' => 'XXX',
	 * 		'expect_num' =>  XXX,
	 * 		'create_time' =>  XXX,
	 * 		'product_type' =>  XXX,
	 * 		'use_virtual_stock' =>  XXX,
	 * 		'main_product_id' =>  XXX,
	 * 		'updatetime' =>  XXX,
	 * 		'edm_code' => 'XXX',
	 * 		'apportToPm' =>  XXX,
	 * 		'apportToMkt' =>  XXX,
	 * 		'OTag' => 'XXX',
	 * 		'shop_guide_cost' =>  XXX,
	 * 		'package_ids' => 'XXX',
	 * 		'business_unit_cost' =>  XXX,
	 * 		'cost_pre' =>  XXX,
	 * 		'cost_type' =>  XXX,
	 * 		'guide_cost_pre' =>  XXX,
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
		$ttc = Config::getTTC('IRetailerOrderItemsTTC');
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
		$ttc = Config::getTTC('IRetailerOrderItemsTTC');
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
	 * 		'order_char_id' => 'XXX',
	 * 		'item_id' =>  XXX,
	 * 		'product_id' =>  XXX,
	 * 		'wh_id' =>  XXX,
	 * 		'product_char_id' => 'XXX',
	 * 		'name' => 'XXX',
	 * 		'flag' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'type2' =>  XXX,
	 * 		'weight' =>  XXX,
	 * 		'buy_num' =>  XXX,
	 * 		'points' =>  XXX,
	 * 		'points_pay' =>  XXX,
	 * 		'point_type' =>  XXX,
	 * 		'discount' =>  XXX,
	 * 		'price' =>  XXX,
	 * 		'cash_back' =>  XXX,
	 * 		'cost' =>  XXX,
	 * 		'warranty' => 'XXX',
	 * 		'expect_num' =>  XXX,
	 * 		'create_time' =>  XXX,
	 * 		'product_type' =>  XXX,
	 * 		'use_virtual_stock' =>  XXX,
	 * 		'main_product_id' =>  XXX,
	 * 		'updatetime' =>  XXX,
	 * 		'edm_code' => 'XXX',
	 * 		'apportToPm' =>  XXX,
	 * 		'apportToMkt' =>  XXX,
	 * 		'OTag' => 'XXX',
	 * 		'shop_guide_cost' =>  XXX,
	 * 		'package_ids' => 'XXX',
	 * 		'business_unit_cost' =>  XXX,
	 * 		'cost_pre' =>  XXX,
	 * 		'cost_type' =>  XXX,
	 * 		'guide_cost_pre' =>  XXX,
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
		$ttc = Config::getTTC('IRetailerOrderItemsTTC');
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
		$ttc = Config::getTTC2('IRetailerOrderItemsTTC');
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
		$ttc = Config::getTTC('IRetailerOrderItemsTTC');
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
		$ttc = Config::getTTC('IRetailerOrderItemsTTC');
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

