<?php
/*错误码定义
 * 21 => 所查询的广告位类型或广告位id为空
 * 22 => 未找到指定广告位类型
 * 31 => 需要删除广告的广告位类型不能为空
 * 32 => 需要删除广告的ID不能为空
 * 33 => 删除广告失败
 */
class IMobile {
	public static $errMsg = "";
	public static $errCode = 0;
	protected static $keyPrefix = 'IMobileCodeCache::';
	protected static $bindNumKeyPrefix = 'IMobileNumCache::';
	protected static $expire = 150;

	protected static $isSafeForBindMInfo = array(
		'mid' => 233000138,
		'cid' => 233000139,
		'fid' => 133000574,
	);

	protected static $isNeedVerify = array(
		'mid' => 233000138,
		'cid' => 233000139,
		'fid' => 133000575,
	);

	protected static $freqLimitMInfo = array(
		'mid' => 233000138,
		'cid' => 233000133,
		'fid' => 133000573,
	);

	protected static $errorLimit = 20;
	
	static $testUID = array(
		6875042 => 1,
	);

	public static function genSmsCode($uid) {
//		return 123456;

		global $_CMEM_CFG;
		$code = "";
		$chars = '1234567890';
		$charsLen = strlen($chars);
		for ( $i = 0; $i < 6; $i++ ) {
			$code .= $chars[ mt_rand(0, $charsLen - 1) ];
		}

		$cmem = CMemFactory::factory($_CMEM_CFG['smsCode']);
		$rs = $cmem->set(self::getKey($uid), serialize(array(
			'code'	=> $code,
			'createdTime' => time(),
			'errorTimes' => 0,
		)), self::$expire);

		if (!$rs) {
			return false;
		}

		return $code;
	}

	public static function verifySmsCode($uid, $smsCode) {
//		return true;

		global $_CMEM_CFG;
		$cmem = CMemFactory::factory($_CMEM_CFG['smsCode']);
		$val = $cmem->get(self::getKey($uid));
		if (!isset($val[0])) {
			self::$errCode = 7021;
			self::$errMsg = '系统繁忙，请稍后再试';
			return false;
		}

		$val = unserialize($val[0]);

		//超时失败
		if ($val['createdTime'] + self::$expire < time()) {
			self::$errCode = 7022;
			self::$errMsg = '您的短信验证码已过期';
			return false;
		}

		//尝试超过次数限制
		if ($val['errorTimes'] > self::$errorLimit) {
			self::$errCode = 7023;
			self::$errMsg = '您的短信验证码由于尝试次数过多已过期';
			return false;
		}

		if (strtolower($smsCode) == strtolower($val['code'])) {
			$cmem->del(self::getKey($uid));
			return true;
		} else {
			$val['errorTimes']++;
			$rs = $cmem->set(self::getKey($uid), serialize($val));
			self::$errCode = 7024;
			self::$errMsg = '短信验证码输入错误';
			return false;
		}
	}

	public static function prePareBindNum($uid, $mobile) {
//		return true;

		global $_CMEM_CFG;

		$cmem = CMemFactory::factory($_CMEM_CFG['smsCode']);
		$rs = $cmem->set(self::getNumKey($uid), $mobile);

		return $rs ? true : false;
	}


	public static function getBindInfo($uid) {
		global $_IP_CFG;
		$info = IUser::getUserInfo($uid);
		$request = array(
			"scene_id" => 10, //   ABC
			"time" => time(), // 秒数 ABC
			"user_id" => (int)$uid, // 易迅ID， ABC
			"ip" => ToolUtil::getClientIP(), // IP， ABC
			"vk" => $_COOKIE["visitkey"], // 易迅COOKIE， ABC
			"wireless" => 1, // 是否在无线环境 0 -PC， 1-无线， ABC
			"total_point" => $info['total_point'], // 积分总数（单位个） ABC
		);

		$mlog = new CLoggerWrap(self::$isSafeForBindMInfo['mid']);
		$mlog->start();
		$response = NetUtil::udpCmd($_IP_CFG['safeService']['ip'], $_IP_CFG['safeService']['port'], json_encode($request));
		//服务挂了
		if (!$response) {
			$mlog->report(self::$isSafeForBindMInfo['cid'], self::$isSafeForBindMInfo['fid'], 0, 1, LocalIP, LocalIP );
			Logger::err("IMobile::isSafeForBind safe service down");
			return false;
		}
		$mlog->report(self::$isSafeForBindMInfo['cid'], self::$isSafeForBindMInfo['fid'], 0, 0, LocalIP, LocalIP );
		$response = json_decode($response);

		return $response;
	}

	public static function getBindList($uid) {
		$response = self::getBindInfo($uid);

		if ($response->need_verify == 1) {
			if (isset($response->trusted_mobile_list) && !empty($response->trusted_mobile_list)) {
				return $response->trusted_mobile_list;
			} else {
				return false;
			}
		}
		return true;
	}

	public static function isSafeForBind($uid, $mobile) {
		$response = self::getBindInfo($uid);

		//验证失败
		if ($response->need_verify == 1 && !in_array($mobile, $response->trusted_mobile_list)) {
			return false;
		}
		return true;
	}

