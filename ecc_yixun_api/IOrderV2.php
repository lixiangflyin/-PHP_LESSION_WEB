<?php
require_once(PHPLIB_ROOT . 'lib/DataReport.php');


class IOrderV2 {
	public static $errCode = 0;
	public static $errMsg = '';

	//圆通快递
	public static $ytoRequestTpl = '<BatchQueryRequest><logisticProviderID>YTO</logisticProviderID><clientID>ICSON</clientID><orders><order><mailNo>{sysno_holder}</mailNo></order></orders></BatchQueryRequest>';
	public static $ytoPartnerId = 'icson';
	public static $ytoRequestHost = 'jingang.yto56.com.cn';
	public static $ytoRequestUrl = 'http://116.228.70.199/ordws/VipOrderServlet';

	//易迅及相关第三方快递的订单，在processID=99的时候，才能被评论 @TAPD 5438774
	public static $evaluateViaShipType = array(ICSON_DELIVERY, ICSON_DELIVERY_QF, 30612,30761,30762,30752,30753,30804,30790,30812,30821,31478,31485,31484,50077,50078,50079,50080,50081,50082,50083,50084,50085,50086,);

	// cookie 中的 visitkey
	protected static $visitkey;

	//抢购商品显示验证码？
	const DISPLAY_VERIFY_CODE = false;


	public static function newOrderId()
	{
		//获取一个新id
		$newId = IIdGenerator::getNewId('so_sequence');
		if (false === $newId || $newId <= 0) {
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return false;
		}

		return $newId;
	}


	public static function placeOrder($newOrder, $wh_id = 1)
{
    $ret = IOrder51buyV2::placeOrder($newOrder, $wh_id);
    if(false === $ret)
    {
        self::$errCode = IOrder51buyV2::$errCode;
        self::$errMsg = IOrder51buyV2::$errMsg;
    }
    return $ret;
}

    public static function placeOrderV2($newOrder, $wh_id = 1)
    {
        $ret = IOrder51buyV2::placeAnOrder($newOrder, $wh_id);
        if(false === $ret)
        {
            self::$errCode = IOrder51buyV2::$errCode;
            self::$errMsg = IOrder51buyV2::$errMsg;
        }
        return $ret;
    }

	public static function order($newOrder, $wh_id = 1)
	{
		self::$visitkey = isset($_COOKIE['visitkey']) ? $_COOKIE['visitkey'] : "";
		$newOrder['visitkey'] = self::$visitkey;

		//EL_Flow::getInstance('order')->append("Post newOrder:" . ToolUtil::gbJsonEncode($newOrder),true);
		// 记录post过来的信息
		self::Log("Post newOrder:" . ToolUtil::gbJsonEncode($newOrder));

		// 检查所有必须的字段
		if (true !== self::checkByField($newOrder)) {
			return false;
		}

		self::Log("checkByField finish");
		//参数收货地址
		if (false === self::checkReceiverAddr($newOrder)) {
			return false;
		}

		self::Log("checkReceiverAddr finish");
		//检查运送方式
		if (false === self::checkShippingType($newOrder, $wh_id)) {
			return false;
		}

		self::Log("checkShippingType finish");
		//检查支付方式
		if (false === self::checkPayType($newOrder, $wh_id)) {
			return false;
		}

		self::Log("checkPayType finish");
		//检查发票
		if (false === self::checkInvoice($newOrder, $wh_id)) {
			return array('errCode'=> -21, 'errMsg'=> '您提交发票类型不合法');
		}

		self::Log("checkInvoice finish");
		return self::placeOrder($newOrder, $wh_id);
	}

    public static function orderV2($newOrder, $wh_id = 1)
    {
        self::$visitkey = isset($_COOKIE['visitkey']) ? $_COOKIE['visitkey'] : "";
        $newOrder['visitkey'] = self::$visitkey;

        //EL_Flow::getInstance('order')->append("Post newOrder:" . ToolUtil::gbJsonEncode($newOrder),true);
        // 记录post过来的信息
        self::Log("Post newOrder:" . ToolUtil::gbJsonEncode($newOrder));

        // 检查所有必须的字段
        if (true !== self::checkByField($newOrder)) {
            return false;
        }

        self::Log("checkByField finish");
        //参数收货地址
        if (false === self::checkReceiverAddr($newOrder)) {
            return false;
        }

        self::Log("checkReceiverAddr finish");
        //检查运送方式
        if (false === self::checkShippingType($newOrder, $wh_id)) {
            return false;
        }

        self::Log("checkShippingType finish");
        //检查支付方式
        if (false === self::checkPayType($newOrder, $wh_id)) {
            return false;
        }

        self::Log("checkPayType finish");
        //检查发票
        if (false === self::checkInvoice($newOrder, $wh_id)) {
            return array('errCode'=> -21, 'errMsg'=> '您提交发票类型不合法');
        }

        self::Log("checkInvoice finish");
        return self::placeOrderV2($newOrder, $wh_id);
    }

