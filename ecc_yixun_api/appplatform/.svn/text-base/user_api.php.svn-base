<?php
// require_once('platform/web_stub_cntl.php');
// require_once('platform/lang_util.php');
require_once('usericsonao_php5_stub.php');
require_once('usericsonao_php5_xxoo.php');
require_once('userapiao_php5_stub.php');

if (!defined("PHPLIB_ROOT")) {
	define('PHPLIB_ROOT', '/data/release/PHPLIB/');
}
require_once(PHPLIB_ROOT . "lib/Config.php");
require_once(PHPLIB_ROOT . 'lib/ToolUtil.php');
if (!defined("AUTHCODE")) {
	define('AUTHCODE', "zxcvbnm");
}
if (!defined("USER_API_TIME_OUT")) {
	define('USER_API_TIME_OUT', 2);
}

class UserWg{
	public static $errMsg = "";
	public static $errCode = 0;
   //调用网购侧接口
	public static $gCntl = false;
	
	public static function initCntl($uid=277631272, $skey="0123456789")
	{
		$g_cntl = new WebStubCntl();
		$sPassport = $skey;
		/*
		$ip = Config::getIP('USER_WG_AO');
		if (NULL == $ip) {
			self::$errCode = 110;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[getip failed ($ip : session_{$index} : time {$time_} : cmd {$cmd_})]";
			return false;
		}
		$rand_keys = array_rand($ip,1);
		$ip = $ip[$rand_keys];
		
		$g_cntl->setPeerIPPort($ip["IP"], $ip["PORT"]);
		*/
		$g_cntl->setDwOperatorId($uid);
		$g_cntl->setSPassport($sPassport);
		$g_cntl->setDwSerialNo(10002);
		$g_cntl->setDwUin($uid);
		$g_cntl->setWVersion(2);
		$g_cntl->setCallerName("USER");
		self::$gCntl = $g_cntl;
		return;
	}
	public static function updateUserWg($uid, $newInfo)
	{
		Logger::info("[IUser::updateUserWg trace], start! uid=".$uid.",newInfo=".print_r($newInfo, true));
		global $_EmailStat;
		global $_IcsonAccStat;
		global $_MobileStat;
		//检查参数
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[uid($uid) is invalid]";
			return false;
		}

		if (!is_array($newInfo) || count($newInfo) == 0) {
			self::$errCode = 22;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[update new newInfo array is empty]";
			return false;
		}
		//易迅id不能更新
		if (isset($newInfo['icsonid'])) 
		{
			unset($newInfo['icsonid']);
		}
		

		if (isset($newInfo['qq']) && $newInfo['qq'] < 10000) {
			self::$errCode = 23;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[new newInfo[qq](" . $newInfo['qq'] . ") is invalid]";
			return false;
		}
		if (isset($newInfo['email']) && $newInfo['email'] == '') {
			unset($newInfo['email']);
		}
		if (isset($newInfo['mobile']) && $newInfo['mobile'] == '') {
			unset($newInfo['mobile']);
		}
// 		self::initCntl($uid);
// 		$g_cntl = self::$gCntl;
// 		$reqSps = new ModifyBasicUserInfoByIcsonUidReq();
// 		$respSps = new ModifyBasicUserInfoByIcsonUidResp();
		$reqSps->source = __FILE__;
		$reqSps->machineKey = ToolUtil::getClientIP();
		$reqSps->sceneId = 0;
		$reqSps->authCode = AUTHCODE;
		$reqSps->icsonUid = $uid;
// 		$buyerInfoPo = new BuyerInfoPo();
		$buyerInfoPo->icsonUid = $uid;
		$buyerInfoPo->icsonUid_u = 1;
// 		$arr_value[] = 0;
// 		$buyerInfoPo->bitProperty = $arr_value;
// 		$buyerInfoPo->userFlagLevel = $arr_value;
		if(isset($newInfo['qq']))
		{
			$buyerInfoPo->qQNumber = $newInfo['qq'];
			$buyerInfoPo->qQNumber_u = 1;
		}
		if(isset($newInfo['name']))
		{
			$buyerInfoPo->truename = $newInfo['name'];
			$buyerInfoPo->truename_u = 1;
		}
		if(isset($newInfo['nickname']))
		{
			$buyerInfoPo->nickname = $newInfo['nickname'];
			$buyerInfoPo->nickname_u = 1;
		}
		if(isset($newInfo['sex']))
		{
			$buyerInfoPo->sex = $newInfo['sex'] == "m" ? 1 : ($newInfo['sex'] == "f" ? 2 : 0);
			$buyerInfoPo->sex_u = 1;
		}
		if(isset($newInfo['mobile']))
		{
			$buyerInfoPo->mobile = $newInfo['mobile'];
			$buyerInfoPo->mobile_u = 1;
		}
		if(isset($newInfo['email']))
		{
			$buyerInfoPo->email = $newInfo['email'];
			$buyerInfoPo->email_u = 1;
		}
		if(isset($newInfo['phone']))
		{
			$buyerInfoPo->phone = $newInfo['phone'];
			$buyerInfoPo->phone_u = 1;
		}
		if(isset($newInfo['fax']))
		{
			$buyerInfoPo->fax = $newInfo['fax'];
			$buyerInfoPo->fax_u = 1;
		}
		if(isset($newInfo['zipcode']))
		{
			$buyerInfoPo->postcode = $newInfo['zipcode'];
			$buyerInfoPo->postcode_u = 1;
		}
		if(isset($newInfo['address']))
		{
			$buyerInfoPo->address = $newInfo['address'];
			$buyerInfoPo->address_u = 1;
		}
		if(isset($newInfo['identity']))
		{
			$buyerInfoPo->identityNum = $newInfo['identity'];
			$buyerInfoPo->identityNum_u = 1;
		}
		if(isset($newInfo['status_bits']))
		{
			$buyerInfoPo->bitProperty = $newInfo['status_bits'];
			$buyerInfoPo->bitProperty_u = 1;
		}
		/*
		if(isset($newInfo['exp_point']))
		{
			$buyerInfoPo->experience = $newInfo['exp_point'];
			$buyerInfoPo->cExperience_u = 1;
		}
		*/
		if(isset($newInfo['type']))
		{
			$buyerInfoPo->userType = $newInfo['type'];
			$buyerInfoPo->userType_u = 1;
		}
		if(isset($newInfo['retailerLevel']))
		{
			$buyerInfoPo->retailerLevel = $newInfo['retailerLevel'];
			$buyerInfoPo->retailerLevel_u = 1;
		}
		/*
		if(isset($newInfo['level']))
		{
			$buyerInfoPo->cIcsonMemberLevel = $newInfo['level'];
			$buyerInfoPo->cIcsonMemberLevel_u = 1;
		}
		*/
		$buyerInfoPo->lastUpdateTime = time();
		$buyerInfoPo->lastUpdateTime_u = 1;
		$reqSps->buyerInfoPo = (array)$buyerInfoPo;
// 		$ret = $g_cntl->invoke($reqSps, $respSps, USER_API_TIME_OUT);
		$uid = intval($uid);
		$ret = WebStubCntl2::request(
				'b2b2c\user\ao\ModifyBasicUserInfoByIcsonUid',
				array(
						'opt' => array(
								'uin' => $uid,
								'operator' => $uid,
								'caller' => 'User'
						),
						'req' => (array)$reqSps
				)
		);
		if($ret && 0 == $ret['code'])
		{
			Logger::info("[IUser::updateUserWg trace], success ! uid=".$uid);
			return true;
		}
		self::$errCode = $ret['code'];
		self::$errMsg = $ret['msg'];
		Logger::err("[IUser::updateUserWg trace], Error in " . self::$errCode."===".self::$errMsg.";uid=".$uid);
		return false;
	}
	public static function updateUserExpWg($uid, $newInfo)
	{
		Logger::info("[IUser::updateUserExpWg trace], start! uid=".$uid.",newInfo=".print_r($newInfo, true));
		//检查参数
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[uid($uid) is invalid]";
			return false;
		}

		if (!is_array($newInfo) || count($newInfo) == 0) {
			self::$errCode = 22;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[updateUserExpWg new newInfo array is empty]";
			return false;
		}
		if (!isset($newInfo['exp_point'])) 
		{
			self::$errCode = 23;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[updateUserExpWg new newInfo array is exp_point empty]";
			return false;
		}

