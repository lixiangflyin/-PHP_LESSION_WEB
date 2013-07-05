<?php
require_once(PHPLIB_ROOT . 'inc/installment.inc.php');

if (!defined('MAX_SHOPPING_CART_ITEM')) {
	define('MAX_SHOPPING_CART_ITEM', 100);
}
if (!defined('MAX_COUNT_PER_ITEM')) {
	define('MAX_COUNT_PER_ITEM', 99);
}

/*错误码定义
100:商品编码不合法
101:uid不合法
102:商品数量不合法
103:没有登录
104:商品父id不合法
105:商品件数不合法
106：仓库id不合法
107:商品不存在
108:超过限购数量
109：超过库存数量

110:商品状态不合法
111:商品数组为空
*/

class IInstallmentShoppingCart
{
	public static $errCode = 0;
	public static $errMsg = '';
	
	public static function addToShoppingCartNoLogin($product_id, $num=1, $wh_id=1)
	{
		
		if (!isset($product_id) || $product_id <= 0) {
			self::$errCode = 100;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id) is invalid";
			return false;
		}

		if (!isset($num) || $num <= 0 || $num > 99) {
			self::$errCode = 105;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "num($num) is invalid";
			return false;
		}
		if (!isset($wh_id) || $wh_id <= 0) {
			self::$errCode = 106;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "wh_id($wh_id) is invalid";
			return false;
		}	
			
