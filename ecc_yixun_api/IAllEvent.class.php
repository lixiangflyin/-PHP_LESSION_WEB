<?php
class IAllEvent {
	private $db = null;
	private $dbname = 'icson_event';
	private $table = 't_event_all';
	
	public function __construct() {
		$this->db = Config::getDB($this->dbname);
	}
	
	public function getAllEvent($sn = '', $title = '') {
		$str = " WHERE 1";
		if (!empty($sn)) {
			$str .= " AND `sn` like '%$sn%'";
		}
		if (!empty($title)) {
			$str .= " AND `title` like '%$title%'";
		}
		
		$sql = "SELECT * FROM $this->table $str ORDER BY `createtime` DESC";
		$rs = $this->db->getRows($sql);
		if ($rs) {
			return $this->formatData($rs);
		}
		return array();
	}
	
	private function formatData($list) {
		$data = array();
		if (is_array($list)) {
			$da = array();
			foreach ($list as $lt) {
				$da['sn'] = $lt['sn'];
				$da['title'] = $lt['title'];
				$da['start_time'] = $lt['start_time'];
				$da['end_time'] = $lt['end_time'];
				$da['createtime'] = $lt['createtime'];
				$da['type'] = $lt['type'];
				$data[] = $da;
			}
		}
		return $data;
	}
	
	public function insertAll($params) {
		$data['sn'] = $params['sn'];
		$data['title'] = $params['title'];
		$data['start_time'] = $params['start_time'];
		$data['end_time'] = $params['end_time'];
		$data['type'] = $params['type'];
		$rs = $this->db->insert($this->table, $data);
		return $rs;
	}
	
	public function createHistory($sn) {
		$sql = "CREATE TABLE IF NOT EXISTS `t_event_lottery_history_" . $sn . "` (
			  `uid` int(11) NOT NULL default '0' COMMENT 'uid',
			  `create_time` timestamp NOT NULL default CURRENT_TIMESTAMP COMMENT '����ʱ��',
			  `create_from` tinyint(4) NOT NULL default '0' COMMENT '��Դ',
			  `times` tinyint(4) NOT NULL default '0' COMMENT '�ڼ���',
			  `lottery_code` varchar(20) NOT NULL default '' COMMENT '���',
			  `lottery_rand` int(11) NOT NULL default '0' COMMENT '�����(�н���)',
			  `icson_id` varchar(80) NOT NULL default '' COMMENT '�ʺ�',
			  `create_date` int(11) NOT NULL default '0' COMMENT '��������',
			  `success_code` varchar(20) NOT NULL default '' COMMENT '����code',
			  `cdkey`  varchar(512) NOT NULL default '' COMMENT 'cdkey���',
			  `from_id` varchar(20) NOT NULL COMMENT '������',
			  `mobile` varchar(11) NOT NULL default '' COMMENT '�ֻ���',
			  `regtime` int(11) NOT NULL default '0' COMMENT 'ע��ʱ��',
			  `ls` varchar(20) NOT NULL default '' COMMENT '��Դ',
			  PRIMARY KEY  (`uid`,`create_from`,`times`,`icson_id`,`create_date`),
              INDEX(lottery_code)             
			) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='�û���ý�Ʒ��¼��';";
		$rs = $this->db->execSql($sql);
		return $rs;
	}
	
	public function createInvite($sn) {
		$sql = "CREATE TABLE IF NOT EXISTS `t_event_lottery_invite_" . $sn . "` (
				  `uid` int(11) NOT NULL default '0',
				  `from_uid` int(11) NOT NULL default '0',
				  `create_time` int(11) NOT NULL default '0',
				  PRIMARY KEY  (`uid`,`from_uid`, `create_time`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='�����';";
		$rs = $this->db->execSql($sql);
		return $rs;
	}
	
	public function createWeibo($sn) {
		$sql = "CREATE TABLE `icson_event`.`t_event_lottery_weibo_" . $sn . "` (
				`uid` INT NOT NULL DEFAULT '0' COMMENT '�û�id',
				`create_date` INT NOT NULL DEFAULT '0' COMMENT '����ʱ��',
				`type` INT NOT NULL DEFAULT '0' COMMENT '1�ǲμӻ���',
				PRIMARY KEY  (`uid`,`create_date`, `type`)
				) ENGINE = InnoDB COMMENT = '΢����¼';";
		$rs = $this->db->execSql($sql);
		return $rs;
	}
	
	public function startT() {
		$sql = 'start transaction';
		return $this->db->execSql($sql);
	}
	
	public function rollback() {
		$sql = 'rollback';
		return $this->db->execSql($sql);
	}
	
	public function commit() {
		$sql = 'commit';
		return $this->db->execSql($sql);
	}
	
	public function updateData($sn, $params) {
		foreach ($params as $key => $param) {
			if ($param === 'checked') {
				$params[$key] = 1;
			}
		}
		$rs = $this->db->update($this->table, $params, "sn = '". $sn. "'");
		return $rs;
	}
}