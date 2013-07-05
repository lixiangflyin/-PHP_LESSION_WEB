<?php
//个性化推荐

class IPersonal {
	
	public static $bizId = 2003;

	public static $darkNightType = 1001;

	public static $darkNightPoolIds = array(1, 2, 3);

	public static $darkNightSort = array(13 => 5, 10013 => 20, 20012 => 5, 30012 => 5, 40012 => 5, 50012 => 5);

	public static $morningPoolIds = array(4);

	public static $tejiaPoolIds = array(5);

	private static $params;

	public static $status;//1为超时，2为失败

	private static $scenceID;

	private static $uin;

	private static $uid;

	private static $siteId;

	public static $clickParams;

	public static $itemNums;

	public static $policyId;

	//获取个性化数据
	//@params uid,场景id即商品池id,站点id,获取商品数量
	public static function getData($uid, $scenceID, $siteId, $itemNums) {
		self::$scenceID = $scenceID;
		self::$itemNums = $itemNums;

		$getDataIpInfo = self::getIpInfo('PERSONAL_GETDATA');
		$getDataIp = $getDataIpInfo['IP'];
		$getDataPort = $getDataIpInfo['PORT'];

		$uin = self::getUin();
		
		self::$uin = $uin;
		self::$uid = $uid;
		self::$siteId = $siteId;
		
		$clientIp = ToolUtil::getClientIP();
		$cmd = "stype=1&srvip={$getDataIp}&ushi=" . self::$bizId . "&usmid=" . self::$darkNightType . "&port={$getDataPort}&uicmd=450&uin={$uin}&version=1&bodynum=1&clientip={$clientIp}&itemnum={$itemNums}&sceneid={$scenceID}&icsonid={$uid}&siteid={$siteId}\r\n";

		$ipInfo = self::getIpInfo('PERSONAL_SERVER');
		$ip = $ipInfo['IP'];
		$port = $ipInfo['PORT'];

		if (self::$darkNightType == 1003) {
			$res = NetUtil::tcpCmd($ip, $port, $cmd, 1, 1);
		} else {
			$res = NetUtil::tcpLongCmd($ip, $port, $cmd, 1, 0, 100000);
		}
		
		if (empty($res)) {
			self::$status = 1;
			return false;
		}

		$rsArray = explode("\n\n\n", $res);

		$itemsArray = explode(";",$rsArray[1]);
		self::$params = $rsArray[1];

		

		$ias = explode("\t", $itemsArray[1]);

        foreach($ias as $ia) {
	        $ia = str_replace(" ", "", $ia);
	        $rs = preg_match_all('/j=([0-9]*?),ullItemID=([0-9]*?),uiSellUin=([0-9]*?)/', $ia, $matches);
	        if (empty($matches[2][0])) continue;
	        $items[] = $matches[2][0];
	        if ($matches[1][0] >= ($itemNums - 1)) break;
        }

        if (empty($items)) {
			self::$status = 2;
		}

		self::$itemNums = count($items);
		self::setClickParam();
        return $items;
	}

	//得到用户uin
	private static function getUin() {
		if (isset($_COOKIE['uin_cookie']) && !empty($_COOKIE['uin_cookie'])) {
			$uin = $_COOKIE['uin_cookie'];
		} else if (isset($_COOKIE['uin']) && !empty($_COOKIE['uin'])) {
			$uin = $_COOKIE['uin'];
		} else if (isset($_COOKIE['o_cookie']) && !empty($_COOKIE['o_cookie'])) {
			$uin = $_COOKIE['o_cookie'];
		} else if (isset($_COOKIE['luin']) && !empty($_COOKIE['luin'])) {
			$uin = $_COOKIE['luin'];
		} else if (isset($_COOKIE['buy_uin']) && !empty($_COOKIE['buy_uin'])) {
			$uin = $_COOKIE['buy_uin'];
		} else if (!empty($_GET['uin'])) {
			$uin = $_GET['uin'];
		} else {
			$uin = 0;
		}
		return $uin;
	}

