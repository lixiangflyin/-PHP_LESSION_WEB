<?php
/**
 * ICouponTTC.php
 * 对TTC:t_coupon_的赠、查、删、改等操作
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	ixiuzeng
 */

global $_TTC_CFG;

$_TTC_CFG['ICouponTTC']['TTCKEY']	= 'ICouponTTC';
$_TTC_CFG['ICouponTTC']['TABLE']	= 't_coupon_';
$_TTC_CFG['ICouponTTC']['TimeOut']	= 1;
$_TTC_CFG['ICouponTTC']['KEY']		= 'coupon_code';
$_TTC_CFG['ICouponTTC']['FIELDS']	= array();//数据类型，int=1,string=2,binary=3
$_TTC_CFG['ICouponTTC']['FIELDS']['coupon_code'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['ICouponTTC']['FIELDS']['coupon_id'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['ICouponTTC']['FIELDS']['coupon_name'] = array('type' => 2, 'min' => 0, 'max' => 400);
$_TTC_CFG['ICouponTTC']['FIELDS']['coupon_amt'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICouponTTC']['FIELDS']['sale_amt'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICouponTTC']['FIELDS']['coupon_type'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICouponTTC']['FIELDS']['valid_time_from'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['ICouponTTC']['FIELDS']['valid_time_to'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['ICouponTTC']['FIELDS']['max_use_degree'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICouponTTC']['FIELDS']['used_degree'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICouponTTC']['FIELDS']['used_time'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['ICouponTTC']['FIELDS']['batchno'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICouponTTC']['FIELDS']['status'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICouponTTC']['FIELDS']['category_coll'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['ICouponTTC']['FIELDS']['product_coll'] = array('type' => 2, 'min' => 0, 'max' => 3000);
$_TTC_CFG['ICouponTTC']['FIELDS']['manufactory_coll'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['ICouponTTC']['FIELDS']['area_coll'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['ICouponTTC']['FIELDS']['user_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['ICouponTTC']['FIELDS']['user_grade_coll'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['ICouponTTC']['FIELDS']['pay_type'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICouponTTC']['FIELDS']['allow_use_time'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICouponTTC']['FIELDS']['need_mail_verify'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICouponTTC']['FIELDS']['need_mobile_verify'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICouponTTC']['FIELDS']['wh_id'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICouponTTC']['FIELDS']['account_type'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICouponTTC']['FIELDS']['flag'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);

class ICouponTTC
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
	 * 		'coupon_code' => 'XXX',
	 * 		'coupon_id' => 'XXX',
	 * 		'coupon_name' => 'XXX',
	 * 		'coupon_amt' =>  XXX,
	 * 		'sale_amt' =>  XXX,
	 * 		'coupon_type' =>  XXX,
	 * 		'valid_time_from' =>  XXX,
	 * 		'valid_time_to' =>  XXX,
	 * 		'max_use_degree' =>  XXX,
	 * 		'used_degree' =>  XXX,
	 * 		'used_time' =>  XXX,
	 * 		'batchno' =>  XXX,
	 * 		'status' =>  XXX,
	 * 		'category_coll' => 'XXX',
	 * 		'product_coll' => 'XXX',
	 * 		'manufactory_coll' => 'XXX',
	 * 		'area_coll' => 'XXX',
	 * 		'user_id' =>  XXX,
	 * 		'user_grade_coll' => 'XXX',
	 * 		'pay_type' =>  XXX,
	 * 		'allow_use_time' =>  XXX,
	 * 		'need_mail_verify' =>  XXX,
	 * 		'need_mobile_verify' =>  XXX,
	 * 		'wh_id' =>  XXX,
	 * 		'account_type' =>  XXX,
	 * 		'flag' =>  XXX,
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
		$ttc = Config::getTTC('ICouponTTC');
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

		if(!empty(self::$ttcMap[$param['coupon_code']]))
		{
			unset(self::$ttcMap[$param['coupon_code']]);
		}

		return $v;
	}

	/**
	 * 更新一条TTC记录
	 * 
	 * @param	$param 格式: 
	 * 	array(
	 * 		'coupon_code' => 'XXX',
	 * 		'coupon_id' => 'XXX',
	 * 		'coupon_name' => 'XXX',
	 * 		'coupon_amt' =>  XXX,
	 * 		'sale_amt' =>  XXX,
	 * 		'coupon_type' =>  XXX,
	 * 		'valid_time_from' =>  XXX,
	 * 		'valid_time_to' =>  XXX,
	 * 		'max_use_degree' =>  XXX,
	 * 		'used_degree' =>  XXX,
	 * 		'used_time' =>  XXX,
	 * 		'batchno' =>  XXX,
	 * 		'status' =>  XXX,
	 * 		'category_coll' => 'XXX',
	 * 		'product_coll' => 'XXX',
	 * 		'manufactory_coll' => 'XXX',
	 * 		'area_coll' => 'XXX',
	 * 		'user_id' =>  XXX,
	 * 		'user_grade_coll' => 'XXX',
	 * 		'pay_type' =>  XXX,
	 * 		'allow_use_time' =>  XXX,
	 * 		'need_mail_verify' =>  XXX,
	 * 		'need_mobile_verify' =>  XXX,
	 * 		'wh_id' =>  XXX,
	 * 		'account_type' =>  XXX,
	 * 		'flag' =>  XXX,
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
		$ttc = Config::getTTC('ICouponTTC');
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

		if(!empty(self::$ttcMap[$param['coupon_code']]))
		{
			unset(self::$ttcMap[$param['coupon_code']]);
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
		$ttc = Config::getTTC('ICouponTTC');
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
	 * 		'coupon_code' => 'XXX',
	 * 		'coupon_id' => 'XXX',
	 * 		'coupon_name' => 'XXX',
	 * 		'coupon_amt' =>  XXX,
	 * 		'sale_amt' =>  XXX,
	 * 		'coupon_type' =>  XXX,
	 * 		'valid_time_from' =>  XXX,
	 * 		'valid_time_to' =>  XXX,
	 * 		'max_use_degree' =>  XXX,
	 * 		'used_degree' =>  XXX,
	 * 		'used_time' =>  XXX,
	 * 		'batchno' =>  XXX,
	 * 		'status' =>  XXX,
	 * 		'category_coll' => 'XXX',
	 * 		'product_coll' => 'XXX',
	 * 		'manufactory_coll' => 'XXX',
	 * 		'area_coll' => 'XXX',
	 * 		'user_id' =>  XXX,
	 * 		'user_grade_coll' => 'XXX',
	 * 		'pay_type' =>  XXX,
	 * 		'allow_use_time' =>  XXX,
	 * 		'need_mail_verify' =>  XXX,
	 * 		'need_mobile_verify' =>  XXX,
	 * 		'wh_id' =>  XXX,
	 * 		'account_type' =>  XXX,
	 * 		'flag' =>  XXX,
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
		$ttc = Config::getTTC('ICouponTTC');
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
		$ttc = Config::getTTC2('ICouponTTC');
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
		$ttc = Config::getTTC('ICouponTTC');
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

