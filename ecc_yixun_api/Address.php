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
 * 地址类
 */
class EA_Address
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

		$ret = self::_getAddress($uid, $filter);
		return $ret;
	}

	/**
	 * @static
	 * @param $uid 用户id
	 * @param $newAddress 地址内容
	 * @return bool|int
	 */
	public static function insert($uid, $newAddress)
	{
		Logger::info(var_export($uid, true));
		Logger::info(var_export($newAddress, true));
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'uid is null';
			return false;
		}


		if (!self::checkField($uid, $newAddress))
			return false;


		// 检查非法字符
		if (!self::checkIsValidAddressData($newAddress)) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'Address data is invalid';
			return false;
		}


		$newId = self::getAddressId();
		if (false === $newId)
			return false;


		//默认为正常状态
		$now = time();
		$newAddress['status'] = ADDRESS_STATUS_OK;
		$newAddress['aid'] = $newId;
		$newAddress['uid'] = $uid;
		$newAddress['updatetime'] = $now;
		$newAddress['createtime'] = $now;
		$newAddress['last_use_time'] = 0;


		$ret = self::_insertAddress($newAddress);
		if (false === $ret) {
			self::$errCode = EA_Address::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[insert new Address to IUserAddressBookTTC failed:" . EA_Address::$errMsg . "]";
			return false;
		}

		// insert modify time for asyn to ERP
		IUserAddressSyn::insert($newAddress);

		// insert modify time for asyn to ERP
		$ret = IUserAddressSyn::insert($newAddress);
		if (false === $ret) {
			Logger::warn("insert into ERP error" . IUserAddressSyn::$errMsg . ",Invoice:" . var_export($newAddress, true));
		}

		return $newId;
	}

	/**
	 * @static 逻辑层，更新地址
	 * @param $newAddress 地址内容
	 * @param $filter 过滤条件
	 * @return bool
	 */
	public static function update($newAddress, $filter)
	{
		Logger::info(var_export($filter, true));
		Logger::info(var_export($newAddress, true));
		if (!isset($newAddress['uid']) || $newAddress['uid'] <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'uid is null';
			return false;
		}
		$uid = $newAddress['uid'];

		if (!isset($filter['aid']) || $filter['aid'] <= 0) {
			self::$errCode = 62;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'aid is null';
			return false;
		}
		$aid = $filter['aid'];

		if (!isset($newAddress) || count($newAddress) == 0) {
			self::$errCode = 65;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'new Address is null';
			return false;
		}

		$newAddress['updatetime'] = time();

		// 检查字段
		if (!self::checkField($newAddress['uid'], $newAddress))
			return false;

		// 检查非法字符
		if (!self::checkIsValidAddressData($newAddress)) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'Address data is invalid';
			return false;
		}

		$now = time();
		$newAddr['updatetime'] = $now;
		$newAddr['uid'] = $uid;

		// 更新地址
		if (!self::_updateAddress($newAddress, $filter)) {
			return false;
		}

		$lines = self::_getAffectRows();
		if (1 != $lines) {
			self::$errCode = 65;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[modify user Address($aid) affect $lines rows";
			return false;
		}

		$newAddress['aid'] = $aid;

		// insert modify time for asyn to ERP
		$ret = IUserAddressSyn::update($newAddress);
		if (false === $ret) {
			Logger::warn("insert into ERP error" . IUserAddressSyn::$errMsg . ",Invoice:" . var_export($newAddress, true));
		}
		return $aid;
	}

	/**
	 * @static 逻辑层，删除地址
	 * @param $uid
	 * @param $aid
	 * @return bool
	 */
	public static function del($uid, $aid)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'uid is null';
			return false;
		}

		if (!isset($aid) || $aid <= 0) {
			self::$errCode = 62;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'aid is null';
			return false;
		}

		$newAddress['uid'] = $uid;
		$newAddress['status'] = ADDRESS_STATUS_DELETED;
		$newAddress['updatetime'] = time();

		// 标记删除，不做物理删除
		$ret = self::_updateAddress($newAddress, array('aid'=> $aid));
		if (false === $ret) {
			self::$errCode = IUserAddressBookTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[delete user Address($aid) from IUserAddressBookTTC failed:" . IUserAddressBookTTC::$errMsg . "]";
			return false;
		}

		$lines = self::_getAffectRows();
		if (1 != $lines) {
			self::$errCode = 65;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[modify user Address($aid) affect $lines rows";
			return false;
		}

		// delete modify time for asyn to ERP
		IUserAddressSyn::delete(array('uid'=> $uid, 'aid'=> $aid));
		return true;
	}


	public static function updateDefaultValue($uid, $data)
	{
		if (!isset($data['shipType'])) {
			self::$errCode = -1;
			self::$errMsg = "shipType is not set!";
			return false;
		}

		if (!isset($data['invoiceId'])) {
			self::$errCode = -1;
			self::$errMsg = "shipType is not set!";
			return false;
		}

		if (!isset($data['payType'])) {
			self::$errCode = -1;
			self::$errMsg = "shipType is not set!";
			return false;
		}

		if (!isset($data['aid'])) {
			self::$errCode = -1;
			self::$errMsg = "shipType is not set!";
			return false;
		}

		$ret = IUserAddressBookTTC::update(
			array(
				'uid'             => $uid,
				'default_shipping'=> $data['shipType'],
				'default_pay_type'=> $data['payType'],
				'last_use_time'   => time(),
				'iid'             => $data['invoiceId']
			),
			array('aid'=> $data['aid'])
		);

		if ($ret === false) {
			self::$errCode = -1;
			self::$errMsg = basename(__FILE__) . ",IUserAddressBookTTC update failed,errMsg:" . IUserAddressBookTTC::$errMsg;
			return false;
		}

		return true;
	}

	/**
	 * @static 数据层，读取数据源
	 * @param $uid
	 * @param $filter
	 * @return array|bool
	 */
	private static function _getAddress($uid, $filter)
	{
		$ret = IUserAddressBookTTC::get($uid, $filter);
		if (false === $ret) {
			self::$errCode = IUserAddressBookTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[get Address :" . IUserAddressBookTTC::$errMsg . "]";
			return false;
		}
		return $ret;
	}

	/**
	 * @static 数据层，写入数据源
	 * @param $newAddress
	 * @return bool
	 */
	private static function _insertAddress($newAddress)
	{
		$ret = IUserAddressBookTTC::insert($newAddress);
		if (false === $ret) {
			self::$errCode = IUserAddressBookTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[insert new Address to IUserAddressBookTTC failed:" . IUserAddressBookTTC::$errMsg . "]";
			return false;
		}
		return $ret;
	}

	/**
	 * @static 数据层，更新数据源
	 * @param       $newAddress
	 * @param array $filter
	 * @return bool
	 */
	private static function _updateAddress($newAddress, $filter = array())
	{
		$ret = IUserAddressBookTTC::update($newAddress, $filter);
		if (false === $ret) {
			self::$errCode = IUserAddressBookTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[update user Address failed:" . var_export($newAddress, true) . ",filter:" . var_export($filter, true) . IUserAddressBookTTC::$errMsg . "]";
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
		return IUserAddressBookTTC::getTTCAffectRows();
	}


	/**
	 * @static
	 * @return bool|int
	 */
	private static function getAddressId()
	{
		//获取一个新id
		$newId = IIdGenerator::getNewId('useraddress');
		if (false === $newId || $newId <= 0) {
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return false;
		}
		return $newId;
	}

	/**
	 * @static 根据类型检查地址所必须的字段，以及长度限制
	 * @param $newAddress 地址内容
	 * @return bool
	 */
	private static function checkField($uid, $newAddr)
	{

		// 必须的字段
		if (!isset($newAddr['name']) || '' == $newAddr['name']) {
			self::$errCode = 37;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'receiver name is null';
			return false;
		}

		if (strlen($newAddr['name']) > MAX_ADDR_NAME_LEN) {
			self::$errCode = 38;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'receiver name len is invalid';
			return false;
		}

		if (empty($newAddr['mobile']) && empty($newAddr['phone'])) {
			self::$errCode = 12;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[mobile is null]';
			return false;
		}

		if (!empty($newAddr['mobile']) && !ToolUtil::checkMobilePhone($newAddr['mobile'])) {
			self::$errCode = 13;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[mobile(" . $newAddr['mobile'] . ") is invalid]";
			return false;
		}

		/* 短线与ERP无phone验证
		if (!empty($newAddr['phone']) && !ToolUtil::checkPhone($newAddr['phone']))
		{
			self::$errCode = 13;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[phone(". $newAddr['phone'] . ") is invalid]";
			return false;
		}
		*/


		if (!isset($newAddr['district']) || $newAddr['district'] <= 0) {
			self::$errCode = 41;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[district is invalid]';
			return false;
		}

		if (!isset($newAddr['address']) || "" == $newAddr['address']) {
			self::$errCode = 42;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[address is null]';
			return false;
		}

		if (strlen($newAddr['address']) > MAX_ADDR_LEN) {
			self::$errCode = 42;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[address len is invalid]';
			return false;
		}


		// 非必须字段
		if (!isset($newAddr['sortfactor'])) {
			$newAddr['sortfactor'] = 0;
		}

		if (!isset($newAddr['fax'])) {
			$newAddr['fax'] = "";
		}


		if (!isset($newAddr['zipcode'])) {
			$newAddr['zipcode'] = "";
		} else if (strlen($newAddr['zipcode']) > MAX_ZIPCODE_LEN) {
			self::$errCode = 40;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[zipcode len is invalid]';
			return false;
		}

		if (!isset($newAddr['workplace'])) {
			$newAddr['workplace'] = '';
		} else if (strlen($newAddr['workplace']) > MAX_COMPANY_LEN) {
			self::$errCode = 43;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[workplace len is invalid]';
			return false;
		}


		if (!isset($newAddr['iid']) || $newAddr['iid'] <= 0) {
			$newAddr['iid'] = 0;
		} else {
			//检查发票id对应的纪录是否属于该用户
			$item = EA_Invoice::get($uid, array('iid'=> $newAddr['iid']));
			if (false === $item) {
				self::$errCode = EA_Invoice::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[get user invoice(" . $newAddr['iid'] . ") from IUserInvoiceBookTTC failed:" . EA_Invoice::$errMsg . "]";
				return false;
			}
			if (1 != count($item)) {
				self::$errCode = 64;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[invoice(" . $newAddr['iid'] . ") not exist or not belong to $uid";
				return false;
			}
		}


		return true;
	}


	/**
	 * 检查地址内容字段是否有不允许出现的字符
	 * @param string $text
	 * @return boolean 合法则为true / 不法则为则为false
	 */
	/*private static function checkUpdateField($uid, $newAddr)
	{
		if (!isset($newAddr) || count($newAddr) == 0) {
			self::$errCode = 65;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'new addr is null';
			return false;
		}

		if (isset($newAddr['iid']) && $newAddr['iid'] > 0) {
			//检查发票id对应的纪录是否属于该用户
			$item = EA_Invoice::get($uid, array('aid'=> $newAddr['iid']));
			if (false === $item) {
				self::$errCode = EA_Invoice::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[get user invoice(" . $newAddr['iid'] . ") from IUserInvoiceBookTTC failed:" . EA_Invoice::$errMsg . "]";
				return false;
			}
			if (1 != count($item)) {
				self::$errCode = 64;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[invoice(" . $newAddr['iid'] . ") not exist or not belong to $uid";
				return false;
			}
		} else {
			unset($newAddr['iid']);
		}

		if (isset($newAddr['name']) && '' == $newAddr['name']) {
			self::$errCode = 37;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'receiver name is null';
			return false;
		}

		if (isset($newAddr['name']) && strlen($newAddr['name']) > MAX_ADDR_NAME_LEN) {
			self::$errCode = 38;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'receiver name len is invalid';
			return false;
		}

		if (empty($newAddr['mobile']) && empty($newAddr['phone'])) {
			self::$errCode = 12;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[mobile is null]';
			return false;
		}

		if (!empty($newAddr['mobile']) && !ToolUtil::checkMobilePhone($newAddr['mobile'])) {
			self::$errCode = 13;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[mobile(" . $newAddr['mobile'] . ") is invalid]";
			return false;
		}

		 短线及ERP无电话检测
		if (!empty($newAddr['phone']) && !ToolUtil::checkPhone($newAddr['phone']))
		{
			self::$errCode = 13;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[mobile(". $newAddr['mobile'] . ") is invalid]";
			return false;
		}

		if (isset($newAddr['zipcode']) && "" == $newAddr['zipcode']) {
		self::$errCode = 39;
		self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[zipcode is null]';
		return false;
	}
		if (isset($newAddr['zipcode']) && strlen($newAddr['zipcode']) > MAX_ZIPCODE_LEN) {
			self::$errCode = 40;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[zipcode len is invalid]';
			return false;
		}

		if (isset($newAddr['district']) && $newAddr['district'] <= 0) {
			self::$errCode = 41;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[district is invalid]';
			return false;
		}

		if (isset($newAddr['address']) && "" == $newAddr['address']) {
			self::$errCode = 42;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[address is null]';
			return false;
		}

		if (isset($newAddr['address']) && strlen($newAddr['address']) > MAX_ADDR_LEN) {
			self::$errCode = 42;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[address len is invalid]';
			return false;
		}

		if (isset($newAddr['workplace']) && strlen($newAddr['workplace']) > MAX_COMPANY_LEN) {
			self::$errCode = 43;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[workplace len is invalid]';
			return false;
		}
		return true;
	}
	*/
	/**
	 * 检查地址内容字段是否有不允许出现的字符
	 * @param string $text
	 * @return boolean 合法则为true / 不法则为则为false
	 */
	private static function checkIsValidAddressString($text)
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
	 * 检查是否合法的地址数据
	 * @param array $data
	 * @param array $numberFields
	 * @param array $stringFields
	 * @param array $phoneFields
	 * @return boolean 合法则为true / 不法则为则为false
	 */
	private static function checkIsValidAddressData($data, $blockNotChecked = false)
	{
		$ret = ToolUtil::checkAddress($data['address']);
		Logger::info(var_export($data['address'], true));
		Logger::info(var_export($ret, true));
		return true;
	}


}