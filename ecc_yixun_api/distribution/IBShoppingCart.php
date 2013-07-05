<?php
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

class IBShoppingCart {

	public static $errCode = 0;
	public static $errMsg = '';

	//客户切换站点，需要清理购物车中，在新分站不销售的商品
	//$productIdArr = array(pid1,pid2,pid3)
	public static function removeProducts($uid, $productIds) {
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}

		foreach ($productIds as $pid) {
			$item = IBShoppingCartTTC::remove($uid, array('product_id'=>$pid));
			if (false === $item) {
				continue;
			}
		}
		return true;
	}

	/**
	 * 添加商品到购物车中
	 * @param int $uid 用户ID
	 * @param int $product_id 商品ID
	 * @param int $num 商品数量
	 * @param int $wh_id 分站ID
	 * @param int $main_product_id 随心配主商品ID，（会对价格产生影响）
	 * @param array $multiPriceInfo 多价格参数。如果取易迅价，则可以传空
	 * 		$multiPriceInfo = array(
	 * 			'from_cart_nologin' => true, //请求是否是把非登录态购物车转移到登录态购物车，如果是，则不在校验多价格是否满足校验点（因为加入非登录态购物车已经检查过了）
	 * 			'price_id' => xxx, //$price_id： 加入购物车取商品的哪一个价格，原价为0，其他价格为1-64取值
	 * 			//其他多价校验信息
	 *	    $otag : 订单路径跟踪码
	 * 		)
	*/
	public static function add($uid, $product_id, $num=1, $wh_id=1, $main_product_id=0, $price_id, $otag = '') {
		
		if (!isset($product_id) || $product_id <= 0) {
			self::$errCode = 100;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id) is invalid";
			return false;
		}
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}
		if (!isset($num) || $num <= 0 || $num > 99) {
			self::$errCode = 105;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "num($num) is invalid";
			return false;
		}
		if (!isset($wh_id) || $wh_id < 0) {
			self::$errCode = 106;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "wh_id($wh_id) is invalid";
			return false;
		}

		//获取商品分仓信息
		$product = IProductInfoTTC::get($product_id, array('wh_id'=>$wh_id));
		if (false === $product) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
			return false;
		}

		if (count($product) < 1) {
			self::$errCode = 107;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '商品信息不存在';
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


		// 如果是特殊商品（定制机和节能补贴）不直接加入购物车
		if ( IProduct::isCanNotAddToNormalCart($product) ) {
			return array();
		}

		//拉取购物车中已有信息
		$items = IBShoppingCartTTC::get($uid, array(), array('product_id', 'buy_count', 'main_product_id'));
		if (false === $items) {
			self::$errCode = IBShoppingCartTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IBShoppingCartTTC failed]' . IBShoppingCartTTC::$errMsg;
			return false;
		}

		$exist = false;
		$isMainProduct = false;
		$isMatchProduct = false;

		foreach ($items as $key => $item) {
			if ($item['product_id'] == $product_id) {
				$exist = true;
				$existItemNum = $item['buy_count'];
				if ($main_product_id == 0) {
					break;
				}
			}

			if ($product_id == $item['main_product_id'] ) { //$product_id 作为附属商品，所以其不能已经是主商品
				$isMainProduct = true;
			}
			if ($main_product_id > 0 && $main_product_id == $item['product_id'] && $item['main_product_id'] > 0) {//$product_id 作为主商品，所以其不能已经是附属商品
				$isMatchProduct = true;
			}
		}
		if ($isMainProduct || $isMatchProduct) {
			$main_product_id = 0;
		}
		$existItemCount = count($items);
		//超过购物车数量限制，删除最老的记录
		if (false === $exist && $existItemCount > MAX_SHOPPING_CART_ITEM) {
			IBShoppingCartTTC::remove($uid, array('product_id'=> $items[$existItemCount-1]['product_id']));
		}
		unset($items);

		//这里请求多价信息，取一个最低价格给用户
