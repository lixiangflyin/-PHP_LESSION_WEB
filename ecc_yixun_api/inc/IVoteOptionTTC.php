<?php
/**
 * IVoteOptionTTC.php
 * ��TTC:t_vote_option�������顢ɾ���ĵȲ���
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	zhiliu
 */

global $_TTC_CFG;

$_TTC_CFG['IVoteOptionTTC']['TTCKEY']	= 'IVoteOptionTTC';
$_TTC_CFG['IVoteOptionTTC']['TABLE']	= 't_vote_option';
$_TTC_CFG['IVoteOptionTTC']['TimeOut']	= 1;
$_TTC_CFG['IVoteOptionTTC']['KEY']		= 'category_id';
$_TTC_CFG['IVoteOptionTTC']['FIELDS']	= array();//�������ͣ�int=1,string=2,binary=3
$_TTC_CFG['IVoteOptionTTC']['FIELDS']['category_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IVoteOptionTTC']['FIELDS']['biz_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IVoteOptionTTC']['FIELDS']['option_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IVoteOptionTTC']['FIELDS']['group_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IVoteOptionTTC']['FIELDS']['order'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IVoteOptionTTC']['FIELDS']['option_name1'] = array('type' => 2, 'min' => 0, 'max' => 255);
$_TTC_CFG['IVoteOptionTTC']['FIELDS']['option_name2'] = array('type' => 2, 'min' => 0, 'max' => 255);
$_TTC_CFG['IVoteOptionTTC']['FIELDS']['status'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);

class IVoteOptionTTC
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
	 * 		'category_id' =>  XXX,
	 * 		'biz_id' =>  XXX,
	 * 		'option_id' =>  XXX,
	 * 		'group_id' =>  XXX,
	 * 		'order' =>  XXX,
	 * 		'option_name1' => 'XXX',
	 * 		'option_name2' => 'XXX',
	 * 		'status' =>  XXX,
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
		$ttc = Config::getTTC('IVoteOptionTTC');
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

		if(!empty(self::$ttcMap[$param['category_id']]))
		{
			unset(self::$ttcMap[$param['category_id']]);
		}

		return $v;
	}

	/**
	 * ����һ��TTC��¼
	 * 
	 * @param	$param ��ʽ: 
	 * 	array(
	 * 		'category_id' =>  XXX,
	 * 		'biz_id' =>  XXX,
	 * 		'option_id' =>  XXX,
	 * 		'group_id' =>  XXX,
	 * 		'order' =>  XXX,
	 * 		'option_name1' => 'XXX',
	 * 		'option_name2' => 'XXX',
	 * 		'status' =>  XXX,
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
		$ttc = Config::getTTC('IVoteOptionTTC');
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

		if(!empty(self::$ttcMap[$param['category_id']]))
		{
			unset(self::$ttcMap[$param['category_id']]);
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
		$ttc = Config::getTTC('IVoteOptionTTC');
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
	 * 		'category_id' =>  XXX,
	 * 		'biz_id' =>  XXX,
	 * 		'option_id' =>  XXX,
	 * 		'group_id' =>  XXX,
	 * 		'order' =>  XXX,
	 * 		'option_name1' => 'XXX',
	 * 		'option_name2' => 'XXX',
	 * 		'status' =>  XXX,
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
		if(empty($filter) && !empty(self::$ttcMap[$key]))
		{
			return self::$ttcMap[$key];
		}

		$ttc = Config::getTTC('IVoteOptionTTC');
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

		if (count(self::$ttcMap) > 100)
		{
			self::$ttcMap = array();
		}

		if (empty($filter))
		{
				self::$ttcMap[$key] = $v;

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
	public static function gets($keys)
	{
		self::clearErr();
		
		if(empty($keys) || !is_array($keys))
		{
			self::$errCode = 111;
			self::$errMsg  = 'keys is empty';
		}
		$ttc = Config::getTTC2('IVoteOptionTTC');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->get($keys);
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
		$ttc = Config::getTTC('IVoteOptionTTC');
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
