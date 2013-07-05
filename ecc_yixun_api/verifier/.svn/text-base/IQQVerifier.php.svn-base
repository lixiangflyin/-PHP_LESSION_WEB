<?php

require_once(PHPLIB_ROOT . 'api/appplatform/user_api.php');

class IQQVerifier {
	
	private $params = null;
	private $uid = 0;
	private $isQQ = false;
	private $blueRet = null;
	private $qq = null;

	private static $errCode;
	private static $errMsg;

	private static function clearErr() {
		self::$errCode = 0;
		self::$errMsg = '';
	}
	
	public function __construct($params = array()) {
		$this->params = $params;
		
		if(isset($params['uid'])) {
			$this->uid = $params['uid'];
		} else {
			$this->uid = IUser::getLoginUid();
		}
		
		if(!empty($this->uid)) {
			$ret = IUser::validateUserFromQQ($this->uid);
			if($ret && $ret['validate']) {
				$this->isQQ = true;
			} else {
				if($ret === false) {
					Logger::err(IUser::$errCode . ' : ' . IUser::$errMsg);
				}
				$this->isQQ = false;
			}
		}

		$this->qq = self::getQQByUid($this->uid);
	}
	
	public function verifyQQ($config = array()) {
		if(empty($this->uid)) {
			return 1;
		}
		// 判断是否QQ用户
		if($this->isQQ) {
			return true;
		} else {
			return 2;
		}
	}
	
	public function verifyVip($config = array()) {
		if(empty($this->uid)) {
			return 1;
		}
		
		// 判断是否QQ用户
		if(!$this->isQQ || !$this->qq) {
			return 2;
		}
		
		// 判断是否QQ会员
		//if(IUser::checkQQVip($this->uid)) {
		if(self::checkQQVip($this->qq)) {
			return true;
		} else {
			return 3;
		}
	}
	
	public function verifyVipYear($config = array()) {
		if(empty($this->uid)) {
			return 1;
		}
		
		// 判断是否QQ用户
		if(!$this->isQQ || !$this->qq) {
			return 2;
		}
		
		// 判断是否QQ年费会员
		//if(IUser::checkQQVipIsYear($this->uid)) {
		if(self::checkQQVipIsYear($this->qq)) {
			return true;
		} else {
			return 3;
		}
	}
	
	public function verifyYellow($config = array()) {
		if(empty($this->uid)) {
			return 1;
		}
		
		// 判断是否QQ用户
		if(!$this->isQQ) {
			return 2;
		}
		
		// 黄钻接口待修改
	}
	
	public function verifyYellowYear($config = array()) {
		if(empty($this->uid)) {
			return 1;
		}
		
		// 判断是否QQ用户
		if(!$this->isQQ) {
			return 2;
		}
		
		// 黄钻年费接口待修改
	}
	
	public function verifyBlue($config = array()) {
		if(empty($this->uid)) {
			return 1;
		}
		
		// 判断是否QQ用户
		if(!$this->isQQ || !$this->qq) {
			return 2;
		}

		// 判断是否蓝钻用户
		if(empty($this->blueRet)) {
			$this->blueRet = self::checkQQBlue($this->qq);
		}
		
		if($this->blueRet && $this->blueRet['isBlue']) {
			return true;
		} else {
			return 3;
		}
	}
	
	public function verifyBlueYear($config = array()) {
		if(empty($this->uid)) {
			return 1;
		}
		
		// 判断是否QQ用户
		if(!$this->isQQ || !$this->qq) {
			return 2;
		}
		
		// 判断是否蓝钻用户
		if(empty($this->blueRet)) {
			//$this->blueRet = IUser::checkQQBlue($this->uid);
			$this->blueRet = self::checkQQBlue($this->qq);
		}
		
		if($this->blueRet && $this->blueRet['isYearBlue']) {
			return true;
		} else {
			return 3;
		}
	}
	
	public function verifyGreen($config = array()) {
		if(empty($this->uid)) {
			return 1;
		}
		
		// 判断是否QQ用户
		if(!$this->isQQ || !$this->qq) {
			return 2;
		}
		
		// 判断是否绿钻用户
		if(self::checkQQGreen($this->qq)) {
			return true;
		} else {
			return 3;
		}
	}
	
