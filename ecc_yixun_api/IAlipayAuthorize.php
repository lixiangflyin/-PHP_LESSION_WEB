<?php
class IAlipayAuthorize extends IAliAPI{
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
	 * Ìø×ªÖÁÖ§¸¶±¦µÇÂ¼Ò³Ãæ
	 */
	public static function redirect($redirectUrl){
		self::clearERR();

		if(empty($redirectUrl) || !preg_match("/^http:\/\/([^\.]+\.|)51buy\.com/i", $redirectUrl)){
			$redirectUrl = '';
		}

		if(!empty($redirectUrl)){
			$redirectUrl = str_replace("&", "[_]", $redirectUrl);
		}
		$url = rawurldecode($redirectUrl);
		$params = array(
			"service"	=> "alipay.auth.authorize",
			"return_url"	=> "http://base.51buy.com/index.php?mod=user&act=alipaylogin" . (empty($redirectUrl) ? '' : ('&url=' . $url)),
			"target_service"	=> "user.auth.quick.login",
			//"exter_invoke_ip"	=> "",
			//"anti_phishing_key"	=> ""
		);
		if(mb_detect_encoding($url, array("ASCII","UTF-8","GB2312","GBK")) == "UTF-8"){
			$params['_input_charset'] = "UTF-8";
		}
		
		return self::request($params);
	}
	
	public static function authorize($params){
		self::clearERR();

		$params = self::response($params);
		if ($params === false) {
			self::setERR(parent::$errCode, parent::$errMsg);
			return false;
		}

		if(!empty($params['token'])){
			setrawcookie("ali_token", $params['token'], 0, '/', '.51buy.com', false, true);
		}
		return array(
			"user_id"	=> empty($params['user_id']) ? '' : $params['user_id'],
			"real_name"	=> empty($params['real_name']) ? '' : $params['real_name'],
			"token"		=> empty($params['token']) ? '' : $params['token'],
			"user_grade_type"	=> !isset($params['user_grade_type']) ? false : $params['user_grade_type'],
		);
	}
}

// End Of Script