// 		self::initCntl($uid);
// 		$g_cntl = self::$gCntl;
// 		$reqSps = new ModifyExperienceByIcsonUidReq();
// 		$respSps = new ModifyExperienceByIcsonUidResp();
		$reqSps->source = __FILE__;
		$reqSps->machineKey = ToolUtil::getClientIP();
		$reqSps->sceneId = 0;
		$reqSps->authCode = AUTHCODE;
		$reqSps->icsonUid = $uid;
		$reqSps->experience = $newInfo['exp_point'];
// 		$ret = $g_cntl->invoke($reqSps, $respSps, USER_API_TIME_OUT);
		$ret = WebStubCntl2::request(
				'b2b2c\user\ao\ModifyExperienceByIcsonUid',
				array(
						'opt' => array(
								'uin' => $uid,
								'operator' => $uid,
								'caller' => 'User'
						),
						'req' => (array)$reqSps
				)
		);
		if(0 != $ret['code'])
		{
			self::$errCode = $ret['code'];
			self::$errMsg = $ret['msg'];
			Logger::err("[IUser::updateUserExpWg trace], Error in " . self::$errCode."===".self::$errMsg.";uid=".$uid);
			return false;	
		}
		Logger::info("[IUser::updateUserExpWg trace], success ! uid=".$uid);
		return true;
	}
	public static function updateUserLevelWg($uid, $newInfo)
	{
		Logger::info("[IUser::updateUserLevelWg trace], start! uid=".$uid.",newInfo=".print_r($newInfo, true));
		//检查参数
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[uid($uid) is invalid]";
			return false;
		}

		if (!is_array($newInfo) || count($newInfo) == 0) {
			self::$errCode = 22;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[updateUserExpWg new newInfo array is empty]";
			return false;
		}
		if (!isset($newInfo['level'])) 
		{
			self::$errCode = 23;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[updateUserExpWg new newInfo array is level empty]";
			return false;
		}

// 		self::initCntl($uid);
// 		$g_cntl = self::$gCntl;
// 		$reqSps = new ModifyIcsonMemberLevelByIcsonUidReq();
// 		$respSps = new ModifyIcsonMemberLevelByIcsonUidResp();
		$reqSps->source = __FILE__;
		$reqSps->machineKey = ToolUtil::getClientIP();
		$reqSps->sceneId = 0;
		$reqSps->authCode = AUTHCODE;
		$reqSps->icsonUid = $uid;
		$reqSps->icsonMemberLevel = $newInfo['level'];
// 		$ret = $g_cntl->invoke($reqSps, $respSps, USER_API_TIME_OUT);
		$ret = WebStubCntl2::request(
				'b2b2c\user\ao\ModifyIcsonMemberLevelByIcsonUid',
				array(
						'opt' => array(
								'uin' => $uid,
								'operator' => $uid,
								'caller' => 'User'
						),
						'req' => (array)$reqSps
				)
		);
		if(0 != $ret['code'])
		{
			self::$errCode = $ret['code'];
			self::$errMsg = $ret['msg'];
			Logger::err("[IUser::updateUserLevelWg trace], Error in " . self::$errCode."===".self::$errMsg.";uid=".$uid);
			return false;	
		}
		Logger::info("[IUser::updateUserLevelWg trace], success ! uid=".$uid);
		return true;	
	}
	/**
	 * 网购统一绑定用户手机或邮箱
	 * @param  [type] $uid    [description]
	 * @param  [type] $mobile [description]
	 * @return [type]         [description]
	 */
	public static function bindMobileOrEmailWg($uid, $type, $bindInfo)
	{
		Logger::info("[IUser::bindMobileOrEmailWg trace], start! uid=".$uid.",type=".$type.",bindInfo=".$bindInfo);
		//检查参数
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[uid($uid) is invalid]";
			return false;
		}

// 		self::initCntl($uid);
// 		$g_cntl = self::$gCntl;
// 		$reqSps = new AddBindInfoWithIcsonUidReq();
// 		$respSps = new AddBindInfoWithIcsonUidResp();
		$reqSps->source = __FILE__;
		$reqSps->machineKey = ToolUtil::getClientIP();
		$reqSps->sceneId = 0;
		$reqSps->authCode = AUTHCODE;
		$reqSps->icsonUid = $uid;
		$reqSps->bindInfoType = $type;
		$reqSps->bindInfo = $bindInfo;
		$reqSps->inReserve = "";
