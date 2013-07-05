<?php

define("ALIPAY_API_GATEWAY", 'https://mapi.alipay.com/gateway.do');
define("ALIPAY_API_SP_ID", '2088201932476279');
define("ALIPAY_API_SIGN_KEY", '2kfwmom37g7pdnld7wono27jrytscofr');

class IAliWapAPI {
	public static $errCode = 0;
	public static $errMsg = '';

	private static function setERR($code, $msg) {
		self::$errCode = $code;
		self::$errMsg = $msg;
	}

	private static function clearERR() {
		self::setERR(0, '');
	}

	public static function request($params) {
		self::clearERR();

		if (empty($params['return_url']) || !preg_match("/^http:\/\/([^\.]+\.|)51buy\.com/i", $params['return_url'])) {
			$params['return_url'] = '';
		}

		$params['partner'] = ALIPAY_API_SP_ID;
		if (!isset($params['_input_charset'])) $params['_input_charset'] = "GB2312";

		$sign = self::sign($params);
		foreach ($params as $k => $value) {
			$params[$k] = $k . '=' . rawurlencode($value);
		}
		$signStr = implode("&", $params);
		$signStr .= "&sign_type=MD5&sign=" . $sign;

		ToolUtil::redirect(ALIPAY_API_GATEWAY . '?' . $signStr);
	}

	public static function response($params) {
		self::clearERR();

		$sign = empty($params['sign']) ? '' : $params['sign'];
		if (empty($sign)) {
			self::setERR(8602, 'sign is empty');
			return false;
		}

		unset($params['mod'], $params['act'], $params['app'], $params['url'], $params['sign'], $params['sign_type']); //去掉多余的参数,准备计算签名
		if (self::sign($params) != $sign) {
			self::setERR(8603, 'sign is not correct');
			return false;
		}

		return $params;
	}

	private static function sign($params) {
		ksort($params);
		$tmp = array();
		foreach ($params as $k => $value) {
			$tmp[] = $k . '=' . $value;
		}

		return md5(implode("&", $tmp) . ALIPAY_API_SIGN_KEY);
	}

}

// End Of Script