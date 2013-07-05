<?php
/**
 * Created by JetBrains PhpStorm.
 * User: clydechang
 * Date: 12-12-4
 * Time: 上午11:32
 * To change this template use File | Settings | File Templates.
 */

if (!defined("PHPLIB_ROOT")) {
	define('PHPLIB_ROOT', '/data/release/PHPLIB/');
}

require_once(PHPLIB_ROOT . "lib/Config.php");

/**
 * 发票类
 */
class EA_Invoice
{
	/**
	 * 错误码
	 * @var int
	 */
	public static $errCode = 0;

	/**
	 * 错误提示
	 * @var string
	 */
	public static $errMsg = "";


	const INVOICE_TYPE_RETAIL_PERSONAL = 1;
	const INVOICE_TYPE_VAT = 2;
	const INVOICE_TYPE_RETAIL_COMPANY = 3;
	const INVOICE_TYPE_VAT_NORMAL = 4;
	const INVOICE_TYPE_CP_UNICOM = 5;
	const INVOICE_TYPE_CP_TELCOM = 6;
	const INVOICE_TYPE_CP_MOBILE = 7;
	const INVOICE_TYPE_VAT_NORMAL_NEW = 8;
	const INVOICE_TYPE_TITLE = 9;

	public static $whidInvoice = array(
		SITE_SZ  => array(
			self::INVOICE_TYPE_VAT,
			self::INVOICE_TYPE_VAT_NORMAL,
		),
		/* SITE_ALL 表示其他站点 */
		SITE_ALL => array(
			self::INVOICE_TYPE_VAT,
			self::INVOICE_TYPE_RETAIL_PERSONAL,
			self::INVOICE_TYPE_RETAIL_COMPANY,
		),
	);

	/**
	 * 模糊开票配置项
	 * @var array
	 */
	public static $_FuzzyInvoiceMap = array(
		'1' => '商品明细',
		'2' => '办公用品',
		'3' => '核心配件',
		'4' => '耗材',
		'5' => '电脑外设',
		'6' => '电脑整机',
		'7' => '附件',
		'8' => '办公设备',
		'9' => '数码产品',
		'10' => '汽车服务',
		'11' => '精品家电',
		'12' => '食品',
		'13' => '礼品',
		'14' => '日化',
		'15' => '软件',
	);
	/**
	 * 模糊开票配置
	 * @var array 1维key 是 商品小类；2维key是用于排序的权值；2维value是虚拟开票的名称
	 */
	public static $_FuzzyInvoiceConf = array(
		1005 => array( '2', '3', '4', '5', '6', '7', ),
		7 => array( '2', '4', '8', ),
		1007 => array( '2', '9', ),
		384 => array( '10', ),
		1009 => array( '11', ),
		2041 => array( '2', '12', '13', '14', '15', ),
	);

