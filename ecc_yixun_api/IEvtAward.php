<?php
require_once(PHPLIB_ROOT . "inc/eventAward.inc.php");
require_once(PHPLIB_ROOT . "api/verifier/IQQVerifier.php");
require_once(PHPLIB_ROOT . "api/IMPService.class.php");
require_once(PHPLIB_ROOT . "lib/ToolUtil.php");
require_once(WEB_PAGE_ROOT . 'lib/ordercheck.php');
/**
 * 
 * 抽奖组件
 * @author rongxu
 *
 */
class IEvtAward {

	const ACT_TYPE_LOTTERY = 5;
	
	private $db = null;
	private $dbConfig = 'icson_event';
	private $table = 't_event_lottery_history_';
	private $dbConfigBak = 'icson_event_slave';
	private $dbSelect = null;
	private $eventSn = '';
	public $result = array();
	private $config;
	private $dailyTimes = 0;
	private $allTimes = 0;
	private $eventAwardConfig = array();
	private $from = 1;
	private $dailyTimesHas = -1;
	private $allTimesHas = -1;
	
	public function __construct($sn) {
		$this->eventSn = $sn;
		$this->db = Config::getDB($this->dbConfig);
		$this->dbSelect = Config::getDB($this->dbConfigBak);
		global $eventAwardInfo;
		$this->eventAwardConfig = $eventAwardInfo;
		return $this->initConfig();
	}
	
	/**
	 * 初始化配置
	 */
	private function initConfig() {
		$eventObj = new ILotteryEvent();
		$eventData = $eventObj->getdataJsonByCache($this->eventSn);
		if (empty($eventData)) {
			$rs['errno'] = $this->eventAwardConfig['error']['SN_ERROR']['errno'];
			$rs['message'] = $this->eventAwardConfig['error']['SN_ERROR']['message'];
			$this->result = $rs;
			return false;
		}
		$this->config = ToolUtil::gbJsonDecode($eventData);

		return true;
	}

    public function isIntegral() {
        return intval($this->config['isintegral']);
    }

    public function getIntegralCount() {
        return intval($this->config['integral_count']);
    }

    public function getTitle() {
        return $this->config['title'];
    }
	
