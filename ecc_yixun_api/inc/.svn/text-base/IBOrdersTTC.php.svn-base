<?php
/**
 * IBOrdersTTC.php
 * 对TTC:t_borders_的赠、查、删、改等操作
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	root
 */

global $_TTC_CFG;

$_TTC_CFG['IBOrdersTTC']['TTCKEY']	= 'IBOrdersTTC';
$_TTC_CFG['IBOrdersTTC']['TABLE']	= 't_borders_';
$_TTC_CFG['IBOrdersTTC']['TimeOut']	= 1;
$_TTC_CFG['IBOrdersTTC']['KEY']		= 'uid';
$_TTC_CFG['IBOrdersTTC']['FIELDS']	= array();//数据类型，int=1,string=2,binary=3
$_TTC_CFG['IBOrdersTTC']['FIELDS']['uid'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['order_char_id'] = array('type' => 2, 'min' => 0, 'max' => 32);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['order_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['status'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['flag'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['hw_id'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['order_date'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['source'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['type'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['shipping_cost'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['premium_cost'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['shipping_type'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['pay_time'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['pay_type'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['prcd_cost'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['order_cost'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['price_cut'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['coupon_type'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['coupon_code'] = array('type' => 2, 'min' => 0, 'max' => 32);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['coupon_amt'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['point'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['point_pay'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['cash'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['receiver'] = array('type' => 2, 'min' => 0, 'max' => 32);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['receiver_tel'] = array('type' => 2, 'min' => 0, 'max' => 64);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['receiver_mobile'] = array('type' => 2, 'min' => 0, 'max' => 16);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['receiver_zip'] = array('type' => 2, 'min' => 0, 'max' => 16);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['receiver_addr_id'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['receiver_addr'] = array('type' => 2, 'min' => 0, 'max' => 256);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['expect_dly_date'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['expect_dly_time_span'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['comment'] = array('type' => 2, 'min' => 0, 'max' => 65535);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['update_time'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['isPayed'] = array('type' => 1, 'min' => -128, 'max' => 127);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['out_time'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['sign_by_other'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['installment_bank'] = array('type' => 2, 'min' => 0, 'max' => 40);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['installment_num'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['cash_per_month'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['rate'] = array('type' => 4, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['back_rate'] = array('type' => 4, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['cpsinfo'] = array('type' => 2, 'min' => 0, 'max' => 512);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['visitkey'] = array('type' => 2, 'min' => 0, 'max' => 40);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['ls'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['pOrderId'] = array('type' => 2, 'min' => 0, 'max' => 32);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['subOrderNum'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['stockNo'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['deliveryMemo'] = array('type' => 2, 'min' => 0, 'max' => 16);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['promotion_point'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['cash_point'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['shop_guide_cost'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['shop_guide_id'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['shop_guide_name'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['shop_id'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['is_vat'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['single_promotion_info'] = array('type' => 2, 'min' => 0, 'max' => 400);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['ingoreLackOfGift'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBOrdersTTC']['FIELDS']['real_order_id'] = array('type' => 2, 'min' => 0, 'max' => 32);

class IBOrdersTTC
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
	 * 		'order_id' =>  XXX,
	 * 		'status' =>  XXX,
	 * 		'flag' =>  XXX,
	 * 		'hw_id' =>  XXX,
	 * 		'order_date' =>  XXX,
	 * 		'source' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'shipping_cost' =>  XXX,
	 * 		'premium_cost' =>  XXX,
	 * 		'shipping_type' =>  XXX,
	 * 		'pay_time' =>  XXX,
	 * 		'pay_type' =>  XXX,
	 * 		'prcd_cost' =>  XXX,
	 * 		'order_cost' =>  XXX,
	 * 		'price_cut' =>  XXX,
	 * 		'coupon_type' =>  XXX,
	 * 		'coupon_code' => 'XXX',
	 * 		'coupon_amt' =>  XXX,
	 * 		'point' =>  XXX,
	 * 		'point_pay' =>  XXX,
	 * 		'cash' =>  XXX,
	 * 		'receiver' => 'XXX',
	 * 		'receiver_tel' => 'XXX',
	 * 		'receiver_mobile' => 'XXX',
	 * 		'receiver_zip' => 'XXX',
	 * 		'receiver_addr_id' =>  XXX,
	 * 		'receiver_addr' => 'XXX',
	 * 		'expect_dly_date' =>  XXX,
	 * 		'expect_dly_time_span' =>  XXX,
	 * 		'comment' => 'XXX',
	 * 		'update_time' =>  XXX,
	 * 		'isPayed' =>  XXX,
	 * 		'out_time' =>  XXX,
	 * 		'sign_by_other' =>  XXX,
	 * 		'installment_bank' => 'XXX',
	 * 		'installment_num' =>  XXX,
	 * 		'cash_per_month' =>  XXX,
	 * 		'rate' => 'XXX',
	 * 		'back_rate' => 'XXX',
	 * 		'cpsinfo' => 'XXX',
	 * 		'visitkey' => 'XXX',
	 * 		'ls' => 'XXX',
	 * 		'pOrderId' => 'XXX',
	 * 		'subOrderNum' =>  XXX,
	 * 		'stockNo' =>  XXX,
	 * 		'deliveryMemo' => 'XXX',
	 * 		'promotion_point' =>  XXX,
	 * 		'cash_point' =>  XXX,
	 * 		'shop_guide_cost' =>  XXX,
	 * 		'shop_guide_id' =>  XXX,
	 * 		'shop_guide_name' => 'XXX',
	 * 		'shop_id' =>  XXX,
	 * 		'is_vat' =>  XXX,
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
		$ttc = Config::getTTC('IBOrdersTTC');
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
	 * 		'order_id' =>  XXX,
	 * 		'status' =>  XXX,
	 * 		'flag' =>  XXX,
	 * 		'hw_id' =>  XXX,
	 * 		'order_date' =>  XXX,
	 * 		'source' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'shipping_cost' =>  XXX,
	 * 		'premium_cost' =>  XXX,
	 * 		'shipping_type' =>  XXX,
	 * 		'pay_time' =>  XXX,
	 * 		'pay_type' =>  XXX,
	 * 		'prcd_cost' =>  XXX,
	 * 		'order_cost' =>  XXX,
	 * 		'price_cut' =>  XXX,
	 * 		'coupon_type' =>  XXX,
	 * 		'coupon_code' => 'XXX',
	 * 		'coupon_amt' =>  XXX,
	 * 		'point' =>  XXX,
	 * 		'point_pay' =>  XXX,
	 * 		'cash' =>  XXX,
	 * 		'receiver' => 'XXX',
	 * 		'receiver_tel' => 'XXX',
	 * 		'receiver_mobile' => 'XXX',
	 * 		'receiver_zip' => 'XXX',
	 * 		'receiver_addr_id' =>  XXX,
	 * 		'receiver_addr' => 'XXX',
	 * 		'expect_dly_date' =>  XXX,
	 * 		'expect_dly_time_span' =>  XXX,
	 * 		'comment' => 'XXX',
	 * 		'update_time' =>  XXX,
	 * 		'isPayed' =>  XXX,
	 * 		'out_time' =>  XXX,
	 * 		'sign_by_other' =>  XXX,
	 * 		'installment_bank' => 'XXX',
	 * 		'installment_num' =>  XXX,
	 * 		'cash_per_month' =>  XXX,
	 * 		'rate' => 'XXX',
	 * 		'back_rate' => 'XXX',
	 * 		'cpsinfo' => 'XXX',
	 * 		'visitkey' => 'XXX',
	 * 		'ls' => 'XXX',
	 * 		'pOrderId' => 'XXX',
	 * 		'subOrderNum' =>  XXX,
	 * 		'stockNo' =>  XXX,
	 * 		'deliveryMemo' => 'XXX',
	 * 		'promotion_point' =>  XXX,
	 * 		'cash_point' =>  XXX,
	 * 		'shop_guide_cost' =>  XXX,
	 * 		'shop_guide_id' =>  XXX,
	 * 		'shop_guide_name' => 'XXX',
	 * 		'shop_id' =>  XXX,
	 * 		'is_vat' =>  XXX,
	 *      '' =>
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
		$ttc = Config::getTTC('IBOrdersTTC');
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
		$ttc = Config::getTTC('IBOrdersTTC');
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
	 * 		'order_id' =>  XXX,
	 * 		'status' =>  XXX,
	 * 		'flag' =>  XXX,
	 * 		'hw_id' =>  XXX,
	 * 		'order_date' =>  XXX,
	 * 		'source' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'shipping_cost' =>  XXX,
	 * 		'premium_cost' =>  XXX,
	 * 		'shipping_type' =>  XXX,
	 * 		'pay_time' =>  XXX,
	 * 		'pay_type' =>  XXX,
	 * 		'prcd_cost' =>  XXX,
	 * 		'order_cost' =>  XXX,
	 * 		'price_cut' =>  XXX,
	 * 		'coupon_type' =>  XXX,
	 * 		'coupon_code' => 'XXX',
	 * 		'coupon_amt' =>  XXX,
	 * 		'point' =>  XXX,
	 * 		'point_pay' =>  XXX,
	 * 		'cash' =>  XXX,
	 * 		'receiver' => 'XXX',
	 * 		'receiver_tel' => 'XXX',
	 * 		'receiver_mobile' => 'XXX',
	 * 		'receiver_zip' => 'XXX',
	 * 		'receiver_addr_id' =>  XXX,
	 * 		'receiver_addr' => 'XXX',
	 * 		'expect_dly_date' =>  XXX,
	 * 		'expect_dly_time_span' =>  XXX,
	 * 		'comment' => 'XXX',
	 * 		'update_time' =>  XXX,
	 * 		'isPayed' =>  XXX,
	 * 		'out_time' =>  XXX,
	 * 		'sign_by_other' =>  XXX,
	 * 		'installment_bank' => 'XXX',
	 * 		'installment_num' =>  XXX,
	 * 		'cash_per_month' =>  XXX,
	 * 		'rate' => 'XXX',
	 * 		'back_rate' => 'XXX',
	 * 		'cpsinfo' => 'XXX',
	 * 		'visitkey' => 'XXX',
	 * 		'ls' => 'XXX',
	 * 		'pOrderId' => 'XXX',
	 * 		'subOrderNum' =>  XXX,
	 * 		'stockNo' =>  XXX,
	 * 		'deliveryMemo' => 'XXX',
	 * 		'promotion_point' =>  XXX,
	 * 		'cash_point' =>  XXX,
	 * 		'shop_guide_cost' =>  XXX,
	 * 		'shop_guide_id' =>  XXX,
	 * 		'shop_guide_name' => 'XXX',
	 * 		'shop_id' =>  XXX,
	 * 		'is_vat' =>  XXX,
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
		$ttc = Config::getTTC('IBOrdersTTC');
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
		$ttc = Config::getTTC2('IBOrdersTTC');
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
		$ttc = Config::getTTC('IBOrdersTTC');
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