// 		$ret = $g_cntl->invoke($reqSps, $respSps, USER_API_TIME_OUT);
		$ret = WebStubCntl2::request(
				'b2b2c\user\ao\AddBindInfoWithIcsonUid',
				array(
						'opt' => array(
								'uin' => $uid,
								'operator' => $uid,
								'caller' => 'User'
						),
						'req' => (array)$reqSps
				)
		);
		if(0 != $ret['code'])
		{
			self::$errCode = $ret['code'];
			self::$errMsg = $ret['msg'];
			Logger::err("[IUser::bindMobileOrEmailWg trace], Error in " . self::$errCode."===".self::$errMsg.";uid=".$uid);
			return false;	
		}
		Logger::info("[IUser::bindMobileOrEmailWg trace], success! uid=".$uid);
		return true;
	}
	/**
	 * [unbindMobileOrEmailWg 网购统一解绑定用户手机或邮箱]
	 * @param  [type] $uid      [description]
	 * @param  [type] $type     [description]
	 * @param  [type] $bindInfo [description]
	 * @return [type]           [description]
	 */
	public static function unbindMobileOrEmailWg($uid, $type, $bindInfo)
	{
		Logger::info("[IUser::unbindMobileOrEmailWg trace], start! uid=".$uid.",type=".$type.",bindInfo=".$bindInfo);
		//检查参数
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[uid($uid) is invalid]";
			return false;
		}

// 		self::initCntl($uid);
// 		$g_cntl = self::$gCntl;
// 		$reqSps = new RemoveBindInfoWithIcsonUidReq();
// 		$respSps = new RemoveBindInfoWithIcsonUidResp();
		$reqSps->source = __FILE__;
		$reqSps->machineKey = "1";
		$reqSps->sceneId = 0;
		$reqSps->authCode = AUTHCODE;
		$reqSps->icsonUid = $uid;
		$reqSps->bindInfoType = $type;
		$reqSps->bindInfo = $bindInfo;
		$reqSps->inReserve = "";
