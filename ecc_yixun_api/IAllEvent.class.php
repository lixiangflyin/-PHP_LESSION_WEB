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
			  `create_time` timestamp NOT NULL default CURRENT_TIMESTAMP COMMENT '创建时间',
			  `create_from` tinyint(4) NOT NULL default '0' COMMENT '来源',
			  `times` tinyint(4) NOT NULL default '0' COMMENT '第几次',
			  `lottery_code` varchar(20) NOT NULL default '' COMMENT '编号',
			  `lottery_rand` int(11) NOT NULL default '0' COMMENT '随机数(中奖号)',
			  `icson_id` varchar(80) NOT NULL default '' COMMENT '帐号',
			  `create_date` int(11) NOT NULL default '0' COMMENT '创建日期',
			  `success_code` varchar(20) NOT NULL default '' COMMENT '返回code',
			  `cdkey`  varchar(512) NOT NULL default '' COMMENT 'cdkey编号',
			  `from_id` varchar(20) NOT NULL COMMENT '订单号',
			  `mobile` varchar(11) NOT NULL default '' COMMENT '手机号',
			  `regtime` int(11) NOT NULL default '0' COMMENT '注册时间',
			  `ls` varchar(20) NOT NULL default '' COMMENT '来源',
			  PRIMARY KEY  (`uid`,`create_from`,`times`,`icson_id`,`create_date`),
              INDEX(lottery_code)             
			) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='用户获得奖品记录表';";
		$rs = $this->db->execSql($sql);
		return $rs;
	}
	
	public function createInvite($sn) {
		$sql = "CREATE TABLE IF NOT EXISTS `t_event_lottery_invite_" . $sn . "` (
				  `uid` int(11) NOT NULL default '0',
				  `from_uid` int(11) NOT NULL default '0',
				  `create_time` int(11) NOT NULL default '0',
				  PRIMARY KEY  (`uid`,`from_uid`, `create_time`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='邀请表';";
		$rs = $this->db->execSql($sql);
		return $rs;
	}
	
	public function createWeibo($sn) {
		$sql = "CREATE TABLE `icson_event`.`t_event_lottery_weibo_" . $sn . "` (
				`uid` INT NOT NULL DEFAULT '0' COMMENT '用户id',
				`create_date` INT NOT NULL DEFAULT '0' COMMENT '当天时间',
				`type` INT NOT NULL DEFAULT '0' COMMENT '1是参加活动点击',
				PRIMARY KEY  (`uid`,`create_date`, `type`)
				) ENGINE = InnoDB COMMENT = '微博记录';";
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