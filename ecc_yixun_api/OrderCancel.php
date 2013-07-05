<?php

require_once(PHPLIB_ROOT . 'lib/DataReport.php');
require_once(PHPLIB_ROOT . 'inc/district.inc.php');
require_once(PHPLIB_ROOT . 'inc/special.constant.inc.php');

class EA_OrderCancel
{
	public static $errCode = 0;
	public static $errMsg = '';
	public static $logMsg = '';


	/**
	 * @static
	 * @desc            �ϲ�ȡ��������һ���Կ���ȡ��1�����߶��������������������Ǹ��Ӷ�����
	 * @param $uid      �û��ı��id
	 * @param $orders   ��Ҫȡ���Ķ���id
	 *                  1�������飬��ֵΪ������
	 *                  2�����飬�ṹ
	 *                     array(
	 *                          'p_order_id'=> ������id,
	 *                          's_order_id'=> array(�Ӷ�����_1,�Ӷ�����_2);
	 *                     )
	 * @return bool
	 * @comment         �ϲ�ȡ���Ĵ����붼��3000���ڵģ�3099���¶������ڲ�������ϵͳ��������⣬��ʾ����һ��
	 */
	public static function setPOrderCanceled($uid, $orders)
	{
		///��鴫��Ĳ����Ƿ���ڣ��Բ�����Ԥ����
		if (empty($orders))
		{
			self::$errCode = 3001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "orders is empty";
			return false;
		}

		if (empty($uid))
		{
			self::$errCode = 3002;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid is empty";
			return false;
		}

		$order_ids = array();   //��¼��Ҫȡ���Ķ�����
		$p_order_id = null;
		$s_orders_id = null;
		if (!is_array($orders)) //��ʾȡ���ĵ�������
		{
			$order_ids[] = $orders;
		}
		else
		{
			$order_ids = $orders['s_order_id'];
			$s_orders_id = $orders['s_order_id']; //��¼���е��Ӷ���id
			$order_ids[] = $orders['p_order_id'];
			$p_order_id = $orders['p_order_id'];  //��¼������id
		}
		///�����Դ���Ĳ�����Ԥ����


		///һ���Ի�ȡ��������Ļ�����Ϣ��������ȡ������
		$orders_info = IOrder::getSomeOrders($uid, $order_ids);


		///��ʼ���ݶ�����Ϣ��鴫��Ķ����Ƿ���ȷ
		//���ض�����Ϣ����������Ҫ��ѯ�Ķ���������һ��ʱ����ʾ�������쳣
		if (count($order_ids) != count($orders_info))
		{
			//��Ҫ�ҳ��ļ�������û�ж�����Ϣ
			self::$errCode = 3003;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "some order no exsit";
			return false;
		}

		//����Ǻϲ�ȡ�����˲鸸�������Ӷ����Ĺ�ϵ�Ƿ���ȷ
		if (!empty($p_order_id))
		{
			//�˲��Ӷ�������
			if ($orders_info[$p_order_id]['subOrderNum'] != count($s_orders_id))
			{
				self::$errCode = 3004;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "p_order_id($p_order_id)���Ӷ����������ύ�Ĳ�һ��";
				return false;
			}

			foreach ($s_orders_id as $sub)
			{
				if ($orders_info[$sub]['pOrderId'] != $p_order_id)
				{
					self::$errCode = 3005;
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "s_order_id($sub)�ĸ����������ύ�Ĳ�һ��";
					return false;
				}
			}
		}

		//��鶩����ǰ��״̬�Ƿ����ȡ��
		foreach ($order_ids as $oid)
		{
			$ret_can_cancel = IOrder::checkCanCancel($orders_info[$oid]);
			if (false === $ret_can_cancel)
			{
				self::$errCode = 3006;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_id($oid) can not canceled";
				return false;
			}
		}
		///�������ݶ�����Ϣ��鴫��Ķ����Ƿ���ȷ


		///��ʼ�������ݿ⣬ִ��ȡ�������Ĳ������ú�������ֻ�������ݿ�Ĳ������������߼�
		$ordersData['uid'] = $uid;
		$ordersData['orders_info'] = $orders_info;
		if (!empty($p_order_id)) //�Ӷ�����Ϣ���н�������ɾ����
		{
			unset($ordersData['orders_info'][$p_order_id]);
		}
		$ret = self::doCancel($ordersData);
		///�����������ݿ�

		return $ret;
	}


