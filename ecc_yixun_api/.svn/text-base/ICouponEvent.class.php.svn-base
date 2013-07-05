<?php
/**
 * 
 * 优惠券活动类
 * @author rongxu
 *
 */
class ICouponEvent {
	private $db = null;
	private $dbname = 'icson_event';
	private $table = 't_event_coupon_config';
	private $recordTable = 't_event_coupon_record';
	
	public function __construct() {
		$this->db = Config::getDB($this->dbname);
	}
	
	/**
	 * 新建优惠券活动
	 * @param array $params
	 */
	public function insert($params) {
		$params['is_del'] = 0;
		$rs = $this->db->insert($this->table, $params);
		return $rs;
	}
	
	/**
	 * 获取新插入的记录ID
	 */
	public function getInsertId() {
		return $this->db->getInsertId();
	}
	
	/**
	 * 通过id获取活动数据
	 * @param int $id
	 */
	public function getdata($id) {
		$sql = "SELECT * FROM " . $this->table . " WHERE `id` = $id LIMIT 1;";
		$rs = $this->db->getRows($sql);
		return isset($rs[0]) ? $rs[0] : false;
	}
	
	public function getdataBySn($sn) {
		$sql = "SELECT * FROM " . $this->table . " WHERE `sn` = '$sn' AND is_del = 0 LIMIT 1;";
		$rs = $this->db->getRows($sql);
		return isset($rs[0]) ? $rs[0] : false;
	}
	
	/**
	* 通过sn获取活动数据
	* @param string $sn
	*/
	public function getdataSn($sn) {
		$sql = "SELECT * FROM " . $this->table . " WHERE `sn` = '$sn' AND is_del = 0 LIMIT 1;";
		$rs = $this->db->getRows($sql);
		if ($rs) {
			return isset($rs[0]) ? json_encode($rs[0]) : false;
		} else {
			return false;
		}
	}
	
	/**
	 * 通过缓存获取基于sn的数据
	 * @param string $sn
	 */
	public function getdataSnByCache($sn) {
		return IPageCahce::cached($this, "getdata", array($sn), 86400, '', false, array('key' => 'event_coupon_rongxu_' . $sn));
	}
	
	/**
	 * 根据id更新活动数据
	 * @param int $id
	 * @param array $params
	 */
	public function updateData($id, $params) {
		foreach ($params as $key => $param) {
			if ($param === 'checked') {
				$params[$key] = 1;
			}
		}
		$rs = $this->db->update($this->table, $params, 'id = ' . $id);
		if ($rs) {
			$value = $this->getdata($id);
			IPageCahce::setCacheData('event_coupon_rongxu_' . $id, serialize($value), 86400);
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
			$str .= " AND `sn` = '$sn'";
		} 
		if (!empty($keyword)) {
			$str .= " AND `title` LIKE '%$keyword%'";
		}
		$sql = "SELECT * FROM " . $this->table . $str . " ORDER BY is_del ASC,id DESC";
		$rs = $this->db->getRows($sql);
		return $rs;
	}
	
	/**
	 * 
	 * 关闭活动
	 * @param int $id
	 */
	public function close($id) {
		$rs = $this->db->update($this->table, array('is_del' => 1), 'id = ' . $id);
		return $rs;
	}
	
	/**
	*
	* 打开活动
	* @param int $id
	*/
	public function open($id) {
		$rs = $this->db->update($this->table, array('is_del' => 0), 'id = ' . $id);
		return $rs;
	}

	//增加记录
	public function record($params) {
		$rs = $this->db->insert($this->recordTable, $params);
		return $rs;
	}

	//获取用户优惠券
	public function getUserNo($uid) {
		$res = $this->db->getRows('SELECT uno FROM ' . $this->recordTable . ' WHERE uid = ' . $uid);
		return $res;
	}

	public function getUserNoCache($uid) {
		return IPageCahce::cached($this, "getUserNo", array($uid), 300, '', false, array('key' => 'event_coupon_getUserNo_rongxu_' . $uid));
	}

	//获取当前活动的参加人数
	public function getUsersCount($evtno) {
		$res = $this->db->getRows('SELECT count(*) AS ct FROM ' . $this->recordTable . ' WHERE evtno = ' . $evtno);
		return $res[0]['ct'];
	}

	public function getUsersCountCache($evtno) {
		return IPageCahce::cached($this, "getUsersCount", array($evtno), 300, '', false, array('key' => 'event_coupon_getUsersCountCache_rongxu_' . $evtno));
	}
}