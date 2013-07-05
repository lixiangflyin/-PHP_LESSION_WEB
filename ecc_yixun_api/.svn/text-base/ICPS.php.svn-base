<?php
require_once(PHPLIB_ROOT . 'api/inc/IQQTuanAPI.php');

require_once(PHPLIB_ROOT . 'inc/CPSConfig.inc.php');
require_once(PHPLIB_ROOT . 'inc/paytype.inc.php'); //支付类型
require_once(PHPLIB_ROOT . 'inc/paytypevia.inc.php'); //QQCB 支付类型转换


/**
 * CPS 操作类
 * @tutorial
 * 		存储订单进DB的部分，我写的有些冗余。之前的想法是都区分开，方便之后隔离修改。
 * 		切记：调用、修改 saveCPSOrderToDB 一定要读相关文档，并了解已有的结构。
 *
 * error code 定义：
 * 400 参数不存在
 * 401 对应的数据表不存在
 * 402 cookie 破损
 * 403 参数校验失败
 * 404 未找到数据
 * 501 写表出错
 * 502 读表出错
 */
class ICPS {
	public static $errCode = 0;
	public static $errMsg = '';
	public static $whId = 0;

	public static function init() {
		if (empty(self::$whId)) {
			self::$whId = IUser::getSiteId(); //设置城市ID
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
	 * 城市ID，指定ERP。
	 * @param int $whId
	 */
	public static function setWhId($whId) {
		self::$whId = $whId;
	}

	/**
	 * 依据配置的 CPSConfig::$providerList 验证相关参数的完整性
	 * @param array $params GET/POST请求,也许有非必需的键值对
	 * @param string $srouce 指明CPS提供商
	 * @return boolean 是否通过验证
	 */
	public static function validateRedirectParam(&$params, $source) {
		self::clearERR();

		if (count(array_diff(CPSConfig::$providerList[$source]['field'], array_keys($params))) != 0) { //存在验证
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
				&& (! in_array($params['cid'], CPSConfig::$providerList[CPSConfig::$providerYiqifa]['valid_cid'])) ) { //亿起发 src cid 严格匹配

				self::setERR(400, basename(__FILE__, '.php') . '|' . __LINE__ . " invalid src or cid.");
				return false;
			}

			if  ($source != CPSConfig::$provider51fanli) { //51fanli 不做非空验证
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
	 * 依据配置的 CPSConfig::$providerList 中 consult_fields 字段验证相关参数的完整性
	 * @param array $params GET/POST请求,也许有非必需的键值对
	 * @param string $srouce 指明CPS提供商
	 * @tutorial
Q团的两种请求格式：
1. batch 模式
<?xml version="1.0" encoding="utf-8"?>
<groupon>
	<ver>1.0</ver>
	<spid>www.qq.com</spid>
	<qqgid>123456</qqgid>
	<date>2011-10-11</date><!--日期-->
</groupon>
2. detail 模式
<?xml version="1.0" encoding="utf-8"?>
<groupon>
	<ver>1.0</ver>
	<spid>www.qq.com</spid>
	<qqgid>123456</qqgid>
	<orderid>abcdefg</orderid>
</groupon>
	 * @return boolean 是否通过验证
	 */
	public static function validateConsultParam(&$params, $source) {
		self::clearERR();

		//针对配置过的 consult_fields ，其值不能为空
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

			case CPSConfig::$providerQQCB: //QQ彩贝不过来
				break;

			case CPSConfig::$providerLinktech:
				if (! preg_match('/^2\d{3}[01]\d[0-3]\d$/', $params['yyyymmdd'])) { //日期格式与文档不同
					self::setERR(403, basename(__FILE__, '.php') . '|' . __LINE__ . ' 参数校验失败');
					return false;
				}
				break;

			case CPSConfig::$providerYiqifa:
				if (! preg_match('/^2\d{3}[01]\d[0-3]\d$/', $params['d'])) { //日期格式与文档不同
					self::setERR(403, basename(__FILE__, '.php') . '|' . __LINE__ . ' 参数校验失败');
					return false;
				}
				break;

			case CPSConfig::$providerChanet:
				if ( (isset($params['orderid']) && (! is_numeric($params['orderid']))) //订单ID不是数字
					 || (isset($params['start']) && (! preg_match('/^2\d{3}[01]\d[0-3]\d$/', $params['start']))) //start 日期格式与文档不同
					 || (isset($params['end']) && (! preg_match('/^2\d{3}[01]\d[0-3]\d$/', $params['end']))) ) { //end 日期格式与文档不同

					self::setERR(403, basename(__FILE__, '.php') . '|' . __LINE__ . ' 参数校验失败');
					return false;
				}

				if ($params['sig'] != self::getSigForChanet($params)) { //成果sig校验
					self::setERR(403, basename(__FILE__, '.php') . '|' . __LINE__ . ' 成果网 sig 校验失败');
					return false;
				}
				break;

			case CPSConfig::$providerWeiyi:
				if ( $params['unionid'] != CPSConfig::$providerList[CPSConfig::$providerWeiyi]['unionid'] //unionid 和设置不匹配
					 || $params['pwd'] != CPSConfig::$providerList[CPSConfig::$providerWeiyi]['pwd'] //pwd 和设置不匹配
					 || (! preg_match('/^2\d{3}-[01]\d-[0-3]\d$/', $params['starttime'])) //starttime 日期格式与文档不同 yyyy-MM-dd
					 || (! preg_match('/^2\d{3}-[01]\d-[0-3]\d$/', $params['endtime'])) ) { //endtime 日期格式与文档不同 yyyy-MM-dd

					self::setERR(403, basename(__FILE__, '.php') . '|' . __LINE__ . ' 参数校验失败');
					return false;
				}
				break;

			case CPSConfig::$provider51bigou:
				if ( (! preg_match('/^2\d{3}[01]\d[0-3]\d[0-2]\d[0-6]\d[0-6]\d$/', $params['starttime'])) //starttime 日期格式与文档不同 yyyyMMddHHmmss
					 || (! preg_match('/^2\d{3}[01]\d[0-3]\d[0-2]\d[0-6]\d[0-6]\d$/', $params['endtime'])) ) { //endtime 日期格式与文档不同 yyyyMMddHHmmss

					self::setERR(403, basename(__FILE__, '.php') . '|' . __LINE__ . ' 参数校验失败');
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
					 
					self::setERR(403, basename(__FILE__, '.php') . '|' . __LINE__ . ' 参数校验失败');
					return false;
				}
				break;
			case CPSConfig::$providerCommon:
				return false; //NOTE stop here
		}

		return true;
	}

	/**
	 * QQ彩贝的参数验证：比对vkey。
	 * @param array $params
	 * @return boolean 验证结果: true 通过 / false 不通过
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
	 * QQ图购联合登录参数验证.
	 * @param array $params URL中传递的参数
	 * @return bool true 通过, false 未通过
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
	 * QQ返利的参数验证：比对vkey。
	 * @param array $params
	 * @return boolean 验证结果: true 通过 / false 不通过
	 */
	private static function validateRedirectParamForQQfanli(&$params) {
		if (strlen($params['acct']) != 32) return false;

		$params['attach'] = isset($params['attach']) ? $params['attach'] : ''; //默认值
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
	 * 网易有道参数验证
	 * @param array $params
	 * @return boolean 验证结果: true 通过 / false 不通过
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
	 * 把cps变量变成cookie字符串，cookie中各值的顺序来源于文档
	 * @param array $params cps变量
	 * @return string 存储在客户端 Cookie，以 CPSConfig::$cookieName 为键值
	 */
	private static function packCookie($params, $source) {
		$cookies = array($source); //第一个是cps提供商

		switch ($source) {
			case CPSConfig::$providerQQCB:
				$cookies[] = $params['openid']; //暂时存cookie吧
				$cookies[] = $params['loginfrom'];
				$cookies[] = $params['attach']; //针对cb: Attach/LoginFrom存cookie, OpenId 存db.
				break;

			case CPSConfig::$providerLinktech:
				$cookies[] = $params[0]; //和其他的CPS提供商不同，领克特的cookie经过拼装，此处整个存储
				break;

			case CPSConfig::$providerYiqifa:
				$cookies[] = $params['src']; //这个值由广告主指定，用来判断流量来自于亿起发联盟
				$cookies[] = $params['cid']; //广告主在亿起发平台的推广可有多个标识，此参数可用来区分不同的推广方式，此参数需要回传给亿起发
				$cookies[] = $params['wi']; //此参数的值经过base64编码，广告主无需转码，须原样回传给亿起发，作为亿起发结算的依据
				break;

			case CPSConfig::$providerChanet:
				$cookies[] = $params['click_id']; //成果网唯一标识
				break;

			case CPSConfig::$providerWeiyi:
				$cookies[] = $params['cid']; //唯一联盟下的二级联盟会员ID以及相关信息
				break;

			case CPSConfig::$provider51bigou:
				$cookies[] = $params['u_id']; //51比购网上的会员标识ID
				break;

			case CPSConfig::$provider51fanli:
				$cookies[] = $params['u_id']; //51返利中参数 u_id
				$cookies[] = $params['tracking_code']; //51返利中参数 tracking_code
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

		$cookies[] = time(); //cps 时间戳
		return implode(CPSConfig::$cookieSeparator, $cookies);
	}

	/**
	 * 把cookie字符串解析成cps变量
	 * @param string $cookie Cookie中 CPSConfig::$cookieName 对应的字符串
	 * @return array CPS相关信息; false CPS cookie 信息破损
	 * 返回的具体结构
	 * cps_source => array(
	 * 具体信息，各有不同
	 * );
	 */
	private static function unpackCookie($cookie) {
		self::clearERR();
		$cpsCookie = explode(CPSConfig::$cookieSeparator, $cookie);

		$source = array_shift($cpsCookie); //第一个是cps 提供商

		if (array_key_exists($source, CPSConfig::$providerList)) {
			switch ($source) {
				case CPSConfig::$providerQQCB: //彩贝
					return (count($cpsCookie) == 4)
						? array($source => array_combine(array('open_id', 'login_from', 'attach', 'cookie_time'), $cpsCookie))
						: false;

				case CPSConfig::$providerLinktech: //领科特
					return (count($cpsCookie) == 2 && strlen($cpsCookie[0]) > 0)
						? array ($source => array_combine(array('cookie', 'cookie_time'), $cpsCookie))
						: false; //和其他的CPS提供商不同

				case CPSConfig::$providerYiqifa: //亿起发
					return (count($cpsCookie) == 4)
						? array($source => array_combine(array('src', 'cid', 'wi', 'cookie_time'), $cpsCookie))
						: false;

				case CPSConfig::$providerChanet: //成果网
					return (count($cpsCookie) == 2 && strlen($cpsCookie[0]) > 0)
						? array($source => array_combine(array('click_id', 'cookie_time'), $cpsCookie))
						: false;

				case CPSConfig::$providerWeiyi: //唯一
					return (count($cpsCookie) == 2 && strlen($cpsCookie[0]) > 0)
						? array($source => array_combine(array('cid', 'cookie_time'), $cpsCookie))
						: false;

				case CPSConfig::$provider51bigou: //51 比购
					return (count($cpsCookie) == 2 && strlen($cpsCookie[0]) > 0)
						? array($source => array_combine(array('u_id', 'cookie_time'), $cpsCookie))
						: false;

				case CPSConfig::$provider51fanli: //51 返利
					return (count($cpsCookie) == 3)
						? array($source => array_combine(array('u_id', 'tracking_code', 'cookie_time'), $cpsCookie))
						: false;
				case CPSConfig::$provider163Youdao: //网易有道 add by wheelswang
					return (count($cpsCookie) == 3)
						? array($source => array_combine(array('unionid', 'userid', 'cookie_time'), $cpsCookie))
						: false;
				case CPSConfig::$providerCommon: //通用，继承自旧的系统
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
	 * 解析QQCB post的字符串，提取并处理ViewInfo字段。
	 * @param string $viewinfo QQCB post 回的 viewinfo 字段
	 * @return array
	 */
	private static function getViewInfoForQQCB($viewinfo) {
		$ret = array();
		parse_str($viewinfo, $ret);
		$ret = array_change_key_case($ret, CASE_LOWER);

		$ret['showmsg'] = isset($ret['showmsg']) ? ToolUtil::escape($ret['showmsg']) : '';
		$ret['nickname'] = isset($ret['nickname']) ? ToolUtil::escape($ret['nickname']) : '';
		$ret['openkey'] = isset($ret['openkey']) ? ToolUtil::escape($ret['openkey']) : '';

		//以下几个暂时用不着
//		$ret['nickname'] = isset($ret['nickname']) ? ToolUtil::escape($ret['nickname']) : '';
//		$ret['cbpoints'] = isset($ret['cbpoints']) ? ToolUtil::escape($ret['cbpoints']) : '';
//		$ret['cbbonus'] = isset($ret['cbbonus']) ? ToolUtil::escape($ret['cbbonus']) : '';
//		$ret['headshow'] = isset($ret['headshow']) ? ToolUtil::escape($ret['headshow']) : '';
//		$ret['jifenurl'] = isset($ret['jifenurl']) ? ToolUtil::escape($ret['jifenurl']) : '';

		return $ret;
	}

	/**
	 * 获取cookie中保存的cps信息
	 */
	public static function getCPSInfoFromCookie() {
		return isset($_COOKIE[CPSConfig::$cookieName]) ? self::unpackCookie($_COOKIE[CPSConfig::$cookieName]) : false;
	}

	/**
	 * 从string中获取保存的cps信息, 订单的 cpsinfo 字段
	 */
	public static function getCPSInfoFromString($str) {
		return self::unpackCookie($str);
	}

	/**
	 * 删除cookie中的CPS 标记。
	 */
	public static function clearCPSInfo() {
		if (isset($_COOKIE[CPSConfig::$cookieName])) { //如果有，删除CPS标记
			unset($_COOKIE[CPSConfig::$cookieName]);
			setrawcookie(CPSConfig::$cookieName, '', -1, '/', '.51buy.com');
		}
	}

	/**
	 * 保存CPS信息到cookie中，每个提供商需要保存的字段不同。
	 * @param array $params GET/POST的键值对
	 * @param string $source CPS提供商
	 * @return NULL
	 */
	public static function saveCPSInfoToCookie(&$params, $source, $uid=null) {
		$cookieStr = self::packCookie($params, $source);

		//RD 时间读配置；这里的cookie信息为订单提交服务
		setrawcookie(CPSConfig::$cookieName, $cookieStr, time()+CPSConfig::$providerList[$source]['rd'], '/', CPSConfig::$merchantName);

		if ($uid != null) { //彩贝需要显示额外的ShowMsg
			if ($source == CPSConfig::$providerQQCB) {
				$msgAry = (isset($params['viewinfo']) && strlen($params['viewinfo']) != 0) ? self::getViewInfoForQQCB($params['viewinfo']) : array();

				if (isset($msgAry['showmsg']) && (!empty($msgAry['showmsg']))) { //能在QQCB POST 的参数中decode到相关信息
					$ret1 = setrawcookie(CPSConfig::$cookieNameSource, CPSConfig::$providerQQCB, 0, '/', CPSConfig::$merchantName); //会话期有效
					$ret2 = setrawcookie(CPSConfig::$cookieNameMsg, "{$uid}|{$msgAry['showmsg']}", 0, '/', CPSConfig::$merchantName); //showmsg 用于页头的显示
					$ret3 = setrawcookie(CPSConfig::$cookieNameOpenKey, $msgAry['openkey'], 0, '/', CPSConfig::$merchantName); //openkey 用来拉去彩贝地址
				}
			}
			else if ($source == CPSConfig::$provider51fanli && strlen($params['show_name']) != 0) {
				$show_name = ToolUtil::escape($params['show_name']);
				setrawcookie(CPSConfig::$cookieNameMsg, "{$uid}|{$show_name}", 0, '/', CPSConfig::$merchantName); //会话期有效
			}
		}
	}

	/**
	 * 获得一条记录
	 * @param string $source CPS提供商
	 * @param int $orderId 订单ID (DB 中, order_id 加上了 UNIQUE INDEX )
	 * @return mixed 返回一条CPS订单记录 / 失败
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
				$cpsOrder['ip'] = long2ip($cpsOrder['ip']); // IP 存的是整数形式
			}
		}

		return $cpsOrder;
	}

	/**
	 * 保存CPS订单
	 * TODO 需要优化，已经极度臃肿了
	 * @param array $submitOrder IOrder::checkShippingCart 返回值
	 * @param int $whId 分站ID
	 * @return mixed 保存CPS订单到数据库的结果。
	 * @tutorial $submitOrder 的格式:
	 * Array (
	 *     'errCode' => 0,
	 *     'uid' => '30558397',
	 *     'orderId' => '1030076825',
	 *     'orderAmt' => 222700,
	 *     'payType' => '4',
	 *     'payTypeIsOnline' => 0,
	 *     'payTypeName' => '邮局汇款',
	 *     'orderTotalAmt' => 222700,
	 *     'payGoodsAmt' => 222700,
	 *     'orderCreateTime' => 1323870377,
	 *     'isParentOrder' => false,
	 *     'isVATInvoice' => ($newOrder['invoiceType'] == INVOICE_TYPE_VAT) ? true : false, //是否为增值税发票
	 *     'isParentOrder' => boolean, //是否拆单
	 *     'subOrderIdStr' => $orderstrforlog, //子单ID字符串, 逗号分割
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
	 *                 'name' => 'HTC 野火S A510c 3G（CDMA2000）手机 黑色 电信定制',
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
	 *                 'warranty' => '本产品全国联保，享受三包服务，质保期为：质保一年。如因质量问题或故障，凭厂商维修中心或特约维修点的质量检测证明，享受7日内退货，15日内换货，15日以上在质保期内享受免费保修等三包服务！',
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

		/* CPS 订单入库的逻辑：
		 * 1. 是否是彩贝推广。如果是并且没有切换登录的QQ，则入库彩贝高价单。
		 * 2. 是否是CPS合作商（非彩贝）。如果是，则入库。
		 * 3. 是否是QQ用户登录。如果是，则入库彩贝低价单。
		 */

		global $_PAY_MODE;
		self::$whId = empty(self::$whId) ? IUser::getSiteId() : self::$whId;
		if ($whId) self::$whId = $whId; //用外部强制传入的覆盖

		$saveCPSForQQ = null;
		$saveCPSRet = null;

		$userInfo = IUser::getUserInfo($submitOrder['uid']);
		if (false == $userInfo) {
			self::setERR(400, basename(__FILE__, '.php') . '|' . __LINE__ . ' fetch userinfo FAILED');
			return false;
		}

		$subOrderIds = self::_preprocessSubOrderIdStr($submitOrder['subOrderIdStr']);
		$subOrderCount = count($subOrderIds); //需要录入的子订单数
		if ($subOrderCount == 0) { //下单接口返回数据有误
			Logger::warn('suborders count 0, IFAILED.');
			return false;
		}

		//登录名检查
		$preQQUser = QQ_ACCOUNT_PRE . '_'; //qq用户名前缀
		if (42 == strlen($userInfo['icsonid']) && 0 === strpos($userInfo['icsonid'], $preQQUser)) { //QQ 登录
			$acct = str_replace($preQQUser, '', $userInfo['icsonid']);

			$newBizNo = IIdGenerator::getNewId('eqifa_log_sequence', $subOrderCount); //全局ID
			if (false === $newBizNo || $newBizNo <= 0) {
				self::setERR(IIdGenerator::$errCode, IIdGenerator::$errMsg);
				return false;
			}

			$loginFromQQCB = false; //检查是否包含彩贝CPS信息，低价单？高价单？
			$cookieInfo = array();
			if (isset($_COOKIE[CPSConfig::$cookieName])) {
				$cpsCookie = self::getCPSInfoFromCookie();

				if (is_array($cpsCookie)) { //
					$source = array_pop(array_keys($cpsCookie));
					$cookieInfo = array_pop(array_values($cpsCookie));
					$loginFromQQCB = ($source == CPSConfig::$providerQQCB) && ($cookieInfo['open_id'] == $acct);
				}
			}

			if ($subOrderCount == 1) { //未拆单
				$userPayAmount = self::getUserPayAmount($submitOrder);
				$saveCPSForQQ = self::saveCPSOrderToDB(CPSConfig::$providerQQCB, array(
					'bizno' => $newBizNo,
					'open_id' => $acct, //QQ 彩贝平台提供的等于用户 ID 的一部分
					'login_from' => $loginFromQQCB ? $cookieInfo['login_from'] : '', //联合登录的跳转来源, QQ直接登录无法取得
					'attach' => $loginFromQQCB ? $cookieInfo['attach'] : CPSConfig::$providerList[CPSConfig::$providerQQCB]['static_attach'], //跟踪代码, QQ直接登录无法取得, 直接置为空
					'cps_order_type' => $loginFromQQCB ? 1 : 0, //'0. 联合登录；1.从彩贝处跳转。'
					'uid' => $submitOrder['uid'], //用户编号
					'order_id' => $submitOrder['orderId'], //订单ID
					'order_status' => 10, //订单状态，初始值
					'order_desc' => '51buy, ' . date('Y年m月d日 H时i分', $submitOrder['orderCreateTime']), //订单内容摘要
					'order_total_amount' => $submitOrder['orderTotalAmt'], //订单总金额
					'order_pay_amount' => $userPayAmount, //订单实际支付的金额 - 减去特价商品金额
					'order_comm_amount' => $submitOrder['isVATInvoice'] ? 0 : self::getCommAmountForQQCB($userPayAmount, $loginFromQQCB), //订单商户需要支付的佣金, 增票订单不返利
					'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //支付类型（入库时仅记录 payTypeID）
					'products' => '', //打包成 JSON 串的商品信息
					'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //用户在商户站点的下单时间。该时间一旦确定，后续不会变动
					'order_modify_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //订单在商户的最后修改时间，刚下单的时候该时间的值跟 OrderCreateTime 一致
					'cookie_time' => $loginFromQQCB ? $cookieInfo['cookie_time'] : '', //cookie 时间戳
					'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
					'wh_id' => self::$whId, //城市代码
					'feedback' => '', //备用字段 $submitOrder['comment']是用户对这个订单填写的一些备注("什么时候不能送货"之类的)
				));
			}
			else if ($subOrderCount > 1) { //拆单
				$cpsOrders = self::_makeupAry(array(
											'bizno' => $newBizNo,
											'open_id' => $acct, //QQ 彩贝平台提供的等于用户 ID 的一部分
											'login_from' => $loginFromQQCB ? $cookieInfo['login_from'] : '', //联合登录的跳转来源, QQ直接登录无法取得
											'attach' => $loginFromQQCB ? $cookieInfo['attach'] : CPSConfig::$providerList[CPSConfig::$providerQQCB]['static_attach'], //跟踪代码, QQ直接登录无法取得, 直接置为空
											'cps_order_type' => $loginFromQQCB ? 1 : 0, //'0. 联合登录；1.从彩贝处跳转。'
											'uid' => $submitOrder['uid'], //用户编号
											'order_id' => 0, //重算
											'order_status' => 10, //订单状态，初始值
											'order_desc' => '51buy, ' . date('Y年m月d日 H时i分', $submitOrder['orderCreateTime']), //订单内容摘要
											'order_total_amount' => 0, //重算
											'order_pay_amount' => 0, //重算
											'order_comm_amount' => $submitOrder['isVATInvoice'] ? 0 : self::getCommAmountForQQCB($userPayAmount, $loginFromQQCB), //订单商户需要支付的佣金, 增票订单不返利
											'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //支付类型（入库时仅记录 payTypeID）
											'products' => '', //打包成 JSON 串的商品信息
											'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //用户在商户站点的下单时间。该时间一旦确定，后续不会变动
											'order_modify_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //订单在商户的最后修改时间，刚下单的时候该时间的值跟 OrderCreateTime 一致
											'cookie_time' => $loginFromQQCB ? $cookieInfo['cookie_time'] : '', //cookie 时间戳
											'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
											'wh_id' => self::$whId, //城市代码
											'feedback' => '', //备用字段 $submitOrder['comment']是用户对这个订单填写的一些备注("什么时候不能送货"之类的)
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
			else { // 出错
				Logger::warn("SubOrder count ERROR - {$subOrderCount}.");
			}

			// QQCB 可能一单多算, 程序继续执行
		}
		else if (0 === strpos($userInfo['icsonid'], SHAUTO_ACCOUNT_PRE)) { //上汽用户
			$newBizNo = IIdGenerator::getNewId('eqifa_log_sequence', $subOrderCount); //全局ID
			if (false === $newBizNo || $newBizNo <= 0) {
				self::setERR(IIdGenerator::$errCode, IIdGenerator::$errMsg);
				return false;
			}

			if ($subOrderCount == 1) { //未拆单
				$userPayAmount = self::getUserPayAmount($submitOrder);
				$saveCPSForSHCar = self::saveCPSOrderToDB(CPSConfig::$providerSHCar, array(
					'bizno' => $newBizNo,
					'uid' => $submitOrder['uid'], //用户编号
					'order_id' => $submitOrder['orderId'], //订单ID
					'order_status' => 0, //订单状态，初始值
					'order_total_amount' => $submitOrder['orderTotalAmt'], //订单总金额
					'order_pay_amount' => $userPayAmount, //订单实际支付的金额 - 减去特价商品金额
					'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //支付类型（入库时仅记录 payTypeID）
					'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //用户在商户站点的下单时间。该时间一旦确定，后续不会变动
					'order_modify_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //订单在商户的最后修改时间，刚下单的时候该时间的值跟 OrderCreateTime 一致
					'wh_id' => self::$whId, //城市代码
				));
				Logger::warn('shcar ret ' . ($saveCPSForSHCar ? 'SUCCESS' : 'FAILED'));
			}
			else if ($subOrderCount > 1) { //拆单
				$cpsOrders = self::_makeupAry(array(
											'bizno' => $newBizNo,
											'uid' => $submitOrder['uid'], //用户编号
											'order_id' => 0, //重算
											'order_status' => 0, //订单状态，初始值
											'order_total_amount' => 0, //重算
											'order_pay_amount' => 0, //重算
											'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //支付类型（入库时仅记录 payTypeID）
											'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //用户在商户站点的下单时间。该时间一旦确定，后续不会变动
											'order_modify_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //订单在商户的最后修改时间，刚下单的时候该时间的值跟 OrderCreateTime 一致
											'wh_id' => self::$whId, //城市代码
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
			else { // 出错
				Logger::warn("SubOrder count ERROR - {$subOrderCount}.");
			}

			return true; //上汽订单不能一单多付
		}
		//登录名检查结束

		//根据 cookie 录入 CPS 订单
		if (isset($_COOKIE[CPSConfig::$cookieNameSource])) {

			//QQTuan begin
			if ( $_COOKIE[CPSConfig::$cookieNameSource] == CPSConfig::$providerQQTuan
				&& isset($_COOKIE['edm']) ) { //QTuan 是绑定 EDM

				$edm_str = false;
				$edm_infos = explode(',', $_COOKIE['edm']);

				$cpsOrders = array(); //Q团订单一个商品一条记录
				foreach ($submitOrder['order_items'] as &$orderItem) {
					if ( $orderItem['edm_code'] ) { //包含 edm 信息才检查是否匹配
						foreach ($edm_infos as $edm_item) {
							if (false !== strpos($edm_item, $orderItem['edm_code'])) {
								$edm_str = $edm_item;
								break;
							}
						}

						if ($edm_str) { //推单的时候可能要再次判定，此处不再记录是否和上传资源匹配
							$edmAry = explode('_', $edm_str);
							$edmLen = count($edmAry);
							if ( $edmLen >= 2 && in_array($orderItem['product_id'], $edmAry) ) { //该商品id位于Q团EDM cookie中
								$order_id = 0;
								foreach ($submitOrder['subOrders'] as $stockId => &$subOrder) {
									if (in_array($orderItem['product_id'], $subOrder['product_ids'])) {
										$order_id = $subOrder['orderId'];
										//order_id前面加'10' daopingsun
										$order_id = isset($order_id) ? sprintf("%s%09d", "1", $order_id % 1000000000) : 0;
										break;
									}
								}

								if (0 != $order_id) { //反查 orderid 成功
									$newBizNo = IIdGenerator::getNewId('eqifa_log_sequence'); //全局ID
									if (false === $newBizNo || $newBizNo <= 0) {
										self::setERR(IIdGenerator::$errCode, IIdGenerator::$errMsg);
										return false;
									}

									$cpsOrders[] = array(
										'bizno' => $newBizNo,
										'uid' => $submitOrder['uid'], //用户ID
										'qqtuan_id' => $edmAry[ $edmLen - 1 ], //Q团ID，应该是edm数组最后一个
										'order_id' => $order_id, //订单ID
										'openkey' => empty($_COOKIE[CPSConfig::$cookieQQTuanOpenKey]) ? '' : $_COOKIE[CPSConfig::$cookieQQTuanOpenKey], //cookie 中保存的Q团侧传入的 openkey
										'product_id' => $orderItem['product_id'], //商品id
										'buy_count' => $orderItem['buy_num'], //购买个数
										'order_status' => 0, //订单状态
										'order_total_amount' => $orderItem['price'], //订单总金额（针对Q团，这里只能记录cost了）。
										'order_pay_amount' => $orderItem['price'], //订单实际支付的总金额（针对Q团，这里只能记录cost了）。
										'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //支付类型（入库时仅记录 payTypeID）
										'pay_online' => $submitOrder['payTypeIsOnline'], //pay online?
										'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //订单下单时间
										'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
										'wh_id' => self::$whId, //城市代码
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
					if ($source != CPSConfig::$providerQQCB) { //NOTE: "QQCB" 之前记录过了; "QQTuan" 暂时不做CPS cookie记录

						$newBizNo = IIdGenerator::getNewId('eqifa_log_sequence', $subOrderCount); //全局ID
						if (false === $newBizNo || $newBizNo <= 0) {
							self::setERR(IIdGenerator::$errCode, IIdGenerator::$errMsg);
							return false;
						}

						$saveCPSRet = false;
						if ($subOrderCount == 1) {
							switch ($source) {
								//case CPSConfig::$providerQQCB: //NOTE 彩贝之前记录过了
								//break;

								case CPSConfig::$providerLinktech:
									$saveCPSRet = self::saveCPSOrderToDB($source, array(
										'bizno' => $newBizNo,
										'cookie_info' => $cookieInfo['cookie'], //领科特的 Cookie 比较特殊
										'uid' => $submitOrder['uid'], //用户ID
										'order_id' => $submitOrder['orderId'], //订单ID
										'order_status' => 100, //订单状态 [100:未结算(用户刚下的订单).200:核对完(交易成功).300:取消(交易失败)]
										'order_total_amount' => $submitOrder['orderTotalAmt'], //订单总金额
										'order_pay_amount' => self::getUserPayAmount($submitOrder), //订单实际支付的金额 - 减去特价商品金额
										'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //支付类型（入库时仅记录 payTypeID）
										'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //订单下单时间
										'product_id' => '', //商品编号
										'product_count' => '', //购买的商品数量
										'product_price' => '', //商品单价
										'product_type' => '', //购买的商品分类
										'cookie_time' => $cookieInfo['cookie_time'], //cookie 时间戳
										'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
										'wh_id' => self::$whId, //城市代码
									));
								break;

								case CPSConfig::$providerYiqifa:
									$saveCPSRet = self::saveCPSOrderToDB($source, array (
										'bizno' => $newBizNo,
										'cid' => $cookieInfo['cid'], //广告主在亿起发平台推广的标识,固定值,来自于接口1的cid值
										'wi' => $cookieInfo['wi'], //亿起发下级网站信息
										'uid' => $submitOrder['uid'], //用户ID
										'order_id' => $submitOrder['orderId'], //订单ID
										'order_total_amount' => $submitOrder['orderTotalAmt'], //订单总金额
										'order_pay_amount' => self::getUserPayAmount($submitOrder), //订单实际支付的金额 - 减去特价商品金额
										'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //支付类型（入库时仅记录 payTypeID）
										'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //订单下单时间
										'product_id' => '', //商品编号.如果是多个商品,请以 | 分隔
										'product_type' => '', //购买的商品分类
										'product_count' => '', //购买的商品数量
										'product_price' => '', //商品单价
										'cookie_time' => $cookieInfo['cookie_time'], //cookie 时间戳
										'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
										'wh_id' => self::$whId, //城市代码
									));
								break;

								case CPSConfig::$providerChanet:
									$saveCPSRet = self::saveCPSOrderToDB($source, array (
										'bizno' => $newBizNo,
										'click_id' => $cookieInfo['click_id'], //成果网唯一标识
										'uid' => $submitOrder['uid'], //用户ID
										'order_id' => $submitOrder['orderId'], //订单ID
										'order_total_amount' => $submitOrder['orderTotalAmt'], //订单总金额
										'order_pay_amount' => self::getUserPayAmount($submitOrder), //订单实际支付的金额 - 减去特价商品金额
										'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //支付类型（入库时仅记录 payTypeID）
										'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //订单下单时间
										'cookie_time' => $cookieInfo['cookie_time'], //cookie 时间戳
										'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
										'wh_id' => self::$whId, //城市代码
									));
								break;

								case CPSConfig::$providerWeiyi:
									$saveCPSRet = self::saveCPSOrderToDB($source, array (
										'bizno' => $newBizNo,
										'cid' => $cookieInfo['cid'], //唯一网唯一标识
										'uid' => $submitOrder['uid'], //用户ID
										'order_id' => $submitOrder['orderId'], //订单ID
										'order_total_amount' => $submitOrder['orderTotalAmt'], //订单总金额
										'order_pay_amount' => self::getUserPayAmount($submitOrder), //订单实际支付的金额 - 减去特价商品金额
										'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //支付类型（入库时仅记录 payTypeID）
										'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //订单下单时间
										'cookie_time' => $cookieInfo['cookie_time'], //cookie 时间戳
										'wh_id' => self::$whId, //城市代码
									));
								break;

								case CPSConfig::$provider51bigou:
									$saveCPSRet = self::saveCPSOrderToDB($source, array (
										'bizno' => $newBizNo,
										'u_id' => $cookieInfo['u_id'], //唯一网唯一标识
										'uid' => $submitOrder['uid'], //用户ID
										'ip' => ip2long(ToolUtil::getClientIP()), //用户ID
										'order_id' => $submitOrder['orderId'], //订单ID
										'order_total_amount' => $submitOrder['orderTotalAmt'], //订单总金额
										'order_pay_amount' => self::getUserPayAmount($submitOrder), //订单实际支付的金额 - 减去特价商品金额
										'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //支付类型（入库时仅记录 payTypeID）
										'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //订单下单时间
										'cookie_time' => $cookieInfo['cookie_time'], //cookie 时间戳
										'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
										'wh_id' => self::$whId, //城市代码
									));
								break;

								case CPSConfig::$provider51fanli:
									$icsonid = ($userInfo === false) ? '' : $userInfo['icsonid'];
									if (! preg_match('/^\d+@51fanli$/i', $userInfo['icsonid'])) {
										$icsonid = ''; //非返利网用户 不记录 name
									}

									$saveCPSRet = self::saveCPSOrderToDB($source, array (
										'bizno' => $newBizNo,
										'u_id' => $cookieInfo['u_id'], //51fanli u_id
										'tracking_code' => $cookieInfo['tracking_code'], //51fanli tracking_code
										'uid' => $submitOrder['uid'], //用户ID
										'name' => $icsonid, //用户登录名
										'order_id' => $submitOrder['orderId'], //订单ID
										'order_total_amount' => $submitOrder['orderTotalAmt'], //订单总金额
										'order_pay_amount' => self::getUserPayAmount($submitOrder), //订单实际支付的金额 - 减去特价商品金额
										'payment_type' => (intval($submitOrder['payTypeIsOnline']) == 1 ? 1 : 2), //支付类型（在线支付：1；货到付款：2；其他：3）
										'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //订单下单时间
										'cookie_time' => $cookieInfo['cookie_time'], //cookie 时间戳
										'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
										'wh_id' => self::$whId, //城市代码
									));
								break;
								/*********add by wheelswang 2012-09-25*********/
								case CPSConfig::$provider163Youdao:
									$youdao_order = array (
										'bizno' => $newBizNo,
										'uid' => $submitOrder['uid'],
										'user_id' => $cookieInfo['userid'],
										'order_id' => $submitOrder['orderId'], //订单ID
										'order_status' => 0, //订单初始化
										'order_total_amount' => $submitOrder['orderTotalAmt'], //订单总金额
										'order_pay_amount' => self::getUserPayAmount($submitOrder), //订单实际支付的金额 - 减去特价商品金额
										'payment_type' => (intval($submitOrder['payTypeIsOnline']) == 1 ? 1 : 2), //支付类型（在线支付：1；货到付款：2；其他：3）
										'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //订单下单时间
										'order_modify_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']),//订单修改时间
										'wh_id' => self::$whId, //城市代码
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
										'uid' => $submitOrder['uid'], //用户ID
										'ip' => ip2long(ToolUtil::getClientIP()), //用户ID
										'order_id' => $submitOrder['orderId'], //订单ID
										'order_total_amount' => $submitOrder['orderTotalAmt'], //订单总金额
										'order_pay_amount' => self::getUserPayAmount($submitOrder), //订单实际支付的金额 - 减去特价商品金额
										'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //支付类型（入库时仅记录 payTypeID）
										'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //订单下单时间
										'cookie_time' => $cookieInfo['cookie_time'], //cookie 时间戳
										'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
										'wh_id' => self::$whId, //城市代码
									));
								break;
							} //switch end

							if (false === $saveCPSRet) {
								Logger::warn('cps save single FAILED ' . self::$errCode . '|' . self::$errMsg);
								return false;
							}
						}
						else if ($subOrderCount > 1) { //拆单
							$cpsOrders = array();

							switch ($source) {
								//case CPSConfig::$providerQQCB: //NOTE 彩贝之前记录过了
								//break;

								case CPSConfig::$providerLinktech:
									$cpsOrders = self::_makeupAry(array(
											'bizno' => $newBizNo,
											'cookie_info' => $cookieInfo['cookie'], //领科特的 Cookie 比较特殊
											'uid' => $submitOrder['uid'], //用户ID
											'order_id' => 0, //重算
											'order_status' => 100, //订单状态 [100:未结算(用户刚下的订单).200:核对完(交易成功).300:取消(交易失败)]
											'order_total_amount' => 0, //重算
											'order_pay_amount' => 0, //重算
											'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //支付类型（入库时仅记录 payTypeID）
											'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //订单下单时间
											'product_id' => '', //商品编号
											'product_count' => '', //购买的商品数量
											'product_price' => '', //商品单价
											'product_type' => '', //购买的商品分类
											'cookie_time' => $cookieInfo['cookie_time'], //cookie 时间戳
											'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
											'wh_id' => self::$whId, //城市代码
										),
										$submitOrder
									);
								break;

								case CPSConfig::$providerYiqifa:
									$cpsOrders = self::_makeupAry(array(
											'bizno' => $newBizNo,
											'cid' => $cookieInfo['cid'], //广告主在亿起发平台推广的标识,固定值,来自于接口1的cid值
											'wi' => $cookieInfo['wi'], //亿起发下级网站信息
											'uid' => $submitOrder['uid'], //用户ID
											'order_id' => 0, //重算
											'order_total_amount' => 0, //重算
											'order_pay_amount' => 0, //重算
											'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //支付类型（入库时仅记录 payTypeID）
											'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //订单下单时间
											'product_id' => '', //商品编号.如果是多个商品,请以 | 分隔
											'product_type' => '', //购买的商品分类
											'product_count' => '', //购买的商品数量
											'product_price' => '', //商品单价
											'cookie_time' => $cookieInfo['cookie_time'], //cookie 时间戳
											'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
											'wh_id' => self::$whId, //城市代码
										),
										$submitOrder
									);
								break;

								case CPSConfig::$providerChanet:
									$cpsOrders = self::_makeupAry(array(
											'bizno' => $newBizNo,
											'click_id' => $cookieInfo['click_id'], //成果网唯一标识
											'uid' => $submitOrder['uid'], //用户ID
											'order_id' => 0, //重算
											'order_total_amount' => 0, //重算
											'order_pay_amount' => 0, //重算
											'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //支付类型（入库时仅记录 payTypeID）
											'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //订单下单时间
											'cookie_time' => $cookieInfo['cookie_time'], //cookie 时间戳
											'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
											'wh_id' => self::$whId, //城市代码
										),
										$submitOrder
									);
								break;

								case CPSConfig::$providerWeiyi:
									$cpsOrders = self::_makeupAry(array(
											'bizno' => $newBizNo,
											'cid' => $cookieInfo['cid'], //唯一网唯一标识
											'uid' => $submitOrder['uid'], //用户ID
											'order_id' => 0, //重算
											'order_total_amount' => 0, //重算
											'order_pay_amount' => 0, //重算
											'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //支付类型（入库时仅记录 payTypeID）
											'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //订单下单时间
											'cookie_time' => $cookieInfo['cookie_time'], //cookie 时间戳
											'wh_id' => self::$whId, //城市代码
										),
										$submitOrder
									);
								break;

								case CPSConfig::$provider51bigou:
									$cpsOrders = self::_makeupAry(array(
											'bizno' => $newBizNo,
											'u_id' => $cookieInfo['u_id'], //唯一网唯一标识
											'uid' => $submitOrder['uid'], //用户ID
											'ip' => ip2long(ToolUtil::getClientIP()), //用户ID
											'order_id' => 0, //重算
											'order_total_amount' => 0, //重算
											'order_pay_amount' => 0, //重算
											'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //支付类型（入库时仅记录 payTypeID）
											'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //订单下单时间
											'cookie_time' => $cookieInfo['cookie_time'], //cookie 时间戳
											'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
											'wh_id' => self::$whId, //城市代码
										),
										$submitOrder
									);
								break;

								case CPSConfig::$provider51fanli:
									$icsonid = ($userInfo === false) ? '' : $userInfo['icsonid'];
									if (! preg_match('/^\d+@51fanli$/i', $userInfo['icsonid'])) {
										$icsonid = ''; //非返利网用户 不记录 name
									}

									$cpsOrders = self::_makeupAry(array(
											'bizno' => $newBizNo,
											'u_id' => $cookieInfo['u_id'], //51fanli u_id
											'tracking_code' => $cookieInfo['tracking_code'], //51fanli tracking_code
											'uid' => $submitOrder['uid'], //用户ID
											'name' => $icsonid, //用户登录名
											'order_id' => 0, //重算
											'order_total_amount' => 0, //重算
											'order_pay_amount' => 0, //重算
											'payment_type' => (intval($submitOrder['payTypeIsOnline']) == 1 ? 1 : 2), //支付类型（在线支付：1；货到付款：2；其他：3）
											'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //订单下单时间
											'cookie_time' => $cookieInfo['cookie_time'], //cookie 时间戳
											'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
											'wh_id' => self::$whId, //城市代码
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
											'order_id' => $submitOrder['orderId'], //订单ID
											'order_status' => 0,//订单初始化
											'order_total_amount' => 0, //订单总金额
											'order_pay_amount' => 0, //订单实际支付的金额 - 减去特价商品金额
											'payment_type' => (intval($submitOrder['payTypeIsOnline']) == 1 ? 1 : 2), //支付类型（在线支付：1；货到付款：2；其他：3）
											'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //订单下单时间
											'order_modify_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']),//订单修改时间
											'wh_id' => self::$whId, //城市代码
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
											'uid' => $submitOrder['uid'], //用户ID
											'ip' => ip2long(ToolUtil::getClientIP()), //用户ID
											'order_id' => 0, //重算
											'order_total_amount' => 0, //重算
											'order_pay_amount' => 0, //重算
											'payment_type' => $_PAY_MODE[self::$whId][$submitOrder['payType']]['SysNo'], //支付类型（入库时仅记录 payTypeID）
											'order_create_time' => date('Y-m-d H:i:s', $submitOrder['orderCreateTime']), //订单下单时间
											'cookie_time' => $cookieInfo['cookie_time'], //cookie 时间戳
											'is_vat_invoice' => $submitOrder['isVATInvoice'] ? 1 : 0,
											'wh_id' => self::$whId, //城市代码
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
	 * 记录 CPS 订单信息到数据库。
	 * @param string $source CPS 提供商
	 * @param array $params 订单信息数组，可能有多余键值对需要过滤
	 * QQ 彩贝的 $params
	 * array (
			'uid' => 用户ID
			'order_id' => 订单ID
			'order_status' => 订单状态
			'order_desc' => 订单内容摘要
			'order_total_amount' => 订单总金额，包括了商品总价格，运费，保证金，优惠券等
			'order_pay_amount' => 订单实际支付的总金额
			'order_comm_amount' => 订单商户需要支付的佣金
			'payment_type' => 支付类型，是财付通支付、网银支付、货到付款等
			'open_id' => QQ 彩贝平台提供
			'login_from' => 联合登录的跳转来源
			'wh_id' => 城市代码
			'products' => 打包成 JSON 串的商品信息
			'attach' => 跟踪代码，表示广告点击的渠道、广告位、唯一标识。由彩贝平台提供,合作伙伴系统在第一次推单时回传。
			'order_create_time' => 用户在商户站点的下单时间。该时间一旦确定，后续不会变动
			'order_modify_time' => 订单在商户的最后修改时间，刚下单的时候该时间的值跟 OrderCreateTime 一致
			'province' => 订单配送省份，按照省份拼音输入
			'feedback' => 备用字段
		)
	 ******************
	 * 领克特(linktech)的 $params
	 * array (
			'uid' => 用户ID
			'cookie_info' => 记录的发送业绩时候的 Cookie 值
			'order_id' => 订单ID
			'order_create_time' => 订单下单时间
			'order_status' => 订单状态 [100:未结算(用户刚下的订单).200:核对完(交易成功).300:取消(交易失败)]
			'product_id' => 商品编号
			'product_count' => 购买的商品数量
			'product_price' => 商品单价
			'product_type' => 购买的商品分类
			'wh_id' => 登录城市ID
		)
	 ******************
	 * 亿起发(yiqifa)的 $params
	 * array (
			'cid' => 广告主在亿起发平台推广的标识,固定值,来自于接口1的cid值
			'wi' => 亿起发下级网站信息
			'uid' => 用户ID
			'order_id' => 订单号
			'order_create_time' => 订单下单时间
			'product_id' => 商品编号.如果是多个商品,请以 | 分隔
			'product_type' => 购买的商品分类
			'product_count' => 购买的商品数量
			'product_price' => 商品单价
			'wh_id' => 登录城市ID
		)
	 * @return Boolean 添加记录到DB的结果
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
	 * 批量添加
	 * @param string $source
	 * @param array $params
	 * @return boolean 成功?失败?
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
	 * 根据QQ彩贝的文档计算联合登录的vkey。
	 * @param array $params QQ彩贝POST表单
	 * @return string 根据公式计算的验证字符串
	 */
	public static function getLoginVKeyForQQCB($params) {
		ksort($params);
		$rawString = implode('', array_values($params));
		//vkey = md5(md5(raw_string+key1)+key2) 计算公式参考彩贝文档; 考虑到md5加密输出的大小写问题，约定md5的输出均为小写
		return strtolower(md5(strtolower(md5($rawString . CPSConfig::$providerList[CPSConfig::$providerQQCB]['login_key1'])) . CPSConfig::$providerList[CPSConfig::$providerQQCB]['login_key2']));
	}

	/**
	 * 根据QQ返利的文档计算联合登录的vkey。
	 * @param array $params QQ彩贝POST表单
	 * @return string 根据公式计算的验证字符串
	 */
	public static function getLoginVKeyForQQfanli($params) {
		$rawString = implode('', $params);

		//vkey = md5(md5(raw_string+key1)+key2) 计算公式参考彩贝文档; 考虑到md5加密输出的大小写问题，约定md5的输出均为小写
		return strtolower(md5(
			strtolower(md5($rawString . CPSConfig::$providerList[CPSConfig::$providerQQfanli]['login_key1']))
			. CPSConfig::$providerList[CPSConfig::$providerQQfanli]['login_key2']
		));
	}

	/**
	 * 根据QQ彩贝的文档计算推单时的vkey。
	 * @param string $attach QQ彩贝传入参数
	 * @param string $openId QQ彩贝传入参数
	 * @param string $orderCommAmount 推单参数
	 * @param string $orderCreateTime 推单参数
	 * @param string $orderId 推单参数
	 * @param string $orderModifyTime 推单参数
	 * @param string $orderPayAmount 推单参数
	 * @param string $orderPushTime 推单参数
	 * @param string $orderStatus 推单参数
	 * @param string $orderTotalAmount 推单参数
	 * @param string $paymentType 推单参数
	 * @return string 根据公式计算的验证字符串
	 */
	public static function getOrderVKeyForQQCB($attach, $openId, $orderCommAmount, $orderCreateTime, $orderId, $orderModifyTime, $orderPayAmount, $orderPushTime, $orderStatus, $orderTotalAmount, $paymentType) {
		$rawString = "{$attach}" . CPSConfig::$providerList[CPSConfig::$providerQQCB]['merchant_id']
						. "{$openId}{$orderCommAmount}{$orderCreateTime}{$orderId}{$orderModifyTime}{$orderPayAmount}{$orderPushTime}{$orderStatus}{$orderTotalAmount}{$paymentType}";
		return strtolower(md5(strtolower(md5($rawString . CPSConfig::$providerList[CPSConfig::$providerQQCB]['order_key1'])) . CPSConfig::$providerList[CPSConfig::$providerQQCB]['order_key2']));
	}

	/**
	 * 计算成果网 sig 。
	 * @param array $params 计算成果网 sig 必要的参数
	 * @return string 成果网 sig
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
	 * 联合登录GET请求中的参数
	 * @param array $params
	 * @return string 将username、shop_key和action_time三个字符串连接一起，进行MD5加密
	 */
	public static function getVerifyCodeFor51fanli(&$params) {
		$shop_key = CPSConfig::$providerList[CPSConfig::$provider51fanli]['shop_key'];

		return md5("{$params['username']}{$shop_key}{$params['action_time']}");
	}

	/********************** 暂时不用 *****************************/
	/**
	 * 记录 CPS 跳转信息，不管有无订单。
	 * @param string $source CPS 提供商
	 * @param array $params 跳转信息数组，可能有多余键值对需要过滤
	 * @return Boolean 添加记录到DB的结果
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
				return false; //无

			default:
				self::setERR(400, '找不到该CPS提供商对应的处理步骤');
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
				self::setERR(501, '写表出错');
				return false;
			}
			return $ret;
		}
		else {
			self::setERR(401, '对应的数据表不存在');
			return false;
		}
	}

	public static function getLogForQQCB() {
		$table = CPSConfig::getCorrespondingTable(CPSConfig::$providerQQCB, CPSConfig::$tableTypeLog);
		if (! empty($table)) {
			$ret = ICPSDao::getRows($table, '*');
			if ($ret === false) {
				self::setERR(502, '读表出错');
				return false;
			}
			return $ret;
		}
		else {
			self::setERR(401, '对应的数据表不存在');
			return false;
		}
	}
	*/

	/**
	 * 根据参数获取CPS订单列表。
	 * @tutorial 这个方法很撮...
	 * @param array $params 合作商传递的订单查询参数
	 * @param string $source 指明合作商
	 * @param string $where 过滤条件
	 * @param string $start 起始
	 * @param string $len 条目数
	 * @return mixed boolean false / array 找到CPS订单
	 */
	public static function getOrdersForConsult($source, $params, $where=null, $start=0, $len=10000) {
		self::clearERR();
		$ret = false;

		switch ($source) {
			case CPSConfig::$providerSHCar:
				$ret = self::consultRetForSHCar($where, $start, $len);
				break;

			case CPSConfig::$providerQQCB: //QQ彩贝
				$ret = self::consultRetForQQCB($where, $start, $len);
				break;

			case CPSConfig::$providerQQTuan: //QQTuan
				$ret = IQQTuan::consultRet($params, $where, $start, $len);
				if (false === $ret) {
					self::setERR(IQQTuan::$errCode, IQQTuan::$errMsg);
				}
				break;

			case CPSConfig::$providerLinktech: //领科特
				$where = array(
					'`is_vat_invoice` = 0',
					'`cookie_time` < (UNIX_TIMESTAMP(`order_create_time`)+86400)',
					"`order_create_time` BETWEEN '{$params['yyyymmdd']}' AND DATE_ADD('{$params['yyyymmdd']}', INTERVAL 1 DAY)"
				);
				$where = implode(' AND ', $where);
				$ret = self::consultRetForLinktech($where, $start, $len);
				break;

			case CPSConfig::$providerYiqifa: //亿起发
				$where = array(
					'`is_vat_invoice` = 0',
					"`cid` = '{$params['cid']}'",
					'`cookie_time` < (UNIX_TIMESTAMP(`order_create_time`)+86400)',
					"`order_create_time` BETWEEN '{$params['d']}' AND DATE_ADD('{$params['d']}', INTERVAL 1 DAY)"
				);
				$where = implode(' AND ', $where);
				$len = 30000; //临时提高拉取上限。2.0 中将不再进行限制。
				$ret = self::consultRetForYiqifa($where, $start, $len);
				break;

			case CPSConfig::$providerChanet: //成果
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

			case CPSConfig::$providerWeiyi: //唯一
				$where = " `is_vat_invoice` = 0
								AND `cookie_time` < (UNIX_TIMESTAMP(`order_create_time`)+86400)
								AND `order_create_time` > '{$params['starttime']}'
								AND `order_create_time` < '{$params['endtime']}' ";

				$ret = self::consultRetForWeiyi($where, $start, $len);
				break;

			case CPSConfig::$provider51bigou: //51比购
				$where = " `is_vat_invoice` = 0
								AND `cookie_time` < (UNIX_TIMESTAMP(`order_create_time`)+86400)
								AND `order_create_time` > '{$params['starttime']}'
								AND `order_create_time` < '{$params['endtime']}' ";

				$ret = self::consultRetFor51bigou($where, $start, $len);
				break;

			case CPSConfig::$provider51fanli: //51返利
				if (is_null($where)) { //查询接口调用
					$params['begin_date'] = str_replace(array('-', ':', ' '), '', $params['begin_date']);
					$params['end_date'] = str_replace(array('-', ':', ' '), '', $params['end_date']);

					if (strlen($params['begin_date']) < 6 || strlen($params['end_date']) < 6) { //param error
						Logger::err('ICPS Consult Failed, param error.');
						$ret = array();
					}
					else {
						$time_inteval = intval(substr($params['begin_date'], 0, 8)) - intval(substr($params['end_date'], 0, 8)); //警戒代码，间隔过长则在log中报警
						if ($time_inteval > 10) {
							Logger::warn("51fanli WARNED, inteval is {$time_inteval}.");
						}

						$params['begin_date'] = strlen($params['begin_date']) < 14 ? str_pad($params['begin_date'], 14, '0') : substr($params['begin_date'], 0, 14);
						$params['end_date'] = strlen($params['end_date']) < 14 ? str_pad($params['end_date'], 14, '9') : substr($params['end_date'], 0, 14);

						if (intval($params['type']) == 1) { //查询接口1
							$where = " `is_vat_invoice` = 0
									AND `cookie_time` < (UNIX_TIMESTAMP(`order_create_time`)+86400)
									AND `order_create_time` > '{$params['begin_date']}'
									AND `order_create_time` < '{$params['end_date']}' ";
							$ret = self::consuleRerFor51fanli($where, $start, $len);
						}
						else { //查询接口2
							$where = "`name` like '%@51fanli'
									AND `is_vat_invoice` = 0
									AND `cookie_time` < (UNIX_TIMESTAMP(`order_create_time`)+86400)
									AND `order_create_time` > '{$params['begin_date']}'
									AND `order_create_time` < '{$params['end_date']}' ";
							$ret = self::consuleRerFor51fanli($where, $start, $len);
						}
					}
				}
				else { //脚本调用
					$ret = self::consuleRerFor51fanli($where, $start, $len);
				}
				break;
			case CPSConfig::$provider163Youdao: //网易有道 add by wheelswang
				$condition = "`order_create_time` >= '{$params['sd']}000000' AND `order_create_time` <= '{$params['ed']}235959'";
				if($where)
					$where .= ' AND '.$condition;
				else 
					$where = $condition;
				$ret = self::consuleRerFor163Youdao($where, $start, $len);
				break;
			default:
				self::setERR(400, '找不到该CPS提供商对应的处理步骤');
				break;
		}

		return $ret;
	}

	/**
	 * 返回的结果集
	 * @param array $param CPS 参数 [QQCB 不需要]
	 * @param string $table 表名
	 * @param string $where 过滤条件
	 * @return array 找到CPS订单，补齐需要的商品、价格信息
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
			$orderCommAmount = ($cpsOrder['is_vat_invoice'] == '1') ? 0 : $cpsOrder['order_comm_amount']; //增票订单不返利
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
	 * 返回的结果集
	 * @param array $param CPS 参数
	 * array(
	 *	 'yyyymmdd' => 20110101
	 * )
	 * @param int $start 开始数
	 * @param int $len 限制数
	 * @return array 找到CPS订单，补齐需要的商品、价格信息
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
				//2 因为是CPS业绩(摘自领科特文档)
		}

		return $orderRets;
	}

	/**
	 * 返回的结果集
	 * @param array $params CPS 参数
	 * array(
	 *	 'src' => donot care
	 *	 'cid' => xxx
	 *	 'd' => 20110101
	 * )
	 * @param int $start 开始数
	 * @param int $len 限制数
	 * @return array 找到CPS订单，补齐需要的商品、价格信息
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
	 * 返回的结果集
	 * @param array $params CPS 参数
	 * array(
	 *	 'src' => donot care
	 *	 'cid' => xxx
	 *	 'd' => 20110101
	 * )
	 * @param int $start 开始数
	 * @param int $len 限制数
	 * @return array 找到CPS订单，补齐需要的商品、价格信息
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
				if ($item['isCouponProduct']) { //特价商品不返利
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
	 * 返回的结果集
	 * @param array $params CPS 参数
	 * @param int $start 开始数
	 * @param int $len 限制数
	 * @return array 找到CPS订单，补齐需要的商品、价格信息
	 *
	 * @tutorial 和weiyi技术沟通的结果，由于 icson 的支付方式是以订单价格为依据，故
	 * pid 不需要传值了；
	 * ptype 由订单价确定；
	 * pnum 总传 1；
	 * price 为订单价，以元为单位。
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
			$price = floor($cpsOrder['order_pay_amount'] / 100); //减去运费
			$orderRets[] = $cpsOrder['order_create_time'] //order_date
							. $sep . $cpsOrder['cid'] //cid
							. $sep . $cpsOrder['uid'] //uid
							. $sep . $cpsOrder['order_id'] //order_id
							. $sep . '' //pid 置为 空
							. $sep . self::convertPaymentTypeForWeiyi($cpsOrder['order_pay_amount']) //ptype 根据 order[cash] 获得
							. $sep . 1 //product_num 商品数量 置为 1
							. $sep . $price
							. $sep . self::convertOrderStatusForWeiyi($cpsOrder['order_status'])
							. $nl;
		}

		return $orderRets;
	}

	/**
	 * 返回51比购需要的结果集
	 * @param string $where 查询条件
	 * @param int $start 开始数
	 * @param int $len 限制数
	 * @return array 找到CPS订单，补齐需要的商品、价格信息
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
							. $sep . $cpsOrder['u_id'] //u_id - cookie 中保存的 u_id
							. $sep . $price //返利价格
							. $sep . $commision //佣金
							. $nl;
		}

		return $orderRets;
	}

	/**
	 * 返回51返利需要的结果集
	 * @param string $where 查询条件
	 * @param int $start 开始数
	 * @param int $len 限制数
	 * @return array 找到CPS订单，补齐需要的商品、价格信息
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
			if ($cpsOrder['is_vat_invoice'] == '1') { //增税发票订单，约定不返回
				continue;
			}

			$order_ret['sysno'] = $cpsOrder['sysno']; //脚本需要
			$order_ret['order_id'] = $cpsOrder['order_id']; //脚本需要

			$order_ret['order_no'] = $cpsOrder['order_id'];
			$order_ret['order_time'] = $cpsOrder['order_create_time'];
			$order_ret['shop_no'] = CPSConfig::$providerList[CPSConfig::$provider51fanli]['shop_no'];
			$order_ret['shop_key'] = CPSConfig::$providerList[CPSConfig::$provider51fanli]['shop_key'];

			$order_ret['total_price'] = $cpsOrder['order_pay_amount'] / 100; //转换到单位"元"
			$order_ret['total_qty'] = 0; // 初始为0

			$order_ret['u_id'] = $cpsOrder['u_id'];
			$order_ret['username'] = $cpsOrder['name'];
			$order_ret['is_pay'] = (intval($cpsOrder['order_status']) == 10) ? 1 : 0;
			$order_ret['pay_type'] = $cpsOrder['payment_type'];
			$order_ret['order_status'] = (intval($cpsOrder['order_status']) == 10) ? 5 : $cpsOrder['order_status']; //5 已收货

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
				$order_ret['product_all'][$item['product_id']]['comm_no'] = ($item['isCouponProduct'] == '1') ? 'CouponProduct' : ''; //CouponProduct 为 双方约定标记

				$order_ret['total_qty'] += $item['buy_num']; // total_qty 为购买的商品总数
			}
//			$order_ret['coupons_all'] = array(); //去掉 coupons_all 节点

			array_push($ret, $order_ret);
		}

		return $ret;
	}
	/**
	 * 返回网易有道cps订单数据
	 * @param string $where 查询条件
	 * @return array 返回订单信息，实时查询订单状态
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
	 * 转换成51fanli需要的XML格式
	 * @param array $orders 拼装好的订单相关信息
	 * @return string XML数据
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
	 * 将订单数据转化成CSV格式
	 * @param array $order
	 * @return string CSV信息
	 * add by wheelswang
	 */
	public static function convertToCSVFor163Youdao($orders) {
		$ret = "订单编号,状态,用户ID,下单时间,有效金额\n";
		foreach($orders as $order) {
			$order['order_pay_amount'] /= 100;
			$order['order_pay_amount'] = sprintf('%.2f',$order['order_pay_amount']);
			$ret .= "{$order['order_id']},{$order['order_status']},{$order['user_id']},{$order['order_create_time']},{$order['order_pay_amount']}\n";
		}
		return $ret;
	}
	/**
	 * 返回的结果集
	 * @param string $where
	 * @param int $start 开始数
	 * @param int $len 限制数
	 * @return array 找到CPS订单，补齐需要的商品、价格信息
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
	 * 易迅的支付类型转换到彩贝的支付类型
	 * @param string $whid 城市ID
	 * @param string $paymentType 易迅的支付类型
	 * @return string 彩贝的支付类型
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
	 * 易迅的商品类别转换到彩贝的商品类别
	 * @param string $productId 易迅的商品ID
	 * @return string 彩贝的商品类别
	 */
	private static function convertProductTypeForQQCB($product_id) {
		$product_base_info = IProduct::getBaseInfo($product_id);
		$c2_ret = ICategoryTTC::get($product_base_info['c3_ids'], array('level'=>3));
		$c1_ret = ICategoryTTC::get($c2_ret[0]['parent_id'], array('level'=>2));
		return CPSConfig::$providerList[CPSConfig::$providerQQCB]['productTypeMap'][$c1_ret[0]['parent_id']];
	}

	/**
	 * 获得QQ彩贝需要的 products json 串。
	 * @param string $orderId 订单ID
	 * @param array $dbInfo 分库分表规则
	 * @return mixed array; false
	 */
	private static function getProductsByOrderForQQCB($uid, $order_id) {
		$ret = array();

		$order_items = IOrder::getOrderItems($uid, $order_id);
		foreach ($order_items as &$item) {
			if ($item['isCouponProduct']) { //特价商品不返利
				continue;
			}
			else {
				$item['product_type'] = self::convertProductTypeForQQCB($item['product_id']); //商品类型转换
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
	 * 计算实际需要支付给QQCB的金额
	 * @param int $price 订单总价
	 * @return int 佣金
	 */
	public static function getCommAmountForQQCB($price, $loginFromQQCB=false) { //默认不是彩贝登录，comm价格低一些
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
	 * 订单状态转换
	 * @param string $source CPS 提供商
	 * @param int $status 订单状态
	 * @param array $cpsOrder CPS订单信息
	 * @return mixed string 相应订单状态 / false 没找到相应的状态
	 */
	public static function convertOrderStatus($source, $status, $cpsOrder) {
		$ret = false;

		switch ($source) {
			case CPSConfig::$providerSHCar:
				$ret = $status; //上汽的订单状态不转换
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
	 * icson 订单状态到 QQCB 的映射关系
	 * @param int $status icson订单状态
	 * @return int QQCB 规定的订单状态
	 */
	public static function convertOrderStatusForQQCB($status) {
		switch ($status) {
			case -5: //部分退货
			case -4: //全部退货
			case -3: //主管作废
			case -2: //客户作废
			case -1: //员工作废
				return '21'; //订单作废

			case 0: //待审核
			case 1: //待出库
			case 2: //待支付
			case 3: //待主管审
				return '10'; //用户已下单

			case 4: //已出库
				return '11'; //商户已发货

			default:
				return false; //无对应值
		}
	}

	/**
	 * icson 订单状态到 Linktech 的映射关系
	 * @param int $status icson订单状态
	 * @return int Linktech 规定的订单状态
	 */
	public static function convertOrderStatusForLinktech($status) {
		switch ($status) {
			case -5: //部分退货
			case -4: //全部退货
			case -3: //主管作废
			case -2: //客户作废
			case -1: //员工作废
				return 300; //订单作废

			case 0: //待审核
			case 1: //待出库
			case 2: //待支付
			case 3: //待主管审
			case 4: //已出库
				return 100; //订单处理中

			default:
				return false; //无对应值
		}
	}

	/**
	 * icson 订单状态到 Linktech 的映射关系
	 * @param int $status icson订单状态
	 * @return int Linktech 规定的订单状态
	 */
	public static function convertOrderStatusForYiqifa($status) {
		switch ($status) {
			case -5: //部分退货
			case -4: //全部退货
			case -3: //主管作废
			case -2: //客户作废
			case -1: //员工作废
				return 2; //退单

			case 0: //待审核
			case 1: //待出库
			case 2: //待支付
			case 3: //待主管审
			case 4: //已出库
				return 0; //订单处理中

			default:
				return false; //无对应值
		}
	}

	/**
	 * icson 订单状态到 weiyi 的映射关系
	 * @param int $status icson订单状态
	 * @return int weiyi 规定的订单状态
	 */
	public static function convertOrderStatusForWeiyi($status) {
		switch ($status) {
			case -5: //部分退货
			case -4: //全部退货
			case -3: //主管作废
			case -2: //客户作废
			case -1: //员工作废
				return 2; //weiyi 核对无效

			case 0: //待审核
			case 1: //待出库
			case 2: //待支付
			case 3: //待主管审
			case 4: //已出库
				return 0; //weiyi 未核对

			default:
				return false; //无对应值
		}
	}

	/**
	 * icson 订单状态到 51fanli 的映射关系, 添加订单状态 10 表示 51fanli 订单的 is_pay (已支付)
	 * @param int $status icson订单状态
	 * @return int weiyi 规定的订单状态
	 */
	public static function convertOrderStatusFor51fanli($status) {
		switch ($status) {
			case -5: //部分退货
				return 6; //51fanli 部分退货

			case -4: //全部退货
				return 7; //51fanli 全部退货

			case -3: //主管作废
			case -2: //客户作废
			case -1: //员工作废
				return -1; //51fanli 取消订单

			case 0: //待审核
			case 3: //待主管审
				return 1; //51fanli 待审核

			case 1: //待出库
				return 3; //51fanli 待发货

			case 4: //已出库
				return 4; //51fanli 配送中

			case 2: //待支付
			default:
				return false; //无对应值
		}
	}

	/**
	 * icson 订单状态到 51bi 的映射关系
	 * @param int $status icson订单状态
	 * @return int 51bi 规定的订单状态
	 */
	public static function convertOrderStatusFor51bigou($status) {
		switch ($status) {
			case -5: //部分退货
			case -4: //全部退货
			case -3: //主管作废
			case -2: //客户作废
			case -1: //员工作废

			case 0: //待审核
			case 1: //待出库
			case 2: //待支付
			case 3: //待主管审
			case 4: //已出库

			default:
				return false; //51比购的文档中没发现需要返回订单状态
		}
	}
	/**
	 * icson 订单状态到 网易有道 的映射关系 经过沟通，不需要映射，直接返回
	 * @param int $status icson订单状态
	 * @return int 163Youdao 规定的订单状态
	 */
	
	public static function convertOrderStatusFor163Youdao($status) {
		return $status;
	}
	/**
	 * 根据orderId检查订单中 cpsinfo 字段是否为空；如果不为空，再检查是否能解析成相应的 cookie 信息；根据解析出的 cookie 信息进行接下来的操作。
	 *
	 * @tutorial 用 link 的方式发送订单数据，只在下单成功之后的确认页。所以，有些数据是固定的。例如：订单状态都是初始的。
	 * @param string $uid 用户ID.
	 * @param string $orderId 订单ID.
	 * @param sring $append 附加 CPS 提供商地址
	 * @return array 订单信息
	 */
	public static function convertCPSOrderToLink($uid, $orderId, $append=false) {
		self::clearERR();

		$ret = false;

		$order = IOrder::getOneOrder($uid, $orderId);
		if ($order === false) {
			self::setERR(500, "get order {$orderId} FAILED.");
			return false; //未找到订单
		}
		if (empty($order['cpsinfo'])) {
			self::setERR(404, "order {$orderId} isnot cps order.");
			return ''; //不是 cps 订单
		}

		$cpsCookie = self::unpackCookie($order['cpsinfo']); //解析订单表中记录的 cps cookie 信息

		if (is_array($cpsCookie) && count($cpsCookie) > 0) { //解析成功
			$source = array_pop(array_keys($cpsCookie));
			$cookieInfo = array_pop(array_values($cpsCookie));

			//此处之下，可以使用的变量仅仅是 $order, $uid 和 cps 订单入库时记录的 cookie
			if (array_key_exists($source, CPSConfig::$providerList)) {
				//除QQCB 外，其他只推第一天订单
				if ($order['order_date'] > $cookieInfo['cookie_time'] && $order['order_date'] <= ($cookieInfo['cookie_time'] + 86400)) { //cookie 时间戳合理
					$order_items = IOrder::getOrderItems($uid, $orderId);
					if ($order_items === false) {
						self::setERR(501, "get order_items {$orderId} FAILED, " . IOrder::$errCode . '-' . IOrder::$errMsg);
						return false; //未找到订单
					}

					$cpsOpder = self::getOneCPSOrder($source, $order['order_char_id']);
					if (false === $cpsOpder || empty($cpsOpder)) {
						self::setERR(502, "get cpsOrder {$order['order_char_id']} FAILED, " . self::$errCode . '-' . self::$errMsg);
						return false; //未找到cps订单
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
								$type = self::convertPaymentTypeForLinktech($order['cash']); //该订单在linktech的类型
								$order['cash'] = ($order['cash'] == 0) ? 0 : ($order['cash'] / 100);

								$ret = "a_id={$cookieInfo['cookie']}"
										. "&m_id=" . CPSConfig::$providerList[CPSConfig::$providerLinktech]['merchant_id']
										. "&mbr_id={$uid}"
										. "&o_cd={$orderId}"
										. "&p_cd=1" //约定
										. "&it_cnt=1" //约定
										. "&price={$order['cash']}"
										. "&c_cd={$type}";
								$ret = $append ? CPSConfig::$providerList[CPSConfig::$providerLinktech]['syncURL'] . "?{$ret}" : $ret;
							break;

							case CPSConfig::$providerYiqifa:
								$sd = urlencode(date('Y-m-d H:i:s', $order['order_date']));

								//和亿起发技术沟通的结果，传参沿用过去的方式：
								//“商品编号”置为空；
								//“商品类型”为订单类型（1 [成功订单]；2 [退单]）；事实上传的都是1，然后线下对单
								//“商品数量”为 1；
								//“商品单价”为订单实际支付价格；
								//“下单时间”为订单生成时间

								//不带 syncURL ，仅仅是 query 部分
								$cpsOpder = self::getOneCPSOrder($source, $order['order_char_id']);
								$order['cash'] = ($cpsOpder['is_vat_invoice'] == '1') ? 0 : ($cpsOpder['order_pay_amount'] / 100); //减去运费和特价商品价格

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
									//不带 syncURL ，仅仅是 query 部分
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
								$price = ($cpsOpder['is_vat_invoice'] == '1') ? 0 : $cpsOpder['order_pay_amount']; //减去运费和特价商品价格
								$ptype = self::convertPaymentTypeForWeiyi($price); //该订单在 weiyi 侧的类型
								$price = $price / 100; //唯一是以“元”为单位

								//其他几个必须的参数,写这只是为了清楚
								//$mid = CPSConfig::$providerList[CPSConfig::$providerWeiyi]['merchant_id'];
								//$odate = date('YmdHis', $order['order_date']);
								//$cid = $cookieInfo['cid'];
								//$bid = $uid;
								//$oid = $order['order_char_id'];

								//和weiyi技术沟通的结果，由于 icson 的支付方式是以订单价格为依据，故
								//pid 不需要传值了；
								//ptype 由订单价确定；
								//pnum 总传 1；
								//price 为订单价；

								//不带 syncURL ，仅仅是 query 部分
								$ret = 'mid=' . CPSConfig::$providerList[CPSConfig::$providerWeiyi]['merchant_id']
										. '&odate=' . date('YmdHis', $order['order_date'])
										. "&cid={$cookieInfo['cid']}"
										. "&bid={$uid}"
										. "&oid={$order['order_char_id']}"
										. "&pid="
										. "&ptype={$ptype}"
										. "&pnum=1"
										. "&price={$price}"
										. "&ostat=0"; //ostat 为初始订单状态 0

								$ret = $append ? CPSConfig::$providerList[CPSConfig::$providerWeiyi]['syncURL'] . "?{$ret}" : $ret;
							break;

							case CPSConfig::$provider51bigou:
								$cpsOpder = self::getOneCPSOrder($source, $order['order_char_id']);
								$ip = ($cpsOpder) ? $cpsOpder['ip'] : '0';
								$mcode = md5("{$cookieInfo['u_id']}{$order['order_char_id']}");

								$cost = ($cpsOpder['is_vat_invoice'] == '1') ? 0 : ($cpsOpder['order_pay_amount']); //减去运费
								$commision = self::getCommAmountFor51bigou($cost);
								$cost = $cost / 100; //51bigou 以“元”为单位

								$ret = 'bid=' . CPSConfig::$providerList[CPSConfig::$provider51bigou]['merchant_id']
										. '&uid=' . $cookieInfo['u_id'] //不是 $uid
										. "&oid={$order['order_char_id']}"
										. "&cost={$cost}"
										. "&cback={$commision}"
										. "&ip={$ip}"
										. "&mcode={$mcode}"; //ostat 为初始订单状态 0

								$ret = $append ? CPSConfig::$providerList[CPSConfig::$provider51bigou]['syncURL'] . "?{$ret}" : $ret;
							break;

							default:
								$ret = ''; //其他source 无需反馈
						}
					}
				}
				else { //通过 cookie 中的时间戳判定不是第一天
					return '';
				}
			}
			else {
				self::setERR(504, "{$source} NOT Supported");
			}
		}
		else {
			self::setERR(505, "cpsinfo {$orderId} BROKEN"); //cpsinfo 字段无法解析以供操作
		}

		return $ret;
	}

	/**
	 * 易迅的支付类型转换到领科特的支付类型，跟领科特确认的结果是：
	 * “分类编号”是每个订单按照“实际销售”而定，和商品没什么关系
	 * @param int $price 订单的用户支付货款
	 * @return string 领科特的支付类型
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
	 * 成果网根据“商品价格”标注“商品类型”。
	 * @param int $price 商品单价
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
	 * 转换成 “成果网” 的支付方式。
	 * 货到付款				1
	 * 在线支付-支付宝		2
	 * 在线支付-财付通		3
	 * 在线支付-快钱		4
	 * 在线支付-其他		5
	 * 邮局汇款				6
	 * 银行转帐				7
	 * 礼券支付				8
	 * 其他						9
	 * @param string $whid 城市ID
	 * @param string $paymentType 易迅的支付类型
	 * @return int 成果网的支付方式
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
	 * 转换成 “成果网” 的订单状态。
	 * 已支付	1	用户成功支付订单（含所有支付方式）
	 * 已发货	2	商家发出商品
	 * 已签收	3	用户收到并签收商品
	 * 已退货	4	用户收到商品后提出退货
	 * 已取消	5	用户支付后，但未收到商品时，提出取消订单
	 * 已完成	6	用户收到商品，并过退换货保障期，订单完成
	 * 商品缺货	7	订单商品缺货，无法发货
	 * 商品预订	8	订单商品含预售商品，无法发货
	 * @param string $status 订单状态
	 * @return int 成果网的订单状态
	 */
	private static function convertOrderStatusForChanet($status) {
		switch ($status) {
			case -5: //部分退货
			case -4: //全部退货
				return 4; //退货

			case -3: //主管作废
			case -2: //客户作废
			case -1: //员工作废
				return 5; //取消

			case 2: //待支付
			case 4: //已出库
				return 2; //发货

			case 0: //待审核
			case 1: //待出库
			case 3: //待主管审
			default:
				return 0; //无对应值
		}
	}

	/**
	 * 将订单对应的商品转换成“成果网”所需的字符串形式
	 * @param int $uid 用户ID
	 * @param int $orderId 订单ID
	 * @return mixed string 转换成功； false 转换失败
	 */
	private static function convertProductStrForChanet($uid, $orderId, $products = array()) {
		self::clearERR();

		$ret = false;

		$products = empty($products) ? IOrder::getOrderItems($uid, $orderId) : $products;
		if (is_array($products) && count($products)>0) {
			$productItems = array();
			foreach($products as &$product) {
				if ($product['isCouponProduct']) { //特价商品不计算
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
	 * 由“价格区间”定义的订单的“类型”
	 * @param int $price 用户支付的用于计算返利的金额
	 * @return string 唯一需要的支付类型
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
	 * 根据价格，返回51比购的返利。注意，返还给51bi的佣金,小数点后保留两位小数
	 * @param int $price
	 * @return float 返利
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
	 * 获得存储的usersafekey
	 * @param int $uid 用户ID
	 * @return string 用户对应的 usersafekey
	 */
	public static function getUserSafeKeyFor51fanli($uid) {
		$usersafekey = false;

		$userinfo = ICPSDao::getRows('t_cps_user_51fanli', '*', "`uid`= {$uid}");
		if (false === $userinfo) { //失败
			self::setERR(ICPSDao::$errCode, ICPSDao::$errMsg);
		}
		else if (count($userinfo)==1) { //成功
			$userinfo = $userinfo[0];
			$usersafekey = $userinfo['usersafekey'];
		}
		else {
			$usersafekey = 0; //无记录
		}

		return $usersafekey;
	}

	/**
	 * 存储的usersafekey
	 * @param int $uid 用户ID
	 * @param string $usersafekey 用户对应的usersafekey
	 * @return mixed 存储的结果
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
	 * 获得同步到erp记录的key
	 * @param string $source 提供商类型
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
	 * 用户实际支付金额减去特价商品金额
	 * @param array $submitOrder IOrder::checkShippingCart 返回值
			'errCode'=>0,
			'uid'=>$newOrder['uid'],
			'orderId'=>$parentOrderId,
			'orderAmt'=> $orderShipPrice + $orderPrice - $newOrder['point'] - $couponInfo['amt'],
			'payType'=>$newOrder['payType'],
			'payTypeIsOnline' => $_PAY_MODE[$wh_id][$newOrder['payType']]['IsNet'],
			'payTypeName' => $_PAY_MODE[$wh_id][$newOrder['payType']]['PayTypeName'],
			'orderTotalAmt'=>$orderShipPrice + $orderPrice, //订单总金额
			'payGoodsAmt' => $product_cash, //订单客户支付的金额（去掉运费和享受到的其它优惠后的用户实际支付金额）
			'orderCreateTime'=>$now,
			'isParentOrder' => $orderNum > 1 ? true : false,
			'isVATInvoice' => ($newOrder['invoiceType'] == INVOICE_TYPE_VAT) ? true : false, //是否为增值税发票
			'order_items' => $newOrder['order_items']
	 * @return int
	 */
	public static function getUserPayAmount(&$submitOrder) {
		if ($submitOrder['isVATInvoice']) { //增票订单
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

		return ($submitOrder['payGoodsAmt']) >= 0 ? $submitOrder['payGoodsAmt'] : 0; //积分，优惠卷可能是这部分金额变成负数
	}

	/**
	 * 针对拆单情况，编写的用户支付计算方式
	 * @param array $submitOrder
	 * @param array $subOrder
	 * @return int
	 */
	public static function getUserPayAmountForBatch(&$submitOrder, &$subOrder) {
		if ($submitOrder['isVATInvoice']) { //增票订单
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

		return ($submitOrder['payGoodsAmt']) >= 0 ? $submitOrder['payGoodsAmt'] : 0; //积分，优惠卷可能是这部分金额变成负数
	}

	/**
	 * 处理下单返回的子订单串
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
	 * 转换 OrderID
	 * @param string $orderId
	 * @return string
	 */
	private static function _converOrderId($orderId) {
		$mod = 1000000000;
		return ($orderId % $mod) + $mod;
	}

	/**
	 * 拆单是拼装批量子订单
	 * @param array $initAry 部分信息会根据 $submitOrder 修改
	 * @param array $submitOrder
	 * @param boolean $loginFromQQCB
	 * @return array
	 */
	private function _makeupAry($initAry, &$submitOrder, $loginFromQQCB = null) {
		$ret = array();
		$i = 0;
		foreach ($submitOrder['subOrders'] as $stockId => &$subOrder) {
			$ret[$i] = $initAry;

			//需要被重写的key
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