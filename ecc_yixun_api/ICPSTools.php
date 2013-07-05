<?php if(file_exists('/data/COV/script/XDebugTester.php')){require_once('/data/COV/script/XDebugTester.php');XDebugTester::addFile(__FILE__);}/* phpwithxdebug_md5:5491276593cfd4f20efc6bde9b3fcfef:valueend */
/*
require_once(PHPLIB_ROOT . 'api/tp_netclient.php');

require_once(PHPLIB_ROOT . 'inc/CPSConfig.inc.php');
require_once(PHPLIB_ROOT . 'inc/paytype.inc.php'); //支付类型
require_once(PHPLIB_ROOT . 'inc/paytypevia.inc.php'); //QQCB 支付类型转换
require_once(PHPLIB_ROOT . 'lib/NetUtil.php');//add by wheelswang
*/
define("CPS_COOKIE_KEY","Dj39&#093kZFr0erjE289phrdftzp2@@Ijgl");

class ICPSTools {
	
	public static function authCode($str, $operate = 'DECODE', $key = '', $expiry = 0) {

		$ckey_length = 4;
		$key = md5($key != '' ? $key : CPS_COOKIE_KEY);
		$keya = md5(substr($key, 0, 16));
		$keyb = md5(substr($key, 16, 16));
		$keyc = $ckey_length ? ($operate == 'DECODE' ? substr($str, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

		$cryptkey = $keya.md5($keya.$keyc);
		$key_length = strlen($cryptkey);

		$str = $operate == 'DECODE' ? base64_decode(substr($str, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($str.$keyb), 0, 16).$str;

		$str_length = strlen($str);

		$result = '';
		$box = range(0, 255);

		$rndkey = array();
		for($i = 0; $i <= 255; $i++) {
			$rndkey[$i] = ord($cryptkey[$i % $key_length]);
		}

		for($j = $i = 0; $i < 256; $i++) {
			$j = ($j + $box[$i] + $rndkey[$i]) % 256;
			$tmp = $box[$i];
			$box[$i] = $box[$j];
			$box[$j] = $tmp;
		}

		for($a = $j = $i = 0; $i < $str_length; $i++) {
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;
			$tmp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $tmp;
			$result .= chr(ord($str[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
		}

		if($operate == 'DECODE') {
			if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
				return substr($result, 26);
			} else {
				return '';
			}
		} else {
			return $keyc.str_replace('=', '', base64_encode($result));
		}

	}

	public static function getCpsCookies($name = 'cps_cookies',$isEncrypt=true){
	
		if(!isset($_COOKIE[$name])){
			return false;
		}
		if(!$isEncrypt){
			$decodeStr = $_COOKIE[$name];
		}else{
			$decodeStr = self::authCode($_COOKIE[$name]);
			if(!$decodeStr) {
				return false;
			}
		}
		$cookie = explode(',',$decodeStr);
		$sysid = $cookie[0];
		$type = $cookie[1];
		if($type == 'owner' || $type == 'union'){
			unset($cookie[1]);
		}else{
			$type = '';
		}
		
		unset($cookie[0]);
		$encodeStr = implode(',',$cookie);

		return array('sysid'=>$sysid,'type'=>$type,'cps_cookies'=>$encodeStr);
	}

	
}

// End Of Script