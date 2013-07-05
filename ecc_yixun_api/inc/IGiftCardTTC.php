<?php
/**
 * IGiftCardTTC.php
 * ��TTC:t_card_info_�������顢ɾ���ĵȲ���
 *
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	root
 */

global $_TTC_CFG;

$_TTC_CFG['IGiftCardTTC']['TTCKEY']	= 'IGiftCardTTC';
$_TTC_CFG['IGiftCardTTC']['TABLE']	= 't_card_info_';
$_TTC_CFG['IGiftCardTTC']['TimeOut']	= 1;
$_TTC_CFG['IGiftCardTTC']['KEY']		= 'code';
$_TTC_CFG['IGiftCardTTC']['FIELDS']	= array();//�������ͣ�int=1,string=2,binary=3
$_TTC_CFG['IGiftCardTTC']['FIELDS']['code'] = array('type' => 2, 'min' => 0, 'max' => 30);
$_TTC_CFG['IGiftCardTTC']['FIELDS']['password'] = array('type' => 2, 'min' => 0, 'max' => 40);
$_TTC_CFG['IGiftCardTTC']['FIELDS']['head_of_password'] = array('type' => 2, 'min' => 0, 'max' => 10);
$_TTC_CFG['IGiftCardTTC']['FIELDS']['pn_code'] = array('type' => 2, 'min' => 0, 'max' => 64);
$_TTC_CFG['IGiftCardTTC']['FIELDS']['batch'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IGiftCardTTC']['FIELDS']['is_used'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IGiftCardTTC']['FIELDS']['use_account'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IGiftCardTTC']['FIELDS']['use_time'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IGiftCardTTC']['FIELDS']['card_status'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);

class IGiftCardTTC {
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
	private static function clearErr() {
		self::$errCode = 0;
		self::$errMsg  = '';
	}

	/**
	 * ����һ��TTC��¼
	 *
	 * @param	$param ��ʽ:
	 * 	array(
	 * 		'code' => 'XXX',
	 * 		'password' => 'XXX',
	 * 		'head_of_password' => 'XXX',
	 * 		'batch' =>  XXX,
	 * 		'is_used' =>  XXX,
	 * 		'use_account' =>  XXX,
	 * 		'use_time' =>  XXX,
	 * 		'card_status' =>  XXX,
	 * 		)
	 *
	 * ����ֵ����ȷ����true�����󷵻�false
	 */
	public static function insert($param) {
		self::clearErr();

		if (empty($param) || !is_array($param)) {
			self::$errCode = 111;
			self::$errMsg  = 'param is empty';
		}
		$ttc = Config::getTTC('IGiftCardTTC');
		if (!$ttc) {
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->insert($param);
		if (false === $v) {
			self::$errCode = $ttc->errCode;
			self::$errMsg  = $ttc->errMsg;
			return false;
		}

		if (!empty(self::$ttcMap[$param['code']])) {
			unset(self::$ttcMap[$param['code']]);
		}

		return $v;
	}

	/**
	 * ����һ��TTC��¼
	 *
	 * @param	$param ��ʽ:
	 * 	array(
	 * 		'code' => 'XXX',
	 * 		'password' => 'XXX',
	 * 		'head_of_password' => 'XXX',
	 * 		'batch' =>  XXX,
	 * 		'is_used' =>  XXX,
	 * 		'use_account' =>  XXX,
	 * 		'use_time' =>  XXX,
	 * 		'card_status' =>  XXX,
	 * 		)
	 *
	 * ����ֵ����ȷ����true�����󷵻�false
	 */
	public static function update($param, $filter = array()) {
		self::clearErr();

		if (empty($param) || !is_array($param)) {
			self::$errCode = 111;
			self::$errMsg  = 'param is empty';
		}
		$ttc = Config::getTTC('IGiftCardTTC');
		if (!$ttc) {
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->update($param, $filter);
		if (false === $v) {
			self::$errCode = $ttc->errCode;
			self::$errMsg  = $ttc->errMsg;
			return false;
		}

		if (!empty(self::$ttcMap[$param['code']])) {
			unset(self::$ttcMap[$param['code']]);
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
	public static function remove($key, $filter= array()) {
		self::clearErr();

		if (empty($key)) {
			self::$errCode = 111;
			self::$errMsg  = 'key is empty';
		}
		$ttc = Config::getTTC('IGiftCardTTC');
		if (!$ttc) {
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->delete($key, $filter);
		if (false === $v) {
			self::$errCode = $ttc->errCode;
			self::$errMsg  = $ttc->errMsg;
			return false;
		}

		if (!empty(self::$ttcMap[$key])) {
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
	 * 		'code' => 'XXX',
	 * 		'password' => 'XXX',
	 * 		'head_of_password' => 'XXX',
	 * 		'pn_code' => 'XXX',
	 * 		'batch' =>  XXX,
	 * 		'is_used' =>  XXX,
	 * 		'use_account' =>  XXX,
	 * 		'use_time' =>  XXX,
	 * 		'card_status' =>  XXX,
	 * 		)
	 */
	public static function get($key, $filter = array(), $need = array(), $itemLimit = 0, $start = 0) {
		self::clearErr();

		if (empty($key)) {
			self::$errCode = 111;
			self::$errMsg  = 'key is empty';
		}
		$ttc = Config::getTTC('IGiftCardTTC');
		if (!$ttc) {
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->get($key, $filter, $need , $itemLimit, $start );
		if (false === $v) {
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
	public static function gets($keys, $filter=array(), $need=array()) {
		self::clearErr();

		if (empty($keys) || !is_array($keys)) {
			self::$errCode = 111;
			self::$errMsg  = 'keys is empty';
		}

		$ttc = Config::getTTC2('IGiftCardTTC');
		if (!$ttc) {
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->get($keys, $filter, $need);
		if (false === $v) {
			self::$errCode = $ttc->errCode;
			self::$errMsg  = $ttc->errMsg;
			return false;
		}

		return $v;
	}

	/**
	 * ������
	 * @param mix $key ��һ��key
	 * @param array $filter ������������
	 * @return boolean
	 */
	public static function purge($key, $filter = array()) {
		self::clearErr();

		if (empty($key)) {
			self::$errCode = 111;
			self::$errMsg  = 'key is empty';
		}
		$ttc = Config::getTTC('IGiftCardTTC');
		if (!$ttc) {
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->purge($key, $filter);
		if (false === $v) {
			self::$errCode = $ttc->errCode;
			self::$errMsg  = $ttc->errMsg;
			return false;
		}

		return true;
	}

	/**
	 * ȡ����TTCӰ�������
	 *
	 *
	 * ����ֵ����ȷ����>-1�����������󷵻ظ���
	 */
	public static function getTTCAffectRows() {
		$ttc = Config::getTTC('IGiftCardTTC');
		if (!$ttc) {
			self::$errCode = -114;
			self::$errMsg  = 'get instance of TTC failed';
			return -1;
		}

		return $ttc->getAffectRows();
	}
}

//End Of Script