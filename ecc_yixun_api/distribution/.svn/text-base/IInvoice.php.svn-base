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
class IInvoice
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


	/**
	 * @static
	 * @param $uid 用户id
	 * @param $filter 过滤条件
	 * @return array|bool
	 */
	public static function get($uid, $filter)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'uid is null';
			return false;
		}

		$ret = self::_getInvoice($uid, $filter);
		return $ret;
	}

	/**
	 * @static
	 * @param $uid 用户id
	 * @param $newInvoice 发票内容
	 * @return bool|int
	 */
	public static function insert($uid, $newInvoice)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'uid is null';
			return false;
		}


		if (!self::checkFieldByType($newInvoice))
			return false;


		// 检查非法字符
		if (!self::checkIsValidInvoiceData($newInvoice)) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice data is invalid';
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
			self::$errCode = IInvoice::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[insert new invoice to IRetailerInvoiceTTC failed:" . IInvoice::$errMsg . "]";
			return false;
		}

		// insert modify time for asyn to ERP
		$ret = IUserInvoiceSyn::add($newInvoice);
		return $ret;
	}

	/**
	 * @static 逻辑层，更新发票
	 * @param $newInvoice 发票内容
	 * @param $filter 过滤条件
	 * @return bool
	 */
	public static function update($newInvoice, $filter)
	{
		if (!isset($newInvoice['uid']) || $newInvoice['uid'] <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'uid is null';
			return false;
		}

		if (!isset($filter['iid']) || $filter['iid'] <= 0) {
			self::$errCode = 62;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'aid is null';
			return false;
		}
		$iid = $filter['iid'];

		if (!isset($newInvoice) || count($newInvoice) == 0) {
			self::$errCode = 65;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'new invoice is null';
			return false;
		}

		$newInvoice['updatetime'] = time();

		// 检查必备的字段
		if (!self::checkFieldByType($newInvoice))
			return false;

		// 检查非法字符
		if (!self::checkIsValidInvoiceData($newInvoice)) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice data is invalid';
			return false;
		}

		// 更新发票
		if (!self::_updateInvoice($newInvoice, $filter)) {
			self::$errCode = IRetailerInvoiceTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[modify user invoice($iid) from IRetailerInvoiceTTC failed:" . IRetailerInvoiceTTC::$errMsg . "]";
			return false;
		}

		$lines = self::_getAffectRows();
		if (1 != $lines) {
			self::$errCode = 65;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[modify user invoice($iid) affect $lines rows";
			return false;
		}

		$newInvoice['iid'] = $iid;
		IUserInvoiceSyn::update($newInvoice);
		return true;
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
			self::$errCode = IRetailerInvoiceTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[delete user invoice($iid) from IRetailerInvoiceTTC failed:" . IRetailerInvoiceTTC::$errMsg . "]";
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
	 * @static 数据层，读取数据源
	 * @param $uid
	 * @param $filter
	 * @return array|bool
	 */
	private static function _getInvoice($uid, $filter)
	{
		$ret = IRetailerInvoiceTTC::get($uid, $filter);
		if (false === $ret) {
			self::$errCode = IRetailerInvoiceTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[get INVOICE :" . IRetailerInvoiceTTC::$errMsg . "]";
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
		$ret = IRetailerInvoiceTTC::insert($newInvoice);
		if (false === $ret) {
			self::$errCode = IRetailerInvoiceTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[insert new invoice to IRetailerInvoiceTTC failed:" . IRetailerInvoiceTTC::$errMsg . "]";
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
		$ret = IRetailerInvoiceTTC::update($newInvoice, $filter);
		if (false === $ret) {
			self::$errCode = IRetailerInvoiceTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[update user invoice failed:" . var_export($newInvoice, true) . ",filter:" . var_export($filter, true) . IRetailerInvoiceTTC::$errMsg . "]";
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
		return IRetailerInvoiceTTC::getTTCAffectRows();
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
	private static function checkFieldByType($newInvoice)
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
			$pos = strpos($text, $char);
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
	private static function checkIsValidInvoiceData($data, $blockNotChecked = false)
	{
		$numberFields = array('type', 'bankno', 'iid', 'taxno');
		$stringFields = array('addr', 'bankname', 'name', 'title', 'vat_normal_name', 'sid');
		$phoneFields = array('phone');

		foreach ($numberFields as $field) {
			if (!empty($data[$field]) && !is_numeric($data[$field])) {
				Logger::info(var_export($data[$field], true));
				return false;
			}
		}

		foreach ($stringFields as $field) {
			if (!empty($data[$field]) && !self::checkIsValidInvoiceString($data[$field])) {
				Logger::info(var_export($data[$field], true));
				return false;
			}
		}

		foreach ($phoneFields as $field) {
			if (!empty($data[$field]) && !preg_match('/^[0-9\-]{5,25}$/', $data[$field])) {
				Logger::info(var_export($data[$field], true));
				return false;
			}
		}

		//block not checked ?
		if ($blockNotChecked) {
			$all_fields = array_keys($data);
			$not_checked = array_diff($all_fields, array_merge($numberFields, $stringFields, $phoneFields));
			if (!empty($not_checked)) {
				Logger::info(var_export($data, true));
				return false;
			}
		}

		return true;
	}


}