<?php
define("TENCENT_APP_ID", '215585');
define("TENCENT_APP_KEY", 'cbedab258c4b3e9d93e034796b741d56');

class ITencentAPI {
	public static $errCode = 0;
	public static $errMsg = '';

	static $params = array();
	static $url = '';
	private static $apiList = array(
		// 跳转登录页面
		'oauth_authorize'	=> array(
			// 请求地址
			'urlpath'	=> 'moc/oauth_authorize',
			// host
			'host'	=> 'open.z.qq.com',
			// 必须字段
			'required_fields'	=> array(
				'oauth_token',
				'oauth_callback',
			),
			// 可选字段
			'other_fields'	=> array(
				'g_ut',
			),
		),
		// 请求临时token
		'oauth_request_token'	=> array(
			// 请求地址
			'urlpath'	=> 'moc/oauth_request_token',
			// host
			'host'	=> 'open.z.qq.com',
			// ip
			'ip'	=> 'open.z.qq.com',
			// 必须字段
			'required_fields'	=> array(
			),
			// 可选字段
			'other_fields'	=> array(
				'oauth_client_ip',
			),
		),

		'oauth_access_token'	=> array(
			// 请求地址
			'urlpath'	=> 'moc/oauth_access_token',
			// host
			'host'	=> 'open.z.qq.com',
			// ip
			'ip'	=> 'open.z.qq.com',
			// 必须字段
			'required_fields'	=> array(
				'oauth_token',
				'oauth_vericode'
			),
			// 可选字段
			'other_fields'	=> array(
				'oauth_client_ip',
			),
		)
	);

	protected static function setERR($code, $msg){
		self::$errCode = $code;
		self::$errMsg = $msg;
	}

	protected static function clearERR(){
		self::setERR(0, '');
	}
//get("oauth_request_token", array(), "");
//oauth_access_token
	private static function request($apiName, $params, $secret = '', $method = 'GET' ){
		self::clearERR();
		if(!isset(self::$apiList[$apiName])){
			self::setERR('9001', 'undefined apiName');
			return false;
		}
		
		$apiOpt = self::$apiList[$apiName];
		$params = self::checkParams($apiName, $params);
		if($params === false) return false;
		//file_put_contents("/data/release/PHPLIB/api/txt.txt", "vive16: empty $params"."\n", FILE_APPEND);
		$params['oauth_consumer_key'] = TENCENT_APP_ID;
		$params['oauth_version'] = '1.0';
		$params['oauth_timestamp'] = time();
		$params['oauth_nonce'] = mt_rand();
		$params['oauth_signature_method'] = 'HMAC-SHA1';

		$params['oauth_signature'] = self::sign($method, $apiName, $params, $secret);

		$url = 'http://' . (empty($apiOpt['ip']) ? $apiOpt['host'] : $apiOpt['ip']) . '/' . $apiOpt['urlpath'];
		//file_put_contents("/data/release/PHPLIB/api/txt.txt", "vive17: url: ".$url."\n", FILE_APPEND);
		if($method == 'GET'){
			$querystring = array();
			foreach ($params as $k => $v){
				$querystring[] = $k . '=' . rawurlencode($v);
			}
			self::$params = $params;
			self::$url = $url;
			$querystring = implode('&', $querystring);

			$request = NetUtil::cURLHTTPGet($url . '?' . $querystring, 5, $apiOpt['host']);
			if($request === false){
				//file_put_contents("/data/release/PHPLIB/api/txt.txt", "vive17: request1 = ".$request."\n", FILE_APPEND);
				self::setERR(9005, 'NetUtil::cURLHTTPGet ' . $url . ' failed, code: ' . NetUtil::$errCode . ', msg: ' . NetUtil::$errMsg);
				return false;
			}
			//file_put_contents("/data/release/PHPLIB/api/txt.txt", "vive17: request = ".$request."\n", FILE_APPEND);
			return self::response($request);
		} else {
			self::$params = $params;
			self::$url = $url;
			$request = NetUtil::cURLHTTPPost($url, $params, 5, $apiOpt['host']);
			if($request === false){
				self::setERR(9006, 'NetUtil::cURLHTTPPost ' . $url . ' failed, code: ' . NetUtil::$errCode . ', msg: ' . NetUtil::$errMsg);
				return false;
			}
			
			
			return self::response($request);
		}
	}

