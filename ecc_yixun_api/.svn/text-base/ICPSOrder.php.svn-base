<?php
/**
 * CPS 2.0 Order Processor
 * 
 * @added by Wheelswang
 * @modified by EdisonTsai on 18:12 2012/12/28 for optimize
 */
class ICPSOrder {

	public static $errCode	= 0;
	public static $errMsg	= '';
	public static $cpsOrderNum = 0;

	/**
	 * 重组订单数据，让其符合CPS 2.0的格式要求
	 *
	 * @param	array	$submitOrder	原始订单数据
	 * @param	array	$userInfo		用户基础信息
	 * @param	array	$cpsCookie		CPS Cookies信息
	 * @return	array
	 */
	private static function genData($submitOrder, $userInfo, $cpsCookie) {

		$orders = array();
		$ip_addr = ToolUtil::getClientIP();
		$subOrderIds = self::_preprocessSubOrderIdStr($submitOrder['subOrderIdStr']);

		$subOrderCount = count($subOrderIds); //需要录入的子订单数
		if ($subOrderCount == 0) { //下单接口返回数据有误
			self::$errCode = 1002;
			self::$errMsg = 'suborders count 0, IFAILED.';
			return false;
		}
		
		//以下是调用Sequence服务，有不稳定的现象，要注意！
		//可能产生2个cps接入商订单
		$newBizNo = IIdGenerator::getNewId('eqifa_log_sequence', $subOrderCount*2); //全局ID 
		
		if (false === $newBizNo || $newBizNo <= 0) {
			self::$errCode = 1003;
			self::$errMsg = 'IIdGenerator error';
			return false;
		}

		foreach($submitOrder['order_items'] as &$order_item) {
			$productInfo = self::getProductInfo($order_item['product_id'], $order_item['wh_id']);
			if($productInfo === false) {
				continue;
			}
			$order_item['c3_ids'] = $productInfo['c3_ids'];
			$order_item['c1_ids'] = $productInfo['c1_ids'];
			$order_item['canVAT'] = $productInfo['canVAT'];
		}

		if(isset($_COOKIE['cps_tkd'])) {
			$submitOrder['cps_tkd'] = $_COOKIE['cps_tkd'];

			#@modified by EdisonTsai on 19:00 2012/12/28 for Optimize
			setcookie('cps_tkd', '', time()-3600, '/', '.51buy.com');//清除浏览器cookie(cps_tkd)
			unset($_COOKIE['cps_tkd']);
		}
		$submitOrder['cps_extra'] = array(
			'icsonid' => $userInfo['icsonid'],
			'ip_addr' => $ip_addr,
			'is_qqcb' => false,
		);
		if(isset($_COOKIE['cps_cookie_tick'])) {
			$submitOrder['cps_cookie_tick'] = $_COOKIE['cps_cookie_tick'];
		}
		$tick = false;//只传送一次tick
		if(42 == strlen($userInfo['icsonid']) && 0 === strpos($userInfo['icsonid'], QQ_ACCOUNT_PRE . '_')) { //qqcb
			$submitOrder['sysid'] = 'qqcb';
			$submitOrder['cps_extra']['is_qqcb'] = true;
			if($cpsCookie && $cpsCookie['sysid'] == 'qqcb') { // qqcb登陆
				$submitOrder['cps_extra']['cps_cookies'] = $cpsCookie['cps_cookies'];
				$submitOrder['cps_extra']['cps_order_type'] = 1;
				$submitOrder = self::_dispatchBizNo($submitOrder, $newBizNo);
				$orders[] = $submitOrder;
				$tick = true;
			}
			else {
				$submitOrder['cps_extra']['cps_order_type'] = 0;
				$submitOrder = self::_dispatchBizNo($submitOrder, $newBizNo);
				$orders[] = $submitOrder;
				$tick = true;
			}
		}

		if(($cpsCookie && $cpsCookie['sysid'] != 'qqcb') || (isset($submitOrder['cps_cookie_tick']) && !$tick)) {
			if($tick && isset($submitOrder['cps_cookie_tick'])) {
				unset($submitOrder['cps_cookie_tick']);
			}
			$submitOrder['cps_extra']['is_qqcb'] = false;
			if($cpsCookie) {
				$submitOrder['cps_extra']['cps_cookies'] = $cpsCookie['cps_cookies'];
				$submitOrder['sysid'] = $cpsCookie['sysid'];
			}
			else {
				$submitOrder['sysid'] = '';
			}
			$submitOrder = self::_dispatchBizNo($submitOrder, $newBizNo);
			$orders[] = $submitOrder;
		}

		$orders = IPSFPackageUtils::_gbkToUtf8($orders);
		return $orders;
	}

