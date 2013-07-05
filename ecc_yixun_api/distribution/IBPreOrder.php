<?php
require_once(PHPLIB_ROOT . 'inc/district.inc.php');
require_once(PHPLIB_ROOT . 'inc/ship.inc.php');
require_once(PHPLIB_ROOT . 'api/distribution/IBCustom.php');
/**
	900:目的地编码不合法
	901:目的地没有父城市id
	902:运送方式不合法
	903:使用优惠卷的用户id不合法
	904:优惠券编码不合法
	905:支付方式不合法
	906:优惠券不可用
	907:订单金额不足以使用优惠券
	908:积分数量不合法
	909:用户不存在
	910:用户积分不足
	1000：收货地址不合法
	1001：发票信息不合法
*/
/**
 * 提供分销订单的验证、查询、更新、入预订单库功能 
 */
class IBPreOrder {
	public static $errCode = 0;
	public static $errMsg = '';

	// 根据用户类型，支付方式会稍有不同
	const USER_TYPE_ALI = 'ali'; //支付宝普通
	const USER_TYPE_ALI_GOLDEN = 'ali_golden'; //支付宝金账户
	const USER_TYPE_SHCAR = 'shcar'; //上汽

	//以下几个特殊配置，需跟线上保持一致，不然会出问题
	public static $PAYTYPE_ALI_ONLY = array(17,18,19,20,21); //支付宝用户只有这几个
	public static $PAYTYPE_ALI_GOLDEN_ONLY = array(21); //支付宝金账户只有这1个
	public static $PAYTYPE_SHCAR_ONLY = array(73); //仅供上汽用户

	//$product_id_wireless: 如果传入合法值，代表是无线一键购买
	public static function getShippingTypeNotAviable($uid, $destination, $wh_id=1, $product_id_wireless = -1) {
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}
		if (!isset($destination) || $destination <= 0) {
			self::$errCode = 105;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "destination($destination) is invalid";
			return false;
		}