//		if (isset($multiPriceInfo['from_cart_nologin']) && $multiPriceInfo['from_cart_nologin'] && isset($multiPriceInfo['price_id']) && $multiPriceInfo['price_id'] > 0) {
//			$price_id = $multiPriceInfo['price_id']; //如果是从非登录态购物车中转入，则不再检查
//		}
//		else {
//			$userLevel = -1;
//			$isTrader = 0;
//			$userInfo = IUsersTTC::get($uid, array(), array('type', 'level','retailerLevel'));
//			if (isset($userInfo[0])) {
//				$userLevel = $userInfo[0]['level'];
//				$isTrader = $userInfo[0]['retailerLevel'];
//			}
//
//			$price_id = isset($multiPriceInfo['price_id']) ? $multiPriceInfo['price_id'] : 0;
//			$multiPrice = IMultiPrice::getListPrices(array(
//									'product_id'=>$product_id,
//									'wh_id'=>$wh_id,
//									'uid'=>$uid,
//									'level'=>$userLevel,
//									'IsTrader'=>$isTrader,
//									'price_id'=>$price_id,
//									'multiPriceType'=>$product['multiprice_type'],
//								));
//
//			$price_id = 0; //默认取原价，遍历出最低的价格
//			$minPrice = $product['price'];
//			if (isset($multiPrice['Prices'])) {
//				foreach ($multiPrice['Prices'] as $pkey=>$mp) {
//					if (isset($mp['isSatisfy']) && $mp['isSatisfy'] == false) {
//						continue;
//					}
//
//					if ($mp['count_type'] == MP_COUNT_BY_DISCOUNT) { //折扣
//						 $tmp = 10 * bcdiv($product['price'] * $mp['price'], 1000, 0);
//						 if ($tmp < $minPrice) {
//						 	$minPrice = $tmp;
//						 	$price_id = $pkey;
//						 }
//					}
//					else if ($mp['count_type'] == MP_COUNT_BY_PRICE) {
//						if ($mp['price'] < $minPrice) {
//							$minPrice = $mp['price'];
//							$price_id = $pkey;
//						}
//					}
//				}
//			}
//		}

		$numNeed = $num;
		if (true === $exist) {
			$numNeed = $num + $existItemNum;
		}
		if ($numNeed > MAX_COUNT_PER_ITEM) {
			$numNeed =  MAX_COUNT_PER_ITEM;
		}

		//检查商品是否限购
		if ($product['num_limit'] <= 0) { //不限购
			$product['num_limit'] = 999;
		}

		//限购数量小于库存
