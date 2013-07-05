<?php
if(!defined("PHPLIB_ROOT")) {
    define('PHPLIB_ROOT', '/data/release/PHPLIB/');
}
require_once (PHPLIB_ROOT."api/IShoppingProcess.php");

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

class IShoppingCartV2
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

		self::setErr(0, '');
		$productNew['uid'] = $uid;
		/*
		$productNew = IShoppingCart::checkParam($productNew);
		if (false === $productNew) {
			return false;
		}
		*/
		$product_id = $productNew['product_id'];
		$num = $productNew['buy_count'];
		$wh_id = $productNew['wh_id'];
		$otag = $productNew['OTag'];
		$main_product_id = $productNew['main_product_id'];
		$type = $productNew['type'];
		$reqFromMobile = isset($productNew['reqFromMobile']) ? (bool)$productNew['reqFromMobile'] : false; //false by default
		$chid = isset($productNew['chid']) ? $productNew['chid'] : 0;
		$district_id = isset($productNew['prid']) ? $productNew['prid'] : 0;//区id

		//拉取购物车中已有信息
		$items = self::get($uid);
		if (false === $items) {
			return false;
		}

		switch ($type) {
			case IShoppingCart::ITEM_NORMAL:
				$product = IShoppingProcess::getProductsInfo(array($product_id), $wh_id, $district_id, $uid);
                if(false === $product) {
                    self::$errCode = IShoppingProcess::$errCode;
                    self::$errMsg = IShoppingProcess::$errMsg;
                    return false;
                } else if(count($product['productsInfo']) < 1) {
                    self::setErr(107, basename(__FILE__, '.php') . " |" . __LINE__ . '商品信息不存在');
                    return false;
                } else if ($product['productsInfo'][$product_id]['status'] != PRODUCT_STATUS_NORMAL) {
                    self::setErr(110, basename(__FILE__, '.php') . " |" . __LINE__ . '商品暂不销售');
                    return false;
                }

                // 如果是特殊商品（定制机和节能补贴）不直接加入购物车
                if (IProduct::isCanNotAddToNormalCart($product['productsInfo'][$product_id])) {
                    return array();
                }
                /*
				//商品
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
				$result = IProductInventory::setProductsInventoryInfo(array($product_id), $wh_id, $product, $district_id);
				if (false === $result) {
					self::setErr('IProductInventory');
					return false;
				}
				$productInventoryInfo = $result['inventoryInfo'];
				$product = $result['productWhInfo'][0];

                */

				$exist = false;
				$isMainProduct = false;
				$isMatchProduct = false;
				$existItemNum = 0;
				foreach ($items as $key => $item) {
					if ($product_id == $item['product_id']) { //购物车中已有当前商品
						$exist = true;
						$existItemNum = $item['buy_count'];
						//促销2.0,chid的拼接
						$chid_array = explode("@",$item['chid']);
						if(!in_array($chid,$chid_array)){
							$chid = $item['chid'] . "@" . $chid;
						}
						else{
							$chid = $item['chid'];
						}
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

				$numNeed = self::checkProductNumLimit($numNeed, $product_id, $wh_id, $district_id, $uid, $chid);
				if (false === $numNeed || $numNeed == 0) {
					return false;
				}

				//具体操作 TTC
				$baseAry = array(
					'uid'       => $uid,
					'buy_count' => $numNeed,
					'wh_id'     => $wh_id,
					'price_id'  => 0,
					'type'      => IShoppingCartV2::ITEM_NORMAL,
					//目前只在普通商品存多价场景和来源
					'chid'       => $chid,
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
			//从购物车获取该商品的chid
			$chid = 0;
			$ret = self::get($uid);
			if(false === $ret){
				self::$errCode = 107;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "shoppingcart($uid) get failed";
				return false;
			}
			if(empty($ret)){
				return false;
			}
			foreach($ret as $r){
				if($r['product_id'] == $product_id){
					$chid = $r['chid'];
				}
			}
			$numNeed = self::checkProductNumLimit($num, $product_id, $wh_id, $district_id, $uid ,$chid);
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
		//限购，可设置数量与要求数量不一致是否需要返回错误，若丰富返回结果，手机侧也需要对应修改cgi
		if($numNeed != $num || $numNeed == 0){
			self::$errCode = 201;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "商品限购，修改数量失败";
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
		self::setErr(0, '');
		$productNew = IShoppingCart::checkParam($productNew, self::OFFLINE_CART);
		if (false === $productNew) {
			return false;
		}

		$product_id = $productNew['product_id']; //商品 / 套餐 ID
		$wh_id = $productNew['wh_id'];
		$num = $productNew['buy_count'];
		$type = $productNew['type'];
		$district_id = isset($productNew['prid']) ? $productNew['prid'] : 0;
		$chid = isset($productNew['chid']) ? $productNew['chid'] : 0;

		switch ($type) {
			case IShoppingCart::ITEM_NORMAL:

                $products = IShoppingProcess::getProductsInfo(array($product_id), $wh_id, $district_id);
                if(false === $products) {
                    self::$errCode = IShoppingProcess::$errCode;
                    self::$errMsg = IShoppingProcess::$errMsg;
                    return false;
                } else if(count($products['productsInfo']) < 1) {
                    self::setErr(107, basename(__FILE__, '.php') . " |" . __LINE__ . '商品信息不存在');
                    return false;
                } else if ($products['productsInfo'][$product_id]['status'] != PRODUCT_STATUS_NORMAL) {
                    self::setErr(110, basename(__FILE__, '.php') . " |" . __LINE__ . '商品暂不销售');
                    return false;
                }

                // 如果是特殊商品（定制机和节能补贴）不直接加入购物车
                if (IProduct::isCanNotAddToNormalCart($products['productsInfo'][$product_id])) {
                    return array();
                }

				$product = $products['productsInfo'][$product_id];

				$numNeed = min($num, self::MAX_COUNT_PER_ITEM);
				$numNeed = self::checkProductNumLimit($numNeed, $product_id, $wh_id, $district_id, 0, $chid);
				if (false === $numNeed) {
					return false;
				}

				$needToLogin = false;

				return array(
					'product_id'    => $product_id,
					'num'           => $numNeed,
					'need_to_login' => $needToLogin,
					'price_id'      => 0,
					'price'         => 0,
                    'chid'          => $chid,
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

	public static function addToESCart($productNew)
	{
		self::setErr(0, '');
		$productNew = IShoppingCart::checkParam($productNew, self::OFFLINE_CART);
		if (false === $productNew) {
			return false;
		}

		$product_id = $productNew['product_id']; //商品 / 套餐 ID
		$wh_id = $productNew['wh_id'];
		$num = $productNew['buy_count'];
		$type = $productNew['type'];
		$district_id = isset($productNew['prid']) ? $productNew['prid'] : 0;
		$chid = isset($productNew['chid']) ? $productNew['chid'] : 0;

		switch ($type) {
			case IShoppingCart::ITEM_NORMAL:

                $products = IShoppingProcess::getProductsInfo(array($product_id), $wh_id, $district_id);
                if(false === $products) {
                    self::$errCode = IShoppingProcess::$errCode;
                    self::$errMsg = IShoppingProcess::$errMsg;
                    return false;
                } else if(count($products['productsInfo']) < 1) {
                    self::setErr(107, basename(__FILE__, '.php') . " |" . __LINE__ . '商品信息不存在');
                    return false;
                } else if ($products['productsInfo'][$product_id]['status'] != PRODUCT_STATUS_NORMAL) {
                    self::setErr(110, basename(__FILE__, '.php') . " |" . __LINE__ . '商品暂不销售');
                    return false;
                }

                $product = $products['productsInfo'][$product_id];

				$numNeed = min($num, self::MAX_COUNT_PER_ITEM);
				$numNeed = self::checkProductNumLimit($numNeed, $product_id, $wh_id, $district_id, 0, $chid);

				if (false === $numNeed) {
					if(self::$buyNeedNum != 0)
					{
						$numNeed = self::$buyNeedNum;
					}
					else
					{
						return false;
					}
				}

				$needToLogin = false;

				return array(
					'product_id'    => $product_id,
					'num'           => $numNeed,
					'need_to_login' => $needToLogin,
					'price_id'      => 0,
					'price'         => 0,
                    'chid'          => $chid,
				);
			// IShoppingCart::ITEM_PRODUCT end
			default:
				self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' 非法商品类型';
				return false;

		} //end of switch
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
		$arr = IShoppingCart::checkParam($arr);
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
			'type' => $item['type'],
			'chid' => $item['chid'],
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
			'chid'                        => $item['chid'],
		);
	}

	// 检查商品限购
	public static function checkProductNumLimit($num, $product_id, $wh_id, $district_id = 0, $uid=0, $chid=0)
	{

        $products = IShoppingProcess::getProductsInfo(array($product_id),$wh_id,$district_id,$uid);
        if(false === $products) {
            self::$errCode = IShoppingProcess::$errCode;
            self::$errMsg = IShoppingProcess::$errMsg;
            return false;
        } else if(count($products['productsInfo']) < 1) {
            self::setErr(107, basename(__FILE__, '.php') . " |" . __LINE__ . '商品信息不存在');
            return false;
        } else if ($products['productsInfo'][$product_id]['status'] != PRODUCT_STATUS_NORMAL) {
            self::setErr(110, basename(__FILE__, '.php') . " |" . __LINE__ . '商品暂不销售');
            return false;
        }

        $product = $products['productsInfo'][$product_id];
		//$productInventoryInfo = $result['inventoryInfo'];
		//$product = $result['productWhInfo'][0];

		$numNeed = self::checkNumLimit($num, $product, $wh_id);
		if (false === $numNeed || $numNeed == 0){
			if(isset(IShoppingCart::$buyNeedNum) && IShoppingCart::$buyNeedNum != 0)
			{
				self::$buyNeedNum = IShoppingCart::$buyNeedNum;
			}
			return false;
		}
		$product['chid'] = $chid;

		$numNeed = self::checkMultiPriceLimit($numNeed, $product, $wh_id, $uid);
		if (false === $numNeed){
			return false;
		}

		return $numNeed;
	}



	private static function checkMultiPriceLimit($numNeed, $product, $wh_id, $uid=0)
	{
		//检查商品是否限购
		if ($product['num_limit'] <= 0) { //不限购
			$product['num_limit'] = self::MAX_COUNT_PER_ITEM;
		}
		//检查起购数量
		if($product['lowest_num'] <= 0){
			$product['lowest_num']	= 1;
		}
		//冗余代码 edit by hut
		//if ($numNeed > $product['num_limit']) {
			//self::$errCode = 109;
			//self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '超过限购数量';
			//return false;
		//}
		$type = 1;//默认是普通商品，2是节能补贴商品
		if(($product['flag'] & PRODUCT_ENERGY_SUBSIDY) == PRODUCT_ENERGY_SUBSIDY){
			$type = 2;
		}
		$item = array(
			'product_id' => $product['product_id'],
			'buy_count' => $numNeed,
			'chid' => $product['chid'],
			'package_id' => 0,//0为普通商品，1为套餐商品
		    'c3_ids'    => $product['c3_ids'],
            'psystock'  => $product['psystock'],
            'price'     => $product['price'],
		);
		$ret = IPromotionRuleV2::checkItmeMultPriceRestrict(array($item), $wh_id, $type, $uid);
		if($ret ===false){
			self::$errCode = IPromotionRuleV2::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . IPromotionRuleV2::$errMsg;
			return false;
		}
		if($ret[0]['mult_limit'] == 0){

			if(self::$errCode != 0)
			{
				return false;
			}
			return $numNeed;
		}
		else{
            //被限购，只能购买的数量
			//8005起购>多价限购
			if($ret[0]['mult_limit_num'] < $product['lowest_num']){
				self::$errCode = 8005;
				self::$errMsg = '商品促销库存不足，暂不销售';
				return false;
			}
			if(self::$errCode != 0)
			{
				return false;
			}
			//8006购买数>多价限购
			if($numNeed > $ret[0]['mult_limit_num']){
				self::$errCode = 8006;
				self::$errMsg = '商品可售促销库存'.$ret[0]['mult_limit_num'].'件，请调整购买数量后再进行购买';
				self::$buyNeedNum = $ret[0]['mult_limit_num'];
				return false;
			}
			return min($numNeed,$ret[0]['mult_limit_num']);
		}
	}

    public static function checkSuitNumLimit($num, $pkgid, $wh_id, $district_id=0)
    {
       // $suiteInfo = EA_Promotion::getPackageInfo($pkgid, $wh_id);
        $result = IShoppingProcess::getPackageInfo($pkgid,$wh_id,$district_id);
        if(false == $result || !isset($result['suiteInfo'][0]))
        {
            self::$errCode = IShoppingProcess::$errCode;
            self::$errMsg = IShoppingProcess::$errMsg;
            return  false;
        }

        $suiteInfo = $result['suiteInfo'][0];
        $product_ids = $suiteInfo['pid_list'];
        $result = IShoppingProcess::getProductsInfo($product_ids,$wh_id,$district_id);
        if(false === $result) {
            self::$errCode = IShoppingProcess::$errCode;
            self::$errMsg = IShoppingProcess::$errMsg;
            return false;
        }
        $products = $result['productsInfo'];
		/* 套餐库存服务化接入
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
		*/


        // 套餐的限购值 为 套餐中所有的商品限购值的最小值
        $numNeedMin = IShoppingCartV2::MAX_COUNT_PER_ITEM;
        foreach ($products as $key => $product) {
            $numNeed = self::checkNumLimit($num, $product, $wh_id);

            if (false === $numNeed)
                return false;

            $numNeedMin = min($numNeed, $numNeedMin);
        }
        $suiteInfo['num'] = $numNeedMin;
        return array(
            'numNeedMin' => $numNeedMin,
            'suiteInfo'  => $suiteInfo,
        );
    }

    public static function checkNumLimit($numNeed, $product, $wh_id)
    {
		//检查起购数量>限购数量 ？
		if($product['lowest_num'] <= 0){
			$product['lowest_num']	= 1;
		}
        //对于商品限购小于等于0的情况加个处理,限购数量改成99
        if($product['num_limit'] <= 0)
        {
            $product['num_limit'] = IShoppingCartV2::MAX_COUNT_PER_ITEM;
        }

		//8001起购>限购
        if($product['lowest_num'] > $product['num_limit']){
            self::$errCode = 8001;
            self::$errMsg = '商品有购买限制，暂不销售';
			return false;
		}

		//8002 起购>购买数
		if($numNeed < $product['lowest_num']){
            self::$errCode = 8002;
            self::$errMsg = '商品'.$product['lowest_num'].'件起购，请调整购买数量后继续购买';
		}

		
		
		//8003 购买数>限购
        if ($numNeed > $product['num_limit']) {
            //self::$errCode = 109;
            self::$errCode = 8003;
            self::$errMsg = '商品限购'.$product['num_limit'].'件，请调整购买数量后继续购买';
            self::$buyNeedNum = $product['num_limit'];
        }
		
		//8007 起购>库存
		if ($product['lowest_num'] > $product['num_available'] + $product['virtual_num']) {
            self::$errCode = 8007;
            self::$errMsg = '商品数量不足，暂时不能购买';
			return false;
        }

        ////限购数量小于库存
        if ($product['num_limit'] <= $product['num_available'] + $product['virtual_num']) {
            $numNeed = min($numNeed, $product['num_limit']);
        } else {
            //8004.购买数>库存
            if ($numNeed > $product['num_available'] + $product['virtual_num']) {
                    self::$errCode = 8004;
                    self::$errMsg = '商品可售库存'.($product['num_available'] + $product['virtual_num']).'件，请调整购买数量后继续购买';
                    self::$buyNeedNum = $product['num_available'] + $product['virtual_num'];
			}
		}
        return $numNeed;
    }
}
