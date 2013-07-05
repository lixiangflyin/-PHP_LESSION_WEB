<?php
require_once('constant.inc.php');
require_once('inc/IVerifyCodeTTC.php');

define('VERIFY_CODE_TYPE_EMAIL', 1);
define('VERIFY_CODE_TYPE_MOBILE', 2);

define('EMAIL_VERIFY_CODE_VALID_TIME', 86400); // 24*3600
define('MOBILE_VERIFY_CODE_VALID_TIME', 600);

class IVerify
{
	public static $errCode = 0;
	public static $errMsg = '';

	//返回生成的email验证码，其中包含了uid
	public static function getEmailVerifyCode($uid, $email)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 903;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}

		$oldCode = IVerifyCodeTTC::get($uid, array('type'=>VERIFY_CODE_TYPE_EMAIL));
		if (false === $oldCode) {
			self::$errCode = IVerifyCodeTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IVerifyCodeTTC failed]' . IVerifyCodeTTC::$errMsg;
			return false;
		}

		$code = rand();
		$code = sprintf("%08X", $code);
		$validTime = time() + EMAIL_VERIFY_CODE_VALID_TIME;


		if (0 != count($oldCode)) {
			$ret = IVerifyCodeTTC::update(array('uid'=>$uid, 'code'=>$code, 'valid_time' => $validTime, 'account'=>$email), array('type'=>VERIFY_CODE_TYPE_EMAIL));
		}else
		{
			$ret = IVerifyCodeTTC::insert(array('uid'=>$uid, 'code'=>$code,'type'=>VERIFY_CODE_TYPE_EMAIL, 'valid_time' => $validTime,'account'=>$email));
		}

		if (false === $ret)
		{
			self::$errCode = IVerifyCodeTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[insert or update IVerifyCodeTTC failed]' . IVerifyCodeTTC::$errMsg;
			return false;
		}

		return sprintf("%08X%s", $uid, $code);
	}

	public static function getMobileVerifyCode($uid, $mobile)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 903;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}

		$oldCode = IVerifyCodeTTC::get($uid, array('type'=>VERIFY_CODE_TYPE_MOBILE));
		if (false === $oldCode) {
			self::$errCode = IVerifyCodeTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IVerifyCodeTTC failed]' . IVerifyCodeTTC::$errMsg;
			return false;
		}

		$code = "";
		$chars = 'ABCDEFGHJKLMNPQRSTUVWXY3456789'; // 去掉0，O，1、L、2、Z
		$charsLen = strlen($chars);
		for ( $i = 0; $i < 5; $i++ ) {
			$code .= $chars[ mt_rand(0, $charsLen - 1) ];
		}
		$validTime = time() + MOBILE_VERIFY_CODE_VALID_TIME;

		if (0 != count($oldCode)) {
			$ret = IVerifyCodeTTC::update(array('uid'=>$uid, 'code'=>$code, 'valid_time' => $validTime, 'account'=>$mobile), array('type'=>VERIFY_CODE_TYPE_MOBILE));
		}else
		{
			$ret = IVerifyCodeTTC::insert(array('uid'=>$uid, 'code'=>$code,'type'=>VERIFY_CODE_TYPE_MOBILE, 'valid_time' => $validTime, 'account'=>$mobile));
		}

		if (false === $ret)
		{
			self::$errCode = IVerifyCodeTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[insert or update IVerifyCodeTTC failed]' . IVerifyCodeTTC::$errMsg;
			return false;
		}

		return $code;
	}

	public static function checkEmailVerifyCode($uid, $code, $email)
	{
		if (!isset($code) || strlen($code) != 8) {
			self::$errCode = 903;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "code($code) is invalid";
			return false;
		}


		$codeInCache = IVerifyCodeTTC::get($uid, array('type'=>VERIFY_CODE_TYPE_EMAIL));
		if (false === $codeInCache) {
			self::$errCode = IVerifyCodeTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IVerifyCodeTTC failed]' . IVerifyCodeTTC::$errMsg;
			return false;
		}
		if (count($codeInCache) == 0) {
			self::$errCode = -906;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "no code($code)in code cache";
			return false;
		}

		$codeInCache = &$codeInCache[0];
		if ($codeInCache['code'] != $code) {
			self::$errCode = -909;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "no code($code) is not correct";
			return false;
		}

		if ($codeInCache['account'] != $email) {
			self::$errCode = -909; 
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "no email($email) is not correct";
			return false;
		}
		
		if ($codeInCache['valid_time'] < time()) {
			self::$errCode = -910;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "no code($code) is expired";
			return false;
		}

		IVerifyCodeTTC::remove($uid, array('type'=>VERIFY_CODE_TYPE_EMAIL));
		return true;
	}

	public static function checkMobileVerifyCode($uid, $code , $mobile)
	{
		$code = trim($code);

		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 903;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}

		if (!isset($code) || strlen($code) != 5) {
			self::$errCode = 903;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "code($code) is invalid";
			return false;
		}

		$codeInCache = IVerifyCodeTTC::get($uid, array('type'=>VERIFY_CODE_TYPE_MOBILE));
		if (false === $codeInCache) {
			self::$errCode = IVerifyCodeTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IVerifyCodeTTC failed]' . IVerifyCodeTTC::$errMsg;
			return false;
		}
		if (count($codeInCache) == 0) {
			self::$errCode = -906;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "no code($code)in code cache";
			return false;
		}

		$codeInCache = &$codeInCache[0];
		if (strtoupper($codeInCache['code']) != strtoupper($code)) {
			self::$errCode = -909;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "no code($code) is not correct";
			return false;
		}

		if ($codeInCache['valid_time'] < time()) {
			self::$errCode = -910;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "no valid_time is expired";
			return false;
		}

		if ($codeInCache['account'] != $mobile) {
			self::$errCode = -910;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "no mobile($mobile) is expired";
			return false;
		}
		
		IVerifyCodeTTC::remove($uid, array('type'=>VERIFY_CODE_TYPE_MOBILE));
		return true;
	}
	
		public static function getMobileVerifyCodeNew($uid, $mobile)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 903;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}

		$oldCode = IVerifyCodeTTC::get($uid, array('type'=>VERIFY_CODE_TYPE_MOBILE));
		if (false === $oldCode) {
			self::$errCode = IVerifyCodeTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IVerifyCodeTTC failed]' . IVerifyCodeTTC::$errMsg;
			return false;
		}

		$code = "";
		//$chars = 'ABCDEFGHJKLMNPQRSTUVWXY3456789'; // 去掉0，O，1、L、2、Z
		$chars = '1234567890'; // 去掉0，O，1、L、2、Z

		$charsLen = strlen($chars);
		for ( $i = 0; $i < 6; $i++ ) {
			$code .= $chars[ mt_rand(0, $charsLen - 1) ];
		}
		$validTime = time() + MOBILE_VERIFY_CODE_VALID_TIME;

		if (0 != count($oldCode)) {
			$ret = IVerifyCodeTTC::update(array('uid'=>$uid, 'code'=>$code, 'valid_time' => $validTime, 'account'=>$mobile), array('type'=>VERIFY_CODE_TYPE_MOBILE));
		}else
		{
			$ret = IVerifyCodeTTC::insert(array('uid'=>$uid, 'code'=>$code,'type'=>VERIFY_CODE_TYPE_MOBILE, 'valid_time' => $validTime, 'account'=>$mobile));
		}

		if (false === $ret)
		{
			self::$errCode = IVerifyCodeTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[insert or update IVerifyCodeTTC failed]' . IVerifyCodeTTC::$errMsg;
			return false;
		}

		return $code;
	}
	public static function checkMobileVerifyCodeNew($uid, $code , $mobile)
	{
		$code = trim($code);

		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 903;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}

		if (!isset($code) || strlen($code) != 6) {
			self::$errCode = 903;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "code($code) is invalid";
			return false;
		}

		$codeInCache = IVerifyCodeTTC::get($uid, array('type'=>VERIFY_CODE_TYPE_MOBILE));
		if (false === $codeInCache) {
			self::$errCode = IVerifyCodeTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IVerifyCodeTTC failed]' . IVerifyCodeTTC::$errMsg;
			return false;
		}
		if (count($codeInCache) == 0) {
			self::$errCode = -906;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "no code($code)in code cache";
			return false;
		}

		$codeInCache = &$codeInCache[0];
		if (strtoupper($codeInCache['code']) != strtoupper($code)) {
			self::$errCode = -909;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "no code($code) is not correct";
			return false;
		}

		if ($codeInCache['valid_time'] < time()) {
			self::$errCode = -910;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "no valid_time is expired";
			return false;
		}

		if ($codeInCache['account'] != $mobile) {
			self::$errCode = -910;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "no mobile($mobile) is expired";
			return false;
		}
		
		IVerifyCodeTTC::remove($uid, array('type'=>VERIFY_CODE_TYPE_MOBILE));
		return true;
	}
}

