<?php
//��ؼ�¼���ݲ�

class Monitor {

	private static $dbName = 'icson_event';

	private static $tableName = 't_monitor';

	public static $errCode;

	public static $errMsg;

	//������¼
	public static function add($datas) {
		$db = Config::getDB(self::$dbName);
		$rs = $db->insert(self::$tableName, $datas);
		self::$errCode = $db->errCode;
		self::$errMsg = $db->errMsg;
		return $rs;
	}

	//���¼�¼
	public static function modify($id, $datas) {
		$db = Config::getDB(self::$dbName);
		$rs = $db->update(self::$tableName, $datas, ' id = ' . $id);
		self::$errCode = $db->errCode;
		self::$errMsg = $db->errMsg;
		return $rs;
	}

	//�Ƴ���¼
	public static function remove($id) {
		$db = Config::getDB(self::$dbName);
		$rs = $db->remove(self::$tableName, ' id = ' . $id);
		self::$errCode = $db->errCode;
		self::$errMsg = $db->errMsg;
		return $rs;
	}

	//��ȡ��¼
	public static function getInfo($where = '') {
		$db = Config::getDB(self::$dbName);

		$rs = $db->getRows('SELECT * FROM ' . self::$tableName . ' ' . $where . ' ORDER BY error_times DESC, id DESC');
		self::$errCode = $db->errCode;
		self::$errMsg = $db->errMsg;
		return $rs;
	}

	//��ȡ��־��Ϣ
	public static function getLogInfo($id = 0) {
		$db = Config::getDB(self::$dbName);
		$where = '';
		if (!empty($id)) {
			$where = ' WHERE mid = ' . $id;
		}
		$rs = $db->getRows('SELECT * FROM ' . self::$tableName . $where . ' ORDER BY id DESC');
		self::$errCode = $db->errCode;
		self::$errMsg = $db->errMsg;
		return $rs;
	}

	//��ȡlastId
	public static function getInsertId() {
		$db = Config::getDB(self::$dbName);
		$insertId = $db->getInsertId();
		return $insertId;
	}
}