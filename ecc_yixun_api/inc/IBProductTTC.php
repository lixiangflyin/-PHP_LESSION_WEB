<?php
/**
 * IBProductTTC.php
 * ��TTC:t_retailer_product�������顢ɾ���ĵȲ���
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	zhiliu
 */

global $_TTC_CFG;

$_TTC_CFG['IBProductTTC']['TTCKEY']	= 'IBProductTTC';
$_TTC_CFG['IBProductTTC']['TABLE']	= 't_retailer_product';
$_TTC_CFG['IBProductTTC']['TimeOut']	= 1;
$_TTC_CFG['IBProductTTC']['KEY']		= 'retailerId';
$_TTC_CFG['IBProductTTC']['FIELDS']	= array();//�������ͣ�int=1,string=2,binary=3
$_TTC_CFG['IBProductTTC']['FIELDS']['retailerId'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IBProductTTC']['FIELDS']['productId'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IBProductTTC']['FIELDS']['productNo'] = array('type' => 2, 'min' => 0, 'max' => 32);
$_TTC_CFG['IBProductTTC']['FIELDS']['category1'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IBProductTTC']['FIELDS']['category2'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IBProductTTC']['FIELDS']['category3'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IBProductTTC']['FIELDS']['brandId'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IBProductTTC']['FIELDS']['addPrice'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBProductTTC']['FIELDS']['priceType'] = array('type' => 1, 'min' => -128, 'max' => 127);
$_TTC_CFG['IBProductTTC']['FIELDS']['shelveState'] = array('type' => 1, 'min' => -128, 'max' => 127);
$_TTC_CFG['IBProductTTC']['FIELDS']['topState'] = array('type' => 1, 'min' => -128, 'max' => 127);
$_TTC_CFG['IBProductTTC']['FIELDS']['priceingState'] = array('type' => 1, 'min' => -128, 'max' => 127);
$_TTC_CFG['IBProductTTC']['FIELDS']['createTime'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IBProductTTC']['FIELDS']['updateTime'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IBProductTTC']['FIELDS']['stockState'] = array('type' => 1, 'min' => -128, 'max' => 127);
$_TTC_CFG['IBProductTTC']['FIELDS']['isDelete'] = array('type' => 1, 'min' => -128, 'max' => 127);

class IBProductTTC
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
	 * 		'productId' =>  XXX,
	 * 		'productNo' => 'XXX',
	 * 		'category1' =>  XXX,
	 * 		'category2' =>  XXX,
	 * 		'category3' =>  XXX,
	 * 		'brandId' =>  XXX,
	 * 		'addPrice' =>  XXX,
	 * 		'priceType' =>  XXX,
	 * 		'shelveState' =>  XXX,
	 * 		'topState' =>  XXX,
	 * 		'priceingState' =>  XXX,
	 * 		'createTime' =>  XXX,
	 * 		'updateTime' =>  XXX,
	 * 		'stockState' =>  XXX,
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
		$ttc = Config::getTTC('IBProductTTC');
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
	 * 		'productId' =>  XXX,
	 * 		'productNo' => 'XXX',
	 * 		'category1' =>  XXX,
	 * 		'category2' =>  XXX,
	 * 		'category3' =>  XXX,
	 * 		'brandId' =>  XXX,
	 * 		'addPrice' =>  XXX,
	 * 		'priceType' =>  XXX,
	 * 		'shelveState' =>  XXX,
	 * 		'topState' =>  XXX,
	 * 		'priceingState' =>  XXX,
	 * 		'createTime' =>  XXX,
	 * 		'updateTime' =>  XXX,
	 * 		'stockState' =>  XXX,
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
		$ttc = Config::getTTC('IBProductTTC');
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
		$ttc = Config::getTTC('IBProductTTC');
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
	 * 		'productId' =>  XXX,
	 * 		'productNo' => 'XXX',
	 * 		'category1' =>  XXX,
	 * 		'category2' =>  XXX,
	 * 		'category3' =>  XXX,
	 * 		'brandId' =>  XXX,
	 * 		'addPrice' =>  XXX,
	 * 		'priceType' =>  XXX,
	 * 		'shelveState' =>  XXX,
	 * 		'topState' =>  XXX,
	 * 		'priceingState' =>  XXX,
	 * 		'createTime' =>  XXX,
	 * 		'updateTime' =>  XXX,
	 * 		'stockState' =>  XXX,
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
		$ttc = Config::getTTC('IBProductTTC');
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
		$ttc = Config::getTTC2('IBProductTTC');
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
		$ttc = Config::getTTC('IBProductTTC');
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

