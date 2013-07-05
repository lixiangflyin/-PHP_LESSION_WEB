<?php
require_once(PHPLIB_ROOT . 'lib/DataReport.php');


class IOrder {
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
	
	//一个月内订单可评论限制改为三个月 mackwang 2013.03.28  3*31*24*3600 = 8035200
	const EVALUATE_LIMIT_SECOND = 8035200;
	/**
	 * 设置错误码和错误信息
	 * @param int $code
	 * @param string $msg
	 * @return null
	 */
	private static function setErr($code, $msg = '')
	{
		self::$errCode = $code;
		self::$errMsg = $msg;
	}

	public static function getSubOrders($uid, $p_order_id)
	{
		if (!isset($p_order_id) || $p_order_id == "") {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_id[$p_order_id] is empty";
			return false;
		}

		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -2020;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";
			return false;
		}
		$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
		$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
		if (empty($orderDb)) {
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;
			return false;
		}
		$sql = "SELECT shipping_type,
							out_time,
							expect_dly_date,
							expect_dly_time_span,
							order_char_id,
							hw_id,
							flag,
							status,
							order_date,
							installment_num,
							cash_per_month,
							pay_type,
							receiver,
							receiver_mobile,
							shipping_cost,
							order_cost,
							coupon_code,
							coupon_amt,
							point,
							point_pay,
							cash + prcd_cost as cash,
							cpsinfo,
							isPayed,
							subOrderNum,
							single_promotion_info,
							pOrderId,
							bits
				from t_orders_{$db_tab_index['table']} where pOrderId='$p_order_id' and order_char_id <> '$p_order_id' and subOrderNum = 0";
		$subOrders = $orderDb->getRows($sql);
		if (false === $subOrders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

        foreach($subOrders as $key => $order)
        {
            if(!empty($order['single_promotion_info']))
            {
				$subOrders[$key]['single_promotion_info'] = explode(';', $order['single_promotion_info']);
			}
		}

		return $subOrders;
	}

	/*
			 @name	getOrderInvoice
			 @desc	获得订单发票
			 @para	uid，用户id
			 @para	order_id，订单id
		 */
	public static function getOrderInvoice($uid, $order_id)
	{
		if (!isset($order_id) || $order_id == "") {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_id[$order_id] is empty";
			return false;
		}

		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -2020;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";
			return false;
		}

		$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
		$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
		if (empty($orderDb)) {
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;
			return false;
		}

		//拉取发票信息
		$sql = "select title, type, name, addr, phone, taxno, bankno, bankname, content from t_order_invoice_{$db_tab_index['table']} where order_char_id='$order_id' and uid=$uid";
		$order_invoice = $orderDb->getRows($sql);
		if (false === $order_invoice) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

		if (count($order_invoice) < 1) {

			$order_invoice = IOrderInvoiceTTC::get($uid, array('order_char_id'=> $order_id), array('title', 'type', 'name', 'addr', 'phone', 'taxno', 'bankno', 'bankname', 'content'));
			if (false === $order_invoice) {
				self::$errCode = IOrderInvoiceTTC::$errCode;
				self::$errMsg = IOrderInvoiceTTC::$errMsg;
				return false;
			}
			if (count($order_invoice) < 1) {
				self::$errCode = -2021;
				self::$errMsg = '该订单发票信息不存在';
				return false;
			}
		}

        foreach ($order_invoice as &$oi)
        {
			$oi['type_id'] = $oi['type'];
			if ($oi['type'] == INVOICE_TYPE_RETAIL_COMPANY) {
				$oi['type'] = "商业零售发票(单位)";
			} else if ($oi['type'] == INVOICE_TYPE_VAT) {
				$oi['type'] = "增值税专业发票";
            }else if ($oi['type'] == INVOICE_TYPE_VAT_NORMAL)
            {
				$oi['type'] = "增值税普通发票";
            }else
            {
				$oi['type'] = "商业零售发票(个人)";
			}
		}

