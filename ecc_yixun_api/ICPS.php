<?php
require_once(PHPLIB_ROOT . 'api/inc/IQQTuanAPI.php');

require_once(PHPLIB_ROOT . 'inc/CPSConfig.inc.php');
require_once(PHPLIB_ROOT . 'inc/paytype.inc.php'); //֧������
require_once(PHPLIB_ROOT . 'inc/paytypevia.inc.php'); //QQCB ֧������ת��


/**
 * CPS ������
 * @tutorial
 * 		�洢������DB�Ĳ��֣���д����Щ���ࡣ֮ǰ���뷨�Ƕ����ֿ�������֮������޸ġ�
 * 		�мǣ����á��޸� saveCPSOrderToDB һ��Ҫ������ĵ������˽����еĽṹ��
 *
 * error code ���壺
 * 400 ����������
 * 401 ��Ӧ�����ݱ�����
 * 402 cookie ����
 * 403 ����У��ʧ��
 * 404 δ�ҵ�����
 * 501 д�����
 * 502 �������
 */
class ICPS {
	public static $errCode = 0;
	public static $errMsg = '';
	public static $whId = 0;

	public static function init() {
		if (empty(self::$whId)) {
			self::$whId = IUser::getSiteId(); //���ó���ID
		}
	}

	private static function setERR($code, $msg='') {
		self::$errCode = $code;
		self::$errMsg = $msg;
	}

	private static function clearERR() {
		self::setERR(0);
	}

	public static function debug() {
		$params = func_get_args();
		echo '<pre style="color:blue;text-align:left">';
		foreach ($params as $idx=>$param) {
			echo "\n$idx\n";
			print_r($param);
		}
		echo '</pre>';
	}

	/**
	 * ����ID��ָ��ERP��
	 * @param int $whId
	 */
	public static function setWhId($whId) {
		self::$whId = $whId;
	}

	/**
	 * �������õ� CPSConfig::$providerList ��֤��ز�����������
	 * @param array $params GET/POST����,Ҳ���зǱ���ļ�ֵ��
	 * @param string $srouce ָ��CPS�ṩ��
	 * @return boolean �Ƿ�ͨ����֤
	 */
	public static function validateRedirectParam(&$params, $source) {
		self::clearERR();

		if (count(array_diff(CPSConfig::$providerList[$source]['field'], array_keys($params))) != 0) { //������֤
			self::setERR(400, basename(__FILE__, '.php') . '|' . __LINE__ . " invalid parameter." . var_export(CPSConfig::$providerList[$source]['field'], true).var_export(array_keys($params), true));
			return false;
		}

		if ($source == CPSConfig::$providerQQCB) {
			return self::validateRedirectParamForQQCB($params);
		}
		else if ($source == CPSConfig::$providerQQTuan) {
			return self::validateRedirectParamForQQTuan($params);
		}
		else if ($source == CPSConfig::$providerQQfanli) {
			return self::validateRedirectParamForQQfanli($params);
		}
		else if ($source == CPSConfig::$provider163Youdao) {// add by wheelswang
			return self::validateRedirectParamFor163Youdao($params);
		}
		else {
			if ($source == CPSConfig::$providerYiqifa
				&& (! in_array($params['src'], CPSConfig::$providerList[CPSConfig::$providerYiqifa]['valid_src']))
				&& (! in_array($params['cid'], CPSConfig::$providerList[CPSConfig::$providerYiqifa]['valid_cid'])) ) { //���� src cid �ϸ�ƥ��

				self::setERR(400, basename(__FILE__, '.php') . '|' . __LINE__ . " invalid src or cid.");
				return false;
			}

			if  ($source != CPSConfig::$provider51fanli) { //51fanli �����ǿ���֤
				foreach ($params as $k => &$v) {
					$v = trim($v);
					if ($v == '') {
						self::setERR(400, basename(__FILE__, '.php') . '|' . __LINE__ . " {$k} isnot exists");
						return false;
					}
				}
			}
		}

		return true;
	}

	/**
	 * �������õ� CPSConfig::$providerList �� consult_fields �ֶ���֤��ز�����������
	 * @param array $params GET/POST����,Ҳ���зǱ���ļ�ֵ��
	 * @param string $srouce ָ��CPS�ṩ��
	 * @tutorial
Q�ŵ����������ʽ��
1. batch ģʽ
<?xml version="1.0" encoding="utf-8"?>
<groupon>
	<ver>1.0</ver>
	<spid>www.qq.com</spid>
	<qqgid>123456</qqgid>
	<date>2011-10-11</date><!--����-->
</groupon>
2. detail ģʽ
<?xml version="1.0" encoding="utf-8"?>
<groupon>
	<ver>1.0</ver>
	<spid>www.qq.com</spid>
	<qqgid>123456</qqgid>
	<orderid>abcdefg</orderid>
</groupon>
	 * @return boolean �Ƿ�ͨ����֤
	 */
	public static function validateConsultParam(&$params, $source) {
		self::clearERR();

		//������ù��� consult_fields ����ֵ����Ϊ��
		if (isset(CPSConfig::$providerList[$source]['consult_fields']) && (!empty(CPSConfig::$providerList[$source]['consult_fields']))) {
			foreach(CPSConfig::$providerList[$source]['consult_fields'] as $key) {
				if (! array_key_exists($key, $params)) {
					self::setERR(400, basename(__FILE__, '.php') . '|' . __LINE__ . " {$key} isnot exists");
					return false;
				}

				$params[$key] = trim($params[$key]);
				if ($params[$key] == '') {
					self::setERR(400, basename(__FILE__, '.php') . '|' . __LINE__ . " {$key} isnot exists");
					return false;
				}
			}
		}

		switch ($source) {
			case CPSConfig::$providerQQTuan:
				if ($params['spid'] != 'www.qq.com') {
					self::setERR(403, basename(__FILE__, '.php') . '|' . __LINE__ . ' spid error');
					return false;
				}
				if (! in_array($params['type'], array(QQTUAN_CONSULT_DETAIL, QQTUAN_CONSULT_BATCH))) {
					self::setERR(403, basename(__FILE__, '.php') . '|' . __LINE__ . ' consult type error');
					return false;
				}
				break;

			case CPSConfig::$providerQQCB: //QQ�ʱ�������
				break;

			case CPSConfig::$providerLinktech:
				if (! preg_match('/^2\d{3}[01]\d[0-3]\d$/', $params['yyyymmdd'])) { //���ڸ�ʽ���ĵ���ͬ
					self::setERR(403, basename(__FILE__, '.php') . '|' . __LINE__ . ' ����У��ʧ��');
					return false;
				}
				break;

			case CPSConfig::$providerYiqifa:
				if (! preg_match('/^2\d{3}[01]\d[0-3]\d$/', $params['d'])) { //���ڸ�ʽ���ĵ���ͬ
					self::setERR(403, basename(__FILE__, '.php') . '|' . __LINE__ . ' ����У��ʧ��');
					return false;
				}
				break;

			case CPSConfig::$providerChanet:
				if ( (isset($params['orderid']) && (! is_numeric($params['orderid']))) //����ID��������
					 || (isset($params['start']) && (! preg_match('/^2\d{3}[01]\d[0-3]\d$/', $params['start']))) //start ���ڸ�ʽ���ĵ���ͬ
					 || (isset($params['end']) && (! preg_match('/^2\d{3}[01]\d[0-3]\d$/', $params['end']))) ) { //end ���ڸ�ʽ���ĵ���ͬ

					self::setERR(403, basename(__FILE__, '.php') . '|' . __LINE__ . ' ����У��ʧ��');
					return false;
				}

				if ($params['sig'] != self::getSigForChanet($params)) { //�ɹ�sigУ��
					self::setERR(403, basename(__FILE__, '.php') . '|' . __LINE__ . ' �ɹ��� sig У��ʧ��');
					return false;
				}
				break;

			case CPSConfig::$providerWeiyi:
				if ( $params['unionid'] != CPSConfig::$providerList[CPSConfig::$providerWeiyi]['unionid'] //unionid �����ò�ƥ��
					 || $params['pwd'] != CPSConfig::$providerList[CPSConfig::$providerWeiyi]['pwd'] //pwd �����ò�ƥ��
					 || (! preg_match('/^2\d{3}-[01]\d-[0-3]\d$/', $params['starttime'])) //starttime ���ڸ�ʽ���ĵ���ͬ yyyy-MM-dd
					 || (! preg_match('/^2\d{3}-[01]\d-[0-3]\d$/', $params['endtime'])) ) { //endtime ���ڸ�ʽ���ĵ���ͬ yyyy-MM-dd

					self::setERR(403, basename(__FILE__, '.php') . '|' . __LINE__ . ' ����У��ʧ��');
					return false;
				}
				break;

			case CPSConfig::$provider51bigou:
				if ( (! preg_match('/^2\d{3}[01]\d[0-3]\d[0-2]\d[0-6]\d[0-6]\d$/', $params['starttime'])) //starttime ���ڸ�ʽ���ĵ���ͬ yyyyMMddHHmmss
					 || (! preg_match('/^2\d{3}[01]\d[0-3]\d[0-2]\d[0-6]\d[0-6]\d$/', $params['endtime'])) ) { //endtime ���ڸ�ʽ���ĵ���ͬ yyyyMMddHHmmss

					self::setERR(403, basename(__FILE__, '.php') . '|' . __LINE__ . ' ����У��ʧ��');
					return false;
				}
				break;
			case CPSConfig::$provider163Youdao://add by wheelswang
				$provider = CPSConfig::$providerList[$source];
				$verify_code = md5($provider['unionid'].$params['sd'].$params['ed'].$provider['publicKey']);
				if ( $verify_code != $params['verifycode']
					 ||$provider['unionid'] != $params['unionid']
					 ||(! preg_match('/^2\d{3}[01]\d[0-3]\d$/', $params['sd'])) //sd  yyyyMMdd
					 || (! preg_match('/^2\d{3}[01]\d[0-3]\d$/', $params['ed'])) ) { //ed  yyyyMMdd
					 
					self::setERR(403, basename(__FILE__, '.php') . '|' . __LINE__ . ' ����У��ʧ��');
					return false;
				}
				break;
			case CPSConfig::$providerCommon:
				return false; //NOTE stop here
		}

		return true;
	}

	/**
	 * QQ�ʱ��Ĳ�����֤���ȶ�vkey��
	 * @param array $params
	 * @return boolean ��֤���: true ͨ�� / false ��ͨ��
	 */
	private static function validateRedirectParamForQQCB(&$params) {
		if (strlen($params['acct']) != 32) {
			self::setERR(403, basename(__FILE__, '.php') . '|' . __LINE__ . ', qqcb acct is invalid');
			return false;
		}

		unset($params[CPSConfig::$providerIndicator]);
		$vkey = urldecode($params['vkey']);
		unset($params['vkey']);

		$calVkey = self::getLoginVKeyForQQCB($params);
		if ($calVkey != $vkey) {
			self::setERR(403, basename(__FILE__, '.php') . '|' . __LINE__ . ', qqcb vkey is invalid');
			return false;
		}

		return true;
	}

	/**
	 * QQͼ�����ϵ�¼������֤.
	 * @param array $params URL�д��ݵĲ���
	 * @return bool true ͨ��, false δͨ��
	 */
	private static function validateRedirectParamForQQTuan(&$params) {
		if (strlen($params['openid']) != 32) {
			self::setERR(403, basename(__FILE__, '.php') . '|' . __LINE__ . ', qqtuan openid is invalid');
			return false;
		}

		$vkey = urldecode($params['vkey']);
		$calVkey = md5("{$params['openid']}{$params['qqtuanid']}" . QQTUAN_SPKEY);
		if ($calVkey != $vkey) {
			self::setERR(403, basename(__FILE__, '.php') . '|' . __LINE__ . ', qqtuan vkey is invalid');
			return false;
		}

		return true;
	}

	/**
	 * QQ�����Ĳ�����֤���ȶ�vkey��
	 * @param array $params
	 * @return boolean ��֤���: true ͨ�� / false ��ͨ��
	 */
	private static function validateRedirectParamForQQfanli(&$params) {
		if (strlen($params['acct']) != 32) return false;

		$params['attach'] = isset($params['attach']) ? $params['attach'] : ''; //Ĭ��ֵ
		$calVkey = self::getLoginVKeyForQQfanli(array(
			$params['acct'],
			$params['attach'],
			$params['clubinfo'],
			$params['ts'],
			$params['url'],
			$params['viewinfo'],
		));

		if ($calVkey != $params['vkey']) {
			self::setERR(403, basename(__FILE__, '.php') . '|' . __LINE__ . ', qqfanli vkey is invalid');
			return false;
		}
		return true;
	}
	/**
	 * �����е�������֤
	 * @param array $params
	 * @return boolean ��֤���: true ͨ�� / false ��ͨ��
	 * add by wheelswang
	 */
	private static function validateRedirectParamFor163Youdao(&$params) {
		if($params['unionid'] != CPSConfig::$providerList['163youdao']['unionid']) {
			
			self::setERR(403, basename(__FILE__, '.php') . '|' . __LINE__ . ', 163youdao redirect param is invalid');
			return false;
		}
		return true;
	}
	/**
	 * ��cps�������cookie�ַ�����cookie�и�ֵ��˳����Դ���ĵ�
	 * @param array $params cps����
	 * @return string �洢�ڿͻ��� Cookie���� CPSConfig::$cookieName Ϊ��ֵ
	 */
	private static function packCookie($params, $source) {
		$cookies = array($source); //��һ����cps�ṩ��

		switch ($source) {
			case CPSConfig::$providerQQCB:
				$cookies[] = $params['openid']; //��ʱ��cookie��
				$cookies[] = $params['loginfrom'];
				$cookies[] = $params['attach']; //���cb: Attach/LoginFrom��cookie, OpenId ��db.
				break;

			case CPSConfig::$providerLinktech:
				$cookies[] = $params[0]; //��������CPS�ṩ�̲�ͬ������ص�cookie����ƴװ���˴������洢
				break;

			case CPSConfig::$providerYiqifa:
				$cookies[] = $params['src']; //���ֵ�ɹ����ָ���������ж�������������������
				$cookies[] = $params['cid']; //�����������ƽ̨���ƹ���ж����ʶ���˲������������ֲ�ͬ���ƹ㷽ʽ���˲�����Ҫ�ش�������
				$cookies[] = $params['wi']; //�˲�����ֵ����base64���룬���������ת�룬��ԭ���ش������𷢣���Ϊ���𷢽��������
				break;

			case CPSConfig::$providerChanet:
				$cookies[] = $params['click_id']; //�ɹ���Ψһ��ʶ
				break;

			case CPSConfig::$providerWeiyi:
				$cookies[] = $params['cid']; //Ψһ�����µĶ������˻�ԱID�Լ������Ϣ
				break;

			case CPSConfig::$provider51bigou:
				$cookies[] = $params['u_id']; //51�ȹ����ϵĻ�Ա��ʶID
				break;

			case CPSConfig::$provider51fanli:
				$cookies[] = $params['u_id']; //51�����в��� u_id
				$cookies[] = $params['tracking_code']; //51�����в��� tracking_code
				break;
			case CPSConfig::$provider163Youdao: // add by wheelswang
				$cookies[] = $params['unionid'];
				$cookies[] = $params['userid'];
				break;
			case CPSConfig::$providerCommon:
				$cookies[] = $params['aid'];
				$cookies[] = $params['bid'];
				$cookies[] = $params['cid'];
				break;
		}

		$cookies[] = time(); //cps ʱ���
		return implode(CPSConfig::$cookieSeparator, $cookies);
	}

