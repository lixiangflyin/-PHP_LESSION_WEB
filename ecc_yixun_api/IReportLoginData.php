<?php
class IReportLoginData
{
	public static $errCode = 0;
	public static $errMsg = '';
	
	const VISITKEY_COOKIE = 'y_guid';

    /*
    typedef struct
    {
        uint32_t    uiLoginType;
        uint32_t    uiLoginID;
        char         szClientIP[MAX_TMP_BUF_LEN];
        uint64_t    ullVisityKey;
        uint32_t    uiLoginTime;
        uint32_t    uiLoginSuc;
        char         szFailedReason[MAX_TMP_BUF_LEN];
        uint32_t    uiVerson;
    }STLoginData;
    */
    // logintype=1|loginid=313476708|loginname=username|loginip=127.0.0.1|visitkey=622773ABB|logintime=1355241600|loginsuc=1|freason='wrong password'|version=1.0
    function report(
                        $logintype = 3,
                        $loginid = 0,
                        $loginname= '',
                        $loginsuc = 1,
                        $freason = '',
                        $loginip = '',
                        $visitkey = '',
                        $logintime = 0,
                        $version = '',
                        $isResponse=false)
    {
    	if (empty($loginname)) {
            self::$errCode = 18;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[loginname empty]";
    		return false;
    	}

    	if (empty($loginip)) {
    		$loginip = ToolUtil::getClientIP();
    	}

    	if (empty($visitkey)) {
    		if(isset($_COOKIE[self::VISITKEY_COOKIE])){
    			$visitkey = $_COOKIE[self::VISITKEY_COOKIE];
    		}else{
    			$visitkey = '8888888888888888';
    		}
    	}

    	if (empty($logintime)) {
    		$logintime = time();
    	}

        if (empty($version)) {
            $version = '1.0';
        }

        // È¥³ýfreasonÀïµÄ |
        $freason = strtr($freason, "|", " ");
        $loginData = "logintype=$logintype|loginid=$loginid|loginname=$loginname|loginip=$loginip|visitkey=$visitkey|logintime=$logintime|loginsuc=$loginsuc|freason=$freason|version=$version";
        //Logger::info($loginData);
        $len = strlen($loginData);
        $loginBuff = (pack("CNa" . $len . "C", 2, $len, $loginData, 3));

        $ip = Config::getIP('logindata');
        if (empty($ip))
        {
            $ip = '10.149.20.209:39001';
        }
        $addr = explode(":", $ip);

        $rspStr = NetUtil::udpCmd($addr[0], $addr[1], $loginBuff, $isResponse, 1);
        if (empty($rspStr)) {
            self::$errCode = 19;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[send package to logindata svr timeout]";
            return  false;
        }

        if ($isResponse) {
	        $retArray = unpack("CcStx/NuiMsgLen/a1000szBuf/CcEtx", $rspStr);
	        return $retArray;
        }else{
        	return true;
        }
    }

}

