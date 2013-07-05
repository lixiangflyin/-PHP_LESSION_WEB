<?php
define("TENCENT_APP_ID", '215585');
define("TENCENT_APP_KEY", 'cbedab258c4b3e9d93e034796b741d56');

class IQQConnect
{

	public static $errCode = 0;
	public static $errMsg = '';

	static $params = array();
	static $url = '';

	static $sid = '';
	
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

	protected static function setERR($code, $msg)
	{
		self::$errCode = $code;
		self::$errMsg = $msg;
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

	protected static function clearERR()
	{
		self::setERR(0, '');
	}

	static function debug($tag, $info)
	{
		return true;
		file_put_contents('/data/log/qqconnect/'.self::$sid.'.log', "[".date('Y-m-d H:i:s')."]\t".self::$errCode."\t".self::$errMsg."\t{$tag}\n{$info}\n", FILE_APPEND);
	}

	public static function getRequestToken()
	{
		$requestTokenArr = self::get("oauth_request_token", array(), "");
		if($requestTokenArr === false) return false;

		//add by benxi
		if(empty($requestTokenArr['oauth_token_secret']))
		{
			self::debug('RequestToken', var_export($requestTokenArr, true));
			return false;
		}
		self::debug('RequestToken', var_export($requestTokenArr, true));
		CMemFactory::singleton('cate_hot_top5')->set('osecret_'.self::$sid, $requestTokenArr['oauth_token_secret']);
		return $requestTokenArr;
	}

	static function getLoginURL($params)
	{
		$apiName = 'oauth_authorize';
		$apiOpt = self::$apiList[$apiName];
		$params = self::checkParams($apiName, $params);
		if($params === false) return false;

		$params['oauth_consumer_key'] = TENCENT_APP_ID;
		//oauth_authorize
		$url = 'http://' . $apiOpt['host'] . '/' . $apiOpt['urlpath'];
		$querystring = array();
		foreach ($params as $k => $v)
		{
			$querystring[] = $k . '=' . rawurlencode($v);
		}
		$querystring = implode('&', $querystring);
		return $url.'?'.$querystring;
	}

	public static function getAccessToken($unAuthorizedToken, $verifyCode)
	{
		$oauth_secret = CMemFactory::singleton('cate_hot_top5')->get('osecret_'.self::$sid);
		if(empty($oauth_secret[0]))
		{
			self::setERR(9103, 'oauth_token_secret not found');
			self::debug('getAccessToken', 'oauth_token_secret not found'.var_export($_SESSION));
			return false;
		}
		
		$oauth_secret = $oauth_secret[0];
		
		$params = array(
				'oauth_token'	=> $unAuthorizedToken,
				'oauth_vericode'	=> $verifyCode
		);

		self::debug('oauth_access_token[start]', var_export($params, true));
		self::debug('oauth_access_token[secret]', $oauth_secret);

		$accessTokenArr = self::get("oauth_access_token", $params , $oauth_secret);

		if(empty($accessTokenArr['openid']) || empty($accessTokenArr['oauth_timestamp']))
		{
			self::setERR(9102, "openid or oauth_timestamp is missing.Code={$accessTokenArr['code']}|Msg={$accessTokenArr['msg']}|Url=".self::$url."|Params=".var_export(self::$params, true));
			self::debug('oauth_access_token[secret]', var_export($params, true).var_export($accessTokenArr, true).'|secret'.$oauth_secret);
			return false;
		}

		$calcuSign = self::getSignature($accessTokenArr['openid'] . $accessTokenArr['oauth_timestamp'], TENCENT_APP_KEY);
		if($calcuSign != $accessTokenArr['oauth_signature'])
		{
			self::debug('oauth_access_token[sign]', var_export($accessTokenArr, true) . $calcuSign);
			self::setERR(9102, 'oauth_signature is wrong, ' . var_export($accessTokenArr, true) . $calcuSign);
			return false;
		}
		//$_SESSION['_wlogin_oauth_token'] = $accessTokenArr['oauth_token'];
		//$_SESSION['_wlogin_oauth_token_secret'] = $accessTokenArr['oauth_token_secret'];
		return $accessTokenArr;
	}

	private static function request($apiName, $params, $secret = '', $method = 'GET' )
	{
		$apiOpt = self::$apiList[$apiName];
		$params = self::checkParams($apiName, $params);
		if($params === false) return false;
		$params['oauth_consumer_key'] = TENCENT_APP_ID;
		$params['oauth_version'] = '1.0';
		$params['oauth_timestamp'] = time();
		$params['oauth_nonce'] = mt_rand();
		$params['oauth_signature_method'] = 'HMAC-SHA1';

		$params['oauth_signature'] = self::sign($method, $apiName, $params, $secret);

		$url = 'http://' . (empty($apiOpt['ip']) ? $apiOpt['host'] : $apiOpt['ip']) . '/' . $apiOpt['urlpath'];
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
				self::setERR(9005, 'NetUtil::cURLHTTPGet ' . $url . ' failed, code: ' . NetUtil::$errCode . ', msg: ' . NetUtil::$errMsg);
				return false;
			}
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

	public static function get($apiName, $params, $secret = '')
	{
		return self::request($apiName, $params, $secret, 'GET');
	}

	public static function post($apiName, $params, $secret = '')
	{
		return self::request($apiName, $params, $secret, 'POST');
	}

	public static function response($params)
	{
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