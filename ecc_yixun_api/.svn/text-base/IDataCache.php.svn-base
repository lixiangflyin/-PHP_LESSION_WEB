<?php

require_once PHPLIB_ROOT . 'inc/DataCache.inc.php';

/**
 * TMem存储简易接口，提供数据缓存的读、写、删除功能，适合少量key的数据缓存，如需大量key的数据缓存请另外申请空间
 * @author smithhuang
 */

class IDataCache {
	
	const TMEM_KEY = 'data_cache'; /**< TMem业务ID */
	
	// 定义DataCache中数据的业务类型
	/** 组件配置类型 */
	const BIZ_TYPE_COMP_CONFIG = 1; 
	/** 频率限制类型 */
	const BIZ_TYPE_FREQ_LIMIT = 2; 
	
	// tmem常见错误码
	/** 读取key对应的数据找不到 */
	const ERROR_NO_DATA = -13200; 
	/** 读取时key对应的数据已过期 */
	const ERROR_KEY_EXPIRED = -13106; 
	/** 删除时key不存在 */
	const ERROR_KEY_NO_EXIST = -13105; 
	/** 偏移操作参数不合法 */
	const ERROR_LOCAL_PARSE_ARGS = -13002;
	/** 列操作参数不合法 */
	const ERROR_SO_PARSE_ARGS = -13004;
	/** 自增操作失败 */
	const ERROR_CAN_NOT_INCR = -13110;
	/** 自增数据解析错误 */
	const ERROR_INCR_VALUE_DECODE = -11916;
	
	/**
	 * 数据业务所对应的前缀，在DataCache.inc.php中定义
	 * @var array
	 */
	public static $prefixs;
	
	/** 当接口函数出错时，此变量被设为引起错误的错误码 */
	public static $errCode; 
	/** 当接口函数出错时，此变量被设为引起错误的错误信息 */
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
	 * 写入缓存数据，不支持批量操作
	 * @param $key 缓存的key
	 * @param $data 缓存数据，非字符串型数据先序列化为字符串
	 * @return 写入成功返回true，写入失败返回false
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
	 * 获取缓存数据，支持批量操作
	 * @param $key 缓存的key，若需批量操作将key以数组形式传入
	 * @return 返回缓存数据，若获取失败返回false，若批量操作则返回关联数组，某个key获取数据失败则对应的内容为false
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
	 * 删除缓存数据，支持批量操作
	 * @param $key 缓存的key，若需批量操作将key以数组形式传入
	 * @return 删除成功返回true，删除失败返回false，若批量操作则返回关联数组，每个key对应其操作结果
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
	 * 在缓存数据的指定部分写入，不支持批量操作
	 * @param $key 缓存的key
	 * @param $data 缓存数据，非字符串型数据先序列化为字符串
	 * @param $offset 缓存数据写入的偏移位置
	 * @param $len 缓存数据写入的范围
	 * @return 写入成功返回true，写入失败返回false
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
	 * 在缓存数据的指定部分读取，不支持批量操作
	 * @param $key 缓存的key
	 * @param $offset 缓存数据读取的偏移位置
	 * @param $len 缓存数据读取的范围
	 * @return 成功返回缓存数据，失败返回false
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
	 * 对缓存数据按列写入，支持单key单列写入、单key多列写入、多key多列写入
	 * @param $key 缓存的key，多key写入时传入数组
	 * @param $col_no 缓存数据的列，单key多列时传入数组，多key多列时传入二维数组
	 * @param $data 缓存数据，非字符串型数据先序列化为字符串，单key多列时传入数组，多key多列时传入二维数组
	 * @return 写入成功返回true，写入失败返回false，单key多列时返回关联数组，多key多列时返回二维关联数组
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
	 * 对缓存数据按列读取，支持单key单列读取、单key多列读取、多key多列读取
	 * @param $key 缓存的key，多key读取时传入数组
	 * @param $col_no 缓存数据的列，单key多列时传入数组，多key多列时传入二维数组
	 * @return 读取成功返回缓存数据，读取失败返回false，单key多列时返回关联数组，多key多列时返回二维关联数组
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
	 * 对缓存数据按列删除，支持单key单列删除、单key多列删除、多key多列删除
	 * @param $key 缓存的key，多key写入时传入数组
	 * @param $col_no 缓存数据的列，单key多列时传入数组，多key多列时传入二维数组
	 * @return 删除成功返回true，删除失败返回false，单key多列时返回关联数组，多key多列时返回二维关联数组
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
	 * 对缓存数据使用CAS模式写入
	 * @param string $key 缓存的key
	 * @param string $value 缓存数据
	 * @param int $cas 当前的CAS值，只有传入的CAS值大于等于服务器的CAS值，才能成功写入，第一次写入可以传入-1，函数执行完后此参数被设为服务器的CAS值
	 * @param int $expire_seconds 缓存数据有效期，以秒为单位，若传入0则一直有效
	 * @param int $offset 写入的偏移位置
	 * @param int $length 写入的范围
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
				// 数据被其他进程写入，cas不同步
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
	 * 对缓存数据使用CAS模式读取
	 * @param string $key 缓存的key
	 * @param int $cas 函数执行完后此参数被设为服务器的CAS值
	 * @param int $expire_timestamp 函数执行完后此参数被设为缓存数据到期的时间戳
	 * @param int $offset 读取的偏移位置
	 * @param int $length 读取的范围
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
	 * 对缓存数据使用CAS模式删除
	 * @param string $key 缓存的key
	 * @param int $cas 当前的CAS值，只有传入的CAS值大于等于服务器的CAS值，才能成功写入，第一次写入可以传入-1
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
				// 数据被其他进程写入，cas不同步
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
	 * incr 初始化为特定值,incr操作必须不能跟set/get接口混用，可以调用del删除
	 * @param string $key incr的key
	 * @param int $value 初始值
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
	 * incr 指定值，注意，如果是负值，则相当于decr操作，最终结果如果小于0，则被置为0;如果key不存在时错误码为-13105
	 * @param string $key incr的key
	 * @param int $value 增加的值
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
	 * 获取incr操作数据结果，如果key不存在时错误码为-13200
	 * @param string $key incr的key
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
	 * 获取前缀统一接口，若已定义前缀则返回配置中的前缀，若没有则返回默认的前缀 _undefined_$biz_
	 * @param int $biz 数据业务类型
	 */
	public static function getPrefix($biz) {
		if(isset(self::$prefixs[$biz])) {
			return self::$prefixs[$biz];
		} else {
			return "_undefined_$biz_";
		}
	}
}