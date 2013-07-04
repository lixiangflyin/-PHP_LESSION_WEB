<?php
/**
 * ISMS.php
 *
 * icson 短信接口
 */

class ISMS
{
	/**
	 * 错误编码
	 */
	public static $errCode = 0;

	/**
	 * 错误消息
	 */
	public static $errMsg  = '';

	/**
	 * 清除错误标识，在每个函数调用前调用
	 */
	private static function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}
	

	//测试单条下行
	//sendSingleSMS("13815842728","我来试试怎么样");

	/**
	 * 单一号码，单一内容下发
	 *
	 *  * @return String
	 */
	public static function sendSingleSMS($cellPhone, $sm) {
		global $_ENV_FLAG ;
		//预定义参数，参数说明见文档
		$spid = "3948";
		$sppassword = "yx0628dz";
		$da = "86". $cellPhone;
		$dc = "8";
		$host="esms4.etonenet.com";
		//发送端口，默认80.
		$port = 80;
		//拼接URI
		$request = "/sms/mt";
		$request .= "?command=MT_REQUEST&spid=" . $spid . "&sppassword=" . $sppassword;
		$request .= "&da=" . $da . "&dc=" . $dc . "&sm=";
		$request.= self::encodeHexStr($dc, $sm, "UTF-8");//下发内容转换HEX编码
		//if ($_ENV_FLAG == 'dev.') {
			$remote_url = "http://" . $host . $request;	
			$ch = curl_init($remote_url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
			curl_setopt($ch, CURLOPT_PROXY, "172.27.28.234");
			curl_setopt($ch, CURLOPT_PROXYPORT, 8080);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$content = curl_exec($ch); 
			curl_close($ch); 
		//}else {
		//	$content = self::doGetRequest($host, $port, $request);//调用发送方法发送
		//}
		strpos($content,'mterrcode=000') ? $respStatus = 0 : $respStatus = 1;
		//echo $respStatus;
		return $respStatus;
	}


	private static function doGetRequest($host, $port, $request) {
		$method="GET";
		return self::httpSend($host, $port, $method, $request);
	}
	
	private static function doPostRequest($host, $port, $request) {
		$method="POST";
		return self::httpSend($host, $port, $method, $request);
	}
	
	/**
	 * 使用http协议发送消息
	 *
	 * @param string $host
	 * @param int $port
	 * @param string $method
	 * @param string $request
	 * @return string
	 */
	private static function httpSend($host,$port,$method,$request) {
		$httpHeader  = $method . " " . $request . " HTTP/1.1\r\n";
		$httpHeader .= "Host: $host\r\n";
		$httpHeader .= "Connection: Close\r\n";
		//	$httpHeader .= "User-Agent: Mozilla/4.0(compatible;MSIE 7.0;Windows NT 5.1)\r\n";
		$httpHeader .= "Content-type: text/plain\r\n";
		$httpHeader .= "Content-length: " . strlen($request) . "\r\n";
		$httpHeader .= "\r\n";
		$httpHeader .= $request;
		$httpHeader .= "\r\n\r\n";
		$fp = @fsockopen($host, $port, $errno, $errstr, 5);
		$result = "";
		if ( $fp ) {
			fwrite($fp, $httpHeader);
			while(! feof($fp)) { //读取get的结果
				$result .= fread($fp, 1024);
			}
			fclose($fp);
		}
		else
		{
			return "连接短信网关超时！";//超时标志
		}
		list($header, $foo)  = explode("\r\n\r\n", $result);
		list($foo, $content) = explode($header, $result);
		$content=str_replace("\r\n", "", $content);
		//返回调用结果
		return $content;
	}
	/**
	 *  decode Hex String
	 *
	 * @param string $dataCoding       charset
	 * @param string $hexStr      convert a hex string to binary string
	 * @return string binary string
	 */
	private static function decodeHexStr($dataCoding, $hexStr)
	{
		$hexLenght = strlen($hexStr);
		// only hex numbers is allowed
		if ($hexLenght % 2 != 0 || preg_match("/[^\da-fA-F]/",$hexStr)) {
			return FALSE;
		}
		unset($binString);
		for ($x = 1; $x <= $hexLenght/2; $x++) {
			$binString .= chr(hexdec(substr($hexStr, 2 * $x - 2, 2)));
		}
	
		return $binString;
	}
	
	/**
	 * encode Hex String
	 *
	 * @param string $dataCoding
	 * @param string $binStr
	 * @param string $encode
	 * @return string hex string
	 */
	private static  function encodeHexStr($dataCoding,$binStr,$encode="UTF-8"){
		//return bin2hex($binStr);
		if ($dataCoding == 15) {//GBK
			return bin2hex(mb_convert_encoding($binStr, "GBK", $encode));
		} elseif (($dataCoding & 0x0C) == 8) {//UCS-2BE
			return bin2hex(mb_convert_encoding($binStr, "UCS-2BE", $encode));
		} else {//ISO8859-1
			return bin2hex(mb_convert_encoding($binStr, "ASCII", $encode));
		}
	}
		
}

