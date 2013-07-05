<?php

require_once PHPLIB_ROOT . 'inc/DataCache.inc.php';

/**
 * TMem�洢���׽ӿڣ��ṩ���ݻ���Ķ���д��ɾ�����ܣ��ʺ�����key�����ݻ��棬�������key�����ݻ�������������ռ�
 * @author smithhuang
 */

class IDataCache {
	
	const TMEM_KEY = 'data_cache'; /**< TMemҵ��ID */
	
	// ����DataCache�����ݵ�ҵ������
	/** ����������� */
	const BIZ_TYPE_COMP_CONFIG = 1; 
	/** Ƶ���������� */
	const BIZ_TYPE_FREQ_LIMIT = 2; 
	
	// tmem����������
	/** ��ȡkey��Ӧ�������Ҳ��� */
	const ERROR_NO_DATA = -13200; 
	/** ��ȡʱkey��Ӧ�������ѹ��� */
	const ERROR_KEY_EXPIRED = -13106; 
	/** ɾ��ʱkey������ */
	const ERROR_KEY_NO_EXIST = -13105; 
	/** ƫ�Ʋ����������Ϸ� */
	const ERROR_LOCAL_PARSE_ARGS = -13002;
	/** �в����������Ϸ� */
	const ERROR_SO_PARSE_ARGS = -13004;
	/** ��������ʧ�� */
	const ERROR_CAN_NOT_INCR = -13110;
	/** �������ݽ������� */
	const ERROR_INCR_VALUE_DECODE = -11916;
	
	/**
	 * ����ҵ������Ӧ��ǰ׺����DataCache.inc.php�ж���
	 * @var array
	 */
	public static $prefixs;
	
	/** ���ӿں�������ʱ���˱�������Ϊ�������Ĵ����� */
	public static $errCode; 
	/** ���ӿں�������ʱ���˱�������Ϊ�������Ĵ�����Ϣ */
	public static $errMsg; 
	
	private static function clearErr() {
		self::$errCode = 0;
		self::$errMsg = '';
	}
	
	private static function getTMem() {
		$tm = Config::getTMem(IDataCache::TMEM_KEY);
		if($tm === false) {
			Logger::err('Failed to get tmem for key ' . IDataCache::TMEM_KEY . '.');
			throw new BaseException(ErrorConfig::getErrorCode('config_not_found'), 'Failed to get tmem for key ' . IDataCache::TMEM_KEY . '.');
		}
		return $tm;
	}
	