		if ($product_id_wireless > 0) {
			$items = array(0 => array( 'product_id' => $product_id_wireless));
		}
		else {
			$items = IBShoppingCartTTC::get($uid, array(), array('product_id'));
			if (false === $items) {
				self::$errCode = IBShoppingCartTTC::$errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IShoppingCartTTC failed]' . IShoppingCartTTC::$errMsg;
				return false;
			}
		}

		$productIds = array();
		foreach ($items as $key => $item) {
			if ($item['product_id'] > 0) {
				$productIds[] = $item['product_id'];
			}
			else {
				$deleteProductIds[] = $item['product_id'];
				unset($items[$key]);
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
		$deleteProductIds = array();
		foreach ($items as $key => $item) {
			$exist = false;
			foreach ($products as $product) {
				if ($item['product_id'] == $product['product_id']) {
					$exist = true;
					$forbidenShip[$product['restricted_trans_type']][] = $product['product_id'];
					break;
				}
			}
			if (false === $exist) {
				$deleteProductIds[] = $item['product_id'];
			}
		}


		$shipNotAvaialbe = array();
		if (!empty($forbidenShip)) {
			global $_District;
			$shipNotAvaialbe = IBPreOrder::getForbidenShippingType($forbidenShip, $_District[$destination]['province_id'],  $_District[$destination]['city_id'],$destination, $wh_id);
		}

		//如果不包含这些特殊商品，需要剔除自提
		global $_SelfFetchProductids;
		$bothExist = array_intersect($_SelfFetchProductids, $productIds);
		if (count($bothExist) == 0) {
			global $_LGT_MODE;
			foreach ($_LGT_MODE as $lgt) {
				if (false === strpos($lgt['ShipTypeName'], '上门提货')) {
					continue;
				}
				if (isset($shipNotAvaialbe[$lgt['SysNo']])) {
					continue;
				}
				$shipNotAvaialbe[$lgt['SysNo']] = array();
			}
		}

		//删除不合法的购物车商品
		foreach ($deleteProductIds as $id) {
			if ($product_id_wireless == -1) {
					IBShoppingCartTTC::remove($uid, array('product_id'=>$id));
			}
		}
		return $shipNotAvaialbe;
	}

	//  $payAmt: 为用户需要支付的金额(手续费除外)
	public static function getProcFee($payAmt, $payType, $wh_id=1) {
		if (!isset($payAmt) || $payAmt < 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "payAmt($payAmt) is invalid";
			return false;
		}
		global $_PAY_MODE;
		if ($payType < 0 || !isset($_PAY_MODE[$wh_id][$payType])) {
			self::$errCode = 102;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "payType($payType) is invalid";
			return false;
		}
		return ceil(bcmul($payAmt ,$_PAY_MODE[$wh_id][$payType]['PayRate'], 6));
	}

	/**
	 * $products 商品的基本信息，包括 num_available, virtual_num, type, flag
	 * $item 购买商品的基本信息，包括 buy_count, product_id
	 */
	public static function isVirtualOrder($products, $items) {
		$wh_id = IUser::getSiteId();
		foreach($items as $item) {
			$product = $products[$item['product_id']];
			if ( ($product['num_available'] + $product['virtual_num'] >=  $item['buy_count'])
				|| (( $wh_id == 1) && ($product['flag'] & FORBID_SET_VIRTUAL) != FORBID_SET_VIRTUAL && $product['type'] == PRODUCT_TYPE_NORMAL) ) {

				if ($product['num_available']  < $item['buy_count']) { //实际库存不足够
					return true;
				}
			}
		}
		return false;
	}

	/**
	商品详情链接，或者加入购物车连接后面带上   edm=xxxxxx，则需要记录该串，并传入到此
	格式"code1_productid1,code2_productid2"

	$rule_id :  如果用户在购物车页面选择了促销规则，则需要传入其选择的促销规则id
	$apply_times:如果促销规则是换购，或者赠送商品，则需要传入apply_times：规则累计次数
	$product_id_wilreless: 如果传入此参数，说明是来自无线的一键购买
	$buy_count_wireless:  无线一键购买，购买商品的数量
	*/
	public static function getItemsInShoppingCart($uid , $wh_id=1, $open_id='', $rule_id=0, $apply_times=999, $product_id_wilreless = -1, $buy_count_wireless=0,$is_es=false, $esitems=array()) {
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}

		$items = IBShoppingCartTTC::get($uid, array(), array('product_id', 'buy_count', 'main_product_id', 'price_id'));
		if (false === $items) {
			self::$errCode = IBShoppingCartTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IShoppingCart failed]' . IShoppingCart::$errMsg;
			return false;
		}


		$deleteProductIds = array();
		$productIds = array();
		$multiPriceProduct = array();
		foreach ($items as $key => $item) {
			if ($item['product_id'] > 0) {
				$productIds[] = $item['product_id'];
				if ($item['price_id'] > 0) {   //如果是取特殊价格
					$multiPriceProduct[$item['product_id']]['price_id'] = $item['price_id'];
					$multiPriceProduct[$item['product_id']]['multiPriceType'] = 0; //默认都没有特殊价格
				}
			}
			else {
				$deleteProductIds[] = $item['product_id'];
				unset($items[$key]);
			}
		}

		// 拉取商品信息
		$products = IProduct::getProductsInfo($productIds, $wh_id, true);
		if (false === $products) {
			self::$errCode = IProduct::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProduct failed]' . IProduct::$errMsg;
			return false;
		}
		
	    $dprice = IBProduct::getProductDistributionPrice($uid, $productIds);
        if (false === $dprice)
        {
            self::$errCode = IBProduct::$errCode;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[invoke IBProduct::getProductDistributionPrice() failed]' . IBProduct::$errMsg;
            return false;
        }
        
		// 剔除商品状态不处于正常状态的商品 && 剔除没有商品基本信息的商品
		$productIds = array();
		$limitedProduct = array();
		$virtualStockPids = array();
		global  $_StockTips, $_ColorList, $_PROD_SIZE_2;
		global $_StockToWhidTransitDays;
		global $_Wh_id;
		global $_StockToStation;

		foreach ($items as $key => $item) {
			$exist =  isset($products[$item['product_id']]) ? true : false;
			if (false == $exist) {
				unset($items[$key]);
				$deleteProductIds[] = $item['product_id'];
				continue;
			}

			$product = $products[$item['product_id']];
			if ($product['status'] != PRODUCT_STATUS_NORMAL) {
				unset($items[$key]);
				$deleteProductIds[] = $item['product_id'];
			}
			else {
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
				$items[$key]['psystock'] = $product['psystock'];
				$items[$key]['canAddToWireLessCart'] = ($wh_id == 1 && $product['psystock'] == 1);
				$items[$key]['rushing_buy'] = ($product['flag'] & OTHER_TIME_LIMITED_RUSHING_BUY) == OTHER_TIME_LIMITED_RUSHING_BUY; //抢购
				$items[$key]['canVAT'] = ($product['flag'] & CAN_VAT_INVOICE) == CAN_VAT_INVOICE;
				$items[$key]['canUseCoupon'] = ($product['flag'] & COUPON_PRODUCT) != COUPON_PRODUCT;
				//$items[$key]['price'] = $product['price'] + $product['cash_back'];
				$items[$key]['price'] = $dprice[$item['product_id']];
				$items[$key]['cash_back'] = $product['cash_back'];

				if (isset($promotion['benefit_type'])) {
					if ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_HUANGOU']
						&& $item['product_id'] == $promotion['discount']) { //换购

						$dis = ($product['price'] - $promotion['plus_con']) > 0 ? ($product['price'] - $promotion['plus_con']) : 0;
						$promotion['benefits'] = $dis * $promotion['benefit_times'] * $promotion['benefit_per_time'];
					}
					else if ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_PRODUCT']
								&& $item['product_id'] == $promotion['discount']) { //赠送商品

						$promotion['benefits'] = $product['price'] * $promotion['benefit_times'] * $promotion['benefit_per_time'];
					}
				}

				//$items[$key]['cost_price'] = $product['cost_price'];
				$items[$key]['point'] = $product['point'];
				$items[$key]['num_limit'] = $product['num_limit'];
				if ($product['num_limit'] > 0 && $product['num_limit'] < 999) {
					$limitedProduct[] = $product['product_id'];
				}

				if (($product['num_available'] + $product['virtual_num'] >=  $item['buy_count']) ||
					(( $wh_id == 1) && ($product['flag'] & FORBID_SET_VIRTUAL) != FORBID_SET_VIRTUAL && $product['type'] == PRODUCT_TYPE_NORMAL)
					/* ($product['type'] == PRODUCT_TYPE_NORMAL && $product['price'] > $product['cost_price'])*/) {

					if ($product['num_available']  >= $item['buy_count']) { //实际库存足够
						if (!isset($_StockToWhidTransitDays[$product['psystock']][$wh_id]) || $_StockToWhidTransitDays[$product['psystock']][$wh_id] == 0) {
							$items[$key]['array_days'] = $_StockTips['available'];
						}
						else {
							$items[$key]['array_days'] = "有货，待{$_Wh_id[$_StockToStation[$product['psystock']]]}仓调拨，{$_StockToWhidTransitDays[$product['psystock']][$wh_id]}天后配送";
						}
					}
					else {
						if ($product['arrival_days'] == VIRTUAL_STOCK_ARRAY_1_3DAYS) {
							$items[$key]['array_days'] = $_StockTips['arrival1-3'];
							$virtualStockPids[] = $item['product_id'];
						}else
						{
							$items[$key]['array_days'] = $_StockTips['arrival2-7'];
							$virtualStockPids[] = $item['product_id'];
						}
					}
					$productIds[$item['product_id']] = $item['product_id'];
				}
				else {
					unset($items[$key]);
					$deleteProductIds[] = $item['product_id'];
				}
			}
		}

		//ixiuzeng修改，拉取赠品信息
		$gifts = IGiftNewTTC::gets(array_unique($productIds), array('status'=>GIFT_STATUS_OK));
		if (false === $gifts) {
			self::$errCode = IGiftNewTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IGiftNewTTC failed]' . IGiftNewTTC::$errMsg;
			return false;
		}

		//剔除掉与主商品不在一个物理分仓
		$giftsValid = array();
		$products_gifts_type = array();
		foreach($products as $pwinfo) {
			foreach($gifts as $gi) {
				if (($pwinfo['product_id'] == $gi['product_id']) && ($pwinfo['psystock'] == $gi['stock_id'])) {
					$giftsValid[] = $gi;
					$products_gifts_type[$gi['product_id']][$gi['gift_id']][$gi['stock_id']]=$gi['type'];
				}
			}
		}
		unset($gifts);

		$gifts_ids = array();
		foreach ($giftsValid as $g) {
			$gifts_ids[] = $g['gift_id'];
		}

		//分别剔除掉每个商品中所有没有库存的赠品
		$giftsInventorys = IInventoryStockTTC::gets(array_unique($gifts_ids), array('status' => 0));
		if (false === $giftsInventorys) {
			self::$errCode = IInventoryStockTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IInventoryStockTTC failed]' . IInventoryStockTTC::$errMsg;
			return false;
		}

		$giftValidInventory = array();
		foreach($giftsValid as $gv) {
			foreach($giftsInventorys as $gsi) {
				if (($gv['gift_id'] == $gsi['product_id']) && ($gv['stock_id'] == $gsi['stock_id'])
					&& (($gsi['num_available'] + $gsi['virtual_num'] > 0) || COMPONENT_TYPE == $products_gifts_type[$gv['product_id']][$gv['gift_id']][$gv['stock_id']])) {

					$gv['num_available'] = $gsi['num_available'];
					$gv['virtual_num'] = $gsi['virtual_num'];
					$giftValidInventory[] = $gv;
					break;
				}
			}
		}

		$gifts_final_ids = array();
		foreach($giftValidInventory as $gvi) {
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
		if (false === $gift_wh_info) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
			return false;
		}
		foreach($gift_wh_info as $gwi) {
			$gifts_status[$gwi['product_id']][$gwi['wh_id']] = $gwi['status'];
		}

		//将赠品与其对应的主商品进行绑定
		global $_StockToStation;
		foreach ($items as $key => $item) {
			$items[$key]['gift'] = array();
			foreach ($giftValidInventory as $gift) {
				if (($gift['product_id'] == $item['product_id']) && ($gift['stock_id'] == $item['psystock'])
					&& ($gifts_status[$gift['gift_id']][$_StockToStation[$gift['stock_id']]] != PRODUCT_STATUS_NORMAL)) { //赠品组件的状态不可能是出售状态

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

		//删除不合法的购物车商品
		foreach ($deleteProductIds as $id) {
			if ($product_id_wilreless == -1 && $buy_count_wireless == 0) {
				IShoppingCartTTC::remove($uid, array('product_id'=>$id));
			}
		}

		//拉取随心配,同时检查是否能开赠票，能否模糊开票
		$matchPids = array();
		$totalAmt = 0;
		$totalWeight = 0;
		$totalCut = 0;
		$isCanVATInvoice = true;
		$c3ids = array();
		$rule_total_amt = 0;

		//开始根据商品所在物理仓储拆单
		global $_StockToStation;
		$itemGroups = array();
		$itemsForConflit = array();
		foreach ($items as $key=>$item) {
			//按物理仓储分子订单
			$itemGroups[$item['psystock']]['items'][$item['product_id']] = $item;
			$itemGroups[$item['psystock']]['isVirtual'] = isset($itemGroups[$item['psystock']]['isVirtual']);

			// 判断是否在虚库商品列表中
			if (in_array($item['product_id'], $virtualStockPids)) {
				$itemGroups[$item['psystock']]['isVirtual'] = true;
			}

			$itemsForConflit[] = $item['product_id'];
			if (0 == ($item['flag'] & CAN_VAT_INVOICE)) { //增值发票
				$isCanVATInvoice = false;
			}

			$c3ids[] = $item['c3_ids'];

			if ($item['main_product_id'] > 0) {
				$matchPids[] = $item['main_product_id'];
			}
			@$itemGroups[$item['psystock']]['totalAmt'] += $item['price']  * $item['buy_count'];
			@$itemGroups[$item['psystock']]['totalCut'] += $item['buy_count'] * $item['cash_back'];
			@$itemGroups[$item['psystock']]['totalWeight'] +=  $item['buy_count'] * $item['weight'];

			if (isset($promotion['benefit_type']) && $promotion['benefits'] > 0) {
				if (in_array($item['product_id'], $promotion['pids'])) { //计算每个子单中满足促销规则的商品的总价格，便于在子单之间分摊促销成本
					@$itemGroups[$item['psystock']]['rule_total_amt'] += $item['price'] * $item['buy_count'];
					$rule_total_amt +=  $item['price'] * $item['buy_count'];
				}
			}

			$totalAmt += ( $item['price'] )  * $item['buy_count'];
			$totalWeight += $item['buy_count'] * $item['weight'];
			$totalCut += $item['buy_count'] * $item['cash_back'];
			foreach ($item['gift'] as $g) {
				@$itemGroups[$item['psystock']]['totalWeight'] +=  (($item['buy_count'] * $g['num']) <= $g['stock_num']? ($item['buy_count'] * $g['num']) : $g['stock_num']) * $g['weight'];
				$totalWeight += (($item['buy_count'] * $g['num']) <= $g['stock_num'] ? ($item['buy_count'] * $g['num']) : $g['stock_num']) * $g['weight'];
			}

			if (isset($_StockToStation[$item['psystock']])) {
				$itemGroups[$item['psystock']]['stock_wh_id'] = intval($_StockToStation[$item['psystock']]);
			}
			else {
				$itemGroups[$item['psystock']]['stock_wh_id'] = 0;
			}
			$itemGroups[$item['psystock']]['stock_wh_id'] = intval($_StockToStation[$item['psystock']]);
			$itemGroups[$item['psystock']]['wh_id'] = intval($wh_id);
			$itemGroups[$item['psystock']]['cross_stock'] = $itemGroups[$item['psystock']]['wh_id'] !== $itemGroups[$item['psystock']]['stock_wh_id'] ? 1 : 0;
		}

		//分摊促销规则在各个子订单的分摊金额
		if (isset($promotion['benefit_type']) && $promotion['benefits'] > 0) {
			$last = 0;
			ksort($itemGroups);
			$remain = $promotion['benefits'];
			foreach($itemGroups as $subKey => $subOrder) {
				if (isset($subOrder['rule_total_amt'])) {
					$tmp =  10 * bcdiv($subOrder['rule_total_amt'] * $promotion['benefits']  , $rule_total_amt * 10 , 0);
					$itemGroups[$subKey]['rule_benefits'] = $tmp;
					$remain -= $tmp;
					$last = $subKey;
				}
				else {
					$itemGroups[$subKey]['rule_benefits'] = 0;
				}
			}
			if (0 != $remain) {
				$itemGroups[$last]['rule_benefits'] += $remain;
			}
		}
		else { //都返回 rule_benefits 字段, 方便前台计算
			foreach($itemGroups as $subKey => $subOrder)
				$itemGroups[$subKey]['rule_benefits'] = 0;
			}

		if (!empty($matchPids)) {
			//ixiuzeng添加，广东站的随心配从广东站获取，上海和北京的随心配依然从上海获取
			$wh_id_temp = null;
			if (1001 == $wh_id) {
				$wh_id_temp = 1001;
			}
			else {
				$wh_id_temp = 1;
			}

			$matchItems = IProductRelativityTTC::gets($matchPids, array('type'=>PRODUCT_BY_MIND, 'status'=>1, 'wh_id'=>$wh_id_temp));
			if (is_array($matchItems) && count($matchItems) > 0) {
				foreach ($items as &$it) {
					if ($it['main_product_id'] == 0 ) {
						continue;
					}
					foreach ($matchItems as $mait) {
						if ($it['main_product_id'] == $mait['product_id'] && $it['product_id'] == $mait['relative_id'] && $mait['type'] == PRODUCT_BY_MIND) {
							$itemGroups[$it['psystock']]['items'][$it['product_id']]['priceCutByMatch'] =  intval($mait['property']);
							$totalCut += $it['matchNum'] * $itemGroups[$it['psystock']]['items'][$it['product_id']]['priceCutByMatch'];
							$itemGroups[$it['psystock']]['totalCut'] += $it['matchNum'] * $itemGroups[$it['psystock']]['items'][$it['product_id']]['priceCutByMatch'];
							break;
						}
					}
				}
			}
		}

		//拉取商品三级分类，判断是否能模糊开票
		$isCanFuzzyInvoice = true;
		$avaiableInvoices = array (
			'isCanVAT' => $isCanVATInvoice,
			'hasNoteBook'=>0,
			'contentOpt' => array('商品明细'),
		);

		//如果购物车中有笔记本类商品，需要提示以公司开普通发票，无法保修
		if (in_array(234, $c3ids)) {
			$avaiableInvoices['hasNoteBook'] = 1;
		}
		if ($wh_id == 1 || $wh_id == 2001) {
			$c3Info = ICategoryTTC::gets($c3ids, array('level'=>3, 'status'=>0), array('parent_id', 'flag'));

			if (is_array($c3Info)) {
				$c2ids = array();
				foreach ($c3Info as $c3) {
					if (($c3['flag'] & FUZZY_INVOICE) != FUZZY_INVOICE) { //不可以模糊开票
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
						foreach ($c2Info as $c2) {
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
//		if (!empty($limitedProduct)) {
//			global $_OrderState;
//			$timestamp = mktime(0,0,0,date('m'), date('d'), date('Y') );
//
//			$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
//
//			$sql = "SELECT product_id,
//									sum(buy_num) as buy_num
//						FROM t_order_items_{$db_tab_index['table']} ot, t_orders_{$db_tab_index['table']} o
//						WHERE o.order_char_id = ot.order_char_id
//							AND o.status <> {$_OrderState['ManagerCancel']['value']}
//							AND o.status <> {$_OrderState['CustomerCancel']['value']}
//							AND o.status <> {$_OrderState['EmployeeCancel']['value']}
//							AND ot.uid = {$uid}
//							AND create_time > {$timestamp}
//							AND product_id in(" . implode(',', $limitedProduct) . ")
//				GROUP BY product_id";
//
//			$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
//			$userOrder = $orderDb->getRows($sql);
//			if (false === $userOrder) {
//				self::$errCode = $orderDb->errCode;
//				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query order db failed]' . $orderDb->errMsg;
//				return false;
//			}
//
//			if (!empty($userOrder)) {
//				self::$errMsg = "您购买的";
//				foreach ($userOrder as $order) {
//					foreach ($items as $item) {
//						if ($item['product_id'] == $order['product_id']) {
//							if ($item['buy_count'] + $order['buy_num'] > $item['num_limit']) {
//								self::$errCode = 999;
//								self::$errMsg .= $item['name'] . "限购{$item['num_limit']}件，您今日已购{$order['buy_num']}件;";
//							}
//							break;
//						}
//					}
//					self::$errMsg .= "请您返回购物车修改购买数量";
//				}
//			}
//		}
//
//		//检查限购完毕
//		if (self::$errCode === 999) {
//			return false;
//		}

		//检查三大件兼容情况
		/*'
			$result[] = array(
								'pid1' => $val['product_id'],
								'pName1'=> $val['product_name'],
								'pid2' => $val2['product_id'],
								'pName2' => $val2['product_name'],
							)
		*/

		//拉取用户是否属于特殊用户
		if (empty($userInfo)) {
			$userInfo = IUsersTTC::get($uid,array(), array('email', 'mobile', 'level', 'type'));
			if (isset($userInfo[0])) {
				$userInfo = $userInfo[0];
			}
		}

		return array (
						'invoice' => &$avaiableInvoices,
						'items' => &$itemGroups,
						'totalCut' => $totalCut,
						'totalAmt' => $totalAmt,
						'totalWeight' => $totalWeight,
						'conflictProducts'=>IDIYInfo::checkProductsMatch($itemsForConflit),
						'promotion' => '',
						'promoCoupon' => '',
						'userIsDealer' => isset($userInfo['type']) ? ($userInfo['type'] == USER_IS_DEALER) : false,
					);
	}

	/**
	 * 分销默认为易迅快递
	*/
	public static function getShippingTypeByDestination($destination, $isVirtual = array(), $orderWeight = array(), $wh_id = 1) {
		$shippingType = 1;
		return $shippingType;
	}

	/**
	 * 根据配送方式（分站ID，商品ID，用户类型）获取支付方式
	 * @param int $shippingType 指定的配送方式
	 * @param int $wh_id 分站ID
	 * @param array $productidArr 商品ID数组
	 * @param string $userType 用户类型
	 * @return mixed false 失败；array 成功
	 * 分销默认为货到付款
	 */
	public static function getPayTypeByShippingType($shippingType , $wh_id=1, $productidArr = array(), $userType=false) {
	    $result = 1;

		return  $result;
	}

	// 多分仓版的限运逻辑
	public static function getForbidenShippingType($forbidenShipArr, $province, $city, $district, $wh_id=1)
	{
		if (empty($forbidenShipArr)) {
			return array();
		}
		global $_LGT_MODE;

		$shipNotAva = array();

		foreach($forbidenShipArr as $ship=>$products)
		{
			if ($wh_id == SITE_SH)
			{
				if ($ship == 4)
				{
					//仅限易迅快递
					foreach($_LGT_MODE as $l)
					{
						// 45为全峰快递
						if ($l['SysNo'] != ICSON_DELIVERY && $l['SysNo'] != ICSON_DELIVERY_QF )
						{
							if (!isset($shipNotAva[$l['SysNo']]))
							{
								$shipNotAva[$l['SysNo']] = array();
							}
							$shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
						}
					}
				}
				else if ($ship == 5)
				{
					//EMS限运、航空限运

					foreach($_LGT_MODE as $l)
					{
						if ($l['SysNo'] != ICSON_DELIVERY
						 && $l['SysNo'] != YT_DELIVERY
						 && $l['SysNo'] != SELF_DELIVERY_SH
						 && $l['SysNo'] != ICSON_DELIVERY_QF)
						{
							if (!isset($shipNotAva[$l['SysNo']])) {
								$shipNotAva[$l['SysNo']] = array();
							}
							$shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
						}
					}

					// 如果不在下列区域，是不能使用圆通快递的
					$dis_array = array(131,201,403,814,1323,1454,1591,2329,2621,1718,1,1144,2490,3225);
					if (!in_array($province, $dis_array))
					{
						if (!isset($shipNotAva[YT_DELIVERY])) {
							$shipNotAva[YT_DELIVERY] = array();
						}
						$shipNotAva[YT_DELIVERY] = array_merge($shipNotAva[YT_DELIVERY], $products);
					}
				}
				else if ($ship == 6)
				{
					//江浙沪皖以外区域无法配送
					$dis_array = array(1, 1591, 3225, 2621);
					foreach($_LGT_MODE as $l) {
						if (!in_array($province, $dis_array)) {
							if (!isset($shipNotAva[$l['SysNo']])) {
								$shipNotAva[$l['SysNo']] = array();
							}
							$shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
						}
					}
				}
				else if ($ship == 8)
				{
					//易迅快递无法配送
					if (!isset($shipNotAva[ICSON_DELIVERY])) {
						$shipNotAva[ICSON_DELIVERY] = array();
					}
					$shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);

					if (!isset($shipNotAva[ICSON_DELIVERY_QF])) {
						$shipNotAva[ICSON_DELIVERY_QF] = array();
					}
					$shipNotAva[ICSON_DELIVERY_QF] = array_merge($shipNotAva[ICSON_DELIVERY_QF], $products);

				}
				else if ($ship == 10)
				{
					//仅限上海自提
					foreach($_LGT_MODE as $l) {
						if ($l['SysNo'] != SELF_DELIVERY_SH) {
							if (!isset($shipNotAva[$l['SysNo']])) {
								$shipNotAva[$l['SysNo']] = array();
							}
							$shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
						}
					}
				}
				else if ($ship == 11)
				{
					//仅限上海易迅快递
					foreach($_LGT_MODE as $l)
					{
						if ( $l['SysNo'] != ICSON_DELIVERY )
						{
							if (!isset($shipNotAva[$l['SysNo']]))
							{
								$shipNotAva[$l['SysNo']] = array();
							}
							$shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
						}
					}

					if (!in_array($province, array(2621)))
					{
						if (!isset($shipNotAva[ICSON_DELIVERY]))
						{
							$shipNotAva[ICSON_DELIVERY] = array();
						}
						$shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);
					}
				}
				else if ($ship == 19)
				{
					//仅限上海易迅快递、苏州易迅快递
					$dis_array = array(1693, 1694, 3485, 3696, 3486, 1695, 1697);
					foreach($_LGT_MODE as $l)
					{
						if ( $l['SysNo'] != ICSON_DELIVERY )
						{
							if (!isset($shipNotAva[$l['SysNo']])) {
								$shipNotAva[$l['SysNo']] = array();
							}
							$shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
						}
					}

					if (!in_array($province, array(2621)) && !in_array($district, $dis_array))
					{
						if (!isset($shipNotAva[ICSON_DELIVERY])) {
							$shipNotAva[ICSON_DELIVERY] = array();
						}
						$shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);
					}
				}
				else if (24 == $ship) //仅限上海易迅快递外环以内
				{
					foreach($_LGT_MODE as $l)
					{
						if ($l['SysNo'] != ICSON_DELIVERY)
						{
							if (!isset($shipNotAva[$l['SysNo']])) {
								$shipNotAva[$l['SysNo']] = array();
							}
							$shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
						}
					}

					$dis_array = array(3329, 3333, 2624, 2625, 2626, 2627, 2628, 2629, 2630, 2631, 2632, 2633, 2637, 2638, 3525);
					if (!in_array($district, $dis_array))
					{
						if (!isset($shipNotAva[ICSON_DELIVERY])) {
							$shipNotAva[ICSON_DELIVERY] = array();
						}
						$shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);
					}
				}
			}
			//以下深圳有效
			else if ($wh_id == SITE_SZ)
			{
				if ($ship == 13) { //普通快递无法配送,不能使用配送方式（圆通快递，申通快递）
					if (!isset($shipNotAva[YT_DELIVERY])) {
						$shipNotAva[YT_DELIVERY] = array();
					}
					$shipNotAva[YT_DELIVERY] = array_merge($shipNotAva[YT_DELIVERY], $products);
				}
				else if ($ship == 14)
				{
					//仅限易迅快递
					foreach($_LGT_MODE as $l)
					{
						if ($l['SysNo'] != ICSON_DELIVERY && $l['SysNo'] != ICSON_DELIVERY_QF)
						{
							if (!isset($shipNotAva[$l['SysNo']])) {
								$shipNotAva[$l['SysNo']] = array();
							}
							$shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
						}
					}
				}
				else if ($ship == 15)
				{
					//易迅快递无法配送
					if (!isset($shipNotAva[ICSON_DELIVERY])) {
						$shipNotAva[ICSON_DELIVERY] = array();
					}
					@$shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);

					//易迅全峰快递无法配送
					if (!isset($shipNotAva[ICSON_DELIVERY_QF])) {
						$shipNotAva[ICSON_DELIVERY_QF] = array();
					}
					@$shipNotAva[ICSON_DELIVERY_QF] = array_merge($shipNotAva[ICSON_DELIVERY_QF], $products);
				}
				else if ($ship == 16)
				{
					//深圳邮政EMS无法配送
					if (!isset($shipNotAva[EMS_DELIVERY])) {
						$shipNotAva[EMS_DELIVERY] = array();
					}
					@$shipNotAva[EMS_DELIVERY] = array_merge($shipNotAva[EMS_DELIVERY], $products);
				}
				else if ($ship == 18)
				{

					//EMS限运、航空限运
					foreach($_LGT_MODE as $l)
					{

						if ($l['SysNo'] != ICSON_DELIVERY && $l['SysNo'] != ICSON_DELIVERY_QF && $l['SysNo'] != YT_DELIVERY)
						{
							if (!isset($shipNotAva[$l['SysNo']])) {
								$shipNotAva[$l['SysNo']] = array();
							}
							$shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
						}
					}

					$prov_array = array(131, 201, 403, 814, 1323, 1454, 1591, 2329, 2621, 1718, 1, 1144, 2490, 3225);
					if( !in_array($province,$prov_array) )
					{
						if (!isset($shipNotAva[7])) {
							$shipNotAva[7] = array();
						}
						$shipNotAva[7] = array_merge($shipNotAva[7], $products);
					}

				}
				//ixiuzeng添加增加23号限运逻辑
				else if (23 == $ship)
				{
					foreach($_LGT_MODE as $l)
					{
						if ($l['SysNo'] != ICSON_DELIVERY )
						{
							if (!isset($shipNotAva[$l['SysNo']])) {
								$shipNotAva[$l['SysNo']] = array();
							}
							$shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
						}
					}

					if( !in_array($city,array(420)) )
					{
						//易迅快递无法配送
						if (!isset($shipNotAva[ICSON_DELIVERY])) {
							$shipNotAva[ICSON_DELIVERY] = array();
						}
						@$shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);
						}
					}
				}

			//以下北京有效
			else if ($wh_id == SITE_BJ)
			{
				if ($ship == 20)
				{
					//北京易迅快递无法配送
					if (!isset($shipNotAva[ICSON_DELIVERY])) {
						$shipNotAva[ICSON_DELIVERY] = array();
					}
					@$shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);
				}
				else if ($ship == 21)
				{
					//EMS限运、航空限运
					foreach($_LGT_MODE as $l)
					{
						if ($l['SysNo'] != ICSON_DELIVERY && $l['SysNo'] != ICSON_DELIVERY_QF && $l['SysNo'] != YT_DELIVERY )
						{
							if (!isset($shipNotAva[$l['SysNo']])) {
								$shipNotAva[$l['SysNo']] = array();
							}
							$shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
						}
					}

					$prov_array = array(131, 201, 403, 814, 1323, 1454, 1591, 2329, 2621, 1718, 1, 1144, 2490, 3225);
					if(!in_array($province, $prov_array))
					{
						if (!isset($shipNotAva[YT_DELIVERY])) {
							$shipNotAva[YT_DELIVERY] = array();
						}
						$shipNotAva[YT_DELIVERY] = array_merge($shipNotAva[YT_DELIVERY], $products);
					}
				}
				else if ($ship == 22)
				{
					//仅限北京易迅快递
					foreach($_LGT_MODE as $l)
					{
						if ($l['SysNo'] != ICSON_DELIVERY) {
							if (!isset($shipNotAva[$l['SysNo']])) {
								$shipNotAva[$l['SysNo']] = array();
							}
							$shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
						}
					}

					if (!in_array($province, array(131)))
					{
						if (!isset($shipNotAva[ICSON_DELIVERY])) {
							$shipNotAva[ICSON_DELIVERY] = array();
						}
						$shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);
					}
				}
			}

			else if( $wh_id == SITE_CQ )
			{
				if($ship == 25)
				{
					// 重庆易迅快递无法配送
					if (!isset($shipNotAva[ICSON_DELIVERY])) {
						$shipNotAva[ICSON_DELIVERY] = array();
					}
					@$shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);

					if (!isset($shipNotAva[ICSON_DELIVERY_QF])) {
						$shipNotAva[ICSON_DELIVERY_QF] = array();
					}
					@$shipNotAva[ICSON_DELIVERY_QF] = array_merge($shipNotAva[ICSON_DELIVERY_QF], $products);
				}
				else if($ship == 26)
				{
					//EMS限运、航空限运
					foreach($_LGT_MODE as $l)
					{
						if ($l['SysNo'] != ICSON_DELIVERY && $l['SysNo'] != ICSON_DELIVERY_QF && $l['SysNo'] != YT_DELIVERY )
						{
							if (!isset($shipNotAva[$l['SysNo']])) {
								$shipNotAva[$l['SysNo']] = array();
							}
							$shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
						}
					}

					$prov_array = array(131, 201, 403, 814, 1323, 1454, 1591, 2329, 2621, 1718, 1, 1144, 2490, 3225, 2652, 158);
					if(!in_array($province, $prov_array))
					{
						if (!isset($shipNotAva[YT_DELIVERY])) {
							$shipNotAva[YT_DELIVERY] = array();
						}
						$shipNotAva[YT_DELIVERY] = array_merge($shipNotAva[YT_DELIVERY], $products);
					}
				}
				else if($ship == 27)
				{
					// 仅限重庆易迅快递
					foreach($_LGT_MODE as $l)
					{
						if ($l['SysNo'] != ICSON_DELIVERY)
						{
							if (!isset($shipNotAva[$l['SysNo']])) {
								$shipNotAva[$l['SysNo']] = array();
							}
							$shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
						}
					}

					if (!in_array($province, array(158)))
					{
						if (!isset($shipNotAva[ICSON_DELIVERY]))
						{
							$shipNotAva[ICSON_DELIVERY] = array();
						}
						$shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);
					}
				}
				else if($ship == 28)
				{
					// 仅限易迅快递
					foreach($_LGT_MODE as $l)
					{
						if ( $l['SysNo'] != ICSON_DELIVERY  && $l['SysNo'] != ICSON_DELIVERY_QF )
						{
							if (!isset($shipNotAva[$l['SysNo']])) {
								$shipNotAva[$l['SysNo']] = array();
							}
							$shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
						}
					}

				}
			}
		}

		foreach($shipNotAva as $key=> $value) {
			$shipNotAva[$key] = array_unique($value);
		}
		return $shipNotAva;

	}

    public static function add($newOrder_,$wh_id=1){
    
    	$newOrder = $newOrder_;
        //分销不使用优惠券与促销规则
        $newOrder['rule_id'] = '';
        $newOrder['couponCode'] = ''; 

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

        $limitState = @IShippingTime::getOrderLimitState($wh_id);
        if (false === $limitState){
            self::$errCode = IShippingTime::$errCode;
            self::$errMsg = IShippingTime::$errMsg;
            return false;
        }
        if ($limitState['day_limit'] == 1) {
            return array('errCode'=>-1, 'errMsg'=>'对不起，今日订单已经超过最大数量，请明天再下订单');
        }
        //参数收货地址
        if (false === IOrder::checkReceiverAddr($newOrder)) {
           return array('errCode'=>-1001, 'errMsg'=>IOrder::$errMsg);
        }
        //foreach ($newOrder['suborders'])
        
        //检查发票
        if (false === IOrder::checkInvoice($newOrder)) {
           return array('errCode'=>-1002, 'errMsg'=>'发票信息未确认，请联系客服');
        }

        return self::preCheckShippingCart($newOrder, $wh_id);
    }
    
    /**
     * 入预订单库前先进行一次订单检查， 待订单被分销商审核通过后，需再次检查
     */
    public static function preCheckShippingCart(&$newOrder, $wh_id = 1)
    { 
    	
        if (isset($newOrder['comment']) && strlen($newOrder['comment']) > 800) {
            return array('errCode'=>10, 'errMsg'=>"您填写的订单备注过长，请返回修改！");
        }
        if (!isset($newOrder['suborders']) || !is_array($newOrder['suborders'])) {
            return array('errCode'=>10, 'errMsg'=>"您的购物车中没有商品，请选购！");
        }
       
        $userInfo = IRetailer::getRetailers(array('uid'=>$newOrder['uid']));
        if (false === $userInfo || !isset($userInfo[0]))
        {
            self::$errCode = IUsersTTC::$errCode;
            self::$errMsg = IUsersTTC::$errMsg;
            return false;
        }
        $userInfo = current($userInfo);
        
        $itemsInShoppingCart = array();
        $i = 0;

        $isShopGuide = (isset($newOrder['shopGuideId']) && !empty($newOrder['shopGuideId'])) ? true : false;

        if (true === $isShopGuide)  //如果是IPad分销导购，从suborders中取商品
        {
            reset($newOrder['suborders']);
            while (FALSE !== ($node = current($newOrder['suborders']))) {
                if (!isset($node['items'])) {
                    return array('errCode'=>10, 'errMsg'=>"您提交的订单数据有误，请检查！");
                }

                foreach ($node['items'] as $it) {
                    $itemsInShoppingCart[$i]['product_id'] = $it['product_id'];
                    $itemsInShoppingCart[$i]['buy_count'] = $it['num'];
                    $itemsInShoppingCart[$i]['main_product_id'] = 0;
                    $itemsInShoppingCart[$i]['OTag'] = '';
                    $i++;
                }
                next($newOrder['suborders']);
            }
        }
        else {
            //获取购物车中商品列表
            $itemsInShoppingCart = IBShoppingCartTTC::get($newOrder['uid']);
            if( false === $itemsInShoppingCart )
            {
                self::$errCode = 11;
                self::$errMsg = "uid({$newOrder['uid']}) IBShoppingCartTTC::get failed";
                return array('errCode'=>self::$errCode, 'errMsg'=>"您的购物车中没有商品，请选购！");
            }
        }

        if (count($itemsInShoppingCart) == 0) {
            return array('errCode'=>10, 'errMsg'=>"您的购物车中没有商品，请选购！");
        }
        
        reset($newOrder['suborders']);
        $countPost = 0;
        while (FALSE != ($node = current($newOrder['suborders'])))
        {
            if (!isset($node['items'])) {
                return array('errCode'=>10, 'errMsg'=>"您提交的订单数据有误，请检查！");
            }
            $countPost += count($node['items']);
            next($newOrder['suborders']);
        }
        //判断购物车中商品与前台展示的商品种类是一致的
        if (count($itemsInShoppingCart) != $countPost) {
            self::$errCode = -2021;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "items count in shoppingcart is not equal to post items count";
            return false;
        }
        $product_in_cart = array();

        foreach ($itemsInShoppingCart as $item) {
            $product_in_cart[] = $item['product_id'];
        }

        $product_base_info = IProduct::getProductsInfo($product_in_cart, $wh_id, true, true);
        if (false === $product_base_info) {
            self::$errCode = IProduct::$errCode;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProduct failed]' . IProduct::$errMsg;
            return false;
        }
        //处理分销价
        $dPrice = IBProduct::getProductDistributionPrice($newOrder['uid'], $product_in_cart);
        if (false === $dPrice)
        {
            self::$errCode = IBProduct::$errCode;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[invoke IBProduct::getProductDistributionPrice() failed]' . IBProduct::$errMsg;

            return false;
        }
        if ($isShopGuide)
        {
            $sPrice = IBProduct::getMarketPrice($newOrder['uid'], $product_in_cart);
	        if (false === $sPrice)
	        {
	            self::$errCode = IBProduct::$errCode;
	            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[invoke IBProduct::getMarketPrice() failed]' . IBProduct::$errMsg;
	
	            return false;
	        }
        }
        
        foreach($newOrder['suborders'] as $key=>$suborder)
        {
        	$ship = IShippingTime::getShipTimeList($wh_id, $key, $newOrder['receiveAddrId']);
            if (false === $ship)
            {
                 self::$errCode = '-2006';
                 self::$errMsg = "默认易迅快递不支持此区域，请重新选择门店";
                
                 return false;
            }
            $ship = current($ship);
            $newOrder['suborders'][$key]['shipPrice'] = 0;
            $newOrder['suborders'][$key]['expectDate'] = date("Y-m-d",strtotime("+1 day"));
            $newOrder['suborders'][$key]['expectSpan'] = 1;
 
             foreach($suborder['items'] as $product)
             {
                 foreach($product_base_info as $p)
                 {
                     if($p['product_id'] == $product['product_id'])
                     {
                         $product_base_info[$p['product_id']]['price'] = $dPrice[$p['product_id']];
                         $product_base_info[$p['product_id']]['shopPrice'] = $isShopGuide ? $sPrice[$p['product_id']] : 0;
                     }
                 }
             }
        }

        //检查前台传入的商品列表 与 购物车中商品列表是否一致 , 同时检查商品，赠品，组件的状态，禁运类型
        $restricted_trans_type = array();
        $shoppingProduct = array();
        $productInShoppingCart = array();

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
                            return array('errCode'=>-1, 'errMsg'=>"购物车中商品" . $product_base_info[$item['product_id']]['name'] . "订购数量不正确，请返回购物车修改数量");
                         }//商品基本信息不存在
                         else if (!isset($product_base_info[$orderItem['product_id']])) {
                            return array('errCode'=>-2, 'errMsg'=>"购物车中商品" . $product_base_info[$item['product_id']]['name'] . "暂不销售，请返回购物车删除");
                         }//商品状态不合法
                         else if ( isset($product_base_info[$orderItem['product_id']]['status']) && $product_base_info[$orderItem['product_id']]['status'] != PRODUCT_STATUS_NORMAL /*&& true != $itemInCart['isPromotionGift'] */) {
                            return array('errCode'=>-3, 'errMsg'=>"购物车中商品" . $product_base_info[$item['product_id']]['name'] . "暂不销售，请返回购物车删除");
                         }
