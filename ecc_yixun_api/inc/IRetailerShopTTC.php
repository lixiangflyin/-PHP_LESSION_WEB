<?php
/**
 * IRetailerShopTTC.php
 * ��TTC:t_retailer_shop�������顢ɾ���ĵȲ���
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	zhiliu
 */

global $_TTC_CFG;

$_TTC_CFG['IRetailerShopTTC']['TTCKEY']	= 'IRetailerShopTTC';
$_TTC_CFG['IRetailerShopTTC']['TABLE']	= 't_retailer_shop';
$_TTC_CFG['IRetailerShopTTC']['TimeOut']	= 1;
$_TTC_CFG['IRetailerShopTTC']['KEY']		= 'retailerId';
$_TTC_CFG['IRetailerShopTTC']['FIELDS']	= array();//�������ͣ�int=1,string=2,binary=3
$_TTC_CFG['IRetailerShopTTC']['FIELDS']['retailerId'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerShopTTC']['FIELDS']['shopId'] = array('type' => 1, 'min' => 0, 'max' => 4294967295, 'auto' => 1);
$_TTC_CFG['IRetailerShopTTC']['FIELDS']['shopName'] = array('type' => 2, 'min' => 0, 'max' => 64);
$_TTC_CFG['IRetailerShopTTC']['FIELDS']['contact'] = array('type' => 2, 'min' => 0, 'max' => 32);
$_TTC_CFG['IRetailerShopTTC']['FIELDS']['mobile'] = array('type' => 2, 'min' => 0, 'max' => 64);
$_TTC_CFG['IRetailerShopTTC']['FIELDS']['phone'] = array('type' => 2, 'min' => 0, 'max' => 64);
$_TTC_CFG['IRetailerShopTTC']['FIELDS']['emergencyContact'] = array('type' => 2, 'min' => 0, 'max' => 32);
$_TTC_CFG['IRetailerShopTTC']['FIELDS']['emergencyMobile'] = array('type' => 2, 'min' => 0, 'max' => 64);
$_TTC_CFG['IRetailerShopTTC']['FIELDS']['emergencyPhone'] = array('type' => 2, 'min' => 0, 'max' => 64);
$_TTC_CFG['IRetailerShopTTC']['FIELDS']['district'] = array('type' => 1, 'min' => 0, 'max' => 65535);
$_TTC_CFG['IRetailerShopTTC']['FIELDS']['address'] = array('type' => 2, 'min' => 0, 'max' => 255);
$_TTC_CFG['IRetailerShopTTC']['FIELDS']['zipcode'] = array('type' => 2, 'min' => 0, 'max' => 6);
$_TTC_CFG['IRetailerShopTTC']['FIELDS']['status'] = array('type' => 1, 'min' => 0, 'max' => 255);
$_TTC_CFG['IRetailerShopTTC']['FIELDS']['isDeleted'] = array('type' => 1, 'min' => 0, 'max' => 255);
$_TTC_CFG['IRetailerShopTTC']['FIELDS']['createTime'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerShopTTC']['FIELDS']['updateTime'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerShopTTC']['FIELDS']['checkTime'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerShopTTC']['FIELDS']['operatorId'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerShopTTC']['FIELDS']['operatorName'] = array('type' => 2, 'min' => 0, 'max' => 32);

class IRetailerShopTTC
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
	 * 		'retailerId' =>  XXX,
	 * 		'shopId' =>  XXX,
	 * 		'shopName' => 'XXX',
	 * 		'contact' => 'XXX',
	 * 		'mobile' => 'XXX',
	 * 		'phone' => 'XXX',
	 * 		'emergencyContact' => 'XXX',
	 * 		'emergencyMobile' => 'XXX',
	 * 		'emergencyPhone' => 'XXX',
	 * 		'district' =>  XXX,
	 * 		'address' => 'XXX',
	 * 		'zipcode' => 'XXX',
	 * 		'status' =>  XXX,
	 * 		'isDeleted' =>  XXX,
	 * 		'createTime' =>  XXX,
	 * 		'updateTime' =>  XXX,
	 * 		'checkTime' =>  XXX,
	 * 		'operatorId' =>  XXX,
	 * 		'operatorName' => 'XXX',
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
		$ttc = Config::getTTC('IRetailerShopTTC');
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

		if(!empty(self::$ttcMap[$param['retailerId']]))
		{
			unset(self::$ttcMap[$param['retailerId']]);
		}

		return $v;
	}

	/**
	 * ����һ��TTC��¼
	 * 
	 * @param	$param ��ʽ: 
	 * 	array(
	 * 		'retailerId' =>  XXX,
	 * 		'shopId' =>  XXX,
	 * 		'shopName' => 'XXX',
	 * 		'contact' => 'XXX',
	 * 		'mobile' => 'XXX',
	 * 		'phone' => 'XXX',
	 * 		'emergencyContact' => 'XXX',
	 * 		'emergencyMobile' => 'XXX',
	 * 		'emergencyPhone' => 'XXX',
	 * 		'district' =>  XXX,
	 * 		'address' => 'XXX',
	 * 		'zipcode' => 'XXX',
	 * 		'status' =>  XXX,
	 * 		'isDeleted' =>  XXX,
	 * 		'createTime' =>  XXX,
	 * 		'updateTime' =>  XXX,
	 * 		'checkTime' =>  XXX,
	 * 		'operatorId' =>  XXX,
	 * 		'operatorName' => 'XXX',
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
		$ttc = Config::getTTC('IRetailerShopTTC');
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

		if(!empty(self::$ttcMap[$param['retailerId']]))
		{
			unset(self::$ttcMap[$param['retailerId']]);
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
		$ttc = Config::getTTC('IRetailerShopTTC');
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
	 * 		'retailerId' =>  XXX,
	 * 		'shopId' =>  XXX,
	 * 		'shopName' => 'XXX',
	 * 		'contact' => 'XXX',
	 * 		'mobile' => 'XXX',
	 * 		'phone' => 'XXX',
	 * 		'emergencyContact' => 'XXX',
	 * 		'emergencyMobile' => 'XXX',
	 * 		'emergencyPhone' => 'XXX',
	 * 		'district' =>  XXX,
	 * 		'address' => 'XXX',
	 * 		'zipcode' => 'XXX',
	 * 		'status' =>  XXX,
	 * 		'isDeleted' =>  XXX,
	 * 		'createTime' =>  XXX,
	 * 		'updateTime' =>  XXX,
	 * 		'checkTime' =>  XXX,
	 * 		'operatorId' =>  XXX,
	 * 		'operatorName' => 'XXX',
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
		$ttc = Config::getTTC('IRetailerShopTTC');
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
		$ttc = Config::getTTC2('IRetailerShopTTC');
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
		$ttc = Config::getTTC('IRetailerShopTTC');
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

