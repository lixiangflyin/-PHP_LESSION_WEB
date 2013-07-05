<?php
/**
 * IUserAddressTTC.php
 * ��TTC:t_user_address�������顢ɾ���ĵȲ���
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	andyyao
 */

global $_TTC_CFG;

$_TTC_CFG['IUserAddressTTC']['TTCKEY']	= 'IUserAddressTTC';
$_TTC_CFG['IUserAddressTTC']['TABLE']	= 't_user_address';
$_TTC_CFG['IUserAddressTTC']['TimeOut']	= 1;
$_TTC_CFG['IUserAddressTTC']['KEY']		= 'uid';
$_TTC_CFG['IUserAddressTTC']['FIELDS']	= array();//�������ͣ�int=1,string=2,binary=3
$_TTC_CFG['IUserAddressTTC']['FIELDS']['uid'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IUserAddressTTC']['FIELDS']['aid'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IUserAddressTTC']['FIELDS']['iid'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IUserAddressTTC']['FIELDS']['name'] = array('type' => 2, 'min' => 0, 'max' => 32);
$_TTC_CFG['IUserAddressTTC']['FIELDS']['mobile'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IUserAddressTTC']['FIELDS']['phone'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IUserAddressTTC']['FIELDS']['fax'] = array('type' => 2, 'min' => 0, 'max' => 20);
$_TTC_CFG['IUserAddressTTC']['FIELDS']['zipcode'] = array('type' => 2, 'min' => 0, 'max' => 10);
$_TTC_CFG['IUserAddressTTC']['FIELDS']['city'] = array('type' => 1, 'min' => -65536, 'max' => 32767);
$_TTC_CFG['IUserAddressTTC']['FIELDS']['address'] = array('type' => 2, 'min' => 0, 'max' => 256);
$_TTC_CFG['IUserAddressTTC']['FIELDS']['workplace'] = array('type' => 2, 'min' => 0, 'max' => 128);
$_TTC_CFG['IUserAddressTTC']['FIELDS']['sortfactor'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IUserAddressTTC']['FIELDS']['updatetime'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IUserAddressTTC']['FIELDS']['createtime'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);

class IUserAddressTTC
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
	 * 		'uid' =>  XXX,
	 * 		'aid' =>  XXX,
	 * 		'iid' =>  XXX,
	 * 		'name' => 'XXX',
	 * 		'mobile' => 'XXX',
	 * 		'phone' => 'XXX',
	 * 		'fax' => 'XXX',
	 * 		'zipcode' => 'XXX',
	 * 		'city' =>  XXX,
	 * 		'address' => 'XXX',
	 * 		'workplace' => 'XXX',
	 * 		'sortfactor' =>  XXX,
	 * 		'updatetime' =>  XXX,
	 * 		'createtime' =>  XXX,
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
		$ttc = Config::getTTC('IUserAddressTTC');
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
	 * ����һ��TTC��¼
	 * 
	 * @param	$param ��ʽ: 
	 * 	array(
	 * 		'uid' =>  XXX,
	 * 		'aid' =>  XXX,
	 * 		'iid' =>  XXX,
	 * 		'name' => 'XXX',
	 * 		'mobile' => 'XXX',
	 * 		'phone' => 'XXX',
	 * 		'fax' => 'XXX',
	 * 		'zipcode' => 'XXX',
	 * 		'city' =>  XXX,
	 * 		'address' => 'XXX',
	 * 		'workplace' => 'XXX',
	 * 		'sortfactor' =>  XXX,
	 * 		'updatetime' =>  XXX,
	 * 		'createtime' =>  XXX,
	 * 		)
	 * 
	 * ����ֵ����ȷ����true�����󷵻�false
	 */
	public static function update($param,$filter=array())
	{
		self::clearErr();
		
		if(empty($param) || !is_array($param))
		{
			self::$errCode = 111;
			self::$errMsg  = 'param is empty';
		}
		$ttc = Config::getTTC('IUserAddressTTC');
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
	 * ɾ��һ��TTC��¼
	 * 
	 * @param   string  $key		���ݿ������
	 * 
	 * ����ֵ����ȷ����true�����󷵻�false
	 */
	public static function remove($key, $filter=array())
	{
		self::clearErr();
		
		if(empty($key))
		{
			self::$errCode = 111;
			self::$errMsg  = 'key is empty';
		}
		$ttc = Config::getTTC('IUserAddressTTC');
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
	 * ȡ����TTCӰ�������
	 * 
	 * 
	 * ����ֵ����ȷ����>-1�����������󷵻ظ���
	 */
	public static function getTTCAffectRows()
	{
		$ttc = Config::getTTC('IUserAddressTTC');
		if(!$ttc)
		{
			self::$errCode = -114;
			self::$errMsg  = 'get instance of TTC failed';
			return -1;
		}

		return $ttc->getAffectRows();
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
	 * 		'uid' =>  XXX,
	 * 		'aid' =>  XXX,
	 * 		'iid' =>  XXX,
	 * 		'name' => 'XXX',
	 * 		'mobile' => 'XXX',
	 * 		'phone' => 'XXX',
	 * 		'fax' => 'XXX',
	 * 		'zipcode' => 'XXX',
	 * 		'city' =>  XXX,
	 * 		'address' => 'XXX',
	 * 		'workplace' => 'XXX',
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

		$ttc = Config::getTTC('IUserAddressTTC');
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
	 * ����ȡTTC��¼
	 * 
	 * @param   string  $keys		���ݿ����������
	 * 
	 * ����ֵ����ȷ�������ݣ����󷵻�false
	 */
	public static function gets($keys)
	{
		self::clearErr();
		
		if(empty($keys) || !is_array($keys))
		{
			self::$errCode = 111;
			self::$errMsg  = 'keys is empty';
		}
		$ttc = Config::getTTC2('IUserAddressTTC');
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

