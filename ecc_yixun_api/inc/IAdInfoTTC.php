<?php
/**
 * IAdInfoTTC.php
 * ��TTC:t_ad_info�������顢ɾ���ĵȲ���
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	root
 */

global $_TTC_CFG;

$_TTC_CFG['IAdInfoTTC']['TTCKEY']	= 'IAdInfoTTC';
$_TTC_CFG['IAdInfoTTC']['TABLE']	= 't_ad_info';
$_TTC_CFG['IAdInfoTTC']['TimeOut']	= 1;
$_TTC_CFG['IAdInfoTTC']['KEY']		= 'mid';
$_TTC_CFG['IAdInfoTTC']['FIELDS']	= array();//�������ͣ�int=1,string=2,binary=3
$_TTC_CFG['IAdInfoTTC']['FIELDS']['mid'] = array('type' => 1, 'min' => -128, 'max' => 127);
$_TTC_CFG['IAdInfoTTC']['FIELDS']['aid'] = array('type' => 1, 'min' => 0, 'max' => 4294967295, 'auto' => 1);
$_TTC_CFG['IAdInfoTTC']['FIELDS']['name'] = array('type' => 2, 'min' => 0, 'max' => 100);
$_TTC_CFG['IAdInfoTTC']['FIELDS']['starttime'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IAdInfoTTC']['FIELDS']['endtime'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IAdInfoTTC']['FIELDS']['url'] = array('type' => 2, 'min' => 0, 'max' => 128);
$_TTC_CFG['IAdInfoTTC']['FIELDS']['adurl'] = array('type' => 2, 'min' => 0, 'max' => 128);
$_TTC_CFG['IAdInfoTTC']['FIELDS']['adurl2'] = array('type' => 2, 'min' => 0, 'max' => 128);
$_TTC_CFG['IAdInfoTTC']['FIELDS']['content'] = array('type' => 2, 'min' => 0, 'max' => 1024);
$_TTC_CFG['IAdInfoTTC']['FIELDS']['status'] = array('type' => 1, 'min' => -128, 'max' => 127);
$_TTC_CFG['IAdInfoTTC']['FIELDS']['comment'] = array('type' => 2, 'min' => 0, 'max' => 200);
$_TTC_CFG['IAdInfoTTC']['FIELDS']['gid'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IAdInfoTTC']['FIELDS']['createtime'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IAdInfoTTC']['FIELDS']['updatetime'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IAdInfoTTC']['FIELDS']['user_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);

class IAdInfoTTC
{
	/**
	 * �������
	 */
	public static $errCode = 0;

	/**
	 * ������Ϣ
	 */
	public static $errMsg  = '';

	/**
	 * ttc��¼Map
	 */
	public static $ttcMap  = array();


	/**
	 * ��������ʶ����ÿ����������ǰ����
	 */
	private static function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}

	/**
	 * ����һ��TTC��¼
	 * 
	 * @param	$param ��ʽ: 
	 * 	array(
	 * 		'mid' =>  XXX,
	 * 		'aid' =>  XXX,
	 * 		'name' => 'XXX',
	 * 		'starttime' => 'XXX',
	 * 		'endtime' => 'XXX',
	 * 		'url' => 'XXX',
	 * 		'adurl' => 'XXX',
	 * 		'adurl2' => 'XXX',
	 * 		'content' => 'XXX',
	 * 		'status' =>  XXX,
	 * 		'comment' => 'XXX',
	 * 		'gid' =>  XXX,
	 * 		'createtime' => 'XXX',
	 * 		'updatetime' => 'XXX',
	 * 		'user_id' =>  XXX,
	 * 		)
	 * 
	 * ����ֵ����ȷ����true�����󷵻�false
	 */
	public static function insert($param)
	{
		self::clearErr();
		
		if(empty($param) || !is_array($param))
		{
			self::$errCode = 111;
			self::$errMsg  = 'param is empty';
		}
		$ttc = Config::getTTC('IAdInfoTTC');
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

		if(!empty(self::$ttcMap[$param['mid']]))
		{
			unset(self::$ttcMap[$param['mid']]);
		}

		return $v;
	}

	/**
	 * ����һ��TTC��¼
	 * 
	 * @param	$param ��ʽ: 
	 * 	array(
	 * 		'mid' =>  XXX,
	 * 		'aid' =>  XXX,
	 * 		'name' => 'XXX',
	 * 		'starttime' => 'XXX',
	 * 		'endtime' => 'XXX',
	 * 		'url' => 'XXX',
	 * 		'adurl' => 'XXX',
	 * 		'adurl2' => 'XXX',
	 * 		'content' => 'XXX',
	 * 		'status' =>  XXX,
	 * 		'comment' => 'XXX',
	 * 		'gid' =>  XXX,
	 * 		'createtime' => 'XXX',
	 * 		'updatetime' => 'XXX',
	 * 		'user_id' =>  XXX,
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
		$ttc = Config::getTTC('IAdInfoTTC');
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

		if(!empty(self::$ttcMap[$param['mid']]))
		{
			unset(self::$ttcMap[$param['mid']]);
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
		$ttc = Config::getTTC('IAdInfoTTC');
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
	 * ȡһ��TTC��¼
	 * 
	 * @param   string  $key		���ݿ������
	 * @param   array   $multikey	��ѡ����, ���ֶ�keyʱ��ѡ, ����array('field2' => 1, 'field3' => 2)
	 * 
	 * ����ֵ����ȷ�������ݣ����󷵻�false
	 * ���ݸ�ʽ:
	 * 	array(
	 * 		'mid' =>  XXX,
	 * 		'aid' =>  XXX,
	 * 		'name' => 'XXX',
	 * 		'starttime' => 'XXX',
	 * 		'endtime' => 'XXX',
	 * 		'url' => 'XXX',
	 * 		'adurl' => 'XXX',
	 * 		'adurl2' => 'XXX',
	 * 		'content' => 'XXX',
	 * 		'status' =>  XXX,
	 * 		'comment' => 'XXX',
	 * 		'gid' =>  XXX,
	 * 		'createtime' => 'XXX',
	 * 		'updatetime' => 'XXX',
	 * 		'user_id' =>  XXX,
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
		$ttc = Config::getTTC('IAdInfoTTC');
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
	 * ����ȡTTC��¼
	 * 
	 * @param   string  $keys		���ݿ����������
	 * 
	 * ����ֵ����ȷ�������ݣ����󷵻�false
	 */
	public static function gets($keys, $filter=array(), $need=array())
	{
		self::clearErr();
		
		if(empty($keys) || !is_array($keys))
		{
			self::$errCode = 111;
			self::$errMsg  = 'keys is empty';
		}
		$ttc = Config::getTTC2('IAdInfoTTC');
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
	 * ȡ����TTCӰ�������
	 * 
	 * 
	 * ����ֵ����ȷ����>-1�����������󷵻ظ���
	 */
	public static function getTTCAffectRows()
	{
		$ttc = Config::getTTC('IAdInfoTTC');
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

