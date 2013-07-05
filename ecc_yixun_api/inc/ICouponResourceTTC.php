<?php
/**
 * ICouponResourceTTC.php
 * ��TTC:t_coupon_resource�������顢ɾ���ĵȲ���
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	ixiuzeng
 */

global $_TTC_CFG;

$_TTC_CFG['ICouponResourceTTC']['TTCKEY']	= 'ICouponResourceTTC';
$_TTC_CFG['ICouponResourceTTC']['TABLE']	= 't_coupon_resource';
$_TTC_CFG['ICouponResourceTTC']['TimeOut']	= 1;
$_TTC_CFG['ICouponResourceTTC']['KEY']		= 'batch';
$_TTC_CFG['ICouponResourceTTC']['FIELDS']	= array();//�������ͣ�int=1,string=2,binary=3
$_TTC_CFG['ICouponResourceTTC']['FIELDS']['batch'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICouponResourceTTC']['FIELDS']['wh_id'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICouponResourceTTC']['FIELDS']['num'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICouponResourceTTC']['FIELDS']['num_pubed'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICouponResourceTTC']['FIELDS']['coupon_code'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['ICouponResourceTTC']['FIELDS']['coupon_type'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICouponResourceTTC']['FIELDS']['coupon_name'] = array('type' => 2, 'min' => 0, 'max' => 400);
$_TTC_CFG['ICouponResourceTTC']['FIELDS']['coupon_amt'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICouponResourceTTC']['FIELDS']['sale_amt'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICouponResourceTTC']['FIELDS']['valid_time_from'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['ICouponResourceTTC']['FIELDS']['valid_time_to'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['ICouponResourceTTC']['FIELDS']['max_use_times'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICouponResourceTTC']['FIELDS']['status'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICouponResourceTTC']['FIELDS']['category'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['ICouponResourceTTC']['FIELDS']['productids'] = array('type' => 2, 'min' => 0, 'max' => 3000);
$_TTC_CFG['ICouponResourceTTC']['FIELDS']['manufactory'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['ICouponResourceTTC']['FIELDS']['user_grade'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['ICouponResourceTTC']['FIELDS']['need_mail_verify'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICouponResourceTTC']['FIELDS']['need_mobile_verify'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICouponResourceTTC']['FIELDS']['create_user'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['ICouponResourceTTC']['FIELDS']['create_time'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['ICouponResourceTTC']['FIELDS']['audit_user'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['ICouponResourceTTC']['FIELDS']['audit_time'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['ICouponResourceTTC']['FIELDS']['account_type'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);

class ICouponResourceTTC
{
	/**
	 * �������
	 */
	public static $errCode = 0;

	/**
	 * ������Ϣ
	 */
	public static $errMsg  = '';

	/**
	 * ttc��¼Map
	 */
	public static $ttcMap  = array();


	/**
	 * ��������ʶ����ÿ����������ǰ����
	 */
	private static function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}

	/**
	 * ����һ��TTC��¼
	 * 
	 * @param	$param ��ʽ: 
	 * 	array(
	 * 		'batch' =>  XXX,
	 * 		'wh_id' =>  XXX,
	 * 		'num' =>  XXX,
	 * 		'num_pubed' =>  XXX,
	 * 		'coupon_code' => 'XXX',
	 * 		'coupon_type' =>  XXX,
	 * 		'coupon_name' => 'XXX',
	 * 		'coupon_amt' =>  XXX,
	 * 		'sale_amt' =>  XXX,
	 * 		'valid_time_from' =>  XXX,
	 * 		'valid_time_to' =>  XXX,
	 * 		'max_use_times' =>  XXX,
	 * 		'status' =>  XXX,
	 * 		'category' => 'XXX',
	 * 		'productids' => 'XXX',
	 * 		'manufactory' => 'XXX',
	 * 		'user_grade' => 'XXX',
	 * 		'need_mail_verify' =>  XXX,
	 * 		'need_mobile_verify' =>  XXX,
	 * 		'create_user' => 'XXX',
	 * 		'create_time' =>  XXX,
	 * 		'audit_user' => 'XXX',
	 * 		'audit_time' =>  XXX,
	 * 		'account_type' =>  XXX,
	 * 		)
	 * 
	 * ����ֵ����ȷ����true�����󷵻�false
	 */
	public static function insert($param)
	{
		self::clearErr();
		
		if(empty($param) || !is_array($param))
		{
			self::$errCode = 111;
			self::$errMsg  = 'param is empty';
		}
		$ttc = Config::getTTC('ICouponResourceTTC');
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
	 * ����һ��TTC��¼
	 * 
	 * @param	$param ��ʽ: 
	 * 	array(
	 * 		'batch' =>  XXX,
	 * 		'wh_id' =>  XXX,
	 * 		'num' =>  XXX,
	 * 		'num_pubed' =>  XXX,
	 * 		'coupon_code' => 'XXX',
	 * 		'coupon_type' =>  XXX,
	 * 		'coupon_name' => 'XXX',
	 * 		'coupon_amt' =>  XXX,
	 * 		'sale_amt' =>  XXX,
	 * 		'valid_time_from' =>  XXX,
	 * 		'valid_time_to' =>  XXX,
	 * 		'max_use_times' =>  XXX,
	 * 		'status' =>  XXX,
	 * 		'category' => 'XXX',
	 * 		'productids' => 'XXX',
	 * 		'manufactory' => 'XXX',
	 * 		'user_grade' => 'XXX',
	 * 		'need_mail_verify' =>  XXX,
	 * 		'need_mobile_verify' =>  XXX,
	 * 		'create_user' => 'XXX',
	 * 		'create_time' =>  XXX,
	 * 		'audit_user' => 'XXX',
	 * 		'audit_time' =>  XXX,
	 * 		'account_type' =>  XXX,
	 * 		)
	 * 
	 * ����ֵ����ȷ����true�����󷵻�false
	 */
	public static function update($param, $filter = array())
	{
		self::clearErr();
		
		if(empty($param) || !is_array($param))
		{
			self::$errCode = 111;
			self::$errMsg  = 'param is empty';
		}
		$ttc = Config::getTTC('ICouponResourceTTC');
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
	 * ɾ��һ��TTC��¼
	 * 
	 * @param   string  $key		���ݿ������
	 * 
	 * ����ֵ����ȷ����true�����󷵻�false
	 */
	public static function remove($key, $filter= array())
	{
		self::clearErr();
		
		if(empty($key))
		{
			self::$errCode = 111;
			self::$errMsg  = 'key is empty';
		}
		$ttc = Config::getTTC('ICouponResourceTTC');
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
	 * ȡһ��TTC��¼
	 * 
	 * @param   string  $key		���ݿ������
	 * @param   array   $multikey	��ѡ����, ���ֶ�keyʱ��ѡ, ����array('field2' => 1, 'field3' => 2)
	 * 
	 * ����ֵ����ȷ�������ݣ����󷵻�false
	 * ���ݸ�ʽ:
	 * 	array(
	 * 		'batch' =>  XXX,
	 * 		'wh_id' =>  XXX,
	 * 		'num' =>  XXX,
	 * 		'num_pubed' =>  XXX,
	 * 		'coupon_code' => 'XXX',
	 * 		'coupon_type' =>  XXX,
	 * 		'coupon_name' => 'XXX',
	 * 		'coupon_amt' =>  XXX,
	 * 		'sale_amt' =>  XXX,
	 * 		'valid_time_from' =>  XXX,
	 * 		'valid_time_to' =>  XXX,
	 * 		'max_use_times' =>  XXX,
	 * 		'status' =>  XXX,
	 * 		'category' => 'XXX',
	 * 		'productids' => 'XXX',
	 * 		'manufactory' => 'XXX',
	 * 		'user_grade' => 'XXX',
	 * 		'need_mail_verify' =>  XXX,
	 * 		'need_mobile_verify' =>  XXX,
	 * 		'create_user' => 'XXX',
	 * 		'create_time' =>  XXX,
	 * 		'audit_user' => 'XXX',
	 * 		'audit_time' =>  XXX,
	 * 		'account_type' =>  XXX,
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
		$ttc = Config::getTTC('ICouponResourceTTC');
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
	 * ����ȡTTC��¼
	 * 
	 * @param   string  $keys		���ݿ����������
	 * 
	 * ����ֵ����ȷ�������ݣ����󷵻�false
	 */
	public static function gets($keys, $filter=array(), $need=array())
	{
		self::clearErr();
		
		if(empty($keys) || !is_array($keys))
		{
			self::$errCode = 111;
			self::$errMsg  = 'keys is empty';
		}
		$ttc = Config::getTTC2('ICouponResourceTTC');
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
	 * ȡ����TTCӰ�������
	 * 
	 * 
	 * ����ֵ����ȷ����>-1�����������󷵻ظ���
	 */
	public static function getTTCAffectRows()
	{
		$ttc = Config::getTTC('ICouponResourceTTC');
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

