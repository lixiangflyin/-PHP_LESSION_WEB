<?php
/**
 * 
 * 团购抽奖模块
 * @author rongxu
 *
 */
class ITuanAward {
	
	const LOTTERY_TYPE_QQ = 0;
	const LOTTERY_TYPE_QQVIP = 1;
	const LOTTERY_TYPE_SHOPPING = 2;
	const LOTTERY_TYPE_MOBILE = 3;
	
	public static $openW = 2;//1,2,3,4,5,6,7
	
	private static $table = "tuan_lottery";
	
	private static $db = "icson_event";
	
	private $startTime = 0;
	
	private $endTime = 0;
	
	private $publishTime = 0;
	
	private $orderTime = 0;
	
	//实际用户的中奖号
	private $realCode = null;
	
	private $code = null;
	
	//中奖用户QQ号
	private $qq = null;
	
	//中奖用户手机号
	private $mobile = null;
	
	private $showQQ = null;
	
	public function __construct($start_time, $end_time, $publish_time, $order_time = 0, $code = -1) {
		$this->startTime = $start_time;
		$this->endTime = $end_time;
		$this->publishTime = $publish_time;
		$this->orderTime = $order_time;
		$this->code = $code;
		
		$now = time();
		if($code !== -1 && $now >= $this->endTime)
			$this->getAwardUser();
	}
	
	/**
	 * 
	 * 抽奖
	 * @param int $uid
	 */
	public function lottery($uid, $type) {

		$now = time();
		if($now < $this->startTime)
			return -2;
			
		if($now > $this->endTime)
			return -3;
		
		//判断是否重复抽奖
		$codes = $this->getCodeCache($uid);
		if(isset($codes[$type]))
			return -4;
		
		$db = Config::getDB(self::$db);
		
		switch ($type) {
			case self::LOTTERY_TYPE_QQ: //QQ用户抽一次
				$num = 1;
				break;
			case self::LOTTERY_TYPE_QQVIP: //QQ VIP用户抽两次
				$num = 2;
				break;
			case self::LOTTERY_TYPE_SHOPPING: //购物用户抽三次
				$num = 3;
				break;
			case self::LOTTERY_TYPE_MOBILE:
				$num = 3;
				break;
			default:
				return -6; //未知抽奖类型
		}
		
		$code = array();
		for($i = 0; $i < $num; $i++) {
			if(($c = $this->generateCode($uid, $type)) === false)
				return -5;
			$code[] = $c;
		}
		
		$key = IPageCahce::getCacheKey('ITuanAward', 'getCode', '', array($uid));
		IPageCahce::setCacheData($key, '');

		return $code;
	}
	
	/**
	 * 
	 * 得到抽奖号
	 * @param int $uid
	 */
	private function getCode($uid) {
		$db = Config::getDB(self::$db);
		
		$rs = $db->getRows("SELECT type, code FROM " . self::$table . " WHERE uid = " . $uid . " AND act_key = {$this->startTime}");
		if (empty($rs)) {
			return false;
		}
		/*$id = intval($rs[0]['code']);
		$mid = self::getId($id);*/
		$codes = array();
		foreach($rs as $r) {
			if(isset($codes[$r['type']]))
				$codes[$r['type']][] = sprintf('%07.0f', $r['code']);
			else {
				$codes[$r['type']] = array();
				$codes[$r['type']][] = sprintf('%07.0f', $r['code']);
			}
		}
			
		return $codes;
	}
	
	/**
	 * 
	 * 得到抽奖号cache
	 * @param int $uid
	 */
	public function getCodeCache($uid) {
		$key = IPageCahce::getCacheKey('ITuanAward', 'getCode', '', array($uid));
		$value = IPageCahce::getCacheData($key);
		if (!empty($value)) {
			return self::decodeCode($value);
		}
		if(($codes = $this->getCode($uid)) === false)
			$codes = array();
		IPageCahce::setCacheData($key, self::encodeCode($codes));
		return $codes;
	}
	
	/**
	 * 
	 * 获取抽奖总数
	 */
	public function getCount() {
		$db = Config::getDB(self::$db);
		$rs = $db->getRows("SELECT count(*) as cc FROM " . self::$table . " WHERE act_key = {$this->startTime}");
		$count = intval($rs[0]['cc']);
		return $count;
	}
	
	public function getWinnerCode() {
		return $this->realCode;
	}
	
	public function getWinnerQQ() {
		return $this->qq;
	}
	
	public function getWinnerShowQQ() {
		return $this->showQQ;
	}
	
	public function getWinnerMobile() {
		return $this->mobile;
	}
	
