<?php

/**
 * �ԤԼ�ӿڣ��ṩ�ԤԼ��ԤԼ��֤����ȡԤԼ�����ȹ���
 * @author smithhuang
 */
class IActAppoint {
	
	const VALUE_TYPE_PHONE = 1; /**< �ֻ��� */
	const VALUE_TYPE_YTAG = 2;
	
	private static $_VALUE_TYPES = array(
		self::VALUE_TYPE_PHONE,
		self::VALUE_TYPE_YTAG
	); /**< ԤԼ�������� */
	
	public static $errCode = 0; /**< ���ӿں�������ʱ���˱�������Ϊ�������Ĵ����� */
	public static $errMsg = ''; /**< ���ӿں�������ʱ���˱�������Ϊ�������Ĵ�����Ϣ */
	
	public static $record_id = 0;
	
	private static function clearErr() {
		self::$errCode = 0;
		self::$errMsg = '';
	}
	
	private static function setErr($errCode, $errMsg) {
		self::$errCode = $errCode;
		self::$errMsg = $errMsg;
	}
	
	/**
	 * �ԤԼ
	 * @param $act_id �id
	 * @param $uid �û�id
	 * @param $ip �û�IP
	 * @param $params ԤԼ��ز������� key => value ����ʽ���룬���� key ����Ϊ $_VALUE_TYPES �������������
	 * @return ԤԼ�ɹ�����true��ԤԼʧ�ܷ���false
	 */
	public static function appoint($act_id, $uid, $ip, $params = array(), $create_time = 0) {
		
		self::clearErr();
		self::$record_id = 0;
		
		// ����ԤԼ��¼
		$ret = IActAppointTTC::insert(array(
			'act_id' => $act_id,
			'create_time' => $create_time ?: time(),
			'uid' => $uid,
			'ip' => $ip,
			'status' => 1
		));
		if($ret === false) {
			self::setErr(IActAppointTTC::$errCode, IActAppointTTC::$errMsg);
			return false;
		}
		
		try {
			// ����ԤԼ�����Ϣ
			foreach ($params as $type => $value) {
				if(!in_array($type, self::$_VALUE_TYPES)) {
					Logger::warn("Unexpected value type $type.");
					continue;
				}
				$ret = IActAppointValueTTC::insert(array(
					'act_id' => $act_id,
					'type' => $type,
					'value' => $value,
					'uid' => $uid
				));
				if($ret === false) {
					Logger::err(IActAppointValueTTC::$errCode . ' : ' . IActAppointValueTTC::$errMsg . "\n");
					throw new BaseException(102, "Failed to save appoint value with act $act_id, type $type, value $value.");
				}
			}
			
			self::updateCount($act_id);
			
			return true;
		} catch(BaseException $e) {
			self::setErr($e->errCode, $e->errMsg);
			
			// �ع�ԤԼ��¼��
			IActAppointTTC::remove($uid, array( 'act_id' => $act_id ));
			
			// �ع�ԤԼ�����Ϣ��
			IActAppointValueTTC::remove($uid, array( 'act_id' => $act_id ));
			
			return false;
		}
	}
	
	/**
	 * �ж��û��Ƿ�ԤԼ�˻
	 * @param $act_id �id������Ϊ�������id���߶���id������
	 * @param $uid �û�id
	 * @return �û���ԤԼ����true���û�δԤԼ������֤ʧ�ܷ���false
	 */
	public static function hasAppointed($act_id, $uid) {
		self::clearErr();
		
		if(!is_array($act_id)) {
			return self::_hasAppointed($act_id, $uid);
		} else {
			foreach ($act_id as $aid) {
				if(self::_hasAppointed($aid, $uid)) {
					return true;
				}
			}
			return false;
		}
	}
	
	private static function _hasAppointed($act_id, $uid) {
		$res = IActAppointTTC::get($uid, array( 'act_id' => $act_id, 'status' => 1 ));
		if($res === false) {
			self::setErr(IActAppointTTC::$errCode, IActAppointTTC::$errMsg);
			return false;
		}
		return !empty($res);
	}
	
