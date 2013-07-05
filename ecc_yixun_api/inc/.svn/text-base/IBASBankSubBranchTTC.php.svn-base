<?php
/**
 * IBASBankSubBranchTTC.php
 * 对TTC:BAS_BankSubBranch的赠、查、删、改等操作
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	andyyao
 */

global $_TTC_CFG;

$_TTC_CFG['IBASBankSubBranchTTC']['TTCKEY']	= 'IBASBankSubBranchTTC';
$_TTC_CFG['IBASBankSubBranchTTC']['TABLE']	= 'BAS_BankSubBranch';
$_TTC_CFG['IBASBankSubBranchTTC']['TimeOut']	= 1;
$_TTC_CFG['IBASBankSubBranchTTC']['KEY']		= 'query_banks';
$_TTC_CFG['IBASBankSubBranchTTC']['FIELDS']	= array();//数据类型，int=1,string=2,binary=3
$_TTC_CFG['IBASBankSubBranchTTC']['FIELDS']['query_banks'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IBASBankSubBranchTTC']['FIELDS']['SysNo'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBASBankSubBranchTTC']['FIELDS']['BankSysNo'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBASBankSubBranchTTC']['FIELDS']['SubBranchID'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IBASBankSubBranchTTC']['FIELDS']['SubBranchName'] = array('type' => 2, 'min' => 0, 'max' => 500);
$_TTC_CFG['IBASBankSubBranchTTC']['FIELDS']['EBankID'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IBASBankSubBranchTTC']['FIELDS']['AreaSysNo'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBASBankSubBranchTTC']['FIELDS']['Status'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IBASBankSubBranchTTC']['FIELDS']['rowCreateDate'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IBASBankSubBranchTTC']['FIELDS']['rowModifyDate'] = array('type' => 2, 'min' => 0, 'max' => 20);

class IBASBankSubBranchTTC
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
	 * 		'query_banks' => 'XXX',
	 * 		'SysNo' =>  XXX,
	 * 		'BankSysNo' =>  XXX,
	 * 		'SubBranchID' => 'XXX',
	 * 		'SubBranchName' => 'XXX',
	 * 		'EBankID' => 'XXX',
	 * 		'AreaSysNo' =>  XXX,
	 * 		'Status' =>  XXX,
	 * 		'rowCreateDate' => 'XXX',
	 * 		'rowModifyDate' => 'XXX',
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
		$ttc = Config::getTTC('IBASBankSubBranchTTC');
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

		if(!empty(self::$ttcMap[$param['query_banks']]))
		{
			unset(self::$ttcMap[$param['query_banks']]);
		}

		return $v;
	}

	/**
	 * 更新一条TTC记录
	 * 
	 * @param	$param 格式: 
	 * 	array(
	 * 		'query_banks' => 'XXX',
	 * 		'SysNo' =>  XXX,
	 * 		'BankSysNo' =>  XXX,
	 * 		'SubBranchID' => 'XXX',
	 * 		'SubBranchName' => 'XXX',
	 * 		'EBankID' => 'XXX',
	 * 		'AreaSysNo' =>  XXX,
	 * 		'Status' =>  XXX,
	 * 		'rowCreateDate' => 'XXX',
	 * 		'rowModifyDate' => 'XXX',
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
		$ttc = Config::getTTC('IBASBankSubBranchTTC');
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

		if(!empty(self::$ttcMap[$param['query_banks']]))
		{
			unset(self::$ttcMap[$param['query_banks']]);
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
		$ttc = Config::getTTC('IBASBankSubBranchTTC');
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
	 * 		'query_banks' => 'XXX',
	 * 		'SysNo' =>  XXX,
	 * 		'BankSysNo' =>  XXX,
	 * 		'SubBranchID' => 'XXX',
	 * 		'SubBranchName' => 'XXX',
	 * 		'EBankID' => 'XXX',
	 * 		'AreaSysNo' =>  XXX,
	 * 		'Status' =>  XXX,
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
		$ttc = Config::getTTC('IBASBankSubBranchTTC');
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
		$ttc = Config::getTTC2('IBASBankSubBranchTTC');
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
	 * 取操作TTC影响的行数
	 * 
	 * 
	 * 返回值：正确返回>-1的行数，错误返回负数
	 */
	public static function getTTCAffectRows()
	{
		$ttc = Config::getTTC('IBASBankSubBranchTTC');
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

