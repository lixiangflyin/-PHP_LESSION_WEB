<?php
//微卖场设置

class IMicrosale {

	private static $dbName = 'icson_event';

	private static $tableName = 't_microsale';

	public static $errCode;

	public static $errMsg;

	private static $cacheKey = 'microsale_config_20121015_key';

	//新增记录
	public static function add($datas) {
		$db = Config::getDB(self::$dbName);
		$rs = $db->insert(self::$tableName, $datas);
		self::$errCode = $db->errCode;
		self::$errMsg = $db->errMsg;
		return $rs;
	}

	//更新记录
	public static function modify($id, $datas) {
		$db = Config::getDB(self::$dbName);
		$rs = $db->update(self::$tableName, $datas, ' id = ' . $id);
		self::$errCode = $db->errCode;
		self::$errMsg = $db->errMsg;
		return $rs;
	}

	//移除记录
	public static function remove($id) {
		$db = Config::getDB(self::$dbName);
		$rs = $db->remove(self::$tableName, ' id = ' . $id);
		self::$errCode = $db->errCode;
		self::$errMsg = $db->errMsg;
		return $rs;
	}

	//获取记录
	public static function getInfo($where = '') {
		$db = Config::getDB(self::$dbName);

		$rs = $db->getRows('SELECT * FROM ' . self::$tableName . ' ' . $where . ' ORDER BY id DESC LIMIT 60');
		self::$errCode = $db->errCode;
		self::$errMsg = $db->errMsg;
		return $rs;
	}

	//获取lastId
	public static function getInsertId() {
		$db = Config::getDB(self::$dbName);
		$insertId = $db->getInsertId();
		return $insertId;
	}

	//缓存获取数据
	public static function getInfoByCache() {
		$obj = new IMicrosale();
		return IPageCahce::cached($obj, "getInfo", array(), 300, '', false, array('key' => 
				self::$cacheKey));
	}
}