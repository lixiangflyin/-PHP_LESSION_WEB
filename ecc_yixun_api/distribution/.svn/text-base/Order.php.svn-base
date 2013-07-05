<?php
/**
	admin/api 平台下对分销订单的操作集
	
*/
class LIB_Order {
	public static $errCode = 0;
	public static $errMsg = '';
	public static $DBName = "orders";
	public static $_OrderState = array ( 
			'RetailerAudit' => array (
					'value' => -8,
					'desc' => '待商家审核',
					'siteName' => '待审核' 
			),
			'SailerAudit' => array (
					'value' => -7,
					'desc' => '待经理审核',
					'siteName' => '待审核' 
			),
			'ManagerAudit' => array (
					'value' => -6,
					'desc' => '待总监审核',
					'siteName' => '待审核' 
			),
			'PartlyReturn' => array (
					'value' => -5,
					'desc' => '部分退货',
					'siteName' => '部分退货' 
			),
			'Return' => array (
					'value' => -4,
					'desc' => '全部退货',
					'siteName' => '全部退货' 
			),
			'ManagerCancel' => array (
					'value' => -3,
					'desc' => '系统作废',
					'siteName' => '系统作废' 
			),
			'CustomerCancel' => array (
					'value' => -2,
					'desc' => '客户作废',
					'siteName' => '客户作废' 
			),
			'EmployeeCancel' => array (
					'value' => -1,
					'desc' => '员工作废',
					'siteName' => '员工作废' 
			),
			'Origin' => array (
					'value' => 0,
					'desc' => '待审核',
					'siteName' => '待审核' 
			),
			'WaitingOutStock' => array (
					'value' => 1,
					'desc' => '待出库',
					'siteName' => '待出库' 
			),
			'WaitingPay' => array (
					'value' => 2,
					'desc' => '待支付',
					'siteName' => '待支付' 
			),
			'WaitingManagerAudit' => array (
					'value' => 3,
					'desc' => '待主管审',
					'siteName' => '待审核' 
			),
			'OutStock' => array (
					'value' => 4,
					'desc' => '已出库',
					'siteName' => '已出库' 
			) 
	);
	public static $OrderState = array (
			- 8 => '待商家审核',
			- 7 => '待经理审核',
			- 6 => '待总监审核',
			- 5 => '部分退货',
			- 4 => '全部退货',
			- 3 => '系统作废',
			- 2 => '客户作废',
			- 1 => '员工作废',
			0 => '待审核',
			1 => '待出库',
			2 => '待支付',
			3 => '待主管审',
			4 => '已出库' 
	);
	const DISPLAY_VERIFY_CODE = false;
	const INVOICE_TYPE_RETAIL_PERSONAL = 1; // 商业零售发票(个人)
	const INVOICE_TYPE_RETAIL_COMPANY = 3; // 商业零售发票(公司)
	const INVOICE_TYPE_VAT = 2; // 增值税发票
	const INVOICE_TYPE_VAT_NORMAL = 4; // 增值税普通发票
	const INVOICE_TYPE_CP_UNICOM = 5; // 联通定额发票
	const INVOICE_TYPE_CP_TELCOM = 6; // 电信定额发票
	const INVOICE_TYPE_CP_MOBILE = 7; // 移动定额发票
	const INVOICE_TYPE_VAT_NORMAL_NEW = 8; // 增值税普通发票,替代发票类型ID为4
	const INVOICE_TYPE_TITLE = 9; // 冠名发票
	const  PC_ORDER = 888888;  //特殊的shopguideId 表明不同的下单来源
	/*
	 * @name	getRowCount @desc	根据要求获取符合条件的订单数量
	 */
	public static function getRowCount($condition, $func = true) {

		if (!$func) {
			$orderDB = Config::getDB(self::$DBName);

			if (empty($orderDB)) {
				self::$errCode = Config::$errCode;
				self::$errMsg = Config::$errMsg;
				return false;
			}

	 		if (!empty($condition)){
	 			$condition = 'subOrderNum=0 and ' . $condition;
	 		}
			$ret = $orderDB->getRowsCount('t_orders', $condition);
		}
		else {
			$ret = self::$condition();
			$ret = $ret['total'];
		}
		

		return $ret;
	}
	
	/*
	 * @name	get_minus_profit_orders() @desc	获取负毛利订单数量
	 */
	public static function get_minus_profit_orders()
	{
		$orderDB = Config::getDB(self::$DBName);
		
		if (empty($orderDB)) {
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;
			return false;
		}
		$sql = 'SELECT * FROM t_orders';
		$orders = $orderDB->getRows($sql);
		$ret = array();
		$ret['total'] = 0;
		$ret['data'] = array();
		
		//获取每笔订单的分销总价
		foreach($orders as $i => $order_arr) {
			$revenue = self::get_retail_revenue($order_arr['uid'], $order_arr['order_char_id']);

			if ($order_arr['order_cost'] - $revenue < 0){
				++$ret['total'];
				$ret['data'][] = $order_arr;
			}
		}
		return $ret;
	}
	
	/*
	 * @name	get_minus_profit_count() @desc	获取订单的业务成本
	 */
	public static function get_retail_revenue($uid, $order_char_id)
	{
		$orderItems = IRetailerOrderItemsTTC::get($uid, array('order_char_id' => $order_char_id));
		if (false === $orderItems || count($orderItems) == 0)
		{
			$errmsg = IRetailerOrderItemsTTC::$errMsg;
			$errcode = IRetailerOrderItemsTTC::$errCode;
			EL_Flow::getInstance('RetailerOrder')->append("order_char_id:{$order_char_id} 订单异常，获取订单商品数据失败，{$errcode}:{$errmsg}");
			//continue;
		}
		$business_unit_cost = 0;//计算分销总价
		foreach ($orderItems AS $orderItem)
		{
			$business_unit_cost += $orderItem['business_unit_cost'] * $orderItem['buy_num'];
		}
		
		return $business_unit_cost;
	}

	/*
	 * @name	getOrdersByCondition @desc	根据要求获取符合条件的订单数量
	 */
	public static function getOrdersByCondition($condition, $page_no, $page_size, $func) 
	{
		$start = ($page_no - 1) * $page_size;
		if (!$func) {
			$orderDB = Config::getDB(self::$DBName);

			if (empty($orderDB)) {
				self::$errCode = Config::$errCode;
				self::$errMsg = Config::$errMsg;
				return false;
			}
			if (!empty($condition)){
				$condition = 'subOrderNum=0 and ' . $condition;
			}
			
			$sql = 'SELECT * FROM t_orders WHERE ' . $condition . ' LIMIT ' . $start . ',' . $page_size;
			$ret['data'] = $orderDB->getRows($sql);
			$ret['total'] = $orderDB->getRowsCount('t_orders', $condition);

			return $ret;
		}
		else {
			$ret = self::$condition();
			$ret['data'] = array_slice($ret['data'], $start, $page_size);
			
			return $ret;
		}
	}

	
	/*
	 * @name	addOrder @desc	添加一个订单(测试用，线上业务慎用)
	*/
	public static function addOrder($order) {
	
		$orderDB = Config::getDB(self::$DBName);
	
		if (empty($orderDB)) {
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;
			return false;
		}
	
		$ret = $orderDB->insert('t_orders', $order);
		if (!$ret)
		{
			self::$errCode = $orderDB->errCode;
			self::$errMsg = $orderDB->errMsg;
			return false;
		}
	
		return true;
	}
	
	/*
	 * @name	getOrderInvoice @desc	获得订单发票 @para	uid，用户id @para	order_id，订单id
	 */
	public static function getOrderInvoice($order_id) {
		if (! isset ( $order_id ) || $order_id == "") {
			self::$errCode = - 2019;
			self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "order_id[$order_id] is empty";
			return false;
		}
		
		$orderDb = Config::getDB ( self::$DBName );
		if (empty ( $orderDb )) {
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;
			return false;
		}
		
		// 拉取发票信息
		$sql = "select title, type, name, addr, phone, taxno, bankno, bankname, content from t_order_invoice where order_char_id='$order_id' ";
		$order_invoice = $orderDb->getRows ( $sql );
		if (false === $order_invoice) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}
		
		if (count ( $order_invoice ) < 1) {
			self::$errCode = - 2021;
			self::$errMsg = '该订单发票信息不存在';
			return false;
		}
		
