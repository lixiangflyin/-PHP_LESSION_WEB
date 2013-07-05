<?php
/**
 * IActCountDownTTC.php
 * 对TTC:t_act_countdown的赠、查、删、改等操作
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	oscarzhu
 */

global $_TTC_CFG;

$_TTC_CFG['IActCountDownTTC']['TTCKEY']	= 'IActCountDownTTC';
$_TTC_CFG['IActCountDownTTC']['TABLE']	= 't_act_countdown';
$_TTC_CFG['IActCountDownTTC']['TimeOut']	= 1;
$_TTC_CFG['IActCountDownTTC']['KEY']		= 'wh_id';
$_TTC_CFG['IActCountDownTTC']['FIELDS']	= array();//数据类型，int=1,string=2,binary=3
$_TTC_CFG['IActCountDownTTC']['FIELDS']['wh_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['oid'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['bid'] = array('type' => 1, 'min' => 0, 'max' => 255);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['product_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['user_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['CountDownCurrentPrice'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['CountDownCashRebate'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['CountDownCashPoint'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['CountDownQty'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['SnapShotCurrentPrice'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['SnapShotCashRebate'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['SnapShotCashPoint'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['SnapShotUnitCost'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['AffectedVirtualQty'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['Type'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['PloyType'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['BatchNo'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['Status'] = array('type' => 1, 'min' => -128, 'max' => 127);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['CreateTime'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['StartTime'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['EndTime'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['rowCreateDate'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['rowModifyDate'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['OldQty'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['c3_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['c3_name'] = array('type' => 2, 'min' => 0, 'max' => 255);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['c2_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['c2_name'] = array('type' => 2, 'min' => 0, 'max' => 255);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['c1_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IActCountDownTTC']['FIELDS']['c1_name'] = array('type' => 2, 'min' => 0, 'max' => 255);

class IActCountDownTTC
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
	public static function getErrMsg()
	{
		return self::$errMsg;
	}



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
	 * 		'wh_id' =>  XXX,
	 * 		'oid' =>  XXX,
	 * 		'bid' =>  XXX,
	 * 		'product_id' =>  XXX,
	 * 		'user_id' =>  XXX,
	 * 		'CountDownCurrentPrice' =>  XXX,
	 * 		'CountDownCashRebate' =>  XXX,
	 * 		'CountDownCashPoint' =>  XXX,
	 * 		'CountDownQty' =>  XXX,
	 * 		'SnapShotCurrentPrice' =>  XXX,
	 * 		'SnapShotCashRebate' =>  XXX,
	 * 		'SnapShotCashPoint' =>  XXX,
	 * 		'SnapShotUnitCost' =>  XXX,
	 * 		'AffectedVirtualQty' =>  XXX,
	 * 		'Type' =>  XXX,
	 * 		'PloyType' =>  XXX,
	 * 		'BatchNo' =>  XXX,
	 * 		'Status' =>  XXX,
	 * 		'CreateTime' => 'XXX',
	 * 		'StartTime' => 'XXX',
	 * 		'EndTime' => 'XXX',
	 * 		'rowCreateDate' => 'XXX',
	 * 		'rowModifyDate' => 'XXX',
	 * 		'OldQty' =>  XXX,
	 * 		'c3_id' =>  XXX,
	 * 		'c3_name' => 'XXX',
	 * 		'c2_id' =>  XXX,
	 * 		'c2_name' => 'XXX',
	 * 		'c1_id' =>  XXX,
	 * 		'c1_name' => 'XXX',
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
		$ttc = Config::getTTC('IActCountDownTTC');
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

		if(!empty(self::$ttcMap[$param['wh_id']]))
		{
			unset(self::$ttcMap[$param['wh_id']]);
		}

		return $v;
	}

	/**
	 * 更新一条TTC记录
	 * 
	 * @param	$param 格式: 
	 * 	array(
	 * 		'wh_id' =>  XXX,
	 * 		'oid' =>  XXX,
	 * 		'bid' =>  XXX,
	 * 		'product_id' =>  XXX,
	 * 		'user_id' =>  XXX,
	 * 		'CountDownCurrentPrice' =>  XXX,
	 * 		'CountDownCashRebate' =>  XXX,
	 * 		'CountDownCashPoint' =>  XXX,
	 * 		'CountDownQty' =>  XXX,
	 * 		'SnapShotCurrentPrice' =>  XXX,
	 * 		'SnapShotCashRebate' =>  XXX,
	 * 		'SnapShotCashPoint' =>  XXX,
	 * 		'SnapShotUnitCost' =>  XXX,
	 * 		'AffectedVirtualQty' =>  XXX,
	 * 		'Type' =>  XXX,
	 * 		'PloyType' =>  XXX,
	 * 		'BatchNo' =>  XXX,
	 * 		'Status' =>  XXX,
	 * 		'CreateTime' => 'XXX',
	 * 		'StartTime' => 'XXX',
	 * 		'EndTime' => 'XXX',
	 * 		'rowCreateDate' => 'XXX',
	 * 		'rowModifyDate' => 'XXX',
	 * 		'OldQty' =>  XXX,
	 * 		'c3_id' =>  XXX,
	 * 		'c3_name' => 'XXX',
	 * 		'c2_id' =>  XXX,
	 * 		'c2_name' => 'XXX',
	 * 		'c1_id' =>  XXX,
	 * 		'c1_name' => 'XXX',
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
		$ttc = Config::getTTC('IActCountDownTTC');
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

		if(!empty(self::$ttcMap[$param['wh_id']]))
		{
			unset(self::$ttcMap[$param['wh_id']]);
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
		$ttc = Config::getTTC('IActCountDownTTC');
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
	 * 		'wh_id' =>  XXX,
	 * 		'oid' =>  XXX,
	 * 		'bid' =>  XXX,
	 * 		'product_id' =>  XXX,
	 * 		'user_id' =>  XXX,
	 * 		'CountDownCurrentPrice' =>  XXX,
	 * 		'CountDownCashRebate' =>  XXX,
	 * 		'CountDownCashPoint' =>  XXX,
	 * 		'CountDownQty' =>  XXX,
	 * 		'SnapShotCurrentPrice' =>  XXX,
	 * 		'SnapShotCashRebate' =>  XXX,
	 * 		'SnapShotCashPoint' =>  XXX,
	 * 		'SnapShotUnitCost' =>  XXX,
	 * 		'AffectedVirtualQty' =>  XXX,
	 * 		'Type' =>  XXX,
	 * 		'PloyType' =>  XXX,
	 * 		'BatchNo' =>  XXX,
	 * 		'Status' =>  XXX,
	 * 		'CreateTime' => 'XXX',
	 * 		'StartTime' => 'XXX',
	 * 		'EndTime' => 'XXX',
	 * 		'rowCreateDate' => 'XXX',
	 * 		'rowModifyDate' => 'XXX',
	 * 		'OldQty' =>  XXX,
	 * 		'c3_id' =>  XXX,
	 * 		'c3_name' => 'XXX',
	 * 		'c2_id' =>  XXX,
	 * 		'c2_name' => 'XXX',
	 * 		'c1_id' =>  XXX,
	 * 		'c1_name' => 'XXX',
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
		$ttc = Config::getTTC('IActCountDownTTC');
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
		$ttc = Config::getTTC2('IActCountDownTTC');
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
		$ttc = Config::getTTC('IActCountDownTTC');
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