	/**
	 * 
	 * 当期的抽奖日
	 */
/*	public static function getLotteryDay() {
		$w = date("w");
		if (empty($w)) $w = 7;
		if ($w < self::$openW) $w = 7 + $w;
		if ($w == self::$openW) {
			$startTime = time();
		} else if ($w == (self::$openW - 1 + 7)) {
			$startTime = time() + 86400;
		} else {
			$startTime = time() - ($w - self::$openW)*86400;
		}
		
		//当期抽奖日
		$startTime = strtotime(date("Y-m-d 00:00:00", $startTime));
		return $startTime;
	}*/
	
	/**
	 * 
	 * 获取中奖人员
	 */
	private function getAwardUser() {
		$db = Config::getDB(self::$db);
		$rs =  $db->getRows("SELECT uid FROM " . self::$table . " WHERE code = $this->code AND create_time >= {$this->startTime} AND create_time < {$this->endTime}");
		if (empty($rs)) {
			$rs1 =  $db->getRows("SELECT uid, code FROM " . self::$table . " WHERE act_key = {$this->startTime} AND code > {$this->code} ORDER BY code ASC LIMIT 1");
			$rs2 =  $db->getRows("SELECT uid, code FROM " . self::$table . " WHERE act_key = {$this->startTime} AND code < {$this->code} ORDER BY code DESC LIMIT 1");
			if (empty($rs1) && empty($rs2)) {
				return 0;
			}
			if (empty($rs1)) {
				$uid = $rs2[0]['uid'];
				$this->realCode = $rs2[0]['code'];
			} else if (empty($rs2)) {
				$uid = $rs1[0]['uid'];
				$this->realCode = $rs1[0]['code'];
			} else {
				$a1 = $rs1[0]['code'] - $this->code;
				$a2 = $this->code - $rs2[0]['code'];
				if ($a1 < $a2) {
					$uid = $rs1[0]['uid'];
					$this->realCode = $rs1[0]['code'];
				} else {
					$uid = $rs2[0]['uid'];
					$this->realCode = $rs2[0]['code'];
				}
			}
		} else {
			$uid = $rs[0]['uid'];
			$this->realCode = $this->code;
		}
		
		$this->realCode = sprintf('%07.0f', $this->realCode);
		
		$userInfo = IUser::getUserInfo($uid);
		$qq = IQQVerifier::getQQByUid($uid);
		$this->qq = $qq;
		$this->mobile = $userInfo['mobile'];
		$len = strlen($qq);
		$ll = ($len - 6);
		$qq1 = substr($qq, 0, 3);
		$qq2 = substr($qq, strlen($qq) - $ll, $ll);
		$this->showQQ = $qq1 . "***" . $qq2;
	}
	
	private static function getId($id) {
//		while ($id > 9999999) {
//			$id = $id - 9999999;
//		}
		return $id;
	}
	
	/**
	 * 发放抽奖券
	 */
	public static function addLotteryCoupon($qq) {
		$db = Config::getDB(self::$db);
		$uid = IUser::getUidByQQ($qq, '');
		$data = array('uid' => $uid, 'qq' => $qq);
		$rs = $db->insert(self::$tableCount, $data);
		return $rs;
	}
	
	/**
	 * 判断是否存在抽奖券
	 */
	private static function getLotteryCoupon($uid) {
		$db = Config::getDB(self::$db);
		$rs = $db->getRows("SELECT * FROM " . self::$tableCount . " WHERE uid = " . $uid);
		if (empty($rs)) {
			return false;
		}
		return true;
	}
	
	private function generateCode($uid, $type) {
		if(($db = Config::getDB(self::$db)) === false)
			return false;
		$i = 0;
		$base = rand(0, 9);
		do {
			$n = ($base + $i) % 10;
			$code = rand($n * 1000000, $n * 1000000 + 999999);
			if ($i > 10) return false;
			$i++;
			$rs = $db->insert(self::$table, array('uid' => $uid, 'create_time' => time(), 'code' => $code, 'type' => $type, 'act_key' => $this->startTime));
		} while (!$rs);
			
		return sprintf('%07.0f', $code);
	}
	
	private static function encodeCode($codes) {
		$codeStr = '';
		foreach ($codes as $type => $code) {
			if(empty($codeStr))
				$codeStr = $type . ':' . implode(',', $code);
			else
				$codeStr .= ';' . $type . ':' . implode(',', $code);
		}
		return $codeStr;
	}
	
	private static function decodeCode($codeStr) {
		$codes = array();
		$typeStrs = explode(';', $codeStr);
		foreach ($typeStrs as $typeStr) {
			$tmp = explode(':', $typeStr);
			$codes[$tmp[0]] = explode(',', $tmp[1]);
		}
		return $codes;
	}
}