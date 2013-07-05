<?php
require_once PHPLIB_ROOT . 'api/IVerifyConfig.inc.php';

/**
 * 统一用户验证接口，提供根据活动配置对用户身份验证的接口，如领券、抽奖活动，
 * 同时也可能对用户单项身份验证，如新用户、老用户、QQ会员等。
 * @author smithhuang
 */
class IVerifyConfig {
	
	private static $failed_type = 0;
	private static $error_code = 0;
	
	private static $verify_session;
	
	public static $errCode = 0; /**< 当接口函数出错时，此变量被设为引起错误的错误码 */
	public static $errMsg = ''; /**< 当接口函数出错时，此变量被设为引起错误的错误信息 */
	
	private static function clearErr() {
		self::$errCode = 0;
		self::$errMsg = '';
	}
	
	private static function getVerifier($verify_type) {
		global $_VERIFIER;
		if(isset($_VERIFIER[$verify_type])) {
			return $_VERIFIER[$verify_type];
		} else {
			throw new BaseException(ErrorConfig::getErrorCode('verifier_not_found'), "Failed to find verifier $verify_type.");
		}
	}
	
	/**
	 * 活动组件用户身份验证接口，根据活动组件的验证配置，对用户身份进行验证，若满足条件返回true，不满足条件返回false
	 * @param $act_type int 活动组件类型
	 * @param $act_id int 活动组件id
	 * @param $sub_id int 验证配置id
	 * @param $params array 验证相关参数
	 * @return 返回用户是否符合活动组件的要求
	 */
	public static function verify($act_type, $act_id, $sub_id, $params) {
		
		self::clearErr();
		
		self::$failed_type = 0;
		self::$error_code = 0;
		
		self::$verify_session = array();
		
		try {
			$params['ACT_TYPE'] = $act_type;
			$params['ACT_ID'] = $act_id;
			$params['SUB_ID'] = $sub_id;
			$configs = self::getVerifyConfig($act_type, $act_id, $sub_id);
			if($configs === false) {
				return false;
			}
			foreach ($configs as $c) {
				$ret = self::dispatch($c['verify_type'], $c['params'], $params);
				if($ret === true) {
					continue;
				} else if(is_int($ret)) {
					self::$failed_type = $c['verify_type'];
					self::$error_code = $ret;
					return false;
				} else {
					throw new BaseException(ErrorConfig::getErrorCode('unexpected_return'), "Unexpected return $ret when execute verifier {$c['verify_type']}.");
				}
			}
			return true;
		} catch(BaseException $e) {
			Logger::err("Error {$e->errCode} : {$e->errMsg}.");
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * 获取验证失败的信息，当验证失败时，此函数返回引起验证失败的相关信息
	 * @return 返回验证失败信息的数组，其中verify_type为引起失败的验证类型，err_code为失败的错误码，err_msg为失败的错误信息
	 */
	public static function getFailedInfo() {
		global $_VERIFY_ERR_MSG;
		return array(
			'verify_type' => self::$failed_type,
			'err_code' => self::$error_code,
			'err_msg' => isset($_VERIFY_ERR_MSG[self::$failed_type][self::$error_code]) ? $_VERIFY_ERR_MSG[self::$failed_type][self::$error_code] : ''
		);
	}
	
	/**
	 * 从tmem中获取活动所配置的验证信息
	 * @param $act_type 活动组件类型
	 * @param $act_id 活动组件id
	 * @param $sub_id 活动配置id
	 * @return 返回与活动组件对应的验证配置信息，若失败则返回false
	 */
	public static function getVerifyConfig($act_type, $act_id, $sub_id) {
		try {
			self::clearErr();
			
			$key = "verify_config_{$act_type}_{$act_id}_{$sub_id}";
			$tm = Config::getTMem('verify_config');
			if($tm === false) {
				throw new BaseException(Config::$errCode, Config::$errMsg);
			}
			
			$ret = $tm->get(TMEM_BID_VERIFY_CONFIG, $key);
			if($ret === false) {
				if($tm->errno() === -13200) {
					// 没有配置
					return array();
				} else {
					throw new BaseException($tm->errno(), "Failed to get data with key $key.");
				}
			}
			return unserialize($ret);
		} catch(BaseException $e) {
			Logger::err("Error {$e->errCode} : {$e->errMsg}.");
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * 将验证配置信息储存入tmem中
	 * @param $act_type 活动组件类型
	 * @param $act_id 活动组件id
	 * @param $sub_id 活动配置id
	 * @param $configs 验证配置信息
	 * @return 成功返回true，失败返回false
	 */
	public static function cacheVerifyConfig($act_type, $act_id, $sub_id, $configs) {
		try {
			self::clearErr();
			$key = "verify_config_{$act_type}_{$act_id}_{$sub_id}";
			$tm = Config::getTMem('verify_config');
			if($tm === false) {
				throw new BaseException(Config::$errCode, Config::$errMsg);
			}
			
			$ret = $tm->set(TMEM_BID_VERIFY_CONFIG, $key, serialize($configs));
			if($ret === false) {
				throw new BaseException($tm->errno(), "Failed to set data with key $key.");
			}
		} catch(BaseException $e) {
			Logger::err("Error {$e->errCode} : {$e->errMsg}.");
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * 更新验证配置有效期
	 * @param $act_type 活动组件类型
	 * @param $act_id 活动组件id
	 * @param $start_time 活动配置生效时间
	 * @param $end_time 活动配置失效时间
	 * @return 成功返回true，失败返回false
	 */
	public static function updateVerifyConfigTime($act_type, $act_id, $start_time, $end_time) {
		try {
			self::clearErr();
			
			$dao = new IMySQLDAO('icson_event', 't_verify_config');
			$now = time();
			$status = ($end_time >= $now) ? 1 : 2;
			$dao->update(array( 'start_time' => $start_time, 'end_time' => $end_time, 'status' => $status ), "act_type = $act_type AND act_id = $act_id AND status IN (1, 2)");
			$sub_id_res = $dao->query("SELECT DISTINCT sub_id FROM t_verify_config WHERE act_type = $act_type AND act_id = $act_id");
			foreach ($sub_id_res as $sr) {
				$res = $dao->getRows('', "act_type = $act_type AND act_id = $act_id AND sub_id = {$sr['sub_id']} AND status IN (1, 2)", null, null);
				foreach ($res as &$r) {
					$r['params'] = unserialize($r['params']);
				}
				self::cacheVerifyConfig($act_type, $act_id, $sr['sub_id'], $res);
			}
		} catch(BaseException $e) {
			Logger::err("Error {$e->errCode} : {$e->errMsg}.");
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	private static function dispatch($verify_type, $config, $params) {
		$verifier = self::getVerifier($verify_type);
		if(isset(self::$verify_session[$verifier[0]])) {
			$func = array(self::$verify_session[$verifier[0]], $verifier[1]);
		} else {
			$file = PHPLIB_ROOT . "api/verifier/{$verifier[0]}.php";
			if(!file_exists($file)) {
				Logger::err("File $file not found.");
				throw new BaseException(ErrorConfig::getErrorCode('class_not_found'), "Failed to load class {$verifier[0]}.");
			}
			require_once $file;
			if(class_exists($verifier[0])) {
				$obj = new $verifier[0]($params);
				self::$verify_session[$verifier[0]] = $obj;
				$func = array($obj, $verifier[1]);
			} else {
				Logger::err("Class {$verifier[0]} not found.");
				throw new BaseException(ErrorConfig::getErrorCode('class_not_found'), "Failed to find class {$verifier[0]}.");
			}
		}
		return call_user_func($func, $config);
	}
	
	/**
	 * 验证用户身份，可以用来单独判断某项验证
	 * @param $verify_type 验证类型
	 * @param $params 验证相关参数
	 * @return 验证通过返回true，验证未通过或者异常返回false，验证未通过可以通过getFailedInfo获取未通过的原因，异常情况查询$errCode、$errMsg信息
	 */
	public static function verifyUser($verify_type, $params = array()) {
		try {
			self::clearErr();
			
			$ret = self::dispatch($verify_type, array(), $params);
			if($ret === true) {
				return true;
			} else if(is_int($ret)) {
				self::$failed_type = $verify_type;
				self::$error_code = $ret;
				return false;
			} else {
				throw new BaseException(ErrorConfig::getErrorCode('unexpected_return'), "Unexpected return $ret when execute verifier $verify_type.");
			}
		} catch(BaseException $e) {
			Logger::err("Error {$e->errCode} : {$e->errMsg}.");
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * 获取验证名称
	 * @param $verify_type 验证类型
	 * @return 验证的名称，若未定义则返回空字符串
	 */
	public static function getVerifierName($verify_type) {
		global $_VERIFIER_NAME;
		return isset($_VERIFIER_NAME[$verify_type]) ? $_VERIFIER_NAME[$verify_type] : '';
	}
	
	/**
	 * 增加验证对象关联，比如订单验证的订单号，已关联的验证对象再次验证时将不能通过验证
	 * @param $act_type 活动组件类型
	 * @param $act_id 活动组件id
	 * @param $object_type 验证对象类型
	 * @param $object_id 验证对象id
	 * @param $record_id 相关记录id
	 * @return 成功返回true，失败返回false
	 */
	public static function addVerifyObjectMap($act_type, $act_id, $object_type, $object_id, $record_id = 0) {
		try {
			self::clearErr();
			$ret = IVerifyObjectMapTTC::insert(array(
				'act_type' => $act_type,
				'act_id' => $act_id,
				'object_type' => $object_type,
				'object_value' => $object_id,
				'record_id' => $record_id
			));
			if($ret === false) {
				Logger::err(IVerifyObjectMapTTC::$errCode . ' : ' . IVerifyObjectMapTTC::$errMsg);
				throw new BaseException(IVerifyObjectMapTTC::$errCode, "Failed to add verify object map with act type $act_type, act id $act_id, object type $object_type, object id $object_id, record id $record_id.");
			}
		} catch(BaseException $e) {
			Logger::err("Error {$e->errCode} : {$e->errMsg}.");
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * 检验验证对象是否可关联
	 * @param $act_type 活动组件类型
	 * @param $act_id 活动组件id
	 * @param $object_type 验证对象类型
	 * @param $object_id 验证对象id
	 * @return 若验证对象未关联返回true，若验证对象已关联或者验证失败返回false
	 */
	public static function checkVerifyObjectMap($act_type, $act_id, $object_type, $object_id) {
		try {
			self::clearErr();
			$ret = IVerifyObjectMapTTC::get($act_id, array(
				'act_type' => $act_type,
				'object_type' => $object_type,
				'object_value' => $object_id
			));
			if($ret === false) {
				Logger::err(IVerifyObjectMapTTC::$errCode . ' : ' . IVerifyObjectMapTTC::$errMsg);
				throw new BaseException(IVerifyObjectMapTTC::$errCode, "Failed to check verify object with act type $act_type, act id $act_id, object type $object_type, object value $object_id.");
			}
			return empty($ret);
		} catch(BaseException $e) {
			Logger::err("Error {$e->errCode} : {$e->errMsg}.");
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	public static function checkParameterNeeded($act_type, $act_id, $sub_id) {
		$configs = self::getVerifyConfig($act_type, $act_id, $sub_id);
		if($configs === false) {
			return false;
		}
		global $_VERIFIER_PARAMS;
		$params = array();
		foreach ($configs as $c) {
			if(isset($_VERIFIER_PARAMS[$c['verify_type']]) && !empty($_VERIFIER_PARAMS[$c['verify_type']])) {
				foreach ($_VERIFIER_PARAMS[$c['verify_type']] as $p) {
					$params[] = $p;
				}
			}
		}
		return array_unique($params);
	}
}