	public static function get($apiName, $params, $secret = ''){
		return self::request($apiName, $params, $secret, 'GET');
	}

	public static function post($apiName, $params, $secret = ''){
		return self::request($apiName, $params, $secret, 'POST');
	}

	public static function redirect($apiName, $params){
		self::clearERR();
		if(!isset(self::$apiList[$apiName])){
			self::setERR('9001', 'undefined apiName');
			return false;
		}
		//oauth_callback
		//file_put_contents("/data/release/PHPLIB/api/txt.txt", "vive12: ".$params['oauth_callback']."\n", FILE_APPEND);
		$apiOpt = self::$apiList[$apiName];
		$params = self::checkParams($apiName, $params);
		if($params === false) return false;

		$params['oauth_consumer_key'] = TENCENT_APP_ID;
//oauth_authorize
		$url = 'http://' . $apiOpt['host'] . '/' . $apiOpt['urlpath'];
		//file_put_contents("/data/release/PHPLIB/api/txt.txt", "vive4: ".$url." -- ".$apiName.'\n', FILE_APPEND);
		$querystring = array();
		foreach ($params as $k => $v){
			$querystring[] = $k . '=' . rawurlencode($v);
		}
		$querystring = implode('&', $querystring);

		//file_put_contents("/data/release/PHPLIB/api/txt.txt", "vive5: ".$url . '?' . $querystring.'\n', FILE_APPEND);
		ToolUtil::redirect($url . '?' . $querystring);
	}

	public static function response($params){
		self::clearERR();

		$result = array();
		$params = explode("&", rawurldecode($params));
		Logger::info(var_export($params,true));
		foreach ($params as $param){
			$param = explode("=", $param, 2);
			if(count($param) < 2 ) continue;
			$result[$param[0]] = $param[1];
		}

		return $result;
	}
	//oauth_request_token", array()
	private static function checkParams($apiName, $params){
		self::clearERR();

		if(!isset(self::$apiList[$apiName])){
			self::setERR('9001', 'undefined apiName');
			return false;
		}

		$paramsOut = array();
		foreach(self::$apiList[$apiName]['required_fields'] as $pkey){
			if(!isset($params[$pkey])){
				self::setERR('9002', "field missing, $apiName, $pkey");
				return false;
			}
			$paramsOut[$pkey] = $params[$pkey];
		}

		foreach(self::$apiList[$apiName]['other_fields'] as $pkey){
			if(!isset($params[$pkey])) continue;
			$paramsOut[$pkey] = $params[$pkey];
		}

		return $paramsOut;
	}

	private static function sign($method, $apiName, $params, $secret = ''){
		self::clearERR();
		if(!isset(self::$apiList[$apiName])){
			self::setERR('9001', 'undefined apiName');
			return false;
		}

		$apiOpt = self::$apiList[$apiName];
		$requestUri = 'http://' . $apiOpt['host'] . '/' . $apiOpt['urlpath'];

		if(isset($params['oauth_signature'])){
			unset($params['oauth_signature']);
		}

		ksort($params);
		$normalized = array();
		foreach($params as $key => $val){
			$normalized[] = $key."=".$val;
		}

		$normalizedStr = implode("&", $normalized);
		return self::getSignature(
			$method . '&' . // 签名第一部分，HTTP请求方式
			rawurlencode($requestUri) . '&' . // 请求的URI路径
			rawurlencode($normalizedStr), // 参数内容

			TENCENT_APP_KEY . '&' . $secret
		);
	}

	protected static function getSignature($str, $key){
		$signature = "";
		if (function_exists('hash_hmac')){
			$signature = base64_encode(hash_hmac("sha1", $str, $key, true));
		} else {
			$blocksize	= 64;
			$hashfunc	= 'sha1';
			if (strlen($key) > $blocksize){
				$key = pack('H*', $hashfunc($key));
			}
			$key	= str_pad($key,$blocksize,chr(0x00));
			$ipad	= str_repeat(chr(0x36),$blocksize);
			$opad	= str_repeat(chr(0x5c),$blocksize);
			$hmac 	= pack('H*',$hashfunc(($key^$opad).pack('H*',$hashfunc(($key^$ipad).$str))));
			$signature = base64_encode($hmac);
		}
	
		return $signature;
	}
}

// End Of Script