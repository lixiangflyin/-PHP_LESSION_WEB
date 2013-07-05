<?php
/*
 * Author:hedyhe
 * Date:2013-01-17
 * 用于用户对自己2012年历史数据的查询在这里对ttc中数据进行查询，用于20120年终活动数据呈现
 * */
if (!defined("PHPLIB_ROOT")) {
	define('PHPLIB_ROOT', '/data/release/PHPLIB/');
}
require_once(PHPLIB_ROOT . "lib/Config.php");

class IUserHistory
{
	public static $errCode = 0;
	public static $errMsg = '';
	
	public static function get($user_id_) {
		if (!isset($user_id_) || $user_id_ <= 0)
		{
			self::$errCode = ERROR_INVALID_USER_ID;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "user_id($user_id_) is invalid";
			return false;
		}
		$items=IUserHistoryTTC::get($user_id_);
		if (false === $items)
		{
			self::$errCode = IUserHistoryTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IUserHistoryTTC failed]' . IUserHistoryTTC::$errMsg;
			return false;
		}
		return $items;
	}
	
}