	/**
	 * ��cookie�ַ���������cps����
	 * @param string $cookie Cookie�� CPSConfig::$cookieName ��Ӧ���ַ���
	 * @return array CPS�����Ϣ; false CPS cookie ��Ϣ����
	 * ���صľ���ṹ
	 * cps_source => array(
	 * ������Ϣ�����в�ͬ
	 * );
	 */
	private static function unpackCookie($cookie) {
		self::clearERR();
		$cpsCookie = explode(CPSConfig::$cookieSeparator, $cookie);

		$source = array_shift($cpsCookie); //��һ����cps �ṩ��

		if (array_key_exists($source, CPSConfig::$providerList)) {
			switch ($source) {
				case CPSConfig::$providerQQCB: //�ʱ�
					return (count($cpsCookie) == 4)
						? array($source => array_combine(array('open_id', 'login_from', 'attach', 'cookie_time'), $cpsCookie))
						: false;

				case CPSConfig::$providerLinktech: //�����
					return (count($cpsCookie) == 2 && strlen($cpsCookie[0]) > 0)
						? array ($source => array_combine(array('cookie', 'cookie_time'), $cpsCookie))
						: false; //��������CPS�ṩ�̲�ͬ

				case CPSConfig::$providerYiqifa: //����
					return (count($cpsCookie) == 4)
						? array($source => array_combine(array('src', 'cid', 'wi', 'cookie_time'), $cpsCookie))
						: false;

				case CPSConfig::$providerChanet: //�ɹ���
					return (count($cpsCookie) == 2 && strlen($cpsCookie[0]) > 0)
						? array($source => array_combine(array('click_id', 'cookie_time'), $cpsCookie))
						: false;

				case CPSConfig::$providerWeiyi: //Ψһ
					return (count($cpsCookie) == 2 && strlen($cpsCookie[0]) > 0)
						? array($source => array_combine(array('cid', 'cookie_time'), $cpsCookie))
						: false;

				case CPSConfig::$provider51bigou: //51 �ȹ�
					return (count($cpsCookie) == 2 && strlen($cpsCookie[0]) > 0)
						? array($source => array_combine(array('u_id', 'cookie_time'), $cpsCookie))
						: false;

				case CPSConfig::$provider51fanli: //51 ����
					return (count($cpsCookie) == 3)
						? array($source => array_combine(array('u_id', 'tracking_code', 'cookie_time'), $cpsCookie))
						: false;
				case CPSConfig::$provider163Youdao: //�����е� add by wheelswang
					return (count($cpsCookie) == 3)
						? array($source => array_combine(array('unionid', 'userid', 'cookie_time'), $cpsCookie))
						: false;
				case CPSConfig::$providerCommon: //ͨ�ã��̳��Ծɵ�ϵͳ
					return (count($cpsCookie) == 4)
						? array($source => array_combine(array('cid', 'wid', 'fbt', 'cookie_time'), $cpsCookie))
						: false;

				default:
					self::setERR(401, 'unsupport cps provider');
					return false;
			}
		}
		else {
			self::setERR(402, 'unsupport cps provider');
		}

		return false;
	}

	/**
	 * ����QQCB post���ַ�������ȡ������ViewInfo�ֶΡ�
	 * @param string $viewinfo QQCB post �ص� viewinfo �ֶ�
	 * @return array
	 */
	private static function getViewInfoForQQCB($viewinfo) {
		$ret = array();
		parse_str($viewinfo, $ret);
		$ret = array_change_key_case($ret, CASE_LOWER);

		$ret['showmsg'] = isset($ret['showmsg']) ? ToolUtil::escape($ret['showmsg']) : '';
		$ret['nickname'] = isset($ret['nickname']) ? ToolUtil::escape($ret['nickname']) : '';
		$ret['openkey'] = isset($ret['openkey']) ? ToolUtil::escape($ret['openkey']) : '';

		//���¼�����ʱ�ò���
//		$ret['nickname'] = isset($ret['nickname']) ? ToolUtil::escape($ret['nickname']) : '';
//		$ret['cbpoints'] = isset($ret['cbpoints']) ? ToolUtil::escape($ret['cbpoints']) : '';
//		$ret['cbbonus'] = isset($ret['cbbonus']) ? ToolUtil::escape($ret['cbbonus']) : '';
//		$ret['headshow'] = isset($ret['headshow']) ? ToolUtil::escape($ret['headshow']) : '';
//		$ret['jifenurl'] = isset($ret['jifenurl']) ? ToolUtil::escape($ret['jifenurl']) : '';

		return $ret;
	}

	/**
	 * ��ȡcookie�б����cps��Ϣ
	 */
	public static function getCPSInfoFromCookie() {
		return isset($_COOKIE[CPSConfig::$cookieName]) ? self::unpackCookie($_COOKIE[CPSConfig::$cookieName]) : false;
	}

	/**
	 * ��string�л�ȡ�����cps��Ϣ, ������ cpsinfo �ֶ�
	 */
	public static function getCPSInfoFromString($str) {
		return self::unpackCookie($str);
	}

	/**
	 * ɾ��cookie�е�CPS ��ǡ�
	 */
	public static function clearCPSInfo() {
		if (isset($_COOKIE[CPSConfig::$cookieName])) { //����У�ɾ��CPS���
			unset($_COOKIE[CPSConfig::$cookieName]);
			setrawcookie(CPSConfig::$cookieName, '', -1, '/', '.51buy.com');
		}
	}

	/**
	 * ����CPS��Ϣ��cookie�У�ÿ���ṩ����Ҫ������ֶβ�ͬ��
	 * @param array $params GET/POST�ļ�ֵ��
	 * @param string $source CPS�ṩ��
	 * @return NULL
	 */
	public static function saveCPSInfoToCookie(&$params, $source, $uid=null) {
		$cookieStr = self::packCookie($params, $source);

		//RD ʱ������ã������cookie��ϢΪ�����ύ����
		setrawcookie(CPSConfig::$cookieName, $cookieStr, time()+CPSConfig::$providerList[$source]['rd'], '/', CPSConfig::$merchantName);

		if ($uid != null) { //�ʱ���Ҫ��ʾ�����ShowMsg
			if ($source == CPSConfig::$providerQQCB) {
				$msgAry = (isset($params['viewinfo']) && strlen($params['viewinfo']) != 0) ? self::getViewInfoForQQCB($params['viewinfo']) : array();

				if (isset($msgAry['showmsg']) && (!empty($msgAry['showmsg']))) { //����QQCB POST �Ĳ�����decode�������Ϣ
					$ret1 = setrawcookie(CPSConfig::$cookieNameSource, CPSConfig::$providerQQCB, 0, '/', CPSConfig::$merchantName); //�Ự����Ч
					$ret2 = setrawcookie(CPSConfig::$cookieNameMsg, "{$uid}|{$msgAry['showmsg']}", 0, '/', CPSConfig::$merchantName); //showmsg ����ҳͷ����ʾ
					$ret3 = setrawcookie(CPSConfig::$cookieNameOpenKey, $msgAry['openkey'], 0, '/', CPSConfig::$merchantName); //openkey ������ȥ�ʱ���ַ
				}
			}
			else if ($source == CPSConfig::$provider51fanli && strlen($params['show_name']) != 0) {
				$show_name = ToolUtil::escape($params['show_name']);
				setrawcookie(CPSConfig::$cookieNameMsg, "{$uid}|{$show_name}", 0, '/', CPSConfig::$merchantName); //�Ự����Ч
			}
		}
	}

	/**
	 * ���һ����¼
	 * @param string $source CPS�ṩ��
	 * @param int $orderId ����ID (DB ��, order_id ������ UNIQUE INDEX )
	 * @return mixed ����һ��CPS������¼ / ʧ��
	 */
	public static function getOneCPSOrder($source, $orderId) {
		self::clearERR();

		if (! array_key_exists($source, CPSConfig::$providerList)) {
			self::setERR(400, 'unknown cps provider');
			return false;
		}
		else if (! is_numeric($orderId) || intval($orderId) <= 0) {
			self::setERR(400, 'order_id error');
			return false;
		}

		$table = CPSConfig::getCorrespondingTable($source);
		$cpsOrder = ICPSDao::getRows($table, '*', "`order_id` = '{$orderId}'");
		if (false === $cpsOrder) {
			self::setERR(ICPSDao::$errCode, ICPSDao::$errMsg);
		}
		else if (count($cpsOrder)==1) {
			$cpsOrder = $cpsOrder[0];
			if (isset($cpsOrder['ip'])) {
				$cpsOrder['ip'] = long2ip($cpsOrder['ip']); // IP �����������ʽ
			}
		}

		return $cpsOrder;
	}

