<?php
/**
 * @tutorial:
 * 一切数据的发送都是基于POST的；
 * POST到腾讯的数据分两个字段，一个是spid，一个是data：
 * spid 是外团的唯一标识，由外团定义，建议用外团的域名，如：www.51buy.com，这个字段是明文。
 * data 部分是要发送的XML数据，XML数据必须经过加密的，加密的方式必须是AES，密钥由外团自己定义并通知QQ技术，机密后的数据要经过base64_encode进行编码。
 * 过程如下：base64_encode（AES加密（XML数据）），POST给QQ如下数据：data=上面加密后的数据&spid=www.51buy.com
 */

//119.147.15.49 外网IP; 10.137.131.48 内网IP. 10.96.78.106 内部测试机IP
define('QQTUAN_HOST', 'api.tuan.qq.com');//真实 HOST
//define('QQTUAN_HOST', 'apidev.tuan.qq.com'); //开发 HOST
//define('QQTUAN_HOST', 'act.51buy.com'); //开发 HOST

define('QQTUAN_ENCRYPY_CIPHER', MCRYPT_RIJNDAEL_128);
define('QQTUAN_ENCRYPY_MODE', MCRYPT_MODE_ECB);
define('QQTUAN_SPID', 'www.51buy.com');
define('QQTUAN_SPKEY', 'bW9jLnl1YjE1Lnd3'); //hint: substr(base64_encode(strrev(QQTUAN_SPID)), 0, 16);

define('QQTUAN_CONSULT_DETAIL', 'detail'); //查询类型
define('QQTUAN_CONSULT_BATCH', 'batch');

define('QQTUAN_EXPRESS_JS_OUTTER', 'try{TUAN.Data.MyordersShowIcsonFlow.callBack({holder});}catch(e){}');

define('QQTUAN_STATUS_WAIT_FOR_EXPRESS', 99); //QQ团，线下支付订单的“待支付”状态，之后如果有冲突，则需要修改。
define('QQTUAN_STATUS_SUCCESS', 98); //QQ团，订单保持2（已发货）状态15天，自动更新成成功。这个状态不推，因为Q团也自动将订单变成成功。
define('QQTUAN_RESOURCE_WARNING_QUANTITY', 5);

class IQQTuanAPI {
	public static $errCode = 0;
	public static $errMsg = '';

	private static function setERR($code, $msg) {
		self::$errCode = $code;
		self::$errMsg = $msg;
	}

	private static function clearERR() {
		self::setERR(0, '');
	}

	/**
	 * POST到QQ团的数据分两个字段，一个是spid，一个是data。
	 * spid是外团的唯一标识，有外团定义，建议用外团的域名，如：www.51buy.com，这个字段是明文。
	 * data部分是要发送的XML数据，XML数据必须经过加密的，加密的方式必须是AES，密钥由外团自己定义并通知QQ技术;
	 * 加密后的数据要经过base64_encode进行编码，过程如下：base64_encode（AES加密（XML数据））。
	 * POST给QQ如下数据：data=上面加密后的数据&spid=www.51buy.com
	 * @param string $url 请求地址
	 * @param string $data 请求数据
	 * @param int $timeout
	 * @return mixed false 请求失败; object 请求成功后的相应 {spid, desc, retcode[, others]}
	 */
	public static function request($url, $data, $timeout=15) {
		self::clearERR();

		$data = 'data=' . self::encrypt($data) . '&spid=' . QQTUAN_SPID;
		$response = NetUtil::cURLHTTPPost($url, $data, $timeout, QQTUAN_HOST);
		if (false === $response) {
			self::setERR(NetUtil::$errCode, NetUtil::$errMsg);
			return false;
		}

		$ret = @simplexml_load_string($response);
		if (empty($ret)) {
			self::setERR(501, 'convert to xml FAILED.');
			return false;
		}

		$ret = self::utf2Gbk(self::_objectToArray($ret));
		if ($ret['spid'] != QQTUAN_SPID) {
			self::setERR(501, 'spid is incorrect.');
			return false;
		}
		else if ((!isset($ret['desc'])) || (!isset($ret['retcode']))) {
			self::setERR(502, 'missed desc or retcode.');
			return false;
		}

		return $ret;
	}

