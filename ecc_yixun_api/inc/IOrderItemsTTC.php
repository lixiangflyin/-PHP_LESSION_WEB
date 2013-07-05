<?php
/**
 * IOrderItemsTTC.php
 * ��TTC:t_order_items_�������顢ɾ���ĵȲ���
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	ixiuzeng
 */

global $_TTC_CFG;

$_TTC_CFG['IOrderItemsTTC']['TTCKEY']	= 'IOrderItemsTTC';
$_TTC_CFG['IOrderItemsTTC']['TABLE']	= 't_order_items_';
$_TTC_CFG['IOrderItemsTTC']['TimeOut']	= 1;
$_TTC_CFG['IOrderItemsTTC']['KEY']		= 'uid';
$_TTC_CFG['IOrderItemsTTC']['FIELDS']	= array();//�������ͣ�int=1,string=2,binary=3
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['uid'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['order_char_id'] = array('type' => 2, 'min' => 0, 'max' => 32);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['item_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['product_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['wh_id'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['product_char_id'] = array('type' => 2, 'min' => 0, 'max' => 32);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['name'] = array('type' => 2, 'min' => 0, 'max' => 640);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['flag'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['type'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['type2'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['weight'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['buy_num'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['points'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['points_pay'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['point_type'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['discount'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['price'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['cash_back'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['cost'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['warranty'] = array('type' => 2, 'min' => 0, 'max' => 1000);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['expect_num'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['create_time'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['product_type'] = array('type' => 1, 'min' => -128, 'max' => 127);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['use_virtual_stock'] = array('type' => 1, 'min' => -128, 'max' => 127);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['main_product_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['updatetime'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['edm_code'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['apportToPm'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['apportToMkt'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['OTag'] = array('type' => 2, 'min' => 0, 'max' => 200);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['shop_guide_cost'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IOrderItemsTTC']['FIELDS']['package_ids'] = array('type' => 2, 'min' => 0, 'max' => 1000);

class IOrderItemsTTC
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
		$ttc = Config::getTTC('IOrderItemsTTC');
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
	 * ����һ��TTC��¼
	 * 
	 * @param	$param ��ʽ: 
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
		$ttc = Config::getTTC('IOrderItemsTTC');
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
		$ttc = Config::getTTC('IOrderItemsTTC');
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
		$ttc = Config::getTTC('IOrderItemsTTC');
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
		$ttc = Config::getTTC2('IOrderItemsTTC');
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
		$ttc = Config::getTTC('IOrderItemsTTC');
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