	public static function isNeedSmsCode($uid, $post) {
//		return true;

		global $_IP_CFG;
		$info = IUser::getUserInfo($uid);
		$areaInfo = IArea::getAreaInfoByDistrictId($post['receiveAddrId']);
		$request = array(
			"scene_id" => 1,
			"time" => time(),
			"user_id" => (int)$uid,
			"ip" => ToolUtil::getClientIP(),
			"vk" => empty($_COOKIE["visitkey"])?'':$_COOKIE["visitkey"],
			"wireless" => 1,
			"total_point" => $info['total_point'],
			"name" => isset($post['receiver']) ? iconv('GBK', 'UTF-8', $post['receiver']) : '',
			"address" => array(
				"province" => iconv('GBK', 'UTF-8', $areaInfo['province']),
				"city" => iconv('GBK', 'UTF-8', $areaInfo['city']),
				"region" => iconv('GBK', 'UTF-8', $areaInfo['district']),
				"full_address" => isset($post['receiveAddrDetail']) ? iconv('GBK','UTF-8', $post['receiveAddrDetail']) : '',
			),
			"mobile" => isset($post['receiverMobile']) ? $post['receiverMobile'] : '',
			"total_fee" => intval(isset($post['Price']) ? $post['Price'] : 0),
			"point_pay" => intval(isset($post['point']) ? $post['point'] : 0),
		);
		$mlog = new CLoggerWrap(self::$isNeedVerify['mid']);
		$mlog->start();
		$response = NetUtil::udpCmd($_IP_CFG['safeService']['ip'], $_IP_CFG['safeService']['port'], json_encode($request));

		//服务挂了
		if (!$response) {
			$mlog->report(self::$isNeedVerify['cid'], self::$isNeedVerify['fid'], 0, 1, LocalIP, LocalIP );
			Logger::err("IMobile::isNeedSmsCode safe service down");
			return true;
		}
		$mlog->report(self::$isNeedVerify['cid'], self::$isNeedVerify['fid'], 0, 0, LocalIP, LocalIP );
		$response = json_decode($response);
		
		return $response->need_verify == 1 ? true : false;
	}

	public static function BindMobile($uid, $mobile) {
//		return true;

		global $_CMEM_CFG;
		$cmem = CMemFactory::factory($_CMEM_CFG['smsCode']);
		$val = $cmem->get(self::getNumKey($uid));
		if (isset($val[0])) {
			$val = $val[0];
			if ($val != $mobile) {
				self::$errMsg = '系统繁忙，请稍后再试';
				self::$errCode = 8011;
				return false;
			}
			if (!IUser::realBindMobileWithoutCodeCheck($uid, $mobile)) {
				self::$errMsg = IUser::$errMsg;
				self::$errCode = IUser::$errCode;
				return false;
			} else {
				return true;
			}
		} else {
			self::$errMsg = '系统繁忙，请稍后再试';
			self::$errCode = 8001;
			return false;
		}
	}

	public static function sendSmsCode($uid, $mobile) {
		$mlogCheck = new CLoggerWrap(self::$freqLimitMInfo['mid']);
		$mlogCheck -> start();
		$rs = IFreqLimit::checkByStr($uid, 'SMSCode');
//		if (1) {//频次控制
		if ($rs === 0) {//频次控制
			$mlogCheck->report(self::$freqLimitMInfo['cid'], self::$freqLimitMInfo['fid'], 0, 0, LocalIP, LocalIP );
			$smsCode = IMobile::genSmsCode($uid);
			if ($smsCode === false) {
				self::$errMsg = '系统繁忙，请稍后再试';
				self::$errCode = 7101;
				return false;
			}
			$result = IFreqLimit::addByStrKey($uid, 'SMSCode');
			IMessage::sendSMSMessage($mobile, "您在易迅网使用积分下单，验证码为" . $smsCode);
			return true;
		} else {
			$mlogCheck->report(self::$freqLimitMInfo['cid'], self::$freqLimitMInfo['fid'], 0, 1, LocalIP, LocalIP );
			self::$errMsg = '请输入您收到的短信验证码';
			self::$errCode = 7105;
			Logger::err("IMobile::sendSmsCode failed-" . self::$errCode . '-' . self::$errMsg);
			return false;
		}
	}

	public static function isBind($uid) {
		global $_MobileStat;

		$info = IUser::getUserInfo($uid);
		if (empty($info['mobile'])) {
			return false;
		}

		$item = IUser::_getTTCInfo("ITelLoginTTC", ($info['mobile']));
		if (false === $item) {
			return false;
		}

		foreach ($item as $i) {
			if ($i['uid'] == $uid && $i['status'] == $_MobileStat['bound']) {
				return true;
			}
		}

		return false;
	}

	public static function getKey($seed) {
		return self::$keyPrefix . $seed;
	}

	public static function getNumKey($seed) {
		return self::$bindNumKeyPrefix . $seed;
	}

	public static function maskMobile($mobile) {
		return preg_replace("/^(\d{3})\d{4}(\d{4})/", "$1****$2", $mobile);
	}

}
