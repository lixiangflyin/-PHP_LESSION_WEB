<?php
/**
 * ILogInfo.php
 * 封装ILoginfoTTC.php，提供增、查、删、改等操作
 * @author Daopingsun
 * @version 1.0
 * @created 2012/8/10 20:07:40
 */

class ILogInfo
{
	public static $errCode = 0;
	public static $errMsg = '';
	
	private static function setERR($code, $msg){
		self::$errCode = $code;
		self::$errMsg = $msg;
	}

	private static function clearERR(){
		self::setERR(0, '');
	}
	
	/**
	 * 增加一条TTC记录
	 * 
	 * @param	$param 格式: 
	 * 	array(
	 * 		'content' => 'XXX',
	 * 		'status' =>  XXX,
	 * 		'addtime' =>  XXX,
	 * 		'updatetime' =>  XXX,
	 * 		)
	 * 
	 * 返回值：正确返回true，错误返回false
	 */
	public static function insert($param){
		self::clearErr();
		
		if(empty($param) || !is_array($param))
		{
			self::$errCode = 111;
			self::$errMsg  = 'param is empty';
		}

		$v = ILoginfoTTC::insert($param);
		if(false === $v)
		{
			self::$errCode = ILoginfoTTC::$errCode;
			self::$errMsg  = ILoginfoTTC::$errMsg;
			return false;
		}
		return $v;
	}
	/**
	 * 更新一条TTC记录
	 * 
	 * @param	$param 格式: 
	 * 	array(
	 * 		'logid' =>  XXX,   //key
	 * 		'content' => 'XXX',
	 * 		'status' =>  XXX,
	 * 		'addtime' =>  XXX,
	 * 		'updatetime' =>  XXX,
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

		$v = ILoginfoTTC::update($param, $filter);
		if(false === $v)
		{
			self::$errCode = ILoginfoTTC::$errCode;
			self::$errMsg  = ILoginfoTTC::$errMsg;
			return false;
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
		$v = ILoginfoTTC::remove($key, $filter);
		if(false === $v)
		{
			self::$errCode = ILoginfoTTC::$errCode;
			self::$errMsg  = ILoginfoTTC::$errMsg;
			return false;
		}

		return $v;
	}
	/**
	 * 取一条TTC记录
	 * 
	 * @param   string  $key		数据库的主键
	 * @param   array   $filter	可选参数, 多字段key时必选, 形如array('field2' => 1, 'field3' => 2)
	 * 
	 * 返回值：正确返回数据，错误返回false
	 * 数据格式:
	 * 	array(
	 * 		'logid' =>  XXX,
	 * 		'content' => 'XXX',
	 * 		'status' =>  XXX,
	 * 		'addtime' =>  XXX,
	 * 		'updatetime' =>  XXX,
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

		$v = ILoginfoTTC::get($key, $filter, $need , $itemLimit, $start );
		if(false === $v)
		{
			self::$errCode = ILoginfoTTC::$errCode;
			self::$errMsg  = ILoginfoTTC::$errMsg;
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
//	public static function gets($keys, $filter=array(), $need=array())
//	{
//		self::clearErr();
//		
//		if(empty($keys) || !is_array($keys))
//		{
//			self::$errCode = 111;
//			self::$errMsg  = 'keys is empty';
//		}
//
//		$v = ILoginfoTTC::get($keys, $filter, $need);
//		if(false === $v)
//		{
//			self::$errCode = ILoginfoTTC::$errCode;
//			self::$errMsg  = ILoginfoTTC::$errMsg;
//			return false;
//		}
//
//		return $v;
//	}
//	
}