// 		$ret = $g_cntl->invoke($reqSps, $respSps, USER_API_TIME_OUT);
		$ret = WebStubCntl2::request(
				'b2b2c\user\ao\RemoveBindInfoWithIcsonUid',
				array(
						'opt' => array(
								'uin' => $uid,
								'operator' => $uid,
								'caller' => 'User'
						),
						'req' => (array)$reqSps
				)
		);
		if(0 != $ret['code'])
		{
			self::$errCode = $ret['code'];
			self::$errMsg = $ret['msg'];
			Logger::err("[IUser::unbindMobileOrEmailWg trace], Error in " . self::$errCode."===".self::$errMsg.";uid=".$uid);
			return false;	
		}
		Logger::info("[IUser::unbindMobileOrEmailWg trace], success! uid=".$uid);	

		return true;
	}

	/**
	 * [resetPasswordWg 网购统一用户接口 重置用户密码]
	 * @param  [type] $uid     [description]
	 * @param  [type] $newPass [description]
	 * @param  [type] $oldPass [description]
	 * @return [type]          [description]
	 */
	public static function resetPasswordWg($uid, $newPass)
	{
		Logger::info("[IUser::resetPasswordWg trace], start! uid=".$uid);
		if ($uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . " uid($uid) is invalid";
			return false;
		}

		$newPassLen = strlen($newPass);
		if ($newPassLen < MIN_PASS_LEN || $newPassLen > MAX_PASS_LEN) {
			self::$errCode = 17;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . " new pass length is invalid";
			return false;
		}

		/*$item = self::_getTTCInfo("IUserPassTTC", $uid);
		if (false === $item)
			return false;

		if (($item[0]['password']) != md5($oldPass)) {
			self::$errMsg = "您输入的旧密码不正确";
			self::$errCode = 35;
			return false;
		}*/
		//直接调用网购接口修改用户密码
// 		self::initCntl($uid);
// 		$g_cntl = self::$gCntl;
// 		$reqSps = new ResetAccountPasswdByIcsonUidReq();
// 		$respSps = new ResetAccountPasswdByIcsonUidResp();
		$reqSps->source = __FILE__;
		$reqSps->machineKey = ToolUtil::getClientIP();
		$reqSps->sceneId = 0;
		$reqSps->authCode = AUTHCODE;
		$reqSps->icsonUid = $uid;
		$reqSps->initPasswd = $newPass;
// 		$ret = $g_cntl->invoke($reqSps, $respSps, USER_API_TIME_OUT);
		$ret = WebStubCntl2::request(
				'b2b2c\user\ao\ResetAccountPasswdByIcsonUid',
				array(
						'opt' => array(
								'uin' => $uid,
								'operator' => $uid,
								'caller' => 'User'
						),
						'req' => (array)$reqSps
				)
		);
		if(0 != $ret['code'])
		{
			self::$errCode = $ret['code'];
			self::$errMsg = $ret['msg'];
			Logger::err("[IUser::resetPasswordWg trace], Error in " . self::$errCode."===".self::$errMsg.";uid=".$uid);
			return false;	
		}
		Logger::info("[IUser::resetPasswordWg trace],  success! uid = " . $uid);
		return true;
	}
	/**
	 * [modifyPasswordWg 网购统一用户接口 修改用户密码]
	 * @param  [type] $uid     [description]
	 * @param  [type] $newPass [description]
	 * @param  [type] $oldPass [description]
	 * @return [type]          [description]
	 */
	public static function modifyPasswordWg($uid, $newPass, $oldPass)
	{
		Logger::info("[IUser::modifyPasswordWg trace], start! uid=".$uid);
		if ($uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . " uid($uid) is invalid";
			return false;
		}

		$newPassLen = strlen($newPass);
		if ($newPassLen < MIN_PASS_LEN || $newPassLen > MAX_PASS_LEN) {
			self::$errCode = 17;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . " new pass length is invalid";
			return false;
		}
		$oldPassLen = strlen($oldPass);
		if ($oldPassLen < MIN_PASS_LEN || $oldPassLen > MAX_PASS_LEN) {
			self::$errCode = 17;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . " old pass length is invalid";
			return false;
		}

		/*$item = self::_getTTCInfo("IUserPassTTC", $uid);
		if (false === $item)
			return false;

		if (($item[0]['password']) != md5($oldPass)) {
			self::$errMsg = "您输入的旧密码不正确";
			self::$errCode = 35;
			return false;
		}*/
		//直接调用网购接口修改用户密码
// 		self::initCntl($uid);
// 		$g_cntl = self::$gCntl;
// 		$reqSps = new ModifyAccountPasswdByIcsonUidReq();
// 		$respSps = new ModifyAccountPasswdByIcsonUidResp();
		$reqSps->source = __FILE__;
		$reqSps->machineKey = ToolUtil::getClientIP();
		$reqSps->sceneId = 0;
		$reqSps->authCode = AUTHCODE;
		$reqSps->icsonUid = $uid;
		$reqSps->oldPasswd = $oldPass;
		$reqSps->newPasswd = $newPass;
// 		$ret = $g_cntl->invoke($reqSps, $respSps, USER_API_TIME_OUT);
		$ret = WebStubCntl2::request(
				'b2b2c\user\ao\ModifyAccountPasswdByIcsonUid',
				array(
						'opt' => array(
								'uin' => $uid,
								'operator' => $uid,
								'caller' => 'User'
						),
						'req' => (array)$reqSps
				)
		);
		if(0 != $ret['code'])
		{
			self::$errCode = $ret['code'];
			self::$errMsg = $ret['msg'];
			Logger::err("[IUser::modifyPasswordWg trace], Error in " . self::$errCode."===".self::$errMsg.";uid=".$uid);
			return false;	
		}
		Logger::info("[IUser::modifyPasswordWg trace],  success! uid = " . $uid);
		return true;
	}
	/**
	 * [ImportCopartnerUserInfo 用户接口切换 前期导入易迅数据到网购]
	 * @param [type] $uid     [description]
	 * @param [type] $account [description]
	 * @param [type] $type    [description]
	 */
	public static function ImportCopartnerUserInfo($uid, $account, $type)
	{
		global $_LoginType;
		Logger::info("[IUser::ImportCopartnerUserInfo trace], start! uid =".$uid.",account=".$account.";type=".$type);
// 		self::initCntl($uid);
// 		$g_cntl = self::$gCntl;
// 		$reqSps = new ImportCopartnerUserInfoReq();
// 		$respSps = new ImportCopartnerUserInfoResp();
		
		$reqSps->source = __FILE__;
		$reqSps->machineKey = ToolUtil::getClientIP();
		$reqSps->sceneId = 1;
		$reqSps->loginName = $account;
		//copartnerUserInfo
		
		$userInfo = IUser::getUserInfo($uid);
		if ($userInfo === false) {
			self::$errCode = 99;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[get userpass ttc failed" . $type . " , user " . $account;
			return false;
			return false;
		}

		$passitem = IUser::_getTTCInfo("IUserPassTTC", $uid);
		if (false === $passitem) {
			self::$errCode = 99;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[get userpass ttc failed" . $type . " , user " . $account;
			return false;
		}
		if (count($passitem) == 0) {
			self::$errCode = 66;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[query passTTC, pass not exist!]";
			return false;
		}
// 		$copartnerUserInfo = new CopartnerUserInfoPo();
		if($type == $_LoginType['qq'])
		{
			$reqSps->loginNameType = 1;
			$copartnerUserInfo->qqNumber = $account;
			$copartnerUserInfo->qqNumber_u = 1;
		}
		else
		{
			$reqSps->loginNameType = 2;
			$copartnerUserInfo->qqNumber = $userInfo['qq'];
			$copartnerUserInfo->qqNumber_u = 1;
		}
		//导数据结构
// 		$copartnerUserInfo->dwIcsonUid = $uid;
// 		$copartnerUserInfo->cIcsonUid_u = 1;
// 		$copartnerUserInfo->strTruename = $userInfo['name'];
// 		$copartnerUserInfo->cTruename_u = 1;
		$copartnerUserInfo->password = $passitem[0]["password"];
		$copartnerUserInfo->password_u = 1;
		$copartnerUserInfo->email = $userInfo['email'];
		$copartnerUserInfo->email_u = 1;
		$copartnerUserInfo->mobile = $userInfo['mobile'];
		$copartnerUserInfo->mobile_u = 1;
		$copartnerUserInfo->nickname = $userInfo['nick'];
		$copartnerUserInfo->nickname_u = 1;
		$copartnerUserInfo->sex = $userInfo['sex'] == "m" ? 1 : ($userInfo['sex'] == "f" ? 2 : 0);
		$copartnerUserInfo->sex_u = 1;
		$copartnerUserInfo->phone = $userInfo['phone'];
		$copartnerUserInfo->phone_u = 1;
		$copartnerUserInfo->fax = $userInfo['fax'];
		$copartnerUserInfo->fax_u = 1;
		$copartnerUserInfo->city = $userInfo['city'];
		$copartnerUserInfo->city_u = 1;
		$copartnerUserInfo->address = $userInfo['address'];
		$copartnerUserInfo->address_u = 1;
		$copartnerUserInfo->updateTime = $userInfo['updatetime'];
		$copartnerUserInfo->updateTime_u = 1;
		$copartnerUserInfo->regTime = $userInfo['regtime'];
		$copartnerUserInfo->regTime_u = 1;
		$copartnerUserInfo->userType = $userInfo['type'];
		$copartnerUserInfo->userType_u = 1;
		$copartnerUserInfo->expPoint = $userInfo['exp_point'];
		$copartnerUserInfo->expPoint_u = 1;
// 		$copartnerUserInfo->dwIcsonMemberLevel = $userInfo['level'];
// 		$copartnerUserInfo->cIcsonMemberLevel_u = 1;
// 		$copartnerUserInfo->dwPromotionPoints = $userInfo['promotion_point'];
// 		$copartnerUserInfo->cPromotionPoints_u = 1;
// 		$copartnerUserInfo->dwCashPoints = $userInfo['cash_point'];
// 		$copartnerUserInfo->cCashPoints_u = 1;
		
		//用户属性需要进行转换
		if($userInfo['status_bits'] & 1)
		{
			$copartnerUserInfo->userProperty |= 8;
		}
		if($userInfo['status_bits'] & 2)
		{
			$copartnerUserInfo->userProperty |= 14;
		}
		if($userInfo['status_bits'] & 4)
		{
			$copartnerUserInfo->userProperty |= 13;
		}
		if($userInfo['status_bits'] & 8)
		{
			$copartnerUserInfo->userProperty |= 12;
		}
		else{
			$copartnerUserInfo->userProperty = $userInfo['status_bits'];
		}
		$copartnerUserInfo->userProperty_u = 1;
		$copartnerUserInfo->retailerLevel = $userInfo["retailerLevel"];
		$copartnerUserInfo->retailerLevel_u = 1;
		
		$reqSps->copartnerUserInfo = (array)$copartnerUserInfo;
		
		//Logger::info("reqSps".print_r($reqSps, true));
		$reqSps->inReserve = "";
// 		$ret = $g_cntl->invoke($reqSps, $respSps, USER_API_TIME_OUT);
		$ret = WebStubCntl2::request(
				'b2b2c\user\ao\ImportCopartnerUserInfo',
				array(
						'opt' => array(
								'uin' => $uid,
								'operator' => $uid,
								'caller' => 'User'
						),
						'req' => (array)$reqSps
				)
		);
		if($ret && $ret['code'] == 0 )
		{
			Logger::info("[IUser::ImportCopartnerUserInfo trace], success! uid == ".$uid);
			return true;
		}
		self::$errCode = $ret['code'];
		self::$errMsg = $ret['msg'];
		Logger::err("[IUser::ImportCopartnerUserInfo trace], Error in " . self::$errCode."===".self::$errMsg.";uid=".$uid);
		return false;
	}
	
	
	public static function IcsonUserLogin($uid, $accountType, $loginAccount="",$passwd="", $uin=0, $ptskey='')
	{
		global $_AccountType;
		Logger::info("[IUser::IcsonUserLogin trace], start! loginAccount=".$loginAccount.",uin=".$uin.",uid=".$uid);

		$sPassport = "";
		$iOperator = 0;
		if($accountType == $_AccountType['qq']){
			if(!empty($uin)){
// 				self::initCntl($uin,$ptskey);
				$iOperator = $uin;
				$sPassport = $ptskey;
			}else{
// 				self::initCntl($uid,$ptskey);
				$iOperator = $uid;
				$sPassport = $ptskey;
			}
		}else{
// 			self::initCntl($uid, '');
			$iOperator = $uid;
		}

//		$g_cntl = self::$gCntl;
// 		$reqSps = new IcsonUserLoginReq();
//		$respSps = new IcsonUserLoginResp();

		$reqSps->source = __FILE__;
		$reqSps->machineKey = ToolUtil::getClientIP();
		$reqSps->sceneId = 0;
		$reqSps->authCode = AUTHCODE;
		$reqSps->accountType = $accountType;//用户帐号类型，必需，0-无效值 1-QQ号(填1则QQNumber必填) 2-个性化帐号(填2则loginAccount必填)，参见user_comm_define.h中的E_ICSON_USER_ACCOUNT_TYPE

		if($accountType == $_AccountType['qq']){//用户QQ号，accountType填1时必填，目前仅支持32位
			$reqSps->loginAccount = $loginAccount;
			$reqSps->qQNumber = $uin;
			$reqSps->inReserve = $loginAccount;
		}else if($accountType == $_AccountType['custom']){//个性登录帐号（如易迅注册帐号、Login_ +Openid等），accountType填2时必填
			$reqSps->loginAccount = $loginAccount;
			$reqSps->passwd = $passwd;
		}else{
			self::$errCode = 129;
			self::$errMsg = "accountType is error, accountType:".$accountType.", loginAccount:".$loginAccount.", uin:".$uin;
			Logger::err("[IUser::IcsonUserLogin trace], Error in " . self::$errCode."===".self::$errMsg.";");
			return false;
		}
// 		var_dump($reqSps);echo "\n";
//		$ret = $g_cntl->invoke($reqSps, $respSps, USER_API_TIME_OUT);
		$ret = WebStubCntl2::request(
			'b2b2c\user\ao\IcsonUserLogin',
			array(
				'opt' => array(
					'uin' => $iOperator,
					'operator' => $iOperator,
					'passport' => $sPassport,
					'caller' => 'User',
					'itil' => '633971|633972|633973'
				),
				'req' => (array)$reqSps
			)
		);
// 		var_dump($ret);echo "\n";
		if($ret && $ret['code'] == 0){
			Logger::info("[IUser::IcsonUserLogin trace], success !");
			return (object)$ret['data'];
		}

		self::$errCode = $ret['code'];
		self::$errMsg = $ret['msg'];
		Logger::err("[IUser::IcsonUserLogin trace], Error in " . self::$errCode."===".self::$errMsg.";");
		return false;

	}
	
	//获取wg_skey
	public static function GetSkey($uid, $ptskey="")
	{
		Logger::info("[IUser::GetSkey trace], start! uid=".$uid.",ptskey=".$ptskey);
		//检查参数
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 122;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[uid($uid) is invalid]";
			return false;
		}

//		self::initCntl($uid,$ptskey);
// 		$g_cntl = self::$gCntl;
//		$reqSps = new GetSkeyReq();
//		$respSps = new GetSkeyResp();

		$reqSps->source = __FILE__;
		$reqSps->machineKey = ToolUtil::getClientIP();
		$reqSps->sceneId = 0;
		$reqSps->authCode = AUTHCODE;
		$reqSps->icsonUid = $uid;
	
//		$ret = $g_cntl->invoke($reqSps, $respSps, USER_API_TIME_OUT);
		$ret = WebStubCntl2::request(
			'b2b2c\user\ao\GetSkey',
			array(
				'opt' => array(
					'uin' => $uid,
					'operator' => $uid,
					'passport' => "",
					'caller' => 'User',
					'itil' => '633974|633975|633976'
				),
				'req' => (array)$reqSps
			)
		);
// 		var_dump($ret);echo "\n";
		if($ret && $ret['code'] == 0){
			Logger::info("[IUser::GetSkey trace], success ! uid=".$uid);
			return (object)$ret['data'];
		}

		self::$errCode = $ret['code'];
		self::$errMsg = $ret['msg'];
		Logger::err("[IUser::updateUserWg trace], Error in " . self::$errCode."===".self::$errMsg.";uid=".$uid);
		return false;

	}
	
	
	//校验登录

	public static function CheckLoginByIcsonUid($uid,$skey)
	{
		//Logger::info("[IUser::CheckLoginByIcsonUid trace], start! uid=".$uid.",skey=".$skey);
		//检查参数
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 125;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[uid($uid) is invalid]";
			return false;
		}
	
//		self::initCntl($uid,$skey);
// 		$g_cntl = self::$gCntl;
//		$reqSps = new CheckLoginByIcsonUidReq();
//		$respSps = new CheckLoginByIcsonUidResp();

		$reqSps->source = __FILE__;
		$reqSps->machineKey = ToolUtil::getClientIP();
		$reqSps->sceneId = 0;
// 		$reqSps->authCode = AUTHCODE;

//		$ret = $g_cntl->invoke($reqSps, $respSps, USER_API_TIME_OUT);
// 		var_dump($uid);echo "\n";
// 		$uid = intval($uid);
		$ret = WebStubCntl2::request(
			'b2b2c\user\ao\CheckLoginByIcsonUid',
			array(
				'opt' => array(
					'uin' => $uid,
					'operator' => $uid,
					'passport' => $skey,
					'caller' => 'User',
					'itil' => '633977|633978|633979'
				),
				'req' => (array)$reqSps
			)
		);
// 		var_dump($ret);echo "\n";
		if($ret && $ret['code'] == 0)
		{
			return true;
		}
		self::$errCode = $ret['code'];
		self::$errMsg = $ret['msg'];
		Logger::err("[IUser::CheckLoginByIcsonUid trace], Error in " . self::$errCode."===".self::$errMsg.";uid=".$uid);
		return false;
	}

	//退出登录

	public static function IcsonUserLogout($uid,$skey)
	{
		Logger::info("[IUser::IcsonUserLogout trace], start! uid=".$uid.",skey=".$skey);
		//检查参数
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 128;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[uid($uid) is invalid]";
			return false;
		}

