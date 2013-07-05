<?php
/**
 * IProductRepair.php
 * 对TTC:t_product_repair的赠、查、删、改等操作
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	andyyao
 */

global $_TTC_CFG;

$_TTC_CFG['IProductRepair']['TTCKEY']	= 'IProductRepair';
$_TTC_CFG['IProductRepair']['TABLE']	= 't_product_repair';
$_TTC_CFG['IProductRepair']['TimeOut']	= 1;
$_TTC_CFG['IProductRepair']['KEY']		= 'repair_id';
$_TTC_CFG['IProductRepair']['FIELDS']	= array();//数据类型，int=1,string=2,binary=3
$_TTC_CFG['IProductRepair']['FIELDS']['repair_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IProductRepair']['FIELDS']['status'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IProductRepair']['FIELDS']['type'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IProductRepair']['FIELDS']['receiver_mode'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IProductRepair']['FIELDS']['contact'] = array('type' => 2, 'min' => 0, 'max' => 32);
$_TTC_CFG['IProductRepair']['FIELDS']['mobile'] = array('type' => 2, 'min' => 0, 'max' => 16);
$_TTC_CFG['IProductRepair']['FIELDS']['phone'] = array('type' => 2, 'min' => 0, 'max' => 64);
$_TTC_CFG['IProductRepair']['FIELDS']['receiver_zipcode'] = array('type' => 2, 'min' => 0, 'max' => 16);
$_TTC_CFG['IProductRepair']['FIELDS']['receiver_pid'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IProductRepair']['FIELDS']['receiver_addr'] = array('type' => 2, 'min' => 0, 'max' => 256);
$_TTC_CFG['IProductRepair']['FIELDS']['same_addr'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IProductRepair']['FIELDS']['delivery_pid'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IProductRepair']['FIELDS']['delivery_addr'] = array('type' => 2, 'min' => 0, 'max' => 256);
$_TTC_CFG['IProductRepair']['FIELDS']['appendix'] = array('type' => 2, 'min' => 0, 'max' => 512);
$_TTC_CFG['IProductRepair']['FIELDS']['appearance'] = array('type' => 2, 'min' => 0, 'max' => 512);
$_TTC_CFG['IProductRepair']['FIELDS']['packing'] = array('type' => 2, 'min' => 0, 'max' => 512);
$_TTC_CFG['IProductRepair']['FIELDS']['with_invoice'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IProductRepair']['FIELDS']['report'] = array('type' => 2, 'min' => 0, 'max' => 512);
$_TTC_CFG['IProductRepair']['FIELDS']['problem_desc'] = array('type' => 2, 'min' => 0, 'max' => 512);
$_TTC_CFG['IProductRepair']['FIELDS']['applytime'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IProductRepair']['FIELDS']['repair_note'] = array('type' => 2, 'min' => 0, 'max' => 256);

class IProductRepair
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
	 * 		'repair_id' =>  XXX,
	 * 		'status' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'receiver_mode' =>  XXX,
	 * 		'contact' => 'XXX',
	 * 		'mobile' => 'XXX',
	 * 		'phone' => 'XXX',
	 * 		'receiver_zipcode' => 'XXX',
	 * 		'receiver_pid' =>  XXX,
	 * 		'receiver_addr' => 'XXX',
	 * 		'same_addr' =>  XXX,
	 * 		'delivery_pid' =>  XXX,
	 * 		'delivery_addr' => 'XXX',
	 * 		'appendix' => 'XXX',
	 * 		'appearance' => 'XXX',
	 * 		'packing' => 'XXX',
	 * 		'with_invoice' =>  XXX,
	 * 		'report' => 'XXX',
	 * 		'problem_desc' => 'XXX',
	 * 		'applytime' =>  XXX,
	 * 		'repair_note' => 'XXX',
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
		$ttc = Config::getTTC('IProductRepair');
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

		if(!empty(self::$ttcMap[$param['repair_id']]))
		{
			unset(self::$ttcMap[$param['repair_id']]);
		}

		return $v;
	}

	/**
	 * 更新一条TTC记录
	 * 
	 * @param	$param 格式: 
	 * 	array(
	 * 		'repair_id' =>  XXX,
	 * 		'status' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'receiver_mode' =>  XXX,
	 * 		'contact' => 'XXX',
	 * 		'mobile' => 'XXX',
	 * 		'phone' => 'XXX',
	 * 		'receiver_zipcode' => 'XXX',
	 * 		'receiver_pid' =>  XXX,
	 * 		'receiver_addr' => 'XXX',
	 * 		'same_addr' =>  XXX,
	 * 		'delivery_pid' =>  XXX,
	 * 		'delivery_addr' => 'XXX',
	 * 		'appendix' => 'XXX',
	 * 		'appearance' => 'XXX',
	 * 		'packing' => 'XXX',
	 * 		'with_invoice' =>  XXX,
	 * 		'report' => 'XXX',
	 * 		'problem_desc' => 'XXX',
	 * 		'applytime' =>  XXX,
	 * 		'repair_note' => 'XXX',
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
		$ttc = Config::getTTC('IProductRepair');
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

		if(!empty(self::$ttcMap[$param['repair_id']]))
		{
			unset(self::$ttcMap[$param['repair_id']]);
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
		$ttc = Config::getTTC('IProductRepair');
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
	 * 		'repair_id' =>  XXX,
	 * 		'status' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'receiver_mode' =>  XXX,
	 * 		'contact' => 'XXX',
	 * 		'mobile' => 'XXX',
	 * 		'phone' => 'XXX',
	 * 		'receiver_zipcode' => 'XXX',
	 * 		'receiver_pid' =>  XXX,
	 * 		'receiver_addr' => 'XXX',
	 * 		'same_addr' =>  XXX,
	 * 		'delivery_pid' =>  XXX,
	 * 		'delivery_addr' => 'XXX',
	 * 		'appendix' => 'XXX',
	 * 		'appearance' => 'XXX',
	 * 		'packing' => 'XXX',
	 * 		'with_invoice' =>  XXX,
	 * 		'report' => 'XXX',
	 * 		'problem_desc' => 'XXX',
	 * 		'applytime' =>  XXX,
	 * 		'repair_note' => 'XXX',
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

		$ttc = Config::getTTC('IProductRepair');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->get($key, $filter, !$multiItem);
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
		$ttc = Config::getTTC2('IProductRepair');
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

