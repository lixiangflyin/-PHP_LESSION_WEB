<?php
/**
 * �Ź������ż�¼
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
	* ��ȡ�Ź�Ƶ�����ӵ�ַ
	*/
	static public function getTuanLink($wId) {
		$rst = IPageCahce::getCacheData('tuan_link_rongxu' . $wId);
		if (!$rst) {
			return false;
		}
		return unserialize($rst);
	}
	
	/**
	 * ��ȡ����������Db
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
	* ��ȡ����������cache
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
	 * ��������������
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