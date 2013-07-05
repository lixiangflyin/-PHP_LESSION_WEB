<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sheldonshi hedyhe
 * Date: 13-5-1
 * Time: ����4:02
 * To change this template use File | Settings | File Templates.
 * Ps: �ļ��нӿڽ�����Ѹ��վ�๺�����̵��ã�������������ǰ��֪������ӿڵ����޸Ĳ�����֪
 */
require_once(PHPLIB_ROOT . 'lib/DataReport.php');
require_once(PHPLIB_ROOT . 'inc/special.constant.inc.php');
require_once(PHPLIB_ROOT . 'api/IUniOrder.php');

class IOrderProcess{  //IOrderProcess
	public static $errCode = 0;
	public static $errMsg = '';
	public static $logMsg = '';

    public static $timeSpan = array('1' => '����', '2' => '����', '3' => '����', '4' => "");
    public static $weekDays = array('1' => '����һ', '2' => '���ڶ�', '3' => '������', '4' => '������', '5' => '������', '6' => '������', '7' => '������');
    public static $stopTime = array(
        MORNING => "00:30",
        NOON => "11:00",
        NIGHT => "15:00",
    );
    // cookie �е� visitkey
    public static $visitkey;
    public static $needSellerId = array();
    //��Ѹ����ص�������ݵĶ�������processID=99��ʱ�򣬲��ܱ����� @TAPD 5438774
    public static $evaluateViaShipType = array(ICSON_DELIVERY, ICSON_DELIVERY_QF, 30612,30761,30762,30752,30753,30804,30790,30812,30821,31478,31485,31484,50077,50078,50079,50080,50081,50082,50083,50084,50085,50086,);
    // ʱ��״̬���
    CONST NORMAL = 0; // ������ʱ���
    CONST EXPIRE = 1; // ������ڵ�ʱ���
    CONST LIMITED = 2; // �޵���ʱ���

	//Բͨ���
	public static $ytoRequestTpl = '<BatchQueryRequest><logisticProviderID>YTO</logisticProviderID><clientID>ICSON</clientID><orders><order><mailNo>{sysno_holder}</mailNo></order></orders></BatchQueryRequest>';
	public static $ytoPartnerId = 'icson';
	public static $ytoRequestHost = 'jingang.yto56.com.cn';
	public static $ytoRequestUrl = 'http://116.228.70.199/ordws/VipOrderServlet';
    //���ڸ���

	// ������Ʊ
	const HAS_INVOICE = 1;
	const NO_INVOICE = 0;
	//������Ʒ��ʾ��֤�룿
	const DISPLAY_VERIFY_CODE = false;
	const FREE_SHIPPING_PRICE = 2900; //���˷ѵĹ�����ͼۣ���λΪ��

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

    public static function orderProcess($newOrder, $userInfo, $wh_id = 1)
    {
        global $shoppingProcessItil;
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['order']['req']);

        self::$visitkey = isset($_COOKIE['visitkey']) ? $_COOKIE['visitkey'] : "";
        $newOrder['visitkey'] = self::$visitkey;
        // ��¼post��������Ϣ
        self::Log("Post newOrder:" . ToolUtil::gbJsonEncode($newOrder));

