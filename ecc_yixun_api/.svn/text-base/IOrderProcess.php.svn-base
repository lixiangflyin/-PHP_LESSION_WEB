<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sheldonshi hedyhe
 * Date: 13-5-1
 * Time: 下午4:02
 * To change this template use File | Settings | File Templates.
 * Ps: 文件中接口仅供易迅网站侧购物流程调用，其他调用须提前告知，否则接口调整修改不做周知
 */
require_once(PHPLIB_ROOT . 'lib/DataReport.php');
require_once(PHPLIB_ROOT . 'inc/special.constant.inc.php');
require_once(PHPLIB_ROOT . 'api/IUniOrder.php');

class IOrderProcess{  //IOrderProcess
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
    // cookie 中的 visitkey
    public static $visitkey;
    public static $needSellerId = array();
    //易迅及相关第三方快递的订单，在processID=99的时候，才能被评论 @TAPD 5438774
    public static $evaluateViaShipType = array(ICSON_DELIVERY, ICSON_DELIVERY_QF, 30612,30761,30762,30752,30753,30804,30790,30812,30821,31478,31485,31484,50077,50078,50079,50080,50081,50082,50083,50084,50085,50086,);
    // 时间状态标记
    CONST NORMAL = 0; // 正常的时间段
    CONST EXPIRE = 1; // 当天过期的时间段
    CONST LIMITED = 2; // 限单的时间段

	//圆通快递
	public static $ytoRequestTpl = '<BatchQueryRequest><logisticProviderID>YTO</logisticProviderID><clientID>ICSON</clientID><orders><order><mailNo>{sysno_holder}</mailNo></order></orders></BatchQueryRequest>';
	public static $ytoPartnerId = 'icson';
	public static $ytoRequestHost = 'jingang.yto56.com.cn';
	public static $ytoRequestUrl = 'http://116.228.70.199/ordws/VipOrderServlet';
    //分期付款

	// 不开发票
	const HAS_INVOICE = 1;
	const NO_INVOICE = 0;
	//抢购商品显示验证码？
	const DISPLAY_VERIFY_CODE = false;
	const FREE_SHIPPING_PRICE = 2900; //免运费的购买最低价，单位为分

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


