<?php
require_once(PHPLIB_ROOT . 'api/appplatform/user_api.php');

class IUserVerifier {

	const STATUS_BIT_BIND_EMAIL = 12;
	const STATUS_BIT_BIND_MOBILE = 13;
	
	private $params = null;
	private $userInfo = null;
	
	public function __construct($params = array()) {
		$this->params = $params;
		
		if(isset($params['uid'])) {
			$uid = $params['uid'];
		} else {
			$uid = IUser::getLoginUid();
		}
		
		if(!empty($uid)) {
			$ret = UserWg::GetUserInfoByIcsonUid($uid);
			if ($ret == false) {
				Logger::err(UserWg::$errCode . ' : ' . UserWg::$errMsg);
			}
			if(!empty($ret)) {
				$this->userInfo = $ret[0];
			}
		}
	}
	
	public function verifyNewUser($config = array()) {
		if(empty($this->userInfo)) {
			return 1;
		}
		
		//判断用户是否是新用户
		if( $this->userInfo['exp_point'] > 1) {
			return 2;
		}
		
		return true;
	}
	
	public function verifyOldUser($config = array()) {
		if(empty($this->userInfo)) {
			return 1;
		}
		
		//判断用户是否是老用户
		if( $this->userInfo['exp_point'] <= 1) {
			return 2;
		}
		
		return true;
	}
	
	public function verifyLevel($config = array()) {
		if(isset($config['level'])) {
			$level = $config['level'];
		} else {
			throw new BaseException(ErrorConfig::getErrorCode('unexpected_input'), "Unexpected verify configuration.");
		}
		
		if(empty($this->userInfo)) {
			return 1;
		}
		
		//判断用户等级是否符合
		/*global $_UserLevel;
		$ulevel = 0;
		foreach ($_UserLevel as $k => $ul) {
			if ($ul['startV'] <= $this->userInfo['exp_point'] && $ul['endV'] >=  $this->userInfo['exp_point']) {
				$ulevel = $k;
				break;
			}
		}*/
		$ulevel = $this->userInfo['level'];
		if ($ulevel < $level) {
			return 2;
		}
		
		return true;
	}
	
	public function verifyBindMobile($config = array()) {
		if(empty($this->userInfo)) {
			return 1;
		}
		
		//判断用户是否绑定手机
		if ($this->userInfo['mobile'] == '') {
			return 2;
		}
		
		/*$uid = $this->userInfo['uid'];
		$mobileState = ITelLoginTTC::get($this->userInfo['mobile'], array('uid' => $uid));
		if (false === $mobileState ) {
			throw new BaseException(ITelLoginTTC::$errCode, ITelLoginTTC::$errMsg);
		}
		global $_MobileStat;
		if (count($mobileState) == 0 || $mobileState[0]['uid'] != $uid || $mobileState[0]['status'] != $_MobileStat['bound']) {
			return 3;
		}*/
		if(!$this->userInfo['status_bits'][self::STATUS_BIT_BIND_MOBILE]) {
			return 3;
		}
		
		return true;
	}
	
	public function verifyBindEmail($config = array()) {
		if(empty($this->userInfo)) {
			return 1;
		}
		
		//判断用户是否绑定邮箱
		if ($this->userInfo['email'] == '') {
			return 2;
		}
		
		/*$uid = $this->userInfo['uid'];
		$emailState = IEmailLoginTTC::get($this->userInfo['email']);
		if (false === $emailState) {
			throw new BaseException(IEmailLoginTTC::$errCode, IEmailLoginTTC::$errMsg);
		}
		global $_EmailStat;
		if (count($emailState) == 0 || $emailState[0]['uid'] != $uid || $emailState[0]['status'] != $_EmailStat['bound']) {
			return 3;
		}*/
		if(!$this->userInfo['status_bits'][self::STATUS_BIT_BIND_EMAIL]) {
			return 3;
		}
		
		return true;
	}
	
	public function verifyAppoint($config = array()) {
		if(isset($config['act_id'])) {
			$act_id = $config['act_id'];
		} else {
			throw new BaseException(ErrorConfig::getErrorCode('unexpected_input'), "Unexpected verify configuration.");
		}
		
		if(empty($this->userInfo)) {
			return 1;
		}
		
		$uid = $this->userInfo['uid'];
		if(IActAppoint::hasAppointed($act_id, $uid)) {
			return true;
		} else {
			return 2;
		}
	}
}