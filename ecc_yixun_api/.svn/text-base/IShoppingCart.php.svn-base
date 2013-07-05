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

class IShoppingCart
{
	public static $errCode = 0;
	public static $errMsg = '';
	public static $buyNeedNum = 0;

	const ITEM_NORMAL = 0; // 普通商品
	const ITEM_PACKAGE = 1; // 套餐商品
	const NOT_BELONG_PACKAGE = 0; // 表示商品不属于任何套餐

	// 商品个数上限
	const MAX_SHOPPING_CART_ITEM = 50;

	// 每种商品的个数上限
	const MAX_COUNT_PER_ITEM = 99;

	// 商品字符串最大长度
	const MAX_ITEM_LENGTH = 10000;

	// 购物车类别
	const ONLINE_CART = 0; //正常在线TTC购物车
	const INSTALLMENT_CART = 1; //分期付款
	const ES_CART = 2; // 节能补贴
	const OFFLINE_CART = 3; // 正常离线购物车

	private static $default = array(
		'buy_count' => 1,
		'price_id'  => 0,
		'OTag'      => '',
		'type'      => self::ITEM_NORMAL,
		'wh_id'     => SITE_SH
	);

	/**
	 * 设置错误码和错误信息
	 * @param mixed $mix error code or class name
	 * @param string $msg
	 * @return null
	 */
	private static function setErr($mix, $msg = '')
	{
		if (is_numeric($mix)) {
			self::$errCode = $mix;
			self::$errMsg = $msg;
		} else if (class_exists($mix)) {
			$vars = get_class_vars($mix);
			if (isset($vars['errCode'])) {
				self::$errCode = $vars['errCode'];
				self::$errMsg = $vars['errMsg'];
			}
		}
	}

	//客户切换站点，需要清理购物车中，在新分站不销售的商品
	//$productIdArr = array(pid1,pid2,pid3)
	public static function tryJumpToAnotherSubSiteNoLogin($productIds, $new_wh_id)
	{
		//拉取商品分仓信息
		$products = IProductInfoTTC::gets($productIds, array('wh_id' => $new_wh_id), array('product_id', 'status'));
		if (false === $products) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
			return false;
		}
		if (count($products) == 0) {
			return array();
		}

		$returnArr = array();
		$productIds = array();
		foreach ($products as $p) {
			if ($p['status'] != PRODUCT_STATUS_NORMAL) {
				$returnArr[$p['product_id']] = "";
				$productIds[] = $p['product_id'];
			}
		}
		if (count($productIds) == 0) {
			return array();
		}

		//拉取不售的商品名称
		$productCommon = IProductCommonInfoTTC::gets($productIds, array(), array('product_id', 'name'));
		if (false === $productCommon) {
			//TTC error
		} else {
			foreach ($productCommon as $pc) {
				$returnArr[$pc['product_id']] = $pc['name'];
			}
		}