//		self::initCntl($uid,$skey);
// 		$g_cntl = self::$gCntl;
//		$reqSps = new IcsonUserLogoutReq();
//		$respSps = new IcsonUserLogoutResp();

		$reqSps->source = __FILE__;
		$reqSps->machineKey = ToolUtil::getClientIP();
		$reqSps->sceneId = 0;
		$reqSps->authCode = AUTHCODE;

//		$ret = $g_cntl->invoke($reqSps, $respSps, USER_API_TIME_OUT);
		$ret = WebStubCntl2::request(
			'b2b2c\user\ao\IcsonUserLogout',
			array(
				'opt' => array(
					'uin' => $uid,
					'operator' => $uid,
					'caller' => 'User',
					'itil' => '633980|633981|633982'
				),
				'req' => (array)$reqSps
			)
		);
		if($ret && $ret['code'] == 0)
		{
			Logger::info("[IUser::IcsonUserLogout trace], success ! uid=".$uid);
			return true;
		}
		self::$errCode = $ret['code'];
		self::$errMsg = $ret['msg'];
		Logger::err("[IUser::IcsonUserLogout trace], Error in " . self::$errCode."===".self::$errMsg.";uid=".$uid);
		return false;
	}
	
	public static function GetUserInfoByIcsonUid($uid){
		//Logger::info("[IUser::GetUserInfoByIcsonUid trace], start! uid=".$uid);
		//检查参数
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 131;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[uid($uid) is invalid]";
			return false;
		}

