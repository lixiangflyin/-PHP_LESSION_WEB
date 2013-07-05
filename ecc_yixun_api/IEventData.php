<?php

/**
 * ����ݽӿڣ��ṩ������ӡ���ѯ���󶨵ȹ���
 * @author smithhuang
 */
class IEventData {
	
	// �������
	/** ͳһ������ͣ����ģ���е�������� */
	const COMP_TYPE_UNIFY_COMP = 1;
	
	// ��������
	/** ������ */
	const DATA_TYPE_ORDER_ID = 1;
	
	/** ͶƱ */
	const DATA_TYPE_VOTE_ID = 2;
	
	/** CDKEY */
	const DATA_TYPE_CDKEY = 3;

	/** ���� */
	const DATA_TYPE_SMS_ID = 4;
	
	public static $errCode;
	public static $errMsg;
	
	private static function clearErr() {
		self::$errCode = 0;
		self::$errMsg = '';
	}
	
	/**
	 * ��ӻ����
	 * @param int $uid �û�id
	 * @param int $component_type �������
	 * @param int $component_id ���id
	 * @param int $type ��������
	 * @param string $value ����ֵ
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
	 * ��ȡ�����
	 * @param int $uid �û�id
	 * @param int $component_type �������
	 * @param int $component_id ���id
	 * @param int $type ��������
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
	 * �󶨻����
	 * @param int $uid �û�id
	 * @param int $component_type �������
	 * @param int $component_id ���id
	 * @param int $type ��������
	 * @param string $value ����ֵ
	 */
	public static function bind($uid, $component_type, $component_id, $type, $value) {
		self::clearErr();
		// �ж��Ƿ��Ѿ���
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
		
		// ��ȡ��
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
	 * ��ѯֵ�Ƿ��
	 * @param int $component_type �������
	 * @param int $component_id ���id
	 * @param int $type ��������
	 * @param string $value ����ֵ
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
	 * ��Ӳ��󶨻����
	 * @param int $uid �û�id
	 * @param int $component_type �������
	 * @param int $component_id ���id
	 * @param int $type ��������
	 * @param string $value ����ֵ
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
		// ��ȡ��
		$lock_key = "ctype_{$component_type}_cid_{$component_id}_type_{$type}_value_{$value}";
		if($th->lock($lock_key) === false) {
			self::$errCode = ErrorConfig::getErrorCode('data_locked');
			self::$errMsg = "Value $value has been locked.";
			return false;
		}
		
		// ������
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
		
		// ��������
		$ret = self::add($uid, $component_type, $component_id, $type, $value);
		if($ret === false) {
			// ʧ�ܻع�
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