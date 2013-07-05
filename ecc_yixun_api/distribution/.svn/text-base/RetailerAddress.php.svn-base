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
class RetailerAddress
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
	 * @static 根据门店ID查询地址 
	 * @param $uid 父帐号id
	 * @param $shopid 门店id
	 * @return array | bool
	 */
	public static function getAddrByShopId($uid, $shopid)
	{
		// 获取所有地址
		$ret = self::get($uid,array());
		if (false === $ret)
		{
			return false;
		}
		foreach ($ret AS $address)
		{
			if ($address['shopid'] == $shopid)
			{
				return $address;
			}
		}
		
		if (!is_array($ret) || count($ret) == 0)
		{
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'uid ' . $uid . ' 没有地址信息';
			return false;
		}
		
		//未绑定地址默认返回一个地址信息
		return $ret[0];
		
	}
	
	/**
	 * @static 数据层，读取数据源
	 * @param $uid
	 * @param $filter
	 * @return array|bool
	 */
	private static function _getAddress($uid, $filter)
	{
		$ret = IRetailerAddressBookTTC::get($uid, $filter);
		if (false === $ret) {
			self::$errCode = IRetailerAddressBookTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[get Address :" . IRetailerAddressBookTTC::$errMsg . "]";
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
		return IRetailerAddressBookTTC::getTTCAffectRows();
	}





	


}