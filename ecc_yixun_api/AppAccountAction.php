<?php

require_once(PHPLIB_ROOT . 'lib/Logger.php');
require_once(PHPLIB_ROOT . 'lib/ToolUtil.php');
require_once('inc/IUserDeviceTTC.php');
require_once('inc/IDeviceInfoTTC.php');

/**
 * 无线管理平台用户账户状态操作接口
 * @author qitao
 * @version 1.0
 */
  
class AppAccountAction
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

	
	public static function insertOrUpdate($param)
	{
		$param = $param + array('FLastActiveTime' => time());
		$paramNew = $param + array('FCreateTime' => time());
		$paramNew['FDeviceID'] = isset($paramNew['FDeviceID']) ? $paramNew['FDeviceID'] : '';

		$rs = IUserDeviceTTC::get($paramNew['FUserID'], array('FDeviceID' => $paramNew['FDeviceID']));
		if (empty($rs)) {
			$result = IUserDeviceTTC::insert($paramNew);
		} else {
			$result = IUserDeviceTTC::update($param, array(
				'FDeviceID' =>	$paramNew['FDeviceID'],
			));
			if (false == $result) {
				self::$errCode = IUserDeviceTTC::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . IUserDeviceTTC::$errMsg;
				Logger::err($param['FUserID'] . ' insert OR update error: ' . self::$errMsg);
			}
		}

		return $result;
	}
	
	public static function nonLoginInsertOrUpdate($param)
	{
		$param = $param + array('FLastActiveTime' => time());
		$paramNew = $param + array('FCreateTime' => time());
		$result = IDeviceInfoTTC::insert($paramNew);
		if (false == $result) {
			$result = IDeviceInfoTTC::update($param);
			if (false == $result) {
				self::$errCode = IDeviceInfoTTC::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . IDeviceInfoTTC::$errMsg;
				Logger::err($param['FDeviceID'] . ' insert OR update error: ' . self::$errMsg);
			}
		}
		return $result;
	}

	public static function getUserLastLoginTime($user_id, $device_type = 0)
	{
		if(is_numeric($user_id))
		{  
			$filter = array();
			if ($device_type > 0) {
				$filter = array('FDeviceType' => $device_type);
			}
			$dates = IUserDeviceTTC::get($user_id, $filter, array('FLastLoginTime'));
			if (false === ($dates)) {
				self::$errCode = IUserDeviceTTC::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . IUserDeviceTTC::$errMsg;
				return false;
			}
			if (count($dates) == 0) {
				return array();
			}

			$lastDate = 0;
			foreach($dates as $k => $v) {
				if ($lastDate < $v['FLastLoginTime']) {
					$lastDate = $v['FLastLoginTime'];
				}
			}
			return $lastDate;
		}
		else
		{
			self::$errCode = -1001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[ 参数错误 ]";
			return false;
		}
	}

	public static function getDeviceInfo($device_id)
	{
		if($device_id)
		{  
			$res = IDeviceInfoTTC::get($device_id);
			if (false === ($res)) {
				self::$errCode = IDeviceInfoTTC::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . IDeviceInfoTTC::$errMsg;
				return false;
			}
			if (count($res) == 0) {
				return array();
			}
			return $res;
		}
		else
		{
			self::$errCode = -1001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[ 参数错误 ]";
			return false;
		}
	}
}

