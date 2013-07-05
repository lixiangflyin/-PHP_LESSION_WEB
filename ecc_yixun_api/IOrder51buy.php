<?php
require_once(PHPLIB_ROOT . 'lib/DataReport.php');
require_once(PHPLIB_ROOT . 'inc/special.constant.inc.php');


class IOrder51buy extends IOrder{
	public static $errCode = 0;
	public static $errMsg = '';
	public static $logMsg = '';

	//Բͨ���
	public static $ytoRequestTpl = '<BatchQueryRequest><logisticProviderID>YTO</logisticProviderID><clientID>ICSON</clientID><orders><order><mailNo>{sysno_holder}</mailNo></order></orders></BatchQueryRequest>';
	public static $ytoPartnerId = 'icson';
	public static $ytoRequestHost = 'jingang.yto56.com.cn';
	public static $ytoRequestUrl = 'http://116.228.70.199/ordws/VipOrderServlet';

	// ������Ʊ
	const HAS_INVOICE = 1;
	const NO_INVOICE = 0;
	//������Ʒ��ʾ��֤�룿
	const DISPLAY_VERIFY_CODE = false;
	const FREE_SHIPPING_PRICE = 2900; //���˷ѵĹ�����ͼۣ���λΪ��

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
		 @desc	ȡ������
		 @para	uid���û�id
		 @para	order_id������id
		 @para	product_id����Ʒid
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

		//�ж϶����Ƿ����ȡ��
		global $_OrderState, $_PAY_MODE;
		$can_cancel = IOrder::checkCanCancel($order);
		if (false === $can_cancel)
		{
			self::$errCode = -1409;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_id[$order_id] can not canceled";
			return false;
		}

		//��ȡ�ö�����Ӧ����Ʒ�б�
		$sql = "select product_id, wh_id, buy_num, use_virtual_stock from t_order_items_{$db_tab_index['table']} where order_char_id='$order_id'";
		$order_items = $orderDb->getRows($sql);
		if (false === $order_items) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

		$timeNow = date('Y-m-d H:i:s');

