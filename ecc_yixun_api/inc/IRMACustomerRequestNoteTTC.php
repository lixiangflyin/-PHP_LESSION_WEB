<?php
/**
 * IRMACustomerRequestNoteTTC.php
 * ��TTC:RMA_CustomerRequestNote�������顢ɾ���ĵȲ���
 *
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	andyyao
 */

global $_TTC_CFG;

$_TTC_CFG['IRMACustomerRequestNoteTTC']['TTCKEY']	= 'IRMACustomerRequestNoteTTC';
$_TTC_CFG['IRMACustomerRequestNoteTTC']['TABLE']	= 'RMA_CustomerRequestNote';
$_TTC_CFG['IRMACustomerRequestNoteTTC']['TimeOut']	= 1;
$_TTC_CFG['IRMACustomerRequestNoteTTC']['KEY']		= 'CustomerRequestSysNo';
$_TTC_CFG['IRMACustomerRequestNoteTTC']['FIELDS']	= array();//�������ͣ�int=1,string=2,binary=3
$_TTC_CFG['IRMACustomerRequestNoteTTC']['FIELDS']['CustomerRequestSysNo'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMACustomerRequestNoteTTC']['FIELDS']['SysNo'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMACustomerRequestNoteTTC']['FIELDS']['Whid'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMACustomerRequestNoteTTC']['FIELDS']['Content'] = array('type' => 2, 'min' => 0, 'max' => 1000);
$_TTC_CFG['IRMACustomerRequestNoteTTC']['FIELDS']['Type'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMACustomerRequestNoteTTC']['FIELDS']['Status'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMACustomerRequestNoteTTC']['FIELDS']['CreateUserSysNo'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMACustomerRequestNoteTTC']['FIELDS']['CreateDate'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IRMACustomerRequestNoteTTC']['FIELDS']['rowCreateDate'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IRMACustomerRequestNoteTTC']['FIELDS']['rowModifyDate'] = array('type' => 2, 'min' => 0, 'max' => 20);

class IRMACustomerRequestNoteTTC
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
	 * 		'CustomerRequestSysNo' =>  XXX,
	 * 		'SysNo' =>  XXX,
	 * 		'Whid' =>  XXX,
	 * 		'Content' => 'XXX',
	 * 		'Type' =>  XXX,
	 * 		'Status' =>  XXX,
	 * 		'CreateUserSysNo' =>  XXX,
	 * 		'CreateDate' => 'XXX',
	 * 		'rowCreateDate' => 'XXX',
	 * 		'rowModifyDate' => 'XXX',
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
		$ttc = Config::getTTC('IRMACustomerRequestNoteTTC');
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

		if(!empty(self::$ttcMap[$param['CustomerRequestSysNo']]))
		{
			unset(self::$ttcMap[$param['CustomerRequestSysNo']]);
		}

		return $v;
	}

	/**
	 * ����һ��TTC��¼
	 *
	 * @param	$param ��ʽ:
	 * 	array(
	 * 		'CustomerRequestSysNo' =>  XXX,
	 * 		'SysNo' =>  XXX,
	 * 		'Whid' =>  XXX,
	 * 		'Content' => 'XXX',
	 * 		'Type' =>  XXX,
	 * 		'Status' =>  XXX,
	 * 		'CreateUserSysNo' =>  XXX,
	 * 		'CreateDate' => 'XXX',
	 * 		'rowCreateDate' => 'XXX',
	 * 		'rowModifyDate' => 'XXX',
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
		$ttc = Config::getTTC('IRMACustomerRequestNoteTTC');
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

		if(!empty(self::$ttcMap[$param['CustomerRequestSysNo']]))
		{
			unset(self::$ttcMap[$param['CustomerRequestSysNo']]);
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
		$ttc = Config::getTTC('IRMACustomerRequestNoteTTC');
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
	 * 		'CustomerRequestSysNo' =>  XXX,
	 * 		'SysNo' =>  XXX,
	 * 		'Whid' =>  XXX,
	 * 		'Content' => 'XXX',
	 * 		'Type' =>  XXX,
	 * 		'Status' =>  XXX,
	 * 		'CreateUserSysNo' =>  XXX,
	 * 		'CreateDate' => 'XXX',
	 * 		'rowCreateDate' => 'XXX',
	 * 		'rowModifyDate' => 'XXX',
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
		$ttc = Config::getTTC('IRMACustomerRequestNoteTTC');
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
		$ttc = Config::getTTC2('IRMACustomerRequestNoteTTC');
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
		$ttc = Config::getTTC('IRMACustomerRequestNoteTTC');
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