	/**
	 * �ж�ԤԼ��ز����Ƿ��Ѿ����ڣ������ж�ԤԼ�ֻ����Ƿ��Ѿ�ʹ��
	 * @param $act_id �id������Ϊ�������id���߶���id������
	 * @param $type ��������
	 * @param $value ����ֵ
	 * @return �Ѿ����ڷ���true�������ڻ��߳����쳣����false
	 */
	public static function isExistValue($act_id, $type, $value) {
		self::clearErr();
		if(!is_array($act_id)) {
			return self::_isExistValue($act_id, $type, $value);
		} else {
			foreach ($act_id as $aid) {
				if(self::_isExistValue($aid, $type, $value)) {
					return true;
				}
			}
			return false;
		}
	}
	
	private static function _isExistValue($act_id, $type, $value) {
		$res = IActAppointValueTTC::get($act_id, array( 'type' => $type, 'value' => $value ));
		if($res === false) {
			self::setErr(IActAppointValueTTC::$errCode, IActAppointValueTTC::$errMsg);
			return false;
		}
		return !empty($res);
	}
	
	/**
	 * ��ȡ�ԤԼ��������
	 * @param $act_id �id������Ϊ�������id���߶���id������
	 * @return ���ػԤԼ�������������쳣����false
	 */
	public static function getAppointCount($act_id) {
		self::clearErr();
		if(!is_array($act_id)) {
			return self::_getAppointCount($act_id);
		} else {
			$count = 0;
			foreach ($act_id as $aid) {
				$c = self::_getAppointCount($aid);
				if($c === false) {
					return false; 
				}
				$count += $c;
			}
			return $count;
		}
	}
	
	private static function _getAppointCount($act_id) {
		$key = "appoint_count_{$act_id}";
		$value = IDataCache::getData($key);
		if($value === false) {
			if(IDataCache::$errCode === -13200) {
				// ���ݲ����ڣ���ʼ��Ϊ0
				IDataCache::setData($key, 0);
				return 0;
			}
			self::setErr(IDataCache::$errCode, IDataCache::$errMsg);
			return false;
		}
		return $value;
	}
	
	private static function updateCount($act_id) {
		$count = self::getAppointCount($act_id);
		if($count === false) {
			return false;
		}
		$count++;
		$key = "appoint_count_{$act_id}";
		$ret = IDataCache::setData($key, $count);
		if($ret === false) {
			self::setErr(IDataCache::$errCode, IDataCache::$errMsg);
			return false;
		}
		return true;
	}
	
	public static function cacheAppointConfig($act_id) {
		self::clearErr();
		try {
			$comDao = new IMySQLDAO('icson_admin_event', 't_basic_component');
			$res = $comDao->getRows('', "activity_id = $act_id AND component_id = 8 AND status = 1", null, null);
			if(empty($res)) {
				throw new BaseException(101, "Failed to component map record with act $act_id.");
			}
			
			$config_id = $res[0]['config_id'];
			$appDao = new IMySQLDAO('icson_event_component', 't_appoint');
			$res = $appDao->getRows('', "id = $config_id", null, null);
			if(empty($res)) {
				throw new BaseException(102, "Failed to get appoint configuration with id $id.");
			}
			
			$config = $res[0];
			$key = "appoint_config_{$act_id}";
			$ret = IDataCache::setData($key, serialize(array(
				'title' => $config['title'],
				'start_time' => $config['start_time'],
				'end_time' => $config['end_time'],
				'count_limit' => $config['count_limit'],
				'params' => empty($config['params']) ? array() : ToolUtil::gbJsonDecode($config['params'])
			)));
			if($ret === false) {
				return false;
			}
			
			return true;
		} catch(BaseException $e) {
			self::setErr($e->errCode, $e->errMsg);
			return false;
		}
	}
	
	public static function getAppointConfig($act_id) {
		self::clearErr();
		$key = "appoint_config_{$act_id}";
		$ret = IDataCache::getData($key);
		if($ret === false) {
			self::setErr(IDataCache::$errCode, IDataCache::$errMsg);
			return false;
		}
		return unserialize($ret);
	}
}