		//������ָ����
		global $_StockToStation;
		global $_SO_Site;
		// �����վ���Ѿ��л����˿ͷ�ϵͳ����ʹ���µĿͷ���
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
			self::$errMsg = '����orderdb����ʧ��';
			return false;
		}

		$ret = $erpDb->execSql($sql);
		if (false === $ret) {
			self::$errCode = $erpDb->errCode;
			self::$errMsg = '����ms sql����ʧ��,line:' . __LINE__ . ",errMsg:" . $erpDb->errMsg;
			$sql = "rollback";
			$orderDb->execSql($sql);
			return false;
		}

		$sql = "SELECT Status from SO_Master where SOID='{$order_id}'";
		$erpOrder = $erpDb->getRows($sql);
		if (false === $erpOrder) {
			self::$errCode = $erpDb->errCode;
			self::$errMsg = '��ѯERP����ʧ��,line:' . __LINE__ . ",errMsg:" . $erpDb->errMsg;
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
		//���ö���״̬Ϊ�û�ȡ��״̬
		$sql = "update t_orders_{$db_tab_index['table']} set status = {$_OrderState['CustomerCancel']['value']} where uid=$uid and order_char_id='$order_id' and status in ({$_OrderState['Origin']['value']},{$_OrderState['WaitingPay']['value']},{$_OrderState['WaitingManagerAudit']['value']}) ";
		$ret = $orderDb->execSql($sql);
		if (false === $ret || $orderDb->getAffectedRows() != 1) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = 'ȡ��ǰ̨����ʧ��,line:' . __LINE__ . ",errMsg:" . $orderDb->errMsg;
			$sql = "rollback";
			$orderDb->execSql($sql);
			$erpDb->execSql($sql);
			return false;
		}

		//��ѯERP���м������״̬�����Ƿ���ȡ��
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
			//��ѯERP��So_Master������״̬�����Ƿ���ȡ��
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

			//��ѯERP�ж�����״̬�����Ƿ���ȡ�� ���
		}
		//�ָ����
		$inventoryDB = ToolUtil::getMSDBObj('Inventory_Manager');
		if( false === $inventoryDB )
		{
			self::$errCode = $erpDb->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "����Inventory_Manager���ݿ����" . $erpDb->errMsg;
			$sql = "rollback";
			$orderDb->execSql($sql);
			$erpDb->execSql($sql);
		}

		$sql = "begin transaction";
		$ret = $inventoryDB->execSql($sql);
		if (false === $ret) {
			self::$errCode = $inventoryDB->errCode;
			self::$errMsg = '����inventoryDB����ʧ��,line:' . __LINE__ . ",errMsg:" . $inventoryDB->errMsg;
			$sql = "rollback";
			$orderDb->execSql($sql);
			$erpDb->execSql($sql);
			return false;
		}

		$order_id_int = intval($order_id) % 100000000;

		// ������ˮ�Ĵ���λ����ʼ update ֮ǰ����һ�� Inventory_Stock


		$_local_ip = ToolUtil::getLocalIp(0);
		$_local_ip = explode('.', $_local_ip);
		$_inserter = empty($_local_ip[3]) ? 7 : intval($_local_ip[3]);

		reset($order_items);
        //���˫д S Sheldonshi
        $inventorysAllData = array();
        //���˫д E Sheldonshi

		foreach ($order_items as $oit)
		{
			$buy_num_positive = $oit['buy_num'];
			$buy_num_negative = $oit['buy_num'] * (-1);

			//������ⵥ����Ҫ��ȥ�������������������������ⵥ
			if ($oit['use_virtual_stock'] == 1) {
				$sql = "update t_order_virtual_stock_{$db_tab_index['table']} set status=" . VIRTUAL_STOCK_STATUS_CACEL . ",update_time=" . time() . " where order_char_id='$order_id' AND product_id={$oit['product_id']}";
				$ret = $orderDb->execSql($sql);
				if (false === $ret) {
					self::$errCode = $orderDb->errCode;
					self::$errMsg = "������ⵥʧ�ܣ�line��" . __LINE__ . ",errMsg" . $orderDb->errMsg;
					$sql = "rollback";
					$orderDb->execSql($sql);
					$erpDb->execSql($sql);
					return false;
				}


				//ixiuzeng��ӣ���Inventroy_Stock�Ŀ���޸ļ�¼���뵽Inventory_Flow����
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
				self::$errMsg = "��������ʧ�ܣ�line��" . __LINE__ . ",errMsg" . $inventoryDB->errMsg;
				$sql = "rollback";
				$orderDb->execSql($sql);
				$erpDb->execSql($sql);
				$inventoryDB->execSql($sql);
				return false;
			}
            //���˫д S sheldonshi
            //��ȡ����Ʒ��sale_model
            $productInfoRet = IShoppingProcess::getProductInfo(array($oit['product_id']), $order['stockNo'], 0, $uid);
            if(false === $productInfoRet)
            {
                //��Ϣ��ȡʧ�ܣ���¼��־
                $inventoryData = array(
                    'product_id' => $oit['product_id'],
                    'sys_stock' => $order['stockNo'],
                    'order_id' => $order_id_int,
                    'order_creat_time' => $order['order_date'],
                    'buy_count' => $oit['buy_num'],
                    'order_type' => 0,  //������Ҫ�޸�
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
                    'order_type' => $productInfoRet[$oit['product_id']]['sale_model'] == 0 ? 1 : $productInfoRet[$oit['product_id']]['sale_model'],  //������Ҫ�޸�
                );
                $inventorysAllData[] = $inventoryData;
            }
            //���˫д E sheldonshi
		}

		if ( ICustomPhone::isCustomPhoneOrder($order) )
		{
			// ����Ƕ��ƻ�����
			// ���ݶ������ҵ���Լ�еĺ���
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

			// ��󷵻������״̬
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

		//���ʹ���˻��֣���������
		if ($order['point_pay'] > 0) {
			//$userInfo = IUsersTTC::get($uid, array(), array('valid_point'));
            $userInfo = IUser::getUserInfo($uid);
            if (false === $userInfo) {
				self::$errCode = IUser::$errCode;
				self::$errMsg = "�û�ʹ���˻��֣�getUserInfo::getʧ�ܣ�line:" . __LINE__ . ",errMsg:" . IUser::$errMsg;
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
			//�ӳٷ������֣�����һ����Ҫ�����Ķ�����¼
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

		//ȡ���ɹ��󣬵���ERP�ķ��񣬼�¼�ö�����ȡ��
		$inform_data = array(
			'order_char_id' => $order['order_char_id'],
			'stock_id' => $order['stockNo'],
			'status' => $_OrderState['CustomerCancel']['value'],
		);
		EA_ServiceFromERP::informOrderCancel($inform_data);

		$ordersToSub = array(
			$order['order_char_id'] => $order
		);

		// ȡ�������ɹ�����¼��-1
		IShippingTime::orderRecording($ordersToSub, -1);

		//IOrderProcessFlowTTC::insert(array('order_char_id'=>$order_id, 'ptime'=>date('Y-m-d H:i:s'), 'content'=>"���ɹ�ȡ���˸ö�����"));
		//flycgu ����棬�޸�TTC���ݣ�ʧ�ܲ����أ���Ϊͬ���ű�Ҳ��ͬ�����
		foreach ($order_items as $oit)
		{
			$info = IInventoryStockTTC::get($oit['product_id'], array('stock_id' => $order['stockNo']));
			//�ж��Ƿ������
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
		//���������Ż�ȯ��ȡ���Ż�ȯ��¼����ȯ��¼,֮��ĳ�������뵽������
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

        //���˫д S sheldonshi
        IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
        //���˫д E sheldonshi

		return true;
	}

	public static function placeOrder($newOrder, $wh_id)
	{
		$newOrder = self::transXSSContent($newOrder);
		self::$visitkey = $newOrder['visitkey'];

		$uid = $newOrder['uid'];
		$destination = $newOrder['receiveAddrId'];
		//���ʹ���Ż�ȯ���ж��û��Ƿ�Ϊ�����̣����ǣ�������ʹ���Ż�ȯ

		$isDistribution = (isset($newOrder['isDistribution']) && !empty($newOrder['isDistribution'])) ? true : false; //����
		$userInfo = IUser::getUserInfo($uid);
		if ($userInfo === false) {
			self::$errCode = IUser::$errCode;
			self::$errMsg = "��ȡ�û���Ϣ����";
			self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:��ȡ�û���Ϣ����" . IUser::$errMsg;
			return false;
		}

		global $_USER_TYPE;
		if ($userInfo['type'] == $_USER_TYPE['Dealer'] && isset($newOrder['couponCode']) && $newOrder['couponCode'] != '') {
			return array('errCode'=> 15, 'errMsg'=> "�����ڷ����û�������ʹ���Ż�ȯ��");
		}

		// ���ù��ﳵ����
		$shoppingCartInfo = self::setShoppingCartInfo($newOrder);

		// ��ȡ���ﳵ��Ʒ�б�
		$result = IPreOrder::getItemList($uid, $wh_id, $shoppingCartInfo);
		if (false === $result) {
			self::$errCode = IPreOrder::$errCode;
			self::$errMsg = IPreOrder::$errMsg . ",uid({$uid}) getItemList failed";
			return array('errCode'=> self::$errCode, 'errMsg'=> "���Ĺ��ﳵ��û����Ʒ����ѡ����");
		}

		// ���ﳵ�е���Ʒ
		$items = $result['items'];

		if (isset($newOrder['ls']) && in_array($newOrder['ls'], self::$AppLS)) {
			$items = IShoppingCart::filterPackageItems($items);
		}

		// ��Ʒ�е��ײ���Ϣ
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


		$ret = IPreOrder::splitSuiteItems($items,$suiteInfo);
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

		self::Log("��ȡ���ﳵ�е���Ʒ�б�:" . ToolUtil::gbJsonEncode($items) . "," . ToolUtil::gbJsonEncode($itemsInShoppingCart));

		if (count($itemsInShoppingCart) == 0) {
			return array('errCode'=> 10, 'errMsg'=> "���Ĺ��ﳵ��û����Ʒ����ѡ����");
		}

		reset($newOrder['suborders']);
		$countPost = 0;
		while (FALSE != ($node = current($newOrder['suborders'])))
		{
			if (!isset($node['items'])) {
				return array('errCode'=> 10, 'errMsg'=> "���ύ�Ķ��������������飡");
			}
			$countPost += count($node['items']);
			next($newOrder['suborders']);
		}
		$promotionRule = false;
		if (isset($newOrder['rule_id']))
		{
			if (!isset($newOrder['applytimes']) || $newOrder['applytimes'] < 0) {
				return array('errCode'=> -991, 'errMsg'=> '��Ǹ�����μӵĻ�ѽ�������ֹ���������ع��ﳵ���²���');
			}

			$promotionRule = IPromotionRule::checkRuleForOrder($itemsInShoppingCart, $wh_id, $uid, $newOrder['rule_id'], $newOrder['applytimes']);
			if (false === $promotionRule) {
				self::$errCode = IPromotionRule::$errCode;
				self::$errMsg = IPromotionRule::$errMsg;
				return false;
			}
			$promotionRule = json_decode($promotionRule, true);
			if (!is_array($promotionRule)) {
				self::$errCode = -841;
				self::$errMsg = "json_decode promotionrule failed";
				return false;
			}
			if ($promotionRule['errCode'] == -2007 || $promotionRule['errCode'] == -2008 || $promotionRule['errCode'] == -2006) {
				return array('errCode'=> -991, 'errMsg'=> '��Ǹ�����μӵĻ�ѽ�������ֹ���������ع��ﳵ���²���');
			}
			if ($promotionRule['errCode'] != 0 || !isset($promotionRule['rules'][0])) { //��ȡ��������ʧ��
				self::$errCode = $promotionRule['errCode'];
				self::$errMsg = $promotionRule['errMsg'];
				return false;
			}

			//����Ҫ�����û��Ѿ�ʹ�øù���Ĵ���
			if ($promotionRule['rules'][0]['apply_time_peruser'] < 999) {
				$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
				$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
				if (!empty($orderDb)) {
					$sql = "select order_char_id from t_orders_{$db_tab_index['table']} where uid={$uid} and coupon_code='rule_{$newOrder['rule_id']}' and status >=0";
					$count = $orderDb->getRows($sql);
					if (is_array($count) && count($count) >= $promotionRule['rules'][0]['apply_time_peruser']) {
						return array('errCode'=> -992, 'errMsg'=> "��Ǹ�����ѵ��{$promotionRule['rules'][0]['desc']}�������Ĵ������ޣ������ٲμӸû");
					}
				}
			}
			$promotion = $promotionRule['rules'][0];
			if ($newOrder['applytimes'] != $promotion['benefit_times']) {
				return array('errCode'=> -993, 'errMsg'=> "��Ǹ�����μӵĻ�ѽ�������ֹ���������ع��ﳵ���²���");
			}
			//����ǻ�����������Ʒ������Ҫ��items���һ����¼
			if ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_HUANGOU']
				|| $promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_PRODUCT']) {
				$promotionGiftProduct = array(
					'product_id'      => $promotion['discount'],
					'buy_count'       => $promotion['benefit_per_time'] * $promotion['benefit_times'],
					'main_product_id' => 0,
					'createtime'      => 0,
					'isPromotionGift' => true
				);
				$itemsInShoppingCart[] = $promotionGiftProduct;
			}
		}

		//���û���ײͣ��жϹ��ﳵ����Ʒ��ǰ̨չʾ����Ʒ������һ�µ�
		if(empty($suiteInfo))
		{
			if (count($itemsInShoppingCart) != $countPost) {
				self::$errCode = -2021;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "items count in shoppingcart is not equal to post items count";
				return false;
			}
		}

		//��ȡ���ﳵ�е���Ʒ����Ʒ&���
		$product_in_cart = array();
		$multiPriceProduct = array();
		foreach ($itemsInShoppingCart as $item) {
			$product_in_cart[] = $item['product_id'];
		}


		$product_base_info = IProduct::getProductsInfo($product_in_cart, $wh_id, true, true, $destination);
		if (false === $product_base_info) {
			self::$errCode = IProduct::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProduct failed]' . IProduct::$errMsg;
			return false;
		}

		self::Log("������Ʒ�µ�Ƶ�ʼ��", false);
		//������Ʒ�µ�Ƶ�ʼ��
		$ret = self::checkVisitFrequency($product_base_info, $newOrder);
		if (false === $ret) {
			return false;
		}

		//�����충����֤������
		/*
		if (self::DISPLAY_VERIFY_CODE) {
			self::Log("�����충����֤������");
			if ((!isset($newOrder['ls'])) || (!in_array($newOrder['ls'], array('--android--', '--mobile--')))) { //���� wap �� mobile app �Ķ�����������֤
				foreach ($product_base_info as $pid => &$p_info) {
					if (($p_info['flag'] & OTHER_TIME_LIMITED_RUSHING_BUY) == OTHER_TIME_LIMITED_RUSHING_BUY) { //����������Ʒ��������֤��
						if ((!isset($newOrder['verifycode'])) || empty($newOrder['verifycode']) || strlen(trim($newOrder['verifycode'])) < 4) {
							self::$errCode = -5001;
							self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[verifycode] invalid verify code';
							return false;
						}

						$verifyCodeRet = VerifyCode::verifycodeNum($newOrder['verifycode']);
						if ($verifyCodeRet === false) {
							self::$errCode = -5002;
							self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[verifycode] errMsg: " . VerifyCode::$errMsg . ", invalid {$newOrder['verifycode']}";
							return false;
						}

						//else ��֤ͨ��������ѭ��
						break;
					}
				}
			}
		}*/


		self::Log("�����۸���Ϣ");
		//�����۸���Ϣ
		$ret_mpi = IPreOrder::getMultiPriceInfo($items, $wh_id, $product_base_info, $suiteInfo);

		// ���ж�۸���Ϣ����Ʒ������Ϣ
		$product_base_info = $ret_mpi['products_mpi'];

		// ���ж�۸���Ϣ���ײ���Ϣ
		// $suiteInfo_mpi = $ret_mpi['suiteInfo_mpi'];

		self::Log("IPreOrder��ȡ��Ʒ��Ϣ");

		$ret = IPreOrder::getItemInfo($items, $wh_id, $product_base_info, $destination);
		if (false === $ret) {
			self::$errMsg = IPreOrder::$errMsg;
			self::$errCode = IPreOrder::$errCode;
			return false;
		}
		$items = $ret['items'];
		self::Log(ToolUtil::gbJsonEncode($items));


		// ��ֶ���
		$divideOrder = IPreOrder::DivideOrder($items, $wh_id);
		if (false === $divideOrder) {
			return false;
		}

		// �����İ�����Ϣ��������⣬����������İ�����Ϣ�ȵ�
		$isVirtual = $divideOrder['order']['isVirtual'];
		$bVirtual = array();

		$ret = self::checkAppointInfo($uid, $items);
		self::Log("���ԤԼ���" . var_export($ret, true));

		if ($ret == false) {
			return array('errCode'=> self::$errMsg, 'errMsg'=> self::$errCode);
		}


		//�����ļ۸�����
		if (true === $isDistribution) {
			self::Log("�����ļ۸�����");
			foreach($newOrder['suborders'] as $suborder)
			{
				foreach($suborder['items'] as $product)
				{
					foreach($product_base_info as $p)
					{
						if($p['product_id'] == $product['product_id'])
						{
							$product_base_info[$p['product_id']]['price'] = $product['price'];
							$product_base_info[$p['product_id']]['shopPrice'] = $product['shopPrice'];
						}
					}
				}
			}
		}

		$rule_discount = 0;
		if (isset($promotion['benefit_type'])) {
			//����
			if ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_HUANGOU'] &&
				isset($product_base_info[$promotion['discount']])){
				$dis = ($product_base_info[$promotion['discount']]['price'] >= $promotion['plus_con'])? ($product_base_info[$promotion['discount']]['price'] - $promotion['plus_con']) : 0;
				$rule_discount = $promotion['benefit_times'] * $promotion['benefit_per_time'] * $dis;
			}//������Ʒ
			else if ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_PRODUCT'] &&
				isset($product_base_info[$promotion['discount']])) {
				$rule_discount = $product_base_info[$promotion['discount']]['price'] * $promotion['benefit_times'] * $promotion['benefit_per_time'];
			}else if ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_CASH'])
			{
				$rule_discount = $promotion['benefit_times'] * $promotion['benefit_per_time'];
			}else if ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_DISCOUNT'])
			{
				$rule_discount = $promotion['discount'];
			}
		}

		//��ȡ��Ʒ&��Ʒ&�����Ϣ����
		//���ǰ̨�������Ʒ�б� �� ���ﳵ����Ʒ�б��Ƿ�һ�� , ͬʱ�����Ʒ����Ʒ�������״̬����������
		$restricted_trans_type = array();
		$shoppingProduct = array();
		$productInShoppingCart = array();

		self::Log("���ǰ̨�������Ʒ�б� �� ���ﳵ����Ʒ�б��Ƿ�һ��");
		//ͬʱ����ܷ�ģ����Ʊ������ֵ��Ʊ
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
					if ($orderItem['product_id'] == $itemInCart['product_id'] ) {
						//����������һ��
						if ($orderItem['num'] != $itemInCart['buy_count']) {
							return array('errCode'=> -1, 'errMsg'=> "���ﳵ����Ʒ" . $product_base_info[$itemInCart['product_id']]['name'] . "������������ȷ���뷵�ع��ﳵ�޸�����");
						} //��Ʒ������Ϣ������
						else if (!isset($product_base_info[$orderItem['product_id']])) {
							return array('errCode'=> -2, 'errMsg'=> "���ﳵ����Ʒ" . $product_base_info[$itemInCart['product_id']]['name'] . "�ݲ����ۣ��뷵�ع��ﳵɾ��");
						} //��Ʒ״̬���Ϸ�
						else if (isset($product_base_info[$orderItem['product_id']]['status']) && $product_base_info[$orderItem['product_id']]['status'] != PRODUCT_STATUS_NORMAL /*&& true != $itemInCart['isPromotionGift'] */) {
							return array('errCode'=> -3, 'errMsg'=> "���ﳵ����Ʒ" . $product_base_info[$itemInCart['product_id']]['name'] . "�ݲ����ۣ��뷵�ع��ﳵɾ��");
						} else if ($product_base_info[$orderItem['product_id']]['psystock'] != $subOrderKey) {
							return array('errCode'=> -3, 'errMsg'=> "���ﳵ����Ʒ" . $product_base_info[$itemInCart['product_id']]['name'] . "��Ϣ�Ѿ��ı䣬��ˢ��ҳ��");
						}
						else
						{
							$shoppingProduct[$subOrderKey][$itemInCart['product_id']]['product_id'] = $itemInCart['product_id'];
							$shoppingProduct[$subOrderKey][$itemInCart['product_id']]['OTag'] = $itemInCart['OTag'];
							@$shoppingProduct[$subOrderKey][$itemInCart['product_id']]['buy_count'] += $itemInCart['buy_count'];
							//	$shoppingProduct[$subOrderKey][$itemInCart['product_id']]['wh_id'] = $itemInCart['wh_id'];
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
					return array('errCode'=> -4, 'errMsg'=> "���ﳵ����Ʒ" .
						(isset($product_base_info[$orderItem['product_id']]) ? $product_base_info[$orderItem['product_id']]['name'] : $orderItem['product_id'])
						. "�����ڣ��뷵�ع��ﳵɾ������Ʒ");
				}


				//�鿴����Ʒ���͵���Ʒ&����Ƿ�ƥ��
				foreach ($orderItem['gift'] as $g_p_id)
				{
					if (!isset($product_base_info[$orderItem['product_id']]['gifts'][$g_p_id])) {
						return array('errCode'=>-5, 'errMsg'=>"���ﳵ����Ʒ/���" . $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['name'] . "��ʱ�޻����뷵�ع��ﳵɾ��");
					}//��Ʒ״̬���Ϸ�
					else if ( isset($product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['status']) &&  $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['status'] == PRODUCT_STATUS_NORMAL) {
						return array('errCode'=>-6, 'errMsg'=>"���ﳵ����Ʒ/���" . $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['name'] . "��ʱ�޻����뷵�ع��ﳵɾ��");
					}/*else if ($product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['psystock'] != $subOrderKey) {
						return array('errCode'=>-6, 'errMsg'=>"���ﳵ����Ʒ/���" . $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['name'] . "��Ϣ�Ѹı䣬��ˢ��ҳ��");
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

		self::Log("��֤�Ƿ���Կ���ֵ˰��Ʊ");
		//����Ƿ�������������Ҫ��֤�Ƿ���Կ���ֵ˰��Ʊ
		if(false === $isDistribution)
		{
			if ($isCanVATInvoice === false && $newOrder['invoiceType'] == INVOICE_TYPE_VAT) {
				return array('errCode'=> -20, 'errMsg'=> '���Ķ���������Ʒ���ܿ���ֵ˰��Ʊ');
			}
		}

		// android ����վ������Ʊת��
		if (isset($newOrder['ls']) && in_array($newOrder['ls'], array('--android--')) && $wh_id == SITE_SZ) {
			if ($newOrder['invoiceType'] == INVOICE_TYPE_RETAIL_COMPANY || $newOrder['invoiceType'] == INVOICE_TYPE_RETAIL_PERSONAL)
				$newOrder['invoiceType'] = INVOICE_TYPE_VAT_NORMAL;
			}

		//���ѡ���������񣬲���ѡ���������

		self::Log("��֤ѡ��������װ");
		//ѡ��������װ������ѡ���������
		global $_PAY_MODE;
		if ($_PAY_MODE[$wh_id][$newOrder['payType']]['PayTypeName'] == '��������') {
			global $_NotPayWhenArrive;
			$bothExist = array_intersect($_NotPayWhenArrive, $productInShoppingCart);
			if (count($bothExist) != 0) {
				return array('errCode'=> -22, 'errMsg'=> '��ѡ����������װ���񣬲���ѡ���������֧����ʽ');
			}
		}

		//���ĳЩ���ⲻ�����ڹ��ﳵ�У�����ѡ�������
		//�����������Щ������Ʒ����Ҫ�޳�����

		self::Log("��֤ѡ������");
		global $_SelfFetchProductids;
		global $_LGT_MODE;
		//���ѡ������������᷽ʽ����Ҫ��⹺�ﳵ�д����ض���Ʒ
		if (false !== strpos($_LGT_MODE[$newOrder['shipType']]['ShipTypeName'], '�������')) {
			$bothExist = array_intersect($_SelfFetchProductids, $productInShoppingCart);
			if (count($bothExist) == 0) {
				return array('errCode'=> -29, 'errMsg'=> '�Բ��������������Ʒ����ѡ���������');
			}
		}

		self::Log("��֤���ύ��Ʊ����");
		$invoinceContent = IPreOrder::getInvoicesContentOpt($c3ids, $wh_id);
		if($newOrder['isVat'] == self::HAS_INVOICE)
		{
			if (!in_array($newOrder['invoiceContent'], $invoinceContent)) {
				return array('errCode'=>-21, 'errMsg'=>'���ύ��Ʊ���ݲ��Ϸ�');
			}
		}

		//ɾ����������0�������ˣ�
		unset($restricted_trans_type[0]);
		unset($gifts);
		//���ǰ̨����Ĺ��ﳵ���� �� ��̨���ﳵ���� һ�����


		//�Ż�ȯ���
		self::Log("�Ż�ȯ���");
		$couponInfo = array('amt'=>0, 'code'=>'', 'type'=>0);
		if (isset($newOrder['couponCode']) && $newOrder['couponCode'] != "" ) {
			if ( (isset($newOrder['ls'])) && ( in_array($newOrder['ls'], array('--android--','--iphone--'))) )
			{
				$couponInfo = ICoupon::checkAppCoupon($uid, $newOrder['couponCode'], $newOrder['receiveAddrId'], $newOrder['payType'] ,$wh_id,$itemsInShoppingCart);
			}
			else if (in_array($newOrder['ls'], array('--mobile--'))) {
				$couponInfo = ICoupon::checkCoupon($uid, $newOrder['couponCode'], $newOrder['receiveAddrId'], $newOrder['payType'] ,$wh_id, 1);
			}
			else {
				$couponInfo = ICoupon::checkCoupon($uid, $newOrder['couponCode'], $newOrder['receiveAddrId'], $newOrder['payType'] ,$wh_id, 0);
			}
			if (false === $couponInfo) {
				self::$errCode = ICoupon::$errCode;
				self::$errMsg = ICoupon::$errMsg;
				return array('errCode' => self::$errCode, 'errMsg' => self::$errMsg);
			}
		}
		/**ȥ���齱�߼�
		$hasActProduct = false;**/
		//��ʼ����EDMר��
		//���ж�EDM�Ƿ���ҪУ��
		self::Log("��ʼ����EDMר��");
		$product_base_info = IPreOrder::getEDMInfo($userInfo, $wh_id, $product_base_info);
		if (false === $product_base_info) {
			self::$errCode = IPreOrder::$errCode;
			self::$errMsg = IPreOrder::$errMsg;
			return false;
		}

		//�����ʼ�ר��۸����

		$pointMax = 0;
		$pointMin = 0;
		global $_OrderState;
		$limitedProduct = array();

		self::Log("��ȡ���û��ַ�Χ");
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
					return array('errCode'=> -9, 'errMsg'=> "���ﳵ����Ʒ" . $product_base_info[$item['product_id']]['name'] . "�ݲ����ۣ��뷵�ع��ﳵɾ��");
				}
				$p = $product_base_info[$item['product_id']];


				if ($p['num_limit'] > 0 && $p['num_limit'] < 999) {
					if ($p['num_limit'] < $item['buy_count']) {
						return array('errCode'=> -8, 'errMsg'=> "���ﳵ����Ʒ" . $product_base_info[$item['product_id']]['name'] . "�����޹�����" . $p['num_limit']);
					}
					$limitedProduct[$p['product_id']] = $subOrderKey;
				}

				if ($p['point_type'] != PRODUCT_CASH_PAY_ONLY) {
					$pointMax += ($p['price'] /*+ $p['cash_back'] */) * $shoppingProduct[$subOrderKey][$p['product_id']]['buy_count'];
				}
				if ($p['point_type'] == PRODUCT_POINT_PAY_ONLY) {
					$pointMin += $p['price'] * $shoppingProduct[$subOrderKey][$p['product_id']]['buy_count'];
				}

			}
		}

		//������ﳵ����Ʒ���޹���Ʒ�����ѯ���û�����Ķ���
		//���ﲿ��������Ҫ�޸ķֿ�ֱ������
		self::Log("����޹���Ʒ");
		$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
		if (false === $isDistribution && !empty($limitedProduct)) {
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
						return array('errCode'=>-11, 'errMsg'=>"���ﳵ����Ʒ" . $product_base_info[$order['product_id']]['name'] . "���޹���Ʒ�������չ��������Ѿ������޹�����");
					}
					else if ($order['buy_num'] + $shoppingProduct[$limitedProduct[$order['product_id']]][$order['product_id']]['buy_count'] > $product_base_info[$order['product_id']]['num_limit']) {
						return array('errCode'=>-12, 'errMsg'=>"���ﳵ����Ʒ" . $product_base_info[$order['product_id']]['name'] .
							"���޹���Ʒ�������ջ��ܹ���" . ($product_base_info[$order['product_id']]['num_limit'] - $order['buy_num']) . "��" );
					}
				}
			}
		}

		self::Log("��ʼ�����");
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

		self::Log("��Ʒ");

		reset($shoppingProduct);
		while (FALSE != ($subOrderItem = current($shoppingProduct))) {
			$subOrderKey = key($shoppingProduct);
			next($shoppingProduct);

			foreach ($subOrderItem as $kk => $sp)
			{
				//��ȡ��������Ʒ������Ʒ
				if ($sp['type'] === SHOPPING_CART_PRODUCT_TYPE_NORMAL && $sp['main_product_id'] != 0) {
					$easyKey[$sp['main_product_id']] = $sp['main_product_id'];
				}
				//��ȡ��������Ʒ������Ʒ

				$exist = false;
				foreach ($productStocks as $pstock)
				{
					if ($sp['product_id'] == $pstock['ProductSysNo'] && $subOrderKey == $pstock['StockSysNo']) {
						$exist = true;
						if (($pstock['AvailableQty'] + $pstock['VirtualQty'] <= 0) && $sp['type'] != SHOPPING_CART_PRODUCT_TYPE_GIFT) {
							IInventoryStockTTC::update(array('product_id'=>$sp['product_id'], 'num_available'=>$pstock['AvailableQty'], 'virtual_num'=> $pstock['VirtualQty']), array('sys_no'=>$pstock['SysNo']));
							if($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_ZUJIAN)
							{
								return array('errCode'=>-15, 'errMsg'=>'���'.$product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name']."��治��,����ϵ�ͷ�");
							}
							return array('errCode'=>-14, 'errMsg'=>'��Ʒ'.$product_base_info[$sp['product_id']]['name']."��治��");
						}
						if ($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_GIFT) //��Ʒ
						{
							if ($pstock['AvailableQty'] + $pstock['VirtualQty'] < $sp['buy_count']) {
								IInventoryStockTTC::update(array('product_id'=> $sp['product_id'], 'num_available'=> $pstock['AvailableQty'], 'virtual_num'=> $pstock['VirtualQty']), array('sys_no'=> $pstock['SysNo']));
								if (!isset($newOrder['ingoreLackOfGift'])) { //�����һ���ύ����
									$giftLackOfStock[$sp['product_id']] = $product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name'];
								} else if ($newOrder['ingoreLackOfGift'] == 1) { //�û�����ȱ����Ʒ
									$shoppingProduct[$subOrderKey][$kk]['buy_count'] = $pstock['AvailableQty'] + $pstock['VirtualQty'];
									if ($shoppingProduct[$subOrderKey][$kk]['buy_count'] <= 0) {
										unset($shoppingProduct[$subOrderKey][$kk]);
									}
									$lackGiftAndIgnore = true;
								} else //�û������ܣ���ܾ��µ�
								{
									return array('errCode'=> -13, 'errMsg'=> '��Ʒ' . $product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name'] . "��治��");
								}
							}
						} else if ($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_ZUJIAN) {
							if ($pstock['AvailableQty'] + $pstock['VirtualQty'] < $sp['buy_count']) {
								return array('errCode'=> -15, 'errMsg'=> '���' . $product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name'] . "��治��,����ϵ�ͷ�");
							}
						} else //����Ʒ
						{
							if ($pstock['AvailableQty'] < $sp['buy_count']) {
								$bVirtual[$subOrderKey] = true;

							}
							if (($pstock['AvailableQty'] + $pstock['VirtualQty'] < $sp['buy_count']) &&
								(($wh_id != 1) || ($product_base_info[$sp['product_id']]['flag'] & FORBID_SET_VIRTUAL) == FORBID_SET_VIRTUAL ||
									$product_base_info[$sp['product_id']]['type'] != PRODUCT_TYPE_NORMAL)
							) {
								return array('errCode'=> -15, 'errMsg'=> '��Ʒ' . $product_base_info[$sp['product_id']]['name'] . "��治��");
							}
						}
						$product_base_info[$sp['product_id']]['AvailableQty'] = $pstock['AvailableQty'];
						$product_base_info[$sp['product_id']]['VirtualQty'] = $pstock['VirtualQty'];
						break;
					}
				}
				if (false === $exist) {
					return array('errCode'=> -16, 'errMsg'=> '��Ʒ' . $product_base_info[$sp['product_id']]['name'] . "�ݲ�����");
				}
			}
		}


		if (count($giftLackOfStock) != 0) {
			$errMsg = "���ﳵ����Ʒ:";
			foreach ($giftLackOfStock as $key=>$name)
			{
				$errMsg .= $name . "��治��,"; //��ʣ��" . $num ."��,";
			}
			$errMsg .= "�Ƿ�����µ�?";
			return array('errCode'=> -100, 'errMsg'=> $errMsg);
		}

		// �����ʾ
		if ($lackGiftAndIgnore) {
			$newOrder['comment'] .= "\nϵͳ�Զ���ע���û��ѽ���ȱ����Ʒ��治�㡣";
		}

		//��������

		//����������
		self::Log("����������");
		global $_District;
		$shipTypeNotAva = IShipping::getForbidenShippingType($restricted_trans_type, $_District[$newOrder['receiveAddrId']]['province_id'], $_District[$newOrder['receiveAddrId']]['city_id'], $newOrder['receiveAddrId'], $wh_id);
		if (false === $shipTypeNotAva) {
			self::$errCode = -2031;
			self::$errMsg = '��ȡ��������->���ͷ�ʽʧ��';
			return false;
		}

		$shipTypeNotAva = array_keys($shipTypeNotAva);
		if (in_array($newOrder['shipType'], $shipTypeNotAva)) {
			return array('errCode'=> -17, 'errMsg'=> "���ﳵ������Ʒ��֧����ѡ������ͷ�ʽ");
		}
		//����������ʧ��

		//��ȡ������
		//ixiuzeng��ӣ��㶫վ��������ӹ㶫վ��ȡ���Ϻ��ͱ�������������Ȼ���Ϻ���ȡ
		$wh_id_temp = NULL;
		if (1001 == $wh_id) {
			$wh_id_temp = 1001;
		}
		else {
			$wh_id_temp = 1;
		}
		self::Log("������", false);
		$easyMatch = IProductRelativityTTC::gets($easyKey, array('type'=> PRODUCT_BY_MIND, 'status'=> 1, 'wh_id' => $wh_id_temp));
		if (false === $easyKey) {
			self::$errCode = IProductRelativityTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductRelativityTTC failed]' . IProductRelativityTTC::$errMsg;
			return false;
		}

		//��ȡ��������Ʒ����
		//����������Ӧ���Żݵļ۸�&����
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
						//������Ҫ����������Ʒ�ĳɱ��۱Ƚ�ô�� ���Ƚ�̫Σ����
						$shoppingProduct[$subOrderKey][$sp['product_id']]['cashCutPerItem'] = $cashCut;
						break;
					}
				}
			}
		}
		//�����������

		//����۸�
		$orderPrice = 0;
		$totalWeight = 0;
		$totalCut = 0;

		global $_ProductType;
		global $ProductForNongHang;
		$subOrders = array();
		$has_service = false;

		foreach ($shoppingProduct as $subOrderKey => $subOrderItem) {
			foreach ($subOrderItem as $sp) {
				$subOrders[$subOrderKey]['product_ids'][] = $sp['product_id']; //clark ��¼��ƷID

				$totalWeight += $sp['buy_count'] * $product_base_info[$sp['product_id']]['weight'];
				@$subOrders[$subOrderKey]['totalWeight'] += $sp['buy_count'] * $product_base_info[$sp['product_id']]['weight'];

				if (!isset($subOrders[$subOrderKey]['flag'])) {
					$subOrders[$subOrderKey]['flag'] = 0;
				}

				if ($product_base_info[$sp['product_id']]['type'] == $_ProductType['Service']) {
					$subOrders[$subOrderKey]['flag'] |= ORDER_HAS_SERVICE; //��¼�������Ƿ��з�������Ʒ
					$has_service = true;
				}

				if (in_array($sp['product_id'], $ProductForNongHang)) {
					$subOrders[$subOrderKey]['flag'] |= ORDER_NONGHANG; //�����а���ũ����Ʒ
					$newOrder['isVat'] = self::NO_INVOICE; //�򲻿���Ʊ
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

				if ($sp['type'] != SHOPPING_CART_PRODUCT_TYPE_NORMAL) {
					continue;
				}

				@$subOrders[$subOrderKey]['orderPrice'] += $product_base_info[$sp['product_id']]['price'] * $sp['buy_count'];
				$orderPrice += $product_base_info[$sp['product_id']]['price'] * $sp['buy_count'];

				if ($sp['main_product_id'] > 0 && $sp['matchNum'] > 0) {
					$orderPrice -= $sp['matchNum'] * $sp['cashCutPerItem'];
					@$subOrders[$subOrderKey]['orderPrice'] -= $sp['matchNum'] * $sp['cashCutPerItem'];

					$totalCut += $sp['matchNum'] * $sp['cashCutPerItem'];
					@$subOrders[$subOrderKey]['totalCut'] += $sp['matchNum'] * $sp['cashCutPerItem'];
				}

				//ixiuzeng��ӣ������к����ײ�ʱ���Żݼ۸���뷵��ֵ
				if(isset($itemsInShoppingCart[$sp['product_id']]))
				{
					@$orderPrice -= $itemsInShoppingCart[$sp['product_id']]['cash_back'];
					@$subOrders[$subOrderKey]['orderPrice'] -= $itemsInShoppingCart[$sp['product_id']]['cash_back'];

					@$totalCut += $itemsInShoppingCart[$sp['product_id']]['cash_back'];
					@$subOrders[$subOrderKey]['totalCut'] += $itemsInShoppingCart[$sp['product_id']]['cash_back'];
				}

				//ixiuzeng���,�����к�����ʱ�������߶�����Ʒ������һ����־λ
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

				// ����ǽ��ܲ�����Ʒ�����Ҳ��������Ϣ���������ж�Ϊ���ܲ�������
				
                if (PRODUCT_ENERGY_SUBSIDY == ($product_base_info[$sp['product_id']]['flag'] & PRODUCT_ENERGY_SUBSIDY)
                    && $promotionRule != false)
                {
                    if(self::esInfoCheck($newOrder))
                    {
                        $is_energy_subsidy_order = TRUE;
                        if (!isset($subOrders[$subOrderKey]['flag'])) {
                            $subOrders[$subOrderKey]['flag'] = ORDER_ENERGY_SUBSIDY;
                        }
                        else {
                            $subOrders[$subOrderKey]['flag'] = $subOrders[$subOrderKey]['flag'] | ORDER_ENERGY_SUBSIDY;
                        }
                    }
                    else
                    {
                        return array('errCode' => 6002,'errMsg'=> "ʹ���˽��ܲ����Żݣ�����û�������Ϣ����Ϣ����");
                    }
                }
			}
		}
		if (true === $has_service) //������������ඩ���������е��Ӷ�����flag����Ϊ���ඩ��
		{
			foreach($subOrders as $key => $so)
			{
				$subOrders[$key]['flag'] |= ORDER_HAS_SERVICE;
			}
		}

		if ($newOrder['payType'] == 1) { //��������Ĩȥ��
			$orderPrice = 0;
			foreach ($subOrders as $subOrderKey => $so) {
				$subOrders[$subOrderKey]['orderPrice'] = 10 * bcdiv($subOrders[$subOrderKey]['orderPrice'], 10, 0);
				$orderPrice += $subOrders[$subOrderKey]['orderPrice'];
			}
		}
		self::Log("����Ķ����۸���ǰ̨�����۸�Ƚ�", false);
		if (bccomp($orderPrice, $newOrder['Price'], 0) != 0) {
			self::$errCode = -2031;
			self::$errMsg = $orderPrice . '����Ķ����۸���ǰ̨�����۸�һ��' . $newOrder['Price'];
			return false;
		}

		foreach ($subOrders as $subOrderKey=> $so) {
			if (bccomp($so['orderPrice'], $newOrder['suborders'][$subOrderKey]['price'], 0) != 0) {
				self::$errCode = -2030;
				self::$errMsg = '����Ķ����۸���ǰ̨�����۸�һ��';
				return false;
			}
		}

		$pointMax -= $totalCut;
		$pointMax /= 10;
		$pointMax = ceil($pointMax < $orderPrice ? $pointMax : $orderPrice);
		$pointMax *= 10;
		$pointMin = ceil($pointMin);
		//����۸����

		self::Log("������ʹ�����", false);
		//������ʹ�����
		if ($newOrder['point'] < $pointMin || $newOrder['point'] > $pointMax) {
			return array('errCode'=> -10, 'errMsg'=> "�����ζ���������ʹ��" . ($pointMin / 10) . "������,�����ʹ��" . ($pointMax / 10) . "������");
		}

		//��ȡ�û����֣�ȷ���û�ʹ�õĻ��ֲ�������ӵ�еĻ���,������ֱ���Ҫ���ֽ���ֺʹ������֣�����ʹ���ֽ����
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
				return array('errCode'=>-34, 'errMsg'=>"���˻������ܶ�Ϊ{$userInfo['point']}�����ֻ��ʹ��{$userInfo['point']}������");
			}
		}

		//���ʹ���˴������򣬻����Ż�ȯ
		if (isset($promotion['benefit_type'])) {
			$couponInfo['code'] = "rule_{$promotion['rule_id']}";
			$couponInfo['type'] = $promotion['account_type'];
			$couponInfo['amt'] = $rule_discount;
			$couponInfo['subOrders'] = array();
			//�����ϴ����������Ʒ���Ӷ�������

			$promotionAmt = 0;
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
			//��̯�Ż�ȯ�������ӵ�
			if ($couponInfo['amt'] == 0) {
				foreach ($couponInfo['subOrders'] as $key=> $so) {
					$couponInfo['subOrders'][$key]['coupon_amt'] = 0;
				}
			}
			else {
				$remain = $couponInfo['amt'];
				ksort($couponInfo['subOrders']);
				foreach ($couponInfo['subOrders'] as $key=> $so) {
					$tmp = 10 * bcdiv($so['orderAmt'] * $couponInfo['amt'], 10 * $promotionAmt, 0);
					$couponInfo['subOrders'][$key]['coupon_amt'] = $tmp;
					$remain -= $tmp;
				}
				if (0 != $remain) {
					$couponInfo['subOrders'][$key]['coupon_amt'] += $remain;
				}
			}
		}
		//unset($itemsInShoppingCart);

		$product_cash = $orderPrice - $newOrder['point'] - $couponInfo['amt'];
		if ( bccomp( $product_cash, 0, 0 ) < 0 )
		{
			//if($newOrder['point']==0 && $couponInfo['amt'] !=0 ) //���ֻ�����Ż�ȯ��û��ʹ�û��֣�����ۼ�Ϊ��ֵ
			//{
			//�޸���ICoupon::checkCoupon���Ż�ȯ�Żݽ����߼�֮�󣬲������ֻ�����Ż�ȯʱ���������Ϊ��ֵ�����
			//�������Լ���̯����ʱ��ʹ���Ż�ȯ���Ϊʵ�ʵֿ۵Ľ��
			// $couponInfo['amt'] = $orderPrice;
			// foreach ($subOrders as $subOrderKey => $so)
			// {
			// $couponInfo['subOrders'][$subOrderKey]['coupon_amt'] = $subOrders[$subOrderKey]['orderPrice'];
			// }
			//}
			//else  // ��� Ӧ����Ʒ�۸� С��0��bccomp����ֵΪ-1�������ش���
			//{
			self::$errCode = -2040;
			self::$errMsg = '�û�ʵ����Ҫ֧���Ļ�����Ϊ����';
			return false;
			//}
		}

		//��ʼ�����˷ѣ����ü����˷ѽӿ�
		$is_mobile = (!empty($newOrder['ls']) && in_array($newOrder['ls'], self::$AppLS)) ? true : false;
		$price_without_point = $orderPrice - $couponInfo['amt'];
		$user_level = empty($userInfo['level']) ? 0 : $userInfo['level'];

		$shipInfo = array(
			'shipping_id' => $newOrder['shipType'], //���ͷ�ʽid
			'wh_id'       => $wh_id, //��ʼվ��
			'destination' => $destination, //�ջ����
			'order_price' => $price_without_point, //������֧���Ľ��(ȥ���Ż�ȯ�Ľ��)
			'is_mobile'   => $is_mobile, //�Ƿ����ֻ�����
			'user_level'  => $user_level, //�û��ȼ�
		);

		//��ȡ���ﳵ����Ʒ������
		foreach ($subOrders as $subOrderKey => $so) {
			$shipInfo['order_info'][$subOrderKey]['weight'] = $so['totalWeight'];
		}

		self::Log("�˷�");
		$shipPriceInfo = EA_ShippingPrice::get($shipInfo);

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
		//�˷Ѽ������

		if (bccomp($newOrder['shippingPrice'], $orderShipPrice, 0) != 0) {
			self::$errCode = -2038;
			self::$errMsg = 'web������˷�:' . $newOrder['shippingPrice'] . '��̨���¼�����˷�:' . $orderShipPrice . '����Ķ����˷Ѽ۸���ǰ̨�����˷Ѽ۸�һ��';
			return false;
		}
		//��Ʊ���������˷�,ǰ̨���˵������
		if (isset($newOrder['separateInvoice']) && $newOrder['separateInvoice'] == 1) {
			$orderShipPrice += 1000;
			foreach ($subOrders as $subOrderKey => $so) {
				$subOrders[$subOrderKey]['orderShipPrice'] += 1000;
			}
		}
		foreach ($subOrders as $subOrderKey => $so) {
			if ($so['orderShipPrice'] < 0) {
				self::$errCode = -2044;
				self::$errMsg = '�����˷Ѽ���ʧ��';
				return false;
			}
			// else if (bccomp($so['orderShipPrice'], $newOrder['suborders'][$subOrderKey]['shipPrice'], 0) != 0) {
			// self::$errCode = -2038;
			// self::$errMsg='web������˷�:' . $newOrder['suborders'][$subOrderKey]['shipPrice'] . '��̨���¼�����˷�:' . $so['orderShipPrice'] . '����Ķ����˷Ѽ۸���ǰ̨�����˷Ѽ۸�һ��';
			// return false;
			// }
		}

		$cash = $orderShipPrice + $product_cash;

		//��ʼ��̯�Ż�ȯ&
		self::Log("��ʼ��̯�Ż�ȯ����");
		if ($newOrder['point'] > 0) {
			ksort($subOrders);
		}
		//��̯�Ż�ȯ����Ʒ
		if ($couponInfo['amt'] > 0) {
			foreach ($subOrders as $subOrderKey => $so) {
				$subOrders[$subOrderKey]['couponamt'] = $couponInfo['subOrders'][$subOrderKey]['coupon_amt'];
			}

			foreach ($couponInfo['subOrders'] as $subKey=> $so) {
				$remain = $so['coupon_amt'];
				foreach ($so['pids'] as $pid) {
					@$couponInfo['subOrders'][$subKey]['apport'][$pid] = 10 * bcdiv($so['coupon_amt'] * $shoppingProduct[$subKey][$pid]['buy_count'] * $product_base_info[$pid]['price'], 10 * $so['orderAmt'], 0);
					$remain -= $couponInfo['subOrders'][$subKey]['apport'][$pid];
				}
				if ($remain > 0) {
					$couponInfo['subOrders'][$subKey]['apport'][$pid] += $remain;
				}
			}
		}

		//��̯����
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
			//������̯��������ʣ�µĲ���
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

			//��̯�ֽ���ֺʹ�������
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
		//������Բ�����Ѹ��ݣ�У���ͻ�ʱ��
		if (ICSON_DELIVERY == $newOrder['shipType']) {
			self::Log("��Ѹ��ݣ�У���ͻ�ʱ��");

			$icson_delivery_info = IShipping::getIcsonDeliveryInfoByRegion($newOrder['receiveAddrId'], $wh_id);

			if (false === $icson_delivery_info) {
				self::$errCode = IShipping::$errCode;
				self::$errMsg = IShipping::$errMsg;
				return false;
			}

			foreach ($shoppingProduct as $subOrderKey=> $subOrderItem) {
				self::Log(ToolUtil::gbJsonEncode($subOrderItem));

				$icson_delivery_info['stock_num'] = $subOrderKey; // �����ֺ�
				$icson_delivery_info['expect_ship_date'] = $newOrder['suborders'][$subOrderKey]['expectDate']; // ��������
				$icson_delivery_info['expect_time_span'] = $newOrder['suborders'][$subOrderKey]['expectSpan']; // ����ʱ��

				// �ֻ��˵�����isVirtual���� true false �ķ�ʽ
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
					self::$errMsg = basename(__FILE__) . "����֤����ʱ�����" . IShippingTime::$errMsg . ",subOrderItem" . var_export($subOrderItem, true);
					return array('errCode' => IShippingTime::$errCode, "errMsg" => IShippingTime::$errMsg);
				}
			}
		}

		//��ʼ�µ����������� ����orderdb�� �� mssql ��棬 commit����or callback����
		//��ȡ�¶�����
		self::Log("��ȡ�¶�����");
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
		//��ȡ������Ʊid
		$invoice_id = IIdGenerator::getNewId('so_valueadded_invoice_sequence', $orderNum);
		if (false === $invoice_id) {
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return false;
		}

		//��ȡ������id
		// �����������
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
				self::$errMsg = '��ȡ����������seqʧ��' . IIdGenerator::$errMsg;
				return false;
			}
		}
		//��ȡ������Ʒ��seqid
		$itemStartID = IIdGenerator::getNewId('So_Item_Sequence', $itemCount);
		if (false === $itemStartID) {
			self::$errCode = -2047;
			self::$errMsg = '��ȡ������Ʒidʧ��' . IIdGenerator::$errMsg;
			return false;
		}

		//�������ŵ������ַ�
		foreach ($newOrder as $k => $no) {
			if ($k == 'suborders' || $k == 'buy_one_key' || $k == 'send_coupon_success_info' || $k == 'send_coupon_record_info') {
				continue;
			}
			$newOrder[$k] = addslashes($no);
		}

		if (0 == $newOrder['isVat']) //�������Ҫ����Ʊ����ô�����ֶ�Ҳ��Ϊ��
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



		self::Log("����orderdb����ʧ��");
		$sql = "begin transaction";
		$ret = $orderDb->execSql($sql);
		if (false === $ret) {
			self::$errCode = -2032 . " " . $orderDb->errCode;
			self::$errMsg = '����orderdb����ʧ��' . $orderDb->errMsg;
			return false;
		}

		$ORS_Report_Data = array();
		//��������˲𵥣����븸����
		$now = time();
		global $_PAY_MODE, $_OrderState;
		if ($orderNum > 1) {
			self::Log("�����˲𵥣����븸����");

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
				'prcd_cost'           => 0, //������
				'order_cost'          => $orderShipPrice + $orderPrice + $totalCut, //�˷�+��Ʒ�ܼ�+�������䣩
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
				'synFlag'             => 0, //��������ͬ����ERP
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
			$ret = $orderDb->insert("t_orders_{$db_tab_index['table']}", $newItem);
			if (false === $ret) {
				self::$errCode = -2033;
				self::$errMsg = 'ִ��sql���ʧ��' . $orderDb->errMsg;
				$sql = "rollback";
				$orderDb->execSql($sql);
				return false;
			}


			$newOrderId++;
		}

		// ����������
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
			'qq' => '', //(�˴��ÿ�)
			'whid' => $wh_id,
			'ordertime' => $now,
			'vk' => $newOrder['visitkey'], //visit key
			'ip' => '', //�Ժ󲹳�
			'recv_province' => '', //�ջ�ʡ��
			'recv_city' => '', //�ջ�����
			'recv_region' => $newOrder['receiveAddrId'], //�ջ�����
			'raddr' => $newOrder['receiveAddrDetail'], //�ջ���ַ
			'rname' => $newOrder['receiver'], //�ջ�������
			'rphone' => $newOrder['receiverMobile'], //�ջ��˵绰
			'point' => $newOrder['point'], //ʹ�õĻ���
			'osrc' => isset($newOrder['ls']) ? $newOrder['ls'] : '', //������Դ
			'payid' => $newOrder['payType'], //֧����ʽID
			'payname' => '', //֧����ʽ
			'coutype' => $couponInfo['type'], //�Ż�����
			'couamt' => $couponInfo['amt'], //�Żݽ��
			'shipid' => $newOrder['shipType'], //���ͷ�ʽID
			'shipname' => isset($_LGT_MODE[ $newOrder['shipType'] ]) ? $_LGT_MODE[ $newOrder['shipType'] ]['ShipTypeName'] : '', //���ͷ�ʽ����
			'invoice' => $newOrder['invoiceTitle'], //��Ʊ̧ͷ
		); //TAPD 5478549 �����ϱ� (����������Ϣ)

		//�ۼ���� & ��������
		$sql = "begin transaction";
		$ret = $msSQL->execSql($sql);
		if (false === $ret) {
			self::$errCode = -2035;
			self::$errMsg = '����ms sql����ʧ��' . $msSQL->errMsg;
			$sql = "rollback";
			$orderDb->execSql($sql);
			return false;
		}

		$timeNow = date('Y-m-d H:i:s', $now);

		//��¼���ϵ�Ʒ��ȯ����Ʒ����Ϣ
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
		foreach ($shoppingProduct as $subOrderKey => $subOrder) {
			$cash = $subOrders[$subOrderKey]['orderPrice']
						+ $subOrders[$subOrderKey]['orderShipPrice']
						- (isset($subOrders[$subOrderKey]['couponamt']) ? $subOrders[$subOrderKey]['couponamt'] : 0)
						- (isset($subOrders[$subOrderKey]['point']) ? $subOrders[$subOrderKey]['point'] : 0);
			$isPayed = ($cash <= 0 ? 1 : 0);

			$subOrders[$subOrderKey]['orderId'] = $newOrderId; //clark��¼����ID

			$oid = sprintf("%s%09d", "1", $newOrderId % 1000000000);

			//����ÿ��������ʹ�õĵ�Ʒ�����Ĺ����Լ�����
			$single_promotion_info = '';

			foreach ($subOrder as $sp)
			{
				if(isset($products_rules[$sp['product_id']]) && !empty($products_rules[$sp['product_id']]))
				{
					//��ʼ��װ$single_promotion_info��ֵ
					$rule_info = $products_rules[$sp['product_id']];
					foreach($rule_info['coupons_name'] as $name)
					{
						$single_promotion_info = $single_promotion_info . $name . " x " . $rule_info['count'] . "��;";
					}
					//self::Log(var_export($single_promotion_info,true));
				}
			}
			//��Ʊ����
			$bits = 0;
			if ($newOrder['separateInvoice'] == 1) {
				self::Log("��Ʊ����");
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
					'shipping_type'    => YT_DELIVERY, //Ŀǰֻ֧��Բͨ
					'shipping_cost'    => 1000, //��Ϊ��λ
					'order_date'       => $now,
					'wh_id'            => $wh_id,
					'stockNo'          => $subOrderKey,
				);
				$ret = $orderDb->insert("t_order_invoice_address_{$db_tab_index['table']}", $newInvAddr);
				if (false === $ret) {
					self::$errCode = -2050;
					self::$errMsg = 'ִ��sql���ʧ��' . $orderDb->errMsg;
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
				'prcd_cost'             => 0, //������
				'order_cost'            => $subOrders[$subOrderKey]['orderPrice'] + $subOrders[$subOrderKey]['orderShipPrice'] + (isset($subOrders[$subOrderKey]['totalCut']) ? $subOrders[$subOrderKey]['totalCut'] : 0), //�˷�+��Ʒ�ܼ�+�������䣩
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

			self::Log("���붩������");
			$ret = $orderDb->insert("t_orders_{$db_tab_index['table']}", $newItem);
			if (false === $ret) {
				self::$errCode = -2033;
				self::$errMsg = 'ִ��sql���ʧ��' . $orderDb->errMsg;
				$sql = "rollback";
				$msSQL->execSql($sql);
				$orderDb->execSql($sql);
				return false;
			}

			// �Ӷ������ݣ��Զ�������Ϊkey
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

			self::Log("���뷢Ʊ��");
			$ret = $orderDb->insert("t_order_invoice_{$db_tab_index['table']}", $newInv);
			if (false === $ret) {
				self::$errCode = -2050;
				self::$errMsg = 'ִ��sql���ʧ��' . $orderDb->errMsg;
				$sql = "rollback";
				$msSQL->execSql($sql);
				$orderDb->execSql($sql);
				return false;
			}

			$_local_ip = ToolUtil::getLocalIp(0);
			$_local_ip = explode('.', $_local_ip);
			$_inserter = empty($_local_ip[3]) ? 7 : intval($_local_ip[3]);

			foreach ($subOrder as $sp) {
				//�����������
				self::Log("�����������");
				if ($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL && $sp['main_product_id'] != 0) {
					$sql = "insert into t_order_match_{$db_tab_index['table']} values($match_id_start, '{$newOrderId}', {$sp['product_id']}, {$sp['main_product_id']},{$sp['matchNum']}, {$sp['cashCutPerItem']}, $now, $wh_id )";
					$ret = $orderDb->execSql($sql);
					if (false === $ret) {
						self::$errCode = -2036;
						self::$errMsg = 'ִ��sql���ʧ��' . $orderDb->errMsg;
						$sql = "rollback";
						$msSQL->execSql($sql);
						$orderDb->execSql($sql);
						return false;
					}
					++$match_id_start;
				}

				$buy_count_positive = $sp['buy_count'];
				$buy_count_negative = $sp['buy_count'] * (-1);
				foreach ($productStocks as $pstock) {
					if ($subOrderKey != $pstock['StockSysNo']) {
						continue;
					}
					if ($sp['product_id'] == $pstock['ProductSysNo']) {
						if ($pstock['AvailableQty'] + $pstock['VirtualQty'] >= $sp['buy_count']) { //���ô��ڹ�������
							$sql = "update Inventory_stock set AvailableQty = AvailableQty - {$sp['buy_count']}, OrderQty = OrderQty + {$sp['buy_count']}, rowModifydate='{$timeNow}' where AvailableQty+VirtualQty>={$sp['buy_count']} AND ProductSysNo={$sp['product_id']} and StockSysNo=$subOrderKey";
							$ret = $msSQL->execSql($sql);
							$cnt = $msSQL->getAffectedRows();
							if ((false === $ret) || (1 != $cnt)) {
								self::$errCode = -2047;
								self::$errMsg = "�ۼ�ms sql���ʧ��({$sp['product_id'] })" . $msSQL->errMsg;
								$sql = "rollback";
								$msSQL->execSql($sql);
								$orderDb->execSql($sql);
								return false;
							}

							//ixiuzeng��ӣ���Inventroy_Stock�Ŀ���޸ļ�¼���뵽Inventory_Flow����
							$sql = "insert into Inventory_Flow values
									($subOrderKey, {$sp['product_id']}, 1, $newOrderId, 2, $buy_count_negative,'$timeNow', '$timeNow',$_inserter),
									($subOrderKey, {$sp['product_id']}, 1, $newOrderId, 4, $buy_count_positive,'$timeNow', '$timeNow',$_inserter)";
							$ret = $msSQL->execSql($sql);
							$cnt = $msSQL->getAffectedRows();
							if ((false === $ret) || (2 != $cnt)) {
								self::$errCode = -2046;
								self::$errMsg = "����ms sql-Inventory_Flow��ʧ��({$sp['product_id'] })" . $msSQL->errMsg;
								$sql = "rollback";
								$msSQL->execSql($sql);
								$orderDb->execSql($sql);
								return false;
							}

						}
						else if(($wh_id == 1) && (($product_base_info[$sp['product_id']]['flag'] & FORBID_SET_VIRTUAL) != FORBID_SET_VIRTUAL) &&
							($product_base_info[$sp['product_id']]['type'] == PRODUCT_TYPE_NORMAL) && $_StockToStation[$subOrderKey] == $wh_id) {  //�Ϻ�վ��ͨ������Ʒ�������
							$sql = "update Inventory_stock set AvailableQty = AvailableQty - {$sp['buy_count']}, VirtualQty=VirtualQty + {$sp['buy_count']}, OrderQty = OrderQty + {$sp['buy_count']} , rowModifydate='{$timeNow}' where ProductSysNo={$sp['product_id']} and StockSysNo=$subOrderKey";
							$ret = $msSQL->execSql($sql);
							$cnt = $msSQL->getAffectedRows();
							if ($ret === false || 1 != $cnt) {
								self::$errCode = -2048;
								self::$errMsg = "�ۼ�ms sql���ʧ��({$sp['product_id'] })" . $msSQL->errMsg;
								$sql = "rollback";
								$msSQL->execSql($sql);
								$orderDb->execSql($sql);
								return false;
							}

							//ixiuzeng��ӣ���Inventroy_Stock�Ŀ���޸ļ�¼���뵽Inventory_Flow����
							$sql = "insert into Inventory_Flow values
									($subOrderKey, {$sp['product_id']}, 1, $newOrderId, 2,$buy_count_negative,'$timeNow', '$timeNow',$_inserter),
									($subOrderKey, {$sp['product_id']}, 1, $newOrderId, 4,$buy_count_positive,'$timeNow', '$timeNow',$_inserter),
									($subOrderKey, {$sp['product_id']}, 1, $newOrderId, 5,$buy_count_positive,'$timeNow', '$timeNow',$_inserter)";
							$ret = $msSQL->execSql($sql);
							$cnt = $msSQL->getAffectedRows();
							if ((false === $ret) || (3 != $cnt)) {
								self::$errCode = -2045;
								self::$errMsg = "����ms sql-Inventory_Flow��ʧ��({$sp['product_id'] })" . $msSQL->errMsg;
								$sql = "rollback";
								$msSQL->execSql($sql);
								$orderDb->execSql($sql);
								return false;
							}


							//��������
							$auto_id = IIdGenerator::getNewId('SO_ProductVirtue_Sequence');
							if (false === $auto_id) {
								self::$errCode = -2089;
								self::$errMsg = '��ȡ��������¼sqlʧ��' . IIdGenerator::$errMsg;
								$sql = "rollback";
								$msSQL->execSql($sql);
								$orderDb->execSql($sql);
								return false;
							}

							$sql = "insert into t_order_virtual_stock_{$db_tab_index['table']} values($auto_id, '$oid', {$sp['product_id']}, {$sp['buy_count']}, 0, $now, $wh_id)";
							$ret = $orderDb->execSql($sql);
							if (false === $ret) {
								self::$errCode = -2049;
								self::$errMsg = '������¼ʧ��' . $orderDb->errMsg;
								$sql = "rollback";
								$msSQL->execSql($sql);
								$orderDb->execSql($sql);
								return false;
							}

						}
						else { //���ڣ������ݲ�֧�ֽ����
							self::$errCode = -2099;
							self::$errMsg = '��Ʒ' . $product_base_info[$sp['product_id']]['name'] . "��治��";
							$sql = "rollback";
							$msSQL->execSql($sql);
							$orderDb->execSql($sql);
							return array('errCode'=> -15, 'errMsg'=> "��Ǹ��{$product_base_info[$sp['product_id']]['name']}��Ʒ��治�㣬����ٹ�������");
						}

						//���붩��-��Ʒӳ���
						// $isMainProduct 0:����Ʒ 1����� 2����Ʒ
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
						);

						$newOrder['order_items'][] = $newOrderItems; //��Ҫ��order_item �����ú���

						$ret = $orderDb->insert("t_order_items_{$db_tab_index['table']}", $newOrderItems);
						if (false === $ret) {
							self::$errCode = -2039;
							self::$errMsg = 'ִ��sql���ʧ��' . $orderDb->errMsg;
							$sql = "rollback";
							$orderDb->execSql($sql);
							$msSQL->execSql($sql);
							return false;
						}

						// �Ӷ�����Ʒ���ݣ�����ƷID��Ϊkey
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
						break;
					}
				}
			}
			$newOrderId++;
		}

		//���ʹ���˴������򣬿ۼ�����
		$mysqlDb = NULL;
		self::Log("���ʹ���˴������򣬿ۼ�����");
		if (isset($promotion['benefit_type'])) {
			$orderDb = ToolUtil::getMSDBObj('ICSON_CORE');
			if (false === $orderDb) {
				self::$errCode = ToolUtil::$errCode;
				self::$errMsg = ToolUtil::$errMsg;

				$sql = "rollback";
				$orderDb->execSql($sql);
				$msSQL->execSql($sql);
				return false;
			}

			if ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_COUPON']) {
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
				return array('errCode'=> -987, 'errMsg'=> '��Ǹ�����μӵĻ�ѽ�������ֹ���������ع��ﳵ���²���');
			}

			//������ͻ��֣��Ż�ȯ������Ҫִ�����û��ʺ��﷢�Ż��֣��Ż�ȯ
			if (IPromotionRule::$BenfitType['BENEFIT_TYPE_POINT'] == $promotion['benefit_type']) {

			}
			else if (IPromotionRule::$BenfitType['BENEFIT_TYPE_COUPON'] == $promotion['benefit_type']) {
				$couponFetch = array();
				$batches = explode(",", $promotion['discount']);
				foreach ($batches as $batch) {
					$couponFetch[$batch] = $promotion['benefit_times'];
				}
				if (NULL == $mysqlDb) {
					$mysqlDb = ToolUtil::getDBObj('coupon', 0);
					if (false === $mysqlDb) {
						self::$errCode = Config::$errCode;
						self::$errMsg = Config::$errMsg;

						$sql = "rollback";
						$orderDb->execSql($sql);
						$msSQL->execSql($sql);
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
						return false;
					}
				}

				$ret = ICoupon::fetchCoupons($uid, $couponFetch, $mysqlDb, (isset($userInfo['level']) ? $userInfo['level'] : -1));
				if (false === $ret) {
					self::$errCode = ICoupon::$errCode;
					self::$errMsg = ICoupon::$errMsg;
					$sql = "rollback";
					$mysqlDb->execSql($sql);
					$orderDb->execSql($sql);
					$msSQL->execSql($sql);
					if (ICoupon::$errCode == -106) {
						return array('errCode'=> -987, 'errMsg'=> '��Ǹ�����μӵĻ�ѽ�������ֹ���������ع��ﳵ���²���');
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
						return false;
					}
				}
			}
		}

		//���¹���ȯ
		self::Log("�����Ż�ȯ");
		if (isset($newOrder['couponCode']) && $newOrder['couponCode'] != '') {
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
				return false;
			}
		}

		//����ǽ��ܲ����������򽫽��ܲ���������Ϣ�����Ӧ�ı�
		if (isset($is_energy_subsidy_order)) {
			self::Log("���ܲ�������");
			//������ܲ�������
			$coreDb = ToolUtil::getMSDBObj('ICSON_CORE');
			$sql = "begin transaction";
			$ret = $coreDb->execSql($sql);
			if (false === $ret) {
				self::$errCode = -2035;
				self::$errMsg = '����ms sql����ʧ��' . $coreDb->errMsg;
				$sql = "rollback";
				if (isset($mysqlDb) && !empty($mysqlDb)) {
					$mysqlDb->execSql($sql);
				}
				$orderDb->execSql($sql);
				$msSQL->execSql($sql);
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
				return false;
			}
		}

		//���»���
		if ($newOrder['point'] > 0)
		{
			//����ۼ����ֵ���ˮ
			self::Log("���»���");
			global $_SCORE_TYPE;
			$ret = IScore::addScore($uid, $_SCORE_TYPE['CREATE_ORDER']['id'], -1 * $newOrder['point'] / 10, "���µ�10" . ($newOrderId - 1) . "���ѻ���", '', -1 * $cash_point_used / 10, -1 * $promotion_point_used / 10);
			if (false === $ret) {
				self::$errCode = IScore::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "add score flow:insert score flow faild(uid={$newOrder['uid']},order_id=$newOrderId,point={$newOrder['point']})" . IScore::$errMsg;
				$sql = "rollback";

				if (isset($mysqlDb) && !empty($mysqlDb)) {
					$mysqlDb->execSql($sql);
				}
				$orderDb->execSql($sql);
				$msSQL->execSql($sql);
				return array('errCode'=> -987, 'errMsg'=> '��Ǹ�����Ķ�����ʹ�û����쳣�����ύ����ʧ�ܣ��������Ժ������µ������ύ����ʱ�ݲ�ʹ�û���');
			}
		}

		self::reportORS($ORS_Report_Data);

		self::Log("commit����");
		$sql = "commit";

		if (!empty($mysqlDb)) {
			$mysqlDb_commit_ret = $mysqlDb->execSql($sql);
		}

		if (!empty($coreDb)) {
			$coreDb_commit_ret = $coreDb->execSql($sql);
		}

		$msSQL_commit_ret = $msSQL->execSql($sql);
		$orderDb_commit_ret = $orderDb->execSql($sql);

		//��������������ύʧ�ܣ���ʹ���˻���,����Ҫ��¼������Ϣ
		if (!$orderDb_commit_ret && ($newOrder['point'] > 0))
		{
			$backDate['order_id'] = $newOrderId - 1;
			$backDate['uid'] = $uid;
			$backDate['type'] = ERROR_COMMIT_ORDER;
			$backDate['cash_point'] = $cash_point_used;
			$backDate['promotion_point'] = $promotion_point_used;

			self::Log("$uid �û��¶��� {$backDate['order_id']} ����ʹ�õĻ��ֽ���1��Сʱ�ڷ����������˻�");
			$ret = IScore::insertBackData($backDate);
			return array('errCode'=> -988, 'errMsg'=> '��Ǹ�����Ķ����ύʧ�ܣ�����ʹ�õĻ��ֽ���1��Сʱ�ڷ����������˻�');
		}


		// �ϱ���������ʹ�ü�¼

		if (isset($newOrder['rule_id']) && $newOrder['rule_id'] > 0) {
			$orders = explode(",", $orderstrforlog);
			foreach ($orders as $o) {
				if (!empty($o)) {
					DataReport::report(3001, DATA_TYPE_1DAY, array($wh_id, $o, $newOrder['rule_id'], $userInfo['level'], $uid));
				}
			}
		}

		//д���û�����Ʒ��ȯ��Ϣ
		if (isset($newOrder['send_coupon_record_info']) && $newOrder['send_coupon_record_info'] != '') {
			$ret = EA_Promotion::setUserJoinedRecord($uid, $now, $newOrder['send_coupon_record_info'], $orders_items_array);
		}

		self::reportToSZ($orderToSZ, $items); //TAPD 5478549 �����ϱ�
		self::reportBaiduSem($_COOKIE, $subOrders, $wh_id); // �ϱ��ٶ�sem����
		self::reportGSadid($_COOKIE, $subOrders, $wh_id); // �ϱ� ��˫ ����

		//ɾ�����ﳵ
		if (!(isset($newOrder['buy_one_key']) && true === $newOrder['buy_one_key'])) {
			IShoppingCart::clear($uid);
		}

		//�����û���ַ��Ϣ��Ĭ��֧����ʽ��Ĭ�Ϸ�Ʊ
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
		//���Ͷ���֪ͨ
		if ($newOrder['point'] > 1000) {
			$mobile = $userInfo['mobile'];
			$time = date("Y-m-d H:i:s");
			$ret = IMessage::sendSMSMessage($mobile, "������Ѹ���˻���" . $time . "�µ���ʹ�û���" . $newOrder['point'] / 10 . "����������" . $parentOrderId . "�������������µ�400-828-1878");
			if (false === $ret) {
				self::Log("���Ͷ��ţ�������Ϣʧ�ܣ�" . IMessage::$errMsg);
			}
		}


		global $_PAY_MODE;
		return array(
			'errCode'         => 0,
			'uid'             => $uid,
			'orderId'         => $parentOrderId,
			'orderAmt'        => $orderShipPrice + $orderPrice - $newOrder['point'] - $couponInfo['amt'],
			'payType'         => $newOrder['payType'],
			'payTypeIsOnline' => $_PAY_MODE[$wh_id][$newOrder['payType']]['IsNet'],
			'payTypeName'     => $_PAY_MODE[$wh_id][$newOrder['payType']]['PayTypeName'],
			'orderTotalAmt'   => $orderShipPrice + $orderPrice, //�����ܽ��
			'payGoodsAmt'     => $product_cash, //�����ͻ�֧���Ľ�ȥ���˷Ѻ����ܵ��������Żݺ���û�ʵ��֧����
			'orderCreateTime' => $now,
			'isParentOrder'   => $orderNum > 1 ? true : false,
			'isVATInvoice'    => ($newOrder['invoiceType'] == INVOICE_TYPE_VAT) ? true : false,
			'order_items'     => $newOrder['order_items'],
			'subOrderIdStr'   => $orderstrforlog, //����ȥ cps ����
			'subOrders'       => $subOrders, //����ȥ cps ����
		);
	}


	/**
	 * @static ���Ԥ����Ϣ
	 * @param $uid �û�ID
	 * @param $items �������Ʒ
	 */
	public static function checkAppointInfo($uid, $items)
	{
		self::Log($uid);
		self::Log(ToolUtil::gbJsonEncode($items));
		$now = time();
		// �Ƿ�ԤԼ
		$isAppointed = true;

		// ��Ʒ���Ƿ����ԤԼ��Ʒ
		$hasAppointedProduct = false;

		//$lastItem = false;
		foreach ($items as $item) {

			if (!isset($item['event_id']) || $item['event_id'] <= 0) {
				continue;
			}

			if ($now < $item['buy_time_from'] or $now > $item['buy_time_to']) {
				// ����ԤԼ����ʱ����ڣ�����ԤԼ��飬����ֱ�ӹ���
				continue;
			}

			$hasAppointedProduct = true;

			$event_id = $item['event_id'];
			$ret = IActAppoint::hasAppointed($event_id, $uid);
			if ($ret === false) {
				// ���û�û�вμ�ԤԼ
				$isAppointed = false;
				self::$errMsg = 6002;
				self::$errCode = "�����ﳵ�е�\"{$item['name']}\"ΪԤ����Ʒ����ҪԤ���ʸ���ܹ���Ŷ";
				break;
			}

		}

		//self::Log(var_export($isAppointed, true));

		// ��������Ԥ����Ʒ
		if ($hasAppointedProduct) {
			// ����û��Ƿ����ʸ�
			return $isAppointed;
		}

		// ������û��Ԥ����Ʒ��ֱ�ӷŹ�
		return true;
	}

	private static function setShoppingCartInfo($newOrder)
	{
		$newOrderItems = array();

		$shopping_cart_type = IShoppingCart::ONLINE_CART;
		$isDistribution = (isset($newOrder['isDistribution']) && !empty($newOrder['isDistribution'])) ? true : false; //����
		if ((isset($newOrder['buy_one_key']) && true === $newOrder['buy_one_key']) //���������һ���������suborders��ȡ��Ʒ
			|| (isset($newOrder['ism']) && $newOrder['ism'] == 2) //����ǽ��ܲ�����Ʒ��Ҳ��suborders��ȡ��Ʒ
			|| (true === $isDistribution)
		) //����Ƿ���������Ҳ��suborders��ȡ��Ʒ
		{
			while (FALSE !== ($node = current($newOrder['suborders']))) {
				if (!isset($node['items'])) {
					return array('errCode'=> 10, 'errMsg'=> "���ύ�Ķ��������������飡");
				}

				foreach ($node['items'] as $it) {
					$item_tmp = array();
					$item_tmp['product_id'] = $it['product_id'];
					$item_tmp['buy_count'] = $it['num'];
					$item_tmp['main_product_id'] = !empty($it['main_product_id']) ? $it['main_product_id'] : 0;
					$item_tmp['price_id'] = !empty($it['price_id']) ? ($it['price_id'] === "thh" ? 1 : $it['price_id']) : 0;
					$item_tmp['OTag'] = !empty($it['OTag']) ? $it['OTag'] : "";
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
		// �ϱ��ٶ�sem����
		$reportID = 3201;
		if (isset($_COOKIE['mediav_data']) && $_COOKIE['mediav_data'] != '') {
			$cookie_data = $_COOKIE['mediav_data'];
			self::Log("�ϱ��ٶ�sem���� {$cookie_data} ");
			self::_dataReport($reportID, $cookie_data, $subOrders, $wh_id);
		}
	}

	private static function reportGSadid($_COOKIE, $subOrders, $wh_id)
	{
		// 5468935 ��˫���������ϱ�
		$reportID = 3202;
		if (isset($_COOKIE['gsadid_data']) && $_COOKIE['gsadid_data'] != '') {
			$cookie_data = $_COOKIE['gsadid_data'];
			self::Log("��˫���������ϱ� {$cookie_data} ");
			self::_dataReport($reportID, $cookie_data, $subOrders, $wh_id);
		}
	}

	private static function _dataReport($reportID, $cookie_data, $subOrders, $wh_id)
	{
		//
		$mediv_data = explode("|", $cookie_data);

		// �ָ���ǰ��Ϊ����
		$_data = $mediv_data[0];

			// �ָ�������Ϊ�û�������վ��ʱ��
		$_time = $mediv_data[1];

			// �����ڼ��ʱ��С��7��Ĳ��ϱ�
		if (time() - $_time < 7 * 24 * 60 * 60) {
			foreach ($subOrders as $stockNo=> $o) {
				// �ϱ����ж���
				DataReport::report($reportID, DATA_TYPE_1DAY, array($wh_id, $o['orderId'], $stockNo, $_data));
			}
		}
	}


	private static function reportORS($ORS_Report_Data)
	{
		$env = get_cfg_var('env.name');
		if(empty($env) or $env == "beta")
		{
			// ���� ip
			$ip = "10.180.37.99";
			$port = 44447;
		}
		else
		{
			// ��������ip
			$ip = "10.12.194.126";
			$port = 44447;
		}


		// ���������ϱ��� ORS
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
	 * �����ϱ����ο� tapd 5478549��
	 * ��"|"�ָ���Ƭ�Σ�Ƭ���ڣ���"&"����"key=value"
	 * @param array $order
	 * @param array $products
	 * @return true
	 */
	private static function reportToSZ($order, $products) {
		$env = get_cfg_var('env.name');

		if (empty($env) || $env == "beta") { // ���ϻ���
			$ip = '10.191.7.25';
		}
		else { // �������Ի���
			$ip = "10.12.194.109"; //����ָ��109
		}
		$port = 65300;
		$needResp = false; //����Ҫ�ȴ�����

		$data[] = 'cmd=1'; //��һƬ��

		//order �� recv_province, recv_city, ip, payname ��Ҫ����
		global $_District, $_Province, $_City;
		$province_id = isset($_District[ $order['recv_region'] ]) ? $_District[ $order['recv_region'] ]['province_id'] : false;
		$city_id = isset($_District[ $order['recv_region'] ]) ? $_District[ $order['recv_region'] ]['city_id'] : false;
		$order['recv_province'] = ($province_id) ? (isset($_Province[ $province_id ]) ? $_Province[ $province_id ] : '') : '';
		$order['recv_city'] = ($city_id) ? (isset($_City[ $city_id ]) ? $_City[ $city_id ]['name'] : '') : '';
		$order['recv_region'] = isset($_District[ $order['recv_region'] ]) ? $_District[ $order['recv_region'] ]['name'] : '';

		$order['ip'] = ToolUtil::getClientIP();

		global $_PAY_MODE;
		$order['payname'] = isset($_PAY_MODE[ $order['whid'] ][ $order['payid'] ]) ? $_PAY_MODE[ $order['whid'] ][ $order['payid'] ]['PayTypeName'] : ''; //ͨ��payid
		$data[] = $order; //�ڶ�Ƭ�Σ�������Ϣ

		//����Ƭ�ο�ʼ����Ʒ��Ϣ
		foreach($products as $pdt) {
			$data[] = array(
				'pid' => $pdt['product_id'], //��ƷID
				'pcharid' => $pdt['product_char_id'], //��Ʒ���
				'pname' => $pdt['name'], //��Ʒ��
				'qty' => $pdt['buy_count'], //��������
				'price' => $pdt['price'], //��Ʒ�۸��Է�Ϊ��λ
				'flag' => $pdt['flag'], //��Ʒ���
				'c3id' => $pdt['c3_ids'], //С��ID
			);
		}

		$udpAry = array();
		foreach($data as $phaseCnt) {
			if (is_string($phaseCnt)) { //��һƬ��
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
			// ���ﳵ���ʹ���
			return false;
		}


		if( !isset($newOrder['es_type']) )
		{
			// �������ʹ���
			return false;
		}

		$es_type = intval($newOrder['es_type']);

		// ���õ���������
		$available_types = array(
			0,//���˹���
			1,//��ҵ����
			2,//��ҵ��λ����
		);

		if(!in_array($es_type,$available_types))
		{
			// �������ʹ���
			return false;
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
				self::$errMsg = "̧ͷ������ȫ���ģ����Ȳ��ܳ���{$relly_len}������";
				return false;
			}


			if(empty($newOrder['es_idCard']) or !ToolUtil::checkIDCard($newOrder['es_idCard']))
			{
				// ����ID
				self::$errMsg = "���֤��Ϊ�գ�����Ϊ15����18";
				return false;
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
				self::$errMsg = "��ҵ���ֲ�Ϊ�գ����Ȳ��ܳ���{$relly_len}";
				return false;
			}


			if(empty($newOrder['es_idCard'])
				or strlen($newOrder['es_idCard']) > 60
				or !is_string($newOrder['es_idCard']))
			{
				// ����ID
				self::$errMsg = "��ҵִ�ղ�Ϊ�գ����Ȳ�����60���ַ�";
				return false;
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
				self::$errMsg = "��ҵ��λ����Ʊ̧ͷ����Ϊ�գ����Ȳ��ܳ���{$relly_len}";
				return false;
			}

		}
		else
		{
			return false;
		}
		//����xss����
		$newOrder['es_name'] = ToolUtil::transXSSContent($newOrder['es_name']);
		return true;

	}
}