	/**
	 * @static
	 * @param $ordersData
	 * @return bool
	 */
	private static function doCancel(&$ordersData)
	{
		$uid = $ordersData['uid'];
		$orders_info = $ordersData['orders_info'];  //��¼�������ж�������Ϣ
		$db_transaction_set = array();  //���ڼ�¼�����Ѿ��ɹ��������db,����ͳһ����������ύ�ͻع�
		$ias_db = array();    //���ڼ�¼����ias��db����
		$is_in_somaster = array();  //���ڼ�¼�����Ƿ���so_master����

		//����ƴװ��ѯ���Ķ�������
		$ordersIdString = "''";
		foreach ($orders_info as $order)
		{
			$ordersIdString .= ",'{$order['order_char_id']}'";
		}

		//������ERP�ж�����״��
		$init_sql = "SET ANSI_NULLS ON
				 SET ANSI_PADDING ON
				 SET ANSI_WARNINGS ON
				 SET ARITHABORT ON
				 SET CONCAT_NULL_YIELDS_NULL ON
				 SET QUOTED_IDENTIFIER ON
				 SET NUMERIC_ROUNDABORT OFF";

		global $_OrderState;
		global $_StockToStation;
		global $_SO_Site;
		foreach($orders_info as $info)
		{
			// �����վ���Ѿ��л����˿ͷ�ϵͳ����ʹ���µĿͷ���
			if(in_array($_StockToStation[$info['stockNo']], $_SO_Site))
			{
				$db_tmp = ToolUtil::getMSDBObj("SO");
			}
			else
			{
				$db_tmp = ToolUtil::getMSDBObj('ERP_' . $_StockToStation[$info['stockNo']]);
			}
			
			if(false === $db_tmp)
			{
				self::$errCode = ToolUtil::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "query ms sql faild " . ToolUtil::$errMsg;
				return false;
			}
			$ias_db[$info['order_char_id']] = $db_tmp;

			$ret_sql = $db_tmp->execSql($init_sql);
			if(false === $ret_sql)
			{
				self::$errCode = $db_tmp->errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "query ms sql faild " . $db_tmp->errMsg;
				return false;
			}

			$sql = "SELECT Status from SO_Master where SOID='{$info['order_char_id']}'";
			$erpOrder = $db_tmp->getRows($sql);
			if(false === $erpOrder)
			{
				self::$errCode = $db_tmp->errCode;
				self::$errMsg = '��ѯERP����ʧ��,line:' . __LINE__ . ",errMsg:" . $db_tmp->errMsg;
				return false;
			}

			$inSoMaster = false;
			if(count($erpOrder) > 0)
			{
				$inSoMaster = true;
				if(!($info['status'] == $_OrderState['Origin']['value'] || $info['status'] == $_OrderState['WaitingPay']['value'] || $info['status'] == $_OrderState['WaitingManagerAudit']['value']))
				{
					self::$errCode = 4001;
					self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . "{$info['order_char_id']} (status is not origin) can not canceled";
					return false;
				}
			}
			$is_in_somaster[$info['order_char_id']] = $inSoMaster;
		}


		$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
		$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);

		$sql = "begin transaction";
		$ret = $orderDb->execSql($sql);
		if(false === $ret)
		{
			self::$errCode = 4002;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '����orderdb����ʧ��';
			return false;
		}
		$db_transaction_set[] = $orderDb;


