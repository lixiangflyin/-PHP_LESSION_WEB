<?php
class IAlipayWapAuthorize extends IAliWapAPI{
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
	 * WAPÌø×ªÖÁÖ§¸¶±¦µÇÂ¼Ò³Ãæ
	 */
	public static function redirect($redirectUrl){
		self::clearERR();

		if(empty($redirectUrl) || !preg_match("/^http:\/\/([^\.]+\.|)51buy\.com/i", $redirectUrl)){
			$redirectUrl = '';
		}

		if(!empty($redirectUrl)){
			$redirectUrl = str_replace("&", "[_]", $redirectUrl);
		}
		$params = array(
			"service"	=> "wap.user.common.login",
			"login_service" => "user_anth",
			"return_url"	=> "http://m.51buy.com/index.php?mod=wlogin&act=alipaylogin" . (empty($redirectUrl) ? '' : ('&url=' . rawurldecode($redirectUrl))),
			"target_service"	=> "user.auth.quick.login",
			//"exter_invoke_ip"	=> "",
			//"anti_phishing_key"	=> ""
		);

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