	public function verifyMPVip($config = array()) {
		if(empty($this->uid)) {
			return 1;
		}
		
		// 判断是否QQ用户
		if(!$this->isQQ || !$this->qq) {
			return 2;
		}
		
		// 检测月费开通
		if(!empty($config['month_mp'])) {
			$ret = self::checkQQVipByMp($config['month_mp'],$this->qq);
			if($ret === false) {
				Logger::err(IUser::$errCode . ' : ' . IUser::$errMsg);
			}
			
			if($ret) {
				return true;
			}
		}
		
		// 检测年费开通
		if(!empty($config['year_mp'])) {
			$ret = self::checkQQVipByMp($config['year_mp'],$this->qq);
			if($ret === false) {
				Logger::err(IUser::$errCode . ' : ' . IUser::$errMsg);
			}
			
			if($ret) {
				return true;
			} else {
				return 3;
			}
		} else {
			throw new BaseException(ErrorConfig::getErrorCode('unexpected_input'), 'Value year_mp missed in config.');
		}
	}

	public static function getQQByUid($uid) {
		$user_info = UserWg::GetUserInfoByIcsonUid($uid);
	    if($user_info === false || empty($user_info)) {
	        Logger::err("Failed to get user information with uid $uid.");
	        return false;
	    }

	    $user_info = $user_info[0];

	    if(!empty($user_info['qq'])) {
	        $uin = $user_info['qq'];
	    } else {
	        $user_info = IUser::getUserInfo($uid);
	        if($user_info === false) {
	            Logger::err("Failed to get user information with uid $uid.");
	            return false;
	        }

	        $uin = IUser::getQQByAccount($user_info['icsonid']);
	        if($uin === false || $uin == 'openid error') {
	            Logger::err("Failed to get qq with open id $open_id. [ uid : {$uid} ]");
	            return false;
	        }
	    }

	    return $uin;
	}
	/**
	 * 判断用户是否是绿钻会员
	 * @param int $qq
	 * @author scootli
	 */
	public static function checkQQGreen($qq){
		Global $_IP_CFG;
		$url = 'http://' . $_IP_CFG['QQ_GREEN'] . '/fcg-bin/fcg_music_getstate.fcg?uin=' . $qq;
		$host = 'qzone-music.qq.com';
		$checkRet = NetUtil::cURLHTTPGet($url, 2, $host);
		$i = 0;

		if (empty($checkRet)) {
			return false;
		}
		preg_match('/state=\"\d\"/', $checkRet, $state);
		preg_match('/\d/', $state[0], $flag);
		return $flag[0] == 1 ? true : false;
	}

	public static function checkQQVip($qq)
	{
		Global $_IP_CFG;
		$openid = IUser::getOpenidByQQ($qq);
		if ($openid) {
			$appid = OPENQQ_APPID;
			$appkey = '8ef8d1810b5e64898b996a423c78e7c7';
			$sign = md5('openid=' . $openid . '&appid=' . $appid . '&accesskey=' . $appkey);
			$svr_ip = $_IP_CFG['QQ_VIP'][rand(0, count($_IP_CFG['QQ_VIP']) - 1)];
			$url = 'http://' . $svr_ip . '/openapi/isclub.php?openid=' . $openid . '&appid=' . $appid . '&sign=' . $sign . '&realcheck=1';
			$checkRet = NetUtil::cURLHTTPGet(
				$url,
				3,
				'pf.vip.qq.com'
			);
			if (empty($checkRet)) {
				Logger::err(NetUtil::$errCode . ' : ' . NetUtil::$errMsg . " [$svr_ip]");
				self::$errCode = NetUtil::$errCode;
				self::$errMsg = NetUtil::$errMsg;
				return false;
			}
			$vipInfo = json_decode($checkRet);
			return $vipInfo->isclub > 0 ? true : false;
		}
		Logger::err("Failed to convert openid witch account $icsonid.");
		self::$errCode = IUser::$errCode;
		self::$errMsg = IUser::$errMsg;
		return false;
	}