//		if ($product['num_limit'] <= $product['num_available'] + $product['virtual_num']) {
//			if ($numNeed > $product['num_limit']) {
//				self::$errCode = 108;
//				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '超过限购数量个';
//				$numNeed =  $product['num_limit'];
//			}
//
//			if ($exist) {
//				if ($main_product_id > 0) {
//					if ($otag != '') {
//						$ret = IBShoppingCartTTC::update(array('uid'=>$uid, 'buy_count'=>$numNeed, 'wh_id' => 0, 'main_product_id'=> $main_product_id, 'price_id'=>$price_id, 'OTag'=>$otag), array('product_id'=>$product_id));
//					}else
//					{
//						$ret = IBShoppingCartTTC::update(array('uid'=>$uid, 'buy_count'=>$numNeed, 'wh_id' => 0, 'main_product_id'=> $main_product_id, 'price_id'=>$price_id ), array('product_id'=>$product_id));
//					}
//				}
//				else {
//					if ($otag != '') {
//						$ret = IBShoppingCartTTC::update(array('uid'=>$uid, 'buy_count'=>$numNeed, 'wh_id' => 0,  'price_id'=>$price_id, 'OTag'=>$otag), array('product_id'=>$product_id));
//					}else
//					{
//						$ret = IBShoppingCartTTC::update(array('uid'=>$uid, 'buy_count'=>$numNeed, 'wh_id' => 0, 'price_id'=>$price_id), array('product_id'=>$product_id));
//					}
//				}
//			}
//			else {
//				$param = array('uid'=>$uid, 'buy_count'=>$numNeed,'product_id'=>$product_id,  'main_product_id'=> $main_product_id, 'wh_id'=>0, 'price_id'=>$price_id, 'OTag'=>$otag);
//				$ret = IBShoppingCartTTC::insert($param);
//				
//			}
//
//			if (false === $ret) {
//				self::$errCode = IBShoppingCartTTC::$errCode;
//				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[update or insert IBShoppingCartTTC failed]' . IBShoppingCartTTC::$errMsg;
//				return false;
//			}
//
//			return true;
//		}
//		else { //库存小于限购数量
			if ($numNeed > $product['num_available'] + $product['virtual_num']) {
				if ((( $wh_id != 1) || (($product['flag'] & FORBID_SET_VIRTUAL) == FORBID_SET_VIRTUAL) || ($product['type'] != PRODUCT_TYPE_NORMAL))
					/*$product['type'] != PRODUCT_TYPE_NORMAL || $product['price'] <= $product['cost_price'] */) {
					self::$errCode = 109;
					self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '超过库存数量';
//					$numNeed =  $product['num_available'] + $product['virtual_num'];
//					if ($numNeed <= 0) {
//						return false;
//					}
					return false;
				}
			}

			$main_product_id = ($main_product_id > 0? $main_product_id : 0);

			if ($exist) {
				if ($main_product_id > 0) {
					if ($otag != '') {
						$ret = IBShoppingCartTTC::update(array('uid'=>$uid, 'buy_count'=>$numNeed, 'wh_id' => 0, 'main_product_id'=> $main_product_id, 'price_id'=>$price_id, 'OTag'=>$otag), array('product_id'=>$product_id));
					}else
					{
						$ret = IBShoppingCartTTC::update(array('uid'=>$uid, 'buy_count'=>$numNeed, 'wh_id' => 0, 'main_product_id'=> $main_product_id, 'price_id'=>$price_id ), array('product_id'=>$product_id));
					}
				}
				else {
					if ($otag != '') {
						$ret = IBShoppingCartTTC::update(array('uid'=>$uid, 'buy_count'=>$numNeed, 'wh_id' => 0,  'price_id'=>$price_id, 'OTag'=>$otag), array('product_id'=>$product_id));
					}else
					{
						$ret = IBShoppingCartTTC::update(array('uid'=>$uid, 'buy_count'=>$numNeed, 'wh_id' => 0, 'price_id'=>$price_id), array('product_id'=>$product_id));
					}
				}
			}
			else {
				$param = array('uid'=>$uid, 'buy_count'=>$numNeed,'product_id'=>$product_id,  'main_product_id'=> $main_product_id, 'wh_id'=>0, 'price_id'=>$price_id, 'OTag'=>$otag);
				$ret = IBShoppingCartTTC::insert($param);
			
			}

			if (false === $ret) {
				self::$errCode = IBShoppingCartTTC::$errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[update or insert IBShoppingCartTTC failed]' . IBShoppingCartTTC::$errMsg;
				return false;
			}

			return true;
//		}
	}

	public static function setNum($uid, $product_id, $num=1, $wh_id=1)
	{
		if (!isset($product_id) || $product_id <= 0) {
			self::$errCode = 100;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id) is invalid";
			return false;
		}
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}

		if (!isset($num) || $num <= 0 || $num > 99) {
			self::$errCode = 105;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "num($num) is invalid";
			return false;
		}
		if (!isset($wh_id) || $wh_id < 0) {
			self::$errCode = 106;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "wh_id($wh_id) is invalid";
			return false;
		}


		//获取商品分仓信息
		$product = IProductInfoTTC::get($product_id, array('wh_id'=>$wh_id));
		if (false === $product) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
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
		if ($product['num_limit'] <= 0) { //不限购
			$product['num_limit'] = 999;
		}

		$numNeed = $num;
		if ($numNeed > MAX_COUNT_PER_ITEM) {
			$numNeed =  MAX_COUNT_PER_ITEM;
		}