	//pv上报
	//@params 上报的商品ids(array)
	public static function pvUp($items, $curUrl, $uid, $scenceID, $siteId, $status, $pvParams, $pilicyId = 4) {
		if ($status == 1) {
			$pvParams = "MsgID:3|SceneID:" . self::$scenceID . "|PolicyID:" . $pilicyId;
		} else if ($status == 2) {
			$pvParams = "MsgID:2|SceneID:" .  self::$scenceID . "|PolicyID:" . $pilicyId;
		} else {
			$paramsArray = explode(":", $pvParams);
			$pvParams = "MsgID:" . $paramsArray[0] . "|SceneID:" . $paramsArray[1] . "|PolicyID:" . $pilicyId . "|ItemID:" . $items;
		}
	
		$pvIpInfo = self::getIpInfo('PERSONAL_PV');
		$pvIp = $pvIpInfo['IP'];
		$pvPort = $pvIpInfo['PORT'];

		$ipInfo = self::getIpInfo('PERSONAL_SERVER');
		$ip = $ipInfo['IP'];
		$port = $ipInfo['PORT'];

		$clientIp = ToolUtil::getClientIP();

		$referUrl = urlencode('http://www.51buy.com');
		$toUrl = urlencode($curUrl);
		$curUrl = urlencode($curUrl);
		$skey = 0;
		if (isset($_COOKIE['skey'])) {
			$skey = $_COOKIE['skey'];
		}
		$clickParams = '0';
		
		$uin = self::getUin();
		$cmd = "stype=2&srvip={$pvIp}&port={$pvPort}&uin=" . $uin . "&clientip={$clientIp}&sceneid=" . $scenceID . "&icsonuid=" . $uid . "&siteid=" . $siteId . "&ullvisistkey=" . $skey . "&cururl={$curUrl}&referurl={$referUrl}&strtourl={$toUrl}&pvparam={$pvParams}&clickparam={$clickParams}\r\n";
 		NetUtil::tcpCmd($ip, $port, $cmd, 1, 1);
	}

	//点击上报
	//@params uid, 站点id，状态(1表示拉取超时，2表示拉取失败),场景id, click所需参数，目标url，目标商品id
	public static function clickUp($uid, $siteId, $status, $scenceID, $cParams, $params, $curUrl, $referUrl, $toUrl, $itemID) {
		if ($status == 1) {
			$clickParams = "MsgID:3|SceneID:" . $clicks[1];
			$params = 3;
		} else if ($status == 2) {
			$clickParams = "MsgID:2|SceneID:" . $clicks[1];
			$params = 2;
		} else {
			$clicks = explode(":", $params);
			$clickParams = "MsgID:" . $clicks[0] . "|SceneID:" . $clicks[1];
			$clickParamsArray = explode("strKey=CLICK_TOURL_PARAM,strKey=", $clickParams);
			$clickParams = str_replace(array("\r\n", "\r", "\n"), "", $clickParamsArray[1]);
		}

		$pvIpInfo = self::getIpInfo('PERSONAL_CLICK');
		$pvIp = $pvIpInfo['IP'];
		$pvPort = $pvIpInfo['PORT'];

		$ipInfo = self::getIpInfo('PERSONAL_SERVER');
		$ip = $ipInfo['IP'];
		$port = $ipInfo['PORT'];

		$clientIp = ToolUtil::getClientIP();

		$userInfo = IUser::getUserInfo($uid);
		$icsonid = $userInfo['icsonid'];

		$uin = self::getUin();

		if (strpos($toUrl, "?")) {
			$toUrl .= "&DAP={$cParams}:{$itemID}";
		} else {
			$toUrl .= "?DAP={$cParams}:{$itemID}";
		}

		$curUrl = urlencode($curUrl);
		if (empty($referUrl)) {
			$referUrl = 'http://www.51buy.com';
		}
		$referUrl = urlencode($referUrl);
		$toUrl = urlencode($toUrl);
		
		$pvParams = '0';
		$skey = 0;
		if (isset($_COOKIE['skey'])) {
			$skey = $_COOKIE['skey'];
		}

		$cmd = "stype=3&srvip={$pvIp}&port={$pvPort}&uin={$uin}&clientip={$clientIp}&sceneid={$scenceID}&icsonuid={$uid}&siteid={$siteId}&ullvisistkey=" . $skey . "&cururl={$curUrl}&referurl={$referUrl}&strtourl={$toUrl}&pvparam={$pvParams}&clickparam={$params}\r\n";
    	NetUtil::tcpCmd($ip, $port, $cmd, 1, 1);
	}

	//设置点击参数
	private static function setClickParam() {
		$paramsArray = explode("\t", self::$params);
    	self::$clickParams = str_replace(" ", "", $paramsArray[count($paramsArray) - 2]);
    	self::$clickParams = str_replace("k=1,strKey=CLICK_TOURL_PARAM,strKey=", "", self::$clickParams);	
    	$cp = explode(":", self::$clickParams);
    	self::$scenceID = $cp[1];

    	$pvPrams = explode("|", $paramsArray[count($paramsArray) - 3]);
    	self::$policyId = str_replace("PolicyID:", "", $pvPrams[2]);
	}

	//获取ip信息
	private static function getIpInfo($keys) {
		global $_IP_CFG;
		if (is_array($_IP_CFG[$keys])) {
			$ip_key = array_rand($_IP_CFG[$keys], 1);
			$ipInfo = $_IP_CFG[$keys][$ip_key];
		} else {
			$ipInfo = $_IP_CFG[$keys];
		}
		return $ipInfo;
	}
}