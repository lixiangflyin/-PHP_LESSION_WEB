<?php

require_once(PHPLIB_ROOT . 'lib/Logger.php');
require_once(PHPLIB_ROOT . 'lib/ToolUtil.php');
require_once('inc/IUserDeviceTTC.php');
require_once('inc/IDeviceInfoTTC.php');
require_once('inc/IPushMsgTTC.php');
require_once('ApnsPHP/Autoload.php');

define('Push_PEM_FILE', PHPLIB_ROOT . 'api/ApnsPHP/Pem/apns_ck_dev.pem');

define('DefaultUser', 'PushDefaultUser');

// ignore device token
define('AllUser', 'PushAllUser');
define('IOSUser', 'PushIOSUser');
define('AndroidUser', 'PushAndroidUser');

/**
 * 无线管理平台push消息操作接口
 * @author qitao
 * @version 1.0
 */
  
class PushNotification
{
	/**
	 * 错误码
	 */
	public static $errCode = 0;
	/**
	 * 错误信息
	 */
	public static $errMsg = '';

	function __construct()
	{
	}

	function __destruct()
	{
	}

	public static function sendSeveralMsgToApns($msgArr)
	{
		if (count($msgArr) == 0) {
			return;
		}
		$push = new ApnsPHP_Push(ApnsPHP_Abstract::ENVIRONMENT_SANDBOX, Push_PEM_FILE);
		$push->setProviderCertificatePassphrase('icson');

		foreach ($msgArr as $msg) 
		{
			if (AllUser == $msg['FUserID']) {
				
			} elseif (IOSUser == $msg['FUserID']) {
				
			} elseif (AndroidUser == $msg['FUserID']) {
				
			} elseif ($msg['FDeviceToken']) {
				if ($msg['FDeviceType'] >= 200 && $msg['FDeviceType'] < 300) {
					$message = new ApnsPHP_Message($msg['FDeviceToken']);
					$message->setText($msg['FMsgCtx']);
					$push->add($message);
				}	
			}
		}
		
		if (count($push->getQueue(false)) > 0) {
			$push->connect();
			$push->send();
			$push->disconnect();
		}
	}
	
//	public static function sendMassiveMsgToApns($msgArr)
//	{
//		$server = new ApnsPHP_Push_Server(ApnsPHP_Abstract::ENVIRONMENT_SANDBOX, Push_PEM_FILE);
//		$server->setProviderCertificatePassphrase('icsonpush');
//		$server->setProcesses(4);
//		$server->start();
//		
//		$message = new ApnsPHP_Message('c6e1b4701e182eabebbd72784abe59284834fb45d60706d9a58ef8da0979e756');
//		$message->setText('123412412412412421341241234');
//		
//		$server->run();
//	}
	
	public static function insertOrUpdate($param)
	{
		if (!$param['FUserID']) $param['FUserID'] = 'DefaultUser';
		if (!$param['FMsgStatus']) $param['FMsgStatus'] = 1;
		$paramNew = $param + array('FCreateTime' => time());
		$result = IPushMsgTTC::insert($paramNew);
		if (false == $result) {
			$filter = array();
			if ($param['FDeviceToken']) $filter['FDeviceToken'] = $param['FDeviceToken'];
			if ($param['FFingerprintCode']) $filter['FFingerprintCode'] = $param['FFingerprintCode'];
			$result = IPushMsgTTC::update($param, $filter);
			if (false == $result) {
				self::$errCode = IPushMsgTTC::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . IPushMsgTTC::$errMsg;
				Logger::err($param['FUserID'] . ' insert OR update error: ' . self::$errMsg);
			}
		}
		return $result;
	}

	public static function updateMsgStatus($msg_arr, $status = 0)
	{
		foreach ($msg_arr as $it) {
			if ($status > 0) {
				$it['FMsgStatus'] = $status;
			}
			$filter = array();
			if ($it['FDeviceToken']) $filter['FDeviceToken'] = $it['FDeviceToken'];
			if ($it['FFingerprintCode']) $filter['FFingerprintCode'] = $it['FFingerprintCode'];
			IPushMsgTTC::update($it, $filter);
		}
	}
	
	public static function getMsgToSendByUserId($user_id, $set_send_flag = false)
	{
		if($user_id)
		{  
			$res = IPushMsgTTC::get($user_id, array('FMsgStatus' => 1));
			if (false === ($res)) {
				self::$errCode = IPushMsgTTC::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . IPushMsgTTC::$errMsg;
				return false;
			}
			if (count($res) == 0) {
				return array();
			}
			
			$arr_ret = array();
			foreach ($res as $it) {
				$send_time = $it['FSentTime'];
				$expire_time = $it['FExpiredTime'];
				$should_ret = true;
				if ($send_time && $send_time > time()) {
					$should_ret = false;
				}
				if ($expire_time && $expire_time < time()) {
					$it['FMsgStatus'] = 3;
					IPushMsgTTC::update($it, array('FDeviceToken' => $it['FDeviceToken'], 'FFingerprintCode' => $it['FFingerprintCode']));
					$should_ret = false;
				}
				if ($should_ret) {
					if ($set_send_flag) {
						$it['FMsgStatus'] = 2;
						IPushMsgTTC::update($it, array('FDeviceToken' => $it['FDeviceToken'], 'FFingerprintCode' => $it['FFingerprintCode']));
					}
					$arr_ret[] = $it;
				}
			}

			return $arr_ret;
		}
		else
		{
			self::$errCode = -1001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[ 参数错误 ]";
			return false;
		}
	}
	
	public static function getMsgToSendByDeviceToken($device_token, $set_send_flag = false)
	{
		if($device_token)
		{  
			$res = IPushMsgTTC::get('DefaultUser', array('FDeviceToken' => $device_token, 'FMsgStatus' => 1));
			if (false === ($res)) {
				self::$errCode = IPushMsgTTC::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . IPushMsgTTC::$errMsg;
				return false;
			}
			if (count($res) == 0) {
				return array();
			}
			
			foreach ($res as $it) {
				$send_time = $it['FSentTime'];
				$expire_time = $it['FExpiredTime'];
				$should_ret = true;
				if ($send_time && $send_time > time()) {
					$should_ret = false;
				}
				if ($expire_time && $expire_time < time()) {
					$it['FMsgStatus'] = 3;
					IPushMsgTTC::update($it, array('FDeviceToken' => $it['FDeviceToken'], 'FFingerprintCode' => $it['FFingerprintCode']));
					$should_ret = false;
				}
				if ($should_ret) {
					if ($set_send_flag) {
						$it['FMsgStatus'] = 2;
						IPushMsgTTC::update($it, array('FDeviceToken' => $it['FDeviceToken'], 'FFingerprintCode' => $it['FFingerprintCode']));
					}
					$arr_ret[] = $it;
				}
			}

			return $arr_ret;
		}
		else
		{
			self::$errCode = -1001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[ 参数错误 ]";
			return false;
		}
	}
	
}

