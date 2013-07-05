<?php
/**
 * IDeviceInfoTTC.php
 * ��TTC:tbl_deviceinfo_�������顢ɾ���ĵȲ���
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	ixiuzeng
 */

global $_TTC_CFG;

$_TTC_CFG['IDeviceInfoTTC']['TTCKEY']	= 'IDeviceInfoTTC';
$_TTC_CFG['IDeviceInfoTTC']['TABLE']	= 'tb1_deviceinfo_';
$_TTC_CFG['IDeviceInfoTTC']['TimeOut']	= 1;
$_TTC_CFG['IDeviceInfoTTC']['KEY']		= 'FDeviceID';
$_TTC_CFG['IDeviceInfoTTC']['FIELDS']	= array();//�������ͣ�int=1,string=2,binary=3
$_TTC_CFG['IDeviceInfoTTC']['FIELDS']['FDeviceID'] = array('type' => 2, 'min' => 0, 'max' => 128);
$_TTC_CFG['IDeviceInfoTTC']['FIELDS']['FDeviceType'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IDeviceInfoTTC']['FIELDS']['FDeviceToken'] = array('type' => 2, 'min' => 0, 'max' => 256);
$_TTC_CFG['IDeviceInfoTTC']['FIELDS']['FCreateTime'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IDeviceInfoTTC']['FIELDS']['FLastActiveTime'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IDeviceInfoTTC']['FIELDS']['FStatus'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IDeviceInfoTTC']['FIELDS']['FOSVersion'] = array('type' => 2, 'min' => 0, 'max' => 256);
$_TTC_CFG['IDeviceInfoTTC']['FIELDS']['FLongitude'] = array('type' => 1, 'min' => -2147483647, 'max' => 2147483647);
$_TTC_CFG['IDeviceInfoTTC']['FIELDS']['FLatitude'] = array('type' => 1, 'min' => -2147483647, 'max' => 2147483647);
$_TTC_CFG['IDeviceInfoTTC']['FIELDS']['FGeographic'] = array('type' => 2, 'min' => 0, 'max' => 256);
$_TTC_CFG['IDeviceInfoTTC']['FIELDS']['FZone'] = array('type' => 2, 'min' => 0, 'max' => 512);
$_TTC_CFG['IDeviceInfoTTC']['FIELDS']['FNetWorkType'] = array('type' => 2, 'min' => 0, 'max' => 64);
$_TTC_CFG['IDeviceInfoTTC']['FIELDS']['FExtField1'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IDeviceInfoTTC']['FIELDS']['FExtField2'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IDeviceInfoTTC']['FIELDS']['FExtField3'] = array('type' => 2, 'min' => 0, 'max' => 128);
$_TTC_CFG['IDeviceInfoTTC']['FIELDS']['FExtField4'] = array('type' => 2, 'min' => 0, 'max' => 256);
$_TTC_CFG['IDeviceInfoTTC']['FIELDS']['FExtField5'] = array('type' => 2, 'min' => 0, 'max' => 512);

class IDeviceInfoTTC
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
	 * 		'FDeviceID' => 'XXX',
	 * 		'FDeviceType' =>  XXX,
	 * 		'FDeviceToken' => 'XXX',
	 * 		'FCreateTime' =>  XXX,
	 * 		'FLastActiveTime' =>  XXX,
	 * 		'FStatus' =>  XXX,
	 * 		'FOSVersion' => 'XXX',
	 * 		'FLongitude' =>  XXX,
	 * 		'FLatitude' =>  XXX,
	 * 		'FGeographic' => 'XXX',
	 * 		'FZone' => 'XXX',
	 * 		'FNetWorkType' => 'XXX',
	 * 		'FExtField1' =>  XXX,
	 * 		'FExtField2' =>  XXX,
	 * 		'FExtField3' => 'XXX',
	 * 		'FExtField4' => 'XXX',
	 * 		'FExtField5' => 'XXX',
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
		$ttc = Config::getTTC('IDeviceInfoTTC');
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

		if(!empty(self::$ttcMap[$param['FDeviceID']]))
		{
			unset(self::$ttcMap[$param['FDeviceID']]);
		}

		return $v;
	}

	/**
	 * ����һ��TTC��¼
	 * 
	 * @param	$param ��ʽ: 
	 * 	array(
	 * 		'FDeviceID' => 'XXX',
	 * 		'FDeviceType' =>  XXX,
	 * 		'FDeviceToken' => 'XXX',
	 * 		'FCreateTime' =>  XXX,
	 * 		'FLastActiveTime' =>  XXX,
	 * 		'FStatus' =>  XXX,
	 * 		'FOSVersion' => 'XXX',
	 * 		'FLongitude' =>  XXX,
	 * 		'FLatitude' =>  XXX,
	 * 		'FGeographic' => 'XXX',
	 * 		'FZone' => 'XXX',
	 * 		'FNetWorkType' => 'XXX',
	 * 		'FExtField1' =>  XXX,
	 * 		'FExtField2' =>  XXX,
	 * 		'FExtField3' => 'XXX',
	 * 		'FExtField4' => 'XXX',
	 * 		'FExtField5' => 'XXX',
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
		$ttc = Config::getTTC('IDeviceInfoTTC');
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

		if(!empty(self::$ttcMap[$param['FDeviceID']]))
		{
			unset(self::$ttcMap[$param['FDeviceID']]);
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
		$ttc = Config::getTTC('IDeviceInfoTTC');
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
	 * 		'FDeviceID' => 'XXX',
	 * 		'FDeviceType' =>  XXX,
	 * 		'FDeviceToken' => 'XXX',
	 * 		'FCreateTime' =>  XXX,
	 * 		'FLastActiveTime' =>  XXX,
	 * 		'FStatus' =>  XXX,
	 * 		'FOSVersion' => 'XXX',
	 * 		'FLongitude' =>  XXX,
	 * 		'FLatitude' =>  XXX,
	 * 		'FGeographic' => 'XXX',
	 * 		'FZone' => 'XXX',
	 * 		'FNetWorkType' => 'XXX',
	 * 		'FExtField1' =>  XXX,
	 * 		'FExtField2' =>  XXX,
	 * 		'FExtField3' => 'XXX',
	 * 		'FExtField4' => 'XXX',
	 * 		'FExtField5' => 'XXX',
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
		$ttc = Config::getTTC('IDeviceInfoTTC');
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
		$ttc = Config::getTTC2('IDeviceInfoTTC');
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
		$ttc = Config::getTTC('IDeviceInfoTTC');
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

