<?php
class IInviteEvent {
	private $db = null;
	private $dbname = 'icson_event';
	private $table = 't_event_lottery_invite_';
	private $ttcKey = 'event_lottery_invite_12_';
	
	public function __construct() {
		$this->db = Config::getDB($this->dbname);
	}
	
	public function insert($sn, $params) {
		$rs = $this->db->insert($this->table . $sn, $params);
		return $rs;
	}
	
	public function getIsInviteDb($sn, $uid, $fromUid, $ts) {
		$sql = "SELECT count(*) as count FROM " . $this->table . $sn . " WHERE (uid = $uid AND from_uid = $fromUid AND create_time = $ts)
		OR (uid = $fromUid AND from_uid = $uid AND create_time = $ts)";
		$rs = $this->db->getRows($sql);
		if (empty($rs)) {
			return 0;
		}
		return $rs[0]['count'];
	}
	
	/**
	 * 获取是否邀请过
	 * @param int $sn
	 * @param int $uid
	 * @param int $fromUid
	 */
	public function getIsInviteCache($sn, $uid, $fromUid, $ts) {
		return IPageCahce::cached($this, "getIsInviteDb", array($sn, $uid, $fromUid, $ts), 86400, '', false,
		array('key' => $this->ttcKey . $sn . $uid . $fromUid . $ts));
	}
	
	public function getInviteCounts($sn, $uid) {
		$ts = strtotime(date("Y-m-d", time()));
		$sql = "SELECT count(*) as count FROM " . $this->table . $sn . " WHERE from_uid = $uid AND create_time = $ts";
		$rs = $this->db->getRows($sql);
		if (empty($rs)) {
			return 0;
		}
		return $rs[0]['count'];
	}
	
	public function getTCounts($sn, $start = 0, $limit = 30) {
		$sql = "SELECT count( uid ) AS count, from_uid FROM `t_event_lottery_invite_" . $sn . "` GROUP BY from_uid ORDER BY count DESC LIMIT " . $start . ", " . $limit;
		$rs = $this->db->getRows($sql);
		foreach ($rs as &$r) {
			$info = IUser::getUserInfo($r['from_uid']);
			$r['name'] = $info['icsonid'];
		}
		return $rs;
	}
	
	/**
	 * 
	 * 获取邀请次数排行
	 * @param int $sn
	 * @param int $start
	 * @param int $limit
	 */
	public function getTCountsCache($sn, $start = 0, $limit = 30) {
		return IPageCahce::cached($this, "getTCounts", array($sn, $start, $limit), 300, '', false,
		array('key' => 'event_lottery_invite_tcounts_' . $sn));
	}
}