//                         else if ($product_base_info[$orderItem['product_id']]['psystock'] != $subOrderKey) {
//                            return array('errCode'=>-3, 'errMsg'=>"购物车中商品" . $product_base_info[$item['product_id']]['name'] . "信息已经改变，请刷新页面");
//                         }
                         else
                         {
                            $shoppingProduct[$subOrderKey][$itemInCart['product_id']]['product_id'] = $itemInCart['product_id'];
                            $shoppingProduct[$subOrderKey][$itemInCart['product_id']]['OTag'] = $itemInCart['OTag'];
                            @$shoppingProduct[$subOrderKey][$itemInCart['product_id']]['buy_count'] += $itemInCart['buy_count'];
                            $shoppingProduct[$subOrderKey][$itemInCart['product_id']]['main_product_id'] = $itemInCart['main_product_id'];
                            $shoppingProduct[$subOrderKey][$itemInCart['product_id']]['type'] = SHOPPING_CART_PRODUCT_TYPE_NORMAL;
                            @$restricted_trans_type[$product_base_info[$orderItem['product_id']]['restricted_trans_type']][] = $orderItem['product_id'];//$product_base_info[$orderItem['product_id']]['restricted_trans_type'];

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
                    return array('errCode'=>-4, 'errMsg'=>"购物车中商品" .
                                 (isset($product_base_info[$orderItem['product_id']])? $product_base_info[$orderItem['product_id']]['name'] : $orderItem['product_id'])
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
                            $shoppingProduct[$subOrderKey][$g_p_id]['type'] = SHOPPING_CART_PRODUCT_TYPE_ZUJIAN ;
                        }else
                        {
                            $shoppingProduct[$subOrderKey][$g_p_id]['type'] = SHOPPING_CART_PRODUCT_TYPE_GIFT ;
                        }
                        @$restricted_trans_type[$product_base_info[$orderItem['product_id']]['gifts'][$g_p_id]['restricted_trans_type']][] = $g_p_id;// = $product_base_info[$gift['gift_id']]['restricted_trans_type'];
                        $exist = true;
                        $productInShoppingCart[] = $g_p_id;
                    }
                }
            }
        }
        
       
        //开始检查库存
        $msSQL = ToolUtil::getMSDBObj('Inventory_Manager');
        if (empty($msSQL)) {
            self::$errCode = Config::$errCode;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "query ms sql faild " . Config::$errMsg;
            return false;
        }

        $sql = "select SysNo, ProductSysNo, StockSysNo, AvailableQty, VirtualQty, OrderQty from Inventory_Stock where ProductSysNo in (" . implode(",", $productInShoppingCart) . ")";
        $sqlforlog = $sql;
        $productStocks = $msSQL->getRows($sql);
        if (false === $productStocks) {
            self::$errCode = $msSQL->errCode;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "query ms sql faild " . $msSQL->errMsg;
            return false;
        }

        $giftLackOfStock = array();
        $lackGiftAndIgnore = false;
        $containVirtual = array();
        $easyKey =array();

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
                                IInventoryStockTTC::update(array('product_id'=>$sp['product_id'], 'num_available'=>$pstock['AvailableQty'], 'virtual_num'=> $pstock['VirtualQty']), array('sys_no'=>$pstock['SysNo']));
                                if (!isset($newOrder['ingoreLackOfGift'])) { //如果第一次提交订单
                                    $giftLackOfStock[$sp['product_id']] = $product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name'];
                                }else if ($newOrder['ingoreLackOfGift'] == 1) { //用户接受缺少礼品
                                    $shoppingProduct[$subOrderKey][$kk]['buy_count'] = $pstock['AvailableQty'] + $pstock['VirtualQty'];
                                    if ($shoppingProduct[$subOrderKey][$kk]['buy_count'] <= 0) {
                                        unset($shoppingProduct[$subOrderKey][$kk]);
                                    }
                                    $lackGiftAndIgnore = true;
                                }else //用户不接受，则拒绝下单
                                {
                                    return array('errCode'=>-13, 'errMsg'=>'赠品'.$product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name']."库存不足");
                                }
                            }
                        }else if ($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_ZUJIAN) {
                            if ($pstock['AvailableQty'] + $pstock['VirtualQty'] < $sp['buy_count']) {
                                return array('errCode'=>-15, 'errMsg'=>'组件'.$product_base_info[$sp['belongto_product_id']]['gifts'][$sp['product_id']]['name']."库存不足,请联系客服");
                            }
                        }else//主商品
                        {
                            if ($pstock['AvailableQty'] < $sp['buy_count']){
                                $containVirtual[$subOrderKey] = true;
                            }
                            if (($pstock['AvailableQty'] + $pstock['VirtualQty'] < $sp['buy_count']) &&
                                (( $wh_id != 1) || ($product_base_info[$sp['product_id']]['flag'] & FORBID_SET_VIRTUAL) == FORBID_SET_VIRTUAL ||
                                 $product_base_info[$sp['product_id']]['type'] != PRODUCT_TYPE_NORMAL)
                                ) {
                                    return array('errCode'=>-15, 'errMsg'=>'商品'.$product_base_info[$sp['product_id']]['name']."库存不足");
                            }
                        }
                        $product_base_info[$sp['product_id']]['AvailableQty'] = $pstock['AvailableQty'];
                        $product_base_info[$sp['product_id']]['VirtualQty'] = $pstock['VirtualQty'];
                        break;
                    }
                }
                if (false === $exist) {
                        return array('errCode'=>-16, 'errMsg'=>'商品'.$product_base_info[$sp['product_id']]['name']."暂不销售");
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
        if ($lackGiftAndIgnore){
            $newOrder['comment'] .= "\n系统自动备注：用户已接受缺货赠品库存不足。";
        }
   
        //计算价格
        $orderPrice = 0;
        $totalWeight = 0;
        $totalCut = 0;

        global $_ProductType;
        $subOrders = array();

        foreach ($shoppingProduct as $subOrderKey => $subOrderItem) {
            foreach ($subOrderItem as $sp) {
                $subOrders[$subOrderKey]['product_ids'][] = $sp['product_id']; //clark 记录商品ID

                $totalWeight += $sp['buy_count'] * $product_base_info[$sp['product_id']]['weight'];
                @$subOrders[$subOrderKey]['totalWeight'] += $sp['buy_count'] * $product_base_info[$sp['product_id']]['weight'];

                if (!isset($subOrders[$subOrderKey]['flag'])) {
                    $subOrders[$subOrderKey]['flag'] = 0;
                }

                if ($product_base_info[$sp['product_id']]['type'] == $_ProductType['Service']) {
                    $subOrders[$subOrderKey]['flag'] |= ORDER_HAS_SERVICE;   //记录订单中是否有服务类商品
                }

                if (isset($userInfo['RetailerType'])) {
                    global $_USER_TYPE;
                    if ($_USER_TYPE['EnterpriseUser'] == $userInfo['RetailerType']) {
                        $subOrders[$subOrderKey]['flag'] |= ORDER_ENTERPRISE_USER;
                    }
                    else if ($_USER_TYPE['ChaohuoUser'] == $userInfo['RetailerType'])
                    {
                        $subOrders[$subOrderKey]['flag'] |= ORDER_CHAOHUO_USER;
                    }else if ($_USER_TYPE['WholeSalerUser'] == $userInfo['RetailerType'])
                    {
                        $subOrders[$subOrderKey]['flag'] |= ORDER_WHOLESALER_USER;
                    }else if ($_USER_TYPE['RetailersUser'] == $userInfo['RetailerType'])
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
                

            }
        }
        foreach ($subOrders as $subOrderKey => $so) {
            $subOrders[$subOrderKey]['orderShipPrice'] = 0;
        }
        if ($newOrder['payType'] == 1) { //货到付款抹去分
            $orderPrice = 0;
            foreach ($subOrders as $subOrderKey => $so) {
                $subOrders[$subOrderKey]['orderPrice'] = 10 * bcdiv($subOrders[$subOrderKey]['orderPrice'], 10 , 0);
                $orderPrice += $subOrders[$subOrderKey]['orderPrice'];
            }
        }

        if (bccomp($orderPrice, $newOrder['Price'], 0) != 0) {
        	
            self::$errCode = -2031;
            self::$errMsg='计算的订单价格与前台订单价格不一致';
            return false;
        }

        foreach ($subOrders as $subOrderKey=>$so) {
            if (bccomp($so['orderPrice'], $newOrder['suborders'][$subOrderKey]['price'], 0) != 0) {  
                self::$errCode = -2030;
                self::$errMsg='计算的订单价格与前台订单价格不一致';
                return false;
            }
        }       
        
        $itemCount = 0;
        foreach ($shoppingProduct as $key => $subOrderItem) {
            foreach ($subOrderItem as $sp) {
                $itemCount++;
                if ($sp['type'] != SHOPPING_CART_PRODUCT_TYPE_NORMAL || $sp['main_product_id'] == 0) {
                    continue;
                }
            }
        }
        
        $limitOrder = IShippingTime::getOrderLimitState($wh_id);
        //如果可以采用易迅快递，校验送货时间
        if ( ICSON_DELIVERY == $newOrder['shipType'] ) {
            $icson_delivery_info = IShipping::getIcsonDeliveryInfoByRegion($newOrder['receiveAddrId'],$wh_id);
            if ( false === $icson_delivery_info ) {
                self::$errMsg = IShipping::$errMsg;
                return false;
            }
            $destination = $newOrder['receiveAddrId'];
            foreach ($shoppingProduct as $subOrderKey=>$subOrderItem) {
                $old_delivery_time = $icson_delivery_info['delivery_time'];
                if ($wh_id == SITE_SH && $subOrderKey == 5) {
                    //如果是上海的大件仓，则直接规定是一日一送的逻辑
                    $icson_delivery_info['delivery_time'] = 1;
                }

                // 发货仓号
                $icson_delivery_info['stock_num'] = $subOrderKey;
                $v = isset($containVirtual[$subOrderKey]) ? $containVirtual[$subOrderKey] : false;
               
                $timeAvaiable = @IShippingTime::getShipTimeListIcson($icson_delivery_info, $wh_id, $destination, $v, $limitOrder['am_limit'], $limitOrder['day_limit']);
                $icson_delivery_info['delivery_time'] = $old_delivery_time;

                if ( !is_array($timeAvaiable) || count($timeAvaiable) == 0) {
                    self::$errCode = -987;
                    self::$errMsg = "verify get expect dly date failed, Error:".IShippingTime::$errMsg;
                    return false;
                }
                else {
                    $timeAvaiable = $timeAvaiable[0];
                    $date = substr($timeAvaiable['name'], 0, 11);
                    if (strtotime($date) > strtotime($newOrder['suborders'][$subOrderKey]['expectDate'])
                        || ( isset($timeAvaiable['time_span'] )
                        && strtotime($date) == strtotime($newOrder['suborders'][$subOrderKey]['expectDate'])
                        && $timeAvaiable['time_span'] > $newOrder['suborders'][$subOrderKey]['expectSpan'])) {

                        return array('errCode'=>-11, 'errMsg'=>"您选择的期望配送时间不正确，请重新选择" );
                    }
                }
            }
        }
        
        
        
        //获取订单商品的seqid
        $itemStartID = IIdGenerator::getNewId('pre_item_sequence', $itemCount);
        if (false === $itemStartID) {
            self::$errCode = -2047;
            self::$errMsg='获取订单商品id失败' . IIdGenerator::$errMsg;
            return false;
        }
        //处理单引号等特殊字符
        foreach ($newOrder as $k => $no) {
            if ($k == 'suborders' || $k == 'buy_one_key') {
                continue;
            }
            $newOrder[$k] = addslashes($no);
        }
 
        if ($newOrder['invoiceType'] != INVOICE_TYPE_VAT)
        {
            $newOrder['invoiceCompanyName'] = '';
            $newOrder['invoiceCompanyAddr'] = '';
            $newOrder['invoiceCompanyTel'] = '';
            $newOrder['invoiceTaxno'] = '';
            $newOrder['invoiceBankNo'] = '';
            $newOrder['invoiceBankName'] = '';

            if(0 == $newOrder['isVat']) //如果不需要开发票，那么其他字段也置为空
            {
                $newOrder['invoiceType'] = '';
                $newOrder['invoiceTitle'] = '';
                $newOrder['invoiceContent'] = '';
            }
        }
        else
        {
            $newOrder['invoiceTitle'] = $newOrder['invoiceCompanyName'];
        }
      
        //插入预订单库
        $orderNum = count($subOrders);
        if ($orderNum > 1) {
            $newOrderId = IIdGenerator::getNewId('border_sequence', $orderNum + 1);
        }
        else {
            $newOrderId = IIdGenerator::getNewId('border_sequence', $orderNum);
        }
        if (false === $newOrderId || $newOrderId <= 0) {
            self::$errCode = IIdGenerator::$errCode;
            self::$errMsg = IIdGenerator::$errMsg;
            return false;
        }

        $oid = sprintf("%s%09d", "1", $newOrderId % 1000000000);
        $parentOrderId = sprintf("%s%09d", "1", $newOrderId % 1000000000);
        $now = time();
        global $_PAY_MODE;
        global $_OrderState;
        if ($orderNum > 1) {  //如果拆单，则插入父订单
            $newItem = array (
                'order_char_id'=> $parentOrderId,
                'order_id'=> $newOrderId,
                'status'=> 0,
                'flag'=> 0,
                'uid'=> $newOrder['uid'],
                'hw_id'=> $wh_id,
                'order_date'=> $now,
                'source'=> 0,
                'type'=> 0,
                'shipping_cost'=>isset($newOrder['shippingPrice'])?$newOrder['shippingPrice']:'',
                'premium_cost'=> 0,
                'shipping_type'=> isset($newOrder['shipType'])?$newOrder['shipType']:1,
                'pay_time'=> 0,
                'pay_type'=>  isset($newOrder['payType'])?$newOrder['payType']:1,
                'prcd_cost'=> 0, //手续费
                'order_cost'=> isset($newOrder['Price'])?$newOrder['Price']:'',//运费+商品总价 
                'price_cut'=> 0,
                'coupon_type'=> '',
                 'coupon_code'=>isset($newOrder['customerMobile'])?$newOrder['customerMobile']:'',  //优惠券字段存储该订单的c客户
                'coupon_amt'=> '',
                'point'=> 0,
                'point_pay'=> '',
                'promotion_point'=> 0,
                'cash_point'=> 0,
                'cash'=> isset($newOrder['Price'])?$newOrder['Price']:'',//运费+商品总价 
                'receiver'=> $newOrder['receiver'],
                'receiver_tel'=> $newOrder['receiverTel'],
                'receiver_mobile'=> $newOrder['receiverMobile'],
                'receiver_zip'=> $newOrder['zipCode'],
                'receiver_addr_id'=> $newOrder['receiveAddrId'],
                'receiver_addr'=> $newOrder['receiveAddrDetail'],
                'expect_dly_date'=> 0,
                'expect_dly_time_span'=> 0,
                'deliveryMemo'=> '',
                'comment'=> isset($newOrder['comment'])?$newOrder['comment']:'',
                'update_time'=> $now,
                'isPayed'=> 0,
                'out_time' => 0,
                'sign_by_other' => isset($newOrder['sign_by_other'])?$newOrder['sign_by_other']:1,
                'ls' => isset($newOrder['ls'])? $newOrder['ls'] : '',
                'cpsinfo' => isset($newOrder['cpsinfo'])? $newOrder['cpsinfo'] : '',
                'synFlag' => 0, //父订单不同步给ERP
                'visitkey'=>isset($newOrder['visitkey'])? $newOrder['visitkey'] : '',
                'pOrderId' => $parentOrderId,
                'subOrderNum' => $orderNum,  
                'stockNo' => 0,
                'shop_guide_id' => isset($newOrder['shopGuideId'])? $newOrder['shopGuideId'] : 0,
                'shop_guide_name' => isset($newOrder['shopGuideName']) ? $newOrder['shopGuideName'] : '',
                'shop_guide_cost' => isset($newOrder['shopPrice']) ? $newOrder['shopPrice'] : 0,
                'shop_id' => isset($newOrder['shopId'])? $newOrder['shopId'] : 0,
                'is_vat' =>  $userInfo['useInvoice'],
                'ingoreLackOfGift' => isset($newOrder['ingoreLackOfGift'])? $newOrder['ingoreLackOfGift'] : 0,
            );
           
	        $ret = IBOrdersTTC::insert($newItem);
	        if (false === $ret) {
	             self::$errCode = -2033;
	             self::$errMsg='入预订单库失败' . IBOrdersTTC::$errMsg;
	             Logger::err(basename(__FILE__, '.php') . " |" . __LINE__ );
	             return false;
	        }
	        $newOrderId++;
        }

        foreach ($shoppingProduct as $subOrderKey => $subOrder) {
            $cash = $subOrders[$subOrderKey]['orderPrice']
                    + $subOrders[$subOrderKey]['orderShipPrice']
                    - (isset($subOrders[$subOrderKey]['couponamt']) ? $subOrders[$subOrderKey]['couponamt'] : 0)
                    - (isset($subOrders[$subOrderKey]['point']) ? $subOrders[$subOrderKey]['point'] : 0);
            $isPayed = ($cash <= 0? 1:0);

            $subOrders[$subOrderKey]['orderId'] = $newOrderId; //clark记录订单ID

            $oid = sprintf("%s%09d", "1", $newOrderId % 1000000000);
            $newItem = array(
                'order_char_id'=> $oid,
                'order_id'=> $newOrderId,
                'status'=> 0,
                'flag'=> isset($subOrders[$subOrderKey]['flag']) ? $subOrders[$subOrderKey]['flag'] : 0,
                'uid'=>  $newOrder['uid'],
                'hw_id'=> $wh_id,
                'order_date'=> $now,
                'source'=> 0,
                'type'=> 0,
                'shipping_cost'=> $subOrders[$subOrderKey]['orderShipPrice'],
                'premium_cost'=> 0,
                'shipping_type'=> 1,
                'pay_time'=> 0,
                'pay_type'=> 1,
                'prcd_cost'=> 0, //手续费
                'order_cost'=> $subOrders[$subOrderKey]['orderPrice'] + $subOrders[$subOrderKey]['orderShipPrice'] + (isset($subOrders[$subOrderKey]['totalCut'])?$subOrders[$subOrderKey]['totalCut']:0),//运费+商品总价+（随心配）
                'price_cut'=> 0,
                'coupon_type'=> '',
                //绑定c客户手机
                'coupon_code'=> isset($newOrder['customerMobile']) ? $newOrder['customerMobile'] : '',
                'coupon_amt'=>  0,
                'point'=> 0,
                'point_pay'=>  0,
                'cash_point'=>  0,
                'promotion_point'=> isset($subOrders[$subOrderKey]['promotion_point']) ? $subOrders[$subOrderKey]['promotion_point'] : 0,
                'cash'=> $cash,
                'receiver'=> $newOrder['receiver'],
                'receiver_tel'=> $newOrder['receiverTel'],
                'receiver_mobile'=> $newOrder['receiverMobile'],
                'receiver_zip'=> $newOrder['zipCode'],
                'receiver_addr_id'=> $newOrder['receiveAddrId'],
                'receiver_addr'=> $newOrder['receiveAddrDetail'],
                'expect_dly_date'=> strtotime($newOrder['suborders'][$subOrderKey]['expectDate']),
                'expect_dly_time_span'=> $newOrder['suborders'][$subOrderKey]['expectSpan'],
                'deliveryMemo'=> isset($newOrder['suborders'][$subOrderKey]['arrived_limit_time'])? $newOrder['suborders'][$subOrderKey]['arrived_limit_time'] : '',
                'comment'=> isset($newOrder['comment'])?$newOrder['comment']:'',
                'update_time'=> $now,
                'isPayed'=> $isPayed,
                'out_time' => 0,
                'sign_by_other' => 1,
                'ls' => isset($newOrder['ls']) ? $newOrder['ls'] : '',
                'cpsinfo' => isset($newOrder['cpsinfo']) ? $newOrder['cpsinfo'] : '',
                'synFlag' => 1,
                'visitkey'=>isset($newOrder['visitkey']) ? $newOrder['visitkey'] : '',
                'pOrderId' => $parentOrderId,
                'subOrderNum' => 0,
                'stockNo' => $subOrderKey,
                'shop_guide_id' => isset($newOrder['shopGuideId'])? $newOrder['shopGuideId'] : 0,
                'shop_guide_name' => isset($newOrder['shopGuideName']) ? $newOrder['shopGuideName'] : '',
                'shop_guide_cost' => isset($newOrder['suborders'][$subOrderKey]['shopPrice']) ? $newOrder['suborders'][$subOrderKey]['shopPrice'] : 0,
                'shop_id' => isset($newOrder['shopId'])? $newOrder['shopId'] : 0,
                'customer_ip' => ToolUtil::getClientIP(),
                'is_vat' =>  $userInfo['useInvoice'],
                'ingoreLackOfGift' => isset($newOrder['ingoreLackOfGift'])? $newOrder['ingoreLackOfGift'] : 0,
            );
            $ret = IBOrdersTTC::insert($newItem);
            if (false === $ret) {
                 self::$errCode = -2033;
                 self::$errMsg='入预订单库失败' . IBOrdersTTC::$errMsg;
                 Logger::err(basename(__FILE__, '.php') . " |" . __LINE__ );
                 return false;
            }

            foreach ($subOrder as $sp) {
                foreach ($productStocks as $pstock) {
                    if ($subOrderKey != $pstock['StockSysNo']) {
                        continue;
                    }
                    if ($sp['product_id'] == $pstock['ProductSysNo'] ) {
                        //插入订单-商品映射表
                        // $isMainProduct 0:主商品 1：组件 2：赠品
                        $isMainProduct = $sp['type'];
                        $product_base_info[$sp['product_id']]['point_type'] =  0;
                        $product_base_info[$sp['product_id']]['point'] = 0;
                        $product_base_info[$sp['product_id']]['cost_price'] = isset($product_base_info[$sp['product_id']]['cost_price'])? $product_base_info[$sp['product_id']]['cost_price'] : 0;
                        $product_base_info[$sp['product_id']]['price'] = isset($product_base_info[$sp['product_id']]['price'])? $product_base_info[$sp['product_id']]['price'] : 0;

                        $useVirtualStock = $pstock['AvailableQty'] + $pstock['VirtualQty'] >= $sp['buy_count']? 0:1;
                        $newOrderItems = array(
                            'item_id' => $itemStartID++,
                            'order_char_id' => $oid,
                            'wh_id' => $wh_id,
                            'product_id' => $sp['product_id'],
                            'product_char_id' => $product_base_info[$sp['product_id']]['product_char_id'],
                            'uid' => $newOrder['uid'],
                            'name' => $product_base_info[$sp['product_id']]['name'],
                            'flag' => $product_base_info[$sp['product_id']]['flag'],
                            'type' => $product_base_info[$sp['product_id']]['type'],
                            'type2' => $product_base_info[$sp['product_id']]['type2'],
                            'weight' => $product_base_info[$sp['product_id']]['weight'],
                            'buy_num' => $sp['buy_count'],
                            'points' => 0,
                            'points_pay' => 0,
                            'point_type' => 0,
                            'discount' => 0,
                            'price' => ($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL)? $product_base_info[$sp['product_id']]['price']:0,
                            'cash_back' => (($sp['main_product_id'] > 0 && $sp['type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL)? $sp['cashCutPerItem']:0),
                            'cost' => $product_base_info[$sp['product_id']]['cost_price'],
                            'warranty' => $product_base_info[$sp['product_id']]['warranty'],
                            'expect_num' => 0,
                            'create_time' => $now,
                            'product_type' => $isMainProduct,
                            'use_virtual_stock' => $useVirtualStock,
                            'main_product_id' => isset($sp['belongto_product_id']) ? $sp['belongto_product_id']: 0,
                            'updatetime' => $now,
                            'edm_code' => isset( $product_base_info[$sp['product_id']]['edm'])?$product_base_info[$sp['product_id']]['edm']: '',
                            'apportToPm'=> 0,
                            'apportToMkt' => 0,
                            'shop_guide_cost' => isset($product_base_info[$sp['product_id']]['shopPrice']) ? $product_base_info[$sp['product_id']]['shopPrice'] : 0,
                            'OTag' => isset($sp['OTag'])? $sp['OTag'] : '',
                        );
                         $ret = IBOrderItemsTTC::insert($newOrderItems);
		                 if (false === $ret) {
		                     self::$errCode = -2033;
		                     self::$errMsg='入预订单商品记录库失败' . IBOrderItemsTTC::$errMsg . '  ' . $newOrderItems['item_id'];
		                     Logger::err(basename(__FILE__, '.php') . " |" . __LINE__ );
		                     return false;
		                }
                        break;
                    }
                }
            }
            $newOrderId++;
        }

        // 非导购订单则删除购物车
       if (true !== $isShopGuide){ 
         IBShoppingCartTTC::remove($newOrder['uid']);
       }
        return array (
            'errCode' => 0,
            'uid' => $newOrder['uid'],
            'orderId' => $parentOrderId,
            'subOrders' => $subOrders
        );
    }

    /**
     * 获取预订单详情 
     */
    function  getOneOrder($uid, $order_id, $real_order_id=0)
    {
        if (!isset($uid) || $uid <= 0) 
        {
            self::$errCode = -2019;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";
            
            return false;
        }
        if (0 == $real_order_id && (!isset($order_id) || $order_id == ""))
        {
            self::$errCode = -2020;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_id[$order_id] is empty";
            
            return false;
        }
        $condition = array();
        if (0 != $real_order_id)
        {
            $condition = array('real_order_id'=>$real_order_id);
        }
        else 
        {
            $condition = array('order_char_id'=>$order_id);
        }
        $orders = IBOrdersTTC::get($uid,$condition);
        if (false === $orders)
        {
            self::$errCode = IBOrdersTTC::$errCode;
            self::$errMsg = IBOrdersTTC::$errMsg;
            
            return false;
        }
        $order = current($orders);
        
        $orderItems = IBOrderItemsTTC::get($uid,array('order_char_id' => $order['order_char_id'],'product_type'=>0));
        if (false === $orderItems)
        {
            self::$errCode = IBOrderItemsTTC::$errCode;
            self::$errMsg = IBOrderItemsTTC::$errMsg;
            
            return false;
        }
        
        if (0 === count($orderItems))
        {
            self::$errCode = -2021;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_id  is empty";
            
            return false;
        }
        $order['items'] = $orderItems;
        
        return $order;
    }
    
    /**
     * 如果是父订单 则返回该父订单下所有的商品信息
     * 一般只在下单成功后的页面显示
     * 
     */
    function getOneOrderDetail($uid, $order_id, $sub_id=0)
    {
        if (!isset($uid) || $uid <= 0) 
        {
            self::$errCode = -2019;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";
            
            return false;
        }
        if (!isset($order_id) || $order_id == "") 
        {
            self::$errCode = -2020;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_id[$order_id] is empty";
            
            return false;
        }
        $filter = array('order_char_id'=>$order_id);
        if ($sub_id !== 0)
        {
            $filter['shop_guide_id'] = $sub_id;
        }
        $orders = IBOrdersTTC::get($uid,$filter);
        if (false === $orders)
        {
            self::$errCode = IBOrdersTTC::$errCode;
            self::$errMsg = IBOrdersTTC::$errMsg;
            
            return false;
        }
        if (count($orders) == 0)
        {
        	self::$errCode = -2021;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_id[$order_id] is empty";
            return false;
        }
        $order = current($orders);
        global $_District, $_Province, $_City;
        @$order['receiver_addr'] = ($_Province[$_District[$order['receiver_addr_id']]['province_id']] . $_City[$_District[$order['receiver_addr_id']]['city_id']]['name'] . $_District[$order['receiver_addr_id']]['name'] . $order['receiver_addr']);
        if ($order['shipping_type'] == ICSON_DELIVERY ) { //易迅快递才有效
            $order['expect_dly_date'] = date("Y年m月d日", $order['expect_dly_date']);
            if ($order['expect_dly_time_span'] == 1) {
                $order['expect_dly_time_span'] = "上午 9:00-14:00";
                $order['expect_dly_time_span'] = "上午 09:00-14:00";
            }else if ($order['expect_dly_time_span'] == 2) {
                $order['expect_dly_time_span'] = "下午 14:00-18:00";
            }else if ($order['expect_dly_time_span'] == 3) {
                $order['expect_dly_time_span'] = "晚上 18:00-22:00";
            }
        }
        //如果是父订单
        $orderItems = array();
        if ($order['subOrderNum'] > 1)
        {
            $suborders = IBOrdersTTC::get($uid,array('pOrderId' => $order_id));
            if (false === $suborders)
            {
                self::$errCode = IBOrdersTTC::$errCode;
                self::$errMsg = IBOrdersTTC::$errMsg;
                
                return false;
            }
            foreach ($suborders AS $suborder)
            {
                $tempitems = IBOrderItemsTTC::get($uid,array('order_char_id' => $suborder['order_char_id']));
	            if (false === $tempitems)
	            {
	                self::$errCode = IBOrderItemsTTC::$errCode;
	                self::$errMsg = IBOrderItemsTTC::$errMsg;
	                
	                return false;
	            }
                array_push($orderItems,$tempitems);
            }
        }
        else 
        {
	        $orderItems = IBOrderItemsTTC::get($uid,array('order_char_id' => $order_id));
	        if (false === $orderItems)
	        {
	            self::$errCode = IBOrderItemsTTC::$errCode;
	            self::$errMsg = IBOrderItemsTTC::$errMsg;
	            
	            return false;
	        }
        }
        if (0 === count($orderItems))
        {
            self::$errCode = -2021;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_id[$order_id] is empty";
                
            return false;
        }
            
        foreach ($orderItems as $oit)
        {
            if ($oit['product_type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL) 
            {
                 $order['items'][$oit['product_id']] = $oit;
            }
            else
            {
                    if ($oit['product_type'] == SHOPPING_CART_PRODUCT_TYPE_ZUJIAN) {
                        $oit['product_type'] = "组件";
                    }
                    else{
                        $oit['product_type'] = "赠品";
                    }
                    $order['items'][$oit['main_product_id']]['gift'][] = $oit;
                   
            }
        }
        
        $retailer = IRetailer::getRetailers(array('uid'=>$uid));
        if (false === $retailer)
        {
            self::$errCode = IRetailer::$errCode;
            self::$errMsg = IRetailer::$errMsg;
                
            return false;
        }
        if (0 === count($retailer))
        {
            self::$errCode = -1001;
            self::$errMsg = "invalid uid";
            
            return false;
        }
        $retailer = current($retailer);

        //获取订单的c客户信息
        if ($order['coupon_code'] != '')
        {
        	$customerMobile = $order['coupon_code'];
            $customer = IBCustom::getCustomPage($retailer['uid'],array('mobile'=>$customerMobile),1);
            if (false === $customer)
            {
                self::$errCode = IBCustom::$errCode;
                self::$errMsg = IBCustom::$errMsg;
                Logger::err("IBCustom::getCustomPage faild-" . IBCustom::$errCode . "-" . IBCustom::$errMsg . basename(__FILE__, '.php') . " |" . __LINE__ );
            }
            if (0 == $customer['count'])
            {
                Logger::err("C用户信息不存在或已删除" . basename(__FILE__, '.php') . " |" . __LINE__ );
            }
            else 
            {
                $order['customerInfo'] = $customer['data'][0];
            }
        }
        
        if ($order['is_vat'] == 0)
        {
            return $order;
        }
        //获取分销商默认发票ID
        $invoiceId = intval($retailer['invoiceId']);
        //获取默认发票信息
        $invoice = IUser::getUserInvoice($uid,$invoiceId);
        if (false === $invoice)
        {
             self::$errCode = IUser::$errCode;
             self::$errMsg = IUser::$errMsg;
            
            return $order;
        }
        if (0 === count($invoice))
        {
            self::$errCode = -1003;
            self::$errMsg = "发票信息 不存在";
            
            return $order;
        }
        $invoice = current($invoice);
        $order['invoices'] = array($invoice);
        
        return $order;
    }
    
    /**
     * 获取预订单
     * 
     */
    function getPreOrders($uid,$filter=array(),$currentPage=1,$pageSize=24)
    {
        if (!isset($uid) || $uid <= 0) 
        {
             self::$errCode = -2019;
             self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";
            
             return false;
        }
        
        $retailer = IRetailer::getRetailers(array('uid'=>$uid));
        if (false === $retailer || 0 === count($retailer))
        {
             Logger::err(basename(__FILE__, '.php') . " |" . __LINE__  . IRetailer::$errMsg);
             return '';
        }
        $retailer = current($retailer);
        
        $db_tab_index = array('table'=>intval($uid%100), 'db'=>intval($uid%1000/100));//10库百表

        $orderDb = ToolUtil::getDBObj('retailer_orders', $db_tab_index['db']);
        if (empty($orderDb))
        {
            self::$errCode = $orderDb->errCode;
            self::$errMsg = $orderDb->errMsg;
            return false;
        }
   
        $condition = self::_getWhereSQL($uid, $orderDb, $retailer, $filter);
    
$sql = <<<SQL
   SELECT count(*) AS total
   FROM  t_borders_{$db_tab_index['table']}
   WHERE $condition
   ORDER BY order_date desc 
SQL;


        $ordercount = $orderDb->getRows($sql);
        if (false === $ordercount)
        {
            self::$errCode = $orderDb->errCode;
            self::$errMsg = $orderDb->errMsg;
            return false;
        }
        if(0 === count($ordercount))
        {
            return array('data'=>array(),'total'=>0);
        }
        $ordercount = current($ordercount);
        $total = $ordercount['total'];
        
        $start = ($currentPage-1) * $pageSize;
$sql = "
   SELECT *
   FROM  t_borders_{$db_tab_index['table']}
   WHERE $condition
   ORDER BY order_date desc 
   LIMIT $start,$pageSize" ;

        $orders = $orderDb->getRows($sql);
        if (false === $orders) 
        {
            self::$errCode = $orderDb->errCode;
            self::$errMsg = $orderDb->errMsg;
            return false;
        }

        //从ttc获取订单商品
        foreach ($orders AS $key=>$order)
        {
	        $orderItems = IBOrderItemsTTC::get($uid,array('order_char_id' => $order['order_char_id'],'product_type'=>0));
	        if (false === $orderItems)
	        {
	            self::$errCode = IBOrderItemsTTC::$errCode;
	            self::$errMsg = IBOrderItemsTTC::$errMsg;
	            
	            return false;
	        }
	        $orders[$key]['items'] = $orderItems;
        }
        return array('data'=>$orders,'total'=>$total);
    }
    
    /**
     * 构造sql
     * @param array $condition ('status'=>'','shop_id'=>'','onMonth'=>,'onMonthAgo'=>,'shop_guide_name'=>,'account'=>)
     */
    function _getWhereSQL($uid,$db,$retailer,$conditions = array())
    {
        $time = strtotime("last month",time());
        $whereSql = 'uid != 0 AND subOrderNum=0 AND type=0 '; //父订单不显示
        if (isset ( $conditions ['status'] ) && '' != $conditions ['status']) 
        {
            $whereSql .= " and status=" . intval($conditions ['status']);
        }
        if (isset ( $conditions ['shop_id'] ) && '' != $conditions ['shop_id']) 
        {
            $whereSql .= " and shop_id=" . intval($conditions ['shop_id']);
        }
        if (isset ( $conditions ['onMonth'] ) && '' != $conditions ['onMonth']) 
        {
            $whereSql .= " and order_date >= " . $time;
        }
        if (isset ( $conditions ['onMonthAgo'] ) && '' != $conditions ['onMonthAgo']) 
        {
            $whereSql .= " and order_date <= " . $time;
        }
        if (isset ( $conditions ['order_char_id'] ) && '' != $conditions ['order_char_id']) 
        {
            $whereSql .= " and order_char_id = " . ToolUtil::filterInput($conditions ['order_char_id']);
        }
        if (isset ( $conditions ['name'] ) && '' != $conditions ['name']) 
        {//导购姓名
             if ($conditions ['name'] == $retailer['name']) //
             {
                  $whereSql .= " and shop_guide_id = 0";
             }
             else 
             {
                    $sub = IBUser::getAllSalesman($uid,array('name' => $conditions['name']));
                    if (false !=$sub && count($sub)>0)
                    {
                        $whereSql .= " and shop_guide_id = " . $sub[0]['uid'] ;
                    }
                    else
                    {
                        $whereSql .= " and shop_guide_id = -1";  //返回空结果
                    }
        	   
             }
         }
        if (isset ( $conditions ['account'] ) && '' !== $conditions ['account']) 
        { //导购帐号	
            	$sql = '';
                if ($conditions ['account'] == $retailer['icsonid'])
                {
                    $sql = " and shop_guide_id = 0";
                }
                else 
                {
                    $sql = " and shop_guide_name like '%" . $db->filterString($conditions ['account']) . "%'";
                }
                $whereSql .= $sql;
           
        }
        if (isset($conditions ['shop_guide_id']) && '' !== $conditions ['shop_guide_id'])
        {
             $whereSql .= " and shop_guide_id = " . $conditions ['shop_guide_id'] ;
        }
        if (isset($conditions ['guidStatus']) && '' !== $conditions ['guidStatus'])
        {
            $whereSql .= " and status<=" . intval($conditions ['guidStatus']);
        }
        return $whereSql;
    }
    
    /**
     * 分销商审核订单
     * 通     过：校验分销价是否变动->正式提交订单->修改预订单为通过->关联门店订单和正式订单
     * 不通过： 修改门店订单状态为不通过
     */
    function approvalPreOrder($uid, $order_id, $status, $reason)
    {
    	//获取门店订单数据
    	$wh_id = 1; //默认为上海站
        $preOrder = self::getOneOrder($uid,$order_id);
        if (false === $preOrder || 0 === count($preOrder))//order不存在
        {
            self::$errMsg = "invalid order id";
            return false;
        }

        global $_OrderState;
        if ($status != $_OrderState['WaitingOutStock']['value'])
        {
	        $param = array(
	            'uid' => $uid,
	            'status' => -1,
	            'single_promotion_info' => ToolUtil::transXSSContent($reason),
	            'update_time' => time()
	        );
	        $result = IBOrdersTTC::update($param, array('order_char_id'=>$order_id));
	        
	        return $result;
        }

        $retailer = IRetailer::getRetailers(array('uid'=>$uid));
        if (false === $retailer)
        {
            self::$errCode = IRetailer::$errCode;
            self::$errMsg = IRetailer::$errMsg;
                
            return false;
        }
        if (0 === count($retailer))
        {
            self::$errCode = -1001;
            self::$errMsg = "invalid uid";
            
            return false;
        }
        //获取分销商默认发票ID
        $retailer = current($retailer);
        $invoiceId = intval($retailer['invoiceId']);

    //补充发票信息
    $invoice = IUser::getUserInvoice($uid,$invoiceId);
    if (false === $invoice)
    {
             self::$errCode = IUser::$errCode;
             self::$errMsg = IUser::$errMsg;
            
            return false;
    }
    if (0 === count($invoice) && intval($retailer['useInvoice']) != 0)
    {
            self::$errCode = -1003;
            self::$errMsg = "发票信息不存在，请联系客服";
            
            return false;
    }
     $invoice = current($invoice);    
        $pids = array();
        foreach ($preOrder['items'] AS $item)
        {
            array_push($pids,$item['product_id']);
        }
        // 获取商品库存
        $stock = IProductInventory::getProductsInventeory($pids, $wh_id);
	    if (false === $stock)
	    {
	    	self::$errCode = -1004;
            self::$errMsg = IProductInventory::$errMsg;
            
	        return false;
	    }
        // 获取商品组件
	    $gift = IProduct::getProductsGift($pids, $wh_id, 'ONLY_COMPONENT');
	    if (false === $gift)
	    {
	        self::$errCode = -1005;
            self::$errMsg = IProduct::$errMsg;
            
            return false;
	    }
	    // 获取商品分销进货价
	    $price = IBProduct::getProductDistributionPrice($uid, $pids);
	    if (false === $price)
	    {
	        self::$errCode = -1006;
            self::$errMsg = IBProduct::$errMsg;
            
            return false;
	    }
	    // 获取商品导购零售价
	    $isShoppingGuide = false; // 判断是否开启导购
//	    $guide_price = array();
	    if (0 != $preOrder['shop_guide_id'])
	    {
	        $isShoppingGuide = true;
//	        $guide_price = IBProduct::getMarketPrice($uid, $pids);
//	        if (false === $guide_price)
//	        {
//		        self::$errCode = -1007;
//	            self::$errMsg = IBProduct::$errMsg;
//	            
//	            return false;
//	        }
	    }
	    //构造子订单
	    $suborders = array();
	    $productIds_wh = array();

        foreach ($preOrder['items'] AS $item)
        {
        	$id = $item['product_id'];
        	$num = $item['buy_num'];
            $sale_stock_id = $stock[$id]['supply_stock_id'];

	        if (!isset($suborders[$sale_stock_id]))
	        {
	            $suborders[$sale_stock_id]['shipPrice'] = 0;
	            $suborders[$sale_stock_id]['arrived_limit_time'] = '';
	            $suborders[$sale_stock_id]['price'] = 0;
	            $suborders[$sale_stock_id]['shopPrice'] = 0;

	        }
	
//	        $product_price = $price[$id];
//	        $product_shop_price = $isShoppingGuide ? $guide_price[$id] : 0;
//	        //分销进货价发生变动
//	        if ($product_price != $item['price']) 
//	        {
//	        	return $item;
//	        	self::$errCode = -1008;
//                self::$errMsg = '分销进货价发生变动,请重新下单';
//                
//	            return false;
//	        }
	        $component = array();
	        if (isset($gift[$id]))
	        {
	            foreach ($gift[$id] AS $gitem)
	            {
	                $component[] = $gitem['product_id'];
	            }
	        }
	        $suborders[$sale_stock_id]['price'] += $item['price']* $num;
            $suborders[$sale_stock_id]['shopPrice'] += $item['shop_guide_cost'] * $num; 
	        $suborders[$sale_stock_id]['items'][] = array(
                                                           'product_id' => $id,
                                                           'price'      => $item['price'],
                                                           'shopPrice'  => $item['shop_guide_cost'],
                                                           'num'        => $num,
                                                           'gift'       => $component,
                                                          );
            $productIds_wh[$sale_stock_id][] = $id;
        }
        
        $total_price = 0;
        $total_shop_price = 0;
        foreach ($suborders AS $key => $item)
        {
	        $product_info = IProductInfoTTC::gets($productIds_wh[$key], array('wh_id'=>$key), array('product_id', 'flag', 'type'));
	        if (false === $product_info)
	        {
	            self::$errCode = -1009;
                self::$errMsg = IProductInfoTTC::$errMsg;
                
                return false;
	        }
	
	        $products = array();
	        $product_num = array();
	        foreach ($product_info AS $value)
	        {
	            $id = $value['product_id'];
	            if (!isset($stock[$id]))
	            {
	                self::$errCode = -1010;
                    self::$errMsg = "商品库存不存在";
                
                    return false;
	            }
	            $num_available = $stock[$id]['num_available'];
	            $virtual_num = $stock[$id]['virtual_num'];
	
	            $products[$id] = array('flag' => $value['flag'],
	                                   'type' => $value['type'],
	                                   'num_available' => $num_available,
	                                   'virtual_num' => $virtual_num);
	            $num = 0;
	            foreach ($item AS $pair)
	            {
	               if ($pair['product_id'] == $id)
	               {
	               	   $num = $pair['num'];
	               	   break;
	               }
	            }
	            $product_num[] = array('product_id' => $id,
	                                   'buy_count' => $num);
	        }


	        $suborders[$key]['shipPrice'] = 0;
	        $suborders[$key]['expectDate'] = ($preOrder['expect_dly_date']>time()) ? date("Y-m-d",strtotime("+1 day")) : date("Y-m-d",$preOrder['expect_dly_date']);
	        $suborders[$key]['expectSpan'] = $preOrder['expect_dly_time_span'];

	        // 子订单去分
	        $trim_price =  10 * bcdiv($item['price'], 10 , 0);
	        $suborders[$key]['price'] = $trim_price;
	        $total_price += $trim_price;
	        $total_shop_price += $suborders[$key]['shopPrice'];
	    }

	    //审核通过，正式提交订单
        $order = array(
             'uid'               => $uid,
             'shopGuideId'       => $preOrder['shop_guide_id'],
             'shopGuideName'     => $preOrder['shop_guide_name'],
             'shopId'            => $preOrder['shop_id'],
             'verifycode'        => false,
             'aid'               => $preOrder['shop_id'],
             'receiver'          => $preOrder['receiver'],
             'receiveAddrId'     => $preOrder['receiver_addr_id'],
             'receiveAddrDetail' => $preOrder['receiver_addr'],
             'receiverTel'       => $preOrder['receiver_tel'],
             'receiverMobile'    => $preOrder['receiver_mobile'],
             'zipCode'           => $preOrder['receiver_zip'],
             'shipType'          => 1,    // 默认是易迅快递
             'sign_by_other'     => 1,    // 是否同意由他人代收，1表示同意，0表示不同意
             'payType'           => 1,    // 默认是货到付款
             'isVat'             => $retailer['useInvoice'],
             'invoiceId'         => $invoice['iid'],
             'invoiceType'       => $invoice['type'],
             'invoiceTitle' => $invoice['name'],
             'invoiceContent' => '商品明细',
             'invoiceCompanyName' => $invoice['name'],
             'invoiceCompanyAddr' => $invoice['addr'],
             'invoiceCompanyTel' => $invoice['phone'],
             'invoiceTaxno' => $invoice['taxno'],
             'invoiceBankNo' => $invoice['bankno'],
             'invoiceBankName' =>$invoice['bankname'],
             'point' => 0,
             'shippingPrice' => $preOrder['shippingPrice'],
             'couponCode' => '',
             'comment' => $preOrder['comment'],
             'url' => '',
             'openID' => $preOrder['openID'],
             'visitkey' => $preOrder['visitkey'],
             'buy_one_key' => false,
             'Price' => $preOrder['order_cost']-$preOrder['shippingPrice'],  //分销进货总价
             'shopPrice' => $total_shop_price,     //导购零售总价
             'suborders' => $suborders,
             'ingoreLackOfGift' => $preOrder['ingoreLackOfGift'],
             'isDistribution' => true
        );

        $ret = IOrder::order($order, $wh_id);
        

        if (false === $ret)
        {
            self::$errCode = IOrder::$errCode;
            self::$errMsg = IOrder::$errMsg;
            return false;
        }
        else if(0 !== intval($ret['errCode']))
        {
             self::$errCode = $ret['errCode'];
             self::$errMsg = $ret['errMsg'];
             return false;
        }
        //更新预订单对应订单号、更新订单审核状态、更新导购零售价
      
	    $param = array(
	            'uid' => $uid,
	            'status' => 1,
	            'update_time' => time(),
	            'single_promotion_info' => ToolUtil::transXSSContent($reason),
	            'real_order_id' => $ret['orderId']
	        );
	     $result = IBOrdersTTC::update($param, array('order_char_id'=>$order_id));
	     if (false === $result)
	     {
	         self::$errCode = IBOrdersTTC::$errCode;
             self::$errMsg = IBOrdersTTC::$errMsg;
             Logger::err(" IBOrdersTTC::update faild-" . IBOrdersTTC::$errCode . "-" . IBOrdersTTC::$errMsg . basename(__FILE__, '.php') . " |" . __LINE__ );
	     }
	     //绑定c客户到订单
	     $resu = IBCustom::addreation($uid,$ret['orderId'],$preOrder['coupon_code']);
	     if ($resu['error'] !== 0)
	     {
	         Logger::err(" IIBCustom::addreation faild-" . $uid . "-" . $order_id . ',' . $resu['data'] .basename(__FILE__, '.php') . " |" . __LINE__ );
	     }
	     return $result;
    }
}

