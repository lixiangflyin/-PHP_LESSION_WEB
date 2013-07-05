<?php
/**
 * IUserInvoiceTTC.php
 * 对TTC:t_user_invoice的赠、查、删、改等操作
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	andyyao
 */

global $_TTC_CFG;

$_TTC_CFG['IUserInvoiceTTC']['TTCKEY']	= 'IUserInvoiceTTC';
$_TTC_CFG['IUserInvoiceTTC']['TABLE']	= 't_user_invoice';
$_TTC_CFG['IUserInvoiceTTC']['TimeOut']	= 1;
$_TTC_CFG['IUserInvoiceTTC']['KEY']		= 'uid';
$_TTC_CFG['IUserInvoiceTTC']['FIELDS']	= array();//数据类型，int=1,string=2,binary=3
$_TTC_CFG['IUserInvoiceTTC']['FIELDS']['uid'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IUserInvoiceTTC']['FIELDS']['iid'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IUserInvoiceTTC']['FIELDS']['type'] = array('type' => 1, 'min' => -128, 'max' => 127);
$_TTC_CFG['IUserInvoiceTTC']['FIELDS']['title'] = array('type' => 2, 'min' => 0, 'max' => 128);
$_TTC_CFG['IUserInvoiceTTC']['FIELDS']['name'] = array('type' => 2, 'min' => 0, 'max' => 128);
$_TTC_CFG['IUserInvoiceTTC']['FIELDS']['addr'] = array('type' => 2, 'min' => 0, 'max' => 256);
$_TTC_CFG['IUserInvoiceTTC']['FIELDS']['phone'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IUserInvoiceTTC']['FIELDS']['taxno'] = array('type' => 2, 'min' => 0, 'max' => 32);
$_TTC_CFG['IUserInvoiceTTC']['FIELDS']['bankno'] = array('type' => 2, 'min' => 0, 'max' => 32);
$_TTC_CFG['IUserInvoiceTTC']['FIELDS']['bankname'] = array('type' => 2, 'min' => 0, 'max' => 128);
$_TTC_CFG['IUserInvoiceTTC']['FIELDS']['status'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IUserInvoiceTTC']['FIELDS']['sortfactor'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IUserInvoiceTTC']['FIELDS']['updatetime'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IUserInvoiceTTC']['FIELDS']['createtime'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);

class IUserInvoiceTTC
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
	 * 		'iid' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'title' => 'XXX',
	 * 		'name' => 'XXX',
	 * 		'addr' => 'XXX',
	 * 		'phone' => 'XXX',
	 * 		'taxno' => 'XXX',
	 * 		'bankno' => 'XXX',
	 * 		'bankname' => 'XXX',
	 * 		'status' =>  XXX,
	 * 		'sortfactor' =>  XXX,
	 * 		'updatetime' =>  XXX,
	 * 		'createtime' =>  XXX,
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
		$ttc = Config::getTTC('IUserInvoiceTTC');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->insert($param);
		if(!$v)
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
	 * 		'iid' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'title' => 'XXX',
	 * 		'name' => 'XXX',
	 * 		'addr' => 'XXX',
	 * 		'phone' => 'XXX',
	 * 		'taxno' => 'XXX',
	 * 		'bankno' => 'XXX',
	 * 		'bankname' => 'XXX',
	 * 		'status' =>  XXX,
	 * 		'sortfactor' =>  XXX,
	 * 		'updatetime' =>  XXX,
	 * 		'createtime' =>  XXX,
	 * 		)
	 * 
	 * 返回值：正确返回true，错误返回false
	 */
	public static function update($param,$filter=array())
	{
		self::clearErr();
		
		if(empty($param) || !is_array($param))
		{
			self::$errCode = 111;
			self::$errMsg  = 'param is empty';
		}
		$ttc = Config::getTTC('IUserInvoiceTTC');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->update($param, $filter);
		if(!$v)
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
	public static function remove($key, $filter=array())
	{
		self::clearErr();
		
		if(empty($key))
		{
			self::$errCode = 111;
			self::$errMsg  = 'key is empty';
		}
		$ttc = Config::getTTC('IUserInvoiceTTC');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->delete($key, $filter);
		if(!$v)
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
	 * 取操作TTC影响的行数
	 * 
	 * 
	 * 返回值：正确返回>-1的行数，错误返回负数
	 */
	public static function getTTCAffectRows()
	{
		$ttc = Config::getTTC('IUserInvoiceTTC');
		if(!$ttc)
		{
			self::$errCode = -114;
			self::$errMsg  = 'get instance of TTC failed';
			return -1;
		}

		return $ttc->getAffectRows();
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
	 * 		'iid' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'title' => 'XXX',
	 * 		'name' => 'XXX',
	 * 		'addr' => 'XXX',
	 * 		'phone' => 'XXX',
	 * 		'taxno' => 'XXX',
	 * 		'bankno' => 'XXX',
	 * 		'bankname' => 'XXX',
	 * 		'status' =>  XXX,
	 * 		'sortfactor' =>  XXX,
	 * 		'updatetime' =>  XXX,
	 * 		'createtime' =>  XXX,
	 * 		)
	 */
	public static function get($key, $filter = array(), $multiItem = false)
	{
		self::clearErr();
		
		if(empty($key))
		{
			self::$errCode = 111;
			self::$errMsg  = 'key is empty';
		}
		if(!empty(self::$ttcMap[$key]))
		{
			return self::$ttcMap[$key];
		}

		$ttc = Config::getTTC('IUserInvoiceTTC');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->get($key, $multikey, !$multiItem);
		if(!$v)
		{
			self::$errCode = $ttc->errCode;
			self::$errMsg  = $ttc->errMsg;
			return false;
		}

		if (count(self::$ttcMap) > 100)
		{
			self::$ttcMap = array();
		}

		self::$ttcMap[$key] = $v;

		return $v;
	}

	/**
	 * 批量取TTC记录
	 * 
	 * @param   string  $keys		数据库的主键数组
	 * 
	 * 返回值：正确返回数据，错误返回false
	 */
	public static function gets($keys)
	{
		self::clearErr();
		
		if(empty($keys) || !is_array($keys))
		{
			self::$errCode = 111;
			self::$errMsg  = 'keys is empty';
		}
		$ttc = Config::getTTC2('IUserInvoiceTTC');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->get($keys);
		if(!$v)
		{
			self::$errCode = $ttc->errCode;
			self::$errMsg  = $ttc->errMsg;
			return false;
		}

		return $v;
	}

}

//End Of Script

