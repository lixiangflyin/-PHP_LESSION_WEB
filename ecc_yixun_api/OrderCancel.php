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
	 * @desc            合并取消订单，一次性可以取消1个或者多个订单（多个订单必须是父子订单）
	 * @param $uid      用户的编号id
	 * @param $orders   需要取消的订单id
	 *                  1、非数组，该值为订单号
	 *                  2、数组，结构
	 *                     array(
	 *                          'p_order_id'=> 父订单id,
	 *                          's_order_id'=> array(子订单号_1,子订单号_2);
	 *                     )
	 * @return bool
	 * @comment         合并取消的错误码都是3000以内的，3099以下都是属于参数或者系统错误的问题，提示语是一类
	 */
	public static function setPOrderCanceled($uid, $orders)
	{
		///检查传入的参数是否存在，对参数做预处理
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

		$order_ids = array();   //记录需要取消的订单号
		$p_order_id = null;
		$s_orders_id = null;
		if (!is_array($orders)) //表示取消的单个订单
		{
			$order_ids[] = $orders;
		}
		else
		{
			$order_ids = $orders['s_order_id'];
			$s_orders_id = $orders['s_order_id']; //记录所有的子订单id
			$order_ids[] = $orders['p_order_id'];
			$p_order_id = $orders['p_order_id'];  //记录父订单id
		}
		///结束对传入的参数的预处理


		///一次性获取多个订单的基本信息，并用于取消订单
		$orders_info = IOrder::getSomeOrders($uid, $order_ids);


		///开始根据订单信息检查传入的订单是否正确
		//返回订单信息的数量与需要查询的订单数量不一致时，表示订单有异常
		if (count($order_ids) != count($orders_info))
		{
			//需要找出哪几个订单没有订单信息
			self::$errCode = 3003;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "some order no exsit";
			return false;
		}

		//如果是合并取消，核查父订单，子订单的关系是否正确
		if (!empty($p_order_id))
		{
			//核查子订单数量
			if ($orders_info[$p_order_id]['subOrderNum'] != count($s_orders_id))
			{
				self::$errCode = 3004;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "p_order_id($p_order_id)的子订单数量与提交的不一致";
				return false;
			}

			foreach ($s_orders_id as $sub)
			{
				if ($orders_info[$sub]['pOrderId'] != $p_order_id)
				{
					self::$errCode = 3005;
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "s_order_id($sub)的父订单号与提交的不一致";
					return false;
				}
			}
		}

		//检查订单当前的状态是否可以取消
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
		///结束根据订单信息检查传入的订单是否正确


		///开始操作数据库，执行取消订单的操作，该函数尽量只包含数据库的操作，不包含逻辑
		$ordersData['uid'] = $uid;
		$ordersData['orders_info'] = $orders_info;
		if (!empty($p_order_id)) //从订单信息表中将父订单删除掉
		{
			unset($ordersData['orders_info'][$p_order_id]);
		}
		$ret = self::doCancel($ordersData);
		///结束操作数据库

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
		$orders_info = $ordersData['orders_info'];  //记录所有所有订单的信息
		$db_transaction_set = array();  //用于记录所有已经成功起事务的db,用于统一控制事务的提交和回滚
		$ias_db = array();    //用于记录各个ias的db连接
		$is_in_somaster = array();  //用于记录订单是否在so_master表中

		//用于拼装查询语句的订单集合
		$ordersIdString = "''";
		foreach ($orders_info as $order)
		{
			$ordersIdString .= ",'{$order['order_char_id']}'";
		}

		//检查各个ERP中订单的状况
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
			// 如果该站点已经切换到了客服系统，则使用新的客服库
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
				self::$errMsg = '查询ERP订单失败,line:' . __LINE__ . ",errMsg:" . $db_tmp->errMsg;
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
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '开启orderdb事务失败';
			return false;
		}
		$db_transaction_set[] = $orderDb;


		//设置网站端订单状态为用户取消状态
		$now = time();
		$sql = "update t_orders_{$db_tab_index['table']} set status = {$_OrderState['CustomerCancel']['value']},update_time = {$now}
				where uid=$uid and order_char_id in ($ordersIdString) and
					  status in ({$_OrderState['Origin']['value']},{$_OrderState['WaitingPay']['value']},{$_OrderState['WaitingManagerAudit']['value']})";
		$ret = $orderDb->execSql($sql);
		if(false === $ret || $orderDb->getAffectedRows() != count($orders_info))
		{
			self::$errCode = $orderDb->errCode;
			self::$errMsg = '取消前台订单失败,line:' . __LINE__ . ",errMsg:" . $orderDb->errMsg;
			$sql = "rollback";
			foreach($db_transaction_set as $db)
			{
				$db->execSql($sql);
			}
			return false;
		}


		//设置ERP的中间表，以及so_master表中的订单状态为用户取消状态
		foreach($orders_info as $order)
		{
			$ias_db_temp = $ias_db[$order['order_char_id']];
			$sql = "begin transaction";
			$ret = $ias_db_temp->execSql($sql);
			if(false === $ret)
			{
				self::$errCode = $ias_db_temp->errCode;
				self::$errMsg = '开启ias_db事务失败,line:' . __LINE__ . ",errMsg:" . $ias_db_temp->errMsg;
				foreach($db_transaction_set as $db)
				{
					$db->execSql($sql);
				}
				return false;
			}
			$db_transaction_set[] = $ias_db_temp;

			//取消中间表
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

			//取消so_master表，查询ERP中So_Master订单的状态，看是否能取消
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
		///结束：对应IAS的订单状态


		///恢复库存
		$timeNow = date('Y-m-d H:i:s');
		$inventoryDB = ToolUtil::getMSDBObj('Inventory_Manager');
		if (false === $inventoryDB)
		{
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "连接Inventory_Manager数据库出错" . ToolUtil::$errMsg;
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
			self::$errMsg = '开启inventoryDB事务失败,line:' . __LINE__ . ",errMsg:" . $inventoryDB->errMsg;
			$sql = "rollback";
			foreach($db_transaction_set as $db)
			{
				$db->execSql($sql);
			}
			return false;
		}
		$db_transaction_set[] = $inventoryDB;


		//库存和流水的错误定位，开始 update 之前查找一次 Inventory_Stock
		$_local_ip = ToolUtil::getLocalIp(0);
		$_local_ip = explode('.', $_local_ip);
		$_inserter = empty($_local_ip[3]) ? 7 : intval($_local_ip[3]);
        //库存双写 S Sheldonshi
        $inventorysAllData = array();
        //库存双写 E Sheldonshi
		foreach($orders_info as $order)
		{
			$order_id_int = $order['order_id'];
			foreach($order['product_info'] as $oit)
			{
				$buy_num_positive = $oit['buy_num'];
				$buy_num_negative = $oit['buy_num'] * (-1);

				//建了虚库单，需要减去订购数量，虚库数量，作废虚库单
				if ($oit['use_virtual_stock'] == 1)
				{
					$sql = "update t_order_virtual_stock_{$db_tab_index['table']} set status=" . VIRTUAL_STOCK_STATUS_CACEL . ",update_time=" . time() . " where order_char_id='{$order['order_char_id']}' AND product_id={$oit['product_id']}";
					$ret = $orderDb->execSql($sql);
					if (false === $ret)
					{
						self::$errCode = $orderDb->errCode;
						self::$errMsg = "更新虚库单失败，line：" . __LINE__ . ",errMsg" . $orderDb->errMsg;
						$sql = "rollback";
						foreach($db_transaction_set as $db)
						{
							$db->execSql($sql);
						}
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
				if (false === $ret)
				{
					self::$errCode = $inventoryDB->errCode;
					self::$errMsg = "更新虚库存失败，line：" . __LINE__ . ",errMsg" . $inventoryDB->errMsg;
					$sql = "rollback";
					foreach($db_transaction_set as $db)
					{
						$db->execSql($sql);
					}
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
		}
		///结束回复库存


		///处理定制机订单
		foreach($orders_info as $order)
		{
			if(ICustomPhone::isCustomPhoneOrder($order))
			{
				// 如果是定制机订单，根据订单号找到合约中的号码
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
				// 最后返还号码的状态
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
		///结束：处理定制机订单


		///开始处理积分
		foreach($orders_info as $order)
		{
			//如果使用了积分，返还积分
			if($order['point_pay'] > 0)
			{
				//$userInfo = IUsersTTC::get($uid, array(), array('valid_point'));
                $userInfo = IUser::getUserInfo($uid);
				if (false === $userInfo)
				{
					self::$errCode = IUser::$errCode;
					self::$errMsg = "用户使用了积分，IUser::getUserInfo失败，line:" . __LINE__ . ",errMsg:" . IUser::$errMsg;
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
				//延迟返还积分，插入一条需要返还的订单记录
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
		///结束积分处理


		///提交事务
		$sql = "commit";
		foreach($db_transaction_set as $db)
		{
			$db->execSql($sql);
		}


		///开始提交事务后的必要处理
		$ordersToSub = array();
		foreach($orders_info as $order)
		{
			//取消订单成功，记录数-1
			$ordersToSub[$order['order_char_id']] = $order;


			//还库存，修改TTC数据，失败不返回，因为同步脚本也会同步库存
			foreach($order['product_info'] as $oit)
			{
				$info = IInventoryStockTTC::get($oit['product_id'], array('stock_id' => $order['stockNo']));
				//判断是否是虚库
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


			//如果获得了优惠券，取消优惠券记录、发券记录,之后改成事务加入到上面中
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
		///结束提交事务后的必要处理
        //库存双写 S sheldonshi
        IShoppingProcess::setUnlockInventory($uid, $inventorysAllData);
        //库存双写 E sheldonshi
		return true;
	}
}