		//������վ�˶���״̬Ϊ�û�ȡ��״̬
		$now = time();
		$sql = "update t_orders_{$db_tab_index['table']} set status = {$_OrderState['CustomerCancel']['value']},update_time = {$now}
				where uid=$uid and order_char_id in ($ordersIdString) and
					  status in ({$_OrderState['Origin']['value']},{$_OrderState['WaitingPay']['value']},{$_OrderState['WaitingManagerAudit']['value']})";
		$ret = $orderDb->execSql($sql);
		if(false === $ret || $orderDb->getAffectedRows() != count($orders_info))
		{
			self::$errCode = $orderDb->errCode;
			self::$errMsg = 'ȡ��ǰ̨����ʧ��,line:' . __LINE__ . ",errMsg:" . $orderDb->errMsg;
			$sql = "rollback";
			foreach($db_transaction_set as $db)
			{
				$db->execSql($sql);
			}
			return false;
		}


		//����ERP���м���Լ�so_master���еĶ���״̬Ϊ�û�ȡ��״̬
		foreach($orders_info as $order)
		{
			$ias_db_temp = $ias_db[$order['order_char_id']];
			$sql = "begin transaction";
			$ret = $ias_db_temp->execSql($sql);
			if(false === $ret)
			{
				self::$errCode = $ias_db_temp->errCode;
				self::$errMsg = '����ias_db����ʧ��,line:' . __LINE__ . ",errMsg:" . $ias_db_temp->errMsg;
				foreach($db_transaction_set as $db)
				{
					$db->execSql($sql);
				}
				return false;
			}
			$db_transaction_set[] = $ias_db_temp;

			//ȡ���м��
			$sql = "update t_orders set Status={$_OrderState['CustomerCancel']['value']} where order_char_id='{$order['order_char_id']}' ";
			$ret = $ias_db_temp->execSql($sql);
			if (false === $ret)
			{
				self::$errCode = $ias_db_temp->errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_id[{$order['order_char_id']}] (erp order status can not updated) can not canceled " .  $ias_db_temp->errMsg;
				$sql = "rollback";
				foreach($db_transaction_set as $db)
				{
					$db->execSql($sql);
				}
				return false;
			}

			//ȡ��so_master����ѯERP��So_Master������״̬�����Ƿ���ȡ��
			if(true === $is_in_somaster[$order['order_char_id']])
			{
				$sql = "update SO_Master set Status={$_OrderState['CustomerCancel']['value']} where SOID='{$order['order_char_id']}'
						and status in ({$_OrderState['Origin']['value']},{$_OrderState['WaitingPay']['value']},{$_OrderState['WaitingManagerAudit']['value']})";
				$ret = $ias_db_temp->execSql($sql);
				if (false === $ret || 1 != $ias_db_temp->getAffectedRows())
				{
					self::$errCode = 4003;
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_id[{$order['order_char_id']}] (erp order status can not updated) can not canceled " . $ias_db_temp->errMsg;
					$sql = "rollback";
					foreach($db_transaction_set as $db)
					{
						$db->execSql($sql);
					}
					return false;
				}
			}
		}
		///��������ӦIAS�Ķ���״̬


		///�ָ����
		$timeNow = date('Y-m-d H:i:s');
		$inventoryDB = ToolUtil::getMSDBObj('Inventory_Manager');
		if (false === $inventoryDB)
		{
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "����Inventory_Manager���ݿ����" . ToolUtil::$errMsg;
			$sql = "rollback";
			foreach($db_transaction_set as $db)
			{
				$db->execSql($sql);
			}
			return false;
		}

		$sql = "begin transaction";
		$ret = $inventoryDB->execSql($sql);
		if (false === $ret)
		{
			self::$errCode = $inventoryDB->errCode;
			self::$errMsg = '����inventoryDB����ʧ��,line:' . __LINE__ . ",errMsg:" . $inventoryDB->errMsg;
			$sql = "rollback";
			foreach($db_transaction_set as $db)
			{
				$db->execSql($sql);
			}
			return false;
		}
		$db_transaction_set[] = $inventoryDB;


