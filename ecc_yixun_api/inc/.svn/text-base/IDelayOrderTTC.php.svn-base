<?php
/**
 * IDelayOrderTTC.php
 * 对TTC:t_onc_any_delay_node_的赠、查、删、改等操作
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	root
 */

global $_TTC_CFG;

$_TTC_CFG['IDelayOrderTTC']['TTCKEY']	= 'IDelayOrderTTC';
$_TTC_CFG['IDelayOrderTTC']['TABLE']	= 't_onc_any_delay_node_';
$_TTC_CFG['IDelayOrderTTC']['TimeOut']	= 1;
$_TTC_CFG['IDelayOrderTTC']['KEY']		= 'SOID';
$_TTC_CFG['IDelayOrderTTC']['FIELDS']	= array();//数据类型，int=1,string=2,binary=3
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['SOID'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['StockNo'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['CustomerSysNo'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['ReceiveCellPhone'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['DispatchDate'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['DispatchNodeSysNo'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['DispatchNodeName'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['DstStockNo'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['Status'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['PayTypeSysNo'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['OrderDate'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['ExpectDeliveryDate'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['ExpectDeliveryTimeSpan'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['AuditDeliveryDate'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['AuditDeliveryTimeSpan'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['CrtHoldingNode'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['DeliverRegion'] = array('type' => 2, 'min' => 0, 'max' => 128);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['ReceiveName'] = array('type' => 2, 'min' => 0, 'max' => 128);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['AuditTime'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['ServiceAuditTimeDemand'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['ServiceAuditTimeSpan'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['IsDelayAuditTime'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['OutTime'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['FinancialOutTimeDemand'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['FinancialOutTimeSpan'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['IsDelayOutTime'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['CheckQtyTime'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['StockPackTimeDemand'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['StockPackTimeSpan'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['IsDelayStockPackTime'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['DispatchPackageTime'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['DispatchPackageDemand'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['DispatchPackageTimeSpan'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['IsDelayDispatchPackage'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['DeliverPackageTime'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['DeliverPackageDemand'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['DeliverPackageTimeSpan'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['IsDelayDeliverPackage'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['ReceiveTime'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['DistributionScanDemand'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['DistributionScanSpan'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['IsDelayDistributionScan'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['CustomerReceiveTime'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['CustomerReceiveDemand'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['CustomerReceiveSpan'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['IsDelayCustomerReceive'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['rowCreateDate'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['rowModifyDate'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IDelayOrderTTC']['FIELDS']['flag'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);

class IDelayOrderTTC
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
	 * 		'SOID' => 'XXX',
	 * 		'StockNo' =>  XXX,
	 * 		'CustomerSysNo' =>  XXX,
	 * 		'ReceiveCellPhone' => 'XXX',
	 * 		'DispatchDate' =>  XXX,
	 * 		'DispatchNodeSysNo' =>  XXX,
	 * 		'DispatchNodeName' => 'XXX',
	 * 		'DstStockNo' =>  XXX,
	 * 		'Status' =>  XXX,
	 * 		'PayTypeSysNo' =>  XXX,
	 * 		'OrderDate' =>  XXX,
	 * 		'ExpectDeliveryDate' =>  XXX,
	 * 		'ExpectDeliveryTimeSpan' =>  XXX,
	 * 		'AuditDeliveryDate' =>  XXX,
	 * 		'AuditDeliveryTimeSpan' =>  XXX,
	 * 		'CrtHoldingNode' =>  XXX,
	 * 		'DeliverRegion' => 'XXX',
	 * 		'ReceiveName' => 'XXX',
	 * 		'AuditTime' =>  XXX,
	 * 		'ServiceAuditTimeDemand' =>  XXX,
	 * 		'ServiceAuditTimeSpan' =>  XXX,
	 * 		'IsDelayAuditTime' =>  XXX,
	 * 		'OutTime' =>  XXX,
	 * 		'FinancialOutTimeDemand' =>  XXX,
	 * 		'FinancialOutTimeSpan' =>  XXX,
	 * 		'IsDelayOutTime' =>  XXX,
	 * 		'CheckQtyTime' =>  XXX,
	 * 		'StockPackTimeDemand' =>  XXX,
	 * 		'StockPackTimeSpan' =>  XXX,
	 * 		'IsDelayStockPackTime' =>  XXX,
	 * 		'DispatchPackageTime' =>  XXX,
	 * 		'DispatchPackageDemand' =>  XXX,
	 * 		'DispatchPackageTimeSpan' =>  XXX,
	 * 		'IsDelayDispatchPackage' =>  XXX,
	 * 		'DeliverPackageTime' =>  XXX,
	 * 		'DeliverPackageDemand' =>  XXX,
	 * 		'DeliverPackageTimeSpan' =>  XXX,
	 * 		'IsDelayDeliverPackage' =>  XXX,
	 * 		'ReceiveTime' =>  XXX,
	 * 		'DistributionScanDemand' =>  XXX,
	 * 		'DistributionScanSpan' =>  XXX,
	 * 		'IsDelayDistributionScan' =>  XXX,
	 * 		'CustomerReceiveTime' =>  XXX,
	 * 		'CustomerReceiveDemand' =>  XXX,
	 * 		'CustomerReceiveSpan' =>  XXX,
	 * 		'IsDelayCustomerReceive' =>  XXX,
	 * 		'rowCreateDate' =>  XXX,
	 * 		'rowModifyDate' =>  XXX,
	 * 		'flag' =>  XXX,
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
		$ttc = Config::getTTC('IDelayOrderTTC');
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

		if(!empty(self::$ttcMap[$param['SOID']]))
		{
			unset(self::$ttcMap[$param['SOID']]);
		}

		return $v;
	}

	/**
	 * 更新一条TTC记录
	 * 
	 * @param	$param 格式: 
	 * 	array(
	 * 		'SOID' => 'XXX',
	 * 		'StockNo' =>  XXX,
	 * 		'CustomerSysNo' =>  XXX,
	 * 		'ReceiveCellPhone' => 'XXX',
	 * 		'DispatchDate' =>  XXX,
	 * 		'DispatchNodeSysNo' =>  XXX,
	 * 		'DispatchNodeName' => 'XXX',
	 * 		'DstStockNo' =>  XXX,
	 * 		'Status' =>  XXX,
	 * 		'PayTypeSysNo' =>  XXX,
	 * 		'OrderDate' =>  XXX,
	 * 		'ExpectDeliveryDate' =>  XXX,
	 * 		'ExpectDeliveryTimeSpan' =>  XXX,
	 * 		'AuditDeliveryDate' =>  XXX,
	 * 		'AuditDeliveryTimeSpan' =>  XXX,
	 * 		'CrtHoldingNode' =>  XXX,
	 * 		'DeliverRegion' => 'XXX',
	 * 		'ReceiveName' => 'XXX',
	 * 		'AuditTime' =>  XXX,
	 * 		'ServiceAuditTimeDemand' =>  XXX,
	 * 		'ServiceAuditTimeSpan' =>  XXX,
	 * 		'IsDelayAuditTime' =>  XXX,
	 * 		'OutTime' =>  XXX,
	 * 		'FinancialOutTimeDemand' =>  XXX,
	 * 		'FinancialOutTimeSpan' =>  XXX,
	 * 		'IsDelayOutTime' =>  XXX,
	 * 		'CheckQtyTime' =>  XXX,
	 * 		'StockPackTimeDemand' =>  XXX,
	 * 		'StockPackTimeSpan' =>  XXX,
	 * 		'IsDelayStockPackTime' =>  XXX,
	 * 		'DispatchPackageTime' =>  XXX,
	 * 		'DispatchPackageDemand' =>  XXX,
	 * 		'DispatchPackageTimeSpan' =>  XXX,
	 * 		'IsDelayDispatchPackage' =>  XXX,
	 * 		'DeliverPackageTime' =>  XXX,
	 * 		'DeliverPackageDemand' =>  XXX,
	 * 		'DeliverPackageTimeSpan' =>  XXX,
	 * 		'IsDelayDeliverPackage' =>  XXX,
	 * 		'ReceiveTime' =>  XXX,
	 * 		'DistributionScanDemand' =>  XXX,
	 * 		'DistributionScanSpan' =>  XXX,
	 * 		'IsDelayDistributionScan' =>  XXX,
	 * 		'CustomerReceiveTime' =>  XXX,
	 * 		'CustomerReceiveDemand' =>  XXX,
	 * 		'CustomerReceiveSpan' =>  XXX,
	 * 		'IsDelayCustomerReceive' =>  XXX,
	 * 		'rowCreateDate' =>  XXX,
	 * 		'rowModifyDate' =>  XXX,
	 * 		'flag' =>  XXX,
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
		$ttc = Config::getTTC('IDelayOrderTTC');
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

		if(!empty(self::$ttcMap[$param['SOID']]))
		{
			unset(self::$ttcMap[$param['SOID']]);
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
		$ttc = Config::getTTC('IDelayOrderTTC');
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
	 * 		'SOID' => 'XXX',
	 * 		'StockNo' =>  XXX,
	 * 		'CustomerSysNo' =>  XXX,
	 * 		'ReceiveCellPhone' => 'XXX',
	 * 		'DispatchDate' =>  XXX,
	 * 		'DispatchNodeSysNo' =>  XXX,
	 * 		'DispatchNodeName' => 'XXX',
	 * 		'DstStockNo' =>  XXX,
	 * 		'Status' =>  XXX,
	 * 		'PayTypeSysNo' =>  XXX,
	 * 		'OrderDate' =>  XXX,
	 * 		'ExpectDeliveryDate' =>  XXX,
	 * 		'ExpectDeliveryTimeSpan' =>  XXX,
	 * 		'AuditDeliveryDate' =>  XXX,
	 * 		'AuditDeliveryTimeSpan' =>  XXX,
	 * 		'CrtHoldingNode' =>  XXX,
	 * 		'DeliverRegion' => 'XXX',
	 * 		'ReceiveName' => 'XXX',
	 * 		'AuditTime' =>  XXX,
	 * 		'ServiceAuditTimeDemand' =>  XXX,
	 * 		'ServiceAuditTimeSpan' =>  XXX,
	 * 		'IsDelayAuditTime' =>  XXX,
	 * 		'OutTime' =>  XXX,
	 * 		'FinancialOutTimeDemand' =>  XXX,
	 * 		'FinancialOutTimeSpan' =>  XXX,
	 * 		'IsDelayOutTime' =>  XXX,
	 * 		'CheckQtyTime' =>  XXX,
	 * 		'StockPackTimeDemand' =>  XXX,
	 * 		'StockPackTimeSpan' =>  XXX,
	 * 		'IsDelayStockPackTime' =>  XXX,
	 * 		'DispatchPackageTime' =>  XXX,
	 * 		'DispatchPackageDemand' =>  XXX,
	 * 		'DispatchPackageTimeSpan' =>  XXX,
	 * 		'IsDelayDispatchPackage' =>  XXX,
	 * 		'DeliverPackageTime' =>  XXX,
	 * 		'DeliverPackageDemand' =>  XXX,
	 * 		'DeliverPackageTimeSpan' =>  XXX,
	 * 		'IsDelayDeliverPackage' =>  XXX,
	 * 		'ReceiveTime' =>  XXX,
	 * 		'DistributionScanDemand' =>  XXX,
	 * 		'DistributionScanSpan' =>  XXX,
	 * 		'IsDelayDistributionScan' =>  XXX,
	 * 		'CustomerReceiveTime' =>  XXX,
	 * 		'CustomerReceiveDemand' =>  XXX,
	 * 		'CustomerReceiveSpan' =>  XXX,
	 * 		'IsDelayCustomerReceive' =>  XXX,
	 * 		'rowCreateDate' =>  XXX,
	 * 		'rowModifyDate' =>  XXX,
	 * 		'flag' =>  XXX,
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
		$ttc = Config::getTTC('IDelayOrderTTC');
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
		$ttc = Config::getTTC2('IDelayOrderTTC');
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
		$ttc = Config::getTTC('IDelayOrderTTC');
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
		$ttc = Config::getTTC('IDelayOrderTTC');
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

