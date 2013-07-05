<?php

class IUserActStatus {

	const ONE_DAY_SECONDS = 86400;

	public static $errCode = 0;
	public static $errMsg = '';

	public static function getDailyStatus($uid, $act_key, $time = 0) {
		if(empty($time)) {
			$time = time();
		}

		$status_key = self::getDailyStatusKey($uid, $act_key, $time);
		$ret = IDataCache::getData($status_key);
		if($ret === false) {
			if(IDataCache::$errCode == IDataCache::ERROR_NO_DATA || IDataCache::$errCode == IDataCache::ERROR_KEY_EXPIRED) {
				$status = array();
			} else {
				self::$errCode = IDataCache::$errCode;
				self::$errMsg = IDataCache::$errMsg;
				Logger::err("Failed to get daily status with uid {$uid}, act key {$act_key}, time {$time}.[" . self::$errCode . ' : ' . self::$errMsg . ']');
				return false;
			}
		} else {
			$status = json_decode($ret, true);
			if($status === false) {
				self::$errCode = ErrorConfig::getErrorCode('decode_error');
				self::$errMsg = "Failed to decode daily status with uid {$uid}, act key {$act_key}, time {$time}.";
				Logger::err(self::$errCode . ' : ' . self::$errMsg);
				return false;
			}
		}

		return $status;
	}

	public static function setDailyStatus($uid, $act_key, $status, $time = 0) {
		if(empty($time)) {
			$time = time();
		}

		$status_key = self::getDailyStatusKey($uid, $act_key, $time);
		$status_data = json_encode($status);
		if($status_data === false) {
			self::$errCode = ErrorConfig::getErrorCode('encode_error');
			self::$errMsg = "Failed to encode daily status with uid {$uid}, act key {$act_key}, time {$time}, status " . var_export($status, true) . '.';
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}

		$cas = -1;
		$ret = IDataCache::casSetData($status_key, $status_data, $cas, self::ONE_DAY_SECONDS);
		if($ret === false) {
			self::$errCode = IDataCache::$errCode;
			self::$errMsg = IDataCache::$errMsg;
			Logger::err("Failed to set daily status with uid {$uid}, act key {$act_key}, status {$status_data}, time {$time}.[" . self::$errCode . ' : ' . self::$errMsg . ']');
			return false;
		}

		return true;
	}

	private static function getDailyStatusKey($uid, $act_key, $time) {
		$week_day = date('N', $time);
		return IDataCache::getPrefix(BIZ_TYPE_ACTIVITY_DAILY_STATUS) . $uid . '_' . $act_key . '_' . $week_day;
	}

	public static function getStatus($uid, $act_key) {
		if(is_int($act_key)) {
			$act_id = $act_key;
		} else {
			$tks = explode('_', $act_key);
			$act_id = $tks[1];
		}

		$status_key = self::getStatusKey($uid, $act_key);
		$ret = IDataCache::getData($status_key);
		if($ret === false) {
			if(IDataCache::$errCode == IDataCache::ERROR_NO_DATA || IDataCache::$errCode == IDataCache::ERROR_KEY_EXPIRED) {
				$status = array();
			} else {
				self::$errCode = IDataCache::$errCode;
				self::$errMsg = IDataCache::$errMsg;
				Logger::err("Failed to get status with uid {$uid}, act key {$act_key}.[" . self::$errCode . ' : ' . self::$errMsg . ']');
				return false;
			}
		} else {
			$status = json_decode($ret, true);
			if($status === false) {
				self::$errCode = ErrorConfig::getErrorCode('decode_error');
				self::$errMsg = "Failed to decode status with uid {$uid}, act key {$act_key}.";
				Logger::err(self::$errCode . ' : ' . self::$errMsg);
				return false;
			}
		}

		return isset($status[$act_id]) ? $status[$act_id] : array();
	}

	public static function setStatus($uid, $act_key, $data) {
		if(is_int($act_key)) {
			$act_id = $act_key;
		} else {
			$tks = explode('_', $act_key);
			$act_id = $tks[1];
		}

		$status_key = self::getStatusKey($uid, $act_key);
		$cas = -1;
		$exts = 0;
		$ret = IDataCache::casGetData($status_key, $cas, $exts);
		if($ret === false) {
			if(IDataCache::$errCode == IDataCache::ERROR_NO_DATA || IDataCache::$errCode == IDataCache::ERROR_KEY_EXPIRED) {
				$status = array();
			} else {
				self::$errCode = IDataCache::$errCode;
				self::$errMsg = IDataCache::$errMsg;
				Logger::err("Failed to get status with uid {$uid}, act key {$act_key}.[" . self::$errCode . ' : ' . self::$errMsg . ']');
				return false;
			}
		} else {
			$status = json_decode($ret, true);
			if($status === false) {
				self::$errCode = ErrorConfig::getErrorCode('decode_error');
				self::$errMsg = "Failed to decode status with uid {$uid}, act key {$act_key}.";
				Logger::err(self::$errCode . ' : ' . self::$errMsg);
				return false;
			}
		}

		$status[$act_id] = $data;
		$status_data = json_encode($status);
		if($status_data === false) {
			self::$errCode = ErrorConfig::getErrorCode('encode_error');
			self::$errMsg = "Failed to encode status with uid {$uid}, act key {$act_key}, status " . var_export($status, true) . '.';
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}

		$ret = IDataCache::casSetData($status_key, $status_data, $cas, 0);
		if($ret === false) {
			self::$errCode = IDataCache::$errCode;
			self::$errMsg = IDataCache::$errMsg;
			Logger::err("Failed to set status with uid {$uid}, act key {$act_key}, status {$status_data}.[" . self::$errCode . ' : ' . self::$errMsg . ']');
			return false;
		}

		return true;
	}

	private static function getStatusKey($uid, $act_key) {
		if(is_int($act_key)) {
			$index = floor($act_key / 100);
			return IDataCache::getPrefix(BIZ_TYPE_ACTIVITY_STATUS) . $uid . '_' . $index;
		} else {
			return IDataCache::getPrefix(BIZ_TYPE_ACTIVITY_STATUS) . $uid;
		}
	}
}