//		self::initCntl($uid);
//		$g_cntl = self::$gCntl;
// 		$reqSps = new GetUserInfoByIcsonUidReq();
//		$respSps = new GetUserInfoByIcsonUidResp();

		$reqSps->source = __FILE__;
		$reqSps->machineKey = ToolUtil::getClientIP();
		$reqSps->sceneId = 0;
// 		$reqSps->authCode = AUTHCODE;
		$reqSps->icsonUid = $uid;

//		$ret = $g_cntl->invoke($reqSps, $respSps, USER_API_TIME_OUT);
		$ret = WebStubCntl2::request(
			'b2b2c\user\ao\GetUserInfoByIcsonUid',
			array(
				'opt' => array(
					'uin' => $uid,
					'operator' => $uid,
					'caller' => 'User',
					'itil' => '633986|633987|633988'
				),
				'req' => (array)$reqSps
			)
		);
// 		var_dump($ret);echo "\n";
		if($ret && $ret['code'] == 0){
			if($ret['data']['result'] == 0){
				Logger::info("[IUser::GetUserInfoByIcsonUid trace], success ! uid=".$uid);
				return self::changeFieldsToIcson($ret['data']['buyerInfoPo']);
			}
			self::$errCode = $ret['data']['result'];
			self::$errMsg = $ret['data']['errmsg'];
			Logger::err("[IUser::GetUserInfoByIcsonUid trace], Error in result:" . self::$errCode."===".self::$errMsg.";uid=".$uid);
			return false;
		}
		self::$errCode = $ret['code'];
		self::$errMsg = $ret['msg'];
		Logger::err("[IUser::GetUserInfoByIcsonUid trace], Error in net:" . self::$errCode."===".self::$errMsg.";uid=".$uid);
		return false;
	}
	
	public static function GetUserInfoByQQorAccount($accountType, $loginAccount="", $qq=0){
		//Logger::info("[IUser::GetUserInfoByQQorAccount trace], start! uid=".$loginAccount);
		global $_AccountType;
//		self::initCntl(rand(0,100000));
// 		$g_cntl = self::$gCntl;
//		$reqSps = new GetUserInfoByQQorAccountReq();
//		$respSps = new GetUserInfoByQQorAccountResp();

		$reqSps->source = __FILE__;
		$reqSps->machineKey = ToolUtil::getClientIP();
		$reqSps->sceneId = 0;
// 		$reqSps->authCode = AUTHCODE;
		if($accountType == $_AccountType['qq']){//用户QQ号，accountType填1时必填，目前仅支持32位
			$reqSps->loginAccount = $loginAccount;
			$reqSps->qQNumber = $qq;
			$reqSps->accountType = $_AccountType['qq'];
		}else if($accountType == $_AccountType['custom']){//个性登录帐号（如易迅注册帐号、Login_ +Openid等），accountType填2时必填
			$reqSps->loginAccount = mb_convert_encoding($loginAccount,"GBK","auto");
			$reqSps->accountType = $_AccountType['custom'];
		}else{
			self::$errCode = 129;
			self::$errMsg = "accountType is error, accountType:".$accountType.", loginAccount:".$loginAccount.", qq:".$qq;
			Logger::err("[IUser::GetUserInfoByQQorAccount trace], Error in " . self::$errCode."===".self::$errMsg.";");
			return false;
		}
//		var_dump($reqSps);

//		$ret = $g_cntl->invoke($reqSps, $respSps, USER_API_TIME_OUT);
		$uid = rand(0,100000);
		$ret = WebStubCntl2::request(
			'b2b2c\user\ao\GetUserInfoByQQorAccount',
			array(
				'opt' => array(
					'uin' => $uid,
					'operator' => $uid,
					'caller' => 'User',
					'itil' => '633989|633990|633991'
				),
				'req' => (array)$reqSps
			)
		);
		if($ret && $ret['code'] == 0){
			if($ret['data']['result'] == 0){
				Logger::info("[IUser::GetUserInfoByQQorAccount trace], success !");
				return self::changeFieldsToIcson($ret['data']['buyerInfoPo']);
			}
			self::$errCode = $ret['data']['result'];
			self::$errMsg = $ret['data']['errmsg'];
			Logger::err("[IUser::GetUserInfoByQQorAccount trace], Error in result:" . self::$errCode."===".self::$errMsg);
			return false;
		}else if($ret && $ret['code'] == 3508){
			Logger::info("[IUser::GetUserInfoByQQorAccount trace], success ! account=".$loginAccount);
			return array();
		}
		self::$errCode = $ret['code'];
		self::$errMsg = $ret['msg'];
		Logger::err("[IUser::GetUserInfoByQQorAccount trace], Error in net:" . self::$errCode."===".self::$errMsg);
		return false;
	}
	
	
	public static function GetUserInfoByBindInfo($bindType, $bindInfo){
		//Logger::info("[IUser::GetUserInfoByBindInfo trace], start!");
		//检查参数
//		self::initCntl(rand(0,100000));
//		$g_cntl = self::$gCntl;
// 		$reqSps = new GetUserInfoByBindInfoReq();
//		$respSps = new GetUserInfoByBindInfoResp();

		$reqSps->source = __FILE__;
		$reqSps->machineKey = ToolUtil::getClientIP();
		$reqSps->sceneId = 0;
// 		$reqSps->authCode = AUTHCODE;
		$reqSps->bindInfo = $bindInfo;
		$reqSps->bindInfoType = $bindType;

//		$ret = $g_cntl->invoke($reqSps, $respSps, USER_API_TIME_OUT);
		$uid = rand(0,100000);
		$ret = WebStubCntl2::request(
			'b2b2c\user\ao\GetUserInfoByBindInfo',
			array(
				'opt' => array(
					'uin' => $uid,
					'operator' => $uid,
					'caller' => 'User',
					'itil' => '633992|633993|633994'
				),
				'req' => (array)$reqSps
			)
		);
// 		var_dump($ret);echo "\n";
		if($ret && $ret['code'] == 0){
			if($ret['data']['result'] == 0){
				Logger::info("[IUser::GetUserInfoByBindInfo trace], success !");
				return  self::changeFieldsToIcson($ret['data']['buyerInfoPo']);
			}
			self::$errCode = $ret['data']['result'];
			self::$errMsg = $ret['data']['errmsg'];
			Logger::err("[IUser::GetUserInfoByBindInfo trace], Error in result:" . self::$errCode."===".self::$errMsg.";");
			return false;
		}else if($ret && $ret['code'] == 3508){
			Logger::info("[IUser::GetUserInfoByBindInfo trace], success ! uid=".$uid.", but not bind!");
			return array();
		}
		self::$errCode = $ret['code'];
		self::$errMsg = $ret['msg'];
		Logger::err("[IUser::GetUserInfoByBindInfo trace], Error in net:" . self::$errCode."===".self::$errMsg.";");
		return false;
	}
	
	
	public static function IsBindInfoBinded($uid, $bindType, $bindInfo){
		//Logger::info("[IUser::IsBindInfoBinded trace], start!");
		//检查参数
//		self::initCntl($uid);
//		$g_cntl = self::$gCntl;
// 		$reqSps = new IsBindInfoBindedReq();
//		$respSps = new IsBindInfoBindedResp();

		$reqSps->source = __FILE__;
		$reqSps->machineKey = ToolUtil::getClientIP();
		$reqSps->sceneId = 0;
// 		$reqSps->authCode = AUTHCODE;
		$reqSps->icsonUid = $uid;
		$reqSps->bindInfo = $bindInfo;
		$reqSps->bindInfoType = $bindType;
	
// 		var_dump($reqSps);echo "\n";

//		$ret = $g_cntl->invoke($reqSps, $respSps, USER_API_TIME_OUT);
		$ret = WebStubCntl2::request(
			'b2b2c\user\ao\IsBindInfoBinded',
			array(
				'opt' => array(
					'uin' => $uid,
					'operator' => $uid,
					'caller' => 'User'
				),
				'req' => (array)$reqSps
			)
		);
// 		var_dump($ret);echo "\n";
		if($ret && $ret['code'] == 0){
			if($ret['data']['result'] == 0){
				Logger::info("[IUser::IsBindInfoBinded trace], success !");
				return $ret['data']['retValue'];
			}
			self::$errCode = $ret['data']['result'];
			self::$errMsg = $ret['data']['errmsg'];
			Logger::err("[IUser::IsBindInfoBinded trace], Error in result:" . self::$errCode."===".self::$errMsg.";");
			return false;
		}
		self::$errCode = $ret['code'];
		self::$errMsg = $ret['msg'];
		Logger::err("[IUser::IsBindInfoBinded trace], Error in net:" . self::$errCode."===".self::$errMsg.";");
		return false;
	}
	
	public static function IsQQorAccountRegistered($accountType, $loginAccount="", $qq=0){
		//Logger::info("[IUser::IsQQorAccountRegistered trace], start!");
		//检查参数
		global $_AccountType;
//		self::initCntl(rand(0,100000));
// 		$g_cntl = self::$gCntl;
//		$reqSps = new IsQQorAccountRegisteredReq();
//		$respSps = new IsQQorAccountRegisteredResp();
		$uid = rand(0,100000);
		$reqSps->source = __FILE__;
		$reqSps->machineKey = ToolUtil::getClientIP();
		$reqSps->sceneId = 0;
		if($accountType == $_AccountType['qq']){//用户QQ号，accountType填1时必填，目前仅支持32位
			$reqSps->loginAccount = $loginAccount;
			$reqSps->qQNumber = $qq;
			$reqSps->accountType = $_AccountType['qq'];
			$uid = $qq;
		}else if($accountType == $_AccountType['custom']){//个性登录帐号（如易迅注册帐号、Login_ +Openid等），accountType填2时必填
			$reqSps->loginAccount = $loginAccount;
			$reqSps->accountType = $_AccountType['custom'];
		}else{
			self::$errCode = 129;
			self::$errMsg = "accountType is error, accountType:".$accountType.", loginAccount:".$loginAccount.", qq:".$qq;
			Logger::err("[IUser::IsQQorAccountRegistered trace], Error in " . self::$errCode."===".self::$errMsg.";");
			return false;
		}

// 		var_dump($reqSps);echo "\n";
//		$ret = $g_cntl->invoke($reqSps, $respSps, USER_API_TIME_OUT);
// 		var_dump($respSps);
		$ret = WebStubCntl2::request(
			'b2b2c\user\ao\IsQQorAccountRegistered',
			array(
				'opt' => array(
					'uin' => $uid,
					'operator' => $uid,
					'caller' => 'User'
				),
				'req' => (array)$reqSps
			)
		);
// 		var_dump($ret);echo "\n";
		if($ret && $ret['code'] == 0){
			if($ret['data']['result'] == 0){
				Logger::info("[IUser::IsQQorAccountRegistered trace], success !");
				return $ret['data']['retValue'];
			}
			self::$errCode = $ret['data']['result'];
			self::$errMsg = $ret['data']['errmsg'];
			Logger::err("[IUser::IsQQorAccountRegistered trace], Error in result:" . self::$errCode."===".self::$errMsg.";");
			return false;
		}
		self::$errCode = $ret['code'];
		self::$errMsg = $ret['msg'];
		Logger::err("[IUser::IsQQorAccountRegistered trace], Error in net:" . self::$errCode."===".self::$errMsg.";");
		return false;
	}
	
	private static function changeFieldsToIcson($wgUserInfo){
		$icsonUserInfo = array();
		if($wgUserInfo && $wgUserInfo['icsonUid']){
			$icsonUserInfo = array(
					array(
						'uid' => $wgUserInfo['icsonUid'],
						'icsonid' => $wgUserInfo['loginAccount'],
						'email' => $wgUserInfo['email'],
						'mobile' => $wgUserInfo['mobile'],
						'qq' => $wgUserInfo['qQNumber'],
						'name' => $wgUserInfo['truename'],
						'nick' => $wgUserInfo['nickname'],
						//'face' => $wgUserInfo->,
						'sex' => ($wgUserInfo['sex'] == 1 ? 'm' : ($wgUserInfo['sex'] == 2 ? 'f' : '')),
						//'year' => $wgUserInfo->,
						//'month' => $wgUserInfo->,
						//'day' => $wgUserInfo->,
						'identity' => $wgUserInfo['identityNum'],
						'level' => $wgUserInfo['icsonMemberLevel'],
						//'total_point' => $wgUserInfo->,
						//'valid_point' => $wgUserInfo->,
						//'idcard' => $wgUserInfo->,
						'status' => 0,
						'phone' => $wgUserInfo['phone'],
						'fax' => $wgUserInfo['fax'],
						//'city' => $wgUserInfo->,
						'address' => $wgUserInfo['address'],
						'zipcode' => $wgUserInfo['postcode'],
						'updatetime' => $wgUserInfo['lastUpdateTime'],
						//'regsrc' => $wgUserInfo->,
						//'reg_warehouse_id' => $wgUserInfo->,
						'regtime' => $wgUserInfo['regTime'],
						//'note' => $wgUserInfo->,
						//'is_manual_level' => $wgUserInfo->,
						'type' => $wgUserInfo['userType'],
						//'regIP' => $wgUserInfo->,
						'exp_point' => $wgUserInfo['experience'],
						//'recomend_score' => $wgUserInfo->,
						//'refer_uid' => $wgUserInfo->,
						//'vip_rank' => $wgUserInfo->,
						//'web_power_group' => $wgUserInfo->,
						'status_bits' => $wgUserInfo['bitProperty'],
						'retailerLevel' => $wgUserInfo['retailerLevel']
						//'cqq' => $wgUserInfo->,
						//'promotion_point' => $wgUserInfo->,
						//'cash_point' => $wgUserInfo->
					)
			);
		}
		return $icsonUserInfo;
	}
	
	public static function IcsonUniformLogin($accountType, $loginAccount, $ptskey="", $passwd="",$qq=0){
		Logger::info("[UserWg::IcsonUniformLogin trace], start!");
		//检查参数
		global $_AccountType;

//		self::initCntl(rand(0,100000));
// 		$g_cntl = self::$gCntl;
//		$reqSps = new IcsonUniformLoginReq();
//		$respSps = new IcsonUniformLoginResp();

		$reqSps->source = __FILE__;
		$reqSps->machineKey = ToolUtil::getClientIP();
		$reqSps->sceneId = 0;
		$reqSps->authCode = AUTHCODE;
		
//		$loginInfoPo = new LoginInfoPo();
		$uid = rand(0,100000);
		$loginInfoPo->accountType = $accountType;
		if($accountType == $_AccountType['qq']){
			$loginInfoPo->loginAccount = $loginAccount;
			$loginInfoPo->qQNumber = $qq;
			$loginInfoPo->qQSkey = $ptskey;
			if($qq != 0){
				$uid = $qq;
			}
		}else{
			$loginInfoPo->loginAccount = $loginAccount;
			$loginInfoPo->passwd = $passwd;
		}

		$reqSps->loginInfoPo = (array)$loginInfoPo;
		

// 		var_dump($reqSps);echo "\n";
//		$ret = $g_cntl->invoke($reqSps, $respSps, USER_API_TIME_OUT);
// 		var_dump($respSps);
		
		$ret = WebStubCntl2::request(
			'b2b2c\user\ao\IcsonUniformLogin',
			array(
				'opt' => array(
					'uin' => $uid,
					'operator' => $uid,
					'caller' => 'User',
					'itil' => '633983|633984|633985'
				),
				'req' => (array)$reqSps
			)
		);
// 		var_dump($ret);echo "\n";
		if($ret && $ret['code'] == 0){
			Logger::info("[UserWg::IcsonUniformLogin trace], success !");
			return (object)$ret['data'];
		}

		self::$errCode = $ret['code'];
		self::$errMsg = $ret['msg'];
		Logger::err("[UserWg::IcsonUniformLogin trace], Error in " . self::$errCode."===".self::$errMsg.";");
		return false;
	}
}

?>