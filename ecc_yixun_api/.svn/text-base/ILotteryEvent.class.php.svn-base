<?php
/**
 * 
 * 抽奖类活动
 * @author rongxu
 *
 */
class ILotteryEvent {
	private $db = null;
	private $dbname = 'icson_event';
	private $table = 't_event_lottery';
	private $tableHistory = 't_event_lottery_history_';
	private $ttcKey = 'event_lottery_12_';
	
	public function __construct() {
		$this->db = Config::getDB($this->dbname);
	}

	/**
	 * 新建抽奖活动
	 * @param array $params
	 */
	public function insert($params) {
		foreach ($params as $key => $param) {
			if ($param === 'checked') {
				$params[$key] = 1;
			}
		}
		$params['is_del'] = 0;
		$rs = $this->db->insert($this->table, $params);
		return $rs;
	}
	
	/**
	 * 通过sn获取活动数据
	 * @param int $id
	 */
	public function getdata($sn) {
		$sql = "SELECT * FROM " . $this->table . " WHERE `sn` = '$sn' AND is_del = 0 LIMIT 1;";
		$rs = $this->db->getRows($sql);
		if (empty($rs)) {
			return $rs;
		}
		return $rs[0];
	}
	
	/**
	* 通过sn获取活动数据
	* @param string $sn
	*/
	public function getdataJson($sn) {
		$sql = "SELECT * FROM " . $this->table . " WHERE `sn` = '$sn' AND is_del = 0 LIMIT 1;";
		$rs = $this->db->getRows($sql);
		if ($rs) {
			return ToolUtil::gbJsonEncode($rs[0]);
		} else {
			return false;
		}
	}
	
	/**
	 * 通过缓存获取基于sn的数据
	 * @param string $sn
	 */
	public function getdataJsonByCache($sn) {
		return IPageCahce::cached($this, "getdataJson", array($sn), 86400, '', false, array('key' => $this->ttcKey . $sn));
	}
	
	/**
	* 得到所有的活动号
	* @author scootli
	* @param 
	*/
	public function getAllLotteryActivitys(){
		$sql = "SELECT sn FROM " . $this->table . " WHERE `sn` <= 1000000 AND is_del = 0;";
		$rs = $this->db->getRows($sql);
		if ($rs) {
			return $rs;
		}else{
			return false;
		}
	}
	
	/**
	 * 根据id更新活动数据
	 * @param int $id
	 * @param array $params
	 */
	public function updateData($sn, $params) {
		foreach ($params as $key => $param) {
			if ($param === 'checked') {
				$params[$key] = 1;
			}
		}
		$rs = $this->db->update($this->table, $params, "sn = '". $sn. "'");
		if ($rs) {
			$value = $this->getdataJson($params['sn']);
			IPageCahce::setCacheData($this->ttcKey . $params['sn'], serialize($value), 86400);
		}
		return $rs;
	}
	
	/**
	 * 查找活动
	 * @param int $sn
	 * @param String $keyword
	 */
	public function getList($sn, $keyword) {
		$str = " WHERE 1 ";
		if (!empty($sn)) {
			$str .= " AND `sn` like '%$sn%'";
		} 
		if (!empty($keyword)) {
			$str .= " AND `title` LIKE '%$keyword%'";
		}
		$sql = "SELECT * FROM " . $this->table . $str . " ORDER BY is_del ASC,createtime DESC";
		$rs = $this->db->getRows($sql);
		return $rs;
	}
	
	/**
	 * 
	 * 关闭活动
	 * @param int $id
	 */
	public function close($sn) {
		$rs = $this->db->update($this->table, array('is_del' => 1), "sn = '" . $sn . "'");
		return $rs;
	}
	
	/**
	*
	* 打开活动
	* @param int $id
	*/
	public function open($sn) {
		$rs = $this->db->update($this->table, array('is_del' => 0), "sn = '" . $sn . "'");
		return $rs;
	}
	
}