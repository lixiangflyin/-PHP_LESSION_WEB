<?php
/**
 * IServiceApplyTTC.php
 * 对TTC:service_apply的赠、查、删、改等操�?
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	myforchen
 */

global $_TTC_CFG;

$_TTC_CFG['IServiceApplyTTC']['TTCKEY']	= 'IServiceApplyTTC';
$_TTC_CFG['IServiceApplyTTC']['TABLE']	= 'service_apply';
$_TTC_CFG['IServiceApplyTTC']['TimeOut']	= 1;
$_TTC_CFG['IServiceApplyTTC']['KEY']		= 'buyer_id';
$_TTC_CFG['IServiceApplyTTC']['FIELDS']	= array();//数据类型，int=1,string=2,binary=3
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['buyer_id'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['id'] = array('type' => 1, 'min' => 0, 'max' => 1.844674407371E+19);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['type'] = array('type' => 1, 'min' => 0, 'max' => 255);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['subtype'] = array('type' => 1, 'min' => 0, 'max' => 255);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['state'] = array('type' => 1, 'min' => 0, 'max' => 255);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['order_id'] = array('type' => 2, 'min' => 0, 'max' => 40);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['postsale_id'] = array('type' => 2, 'min' => 0, 'max' => 255);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['mobile'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['telephone'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['title'] = array('type' => 2, 'min' => 0, 'max' => 255);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['content'] = array('type' => 2, 'min' => 0, 'max' => 1536);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['attachment'] = array('type' => 2, 'min' => 0, 'max' => 65535);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['issatisfaction'] = array('type' => 1, 'min' => 0, 'max' => 255);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['follow_kf'] = array('type' => 2, 'min' => 0, 'max' => 50);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['time_create'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['time_firstreply'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['time_lastreply'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['role_lastreply'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['time_modify_state'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['isfollow'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['ext1'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['ext2'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['ext3'] = array('type' => 2, 'min' => 0, 'max' => 255);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['ext4'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['ext5'] = array('type' => 2, 'min' => 0, 'max' => 255);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['ext6'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['ext7'] = array('type' => 2, 'min' => 0, 'max' => 255);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['ext8'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['ext9'] = array('type' => 2, 'min' => 0, 'max' => 255);
$_TTC_CFG['IServiceApplyTTC']['FIELDS']['ext10'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);

class IServiceApplyTTC
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
	 * 清除错误标识，在每个函数调用前调�?
	 */
	private static function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}

	/**
	 * 增加�?条TTC记录
	 * 
	 * @param	$param 格式: 
	 * 	array(
	 * 		'buyer_id' => 'XXX',
	 * 		'id' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'state' =>  XXX,
	 * 		'order_id' => 'XXX',
	 * 		'postsale_id' => 'XXX',
	 * 		'mobile' => 'XXX',
	 * 		'telephone' => 'XXX',
	 * 		'title' => 'XXX',
	 * 		'content' => 'XXX',
	 * 		'attachment' => 'XXX',
	 * 		'issatisfaction' =>  XXX,
	 * 		'follow_kf' => 'XXX',
	 * 		'time_create' =>  XXX,
	 * 		'time_firstreply' =>  XXX,
	 * 		'time_lastreply' =>  XXX,
	 * 		'role_lastreply' =>  XXX,
	 * 		'time_modify_state' =>  XXX,
	 * 		'isfollow' =>  XXX,
	 * 		'ext1' => 'XXX',
	 * 		'ext2' =>  XXX,
	 * 		'ext3' => 'XXX',
	 * 		'ext4' =>  XXX,
	 * 		'ext5' => 'XXX',
	 * 		'ext6' =>  XXX,
	 * 		'ext7' => 'XXX',
	 * 		'ext8' =>  XXX,
	 * 		'ext9' => 'XXX',
	 * 		'ext10' =>  XXX,
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
		$ttc = Config::getTTC('IServiceApplyTTC');
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

		if(!empty(self::$ttcMap[$param['buyer_id']]))
		{
			unset(self::$ttcMap[$param['buyer_id']]);
		}

		return $v;
	}

	/**
	 * 更新�?条TTC记录
	 * 
	 * @param	$param 格式: 
	 * 	array(
	 * 		'buyer_id' => 'XXX',
	 * 		'id' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'state' =>  XXX,
	 * 		'order_id' => 'XXX',
	 * 		'postsale_id' => 'XXX',
	 * 		'mobile' => 'XXX',
	 * 		'telephone' => 'XXX',
	 * 		'title' => 'XXX',
	 * 		'content' => 'XXX',
	 * 		'attachment' => 'XXX',
	 * 		'issatisfaction' =>  XXX,
	 * 		'follow_kf' => 'XXX',
	 * 		'time_create' =>  XXX,
	 * 		'time_firstreply' =>  XXX,
	 * 		'time_lastreply' =>  XXX,
	 * 		'role_lastreply' =>  XXX,
	 * 		'time_modify_state' =>  XXX,
	 * 		'isfollow' =>  XXX,
	 * 		'ext1' => 'XXX',
	 * 		'ext2' =>  XXX,
	 * 		'ext3' => 'XXX',
	 * 		'ext4' =>  XXX,
	 * 		'ext5' => 'XXX',
	 * 		'ext6' =>  XXX,
	 * 		'ext7' => 'XXX',
	 * 		'ext8' =>  XXX,
	 * 		'ext9' => 'XXX',
	 * 		'ext10' =>  XXX,
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
		$ttc = Config::getTTC('IServiceApplyTTC');
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

		if(!empty(self::$ttcMap[$param['buyer_id']]))
		{
			unset(self::$ttcMap[$param['buyer_id']]);
		}

		return $v;
	}

	/**
	 * 删除�?条TTC记录
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
		$ttc = Config::getTTC('IServiceApplyTTC');
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
	 * @param   array   $multikey	可�?�参�?, 多字段key时必�?, 形如array('field2' => 1, 'field3' => 2)
	 * 
	 * 返回值：正确返回数据，错误返回false
	 * 数据格式:
	 * 	array(
	 * 		'buyer_id' => 'XXX',
	 * 		'id' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'state' =>  XXX,
	 * 		'order_id' => 'XXX',
	 * 		'postsale_id' => 'XXX',
	 * 		'mobile' => 'XXX',
	 * 		'telephone' => 'XXX',
	 * 		'title' => 'XXX',
	 * 		'content' => 'XXX',
	 * 		'attachment' => 'XXX',
	 * 		'issatisfaction' =>  XXX,
	 * 		'follow_kf' => 'XXX',
	 * 		'time_create' =>  XXX,
	 * 		'time_firstreply' =>  XXX,
	 * 		'time_lastreply' =>  XXX,
	 * 		'role_lastreply' =>  XXX,
	 * 		'time_modify_state' =>  XXX,
	 * 		'isfollow' =>  XXX,
	 * 		'ext1' => 'XXX',
	 * 		'ext2' =>  XXX,
	 * 		'ext3' => 'XXX',
	 * 		'ext4' =>  XXX,
	 * 		'ext5' => 'XXX',
	 * 		'ext6' =>  XXX,
	 * 		'ext7' => 'XXX',
	 * 		'ext8' =>  XXX,
	 * 		'ext9' => 'XXX',
	 * 		'ext10' =>  XXX,
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
		$ttc = Config::getTTC('IServiceApplyTTC');
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
	 * 取一条TTC记录，支持大于�?�小于等条件
	 * 
	 * @param   string  $key		数据库的主键
	 * 
	 * 返回值：正确返回数据，错误返回false
	 * 数据格式:
	 * 	array(
	 * 		'buyer_id' => 'XXX',
	 * 		'id' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'state' =>  XXX,
	 * 		'order_id' => 'XXX',
	 * 		'postsale_id' => 'XXX',
	 * 		'mobile' => 'XXX',
	 * 		'telephone' => 'XXX',
	 * 		'title' => 'XXX',
	 * 		'content' => 'XXX',
	 * 		'attachment' => 'XXX',
	 * 		'issatisfaction' =>  XXX,
	 * 		'follow_kf' => 'XXX',
	 * 		'time_create' =>  XXX,
	 * 		'time_firstreply' =>  XXX,
	 * 		'time_lastreply' =>  XXX,
	 * 		'role_lastreply' =>  XXX,
	 * 		'time_modify_state' =>  XXX,
	 * 		'isfollow' =>  XXX,
	 * 		'ext1' => 'XXX',
	 * 		'ext2' =>  XXX,
	 * 		'ext3' => 'XXX',
	 * 		'ext4' =>  XXX,
	 * 		'ext5' => 'XXX',
	 * 		'ext6' =>  XXX,
	 * 		'ext7' => 'XXX',
	 * 		'ext8' =>  XXX,
	 * 		'ext9' => 'XXX',
	 * 		'ext10' =>  XXX,
	 * 		)
	 */
	public static function getc($key, $eqs = array(), $lts = array(), $gts = array(), $need = array(), $itemLimit = 0, $start = 0)
	{
		self::clearErr();
		
		if(empty($key))
		{
			self::$errCode = 111;
			self::$errMsg  = 'key is empty';
		}
		$ttc = Config::getTTC('IServiceApplyTTC');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->getc($key, $eqs, $lts, $gts, $need , $itemLimit, $start );
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
		$ttc = Config::getTTC2('IServiceApplyTTC');
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
	 * 取操作TTC影响的行�?
	 * 
	 * 
	 * 返回值：正确返回>-1的行数，错误返回负数
	 */
	public static function getTTCAffectRows()
	{
		$ttc = Config::getTTC('IServiceApplyTTC');
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

