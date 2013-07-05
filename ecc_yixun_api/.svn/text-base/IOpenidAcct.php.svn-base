<?php
// 废弃掉了，经过确认，不需要处理彩贝的openid字段
/**
 * 作为openid和acct的转换方案
 * 在当前QQ用户都是openid作为key的情况下，使用一个openid和acct的对应表
 * 过程：
 *   首先根据Openid获取uid，然后可以获取一组openid和acct
 * @author myforchen
 *
 */
class IOpenidAcct {
	public static $errCode = 0;
	public static $errMsg = '';

	private static function setERR($code, $msg){
		self::$errCode = $code;
		self::$errMsg = $msg;
	}

	private static function clearERR(){
		self::setERR(0, '');
	}

	/**
	 * 存储某用户的openid和acct
	 * 当用户跳转过来登录后，是可以获取到uid的，这时候调用该方法存储
	 * @param int $uid 用户ID
	 * @param string $openid 老的openid值
	 * @param string $acct 新的acct值
	 */
	public static function saveOpenidAcct($uid, $openid, $acct){
		self::clearERR();

		if(empty($uid) || empty($openid) || empty($acct)){
			self::setERR(8601, "param is not correct");
			return false;
		}

		$openidAcct = IOpenidAcctTTC::get($uid);
		if($openidAcct === false){
			self::setERR(8602, "IOpenidAcctTTC::get failed, code: " . IOpenidAcctTTC::$errCode . ", msg: " . IOpenidAcctTTC::$errMsg);
			return false;
		}

		$params = array(
			'uid'		=> $uid,
			'openid'	=> $openid,
			'acct'		=> $acct,
			'update_time'	=> time()
		);
		if(count($openidAcct) > 0){
			$ret = IOpenidAcctTTC::update($params);
			if($ret === false){
				self::setERR(8603, "IOpenidAcctTTC::update failed, code: " . IOpenidAcctTTC::$errCode . ", msg: " . IOpenidAcctTTC::$errMsg);
				return false;
			}
		} else {
			$ret = IOpenidAcctTTC::insert($params);
			if($ret === false){
				self::setERR(8604, "IOpenidAcctTTC::update failed, code: " . IOpenidAcctTTC::$errCode . ", msg: " . IOpenidAcctTTC::$errMsg);
				return false;
			}
		}

		return true;
	}

	/**
	 * 获取某uid用户的acct
	 * @param int $uid 用户ID
	 */
	public static function getAcctOfUid($uid){
		self::clearERR();

		if(empty($uid)){
			self::setERR(8605, "param is not correct");
			return false;
		}

		$openidAcct = IOpenidAcctTTC::get($uid);
		if($openidAcct === false){
			self::setERR(8606, "IOpenidAcctTTC::get failed, code: " . IOpenidAcctTTC::$errCode . ", msg: " . IOpenidAcctTTC::$errMsg);
			return false;
		}

		if(count($openidAcct) == 0){
			self::setERR(8611, "no record found");
			return false;
		}

		return $openidAcct[0]['acct'];
	}

	/**
	 * 获取某uid用户的openid
	 * @param int $uid 用户ID
	 */
	public static function getOpenidOfUid($uid){
		self::clearERR();

		if(empty($uid)){
			self::setERR(8607, "param is not correct");
			return false;
		}
	
		$openidAcct = IOpenidAcctTTC::get($uid);
		if($openidAcct === false){
			self::setERR(8608, "IOpenidAcctTTC::get failed, code: " . IOpenidAcctTTC::$errCode . ", msg: " . IOpenidAcctTTC::$errMsg);
			return false;
		}

		if(count($openidAcct) == 0){
			self::setERR(8611, "no record found");
			return false;
		}

		return $openidAcct[0]['openid'];
	}
}

// End Of Script