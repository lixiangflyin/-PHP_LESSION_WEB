<?php
/**
 * ILogInfo.php
 * ��װILoginfoTTC.php���ṩ�����顢ɾ���ĵȲ���
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
	 * ����һ��TTC��¼
	 * 
	 * @param	$param ��ʽ: 
	 * 	array(
	 * 		'content' => 'XXX',
	 * 		'status' =>  XXX,
	 * 		'addtime' =>  XXX,
	 * 		'updatetime' =>  XXX,
	 * 		)
	 * 
	 * ����ֵ����ȷ����true�����󷵻�false
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
	 * ����һ��TTC��¼
	 * 
	 * @param	$param ��ʽ: 
	 * 	array(
	 * 		'logid' =>  XXX,   //key
	 * 		'content' => 'XXX',
	 * 		'status' =>  XXX,
	 * 		'addtime' =>  XXX,
	 * 		'updatetime' =>  XXX,
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
	 * ȡһ��TTC��¼
	 * 
	 * @param   string  $key		���ݿ������
	 * @param   array   $filter	��ѡ����, ���ֶ�keyʱ��ѡ, ����array('field2' => 1, 'field3' => 2)
	 * 
	 * ����ֵ����ȷ�������ݣ����󷵻�false
	 * ���ݸ�ʽ:
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
	 * ����ȡTTC��¼
	 * 
	 * @param   string  $keys		���ݿ����������
	 * 
	 * ����ֵ����ȷ�������ݣ����󷵻�false
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