	/**
	 * 转换成"资源上报"所需的XML格式. UTF-8格式
	 * @param array $product 上报数据
	 * @return string
	 */
	public static function convertToUploadXML($product) {
		$spid = QQTUAN_SPID;
		$xml = <<<EOL
<?xml version="1.0" encoding="utf-8"?>
<groupon>
<ver>1.0</ver>
<spid>{$spid}</spid>
<data>
	<spgid>{$product['product_id']}</spgid>
	<Title><![CDATA[{$product['product_name']}]]></Title>
	<GrouponImg><![CDATA[{$product['product_image']}]]></GrouponImg>
	<OriginalPrice>{$product['product_ori_price']}</OriginalPrice>
	<PresentPrice>{$product['product_curr_price']}</PresentPrice>
	<BeginTime>{$product['start_sell_time']} 00:00:00</BeginTime>
	<EndTime>{$product['stop_sell_time']} 23:59:59</EndTime>
	<SupplierClass>商品团购</SupplierClass>
	<SupplierClass2>{$product['product_type']}</SupplierClass2>
	<Url><![CDATA[{$product['product_url']}]]></Url>
</data>
</groupon>
EOL;

		return mb_convert_encoding($xml, 'UTF-8', 'GBK');
	}

	/**
	 * 转换成"资源下架"所需的XML格式. UTF-8格式
	 * @param string $qqgid 商品的团购侧ID.
	 * @return string
	 */
	public static function convertToCancelXML($qqgid) {
		$spid = QQTUAN_SPID;
		$xml = <<<EOL
<?xml version="1.0" encoding="utf-8"?>
<groupon>
<ver>1.0</ver>
<spid>{$spid}</spid>
<qqgid>{$qqgid}</qqgid>
</groupon>
EOL;

		return mb_convert_encoding($xml, 'UTF-8', 'GBK');
	}

	/**
	 * 转换成"订单上报"所需的XML格式. UTF-8格式
	 * @param array $order 上报数据
	 * @return string
	 */
	public static function convertToOrderXML(&$order) {
		$spid = QQTUAN_SPID;

		$xml = <<<EOL
<?xml version="1.0" encoding="utf-8"?>
<groupon>
	<ver>1.0</ver>
	<spid>{$spid}</spid>
<data>
	<openid>{$order['openid']}</openid>
	<qqgid>{$order['qqtuan_id']}</qqgid>
	<openkey>{$order['openkey']}</openkey>
	<orderid>{$order['order_id']}</orderid>
	<count>{$order['buy_count']}</count>
	<pay>{$order['order_pay_amount']}</pay>
	<buytime>{$order['order_create_time']}</buytime>
	<goodsproperty></goodsproperty>
	<name>{$order['name']}</name>
	<mobile>{$order['mobile']}</mobile>
	<tel>{$order['tel']}</tel>
	<address>
		<province>{$order['address']['province']}</province>
		<city>{$order['address']['city']}</city>
		<area>{$order['address']['area']}</area>
		<detail>{$order['address']['detail']}</detail>
		<zip>{$order['address']['zip']}</zip>
	</address>
	<sellcount>{$order['sales_count']}</sellcount>
</data>
</groupon>
EOL;

		return mb_convert_encoding($xml, 'UTF-8', 'GBK');
	}

