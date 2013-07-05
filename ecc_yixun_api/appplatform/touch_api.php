<?php

require_once('platform/web_stub_cntl.php');
require_once('touchdao_stub4php.php');

// 邮件类型
define("MAIL_NORMAL", 0);
define("MAIL_MERGE", 1);


class TouchResult{
    var $resultCode;
    var $errMsg;
}

class TouchParam{
    var $businessType;      // 业务类型
    var $subBusiness;       // 子业务ID
    var $businessInfo;      // 业务信息，与当前触达内容相关，如订单号
    var $templateId;        // 模版ID
    var $contentArray;      // 邮件内容参数列表
    
    function __construct() {
        $this->businessType = 0;
        $this->subBusiness = 0;
        $this->businessInfo = '';
        $this->templateId = 0;
        $this->contentArray = array();
    }
}

// 邮件参数
class MailParam{
    var $touchParam;
    var $qq;                // QQ号（用于指定QQ号发送给QQ邮箱）
    var $mailAddr;          // 邮箱地址（用与指定邮箱地址发送邮件）
    var $type;              // 邮件类型（0：普通， 1：聚合（仅支持QQ邮箱））
    
    
    function __construct() {
        $this->touchParam = new TouchParam();
        $this->qq = 0;
        $this->mailAddr = '';
        $this->type = 0;
    }
}

// 短信参数
class SmsParam{
    var $touchParam;
    var $mobile;        // 手机
    var $type;          // 短信类型
    
    function __construct() {
        $this->touchParam = new TouchParam();
        $this->mobile = '';
        $this->type = 0;
    }
}

/*
参数：
    MailParam     
    
返回：
    TouchResult
*/
function SendMail(&$maiParam)
{
    $req = new InsertRealTimeReq();
    
    FillRealCommon($req, $maiParam->touchParam);
    
    $req->Record->dwChannel = 3;
    $req->Record->cChannel_u = 1;
    
    // 未指定QQ号，使用邮箱地址
    if($maiParam->qq == 0)
    {
        $req->Record->strTarget = $maiParam->mailAddr;
        $req->Record->cTarget_u = 1;
    }
    else
    {
        $req->Record->ddwUin = $maiParam->qq;
        $req->Record->cUin_u = 1;
    }    
    
    $req->Record->dwExt2 = $maiParam->type;
    $req->Record->cExt2_u = 1;
    
    return SendRealTime($req);
}


function FillRealCommon(&$realTimeReq, &$touchParam)
{
    $realTimeReq->Record->wVersion = 3;
    $realTimeReq->Record->cVersion_u = 1;
    
    $realTimeReq->Record->dwBusinessType = $touchParam->businessType;
    $realTimeReq->Record->cBusinessType_u = 1;
    
    $realTimeReq->Record->dwFlowId = $touchParam->subBusiness;
    $realTimeReq->Record->cFlowId_u = 1;
    
    $realTimeReq->Record->strBusinessId = $touchParam->businessInfo;
    $realTimeReq->Record->cBusinessId_u = 1;
    
    $realTimeReq->Record->dwTemplate = $touchParam->templateId;
    $realTimeReq->Record->cTemplate_u = 1;
    
    $realTimeReq->Record->vecContentVector->setValue($touchParam->contentArray);
    $realTimeReq->Record->cContentVector_u = 1;
    
    $realTimeReq->Record->dwCtime = time();
    $realTimeReq->Record->cCtime_u = 1;
}

function SendRealTime(&$realTimeReq)
{
    $resp = new InsertRealTimeResp();
    
    $cntl = new WebStubCntl();
	
	$cntl->setCallerName('touch_api');
	$cntl->setDwOperatorId(10000);
	$cntl->setDwUin($realTimeReq->Record->ddwUin + $realTimeReq->Record->dwCtime);
    
    $ret = $cntl->invoke($realTimeReq, $resp);
    
    $result = new TouchResult();
    
	if($ret == 0 && $resp->result == 0)
	{
        $result->resultCode = 0;
        $result->errMsg = '';
	}
    else
    {
        $result->resultCode = ($resp->result == 0 ? -1 : $resp->result);
        $result->errMsg = $resp->errmsg;
    }
    
    return $result;
}

?>
