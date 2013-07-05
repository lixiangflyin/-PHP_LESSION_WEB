<?php
class IAlipayAddress extends IAliAPI{
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
	 * 跳转至支付宝登录页面
	 */
	public static function redirect($redirectUrl){
		self::clearERR();

		if(empty($redirectUrl) || !preg_match("/^http:\/\/([^\.]+\.|)51buy\.com/i", $redirectUrl)){
			$redirectUrl = 'http://www.51buy.com/';
		}

		$params = array(
			"service"	=> "user.logistics.address.query",
			"_input_charset"	=> 'UTF-8',
			"return_url"	=> $redirectUrl,
		);
	
		if(!empty($_COOKIE['ali_token'])){
			$params['token'] = $_COOKIE['ali_token'];
		}
		return self::request($params);
	}

	public static function authorize($params){
		self::clearERR();

		$params = self::response($params);
		if($params === false){
			return false;
		}


		if(!empty($params['receive_address'])){
			$addrXML = new SimpleXMLElement($params['receive_address']);
			if($addrXML === false){
				self::setERR(8605, 'SimpleXMLElement failed');
				return false;
			}

			return array(
				'address'	=> mb_convert_encoding((string)$addrXML->address, 'GB2312', 'UTF-8'),
				'address_code'	=> mb_convert_encoding((string)$addrXML->address_code, 'GB2312', 'UTF-8'),
				'area'	=> mb_convert_encoding((string)$addrXML->area, 'GB2312', 'UTF-8'),
				'city'	=> mb_convert_encoding((string)$addrXML->city, 'GB2312', 'UTF-8'),
				'fullname'	=> mb_convert_encoding((string)$addrXML->fullname, 'GB2312', 'UTF-8'),
				'mobile_phone'	=> mb_convert_encoding((string)$addrXML->mobile_phone, 'GB2312', 'UTF-8'),
				'phone'	=> mb_convert_encoding((string)$addrXML->phone, 'GB2312', 'UTF-8'),
				'post'	=> mb_convert_encoding((string)$addrXML->post, 'GB2312', 'UTF-8'),
				'prov'	=> mb_convert_encoding((string)$addrXML->prov, 'GB2312', 'UTF-8'),
			);
		}

		self::setERR(8605, 'not enough data');
		return false;
	}
}

// End Of Script