		//获取商品基本信息	
		$productCommon = IProductCommonInfoTTC::get($product_id); 
		if (false === ($productCommon)) {
			self::$errCode = IProductCommonInfoTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IProductCommonInfoTTC failed]' . IProductCommonInfoTTC::$errMsg;
			return false;
		}
		if (count($productCommon) == 0)
		{
			self::$errCode = 409;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id) is not exist";
			return false;
		}
		$c3id = $productCommon[0]['c3_ids'];
		unset($productCommon);
		
		//获取商品分仓信息
		$product = IProductInfoTTC::get($product_id, array('wh_id'=>$wh_id));
		if (false === $product) {
			self::$errCode = IProductTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductTTC failed]' . IProductTTC::$errMsg;
			return false;
		}	
		
		if (count($product) < 1) {
			self::$errCode = 107;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '商品不存在';
			return false;
		}		
		if ($product[0]['status'] != PRODUCT_STATUS_NORMAL) {
			self::$errCode = 110;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '商品暂不销售';
			return false;
		}	
		
		$product = $product[0];
		
		//ixiuzeng添加获取商品的库存
		$productInventoryInfo = IProductInventory::getProductInventeory($product_id, $wh_id);
		if(false === $productInventoryInfo)
		{
			self::$errCode = IProductInventory::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[getProductInventeory failed]' . IProductInventory::$errMsg;
			Logger::err("errCode(" . self::$errCode . ")" . self::$errMsg);
				
			$product['virtual_num'] = 0;
			$product['num_available'] = 0;
			$product['psystock'] = -1;
		}
		else
		{
			$product['virtual_num'] = $productInventoryInfo['virtual_num'];
			$product['num_available'] = $productInventoryInfo['num_available'];
			$product['psystock'] = $productInventoryInfo['supply_stock_id'];
		}
		
		
		//检查商品是否限购
		//不限购
		if ($product['num_limit'] <= 0) {
			$product['num_limit'] = 999;
		}
		
		$numNeed = $num;
		if ($numNeed > MAX_COUNT_PER_ITEM)
		{
			$numNeed =  MAX_COUNT_PER_ITEM;
		}
		//限购数量小于库存
		if ($product['num_limit'] <= $product['num_available'] + $product['virtual_num']) {
			if ($numNeed > $product['num_limit']) {				
				self::$errCode = 108;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '超过限购数量';		
				$numNeed =  $product['num_limit'];	
			}
		}else   //库存小于限购数量
		{
			if ($numNeed > $product['num_available'] + $product['virtual_num']) {	
				if ((( $wh_id != 1) || ($product['flag'] & FORBID_SET_VIRTUAL) == FORBID_SET_VIRTUAL) || $product['type'] != PRODUCT_TYPE_NORMAL
					/*$product['type'] != PRODUCT_TYPE_NORMAL || $product['price'] <= $product['cost_price'] */) {							
							$numNeed =  $product['num_available'] + $product['virtual_num'];		
							if ($numNeed <= 0) {
								self::$errCode = 109;
								self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '库存不足，为负数';		
								return false;
							}
						}			
			}
		}	
		
		$err = "";
		$limitMin = INSTALLMENT_LIMIT_PRICE_MIN;
		$limitMax = INSTALLMENT_LIMIT_PRICE_MAX;
		
		if($product['price'] < $limitMin)
		{
			$err = "分期付款商品金额不得小于". $limitMin / 100 . "元";
		}else if  ($product['price'] >$limitMax) {
			$err = "分期付款商品金额不得大于". $limitMax / 100 . "元";
		}
		
		return array('errMsg'=>$err, 'product_id'=>$product_id, 'num'=>$numNeed);
	}
	
	//items: array('product_id', 'buy_count')
	public static function viewNoLogin($items, $wh_id=1)
	{
		if (count($items) == 0) {
			return  array();
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
		//拉取商品分仓信息
		$products = IProductCommonInfoTTC::gets($productIds);
		if (false === $products) {
			self::$errCode = IProductCommonInfoTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductCommonInfoTTC failed]' . IProductCommonInfoTTC::$errMsg;
			return false;
		}
		if (count($products) == 0) {
			return  array();
		}
		
		//剔除没有商品基本信息的商品
		$productIds = array();
		
		global $_ColorList, $_PROD_SIZE_2;
		foreach ($items as $key => $item)
		{
			$exist = false;
			foreach ($products as $product)
			{
				if ( $item['product_id'] == $product['product_id'])
				{ 				    
				    $items[$key]['name'] = $product['name'];
				    $items[$key]['size'] = isset($_PROD_SIZE_2['$product["size"]'])? $_PROD_SIZE_2['$product["size"]'] : "";
				    $items[$key]['color'] = isset($_ColorList['$product["color"]']) ? $_ColorList['$product["color"]'] : "";
				    $items[$key]['product_char_id'] = $product['product_char_id'];
				    $items[$key]['pic_num'] = $product['pic_num'];
				    $items[$key]['weight'] = $product['weight'];
				    $items[$key]['c3_ids'] = $product['c3_ids'];
				    $productIds[] = $item['product_id'];				    
					$exist = true;
					break;
				}
			}
			if (false == $exist) {
				unset($items[$key]);
			}
		}		
		unset($products);
		
		//拉取商品分仓价格
		$productWhInfo = IProductInfoTTC::gets($productIds, array('wh_id'=>$wh_id));
		if (false === $productWhInfo) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
			return false;
		}
		
		//ixiuzeng添加获取多个商品的库存
		$productsInventoryInfo = IProductInventory::getProductsInventeory($productIds, $wh_id);
		if (false === $productsInventoryInfo)
		{
			self::$errCode = IProductInventory::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[getProductsInventeory failed]' . IProductInventory::$errMsg;
			Logger::err("errCode(" . self::$errCode . ")" . self::$errMsg);
			
			foreach ($productWhInfo as $key => $wi)
			{
				$productWhInfo[$key]['virtual_num'] = 0;
				$productWhInfo[$key]['num_available'] = 0;
				$productWhInfo[$key]['psystock'] = -1;
			}
		}
		else
		{
			foreach ($productWhInfo as $key => $wi)
			{
				foreach ($productsInventoryInfo as $psii)
				{
					if ($psii['product_id'] == $wi['product_id'])
					{
						$productWhInfo[$key]['virtual_num'] = $psii['virtual_num'];
						$productWhInfo[$key]['num_available'] = $psii['num_available'];
						$productWhInfo[$key]['psystock'] = $psii['supply_stock_id'];
						break;
					}
				}
			}
		}	
			
		$productIds = array();
		global  $_StockTips;
		global $_StockToWhidTransitDays;
		global $_Wh_id;
		global $_StockToStation;
		//剔除无价格信息的商品
		foreach ($items as $key => $item)
		{
			$exist = false;
			foreach ($productWhInfo as $pwinfo)
			{
				if ($pwinfo['product_id'] == $item['product_id']) {						
					if (311 == $item['c3_ids']) {
						if($pwinfo['price'] < INSTALLMENT_CELLPHONE_PRICE_MIN || $pwinfo['price'] > INSTALLMENT_CELLPHONE_PRICE_MAX)
						{
							unset($items[$key]);
							continue;
						}
					}else 
					{
						if($pwinfo['price'] < INSTALLMENT_NOTCELLPHONE_PRICE_MIN || $pwinfo['price'] > INSTALLMENT_NOTCELLPHONE_PRICE_MAX)
						{
							unset($items[$key]);
							continue;
						}
					}				
					$items[$key]['market_price'] = $pwinfo['market_price'];
					$items[$key]['price'] = $pwinfo['price'] + $pwinfo['cash_back'];
					$items[$key]['cash_back'] = $pwinfo['cash_back'];
					$items[$key]['point'] = $pwinfo['point'];
					$items[$key]['num_limit'] = $pwinfo['num_limit'];
					$items[$key]['type'] = $pwinfo['type'];
					$items[$key]['psystock'] = $pwinfo['psystock'];
					
					if (($pwinfo['num_available'] + $pwinfo['virtual_num'] >=  $item['buy_count']) || 
						(( $wh_id == 1) && ($pwinfo['flag'] & FORBID_SET_VIRTUAL) != FORBID_SET_VIRTUAL && $pwinfo['type'] == PRODUCT_TYPE_NORMAL)
				    	  /*     ($items[$key]['type'] == PRODUCT_TYPE_NORMAL && $pwinfo['price'] > $pwinfo['cost_price'])*/)
				    {
				    	if ($pwinfo['num_available'] >= $item['buy_count']) {   //实际库存足够
					    	if(!isset($_StockToWhidTransitDays[$pwinfo['psystock']][$wh_id]) || ($_StockToWhidTransitDays[$pwinfo['psystock']][$wh_id] == 0))
							{
								$items[$key]['array_days'] = $_StockTips['available'];
							}else
							{
								$items[$key]['array_days'] = "有货，待{$_Wh_id[$_StockToStation[$pwinfo['psystock']]]}仓调拨，{$_StockToWhidTransitDays[$pwinfo['psystock']][$wh_id]}天后配送";
							}
					    }else if ($pwinfo['arrival_days'] == VIRTUAL_STOCK_ARRAY_1_3DAYS) {
				    		$items[$key]['array_days'] = $_StockTips['arrival1-3'];
				    	}else 
				    	{
				    		$items[$key]['array_days'] = $_StockTips['arrival2-7'];
				    	}				    	
				    } else
				    {
				    	$items[$key]['array_days'] = $_StockTips['not_available'];
				    }
				    $productIds[] = $item['product_id'];	
					$exist = true;
					break;
				}
			}
			if (false === $exist) {
				unset($items[$key]);
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
		$giftsValid = array();
		$products_gifts_type = array();
		foreach($productWhInfo as $pwinfo)
		{
			foreach($gifts as $gi)
			{
				if(($pwinfo['product_id'] == $gi['product_id']) && ($pwinfo['psystock'] == $gi['stock_id']))
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
				if(($gv['gift_id'] == $gsi['product_id']) && ($gv['stock_id'] == $gsi['stock_id']) && 
				  (($gsi['num_available'] + $gsi['virtual_num'] > 0) || (COMPONENT_TYPE==$products_gifts_type[$gv['product_id']][$gv['gift_id']][$gv['stock_id']])))
				{
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
		$gift_ids_baseinfo = array();
		foreach ($giftValidInventory as $key => $gift) {
			$exist = false;
			foreach ($gift_base_info as $g_base) {
				if ($g_base['product_id'] == $gift['gift_id']) {
					$gift_ids_baseinfo[] = $gift['gift_id'];
					$exist = true;
					$giftValidInventory[$key]['name'] = $g_base['name'];
					$giftValidInventory[$key]['product_char_id'] = $g_base['product_char_id'];
					$giftValidInventory[$key]['weight'] = $g_base['weight'];;
					$giftValidInventory[$key]['pic_num'] = $g_base['pic_num'];
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
				if (($gift['product_id'] == $item['product_id']) && ($gift['stock_id'] == $item['psystock'])&&
					($gifts_status[$gift['gift_id']][$_StockToStation[$gift['stock_id']]] != PRODUCT_STATUS_NORMAL))//赠品组件的状态不可能是出售状态 
				{
					$items[$key]['gift'][$gift['gift_id']]['name'] = $gift['name'];
					$items[$key]['gift'][$gift['gift_id']]['product_id'] = $gift['gift_id'];
					$items[$key]['gift'][$gift['gift_id']]['product_char_id'] = $gift['product_char_id'];
					$items[$key]['gift'][$gift['gift_id']]['type'] = $gift['type'];
					$items[$key]['gift'][$gift['gift_id']]['weight'] = $gift['weight'];
					$items[$key]['gift'][$gift['gift_id']]['pic_num'] = $gift['pic_num'];
					$items[$key]['gift'][$gift['gift_id']]['num'] = $gift['gift_num'];
				}
			}
		}
		
		return $items;
	}
}