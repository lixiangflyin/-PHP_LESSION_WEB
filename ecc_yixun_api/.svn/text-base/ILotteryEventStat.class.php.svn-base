<?php
/**
 * 
 * 抽奖活动统计
 * @author rongxu
 *
 */
class ILotteryEventStat {
	
	private $db = null;
	private $dbname = 'icson_event';
	private $table = 't_event_lottery_stat';
	public $errMsg = '';
	
	public function __construct() {
		$this->db = Config::getDB($this->dbname);
	}
	
	public function add($params) {
		$rs = $this->db->insert($this->table, $params);
		return $rs;
	}
	
	public function update($id, $params) {
		$rs = $this->db->update($this->table, $params, " id = $id");
		return $rs;
	}
	
	public function getData($id) {
		$sql = "SELECT * FROM " . $this->table . " WHERE `id` = $id;";
		$rs = $this->db->getRows($sql);
		return $rs[0];
	}
	
	public function getAllData($sn, $keyword = '') {
		$str = '';
		if (!empty($keyword)) {
			$str = " AND `name` LIKE '%$keyword%'";
		}
		$sql = "SELECT * FROM " . $this->table . " WHERE `sn` = '$sn' $str ORDER BY `id` DESC";
		$rs = $this->db->getRows($sql);
		return $rs;
	}
	
	public function execSql($sql) {
		$rs = $this->db->getRows($sql);
		$this->errMsg = $this->db->errMsg;
		return $rs;
	}
}