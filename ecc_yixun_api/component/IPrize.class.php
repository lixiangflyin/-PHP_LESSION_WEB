<?php

class IPrize {
	
	const DB_COUNT = 100;
	const TABLE_COUNT = 100;
	
	const PRIZE_RECORD_STATUS_INIT = 1;
	const PRIZE_RECORD_STATUS_WAIT = 2;
	const PRIZE_RECORD_STATUS_READY = 3;
	const PRIZE_RECORD_STATUS_FIN = 4;
	const PRIZE_RECORD_STATUS_ERR = 5;
	
	const PRIZE_TYPE_COUPON = 1;
	const PRIZE_TYPE_MP = 2;
	const PRIZE_TYPE_APPOINT = 3;
	const PRIZE_TYPE_LOTTERY = 4;
	
	const QUEUE_KEY = 'send_prize_queue_bak';
	
	const ALARM_SEND_PRIZE_FAILED = 629480;
	
	public static $_PRIZE_RECORD_STATUS_NAME = array(
		self::PRIZE_RECORD_STATUS_INIT => '初始化',
		self::PRIZE_RECORD_STATUS_WAIT => '等待中',
		self::PRIZE_RECORD_STATUS_READY => '发放中',
		self::PRIZE_RECORD_STATUS_FIN => '已发放',
		self::PRIZE_RECORD_STATUS_ERR => '已失败'
	);
	
	public static $errCode = 0;
	public static $errMsg = '';
	
	private static function clearErr() {
		self::$errCode = 0;
		self::$errMsg = '';
	}
	
	public static function sendPrize($uid, $prize_id, $p1 = 0, $p2 = '') {
		try {
			/*global $_DB_CFG;
			$db_index = self::getDBIndex($uid);
			$_DB_CFG["prize_record_{$db_index}"] = $_DB_CFG['prize_record'];
			$_DB_CFG["prize_record_{$db_index}"]['DB'] = "prize_record_{$db_index}";
			
			$db = Config::getDB("prize_record_{$db_index}");
			if($db === false) {
				Logger::err('Failed to init db.[' . $db->errCode . ' : ' . $db->errMsg . ']');
				throw new BaseException($db->errCode, $db->errMsg);
			}
			
			$table_index = self::getTableIndex($uid);
			$ret = $db->insert("t_prize_record_{$table_index}", array(
				'uid' => $uid,
				'prize_id' => $prize_id,
				'col1' => $p1,
				'col2' => $p2,
				'status' => self::PRIZE_RECORD_STATUS_WAIT,
				'create_time' => date('Y-m-d H:i:s')
			));
			
			if($ret === false) {
				Logger::err('Failed to insert prize record.[' . $db->errCode . ' : ' . $db->errMsg . ']');
				throw new BaseException($db->errCode, $db->errMsg);
			}*/
			if(empty($uid) || empty($prize_id)) {
				Logger::err("Empty uid[{$uid}] or prize id[{$prize_id}].");
				throw new BaseException(ErrorConfig::getErrorCode('unexpected_input'), "Empty uid[{$uid}] or prize id[{$prize_id}].");
			}
			
			$mem_cache_q = Config::getMCQ('send_prize');
			if($mem_cache_q === false) {
				Logger::err('Failed to init send prize mem cache queue.[' . Config::$errCode . ' : ' . Config::$errMsg . ']');
				qp_itil_write(self::ALARM_SEND_PRIZE_FAILED, "连接发奖消息队列失败！[uid {$uid}, prize id : {$prize_id}, col1 : {$p1}, col2 : {$p2}]");
				throw new BaseException(Config::$errCode, Config::$errMsg);
			}
			
			$ret = $mem_cache_q->set(self::QUEUE_KEY, serialize(array(
				'uid' => $uid,
				'prize_id' => $prize_id,
				'col1' => $p1,
				'col2' => $p2,
				'create_time' => date('Y-m-d H:i:s')
			)));
			if($ret === false || $ret === null) {
				Logger::err("Failed to add send prize record to queue.[ uid : {$uid}, prize id : {$prize_id} ]");
				qp_itil_write(self::ALARM_SEND_PRIZE_FAILED, "发送发奖消息失败！[uid {$uid}, prize id : {$prize_id}, col1 : {$p1}, col2 : {$p2}]");
				throw new BaseException(ErrorConfig::getErrorCode('send_failed'), 'Failed to send prize.');
			}
			
			return true;
		} catch(BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	public static function getCount($prize_id) {
		$count = IDataCache::incrGet(IDataCache::getPrefix(BIZ_TYPE_PRIZE_COUNTER) . $prize_id);
		if($count === false) {
			if(IDataCache::$errCode == IDataCache::ERROR_NO_DATA || IDataCache::$errCode == IDataCache::ERROR_KEY_EXPIRED) {
				$count = 0;
			} else {
				Logger::err("Failed to get count for prize {$prize_id}.[" . IDataCache::$errCode . ' : ' . IDataCache::$errMsg . ']');
				self::$errCode = IDataCache::$errCode;
				self::$errMsg = IDataCache::$errMsg;
				return false;
			}
		}
		
		return $count;
	}
	
	private static function getDBIndex($uid) {
		return $uid % self::DB_COUNT;
	}
	
	private static function getTableIndex($uid) {
		return floor($uid / self::DB_COUNT) % self::TABLE_COUNT; 
	}
}