                //ixiuzeng添加，将Inventroy_Stock的库存修改记录插入到Inventory_Flow表中
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
            $userInfo = IUser::getUserInfo($uid);
            if (false === $userInfo) {
                self::$errCode = IUser::$errCode;
                self::$errMsg = "用户使用了积分，getUserInfo::get失败，line:" . __LINE__ . ",errMsg:" . IUser::$errMsg;
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

    public static function orderProcess($newOrder, $userInfo, $wh_id = 1)
    {
        global $shoppingProcessItil;
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['order']['req']);

        self::$visitkey = isset($_COOKIE['visitkey']) ? $_COOKIE['visitkey'] : "";
        $newOrder['visitkey'] = self::$visitkey;
        // 记录post过来的信息
        self::Log("Post newOrder:" . ToolUtil::gbJsonEncode($newOrder));

        // 检查所有必须的字段
        if (true !== self::checkByField($newOrder)) {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['order']['failed']);
            return false;
        }
        self::Log("checkByField finish");
        //参数收货地址
        if (false === self::checkReceiverAddr($newOrder)) {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['order']['failed']);
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
        if (false === self::checkPayType($newOrder, $wh_id, $userInfo)) {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['order']['failed']);
            return false;
        }
        self::Log("checkPayType finish");

        //检查发票
        if (false === self::checkInvoice($newOrder, $wh_id)) {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['order']['failed']);
            return array('errCode'=> -21, 'errMsg'=> '您提交发票类型不合法');
        }
        self::Log("checkInvoice finish");

        global $_USER_TYPE;
        if(false === self::checkUserInfo($newOrder, $userInfo))
        {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['order']['failed']);
            return array('errCode'=> 15, 'errMsg'=> "您属于分销用户，不能使用优惠券。");
        }

        $ret = self::placeOrder($newOrder, $wh_id, $userInfo);
        if(false === $ret)
        {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['order']['failed']);
            self::$errCode = IOrderProcess::$errCode;
            self::$errMsg = IOrderProcess::$errMsg;
        }
        else
        {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['order']['succ']);
        }

        return $ret;
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

    public static function checkPayType(&$newOrder, $wh_id = 1, $userInfo)
    {

        global $_PAY_MODE;
        global $_LGT_PAY;

        if (!isset($newOrder['payType'])) {
            self::$errCode = -2007;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newOrder[payType] is invalid";
            return false;
        }
        $userType = IPreOrderProcess::getUserType($userInfo);
        //getOnePayType($payTypeId, $shippingType, $whId = 1, $productidArr = array(), $userType = false, $cartType = 0, $uid = 0)
        $payTypeRet = IPreOrderProcess::getOnePayType($newOrder['payType'], $newOrder['shipType'], $wh_id, array(), $userType, 0, $userInfo['uid']);
        if(false == $payTypeRet)
        {
            //调用接口超时等，校验放过
            return true;
        }
        else if($payTypeRet['errCode'] != 0)
        {
            IOrderProcess::Log("payTypeRet ret:[{$userType}]" .print_r($userInfo['status_bits'], true). "--" . ToolUtil::gbJsonEncode($payTypeRet));
            self::$errCode = -2008;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "{$newOrder['payType']} is invalid";

            return false;
        }
        $payTypeData = $payTypeRet['data'];
        if($payTypeData['payTypeData'][$newOrder['payType']]['IsInstallment'] == 1)
        {
            $newOrder['isInstallment'] = 1;
            $newOrder['bank'] = $payTypeData['installmentConfigData'][$newOrder['payType']]['BankName'];
            $newOrder['installment'] = $payTypeData['installmentConfigData'][$newOrder['payType']]['installments'];
        }
        else
        {
            $newOrder['isInstallment'] = 0;
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
            if (!isset($newOrder['invoiceTaxno']) || $newOrder['invoiceTaxno'] == '' || (strlen($newOrder['invoiceTaxno']) != MIN_TAXNO_LEN && strlen($newOrder['invoiceTaxno']) != MAX_TAXNO_LEN)) {
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

    public static function checkUserInfo($newOrder, $userInfo)
    {
        //如果使用优惠券，判断用户是否为经销商，若是，则不允许使用优惠券
        global $_USER_TYPE;
        if ($userInfo['type'] == $_USER_TYPE['Dealer'] && isset($newOrder['couponCode']) && $newOrder['couponCode'] != '') {
            self::$errCode = 15;
            self::$errMsg = "用户提交的发票不可以在该站点使用";
            return false;
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

    //---------------下单逻辑中提取出的函数--------------
    /**
     * 将vector形式的商品列表转换为map形式
     * @param $items
     */
    private static function transItemsToMap($items)
    {
        $itemsTmp = array();
        reset($items);
        foreach($items as $item)
        {
            $pid = $item['product_id'];
            if(array_key_exists($pid,$itemsTmp))
            {
                $itemsTmp[$pid]['buy_count'] += $item['buy_count'];
                $itemsTmp[$pid]['cash_back'] += (isset($item['cash_back'])? $item['cash_back'] : 0) * $item['buy_count'];
                $itemsTmp[$pid]['package_id'] .= "," . $item['package_id'];
                //随心配
                $itemsTmp[$pid]['main_product_id'] = $item['match_num'] > 0 ? $item['main_product_id'] : $itemsTmp[$pid]['main_product_id'];
                $itemsTmp[$pid]['match_num'] += $item['match_num'];
                $itemsTmp[$pid]['match_cut'] = $item['match_num'] > 0 ? $item['match_cut'] : $itemsTmp[$pid]['match_cut'];
            }
            else
            {
                $itemsTmp[$pid] = $item;
                $itemsTmp[$pid]['cash_back'] = (isset($item['cash_back'])? $item['cash_back'] : 0) * $item['buy_count'];
            }
        }

        //购物车中商品转换，转换成商品ID做KEY的形式
        $formatItemsList = array();
        foreach($itemsTmp as $pid => $item)
        {
            if(isset($item['product_saving_amount']))
            {
                unset($item['product_saving_amount']);
            }
            $formatItemsList[$pid] = $item;
        }
        return $formatItemsList;
    }

    public static function checkPostAndShopcartItems($newOrder, $itemsInShoppingCart, $product_base_info, $packages)
    {
        self::Log("itemsInShoppingCart" . ToolUtil::gbJsonEncode($itemsInShoppingCart));
        $shoppingProduct = array();
        $productInShoppingCart = array();
        self::Log("检查前台传入的商品列表与购物车中商品列表是否一致");
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
                    if($orderItem['product_id'] == $itemInCart['product_id'])
                    {
                        //订购数量不一致,新版订单详情页按理不会出现这个分支，因为商品数量已经做了重新赋值
                        if($orderItem['num'] != $itemInCart['buy_count'])
                        {
                            self::$errCode = -1;
                            self::$errMsg = "购物车中商品" . $product_base_info[$itemInCart['product_id']]['name'] . "{$orderItem['num']}订购数量不正确，请返回购物车修改数量{$itemInCart['buy_count']}";
                            return false;
                        } //商品基本信息不存在，会出现
                        else if(!isset($product_base_info[$orderItem['product_id']]))
                        {
                            self::$errCode = -2;
                            self::$errMsg = "购物车中商品" . $product_base_info[$itemInCart['product_id']]['name'] . "暂不销售，请返回购物车删除";
                            return false;
                        } //商品状态不合法，会出现
                        else if(isset($product_base_info[$orderItem['product_id']]['status'])
                            && $product_base_info[$orderItem['product_id']]['status'] != PRODUCT_STATUS_NORMAL)
                        {
                            self::$errCode = -3;
                            self::$errMsg = "购物车中商品" . $product_base_info[$itemInCart['product_id']]['name'] . "暂不销售，请返回购物车删除";
                            return false;
                        }
                        //这里分单逻辑的判断，这里的逻辑处理会是个问题
                        //else if($product_base_info[$orderItem['product_id']]['psystock'] != $subOrderKey) {
                        /*
                        else if($product_base_info[$orderItem['product_id']]['psystock'] != $packages[$subOrderKey]['psystock'])
                        {
                            self::Log("product_base_info=".ToolUtil::gbJsonEncode($product_base_info)."---".$packages[$subOrderKey]['psystock']);
                            self::$errCode = -3;
                            self::$errMsg = "购物车中商品" . $product_base_info[$itemInCart['product_id']]['name'] . "信息已经改变，请刷新页面";
                            return false;
                        }
                        */
                        else
                        {
                            $shoppingProduct[$subOrderKey][$itemInCart['product_id']]['product_id'] = $itemInCart['product_id'];
                            $shoppingProduct[$subOrderKey][$itemInCart['product_id']]['OTag'] = $itemInCart['OTag'];
                            @$shoppingProduct[$subOrderKey][$itemInCart['product_id']]['buy_count'] += $itemInCart['buy_count'];
                            $shoppingProduct[$subOrderKey][$itemInCart['product_id']]['main_product_id'] = $itemInCart['main_product_id'];
                            $shoppingProduct[$subOrderKey][$itemInCart['product_id']]['type'] = SHOPPING_CART_PRODUCT_TYPE_NORMAL;
                            //加入随心配的内容
                            $shoppingProduct[$subOrderKey][$itemInCart['product_id']]['matchNum'] = $itemInCart['match_num'];
                            $shoppingProduct[$subOrderKey][$itemInCart['product_id']]['cashCutPerItem'] = $itemInCart['match_cut'];

                            $c3ids[] = $product_base_info[$itemInCart['product_id']]['c3_ids'];
                            $productInShoppingCart[] = $itemInCart['product_id'];
                        }
                        $exist = true;
                        break;
                    }
                }
                if(false === $exist) {
                    self::$errCode = -4;
                    self::$errMsg = "购物车中商品" .
                        (isset($product_base_info[$orderItem['product_id']]) ? $product_base_info[$orderItem['product_id']]['name'] : $orderItem['product_id'])
                        . "不存在，请返回购物车删除该商品";
                    return false;
                }

                //查看该商品附送的赠品&配件是否匹配
                foreach ($orderItem['gift'] as $g_p_id)
                {
                    if(!isset($product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]))
                    {
                        self::$errCode = -5;
                        self::$errMsg = "购物车中赠品/组件" . $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['name'] . "暂时无货，请返回购物车删除";
                        return false;
                    }//商品状态不合法
                    else if( isset($product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['status'])
                        && $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['status'] == PRODUCT_STATUS_NORMAL)
                    {
                        self::$errCode = -6;
                        self::$errMsg = "购物车中赠品/组件" . $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['name'] . "暂时无货，请返回购物车删除";
                        return false;
                    }
                    else
                    {
                        $shoppingProduct[$subOrderKey][$g_p_id]['product_id'] = $g_p_id;
                        @$shoppingProduct[$subOrderKey][$g_p_id]['buy_count'] += $orderItem['num'] * $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['num'];
                        $shoppingProduct[$subOrderKey][$g_p_id]['OTag'] = '';
                        $shoppingProduct[$subOrderKey][$g_p_id]['main_product_id'] = 0;
                        $shoppingProduct[$subOrderKey][$g_p_id]['belongto_product_id'] = $orderItem['product_id'];
                        if($product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['type'] == 1) {
                            $shoppingProduct[$subOrderKey][$g_p_id]['type'] = SHOPPING_CART_PRODUCT_TYPE_ZUJIAN;
                        }
                        else
                        {
                            $shoppingProduct[$subOrderKey][$g_p_id]['type'] = SHOPPING_CART_PRODUCT_TYPE_GIFT;
                        }
                        $exist = true;
                        $productInShoppingCart[] = $g_p_id;
                    }
                }
            }
        }

        $result = array(
            "shoppingProduct" => $shoppingProduct,
            "productInShoppingCart" => $productInShoppingCart,
            "c3ids" => $c3ids,
        );
        return $result;
    }

    public static function getPointRange($shoppingProduct, $product_base_info)
    {
        $pointMax = 0;
        $pointMin = 0;
        global $_OrderState;
        $limitedProduct = array();
        self::Log("获取可用积分范围");
        reset($shoppingProduct);
        while (FALSE != ($subOrderItem = current($shoppingProduct)))
        {
            $subOrderKey = key($shoppingProduct);
            next($shoppingProduct);
            foreach ($subOrderItem as $item)
            {
                if($item['type'] != SHOPPING_CART_PRODUCT_TYPE_NORMAL)
                {
                    continue;
                }
                $exist = isset($product_base_info[$item['product_id']]) ? true : false;
                if(false === $exist)
                {
                    self::$errCode = -9;
                    self::$errMsg = "购物车中商品" . $product_base_info[$item['product_id']]['name'] . "暂不销售，请返回购物车删除";
                    return false;
                }
                $p = $product_base_info[$item['product_id']];
                if($p['num_limit'] > 0 && $p['num_limit'] < 999)
                {
                    if($p['num_limit'] < $item['buy_count'])
                    {
                        self::$errCode = -15;
                        self::$errMsg = "购物车中商品" . $product_base_info[$item['product_id']]['name'] . "超过限购数量，只能购买" . $p['num_limit']  . "件";
                        return false;
                    }
                    $limitedProduct[$p['product_id']] = $subOrderKey;
                }
                //可用积分使用多价后的单价，这里是否要减掉套餐优惠cash_back？
                if($p['point_type'] != PRODUCT_CASH_PAY_ONLY)
                {
                    $pointMax += ($p['price']) * $shoppingProduct[$subOrderKey][$p['product_id']]['buy_count'];
                }
                if($p['point_type'] == PRODUCT_POINT_PAY_ONLY) {
                    $pointMin += $p['price'] * $shoppingProduct[$subOrderKey][$p['product_id']]['buy_count'];
                }
            }
        }

        $result = array(
            "pointMin" => $pointMin,
            "pointMax" => $pointMax,
            "limitedProduct" => $limitedProduct,
        );

        return $result;

    }

    public static function checkNormalProductLimit($uid, $orderDb, $db_tab_index, $limitedProduct, $shoppingProduct, $product_base_info)
    {
        global $_OrderState;
        $timestamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $sql = "select product_id, sum(buy_num) as buy_num from
                t_order_items_{$db_tab_index['table']} ot,
                t_orders_{$db_tab_index['table']} o
                where o.order_char_id=ot.order_char_id".
                " and o.status<>". $_OrderState['ManagerCancel']['value'] .
                " and o.status<>". $_OrderState['CustomerCancel']['value'].
                " and o.status<>". $_OrderState['EmployeeCancel']['value']." and ot.uid=" . $uid. " and create_time > " . $timestamp .
                " and product_id in(" . implode(',', array_keys($limitedProduct)) . ") group by product_id";

        $userOrder = $orderDb->getRows($sql);
        if(false === $userOrder)
        {
            self::$errCode = $orderDb->errCode;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[query order db failed]' . $orderDb->errMsg;
            return false;
        }
        if(!empty($userOrder))
        {
            foreach ($userOrder as $order)
            {
                if($order['buy_num'] >= $product_base_info[$order['product_id']]['num_limit'])
                {
                    self::$errCode = -11;
                    self::$errMsg = "购物车中商品" . $product_base_info[$order['product_id']]['name'] . "是限购商品，您今日购买数量已经超过限购数量";
                    return false;
                }
                else if($order['buy_num'] + $shoppingProduct[$limitedProduct[$order['product_id']]][$order['product_id']]['buy_count'] > $product_base_info[$order['product_id']]['num_limit'])
                {
                    self::$errCode = -12;
                    self::$errMsg = "购物车中商品" . $product_base_info[$order['product_id']]['name'] .
                        "是限购商品，您今日还能购买" . ($product_base_info[$order['product_id']]['num_limit'] - $order['buy_num']) . "个";
                    return false;
                }
            }
        }

        return true;
    }
    private static function getPostPackageInfo($newOrder, $items, $wh_id, $destination, $uid, $version = 0)
    {
        if($version == 0)
        {
            $divideOrder = IShoppingProcess::setOrderDivide($items, $wh_id, $destination, $uid);
            if(false === $divideOrder)
            {
                self::$errCode = IShoppingProcess::$errCode;
                self::$errMsg = IShoppingProcess::$errMsg;
                self::Log("分单接口setOrderDivide Error! errCode:" . self::$errCode);
                return false;
            }
            return $divideOrder;
        }
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

        $result = array(
            "items"     => $items,
            "packages"  => $packages
        );
        return $result;
    }

    public static function checkItemsInventory($productStocks, $shoppingProduct, $packages, $newOrder, $product_base_info, $wh_id)
    {
        $lackGiftAndIgnore = false;
        reset($shoppingProduct);
        while (FALSE != ($subOrderItem = current($shoppingProduct))) {
            $subOrderKey = key($shoppingProduct);
            next($shoppingProduct);
            foreach ($subOrderItem as $kk => $sp)
            {
                $exist = false;
                foreach ($productStocks as $pstock)
                {
                    //sheldonshi 这里有问题啦   库存信息的校验是以分单来处理的
                    //if($sp['product_id'] == $pstock['ProductSysNo'] && $subOrderKey == $pstock['StockSysNo'])
                    if($sp['product_id'] == $pstock['ProductSysNo'] && $packages[$subOrderKey]['psystock'] == $pstock['StockSysNo'])
                    {
                        $exist = true;
                        if(($pstock['AvailableQty'] + $pstock['VirtualQty'] <= 0) && $sp['type'] != SHOPPING_CART_PRODUCT_TYPE_GIFT)
                        {
                            IInventoryStockTTC::update(array('product_id'=>$sp['product_id'], 'num_available'=>$pstock['AvailableQty'], 'virtual_num'=> $pstock['VirtualQty']), array('sys_no'=>$pstock['SysNo']));
                            if($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_ZUJIAN)
                            {
                                self::$errCode = -15;
                                self::$errMsg = '组件'.$product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name']."库存不足,请联系客服";
                                return false;
                            }
                            self::$errCode = -14;
                            self::$errMsg = '商品'.$product_base_info[$sp['product_id']]['name']."库存不足";
                            return false;
                        }
                        if($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_GIFT) //赠品
                        {
                            if($pstock['AvailableQty'] + $pstock['VirtualQty'] < $sp['buy_count'])
                            {
                                IInventoryStockTTC::update(array('product_id'=> $sp['product_id'], 'num_available'=> $pstock['AvailableQty'], 'virtual_num'=> $pstock['VirtualQty']), array('sys_no'=> $pstock['SysNo']));
                                if(!isset($newOrder['ingoreLackOfGift']))
                                { //如果第一次提交订单
                                    $giftLackOfStock[$sp['product_id']] = $product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name'];
                                }
                                else if($newOrder['ingoreLackOfGift'] == 1)
                                { //用户接受缺少礼品
                                    $shoppingProduct[$subOrderKey][$kk]['buy_count'] = $pstock['AvailableQty'] + $pstock['VirtualQty'];
                                    if($shoppingProduct[$subOrderKey][$kk]['buy_count'] <= 0)
                                    {
                                        unset($shoppingProduct[$subOrderKey][$kk]);
                                    }
                                    $lackGiftAndIgnore = true;
                                }
                                else //用户不接受，则拒绝下单
                                {
                                    self::$errCode = -13;
                                    self::$errMsg = '赠品' . $product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name'] . "库存不足";
                                    return false;
                                }
                            }
                        }
                        else if($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_ZUJIAN)
                        {
                            if($pstock['AvailableQty'] + $pstock['VirtualQty'] < $sp['buy_count'])
                            {
                                self::$errCode = -15;
                                self::$errMsg = '组件' . $product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name'] . "库存不足,请联系客服";
                                return false;
                            }
                        }
                        else //主商品
                        {
                            if(($pstock['AvailableQty'] + $pstock['VirtualQty'] < $sp['buy_count'])
                                &&(($wh_id != 1) || ($product_base_info[$sp['product_id']]['flag'] & FORBID_SET_VIRTUAL) == FORBID_SET_VIRTUAL
                                    ||$product_base_info[$sp['product_id']]['type'] != PRODUCT_TYPE_NORMAL)
                            )
                            {
                                self::$errCode = -15;
                                self::$errMsg = '商品' . $product_base_info[$sp['product_id']]['name'] . "库存不足";
                                return false;
                            }
                        }
                        $product_base_info[$sp['product_id']]['AvailableQty'] = $pstock['AvailableQty'];
                        $product_base_info[$sp['product_id']]['VirtualQty'] = $pstock['VirtualQty'];
                        break;
                    }
                }
                if(false === $exist)
                {
                    self::$errCode = -16;
                    self::$errMsg = '商品' . $product_base_info[$sp['product_id']]['name'] . "暂不销售";
                    return false;
                }
            }
        }

        $result = array(
            "giftLackOfStock" => $giftLackOfStock,
            "lackGiftAndIgnore" => $lackGiftAndIgnore,
            "product_base_info" => $product_base_info,
            "shoppingProduct" => $shoppingProduct,
        );
        return $result;
    }

    public static function checkUserPointsUse($newOrder, $userInfo, $orderPrice, $totalCut, $pointMax, $pointMin)
    {
        $pointMax -= $totalCut;
        $pointMax /= 10;
        $pointMax = ceil($pointMax < $orderPrice ? $pointMax : $orderPrice);
        $pointMax *= 10;
        $pointMin = ceil($pointMin);
        //检查积分使用情况
        if($newOrder['point'] < $pointMin || $newOrder['point'] > $pointMax)
        {
            self::$errCode = -10;
            self::$errMsg = "您本次订单最少需使用" . ($pointMin / 10) . "个积分,最多能使用" . ($pointMax / 10) . "个积分";
            return false;
        }

        //拉取用户积分，确保用户使用的积分不超过其拥有的积分,并计算分别需要的现金积分和促销积分，优先使用现金积分
        $cash_point_used = 0;
        $promotion_point_used = 0;
        if($newOrder['point'] > 0 )
        {
            if($newOrder['point'] / 10 < $userInfo['cash_point'] || $newOrder['point'] / 10 == $userInfo['cash_point'])
            {
                $cash_point_used = $newOrder['point'];
            }
            else if($newOrder['point'] / 10 > $userInfo['cash_point']
                && (($newOrder['point'] / 10 < ($userInfo['cash_point']+$userInfo['promotion_point']))
                    || ($newOrder['point'] / 10 == ($userInfo['cash_point']+$userInfo['promotion_point']))))
            {
                $cash_point_used = ($userInfo['cash_point'] <0) ? 0 : $userInfo['cash_point'] * 10;
                $promotion_point_used = $newOrder['point'] - $cash_point_used;
            }
            else
            {
                self::$errCode = -34;
                self::$errMsg = "您账户积分总额为{$userInfo['point']}，最多只能使用{$userInfo['point']}个积分";
                return false;
            }
        }

        $result = array(
            "cash_point_used" => $cash_point_used,
            "promotion_point_used" => $promotion_point_used,
        );

        return $result;
    }

    public static function checkDeliveryInfo($shipRet, $divideOrderType, &$subOrders, &$newOrder, $destination)
    {
        //如果前端选择的是ors分单，而下单获取ors的时候出错，则校验下单，如果没有出错或正常，则校验配送
        if(false === $shipRet || !isset($shipRet[$divideOrderType]))
        {
            //不校验返回，出现这种情况的只有ors出错，默认出错前面就返回了
            $orderShipPrice = $newOrder['shippingPrice'];
            foreach($subOrders as $subKey => $subOrder)
            {

                $subOrders[$subKey]['seller_id'] = $newOrder['suborders'][$subKey]['seller_id'];
                $subOrders[$subKey]['sale_mode'] = $newOrder['suborders'][$subKey]['sale_mode'];
                $subOrders[$subKey]['seller_address_id'] = $newOrder['suborders'][$subKey]['seller_stock_id'];
                //大中小件
                $subOrders[$subKey]['order_size'] = $newOrder['suborders'][$subKey]['order_size'];
                $subOrders[$subKey]['order_volume'] = $newOrder['suborders'][$subKey]['order_volume'];
                $subOrders[$subKey]['order_longest'] = $newOrder['suborders'][$subKey]['order_longest'];
                $subOrders[$subKey]['order_weight'] = $newOrder['suborders'][$subKey]['totalWeight'];
                //运费
                $subOrders[$subKey]['orderShipPrice'] = $newOrder['suborders'][$subKey]['orderShipPrice'];
                if(isset($newOrder['suborders'][$subKey]['isCanXpress']) && $newOrder['suborders'][$subKey]['isCanXpress'] == 1)
                {
                    $subOrders[$subKey]['isCanXpress'] = 2;
                    //随心送的时间需要为下一天的第一个时间span
                    $now = time() + 3600*24;
                    $expectDate = date('Y-m-d', $now);
                    $newOrder['suborders'][$subKey]['expectDate'] = $expectDate;
                    $newOrder['suborders'][$subKey]['expectSpan'] = 1; // 期望时间
                    $orderShipPrice = 0;
                    $subOrders[$subKey]['orderShipPrice'] = 0;
                }
            }

            $result = array(
                'orderShipPrice' => $orderShipPrice,
            );
            return $result;
        }
        else if(strcmp($divideOrderType, "default") === 0)
        {
            //默认
            $shipInfo = $shipRet['default']['shippingType'];
            $packageInfo = $shipRet['default']['packages'];
        }
        else
        {
            //选择ors方式
            $shipInfo = $shipRet[$divideOrderType]['shippingType'];
            $packageInfo = $shipRet[$divideOrderType]['packages'];
        }

        //同时检查能否模糊开票，开增值发票
        if(isset($shipRet['availableInvoices']['isCanVAT'])
            && $shipRet['availableInvoices']['isCanVAT'] == false
            && $newOrder['invoiceType'] == INVOICE_TYPE_VAT
        )
        {
            self::$errCode = -20;
            self::$errMsg = '您的订单中有商品不能开增值税发票';

            return false;
        }
        $isShipTypenotAva = true;
        $orderShipPrice = 0;
        foreach($shipInfo as $key => $ship)
        {
            if($newOrder['shipType'] == $ship['ShippingId'])
            {
                $isShipTypenotAva = false;
                $orderShipPrice = $ship['shippingPrice'];
                foreach ($subOrders as $subOrderKey => $so)
                {
                    $subOrders[$subOrderKey]['orderShipPrice'] = $ship['subOrder'][$subOrderKey]['shippingPrice'];
                    //随心送  新接入  1-正常配送  2-随心送
                    if(isset($newOrder['suborders'][$subOrderKey]['isCanXpress']) && $newOrder['suborders'][$subOrderKey]['isCanXpress'] == 1)
                    {
                        //如果有随心送且是选择了随心送则校验
                        if(!isset($ship['subOrder'][$subOrderKey]['isCanXpress'])
                            || $ship['subOrder'][$subOrderKey]['isCanXpress'] != $newOrder['suborders'][$subOrderKey]['isCanXpress']
                        )
                        {
                            self::$errMsg = "抱歉，该配送方式暂不支持随心送，请重新选择！";
                            self::$errCode = -21;
                            self::Log("随心送验证错误！");

                            return false;
                        }
                        $subOrders[$subOrderKey]['isCanXpress'] = 2;
                        //随心送的时间需要为下一天的第一个时间span
                        $now = time() + 3600*24;
                        $expectDate = date('Y-m-d', $now);
                        $newOrder['suborders'][$subOrderKey]['expectDate'] = $expectDate;
                        $newOrder['suborders'][$subOrderKey]['expectSpan'] = 1; // 期望时间
                        $orderShipPrice = 0;
                        $subOrders[$subOrderKey]['orderShipPrice'] = 0;
                    }
                    else
                    {
                        $timeAvailable = array();
                        if(ICSON_DELIVERY == $newOrder['shipType'])
                        {
                            $timeAvailable = $ship['subOrder'][$subOrderKey]['timeAvaiable'];
                            $icson_delivery_info['expect_ship_date'] = $newOrder['suborders'][$subOrderKey]['expectDate']; // 期望日期
                            $icson_delivery_info['expect_time_span'] = $newOrder['suborders'][$subOrderKey]['expectSpan']; // 期望时间
                            $ret = self::verifyExpectDateSpan($icson_delivery_info, $timeAvailable, $destination);
                            if(false === $ret)
                            {
                                self::$errMsg = "抱歉，您选择的配送时间无法配送，请重新选择！";
                                self::$errCode = -21;
                                self::Log("配送时间验证失败！[{$icson_delivery_info['expect_ship_date']}][{$icson_delivery_info['expect_time_span']}]");
                                return false;
                            }
                        }
                    }
                }
                break;
            }
        }
        if($isShipTypenotAva)
        {
            self::$errMsg = "抱歉，购物车中有商品不支持您选择的运送方式！";
            self::$errCode = -17;
            return false;
        }
        foreach($packageInfo as $subKey=>$package)
        {
            $subOrders[$subKey]['seller_id'] = $package['seller_id'];
            $subOrders[$subKey]['sale_mode'] = $package['sale_mode'];
            $subOrders[$subKey]['seller_address_id'] = $package['seller_stock_id'];
            //大中小件
            $subOrders[$subKey]['order_size'] = $package['order_size'];
            $subOrders[$subKey]['order_volume'] = $package['order_volume'];
            $subOrders[$subKey]['order_longest'] = $package['order_longest'];
            $subOrders[$subKey]['order_weight'] = $package['totalWeight'];
        }

        $result = array(
            'orderShipPrice' => $orderShipPrice,
        );
        return $result;
    }
    public static function placeOrder($newOrder, $wh_id, $userInfo)
	{
        global $shoppingProcessItil, $shoppingProcessModuleCall;
        //ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['order']['req']);
        //$activeModuleId = $shoppingProcessModuleCall['active']['order'];
        $activeModuleId = $shoppingProcessModuleCall['passiveMID'];
        $mlog =	new CLoggerWrap($shoppingProcessModuleCall['active']['order']);
        $mlog->start();
        $newOrder = self::transXSSContent($newOrder);
        //订单确认页
        $version = isset($newOrder['version']) && $newOrder['version'] == 1 ? $newOrder['version'] : 0;
        $divideOrderType = isset($newOrder['divide_order_type']) ? $newOrder['divide_order_type'] : "default";
        self::Log("Order New Para:[whid:{$wh_id}],newOrder:" . ToolUtil::gbJsonEncode($newOrder));
		self::$visitkey = $newOrder['visitkey'];

		$uid = $newOrder['uid'];
		$destination = $newOrder['receiveAddrId'];
        /*
         * 用户信息的获取前移到cgi入口是获取，下的那流程中不做多次获取
        $userInfo = IUser::getUserInfo($uid);
		if($userInfo === false) {
			self::$errCode = IUser::$errCode;
			self::$errMsg = "获取用户信息错误";
			self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:获取用户信息错误：" . IUser::$errMsg;
            self::Log("placeOrder IUser::getUserInfo Error!获取用户信息错误!errCode:" . IUser::$errCode);
			return false;
		}
        $userPoint = IShoppingProcess::getUserPoint($uid);
        if($userPoint === false && $newOrder['point'] > 0){
            self::$errCode = IShoppingProcess::$errCode;
            self::$errMsg = "获取用户信息错误";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:获取用户信息错误：" . IShoppingProcess::$errMsg;
            self::Log("placeOrder IShoppingProcess::getUserPoint Error!获取用户积分信息错误!errCode:" . IShoppingProcess::$errCode);
        }
        $userInfo['point'] = $userPoint['point'];
        $userInfo['cash_point'] = $userPoint['cash_point'];
        $userInfo['promotion_point'] = $userPoint['promotion_point'];
        $userInfo['valid_point'] = $userPoint['valid_point'];
        */
        //分期处理 sheldonshi
        $isInstallmentOrder = false;
        if(isset($newOrder['IsInstallment']) && $newOrder['IsInstallment'] == 1)
        {
            $isInstallmentOrder = true;
            $bank = $newOrder['bank'];
            $installment = $newOrder['installment'];
        }

		// 设置购物车参数
		$shoppingCartInfo = self::setShoppingCartInfo($newOrder);
        //使用新的接口来完成这里的商品列表商品信息获取   Start
        $result = IShoppingProcess::getAllCartItemsInfo($uid, $wh_id, $destination, $shoppingCartInfo, true , true, SCENE_SHOPPING_ORDER, $newOrder, $version);
        if(false === $result)
        {
            self::$errCode = IShoppingProcess::$errCode;
            self::$errMsg = IShoppingProcess::$errMsg . ",uid({$uid}) getItemList failed";
            self::Log("getAllCartItemsInfo Failed!".IShoppingProcess::$errCode);
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETALLCARTITEMSINFO'], self::$errCode, 1, LocalServerIP, LocalServerIP);
            return array('errCode'=> -1, 'errMsg'=> "您的购物车中没有商品，请选购！");
        }
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETALLCARTITEMSINFO'], 0, 0, LocalServerIP, LocalServerIP);
        $items = $result['items'];
        $suiteInfo = $result['suiteInfo'];
        $product_base_info = $result['products'];
        $inventorys = $result['inventory'];

        self::Log("购物车商品信息获取结果! getAllCartItemsInfo Result: [items:"
                . ToolUtil::gbJsonEncode($items)
                . "]  [suitInfo:" . ToolUtil::gbJsonEncode($suiteInfo)
                . "]  [product_base_info:" . ToolUtil::gbJsonEncode($product_base_info)
                . "]  [inventory:" . ToolUtil::gbJsonEncode($inventorys)
                . "]"
        );
        //服务类商品跨仓检查逻辑
        $conflict = IPreOrderProcess::diyProductStockCheck($product_base_info, $wh_id);
        if(!empty($conflict))
        {
            if($version == 1)
            {
                reset($items);
                foreach($items as $key => $item)
                {
                    if(in_array($item['product_id'], self::$DIY_SERVICE_IDS))
                    {
                        unset($items[$key]);
                    }
                }
            }
            else
            {
                return array('errCode'=> -1, 'errMsg'=> "抱歉，您购物车中含有待调拨商品，暂不支持安装服务。您可以选择其他当日出货的同类商品享受安装服务；或者删除安装服务，自行安装。");
            }
        }
        self::Log("装机服务跨仓逻辑检查! diyProductStockCheck finish");
        //sheldonshi 恢复随心配
        $mlog->start();
        $tyingRet = IShoppingProcess::getTyingInfo($items, $wh_id, $destination, $uid, SCENE_SHOPPING_ORDER);
        if($tyingRet === false)
        {
            //随心配不是主路径，如果失败了，可以直接下单？但是前一次如果没失败，这次失败了,在后面价格验证出错就可以
            self::$errMsg = '获取随心配失败. '.IShoppingProcess::$errCode;
            self::$errCode = 4001;
            self::$logMsg =  basename(__FILE__) . "line:" . __LINE__ . ",errMsg:获取随心配失败.".IShoppingProcess::$errCode;
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETTYINGINFO'], IShoppingProcess::$errCode, 1, LocalServerIP, LocalServerIP);
            self::Log("获取随心配失败! [uid:{$uid}] [whid:{$wh_id}] [destination:{$destination}] [items:" . ToolUtil::gbJsonEncode($items) . "]");
        }
        else
        {
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETTYINGINFO'], 0, 0, LocalServerIP, LocalServerIP);
            $items = $tyingRet['items'];
        }
        self::Log("获取随心配结果! getTyingInfo itmes:" . ToolUtil::gbJsonEncode($items));

        /*
        $itemsTmp = array();
        foreach($items as $item)
        {
            $pid = $item['product_id'];
            if(array_key_exists($pid,$itemsTmp))
            {
                $itemsTmp[$pid]['buy_count'] += $item['buy_count'];
                $itemsTmp[$pid]['cash_back'] += (isset($item['cash_back'])? $item['cash_back'] : 0) * $item['buy_count'];
                $itemsTmp[$pid]['package_id'] .= "," . $item['package_id'];
                //随心配
                $itemsTmp[$pid]['main_product_id'] = $item['match_num'] > 0 ? $item['main_product_id'] : $itemsTmp[$pid]['main_product_id'];
                $itemsTmp[$pid]['match_num'] += $item['match_num'];
                $itemsTmp[$pid]['match_cut'] = $item['match_num'] > 0 ? $item['match_cut'] : $itemsTmp[$pid]['match_cut'];
            }
            else
            {
                $itemsTmp[$pid] = $item;
                $itemsTmp[$pid]['cash_back'] = (isset($item['cash_back'])? $item['cash_back'] : 0) * $item['buy_count'];
            }
        }

        //购物车中商品转换，转换成商品ID做KEY的形式
        $itemsInShoppingCart = array();
        foreach($itemsTmp as $pid => $item)
        {
            if(isset($item['product_saving_amount']))
            {
                unset($item['product_saving_amount']);
            }
            $itemsInShoppingCart[$pid] = $item;
        }
        */
        $itemsInShoppingCart = self::transItemsToMap($items);

        if(count($itemsInShoppingCart) == 0)
        {

            return array('errCode'=> 10, 'errMsg'=> "您的购物车中没有商品，请选购！");
        }
        self::Log("购物车商品信息合并! transItemsToMap Result: [items:"
                . ToolUtil::gbJsonEncode($items)
                . "]  [itemsInShoppingCart:" . ToolUtil::gbJsonEncode($itemsInShoppingCart)
                . "]"
        );
        //TODO:使用新的接口来完成这里的商品列表商品信息获取  End

        $ret = self::checkVisitFrequency($product_base_info, $newOrder);
        if(false === $ret)
        {
            //检查频率限制失败
            self::Log("place order checkVisitFrequency Failed!errCode:" . self::$errCode . "errMsg:" . self::$errMsg);
            return false;
        }
        self::Log("下单频率检查！checkVisitFrequency finish!");


		reset($newOrder['suborders']);
		$countPost = 0;                                              //商品款数
		while(FALSE != ($node = current($newOrder['suborders'])))
		{
			if(!isset($node['items']))
            {
				return array('errCode'=> 10, 'errMsg'=> "您提交的订单数据有误，请检查！");
			}
			$countPost += count($node['items']);
			next($newOrder['suborders']);
		}
		//如果没有套餐，判断购物车中商品与前台展示的商品数量是一致的
		if(empty($suiteInfo))
		{
			if(count($itemsInShoppingCart) != $countPost)
            {
				self::$errCode = -2021;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "items count in shoppingcart is not equal to post items count";
				self::Log("items count in shoppingcart is not equal to post items count[countPost:{$countPost}][itemInShoppingCart:" . count($itemsInShoppingCart));
                return false;
			}
		}
        //判断商品是否是节能补贴商品:商品flag是节能补贴商品&&节能补贴信息齐全&&购物车中商品数量=1
        if(isset($items[0]['flag'])
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
		//调用多价、促销系统进行商品批价
        $mlog->start();
		$rule_id = !empty($newOrder['rule_id']) ? intval($newOrder['rule_id']) : 0;
		$promotionRule = IPromotionRuleV2::checkRuleForOrder($items, $wh_id, $uid, $rule_id, $isEnergySavingType, SCENE_SHOPPING_ORDER);
		if(false === $promotionRule)
        {
			if(106 == IPromotionRuleV2::$errCode)
			{
				self::$errCode = IPromotionRuleV2::$errCode;
				self::$errMsg = IPromotionRuleV2::$errMsg;
                self::Log("checkRuleForOrder 您参加的活动已结束或终止:errCode" . self::$errCode . ";errMsg:" . self::$errMsg);
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['CHECKRULEFORORDER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                return array('errCode'=> -991, 'errMsg'=> '抱歉，您参加的活动已结束或终止，请您返回购物车重新操作');
			}
			else if(107 == IPromotionRuleV2::$errCode)
			{
				self::$errCode = IPromotionRuleV2::$errCode;
				self::$errMsg = IPromotionRuleV2::$errMsg;
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['CHECKRULEFORORDER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                self::Log("checkRuleForOrder 活动已达到参与次数上限:errCode" . self::$errCode . ";errMsg:" . self::$errMsg);
				return array('errCode'=> -992, 'errMsg'=> "抱歉，您所参与的活动已达到参与次数上限，不能再参加该活动");
			}
			else
			{
				self::$errCode = IPromotionRuleV2::$errCode;
				self::$errMsg = IPromotionRuleV2::$errMsg;
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['CHECKRULEFORORDER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                self::Log("checkRuleForOrder Failed!:errCode" . self::$errCode . ";errMsg:" . self::$errMsg);
				return false;
			}
		}
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['CHECKRULEFORORDER'], 0, 0, LocalServerIP, LocalServerIP);
		self::Log("多价、促销批价结果！IPromotionRuleV2 result:" . ToolUtil::gbJsonEncode($promotionRule));
		$promotion = $promotionRule['promotion'];
		$items = $promotionRule['items'];
		$restricts = $promotionRule['restrict'];
        //预约检查
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['appoint']['req']);
		$ret = self::checkAppointInfo($uid, $items);
		self::Log("检查预约结果！" . var_export($ret, true));
		if($ret == false)
        {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['appoint']['failed']);
			return array('errCode'=> self::$errMsg, 'errMsg'=> self::$errCode);
		}
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['appoint']['succ']);
		// 拆分订单，所有需要对items进行改变的操作，请在拆单之前进行
        //sheldonshi 调用拆单来拆分订单
        /*
        $divideOrder = IShoppingProcess::setOrderDivide($items, $wh_id, $destination, $uid);
        if(false === $divideOrder)
        {
            self::$errCode = IShoppingProcess::$errCode;
            self::Log("分单接口setOrderDivide Error! errCode:" . self::$errCode);
            return false;
        }

        self::Log("获取分单结果！setOrderDivide Result!". ToolUtil::gbJsonEncode($divideOrder));
        */
        $mlog->start();
        $divideOrder = self::getPostPackageInfo($newOrder, $items, $wh_id, $destination, $uid,$version);
        if(false === $divideOrder)
        {
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['SETORDERDIVIDE'], self::$errCode, 1, LocalServerIP, LocalServerIP);
            return array(
                'errCode'=> self::$errCode,
                'errMsg'=> self::$errMsg,
            );
        }
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['SETORDERDIVIDE'], 0, 0, LocalServerIP, LocalServerIP);
        $items = $divideOrder['items'];
        $packages = $divideOrder['packages'];

		//检查前台传入的商品列表 与 购物车中商品列表是否一致 新版这里做了调整
        $itemsCheckRet = self::checkPostAndShopcartItems($newOrder, $itemsInShoppingCart, $product_base_info, $packages);
        if(false === $itemsCheckRet)
        {
            return array(
                'errCode'=> self::$errCode,
                'errMsg'=> self::$errMsg,
            );
        }
        $shoppingProduct = $itemsCheckRet['shoppingProduct'];
        $productInShoppingCart = $itemsCheckRet['productInShoppingCart'];
        $c3ids = $itemsCheckRet['c3ids'];
        self::Log("检查前台传入的商品列表与购物车中商品列表是否一致!");

        //选择整机安装，不能选择货到付款
        global $_PAY_MODE;
        //if($_PAY_MODE[$wh_id][$newOrder['payType']]['PayTypeName'] == '货到付款')
        if($newOrder['payType'] == COD)
        {
            global $_NotPayWhenArrive;
            $bothExist = array_intersect($_NotPayWhenArrive, $productInShoppingCart);
            if(count($bothExist) != 0)
            {
                self::Log("选择整机安装，不能选择货到付款![payType:{$newOrder['payType']}]");
                return array('errCode'=> -22, 'errMsg'=> '您选择了整机安装服务，不能选择货到付款支付方式');
            }
        }
        self::Log("验证选择整机安装!");

        //检测某些特殊不包含在购物车中，则不能选择自提点
        global $_SelfFetchProductids;
        global $_LGT_MODE;
        //如果选择的是上门自提方式，需要检测购物车中存在特定商品,这里上门提货应该有对应类型，最好不要汉字提示
        if(false !== strpos($_LGT_MODE[$newOrder['shipType']]['ShipTypeName'], '上门提货'))
        {
            $bothExist = array_intersect($_SelfFetchProductids, $productInShoppingCart);
            if(count($bothExist) == 0)
            {
                return array('errCode'=> -29, 'errMsg'=> '对不起，您所购买的商品不能选择上门提货');
            }
        }
        self::Log("验证选择自提!");

        $invoinceContent = IPreOrderProcess::getInvoicesContentOpt($c3ids, $wh_id);
        if($newOrder['isVat'] == self::HAS_INVOICE)
        {
            if(!in_array($newOrder['invoiceContent'], $invoinceContent))
            {
                return array('errCode'=>-21, 'errMsg'=>'您提交发票内容不合法');
            }
        }
        self::Log("验证您提交发票内容！");
        /*
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
					if($orderItem['product_id'] == $itemInCart['product_id'])
                    {
						//订购数量不一致,新版订单详情页按理不会出现这个分支，因为商品数量已经做了重新赋值
						if($orderItem['num'] != $itemInCart['buy_count'])
                        {
							return array(
                                'errCode'=> -1,
                                'errMsg'=> "购物车中商品" . $product_base_info[$itemInCart['product_id']]['name'] . "{$orderItem['num']}订购数量不正确，请返回购物车修改数量{$itemInCart['buy_count']}"
                            );
						} //商品基本信息不存在，会出现
						else if(!isset($product_base_info[$orderItem['product_id']]))
                        {
							return array(
                                'errCode'=> -2,
                                'errMsg'=> "购物车中商品" . $product_base_info[$itemInCart['product_id']]['name'] . "暂不销售，请返回购物车删除"
                            );
						} //商品状态不合法，会出现
						else if(isset($product_base_info[$orderItem['product_id']]['status'])
                            && $product_base_info[$orderItem['product_id']]['status'] != PRODUCT_STATUS_NORMAL)
                        {
							return array(
                                'errCode'=> -3,
                                'errMsg'=> "购物车中商品" . $product_base_info[$itemInCart['product_id']]['name'] . "暂不销售，请返回购物车删除"
                            );
						}
                        //这里分单逻辑的判断，这里的逻辑处理会是个问题
                        //else if($product_base_info[$orderItem['product_id']]['psystock'] != $subOrderKey) {
                        else if($product_base_info[$orderItem['product_id']]['psystock'] != $packages[$subOrderKey]['psystock']) {
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
                            //加入随心配的内容
                            $shoppingProduct[$subOrderKey][$itemInCart['product_id']]['matchNum'] = $itemInCart['match_num'];
                            $shoppingProduct[$subOrderKey][$itemInCart['product_id']]['cashCutPerItem'] = $itemInCart['match_cut'];

							$c3ids[] = $product_base_info[$itemInCart['product_id']]['c3_ids'];
							$productInShoppingCart[] = $itemInCart['product_id'];
						}
						$exist = true;
						break;
					}
				}
				if(false === $exist) {
					return array(
                        'errCode'=> -4, 'errMsg'=> "购物车中商品" .
						(isset($product_base_info[$orderItem['product_id']]) ? $product_base_info[$orderItem['product_id']]['name'] : $orderItem['product_id'])
						. "不存在，请返回购物车删除该商品"
                    );
				}

				//查看该商品附送的赠品&配件是否匹配
				foreach ($orderItem['gift'] as $g_p_id)
				{
					if(!isset($product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]))
                    {
						return array(
                            'errCode'=>-5,
                            'errMsg'=>"购物车中赠品/组件" . $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['name'] . "暂时无货，请返回购物车删除"
                        );
					}//商品状态不合法
					else if( isset($product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['status'])
                        && $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['status'] == PRODUCT_STATUS_NORMAL)
                    {
						return array(
                            'errCode'=>-6,
                            'errMsg'=>"购物车中赠品/组件" . $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['name'] . "暂时无货，请返回购物车删除"
                        );
					}
					else
					{
						$shoppingProduct[$subOrderKey][$g_p_id]['product_id'] = $g_p_id;
						@$shoppingProduct[$subOrderKey][$g_p_id]['buy_count'] += $orderItem['num'] * $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['num'];
						$shoppingProduct[$subOrderKey][$g_p_id]['OTag'] = '';
						$shoppingProduct[$subOrderKey][$g_p_id]['main_product_id'] = 0;
						$shoppingProduct[$subOrderKey][$g_p_id]['belongto_product_id'] = $orderItem['product_id'];
                        if($product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['type'] == 1) {
							$shoppingProduct[$subOrderKey][$g_p_id]['type'] = SHOPPING_CART_PRODUCT_TYPE_ZUJIAN;
						}
                        else
						{
							$shoppingProduct[$subOrderKey][$g_p_id]['type'] = SHOPPING_CART_PRODUCT_TYPE_GIFT;
						}
						$exist = true;
						$productInShoppingCart[] = $g_p_id;
					}
				}
			}
		}

        */
        //$shoppingProduct 这里是根据前端进行了拆单后的数据了，这里含有了赠品和组件的信息，赠品和组件当作一条商品数据
		reset($items);
        foreach($items as $it)
		{
			$pid = $it['product_id'];
            $subOrderKey = $it['divide_id'];
			if(isset($shoppingProduct[$subOrderKey][$pid]))
			{
				if(empty($shoppingProduct[$subOrderKey][$pid]['total_price']))
                {
					$shoppingProduct[$subOrderKey][$pid]['total_price'] = 0;
                    $shoppingProduct[$subOrderKey][$pid]['promotion_total_price'] = 0;
                }
				//累加多价后的总价
				$shoppingProduct[$subOrderKey][$pid]['total_price'] += $it['total_price_after'];
                $shoppingProduct[$subOrderKey][$pid]['promotion_total_price'] += $it['promotion_price'];
			}
            else
            {
                $shoppingProduct[$subOrderKey][$pid]['promotion_total_price'] = $it['promotion_price'];
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

		//优惠券检测
		$couponInfo = array('amt'=>0, 'code'=>'', 'type'=>0);
        //节能补贴商品临时搞搞 Start
        if(2 == $isEnergySavingType && isset($newOrder['couponCode']))
        {
            $newOrder['couponCode'] = "";
        }
        //节能补贴商品临时搞搞 End
		if(isset($newOrder['couponCode']) && $newOrder['couponCode'] != "" )
        {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['coupon']['req']);
            $mlog->start();
            $couponInfo = ICouponV2::checkCouponForOrder(
                                                $uid,
                                                $newOrder['couponCode'],
                                                $newOrder['receiveAddrId'],
                                                $newOrder['payType'] ,
                                                $items,
                                                $product_base_info,
                                                $packages,
                                                $wh_id,
                                                0);
			if(false === $couponInfo)
            {
                ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['coupon']['failed']);
				self::$errCode = ICouponV2::$errCode;
				self::$errMsg = ICouponV2::$errMsg;
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['CHECKCOUPONFORORDER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                self::Log("checkCouponForOrder Error[couponCode:{$newOrder['couponCode']}][receiveAddrId:{$newOrder['receiveAddrId']}][payType:{$newOrder['payType']}]");
				return array('errCode' => self::$errCode, 'errMsg' => self::$errMsg);
			}
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['CHECKCOUPONFORORDER'], 0, 0, LocalServerIP, LocalServerIP);
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['coupon']['succ']);
		}
        self::Log("优惠券检测!");
        //积分验证
        global $_OrderState;
        $pointRangeRet = self::getPointRange($shoppingProduct, $product_base_info);
        if(false === $pointRangeRet)
        {
            return array(
                'errCode'=> self::$errCode,
                'errMsg'=> self::$errMsg,
            );
        }
        $pointMax = $pointRangeRet['pointMax'];
        $pointMin = $pointRangeRet['pointMin'];
        $limitedProduct = $pointRangeRet['limitedProduct'];
		self::Log("获取可用积分范围![pointMax:{$pointMax}][pointMin:{$pointMin}]");
		/*
        reset($shoppingProduct);
		while (FALSE != ($subOrderItem = current($shoppingProduct)))
        {
			$subOrderKey = key($shoppingProduct);
			next($shoppingProduct);
			foreach ($subOrderItem as $item)
			{
				if($item['type'] != SHOPPING_CART_PRODUCT_TYPE_NORMAL)
                {
					continue;
				}
				$exist = isset($product_base_info[$item['product_id']]) ? true : false;
				if(false === $exist)
                {
					return array(
                        'errCode'=> -9,
                        'errMsg'=> "购物车中商品" . $product_base_info[$item['product_id']]['name'] . "暂不销售，请返回购物车删除"
                    );
				}
				$p = $product_base_info[$item['product_id']];
				if($p['num_limit'] > 0 && $p['num_limit'] < 999)
                {
					if($p['num_limit'] < $item['buy_count'])
                    {
						return array(
                            'errCode'=> -8,
                            'errMsg'=> "购物车中商品" . $product_base_info[$item['product_id']]['name'] . "超过限购数量" . $p['num_limit']
                        );
					}
					$limitedProduct[$p['product_id']] = $subOrderKey;
				}
                //可用积分使用多价后的单价，这里是否要减掉套餐优惠cash_back？
				if($p['point_type'] != PRODUCT_CASH_PAY_ONLY)
                {
					$pointMax += ($p['price'] ) * $shoppingProduct[$subOrderKey][$p['product_id']]['buy_count'];
				}
				if($p['point_type'] == PRODUCT_POINT_PAY_ONLY) {
					$pointMin += $p['price'] * $shoppingProduct[$subOrderKey][$p['product_id']]['buy_count'];
				}
			}
		}
        */

        //可用积分
		//如果购物车中商品有限购商品，则查询该用户当天的订单
		//这里部署外网需要修改分库分表的问题,多价的限购是否未考虑？
        reset($items);
        foreach($items as $item)
        {
            if(1 == $item['price_buy_limit_flag'])
            {
                return array(
                    'errCode'=> -15,
                    'errMsg'=> "购物车中商品" . $item['name'] . "超过限购数量，只能购买" . $item['mult_limit_num'] . "件",
                );
            }
        }
		self::Log("检查商品多价限购！");
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['orderDB']['req']);
		$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
		if(!empty($limitedProduct))
        {
            $orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
            if(empty($orderDb))
            {
                ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['orderDB']['failed']);
                self::$errCode = Config::$errCode;
                self::$errMsg = Config::$errMsg;
                return false;
            }
            $normalProductLimitRet = self::checkNormalProductLimit($uid, $orderDb, $db_tab_index, $limitedProduct, $shoppingProduct, $product_base_info);
			if(false === $normalProductLimitRet)
            {
                return array(
                    'errCode'=> self::$errCode,
                    'errMsg'=> self::$errMsg,
                );
            }
			/*
            $timestamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
			$sql = "select product_id, sum(buy_num) as buy_num from
			t_order_items_{$db_tab_index['table']} ot,
			t_orders_{$db_tab_index['table']} o
			where o.order_char_id=ot.order_char_id".
				" and o.status<>". $_OrderState['ManagerCancel']['value'] .
				" and o.status<>". $_OrderState['CustomerCancel']['value'].
				" and o.status<>". $_OrderState['EmployeeCancel']['value']." and ot.uid=" . $uid. " and create_time > " . $timestamp .
				" and product_id in(" . implode(',', array_keys($limitedProduct)) . ") group by product_id";

			$userOrder = $orderDb->getRows($sql);
			if(false === $userOrder)
            {
				self::$errCode = $orderDb->errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[query order db failed]' . $orderDb->errMsg;
				return false;
			}
			if(!empty($userOrder))
            {
				foreach ($userOrder as $order)
				{
					if($order['buy_num'] >= $product_base_info[$order['product_id']]['num_limit'])
                    {
						return array(
                            'errCode'=>-11,
                            'errMsg'=>"购物车中商品" . $product_base_info[$order['product_id']]['name'] . "是限购商品，您今日购买数量已经超过限购数量"
                        );
					}
					else if($order['buy_num'] + $shoppingProduct[$limitedProduct[$order['product_id']]][$order['product_id']]['buy_count'] > $product_base_info[$order['product_id']]['num_limit'])
                    {
						return array(
                            'errCode'=>-12,
                            'errMsg'=>"购物车中商品" . $product_base_info[$order['product_id']]['name'] .
							"是限购商品，您今日还能购买" . ($product_base_info[$order['product_id']]['num_limit'] - $order['buy_num']) . "个" );
					}
				}
			}
			*/
		}
        self::Log("检查商品普通限购！");
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['inventoryDB']['req']);
		$msSQL = ToolUtil::getMSDBObj('Inventory_Manager');
		if(empty($msSQL))
        {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['inventoryDB']['failed']);
			self::$errCode = Config::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "query ms sql faild " . Config::$errMsg;
            self::Log("检查库存 DB 连接失败errCode:".self::$errCode.";errMsg:".self::$errMsg);
			return false;
		}
		$sql = "select SysNo, ProductSysNo, StockSysNo, AvailableQty, VirtualQty, OrderQty from Inventory_Stock where ProductSysNo in (" . implode(",", $productInShoppingCart) . ")";
		$productStocks = $msSQL->getRows($sql);
		if(false === $productStocks)
        {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['inventoryDB']['failed']);
			self::$errCode = $msSQL->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "query ms sql faild " . $msSQL->errMsg;
            self::Log("检查库存 DB 查询失败errCode:".self::$errCode.";errMsg:".self::$errMsg);
			return false;
		}
        /*
		reset($shoppingProduct);
		while (FALSE != ($subOrderItem = current($shoppingProduct))) {
			$subOrderKey = key($shoppingProduct);
			next($shoppingProduct);
			foreach ($subOrderItem as $kk => $sp)
			{
				$exist = false;
				foreach ($productStocks as $pstock)
				{
                    //sheldonshi 这里有问题啦   库存信息的校验是以分单来处理的
					//if($sp['product_id'] == $pstock['ProductSysNo'] && $subOrderKey == $pstock['StockSysNo'])
                    if($sp['product_id'] == $pstock['ProductSysNo'] && $packages[$subOrderKey]['psystock'] == $pstock['StockSysNo'])
                    {
						$exist = true;
						if(($pstock['AvailableQty'] + $pstock['VirtualQty'] <= 0) && $sp['type'] != SHOPPING_CART_PRODUCT_TYPE_GIFT)
                        {
							IInventoryStockTTC::update(array('product_id'=>$sp['product_id'], 'num_available'=>$pstock['AvailableQty'], 'virtual_num'=> $pstock['VirtualQty']), array('sys_no'=>$pstock['SysNo']));
							if($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_ZUJIAN)
							{
								return array(
                                    'errCode'=>-15,
                                    'errMsg'=>'组件'.$product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name']."库存不足,请联系客服"
                                );
							}
							return array('errCode'=>-14, 'errMsg'=>'商品'.$product_base_info[$sp['product_id']]['name']."库存不足");
						}
						if($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_GIFT) //赠品
						{
							if($pstock['AvailableQty'] + $pstock['VirtualQty'] < $sp['buy_count'])
                            {
								IInventoryStockTTC::update(array('product_id'=> $sp['product_id'], 'num_available'=> $pstock['AvailableQty'], 'virtual_num'=> $pstock['VirtualQty']), array('sys_no'=> $pstock['SysNo']));
								if(!isset($newOrder['ingoreLackOfGift']))
                                { //如果第一次提交订单
									$giftLackOfStock[$sp['product_id']] = $product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name'];
								}
                                else if($newOrder['ingoreLackOfGift'] == 1)
                                { //用户接受缺少礼品
									$shoppingProduct[$subOrderKey][$kk]['buy_count'] = $pstock['AvailableQty'] + $pstock['VirtualQty'];
									if($shoppingProduct[$subOrderKey][$kk]['buy_count'] <= 0)
                                    {
										unset($shoppingProduct[$subOrderKey][$kk]);
									}
									$lackGiftAndIgnore = true;
								}
                                else //用户不接受，则拒绝下单
								{
									return array(
                                        'errCode'=> -13,
                                        'errMsg'=> '赠品' . $product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name'] . "库存不足"
                                    );
								}
							}
						}
                        else if($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_ZUJIAN)
                        {
							if($pstock['AvailableQty'] + $pstock['VirtualQty'] < $sp['buy_count'])
                            {
								return array(
                                    'errCode'=> -15,
                                    'errMsg'=> '组件' . $product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name'] . "库存不足,请联系客服"
                                );
							}
						}
                        else //主商品
						{
							if(($pstock['AvailableQty'] + $pstock['VirtualQty'] < $sp['buy_count'])
                                &&(($wh_id != 1) || ($product_base_info[$sp['product_id']]['flag'] & FORBID_SET_VIRTUAL) == FORBID_SET_VIRTUAL
                                    ||$product_base_info[$sp['product_id']]['type'] != PRODUCT_TYPE_NORMAL)
							)
                            {
								return array(
                                    'errCode'=> -15,
                                    'errMsg'=> '商品' . $product_base_info[$sp['product_id']]['name'] . "库存不足"
                                );
							}
						}
						$product_base_info[$sp['product_id']]['AvailableQty'] = $pstock['AvailableQty'];
						$product_base_info[$sp['product_id']]['VirtualQty'] = $pstock['VirtualQty'];
						break;
					}
				}
				if(false === $exist)
                {
					return array(
                        'errCode'=> -16,
                        'errMsg'=> '商品' . $product_base_info[$sp['product_id']]['name'] . "暂不销售"
                    );
				}
			}
		}
        */
        $itemsInventoryCheckRet = self::checkItemsInventory($productStocks, $shoppingProduct, $packages, $newOrder, $product_base_info, $wh_id);
		if(false === $itemsInventoryCheckRet)
        {
            return array(
                'errCode'=> self::$errCode,
                'errMsg'=> self::$errMsg,
            );
        }
        $giftLackOfStock = $itemsInventoryCheckRet['giftLackOfStock'];
        $lackGiftAndIgnore = $itemsInventoryCheckRet['lackGiftAndIgnore'];
        $product_base_info = $itemsInventoryCheckRet['product_base_info'];
        $shoppingProduct = $itemsInventoryCheckRet['shoppingProduct'];
        self::Log("检查商品库存！");
        if(count($giftLackOfStock) != 0) {
			$errMsg = "购物车中赠品:";
			foreach ($giftLackOfStock as $key=>$name)
			{
				$errMsg .= $name . "库存不足,";//仅剩下" . $num ."件,";
			}
			$errMsg .= "是否继续下单?";
			return array('errCode'=> -100, 'errMsg'=> $errMsg);
		}
		// 添加提示
		if($lackGiftAndIgnore)
        {
			$newOrder['comment'] .= "\n系统自动备注：用户已接受缺货赠品库存不足。";
		}

		//库存检查结束
        //计算价格
		$orderPrice = 0;
		$totalWeight = 0;
		$totalCut = 0;
		global $_ProductType;
		global $ProductForNongHang;
		$subOrders = array();
		$hasService = false;
		$isEnergySubsidyOrder = false;
		foreach ($shoppingProduct as $subOrderKey => $subOrderItem)
        {

			foreach ($subOrderItem as $sp)
            {
                //sheldnshi
				$subOrders[$subOrderKey]['product_ids'][] = $sp['product_id']; //clark 记录商品ID
				$totalWeight += $sp['buy_count'] * $product_base_info[$sp['product_id']]['weight'];
				@$subOrders[$subOrderKey]['totalWeight'] += $sp['buy_count'] * $product_base_info[$sp['product_id']]['weight'];

				if(!isset($subOrders[$subOrderKey]['flag']))
                {
					$subOrders[$subOrderKey]['flag'] = 0;
				}
				if($product_base_info[$sp['product_id']]['type'] == $_ProductType['Service'])
                {
					$subOrders[$subOrderKey]['flag'] |= ORDER_HAS_SERVICE; //记录订单中是否有服务类商品
					$hasService = true;
				}
				if(in_array($sp['product_id'], $ProductForNongHang))
                {
					$subOrders[$subOrderKey]['flag'] |= ORDER_NONGHANG; //订单中包含农行商品
					$newOrder['isVat'] = self::NO_INVOICE; //则不开发票
				}

				if(isset($userInfo['type']))
                {
					global $_USER_TYPE;
					if($_USER_TYPE['EnterpriseUser'] == $userInfo['type'])
                    {
						$subOrders[$subOrderKey]['flag'] |= ORDER_ENTERPRISE_USER;
					}
					else if($_USER_TYPE['ChaohuoUser'] == $userInfo['type'])
					{
						$subOrders[$subOrderKey]['flag'] |= ORDER_CHAOHUO_USER;
					}
                    else if($_USER_TYPE['WholeSalerUser'] == $userInfo['type'])
					{
						$subOrders[$subOrderKey]['flag'] |= ORDER_WHOLESALER_USER;
					}
                    else if($_USER_TYPE['RetailersUser'] == $userInfo['type'])
					{
						$subOrders[$subOrderKey]['flag'] |= ORDER_RETAILERS_USER;
					}
				}
                //商品价格  sheldonshi  这里是多价后的价格
                $product_base_info[$sp['product_id']]['price'] = $sp['price'];
				if($sp['type'] != SHOPPING_CART_PRODUCT_TYPE_NORMAL)
                {
					continue;
				}

				//ixiuzeng添加,订单中含有限时抢购或者二手商品，增加一个标志位
				if((TIME_LIMITED_RUSHING_BUY == ($product_base_info[$sp['product_id']]['flag'] & TIME_LIMITED_RUSHING_BUY)
					|| OTHER_TIME_LIMITED_RUSHING_BUY == ($product_base_info[$sp['product_id']]['flag'] & OTHER_TIME_LIMITED_RUSHING_BUY)
					|| ($product_base_info[$sp['product_id']]['type'] == $_ProductType['SecondHand']))
					&& $_PAY_MODE[$wh_id][$newOrder['payType']]['IsNet'] == 1 ) {

					if(!isset($subOrders[$subOrderKey]['flag']))
                    {
						$subOrders[$subOrderKey]['flag'] = ORDER_RUSHING_BUY_ONLINE_PAY;
					}
					else
                    {
						$subOrders[$subOrderKey]['flag'] = $subOrders[$subOrderKey]['flag'] | ORDER_RUSHING_BUY_ONLINE_PAY;
					}
				}

				// 如果是节能补贴商品，而且补贴身份信息完整，则判定为节能补贴订单
				if(PRODUCT_ENERGY_SUBSIDY == ($product_base_info[$sp['product_id']]['flag'] & PRODUCT_ENERGY_SUBSIDY)
                    && self::esInfoCheck($newOrder))
                {
                    $isEnergySubsidyOrder = TRUE;
                    if(!isset($subOrders[$subOrderKey]['flag'])) {
                        $subOrders[$subOrderKey]['flag'] = ORDER_ENERGY_SUBSIDY;
                    }
                    else
                    {
                        $subOrders[$subOrderKey]['flag'] = $subOrders[$subOrderKey]['flag'] | ORDER_ENERGY_SUBSIDY;
                    }
				}
			}
		}
		if(!empty($promotion))
        {
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
        //批价明细
        $priceDetails = array();
        $energySaveDiscount = 0;
		foreach($items as $it)
		{
			$it_str = ToolUtil::gbJsonEncode($it);
			//$subOrderKey = $it['psystock'];
            $subOrderKey = $it['divide_id'];
			// MARK 商品的核对价格，这个$pPrice定义需要确认
			if( $it['package_id'] == 0 )
			{
				// 经过批价的商品，该商品的总的减免价格
                $ptotalCut = 0;
                //是否有随心配
                if ($it['main_product_id'] > 0 && $it['match_num'] > 0) {
                    $ptotalCut = $it['match_num'] * $it['match_cut'];
                }
				// 该商品的多价后，促销前的价格
				$pPrice = $it['total_price_after'] - $ptotalCut;

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
                if ($it['main_product_id'] > 0 && $it['match_num'] > 0) {
                    $ptotalCut += $it['match_num'] * $it['match_cut'];
                }
				//$pPrice = $it['promotion_price'] + $it['promotion_discount'] - $it['cash_back'] * $it['buy_count'];
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
            if($isEnergySubsidyOrder && 0 == $energySaveDiscount)
            {
                //节能补贴需要把节能补贴的减免加到商品单价上
                $energySaveDiscount = $it['energy_save_discount'];
                $couponInfo['energy_save_name'] = $it['energy_save_name'];
                $product_base_info[$it['product_id']]['price'] += $energySaveDiscount;
                @$couponInfo['subOrders'][$subOrderKey]['coupon_amt'] = $energySaveDiscount;
                @$couponInfo['subOrders'][$subOrderKey]['pids'][] = $it['product_id'];
            }
            //这里加入批价明细吧，不了没地方加了
            self::setPriceDetail($priceDetails, $it, $wh_id);
		}
		self::Log("分摊后：".ToolUtil::gbJsonEncode($couponInfo));

		if($newOrder['payType'] == COD)
        { //货到付款抹去分
			self::Log("货到付款去分之前, $orderPrice");
			$orderPrice = 0;
			self::Log("货到付款商品订单价格".$orderPrice);
			foreach ($subOrders as $subOrderKey => $so)
            {
                $subOrders[$subOrderKey]['cod_adjust_price'] = $subOrders[$subOrderKey]['orderPrice'];
				$subOrders[$subOrderKey]['orderPrice'] = 10 * bcdiv($subOrders[$subOrderKey]['orderPrice'], 10, 0);
				$orderPrice += $subOrders[$subOrderKey]['orderPrice'];
                $subOrders[$subOrderKey]['cod_adjust_price'] = $subOrders[$subOrderKey]['orderPrice'] - $subOrders[$subOrderKey]['cod_adjust_price'];
				self::Log("货到付款抹去分,+{$subOrders[$subOrderKey]['orderPrice']}:".$orderPrice);
			}
		}
        //前端提交的价格也是多价后的价格
		if(bccomp($orderPrice, $newOrder['Price'], 0) != 0)
        {
			self::$errCode = -2031;
			self::$errMsg = "总价：后台计算的订单价格{$orderPrice}与前台提交价格{$newOrder['Price']}不一致";
            self::Log("总价：后台计算的订单价格{$orderPrice}与前台提交价格{$newOrder['Price']}不一致");
            return array("errCode"=>-15, "errMsg" => "受市场行情影响，部分商品价格发生变化，请确认后提交订单。");
			//return false;
		}

        self::Log("suborders:". ToolUtil::gbJsonEncode($subOrders));
        //前端分单的子单价格
		foreach ($subOrders as $subOrderKey=> $so)
        {
			if(bccomp($so['orderPrice'], $newOrder['suborders'][$subOrderKey]['price'], 0) != 0)
            {
				self::$errCode = -2030;
				self::$errMsg = "子订单{$subOrderKey}：后台计算的订单价格{$so['orderPrice']}与前台提交价格{$newOrder['suborders'][$subOrderKey]['price']}不一致";
				self::Log("子订单{$subOrderKey}：后台计算的订单价格{$so['orderPrice']}与前台提交价格{$newOrder['suborders'][$subOrderKey]['price']}不一致");
                return array("errCode"=>-15, "errMsg" => "受市场行情影响，部分商品价格发生变化，请确认后提交订单。");
                //return false;
			}
		}
        //节能补贴临时搞搞 Start
        if($isEnergySubsidyOrder)
        {
            $couponInfo['amt'] = $energySaveDiscount;
            $couponInfo['code'] = "jieneng";
            $couponInfo['type'] = 1;
            $orderPrice += $energySaveDiscount;
            foreach ($subOrders as $subOrderKey=> $so)
            {
               @$subOrders[$subOrderKey]['orderPrice'] = $so['orderPrice'] + $energySaveDiscount;
            }
        }
        self::Log("价格检查一致结果 orderPrice:" . ToolUtil::gbJsonEncode($subOrders));
        //节能补贴临时搞搞 End
		self::Log("计算的订单价格与前台订单价格一致", false);

        /*
		$pointMax -= $totalCut;
		$pointMax /= 10;
		$pointMax = ceil($pointMax < $orderPrice ? $pointMax : $orderPrice);
		$pointMax *= 10;
		$pointMin = ceil($pointMin);
		//计算价格结束
		//检查积分使用情况
		if($newOrder['point'] < $pointMin || $newOrder['point'] > $pointMax)
        {
			return array(
                'errCode'=> -10,
                'errMsg'=> "您本次订单最少需使用" . ($pointMin / 10) . "个积分,最多能使用" . ($pointMax / 10) . "个积分"
            );
		}
        self::Log("检查积分使用情况", false);
		//拉取用户积分，确保用户使用的积分不超过其拥有的积分,并计算分别需要的现金积分和促销积分，优先使用现金积分
		$cash_point_used = 0;
		$promotion_point_used = 0;
		if($newOrder['point'] > 0 )
		{
			if($newOrder['point'] / 10 < $userInfo['cash_point'] || $newOrder['point'] / 10 == $userInfo['cash_point'])
			{
				$cash_point_used = $newOrder['point'];
			}
			else if($newOrder['point'] / 10 > $userInfo['cash_point']
                && (($newOrder['point'] / 10 < ($userInfo['cash_point']+$userInfo['promotion_point']))
				|| ($newOrder['point'] / 10 == ($userInfo['cash_point']+$userInfo['promotion_point']))))
			{
				$cash_point_used = ($userInfo['cash_point'] <0) ? 0 : $userInfo['cash_point'] * 10;
				$promotion_point_used = $newOrder['point'] - $cash_point_used;
			}
			else
			{
				return array(
                    'errCode'=>-34,
                    'errMsg'=>"您账户积分总额为{$userInfo['point']}，最多只能使用{$userInfo['point']}个积分"
                );
			}
		}
        */
        $cash_point_used = 0;
        $promotion_point_used = 0;
        $pointUseCheckRet = self::checkUserPointsUse($newOrder, $userInfo, $orderPrice, $totalCut, $pointMax, $pointMin);
        if(false === $pointUseCheckRet)
        {
            return array(
                'errCode'=> self::$errCode,
                'errMsg'=> self::$errMsg,
            );
        }
        $cash_point_used = $pointUseCheckRet['cash_point_used'];
        $promotion_point_used = $pointUseCheckRet['promotion_point_used'];
        self::Log("检查积分使用情况", false);
        //商品支付总额，（不包括运费）
		$product_cash = $orderPrice - $newOrder['point'] - $couponInfo['amt'];
		if( bccomp( $product_cash, 0, 0 ) < 0 )
		{
			self::$errCode = -2040;
			self::$errMsg = '用户实际需要支付的货款金额为负数';
            self::Log("用户实际需要支付的货款金额为负数[product_cash:{$product_cash}]");
			return false;
		}

        //计算运费
        $destination = $newOrder['receiveAddrId'];
        $user_level = empty($userInfo['level']) ? 0 : $userInfo['level'];
        $price_without_point = $orderPrice - $couponInfo['amt'];
        $orderShipPrice = 0;
        $mlog->start();
        if(strcmp($divideOrderType, "default") === 0)
        {
            //默认使用默认的
            $shipRet = IShoppingProcess::getDeliveryInfo4PlaceOrder($items, $inventorys, $wh_id, $destination, $price_without_point, $uid, $user_level, SCENE_SHOPPING_ORDER);
            if(false === $shipRet)
            {
                self::$errCode = IShoppingProcess::$errCode;
                self::$errMsg = IShoppingProcess::$errMsg;
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETDELIVERYINFO4ORDER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                self::Log("getDeliveryInfo4PlaceOrder false!errCode:" . self::$errCode . ";errMsg:".self::$errMsg);
                return false;
            }
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETDELIVERYINFO4ORDER'], 0, 0, LocalServerIP, LocalServerIP);
            $shipRet = array("default" => $shipRet);
        }
        else
        {
            //拉取ors
            $shipRet = IShoppingProcess::getDeliveryInfoOrs4Order($items, $inventorys, $wh_id, $destination, $price_without_point, $uid, $user_level, SCENE_SHOPPING_ORDER);
            if(false === $shipRet)
            {
                self::$errCode = IShoppingProcess::$errCode;
                self::$errMsg = IShoppingProcess::$errMsg;
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETDELIVERYINFOORS4ORDER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                self::Log("getDeliveryInfo4PlaceOrder false!errCode:" . self::$errCode . ";errMsg:".self::$errMsg);
                //return false;
            }
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETDELIVERYINFOORS4ORDER'], 0, 0, LocalServerIP, LocalServerIP);
        }
        self::Log("获取配送信息！getDeliveryInfo:[divideOrderType:{$divideOrderType}][shipRet:" . ToolUtil::gbJsonEncode($shipRet) . "]");
        $deliveryRet = self::checkDeliveryInfo($shipRet, $divideOrderType, $subOrders, $newOrder, $destination);
        if(false === $deliveryRet)
        {
            self::Log("检查配送信息失败！");
            return array(
                'errCode'=> self::$errCode,
                'errMsg'=> self::$errMsg,
            );
        }
        $orderShipPrice = $deliveryRet['orderShipPrice'];
        /*
        $shipInfo = $shipRet['shippingType'];
        $packageInfo = $shipRet['packages'];

        //同时检查能否模糊开票，开增值发票
        if(isset($shipRet['availableInvoices']['isCanVAT']) && $shipRet['availableInvoices']['isCanVAT'] == false && $newOrder['invoiceType'] == INVOICE_TYPE_VAT) {

            return array('errCode'=> -20, 'errMsg'=> '您的订单中有商品不能开增值税发票');
        }
        $isShipTypenotAva = true;
        foreach($shipInfo as $key => $ship)
        {
            if($newOrder['shipType'] == $ship['ShippingId'])
            {
                $isShipTypenotAva = false;
                $orderShipPrice = $ship['shippingPrice'];
                foreach ($subOrders as $subOrderKey => $so)
                {
                    $subOrders[$subOrderKey]['orderShipPrice'] = $ship['subOrder'][$subOrderKey]['shippingPrice'];
                    //随心送  新接入  1-正常配送  2-随心送
                    if(isset($newOrder['suborders'][$subOrderKey]['isCanXpress']) && $newOrder['suborders'][$subOrderKey]['isCanXpress'] == 1)
                    {
                        //如果有随心送且是选择了随心送则校验
                        if(!isset($ship['subOrder'][$subOrderKey]['isCanXpress'])
                            || $ship['subOrder'][$subOrderKey]['isCanXpress'] != $newOrder['suborders'][$subOrderKey]['isCanXpress']
                        )
                        {
                            $tmpErrMsg = self::$errMsg;
                            self::$errCode = self::$errCode;
                            self::$errMsg = basename(__FILE__) . "，验证配送时间错误，" . self::$errMsg . ",subOrderItem" . var_export($subOrderItem, true);
                            return array('errCode' => self::$errCode, "errMsg" => $tmpErrMsg);
                        }
                        $subOrders[$subOrderKey]['isCanXpress'] = 2;
                        //随心送的时间需要为下一天的第一个时间span
                        $newOrder['suborders'][$subOrderKey]['expectDate'] = 0;
                        $newOrder['suborders'][$subOrderKey]['expectSpan'] = 1; // 期望时间
                    }
                    else
                    {
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
                }
                break;
            }
        }
        if($isShipTypenotAva)
        {
            return array('errCode'=> -17, 'errMsg'=> "购物车中有商品不支持您选择的运送方式");
        }
        foreach($packageInfo as $subKey=>$package)
        {
            $subOrders[$subKey]['seller_id'] = $package['seller_id'];
            $subOrders[$subKey]['sale_mode'] = $package['sale_mode'];
            $subOrders[$subKey]['seller_address_id'] = $package['seller_stock_id'];
            //大中小件
            $subOrders[$subKey]['order_size'] = $package['order_size'];
            $subOrders[$subKey]['order_volume'] = $package['order_volume'];
            $subOrders[$subKey]['order_longest'] = $package['order_longest'];
            $subOrders[$subKey]['order_weight'] = $package['totalWeight'];
        }
        */
        self::Log("配送方式校验" . ToolUtil::gbJsonEncode($deliveryRet));
        //运费校验
		if(bccomp($newOrder['shippingPrice'], $orderShipPrice, 0) != 0) {
			self::$errCode = -2038;
			self::$errMsg = 'web传入的运费:' . $newOrder['shippingPrice'] . '后台重新计算的运费:' . $orderShipPrice . '计算的订单运费价格与前台订单运费价格不一致';
			self::Log('web传入的运费:' . $newOrder['shippingPrice'] . '后台重新计算的运费:' . $orderShipPrice . '计算的订单运费价格与前台订单运费价格不一致');
            return array("errCode"=>-15, "errMsg" => "受市场行情影响，订单运费发生变化，请确认后提交订单。");
            //return false;
		}
		//货票分离增加运费,前台过滤掉拆单情况
		if(isset($newOrder['separateInvoice']) && $newOrder['separateInvoice'] == 1)
        {
			$orderShipPrice += 1000;
			foreach ($subOrders as $subOrderKey => $so) {
				$subOrders[$subOrderKey]['orderShipPrice'] += 1000;
			}
		}
		foreach ($subOrders as $subOrderKey => $so) {
			if($so['orderShipPrice'] < 0) {
				self::$errCode = -2044;
				self::$errMsg = '订单运费计算失败';
                self::Log('订单运费计算失败'.$so['orderShipPrice']);
				return false;
			}
		}



        //订单总的金额
		$cash = $orderShipPrice + $product_cash;
        //处理分期付款的事情
        if($isInstallmentOrder)
        {
            $limitMin = INSTALLMENT_LIMIT_PRICE_MIN;
            $limitMax = INSTALLMENT_LIMIT_PRICE_MAX;

            if($cash < $limitMin)
            {
                return  array('errCode'=>-51, 'errMsg'=>"抱歉，分期付款订单金额最低不得低于" . $limitMin / 100 . "元，请您重新选择商品");
            }
            else if($cash > $limitMax)
            {
                return  array('errCode'=>-51, 'errMsg'=>"抱歉，分期付款订单金额最高不得高于" . $limitMax / 100 . "元，请您重新选择商品");
            }
            if ($cash < $installment['minprice'] || $cash > $installment['maxprice'])
            {
                return  array('errCode'=>-51, 'errMsg'=>"您的订单金额为" . $cash / 100 . "元，不能选择{$newOrder['installment_num']}期");
            }
            $cashToPay = $newOrder['installment_num'] * round($installment['rate'] * $cash / $newOrder['installment_num']);
            $cashPerMonth = round($installment['rate'] * $cash / $newOrder['installment_num']);
        }

		//开始分摊优惠券&
		self::Log("开始分摊优惠券积分");
		if($newOrder['point'] > 0)
        {
			ksort($subOrders);
		}
		//分摊优惠券到商品
        self::Log('分摊优惠券到商品');
		if($couponInfo['amt'] > 0)
        {
			foreach ($subOrders as $subOrderKey => $so) {
				$subOrders[$subOrderKey]['couponamt'] = $couponInfo['subOrders'][$subOrderKey]['coupon_amt'];
			}
            if(empty($promotion))
            {
                $lastPid = 0;
                foreach ($couponInfo['subOrders'] as $subKey=> $so) {
                    $remain = $so['coupon_amt'];
                    foreach ($so['pids'] as $pid) {
                        if(isset($couponInfo['subOrders'][$subKey]['apport'][$pid]))
                        {
                            continue;
                        }
                        $tmpCoupon = 10 * bcdiv($so['coupon_amt'] * $shoppingProduct[$subKey][$pid]['total_price'], 10 * $so['orderAmt'], 0);
                        @$couponInfo['subOrders'][$subKey]['apport'][$pid] = $tmpCoupon<=$remain ? $tmpCoupon : $remain;
                        $remain -= $couponInfo['subOrders'][$subKey]['apport'][$pid];
                        $lastPid = $pid;
                    }

                    if($remain > 0 && $lastPid != 0 ) {
                        $couponInfo['subOrders'][$subKey]['apport'][$lastPid] += $remain;
                    }
                }
            }
		}
		//分摊积分
        self::Log('分摊积分');
		$temp_cash_point = $cash_point_used;
		$i = 1;
		$order_num = 0;
		if($newOrder['point'] > 0) {
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
				if($tmp > 0) {
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

		//开始下单，先起事务， 插入orderdb， 扣 mssql 库存， commit事务or callback事务
		//获取新订单号
		self::Log("获取新订单号");
		$orderNum = count($subOrders);
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['idGenerator']['req']);
        $mlog->start();
		if($orderNum > 1) {
			$newOrderId = IIdGenerator4Order::getNewId($uid, 'so_sequence', $orderNum + 1);
		}
		else {
			$newOrderId = IIdGenerator4Order::getNewId($uid, 'so_sequence', $orderNum);
		}
		if(false === $newOrderId || $newOrderId <= 0) {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['idGenerator']['failed']);
			self::$errCode = IIdGenerator4Order::$errCode;
			self::$errMsg = IIdGenerator4Order::$errMsg;
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['IIDGENERATOR4ORDER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
            self::Log("IIdGenerator4Order newOrderId 获取ID错误 errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
			return false;
		}
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['IIDGENERATOR4ORDER'], 0, 0, LocalServerIP, LocalServerIP);
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['idGenerator']['succ']);
		$orderstrforlog = '';
		$cc = ($orderNum > 1) ? $orderNum + 1 : $orderNum;
		for ($i = ($orderNum > 1 ? 1 : 0); $i < $cc; $i++) {
			$orderstrforlog .= "," . ($newOrderId + $i);
		}

		$parentOrderId = sprintf("%s%09d", "1", $newOrderId % 1000000000);
		$parentOrderInInt = $newOrderId;
		//获取订单发票id
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['idGenerator']['req']);
        $mlog->start();
		$invoice_id = IIdGenerator4Order::getNewId($uid, 'so_valueadded_invoice_sequence', $orderNum);
		if(false === $invoice_id) {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['idGenerator']['failed']);
			self::$errCode = IIdGenerator4Order::$errCode;
			self::$errMsg = IIdGenerator4Order::$errMsg;
            self::Log("IIdGenerator4Order invoice_id 获取ID错误 errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['IIDGENERATOR4ORDER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
			return false;
		}
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['IIDGENERATOR4ORDER'], 0, 0, LocalServerIP, LocalServerIP);
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['idGenerator']['succ']);

		//获取随心配id
	    $match_id_start = 0;
		$needCount = 0;
		$itemCount = 0;
		foreach ($shoppingProduct as $key => $subOrderItem) {
			foreach ($subOrderItem as $sp) {
				$itemCount++;
				if($sp['type'] != SHOPPING_CART_PRODUCT_TYPE_NORMAL || $sp['main_product_id'] == 0) {
					continue;
				}
				$needCount++;
			}
		}
		if($needCount > 0) {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['idGenerator']['req']);
            $mlog->start();
			$match_id_start = IIdGenerator4Order::getNewId($uid, 'SO_SaleRule_Sequence', $needCount);
			if(false === $match_id_start) {
                ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['idGenerator']['failed']);
				self::$errCode = -2036;
				self::$errMsg = '获取订单随心配seq失败' . IIdGenerator4Order::$errMsg;
                self::Log("IIdGenerator4Order match_id_start 获取ID错误 errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['IIDGENERATOR4ORDER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
				return false;
			}
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['IIDGENERATOR4ORDER'], 0, 0, LocalServerIP, LocalServerIP);
		}
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['idGenerator']['succ']);
		//获取订单商品的seqid
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['idGenerator']['req']);
        $mlog->start();
		$itemStartID = IIdGenerator4Order::getNewId($uid, 'So_Item_Sequence', $itemCount);
		if(false === $itemStartID) {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['idGenerator']['failed']);
			self::$errCode = -2047;
			self::$errMsg = '获取订单商品id失败' . IIdGenerator4Order::$errMsg;
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['IIDGENERATOR4ORDER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
            self::Log("IIdGenerator4Order itemStartID 获取ID错误 errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
			return false;
		}
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['IIDGENERATOR4ORDER'], 0, 0, LocalServerIP, LocalServerIP);
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['idGenerator']['succ']);
		//处理单引号等特殊字符
		foreach ($newOrder as $k => $no) {
			if($k == 'suborders' || $k == 'buy_one_key' || $k == 'send_coupon_success_info' || $k == 'send_coupon_record_info') {
				continue;
			}
			$newOrder[$k] = addslashes($no);
		}

		if( self::NO_INVOICE == $newOrder['isVat'] ) //如果不需要开发票，那么其他字段也置为空
		{
			$newOrder['invoiceType'] = '';
			$newOrder['invoiceTitle'] = '';
			$newOrder['invoiceContent'] = '';
		}

		if($newOrder['invoiceType'] != INVOICE_TYPE_VAT)
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
		if(!isset($orderDb)) {
			$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
			if(empty($orderDb)) {
                ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['orderDB']['failed']);
				self::$errCode = ToolUtil::$errCode;
				self::$errMsg = ToolUtil::$errMsg;
                self::Log("orderDb 连接错误！ errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
				return false;
			}
		}
		self::Log("开启orderdb事务失败");
        $mlog->start();
        $mlog->start();
		$sql = "begin transaction";
		$ret = $orderDb->execSql($sql);
		if(false === $ret) {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['orderDB']['failed']);
			self::$errCode = -2032 . " " . $orderDb->errCode;
			self::$errMsg = '开启orderdb事务失败' . $orderDb->errMsg;
            self::Log("orderDb 开启orderdb事务失败！ errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ICSON_ORDER_CORE'], $orderDb->errCode, 1, LocalServerIP, LocalServerIP);
			return false;
		}

        $uniorder_parentOrder = array();
        $activeInfoList = array();

        //库存双写 S sheldonshi
        $inventorysAllData = array();
        //库存双写 E sheldonshi
		//如果发生了拆单，插入父订单
		$now = time();
		if($orderNum > 1) {
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
				'price_cut'           => $totalCut,                                 //套餐随心配的优惠
				'coupon_type'         => $couponInfo['type'],
				'coupon_code'         => $couponInfo['code'],
				'coupon_amt'          => $couponInfo['amt'],
				'point'               => 0,
				'point_pay'           => $newOrder['point'],
				'promotion_point'     => $promotion_point_used,
				'cash_point'          => $cash_point_used,
				'cash'                => $isInstallmentOrder ? $cashToPay : $cash,
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
            if($isInstallmentOrder)
            {
                $newItem['installment_bank'] = $installment['BankSynNo'];
                $newItem['installment_num'] = $newOrder['installment_num'];
                $newItem['cash_per_month'] = $cashPerMonth;
                $newItem['rate'] = $installment['Rate'];
                $newItem['back_rate'] = $installment['BackRate'];
            }
            $uniorder_parentOrder = $newItem;
			$ret = $orderDb->insert("t_orders_{$db_tab_index['table']}", $newItem);
			if(false === $ret) {
                ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['orderDB']['failed']);
				self::$errCode = -2033;
				self::$errMsg = '执行sql语句失败' . $orderDb->errMsg;
				$sql = "rollback";
				$orderDb->execSql($sql);
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ICSON_ORDER_CORE'], $orderDb->errCode, 1, LocalServerIP, LocalServerIP);
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
            'isors'        => strcmp($divideOrderType, "default") === 0 ? 0 : 1,
		);
		$orderToSZ = array(
			'oid' => $parentOrderId,
			'status' => 0,
			//'cash' => $cash,
            'cash' => $isInstallmentOrder ? $cashToPay : $cash,
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
		if(false === $ret) {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['inventoryDB']['failed']);
			self::$errCode = -2035;
			self::$errMsg = '开启ms sql事务失败' . $msSQL->errMsg;
			$sql = "rollback";
			$orderDb->execSql($sql);
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['INVENTORY_MANAGER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
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

 		$uniorder_orderList = array();
        $uniorder_tradeList = array();
        $installmentSubCount = 1;
		foreach ($shoppingProduct as $subOrderKey => $subOrder)
        {
            //每单支付金额=商品多价后总价+运费-促销/优惠券分摊-积分
			$cash = $subOrders[$subOrderKey]['orderPrice']
				+ $subOrders[$subOrderKey]['orderShipPrice']
				- (isset($subOrders[$subOrderKey]['couponamt']) ? $subOrders[$subOrderKey]['couponamt'] : 0)
				- (isset($subOrders[$subOrderKey]['point']) ? $subOrders[$subOrderKey]['point'] : 0);

			$isPayed = ($cash <= 0 ? 1 : 0);
            //处理分期付款 S sheldonshi
            if($isInstallmentOrder)
            {
                if($installmentSubCount == count($shoppingProduct))
                {
                    $subCashToPay = $cashToPay;
                    $subCashPerMonth = $cashPerMonth;
                }
                else
                {
                    $subCashToPay = $newOrder['installment_num'] * round($installment['rate'] * $cash / $newOrder['installment_num']);
                    $cashToPay -= $subCashToPay;
                    $subCashPerMonth = round($installment['rate'] * $cash / $newOrder['installment_num']);
                    $cashPerMonth -= $subCashPerMonth;
                }
                $installmentSubCount++;
            }
            //处理分期付款 E sheldonshi
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
			if($newOrder['separateInvoice'] == 1) {
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
					//'stockNo'          => $subOrderKey,
                    'stockNo'          => $packages[$subOrderKey]['psystock'],
				);
				$ret = $orderDb->insert("t_order_invoice_address_{$db_tab_index['table']}", $newInvAddr);
				if(false === $ret) {
                    ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['orderDB']['failed']);
					self::$errCode = -2050;
					self::$errMsg = '执行sql语句失败' . $orderDb->errMsg;
					$sql = "rollback";
					$msSQL->execSql($sql);
					$orderDb->execSql($sql);
                    $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ICSON_ORDER_CORE'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                    self::Log("orderDb 执行sql语句失败！ errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
					return false;
				}
			}
            $subOrderFlag = isset($subOrders[$subOrderKey]['flag']) ? $subOrders[$subOrderKey]['flag'] : 0;
            $subOrderFlag = $isInstallmentOrder ? ($subOrderFlag|ORDER_INSTALLMENT_FLAG) : $subOrderFlag;
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
				'cash'                  => $isInstallmentOrder ? $subCashToPay : $cash,
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
				//'stockNo'               => $subOrderKey,
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
			    //大中小件
                'Weight'                => isset($subOrders[$subOrderKey]['order_weight']) ? $subOrders[$subOrderKey]['order_weight'] : 0,
                'SaleSpec'              => isset($subOrders[$subOrderKey]['order_size']) ? $subOrders[$subOrderKey]['order_size'] : 0,
                'Volume'                => isset($subOrders[$subOrderKey]['order_volume']) ? $subOrders[$subOrderKey]['order_volume'] : 0,
                'LongestEdge'           => isset($subOrders[$subOrderKey]['order_longest']) ? $subOrders[$subOrderKey]['order_longest'] : 0,
                //随心送
                'shipping_flag'         => isset($subOrders[$subOrderKey]['isCanXpress']) ? $subOrders[$subOrderKey]['isCanXpress'] : 1,
            );
            if($isInstallmentOrder)
            {
                $newItem['installment_bank'] = $installment['BankSynNo'];
                $newItem['installment_num'] = $newOrder['installment_num'];
                $newItem['cash_per_month'] = $subCashPerMonth;
                $newItem['rate'] = $installment['Rate'];
                $newItem['back_rate'] = $installment['BackRate'];
            }
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
			if(false === $ret) {
                ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['orderDB']['failed']);
				self::$errCode = -2033;
				self::$errMsg = '执行sql语句失败' . $orderDb->errMsg;
				$sql = "rollback";
				$msSQL->execSql($sql);
				$orderDb->execSql($sql);
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ICSON_ORDER_CORE'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                self::Log("orderDb 执行sql语句失败！ errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
				return false;
			}

			// 子订单数据，以订单号作为key
			$ORS_Report_Data['childorderid'][$oid] = array(
				'products' => array(),
				'order_char_id' => $oid,
				//'stock' => $subOrderKey,
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
			if(false === $ret) {
                ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['orderDB']['failed']);
				self::$errCode = -2050;
				self::$errMsg = '执行sql语句失败' . $orderDb->errMsg;
				$sql = "rollback";
				$msSQL->execSql($sql);
				$orderDb->execSql($sql);
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ICSON_ORDER_CORE'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                self::Log("orderDb 执行sql语句失败！ errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
				return false;
			}

			$_local_ip = ToolUtil::getLocalIp(0);
			$_local_ip = explode('.', $_local_ip);
			$_inserter = empty($_local_ip[3]) ? 7 : intval($_local_ip[3]);
			reset($subOrder);
            foreach ($subOrder as $sp) {
				//插入随心配表
				if($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL && $sp['main_product_id'] != 0 && $sp['matchNum'] > 0)
                {
					$sql = "insert into t_order_match_{$db_tab_index['table']} values($match_id_start, '{$newOrderId}', {$sp['product_id']}, {$sp['main_product_id']},{$sp['matchNum']}, {$sp['cashCutPerItem']}, $now, $wh_id )";
                    $ret = $orderDb->execSql($sql);
					if(false === $ret) {
						self::$errCode = -2036;
						self::$errMsg = '执行sql语句失败' . $orderDb->errMsg;
						$sql = "rollback";
						$msSQL->execSql($sql);
						$orderDb->execSql($sql);
                        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ICSON_ORDER_CORE'], self::$errCode, 1, LocalServerIP, LocalServerIP);
						return false;
					}
					++$match_id_start;
				}

				$buy_count_positive = $sp['buy_count'];
				$buy_count_negative = $sp['buy_count'] * (-1);
				foreach ($productStocks as $pstock) {
                    //$subOrders[$subOrderKey]['couponamt']
                    /*
					if($subOrderKey != $pstock['StockSysNo']) {
						continue;
					}
                    */
                    if($packages[$subOrderKey]['psystock'] != $pstock['StockSysNo'])
                    {
                        continue;
                    }
                    $subKey = $pstock['StockSysNo'];

					if($sp['product_id'] == $pstock['ProductSysNo']) {

						if($pstock['AvailableQty'] + $pstock['VirtualQty'] >= $sp['buy_count']) { //可用大于购买数量
							//$sql = "update Inventory_stock set AvailableQty = AvailableQty - {$sp['buy_count']}, OrderQty = OrderQty + {$sp['buy_count']}, rowModifydate='{$timeNow}' where AvailableQty+VirtualQty>={$sp['buy_count']} AND ProductSysNo={$sp['product_id']} and StockSysNo=$subOrderKey";
                            $sql = "update Inventory_stock set AvailableQty = AvailableQty - {$sp['buy_count']}, OrderQty = OrderQty + {$sp['buy_count']}, rowModifydate='{$timeNow}' where AvailableQty+VirtualQty>={$sp['buy_count']} AND ProductSysNo={$sp['product_id']} and StockSysNo=$subKey";
							$ret = $msSQL->execSql($sql);
							$cnt = $msSQL->getAffectedRows();
							if((false === $ret) || (1 != $cnt)) {
                                ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['inventoryDB']['failed']);
								self::$errCode = -2047;
								self::$errMsg = "扣减ms sql库存失败({$sp['product_id'] })" . $msSQL->errMsg;
								$sql = "rollback";
								$msSQL->execSql($sql);
								$orderDb->execSql($sql);
                                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['INVENTORY_MANAGER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                                self::Log("扣减ms sql库存失败！[cnt:{$cnt}] errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
								return false;
							}

							//ixiuzeng添加，将Inventroy_Stock的库存修改记录插入到Inventory_Flow表中
							/*
                            $sql = "insert into Inventory_Flow values
									($subOrderKey, {$sp['product_id']}, 1, $newOrderId, 2, $buy_count_negative,'$timeNow', '$timeNow',$_inserter),
									($subOrderKey, {$sp['product_id']}, 1, $newOrderId, 4, $buy_count_positive,'$timeNow', '$timeNow',$_inserter)";
							*/
                            $sql = "insert into Inventory_Flow values
									($subKey, {$sp['product_id']}, 1, $newOrderId, 2, $buy_count_negative,'$timeNow', '$timeNow',$_inserter),
									($subKey, {$sp['product_id']}, 1, $newOrderId, 4, $buy_count_positive,'$timeNow', '$timeNow',$_inserter)";
							$ret = $msSQL->execSql($sql);
							$cnt = $msSQL->getAffectedRows();
							if((false === $ret) || (2 != $cnt)) {
                                ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['inventoryDB']['failed']);
								self::$errCode = -2046;
								self::$errMsg = "插入ms sql-Inventory_Flow表失败({$sp['product_id'] })" . $msSQL->errMsg;
								$sql = "rollback";
								$msSQL->execSql($sql);
								$orderDb->execSql($sql);
                                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['INVENTORY_MANAGER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
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
							if($ret === false || 1 != $cnt) {
                                ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['inventoryDB']['failed']);
								self::$errCode = -2048;
								self::$errMsg = "扣减ms sql库存失败({$sp['product_id'] })" . $msSQL->errMsg;
								$sql = "rollback";
								$msSQL->execSql($sql);
								$orderDb->execSql($sql);
                                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['INVENTORY_MANAGER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
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
							if((false === $ret) || (3 != $cnt)) {
                                ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['inventoryDB']['failed']);
								self::$errCode = -2045;
								self::$errMsg = "插入ms sql-Inventory_Flow表失败({$sp['product_id'] })" . $msSQL->errMsg;
								$sql = "rollback";
								$msSQL->execSql($sql);
								$orderDb->execSql($sql);
                                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['INVENTORY_MANAGER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                                self::Log("插入ms sql-Inventory_Flow表失败！[cnt:{$cnt}] errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
								return false;
							}


							//插入虚库表
                            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['idGenerator']['req']);
                            $mlog->start();
                            $auto_id = IIdGenerator4Order::getNewId($uid, 'SO_ProductVirtue_Sequence');
							if(false === $auto_id) {
                                ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['idGenerator']['failed']);
								self::$errCode = -2089;
								self::$errMsg = '获取订单虚库记录sql失败' . IIdGenerator4Order::$errMsg;
								$sql = "rollback";
								$msSQL->execSql($sql);
								$orderDb->execSql($sql);
                                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['IIDGENERATOR4ORDER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                                self::Log("获取订单虚库记录sql失败！errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
								return false;
							}
                            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['idGenerator']['succ']);
                            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['IIDGENERATOR4ORDER'], 0, 0, LocalServerIP, LocalServerIP);

							$sql = "insert into t_order_virtual_stock_{$db_tab_index['table']} values($auto_id, '$oid', {$sp['product_id']}, {$sp['buy_count']}, 0, $now, $wh_id)";
							self::Log("t_order_virtual_stock_==".$sql);
                            $ret = $orderDb->execSql($sql);
							if(false === $ret) {
                                ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['orderDB']['failed']);
								self::$errCode = -2049;
								self::$errMsg = '建虚库记录失败' . $orderDb->errMsg;
								$sql = "rollback";
								$msSQL->execSql($sql);
								$orderDb->execSql($sql);
                                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ICSON_ORDER_CORE'], self::$errCode, 1, LocalServerIP, LocalServerIP);
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
						else
                        { //深圳，北京暂不支持建虚库
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
							'cash_back'         => (($sp['main_product_id'] > 0 && $sp['type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL) ? $sp['matchNum'] * $sp['cashCutPerItem'] : 0) + $cb,                          //sheldonshi 写入数据做了调整
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
                            //'sale_model'        => $product_base_info[$sp['product_id']]['sale_model'],
                        );

						$newOrder['order_items'][] = $newOrderItems; //需要将order_item 传出该函数
						$ret = $orderDb->insert("t_order_items_{$db_tab_index['table']}", $newOrderItems);
						if(false === $ret) {
                            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['orderDB']['failed']);
							self::$errCode = -2039;
							self::$errMsg = '执行sql语句失败' . $orderDb->errMsg;
							$sql = "rollback";
							$orderDb->execSql($sql);
							$msSQL->execSql($sql);
                            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ICSON_ORDER_CORE'], self::$errCode, 1, LocalServerIP, LocalServerIP);
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
                        //统一订单
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

		if(!empty($promotion)) {
			self::Log("使用了促销规则");
			//如果是送积分，优惠券，还需要执行向用户帐号里发放积分，优惠券
			if(IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_POINT'] == $promotion['benefit_type']) {
				// 送积分
			}
			else if(IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_COUPON'] == $promotion['benefit_type']) {
				// 送优惠卷
				$couponFetch = array();
				$batches = explode(",", $promotion['benefits']);
				foreach ($batches as $batch) {
					$couponFetch[$batch] = $promotion['benefit_times'];
				}
				if(NULL == $mysqlDb) {
					$mysqlDb = ToolUtil::getDBObj('coupon', 0);
					if(false === $mysqlDb) {
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
					if(false === $ret) {
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
                ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['coupon']['req']);
                $mlog->start();
				$ret = ICoupon::fetchCoupons($uid, $couponFetch, $mysqlDb, (isset($userInfo['level']) ? $userInfo['level'] : -1));
				if(false === $ret) {
                    ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['coupon']['failed']);
					self::$errCode = ICoupon::$errCode;
					self::$errMsg = ICoupon::$errMsg;
					$sql = "rollback";
					$mysqlDb->execSql($sql);
					//$orderDb->execSql($sql);
					$msSQL->execSql($sql);
                    $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['FETCHCOUPONS'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                    //库存双写 S Sheldonshi
                    IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                    //库存双写 E Sheldonshi
					if(ICoupon::$errCode == -106) {
						return array('errCode'=> -987, 'errMsg'=> '抱歉，您参加的活动已结束或终止，请您返回购物车重新操作');
					}
					else {
                        self::Log("送优惠券 fetchCoupons error！errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
						return false;
					}
				}
                ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['coupon']['succ']);
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['FETCHCOUPONS'], 0, 0, LocalServerIP, LocalServerIP);

				$couponids = '';
				foreach ($ret as $promotionCode) {
					$couponids .= (implode(",", $promotionCode) . ",");
				}
				if('' != $couponids) {
					$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
					$ret = $orderDb->update("t_orders_{$db_tab_index['table']}", array('rule_benefit'=> $couponids), "order_char_id='$parentOrderId' and uid={$uid}");
                    if(false === $ret) {
						self::$errCode = $mysqlDb->errCode;
						self::$errMsg = $mysqlDb->errMsg;
                        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['orderDB']['failed']);
                        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ICSON_ORDER_CORE'], self::$errCode, 1, LocalServerIP, LocalServerIP);
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
		}

		//更新购物券
		if(isset($newOrder['couponCode']) && $newOrder['couponCode'] != '') {
			self::Log("更新优惠券");
			global $_CouponStatus;
			$st = $_CouponStatus['partly_used'];

			if($couponInfo['used_degree'] + 1 >= $couponInfo['max_use_degree']) {
				$st = $_CouponStatus['used'];
			}
			if(NULL == $mysqlDb) {
				$mysqlDb = ToolUtil::getDBObj('coupon', 0);
				if(false === $mysqlDb) {
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
				if(false === $ret) {
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
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['coupon']['req']);
            $mlog->start();
            $ret = ICoupon::useCoupon($uid, $couponInfo, $orderstrforlog, $mysqlDb, (isset($userInfo['level']) ? $userInfo['level'] : -1), $wh_id);
			if(false === $ret) {
                ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['coupon']['failed']);
				self::$errCode = ICoupon::$errCode;
				self::$errMsg = ICoupon::$errMsg;
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['USECOUPON'], self::$errCode, 1, LocalServerIP, LocalServerIP);
				$sql = "rollback";
				$mysqlDb->execSql($sql);
				$orderDb->execSql($sql);
				$msSQL->execSql($sql);
                //库存双写 S Sheldonshi
                IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                //库存双写 E Sheldonshi
                self::Log("更新优惠券 useCoupon!errCode" . self::$errCode . ";errMsg:" .self::$errMsg);

                return array(
                    'errCode' => -16,
                    'errMsg' => "抱歉，您使用的优惠券暂时无法使用，请确认！",
                );
                //return false;
			}
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['USECOUPON'], 0, 0, LocalServerIP, LocalServerIP);
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['coupon']['succ']);
		}

		//如果是节能补贴订单，则将节能补贴申请信息插入对应的表
		if($isEnergySubsidyOrder) {
			self::Log("节能补贴订单");
			//插入节能补贴数据
            $mlog->start();
			$coreDb = ToolUtil::getMSDBObj('ICSON_CORE');
			$sql = "begin transaction";
			$ret = $coreDb->execSql($sql);
			if(false === $ret) {
				self::$errCode = -2035;
				self::$errMsg = '开启ms sql事务失败' . $coreDb->errMsg;
				$sql = "rollback";
				if(isset($mysqlDb) && !empty($mysqlDb)) {
					$mysqlDb->execSql($sql);
				}
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ICSON_CORE'], self::$errCode, 1, LocalServerIP, LocalServerIP);
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
			if(false === $ret) {
				self::$errCode = $coreDb->errCode;
				self::$errMsg = $coreDb->errMsg;
				$sql = "rollback";
				if(isset($mysqlDb) && !empty($mysqlDb)) {
					$mysqlDb->execSql($sql);
				}
				$orderDb->execSql($sql);
				$msSQL->execSql($sql);
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ICSON_CORE'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                //库存双写 S Sheldonshi
                IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                //库存双写 E Sheldonshi
				return false;
			}
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ICSON_CORE'], 0, 0, LocalServerIP, LocalServerIP);
		}

		//更新积分
		if($newOrder['point'] > 0)
		{
			//插入扣减积分的流水
			self::Log("更新积分");
			global $_SCORE_TYPE;
            $mlog->start();
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['score']['req']);
			$ret = IScore::addScore($uid, $_SCORE_TYPE['CREATE_ORDER']['id'], -1 * $newOrder['point'] / 10, "您下单10" . ($newOrderId - 1) . "消费积分", '', -1 * $cash_point_used / 10, -1 * $promotion_point_used / 10);
			if(false === $ret) {
                ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['score']['failed']);
				self::$errCode = IScore::$errCode;
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ADDSCORE'], self::$errCode, 1, LocalServerIP, LocalServerIP);
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "add score flow:insert score flow faild(uid={$newOrder['uid']},order_id=$newOrderId,point={$newOrder['point']})" . IScore::$errMsg;
				$sql = "rollback";

				if(isset($mysqlDb) && !empty($mysqlDb)) {
					$mysqlDb->execSql($sql);
				}
				$orderDb->execSql($sql);
				$msSQL->execSql($sql);
                //库存双写 S Sheldonshi
                IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                //库存双写 E Sheldonshi
                self::Log("更新积分 useCoupon!errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
				return array('errCode'=> -987, 'errMsg'=> '抱歉，您的订单因使用积分异常导致提交订单失败，您可以稍后重新下单或在提交订单时暂不使用积分');
			}
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['score']['succ']);
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ADDSCORE'], 0, 0, LocalServerIP, LocalServerIP);
		}

		//扣减多价促销次数
		self::Log("扣减促销多价次数");
		$ret = IPromotionRuleV2::dealPromotionRestrict($restricts, $newOrder['uid']);
		if(false === $ret) {
			$restrictsJson = ToolUtil::gbJsonEncode($restricts);
			self::$errCode = IPromotionRuleV2::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "dealPromotionRestrict faild(uid={$newOrder['uid']},)" . IPromotionRuleV2::$errMsg.",{$restrictsJson}";
			$sql = "rollback";
			if(isset($mysqlDb) && !empty($mysqlDb)) {
				$mysqlDb->execSql($sql);
			}
			$orderDb->execSql($sql);
			$msSQL->execSql($sql);
            //库存双写 S Sheldonshi
            IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
            //库存双写 E Sheldonshi
            self::Log("扣减促销多价次数 useCoupon!errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
            //这里有点问题，如果下单失败了，需要回滚积分
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

			return array('errCode'=> -989, 'errMsg'=> '抱歉，您的订单因系统异常导致提交订单失败，您可以稍后重新下单');
		}
		else
		{
			$restricts = $ret["restrict"];
		}

		self::Log("commit事务");
		$sql = "commit";

		if(!empty($mysqlDb)) {
			$mysqlDb_commit_ret = $mysqlDb->execSql($sql);
		}

		if(!empty($coreDb)) {
			$coreDb_commit_ret = $coreDb->execSql($sql);
		}

		$msSQL_commit_ret = $msSQL->execSql($sql);
		$orderDb_commit_ret = $orderDb->execSql($sql);

		//如果订单的事务提交失败，且使用了积分,则需要记录该条信息
		if(!$orderDb_commit_ret)
		{
			//回滚多价促销内容
			$ret = IPromotionRuleV2::rollbackPromotionRestrict($restricts, $newOrder['uid']);
			if(false === $ret) {
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
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['orderDB']['succ']);
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['inventoryDB']['succ']);

        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ICSON_ORDER_CORE'], 0, 0, LocalServerIP, LocalServerIP);
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['INVENTORY_MANAGER'], 0, 0, LocalServerIP, LocalServerIP);
		// 上报促销规则使用记录

		if(isset($newOrder['rule_id']) && $newOrder['rule_id'] > 0) {
			$orders = explode(",", $orderstrforlog);
			foreach ($orders as $o) {
				if(!empty($o)) {
					DataReport::report(3001, DATA_TYPE_1DAY, array($wh_id, $o, $newOrder['rule_id'], $userInfo['level'], $uid));
				}
			}
		}

		//写下用户购买单品赠券信息
		if(isset($newOrder['send_coupon_record_info']) && $newOrder['send_coupon_record_info'] != '') {
			$ret = EA_Promotion::setUserJoinedRecord($uid, $now, $newOrder['send_coupon_record_info'], $orders_items_array);
		}

		self::writePriceDetail($uid, $priceDetails);
		self::reportORS($ORS_Report_Data);
		self::reportToSZ($orderToSZ, $items); //TAPD 5478549 数据上报
		self::reportBaiduSem($_COOKIE, $subOrders, $wh_id); // 上报百度sem数据
		self::reportGSadid($_COOKIE, $subOrders, $wh_id); // 上报 国双 数据
		//删除购物车
		if(!(isset($newOrder['buy_one_key']) && true === $newOrder['buy_one_key'])) {
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
		if($newOrder['point'] > 1000) {
			$mobile = $userInfo['mobile'];
			$time = date("Y-m-d H:i:s");
			$ret = IMessage::sendSMSMessage($mobile, "您的易迅网账户于" . $time . "下单并使用积分" . $newOrder['point'] / 10 . "个。订单号" . $parentOrderId . "。如有疑问请致电400-828-1878");
			if(false === $ret) {
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
        //ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['order']['succ']);
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
		if(false === $priceDetailDB) 
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
				if(false === $ret) 
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
		//self::Log(ToolUtil::gbJsonEncode($items));
		$now = time();
		// 是否预约
		$isAppointed = true;

		// 商品中是否包含预约商品
		$hasAppointedProduct = false;

		//$lastItem = false;
		foreach ($items as $item) {

			if(!isset($item['event_id']) || $item['event_id'] <= 0) {
				continue;
			}

			if($now < $item['buy_time_from'] or $now > $item['buy_time_to']) {
				// 不在预约购买时间段内，不做预约检查，可以直接购买
				continue;
			}

			$hasAppointedProduct = true;

			$event_id = $item['event_id'];
			$ret = IActAppoint::hasAppointed($event_id, $uid);
			if($ret === false) {
				// 该用户没有参加预约
				$isAppointed = false;
				self::$errMsg = 6002;
				self::$errCode = "您购物车中的\"{$item['name']}\"为预购商品，需要预购资格才能购买哦";
				break;
			}

		}

		//self::Log(var_export($isAppointed, true));

		// 订单中有预购商品
		if($hasAppointedProduct) {
			// 检查用户是否有资格
			return $isAppointed;
		}

		// 订单中没有预购商品，直接放过
		return true;
	}

	private static function setShoppingCartInfo($newOrder)
	{
		$newOrderItems = array();

		$shopping_cart_type = IShoppingCartV2::ONLINE_CART;

		if((isset($newOrder['buy_one_key']) && true === $newOrder['buy_one_key']) //如果是无线一键购买，则从suborders中取商品
			|| (isset($newOrder['ism']) && $newOrder['ism'] == 2) //如果是节能补贴商品，也从suborders中取商品
		) //如果是分销导购，也从suborders中取商品
		{
			while (FALSE !== ($node = current($newOrder['suborders']))) {
				if(!isset($node['items'])) {
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
			$shopping_cart_type = IShoppingCartV2::OFFLINE_CART;
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
		if(isset($_COOKIE['mediav_data']) && $_COOKIE['mediav_data'] != '') {
			$cookie_data = $_COOKIE['mediav_data'];
			self::Log("上报百度sem数据 {$cookie_data} ");
			self::_dataReport($reportID, $cookie_data, $subOrders, $wh_id);
		}
	}

	private static function reportGSadid($_COOKIE, $subOrders, $wh_id)
	{
		// 5468935 国双代理数据上报
		$reportID = 3202;
		if(isset($_COOKIE['gsadid_data']) && $_COOKIE['gsadid_data'] != '') {
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
		if(time() - $_time < 7 * 24 * 60 * 60) {
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

		if(empty($env) || $env == "beta") { // 线上环境
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
                'packageid' => $pdt['package_id'],  //套餐id
			);
		}

		$udpAry = array();
		foreach($data as $phaseCnt) {
			if(is_string($phaseCnt)) { //第一片段
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
                'customer_ip'       => ToolUtil::getClientIP(true),
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
                //随心送
                'shipping_flag'     => $order['shipping_flag'],
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
}