	/**
	 * 获取奖品
	 * @param string $fromId
	 */
	public function getAward($fromId = '') {
		// 常规检查提到外部
		//常规检查
		/*if (!$this->generalCheck()) {
			$uid = IUser::getLoginUid();
			$numbers = $this->getUserNumbers($uid);
			$this->result['success_code'] = $numbers;
			return false;
		}*/
		
		// 订单验证和新用户放入统一验证模块
/*		//订单检查
		$evtInfo = $this->config->event_info;
		$evtInfoObj = json_decode($evtInfo);
		$orderInfoCfg = $evtInfoObj->order_info;
		if (!empty($orderInfoCfg) && empty($fromId)) {
			$rs['errno'] = $this->eventAwardConfig['error']['ORDER_NOT_EXIST']['errno'];
			$rs['message'] = $this->eventAwardConfig['error']['ORDER_NOT_EXIST']['message'];
			$this->result = $rs;
			return false;
		}
		
		//订单验证
		if (!empty($fromId)) {
			if ($this->eventSn = 3732 || $this->eventSn = 3731 || $this->eventSn = 3730 || $this->eventSn = 3524) {

				if (IFreqLimit::checkAndAdd($this->eventSn, 16)) {
					$rs['errno'] = 121;
					$rs['message'] = '点击人数过多，请稍候再试';
					$this->result = $rs;
					return false;
				}
				$uid = IUser::getLoginUid();
				$rst = IVirtualPay::getUserOrdersInOneMonth($uid, 0, 10);
				if ($rst['total'] > 0) {
					$i = 0;
					$orders = $rst['orders'];
					foreach ($orders as $od) {
						if ($fromId == $od['order_char_id']) {
							$i++;
							break;
						}
					}
				}

				if ($i == 0) {
					$rs['errno'] = 120;
					$rs['message'] = '订单不存在';
					$this->result = $rs;
					return false;
				}
			} else {
				$orderCheck = new OrderCheck($this->eventSn, $this->config);
				$rst = $orderCheck->orderGeCheck($fromId, $this->config->site);
				if (!$rst) {
					$this->result = $orderCheck->result;
					return false;
				}
			}
			
		}
	
		//是否新用户
		$newUserCheck = $this->isNewUserLimit($fromId);
		if (!$newUserCheck) {
			return false;
		}*/
	
		//开启事务
		if ($this->startTransaction() == false) {
			$rs['errno'] = $this->eventAwardConfig['error']['SERVER_BUSY']['errno'];
			$rs['message'] = $this->eventAwardConfig['error']['SERVER_BUSY']['message'];
			$this->result = $rs;
			return false;
		}
	
		//获取奖项
		if (!empty($this->config['isrepeat'])) {
			$i = 0;
			$uid = IUser::getLoginUid();
			do {
				if ($i > 10) break;
				$award = $this->getAwardByRand();
				$islo = IPageCahce::getCacheData('lottery20120627_' .$this->eventSn . $uid . $award['id']);
				$i++;
			} while($islo != false);
		} else {
			$award = $this->getAwardByRand();
		}
	
		$dNumber = $award['number'];
		$eventInfo = ToolUtil::gbJsonDecode($this->config['event_info']);
		$awardInfo = $eventInfo['coupon_datas'];
		//检查奖项总领取限制
		$checkAllTimes = $this->checkAwardAllTimesLimit($award);
		if (!$checkAllTimes) {
			foreach ($awardInfo as $daward) {
				if ($daward['is_default'] == 1) {
					$award = $daward;
					$award['number'] = $dNumber;
					break;
				}
			}
		}
	
		//检查奖项每天领取限制
		$checkDailyTimes = $this->checkAwardDailyTimesLimit($award);
		if (!$checkDailyTimes) {
			foreach ($awardInfo as $daward) {
				if ($daward['is_default'] == 1) {
					$award = $daward;
					$award['number'] = $dNumber;
					break;
				}
			}
		}

		if (empty($award['id'])) {
			foreach ($awardInfo as $daward) {
				if ($daward['is_default'] == 1) {
					$award = $daward;
					$award['number'] = $dNumber;
					break;
				}
			}
		}
		
		//Logger::info('\n' . "恭喜你，你中了" . $award['select_award'] . " : " . $award['id'] . '\t');
		$uid = IUser::getLoginUid();
		//如果允许发放优惠券则发放
		$rst = $this->sendCoupon($uid, $award);
		if (!$rst) {
			$i = 0;
			while (!$rst) {
				$rst = $this->sendCoupon($uid, $award);
				if ($rst) {
					break;
				}
				if ($i > 5) {
					break;
				}
				$i++;
			}
		}
		//发放奖品
		$awardrst = $this->sendAward($uid,$award);
		if (!$awardrst) {
			$i = 0;
			while (!$awardrst) {
				$awardrst = $this->sendAward($uid, $award);
				if ($awardrst) {
					break;
				}
				if ($i > 5) {
					break;
				}
				$i++;
			}
		}
		//发放奖品失败则发放默认奖品
 		if (!$rst || !$awardrst) {
 			/*$rs = $this->result;
 			if ($rs['errno'] != -106) {
 				$rs['errno'] = 100;
	 			$rs['message'] = '领取失败，稍后再试';
	 			$this->result = $rs;
				if ($this->shouldLockSQL($award)) 
                    $this->commit();
	 			return false;
 			}*/
 			foreach ($awardInfo as $daward) {
				if ($daward['is_default'] == 1) {
					//Logger::info('\n' . "奖品发放失败，发放默认奖品" . '\t');
					$award = $daward;
					$award['number'] = $dNumber;
					break;
				}
			}
 		}

 		//将返回代码和领取成功提示封装成JSON
 		/*$extra_data = array(
 			'success_code' => $award['return_code'],
 			'message' =>  $award['return_msg'],
 			'cdkey' => $awardrst
 		);

 		$extra_info = ToolUtil::gbJsonEncode($extra_data);*/
		//记录到抽奖记录表
		if (isset($eventInfo['version'])) {
			$rst = $this->recordAward($uid, 1, $award['id'], $award['number'], $award['return_code'],$awardrst,$fromId);
		}else{
			$rst = $this->recordAwardOld($uid, 1, $award['id'], $award['number'], $fromId);
		}
		if (!$rst) {
			$rs['errno'] = $this->eventAwardConfig['error']['RECORD_ERROR']['errno'];
			$rs['message'] = $this->eventAwardConfig['error']['RECORD_ERROR']['message'];
			if (!empty($fromId)) {
				$rs['errno'] = 122;
				$rs['message'] = '订单已经使用过';
			}
			$this->result = $rs;
			$this->rollback();
			return false;
		}
		if (!empty($award['id'])) {
			IPageCahce::setCacheData('lottery20120627_' .$this->eventSn . $uid . $award['id'], 1, 8640000);
		}
	
		$this->commit();
	
		$rs['errno'] = $this->eventAwardConfig['error']['SUCCESS']['errno'];
		$rs['message'] = $award['return_msg'];
		$rs['success_code'] = $award['return_code'];
		$rs['id'] =  $award['id'];
		$rs['batch_no'] = $award['batch_no'];
		$rs['select_award'] = $award['select_award'];
		$rs['cdkey'] = $awardrst;

		//$rs['success_msg'] = iconv("UTF-8", "GBK", $award->return_msg);

		$this->result = $rs;
		return true;
	}
	
