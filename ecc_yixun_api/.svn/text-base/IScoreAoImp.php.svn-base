<?php
define ('PHPLIB_ROOT','/data/dev/PHPLIB/');

require_once(PHPLIB_ROOT . 'api/appplatform/platform/web_stub_cntl.php');
require_once(PHPLIB_ROOT . 'api/appplatform/platform/lang_util.php');
require_once(PHPLIB_ROOT . 'api/appplatform/icsonscoreao_stub4php.php');
define('BUSICODE', 10001);
define('BUSIVERIFYCODE', '07937f5b640eadf6fb29f5aa9ebe6c63');

define('REVIEW_API_TIME_OUT', 2);

class IScoreAoImp
{
    public static $errMsg = "";
    public static $errCode = 0;
    //调用网购侧接口
    public static $gCntl = false;
    
    public static function _initCntl($uid)
    {
        $g_cntl = new WebStubCntl();
        $sPassport = "0123456789";
        $g_cntl->setDwOperatorId($uid);
        $g_cntl->setSPassport($sPassport);
        $g_cntl->setDwSerialNo(10002);
        $g_cntl->setDwUin($uid);
        $g_cntl->setWVersion(2);
		$g_cntl->setCallerName("SCORE");
        self::$gCntl = $g_cntl;

        return;
    }

	
	public static function addScore($uid,$type,$pid,$reviewid,$price)
	{
		Logger::debug("call".__FUNCTION__."\n".print_r(func_get_args(),true));
		
		//检查参数
		if (!isset($pid) || $pid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[pid($pid) is invalid]";
			return false;
		}
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[uid($uid) is invalid]";
			return false;
		}
		if (!isset($reviewid) || $reviewid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[reviewid($reviewid) is invalid]";
			return false;
		}

		self::_initCntl($uid);
		$g_cntl = self::$gCntl;
		
		$reqSps = new ScoreAddReq();
		$respSps = new ScoreAddResp();
		$reqSps->source = __FILE__;
		$reqSps->machineKey = ToolUtil::getClientIP();
		
		//FIXME these need to be fixed by real data
		$reqSps->busiCode = BUSICODE ;
		$reqSps->busiVerifyCode = BUSIVERIFYCODE;
		$reqSps->operationName = "Review";
		$reqSps->busiUniqId  = $reviewid;
	
		$addPo = new  AddScorePo();
		$addPo->dwVersion = 0;
		$addPo->cVersion_u = 1;
		$addPo->ddwUid = $uid;
		$addPo->cUid_u = 1;
		$addPo->dwType = $type;
		$addPo->cType_u = 1;	
		$addPo->dwFactor = $price;
		$addPo->cFactor_u = 1;	
		$addPo->dwRuleId = 1;
		$addPo->cRuleId_u = 1;
		$addPo->strProductId = $product_id;
		$addPo->cProductId_u = 1;
		
		$reqSps->AddScorePo = $addPo;
		
		$ret = $g_cntl->invoke($reqSps, $respSps, REVIEW_API_TIME_OUT);
		if($ret != 0)
		{
			self::$errCode = 500;
			self::$errMsg = $respSps->errmsg;
			return false;
		}else if(isset($respSps->result) && $respSps->result == 0){
			return true;
		}
		self::$errCode = 500;
		self::$errMsg = $respSps->errmsg;
		return false;
	}
}
?>
