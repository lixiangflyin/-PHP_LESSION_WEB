<?php
define('QQCB_OPEN_HOST', 'open.cb.qq.com');
define('QQCB_OPEN_IP', '119.147.197.20');
define('QQCB_OPEN_ADDRESS_URL', 'http://' . QQCB_OPEN_IP . '/OpenAPI/openkey/get_user_address.php');

class IQQCBAddress {
//	const MallKey1 = 'Iuy82d$Ob$yj57*#wnt2Wp#g*3Q@u3sc'; //商家请求的key1和key2
//	const MallKey2 = 'mgg8*ew1zWQ2^*4^lyRp96k5tb^7gWue';
//
//	const FanliKey1 = '$ft6^fgyQQ46@n^sfuxwg7g3Wtsooh6%'; //地址信息签名的key1和key2
//	const FanliKey2 = 'iURw7$gajRu*Iq!^0tl$*dU905x9jzk#';

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

		$sort_ret = ksort($params);
		if ($sort_ret) {
			$sign = self::sign($params);
			$params['sign'] = $sign;

			$url = QQCB_OPEN_ADDRESS_URL . '?';
			$tmp = array();
			foreach ($params as $k=>$v) {
				$tmp[] = "{$k}={$v}";
			}
			$url .= implode('&', $tmp);

			$response = NetUtil::cURLHTTPGet($url, 3, QQCB_OPEN_HOST);
			if (false === $response) {
				self::setERR(NetUtil::$errCode, NetUtil::$errMsg);
				return false;
			}

			$ret = json_decode($response, true);

			if ( (!isset($ret['ret_code'])) || $ret['ret_code'] != 0) {
				self::setERR(8903, 'result error, code: ' . $ret['ret_code'] . ', msg: ' . $ret['ret_msg']);
				return false;
			}

			foreach ($ret['shopping_address'] as &$addr_info) {
				foreach ($addr_info as &$_info) {
					$_info = mb_convert_encoding(urldecode($_info), 'GBK', 'UTF-8');
				}
			}
			return $ret['shopping_address'];
		}
		else {
			Logger::info(__CLASS__ . '::' . __FUNCTION__ . ' sort FAILED.');
			self::setERR(500, 'sort params error');
			return false;
		}
	}

	private static function sign($params) {
		ksort($params);

		return md5(implode('', array_values($params)) . TENCENT_APP_KEY);
	}
}

// End Of Script