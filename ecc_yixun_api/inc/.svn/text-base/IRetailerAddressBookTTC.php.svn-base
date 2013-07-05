<?php
/**
 * IRetailerAddressBookTTC.php
 * 对TTC:t_retailer_addressbook的赠、查、删、改等操作
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	zhiliu
 */

global $_TTC_CFG;

$_TTC_CFG['IRetailerAddressBookTTC']['TTCKEY']	= 'IRetailerAddressBookTTC';
$_TTC_CFG['IRetailerAddressBookTTC']['TABLE']	= 't_retailer_addressbook';
$_TTC_CFG['IRetailerAddressBookTTC']['TimeOut']	= 1;
$_TTC_CFG['IRetailerAddressBookTTC']['KEY']		= 'uid';
$_TTC_CFG['IRetailerAddressBookTTC']['FIELDS']	= array();//数据类型，int=1,string=2,binary=3
$_TTC_CFG['IRetailerAddressBookTTC']['FIELDS']['uid'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerAddressBookTTC']['FIELDS']['aid'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerAddressBookTTC']['FIELDS']['iid'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerAddressBookTTC']['FIELDS']['name'] = array('type' => 2, 'min' => 0, 'max' => 32);
$_TTC_CFG['IRetailerAddressBookTTC']['FIELDS']['mobile'] = array('type' => 2, 'min' => 0, 'max' => 16);
$_TTC_CFG['IRetailerAddressBookTTC']['FIELDS']['phone'] = array('type' => 2, 'min' => 0, 'max' => 64);
$_TTC_CFG['IRetailerAddressBookTTC']['FIELDS']['fax'] = array('type' => 2, 'min' => 0, 'max' => 64);
$_TTC_CFG['IRetailerAddressBookTTC']['FIELDS']['zipcode'] = array('type' => 2, 'min' => 0, 'max' => 16);
$_TTC_CFG['IRetailerAddressBookTTC']['FIELDS']['district'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRetailerAddressBookTTC']['FIELDS']['address'] = array('type' => 2, 'min' => 0, 'max' => 256);
$_TTC_CFG['IRetailerAddressBookTTC']['FIELDS']['workplace'] = array('type' => 2, 'min' => 0, 'max' => 128);
$_TTC_CFG['IRetailerAddressBookTTC']['FIELDS']['sortfactor'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRetailerAddressBookTTC']['FIELDS']['updatetime'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerAddressBookTTC']['FIELDS']['createtime'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerAddressBookTTC']['FIELDS']['default_shipping'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRetailerAddressBookTTC']['FIELDS']['default_pay_type'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRetailerAddressBookTTC']['FIELDS']['last_use_time'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IRetailerAddressBookTTC']['FIELDS']['status'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRetailerAddressBookTTC']['FIELDS']['shopid'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);

class IRetailerAddressBookTTC
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
	 * 		'aid' =>  XXX,
	 * 		'iid' =>  XXX,
	 * 		'name' => 'XXX',
	 * 		'mobile' => 'XXX',
	 * 		'phone' => 'XXX',
	 * 		'fax' => 'XXX',
	 * 		'zipcode' => 'XXX',
	 * 		'district' =>  XXX,
	 * 		'address' => 'XXX',
	 * 		'workplace' => 'XXX',
	 * 		'sortfactor' =>  XXX,
	 * 		'updatetime' =>  XXX,
	 * 		'createtime' =>  XXX,
	 * 		'default_shipping' =>  XXX,
	 * 		'default_pay_type' =>  XXX,
	 * 		'last_use_time' =>  XXX,
	 * 		'status' =>  XXX,
	 * 		'shopid' =>  XXX,
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
		$ttc = Config::getTTC('IRetailerAddressBookTTC');
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
	 * 		'aid' =>  XXX,
	 * 		'iid' =>  XXX,
	 * 		'name' => 'XXX',
	 * 		'mobile' => 'XXX',
	 * 		'phone' => 'XXX',
	 * 		'fax' => 'XXX',
	 * 		'zipcode' => 'XXX',
	 * 		'district' =>  XXX,
	 * 		'address' => 'XXX',
	 * 		'workplace' => 'XXX',
	 * 		'sortfactor' =>  XXX,
	 * 		'updatetime' =>  XXX,
	 * 		'createtime' =>  XXX,
	 * 		'default_shipping' =>  XXX,
	 * 		'default_pay_type' =>  XXX,
	 * 		'last_use_time' =>  XXX,
	 * 		'status' =>  XXX,
	 * 		'shopid' =>  XXX,
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
		$ttc = Config::getTTC('IRetailerAddressBookTTC');
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
		$ttc = Config::getTTC('IRetailerAddressBookTTC');
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
	 * 		'aid' =>  XXX,
	 * 		'iid' =>  XXX,
	 * 		'name' => 'XXX',
	 * 		'mobile' => 'XXX',
	 * 		'phone' => 'XXX',
	 * 		'fax' => 'XXX',
	 * 		'zipcode' => 'XXX',
	 * 		'district' =>  XXX,
	 * 		'address' => 'XXX',
	 * 		'workplace' => 'XXX',
	 * 		'sortfactor' =>  XXX,
	 * 		'updatetime' =>  XXX,
	 * 		'createtime' =>  XXX,
	 * 		'default_shipping' =>  XXX,
	 * 		'default_pay_type' =>  XXX,
	 * 		'last_use_time' =>  XXX,
	 * 		'status' =>  XXX,
	 * 		'shopid' =>  XXX,
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
		$ttc = Config::getTTC('IRetailerAddressBookTTC');
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
		$ttc = Config::getTTC2('IRetailerAddressBookTTC');
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
	 * 清理缓存
	 * @param mix $key 第一个key
	 * @param array $filter 其它过滤条件
	 * @return boolean
	 */
	public static function purge($key, $filter = array())
	{
		self::clearErr();
		
		if(empty($key))
		{
			self::$errCode = 111;
			self::$errMsg  = 'key is empty';
		}
		$ttc = Config::getTTC('IRetailerAddressBookTTC');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}
		
		$v = $ttc->purge($key, $filter);
		if(false === $v)
		{
			self::$errCode = $ttc->errCode;
			self::$errMsg  = $ttc->errMsg;
			return false;
		}
		
		return true;
	}

	/**
	 * 取操作TTC影响的行数
	 * 
	 * 
	 * 返回值：正确返回>-1的行数，错误返回负数
	 */
	public static function getTTCAffectRows()
	{
		$ttc = Config::getTTC('IRetailerAddressBookTTC');
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

