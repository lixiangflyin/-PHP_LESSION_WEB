<?php
require_once(PHPLIB_ROOT . 'inc/ship.inc.php');
require_once(PHPLIB_ROOT . 'inc/installment.inc.php');

/*
	-2000:订单参数为空
	-2001:收货人为空
*/

class IInstallmentOrder
{
	public static $errCode = 0;
	public static $errMsg = '';

	public static function newOrderId()
	{
		//获取一个新id
		$newId = IIdGenerator::getNewId('so_sequence');
		if (false === $newId || $newId <= 0) {
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return  false;
		}

		return $newId;
	}

	/*
	输入
	array
	(
		uid=>xx,                     用户编号
		source=>xxx,                 订单来源
		premium_cost=>xxx,           保价费用
		shipping_type=>xxxx,         运送方式
		pay_type=>xxxx,              支付方式
		prcd_cost=>xxxx,             手续费用
		couponCode=>xxxx,           优惠卷编码
		coupon_amt=>xxxx,            优惠卷面值
		point=>xxxx,             使用积分数量
		receiver=>xxxx,              收货人
		receiver_tel=>xxxx,          收货人电话
		receiver_mobile=>xxxx,       收货人手机
		receiver_addr_id=>xxxx,      收获地区id
		receiver_zip=>xxxx,          收获地址邮政编码
		receiver_addr=>xxxx,         详细收获地址
		expect_dly_date=>xxx,        预期送货日期
		expect_dly_time_span=>xxxx,  预期送货时段
		comment=>xxxx,               订单备注
		list=>array(                 订单商品列表
		product_id=>xxxx,            商品id
		wh_id=>xxxx,                 仓库id
		expect_num=>xxx,		     预期购买数量
		)
	)
	*/
	public static function order($newOrder, $wh_id=1)
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
		$badUser = array(6922062);
		if (in_array($newOrder['uid'] , $badUser)) {
			return array('errCode'=>-1, 'errMsg'=>"对不起，您的帐号异常，暂不能下单，请联系客服");
		}
		//检查购物车是否为空
		if (!isset($newOrder['items']) || 1 != count($newOrder['items'])) {
			self::$errCode = -2020;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "items in shopping cart is not correct";
			return false;
		}

		$limitState = IShippingTime::getOrderLimitState($wh_id);
		if (false === $limitState){
			self::$errCode = IShippingTime::$errCode;
			self::$errMsg = IShippingTime::$errMsg;
			return false;
		}
		if ($limitState['day_limit'] == 1) {
			return array('errCode'=>-1, 'errMsg'=>'对不起，今日订单已经超过最大数量，请明天再下订单');
		}

		//参数收货地址
		if (false === self::checkReceiverAddr($newOrder)) {
			return  false;
		}

		//检查运送方式
		if (false === self::checkShippingType($newOrder, $wh_id)) {
			return false;
		}

		//检查支付方式
		if (false === self::checkPayType($newOrder, $wh_id)) {
			return false;
		}

		//检查发票
		if (false === self::checkInvoice($newOrder)) {
			return false;
		}

