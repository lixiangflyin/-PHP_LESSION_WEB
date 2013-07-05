<?php
require_once(PHPLIB_ROOT . 'inc/ship.inc.php');
require_once(PHPLIB_ROOT . 'inc/installment.inc.php');
require_once(PHPLIB_ROOT . 'inc/district.inc.php');

/*
900:目的地编码不合法
901:目的地没有父城市id
902:运送方式不合法
903:使用优惠卷的用户id不合法
904：优惠券编码不合法
905:支付方式不合法
906:优惠券不可用
907: 订单金额不足以使用优惠券
908:积分数量不合法
909:用户不存在
910：用户积分不足
*/

class IInstallmentPreOrder
{
	public static $errCode = 0;
	public static $errMsg = '';

	/*   itemArr:数组，数组元素为购物车中商品id,不需要赠品，组件，  array(100,200,300)*/
	public static function getShippingTypeNotAviable($itemArr, $destination, $wh_id=1)
	{
		if (!is_array($itemArr) || count($itemArr) == 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "no items";
			return false;
		}

		if (!isset($destination) || $destination <= 0) {
			self::$errCode = 105;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "destination($destination) is invalid";
			return false;
		}
	
		$productIds = array();
		foreach ($itemArr as $pid)
		{
			if ($pid > 0) {
				$productIds[] = $pid;
			}
		}

		//拉取商品信息
		$products = IProductInfoTTC::gets($productIds, array('status'=>PRODUCT_STATUS_NORMAL, 'wh_id'=>$wh_id),array('product_id','restricted_trans_type'));
		if (false === $products) {
			self::$errCode = IProductTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductTTC failed]' . IProductTTC::$errMsg;
			return false;
		}
		
		$forbidenShip = array();			
		foreach ($products as $product)
		{
			$forbidenShip[$product['restricted_trans_type']][] = $product['product_id'];
		}
		
