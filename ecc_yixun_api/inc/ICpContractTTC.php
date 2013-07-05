<?php
/**
 * ICpContractTTC.php
 * ��TTC:t_cp_contract_info�������顢ɾ���ĵȲ���
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	andyyao
 */

global $_TTC_CFG;

$_TTC_CFG['ICpContractTTC']['TTCKEY']	= 'ICpContractTTC';
$_TTC_CFG['ICpContractTTC']['TABLE']	= 't_cp_contract_info';
$_TTC_CFG['ICpContractTTC']['TimeOut']	= 1;
$_TTC_CFG['ICpContractTTC']['KEY']		= 'contract_key';
$_TTC_CFG['ICpContractTTC']['FIELDS']	= array();//�������ͣ�int=1,string=2,binary=3
$_TTC_CFG['ICpContractTTC']['FIELDS']['contract_key'] = array('type' => 2, 'min' => 0, 'max' => 32);
$_TTC_CFG['ICpContractTTC']['FIELDS']['uid'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICpContractTTC']['FIELDS']['package_id'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICpContractTTC']['FIELDS']['package_name'] = array('type' => 2, 'min' => 0, 'max' => 40);
$_TTC_CFG['ICpContractTTC']['FIELDS']['num'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['ICpContractTTC']['FIELDS']['sp_id'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICpContractTTC']['FIELDS']['updatetime'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['ICpContractTTC']['FIELDS']['num_total_page'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICpContractTTC']['FIELDS']['user_name'] = array('type' => 2, 'min' => 0, 'max' => 40);
$_TTC_CFG['ICpContractTTC']['FIELDS']['user_idcard'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['ICpContractTTC']['FIELDS']['user_idindate'] = array('type' => 2, 'min' => 0, 'max' => 10);
$_TTC_CFG['ICpContractTTC']['FIELDS']['user_idaddr'] = array('type' => 2, 'min' => 0, 'max' => 256);
$_TTC_CFG['ICpContractTTC']['FIELDS']['user_addr'] = array('type' => 2, 'min' => 0, 'max' => 256);
$_TTC_CFG['ICpContractTTC']['FIELDS']['user_zipcode'] = array('type' => 2, 'min' => 0, 'max' => 6);
$_TTC_CFG['ICpContractTTC']['FIELDS']['user_phone'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['ICpContractTTC']['FIELDS']['product_id'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['ICpContractTTC']['FIELDS']['card_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);

class ICpContractTTC
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
	 * 		'contract_key' =>  XXX,
	 * 		'uid' =>  XXX,
	 * 		'package_id' =>  XXX,
	 * 		'package_name' => 'XXX',
	 * 		'num' => 'XXX',
	 * 		'sp_id' =>  XXX,
	 * 		'updatetime' =>  XXX,
	 * 		'num_total_page' =>  XXX,
	 * 		'user_name' => 'XXX',
	 * 		'user_idcard' => 'XXX',
	 * 		'user_idindate' => 'XXX',
	 * 		'user_idaddr' => 'XXX',
	 * 		'user_addr' => 'XXX',
	 * 		'user_zipcode' => 'XXX',
	 * 		'user_phone' => 'XXX',
	 * 		'product_id' =>  XXX,
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
		$ttc = Config::getTTC('ICpContractTTC');
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

		if(!empty(self::$ttcMap[$param['contract_key']]))
		{
			unset(self::$ttcMap[$param['contract_key']]);
		}

		return $v;
	}

	/**
	 * ����һ��TTC��¼
	 * 
	 * @param	$param ��ʽ: 
	 * 	array(
	 * 		'contract_key' =>  XXX,
	 * 		'uid' =>  XXX,
	 * 		'package_id' =>  XXX,
	 * 		'package_name' => 'XXX',
	 * 		'num' => 'XXX',
	 * 		'sp_id' =>  XXX,
	 * 		'updatetime' =>  XXX,
	 * 		'num_total_page' =>  XXX,
	 * 		'user_name' => 'XXX',
	 * 		'user_idcard' => 'XXX',
	 * 		'user_idindate' => 'XXX',
	 * 		'user_idaddr' => 'XXX',
	 * 		'user_addr' => 'XXX',
	 * 		'user_zipcode' => 'XXX',
	 * 		'user_phone' => 'XXX',
	 * 		'product_id' =>  XXX,
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
		$ttc = Config::getTTC('ICpContractTTC');
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

		if(!empty(self::$ttcMap[$param['contract_key']]))
		{
			unset(self::$ttcMap[$param['contract_key']]);
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
		$ttc = Config::getTTC('ICpContractTTC');
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
	 * 		'contract_key' =>  XXX,
	 * 		'uid' =>  XXX,
	 * 		'package_id' =>  XXX,
	 * 		'package_name' => 'XXX',
	 * 		'num' => 'XXX',
	 * 		'sp_id' =>  XXX,
	 * 		'updatetime' =>  XXX,
	 * 		'num_total_page' =>  XXX,
	 * 		'user_name' => 'XXX',
	 * 		'user_idcard' => 'XXX',
	 * 		'user_idindate' => 'XXX',
	 * 		'user_idaddr' => 'XXX',
	 * 		'user_addr' => 'XXX',
	 * 		'user_zipcode' => 'XXX',
	 * 		'user_phone' => 'XXX',
	 * 		'product_id' =>  XXX,
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
		$ttc = Config::getTTC('ICpContractTTC');
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
		$ttc = Config::getTTC2('ICpContractTTC');
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
		$ttc = Config::getTTC('ICpContractTTC');
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

