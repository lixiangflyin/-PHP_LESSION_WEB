<?php
/**
 * @tutorial:
 * һ�����ݵķ��Ͷ��ǻ���POST�ģ�
 * POST����Ѷ�����ݷ������ֶΣ�һ����spid��һ����data��
 * spid �����ŵ�Ψһ��ʶ�������Ŷ��壬���������ŵ��������磺www.51buy.com������ֶ������ġ�
 * data ������Ҫ���͵�XML���ݣ�XML���ݱ��뾭�����ܵģ����ܵķ�ʽ������AES����Կ�������Լ����岢֪ͨQQ���������ܺ������Ҫ����base64_encode���б��롣
 * �������£�base64_encode��AES���ܣ�XML���ݣ�����POST��QQ�������ݣ�data=������ܺ������&spid=www.51buy.com
 */

//119.147.15.49 ����IP; 10.137.131.48 ����IP. 10.96.78.106 �ڲ����Ի�IP
define('QQTUAN_HOST', 'api.tuan.qq.com');//��ʵ HOST
//define('QQTUAN_HOST', 'apidev.tuan.qq.com'); //���� HOST
//define('QQTUAN_HOST', 'act.51buy.com'); //���� HOST

define('QQTUAN_ENCRYPY_CIPHER', MCRYPT_RIJNDAEL_128);
define('QQTUAN_ENCRYPY_MODE', MCRYPT_MODE_ECB);
define('QQTUAN_SPID', 'www.51buy.com');
define('QQTUAN_SPKEY', 'bW9jLnl1YjE1Lnd3'); //hint: substr(base64_encode(strrev(QQTUAN_SPID)), 0, 16);

define('QQTUAN_CONSULT_DETAIL', 'detail'); //��ѯ����
define('QQTUAN_CONSULT_BATCH', 'batch');

define('QQTUAN_EXPRESS_JS_OUTTER', 'try{TUAN.Data.MyordersShowIcsonFlow.callBack({holder});}catch(e){}');

define('QQTUAN_STATUS_WAIT_FOR_EXPRESS', 99); //QQ�ţ�����֧�������ġ���֧����״̬��֮������г�ͻ������Ҫ�޸ġ�
define('QQTUAN_STATUS_SUCCESS', 98); //QQ�ţ���������2���ѷ�����״̬15�죬�Զ����³ɳɹ������״̬���ƣ���ΪQ��Ҳ�Զ���������ɳɹ���
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
	 * POST��QQ�ŵ����ݷ������ֶΣ�һ����spid��һ����data��
	 * spid�����ŵ�Ψһ��ʶ�������Ŷ��壬���������ŵ��������磺www.51buy.com������ֶ������ġ�
	 * data������Ҫ���͵�XML���ݣ�XML���ݱ��뾭�����ܵģ����ܵķ�ʽ������AES����Կ�������Լ����岢֪ͨQQ����;
	 * ���ܺ������Ҫ����base64_encode���б��룬�������£�base64_encode��AES���ܣ�XML���ݣ�����
	 * POST��QQ�������ݣ�data=������ܺ������&spid=www.51buy.com
	 * @param string $url �����ַ
	 * @param string $data ��������
	 * @param int $timeout
	 * @return mixed false ����ʧ��; object ����ɹ������Ӧ {spid, desc, retcode[, others]}
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
	 * ת����"��Դ�ϱ�"�����XML��ʽ. UTF-8��ʽ
	 * @param array $product �ϱ�����
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
	<SupplierClass>��Ʒ�Ź�</SupplierClass>
	<SupplierClass2>{$product['product_type']}</SupplierClass2>
	<Url><![CDATA[{$product['product_url']}]]></Url>
</data>
</groupon>
EOL;

		return mb_convert_encoding($xml, 'UTF-8', 'GBK');
	}

	/**
	 * ת����"��Դ�¼�"�����XML��ʽ. UTF-8��ʽ
	 * @param string $qqgid ��Ʒ���Ź���ID.
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
	 * ת����"�����ϱ�"�����XML��ʽ. UTF-8��ʽ
	 * @param array $order �ϱ�����
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
	 * ת����"����״̬ͬ��"�����XML��ʽ. UTF-8��ʽ
	 * @param array $order �ϱ�����
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
	 * ����xml����: base64_encode( AES($xml) )
	 * @param string $xml
	 * @return string ����
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
	 * ���� (Ҳ����Ҫ����)
	 * @param string $crypt ����
	 * @param string $xml
	 */
	public static function decrypt($crypt) {
		return trim(mcrypt_decrypt(
			QQTUAN_ENCRYPY_CIPHER,
			QQTUAN_SPKEY,
			base64_decode($crypt),
			QQTUAN_ENCRYPY_MODE
		), "\0"); //ECBģʽ���ں��油 "\0"
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
	 * ���ɲ�ѯurl
	 * @param string $type
	 * @return string
	 */
	public static function getRequestUrl($type) {
		//�滻��֮ǰͷ���ĵ�define���
//		$ip_backup = array('10.96.78.106'); //Q�����ϻ���
//		$ip_backup = array('10.137.131.48'); //Q����������IP 10.137.131.48
//		$ip_backup = array('10.130.131.54'); //Q����������IP
//		$ip_backup = array('121.14.96.114'); //Q��Ԥ��������
//		$ip_backup = array('183.60.63.17', '183.60.55.234'); //Q�����ϻ���
		$ip_backup = array('10.137.148.121','10.137.148.38');//Q����������
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