		foreach ( $order_invoice as &$oi ) {
			$oi ['type_id'] = $oi ['type'];
			if ($oi ['type'] == INVOICE_TYPE_RETAIL_COMPANY) {
				$oi ['type'] = "商业零售发票(单位)";
			} else if ($oi ['type'] == INVOICE_TYPE_VAT) {
				$oi ['type'] = "增值税专业发票";
			} else if ($oi ['type'] == INVOICE_TYPE_VAT_NORMAL) {
				$oi ['type'] = "增值税普通发票";
			} else {
				$oi ['type'] = "商业零售发票(个人)";
			}
		}
		
		return $order_invoice;
	}
	
	/*
	 * @name	setOrderCanceled @desc	取消订单 @para	uid，用户id @para	order_id，订单id
	 */
	public static function setOrderCanceled($uid, $order_id, $status) {
		$ip = Config::getIP ( "OrderManager" );
		$addr = explode ( ":", $ip );
		if ((false === $addr) || ! is_array ( $addr ) || (count ( $addr ) < 2)) {
			self::$errCode = 100;
			self::$errMsg = 'get order spp ip config failed';
			return false;
		}
		
		$json = array (
				'cmd' => 2,
				'orderId' => $order_id,
				'status' => $status,
				'uid' => $uid 
		);
		
		$rspStr = NetUtil::tcpCmd ( $addr [0], $addr [1], ToolUtil::gbJsonEncode ( $json ) . "\r\n", 1, 1, "\r\n" );
		return $rspStr;
		if (false == $rspStr) {
			self::$errCode = 19;
			self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "[send package to order svr timeout]";
			return false;
		}
		// $rspStr = preg_replace("/,}}$/", "}}", $rspStr);
		$ret = ToolUtil::gbJsonDecode ( $rspStr );
		
		return $ret;
	}
	
	/**
	 * 订单销售经理审核通过
	 * @para uid，用户id
	 * @para order_id，订单id
	 * 
	 * @name setOrderPassByManager
	 */
	public static function setOrderPassByManager($uid, $order_id) {
		$ip = Config::getIP ( "OrderManager" );
		$addr = explode ( ":", $ip );
		if ((false === $addr) || ! is_array ( $addr ) || (count ( $addr ) < 2)) {
			self::$errCode = 100;
			self::$errMsg = 'get order spp ip config failed';
			return false;
		}
		
		$json = array (
				'cmd' => 8,
				'orderId' => $order_id,
				'uid' => $uid,
		);
		
		$rspStr = NetUtil::tcpCmd ( $addr [0], $addr [1], ToolUtil::gbJsonEncode ( $json ) . "\r\n", 1, 1, "\r\n" );
		
		if (false == $rspStr) {
			self::$errCode = 19;
			self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "[send package to order svr timeout]";
			return false;
		}
		// $rspStr = preg_replace("/,}}$/", "}}", $rspStr);
		$ret = ToolUtil::gbJsonDecode ( $rspStr );
		
		return $ret;
	}
	
	public static function setOrderPassByDirector($uid, $order_id) {
		$ip = Config::getIP ( "OrderManager" );
		$addr = explode ( ":", $ip );
		if ((false === $addr) || ! is_array ( $addr ) || (count ( $addr ) < 2)) {
			self::$errCode = 100;
			self::$errMsg = 'get order spp ip config failed';
			return false;
		}
	
		$json = array (
				'cmd' => 16,
				'orderId' => $order_id,
				'uid' => $uid,
		);
	
		$rspStr = NetUtil::tcpCmd ( $addr [0], $addr [1], ToolUtil::gbJsonEncode ( $json ) . "\r\n", 1, 1, "\r\n" );
	
		if (false == $rspStr) {
			self::$errCode = 19;
			self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "[send package to order svr timeout]";
			return false;
		}
		// $rspStr = preg_replace("/,}}$/", "}}", $rspStr);
		$ret = ToolUtil::gbJsonDecode ( $rspStr );
	
		return $ret;
	}
	/*
	 * @name	getOneOrderDetail @desc	获取一个订单的信息 @para	order_id，订单id
	 */
	public static function getOneOrderDetail($order_id) {
		if (! isset ( $order_id ) || $order_id == "") {
			self::$errCode = - 2019;
			self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "order_id[$order_id] is empty";
			return false;
		}
		
		$orderDb = Config::getDB ( self::$DBName );
		if (empty ( $orderDb )) {
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;
			return false;
		}
		$sql = "select * from t_orders where order_char_id='$order_id' ";
		$orders = $orderDb->getRows ( $sql );
		if (false === $orders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}
		
		if (count ( $orders ) == 0) {
			self::$errCode = - 999;
			self::$errMsg = "订单不存在";
			return false;
		}
		$orders [0] ['cash'] += $orders [0] ['prcd_cost'];
		
		$order = &$orders [0];
		
		global $_District, $_Province, $_City;
		@$order ['receiver_addr'] = ($_Province [$_District [$order ['receiver_addr_id']] ['province_id']] . $_City [$_District [$order ['receiver_addr_id']] ['city_id']] ['name'] . $_District [$order ['receiver_addr_id']] ['name'] . $order ['receiver_addr']);
		
		//if ($order ['shipping_type'] == ICSON_DELIVERY) { // 易迅快递才有效
			$order ['expect_dly_date'] = date ( "Y年m月d日", $order ['expect_dly_date'] );
			if ($order ['expect_dly_time_span'] == 1) {
				$order ['expect_dly_time_span'] = "上午 9:00-14:00";
				$order ['expect_dly_time_span'] = "上午 09:00-14:00";
			} else if ($order ['expect_dly_time_span'] == 2) {
				$order ['expect_dly_time_span'] = "下午 14:00-18:00";
			} else if ($order ['expect_dly_time_span'] == 3) {
				$order ['expect_dly_time_span'] = "晚上 18:00-22:00";
			}
			else $order ['expect_dly_time_span'] = '--';
		//}
		
		global $_PAY_MODE;
		
		if (($order ['status'] == self::$_OrderState ['Origin'] ['value'] || $order ['status'] == self::$_OrderState ['WaitingPay'] ['value'] || $order ['status'] == self::$_OrderState ['WaitingManagerAudit'] ['value']) && $_PAY_MODE [$order ['hw_id']] [$order ['pay_type']] ['IsNet'] == 1 && $order ['isPayed'] == 0) {
			$order ['need_pay'] = 1;
		} else {
			$order ['need_pay'] = 0;
		}
		
		if ($order ['status'] == self::$_OrderState ['Origin'] ['value'] && $order ['isPayed'] == 0) {
			$order ['can_cancel'] = 1;
		} else {
			$order ['can_cancel'] = 0;
		}
		
		// 拉取订单对应的商品
		$sql = "select * from t_order_items  where order_char_id='$order_id' ";
		$order_items = $orderDb->getRows ( $sql );
		if (false === $orders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}
		
		foreach ( $order_items as $oit ) {
			$oit ['can_evaluate'] = false;
			$oit ['is_evaluated'] = false;
			if ($oit ['product_type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL) {
				
				if (($oit ['flag'] & ORDER_ITEM_EVALUATED) == ORDER_ITEM_EVALUATED) {
					$oit ['is_evaluated'] = true;
				}
				$order ['items'] [$oit ['product_id']] = $oit;
			} else {
				if ($oit ['product_type'] == SHOPPING_CART_PRODUCT_TYPE_ZUJIAN) {
					$oit ['product_type'] = "组件";
				} else {
					$oit ['product_type'] = "赠品";
				}
				$order ['items'] [$oit ['main_product_id']] ['gift'] [] = $oit;
			}
		}
		
		// 拉取发票信息
		$sql = "select title, type, name, addr, phone, taxno, bankno, bankname, content from t_order_invoice where order_char_id='$order_id' ";
		$order_invoice = $orderDb->getRows ( $sql );
		if (false === $order_invoice) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}
		
		foreach ( $order_invoice as $oi ) {
			$oi ['type_id'] = $oi ['type'];
			if ($oi ['type'] == self::INVOICE_TYPE_RETAIL_COMPANY) {
				$oi ['type'] = "商业零售发票(单位)";
			} else if ($oi ['type'] == self::INVOICE_TYPE_VAT) {
				$oi ['type'] = "增值税专业发票";
			} else if ($oi ['type'] == self::INVOICE_TYPE_VAT_NORMAL) {
				$oi ['type'] = "增值税普通发票";
			} else if ($oi ['type'] == self::INVOICE_TYPE_CP_UNICOM) {
				$oi ['type'] = "联通统一发票";
			} else if ($oi ['type'] == self::INVOICE_TYPE_CP_TELCOM) {
				$oi ['type'] = "电信统一发票";
			} else if ($oi ['type'] == self::INVOICE_TYPE_CP_MOBILE) {
				$oi ['type'] = "移动统一发票";
			} else {
				$oi ['type'] = "商业零售发票(个人)";
			}
			$order ['invoices'] = $oi;
		}
		
		$order ['is_hide_invoices'] = empty ( $order ['is_vat'] ) ? 1 : 0;
		
		// 获取c客户信息
		if ($order ['customer_mobile'] != '') {
			$customerMobile = $order ['customer_mobile'];
			$customer = IBCustom::getCustomPage ( $order ['uid'], array (
					'mobile' => $customerMobile 
			), 1 );
			if (false === $customer) {
				self::$errCode = IBCustom::$errCode;
				self::$errMsg = IBCustom::$errMsg;
				Logger::err ( "IBCustom::getCustomPage faild-" . IBCustom::$errCode . "-" . IBCustom::$errMsg . basename ( __FILE__, '.php' ) . " |" . __LINE__ );
			}
			if (0 == $customer ['count']) {
				Logger::err ( "C用户信息不存在或已删除" . basename ( __FILE__, '.php' ) . " |" . __LINE__ );
			} else {
				$order ['customerInfo'] = $customer ['data'] [0];
			}
		}
		return $order;
	}
	public static function getOneOrder($order_id) {
		if (! isset ( $order_id ) || $order_id == "") {
			self::$errCode = - 2020;
			self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "order_id[$order_id] is empty";
			return false;
		}
		
		$orderDb = Config::getDB ( self::$DBName );
		if (empty ( $orderDb )) {
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;
			return false;
		}
		$sql = "select * from t_orders where order_char_id='$order_id' ";
		$orders = $orderDb->getRows ( $sql );
		if (false === $orders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}
		if (count ( $orders ) == 0) {
			self::$errCode = - 2020;
			self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "no such orders";
			return false;
		}
		$order = $orders [0];
		$order ['cash'] += $order ['prcd_cost'];
		
		if (! empty ( $order ['single_promotion_info'] )) {
			$order ['single_promotion_info'] = explode ( ';', $order ['single_promotion_info'] );
		}
		
		return $order;
	}
	
	/**
	 * 根据输入条件，找出uid
	 * 
	 * @param
	 *        	filter = array('icsonid','conpanyName')
	 */
	public static function getUids($condition) {
		if (empty ( $condition ['icsonid'] ) && empty ( $condition ['companyname'] )) {
			return "";
		}
		$retailerDB = ToolUtil::getDBObj ( "retailer" );
		
		if (false == $retailerDB) {
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = ToolUtil::$errMsg;
			return "";
		}
		$sql = " SELECT uid from t_retailer where uid != 0 ";
		if (isset ( $condition ['icsonid'] )) {
			//$sql .= " AND icsonid LIKE '" . $retailerDB->filterString ( $condition ['icsonid'] ) . "%'";
			$sql .= " AND icsonid = '" . $retailerDB->filterString ( $condition ['icsonid'] ) . "'";
		}
		if (isset ( $condition ['companyname'] )) {
			$sql .= " AND conpanyName LIKE '" . $retailerDB->filterString ( $condition ['companyname'] ) . "%'";
		}
		
		$uids = $retailerDB->getRows ( $sql );
		if (false === $uids) {
			self::$errCode = $retailerDB->errCode;
			self::$errMsg = $retailerDB->errMsg;
			return false;
		}
		// 符合条件uid不存在
		if (count ( $uids ) == 0) {
			return false;
		}
		$ret = array ();
		foreach ( $uids as $item ) {
			$ret [] = $item ['uid'];
		}
		return $ret;
	}
	
	/**
	 * 根据输入条件，找出uid
	 * 
	 * @param
	 *        	filter = array('shopName',)
	 */
	public static function getShopIds($condition) {
		if (empty ( $condition ['shopName'] )) {
			return '';
		}
		$retailerDB = ToolUtil::getDBObj ( "retailer" );
		if (false == $retailerDB) {
			return "";
		}
		$sql = " SELECT shopId from t_retailer_shop where shopName like '" . $retailerDB->filterString ( $condition ['shopName'] ) . "%'";
		
		$shopIds = $retailerDB->getRows ( $sql );
		if (false === $shopIds) {
			
			self::$errCode = $retailerDB->errCode;
			self::$errMsg = $retailerDB->errMsg;
			return false;
		}
		// 符合条件uid不存在
		if (count ( $shopIds ) == 0) {
			return false;
		}
		
		$ret = array ();
		foreach ( $shopIds as $item ) {
			$ret [] = $item ['shopId'];
		}
		return $ret;
	}
	
	/**
	 * 根据输入条件，找出uid
	 * 
	 * @param
	 *        	filter = array('shopGuideName',)
	 */
	public static function getShopGuideIds($condition) {
		if (empty ( $condition ['shopGuideName'] )) {
			return '';
		}
		$retailerDB = ToolUtil::getDBObj ( "retailer" );
		if (false == $retailerDB) {
			return "";
		}
		$sql = " SELECT uid from t_retailer_salesman where  name like '" . $retailerDB->filterString ( $condition ['shopGuideName'] ) . "%'";
		
		$shopGuideIds = $retailerDB->getRows ( $sql );
		if (false === $shopGuideIds) {
			self::$errCode = $retailerDB->errCode;
			self::$errMsg = $retailerDB->errMsg;
			return false;
		}
		// 符合条件uid不存在
		if (count ( $shopGuideIds ) == 0) {
			return false;
		}
		$ret = array ();
		foreach ( $shopGuideIds as $item ) {
			$ret [] = $item ['uid'];
		}
		return $ret;
	}
	/**
	 * 获取订单列表信息
	 * $filter = array(
	 * 'status'=>'',
	 * 'shop_id'=>'',
	 * 'onMonth'=>,
	 * 'onMonthAgo'=>,
	 * 'shop_guide_name'=>,
	 * 'account'=>
	 * )
	 */
	public static function getOrders($filter = array(), $currentPage = 1, $pageSize = 24) {
		$condition = self::_getWhereSQL ( $filter );

		if (false == $condition) {
			return false;
		}
		$orderDb = Config::getDB ( self::$DBName );
		if (empty ( $orderDb )) {
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;
			return false;
		}
		
		$sql = <<<SQL
   SELECT count(*) AS total
   FROM  t_orders
   WHERE $condition
   ORDER BY order_date desc 
SQL;

		$ordercount = $orderDb->getRows ( $sql );
		if (false === $ordercount) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			var_dump ( self::$errMsg );
			return false;
		}
		if (0 === count ( $ordercount )) {
			return array (
					'data' => array (),
					'total' => 0 
			);
		}
		$ordercount = current ( $ordercount );
		$total = $ordercount ['total'];
		
		$start = ($currentPage - 1) * $pageSize;
		if ($start < 0)
			$start = 0;
		$sql = "
   SELECT *
   FROM  t_orders
   WHERE $condition
   ORDER BY order_date desc 
   LIMIT $start,$pageSize";
		
		EL_Flow::getInstance('RetailerOrder')->append(var_export($filter, true));
		EL_Flow::getInstance('RetailerOrder')->append(var_export($sql, true));
		$orders = $orderDb->getRows ( $sql );
		if (false === $orders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}	
		return array (
				'data' => $orders,
				'total' => $total 
		);
	}
	
	/**
	 * 构造sql
	 * 
	 * @param array $condition
	 *        	('status'=>'','shop_id'=>'','onMonth'=>,'onMonthAgo'=>,'shop_guide_name'=>,'account'=>)
	 */
	public static function _getWhereSQL($conditions = array()) {
		$uids = self::getUids ( $conditions );
		
		if (false === $uids) {
			return false;
		}
		$shopIds = self::getShopIds ( $conditions );
		
		if (false === $shopIds) {
			return false;
		}
		$shopGuideIds = self::getShopGuideIds ( $conditions );
		if (false === $shopGuideIds) {
			return false;
		}
		$time = strtotime ( "last month", time () );
		$whereSql = 'subOrderNum=0 '; // 父订单不显示
		if (isset ( $conditions ['status'] ) && '' !== $conditions ['status']) {
			if ($conditions ['status'] == -8){
				$whereSql .= " and (status=-8 or status=-7) ";
			}
			else {
				$whereSql .= " and status=" . intval ( $conditions ['status'] );
			}
		}
		
		if (isset ( $conditions ['statusPAD'] ) && - 8 == $conditions ['statusPAD']) {
			$whereSql .= " and status=" . intval ( $conditions ['statusPAD'] );
		} else if (isset ( $conditions ['statusPAD'] ) && - 8 != $conditions ['statusPAD']) {
			$whereSql .= " and status != -8 ";
		}
		
		if (isset ( $conditions ['onMonth'] ) && '' !== $conditions ['onMonth']) {
			$whereSql .= " and order_date >= " . $time;
		}
		if (isset ( $conditions ['onMonthAgo'] ) && '' !== $conditions ['onMonthAgo']) {
			$whereSql .= " and order_date <= " . $time;
		}
		if (isset ( $conditions ['order_char_id'] ) && '' != $conditions ['order_char_id']) {
			$whereSql .= " and order_char_id = " . ToolUtil::filterInput ( $conditions ['order_char_id'] );
		}

		if (isset ( $conditions ['bargaining'] ) && '' != $conditions ['bargaining']) {
			$whereSql .= " and is_whole_sail = " . intval($conditions ['bargaining']) ;
		}
		if (isset ( $conditions ['customer_phone'] ) && '' != $conditions ['customer_phone']) {
			$whereSql .= " and customer_mobile = '" . ToolUtil::filterInput ( $conditions ['customer_phone'] ) ."'";
		}
		if (isset ( $conditions ['shopGuideId'] ) && '' != $conditions ['shopGuideId']) {
			$whereSql .= " and shop_guide_id = " . intval ( $conditions ['shopGuideId'] );
		}
		if (isset ( $conditions ['uid'] ) && '' != $conditions ['uid']) {
			$whereSql .= " and uid = " . intval ( $conditions ['uid'] );
		}
		/**
		 * c客户订单
		 */
		if (isset ( $conditions ['customer_mobile'] ) && '' != $conditions ['customer_mobile']) {
			$whereSql .= " and customer_mobile = " . ToolUtil::filterInput ( $conditions ['customer_mobile'] );
		}
		if ($shopGuideIds != '') {
			$whereSql .= " and shop_guide_id in (" . implode ( ",", $shopGuideIds ) . ")";
		}
		if ($uids != '') {
			
			$whereSql .= " and uid in (" . implode ( ",", $uids ) . ")";
		}
		if ($shopIds != '') {
			
			$whereSql .= " and shop_id in (" . implode ( ",", $shopIds ) . ")";
		}
		if (isset ( $conditions ['order_char_id'] ) && '' != $conditions ['order_char_id'])
		{
			$whereSql .= " and order_char_id = " . ToolUtil::filterInput($conditions ['order_char_id']);
		}
		if (!empty($conditions ['source'])){
			if ($conditions ['source'] == 1){ //后台下单
				$whereSql .= " and shop_guide_id = 0";  //返回空结果
			}
			else if($conditions ['source'] == 3){
				$whereSql .= " and shop_guide_id =". self::PC_ORDER;
			}
			else if($conditions ['source'] == 2){	
				$whereSql .= " and visitkey ='100' "  ;
			}
			else if($conditions ['source'] == 4){
				$whereSql .= " and visitkey ='200' "  ;
			}
		}
		if (isset($conditions ['dateBegin']) && '' !== $conditions ['dateBegin'])
		{
			$whereSql .= " and order_date >= " .  intval($conditions ['dateBegin']);
		}
		if (isset($conditions ['dateTo']) && '' !== $conditions ['dateTo'])
		{
			$whereSql .= " and order_date <= " .  intval($conditions ['dateTo']);
		}
		if (isset($conditions ['payType']) && '' !== $conditions ['payType'])
		{
			if (1 != $conditions ['payType'] && 3 != $conditions ['payType']) //货到付款  银行电汇
				$whereSql .= " and pay_type != 1 and pay_type != 3";
			else
				$whereSql .= " and pay_type= " . intval($conditions ['payType']);
		}
		
		return $whereSql;
	}
	public static function getOrderFlow($order_char_id) {
		if (! isset ( $order_char_id ) || $order_char_id <= 0) {
			self::$errCode = - 2019;
			self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "order_id[$order_char_id] is empty";
			return false;
		}
		
		$orderDb = Config::getDB ( self::$DBName );
		if (empty ( $orderDb )) {
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;
			return false;
		}
		$sql = "select * from t_order_process_flow where order_id=" . intval ( $order_char_id ) % 1000000000 . ' order by update_time asc ';
		
		$processflow = $orderDb->getRows ( $sql );
		if (false === $processflow) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}
		
		return $processflow;
	}
	public static function getOrderCancelReason($order_char_id) {
		if (! isset ( $order_char_id ) || $order_char_id <= 0) {
			self::$errCode = - 2019;
			self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "order_id[$order_char_id] is empty";
			return false;
		}
		$orderDb = Config::getDB ( self::$DBName );
		if (empty ( $orderDb )) {
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;
			return false;
		}
		$sql = "select memo,update_time from t_order_process_flow where order_id=" . intval ( $order_char_id ) % 1000000000 . ' and to_status = -2 order by update_time asc ';
		$rows = $orderDb->getRows ( $sql );
		if (false === $rows) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}
		
		if (count ( $rows ) == 0) {
			return "";
		}
		
		return $rows [0] ['memo'];
	}
	public static function order($newOrder, $wh_id = 1) {
		/**
		 * 检查期望送货时间 ，如何组装订单请求参数
		 */
		// 请求server下单
		$ip = Config::getIP ( 'OrderManagerCheck' );
		$addr = explode ( ":", $ip );
		if ((false === $addr) || ! is_array ( $addr ) || (count ( $addr ) < 2)) {
			self::$errCode = 100;
			self::$errMsg = 'get ordercheck spp ip config failed';
			return false;
		}
		
		$newOrder ['cmd'] = 1;
		
		$newOrder ['whid'] = $wh_id;
		$orderstr = ToolUtil::gbJsonEncode ( $newOrder );
		if (strlen ( $orderstr ) >= (2 << 18)) {
			self::$errCode = 101;
			self::$errMsg = 'request str is too long';
			return false;
		}
		
		$rspStr = NetUtil::tcpCmd ( $addr [0], $addr [1], $orderstr . "\r\n", 3, 3 );
		
		if (false == $rspStr) {
			self::$errCode = 19;
			self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "[send package to ordercheck svr timeout]";
			return false;
		}
		$rspStr = preg_replace ( "/,}}$/", "}}", $rspStr );
		$strArr = explode ( "}", $rspStr );
		
		$ret = ToolUtil::gbJsonDecode ( $strArr [0] . "}" );
		
		if (empty($ret)) {
			EL_Flow::getInstance("ipad_order")->append(var_export($rspStr,true));
			return false;
		}
		// 清空购物车
		
		return $ret;
	}
	public static function getERPOrderFlow($uid, $order_char_id) {
		if (! isset ( $order_char_id ) || $order_char_id <= 0) {
			self::$errCode = - 2019;
			self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "order_id[$order_char_id] is empty";
			return false;
		}
		
		if (! isset ( $uid ) || $uid <= 0) {
			self::$errCode = - 2020;
			self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "uid[$uid] is empty";
			return false;
		}
		
		global $_IP_CFG;
		
		$detail = self::getOneOrderDetail ( $order_char_id );
		if (false === $detail) {
			return false;
		}
		
		global $_StockToStation; // 出货仓所在站点
		$stockId = empty ( $detail ['stockNo'] ) ? $detail ['hw_id'] : $detail ['stockNo'];
		$stock_siteId = $_StockToStation [$stockId];
		
		$url = $_IP_CFG ['ORDERFLOW'] [$stock_siteId] . "/InternalService/AjaxGetOrderInfo.aspx?sysno=" . $order_char_id . "&siteid=" . $stock_siteId . "&type=json";
		
		$res = NetUtil::cURLHTTPGet ( $url, 10 );
		
		if (false === $res) {
			self::$errCode = NetUtil::$errCode;
			self::$errMsg = NetUtil::$errMsg;
			
			return false;
		}
		
		$res = ToolUtil::gbJsonDecode ( $res );
		
		if (empty ( $res ) || ! isset ( $res ['Steps'] ) || ! isset ( $res ['Steps'] ['Step'] )) {
			self::$errCode = - 991;
			self::$errMsg = "ToolUtil::gbJsonDecode error: " . $res;
			
			return false;
		}
		
		if (isset ( $res ['Steps'] ['Step'] ['Item'] )) {
			$data = $res ['Steps'] ['Step'];
			
			if ($data ["ItemContent"] == "Order is not exist") {
				
				// hack
				$res ['Steps'] ['Step'] = array (
						array (
								"Item" => date ( "Y-m-d H:i:s", $detail ['order_date'] ),
								"ItemContent" => "您提交了订单，等待客服审核。" 
						) 
				);
			} else {
				$res ['Steps'] ['Step'] = array (
						array (
								"Item" => $data ["Item"],
								"ItemContent" => $data ['ItemContent'] 
						) 
				);
			}
		}
		
		$items = array ();
		$total = '';
		$doNo = 0;
		$shipType = 0;
		
		foreach ( $res ['Steps'] ['Step'] as $index => $item ) {
			if (isset ( $item ['DoNo'] ) && isset ( $item ['ShipType'] )) {
				$doNo = intval ( $item ['DoNo'] );
				$shipType = intval ( $item ['ShipType'] );
			} else if (empty ( $item ['Item'] )) {
				$total = $item ['ItemContent'];
			} else {
				$time = $item ['Item'];
				
				if ($time === '无' && $index > 0) {
					$time = $res ['Steps'] ['Step'] [$index - 1] ['Item'];
				}
				
				$items [] = array (
						"time" => $item ['Item'],
						"content" => $item ['ItemContent'] 
				);
			}
		}
		
		return array (
				"total" => $total,
				"items" => $items,
				"third_type" => $shipType,
				"third_sysno" => $doNo 
		);
	}
	
	/**
	 * @brief 给订单添加新的商品
	 * 在订单未进入ERP的前提下
	 * 
	 * @param $isDelay 商品有虚库产生时，是否同意延时订单送货时间        	
	 */
	public static function addOrderItem($orderId, $productId, $num) {
		if (intval ( $num ) <= 0) {
			self::$errCode = - 98;
			self::$errMsg = "商品购买数量错误";
			return false;
		}
		
		$order = LIB_Order::getOneOrderDetail ( $orderId );
		if (false == $order) {
			Logger::err(LIB_Order::$errMsg);
			return false;
		}
		$uid = $order['uid'];

		// 判断订单状态是否可以修改
		if (! in_array ( $order ['status'], array (
				self::$_OrderState ['RetailerAudit'] ['value'],
				self::$_OrderState ['SailerAudit'] ['value'] 
		) )) {
			self::$errCode = - 99;
			self::$errMsg = "当前订单不可修改";
			return false;
		}
		
		foreach ( $order ['items'] as $item ) {
			if ($item ['product_id'] == $productId) {
				self::$errCode = - 100;
				self::$errMsg = "该商品在订单中已存在，请返回修改购买数量";
				return false;
			}
		}
		
		// 获取商品信息
		$result = array ();
		try {
			$result = IProduct::getProductsInfo ( array (
					$productId 
			), SITE_SH, true, true );
		} catch ( BaseException $e ) {
			self::$errCode = - 97;
			self::$errMsg = "商品信息获取失败";
			Logger::err ( 'pid =' . $productId . ' ' . $e->getMessage () );
			return false;
		}
		if (count ( $result ) == 0) {
			self::$errCode = - 97;
			self::$errMsg = "商品信息获取失败";
			return false;
		}
		
		foreach ( $result as $key => $prod ) {
			// 查是否同一个销售仓，保证不拆单
			$product_id = $prod ['product_id'];
			
			var_export ( 'product_id' . $product_id );
			
			if ($order ['stockNo'] !== $result [$product_id] ['supply_stock_id']) {
				self::$errCode = - 101;
				self::$errMsg = "该商品与订单商品不在一个物理仓库，无法合并，建议重新下单";
				return false;
			}
			// 查库存，如果是虚库，送货日期顺延
			if ($result [$product_id] ['stock'] == IProduct::$_StockTips ['arrival1-3']) {
				self::$errCode = - 102;
				self::$errMsg = "该商品不能立即送达，可能会导致送货延迟";
				return false;
			} else if ($result [$product_id] ['stock'] == IProduct::$_StockTips ['arrival2-7']) {
				self::$errCode = - 103;
				self::$errMsg = "该商品不能立即送达，可能会导致送货延迟";
				return false;
			} else if ($result [$product_id] ['stock'] == IProduct::$_StockTips ['not_available']) {
				self::$errCode = - 104;
				self::$errMsg = "商品库存不足";
				return false;
			}
			
			// 查是否可开增值税发票
			if (0 === ($result [$product_id] ['flag'] & IProduct::CAN_VAT_INVOICE)) {
				if ($order ['invoice'] ['type'] == INVOICE_TYPE_VAT) {
					self::$errCode = - 105;
					self::$errMsg = "原订单徐开增值税发票，该商品暂不支持可开增值税发票，请重新下单";
					return false;
				}
			}
		}
		$retailer = IRetailer::getRetailers(array('uid'=>$uid));
		if (!is_array($retailer)  || count($retailer) != 1){
			self::$errCode = - 95;
			self::$errMsg = "该用户信息不存在";
			
			return false;
		}
		$retailer = $retailer[0];
		// 获取分销价，零售价，业务成本价，编号
		$userData = array (
				'uid' => $uid,
				'utype' => $retailer['retailerType'],
				'pids' => array (
						$productId 
				) 
		);
		$dprice = IDistributionPrice::getPriceForProducts ( $userData );
		if (false === $dprice) {
			self::$errCode = LIB_DistributionPrice::$errCode;
			self::$errMsg = "获取商品价格信息失败";
			Logger::err ( LIB_DistributionPrice::$errMsg );
			return false;
		}
		$sprice = IDistributionPrice::getSailPriceForProducts ( $userData );
		if (false === $sprice) {
			self::$errCode = LIB_DistributionPrice::$errCode;
			self::$errMsg = "获取商品零售价信息失败";
			Logger::err ( LIB_DistributionPrice::$errMsg );
			return false;
		}
		
		$ids = IIdGenerator::getNewId( 'So_Item_Sequence', count ( $result [$productId] ['gifts'] ) + 1 );
		if (false == $ids){
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = "获取ID失败";
			Logger::err ( IIdGenerator::$errMsg );
			return false;
		}
		$now = time ();
		
		$weight = 0; // 添加商品的重量
		              // 更新ttc，插入主商品item
		$newitem = array (
				'item_id' => $ids ++,
				'order_char_id' => $order ['order_char_id'],
				'wh_id' => $order ['hw_id'],
				'product_id' => $productId,
				'product_char_id' => $result [$productId] ['product_char_id'],
				'uid' => $uid,
				'name' => $result [$productId] ['name'],
				'flag' => $result [$productId] ['flag'],
				'type' => $result [$productId] ['type'],
				'type2' => $result [$productId] ['type2'],
				'weight' => $result [$productId] ['weight'],
				'buy_num' => $num,
				'points' => 0,
				'points_pay' => 0,
				'point_type' => 0,
				'price' => $dprice [$productId], // 分销价
				'discount' => 0,
				'cash_back' => 0,
				'cost' => $result [$productId] ['cost_price'],
				'warranty' => $result [$productId] ['warranty'],
				'expect_num' => 0,
				'create_time' => $now,
				'product_type' => 0,
				'use_virtual_stock' => 0,
				'main_product_id' => 0,
				'updatetime' => $now,
				'edm_code' => '',
				'apportToPm' => 0,
				'apportToMkt' => 0,
				'shop_guide_cost' => $sprice [$productId],
				'OTag' => '',
				'package_ids' => '',
				'business_unit_cost' => $result [$productId] ['business_unit_cost_price'],
				'cost_type' => $dprice [$productId . 'type'],
				'cost_pre' => $dprice [$productId], // 分销价
				'guide_cost_pre' => $sprice [$productId] 
		);
		Logger::info ( var_export ( $newitem, true ) );
		EL_Flow::getInstance ( 'addOrderItem' )->append ( "order_id:{$newitem['order_char_id']},uid:{$uid},productId:{$newitem['product_id']},buyNum:{$num},cost:{$dprice[$productId]}" ); // 记录关键信息
		$ret = IRetailerOrderItemsTTC::insert ( $newitem );
		if (false == $ret) {
			self::$errCode = IRetailerOrderItemsTTC::$errCode;
			self::$errMsg = IRetailerOrderItemsTTC::$errMsg;
			return false;
		}
		$weight += $result [$productId] ['weight'] * $num;
		// 插入赠品
		$giftIds = array ();
		foreach ( $result as $prod ) {
			if ($prod ['product_id'] == $productId)
				continue;
			$product_id = $prod ['product_id'];
			
			$newgiftitem = array (
					'item_id' => $ids ++,
					'order_char_id' => $order ['order_char_id'],
					'wh_id' => $order ['hw_id'],
					'product_id' => $prod ['product_id'],
					'product_char_id' => $result [$product_id] ['product_char_id'],
					'uid' => $uid,
					'name' => $result [$product_id] ['name'],
					'flag' => $result [$product_id] ['flag'],
					'type' => $result [$product_id] ['type'],
					'type2' => $result [$product_id] ['type2'],
					'weight' => $result [$product_id] ['weight'],
					'buy_num' => $num * $result [$productId] ['gifts'] [$product_id] ['num'],
					'points' => 0,
					'points_pay' => 0,
					'point_type' => 0,
					'price' => 0, // $dprice[$productId], //分销价
					'discount' => 0,
					'cash_back' => 0,
					'cost' => $result [$product_id] ['cost_price'],
					'warranty' => $result [$product_id] ['warranty'],
					'expect_num' => 0,
					'create_time' => $now,
					'product_type' => ($result [$productId] ['gifts'] [$product_id] ['type'] == IProduct::COMPONENT_TYPE) ? IProduct::COMPONENT_TYPE : IProduct::GIFT_TYPE,
					'use_virtual_stock' => 0,
					'main_product_id' => $productId,
					'updatetime' => $now,
					'edm_code' => '',
					'apportToPm' => 0,
					'apportToMkt' => 0,
					'shop_guide_cost' => 0,
					'OTag' => '',
					'package_ids' => '',
					'business_unit_cost' => $result [$product_id] ['business_unit_cost_price'],
					'cost_type' => - 1,
					'cost_pre' => 0, // 分销价
					'guide_cost_pre' => 0 
			);
			Logger::info ( var_export ( $newgiftitem, true ) );
			EL_Flow::getInstance ( 'addOrderItem' )->append ( "order_id:{$newgiftitem['order_char_id']},uid:{$uid},productId:{$newgiftitem['product_id']},buyNum:{$num},gift" ); // 记录关键信息
			$ret = IRetailerOrderItemsTTC::insert ( $newgiftitem );
			if (false == $ret) {
				self::$errCode = IRetailerOrderItemsTTC::$errCode;
				self::$errMsg = IRetailerOrderItemsTTC::$errMsg;
				IRetailerOrderItemsTTC::remove ( $uid, array (
						'order_char_id' => $order ['order_char_id'],
						'product_id' => $productId 
				) );
				foreach ( $giftIds as $gid ) {
					IRetailerOrderItemsTTC::remove ( $uid, array (
							'order_char_id' => $order ['order_char_id'],
							'product_id' => $gid 
					) );
				}
				return false;
			}
			$weight += $num * $result [$product_id] ['weight'] * $result [$productId] ['gifts'] [$product_id] ['num'];
			array_push ( $giftIds, $product_id );
		}
		
		// 更新商品总价、运费
		$shipingCost = $order ['shipping_cost'];
		if ($order ['shipping_cost'] != 0) {
			$preWeight = 0;
			foreach ( $order ['items'] as $item ) {
				$preWeight += $item ['weight'] * buy_num;
			}
			$shippcost = LIB_ShippingPrice::get ( array (
					'shipping_id' => $order ['shipping_type'],
					'wh_id' => SITE_SH,
					'destination' => $order ['receiver_addr_id'],
					'order_price' => $order ['cash'],
					'order_info' => array (
							$order ['hw_id'] => array (
									'weight' => $preWeight + $weight 
							) 
					) 
			) );
			if (! empty ( $shippcost ['errCode'] )) {
				self::$errCode = $shippcost ['errCode'];
				self::$errMsg = $shippcost ['errMsg'];
				return false;
			}
			$shipingCost = $shippcost ['shippingCost'];
		}
		EL_Flow::getInstance ( 'addOrderItem' )->append ( "增加商品前:order_id:{$orderId},uid:{$uid},shipping_cost:{$order['shipping_cost']},cash:{$order['cash']},order_cost:{$order['order_cost']},shop_guide_cost:{$order['shop_guide_cost']}" ); // 记录关键信息
		$modifyOrder = array (
				'uid' => $uid,
				// 'order_char_id' => $orderId,
				'shipping_cost' => $shipingCost,
				'cash' => $order ['cash'] + $dprice [$productId] * $num,
				'order_cost' => $order ['order_cost'] + $dprice [$productId] * $num,
				'shop_guide_cost_pre' => $order ['shop_guide_cost_pre'] + $sprice [$productId] * $num,
				'order_cost_pre' => $order ['order_cost_pre'] + $dprice [$productId] * $num,
				'shop_guide_cost' => $order ['shop_guide_cost'] + $sprice [$productId] * $num,
				'comment' => $order ['comment'] . '\n添加商品【' . $result [$productId] ['name'] . '】' . ' 至订单',
				'update_time' => time () 
		)
		;
		$ret = IRetailerOrdersTTC::update ( $modifyOrder, array (
				'order_char_id' => $orderId 
		) );
		if (false == $ret) {
			self::$errMsg = IRetailerOrdersTTC::$errMsg;
			self::$errCode = IRetailerOrdersTTC::$errCode;
			EL_Flow::getInstance ( 'addOrderItem' )->append ( "添加商品失败！" );
			IRetailerOrderItemsTTC::remove ( $uid, array (
					'order_char_id' => $order ['order_char_id'],
					'product_id' => $productId 
			) );
			foreach ( $giftIds as $gid ) {
				IRetailerOrderItemsTTC::remove ( $uid, array (
						'order_char_id' => $order ['order_char_id'],
						'product_id' => $gid 
				) );
			}
			return false;
		}
		EL_Flow::getInstance ( 'addOrderItem' )->append ( "增加商品后:order_id:{$orderId},uid:{$uid},shipping_cost:{$modifyOrder['shipping_cost']},cash:{$modifyOrder['cash']},order_cost:{$modifyOrder['order_cost']},shop_guide_cost:{$modifyOrder['shop_guide_cost']}" ); // 记录关键信息
		                                                                                                                                                                                                                                                         
		// ttc中插入操作记录
		$process = array (
				'order_id' => $order ['order_id'],
				'process_id' => time (),
				'from_status' => $order ['status'],
				'to_status' => $order ['status'],
				'update_time' => time (),
				'sys_no' => time (),
				'source_order_id' => $orderId,
				'process_desc' => '添加商品【 ' . $result [$productId] ['name'] . '】',
				'process_result' => '添加成功',
				'memo' => '添加商品【 ' . $result [$productId] ['name'] . '】' 
		);
		IRetailerOrderProcessFlowTTC::insert ( $process );
		
		return true;
	}
	
	/**
	 * @brief 删除订单部分商品（单个）
	 * 在订单未进入ERP的前提下
	 */
	public static function delOrderItem($orderId, $productId) {
		$order = LIB_Order::getOneOrderDetail ( $orderId );
		if (false == $order) {
			return false;
		}
		$uid = $order['uid'];
		// 判断订单状态是否可以修改
		if (! in_array ( $order ['status'], array (
				self::$_OrderState ['RetailerAudit'] ['value'],
				self::$_OrderState ['SailerAudit'] ['value'] 
		) )) {
			self::$errCode = - 99;
			self::$errMsg = "当前订单不可修改";
			return false;
		}
		
		$isExit = false;
		$findItem = array ();
		foreach ( $order ['items'] as $item ) {
			if ($item ['product_id'] == $productId) {
				$isExit = true;
				$findItem = $item;
				break;
			}
		}
		if (! $isExit) {
			self::$errCode = - 100;
			self::$errMsg = "该商品在订单中不存在";
			return false;
		}
		
		if (count ( $order ['items'] ) == 1) {
			self::$errCode = - 100;
			self::$errMsg = "当前商品不可删除";
			return false;
		}
		// 删除商品
		$ret = IRetailerOrderItemsTTC::remove ( $uid, array (
				'order_char_id' => $orderId,
				'product_id' => $productId 
		) );
		if (false == $ret) {
			self::$errCode = - 101;
			self::$errMsg = "删除操作失败";
			return false;
		}
		EL_Flow::getInstance ( 'deleteOrderItem' )->append ( "删除订单商品 order_id:{$orderId},uid:{$uid},productId:{$productId},name:{$findItem['name']}" ); // 记录关键信息
		                                                                                                                                         // 更新价格
		EL_Flow::getInstance ( 'deleteOrderItem' )->append ( "删除订单商品前:order_id:{$orderId},uid:{$uid},cash:{$order['cash']},order_cost:{$order['order_cost']},shop_guide_cost:{$order['shop_guide_cost']}" ); // 记录关键信息
		$modifyOrder = array (
				'uid' => $uid,
				// 'order_char_id' => $orderId,
				'cash' => $order ['cash'] - $findItem ['price'] * $findItem ['buy_num'],
				'order_cost' => $order ['order_cost'] - $findItem ['price'] * $findItem ['buy_num'],
				'shop_guide_cost_pre' => $order ['shop_guide_cost_pre'] - $findItem ['guide_cost_pre'] * $findItem ['buy_num'],
				'order_cost_pre' => $order ['order_cost_pre'] - $findItem ['cost_pre'] * $findItem ['buy_num'],
				'shop_guide_cost' => $order ['shop_guide_cost'] - $findItem ['shop_guide_cost'] * $findItem ['buy_num'],
				//'comment' => $order ['comment'] . '\n删除商品【' . $findItem ['name'] . '】' . ' 至订单',
				'update_time' => time () 
		);
		
		if (($modifyOrder['cash']-$order['shipping_cost']) >= 9900
				&& $order['shipping_cost'] == 500){
			$modifyOrder['shipping_cost'] = 0;
			$modifyOrder['order_cost'] = $modifyOrder['order_cost'] - 500;
			$modifyOrder['cash'] = $modifyOrder['cash'] - 500;
			$modifyOrder['order_cost_pre'] = $modifyOrder['order_cost_pre'] - 500;
		}
		else if ($order['shipping_cost'] == 0 && ($modifyOrder['cash']) < 9900){
			$modifyOrder['shipping_cost'] = 500;
			$modifyOrder['order_cost'] = $modifyOrder['order_cost'] + 500;
			$modifyOrder['cash'] = $modifyOrder['cash'] + 500;
			$modifyOrder['order_cost_pre'] = $modifyOrder['order_cost_pre'] + 500;
		}
		
		$ret = IRetailerOrdersTTC::update ( $modifyOrder, array (
				'order_char_id' => $orderId 
		) );
		if (false == $ret) {
			self::$errMsg = IRetailerOrdersTTC::$errMsg;
			self::$errCode = IRetailerOrdersTTC::$errCode;
			EL_Flow::getInstance ( 'deleteOrderItem' )->append ( "订单价格更新失败！" );
			IRetailerOrderItemsTTC::insert ( $findItem );
			return false;
		}
		EL_Flow::getInstance ( 'deleteOrderItem' )->append ( "删除订单商品后:order_id:{$orderId},uid:{$uid},shipping_cost:{$modifyOrder['shipping_cost']},cash:{$modifyOrder['cash']},order_cost:{$modifyOrder['order_cost']},shop_guide_cost:{$modifyOrder['shop_guide_cost']}" ); // 记录关键信息
		                                                                                                                                                                                                                                                              
		// ttc中插入操作记录
		$process = array (
				'order_id' => $order ['order_id'],
				'process_id' => time (),
				'from_status' => $order ['status'],
				'to_status' => $order ['status'],
				'update_time' => time (),
				'sys_no' => time (),
				'source_order_id' => $orderId,
				'process_desc' => '删除商品【 ' . $findItem ['name'] . '】',
				'process_result' => '删除成功',
				'memo' => '删除商品【 ' . $findItem ['name'] . '】' 
		);
		IRetailerOrderProcessFlowTTC::insert ( $process );
		
		return true;
	}

	
	/**
	 * @brief 修改商品分销价格 改变订单标记为议价订单
	 * 在订单未进入ERP的前提下
	 */
	public static function changeOrderCost($orderId, $productId, $newPrice) {
		$order = LIB_Order::getOneOrderDetail (  $orderId );
		if (false == $order) {
			return false;
		}
		$uid = $order['uid'];
		// 判断订单状态是否可以修改
		if (! in_array ( $order ['status'], array (
				self::$_OrderState ['RetailerAudit'] ['value'],
				self::$_OrderState ['SailerAudit'] ['value'] 
		) )) {
			self::$errCode = - 99;
			self::$errMsg = "当前订单不可修改";
			return false;
		}
		
		$isExit = false;
		$findItem = array ();
		foreach ( $order ['items'] as $item ) {
			if ($item ['product_id'] == $productId) {
				$isExit = true;
				$findItem = $item;
				break;
			}
		}
		if (! $isExit) {
			self::$errCode = - 100;
			self::$errMsg = "该商品在订单中不存在";
			return false;
		}
		
		$oldPrice = $findItem ['price'];
		$cash = $order ['cash'];
		$order_cost = $order ['order_cost'];
		// 修改订单总零售价格
		$modifyOrder = array (
				'uid' => $uid,
				'cash' => $order ['cash'] - ($oldPrice - intval ( $newPrice )) * $findItem ['buy_num'],
				'order_cost' => $order ['order_cost'] - ($oldPrice - intval ( $newPrice )) * $findItem ['buy_num'],
				'is_whole_sail' => 1,
				'status'  => -7,
				'update_time' => time () 
		)
		;
		EL_Flow::getInstance ( 'changeOrderCost' )->append ( "修改订单价格前:order_id:{$orderId},uid:{$uid},shipping_cost:{$order['shipping_cost']},cash:{$order['cash']},order_cost:{$order['order_cost']},shop_guide_cost:{$order['shop_guide_cost']}" ); // 记录关键信息
		
		$ret = IRetailerOrdersTTC::update ( $modifyOrder, array (
				'order_char_id' => $orderId 
		) );
		if (false == $ret) {
			self::$errMsg = IRetailerOrdersTTC::$errMsg;
			self::$errCode = IRetailerOrdersTTC::$errCode;
			EL_Flow::getInstance ( 'changeOrderCost' )->append ( "订单分销价格更新失败！" );
			return false;
		}
		EL_Flow::getInstance ( 'changeOrderCost' )->append ( "修改订单价格后:order_id:{$orderId},uid:{$uid},shipping_cost:{$order['shipping_cost']},cash:{$modifyOrder['cash']},order_cost:{$modifyOrder['order_cost']},is_whole_sail:{$modifyOrder['is_whole_sail']}" ); // 记录关键信息
		                                                                                                                                                                                                                                                    
		// 修改订单item零售价格
		$modifyItem = array (
				'uid' => $uid,
				'price' => $newPrice,
				'update_time' => time () 
		);
		$ret = IRetailerOrderItemsTTC::update ( $modifyItem, array (
				'order_char_id' => $orderId,
				'product_id' => $productId 
		) );
		if (false == $ret) {
			self::$errMsg = IRetailerOrderItemsTTC::$errMsg;
			self::$errCode = IRetailerOrderItemsTTC::$errCode;
			EL_Flow::getInstance ( 'changeOrderGuideCost' )->append ( "订单分销价格更新失败！" );
			IRetailerOrdersTTC::update ( array (
					'uid' => $uid,
					'cash' => $cash,
					'order_cost' => $order_cost 
			), array (
					'order_char_id' => $orderId 
			) );
			return false;
		}
		
		// ttc中插入操作记录
		$process = array (
				'order_id' => $order ['order_id'],
				'process_id' => time (),
				'from_status' => $order ['status'],
				'to_status' => $order ['status'],
				'update_time' => time (),
				'sys_no' => time (),
				'source_order_id' => $orderId,
				'process_desc' => '修改商品【 ' . $findItem ['name'] . '】分销价',
				'process_result' => '修改成功，议价订单',
				'memo' => '修改商品【 ' . $findItem ['name'] . '】分销价' 
		);
		IRetailerOrderProcessFlowTTC::insert ( $process );
		
		return true;
	}
	
	/**
	 * @brief 修改商品分销价格 改变订单标记为议价订单
	 * 在订单未进入ERP的前提下
	 */
	public static function changeOrderUintCost($orderId, $productId, $newPrice) {
		$order = LIB_Order::getOneOrderDetail (  $orderId );
		if (false == $order) {
			return false;
		}
		$uid = $order['uid'];
		// 判断订单状态是否可以修改
		if (! in_array ( $order ['status'], array (
				self::$_OrderState ['RetailerAudit'] ['value'],
				self::$_OrderState ['SailerAudit'] ['value']
		) )) {
			self::$errCode = - 99;
			self::$errMsg = "当前订单不可修改";
			return false;
		}
	
		$isExit = false;
		$findItem = array ();
		foreach ( $order ['items'] as $item ) {
			if ($item ['product_id'] == $productId) {
				$isExit = true;
				$findItem = $item;
				break;
			}
		}
		if (! $isExit) {
			self::$errCode = - 100;
			self::$errMsg = "该商品在订单中不存在";
			return false;
		}
	
		$oldPrice = ($findItem['business_unit_cost_pre']==0)?$findItem ['business_unit_cost']:$findItem['business_unit_cost_pre'];
		
		// 修改订单item零售价格
		$modifyItem = array (
				'uid' => $uid,
				'business_unit_cost'=> $newPrice,
				'business_unit_cost_pre' => $oldPrice,
				'update_time' => time ()
		);
		$ret = IRetailerOrderItemsTTC::update ( $modifyItem, array (
				'order_char_id' => $orderId,
				'product_id' => $productId
		) );
		if (false == $ret) {
			self::$errMsg = IRetailerOrderItemsTTC::$errMsg;
			self::$errCode = IRetailerOrderItemsTTC::$errCode;
			EL_Flow::getInstance ( 'changeOrderGuideCost' )->append ( "订单商品业务成本价格更新失败！" );
			return false;
		}
		
		// ttc中插入操作记录
		$process = array (
				'order_id' => $order ['order_id'],
				'process_id' => time (),
				'from_status' => $order ['status'],
				'to_status' => $order ['status'],
				'update_time' => time (),
				'sys_no' => time (),
				'source_order_id' => $orderId,
				'process_desc' => '修改商品【 ' . $findItem ['name'] . '】业务成本价',
				'process_result' => '修改成功',
				'memo' => '修改商品【 ' . $findItem ['name'] . '】业务成本价'
		);
		IRetailerOrderProcessFlowTTC::insert ( $process );
		$modifyItem['cost'] = $findItem['cost']; 
		$modifyItem['price'] = $findItem['price']; //易迅价
		$modifyItem['product_char_id'] = $findItem['product_char_id'];
		$modifyItem['cost_pre'] = $findItem['cost_pre']; //议价前分销价
		$modifyItem['cost'] = $findItem['cost'];         //实际成交价格
		$modifyItem['shop_guide_cost'] = $findItem['shop_guide_cost'];
		$modifyItem['product_id'] = $findItem['product_id'];
		$modifyItem['name'] = $findItem['name'];
		$modifyItem['order_char_id'] = $findItem['order_char_id'];
		return array('errCode'=>0,'data'=> $modifyItem);
	}
	
	/**
	 * @brief 修改订单商品数量
	 * 在订单未进入ERP的前提下
	 */
	public static function changeOrderItemNum($orderId, $productId, $num) {
		if (intval ( $num ) <= 0) {
			self::$errCode = - 98;
			self::$errMsg = "商品购买数量错误";
			return false;
		}
		
		$order = LIB_Order::getOneOrderDetail ( $orderId );
		if (false == $order) {
			return false;
		}
		$uid = $order['uid'];
		// 判断订单状态是否可以修改
		if (! in_array ( $order ['status'], array (
				self::$_OrderState ['RetailerAudit'] ['value'],
				self::$_OrderState ['SailerAudit'] ['value'] 
		) )) {
			self::$errCode = - 99;
			self::$errMsg = "当前订单不可修改";
			return false;
		}
		
		$isExit = false;
		$findItem = array ();
		foreach ( $order ['items'] as $item ) {
			if ($item ['product_id'] == $productId) {
				$isExit = true;
				$findItem = $item;
				break;
			}
		}
		if (! $isExit) {
			self::$errCode = - 100;
			self::$errMsg = "该商品在订单中不存在";
			return false;
		}
		
		// 获取商品信息
		$result = IProduct::getProductsInfo ( array (
				$productId 
		), SITE_SH, true, true );
		if (false == $result) {
			self::$errCode = IProduct::$errCode;
			self::$errMsg = IProduct::$errMsg;
			return false;
		}
		//
		if ($result [$productId] ['num_available'] < $num) {
			self::$errCode = - 97;
			self::$errMsg = '商品实际库存不足';
			return false;
		}
		// 赠品库存判断
// 		foreach ( $result [$productId] ['gifts'] as $key => $gift ) {
// 			if ($result [$key] ['num_available'] < $num * $gift ['num']) {
// 				self::$errCode = - 96;
// 				self::$errMsg = '商品赠品实际库存不足';
// 				return false;
// 			}
// 		}
		
		$price = $findItem ['price'];
		$pricePre = $findItem['cost_pre'];
		$itemShopGuideCost = $findItem ['shop_guide_cost'];
		$itemShopGuideCostPre = $findItem ['guide_cost_pre'];
		$oldNum = $findItem ['buy_num'];
		$cash = $order ['cash'];
		$order_cost = $order ['order_cost'];
		$order_shopcost = $order ['shop_guide_cost'];
		// 修改订单总零售价格
		$modifyOrder = array (
				'uid' => $uid,
				'cash' => $order ['cash'] + (intval ( $num ) - intval ( $oldNum )) * $price,
				'shop_guide_cost' => $order ['shop_guide_cost'] + (intval ( $num ) - intval ( $oldNum )) * $itemShopGuideCost,
				'shop_guide_cost_pre' => $order ['shop_guide_cost_pre'] + (intval ( $num ) - intval ( $oldNum )) * $itemShopGuideCostPre,
				'order_cost' => $order ['order_cost'] + (intval ( $num ) - intval ( $oldNum )) * $price,
				'order_cost_pre' => $order ['order_cost_pre'] + (intval ( $num ) - intval ( $oldNum )) * $pricePre,
				'update_time' => time () 
		);
		if (($modifyOrder['cash']-$order['shipping_cost']) >= 9900 
				&& $order['shipping_cost'] == 500){
			$modifyOrder['shipping_cost'] = 0;
			$modifyOrder['order_cost'] = $modifyOrder['order_cost'] - 500;
			$modifyOrder['cash'] = $modifyOrder['cash'] - 500;
			$modifyOrder['order_cost_pre'] = $modifyOrder['order_cost_pre'] - 500;
		}
		else if ($order['shipping_cost'] == 0 && ($modifyOrder['cash']) < 9900){
			$modifyOrder['shipping_cost'] = 500;
			$modifyOrder['order_cost'] = $modifyOrder['order_cost'] + 500;
			$modifyOrder['cash'] = $modifyOrder['cash'] + 500;
			$modifyOrder['order_cost_pre'] = $modifyOrder['order_cost_pre'] + 500;
		}
		
		EL_Flow::getInstance ( 'changeOrderItemNum' )->append ( "修改商品数量前:order_id:{$orderId},uid:{$uid},produid:{$productId},num:{$oldNum},shipping_cost:{$order['shipping_cost']},cash:{$order['cash']},order_cost:{$order['order_cost']},shop_guide_cost:{$order['shop_guide_cost']}" ); // 记录关键信息
		
		$ret = IRetailerOrdersTTC::update ( $modifyOrder, array (
				'order_char_id' => $orderId 
		) );
		if (false == $ret) {
			self::$errMsg = IRetailerOrdersTTC::$errMsg;
			self::$errCode = IRetailerOrdersTTC::$errCode;
			EL_Flow::getInstance ( 'changeOrderGuideCost' )->append ( "订单商品数量更新失败！" );
			return false;
		}
		EL_Flow::getInstance ( 'changeOrderItemNum' )->append ( "修改商品数量后:order_id:{$orderId},uid:{$uid},produid:{$productId},num:{$num}shipping_cost:{$order['shipping_cost']},cash:{$modifyOrder['cash']},order_cost:{$modifyOrder['order_cost']}" ); // 记录关键信息
		                                                                                                                                                                                                                                                                                      
		// 修改订单item零售价格
		$modifyItem = array (
				'uid' => $uid,
				'buy_num' => $num,
				'update_time' => time () 
		);
		$ret = IRetailerOrderItemsTTC::update ( $modifyItem, array (
				'order_char_id' => $orderId,
				'product_id' => $productId 
		) );
		if (false == $ret) {
			self::$errMsg = IRetailerOrderItemsTTC::$errMsg;
			self::$errCode = IRetailerOrderItemsTTC::$errCode;
			EL_Flow::getInstance ( 'changeOrderGuideCost' )->append ( "订单分销价格更新失败！" );
			IRetailerOrdersTTC::update ( array (
					'uid' => $uid,
					'cash' => $cash,
					'order_cost' => $order_cost,
					'shop_guide_cost' => $order_shopcost 
			), array (
					'order_char_id' => $orderId 
			) );
			return false;
		}
		
		//查找是否有赠品组件
		if (isset($order ['items'] [$productId] ['gift'])){
			foreach ($order ['items'] [$productId] ['gift'] AS $gift){
				$ret = IRetailerOrderItemsTTC::update ( $modifyItem, array (
										'order_char_id' => $orderId,
										'product_id' => $gift['product_id']) 
									);
			}
		}
		
		// ttc中插入操作记录
		$process = array (
				'order_id' => $order ['order_id'],
				'process_id' => time (),
				'from_status' => $order ['status'],
				'to_status' => $order ['status'],
				'update_time' => time (),
				'sys_no' => time (),
				'source_order_id' => $orderId,
				'process_desc' => '修改商品【 ' . $findItem ['name'] . '】数量',
				'process_result' => $productId, //修改数量-
				'memo' => '修改商品【 ' . $findItem ['name'] . '】数量' 
		);
		$ret = IRetailerOrderProcessFlowTTC::insert ( $process );

		return true;
	}

}


