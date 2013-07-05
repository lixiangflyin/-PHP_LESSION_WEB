<?php
class IWeiboEvent {
	private $db = null;
	private $dbname = 'icson_event';
	private $table = 't_event_lottery_weibo_';
	private $ttcKey = 'event_lottery_weibo_12_';
	
	public function __construct() {
		$this->db = Config::getDB($this->dbname);
	}
	
	public function insert($sn, $params) {
		$params['create_date'] = strtotime(date("Y-m-d"));
		$rs = $this->db->insert($this->table . $sn, $params);
		return $rs;
	}
	
	public function getIsWeiboDb($sn, $uid) {
		$date = strtotime(date("Y-m-d"));
		$sql = "SELECT count(*) as count FROM " . $this->table . $sn . " WHERE uid = $uid AND create_date = $date AND type = 0";
		$rs = $this->db->getRows($sql);
		if (empty($rs)) {
			return 0;
		}
		return $rs[0]['count'];
	}
	
	public function getIsWeiboCache($sn, $uid) {
		//return IPageCahce::cached($this, "getIsWeiboDb", array($sn, $uid), 86400, '', false,
		//array('key' => $this->ttcKey . $sn . $uid));
		return $this->getIsWeiboDb($sn, $uid);
	}
	
	public function isJoin($sn, $uid) {
		$date = strtotime(date("Y-m-d"));
		$sql = "SELECT count(*) as count FROM " . $this->table . $sn . " WHERE uid = $uid AND create_date = $date AND type = 1";
		$rs = $this->db->getRows($sql);
		if (empty($rs)) {
			return 0;
		}
		return $rs[0]['count'];
	}
	
	public function isJoinAll($sn, $uid) {
		$date = strtotime(date("Y-m-d"));
		$sql = "SELECT count(*) as count FROM " . $this->table . $sn . " WHERE uid = $uid AND type = 1";
		$rs = $this->db->getRows($sql);
		if (empty($rs)) {
			return 0;
		}
		return $rs[0]['count'];
	}
}