		return self::checkShippingCart($newOrder, $wh_id);

	}


	private static function checkShippingCart(&$newOrder, $wh_id = 1)
	{
		$newOrder = IOrder51buy::transXSSContent($newOrder);

		if (isset($newOrder['comment']) && strlen($newOrder['comment']) > 800) 
		{
			return array('errCode'=>-10, 'errMsg'=>"您填写的订单备注过长，请返回修改！");
		}
		
		global $_InstallmentBank;
		if (!isset($_InstallmentBank[$newOrder['bankIndex']]) || !isset($_InstallmentBank[$newOrder['bankIndex']]['installments'][$newOrder['installment_num']])) {
			return  array('errCode'=>-1, 'errMsg'=>"您所选择的分期付款银行或者期数不合法");
		}
		$bank = $_InstallmentBank[$newOrder['bankIndex']]['bank'];
		$installment = &$_InstallmentBank[$newOrder['bankIndex']]['installments'][$newOrder['installment_num']];
		//拉取购物车中的商品的赠品&配件
		$product_in_cart = array();
		if (count($newOrder['items']) == 0) {
			return  array('errCode'=>-10, 'errMsg'=>"您购物车中没有任何商品");
		}
		foreach ($newOrder['items'] as $item)
		{
			$product_in_cart[] = $item['product_id'];
		}

		//拉取购物车中主商品 & 赠品 & 配件的基本信息
		$product_base_info = IProduct::getProductsInfo($product_in_cart, $wh_id, true, true);
		if (false === $product_base_info) {
			self::$errCode = IProduct::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProduct failed]' . IProduct::$errMsg;
			return false;
		}

		//检查前台传入的商品列表  与  购物车中商品列表是否一致 , 同时检查商品，赠品，组件的状态，禁运类型
		$restricted_trans_type = array();
		$shoppingProduct = array();
		$productInShoppingCart = array();
		//同时检查能否模糊开票，开增值发票
		$isCanVATInvoice = true;
		$c3ids = array();

		$hasCellPhone = false;
		$psystock = 0;

		foreach ($newOrder['items'] as $orderItem)
		{
			if (!isset($product_base_info[$orderItem['product_id']])) {
					 return  array('errCode'=>-2, 'errMsg'=>"购物车中商品" . $product_base_info[$item['product_id']]['name'] . "暂不销售，请返回购物车删除");
				}//商品状态不合法
			else if ($product_base_info[$orderItem['product_id']]['status'] != PRODUCT_STATUS_NORMAL) {
					return  array('errCode'=>-3, 'errMsg'=>"购物车中商品" . $product_base_info[$item['product_id']]['name'] . "暂不销售，请返回购物车删除");
			}
			else
			{
				if (311 == $product_base_info[$orderItem['product_id']]['c3_ids']) {
					$hasCellPhone = true;
				}else {
				}
	
				$limitMin = INSTALLMENT_LIMIT_PRICE_MIN;
				$limitMax = INSTALLMENT_LIMIT_PRICE_MAX;
				if($product_base_info[$orderItem['product_id']]['price'] < $limitMin || $product_base_info[$orderItem['product_id']]['price'] > $limitMax)
				{
					return  array('errCode'=>-22, 'errMsg'=>"商品分期付款价格最低为{$limitMin}元，最高为{$limitMax}元，商品" . $product_base_info[$orderItem['product_id']]['name'] . "不符合，请返回购物车删除");
				}
	
				$shoppingProduct[$orderItem['product_id']]['product_id'] =  $orderItem['product_id'];
				@$shoppingProduct[$orderItem['product_id']]['buy_count'] +=  $orderItem['num'];
				$shoppingProduct[$orderItem['product_id']]['wh_id'] =  $wh_id;
				$shoppingProduct[$orderItem['product_id']]['type'] =  SHOPPING_CART_PRODUCT_TYPE_NORMAL;
				$restricted_trans_type[$product_base_info[$orderItem['product_id']]['restricted_trans_type']][] = $orderItem['product_id'];
				if ($product_base_info[$orderItem['product_id']]['flag'] & CAN_VAT_INVOICE == 0) {
					$isCanVATInvoice = false;
				}
				$c3ids[] = $product_base_info[$orderItem['product_id']]['c3_ids'];
				$psystock = $product_base_info[$orderItem['product_id']]['psystock'];
				$productInShoppingCart[] = $orderItem['product_id'];
			}
			//查看该商品附送的赠品&配件是否匹配
			foreach ($orderItem['gift'] as $g_p_id)
			{
				if (!isset($product_base_info[$orderItem['product_id']]['gifts'][$g_p_id])) {
					return  array('errCode'=>-5, 'errMsg'=>"购物车中赠品/组件" . $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['name']  . "暂时无货，请返回购物车删除");
				}
				else if ($product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['status'] == PRODUCT_STATUS_NORMAL) 
				{
					//商品状态不合法
					return  array('errCode'=>-6, 'errMsg'=>"购物车中赠品/组件" . $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['name'] . "暂时无货，请返回购物车删除");
				}
				else
				{
					$shoppingProduct[$g_p_id]['product_id'] =  $g_p_id;
					@$shoppingProduct[$g_p_id]['buy_count'] +=  $orderItem['num'] * $product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['num'];
					$shoppingProduct[$g_p_id]['OTag'] =  '';
					$shoppingProduct[$g_p_id]['main_product_id'] = 0;
					$shoppingProduct[$g_p_id]['belongto_product_id'] = $orderItem['product_id'];
					if ($product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['type'] == 1) 
					{
						$shoppingProduct[$g_p_id]['type'] = SHOPPING_CART_PRODUCT_TYPE_ZUJIAN ;
					}
					else
					{
						$shoppingProduct[$g_p_id]['type'] = SHOPPING_CART_PRODUCT_TYPE_GIFT ;
					}
					$restricted_trans_type[$product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['restricted_trans_type']][] = $g_p_id;// = $product_base_info[$gift['gift_id']]['restricted_trans_type'];
					$exist = true;
					$productInShoppingCart[] = $g_p_id;
				}				
			}
		}

		//检查发票类型是否正确
		if ($isCanVATInvoice === false && $newOrder['invoiceType'] == INVOICE_TYPE_VAT) {
			return array('errCode'=>-20, 'errMsg'=>'您的订单中有商品不能开增值税发票');
		}

		$invoinceContent = array('商品明细');
		if (($wh_id ==1 || $wh_id == 2001 )&& $newOrder['invoiceContent'] != "商品明细" && count($c3ids) > 0) {
			$isCanFuzzyInvoice = true;

			$c3Info = ICategoryTTC::gets($c3ids, array('level'=>3, 'status'=>0), array('parent_id','flag'));
			if (is_array($c3Info)) {
				$c2ids = array();
				foreach ($c3Info as $c3)
				{
					if (($c3['flag'] & FUZZY_INVOICE) != FUZZY_INVOICE) {  //不可以模糊开票
						$isCanFuzzyInvoice = false;
						break;
					}
					$c2ids[] = $c3['parent_id'];
				}
				if (true == $isCanFuzzyInvoice )
				{
					$c2ids = array_unique($c2ids);
					$c2Info = ICategoryTTC::gets($c2ids, array('level'=>2, 'status'=>0), array('parent_id'));
					if (is_array($c2Info)) {
						global $_FuzzyInvoiceConf;
						foreach ($c2Info as $c2)
						{
							if (isset($_FuzzyInvoiceConf[intval($c2['parent_id'])])) {
								$invoinceContent = array_merge($invoinceContent, $_FuzzyInvoiceConf[intval($c2['parent_id'])]);
							}
						}
					}
				}
			}
			if (false === $isCanFuzzyInvoice) {
				$invoinceContent = array('商品明细');
			}
		}
		$invoinceContent = array_unique($invoinceContent);
		if($newOrder['isVat'] == 1)
		{
			if (!in_array($newOrder['invoiceContent'], $invoinceContent)) {
				return array('errCode'=>-21, 'errMsg'=>'您提交发票内容不合法');
			}
		}

		//删除禁运类型0（不限运）
		unset($restricted_trans_type[0]);
		unset($gifts);
		//检查前台传入的购物车内容  与 后台购物车内容  一致完毕


		//检查限运规则（放在一切通过之后检查，因为后续检查可能会要求用户返回购物车删除一些商品，导致商品减少）
		$limitedProduct = array();
		foreach ($shoppingProduct as $item)
		{
			if ($item['type'] != SHOPPING_CART_PRODUCT_TYPE_NORMAL) {
				continue;
			}
			$exist = isset($product_base_info[$item['product_id']])? true : false;
			if (false === $exist) {
				return  array('errCode'=>-9, 'errMsg'=>"购物车中商品" . $product_base_info[$item['product_id']]['name'] . "暂不销售，请返回购物车删除");
			}
			$p = $product_base_info[$item['product_id']];

			//该商品限购
			if ($p['num_limit'] > 0 && $p['num_limit'] < 999) {
				if ($p['num_limit'] < $item['buy_count']) {
					return  array('errCode'=>-8, 'errMsg'=>"购物车中商品" . $product_base_info[$item['product_id']]['name'] . "超过限购数量" . $p['num_limit']);
				}
				$limitedProduct[] = $p['product_id'];
			}
		}

		$db_tab_index = ToolUtil::getMSDBTableIndex($newOrder['uid'],'ICSON_ORDER_CORE');
		//如果购物车中商品有限购商品，则查询该用户当天的订单
		//这里部署外网需要修改分库分表的问题
		global $_OrderState;
		if (!empty($limitedProduct)) {
			$timestamp = mktime(0,0,0,date('m'), date('d'), date('Y') );			
			$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
			
			$sql = "select product_id, sum(buy_num) as buy_num from
			t_order_items_{$db_tab_index['table']} ot,
			t_orders_{$db_tab_index['table']} o
			where o.order_char_id=ot.order_char_id".
			" and o.status<>". $_OrderState['ManagerCancel']['value'] .
			" and o.status<>". $_OrderState['CustomerCancel']['value'].
			" and o.status<>". $_OrderState['EmployeeCancel']['value']." and ot.uid=" . $newOrder['uid'].  " and create_time > " . $timestamp .
			" and product_id in(" . implode(',', $limitedProduct) . ") group by product_id";

			$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
			if (empty($orderDb)) {
				self::$errCode = Config::$errCode;
				self::$errMsg = Config::$errMsg;
				return  false;
			}
			$userOrder = $orderDb->getRows($sql);
			if (false === $userOrder) {
				self::$errCode = $orderDb->errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query order db failed]' . $orderDb->errMsg;
				return false;
			}

			if (!empty($userOrder)) {
				foreach ($userOrder as $order)
				{
					if ($order['buy_num'] >= $product_base_info[$order['product_id']]['num_limit']) {
						return  array('errCode'=>-11, 'errMsg'=>"购物车中商品" . $product_base_info[$order['product_id']]['name'] . "是限购商品，您今日购买数量已经超过限购数量");
					}
					else if ($order['buy_num'] + $shoppingProduct[$order['product_id']]['buy_count'] > $product_base_info[$order['product_id']]['num_limit']) {
						return  array('errCode'=>-12, 'errMsg'=>"购物车中商品" . $product_base_info[$order['product_id']]['name'] .
						 "是限购商品，您今日还能购买" . ($product_base_info[$order['product_id']]['num_limit'] - $order['buy_num']) . "个" );
					}
				}
			}
		}
		//检查限购完毕

		
		//开始检查库存
		$msSQL = ToolUtil::getMSDBObj('Inventory_Manager');
		if (empty($msSQL)) {
			self::$errCode = Config::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "query ms sql faild " . Config::$errMsg;
			return false;
		}


		$sql = "select  SysNo, ProductSysNo, StockSysNo, AvailableQty, VirtualQty, OrderQty from Inventory_Stock where ProductSysNo in (" . implode(",", $productInShoppingCart) . ")";
		$sqlforlog = $sql;
		$productStocks = $msSQL->getRows($sql);
		if (false === $productStocks) {
			self::$errCode = $msSQL->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "query ms sql faild " . $msSQL->errMsg;
			return false;
		}

		$giftLackOfStock = array();
		$lackGiftAndIgnore = false;
		foreach ($shoppingProduct as $kk => $sp)
		{
			$exist = false;
			foreach ($productStocks as $pstock)
			{
				if ($sp['product_id'] == $pstock['ProductSysNo'] && $psystock == $pstock['StockSysNo']) {
					$exist = true;
					if (($pstock['AvailableQty'] + $pstock['VirtualQty'] <= 0) && $sp['type'] != SHOPPING_CART_PRODUCT_TYPE_GIFT) {
						IInventoryStockTTC::update(array('product_id'=>$sp['product_id'], 'num_available'=>$pstock['AvailableQty'], 'virtual_num'=> $pstock['VirtualQty']), array('sys_no'=>$pstock['SysNo']));
						return  array('errCode'=>-14, 'errMsg'=>'商品'.$product_base_info[$sp['product_id']]['name']."库存不足");
					}
					if ($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_GIFT)  //赠品
					{
						if ($pstock['AvailableQty']  + $pstock['VirtualQty'] < $sp['buy_count']) {
							IInventoryStockTTC::update(array('product_id'=>$sp['product_id'], 'num_available'=>$pstock['AvailableQty'], 'virtual_num'=> $pstock['VirtualQty']), array('sys_no'=>$pstock['SysNo']));
							if (!isset($newOrder['ingoreLackOfGift'])) {   //如果第一次提交订单
								$giftLackOfStock[$sp['product_id']] = $product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name'];
							}else if ($newOrder['ingoreLackOfGift'] == 1) {  //用户接受缺少礼品
								$shoppingProduct[$kk]['buy_count'] = $pstock['AvailableQty']  + $pstock['VirtualQty'];
								if ($sp['buy_count'] <= 0) {
									unset($shoppingProduct[$kk]);
								}
								$lackGiftAndIgnore = true;
							}else   //用户不接受，则拒绝下单
							{
								return  array('errCode'=>-13, 'errMsg'=>'赠品'.$product_base_info[$sp['product_id']]['name']."库存不足");
							}
						}
					}else if ($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_ZUJIAN) {
						if ($pstock['AvailableQty']  + $pstock['VirtualQty'] < $sp['buy_count']) {
							return  array('errCode'=>-15, 'errMsg'=>'组件'.$product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name']."库存不足,请联系客服");
						}
					}else//主商品
					{
						if ($pstock['AvailableQty'] < $sp['buy_count']){
							$containVirtual[$psystock] = true;
						}
							
						if ($pstock['AvailableQty'] + $pstock['VirtualQty'] < $sp['buy_count'] /*&&
								  $product_base_info[$sp['product_id']]['cost_price'] >=  $product_base_info[$sp['product_id']]['price']*/) {
								return  array('errCode'=>-15, 'errMsg'=>'商品'.$product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name']."库存不足");
						}
					}
					$product_base_info[$sp['product_id']]['AvailableQty'] = $pstock['AvailableQty'];
					$product_base_info[$sp['product_id']]['VirtualQty'] = $pstock['VirtualQty'];
					break;
				}
				if (false === true) {
					return  array('errCode'=>-16, 'errMsg'=>'商品'.$product_base_info[$sp['product_id']]['name']."暂不销售");
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
			return array('errCode'=>-100, 'errMsg'=>$errMsg);
		}

		// 添加提示
		if($lackGiftAndIgnore){
			$newOrder['comment'] .= "\n系统自动备注：用户已接受缺货赠品库存不足。";
		}
		//库存检查结束

		//检查禁运类型
		global $_District;
		$shipTypeNotAva = IInstallmentPreOrder::getForbidenShippingType($restricted_trans_type, $_District[$newOrder['receiveAddrId']]['province_id'], $_District[$newOrder['receiveAddrId']]['city_id'],$newOrder['receiveAddrId'],  $wh_id );
		if (false === $shipTypeNotAva) {
			self::$errCode = -2031;
			self::$errMsg='获取禁运类型->运送方式失败';
			return  false;
		}
		if (in_array($newOrder['shipType'], $shipTypeNotAva)) {
			return array('errCode'=>-17, 'errMsg'=>"购物车中有商品不支持您选择的运送方式");
		}
		//检查禁运类型失败

		//计算价格
		$orderPrice = 0;
		$totalWeight = 0;
		foreach ($shoppingProduct as $sp)
		{
			$totalWeight += $sp['buy_count'] * $product_base_info[$sp['product_id']]['weight'];
			if ($sp['type'] != SHOPPING_CART_PRODUCT_TYPE_NORMAL) {
				continue;
			}
			$orderPrice += $product_base_info[$sp['product_id']]['price'] * $sp['buy_count'];
		}
		if ($newOrder['payType'] == 1) {   //货到付款抹去分
			$orderPrice = 10 * floor($orderPrice / 10);
		}
		
		$limitMin = INSTALLMENT_LIMIT_PRICE_MIN;
		$limitMax = INSTALLMENT_LIMIT_PRICE_MAX;
		
		if($orderPrice < $limitMin)
		{
			return  array('errCode'=>-51, 'errMsg'=>"抱歉，商品分期付款订单金额最低不得低于" . $limitMin / 100 . "元，请您重新选择商品");
		}else if  ($orderPrice >$limitMax) {
			return  array('errCode'=>-51, 'errMsg'=>"抱歉，商品分期付款订单金额最高不得高于" . $limitMax / 100 . "元，请您重新选择商品");
		}

		if ($orderPrice < $installment['minprice'] || $orderPrice > $installment['maxprice']) {
			return  array('errCode'=>-51, 'errMsg'=>"您的订单金额为" . $orderPrice / 100 . "元，不能选择{$newOrder['installment_num']}期");
		}

		$cashToPay = $newOrder['installment_num'] * round($installment['rate'] * $orderPrice / $newOrder['installment_num']);
		$cashPerMonth = round($installment['rate'] * $orderPrice / $newOrder['installment_num']);
		if (bccomp($cashToPay, $newOrder['Price']) != 0) {
			self::$errCode = -2030;
			self::$errMsg='计算的订单价格与前台订单价格不一致';
			return  false;
		}
		//计算价格结束
		if ($newOrder['shippingPrice'] != 0) {
			self::$errCode = -2038;
			self::$errMsg='计算的订单运费价格与前台订单运费价格不一致';
			return  false;
		}
		
		
		global $_ArrivedLimitTime;
		$limitOrder = IShippingTime::getOrderLimitState($wh_id);
		//如果可以采用易迅快递，则获取送货时间
		if ( ICSON_DELIVERY == $newOrder['shipType'] ) 
		{				
			$icson_delivery_info = IShipping::getIcsonDeliveryInfoByRegion($newOrder['receiveAddrId'],$wh_id);
			if( false === $icson_delivery_info )
			{
				self::$errMsg = IShipping::$errMsg;
				return false;
			}
			
			if ($psystock == 5 && $wh_id == SITE_SH )  // 上海大件仓，按一日一送获取时间
				$icson_delivery_info['delivery_time'] = 1;
				
			// 发货仓库	
			$icson_delivery_info['stock_num'] = $psystock;
			$v = isset($containVirtual[$psystock]) ? $containVirtual[$psystock] : false;
			$timeAvaiable = IShippingTime::getShipTimeListIcson($icson_delivery_info, $wh_id, $newOrder['receiveAddrId'], $v, $limitOrder['am_limit'],  $limitOrder['day_limit']);
			
			if ( !is_array($timeAvaiable) || count($timeAvaiable) == 0) {
					self::$errCode = -987;
					self::$errMsg = "verify get expect dly date failed, Error:".IShippingTime::$errMsg;
					return false;
			}
			else
			{
				$timeAvaiable = $timeAvaiable[0];
				$date = $timeAvaiable['ship_date'];
				if ((strtotime($date) >  strtotime($newOrder['expectDate'])) ||
					( isset($timeAvaiable['time_span'] )
						&& (strtotime($date) == strtotime($newOrder['expectDate']))
						&& $timeAvaiable['time_span'] > $newOrder['expectSpan'])) {
					return  array('errCode'=>-11, 'errMsg'=>"您选择的期望配送时间不正确，请重新选择" );
				}
			}			
			
			//ixiuzeng添加
			//如果选择的是易迅快递，检查收获地址是否为限时达
			global $_ArrivedLimitTime;
			if(isset($_ArrivedLimitTime[$newOrder['receiveAddrId']]))
			{
				//如果是限时达，需要检查arrived_time_span字段是否有数据。
				if(!isset($newOrder['arrived_limit_time']) || empty($newOrder['arrived_limit_time']))
				{
					return array('errCode'=>-11, 'errMsg'=>"您没有选择的配送时间，请进行选择");
				}
			}	
		}		
		
		
		//开始下单，先起事务， 插入mysql， 扣 mssql 库存， commit事务or callback事务
		//获取新订单号
		$newId = self::newOrderId();
		if (false === $newId) {
			return  false;
		}
		$invoice_id = IIdGenerator::getNewId('so_valueadded_invoice_sequence');
		if (false === $invoice_id) {
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return  false;
		}
		$newOrderId = sprintf("%s%09d", "1", $newId % 1000000000);
		if (!isset($orderDb)) {
			$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
			if (empty($orderDb)) {
				self::$errCode = Config::$errCode;
				self::$errMsg = Config::$errMsg;
				return  false;
			}
		}
		$sql = "begin transaction";
		$ret = $orderDb->execSql($sql);
		if (false === $ret) {
			self::$errCode = -2032 . "  " . $orderDb->errCode;
			self::$errMsg='开启mysql事务失败'  . $orderDb->errMsg;
			return  false;
		}

		foreach ($newOrder as $k => $no)
		{
			if ($k == 'items') {
				continue;
			}
			$newOrder[$k] = addslashes($no);
		}

		
		//插入订单主表
		$now = time();
		global $_PAY_MODE;
		global $_OrderState;

		$status = 0; //$_PAY_MODE[$newOrder['payType']]['IsOnlineShow']? 0:0;
		$isPayed = ($cashToPay <= 0? 1:0);
		$flag = ORDER_INSTALLMENT_FLAG;
		$newItem = array(
				'order_char_id'=> $newOrderId,
	            'order_id'=> $newId,
	              'status'=> $status,
	                'flag'=> $flag,
	                 'uid'=> $newOrder['uid'],
	               'hw_id'=> $wh_id,
	          'order_date'=> $now,
	              'source'=> 0,
	                'type'=> 0,
	       'shipping_cost'=> 0,
	        'premium_cost'=> 0,
	       'shipping_type'=> $newOrder['shipType'],
	            'pay_time'=> 0,
	            'pay_type'=> $newOrder['payType'],
	           'prcd_cost'=> 0,
	          'order_cost'=>  $orderPrice,  //运费+商品总价+（随心配）
	            'price_cut'=> 0,
	         'coupon_type'=> 0,   //分期付款，该字段用来选择用户选择的银行
	         'coupon_code'=> '',        //分期付款，该字段用来记录用户选择的期数
	          'coupon_amt'=> 0, //分期付款，该字段用来选择用户选择期数对应的利率
	               'point'=> 0,
	           'point_pay'=> 0,  //分期付款，该字段用来选择用户选择期数对应的返还率
	                'cash'=> $orderPrice,
	            'receiver'=> $newOrder['receiver'],
	        'receiver_tel'=> $newOrder['receiverTel'],
	     'receiver_mobile'=> $newOrder['receiverMobile'],
	        'receiver_zip'=> $newOrder['zipCode'],
	    'receiver_addr_id'=> $newOrder['receiveAddrId'],
	       'receiver_addr'=> $newOrder['receiveAddrDetail'],
	     'expect_dly_date'=> strtotime($newOrder['expectDate']),
	'expect_dly_time_span'=> $newOrder['expectSpan'],
			'deliveryMemo'=> $newOrder['arrived_limit_time'],
	             'comment'=> $newOrder['comment'],
	          'update_time'=> $now,
	             'isPayed'=> $isPayed,
	             'out_time' => 0,
	             'sign_by_other' => $newOrder['sign_by_other'],
	             'installment_bank' => $installment['banksysno'],
	             'installment_num' => $newOrder['installment_num'],
	             'cash_per_month' => $cashPerMonth,
	             'rate' => $installment['rate'],
		     	'synflag' => 1,
	             'back_rate' => $installment['backrate'],
	             'pOrderId' => '',
		          'subOrderNum' => 0,
				  'is_vat' => $newOrder['isVat'],
		          'stockNo' =>  $psystock,
		          'customer_ip' => ToolUtil::getClientIP(),
		);
		$ret = $orderDb->insert("t_orders_{$db_tab_index['table']}", $newItem);
		if (false === $ret) {
			self::$errCode = -2033;
			self::$errMsg='执行sql语句失败' . $orderDb->errMsg;
			$sql = "rollback";
			$orderDb->execSql($sql);
			return  false;
		}

		if(0 == $newOrder['isVat']) //如果不需要开发票，那么其他字段也置为空
		{
			$newOrder['invoiceType'] = '';
			$newOrder['invoiceTitle'] = '';
			$newOrder['invoiceContent'] = '';
		}
		
		if ($newOrder['invoiceType'] != INVOICE_TYPE_VAT) {
			$newOrder['invoiceCompanyName'] = '';
			$newOrder['invoiceCompanyAddr'] = '';
			$newOrder['invoiceCompanyTel'] = '';
			$newOrder['invoiceTaxno'] = '';
			$newOrder['invoiceBankNo'] = '';
			$newOrder['invoiceBankName'] = '';
		}else
		{
			$newOrder['invoiceTitle'] = $newOrder['invoiceCompanyName'];
		}

		//插入发票表
		$newInv = array(
	'user_invoice_id'=> $newOrder['invoiceId'],
	  'order_char_id'=> $newOrderId,
	            'uid'=> $newOrder['uid'],
	           'type'=> $newOrder['invoiceType'],
	          'title'=> $newOrder['invoiceTitle'],
	           'name'=> $newOrder['invoiceCompanyName'],
	           'addr'=> $newOrder['invoiceCompanyAddr'],
	          'phone'=> $newOrder['invoiceCompanyTel'],
	          'taxno'=> $newOrder['invoiceTaxno'],
	         'bankno'=> $newOrder['invoiceBankNo'],
	       'bankname'=> $newOrder['invoiceBankName'],
	        'content'=> $newOrder['invoiceContent'],
	     'updatetime'=> time(),
	     'wh_id' =>$wh_id,
	        'auto_id'=> $invoice_id,
        	);
		$ret = $orderDb->insert("t_order_invoice_{$db_tab_index['table']}", $newInv);
		if (false === $ret) {
			self::$errCode = -2050;
			self::$errMsg='执行sql语句失败' . $orderDb->errMsg;
			$sql = "rollback";
			$orderDb->execSql($sql);
			return  false;
		}

		
		//扣减库存 &　生成虚库表
		$sql = "begin transaction";
		$ret = $msSQL->execSql($sql);
		if (false === $ret) {
			self::$errCode = -2035;
			self::$errMsg='开启ms sql事务失败' . $msSQL->errMsg;
			$sql = "rollback";
			$orderDb->execSql($sql);
			return  false;
		}
		$timeNow = date('Y-m-d H:i:s');
		$itemCount = count($shoppingProduct);
		$itemStartID = IIdGenerator::getNewId('So_Item_Sequence', $itemCount);

		if (false === $itemStartID) {
			self::$errCode = -2047;
			self::$errMsg='获取订单商品id失败' . IIdGenerator::$errMsg;
			$sql = "rollback";
			$orderDb->execSql($sql);
			$msSQL->execSql($sql);
			return  false;
		}
		
		$SubKeyId = $psystock;
		foreach ($shoppingProduct as $sp)
		{
			foreach ($productStocks as $pstock)
			{
				
				if($psystock != $pstock['StockSysNo'])
				{
					continue;
				}
				
				if ($sp['product_id'] == $pstock['ProductSysNo']) {
					if ($pstock['AvailableQty'] + $pstock['VirtualQty'] >= $sp['buy_count']) {    //可用大于购买数量
						$sql = "update Inventory_Stock set AvailableQty = AvailableQty - {$sp['buy_count']},  OrderQty = OrderQty + {$sp['buy_count']}, rowModifydate='{$timeNow}' where  AvailableQty+VirtualQty>={$sp['buy_count']} AND  ProductSysNo={$sp['product_id']}  and StockSysNo=$psystock";
						$ret = $msSQL->execSql($sql);						
						if (false === $ret || 1 != $msSQL->getAffectedRows()) 
						{
							Logger::err(var_export($sql,true));
							self::$errCode = -2047;
							self::$errMsg='扣减ms sql库存失败' . $msSQL->errMsg;
							$sql = "rollback";
							$orderDb->execSql($sql);
							$msSQL->execSql($sql);
							return  false;
						}
						
						// 记库存变化流水
						// AvailableQty
						$buy_num_negative = -1 * $sp['buy_count'];
						$sql = "insert into Inventory_Flow values({$SubKeyId}, {$sp['product_id']}, 1, {$newId}, 2, {$buy_num_negative},'{$timeNow}', '{$timeNow}',7)";
						$ret = $msSQL->execSql($sql);
						if ( false === $ret )
						{
							Logger::info($sql);	
							self::$errCode = -2048;
							self::$errMsg = "记录 AvailableQty 变化流水失败, line:". __LINE__ .",errMsg".$msSQL->errMsg;
							$orderDb->execSql("rollback");
							$msSQL->execSql("rollback");
							return false;
						}
						
						// OrderQty			
						$sql = "insert into Inventory_Flow values({$SubKeyId}, {$sp['product_id']}, 1, {$newId}, 4, {$sp['buy_count']},'{$timeNow}', '{$timeNow}',7)";
						$ret = $msSQL->execSql($sql);
						if ( false === $ret )
						{
							Logger::info($sql);	
							self::$errCode = -2049;
							self::$errMsg = "记录 OrderQty 变化流水失败, line:". __LINE__ .",errMsg".$msSQL->errMsg;
							$orderDb->execSql("rollback");
							$msSQL->execSql("rollback");
							return false;
						}
					}
					else 
					{
						// 库存不足，但是用户同意继续下单，把剩下的库存全部给用户
						if($lackGiftAndIgnore===true)
						{
							$sql = "update Inventory_stock set AvailableQty = AvailableQty - {$sp['buy_count']},  OrderQty = OrderQty + {$sp['buy_count']}, rowModifydate='{$timeNow}' where  AvailableQty+VirtualQty>={$sp['buy_count']} AND  ProductSysNo={$sp['product_id']}  and StockSysNo=$psystock";
							$ret = $msSQL->execSql($sql);
							Logger::err(var_export($sql,true));
							if (false === $ret || 1 != $msSQL->getAffectedRows()) {
								self::$errCode = -2047;
								self::$errMsg='扣减ms sql库存失败' . $msSQL->errMsg;
								$sql = "rollback";
								$orderDb->execSql($sql);
								$msSQL->execSql($sql);
								return  false;
							}
						}
						else
						{
							self::$errCode = -2099;
							self::$errMsg='商品'.$product_base_info[$sp['product_id']]['name']."库存不足";
							$sql = "rollback";
							$orderDb->execSql($sql);
							$msSQL->execSql($sql);
							return  array('errCode'=>-15, 'errMsg'=>"抱歉，{$product_base_info[$sp['product_id']]['name']}商品库存不足，请减少购买数量");
						}
					}
					
					//插入订单-商品映射表
					// $isMainProduct  0:主商品  1：组件  2：赠品
					$isMainProduct = $sp['type']; //($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL? 1 : 0);
					$product_base_info[$sp['product_id']]['point_type'] = isset($product_base_info[$sp['product_id']]['point_type'])? $product_base_info[$sp['product_id']]['point_type'] : 0;
					$product_base_info[$sp['product_id']]['point'] = isset($product_base_info[$sp['product_id']]['point'])? $product_base_info[$sp['product_id']]['point'] : 0;
					$product_base_info[$sp['product_id']]['cost_price'] = isset($product_base_info[$sp['product_id']]['cost_price'])? $product_base_info[$sp['product_id']]['cost_price'] : 0;
					$product_base_info[$sp['product_id']]['price'] = isset($product_base_info[$sp['product_id']]['price'])? $product_base_info[$sp['product_id']]['price'] : 0;

					$useVirtualStock = $pstock['AvailableQty'] + $pstock['VirtualQty'] >= $sp['buy_count']? 0:1;
					$newOrderItems = array(
						'item_id' => $itemStartID++,
						'order_char_id' => $newOrderId,
						'wh_id' => $wh_id,
						'product_id' => $sp['product_id'],
						'product_char_id' => $product_base_info[$sp['product_id']]['product_char_id'],
						'uid' => $newOrder['uid'],
						'name' => $product_base_info[$sp['product_id']]['name'],
						'flag' => $product_base_info[$sp['product_id']]['flag'],
						'type' => $product_base_info[$sp['product_id']]['type'],
						'type2' => $product_base_info[$sp['product_id']]['type2'],
						'weight' => $product_base_info[$sp['product_id']]['weight'],
						'buy_num' => $shoppingProduct[$sp['product_id']]['buy_count'],
						'points' => $product_base_info[$sp['product_id']]['point'] * $sp['buy_count'],
						'points_pay' => 0,
						'point_type' => $product_base_info[$sp['product_id']]['point_type'],
						'discount' => 0,
						'price' => ($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL)? $product_base_info[$sp['product_id']]['price']:0,
						//'price' => $price_product_temp,
						'cash_back' =>  0,
						'cost' => $product_base_info[$sp['product_id']]['cost_price'],
						'warranty' => $product_base_info[$sp['product_id']]['warranty'],
						'expect_num' => 0,
						'create_time' => $now,
						'product_type' => $isMainProduct,
						'use_virtual_stock' => $useVirtualStock,
						'main_product_id' => isset($sp['belongto_product_id']) ? $sp['belongto_product_id']: 0,
						'updatetime' => $now,
					);

					$ret = $orderDb->insert("t_order_items_{$db_tab_index['table']}" , $newOrderItems);
					if (false === $ret) {
						self::$errCode = -2039;
						self::$errMsg='执行sql语句失败' . $orderDb->errMsg;
						$sql = "rollback";
						$orderDb->execSql($sql);
						$msSQL->execSql($sql);
						return  false;
					}
					break;
				}
			}
		}

		$sql = "commit";
		$msSQL->execSql($sql);
		$orderDb->execSql($sql);


		//更新用户地址信息中默认支付方式，默认发票
		IUserAddressBookTTC::update(array('uid'=>$newOrder['uid'], 'default_shipping'=>$newOrder['shipType'],
		'default_pay_type'=>$newOrder['payType'], 'last_use_time'=>time(),'iid'=>$newOrder['invoiceId']), array('aid'=>$newOrder['aid']));

		//写下订单日志
		if (empty($logger)) {
			$logger = new Logger('IOrder');
		}
		$logger->info("new order:({$newOrder['uid']})($newId)");

		global $_PAY_MODE;
		return array(
			'errCode'=>0,
			'uid'=>$newOrder['uid'],
			'orderId'=>$newOrderId,
			'orderAmt'=> $orderPrice,
			'payType'=>$newOrder['payType'],
			'payTypeIsOnline' => $_PAY_MODE[$wh_id][$newOrder['payType']]['IsNet'],
			'payTypeName' => $_PAY_MODE[$wh_id][$newOrder['payType']]['PayTypeName'],
			'orderTotalAmt'=>$cashToPay, //订单客户需支付
			'payGoodsAmt' => $cashToPay, //订单客户支付的金额（去掉运费和享受到的其它优惠后的用户实际支付金额）
			'orderCreateTime'=>$now,
		);
	}

	private static function checkReceiverAddr(&$newOrder)
	{
		//开始检查收获地址
		if (!isset($newOrder['receiver']) || strlen($newOrder['receiver']) == 0) {
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
			&& (!isset($newOrder['receiverMobile']) || strlen($newOrder['receiverMobile']) == 0))  {
			self::$errCode = -2004;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newOrder[receiverTel and receiverMobile] is empty";
			return false;
		}
		if (!isset($newOrder['zipCode'])) {
			$newOrder['zipCode'] = '';
		}
		return  true;
	}
	private static function checkInvoice(&$newOrder)
	{
		$newOrder['isVat'] = isset($newOrder['isVat']) ? $newOrder['isVat'] : 1;
		if(0 == $newOrder['isVat']) //如果不需要开发票，则不用验证发票
		{
			return true;
		}
	
		if (!isset($newOrder['invoiceType']) || 
		   ($newOrder['invoiceType'] != INVOICE_TYPE_RETAIL_COMPANY && 
		    $newOrder['invoiceType'] != INVOICE_TYPE_RETAIL_PERSONAL && 
		    $newOrder['invoiceType'] != INVOICE_TYPE_VAT && 
		    $newOrder['invoiceType'] != INVOICE_TYPE_VAT_NORMAL)) {
			self::$errCode = -2009;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceType is invalid";
			return false;
		}

		if (!isset($newOrder['invoiceTitle']) || $newOrder['invoiceTitle'] == '' || strlen($newOrder['invoiceTitle']) > MAX_TITLE_LEN) {
			self::$errCode = -2010;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoice invoiceTitle is invalid";
			return false;
		}

		if (!isset($newOrder['invoiceId']) || $newOrder['invoiceId'] <= 0 ) {
			self::$errCode = -2017;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " invoiceId is invalid";
			return false;
		}

		//商业零售发票
		if ($newOrder['invoiceType'] == INVOICE_TYPE_VAT) {
			if (!isset($newOrder['invoiceCompanyName']) || $newOrder['invoiceCompanyName'] == '' || strlen($newOrder['invoiceCompanyName']) > MAX_COMPANY_LEN) {
				self::$errCode = -2011;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceCompanyName  is invalid";
				return false;
			}
			if (!isset($newOrder['invoiceCompanyAddr']) || $newOrder['invoiceCompanyAddr'] == '' || strlen($newOrder['invoiceCompanyAddr']) > MAX_ADDR_LEN) {
				self::$errCode = -2012;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceCompanyAddr  is invalid";
				return false;
			}
			if (!isset($newOrder['invoiceCompanyTel']) || $newOrder['invoiceCompanyTel'] == '' || strlen($newOrder['invoiceCompanyTel']) > MAX_PHONE_LEN) {
				self::$errCode = -2013;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceCompanyTel  is invalid";
				return false;
			}
			if (!isset($newOrder['invoiceTaxno']) || $newOrder['invoiceTaxno'] == '' || strlen($newOrder['invoiceTaxno']) > MAX_TAXNO_LEN) {
				self::$errCode = -2014;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceTaxno  is invalid";
				return false;
			}
			if (!isset($newOrder['invoiceBankNo']) || $newOrder['invoiceBankNo'] == '' || strlen($newOrder['invoiceBankNo']) > MAX_BANK_NO_LEN) {
				self::$errCode = -2015;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceBankNo  is invalid";
				return false;
			}
			if (!isset($newOrder['invoiceBankName']) || $newOrder['invoiceBankName'] == '' || strlen($newOrder['invoiceBankName']) > MAX_BANK_NAME_LEN) {
				self::$errCode = -2016;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceBankName  is invalid";
				return false;
			}
			if (!isset($newOrder['invoiceContent'])) {
				$newOrder['invoiceNote'] = '';
			}
		}

		//校验传入的发票id是否属于该用户
		$invoice = IUserInvoiceBookTTC::get($newOrder['uid'], array('iid'=>$newOrder['invoiceId']));
		if (false === $invoice) {
			self::$errCode = IUserInvoiceBookTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IUserInvoiceBookTTC failed]' . IUserInvoiceBookTTC::$errMsg;
			return false;
		}
		if (1 != count($invoice)) {
			self::$errCode = -2018;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoice id  is not exist or not belong to this uid";
			return false;
		}
		return  true;
	}

	private static function checkPayType(&$newOrder, $wh_id=1)
	{
		global $_PAY_MODE;
		global $_LGT_PAY;

		if (!isset($newOrder['payType']) || !isset($_PAY_MODE[$wh_id][$newOrder['payType']])) {
			self::$errCode = -2007;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newOrder[payType] is invalid";
			return false;
		}

		foreach ($_LGT_PAY[$wh_id] as $lgt)
		{
			if ($lgt['ShipTypeSysNo'] == $newOrder['shipType'] && $lgt['PayTypeSysNo'] == $newOrder['payType']){
				self::$errCode = -2008;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "paytype is not support by shiptype";
				return false;
			}
		}
		return true;
	}

	private static function checkShippingType(&$newOrder, $wh_id=1)
	{
		global $_LGT_MODE,$_WhidToRegion;
		if (!isset($newOrder['shipType']) || !isset($_LGT_MODE[$newOrder['shipType']])) {
			self::$errCode = -2005;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newOrder[shipType] is invalid";
			return false;
		}

		//运送方式不可用
		if ($_LGT_MODE[$newOrder['shipType']]['IsOnlineShow']  == 0) {
			self::$errCode = -2006;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newOrder[shipType] is avaible";
			return false;
		}

		global $_District;
		//判断该物流方式能否到达该目的地，商品禁运放在检查商品的时候进行
		$destination = $newOrder['receiveAddrId'] ;
		$source_region = $_WhidToRegion[$wh_id];
		$shippingTypeAva = IShippingRegionTTC::gets(array($destination, $_District[$destination]['city_id'],$_District[$destination]['province_id'] ), array('wh_id'=>$source_region));
		if (false === $shippingTypeAva) {
			self::$errCode = IShippingRegionTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IShippingRegionTTC failed]' . IShippingRegionTTC::$errMsg;
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
		
		if( false === $is_Reach )
		{
			// 找不到这种运送方式，则为不可达
			self::$errCode = -2006;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newOrder[shipType] can not shipping to destination";
			return false;
		}

		if (!isset($newOrder['expectDate'])) {
			$newOrder['expectDate'] = 0;
		}
		if (!isset($newOrder['expectSpan'])) {
			$newOrder['expectSpan'] = 0;
		}
		if (!isset($newOrder['arrived_limit_time'])){
			$newOrder['arrived_limit_time'] = '';
		}
		return true;
	}
}