//		//限购数量小于库存
//		if ($product['num_limit'] <= $product['num_available'] + $product['virtual_num']) {
//			if ($numNeed > $product['num_limit']) {
//				self::$errCode = 108;
//				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '超过限购数量';
//				$numNeed =  $product['num_limit'];
//			}
//
//			$ret = IBShoppingCartTTC::update(array('uid'=>$uid, 'buy_count'=>$numNeed), array('product_id'=>$product_id));
//			if (false === $ret) {
//				self::$errCode = IBShoppingCartTTC::$errCode;
//				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[update or insert IBShoppingCartTTC failed]' . IBShoppingCartTTC::$errMsg;
//				return false;
//			}
//			return true;
//		}
//		else { //库存小于限购数量
			if ($numNeed > $product['num_available'] + $product['virtual_num']) {
				if ((( $wh_id != 1) || ($product['flag'] & FORBID_SET_VIRTUAL) == FORBID_SET_VIRTUAL || $product['type'] != PRODUCT_TYPE_NORMAL)
					/*$product['type'] != PRODUCT_TYPE_NORMAL || $product['price'] <= $product['cost_price']*/) {
					self::$errCode = 109;
					self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '超过库存数量个';
					return false;
				}
			}

			$ret = IBShoppingCartTTC::update(array('uid'=>$uid, 'buy_count'=>$numNeed), array('product_id'=>$product_id));
			if (false === $ret) {
				self::$errCode = IBShoppingCartTTC::$errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[update or insert IBShoppingCartTTC failed]' . IBShoppingCartTTC::$errMsg;
				return false;
			}

			return true;