        // ������б�����ֶ�
        if (true !== self::checkByField($newOrder)) {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['order']['failed']);
            return false;
        }
        self::Log("checkByField finish");
        //�����ջ���ַ
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

        //���֧����ʽ
        if (false === self::checkPayType($newOrder, $wh_id, $userInfo)) {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['order']['failed']);
            return false;
        }
        self::Log("checkPayType finish");

        //��鷢Ʊ
        if (false === self::checkInvoice($newOrder, $wh_id)) {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['order']['failed']);
            return array('errCode'=> -21, 'errMsg'=> '���ύ��Ʊ���Ͳ��Ϸ�');
        }
        self::Log("checkInvoice finish");

        global $_USER_TYPE;
        if(false === self::checkUserInfo($newOrder, $userInfo))
        {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['order']['failed']);
            return array('errCode'=> 15, 'errMsg'=> "�����ڷ����û�������ʹ���Ż�ȯ��");
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
     * @static ������б�����ֶ�
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
            return array('errCode'=> 10, 'errMsg'=> "����д�Ķ�����ע�������뷵���޸ģ�");
        }

        if (!isset($newOrder['suborders']) || !is_array($newOrder['suborders'])) {
            return array('errCode'=> 10, 'errMsg'=> "���Ĺ��ﳵ��û����Ʒ����ѡ����");
        }

        //���ж��Ż�ȯ�����������ͬʱʹ��
        if (isset($newOrder['rule_id']) && isset($newOrder['couponCode']) && $newOrder['rule_id'] > 0 && $newOrder['couponCode'] != '') {
            return array('errCode'=> 15, 'errMsg'=> "�����������Ż�ȯ����ͬʱʹ��");
        }
        if (isset($newOrder['rule_id']) && ($newOrder['rule_id'] <= 0)) {
            return array('errCode'=> 16, 'errMsg'=> "���ύ�Ĵ���������Ϣ����ȷ���뷵�ع��ﳵ����ѡ��");
        }

        return true;
    }

    public static function checkReceiverAddr(&$newOrder)
    {
        //��ʼ����ջ��ַ

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
            //���ýӿڳ�ʱ�ȣ�У��Ź�
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
        if (0 == $newOrder['isVat']) //�������Ҫ����Ʊ��������֤��Ʊ
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

        //��ҵ���۷�Ʊ
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

        //���ڷǷ�������,��ҪУ�鴫��ķ�Ʊid�Ƿ����ڸ��û�
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


        // ����û��ύ�ķ�Ʊ�Ƿ��Ǹ�վ������ύ�ķ�Ʊ
        $whInvoice = EA_Invoice::getInvoicesWhType($wh_id);
        if( !in_array($newOrder['invoiceType'], $whInvoice) )
        {
            self::$errCode = -21;
            self::$errMsg = "�û��ύ�ķ�Ʊ�������ڸ�վ��ʹ��";
            return false;
        }
        return true;
    }

    public static function checkUserInfo($newOrder, $userInfo)
    {
        //���ʹ���Ż�ȯ���ж��û��Ƿ�Ϊ�����̣����ǣ�������ʹ���Ż�ȯ
        global $_USER_TYPE;
        if ($userInfo['type'] == $_USER_TYPE['Dealer'] && isset($newOrder['couponCode']) && $newOrder['couponCode'] != '') {
            self::$errCode = 15;
            self::$errMsg = "�û��ύ�ķ�Ʊ�������ڸ�վ��ʹ��";
            return false;
        }
        return true;
    }

    /*
     * �µ�Ƶ������
     * @param $productInfos ��Ʒ��Ϣ
     * @param $order ������Ϣ
     * @return false ����Ƶ�ʳ�������
    */
    public static function checkVisitFrequency($productInfos, $order)
    {
        $bNeedCheck = false;
        foreach ($productInfos as $p_info) {
            if (($p_info['flag'] & OTHER_TIME_LIMITED_RUSHING_BUY) == OTHER_TIME_LIMITED_RUSHING_BUY) { //����������Ʒ�������µ�Ƶ��
                $bNeedCheck = true;
                break;
            }
        }

        if ($bNeedCheck) {
            $ret = IFreqLimit::checkAndAdd($order['uid'], 5);
            if ($ret > 0) { //�µ�Ƶ�ʹ���
                self::$errCode = -6001;
                self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[freqlimit] visit frequency too high';
                return false;
            }
        }
        return true;
    }

    //---------------�µ��߼�����ȡ���ĺ���--------------
    /**
     * ��vector��ʽ����Ʒ�б�ת��Ϊmap��ʽ
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
                //������
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

        //���ﳵ����Ʒת����ת������ƷID��KEY����ʽ
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
        self::Log("���ǰ̨�������Ʒ�б��빺�ﳵ����Ʒ�б��Ƿ�һ��");
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
                        //����������һ��,�°涩������ҳ��������������֧����Ϊ��Ʒ�����Ѿ��������¸�ֵ
                        if($orderItem['num'] != $itemInCart['buy_count'])
                        {
                            self::$errCode = -1;
                            self::$errMsg = "���ﳵ����Ʒ" . $product_base_info[$itemInCart['product_id']]['name'] . "{$orderItem['num']}������������ȷ���뷵�ع��ﳵ�޸�����{$itemInCart['buy_count']}";
                            return false;
                        } //��Ʒ������Ϣ�����ڣ������
                        else if(!isset($product_base_info[$orderItem['product_id']]))
                        {
                            self::$errCode = -2;
                            self::$errMsg = "���ﳵ����Ʒ" . $product_base_info[$itemInCart['product_id']]['name'] . "�ݲ����ۣ��뷵�ع��ﳵɾ��";
                            return false;
                        } //��Ʒ״̬���Ϸ��������
                        else if(isset($product_base_info[$orderItem['product_id']]['status'])
                            && $product_base_info[$orderItem['product_id']]['status'] != PRODUCT_STATUS_NORMAL)
                        {
                            self::$errCode = -3;
                            self::$errMsg = "���ﳵ����Ʒ" . $product_base_info[$itemInCart['product_id']]['name'] . "�ݲ����ۣ��뷵�ع��ﳵɾ��";
                            return false;
                        }
                        //����ֵ��߼����жϣ�������߼�������Ǹ�����
                        //else if($product_base_info[$orderItem['product_id']]['psystock'] != $subOrderKey) {
                        /*
                        else if($product_base_info[$orderItem['product_id']]['psystock'] != $packages[$subOrderKey]['psystock'])
                        {
                            self::Log("product_base_info=".ToolUtil::gbJsonEncode($product_base_info)."---".$packages[$subOrderKey]['psystock']);
                            self::$errCode = -3;
                            self::$errMsg = "���ﳵ����Ʒ" . $product_base_info[$itemInCart['product_id']]['name'] . "��Ϣ�Ѿ��ı䣬��ˢ��ҳ��";
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
                            //���������������
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
                    self::$errMsg = "���ﳵ����Ʒ" .
                        (isset($product_base_info[$orderItem['product_id']]) ? $product_base_info[$orderItem['product_id']]['name'] : $orderItem['product_id'])
                        . "�����ڣ��뷵�ع��ﳵɾ������Ʒ";
                    return false;
                }

                //�鿴����Ʒ���͵���Ʒ&����Ƿ�ƥ��
                foreach ($orderItem['gift'] as $g_p_id)
                {
                    if(!isset($product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]))
                    {
                        self::$errCode = -5;
                        self::$errMsg = "���ﳵ����Ʒ/���" . $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['name'] . "��ʱ�޻����뷵�ع��ﳵɾ��";
                        return false;
                    }//��Ʒ״̬���Ϸ�
                    else if( isset($product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['status'])
                        && $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['status'] == PRODUCT_STATUS_NORMAL)
                    {
                        self::$errCode = -6;
                        self::$errMsg = "���ﳵ����Ʒ/���" . $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['name'] . "��ʱ�޻����뷵�ع��ﳵɾ��";
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
        self::Log("��ȡ���û��ַ�Χ");
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
                    self::$errMsg = "���ﳵ����Ʒ" . $product_base_info[$item['product_id']]['name'] . "�ݲ����ۣ��뷵�ع��ﳵɾ��";
                    return false;
                }
                $p = $product_base_info[$item['product_id']];
                if($p['num_limit'] > 0 && $p['num_limit'] < 999)
                {
                    if($p['num_limit'] < $item['buy_count'])
                    {
                        self::$errCode = -15;
                        self::$errMsg = "���ﳵ����Ʒ" . $product_base_info[$item['product_id']]['name'] . "�����޹�������ֻ�ܹ���" . $p['num_limit']  . "��";
                        return false;
                    }
                    $limitedProduct[$p['product_id']] = $subOrderKey;
                }
                //���û���ʹ�ö�ۺ�ĵ��ۣ������Ƿ�Ҫ�����ײ��Ż�cash_back��
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
                    self::$errMsg = "���ﳵ����Ʒ" . $product_base_info[$order['product_id']]['name'] . "���޹���Ʒ�������չ��������Ѿ������޹�����";
                    return false;
                }
                else if($order['buy_num'] + $shoppingProduct[$limitedProduct[$order['product_id']]][$order['product_id']]['buy_count'] > $product_base_info[$order['product_id']]['num_limit'])
                {
                    self::$errCode = -12;
                    self::$errMsg = "���ﳵ����Ʒ" . $product_base_info[$order['product_id']]['name'] .
                        "���޹���Ʒ�������ջ��ܹ���" . ($product_base_info[$order['product_id']]['num_limit'] - $order['buy_num']) . "��";
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
                self::Log("�ֵ��ӿ�setOrderDivide Error! errCode:" . self::$errCode);
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
                    //sheldonshi ������������   �����Ϣ��У�����Էֵ��������
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
                                self::$errMsg = '���'.$product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name']."��治��,����ϵ�ͷ�";
                                return false;
                            }
                            self::$errCode = -14;
                            self::$errMsg = '��Ʒ'.$product_base_info[$sp['product_id']]['name']."��治��";
                            return false;
                        }
                        if($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_GIFT) //��Ʒ
                        {
                            if($pstock['AvailableQty'] + $pstock['VirtualQty'] < $sp['buy_count'])
                            {
                                IInventoryStockTTC::update(array('product_id'=> $sp['product_id'], 'num_available'=> $pstock['AvailableQty'], 'virtual_num'=> $pstock['VirtualQty']), array('sys_no'=> $pstock['SysNo']));
                                if(!isset($newOrder['ingoreLackOfGift']))
                                { //�����һ���ύ����
                                    $giftLackOfStock[$sp['product_id']] = $product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name'];
                                }
                                else if($newOrder['ingoreLackOfGift'] == 1)
                                { //�û�����ȱ����Ʒ
                                    $shoppingProduct[$subOrderKey][$kk]['buy_count'] = $pstock['AvailableQty'] + $pstock['VirtualQty'];
                                    if($shoppingProduct[$subOrderKey][$kk]['buy_count'] <= 0)
                                    {
                                        unset($shoppingProduct[$subOrderKey][$kk]);
                                    }
                                    $lackGiftAndIgnore = true;
                                }
                                else //�û������ܣ���ܾ��µ�
                                {
                                    self::$errCode = -13;
                                    self::$errMsg = '��Ʒ' . $product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name'] . "��治��";
                                    return false;
                                }
                            }
                        }
                        else if($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_ZUJIAN)
                        {
                            if($pstock['AvailableQty'] + $pstock['VirtualQty'] < $sp['buy_count'])
                            {
                                self::$errCode = -15;
                                self::$errMsg = '���' . $product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name'] . "��治��,����ϵ�ͷ�";
                                return false;
                            }
                        }
                        else //����Ʒ
                        {
                            if(($pstock['AvailableQty'] + $pstock['VirtualQty'] < $sp['buy_count'])
                                &&(($wh_id != 1) || ($product_base_info[$sp['product_id']]['flag'] & FORBID_SET_VIRTUAL) == FORBID_SET_VIRTUAL
                                    ||$product_base_info[$sp['product_id']]['type'] != PRODUCT_TYPE_NORMAL)
                            )
                            {
                                self::$errCode = -15;
                                self::$errMsg = '��Ʒ' . $product_base_info[$sp['product_id']]['name'] . "��治��";
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
                    self::$errMsg = '��Ʒ' . $product_base_info[$sp['product_id']]['name'] . "�ݲ�����";
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
        //������ʹ�����
        if($newOrder['point'] < $pointMin || $newOrder['point'] > $pointMax)
        {
            self::$errCode = -10;
            self::$errMsg = "�����ζ���������ʹ��" . ($pointMin / 10) . "������,�����ʹ��" . ($pointMax / 10) . "������";
            return false;
        }

        //��ȡ�û����֣�ȷ���û�ʹ�õĻ��ֲ�������ӵ�еĻ���,������ֱ���Ҫ���ֽ���ֺʹ������֣�����ʹ���ֽ����
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
                self::$errMsg = "���˻������ܶ�Ϊ{$userInfo['point']}�����ֻ��ʹ��{$userInfo['point']}������";
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
        //���ǰ��ѡ�����ors�ֵ������µ���ȡors��ʱ�������У���µ������û�г������������У������
        if(false === $shipRet || !isset($shipRet[$divideOrderType]))
        {
            //��У�鷵�أ��������������ֻ��ors����Ĭ�ϳ���ǰ��ͷ�����
            $orderShipPrice = $newOrder['shippingPrice'];
            foreach($subOrders as $subKey => $subOrder)
            {

                $subOrders[$subKey]['seller_id'] = $newOrder['suborders'][$subKey]['seller_id'];
                $subOrders[$subKey]['sale_mode'] = $newOrder['suborders'][$subKey]['sale_mode'];
                $subOrders[$subKey]['seller_address_id'] = $newOrder['suborders'][$subKey]['seller_stock_id'];
                //����С��
                $subOrders[$subKey]['order_size'] = $newOrder['suborders'][$subKey]['order_size'];
                $subOrders[$subKey]['order_volume'] = $newOrder['suborders'][$subKey]['order_volume'];
                $subOrders[$subKey]['order_longest'] = $newOrder['suborders'][$subKey]['order_longest'];
                $subOrders[$subKey]['order_weight'] = $newOrder['suborders'][$subKey]['totalWeight'];
                //�˷�
                $subOrders[$subKey]['orderShipPrice'] = $newOrder['suborders'][$subKey]['orderShipPrice'];
                if(isset($newOrder['suborders'][$subKey]['isCanXpress']) && $newOrder['suborders'][$subKey]['isCanXpress'] == 1)
                {
                    $subOrders[$subKey]['isCanXpress'] = 2;
                    //�����͵�ʱ����ҪΪ��һ��ĵ�һ��ʱ��span
                    $now = time() + 3600*24;
                    $expectDate = date('Y-m-d', $now);
                    $newOrder['suborders'][$subKey]['expectDate'] = $expectDate;
                    $newOrder['suborders'][$subKey]['expectSpan'] = 1; // ����ʱ��
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
            //Ĭ��
            $shipInfo = $shipRet['default']['shippingType'];
            $packageInfo = $shipRet['default']['packages'];
        }
        else
        {
            //ѡ��ors��ʽ
            $shipInfo = $shipRet[$divideOrderType]['shippingType'];
            $packageInfo = $shipRet[$divideOrderType]['packages'];
        }

        //ͬʱ����ܷ�ģ����Ʊ������ֵ��Ʊ
        if(isset($shipRet['availableInvoices']['isCanVAT'])
            && $shipRet['availableInvoices']['isCanVAT'] == false
            && $newOrder['invoiceType'] == INVOICE_TYPE_VAT
        )
        {
            self::$errCode = -20;
            self::$errMsg = '���Ķ���������Ʒ���ܿ���ֵ˰��Ʊ';

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
                    //������  �½���  1-��������  2-������
                    if(isset($newOrder['suborders'][$subOrderKey]['isCanXpress']) && $newOrder['suborders'][$subOrderKey]['isCanXpress'] == 1)
                    {
                        //���������������ѡ������������У��
                        if(!isset($ship['subOrder'][$subOrderKey]['isCanXpress'])
                            || $ship['subOrder'][$subOrderKey]['isCanXpress'] != $newOrder['suborders'][$subOrderKey]['isCanXpress']
                        )
                        {
                            self::$errMsg = "��Ǹ�������ͷ�ʽ�ݲ�֧�������ͣ�������ѡ��";
                            self::$errCode = -21;
                            self::Log("��������֤����");

                            return false;
                        }
                        $subOrders[$subOrderKey]['isCanXpress'] = 2;
                        //�����͵�ʱ����ҪΪ��һ��ĵ�һ��ʱ��span
                        $now = time() + 3600*24;
                        $expectDate = date('Y-m-d', $now);
                        $newOrder['suborders'][$subOrderKey]['expectDate'] = $expectDate;
                        $newOrder['suborders'][$subOrderKey]['expectSpan'] = 1; // ����ʱ��
                        $orderShipPrice = 0;
                        $subOrders[$subOrderKey]['orderShipPrice'] = 0;
                    }
                    else
                    {
                        $timeAvailable = array();
                        if(ICSON_DELIVERY == $newOrder['shipType'])
                        {
                            $timeAvailable = $ship['subOrder'][$subOrderKey]['timeAvaiable'];
                            $icson_delivery_info['expect_ship_date'] = $newOrder['suborders'][$subOrderKey]['expectDate']; // ��������
                            $icson_delivery_info['expect_time_span'] = $newOrder['suborders'][$subOrderKey]['expectSpan']; // ����ʱ��
                            $ret = self::verifyExpectDateSpan($icson_delivery_info, $timeAvailable, $destination);
                            if(false === $ret)
                            {
                                self::$errMsg = "��Ǹ����ѡ�������ʱ���޷����ͣ�������ѡ��";
                                self::$errCode = -21;
                                self::Log("����ʱ����֤ʧ�ܣ�[{$icson_delivery_info['expect_ship_date']}][{$icson_delivery_info['expect_time_span']}]");
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
            self::$errMsg = "��Ǹ�����ﳵ������Ʒ��֧����ѡ������ͷ�ʽ��";
            self::$errCode = -17;
            return false;
        }
        foreach($packageInfo as $subKey=>$package)
        {
            $subOrders[$subKey]['seller_id'] = $package['seller_id'];
            $subOrders[$subKey]['sale_mode'] = $package['sale_mode'];
            $subOrders[$subKey]['seller_address_id'] = $package['seller_stock_id'];
            //����С��
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
        //����ȷ��ҳ
        $version = isset($newOrder['version']) && $newOrder['version'] == 1 ? $newOrder['version'] : 0;
        $divideOrderType = isset($newOrder['divide_order_type']) ? $newOrder['divide_order_type'] : "default";
        self::Log("Order New Para:[whid:{$wh_id}],newOrder:" . ToolUtil::gbJsonEncode($newOrder));
		self::$visitkey = $newOrder['visitkey'];

		$uid = $newOrder['uid'];
		$destination = $newOrder['receiveAddrId'];
        /*
         * �û���Ϣ�Ļ�ȡǰ�Ƶ�cgi����ǻ�ȡ���µ��������в�����λ�ȡ
        $userInfo = IUser::getUserInfo($uid);
		if($userInfo === false) {
			self::$errCode = IUser::$errCode;
			self::$errMsg = "��ȡ�û���Ϣ����";
			self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:��ȡ�û���Ϣ����" . IUser::$errMsg;
            self::Log("placeOrder IUser::getUserInfo Error!��ȡ�û���Ϣ����!errCode:" . IUser::$errCode);
			return false;
		}
        $userPoint = IShoppingProcess::getUserPoint($uid);
        if($userPoint === false && $newOrder['point'] > 0){
            self::$errCode = IShoppingProcess::$errCode;
            self::$errMsg = "��ȡ�û���Ϣ����";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:��ȡ�û���Ϣ����" . IShoppingProcess::$errMsg;
            self::Log("placeOrder IShoppingProcess::getUserPoint Error!��ȡ�û�������Ϣ����!errCode:" . IShoppingProcess::$errCode);
        }
        $userInfo['point'] = $userPoint['point'];
        $userInfo['cash_point'] = $userPoint['cash_point'];
        $userInfo['promotion_point'] = $userPoint['promotion_point'];
        $userInfo['valid_point'] = $userPoint['valid_point'];
        */
        //���ڴ��� sheldonshi
        $isInstallmentOrder = false;
        if(isset($newOrder['IsInstallment']) && $newOrder['IsInstallment'] == 1)
        {
            $isInstallmentOrder = true;
            $bank = $newOrder['bank'];
            $installment = $newOrder['installment'];
        }

		// ���ù��ﳵ����
		$shoppingCartInfo = self::setShoppingCartInfo($newOrder);
        //ʹ���µĽӿ�������������Ʒ�б���Ʒ��Ϣ��ȡ   Start
        $result = IShoppingProcess::getAllCartItemsInfo($uid, $wh_id, $destination, $shoppingCartInfo, true , true, SCENE_SHOPPING_ORDER, $newOrder, $version);
        if(false === $result)
        {
            self::$errCode = IShoppingProcess::$errCode;
            self::$errMsg = IShoppingProcess::$errMsg . ",uid({$uid}) getItemList failed";
            self::Log("getAllCartItemsInfo Failed!".IShoppingProcess::$errCode);
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETALLCARTITEMSINFO'], self::$errCode, 1, LocalServerIP, LocalServerIP);
            return array('errCode'=> -1, 'errMsg'=> "���Ĺ��ﳵ��û����Ʒ����ѡ����");
        }
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETALLCARTITEMSINFO'], 0, 0, LocalServerIP, LocalServerIP);
        $items = $result['items'];
        $suiteInfo = $result['suiteInfo'];
        $product_base_info = $result['products'];
        $inventorys = $result['inventory'];

        self::Log("���ﳵ��Ʒ��Ϣ��ȡ���! getAllCartItemsInfo Result: [items:"
                . ToolUtil::gbJsonEncode($items)
                . "]  [suitInfo:" . ToolUtil::gbJsonEncode($suiteInfo)
                . "]  [product_base_info:" . ToolUtil::gbJsonEncode($product_base_info)
                . "]  [inventory:" . ToolUtil::gbJsonEncode($inventorys)
                . "]"
        );
        //��������Ʒ��ּ���߼�
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
                return array('errCode'=> -1, 'errMsg'=> "��Ǹ�������ﳵ�к��д�������Ʒ���ݲ�֧�ְ�װ����������ѡ���������ճ�����ͬ����Ʒ���ܰ�װ���񣻻���ɾ����װ�������а�װ��");
            }
        }
        self::Log("װ���������߼����! diyProductStockCheck finish");
        //sheldonshi �ָ�������
        $mlog->start();
        $tyingRet = IShoppingProcess::getTyingInfo($items, $wh_id, $destination, $uid, SCENE_SHOPPING_ORDER);
        if($tyingRet === false)
        {
            //�����䲻����·�������ʧ���ˣ�����ֱ���µ�������ǰһ�����ûʧ�ܣ����ʧ����,�ں���۸���֤����Ϳ���
            self::$errMsg = '��ȡ������ʧ��. '.IShoppingProcess::$errCode;
            self::$errCode = 4001;
            self::$logMsg =  basename(__FILE__) . "line:" . __LINE__ . ",errMsg:��ȡ������ʧ��.".IShoppingProcess::$errCode;
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETTYINGINFO'], IShoppingProcess::$errCode, 1, LocalServerIP, LocalServerIP);
            self::Log("��ȡ������ʧ��! [uid:{$uid}] [whid:{$wh_id}] [destination:{$destination}] [items:" . ToolUtil::gbJsonEncode($items) . "]");
        }
        else
        {
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETTYINGINFO'], 0, 0, LocalServerIP, LocalServerIP);
            $items = $tyingRet['items'];
        }
        self::Log("��ȡ��������! getTyingInfo itmes:" . ToolUtil::gbJsonEncode($items));

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
                //������
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

        //���ﳵ����Ʒת����ת������ƷID��KEY����ʽ
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

            return array('errCode'=> 10, 'errMsg'=> "���Ĺ��ﳵ��û����Ʒ����ѡ����");
        }
        self::Log("���ﳵ��Ʒ��Ϣ�ϲ�! transItemsToMap Result: [items:"
                . ToolUtil::gbJsonEncode($items)
                . "]  [itemsInShoppingCart:" . ToolUtil::gbJsonEncode($itemsInShoppingCart)
                . "]"
        );
        //TODO:ʹ���µĽӿ�������������Ʒ�б���Ʒ��Ϣ��ȡ  End

        $ret = self::checkVisitFrequency($product_base_info, $newOrder);
        if(false === $ret)
        {
            //���Ƶ������ʧ��
            self::Log("place order checkVisitFrequency Failed!errCode:" . self::$errCode . "errMsg:" . self::$errMsg);
            return false;
        }
        self::Log("�µ�Ƶ�ʼ�飡checkVisitFrequency finish!");


		reset($newOrder['suborders']);
		$countPost = 0;                                              //��Ʒ����
		while(FALSE != ($node = current($newOrder['suborders'])))
		{
			if(!isset($node['items']))
            {
				return array('errCode'=> 10, 'errMsg'=> "���ύ�Ķ��������������飡");
			}
			$countPost += count($node['items']);
			next($newOrder['suborders']);
		}
		//���û���ײͣ��жϹ��ﳵ����Ʒ��ǰ̨չʾ����Ʒ������һ�µ�
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
        //�ж���Ʒ�Ƿ��ǽ��ܲ�����Ʒ:��Ʒflag�ǽ��ܲ�����Ʒ&&���ܲ�����Ϣ��ȫ&&���ﳵ����Ʒ����=1
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
		//���ö�ۡ�����ϵͳ������Ʒ����
        $mlog->start();
		$rule_id = !empty($newOrder['rule_id']) ? intval($newOrder['rule_id']) : 0;
		$promotionRule = IPromotionRuleV2::checkRuleForOrder($items, $wh_id, $uid, $rule_id, $isEnergySavingType, SCENE_SHOPPING_ORDER);
		if(false === $promotionRule)
        {
			if(106 == IPromotionRuleV2::$errCode)
			{
				self::$errCode = IPromotionRuleV2::$errCode;
				self::$errMsg = IPromotionRuleV2::$errMsg;
                self::Log("checkRuleForOrder ���μӵĻ�ѽ�������ֹ:errCode" . self::$errCode . ";errMsg:" . self::$errMsg);
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['CHECKRULEFORORDER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                return array('errCode'=> -991, 'errMsg'=> '��Ǹ�����μӵĻ�ѽ�������ֹ���������ع��ﳵ���²���');
			}
			else if(107 == IPromotionRuleV2::$errCode)
			{
				self::$errCode = IPromotionRuleV2::$errCode;
				self::$errMsg = IPromotionRuleV2::$errMsg;
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['CHECKRULEFORORDER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                self::Log("checkRuleForOrder ��Ѵﵽ�����������:errCode" . self::$errCode . ";errMsg:" . self::$errMsg);
				return array('errCode'=> -992, 'errMsg'=> "��Ǹ����������Ļ�Ѵﵽ����������ޣ������ٲμӸû");
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
		self::Log("��ۡ��������۽����IPromotionRuleV2 result:" . ToolUtil::gbJsonEncode($promotionRule));
		$promotion = $promotionRule['promotion'];
		$items = $promotionRule['items'];
		$restricts = $promotionRule['restrict'];
        //ԤԼ���
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['appoint']['req']);
		$ret = self::checkAppointInfo($uid, $items);
		self::Log("���ԤԼ�����" . var_export($ret, true));
		if($ret == false)
        {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['appoint']['failed']);
			return array('errCode'=> self::$errMsg, 'errMsg'=> self::$errCode);
		}
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['appoint']['succ']);
		// ��ֶ�����������Ҫ��items���иı�Ĳ��������ڲ�֮ǰ����
        //sheldonshi ���ò�����ֶ���
        /*
        $divideOrder = IShoppingProcess::setOrderDivide($items, $wh_id, $destination, $uid);
        if(false === $divideOrder)
        {
            self::$errCode = IShoppingProcess::$errCode;
            self::Log("�ֵ��ӿ�setOrderDivide Error! errCode:" . self::$errCode);
            return false;
        }

        self::Log("��ȡ�ֵ������setOrderDivide Result!". ToolUtil::gbJsonEncode($divideOrder));
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

		//���ǰ̨�������Ʒ�б� �� ���ﳵ����Ʒ�б��Ƿ�һ�� �°��������˵���
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
        self::Log("���ǰ̨�������Ʒ�б��빺�ﳵ����Ʒ�б��Ƿ�һ��!");

        //ѡ��������װ������ѡ���������
        global $_PAY_MODE;
        //if($_PAY_MODE[$wh_id][$newOrder['payType']]['PayTypeName'] == '��������')
        if($newOrder['payType'] == COD)
        {
            global $_NotPayWhenArrive;
            $bothExist = array_intersect($_NotPayWhenArrive, $productInShoppingCart);
            if(count($bothExist) != 0)
            {
                self::Log("ѡ��������װ������ѡ���������![payType:{$newOrder['payType']}]");
                return array('errCode'=> -22, 'errMsg'=> '��ѡ����������װ���񣬲���ѡ���������֧����ʽ');
            }
        }
        self::Log("��֤ѡ��������װ!");

        //���ĳЩ���ⲻ�����ڹ��ﳵ�У�����ѡ�������
        global $_SelfFetchProductids;
        global $_LGT_MODE;
        //���ѡ������������᷽ʽ����Ҫ��⹺�ﳵ�д����ض���Ʒ,�����������Ӧ���ж�Ӧ���ͣ���ò�Ҫ������ʾ
        if(false !== strpos($_LGT_MODE[$newOrder['shipType']]['ShipTypeName'], '�������'))
        {
            $bothExist = array_intersect($_SelfFetchProductids, $productInShoppingCart);
            if(count($bothExist) == 0)
            {
                return array('errCode'=> -29, 'errMsg'=> '�Բ��������������Ʒ����ѡ���������');
            }
        }
        self::Log("��֤ѡ������!");

        $invoinceContent = IPreOrderProcess::getInvoicesContentOpt($c3ids, $wh_id);
        if($newOrder['isVat'] == self::HAS_INVOICE)
        {
            if(!in_array($newOrder['invoiceContent'], $invoinceContent))
            {
                return array('errCode'=>-21, 'errMsg'=>'���ύ��Ʊ���ݲ��Ϸ�');
            }
        }
        self::Log("��֤���ύ��Ʊ���ݣ�");
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
						//����������һ��,�°涩������ҳ��������������֧����Ϊ��Ʒ�����Ѿ��������¸�ֵ
						if($orderItem['num'] != $itemInCart['buy_count'])
                        {
							return array(
                                'errCode'=> -1,
                                'errMsg'=> "���ﳵ����Ʒ" . $product_base_info[$itemInCart['product_id']]['name'] . "{$orderItem['num']}������������ȷ���뷵�ع��ﳵ�޸�����{$itemInCart['buy_count']}"
                            );
						} //��Ʒ������Ϣ�����ڣ������
						else if(!isset($product_base_info[$orderItem['product_id']]))
                        {
							return array(
                                'errCode'=> -2,
                                'errMsg'=> "���ﳵ����Ʒ" . $product_base_info[$itemInCart['product_id']]['name'] . "�ݲ����ۣ��뷵�ع��ﳵɾ��"
                            );
						} //��Ʒ״̬���Ϸ��������
						else if(isset($product_base_info[$orderItem['product_id']]['status'])
                            && $product_base_info[$orderItem['product_id']]['status'] != PRODUCT_STATUS_NORMAL)
                        {
							return array(
                                'errCode'=> -3,
                                'errMsg'=> "���ﳵ����Ʒ" . $product_base_info[$itemInCart['product_id']]['name'] . "�ݲ����ۣ��뷵�ع��ﳵɾ��"
                            );
						}
                        //����ֵ��߼����жϣ�������߼�������Ǹ�����
                        //else if($product_base_info[$orderItem['product_id']]['psystock'] != $subOrderKey) {
                        else if($product_base_info[$orderItem['product_id']]['psystock'] != $packages[$subOrderKey]['psystock']) {
                            self::Log("product_base_info=".ToolUtil::gbJsonEncode($product_base_info)."---".$packages[$subOrderKey]['psystock']);
							return array('errCode'=> -3, 'errMsg'=> "���ﳵ����Ʒ" . $product_base_info[$itemInCart['product_id']]['name'] . "��Ϣ�Ѿ��ı䣬��ˢ��ҳ��");
						}

						else
						{
							$shoppingProduct[$subOrderKey][$itemInCart['product_id']]['product_id'] = $itemInCart['product_id'];
							$shoppingProduct[$subOrderKey][$itemInCart['product_id']]['OTag'] = $itemInCart['OTag'];
							@$shoppingProduct[$subOrderKey][$itemInCart['product_id']]['buy_count'] += $itemInCart['buy_count'];
							$shoppingProduct[$subOrderKey][$itemInCart['product_id']]['main_product_id'] = $itemInCart['main_product_id'];
							$shoppingProduct[$subOrderKey][$itemInCart['product_id']]['type'] = SHOPPING_CART_PRODUCT_TYPE_NORMAL;
                            //���������������
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
                        'errCode'=> -4, 'errMsg'=> "���ﳵ����Ʒ" .
						(isset($product_base_info[$orderItem['product_id']]) ? $product_base_info[$orderItem['product_id']]['name'] : $orderItem['product_id'])
						. "�����ڣ��뷵�ع��ﳵɾ������Ʒ"
                    );
				}

				//�鿴����Ʒ���͵���Ʒ&����Ƿ�ƥ��
				foreach ($orderItem['gift'] as $g_p_id)
				{
					if(!isset($product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]))
                    {
						return array(
                            'errCode'=>-5,
                            'errMsg'=>"���ﳵ����Ʒ/���" . $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['name'] . "��ʱ�޻����뷵�ع��ﳵɾ��"
                        );
					}//��Ʒ״̬���Ϸ�
					else if( isset($product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['status'])
                        && $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['status'] == PRODUCT_STATUS_NORMAL)
                    {
						return array(
                            'errCode'=>-6,
                            'errMsg'=>"���ﳵ����Ʒ/���" . $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['name'] . "��ʱ�޻����뷵�ع��ﳵɾ��"
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
        //$shoppingProduct �����Ǹ���ǰ�˽����˲𵥺�������ˣ����ﺬ������Ʒ���������Ϣ����Ʒ���������һ����Ʒ����
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
				//�ۼӶ�ۺ���ܼ�
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
				// ���¼���ÿ����Ʒ�ĵ���
				$shoppingProduct[$subOrderKey][$pid]['price'] = intval($pInfo['total_price'] / $pInfo['buy_count']);
			}
		}

		//�Ż�ȯ���
		$couponInfo = array('amt'=>0, 'code'=>'', 'type'=>0);
        //���ܲ�����Ʒ��ʱ��� Start
        if(2 == $isEnergySavingType && isset($newOrder['couponCode']))
        {
            $newOrder['couponCode'] = "";
        }
        //���ܲ�����Ʒ��ʱ��� End
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
        self::Log("�Ż�ȯ���!");
        //������֤
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
		self::Log("��ȡ���û��ַ�Χ![pointMax:{$pointMax}][pointMin:{$pointMin}]");
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
                        'errMsg'=> "���ﳵ����Ʒ" . $product_base_info[$item['product_id']]['name'] . "�ݲ����ۣ��뷵�ع��ﳵɾ��"
                    );
				}
				$p = $product_base_info[$item['product_id']];
				if($p['num_limit'] > 0 && $p['num_limit'] < 999)
                {
					if($p['num_limit'] < $item['buy_count'])
                    {
						return array(
                            'errCode'=> -8,
                            'errMsg'=> "���ﳵ����Ʒ" . $product_base_info[$item['product_id']]['name'] . "�����޹�����" . $p['num_limit']
                        );
					}
					$limitedProduct[$p['product_id']] = $subOrderKey;
				}
                //���û���ʹ�ö�ۺ�ĵ��ۣ������Ƿ�Ҫ�����ײ��Ż�cash_back��
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

        //���û���
		//������ﳵ����Ʒ���޹���Ʒ�����ѯ���û�����Ķ���
		//���ﲿ��������Ҫ�޸ķֿ�ֱ������,��۵��޹��Ƿ�δ���ǣ�
        reset($items);
        foreach($items as $item)
        {
            if(1 == $item['price_buy_limit_flag'])
            {
                return array(
                    'errCode'=> -15,
                    'errMsg'=> "���ﳵ����Ʒ" . $item['name'] . "�����޹�������ֻ�ܹ���" . $item['mult_limit_num'] . "��",
                );
            }
        }
		self::Log("�����Ʒ����޹���");
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
                            'errMsg'=>"���ﳵ����Ʒ" . $product_base_info[$order['product_id']]['name'] . "���޹���Ʒ�������չ��������Ѿ������޹�����"
                        );
					}
					else if($order['buy_num'] + $shoppingProduct[$limitedProduct[$order['product_id']]][$order['product_id']]['buy_count'] > $product_base_info[$order['product_id']]['num_limit'])
                    {
						return array(
                            'errCode'=>-12,
                            'errMsg'=>"���ﳵ����Ʒ" . $product_base_info[$order['product_id']]['name'] .
							"���޹���Ʒ�������ջ��ܹ���" . ($product_base_info[$order['product_id']]['num_limit'] - $order['buy_num']) . "��" );
					}
				}
			}
			*/
		}
        self::Log("�����Ʒ��ͨ�޹���");
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['inventoryDB']['req']);
		$msSQL = ToolUtil::getMSDBObj('Inventory_Manager');
		if(empty($msSQL))
        {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['inventoryDB']['failed']);
			self::$errCode = Config::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "query ms sql faild " . Config::$errMsg;
            self::Log("����� DB ����ʧ��errCode:".self::$errCode.";errMsg:".self::$errMsg);
			return false;
		}
		$sql = "select SysNo, ProductSysNo, StockSysNo, AvailableQty, VirtualQty, OrderQty from Inventory_Stock where ProductSysNo in (" . implode(",", $productInShoppingCart) . ")";
		$productStocks = $msSQL->getRows($sql);
		if(false === $productStocks)
        {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['inventoryDB']['failed']);
			self::$errCode = $msSQL->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "query ms sql faild " . $msSQL->errMsg;
            self::Log("����� DB ��ѯʧ��errCode:".self::$errCode.";errMsg:".self::$errMsg);
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
                    //sheldonshi ������������   �����Ϣ��У�����Էֵ��������
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
                                    'errMsg'=>'���'.$product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name']."��治��,����ϵ�ͷ�"
                                );
							}
							return array('errCode'=>-14, 'errMsg'=>'��Ʒ'.$product_base_info[$sp['product_id']]['name']."��治��");
						}
						if($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_GIFT) //��Ʒ
						{
							if($pstock['AvailableQty'] + $pstock['VirtualQty'] < $sp['buy_count'])
                            {
								IInventoryStockTTC::update(array('product_id'=> $sp['product_id'], 'num_available'=> $pstock['AvailableQty'], 'virtual_num'=> $pstock['VirtualQty']), array('sys_no'=> $pstock['SysNo']));
								if(!isset($newOrder['ingoreLackOfGift']))
                                { //�����һ���ύ����
									$giftLackOfStock[$sp['product_id']] = $product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name'];
								}
                                else if($newOrder['ingoreLackOfGift'] == 1)
                                { //�û�����ȱ����Ʒ
									$shoppingProduct[$subOrderKey][$kk]['buy_count'] = $pstock['AvailableQty'] + $pstock['VirtualQty'];
									if($shoppingProduct[$subOrderKey][$kk]['buy_count'] <= 0)
                                    {
										unset($shoppingProduct[$subOrderKey][$kk]);
									}
									$lackGiftAndIgnore = true;
								}
                                else //�û������ܣ���ܾ��µ�
								{
									return array(
                                        'errCode'=> -13,
                                        'errMsg'=> '��Ʒ' . $product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name'] . "��治��"
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
                                    'errMsg'=> '���' . $product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name'] . "��治��,����ϵ�ͷ�"
                                );
							}
						}
                        else //����Ʒ
						{
							if(($pstock['AvailableQty'] + $pstock['VirtualQty'] < $sp['buy_count'])
                                &&(($wh_id != 1) || ($product_base_info[$sp['product_id']]['flag'] & FORBID_SET_VIRTUAL) == FORBID_SET_VIRTUAL
                                    ||$product_base_info[$sp['product_id']]['type'] != PRODUCT_TYPE_NORMAL)
							)
                            {
								return array(
                                    'errCode'=> -15,
                                    'errMsg'=> '��Ʒ' . $product_base_info[$sp['product_id']]['name'] . "��治��"
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
                        'errMsg'=> '��Ʒ' . $product_base_info[$sp['product_id']]['name'] . "�ݲ�����"
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
        self::Log("�����Ʒ��棡");
        if(count($giftLackOfStock) != 0) {
			$errMsg = "���ﳵ����Ʒ:";
			foreach ($giftLackOfStock as $key=>$name)
			{
				$errMsg .= $name . "��治��,";//��ʣ��" . $num ."��,";
			}
			$errMsg .= "�Ƿ�����µ�?";
			return array('errCode'=> -100, 'errMsg'=> $errMsg);
		}
		// �����ʾ
		if($lackGiftAndIgnore)
        {
			$newOrder['comment'] .= "\nϵͳ�Զ���ע���û��ѽ���ȱ����Ʒ��治�㡣";
		}

		//��������
        //����۸�
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
				$subOrders[$subOrderKey]['product_ids'][] = $sp['product_id']; //clark ��¼��ƷID
				$totalWeight += $sp['buy_count'] * $product_base_info[$sp['product_id']]['weight'];
				@$subOrders[$subOrderKey]['totalWeight'] += $sp['buy_count'] * $product_base_info[$sp['product_id']]['weight'];

				if(!isset($subOrders[$subOrderKey]['flag']))
                {
					$subOrders[$subOrderKey]['flag'] = 0;
				}
				if($product_base_info[$sp['product_id']]['type'] == $_ProductType['Service'])
                {
					$subOrders[$subOrderKey]['flag'] |= ORDER_HAS_SERVICE; //��¼�������Ƿ��з�������Ʒ
					$hasService = true;
				}
				if(in_array($sp['product_id'], $ProductForNongHang))
                {
					$subOrders[$subOrderKey]['flag'] |= ORDER_NONGHANG; //�����а���ũ����Ʒ
					$newOrder['isVat'] = self::NO_INVOICE; //�򲻿���Ʊ
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
                //��Ʒ�۸�  sheldonshi  �����Ƕ�ۺ�ļ۸�
                $product_base_info[$sp['product_id']]['price'] = $sp['price'];
				if($sp['type'] != SHOPPING_CART_PRODUCT_TYPE_NORMAL)
                {
					continue;
				}

				//ixiuzeng���,�����к�����ʱ�������߶�����Ʒ������һ����־λ
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

				// ����ǽ��ܲ�����Ʒ�����Ҳ��������Ϣ���������ж�Ϊ���ܲ�������
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
            //�����֧�߼�ֻ����������
			switch($promotion['benefit_type'])
			{
				case IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_CASH']:
					// ��������¼�Żݵ��ܼ�
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
		// MARK �������۽��
		reset($items);
		// �μӴ����������Ʒ�ܽ��
        //������ϸ
        $priceDetails = array();
        $energySaveDiscount = 0;
		foreach($items as $it)
		{
			$it_str = ToolUtil::gbJsonEncode($it);
			//$subOrderKey = $it['psystock'];
            $subOrderKey = $it['divide_id'];
			// MARK ��Ʒ�ĺ˶Լ۸����$pPrice������Ҫȷ��
			if( $it['package_id'] == 0 )
			{
				// �������۵���Ʒ������Ʒ���ܵļ���۸�
                $ptotalCut = 0;
                //�Ƿ���������
                if ($it['main_product_id'] > 0 && $it['match_num'] > 0) {
                    $ptotalCut = $it['match_num'] * $it['match_cut'];
                }
				// ����Ʒ�Ķ�ۺ󣬴���ǰ�ļ۸�
				$pPrice = $it['total_price_after'] - $ptotalCut;

                //ͳһ����˫д S
                @$subOrders[$subOrderKey]['total_pkg_cut'] += 0;
                @$subOrders[$subOrderKey]['total_match_cut'] += $ptotalCut;
                //ͳһ����˫д E
                self::Log("��ͨ��Ʒ��{$it['package_id']}��,����Ʒ���ܵļ���۸�{$ptotalCut},����Ʒ�������ܼ۸�{$pPrice},$it_str");
			}
			else
			{
				// �ײ���Ʒ��δ�������ۣ����ܵļ���۸�
				//$ptotalCut = $it['total_price_discount'] + $it['cash_back'] * $it['buy_count'];
                $ptotalCut = $it['cash_back'] * $it['buy_count'];
                if ($it['main_product_id'] > 0 && $it['match_num'] > 0) {
                    $ptotalCut += $it['match_num'] * $it['match_cut'];
                }
				//$pPrice = $it['promotion_price'] + $it['promotion_discount'] - $it['cash_back'] * $it['buy_count'];
				$pPrice = $it['total_price_after'] - $ptotalCut;

                //ͳһ����˫д S
                @$subOrders[$subOrderKey]['total_pkg_cut'] += $it['cash_back'] * $it['buy_count'];
                @$subOrders[$subOrderKey]['total_match_cut'] += $it['match_num'] * $it['match_cut'];
                //ͳһ����˫д E

                self::Log("�ײ���Ʒ��{$it['package_id']}��,����Ʒ���ܵļ���۸�{$ptotalCut},����Ʒ�������ܼ۸�{$pPrice},$it_str");
			}
			// �����Ż����Żݾ����ʽ��¼����̯��ÿ���Ӷ���
			@$couponInfo['subOrders'][$subOrderKey]['coupon_amt'] += $it['promotion_discount'];
			if($it['promotion_discount'] > 0)
            {
				@$couponInfo['subOrders'][$subOrderKey]['pids'][] = $it['product_id'];
                @$couponInfo['subOrders'][$subOrderKey]['apport'][$it['product_id']] += $it['promotion_discount'];
            }
			// ��¼������
			@$subOrders[$subOrderKey]['orderPrice'] += $pPrice;
			@$subOrders[$subOrderKey]['totalCut'] += $ptotalCut;


			$t = $orderPrice + $pPrice;
			self::Log("$orderPrice + $pPrice = $t");
			$orderPrice += $pPrice;
			@$totalCut += $ptotalCut;
            if($isEnergySubsidyOrder && 0 == $energySaveDiscount)
            {
                //���ܲ�����Ҫ�ѽ��ܲ����ļ���ӵ���Ʒ������
                $energySaveDiscount = $it['energy_save_discount'];
                $couponInfo['energy_save_name'] = $it['energy_save_name'];
                $product_base_info[$it['product_id']]['price'] += $energySaveDiscount;
                @$couponInfo['subOrders'][$subOrderKey]['coupon_amt'] = $energySaveDiscount;
                @$couponInfo['subOrders'][$subOrderKey]['pids'][] = $it['product_id'];
            }
            //�������������ϸ�ɣ�����û�ط�����
            self::setPriceDetail($priceDetails, $it, $wh_id);
		}
		self::Log("��̯��".ToolUtil::gbJsonEncode($couponInfo));

		if($newOrder['payType'] == COD)
        { //��������Ĩȥ��
			self::Log("��������ȥ��֮ǰ, $orderPrice");
			$orderPrice = 0;
			self::Log("����������Ʒ�����۸�".$orderPrice);
			foreach ($subOrders as $subOrderKey => $so)
            {
                $subOrders[$subOrderKey]['cod_adjust_price'] = $subOrders[$subOrderKey]['orderPrice'];
				$subOrders[$subOrderKey]['orderPrice'] = 10 * bcdiv($subOrders[$subOrderKey]['orderPrice'], 10, 0);
				$orderPrice += $subOrders[$subOrderKey]['orderPrice'];
                $subOrders[$subOrderKey]['cod_adjust_price'] = $subOrders[$subOrderKey]['orderPrice'] - $subOrders[$subOrderKey]['cod_adjust_price'];
				self::Log("��������Ĩȥ��,+{$subOrders[$subOrderKey]['orderPrice']}:".$orderPrice);
			}
		}
        //ǰ���ύ�ļ۸�Ҳ�Ƕ�ۺ�ļ۸�
		if(bccomp($orderPrice, $newOrder['Price'], 0) != 0)
        {
			self::$errCode = -2031;
			self::$errMsg = "�ܼۣ���̨����Ķ����۸�{$orderPrice}��ǰ̨�ύ�۸�{$newOrder['Price']}��һ��";
            self::Log("�ܼۣ���̨����Ķ����۸�{$orderPrice}��ǰ̨�ύ�۸�{$newOrder['Price']}��һ��");
            return array("errCode"=>-15, "errMsg" => "���г�����Ӱ�죬������Ʒ�۸����仯����ȷ�Ϻ��ύ������");
			//return false;
		}

        self::Log("suborders:". ToolUtil::gbJsonEncode($subOrders));
        //ǰ�˷ֵ����ӵ��۸�
		foreach ($subOrders as $subOrderKey=> $so)
        {
			if(bccomp($so['orderPrice'], $newOrder['suborders'][$subOrderKey]['price'], 0) != 0)
            {
				self::$errCode = -2030;
				self::$errMsg = "�Ӷ���{$subOrderKey}����̨����Ķ����۸�{$so['orderPrice']}��ǰ̨�ύ�۸�{$newOrder['suborders'][$subOrderKey]['price']}��һ��";
				self::Log("�Ӷ���{$subOrderKey}����̨����Ķ����۸�{$so['orderPrice']}��ǰ̨�ύ�۸�{$newOrder['suborders'][$subOrderKey]['price']}��һ��");
                return array("errCode"=>-15, "errMsg" => "���г�����Ӱ�죬������Ʒ�۸����仯����ȷ�Ϻ��ύ������");
                //return false;
			}
		}
        //���ܲ�����ʱ��� Start
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
        self::Log("�۸���һ�½�� orderPrice:" . ToolUtil::gbJsonEncode($subOrders));
        //���ܲ�����ʱ��� End
		self::Log("����Ķ����۸���ǰ̨�����۸�һ��", false);

        /*
		$pointMax -= $totalCut;
		$pointMax /= 10;
		$pointMax = ceil($pointMax < $orderPrice ? $pointMax : $orderPrice);
		$pointMax *= 10;
		$pointMin = ceil($pointMin);
		//����۸����
		//������ʹ�����
		if($newOrder['point'] < $pointMin || $newOrder['point'] > $pointMax)
        {
			return array(
                'errCode'=> -10,
                'errMsg'=> "�����ζ���������ʹ��" . ($pointMin / 10) . "������,�����ʹ��" . ($pointMax / 10) . "������"
            );
		}
        self::Log("������ʹ�����", false);
		//��ȡ�û����֣�ȷ���û�ʹ�õĻ��ֲ�������ӵ�еĻ���,������ֱ���Ҫ���ֽ���ֺʹ������֣�����ʹ���ֽ����
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
                    'errMsg'=>"���˻������ܶ�Ϊ{$userInfo['point']}�����ֻ��ʹ��{$userInfo['point']}������"
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
        self::Log("������ʹ�����", false);
        //��Ʒ֧���ܶ���������˷ѣ�
		$product_cash = $orderPrice - $newOrder['point'] - $couponInfo['amt'];
		if( bccomp( $product_cash, 0, 0 ) < 0 )
		{
			self::$errCode = -2040;
			self::$errMsg = '�û�ʵ����Ҫ֧���Ļ�����Ϊ����';
            self::Log("�û�ʵ����Ҫ֧���Ļ�����Ϊ����[product_cash:{$product_cash}]");
			return false;
		}

        //�����˷�
        $destination = $newOrder['receiveAddrId'];
        $user_level = empty($userInfo['level']) ? 0 : $userInfo['level'];
        $price_without_point = $orderPrice - $couponInfo['amt'];
        $orderShipPrice = 0;
        $mlog->start();
        if(strcmp($divideOrderType, "default") === 0)
        {
            //Ĭ��ʹ��Ĭ�ϵ�
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
            //��ȡors
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
        self::Log("��ȡ������Ϣ��getDeliveryInfo:[divideOrderType:{$divideOrderType}][shipRet:" . ToolUtil::gbJsonEncode($shipRet) . "]");
        $deliveryRet = self::checkDeliveryInfo($shipRet, $divideOrderType, $subOrders, $newOrder, $destination);
        if(false === $deliveryRet)
        {
            self::Log("���������Ϣʧ�ܣ�");
            return array(
                'errCode'=> self::$errCode,
                'errMsg'=> self::$errMsg,
            );
        }
        $orderShipPrice = $deliveryRet['orderShipPrice'];
        /*
        $shipInfo = $shipRet['shippingType'];
        $packageInfo = $shipRet['packages'];

        //ͬʱ����ܷ�ģ����Ʊ������ֵ��Ʊ
        if(isset($shipRet['availableInvoices']['isCanVAT']) && $shipRet['availableInvoices']['isCanVAT'] == false && $newOrder['invoiceType'] == INVOICE_TYPE_VAT) {

            return array('errCode'=> -20, 'errMsg'=> '���Ķ���������Ʒ���ܿ���ֵ˰��Ʊ');
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
                    //������  �½���  1-��������  2-������
                    if(isset($newOrder['suborders'][$subOrderKey]['isCanXpress']) && $newOrder['suborders'][$subOrderKey]['isCanXpress'] == 1)
                    {
                        //���������������ѡ������������У��
                        if(!isset($ship['subOrder'][$subOrderKey]['isCanXpress'])
                            || $ship['subOrder'][$subOrderKey]['isCanXpress'] != $newOrder['suborders'][$subOrderKey]['isCanXpress']
                        )
                        {
                            $tmpErrMsg = self::$errMsg;
                            self::$errCode = self::$errCode;
                            self::$errMsg = basename(__FILE__) . "����֤����ʱ�����" . self::$errMsg . ",subOrderItem" . var_export($subOrderItem, true);
                            return array('errCode' => self::$errCode, "errMsg" => $tmpErrMsg);
                        }
                        $subOrders[$subOrderKey]['isCanXpress'] = 2;
                        //�����͵�ʱ����ҪΪ��һ��ĵ�һ��ʱ��span
                        $newOrder['suborders'][$subOrderKey]['expectDate'] = 0;
                        $newOrder['suborders'][$subOrderKey]['expectSpan'] = 1; // ����ʱ��
                    }
                    else
                    {
                        $timeAvailable = array();
                        if(ICSON_DELIVERY == $newOrder['shipType'])
                        {
                            $timeAvailable = $ship['subOrder'][$subOrderKey]['timeAvaiable'];
                            $icson_delivery_info['expect_ship_date'] = $newOrder['suborders'][$subOrderKey]['expectDate']; // ��������
                            $icson_delivery_info['expect_time_span'] = $newOrder['suborders'][$subOrderKey]['expectSpan']; // ����ʱ��
                            $ret = self::verifyExpectDateSpan($icson_delivery_info, $timeAvailable, $destination);
                            if(false === $ret)
                            {
                                $tmpErrMsg = self::$errMsg;
                                self::$errCode = self::$errCode;
                                self::$errMsg = basename(__FILE__) . "����֤����ʱ�����" . self::$errMsg . ",subOrderItem" . var_export($subOrderItem, true);
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
            return array('errCode'=> -17, 'errMsg'=> "���ﳵ������Ʒ��֧����ѡ������ͷ�ʽ");
        }
        foreach($packageInfo as $subKey=>$package)
        {
            $subOrders[$subKey]['seller_id'] = $package['seller_id'];
            $subOrders[$subKey]['sale_mode'] = $package['sale_mode'];
            $subOrders[$subKey]['seller_address_id'] = $package['seller_stock_id'];
            //����С��
            $subOrders[$subKey]['order_size'] = $package['order_size'];
            $subOrders[$subKey]['order_volume'] = $package['order_volume'];
            $subOrders[$subKey]['order_longest'] = $package['order_longest'];
            $subOrders[$subKey]['order_weight'] = $package['totalWeight'];
        }
        */
        self::Log("���ͷ�ʽУ��" . ToolUtil::gbJsonEncode($deliveryRet));
        //�˷�У��
		if(bccomp($newOrder['shippingPrice'], $orderShipPrice, 0) != 0) {
			self::$errCode = -2038;
			self::$errMsg = 'web������˷�:' . $newOrder['shippingPrice'] . '��̨���¼�����˷�:' . $orderShipPrice . '����Ķ����˷Ѽ۸���ǰ̨�����˷Ѽ۸�һ��';
			self::Log('web������˷�:' . $newOrder['shippingPrice'] . '��̨���¼�����˷�:' . $orderShipPrice . '����Ķ����˷Ѽ۸���ǰ̨�����˷Ѽ۸�һ��');
            return array("errCode"=>-15, "errMsg" => "���г�����Ӱ�죬�����˷ѷ����仯����ȷ�Ϻ��ύ������");
            //return false;
		}
		//��Ʊ���������˷�,ǰ̨���˵������
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
				self::$errMsg = '�����˷Ѽ���ʧ��';
                self::Log('�����˷Ѽ���ʧ��'.$so['orderShipPrice']);
				return false;
			}
		}



        //�����ܵĽ��
		$cash = $orderShipPrice + $product_cash;
        //������ڸ��������
        if($isInstallmentOrder)
        {
            $limitMin = INSTALLMENT_LIMIT_PRICE_MIN;
            $limitMax = INSTALLMENT_LIMIT_PRICE_MAX;

            if($cash < $limitMin)
            {
                return  array('errCode'=>-51, 'errMsg'=>"��Ǹ�����ڸ���������Ͳ��õ���" . $limitMin / 100 . "Ԫ����������ѡ����Ʒ");
            }
            else if($cash > $limitMax)
            {
                return  array('errCode'=>-51, 'errMsg'=>"��Ǹ�����ڸ���������߲��ø���" . $limitMax / 100 . "Ԫ����������ѡ����Ʒ");
            }
            if ($cash < $installment['minprice'] || $cash > $installment['maxprice'])
            {
                return  array('errCode'=>-51, 'errMsg'=>"���Ķ������Ϊ" . $cash / 100 . "Ԫ������ѡ��{$newOrder['installment_num']}��");
            }
            $cashToPay = $newOrder['installment_num'] * round($installment['rate'] * $cash / $newOrder['installment_num']);
            $cashPerMonth = round($installment['rate'] * $cash / $newOrder['installment_num']);
        }

		//��ʼ��̯�Ż�ȯ&
		self::Log("��ʼ��̯�Ż�ȯ����");
		if($newOrder['point'] > 0)
        {
			ksort($subOrders);
		}
		//��̯�Ż�ȯ����Ʒ
        self::Log('��̯�Ż�ȯ����Ʒ');
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
		//��̯����
        self::Log('��̯����');
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
			//������̯��������ʣ�µĲ���
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

		//��ʼ�µ����������� ����orderdb�� �� mssql ��棬 commit����or callback����
		//��ȡ�¶�����
		self::Log("��ȡ�¶�����");
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
            self::Log("IIdGenerator4Order newOrderId ��ȡID���� errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
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
		//��ȡ������Ʊid
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['idGenerator']['req']);
        $mlog->start();
		$invoice_id = IIdGenerator4Order::getNewId($uid, 'so_valueadded_invoice_sequence', $orderNum);
		if(false === $invoice_id) {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['idGenerator']['failed']);
			self::$errCode = IIdGenerator4Order::$errCode;
			self::$errMsg = IIdGenerator4Order::$errMsg;
            self::Log("IIdGenerator4Order invoice_id ��ȡID���� errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['IIDGENERATOR4ORDER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
			return false;
		}
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['IIDGENERATOR4ORDER'], 0, 0, LocalServerIP, LocalServerIP);
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['idGenerator']['succ']);

		//��ȡ������id
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
				self::$errMsg = '��ȡ����������seqʧ��' . IIdGenerator4Order::$errMsg;
                self::Log("IIdGenerator4Order match_id_start ��ȡID���� errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['IIDGENERATOR4ORDER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
				return false;
			}
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['IIDGENERATOR4ORDER'], 0, 0, LocalServerIP, LocalServerIP);
		}
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['idGenerator']['succ']);
		//��ȡ������Ʒ��seqid
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['idGenerator']['req']);
        $mlog->start();
		$itemStartID = IIdGenerator4Order::getNewId($uid, 'So_Item_Sequence', $itemCount);
		if(false === $itemStartID) {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['idGenerator']['failed']);
			self::$errCode = -2047;
			self::$errMsg = '��ȡ������Ʒidʧ��' . IIdGenerator4Order::$errMsg;
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['IIDGENERATOR4ORDER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
            self::Log("IIdGenerator4Order itemStartID ��ȡID���� errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
			return false;
		}
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['IIDGENERATOR4ORDER'], 0, 0, LocalServerIP, LocalServerIP);
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['idGenerator']['succ']);
		//�������ŵ������ַ�
		foreach ($newOrder as $k => $no) {
			if($k == 'suborders' || $k == 'buy_one_key' || $k == 'send_coupon_success_info' || $k == 'send_coupon_record_info') {
				continue;
			}
			$newOrder[$k] = addslashes($no);
		}

		if( self::NO_INVOICE == $newOrder['isVat'] ) //�������Ҫ����Ʊ����ô�����ֶ�Ҳ��Ϊ��
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
                self::Log("orderDb ���Ӵ��� errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
				return false;
			}
		}
		self::Log("����orderdb����ʧ��");
        $mlog->start();
        $mlog->start();
		$sql = "begin transaction";
		$ret = $orderDb->execSql($sql);
		if(false === $ret) {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['orderDB']['failed']);
			self::$errCode = -2032 . " " . $orderDb->errCode;
			self::$errMsg = '����orderdb����ʧ��' . $orderDb->errMsg;
            self::Log("orderDb ����orderdb����ʧ�ܣ� errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ICSON_ORDER_CORE'], $orderDb->errCode, 1, LocalServerIP, LocalServerIP);
			return false;
		}

        $uniorder_parentOrder = array();
        $activeInfoList = array();

        //���˫д S sheldonshi
        $inventorysAllData = array();
        //���˫д E sheldonshi
		//��������˲𵥣����븸����
		$now = time();
		if($orderNum > 1) {
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
				'price_cut'           => $totalCut,                                 //�ײ���������Ż�
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
				self::$errMsg = 'ִ��sql���ʧ��' . $orderDb->errMsg;
				$sql = "rollback";
				$orderDb->execSql($sql);
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ICSON_ORDER_CORE'], $orderDb->errCode, 1, LocalServerIP, LocalServerIP);
                self::Log("orderDb ִ��sql���ʧ�ܣ� errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
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
            'isors'        => strcmp($divideOrderType, "default") === 0 ? 0 : 1,
		);
		$orderToSZ = array(
			'oid' => $parentOrderId,
			'status' => 0,
			//'cash' => $cash,
            'cash' => $isInstallmentOrder ? $cashToPay : $cash,
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
		if(false === $ret) {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['inventoryDB']['failed']);
			self::$errCode = -2035;
			self::$errMsg = '����ms sql����ʧ��' . $msSQL->errMsg;
			$sql = "rollback";
			$orderDb->execSql($sql);
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['INVENTORY_MANAGER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
            self::Log("msSQL ִ��sql���ʧ�ܣ� errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
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

 		$uniorder_orderList = array();
        $uniorder_tradeList = array();
        $installmentSubCount = 1;
		foreach ($shoppingProduct as $subOrderKey => $subOrder)
        {
            //ÿ��֧�����=��Ʒ��ۺ��ܼ�+�˷�-����/�Ż�ȯ��̯-����
			$cash = $subOrders[$subOrderKey]['orderPrice']
				+ $subOrders[$subOrderKey]['orderShipPrice']
				- (isset($subOrders[$subOrderKey]['couponamt']) ? $subOrders[$subOrderKey]['couponamt'] : 0)
				- (isset($subOrders[$subOrderKey]['point']) ? $subOrders[$subOrderKey]['point'] : 0);

			$isPayed = ($cash <= 0 ? 1 : 0);
            //������ڸ��� S sheldonshi
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
            //������ڸ��� E sheldonshi
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
			if($newOrder['separateInvoice'] == 1) {
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
					//'stockNo'          => $subOrderKey,
                    'stockNo'          => $packages[$subOrderKey]['psystock'],
				);
				$ret = $orderDb->insert("t_order_invoice_address_{$db_tab_index['table']}", $newInvAddr);
				if(false === $ret) {
                    ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['orderDB']['failed']);
					self::$errCode = -2050;
					self::$errMsg = 'ִ��sql���ʧ��' . $orderDb->errMsg;
					$sql = "rollback";
					$msSQL->execSql($sql);
					$orderDb->execSql($sql);
                    $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ICSON_ORDER_CORE'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                    self::Log("orderDb ִ��sql���ʧ�ܣ� errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
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
			    //����С��
                'Weight'                => isset($subOrders[$subOrderKey]['order_weight']) ? $subOrders[$subOrderKey]['order_weight'] : 0,
                'SaleSpec'              => isset($subOrders[$subOrderKey]['order_size']) ? $subOrders[$subOrderKey]['order_size'] : 0,
                'Volume'                => isset($subOrders[$subOrderKey]['order_volume']) ? $subOrders[$subOrderKey]['order_volume'] : 0,
                'LongestEdge'           => isset($subOrders[$subOrderKey]['order_longest']) ? $subOrders[$subOrderKey]['order_longest'] : 0,
                //������
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
            //ͳһ�����Ҷ� S
            $uniNewItem = $newItem;
            $uniNewItem['cod_adjust_price'] = isset($subOrders[$subOrderKey]['cod_adjust_price']) ? $subOrders[$subOrderKey]['cod_adjust_price'] : 0;
            $uniorder_orderList[] = $uniNewItem;
            $uniorder_tradeList[$newItem['order_char_id']] = array();

            if (strncmp('rule_', $couponInfo['code'], 5) == 0)
            {
                //��������
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
                //���ܲ���
                $activeInfoList[$oid][] = array(
                                    "activeNo" => "",
                                    "activeType" => 3,
                                    "activeRuleId" => "",
                                    "activeDesc" => "�μӽ��ܲ���",
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
                //�Ż�ȯ
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
                //��Ʒ��ȯ
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
                //�ײ�
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
                //������
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
			//ͳһ�����Ҷ� E
            self::Log("���붩������");
			$ret = $orderDb->insert("t_orders_{$db_tab_index['table']}", $newItem);
			if(false === $ret) {
                ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['orderDB']['failed']);
				self::$errCode = -2033;
				self::$errMsg = 'ִ��sql���ʧ��' . $orderDb->errMsg;
				$sql = "rollback";
				$msSQL->execSql($sql);
				$orderDb->execSql($sql);
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ICSON_ORDER_CORE'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                self::Log("orderDb ִ��sql���ʧ�ܣ� errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
				return false;
			}

			// �Ӷ������ݣ��Զ�������Ϊkey
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

			self::Log("���뷢Ʊ��");
			$ret = $orderDb->insert("t_order_invoice_{$db_tab_index['table']}", $newInv);
			if(false === $ret) {
                ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['orderDB']['failed']);
				self::$errCode = -2050;
				self::$errMsg = 'ִ��sql���ʧ��' . $orderDb->errMsg;
				$sql = "rollback";
				$msSQL->execSql($sql);
				$orderDb->execSql($sql);
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ICSON_ORDER_CORE'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                self::Log("orderDb ִ��sql���ʧ�ܣ� errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
				return false;
			}

			$_local_ip = ToolUtil::getLocalIp(0);
			$_local_ip = explode('.', $_local_ip);
			$_inserter = empty($_local_ip[3]) ? 7 : intval($_local_ip[3]);
			reset($subOrder);
            foreach ($subOrder as $sp) {
				//�����������
				if($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL && $sp['main_product_id'] != 0 && $sp['matchNum'] > 0)
                {
					$sql = "insert into t_order_match_{$db_tab_index['table']} values($match_id_start, '{$newOrderId}', {$sp['product_id']}, {$sp['main_product_id']},{$sp['matchNum']}, {$sp['cashCutPerItem']}, $now, $wh_id )";
                    $ret = $orderDb->execSql($sql);
					if(false === $ret) {
						self::$errCode = -2036;
						self::$errMsg = 'ִ��sql���ʧ��' . $orderDb->errMsg;
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

						if($pstock['AvailableQty'] + $pstock['VirtualQty'] >= $sp['buy_count']) { //���ô��ڹ�������
							//$sql = "update Inventory_stock set AvailableQty = AvailableQty - {$sp['buy_count']}, OrderQty = OrderQty + {$sp['buy_count']}, rowModifydate='{$timeNow}' where AvailableQty+VirtualQty>={$sp['buy_count']} AND ProductSysNo={$sp['product_id']} and StockSysNo=$subOrderKey";
                            $sql = "update Inventory_stock set AvailableQty = AvailableQty - {$sp['buy_count']}, OrderQty = OrderQty + {$sp['buy_count']}, rowModifydate='{$timeNow}' where AvailableQty+VirtualQty>={$sp['buy_count']} AND ProductSysNo={$sp['product_id']} and StockSysNo=$subKey";
							$ret = $msSQL->execSql($sql);
							$cnt = $msSQL->getAffectedRows();
							if((false === $ret) || (1 != $cnt)) {
                                ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['inventoryDB']['failed']);
								self::$errCode = -2047;
								self::$errMsg = "�ۼ�ms sql���ʧ��({$sp['product_id'] })" . $msSQL->errMsg;
								$sql = "rollback";
								$msSQL->execSql($sql);
								$orderDb->execSql($sql);
                                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['INVENTORY_MANAGER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                                self::Log("�ۼ�ms sql���ʧ�ܣ�[cnt:{$cnt}] errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
								return false;
							}

							//ixiuzeng��ӣ���Inventroy_Stock�Ŀ���޸ļ�¼���뵽Inventory_Flow����
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
								self::$errMsg = "����ms sql-Inventory_Flow��ʧ��({$sp['product_id'] })" . $msSQL->errMsg;
								$sql = "rollback";
								$msSQL->execSql($sql);
								$orderDb->execSql($sql);
                                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['INVENTORY_MANAGER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                                self::Log("����ms sql-Inventory_Flow��ʧ�ܣ�[cnt:{$cnt}] errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
								return false;
							}
                            //���˫д S sheldonshi
                            $inventoryData = array(
                                'product_id' => $sp['product_id'],
                                'sys_stock' => $subKey,
                                'order_id' => $newOrderId,
                                'order_creat_time' => $now,
                                'buy_count' => $sp['buy_count'],
                                'order_type' => $product_base_info[$sp['product_id']]['sale_model'] == 0 ? 1 : $product_base_info[$sp['product_id']]['sale_model'],
                            );
                            $inventorysAllData[] = $inventoryData;
                            //���˫д E sheldonshi
						}
						else if(($wh_id == 1) && (($product_base_info[$sp['product_id']]['flag'] & FORBID_SET_VIRTUAL) != FORBID_SET_VIRTUAL) &&
							//($product_base_info[$sp['product_id']]['type'] == PRODUCT_TYPE_NORMAL) && $_StockToStation[$subOrderKey] == $wh_id) {  //�Ϻ�վ��ͨ������Ʒ�������
                            ($product_base_info[$sp['product_id']]['type'] == PRODUCT_TYPE_NORMAL) && $_StockToStation[$subKey] == $wh_id) {  //�Ϻ�վ��ͨ������Ʒ�������
                            $sql = "update Inventory_stock set AvailableQty = AvailableQty - {$sp['buy_count']}, VirtualQty=VirtualQty + {$sp['buy_count']}, OrderQty = OrderQty + {$sp['buy_count']} , rowModifydate='{$timeNow}' where ProductSysNo={$sp['product_id']} and StockSysNo=$subKey";
							$ret = $msSQL->execSql($sql);
							$cnt = $msSQL->getAffectedRows();
							if($ret === false || 1 != $cnt) {
                                ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['inventoryDB']['failed']);
								self::$errCode = -2048;
								self::$errMsg = "�ۼ�ms sql���ʧ��({$sp['product_id'] })" . $msSQL->errMsg;
								$sql = "rollback";
								$msSQL->execSql($sql);
								$orderDb->execSql($sql);
                                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['INVENTORY_MANAGER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                                self::Log("�ۼ�ms sql���ʧ�ܣ�[cnt:{$cnt}] errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
								return false;
							}

							//ixiuzeng��ӣ���Inventroy_Stock�Ŀ���޸ļ�¼���뵽Inventory_Flow����
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
								self::$errMsg = "����ms sql-Inventory_Flow��ʧ��({$sp['product_id'] })" . $msSQL->errMsg;
								$sql = "rollback";
								$msSQL->execSql($sql);
								$orderDb->execSql($sql);
                                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['INVENTORY_MANAGER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                                self::Log("����ms sql-Inventory_Flow��ʧ�ܣ�[cnt:{$cnt}] errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
								return false;
							}


							//��������
                            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['idGenerator']['req']);
                            $mlog->start();
                            $auto_id = IIdGenerator4Order::getNewId($uid, 'SO_ProductVirtue_Sequence');
							if(false === $auto_id) {
                                ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['idGenerator']['failed']);
								self::$errCode = -2089;
								self::$errMsg = '��ȡ��������¼sqlʧ��' . IIdGenerator4Order::$errMsg;
								$sql = "rollback";
								$msSQL->execSql($sql);
								$orderDb->execSql($sql);
                                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['IIDGENERATOR4ORDER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                                self::Log("��ȡ��������¼sqlʧ�ܣ�errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
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
								self::$errMsg = '������¼ʧ��' . $orderDb->errMsg;
								$sql = "rollback";
								$msSQL->execSql($sql);
								$orderDb->execSql($sql);
                                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ICSON_ORDER_CORE'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                                self::Log("������¼ʧ�ܣ�errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
								return false;
							}
                            //���˫д S sheldonshi
                            $inventoryData = array(
                                'product_id' => $sp['product_id'],
                                'sys_stock' => $subKey,
                                'order_id' => $newOrderId,
                                'order_creat_time' => $now,
                                'buy_count' => $sp['buy_count'],
                                'order_type' => $product_base_info[$sp['product_id']]['sale_model'] == 0 ? 1 : $product_base_info[$sp['product_id']]['sale_model'],
                            );
                            $inventorysAllData[] = $inventoryData;
                            //���˫д E sheldonshi
						}
						else
                        { //���ڣ������ݲ�֧�ֽ����
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
							'cash_back'         => (($sp['main_product_id'] > 0 && $sp['type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL) ? $sp['matchNum'] * $sp['cashCutPerItem'] : 0) + $cb,                          //sheldonshi д���������˵���
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

						$newOrder['order_items'][] = $newOrderItems; //��Ҫ��order_item �����ú���
						$ret = $orderDb->insert("t_order_items_{$db_tab_index['table']}", $newOrderItems);
						if(false === $ret) {
                            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['orderDB']['failed']);
							self::$errCode = -2039;
							self::$errMsg = 'ִ��sql���ʧ��' . $orderDb->errMsg;
							$sql = "rollback";
							$orderDb->execSql($sql);
							$msSQL->execSql($sql);
                            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ICSON_ORDER_CORE'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                            self::Log("ִ��sql���ʧ�ܣ�errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
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
                        //ͳһ����
                        //��Ʒά�Ȼ�б�
                        $newOrderItems['promotion_price'] = $sp['promotion_total_price'];
                        $tradeActiveLists = array();
                        if(!empty($promotion)
                            && IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_CASH'] == $promotion['benefit_type']
                            && isset($couponInfo['subOrders'][$subOrderKey]['apport'][$sp['product_id']])
                        )
                        {
                            //��Ʒά�ȴ�����б�
                            $tradeActive = array(
                                "activeNo" => $promotion['rule_id'],
                                "activeType" => 2,
                                "activeRuleId" => $promotion['rule_id'],
                                "activeDesc" => $promotion['desc'],
                                "preActiveFee"  => $product_base_info[$sp['product_id']]['price'] * $sp['buy_count'] - $sp['matchNum'] * $sp['cashCutPerItem'] - $cb,       //��ۺ�ļ۸�
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
                            //��Ʒά���Ż�ȯ��б�
                            $tradeActive = array(
                                "activeNo" => isset($couponInfo['coupon_id']) ? $couponInfo['coupon_id'] : 0,
                                "activeType" => 5,
                                "activeRuleId" => isset($couponInfo['coupon_id']) ? $couponInfo['coupon_id'] : 0,
                                "activeDesc" => $couponInfo['coupon_name'],
                                "preActiveFee"  => $product_base_info[$sp['product_id']]['price'] * $sp['buy_count'] - $sp['matchNum'] * $sp['cashCutPerItem'] - $cb,           //��ۺ�ļ۸�
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
                            //��Ʒά���������б�
                            $tradeActive = array(
                                "activeNo" => $sp['main_product_id'],
                                "activeType" => 8,
                                "activeRuleId" => 1,                             //�����丨��Ʒ
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
                        //����������ϸ��Ķ�����ʱ����ֶ�
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

        //���˫д S sheldonshi
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
            //��ʽ���������µ������ؿ������
            //return false;
        }
        //���˫д E sheldonshi

		$mysqlDb = NULL;

		if(!empty($promotion)) {
			self::Log("ʹ���˴�������");
			//������ͻ��֣��Ż�ȯ������Ҫִ�����û��ʺ��﷢�Ż��֣��Ż�ȯ
			if(IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_POINT'] == $promotion['benefit_type']) {
				// �ͻ���
			}
			else if(IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_COUPON'] == $promotion['benefit_type']) {
				// ���Żݾ�
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
                        //���˫д S Sheldonshi
                        IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                        //���˫д E Sheldonshi
                        self::Log("���Ż�ȯerror��errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
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
                        //���˫д S Sheldonshi
                        IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                        //���˫д E Sheldonshi
                        self::Log("���Ż�ȯ transaction error��errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
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
                    //���˫д S Sheldonshi
                    IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                    //���˫д E Sheldonshi
					if(ICoupon::$errCode == -106) {
						return array('errCode'=> -987, 'errMsg'=> '��Ǹ�����μӵĻ�ѽ�������ֹ���������ع��ﳵ���²���');
					}
					else {
                        self::Log("���Ż�ȯ fetchCoupons error��errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
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
                        //���˫д S Sheldonshi
                        IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                        //���˫д E Sheldonshi
                        self::Log("���������!errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
						return false;
					}
                    //ͳһ����
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
                    //ͳһ����
				}
			}
		}

		//���¹���ȯ
		if(isset($newOrder['couponCode']) && $newOrder['couponCode'] != '') {
			self::Log("�����Ż�ȯ");
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
                    //���˫д S Sheldonshi
                    IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                    //���˫д E Sheldonshi
                    self::Log("�����Ż�ȯ!errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
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
                    //���˫д S Sheldonshi
                    IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                    //���˫д E Sheldonshi
                    self::Log("�����Ż�ȯ transaction!errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
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
                //���˫д S Sheldonshi
                IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                //���˫д E Sheldonshi
                self::Log("�����Ż�ȯ useCoupon!errCode" . self::$errCode . ";errMsg:" .self::$errMsg);

                return array(
                    'errCode' => -16,
                    'errMsg' => "��Ǹ����ʹ�õ��Ż�ȯ��ʱ�޷�ʹ�ã���ȷ�ϣ�",
                );
                //return false;
			}
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['USECOUPON'], 0, 0, LocalServerIP, LocalServerIP);
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['coupon']['succ']);
		}

		//����ǽ��ܲ����������򽫽��ܲ���������Ϣ�����Ӧ�ı�
		if($isEnergySubsidyOrder) {
			self::Log("���ܲ�������");
			//������ܲ�������
            $mlog->start();
			$coreDb = ToolUtil::getMSDBObj('ICSON_CORE');
			$sql = "begin transaction";
			$ret = $coreDb->execSql($sql);
			if(false === $ret) {
				self::$errCode = -2035;
				self::$errMsg = '����ms sql����ʧ��' . $coreDb->errMsg;
				$sql = "rollback";
				if(isset($mysqlDb) && !empty($mysqlDb)) {
					$mysqlDb->execSql($sql);
				}
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ICSON_CORE'], self::$errCode, 1, LocalServerIP, LocalServerIP);
				$orderDb->execSql($sql);
				$msSQL->execSql($sql);
                //���˫д S Sheldonshi
                IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                //���˫д E Sheldonshi
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
                //���˫д S Sheldonshi
                IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                //���˫д E Sheldonshi
				return false;
			}
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ICSON_CORE'], 0, 0, LocalServerIP, LocalServerIP);
		}

		//���»���
		if($newOrder['point'] > 0)
		{
			//����ۼ����ֵ���ˮ
			self::Log("���»���");
			global $_SCORE_TYPE;
            $mlog->start();
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['score']['req']);
			$ret = IScore::addScore($uid, $_SCORE_TYPE['CREATE_ORDER']['id'], -1 * $newOrder['point'] / 10, "���µ�10" . ($newOrderId - 1) . "���ѻ���", '', -1 * $cash_point_used / 10, -1 * $promotion_point_used / 10);
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
                //���˫д S Sheldonshi
                IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
                //���˫д E Sheldonshi
                self::Log("���»��� useCoupon!errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
				return array('errCode'=> -987, 'errMsg'=> '��Ǹ�����Ķ�����ʹ�û����쳣�����ύ����ʧ�ܣ��������Ժ������µ������ύ����ʱ�ݲ�ʹ�û���');
			}
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['score']['succ']);
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ADDSCORE'], 0, 0, LocalServerIP, LocalServerIP);
		}

		//�ۼ���۴�������
		self::Log("�ۼ�������۴���");
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
            //���˫д S Sheldonshi
            IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
            //���˫д E Sheldonshi
            self::Log("�ۼ�������۴��� useCoupon!errCode" . self::$errCode . ";errMsg:" .self::$errMsg);
            //�����е����⣬����µ�ʧ���ˣ���Ҫ�ع�����
            if($newOrder['point'] > 0)
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

			return array('errCode'=> -989, 'errMsg'=> '��Ǹ�����Ķ�����ϵͳ�쳣�����ύ����ʧ�ܣ��������Ժ������µ�');
		}
		else
		{
			$restricts = $ret["restrict"];
		}

		self::Log("commit����");
		$sql = "commit";

		if(!empty($mysqlDb)) {
			$mysqlDb_commit_ret = $mysqlDb->execSql($sql);
		}

		if(!empty($coreDb)) {
			$coreDb_commit_ret = $coreDb->execSql($sql);
		}

		$msSQL_commit_ret = $msSQL->execSql($sql);
		$orderDb_commit_ret = $orderDb->execSql($sql);

		//��������������ύʧ�ܣ���ʹ���˻���,����Ҫ��¼������Ϣ
		if(!$orderDb_commit_ret)
		{
			//�ع���۴�������
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

                self::Log("$uid �û��¶��� {$backDate['order_id']} ����ʹ�õĻ��ֽ���1��Сʱ�ڷ����������˻�");
                $ret = IScore::insertBackData($backDate);
                return array('errCode'=> -988, 'errMsg'=> '��Ǹ�����Ķ����ύʧ�ܣ�����ʹ�õĻ��ֽ���1��Сʱ�ڷ����������˻�');
            }
		}
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['orderDB']['succ']);
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_ORDER]['inventoryDB']['succ']);

        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['ICSON_ORDER_CORE'], 0, 0, LocalServerIP, LocalServerIP);
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['INVENTORY_MANAGER'], 0, 0, LocalServerIP, LocalServerIP);
		// �ϱ���������ʹ�ü�¼

		if(isset($newOrder['rule_id']) && $newOrder['rule_id'] > 0) {
			$orders = explode(",", $orderstrforlog);
			foreach ($orders as $o) {
				if(!empty($o)) {
					DataReport::report(3001, DATA_TYPE_1DAY, array($wh_id, $o, $newOrder['rule_id'], $userInfo['level'], $uid));
				}
			}
		}

		//д���û�����Ʒ��ȯ��Ϣ
		if(isset($newOrder['send_coupon_record_info']) && $newOrder['send_coupon_record_info'] != '') {
			$ret = EA_Promotion::setUserJoinedRecord($uid, $now, $newOrder['send_coupon_record_info'], $orders_items_array);
		}

		self::writePriceDetail($uid, $priceDetails);
		self::reportORS($ORS_Report_Data);
		self::reportToSZ($orderToSZ, $items); //TAPD 5478549 �����ϱ�
		self::reportBaiduSem($_COOKIE, $subOrders, $wh_id); // �ϱ��ٶ�sem����
		self::reportGSadid($_COOKIE, $subOrders, $wh_id); // �ϱ� ��˫ ����
		//ɾ�����ﳵ
		if(!(isset($newOrder['buy_one_key']) && true === $newOrder['buy_one_key'])) {
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
		if($newOrder['point'] > 1000) {
			$mobile = $userInfo['mobile'];
			$time = date("Y-m-d H:i:s");
			$ret = IMessage::sendSMSMessage($mobile, "������Ѹ���˻���" . $time . "�µ���ʹ�û���" . $newOrder['point'] / 10 . "����������" . $parentOrderId . "�������������µ�400-828-1878");
			if(false === $ret) {
				self::Log("���Ͷ��ţ�������Ϣʧ�ܣ�" . IMessage::$errMsg);
			}
		}

        //*******************ͳһ����˫д�Ҷ� Start*****************
        //writeUniOrdersData($uid, $uniorder_orderList, $orderNum, $uniorder_parentOrder, $uniorder_tradeList, $newOrder, $activeInfoList, $isEnergySubsidyOrder)
        global $_UIN_ORDER_WHITE_LIST;
        if($_UIN_ORDER_WHITE_LIST['flag'])
        {
            //�Ҷ�
            if($_UIN_ORDER_WHITE_LIST['type'] == 1)
            {
                //�������Ҷ�
                if(in_array($uid, $_UIN_ORDER_WHITE_LIST['list']))
                {
                    self::writeUniOrdersData($uid, $uniorder_orderList, $orderNum, $uniorder_parentOrder, $uniorder_tradeList, $newOrder, $activeInfoList, $isEnergySubsidyOrder);
                }
            }
            else if($_UIN_ORDER_WHITE_LIST['type'] == 2)
            {
                //uidȡģ�Ҷ�
                $mod = $_UIN_ORDER_WHITE_LIST['mod'];
                if($uid % $mod == 0)
                {
                    //дͳһ����
                    self::writeUniOrdersData($uid, $uniorder_orderList, $orderNum, $uniorder_parentOrder, $uniorder_tradeList, $newOrder, $activeInfoList, $isEnergySubsidyOrder);
                }
            }
            else if($_UIN_ORDER_WHITE_LIST['type'] == 3)
            {
                //ȫ��
                self::writeUniOrdersData($uid, $uniorder_orderList, $orderNum, $uniorder_parentOrder, $uniorder_tradeList, $newOrder, $activeInfoList, $isEnergySubsidyOrder);
            }
        }
        //*******************ͳһ����˫д�Ҷ� End********************
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

	// ����·����¼
	/*private static function opPathRecord($priceDetails, $uid)
	{
		//��ȡdb��д����
		$dbtable = ToolUtil::getDBTableIndex($uid);
		$priceDetailDB = ToolUtil::getDBObj('order_items_price_detail', $dbtable['db']);
		if(false === $priceDetailDB) 
		{
			//��¼������־����
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
					//������ϸ������¼��־����
					$strPriceDetail = ToolUtil::gbJsonEncode($priceDetail);
					Logger::err("order_items_price_detail insert table failed![uid:{$uid}][strPriceDetail:{$strPriceDetail}]");
				}
			}
		}
		return;
	}*/

	/**
	 * @static ���Ԥ����Ϣ
	 * @param $uid �û�ID
	 * @param $items �������Ʒ
	 */
	public static function checkAppointInfo($uid, $items)
	{
		//self::Log(ToolUtil::gbJsonEncode($items));
		$now = time();
		// �Ƿ�ԤԼ
		$isAppointed = true;

		// ��Ʒ���Ƿ����ԤԼ��Ʒ
		$hasAppointedProduct = false;

		//$lastItem = false;
		foreach ($items as $item) {

			if(!isset($item['event_id']) || $item['event_id'] <= 0) {
				continue;
			}

			if($now < $item['buy_time_from'] or $now > $item['buy_time_to']) {
				// ����ԤԼ����ʱ����ڣ�����ԤԼ��飬����ֱ�ӹ���
				continue;
			}

			$hasAppointedProduct = true;

			$event_id = $item['event_id'];
			$ret = IActAppoint::hasAppointed($event_id, $uid);
			if($ret === false) {
				// ���û�û�вμ�ԤԼ
				$isAppointed = false;
				self::$errMsg = 6002;
				self::$errCode = "�����ﳵ�е�\"{$item['name']}\"ΪԤ����Ʒ����ҪԤ���ʸ���ܹ���Ŷ";
				break;
			}

		}

		//self::Log(var_export($isAppointed, true));

		// ��������Ԥ����Ʒ
		if($hasAppointedProduct) {
			// ����û��Ƿ����ʸ�
			return $isAppointed;
		}

		// ������û��Ԥ����Ʒ��ֱ�ӷŹ�
		return true;
	}

	private static function setShoppingCartInfo($newOrder)
	{
		$newOrderItems = array();

		$shopping_cart_type = IShoppingCartV2::ONLINE_CART;

		if((isset($newOrder['buy_one_key']) && true === $newOrder['buy_one_key']) //���������һ���������suborders��ȡ��Ʒ
			|| (isset($newOrder['ism']) && $newOrder['ism'] == 2) //����ǽ��ܲ�����Ʒ��Ҳ��suborders��ȡ��Ʒ
		) //����Ƿ���������Ҳ��suborders��ȡ��Ʒ
		{
			while (FALSE !== ($node = current($newOrder['suborders']))) {
				if(!isset($node['items'])) {
					return array('errCode'=> 10, 'errMsg'=> "���ύ�Ķ��������������飡");
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
		// �ϱ��ٶ�sem����
		$reportID = 3201;
		if(isset($_COOKIE['mediav_data']) && $_COOKIE['mediav_data'] != '') {
			$cookie_data = $_COOKIE['mediav_data'];
			self::Log("�ϱ��ٶ�sem���� {$cookie_data} ");
			self::_dataReport($reportID, $cookie_data, $subOrders, $wh_id);
		}
	}

	private static function reportGSadid($_COOKIE, $subOrders, $wh_id)
	{
		// 5468935 ��˫���������ϱ�
		$reportID = 3202;
		if(isset($_COOKIE['gsadid_data']) && $_COOKIE['gsadid_data'] != '') {
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
		if(time() - $_time < 7 * 24 * 60 * 60) {
			foreach ($subOrders as $stockNo=> $o) {
				// �ϱ����ж���
				DataReport::report($reportID, DATA_TYPE_1DAY, array($wh_id, $o['orderId'], $stockNo, $_data));
			}
		}
	}
    private static function setPriceDetail(&$priceDetails, $item, $whid)
    {
        //������ϸ��¼ Start
        $priceDetail = array();
        $priceDetail['product_id'] = $item['product_id'];
        //$priceDetail['order_char_id'] = $item['order_char_id'];
        //$priceDetail['create_time'] = $now;
        $priceDetail['product_char_id'] = $item['product_char_id'];
        $priceDetail['wh_id'] = $whid;
        $priceDetail['buy_num'] = $item['buy_count'];
        //���һ���м���
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

        //�д����Żݼ�������Ż�
        if(isset($item['op_path']['op_path_full_discount']) && count($item['op_path']['op_path_full_discount']) > 0)
        {
            //�д����Ż�
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
        //������ϸ��¼ End
        return;
    }
	private static function writePriceDetail($uid, $priceDetails)
	{
		//дcmem
        $priceDetailsJson = ToolUtil::gbJsonEncode($priceDetails);
        Logger::err("order_items_price_detail get db failed![uid:{$uid}][priceDetail:{$priceDetailsJson}]");
        $tm = Config::getTMem('order_price_detail_config');
        if($tm === false) {
            //��¼������־����
            $priceDetailsJson = ToolUtil::gbJsonEncode($priceDetails);
            Logger::err("order_items_price_detail get db failed![uid:{$uid}][priceDetail:{$priceDetailsJson}]");
            return false;
        }
        //���ݶ���id����
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
	 * @return bool true
	 */
	private static function reportToSZ($order, $products) {
		$env = get_cfg_var('env.name');

		if(empty($env) || $env == "beta") { // ���ϻ���
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
		$order['recv_region'] = isset($_District[ $order['recv_region'] ]) ? $_District[ $order['recv_region'] ]['name'] : ''; //��name��д��

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
                'packageid' => $pdt['package_id'],  //�ײ�id
			);
		}

		$udpAry = array();
		foreach($data as $phaseCnt) {
			if(is_string($phaseCnt)) { //��һƬ��
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
			self::Log($newOrder['ism']);
			self::Log(__LINE__);return false;
		}


		if( !isset($newOrder['es_type']) )
		{
			// �������ʹ���
			self::Log(__LINE__);return false;
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
				self::$errMsg = "̧ͷ������ȫ���ģ����Ȳ��ܳ���{$relly_len}������";
				self::Log(__LINE__);return false;
			}


			if(empty($newOrder['es_idCard']) or !ToolUtil::checkIDCard($newOrder['es_idCard']))
			{
				// ����ID
				self::$errMsg = "���֤��Ϊ�գ�����Ϊ15����18";
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
				self::$errMsg = "��ҵ���ֲ�Ϊ�գ����Ȳ��ܳ���{$relly_len}";
				self::Log(__LINE__);return false;
			}


			if(empty($newOrder['es_idCard'])
				or strlen($newOrder['es_idCard']) > 60
				or !is_string($newOrder['es_idCard']))
			{
				// ����ID
				self::$errMsg = "��ҵִ�ղ�Ϊ�գ����Ȳ�����60���ַ�";
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
				self::$errMsg = "��ҵ��λ����Ʊ̧ͷ����Ϊ�գ����Ȳ��ܳ���{$relly_len}";
				self::Log(__LINE__);return false;
			}

		}
		else
		{
			self::Log(__LINE__);return false;
		}
		//����xss����
		$newOrder['es_name'] = ToolUtil::transXSSContent($newOrder['es_name']);
		self::Log(__LINE__);return true;

	}

    public static function verifyExpectDateSpan($icson_delivery_info, $timeAvailable, $destination)
    {
        //self::Log("verifyExpectDateSpan". ToolUtil::gbJsonEncode($icson_delivery_info)."time:". ToolUtil::gbJsonEncode($timeAvailable)."destination:".$destination);
        if (!is_array($timeAvailable) || count($timeAvailable) == 0) {
            self::$errCode = -11;
            self::$errMsg = "�����ݲ��ṩ���ͷ���лл���Ĺ�ע";
            return false;
        }
        else
        {
            $isExpect = false;
            if(!isset($icson_delivery_info['expect_ship_date']) || !isset($icson_delivery_info['expect_time_span']))
            {
                self::$errCode = -11;
                self::$errMsg = "û����������ʱ��";
                return false;
            }
            $expect_ship_date = $icson_delivery_info['expect_ship_date'];
            $expect_time_span = $icson_delivery_info['expect_time_span'];
            //self::Log($expect_ship_date."===".$expect_time_span);
            // �������ʱ���Ƿ��ڿ��õ�����ʱ���ڣ�Ĭ�ϲ���ȷ
            //self::Log("verifyExpectDateSpan". ToolUtil::gbJsonEncode($timeAvailable));
            foreach ($timeAvailable as $span)
            {
                if (strtotime($span['ship_date']) == strtotime($expect_ship_date) && $span['time_span'] == $expect_time_span )
                {   // ���µ�ʱ��δ���
                    // �ҵ����û���ѡ��ʱ�䣬���ݵ�ǰ״̬����ʾ
                    $s = self::$timeSpan[$span['time_span']];
                    $selected_time = date("n��j��{$s}",strtotime($span['ship_date']));
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
                            self::$errMsg = "�����ᵥʱ��{$stop}����ѡ���\"{$selected_time}\"�Ѳ����ã�����ȷ��������ѡ��";
                            break;
                        case self::LIMITED:
                            $isExpect = false;
                            self::$errCode = -11;
                            self::$errMsg = "��ѡ���\"{$selected_time}\"�����������������ȷ��������ѡ��";
                            break;
                        default;
                            break;
                    }
                    return $isExpect;
                }
            }
        }
        self::$errCode = -11;
        self::$errMsg = "���ύ������ʱ�䲻��ȷ������ȷ��������ѡ��";
        return false;
    }

    /**
     * @param $str �µ���¼��־
     * @param string $folder ��¼�����ļ��У�Ĭ��Ϊorder���ڻ����ϵ�·��Ϊ /data/logs/order/��������ļ�������������û�к�׺
     * @param bool $backtrace �Ƿ���Ҫ����·����Ĭ��true
     */
    public static function Log($str, $backtrace = true, $folder = "order")
    {
        $vk = self::$visitkey;
        EL_Flow::getInstance("{$folder}")->append("vk:{$vk}," . $str, $backtrace);
    }

    /**
     * ����д�뵽ͬһ��̨
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
        //***********************�Ҷ�˫д�������� start****************************
        $uniorder = array(
            'uid'           =>  $uid,
            'buyerId'       =>  0,  //ͳһ�û�id����ͳһ�û�ϵͳ��ȡ��wgid
            'buyerAccount'  =>  '', //����ʺ�, ��ͳһ�û�ϵͳ��ȡ����¼email���ⲿ�˻���qq�ŵȣ�
            'buyerNickName' =>  '',//�������, ��ͳһ�û�ϵͳ��ȡ
            'buyerNick'     =>  ''  //����ǳ�, ��ͳһ�û�ϵͳ��ȡ
        );

        $uniorder['orderInfoList'] = array();
        //for ($i = 0, $len = count($uniorder_orderList); $i < $len; $i++) {
        foreach($uniorder_orderList as $i => $order){
            //$order = $uniorder_orderList[$i];
            //����
            $orderData = array(
                'order_id'          => $order['order_id'],
                'order_char_id'     => $order['order_char_id'],
                'ls'                => $order['ls'],
                'pay_type'          => $order['pay_type'],
                'cash'              => $order['cash'],//����ʵ���ܽ��
                'flag'              => $order['flag'],
                'bits'              => $order['bits'],
                'discount'          => $order['price_cut'] + $order['coupon_amt'],//�Ż��ܽ��
                //'totalFee'          => $order['order_cost'] - $order['shipping_cost'] - $order['price_cut'] - $order['coupon_amt'],
                'dealAdjustFee'     => $order['cod_adjust_price'],
                'shipping_cost'     => $order['shipping_cost'],//�ʷѽ��
                'premium_cost'      => $order['premium_cost'],//�˷ѱ��շ�
                'point_pay'         => $order['point_pay'],//����֧��ֵ
                'point'             => $order['point'],//��û���ֵ
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
                'is_vat'            => $order['is_vat'],//�Ƿ񿪷�Ʊ
                'orderNum'          => $orderNum,//��������
                'parentOrderId'     => $orderNum > 1 ? $uniorder_parentOrder['order_id'] : $order['order_id'],
                'hw_id'             => $order['hw_id'],
                'coupon_amt'        => (isset($newOrder['couponCode']) && $newOrder['couponCode'] != "") ? $order['coupon_amt'] : 0,//�Ż�ȯ���
                'cash_point'        => $order['cash_point'],//�ֽ����֧��ֵ
                'promotion_point'   => $order['promotion_point'],//��������֧��ֵ
                'shipping_type'     => $order['shipping_type'],//��Ѹ���ͷ�ʽ
                //'rate'              => $order[''],//��Ѹƽ�����
                //'back_rate'         => $order[''],//��Ѹ��������
                'shop_id'           => $order['shop_id'],
                'shop_guide_id'     => $order['shop_guide_id'],
                'shop_guide_cost'   => $order['shop_guide_cost'],
                'shop_guide_name'   => $order['shop_guide_name'],
                'stockNo'           => $order['stockNo'],
                'price_cut'         => $order['price_cut'],//�������ֽ��
                'order_cost'        => $order['order_cost'],//�������,���ڸ���ʹ��
                'cpsinfo'           => $order['cpsinfo'],
                //��Ѹ��Ӫ
                'seller_id'         => $order['seller_id'],
                'sale_model'        => $order['sale_model'],
                'seller_address_id' => $order['seller_address_id'],
                //����С��
                'SaleSpec'          => $order['SaleSpec'],
                'Weight'            => $order['Weight'],
                'Volume'            => $order['Volume'],
                'LongestEdge'       => $order['LongestEdge'],
                //������
                'shipping_flag'     => $order['shipping_flag'],
            );
            //���ڸ��� ->��������
            if(isset($newOrder['IsInstallment']) && $newOrder['IsInstallment'] == 1)
            {
                $orderData['installment'] = array();
                $orderData['installment']['installment_bank'] = $order['installment_bank'];
                $orderData['installment']['installment_num'] = $order['installment_num'];
                $orderData['installment']['cash_per_month'] = $order['cash_per_month'];
                $orderData['installment']['rate'] = $order['rate'];
                $orderData['installment']['back_rate'] = $order['back_rate'];
            }

            //���ܲ���
            if($isEnergySubsidyOrder){
                $orderData['subsidy'] = array();
                $orderData['subsidy']['type'] = intval($newOrder['es_type']);
                $orderData['subsidy']['name'] = $newOrder['es_name'];
                $orderData['subsidy']['idCard'] = $newOrder['es_idCard'];
            }

            //��Ʊ
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

            //��Ʊ���붩��
            if($newOrder['separateInvoice'] == 1){
                $orderData['invoiceSeparate'] = array();
                $orderData['invoiceSeparate']['receiver'] = $newOrder['invoiceReceiver'];
                $orderData['invoiceSeparate']['receiver_addr'] = $newOrder['invoiceReceiveAddrDetail'];
                $orderData['invoiceSeparate']['receiver_addr_id'] = $newOrder['invoiceReceiveAddrId'];
                $orderData['invoiceSeparate']['receiver_mobile'] = $newOrder['invoiceReceiverMobile'];
                $orderData['invoiceSeparate']['receiver_tel'] = $newOrder['invoiceReceiverTel'];
                $orderData['invoiceSeparate']['receiver_zip'] = $newOrder['invoicezipCode'];
                $orderData['invoiceSeparate']['shipping_type'] = YT_DELIVERY;//Ŀǰֻ֧��Բͨ
                $orderData['invoiceSeparate']['shipping_cost'] = 1000; //��Ϊ��λ
            }

            //����->��Ʒ��
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
                    'main_product_id'   => $trade['main_product_id'],//��Ʒ�ײ�����ƷID
                    'cost'              => $trade['cost'],//��Ʒ�ɱ���
                    'price'             => $trade['price'],//��Ʒ�ɽ���
                    'apportToMkt'       => $trade['apportToMkt'],//��ӪB2C�г�
                    'apportToPm'        => $trade['apportToPm'],//��ӪB2CPM
                    'use_virtual_stock' => $trade['use_virtual_stock'],//��ӪB2C�Ƿ�ռ�����
                    'buy_num'           => $trade['buy_num'],//��Ʒ�ɽ�����
                    'totalFee'          => $trade['promotion_price'] - $trade['cash_back'] - ((isset($newOrder['couponCode']) && $newOrder['couponCode'] != "") ? $trade['apportToMkt'] : 0),//��Ʒ���ܽ�� �ɽ���*�ɽ�����-�Ż��ܽ����������֣�
                    'payment'           => $trade['promotion_price'] - $trade['cash_back'] - ((isset($newOrder['couponCode']) && $newOrder['couponCode'] != "") ? $trade['apportToMkt'] : 0),//ʵ���ܽ�� �ɽ���*�ɽ�����-�Ż��ܽ����������֣�
                    'discount'          => $trade['cash_back'] + $trade['apportToMkt'],//�Ż��ܽ��  ����·���Ż��ܽ��֮�ͣ����������֣���̯������Ʒ�ӵ��ϵ��Ż��ܺͣ����ɻ�б���ܵõ�
                    'points_pay'        => $trade['points_pay'],//����֧��ֵ
                    'points'            => $trade['points'],//��û���ֵ
                    'flag'              => $trade['flag'],
                    'type'              => $trade['type'],
                    'warranty'          => $trade['warranty'],//��������
                    'product_id'        => $trade['product_id'],
                    'product_char_id'   => $trade['product_char_id'],
                    'edm_code'          => $trade['edm_code'],
                    'OTag'              => $trade['OTag'],
                    'shop_guide_cost'   => $trade['shop_guide_cost'],//��Ѹ���̵�������
                    'point_type'        => $trade['point_type'],//��Ѹ���ֶһ�����
                    'package_ids'       => $trade['package_ids'],//��Ѹ��Ʒ�ӵ��ײ�id
                    'cash_back'         => $trade['cash_back'],//�ӵ����ֽ��
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
        //***********************�Ҷ�˫д�������� end****************************
    }
}