    public static function orderProcess($newOrder, $wh_id = 1)
    {
        self::$visitkey = isset($_COOKIE['visitkey']) ? $_COOKIE['visitkey'] : "";
        $newOrder['visitkey'] = self::$visitkey;

        //EL_Flow::getInstance('order')->append("Post newOrder:" . ToolUtil::gbJsonEncode($newOrder),true);
        // 记录post过来的信息
        self::Log("Post newOrder:" . ToolUtil::gbJsonEncode($newOrder));

        // 检查所有必须的字段
        if (true !== self::checkByField($newOrder)) {
            return false;
        }

        self::Log("checkByField finish");
        //参数收货地址
        if (false === self::checkReceiverAddr($newOrder)) {
            return false;
        }

        self::Log("checkReceiverAddr finish");
        if (!isset($newOrder['expectDate'])) {
            $newOrder['expectDate'] = 0;
        }
        if (!isset($newOrder['expectSpan'])) {
            $newOrder['expectSpan'] = 0;
        }
        if (!isset($newOrder['arrived_limit_time'])) {
            $newOrder['arrived_limit_time'] = '';
        }

        self::Log("checkShippingType finish");
        //检查支付方式
        if (false === self::checkPayType($newOrder, $wh_id)) {
            return false;
        }

        self::Log("checkPayType finish");
        //检查发票
        if (false === self::checkInvoice($newOrder, $wh_id)) {
            return array('errCode'=> -21, 'errMsg'=> '您提交发票类型不合法');
        }

        self::Log("checkInvoice finish");
        $ret = IOrderProcess::placeOrder($newOrder, $wh_id);
        if(false === $ret)
        {
            self::$errCode = IOrderProcess::$errCode;
            self::$errMsg = IOrderProcess::$errMsg;
        }
        return $ret;
        //return self::placeOrder($newOrder, $wh_id);
    }

	/**
	 * @static 检查所有必须的字段
	 * @param $newOrder
	 * @return array|bool
	 */
	public static function checkByField($newOrder)
	{
		if (!is_array($newOrder) || empty($newOrder)) {
			self::$errCode = -2000;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newOrder is empty";
			return false;
		}

		if (!isset($newOrder['uid']) || $newOrder['uid'] <= 0) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newOrder[uid] is empty";
			return false;
		}

		if (isset($newOrder['comment']) && strlen($newOrder['comment']) > 800) {
			return array('errCode'=> 10, 'errMsg'=> "您填写的订单备注过长，请返回修改！");
		}

		if (!isset($newOrder['suborders']) || !is_array($newOrder['suborders'])) {
			return array('errCode'=> 10, 'errMsg'=> "您的购物车中没有商品，请选购！");
		}

		//先判断优惠券与促销规则不能同时使用
		if (isset($newOrder['rule_id']) && isset($newOrder['couponCode']) && $newOrder['rule_id'] > 0 && $newOrder['couponCode'] != '') {
			return array('errCode'=> 15, 'errMsg'=> "促销规则与优惠券不能同时使用");
		}
		if (isset($newOrder['rule_id']) && ($newOrder['rule_id'] <= 0)) {
			return array('errCode'=> 16, 'errMsg'=> "您提交的促销规则信息不正确，请返回购物车重新选择");
		}

