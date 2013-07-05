<?php
/**
 * ICPSMerchantsTTC.php
 * ��TTC:t_cps_merchants�������顢ɾ���ĵȲ���
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	zhiliu
 */

global $_TTC_CFG;

$_TTC_CFG['ICPSMerchantsTTC']['TTCKEY']	= 'ICPSMerchantsTTC';
$_TTC_CFG['ICPSMerchantsTTC']['TABLE']	= 't_cps_merchants';
$_TTC_CFG['ICPSMerchantsTTC']['TimeOut']	= 1;
$_TTC_CFG['ICPSMerchantsTTC']['KEY']		= 'mid';
$_TTC_CFG['ICPSMerchantsTTC']['FIELDS']	= array();//�������ͣ�int=1,string=2,binary=3
$_TTC_CFG['ICPSMerchantsTTC']['FIELDS']['mid'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['ICPSMerchantsTTC']['FIELDS']['sysid'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['ICPSMerchantsTTC']['FIELDS']['nickname'] = array('type' => 2, 'min' => 0, 'max' => 30);
$_TTC_CFG['ICPSMerchantsTTC']['FIELDS']['type'] = array('type' => 2, 'min' => 0, 'max' => 10);
$_TTC_CFG['ICPSMerchantsTTC']['FIELDS']['password'] = array('type' => 2, 'min' => 0, 'max' => 32);
$_TTC_CFG['ICPSMerchantsTTC']['FIELDS']['keycode'] = array('type' => 2, 'min' => 0, 'max' => 32);
$_TTC_CFG['ICPSMerchantsTTC']['FIELDS']['website'] = array('type' => 2, 'min' => 0, 'max' => 50);
$_TTC_CFG['ICPSMerchantsTTC']['FIELDS']['qq'] = array('type' => 2, 'min' => 0, 'max' => 15);
$_TTC_CFG['ICPSMerchantsTTC']['FIELDS']['email'] = array('type' => 2, 'min' => 0, 'max' => 30);
$_TTC_CFG['ICPSMerchantsTTC']['FIELDS']['tel'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['ICPSMerchantsTTC']['FIELDS']['contact'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['ICPSMerchantsTTC']['FIELDS']['address'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['ICPSMerchantsTTC']['FIELDS']['last_login'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['ICPSMerchantsTTC']['FIELDS']['last_ip'] = array('type' => 2, 'min' => 0, 'max' => 15);
$_TTC_CFG['ICPSMerchantsTTC']['FIELDS']['login_times'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['ICPSMerchantsTTC']['FIELDS']['status'] = array('type' => 1, 'min' => 0, 'max' => 255);
$_TTC_CFG['ICPSMerchantsTTC']['FIELDS']['is_email'] = array('type' => 1, 'min' => 0, 'max' => 255);
$_TTC_CFG['ICPSMerchantsTTC']['FIELDS']['is_url'] = array('type' => 1, 'min' => 0, 'max' => 255);
$_TTC_CFG['ICPSMerchantsTTC']['FIELDS']['remark'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['ICPSMerchantsTTC']['FIELDS']['addtime'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);

class ICPSMerchantsTTC
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
	 * 		'mid' =>  XXX,
	 * 		'sysid' => 'XXX',
	 * 		'nickname' => 'XXX',
	 * 		'type' => 'XXX',
	 * 		'password' => 'XXX',
	 * 		'keycode' => 'XXX',
	 * 		'website' => 'XXX',
	 * 		'qq' => 'XXX',
	 * 		'email' => 'XXX',
	 * 		'tel' => 'XXX',
	 * 		'contact' => 'XXX',
	 * 		'address' => 'XXX',
	 * 		'last_login' =>  XXX,
	 * 		'last_ip' => 'XXX',
	 * 		'login_times' =>  XXX,
	 * 		'status' =>  XXX,
	 * 		'is_email' =>  XXX,
	 * 		'is_url' =>  XXX,
	 * 		'remark' => 'XXX',
	 * 		'addtime' =>  XXX,
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
		$ttc = Config::getTTC('ICPSMerchantsTTC');
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
	 * ����һ��TTC��¼
	 * 
	 * @param	$param ��ʽ: 
	 * 	array(
	 * 		'mid' =>  XXX,
	 * 		'sysid' => 'XXX',
	 * 		'nickname' => 'XXX',
	 * 		'type' => 'XXX',
	 * 		'password' => 'XXX',
	 * 		'keycode' => 'XXX',
	 * 		'website' => 'XXX',
	 * 		'qq' => 'XXX',
	 * 		'email' => 'XXX',
	 * 		'tel' => 'XXX',
	 * 		'contact' => 'XXX',
	 * 		'address' => 'XXX',
	 * 		'last_login' =>  XXX,
	 * 		'last_ip' => 'XXX',
	 * 		'login_times' =>  XXX,
	 * 		'status' =>  XXX,
	 * 		'is_email' =>  XXX,
	 * 		'is_url' =>  XXX,
	 * 		'remark' => 'XXX',
	 * 		'addtime' =>  XXX,
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
		$ttc = Config::getTTC('ICPSMerchantsTTC');
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
		$ttc = Config::getTTC('ICPSMerchantsTTC');
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
	 * 		'mid' =>  XXX,
	 * 		'sysid' => 'XXX',
	 * 		'nickname' => 'XXX',
	 * 		'type' => 'XXX',
	 * 		'password' => 'XXX',
	 * 		'keycode' => 'XXX',
	 * 		'website' => 'XXX',
	 * 		'qq' => 'XXX',
	 * 		'email' => 'XXX',
	 * 		'tel' => 'XXX',
	 * 		'contact' => 'XXX',
	 * 		'address' => 'XXX',
	 * 		'last_login' =>  XXX,
	 * 		'last_ip' => 'XXX',
	 * 		'login_times' =>  XXX,
	 * 		'status' =>  XXX,
	 * 		'is_email' =>  XXX,
	 * 		'is_url' =>  XXX,
	 * 		'remark' => 'XXX',
	 * 		'addtime' =>  XXX,
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
		$ttc = Config::getTTC('ICPSMerchantsTTC');
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
		$ttc = Config::getTTC2('ICPSMerchantsTTC');
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
		$ttc = Config::getTTC('ICPSMerchantsTTC');
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

