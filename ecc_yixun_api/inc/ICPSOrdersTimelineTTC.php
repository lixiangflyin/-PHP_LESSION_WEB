<?php
/**
 * ICPSOrdersTimelineTTC.php
 * ��TTC:t_cps_orders_timeline_�������顢ɾ���ĵȲ���
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	zhiliu
 */

global $_TTC_CFG;

$_TTC_CFG['ICPSOrdersTimelineTTC']['TTCKEY']	= 'ICPSOrdersTimelineTTC';
$_TTC_CFG['ICPSOrdersTimelineTTC']['TABLE']	= 't_cps_orders_timeline_';
$_TTC_CFG['ICPSOrdersTimelineTTC']['TimeOut']	= 1;
$_TTC_CFG['ICPSOrdersTimelineTTC']['KEY']		= 'order_id';
$_TTC_CFG['ICPSOrdersTimelineTTC']['FIELDS']	= array();//�������ͣ�int=1,string=2,binary=3
$_TTC_CFG['ICPSOrdersTimelineTTC']['FIELDS']['order_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['ICPSOrdersTimelineTTC']['FIELDS']['type'] = array('type' => 1, 'min' => 0, 'max' => 255);
$_TTC_CFG['ICPSOrdersTimelineTTC']['FIELDS']['err_code'] = array('type' => 2, 'min' => 0, 'max' => 15);
$_TTC_CFG['ICPSOrdersTimelineTTC']['FIELDS']['err_msg'] = array('type' => 2, 'min' => 0, 'max' => 65535);
$_TTC_CFG['ICPSOrdersTimelineTTC']['FIELDS']['uid'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['ICPSOrdersTimelineTTC']['FIELDS']['mid'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['ICPSOrdersTimelineTTC']['FIELDS']['ip'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['ICPSOrdersTimelineTTC']['FIELDS']['add_time'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);

class ICPSOrdersTimelineTTC
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
	 * 		'order_id' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'err_code' => 'XXX',
	 * 		'err_msg' => 'XXX',
	 * 		'uid' =>  XXX,
	 * 		'mid' =>  XXX,
	 * 		'ip' => 'XXX',
	 * 		'add_time' =>  XXX,
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
		$ttc = Config::getTTC('ICPSOrdersTimelineTTC');
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

		if(!empty(self::$ttcMap[$param['order_id']]))
		{
			unset(self::$ttcMap[$param['order_id']]);
		}

		return $v;
	}

	/**
	 * ����һ��TTC��¼
	 * 
	 * @param	$param ��ʽ: 
	 * 	array(
	 * 		'order_id' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'err_code' => 'XXX',
	 * 		'err_msg' => 'XXX',
	 * 		'uid' =>  XXX,
	 * 		'mid' =>  XXX,
	 * 		'ip' => 'XXX',
	 * 		'add_time' =>  XXX,
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
		$ttc = Config::getTTC('ICPSOrdersTimelineTTC');
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

		if(!empty(self::$ttcMap[$param['order_id']]))
		{
			unset(self::$ttcMap[$param['order_id']]);
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
		$ttc = Config::getTTC('ICPSOrdersTimelineTTC');
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
	 * 		'order_id' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'err_code' => 'XXX',
	 * 		'err_msg' => 'XXX',
	 * 		'uid' =>  XXX,
	 * 		'mid' =>  XXX,
	 * 		'ip' => 'XXX',
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
		$ttc = Config::getTTC('ICPSOrdersTimelineTTC');
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
		$ttc = Config::getTTC2('ICPSOrdersTimelineTTC');
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
		$ttc = Config::getTTC('ICPSOrdersTimelineTTC');
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