		//������ˮ�Ĵ���λ����ʼ update ֮ǰ����һ�� Inventory_Stock
		$_local_ip = ToolUtil::getLocalIp(0);
		$_local_ip = explode('.', $_local_ip);
		$_inserter = empty($_local_ip[3]) ? 7 : intval($_local_ip[3]);
        //���˫д S Sheldonshi
        $inventorysAllData = array();
        //���˫д E Sheldonshi
		foreach($orders_info as $order)
		{
			$order_id_int = $order['order_id'];
			foreach($order['product_info'] as $oit)
			{
				$buy_num_positive = $oit['buy_num'];
				$buy_num_negative = $oit['buy_num'] * (-1);

				//������ⵥ����Ҫ��ȥ�������������������������ⵥ
				if ($oit['use_virtual_stock'] == 1)
				{
					$sql = "update t_order_virtual_stock_{$db_tab_index['table']} set status=" . VIRTUAL_STOCK_STATUS_CACEL . ",update_time=" . time() . " where order_char_id='{$order['order_char_id']}' AND product_id={$oit['product_id']}";
					$ret = $orderDb->execSql($sql);
					if (false === $ret)
					{
						self::$errCode = $orderDb->errCode;
						self::$errMsg = "������ⵥʧ�ܣ�line��" . __LINE__ . ",errMsg" . $orderDb->errMsg;
						$sql = "rollback";
						foreach($db_transaction_set as $db)
						{
							$db->execSql($sql);
						}
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
				if (false === $ret)
				{
					self::$errCode = $inventoryDB->errCode;
					self::$errMsg = "��������ʧ�ܣ�line��" . __LINE__ . ",errMsg" . $inventoryDB->errMsg;
					$sql = "rollback";
					foreach($db_transaction_set as $db)
					{
						$db->execSql($sql);
					}
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
		}
		///�����ظ����


		///�����ƻ�����
		foreach($orders_info as $order)
		{
			if(ICustomPhone::isCustomPhoneOrder($order))
			{
				// ����Ƕ��ƻ����������ݶ������ҵ���Լ�еĺ���
				$contractDb = ToolUtil::getMSDBObj('ICSON_CORE');
				if ($contractDb === false)
				{
					self::$errMsg = "getMSDBObj Error, line" . __LINE__ . "," . self::$errMsg . "\n";
					self::Log(self::$errMsg);
					$sql = "rollback";
					foreach($db_transaction_set as $db)
					{
						$db->execSql($sql);
					}
					return false;
				}

				$sql = "select num from t_cp_contract_info where order_char_id=" . $order['order_char_id'];
				$num = $contractDb->getRows($sql);
				if ($num === false || count($num) == 0)
				{
					self::$errMsg = "getMSDBObj Error, line" . __LINE__ . "," . $contractDb->errMsg . "\n";
					self::Log(self::$errMsg);
					$sql = "rollback";
					foreach($db_transaction_set as $db)
					{
						$db->execSql($sql);
					}
					return false;
				}

				$num = $num[0]['num'];
				// ��󷵻������״̬
				$ret = ICustomPhone::returnNum($num);
				if (false === $ret)
				{
					self::$errMsg = "returnNum Error, line" . __LINE__ . "," . ICustomPhone::$errMsg . "\n";
					self::Log(self::$errMsg);
					$sql = "rollback";
					foreach($db_transaction_set as $db)
					{
						$db->execSql($sql);
					}
					return false;
				}
			}
		}
		///�����������ƻ�����


		///��ʼ�������
		foreach($orders_info as $order)
		{
			//���ʹ���˻��֣���������
			if($order['point_pay'] > 0)
			{
				//$userInfo = IUsersTTC::get($uid, array(), array('valid_point'));
                $userInfo = IUser::getUserInfo($uid);
				if (false === $userInfo)
				{
					self::$errCode = IUser::$errCode;
					self::$errMsg = "�û�ʹ���˻��֣�IUser::getUserInfoʧ�ܣ�line:" . __LINE__ . ",errMsg:" . IUser::$errMsg;
					$sql = "rollback";
					foreach($db_transaction_set as $db)
					{
						$db->execSql($sql);
					}
					return false;
				}
                /*
				if (1 != count($userInfo))
				{
					self::$errCode = 934;
					self::$errMsg = "no user($uid) exist,line:" . __LINE__;
					$sql = "rollback";
					foreach($db_transaction_set as $db)
					{
						$db->execSql($sql);
					}
					return false;
				}
                */
				//�ӳٷ������֣�����һ����Ҫ�����Ķ�����¼
				$backData['uid'] = $uid;
				$backData['order_id'] = $order['order_id'];
				$backData['type'] = ERROR_CANCEL_ORDER;
				$backData['cash_point'] = $order['cash_point'];
				$backData['promotion_point'] = $order['promotion_point'];
				$ret_insert = IScore::insertBackData($backData);

				if (false === $ret_insert)
				{
					$sql = "rollback";
					foreach($db_transaction_set as $db)
					{
						$db->execSql($sql);
					}
					return false;
				}
			}
		}
		///�������ִ���


		///�ύ����
		$sql = "commit";
		foreach($db_transaction_set as $db)
		{
			$db->execSql($sql);
		}


		///��ʼ�ύ�����ı�Ҫ����
		$ordersToSub = array();
		foreach($orders_info as $order)
		{
			//ȡ�������ɹ�����¼��-1
			$ordersToSub[$order['order_char_id']] = $order;


			//����棬�޸�TTC���ݣ�ʧ�ܲ����أ���Ϊͬ���ű�Ҳ��ͬ�����
			foreach($order['product_info'] as $oit)
			{
				$info = IInventoryStockTTC::get($oit['product_id'], array('stock_id' => $order['stockNo']));
				//�ж��Ƿ������
				if ($oit['use_virtual_stock'] == 1)
				{
					$ret = IInventoryStockTTC::update(array('product_id' => $oit['product_id'], 'num_available' => $info[0]['num_available'] + $oit['buy_num'], 'virtual_num' => $info[0]['virtual_num'] - $oit['buy_num']), array('stock_id' => $order['stockNo']));
					if ($ret === false)
					{
						EL_Flow::getInstance('orderCancel')->append("increment IInventoryStockTTC failed,product_id:{$oit['product_id']},stockNo:{$order['stockNo']},num:{$oit['buy_num']}");
					}
				}
				else
				{
					$ret = IInventoryStockTTC::update(array('product_id' => $oit['product_id'], 'num_available' => $info[0]['num_available'] + $oit['buy_num']), array('stock_id' => $order['stockNo']));
					if ($ret === false)
					{
						EL_Flow::getInstance('orderCancel')->append("increment IInventoryStockTTC failed,product_id:{$oit['product_id']},stockNo:{$order['stockNo']},num:{$oit['buy_num']}");
					}
				}
			}


			//���������Ż�ȯ��ȡ���Ż�ȯ��¼����ȯ��¼,֮��ĳ�������뵽������
			if(isset($order['single_promotion_info']) && $order['single_promotion_info'] != '')
			{
				$filter = array(
					'order_id' => $order['order_char_id'],
				);
				$ret = IPromotionUserRuleMapTTC::remove($uid, $filter);
				if(false === $ret)
				{
					$ret = IPromotionUserRuleMapTTC::remove($uid, $filter);
					if(false === $ret)
					{
						EL_Flow::getInstance('promotion')->append("IPromotionUserRuleMapTTC ERROR,uid:{$uid},order_id:{$order['order_char_id']}:" . IPromotionUserRuleMapTTC::$errMsg);
					}
				}
			}
		}
		IShippingTime::orderRecording($ordersToSub, -1);
		///�����ύ�����ı�Ҫ����
        //���˫д S sheldonshi
        IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
        //���˫д E sheldonshi
		return true;
	}
}