	/**
	* 获取奖品
	* @param array $users
	* @param string $fromId
	*/
	public function getAwardByUid($users, $fromId = '', $ff = '') {
		//订单验证
		if (!empty($fromId)) {
			$orderCheck = new OrderCheck($this->eventSn);
			$rst = $orderCheck->orderGeCheck($fromId, $this->config['site']);
			if (!$rst) {
				$this->result = $orderCheck->result;
				return false;
			}
		}
		
		$ownNumbers = array();
		$otherNumbers = array();
		$otherUid = 0;
		foreach ($users as $user) {
			$uid = $user['uid'];
			$from = $user['from'];
			if ($from > 1) {
				$this->from = $from;
				$this->dailyTimes = $this->getUserFromCount($uid, $this->from);
			}
			
			//常规检查
			if (!$this->generalCheck()) {
				return false;
			}
				
			//获取奖项
			$award = $this->getAwardByRand();

			$dNumber = $award->number;
			$eventInfo = ToolUtil::gbJsonDecode($this->config['event_info']);
			$awardInfo = $eventInfo['coupon_datas'];
			//检查奖项总领取限制
			$checkAllTimes = $this->checkAwardAllTimesLimit($award);
			if (!$checkAllTimes) {
				foreach ($awardInfo as $daward) {
					if ($daward['is_default'] == 1) {
						$award = $daward;
						$award['number'] = $dNumber;
						break;
					}
				}
			}

			//检查奖项每天领取限制
			$checkDailyTimes = $this->checkAwardDailyTimesLimit($award);
			if (!$checkDailyTimes) {
				foreach ($awardInfo as $daward) {
					if ($daward['is_default'] == 1) {
						$award = $daward;
						$award['number'] = $dNumber;
						break;
					}
				}
			}

			if ($uid == IUser::getLoginUid()) {
				$returnNumber = $award['number'];
				$ownNumbers[] = $award['number'];
			} else {
				$otherNumbers[] = $award['number'];
				$otherUid = $uid;
			}

			//将返回代码和领取成功提示封装成JSON
	 		/*$extra_data = array(
	 			'success_code' => $award['return_code'],
	 			'message' =>  $award['return_msg']
	 		);
	 		$extra_info = ToolUtil::gbJsonEncode($extra_data);*/
			//记录到抽奖记录表
			if (!empty($ff)) {
				$award['id'] = 1;
			}

			if (isset($eventInfo['version'])) {
				$rst = $this->recordAward($uid, $this->from, $award['id'], $award['number'],/* $extra_info,*/'','',$fromId);
			}else{
				$rst = $this->recordAwardOld($uid, $this->from, $award['id'], $award['number'], $fromId);
			}
			
			if (!$rst) {
				$rs['errno'] = $this->eventAwardConfig['error']['RECORD_ERROR']['errno'];
				$rs['message'] = $this->eventAwardConfig['error']['RECORD_ERROR']['message'];
				$this->result = $rs;
				$this->rollback();
				return false;
			}
			//如果允许发放优惠券则发放
			$rst = $this->sendCoupon($uid, $award);

		}

		$rs['errno'] = $this->eventAwardConfig['error']['SUCCESS']['errno'];
		$rs['message'] = $award['return_msg'];
		$rs['success_code'] = $award['return_code'];
		$rs['number'] = $returnNumber;
		$rs['own_numbers'] = $ownNumbers;
		$rs['other_numbers'] = $otherNumbers;
		$rs['other_uid'] = $otherUid;
		$this->result = $rs;
		return true;
	}
	