	/**
	 * @static
	 * @param $uid 用户id
	 * @param $filter 过滤条件
	 * @return array|bool
	 */
	public static function get($uid, $filter = array())
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'uid is null';
			return false;
		}


		// 设置 数据源 过滤条件
		if (!isset($filter['status']))
			$filter['status'] = INVOICE_STATUS_OK;

		$invoice = self::_getInvoice($uid, $filter);

		// 分站ID，在拉取完数据之后再过滤
		if (!empty($filter['wh_id'])) {
			// 根据站点ID来区分发票类型
			$wh_id = $filter['wh_id'];
			$invoice = self::filterInvoiceTypeByWhId($wh_id, $invoice);
			if ( false === $invoice) {
				Logger::err("过滤发票失败" . self::$errMsg);
				$invoice = array();
			}
		}

		return $invoice;
	}


	/**
	 * @static
	 * @param $uid 用户id
	 * @param $newInvoice 发票内容
	 * @return bool|int
	 */
	public static function insert($uid, $newInvoice)
	{
		Logger::info(var_export($uid, true));
		Logger::info(var_export($newInvoice, true));
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'uid is null';
			return false;
		}


		if (!self::checkFieldByType($newInvoice))
			return false;


		// 检查非法字符
		if (!self::checkIsValidInvoiceData($newInvoice)) { 			;
			return false;
		}


		$newId = self::getInvoiceId();
		if (false === $newId)
			return false;


		//默认为正常状态
		$now = time();
		$newInvoice['status'] = INVOICE_STATUS_OK;
		$newInvoice['sortfactor'] = 0;
		$newInvoice['iid'] = $newId;
		$newInvoice['uid'] = $uid;
		$newInvoice['updatetime'] = $now;
		$newInvoice['createtime'] = $now;


		$ret = self::_insertInvoice($newInvoice);
		if (false === $ret) {
			self::$errCode = EA_Invoice::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[insert new invoice to IUserInvoiceBookTTC failed:" . EA_Invoice::$errMsg . "]";
			return false;
		}

		// insert modify time for asyn to ERP
		$ret = IUserInvoiceSyn::add($newInvoice);
		if (false === $ret) {
			Logger::warn("insert into ERP error" . IUserInvoiceSyn::$errMsg . ",Invoice:" . var_export($newInvoice, true));
		}

		return $newId;
	}

	/**
	 * @static 逻辑层，更新发票
	 * @param $newInvoice 发票内容
	 * @param $filter 过滤条件
	 * @return bool
	 */
	public static function update($newInvoice, $filter)
	{
		Logger::info(var_export($filter, true));
		Logger::info(var_export($newInvoice, true));
		if (!isset($newInvoice['uid']) || $newInvoice['uid'] <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'uid is null';
			return false;
		}

		if (!isset($filter['iid']) || $filter['iid'] <= 0) {
			self::$errCode = 62;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'iid is null';
			return false;
		}
		$iid = $filter['iid'];

		if (!isset($newInvoice) || count($newInvoice) == 0) {
			self::$errCode = 65;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'new invoice is null';
			return false;
		}

		$iid = $filter['iid'];
		$newInvoice['updatetime'] = time();

		// 检查必备的字段
		if (!self::checkFieldByType($newInvoice))
			return false;

		// 检查非法字符
		if (!self::checkIsValidInvoiceData($newInvoice)) {
			return false;
		}

		$newInvoice['updatetime'] = time();

		// 更新发票
		if (!self::_updateInvoice($newInvoice, $filter)) {
			self::$errCode = IUserInvoiceBookTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[modify user invoice($iid) from IUserInvoiceBookTTC failed:" . IUserInvoiceBookTTC::$errMsg . "]";
			return false;
		}

		$lines = self::_getAffectRows();
		if (1 != $lines) {
			self::$errCode = 65;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[modify user invoice($iid) affect $lines rows";
			return false;
		}

		$newInvoice['iid'] = $iid;

		// update asyn to ERP
		$ret = IUserInvoiceSyn::update($newInvoice);
		if (false === $ret) {
			Logger::warn("insert into ERP error" . IUserInvoiceSyn::$errMsg . ",Invoice:" . var_export($newInvoice, true));
		}

		return $iid;
	}

	/**
	 * @static 逻辑层，删除发票
	 * @param $uid
	 * @param $iid
	 * @return bool
	 */
	public static function del($uid, $iid)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'uid is null';
			return false;
		}

		if (!isset($iid) || $iid <= 0) {
			self::$errCode = 62;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'aid is null';
			return false;
		}

		$newInvoice['uid'] = $uid;
		$newInvoice['status'] = INVOICE_STATUS_DELETED;
		$newInvoice['updatetime'] = time();

		// 标记删除，不做物理删除
		$ret = self::_updateInvoice($newInvoice, array('iid'=> $iid));
		if (false === $ret) {
			self::$errCode = IUserInvoiceBookTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[delete user invoice($iid) from IUserInvoiceBookTTC failed:" . IUserInvoiceBookTTC::$errMsg . "]";
			return false;
		}

		$lines = self::_getAffectRows();
		if (1 != $lines) {
			self::$errCode = 65;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[modify user invoice($iid) affect $lines rows";
			return false;
		}

		// delete modify time for asyn to ERP
		IUserInvoiceSyn::delete(array('uid'=> $uid, 'iid'=> $iid));
		return true;
	}

	/**
	 * 获取可选的发票种类
	 */
	public static function getInvoicesContentOpt($c3ids, $wh_id) {
		$contentOpt = array('1'); //默认值
		$isCanFuzzyInvoice = true;

		if ($wh_id == SITE_SH || $wh_id == SITE_BJ) {
			$c3Info = ICategoryTTC::gets($c3ids, array('level' => 3, 'status' => 0), array('parent_id', 'flag')); //获取小类ID
			if (is_array($c3Info)) { //成功
				$c2ids = array();
				foreach ($c3Info as $c3) {
					if (($c3['flag'] & FUZZY_INVOICE) != FUZZY_INVOICE) { //不可以模糊开票
						$isCanFuzzyInvoice = false;
						break;
					}
					$c2ids[] = $c3['parent_id'];
				}

				if ($isCanFuzzyInvoice && (! empty($c2ids))) {
					$c2ids = array_unique($c2ids);
					$c2Info = ICategoryTTC::gets($c2ids, array('level' => 2, 'status' => 0), array('parent_id'));
					if (is_array($c2Info)) {
						$_FuzzyInvoiceConf = EA_Invoice::$_FuzzyInvoiceConf;
						foreach ($c2Info as $c2) {
							if (isset($_FuzzyInvoiceConf[intval($c2['parent_id'])])) {
								$contentOpt = array_merge($contentOpt, $_FuzzyInvoiceConf[intval($c2['parent_id'])]);
							}
						}
					}
					$contentOpt = array_unique($contentOpt);
				}
			}
		}

		// contentOpt 中可能有重复的元素被unique删除了，需要重新排序，否则json返回的时候用的是key-value的格式，在ios上会出错
		sort($contentOpt);

		$ret = array();
		foreach($contentOpt as $k) {
			if (isset(EA_Invoice::$_FuzzyInvoiceMap[$k])) {
				$ret[] = EA_Invoice::$_FuzzyInvoiceMap[$k];
			}
		}

		return $ret;
	}

	/**
	 * @static 获取指定分站所允许的发票类型
	 * @param $wh_id 分站ID
	 * @return 可选的发票类型
	 */
	public static function getInvoicesWhType($wh_id)
	{
		$invoice_wh_id = ($wh_id == SITE_SZ) ? SITE_SZ : SITE_ALL;
		return EA_Invoice::$whidInvoice[$invoice_wh_id];
	}


	/**
	 * @static 数据层，读取数据源
	 * @param $uid
	 * @param $filter
	 * @return array|bool
	 */
	private static function _getInvoice($uid, $filter)
	{
		if (isset($filter['wh_id']))
			unset($filter['wh_id']);

		$ret = IUserInvoiceBookTTC::get($uid, $filter);
		if (false === $ret) {
			self::$errCode = IUserInvoiceBookTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[get INVOICE :" . IUserInvoiceBookTTC::$errMsg . "]";
			return false;
		}
		return $ret;
	}

	/**
	 * @static 数据层，写入数据源
	 * @param $newInvoice
	 * @return bool
	 */
	private static function _insertInvoice($newInvoice)
	{
		$ret = IUserInvoiceBookTTC::insert($newInvoice);
		if (false === $ret) {
			self::$errCode = IUserInvoiceBookTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[insert new invoice to IUserInvoiceBookTTC failed:" . IUserInvoiceBookTTC::$errMsg . "]";
			return false;
		}
		return $ret;
	}

	/**
	 * @static 数据层，更新数据源
	 * @param       $newInvoice
	 * @param array $filter
	 * @return bool
	 */
	private static function _updateInvoice($newInvoice, $filter = array())
	{
		$ret = IUserInvoiceBookTTC::update($newInvoice, $filter);
		if (false === $ret) {
			self::$errCode = IUserInvoiceBookTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[update user invoice failed:" . var_export($newInvoice, true) . ",filter:" . var_export($filter, true) . IUserInvoiceBookTTC::$errMsg . "]";
			return false;
		}
		return $ret;
	}

	/**
	 * @static 获得数据源操作影响的行数
	 * @return int
	 */
	private static function _getAffectRows()
	{
		return IUserInvoiceBookTTC::getTTCAffectRows();
	}


	/**
	 * @static
	 * @return bool|int
	 */
	private static function getInvoiceId()
	{
		//获取一个新id
		$newId = IIdGenerator::getNewId('Invoice_Sequence');
		if (false === $newId || $newId <= 0) {
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return false;
		}
		return $newId;
	}

	/**
	 * @static 根据类型检查发票所必须的字段，以及长度限制
	 * @param $newInvoice 发票内容
	 * @return bool
	 */
	public static function checkFieldByType($newInvoice)
	{
		if (isset($newInvoice['type'])
			&& ($newInvoice['type'] != INVOICE_TYPE_RETAIL_COMPANY
				&& $newInvoice['type'] != INVOICE_TYPE_RETAIL_PERSONAL
				&& $newInvoice['type'] != INVOICE_TYPE_VAT
				&& $newInvoice['type'] != INVOICE_TYPE_TITLE //冠名发票 @Tellenji Modify 2022/09/05
				&& $newInvoice['type'] != INVOICE_TYPE_VAT_NORMAL)
		) {

			self::$errCode = 47;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice type is invalid';
			return false;
		}

		//增值税发票，则需要检查更多参数
		if ($newInvoice['type'] == INVOICE_TYPE_VAT) { // 2
			if (!isset($newInvoice['name']) || '' == $newInvoice['name']) {
				self::$errCode = 50;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice name is invalid';
				return false;
			}

			if (strlen($newInvoice['name']) > MAX_COMPANY_LEN) {
				self::$errCode = 51;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice name len is invalid';
				return false;
			}

			if (!isset($newInvoice['addr']) || '' == $newInvoice['addr']) {
				self::$errCode = 52;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice addr is invalid';
				return false;
			}
			if (strlen($newInvoice['addr']) > MAX_ADDR_LEN) {
				self::$errCode = 53;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice addr len is invalid';
				return false;
			}

			if (!isset($newInvoice['phone']) || '' == $newInvoice['phone']) {
				self::$errCode = 54;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice phone is invalid';
				return false;
			}
			if (strlen($newInvoice['phone']) > MAX_PHONE_LEN) {
				self::$errCode = 55;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice phone len is invalid';
				return false;
			}

			if (!isset($newInvoice['taxno']) || '' == $newInvoice['taxno']) {
				self::$errCode = 56;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice taxno is invalid';
				return false;
			}
			if (strlen($newInvoice['taxno']) > MAX_TAXNO_LEN) {
				self::$errCode = 57;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice taxno len is invalid';
				return false;
			}

			if (!isset($newInvoice['bankno']) || '' == $newInvoice['bankno']) {
				self::$errCode = 58;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice bankno is invalid';
				return false;
			}
			if (strlen($newInvoice['bankno']) > MAX_BANK_NO_LEN) {
				self::$errCode = 59;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice bankno len is invalid';
				return false;
			}

			if (!isset($newInvoice['bankname']) || '' == $newInvoice['bankname']) {
				self::$errCode = 60;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice bankname is invalid';
				return false;
			}
			if (strlen($newInvoice['bankname']) > MAX_BANK_NAME_LEN) {
				self::$errCode = 61;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice bankname len is invalid';
				return false;
			}
		} else if ($newInvoice['type'] == INVOICE_TYPE_VAT_NORMAL) { //4
			if (!isset($newInvoice['title']) || '' == $newInvoice['title']) {
				self::$errCode = 48;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'invoice title is invalid';
				return false;
			}
			if (strlen($newInvoice['title']) > MAX_TITLE_LEN) {
				self::$errCode = 49;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'invoice title len is invalid';
				return false;
			}
		} else {
			if (!isset($newInvoice['title']) || '' == $newInvoice['title']) {
				self::$errCode = 48;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice title is invalid';
				return false;
			}
			if (strlen($newInvoice['title']) > MAX_TITLE_LEN) {
				self::$errCode = 49;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice title len is invalid';
				return false;
			}
		}
		return true;
	}


	/**
	 * 检查发票内容字段是否有不允许出现的字符
	 * @param string $text
	 * @return boolean 合法则为true / 不法则为则为false
	 */
	private static function checkIsValidInvoiceString($text)
	{
		$chars = array('`', '~', '!', '@', '#', '$', '^', '&', '*', '=', '|', '{', '}', ':', ';', '\\', '[', ']', '<', '>', '~', '！', '@', '#', '￥', '…', '＆', '*', '&mdash;', '|', '{', '}', '【', '】', '‘',);

		//$str = '<a href="dddd">你好吗？￥哈写对复旦哈达反对</a>';
		foreach ($chars as $char) {
			//$pos = strpos($text, $char);
			$pos = iconv_strpos($text, $char, 0, 'GBK');
			if ($pos !== false) {
				return false;
			}
		}

		return true;
	}

	/**
	 * 检查是否合法的发票数据
	 * @param array $data
	 * @param array $numberFields
	 * @param array $stringFields
	 * @param array $phoneFields
	 * @return boolean 合法则为true / 不法则为则为false
	 */
	public static function checkIsValidInvoiceData($data, $blockNotChecked = true)
	{
		$numberFields = array('type', 'iid', 'uid', 'updatetime', 'status');
		$stringFields = array('addr', 'bankname', 'bankno', 'name', 'title', 'vat_normal_name', 'sid');
		$phoneFields = array('phone');
		$taxno = array('taxno');

		$fieldsConf = array(
			'addr' =>
				array(
					'name' => "公司地址",
					'hint' => "必须是字符串",
				),
			'bankname' =>
				array(
					'name' => "开户行",
					'hint' => "必须是字符串",
				),
			'bankno'  =>
				array(
					'name' => "银行账号",
					'hint' => "必须是纯数字",
				),
			'name' =>
				array(
					'name' => "公司名称",
					'hint' => "公司名称不能超过50个汉字或100个字母",
				),
			'title' =>
				array(
					'name' => "个人或公司名称",
					'hint' => "必须是纯数字",
				),
			'vat_normal_name' =>
				array(
					'name' => "发票抬头",
					'hint' => "必须是纯数字",
				),
			'phone' =>
				array(
					'name' => "公司电话",
					'hint' => "必须是纯数字",
				),
			'taxno'  =>
				array(
					'name' => "税号",
					'hint' => "必须是纯数字",
				),
		);

		foreach ($numberFields as $field) {
			if (!empty($data[$field]) && !is_numeric($data[$field])) {
				Logger::info(var_export($data[$field], true));
				self::$errCode = 101;
				self::$errMsg = "{$fieldsConf[$field]['name']}填写有误，必须是纯数字";
				return false;
			}
		}

		foreach ($stringFields as $field) {
			if (!empty($data[$field]) && !self::checkIsValidInvoiceString($data[$field])) {
				Logger::info(var_export($data[$field], true));
				self::$errCode = 101;
				self::$errMsg = "{$fieldsConf[$field]['name']}填写有误，包含非法字符";
				return false;
			}
		}

		foreach ($phoneFields as $field) {
			if (!empty($data[$field]) && !preg_match('/^[0-9\-]{5,25}$/', $data[$field])) {
				Logger::info(var_export($data[$field], true));
				self::$errCode = 101;
				self::$errMsg = "{$fieldsConf[$field]['name']}填写有误";
				return false;
			}
		}

		foreach ($taxno as $field) {
			if (!empty($data[$field]) && !preg_match('/^[0-9X]{15,20}$/', $data[$field])) {
				Logger::info(var_export($data[$field], true));
				self::$errCode = 101;
				self::$errMsg = "{$fieldsConf[$field]['name']}填写有误，只能是15或20位的数字，可以包含大写字母X";
				return false;
			}
		}

		//block not checked ?
		if ($blockNotChecked) {
			$all_fields = array_keys($data);
			$not_checked = array_diff($all_fields, array_merge($numberFields, $stringFields, $phoneFields, $taxno));
			if (!empty($not_checked)) {
				Logger::info(var_export($data, true));
				return false;
			}
		}

		return true;
	}


	/**
	 * @static 过滤发票类型
	 * @param $wh_id 分站ID
	 * @param $invoices 用户所有的发票
	 * @return $invoices 用户在该站点可以使用的发票
	 */
	public static function filterInvoiceTypeByWhId($wh_id, $invoices)
	{
		if (!isset($wh_id) || $wh_id <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'wh_id is null';
			return false;
		}

		// 确定每个站点所支持的发票类型
		if (SITE_SZ == $wh_id) {
			// 深圳站返回 2,4
			$availableTypes = self::$whidInvoice[SITE_SZ];
		} else {
			// 非深圳返回 1,2,3
			$availableTypes = self::$whidInvoice[SITE_ALL];
		}

		//Logger::info(var_export($invoices,true));

		foreach ($invoices as $key => $inv) {
			// 如果该发票的类型，不在可用发票类型中，则过滤掉
			$type = $inv['type'];
			if (!in_array($type, $availableTypes)) {
				unset($invoices[$key]);
			}
		}
		sort($invoices);
		return $invoices;
	}


}