	/**
	 * 转换成"订单状态同步"所需的XML格式. UTF-8格式
	 * @param array $order 上报数据
	 * @return string
	 */
	public static function convertToOrderStatusXML(&$order) {
		$spid = QQTUAN_SPID;

		$xml = <<<EOL
<?xml version="1.0" encoding="utf-8"?>
<groupon>
	<ver>1.0</ver>
	<spid>{$spid}</spid>
	<openid>{$order['openid']}</openid>
	<qqgid>{$order['qqtuan_id']}</qqgid>
	<openkey>{$order['openkey']}</openkey>
	<orderid>{$order['order_id']}</orderid>
	<optype>{$order['order_status']}</optype>
	<logistic>{$order['logistic']}</logistic>
	<logisticno>{$order['logisticno']}</logisticno>
	<logisticurl></logisticurl>
</groupon>
EOL;

		return mb_convert_encoding($xml, 'UTF-8', 'GBK');
	}

	/**
	 * 加密xml数据: base64_encode( AES($xml) )
	 * @param string $xml
	 * @return string 密文
	 */
	public static function encrypt($xml) {
		return base64_encode(mcrypt_encrypt(
			QQTUAN_ENCRYPY_CIPHER,
			QQTUAN_SPKEY,
			$xml,
			QQTUAN_ENCRYPY_MODE
		));
	}

	/**
	 * 解密 (也许需要解密)
	 * @param string $crypt 密文
	 * @param string $xml
	 */
	public static function decrypt($crypt) {
		return trim(mcrypt_decrypt(
			QQTUAN_ENCRYPY_CIPHER,
			QQTUAN_SPKEY,
			base64_decode($crypt),
			QQTUAN_ENCRYPY_MODE
		), "\0"); //ECB模式会在后面补 "\0"
	}

	public static function utf2Gbk($data) {
		if (!is_array($data)) {
			return mb_convert_encoding($data, 'GBK', 'UTF-8');
		}

		$res = array();
		foreach($data as $key => $_val) {
	 		$key = mb_convert_encoding($key, 'GBK', 'UTF-8');

			$res[ $key ] = self::utf2Gbk($_val);
		}

		return $res;
	}

	public static function gbk2Utf($data) {
		if (!is_array($data)) {
			return mb_convert_encoding($data, 'UTF-8', 'GBK');
		}

		$res = array();
		foreach($data as $key => $_val) {
	 		$key = mb_convert_encoding($key, 'UTF-8', 'GBK');

			$res[ $key ] = self::utf2Gbk($_val);
		}

		return $res;
	}

	public static function _objectToArray($d) {
		if (is_object($d)) {
			$d = get_object_vars($d);
		}

		if (is_array($d)) {
			return array_map("IQQTuanAPI::_objectToArray", $d);
		}
		else {
			return $d;
		}
	}

	/**
	 * 生成查询url
	 * @param string $type
	 * @return string
	 */
	public static function getRequestUrl($type) {
		//替换了之前头部的的define语句
//		$ip_backup = array('10.96.78.106'); //Q团线上环境
//		$ip_backup = array('10.137.131.48'); //Q团内网开发IP 10.137.131.48
//		$ip_backup = array('10.130.131.54'); //Q团内网测试IP
//		$ip_backup = array('121.14.96.114'); //Q团预发布环境
//		$ip_backup = array('183.60.63.17', '183.60.55.234'); //Q团线上环境
		$ip_backup = array('10.137.148.121','10.137.148.38');//Q团内网环境
		$ip = $ip_backup[ array_rand($ip_backup) ];
		$api = '';
		switch($type) {
			case 'QQTUAN_URL_UPLOAD_B2C' :
				$api = 'uploadb2c';
				break;

			case 'QQTUAN_URL_ORDER_B2C' :
				$api = 'orderb2c';
				break;

			case 'QQTUAN_URL_UPDATE_ORDER_B2C' :
				$api = 'updateorderb2c';
				break;

			case 'QQTUAN_URL_CANCEL' :
				$api = 'cancel';
				break;

			case 'QQTUAN_URL_SYNSALES' :
				$api = 'sellcount';
				break;

			default:
				self::setERR('500', 'unknown request type');
				return false; //
		}

		return "http://{$ip}/api/v2/{$api}";
	}
}

// End Of Script