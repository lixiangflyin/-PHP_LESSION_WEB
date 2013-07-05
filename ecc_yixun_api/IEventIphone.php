<?php
/**
 * 
 * 0元得手机获取抽奖号
 * 
 * @author rongxu
 */
class IEventIphone {
    private $db = null;
    private $dbname = 'icson_event';
    private $table = 't_event_iphone';
    private $numberMin = 0;
    private $numberMax = 99999;
    const FROM_ACTIVITIES = 1;
    const FROM_QQMEMBER = 2;
    const FROM_BINDT = 3;
    const FROM_INVITE = 4;
    
    public $emailSend;
    public $smsSend;
    
    public function __construct() {
    	$this->db = Config::getDB($this->dbname);
    }
	
    /**
     * 获取抽奖号
     * @param int $uid
     * @param string $username
     * @return array(
     * 				has_number,
     * 				generate_number
     * 				)
     */
	public function getNumbers($uid, $username) {
		//获取已经有的号码列表
		$sql = "SELECT `icson_id`, `number`, `from`, `create_time` FROM " . $this->table . " WHERE `user_id` = $uid";
		$rs = $this->db->getRows($sql);
		$data['has_number'] = $rs;
		
		//当天24点之前昨天24点之后已经领取号码，返回
		$nowTime = time();
		$yesTime = strtotime(date("Y-m-d 00:00:00", $nowTime));
		$todTime = strtotime(date("Y-m-d 00:00:00", $nowTime + 24*60*60));
		
		if (is_array($rs)) {
			foreach ($rs as $numbers) {
				$createTime = intval($numbers['create_time']);
				$from = intval($numbers['from']);
				if ($createTime > $yesTime && $createTime < $todTime && $from == self::FROM_ACTIVITIES) {
					return $data;
				}
			}
		}
		
		$isVip = 0;
		$un = strlen($username);
		if (isset($_COOKIE['is_vip']) && $un > 16) {
			$isVip = intval($_COOKIE['is_vip']);
		}
		if ($isVip) {
			//当天24点之前昨天24点之后未领取号码并且是QQ会员，生成3个号码，并返回领取号码列表
			$this->db->execSql("start transaction;");
			for ($i = 0;$i < 3;$i++) {
				$iphone = array();
				$rs = $this->generateNumbers($uid, $username, self::FROM_ACTIVITIES, $iphone);
				$data['generate_number'][] = $iphone['`number`'];
				if (!$rs) {
					$this->db->execSql("rollback;");
				}
			}
			$this->db->execSql("commit;");
			
		} else {
			//当天24点之前昨天24点之后未领取号码并且不是QQ会员，生成1个号码，并返回领取号码列表
			$iphone = array();
			$rs = $this->generateNumbers($uid, $username, self::FROM_ACTIVITIES, $iphone);
			$data['generate_number'][] = $iphone['`number`'];
		}
		
	
		
		$this->getInviteNumbers($uid);
		
		return $data;
	}
	
	/**
	 * 获取已经得到的抽奖号
	 * @param int $uid
	 * @return
	 */
	public function getHasNumbers($uid) {
		$sql = "SELECT `icson_id`, `number`, `from`, `create_time` FROM " . $this->table . " WHERE `user_id` = $uid";
		$rs = $this->db->getRows($sql);
		$data['has_number'] = $rs;
		
		//当天24点之前昨天24点之后已经领取号码，返回
		$nowTime = time();
		$yesTime = strtotime(date("Y-m-d 00:00:00", $nowTime));
		$todTime = strtotime(date("Y-m-d 00:00:00", $nowTime + 24*60*60));
		
		if (is_array($rs)) {
			foreach ($rs as $numbers) {
				$createTime = intval($numbers['create_time']);
				$from = intval($numbers['from']);
				if ($createTime > $yesTime && $createTime < $todTime && $from == self::FROM_ACTIVITIES) {
					return $data;
				}
			}
		}
		$data['can_generate'] = 1;
		return $data;
	}
	