	/**
	 * ����CPS����
	 * TODO ��Ҫ�Ż����Ѿ�����ӷ����
	 * @param array $submitOrder IOrder::checkShippingCart ����ֵ
	 * @param int $whId ��վID
	 * @return mixed ����CPS���������ݿ�Ľ����
	 * @tutorial $submitOrder �ĸ�ʽ:
	 * Array (
	 *     'errCode' => 0,
	 *     'uid' => '30558397',
	 *     'orderId' => '1030076825',
	 *     'orderAmt' => 222700,
	 *     'payType' => '4',
	 *     'payTypeIsOnline' => 0,
	 *     'payTypeName' => '�ʾֻ��',
	 *     'orderTotalAmt' => 222700,
	 *     'payGoodsAmt' => 222700,
	 *     'orderCreateTime' => 1323870377,
	 *     'isParentOrder' => false,
	 *     'isVATInvoice' => ($newOrder['invoiceType'] == INVOICE_TYPE_VAT) ? true : false, //�Ƿ�Ϊ��ֵ˰��Ʊ
	 *     'isParentOrder' => boolean, //�Ƿ��
	 *     'subOrderIdStr' => $orderstrforlog, //�ӵ�ID�ַ���, ���ŷָ�
	 *     'subOrders' =>
	 *       array (
	 *         1 =>
	 *         array (
	 *           'product_ids' =>
	 *           array (
	 *             0 => '201366',
	 *             1 => '201377',
	 *           ),
	 *           'totalWeight' => 75000,
	 *           'flag' => 0,
	 *           'orderPrice' => 289900,
	 *           'orderShipPrice' => 0,
	 *           'couponamt' => 1000,
	 *         ),
	 *     'order_items' =>
	 *         array (
	 *         0 =>
	 *             array (
	 *                 'item_id' => 30024236,
	 *                 'order_char_id' => '1030076825',
	 *                 'wh_id' => '1',
	 *                 'product_id' => 189672,
	 *                 'product_char_id' => '04-156-076',
	 *                 'uid' => '30558397',
	 *                 'name' => 'HTC Ұ��S A510c 3G��CDMA2000���ֻ� ��ɫ ���Ŷ���',
	 *                 'flag' => 26,
	 *                 'type' => 0,
	 *                 'type2' => 0,
	 *                 'weight' => 320,
	 *                 'buy_num' => 1,
	 *                 'points' => 0,
	 *                 'points_pay' => 0,
	 *                 'point_type' => 1,
	 *                 'discount' => 0,
	 *                 'price' => 209900,
	 *                 'cash_back' => 0,
	 *                 'cost' => 207308,
	 *                 'warranty' => '����Ʒȫ���������������������ʱ���Ϊ���ʱ�һ�ꡣ���������������ϣ�ƾ����ά�����Ļ���Լά�޵���������֤��������7�����˻���15���ڻ�����15���������ʱ�����������ѱ��޵���������',
	 *                 'expect_num' => 0,
	 *                 'create_time' => 1323870377,
	 *                 'product_type' => 0,
	 *                 'use_virtual_stock' => 0,
	 *                 'main_product_id' => 0,
	 *                 'updatetime' => 1323870377,
	 *                 'edm_code' => '',
	 *                 'apportToPm' => 0,
	 *                 'apportToMkt' => 0,
	 *             ),
	 *         )
	 *     )
	 */
	public static function saveCPSOrder(&$submitOrder, $whId = null) {
		self::clearERR();

		if (intval($submitOrder['errCode']) != 0) { //order error
			self::setERR(500, 'errors in order');
			return false;
		}

		/* CPS ���������߼���
		 * 1. �Ƿ��ǲʱ��ƹ㡣����ǲ���û���л���¼��QQ�������ʱ��߼۵���
		 * 2. �Ƿ���CPS�����̣��ǲʱ���������ǣ�����⡣
		 * 3. �Ƿ���QQ�û���¼������ǣ������ʱ��ͼ۵���
		 */

		global $_PAY_MODE;
		self::$whId = empty(self::$whId) ? IUser::getSiteId() : self::$whId;
		if ($whId) self::$whId = $whId; //���ⲿǿ�ƴ���ĸ���

		$saveCPSForQQ = null;
		$saveCPSRet = null;

		$userInfo = IUser::getUserInfo($submitOrder['uid']);
		if (false == $userInfo) {
			self::setERR(400, basename(__FILE__, '.php') . '|' . __LINE__ . ' fetch userinfo FAILED');
			return false;
		}

		$subOrderIds = self::_preprocessSubOrderIdStr($submitOrder['subOrderIdStr']);
		$subOrderCount = count($subOrderIds); //��Ҫ¼����Ӷ�����
		if ($subOrderCount == 0) { //�µ��ӿڷ�����������
			Logger::warn('suborders count 0, IFAILED.');
			return false;
		}

		//��¼�����
		$preQQUser = QQ_ACCOUNT_PRE . '_'; //qq�û���ǰ׺
		if (42 == strlen($userInfo['icsonid']) && 0 === strpos($userInfo['icsonid'], $preQQUser)) { //QQ ��¼
			$acct = str_replace($preQQUser, '', $userInfo['icsonid']);

			$newBizNo = IIdGenerator::getNewId('eqifa_log_sequence', $subOrderCount); //ȫ��ID
			if (false === $newBizNo || $newBizNo <= 0) {
				self::setERR(IIdGenerator::$errCode, IIdGenerator::$errMsg);
				return false;
			}

			$loginFromQQCB = false; //����Ƿ�����ʱ�CPS��Ϣ���ͼ۵����߼۵���
			$cookieInfo = array();
			if (isset($_COOKIE[CPSConfig::$cookieName])) {
				$cpsCookie = self::getCPSInfoFromCookie();

				if (is_array($cpsCookie)) { //
					$source = array_pop(array_keys($cpsCookie));
					$cookieInfo = array_pop(array_values($cpsCookie));
					$loginFromQQCB = ($source == CPSConfig::$providerQQCB) && ($cookieInfo['open_id'] == $acct);
				}
			}

			if ($subOrderCount == 1) { //δ��
				$userPayAmount = self::getUserPayAmount($submitOrder);
				$saveCPSForQQ = self::saveCPSOrderToDB(CPSConfig::$providerQQCB, array(
					'bizno' => $newBizNo,
					'open_id' => $acct, //QQ �ʱ�ƽ̨�ṩ�ĵ����û� ID ��һ����
					'login_from' => $loginFromQQCB ? $cookieInfo['login_from'] : '', //���ϵ�¼����ת��Դ, QQֱ�ӵ�¼�޷�ȡ��
					'attach' => $loginFromQQCB ? $cookieInfo['attach'] : CPSConfig::$providerList[CPSConfig::$providerQQCB]['static_attach'], //���ٴ���, QQֱ�ӵ�¼�޷�ȡ��, ֱ����Ϊ��
					'cps_order_type' => $loginFromQQCB ? 1 : 0, //'0. ���ϵ�¼��1.�Ӳʱ�����ת��'
					'uid' => $submitOrder['uid'], //�û����
					'order_id' => $submitOrder['orderId'], //����ID
					'order_status' => 10, //����״̬����ʼֵ
					'order_desc' => '51buy, ' . date('Y��m��d�� Hʱi��', $submitOrder['orderCreateTime']), //��������ժҪ
					'order_total_amount' => $submitOrder['orderTotalAmt'], //�����ܽ��
					'order_pay_amount' => $userPayAmount, //����ʵ��֧���Ľ�� - ��ȥ�ؼ���Ʒ���
					'order_comm_amount' => $submitOrder['isVATInvoice'] ? 0 : self::getCommAmountForQQCB($userPayAmount, $loginFromQQCB), //�����̻���Ҫ֧����Ӷ��, ��Ʊ����������
					'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //֧�����ͣ����ʱ����¼ payTypeID��
					'products' => '', //����� JSON ������Ʒ��Ϣ
					'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�û����̻�վ����µ�ʱ�䡣��ʱ��һ��ȷ������������䶯
					'order_modify_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�������̻�������޸�ʱ�䣬���µ���ʱ���ʱ���ֵ�� OrderCreateTime һ��
					'cookie_time' => $loginFromQQCB ? $cookieInfo['cookie_time'] : '', //cookie ʱ���
					'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
					'wh_id' => self::$whId, //���д���
					'feedback' => '', //�����ֶ� $submitOrder['comment']���û������������д��һЩ��ע("ʲôʱ�����ͻ�"֮���)
				));
			}
			else if ($subOrderCount > 1) { //��
				$cpsOrders = self::_makeupAry(array(
											'bizno' => $newBizNo,
											'open_id' => $acct, //QQ �ʱ�ƽ̨�ṩ�ĵ����û� ID ��һ����
											'login_from' => $loginFromQQCB ? $cookieInfo['login_from'] : '', //���ϵ�¼����ת��Դ, QQֱ�ӵ�¼�޷�ȡ��
											'attach' => $loginFromQQCB ? $cookieInfo['attach'] : CPSConfig::$providerList[CPSConfig::$providerQQCB]['static_attach'], //���ٴ���, QQֱ�ӵ�¼�޷�ȡ��, ֱ����Ϊ��
											'cps_order_type' => $loginFromQQCB ? 1 : 0, //'0. ���ϵ�¼��1.�Ӳʱ�����ת��'
											'uid' => $submitOrder['uid'], //�û����
											'order_id' => 0, //����
											'order_status' => 10, //����״̬����ʼֵ
											'order_desc' => '51buy, ' . date('Y��m��d�� Hʱi��', $submitOrder['orderCreateTime']), //��������ժҪ
											'order_total_amount' => 0, //����
											'order_pay_amount' => 0, //����
											'order_comm_amount' => $submitOrder['isVATInvoice'] ? 0 : self::getCommAmountForQQCB($userPayAmount, $loginFromQQCB), //�����̻���Ҫ֧����Ӷ��, ��Ʊ����������
											'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //֧�����ͣ����ʱ����¼ payTypeID��
											'products' => '', //����� JSON ������Ʒ��Ϣ
											'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�û����̻�վ����µ�ʱ�䡣��ʱ��һ��ȷ������������䶯
											'order_modify_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�������̻�������޸�ʱ�䣬���µ���ʱ���ʱ���ֵ�� OrderCreateTime һ��
											'cookie_time' => $loginFromQQCB ? $cookieInfo['cookie_time'] : '', //cookie ʱ���
											'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
											'wh_id' => self::$whId, //���д���
											'feedback' => '', //�����ֶ� $submitOrder['comment']���û������������д��һЩ��ע("ʲôʱ�����ͻ�"֮���)
										),
										$submitOrder,
										$loginFromQQCB
									);
				if (false === $cpsOrders) {
					Logger::warn('Generate batch cpsorders FAILED');
					return false;
				}

				$saveCPSForQQ = self::batchSaveCPSOrderToDB(CPSConfig::$providerQQCB, $cpsOrders);
			}
			else { // ����
				Logger::warn("SubOrder count ERROR - {$subOrderCount}.");
			}

			// QQCB ����һ������, �������ִ��
		}
		else if (0 === strpos($userInfo['icsonid'], SHAUTO_ACCOUNT_PRE)) { //�����û�
			$newBizNo = IIdGenerator::getNewId('eqifa_log_sequence', $subOrderCount); //ȫ��ID
			if (false === $newBizNo || $newBizNo <= 0) {
				self::setERR(IIdGenerator::$errCode, IIdGenerator::$errMsg);
				return false;
			}

			if ($subOrderCount == 1) { //δ��
				$userPayAmount = self::getUserPayAmount($submitOrder);
				$saveCPSForSHCar = self::saveCPSOrderToDB(CPSConfig::$providerSHCar, array(
					'bizno' => $newBizNo,
					'uid' => $submitOrder['uid'], //�û����
					'order_id' => $submitOrder['orderId'], //����ID
					'order_status' => 0, //����״̬����ʼֵ
					'order_total_amount' => $submitOrder['orderTotalAmt'], //�����ܽ��
					'order_pay_amount' => $userPayAmount, //����ʵ��֧���Ľ�� - ��ȥ�ؼ���Ʒ���
					'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //֧�����ͣ����ʱ����¼ payTypeID��
					'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�û����̻�վ����µ�ʱ�䡣��ʱ��һ��ȷ������������䶯
					'order_modify_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�������̻�������޸�ʱ�䣬���µ���ʱ���ʱ���ֵ�� OrderCreateTime һ��
					'wh_id' => self::$whId, //���д���
				));
				Logger::warn('shcar ret ' . ($saveCPSForSHCar ? 'SUCCESS' : 'FAILED'));
			}
			else if ($subOrderCount > 1) { //��
				$cpsOrders = self::_makeupAry(array(
											'bizno' => $newBizNo,
											'uid' => $submitOrder['uid'], //�û����
											'order_id' => 0, //����
											'order_status' => 0, //����״̬����ʼֵ
											'order_total_amount' => 0, //����
											'order_pay_amount' => 0, //����
											'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //֧�����ͣ����ʱ����¼ payTypeID��
											'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�û����̻�վ����µ�ʱ�䡣��ʱ��һ��ȷ������������䶯
											'order_modify_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�������̻�������޸�ʱ�䣬���µ���ʱ���ʱ���ֵ�� OrderCreateTime һ��
											'wh_id' => self::$whId, //���д���
										),
										$submitOrder,
										$loginFromQQCB
									);
				if (false === $cpsOrders) {
					Logger::warn('Generate batch cpsorders FAILED');
					return false;
				}

				$saveCPSForSHCar = self::batchSaveCPSOrderToDB(CPSConfig::$providerSHCar, $cpsOrders);
				Logger::warn('shcar ret ' . $saveCPSForSHCar ? 'SUCCESS' : 'FAILED');
			}
			else { // ����
				Logger::warn("SubOrder count ERROR - {$subOrderCount}.");
			}

			return true; //������������һ���ึ
		}
		//��¼��������

		//���� cookie ¼�� CPS ����
		if (isset($_COOKIE[CPSConfig::$cookieNameSource])) {

			//QQTuan begin
			if ( $_COOKIE[CPSConfig::$cookieNameSource] == CPSConfig::$providerQQTuan
				&& isset($_COOKIE['edm']) ) { //QTuan �ǰ� EDM

				$edm_str = false;
				$edm_infos = explode(',', $_COOKIE['edm']);

				$cpsOrders = array(); //Q�Ŷ���һ����Ʒһ����¼
				foreach ($submitOrder['order_items'] as &$orderItem) {
					if ( $orderItem['edm_code'] ) { //���� edm ��Ϣ�ż���Ƿ�ƥ��
						foreach ($edm_infos as $edm_item) {
							if (false !== strpos($edm_item, $orderItem['edm_code'])) {
								$edm_str = $edm_item;
								break;
							}
						}

						if ($edm_str) { //�Ƶ���ʱ�����Ҫ�ٴ��ж����˴����ټ�¼�Ƿ���ϴ���Դƥ��
							$edmAry = explode('_', $edm_str);
							$edmLen = count($edmAry);
							if ( $edmLen >= 2 && in_array($orderItem['product_id'], $edmAry) ) { //����Ʒidλ��Q��EDM cookie��
								$order_id = 0;
								foreach ($submitOrder['subOrders'] as $stockId => &$subOrder) {
									if (in_array($orderItem['product_id'], $subOrder['product_ids'])) {
										$order_id = $subOrder['orderId'];
										//order_idǰ���'10' daopingsun
										$order_id = isset($order_id) ? sprintf("%s%09d", "1", $order_id % 1000000000) : 0;
										break;
									}
								}

								if (0 != $order_id) { //���� orderid �ɹ�
									$newBizNo = IIdGenerator::getNewId('eqifa_log_sequence'); //ȫ��ID
									if (false === $newBizNo || $newBizNo <= 0) {
										self::setERR(IIdGenerator::$errCode, IIdGenerator::$errMsg);
										return false;
									}

									$cpsOrders[] = array(
										'bizno' => $newBizNo,
										'uid' => $submitOrder['uid'], //�û�ID
										'qqtuan_id' => $edmAry[ $edmLen - 1 ], //Q��ID��Ӧ����edm�������һ��
										'order_id' => $order_id, //����ID
										'openkey' => empty($_COOKIE[CPSConfig::$cookieQQTuanOpenKey]) ? '' : $_COOKIE[CPSConfig::$cookieQQTuanOpenKey], //cookie �б����Q�Ųഫ��� openkey
										'product_id' => $orderItem['product_id'], //��Ʒid
										'buy_count' => $orderItem['buy_num'], //�������
										'order_status' => 0, //����״̬
										'order_total_amount' => $orderItem['price'], //�����ܽ����Q�ţ�����ֻ�ܼ�¼cost�ˣ���
										'order_pay_amount' => $orderItem['price'], //����ʵ��֧�����ܽ����Q�ţ�����ֻ�ܼ�¼cost�ˣ���
										'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //֧�����ͣ����ʱ����¼ payTypeID��
										'pay_online' => $submitOrder['payTypeIsOnline'], //pay online?
										'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�����µ�ʱ��
										'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
										'wh_id' => self::$whId, //���д���
									);
								}
								else {
									Logger::err('reverse search order_id FAILED');
								}
								//Logger::info("Save qqtuan order {$newBizNo} " . ((false === $saveCPSRet) ? 'FAILED' : 'SUCCESS'));
							}
						}
					}
				}

				if (! empty($cpsOrders)) {
					$saveCPSRet = self::batchSaveCPSOrderToDB(CPSConfig::$providerQQTuan, $cpsOrders);
					Logger::info('record qtuan ' . (false === $saveCPSRet) ? 'FAILED' : 'SUCCESS');
				}
				else {
					Logger::info('no qtuan item');
				}
			}
		}
		//QQTuan end

		if (isset($_COOKIE[CPSConfig::$cookieName])) {
			$cpsCookie = self::getCPSInfoFromCookie();
			if (is_array($cpsCookie)) {
				$source = array_pop(array_keys($cpsCookie));
				$cookieInfo = array_pop(array_values($cpsCookie));

				if (array_key_exists($source, CPSConfig::$providerList)) {
					if ($source != CPSConfig::$providerQQCB) { //NOTE: "QQCB" ֮ǰ��¼����; "QQTuan" ��ʱ����CPS cookie��¼

						$newBizNo = IIdGenerator::getNewId('eqifa_log_sequence', $subOrderCount); //ȫ��ID
						if (false === $newBizNo || $newBizNo <= 0) {
							self::setERR(IIdGenerator::$errCode, IIdGenerator::$errMsg);
							return false;
						}

						$saveCPSRet = false;
						if ($subOrderCount == 1) {
							switch ($source) {
								//case CPSConfig::$providerQQCB: //NOTE �ʱ�֮ǰ��¼����
								//break;

								case CPSConfig::$providerLinktech:
									$saveCPSRet = self::saveCPSOrderToDB($source, array(
										'bizno' => $newBizNo,
										'cookie_info' => $cookieInfo['cookie'], //����ص� Cookie �Ƚ�����
										'uid' => $submitOrder['uid'], //�û�ID
										'order_id' => $submitOrder['orderId'], //����ID
										'order_status' => 100, //����״̬ [100:δ����(�û����µĶ���).200:�˶���(���׳ɹ�).300:ȡ��(����ʧ��)]
										'order_total_amount' => $submitOrder['orderTotalAmt'], //�����ܽ��
										'order_pay_amount' => self::getUserPayAmount($submitOrder), //����ʵ��֧���Ľ�� - ��ȥ�ؼ���Ʒ���
										'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //֧�����ͣ����ʱ����¼ payTypeID��
										'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�����µ�ʱ��
										'product_id' => '', //��Ʒ���
										'product_count' => '', //�������Ʒ����
										'product_price' => '', //��Ʒ����
										'product_type' => '', //�������Ʒ����
										'cookie_time' => $cookieInfo['cookie_time'], //cookie ʱ���
										'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
										'wh_id' => self::$whId, //���д���
									));
								break;

								case CPSConfig::$providerYiqifa:
									$saveCPSRet = self::saveCPSOrderToDB($source, array (
										'bizno' => $newBizNo,
										'cid' => $cookieInfo['cid'], //�����������ƽ̨�ƹ�ı�ʶ,�̶�ֵ,�����ڽӿ�1��cidֵ
										'wi' => $cookieInfo['wi'], //�����¼���վ��Ϣ
										'uid' => $submitOrder['uid'], //�û�ID
										'order_id' => $submitOrder['orderId'], //����ID
										'order_total_amount' => $submitOrder['orderTotalAmt'], //�����ܽ��
										'order_pay_amount' => self::getUserPayAmount($submitOrder), //����ʵ��֧���Ľ�� - ��ȥ�ؼ���Ʒ���
										'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //֧�����ͣ����ʱ����¼ payTypeID��
										'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�����µ�ʱ��
										'product_id' => '', //��Ʒ���.����Ƕ����Ʒ,���� | �ָ�
										'product_type' => '', //�������Ʒ����
										'product_count' => '', //�������Ʒ����
										'product_price' => '', //��Ʒ����
										'cookie_time' => $cookieInfo['cookie_time'], //cookie ʱ���
										'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
										'wh_id' => self::$whId, //���д���
									));
								break;

								case CPSConfig::$providerChanet:
									$saveCPSRet = self::saveCPSOrderToDB($source, array (
										'bizno' => $newBizNo,
										'click_id' => $cookieInfo['click_id'], //�ɹ���Ψһ��ʶ
										'uid' => $submitOrder['uid'], //�û�ID
										'order_id' => $submitOrder['orderId'], //����ID
										'order_total_amount' => $submitOrder['orderTotalAmt'], //�����ܽ��
										'order_pay_amount' => self::getUserPayAmount($submitOrder), //����ʵ��֧���Ľ�� - ��ȥ�ؼ���Ʒ���
										'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //֧�����ͣ����ʱ����¼ payTypeID��
										'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�����µ�ʱ��
										'cookie_time' => $cookieInfo['cookie_time'], //cookie ʱ���
										'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
										'wh_id' => self::$whId, //���д���
									));
								break;

								case CPSConfig::$providerWeiyi:
									$saveCPSRet = self::saveCPSOrderToDB($source, array (
										'bizno' => $newBizNo,
										'cid' => $cookieInfo['cid'], //Ψһ��Ψһ��ʶ
										'uid' => $submitOrder['uid'], //�û�ID
										'order_id' => $submitOrder['orderId'], //����ID
										'order_total_amount' => $submitOrder['orderTotalAmt'], //�����ܽ��
										'order_pay_amount' => self::getUserPayAmount($submitOrder), //����ʵ��֧���Ľ�� - ��ȥ�ؼ���Ʒ���
										'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //֧�����ͣ����ʱ����¼ payTypeID��
										'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�����µ�ʱ��
										'cookie_time' => $cookieInfo['cookie_time'], //cookie ʱ���
										'wh_id' => self::$whId, //���д���
									));
								break;

								case CPSConfig::$provider51bigou:
									$saveCPSRet = self::saveCPSOrderToDB($source, array (
										'bizno' => $newBizNo,
										'u_id' => $cookieInfo['u_id'], //Ψһ��Ψһ��ʶ
										'uid' => $submitOrder['uid'], //�û�ID
										'ip' => ip2long(ToolUtil::getClientIP()), //�û�ID
										'order_id' => $submitOrder['orderId'], //����ID
										'order_total_amount' => $submitOrder['orderTotalAmt'], //�����ܽ��
										'order_pay_amount' => self::getUserPayAmount($submitOrder), //����ʵ��֧���Ľ�� - ��ȥ�ؼ���Ʒ���
										'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //֧�����ͣ����ʱ����¼ payTypeID��
										'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�����µ�ʱ��
										'cookie_time' => $cookieInfo['cookie_time'], //cookie ʱ���
										'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
										'wh_id' => self::$whId, //���д���
									));
								break;

								case CPSConfig::$provider51fanli:
									$icsonid = ($userInfo === false) ? '' : $userInfo['icsonid'];
									if (! preg_match('/^\d+@51fanli$/i', $userInfo['icsonid'])) {
										$icsonid = ''; //�Ƿ������û� ����¼ name
									}

									$saveCPSRet = self::saveCPSOrderToDB($source, array (
										'bizno' => $newBizNo,
										'u_id' => $cookieInfo['u_id'], //51fanli u_id
										'tracking_code' => $cookieInfo['tracking_code'], //51fanli tracking_code
										'uid' => $submitOrder['uid'], //�û�ID
										'name' => $icsonid, //�û���¼��
										'order_id' => $submitOrder['orderId'], //����ID
										'order_total_amount' => $submitOrder['orderTotalAmt'], //�����ܽ��
										'order_pay_amount' => self::getUserPayAmount($submitOrder), //����ʵ��֧���Ľ�� - ��ȥ�ؼ���Ʒ���
										'payment_type' => (intval($submitOrder['payTypeIsOnline']) == 1 ? 1 : 2), //֧�����ͣ�����֧����1���������2��������3��
										'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�����µ�ʱ��
										'cookie_time' => $cookieInfo['cookie_time'], //cookie ʱ���
										'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
										'wh_id' => self::$whId, //���д���
									));
								break;
								/*********add by wheelswang 2012-09-25*********/
								case CPSConfig::$provider163Youdao:
									$youdao_order = array (
										'bizno' => $newBizNo,
										'uid' => $submitOrder['uid'],
										'user_id' => $cookieInfo['userid'],
										'order_id' => $submitOrder['orderId'], //����ID
										'order_status' => 0, //������ʼ��
										'order_total_amount' => $submitOrder['orderTotalAmt'], //�����ܽ��
										'order_pay_amount' => self::getUserPayAmount($submitOrder), //����ʵ��֧���Ľ�� - ��ȥ�ؼ���Ʒ���
										'payment_type' => (intval($submitOrder['payTypeIsOnline']) == 1 ? 1 : 2), //֧�����ͣ�����֧����1���������2��������3��
										'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�����µ�ʱ��
										'order_modify_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']),//�����޸�ʱ��
										'wh_id' => self::$whId, //���д���
									);
									$cpsOrders[] = $youdao_order;
									$saveCPSRet = self::saveCPSOrderToDB($source, $youdao_order);
								break;
								/*********add by wheelswang 2012-09-25*********/
								case CPSConfig::$providerCommon:
									$saveCPSRet = self::saveCPSOrderToDB($source, array (
										'bizno' => $newBizNo,
										'cid' => $cookieInfo['cid'], //Eqifa_Log.MasterID
										'wid' => $cookieInfo['wid'], //Eqifa_Log.FirstID
										'fbt' => $cookieInfo['fbt'], //Eqifa_Log.SecondID
										'uid' => $submitOrder['uid'], //�û�ID
										'ip' => ip2long(ToolUtil::getClientIP()), //�û�ID
										'order_id' => $submitOrder['orderId'], //����ID
										'order_total_amount' => $submitOrder['orderTotalAmt'], //�����ܽ��
										'order_pay_amount' => self::getUserPayAmount($submitOrder), //����ʵ��֧���Ľ�� - ��ȥ�ؼ���Ʒ���
										'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //֧�����ͣ����ʱ����¼ payTypeID��
										'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�����µ�ʱ��
										'cookie_time' => $cookieInfo['cookie_time'], //cookie ʱ���
										'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
										'wh_id' => self::$whId, //���д���
									));
								break;
							} //switch end

							if (false === $saveCPSRet) {
								Logger::warn('cps save single FAILED ' . self::$errCode . '|' . self::$errMsg);
								return false;
							}
						}
						else if ($subOrderCount > 1) { //��
							$cpsOrders = array();

							switch ($source) {
								//case CPSConfig::$providerQQCB: //NOTE �ʱ�֮ǰ��¼����
								//break;

								case CPSConfig::$providerLinktech:
									$cpsOrders = self::_makeupAry(array(
											'bizno' => $newBizNo,
											'cookie_info' => $cookieInfo['cookie'], //����ص� Cookie �Ƚ�����
											'uid' => $submitOrder['uid'], //�û�ID
											'order_id' => 0, //����
											'order_status' => 100, //����״̬ [100:δ����(�û����µĶ���).200:�˶���(���׳ɹ�).300:ȡ��(����ʧ��)]
											'order_total_amount' => 0, //����
											'order_pay_amount' => 0, //����
											'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //֧�����ͣ����ʱ����¼ payTypeID��
											'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�����µ�ʱ��
											'product_id' => '', //��Ʒ���
											'product_count' => '', //�������Ʒ����
											'product_price' => '', //��Ʒ����
											'product_type' => '', //�������Ʒ����
											'cookie_time' => $cookieInfo['cookie_time'], //cookie ʱ���
											'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
											'wh_id' => self::$whId, //���д���
										),
										$submitOrder
									);
								break;

								case CPSConfig::$providerYiqifa:
									$cpsOrders = self::_makeupAry(array(
											'bizno' => $newBizNo,
											'cid' => $cookieInfo['cid'], //�����������ƽ̨�ƹ�ı�ʶ,�̶�ֵ,�����ڽӿ�1��cidֵ
											'wi' => $cookieInfo['wi'], //�����¼���վ��Ϣ
											'uid' => $submitOrder['uid'], //�û�ID
											'order_id' => 0, //����
											'order_total_amount' => 0, //����
											'order_pay_amount' => 0, //����
											'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //֧�����ͣ����ʱ����¼ payTypeID��
											'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�����µ�ʱ��
											'product_id' => '', //��Ʒ���.����Ƕ����Ʒ,���� | �ָ�
											'product_type' => '', //�������Ʒ����
											'product_count' => '', //�������Ʒ����
											'product_price' => '', //��Ʒ����
											'cookie_time' => $cookieInfo['cookie_time'], //cookie ʱ���
											'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
											'wh_id' => self::$whId, //���д���
										),
										$submitOrder
									);
								break;

								case CPSConfig::$providerChanet:
									$cpsOrders = self::_makeupAry(array(
											'bizno' => $newBizNo,
											'click_id' => $cookieInfo['click_id'], //�ɹ���Ψһ��ʶ
											'uid' => $submitOrder['uid'], //�û�ID
											'order_id' => 0, //����
											'order_total_amount' => 0, //����
											'order_pay_amount' => 0, //����
											'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //֧�����ͣ����ʱ����¼ payTypeID��
											'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�����µ�ʱ��
											'cookie_time' => $cookieInfo['cookie_time'], //cookie ʱ���
											'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
											'wh_id' => self::$whId, //���д���
										),
										$submitOrder
									);
								break;

								case CPSConfig::$providerWeiyi:
									$cpsOrders = self::_makeupAry(array(
											'bizno' => $newBizNo,
											'cid' => $cookieInfo['cid'], //Ψһ��Ψһ��ʶ
											'uid' => $submitOrder['uid'], //�û�ID
											'order_id' => 0, //����
											'order_total_amount' => 0, //����
											'order_pay_amount' => 0, //����
											'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //֧�����ͣ����ʱ����¼ payTypeID��
											'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�����µ�ʱ��
											'cookie_time' => $cookieInfo['cookie_time'], //cookie ʱ���
											'wh_id' => self::$whId, //���д���
										),
										$submitOrder
									);
								break;

								case CPSConfig::$provider51bigou:
									$cpsOrders = self::_makeupAry(array(
											'bizno' => $newBizNo,
											'u_id' => $cookieInfo['u_id'], //Ψһ��Ψһ��ʶ
											'uid' => $submitOrder['uid'], //�û�ID
											'ip' => ip2long(ToolUtil::getClientIP()), //�û�ID
											'order_id' => 0, //����
											'order_total_amount' => 0, //����
											'order_pay_amount' => 0, //����
											'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //֧�����ͣ����ʱ����¼ payTypeID��
											'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�����µ�ʱ��
											'cookie_time' => $cookieInfo['cookie_time'], //cookie ʱ���
											'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
											'wh_id' => self::$whId, //���д���
										),
										$submitOrder
									);
								break;

								case CPSConfig::$provider51fanli:
									$icsonid = ($userInfo === false) ? '' : $userInfo['icsonid'];
									if (! preg_match('/^\d+@51fanli$/i', $userInfo['icsonid'])) {
										$icsonid = ''; //�Ƿ������û� ����¼ name
									}

									$cpsOrders = self::_makeupAry(array(
											'bizno' => $newBizNo,
											'u_id' => $cookieInfo['u_id'], //51fanli u_id
											'tracking_code' => $cookieInfo['tracking_code'], //51fanli tracking_code
											'uid' => $submitOrder['uid'], //�û�ID
											'name' => $icsonid, //�û���¼��
											'order_id' => 0, //����
											'order_total_amount' => 0, //����
											'order_pay_amount' => 0, //����
											'payment_type' => (intval($submitOrder['payTypeIsOnline']) == 1 ? 1 : 2), //֧�����ͣ�����֧����1���������2��������3��
											'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�����µ�ʱ��
											'cookie_time' => $cookieInfo['cookie_time'], //cookie ʱ���
											'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
											'wh_id' => self::$whId, //���д���
										),
										$submitOrder
									);
								break;
								/*********add by wheelswang********/
								case CPSConfig::$provider163Youdao:
									$cpsOrders = self::_makeupAry(array(
											'bizno' => $newBizNo,
											'uid' => $submitOrder['uid'],
											'user_id' => $cookieInfo['userid'],
											'order_id' => $submitOrder['orderId'], //����ID
											'order_status' => 0,//������ʼ��
											'order_total_amount' => 0, //�����ܽ��
											'order_pay_amount' => 0, //����ʵ��֧���Ľ�� - ��ȥ�ؼ���Ʒ���
											'payment_type' => (intval($submitOrder['payTypeIsOnline']) == 1 ? 1 : 2), //֧�����ͣ�����֧����1���������2��������3��
											'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�����µ�ʱ��
											'order_modify_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']),//�����޸�ʱ��
											'wh_id' => self::$whId, //���д���
										),
										$submitOrder
									);
								break;
								case CPSConfig::$providerCommon:
									$cpsOrders = self::_makeupAry(array(
											'bizno' => $newBizNo,
											'cid' => $cookieInfo['cid'], //Eqifa_Log.MasterID
											'wid' => $cookieInfo['wid'], //Eqifa_Log.FirstID
											'fbt' => $cookieInfo['fbt'], //Eqifa_Log.SecondID
											'uid' => $submitOrder['uid'], //�û�ID
											'ip' => ip2long(ToolUtil::getClientIP()), //�û�ID
											'order_id' => 0, //����
											'order_total_amount' => 0, //����
											'order_pay_amount' => 0, //����
											'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //֧�����ͣ����ʱ����¼ payTypeID��
											'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //�����µ�ʱ��
											'cookie_time' => $cookieInfo['cookie_time'], //cookie ʱ���
											'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
											'wh_id' => self::$whId, //���д���
										),
										$submitOrder
									);
								break;
							} //switch end

							if (empty($cpsOrders)) {
								self::setERR('400', 'no cps order');
								return false;
							}

							$saveCPSRet = self::batchSaveCPSOrderToDB($source, $cpsOrders);
							if (false === $saveCPSRet) {
								Logger::warn('cps save batch FAILED ' . self::$errCode . '|' . self::$errMsg);
								return false;
							}
						}
					}
				}
				else {
					self::setERR(403, 'unsupport cps provider');
					return false;
				}
			}
			else {
				self::setERR(402, basename(__FILE__, '.php') . '|' . __LINE__ . ' cookie is invalid');
				return false;
			}
		}

		return true;
	}

	/**
	 * ��¼ CPS ������Ϣ�����ݿ⡣
	 * @param string $source CPS �ṩ��
	 * @param array $params ������Ϣ���飬�����ж����ֵ����Ҫ����
	 * QQ �ʱ��� $params
	 * array (
			'uid' => �û�ID
			'order_id' => ����ID
			'order_status' => ����״̬
			'order_desc' => ��������ժҪ
			'order_total_amount' => �����ܽ���������Ʒ�ܼ۸��˷ѣ���֤���Ż�ȯ��
			'order_pay_amount' => ����ʵ��֧�����ܽ��
			'order_comm_amount' => �����̻���Ҫ֧����Ӷ��
			'payment_type' => ֧�����ͣ��ǲƸ�֧ͨ��������֧�������������
			'open_id' => QQ �ʱ�ƽ̨�ṩ
			'login_from' => ���ϵ�¼����ת��Դ
			'wh_id' => ���д���
			'products' => ����� JSON ������Ʒ��Ϣ
			'attach' => ���ٴ��룬��ʾ����������������λ��Ψһ��ʶ���ɲʱ�ƽ̨�ṩ,�������ϵͳ�ڵ�һ���Ƶ�ʱ�ش���
			'order_create_time' => �û����̻�վ����µ�ʱ�䡣��ʱ��һ��ȷ������������䶯
			'order_modify_time' => �������̻�������޸�ʱ�䣬���µ���ʱ���ʱ���ֵ�� OrderCreateTime һ��
			'province' => ��������ʡ�ݣ�����ʡ��ƴ������
			'feedback' => �����ֶ�
		)
	 ******************
	 * �����(linktech)�� $params
	 * array (
			'uid' => �û�ID
			'cookie_info' => ��¼�ķ���ҵ��ʱ��� Cookie ֵ
			'order_id' => ����ID
			'order_create_time' => �����µ�ʱ��
			'order_status' => ����״̬ [100:δ����(�û����µĶ���).200:�˶���(���׳ɹ�).300:ȡ��(����ʧ��)]
			'product_id' => ��Ʒ���
			'product_count' => �������Ʒ����
			'product_price' => ��Ʒ����
			'product_type' => �������Ʒ����
			'wh_id' => ��¼����ID
		)
	 ******************
	 * ����(yiqifa)�� $params
	 * array (
			'cid' => �����������ƽ̨�ƹ�ı�ʶ,�̶�ֵ,�����ڽӿ�1��cidֵ
			'wi' => �����¼���վ��Ϣ
			'uid' => �û�ID
			'order_id' => ������
			'order_create_time' => �����µ�ʱ��
			'product_id' => ��Ʒ���.����Ƕ����Ʒ,���� | �ָ�
			'product_type' => �������Ʒ����
			'product_count' => �������Ʒ����
			'product_price' => ��Ʒ����
			'wh_id' => ��¼����ID
		)
	 * @return Boolean ��Ӽ�¼��DB�Ľ��
	 */
	private static function saveCPSOrderToDB($source, $params) {
		if (!array_key_exists($source, CPSConfig::$providerList)) {
			self::setERR(400, basename(__FILE__, '.php') . '|' . __LINE__ . ' cps provider is invalid');
			return false;
		}

		$table = CPSConfig::getCorrespondingTable($source);
		if (! empty($table)) {
			$ret = ICPSDao::insert($table, $params);
			if ($ret === false) {
				self::setERR(501, basename(__FILE__, '.php') . '|' . __LINE__ . ' [insert new CPS order failed: '. ICPSDao::$errMsg .']');
				return false;
			}
			return $ret;
		}
		else {
			self::setERR(401, basename(__FILE__, '.php') . '|' . __LINE__ . ' [cps_order table isnot exist: '. ICPSDao::$errMsg .']');
			return false;
		}
	}

	/**
	 * �������
	 * @param string $source
	 * @param array $params
	 * @return boolean �ɹ�?ʧ��?
	 */
	private static function batchSaveCPSOrderToDB($source, $records) {
		if (!array_key_exists($source, CPSConfig::$providerList)) {
			self::setERR(400, basename(__FILE__, '.php') . '|' . __LINE__ . ' cps provider is invalid');
			return false;
		}

		$table = CPSConfig::getCorrespondingTable($source);
		if (! empty($table)) {
			$ret = ICPSDao::batchInsert($table, $records);
			if ($ret === false) {
				self::setERR(501, basename(__FILE__, '.php') . '|' . __LINE__ . ' [insert new CPS order failed: '. ICPSDao::$errMsg .']');
				return false;
			}
			return $ret;
		}
		else {
			self::setERR(401, basename(__FILE__, '.php') . '|' . __LINE__ . ' [cps_order table isnot exist: '. ICPSDao::$errMsg .']');
			return false;
		}
	}

	/**
	 * ����QQ�ʱ����ĵ��������ϵ�¼��vkey��
	 * @param array $params QQ�ʱ�POST��
	 * @return string ���ݹ�ʽ�������֤�ַ���
	 */
	public static function getLoginVKeyForQQCB($params) {
		ksort($params);
		$rawString = implode('', array_values($params));
		//vkey = md5(md5(raw_string+key1)+key2) ���㹫ʽ�ο��ʱ��ĵ�; ���ǵ�md5��������Ĵ�Сд���⣬Լ��md5�������ΪСд
		return strtolower(md5(strtolower(md5($rawString . CPSConfig::$providerList[CPSConfig::$providerQQCB]['login_key1'])) . CPSConfig::$providerList[CPSConfig::$providerQQCB]['login_key2']));
	}

	/**
	 * ����QQ�������ĵ��������ϵ�¼��vkey��
	 * @param array $params QQ�ʱ�POST��
	 * @return string ���ݹ�ʽ�������֤�ַ���
	 */
	public static function getLoginVKeyForQQfanli($params) {
		$rawString = implode('', $params);

		//vkey = md5(md5(raw_string+key1)+key2) ���㹫ʽ�ο��ʱ��ĵ�; ���ǵ�md5��������Ĵ�Сд���⣬Լ��md5�������ΪСд
		return strtolower(md5(
			strtolower(md5($rawString . CPSConfig::$providerList[CPSConfig::$providerQQfanli]['login_key1']))
			. CPSConfig::$providerList[CPSConfig::$providerQQfanli]['login_key2']
		));
	}

	/**
	 * ����QQ�ʱ����ĵ������Ƶ�ʱ��vkey��
	 * @param string $attach QQ�ʱ��������
	 * @param string $openId QQ�ʱ��������
	 * @param string $orderCommAmount �Ƶ�����
	 * @param string $orderCreateTime �Ƶ�����
	 * @param string $orderId �Ƶ�����
	 * @param string $orderModifyTime �Ƶ�����
	 * @param string $orderPayAmount �Ƶ�����
	 * @param string $orderPushTime �Ƶ�����
	 * @param string $orderStatus �Ƶ�����
	 * @param string $orderTotalAmount �Ƶ�����
	 * @param string $paymentType �Ƶ�����
	 * @return string ���ݹ�ʽ�������֤�ַ���
	 */
	public static function getOrderVKeyForQQCB($attach, $openId, $orderCommAmount, $orderCreateTime, $orderId, $orderModifyTime, $orderPayAmount, $orderPushTime, $orderStatus, $orderTotalAmount, $paymentType) {
		$rawString = "{$attach}" . CPSConfig::$providerList[CPSConfig::$providerQQCB]['merchant_id']
						. "{$openId}{$orderCommAmount}{$orderCreateTime}{$orderId}{$orderModifyTime}{$orderPayAmount}{$orderPushTime}{$orderStatus}{$orderTotalAmount}{$paymentType}";
		return strtolower(md5(strtolower(md5($rawString . CPSConfig::$providerList[CPSConfig::$providerQQCB]['order_key1'])) . CPSConfig::$providerList[CPSConfig::$providerQQCB]['order_key2']));
	}

	/**
	 * ����ɹ��� sig ��
	 * @param array $params ����ɹ��� sig ��Ҫ�Ĳ���
	 * @return string �ɹ��� sig
	 */
	public static function getSigForChanet($params) {
		if (isset($params['sig'])) unset($params['sig']);

		$standard = array(
			'user' => CPSConfig::$providerList[CPSConfig::$providerChanet]['user'],
			'start' => '',
			'end' => '',
			'orderid' => '',
			'unixtime' => '',
			'key' => CPSConfig::$providerList[CPSConfig::$providerChanet]['key'],
		);
		$params = array_merge($standard, $params);
		$iterms = array();
		foreach ($params as $k => $v) {
			if (!empty($v)) {
				$iterms[] = "{$k}={$v}";
			}
		}

		return md5(implode('&', $iterms));
	}

	/**
	 * ���ϵ�¼GET�����еĲ���
	 * @param array $params
	 * @return string ��username��shop_key��action_time�����ַ�������һ�𣬽���MD5����
	 */
	public static function getVerifyCodeFor51fanli(&$params) {
		$shop_key = CPSConfig::$providerList[CPSConfig::$provider51fanli]['shop_key'];

		return md5("{$params['username']}{$shop_key}{$params['action_time']}");
	}

	/********************** ��ʱ���� *****************************/
	/**
	 * ��¼ CPS ��ת��Ϣ���������޶�����
	 * @param string $source CPS �ṩ��
	 * @param array $params ��ת��Ϣ���飬�����ж����ֵ����Ҫ����
	 * @return Boolean ��Ӽ�¼��DB�Ľ��
	 */
	/*
	public static function saveCPSLogToDB($source, $params) {
		switch ($source) {
			case CPSConfig::$providerQQCB:
				return self::saveLogForQQCB($params);

			case CPSConfig::$providerLinktech:
			case CPSConfig::$providerYiqifa:
			case CPSConfig::$providerChanet:
			case CPSConfig::$providerWeiyi:
			case CPSConfig::$provider51bigou:
			case CPSConfig::$providerCommon:
				return false; //��

			default:
				self::setERR(400, '�Ҳ�����CPS�ṩ�̶�Ӧ�Ĵ�����');
				return false;
		}
	}

	public static function saveLogForQQCB($params) {
		$table = CPSConfig::getCorrespondingTable(CPSConfig::$providerQQCB, CPSConfig::$tableTypeLog);
		if (! empty($table)) {
			$ret = ICPSDao::insert($table, array(
				'uid' => $params['uid'],
				'open_id' => $params['openid'],
				'login_from' => $params['loginfrom'],
				'attach' => $params['attach'],
				'wh_id' => $params['wh_id'],
			));
			if ($ret === false) {
				self::setERR(501, 'д�����');
				return false;
			}
			return $ret;
		}
		else {
			self::setERR(401, '��Ӧ�����ݱ�����');
			return false;
		}
	}

	public static function getLogForQQCB() {
		$table = CPSConfig::getCorrespondingTable(CPSConfig::$providerQQCB, CPSConfig::$tableTypeLog);
		if (! empty($table)) {
			$ret = ICPSDao::getRows($table, '*');
			if ($ret === false) {
				self::setERR(502, '�������');
				return false;
			}
			return $ret;
		}
		else {
			self::setERR(401, '��Ӧ�����ݱ�����');
			return false;
		}
	}
	*/

	/**
	 * ���ݲ�����ȡCPS�����б�
	 * @tutorial ��������ܴ�...
	 * @param array $params �����̴��ݵĶ�����ѯ����
	 * @param string $source ָ��������
	 * @param string $where ��������
	 * @param string $start ��ʼ
	 * @param string $len ��Ŀ��
	 * @return mixed boolean false / array �ҵ�CPS����
	 */
	public static function getOrdersForConsult($source, $params, $where=null, $start=0, $len=10000) {
		self::clearERR();
		$ret = false;

		switch ($source) {
			case CPSConfig::$providerSHCar:
				$ret = self::consultRetForSHCar($where, $start, $len);
				break;

			case CPSConfig::$providerQQCB: //QQ�ʱ�
				$ret = self::consultRetForQQCB($where, $start, $len);
				break;

			case CPSConfig::$providerQQTuan: //QQTuan
				$ret = IQQTuan::consultRet($params, $where, $start, $len);
				if (false === $ret) {
					self::setERR(IQQTuan::$errCode, IQQTuan::$errMsg);
				}
				break;

			case CPSConfig::$providerLinktech: //�����
				$where = array(
					'`is_vat_invoice` = 0',
					'`cookie_time` < (UNIX_TIMESTAMP(`order_create_time`)+86400)',
					"`order_create_time` BETWEEN '{$params['yyyymmdd']}' AND DATE_ADD('{$params['yyyymmdd']}', INTERVAL 1 DAY)"
				);
				$where = implode(' AND ', $where);
				$ret = self::consultRetForLinktech($where, $start, $len);
				break;

			case CPSConfig::$providerYiqifa: //����
				$where = array(
					'`is_vat_invoice` = 0',
					"`cid` = '{$params['cid']}'",
					'`cookie_time` < (UNIX_TIMESTAMP(`order_create_time`)+86400)',
					"`order_create_time` BETWEEN '{$params['d']}' AND DATE_ADD('{$params['d']}', INTERVAL 1 DAY)"
				);
				$where = implode(' AND ', $where);
				$len = 30000; //��ʱ�����ȡ���ޡ�2.0 �н����ٽ������ơ�
				$ret = self::consultRetForYiqifa($where, $start, $len);
				break;

			case CPSConfig::$providerChanet: //�ɹ�
				$where = array(
					'`is_vat_invoice` = 0',
					'`cookie_time` < (UNIX_TIMESTAMP(`order_create_time`)+86400)',
				);

				if (isset($params['orderid'])) {
					$where[] = "`order_id` = '{$params['orderid']}' ";
				}
				if (isset($params['start'])) {
					$where[] = "`order_create_time` > '{$params['start']}' ";
				}
				if (isset($params['end'])) {
					$where[] = "`order_create_time` < '{$params['end']}' ";
				}
				if (isset($params['orderstatus'])) {
					$where[] = "`order_status` = '{$params['orderstatus']}' ";
				}
				$where = implode(' AND ', $where);
				$where = strlen($where)>0 ? $where : ' 1=1 ';

				$ret = self::consultRetForChanet($where, $start, $len);
				break;

			case CPSConfig::$providerWeiyi: //Ψһ
				$where = " `is_vat_invoice` = 0
								AND `cookie_time` < (UNIX_TIMESTAMP(`order_create_time`)+86400)
								AND `order_create_time` > '{$params['starttime']}'
								AND `order_create_time` < '{$params['endtime']}' ";

				$ret = self::consultRetForWeiyi($where, $start, $len);
				break;

			case CPSConfig::$provider51bigou: //51�ȹ�
				$where = " `is_vat_invoice` = 0
								AND `cookie_time` < (UNIX_TIMESTAMP(`order_create_time`)+86400)
								AND `order_create_time` > '{$params['starttime']}'
								AND `order_create_time` < '{$params['endtime']}' ";

				$ret = self::consultRetFor51bigou($where, $start, $len);
				break;

			case CPSConfig::$provider51fanli: //51����
				if (is_null($where)) { //��ѯ�ӿڵ���
					$params['begin_date'] = str_replace(array('-', ':', ' '), '', $params['begin_date']);
					$params['end_date'] = str_replace(array('-', ':', ' '), '', $params['end_date']);

					if (strlen($params['begin_date']) < 6 || strlen($params['end_date']) < 6) { //param error
						Logger::err('ICPS Consult Failed, param error.');
						$ret = array();
					}
					else {
						$time_inteval = intval(substr($params['begin_date'], 0, 8)) - intval(substr($params['end_date'], 0, 8)); //������룬�����������log�б���
						if ($time_inteval > 10) {
							Logger::warn("51fanli WARNED, inteval is {$time_inteval}.");
						}

						$params['begin_date'] = strlen($params['begin_date']) < 14 ? str_pad($params['begin_date'], 14, '0') : substr($params['begin_date'], 0, 14);
						$params['end_date'] = strlen($params['end_date']) < 14 ? str_pad($params['end_date'], 14, '9') : substr($params['end_date'], 0, 14);

						if (intval($params['type']) == 1) { //��ѯ�ӿ�1
							$where = " `is_vat_invoice` = 0
									AND `cookie_time` < (UNIX_TIMESTAMP(`order_create_time`)+86400)
									AND `order_create_time` > '{$params['begin_date']}'
									AND `order_create_time` < '{$params['end_date']}' ";
							$ret = self::consuleRerFor51fanli($where, $start, $len);
						}
						else { //��ѯ�ӿ�2
							$where = "`name` like '%@51fanli'
									AND `is_vat_invoice` = 0
									AND `cookie_time` < (UNIX_TIMESTAMP(`order_create_time`)+86400)
									AND `order_create_time` > '{$params['begin_date']}'
									AND `order_create_time` < '{$params['end_date']}' ";
							$ret = self::consuleRerFor51fanli($where, $start, $len);
						}
					}
				}
				else { //�ű�����
					$ret = self::consuleRerFor51fanli($where, $start, $len);
				}
				break;
			case CPSConfig::$provider163Youdao: //�����е� add by wheelswang
				$condition = "`order_create_time` >= '{$params['sd']}000000' AND `order_create_time` <= '{$params['ed']}235959'";
				if($where)
					$where .= ' AND '.$condition;
				else 
					$where = $condition;
				$ret = self::consuleRerFor163Youdao($where, $start, $len);
				break;
			default:
				self::setERR(400, '�Ҳ�����CPS�ṩ�̶�Ӧ�Ĵ�����');
				break;
		}

		return $ret;
	}

	/**
	 * ���صĽ����
	 * @param array $param CPS ���� [QQCB ����Ҫ]
	 * @param string $table ����
	 * @param string $where ��������
	 * @return array �ҵ�CPS������������Ҫ����Ʒ���۸���Ϣ
	 */
	private static function consultRetForQQCB($where=null, $start=0, $len=1000) {
		self::clearERR();

		$ret = array();

		$cpsOrders = ICPSDao::getRows('t_cps_order_qqcb', '*', $where, $start, $len);
		if ($cpsOrders === false) {
			self::setERR(400, 'fetch QQCB consult result failed');
			return false;
		}
		else if (count($cpsOrders) == 0) {
			return $ret;
		}

		//else
		$orderPushTime = date('YmdHis', time());

		foreach ($cpsOrders as &$cpsOrder) {
			$orderTotalAmount = $cpsOrder['order_total_amount'];
			$orderPayAmount = $cpsOrder['order_pay_amount'];
			$orderCommAmount = ($cpsOrder['is_vat_invoice'] == '1') ? 0 : $cpsOrder['order_comm_amount']; //��Ʊ����������
			$orderCreateTime = str_replace(array('-', ' ', ':'), '', $cpsOrder['order_create_time']);
			$orderModifyTime = str_replace(array('-', ' ', ':'), '', $cpsOrder['order_modify_time']);
			$paymentType = self::convertPaymentTypeForQQCB($cpsOrder['wh_id'], $cpsOrder['payment_type']);

			$products = ($cpsOrder['is_vat_invoice'] == '1') ? '' : self::getProductsByOrderForQQCB($cpsOrder['uid'], $cpsOrder['order_id']);
			$productsJSON = (false === $products) ? '' : str_replace(array("/r", "/n"), '', json_encode($products));

			$vkey = self::getOrderVKeyForQQCB(
							$cpsOrder['attach'],
							$cpsOrder['open_id'],
							$orderCommAmount,
							$orderCreateTime,
							$cpsOrder['order_id'],
							$orderModifyTime,
							$orderPayAmount,
							$orderPushTime,
							$cpsOrder['order_status'],
							$orderTotalAmount,
							$paymentType
						);

			$ret[$cpsOrder['order_id']] = array(
				'sysno' => $cpsOrder['sysno'],
				'merchant_id' => CPSConfig::$providerList[CPSConfig::$providerQQCB]['merchant_id'],
				'open_id' => $cpsOrder['open_id'],
				'order_id' => $cpsOrder['order_id'],
				'order_status' => $cpsOrder['order_status'],
				'order_desc' => "51buy.com - {$cpsOrder['order_id']}",
				'order_total_amount' => $orderTotalAmount,
				'order_pay_amount' => $orderPayAmount,
				'order_comm_amount' => $orderCommAmount,
				'payment_type' => $paymentType,
				'products' => $productsJSON,
				'order_create_time' => $orderCreateTime,
				'order_modify_time' => $orderModifyTime,
				'order_push_time' => $orderPushTime,
				'attach' => $cpsOrder['attach'],
				'vkey' => $vkey,
			);
		}

		return $ret;
	}

	/**
	 * ���صĽ����
	 * @param array $param CPS ����
	 * array(
	 *	 'yyyymmdd' => 20110101
	 * )
	 * @param int $start ��ʼ��
	 * @param int $len ������
	 * @return array �ҵ�CPS������������Ҫ����Ʒ���۸���Ϣ
	 */
	private static function consultRetForLinktech($where=null, $start=0, $len=1000) {
		self::clearERR();

		$cpsOrders = ICPSDao::getRows(
			't_cps_order_linktech',
			'*',
			$where,
			$start,
			$len
		);
		if ($cpsOrders === false) {
			Logger::err('get cps records FAILED for linktech: ' . ICPSDao::$errMsg);
			self::setERR(ICPSDao::$errCode, ICPSDao::$errMsg);
			return false;
		}

		$orderRets = array();
		$sep = CPSConfig::$providerList[CPSConfig::$providerLinktech]['sep'];
		$nl = CPSConfig::$providerList[CPSConfig::$providerLinktech]['newline'];
		foreach ($cpsOrders as $cpsOrder) {
			list($day, $time) = explode(' ', $cpsOrder['order_create_time']);
			$cpsOrder['order_time'] = str_replace(':', '', $time);
			$cpsOrder['type'] = self::convertPaymentTypeForLinktech($cpsOrder['order_pay_amount']);
			$cpsOrder['order_pay_amount'] = $cpsOrder['order_pay_amount'] / 100;

			$orderRets[] = 2 . $sep . $cpsOrder['order_time'] . $sep . $cpsOrder['cookie_info'] . $sep
				. $cpsOrder['order_id'] . $sep . 1 . $sep . $cpsOrder['uid'] . $sep . 1 . $sep
				. $cpsOrder['order_pay_amount'] . $sep . $cpsOrder['type'] . $sep . $cpsOrder['order_status'] . $nl;
				//2 ��Ϊ��CPSҵ��(ժ��������ĵ�)
		}

		return $orderRets;
	}

	/**
	 * ���صĽ����
	 * @param array $params CPS ����
	 * array(
	 *	 'src' => donot care
	 *	 'cid' => xxx
	 *	 'd' => 20110101
	 * )
	 * @param int $start ��ʼ��
	 * @param int $len ������
	 * @return array �ҵ�CPS������������Ҫ����Ʒ���۸���Ϣ
	 */
	private static function consultRetForYiqifa($where=null, $start=0, $len=1000) {
		self::clearERR();

		$cpsOrders = ICPSDao::getRows(
			't_cps_order_yiqifa',
			'*',
			$where,
			$start,
			$len
		);
		if ($cpsOrders === false) {
			Logger::err('get cps records FAILED for Yiqifa: ' . ICPSDao::$errMsg);
			self::setERR(ICPSDao::$errCode, ICPSDao::$errMsg);
			return false;
		}

		$sep = CPSConfig::$providerList[CPSConfig::$providerYiqifa]['sep'];
		$nl = CPSConfig::$providerList[CPSConfig::$providerYiqifa]['newline'];

		$orderRets = array();
		foreach ($cpsOrders as &$cpsOrder) {
			$cpsOrder['order_pay_amount'] = $cpsOrder['order_pay_amount'] / 100;
			$orderRets[] = $cpsOrder['wi'] . $sep . $cpsOrder['order_create_time'] . $sep . $cpsOrder['order_id'] . $sep . 1 . $sep
			 . 1 . $sep . 1 . $sep . $cpsOrder['order_pay_amount'] . $nl;
		}

		return $orderRets;
	}

	/**
	 * ���صĽ����
	 * @param array $params CPS ����
	 * array(
	 *	 'src' => donot care
	 *	 'cid' => xxx
	 *	 'd' => 20110101
	 * )
	 * @param int $start ��ʼ��
	 * @param int $len ������
	 * @return array �ҵ�CPS������������Ҫ����Ʒ���۸���Ϣ
	 */
	private static function consultRetForChanet($where=null, $start=0, $len=1000) {
		self::clearERR();

		$cpsOrders = ICPSDao::getRows(
			't_cps_order_chanet',
			'*',
			$where,
			$start,
			$len
		);
		if ($cpsOrders === false) {
			Logger::err('get cps records FAILED for chanet: ' . ICPSDao::$errMsg);
			self::setERR(ICPSDao::$errCode, ICPSDao::$errMsg);
			return false;
		}

		$orderRets = array();
		$sep = CPSConfig::$providerList[CPSConfig::$providerChanet]['sep'];
		$nl = CPSConfig::$providerList[CPSConfig::$providerChanet]['newline'];

		foreach ($cpsOrders as &$cpsOrder) {
			$order_items = IOrder::getOrderItems($cpsOrder['uid'], $cpsOrder['order_id']);
			if ($order_items === false) {
				Logger::err("get {$cpsOrder['order_id']} order_items FAILED");
				continue;
			}
			//else
			foreach ($order_items as &$item) {
				if ($item['isCouponProduct']) { //�ؼ���Ʒ������
					continue;
				}
				else {
					$price = $item['price'] / 100;
					$orderRets[] = $cpsOrder['order_create_time']
										. $sep . $cpsOrder['click_id']
										. $sep . $cpsOrder['order_id']
										. $sep . self::convertProductTypeForChanet($item['price'])
										. $sep . $item['buy_num']
										. $sep . $price
										. $sep . mb_convert_encoding($item['name'], 'UTF-8', 'GB2312')
										. $sep . self::convertPaymentTypeForChanet($cpsOrder['wh_id'], $cpsOrder['payment_type'])
										. $sep . self::convertOrderStatusForChanet($cpsOrder['order_status'])
										. $nl;
				}
			}
		}

		return $orderRets;
	}

	/**
	 * ���صĽ����
	 * @param array $params CPS ����
	 * @param int $start ��ʼ��
	 * @param int $len ������
	 * @return array �ҵ�CPS������������Ҫ����Ʒ���۸���Ϣ
	 *
	 * @tutorial ��weiyi������ͨ�Ľ�������� icson ��֧����ʽ���Զ����۸�Ϊ���ݣ���
	 * pid ����Ҫ��ֵ�ˣ�
	 * ptype �ɶ�����ȷ����
	 * pnum �ܴ� 1��
	 * price Ϊ�����ۣ���ԪΪ��λ��
	 */
	private static function consultRetForWeiyi($where=null, $start=0, $len=1000) {
		self::clearERR();

		$cpsOrders = ICPSDao::getRows(
			't_cps_order_weiyi',
			'*',
			$where,
			$start,
			$len
		);
		if ($cpsOrders === false) {
			Logger::err('get cps records FAILED for weiyi: ' . ICPSDao::$errMsg);
			self::setERR(ICPSDao::$errCode, ICPSDao::$errMsg);
			return false;
		}

		$orders = array();
		$orderRets = array();
		$sep = CPSConfig::$providerList[CPSConfig::$providerWeiyi]['sep'];
		$nl = CPSConfig::$providerList[CPSConfig::$providerWeiyi]['newline'];

		foreach ($cpsOrders as &$cpsOrder) {
			$price = floor($cpsOrder['order_pay_amount'] / 100); //��ȥ�˷�
			$orderRets[] = $cpsOrder['order_create_time'] //order_date
							. $sep . $cpsOrder['cid'] //cid
							. $sep . $cpsOrder['uid'] //uid
							. $sep . $cpsOrder['order_id'] //order_id
							. $sep . '' //pid ��Ϊ ��
							. $sep . self::convertPaymentTypeForWeiyi($cpsOrder['order_pay_amount']) //ptype ���� order[cash] ���
							. $sep . 1 //product_num ��Ʒ���� ��Ϊ 1
							. $sep . $price
							. $sep . self::convertOrderStatusForWeiyi($cpsOrder['order_status'])
							. $nl;
		}

		return $orderRets;
	}

	/**
	 * ����51�ȹ���Ҫ�Ľ����
	 * @param string $where ��ѯ����
	 * @param int $start ��ʼ��
	 * @param int $len ������
	 * @return array �ҵ�CPS������������Ҫ����Ʒ���۸���Ϣ
	 */
	private static function consultRetFor51bigou($where=null, $start=0, $len=1000) {
		self::clearERR();

		$cpsOrders = ICPSDao::getRows(
			't_cps_order_51bigou',
			'*',
			$where,
			$start,
			$len
		);
		if ($cpsOrders === false) {
			Logger::err('get cps records FAILED for 51bigou: ' . ICPSDao::$errMsg);
			self::setERR(ICPSDao::$errCode, ICPSDao::$errMsg);
			return false;
		}

		$orders = array();
		$orderRets = array();
		$sep = CPSConfig::$providerList[CPSConfig::$provider51bigou]['sep'];
		$nl = CPSConfig::$providerList[CPSConfig::$provider51bigou]['newline'];

		foreach ($cpsOrders as &$cpsOrder) {
			$price = ($cpsOrder['order_pay_amount']) / 100;
			$commision = self::getCommAmountFor51bigou($cpsOrder['order_pay_amount']);
			$orderRets[] = $cpsOrder['order_create_time'] //order_date
							. $sep . $cpsOrder['order_id'] //order_id
							. $sep . $cpsOrder['u_id'] //u_id - cookie �б���� u_id
							. $sep . $price //�����۸�
							. $sep . $commision //Ӷ��
							. $nl;
		}

		return $orderRets;
	}

	/**
	 * ����51������Ҫ�Ľ����
	 * @param string $where ��ѯ����
	 * @param int $start ��ʼ��
	 * @param int $len ������
	 * @return array �ҵ�CPS������������Ҫ����Ʒ���۸���Ϣ
	 */
	public static function consuleRerFor51fanli($where=null, $start=0, $len=1000) {
		self::clearERR();

		$cpsOrders = ICPSDao::getRows(
			't_cps_order_51fanli',
			'*',
			$where,
			$start,
			$len
		);
		if ($cpsOrders === false) {
			Logger::err('get cps records FAILED for 51fanli: ' . ICPSDao::$errMsg);
			self::setERR(ICPSDao::$errCode, ICPSDao::$errMsg);
			return false;
		}

		$ret = array();
		foreach ($cpsOrders as &$cpsOrder) {
			if ($cpsOrder['is_vat_invoice'] == '1') { //��˰��Ʊ������Լ��������
				continue;
			}

			$order_ret['sysno'] = $cpsOrder['sysno']; //�ű���Ҫ
			$order_ret['order_id'] = $cpsOrder['order_id']; //�ű���Ҫ

			$order_ret['order_no'] = $cpsOrder['order_id'];
			$order_ret['order_time'] = $cpsOrder['order_create_time'];
			$order_ret['shop_no'] = CPSConfig::$providerList[CPSConfig::$provider51fanli]['shop_no'];
			$order_ret['shop_key'] = CPSConfig::$providerList[CPSConfig::$provider51fanli]['shop_key'];

			$order_ret['total_price'] = $cpsOrder['order_pay_amount'] / 100; //ת������λ"Ԫ"
			$order_ret['total_qty'] = 0; // ��ʼΪ0

			$order_ret['u_id'] = $cpsOrder['u_id'];
			$order_ret['username'] = $cpsOrder['name'];
			$order_ret['is_pay'] = (intval($cpsOrder['order_status']) == 10) ? 1 : 0;
			$order_ret['pay_type'] = $cpsOrder['payment_type'];
			$order_ret['order_status'] = (intval($cpsOrder['order_status']) == 10) ? 5 : $cpsOrder['order_status']; //5 ���ջ�

			$order_ret['deli_name'] = '';
			$order_ret['deli_no'] = '';

			$order_ret['tracking_code'] = $cpsOrder['tracking_code'];
			$order_ret['pass_code'] = md5(strtolower("{$order_ret['order_no']}{$order_ret['shop_no']}{$order_ret['u_id']}{$order_ret['shop_key']}"));

			$order_ret['product_all'] = array();
			$order_items = IOrder::getOrderItems($cpsOrder['uid'], $cpsOrder['order_id']);
			if ($order_items === false) {
				Logger::err("IOrder::getOrderItems failed, code:" . IOrder::$errCode . ', msg:' . IOrder::$errMsg);
				continue;
			}

			foreach ($order_items as &$item) {
				$order_ret['product_all'][$item['product_id']]['product_id'] = $item['product_id'];
				$order_ret['product_all'][$item['product_id']]['product_url'] = "http://item.icson.com/item-{$item['product_id']}.html";
				$order_ret['product_all'][$item['product_id']]['product_qty'] = $item['buy_num'];
				$order_ret['product_all'][$item['product_id']]['product_price'] = $item['price'] / 100;
				$order_ret['product_all'][$item['product_id']]['product_comm'] = 0;
				$order_ret['product_all'][$item['product_id']]['comm_no'] = ($item['isCouponProduct'] == '1') ? 'CouponProduct' : ''; //CouponProduct Ϊ ˫��Լ�����

				$order_ret['total_qty'] += $item['buy_num']; // total_qty Ϊ�������Ʒ����
			}
//			$order_ret['coupons_all'] = array(); //ȥ�� coupons_all �ڵ�

			array_push($ret, $order_ret);
		}

		return $ret;
	}
	/**
	 * ���������е�cps��������
	 * @param string $where ��ѯ����
	 * @return array ���ض�����Ϣ��ʵʱ��ѯ����״̬
	 */
	public static function consuleRerFor163Youdao($where, $start = 0, $len = 10000) {
		self::clearERR();

		$cpsOrders = ICPSDao::getRows(
			't_cps_order_163youdao',
			'*',
			$where,
			$start,
			$len
		);
		if ($cpsOrders === false) {
			Logger::err('get cps records FAILED for 163youdao: ' . ICPSDao::$errMsg);
			self::setERR(ICPSDao::$errCode, ICPSDao::$errMsg);
			return false;
		}
		return $cpsOrders;
	}
	/**
	 * ת����51fanli��Ҫ��XML��ʽ
	 * @param array $orders ƴװ�õĶ��������Ϣ
	 * @return string XML����
	 */
	public static function convertToXMLFor51fanli($orders) {
		$ret = false;
		if (is_array($orders) && count($orders) > 0) {
			$ret = "<fanli_data version='3.0'>\n";

			foreach($orders as &$order) {
				$ret .= "<order order_time='{$order['order_time']}' order_no='{$order['order_no']}' shop_no='{$order['shop_no']}' shop_key='{$order['shop_key']}' total_price='{$order['total_price']}'";
				$ret .= " total_qty='{$order['total_qty']}' u_id='{$order['u_id']}' username='{$order['username']}' is_pay='{$order['is_pay']}' pay_type='{$order['pay_type']}'";
				$ret .= " order_status='{$order['order_status']}' deli_name='{$order['deli_name']}' deli_no='{$order['deli_no']}' tracking_code='{$order['tracking_code']}' pass_code='{$order['pass_code']}'>\n";

				$ret .= "<products_all>\n";
				if (is_array($order['product_all']) && count($order['product_all']) > 0) {
					foreach ($order['product_all'] as $pid => &$product_info) {
						$ret .= "<product>
		<product_id>{$product_info['product_id']}</product_id>
		<product_url>{$product_info['product_url']}</product_url>
		<product_qty>{$product_info['product_qty']}</product_qty>
		<product_price >{$product_info['product_price']}</product_price>
		<product_comm>{$product_info['product_comm']}</product_comm>
		<comm_no>{$product_info['comm_no']}</comm_no>
	</product>\n";
					}
				}
				$ret .= "</products_all>\n";

				$ret .= "<coupons_all>\n";
				if (isset($order['coupons_all']) && is_array($order['coupons_all']) && count($order['coupons_all']) > 0) {
					foreach ($order['coupons_all'] as &$coupon_info) {
						$ret .= "<coupon>
		<coupon_no>{$coupon_info['coupon_no']}</coupon_no>
		<coupon_qty>{$coupon_info['coupon_qty']}</coupon_qty>
		<coupon_price>{$coupon_info['coupon_price']}</coupon_price>
		<comm_no>{$coupon_info['comm_no']}</comm_no>
	</coupon>\n";
					}
				}
				$ret .= "</coupons_all>\n";
				$ret .= "</order>\n";
			}
			$ret .= '</fanli_data>';
		}

		return $ret;
	}
	/**
	 * ����������ת����CSV��ʽ
	 * @param array $order
	 * @return string CSV��Ϣ
	 * add by wheelswang
	 */
	public static function convertToCSVFor163Youdao($orders) {
		$ret = "�������,״̬,�û�ID,�µ�ʱ��,��Ч���\n";
		foreach($orders as $order) {
			$order['order_pay_amount'] /= 100;
			$order['order_pay_amount'] = sprintf('%.2f',$order['order_pay_amount']);
			$ret .= "{$order['order_id']},{$order['order_status']},{$order['user_id']},{$order['order_create_time']},{$order['order_pay_amount']}\n";
		}
		return $ret;
	}
	/**
	 * ���صĽ����
	 * @param string $where
	 * @param int $start ��ʼ��
	 * @param int $len ������
	 * @return array �ҵ�CPS������������Ҫ����Ʒ���۸���Ϣ
	 */
	private static function consultRetForSHCar($where=null, $start=0, $len=1000) {
		self::clearERR();

		$cpsOrders = ICPSDao::getRows(
			't_cps_order_shcar',
			'*',
			$where,
			$start,
			$len
		);
		if ($cpsOrders === false) {
			Logger::err('get cps records FAILED for shcar: ' . ICPSDao::$errMsg);
			self::setERR(ICPSDao::$errCode, ICPSDao::$errMsg);
			return false;
		}

		return $cpsOrders;
	}

	/**
	 * ��Ѹ��֧������ת�����ʱ���֧������
	 * @param string $whid ����ID
	 * @param string $paymentType ��Ѹ��֧������
	 * @return string �ʱ���֧������
	 */
	private static function convertPaymentTypeForQQCB($whid, $paymentType) {
		global $_PAY_TYPE_VIA;

		$paymentType = isset($_PAY_TYPE_VIA[$whid])
			? (isset($_PAY_TYPE_VIA[$whid][$paymentType])
				? (isset($_PAY_TYPE_VIA[$whid][$paymentType][CPSConfig::$providerQQCB]) ? $_PAY_TYPE_VIA[$whid][$paymentType][CPSConfig::$providerQQCB] : false)
				: false)
			: false;

		return ($paymentType) ? $paymentType : 'others';
	}

	/**
	 * ��Ѹ����Ʒ���ת�����ʱ�����Ʒ���
	 * @param string $productId ��Ѹ����ƷID
	 * @return string �ʱ�����Ʒ���
	 */
	private static function convertProductTypeForQQCB($product_id) {
		$product_base_info = IProduct::getBaseInfo($product_id);
		$c2_ret = ICategoryTTC::get($product_base_info['c3_ids'], array('level'=>3));
		$c1_ret = ICategoryTTC::get($c2_ret[0]['parent_id'], array('level'=>2));
		return CPSConfig::$providerList[CPSConfig::$providerQQCB]['productTypeMap'][$c1_ret[0]['parent_id']];
	}

	/**
	 * ���QQ�ʱ���Ҫ�� products json ����
	 * @param string $orderId ����ID
	 * @param array $dbInfo �ֿ�ֱ����
	 * @return mixed array; false
	 */
	private static function getProductsByOrderForQQCB($uid, $order_id) {
		$ret = array();

		$order_items = IOrder::getOrderItems($uid, $order_id);
		foreach ($order_items as &$item) {
			if ($item['isCouponProduct']) { //�ؼ���Ʒ������
				continue;
			}
			else {
				$item['product_type'] = self::convertProductTypeForQQCB($item['product_id']); //��Ʒ����ת��
				$ret[$item['product_type']] = array(
					'Id' => $item['product_id'],
					'Name' => mb_convert_encoding(mb_substr($item['name'], 0, 20, 'GB2312'), 'UTF-8', 'GB2312'),
					'Count' => intval($item['buy_num']),
					'PerPrice' => floatval($item['price']),
				);
			}
		}

		return $ret;
	}

	/**
	 * ����ʵ����Ҫ֧����QQCB�Ľ��
	 * @param int $price �����ܼ�
	 * @return int Ӷ��
	 */
	public static function getCommAmountForQQCB($price, $loginFromQQCB=false) { //Ĭ�ϲ��ǲʱ���¼��comm�۸��һЩ
		$ret = 0;
		$priceMap = $loginFromQQCB
			? CPSConfig::$providerList[CPSConfig::$providerQQCB]['priceMapPromo']
			: CPSConfig::$providerList[CPSConfig::$providerQQCB]['priceMapVIP'];

		foreach ($priceMap as $priceInfo) {
			if ($priceInfo['min'] <= $price) {
				if (empty($priceInfo['max']) || ((!empty($priceInfo['max'])) && $price<= $priceInfo['max'])) {
					$ret = $priceInfo['commision'];
					break;
				}
			}
		}

		return $ret;
	}

	/**
	 * ����״̬ת��
	 * @param string $source CPS �ṩ��
	 * @param int $status ����״̬
	 * @param array $cpsOrder CPS������Ϣ
	 * @return mixed string ��Ӧ����״̬ / false û�ҵ���Ӧ��״̬
	 */
	public static function convertOrderStatus($source, $status, $cpsOrder) {
		$ret = false;

		switch ($source) {
			case CPSConfig::$providerSHCar:
				$ret = $status; //�����Ķ���״̬��ת��
				break;

			case CPSConfig::$providerQQCB:
				$ret = self::convertOrderStatusForQQCB($status);
				break;

			case CPSConfig::$providerQQTuan:
				$ret = IQQTuan::convertOrderStatus($status, $cpsOrder);
				break;

			case CPSConfig::$providerLinktech:
				$ret = self::convertOrderStatusForLinktech($status);
				break;

			case CPSConfig::$providerYiqifa:
				$ret = self::convertOrderStatusForYiqifa($status);
				break;

			case CPSConfig::$providerChanet:
				$ret = self::convertOrderStatusForChanet($status);
				break;

			case CPSConfig::$providerWeiyi:
				$ret = self::convertOrderStatusForWeiyi($status);
				break;

			case CPSConfig::$provider51bigou:
				$ret = self::convertOrderStatusFor51bigou($status);
				break;

			case CPSConfig::$provider51fanli:
				$ret = self::convertOrderStatusFor51fanli($status);
				break;
			case CPSConfig::$provider163Youdao:
				$ret = self::convertOrderStatusFor163Youdao($status, $cpsOrder);// add by wheelswang
				break;
			default:
				break;
		}

		return $ret;
	}

	/**
	 * icson ����״̬�� QQCB ��ӳ���ϵ
	 * @param int $status icson����״̬
	 * @return int QQCB �涨�Ķ���״̬
	 */
	public static function convertOrderStatusForQQCB($status) {
		switch ($status) {
			case -5: //�����˻�
			case -4: //ȫ���˻�
			case -3: //��������
			case -2: //�ͻ�����
			case -1: //Ա������
				return '21'; //��������

			case 0: //�����
			case 1: //������
			case 2: //��֧��
			case 3: //��������
				return '10'; //�û����µ�

			case 4: //�ѳ���
				return '11'; //�̻��ѷ���

			default:
				return false; //�޶�Ӧֵ
		}
	}

	/**
	 * icson ����״̬�� Linktech ��ӳ���ϵ
	 * @param int $status icson����״̬
	 * @return int Linktech �涨�Ķ���״̬
	 */
	public static function convertOrderStatusForLinktech($status) {
		switch ($status) {
			case -5: //�����˻�
			case -4: //ȫ���˻�
			case -3: //��������
			case -2: //�ͻ�����
			case -1: //Ա������
				return 300; //��������

			case 0: //�����
			case 1: //������
			case 2: //��֧��
			case 3: //��������
			case 4: //�ѳ���
				return 100; //����������

			default:
				return false; //�޶�Ӧֵ
		}
	}

	/**
	 * icson ����״̬�� Linktech ��ӳ���ϵ
	 * @param int $status icson����״̬
	 * @return int Linktech �涨�Ķ���״̬
	 */
	public static function convertOrderStatusForYiqifa($status) {
		switch ($status) {
			case -5: //�����˻�
			case -4: //ȫ���˻�
			case -3: //��������
			case -2: //�ͻ�����
			case -1: //Ա������
				return 2; //�˵�

			case 0: //�����
			case 1: //������
			case 2: //��֧��
			case 3: //��������
			case 4: //�ѳ���
				return 0; //����������

			default:
				return false; //�޶�Ӧֵ
		}
	}

	/**
	 * icson ����״̬�� weiyi ��ӳ���ϵ
	 * @param int $status icson����״̬
	 * @return int weiyi �涨�Ķ���״̬
	 */
	public static function convertOrderStatusForWeiyi($status) {
		switch ($status) {
			case -5: //�����˻�
			case -4: //ȫ���˻�
			case -3: //��������
			case -2: //�ͻ�����
			case -1: //Ա������
				return 2; //weiyi �˶���Ч

			case 0: //�����
			case 1: //������
			case 2: //��֧��
			case 3: //��������
			case 4: //�ѳ���
				return 0; //weiyi δ�˶�

			default:
				return false; //�޶�Ӧֵ
		}
	}

	/**
	 * icson ����״̬�� 51fanli ��ӳ���ϵ, ��Ӷ���״̬ 10 ��ʾ 51fanli ������ is_pay (��֧��)
	 * @param int $status icson����״̬
	 * @return int weiyi �涨�Ķ���״̬
	 */
	public static function convertOrderStatusFor51fanli($status) {
		switch ($status) {
			case -5: //�����˻�
				return 6; //51fanli �����˻�

			case -4: //ȫ���˻�
				return 7; //51fanli ȫ���˻�

			case -3: //��������
			case -2: //�ͻ�����
			case -1: //Ա������
				return -1; //51fanli ȡ������

			case 0: //�����
			case 3: //��������
				return 1; //51fanli �����

			case 1: //������
				return 3; //51fanli ������

			case 4: //�ѳ���
				return 4; //51fanli ������

			case 2: //��֧��
			default:
				return false; //�޶�Ӧֵ
		}
	}

	/**
	 * icson ����״̬�� 51bi ��ӳ���ϵ
	 * @param int $status icson����״̬
	 * @return int 51bi �涨�Ķ���״̬
	 */
	public static function convertOrderStatusFor51bigou($status) {
		switch ($status) {
			case -5: //�����˻�
			case -4: //ȫ���˻�
			case -3: //��������
			case -2: //�ͻ�����
			case -1: //Ա������

			case 0: //�����
			case 1: //������
			case 2: //��֧��
			case 3: //��������
			case 4: //�ѳ���

			default:
				return false; //51�ȹ����ĵ���û������Ҫ���ض���״̬
		}
	}
	/**
	 * icson ����״̬�� �����е� ��ӳ���ϵ ������ͨ������Ҫӳ�䣬ֱ�ӷ���
	 * @param int $status icson����״̬
	 * @return int 163Youdao �涨�Ķ���״̬
	 */
	
	public static function convertOrderStatusFor163Youdao($status) {
		return $status;
	}
	/**
	 * ����orderId��鶩���� cpsinfo �ֶ��Ƿ�Ϊ�գ������Ϊ�գ��ټ���Ƿ��ܽ�������Ӧ�� cookie ��Ϣ�����ݽ������� cookie ��Ϣ���н������Ĳ�����
	 *
	 * @tutorial �� link �ķ�ʽ���Ͷ������ݣ�ֻ���µ��ɹ�֮���ȷ��ҳ�����ԣ���Щ�����ǹ̶��ġ����磺����״̬���ǳ�ʼ�ġ�
	 * @param string $uid �û�ID.
	 * @param string $orderId ����ID.
	 * @param sring $append ���� CPS �ṩ�̵�ַ
	 * @return array ������Ϣ
	 */
	public static function convertCPSOrderToLink($uid, $orderId, $append=false) {
		self::clearERR();

		$ret = false;

		$order = IOrder::getOneOrder($uid, $orderId);
		if ($order === false) {
			self::setERR(500, "get order {$orderId} FAILED.");
			return false; //δ�ҵ�����
		}
		if (empty($order['cpsinfo'])) {
			self::setERR(404, "order {$orderId} isnot cps order.");
			return ''; //���� cps ����
		}

		$cpsCookie = self::unpackCookie($order['cpsinfo']); //�����������м�¼�� cps cookie ��Ϣ

		if (is_array($cpsCookie) && count($cpsCookie) > 0) { //�����ɹ�
			$source = array_pop(array_keys($cpsCookie));
			$cookieInfo = array_pop(array_values($cpsCookie));

			//�˴�֮�£�����ʹ�õı��������� $order, $uid �� cps �������ʱ��¼�� cookie
			if (array_key_exists($source, CPSConfig::$providerList)) {
				//��QQCB �⣬����ֻ�Ƶ�һ�충��
				if ($order['order_date'] > $cookieInfo['cookie_time'] && $order['order_date'] <= ($cookieInfo['cookie_time'] + 86400)) { //cookie ʱ�������
					$order_items = IOrder::getOrderItems($uid, $orderId);
					if ($order_items === false) {
						self::setERR(501, "get order_items {$orderId} FAILED, " . IOrder::$errCode . '-' . IOrder::$errMsg);
						return false; //δ�ҵ�����
					}

					$cpsOpder = self::getOneCPSOrder($source, $order['order_char_id']);
					if (false === $cpsOpder || empty($cpsOpder)) {
						self::setERR(502, "get cpsOrder {$order['order_char_id']} FAILED, " . self::$errCode . '-' . self::$errMsg);
						return false; //δ�ҵ�cps����
					}
					else {
						switch ($source) {
							case CPSConfig::$providerLinktech:
								if ($cpsOpder['is_vat_invoice'] == '1') {
									$order['cash'] = 0;
								}
								else {
									$order['cash'] = $cpsOpder['order_pay_amount'];
								}
								$type = self::convertPaymentTypeForLinktech($order['cash']); //�ö�����linktech������
								$order['cash'] = ($order['cash'] == 0) ? 0 : ($order['cash'] / 100);

								$ret = "a_id={$cookieInfo['cookie']}"
										. "&m_id=" . CPSConfig::$providerList[CPSConfig::$providerLinktech]['merchant_id']
										. "&mbr_id={$uid}"
										. "&o_cd={$orderId}"
										. "&p_cd=1" //Լ��
										. "&it_cnt=1" //Լ��
										. "&price={$order['cash']}"
										. "&c_cd={$type}";
								$ret = $append ? CPSConfig::$providerList[CPSConfig::$providerLinktech]['syncURL'] . "?{$ret}" : $ret;
							break;

							case CPSConfig::$providerYiqifa:
								$sd = urlencode(date('Y-m-d H:i:s', $order['order_date']));

								//�����𷢼�����ͨ�Ľ�����������ù�ȥ�ķ�ʽ��
								//����Ʒ��š���Ϊ�գ�
								//����Ʒ���͡�Ϊ�������ͣ�1 [�ɹ�����]��2 [�˵�]������ʵ�ϴ��Ķ���1��Ȼ�����¶Ե�
								//����Ʒ������Ϊ 1��
								//����Ʒ���ۡ�Ϊ����ʵ��֧���۸�
								//���µ�ʱ�䡱Ϊ��������ʱ��

								//���� syncURL �������� query ����
								$cpsOpder = self::getOneCPSOrder($source, $order['order_char_id']);
								$order['cash'] = ($cpsOpder['is_vat_invoice'] == '1') ? 0 : ($cpsOpder['order_pay_amount'] / 100); //��ȥ�˷Ѻ��ؼ���Ʒ�۸�

								$ret = "cid={$cookieInfo['cid']}"
										. "&wi={$cookieInfo['wi']}"
										. "&on={$orderId}"
										. "&pn="
										. "&ct=1"
										. "&ta=1"
										. "&pp={$order['cash']}"
										. "&sd={$sd}";
								$ret = $append ? CPSConfig::$providerList[CPSConfig::$providerYiqifa]['syncURL'] . "?{$ret}" : $ret;
							break;

							case CPSConfig::$providerChanet:
								$productsStr = self::convertProductStrForChanet($uid, $order['order_char_id'], $order_items);
								if (false !== $productsStr) {
									//���� syncURL �������� query ����
									$ret = 't=' . CPSConfig::$providerList[CPSConfig::$providerChanet]['thanks_id']
											. '&sign=' . CPSConfig::$providerList[CPSConfig::$providerChanet]['sign']
											. "&i={$order['order_char_id']}"
											. "&id={$cookieInfo['click_id']}"
											. "&o={$productsStr}";
									$ret = $append ? CPSConfig::$providerList[CPSConfig::$providerChanet]['syncURL'] . "?{$ret}" : $ret;
								}
								else {
									self::setERR(503, "fetch none products for {$source}");
								}
							break;

							case CPSConfig::$providerWeiyi:
								$price = ($cpsOpder['is_vat_invoice'] == '1') ? 0 : $cpsOpder['order_pay_amount']; //��ȥ�˷Ѻ��ؼ���Ʒ�۸�
								$ptype = self::convertPaymentTypeForWeiyi($price); //�ö����� weiyi �������
								$price = $price / 100; //Ψһ���ԡ�Ԫ��Ϊ��λ

								//������������Ĳ���,д��ֻ��Ϊ�����
								//$mid = CPSConfig::$providerList[CPSConfig::$providerWeiyi]['merchant_id'];
								//$odate = date('YmdHis', $order['order_date']);
								//$cid = $cookieInfo['cid'];
								//$bid = $uid;
								//$oid = $order['order_char_id'];

								//��weiyi������ͨ�Ľ�������� icson ��֧����ʽ���Զ����۸�Ϊ���ݣ���
								//pid ����Ҫ��ֵ�ˣ�
								//ptype �ɶ�����ȷ����
								//pnum �ܴ� 1��
								//price Ϊ�����ۣ�

								//���� syncURL �������� query ����
								$ret = 'mid=' . CPSConfig::$providerList[CPSConfig::$providerWeiyi]['merchant_id']
										. '&odate=' . date('YmdHis', $order['order_date'])
										. "&cid={$cookieInfo['cid']}"
										. "&bid={$uid}"
										. "&oid={$order['order_char_id']}"
										. "&pid="
										. "&ptype={$ptype}"
										. "&pnum=1"
										. "&price={$price}"
										. "&ostat=0"; //ostat Ϊ��ʼ����״̬ 0

								$ret = $append ? CPSConfig::$providerList[CPSConfig::$providerWeiyi]['syncURL'] . "?{$ret}" : $ret;
							break;

							case CPSConfig::$provider51bigou:
								$cpsOpder = self::getOneCPSOrder($source, $order['order_char_id']);
								$ip = ($cpsOpder) ? $cpsOpder['ip'] : '0';
								$mcode = md5("{$cookieInfo['u_id']}{$order['order_char_id']}");

								$cost = ($cpsOpder['is_vat_invoice'] == '1') ? 0 : ($cpsOpder['order_pay_amount']); //��ȥ�˷�
								$commision = self::getCommAmountFor51bigou($cost);
								$cost = $cost / 100; //51bigou �ԡ�Ԫ��Ϊ��λ

								$ret = 'bid=' . CPSConfig::$providerList[CPSConfig::$provider51bigou]['merchant_id']
										. '&uid=' . $cookieInfo['u_id'] //���� $uid
										. "&oid={$order['order_char_id']}"
										. "&cost={$cost}"
										. "&cback={$commision}"
										. "&ip={$ip}"
										. "&mcode={$mcode}"; //ostat Ϊ��ʼ����״̬ 0

								$ret = $append ? CPSConfig::$providerList[CPSConfig::$provider51bigou]['syncURL'] . "?{$ret}" : $ret;
							break;

							default:
								$ret = ''; //����source ���跴��
						}
					}
				}
				else { //ͨ�� cookie �е�ʱ����ж����ǵ�һ��
					return '';
				}
			}
			else {
				self::setERR(504, "{$source} NOT Supported");
			}
		}
		else {
			self::setERR(505, "cpsinfo {$orderId} BROKEN"); //cpsinfo �ֶ��޷������Թ�����
		}

		return $ret;
	}

	/**
	 * ��Ѹ��֧������ת��������ص�֧�����ͣ��������ȷ�ϵĽ���ǣ�
	 * �������š���ÿ���������ա�ʵ�����ۡ�����������Ʒûʲô��ϵ
	 * @param int $price �������û�֧������
	 * @return string ����ص�֧������
	 */
	private static function convertPaymentTypeForLinktech($price) {
		$ret = false;
		$priceMap = CPSConfig::$providerList[CPSConfig::$providerLinktech]['orderType'];

		foreach ($priceMap as $priceInfo) {
			if ($priceInfo['min'] <= $price) {
				if (empty($priceInfo['max']) || ((!empty($priceInfo['max'])) && $price<= $priceInfo['max'])) {
					$ret = $priceInfo['type'];
					break;
				}
			}
		}

		return $ret;
	}

	/**
	 * �ɹ������ݡ���Ʒ�۸񡱱�ע����Ʒ���͡���
	 * @param int $price ��Ʒ����
	 */
	private static function convertProductTypeForChanet($price) {
		$ret = false;
		$priceMap = CPSConfig::$providerList[CPSConfig::$providerChanet]['productType'];

		foreach ($priceMap as $priceInfo) {
			if ($priceInfo['min'] <= $price) {
				if (empty($priceInfo['max']) || ((!empty($priceInfo['max'])) && $price<= $priceInfo['max'])) {
					$ret = $priceInfo['type'];
					break;
				}
			}
		}

		return $ret;
	}

	/**
	 * ת���� ���ɹ����� ��֧����ʽ��
	 * ��������				1
	 * ����֧��-֧����		2
	 * ����֧��-�Ƹ�ͨ		3
	 * ����֧��-��Ǯ		4
	 * ����֧��-����		5
	 * �ʾֻ��				6
	 * ����ת��				7
	 * ��ȯ֧��				8
	 * ����						9
	 * @param string $whid ����ID
	 * @param string $paymentType ��Ѹ��֧������
	 * @return int �ɹ�����֧����ʽ
	 */
	private static function convertPaymentTypeForChanet($whid, $paymentType) {
		global $_PAY_TYPE_VIA;

		$paymentType = isset($_PAY_TYPE_VIA[$whid])
			? (isset($_PAY_TYPE_VIA[$whid][$paymentType])
				? (isset($_PAY_TYPE_VIA[$whid][$paymentType][CPSConfig::$providerChanet]) ? $_PAY_TYPE_VIA[$whid][$paymentType][CPSConfig::$providerChanet] : false)
				: false)
			: false;

		return ($paymentType) ? $paymentType : 9;
	}

	/**
	 * ת���� ���ɹ����� �Ķ���״̬��
	 * ��֧��	1	�û��ɹ�֧��������������֧����ʽ��
	 * �ѷ���	2	�̼ҷ�����Ʒ
	 * ��ǩ��	3	�û��յ���ǩ����Ʒ
	 * ���˻�	4	�û��յ���Ʒ������˻�
	 * ��ȡ��	5	�û�֧���󣬵�δ�յ���Ʒʱ�����ȡ������
	 * �����	6	�û��յ���Ʒ�������˻��������ڣ��������
	 * ��Ʒȱ��	7	������Ʒȱ�����޷�����
	 * ��ƷԤ��	8	������Ʒ��Ԥ����Ʒ���޷�����
	 * @param string $status ����״̬
	 * @return int �ɹ����Ķ���״̬
	 */
	private static function convertOrderStatusForChanet($status) {
		switch ($status) {
			case -5: //�����˻�
			case -4: //ȫ���˻�
				return 4; //�˻�

			case -3: //��������
			case -2: //�ͻ�����
			case -1: //Ա������
				return 5; //ȡ��

			case 2: //��֧��
			case 4: //�ѳ���
				return 2; //����

			case 0: //�����
			case 1: //������
			case 3: //��������
			default:
				return 0; //�޶�Ӧֵ
		}
	}

	/**
	 * ��������Ӧ����Ʒת���ɡ��ɹ�����������ַ�����ʽ
	 * @param int $uid �û�ID
	 * @param int $orderId ����ID
	 * @return mixed string ת���ɹ��� false ת��ʧ��
	 */
	private static function convertProductStrForChanet($uid, $orderId, $products = array()) {
		self::clearERR();

		$ret = false;

		$products = empty($products) ? IOrder::getOrderItems($uid, $orderId) : $products;
		if (is_array($products) && count($products)>0) {
			$productItems = array();
			foreach($products as &$product) {
				if ($product['isCouponProduct']) { //�ؼ���Ʒ������
					continue;
				}
				else {
					$type = self::convertProductTypeForChanet($product['price']);
					$name = urlencode(mb_convert_encoding($product['name'], 'UTF-8', 'GB2312'));
					$price = $product['price'] / 100;
					$productItems[] = "$type/{$price}/{$product['buy_num']}/{$product['buy_num']}/$name";
				}
			}
			$ret = implode(':', $productItems);
		}
		else {
			self::setERR(400, "Fetch none products for order {$orderId}");
		}

		return $ret;
	}

	/**
	 * �ɡ��۸����䡱����Ķ����ġ����͡�
	 * @param int $price �û�֧�������ڼ��㷵���Ľ��
	 * @return string Ψһ��Ҫ��֧������
	 */
	private static function convertPaymentTypeForWeiyi($price) {
		$ret = '0';
		$priceMap = CPSConfig::$providerList[CPSConfig::$providerWeiyi]['orderType'];

		foreach ($priceMap as $priceInfo) {
			if ($priceInfo['min'] <= $price) {
				if (empty($priceInfo['max']) || ((!empty($priceInfo['max'])) && $price<= $priceInfo['max'])) {
					$ret = $priceInfo['type'];
					break;
				}
			}
		}

		return $ret;
	}

	/**
	 * ���ݼ۸񣬷���51�ȹ��ķ�����ע�⣬������51bi��Ӷ��,С���������λС��
	 * @param int $price
	 * @return float ����
	 */
	public static function getCommAmountFor51bigou($price) {
		$ret = 0;
		$priceMap = CPSConfig::$providerList[CPSConfig::$provider51bigou]['priceMap'];

		foreach ($priceMap as $priceInfo) {
			if ($priceInfo['min'] <= $price) {
				if (empty($priceInfo['max']) || ((!empty($priceInfo['max'])) && $price<= $priceInfo['max'])) {
					$ret = $priceInfo['commision'] / 100;
					break;
				}
			}
		}

		return $ret;
	}

	/**
	 * ��ô洢��usersafekey
	 * @param int $uid �û�ID
	 * @return string �û���Ӧ�� usersafekey
	 */
	public static function getUserSafeKeyFor51fanli($uid) {
		$usersafekey = false;

		$userinfo = ICPSDao::getRows('t_cps_user_51fanli', '*', "`uid`= {$uid}");
		if (false === $userinfo) { //ʧ��
			self::setERR(ICPSDao::$errCode, ICPSDao::$errMsg);
		}
		else if (count($userinfo)==1) { //�ɹ�
			$userinfo = $userinfo[0];
			$usersafekey = $userinfo['usersafekey'];
		}
		else {
			$usersafekey = 0; //�޼�¼
		}

		return $usersafekey;
	}

	/**
	 * �洢��usersafekey
	 * @param int $uid �û�ID
	 * @param string $usersafekey �û���Ӧ��usersafekey
	 * @return mixed �洢�Ľ��
	 */
	public static function setUserSafeKeyFor51fanli($uid, $usersafekey) {
		$ret = ICPSDao::insert('t_cps_user_51fanli', array(
			'uid' => $uid,
			'usersafekey' => $usersafekey,
		));

		if ($ret === false) {
			self::setERR(501, basename(__FILE__, '.php') . '|' . __LINE__ . ' [insert 51fanli CPS user failed: '. ICPSDao::$errMsg .']');
		}

		return $ret;
	}

	/**
	 * ���ͬ����erp��¼��key
	 * @param string $source �ṩ������
	 * @return string
	 */
	public static function getSynERPRecordKey($source) {
		self::clearERR();

		if (! array_key_exists($source, CPSConfig::$providerList)) {
			self::setERR(400, "unsupport source {$source}");
			return false;
		}

		return "synCPSOrderToERP_{$source}_recordKey";
	}

	/**
	 * �û�ʵ��֧������ȥ�ؼ���Ʒ���
	 * @param array $submitOrder IOrder::checkShippingCart ����ֵ
			'errCode'=>0,
			'uid'=>$newOrder['uid'],
			'orderId'=>$parentOrderId,
			'orderAmt'=> $orderShipPrice + $orderPrice - $newOrder['point'] - $couponInfo['amt'],
			'payType'=>$newOrder['payType'],
			'payTypeIsOnline' => $_PAY_MODE[$wh_id][$newOrder['payType']]['IsNet'],
			'payTypeName' => $_PAY_MODE[$wh_id][$newOrder['payType']]['PayTypeName'],
			'orderTotalAmt'=>$orderShipPrice + $orderPrice, //�����ܽ��
			'payGoodsAmt' => $product_cash, //�����ͻ�֧���Ľ�ȥ���˷Ѻ����ܵ��������Żݺ���û�ʵ��֧����
			'orderCreateTime'=>$now,
			'isParentOrder' => $orderNum > 1 ? true : false,
			'isVATInvoice' => ($newOrder['invoiceType'] == INVOICE_TYPE_VAT) ? true : false, //�Ƿ�Ϊ��ֵ˰��Ʊ
			'order_items' => $newOrder['order_items']
	 * @return int
	 */
	public static function getUserPayAmount(&$submitOrder) {
		if ($submitOrder['isVATInvoice']) { //��Ʊ����
			return 0;
		}

		$order_items = $submitOrder['order_items'];
		if (empty($order_items)) {
			self::setERR(500, 'get order items FAILED.');
			return false;
		}

		foreach ($order_items as &$item) {
			$item['isCouponProduct'] = empty($item['isCouponProduct'])
															? ((COUPON_PRODUCT & $item['flag']) == COUPON_PRODUCT)
															: $item['isCouponProduct'];

			if ($item['isCouponProduct']) {
				$submitOrder['payGoodsAmt'] -= ($item['price'] * $item['buy_num']);
			}
		}

		return ($submitOrder['payGoodsAmt']) >= 0 ? $submitOrder['payGoodsAmt'] : 0; //���֣��Żݾ�������ⲿ�ֽ���ɸ���
	}

	/**
	 * ��Բ��������д���û�֧�����㷽ʽ
	 * @param array $submitOrder
	 * @param array $subOrder
	 * @return int
	 */
	public static function getUserPayAmountForBatch(&$submitOrder, &$subOrder) {
		if ($submitOrder['isVATInvoice']) { //��Ʊ����
			return 0;
		}

		$order_items = $submitOrder['order_items'];
		if (empty($order_items)) {
			self::setERR(500, 'get order items FAILED.');
			return false;
		}

		$products = array();
		foreach ($order_items as &$item) {
			$item['isCouponProduct'] = empty($item['isCouponProduct'])
															? ((COUPON_PRODUCT & $item['flag']) == COUPON_PRODUCT)
															: $item['isCouponProduct'];
			$products[$item['product_id']] = $item;
		}

		$subOrder['payGoodsAmt'] = $subOrder['orderPrice'] - $submitOrder['orderShipPrice'] - $submitOrder['couponamt'];
		foreach ($subOrder['product_ids'] as $product_id) {
			$subOrder['payGoodsAmt'] -= ($products[$product_id]['isCouponProduct']
															? ($products[$product_id]['price'] * $products[$product_id]['buy_num'])
															: 0);
		}

		return ($submitOrder['payGoodsAmt']) >= 0 ? $submitOrder['payGoodsAmt'] : 0; //���֣��Żݾ�������ⲿ�ֽ���ɸ���
	}

	/**
	 * �����µ����ص��Ӷ�����
	 * @param string $str
	 * @return array
	 */
	private static function _preprocessSubOrderIdStr($str) {
		$mod = 1000000000;

		$str = trim($str);
		$ret = explode(',', $str);
		foreach($ret as $k=>$v) {
			if (empty($v)) {
				unset($ret[$k]);
			}
			else {
				$ret[$k] = ($ret[$k] % $mod) + $mod;
			}
		}
		return $ret;
	}

	/**
	 * ת�� OrderID
	 * @param string $orderId
	 * @return string
	 */
	private static function _converOrderId($orderId) {
		$mod = 1000000000;
		return ($orderId % $mod) + $mod;
	}

	/**
	 * ����ƴװ�����Ӷ���
	 * @param array $initAry ������Ϣ����� $submitOrder �޸�
	 * @param array $submitOrder
	 * @param boolean $loginFromQQCB
	 * @return array
	 */
	private function _makeupAry($initAry, &$submitOrder, $loginFromQQCB = null) {
		$ret = array();
		$i = 0;
		foreach ($submitOrder['subOrders'] as $stockId => &$subOrder) {
			$ret[$i] = $initAry;

			//��Ҫ����д��key
			$ret[$i]['bizno'] += $i;
			$ret[$i]['order_id'] = self::_converOrderId($subOrder['orderId']);
			$ret[$i]['order_total_amount'] = $subOrder['orderPrice'] - $submitOrder['orderShipPrice'] - $submitOrder['couponamt'];
			$ret[$i]['order_pay_amount'] = self::getUserPayAmountForBatch($submitOrder, $subOrder);

			if (null !== $loginFromQQCB && isset($ret[$i]['order_comm_amount'])) {
				$ret[$i]['order_comm_amount'] = $submitOrder['isVATInvoice'] ? 0 : self::getCommAmountForQQCB($userPayAmount, $loginFromQQCB);
			}

			$i ++;
		}

		return $ret;
	}
}

// End Of Script