	/**
	 * 发送订单数据包至CPS 2.0 Receiver via Socket
	 *
	 * @param	array	$submitOrder	原始订单数据
	 * @return	mixed
	 */
	public static function sendCPSOrder($submitOrder) {

		$submitOrder['wh_id'] = IUser::getSiteId();
		$userInfo = IUser::getUserInfo($submitOrder['uid']);
		if($userInfo === false) {
			self::$errCode = 1100;
			self::$errMsg = IUser::$errCode . ' ' . IUser::$errMsg;
			return false;
		}
		if(isset($userInfo['qq']) && !empty($userInfo['qq'])){
			global $_IP_CFG;
			if(isset($_IP_CFG['QQ_OPENIDS']) && is_array($_IP_CFG['QQ_OPENIDS'])){
				$ip_key = array_rand($_IP_CFG['QQ_OPENIDS'],1);
				$ip = $_IP_CFG['QQ_OPENIDS'][$ip_key];
			}else if(isset($_IP_CFG['QQ_OPENIDS'])){
				$ip = $_IP_CFG['QQ_OPENIDS'];
			}

			$url = "http://".$ip.":8080/openid/decopenid.php?func=getopenidbyuin&uin=".$userInfo['qq'];
			$qqinfo = NetUtil::cURLHTTPGet($url);
			$ret = json_decode($qqinfo);
			$openID = strtoupper($ret->openid);
			$userInfo['icsonid'] = 'Login_QQ__'.$openID;
		}
		$cpsCookie = ICPSTools::getCpsCookies();

		/*
		 * @modified by EdisonTsai for remove SHCAR
		 */
		if(!$cpsCookie && !(42 == strlen($userInfo['icsonid']) && 0 === strpos($userInfo['icsonid'], QQ_ACCOUNT_PRE . '_')) && !isset($_COOKIE['cps_cookie_tick'])) {	
			return -1;
		}

		$submitOrders = self::genData($submitOrder, $userInfo, $cpsCookie);

		if($submitOrders === false) {
			return false;
		}
		
		self::$cpsOrderNum = count($submitOrders);

		foreach($submitOrders as $submitOrder) {

			$sendData = array();
			$sendData['sysid'] = $submitOrder['sysid'];

			unset($submitOrder['sysid']);

			$sendData['data'] = $submitOrder;
			$sysid = $sendData['sysid'];
		
			Logger::info(print_r($sendData, true)); //此部分日志记录后续需要去掉
			
			/*
			 * TODO: 以下验证是否进行同步模式即页面推单的情况需要后续优化
			 * 全量取消页面推单
			 */
				
			$sendData['cmd'] = 'SAVE_ORDER';
			$sendLen = ISocketClient::sendData('PSFOrderReceiver', $sendData, 1, true);

			if($sendLen === false) {
				self::$errCode = 1101;
				self::$errMsg = ISocketClient::$errMsg;
				return false;
			}
			
			$recvData = ISocketClient::recvData();
			
			if($recvData === false) {
				self::$errCode = 1102;
				self::$errMsg = ISocketClient::$errMsg;
				return false;
			}
			
		}

		return $recvData;
	}

	/**
	 * 订单号取模，让其保持10位长度
	 * 
	 * @param	string	$str
	 * @return	string
	 */
	private static function _preprocessSubOrderIdStr($str) {

		$mod = 1000000000;

		$str = trim($str);
		$ret = explode(',', $str);

		foreach($ret as $k=>$v) {
			if (empty($v)) {
				unset($ret[$k]);
			}
			else {
				$ret[$k] = ($ret[$k] % $mod) + $mod;
			}
		}

		return $ret;
	}
	
	/**
	 * 为订单数据分配bizno
	 *
	 * @param	array	
	 * @param	int
	 * @return	array 
	 */
	private static function _dispatchBizNo($submitOrder, $newBizNo) {
		static $i = 0;
		foreach($submitOrder['subOrders'] as $stockId => &$subOrder) {
			$subOrder['bizno'] = $newBizNo + $i;
			$i++;
		}
		return $submitOrder;
	}

	/**
	 * 获取商品信息
	 * @param string $productId 易迅的商品信息
	 * @return array 商品信息
	 */
	private static function getProductInfo($product_id, $wh_id) {
		$product_base_info = IProduct::getBaseInfo($product_id, $wh_id);
		if($product_base_info === false) {
			self::$errCode = 2001;
			self::$errMsg = 'get product baseinfo error';
			return false;
		}
		$c2_ret = ICategoryTTC::get($product_base_info['c3_ids'], array('level'=>3));
		if($c2_ret === false) {
			self::$errCode = 2002;
			self::$errMsg = ICategoryTTC::$errCode . '|' . ICategoryTTC::$errMsg;
			return false;
		}
		if(empty($c2_ret)) {
			self::$errCode = 2003;
			self::$errMsg  = 'ICategoryTTC empty,c3_ids:' . $product_base_info['c3_ids'] . ' level:3';
			return false;
		}
		$c1_ret = ICategoryTTC::get($c2_ret[0]['parent_id'], array('level'=>2));
		if($c1_ret === false) {
			self::$errCode = 2004;
			self::$errMsg = ICategoryTTC::$errCode . '|' . ICategoryTTC::$errMsg;	
			return false;
		}
		if(empty($c1_ret)) {
			self::$errCode = 2005;
			self::$errMsg = 'ICategoryTTC empty,c2_ids:' . $c2_ret[0]['parent_id'] . ' level:2';
			return false;
		}
		return array('c1_ids' => $c1_ret[0]['parent_id'], 'c2_ids' => $c2_ret[0]['parent_id'], 'c3_ids' => $product_base_info['c3_ids'], 'canVAT' => $product_base_info['canVAT']);
	}
} //End of script
?>