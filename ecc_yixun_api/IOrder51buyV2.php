<?php
require_once(PHPLIB_ROOT . 'lib/DataReport.php');
require_once(PHPLIB_ROOT . 'inc/special.constant.inc.php');
require_once(PHPLIB_ROOT . 'api/IUniOrder.php');

class IOrder51buyV2 extends IOrderV2{
	public static $errCode = 0;
	public static $errMsg = '';
	public static $logMsg = '';

    public static $timeSpan = array('1' => '上午', '2' => '下午', '3' => '晚上', '4' => "");
    public static $weekDays = array('1' => '星期一', '2' => '星期二', '3' => '星期三', '4' => '星期四', '5' => '星期五', '6' => '星期六', '7' => '星期日');
    public static $stopTime = array(
        MORNING => "00:30",
        NOON => "11:00",
        NIGHT => "15:00",
    );

    // 时间状态标记
    CONST NORMAL = 0; // 正常的时间段
    CONST EXPIRE = 1; // 当天过期的时间段
    CONST LIMITED = 2; // 限单的时间段

	//圆通快递
	public static $ytoRequestTpl = '<BatchQueryRequest><logisticProviderID>YTO</logisticProviderID><clientID>ICSON</clientID><orders><order><mailNo>{sysno_holder}</mailNo></order></orders></BatchQueryRequest>';
	public static $ytoPartnerId = 'icson';
	public static $ytoRequestHost = 'jingang.yto56.com.cn';
	public static $ytoRequestUrl = 'http://116.228.70.199/ordws/VipOrderServlet';

	// 不开发票
	const HAS_INVOICE = 1;
	const NO_INVOICE = 0;
	//抢购商品显示验证码？
	const DISPLAY_VERIFY_CODE = false;
	const FREE_SHIPPING_PRICE = 2900; //免运费的购买最低价，单位为分

	private static $AppLS = array(
		"--mobile--",
		"--android--",
		"--androidpad--",
		"--iphone--",
		"--ipad--",
		"--winphone--",
		"--winpad--"
	);

	public static $test_uid = array(30558120);

	/*
		 @name	setOrderCanceled
		 @desc	取消订单
		 @para	uid，用户id
		 @para	order_id，订单id
		 @para	product_id，商品id
	 */
	public static function setOrderCanceled($uid, $order_id)
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
					promotion_point,
					single_promotion_info,
					flag,
					order_char_id,
					shipping_type,
					pay_type,
					isPayed,
					expect_dly_date,
					expect_dly_time_span,
					order_date,
					order_char_id
				from t_orders_{$db_tab_index['table']}
				where uid={$uid}
				and order_char_id='$order_id'";

		$orders = $orderDb->getRows($sql);
		if (false === $orders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}


		if (1 != count($orders)) {
			self::$errCode = -2020;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "no such orders";
			return false;
		}
		$order = &$orders[0];

		//判断订单是否可以取消
		global $_OrderState, $_PAY_MODE;
		$can_cancel = IOrder::checkCanCancel($order);
		if (false === $can_cancel)
		{
			self::$errCode = -1409;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_id[$order_id] can not canceled";
			return false;
		}

		//拉取该订单对应的商品列表
		$sql = "select product_id, wh_id, buy_num, use_virtual_stock from t_order_items_{$db_tab_index['table']} where order_char_id='$order_id'";
		$order_items = $orderDb->getRows($sql);
		if (false === $order_items) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

		$timeNow = date('Y-m-d H:i:s');

		//起事务恢复库存
		global $_StockToStation;
		global $_SO_Site;
		// 如果该站点已经切换到了客服系统，则使用新的客服库
		if(in_array($_StockToStation[$order['stockNo']], $_SO_Site))
		{
			$erpDb = ToolUtil::getMSDBObj("SO");
		}
		else
		{
			$erpDb = ToolUtil::getMSDBObj('ERP_' . $_StockToStation[$order['stockNo']]);
		}
		if (false === $erpDb) {
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "query ms sql faild " . ToolUtil::$errMsg;
			return false;
		}
		$sql = "SET ANSI_NULLS ON
				SET ANSI_PADDING ON
				SET ANSI_WARNINGS ON
				SET ARITHABORT ON
				SET CONCAT_NULL_YIELDS_NULL ON
				SET QUOTED_IDENTIFIER ON
				SET NUMERIC_ROUNDABORT OFF";

		$ret = $erpDb->execSql($sql);
		if (false === $ret) {
			self::$errCode = $erpDb->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "query ms sql faild " . $erpDb->errMsg;
			return false;
		}


		$sql = "begin transaction";
		$ret = $orderDb->execSql($sql);
		if (false === $ret) {
			self::$errCode = -2032;
			self::$errMsg = '开启orderdb事务失败';
			return false;
		}

		$ret = $erpDb->execSql($sql);
		if (false === $ret) {
			self::$errCode = $erpDb->errCode;
			self::$errMsg = '开启ms sql事务失败,line:' . __LINE__ . ",errMsg:" . $erpDb->errMsg;
			$sql = "rollback";
			$orderDb->execSql($sql);
			return false;
		}

