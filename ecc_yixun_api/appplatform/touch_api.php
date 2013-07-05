<?php

require_once('platform/web_stub_cntl.php');
require_once('touchdao_stub4php.php');

// �ʼ�����
define("MAIL_NORMAL", 0);
define("MAIL_MERGE", 1);


class TouchResult{
    var $resultCode;
    var $errMsg;
}

class TouchParam{
    var $businessType;      // ҵ������
    var $subBusiness;       // ��ҵ��ID
    var $businessInfo;      // ҵ����Ϣ���뵱ǰ����������أ��綩����
    var $templateId;        // ģ��ID
    var $contentArray;      // �ʼ����ݲ����б�
    
    function __construct() {
        $this->businessType = 0;
        $this->subBusiness = 0;
        $this->businessInfo = '';
        $this->templateId = 0;
        $this->contentArray = array();
    }
}

// �ʼ�����
class MailParam{
    var $touchParam;
    var $qq;                // QQ�ţ�����ָ��QQ�ŷ��͸�QQ���䣩
    var $mailAddr;          // �����ַ������ָ�������ַ�����ʼ���
    var $type;              // �ʼ����ͣ�0����ͨ�� 1���ۺϣ���֧��QQ���䣩��
    
    
    function __construct() {
        $this->touchParam = new TouchParam();
        $this->qq = 0;
        $this->mailAddr = '';
        $this->type = 0;
    }
}

// ���Ų���
class SmsParam{
    var $touchParam;
    var $mobile;        // �ֻ�
    var $type;          // ��������
    
    function __construct() {
        $this->touchParam = new TouchParam();
        $this->mobile = '';
        $this->type = 0;
    }
}

/*
������
    MailParam     
    
���أ�
    TouchResult
*/
function SendMail(&$maiParam)
{
    $req = new InsertRealTimeReq();
    
    FillRealCommon($req, $maiParam->touchParam);
    
    $req->Record->dwChannel = 3;
    $req->Record->cChannel_u = 1;
    
    // δָ��QQ�ţ�ʹ�������ַ
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