	/**
	 * 获取邀请的抽奖号
	 * @param int $uid
	 */
	private function getInviteNumbers($uid) {
		//如果是朋友邀请过来的，给朋友增加一个抽奖号(判断俩人是否互相邀请过)
		if (isset($_COOKIE['invite_uid'])) {
			$inviteUid = $_COOKIE['invite_uid'];
			
			if ($inviteUid == $uid) {
				return;
			}
			$sql = "SELECT `id` FROM " . $this->table . " WHERE (`from_uid` = $uid AND `user_id` = $inviteUid) OR (`from_uid` = $inviteUid AND `user_id` = $uid)";
			$rs = $this->db->getRows($sql);
			if (!empty($rs)) {
				return;
			}
			
			
			$iphone = array();
			$inviteUserInfo = IUser::getUserInfo($inviteUid);
			$rs = $this->generateNumbers($inviteUid, $inviteUserInfo['icsonid'], self::FROM_INVITE, $iphone, $uid);
			
			setcookie('invite_uid', $inviteUid, time()-3600, '/', '.51buy.com');
//			if ($rs) {
// 			$smsSend = $this->smsSend;
// 			$content = str_replace("{number}", $iphone['`number`'], $smsSend['invite']);
// 			$mobile = $inviteUserInfo['mobile'];
// 			IMessage::sendSMSMessage($mobile, $content);
//		}
		}
	}
	
	/**
	 * 获取转发微博抽奖号
	 * @param int $uid
	 * @return array
	 */
	public function getShareTqqNumbers($uid, $username, $t) {
		$sql = "SELECT `id`  FROM " . $this->table . " WHERE `user_id` = $uid AND `from` = " . $t;
		$rs = $this->db->getRows($sql);
		if (!empty($rs)) {
			return;
		}
		$iphone = array();
		$rs = $this->generateNumbers($uid, $username, $t, $iphone);
//		if ($rs) {
// 			$smsSend = $this->smsSend;
// 			$content = str_replace("{number}", $iphone['`number`'], $smsSend['share']);
// 			$userInfo = IUser::getUserInfo($uid);
// 			$mobile = $userInfo['mobile'];
// 			IMessage::sendSMSMessage($mobile, $content);
//		}
		$data['generate_number'][] = $iphone['`number`'];
		return $data;
	}
	
	/**
	 * 生成抽奖号并保存
	 * @param int $uid
	 * @param string $username
	 * @param int $from
	 * @param array &$iphone
	 * @return boolean
	 */
	private function generateNumbers($uid, $username, $from, &$iphone, $fromUid = 0) {
		$number = rand($this->numberMin, $this->numberMax);
		$iphone = array(
					'`user_id`' => $uid,
					'`icson_id`' => $username,
					'`number`' => $number,
					'`create_time`' => time(),
					'`is_win`' => 0,
					'`win_time`' => 0,
					'`from`' => $from,
					'`from_uid`' => $fromUid,
		);
		$rs = $this->db->insert($this->table, $iphone);
		if ($rs) {
			$userInfo = IUser::getUserInfo($uid);
			$emailSend = $this->emailSend;
			$content = str_replace("{number}", $number, $emailSend['content']);
			IMessage::sendEmail($userInfo['email'], $emailSend['title'], $content);
		}
		return $rs;
	}
	
	/**
	 * 获取参加活动的用户数
	 * @param int $baseCount
	 * @return string
	 */
	public function getUserCountDb($baseCount) {
		//$sql = "SELECT count(distinct(`user_id`)) as count FROM " . $this->table;
		$sql = "SELECT count(`user_id`) as count FROM " . $this->table . " WHERE `from` < 4";
		$rs = $this->db->getRows($sql);
		$count = intval($rs[0]['count']) + intval($baseCount);
		return $count . '';
	}
	
	public function getUserCount($baseCount) {
		//return $this->getUserCountDb($baseCount);
		return IPageCahce::cached($this, "getUserCountDb", array($baseCount), 300);
	}
	
	public function isJoin($uid) {
		return IPageCahce::cached($this, "isJoinDb", array($uid), 30000);
	}
	
	/**
	 * 判断是否参加活动
	 * @param int $uid
	 * @return int
	 */
	public function isJoinDb($uid) {
		$sql = "SELECT `id` FROM " . $this->table . " WHERE `user_id` = " . $uid;
		$rs = $this->db->getRows($sql);
		if (empty($rs)) {
			return 0;
		} else {
			return 1;
		}
	}
}