	public static function checkQQVipByMp($mp, $qq = '') {
		self::$errCode = 0;
		self::$errMsg = '';
		
		try {
		
			if(empty($qq)) {
				$uid = self::getLoginUid();
				if(empty($uid)) {
					throw new BaseException(ErrorConfig::getErrorCode('user_not_found'), 'Uid should not be emtpy.');
				}
				
				$qq = self::getQQByUid($uid);
				if($qq === false) {
					throw new BaseException(ErrorConfig::getErrorCode('get_qq_failed'), "Failed to get qq with open id $open_id.");
				}
			}
			
			$vkey = md5($mp . $qq . md5('iyouxi_qqvip'));
			$url = "http://iyouxi.vip.qq.com/jsonp.php?_c=Info&f=lottchance&mp=$mp&uin=$qq&vkey=$vkey&t=" . time();
			
			$ret = NetUtil::cURLHTTPGet($url);
			
			if($ret === false) {
				Logger::err("Request failed with url $url.");
					throw new BaseException(ErrorConfig::getErrorCode('net_error'), "Failed to check qq vip with url $url.");
			}


			$ret_info = ToolUtil::gbJsonDecode($ret);
			if(empty($ret_info)) {
				throw new BaseException(ErrorConfig::getErrorCode('parse_error'), "Failed to parse return string $ret.");
			}
			
			if($ret_info['ret'] != 0) {
				// 33008	GET传值参数不足(uin或者mp或者vkey)
				// 33009	参数格式不正确（uin或mp）
				// 33010	vkey验证失败
				// -1		找不到接口（_c=Info&f=lottchance这部分错误）
				throw new BaseException(ErrorConfig::getErrorCode('qq_vip_verify_error'), "Unexpected return : {$ret_info['ret']}.");
			}
			
			return $ret_info['data'];
		
		} catch(BaseException $e) {
			if(empty(self::$errCode)) {
				self::$errCode = $e->errCode;
				self::$errMsg = $e->errMsg;
			}
			return false;
		}
	}

	public static function checkQQVipIsYear($qq)
	{
		Global $_IP_CFG;
		$openid = IUser::getOpenidByQQ($qq);
		if ($openid) {
			$appid = OPENQQ_APPID;
			$appkey = '8ef8d1810b5e64898b996a423c78e7c7';
			$sign = md5('openid=' . $openid . '&appid=' . $appid . '&accesskey=' . $appkey);
			$url = 'http://' . $_IP_CFG['QQ_YEAR_VIP'] . '/common/isyear.php?openid=' . $openid . '&appid=' . $appid . '&sign=' . $sign;
			$host = 'iyouxi.vip.qq.com';
			$checkRet = NetUtil::cURLHTTPGet($url, 2, $host);
			if (empty($checkRet)) {
				Logger::err(NetUtil::$errCode . ' : ' . NetUtil::$errMsg);
				self::$errCode = NetUtil::$errCode;
				self::$errMsg = NetUtil::$errMsg;
				return false;
			}
			$yearVipInfo = json_decode($checkRet);
			return $yearVipInfo->isyear == 1 ? true : false;
		}
		Logger::err("Failed to convert openid witch account $icsonid.");
		self::$errCode = IUser::$errCode;
		self::$errMsg = IUser::$errMsg;
		return false;
	}

	public static function checkQQBlue($qq)
	{
		Global $_IP_CFG;
		$uin = $qq;
		$url = "http://{$_IP_CFG['QQ_BLUE']}:8080/blue.php?uin=$uin&cmd=14110";

		$checkRet = NetUtil::cURLHTTPGet($url, 2);
		if (empty($checkRet)) {
			Logger::err(NetUtil::$errCode . ' : ' . NetUtil::$errMsg);
			self::$errCode = NetUtil::$errCode;
			self::$errMsg = NetUtil::$errMsg;
			return false;
		}

		$result = array();
		$properties = explode('&', $checkRet);
		foreach ($properties as $p) {
			$tmp = explode('=', $p);
			$result[$tmp[0]] = $tmp[1];
		}

		return array(
			'isBlue'     => isset($result['result']) && $result['result'] == 0,
			'isYearBlue' => isset($result['annual']) && $result['annual'] == 1
		);
	}
}
