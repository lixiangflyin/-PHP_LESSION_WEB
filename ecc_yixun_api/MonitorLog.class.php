<?php
//监控记录数据层

class MonitorLog {

	private static $dbName = 'icson_event';

	private static $tableName = 't_monitor_log';

	public static $errCode;

	public static $errMsg;

	//新增记录
	public static function add($datas) {
		$db = Config::getDB(self::$dbName);
		$rs = $db->insert(self::$tableName, $datas);
		self::$errCode = $db->errCode;
		self::$errMsg = $db->errMsg;
		return $rs;
	}

	//获取记录
	public static function getInfo($where = '') {
		$db = Config::getDB(self::$dbName);
		$rs = $db->getRows('SELECT * FROM ' . self::$tableName . $where . ' ORDER BY id desc');
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
}