		return $returnArr;
	}

	//客户切换站点， 需要清理购物车中， 在新分站不销售的商品
	public static function tryJumpToAnotherSubSite($uid, $new_wh_id)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}

		$items = self::get($uid);
		if (false === $items) {
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query get failed]' . self::$errMsg;
			return false;
		}
		if (count($items) == 0) {
			return array();
		}

		$productIds = array();
		foreach ($items as $key => $item) {
			$productIds[] = $item['product_id'];
		}
		//拉取商品分仓信息
		$products = IProductInfoTTC::gets($productIds, array('wh_id' => $new_wh_id), array('product_id', 'status'));
		if (false === $products) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
			return false;
		}
		if (count($products) == 0) {
			return array();
		}

		$returnArr = array();
		$productIds = array();
		foreach ($products as $p) {
			if ($p['status'] != PRODUCT_STATUS_NORMAL) {
				$returnArr[$p['product_id']] = "";
				$productIds[] = $p['product_id'];
			}
		}

		if (count($productIds) == 0) {
			return array();
		}

		//拉取不售的商品名称
		$productCommon = IProductCommonInfoTTC::gets($productIds, array(), array('product_id', 'name'));
		if (false === $productCommon) {
			//TTC error
		} else {
			foreach ($productCommon as $pc) {
				$returnArr[$pc['product_id']] = $pc['name'];
			}
		}

		return $returnArr;
	}


	/**
	 * 添加单个“商品/套餐”到购物车中
	 * @param int $uid 用户ID
	 * @param array $productNew “商品/套餐”信息
	包含以下字段：
	 * 'product_id' => $pid,
	 * 'buy_count' => $pnum,
	 * 'wh_id' => $whId,
	 * 'main_product_id' => $main_product_id,
	 * 'price_id' => $price_id,
	 * 'type' => $type,
	 * 'OTag' => $otag
	 * 'reqFromMobile' => $bool
	 * @return mixed
	 */
	public static function add($uid, $productNew)
	{
		$productNew['uid'] = $uid;
		$productNew = self::checkParam($productNew);
		if (false === $productNew) {
			return false;
		}

		$product_id = $productNew['product_id'];
		$num = $productNew['buy_count'];
		$wh_id = $productNew['wh_id'];
		$otag = $productNew['OTag'];
		$main_product_id = $productNew['main_product_id'];
		$type = $productNew['type'];
		$reqFromMobile = isset($productNew['reqFromMobile']) ? (bool)$productNew['reqFromMobile'] : false; //false by default
		$district_id = isset($productNew['prid']) ? $productNew['prid'] : 0;//区id


		//拉取购物车中已有信息
		$items = self::get($uid);
		if (false === $items) {
			return false;
		}

		switch ($type) {
			case IShoppingCart::ITEM_NORMAL: //商品
				$product = IProductInfoTTC::get($product_id, array('wh_id' => $wh_id)); //获取商品分仓信息
				if (false === $product) {
					self::setErr('IProductInfoTTC');
					return false;
				} else if (count($product) < 1) {
					self::setErr(107, basename(__FILE__, '.php') . " |" . __LINE__ . '商品信息不存在');
					return false;
				} else if ($product[0]['status'] != PRODUCT_STATUS_NORMAL) {
					self::setErr(110, basename(__FILE__, '.php') . " |" . __LINE__ . '商品暂不销售');
					return false;
				}

				// 如果是特殊商品（定制机和节能补贴）不直接加入购物车
				if (IProduct::isCanNotAddToNormalCart($product[0])) {
					return array();
				}

				//添加获取多个商品的库存@ixiuzeng
				$result = IProductInventory::setProductsInventoryInfo(array($product_id), $wh_id, $product,$district_id);
				if (false === $result) {
					self::setErr('IProductInventory');
					return false;
				}
				$productInventoryInfo = $result['inventoryInfo'];
				$product = $result['productWhInfo'][0];

				$exist = false;
				$isMainProduct = false;
				$isMatchProduct = false;
				$existItemNum = 0;
				foreach ($items as $key => $item) {
					if ($product_id == $item['product_id']) { //购物车中已有当前商品
						$exist = true;
						$existItemNum = $item['buy_count'];
						if ($main_product_id == 0) {
							break;
						}
					}

					if ($item['main_product_id'] > 0) {
						if ($product_id == $item['main_product_id']) { //$product_id 作为附属商品，所以其不能已经是主商品
							$isMainProduct = true;
						}
						if ($main_product_id > 0 && $main_product_id == $item['product_id']) { //$product_id 作为主商品，所以其不能已经是附属商品
							$isMatchProduct = true;
						}
					}
				}
				if ($isMainProduct || $isMatchProduct) {
					$main_product_id = 0;
				}

				//超过购物车数量限制，删除最老的记录
				$existItemCount = count($items);
				if (false === $exist && $existItemCount > self::MAX_SHOPPING_CART_ITEM) {
					self::removeCart($uid, array('product_id' => $items[$existItemCount - 1]['product_id']));
				}

				//购买数量 $numNeed 处理
				$numNeed = min($num + $existItemNum, self::MAX_COUNT_PER_ITEM);
				$numNeed = self::checkProductNumLimit($numNeed, $product_id, $wh_id,$district_id);
				if (false === $numNeed) {
					return false;
				}

				// 多价处理
				// TODO 这部分多价代码，需要提取出去
				if (isset($productNew['price_id']) && $productNew['price_id'] > 0 /*price_id 有效*/
					&& isset($productNew['from_cart_nologin']) && $productNew['from_cart_nologin'] /*手动打标，强制加入*/
				) {

					$price_id = $productNew['price_id']; //如果是从非登录态购物车中转入，则不再检查
				} else { //这里请求多价信息，取一个最低价格给用户
					$userLevel = -1;
					$isTrader = 0;
					$userInfo = IUsersTTC::get($uid, array(), array('type', 'level', 'retailerLevel'));
					if (isset($userInfo[0])) {
						$userLevel = $userInfo[0]['level'];
						$isTrader = $userInfo[0]['retailerLevel'];
					}

					$price_id = isset($productNew['price_id']) ? $productNew['price_id'] : 0;
					if ($price_id > 0) {
						$multiPrice = IMultiPrice::getListPrices(array(
							'product_id'     => $product_id,
							'wh_id'          => $wh_id,
							'uid'            => $uid,
							'level'          => $userLevel,
							'IsTrader'       => $isTrader,
							'price_id'       => $price_id,
							'multiPriceType' => $product['multiprice_type'],
						));

						$price_id = 0; //默认取原价，遍历出最低的价格
						$minPrice = $product['price'];
						if (isset($multiPrice['Prices'])) {
							foreach ($multiPrice['Prices'] as $pkey => $mp) {
								if (isset($mp['isSatisfy']) && $mp['isSatisfy'] == false) {
									continue;
								} else if (!$reqFromMobile && in_array($pkey, range(40, 42))) {
									continue; //来自手机，才能使用40～42
								}

								if ($mp['count_type'] == MP_COUNT_BY_DISCOUNT) { //折扣
									$tmp = 10 * bcdiv($product['price'] * $mp['price'], 1000, 0);
									if ($tmp < $minPrice) {
										$minPrice = $tmp;
										$price_id = $pkey;
									}
								} else if ($mp['count_type'] == MP_COUNT_BY_PRICE) {
									if ($mp['price'] < $minPrice) {
										$minPrice = $mp['price'];
										$price_id = $pkey;
									}
								}
							}
						}
					}
				}

				//具体操作 TTC
				$baseAry = array(
					'uid'       => $uid,
					'buy_count' => $numNeed,
					'wh_id'     => $wh_id,
					'price_id'  => $price_id,
					'type'      => IShoppingCart::ITEM_NORMAL,
				);
				if ($exist) { //更新
					if ($main_product_id > 0) {
						$baseAry['main_product_id'] = $main_product_id;
					}
					if ($otag != '') {
						$baseAry['OTag'] = $otag;
					}

					$ret = self::updateCart($baseAry, array('product_id' => $product_id, 'type' => $type));
				} else { //插入
					$baseAry['product_id'] = $product_id;
					$baseAry['main_product_id'] = $main_product_id;
					$baseAry['OTag'] = $otag;
					$ret = self::insertCart($baseAry);
				}
				if (false === $ret) {
					self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [update or insert ShoppingCartTTC failed]' . self::$errMsg;
					return false;
				}
				break;

			case IShoppingCart::ITEM_PACKAGE: //套餐
				$exist = false;

				$baseAry = array();
				foreach ($items as $key => $item) {
					if ($item['product_id'] == $product_id) { // 商品已存在，累加个数
						$exist = true;

						$baseAry = $item;
						$baseAry['buy_count'] += $num;
						$baseAry['OTag'] = !empty($otag) ? $otag : $items[$key]['OTag'];
						break;
					}
				}

				if ($exist && !empty($baseAry)) { //更新
					$ret = self::updateCart($baseAry, array('product_id' => $product_id, 'type' => $type));
				} else { //插入 TTC
					$baseAry = array(
						'product_id' => $product_id,
						'uid'        => $uid,
						'buy_count'  => $num,
						'wh_id'      => $wh_id,
						'OTag'       => $otag,
						'type'       => IShoppingCart::ITEM_PACKAGE,
					);
					$ret = self::insertCart($baseAry);
				}
				if (false === $ret) {
					self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [update or insert ShoppingCartTTC failed]' . self::$errMsg;
					return false;
				}
				break;

			default:
				self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' 非法商品类型';
				return false;
		}

		return true;
	}

	/**
	 * 修改购物车中商品的数量
	 * @param int $uid
	 * @param int $product_id
	 * @param int $num
	 * @param int $wh_id
	 * @return mixed false 修改失败；
	 */
	public static function setNum($uid, $product_id, $num = 1, $wh_id = 1, $type = IShoppingCart::ITEM_NORMAL, $district_id = 0)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}
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
		if (!isset($wh_id) || $wh_id < 0) {
			self::$errCode = 106;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "wh_id($wh_id) is invalid";
			return false;
		}


		if ($type == IShoppingCart::ITEM_NORMAL) {

			$numNeed = self::checkProductNumLimit($num, $product_id, $wh_id,$district_id);
			if (false === $numNeed)
				return false;
		} else if ($type == IShoppingCart::ITEM_PACKAGE) {
			$ret = self::checkSuitNumLimit($num, $product_id, $wh_id, $district_id);
			if (false === $ret)
				return false;
			$numNeed = $ret['numNeedMin'];
		} else {
			self::$errCode = 111;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "商品类型{$type}不正确";
			return false;
		}

		$ret = self::updateCart(
			array(
				'uid'       => $uid,
				'buy_count' => $numNeed
			),
			array(
				'product_id' => $product_id,
				'type'       => $type
			)
		);

		if (false === $ret) {
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [update or updateCart failed]' . self::$errMsg;
			return false;
		}
		return true;
	}

	/*
	 多价信息，如果取易迅价，则可以传空
	 $multiPriceInfo = array(
		'price_id' => xxx, //$price_id： 加入购物车取商品的哪一个价格，原价为0，其他价格为1-64取值
		//其他多价校验信息
		)
		*/
	/**
	 * 尝试添加单个“商品”/“套餐”到购物车
	 * @param array $productNew
	 * @return mixed
	 */
	public static function addToShoppingCartNoLogin($productNew)
	{
		$productNew = self::checkParam($productNew, self::OFFLINE_CART);
		if (false === $productNew) {
			return false;
		}

		$product_id = $productNew['product_id']; //商品 / 套餐 ID
		$wh_id = $productNew['wh_id'];
		$num = $productNew['buy_count'];
		$type = $productNew['type'];
		$district_id = isset($productNew['prid']) ? $productNew['prid'] : 0;

		switch ($type) {
			case IShoppingCart::ITEM_NORMAL:

				//获取商品分仓信息
				$product = IProductInfoTTC::get($product_id, array('wh_id' => $wh_id));
				if (false === $product) {
					self::$errCode = IProductInfoTTC::$errCode;
					self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
					return false;
				}
				if (count($product) < 1) {
					self::$errCode = 107;
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '商品不存在';
					return false;
				}
				if ($product[0]['status'] != PRODUCT_STATUS_NORMAL) {
					self::$errCode = 110;
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '商品暂不销售';
					return false;
				}

				// 如果是特殊商品（定制机和节能补贴）不直接加入购物车
				if (IProduct::isCanNotAddToNormalCart($product[0])) {
					return array();
				}

				//ixiuzeng添加获取多个商品的库存
				$result = IProductInventory::setProductsInventoryInfo(array($product_id), $wh_id, $product, $district_id);
				if (false === $result) {
					self::$errCode = IProductInventory::$errCode;
					self::$errMsg = IProductInventory::$errMsg;
					return false;
				}

				$productInventoryInfo = $result['inventoryInfo'];
				$product = $result['productWhInfo'][0];

				$numNeed = min($num, self::MAX_COUNT_PER_ITEM);
				$numNeed = self::checkProductNumLimit($numNeed, $product_id, $wh_id,$district_id);
				if (false === $numNeed) {
					return false;
				}

				$price_id = isset($productNew['price_id']) ? $productNew['price_id'] : 0;
				$needToLogin = false;

				//这里拉取多价格信息，看是否含有会员价以及是否满足请求价格校验条件，若有会员价，则返回错误，前端提示用户登录
				$multiPrice = IMultiPrice::getListPrices(array(
					'product_id'     => $product_id,
					'wh_id'          => $wh_id,
					'uid'            => 0,
					'level'          => 0,
					'IsTrader'       => false,
					'price_id'       => $price_id,
					'multiPriceType' => $product['multiprice_type'],
				));

				if (isset($multiPrice['hasVip']) && $multiPrice['hasVip'] == true) {
					$needToLogin = true;
				}

				$mPrice = 0;
				if ($price_id > 0 && isset($multiPrice['Prices'][$price_id]) && $multiPrice['Prices'][$price_id]['isSatisfy'] == true) {
					$mPrice = $multiPrice['Prices'][$price_id]; //将生效的“多价格”返回，用于前台显示
				} else {
					$price_id = 0;
				}

				return array(
					'product_id'    => $product_id,
					'num'           => $numNeed,
					'need_to_login' => $needToLogin,
					'price_id'      => $price_id,
					'price'         => $mPrice,
				);
			// IShoppingCart::ITEM_PRODUCT end

			case IShoppingCart::ITEM_PACKAGE:
				$ret = self::checkSuitNumLimit($num, $product_id, $wh_id, $district_id);
				if (false === $ret)
					return false;

				return $ret['suiteInfo'];
			// IShoppingCart::ITEM_PACKAGE end
			default:
				self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' 非法商品类型';
				return false;

		} //end of switch
	}

	/**
	 * 展示指定用户id的购物车中的信息
	 * @param $uid
	 * @param $wh_id
	 * @param $reqFromWireless
	 * @return mixed 成功是返回array
	 * array(
	 *         discount_price //多价格金额
	 *         discount_p_name //多价格名称
	 * )

	 */
	public static function view($uid, $wh_id, $reqFromWireless = false) {
		if (!isset($uid) || $uid <= 0) {
			self::setErr(101, basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid");
			return false;
		}

		$items = self::get($uid);
		if (false === $items) {
			self::setErr(IShoppingCartTTC::$errCode, basename(__FILE__, '.php') . " |" . __LINE__ . '[query IShoppingCartTTC failed]' . IShoppingCartTTC::$errMsg);
			return false;
		}

		return self::_view($login=true, $items, $wh_id, $reqFromWireless);
	}

	// 展示购物车中的信息（没有登录）
	//items: array('product_id', 'buy_count', 'main_product_id', 'price_id')
	public static function viewNoLogin($items, $wh_id=1, $reqFromWireless = false) {
		if (count($items) == 0) {
			return array();
		}

		return self::_view($login=false, $items, $wh_id, $reqFromWireless);
	}

	/**
	 * 合并、抽取原本 view 和 viewNoLogin 部分代码。
	 * @param bool $login 登录状态
	 * @param array $items 结果集
	 * @param int $wh_id 分站id
	 * @param bool $reqFromWireless 来自手机？
	 * @return mixed array 结果集; false 失败
	 */
	private static function _view($login, &$items, $wh_id, $reqFromWireless = false) {
		if ($reqFromWireless) { //为手机端过滤掉套餐
			$items = IShoppingCart::filterPackageItems($items);
			if (count($items) == 0) {
				return array();
			}
		}

		$productIds = array();
		$deleteProductIds = array();
		$multiPriceProduct = array(); //多价商品
		foreach ($items as $key => &$item) {
			if ($item['product_id'] > 0) {
				$productIds[] = $item['product_id'];

				if (isset($item['price_id']) && $item['price_id'] > 0) { //如果是取多价格
					$multiPriceProduct[$item['product_id']]['price_id'] = $item['price_id'];
					$multiPriceProduct[$item['product_id']]['multiPriceType'] = 0; //默认都没有特殊价格
				}
			} else {
				$deleteProductIds[] = $item['product_id'];
				unset($items[$key]);
			}
		}

		//拉取商品分仓信息
		$products = IProductCommonInfoTTC::gets(array_unique($productIds));
		if (false === $products) {
			self::$errCode = IProductCommonInfoTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IProductCommonInfoTTC failed]' . IProductCommonInfoTTC::$errMsg;
			return false;
		}
		if (count($products) == 0) {
			return array();
		}

		//剔除没有商品基本信息的商品
		global $_ColorList, $_PROD_SIZE_2;
		foreach ($items as $key => &$item) {
			$exist = false;

			foreach ($products as &$product) {
				if ($item['product_id'] == $product['product_id']) {
					$exist = true;
					$productIds[] = $item['product_id'];

					$item['color'] = isset($_ColorList[$product['color']]) ? $_ColorList[$product['color']] : '';
					$item['pic_num'] = $product['pic_num'];
					$item['product_char_id'] = $product['product_char_id'];
					$item['size'] = isset($_PROD_SIZE_2[$product['size']]) ? $_PROD_SIZE_2[$product['size']] : '';
					$item['name'] = $product['name'];
					$item['weight'] = $product['weight'];

					break;
				}
			}

			if (false == $exist) {
				$deleteProductIds[] = $item['product_id'];
				unset($items[$key]);
			}
		}
		unset($products);
		$productIds = array_unique($productIds);

		//拉取商品分仓价格
		$productWhInfo = IProductInfoTTC::gets($productIds, array('wh_id' => $wh_id));
		if (false === $productWhInfo) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
			return false;
		}
		//获取多个商品的库存@ixiuzeng
		$result = IProductInventory::setProductsInventoryInfo($productIds, $wh_id, $productWhInfo);
		if (false === $result) {
			self::$errCode = IProductInventory::$errCode;
			self::$errMsg = IProductInventory::$errMsg;
			return false;
		}
		$productsInventoryInfo = $result['inventoryInfo'];
		$productWhInfo = $result['productWhInfo'];

		$productIds = array(); //reset

		global $_Wh_id;
		global $_StockStatus, $_StockToStation;
		global $_StockTips, $_StockToWhidTransitDays;
		//剔除无价格信息的商品
		foreach ($items as $key => &$item) {
			$exist = false;

			foreach ($productWhInfo as &$pwinfo) {
				if ($pwinfo['product_id'] == $item['product_id']) {
					/*
					if ($reqFromWireless && $wh_id == 1 && $pwinfo['psystock'] != 1) { //无线请求只支持1号仓的商品
						$deleteProductIds[] = $item['product_id'];
						unset($items[$key]);
						continue;
					}
					*/

					$exist = true;
					$productIds[] = $item['product_id'];

					self::extendProductStockStatus($wh_id, $item, $pwinfo); //属性扩展
					if (isset($multiPriceProduct[$item['product_id']])) {
						$multiPriceProduct[$item['product_id']]['multiPriceType'] = $pwinfo['multiprice_type'];
					}

					break;
				}
			} //end foreach

			if (false === $exist) {
				$deleteProductIds[] = $item['product_id'];
				unset($items[$key]);
			}
		}

		if (!empty($productIds)) {
			$productIds = array_unique($productIds);

			//拉取赠品信息@ixiuzeng
			$gifts = IGiftNewTTC::gets($productIds, array('status' => GIFT_STATUS_OK));
			if (false === $gifts) {
				self::$errCode = IGiftNewTTC::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IGiftNewTTC failed]' . IGiftNewTTC::$errMsg;
				return false;
			}
			if (!empty($gifts)) {
				//剔除掉与主商品不在一个物理分仓的赠品
				$giftsValid = array();
				$gifts_ids = array();

				$products_psy = array();
				$products_gifts_type = array();
				foreach ($productWhInfo as &$pwinfo) {
					$products_psy[$pwinfo['product_id']] = $pwinfo['psystock'];

					foreach ($gifts as &$gi) {
						if (($pwinfo['product_id'] == $gi['product_id']) && ($_StockToStation[$pwinfo['psystock']] == $gi['stock_id'])) {
							$giftsValid[] = $gi;
							$gifts_ids[] = $gi['gift_id'];
							$products_gifts_type[$gi['product_id']][$gi['gift_id']][$gi['stock_id']] = $gi['type'];
						}
					}
				}
				unset($gifts);

				//处理赠品
				if (!empty($gifts_ids)) {
					//分别剔除掉每个商品中所有没有库存的赠品
					$giftsInventorys = IInventoryStockTTC::gets(array_unique($gifts_ids), array('status' => 0));
					if (false === $giftsInventorys) {
						self::$errCode = IInventoryStockTTC::$errCode;
						self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IInventoryStockTTC failed]' . IInventoryStockTTC::$errMsg;
						return false;
					}

					$gifts_final_ids = array();
					$giftValidInventory = array();
					foreach ($giftsValid as $gv) {
						foreach ($giftsInventorys as $gsi) {
							if (($gv['gift_id'] == $gsi['product_id']) && ($products_psy[$gv['product_id']] == $gsi['stock_id'])
								&& (($gsi['num_available'] + $gsi['virtual_num'] > 0) || COMPONENT_TYPE == $products_gifts_type[$gv['product_id']][$gv['gift_id']][$gv['stock_id']]) ) {

								$giftValidInventory[] = $gv;
								$gifts_final_ids[] = $gv['gift_id'];
								break;
							}
						}
					}

					//拉取礼品商品的基本信息
					$gift_base_info = IProductCommonInfoTTC::gets(array_unique($gifts_final_ids), array(), array('name', 'product_char_id', 'weight', 'pic_num'));
					if (false === $gift_base_info) {
						self::$errCode = IProductCommonInfoTTC::$errCode;
						self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IProductCommonInfoTTC failed]' . IProductCommonInfoTTC::$errMsg;
						return false;
					}

					//剔除基本信息不存在的礼品
					$gift_ids_baseinfo = array();
					foreach ($giftValidInventory as $key => $gift) {
						$exist = false;
						foreach ($gift_base_info as $g_base) {
							if ($g_base['product_id'] == $gift['gift_id']) {
								$exist = true;
								$gift_ids_baseinfo[] = $gift['gift_id'];

								$giftValidInventory[$key]['name'] = $g_base['name'];
								$giftValidInventory[$key]['product_char_id'] = $g_base['product_char_id'];
								$giftValidInventory[$key]['weight'] = $g_base['weight'];
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
					$gift_wh_info = IProductInfoTTC::gets(array_unique($gifts_final_ids), array(), array('product_id', 'wh_id', 'status'));
					$gifts_status = array();
					if (false === $gift_wh_info) {
						self::$errCode = IProductInfoTTC::$errCode;
						self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
						return false;
					}
					foreach ($gift_wh_info as $gwi) {
						$gifts_status[$gwi['product_id']][$gwi['wh_id']] = $gwi['status'];
					}

					//将赠品与其对应的主商品进行绑定
					foreach ($items as $key => &$item) {
						$items[$key]['gift'] = array();

						foreach ($giftValidInventory as $gift) {
							if (($gift['product_id'] == $item['product_id']) && ($_StockToStation[$gift['stock_id']] == $_StockToStation[$item['psystock']]) /* 赠品跟主商品同一个物理分仓 */
								&& ($gifts_status[$gift['gift_id']][$_StockToStation[$gift['stock_id']]] != PRODUCT_STATUS_NORMAL) /*赠品组件的状态不可能是出售状态*/ ) {

								$items[$key]['gift'][$gift['gift_id']] = array(
									'name'            => $gift['name'],
									'product_id'      => $gift['gift_id'],
									'product_char_id' => $gift['product_char_id'],
									'type'            => $gift['type'],
									'weight'          => $gift['weight'],
									'pic_num'         => $gift['pic_num'],
									'num'             => $gift['gift_num'],
								);
							}
						}
					}
				}
			}

			//处理随心配
			$easyMainProduct = array();
			foreach ($items as $key => &$item) {
				if ($item['main_product_id'] > 0) {
					$mainProductExist = false;

					foreach ($items as $ii) {
						if ($ii['product_id'] == $item['main_product_id']) {
							$mainProductExist = true;
							$items[$key]['matchNum'] = $ii['buy_count'] < $item['buy_count'] ? $ii['buy_count'] : $item['buy_count'];
							break;
						}
					}

					if ($mainProductExist) {
						$easyMainProduct[$item['main_product_id']] = $item['main_product_id'];
					} else {
						$item['main_product_id'] = 0;
					}
				}
			}

			if (!empty($easyMainProduct)) {
				//拉取随心配@ixiuzeng
				$wh_id_alter = (1001 == $wh_id) ? $wh_id : 1; //广东站的随心配从广东站获取，其他的从上海站获取
				$easyMatch = IProductRelativityTTC::gets($easyMainProduct, array('type' => PRODUCT_BY_MIND, 'status' => 1, 'wh_id' => $wh_id_alter));
				if (false === $easyMainProduct) {
					self::$errCode = IProductRelativityTTC::$errCode;
					self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IProductRelativityTTC failed]' . IProductRelativityTTC::$errMsg;
					return false;
				}

				if (count($easyMatch) > 0) {
					foreach ($items as $key => &$item) {
						if ($item['main_product_id'] > 0) {
							foreach ($easyMatch as $em) {
								if ($item['main_product_id'] == $em['product_id'] && $item['product_id'] == $em['relative_id'] && $em['type'] == PRODUCT_BY_MIND) {
									$cut = intval($em['property']);
									$items[$key]['match_cut'] = $cut > 0 ? $cut : 0;
									break;
								}
							}
						}
					}
				}
			}

			//拉取多价信息
			if (count($multiPriceProduct) > 0) {
				$multiPriceInfo = IMultiPrice::getCartPrices(array(
						'wh_id' 		=> $wh_id,
						'product' 	=> $multiPriceProduct,
					)
				);

				if (false === $multiPriceInfo) {
					Logger::warn(__CLASS__ . '|' . __FUNCTION__ . ' IMultiPrice::getCartPrices FAILED');
				}
				else {
					if (isset($multiPriceInfo['Prices']) && is_array($multiPriceInfo['Prices'])) {
						foreach ($multiPriceInfo['Prices'] as $pid => $mp) {
							if ($mp['isSatisfy']) { //满足多价信息
								foreach ($items as $key => &$item) {
									if ($item['product_id'] == $pid) {
										$item['discount_p_name'] = $mp['price_name'];

										if ($mp['count_type'] == MP_COUNT_BY_DISCOUNT) { //折扣
											$item['discount_price'] = 10 * bcdiv($item['price'] * $mp['price'], 1000, 0) + $item['cash_back'];
										}
										else if ($mp['count_type'] == MP_COUNT_BY_PRICE) {
											$item['discount_price'] = $mp['price'] + $item['cash_back'];
										}
									}
								}
							}
						}
					}
				}
			}
		}

		if ($login) { //删除不合法的购物车商品
			if (!empty($deleteProductIds) && (!$reqFromWireless)) { //手机浏览不删除购物车
				$deleteProductIds = array_unique($deleteProductIds);
				Logger::info('REMOVE from shoppingcart ' . implode(',', $deleteProductIds));
				self::removeCart($uid, array_unique($deleteProductIds));
			}
		}

		// 保证$items有序，手机端需要
		sort($items);
		return $items;
	}

	// 对外接口，清空用户购物车
	public static function clear($uid, $wh_id = 1)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}

		$ret = self::removeCart($uid);
		if (false === $ret) {
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query removeCart failed]' . self::$errMsg;
			return false;
		}

		return true;
	}

	// 对外接口，删除购物车单个商品的
	public static function remove($uid, $product_id, $wh_id = 1)
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

		$item = self::removeCart($uid, array($product_id));
		if (false === $item) {
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query removeCart failed]' . self::$errMsg;
			return false;
		}

		return true;
	}

	// 对外接口，删除购物车中的多个商品
	public static function removeProducts($uid, $productIds)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}

		return self::removeCart($uid, $productIds);
	}

	public static function getCountAndPrice($uid, $wh_id = 1)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}

		$items = self::get($uid);
		if (false === $items) {
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query get failed]' . self::$errMsg;
			return false;
		}
		$totalItem = 0;
		foreach ($items as &$item) {
			$totalItem += $item['buy_count'];
		}
		return array('uid' => $uid, 'totalnum' => $totalItem);
	}

	//获取购物车商品封装操作
	public static function get($uid)
	{
		$items = IShoppingCartTTCNew::get($uid);
		if (false === $items) {
			self::setErr('IShoppingCartTTCNew');
			return false;
		}

		$result = isset($items[0]['info']) ? json_decode($items[0]['info'], true) : array();
		if (count($result) > 0) {
			foreach ($result as $k => &$ret) {
				$ret = self::extendKey($ret, $uid);
			}
		} else if (count($result) == 0) {
			/*
			$result = self::dataConvert($uid);
			if ($result == false) { // 如果出错，说明老的TTC链接有问题，直接返回空数据，不用报错
				return array();
			}*/
			return array();
		}

		return $result;
	}

	/**
	 * 检查购物车参数
	 * @param array $param
	 * @param string $cart_type
	 * @return boolean
	 */
	public static function checkParam($param, $cart_type = self::ONLINE_CART)
	{
		if ($cart_type == self::ONLINE_CART && (!isset($param['uid']) || $param['uid'] <= 0)) { // 正常购物车才有uid
			self::setErr(101, basename(__FILE__, '.php') . " |" . __LINE__ . "uid({$param['uid']}) is invalid");
			return false;
		}
		if (!isset($param['product_id']) || $param['product_id'] <= 0) {
			self::setErr(100, basename(__FILE__, '.php') . " |" . __LINE__ . "product_id({$param['product_id']}) is invalid");
			return false;
		}

		// 设置默认值
		if (!isset($param['main_product_id']) || $param['main_product_id'] < 0) {
			$param['main_product_id'] = 0;
		}
		foreach (self::$default as $key => $val) {
			if (!isset($param[$key]) && isset(self::$default[$key])) {
				$param[$key] = self::$default[$key];
			}
		}
		return $param;
	}

	// 需要保证json串的长度不超过最大值，商品数量和种类也不能超过最大值
	private function itemJsonEncode($data)
	{
		if (count($data) > self::MAX_SHOPPING_CART_ITEM) {
			self::$errCode = -1;
			self::$errMsg = basename(__FILE__) . " | " . __LINE__ . " [购买商品种类超过最大值]";
			return false;
		}

		foreach ($data as $key => $val) {
			// buy_count ， 购买数量上线
			if ($val['buy_count'] > self::MAX_COUNT_PER_ITEM) {
				self::$errCode = -1;
				self::$errMsg = basename(__FILE__) . " | " . __LINE__ . " [{$val['pid']} 购买商品数量超过最大值]";
				return false;
			}
			$data[$key] = self::shortenKey($val);
		}

		sort($data);
		$result_json = json_encode($data);
		if (strlen($result_json) > self::MAX_ITEM_LENGTH) {
			self::$errCode = -2;
			self::$errMsg = basename(__FILE__) . " | " . __LINE__ . " [购买商品种类超过最大值]";
			return false;
		}

		return $result_json;
	}

	// 数据层，加入购物车封装操作，添加数据到数据源中
	private static function insertCart($arr)
	{
		// 检查传入参数
		$arr = self::checkParam($arr);
		if (false == $arr)
			return false;

		//先使用封装的get方法获得用户购物车信息
		$result = self::get($arr['uid']);
		if (false === $result) {
			self::$errCode = IShoppingCartTTCNew::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IShoppingCartTTCNew failed]' . IShoppingCartTTCNew::$errMsg;
			return false;
		}

		//如果为空则增加一条记录
		if (empty($result)) {
			// 数据从无到有，新加一个元素，必须要0下标
			$result[0] = $arr;
			$result_json = self::itemJsonEncode($result);
			if ($result_json === false)
				return false;

			$ret = IShoppingCartTTCNew::insert(array('uid' => $arr['uid'], 'info' => $result_json));
			if (false === $ret) {
				self::$errCode = IShoppingCartTTCNew::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IShoppingCartTTCNew failed]' . IShoppingCartTTCNew::$errMsg;
				return false;
			}
		} else {

			$result = array_merge($result, array($arr));
			$result_json = self::itemJsonEncode($result);
			if ($result_json === false)
				return false;

			$ret = IShoppingCartTTCNew::update(array('uid' => $arr['uid'], 'info' => $result_json));
			if (false === $ret) {
				self::$errCode = IShoppingCartTTCNew::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IShoppingCartTTCNew failed]' . IShoppingCartTTCNew::$errMsg;
				return false;
			}
		}
		return true;
	}

	// 数据层，删除购物车商品封装操作，从数据源中删除数据
	private static function removeCart($uid, $arr = array())
	{
		$result = array();
		if (!empty($arr)) {
			$result = self::get($uid); //先获得用户购物车信息
			if (false === $result) {
				self::$errCode = IShoppingCartTTCNew::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IShoppingCartTTCNew failed]' . IShoppingCartTTCNew::$errMsg;
				return false;
			}

			$pids = array_values($arr);
			foreach ($result as $k => $ret) {
				if (in_array($ret['product_id'], $pids)) {
					unset($result[$k]);
				}
			}
		}

		if (empty($result)) { //直接清空购物车
			$ret = IShoppingCartTTCNew::remove($uid);
			if (false === $ret) {
				self::$errCode = IShoppingCartTTCNew::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IShoppingCartTTCNew failed]' . IShoppingCartTTCNew::$errMsg;
				return false;
			}

			IShoppingCartTTC::remove($uid);
		} else { //更新购物车
			$result_json = self::itemJsonEncode($result);
			if ($result_json === false) {
				return false;
			}

			$ret = IShoppingCartTTCNew::update(array('uid' => $uid, 'info' => $result_json));
			if (false === $ret) {
				self::$errCode = IShoppingCartTTCNew::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IShoppingCartTTCNew failed]' . IShoppingCartTTCNew::$errMsg;
				return false;
			}
		}

		return true;
	}

	// 数据层，更新购物车商品封装操作，更新数据源中的数据
	private static function updateCart($info = array(), $filter = array())
	{
		if (empty($info['uid'])) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid({$info['uid']}) is invalid";
			return false;
		}

		//先使用封装的get方法获得用户购物车信息
		$result = self::get($info['uid']);
		if (false === $result) {
			self::$errCode = IShoppingCartTTCNew::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IShoppingCartTTCNew failed]' . IShoppingCartTTCNew::$errMsg;
			return false;
		}

		//如果为空则返回
		if (empty($result)) {
			self::$errCode = 111;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "IShoppingCartTTCNew update :no information for the uid to update";
			return false;
		}

		foreach ($result as $k => $ret) {
			$tm = array_merge($ret, $filter);
			if ($ret == $tm) {
				$result[$k] = array_merge($result[$k], $info);
			}
		}

		$result_json = self::itemJsonEncode($result);
		if ($result_json === false)
			return false;

		$ret = IShoppingCartTTCNew::update(array('uid' => $info['uid'], 'info' => $result_json));
		if (false === $ret) {
			self::$errCode = IShoppingCartTTCNew::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IShoppingCartTTCNew failed]' . IShoppingCartTTCNew::$errMsg;
			return false;
		}

		return true;
	}

	private static function shortenKey($item)
	{
		$result = array(
			'pid'  => $item['product_id'],
			'whid' => $item['wh_id'],
			'bc'   => $item['buy_count'],
			'prid' => $item['price_id'],
			'mpid' => $item['main_product_id'],
			'ot'   => $item['OTag'],
			'type' => $item['type']
		);

		if (isset($item['uid'])) {
			//$result['uid'] = $item['uid'];
			unset($result['uid']); // = $item['uid'];
		}

		return $result;
	}

	/**
	 * Enter description here ...
	 * @param array $item
	 * @param int $uid
	 * @return array
	 */
	private static function extendKey($item, $uid)
	{
		return array(
			'uid'                         => $uid,
			'product_id'                  => $item['pid'],
			'buy_count'                   => $item['bc'],
			'main_product_id'             => $item['mpid'],
			'type'                        => $item['type'],
			'wh_id'                       => $item['whid'],
			'price_id'                    => $item['prid'],
			'OTag'                        => $item['ot'],
		);
	}

	// 检查商品限购
	public static function checkProductNumLimit($num, $product_id, $wh_id,$district_id = 0)
	{
		//获取商品分仓信息
		$product = IProductInfoTTC::get($product_id, array('wh_id' => $wh_id));
		if (false === $product) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
			return false;
		} else if (count($product) < 1) {
			self::$errCode = 107;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '商品不存在';
			return false;
		} else if ($product[0]['status'] != PRODUCT_STATUS_NORMAL) {
			self::$errCode = 110;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '商品暂不销售';
			return false;
		}

		//ixiuzeng添加获取多个商品的库存
		$result = IProductInventory::setProductsInventoryInfo(array($product_id), $wh_id, $product,$district_id);
		if (false === $result) {
			self::$errCode = IProductInventory::$errCode;
			self::$errMsg = IProductInventory::$errMsg;
			return false;
		}

		//$productInventoryInfo = $result['inventoryInfo'];
		$product = $result['productWhInfo'][0];

		$numNeed = self::checkNumLimit($num, $product, $wh_id);
		if (false === $numNeed)
			return false;

		return $numNeed;
	}

	// 检查套餐限购
	public static function checkSuitNumLimit($num, $pkgid, $wh_id, $district_id=0)
	{
		$suiteInfo = EA_Promotion::getPackageInfo($pkgid, $wh_id);
		$product_ids = $suiteInfo['pid_list'];

		$products = IProductInfoTTC::gets($product_ids, array('wh_id' => $wh_id));
		if (false === $products) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
			return false;
		}

		$result = IProductInventory::setProductsInventoryInfo($product_ids, $wh_id, $products,$district_id);
		if (false === $result) {
			self::$errCode = IProductInventory::$errCode;
			self::$errMsg = IProductInventory::$errMsg;
			return false;
		}

		$products = $result['productWhInfo'];


		// 套餐的限购值 为 套餐中所有的商品限购值的最小值
		$numNeedMin = IShoppingCart::MAX_COUNT_PER_ITEM;
		foreach ($products as $product) {
			$numNeed = self::checkNumLimit($num, $product, $wh_id);
			if (false === $numNeed)
				return false;

			$numNeedMin = min($numNeed, $numNeedMin);
		}

		return array(
			'numNeedMin' => $numNeedMin,
			'suiteInfo'  => $suiteInfo,
		);
	}

	public static function checkNumLimit($numNeed, $product, $wh_id)
	{
		//检查商品是否限购
		if ($product['num_limit'] <= 0) { //不限购
			$product['num_limit'] = self::MAX_COUNT_PER_ITEM;
		}

		if ($numNeed > $product['num_limit']) {
			self::$errCode = 109;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '超过限购数量';
			self::$buyNeedNum = $product['num_limit'];
			return false;
		}

		//限购数量小于库存
		if ($product['num_limit'] <= $product['num_available'] + $product['virtual_num']) {
			$numNeed = min($numNeed, $product['num_limit']);
		} else {
			//库存小于限购数量
			if ($numNeed > $product['num_available'] + $product['virtual_num']) {
				if (($wh_id != SITE_SH) || ($product['flag'] & FORBID_SET_VIRTUAL) == FORBID_SET_VIRTUAL || $product['type'] != PRODUCT_TYPE_NORMAL) {
					self::$errCode = 109;
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '超过库存数量';
					self::$buyNeedNum = $product['num_available'] + $product['virtual_num'];
					return false;
				}
			}
		}
		return $numNeed;
	}

	/**
	 * Enter description here ...
	 * @param unknown_type $uid
	 */
	private static function dataConvert($uid)
	{
		// 新老数据转换，在没有查到新数据的情况下，调用老的数据源，如果有，则从老的数据源中取出数据并转换
		$result = IShoppingCartTTC::get($uid);
		if (false === $result) {
			self::$errCode = IShoppingCartTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IShoppingCartTTC failed]' . IShoppingCartTTC::$errMsg;
			Logger::info(self::$errMsg);
			return false;
		}

		if (!empty($result)) {
			foreach ($result as $key => $ret) {
				$result[$key] = self::checkParam($ret);
			}

			if ($result == false)
				return array();

			$result_json = self::itemJsonEncode($result);
			if ($result_json === false)
				return array();

			$ret = IShoppingCartTTCNew::insert(array('uid' => $uid, 'info' => $result_json));
			if (false === $ret) {
				self::$errCode = IShoppingCartTTCNew::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IShoppingCartTTCNew failed]' . IShoppingCartTTCNew::$errMsg;
				return array();
			}

			IShoppingCartTTC::remove($uid);
		}

		return $result;
	}

	/**
	 * 为手机端过滤掉套餐商品
	 * @param array $items
	 * @return null
	 */
	public static function filterPackageItems(&$items)
	{
		foreach ($items as $key => $item) {
			if ($item['type'] == IShoppingCart::ITEM_PACKAGE) {
				unset($items[$key]);
			}
		}
		sort($items);

		return $items;
	}

	/**
	 * 根据商品信息、库存信息，为商品添加计算的库存、配送信息
	 * @param int $wh_id 分站id
	 * @param array $item 商品信息
	 * @param array $pwinfo 库存分站信息
	 * @return null
	 */
	private static function extendProductStockStatus($wh_id, &$item, &$pwinfo)
	{
		$item['cash_back'] = $pwinfo['cash_back'];
		$item['market_price'] = $pwinfo['market_price'];
		$item['num_limit'] = $pwinfo['num_limit'];
		$item['point'] = $pwinfo['point'];
		$item['price'] = $pwinfo['price'] + $pwinfo['cash_back'];
		$item['psystock'] = $pwinfo['psystock'];
		$item['type'] = $pwinfo['type'];

		global $_StockTips, $_StockStatus, $_StockID_Name, $_StockToWhidTransitDays;

		if (($pwinfo['num_available'] + $pwinfo['virtual_num'] >= $item['buy_count']) //库存加上虚库存足够
			|| (($wh_id == 1) && ($pwinfo['flag'] & FORBID_SET_VIRTUAL) != FORBID_SET_VIRTUAL && $pwinfo['type'] == PRODUCT_TYPE_NORMAL) /*上海仓普通商品未禁止建虚库存*/
		) {

			if ($pwinfo['num_available'] >= $item['buy_count']) { //实际库存足够
				if (!isset($_StockToWhidTransitDays[$pwinfo['psystock']][$wh_id]) || $_StockToWhidTransitDays[$pwinfo['psystock']][$wh_id] == 0) {
					$item['array_days'] = $_StockTips['available'];
					$item['stock_desc'] = $_StockTips['available'];
					$item['stock_status'] = $_StockStatus['available'];
				} else {
					$item['array_days'] = "有货，待{$_StockID_Name[$pwinfo['psystock']]}调拨，{$_StockToWhidTransitDays[$pwinfo['psystock']][$wh_id]}天后配送";
					$item['stock_desc'] = "有货，待{$_StockID_Name[$pwinfo['psystock']]}调拨，{$_StockToWhidTransitDays[$pwinfo['psystock']][$wh_id]}天后配送";
					$item['stock_status'] = $_StockStatus['available'];
				}
			} else if ($pwinfo['arrival_days'] == VIRTUAL_STOCK_ARRAY_1_3DAYS) {
				$item['array_days'] = $_StockTips['arrival1-3'];
				$item['stock_desc'] = $_StockTips['arrival1-3'];
				$item['stock_status'] = $_StockStatus['arrival1-3'];
			} else {
				$item['array_days'] = $_StockTips['arrival2-7'];
				$item['stock_desc'] = $_StockTips['arrival2-7'];
				$item['stock_status'] = $_StockStatus['arrival2-7'];
			}
		} else {
			$item['array_days'] = $_StockTips['not_available'];
			$item['stock_desc'] = $_StockTips['not_available'];
			$item['stock_status'] = $_StockStatus['not_available'];
		}
	}
}