		return true;
	}

	public static function checkUserInfo(&$newOrder, &$userInfo)
	{
		//如果使用优惠券，判断用户是否为经销商，若是，则不允许使用优惠券
		//$userInfo = IUsersTTC::get($newOrder['uid'], array(), array('email', 'mobile', 'level', 'valid_point', 'type'));
        $userInfo = IUser::getUserInfo($newOrder['uid']);
        if (false === $userInfo)
        {
			self::$errCode = IUser::$errCode;
			self::$errMsg = IUser::$errMsg;
			return false;
		}

		//$userInfo = $userInfo[0];
		global $_USER_TYPE;
		if ($userInfo['type'] == $_USER_TYPE['Dealer'] && isset($newOrder['couponCode']) && $newOrder['couponCode'] != '') {
			return array('errCode'=> 15, 'errMsg'=> "您属于炒货商用户，不能使用优惠券。");
		}
		return true;
	}

	/*
		  * 下单频率限制
		  * @param $productInfos 商品信息
		  * @param $order 订单信息
		  * @return false 访问频率超过限制
		  */
	public static function checkVisitFrequency($productInfos, $order)
	{
		$bNeedCheck = false;
		foreach ($productInfos as $p_info) {
			if (($p_info['flag'] & OTHER_TIME_LIMITED_RUSHING_BUY) == OTHER_TIME_LIMITED_RUSHING_BUY) { //发现抢购商品，限制下单频率
				$bNeedCheck = true;
				break;
			}
		}

		if ($bNeedCheck) {
			$ret = IFreqLimit::checkAndAdd($order['uid'], 5);
			if ($ret > 0) { //下单频率过快
				self::$errCode = -6001;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[freqlimit] visit frequency too high';
				return false;
			}
		}
		return true;
	}

	public static function checkReceiverAddr(&$newOrder)
	{
		//开始检查收获地址

		if (!isset($newOrder['receiver']) || strlen($newOrder['receiver']) == 0 || strlen($newOrder['receiver']) > 20) {
			self::$errCode = -2001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newOrder[receiver] is empty";
			return false;
		}

		global $_District;
		if (!isset($newOrder['receiveAddrId']) || !isset($_District[$newOrder['receiveAddrId']])) {
			self::$errCode = -2002;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newOrder[receiveAddrId] is invalid";
			return false;
		}

		if (!isset($newOrder['receiveAddrDetail']) || strlen($newOrder['receiveAddrDetail']) == 0) {
			self::$errCode = -2003;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newOrder[receiveAddrDetail] is empty";
			return false;
		}

		if ((!isset($newOrder['receiverTel']) || strlen($newOrder['receiverTel']) == 0)
            && (!isset($newOrder['receiverMobile']) || strlen($newOrder['receiverMobile']) == 0)) {
			self::$errCode = -2004;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newOrder[receiverTel and receiverMobile] is empty";
			return false;
		}
		if (!isset($newOrder['zipCode'])) {
			$newOrder['zipCode'] = '';
		}
		return true;
	}

	public static function checkInvoice(&$newOrder,$wh_id)
	{
		$newOrder['isVat'] = isset($newOrder['isVat']) ? $newOrder['isVat'] : 1;
		if (0 == $newOrder['isVat']) //如果不需要开发票，则不用验证发票
		{
			return true;
		}

		if (!isset($newOrder['invoiceType']) ||
			($newOrder['invoiceType'] != INVOICE_TYPE_RETAIL_COMPANY &&
				$newOrder['invoiceType'] != INVOICE_TYPE_RETAIL_PERSONAL &&
				$newOrder['invoiceType'] != INVOICE_TYPE_VAT &&
				$newOrder['invoiceType'] != INVOICE_TYPE_TITLE &&
                $newOrder['invoiceType'] != INVOICE_TYPE_VAT_NORMAL )) {
			self::$errCode = -2009;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceType is invalid";
			return false;
		}

		if (!isset($newOrder['invoiceTitle']) || $newOrder['invoiceTitle'] == '' || strlen($newOrder['invoiceTitle']) > MAX_TITLE_LEN) {
			self::$errCode = -2010;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoice invoiceTitle is invalid";
			return false;
		}

		if (!isset($newOrder['invoiceId']) || $newOrder['invoiceId'] <= 0) {
			self::$errCode = -2017;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " invoiceId is invalid";
			return false;
		}

		//商业零售发票
		if ($newOrder['invoiceType'] == INVOICE_TYPE_VAT) {
			if (!isset($newOrder['invoiceCompanyName']) || $newOrder['invoiceCompanyName'] == '' || strlen($newOrder['invoiceCompanyName']) > MAX_COMPANY_LEN) {
				self::$errCode = -2011;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceCompanyName is invalid";
				return false;
			}
			if (!isset($newOrder['invoiceCompanyAddr']) || $newOrder['invoiceCompanyAddr'] == '' || strlen($newOrder['invoiceCompanyAddr']) > MAX_ADDR_LEN) {
				self::$errCode = -2012;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceCompanyAddr is invalid";
				return false;
			}
			if (!isset($newOrder['invoiceCompanyTel']) || $newOrder['invoiceCompanyTel'] == '' || strlen($newOrder['invoiceCompanyTel']) > MAX_PHONE_LEN) {
				self::$errCode = -2013;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceCompanyTel is invalid";
				return false;
			}
			if (!isset($newOrder['invoiceTaxno']) || $newOrder['invoiceTaxno'] == '' || strlen($newOrder['invoiceTaxno']) > MAX_TAXNO_LEN) {
				self::$errCode = -2014;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceTaxno is invalid";
				return false;
			}
			if (!isset($newOrder['invoiceBankNo']) || $newOrder['invoiceBankNo'] == '' || strlen($newOrder['invoiceBankNo']) > MAX_BANK_NO_LEN) {
				self::$errCode = -2015;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceBankNo is invalid";
				return false;
			}
			if (!isset($newOrder['invoiceBankName']) || $newOrder['invoiceBankName'] == '' || strlen($newOrder['invoiceBankName']) > MAX_BANK_NAME_LEN) {
				self::$errCode = -2016;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceBankName is invalid";
				return false;
			}
			if (!isset($newOrder['invoiceContent'])) {
				$newOrder['invoiceNote'] = '';
			}
		}

		//对于非分销订单,需要校验传入的发票id是否属于该用户
        if( !isset($newOrder['shopGuideId'] ))
        {
			$invoice = IUserInvoiceBookTTC::get($newOrder['uid'], array('iid'=> $newOrder['invoiceId']));
			if (false === $invoice) {
				self::$errCode = IUserInvoiceBookTTC::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[get IUserInvoiceBookTTC failed]' . IUserInvoiceBookTTC::$errMsg;
				return false;
			}
			if (1 != count($invoice)) {
				self::$errCode = -2018;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoice id is not exist or not belong to this uid";
				return false;
			}
		}


		// 检查用户提交的发票是否是该站点可以提交的发票
		$whInvoice = EA_Invoice::getInvoicesWhType($wh_id);
		if( !in_array($newOrder['invoiceType'], $whInvoice) )
		{
			self::$errCode = -21;
			self::$errMsg = "用户提交的发票不可以在该站点使用";
			return false;
		}
		return true;
	}

	public static function checkPayType(&$newOrder, $wh_id = 1)
	{
		global $_PAY_MODE;
		global $_LGT_PAY;

		if (!isset($newOrder['payType']) || !isset($_PAY_MODE[$wh_id][$newOrder['payType']])) {
			self::$errCode = -2007;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newOrder[payType] is invalid";
			return false;
		}

		if ($_PAY_MODE[$wh_id][$newOrder['payType']]['IsOnlineShow'] == 0) {
			self::$errCode = -2007;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newOrder[payType] is invalid";
			return false;
		}

        foreach ($_LGT_PAY[$wh_id] as $lgt)
        {
			if ($lgt['ShipTypeSysNo'] == $newOrder['shipType'] && $lgt['PayTypeSysNo'] == $newOrder['payType']) {
				self::$errCode = -2008;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "paytype is not support by shiptype";
				return false;
			}
		}
		return true;
	}

	// 多分仓 版检查运送方式
	public static function checkShippingType(&$newOrder, $wh_id = 1)
	{
		global $_LGT_MODE, $_DCToRegion, $_District;
		if (!isset($newOrder['shipType']) || !isset($_LGT_MODE[$newOrder['shipType']])) {
			self::$errCode = -2005;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newOrder[{$newOrder['shipType']}] is invalid";
			return false;
		}

		//运送方式不可用
		if ($_LGT_MODE[$newOrder['shipType']]['IsOnlineShow'] == 0) {
			self::$errCode = -2006;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newOrder[shipType] is avaible";
			return false;
		}


		//判断该物流方式能否到达该目的地，商品禁运放在检查商品的时候进行
		$destination = $newOrder['receiveAddrId'];
		$des_dc = IProductInventory::getDCFromDistrict($destination, $wh_id); //根据用户的三级地址和站id获得对应DC
		if(empty($des_dc))
		{
			//如果找不到DC，需要记录
			self::$errCode = -2007;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[get dcsysno error]';
			return false;
		}
		$source_region = $_DCToRegion[$des_dc];
		$shippingTypeAva = IShippingRegionTTC::gets(
			array($destination,
				$_District[$destination]['city_id'],
				$_District[$destination]['province_id']),
			array(
				'wh_id'  => $source_region,
				'status' => 0,
                'size_type'=> 1)
		);

		if (false === $shippingTypeAva) {

			self::$errCode = IShippingRegionTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[get IShippingRegionTTC failed]' . IShippingRegionTTC::$errMsg;

			return false;
		}

		// 初始值表示不可达
		$is_Reach = false;
        foreach ($shippingTypeAva as $sp)
        {
			if ($sp['shipping_id'] == $newOrder['shipType']) {
				// 找到这种运送方式则为可达
				$is_Reach = true;
			}
		}

        if ( false === $is_Reach )
        {
			// 找不到这种运送方式，则为不可达
			self::$errCode = -2006;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " {$newOrder['shipType']} can not shipping to $destination";
			Logger::err(var_export($shippingTypeAva, true));
			return false;
		}

		if (!isset($newOrder['expectDate'])) {
			$newOrder['expectDate'] = 0;
		}
		if (!isset($newOrder['expectSpan'])) {
			$newOrder['expectSpan'] = 0;
		}
		if (!isset($newOrder['arrived_limit_time'])) {
			$newOrder['arrived_limit_time'] = '';
		}
		return true;
	}

    public static function _Utf2Gbk($data){

		if (!is_array($data)) {
			return mb_convert_encoding($data, 'GBK', 'UTF-8');
		}

		$res = array();

		foreach ($data as $key => $_val) {
			$key = mb_convert_encoding($key, 'GBK', 'UTF-8');

			$res[$key] = self::_Utf2Gbk($_val);
		}

		return $res;
	}


    public static function _objectToArray($d) {

		if (is_object($d)) {
			$d = get_object_vars($d);
		}

		if (is_array($d)) {
			return array_map("IOrder::_objectToArray", $d);
        }
        else {
			return $d;
		}
	}



	public static function checkLimitOrder($uid, $limitedProduct, $items)
	{
		// 如果限单的商品为空，则不检查
		if (empty($limitedProduct))
			return true;

		global $_OrderState;
		$timestamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
		$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');

		$sql = "SELECT product_id, sum(buy_num) as buy_num
						FROM t_order_items_{$db_tab_index['table']} ot, t_orders_{$db_tab_index['table']} o
						WHERE o.order_char_id = ot.order_char_id
							AND o.status <> {$_OrderState['ManagerCancel']['value']}
							AND o.status <> {$_OrderState['CustomerCancel']['value']}
							AND o.status <> {$_OrderState['EmployeeCancel']['value']}
							AND ot.uid = {$uid}
							AND create_time > {$timestamp}
							AND product_id in(" . implode(',', $limitedProduct) . ")
				GROUP BY product_id";

		$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
		$userOrder = $orderDb->getRows($sql);
		if (false === $userOrder) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[query order db failed]' . $orderDb->errMsg;
			return false;
		}

		if (!empty($userOrder)) {
			self::$errMsg = "您购买的";
			foreach ($userOrder as $order) {
				foreach ($items as $item) {
					if ($item['product_id'] == $order['product_id']) {
						if ($item['buy_count'] + $order['buy_num'] > $item['num_limit']) {
							self::$errCode = 999;
							self::$errMsg .= $item['name'] . "限购{$item['num_limit']}件，您今日已购{$order['buy_num']}件;";
                        }
						break;
					}
				}
			}
            self::$errMsg .= "请返回购物车修改购买数量";
		}


		//检查限购完毕
		if (self::$errCode === 999) {
			return false;
		}

		return true;
	}


	/**
	 * @param $str 下单记录日志
	 * @param string $folder 记录到的文件夹，默认为order，在机器上的路径为 /data/logs/order/，里面的文件按日期命名，没有后缀
	 * @param bool $backtrace 是否需要跟踪路径，默认true
	 */
	public static function Log($str, $backtrace = true, $folder = "order")
	{
		$vk = self::$visitkey;
		EL_Flow::getInstance("{$folder}")->append("vk:{$vk}," . $str, $backtrace);
	}
}

