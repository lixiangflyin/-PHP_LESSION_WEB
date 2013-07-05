<?php
require_once('platform/web_stub_cntl.php');
require_once('platform/lang_util.php');
require_once('pointsaccountao_stub4php.php');
if (!defined("PHPLIB_ROOT")) {
	define('PHPLIB_ROOT', '/data/release/PHPLIB/');
}
require_once(PHPLIB_ROOT . "lib/Config.php");
require_once(PHPLIB_ROOT . 'lib/ToolUtil.php');
if (!defined("AUTHCODE")) {
	define('AUTHCODE', "zxcvbnm");
}
if (!defined("USER_POINT_API_TIME_OUT")) {
	define('USER_POINT_API_TIME_OUT', 2);
}

class UserPointWg{
	public static $errMsg = "";
	public static $errCode = 0;
   //调用网购侧接口
	public static $gCntl = false;
	
	public static function initCntl($uid=277631272, $skey="0123456789")
	{
		$g_cntl = new WebStubCntl();
		$sPassport = $skey;

		$g_cntl->setDwOperatorId($uid);
		$g_cntl->setSPassport($sPassport);
		$g_cntl->setDwSerialNo(10002);
		$g_cntl->setDwUin($uid);
		$g_cntl->setWVersion(2);
		$g_cntl->setCallerName("USER");
		self::$gCntl = $g_cntl;
		return;
	}
	
	public static function GetPointsAccount($uid){
		Logger::info("[UserPointWg::GetPointsAccount trace], start!");

		self::initCntl($uid);
		$g_cntl = self::$gCntl;
		
		$reqSps = new GetPointsAccountReq();
		$respSps = new GetPointsAccountResp();
		$reqSps->source = __FILE__;
		$reqSps->machineKey = ToolUtil::getClientIP();
		$reqSps->sceneId = 0;
		$reqSps->icsonUid = $uid;
// 		$reqSps->authCode = AUTHCODE;
// 		var_dump($reqSps);
		$ret = $g_cntl->invoke($reqSps, $respSps, USER_POINT_API_TIME_OUT);
// 		var_dump($respSps);
		if($ret != 0)
		{
			self::$errCode = 129;
			self::$errMsg = $respSps->errmsg;
			Logger::err("[UserPointWg::GetPointsAccount trace], Error in " . $ret."===".self::$errMsg.";");
			return false;
		}else if(isset($respSps->result) && $respSps->result == 0){
			Logger::info("[IUser::GetPointsAccount trace], success !");
			return $respSps->pointsAccountPo;
		}
		self::$errCode = 130;
		self::$errMsg = $respSps->errmsg;
		Logger::err("[UserPointWg::GetPointsAccount trace], Error in " . $ret."===".self::$errMsg.";");
		return false;
	}
	
	
}

?>