		return $order_invoice;
	}

	/*
			 @name	modifyOrderVAT
			 @desc	修改订单发票
			 @para	uid，用户id
			 @para	order_id， 子订单id
			 @para	newVAT，新的发票信息
		 */
	public static function modifyOrderVAT($uid, $order_id, $newVAT)
	{
		if (!isset($order_id) || $order_id == "") {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_id[$order_id] is empty";
			return false;
		}

		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -2020;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";
			return false;
		}
		if (!isset($newVAT['invoiceTitle']) || $newVAT['invoiceTitle'] == '' || strlen($newVAT['invoiceTitle']) > MAX_TITLE_LEN) {
			self::$errCode = -2010;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoice invoiceTitle is invalid";
			return false;
		}
		$newVAT['invoiceType'] = INVOICE_TYPE_VAT;

		if (!isset($newVAT['invoiceCompanyName']) || $newVAT['invoiceCompanyName'] == '' || strlen($newVAT['invoiceCompanyName']) > MAX_COMPANY_LEN) {
			self::$errCode = -2011;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceCompanyName is invalid";
			return false;
		}
		if (!isset($newVAT['invoiceCompanyAddr']) || $newVAT['invoiceCompanyAddr'] == '' || strlen($newVAT['invoiceCompanyAddr']) > MAX_ADDR_LEN) {
			self::$errCode = -2012;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceCompanyAddr is invalid";
			return false;
		}
		if (!isset($newVAT['invoiceCompanyTel']) || $newVAT['invoiceCompanyTel'] == '' || strlen($newVAT['invoiceCompanyTel']) > MAX_PHONE_LEN) {
			self::$errCode = -2013;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceCompanyTel is invalid";
			return false;
		}
		if (!isset($newVAT['invoiceTaxno']) || $newVAT['invoiceTaxno'] == '' || strlen($newVAT['invoiceTaxno']) > MAX_TAXNO_LEN) {
			self::$errCode = -2014;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceTaxno is invalid";
			return false;
		}
		if (!isset($newVAT['invoiceBankNo']) || $newVAT['invoiceBankNo'] == '' || strlen($newVAT['invoiceBankNo']) > MAX_BANK_NO_LEN) {
			self::$errCode = -2015;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceBankNo is invalid";
			return false;
		}
		if (!isset($newVAT['invoiceBankName']) || $newVAT['invoiceBankName'] == '' || strlen($newVAT['invoiceBankName']) > MAX_BANK_NAME_LEN) {
			self::$errCode = -2016;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceBankName is invalid";
			return false;
		}

		$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
		$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
		if (empty($orderDb)) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

		$sql = "select t1.type, t2.status as status from t_order_invoice_{$db_tab_index['table']} t1, t_orders_{$db_tab_index['table']} t2 where t1.order_char_id = t2.order_char_id and t2.order_char_id ='$order_id' and t2.uid=$uid";
		$result = $orderDb->getRows($sql);
		if (false === $result) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

		if (count($result) == 0) {
			self::$errCode = -2017;
			self::$errMsg = "订单不存在";
			return false;
		}
		$result = $result[0];

		global $_OrderState;
		if ($result['status'] != $_OrderState['Origin']['value']) {
			self::$errCode = -2018;
			self::$errMsg = "订单已经审核通过，不能修改发票资料";
			return false;
		}

		if ($result['type'] != INVOICE_TYPE_VAT) {
			self::$errCode = -2019;
			self::$errMsg = "订单发票不是增值税发票，不能修改发票资料";
			return false;
		}

		$newInv = array(
			'title'     => $newVAT['invoiceTitle'],
			'name'      => $newVAT['invoiceCompanyName'],
			'addr'      => $newVAT['invoiceCompanyAddr'],
			'phone'     => $newVAT['invoiceCompanyTel'],
			'taxno'     => $newVAT['invoiceTaxno'],
			'bankno'    => $newVAT['invoiceBankNo'],
			'bankname'  => $newVAT['invoiceBankName'],
			//'content'=> $newVAT['invoiceContent'],
			'updatetime'=> time(),
		);

		$ret = $orderDb->update("t_order_invoice_{$db_tab_index['table']}", $newInv, "order_char_id='$order_id' and uid=$uid");
		if (false === $ret) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}
		return true;
	}

	/*
			 @name	checkOrderItemCanBeEvaluated
			 @desc	检查订单中的商品是否可以评论
			 @para	uid，用户id
			 @para	order_id，子订单id
			 @para	product_id，商品id
			 @return true/false
		 */
	public static function checkOrderItemCanBeEvaluated($uid, $order_id, $product_id)
	{
		if (!isset($order_id) || $order_id == "") {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_id[$order_id] is empty";
			return false;
		}

		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -2020;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";
			return false;
		}

		if (!isset($product_id) || $product_id <= 0) {
			self::$errCode = -2021;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id[$product_id] is empty";
			return false;
		}

		$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
		$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
		if (empty($orderDb)) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

		global $_OrderState;
		$sql = "select uorder.out_time as out_time, uorder.order_date as order_date,uorder.status as status,
				uorder.shipping_type as shipping_type, uorder.hw_id as hw_id, uorder.order_id as order_id, item.flag as flag from
				t_order_items_{$db_tab_index['table']} item,
				t_orders_{$db_tab_index['table']} uorder
				where item.uid=$uid and item.order_char_id='$order_id' and item.order_char_id = uorder.order_char_id and
				item.product_id = $product_id";
		$orders = $orderDb->getRows($sql);
		if (false === $orders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

		if (count($orders) == 0) { // 去历史订单库取
			$orders = IOrdersTTC::get($uid, array('order_char_id'=> $order_id), array('out_time', 'shipping_type', 'order_id', 'order_date', 'status', 'hw_id'));
			if (false === $orders) {
				self::$errCode = IOrdersTTC::$errCode;
				self::$errMsg = IOrdersTTC::$errMsg;
				return false;
			} else if (count($orders) < 1) {
				self::$errCode = "用户订单不存在";
				self::$errMsg = -2056;
				return false;
			}

			$order = $orders[0];
			$order_items = IOrderItemsTTC::get($uid, array('order_char_id'=> $order_id, 'product_id'=> $product_id), array('flag'));
			if (false === $order_items) {
				self::$errCode = IOrderItemsTTC::$errCode;
				self::$errMsg = IOrderItemsTTC::$errMsg;
				return false;
			} else if (count($order_items) < 1) {
				self::$errCode = -2023;
				self::$errMsg = "用户没有订单购买该商品";
				return false;
			}
			$order['flag'] = $order_items[0]['flag'];
        }else
        {
			$order = &$orders[0];
		}

        if ($order['flag'] & ORDER_ITEM_EVALUATED == ORDER_ITEM_EVALUATED)
        {
			self::$errCode = -2025;
			self::$errMsg = "您已经评价过该商品";
			return false;
		}

		if ($order['status'] != $_OrderState['OutStock']['value'] && $order['status'] != $_OrderState['PartlyReturn']['value']) {
			if( $order['status'] == $_OrderState['Return']['value'] ||
				$order['status'] == $_OrderState['ManagerCancel']['value'] || 
				$order['status'] == $_OrderState['CustomerCancel']['value'] || 
				$order['status'] == $_OrderState['EmployeeCancel']['value'] 
			){
				self::$errCode = -2024;
				self::$errMsg = "您尚未购买该商品，无法发表体验评论，欢迎您发表商品讨论或购买后评价。";
			} else {
				self::$errCode	= -2028;
				self::$errMsg	= '您的订单尚未完成，暂时无法发表体验评论。';
			}
			return false;
		}
		//一个月内订单可评论限制改为三个月 mackwang 2013.03.28
        if (time() - $order['order_date'] > self::EVALUATE_LIMIT_SECOND)
        {
			self::$errCode = -2027;
			self::$errMsg = "已经超过了可评论的期限，只能对三个月内的订单发表评论";
			return false;
		}

		//添加使用易迅快递，对评论规则进行的修改, 12月22日之前的订单，是没有签收流水的 @ ixiuzeng
		global $_OrderProcessId;
		if ($order['order_date'] > 1326038400 && in_array($order['shipping_type'], self::$evaluateViaShipType) ) { //2012.12.22
			$order_process_flows = IOrderProcessFlowTTC::get($order['order_id'], array('process_id'=> $_OrderProcessId['Done']['value']));
			if (false === $order_process_flows) {
				self::$errCode = IOrderProcessFlowTTC::$errCode;
				self::$errMsg = IOrderProcessFlowTTC::$errMsg;
				return false;
			}
			else if (count($order_process_flows) < 1) {
				self::$errCode = -2057;
				self::$errMsg = "用户还没签收";
				return false;
			}
			return true;
		}
        //非易迅快递的用户，保持原来的规则。
        else
        {
            if (time() - $order['out_time'] < 24*3600)
            {
				self::$errCode = -2026;
				self::$errMsg = "您需在商品出库24小时后才可评价";
				return false;
			}
			return true;
		}
		return true;
	}

	/*
			 @name	setOrderItemUnEvaluated , 取消订单已评论状态，让用户可以再次评论
			 @desc
			 @para	uid，用户id
			 @para	order_id，子订单id
			 @para	product_id，商品id
		 */
	public static function setOrderItemUnEvaluated($uid, $order_id, $product_id)
	{
		if (!isset($order_id) || $order_id == "") {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_id[$order_id] is empty";
			return false;
		}

		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -2020;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";
			return false;
		}

		if (!isset($product_id) || $product_id <= 0) {
			self::$errCode = -2021;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id[$product_id] is empty";
			return false;
		}

		$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
		$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
		if (empty($orderDb)) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

		$orderInSqlSvr = false;

		$sql = "select flag from t_order_items_{$db_tab_index['table']} item where item.uid=$uid and item.order_char_id='$order_id' and item.product_id = $product_id";
		$orders = $orderDb->getRows($sql);
		if (false === $orders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

		if (count($orders) == 0) { //去历史订单库取
			$order_items = IOrderItemsTTC::get($uid, array('order_char_id'=> $order_id, 'product_id'=> $product_id), array('flag'));
			if (false === $order_items) {
				self::$errCode = IOrderItemsTTC::$errCode;
				self::$errMsg = IOrderItemsTTC::$errMsg;
				return false;
			} else if (count($order_items) < 1) {
				self::$errCode = -2023;
				self::$errMsg = "用户没有订单购买该商品";
				return false;
			}
			$order['flag'] = $order_items[0]['flag'];
        }else
        {
			$order = &$orders[0];
			$orderInSqlSvr = true;
		}

		if ($order['flag'] & ORDER_ITEM_EVALUATED == 0) { //本身就是未评论状态
			return true;
		}


		if (true === $orderInSqlSvr) {
			$sql = "update t_order_items_{$db_tab_index['table']} set flag = flag & " . (~ORDER_ITEM_EVALUATED) . " where uid=$uid and order_char_id='$order_id' and product_id = $product_id ";
			$ret = $orderDb->execSql($sql);
			if (false === $ret || 1 != $orderDb->getAffectedRows()) {
				self::$errCode = $orderDb->errCode;
				self::$errMsg = $orderDb->errMsg;
				return false;
			}
        }else
        {
			$ret = IOrderItemsTTC::update(array('uid'=> $uid, 'flag'=> ($order['flag'] & (~ORDER_ITEM_EVALUATED))), array('product_id'=> $product_id, 'order_char_id'=> $order_id));
			if (false === $ret) {
				self::$errCode = IOrderItemsTTC::$errCode;
				self::$errMsg = IOrderItemsTTC::$errMsg;
				return false;
			}
		}
		return true;
	}

	/*
			 @name	setOrderItemEvaluated
			 @desc
			 @para	uid，用户id
			 @para	order_id，子订单id
			 @para	product_id，商品id
		 */
	public static function setOrderItemEvaluated($uid, $order_id, $product_id)
	{
		if (!isset($order_id) || $order_id == "") {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_id[$order_id] is empty";
			return false;
		}

		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -2020;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";
			return false;
		}

		if (!isset($product_id) || $product_id <= 0) {
			self::$errCode = -2021;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id[$product_id] is empty";
			return false;
		}

		$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
		$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
		if (empty($orderDb)) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

		$orderInSqlSvr = false;

		global $_OrderState;
		$sql = "select uorder.out_time as out_time, uorder.order_date as order_date,uorder.status as status,
				uorder.shipping_type as shipping_type, uorder.hw_id as hw_id, uorder.order_id as order_id, item.flag as flag from
				t_order_items_{$db_tab_index['table']} item,
				t_orders_{$db_tab_index['table']} uorder
				where item.uid=$uid and item.order_char_id='$order_id' and item.order_char_id = uorder.order_char_id and
				item.product_id = $product_id";
		$orders = $orderDb->getRows($sql);
		if (false === $orders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

		if (count($orders) == 0) { //去历史订单库取
			$orders = IOrdersTTC::get($uid, array('order_char_id'=> $order_id), array('out_time', 'shipping_type', 'order_id', 'order_date', 'status', 'hw_id'));
			if (false === $orders) {
				self::$errCode = IOrdersTTC::$errCode;
				self::$errMsg = IOrdersTTC::$errMsg;
				return false;
			} else if (count($orders) < 1) {
				self::$errCode = "用户订单不存在";
				self::$errMsg = -2056;
				return false;
			}

			$order = $orders[0];
			$order_items = IOrderItemsTTC::get($uid, array('order_char_id'=> $order_id, 'product_id'=> $product_id), array('flag'));
			if (false === $order_items) {
				self::$errCode = IOrderItemsTTC::$errCode;
				self::$errMsg = IOrderItemsTTC::$errMsg;
				return false;
			} else if (count($order_items) < 1) {
				self::$errCode = -2023;
				self::$errMsg = "用户没有订单购买该商品";
				return false;
			}
			$order['flag'] = $order_items[0]['flag'];
        }else
        {
			$order = &$orders[0];
			$orderInSqlSvr = true;
		}

		if ($order['status'] != $_OrderState['OutStock']['value'] && $order['status'] != $_OrderState['PartlyReturn']['value']) {
			if( $order['status'] == $_OrderState['Return']['value'] ||
				$order['status'] == $_OrderState['ManagerCancel']['value'] || 
				$order['status'] == $_OrderState['CustomerCancel']['value'] || 
				$order['status'] == $_OrderState['EmployeeCancel']['value'] 
			){
				self::$errCode = -2024;
				self::$errMsg = "您尚未购买该商品，无法发表体验评论，欢迎您发表商品讨论或购买后评价。";
			} else {
				self::$errCode	= -2028;
				self::$errMsg	= '您的订单尚未完成，暂时无法发表体验评论。';
			}
			return false;
		}

		if ($order['flag'] & ORDER_ITEM_EVALUATED == ORDER_ITEM_EVALUATED) {
			self::$errCode = -2029;
			self::$errMsg = "该订单已被评论".($orderInSqlSvr?"[SqlServer]":"[TTC]");
                        

			return false;
		}
		
		//一个月内订单可评论限制改为三个月 mackwang 2013.03.28
		if (time() - $order['order_date'] > self::EVALUATE_LIMIT_SECOND) {
			self::$errCode = -2027;
			self::$errMsg = "已经超过了可评论的期限，只能对三个月内的订单发表评论";
			return false;
		}

		global $_OrderProcessId;
		if ($order['order_date'] > 1326038400 && in_array($order['shipping_type'], self::$evaluateViaShipType)) //易迅快递
		{
			$order_process_flows = IOrderProcessFlowTTC::get($order['order_id'], array('process_id'=> $_OrderProcessId['Done']['value']));
            if (false === $order_process_flows)
            {
				self::$errCode = IOrderProcessFlowTTC::$errCode;
				self::$errMsg = IOrderProcessFlowTTC::$errMsg;
				return false;
			}
            if (count($order_process_flows) < 1)
            {
				self::$errCode = -2057;
				self::$errMsg = "用户还没签收";
				return false;
			}
		}
        //非易迅快递的用户，保持原来的规则。
        else
        {
            if (time() - $order['out_time'] < 24*3600)
            {
				self::$errCode = -2026;
				self::$errMsg = "您需在商品出库24小时后才可评价";
				return false;
			}
		}

		if (true === $orderInSqlSvr) {
			$sql = "update t_order_items_{$db_tab_index['table']} set flag = flag | " . ORDER_ITEM_EVALUATED . " where uid=$uid and order_char_id='$order_id' and product_id = $product_id and (flag & " . ORDER_ITEM_EVALUATED . ") = 0";
			$ret = $orderDb->execSql($sql);
			if (false === $ret || 1 != $orderDb->getAffectedRows()) {
				self::$errCode = $orderDb->errCode;
				self::$errMsg = $orderDb->errMsg;
				return false;
			}
        }else
        {
			$ret = IOrderItemsTTC::update(array('uid'=> $uid, 'flag'=> ($order['flag'] | ORDER_ITEM_EVALUATED)), array('product_id'=> $product_id, 'order_char_id'=> $order_id));
			if (false === $ret||(true === $ret&&IOrderItemsTTC::getTTCAffectRows()==0) ) {
				self::$errCode = IOrderItemsTTC::$errCode;
				self::$errMsg = IOrderItemsTTC::$errMsg;
				return false;
			}
		}
		return true;
	}

	/*
			 @name	setOrderCanceled
			 @desc	取消订单
			 @para	uid，用户id
			 @para	order_id，订单id
			 @para	product_id，商品id
		 */
	public static function setOrderCanceled($uid, $order_id)
	{
		$ret = IOrder51buy::setOrderCanceled($uid, $order_id);
        if(false === $ret)
        {
			IOrder::$errCode = IOrder51buy::$errCode;
			IOrder::$errMsg = IOrder51buy::$errMsg;
		}
		return $ret;
	}


	/**
	 * @static
	 * @desc                获得用户最近一个月的多个订单的信息
	 * @param $uid          用户的id
	 * @param $order_ids    订单价格array(订单号_1,订单号_2);
	 * @return array|bool
	 *      出错返回false，
	 *      正确返回数组:
	 *      array(
	 *		    'hw_id'=>1,
	 *          'stockNo'=>1,
	 *          'status' =>0,
	 *          'point_pay'=>10,
	 *          'cash_point'=>5,
	 *          'promotion_point'=>5,
	 *          'order_id' => 22015631,
	 *          'single_promotion_info'=>XXX,
	 *          'flag'=>0,
	 *          'order_char_id'=>'1022015631',
	 *          'shipping_type'=>1,
	 *          'expect_dly_date'=>XXX,
	 *          'expect_dly_time_span'=>1,
	 *          'order_date' => XXXX,
	 *          'pOrderId' => '1022015631',
	 *          'subOrderNum' => 1,
	 *          'product_info' = array(
	 *				0=>array(
	 *					'order_char_id' => '1022015631',
	 *                  'product_id' => 28001,
	 *                  'wh_id' => 1,
	 *                  'buy_num' => 3,
	 *                  'use_virtual_stock' => 0,
	 *              ),
	 *              1=>array(
	 *                  'order_char_id' => '1022015631',
	 *                  'product_id' => 28002,
	 *                  'wh_id' => 1,
	 *                  'buy_num' => 2,
	 *                  'use_virtual_stock' => 0,
	 *              ),
	 *          ),
	 *      )
	 */
	public static function  getSomeOrders($uid, $order_ids)
	{
		//用于拼装查询语句的订单集合
		$ordersIdString = "''";
		foreach ($order_ids as $orderId) {
			$ordersIdString .= ",'{$orderId}'";
		}

		$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
		$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
		if (empty($orderDb)) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

		$sql = "select hw_id,
					stockNo,
					status,
					point_pay,
					cash_point,
					order_id,
					pay_type,
					isPayed,
					promotion_point,
					single_promotion_info,
					flag,
					shipping_type,
					expect_dly_date,
					expect_dly_time_span,
					order_date,
					pOrderId,
					subOrderNum,
					order_char_id
				from t_orders_{$db_tab_index['table']}
				where uid={$uid}
				and order_char_id in ({$ordersIdString})";
		$orders_select = $orderDb->getRows($sql);
		if (false === $orders_select) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

		$sql = "select order_char_id, product_id, wh_id, buy_num, use_virtual_stock
				from t_order_items_{$db_tab_index['table']}
				where order_char_id in ({$ordersIdString})";
		$order_items_select = $orderDb->getRows($sql);
		if (false === $order_items_select) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

		//返回每个订单下面的商品
		$result_order_info = array();
		foreach($orders_select as $orderIndex)
		{
			$order_id_temp = $orderIndex['order_char_id'];
			$result_order_info[$order_id_temp] = $orderIndex;
			foreach($order_items_select as $itemIndex)
			{
				if($order_id_temp == $itemIndex['order_char_id'])
				{
					$result_order_info[$order_id_temp]['product_info'][] = $itemIndex;
				}
			}
		}

		return $result_order_info;
	}

	/**
	 * 设置订单为已支付，修改 isPayed 为 1
	 * @param int $uid 用户ID
	 * @param int $order_id 订单ID
	 * @param int $cash 支付金额
	 * @param array $subOrderIds 子单ID
	 * @return bool true 成功；false 失败
	 */
	public static function setOrderPayed($uid, $order_id, $cash, $subOrderIds = array())
	{
		if (!isset($order_id) || $order_id == "") {
			self::setErr(-2019, basename(__FILE__, '.php') . " |" . __LINE__ . "order_id[$order_id] is empty");
			return false;
		}
		if (!isset($uid) || $uid <= 0) {
			self::setErr(-2020, basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty");
			return false;
		}
		if (!isset($cash) || $cash <= 0) {
			self::setErr(-2021, basename(__FILE__, '.php') . " |" . __LINE__ . "cash[$cash] is empty");
			return false;
		}

		$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
		$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
		if (empty($orderDb)) {
			self::setErr($orderDb->errCode, $orderDb->errMsg);
			return false;
		}

		$allOrders = array_merge(array($order_id), $subOrderIds);
		$allOrderCount = count($allOrders);
		$orderIdStr = implode(',', $allOrders);

		$sql = "select
						order_char_id,
						hw_id,
						flag,
						status,
						pay_type,
						cash+prcd_cost as cash,
						isPayed,
						installment_num,
						cash_per_month
					from t_orders_{$db_tab_index['table']}
					where uid = {$uid}
						and order_char_id in ({$orderIdStr})";
		$orders = $orderDb->getRows($sql);
		if (false === $orders) {
			self::setErr($orderDb->errCode, $orderDb->errMsg);
			return false;
		} else if (0 >= count($orders)) {
			self::setErr(-2020, basename(__FILE__, '.php') . " |" . __LINE__ . "no such orders");
			return false;
		}

		if ($allOrderCount == 1) {
			$order = &$orders[0];
			if ((ORDER_INSTALLMENT_FLAG & $order['flag']) == ORDER_INSTALLMENT_FLAG) { //分期付款订单
				if($order['pay_type'] != 28)//pay_type = 28 表示招行
				{
					$order['cash'] = $order['installment_num'] * $order['cash_per_month']; //分期付款订单金额 = 期数 * 每期费用
				}
				self::Log("user pay amt($cash), paytype:({$order['pay_type']}), order cash:({$order['cash']})");	
			}
			if (bccomp($cash, $order['cash'], 0)) {
				self::setErr(-992, "user pay amt($cash) is not equal to order amt({$order['cash']})");
				self::Log("user pay amt($cash) is not equal to order amt({$order['cash']})");
				return false;
			}

			if ($order['isPayed'] == 1) {
				return true;
			}
		}
		else {
			$allPayed = true;
			$allOrderCash = 0;
			foreach($orders as $orderRet) {
				if ((ORDER_INSTALLMENT_FLAG & $orderRet['flag']) == ORDER_INSTALLMENT_FLAG) { //分期付款订单
					if($orderRet['pay_type'] != 28)//pay_type = 28 表示招行
					{
						$orderRet['cash'] = $orderRet['installment_num'] * $orderRet['cash_per_month']; //分期付款订单金额 = 期数 * 每期费用
					}
					self::Log("user pay amt($cash), paytype:({$orderRet['pay_type']}), orderRet cash:({$orderRet['cash']})");
					$allOrderCash += $orderRet['cash'];
				}
				if ($orderRet['isPayed'] != 1) {
					self::setErr(-992, "{$orderRet['order_id']} set isPayed failed!");
					$allPayed = false;
				}
			}

			if ($allOrderCash > 0 && bccomp($cash, $allOrderCash, 0)) { //有分期的订单，详细比较金额
				self::setErr(-992, "user pay amt($cash) is not equal to all order amt({$allOrderCash})");
				self::Log("user pay amt($cash) is not equal to all order amt({$allOrderCash})");
				return false;
			}
			if ($allPayed) {
				return true;
			}
		}

		$now = time();

		$sql = "update t_orders_{$db_tab_index['table']}
						set isPayed=1, update_time={$now}
					where uid=$uid
						and order_char_id in ({$orderIdStr})";
		$ret = $orderDb->execSql($sql);
		if (false === $ret) {
			self::setErr($orderDb->errCode, $orderDb->errMsg);
			return false;
		}
		else if ($allOrderCount != $orderDb->getAffectedRows()) { //更新结果和输入不同
			self::setErr(991, "update result not match");
			return false;
		}

		return true;
	}

    /*
         @name	getOneOrderDetail
         @desc	获取一个订单的信息
         @para	uid，用户id
         @para	order_id，订单id
	 */
	public static function getOneOrderDetail($uid, $order_id)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";
			return false;
		}
		if (!isset($order_id) || $order_id == "") {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_id[$order_id] is empty";
			return false;
		}

		$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
		$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
		if (empty($orderDb)) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

		$sql = "select out_time,
				hw_id,
				stockNo,
				flag,
				installment_num,
				cash_per_month,
				order_id,
				order_char_id,
				status,
				point_pay,
				order_date,
				isPayed,
				pay_type,
				receiver,
				receiver_zip,
				receiver_tel,
				receiver_addr,
				receiver_addr_id,
				receiver_mobile,
				shipping_cost,
				shipping_type,
				order_cost,
				coupon_code,
				coupon_amt,
				price_cut,
				shop_id,
				shop_guide_cost,
				shop_guide_id,
				prcd_cost,
				is_vat,
				cash + prcd_cost as cash ,
				expect_dly_date,
				expect_dly_time_span,
				pOrderId,
				subOrderNum,
				comment,
				bits,
				shipping_flag
				 from t_orders_{$db_tab_index['table']} where uid=$uid and order_char_id='$order_id'";

		$orders = $orderDb->getRows($sql);
		if (false === $orders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

		$inSqlSvr = false;
        if (count($orders) == 1)
        {
			$inSqlSvr = true;
        }
        else
        {
			$orders = IOrdersTTC::get($uid, array('order_char_id'=> $order_id), array('out_time',
				'hw_id',
				'stockNo',
				'flag',
				'installment_num',
				'cash_per_month',
				'order_id',
				'order_char_id',
				'status',
				'point_pay',
				'order_date',
				'isPayed',
				'pay_type',
				'receiver',
				'receiver_zip',
				'shop_id',
				'shop_guide_cost',
				'shop_guide_id',
				'receiver_tel',
				'receiver_addr',
				'receiver_addr_id',
				'receiver_mobile',
				'shipping_cost',
				'shipping_type',
				'order_cost',
				'coupon_code',
				'coupon_amt',
				'price_cut',
				'prcd_cost',
				'is_vat',
				'cash',
				'expect_dly_date',
				'expect_dly_time_span',
				'pOrderId',
				'subOrderNum',
				'comment',
				'bits'
			));
			if (false === $orders) {
				self::$errCode = IOrdersTTC::$errCode;
				self::$errMsg = IOrdersTTC::$errMsg;
				return false;
			}
			if (count($orders) == 0) {
				self::$errCode = -999;
				self::$errMsg = "订单不存在";
				return false;
			}
			$orders[0]['cash'] += $orders[0]['prcd_cost'];
		}
		$order = &$orders[0];

		self::appendSubOrderIds($order);

        if ((strncmp($order['coupon_code'], 'rule_', 5) == 0 )|| (strncmp($order['coupon_code'], 'jieneng', 7) == 0)) { //使用的促销规则
			$order['promotion_cut'] = $order['coupon_amt'];
			unset($order['coupon_code']);
			unset($order['coupon_amt']);
		}

		//如果是分期付款的订单，转换数组索引
		if ((ORDER_INSTALLMENT_FLAG & $order['flag']) == ORDER_INSTALLMENT_FLAG) {
			$order['installment'] = 1;
            //招行分期cash不变，平安分期付款订单金额 = 期数 *　每期费用
			if($order['pay_type'] != 28)//pay_type = 28 表示招行
			{
				$order['cash'] = $order['installment_num'] * $order['cash_per_month'];
			}
		}

		$order['receiver_addr_input'] = $order['receiver_addr']; //详细地址,input用户输入部分.在售后报修单填写加载时用到 add by allenzhou 2012-08-27

		global $_District, $_Province, $_City;
		@$order['receiver_addr'] = ($_Province[$_District[$order['receiver_addr_id']]['province_id']] . $_City[$_District[$order['receiver_addr_id']]['city_id']]['name'] . $_District[$order['receiver_addr_id']]['name'] . $order['receiver_addr']);

		if ($order['shipping_type'] == ICSON_DELIVERY) { //易迅快递才有效
			$order['expect_dly_date'] = date("Y年m月d日", $order['expect_dly_date']);
			if ($order['expect_dly_time_span'] == 1) {
				$order['expect_dly_time_span'] = "上午 09:00-14:00";
			} else if ($order['expect_dly_time_span'] == 2) {
				$order['expect_dly_time_span'] = "下午 14:00-18:00";
			} else if ($order['expect_dly_time_span'] == 3) {
				$order['expect_dly_time_span'] = "晚上 18:00-22:00";
			} else {
				$order['expect_dly_time_span'] = "";
			}
		}

		global $_OrderState, $_PAY_MODE;
		if (($order['status'] == $_OrderState['Origin']['value'] || $order['status'] == $_OrderState['WaitingPay']['value'] || $order['status'] == $_OrderState['WaitingManagerAudit']['value'])
			&& $_PAY_MODE[$order['hw_id']][$order['pay_type']]['IsNet'] == 1
			&& $order['isPayed'] == 0)
		{
			$order['need_pay'] = 1;
		}
		else
		{
			$order['need_pay'] = 0;
		}

		if ( ($order['status'] == $_OrderState['Origin']['value'] && $order['isPayed'] == 0) || //货到付款类的
			(($order['status'] == $_OrderState['Origin']['value'] || $order['status'] == $_OrderState['WaitingPay']['value'] || $order['status'] == $_OrderState['WaitingManagerAudit']['value']) &&
			 (1 != $order['pay_type']) && (0 == $order['isPayed'])) )   //非货到付款类的
		{
			$order['can_cancel'] = 1;
		} 
		else
		{
			$order['can_cancel'] = 0;
		}

		//开始计算该订单是否可以评论
		$now = time();
		global $_OrderProcessId;
		$orderCanEvaluate = true;
		$order['refund_type'] = false; //modify by allenzhou 2012-05-01已签收(售后退款)true.未签收(售前退款)false
		$order_process_flows = IOrderProcessFlowTTC::get($order['order_id'], array('process_id'=> $_OrderProcessId['Done']['value']));
		if (count($order_process_flows) > 0) { //已签收
			$order['refund_type'] = true;
		}

		if ($order['status'] != $_OrderState['OutStock']['value'] && $order['status'] != $_OrderState['PartlyReturn']['value']) {
			$orderCanEvaluate = false;
        }else if ($now - $order['order_date'] > self::EVALUATE_LIMIT_SECOND) {//一个月内订单可评论限制改为三个月 mackwang 2013.03.28
			$orderCanEvaluate = false;
        }else if ($order['order_date'] > 1326038400 && in_array($order['shipping_type'], self::$evaluateViaShipType))
        {
            if (false === $order_process_flows || count($order_process_flows) < 1)
            {
				$orderCanEvaluate = false;
			}
		} else {
            if ($now - $order['out_time'] < 24*3600)
            {
				$orderCanEvaluate = false;
			}
		}
		//计算订单是否可评论结束

		//拉取订单对应的商品
        if ($inSqlSvr === true)
        {
			$sql = "select product_id, flag, product_char_id, product_type, main_product_id, name,weight, buy_num,warranty, price,shop_guide_cost, cash_back, apportToPm, apportToMkt from t_order_items_{$db_tab_index['table']} where uid=$uid and order_char_id='$order_id' order by product_type asc";
			$order_items = $orderDb->getRows($sql);
			if (false === $order_items) {
				self::$errCode = $orderDb->errCode;
				self::$errMsg = $orderDb->errMsg;
				return false;
			}
        }
        else
        {
			$order_items = IOrderItemsTTC::get($uid, array('order_char_id'=> $order_id), array('product_id', 'flag', 'product_char_id', 'product_type', 'main_product_id', 'name', 'weight', 'buy_num', 'warranty', 'shop_guide_cost', 'price', 'cash_back'));
			if (false === $order_items) {
				self::$errCode = IOrderItemsTTC::$errCode;
				self::$errMsg = IOrderItemsTTC::$errMsg;
				return false;
			}
		}

        foreach ($order_items as $oit)
        {
			$oit['can_evaluate'] = false;
			$oit['is_evaluated'] = false;
			if ($oit['product_type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL) {
				if (true === $orderCanEvaluate && (($oit['flag'] & ORDER_ITEM_EVALUATED) != ORDER_ITEM_EVALUATED)) {
					$oit['can_evaluate'] = true;
				}
				//ixiuzeng添加
				if (($oit['flag'] & ORDER_ITEM_EVALUATED) == ORDER_ITEM_EVALUATED) {
					$oit['is_evaluated'] = true;
				}
				$order['items'][$oit['product_id']] = $oit;
            }else
            {
				if ($oit['product_type'] == SHOPPING_CART_PRODUCT_TYPE_ZUJIAN) {
					$oit['product_type'] = "组件";
                }else
                {
					$oit['product_type'] = "赠品";
				}
				$order['items'][$oit['main_product_id']]['gift'][] = $oit;
				//$order['items'][$oit['product_id']] = $oit;
			}
		}

		//拉取发票信息
        if ($inSqlSvr === true) {
			$sql = "select name, addr, phone, taxno, bankno, title, type, content from t_order_invoice_{$db_tab_index['table']} where order_char_id='$order_id'";
			$order_invoice = $orderDb->getRows($sql);
			if (false === $order_invoice) {
				self::$errCode = $orderDb->errCode;
				self::$errMsg = $orderDb->errMsg;
				return false;
			}
        }else
        {
			$order_invoice = IOrderInvoiceTTC::get($uid, array('order_char_id'=> $order_id), array('name', 'addr', 'phone', 'taxno', 'bankno', 'title', 'type', 'content'));
			if (false === $order_invoice) {
				self::$errCode = IOrderInvoiceTTC::$errCode;
				self::$errMsg = IOrderInvoiceTTC::$errMsg;
				return false;
			}
		}


        foreach ($order_invoice as $oi)
        {
			$oi['type_id'] = $oi['type'];
            if ($oi['type'] == INVOICE_TYPE_RETAIL_COMPANY)
            {
					$oi['type'] = "商业零售发票(单位)";
            }
            else if ($oi['type'] == INVOICE_TYPE_VAT)
            {
					$oi['type'] = "增值税专业发票";
            }else if ($oi['type'] == INVOICE_TYPE_VAT_NORMAL)
            {
					$oi['type'] = "增值税普通发票";
            }
            else if ($oi['type'] == INVOICE_TYPE_CP_UNICOM)
            {
					$oi['type'] = "联通统一发票";
            }
            else if ($oi['type'] == INVOICE_TYPE_CP_TELCOM)
            {
					$oi['type'] = "电信统一发票";
            }
            else if ($oi['type'] == INVOICE_TYPE_CP_MOBILE)
            {
					$oi['type'] = "移动统一发票";
            }
            else
            {
					$oi['type'] = "商业零售发票(个人)";
			}
			$order['invoices'][] = $oi;
		}

		$order['is_hide_invoices'] = empty($order['is_vat']) ? 1 : 0;

		return $order;
	}

	/*
			 @name	isUserBuyedACertainItem
			 @desc	uid用户是否在timestart到timeend之间买过product_id的产品
			 @para	uid，用户id
			 @para	order_id，订单id
			 @para	timestart
			 @para	timetend
		 */

	public static function isUserBuyedACertainItem($uid, $product_id, $timestart, $timeend)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";
			return false;
		}
		if (!isset($product_id) || $product_id <= 0) {
			self::$errCode = -2020;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id[$product_id] is empty";
			return false;
		}
		if (!isset($timestart) || $timestart <= 0) {
			self::$errCode = -2021;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "timestart[$timestart] is empty";
			return false;
		}
		if (!isset($timeend) || $timeend <= 0) {
			self::$errCode = -2022;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "imeend[$timeend] is empty";
			return false;
		}

		$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
		$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
		if (empty($orderDb)) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

		$sql = "select wh_id, order_char_id, product_id, product_char_id, name, buy_num, points_pay,
		warranty,price,shop_guide_cost,create_time, flag, (flag &" . ORDER_ITEM_EVALUATED . ") as isEvaluted from t_order_items_{$db_tab_index['table']}
		where uid=$uid and create_time <=$timeend and
		create_time >= $timestart and product_id = $product_id";

		$order_items = $orderDb->getRows($sql);
		if (false === $order_items) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

		//拉取历史订单库中的列表
		$order_items_history = IOrderItemsTTC::get($uid, array('product_id'=> $product_id), array('wh_id', 'order_char_id', 'product_id', 'product_char_id', 'name', 'buy_num', 'points_pay',
			'warranty', 'price', 'create_time', 'flag'));
		if (is_array($order_items_history)) {
            foreach ($order_items_history as $oi)
            {
				if ($oi['create_time'] < $timestart || $oi['create_time'] > $timeend) {
					continue;
				}
				$oi['isEvaluted'] = ($oi['flag'] & ORDER_ITEM_EVALUATED);
				$order_items[] = $oi;
			}
		}

		return $order_items;
	}

	public static function getOrderItems($uid, $order_id)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";
			return false;
		}
		if (!isset($order_id) || $order_id == "") {
			self::$errCode = -2020;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_id[$order_id] is empty";
			return false;
		}

		$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
		$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
		if (empty($orderDb)) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}
		//拉取订单对应的商品
		$sql = "select product_id, product_char_id, name,weight, buy_num,warranty,flag,price,shop_guide_cost from t_order_items_{$db_tab_index['table']}
		 where uid=$uid and product_type=0 and order_char_id='$order_id'";
		$order_items = $orderDb->getRows($sql);
		if (false === $order_items) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

		//如果 sql svr 中没有， 则去历史库查看
		if (count($order_items) == 0) {
			$order_items = IOrderItemsTTC::get($uid, array('order_char_id'=> $order_id, 'product_type'=> 0), array('product_id', 'product_char_id', 'name', 'weight', 'buy_num', 'flag', 'warranty', 'shop_guide_cost', 'price'));
			if (false === $order_items) {
				self::$errCode = IOrderItemsTTC::$errCode;
				self::$errMsg = IOrderItemsTTC::$errMsg;
				return false;
			}
		}

		//ixiuzeng添加,获得商品的是否为特价商品
		foreach ($order_items as &$its) {
			$its['isCouponProduct'] = (COUPON_PRODUCT & $its['flag']) == COUPON_PRODUCT;
		}

		return $order_items;
	}

	/*
		 获取多个订单的item详情,只支持一个月内的订单
		 $needOrder = array(
		 $order_char_id => $uid
		 )
		 */
	public static function getOrdersItems($needOrder)
	{

		if (!is_array($needOrder) || count($needOrder) == 0) {
			self::$errCode = -2020;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "needOrder is empty";
			return false;
		}

		$orderDbTables = array();
        foreach($needOrder as $order_id => $uid)
        {
			$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
			$orderDbTables[$db_tab_index['db']][$db_tab_index['table']][] = $order_id;
		}

		$order_items = array();
        foreach($orderDbTables as $db_index => $dbOrders)
        {
			$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_index);
			if (empty($orderDb)) {
				self::$errCode = $orderDb->errCode;
				self::$errMsg = $orderDb->errMsg;
				return false;
			}
            foreach($dbOrders as $tab_index => $oids)
            {
				//拉取订单对应的商品
				$sql = "select order_char_id, product_id, product_char_id, name,weight, buy_num,warranty,flag,price,shop_guide_cost from t_order_items_$tab_index
				 where product_type=0 and order_char_id in('" . implode("','", $oids) . "')";
				$tmp_items = $orderDb->getRows($sql);
				if (false === $tmp_items) {
					self::$errCode = $orderDb->errCode;
					self::$errMsg = $orderDb->errMsg;
					return false;
				}

				//ixiuzeng添加,获得商品的是否为特价商品
                foreach($tmp_items as $its)
                {
                    if ((COUPON_PRODUCT & $its['flag']) == COUPON_PRODUCT)
                    {
						$its['isCouponProduct'] = true;
                    }
                    else
                    {
						$its['isCouponProduct'] = false;
					}
					$order_items[$its['order_char_id']][] = $its;
				}
			}
		}
		return $order_items;
	}

	public static function getOneOrder($uid, $order_id)
	{

		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";
			return false;
		}
		if (!isset($order_id) || $order_id == "") {
			self::$errCode = -2020;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_id[$order_id] is empty";
			return false;
		}

		$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
		$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
		if (empty($orderDb)) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

		$sql = "SELECT shipping_type,
							stockNo,
							out_time,
							expect_dly_date,
							expect_dly_time_span,
							order_char_id,
							hw_id,
							flag,
							status,
							order_date,
							installment_num,
							cash_per_month,
							pay_type,
							receiver,
							receiver_mobile,
							shipping_cost,
							order_cost,
							coupon_code,
							coupon_amt,
							point,
							point_pay,
							cash + prcd_cost as cash,
							cpsinfo,
							isPayed,
							subOrderNum,
							single_promotion_info,
							pOrderId,
							order_id,
							ls,
							bits
					FROM t_orders_{$db_tab_index['table']}
					WHERE uid=$uid
					AND order_char_id='$order_id'";

		$orders = $orderDb->getRows($sql);
		if (false === $orders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

        if (0 == count($orders)) {
            //去历史库拉取订单信息
			$orders = IOrdersTTC::get($uid, array('order_char_id'=> $order_id));
			if (false === $orders) {
				self::$errMsg = IOrdersTTC::$errMsg;
				self::$errCode = IOrdersTTC::$errCode;
				return false;
			}
			if (count($orders) == 0) {
				self::$errCode = -2020;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "no such orders";
				return false;
			}
			$order = $orders[0];
			$order['cash'] += $order['prcd_cost'];

        }
        else
        {
			$order = $orders[0];
		}

        if(!empty($order['single_promotion_info']))
        {
			$order['single_promotion_info'] = explode(';', $order['single_promotion_info']);
		}

        if ($order['shipping_type'] == ICSON_DELIVERY)
        {
			//易迅快递才有效
			$order['expect_dly_date'] = date("Y年m月d日", $order['expect_dly_date']);
			if ($order['expect_dly_time_span'] == 1) {
				$order['expect_dly_time_span'] = "上午 09:00-14:00";
			} else if ($order['expect_dly_time_span'] == 2) {
				$order['expect_dly_time_span'] = "下午 14:00-18:00";
			} else if ($order['expect_dly_time_span'] == 3) {
				$order['expect_dly_time_span'] = "晚上 18:00-22:00";
			} else {
				$order['expect_dly_time_span'] = "";
			}
		}
		//如果是分期付款的订单，转换数组索引
		if ((ORDER_INSTALLMENT_FLAG & $order['flag']) == ORDER_INSTALLMENT_FLAG) {
			$order['installment'] = 1;
			$order['product_amt'] = $order['cash'];

			//招行分期cash不变，平安分期付款订单金额 = 期数 *　每期费用
			if($order['pay_type'] != 28)//pay_type = 28 表示招行
			{
				$order['cash'] = $order['installment_num'] * $order['cash_per_month'];
			}
		}
		if ($order['subOrderNum'] > 0) {
			$order['isParentOrder'] = true;
        }else
        {
			$order['isParentOrder'] = false;
		}
		self::appendSubOrderIds($order);

		if (strncmp($order['coupon_code'], 'rule_', 5) == 0) { //使用的促销规则
			$order['promotion_cut'] = $order['coupon_amt'];
			unset($order['coupon_code']);
			unset($order['coupon_amt']);
		}

		//是否是节能补贴的订单
        $order['is_energy_subsidy_order'] = (ORDER_ENERGY_SUBSIDY == ($order['flag'] & ORDER_ENERGY_SUBSIDY)) ? true : false;


		return $order;
	}

	/*
		 输入：
			 uid;用户id
			 timestart：起始时间戳
			 timeend：终止时间戳
			 page： 第几页，从0开始
			 pagesize：每页记录数
			 distributionInfo:分销订单的附加查询条件array('shopId'=>XXXX,'shopGuideId'=>'');


		 输出：
		 total :总结果条数
		 items:订单数组
			 order_char_id：订单id
			 status ： 订单状态
			 order_date：下单时间戳
			 shipping_cost：运费
			 order_cost ： 订单金额
			 couponCode ：使用的优惠券
			 coupon_amt ：使用的优惠券面值
			 point ： 使用积分
			 receiver:收获人
			 pay_type：支付方式
			 cash ： 现金支付
		 */
	public static function getUserOrdersInOneMonth($uid, $page, $pageSize, $distributionInfo = array())
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";
			return false;
		}
		$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
		$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
		if (empty($orderDb)) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}


		$sql = "select count(*) as total_num from t_orders_{$db_tab_index['table']} where uid=$uid and (subOrderNum IS NULL OR subOrderNum=0)";
		$sql .= isset($distributionInfo['shopId']) ? " and shop_id={$distributionInfo['shopId']}" : "";
		$sql .= isset($distributionInfo['shopGuideId']) ? " and shop_guide_id={$distributionInfo['shopGuideId']}" : "";

		$total = $orderDb->getRows($sql);
		if (false === $total) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

		$total = $total[0]['total_num'];
		if ($total == 0) {
			return array('total'=> $total, 'orders'=> array());
		}
		$sql = "select * from (
						select hw_id,
								order_char_id,
								flag, out_time,
								order_id,
								status,
								order_date,
								shop_id,
								shop_guide_id,
								shop_guide_cost,
								pay_type,
								isPayed,
								shipping_type,
								receiver,
								receiver_mobile,
								receiver_addr,
								receiver_addr_id,
								shipping_cost,
								order_cost,
								coupon_code,
								coupon_amt,
								point,
								stockNo,
								pOrderId,
								subOrderNum,
								cash + prcd_cost as cash,
								row_number() over (order by order_date desc) rn
		from t_orders_{$db_tab_index['table']} where uid=$uid ";
		$sql .= isset($distributionInfo['shopId']) ? " and shop_id={$distributionInfo['shopId']}" : "";
		$sql .= isset($distributionInfo['shopGuideId']) ? " and shop_guide_id={$distributionInfo['shopGuideId']}" : "";
		$sql .= " and (subOrderNum IS NULL OR subOrderNum=0)) tmpres
		where rn >" . $page * $pageSize . " and rn<=" . ($page + 1) * $pageSize;
		$orders = $orderDb->getRows($sql);
		if (false === $orders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}
		if (count($orders) == 0) {
			return array('total'=> $total, 'orders'=> $orders);
		}

		$now = time();
		$icsonShipOrder = array();
		//处理订单是否需要显示去支付
        global $_OrderState, $_PAY_MODE, $_StockToStation;
		foreach ($orders as $key=> &$oo) {
			if (($oo['status'] == $_OrderState['Origin']['value'] || $oo['status'] == $_OrderState['WaitingPay']['value'] || $oo['status'] == $_OrderState['WaitingManagerAudit']['value'])
				&& $_PAY_MODE[$oo['hw_id']][$oo['pay_type']]['IsNet'] == 1
				&& $oo['isPayed'] == 0)
			{
				$oo['need_pay'] = 1;
			}
			else
			{
				$oo['need_pay'] = 0;
			}

			if ( ($oo['status'] == $_OrderState['Origin']['value'] && $oo['isPayed'] == 0) || //货到付款类的
				(($oo['status'] == $_OrderState['Origin']['value'] || $oo['status'] == $_OrderState['WaitingPay']['value'] || $oo['status'] == $_OrderState['WaitingManagerAudit']['value']) &&
				 (1 != $oo['pay_type']) && (0 == $oo['isPayed'])) )   //非货到付款类的
			{
				$oo['can_cancel'] = 1;
			}
			else
			{
				$oo['can_cancel'] = 0;
			}
            if (strncmp($oo['coupon_code'], 'rule_', 5) == 0) { //使用的促销规则
                $oo['promotion_cut'] = $oo['coupon_amt'];
                unset($oo['coupon_code']);
                unset($oo['coupon_amt']);
			}

			//默认每个订单均可以评论
            $oo['can_evaluate'] = true;
            if ($oo['status'] != $_OrderState['OutStock']['value'] && $oo['status'] != $_OrderState['PartlyReturn']['value']) {
                $oo['can_evaluate'] = false;
            }else if ($now - $oo['order_date'] >  self::EVALUATE_LIMIT_SECOND) {//一个月内订单可评论限制改为三个月 mackwang 2013.03.28
                $oo['can_evaluate'] = false;
            }else if($oo['order_date'] > 1326038400 && in_array($oo['shipping_type'], self::$evaluateViaShipType))
				{
                $icsonShipOrder[] = $oo['order_id'];
            }else
            {
                if ($now - $oo['out_time'] < 24*3600)
                {
                    $oo['can_evaluate'] = false;
				}
			}
		}
		//开始计算该订单是否可以评论
		global $_OrderProcessId;
		if (count($icsonShipOrder) > 0) { //存在易迅订单，还需判断易迅订单的签收状况
			$order_process_flows = IOrderProcessFlowTTC::gets($icsonShipOrder, array('process_id'=> $_OrderProcessId['Done']['value']), array('order_id'));
			if (is_array($order_process_flows)) {
                foreach ($orders as $key=>&$oo)
                {
                    if (false === $oo['can_evaluate']) {
						continue;
					}
                    if ($oo['order_date'] > 1326038400 && in_array($oo['shipping_type'], self::$evaluateViaShipType))
                    {
						$exist = false;
                        foreach ($order_process_flows as $flow)
                        {
                            if ($oo['order_id'] == $flow['order_id']) {
								$exist = true;
								break;
							}
						}
						if (false === $exist) {
							$orders[$key]['can_evaluate'] = false;
						}

					}

				}
			}
		}
		//计算订单是否可评论结束
		//拉取订单对应的商品
		$sql = "select order_char_id, flag, product_id, product_char_id, name, buy_num from t_order_items_{$db_tab_index['table']} where uid=$uid and product_type=0 and order_char_id in(''";
        foreach ($orders as $o)
        {
			$sql .= ",'{$o['order_char_id']}'";
		}
		$sql .= ") order by order_char_id";


		$order_items = $orderDb->getRows($sql);
		if (false === $order_items) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}
        foreach ($orders as &$or)
        {
			$i = 0;
			$itemCanEvaluate = false;
			$buyTotal = 0;
            foreach ($order_items as $oit)
            {
				if (strcmp($oit['order_char_id'], $or['order_char_id']) === 0) {

					if ((($oit['flag'] & ORDER_ITEM_EVALUATED) != ORDER_ITEM_EVALUATED)) {
						$itemCanEvaluate = true;
					}
					if ($i < 8) {
						$or['items'][$i]['name'] = $oit['name'];
						$or['items'][$i]['product_char_id'] = $oit['product_char_id'];
						$or['items'][$i]['product_id'] = $oit['product_id'];
						$or['items'][$i]['buy_num'] = $oit['buy_num'];
						$or['items'][$i]['flag'] = $oit['flag'];
					}
					$i++;
					$buyTotal += $oit['buy_num'];
				}
			}
			if (false === $itemCanEvaluate) {
				$or['can_evaluate'] = false;
			}
			$or['buy_total'] = $buyTotal;
		}
		return array('total'=> $total, 'orders'=> $orders);
	}


	//distributionInfo:分销订单的附加查询条件array('shopId'=>XXXX,'shopGuideId'=>'')
	public static function getUserOrdersOneMonthAgo($uid, $page, $pageSize, $distributionInfo = array())
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";
			return false;
		}

		$conditon = array('subOrderNum'=> 0);
		isset($distributionInfo['shopId']) ? $conditon['shop_id'] = $distributionInfo['shopId'] : "";
		isset($distributionInfo['shopGuideId']) ? $conditon['shop_guide_id'] = $distributionInfo['shopGuideId'] : "";

		$total = IOrdersTTC::get($uid, $conditon, array('order_char_id'));
		if (false === $total) {
			self::$errCode = IOrdersTTC::$errCode;
			self::$errMsg = IOrdersTTC::$errMsg;
			return false;
		}
		$total = count($total);
		if ($total == 0) {
			return array('total'=> $total, 'orders'=> array());
		}

        $orders = IOrdersTTC::get($uid, $conditon, array('hw_id', 'order_char_id', 'flag', 'out_time', 'order_id', 'status', 'order_date',
            'pay_type','shop_id','shop_guide_cost','shop_guide_id','isPayed', 'receiver','receiver_mobile','receiver_addr','receiver_addr_id', 'shipping_cost', 'order_cost', 'shipping_type', 'coupon_code', 'coupon_amt', 'point', 'stockNo', 'pOrderId', 'cash', 'prcd_cost'), $pageSize , $page*$pageSize);
		if (false === $orders) {
			self::$errCode = IOrdersTTC::$errCode;
			self::$errMsg = IOrdersTTC::$errMsg;
			return false;
		}
		if (count($orders) == 0) {
			return array('total'=> $total, 'orders'=> $orders);
		}
		//处理订单是否需要显示去支付
        global $_OrderState, $_PAY_MODE, $_StockToStation;
		$icsonShipOrder = array();
		$now = time();
		foreach ($orders as $key=> &$order) {

			$order['cash'] += $order['prcd_cost'];
			if (($order['status'] == $_OrderState['Origin']['value'] || $order['status'] == $_OrderState['WaitingPay']['value'] ||
				$order['status'] == $_OrderState['WaitingManagerAudit']['value']) && $_PAY_MODE[$order['hw_id']][$order['pay_type']]['IsNet'] == 1 &&
				$order['isPayed'] == 0)
			{
				$order['need_pay'] = 1;
			}
			else
			{
				$order['need_pay'] = 0;
			}

			if ( ($order['status'] == $_OrderState['Origin']['value'] && $order['isPayed'] == 0) || //货到付款类的
				(($order['status'] == $_OrderState['Origin']['value'] || $order['status'] == $_OrderState['WaitingPay']['value'] || $order['status'] == $_OrderState['WaitingManagerAudit']['value']) &&
				 (1 != $order['pay_type']) && (0 == $order['isPayed'])) )   //非货到付款类的
			{
				$order['can_cancel'] = 1;
			}
			else
			{
				$order['can_cancel'] = 0;
			}
			if (strncmp($order['coupon_code'], 'rule_', 5) == 0) { //使用的促销规则
				$order['promotion_cut'] = $order['coupon_amt'];
				unset($order['coupon_code']);
				unset($order['coupon_amt']);
			}

			//默认每个订单均可以评论
			$order['can_evaluate'] = true;
			if ($order['status'] != $_OrderState['OutStock']['value'] && $order['status'] != $_OrderState['PartlyReturn']['value']) {
				$order['can_evaluate'] = false;
			} else if ($now - $order['order_date'] >  self::EVALUATE_LIMIT_SECOND) {//一个月内订单可评论限制改为三个月 mackwang 2013.03.28
				$order['can_evaluate'] = false;
			} else if ($order['order_date'] > 1326038400 && in_array($order['shipping_type'], self::$evaluateViaShipType)) {
				$icsonShipOrder[] = $order['order_id'];
			} else {
				if ($now - $order['out_time'] < 24 * 3600) {
					$order['can_evaluate'] = false;
				}
			}
		}
		//开始计算该订单是否可以评论
		global $_OrderProcessId;
		if (count($icsonShipOrder) > 0) { //存在易迅订单，还需判断易迅订单的签收状况
			$order_process_flows = IOrderProcessFlowTTC::gets($icsonShipOrder, array('process_id'=> $_OrderProcessId['Done']['value']), array('order_id'));
			if (is_array($order_process_flows)) {
				foreach ($orders as $key=> &$order) {
					if (false === $order['can_evaluate']) {
						continue;
					}
					if ($order['order_date'] > 1326038400 && in_array($order['shipping_type'], self::$evaluateViaShipType)) {
						$exist = false;
						foreach ($order_process_flows as $flow) {
							if ($order['order_id'] == $flow['order_id']) {
								$exist = true;
								break;
							}
						}
						if (false === $exist) {
							$orders[$key]['can_evaluate'] = false;
						}
					}
				}
			}
		}
		//计算订单是否可评论结束

		//拉取订单对应的商品
		$order_items = IOrderItemsTTC::get($uid, array('product_type'=> 0), array('order_char_id', 'flag', 'product_id', 'product_char_id', 'name', 'buy_num'));
		if (false === $order_items) {
			self::$errCode = IOrderItemsTTC::$errCode;
			self::$errMsg = IOrderItemsTTC::$errMsg;
			return false;
		}

        foreach ($orders as &$or)
        {
			$i = 0;
			$itemCanEvaluate = false;
			$buyTotal = 0;
            foreach ($order_items as $oit)
            {
				if (strcmp($oit['order_char_id'], $or['order_char_id']) === 0) {

					if ((($oit['flag'] & ORDER_ITEM_EVALUATED) != ORDER_ITEM_EVALUATED)) {
						$itemCanEvaluate = true;
					}
					if ($i < 8) {
						$or['items'][$i]['name'] = $oit['name'];
						$or['items'][$i]['product_char_id'] = $oit['product_char_id'];
						$or['items'][$i]['product_id'] = $oit['product_id'];
						$or['items'][$i]['buy_num'] = $oit['buy_num'];
					}
					$i++;

					$buyTotal += $oit['buy_num'];
				}
			}
			if (false === $itemCanEvaluate) {
				$or['can_evaluate'] = false;
			}

			$or['buy_total'] = $buyTotal;
		}
		return array('total'=> $total, 'orders'=> $orders);
	}

	public static function getRecentOrder($uid, $num)
	{

		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";
			return false;
		}
		if (!isset($num) || $num <= 0) {
			self::$errCode = -2020;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "num[$num] is empty";
			return false;
		}
		$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
		$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
		if (empty($orderDb)) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}
		$sql = "select * from (
		select hw_id,
		order_char_id,
		flag, out_time,
		order_id,
		status,
		order_date,
		shop_guide_cost,
		pay_type,
		isPayed,
		receiver,
		shipping_cost,
		order_cost,
		coupon_code,
		coupon_amt,
		point,
		cash + prcd_cost as cash,
		shipping_type,
		stockNo,
		pOrderId,
		row_number() over (order by order_date desc) rn
		from t_orders_{$db_tab_index['table']} where uid=$uid AND (subOrderNum IS NULL OR subOrderNum=0)) tmpres
		where rn > 0 and rn <= $num";
		$orders = $orderDb->getRows($sql);
		if (false === $orders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

		$gotNum = count($orders);
		//如果最近一个月订单数量不够，则从历史订单库中取
		if ($gotNum < $num) {
			$need = $num - $gotNum;

			$orders_history = IOrdersTTC::get($uid, array('subOrderNum'=> 0), array('hw_id', 'order_char_id', 'flag', 'out_time', 'order_id', 'status', 'order_date',
				'pay_type', 'isPayed', 'receiver', 'shipping_cost', 'order_cost', 'coupon_code', 'coupon_amt', 'point', 'cash', 'prcd_cost', 'shipping_type', 'stockNo', 'pOrderId'), $need, 0);

			if (is_array($orders_history)) {
                foreach ($orders_history as $oh)
                {
					$oh['cash'] += $oh['prcd_cost'];
					$orders[] = $oh;
					$gotNum++;
				}
			}
			unset($orders_history);
		}

		//处理订单是否需要显示去支付
		global $_OrderState, $_PAY_MODE;
		foreach ($orders as $key=> &$order) {
			if (($order['status'] == $_OrderState['Origin']['value'] || $order['status'] == $_OrderState['WaitingPay']['value'] ||
				$order['status'] == $_OrderState['WaitingManagerAudit']['value']) && $_PAY_MODE[$order['hw_id']][$order['pay_type']]['IsNet'] == 1 &&
				$order['isPayed'] == 0)
			{
				$order['need_pay'] = 1;
			}
			else
			{
				$order['need_pay'] = 0;
			}

			if ( ($order['status'] == $_OrderState['Origin']['value'] && $order['isPayed'] == 0) || //货到付款类的
				(($order['status'] == $_OrderState['Origin']['value'] || $order['status'] == $_OrderState['WaitingPay']['value'] || $order['status'] == $_OrderState['WaitingManagerAudit']['value']) &&
				 (1 != $order['pay_type']) && (0 == $order['isPayed'])) )   //非货到付款类的
			{
				$order['can_cancel'] = 1;
			}
			else
			{
				$order['can_cancel'] = 0;
			}

			if (strncmp($order['coupon_code'], 'rule_', 5) == 0) { //使用的促销规则
				$order['promotion_cut'] = $order['coupon_amt'];
				unset($order['coupon_code']);
				unset($order['coupon_amt']);
			}
		}

		return array(
			'total' => $gotNum,
			'orders'=> $orders,
		);
	}

	/**
     * 获取订单出库$day天内的用户订单（只拉取用户订单和订单对应的商品，不做额外的业务逻辑）
     * @param $uid		用户uid
     * @param $day 		订单出库X天内的用户订单（default:1）
     * @param $page		分页起始页（default:0）
     * @param $pageSize 分页大小（default:5）
     */
    public static function getUserOrdersInXDays($uid, $day = 1, $page =0, $pageSize = 5){
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";
			return false;
		}
        $db_tab_index = ToolUtil::getMSDBTableIndex($uid,'ICSON_ORDER_CORE');
        $orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
        if (empty($orderDb)) {
            self::$errCode = $orderDb->errCode;
            self::$errMsg = $orderDb->errMsg;
			return false;
		}

		$now_time = time();
        $sql = "select count(*) as total_num from t_orders_{$db_tab_index['table']} where uid=$uid and (subOrderNum IS NULL OR subOrderNum=0) and out_time>=" . ($now_time - 3600*24*$day) . "";
        $total = $orderDb->getRows($sql);
        if (false === $total) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

        $total = $total[0]['total_num'];
        if ($total == 0) {
            return array('total'=>$total, 'orders'=>array());
        }
		$sql = "select * from (
		select hw_id,
		order_char_id,
		flag,
		order_id,
		status,
		order_date,
		out_time,
		shop_id,
		shop_guide_id,
		shop_guide_cost,
		pay_type,
		isPayed,
		shipping_type,
		receiver,
		receiver_mobile,
        receiver_addr,
        receiver_addr_id,
		shipping_cost,
		order_cost,
		coupon_code,
		coupon_amt,
		point,
		stockNo,
		pOrderId,
		cash + prcd_cost as cash,
		row_number() over (order by order_date desc) rn
		from t_orders_{$db_tab_index['table']} where uid=$uid ";
        $sql .= " and (subOrderNum IS NULL OR subOrderNum=0) and out_time>=" . ($now_time - 3600*24*$day) . ") tmpres
		where rn >" . $page*$pageSize . " and rn<=" .($page+1)*$pageSize ;
		$orders = $orderDb->getRows($sql);
		if (false === $orders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}
        if (count($orders) == 0) {
            return array('total'=>$total, 'orders'=>$orders);
        }

        //拉取订单对应的商品
        $sql = "select order_char_id, flag, product_id, product_char_id, name, buy_num from t_order_items_{$db_tab_index['table']} where uid=$uid and product_type=0 and order_char_id in(''";
        foreach ($orders as $o)
        {
            $sql .= ",'{$o['order_char_id']}'";
        }
        $sql .= ") order by order_char_id";


        $order_items = $orderDb->getRows($sql);
        if (false === $order_items) {
            self::$errCode = $orderDb->errCode;
            self::$errMsg = $orderDb->errMsg;
            return false;
				}
        foreach ($orders as &$or)
        {
            $i = 0;
            $itemCanEvaluate = false;
            $buyTotal = 0;
            foreach ($order_items as $oit)
            {
                if (strcmp($oit['order_char_id'] , $or['order_char_id']) === 0) {

                    if ((($oit['flag'] & ORDER_ITEM_EVALUATED) != ORDER_ITEM_EVALUATED) ) {
                        $itemCanEvaluate = true;
			}
                    if ($i < 8) {
                        $or['items'][$i]['name'] = $oit['name'];
                        $or['items'][$i]['product_char_id'] = $oit['product_char_id'];
                        $or['items'][$i]['product_id'] = $oit['product_id'];
                        $or['items'][$i]['buy_num'] = $oit['buy_num'];
                        $or['items'][$i]['flag'] = $oit['flag'];
		}
                    $i++;
                    $buyTotal+= $oit['buy_num'];
			}
			}
            if (false === $itemCanEvaluate) {
                $or['can_evaluate'] = false;
			}
            $or['buy_total'] = $buyTotal;
		}
        return array('total'=>$total, 'orders'=>$orders);
	}

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
		// 下单接口挪动到 IOrder51buy.php 里面，此处只为了兼容老代码
		$ret = IOrder51buy::placeOrder($newOrder, $wh_id);
        if(false === $ret)
        {
			IOrder::$errCode = IOrder51buy::$errCode;
			IOrder::$errMsg = IOrder51buy::$errMsg;
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
				'status' => 0)
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

    public static function geOrderFlow($uid, $order_char_id){

		if (!isset($order_char_id) || $order_char_id <= 0) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_id[$order_char_id] is empty";
			return false;
		}

		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -2020;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";
			return false;

		}

		global $_IP_CFG;

		$detail = self::getOneOrderDetail($uid, $order_char_id);
		if (false === $detail) {
			return false;
		}

		global $_StockToStation; // 出货仓所在站点
		$stockId = empty($detail['stockNo']) ? $detail['hw_id'] : $detail['stockNo'];
		$stock_siteId = $_StockToStation[$stockId];

		$url = $_IP_CFG['ORDERFLOW'][$stock_siteId] . "/InternalService/AjaxGetOrderInfo.aspx?sysno=" . $order_char_id . "&siteid=" . $stock_siteId . "&type=json";

		$res = NetUtil::cURLHTTPGet($url, 10);

		if (false === $res) {
			self::$errCode = NetUtil::$errCode;
			self::$errMsg = NetUtil::$errMsg;

			return false;
		}

		$res = ToolUtil::gbJsonDecode($res);

		if (empty($res) || !isset($res['Steps']) || !isset($res['Steps']['Step'])) {
			self::$errCode = -991;
			self::$errMsg = "ToolUtil::gbJsonDecode error: " . $res;

			return false;
		}

		if (isset($res['Steps']['Step']['Item'])) {
			$data = $res['Steps']['Step'];

			if ($data["ItemContent"] == "Order is not exist") {

				//hack
				$res['Steps']['Step'] = array(
					array(
						"Item"        => date("Y-m-d H:i:s", $detail['order_date']),
						"ItemContent" => "您提交了订单，等待客服审核。"
					)
				);
            }
            else{
				$res['Steps']['Step'] = array(
					array(
						"Item"        => $data["Item"],
						"ItemContent" => $data['ItemContent']
					)
				);
			}
		}


		$items = array();
		$total = '';
		$doNo = 0;
		$shipType = 0;

		foreach ($res['Steps']['Step'] as $index => $item) {
			if (isset($item['DoNo']) && isset($item['ShipType'])) {
				$doNo = $item['DoNo'];
				$shipType = intval($item['ShipType']);
            }
            else if ( empty( $item['Item'] ) ){
				$total = $item['ItemContent'];
            }
            else{
				$time = $item['Item'];

				if ($time === '无' && $index > 0) {
					$time = $res['Steps']['Step'][$index - 1]['Item'];
				}

				$items[] = array(
					"time"    => $item['Item'],
					"content" => $item['ItemContent']
				);
			}
		}

		$delay_info = array(
			"order_delay_status"  => 0, //订单是否延缓:1:延缓 0:为延缓
			"order_delay_type"    => 0, //订单延缓节点1:审单，2:打包，3:开票，4:分拨分单，5:分拨发货，6:配送扫描，7:用户签收
			"order_delay_mintime" => 0, //最短延缓时间(小时)
			"order_delay_maxtime" => 0, //最长延缓时间(小时)
		);

		$process_ids = array();
		$order_process_flows = IOrderProcessFlowTTC::get($detail['order_id'], array(), array('process_id')); //获取订单处理进程
		if (count($order_process_flows) > 0 && is_array($order_process_flows)) {
			foreach ($order_process_flows as $process) {
				$process_ids[] = $process['process_id'];
			}
		}

		$orderdelay_check = IOrder::orderDelayCheck($detail['order_date'], $detail['stockNo'], $detail['status'], $process_ids);
		if ($orderdelay_check === true) {
			$is_delay = IOrder::orderDelay($detail['order_char_id'], $detail['shipping_type']);
			if (isset($is_delay['errno']) && $is_delay['errno'] == 0) {
				$delay_data = (isset($is_delay['data']) && count($is_delay['data']) > 0) ? $is_delay['data'] : $delay_info;
				$delay_info['order_delay_status'] = $delay_data['order_delay_status'];
				$delay_info['order_delay_type'] = $delay_data['order_delay_type'];
				$delay_info['order_delay_mintime'] = $delay_data['order_delay_mintime'];
				$delay_info['order_delay_maxtime'] = $delay_data['order_delay_maxtime'];
			}
		}
		//收货地的区域是在上海，则为易迅快递，third_type和third_sysno此处为空，获取到的doNo为货票分离的发票运单号
		if (($detail['bits'] & ORDER_SEPARATE_GOODS_INVOICE) == ORDER_SEPARATE_GOODS_INVOICE) {
			return array(
				"total"               => $total,
				"items"               => $items,
				"third_type"          => 0,
				"third_sysno"         => 0,
				"third_type_invoice"  => YT_DELIVERY,
				"third_sysno_invoice" => "" . $doNo,
				"order_delay_status"  => $delay_info['order_delay_status'],
				"order_delay_type"    => $delay_info['order_delay_type'],
				"order_delay_mintime" => $delay_info['order_delay_mintime'],
				"order_delay_maxtime" => $delay_info['order_delay_maxtime'],
				"is_icson_delivery"   => ($detail['shipping_type'] == ICSON_DELIVERY) ? true : false,
			);
		}
		return array(
			"total"               => $total,
			"items"               => $items,
			"third_type"          => $shipType,
			"third_sysno"         => $doNo,
			"order_delay_status"  => $delay_info['order_delay_status'],
			"order_delay_type"    => $delay_info['order_delay_type'],
			"order_delay_mintime" => $delay_info['order_delay_mintime'],
			"order_delay_maxtime" => $delay_info['order_delay_maxtime'],
			"is_icson_delivery"   => ($detail['shipping_type'] == ICSON_DELIVERY) ? true : false,
		);

	}

    public static function getThirdOrderFlow($type_id, $sysno){
		if (!isset($type_id) || $type_id <= 0) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "type_id[$type_id] is empty";
			return false;
		}

		if (!isset($sysno)) {
			self::$errCode = -2020;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "sysno[$sysno] is empty";
			return false;

		}

		$DeliveryConfig = array('YUANTONG' => 1, 'SHENTONG' => 2, 'XINCHENJIBIAN' => 3);

		/*
					  1---圆通快递
					  2---申通快递（2012-02-06开始使用）
					  3---第3方易迅快递（即星辰急便）
				  */

		$flow = array();

		//圆通快递测试: [1697371630]运单号
		if ($DeliveryConfig['YUANTONG'] == $type_id) {
			$xmlData = mb_convert_encoding(str_replace('{sysno_holder}', $sysno, self::$ytoRequestTpl), 'UTF-8', 'GBK');
			$data_digest = urlencode(base64_encode(md5($xmlData . self::$ytoPartnerId, true))); //圆通加密方式
			$data = "logistics_interface={$xmlData}&data_digest={$data_digest}"; //圆通请求数据格式

			$header = array('Content-type: application/x-www-form-urlencoded;charset=UTF-8');
			$response = NetUtil::cURLHTTPPost(self::$ytoRequestUrl, $data, 15, self::$ytoRequestHost, $header);
			if (false === $response) {
				self::$errCode = NetUtil::$errCode;
				self::$errMsg = NetUtil::$errMsg;
				return false;
			}

			$res = simplexml_load_string($response);
			$res = self::_objectToArray($res);
			$res = self::_Utf2Gbk($res);

			if (!isset($res['orders'])) {
				self::$errCode = -990;
				self::$errMsg = "数据格式错误[sysno:$sysno] : " . $response;
				return false;
			}

			$flow[] = array(
				'time'    => '运单号：' . $sysno,
				'content' => '承运人：圆通快递'
			);
			if (!empty($res) && isset($res['orders']) && isset($res['orders']['order']) && count($res['orders']['order']) > 0) {
				//只有一条流水的特殊处理
				if (isset($res['orders']['order']['steps']['step']['acceptTime'])) {
					$item = $res['orders']['order']['steps']['step'];
					$flow[] = array(
						'time'    => substr($item['acceptTime'], 0, strpos($item['acceptTime'], '.')),
						'content' => $item['acceptAddress'] . ' ' . $item['remark'],
					);
                }
                else{
					foreach ($res['orders']['order']['steps']['step'] as $item) {
						$flow[] = array(
							'time'    => substr($item['acceptTime'], 0, strpos($item['acceptTime'], '.')),
							'content' => $item['acceptAddress'] . ' ' . $item['remark'],
						);
					}
				}
            }
            else{
				self::$errCode = -991;
				self::$errMsg = "数据格式错误 [sysno:$sysno]: " . $response;
				return false;
			}
        }
        //星辰急便
		else if ($DeliveryConfig['XINCHENJIBIAN'] === $type_id) {

			$xmlData = '<BatchQueryRequest>';
			$xmlData .= '<logisticProviderID>icson</logisticProviderID>';
			$xmlData .= '<orders>';
			$xmlData .= '<order>';
			$xmlData .= '<mailNo>';
			$xmlData .= $sysno;
			$xmlData .= '</mailNo>';
			$xmlData .= '</order>';
			$xmlData .= '</orders>';
			$xmlData .= '</BatchQueryRequest>';

			$data = "xmlData=$xmlData&MD5Data=" . md5($xmlData . '2011');

			$response = NetUtil::cURLHTTPPost("http://218.241.154.234/WEBInterface/8760975/RequestSearch/do", $data, 15, ' web.stars-exp.com');

			if (false === $response) {
				self::$errCode = NetUtil::$errCode;
				self::$errMsg = NetUtil::$errMsg;

				return false;
			}

			$res = simplexml_load_string($response);
			$res = self::_objectToArray($res);
			$res = self::_Utf2Gbk($res);

			if (!isset($res['orders'])) {
				self::$errCode = -9912;
				self::$errMsg = "数据格式错误[sysno:$sysno] : " . $response;

				return false;
			}

			$flow[] = array(
				'time'    => '运单号：' . $sysno,
				'content' => '承运人：星辰急便'
			);

			foreach ($res['orders']['order']['steps']['step'] as $item) {
				$flow[] = array(
					'time'    => $item['acceptTime'],
					'content' => $item['remark'],
				);
			}
        }
        //申通快递 测试单号:468235346764;468285730397[运单号]
		else if ($DeliveryConfig['SHENTONG'] === $type_id) {
			$response = NetUtil::cURLHTTPGet("http://58.40.18.21/track.aspx?billcode=$sysno", 15, '58.40.18.21');
			if (false === $response) {
				self::$errCode = NetUtil::$errCode;
				self::$errMsg = NetUtil::$errMsg;

				return false;
			}

			$res = simplexml_load_string($response);
			$res = self::_objectToArray($res);
			$res = self::_Utf2Gbk($res);

			if (!isset($res['track'])) {
				self::$errCode = -9913;
				self::$errMsg = "数据格式错误[sysno:$sysno] : " . $response;

				return false;
			}

			$flow[] = array(
				'time'    => '运单号：' . $sysno,
				'content' => '承运人：申通快递'
			);
			if (isset($res['track']) && !empty($res['track']) && isset($res['track']['detail']) && !empty($res['track']['detail'])) {
				foreach ($res['track']['detail'] as $item) {
					$flow[] = array(
						'time'    => str_replace("/", "-", $item['time']),
						'content' => $item['memo'],
					);
				}
			}
        }
        else{
			self::$errCode = -993;
			self::$errMsg = "未知的三方快递公司";

			return false;
		}

		return $flow;

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

	/*
			 type 发票类型
			 stockNo 所属分仓
			 使用前请保证发票类型正确
		 */
	public static function ConvertInvoiceType($type, $stockNo, $buy_wh_id)
	{
		global $_StockToStation;
		// 出货仓所在站点

        if ( !isset($_StockToStation[$stockNo]) )
        {
			self::$errMsg = "ConvertInvoiceType 仓库没有对应分站";
			return false;
		}

		$stock_wh_id = $_StockToStation[$stockNo];

		//用户在上海站（北京，武汉）选择类型1或者3的发票，货物从广东站出仓，需要转换成类型4，入广东的IAS。
		if ($buy_wh_id != SITE_SZ && $stock_wh_id == SITE_SZ &&
            ( $type == INVOICE_TYPE_RETAIL_PERSONAL || $type == INVOICE_TYPE_RETAIL_COMPANY ) )
        {
			return INVOICE_TYPE_VAT_NORMAL;
		}

		//用户在广东选择类型4的发票，需要转换成类型1，货物从上海站（北京，武汉）出仓，入上海站（北京，武汉）的IAS。
        if ( $buy_wh_id == SITE_SZ && $stock_wh_id != SITE_SZ && $type == INVOICE_TYPE_VAT_NORMAL )
        {
			return INVOICE_TYPE_RETAIL_PERSONAL;
		}

		// 如果是其他，则不转换
		return $type;
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
	 * 根据 pOrderId & subOrderNum 计算父子订单关系
	 * @param array $order 订单信息
	 * @return null
	 */
	public static function appendSubOrderIds(&$order)
	{
		if (isset($order['pOrderId']) && isset($order['subOrderNum'])) { //根据 pOrderId & subOrderNum 计算父子订单关系
			$order['subOrderIds'] = array();

			if ($order['pOrderId'] == $order['order_char_id']) { //
				if (intval($order['subOrderNum']) > 0) {
					$order['subOrderIds'] = range(($order['pOrderId'] + 1), intval($order['pOrderId']) + intval($order['subOrderNum'])); //子订单ID计算规则
				} else {
					//empty
				}
			} else { //当前订单为子订单
				//empty
			}
		}
	}

	/**
	 * 根据订单号判断该订单是否延缓
	 * @param int $orders_char_id 订单号
	 * @param int $shipping_type 快递方式
	 */
	public static function orderDelay($orders_char_id, $shipping_type){
		$delay_info = array(
			"order_delay_status"  => 0, //订单是否延缓:1:延缓 0:为延缓
			"order_delay_type"    => 0, //订单延缓节点1:审单，2:打包，3:开票，4:分拨分单，5:分拨发货，6:配送扫描，7:用户签收
			"order_delay_mintime" => 0, //最短延缓时间(小时)
			"order_delay_maxtime" => 0, //最长延缓时间(小时)
		);
		if (!isset($orders_char_id) || $orders_char_id <= 0 || !isset($shipping_type)) {
			self::$errCode = IDelayOrderTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[orders_char_id or shipping_type is empty] order_char_id:' . $orders_char_id . ' shipping_type:' . $shipping_type;
			Logger::info(self::$errMsg . ' errcode:' . self::$errCode . ' errmsg:' . IDelayOrderTTC::$errMsg);
			return array('errno'=> 1);
		} else {
			//1016930625;1012414107
			$get_delay = IDelayOrderTTC::get($orders_char_id, array(), array());
			if ($get_delay === false) {
				self::$errCode = IDelayOrderTTC::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[DelayOrderTTC::get failed ] order_char_id:' . $orders_char_id;
				Logger::info(self::$errMsg . ' errcode:' . self::$errCode . ' errmsg:' . IDelayOrderTTC::$errMsg);
				return array('errno'=> 2);
			}

			if (is_array($get_delay) && count($get_delay) > 0) {
				global $_OrderDelayStock;
				$get_delay = $get_delay[0];

				$CheckQtyTime = strtotime(date('Ymd', $get_delay['CheckQtyTime'])); //打包时间
				$DeliverPackageTime = strtotime(date('Ymd', $get_delay['DeliverPackageTime'])); //分拨发货时间
				$ReceiveTime = strtotime(date('Ymd', $get_delay['ReceiveTime'])); //配送扫描时间

				$AuditDeliveryDate = $get_delay['AuditDeliveryDate']; //审核配送时间
				$AuditDeliveryTimeSpan = intval($get_delay['AuditDeliveryTimeSpan']); //审核配送时间节点


				$StockPackTimeDemand = $get_delay['StockPackTimeDemand']; //打包时间节点
				$DeliverPackageDemand = $get_delay['DeliverPackageDemand']; //分拨发货节点
				$DistributionScanDemand = $get_delay['DistributionScanDemand']; //配送扫描节点

				//是否打包延缓
				if (($get_delay['IsDelayStockPackTime'] == 1)
					&& ($CheckQtyTime == 946656000) //2000-01-01 00:00:00 946656000
					&& (($shipping_type == YT_DELIVERY) || ($shipping_type == EMS_DELIVERY) || ($shipping_type == EYB_DELIVERY))
					&& (in_array($get_delay['StockNo'], $_OrderDelayStock))
					//&& ($AuditDeliveryDate - $StockPackTimeDemand <= 432000) //5天120个小时 5*12*3600=432000
				) {
					$delay_info['order_delay_status'] = 1;
					$delay_info['order_delay_type'] = 2; //打包延缓
					$delay_info['order_delay_mintime'] = 0;
					$delay_info['order_delay_maxtime'] = 0;
				}

				//是否分拨发货延缓
				if (($get_delay['IsDelayDeliverPackage'] == 1)
					&& ($DeliverPackageTime == 946656000) //2000-01-01 00:00:00 946656000
					&& (($shipping_type != YT_DELIVERY) && ($shipping_type != EMS_DELIVERY) && ($shipping_type != EYB_DELIVERY))
					&& (in_array($get_delay['StockNo'], $_OrderDelayStock))
					//&& ($AuditDeliveryDate - $StockPackTimeDemand <= 432000) //5天120个小时 5*24*3600=432000
				) {
					$delay_info['order_delay_status'] = 1;
					$delay_info['order_delay_type'] = 5; //分拨发货延缓
					$delay_info['order_delay_mintime'] = ($shipping_type == ICSON_DELIVERY) ? 12 : 0;
					$delay_info['order_delay_maxtime'] = ($shipping_type == ICSON_DELIVERY) ? 72 : 0;
				}

				//是否配送扫描延缓
				if (($get_delay['IsDelayDistributionScan'] == 1)
					&& ($ReceiveTime == 946656000) //2000-01-01 00:00:00 946656000
					&& (($shipping_type != YT_DELIVERY) && ($shipping_type != EMS_DELIVERY) && ($shipping_type != EYB_DELIVERY))
					&& (in_array($get_delay['StockNo'], $_OrderDelayStock))
					//&& ($AuditDeliveryDate - $StockPackTimeDemand <= 432000) //5天120个小时 5*24*3600=432000
				) {
					$delay_info['order_delay_status'] = 1;
					$delay_info['order_delay_type'] = 6; //配送扫描延缓
					$delay_info['order_delay_mintime'] = ($shipping_type == ICSON_DELIVERY) ? 12 : 0;
					$delay_info['order_delay_maxtime'] = ($shipping_type == ICSON_DELIVERY) ? 72 : 0;
				}
			}

			return array('errno'=> 0, 'data'=> $delay_info);
		}
	}

	/**
	 * 拉取订单延缓接口前置条件检查
	 *接口请求前置条件（各条件是且的关系）
	 *1.订单提交时间为30天内的      //过滤非近期订单
	 *2.出货仓=上海    //过滤缺失延缓数据的订单
	 *3.订单状态orderstate=（1,待出库），或=（4，已出库）且未收到结算态 //过滤作废、退款、待审核、已结算的订单
	 * @param int $order_date 下单日期
	 * @param int $stockNo 分仓编号
	 * @param int $status 订单状态
	 * @param int $process_id 订单处理进程
	 * @return bool false :检查不通过,true:通过检查
	 */
	public static function orderDelayCheck($order_date, $stockNo, $status, $process_ids = array()){
		if (!ORDER_DELAY_ENTERANCE || (ORDER_DELAY_ENTERANCE == 0)) { //如果尚未开启
			return false;
		}

		global $_OrderState, $_OrderDelayStock, $_OrderProcessId;
		$order_flow_sign = true;
		if (is_array($process_ids) && count($process_ids) > 0) {
			foreach ($process_ids as $p) {
				if (($p == $_OrderProcessId['Sign']['value']) || ($p == $_OrderProcessId['Done']['value'])) {
					$order_flow_sign = false;
				}
			}
		}

		$now = strtotime(date('Y-m-d'));
		$order_date = strtotime(date('Y-m-d', $order_date));
		if (($now - $order_date < 2592000) //2592000=30*24*3600
			&& in_array($stockNo, $_OrderDelayStock)
			&& ($status == $_OrderState['WaitingOutStock']['value'])
			|| ($status == $_OrderState['OutStock']['value'])
				&& ($order_flow_sign == true)
		) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * 计算父订单状态，是否显示合并支付连接
	 * @param array $subOrders
	 * @return mixed string 计算父订单状态成功；false 父订单状态无法计算
	 */
	public static function computeParentOrderPayStatus(&$subOrders)
	{
		if (empty($subOrders)) {
			return false;
		}

		global $_OrderState, $_PAY_MODE;
		$onlinePayStatus = array(
			$_OrderState['Origin']['value'],
			$_OrderState['WaitingManagerAudit']['value'],
			$_OrderState['WaitingPay']['value'],
		);

		$ret = true;
		foreach ($subOrders as &$order) {
			if (in_array($order['status'], $onlinePayStatus)
				&& $_PAY_MODE[$order['hw_id']][$order['pay_type']]['IsNet'] == 1 //支付方式
				&& $order['isPayed'] == 0
			) {

				// do nothing
			} else {
				$ret = false;
				break;
			}
		}

		return $ret;
	}

	/**
	 * @static
	 * @param $orderInfo
	 * @return bool
	 */
	public static function checkCanCancel(&$orderInfo)
	{
		//处理参数
		if(isset($orderInfo['status']) && isset($orderInfo['isPayed']) && isset($orderInfo['pay_type']) && isset($orderInfo['hw_id']) )
		{
			$status = $orderInfo['status'];
			$isPayed = $orderInfo['isPayed'];
			$pay_type = $orderInfo['pay_type'];
		}
		else
		{
			return false;
		}

		$can_cancel = false;
		global $_OrderState, $_PAY_MODE;
		$onlinePayStatus = array(
			$_OrderState['Origin']['value'],
			$_OrderState['WaitingManagerAudit']['value'],
			$_OrderState['WaitingPay']['value'],
		);

		//如果是货到付款，则需要订单是待审核状态;如果是在线支付，则可以是待审核，待主管审核，待支付状态
		if((($status == $_OrderState['Origin']['value']) && (0 == $isPayed)) ||
			(in_array($status,$onlinePayStatus) && (1 != $pay_type) && (0 == $isPayed)))
		{
			$can_cancel = true;
		}

		return $can_cancel;
	}

	/**
	 * 获取一个货票分离订单的发票地址信息
	 * @param int $uid
	 * @param int $order_id
	 * @return mixed Array 订单信息; false 失败
	 */
	public static function getOneInvoiceAddress($uid, $order_id)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";
			return false;
		}
		if (!isset($order_id) || $order_id == "") {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_id[$order_id] is empty";
			return false;
		}

		$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
		$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
		if (empty($orderDb)) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}
		$order = array();
		//是货票分离订单flycgu
		$order['invoice_send_status'] = "invoice_hide";
		$order['separateInvoice'] = 0;

		$sql = "select * from t_order_invoice_address_{$db_tab_index['table']} where uid=$uid and order_char_id='$order_id'";
		$invoice_address = $orderDb->getRows($sql);
		if (false === $invoice_address) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}
		else if (count($invoice_address) == 0){
			self::$errCode = -999;
			self::$errMsg = "发票地址不存在";
			return false;
		}
		else {
			$order['separateInvoice'] = 1;
			$order['invoice_send_status'] = "invoice_show";
			$order['invoiceReceiver'] = $invoice_address[0]['receiver'];
			$order['invoiceReceiverTel'] = $invoice_address[0]['receiver_tel'];
			$order['invoiceReceiverMobile'] = $invoice_address[0]['receiver_mobile'];
			$order['invoiceReceiveAddrDetail'] = $invoice_address[0]['receiver_addr'];
			$order['invoiceReceiveAddrId'] = $invoice_address[0]['receiver_addr_id'];
			$order['invoiceZipCode'] = $invoice_address[0]['receiver_zip'];
		}

		//货票分离结束
		Logger::info(var_export($order, true));
		return $order;
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