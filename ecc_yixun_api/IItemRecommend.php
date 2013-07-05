<?php
//����ҳ��Ʒ�Ƽ��ӿ�

class IItemRecommend {

	public static $bizId = 2003;

	public static $usm_id = 1005;

	public static $scenceID_base = 563798694793576448;

	private static $params;

	public static $status;//1Ϊ��ʱ��2Ϊʧ��

	private static $scenceID;

	private static $uin;

	private static $uid;

	private static $siteId;

	public static $clickParams;

	public static $itemNums;

	public static $policyId;
	
	private static $businessType = array(
								0 => array(
											'name' 				=> '����ҳ���Ի��Ƽ�',
											'usmid' 			=> 1005,
											'scence_id' 		=> 563798694793576448,
											'bi_server'			=> 'ITEMRECOMMEND_GETDATA', //bi������
											'transfer_server'	=> 'ITEMRECOMMEND_SERVER', //��ת������
											'pv_server'			=> 'ITEMRECOMMEND_PV', //pv�ϱ�������
										),
								1 => array(
											'name' 		=> '���ﳵ���Ի��Ƽ�',
											'usmid' 	=> 1006,
											'scence_id' => 563798699088543745,
											'bi_server'			=> 'CART_GETDATA', //bi������
											'transfer_server'	=> 'CART_SERVER', //��ת������
											'pv_server'			=> 'CART_PV', //pv�ϱ�������
										)
							);

	/**
	 * ��ȡ���Ի�����
	 * @param int $uid
	 * @param int $siteId
	 * @param int $itemNums
	 * @param array/int $product_ids
	 * @param array/int $c3_ids
	 * @param int $type     0=>����ҳ��1=>���ﳵҳ
	 */
	public static function getData($uid, $siteId, $itemNums, $product_ids, $c3_ids, $type=0) {
		self::$scenceID_base = self::$businessType[$type]['scence_id'];
		$scenceID = self::$scenceID_base + $siteId;
		self::$scenceID = $scenceID;
		self::$itemNums = $itemNums;
		self::$usm_id = self::$businessType[$type]['usmid'];

		// BI������
		$getDataIpInfo = self::getIpInfo(self::$businessType[$type]['bi_server']);
		$getDataIp = $getDataIpInfo['IP'];
		$getDataPort = $getDataIpInfo['PORT'];

		$itemList = array();
		if(is_array($product_ids)){
			foreach ($product_ids as $key=>$product_id){
				$itemList[] = $product_id . '-' . $siteId . '-' . $c3_ids[intval($key)];
			}
			$strItemList = implode('|', $itemList);
		} else {
			$strItemList = $product_ids . '-' . $siteId . '-' . $c3_ids;
		}
		
		$uin = self::getUin();
		self::$uin = $uin;
		self::$uid = $uid;
		self::$siteId = $siteId;

		$clientIp = ToolUtil::getClientIP();
		$cmd = "stype=1&srvip={$getDataIp}&ushi=" . self::$bizId . "&usmid=" . self::$usm_id . "&port={$getDataPort}&uicmd=450&uin={$uin}&version=1&bodynum=1&clientip={$clientIp}&itemnum={$itemNums}&sceneid={$scenceID}&icsonid={$uid}&siteid={$siteId}&itemlist={$strItemList}\r\n";
		
		// AO��ת������
		$ipInfo = self::getIpInfo(self::$businessType[$type]['transfer_server']);
		$ip = $ipInfo['IP'];
		$port = $ipInfo['PORT'];
		Logger::info( 'ip : ' . var_export($ip, true) . " port : " . var_export($port, true) . " cmd : " . var_export($cmd, true) . "\r\n" );
		$res = NetUtil::tcpCmd($ip, $port, $cmd, 1, 1);
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
			foreach ($matches[2] as $i => $itemID){
		        if (empty($itemID)) continue;
		        $items[] = $itemID;
		        if ($matches[1][$i] >= ($itemNums - 1)) break;
			}
        }
        if (empty($items)) {
			self::$status = 2;
		}
		self::$itemNums = count($items);
		self::setClickParam();
//		Logger::info(var_export($ias, true) . '\n' . var_export($items, true) . ' count:'  . count($items));
        return $items;
	}

	//�õ��û�uin
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
		} else {
			$uin = 0;
		}
		return $uin;
	}

	//pv�ϱ�
	//@params �ϱ�����Ʒids(array)
	public static function pvUp($items, $curUrl, $uid, $siteId, $status, $pvParams, $policyId = 4, $type=0) {
		$scenceID = self::$scenceID;
		if ($status == 1) {
			$pvParams = "MsgID:3|SceneID:" . self::$scenceID . "|PolicyID:" . $policyId;
		} else if ($status == 2) {
			$pvParams = "MsgID:2|SceneID:" .  self::$scenceID . "|PolicyID:" . $policyId;
		} else {
			$paramsArray = explode(":", $pvParams);
			$pvParams = "MsgID:" . $paramsArray[0] . "|SceneID:" . $paramsArray[1] . "|PolicyID:" . $policyId . "|ItemID:" . $items;
		}
		$pvIpInfo = self::getIpInfo(self::$businessType[$type]['pv_server']);
		$pvIp = $pvIpInfo['IP'];
		$pvPort = $pvIpInfo['PORT'];

		$ipInfo = self::getIpInfo(self::$businessType[$type]['transfer_server']);
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
		Logger::info( 'ip : ' . var_export($ip, true) . " port : " . var_export($port, true) . " cmd : " . var_export($cmd, true) . "\r\n" );
 		NetUtil::tcpCmd($ip, $port, $cmd, 1, 1);
	}

	//����ϱ�
	//@params uid, վ��id��״̬(1��ʾ��ȡ��ʱ��2��ʾ��ȡʧ��),����id, click���������Ŀ��url��Ŀ����Ʒid
	/*
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
	*/

	//���õ������
	private static function setClickParam() {
		$paramsArray = explode("\t", self::$params);
    	$clickParams_tmp = str_replace(" ", "", $paramsArray[count($paramsArray) - 2]);
    	self::$clickParams = str_replace("k=1,strKey=CLICK_TOURL_PARAM,strKey=", "", $clickParams_tmp);
    	$cp = explode(":", self::$clickParams);
    	self::$scenceID = $cp[1];
    	$pvPrams = explode("|", $paramsArray[count($paramsArray) - 3]);
    	self::$policyId = str_replace("PolicyID:", "", $pvPrams[2]);
	}

	//��ȡip��Ϣ
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