//		}
	}

	/*
	多价信息，如果取易迅价，则可以传空
	$multiPriceInfo = array(
		'price_id' => xxx, //$price_id： 加入购物车取商品的哪一个价格，原价为0，其他价格为1-64取值
		//其他多价校验信息
	)
	*/
	public static function addToShoppingCartNoLogin($product_id, $num=1, $wh_id=1, $multiPriceInfo = array()) {
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

		//获取商品分仓信息
		$product = IProductInfoTTC::get($product_id, array('wh_id'=>$wh_id));
		if (false === $product) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
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

		// 如果是特殊商品（定制机和节能补贴）不直接加入购物车
		if ( IProduct::isCanNotAddToNormalCart($product) ) {
			return array();
		}

		//ixiuzeng添加获取商品的库存
		$productInventoryInfo = IProductInventory::getProductInventeory($product_id, $wh_id);
		if (false === $productInventoryInfo) {
			$msg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[getProductInventeory failed]' . IProductInventory::$errMsg;
			Logger::err("errCode(" . IProductInventory::$errCode . ")" . $msg);

			$product['virtual_num'] = 0;
			$product['num_available'] = 0;
			$product['psystock'] = -1;
		}
		else {
			$product['virtual_num'] = $productInventoryInfo['virtual_num'];
			$product['num_available'] = $productInventoryInfo['num_available'];
			$product['psystock'] = $productInventoryInfo['supply_stock_id'];
		}

		//检查商品是否限购
		if ($product['num_limit'] <= 0) { //不限购
			$product['num_limit'] = 999;
		}

		$numNeed = $num;
		if ($numNeed > MAX_COUNT_PER_ITEM) {
			$numNeed =  MAX_COUNT_PER_ITEM;
		}

		if ($product['num_limit'] <= $product['num_available'] + $product['virtual_num']) { //限购数量小于库存
			if ($numNeed > $product['num_limit']) {
				$numNeed = $product['num_limit'];
			}
		}
		else { //库存小于限购数量
			if ($numNeed > $product['num_available'] + $product['virtual_num']) {
				if ((( $wh_id != 1) || ($product['flag'] & FORBID_SET_VIRTUAL) == FORBID_SET_VIRTUAL || $product['type'] != PRODUCT_TYPE_NORMAL)) {
					$numNeed =  $product['num_available'] + $product['virtual_num'];
					if ($numNeed <= 0) {
						self::$errCode = 109;
						self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '库存不足，为负数';
						return false;
					}
				}
			}
		}

		$price_id = isset($multiPriceInfo['price_id']) ? $multiPriceInfo['price_id'] : 0;
		$needToLogin = false;

		//这里拉取多价格信息，看是否含有会员价以及是否满足请求价格校验条件，若有会员价，则返回错误，前端提示用户登录
		$multiPrice = IMultiPrice::getListPrices(array(
																		'product_id'=>$product_id,
																		'wh_id'=>$wh_id,
																		'uid'=>0,
																		'level'=>0,
																		'IsTrader'=>false,
																		'price_id'=>$price_id,
																		'multiPriceType'=>$product['multiprice_type'],
																	));
		if (isset($multiPrice['hasVip']) && $multiPrice['hasVip'] == true) {
			$needToLogin = true;
		}

		$mPrice = null;
		if ($price_id > 0 && isset($multiPrice['Prices'][$price_id]) && $multiPrice['Prices'][$price_id]['isSatisfy'] == true) {
			$mPrice = $multiPrice['Prices'][$price_id]; //将生效的“多价格”返回，用于前台显示
		}
		else {
			$price_id = 0;
		}

		return array (
			'product_id'		=> $product_id,
			'num'				=> $numNeed,
			'need_to_login'	=> $needToLogin,
			'price_id'			=> $price_id,
			'price' 				=> $mPrice,
		);
	}

	/**
	 * 展示指定用户id的购物车中的信息
	 * @param $uid
	 * @param $wh_id
	 * @param $reqFromWireless
	 * @return mixed 成功是返回array
	 * array(
	 * 		discount_price //多价格金额
	 * 		discount_p_name //多价格名称
	 * )
	 *
	 */
	public static function view($uid , $wh_id, $reqFromWireless = false) {
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}

		$items = IBShoppingCartTTC::get($uid, array(), array('product_id', 'buy_count', 'main_product_id', 'price_id'));
		if (false === $items) {
			self::$errCode = IBShoppingCartTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IBShoppingCartTTC failed]' . IBShoppingCartTTC::$errMsg;
			return false;
		}
		if (count($items) == 0) {
			return  array();
		}

		$deleteProductIds = array();
		$productIds = array();
		//$multiPriceProduct = array();
		foreach ($items as $key => $item) {
			if ($item['product_id'] > 0) {
				$productIds[] = $item['product_id'];
				if ($item['price_id'] > 0) { //如果是取特殊价格
				//	$multiPriceProduct[$item['product_id']]['price_id'] = $item['price_id'];
				//	$multiPriceProduct[$item['product_id']]['multiPriceType'] = 0; //默认都没有特殊价格
				}
			}
			else {
				$deleteProductIds[] = $item['product_id'];
				unset($items[$key]);
			}
		}
        $dprice = IBProduct::getProductDistributionPrice($uid, $productIds);
        if (false === $dprice)
        {
        	self::$errCode = IBProduct::$errCode;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[invoke IBProduct::getProductDistributionPrice() failed]' . IBProduct::$errMsg;
            return false;
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
		foreach ($items as $key => $item) {
			$exist = false;
			foreach ($products as $product) {
				if ( $item['product_id'] == $product['product_id']) {
					$items[$key]['name'] = $product['name'];
					$items[$key]['size'] = isset($_PROD_SIZE_2[$product["size"]])? $_PROD_SIZE_2[$product["size"]] : "";
					$items[$key]['color'] = isset($_ColorList[$product["color"]]) ? $_ColorList[$product["color"]] : "";
					$items[$key]['product_char_id'] = $product['product_char_id'];
					$items[$key]['pic_num'] = $product['pic_num'];
					$items[$key]['weight'] = $product['weight'];
					
					$productIds[] = $item['product_id'];
					$exist = true;
					break;
				}
			}
			if (false == $exist) {
				unset($items[$key]);
				$deleteProductIds[] = $item['product_id'];
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
			self::$errMsg = IProductInventory::$errMsg;
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
		//剔除无价格信息的商品
		global $_StockToWhidTransitDays;
		global $_Wh_id;
		global $_StockToStation;
		foreach ($items as $key => $item) {
			$exist = false;
			foreach ($productWhInfo as $pwinfo) {
				if ($pwinfo['product_id'] == $item['product_id']) {

					if ($wh_id == 1 && $reqFromWireless == true && $pwinfo['psystock'] != 1) { //无线请求只支持1号仓的商品
						unset($items[$key]);
						IBShoppingCartTTC::remove($uid, array('product_id'=>$item['product_id']));
						continue;
					}

					$items[$key]['market_price'] = $pwinfo['market_price'];
					$items[$key]['price'] = $dprice[$item['product_id']];
					//$items[$key]['price'] = $pwinfo['price'] + $pwinfo['cash_back'];
					$items[$key]['cash_back'] = $pwinfo['cash_back'];
					$items[$key]['point'] = $pwinfo['point'];
					$items[$key]['num_limit'] = $pwinfo['num_limit'];
					$items[$key]['type'] = $pwinfo['type'];
					$items[$key]['psystock'] = $pwinfo['psystock'];

//					if (isset($multiPriceProduct[$item['product_id']])) {
//						$multiPriceProduct[$item['product_id']]['multiPriceType'] = $pwinfo['multiprice_type'];
//					}

					if (($pwinfo['num_available'] + $pwinfo['virtual_num'] >=  $item['buy_count'])
						|| (( $wh_id == 1) && ($pwinfo['flag'] & FORBID_SET_VIRTUAL) != FORBID_SET_VIRTUAL && $pwinfo['type'] == PRODUCT_TYPE_NORMAL)
							  /* ($items[$key]['type'] == PRODUCT_TYPE_NORMAL && $pwinfo['price'] > $pwinfo['cost_price'])*/) {
						if ($pwinfo['num_available'] >= $item['buy_count']) { //实际库存足够
							if(!isset($_StockToWhidTransitDays[$pwinfo['psystock']][$wh_id]) || $_StockToWhidTransitDays[$pwinfo['psystock']][$wh_id] == 0)
							{
								$items[$key]['array_days'] = $_StockTips['available'];
							}else
							{
								$items[$key]['array_days'] = "有货，待{$_Wh_id[$_StockToStation[$pwinfo['psystock']]]}仓调拨，{$_StockToWhidTransitDays[$pwinfo['psystock']][$wh_id]}天后配送";
							}
						}
						else if ($pwinfo['arrival_days'] == VIRTUAL_STOCK_ARRAY_1_3DAYS) {
							$items[$key]['array_days'] = $_StockTips['arrival1-3'];
						}
						else {
							$items[$key]['array_days'] = $_StockTips['arrival2-7'];
						}
					}
					else {
						$items[$key]['array_days'] = $_StockTips['not_available'];
					}

					$productIds[] = $item['product_id'];
					$exist = true;
					break;
				}
			}

			if (false === $exist) {
				$deleteProductIds[] = $item['product_id'];
				unset($items[$key]);
			}
		}

//		//拉取多价信息
//		if (count($multiPriceProduct) > 0) {
//			$multiPriceInfo = IMultiPrice::getCartPrices(array('wh_id'=>$wh_id, 'product'=>$multiPriceProduct));
//			if (isset($multiPriceInfo['Prices']) && is_array($multiPriceInfo['Prices'])) {
//				foreach ($multiPriceInfo['Prices'] as $pid => $mp) {
//					if ($mp['isSatisfy'] == true) { //满足多价信息
//						foreach ($items as $key=>$item) {
//							if ($item['product_id'] == $pid) {
//								if ($mp['count_type'] == MP_COUNT_BY_DISCOUNT) { //折扣
//									 $items[$key]['discount_price'] = 10 * bcdiv($items[$key]['price'] * $mp['price'], 1000, 0) + $items[$key]['cash_back'];
//								}
//								else if ($mp['count_type'] == MP_COUNT_BY_PRICE) {
//									 $items[$key]['discount_price'] = $mp['price'] + $items[$key]['cash_back'];
//								}
//								$items[$key]['discount_p_name'] = $mp['price_name'];
//							}
//						}
//					}
//				}
//			}
//		}

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
				   (($gsi['num_available'] + $gsi['virtual_num'] > 0) || COMPONENT_TYPE==$products_gifts_type[$gv['product_id']][$gv['gift_id']][$gv['stock_id']]))
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
				continue;
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
				if (($gift['product_id'] == $item['product_id']) && ($gift['stock_id'] == $item['psystock']) && 
					($gifts_status[$gift['gift_id']][$_StockToStation[$gift['stock_id']]] != PRODUCT_STATUS_NORMAL)) //赠品组件的状态不可能是出售状态
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

		//处理随心配
		$easyMainProduct = array();
		foreach ($items as $key=>$item) {
			if ($item['main_product_id'] > 0 ) {
				$mainProductExist = false;
				foreach ($items as $ii) {
					if ($ii['product_id'] == $item['main_product_id'] ) {
							$mainProductExist = true;
							$items[$key]['matchNum'] = $ii['buy_count'] < $item['buy_count'] ? $ii['buy_count'] : $item['buy_count'];
							break;
						}
				}

				if (false === $mainProductExist) {
					$items[$key]['main_product_id'] = 0;
				}
				else {
					$easyMainProduct[$item['main_product_id']] = $item['main_product_id'];
				}
			}
		}

		//拉取随心配
		//ixiuzeng添加，广东站的随心配从广东站获取，上海和北京的随心配依然从上海获取
		$wh_id_temp = null;
		if (1001 == $wh_id) {
			$wh_id_temp = 1001;
		}
		else {
			$wh_id_temp = 1;
		}

		$easyMatch = IProductRelativityTTC::gets($easyMainProduct, array('type'=>PRODUCT_BY_MIND, 'status'=>1, 'wh_id' => $wh_id_temp));
		if (false === $easyMainProduct) {
			self::$errCode = IProductRelativityTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductRelativityTTC failed]' . IProductRelativityTTC::$errMsg;
			return false;
		}

		if (count($easyMatch) > 0) {
			foreach ($items as $key => $item) {
				if ($item['main_product_id'] > 0) {
					foreach ($easyMatch as $em) {
						if ($item['main_product_id'] == $em['product_id'] && $em['type'] == PRODUCT_BY_MIND && $item['product_id'] == $em['relative_id']) {
							$cut = intval($em['property']);
							$cut = $cut > 0? $cut : 0;
							$items[$key]['match_cut'] = $cut;
						}
					}
				}
			}
		}

		//删除不合法的购物车商品
		foreach ($deleteProductIds as $id) {
			IBShoppingCartTTC::remove($uid, array('product_id'=>$id));
		}
		return $items;
	}

	public static function clear($uid , $wh_id =1) {
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}
		$ret = IBShoppingCartTTC::remove($uid);
		if (false === $ret) {
			self::$errCode = IBShoppingCartTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IBShoppingCartTTC failed]' . IBShoppingCartTTC::$errMsg;
			return false;
		}
		return true;
	}

	public static  function remove($uid,$product_id, $wh_id)
	{
		if (!isset($product_id) || $product_id <= 0) {
			self::$errCode = 100;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id) is invalid";
			return false;
		}
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}


		$item = IBShoppingCartTTC::remove($uid, array('product_id'=>$product_id));
		if (false === $item) {
			self::$errCode = IBShoppingCartTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IBShoppingCartTTC failed]' . IBShoppingCartTTC::$errMsg;
			return false;
		}
	}

	public static function getCountAndPrice($uid, $wh_id=1)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}

		$items = IBShoppingCartTTC::get($uid);
		if (false === $items) {
			self::$errCode = IBShoppingCartTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IBShoppingCartTTC failed]' . IBShoppingCartTTC::$errMsg;
			return false;
		}
		$totalItem = 0;
		foreach ($items as &$item)
		{
			$totalItem += $item['buy_count'];
		}
			return array('uid' => $uid, 'totalnum' => $totalItem);
	}

}