		$shipNotAvaialbe = array();
		if (!empty($forbidenShip)) {
			global $_District;
			$shipNotAvaialbe = self::getForbidenShippingType($forbidenShip, $_District[$destination]['province_id'],$_District[$destination]['city_id'], $destination ,$wh_id);
		}
		//如果不包含这些特殊商品，需要剔除自提
		global $_SelfFetchProductids;
		$bothExist = array_intersect($_SelfFetchProductids, $productIds);
		if (count($bothExist) == 0) {
			global $_LGT_MODE;
			foreach ($_LGT_MODE as $lgt)
			{
				if (false === strpos($lgt['ShipTypeName'], '上门提货')) {
					continue;
				}
				if (isset($shipNotAvaialbe[$lgt['SysNo']])) {
					continue;
				}
				$shipNotAvaialbe[$lgt['SysNo']] = array();
			}
		}
		return $shipNotAvaialbe;
	}

	/*   $items:数组:,不需要赠品，组件，  array(0=>array('product_id'=>100, 'buy_count'=>2),1=>array('product_id'=>1001, 'buy_count'=>1))*/
	public static function getItemsInShoppingCart($uid, $items , $wh_id=1)
	{
		if (!is_array($items) || count($items) != 1) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "item count is not right";
			return false;
		}
		
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 102;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}
		
		$productIds = array();
		foreach ($items as $key => $item)
		{
			if ($item['product_id'] > 0) {
				$productIds[] = $item['product_id'];
			}else
			{
				unset($items[$key]);
			}
		}

		//拉取商品信息
		$products = IProduct::getProductsInfo($productIds, $wh_id, true);
		if (false === $products) {
			self::$errCode = IProduct::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProduct failed]' . IProduct::$errMsg;
			return false;
		}		

		//剔除商品状态不处于正常状态的商品 &&　剔除没有商品基本信息的商品
		$productIds = array();
		$limitedProduct = array();
		$isContentVirtualStock = false;
		$psystock = 0;
		global  $_StockTips;
		global $_StockToWhidTransitDays;
		global $_Wh_id;
		global $_StockToStation;

		global $_ColorList, $_PROD_SIZE_2;
		foreach ($items as $key => $item)
		{
			$exist =  isset($products[$item['product_id']])? true:false;
			if (false == $exist) {
				unset($items[$key]);
				continue;
			}

			$product = $products[$item['product_id']];
			if ($product['status'] != PRODUCT_STATUS_NORMAL) {
			   	unset($items[$key]);
			 }else
			 {
			  	$items[$key]['name'] = $product['name'];
			   	$items[$key]['size'] = isset($_PROD_SIZE_2[$product["size"]])? $_PROD_SIZE_2[$product["size"]] : "";
			   	$items[$key]['color'] = isset($_ColorList[$product["color"]]) ? $_ColorList[$product["color"]] : "";
			   	$items[$key]['product_char_id'] = $product['product_char_id'];
			   	$items[$key]['pic_num'] = $product['pic_num'];
			   	$items[$key]['weight'] = $product['weight'];
				$items[$key]['type'] = $product['type'];
				$items[$key]['flag'] = $product['flag'];
				$items[$key]['c3_ids'] = $product['c3_ids'];
				$items[$key]['restricted_trans_type'] = $product['restricted_trans_type'];
				$items[$key]['market_price'] = $product['market_price'];
				$psystock = $product['psystock'];

				if (($product['flag'] & CAN_VAT_INVOICE) == CAN_VAT_INVOICE) {
					$items[$key]['canVAT'] = true;
				}else {
					$items[$key]['canVAT'] = false;
				}

				if (($product['flag'] & COUPON_PRODUCT) == COUPON_PRODUCT) {
					$items[$key]['canUseCoupon'] = false;
				}else {
					$items[$key]['canUseCoupon'] = true;
				}

				$items[$key]['price'] = $product['price'] + $product['cash_back'];
				$items[$key]['cash_back'] = $product['cash_back'];
				$items[$key]['point'] = $product['point'];
				$items[$key]['num_limit'] = $product['num_limit'];
				if ($product['num_limit'] > 0 && $product['num_limit'] < 999 ) {
					$limitedProduct[] = $product['product_id'];
				}
				if (($product['num_available'] + $product['virtual_num'] >=  $item['buy_count']) /*||
					(( $wh_id == 1) && ($product['flag'] & FORBID_SET_VIRTUAL) != FORBID_SET_VIRTUAL)
					       */)
				{
				   	if ($product['num_available'] >= $item['buy_count']) {   //实际库存足够
				    	if(!isset($_StockToWhidTransitDays[$product['psystock']][$wh_id]) || $_StockToWhidTransitDays[$product['psystock']][$wh_id] == 0)
						{
							$items[$key]['array_days'] = $_StockTips['available'];
						}else
						{
							$items[$key]['array_days'] = "有货，待{$_Wh_id[$_StockToStation[$product['psystock']]]}仓调拨，{$_StockToWhidTransitDays[$product['psystock']][$wh_id]}天后配送";
						}
					}else  if ($product['arrival_days'] == VIRTUAL_STOCK_ARRAY_1_3DAYS) {
						$items[$key]['array_days'] = $_StockTips['arrival1-3'];
						$isContentVirtualStock = true;
					}else
					{
						$items[$key]['array_days'] = $_StockTips['arrival2-7'];
						$isContentVirtualStock = true;
					}
					$productIds[] = $item['product_id'];
				} else
				{
					unset($items[$key]);
				}
			}

		}

		
		//ixiuzeng修改，拉取赠品信息
		$gifts = IGiftNewTTC::gets(array_unique($productIds), array('status'=>GIFT_STATUS_OK));
		if (false === $gifts)
		{
			self::$errCode = IGiftNewTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IGiftNewTTC failed]' . IGiftNewTTC::$errMsg;
			return false;
		}
		
		//剔除掉与主商品不在一个物理分仓
		$products_psy = array();
		$giftsValid = array();
		$products_gifts_type = array();
		foreach($products as $pwinfo)
		{
			$products_psy[$pwinfo['product_id']] = $pwinfo['psystock'];
			foreach($gifts as $gi)
			{
				if(($pwinfo['product_id'] == $gi['product_id']) && ($_StockToStation[$pwinfo['psystock']] == $gi['stock_id']))
				{
					$giftsValid[] = $gi;
					$products_gifts_type[$gi['product_id']][$gi['gift_id']][$gi['stock_id']]=$gi['type'];
				}
			}
		}
		unset($gifts);
		
		$gifts_ids = array();
		foreach ($giftsValid as $g)
		{
			$gifts_ids[] = $g['gift_id'];
		}
		
		//分别剔除掉每个商品中所有没有库存的赠品
		$giftsInventorys = IInventoryStockTTC::gets(array_unique($gifts_ids), array('status' => 0));
		if (false === $giftsInventorys) 
		{
			self::$errCode = IInventoryStockTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IInventoryStockTTC failed]' . IInventoryStockTTC::$errMsg;
			return false;
		}
		
		$giftValidInventory = array();
		foreach($giftsValid as $gv)
		{
			foreach($giftsInventorys as $gsi)
			{
				if(($gv['gift_id'] == $gsi['product_id']) && ($products_psy[$gv['product_id']] == $gsi['stock_id']) && 
				  (($gsi['num_available'] + $gsi['virtual_num'] > 0) || (COMPONENT_TYPE==$products_gifts_type[$gv['product_id']][$gv['gift_id']][$gv['stock_id']])))
				{
					$gv['num_available'] = $gsi['num_available'];
					$gv['virtual_num'] = $gsi['virtual_num'];
					$giftValidInventory[] =  $gv;
					break;
				}
			}
		}
		
		
		$gifts_final_ids = array();
		foreach($giftValidInventory as $gvi)
		{
			$gifts_final_ids[] = $gvi['gift_id'];
		}
		
		//拉取礼品商品的基本信息
		$gift_base_info = IProductCommonInfoTTC::gets(array_unique($gifts_final_ids), array(), array('name', 'product_char_id', 'weight', 'pic_num'));
		if (false === $gift_base_info) {
			self::$errCode = IProductCommonInfoTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductCommonInfoTTC failed]' . IProductCommonInfoTTC::$errMsg;
			return false;
		}
		
		//剔除基本信息不存在的礼品
		foreach ($giftValidInventory as $key => $gift) {
			$exist = false;
			foreach ($gift_base_info as $g_base) {
				if ($g_base['product_id'] == $gift['gift_id']) {
					$exist = true;
					$giftValidInventory[$key]['name'] = $g_base['name'];
					$giftValidInventory[$key]['product_char_id'] = $g_base['product_char_id'];
					$giftValidInventory[$key]['weight'] = $g_base['weight'];;
					$giftValidInventory[$key]['stock_num'] = $gift['num_available'] + $gift['virtual_num'] ;
					break;
				}
			}
		
			if (false === $exist) {
				unset($giftValidInventory[$key]);
			}
		}
		
		//拉取礼品的在各个分仓的装填,赠品组件的状态不可能是出售状态
		$gift_wh_info = IProductInfoTTC::gets(array_unique($gifts_final_ids), array(),array('product_id','wh_id','status'));
		$gifts_status = array();
		if (false === $gift_wh_info) 
		{
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
			return false;
		}
		foreach($gift_wh_info as $gwi)
		{
			$gifts_status[$gwi['product_id']][$gwi['wh_id']] = $gwi['status'];
		}
		
		//将赠品与其对应的主商品进行绑定
		global $_StockToStation;
		foreach ($items as $key => $item)
		{
			$items[$key]['gift'] = array();
			foreach ($giftValidInventory as $gift)
			{
				if (($gift['product_id'] == $item['product_id']) && ($_StockToStation[$gift['stock_id']] == $_StockToStation[$psystock]) &&
					($gifts_status[$gift['gift_id']][$_StockToStation[$gift['stock_id']]] != PRODUCT_STATUS_NORMAL))//赠品组件的状态不可能是出售状态
				{
					$items[$key]['gift'][$gift['gift_id']]['name'] = $gift['name'];
					$items[$key]['gift'][$gift['gift_id']]['product_id'] = $gift['gift_id'];
					$items[$key]['gift'][$gift['gift_id']]['product_char_id'] = $gift['product_char_id'];
					$items[$key]['gift'][$gift['gift_id']]['type'] = $gift['type'];
					$items[$key]['gift'][$gift['gift_id']]['weight'] = $gift['weight'];
					$items[$key]['gift'][$gift['gift_id']]['num'] = $gift['gift_num'];
					$items[$key]['gift'][$gift['gift_id']]['stock_num'] = $gift['stock_num'];
				}
			}
		}
		

		$totalAmt = 0;
		$totalWeight = 0;
		$totalCut = 0;
		$isCanVATInvoice = true;
		$c3ids = array();


		foreach ($items as $key=>$item)
		{
			if (0 == ($item['flag'] & CAN_VAT_INVOICE)) {  //增值发票
				$isCanVATInvoice = false;
			}

			$c3ids[] = $item['c3_ids'];
			
			$totalAmt +=  $item['price']   * $item['buy_count'];
			$totalWeight += $item['buy_count'] * $item['weight'];
			$totalCut += $item['buy_count'] * $item['cash_back'];
			foreach ($item['gift'] as $g)
			{
				$totalWeight += (($item['buy_count'] * $g['num']) <= $g['stock_num']? ($item['buy_count'] * $g['num']) : $g['stock_num']) * $g['weight'];
			}
		}

		//拉取商品三级分类，判断是否能模糊开票
		$isCanFuzzyInvoice = true;
		$avaiableInvoices = array('isCanVAT' => $isCanVATInvoice,'hasNoteBook'=>0,'contentOpt'=>array('商品明细'));

		//如果购物车中有笔记本类商品，需要提示以公司开普通发票，无法保修
		if (in_array(234, $c3ids)) {
			$avaiableInvoices['hasNoteBook'] = 1;
		}
		
		$hasCellPhone = false;
		if (in_array(311, $c3ids)) {
			$hasCellPhone = true;
		}
		
		if($wh_id == 1|| $wh_id == 2001){
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
			if (true == $isCanFuzzyInvoice) {
				$c2ids = array_unique($c2ids);
				$c2Info = ICategoryTTC::gets($c2ids, array('level'=>2, 'status'=>0), array('parent_id'));
				if (is_array($c2Info)) {
					global $_FuzzyInvoiceConf;
					foreach ($c2Info as $c2)
					{
						if (isset($_FuzzyInvoiceConf[intval($c2['parent_id'])])) {
							$avaiableInvoices['contentOpt'] = array_merge($avaiableInvoices['contentOpt'], $_FuzzyInvoiceConf[intval($c2['parent_id'])]);
						}
					}
				}
			}			
		}
		}
		if (false === $isCanFuzzyInvoice) {
			$avaiableInvoices['contentOpt'] = array('商品明细');
		}
		$avaiableInvoices['contentOpt'] = array_unique($avaiableInvoices['contentOpt']);

		//检查限购
		//如果购物车中商品有限购商品，则查询该用户当天的订单
		//这里部署外网需要修改分库分表的问题
		global $_OrderState;
		if (!empty($limitedProduct)) {
			$timestamp = mktime(0,0,0,date('m'), date('d'), date('Y') );
			
			$db_tab_index = ToolUtil::getMSDBTableIndex($uid,'ICSON_ORDER_CORE');
			$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
						
			$sql = "select  product_id, sum(buy_num) as buy_num from 
			t_order_items_{$db_tab_index['table']} ot, 
			t_orders_{$db_tab_index['table']} o 
			where o.order_char_id=ot.order_char_id".
			" and o.status<>". $_OrderState['ManagerCancel']['value'] .
			" and o.status<>". $_OrderState['CustomerCancel']['value'].
			" and o.status<>". $_OrderState['EmployeeCancel']['value']." and ot.uid=$uid and create_time > " . $timestamp . 
			" and product_id in(" . implode(',', $limitedProduct) . ") group by product_id";
			$userOrder = $orderDb->getRows($sql);
			if (false === $userOrder) {
				self::$errCode = $orderDb->errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query order db failed]' . $orderDb->errMsg;
				return false;
			}

			if (!empty($userOrder)) {
				self::$errMsg = "您购买的";
				foreach ($userOrder as $order)
				{
					foreach ($items as $item)
					{
						if ($item['product_id'] == $order['product_id']) {
							if ($item['buy_count'] + $order['buy_num'] > $item['num_limit']) {
								self::$errCode = 999;
								self::$errMsg .= $item['name'] . "限购{$item['num_limit']}件，您今日已购{$order['buy_num']}件;";
							}
							break;
						}
					}
				self::$errMsg .= "请您返回购物车修改购买数量";
				}
			}
		}
		//检查限购完毕
		if (self::$errCode === 999) {
			return false;
		}
		
		
		$errCode = 0;
		$errMsg = '';		
		$cash = $totalAmt - $totalCut;
		if ($cash < INSTALLMENT_CELLPHONE_PRICE_MIN) {
			$errCode = 1000;
			$errMsg .= "手机商品分期付款订单金额不得小于600元";
		}
		if ($hasCellPhone == true) {
			if ($cash > INSTALLMENT_CELLPHONE_PRICE_MAX)
			{
				$errCode = 1000;
				$errMsg .= "手机商品分期付款订单金额不得大于8300元";
			}
		}else if ($cash > INSTALLMENT_NOTCELLPHONE_PRICE_MAX)
		{
			$errCode = 1000;
			$errMsg .= "非手机商品分期付款订单金额不得大于28000元";
		}
		return array('errCode'=>$errCode, 
					'errMsg'=>$errMsg,'invoice'=>&$avaiableInvoices, 
					'items'=>&$items, 'totalCut'=>$totalCut, 
					'totalAmt' => $totalAmt, 
					'totalWeight' => $totalWeight, 
					'isVirtual' => $isContentVirtualStock,
					'psystock'=>$psystock);
	}

	public static function getShippingTypeByDestination($destination, $isVirtual = false, $totalWeight = 0, $wh_id = 1, $psystock = 0)
	{
		global $_District,$_WhidToRegion,$_LGT_MODE,$_InstallmentShipType;

		if (!isset($destination) || $destination <= 0) {
			self::$errCode = 900;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "destination($destination) is invalid";
			return false;
		}

		if (!isset($_District[$destination])) {
			self::$errCode = 901;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "destination($destination) has no parent city";
			return false;
		}
		
		// TODO:多分仓
		if( !isset($wh_id) || !is_numeric($wh_id) || $wh_id <= 0 )
		{
			self::$errCode = 902;
			self::$errMsg = basename( __FILE__, '.php') . " | ". __LINE__ . "wh_id($wh_id) is invalid";
			return false;
		}		

		if( !isset($_WhidToRegion[$wh_id]))
		{
			self::$errCode = 903;
			self::$errMsg = basename( __FILE__, '.php') . " | ". __LINE__ . "wh_id($wh_id) has no stock id";
			return false;
		}
		
		// 得到起始分站对应的仓库ID
		$source_region = $_WhidToRegion[$wh_id];
		$shippingTypeAll = IShippingRegionTTC::gets(
			array( $destination, 
				$_District[$destination]['city_id'],
				$_District[$destination]['province_id'] 
			),
			array('wh_id'=>$source_region, 'status' => 0 )
		);
		
		if (false === $shippingTypeAll) {
			self::$errCode = IShippingRegionTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IShippingRegionTTC failed]' . IShippingRegionTTC::$errMsg;
			return false;
		}
		
		$shippingType = array();

		$icson_delivery_info = array();
		foreach($shippingTypeAll as $sp_type)
		{
			foreach ($_InstallmentShipType[$wh_id] as $sp_key)
			{	
				if( $sp_key != $sp_type['shipping_id'] )
					continue;

				$sp_type_info = $_LGT_MODE[$sp_key];

				if( $sp_key == ICSON_DELIVERY )
				{
					$icson_delivery_info = $sp_type;
				}

				if ($sp_type_info['IsOnlineShow'] == 0 ) {
					continue;
				}	
				
				// 如果当前可以在线展示，则加入到shippingType中
				$shippingType[$sp_type_info['SysNo']] = $sp_type_info;
				$shippingType[$sp_type_info['SysNo']]['ShippingId'] = $sp_type_info['SysNo'];

				//目前支持是易迅快递，没有运费
				$shippingType[$sp_type_info['SysNo']]['shippingPrice'] = 0;
				$shippingType[$sp_type_info['SysNo']]['shippingPriceCut'] = 0;
				
			}
		}
	

		//Logger::info(var_export($shippingType,true));
		global $_ArrivedLimitTime;
		$limitOrder = IShippingTime::getOrderLimitState($wh_id);
		//如果可以采用易迅快递，则获取送货时间
		if ( array_key_exists(ICSON_DELIVERY, $shippingType)) {
			
			$old_delivery_time = $icson_delivery_info['delivery_time'];
			if ($psystock == 5 && $wh_id == SITE_SH )  // 上海大件仓，按一日一送获取时间
				$icson_delivery_info['delivery_time'] = 1;
				
			// 发货仓库	
			$icson_delivery_info['stock_num'] = $psystock;
			$shippingType[ICSON_DELIVERY]['timeAvaiable'] = IShippingTime::getShipTimeListIcson($icson_delivery_info, $wh_id, $destination, $isVirtual, $limitOrder['am_limit'],  $limitOrder['day_limit']);
			$icson_delivery_info['delivery_time'] = $old_delivery_time;
			//ixiuzeng添加。采用易迅快递且属于限时达地区，
			if (!isset($_ArrivedLimitTime[$destination])){
				$shippingType[ICSON_DELIVERY]['isArrivedLimitTime'] = false;
			}
			else{
				$shippingType[ICSON_DELIVERY]['isArrivedLimitTime'] = true;
			}
			
		}
		
		//如果可以采用上海自提，则获取自提时间
		if ($wh_id == 1 && array_key_exists(8, $shippingType)) {
			if ($psystock == 5) {  //大件仓，按一日一送或许时间
				$shippingType[8]['timeAvaiable'] = IShippingTime::getCarryTimeList1($wh_id, $destination, $isVirtual, $limitOrder['am_limit'],  $limitOrder['day_limit']);
			}else {
				$shippingType[8]['timeAvaiable'] = IShippingTime::getCarryTimeList2($wh_id, $destination, $isVirtual, $limitOrder['am_limit'],  $limitOrder['day_limit']);
			}
			
		}
		//如果可以采用张家港自提，则获取自提时间
		if ($wh_id == 1 && array_key_exists(46, $shippingType)) {
			$shippingType[46]['timeAvaiable'] = IShippingTime::getCarryTimeList1($wh_id, $destination, $isVirtual, $limitOrder['am_limit'],  $limitOrder['day_limit']);
		}

		return $shippingType;
	}


	public  static function getPayType($totalMoney, $wh_id=1)
	{
		if (!isset($totalMoney) || $totalMoney <= 0) {
			self::$errCode = 902;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "totalMoney($totalMoney) is invalid";
			return false;
		}

		global $_InstallmentBank;
		
		$result = array();
		
		foreach ($_InstallmentBank as $key=>$bank)
		{
			foreach ($bank['installments'] as $k => $installment)
			{
				if ($totalMoney >= $installment['minprice'] && $totalMoney <= $installment['maxprice']) {
					$result[$key]['bankname'] = $bank['bank'];
					$result[$key]['paytype'] = $bank['paytype'];
					$result[$key]['installments'][$k]['month'] = $k;
					$result[$key]['installments'][$k]['additionFeeTotal'] = $k * round($installment['rate'] * $totalMoney / $k);
					$result[$key]['installments'][$k]['additionFeePerMonth'] = round($installment['rate'] * $totalMoney / $k);
				}
			}
		}		
		return  $result;

	}

	//$forbidenShipArr == array('禁运方式'=>array('商品id'))
	//返回值： array('不可用的运送方式'=>array('商品id'))
	public static function getForbidenShippingType($forbidenShipArr, $province, $city, $district, $wh_id=1)
	{
		return IPreOrder::getForbidenShippingType($forbidenShipArr, $province, $city, $district, $wh_id);
	}
}