	/**
	 * д�뻺�����ݣ���֧����������
	 * @param $key �����key
	 * @param $data �������ݣ����ַ��������������л�Ϊ�ַ���
	 * @return д��ɹ�����true��д��ʧ�ܷ���false
	 */
	public static function setData($key, $data) {
		self::clearErr();
		
		try {
			$tm = self::getTMem();
			$ret = $tm->set(TMEM_BID_DATA_CACHE, $key, $data);
			if($ret === false) {
				Logger::err($tm->errno() . ' : ' . "Failed to cache data with key $key, data $data.");
				throw new BaseException($tm->errno(), "Failed to cache data with key $key, data $data.");
			}
			return $ret;
		} catch(BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * ��ȡ�������ݣ�֧����������
	 * @param $key �����key����������������key��������ʽ����
	 * @return ���ػ������ݣ�����ȡʧ�ܷ���false�������������򷵻ع������飬ĳ��key��ȡ����ʧ�����Ӧ������Ϊfalse
	 */
	public static function getData($key) {
		self::clearErr();
		
		try {
			$tm = self::getTMem();
			$ret = $tm->get(TMEM_BID_DATA_CACHE, $key);
			if($ret === false) {
				$errCode = $tm->errno();
				if($errCode !== self::ERROR_KEY_EXPIRED && $errCode !== self::ERROR_NO_DATA) {
					Logger::err("$errCode : Failed to get data with key $key.");
				}
				throw new BaseException($errCode, "Failed to get data with key $key.");
			}
			return $ret;
		} catch(BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * ɾ���������ݣ�֧����������
	 * @param $key �����key����������������key��������ʽ����
	 * @return ɾ���ɹ�����true��ɾ��ʧ�ܷ���false�������������򷵻ع������飬ÿ��key��Ӧ��������
	 */
	public static function delData($key) {
		self::clearErr();
		
		try {
			$tm = self::getTMem();
			$ret = $tm->del(TMEM_BID_DATA_CACHE, $key);
			if($ret === false) {
				$errCode = $tm->errno();
				if($errCode !== self::ERROR_KEY_NO_EXIST) {
					Logger::err("$errCode : Failed to delete data with key $key.");
				}
				throw new BaseException($errCode, "Failed to delete data with key $key.");
			}
			return $ret;
		} catch(BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * �ڻ������ݵ�ָ������д�룬��֧����������
	 * @param $key �����key
	 * @param $data �������ݣ����ַ��������������л�Ϊ�ַ���
	 * @param $offset ��������д���ƫ��λ��
	 * @param $len ��������д��ķ�Χ
	 * @return д��ɹ�����true��д��ʧ�ܷ���false
	 */
	public static function setDataByOffset($key, $data, $offset, $len) {
		self::clearErr();
		
		try {
			$tm = self::getTMem();
			$ret = $tm->set(TMEM_BID_DATA_CACHE, $key, $data, $offset, $len);
			if($ret === false) {
				$errCode = $tm->errno();
				if($errCode !== self::ERROR_LOCAL_PARSE_ARGS) {
					Logger::err("$errCode : Failed to set data with key $key, data $data, offset $offset, len $len.");
				}
				throw new BaseException($errCode, "Failed to set data with key $key, data $data, offset $offset, len $len.");
			}
			return $ret;
		} catch(BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * �ڻ������ݵ�ָ�����ֶ�ȡ����֧����������
	 * @param $key �����key
	 * @param $offset �������ݶ�ȡ��ƫ��λ��
	 * @param $len �������ݶ�ȡ�ķ�Χ
	 * @return �ɹ����ػ������ݣ�ʧ�ܷ���false
	 */
	public static function getDataByOffset($key, $offset, $len) {
		self::clearErr();
		
		try {
			$tm = self::getTMem();
			$ret = $tm->get(TMEM_BID_DATA_CACHE, $key, $offset, $len);
			if($ret === false) {
				$errCode = $tm->errno();
				if($errCode !== self::ERROR_KEY_EXPIRED && $errCode !== self::ERROR_NO_DATA && $errCode !== self::ERROR_LOCAL_PARSE_ARGS) {
					Logger::err("$errCode : Failed to get data with key $key, offset $offset, len $len.");
				}
				throw new BaseException($errCode, "Failed to get data with key $key, offset $offset, len $len.");
			}
			return $ret;
		} catch(BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * �Ի������ݰ���д�룬֧�ֵ�key����д�롢��key����д�롢��key����д��
	 * @param $key �����key����keyд��ʱ��������
	 * @param $col_no �������ݵ��У���key����ʱ�������飬��key����ʱ�����ά����
	 * @param $data �������ݣ����ַ��������������л�Ϊ�ַ�������key����ʱ�������飬��key����ʱ�����ά����
	 * @return д��ɹ�����true��д��ʧ�ܷ���false����key����ʱ���ع������飬��key����ʱ���ض�ά��������
	 */
	public static function setDataByCol($key, $col_no, $data) {
		self::clearErr();
		
		try {
			$tm = self::getTMem();
			$ret = $tm->setcol(TMEM_BID_DATA_CACHE, $key, $col_no, $data);
			if($ret === false) {
				$errCode = $tm->errno();
				if($errCode !== self::ERROR_SO_PARSE_ARGS) {
					Logger::err("$errCode : Failed to set data with key $key, column number $col_no, data $data.");
				}
				throw new BaseException($errCode, "Failed to set data with key $key, column number $col_no, data $data.");
			}
			return $ret;
		} catch(BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * �Ի������ݰ��ж�ȡ��֧�ֵ�key���ж�ȡ����key���ж�ȡ����key���ж�ȡ
	 * @param $key �����key����key��ȡʱ��������
	 * @param $col_no �������ݵ��У���key����ʱ�������飬��key����ʱ�����ά����
	 * @return ��ȡ�ɹ����ػ������ݣ���ȡʧ�ܷ���false����key����ʱ���ع������飬��key����ʱ���ض�ά��������
	 */
	public static function getDataByCol($key, $col_no) {
		self::clearErr();
		
		try {
			$tm = self::getTMem();
			$ret = $tm->getcol(TMEM_BID_DATA_CACHE, $key, $col_no);
			if($ret === false) {
				if($errCode !== self::ERROR_KEY_EXPIRED && $errCode !== self::ERROR_NO_DATA && $errCode !== self::ERROR_SO_PARSE_ARGS) {
					Logger::err("$errCode : Failed to get data with key $key, column number $col_no.");
				}
				throw new BaseException($errCode, "Failed to get data with key $key, column number $col_no.");
			}
			return $ret;
		} catch(BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * �Ի������ݰ���ɾ����֧�ֵ�key����ɾ������key����ɾ������key����ɾ��
	 * @param $key �����key����keyд��ʱ��������
	 * @param $col_no �������ݵ��У���key����ʱ�������飬��key����ʱ�����ά����
	 * @return ɾ���ɹ�����true��ɾ��ʧ�ܷ���false����key����ʱ���ع������飬��key����ʱ���ض�ά��������
	 */
	public static function delDataByCol($key, $col_no) {
		self::clearErr();
		
		try {
			$tm = self::getTMem();
			$ret = $tm->delcol(TMEM_BID_DATA_CACHE, $key, $col_no);
			if($ret === false) {
				$errCode = $tm->errno();
				if($errCode !== self::ERROR_KEY_NO_EXIST && $errCode !== self::ERROR_SO_PARSE_ARGS) {
					Logger::err("$errCode : Failed to delete data with key $key, column number $col_no.");
				}
				throw new BaseException($errCode, "Failed to delete data with key $key, column number $col_no.");
			}
			return $ret;
		} catch(BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * �Ի�������ʹ��CASģʽд��
	 * @param string $key �����key
	 * @param string $value ��������
	 * @param int $cas ��ǰ��CASֵ��ֻ�д����CASֵ���ڵ��ڷ�������CASֵ�����ܳɹ�д�룬��һ��д����Դ���-1������ִ�����˲�������Ϊ��������CASֵ
	 * @param int $expire_seconds ����������Ч�ڣ�����Ϊ��λ��������0��һֱ��Ч
	 * @param int $offset д���ƫ��λ��
	 * @param int $length д��ķ�Χ
	 */
	public static function casSetData($key, $value, &$cas, $expire_seconds, $offset = null, $length = null) {
		self::clearErr();
		
		try {
			$tm = self::getTMem();
			if($offset !== null && $length !== null) {
				$ret = $tm->casset(TMEM_BID_DATA_CACHE, $key, $value, &$cas, $expire_seconds, $offset, $length);
			} else if($offset !== null) {
				$ret = $tm->casset(TMEM_BID_DATA_CACHE, $key, $value, &$cas, $expire_seconds, $offset);
			} else {
				$ret = $tm->casset(TMEM_BID_DATA_CACHE, $key, $value, &$cas, $expire_seconds);
			}
			
			if($ret === false) {
				Logger::err($tm->errno(), "Failed to casset data with key $key, value $value, cas $cas.");
				throw new BaseException($tm->errno(), "Failed to casset data with key $key, value $value, cas $cas.");
			} else if($ret === null) {
				// ���ݱ���������д�룬cas��ͬ��
				throw new BaseException(ErrorConfig::getErrorCode('cas_not_match'), "Failed to casset data with key $key, value $value, cas $cas.");
			}
			
			return true;
		} catch(BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * �Ի�������ʹ��CASģʽ��ȡ
	 * @param string $key �����key
	 * @param int $cas ����ִ�����˲�������Ϊ��������CASֵ
	 * @param int $expire_timestamp ����ִ�����˲�������Ϊ�������ݵ��ڵ�ʱ���
	 * @param int $offset ��ȡ��ƫ��λ��
	 * @param int $length ��ȡ�ķ�Χ
	 */
	public static function casGetData($key, &$cas, &$expire_timestamp, $offset = null, $length = null) {
		self::clearErr();
		
		try {
			$tm = self::getTMem();
			if($offset !== null && $length !== null) {
				$ret = $tm->casget(TMEM_BID_DATA_CACHE, $key, &$cas, &$expire_timestamp, $offset, $length);
			} else if($offset !== null) {
				$ret = $tm->casget(TMEM_BID_DATA_CACHE, $key, &$cas, &$expire_timestamp, $offset);
			} else {
				$ret = $tm->casget(TMEM_BID_DATA_CACHE, $key, &$cas, &$expire_timestamp);
			}
			
			if($ret === false) {
				$errCode = $tm->errno();
				if($errCode !== self::ERROR_KEY_EXPIRED && $errCode !== self::ERROR_NO_DATA && $errCode !== self::ERROR_LOCAL_PARSE_ARGS) {
					Logger::err("$errCode : Failed to casget data with key $key, cas $cas.");
				}
				throw new BaseException($errCode, "Failed to casget data with key $key, cas $cas.");
			}
			
			return $ret;
		} catch(BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * �Ի�������ʹ��CASģʽɾ��
	 * @param string $key �����key
	 * @param int $cas ��ǰ��CASֵ��ֻ�д����CASֵ���ڵ��ڷ�������CASֵ�����ܳɹ�д�룬��һ��д����Դ���-1
	 */
	public static function casDelData($key, $cas) {
		self::clearErr();
		
		try {
			$tm = self::getTMem();
			$ret = $tm->casdel(TMEM_BID_DATA_CACHE, $key, $cas);
			
			if($ret === false) {
				$errCode = $tm->errno();
				if($errCode !== self::ERROR_KEY_NO_EXIST) {
					Logger::err("$errCode : Failed to casdel data with key $key, cas $cas.");
				}
				throw new BaseException($errCode, "Failed to casdel data with key $key, cas $cas.");
			} else if($ret === null) {
				// ���ݱ���������д�룬cas��ͬ��
				throw new BaseException(ErrorConfig::getErrorCode('cas_not_match'), "Failed to casdel data with key $key, value $value, cas $cas.");
			}
			
			return true;
		} catch(BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * incr ��ʼ��Ϊ�ض�ֵ,incr�������벻�ܸ�set/get�ӿڻ��ã����Ե���delɾ��
	 * @param string $key incr��key
	 * @param int $value ��ʼֵ
	 */
	public static function incrInit($key, $value = 0) {
		self::clearErr();
		
		try {
			$tm = self::getTMem();
			$ret = $tm->incr_init(TMEM_BID_DATA_CACHE, $key, $value);
			
			if($ret === false) {
				$errCode = $tm->errno();
				throw new BaseException($errCode, "Failed to init increment with key $key, value $value.");
			}
			
			return true;
		} catch(BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * incr ָ��ֵ��ע�⣬����Ǹ�ֵ�����൱��decr���������ս�����С��0������Ϊ0;���key������ʱ������Ϊ-13105
	 * @param string $key incr��key
	 * @param int $value ���ӵ�ֵ
	 */
	public static function incrValue($key, $value = 1) {
		self::clearErr();
		
		try {
			$tm = self::getTMem();
			$ret = $tm->incr_value(TMEM_BID_DATA_CACHE, $key, $value);
			
			if($ret === false) {
				$errCode = $tm->errno();
				if($errCode !== self::ERROR_KEY_NO_EXIST && $errCode !== self::ERROR_NO_DATA && $errCode !== self::ERROR_CAN_NOT_INCR) {
					Logger::err("$errCode : Failed to increment value with key $key, value $value.");
				}
				throw new BaseException($errCode, "Failed to increment value with key $key, value $value.");
			}
			
			return true;
		} catch(BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * ��ȡincr�������ݽ�������key������ʱ������Ϊ-13200
	 * @param string $key incr��key
	 */
	public static function incrGet($key) {
		self::clearErr();
		
		try {
			$tm = self::getTMem();
			$ret = $tm->incr_get(TMEM_BID_DATA_CACHE, $key);
			
			if($ret === false) {
				$errCode = $tm->errno();
				if($errCode !== self::ERROR_NO_DATA) {
					Logger::err("$errCode : Failed to get increment value with key $key.");
				}
				throw new BaseException($errCode, "Failed to get increment value with key $key.");
			}
			
			return $ret;
		} catch(BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * ��ȡǰ׺ͳһ�ӿڣ����Ѷ���ǰ׺�򷵻������е�ǰ׺����û���򷵻�Ĭ�ϵ�ǰ׺ _undefined_$biz_
	 * @param int $biz ����ҵ������
	 */
	public static function getPrefix($biz) {
		if(isset(self::$prefixs[$biz])) {
			return self::$prefixs[$biz];
		} else {
			return "_undefined_$biz_";
		}
	}
}