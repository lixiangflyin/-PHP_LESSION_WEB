<?php
/**
 * IRMARequestTTC.php
 * 对TTC:RMA_Request的赠、查、删、改等操作
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	andyyao
 */

global $_TTC_CFG;

$_TTC_CFG['IRMARequestTTC']['TTCKEY']	= 'IRMARequestTTC';
$_TTC_CFG['IRMARequestTTC']['TABLE']	= 'RMA_Request';
$_TTC_CFG['IRMARequestTTC']['TimeOut']	= 1;
$_TTC_CFG['IRMARequestTTC']['KEY']		= 'CustomerSysNo';
$_TTC_CFG['IRMARequestTTC']['FIELDS']	= array();//数据类型，int=1,string=2,binary=3
$_TTC_CFG['IRMARequestTTC']['FIELDS']['CustomerSysNo'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['RequestSysNo'] = array('type' => 2, 'min' => 0, 'max' => 10);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['SOSysNo'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['SOID'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['SoPayTypeSysNo'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['RequestFormType'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['SysNo'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['StockSysNo'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['Whid'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['RequestReason'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['ProductDesc'] = array('type' => 2, 'min' => 0, 'max' => 65535);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['RequestType'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['RefundTypeSysNo'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['RefundBank'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['RefundAccountName'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['RefundAccountNo'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['RefundBankCity'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['ProvinceName'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['CityName'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['RefundBankSubBranchSysNo'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['AccounterTelephone'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['AccounterMobilephone'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['PickupMan'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['PickupTelephone'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['PickupMobilephone'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['PickupAreaSysNo'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['PickupAddress'] = array('type' => 2, 'min' => 0, 'max' => 500);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['PickupZip'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['PickupType'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['ETakeDate'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['ETakeTimeSpan'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['DoorGetFee'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['IsRevertAddress'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['RevertContact'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['RevertTelephone'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['RevertMobilephone'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['RevertAreaSysNo'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['RevertAddress'] = array('type' => 2, 'min' => 0, 'max' => 500);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['RevertZip'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['RequestAmt'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['RequestPoint'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['RequestDate'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['rowCreateDate'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['rowModifyDate'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['Status'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['Source'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['ReceiveSysNo'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['RevertSysNo'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['RefundSysNo'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IRMARequestTTC']['FIELDS']['PicUrls'] = array('type' => 2, 'min' => 0, 'max' => 1000);

class IRMARequestTTC
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
	 * 		'CustomerSysNo' =>  XXX,
	 * 		'RequestSysNo' => 'XXX',
	 * 		'SOSysNo' =>  XXX,
	 * 		'SOID' => 'XXX',
	 * 		'SoPayTypeSysNo' =>  XXX,
	 * 		'RequestFormType' =>  XXX,
	 * 		'SysNo' =>  XXX,
	 * 		'StockSysNo' =>  XXX,
	 * 		'Whid' =>  XXX,
	 * 		'RequestReason' =>  XXX,
	 * 		'ProductDesc' => 'XXX',
	 * 		'RequestType' =>  XXX,
	 * 		'RefundTypeSysNo' =>  XXX,
	 * 		'RefundBank' =>  XXX,
	 * 		'RefundAccountName' => 'XXX',
	 * 		'RefundAccountNo' => 'XXX',
	 * 		'RefundBankCity' =>  XXX,
	 * 		'ProvinceName' => 'XXX',
	 * 		'CityName' => 'XXX',
	 * 		'RefundBankSubBranchSysNo' =>  XXX,
	 * 		'AccounterTelephone' => 'XXX',
	 * 		'AccounterMobilephone' => 'XXX',
	 * 		'PickupMan' => 'XXX',
	 * 		'PickupTelephone' => 'XXX',
	 * 		'PickupMobilephone' => 'XXX',
	 * 		'PickupAreaSysNo' =>  XXX,
	 * 		'PickupAddress' => 'XXX',
	 * 		'PickupZip' => 'XXX',
	 * 		'PickupType' =>  XXX,
	 * 		'ETakeDate' => 'XXX',
	 * 		'ETakeTimeSpan' =>  XXX,
	 * 		'DoorGetFee' =>  XXX,
	 * 		'IsRevertAddress' =>  XXX,
	 * 		'RevertContact' => 'XXX',
	 * 		'RevertTelephone' => 'XXX',
	 * 		'RevertMobilephone' => 'XXX',
	 * 		'RevertAreaSysNo' =>  XXX,
	 * 		'RevertAddress' => 'XXX',
	 * 		'RevertZip' => 'XXX',
	 * 		'RequestAmt' =>  XXX,
	 * 		'RequestPoint' =>  XXX,
	 * 		'RequestDate' => 'XXX',
	 * 		'rowCreateDate' => 'XXX',
	 * 		'rowModifyDate' => 'XXX',
	 * 		'Status' =>  XXX,
	 * 		'Source' =>  XXX,
	 * 		'ReceiveSysNo' =>  XXX,
	 * 		'RevertSysNo' =>  XXX,
	 * 		'RefundSysNo' =>  XXX,
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
		$ttc = Config::getTTC('IRMARequestTTC');
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

		if(!empty(self::$ttcMap[$param['CustomerSysNo']]))
		{
			unset(self::$ttcMap[$param['CustomerSysNo']]);
		}

		return $v;
	}

	/**
	 * 更新一条TTC记录
	 * 
	 * @param	$param 格式: 
	 * 	array(
	 * 		'CustomerSysNo' =>  XXX,
	 * 		'RequestSysNo' => 'XXX',
	 * 		'SOSysNo' =>  XXX,
	 * 		'SOID' => 'XXX',
	 * 		'SoPayTypeSysNo' =>  XXX,
	 * 		'RequestFormType' =>  XXX,
	 * 		'SysNo' =>  XXX,
	 * 		'StockSysNo' =>  XXX,
	 * 		'Whid' =>  XXX,
	 * 		'RequestReason' =>  XXX,
	 * 		'ProductDesc' => 'XXX',
	 * 		'RequestType' =>  XXX,
	 * 		'RefundTypeSysNo' =>  XXX,
	 * 		'RefundBank' =>  XXX,
	 * 		'RefundAccountName' => 'XXX',
	 * 		'RefundAccountNo' => 'XXX',
	 * 		'RefundBankCity' =>  XXX,
	 * 		'ProvinceName' => 'XXX',
	 * 		'CityName' => 'XXX',
	 * 		'RefundBankSubBranchSysNo' =>  XXX,
	 * 		'AccounterTelephone' => 'XXX',
	 * 		'AccounterMobilephone' => 'XXX',
	 * 		'PickupMan' => 'XXX',
	 * 		'PickupTelephone' => 'XXX',
	 * 		'PickupMobilephone' => 'XXX',
	 * 		'PickupAreaSysNo' =>  XXX,
	 * 		'PickupAddress' => 'XXX',
	 * 		'PickupZip' => 'XXX',
	 * 		'PickupType' =>  XXX,
	 * 		'ETakeDate' => 'XXX',
	 * 		'ETakeTimeSpan' =>  XXX,
	 * 		'DoorGetFee' =>  XXX,
	 * 		'IsRevertAddress' =>  XXX,
	 * 		'RevertContact' => 'XXX',
	 * 		'RevertTelephone' => 'XXX',
	 * 		'RevertMobilephone' => 'XXX',
	 * 		'RevertAreaSysNo' =>  XXX,
	 * 		'RevertAddress' => 'XXX',
	 * 		'RevertZip' => 'XXX',
	 * 		'RequestAmt' =>  XXX,
	 * 		'RequestPoint' =>  XXX,
	 * 		'RequestDate' => 'XXX',
	 * 		'rowCreateDate' => 'XXX',
	 * 		'rowModifyDate' => 'XXX',
	 * 		'Status' =>  XXX,
	 * 		'Source' =>  XXX,
	 * 		'ReceiveSysNo' =>  XXX,
	 * 		'RevertSysNo' =>  XXX,
	 * 		'RefundSysNo' =>  XXX,
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
		$ttc = Config::getTTC('IRMARequestTTC');
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

		if(!empty(self::$ttcMap[$param['CustomerSysNo']]))
		{
			unset(self::$ttcMap[$param['CustomerSysNo']]);
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
		$ttc = Config::getTTC('IRMARequestTTC');
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
	 * 		'CustomerSysNo' =>  XXX,
	 * 		'RequestSysNo' => 'XXX',
	 * 		'SOSysNo' =>  XXX,
	 * 		'SOID' => 'XXX',
	 * 		'SoPayTypeSysNo' =>  XXX,
	 * 		'RequestFormType' =>  XXX,
	 * 		'SysNo' =>  XXX,
	 * 		'StockSysNo' =>  XXX,
	 * 		'Whid' =>  XXX,
	 * 		'RequestReason' =>  XXX,
	 * 		'ProductDesc' => 'XXX',
	 * 		'RequestType' =>  XXX,
	 * 		'RefundTypeSysNo' =>  XXX,
	 * 		'RefundBank' =>  XXX,
	 * 		'RefundAccountName' => 'XXX',
	 * 		'RefundAccountNo' => 'XXX',
	 * 		'RefundBankCity' =>  XXX,
	 * 		'ProvinceName' => 'XXX',
	 * 		'CityName' => 'XXX',
	 * 		'RefundBankSubBranchSysNo' =>  XXX,
	 * 		'AccounterTelephone' => 'XXX',
	 * 		'AccounterMobilephone' => 'XXX',
	 * 		'PickupMan' => 'XXX',
	 * 		'PickupTelephone' => 'XXX',
	 * 		'PickupMobilephone' => 'XXX',
	 * 		'PickupAreaSysNo' =>  XXX,
	 * 		'PickupAddress' => 'XXX',
	 * 		'PickupZip' => 'XXX',
	 * 		'PickupType' =>  XXX,
	 * 		'ETakeDate' => 'XXX',
	 * 		'ETakeTimeSpan' =>  XXX,
	 * 		'DoorGetFee' =>  XXX,
	 * 		'IsRevertAddress' =>  XXX,
	 * 		'RevertContact' => 'XXX',
	 * 		'RevertTelephone' => 'XXX',
	 * 		'RevertMobilephone' => 'XXX',
	 * 		'RevertAreaSysNo' =>  XXX,
	 * 		'RevertAddress' => 'XXX',
	 * 		'RevertZip' => 'XXX',
	 * 		'RequestAmt' =>  XXX,
	 * 		'RequestPoint' =>  XXX,
	 * 		'RequestDate' => 'XXX',
	 * 		'rowCreateDate' => 'XXX',
	 * 		'rowModifyDate' => 'XXX',
	 * 		'Status' =>  XXX,
	 * 		'Source' =>  XXX,
	 * 		'ReceiveSysNo' =>  XXX,
	 * 		'RevertSysNo' =>  XXX,
	 * 		'RefundSysNo' =>  XXX,
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
		$ttc = Config::getTTC('IRMARequestTTC');
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
		$ttc = Config::getTTC2('IRMARequestTTC');
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
		$ttc = Config::getTTC('IRMARequestTTC');
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