		$sql = "SELECT Status from SO_Master where SOID='{$order_id}'";
		$erpOrder = $erpDb->getRows($sql);
		if (false === $erpOrder) {
			self::$errCode = $erpDb->errCode;
			self::$errMsg = '查询ERP订单失败,line:' . __LINE__ . ",errMsg:" . $erpDb->errMsg;
			$sql = "rollback";
			$orderDb->execSql($sql);
			$erpDb->execSql($sql);
			return false;
		}
		$inSoMaster = false;
		if (count($erpOrder) > 0) {
			$inSoMaster = true;
			if (!($order['status'] == $_OrderState['Origin']['value'] || $order['status'] == $_OrderState['WaitingPay']['value'] || $order['status'] == $_OrderState['WaitingManagerAudit']['value'])) {
				$sql = "rollback";
				$orderDb->execSql($sql);
				$erpDb->execSql($sql);
				self::$errCode = -1409;
				self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . "order_id[$order_id] (status is not origin) can not canceled";
				return false;
			}
		}
		//设置订单状态为用户取消状态
		$sql = "update t_orders_{$db_tab_index['table']} set status = {$_OrderState['CustomerCancel']['value']} where uid=$uid and order_char_id='$order_id' and status in ({$_OrderState['Origin']['value']},{$_OrderState['WaitingPay']['value']},{$_OrderState['WaitingManagerAudit']['value']}) ";
		$ret = $orderDb->execSql($sql);
		if (false === $ret || $orderDb->getAffectedRows() != 1) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = '取消前台订单失败,line:' . __LINE__ . ",errMsg:" . $orderDb->errMsg;
			$sql = "rollback";
			$orderDb->execSql($sql);
			$erpDb->execSql($sql);
			return false;
		}

		//查询ERP的中间表订单的状态，看是否能取消
		$sql = "update t_orders set Status={$_OrderState['CustomerCancel']['value']} where order_char_id='{$order_id}' ";
		$ret = $erpDb->execSql($sql);
		if (false === $ret) {
			self::$errCode = -1409;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_id[$order_id] (erp order status can not updated) can not canceled " . $erpDb->errMsg;
			$sql = "rollback";
			$orderDb->execSql($sql);
			$erpDb->execSql($sql);
			return false;
		}

		if (true === $inSoMaster)
		{
			//查询ERP中So_Master订单的状态，看是否能取消
			$sql = "update SO_Master set Status={$_OrderState['CustomerCancel']['value']} where SOID='{$order_id}' and status in ({$_OrderState['Origin']['value']},{$_OrderState['WaitingPay']['value']},{$_OrderState['WaitingManagerAudit']['value']})";
			$ret = $erpDb->execSql($sql);
			if (false === $ret || 1 != $erpDb->getAffectedRows()) {
				self::$errCode = -1409;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_id[$order_id] (erp order status can not updated) can not canceled " . $erpDb->errMsg;
				$sql = "rollback";
				$orderDb->execSql($sql);
				$erpDb->execSql($sql);
				return false;
			}

			//查询ERP中订单的状态，看是否能取消 完毕
		}
		//恢复库存
		$inventoryDB = ToolUtil::getMSDBObj('Inventory_Manager');
		if( false === $inventoryDB )
		{
			self::$errCode = $erpDb->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "连接Inventory_Manager数据库出错" . $erpDb->errMsg;
			$sql = "rollback";
			$orderDb->execSql($sql);
			$erpDb->execSql($sql);
		}

		$sql = "begin transaction";
		$ret = $inventoryDB->execSql($sql);
		if (false === $ret) {
			self::$errCode = $inventoryDB->errCode;
			self::$errMsg = '开启inventoryDB事务失败,line:' . __LINE__ . ",errMsg:" . $inventoryDB->errMsg;
			$sql = "rollback";
			$orderDb->execSql($sql);
			$erpDb->execSql($sql);
			return false;
		}

		$order_id_int = intval($order_id) % 100000000;

		// 库存和流水的错误定位，开始 update 之前查找一次 Inventory_Stock


		$_local_ip = ToolUtil::getLocalIp(0);
		$_local_ip = explode('.', $_local_ip);
		$_inserter = empty($_local_ip[3]) ? 7 : intval($_local_ip[3]);

		reset($order_items);

		//库存双写 S Sheldonshi
        $inventorysAllData = array();
        //库存双写 E Sheldonshi

		foreach ($order_items as $oit)
		{
			$buy_num_positive = $oit['buy_num'];
			$buy_num_negative = $oit['buy_num'] * (-1);

			//建了虚库单，需要减去订购数量，虚库数量，作废虚库单
			if ($oit['use_virtual_stock'] == 1) {
				$sql = "update t_order_virtual_stock_{$db_tab_index['table']} set status=" . VIRTUAL_STOCK_STATUS_CACEL . ",update_time=" . time() . " where order_char_id='$order_id' AND product_id={$oit['product_id']}";
				$ret = $orderDb->execSql($sql);
				if (false === $ret) {
					self::$errCode = $orderDb->errCode;
					self::$errMsg = "更新虚库单失败，line：" . __LINE__ . ",errMsg" . $orderDb->errMsg;
					$sql = "rollback";
					$orderDb->execSql($sql);
					$erpDb->execSql($sql);
					return false;
				}


				//ixiuzeng添加，将 Inventroy_Stock 的库存修改记录插入到 Inventory_Flow 表中
				$sql = "update Inventory_Stock set AvailableQty = AvailableQty + {$oit['buy_num']}, VirtualQty = VirtualQty - {$oit['buy_num']}, OrderQty = OrderQty - {$oit['buy_num']} , rowModifydate='{$timeNow}' where ProductSysNo={$oit['product_id']} and StockSysNo={$order['stockNo']} " .
					"insert into Inventory_Flow values({$order['stockNo']}, {$oit['product_id']}, 1, $order_id_int, 2,$buy_num_positive,'$timeNow', '$timeNow',$_inserter),
							({$order['stockNo']}, {$oit['product_id']}, 1, $order_id_int, 4,$buy_num_negative,'$timeNow', '$timeNow',$_inserter),
							({$order['stockNo']}, {$oit['product_id']}, 1, $order_id_int, 5,$buy_num_negative,'$timeNow', '$timeNow',$_inserter)";
			}
			else
			{
				$sql = "update Inventory_Stock set AvailableQty = AvailableQty + {$oit['buy_num']}, OrderQty = OrderQty - {$oit['buy_num']}, rowModifydate='{$timeNow}' where ProductSysNo={$oit['product_id']} and StockSysNo={$order['stockNo']} " .
					"insert into Inventory_Flow values({$order['stockNo']}, {$oit['product_id']}, 1, $order_id_int, 2,$buy_num_positive,'$timeNow', '$timeNow',$_inserter),
							({$order['stockNo']},{$oit['product_id']}, 1, $order_id_int, 4,$buy_num_negative,'$timeNow', '$timeNow',$_inserter)";

			}

			$ret = $inventoryDB->execSql($sql);
			if (false === $ret) {
				self::$errCode = $inventoryDB->errCode;
				self::$errMsg = "更新虚库存失败，line：" . __LINE__ . ",errMsg" . $inventoryDB->errMsg;
				$sql = "rollback";
				$orderDb->execSql($sql);
				$erpDb->execSql($sql);
				$inventoryDB->execSql($sql);
				return false;
			}

			//库存双写 S sheldonshi
	        //获取下商品的sale_model
	        $productInfoRet = IShoppingProcess::getProductInfo(array($oit['product_id']), $order['stockNo'], 0, $uid);
	        if(false === $productInfoRet)
	        {
	            //信息获取失败，记录日志
	            $inventoryData = array(
	                'product_id' => $oit['product_id'],
	                'sys_stock' => $order['stockNo'],
	                'order_id' => $order_id_int,
	                'order_creat_time' => $order['order_date'],
	                'buy_count' => $oit['buy_num'],
	                'order_type' => 0,  //这里需要修改
	            );

	            EL_Flow::getInstance('uniinventory')->append("ordercancel getProductInfo error!" . ToolUtil::gbJsonEncode($inventoryData));
	        }
	        else
	        {
	            $productInfoRet = $productInfoRet['productsInfo'];
	                $inventoryData = array(
	                    'product_id' => $oit['product_id'],
	                    'sys_stock' => $order['stockNo'],
	                    'order_id' => $order_id_int,
	                    'order_creat_time' => $order['order_date'],
	                    'buy_count' => $oit['buy_num'],
	                    'order_type' => $productInfoRet[$oit['product_id']]['sale_model'] == 0 ? 1 : $productInfoRet[$oit['product_id']]['sale_model'],  //这里需要修改
	                );
	                $inventorysAllData[] = $inventoryData;
            }
            //库存双写 E sheldonshi
        }

		if ( ICustomPhone::isCustomPhoneOrder($order) )
		{
			// 如果是定制机订单
			// 根据订单号找到合约中的号码
			$contractDb = ToolUtil::getMSDBObj('ICSON_CORE');
			if ($contractDb === false)
			{
				self::$errMsg = "getMSDBObj Error, line" . __LINE__ . "," . self::$errMsg . "\n";
				self::Log(self::$errMsg);
				$sql = "rollback";
				$orderDb->execSql($sql);
				$erpDb->execSql($sql);
				$inventoryDB->execSql($sql);
				return false;
			}

			$sql = "select num from t_cp_contract_info where order_char_id=" . $order_id;
			$num = $contractDb->getRows($sql);
			if ( $num === false || count($num) == 0 )
			{
				self::$errMsg = "getMSDBObj Error, line" . __LINE__ . "," . $contractDb->errMsg . "\n";
				self::Log(self::$errMsg);
				$sql = "rollback";
				$orderDb->execSql($sql);
				$erpDb->execSql($sql);
				$inventoryDB->execSql($sql);
				return false;
			}

			$num = $num[0]['num'];

			// 最后返还号码的状态
			$ret = ICustomPhone::returnNum($num);
			if ( false === $ret )
			{
				self::$errMsg = "returnNum Error, line" . __LINE__ . "," . ICustomPhone::$errMsg . "\n";
				self::Log(self::$errMsg);
				$sql = "rollback";
				$orderDb->execSql($sql);
				$erpDb->execSql($sql);
				$inventoryDB->execSql($sql);
				return false;
			}

		}

		//如果使用了积分，返还积分
		if ($order['point_pay'] > 0) {
			//$userInfo = IUsersTTC::get($uid, array(), array('valid_point'));
            $userInfo = IUser::getUserInfo($uid, true);
			if (false === $userInfo) {
				self::$errCode = IUser::$errCode;
				self::$errMsg = "用户使用了积分，IUser::getUserInfo失败，line:" . __LINE__ . ",errMsg:" . IUser::$errMsg;
				$sql = "rollback";
				$orderDb->execSql($sql);
				$erpDb->execSql($sql);
				$inventoryDB->execSql($sql);
				return false;
			}
            /*
			if (1 != count($userInfo)) {
				self::$errCode = 934;
				self::$errMsg = "no user($uid) exist,line:" . __LINE__;
				$sql = "rollback";
				$orderDb->execSql($sql);
				$erpDb->execSql($sql);
				$inventoryDB->execSql($sql);
				return false;
			}
            */
			//延迟返还积分，插入一条需要返还的订单记录
			$backDate['uid'] = $uid;
			$backDate['order_id'] = $order['order_id'];
			$backDate['type'] = ERROR_CANCEL_ORDER;
			$backDate['cash_point'] = $order['cash_point'];
			$backDate['promotion_point'] = $order['promotion_point'];
			$ret_insert = IScore::insertBackData($backDate);

			if(false === $ret_insert)
			{
				$sql = "rollback";
				$orderDb->execSql($sql);
				$erpDb->execSql($sql);
				$inventoryDB->execSql($sql);
				return false;
			}
		}

		$sql = "commit";
		$orderDb->execSql($sql);
		$erpDb->execSql($sql);
		$inventoryDB->execSql($sql);

		//取消成功后，调用ERP的服务，记录该订单已取消
		$inform_data = array(
			'order_char_id' => $order['order_char_id'],
			'stock_id' => $order['stockNo'],
			'status' => $_OrderState['CustomerCancel']['value'],
		);
		EA_ServiceFromERP::informOrderCancel($inform_data);

		$ordersToSub = array(
			$order['order_char_id'] => $order
		);

		// 取消订单成功，记录数-1
		IShippingTime::orderRecording($ordersToSub, -1);

		//IOrderProcessFlowTTC::insert(array('order_char_id'=>$order_id, 'ptime'=>date('Y-m-d H:i:s'), 'content'=>"您成功取消了该订单！"));
		//flycgu 还库存，修改TTC数据，失败不返回，因为同步脚本也会同步库存
		foreach ($order_items as $oit)
		{
			$info = IInventoryStockTTC::get($oit['product_id'], array('stock_id' => $order['stockNo']));
			//判断是否是虚库
			if ($oit['use_virtual_stock'] == 1) {
				$ret = IInventoryStockTTC::update(array('product_id' => $oit['product_id'], 'num_available' => $info[0]['num_available'] + $oit['buy_num'], 'virtual_num' => $info[0]['virtual_num'] - $oit['buy_num']), array('stock_id' => $order['stockNo']));
				if ($ret === false) {
					EL_Flow::getInstance('orderCancel')->append("increment IInventoryStockTTC failed,product_id:{$oit['product_id']},stockNo:{$order['stockNo']},num:{$oit['buy_num']}");
				}
			}
			else {
				$ret = IInventoryStockTTC::update(array('product_id' => $oit['product_id'], 'num_available' => $info[0]['num_available'] + $oit['buy_num']), array('stock_id' => $order['stockNo']));
				if ($ret === false) {
					EL_Flow::getInstance('orderCancel')->append("increment IInventoryStockTTC failed,product_id:{$oit['product_id']},stockNo:{$order['stockNo']},num:{$oit['buy_num']}");
				}
			}
		}
		//如果获得了优惠券，取消优惠券记录、发券记录,之后改成事务加入到上面中
		if (isset($order['single_promotion_info']) && $order['single_promotion_info'] != '') {
			$filter = array(
				'order_id' => $order['order_char_id'],
			);
			$ret = IPromotionUserRuleMapTTC::remove($uid, $filter);
			if (false === $ret) {
				$ret = IPromotionUserRuleMapTTC::remove($uid, $filter);
				if (false === $ret) {
					EL_Flow::getInstance('promotion')->append("IPromotionUserRuleMapTTC ERROR,uid:{$uid},order_id:{$order['order_char_id']}:" . IPromotionUserRuleMapTTC::$errMsg);
				}
			}
		}

		//库存双写 S sheldonshi
        IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
        //库存双写 E sheldonshi

		return true;
	}

	public static function placeOrder($newOrder, $wh_id)
	{

        $newOrder = self::transXSSContent($newOrder);
		self::$visitkey = $newOrder['visitkey'];

		$uid = $newOrder['uid'];
		$destination = $newOrder['receiveAddrId'];

		//如果使用优惠券，判断用户是否为经销商，若是，则不允许使用优惠券
		$userInfo = IUser::getUserInfo($uid);
		if ($userInfo === false) {
			self::$errCode = IUser::$errCode;
			self::$errMsg = "获取用户信息错误";
			self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:获取用户信息错误：" . IUser::$errMsg;
			return false;
		}

		/*
        $userPoint = IPreOrderV2::getUserPoint($uid);
        if($userPoint === false && $_POST['point'] > 0){
            self::$errCode = IPreOrderV2::$errCode;
            self::$errMsg = "获取用户积分信息错误";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:获取用户信息错误：" . IPreOrderV2::$errMsg;
            Logger::ERR("placeOrder IPreOrderV2::getUserPoint Error!获取用户积分信息错误!errCode:" . IPreOrderV2::$errCode);
            return array('errno' => 6001);
        }
        else
        {
            $user['point'] = isset($userPoint['point']) ? $userPoint['point'] : 0;
            $user['cash_point'] = isset($userPoint['cash_point']) ? $userPoint['cash_point'] : 0;
            $user['promotion_point'] = isset($userPoint['promotion_point']) ? $userPoint['promotion_point'] : 0;
            $user['valid_point'] = isset($userPoint['valid_point']) ? $userPoint['valid_point'] : 0;
        }
        */

		global $_USER_TYPE;
		if ($userInfo['type'] == $_USER_TYPE['Dealer'] && isset($newOrder['couponCode']) && $newOrder['couponCode'] != '') {
			return array('errCode'=> 15, 'errMsg'=> "您属于分销用户，不能使用优惠券。");
		}
		// 设置购物车参数
		$shoppingCartInfo = self::setShoppingCartInfo($newOrder);
        //TODO:使用新的接口来完成这里的商品列表商品信息获取   Start
        $result = IShoppingProcess::getAllCartItemsInfo($uid, $wh_id, $destination, $shoppingCartInfo, true , true);
        if (false === $result) {
            self::$errCode = IShoppingProcess::$errCode;
            self::$errMsg = IShoppingProcess::$errMsg . ",uid({$uid}) getItemList failed";
            self::Log("getAllCartItemsInfo Failed!=>".IShoppingProcess::$errCode);
            return array('errCode'=> -1, 'errMsg'=> "您的购物车中没有商品，请选购！");
        }
        $items = $result['items'];
        $suiteInfo = $result['suiteInfo'];
        $product_base_info = $result['products'];
        if (isset($newOrder['ls']) && in_array($newOrder['ls'], self::$AppLS)) {
            $items = IShoppingCart::filterPackageItems($items);
        }
        self::Log("getAllCartItemsInfo result=>".ToolUtil::gbJsonEncode($items));
        $items_tmp = array();
        foreach($items as $item)
        {
            $pid = $item['product_id'];
            if(array_key_exists($pid,$items_tmp))
            {
                $items_tmp[$pid]['buy_count'] += $item['buy_count'];
                $items_tmp[$pid]['cash_back'] += (isset($item['cash_back'])? $item['cash_back'] : 0) * $item['buy_count'];
                $items_tmp[$pid]['package_id'] .= ",".$item['package_id'];
            }
            else
            {
                $items_tmp[$pid] = $item;
                $items_tmp[$pid]['cash_back'] = (isset($item['cash_back'])? $item['cash_back'] : 0) * $item['buy_count'];
            }
        }

        $itemsInShoppingCart = array();
        foreach($items_tmp as $pid => $item)
        {
            if (isset($item['product_saving_amount']))
                unset($item['product_saving_amount']);
            $itemsInShoppingCart[$pid] = $item;
        }

        self::Log("获取购物车中的商品列表:" . ToolUtil::gbJsonEncode($items) . "," . ToolUtil::gbJsonEncode($itemsInShoppingCart));
        if (count($itemsInShoppingCart) == 0) {
            return array('errCode'=> 10, 'errMsg'=> "您的购物车中没有商品，请选购！");
        }

        $ret = self::checkVisitFrequency($product_base_info, $newOrder);
        if (false === $ret) {
            return false;
        }
        //TODO:使用新的接口来完成这里的商品列表商品信息获取  End
/*
		// 获取购物车商品列表
		$result = IPreOrderV2::getItemList($uid, $wh_id, $shoppingCartInfo);
		if (false === $result) {
			self::$errCode = IPreOrderV2::$errCode;
			self::$errMsg = IPreOrderV2::$errMsg . ",uid({$uid}) getItemList failed";
			return array('errCode'=> self::$errCode, 'errMsg'=> "您的购物车中没有商品，请选购！");
		}
		// 购物车中的商品
		$items = $result['items'];

		if (isset($newOrder['ls']) && in_array($newOrder['ls'], self::$AppLS)) {
			$items = IShoppingCart::filterPackageItems($items);
		}

		// 商品中的套餐信息
        $suiteInfo = $result['suiteInfo'];

		$bc_suite = array();
		foreach($suiteInfo as $key=>$su)
		{
			foreach($su['product_list'] as $pinfo)
			{
				$pid = $pinfo['product_id'];
				$bc_suite[$pid] = isset($bc_suite[$pid]) ? ($bc_suite[$pid] + $su['buy_count']) : $su['buy_count'];
			}
		}

		$ret = IPreOrderV2::splitSuiteItems($items,$suiteInfo);
		$items = $ret['items'];
		self::Log(ToolUtil::gbJsonEncode($items));
		$items_tmp = array();
		foreach($items as $item)
		{
			$pid = $item['product_id'];
			if(array_key_exists($pid,$items_tmp))
			{
				$items_tmp[$pid]['buy_count'] += $item['buy_count'];
				$items_tmp[$pid]['cash_back'] += (isset($item['cash_back'])? $item['cash_back'] : 0) * $item['buy_count'];
				$items_tmp[$pid]['package_id'] .= ",".$item['package_id'];
			}
			else
			{
				$items_tmp[$pid] = $item;
				$items_tmp[$pid]['cash_back'] = (isset($item['cash_back'])? $item['cash_back'] : 0) * $item['buy_count'];
			}
		}

		$itemsInShoppingCart = array();
		foreach($items_tmp as $pid => $item)
		{
			if (isset($item['product_saving_amount']))
				unset($item['product_saving_amount']);
			$itemsInShoppingCart[$pid] = $item;
		}

		self::Log("获取购物车中的商品列表:" . ToolUtil::gbJsonEncode($items) . "," . ToolUtil::gbJsonEncode($itemsInShoppingCart));

		if (count($itemsInShoppingCart) == 0) {
			return array('errCode'=> 10, 'errMsg'=> "您的购物车中没有商品，请选购！");
		}*/

		reset($newOrder['suborders']);
		$countPost = 0;                                              //商品款数
		while (FALSE != ($node = current($newOrder['suborders'])))
		{
			if (!isset($node['items'])) {
				return array('errCode'=> 10, 'errMsg'=> "您提交的订单数据有误，请检查！");
			}
			$countPost += count($node['items']);
			next($newOrder['suborders']);
		}
		//self::Log("itemsInShoppingCart:".ToolUtil::gbJsonEncode($itemsInShoppingCart));



		//如果没有套餐，判断购物车中商品与前台展示的商品数量是一致的
        //如果有了套餐，商品id做key是合并了的，这里比较的是款数
		if(empty($suiteInfo))
		{
			if (count($itemsInShoppingCart) != $countPost) {
				self::$errCode = -2021;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "items count in shoppingcart is not equal to post items count";
				return false;
			}
		}
/*
		//拉取购物车中的商品的赠品&配件
		$product_in_cart = array();
		//$multiPriceProduct = array();
		foreach ($itemsInShoppingCart as $item) {
			$product_in_cart[] = $item['product_id'];
		}

		$product_base_info = IProduct::getProductsInfo($product_in_cart, $wh_id, true, true, $destination);
		if (false === $product_base_info) {
			self::$errCode = IProduct::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProduct failed]' . IProduct::$errMsg;
			return false;
		}

		self::Log("抢购商品下单频率检查", false);
		//抢购商品下单频率检查
		$ret = self::checkVisitFrequency($product_base_info, $newOrder);
		if (false === $ret) {
			return false;
		}

		self::Log("IPreOrder获取商品信息");
		$ret = IPreOrderV2::getItemInfo($items, $wh_id, $product_base_info, $destination);
		if (false === $ret) {
			self::$errMsg = IPreOrderV2::$errMsg;
			self::$errCode = IPreOrderV2::$errCode;
			return false;
		}*/





		//$items = $ret['items'];
		self::Log(ToolUtil::gbJsonEncode($items));
        //判断商品是否是节能补贴商品
        if (isset($items[0]['flag'])
            && IProduct::isEnergySubsidyProduct($items[0]['flag'], true)
            && self::esInfoCheck($newOrder)
            && count($items) == 1
        )
        {
            $isEnergySavingType = 2;
        }
        else
        {
            $isEnergySavingType = 1;
        }
		// MARK 接入新的促销批价
		$rule_id = !empty($newOrder['rule_id']) ? intval($newOrder['rule_id']) : 0;
		$promotionRule = IPromotionRuleV2::checkRuleForOrder($items, $wh_id, $uid, $rule_id, $isEnergySavingType);
		if (false === $promotionRule) {
			if(106 == IPromotionRuleV2::$errCode)
			{
				self::$errCode = IPromotionRuleV2::$errCode;
				self::$errMsg = IPromotionRuleV2::$errMsg;
				return array('errCode'=> -991, 'errMsg'=> '抱歉，您参加的活动已结束或终止，请您返回购物车重新操作');
			}
			else if(107 == IPromotionRuleV2::$errCode)
			{
				self::$errCode = IPromotionRuleV2::$errCode;
				self::$errMsg = IPromotionRuleV2::$errMsg;
				return array('errCode'=> -992, 'errMsg'=> "抱歉，您所参与的活动已达到参与次数上限，不能再参加该活动");
			}
			else
			{
				self::$errCode = IPromotionRuleV2::$errCode;
				self::$errMsg = IPromotionRuleV2::$errMsg;
				return false;
			}
		}
		self::Log("\n\tIPromotionRuleV2 result:".ToolUtil::gbJsonEncode($promotionRule));

		$promotion = $promotionRule['promotion'];
		$items = $promotionRule['items'];
		$restricts = $promotionRule['restrict'];

		$ret = self::checkAppointInfo($uid, $items);
		self::Log("检查预约结果" . var_export($ret, true));

		if ($ret == false) {
			return array('errCode'=> self::$errMsg, 'errMsg'=> self::$errCode);
		}


		// 拆分订单，所有需要对items进行改变的操作，请在拆单之前进行
		$divideOrder = IPreOrderV2::DivideOrder($items, $wh_id);
		if (false === $divideOrder) {
			return false;
		}

		// 订单的包裹信息，包括虚库，重量，具体的包裹信息等等
		$isVirtual = $divideOrder['order']['isVirtual'];
		$bVirtual = array();

		//获取商品&赠品&配件信息结束
		//检查前台传入的商品列表 与 购物车中商品列表是否一致 , 同时检查商品，赠品，组件的状态，禁运类型
		$restricted_trans_type = array();
		$shoppingProduct = array();
		$productInShoppingCart = array();

		self::Log("检查前台传入的商品列表 与 购物车中商品列表是否一致");
		//同时检查能否模糊开票，开增值发票
		$isCanVATInvoice = true;
		$c3ids = array();
		reset($newOrder['suborders']);

		while (FALSE != ($subOrder = current($newOrder['suborders'])))
		{
			$subOrderKey = key($newOrder['suborders']);
			$shoppingProduct[$subOrderKey] = array();
			next($newOrder['suborders']);
			foreach ($subOrder['items'] as $orderItem)
			{
				$exist = false;
				foreach ($itemsInShoppingCart as $itemInCart)
				{
					if ($orderItem['product_id'] == $itemInCart['product_id'] ){
						//订购数量不一致
						if ($orderItem['num'] != $itemInCart['buy_count']) {
							return array('errCode'=> -1, 'errMsg'=> "购物车中商品" . $product_base_info[$itemInCart['product_id']]['name'] . "{$orderItem['num']}订购数量不正确，请返回购物车修改数量{$itemInCart['buy_count']}");
						} //商品基本信息不存在
						else if (!isset($product_base_info[$orderItem['product_id']])) {
							return array('errCode'=> -2, 'errMsg'=> "购物车中商品" . $product_base_info[$itemInCart['product_id']]['name'] . "暂不销售，请返回购物车删除");
						} //商品状态不合法
						else if (isset($product_base_info[$orderItem['product_id']]['status']) && $product_base_info[$orderItem['product_id']]['status'] != PRODUCT_STATUS_NORMAL /*&& true != $itemInCart['isPromotionGift'] */) {
							return array('errCode'=> -3, 'errMsg'=> "购物车中商品" . $product_base_info[$itemInCart['product_id']]['name'] . "暂不销售，请返回购物车删除");
						} else if ($product_base_info[$orderItem['product_id']]['psystock'] != $subOrderKey) {
                            self::Log("product_base_info=".ToolUtil::gbJsonEncode($product_base_info)."---".$subOrderKey);
							return array('errCode'=> -3, 'errMsg'=> "购物车中商品" . $product_base_info[$itemInCart['product_id']]['name'] . "信息已经改变，请刷新页面");
						}
						else
						{
							$shoppingProduct[$subOrderKey][$itemInCart['product_id']]['product_id'] = $itemInCart['product_id'];
							$shoppingProduct[$subOrderKey][$itemInCart['product_id']]['OTag'] = $itemInCart['OTag'];
							@$shoppingProduct[$subOrderKey][$itemInCart['product_id']]['buy_count'] += $itemInCart['buy_count'];

							$shoppingProduct[$subOrderKey][$itemInCart['product_id']]['main_product_id'] = $itemInCart['main_product_id'];
							$shoppingProduct[$subOrderKey][$itemInCart['product_id']]['type'] = SHOPPING_CART_PRODUCT_TYPE_NORMAL;
							@$restricted_trans_type[$product_base_info[$orderItem['product_id']]['restricted_trans_type']][] = $orderItem['product_id']; //$product_base_info[$orderItem['product_id']]['restricted_trans_type'];

							if ($product_base_info[$itemInCart['product_id']]['flag'] & CAN_VAT_INVOICE == 0) {
								$isCanVATInvoice = false;
							}

							$c3ids[] = $product_base_info[$itemInCart['product_id']]['c3_ids'];
							$productInShoppingCart[] = $itemInCart['product_id'];
						}
						$exist = true;
						break;
					}
				}
				if (false === $exist) {
					return array('errCode'=> -4, 'errMsg'=> "购物车中商品" .
						(isset($product_base_info[$orderItem['product_id']]) ? $product_base_info[$orderItem['product_id']]['name'] : $orderItem['product_id'])
						. "不存在，请返回购物车删除该商品");
				}


				//查看该商品附送的赠品&配件是否匹配
				foreach ($orderItem['gift'] as $g_p_id)
				{
					if (!isset($product_base_info[$orderItem['product_id']]['gifts'][$g_p_id])) {
						return array('errCode'=>-5, 'errMsg'=>"购物车中赠品/组件" . $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['name'] . "暂时无货，请返回购物车删除");
					}//商品状态不合法
					else if ( isset($product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['status']) &&  $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['status'] == PRODUCT_STATUS_NORMAL) {
						return array('errCode'=>-6, 'errMsg'=>"购物车中赠品/组件" . $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['name'] . "暂时无货，请返回购物车删除");
					}/*else if ($product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['psystock'] != $subOrderKey) {
						return array('errCode'=>-6, 'errMsg'=>"购物车中赠品/组件" . $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['name'] . "信息已改变，请刷新页面");
					}*/
					else
					{
						$shoppingProduct[$subOrderKey][$g_p_id]['product_id'] = $g_p_id;
						@$shoppingProduct[$subOrderKey][$g_p_id]['buy_count'] += $orderItem['num'] * $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['num'];
						$shoppingProduct[$subOrderKey][$g_p_id]['OTag'] = '';
						$shoppingProduct[$subOrderKey][$g_p_id]['main_product_id'] = 0;
						$shoppingProduct[$subOrderKey][$g_p_id]['belongto_product_id'] = $orderItem['product_id'];
						if ($product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['type'] == 1) {
							$shoppingProduct[$subOrderKey][$g_p_id]['type'] = SHOPPING_CART_PRODUCT_TYPE_ZUJIAN;
						}else
						{
							$shoppingProduct[$subOrderKey][$g_p_id]['type'] = SHOPPING_CART_PRODUCT_TYPE_GIFT;
						}
						@$restricted_trans_type[$product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['restricted_trans_type']][] = $g_p_id; // = $product_base_info[$gift['gift_id']]['restricted_trans_type'];
						$exist = true;
						$productInShoppingCart[] = $g_p_id;
					}
				}
			}
		}


		 foreach($items as $it)
		 {
		 	$pid = $it['product_id'];
		 	$subOrderKey = $it['psystock'];
		 	if(isset($shoppingProduct[$subOrderKey][$pid]))
		 	{

		 		if(empty($shoppingProduct[$subOrderKey][$pid]['total_price'])) {
		 			$shoppingProduct[$subOrderKey][$pid]['total_price'] = 0;
		 			$shoppingProduct[$subOrderKey][$pid]['promotion_total_price'] = 0;
		 		}


		 		// 累加多价后的总价
		 		$shoppingProduct[$subOrderKey][$pid]['total_price'] += $it['total_price_after'];
		 		$shoppingProduct[$subOrderKey][$pid]['promotion_total_price'] += $it['promotion_price'];
		 	}
		 }

		 foreach($shoppingProduct as $subOrderKey => $so)
		 {
		 	foreach($so as $pid => $pInfo)
		 	{
		 		// 重新计算每个商品的单价
		 		$shoppingProduct[$subOrderKey][$pid]['price'] = intval($pInfo['total_price'] / $pInfo['buy_count']);
		 	}
		 }
        self::Log("shopping Product==>".print_r($shoppingProduct, true));

		self::Log("验证是否可以开增值税发票");
		//验证是否可以开增值税发票

		if ($isCanVATInvoice === false && $newOrder['invoiceType'] == INVOICE_TYPE_VAT) {
			return array('errCode'=> -20, 'errMsg'=> '您的订单中有商品不能开增值税发票');
		}


		// android 深圳站订单发票转换
		if (isset($newOrder['ls']) && in_array($newOrder['ls'], array('--android--')) && $wh_id == SITE_SZ) {
			if ($newOrder['invoiceType'] == INVOICE_TYPE_RETAIL_COMPANY || $newOrder['invoiceType'] == INVOICE_TYPE_RETAIL_PERSONAL)
				$newOrder['invoiceType'] = INVOICE_TYPE_VAT_NORMAL;
		}

		//如果选择整机服务，不能选择货到付款

		self::Log("验证选择整机安装");
		//选择整机安装，不能选择货到付款
		global $_PAY_MODE;
		if ($_PAY_MODE[$wh_id][$newOrder['payType']]['PayTypeName'] == '货到付款') {
			global $_NotPayWhenArrive;
			$bothExist = array_intersect($_NotPayWhenArrive, $productInShoppingCart);
			if (count($bothExist) != 0) {
				return array('errCode'=> -22, 'errMsg'=> '您选择了整机安装服务，不能选择货到付款支付方式');
			}
		}

		//检测某些特殊不包含在购物车中，则不能选择自提点
		//如果不包含这些特殊商品，需要剔除自提

		self::Log("验证选择自提");
		global $_SelfFetchProductids;
		global $_LGT_MODE;
		//如果选择的是上门自提方式，需要检测购物车中存在特定商品
		if (false !== strpos($_LGT_MODE[$newOrder['shipType']]['ShipTypeName'], '上门提货')) {
			$bothExist = array_intersect($_SelfFetchProductids, $productInShoppingCart);
			if (count($bothExist) == 0) {
				return array('errCode'=> -29, 'errMsg'=> '对不起，您所购买的商品不能选择上门提货');
			}
		}

		self::Log("验证您提交发票内容");
		$invoinceContent = IPreOrderV2::getInvoicesContentOpt($c3ids,$wh_id);
		if($newOrder['isVat'] == self::HAS_INVOICE)
		{
			if (!in_array($newOrder['invoiceContent'], $invoinceContent)) {
				return array('errCode'=>-21, 'errMsg'=>'您提交发票内容不合法');
			}
		}

		        //$shoppingProduct 这里是根据前端进行了拆单后的数据了，这里含有了赠品和组件的信息，赠品和组件当作一条商品数据
		// reset($items);
  //       foreach($items as $it)
		// {
		// 	$pid = $it['product_id'];
  //           $subOrderKey = $it['divide_id'];
		// 	if(isset($shoppingProduct[$subOrderKey][$pid]))
		// 	{
		// 		if(empty($shoppingProduct[$subOrderKey][$pid]['total_price']))
  //               {
		// 			$shoppingProduct[$subOrderKey][$pid]['total_price'] = 0;
  //                   $shoppingProduct[$subOrderKey][$pid]['promotion_total_price'] = 0;
  //               }
		// 		//累加多价后的总价
		// 		$shoppingProduct[$subOrderKey][$pid]['total_price'] += $it['total_price_after'];
  //               $shoppingProduct[$subOrderKey][$pid]['promotion_total_price'] += $it['promotion_price'];
		// 	}
  //           else
  //           {
  //               $shoppingProduct[$subOrderKey][$pid]['promotion_total_price'] = $it['promotion_price'];
  //           }
		// }

		foreach($shoppingProduct as $subOrderKey => $so)
		{
			foreach($so as $pid => $pInfo)
			{
				// 重新计算每个商品的单价
				$shoppingProduct[$subOrderKey][$pid]['price'] = intval($pInfo['total_price'] / $pInfo['buy_count']);
			}
		}

		//删除禁运类型0（不限运）
		unset($restricted_trans_type[0]);
		unset($gifts);
		//检查前台传入的购物车内容 与 后台购物车内容 一致完毕


		//优惠券检测
		self::Log("优惠券检测");
		$couponInfo = array('amt'=>0, 'code'=>'', 'type'=>0);
        //节能补贴商品临时搞搞 Start
        if(2 == $isEnergySavingType && isset($newOrder['couponCode']))
        {
            $newOrder['couponCode'] = "";
        }
        //节能补贴商品临时搞搞 End
		if (isset($newOrder['couponCode']) && $newOrder['couponCode'] != "" ) {
			if ( (isset($newOrder['ls'])) && ( in_array($newOrder['ls'], array('--android--','--iphone--'))) )
			{
				$couponInfo = ICoupon::checkAppCoupon($uid, $newOrder['couponCode'], $newOrder['receiveAddrId'], $newOrder['payType'] ,$wh_id,$itemsInShoppingCart);
			}
			else if (in_array($newOrder['ls'], array('--mobile--'))){
				$couponInfo = ICouponV2::checkCoupon($uid, $newOrder['couponCode'], $newOrder['receiveAddrId'], $newOrder['payType'] ,$wh_id, 1);
			}
			else {
				$couponInfo = ICouponV2::checkCoupon($uid, $newOrder['couponCode'], $newOrder['receiveAddrId'], $newOrder['payType'] ,$wh_id, 0);
			}
			if (false === $couponInfo) {
				self::$errCode = ICouponV2::$errCode;
				self::$errMsg = ICouponV2::$errMsg;
				//return false;
				return array('errCode' => self::$errCode, 'errMsg' => self::$errMsg);
			}
		}
		/*
		 * MARK 去掉EDM逻辑
		self::Log("开始计算EDM专享");
		$product_base_info = IPreOrderV2::getEDMInfo($userInfo, $wh_id, $product_base_info);
		if (false === $product_base_info) {
			self::$errCode = IPreOrderV2::$errCode;
			self::$errMsg = IPreOrderV2::$errMsg;
			return false;
		}*/

		//处理邮件专享价格完毕

		$pointMax = 0;
		$pointMin = 0;
		global $_OrderState;
		$limitedProduct = array();

		self::Log("获取可用积分范围");
		reset($shoppingProduct);
		while (FALSE != ($subOrderItem = current($shoppingProduct))) {
			$subOrderKey = key($shoppingProduct);
			next($shoppingProduct);

			foreach ($subOrderItem as $item)
			{
				if ($item['type'] != SHOPPING_CART_PRODUCT_TYPE_NORMAL) {
					continue;
				}
				$exist = isset($product_base_info[$item['product_id']]) ? true : false;
				if (false === $exist) {
					return array('errCode'=> -9, 'errMsg'=> "购物车中商品" . $product_base_info[$item['product_id']]['name'] . "暂不销售，请返回购物车删除");
				}
				$p = $product_base_info[$item['product_id']];


				if ($p['num_limit'] > 0 && $p['num_limit'] < 999) {
					if ($p['num_limit'] < $item['buy_count']) {
						return array('errCode'=> -8, 'errMsg'=> "购物车中商品" . $product_base_info[$item['product_id']]['name'] . "超过限购数量" . $p['num_limit']);
					}
					$limitedProduct[$p['product_id']] = $subOrderKey;
				}
                //可用积分使用多价前还是后
				if ($p['point_type'] != PRODUCT_CASH_PAY_ONLY) {
					$pointMax += ($p['price'] /*+ $p['cash_back'] */) * $shoppingProduct[$subOrderKey][$p['product_id']]['buy_count'];
				}

				if ($p['point_type'] == PRODUCT_POINT_PAY_ONLY) {
					$pointMin += $p['price'] * $shoppingProduct[$subOrderKey][$p['product_id']]['buy_count'];
				}

			}
		}

		//如果购物车中商品有限购商品，则查询该用户当天的订单
		//这里部署外网需要修改分库分表的问题,多价的限购是否未考虑？
        reset($items);
        foreach($items as $item)
        {
            if(1 == $item['price_buy_limit_flag'])
            {
                return array('errCode'=> -8, 'errMsg'=> "购物车中商品" . $item['name'] . "超过限购数量" . $item['mult_limit_num']);
            }
        }
		self::Log("检查限购商品");
		$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
		if (!empty($limitedProduct)) {
			$timestamp = mktime(0,0,0,date('m'), date('d'), date('Y') );

			$sql = "select product_id, sum(buy_num) as buy_num from
			t_order_items_{$db_tab_index['table']} ot,
			t_orders_{$db_tab_index['table']} o
			where o.order_char_id=ot.order_char_id".
				" and o.status<>". $_OrderState['ManagerCancel']['value'] .
				" and o.status<>". $_OrderState['CustomerCancel']['value'].
				" and o.status<>". $_OrderState['EmployeeCancel']['value']." and ot.uid=" . $uid. " and create_time > " . $timestamp .
				" and product_id in(" . implode(',', array_keys($limitedProduct)) . ") group by product_id";


			$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
			if (empty($orderDb)) {
				self::$errCode = Config::$errCode;
				self::$errMsg = Config::$errMsg;
				return false;
			}
			$userOrder = $orderDb->getRows($sql);
			if (false === $userOrder) {
				self::$errCode = $orderDb->errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[query order db failed]' . $orderDb->errMsg;
				return false;
			}

			if (!empty($userOrder)) {
				foreach ($userOrder as $order)
				{
					if ($order['buy_num'] >= $product_base_info[$order['product_id']]['num_limit']) {
						return array('errCode'=>-11, 'errMsg'=>"购物车中商品" . $product_base_info[$order['product_id']]['name'] . "是限购商品，您今日购买数量已经超过限购数量");
					}
					else if ($order['buy_num'] + $shoppingProduct[$limitedProduct[$order['product_id']]][$order['product_id']]['buy_count'] > $product_base_info[$order['product_id']]['num_limit']) {
						return array('errCode'=>-12, 'errMsg'=>"购物车中商品" . $product_base_info[$order['product_id']]['name'] .
							"是限购商品，您今日还能购买" . ($product_base_info[$order['product_id']]['num_limit'] - $order['buy_num']) . "个" );
					}
				}
			}
		}
        //加一下多价的限购吧

		self::Log("开始检查库存");
		$msSQL = ToolUtil::getMSDBObj('Inventory_Manager');
		if (empty($msSQL)) {
			self::$errCode = Config::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "query ms sql faild " . Config::$errMsg;
			return false;
		}

		$sql = "select SysNo, ProductSysNo, StockSysNo, AvailableQty, VirtualQty, OrderQty from Inventory_Stock where ProductSysNo in (" . implode(",", $productInShoppingCart) . ")";
		$productStocks = $msSQL->getRows($sql);

		if (false === $productStocks) {
			self::$errCode = $msSQL->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "query ms sql faild " . $msSQL->errMsg;
			return false;
		}

		$giftLackOfStock = array();
		$lackGiftAndIgnore = false;
		$containVirtual = array();
		$easyKey = array();

		self::Log("赠品");

		reset($shoppingProduct);
		while (FALSE != ($subOrderItem = current($shoppingProduct))) {
			$subOrderKey = key($shoppingProduct);
			next($shoppingProduct);

			foreach ($subOrderItem as $kk => $sp)
			{
				//获取随心配商品的主商品
				if ($sp['type'] === SHOPPING_CART_PRODUCT_TYPE_NORMAL && $sp['main_product_id'] != 0) {
					$easyKey[$sp['main_product_id']] = $sp['main_product_id'];
				}
				//获取随心配商品的主商品

				$exist = false;
				foreach ($productStocks as $pstock)
				{
					if ($sp['product_id'] == $pstock['ProductSysNo'] && $subOrderKey == $pstock['StockSysNo']) {
						$exist = true;
						if (($pstock['AvailableQty'] + $pstock['VirtualQty'] <= 0) && $sp['type'] != SHOPPING_CART_PRODUCT_TYPE_GIFT) {
							IInventoryStockTTC::update(array('product_id'=>$sp['product_id'], 'num_available'=>$pstock['AvailableQty'], 'virtual_num'=> $pstock['VirtualQty']), array('sys_no'=>$pstock['SysNo']));
							if($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_ZUJIAN)
							{
								return array('errCode'=>-15, 'errMsg'=>'组件'.$product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name']."库存不足,请联系客服");
							}
							return array('errCode'=>-14, 'errMsg'=>'商品'.$product_base_info[$sp['product_id']]['name']."库存不足");
						}
						if ($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_GIFT) //赠品
						{
							if ($pstock['AvailableQty'] + $pstock['VirtualQty'] < $sp['buy_count']) {
								IInventoryStockTTC::update(array('product_id'=> $sp['product_id'], 'num_available'=> $pstock['AvailableQty'], 'virtual_num'=> $pstock['VirtualQty']), array('sys_no'=> $pstock['SysNo']));
								if (!isset($newOrder['ingoreLackOfGift'])) { //如果第一次提交订单
									$giftLackOfStock[$sp['product_id']] = $product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name'];
								} else if ($newOrder['ingoreLackOfGift'] == 1) { //用户接受缺少礼品
									$shoppingProduct[$subOrderKey][$kk]['buy_count'] = $pstock['AvailableQty'] + $pstock['VirtualQty'];
									if ($shoppingProduct[$subOrderKey][$kk]['buy_count'] <= 0) {
										unset($shoppingProduct[$subOrderKey][$kk]);
									}
									$lackGiftAndIgnore = true;
								} else //用户不接受，则拒绝下单
								{
									return array('errCode'=> -13, 'errMsg'=> '赠品' . $product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name'] . "库存不足");
								}
							}
						} else if ($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_ZUJIAN) {
							if ($pstock['AvailableQty'] + $pstock['VirtualQty'] < $sp['buy_count']) {
								return array('errCode'=> -15, 'errMsg'=> '组件' . $product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name'] . "库存不足,请联系客服");
							}
						} else //主商品
						{
							if ($pstock['AvailableQty'] < $sp['buy_count']) {
								$bVirtual[$subOrderKey] = true;

							}
							if (($pstock['AvailableQty'] + $pstock['VirtualQty'] < $sp['buy_count']) &&
								(($wh_id != 1) || ($product_base_info[$sp['product_id']]['flag'] & FORBID_SET_VIRTUAL) == FORBID_SET_VIRTUAL ||
									$product_base_info[$sp['product_id']]['type'] != PRODUCT_TYPE_NORMAL)
							) {
								return array('errCode'=> -15, 'errMsg'=> '商品' . $product_base_info[$sp['product_id']]['name'] . "库存不足");
							}
						}
						$product_base_info[$sp['product_id']]['AvailableQty'] = $pstock['AvailableQty'];
						$product_base_info[$sp['product_id']]['VirtualQty'] = $pstock['VirtualQty'];
						break;
					}
				}
				if (false === $exist) {
					return array('errCode'=> -16, 'errMsg'=> '商品' . $product_base_info[$sp['product_id']]['name'] . "暂不销售");
				}
			}
		}


		if (count($giftLackOfStock) != 0) {
			$errMsg = "购物车中赠品:";
			foreach ($giftLackOfStock as $key=>$name)
			{
				$errMsg .= $name . "库存不足,";//仅剩下" . $num ."件,";
			}
			$errMsg .= "是否继续下单?";
			return array('errCode'=> -100, 'errMsg'=> $errMsg);
		}

		// 添加提示
		if ($lackGiftAndIgnore) {
			$newOrder['comment'] .= "\n系统自动备注：用户已接受缺货赠品库存不足。";
		}

		//库存检查结束
		$isEnergySubsidyOrder = false;

		//检查禁运类型
		self::Log("检查禁运类型");
		global $_District;
		$shipTypeNotAva = IShipping::getForbidenShippingType($restricted_trans_type, $_District[$newOrder['receiveAddrId']]['province_id'], $_District[$newOrder['receiveAddrId']]['city_id'], $newOrder['receiveAddrId'], $wh_id);
		if (false === $shipTypeNotAva) {
			self::$errCode = -2031;
			self::$errMsg = '获取禁运类型->运送方式失败';
			return false;
		}

		$shipTypeNotAva = array_keys($shipTypeNotAva);
		if (in_array($newOrder['shipType'], $shipTypeNotAva)) {
			return array('errCode'=> -17, 'errMsg'=> "购物车中有商品不支持您选择的运送方式");
		}
		//检查禁运类型失败

		/*
		 * MARK 去除随心配的逻辑
		//拉取随心配
		//ixiuzeng添加，广东站的随心配从广东站获取，上海和北京的随心配依然从上海获取
		$wh_id_temp = NULL;
		if (1001 == $wh_id) {
			$wh_id_temp = 1001;
		}
		else {
			$wh_id_temp = 1;
		}
		self::Log("随心配", false);
		$easyMatch = IProductRelativityTTC::gets($easyKey, array('type'=> PRODUCT_BY_MIND, 'status'=> 1, 'wh_id' => $wh_id_temp));
		if (false === $easyMatch) {
			self::$errCode = IProductRelativityTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductRelativityTTC failed]' . IProductRelativityTTC::$errMsg;
			return false;
		}

		//拉取随心配商品结束
		//计算随心配应该优惠的价格&套数
		$actpid = 0;
		reset($shoppingProduct);
		while (FALSE != ($subOrderItem = current($shoppingProduct))) {
			$subOrderKey = key($shoppingProduct);
			next($shoppingProduct);

			foreach ($subOrderItem as $sp)
			{
				if ($sp['type'] != SHOPPING_CART_PRODUCT_TYPE_NORMAL) {
					continue;
				}
				$actpid = $sp['product_id'];
				if ($sp['main_product_id'] == 0) {
					continue;
				}
				$mainProductGroup = isset($product_base_info[$sp['main_product_id']])? $product_base_info[$sp['main_product_id']]['psystock'] : -1;
				if(isset($shoppingProduct[$mainProductGroup][$sp['main_product_id']]))
				{
					$buy_count_tmp = $sp['buy_count'] - (isset($bc_suite[$sp['product_id']]) ? $bc_suite[$sp['product_id']] : 0);
					$mp_count = $shoppingProduct[$mainProductGroup][$sp['main_product_id']]['buy_count'] - (isset($bc_suite[$sp['main_product_id']]) ? $bc_suite[$sp['main_product_id']] : 0);
					$matchItems = min($buy_count_tmp,$mp_count);
				}
				else
				{
					$matchItems = 0;
				}
				$shoppingProduct[$subOrderKey][$sp['product_id']]['matchNum'] = $matchItems;
				$shoppingProduct[$subOrderKey][$sp['product_id']]['cashCutPerItem'] = 0;
				foreach ($easyMatch as $em)
				{
					if ($em['product_id'] == $sp['main_product_id'] && $em['relative_id'] == $sp['product_id']) {
						$cashCut = intval($em['property']) > 0? intval($em['property']) : 0;
						//这里需要和随心配商品的成本价比较么？ 不比较太危险了
						$shoppingProduct[$subOrderKey][$sp['product_id']]['cashCutPerItem'] = $cashCut;
						break;
					}
				}
			}
		}
		*/
		//随心配检查完成

		//计算价格
		$orderPrice = 0;
		$totalWeight = 0;
		$totalCut = 0;

		global $_ProductType;
		global $ProductForNongHang;
		$subOrders = array();
		$has_service = false;
		$is_energy_subsidy_order = false;
		foreach ($shoppingProduct as $subOrderKey => $subOrderItem) {
			foreach ($subOrderItem as $sp) {
				$subOrders[$subOrderKey]['product_ids'][] = $sp['product_id']; //clark 记录商品ID

				$totalWeight += $sp['buy_count'] * $product_base_info[$sp['product_id']]['weight'];
				@$subOrders[$subOrderKey]['totalWeight'] += $sp['buy_count'] * $product_base_info[$sp['product_id']]['weight'];

				if (!isset($subOrders[$subOrderKey]['flag'])) {
					$subOrders[$subOrderKey]['flag'] = 0;
				}

				if ($product_base_info[$sp['product_id']]['type'] == $_ProductType['Service']) {
					$subOrders[$subOrderKey]['flag'] |= ORDER_HAS_SERVICE; //记录订单中是否有服务类商品
					$has_service = true;
				}

				if (in_array($sp['product_id'], $ProductForNongHang)) {
					$subOrders[$subOrderKey]['flag'] |= ORDER_NONGHANG; //订单中包含农行商品
					$newOrder['isVat'] = self::NO_INVOICE; //则不开发票
				}

				if (isset($userInfo['type'])) {
					global $_USER_TYPE;
					if ($_USER_TYPE['EnterpriseUser'] == $userInfo['type']) {
						$subOrders[$subOrderKey]['flag'] |= ORDER_ENTERPRISE_USER;
					}
					else if ($_USER_TYPE['ChaohuoUser'] == $userInfo['type'])
					{
						$subOrders[$subOrderKey]['flag'] |= ORDER_CHAOHUO_USER;
					}else if ($_USER_TYPE['WholeSalerUser'] == $userInfo['type'])
					{
						$subOrders[$subOrderKey]['flag'] |= ORDER_WHOLESALER_USER;
					}else if ($_USER_TYPE['RetailersUser'] == $userInfo['type'])
					{
						$subOrders[$subOrderKey]['flag'] |= ORDER_RETAILERS_USER;
					}
				}
                //商品价格  sheldonshi
                $product_base_info[$sp['product_id']]['price'] = $sp['price'];

				if ($sp['type'] != SHOPPING_CART_PRODUCT_TYPE_NORMAL) {
					continue;
				}
				/*
				 * MARK 订单总价累计，更换字段，并添加新的逻辑
				@$subOrders[$subOrderKey]['orderPrice'] += $product_base_info[$sp['product_id']]['price'] * $sp['buy_count'];
				$orderPrice += $product_base_info[$sp['product_id']]['price'] * $sp['buy_count'];
				*/

				/*
				 * MARK 随心配 cash_back，去除，并添加新的逻辑
				if ($sp['main_product_id'] > 0 && $sp['matchNum'] > 0) {
					$orderPrice -= $sp['matchNum'] * $sp['cashCutPerItem'];
					@$subOrders[$subOrderKey]['orderPrice'] -= $sp['matchNum'] * $sp['cashCutPerItem'];
					$totalCut += $sp['matchNum'] * $sp['cashCutPerItem'];
					@$subOrders[$subOrderKey]['totalCut'] += $sp['matchNum'] * $sp['cashCutPerItem'];
				}
				 *
				 */



				//ixiuzeng添加，订单中含有套餐时，优惠价格计入返现值
				/*
				if(isset($itemsInShoppingCart[$sp['product_id']]))
				{
					@$orderPrice -= $itemsInShoppingCart[$sp['product_id']]['cash_back'];
					self::Log("3,".$orderPrice);
					@$subOrders[$subOrderKey]['orderPrice'] -= $itemsInShoppingCart[$sp['product_id']]['cash_back'];

					@$totalCut += $itemsInShoppingCart[$sp['product_id']]['cash_back'];
					@$subOrders[$subOrderKey]['totalCut'] += $itemsInShoppingCart[$sp['product_id']]['cash_back'];
				}*/

				//ixiuzeng添加,订单中含有限时抢购或者二手商品，增加一个标志位
				if ((TIME_LIMITED_RUSHING_BUY == ($product_base_info[$sp['product_id']]['flag'] & TIME_LIMITED_RUSHING_BUY)
					|| OTHER_TIME_LIMITED_RUSHING_BUY == ($product_base_info[$sp['product_id']]['flag'] & OTHER_TIME_LIMITED_RUSHING_BUY)
					|| ($product_base_info[$sp['product_id']]['type'] == $_ProductType['SecondHand']))
					&& $_PAY_MODE[$wh_id][$newOrder['payType']]['IsNet'] == 1 ) {

					if (!isset($subOrders[$subOrderKey]['flag'])) {
						$subOrders[$subOrderKey]['flag'] = ORDER_RUSHING_BUY_ONLINE_PAY;
					}
					else {
						$subOrders[$subOrderKey]['flag'] = $subOrders[$subOrderKey]['flag'] | ORDER_RUSHING_BUY_ONLINE_PAY;
					}
				}

				// 如果是节能补贴商品，而且补贴身份信息完整，则判定为节能补贴订单
				if (PRODUCT_ENERGY_SUBSIDY == ($product_base_info[$sp['product_id']]['flag'] & PRODUCT_ENERGY_SUBSIDY)
                    && self::esInfoCheck($newOrder))
                {

                    //if(self::esInfoCheck($newOrder))
                    //{
                		$isEnergySubsidyOrder = TRUE;
                        $is_energy_subsidy_order = TRUE;
                        if (!isset($subOrders[$subOrderKey]['flag'])) {
                            $subOrders[$subOrderKey]['flag'] = ORDER_ENERGY_SUBSIDY;
                        }
                        else
                        {
                            $subOrders[$subOrderKey]['flag'] = $subOrders[$subOrderKey]['flag'] | ORDER_ENERGY_SUBSIDY;
                        }
                    //}
                    /*
                    else
                    {
                        return array('errCode' => 6002,'errMsg'=> "使用了节能补贴优惠，但是没有身份信息或信息错误");
                    }
                    */
				}
			}
		}

		if (!empty($promotion)) {
            //这里分支逻辑只处理了立减
			switch($promotion['benefit_type'])
			{
				case IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_CASH']:
					// 立减，记录优惠的总价
					$rule_discount = $promotion['benefits'];
					break;
				default:
					$rule_discount = 0;
					break;

			}
			$couponInfo['code'] = "rule_{$promotion['rule_id']}";
			$couponInfo['type'] = $promotion['account_type'];
			$couponInfo['amt'] = $rule_discount;
			$couponInfo['subOrders'] = array();
		}


		// MARK 处理批价结果
		reset($items);
		// 参加促销规则的商品总金额
		//$promotionAmt = 0;
        //批价明细
        $priceDetails = array();
        $energySaveDiscount = 0;
		foreach($items as $it)
		{
			$it_str = ToolUtil::gbJsonEncode($it);
			$subOrderKey = $it['psystock'];
            Logger::info("it_str [{$it_str}]");
			// MARK 商品的核对价格，这个$pPrice定义需要确认
			if( $it['package_id'] == 0 )
			{
				// 经过批价的商品，该商品的总的减免价格
				//$ptotalCut = $it['total_price_discount'] + $it['promotion_discount'];
                $ptotalCut = 0;
                //统一订单双写 S
                //是否有随心配
                if ($it['main_product_id'] > 0 && $it['match_num'] > 0) {
                    $ptotalCut = $it['match_num'] * $it['match_cut'];
                }
                //统一订单双写 E

				// 该商品的多价后，促销前的价格
				// $pPrice = $it['promotion_price'] + $it['promotion_discount'];
				$pPrice = $it['total_price_after'];

				//统一订单双写 S
                @$subOrders[$subOrderKey]['total_pkg_cut'] += 0;
                @$subOrders[$subOrderKey]['total_match_cut'] += $ptotalCut;
                //统一订单双写 E
				self::Log("普通商品【{$it['package_id']}】,该商品的总的减免价格{$ptotalCut},该商品的最终总价格{$pPrice},$it_str");
			}
			else
			{
				// 套餐商品，未经过批价，其总的减免价格
				//$ptotalCut = $it['total_price_discount'] + $it['cash_back'] * $it['buy_count'];
                $ptotalCut = $it['cash_back'] * $it['buy_count'];
                //统一订单双写 S
                if ($it['main_product_id'] > 0 && $it['match_num'] > 0) {
                    $ptotalCut += $it['match_num'] * $it['match_cut'];
                }
                //统一订单双写 E
				//$pPrice = $it['promotion_price'] + $it['promotion_discount'] - $it['cash_back'] * $it['buy_count'];
				//$pPrice = $it['total_price_after'] - $it['cash_back'] * $it['buy_count'];
				$pPrice = $it['total_price_after'] - $ptotalCut;

				//统一订单双写 S
                @$subOrders[$subOrderKey]['total_pkg_cut'] += $it['cash_back'] * $it['buy_count'];
                @$subOrders[$subOrderKey]['total_match_cut'] += $it['match_num'] * $it['match_cut'];
                //统一订单双写 E

				self::Log("套餐商品【{$it['package_id']}】,该商品的总的减免价格{$ptotalCut},该商品的最终总价格{$pPrice},$it_str");
			}


			// 促销优惠以优惠卷的形式记录，分摊到每个子订单
			@$couponInfo['subOrders'][$subOrderKey]['coupon_amt'] += $it['promotion_discount'];
			if($it['promotion_discount'] > 0)
            {
				@$couponInfo['subOrders'][$subOrderKey]['pids'][] = $it['product_id'];
                @$couponInfo['subOrders'][$subOrderKey]['apport'][$it['product_id']] += $it['promotion_discount'];

            }
			// 记录到订单
			@$subOrders[$subOrderKey]['orderPrice'] += $pPrice;
			@$subOrders[$subOrderKey]['totalCut'] += $ptotalCut;

			$t = $orderPrice + $pPrice;
			self::Log("$orderPrice + $pPrice = $t");

			$orderPrice += $pPrice;
			@$totalCut += $ptotalCut;
            if($is_energy_subsidy_order && 0 == $energySaveDiscount)
            {
                $energySaveDiscount = $it['energy_save_discount'];
                $product_base_info[$it['product_id']]['price'] += $energySaveDiscount;
                @$couponInfo['subOrders'][$subOrderKey]['coupon_amt'] = $energySaveDiscount;
                @$couponInfo['subOrders'][$subOrderKey]['pids'][] = $it['product_id'];
                //@$subOrders[$subOrderKey]['totalCut'] = 0;
                //@$subOrders[$subOrderKey]['orderPrice'] += $energySaveDiscount;
            }
            //这里加入批价明细吧，不了没地方加了
            self::setPriceDetail($priceDetails, $it, $wh_id);
		}
		self::Log("分摊后：".ToolUtil::gbJsonEncode($couponInfo));

		/*  mark 前面在设置 $has_service 的时候已经打上了 flag，这里不知道为什么还要再打一次
		if (true === $has_service) //如果包含服务类订单，则将所有的子订单的flag都置为此类订单
		{
			foreach($subOrders as $key => $so)
			{
				$subOrders[$key]['flag'] |= ORDER_HAS_SERVICE;
			}
		}
		*/

		if ($newOrder['payType'] == COD) { //货到付款抹去分
			self::Log("货到付款去分之前,$orderPrice");
			$orderPrice = 0;
			self::Log("4,".$orderPrice);
			foreach ($subOrders as $subOrderKey => $so) {
				$subOrders[$subOrderKey]['orderPrice'] = 10 * bcdiv($subOrders[$subOrderKey]['orderPrice'], 10, 0);
				$orderPrice += $subOrders[$subOrderKey]['orderPrice'];
				self::Log("货到付款抹去分,+{$subOrders[$subOrderKey]['orderPrice']}:".$orderPrice);
			}
		}
        //前端提交的价格也是多价后的价格
		if (bccomp($orderPrice, $newOrder['Price'], 0) != 0) {
			self::$errCode = -2031;
			self::$errMsg = "总价：后台计算的订单价格{$orderPrice}与前台提交价格{$newOrder['Price']}不一致";
			return false;
		}
        //前端分单的子单价格
		foreach ($subOrders as $subOrderKey=> $so) {
			if (bccomp($so['orderPrice'], $newOrder['suborders'][$subOrderKey]['price'], 0) != 0) {
				self::$errCode = -2030;
				self::$errMsg = "子订单{$subOrderKey}：后台计算的订单价格{$so['orderPrice']}与前台提交价格{$newOrder['suborders'][$subOrderKey]['price']}不一致";
				return false;
			}
		}

        //节能补贴临时搞搞 Start
        if($is_energy_subsidy_order)
        {
            $couponInfo['amt'] = $energySaveDiscount;
            $couponInfo['code'] = "jieneng";
            $couponInfo['type'] = 1;
            $orderPrice += $energySaveDiscount;
            foreach ($subOrders as $subOrderKey=> $so) {
               @$subOrders[$subOrderKey]['orderPrice'] = $so['orderPrice'] + $energySaveDiscount;
               //@$couponInfo['subOrders'][$subOrderKey]['apport'][$so['product_ids'][0]] = $energySaveDiscount;
            }
        }
        self::Log("orderPrice==>".print_r($subOrders, true));
        //节能补贴临时搞搞 End
		self::Log("计算的订单价格与前台订单价格一致", false);

		$pointMax -= $totalCut;
		$pointMax /= 10;
		$pointMax = ceil($pointMax < $orderPrice ? $pointMax : $orderPrice);
		$pointMax *= 10;
		$pointMin = ceil($pointMin);
		//计算价格结束

		self::Log("检查积分使用情况", false);
		//检查积分使用情况
		if ($newOrder['point'] < $pointMin || $newOrder['point'] > $pointMax) {
			return array('errCode'=> -10, 'errMsg'=> "您本次订单最少需使用" . ($pointMin / 10) . "个积分,最多能使用" . ($pointMax / 10) . "个积分");
		}

		//拉取用户积分，确保用户使用的积分不超过其拥有的积分,并计算分别需要的现金积分和促销积分，优先使用现金积分
		$cash_point_used = 0;
		$promotion_point_used = 0;
		if ($newOrder['point'] > 0 )
		{
			if($newOrder['point'] / 10 < $userInfo['cash_point'] || $newOrder['point'] / 10 == $userInfo['cash_point'])
			{
				$cash_point_used = $newOrder['point'];
			}
			else if($newOrder['point'] / 10 > $userInfo['cash_point'] && (($newOrder['point'] / 10 < ($userInfo['cash_point']+$userInfo['promotion_point']))
				|| ($newOrder['point'] / 10 == ($userInfo['cash_point']+$userInfo['promotion_point']))))
			{
				$cash_point_used = ($userInfo['cash_point'] <0) ? 0 : $userInfo['cash_point'] * 10;
				$promotion_point_used = $newOrder['point'] - $cash_point_used;
			}
			else
			{
				return array('errCode'=>-34, 'errMsg'=>"您账户积分总额为{$userInfo['valid_point']}，最多只能使用{$userInfo['valid_point']}个积分");
			}
		}

		// MARK: 根据变量引用关系，移动位置到此处, 并按照新的 $BenfitTypeNew 来计算
		//如果使用了促销规则，采用优惠卷的方式记录到DB中
		/*if (!empty($promotion)) {

			//
			$rule_discount = 0;
			//换购
			if ($promotion['benefit_type'] == IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_HUANGOU'] &&
				isset($product_base_info[$promotion['discount']])){
				$dis = ($product_base_info[$promotion['discount']]['price'] >= $promotion['plus_con'])? ($product_base_info[$promotion['discount']]['price'] - $promotion['plus_con']) : 0;
				$rule_discount = $promotion['benefit_times'] * $promotion['benefit_per_time'] * $dis;
			}
			//赠送商品
			else if ($promotion['benefit_type'] == IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_PRODUCT'] &&
				isset($product_base_info[$promotion['discount']])) {
				$rule_discount = $product_base_info[$promotion['discount']]['price'] * $promotion['benefit_times'] * $promotion['benefit_per_time'];
			}else if ($promotion['benefit_type'] == IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_CASH'])
			{
				$rule_discount = $promotion['benefit_times'] * $promotion['benefit_per_time'];
			}
			else if ($promotion['benefit_type'] == IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_DISCOUNT'])
			{
				$rule_discount = $promotion['discount'];
			}

			switch($promotion['benefit_type'])
			{
				case IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_CASH']:
					// 立减，记录优惠的总价
					$rule_discount = $promotion['benefits'];
					break;
				case IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_COUPON']:
					// 赠券
					break;
				default:
					break;

			}


			$couponInfo['code'] = "rule_{$promotion['rule_id']}";
			$couponInfo['type'] = $promotion['account_type'];
			$couponInfo['amt'] = $rule_discount;
			$couponInfo['subOrders'] = array();
			//将符合促销规则的商品按子订单分组


			foreach ($itemsInShoppingCart as $item) {
				if (isset($item['isPromotionGift']) && $item['isPromotionGift'] === true) {
					continue;
				}
				if (in_array($item['product_id'], $promotion['pids'])) {
					$promotionAmt += $product_base_info[$item['product_id']]['price'] * $item['buy_count'];
					@$couponInfo['subOrders'][$product_base_info[$item['product_id']]['psystock']]['orderAmt'] += $product_base_info[$item['product_id']]['price'] * $item['buy_count'];
					@$couponInfo['subOrders'][$product_base_info[$item['product_id']]['psystock']]['pids'][] = $item['product_id'];
				}
			}


			//

			self::Log("分摊优惠券金额到各个子单");
			self::Log("分摊前总金额$promotionAmt".ToolUtil::gbJsonEncode($couponInfo));
			//分摊优惠券金额到各个子单
			if ($couponInfo['amt'] == 0) {
				foreach ($couponInfo['subOrders'] as $key=> $so) {
					$couponInfo['subOrders'][$key]['coupon_amt'] = 0;
				}
			}
			else {
				$lastKey = -1;
				$remain = $couponInfo['amt'];
				ksort($couponInfo['subOrders']);
				foreach ($couponInfo['subOrders'] as $key=> $so) {
					$tmp = 10 * bcdiv($so['orderAmt'] * $couponInfo['amt'], 10 * $promotionAmt, 0);
					$couponInfo['subOrders'][$key]['coupon_amt'] = $tmp;
					$remain -= $tmp;
					$lastKey = $key;
				}

				if (0 != $remain) {
					$couponInfo['subOrders'][$lastKey]['coupon_amt'] += $remain;
				}
			}
			self::Log("分摊后".ToolUtil::gbJsonEncode($couponInfo));

		}*/

		//unset($itemsInShoppingCart);

		$product_cash = $orderPrice - $newOrder['point'] - $couponInfo['amt'];
		if ( bccomp( $product_cash, 0, 0 ) < 0 )
		{
			self::$errCode = -2040;
			self::$errMsg = '用户实际需要支付的货款金额为负数';
			return false;
		}

		//开始计算运费，调用计算运费接口
		$destination = $newOrder['receiveAddrId'];
		$is_mobile = (!empty($newOrder['ls']) && in_array($newOrder['ls'], self::$AppLS)) ? true : false;
		$price_without_point = $orderPrice - $couponInfo['amt'];
		$user_level = empty($userInfo['level']) ? 0 : $userInfo['level'];

		$shipInfo = array(
			'shipping_id' => $newOrder['shipType'], //配送方式id
			'wh_id'       => $wh_id, //起始站点
			'destination' => $destination, //收获地区
			'order_price' => $price_without_point, //订单需支付的金额(去除优惠券的金额)
			'is_mobile'   => $is_mobile, //是否是手机订单
			'user_level'  => $user_level, //用户等级
		);

		//获取购物车中商品总重量
		foreach ($subOrders as $subOrderKey => $so) {
			$shipInfo['order_info'][$subOrderKey]['weight'] = $so['totalWeight'];
		}

		self::Log("运费");
		//self::Log(var_export($shipInfo,true));
		$shipPriceInfo = EA_ShippingPrice::get($shipInfo);

		//self::Log(var_export($shipPriceInfo,true));
		if (!empty($shipPriceInfo['errCode'])) {
			self::$errCode = $shipPriceInfo['errCode'];
			self::$errMsg = $shipPriceInfo['errMsg'];
			return false;
		}

        $orderShipPrice = $shipPriceInfo['shippingPrice'];
		foreach ($subOrders as $subOrderKey => $so)
		{
			if(true === $is_mobile)
			{
				$subOrders[$subOrderKey]['orderShipPrice'] = $newOrder['suborders'][$subOrderKey]['shipPrice'];
			}
			else
			{
				$subOrders[$subOrderKey]['orderShipPrice'] = $shipPriceInfo['subShipPrice'][$subOrderKey]['shippingPrice'];
			}
		}
		//运费计算结束

		if (bccomp($newOrder['shippingPrice'], $orderShipPrice, 0) != 0) {
			self::$errCode = -2038;
			self::$errMsg = 'web传入的运费:' . $newOrder['shippingPrice'] . '后台重新计算的运费:' . $orderShipPrice . '计算的订单运费价格与前台订单运费价格不一致';
			return false;
		}
		//货票分离增加运费,前台过滤掉拆单情况
		if (isset($newOrder['separateInvoice']) && $newOrder['separateInvoice'] == 1) {
			$orderShipPrice += 1000;
			foreach ($subOrders as $subOrderKey => $so) {
				$subOrders[$subOrderKey]['orderShipPrice'] += 1000;
			}
		}
		foreach ($subOrders as $subOrderKey => $so) {
			if ($so['orderShipPrice'] < 0) {
				self::$errCode = -2044;
				self::$errMsg = '订单运费计算失败';
				return false;
			}
			// else if (bccomp($so['orderShipPrice'], $newOrder['suborders'][$subOrderKey]['shipPrice'], 0) != 0) {
			// self::$errCode = -2038;
			// self::$errMsg='web传入的运费:' . $newOrder['suborders'][$subOrderKey]['shipPrice'] . '后台重新计算的运费:' . $so['orderShipPrice'] . '计算的订单运费价格与前台订单运费价格不一致';
			// return false;
			// }
		}

		$cash = $orderShipPrice + $product_cash;

		//开始分摊优惠券&
		self::Log("开始分摊优惠券积分");
		if ($newOrder['point'] > 0) {
			ksort($subOrders);
		}
		//分摊优惠券到商品
		if ($couponInfo['amt'] > 0) {
			foreach ($subOrders as $subOrderKey => $so) {
				$subOrders[$subOrderKey]['couponamt'] = $couponInfo['subOrders'][$subOrderKey]['coupon_amt'];
			}
            if(empty($promotion))
            {
                $lastPid = 0;
                foreach ($couponInfo['subOrders'] as $subKey=> $so) {
                    $remain = $so['coupon_amt'];
                    foreach ($so['pids'] as $pid) {
                        @$couponInfo['subOrders'][$subKey]['apport'][$pid] = 10 * bcdiv($so['coupon_amt'] * $shoppingProduct[$subKey][$pid]['total_price'], 10 * $so['orderAmt'], 0);
                        $remain -= $couponInfo['subOrders'][$subKey]['apport'][$pid];
                        $lastPid = $pid;
                    }

                    if ($remain > 0 && $lastPid != 0 ) {
                        $couponInfo['subOrders'][$subKey]['apport'][$lastPid] += $remain;
                    }
                }
            }
		}


		//分摊积分
		$temp_cash_point = $cash_point_used;
		$i = 1;
		$order_num = 0;
		if ($newOrder['point'] > 0) {
			$remain = $newOrder['point'];
			foreach ($subOrders as $subOrderKey => $so) {
				$tmp = 10 * bcdiv($so['orderPrice'] * $newOrder['point'], $orderPrice * 10, 0);
				$subOrders[$subOrderKey]['point'] = $tmp;
				$remain -= $tmp;
			}
			//继续分摊不能整除剩下的部分
			reset($subOrders);
			while (FALSE != ($so = current($subOrders)) && $remain > 0) {
				$subOrderKey = key($subOrders);
				next($subOrders);
				$tmp = $so['orderPrice'] - $so['couponamt'] - $so['point'];
				if ($tmp > 0) {
					$subOrders[$subOrderKey]['point'] += ($tmp < $remain ? $tmp : $remain);
					$remain -= ($tmp < $remain ? $tmp : $remain);
				}
			}

			//分摊现金积分和促销积分
			$order_num = count($subOrders);
			foreach ($subOrders as $subOrderKey => $so)
			{
				if($i != $order_num)
				{
					$subOrders[$subOrderKey]['cash_point'] = 10 * bcdiv($cash_point_used * $subOrders[$subOrderKey]['point'] / 10, $newOrder['point'], 0);
					$subOrders[$subOrderKey]['promotion_point'] = $subOrders[$subOrderKey]['point'] - $subOrders[$subOrderKey]['cash_point'];
					$temp_cash_point -= $subOrders[$subOrderKey]['cash_point'];
				}
				else
				{
					$subOrders[$subOrderKey]['cash_point'] = $temp_cash_point;
					$subOrders[$subOrderKey]['promotion_point'] = $subOrders[$subOrderKey]['point'] - $subOrders[$subOrderKey]['cash_point'];
				}
				$i++;
			}
		}

		// $limitOrder = IShippingTime::getOrderLimitState($wh_id);
		//如果可以采用易迅快递，校验送货时间
		if (ICSON_DELIVERY == $newOrder['shipType']) {
			self::Log("易迅快递，校验送货时间");

			$icson_delivery_info = IShipping::getIcsonDeliveryInfoByRegion($newOrder['receiveAddrId'], $wh_id);

			if (false === $icson_delivery_info) {
				self::$errCode = IShipping::$errCode;
				self::$errMsg = IShipping::$errMsg;
				return false;
			}

			foreach ($shoppingProduct as $subOrderKey=> $subOrderItem) {
				//self::Log(ToolUtil::gbJsonEncode($subOrderItem));

				$icson_delivery_info['stock_num'] = $subOrderKey; // 发货仓号
				$icson_delivery_info['expect_ship_date'] = $newOrder['suborders'][$subOrderKey]['expectDate']; // 期望日期
				$icson_delivery_info['expect_time_span'] = $newOrder['suborders'][$subOrderKey]['expectSpan']; // 期望时间

				// 手机端的请求，isVirtual采用 true false 的方式
				if(isset($newOrder['ls']) && in_array($newOrder['ls'],self::$AppLS) && ("--mobile--" != $newOrder['ls']) && empty($newOrder['appnewapi']))
				{
					$v = isset($bVirtual[$subOrderKey]) ? $bVirtual[$subOrderKey] : false;
				}
				else
				{
					$v = isset($isVirtual[$subOrderKey]) ? $isVirtual[$subOrderKey] : false;
				}

				$ret = IShippingTime::verifyExpectDateSpan($icson_delivery_info, $wh_id, $destination, $v);
				if (false === $ret) {
					self::$errCode = IShippingTime::$errCode;
					self::$errMsg = basename(__FILE__) . "，验证配送时间错误，" . IShippingTime::$errMsg . ",subOrderItem" . var_export($subOrderItem, true);
					return array('errCode' => IShippingTime::$errCode, "errMsg" => IShippingTime::$errMsg);
				}
			}
		}

		//开始下单，先起事务， 插入orderdb， 扣 mssql 库存， commit事务or callback事务
		//获取新订单号
		self::Log("获取新订单号");
		$orderNum = count($subOrders);
		if ($orderNum > 1) {
			$newOrderId = IIdGenerator::getNewId('so_sequence', $orderNum + 1);
		}
		else {
			$newOrderId = IIdGenerator::getNewId('so_sequence', $orderNum);
		}
		if (false === $newOrderId || $newOrderId <= 0) {
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return false;
		}

		$orderstrforlog = '';
		$cc = ($orderNum > 1) ? $orderNum + 1 : $orderNum;
		for ($i = ($orderNum > 1 ? 1 : 0); $i < $cc; $i++) {
			$orderstrforlog .= "," . ($newOrderId + $i);
		}

		$parentOrderId = sprintf("%s%09d", "1", $newOrderId % 1000000000);
		$parentOrderInInt = $newOrderId;
		//获取订单发票id
		$invoice_id = IIdGenerator::getNewId('so_valueadded_invoice_sequence', $orderNum);
		if (false === $invoice_id) {
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return false;
		}

		//获取随心配id
		// 插入随心配表
		$match_id_start = 0;
		$needCount = 0;
		$itemCount = 0;
		foreach ($shoppingProduct as $key => $subOrderItem) {
			foreach ($subOrderItem as $sp) {
				$itemCount++;
				if ($sp['type'] != SHOPPING_CART_PRODUCT_TYPE_NORMAL || $sp['main_product_id'] == 0) {
					continue;
				}
				$needCount++;
			}
		}
		if ($needCount > 0) {
			$match_id_start = IIdGenerator::getNewId('SO_SaleRule_Sequence', $needCount);
			if (false === $match_id_start) {
				self::$errCode = -2036;
				self::$errMsg = '获取订单随心配seq失败' . IIdGenerator::$errMsg;
				return false;
			}
		}
		//获取订单商品的seqid
		$itemStartID = IIdGenerator::getNewId('So_Item_Sequence', $itemCount);
		if (false === $itemStartID) {
			self::$errCode = -2047;
			self::$errMsg = '获取订单商品id失败' . IIdGenerator::$errMsg;
			return false;
		}

		//处理单引号等特殊字符
		foreach ($newOrder as $k => $no) {
			if ($k == 'suborders' || $k == 'buy_one_key' || $k == 'send_coupon_success_info' || $k == 'send_coupon_record_info') {
				continue;
			}
			$newOrder[$k] = addslashes($no);
		}

		if ( self::NO_INVOICE == $newOrder['isVat'] ) //如果不需要开发票，那么其他字段也置为空
		{
			$newOrder['invoiceType'] = '';
			$newOrder['invoiceTitle'] = '';
			$newOrder['invoiceContent'] = '';
		}

		if ($newOrder['invoiceType'] != INVOICE_TYPE_VAT)
		{
			$newOrder['invoiceCompanyName'] = '';
			$newOrder['invoiceCompanyAddr'] = '';
			$newOrder['invoiceCompanyTel'] = '';
			$newOrder['invoiceTaxno'] = '';
			$newOrder['invoiceBankNo'] = '';
			$newOrder['invoiceBankName'] = '';
		}
		else
		{
			$newOrder['invoiceTitle'] = $newOrder['invoiceCompanyName'];
		}

		//	$newOrderId = sprintf("%s%09d", "1", $newId % 1000000000);
		if (!isset($orderDb)) {
			$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
			if (empty($orderDb)) {
				self::$errCode = ToolUtil::$errCode;
				self::$errMsg = ToolUtil::$errMsg;
				return false;
			}
		}

		self::Log("开启orderdb事务失败");
		$sql = "begin transaction";
		$ret = $orderDb->execSql($sql);
		if (false === $ret) {
			self::$errCode = -2032 . " " . $orderDb->errCode;
			self::$errMsg = '开启orderdb事务失败' . $orderDb->errMsg;
			return false;
		}

		$uniorder_parentOrder = array();
        $activeInfoList = array();

		//库存双写 S sheldonshi
        $inventorysAllData = array();
        //库存双写 E sheldonshi
		//如果发生了拆单，插入父订单
		$now = time();
		if ($orderNum > 1) {
			self::Log("发生了拆单，插入父订单");

			$isPayed = ($cash <= 0 ? 1 : 0);
			$newItem = array(
				'order_char_id'       => $parentOrderId,
				'order_id'            => $newOrderId,
				'status'              => 0,
				'flag'                => 0,
				'uid'                 => $uid,
				'hw_id'               => $wh_id,
				'order_date'          => $now,
				'source'              => 0,
				'type'                => 0,
				'shipping_cost'       => $orderShipPrice,
				'premium_cost'        => 0,
				'shipping_type'       => $newOrder['shipType'],
				'pay_time'            => 0,
				'pay_type'            => $newOrder['payType'],
				'prcd_cost'           => 0, //手续费
				'order_cost'          => $orderShipPrice + $orderPrice + $totalCut, //运费+商品总价+（随心配）
				'price_cut'           => $totalCut,
				'coupon_type'         => $couponInfo['type'],
				'coupon_code'         => $couponInfo['code'],
				'coupon_amt'          => $couponInfo['amt'],
				'point'               => 0,
				'point_pay'           => $newOrder['point'],
				'promotion_point'     => $promotion_point_used,
				'cash_point'          => $cash_point_used,
				'cash'                => $cash,
				'receiver'            => $newOrder['receiver'],
				'receiver_tel'        => $newOrder['receiverTel'],
				'receiver_mobile'     => $newOrder['receiverMobile'],
				'receiver_zip'        => $newOrder['zipCode'],
				'receiver_addr_id'    => $newOrder['receiveAddrId'],
				'receiver_addr'       => $newOrder['receiveAddrDetail'],
				'expect_dly_date'     => 0,
				'expect_dly_time_span'=> 0,
				'deliveryMemo'        => '',
				'comment'             => $newOrder['comment'],
				'update_time'         => $now,
				'isPayed'             => $isPayed,
				'out_time'            => 0,
				'sign_by_other'       => $newOrder['sign_by_other'],
				'ls'                  => isset($newOrder['ls']) ? $newOrder['ls'] : '',
				'cpsinfo'             => isset($newOrder['cpsinfo']) ? $newOrder['cpsinfo'] : '',
				'synFlag'             => 0, //父订单不同步给ERP
				'visitkey'            => $newOrder['visitkey'],
				'pOrderId'            => $parentOrderId,
				'subOrderNum'         => $orderNum,
				'stockNo'             => 0,
				'shop_guide_id'       => isset($newOrder['shopGuideId']) ? $newOrder['shopGuideId'] : 0,
				'shop_guide_name'     => isset($newOrder['shopGuideName']) ? $newOrder['shopGuideName'] : '',
				'shop_guide_cost'     => isset($newOrder['shopPrice']) ? $newOrder['shopPrice'] : 0,
				'shop_id'             => isset($newOrder['shopId']) ? $newOrder['shopId'] : 0,
				'is_vat'              => $newOrder['isVat'],
			);

			$uniorder_parentOrder = $newItem;
			$ret = $orderDb->insert("t_orders_{$db_tab_index['table']}", $newItem);
			if (false === $ret) {
				self::$errCode = -2033;
				self::$errMsg = '执行sql语句失败' . $orderDb->errMsg;
				$sql = "rollback";
				$orderDb->execSql($sql);
				return false;
			}


			$newOrderId++;
		}

		// 父订单数据
		$ORS_Report_Data = array(
			'products' => array(),
			'areaSysNo' => $destination,
			'shiptype' => $newOrder['shipType'],
			'parentorderid' => $parentOrderId,
			'childorderid' => array(),
		);
		$orderToSZ = array(
			'oid' => $parentOrderId,
			'status' => 0,
			'cash' => $cash,
			'uid' => $uid,
			'qq' => '', //(此处置空)
			'whid' => $wh_id,
			'ordertime' => $now,
			'vk' => $newOrder['visitkey'], //visit key
			'ip' => '', //稍后补偿
			'recv_province' => '', //收货省份
			'recv_city' => '', //收货城市
			'recv_region' => $newOrder['receiveAddrId'], //收货地区
			'raddr' => $newOrder['receiveAddrDetail'], //收货地址
			'rname' => $newOrder['receiver'], //收货人姓名
			'rphone' => $newOrder['receiverMobile'], //收货人电话
			'point' => $newOrder['point'], //使用的积分
			'osrc' => isset($newOrder['ls']) ? $newOrder['ls'] : '', //订单来源
			'payid' => $newOrder['payType'], //支付方式ID
			'payname' => '', //支付方式
			'coutype' => $couponInfo['type'], //优惠类型
			'couamt' => $couponInfo['amt'], //优惠金额
			'shipid' => $newOrder['shipType'], //配送方式ID
			'shipname' => isset($_LGT_MODE[ $newOrder['shipType'] ]) ? $_LGT_MODE[ $newOrder['shipType'] ]['ShipTypeName'] : '', //配送方式名称
			'invoice' => $newOrder['invoiceTitle'], //发票抬头
		); //TAPD 5478549 数据上报 (订单基本信息)

		//扣减库存 & 生成虚库表
		$sql = "begin transaction";
		$ret = $msSQL->execSql($sql);
		if (false === $ret) {
			self::$errCode = -2035;
			self::$errMsg = '开启ms sql事务失败' . $msSQL->errMsg;
			$sql = "rollback";
			$orderDb->execSql($sql);
			return false;
		}

		$timeNow = date('Y-m-d H:i:s', $now);

		//记录符合单品赠券的商品的信息
		$orders_items_array = array();
		$products_rules = array();
		if(isset($newOrder['send_coupon_success_info'])&& !empty($newOrder['send_coupon_success_info']))
		{
			foreach($newOrder['send_coupon_success_info'] as $key => $rules)
			{
				$products_rules[$key] = $rules;
			}
		}

		global $_StockToStation;
        Logger::info("shoppingProduct ==>" . ToolUtil::gbJsonEncode($shoppingProduct));

        $uniorder_orderList = array();
        $uniorder_tradeList = array();
		foreach ($shoppingProduct as $subOrderKey => $subOrder) {
			$cash = $subOrders[$subOrderKey]['orderPrice']
				+ $subOrders[$subOrderKey]['orderShipPrice']
				- (isset($subOrders[$subOrderKey]['couponamt']) ? $subOrders[$subOrderKey]['couponamt'] : 0)
				- (isset($subOrders[$subOrderKey]['point']) ? $subOrders[$subOrderKey]['point'] : 0);
			$isPayed = ($cash <= 0 ? 1 : 0);

			$subOrders[$subOrderKey]['orderId'] = $newOrderId; //clark记录订单ID

			$oid = sprintf("%s%09d", "1", $newOrderId % 1000000000);

			//计算每个订单中使用的单品促销的规则以及次数
			$single_promotion_info = '';

			foreach ($subOrder as $sp)
			{
				if(isset($products_rules[$sp['product_id']]) && !empty($products_rules[$sp['product_id']]))
				{
					//开始组装$single_promotion_info的值
					$rule_info = $products_rules[$sp['product_id']];
					foreach($rule_info['coupons_name'] as $name)
					{
						$single_promotion_info = $single_promotion_info . $name . " x " . $rule_info['count'] . "张;";
					}
					//self::Log(var_export($single_promotion_info,true));
				}
			}
			//货票分离
			$bits = 0;
			if ($newOrder['separateInvoice'] == 1) {
				self::Log("货票分离");
				$bits = $bits | ORDER_SEPARATE_GOODS_INVOICE;
				$newInvAddr = array(
					'order_char_id'    => $oid,
					'order_id'         => $newOrderId,
					'uid'              => $uid,
					'receiver'         => $newOrder['invoiceReceiver'],
					'receiver_tel'     => $newOrder['invoiceReceiverTel'],
					'receiver_mobile'  => $newOrder['invoiceReceiverMobile'],
					'receiver_zip'     => $newOrder['invoicezipCode'],
					'receiver_addr_id' => $newOrder['invoiceReceiveAddrId'],
					'receiver_addr'    => $newOrder['invoiceReceiveAddrDetail'],
					'shipping_type'    => YT_DELIVERY, //目前只支持圆通
					'shipping_cost'    => 1000, //分为单位
					'order_date'       => $now,
					'wh_id'            => $wh_id,
					'stockNo'          => $subOrderKey,
				);
				$ret = $orderDb->insert("t_order_invoice_address_{$db_tab_index['table']}", $newInvAddr);
				if (false === $ret) {
					self::$errCode = -2050;
					self::$errMsg = '执行sql语句失败' . $orderDb->errMsg;
					$sql = "rollback";
					$msSQL->execSql($sql);
					$orderDb->execSql($sql);
					return false;
				}
			}

			$newItem = array(
				'order_char_id'         => $oid,
				'order_id'              => $newOrderId,
				'status'                => 0,
				'flag'                  => isset($subOrders[$subOrderKey]['flag']) ? $subOrders[$subOrderKey]['flag'] : 0,
				'uid'                   => $uid,
				'hw_id'                 => $wh_id,
				'order_date'            => $now,
				'source'                => 0,
				'type'                  => 0,
				'shipping_cost'         => $subOrders[$subOrderKey]['orderShipPrice'],
				'premium_cost'          => 0,
				'shipping_type'         => $newOrder['shipType'],
				'pay_time'              => 0,
				'pay_type'              => $newOrder['payType'],
				'prcd_cost'             => 0, //手续费
				'order_cost'            => $subOrders[$subOrderKey]['orderPrice'] + $subOrders[$subOrderKey]['orderShipPrice'] + (isset($subOrders[$subOrderKey]['totalCut']) ? $subOrders[$subOrderKey]['totalCut'] : 0), //运费+商品总价+（随心配）
				'price_cut'             => isset($subOrders[$subOrderKey]['totalCut']) ? $subOrders[$subOrderKey]['totalCut'] : 0,
				'coupon_type'           => $couponInfo['type'],
				'coupon_code'           => $couponInfo['code'],
				'coupon_amt'            => isset($subOrders[$subOrderKey]['couponamt']) ? $subOrders[$subOrderKey]['couponamt'] : 0,
				'point'                 => 0,
				'point_pay'             => isset($subOrders[$subOrderKey]['point']) ? $subOrders[$subOrderKey]['point'] : 0,
				'cash_point'            => isset($subOrders[$subOrderKey]['cash_point']) ? $subOrders[$subOrderKey]['cash_point'] : 0,
				'promotion_point'       => isset($subOrders[$subOrderKey]['promotion_point']) ? $subOrders[$subOrderKey]['promotion_point'] : 0,
				'cash'                  => $cash,
				'receiver'              => $newOrder['receiver'],
				'receiver_tel'          => $newOrder['receiverTel'],
				'receiver_mobile'       => $newOrder['receiverMobile'],
				'receiver_zip'          => $newOrder['zipCode'],
				'receiver_addr_id'      => $newOrder['receiveAddrId'],
				'receiver_addr'         => $newOrder['receiveAddrDetail'],
				'expect_dly_date'       => strtotime($newOrder['suborders'][$subOrderKey]['expectDate']),
				'expect_dly_time_span'  => $newOrder['suborders'][$subOrderKey]['expectSpan'],
				'deliveryMemo'          => isset($newOrder['suborders'][$subOrderKey]['arrived_limit_time']) ? $newOrder['suborders'][$subOrderKey]['arrived_limit_time'] : '',
				'comment'               => $newOrder['comment'],
				'update_time'           => $now,
				'isPayed'               => $isPayed,
				'out_time'              => 0,
				'sign_by_other'         => $newOrder['sign_by_other'],
				'ls'                    => isset($newOrder['ls']) ? $newOrder['ls'] : '',
				'cpsinfo'               => isset($newOrder['cpsinfo']) ? $newOrder['cpsinfo'] : '',
				'synFlag'               => 1,
				'visitkey'              => isset($newOrder['visitkey']) ? $newOrder['visitkey'] : '',
				'pOrderId'              => $parentOrderId,
				'subOrderNum'           => 0,
				'stockNo'               => $subOrderKey,
				'shop_guide_id'         => isset($newOrder['shopGuideId']) ? $newOrder['shopGuideId'] : 0,
				'shop_guide_name'       => isset($newOrder['shopGuideName']) ? $newOrder['shopGuideName'] : '',
				'shop_guide_cost'       => isset($newOrder['suborders'][$subOrderKey]['shopPrice']) ? $newOrder['suborders'][$subOrderKey]['shopPrice'] : 0,
				'shop_id'               => isset($newOrder['shopId']) ? $newOrder['shopId'] : 0,
				'customer_ip'           => ToolUtil::getClientIP(),
				'is_vat'                => $newOrder['isVat'],
				'single_promotion_info' => $single_promotion_info,
				'bits'                  => $bits,
			);

			 //统一订单灰度 S
            $uniNewItem = $newItem;
            $uniNewItem['cod_adjust_price'] = isset($subOrders[$subOrderKey]['cod_adjust_price']) ? $subOrders[$subOrderKey]['cod_adjust_price'] : 0;
            $uniorder_orderList[] = $uniNewItem;
            $uniorder_tradeList[$newItem['order_char_id']] = array();

            if (strncmp('rule_', $couponInfo['code'], 5) == 0)
            {
                //促销规则
                $activeInfoList[$oid][] = array(
                                    "activeNo" => $promotion['rule_id'],
                                    "activeType" => 2,
                                    "activeRuleId" => $promotion['rule_id'],
                                    "activeDesc" => $promotion['desc'],
                                    "favorFee" => isset($subOrders[$subOrderKey]['couponamt']) ? $subOrders[$subOrderKey]['couponamt'] : 0,
                                    "activeParam1" => $promotion['benefit_type'],
                                    "activeParam2" => $promotion['rule_type'],
                                    "activeParam3" => $promotion['stage_price_type'],
                                    "activeParam4" => $promotion['benefit_times'],
                                    "activeParam5" => 0,
                                    "activeParam6" => $promotion['account_type'],
                                    "activeParam7" => 0,
                                    "activeParam8" => "",
                                );

            }
            else if(strncmp('jieneng', $couponInfo['code'], 7) == 0)
            {
                //节能补贴
                $activeInfoList[$oid][] = array(
                                    "activeNo" => "",
                                    "activeType" => 3,
                                    "activeRuleId" => "",
                                    "activeDesc" => "参加节能补贴",
                                    "favorFee" => $couponInfo['amt'],
                                    "activeParam1" => $newOrder['es_type'],
                                    "activeParam2" => 0,
                                    "activeParam3" => 0,
                                    "activeParam4" => 0,
                                    "activeParam5" => 0,
                                    "activeParam6" => $couponInfo['type'],
                                    "activeParam7" => 0,
                                    "activeParam8" => isset($couponInfo['energy_save_name']) ? $couponInfo['energy_save_name'] : "",
                                );
            }
            else if($couponInfo['code'] != NULL && $couponInfo['code'] != '')
            {
                //优惠券
                $activeInfoList[$oid][] = array(
                                    "activeNo" => isset($couponInfo['coupon_id']) ? $couponInfo['coupon_id'] : 0,
                                    "activeType" => 5,
                                    "activeRuleId" => isset($couponInfo['coupon_id']) ? $couponInfo['coupon_id'] : 0,
                                    "activeDesc" => $couponInfo['coupon_name'],
                                    "favorFee" => isset($subOrders[$subOrderKey]['couponamt']) ? $subOrders[$subOrderKey]['couponamt'] : 0,
                                    "activeParam1" => $couponInfo['type'],
                                    "activeParam2" => 1,
                                    "activeParam3" => 0,
                                    "activeParam4" => 0,
                                    "activeParam5" => 0,
                                    "activeParam6" => $couponInfo['type'],
                                    "activeParam7" => isset($couponInfo['code']) ? $couponInfo['code'] : "",
                                    "activeParam8" => isset($couponInfo['coupon_name']) ? $couponInfo['coupon_name'] : "",
                                );
            }
            if($single_promotion_info != '')
            {
                //单品赠券
                $activeInfoList[$oid][] = array(
                                    "activeNo" => "",
                                    "activeType" => 6,
                                    "activeRuleId" => "",
                                    "activeDesc" => "",
                                    "favorFee" => 0,
                                    "activeParam1" => 0,
                                    "activeParam2" => 0,
                                    "activeParam3" => 0,
                                    "activeParam4" => 0,
                                    "activeParam5" => 0,
                                    "activeParam6" => 0,
                                    "activeParam7" => $single_promotion_info,
                                    "activeParam8" => 0,
                                );
            }
            if(isset($subOrders[$subOrderKey]['total_pkg_cut']) && $subOrders[$subOrderKey]['total_pkg_cut'] > 0)
            {
                //套餐
                $activeInfoList[$oid][] = array(
                                    "activeNo" => "",
                                    "activeType" => 4,
                                    "activeRuleId" => "",
                                    "activeDesc" => "",
                                    "favorFee" => $subOrders[$subOrderKey]['total_pkg_cut'],
                                    "activeParam1" => 0,
                                    "activeParam2" => 0,
                                    "activeParam3" => 0,
                                    "activeParam4" => 0,
                                    "activeParam5" => 0,
                                    "activeParam6" => 0,
                                    "activeParam7" => 0,
                                    "activeParam8" => 0,
                                );
            }
            if(isset($subOrders[$subOrderKey]['total_match_cut']) && $subOrders[$subOrderKey]['total_match_cut'] > 0)
            {
                //随心配
                $activeInfoList[$oid][] = array(
                                    "activeNo" => "",
                                    "activeType" => 8,
                                    "activeRuleId" => "",
                                    "activeDesc" => "",
                                    "favorFee" => $subOrders[$subOrderKey]['total_match_cut'],
                                    "activeParam1" => 0,
                                    "activeParam2" => 0,
                                    "activeParam3" => 0,
                                    "activeParam4" => 0,
                                    "activeParam5" => 0,
                                    "activeParam6" => 0,
                                    "activeParam7" => 0,
                                    "activeParam8" => 0,
                                );
            }
			//统一订单灰度 E
			
			self::Log("插入订单主表");
			$ret = $orderDb->insert("t_orders_{$db_tab_index['table']}", $newItem);
			if (false === $ret) {
				self::$errCode = -2033;
				self::$errMsg = '执行sql语句失败' . $orderDb->errMsg;
				$sql = "rollback";
				$msSQL->execSql($sql);
				$orderDb->execSql($sql);
				return false;
			}

			// 子订单数据，以订单号作为key
			$ORS_Report_Data['childorderid'][$oid] = array(
				'products' => array(),
				'order_char_id' => $oid,
				'stock' => $subOrderKey,
			);

			$newInv = array(
				'user_invoice_id'=> $newOrder['invoiceId'],
				'order_char_id'  => $oid,
				'uid'            => $uid,
				'type'           => $newOrder['invoiceType'],
				'title'          => $newOrder['invoiceTitle'],
				'name'           => $newOrder['invoiceCompanyName'],
				'addr'           => $newOrder['invoiceCompanyAddr'],
				'phone'          => $newOrder['invoiceCompanyTel'],
				'taxno'          => $newOrder['invoiceTaxno'],
				'bankno'         => $newOrder['invoiceBankNo'],
				'bankname'       => $newOrder['invoiceBankName'],
				'content'        => $newOrder['invoiceContent'],
				'updatetime'     => $now,
				'wh_id'          => $wh_id,
				'auto_id'        => $invoice_id++,
			);

			self::Log("插入发票表");
			$ret = $orderDb->insert("t_order_invoice_{$db_tab_index['table']}", $newInv);
			if (false === $ret) {
				self::$errCode = -2050;
				self::$errMsg = '执行sql语句失败' . $orderDb->errMsg;
				$sql = "rollback";
				$msSQL->execSql($sql);
				$orderDb->execSql($sql);
				return false;
			}

			$_local_ip = ToolUtil::getLocalIp(0);
			$_local_ip = explode('.', $_local_ip);
			$_inserter = empty($_local_ip[3]) ? 7 : intval($_local_ip[3]);
            $strSubOrder = ToolUtil::gbJsonEncode($subOrder);
            Logger::info("===================[subOrder:{$strSubOrder}]");
			foreach ($subOrder as $sp) {

				/* MARK 随心配功能下线，写表操作去除
				//插入随心配表
				self::Log("插入随心配表");
				if ($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL && $sp['main_product_id'] != 0) {
					$sql = "insert into t_order_match_{$db_tab_index['table']} values($match_id_start, '{$newOrderId}', {$sp['product_id']}, {$sp['main_product_id']},{$sp['matchNum']}, {$sp['cashCutPerItem']}, $now, $wh_id )";
					$ret = $orderDb->execSql($sql);
					if (false === $ret) {
						self::$errCode = -2036;
						self::$errMsg = '执行sql语句失败' . $orderDb->errMsg;
						$sql = "rollback";
						$msSQL->execSql($sql);
						$orderDb->execSql($sql);
						return false;
					}
					++$match_id_start;
				}*/

				$buy_count_positive = $sp['buy_count'];
				$buy_count_negative = $sp['buy_count'] * (-1);
				foreach ($productStocks as $pstock) {
					if ($subOrderKey != $pstock['StockSysNo']) {
						continue;
					}
					$subKey = $pstock['StockSysNo'];
					if ($sp['product_id'] == $pstock['ProductSysNo']) {
						if ($pstock['AvailableQty'] + $pstock['VirtualQty'] >= $sp['buy_count']) { //可用大于购买数量
							$sql = "update Inventory_stock set AvailableQty = AvailableQty - {$sp['buy_count']}, OrderQty = OrderQty + {$sp['buy_count']}, rowModifydate='{$timeNow}' where AvailableQty+VirtualQty>={$sp['buy_count']} AND ProductSysNo={$sp['product_id']} and StockSysNo=$subOrderKey";
							$ret = $msSQL->execSql($sql);
							$cnt = $msSQL->getAffectedRows();
							if ((false === $ret) || (1 != $cnt)) {
								self::$errCode = -2047;
								self::$errMsg = "扣减ms sql库存失败({$sp['product_id'] })" . $msSQL->errMsg;
								$sql = "rollback";
								$msSQL->execSql($sql);
								$orderDb->execSql($sql);
								return false;
							}

							//ixiuzeng添加，将Inventroy_Stock的库存修改记录插入到Inventory_Flow表中
							$sql = "insert into Inventory_Flow values
									($subOrderKey, {$sp['product_id']}, 1, $newOrderId, 2, $buy_count_negative,'$timeNow', '$timeNow',$_inserter),
									($subOrderKey, {$sp['product_id']}, 1, $newOrderId, 4, $buy_count_positive,'$timeNow', '$timeNow',$_inserter)";
							$ret = $msSQL->execSql($sql);
							$cnt = $msSQL->getAffectedRows();
							if ((false === $ret) || (2 != $cnt)) {
								self::$errCode = -2046;
								self::$errMsg = "插入ms sql-Inventory_Flow表失败({$sp['product_id'] })" . $msSQL->errMsg;
								$sql = "rollback";
								$msSQL->execSql($sql);
								$orderDb->execSql($sql);
								return false;
							}
							//库存双写 S sheldonshi
                            $inventoryData = array(
                                'product_id' => $sp['product_id'],
                                'sys_stock' => $subKey,
                                'order_id' => $newOrderId,
                                'order_creat_time' => $now,
                                'buy_count' => $sp['buy_count'],
                                'order_type' => $product_base_info[$sp['product_id']]['sale_model'] == 0 ? 1 : $product_base_info[$sp['product_id']]['sale_model'],
                            );
                            $inventorysAllData[] = $inventoryData;
                            //库存双写 E sheldonshi

						}
						else if(($wh_id == 1) && (($product_base_info[$sp['product_id']]['flag'] & FORBID_SET_VIRTUAL) != FORBID_SET_VIRTUAL) &&
							($product_base_info[$sp['product_id']]['type'] == PRODUCT_TYPE_NORMAL) && $_StockToStation[$subOrderKey] == $wh_id) {  //上海站普通正常商品允许建虚库
							$sql = "update Inventory_stock set AvailableQty = AvailableQty - {$sp['buy_count']}, VirtualQty=VirtualQty + {$sp['buy_count']}, OrderQty = OrderQty + {$sp['buy_count']} , rowModifydate='{$timeNow}' where ProductSysNo={$sp['product_id']} and StockSysNo=$subOrderKey";
							$ret = $msSQL->execSql($sql);
							$cnt = $msSQL->getAffectedRows();
							if ($ret === false || 1 != $cnt) {
								self::$errCode = -2048;
								self::$errMsg = "扣减ms sql库存失败({$sp['product_id'] })" . $msSQL->errMsg;
								$sql = "rollback";
								$msSQL->execSql($sql);
								$orderDb->execSql($sql);
								return false;
							}

							//ixiuzeng添加，将Inventroy_Stock的库存修改记录插入到Inventory_Flow表中
							$sql = "insert into Inventory_Flow values
									($subOrderKey, {$sp['product_id']}, 1, $newOrderId, 2,$buy_count_negative,'$timeNow', '$timeNow',$_inserter),
									($subOrderKey, {$sp['product_id']}, 1, $newOrderId, 4,$buy_count_positive,'$timeNow', '$timeNow',$_inserter),
									($subOrderKey, {$sp['product_id']}, 1, $newOrderId, 5,$buy_count_positive,'$timeNow', '$timeNow',$_inserter)";
							$ret = $msSQL->execSql($sql);
							$cnt = $msSQL->getAffectedRows();
							if ((false === $ret) || (3 != $cnt)) {
								self::$errCode = -2045;
								self::$errMsg = "插入ms sql-Inventory_Flow表失败({$sp['product_id'] })" . $msSQL->errMsg;
								$sql = "rollback";
								$msSQL->execSql($sql);
								$orderDb->execSql($sql);
								return false;
							}


							//插入虚库表
							$auto_id = IIdGenerator::getNewId('SO_ProductVirtue_Sequence');
							if (false === $auto_id) {
								self::$errCode = -2089;
								self::$errMsg = '获取订单虚库记录sql失败' . IIdGenerator::$errMsg;
								$sql = "rollback";
								$msSQL->execSql($sql);
								$orderDb->execSql($sql);
								return false;
							}

							$sql = "insert into t_order_virtual_stock_{$db_tab_index['table']} values($auto_id, '$oid', {$sp['product_id']}, {$sp['buy_count']}, 0, $now, $wh_id)";
							$ret = $orderDb->execSql($sql);
							if (false === $ret) {
								self::$errCode = -2049;
								self::$errMsg = '建虚库记录失败' . $orderDb->errMsg;
								$sql = "rollback";
								$msSQL->execSql($sql);
								$orderDb->execSql($sql);
								return false;
							}

							//库存双写 S sheldonshi
                            $inventoryData = array(
                                'product_id' => $sp['product_id'],
                                'sys_stock' => $subKey,
                                'order_id' => $newOrderId,
                                'order_creat_time' => $now,
                                'buy_count' => $sp['buy_count'],
                                'order_type' => $product_base_info[$sp['product_id']]['sale_model'] == 0 ? 1 : $product_base_info[$sp['product_id']]['sale_model'],
                            );
                            $inventorysAllData[] = $inventoryData;
                            //库存双写 E sheldonshi

						}
						else { //深圳，北京暂不支持建虚库
							self::$errCode = -2099;
							self::$errMsg = '商品' . $product_base_info[$sp['product_id']]['name'] . "库存不足";
							$sql = "rollback";
							$msSQL->execSql($sql);
							$orderDb->execSql($sql);
							return array('errCode'=> -15, 'errMsg'=> "抱歉，{$product_base_info[$sp['product_id']]['name']}商品库存不足，请减少购买数量");
						}

						//插入订单-商品映射表
						// $isMainProduct 0:主商品 1：组件 2：赠品
						$isMainProduct = $sp['type'];
						$product_base_info[$sp['product_id']]['point_type'] = isset($product_base_info[$sp['product_id']]['point_type']) ? $product_base_info[$sp['product_id']]['point_type'] : 0;
						$product_base_info[$sp['product_id']]['point'] = isset($product_base_info[$sp['product_id']]['point']) ? $product_base_info[$sp['product_id']]['point'] : 0;
						$product_base_info[$sp['product_id']]['cost_price'] = isset($product_base_info[$sp['product_id']]['cost_price']) ? $product_base_info[$sp['product_id']]['cost_price'] : 0;
						$product_base_info[$sp['product_id']]['price'] = isset($product_base_info[$sp['product_id']]['price']) ? $product_base_info[$sp['product_id']]['price'] : 0;
						@$cb = !empty($itemsInShoppingCart[$sp['product_id']]) ? $itemsInShoppingCart[$sp['product_id']]['cash_back'] : 0;
						$useVirtualStock = $pstock['AvailableQty'] + $pstock['VirtualQty'] >= $sp['buy_count'] ? 0 : 1;
						$newOrderItems = array(
							'item_id'           => $itemStartID++,
							'order_char_id'     => $oid,
							'wh_id'             => $wh_id,
							'product_id'        => $sp['product_id'],
							'product_char_id'   => $product_base_info[$sp['product_id']]['product_char_id'],
							'uid'               => $uid,
							'name'              => $product_base_info[$sp['product_id']]['name'],
							'flag'              => $product_base_info[$sp['product_id']]['flag'],
							'type'              => $product_base_info[$sp['product_id']]['type'],
							'type2'             => $product_base_info[$sp['product_id']]['type2'],
							'weight'            => $product_base_info[$sp['product_id']]['weight'],
							'buy_num'           => $sp['buy_count'],
							'points'            => $product_base_info[$sp['product_id']]['point'] * $sp['buy_count'],
							'points_pay'        => 0,
							'point_type'        => $product_base_info[$sp['product_id']]['point_type'],
							'price'             => ($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL) ? $product_base_info[$sp['product_id']]['price'] : 0,
							'discount'          => intval(((($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL && $sp['main_product_id'] > 0) ? $sp['matchNum'] * $sp['cashCutPerItem'] : 0) + $cb) / $sp['buy_count']),
							'cash_back'         => (($sp['main_product_id'] > 0 && $sp['type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL) ? $sp['cashCutPerItem'] : 0) + $cb,
							'cost'              => $product_base_info[$sp['product_id']]['cost_price'],
							'warranty'          => $product_base_info[$sp['product_id']]['warranty'],
							'expect_num'        => 0,
							'create_time'       => $now,
							'product_type'      => $isMainProduct,
							'use_virtual_stock' => $useVirtualStock,
							'main_product_id'   => isset($sp['belongto_product_id']) ? $sp['belongto_product_id'] : 0,
							'updatetime'        => $now,
							'edm_code'          => isset($product_base_info[$sp['product_id']]['edm']) ? $product_base_info[$sp['product_id']]['edm'] : '',
							'apportToPm'        => $couponInfo['type'] == 1 ? (isset($couponInfo['subOrders'][$subOrderKey]['apport'][$sp['product_id']]) ? ($couponInfo['subOrders'][$subOrderKey]['apport'][$sp['product_id']]) : 0) : 0,
							'apportToMkt'       => (isset($couponInfo['subOrders'][$subOrderKey]['apport'][$sp['product_id']]) ? ($couponInfo['subOrders'][$subOrderKey]['apport'][$sp['product_id']]) : 0),
							'shop_guide_cost'   => isset($product_base_info[$sp['product_id']]['shopPrice']) ? $product_base_info[$sp['product_id']]['shopPrice'] : 0,
							'OTag'              => isset($sp['OTag']) ? $sp['OTag'] : '',
							'package_ids'       => isset($itemsInShoppingCart[$sp['product_id']]) ? $itemsInShoppingCart[$sp['product_id']]['package_id'] : '',
						    //'energy_save'       => isset($energySaveDiscount) ? $energySaveDiscount : 0,
                        );

						$newOrder['order_items'][] = $newOrderItems; //需要将order_item 传出该函数

						$ret = $orderDb->insert("t_order_items_{$db_tab_index['table']}", $newOrderItems);
						if (false === $ret) {
							self::$errCode = -2039;
							self::$errMsg = '执行sql语句失败' . $orderDb->errMsg;
							$sql = "rollback";
							$orderDb->execSql($sql);
							$msSQL->execSql($sql);
							return false;
						}

						// 子订单商品数据，以商品ID作为key
						$pItem = array(
							'product_id' => $newOrderItems['product_id'],
							'buy_num' => $newOrderItems['buy_num'],
							'main_product_id' => $newOrderItems['main_product_id'],
							//'product_type' => $newOrderItems['product_type'],
						);

						$ORS_Report_Data['childorderid'][$oid]['products'][$pItem["product_id"]] = $pItem;
						$ORS_Report_Data['products'][$pItem["product_id"]]=$pItem;

						if(isset($products_rules[$newOrderItems['product_id']]))
						{
							$orders_items_array[$newItem['order_char_id']][$newOrderItems['product_id']]['count'] = $products_rules[$newOrderItems['product_id']]['count'];
							$orders_items_array[$newItem['order_char_id']][$newOrderItems['product_id']]['rule_id'] = $products_rules[$newOrderItems['product_id']]['rule_id'];
						}

						//统一订单start
                        //商品维度活动列表
                        $newOrderItems['promotion_price'] = $sp['promotion_total_price'];
                        $tradeActiveLists = array();
                        if(!empty($promotion)
                            && IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_CASH'] == $promotion['benefit_type']
                            && isset($couponInfo['subOrders'][$subOrderKey]['apport'][$sp['product_id']])
                        )
                        {
                            //商品维度促销活动列表
                            $tradeActive = array(
                                "activeNo" => $promotion['rule_id'],
                                "activeType" => 2,
                                "activeRuleId" => $promotion['rule_id'],
                                "activeDesc" => $promotion['desc'],
                                "preActiveFee"  => $product_base_info[$sp['product_id']]['price'] * $sp['buy_count'] - $sp['matchNum'] * $sp['cashCutPerItem'] - $cb,       //多价后的价格
                                "favorFee" => $couponInfo['subOrders'][$subOrderKey]['apport'][$sp['product_id']],
                                "activeParam1" => $promotion['benefit_type'],
                                "activeParam2" => $promotion['rule_type'],
                                "activeParam3" => $promotion['stage_price_type'],
                                "activeParam4" => $promotion['benefit_times'],
                                "activeParam5" => 0,
                                "activeParam6" => $promotion['account_type'],
                                "activeParam7" => 0,
                                "activeParam8" => "",
                            );
                            $tradeActiveLists[] = $tradeActive;
                        }
                        if((isset($newOrder['couponCode'])
                            && $newOrder['couponCode'] != "")
                            && isset($couponInfo['subOrders'][$subOrderKey]['apport'][$sp['product_id']])
                        )
                        {
                            //商品维度优惠券活动列表
                            $tradeActive = array(
                                "activeNo" => isset($couponInfo['coupon_id']) ? $couponInfo['coupon_id'] : 0,
                                "activeType" => 5,
                                "activeRuleId" => isset($couponInfo['coupon_id']) ? $couponInfo['coupon_id'] : 0,
                                "activeDesc" => $couponInfo['coupon_name'],
                                "preActiveFee"  => $product_base_info[$sp['product_id']]['price'] * $sp['buy_count'] - $sp['matchNum'] * $sp['cashCutPerItem'] - $cb,           //多价后的价格
                                "favorFee" => $couponInfo['subOrders'][$subOrderKey]['apport'][$sp['product_id']],
                                "activeParam1" => $couponInfo['type'],
                                "activeParam2" => 1,
                                "activeParam3" => 0,
                                "activeParam4" => 0,
                                "activeParam5" => $couponInfo['type'] == 1 ? $couponInfo['subOrders'][$subOrderKey]['apport'][$sp['product_id']] : 0,
                                "activeParam6" => $couponInfo['subOrders'][$subOrderKey]['apport'][$sp['product_id']],
                                "activeParam7" => isset($couponInfo['code']) ? $couponInfo['code'] : "",
                                "activeParam8" => isset($couponInfo['coupon_name']) ? $couponInfo['coupon_name'] : "",
                            );
                            $tradeActiveLists[] = $tradeActive;
                        }

                        if(($sp['main_product_id'] > 0 && $sp['type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL && ($sp['cashCutPerItem'] * $sp['matchNum']) > 0))
                        {
                            //商品维度随心配活动列表
                            $tradeActive = array(
                                "activeNo" => $sp['main_product_id'],
                                "activeType" => 8,
                                "activeRuleId" => 1,                             //随心配辅商品
                                "activeDesc" => "",
                                "preActiveFee"  => $product_base_info[$sp['product_id']]['price'] * $sp['buy_count'],
                                "favorFee" => $sp['cashCutPerItem'] * $sp['matchNum'],
                                "activeParam1" => $sp['matchNum'],
                                "activeParam2" => 0,
                                "activeParam3" => 0,
                                "activeParam4" => $sp['cashCutPerItem'],
                                "activeParam5" => $sp['main_product_id'],
                                "activeParam6" => 0,
                                "activeParam7" => $sp['cashCutPerItem'] * $sp['matchNum'],
                                "activeParam8" => 0,
                            );
                            $tradeActiveLists[] = $tradeActive;
                        }

                        $newOrderItems['activeList'] = $tradeActiveLists;
                        $uniorder_tradeList[$newOrderItems['order_char_id']][] = $newOrderItems;

                        //end
                        //更新批价明细里的订单和时间的字段
                        reset($priceDetails);
                        $strPriceDetails = ToolUtil::gbJsonEncode($priceDetails);
                        Logger::info("writePriceDetail  www ===>".$strPriceDetails);
                        foreach($priceDetails as &$priceDetail)
                        {
                            if($priceDetail["product_id"] == $sp['product_id'] && !isset($priceDetail['order_char_id']))
                            {
                                $priceDetail['order_char_id'] = $oid;
                                $priceDetail['create_time'] = $now;
                            }
                        }
						break;
					}
				}
			}
			$newOrderId++;
		}

		//库存双写 S sheldonshi
        $inventoryRet = IShoppingProcess::setLockInventory($uid, $inventorysAllData);
        if($inventoryRet['errCode'] != 0)
        {
            $lockedInventory = $inventoryRet['lockedInventory'];
            self::Log("place order setLockInventory Error![lockedInventory:" . ToolUtil::gbJsonEncode($lockedInventory) . "]");
            if(!empty($lockedInventory))
            {
                $inventoryRet = IShoppingProcess::setUnlockInventory($uid, $lockedInventory);
                if($inventoryRet == false)
                {
                    self::Log("place order setUnlockInventory Error");
                }
            }
            //正式环境不可下单，返回库存问题
            //return false;
        }
        //库存双写 E sheldonshi


		$mysqlDb = NULL;

		if (!empty($promotion)) {
			self::Log("使用了促销规则");
			/*
			 * MARK 接入促销2.0，旧的扣减筹码的逻辑去掉
			$orderDb = ToolUtil::getMSDBObj('ICSON_CORE');
			if (false === $orderDb) {
				self::$errCode = ToolUtil::$errCode;
				self::$errMsg = ToolUtil::$errMsg;

				$sql = "rollback";
				$orderDb->execSql($sql);
				$msSQL->execSql($sql);
				return false;
			}

			if ($promotion['benefit_type'] == IPromotionRuleV2::$BenfitType['BENEFIT_TYPE_COUPON']) {
				$sql = "update t_promotion_source set benfit_used=benfit_used+{$promotion['benefit_times']} where source_id={$promotion['source_id']} and status=0 and benfit_total >= (benfit_used +{$promotion['benefit_times']})";
			}
			else {
				$sql = "update t_promotion_source set benfit_used=benfit_used+$rule_discount where source_id={$promotion['source_id']} and status=0 and benfit_total >= (benfit_used +$rule_discount)";
			}
			$ret = $orderDb->execSql($sql);
			if (false === $ret) {
				self::$errCode = $orderDb->errCode;
				self::$errMsg = $orderDb->errMsg;

				$sql = "rollback";
				$orderDb->execSql($sql);
				$msSQL->execSql($sql);
				return false;
			}
			else if (1 != $orderDb->getAffectedRows()) {
				$sql = "rollback";
				$orderDb->execSql($sql);
				$msSQL->execSql($sql);
				return array('errCode'=> -987, 'errMsg'=> '抱歉，您参加的活动已结束或终止，请您返回购物车重新操作');
			}
			*/
			//如果是送积分，优惠券，还需要执行向用户帐号里发放积分，优惠券
			if (IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_POINT'] == $promotion['benefit_type']) {
				// 送积分
			}
			else if (IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_COUPON'] == $promotion['benefit_type']) {
				// 送优惠卷
				$couponFetch = array();
				$batches = explode(",", $promotion['benefits']);
				foreach ($batches as $batch) {
					$couponFetch[$batch] = $promotion['benefit_times'];
				}
				if (NULL == $mysqlDb) {
					$mysqlDb = ToolUtil::getDBObj('coupon', 0);
					if (false === $mysqlDb) {
						self::$errCode = Config::$errCode;
						self::$errMsg = Config::$errMsg;

						$sql = "rollback";
						//$orderDb->execSql($sql);
						$msSQL->execSql($sql);
						//库存双写 S Sheldonshi
                        IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                        //库存双写 E Sheldonshi
						return false;
					}

					$sql = "start transaction";
					$ret = $mysqlDb->execSql($sql);
					if (false === $ret) {
						self::$errCode = $mysqlDb->errCode;
						self::$errMsg = $mysqlDb->errMsg;

						$sql = "rollback";
						//$orderDb->execSql($sql);
						$msSQL->execSql($sql);
						//库存双写 S Sheldonshi
                        IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                        //库存双写 E Sheldonshi
						return false;
					}
				}
				$ret = ICoupon::fetchCoupons($uid, $couponFetch, $mysqlDb, (isset($userInfo['level']) ? $userInfo['level'] : -1));
				if (false === $ret) {
					self::$errCode = ICoupon::$errCode;
					self::$errMsg = ICoupon::$errMsg;
					$sql = "rollback";
					$mysqlDb->execSql($sql);
					//$orderDb->execSql($sql);
					$msSQL->execSql($sql);
					//库存双写 S Sheldonshi
                    IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                    //库存双写 E Sheldonshi
					if (ICoupon::$errCode == -106) {
						return array('errCode'=> -987, 'errMsg'=> '抱歉，您参加的活动已结束或终止，请您返回购物车重新操作');
					}
					else {
						return false;
					}
				}

				$couponids = '';
				foreach ($ret as $promotionCode) {
					$couponids .= (implode(",", $promotionCode) . ",");
				}
				if ('' != $couponids) {
					$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
					$ret = $orderDb->update("t_orders_{$db_tab_index['table']}", array('rule_benefit'=> $couponids), "order_char_id='$parentOrderId' and uid={$uid}");
                    if (false === $ret) {
						self::$errCode = $mysqlDb->errCode;
						self::$errMsg = $mysqlDb->errMsg;
						$sql = "rollback";
						$mysqlDb->execSql($sql);
						$orderDb->execSql($sql);
						$msSQL->execSql($sql);
						//库存双写 S Sheldonshi
                        IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                        //库存双写 E Sheldonshi
						return false;
					}
				}
				//统一订单
                foreach($activeInfoList as $oid => $activeInfos)
                {
                    foreach($activeInfos as $index=>$activeInfo)
                    {
                        if($activeInfo['activeType'] == 2 && $activeInfo['activeParam1'] == $promotion['benefit_type'])
                        {
                            $activeInfoList[$oid][$index]['activeParam8'] = $couponids;
                        }
                    }
                }
                //统一订单
			}
		}

		//更新购物券
		if (isset($newOrder['couponCode']) && $newOrder['couponCode'] != '') {
			self::Log("更新优惠券");
			global $_CouponStatus;
			$st = $_CouponStatus['partly_used'];

			if ($couponInfo['used_degree'] + 1 >= $couponInfo['max_use_degree']) {
				$st = $_CouponStatus['used'];
			}
			if (NULL == $mysqlDb) {
				$mysqlDb = ToolUtil::getDBObj('coupon', 0);
				if (false === $mysqlDb) {
					self::$errCode = ToolUtil::$errCode;
					self::$errMsg = ToolUtil::$errMsg;

					$sql = "rollback";
					$orderDb->execSql($sql);
					$msSQL->execSql($sql);
					//库存双写 S Sheldonshi
                    IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                    //库存双写 E Sheldonshi
					return false;
				}

				$sql = "start transaction";
				$ret = $mysqlDb->execSql($sql);
				if (false === $ret) {
					self::$errCode = $mysqlDb->errCode;
					self::$errMsg = $mysqlDb->errMsg;

					$sql = "rollback";
					$orderDb->execSql($sql);
					$msSQL->execSql($sql);
					//库存双写 S Sheldonshi
                    IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                    //库存双写 E Sheldonshi
					return false;
				}
			}

			$ret = ICoupon::useCoupon($uid, $couponInfo, $orderstrforlog, $mysqlDb, (isset($userInfo['level']) ? $userInfo['level'] : -1), $wh_id);
			if (false === $ret) {
				self::$errCode = ICoupon::$errCode;
				self::$errMsg = ICoupon::$errMsg;

				$sql = "rollback";
				$mysqlDb->execSql($sql);
				$orderDb->execSql($sql);
				$msSQL->execSql($sql);
				 //库存双写 S Sheldonshi
                IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                //库存双写 E Sheldonshi
				return false;
			}
		}

		//如果是节能补贴订单，则将节能补贴申请信息插入对应的表
		if ($is_energy_subsidy_order) {
			self::Log("节能补贴订单");
			//插入节能补贴数据
			$coreDb = ToolUtil::getMSDBObj('ICSON_CORE');
			$sql = "begin transaction";
			$ret = $coreDb->execSql($sql);
			if (false === $ret) {
				self::$errCode = -2035;
				self::$errMsg = '开启ms sql事务失败' . $coreDb->errMsg;
				$sql = "rollback";
				if (isset($mysqlDb) && !empty($mysqlDb)) {
					$mysqlDb->execSql($sql);
				}
				$orderDb->execSql($sql);
				$msSQL->execSql($sql);
				//库存双写 S Sheldonshi
                IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                //库存双写 E Sheldonshi
				return false;
			}
			$ret = $coreDb->insert("t_order_energy_subsidy", array(
				'order_id'   => ($newOrderId - 1),
				'type'       => intval($newOrder['es_type']),
				'name'       => $newOrder['es_name'],
				'idCard'     => $newOrder['es_idCard'],
				'timestamp'  => time(),
				'hw_id'      => $wh_id,
				'stockNo'    => current(array_keys($shoppingProduct))
			));
			if (false === $ret) {
				self::$errCode = $coreDb->errCode;
				self::$errMsg = $coreDb->errMsg;
				$sql = "rollback";
				if (isset($mysqlDb) && !empty($mysqlDb)) {
					$mysqlDb->execSql($sql);
				}
				$orderDb->execSql($sql);
				$msSQL->execSql($sql);
				//库存双写 S Sheldonshi
                IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                //库存双写 E Sheldonshi
				return false;
			}
		}

		//更新积分
		if ($newOrder['point'] > 0)
		{
			//插入扣减积分的流水
			self::Log("更新积分");
			global $_SCORE_TYPE;
			$ret = IScore::addScore($uid, $_SCORE_TYPE['CREATE_ORDER']['id'], -1 * $newOrder['point'] / 10, "您下单10" . ($newOrderId - 1) . "消费积分", '', -1 * $cash_point_used / 10, -1 * $promotion_point_used / 10);
			if (false === $ret) {
				self::$errCode = IScore::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "add score flow:insert score flow faild(uid={$newOrder['uid']},order_id=$newOrderId,point={$newOrder['point']})" . IScore::$errMsg;
				$sql = "rollback";

				if (isset($mysqlDb) && !empty($mysqlDb)) {
					$mysqlDb->execSql($sql);
				}
				$orderDb->execSql($sql);
				$msSQL->execSql($sql);
				//库存双写 S Sheldonshi
                IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                //库存双写 E Sheldonshi
				IOrder::Log(self::$errMsg);
				return array('errCode'=> -987, 'errMsg'=> '抱歉，您的订单因使用积分异常导致提交订单失败，您可以稍后重新下单或在提交订单时暂不使用积分');
			}
		}

		//扣减多价促销次数
		self::Log("扣减促销多价次数");
		$ret = IPromotionRuleV2::dealPromotionRestrict($restricts, $newOrder['uid']);
		if (false === $ret) {
			$restrictsJson = ToolUtil::gbJsonEncode($restricts);
			self::$errCode = IPromotionRuleV2::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "dealPromotionRestrict faild(uid={$newOrder['uid']},)" . IPromotionRuleV2::$errMsg.",{$restrictsJson}";
			$sql = "rollback";
			if (isset($mysqlDb) && !empty($mysqlDb)) {
				$mysqlDb->execSql($sql);
			}
			$orderDb->execSql($sql);
			$msSQL->execSql($sql);
			//库存双写 S Sheldonshi
            IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
            //库存双写 E Sheldonshi
			IOrder::Log(self::$errMsg);
			return array('errCode'=> -989, 'errMsg'=> '抱歉，您的订单因系统异常导致提交订单失败，您可以稍后重新下单');
		}
		else
		{
			$restricts = $ret["restrict"];
		}

		self::Log("commit事务");
		$sql = "commit";

		if (!empty($mysqlDb)) {
			$mysqlDb_commit_ret = $mysqlDb->execSql($sql);
		}

		if (!empty($coreDb)) {
			$coreDb_commit_ret = $coreDb->execSql($sql);
		}

		$msSQL_commit_ret = $msSQL->execSql($sql);
		$orderDb_commit_ret = $orderDb->execSql($sql);

		//如果订单的事务提交失败，且使用了积分,则需要记录该条信息
		if(!$orderDb_commit_ret)
		{
			//回滚多价促销内容
			$ret = IPromotionRuleV2::rollbackPromotionRestrict($restricts, $newOrder['uid']);
			if (false === $ret) {
				$restrictsJson = ToolUtil::gbJsonEncode($restricts);
				self::$errCode = IPromotionRuleV2::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "rollbackPromotionRestrict faild(uid={$newOrder['uid']},)" . IPromotionRuleV2::$errMsg.",{$restrictsJson}";

				IOrder::Log(self::$errMsg);
			}
			if($newOrder['point'] > 0)
			{
			$backDate['order_id'] = $newOrderId - 1;
			$backDate['uid'] = $uid;
			$backDate['type'] = ERROR_COMMIT_ORDER;
			$backDate['cash_point'] = $cash_point_used;
			$backDate['promotion_point'] = $promotion_point_used;

			self::Log("$uid 用户下订单 {$backDate['order_id']} 本单使用的积分将在1个小时内返还到您的账户");
			$ret = IScore::insertBackData($backDate);
			return array('errCode'=> -988, 'errMsg'=> '抱歉，您的订单提交失败，本单使用的积分将在1个小时内返还到您的账户');
		}
		}

		// 上报促销规则使用记录

		if (isset($newOrder['rule_id']) && $newOrder['rule_id'] > 0) {
			$orders = explode(",", $orderstrforlog);
			foreach ($orders as $o) {
				if (!empty($o)) {
					DataReport::report(3001, DATA_TYPE_1DAY, array($wh_id, $o, $newOrder['rule_id'], $userInfo['level'], $uid));
				}
			}
		}

		//写下用户购买单品赠券信息
		if (isset($newOrder['send_coupon_record_info']) && $newOrder['send_coupon_record_info'] != '') {
			$ret = EA_Promotion::setUserJoinedRecord($uid, $now, $newOrder['send_coupon_record_info'], $orders_items_array);
		}

		self::writePriceDetail($uid, $priceDetails);
		self::reportORS($ORS_Report_Data);
		self::reportToSZ($orderToSZ, $items); //TAPD 5478549 数据上报
		self::reportBaiduSem($_COOKIE, $subOrders, $wh_id); // 上报百度sem数据
		self::reportGSadid($_COOKIE, $subOrders, $wh_id); // 上报 国双 数据
		//删除购物车
		if (!(isset($newOrder['buy_one_key']) && true === $newOrder['buy_one_key'])) {
			IShoppingCart::clear($uid);
		}

		//更新用户地址信息中默认支付方式，默认发票
		IUserAddressBookTTC::update(
			array(
				'uid'=>$uid,
				'default_shipping'=>$newOrder['shipType'],
				'default_pay_type'=>$newOrder['payType'],
				'last_use_time'=>time(),
				'iid'=>$newOrder['invoiceId']
			),
			array('aid'=>$newOrder['aid'])
		);
		//发送短信通知
		if ($newOrder['point'] > 1000) {
			$mobile = $userInfo['mobile'];
			$time = date("Y-m-d H:i:s");
			$ret = IMessage::sendSMSMessage($mobile, "您的易迅网账户于" . $time . "下单并使用积分" . $newOrder['point'] / 10 . "个。订单号" . $parentOrderId . "。如有疑问请致电400-828-1878");
			if (false === $ret) {
				self::Log("发送短信：发送信息失败：" . IMessage::$errMsg);
			}
		}

		//*******************统一订单双写灰度 Start*****************
        //writeUniOrdersData($uid, $uniorder_orderList, $orderNum, $uniorder_parentOrder, $uniorder_tradeList, $newOrder, $activeInfoList, $isEnergySubsidyOrder)
        global $_UIN_ORDER_WHITE_LIST;
        if($_UIN_ORDER_WHITE_LIST['flag'])
        {
            //灰度
            if($_UIN_ORDER_WHITE_LIST['type'] == 1)
            {
                //白名单灰度
                if(in_array($uid, $_UIN_ORDER_WHITE_LIST['list']))
                {
                    self::writeUniOrdersData($uid, $uniorder_orderList, $orderNum, $uniorder_parentOrder, $uniorder_tradeList, $newOrder, $activeInfoList, $isEnergySubsidyOrder);
                }
            }
            else if($_UIN_ORDER_WHITE_LIST['type'] == 2)
            {
                //uid取模灰度
                $mod = $_UIN_ORDER_WHITE_LIST['mod'];
                if($uid % $mod == 0)
                {
                    //写统一订单
                    self::writeUniOrdersData($uid, $uniorder_orderList, $orderNum, $uniorder_parentOrder, $uniorder_tradeList, $newOrder, $activeInfoList, $isEnergySubsidyOrder);
                }
            }
            else if($_UIN_ORDER_WHITE_LIST['type'] == 3)
            {
                //全量
                self::writeUniOrdersData($uid, $uniorder_orderList, $orderNum, $uniorder_parentOrder, $uniorder_tradeList, $newOrder, $activeInfoList, $isEnergySubsidyOrder);
            }
        }
        //*******************统一订单双写灰度 End********************

		global $_PAY_MODE;
		return array(
			'errCode'         => 0,
			'uid'             => $uid,
			'orderId'         => $parentOrderId,
			'orderAmt'        => $orderShipPrice + $orderPrice - $newOrder['point'] - $couponInfo['amt'],
			'payType'         => $newOrder['payType'],
			'payTypeIsOnline' => $_PAY_MODE[$wh_id][$newOrder['payType']]['IsNet'],
			'payTypeName'     => $_PAY_MODE[$wh_id][$newOrder['payType']]['PayTypeName'],
			'orderTotalAmt'   => $orderShipPrice + $orderPrice, //订单总金额
			'payGoodsAmt'     => $product_cash, //订单客户支付的金额（去掉运费和享受到的其它优惠后的用户实际支付金额）
			'orderCreateTime' => $now,
			'isParentOrder'   => $orderNum > 1 ? true : false,
			'isVATInvoice'    => ($newOrder['invoiceType'] == INVOICE_TYPE_VAT) ? true : false,
			'order_items'     => $newOrder['order_items'],
			'subOrderIdStr'   => $orderstrforlog, //传出去 cps 跟单
			'subOrders'       => $subOrders, //传出去 cps 跟单
		);
	}

	// 批价路径记录
	/*private static function opPathRecord($priceDetails, $uid)
	{
		//获取db，写数据
		$dbtable = ToolUtil::getDBTableIndex($uid);
		$priceDetailDB = ToolUtil::getDBObj('order_items_price_detail', $dbtable['db']);
		if (false === $priceDetailDB)
		{
			//记录错误日志即可
			$strPriceDetails = ToolUtil::gbJsonEncode($priceDetails);
			Logger::err("order_items_price_detail get db failed![uid:{$uid}][strPriceDetails:{$strPriceDetails}]");
			return;
		}
		else
		{
			foreach($priceDetails as $priceDetail)
			{
				print_r($priceDetail);
				$ret = $priceDetailDB->insert("t_order_items_price_detail_{$dbtable['table']}", $priceDetail);
				if (false === $ret)
				{
					//批价明细出错，记录日志即可
					$strPriceDetail = ToolUtil::gbJsonEncode($priceDetail);
					Logger::err("order_items_price_detail insert table failed![uid:{$uid}][strPriceDetail:{$strPriceDetail}]");
				}
			}
		}
		return;
	}*/

	/**
	 * @static 检查预购信息
	 * @param $uid 用户ID
	 * @param $items 购买的商品
	 */
	public static function checkAppointInfo($uid, $items)
	{
		self::Log($uid);
		//self::Log(ToolUtil::gbJsonEncode($items));
		$now = time();
		// 是否预约
		$isAppointed = true;

		// 商品中是否包含预约商品
		$hasAppointedProduct = false;

		//$lastItem = false;
		foreach ($items as $item) {

			if (!isset($item['event_id']) || $item['event_id'] <= 0) {
				continue;
			}

			if ($now < $item['buy_time_from'] or $now > $item['buy_time_to']) {
				// 不在预约购买时间段内，不做预约检查，可以直接购买
				continue;
			}

			$hasAppointedProduct = true;

			$event_id = $item['event_id'];
			$ret = IActAppoint::hasAppointed($event_id, $uid);
			if ($ret === false) {
				// 该用户没有参加预约
				$isAppointed = false;
				self::$errMsg = 6002;
				self::$errCode = "您购物车中的\"{$item['name']}\"为预购商品，需要预购资格才能购买哦";
				break;
			}

		}

		//self::Log(var_export($isAppointed, true));

		// 订单中有预购商品
		if ($hasAppointedProduct) {
			// 检查用户是否有资格
			return $isAppointed;
		}

		// 订单中没有预购商品，直接放过
		return true;
	}

	private static function setShoppingCartInfo($newOrder)
	{
		$newOrderItems = array();

		$shopping_cart_type = IShoppingCart::ONLINE_CART;

		if ((isset($newOrder['buy_one_key']) && true === $newOrder['buy_one_key']) //如果是无线一键购买，则从suborders中取商品
			|| (isset($newOrder['ism']) && $newOrder['ism'] == 2) //如果是节能补贴商品，也从suborders中取商品
		) //如果是分销导购，也从suborders中取商品
		{
			while (FALSE !== ($node = current($newOrder['suborders']))) {
				if (!isset($node['items'])) {
					return array('errCode'=> 10, 'errMsg'=> "您提交的订单数据有误，请检查！");
				}

				foreach ($node['items'] as $it) {
					$item_tmp = array();
					$item_tmp['product_id'] = $it['product_id'];
					$item_tmp['buy_count'] = $it['num'];
					$item_tmp['main_product_id'] = !empty($it['main_product_id']) ? $it['main_product_id'] : 0;
					$item_tmp['price_id'] = !empty($it['price_id']) ? ($it['price_id'] === "thh" ? 1 : $it['price_id']) : 0;
					$item_tmp['OTag'] = !empty($it['OTag']) ? $it['OTag'] : "";
                    $item_tmp['chid'] = !empty($it['chid']) ? $it['chid'] : "";
					$newOrderItems[] = $item_tmp;
				}
				next($newOrder['suborders']);
			}
			$shopping_cart_type = IShoppingCart::OFFLINE_CART;
		}

		$offLine_params = array(
			'type'  => $shopping_cart_type,
			'items' => $newOrderItems,
		);
		return $offLine_params;
	}

	private static function reportBaiduSem($_COOKIE, $subOrders, $wh_id)
	{
		// 上报百度sem数据
		$reportID = 3201;
		if (isset($_COOKIE['mediav_data']) && $_COOKIE['mediav_data'] != '') {
			$cookie_data = $_COOKIE['mediav_data'];
			self::Log("上报百度sem数据 {$cookie_data} ");
			self::_dataReport($reportID, $cookie_data, $subOrders, $wh_id);
		}
	}

	private static function reportGSadid($_COOKIE, $subOrders, $wh_id)
	{
		// 5468935 国双代理数据上报
		$reportID = 3202;
		if (isset($_COOKIE['gsadid_data']) && $_COOKIE['gsadid_data'] != '') {
			$cookie_data = $_COOKIE['gsadid_data'];
			self::Log("国双代理数据上报 {$cookie_data} ");
			self::_dataReport($reportID, $cookie_data, $subOrders, $wh_id);
		}
	}

	private static function _dataReport($reportID, $cookie_data, $subOrders, $wh_id)
	{
		//
		$mediv_data = explode("|", $cookie_data);

		// 分隔符前面为数据
		$_data = $mediv_data[0];

		// 分隔符后面为用户进入网站的时间
		$_time = $mediv_data[1];

		// 与现在间隔时间小于7天的才上报
		if (time() - $_time < 7 * 24 * 60 * 60) {
			foreach ($subOrders as $stockNo=> $o) {
				// 上报所有订单
				DataReport::report($reportID, DATA_TYPE_1DAY, array($wh_id, $o['orderId'], $stockNo, $_data));
			}
		}
	}
    private static function setPriceDetail(&$priceDetails, $item, $whid)
    {
        //批价明细记录 Start
        $priceDetail = array();
        $priceDetail['product_id'] = $item['product_id'];
        //$priceDetail['order_char_id'] = $item['order_char_id'];
        //$priceDetail['create_time'] = $now;
        $priceDetail['product_char_id'] = $item['product_char_id'];
        $priceDetail['wh_id'] = $whid;
        $priceDetail['buy_num'] = $item['buy_count'];
        //多价一定有加上
        $priceDetail['rule_type'] = 1;
        $priceDetail['rule_source_id'] = $item['price_source_id'];
        $priceDetail['rule_scence_id'] = $item['price_scene_id'];
        $priceDetail['rule_name'] = $item['discount_p_name'];

        $priceDetail['price_before'] = $item['total_price_before'];
        $priceDetail['price_after'] = $item['total_price_after'];
        $priceDetail['mult_discount'] = $item['mult_price_discount'];
        $priceDetail['energy_discount'] = $item['energy_save_discount'];
        $priceDetail['cash_back'] = $item['cash_back'];
        $priceDetail['price_start_time'] = $item['price_start_time'];
        $priceDetail['price_end_time'] = $item['price_end_time'];

        if(isset($item['op_path']['op_path_mult']) && count($item['op_path']['op_path_mult']) > 0)
        {
            $multOP = $item['op_path']['op_path_mult'][0];
            $priceDetail['rule_cost_type'] = $multOP['rule_cost_type'];
        }
        $priceDetails[] = $priceDetail;

        //有促销优惠加入促销优惠
        if(isset($item['op_path']['op_path_full_discount']) && count($item['op_path']['op_path_full_discount']) > 0)
        {
            //有促销优惠
            $fulldiscountOP = $item['op_path']['op_path_full_discount'][0];
            $priceDetail['rule_type'] = 2;
            $priceDetail['rule_source_id'] = 0;
            $priceDetail['rule_scence_id'] = 0;
            $priceDetail['mult_discount'] = 0;
            $priceDetail['energy_discount'] = 0;
            $priceDetail['price_start_time'] = 0;
            $priceDetail['price_end_time'] = 0;
            $priceDetail['rule_id'] = $fulldiscountOP['rule_id'];
            $priceDetail['rule_name'] = $fulldiscountOP['rule_desc'];
            //$priceDetail['create_time'] = $now;
            $priceDetail['price_before'] = $fulldiscountOP['before_price'];
            $priceDetail['price_after'] = $fulldiscountOP['after_price'];
            $priceDetail['price_discount'] = $item['promotion_discount'];
            $priceDetail['cash_back'] = $item['cash_back'];
            $priceDetail['rule_cost_type'] = $fulldiscountOP['rule_cost_type'];
            $priceDetails[] = $priceDetail;
        }
        //批价明细记录 End
        return;
    }
	private static function writePriceDetail($uid, $priceDetails)
	{
		//写cmem
        $priceDetailsJson = ToolUtil::gbJsonEncode($priceDetails);
        Logger::err("order_items_price_detail get db failed![uid:{$uid}][priceDetail:{$priceDetailsJson}]");
        $tm = Config::getTMem('order_price_detail_config');
        if($tm === false) {
            //记录错误日志即可
            $priceDetailsJson = ToolUtil::gbJsonEncode($priceDetails);
            Logger::err("order_items_price_detail get db failed![uid:{$uid}][priceDetail:{$priceDetailsJson}]");
            return false;
        }
        //根据订单id来分
        $orderPriceDetails = array();
        foreach($priceDetails as $priceDetail)
        {
            $orderPriceDetails[$priceDetail['order_char_id']][] = $priceDetail;
        }
        foreach($orderPriceDetails as $priceKey => $orderPriceDetail)
        {
            $strKey = 'order_p_detail_' . $priceKey;
            $strValue = ToolUtil::gbJsonEncode($orderPriceDetail);

            $ret = $tm->set(TMEM_BID_ORDER_PRICE_DETAIL, $strKey, $strValue);
            if($ret === false) {
                $errCode =  $tm->errCode;
                $errMsg =  $tm->errMsg;
                Logger::err("order_items_price_detail insert table failed![uid:{$uid}][key:{$strKey}][strValue:{$strValue}][{$errCode}][{$errMsg}]");
            }
        }
		return true;
	}

	private static function reportORS($ORS_Report_Data)
	{
		$env = get_cfg_var('env.name');
		if(empty($env) or $env == "beta")
		{
			// 线上 ip
			$ip = "10.180.37.99";
			$port = 44447;
		}
		else
		{
			// 开发测试ip
			$ip = "10.12.194.126";
			$port = 44447;
		}


		// 订单数据上报到 ORS
		$data = json_encode($ORS_Report_Data);

		self::Log($data);

		$ret = NetUtil::udpPHPCmd($ip,$port,$data);
		if($ret === false)
		{
			self::Log("UDP sending failed,(data:$data),($ip:$ip;port:$port),errMsg:".NetUtil::$errMsg);
		}
		else
		{
			self::Log("UDP sending success,(data:$data),($ip:$ip;port:$port),return:".var_export($ret,true));
		}
		return $ret;
	}

	/**
	 * 数据上报，参考 tapd 5478549。
	 * 用"|"分割多个片段；片段内，用"&"连接"key=value"
	 * @param array $order
	 * @param array $products
	 * @return bool true
	 */
	private static function reportToSZ($order, $products) {
		$env = get_cfg_var('env.name');

		if (empty($env) || $env == "beta") { // 线上环境
			$ip = '10.191.7.25';
		}
		else { // 开发测试环境
			$ip = "10.12.194.109"; //暂先指向109
		}
		$port = 65300;
		$needResp = false; //不需要等待返回

		$data[] = 'cmd=1'; //第一片段

		//order 中 recv_province, recv_city, ip, payname 需要补偿
		global $_District, $_Province, $_City;
		$province_id = isset($_District[ $order['recv_region'] ]) ? $_District[ $order['recv_region'] ]['province_id'] : false;
		$city_id = isset($_District[ $order['recv_region'] ]) ? $_District[ $order['recv_region'] ]['city_id'] : false;
		$order['recv_province'] = ($province_id) ? (isset($_Province[ $province_id ]) ? $_Province[ $province_id ] : '') : '';
		$order['recv_city'] = ($city_id) ? (isset($_City[ $city_id ]) ? $_City[ $city_id ]['name'] : '') : '';
		$order['recv_region'] = isset($_District[ $order['recv_region'] ]) ? $_District[ $order['recv_region'] ]['name'] : ''; //用name复写！

		$order['ip'] = ToolUtil::getClientIP();

		global $_PAY_MODE;
		$order['payname'] = isset($_PAY_MODE[ $order['whid'] ][ $order['payid'] ]) ? $_PAY_MODE[ $order['whid'] ][ $order['payid'] ]['PayTypeName'] : ''; //通过payid
		$data[] = $order; //第二片段，订单信息

		//第三片段开始，商品信息
		foreach($products as $pdt) {
			$data[] = array(
				'pid' => $pdt['product_id'], //商品ID
				'pcharid' => $pdt['product_char_id'], //商品编号
				'pname' => $pdt['name'], //商品名
				'qty' => $pdt['buy_count'], //购买数量
				'price' => $pdt['price'], //商品价格，以分为单位
				'flag' => $pdt['flag'], //商品标记
				'c3id' => $pdt['c3_ids'], //小类ID
			);
		}

		$udpAry = array();
		foreach($data as $phaseCnt) {
			if (is_string($phaseCnt)) { //第一片段
				$udpAry[] = $phaseCnt;
			}
			else {
				$tmp = array();
				foreach($phaseCnt as $k => $v) {
					$tmp[] = "$k=$v";
				}
				$udpAry[] = implode('&', $tmp);
			}
		}
		$udpData = implode('|', $udpAry);

		$ret = NetUtil::udpCmd($ip, $port, $udpData, $needResp);
		return $ret;
	}

	public static function transXSSContent($newOrder)
	{
		$newOrder['comment'] = ToolUtil::transXSSContent($newOrder['comment']);
		$newOrder['receiver'] = ToolUtil::transXSSContent($newOrder['receiver']);
		$newOrder['receiverTel'] = ToolUtil::transXSSContent($newOrder['receiverTel']);
		$newOrder['receiverMobile'] = ToolUtil::transXSSContent($newOrder['receiverMobile']);
		$newOrder['receiveAddrDetail'] = ToolUtil::transXSSContent($newOrder['receiveAddrDetail']);

		$newOrder['invoiceTitle'] = ToolUtil::transXSSContent($newOrder['invoiceTitle']);
		$newOrder['invoiceContent'] = ToolUtil::transXSSContent($newOrder['invoiceContent']);
		$newOrder['invoiceCompanyName'] = ToolUtil::transXSSContent($newOrder['invoiceCompanyName']);
		$newOrder['invoiceCompanyAddr'] = ToolUtil::transXSSContent($newOrder['invoiceCompanyAddr']);
		$newOrder['invoiceCompanyTel'] = ToolUtil::transXSSContent($newOrder['invoiceCompanyTel']);
		$newOrder['invoiceTaxno'] = ToolUtil::transXSSContent($newOrder['invoiceTaxno']);
		$newOrder['invoiceBankNo'] = ToolUtil::transXSSContent($newOrder['invoiceBankNo']);
		$newOrder['invoiceBankName'] = ToolUtil::transXSSContent($newOrder['invoiceBankName']);

		return $newOrder;
	}

	private static function esInfoCheck(&$newOrder)
	{

		if( !isset($newOrder['ism']) or 2 != $newOrder['ism'])
		{
			// 购物车类型错误
			self::Log($newOrder['ism']);
			self::Log(__LINE__);return false;
		}


		if( !isset($newOrder['es_type']) )
		{
			// 购买类型错误
			self::Log(__LINE__);return false;
		}

		$es_type = intval($newOrder['es_type']);

		// 可用的三种类型
		$available_types = array(
			0,//个人购买
			1,//企业购买
			2,//事业单位购买
		);

		if(!in_array($es_type,$available_types))
		{
			// 购买类型错误
			self::Log(__LINE__);return false;
		}

		if($es_type == 0)
		{
			$len = 20;
			$user_name = trim($newOrder['es_name']);
			if( strlen($user_name) == 0
				or strlen($user_name) > $len
				or !ToolUtil::IsChineseWord($user_name) )
			{
				$relly_len = (int)($len / 2);
				self::$errMsg = "抬头必须是全中文，长度不能超过{$relly_len}个汉字";
				self::Log(__LINE__);return false;
			}


			if(empty($newOrder['es_idCard']) or !ToolUtil::checkIDCard($newOrder['es_idCard']))
			{
				// 资料ID
				self::$errMsg = "身份证不为空，长度为15或者18";
				self::Log(__LINE__);return false;
			}
		}
		else if($es_type == 1)
		{
			$len = 100;
			$user_name = trim($newOrder['es_name']);
			if( strlen($user_name) == 0
				or strlen($user_name) > $len
				or !is_string($user_name) )
			{
				$relly_len = (int)($len / 2);
				self::$errMsg = "企业名字不为空，长度不能超过{$relly_len}";
				self::Log(__LINE__);return false;
			}


			if(empty($newOrder['es_idCard'])
				or strlen($newOrder['es_idCard']) > 60
				or !is_string($newOrder['es_idCard']))
			{
				// 资料ID
				self::$errMsg = "企业执照不为空，长度不超过60个字符";
				self::Log(__LINE__);return false;
			}
		}
		else if($es_type == 2)
		{
			$len = 100;
			$user_name = trim($newOrder['es_name']);
			if( strlen($user_name) == 0
				or strlen($user_name) > $len
				or !is_string($user_name) )
			{
				$relly_len = (int)($len / 2);
				self::$errMsg = "事业单位（发票抬头）不为空，长度不能超过{$relly_len}";
				self::Log(__LINE__);return false;
			}

		}
		else
		{
			self::Log(__LINE__);return false;
		}
		//名称xss过滤
		$newOrder['es_name'] = ToolUtil::transXSSContent($newOrder['es_name']);
		self::Log(__LINE__);return true;

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

    /**
     * 订单写入到同一后台
     */
    public static function writeUniOrdersData($uid, $uniorder_orderList, $orderNum, $uniorder_parentOrder, $uniorder_tradeList,
                                              $newOrder, $activeInfoList, $isEnergySubsidyOrder)
    {
        self::Log("writeUniOrdersData Start![uid:{$uid}]  [uniorder_orderList:" . ToolUtil::gbJsonEncode($uniorder_orderList)
                    ."]  [orderNum:{$orderNum}]  [uniorder_parentOrder:" . ToolUtil::gbJsonEncode($uniorder_parentOrder)
                    ."]  [uniorder_tradeList:" . ToolUtil::gbJsonEncode($uniorder_tradeList)
                    ."]  [newOrder:" . ToolUtil::gbJsonEncode($newOrder)
                    ."]  [activeInfoList:" . ToolUtil::gbJsonEncode($activeInfoList)
                    ."]  [isEnergySubsidyOrder:{$isEnergySubsidyOrder}]"
        );
        //***********************灰度双写订单数据 start****************************
        $uniorder = array(
            'uid'           =>  $uid,
            'buyerId'       =>  0,  //统一用户id，从统一用户系统获取的wgid
            'buyerAccount'  =>  '', //买家帐号, 从统一用户系统获取（登录email，外部账户或qq号等）
            'buyerNickName' =>  '',//买家姓名, 从统一用户系统获取
            'buyerNick'     =>  ''  //买家昵称, 从统一用户系统获取
        );

        $uniorder['orderInfoList'] = array();
        //for ($i = 0, $len = count($uniorder_orderList); $i < $len; $i++) {
        foreach($uniorder_orderList as $i => $order){
            //$order = $uniorder_orderList[$i];
            //订单
            $orderData = array(
                'order_id'          => $order['order_id'],
                'order_char_id'     => $order['order_char_id'],
                'ls'                => $order['ls'],
                'pay_type'          => $order['pay_type'],
                'cash'              => $order['cash'],//订单实付总金额
                'flag'              => $order['flag'],
                'bits'              => $order['bits'],
                'discount'          => $order['price_cut'] + $order['coupon_amt'],//优惠总金额
                //'totalFee'          => $order['order_cost'] - $order['shipping_cost'] - $order['price_cut'] - $order['coupon_amt'],
                'dealAdjustFee'     => $order['cod_adjust_price'],
                'shipping_cost'     => $order['shipping_cost'],//邮费金额
                'premium_cost'      => $order['premium_cost'],//运费保险费
                'point_pay'         => $order['point_pay'],//积分支付值
                'point'             => $order['point'],//获得积分值
                'customer_ip'       => $order['customer_ip'],
                'receiver'          => $order['receiver'],
                'receiver_addr'     => $order['receiver_addr'],
                'receiver_addr_id'  => $order['receiver_addr_id'],
                'receiver_zip'      => $order['receiver_zip'],
                'receiver_tel'      => $order['receiver_tel'],
                'receiver_mobile'   => $order['receiver_mobile'],
                'expect_dly_date'   => $order['expect_dly_date'],
                'expect_dly_time_span'=> $order['expect_dly_time_span'],
                'comment'           => $order['comment'],
                'sign_by_other'     => $order['sign_by_other'],
                'is_vat'            => $order['is_vat'],//是否开发票
                'orderNum'          => $orderNum,//订单数量
                'parentOrderId'     => $orderNum > 1 ? $uniorder_parentOrder['order_id'] : $order['order_id'],
                'hw_id'             => $order['hw_id'],
                'coupon_amt'        => (isset($newOrder['couponCode']) && $newOrder['couponCode'] != "") ? $order['coupon_amt'] : 0,//优惠券金额
                'cash_point'        => $order['cash_point'],//现金积分支付值
                'promotion_point'   => $order['promotion_point'],//促销积分支付值
                'shipping_type'     => $order['shipping_type'],//易迅配送方式
                //'rate'              => $order[''],//易迅平衡比率
                //'back_rate'         => $order[''],//易迅银行利率
                'shop_id'           => $order['shop_id'],
                'shop_guide_id'     => $order['shop_guide_id'],
                'shop_guide_cost'   => $order['shop_guide_cost'],
                'shop_guide_name'   => $order['shop_guide_name'],
                'stockNo'           => $order['stockNo'],
                'price_cut'         => $order['price_cut'],//订单返现金额
                'order_cost'        => $order['order_cost'],//订单金额,分期付款使用
                'cpsinfo'           => $order['cpsinfo'],
                //易迅联营
                'seller_id'         => $order['seller_id'],
                'sale_model'        => $order['sale_model'],
                'seller_address_id' => $order['seller_address_id'],
                //大中小件
                'SaleSpec'          => $order['SaleSpec'],
                'Weight'            => $order['Weight'],
                'Volume'            => $order['Volume'],
                'LongestEdge'       => $order['LongestEdge'],
                'dealSource'		=> 2,
            );
            //分期付款 ->独立流程
            if(isset($newOrder['IsInstallment']) && $newOrder['IsInstallment'] == 1)
            {
                $orderData['installment'] = array();
                $orderData['installment']['installment_bank'] = $order['installment_bank'];
                $orderData['installment']['installment_num'] = $order['installment_num'];
                $orderData['installment']['cash_per_month'] = $order['cash_per_month'];
                $orderData['installment']['rate'] = $order['rate'];
                $orderData['installment']['back_rate'] = $order['back_rate'];
            }

            //节能补贴
            if($isEnergySubsidyOrder){
                $orderData['subsidy'] = array();
                $orderData['subsidy']['type'] = intval($newOrder['es_type']);
                $orderData['subsidy']['name'] = $newOrder['es_name'];
                $orderData['subsidy']['idCard'] = $newOrder['es_idCard'];
            }

            //发票
            $orderData['invoice'] = array();
            $orderData['invoice']['type']      = $newOrder['invoiceType'];
            $orderData['invoice']['title']     = $newOrder['invoiceTitle'];
            $orderData['invoice']['content']   = $newOrder['invoiceContent'];
            $orderData['invoice']['name']      = $newOrder['invoiceCompanyName'];
            $orderData['invoice']['addr']      = $newOrder['invoiceCompanyAddr'];
            $orderData['invoice']['phone']     = $newOrder['invoiceCompanyTel'];
            $orderData['invoice']['taxno']     = $newOrder['invoiceTaxno'];
            $orderData['invoice']['bankno']    = $newOrder['invoiceBankNo'];
            $orderData['invoice']['bankname']  = $newOrder['invoiceBankName'];

            //货票分离订单
            if($newOrder['separateInvoice'] == 1){
                $orderData['invoiceSeparate'] = array();
                $orderData['invoiceSeparate']['receiver'] = $newOrder['invoiceReceiver'];
                $orderData['invoiceSeparate']['receiver_addr'] = $newOrder['invoiceReceiveAddrDetail'];
                $orderData['invoiceSeparate']['receiver_addr_id'] = $newOrder['invoiceReceiveAddrId'];
                $orderData['invoiceSeparate']['receiver_mobile'] = $newOrder['invoiceReceiverMobile'];
                $orderData['invoiceSeparate']['receiver_tel'] = $newOrder['invoiceReceiverTel'];
                $orderData['invoiceSeparate']['receiver_zip'] = $newOrder['invoicezipCode'];
                $orderData['invoiceSeparate']['shipping_type'] = YT_DELIVERY;//目前只支持圆通
                $orderData['invoiceSeparate']['shipping_cost'] = 1000; //分为单位
            }

            //订单->商品单
            $orderData['tradePoList'] = array();
            if(isset($uniorder_tradeList[$order['order_char_id']])){
                $tradeList = $uniorder_tradeList[$order['order_char_id']];
            }
            else{
                $tradeList = array();
            }
            $itemIdList = array();
            //for ($j = 0, $len = count($tradeList); $j < $len; $j++) {
            foreach($tradeList as $j => $trade){
                //$trade = $tradeList[$j];
                $tradeData = array(
                    'ls'                => $order['ls'],
                    'pay_type'          => $order['pay_type'],
                    'product_type'      => $trade['product_type'],
                    'name'              => $trade['name'],
                    'item_id'           => $trade['item_id'],
                    'stockNo'           => $order['stockNo'],
                    'weight'            => $trade['weight'],
                    'main_product_id'   => $trade['main_product_id'],//商品套餐主商品ID
                    'cost'              => $trade['cost'],//商品成本价
                    'price'             => $trade['price'],//商品成交价
                    'apportToMkt'       => $trade['apportToMkt'],//自营B2C市场
                    'apportToPm'        => $trade['apportToPm'],//自营B2CPM
                    'use_virtual_stock' => $trade['use_virtual_stock'],//自营B2C是否占用虚库
                    'buy_num'           => $trade['buy_num'],//商品成交件数
                    'totalFee'          => $trade['promotion_price'] - $trade['cash_back'] - ((isset($newOrder['couponCode']) && $newOrder['couponCode'] != "") ? $trade['apportToMkt'] : 0),//商品单总金额 成交价*成交件数-优惠总金额（不包含积分）
                    'payment'           => $trade['promotion_price'] - $trade['cash_back'] - ((isset($newOrder['couponCode']) && $newOrder['couponCode'] != "") ? $trade['apportToMkt'] : 0),//实付总金额 成交价*成交件数-优惠总金额（不包含积分）
                    'discount'          => $trade['cash_back'] + $trade['apportToMkt'],//优惠总金额  批价路径优惠总金额之和（不包含积分）分摊到此商品子单上的优惠总和，可由活动列表汇总得到
                    'points_pay'        => $trade['points_pay'],//积分支付值
                    'points'            => $trade['points'],//获得积分值
                    'flag'              => $trade['flag'],
                    'type'              => $trade['type'],
                    'warranty'          => $trade['warranty'],//保修条款
                    'product_id'        => $trade['product_id'],
                    'product_char_id'   => $trade['product_char_id'],
                    'edm_code'          => $trade['edm_code'],
                    'OTag'              => $trade['OTag'],
                    'shop_guide_cost'   => $trade['shop_guide_cost'],//易迅店铺导购费用
                    'point_type'        => $trade['point_type'],//易迅积分兑换类型
                    'package_ids'       => $trade['package_ids'],//易迅商品子单套餐id
                    'cash_back'         => $trade['cash_back'],//子单返现金额
                );
                $itemIdList[] = $tradeData['item_id'];
                $tradeData['tradeActiveInfoList'] = $trade['activeList'];
                $orderData['tradePoList'][] = $tradeData;
            }

            if(isset($activeInfoList[$order['order_char_id']]))
            {
                $orderData['dealActiveInfoList'] = $activeInfoList[$order['order_char_id']];
            }
            else
            {
                $orderData['dealActiveInfoList'] = array();
            }
            $orderData['item_ids'] = implode(',', $itemIdList);
            $uniorder['orderInfoList'][] = $orderData;
        }
        self::Log("writeUniOrdersData uniorder:" . ToolUtil::gbJsonEncode($uniorder));
        \ECC\Order\IcsonOrder::create($uniorder);
        return;
        //***********************灰度双写订单数据 end****************************
    }

    /*
    * 购物流程接入配送信息服务化及新联营项目的下单函数
    * 2013.7.3
    * handywu
    */
    public static function placeAnOrder($newOrder, $wh_id)
    {
        self::Log("placeOrderV2 New Para:[whid:{$wh_id}],newOrder:" . ToolUtil::gbJsonEncode($newOrder));
        $newOrder = self::transXSSContent($newOrder);
        self::$visitkey = $newOrder['visitkey'];

        $uid = $newOrder['uid'];
        $destination = $newOrder['receiveAddrId'];

        //如果使用优惠券，判断用户是否为经销商，若是，则不允许使用优惠券
        $userInfo = IUser::getUserInfo($uid);
        if ($userInfo === false) {
            self::$errCode = IUser::$errCode;
            self::$errMsg = "获取用户信息错误";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:获取用户信息错误：" . IUser::$errMsg;
            self::Log("placeOrderV2 IUser::getUserInfo Error!获取用户信息错误!errCode:" . IUser::$errCode);
            return false;
        }

        /*
        $userPoint = IPreOrderV2::getUserPoint($uid);
        if($userPoint === false && $_POST['point'] > 0){
            self::$errCode = IPreOrderV2::$errCode;
            self::$errMsg = "获取用户积分信息错误";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:获取用户信息错误：" . IPreOrderV2::$errMsg;
            Logger::ERR("placeOrder IPreOrderV2::getUserPoint Error!获取用户积分信息错误!errCode:" . IPreOrderV2::$errCode);
            return array('errno' => 6001);
        }
        else
        {
            $user['point'] = isset($userPoint['point']) ? $userPoint['point'] : 0;
            $user['cash_point'] = isset($userPoint['cash_point']) ? $userPoint['cash_point'] : 0;
            $user['promotion_point'] = isset($userPoint['promotion_point']) ? $userPoint['promotion_point'] : 0;
            $user['valid_point'] = isset($userPoint['valid_point']) ? $userPoint['valid_point'] : 0;
        }
        */

        global $_USER_TYPE;
        if ($userInfo['type'] == $_USER_TYPE['Dealer'] && isset($newOrder['couponCode']) && $newOrder['couponCode'] != '') {
            return array('errCode'=> 15, 'errMsg'=> "您属于分销用户，不能使用优惠券。");
        }
        // 设置购物车参数
        $shoppingCartInfo = self::setShoppingCartInfo($newOrder);
        //TODO:使用新的接口来完成这里的商品列表商品信息获取   Start
        $result = IShoppingProcess::getAllCartItemsInfo($uid, $wh_id, $destination, $shoppingCartInfo, true , true);
        if (false === $result) {
            self::$errCode = IShoppingProcess::$errCode;
            self::$errMsg = IShoppingProcess::$errMsg . ",uid({$uid}) getItemList failed";
            self::Log("getAllCartItemsInfo Failed!".IShoppingProcess::$errCode);
            return array('errCode'=> -1, 'errMsg'=> "您的购物车中没有商品，请选购！");
        }
        $items = $result['items'];
        $suiteInfo = $result['suiteInfo'];
        $product_base_info = $result['products'];
        $inventorys = $result['inventory'];
        if (isset($newOrder['ls']) && in_array($newOrder['ls'], self::$AppLS)) {
            $items = IShoppingCart::filterPackageItems($items);
        }
        self::Log("getAllCartItemsInfo result=>".ToolUtil::gbJsonEncode($items));
        $items_tmp = array();
        foreach($items as $item)
        {
            $pid = $item['product_id'];
            if(array_key_exists($pid,$items_tmp))
            {
                $items_tmp[$pid]['buy_count'] += $item['buy_count'];
                $items_tmp[$pid]['cash_back'] += (isset($item['cash_back'])? $item['cash_back'] : 0) * $item['buy_count'];
                $items_tmp[$pid]['package_id'] .= ",".$item['package_id'];
            }
            else
            {
                $items_tmp[$pid] = $item;
                $items_tmp[$pid]['cash_back'] = (isset($item['cash_back'])? $item['cash_back'] : 0) * $item['buy_count'];
            }
        }

        $itemsInShoppingCart = array();
        foreach($items_tmp as $pid => $item)
        {
            if (isset($item['product_saving_amount']))
                unset($item['product_saving_amount']);
            $itemsInShoppingCart[$pid] = $item;
        }

        self::Log("购物车商品信息获取结果getAllCartItemsInfo Result:items:"
                . ToolUtil::gbJsonEncode($items)
                . "suitInfo:" . ToolUtil::gbJsonEncode($suiteInfo)
                . "product_base_info:" . ToolUtil::gbJsonEncode($product_base_info)
                . "inventory:" . ToolUtil::gbJsonEncode($inventorys)
                . "itemsInShoppingCart:" . ToolUtil::gbJsonEncode($itemsInShoppingCart)
        );
        if (count($itemsInShoppingCart) == 0) {
            return array('errCode'=> 10, 'errMsg'=> "您的购物车中没有商品，请选购！");
        }

        $ret = self::checkVisitFrequency($product_base_info, $newOrder);
        if (false === $ret) {
            self::Log("place order checkVisitFrequency Failed!errCode:" . self::$errCode . "errMsg:" . self::$errMsg);
            return false;
        }
        //TODO:使用新的接口来完成这里的商品列表商品信息获取  End
        /*
                // 获取购物车商品列表
                $result = IPreOrderV2::getItemList($uid, $wh_id, $shoppingCartInfo);
                if (false === $result) {
                    self::$errCode = IPreOrderV2::$errCode;
                    self::$errMsg = IPreOrderV2::$errMsg . ",uid({$uid}) getItemList failed";
                    return array('errCode'=> self::$errCode, 'errMsg'=> "您的购物车中没有商品，请选购！");
                }
                // 购物车中的商品
                $items = $result['items'];

                if (isset($newOrder['ls']) && in_array($newOrder['ls'], self::$AppLS)) {
                    $items = IShoppingCart::filterPackageItems($items);
                }

                // 商品中的套餐信息
                $suiteInfo = $result['suiteInfo'];

                $bc_suite = array();
                foreach($suiteInfo as $key=>$su)
                {
                    foreach($su['product_list'] as $pinfo)
                    {
                        $pid = $pinfo['product_id'];
                        $bc_suite[$pid] = isset($bc_suite[$pid]) ? ($bc_suite[$pid] + $su['buy_count']) : $su['buy_count'];
                    }
                }

                $ret = IPreOrderV2::splitSuiteItems($items,$suiteInfo);
                $items = $ret['items'];
                self::Log(ToolUtil::gbJsonEncode($items));
                $items_tmp = array();
                foreach($items as $item)
                {
                    $pid = $item['product_id'];
                    if(array_key_exists($pid,$items_tmp))
                    {
                        $items_tmp[$pid]['buy_count'] += $item['buy_count'];
                        $items_tmp[$pid]['cash_back'] += (isset($item['cash_back'])? $item['cash_back'] : 0) * $item['buy_count'];
                        $items_tmp[$pid]['package_id'] .= ",".$item['package_id'];
                    }
                    else
                    {
                        $items_tmp[$pid] = $item;
                        $items_tmp[$pid]['cash_back'] = (isset($item['cash_back'])? $item['cash_back'] : 0) * $item['buy_count'];
                    }
                }

                $itemsInShoppingCart = array();
                foreach($items_tmp as $pid => $item)
                {
                    if (isset($item['product_saving_amount']))
                        unset($item['product_saving_amount']);
                    $itemsInShoppingCart[$pid] = $item;
                }

                self::Log("获取购物车中的商品列表:" . ToolUtil::gbJsonEncode($items) . "," . ToolUtil::gbJsonEncode($itemsInShoppingCart));

                if (count($itemsInShoppingCart) == 0) {
                    return array('errCode'=> 10, 'errMsg'=> "您的购物车中没有商品，请选购！");
                }*/

        reset($newOrder['suborders']);
        $countPost = 0;                                              //商品款数
        while (FALSE != ($node = current($newOrder['suborders'])))
        {
            if (!isset($node['items'])) {
                return array('errCode'=> 10, 'errMsg'=> "您提交的订单数据有误，请检查！");
            }
            $countPost += count($node['items']);
            next($newOrder['suborders']);
        }
        //self::Log("itemsInShoppingCart:".ToolUtil::gbJsonEncode($itemsInShoppingCart));



        //如果没有套餐，判断购物车中商品与前台展示的商品数量是一致的
        //如果有了套餐，商品id做key是合并了的，这里比较的是款数
        if(empty($suiteInfo))
        {
            if (count($itemsInShoppingCart) != $countPost) {
                self::$errCode = -2021;
                self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "items count in shoppingcart is not equal to post items count";
                self::Log("items count in shoppingcart is not equal to post items count[countPost:{$countPost}][itemInShoppingCart:" . count($itemsInShoppingCart));
                return false;
            }
        }
        /*
                //拉取购物车中的商品的赠品&配件
                $product_in_cart = array();
                //$multiPriceProduct = array();
                foreach ($itemsInShoppingCart as $item) {
                    $product_in_cart[] = $item['product_id'];
                }

                $product_base_info = IProduct::getProductsInfo($product_in_cart, $wh_id, true, true, $destination);
                if (false === $product_base_info) {
                    self::$errCode = IProduct::$errCode;
                    self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProduct failed]' . IProduct::$errMsg;
                    return false;
                }

                self::Log("抢购商品下单频率检查", false);
                //抢购商品下单频率检查
                $ret = self::checkVisitFrequency($product_base_info, $newOrder);
                if (false === $ret) {
                    return false;
                }

                self::Log("IPreOrder获取商品信息");
                $ret = IPreOrderV2::getItemInfo($items, $wh_id, $product_base_info, $destination);
                if (false === $ret) {
                    self::$errMsg = IPreOrderV2::$errMsg;
                    self::$errCode = IPreOrderV2::$errCode;
                    return false;
                }*/





        //$items = $ret['items'];
        self::Log(ToolUtil::gbJsonEncode($items));
        //判断商品是否是节能补贴商品
        if (isset($items[0]['flag'])
            && IProduct::isEnergySubsidyProduct($items[0]['flag'], true)
            && self::esInfoCheck($newOrder)
            && count($items) == 1
        )
        {
            $isEnergySavingType = 2;
        }
        else
        {
            $isEnergySavingType = 1;
        }
        // MARK 接入新的促销批价
        $rule_id = !empty($newOrder['rule_id']) ? intval($newOrder['rule_id']) : 0;
        $promotionRule = IPromotionRuleV2::checkRuleForOrder($items, $wh_id, $uid, $rule_id, $isEnergySavingType);
        if (false === $promotionRule) {
            if(106 == IPromotionRuleV2::$errCode)
            {
                self::$errCode = IPromotionRuleV2::$errCode;
                self::$errMsg = IPromotionRuleV2::$errMsg;
                self::Log("checkRuleForOrder 您参加的活动已结束或终止:errCode" . self::$errCode . ";errMsg:" . self::$errMsg);
                return array('errCode'=> -991, 'errMsg'=> '抱歉，您参加的活动已结束或终止，请您返回购物车重新操作');
            }
            else if(107 == IPromotionRuleV2::$errCode)
            {
                self::$errCode = IPromotionRuleV2::$errCode;
                self::$errMsg = IPromotionRuleV2::$errMsg;
                self::Log("checkRuleForOrder 活动已达到参与次数上限:errCode" . self::$errCode . ";errMsg:" . self::$errMsg);
                return array('errCode'=> -992, 'errMsg'=> "抱歉，您所参与的活动已达到参与次数上限，不能再参加该活动");
            }
            else
            {
                self::$errCode = IPromotionRuleV2::$errCode;
                self::$errMsg = IPromotionRuleV2::$errMsg;
                self::Log("checkRuleForOrder Failed!:errCode" . self::$errCode . ";errMsg:" . self::$errMsg);
                return false;
            }
        }
        self::Log("\n\tIPromotionRuleV2 result:".ToolUtil::gbJsonEncode($promotionRule));

        $promotion = $promotionRule['promotion'];
        $items = $promotionRule['items'];
        $restricts = $promotionRule['restrict'];

        $ret = self::checkAppointInfo($uid, $items);
        self::Log("检查预约结果" . var_export($ret, true));

        if ($ret == false) {
            return array('errCode'=> self::$errMsg, 'errMsg'=> self::$errCode);
        }


        // 拆分订单，所有需要对items进行改变的操作，请在拆单之前进行
        // handywu 对应的新拆单数据，不兼容老的
        /*
		$divideOrder = IPreOrderV2::DivideOrder($items, $wh_id);
		if (false === $divideOrder) {
			return false;
		}

		// 订单的包裹信息，包括虚库，重量，具体的包裹信息等等
		$isVirtual = $divideOrder['order']['isVirtual'];
		$bVirtual = array();
        */

        $packages = $newOrder['suborders'];
        $productToPackID = array();
        foreach($packages as $subOrderId => $subOrderInfo)
        {
            foreach($subOrderInfo['items'] as $productInfo)
            {
                $productToPackID[$productInfo['product_id']] = $subOrderId;
            }
        }

        foreach($items as $key => $item)
        {
            $items[$key]['divide_id'] = $productToPackID[$item['product_id']];
        }

        //获取商品&赠品&配件信息结束
        //检查前台传入的商品列表 与 购物车中商品列表是否一致 , 同时检查商品，赠品，组件的状态，禁运类型(配送已做，这里去掉)
        //$restricted_trans_type = array();
        $shoppingProduct = array();
        $productInShoppingCart = array();

        self::Log("检查前台传入的商品列表 与 购物车中商品列表是否一致");
        //同时检查能否模糊开票，开增值发票
        $isCanVATInvoice = true;
        $c3ids = array();
        reset($newOrder['suborders']);

        while (FALSE != ($subOrder = current($newOrder['suborders'])))
        {
            $subOrderKey = key($newOrder['suborders']);
            $shoppingProduct[$subOrderKey] = array();
            next($newOrder['suborders']);
            foreach ($subOrder['items'] as $orderItem)
            {
                $exist = false;
                foreach ($itemsInShoppingCart as $itemInCart)
                {
                    if ($orderItem['product_id'] == $itemInCart['product_id'] ){
                        //订购数量不一致
                        if ($orderItem['num'] != $itemInCart['buy_count']) {
                            return array('errCode'=> -1, 'errMsg'=> "购物车中商品" . $product_base_info[$itemInCart['product_id']]['name'] . "{$orderItem['num']}订购数量不正确，请返回购物车修改数量{$itemInCart['buy_count']}");
                        } //商品基本信息不存在
                        else if (!isset($product_base_info[$orderItem['product_id']])) {
                            return array('errCode'=> -2, 'errMsg'=> "购物车中商品" . $product_base_info[$itemInCart['product_id']]['name'] . "暂不销售，请返回购物车删除");
                        } //商品状态不合法
                        else if (isset($product_base_info[$orderItem['product_id']]['status']) && $product_base_info[$orderItem['product_id']]['status'] != PRODUCT_STATUS_NORMAL /*&& true != $itemInCart['isPromotionGift'] */) {
                            return array('errCode'=> -3, 'errMsg'=> "购物车中商品" . $product_base_info[$itemInCart['product_id']]['name'] . "暂不销售，请返回购物车删除");
                        }// handywu else if ($product_base_info[$orderItem['product_id']]['psystock'] != $subOrderKey) {
                        else if ($product_base_info[$orderItem['product_id']]['psystock'] != $packages[$subOrderKey]['psystock']) {
                            self::Log("product_base_info=".ToolUtil::gbJsonEncode($product_base_info)."---".$packages[$subOrderKey]['psystock']);
                            return array('errCode'=> -3, 'errMsg'=> "购物车中商品" . $product_base_info[$itemInCart['product_id']]['name'] . "信息已经改变，请刷新页面");
                        }
                        else
                        {
                            $shoppingProduct[$subOrderKey][$itemInCart['product_id']]['product_id'] = $itemInCart['product_id'];
                            $shoppingProduct[$subOrderKey][$itemInCart['product_id']]['OTag'] = $itemInCart['OTag'];
                            @$shoppingProduct[$subOrderKey][$itemInCart['product_id']]['buy_count'] += $itemInCart['buy_count'];

                            $shoppingProduct[$subOrderKey][$itemInCart['product_id']]['main_product_id'] = $itemInCart['main_product_id'];
                            $shoppingProduct[$subOrderKey][$itemInCart['product_id']]['type'] = SHOPPING_CART_PRODUCT_TYPE_NORMAL;
                            //@$restricted_trans_type[$product_base_info[$orderItem['product_id']]['restricted_trans_type']][] = $orderItem['product_id']; //$product_base_info[$orderItem['product_id']]['restricted_trans_type'];

                            if ($product_base_info[$itemInCart['product_id']]['flag'] & CAN_VAT_INVOICE == 0) {
                                $isCanVATInvoice = false;
                            }

                            $c3ids[] = $product_base_info[$itemInCart['product_id']]['c3_ids'];
                            $productInShoppingCart[] = $itemInCart['product_id'];
                        }
                        $exist = true;
                        break;
                    }
                }
                if (false === $exist) {
                    return array('errCode'=> -4, 'errMsg'=> "购物车中商品" .
                        (isset($product_base_info[$orderItem['product_id']]) ? $product_base_info[$orderItem['product_id']]['name'] : $orderItem['product_id'])
                        . "不存在，请返回购物车删除该商品");
                }


                //查看该商品附送的赠品&配件是否匹配
                foreach ($orderItem['gift'] as $g_p_id)
                {
                    if (!isset($product_base_info[$orderItem['product_id']]['gifts'][$g_p_id])) {
                        return array('errCode'=>-5, 'errMsg'=>"购物车中赠品/组件" . $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['name'] . "暂时无货，请返回购物车删除");
                    }//商品状态不合法
                    else if ( isset($product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['status']) &&  $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['status'] == PRODUCT_STATUS_NORMAL) {
                        return array('errCode'=>-6, 'errMsg'=>"购物车中赠品/组件" . $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['name'] . "暂时无货，请返回购物车删除");
                    }/*else if ($product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['psystock'] != $subOrderKey) {
						return array('errCode'=>-6, 'errMsg'=>"购物车中赠品/组件" . $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['name'] . "信息已改变，请刷新页面");
					}*/
                    else
                    {
                        $shoppingProduct[$subOrderKey][$g_p_id]['product_id'] = $g_p_id;
                        @$shoppingProduct[$subOrderKey][$g_p_id]['buy_count'] += $orderItem['num'] * $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['num'];
                        $shoppingProduct[$subOrderKey][$g_p_id]['OTag'] = '';
                        $shoppingProduct[$subOrderKey][$g_p_id]['main_product_id'] = 0;
                        $shoppingProduct[$subOrderKey][$g_p_id]['belongto_product_id'] = $orderItem['product_id'];
                        if ($product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['type'] == 1) {
                            $shoppingProduct[$subOrderKey][$g_p_id]['type'] = SHOPPING_CART_PRODUCT_TYPE_ZUJIAN;
                        }else
                        {
                            $shoppingProduct[$subOrderKey][$g_p_id]['type'] = SHOPPING_CART_PRODUCT_TYPE_GIFT;
                        }
                        //@$restricted_trans_type[$product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['restricted_trans_type']][] = $g_p_id; // = $product_base_info[$gift['gift_id']]['restricted_trans_type'];
                        $exist = true;
                        $productInShoppingCart[] = $g_p_id;
                    }
                }
            }
        }


        foreach($items as $it)
        {
            $pid = $it['product_id'];
            //handywu $subOrderKey = $it['psystock'];
            $subOrderKey = $it['divide_id'];
            if(isset($shoppingProduct[$subOrderKey][$pid]))
            {

                if(empty($shoppingProduct[$subOrderKey][$pid]['total_price'])) {
                    $shoppingProduct[$subOrderKey][$pid]['total_price'] = 0;
                    $shoppingProduct[$subOrderKey][$pid]['promotion_total_price'] = 0;
                }


                // 累加多价后的总价
                $shoppingProduct[$subOrderKey][$pid]['total_price'] += $it['total_price_after'];
                $shoppingProduct[$subOrderKey][$pid]['promotion_total_price'] += $it['promotion_price'];
            }
        }

        foreach($shoppingProduct as $subOrderKey => $so)
        {
            foreach($so as $pid => $pInfo)
            {
                // 重新计算每个商品的单价
                $shoppingProduct[$subOrderKey][$pid]['price'] = intval($pInfo['total_price'] / $pInfo['buy_count']);
            }
        }
        self::Log("shopping Product==>".print_r($shoppingProduct, true));

        self::Log("验证是否可以开增值税发票");
        //验证是否可以开增值税发票

        if ($isCanVATInvoice === false && $newOrder['invoiceType'] == INVOICE_TYPE_VAT) {
            return array('errCode'=> -20, 'errMsg'=> '您的订单中有商品不能开增值税发票');
        }


        // android 深圳站订单发票转换
        if (isset($newOrder['ls']) && in_array($newOrder['ls'], array('--android--')) && $wh_id == SITE_SZ) {
            if ($newOrder['invoiceType'] == INVOICE_TYPE_RETAIL_COMPANY || $newOrder['invoiceType'] == INVOICE_TYPE_RETAIL_PERSONAL)
                $newOrder['invoiceType'] = INVOICE_TYPE_VAT_NORMAL;
        }

        //如果选择整机服务，不能选择货到付款

        self::Log("验证选择整机安装");
        //选择整机安装，不能选择货到付款
        global $_PAY_MODE;
        if ($_PAY_MODE[$wh_id][$newOrder['payType']]['PayTypeName'] == '货到付款') {
            global $_NotPayWhenArrive;
            $bothExist = array_intersect($_NotPayWhenArrive, $productInShoppingCart);
            if (count($bothExist) != 0) {
                return array('errCode'=> -22, 'errMsg'=> '您选择了整机安装服务，不能选择货到付款支付方式');
            }
        }

        //检测某些特殊不包含在购物车中，则不能选择自提点
        //如果不包含这些特殊商品，需要剔除自提

        self::Log("验证选择自提");
        global $_SelfFetchProductids;
        global $_LGT_MODE;
        //如果选择的是上门自提方式，需要检测购物车中存在特定商品
        if (false !== strpos($_LGT_MODE[$newOrder['shipType']]['ShipTypeName'], '上门提货')) {
            $bothExist = array_intersect($_SelfFetchProductids, $productInShoppingCart);
            if (count($bothExist) == 0) {
                return array('errCode'=> -29, 'errMsg'=> '对不起，您所购买的商品不能选择上门提货');
            }
        }

        self::Log("验证您提交发票内容");
        $invoinceContent = IPreOrderV2::getInvoicesContentOpt($c3ids,$wh_id);
        if($newOrder['isVat'] == self::HAS_INVOICE)
        {
            if (!in_array($newOrder['invoiceContent'], $invoinceContent)) {
                return array('errCode'=>-21, 'errMsg'=>'您提交发票内容不合法');
            }
        }

        //$shoppingProduct 这里是根据前端进行了拆单后的数据了，这里含有了赠品和组件的信息，赠品和组件当作一条商品数据
        // reset($items);
        //       foreach($items as $it)
        // {
        // 	$pid = $it['product_id'];
        //           $subOrderKey = $it['divide_id'];
        // 	if(isset($shoppingProduct[$subOrderKey][$pid]))
        // 	{
        // 		if(empty($shoppingProduct[$subOrderKey][$pid]['total_price']))
        //               {
        // 			$shoppingProduct[$subOrderKey][$pid]['total_price'] = 0;
        //                   $shoppingProduct[$subOrderKey][$pid]['promotion_total_price'] = 0;
        //               }
        // 		//累加多价后的总价
        // 		$shoppingProduct[$subOrderKey][$pid]['total_price'] += $it['total_price_after'];
        //               $shoppingProduct[$subOrderKey][$pid]['promotion_total_price'] += $it['promotion_price'];
        // 	}
        //           else
        //           {
        //               $shoppingProduct[$subOrderKey][$pid]['promotion_total_price'] = $it['promotion_price'];
        //           }
        // }

        foreach($shoppingProduct as $subOrderKey => $so)
        {
            foreach($so as $pid => $pInfo)
            {
                // 重新计算每个商品的单价
                $shoppingProduct[$subOrderKey][$pid]['price'] = intval($pInfo['total_price'] / $pInfo['buy_count']);
            }
        }

        //删除禁运类型0（不限运）
        //unset($restricted_trans_type[0]);
        //unset($gifts);
        //检查前台传入的购物车内容 与 后台购物车内容 一致完毕


        //优惠券检测
        self::Log("优惠券检测");
        $couponInfo = array('amt'=>0, 'code'=>'', 'type'=>0);
        //节能补贴商品临时搞搞 Start
        if(2 == $isEnergySavingType && isset($newOrder['couponCode']))
        {
            $newOrder['couponCode'] = "";
        }
        //节能补贴商品临时搞搞 End
        if (isset($newOrder['couponCode']) && $newOrder['couponCode'] != "" ) {
            /*handywu
            if ( (isset($newOrder['ls'])) && ( in_array($newOrder['ls'], array('--android--','--iphone--'))) )
            {
                $couponInfo = ICoupon::checkAppCoupon($uid, $newOrder['couponCode'], $newOrder['receiveAddrId'], $newOrder['payType'] ,$wh_id,$itemsInShoppingCart);
            }
            else if (in_array($newOrder['ls'], array('--mobile--'))){
                $couponInfo = ICouponV2::checkCoupon($uid, $newOrder['couponCode'], $newOrder['receiveAddrId'], $newOrder['payType'] ,$wh_id, 1);
            }
            else {
                $couponInfo = ICouponV2::checkCoupon($uid, $newOrder['couponCode'], $newOrder['receiveAddrId'], $newOrder['payType'] ,$wh_id, 0);
            }
            */
            $clientType = 0;
            if ( (isset($newOrder['ls'])) && ( in_array($newOrder['ls'], array('--android--','--iphone--'))) )
            {
                $clientType = 2;
            }
            else if (in_array($newOrder['ls'], array('--mobile--'))){
                $clientType = 1;
            }

            $couponInfo = ICouponV2::checkCouponForOrder(
                $uid,
                $newOrder['couponCode'],
                $newOrder['receiveAddrId'],
                $newOrder['payType'] ,
                $items,
                $product_base_info,
                $packages,
                $wh_id,
                $clientType);
            if (false === $couponInfo) {
                self::$errCode = ICouponV2::$errCode;
                self::$errMsg = ICouponV2::$errMsg;
                self::Log("checkCouponForOrder Error[couponCode:{$newOrder['couponCode']}][receiveAddrId:{$newOrder['receiveAddrId']}][payType:{$newOrder['payType']}]");
                return array('errCode' => self::$errCode, 'errMsg' => self::$errMsg);
            }
        }
        /*
         * MARK 去掉EDM逻辑
        self::Log("开始计算EDM专享");
        $product_base_info = IPreOrderV2::getEDMInfo($userInfo, $wh_id, $product_base_info);
        if (false === $product_base_info) {
            self::$errCode = IPreOrderV2::$errCode;
            self::$errMsg = IPreOrderV2::$errMsg;
            return false;
        }*/

        //处理邮件专享价格完毕

        $pointMax = 0;
        $pointMin = 0;
        global $_OrderState;
        $limitedProduct = array();

        self::Log("获取可用积分范围");
        reset($shoppingProduct);
        while (FALSE != ($subOrderItem = current($shoppingProduct))) {
            $subOrderKey = key($shoppingProduct);
            next($shoppingProduct);

            foreach ($subOrderItem as $item)
            {
                if ($item['type'] != SHOPPING_CART_PRODUCT_TYPE_NORMAL) {
                    continue;
                }
                $exist = isset($product_base_info[$item['product_id']]) ? true : false;
                if (false === $exist) {
                    return array('errCode'=> -9, 'errMsg'=> "购物车中商品" . $product_base_info[$item['product_id']]['name'] . "暂不销售，请返回购物车删除");
                }
                $p = $product_base_info[$item['product_id']];


                if ($p['num_limit'] > 0 && $p['num_limit'] < 999) {
                    if ($p['num_limit'] < $item['buy_count']) {
                        return array('errCode'=> -8, 'errMsg'=> "购物车中商品" . $product_base_info[$item['product_id']]['name'] . "超过限购数量" . $p['num_limit']);
                    }
                    $limitedProduct[$p['product_id']] = $subOrderKey;
                }
                //可用积分使用多价前还是后
                if ($p['point_type'] != PRODUCT_CASH_PAY_ONLY) {
                    $pointMax += ($p['price'] /*+ $p['cash_back'] */) * $shoppingProduct[$subOrderKey][$p['product_id']]['buy_count'];
                }

                if ($p['point_type'] == PRODUCT_POINT_PAY_ONLY) {
                    $pointMin += $p['price'] * $shoppingProduct[$subOrderKey][$p['product_id']]['buy_count'];
                }

            }
        }

        //如果购物车中商品有限购商品，则查询该用户当天的订单
        //这里部署外网需要修改分库分表的问题,多价的限购是否未考虑？
        reset($items);
        foreach($items as $item)
        {
            if(1 == $item['price_buy_limit_flag'])
            {
                return array('errCode'=> -8, 'errMsg'=> "购物车中商品" . $item['name'] . "超过限购数量" . $item['mult_limit_num']);
            }
        }
        self::Log("检查限购商品");
        $db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
        if (!empty($limitedProduct)) {
            $timestamp = mktime(0,0,0,date('m'), date('d'), date('Y') );

            $sql = "select product_id, sum(buy_num) as buy_num from
			t_order_items_{$db_tab_index['table']} ot,
			t_orders_{$db_tab_index['table']} o
			where o.order_char_id=ot.order_char_id".
                " and o.status<>". $_OrderState['ManagerCancel']['value'] .
                " and o.status<>". $_OrderState['CustomerCancel']['value'].
                " and o.status<>". $_OrderState['EmployeeCancel']['value']." and ot.uid=" . $uid. " and create_time > " . $timestamp .
                " and product_id in(" . implode(',', array_keys($limitedProduct)) . ") group by product_id";


            $orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
            if (empty($orderDb)) {
                self::$errCode = Config::$errCode;
                self::$errMsg = Config::$errMsg;
                return false;
            }
            $userOrder = $orderDb->getRows($sql);
            if (false === $userOrder) {
                self::$errCode = $orderDb->errCode;
                self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[query order db failed]' . $orderDb->errMsg;
                return false;
            }

            if (!empty($userOrder)) {
                foreach ($userOrder as $order)
                {
                    if ($order['buy_num'] >= $product_base_info[$order['product_id']]['num_limit']) {
                        return array('errCode'=>-11, 'errMsg'=>"购物车中商品" . $product_base_info[$order['product_id']]['name'] . "是限购商品，您今日购买数量已经超过限购数量");
                    }
                    else if ($order['buy_num'] + $shoppingProduct[$limitedProduct[$order['product_id']]][$order['product_id']]['buy_count'] > $product_base_info[$order['product_id']]['num_limit']) {
                        return array('errCode'=>-12, 'errMsg'=>"购物车中商品" . $product_base_info[$order['product_id']]['name'] .
                            "是限购商品，您今日还能购买" . ($product_base_info[$order['product_id']]['num_limit'] - $order['buy_num']) . "个" );
                    }
                }
            }
        }
        //加一下多价的限购吧

        self::Log("开始检查库存");
        $msSQL = ToolUtil::getMSDBObj('Inventory_Manager');
        if (empty($msSQL)) {
            self::$errCode = Config::$errCode;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "query ms sql faild " . Config::$errMsg;
            self::Log("检查库存 DB 连接失败errCode:".self::$errCode.";errMsg:".self::$errMsg);
            return false;
        }

        $sql = "select SysNo, ProductSysNo, StockSysNo, AvailableQty, VirtualQty, OrderQty from Inventory_Stock where ProductSysNo in (" . implode(",", $productInShoppingCart) . ")";
        $productStocks = $msSQL->getRows($sql);

        if (false === $productStocks) {
            self::$errCode = $msSQL->errCode;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "query ms sql faild " . $msSQL->errMsg;
            self::Log("检查库存 DB 查询失败errCode:".self::$errCode.";errMsg:".self::$errMsg);
            return false;
        }

        $giftLackOfStock = array();
        $lackGiftAndIgnore = false;
        $containVirtual = array();
        $easyKey = array();

        self::Log("赠品");

        reset($shoppingProduct);
        while (FALSE != ($subOrderItem = current($shoppingProduct))) {
            $subOrderKey = key($shoppingProduct);
            next($shoppingProduct);

            foreach ($subOrderItem as $kk => $sp)
            {
                //获取随心配商品的主商品
                if ($sp['type'] === SHOPPING_CART_PRODUCT_TYPE_NORMAL && $sp['main_product_id'] != 0) {
                    $easyKey[$sp['main_product_id']] = $sp['main_product_id'];
                }
                //获取随心配商品的主商品

                $exist = false;
                foreach ($productStocks as $pstock)
                {
                    //handywu if ($sp['product_id'] == $pstock['ProductSysNo'] && $subOrderKey == $pstock['StockSysNo']) {
                    if ($sp['product_id'] == $pstock['ProductSysNo'] && $packages[$subOrderKey]['psystock'] == $pstock['StockSysNo']) {
                        $exist = true;
                        if (($pstock['AvailableQty'] + $pstock['VirtualQty'] <= 0) && $sp['type'] != SHOPPING_CART_PRODUCT_TYPE_GIFT) {
                            IInventoryStockTTC::update(array('product_id'=>$sp['product_id'], 'num_available'=>$pstock['AvailableQty'], 'virtual_num'=> $pstock['VirtualQty']), array('sys_no'=>$pstock['SysNo']));
                            if($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_ZUJIAN)
                            {
                                return array('errCode'=>-15, 'errMsg'=>'组件'.$product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name']."库存不足,请联系客服");
                            }
                            return array('errCode'=>-14, 'errMsg'=>'商品'.$product_base_info[$sp['product_id']]['name']."库存不足");
                        }
                        if ($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_GIFT) //赠品
                        {
                            if ($pstock['AvailableQty'] + $pstock['VirtualQty'] < $sp['buy_count']) {
                                IInventoryStockTTC::update(array('product_id'=> $sp['product_id'], 'num_available'=> $pstock['AvailableQty'], 'virtual_num'=> $pstock['VirtualQty']), array('sys_no'=> $pstock['SysNo']));
                                if (!isset($newOrder['ingoreLackOfGift'])) { //如果第一次提交订单
                                    $giftLackOfStock[$sp['product_id']] = $product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name'];
                                } else if ($newOrder['ingoreLackOfGift'] == 1) { //用户接受缺少礼品
                                    $shoppingProduct[$subOrderKey][$kk]['buy_count'] = $pstock['AvailableQty'] + $pstock['VirtualQty'];
                                    if ($shoppingProduct[$subOrderKey][$kk]['buy_count'] <= 0) {
                                        unset($shoppingProduct[$subOrderKey][$kk]);
                                    }
                                    $lackGiftAndIgnore = true;
                                } else //用户不接受，则拒绝下单
                                {
                                    return array('errCode'=> -13, 'errMsg'=> '赠品' . $product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name'] . "库存不足");
                                }
                            }
                        } else if ($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_ZUJIAN) {
                            if ($pstock['AvailableQty'] + $pstock['VirtualQty'] < $sp['buy_count']) {
                                return array('errCode'=> -15, 'errMsg'=> '组件' . $product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name'] . "库存不足,请联系客服");
                            }
                        } else //主商品
                        {
                            /*
                            if ($pstock['AvailableQty'] < $sp['buy_count']) {
                                $bVirtual[$subOrderKey] = true;

                            }
                            */
                            if (($pstock['AvailableQty'] + $pstock['VirtualQty'] < $sp['buy_count']) &&
                                (($wh_id != 1) || ($product_base_info[$sp['product_id']]['flag'] & FORBID_SET_VIRTUAL) == FORBID_SET_VIRTUAL ||
                                    $product_base_info[$sp['product_id']]['type'] != PRODUCT_TYPE_NORMAL)
                            ) {
                                return array('errCode'=> -15, 'errMsg'=> '商品' . $product_base_info[$sp['product_id']]['name'] . "库存不足");
                            }
                        }
                        $product_base_info[$sp['product_id']]['AvailableQty'] = $pstock['AvailableQty'];
                        $product_base_info[$sp['product_id']]['VirtualQty'] = $pstock['VirtualQty'];
                        break;
                    }
                }
                if (false === $exist) {
                    return array('errCode'=> -16, 'errMsg'=> '商品' . $product_base_info[$sp['product_id']]['name'] . "暂不销售");
                }
            }
        }


        if (count($giftLackOfStock) != 0) {
            $errMsg = "购物车中赠品:";
            foreach ($giftLackOfStock as $key=>$name)
            {
                $errMsg .= $name . "库存不足,";//仅剩下" . $num ."件,";
            }
            $errMsg .= "是否继续下单?";
            return array('errCode'=> -100, 'errMsg'=> $errMsg);
        }

        // 添加提示
        if ($lackGiftAndIgnore) {
            $newOrder['comment'] .= "\n系统自动备注：用户已接受缺货赠品库存不足。";
        }

        //库存检查结束
        $isEnergySubsidyOrder = false;

        //检查禁运类型
        /*
        self::Log("检查禁运类型");
        global $_District;
        $shipTypeNotAva = IShipping::getForbidenShippingType($restricted_trans_type, $_District[$newOrder['receiveAddrId']]['province_id'], $_District[$newOrder['receiveAddrId']]['city_id'], $newOrder['receiveAddrId'], $wh_id);
        if (false === $shipTypeNotAva) {
            self::$errCode = -2031;
            self::$errMsg = '获取禁运类型->运送方式失败';
            return false;
        }

        $shipTypeNotAva = array_keys($shipTypeNotAva);
        if (in_array($newOrder['shipType'], $shipTypeNotAva)) {
            return array('errCode'=> -17, 'errMsg'=> "购物车中有商品不支持您选择的运送方式");
        }
        */
        //检查禁运类型失败

        /*
         * MARK 去除随心配的逻辑
        //拉取随心配
        //ixiuzeng添加，广东站的随心配从广东站获取，上海和北京的随心配依然从上海获取
        $wh_id_temp = NULL;
        if (1001 == $wh_id) {
            $wh_id_temp = 1001;
        }
        else {
            $wh_id_temp = 1;
        }
        self::Log("随心配", false);
        $easyMatch = IProductRelativityTTC::gets($easyKey, array('type'=> PRODUCT_BY_MIND, 'status'=> 1, 'wh_id' => $wh_id_temp));
        if (false === $easyMatch) {
            self::$errCode = IProductRelativityTTC::$errCode;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductRelativityTTC failed]' . IProductRelativityTTC::$errMsg;
            return false;
        }

        //拉取随心配商品结束
        //计算随心配应该优惠的价格&套数
        $actpid = 0;
        reset($shoppingProduct);
        while (FALSE != ($subOrderItem = current($shoppingProduct))) {
            $subOrderKey = key($shoppingProduct);
            next($shoppingProduct);

            foreach ($subOrderItem as $sp)
            {
                if ($sp['type'] != SHOPPING_CART_PRODUCT_TYPE_NORMAL) {
                    continue;
                }
                $actpid = $sp['product_id'];
                if ($sp['main_product_id'] == 0) {
                    continue;
                }
                $mainProductGroup = isset($product_base_info[$sp['main_product_id']])? $product_base_info[$sp['main_product_id']]['psystock'] : -1;
                if(isset($shoppingProduct[$mainProductGroup][$sp['main_product_id']]))
                {
                    $buy_count_tmp = $sp['buy_count'] - (isset($bc_suite[$sp['product_id']]) ? $bc_suite[$sp['product_id']] : 0);
                    $mp_count = $shoppingProduct[$mainProductGroup][$sp['main_product_id']]['buy_count'] - (isset($bc_suite[$sp['main_product_id']]) ? $bc_suite[$sp['main_product_id']] : 0);
                    $matchItems = min($buy_count_tmp,$mp_count);
                }
                else
                {
                    $matchItems = 0;
                }
                $shoppingProduct[$subOrderKey][$sp['product_id']]['matchNum'] = $matchItems;
                $shoppingProduct[$subOrderKey][$sp['product_id']]['cashCutPerItem'] = 0;
                foreach ($easyMatch as $em)
                {
                    if ($em['product_id'] == $sp['main_product_id'] && $em['relative_id'] == $sp['product_id']) {
                        $cashCut = intval($em['property']) > 0? intval($em['property']) : 0;
                        //这里需要和随心配商品的成本价比较么？ 不比较太危险了
                        $shoppingProduct[$subOrderKey][$sp['product_id']]['cashCutPerItem'] = $cashCut;
                        break;
                    }
                }
            }
        }
        */
        //随心配检查完成

        //计算价格
        $orderPrice = 0;
        $totalWeight = 0;
        $totalCut = 0;

        global $_ProductType;
        global $ProductForNongHang;
        $subOrders = array();
        $has_service = false;
        $is_energy_subsidy_order = false;
        foreach ($shoppingProduct as $subOrderKey => $subOrderItem) {
            foreach ($subOrderItem as $sp) {
                $subOrders[$subOrderKey]['product_ids'][] = $sp['product_id']; //clark 记录商品ID

                $totalWeight += $sp['buy_count'] * $product_base_info[$sp['product_id']]['weight'];
                @$subOrders[$subOrderKey]['totalWeight'] += $sp['buy_count'] * $product_base_info[$sp['product_id']]['weight'];

                if (!isset($subOrders[$subOrderKey]['flag'])) {
                    $subOrders[$subOrderKey]['flag'] = 0;
                }

                if ($product_base_info[$sp['product_id']]['type'] == $_ProductType['Service']) {
                    $subOrders[$subOrderKey]['flag'] |= ORDER_HAS_SERVICE; //记录订单中是否有服务类商品
                    $has_service = true;
                }

                if (in_array($sp['product_id'], $ProductForNongHang)) {
                    $subOrders[$subOrderKey]['flag'] |= ORDER_NONGHANG; //订单中包含农行商品
                    $newOrder['isVat'] = self::NO_INVOICE; //则不开发票
                }

                if (isset($userInfo['type'])) {
                    global $_USER_TYPE;
                    if ($_USER_TYPE['EnterpriseUser'] == $userInfo['type']) {
                        $subOrders[$subOrderKey]['flag'] |= ORDER_ENTERPRISE_USER;
                    }
                    else if ($_USER_TYPE['ChaohuoUser'] == $userInfo['type'])
                    {
                        $subOrders[$subOrderKey]['flag'] |= ORDER_CHAOHUO_USER;
                    }else if ($_USER_TYPE['WholeSalerUser'] == $userInfo['type'])
                    {
                        $subOrders[$subOrderKey]['flag'] |= ORDER_WHOLESALER_USER;
                    }else if ($_USER_TYPE['RetailersUser'] == $userInfo['type'])
                    {
                        $subOrders[$subOrderKey]['flag'] |= ORDER_RETAILERS_USER;
                    }
                }
                //商品价格  sheldonshi
                $product_base_info[$sp['product_id']]['price'] = $sp['price'];

                if ($sp['type'] != SHOPPING_CART_PRODUCT_TYPE_NORMAL) {
                    continue;
                }
                /*
                 * MARK 订单总价累计，更换字段，并添加新的逻辑
                @$subOrders[$subOrderKey]['orderPrice'] += $product_base_info[$sp['product_id']]['price'] * $sp['buy_count'];
                $orderPrice += $product_base_info[$sp['product_id']]['price'] * $sp['buy_count'];
                */

                /*
                 * MARK 随心配 cash_back，去除，并添加新的逻辑
                if ($sp['main_product_id'] > 0 && $sp['matchNum'] > 0) {
                    $orderPrice -= $sp['matchNum'] * $sp['cashCutPerItem'];
                    @$subOrders[$subOrderKey]['orderPrice'] -= $sp['matchNum'] * $sp['cashCutPerItem'];
                    $totalCut += $sp['matchNum'] * $sp['cashCutPerItem'];
                    @$subOrders[$subOrderKey]['totalCut'] += $sp['matchNum'] * $sp['cashCutPerItem'];
                }
                 *
                 */



                //ixiuzeng添加，订单中含有套餐时，优惠价格计入返现值
                /*
                if(isset($itemsInShoppingCart[$sp['product_id']]))
                {
                    @$orderPrice -= $itemsInShoppingCart[$sp['product_id']]['cash_back'];
                    self::Log("3,".$orderPrice);
                    @$subOrders[$subOrderKey]['orderPrice'] -= $itemsInShoppingCart[$sp['product_id']]['cash_back'];

                    @$totalCut += $itemsInShoppingCart[$sp['product_id']]['cash_back'];
                    @$subOrders[$subOrderKey]['totalCut'] += $itemsInShoppingCart[$sp['product_id']]['cash_back'];
                }*/

                //ixiuzeng添加,订单中含有限时抢购或者二手商品，增加一个标志位
                if ((TIME_LIMITED_RUSHING_BUY == ($product_base_info[$sp['product_id']]['flag'] & TIME_LIMITED_RUSHING_BUY)
                    || OTHER_TIME_LIMITED_RUSHING_BUY == ($product_base_info[$sp['product_id']]['flag'] & OTHER_TIME_LIMITED_RUSHING_BUY)
                    || ($product_base_info[$sp['product_id']]['type'] == $_ProductType['SecondHand']))
                    && $_PAY_MODE[$wh_id][$newOrder['payType']]['IsNet'] == 1 ) {

                    if (!isset($subOrders[$subOrderKey]['flag'])) {
                        $subOrders[$subOrderKey]['flag'] = ORDER_RUSHING_BUY_ONLINE_PAY;
                    }
                    else {
                        $subOrders[$subOrderKey]['flag'] = $subOrders[$subOrderKey]['flag'] | ORDER_RUSHING_BUY_ONLINE_PAY;
                    }
                }

                // 如果是节能补贴商品，而且补贴身份信息完整，则判定为节能补贴订单
                if (PRODUCT_ENERGY_SUBSIDY == ($product_base_info[$sp['product_id']]['flag'] & PRODUCT_ENERGY_SUBSIDY)
                    && self::esInfoCheck($newOrder))
                {

                    //if(self::esInfoCheck($newOrder))
                    //{
                    $isEnergySubsidyOrder = TRUE;
                    $is_energy_subsidy_order = TRUE;
                    if (!isset($subOrders[$subOrderKey]['flag'])) {
                        $subOrders[$subOrderKey]['flag'] = ORDER_ENERGY_SUBSIDY;
                    }
                    else
                    {
                        $subOrders[$subOrderKey]['flag'] = $subOrders[$subOrderKey]['flag'] | ORDER_ENERGY_SUBSIDY;
                    }
                    //}
                    /*
                    else
                    {
                        return array('errCode' => 6002,'errMsg'=> "使用了节能补贴优惠，但是没有身份信息或信息错误");
                    }
                    */
                }
            }
        }

        if (!empty($promotion)) {
            //这里分支逻辑只处理了立减
            switch($promotion['benefit_type'])
            {
                case IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_CASH']:
                    // 立减，记录优惠的总价
                    $rule_discount = $promotion['benefits'];
                    break;
                default:
                    $rule_discount = 0;
                    break;

            }
            $couponInfo['code'] = "rule_{$promotion['rule_id']}";
            $couponInfo['type'] = $promotion['account_type'];
            $couponInfo['amt'] = $rule_discount;
            $couponInfo['subOrders'] = array();
        }


        // MARK 处理批价结果
        reset($items);
        // 参加促销规则的商品总金额
        //$promotionAmt = 0;
        //批价明细
        $priceDetails = array();
        $energySaveDiscount = 0;
        foreach($items as $it)
        {
            $it_str = ToolUtil::gbJsonEncode($it);
            //handywu $subOrderKey = $it['psystock'];
            $subOrderKey = $it['divide_id'];
            Logger::info("it_str [{$it_str}]");
            // MARK 商品的核对价格，这个$pPrice定义需要确认
            if( $it['package_id'] == 0 )
            {
                // 经过批价的商品，该商品的总的减免价格
                //$ptotalCut = $it['total_price_discount'] + $it['promotion_discount'];
                $ptotalCut = 0;
                //统一订单双写 S
                //是否有随心配
                if ($it['main_product_id'] > 0 && $it['match_num'] > 0) {
                    $ptotalCut = $it['match_num'] * $it['match_cut'];
                }
                //统一订单双写 E

                // 该商品的多价后，促销前的价格
                // $pPrice = $it['promotion_price'] + $it['promotion_discount'];
                $pPrice = $it['total_price_after'];

                //统一订单双写 S
                @$subOrders[$subOrderKey]['total_pkg_cut'] += 0;
                @$subOrders[$subOrderKey]['total_match_cut'] += $ptotalCut;
                //统一订单双写 E
                self::Log("普通商品【{$it['package_id']}】,该商品的总的减免价格{$ptotalCut},该商品的最终总价格{$pPrice},$it_str");
            }
            else
            {
                // 套餐商品，未经过批价，其总的减免价格
                //$ptotalCut = $it['total_price_discount'] + $it['cash_back'] * $it['buy_count'];
                $ptotalCut = $it['cash_back'] * $it['buy_count'];
                //统一订单双写 S
                if ($it['main_product_id'] > 0 && $it['match_num'] > 0) {
                    $ptotalCut += $it['match_num'] * $it['match_cut'];
                }
                //统一订单双写 E
                //$pPrice = $it['promotion_price'] + $it['promotion_discount'] - $it['cash_back'] * $it['buy_count'];
                //$pPrice = $it['total_price_after'] - $it['cash_back'] * $it['buy_count'];
                $pPrice = $it['total_price_after'] - $ptotalCut;

                //统一订单双写 S
                @$subOrders[$subOrderKey]['total_pkg_cut'] += $it['cash_back'] * $it['buy_count'];
                @$subOrders[$subOrderKey]['total_match_cut'] += $it['match_num'] * $it['match_cut'];
                //统一订单双写 E

                self::Log("套餐商品【{$it['package_id']}】,该商品的总的减免价格{$ptotalCut},该商品的最终总价格{$pPrice},$it_str");
            }


            // 促销优惠以优惠卷的形式记录，分摊到每个子订单
            @$couponInfo['subOrders'][$subOrderKey]['coupon_amt'] += $it['promotion_discount'];
            if($it['promotion_discount'] > 0)
            {
                @$couponInfo['subOrders'][$subOrderKey]['pids'][] = $it['product_id'];
                @$couponInfo['subOrders'][$subOrderKey]['apport'][$it['product_id']] += $it['promotion_discount'];

            }
            // 记录到订单
            @$subOrders[$subOrderKey]['orderPrice'] += $pPrice;
            @$subOrders[$subOrderKey]['totalCut'] += $ptotalCut;

            $t = $orderPrice + $pPrice;
            self::Log("$orderPrice + $pPrice = $t");

            $orderPrice += $pPrice;
            @$totalCut += $ptotalCut;
            if($is_energy_subsidy_order && 0 == $energySaveDiscount)
            {
                $energySaveDiscount = $it['energy_save_discount'];
                $product_base_info[$it['product_id']]['price'] += $energySaveDiscount;
                @$couponInfo['subOrders'][$subOrderKey]['coupon_amt'] = $energySaveDiscount;
                @$couponInfo['subOrders'][$subOrderKey]['pids'][] = $it['product_id'];
                //@$subOrders[$subOrderKey]['totalCut'] = 0;
                //@$subOrders[$subOrderKey]['orderPrice'] += $energySaveDiscount;
            }
            //这里加入批价明细吧，不了没地方加了
            self::setPriceDetail($priceDetails, $it, $wh_id);
        }
        self::Log("分摊后：".ToolUtil::gbJsonEncode($couponInfo));

        /*  mark 前面在设置 $has_service 的时候已经打上了 flag，这里不知道为什么还要再打一次
        if (true === $has_service) //如果包含服务类订单，则将所有的子订单的flag都置为此类订单
        {
            foreach($subOrders as $key => $so)
            {
                $subOrders[$key]['flag'] |= ORDER_HAS_SERVICE;
            }
        }
        */

        if ($newOrder['payType'] == COD) { //货到付款抹去分
            self::Log("货到付款去分之前,$orderPrice");
            $orderPrice = 0;
            self::Log("4,".$orderPrice);
            foreach ($subOrders as $subOrderKey => $so) {
                $subOrders[$subOrderKey]['orderPrice'] = 10 * bcdiv($subOrders[$subOrderKey]['orderPrice'], 10, 0);
                $orderPrice += $subOrders[$subOrderKey]['orderPrice'];
                self::Log("货到付款抹去分,+{$subOrders[$subOrderKey]['orderPrice']}:".$orderPrice);
            }
        }
        //前端提交的价格也是多价后的价格
        if (bccomp($orderPrice, $newOrder['Price'], 0) != 0) {
            self::$errCode = -2031;
            self::$errMsg = "总价：后台计算的订单价格{$orderPrice}与前台提交价格{$newOrder['Price']}不一致";
            return false;
        }
        //前端分单的子单价格
        foreach ($subOrders as $subOrderKey=> $so) {
            if (bccomp($so['orderPrice'], $newOrder['suborders'][$subOrderKey]['price'], 0) != 0) {
                self::$errCode = -2030;
                self::$errMsg = "子订单{$subOrderKey}：后台计算的订单价格{$so['orderPrice']}与前台提交价格{$newOrder['suborders'][$subOrderKey]['price']}不一致";
                return false;
            }
        }

        //节能补贴临时搞搞 Start
        if($is_energy_subsidy_order)
        {
            $couponInfo['amt'] = $energySaveDiscount;
            $couponInfo['code'] = "jieneng";
            $couponInfo['type'] = 1;
            $orderPrice += $energySaveDiscount;
            foreach ($subOrders as $subOrderKey=> $so) {
                @$subOrders[$subOrderKey]['orderPrice'] = $so['orderPrice'] + $energySaveDiscount;
                //@$couponInfo['subOrders'][$subOrderKey]['apport'][$so['product_ids'][0]] = $energySaveDiscount;
            }
        }
        self::Log("orderPrice==>".print_r($subOrders, true));
        //节能补贴临时搞搞 End
        self::Log("计算的订单价格与前台订单价格一致", false);

        $pointMax -= $totalCut;
        $pointMax /= 10;
        $pointMax = ceil($pointMax < $orderPrice ? $pointMax : $orderPrice);
        $pointMax *= 10;
        $pointMin = ceil($pointMin);
        //计算价格结束

        self::Log("检查积分使用情况", false);
        //检查积分使用情况
        if ($newOrder['point'] < $pointMin || $newOrder['point'] > $pointMax) {
            return array('errCode'=> -10, 'errMsg'=> "您本次订单最少需使用" . ($pointMin / 10) . "个积分,最多能使用" . ($pointMax / 10) . "个积分");
        }

        //拉取用户积分，确保用户使用的积分不超过其拥有的积分,并计算分别需要的现金积分和促销积分，优先使用现金积分
        $cash_point_used = 0;
        $promotion_point_used = 0;
        if ($newOrder['point'] > 0 )
        {
            if($newOrder['point'] / 10 < $userInfo['cash_point'] || $newOrder['point'] / 10 == $userInfo['cash_point'])
            {
                $cash_point_used = $newOrder['point'];
            }
            else if($newOrder['point'] / 10 > $userInfo['cash_point'] && (($newOrder['point'] / 10 < ($userInfo['cash_point']+$userInfo['promotion_point']))
                || ($newOrder['point'] / 10 == ($userInfo['cash_point']+$userInfo['promotion_point']))))
            {
                $cash_point_used = ($userInfo['cash_point'] <0) ? 0 : $userInfo['cash_point'] * 10;
                $promotion_point_used = $newOrder['point'] - $cash_point_used;
            }
            else
            {
                return array('errCode'=>-34, 'errMsg'=>"您账户积分总额为{$userInfo['valid_point']}，最多只能使用{$userInfo['valid_point']}个积分");
            }
        }

        // MARK: 根据变量引用关系，移动位置到此处, 并按照新的 $BenfitTypeNew 来计算
        //如果使用了促销规则，采用优惠卷的方式记录到DB中
        /*if (!empty($promotion)) {

            //
            $rule_discount = 0;
            //换购
            if ($promotion['benefit_type'] == IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_HUANGOU'] &&
                isset($product_base_info[$promotion['discount']])){
                $dis = ($product_base_info[$promotion['discount']]['price'] >= $promotion['plus_con'])? ($product_base_info[$promotion['discount']]['price'] - $promotion['plus_con']) : 0;
                $rule_discount = $promotion['benefit_times'] * $promotion['benefit_per_time'] * $dis;
            }
            //赠送商品
            else if ($promotion['benefit_type'] == IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_PRODUCT'] &&
                isset($product_base_info[$promotion['discount']])) {
                $rule_discount = $product_base_info[$promotion['discount']]['price'] * $promotion['benefit_times'] * $promotion['benefit_per_time'];
            }else if ($promotion['benefit_type'] == IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_CASH'])
            {
                $rule_discount = $promotion['benefit_times'] * $promotion['benefit_per_time'];
            }
            else if ($promotion['benefit_type'] == IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_DISCOUNT'])
            {
                $rule_discount = $promotion['discount'];
            }

            switch($promotion['benefit_type'])
            {
                case IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_CASH']:
                    // 立减，记录优惠的总价
                    $rule_discount = $promotion['benefits'];
                    break;
                case IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_COUPON']:
                    // 赠券
                    break;
                default:
                    break;

            }


            $couponInfo['code'] = "rule_{$promotion['rule_id']}";
            $couponInfo['type'] = $promotion['account_type'];
            $couponInfo['amt'] = $rule_discount;
            $couponInfo['subOrders'] = array();
            //将符合促销规则的商品按子订单分组


            foreach ($itemsInShoppingCart as $item) {
                if (isset($item['isPromotionGift']) && $item['isPromotionGift'] === true) {
                    continue;
                }
                if (in_array($item['product_id'], $promotion['pids'])) {
                    $promotionAmt += $product_base_info[$item['product_id']]['price'] * $item['buy_count'];
                    @$couponInfo['subOrders'][$product_base_info[$item['product_id']]['psystock']]['orderAmt'] += $product_base_info[$item['product_id']]['price'] * $item['buy_count'];
                    @$couponInfo['subOrders'][$product_base_info[$item['product_id']]['psystock']]['pids'][] = $item['product_id'];
                }
            }


            //

            self::Log("分摊优惠券金额到各个子单");
            self::Log("分摊前总金额$promotionAmt".ToolUtil::gbJsonEncode($couponInfo));
            //分摊优惠券金额到各个子单
            if ($couponInfo['amt'] == 0) {
                foreach ($couponInfo['subOrders'] as $key=> $so) {
                    $couponInfo['subOrders'][$key]['coupon_amt'] = 0;
                }
            }
            else {
                $lastKey = -1;
                $remain = $couponInfo['amt'];
                ksort($couponInfo['subOrders']);
                foreach ($couponInfo['subOrders'] as $key=> $so) {
                    $tmp = 10 * bcdiv($so['orderAmt'] * $couponInfo['amt'], 10 * $promotionAmt, 0);
                    $couponInfo['subOrders'][$key]['coupon_amt'] = $tmp;
                    $remain -= $tmp;
                    $lastKey = $key;
                }

                if (0 != $remain) {
                    $couponInfo['subOrders'][$lastKey]['coupon_amt'] += $remain;
                }
            }
            self::Log("分摊后".ToolUtil::gbJsonEncode($couponInfo));

        }*/

        //unset($itemsInShoppingCart);

        $product_cash = $orderPrice - $newOrder['point'] - $couponInfo['amt'];
        if ( bccomp( $product_cash, 0, 0 ) < 0 )
        {
            self::$errCode = -2040;
            self::$errMsg = '用户实际需要支付的货款金额为负数';
            self::Log("用户实际需要支付的货款金额为负数[product_cash:{$product_cash}]");
            return false;
        }

        //开始计算运费，调用计算运费接口
        $destination = $newOrder['receiveAddrId'];
        $is_mobile = (!empty($newOrder['ls']) && in_array($newOrder['ls'], self::$AppLS)) ? true : false;
        $price_without_point = $orderPrice - $couponInfo['amt'];
        $user_level = empty($userInfo['level']) ? 0 : $userInfo['level'];

        $shipInfo = array(
            'shipping_id' => $newOrder['shipType'], //配送方式id
            'wh_id'       => $wh_id, //起始站点
            'destination' => $destination, //收获地区
            'order_price' => $price_without_point, //订单需支付的金额(去除优惠券的金额)
            'is_mobile'   => $is_mobile, //是否是手机订单
            'user_level'  => $user_level, //用户等级
        );

        //获取购物车中商品总重量
        foreach ($subOrders as $subOrderKey => $so) {
            $shipInfo['order_info'][$subOrderKey]['weight'] = $so['totalWeight'];
        }

        self::Log("运费");
        //self::Log(var_export($shipInfo,true));
        $shipPriceInfo = EA_ShippingPrice::get($shipInfo);

        //self::Log(var_export($shipPriceInfo,true));
        if (!empty($shipPriceInfo['errCode'])) {
            self::$errCode = $shipPriceInfo['errCode'];
            self::$errMsg = $shipPriceInfo['errMsg'];
            self::Log("EA_ShippingPrice::get false!errCode:" . self::$errCode . ";errMsg:".self::$errMsg);
            return false;
        }

        $orderShipPrice = $shipPriceInfo['shippingPrice'];
        foreach ($subOrders as $subOrderKey => $so)
        {
            if(true === $is_mobile)
            {
                $subOrders[$subOrderKey]['orderShipPrice'] = $newOrder['suborders'][$subOrderKey]['shipPrice'];
            }
            else
            {
                $subOrders[$subOrderKey]['orderShipPrice'] = $shipPriceInfo['subShipPrice'][$subOrderKey]['shippingPrice'];
            }
        }
        //运费计算结束

        if (bccomp($newOrder['shippingPrice'], $orderShipPrice, 0) != 0) {
            self::$errCode = -2038;
            self::$errMsg = 'web传入的运费:' . $newOrder['shippingPrice'] . '后台重新计算的运费:' . $orderShipPrice . '计算的订单运费价格与前台订单运费价格不一致';
            return false;
        }
        //货票分离增加运费,前台过滤掉拆单情况
        if (isset($newOrder['separateInvoice']) && $newOrder['separateInvoice'] == 1) {
            $orderShipPrice += 1000;
            foreach ($subOrders as $subOrderKey => $so) {
                $subOrders[$subOrderKey]['orderShipPrice'] += 1000;
            }
        }
        $cash = $orderShipPrice + $product_cash;
        foreach ($subOrders as $subOrderKey => $so) {
            if ($so['orderShipPrice'] < 0) {
                self::$errCode = -2044;
                self::$errMsg = '订单运费计算失败';
                return false;
            }
            // else if (bccomp($so['orderShipPrice'], $newOrder['suborders'][$subOrderKey]['shipPrice'], 0) != 0) {
            // self::$errCode = -2038;
            // self::$errMsg='web传入的运费:' . $newOrder['suborders'][$subOrderKey]['shipPrice'] . '后台重新计算的运费:' . $so['orderShipPrice'] . '计算的订单运费价格与前台订单运费价格不一致';
            // return false;
            // }
        }

        //运费不从这个接口里面拉
        $shipRet = MShoppingProcess::getDeliveryInfo4Order($items, $inventorys, $wh_id, $destination, $uid, $user_level);
        if(false === $shipRet)
        {
            self::$errCode = IShoppingProcess::$errCode;
            self::$errMsg = IShoppingProcess::$errMsg;
            self::Log("getDeliveryInfo4PlaceOrder false!errCode:" . self::$errCode . ";errMsg:".self::$errMsg);
            return false;
        }
        $shipInfo = $shipRet['shippingType'];
        $packageInfo = $shipRet['packages'];

        $isShipTypeInvalid = true;
        foreach($shipInfo as $key => $ship)
        {
            if($newOrder['shipType'] == $ship['ShippingId'])
            {
                $isShipTypeInvalid = false;
                foreach ($subOrders as $subOrderKey => $so)
                {
                    self::Log("易迅快递，校验送货时间");
                    $timeAvailable = array();
                    if(ICSON_DELIVERY == $newOrder['shipType'])
                    {
                        $timeAvailable = $ship['subOrder'][$subOrderKey]['timeAvaiable'];
                        $icson_delivery_info['expect_ship_date'] = $newOrder['suborders'][$subOrderKey]['expectDate']; // 期望日期
                        $icson_delivery_info['expect_time_span'] = $newOrder['suborders'][$subOrderKey]['expectSpan']; // 期望时间
                        $ret = self::verifyExpectDateSpan($icson_delivery_info, $timeAvailable, $destination);
                        if(false === $ret)
                        {
                            $tmpErrMsg = self::$errMsg;
                            self::$errCode = self::$errCode;
                            self::$errMsg = basename(__FILE__) . "，验证配送时间错误，" . self::$errMsg . ",subOrderItem" . var_export($subOrderItem, true);
                            return array('errCode' => self::$errCode, "errMsg" => $tmpErrMsg);
                        }
                    }
                }
                break;
            }
        }
        if($isShipTypeInvalid)
        {
            return array('errCode'=> -17, 'errMsg'=> "购物车中有商品不支持您选择的运送方式");
        }
        foreach($packageInfo as $subKey=>$package)
        {
            $subOrders[$subKey]['seller_id'] = $package['seller_id'];
            $subOrders[$subKey]['sale_mode'] = $package['sale_mode'];
            $subOrders[$subKey]['seller_address_id'] = $package['seller_stock_id'];
        }

        //开始分摊优惠券&
        self::Log("开始分摊优惠券积分");
        if ($newOrder['point'] > 0) {
            ksort($subOrders);
        }
        //分摊优惠券到商品
        if ($couponInfo['amt'] > 0) {
            foreach ($subOrders as $subOrderKey => $so) {
                $subOrders[$subOrderKey]['couponamt'] = $couponInfo['subOrders'][$subOrderKey]['coupon_amt'];
            }
            if(empty($promotion))
            {
                $lastPid = 0;
                foreach ($couponInfo['subOrders'] as $subKey=> $so) {
                    $remain = $so['coupon_amt'];
                    foreach ($so['pids'] as $pid) {
                        @$couponInfo['subOrders'][$subKey]['apport'][$pid] = 10 * bcdiv($so['coupon_amt'] * $shoppingProduct[$subKey][$pid]['total_price'], 10 * $so['orderAmt'], 0);
                        $remain -= $couponInfo['subOrders'][$subKey]['apport'][$pid];
                        $lastPid = $pid;
                    }

                    if ($remain > 0 && $lastPid != 0 ) {
                        $couponInfo['subOrders'][$subKey]['apport'][$lastPid] += $remain;
                    }
                }
            }
        }


        //分摊积分
        $temp_cash_point = $cash_point_used;
        $i = 1;
        $order_num = 0;
        if ($newOrder['point'] > 0) {
            $remain = $newOrder['point'];
            foreach ($subOrders as $subOrderKey => $so) {
                $tmp = 10 * bcdiv($so['orderPrice'] * $newOrder['point'], $orderPrice * 10, 0);
                $subOrders[$subOrderKey]['point'] = $tmp;
                $remain -= $tmp;
            }
            //继续分摊不能整除剩下的部分
            reset($subOrders);
            while (FALSE != ($so = current($subOrders)) && $remain > 0) {
                $subOrderKey = key($subOrders);
                next($subOrders);
                $tmp = $so['orderPrice'] - $so['couponamt'] - $so['point'];
                if ($tmp > 0) {
                    $subOrders[$subOrderKey]['point'] += ($tmp < $remain ? $tmp : $remain);
                    $remain -= ($tmp < $remain ? $tmp : $remain);
                }
            }

            //分摊现金积分和促销积分
            $order_num = count($subOrders);
            foreach ($subOrders as $subOrderKey => $so)
            {
                if($i != $order_num)
                {
                    $subOrders[$subOrderKey]['cash_point'] = 10 * bcdiv($cash_point_used * $subOrders[$subOrderKey]['point'] / 10, $newOrder['point'], 0);
                    $subOrders[$subOrderKey]['promotion_point'] = $subOrders[$subOrderKey]['point'] - $subOrders[$subOrderKey]['cash_point'];
                    $temp_cash_point -= $subOrders[$subOrderKey]['cash_point'];
                }
                else
                {
                    $subOrders[$subOrderKey]['cash_point'] = $temp_cash_point;
                    $subOrders[$subOrderKey]['promotion_point'] = $subOrders[$subOrderKey]['point'] - $subOrders[$subOrderKey]['cash_point'];
                }
                $i++;
            }
        }

        // $limitOrder = IShippingTime::getOrderLimitState($wh_id);
        //如果可以采用易迅快递，校验送货时间
        /* handywu
		if (ICSON_DELIVERY == $newOrder['shipType']) {
			self::Log("易迅快递，校验送货时间");

			$icson_delivery_info = IShipping::getIcsonDeliveryInfoByRegion($newOrder['receiveAddrId'], $wh_id);

			if (false === $icson_delivery_info) {
				self::$errCode = IShipping::$errCode;
				self::$errMsg = IShipping::$errMsg;
				return false;
			}

			foreach ($shoppingProduct as $subOrderKey=> $subOrderItem) {
				//self::Log(ToolUtil::gbJsonEncode($subOrderItem));

				$icson_delivery_info['stock_num'] = $subOrderKey; // 发货仓号
				$icson_delivery_info['expect_ship_date'] = $newOrder['suborders'][$subOrderKey]['expectDate']; // 期望日期
				$icson_delivery_info['expect_time_span'] = $newOrder['suborders'][$subOrderKey]['expectSpan']; // 期望时间

				// 手机端的请求，isVirtual采用 true false 的方式
				if(isset($newOrder['ls']) && in_array($newOrder['ls'],self::$AppLS) && ("--mobile--" != $newOrder['ls']) && empty($newOrder['appnewapi']))
				{
					$v = isset($bVirtual[$subOrderKey]) ? $bVirtual[$subOrderKey] : false;
				}
				else
				{
					$v = isset($isVirtual[$subOrderKey]) ? $isVirtual[$subOrderKey] : false;
				}

				$ret = IShippingTime::verifyExpectDateSpan($icson_delivery_info, $wh_id, $destination, $v);
				if (false === $ret) {
					self::$errCode = IShippingTime::$errCode;
					self::$errMsg = basename(__FILE__) . "，验证配送时间错误，" . IShippingTime::$errMsg . ",subOrderItem" . var_export($subOrderItem, true);
					return array('errCode' => IShippingTime::$errCode, "errMsg" => IShippingTime::$errMsg);
				}
			}
		}
        */

        //开始下单，先起事务， 插入orderdb， 扣 mssql 库存， commit事务or callback事务
        //获取新订单号
        self::Log("获取新订单号");
        $orderNum = count($subOrders);
        if ($orderNum > 1) {
            $newOrderId = IIdGenerator::getNewId('so_sequence', $orderNum + 1);
        }
        else {
            $newOrderId = IIdGenerator::getNewId('so_sequence', $orderNum);
        }
        if (false === $newOrderId || $newOrderId <= 0) {
            self::$errCode = IIdGenerator::$errCode;
            self::$errMsg = IIdGenerator::$errMsg;
            self::Log("IIdGenerator newOrderId 获取ID错误 errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
            return false;
        }

        $orderstrforlog = '';
        $cc = ($orderNum > 1) ? $orderNum + 1 : $orderNum;
        for ($i = ($orderNum > 1 ? 1 : 0); $i < $cc; $i++) {
            $orderstrforlog .= "," . ($newOrderId + $i);
        }

        $parentOrderId = sprintf("%s%09d", "1", $newOrderId % 1000000000);
        $parentOrderInInt = $newOrderId;
        //获取订单发票id
        $invoice_id = IIdGenerator::getNewId('so_valueadded_invoice_sequence', $orderNum);
        if (false === $invoice_id) {
            self::$errCode = IIdGenerator::$errCode;
            self::$errMsg = IIdGenerator::$errMsg;
            self::Log("IIdGenerator invoice_id 获取ID错误 errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
            return false;
        }

        //获取随心配id
        // 插入随心配表
        $match_id_start = 0;
        $needCount = 0;
        $itemCount = 0;
        foreach ($shoppingProduct as $key => $subOrderItem) {
            foreach ($subOrderItem as $sp) {
                $itemCount++;
                if ($sp['type'] != SHOPPING_CART_PRODUCT_TYPE_NORMAL || $sp['main_product_id'] == 0) {
                    continue;
                }
                $needCount++;
            }
        }
        if ($needCount > 0) {
            $match_id_start = IIdGenerator::getNewId('SO_SaleRule_Sequence', $needCount);
            if (false === $match_id_start) {
                self::$errCode = -2036;
                self::$errMsg = '获取订单随心配seq失败' . IIdGenerator::$errMsg;
                self::Log("IIdGenerator match_id_start 获取ID错误 errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
                return false;
            }
        }
        //获取订单商品的seqid
        $itemStartID = IIdGenerator::getNewId('So_Item_Sequence', $itemCount);
        if (false === $itemStartID) {
            self::$errCode = -2047;
            self::$errMsg = '获取订单商品id失败' . IIdGenerator::$errMsg;
            self::Log("IIdGenerator itemStartID 获取ID错误 errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
            return false;
        }

        //处理单引号等特殊字符
        foreach ($newOrder as $k => $no) {
            if ($k == 'suborders' || $k == 'buy_one_key' || $k == 'send_coupon_success_info' || $k == 'send_coupon_record_info') {
                continue;
            }
            $newOrder[$k] = addslashes($no);
        }

        if ( self::NO_INVOICE == $newOrder['isVat'] ) //如果不需要开发票，那么其他字段也置为空
        {
            $newOrder['invoiceType'] = '';
            $newOrder['invoiceTitle'] = '';
            $newOrder['invoiceContent'] = '';
        }

        if ($newOrder['invoiceType'] != INVOICE_TYPE_VAT)
        {
            $newOrder['invoiceCompanyName'] = '';
            $newOrder['invoiceCompanyAddr'] = '';
            $newOrder['invoiceCompanyTel'] = '';
            $newOrder['invoiceTaxno'] = '';
            $newOrder['invoiceBankNo'] = '';
            $newOrder['invoiceBankName'] = '';
        }
        else
        {
            $newOrder['invoiceTitle'] = $newOrder['invoiceCompanyName'];
        }

        //	$newOrderId = sprintf("%s%09d", "1", $newId % 1000000000);
        if (!isset($orderDb)) {
            $orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
            if (empty($orderDb)) {
                self::$errCode = ToolUtil::$errCode;
                self::$errMsg = ToolUtil::$errMsg;
                self::Log("orderDb 连接错误！ errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
                return false;
            }
        }

        self::Log("开启orderdb事务失败");
        $sql = "begin transaction";
        $ret = $orderDb->execSql($sql);
        if (false === $ret) {
            self::$errCode = -2032 . " " . $orderDb->errCode;
            self::$errMsg = '开启orderdb事务失败' . $orderDb->errMsg;
            self::Log("orderDb 开启orderdb事务失败！ errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
            return false;
        }

        $uniorder_parentOrder = array();
        $activeInfoList = array();

        //库存双写 S sheldonshi
        $inventorysAllData = array();
        //库存双写 E sheldonshi
        //如果发生了拆单，插入父订单
        $now = time();
        if ($orderNum > 1) {
            self::Log("发生了拆单，插入父订单");

            $isPayed = ($cash <= 0 ? 1 : 0);
            $newItem = array(
                'order_char_id'       => $parentOrderId,
                'order_id'            => $newOrderId,
                'status'              => 0,
                'flag'                => 0,
                'uid'                 => $uid,
                'hw_id'               => $wh_id,
                'order_date'          => $now,
                'source'              => 0,
                'type'                => 0,
                'shipping_cost'       => $orderShipPrice,
                'premium_cost'        => 0,
                'shipping_type'       => $newOrder['shipType'],
                'pay_time'            => 0,
                'pay_type'            => $newOrder['payType'],
                'prcd_cost'           => 0, //手续费
                'order_cost'          => $orderShipPrice + $orderPrice + $totalCut, //运费+商品总价+（随心配）
                'price_cut'           => $totalCut,
                'coupon_type'         => $couponInfo['type'],
                'coupon_code'         => $couponInfo['code'],
                'coupon_amt'          => $couponInfo['amt'],
                'point'               => 0,
                'point_pay'           => $newOrder['point'],
                'promotion_point'     => $promotion_point_used,
                'cash_point'          => $cash_point_used,
                'cash'                => $cash,
                'receiver'            => $newOrder['receiver'],
                'receiver_tel'        => $newOrder['receiverTel'],
                'receiver_mobile'     => $newOrder['receiverMobile'],
                'receiver_zip'        => $newOrder['zipCode'],
                'receiver_addr_id'    => $newOrder['receiveAddrId'],
                'receiver_addr'       => $newOrder['receiveAddrDetail'],
                'expect_dly_date'     => 0,
                'expect_dly_time_span'=> 0,
                'deliveryMemo'        => '',
                'comment'             => $newOrder['comment'],
                'update_time'         => $now,
                'isPayed'             => $isPayed,
                'out_time'            => 0,
                'sign_by_other'       => $newOrder['sign_by_other'],
                'ls'                  => isset($newOrder['ls']) ? $newOrder['ls'] : '',
                'cpsinfo'             => isset($newOrder['cpsinfo']) ? $newOrder['cpsinfo'] : '',
                'synFlag'             => 0, //父订单不同步给ERP
                'visitkey'            => $newOrder['visitkey'],
                'pOrderId'            => $parentOrderId,
                'subOrderNum'         => $orderNum,
                'stockNo'             => 0,
                'shop_guide_id'       => isset($newOrder['shopGuideId']) ? $newOrder['shopGuideId'] : 0,
                'shop_guide_name'     => isset($newOrder['shopGuideName']) ? $newOrder['shopGuideName'] : '',
                'shop_guide_cost'     => isset($newOrder['shopPrice']) ? $newOrder['shopPrice'] : 0,
                'shop_id'             => isset($newOrder['shopId']) ? $newOrder['shopId'] : 0,
                'is_vat'              => $newOrder['isVat'],
            );

            $uniorder_parentOrder = $newItem;
            $ret = $orderDb->insert("t_orders_{$db_tab_index['table']}", $newItem);
            if (false === $ret) {
                self::$errCode = -2033;
                self::$errMsg = '执行sql语句失败' . $orderDb->errMsg;
                $sql = "rollback";
                $orderDb->execSql($sql);
                self::Log("orderDb 执行sql语句失败！ errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
                return false;
            }


            $newOrderId++;
        }

        // 父订单数据
        $ORS_Report_Data = array(
            'products' => array(),
            'areaSysNo' => $destination,
            'shiptype' => $newOrder['shipType'],
            'parentorderid' => $parentOrderId,
            'childorderid' => array(),
        );
        $orderToSZ = array(
            'oid' => $parentOrderId,
            'status' => 0,
            'cash' => $cash,
            'uid' => $uid,
            'qq' => '', //(此处置空)
            'whid' => $wh_id,
            'ordertime' => $now,
            'vk' => $newOrder['visitkey'], //visit key
            'ip' => '', //稍后补偿
            'recv_province' => '', //收货省份
            'recv_city' => '', //收货城市
            'recv_region' => $newOrder['receiveAddrId'], //收货地区
            'raddr' => $newOrder['receiveAddrDetail'], //收货地址
            'rname' => $newOrder['receiver'], //收货人姓名
            'rphone' => $newOrder['receiverMobile'], //收货人电话
            'point' => $newOrder['point'], //使用的积分
            'osrc' => isset($newOrder['ls']) ? $newOrder['ls'] : '', //订单来源
            'payid' => $newOrder['payType'], //支付方式ID
            'payname' => '', //支付方式
            'coutype' => $couponInfo['type'], //优惠类型
            'couamt' => $couponInfo['amt'], //优惠金额
            'shipid' => $newOrder['shipType'], //配送方式ID
            'shipname' => isset($_LGT_MODE[ $newOrder['shipType'] ]) ? $_LGT_MODE[ $newOrder['shipType'] ]['ShipTypeName'] : '', //配送方式名称
            'invoice' => $newOrder['invoiceTitle'], //发票抬头
        ); //TAPD 5478549 数据上报 (订单基本信息)

        //扣减库存 & 生成虚库表
        $sql = "begin transaction";
        $ret = $msSQL->execSql($sql);
        if (false === $ret) {
            self::$errCode = -2035;
            self::$errMsg = '开启ms sql事务失败' . $msSQL->errMsg;
            $sql = "rollback";
            $orderDb->execSql($sql);
            self::Log("msSQL 执行sql语句失败！ errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
            return false;
        }

        $timeNow = date('Y-m-d H:i:s', $now);

        //记录符合单品赠券的商品的信息
        $orders_items_array = array();
        $products_rules = array();
        if(isset($newOrder['send_coupon_success_info'])&& !empty($newOrder['send_coupon_success_info']))
        {
            foreach($newOrder['send_coupon_success_info'] as $key => $rules)
            {
                $products_rules[$key] = $rules;
            }
        }

        global $_StockToStation;
        Logger::info("shoppingProduct ==>" . ToolUtil::gbJsonEncode($shoppingProduct));

        $uniorder_orderList = array();
        $uniorder_tradeList = array();
        foreach ($shoppingProduct as $subOrderKey => $subOrder) {
            $cash = $subOrders[$subOrderKey]['orderPrice']
                + $subOrders[$subOrderKey]['orderShipPrice']
                - (isset($subOrders[$subOrderKey]['couponamt']) ? $subOrders[$subOrderKey]['couponamt'] : 0)
                - (isset($subOrders[$subOrderKey]['point']) ? $subOrders[$subOrderKey]['point'] : 0);
            $isPayed = ($cash <= 0 ? 1 : 0);

            $subOrders[$subOrderKey]['orderId'] = $newOrderId; //clark记录订单ID

            $oid = sprintf("%s%09d", "1", $newOrderId % 1000000000);

            //计算每个订单中使用的单品促销的规则以及次数
            $single_promotion_info = '';

            foreach ($subOrder as $sp)
            {
                if(isset($products_rules[$sp['product_id']]) && !empty($products_rules[$sp['product_id']]))
                {
                    //开始组装$single_promotion_info的值
                    $rule_info = $products_rules[$sp['product_id']];
                    foreach($rule_info['coupons_name'] as $name)
                    {
                        $single_promotion_info = $single_promotion_info . $name . " x " . $rule_info['count'] . "张;";
                    }
                    //self::Log(var_export($single_promotion_info,true));
                }
            }
            //货票分离
            $bits = 0;
            if ($newOrder['separateInvoice'] == 1) {
                self::Log("货票分离");
                $bits = $bits | ORDER_SEPARATE_GOODS_INVOICE;
                $newInvAddr = array(
                    'order_char_id'    => $oid,
                    'order_id'         => $newOrderId,
                    'uid'              => $uid,
                    'receiver'         => $newOrder['invoiceReceiver'],
                    'receiver_tel'     => $newOrder['invoiceReceiverTel'],
                    'receiver_mobile'  => $newOrder['invoiceReceiverMobile'],
                    'receiver_zip'     => $newOrder['invoicezipCode'],
                    'receiver_addr_id' => $newOrder['invoiceReceiveAddrId'],
                    'receiver_addr'    => $newOrder['invoiceReceiveAddrDetail'],
                    'shipping_type'    => YT_DELIVERY, //目前只支持圆通
                    'shipping_cost'    => 1000, //分为单位
                    'order_date'       => $now,
                    'wh_id'            => $wh_id,
                    //handywu 'stockNo'          => $subOrderKey,
                    'stockNo'          => $packages[$subOrderKey]['psystock'],
                );
                $ret = $orderDb->insert("t_order_invoice_address_{$db_tab_index['table']}", $newInvAddr);
                if (false === $ret) {
                    self::$errCode = -2050;
                    self::$errMsg = '执行sql语句失败' . $orderDb->errMsg;
                    $sql = "rollback";
                    $msSQL->execSql($sql);
                    $orderDb->execSql($sql);
                    self::Log("orderDb 执行sql语句失败！ errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
                    return false;
                }
            }

            $newItem = array(
                'order_char_id'         => $oid,
                'order_id'              => $newOrderId,
                'status'                => 0,
                'flag'                  => isset($subOrders[$subOrderKey]['flag']) ? $subOrders[$subOrderKey]['flag'] : 0,
                'uid'                   => $uid,
                'hw_id'                 => $wh_id,
                'order_date'            => $now,
                'source'                => 0,
                'type'                  => 0,
                'shipping_cost'         => $subOrders[$subOrderKey]['orderShipPrice'],
                'premium_cost'          => 0,
                'shipping_type'         => $newOrder['shipType'],
                'pay_time'              => 0,
                'pay_type'              => $newOrder['payType'],
                'prcd_cost'             => 0, //手续费
                'order_cost'            => $subOrders[$subOrderKey]['orderPrice'] + $subOrders[$subOrderKey]['orderShipPrice'] + (isset($subOrders[$subOrderKey]['totalCut']) ? $subOrders[$subOrderKey]['totalCut'] : 0), //运费+商品总价+（随心配）
                'price_cut'             => isset($subOrders[$subOrderKey]['totalCut']) ? $subOrders[$subOrderKey]['totalCut'] : 0,
                'coupon_type'           => $couponInfo['type'],
                'coupon_code'           => $couponInfo['code'],
                'coupon_amt'            => isset($subOrders[$subOrderKey]['couponamt']) ? $subOrders[$subOrderKey]['couponamt'] : 0,
                'point'                 => 0,
                'point_pay'             => isset($subOrders[$subOrderKey]['point']) ? $subOrders[$subOrderKey]['point'] : 0,
                'cash_point'            => isset($subOrders[$subOrderKey]['cash_point']) ? $subOrders[$subOrderKey]['cash_point'] : 0,
                'promotion_point'       => isset($subOrders[$subOrderKey]['promotion_point']) ? $subOrders[$subOrderKey]['promotion_point'] : 0,
                'cash'                  => $cash,
                'receiver'              => $newOrder['receiver'],
                'receiver_tel'          => $newOrder['receiverTel'],
                'receiver_mobile'       => $newOrder['receiverMobile'],
                'receiver_zip'          => $newOrder['zipCode'],
                'receiver_addr_id'      => $newOrder['receiveAddrId'],
                'receiver_addr'         => $newOrder['receiveAddrDetail'],
                'expect_dly_date'       => strtotime($newOrder['suborders'][$subOrderKey]['expectDate']),
                'expect_dly_time_span'  => $newOrder['suborders'][$subOrderKey]['expectSpan'],
                'deliveryMemo'          => isset($newOrder['suborders'][$subOrderKey]['arrived_limit_time']) ? $newOrder['suborders'][$subOrderKey]['arrived_limit_time'] : '',
                'comment'               => $newOrder['comment'],
                'update_time'           => $now,
                'isPayed'               => $isPayed,
                'out_time'              => 0,
                'sign_by_other'         => $newOrder['sign_by_other'],
                'ls'                    => isset($newOrder['ls']) ? $newOrder['ls'] : '',
                'cpsinfo'               => isset($newOrder['cpsinfo']) ? $newOrder['cpsinfo'] : '',
                'synFlag'               => 1,
                'visitkey'              => isset($newOrder['visitkey']) ? $newOrder['visitkey'] : '',
                'pOrderId'              => $parentOrderId,
                'subOrderNum'           => 0,
                //handywu 'stockNo'               => $subOrderKey,
                'stockNo'               => $packages[$subOrderKey]['psystock'],
                'shop_guide_id'         => isset($newOrder['shopGuideId']) ? $newOrder['shopGuideId'] : 0,
                'shop_guide_name'       => isset($newOrder['shopGuideName']) ? $newOrder['shopGuideName'] : '',
                'shop_guide_cost'       => isset($newOrder['suborders'][$subOrderKey]['shopPrice']) ? $newOrder['suborders'][$subOrderKey]['shopPrice'] : 0,
                'shop_id'               => isset($newOrder['shopId']) ? $newOrder['shopId'] : 0,
                'customer_ip'           => ToolUtil::getClientIP(),
                'is_vat'                => $newOrder['isVat'],
                'single_promotion_info' => $single_promotion_info,
                'bits'                  => $bits,
                'seller_id'             => isset($subOrders[$subOrderKey]['seller_id']) ? $subOrders[$subOrderKey]['seller_id'] : 0,
                'sale_model'             => isset($subOrders[$subOrderKey]['sale_mode']) ? $subOrders[$subOrderKey]['sale_mode'] : 1,
                'seller_address_id'     => isset($subOrders[$subOrderKey]['seller_address_id']) ? $subOrders[$subOrderKey]['seller_address_id'] : 0,
            );

            //统一订单灰度 S
            $uniNewItem = $newItem;
            $uniNewItem['cod_adjust_price'] = isset($subOrders[$subOrderKey]['cod_adjust_price']) ? $subOrders[$subOrderKey]['cod_adjust_price'] : 0;
            $uniorder_orderList[] = $uniNewItem;
            $uniorder_tradeList[$newItem['order_char_id']] = array();

            if (strncmp('rule_', $couponInfo['code'], 5) == 0)
            {
                //促销规则
                $activeInfoList[$oid][] = array(
                    "activeNo" => $promotion['rule_id'],
                    "activeType" => 2,
                    "activeRuleId" => $promotion['rule_id'],
                    "activeDesc" => $promotion['desc'],
                    "favorFee" => isset($subOrders[$subOrderKey]['couponamt']) ? $subOrders[$subOrderKey]['couponamt'] : 0,
                    "activeParam1" => $promotion['benefit_type'],
                    "activeParam2" => $promotion['rule_type'],
                    "activeParam3" => $promotion['stage_price_type'],
                    "activeParam4" => $promotion['benefit_times'],
                    "activeParam5" => 0,
                    "activeParam6" => $promotion['account_type'],
                    "activeParam7" => 0,
                    "activeParam8" => "",
                );

            }
            else if(strncmp('jieneng', $couponInfo['code'], 7) == 0)
            {
                //节能补贴
                $activeInfoList[$oid][] = array(
                    "activeNo" => "",
                    "activeType" => 3,
                    "activeRuleId" => "",
                    "activeDesc" => "参加节能补贴",
                    "favorFee" => $couponInfo['amt'],
                    "activeParam1" => $newOrder['es_type'],
                    "activeParam2" => 0,
                    "activeParam3" => 0,
                    "activeParam4" => 0,
                    "activeParam5" => 0,
                    "activeParam6" => $couponInfo['type'],
                    "activeParam7" => 0,
                    "activeParam8" => isset($couponInfo['energy_save_name']) ? $couponInfo['energy_save_name'] : "",
                );
            }
            else if($couponInfo['code'] != NULL && $couponInfo['code'] != '')
            {
                //优惠券
                $activeInfoList[$oid][] = array(
                    "activeNo" => isset($couponInfo['coupon_id']) ? $couponInfo['coupon_id'] : 0,
                    "activeType" => 5,
                    "activeRuleId" => isset($couponInfo['coupon_id']) ? $couponInfo['coupon_id'] : 0,
                    "activeDesc" => $couponInfo['coupon_name'],
                    "favorFee" => isset($subOrders[$subOrderKey]['couponamt']) ? $subOrders[$subOrderKey]['couponamt'] : 0,
                    "activeParam1" => $couponInfo['type'],
                    "activeParam2" => 1,
                    "activeParam3" => 0,
                    "activeParam4" => 0,
                    "activeParam5" => 0,
                    "activeParam6" => $couponInfo['type'],
                    "activeParam7" => isset($couponInfo['code']) ? $couponInfo['code'] : "",
                    "activeParam8" => isset($couponInfo['coupon_name']) ? $couponInfo['coupon_name'] : "",
                );
            }
            if($single_promotion_info != '')
            {
                //单品赠券
                $activeInfoList[$oid][] = array(
                    "activeNo" => "",
                    "activeType" => 6,
                    "activeRuleId" => "",
                    "activeDesc" => "",
                    "favorFee" => 0,
                    "activeParam1" => 0,
                    "activeParam2" => 0,
                    "activeParam3" => 0,
                    "activeParam4" => 0,
                    "activeParam5" => 0,
                    "activeParam6" => 0,
                    "activeParam7" => $single_promotion_info,
                    "activeParam8" => 0,
                );
            }
            if(isset($subOrders[$subOrderKey]['total_pkg_cut']) && $subOrders[$subOrderKey]['total_pkg_cut'] > 0)
            {
                //套餐
                $activeInfoList[$oid][] = array(
                    "activeNo" => "",
                    "activeType" => 4,
                    "activeRuleId" => "",
                    "activeDesc" => "",
                    "favorFee" => $subOrders[$subOrderKey]['total_pkg_cut'],
                    "activeParam1" => 0,
                    "activeParam2" => 0,
                    "activeParam3" => 0,
                    "activeParam4" => 0,
                    "activeParam5" => 0,
                    "activeParam6" => 0,
                    "activeParam7" => 0,
                    "activeParam8" => 0,
                );
            }
            if(isset($subOrders[$subOrderKey]['total_match_cut']) && $subOrders[$subOrderKey]['total_match_cut'] > 0)
            {
                //随心配
                $activeInfoList[$oid][] = array(
                    "activeNo" => "",
                    "activeType" => 8,
                    "activeRuleId" => "",
                    "activeDesc" => "",
                    "favorFee" => $subOrders[$subOrderKey]['total_match_cut'],
                    "activeParam1" => 0,
                    "activeParam2" => 0,
                    "activeParam3" => 0,
                    "activeParam4" => 0,
                    "activeParam5" => 0,
                    "activeParam6" => 0,
                    "activeParam7" => 0,
                    "activeParam8" => 0,
                );
            }
            //统一订单灰度 E

            self::Log("插入订单主表");
            $ret = $orderDb->insert("t_orders_{$db_tab_index['table']}", $newItem);
            if (false === $ret) {
                self::$errCode = -2033;
                self::$errMsg = '执行sql语句失败' . $orderDb->errMsg;
                $sql = "rollback";
                $msSQL->execSql($sql);
                $orderDb->execSql($sql);
                self::Log("orderDb 执行sql语句失败！ errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
                return false;
            }

            // 子订单数据，以订单号作为key
            $ORS_Report_Data['childorderid'][$oid] = array(
                'products' => array(),
                'order_char_id' => $oid,
                //handywu 'stock' => $subOrderKey,
                'stock' => $packages[$subOrderKey]['psystock'],
            );

            $newInv = array(
                'user_invoice_id'=> $newOrder['invoiceId'],
                'order_char_id'  => $oid,
                'uid'            => $uid,
                'type'           => $newOrder['invoiceType'],
                'title'          => $newOrder['invoiceTitle'],
                'name'           => $newOrder['invoiceCompanyName'],
                'addr'           => $newOrder['invoiceCompanyAddr'],
                'phone'          => $newOrder['invoiceCompanyTel'],
                'taxno'          => $newOrder['invoiceTaxno'],
                'bankno'         => $newOrder['invoiceBankNo'],
                'bankname'       => $newOrder['invoiceBankName'],
                'content'        => $newOrder['invoiceContent'],
                'updatetime'     => $now,
                'wh_id'          => $wh_id,
                'auto_id'        => $invoice_id++,
            );

            self::Log("插入发票表");
            $ret = $orderDb->insert("t_order_invoice_{$db_tab_index['table']}", $newInv);
            if (false === $ret) {
                self::$errCode = -2050;
                self::$errMsg = '执行sql语句失败' . $orderDb->errMsg;
                $sql = "rollback";
                $msSQL->execSql($sql);
                $orderDb->execSql($sql);
                self::Log("orderDb 执行sql语句失败！ errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
                return false;
            }

            $_local_ip = ToolUtil::getLocalIp(0);
            $_local_ip = explode('.', $_local_ip);
            $_inserter = empty($_local_ip[3]) ? 7 : intval($_local_ip[3]);
            $strSubOrder = ToolUtil::gbJsonEncode($subOrder);
            Logger::info("===================[subOrder:{$strSubOrder}]");
            foreach ($subOrder as $sp) {

                /* MARK 随心配功能下线，写表操作去除
                //插入随心配表
                self::Log("插入随心配表");
                if ($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL && $sp['main_product_id'] != 0) {
                    $sql = "insert into t_order_match_{$db_tab_index['table']} values($match_id_start, '{$newOrderId}', {$sp['product_id']}, {$sp['main_product_id']},{$sp['matchNum']}, {$sp['cashCutPerItem']}, $now, $wh_id )";
                    $ret = $orderDb->execSql($sql);
                    if (false === $ret) {
                        self::$errCode = -2036;
                        self::$errMsg = '执行sql语句失败' . $orderDb->errMsg;
                        $sql = "rollback";
                        $msSQL->execSql($sql);
                        $orderDb->execSql($sql);
                        return false;
                    }
                    ++$match_id_start;
                }*/

                $buy_count_positive = $sp['buy_count'];
                $buy_count_negative = $sp['buy_count'] * (-1);
                foreach ($productStocks as $pstock) {
                    /*  handywu
					if ($subOrderKey != $pstock['StockSysNo']) {
						continue;
					}*/
                    if ($packages[$subOrderKey]['psystock'] != $pstock['StockSysNo']) {
                        continue;
                    }
                    $subKey = $pstock['StockSysNo'];
                    if ($sp['product_id'] == $pstock['ProductSysNo']) {
                        if ($pstock['AvailableQty'] + $pstock['VirtualQty'] >= $sp['buy_count']) { //可用大于购买数量
                            $sql = "update Inventory_stock set AvailableQty = AvailableQty - {$sp['buy_count']}, OrderQty = OrderQty + {$sp['buy_count']}, rowModifydate='{$timeNow}' where AvailableQty+VirtualQty>={$sp['buy_count']} AND ProductSysNo={$sp['product_id']} and StockSysNo=$subKey";
                            $ret = $msSQL->execSql($sql);
                            $cnt = $msSQL->getAffectedRows();
                            if ((false === $ret) || (1 != $cnt)) {
                                self::$errCode = -2047;
                                self::$errMsg = "扣减ms sql库存失败({$sp['product_id'] })" . $msSQL->errMsg;
                                $sql = "rollback";
                                $msSQL->execSql($sql);
                                $orderDb->execSql($sql);
                                self::Log("扣减ms sql库存失败！[cnt:{$cnt}] errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
                                return false;
                            }

                            //ixiuzeng添加，将Inventroy_Stock的库存修改记录插入到Inventory_Flow表中
                            /* handywu
							$sql = "insert into Inventory_Flow values
									($subOrderKey, {$sp['product_id']}, 1, $newOrderId, 2, $buy_count_negative,'$timeNow', '$timeNow',$_inserter),
									($subOrderKey, {$sp['product_id']}, 1, $newOrderId, 4, $buy_count_positive,'$timeNow', '$timeNow',$_inserter)";
                            */
                            $sql = "insert into Inventory_Flow values
									($subKey, {$sp['product_id']}, 1, $newOrderId, 2, $buy_count_negative,'$timeNow', '$timeNow',$_inserter),
									($subKey, {$sp['product_id']}, 1, $newOrderId, 4, $buy_count_positive,'$timeNow', '$timeNow',$_inserter)";
                            $ret = $msSQL->execSql($sql);
                            $cnt = $msSQL->getAffectedRows();
                            if ((false === $ret) || (2 != $cnt)) {
                                self::$errCode = -2046;
                                self::$errMsg = "插入ms sql-Inventory_Flow表失败({$sp['product_id'] })" . $msSQL->errMsg;
                                $sql = "rollback";
                                $msSQL->execSql($sql);
                                $orderDb->execSql($sql);
                                self::Log("插入ms sql-Inventory_Flow表失败！[cnt:{$cnt}] errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
                                return false;
                            }
                            //库存双写 S sheldonshi
                            $inventoryData = array(
                                'product_id' => $sp['product_id'],
                                'sys_stock' => $subKey,
                                'order_id' => $newOrderId,
                                'order_creat_time' => $now,
                                'buy_count' => $sp['buy_count'],
                                'order_type' => $product_base_info[$sp['product_id']]['sale_model'] == 0 ? 1 : $product_base_info[$sp['product_id']]['sale_model'],
                            );
                            $inventorysAllData[] = $inventoryData;
                            //库存双写 E sheldonshi

                        }
                        else if(($wh_id == 1) && (($product_base_info[$sp['product_id']]['flag'] & FORBID_SET_VIRTUAL) != FORBID_SET_VIRTUAL) &&
                            //($product_base_info[$sp['product_id']]['type'] == PRODUCT_TYPE_NORMAL) && $_StockToStation[$subOrderKey] == $wh_id) {  //上海站普通正常商品允许建虚库
                            ($product_base_info[$sp['product_id']]['type'] == PRODUCT_TYPE_NORMAL) && $_StockToStation[$subKey] == $wh_id) {  //上海站普通正常商品允许建虚库
                            $sql = "update Inventory_stock set AvailableQty = AvailableQty - {$sp['buy_count']}, VirtualQty=VirtualQty + {$sp['buy_count']}, OrderQty = OrderQty + {$sp['buy_count']} , rowModifydate='{$timeNow}' where ProductSysNo={$sp['product_id']} and StockSysNo=$subKey";
                            $ret = $msSQL->execSql($sql);
                            $cnt = $msSQL->getAffectedRows();
                            if ($ret === false || 1 != $cnt) {
                                self::$errCode = -2048;
                                self::$errMsg = "扣减ms sql库存失败({$sp['product_id'] })" . $msSQL->errMsg;
                                $sql = "rollback";
                                $msSQL->execSql($sql);
                                $orderDb->execSql($sql);
                                self::Log("扣减ms sql库存失败！[cnt:{$cnt}] errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
                                return false;
                            }

                            //ixiuzeng添加，将Inventroy_Stock的库存修改记录插入到Inventory_Flow表中
                            /*
							$sql = "insert into Inventory_Flow values
									($subOrderKey, {$sp['product_id']}, 1, $newOrderId, 2,$buy_count_negative,'$timeNow', '$timeNow',$_inserter),
									($subOrderKey, {$sp['product_id']}, 1, $newOrderId, 4,$buy_count_positive,'$timeNow', '$timeNow',$_inserter),
									($subOrderKey, {$sp['product_id']}, 1, $newOrderId, 5,$buy_count_positive,'$timeNow', '$timeNow',$_inserter)";
                            */
                            $sql = "insert into Inventory_Flow values
									($subKey, {$sp['product_id']}, 1, $newOrderId, 2,$buy_count_negative,'$timeNow', '$timeNow',$_inserter),
									($subKey, {$sp['product_id']}, 1, $newOrderId, 4,$buy_count_positive,'$timeNow', '$timeNow',$_inserter),
									($subKey, {$sp['product_id']}, 1, $newOrderId, 5,$buy_count_positive,'$timeNow', '$timeNow',$_inserter)";
                            $ret = $msSQL->execSql($sql);
                            $cnt = $msSQL->getAffectedRows();
                            if ((false === $ret) || (3 != $cnt)) {
                                self::$errCode = -2045;
                                self::$errMsg = "插入ms sql-Inventory_Flow表失败({$sp['product_id'] })" . $msSQL->errMsg;
                                $sql = "rollback";
                                $msSQL->execSql($sql);
                                $orderDb->execSql($sql);
                                self::Log("插入ms sql-Inventory_Flow表失败！[cnt:{$cnt}] errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
                                return false;
                            }


                            //插入虚库表
                            $auto_id = IIdGenerator::getNewId('SO_ProductVirtue_Sequence');
                            if (false === $auto_id) {
                                self::$errCode = -2089;
                                self::$errMsg = '获取订单虚库记录sql失败' . IIdGenerator::$errMsg;
                                $sql = "rollback";
                                $msSQL->execSql($sql);
                                $orderDb->execSql($sql);
                                self::Log("获取订单虚库记录sql失败！errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
                                return false;
                            }

                            $sql = "insert into t_order_virtual_stock_{$db_tab_index['table']} values($auto_id, '$oid', {$sp['product_id']}, {$sp['buy_count']}, 0, $now, $wh_id)";
                            $ret = $orderDb->execSql($sql);
                            if (false === $ret) {
                                self::$errCode = -2049;
                                self::$errMsg = '建虚库记录失败' . $orderDb->errMsg;
                                $sql = "rollback";
                                $msSQL->execSql($sql);
                                $orderDb->execSql($sql);
                                self::Log("建虚库记录失败！errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
                                return false;
                            }

                            //库存双写 S sheldonshi
                            $inventoryData = array(
                                'product_id' => $sp['product_id'],
                                'sys_stock' => $subKey,
                                'order_id' => $newOrderId,
                                'order_creat_time' => $now,
                                'buy_count' => $sp['buy_count'],
                                'order_type' => $product_base_info[$sp['product_id']]['sale_model'] == 0 ? 1 : $product_base_info[$sp['product_id']]['sale_model'],
                            );
                            $inventorysAllData[] = $inventoryData;
                            //库存双写 E sheldonshi

                        }
                        else { //深圳，北京暂不支持建虚库
                            self::$errCode = -2099;
                            self::$errMsg = '商品' . $product_base_info[$sp['product_id']]['name'] . "库存不足";
                            $sql = "rollback";
                            $msSQL->execSql($sql);
                            $orderDb->execSql($sql);
                            return array('errCode'=> -15, 'errMsg'=> "抱歉，{$product_base_info[$sp['product_id']]['name']}商品库存不足，请减少购买数量");
                        }

                        //插入订单-商品映射表
                        // $isMainProduct 0:主商品 1：组件 2：赠品
                        $isMainProduct = $sp['type'];
                        $product_base_info[$sp['product_id']]['point_type'] = isset($product_base_info[$sp['product_id']]['point_type']) ? $product_base_info[$sp['product_id']]['point_type'] : 0;
                        $product_base_info[$sp['product_id']]['point'] = isset($product_base_info[$sp['product_id']]['point']) ? $product_base_info[$sp['product_id']]['point'] : 0;
                        $product_base_info[$sp['product_id']]['cost_price'] = isset($product_base_info[$sp['product_id']]['cost_price']) ? $product_base_info[$sp['product_id']]['cost_price'] : 0;
                        $product_base_info[$sp['product_id']]['price'] = isset($product_base_info[$sp['product_id']]['price']) ? $product_base_info[$sp['product_id']]['price'] : 0;
                        @$cb = !empty($itemsInShoppingCart[$sp['product_id']]) ? $itemsInShoppingCart[$sp['product_id']]['cash_back'] : 0;
                        $useVirtualStock = $pstock['AvailableQty'] + $pstock['VirtualQty'] >= $sp['buy_count'] ? 0 : 1;
                        $newOrderItems = array(
                            'item_id'           => $itemStartID++,
                            'order_char_id'     => $oid,
                            'wh_id'             => $wh_id,
                            'product_id'        => $sp['product_id'],
                            'product_char_id'   => $product_base_info[$sp['product_id']]['product_char_id'],
                            'uid'               => $uid,
                            'name'              => $product_base_info[$sp['product_id']]['name'],
                            'flag'              => $product_base_info[$sp['product_id']]['flag'],
                            'type'              => $product_base_info[$sp['product_id']]['type'],
                            'type2'             => $product_base_info[$sp['product_id']]['type2'],
                            'weight'            => $product_base_info[$sp['product_id']]['weight'],
                            'buy_num'           => $sp['buy_count'],
                            'points'            => $product_base_info[$sp['product_id']]['point'] * $sp['buy_count'],
                            'points_pay'        => 0,
                            'point_type'        => $product_base_info[$sp['product_id']]['point_type'],
                            'price'             => ($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL) ? $product_base_info[$sp['product_id']]['price'] : 0,
                            'discount'          => intval(((($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL && $sp['main_product_id'] > 0) ? $sp['matchNum'] * $sp['cashCutPerItem'] : 0) + $cb) / $sp['buy_count']),
                            'cash_back'         => (($sp['main_product_id'] > 0 && $sp['type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL) ? $sp['cashCutPerItem'] : 0) + $cb,
                            'cost'              => $product_base_info[$sp['product_id']]['cost_price'],
                            'warranty'          => $product_base_info[$sp['product_id']]['warranty'],
                            'expect_num'        => 0,
                            'create_time'       => $now,
                            'product_type'      => $isMainProduct,
                            'use_virtual_stock' => $useVirtualStock,
                            'main_product_id'   => isset($sp['belongto_product_id']) ? $sp['belongto_product_id'] : 0,
                            'updatetime'        => $now,
                            'edm_code'          => isset($product_base_info[$sp['product_id']]['edm']) ? $product_base_info[$sp['product_id']]['edm'] : '',
                            'apportToPm'        => $couponInfo['type'] == 1 ? (isset($couponInfo['subOrders'][$subOrderKey]['apport'][$sp['product_id']]) ? ($couponInfo['subOrders'][$subOrderKey]['apport'][$sp['product_id']]) : 0) : 0,
                            'apportToMkt'       => (isset($couponInfo['subOrders'][$subOrderKey]['apport'][$sp['product_id']]) ? ($couponInfo['subOrders'][$subOrderKey]['apport'][$sp['product_id']]) : 0),
                            'shop_guide_cost'   => isset($product_base_info[$sp['product_id']]['shopPrice']) ? $product_base_info[$sp['product_id']]['shopPrice'] : 0,
                            'OTag'              => isset($sp['OTag']) ? $sp['OTag'] : '',
                            'package_ids'       => isset($itemsInShoppingCart[$sp['product_id']]) ? $itemsInShoppingCart[$sp['product_id']]['package_id'] : '',
                            //'energy_save'       => isset($energySaveDiscount) ? $energySaveDiscount : 0,
                        );

                        $newOrder['order_items'][] = $newOrderItems; //需要将order_item 传出该函数

                        $ret = $orderDb->insert("t_order_items_{$db_tab_index['table']}", $newOrderItems);
                        if (false === $ret) {
                            self::$errCode = -2039;
                            self::$errMsg = '执行sql语句失败' . $orderDb->errMsg;
                            $sql = "rollback";
                            $orderDb->execSql($sql);
                            $msSQL->execSql($sql);
                            self::Log("执行sql语句失败！errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
                            return false;
                        }

                        // 子订单商品数据，以商品ID作为key
                        $pItem = array(
                            'product_id' => $newOrderItems['product_id'],
                            'buy_num' => $newOrderItems['buy_num'],
                            'main_product_id' => $newOrderItems['main_product_id'],
                            //'product_type' => $newOrderItems['product_type'],
                        );

                        $ORS_Report_Data['childorderid'][$oid]['products'][$pItem["product_id"]] = $pItem;
                        $ORS_Report_Data['products'][$pItem["product_id"]]=$pItem;

                        if(isset($products_rules[$newOrderItems['product_id']]))
                        {
                            $orders_items_array[$newItem['order_char_id']][$newOrderItems['product_id']]['count'] = $products_rules[$newOrderItems['product_id']]['count'];
                            $orders_items_array[$newItem['order_char_id']][$newOrderItems['product_id']]['rule_id'] = $products_rules[$newOrderItems['product_id']]['rule_id'];
                        }

                        //统一订单start
                        //商品维度活动列表
                        $newOrderItems['promotion_price'] = $sp['promotion_total_price'];
                        $tradeActiveLists = array();
                        if(!empty($promotion)
                            && IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_CASH'] == $promotion['benefit_type']
                            && isset($couponInfo['subOrders'][$subOrderKey]['apport'][$sp['product_id']])
                        )
                        {
                            //商品维度促销活动列表
                            $tradeActive = array(
                                "activeNo" => $promotion['rule_id'],
                                "activeType" => 2,
                                "activeRuleId" => $promotion['rule_id'],
                                "activeDesc" => $promotion['desc'],
                                "preActiveFee"  => $product_base_info[$sp['product_id']]['price'] * $sp['buy_count'] - $sp['matchNum'] * $sp['cashCutPerItem'] - $cb,       //多价后的价格
                                "favorFee" => $couponInfo['subOrders'][$subOrderKey]['apport'][$sp['product_id']],
                                "activeParam1" => $promotion['benefit_type'],
                                "activeParam2" => $promotion['rule_type'],
                                "activeParam3" => $promotion['stage_price_type'],
                                "activeParam4" => $promotion['benefit_times'],
                                "activeParam5" => 0,
                                "activeParam6" => $promotion['account_type'],
                                "activeParam7" => 0,
                                "activeParam8" => "",
                            );
                            $tradeActiveLists[] = $tradeActive;
                        }
                        if((isset($newOrder['couponCode'])
                            && $newOrder['couponCode'] != "")
                            && isset($couponInfo['subOrders'][$subOrderKey]['apport'][$sp['product_id']])
                        )
                        {
                            //商品维度优惠券活动列表
                            $tradeActive = array(
                                "activeNo" => isset($couponInfo['coupon_id']) ? $couponInfo['coupon_id'] : 0,
                                "activeType" => 5,
                                "activeRuleId" => isset($couponInfo['coupon_id']) ? $couponInfo['coupon_id'] : 0,
                                "activeDesc" => $couponInfo['coupon_name'],
                                "preActiveFee"  => $product_base_info[$sp['product_id']]['price'] * $sp['buy_count'] - $sp['matchNum'] * $sp['cashCutPerItem'] - $cb,           //多价后的价格
                                "favorFee" => $couponInfo['subOrders'][$subOrderKey]['apport'][$sp['product_id']],
                                "activeParam1" => $couponInfo['type'],
                                "activeParam2" => 1,
                                "activeParam3" => 0,
                                "activeParam4" => 0,
                                "activeParam5" => $couponInfo['type'] == 1 ? $couponInfo['subOrders'][$subOrderKey]['apport'][$sp['product_id']] : 0,
                                "activeParam6" => $couponInfo['subOrders'][$subOrderKey]['apport'][$sp['product_id']],
                                "activeParam7" => isset($couponInfo['code']) ? $couponInfo['code'] : "",
                                "activeParam8" => isset($couponInfo['coupon_name']) ? $couponInfo['coupon_name'] : "",
                            );
                            $tradeActiveLists[] = $tradeActive;
                        }

                        if(($sp['main_product_id'] > 0 && $sp['type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL && ($sp['cashCutPerItem'] * $sp['matchNum']) > 0))
                        {
                            //商品维度随心配活动列表
                            $tradeActive = array(
                                "activeNo" => $sp['main_product_id'],
                                "activeType" => 8,
                                "activeRuleId" => 1,                             //随心配辅商品
                                "activeDesc" => "",
                                "preActiveFee"  => $product_base_info[$sp['product_id']]['price'] * $sp['buy_count'],
                                "favorFee" => $sp['cashCutPerItem'] * $sp['matchNum'],
                                "activeParam1" => $sp['matchNum'],
                                "activeParam2" => 0,
                                "activeParam3" => 0,
                                "activeParam4" => $sp['cashCutPerItem'],
                                "activeParam5" => $sp['main_product_id'],
                                "activeParam6" => 0,
                                "activeParam7" => $sp['cashCutPerItem'] * $sp['matchNum'],
                                "activeParam8" => 0,
                            );
                            $tradeActiveLists[] = $tradeActive;
                        }

                        $newOrderItems['activeList'] = $tradeActiveLists;
                        $uniorder_tradeList[$newOrderItems['order_char_id']][] = $newOrderItems;

                        //end
                        //更新批价明细里的订单和时间的字段
                        reset($priceDetails);
                        $strPriceDetails = ToolUtil::gbJsonEncode($priceDetails);
                        Logger::info("writePriceDetail  www ===>".$strPriceDetails);
                        foreach($priceDetails as &$priceDetail)
                        {
                            if($priceDetail["product_id"] == $sp['product_id'] && !isset($priceDetail['order_char_id']))
                            {
                                $priceDetail['order_char_id'] = $oid;
                                $priceDetail['create_time'] = $now;
                            }
                        }
                        break;
                    }
                }
            }
            $newOrderId++;
        }

        //库存双写 S sheldonshi
        $inventoryRet = IShoppingProcess::setLockInventory($uid, $inventorysAllData);
        if($inventoryRet['errCode'] != 0)
        {
            $lockedInventory = $inventoryRet['lockedInventory'];
            self::Log("place order setLockInventory Error![lockedInventory:" . ToolUtil::gbJsonEncode($lockedInventory) . "]");
            if(!empty($lockedInventory))
            {
                $inventoryRet = IShoppingProcess::setUnlockInventory($uid, $lockedInventory);
                if($inventoryRet == false)
                {
                    self::Log("place order setUnlockInventory Error");
                }
            }
            //正式环境不可下单，返回库存问题
            //return false;
        }
        //库存双写 E sheldonshi


        $mysqlDb = NULL;

        if (!empty($promotion)) {
            self::Log("使用了促销规则");
            //如果是送积分，优惠券，还需要执行向用户帐号里发放积分，优惠券
            if (IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_POINT'] == $promotion['benefit_type']) {
                // 送积分
            }
            else if (IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_COUPON'] == $promotion['benefit_type']) {
                // 送优惠卷
                $couponFetch = array();
                $batches = explode(",", $promotion['benefits']);
                foreach ($batches as $batch) {
                    $couponFetch[$batch] = $promotion['benefit_times'];
                }
                if (NULL == $mysqlDb) {
                    $mysqlDb = ToolUtil::getDBObj('coupon', 0);
                    if (false === $mysqlDb) {
                        self::$errCode = Config::$errCode;
                        self::$errMsg = Config::$errMsg;

                        $sql = "rollback";
                        //$orderDb->execSql($sql);
                        $msSQL->execSql($sql);
                        //库存双写 S Sheldonshi
                        IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                        //库存双写 E Sheldonshi
                        self::Log("送优惠券error！errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
                        return false;
                    }

                    $sql = "start transaction";
                    $ret = $mysqlDb->execSql($sql);
                    if (false === $ret) {
                        self::$errCode = $mysqlDb->errCode;
                        self::$errMsg = $mysqlDb->errMsg;

                        $sql = "rollback";
                        //$orderDb->execSql($sql);
                        $msSQL->execSql($sql);
                        //库存双写 S Sheldonshi
                        IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                        //库存双写 E Sheldonshi
                        self::Log("送优惠券 transaction error！errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
                        return false;
                    }
                }
                $ret = ICoupon::fetchCoupons($uid, $couponFetch, $mysqlDb, (isset($userInfo['level']) ? $userInfo['level'] : -1));
                if (false === $ret) {
                    self::$errCode = ICoupon::$errCode;
                    self::$errMsg = ICoupon::$errMsg;
                    $sql = "rollback";
                    $mysqlDb->execSql($sql);
                    //$orderDb->execSql($sql);
                    $msSQL->execSql($sql);
                    //库存双写 S Sheldonshi
                    IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                    //库存双写 E Sheldonshi
                    if (ICoupon::$errCode == -106) {
                        return array('errCode'=> -987, 'errMsg'=> '抱歉，您参加的活动已结束或终止，请您返回购物车重新操作');
                    }
                    else {
                        self::Log("送优惠券 fetchCoupons error！errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
                        return false;
                    }
                }

                $couponids = '';
                foreach ($ret as $promotionCode) {
                    $couponids .= (implode(",", $promotionCode) . ",");
                }
                if ('' != $couponids) {
                    $orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
                    $ret = $orderDb->update("t_orders_{$db_tab_index['table']}", array('rule_benefit'=> $couponids), "order_char_id='$parentOrderId' and uid={$uid}");
                    if (false === $ret) {
                        self::$errCode = $mysqlDb->errCode;
                        self::$errMsg = $mysqlDb->errMsg;
                        $sql = "rollback";
                        $mysqlDb->execSql($sql);
                        $orderDb->execSql($sql);
                        $msSQL->execSql($sql);
                        //库存双写 S Sheldonshi
                        IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                        //库存双写 E Sheldonshi
                        self::Log("订单表更新!errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
                        return false;
                    }
                }
                //统一订单
                foreach($activeInfoList as $oid => $activeInfos)
                {
                    foreach($activeInfos as $index=>$activeInfo)
                    {
                        if($activeInfo['activeType'] == 2 && $activeInfo['activeParam1'] == $promotion['benefit_type'])
                        {
                            $activeInfoList[$oid][$index]['activeParam8'] = $couponids;
                        }
                    }
                }
                //统一订单
            }
        }

        //更新购物券
        if (isset($newOrder['couponCode']) && $newOrder['couponCode'] != '') {
            self::Log("更新优惠券");
            global $_CouponStatus;
            $st = $_CouponStatus['partly_used'];

            if ($couponInfo['used_degree'] + 1 >= $couponInfo['max_use_degree']) {
                $st = $_CouponStatus['used'];
            }
            if (NULL == $mysqlDb) {
                $mysqlDb = ToolUtil::getDBObj('coupon', 0);
                if (false === $mysqlDb) {
                    self::$errCode = ToolUtil::$errCode;
                    self::$errMsg = ToolUtil::$errMsg;

                    $sql = "rollback";
                    $orderDb->execSql($sql);
                    $msSQL->execSql($sql);
                    //库存双写 S Sheldonshi
                    IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                    //库存双写 E Sheldonshi
                    self::Log("更新优惠券!errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
                    return false;
                }

                $sql = "start transaction";
                $ret = $mysqlDb->execSql($sql);
                if (false === $ret) {
                    self::$errCode = $mysqlDb->errCode;
                    self::$errMsg = $mysqlDb->errMsg;

                    $sql = "rollback";
                    $orderDb->execSql($sql);
                    $msSQL->execSql($sql);
                    //库存双写 S Sheldonshi
                    IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                    //库存双写 E Sheldonshi
                    self::Log("更新优惠券 transaction!errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
                    return false;
                }
            }

            $ret = ICoupon::useCoupon($uid, $couponInfo, $orderstrforlog, $mysqlDb, (isset($userInfo['level']) ? $userInfo['level'] : -1), $wh_id);
            if (false === $ret) {
                self::$errCode = ICoupon::$errCode;
                self::$errMsg = ICoupon::$errMsg;

                $sql = "rollback";
                $mysqlDb->execSql($sql);
                $orderDb->execSql($sql);
                $msSQL->execSql($sql);
                //库存双写 S Sheldonshi
                IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                //库存双写 E Sheldonshi
                self::Log("更新优惠券 useCoupon!errCode" . self::$errCode . ";errMsg:" .self::$errMsg);

                return array(
                    'errCode' => -15,
                    'errMsg' => "抱歉，您使用的优惠券暂时无法使用，请确认！",
                );
                //return false;
            }
        }

        //如果是节能补贴订单，则将节能补贴申请信息插入对应的表
        if ($is_energy_subsidy_order) {
            self::Log("节能补贴订单");
            //插入节能补贴数据
            $coreDb = ToolUtil::getMSDBObj('ICSON_CORE');
            $sql = "begin transaction";
            $ret = $coreDb->execSql($sql);
            if (false === $ret) {
                self::$errCode = -2035;
                self::$errMsg = '开启ms sql事务失败' . $coreDb->errMsg;
                $sql = "rollback";
                if (isset($mysqlDb) && !empty($mysqlDb)) {
                    $mysqlDb->execSql($sql);
                }
                $orderDb->execSql($sql);
                $msSQL->execSql($sql);
                //库存双写 S Sheldonshi
                IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                //库存双写 E Sheldonshi
                return false;
            }
            $ret = $coreDb->insert("t_order_energy_subsidy", array(
                'order_id'   => ($newOrderId - 1),
                'type'       => intval($newOrder['es_type']),
                'name'       => $newOrder['es_name'],
                'idCard'     => $newOrder['es_idCard'],
                'timestamp'  => time(),
                'hw_id'      => $wh_id,
                'stockNo'    => current(array_keys($shoppingProduct))
            ));
            if (false === $ret) {
                self::$errCode = $coreDb->errCode;
                self::$errMsg = $coreDb->errMsg;
                $sql = "rollback";
                if (isset($mysqlDb) && !empty($mysqlDb)) {
                    $mysqlDb->execSql($sql);
                }
                $orderDb->execSql($sql);
                $msSQL->execSql($sql);
                //库存双写 S Sheldonshi
                IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                //库存双写 E Sheldonshi
                return false;
            }
        }

        //更新积分
        if ($newOrder['point'] > 0)
        {
            //插入扣减积分的流水
            self::Log("更新积分");
            global $_SCORE_TYPE;
            $ret = IScore::addScore($uid, $_SCORE_TYPE['CREATE_ORDER']['id'], -1 * $newOrder['point'] / 10, "您下单10" . ($newOrderId - 1) . "消费积分", '', -1 * $cash_point_used / 10, -1 * $promotion_point_used / 10);
            if (false === $ret) {
                self::$errCode = IScore::$errCode;
                self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "add score flow:insert score flow faild(uid={$newOrder['uid']},order_id=$newOrderId,point={$newOrder['point']})" . IScore::$errMsg;
                $sql = "rollback";

                if (isset($mysqlDb) && !empty($mysqlDb)) {
                    $mysqlDb->execSql($sql);
                }
                $orderDb->execSql($sql);
                $msSQL->execSql($sql);
                //库存双写 S Sheldonshi
                IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                //库存双写 E Sheldonshi
                IOrder::Log(self::$errMsg);
                self::Log("更新积分 useCoupon!errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
                return array('errCode'=> -987, 'errMsg'=> '抱歉，您的订单因使用积分异常导致提交订单失败，您可以稍后重新下单或在提交订单时暂不使用积分');
            }
        }

        //扣减多价促销次数
        self::Log("扣减促销多价次数");
        $ret = IPromotionRuleV2::dealPromotionRestrict($restricts, $newOrder['uid']);
        if (false === $ret) {
            $restrictsJson = ToolUtil::gbJsonEncode($restricts);
            self::$errCode = IPromotionRuleV2::$errCode;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "dealPromotionRestrict faild(uid={$newOrder['uid']},)" . IPromotionRuleV2::$errMsg.",{$restrictsJson}";
            $sql = "rollback";
            if (isset($mysqlDb) && !empty($mysqlDb)) {
                $mysqlDb->execSql($sql);
            }
            $orderDb->execSql($sql);
            $msSQL->execSql($sql);
            //库存双写 S Sheldonshi
            IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
            //库存双写 E Sheldonshi
            IOrder::Log(self::$errMsg);
            self::Log("扣减促销多价次数 useCoupon!errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
            return array('errCode'=> -989, 'errMsg'=> '抱歉，您的订单因系统异常导致提交订单失败，您可以稍后重新下单');
        }
        else
        {
            $restricts = $ret["restrict"];
        }

        self::Log("commit事务");
        $sql = "commit";

        if (!empty($mysqlDb)) {
            $mysqlDb_commit_ret = $mysqlDb->execSql($sql);
        }

        if (!empty($coreDb)) {
            $coreDb_commit_ret = $coreDb->execSql($sql);
        }

        $msSQL_commit_ret = $msSQL->execSql($sql);
        $orderDb_commit_ret = $orderDb->execSql($sql);

        //如果订单的事务提交失败，且使用了积分,则需要记录该条信息
        if(!$orderDb_commit_ret)
        {
            //回滚多价促销内容
            $ret = IPromotionRuleV2::rollbackPromotionRestrict($restricts, $newOrder['uid']);
            if (false === $ret) {
                $restrictsJson = ToolUtil::gbJsonEncode($restricts);
                self::$errCode = IPromotionRuleV2::$errCode;
                self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "rollbackPromotionRestrict faild(uid={$newOrder['uid']},)" . IPromotionRuleV2::$errMsg.",{$restrictsJson}";

                IOrder::Log(self::$errMsg);
            }
            if($newOrder['point'] > 0)
            {
                $backDate['order_id'] = $newOrderId - 1;
                $backDate['uid'] = $uid;
                $backDate['type'] = ERROR_COMMIT_ORDER;
                $backDate['cash_point'] = $cash_point_used;
                $backDate['promotion_point'] = $promotion_point_used;

                self::Log("$uid 用户下订单 {$backDate['order_id']} 本单使用的积分将在1个小时内返还到您的账户");
                $ret = IScore::insertBackData($backDate);
                return array('errCode'=> -988, 'errMsg'=> '抱歉，您的订单提交失败，本单使用的积分将在1个小时内返还到您的账户');
            }
        }

        // 上报促销规则使用记录

        if (isset($newOrder['rule_id']) && $newOrder['rule_id'] > 0) {
            $orders = explode(",", $orderstrforlog);
            foreach ($orders as $o) {
                if (!empty($o)) {
                    DataReport::report(3001, DATA_TYPE_1DAY, array($wh_id, $o, $newOrder['rule_id'], $userInfo['level'], $uid));
                }
            }
        }

        //写下用户购买单品赠券信息
        if (isset($newOrder['send_coupon_record_info']) && $newOrder['send_coupon_record_info'] != '') {
            $ret = EA_Promotion::setUserJoinedRecord($uid, $now, $newOrder['send_coupon_record_info'], $orders_items_array);
        }

        self::writePriceDetail($uid, $priceDetails);
        self::reportORS($ORS_Report_Data);
        self::reportToSZ($orderToSZ, $items); //TAPD 5478549 数据上报
        self::reportBaiduSem($_COOKIE, $subOrders, $wh_id); // 上报百度sem数据
        self::reportGSadid($_COOKIE, $subOrders, $wh_id); // 上报 国双 数据
        //删除购物车
        if (!(isset($newOrder['buy_one_key']) && true === $newOrder['buy_one_key'])) {
            IShoppingCart::clear($uid);
        }

        //更新用户地址信息中默认支付方式，默认发票
        IUserAddressBookTTC::update(
            array(
                'uid'=>$uid,
                'default_shipping'=>$newOrder['shipType'],
                'default_pay_type'=>$newOrder['payType'],
                'last_use_time'=>time(),
                'iid'=>$newOrder['invoiceId']
            ),
            array('aid'=>$newOrder['aid'])
        );
        //发送短信通知
        if ($newOrder['point'] > 1000) {
            $mobile = $userInfo['mobile'];
            $time = date("Y-m-d H:i:s");
            $ret = IMessage::sendSMSMessage($mobile, "您的易迅网账户于" . $time . "下单并使用积分" . $newOrder['point'] / 10 . "个。订单号" . $parentOrderId . "。如有疑问请致电400-828-1878");
            if (false === $ret) {
                self::Log("发送短信：发送信息失败：" . IMessage::$errMsg);
            }
        }

        //*******************统一订单双写灰度 Start*****************
        //writeUniOrdersData($uid, $uniorder_orderList, $orderNum, $uniorder_parentOrder, $uniorder_tradeList, $newOrder, $activeInfoList, $isEnergySubsidyOrder)
        global $_UIN_ORDER_WHITE_LIST;
        if($_UIN_ORDER_WHITE_LIST['flag'])
        {
            //灰度
            if($_UIN_ORDER_WHITE_LIST['type'] == 1)
            {
                //白名单灰度
                if(in_array($uid, $_UIN_ORDER_WHITE_LIST['list']))
                {
                    self::writeUniOrdersData($uid, $uniorder_orderList, $orderNum, $uniorder_parentOrder, $uniorder_tradeList, $newOrder, $activeInfoList, $isEnergySubsidyOrder);
                }
            }
            else if($_UIN_ORDER_WHITE_LIST['type'] == 2)
            {
                //uid取模灰度
                $mod = $_UIN_ORDER_WHITE_LIST['mod'];
                if($uid % $mod == 0)
                {
                    //写统一订单
                    self::writeUniOrdersData($uid, $uniorder_orderList, $orderNum, $uniorder_parentOrder, $uniorder_tradeList, $newOrder, $activeInfoList, $isEnergySubsidyOrder);
                }
            }
            else if($_UIN_ORDER_WHITE_LIST['type'] == 3)
            {
                //全量
                self::writeUniOrdersData($uid, $uniorder_orderList, $orderNum, $uniorder_parentOrder, $uniorder_tradeList, $newOrder, $activeInfoList, $isEnergySubsidyOrder);
            }
        }
        //*******************统一订单双写灰度 End********************

        global $_PAY_MODE;
        return array(
            'errCode'         => 0,
            'uid'             => $uid,
            'orderId'         => $parentOrderId,
            'orderAmt'        => $orderShipPrice + $orderPrice - $newOrder['point'] - $couponInfo['amt'],
            'payType'         => $newOrder['payType'],
            'payTypeIsOnline' => $_PAY_MODE[$wh_id][$newOrder['payType']]['IsNet'],
            'payTypeName'     => $_PAY_MODE[$wh_id][$newOrder['payType']]['PayTypeName'],
            'orderTotalAmt'   => $orderShipPrice + $orderPrice, //订单总金额
            'payGoodsAmt'     => $product_cash, //订单客户支付的金额（去掉运费和享受到的其它优惠后的用户实际支付金额）
            'orderCreateTime' => $now,
            'isParentOrder'   => $orderNum > 1 ? true : false,
            'isVATInvoice'    => ($newOrder['invoiceType'] == INVOICE_TYPE_VAT) ? true : false,
            'order_items'     => $newOrder['order_items'],
            'subOrderIdStr'   => $orderstrforlog, //传出去 cps 跟单
            'subOrders'       => $subOrders, //传出去 cps 跟单
        );
    }

    public static function verifyExpectDateSpan($icson_delivery_info, $timeAvailable, $destination)
    {
        //self::Log("verifyExpectDateSpan". ToolUtil::gbJsonEncode($icson_delivery_info)."time:". ToolUtil::gbJsonEncode($timeAvailable)."destination:".$destination);
        if (!is_array($timeAvailable) || count($timeAvailable) == 0) {
            self::$errCode = -11;
            self::$errMsg = "本周暂不提供配送服务，谢谢您的关注";
            return false;
        }
        else
        {
            $isExpect = false;
            if(!isset($icson_delivery_info['expect_ship_date']) || !isset($icson_delivery_info['expect_time_span']))
            {
                self::$errCode = -11;
                self::$errMsg = "没有期望配送时间";
                return false;
            }
            $expect_ship_date = $icson_delivery_info['expect_ship_date'];
            $expect_time_span = $icson_delivery_info['expect_time_span'];
            //self::Log($expect_ship_date."===".$expect_time_span);
            // 检查配送时间是否在可用的配送时间内，默认不正确
            //self::Log("verifyExpectDateSpan". ToolUtil::gbJsonEncode($timeAvailable));
            foreach ($timeAvailable as $span)
            {
                if (strtotime($span['ship_date']) == strtotime($expect_ship_date) && $span['time_span'] == $expect_time_span )
                {   // 且下单时间段存在
                    // 找到了用户的选择时间，根据当前状态来提示
                    $s = self::$timeSpan[$span['time_span']];
                    $selected_time = date("n月j日{$s}",strtotime($span['ship_date']));
                    $stop = self::$stopTime[$span['time_span']];

                    global $_District;
                    if ($_District[$destination]['city_id'] == 1692 && $span['time_span'] == MORNING)
                    {
                        $stop = "23:00";
                    }

                    switch($span['status'])
                    {
                        case self::NORMAL:
                            $isExpect = true;
                            break;
                        case self::EXPIRE:
                            $isExpect = false;
                            self::$errCode = -11;
                            self::$errMsg = "超过结单时间{$stop}，您选择的\"{$selected_time}\"已不可用，请点击确定后重新选择";
                            break;
                        case self::LIMITED:
                            $isExpect = false;
                            self::$errCode = -11;
                            self::$errMsg = "您选择的\"{$selected_time}\"订单配额已满，请点击确定后重新选择";
                            break;
                        default;
                            break;
                    }
                    return $isExpect;
                }
            }
        }
        self::$errCode = -11;
        self::$errMsg = "您提交的配送时间不正确，请点击确定后重新选择";
        return false;
    }
}