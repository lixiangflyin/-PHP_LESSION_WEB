<?php

/**
 * 活动数据接口，提供数据添加、查询、绑定等功能
 * @author smithhuang
 */
class IEventData {
	
	// 组件类型
	/** 统一组件类型，组件模块中的所有组件 */
	const COMP_TYPE_UNIFY_COMP = 1;
	
	// 数据类型
	/** 订单号 */
	const DATA_TYPE_ORDER_ID = 1;
	
	/** 投票 */
	const DATA_TYPE_VOTE_ID = 2;
	
	/** CDKEY */
	const DATA_TYPE_CDKEY = 3;

	/** 短信 */
	const DATA_TYPE_SMS_ID = 4;
	
	public static $errCode;
	public static $errMsg;
	
	private static function clearErr() {
		self::$errCode = 0;
		self::$errMsg = '';
	}
	
	/**
	 * 添加活动数据
	 * @param int $uid 用户id
	 * @param int $component_type 组件类型
	 * @param int $component_id 组件id
	 * @param int $type 数据类型
	 * @param string $value 数据值
	 */
	public static function add($uid, $component_type, $component_id, $type, $value, $time = NULL) {
		self::clearErr();
		$th = TMemHelper::getInstance('act_data');
		if($th === false) {
			self::$errCode = TMemHelper::$errCode;
			self::$errMsg = TMemHelper::$errMsg;
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
		$ret = $th->insert(array(
			'uid' => $uid,
			'component_type' => $component_type,
			'component_id' => $component_id,
			'type' => $type,
			'value' => $value,
			'create_time' => date('Y-m-d H:i:s', !empty($time) ? $time : time())
		));
		if($ret === false) {
			self::$errCode = $th->getErrCode();
			self::$errMsg = $th->getErrMsg();
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
		return true;
	}
	
	/**
	 * 获取活动数据
	 * @param int $uid 用户id
	 * @param int $component_type 组件类型
	 * @param int $component_id 组件id
	 * @param int $type 数据类型
	 */
	public static function get($uid, $component_type, $component_id, $type = 0) {
		self::clearErr();
		$th = TMemHelper::getInstance('act_data');
		if($th === false) {
			self::$errCode = TMemHelper::$errCode;
			self::$errMsg = TMemHelper::$errMsg;
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
		if(empty($type)) {
			$ret = $th->get($uid, array(
				'component_type' => $component_type,
				'component_id' => $component_id
			));
		} else {
			$ret = $th->get($uid, array(
				'component_type' => $component_type,
				'component_id' => $component_id,
				'type' => $type
			));
		}
		if($ret === false) {
			self::$errCode = $th->getErrCode();
			self::$errMsg = $th->getErrMsg();
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
		return $ret;
	}
	
	/**
	 * 绑定活动数据
	 * @param int $uid 用户id
	 * @param int $component_type 组件类型
	 * @param int $component_id 组件id
	 * @param int $type 数据类型
	 * @param string $value 数据值
	 */
	public static function bind($uid, $component_type, $component_id, $type, $value) {
		self::clearErr();
		// 判断是否已经绑定
		$ret = self::hasBound($component_type, $component_id, $type, $value);
		if($ret) {
			self::$errCode = ErrorConfig::getErrorCode('data_bound');
			self::$errMsg = "Value $value has been bound.";
			return false;
		}
		
		$th = TMemHelper::getInstance('act_data_map');
		if($th === false) {
			self::$errCode = TMemHelper::$errCode;
			self::$errMsg = TMemHelper::$errMsg;
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
		
		// 获取锁
		$lock_key = "ctype_{$component_type}_cid_{$component_id}_type_{$type}_value_{$value}";
		if($th->lock($lock_key) === false) {
			self::$errCode = ErrorConfig::getErrorCode('data_locked');
			self::$errMsg = "Value $value has been locked.";
			return false;
		}
		
		$ret = $th->insert(array(
			'uid' => $uid,
			'component_type' => $component_type,
			'component_id' => $component_id,
			'type' => $type,
			'value' => $value,
			'create_time' => date('Y-m-d H:i:s')
		));
		if($ret === false) {
			self::$errCode = $th->getErrCode();
			self::$errMsg = $th->getErrMsg();
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			$th->unlock($lock_key);
			return false;
		}
		
		$th->unlock($lock_key);
		return true;
	}
	
	/**
	 * 查询值是否绑定
	 * @param int $component_type 组件类型
	 * @param int $component_id 组件id
	 * @param int $type 数据类型
	 * @param string $value 数据值
	 */
	public static function hasBound($component_type, $component_id, $type, $value) {
		self::clearErr();
		$th = TMemHelper::getInstance('act_data_map');
		if($th === false) {
			self::$errCode = TMemHelper::$errCode;
			self::$errMsg = TMemHelper::$errMsg;
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
		$ret = $th->get($value, array(
			'component_type' => $component_type,
			'component_id' => $component_id,
			'type' => $type
		));
		if($ret === false) {
			self::$errCode = $th->getErrCode();
			self::$errMsg = $th->getErrMsg();
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
		return !empty($ret);
	}
	
	/**
	 * 添加并绑定活动数据
	 * @param int $uid 用户id
	 * @param int $component_type 组件类型
	 * @param int $component_id 组件id
	 * @param int $type 数据类型
	 * @param string $value 数据值
	 */
	public static function addAndBind($uid, $component_type, $component_id, $type, $value) {
		self::clearErr();
		
		$th = TMemHelper::getInstance('act_data_map');
		if($th === false) {
			self::$errCode = TMemHelper::$errCode;
			self::$errMsg = TMemHelper::$errMsg;
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
		// 获取锁
		$lock_key = "ctype_{$component_type}_cid_{$component_id}_type_{$type}_value_{$value}";
		if($th->lock($lock_key) === false) {
			self::$errCode = ErrorConfig::getErrorCode('data_locked');
			self::$errMsg = "Value $value has been locked.";
			return false;
		}
		
		// 绑定数据
		$ret = $th->insert(array(
			'uid' => $uid,
			'component_type' => $component_type,
			'component_id' => $component_id,
			'type' => $type,
			'value' => $value,
			'create_time' => date('Y-m-d H:i:s')
		));
		if($ret === false) {
			self::$errCode = $th->getErrCode();
			self::$errMsg = $th->getErrMsg();
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			$th->unlock($lock_key);
			return false;
		}
		
		// 插入数据
		$ret = self::add($uid, $component_type, $component_id, $type, $value);
		if($ret === false) {
			// 失败回滚
			$ret = $th->remove($uid, array(
				'component_type' => $component_type,
				'component_id' => $component_id,
				'type' => $type,
				'value' => $value
			));
			if($ret === false) {
				Logger::err("Failed to rollback.[ uid : $uid, component type : $component_type, component id : $component_id, type : $type, value : $value ]");
			}
			$th->unlock($lock_key);
			return false;
		}
		
		$th->unlock($lock_key);
		return true;
	}
}