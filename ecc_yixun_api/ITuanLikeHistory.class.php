<?php
/**
 * 团购我想团记录
 * @author rongxu
 *
 */
class ITuanLikeHistory {
	private $db = null;
	private $dbConfig = 'icson_event';
	private $table = 'tuan_like_history';
	
	public function __construct() {
		$this->db = Config::getDB($this->dbConfig);
	}
	
	/**
	* 获取团购频道连接地址
	*/
	static public function getTuanLink($wId) {
		$rst = IPageCahce::getCacheData('tuan_link_rongxu' . $wId);
		if (!$rst) {
			return false;
		}
		return unserialize($rst);
	}
	
	/**
	 * 获取我想团人数Db
	 * @param int $id
	 * @param int $ts
	 */
	public function getLikeCountDb($id, $ts) {
		$sql = "SELECT count FROM " . $this->table . " WHERE `pid` = $id AND `starttime` = " . $ts;
		$rst = $this->db->getRows($sql);
		if (empty($rst)) {
			return -1;
		}
		$count = intval($rst[0]['count']);
		return $count;
	}
	
	/**
	* 获取我想团人数cache
	* @param int $id
	* @param int $ts
	*/
	public function getLikeCount($id, $ts) {
		$count = IPageCahce::getCacheData('tuan_likes_item12' . $id . $ts);
		if ($count === false) {
			$this->setLikeCount($id, $ts);
			$count = IPageCahce::getCacheData('tuan_likes_item12' . $id . $ts);
		}
		return $count;
	}

	
	/**
	 * 设置我想团人数
	 * @param int $id
	 * @param int $ts
	 */
	public function setLikeCount($id, $ts) {
		$count = $this->getLikeCountDb($id, $ts);
		IPageCahce::setCacheData('tuan_likes_item12' . $id . $ts, $count, 600);
	}
	
	/**
	 * 
	 * @param int $id
	 * @param int $ts
	 */
	public function addLikeCount($id, $ts) {
		$count = $this->getLikeCount($id, $ts);
		if ($count < 0 || empty($count)) {
			$data = array('pid' => $id, 
							'starttime' => $ts,
							'count' => 1);
			$rs = $this->db->insert($this->table, $data);
			return 1;
		} else {
			$data = array('count' => $count + 1);
			$this->db->update($this->table, $data, " pid = $id AND starttime = $ts");
			return $count + 1;
		}
	}
}