	/**
	 * 常规检查
	 */
	public function generalCheck() {
		if (empty($this->config)) {
			return false;
		}

		//站点是否正确
		$siteCheck = $this->isRightSite();
		if (!$siteCheck) {
			return false;
		}
		
		//是否在活动时间内
		$dateCheck = $this->isInDate();
		if (!$dateCheck) {
			return false;
		}

		// 手机验证、邮箱验证、等级限制放入用户验证模块
/*		//判断手机是否验证
		$mobileCheck = $this->isMobileBind();
		if (!$mobileCheck) {
			return false;
		}
		
		//判断邮箱是否验证
		$emailCheck = $this->isEmailBind();
		if (!$emailCheck) {
			return false;
		}
		
		
		//是否等级限制
		$levelLimit = $this->levelLimit();
		if (!$levelLimit) {
			return false;
		}*/
		if ($this->from == 1) {
			$this->checkUserTTimes();
			//判断每人总抽奖次数限制
			$allTimeCheck = $this->checkUserAllTimes();
			if (!$allTimeCheck) {
				return false;
			}
			//判断每人每天抽奖次数限制
			$times = $this->checkUserDailyTimes();
			if (!$times) {
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * 判断站点是否正确
	 */
	private function isRightSite() {
		$siteId = $this->config['site'];
		
		if ($siteId != IUser::getSiteId() && !empty($siteId)) {
			$rs['errno'] = $this->eventAwardConfig['error']['SITE_ERROR']['errno'];
			$rs['message'] = $this->eventAwardConfig['error']['SITE_ERROR']['message'];
			$this->result = $rs;
			return false;
		}
		return true;
	}
	
	/**
	 * 判断是否在活动时间内
	 */
	private function isInDate() {
		$startDate = strtotime($this->config['start_time']);
		$endDate = strtotime($this->config['end_time']);
		$now = time();
		
		if (!empty($startDate) && $now < $startDate) {
			$rs['errno'] = $this->eventAwardConfig['error']['EVENT_NOT_START']['errno'];
			$rs['message'] = $this->eventAwardConfig['error']['EVENT_NOT_START']['message'];
			$this->result = $rs;
			return false;
		}
		
		if (!empty($endDate) && $now > $endDate) {
			$rs['errno'] = $this->eventAwardConfig['error']['EVENT_OVER']['errno'];
			$rs['message'] = $this->eventAwardConfig['error']['EVENT_OVER']['message'];
			$this->result = $rs;
			return false;
		}
		return true;
	}
	
	/**
	 * 判断手机是否验证
	 */
	/*private function isMobileBind() {
		$isMobile = $this->config->ismobile;
		
		$uid = IUser::getLoginUid();
		$userInfo = IUser::getUserInfo($uid);
		if ($isMobile && $userInfo['bindMobile'] == 0) {
			$rs['errno'] = $this->eventAwardConfig['error']['NEED_MOBILE_BIND']['errno'];
			$rs['message'] = $this->eventAwardConfig['error']['NEED_MOBILE_BIND']['message'];
			$this->result = $rs;
			return false;
		}
		return true;
	}*/
	
	/**
	 * 判断邮箱是否验证
	 */
	/*private function isEmailBind() {
		$isEmail = $this->config->isemail;
		
		$uid = IUser::getLoginUid();
		$userInfo = IUser::getUserInfo($uid);
		if ($isEmail && $userInfo['bindEmail'] == 0) {
			$rs['errno'] = $this->eventAwardConfig['error']['NEED_EMAIL_BIND']['errno'];
			$rs['message'] = $this->eventAwardConfig['error']['NEED_EMAIL_BIND']['message'];
			$this->result = $rs;
			return false;
		}
		return true;
	}*/
	
	/**
	 * 是否允许新用户
	 */
/*	private function isNewUserLimit($orderId) {
		$isNewUserLimit = $this->config->isnewuser;
		$uid = IUser::getLoginUid();
		$userInfo = IUser::getUserInfo($uid);
		$userOrderInfo = IOrder::getOneOrder($uid, $orderId);
		$difference = $userInfo['exp_point'] - $userOrderInfo['order_cost'];
		
		if ($isNewUserLimit && $userInfo['exp_point'] > 1 && $difference != 0 && $difference != 1) {
			$rs['errno'] = $this->eventAwardConfig['error']['NEED_NEW_USER']['errno'];
			$rs['message'] = $this->eventAwardConfig['error']['NEED_NEW_USER']['message'];
			$this->result = $rs;
			return false;
		}
		return true;
	}*/
	
	/**
	 * 等级限制
	 */
/*	private function levelLimit() {
		if ($this->config->level > 6) {
			return true;
		}
		$levelLimit = split(",", $this->config->level);
		$uid = IUser::getLoginUid();
		$userInfo = IUser::getUserInfo($uid);
		
		global $_UserLevel;
		$ulevel = 0;
		foreach ($_UserLevel as $k => $ul)
		{
			if ($ul['startV'] <= $userInfo['exp_point'] && $ul['endV'] >=  $userInfo['exp_point']) {
				$ulevel = $k;
				break;
			}
		}
		
		if (!in_array($ulevel, $levelLimit)) {
			$rs['errno'] = $this->eventAwardConfig['error']['LEVEL_LIMIT']['errno'];
			$rs['message'] = $this->eventAwardConfig['error']['LEVEL_LIMIT']['message'];
			$this->result = $rs;
			return false;
		}
		return true;
	}*/
	
	/**
	 * 判断是否超出总抽奖次数
	 */
	private function checkUserAllTimes() {
		$allTimes = $this->config['allcount'];
		$uid = IUser::getLoginUid();
		if(!empty($allTimes)) {
			$act_key = self::ACT_TYPE_LOTTERY . '_' . $this->eventSn;
			$status = IUserActStatus::getStatus($uid, $act_key);
			if($status === false) {
				$rs['errno'] = IUserActStatus::$errCode;
				$rs['message'] = '网络繁忙，请稍后再试';
				$this->result = $rs;
				return false;
			}

			$extra_time = isset($status['extra_time']) ? $status['extra_time'] : 0;
			$allTimes += $extra_time;
		}

		$sql = "SELECT count(*) as count FROM " . $this->table . $this->eventSn . " WHERE uid = $uid AND create_from = 1";
		$rst = $this->db->getRows($sql);
		$count = $rst[0]['count'];
		
		$this->allTimes = $count;
		if (!empty($allTimes) && $count >= $allTimes) {
			$rs['errno'] = $this->eventAwardConfig['error']['MORE_ALLLIMIT']['errno'];
			$rs['message'] = $this->eventAwardConfig['error']['MORE_ALLLIMIT']['message'];
			$this->result = $rs;
			return false;
		}
		$this->allTimesHas = $allTimes - $count;
		return true;
	}
	
	/**
	 * 判断是否超出当日抽奖次数
	 */
	private function checkUserDailyTimes() {
		$times = $this->config['count'];
		$uid = IUser::getLoginUid();
		if(!empty($times)) {
			$act_key = self::ACT_TYPE_LOTTERY . '_' . $this->eventSn;
			$daily_status = IUserActStatus::getDailyStatus($uid, $act_key);
			if($daily_status === false) {
				$rs['errno'] = IUserActStatus::$errCode;
				$rs['message'] = '网络繁忙，请稍后再试';
				$this->result = $rs;
				return false;
			}

			$extra_daily_time = isset($daily_status['extra_time']) ? $daily_status['extra_time'] : 0;
			$times += $extra_daily_time;
		}
		$date = strtotime(date('Y-m-d 4:00:00'));
		$sql = "SELECT count(*) as count FROM " . $this->table . $this->eventSn . " WHERE uid = $uid AND create_date = '$date' AND create_from = 1";
		$rst = $this->db->getRows($sql);
		$count = $rst[0]['count'];

		$this->dailyTimes = $count;
		//Logger::info($this->dailyTimes . " : " .  $count);
		if (!empty($times) && $count >= $times) {
			$rs['errno'] = $this->eventAwardConfig['error']['MORE_DAILYLIMIT']['errno'];
			$rs['message'] = $this->eventAwardConfig['error']['MORE_DAILYLIMIT']['message'];
			$this->result = $rs;
			return false;
		}
		$this->dailyTimesHas = $times - $count;

		return true;
	}
	
	/**
	 * 判断是否超出转发获得的额外次数
	 */
	private function checkUserTTimes() {
		$evtInfo = $this->config['event_info'];
		$evtObj = ToolUtil::gbJsonDecode($evtInfo);
		$tInfo = $evtObj['t_info'];
		if (!empty($tInfo)) {
			$tadd = intval($tInfo['t_add']);
			$tadds = intval($tInfo['t_adds']);
		} else {
			$tadd = 0;
			$tadds = 0;
		}
		
		//判断是否会员
		$uid = IUser::getLoginUid();
		if (IUser::checkQQVip($uid)) {
			if(empty($this->config['count'])) {
				$this->config['count'] = 0;
			} else {
				$this->config['count'] = $this->config['count'] + intval($this->config['qq_times']);
			}
			if (empty($this->config['allcount'])) {
				$this->config['allcount'] = 0;
			} else {
				$this->config['allcount'] = $this->config['allcount'] + intval($this->config['qq_times']);
			}
		}
		
		$invite = new IInviteEvent();
		$uid = IUser::getLoginUid();
		$inviteCount = $invite->getInviteCounts($this->eventSn, $uid);
		$dailyTime = $this->dailyTimes;
		$allTimes = $this->allTimes;
		if ($tadd > 0) {
			if(!empty($this->config['count'])) {
				$this->config['count'] = $this->config['count'] + $inviteCount * $tadd;
			}
			if(!empty($this->config['allcount'])) {
				$this->config['allcount'] = $this->config['allcount'] + $inviteCount　* $tadd;
			}
		} else if ($tadds > 0) {
			$tCount = intval($inviteCount / $tadds);
			if ($tadds == 1000000 && $inviteCount > 0) {
				$tCount = 1;
			}
			if(!empty($this->config['count'])) {
				$this->config['count'] = $this->config['count'] + $tCount;
			}
			if(!empty($this->config['allcount'])) {
				$this->config['allcount'] = $this->config['allcount'] + $tCount;
			}
		}
	}
	
	/**
	 * 开启事务
	 */
	public function startTransaction() {
		$sql = 'start transaction';
		return $this->db->execSql($sql);
	}
	
	/**
	 * 提交
	 */
	public function commit() {
		$sql = 'commit';
		return $this->db->execSql($sql);
	}
	
	/**
	* 回滚
	*/
	public function rollback() {
		$sql = 'rollback';
		return $this->db->execSql($sql);
	}
	
	/**
	 * 随机抽取奖品
	 */
	private function getAwardByRand() {
		$eventInfo = ToolUtil::gbJsonDecode($this->config['event_info']);
		$awardInfo = $eventInfo['coupon_datas'];
		if (empty($awardInfo)) {
			$rs['errno']= $this->eventAwardConfig['error']['AWARD_CONFIG_ERROR']['errno'];
			$rs['data'] = $this->eventAwardConfig['error']['AWARD_CONFIG_ERROR']['message'];
			$this->result = $rs;
			return false;
		}
		
		//获得随机数，这里的基数是根据最小概率的倒数
		$base = 0;
		foreach ($awardInfo as $award) {
			$baseLen = strlen($award['pct']);
			$baseTemp = pow(10, $baseLen-2);
			if ($base < $baseTemp) {
				$base = $baseTemp;
			}
		}

		$currentTime = strtotime(date("Y-m-d G:i:s"));
		$uid = IUser::getLoginUid();
		$randSeed = $currentTime + $uid;
		srand($randSeed);

		$number = rand(0, $base);
		
		//得到奖品
		$pre = 0;
		$next = $base;
		$defaultAward = false;
		foreach ($awardInfo as $award) {
			if ($award['is_default'] == 1) {
				$defaultAward = $award;
			}
			if (empty($award)) {
				continue;
			}
			$lpct = $award['pct'] * $base;
			if ($number == 0 || ($number > $pre && ($number <= ($lpct + $pre)))) {
				$award['number'] = $number;
				return $award;
			} else {
				$pre += $lpct;
			}
		}
		$defaultAward['number'] = $number;
		return $defaultAward;
	}

	/**
     * 操作时是否需要锁数据库
     * @param Object $award
      */
    private function shouldLockSQL($award) {
        $dailyTimesLimit = $award['daily_limit'];
        $pct = $award['pct'];
        $bigAwardPct = 0.01; //大奖的概率

        if (empty($dailyTimesLimit) || $pct > $bigAwardPct)
            return false;
        else
            return true;
    }
	
	/**
	 * 检查奖品否超过总发放限制
	 * @param Object $award
	 */
	public function checkAwardAllTimesLimit($award) {
		$allTimesLimit = $award['all_limit'];
		if (empty($allTimesLimit)) {
			return true;
		}
		
		$code = $award['id'];
		$sql = "SELECT count(*) as count FROM " . $this->table . $this->eventSn . " WHERE lottery_code = '$code'";
        if ($this->shouldLockSQL($award)) {
        	$sql = $sql . " FOR UPDATE";
        	$rst = $this->db->getRows($sql);
        } else {
        	$rst = $this->dbSelect->getRows($sql);
        }
            
       
		$codeAllTimes = $rst[0]['count'];
		
		if (!empty($allTimesLimit) && $codeAllTimes >= $allTimesLimit) {
			$rs['errno']= $this->eventAwardConfig['error']['AWARD_ALL_OVER']['errno'];
			$rs['data'] = $this->eventAwardConfig['error']['AWARD_ALL_OVER']['message'];
			$this->result = $rs;
			return false;
		}

		return true;
	}
	
	/**
	* 检查奖品否超过每日发放限制
	* @param Object $award
	*/
	public function checkAwardDailyTimesLimit($award) {
		$dailyTimesLimit = $award['daily_limit'];
		if (empty($dailyTimesLimit)) {
			return true;
		}
		$date = strtotime(date("Y-m-d 4:00:00"));
		$code = $award['id'];
		$sql = "SELECT count(*) as count FROM " . $this->table . $this->eventSn . " WHERE lottery_code = '$code' AND create_date = '$date'";
        if ($this->shouldLockSQL($award)) {
        	 $sql = $sql . " FOR UPDATE";
        	 $rst = $this->db->getRows($sql);
        } else {
        	$rst = $this->dbSelect->getRows($sql);
        }
           
       
		$codeDailyTimesLimit = $rst[0]['count'];
		
		if (!empty($dailyTimesLimit) && $codeDailyTimesLimit >= $dailyTimesLimit) {
			$rs['errno']= $this->eventAwardConfig['error']['AWARD_DAILY_OVER']['errno'];
			$rs['data'] = $this->eventAwardConfig['error']['AWARD_DAILY_OVER']['message'];
			$this->result = $rs;
			return false;
		}
		
		return true;
	}
	
	/**
	 * 记录抽奖号
	 * @param int $uid
	 * @param int $createFrom
	 * @param int $code
	 * @param int $rand
	 * @param string $fromId
	 */
	private function recordAward($uid, $createFrom, $code, $rand, $success_code,$cdkey = '',$fromId = '') {
		$userInfo = IUser::getUserInfo($uid);
		
		$createDate = strtotime(date("Y-m-d 4:00:00"));
		$data = array('uid' => $uid,
					'icson_id' => $userInfo['icsonid'],
					'create_from' => $createFrom,
					'times' => $this->dailyTimes + 1,
					'lottery_code' => $code,
					'lottery_rand' => $rand,
					'create_date' => $createDate,
					'success_code' => $success_code,
					'cdkey'  => $cdkey,
					'from_id' => $fromId,
					'mobile' => $userInfo['mobile'],
					'regtime' => $userInfo['regtime']);
		if (isset($_COOKIE['ls'])) {
			$data['ls'] = $_COOKIE['ls'];
		}

		$this->db = Config::getDB($this->dbConfig);
		$rs = $this->db->insert($this->table . $this->eventSn, $data);
		return $rs;
	}

		/**
	 * 记录抽奖号
	 * @param int $uid
	 * @param int $createFrom
	 * @param int $code
	 * @param int $rand
	 * @param string $fromId
	 */
	private function recordAwardOld($uid, $createFrom, $code, $rand,$fromId = '') {
		$userInfo = IUser::getUserInfo($uid);
		
		$createDate = strtotime(date("Y-m-d 4:00:00"));
		$data = array('uid' => $uid,
					'icson_id' => $userInfo['icsonid'],
					'create_from' => $createFrom,
					'times' => $this->dailyTimes + 1,
					'lottery_code' => $code,
					'lottery_rand' => $rand,
					'create_date' => $createDate,
					'from_id' => $fromId,
					'mobile' => $userInfo['mobile'],
					'regtime' => $userInfo['regtime']);
		if (isset($_COOKIE['ls'])) {
			$data['ls'] = $_COOKIE['ls'];
		}

		$this->db = Config::getDB($this->dbConfig);
		$rs = $this->db->insert($this->table . $this->eventSn, $data);
		return $rs;
	}
	
	/**
	 * 发放优惠券
	 * @param int $uid
	 * @param Object $award
	 */
	private function sendCoupon($uid, $award) {
		if (isset($award['is_once'])) {
			$isOnce = $award['is_once'];
		}else{
			$isOnce = 0;
		}
		if ($isOnce) {
			$site_id  = IUser::getSiteId();
			if (empty($award['id'])) {
				$rs['errno'] = -106;
				$rs['data'] = '优惠券领取完毕';
				$this->result = $rs;
				return false;
			}
			//Logger::info('\n' . "老版发放优惠劵!" . '\t');
			$ret = ICoupon::fetchCoupon($uid, $award['id']);
			if($ret === false){
				Logger::info("get error:" . $award['id'] . ":" . ICoupon::$errMsg);
				$rs['errno'] = $this->eventAwardConfig['error']['COUPON_NOT_EXIST']['errno'];
				$rs['data'] = $this->eventAwardConfig['error']['COUPON_NOT_EXIST']['message'];
				$this->result = $rs;
				return false;
			}
		}
		
		return true;
	}

	/**
	 * 发放奖品
	 * @author scootli
	 * @param int $uid
	 * @param Object $award
	 */
	private function sendAward($uid,$award){

		if (isset($award['is_once'])) {
			$isOnce = $award['is_once'];
		}else{
			$isOnce = 0;
		}
		if (isset($award['select_award'])) {
			$award_type = $award['select_award'];
		}else{
			$award_type = 4;
		}
		$award_idNo = $award['id'];
		

		//是新版发放优惠劵的选项
		if (($award_type == 1) && !$isOnce && $award_idNo) {
			//发放优惠卷
			//Logger::info('\n' . "新版发放优惠劵!" . '\t');
			$ret = ICoupon::fetchCoupon($uid, $award_idNo);
			if($ret === false){
				Logger::info("get error:" . $award_idNo . ":" . ICoupon::$errMsg);
				$rs['errno'] = $this->eventAwardConfig['error']['COUPON_NOT_EXIST']['errno'];
				$rs['data'] = $this->eventAwardConfig['error']['COUPON_NOT_EXIST']['message'];
				$this->result = $rs;
				return false;
			}

			//Logger::info(" 发卷 ");
			return true;
		}

		//发放cdkey的选项
		if ($award_type == 2 && $award_idNo) {
			//发放cdkey
			//得到QQ号
			$uin = IQQVerifier::getQQByUid($uid);
			//Logger::info("发放cdkey步骤1");
			if(false === $uin) {
				Logger::err("Failed to get qq with uid : $uid");
				$rs['errno'] = $this->eventAwardConfig['error']['GET_QQ_ERROR']['errno'];
				$rs['data'] = $this->eventAwardConfig['error']['GET_QQ_ERROR']['message'];
				$this->result = $rs;
				return false;
			}
			//得到客户端ip地址
			$ip = ToolUtil::getClientIP();
			//Logger::info("发放cdkey步骤2");
			if (false === $ip) {
				Logger::err("Failed to get ip address");
				$rs['errno'] = $this->eventAwardConfig['error']['GET_IP_ERROR']['errno'];
				$rs['data'] = $this->eventAwardConfig['error']['GET_IP_ERROR']['message'];
				$this->result = $rs;
				return false;
			}
			//发放cdkey奖品
			//exit();
			$cdkey = IMPService::sendCDKey($award_idNo, $uin, $ip);
			//Logger::info("发放cdkey步骤3");
			if (false === $cdkey) {
				Logger::err("send cdkey failed: " . IMPService::$errCode . " : " . IMPService::$errMsg . "\n");
				$rs['errno'] = $this->eventAwardConfig['error']['SEND_CDKEY_ERROR']['errno'];
				$rs['data'] = $this->eventAwardConfig['error']['SEND_CDKEY_ERROR']['message'];
				$this->result = $rs;
				return false;
			}
			return $cdkey;

		}
		//是免发送的则直接返回
		if ($award_type == 3) {
			//Logger::info('\n' . "新版金币!" . '\t');
			return true;
		}
		//Logger::info('\n' . "兼容老版!" . '\t');
		return true;
	}

	/**
	* 得到配置信息
	* @author scootli
	*/
	public function getConfigInfo(){
		/*$eventObj = new ILotteryEvent();
		$eventData = $eventObj->getdataJsonByCache($this->eventSn);
		if (empty($eventData)) {
			$rs['errno'] = $this->eventAwardConfig['error']['SN_ERROR']['errno'];
			$rs['message'] = $this->eventAwardConfig['error']['SN_ERROR']['message'];
			$this->result = $rs;
			return false;
		}

		return $eventData['event_info'];*/

		return $this->config['event_info'];
	}

	
	/**
	 * 获取参加人次db
	 */
	public function getUserCountDb() {
		$sql = "SELECT count(DISTINCT `uid`) as count FROM " . $this->table . $this->eventSn;
		$rst = $this->db->getRows($sql);
		$count = intval($rst[0]['count']);
		
		return $count;
	}
	
	/**
	* 获取参加人次cache
	*/
	public function getUserCountDbCache() {
		//return $this->getUserCountDb();
		return IPageCahce::cached($this, "getUserCountDb", array(), 60);
	}
	
	/**
	 * 此人是否参加过活动
	 * @param int $uid
	 */
	public function getUserIsJoinDb($uid) {
		$sql = "SELECT count(*) as count FROM " . $this->table . $this->eventSn . " WHERE `uid` = $uid";
		$rst = $this->db->getRows($sql);
		$count = intval($rst[0]['count']);
		return $count;
	}
	
	/**
	 * 此人是否参加过活动
	 * @param int $uid
	 */
	public function getUserIsJoinCache($uid) {
		return IPageCahce::cached($this, "getUserIsJoinDb", array($uid), 86400);
	}
	

	/**
	 * 此人中奖纪录总数(除去奖项id为第二个参数的中奖纪录)
	 * @param int $uid
	 * @param array $filter 要过滤的奖项id列表
	 */
	public function getUserWinAwardNum($uid,$filter) {
		$blackList = join(',',$filter);
		$sql = "SELECT count(*) as count FROM " . $this->table . $this->eventSn . " WHERE `uid` = $uid and `lottery_code` not in ($blackList)";
		$rst = $this->db->getRows($sql);
		$count = intval($rst[0]['count']);
		return $count;
	}

	/**
	 * 获取用户中奖信息
	 * @param int $uid
	 */
	public function getUserAwardInfo($uid) {
		$sql = "SELECT * FROM " . $this->table . $this->eventSn . " WHERE `uid` = $uid ORDER BY `create_date` DESC, `create_from` ASC";
		$rst = $this->db->getRows($sql);
		return $rst;
	}

	/**
	 * 获取用户指定索引范围中奖信息
	 * @author scootli
	 * @param int $uid
	 * @param int $start : 索引开始位置
	 * @param int $size  : 要获得的记录条数
	 * @param array $filter 要过滤的奖项id列表
	 */
	public function getUserSpecificAwardInfo($uid,$start,$size,$filter) {
		$blackList = join(',',$filter);
		$sql = "SELECT * FROM " . $this->table . $this->eventSn . " WHERE `uid` = $uid and `lottery_code` not in ($blackList) ORDER BY `create_time` DESC, `create_from` ASC LIMIT $start,$size";
		$rst = $this->db->getRows($sql);
		return $rst;
	}

	/**
	 * 获取最近$num条所有用户中奖信息
	 * @author scootli
	 * @param int $num
	 */
	public function getNAllUsersAwardInfo($num = 30){
		$sql = "SELECT * FROM " .  $this->table . $this->eventSn . " ORDER BY `create_time` DESC  LIMIT $num";
		$rst = $this->db->getRows($sql);
		return $rst;
	}

	/**
	 * @author scootli
	 * 取得奖项和奖项相应的数量
	 */
	public function getAwardsAndNum($uid){
		$sql = "SELECT lottery_code,count(*) FROM " .  $this->table . $this->eventSn . " where `uid` = $uid GROUP BY `lottery_code`";
		$rst = $this->db->getRows($sql);
		return $rst;
	}

	
	/**
	 * 
	 * 获取中奖名单
	 */
	public function getAwardsList() {
		$eventInfo = ToolUtil::gbJsonDecode($this->config['event_info']);
		$awards = $eventInfo['lottery_users'];
		return $awards;
	}
	
	/**
	 * 获取用户的中奖号码
	 * @param int $uid
	 */
	public function getUserNumbers($uid) {
		$sql = "SELECT `create_time`, `create_from`, `lottery_code`, `lottery_rand` FROM " . $this->table . $this->eventSn . " WHERE `uid` = $uid  ORDER BY `create_time` DESC, `create_from` ASC";
		$rst = $this->db->getRows($sql);
		return $rst;
	}
	
	/**
	 * 获取当前方式的最大抽奖数
	 * @param unknown_type $uid
	 * @param unknown_type $from
	 */
	public function getUserFromCount($uid, $from = 1) {
		$date = strtotime(date('Y-m-d 4:00:00'));
		$sql = "SELECT count(*) as count FROM " . $this->table . $this->eventSn . " WHERE uid = $uid AND create_date = '$date' AND create_from = $from";
		$rst = $this->db->getRows($sql);
		$count = $rst[0]['count'];
		return $count;
	}
	
	/**
	 * 
	 * 获取抽奖次数
	 * @param int $uid
	 */
	public function getJoinCounts() {
		$count = $this->config['allcount'];
		$dailyCount = $this->config['count'];
		//Logger::info("dailyCount" . $dailyCount . '\t');
		$this->checkUserTTimes();
		if($this->checkUserDailyTimes() === false)
			$this->dailyTimesHas = 0;
		$this->checkUserAllTimes();
		$rst = array();
		$rst['dailay'] = ($dailyCount > 0 ? $this->dailyTimesHas : 0);
		$rst['all'] = ($count > 0 ? $this->allTimesHas : 0);
		return $rst;
	}
	
	/**
	 * 获取获奖名单
	 * @param array $fitter
	 * @param int $start
	 * @param int $limit
	 */
	public function getUsersAwardDB($fitter, $start = 0, $limit = 30) {
		$where = "1 = 1";
		foreach ($fitter as $ft => $value) {
			if ($value != 0) {
				if ($ft == 'lottery_code') {
					$where .= " AND {$ft} <> {$value}";
				} else {
					$where .= " AND {$ft} = {$value}";
				}
			}
		}
		$sql = "SELECT icson_id, lottery_code, lottery_rand, create_date, create_time FROM " . $this->table . $this->eventSn . " WHERE " . $where . " ORDER BY create_time DESC LIMIT $start, $limit";
		$rst = $this->db->getRows($sql);
		foreach ($rst as &$rt) {
			$rt['qq'] = $this->getQQByAccount($rt['icson_id']);
		}
		return $rst;
	}
	
	/**
	 * 获取获奖名单cache
	 * @param array $fitter
	 * @param int $start
	 * @param int $limit
	 */
	public function getUsersAward($fitter, $start = 0, $limit = 30) {
		return IPageCahce::cached($this, "getUsersAwardDB", array($fitter, $start, $limit), 3600, '', false,
		array('key' => 'event_lottery_getaward11_lists_' . $this->eventSn));
	}
	
	
	/**
	 * 获取单独获奖名单
	 * @param array $fitter
	 * @param int $start
	 * @param int $limit
	 */
	public function getUsersAwardDBSip($fitter, $start = 0, $limit = 30) {
		$where = "1 = 1";
		foreach ($fitter as $ft => $value) {
			if ($value != 0) {
				if (is_array($value)) {
					$where .= " AND {$ft} IN (" . implode(",", $value) . ")";
				} else {
					$where .= " AND {$ft} = {$value}";
				}
			}
		}
		$sql = "SELECT icson_id, lottery_code, lottery_rand, create_date, create_time FROM " . $this->table . $this->eventSn . " WHERE " . $where . " ORDER BY create_time DESC LIMIT $start, $limit";
		$rst = $this->db->getRows($sql);
		foreach ($rst as &$rt) {
			$rt['qq'] = $this->getQQByAccount($rt['icson_id']);
		}
		return $rst;
	}
	
	/**
	 * 获取单独获奖名单cache
	 * @param array $fitter
	 * @param int $start
	 * @param int $limit
	 */
	public function getUsersAwardSip($fitter, $start = 0, $limit = 30) {
		return IPageCahce::cached($this, "getUsersAwardDBSip", array($fitter, $start, $limit), 300, '', false,
		array('key' => 'event_lottery_getaward12_listssip_' . $this->eventSn . $fitter['lottery_code']));
	}
	
	private function getQQByAccount($icsonId) {
		$openId = str_replace(QQ_ACCOUNT_PRE . '_', "", $icsonId);
		if ($openId == $icsonId) {
			return $icsonId;
		}
		$url = "http://101.226.52.124:8080/openid/decopenid.php?func=getuinbyopenid&openid=" . $icsonId;
		$checkRet = NetUtil::cURLHTTPGet(
			$url
		);
		if (empty($checkRet)) {
			return $icsonId;
		} else {
			$ret = json_decode($checkRet);
			return $ret->uin;
		}
	}
	
	public function isOrderUsed($order_id) {
		$sql = "SELECT count(*) as count FROM " . $this->table . $this->eventSn . " WHERE from_id = '$order_id'";
		$rst = $this->db->getRows($sql);
		$count = $rst[0]['count'];
	
		if (!empty($count)) {
			return true;
		}
		return false;
	}
}