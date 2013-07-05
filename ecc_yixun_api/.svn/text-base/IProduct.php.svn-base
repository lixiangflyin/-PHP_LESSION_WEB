<?php
require_once(PHPLIB_ROOT . 'inc/constant.inc.php');
require_once(PHPLIB_ROOT . 'inc/installment.inc.php');


class IProduct
{
	public static $errCode = 0;
	public static $errMsg = '';
	public static $logMsg = '';

	// 虚库类型定义
	CONST NO_DELAY = 0; // 正常商品，非延迟
	CONST VIRTUAL_STOCK_TYPE_1 = 1; // 虚库类型1
	CONST VIRTUAL_STOCK_TYPE_2 = 2; // 虚库类型2
	CONST VIRTUAL_STOCK_TYPE_3 = 3; // 虚库类型3
	CONST VIRTUAL_STOCK_TYPE_4 = 4; // 虚库类型4
	CONST VIRTUAL_STOCK_TYPE_5 = 5; // 虚库类型4
	CONST VIRTUAL_STOCK_TYPE_6 = 6; // 虚库类型4

	// 跨仓延迟
	CONST CROSS_STOCK_DELAY = 9;

	// 预购延迟，特定延时天数
	CONST BOOKING_TYPE_SPECIFIC_DELAY = 10;

	// 预购延迟，特定日期
	CONST BOOKING_TYPE_SPECIFIC_DATE = 11;

	// 预购延迟，无特定日期
	CONST BOOKING_TYPE_NOSPECIFIC_DATE = 12;

	public static $_HW_Phone = array(
		/*423444,
		422454,
		422425,
		423551,*/
	);

	public static $_ZX_Phone = array(
		// 9天,
		// k touch
		449381,
		444807,
		428753,
		// 诺基亚 Lumia
		446073,
		446064,
		446066,
		446078,
		446079,
	);

	public static $_21days = array(
		448759,
	);

	public static $_30days = array(
		448775,
	);

	// 获取分站信息
	public static function getWhInfo($pid, $filter = array(), $need = array(), $itemLimit = 0, $start = 0)
	{
		$ret = IProductInfoTTC::get($pid, $filter, $need, $itemLimit, $start);
		if (false === $ret) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg = IProductInfoTTC::$errMsg;
			return false;
		}

		return $ret;
	}

	// 获取分站信息，批量
	public static function getWhInfos($pids, $filter = array(), $need = array())
	{
		$ret = IProductInfoTTC::gets($pids, $filter, $need);
		if (false === $ret) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg = IProductInfoTTC::$errMsg;
			return false;
		}

		return $ret;
	}


	public static function getGift($product_id, $wh_id = 1, $otherData = array())
	{
		if (!isset($product_id) || $product_id <= 0) {
			self::$errCode = 400;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id) is invalid";
			return false;
		}

		$district_id = isset($otherData['prid']) ? $otherData['prid'] : 0;

		/*
		ixiuzeng添加,赠品必须与主商品在同一个物理分仓
		特别说明：
		    拉去赠品的信息时，会查看主商品的物理仓库，同时在其他地方（商品详细页）也会获取主商品的物理仓库，同一个函数
		调用的时间点有区别，可能会得到不同的结果。这种情况发生的概率很小，暂时忽略，或者在购物车以及下单是进行检验。
		*/
		//获取主商品的库存信息
		$productInventoryInfo = IProductInventory::getProductInventeory($product_id, $wh_id, $district_id);
		if (false === $productInventoryInfo) {
			self::$errCode = IProductInventory::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[getProductInventeory failed]' . IProductInventory::$errMsg;

			return array();
		} else {
			$supplyStockId = $productInventoryInfo['supply_stock_id'];
		}

		global $_StockToStation;
		$gift = IGiftNewTTC::get($product_id, array('stock_id' => $_StockToStation[$supplyStockId], 'status' => GIFT_STATUS_OK));
		if (false === ($gift)) {
			self::$errCode = IGiftNewTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . IGiftNewTTC::$errMsg;
			return false;
		}
		if (empty($gift)) {
			return array();
		}

		$keys = array();
		$gifts_type = array();
		foreach ($gift as $v) {
			$keys[] = $v['gift_id'];
			$gifts_type[$v['gift_id']] = $v['type'];
		}

		//获取赠品在主商品的供货仓的库存，并将没有库存的赠品剔除。是否会出现同一个赠品有两个库存,通过mysql的主键控制？？？
		$giftInventorys = IInventoryStockTTC::gets($keys, array('stock_id' => $supplyStockId, 'status' => 0));
		if (false === ($giftInventorys)) {
			self::$errCode = IInventoryStockTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . IInventoryStockTTC::$errMsg;
			return false;
		}
		if (empty($giftInventorys)) {
			return array();
		}

		$keys = array();
		foreach ($giftInventorys as $gis) {
			$keys[] = $gis['product_id'];
		}

		$giftsNoInventory = array();
		foreach ($giftInventorys as $gi) {
			if (($gi['num_available'] + $gi['virtual_num'] <= 0) && ($gifts_type[$gi['product_id']] != COMPONENT_TYPE)) {
				$giftsNoInventory[] = $gi['product_id'];
			}
		}

		$keys = array_diff($keys, $giftsNoInventory);

		if (empty($keys)) {
			return array();
		}

		//拉取礼品商品信息
		$gift_common_info = IProductCommonInfoTTC::gets($keys);
		if (empty($gift_common_info)) {
			return array();
		}

		//拉取礼品分仓信息
		global $_StockToStation;
		$gift_wh_info = IProductInfoTTC::gets($keys, array('wh_id' => $_StockToStation[$supplyStockId]));
		if (empty($gift_wh_info)) {
			return array();
		}

		$result = array();
		$i = 0;


		foreach ($gift_wh_info as $g) {
			if ($g['status'] == PRODUCT_STATUS_NORMAL) //赠品组件的状态不可能是出售状态
			{
				continue;
			}
			/*多分仓后不需要在此处判断库存
			if ($g['num_available'] + $g['virtual_num'] <= 0 )
			{
				//没有库存
				continue;
			}

			if ($g['psystock'] != $product['psystock'])
			{
				//不在同一个物理仓储
				continue;
			}
			*/

			foreach ($gift as $gi) {
				if ($gi['gift_id'] == $g['product_id']) {
					foreach ($gift_common_info as $gc) {
						if ($gc['product_id'] == $g['product_id']) {
							$i++;
							$result[$i]['product_id'] = $gc['product_id'];
							$result[$i]['name'] = $gc['name'];
							$result[$i]['product_char_id'] = $gc['product_char_id'];
							$result[$i]['pic_num'] = $gc['pic_num'];

							$result[$i]['price'] = $g['market_price'];

							$result[$i]['show_order'] = $gi['show_order'];
							$result[$i]['type'] = $gi['type'];
							$result[$i]['num'] = $gi['gift_num'];
							break;
						}
					}
					break;
				}
			}
		}
		return $result;
	}

	/*
		@name:	getProductsGift
		@desc:	批量获取一组商品的对应的礼品（用在商品展示的页面）
		@param product_ids: 一组商品的列表
		@return:	二维数组，商品对应的礼品
		array(pid_count) {
		  [pid0]=>
		  array(gift_count) {
			[gift0]=>
			array(8) {
			  ["product_id"]=>158777
			  ["name"]=>"thinkpad鼠标31P7410（或者）57Y4635"
			  ["product_char_id"]=>"19-419-159"
			  ["pic_num"]=>7
			  ["price"]=>9800
			  ["show_order"]=>3
			  ["type"]=>0
			  ["num"]=>1
			}
			[gift0]=>
			array(8) {
			  ……………………
			}
		  }
		  [pid1]=>
		  array(gift_count) {
			[gift0]=>
				……………………
		  }
		}
	*/
	public static function getProductsGift($product_ids, $wh_id = SITE_SH, $type = GIFT_AND_COMPONENT , $otherData = array())
	{

		if (!isset($product_ids) || !is_array($product_ids)) //必须是数组
		{
			self::$errCode = 401;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_ids is invalid";
			return false;
		}

		$district_id = isset($otherData['prid']) ? $otherData['prid'] : 0;

		//ixiuzeng添加,赠品必须与主商品在同一个物理分仓
		/*
		特别说明：
		    拉去赠品的信息时，会查看主商品的物理仓库，同时在其他地方（商品详细页）也会获取主商品的物理仓库，同一个函数
		调用的时间点有区别，可能会得到不同的结果。这种情况发生的概率很小，暂时忽略，或者在购物车以及下单是进行检验。
		*/
		//获取主商品的库存信息
		$productsInventoryInfo = IProductInventory::getProductsInventeory($product_ids, $wh_id , $district_id);
		if (false === $productsInventoryInfo) {
			self::$errCode = IProductInventory::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[getProductsInventeory failed]' . IProductInventory::$errMsg;

			return array();
		}

		$condition = array('status' => GIFT_STATUS_OK);
		if (ONLY_GIFT == $type) {
			$condition['type'] = 2;
		}
		if (ONLY_COMPONENT == $type) {
			$condition['type'] = 1;
		}

		$gifts = IGiftNewTTC::gets(array_unique($product_ids), $condition, array('product_id', 'gift_num', 'gift_id', 'show_order', 'type', 'stock_id'));
		if (false === ($gifts)) {
			self::$errCode = IGiftNewTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . IGiftNewTTC::$errMsg;
			return false;
		}
		if (count($gifts) == 0) {
			return array();
		}

		//剔除掉与主商品不在一个物理分仓
		global $_StockToStation;
		$giftsValid = array();
		$products_gifts_type = array();
		foreach ($productsInventoryInfo as $pii) {
			foreach ($gifts as $gi) {
				if (($pii['product_id'] == $gi['product_id']) && ($_StockToStation[$pii['supply_stock_id']] == $gi['stock_id'])) {
					$giftsValid[] = $gi;
					$products_gifts_type[$gi['product_id']][$gi['gift_id']][$gi['stock_id']] = $gi['type'];
				}
			}
		}
		unset($gifts);
		if (count($giftsValid) == 0) {
			return array();
		}

		$gifts_ids = array();
		foreach ($giftsValid as $g) {
			$gifts_ids[] = $g['gift_id'];
		}

		//分别剔除掉每个商品中所有没有库存的赠品

		$giftsInventorys = IInventoryStockTTC::gets(array_unique($gifts_ids), array('status' => 0));
		if (false === ($giftsInventorys)) {
			self::$errCode = IInventoryStockTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . IInventoryStockTTC::$errMsg;
			return false;
		}

		$giftValidInventory = array();
		foreach ($giftsValid as $gv) {
			foreach ($giftsInventorys as $gsi) {
				if (($gv['gift_id'] == $gsi['product_id']) && ($productsInventoryInfo[$gv['product_id']]['supply_stock_id'] == $gsi['stock_id']) &&
					(($gsi['num_available'] + $gsi['virtual_num'] > 0) || (COMPONENT_TYPE == $products_gifts_type[$gv['product_id']][$gv['gift_id']][$gv['stock_id']]))
				) {
					$giftValidInventory[] = $gv;
					break;
				}
			}
		}
		if (count($giftValidInventory) == 0) {
			return array();
		}

		$gifts_final_ids = array();
		foreach ($giftValidInventory as $gvi) {
			$gifts_final_ids[] = $gvi['gift_id'];
		}


		$gift_common_info = IProductCommonInfoTTC::gets(array_unique($gifts_final_ids), array(), array('product_id', 'name', 'product_char_id', 'pic_num'));
		if (empty($gift_common_info)) {
			self::$errCode = IProductCommonInfoTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . IProductCommonInfoTTC::$errMsg;
			return false;
		}

		$gift_wh_info = IProductInfoTTC::gets(array_unique($gifts_final_ids), array('wh_id' => $wh_id), array('product_id', 'status', 'num_available', 'virtual_num', 'psystock', 'market_price'));
		if (empty($gift_wh_info)) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . IProductInfoTTC::$errMsg;
			return false;
		}


		$results = array();
		foreach ($giftValidInventory as $g) {
			$item = array();
			foreach ($gift_wh_info as $gwh) {
				// foreach + if 查找该礼品的商品信息
				if ($g['gift_id'] != $gwh['product_id'])
					continue;

				// 找到了
				if ($gwh['status'] == PRODUCT_STATUS_NORMAL) {
					//赠品组件的状态不可能是出售状态
					//echo "状态错误\n";
					continue;
				}

				//if ($gwh['num_available'] + $gwh['virtual_num'] <= 0 )
				//{
				//没有库存
				//echo "没有库存\n";
				//	continue;
				//}

				//$samePsyStock = false;
				//foreach($product_wh_info as $p)
				//{
				// foreach + if 查找赠送该商品的主商品的信息
				//if( $p['product_id'] == $g['product_id'] )
				//{
				//if ($gwh['psystock'] == $p['psystock'])
				//{
				//$samePsyStock = true;
				//}
				//break;
				//}
				//}
				//if (false === $samePsyStock) {
				//        break;
				//}

				foreach ($gift_common_info as $gc) {
					// foreach + if 查找礼品信息
					if ($gc['product_id'] == $g['gift_id']) {
						$item = array();
						$item['product_id'] = $gc['product_id'];
						$item['name'] = $gc['name'];
						$item['product_char_id'] = $gc['product_char_id'];
						$item['pic_num'] = $gc['pic_num'];
						$item['price'] = $gwh['market_price'];
						$item['show_order'] = $g['show_order'];
						$item['type'] = $g['type'];
						$item['num'] = $g['gift_num'];

						$results[$g['product_id']][] = $item;
						break;
					}

				}
				// 前面“查找该礼品的商品信息”成功，没必要再查找了，开始遍历下一件礼品
				break;
			}
		}

		// 返回结果
		return $results;
	}

	/*
	$multiPriceInfo = array(
		$uid => xxx, // 如果用户已经登录，则传入登录用户的id，用以判断用户是否经销商，决定是否显示经销商价格
		$price_id => xxx, //取某个特殊活动价格
		....其他校验信息
		  )
	*/
	public static function getBaseInfo($product_id, $wh_id = 1, $returnStatus = false, $multiPriceInfo = array(), $district = 0)
	{

		if ($product_id <= 0) {
			self::$errCode = 400;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id) is invalid";
			return false;
		}

		$sameGroupIds = IProductIDMapTTC::getSameGroupProductIds($product_id);
		if (false === $sameGroupIds) {
			self::$errMsg = IProductIDMapTTC::$errMsg;
			self::$errCode = IProductIDMapTTC::$errCode;
			return false;
		}

		//获取商品的分仓信息
		// Myfor添加，用以判断商品详情页暂不销售的情况
		// 这种情况可以添加讨论、体验评论等
		$condition = array('wh_id' => $wh_id);
		if (!$returnStatus) {
			$condition['status'] = PRODUCT_STATUS_NORMAL;
		}

		//如果有多个商品属于同一组，则剔除掉type不同的商品，sameGroupIds中包含了product_id
		$allProductTypeInfo = IProductInfoTTC::gets($sameGroupIds, $condition);
		if (false === $allProductTypeInfo) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[get IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
			return false;
		}

		$result = array(); //最终结果数组
		$typeMap = array();
		$methodMap = array();

		// product_id对应商品的分站信息
		$productWhInfo = false;
		foreach ($allProductTypeInfo as $ptype) {
			$pid = $ptype['product_id'];

			if (!$productWhInfo && $pid == $product_id) {
				$productWhInfo = $ptype;
			}

			$typeMap[$pid] = array(
				'status' => $ptype['status'],
				'type'   => $ptype['type']
			);

			// 构造 商品ID -> 购买方式 的映射数组 methodMap
			if (CP_YCHF == ($ptype['flag'] & CP_YCHF)) {
				$methodMap[$pid] = CP_YCHF;
			} else if (CP_GJRW == ($ptype['flag'] & CP_GJRW)) {
				$methodMap[$pid] = CP_GJRW;
			} else if (CP_GMLJ == ($ptype['flag'] & CP_GMLJ)) {
				$methodMap[$pid] = CP_GMLJ;
			}
		}

		// $product_id的商品的分站信息 已经在 IProductInfoTTC::gets($sameGroupIds, $condition) 拉取过了
		if (false === $productWhInfo || empty($productWhInfo)) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[get IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
			return false;
		}

		$product_type = PRODUCT_TYPE_NORMAL;
		if (isset($typeMap[$product_id])) {
			$product_type = $typeMap[$product_id]['type'];
		}
		$result['type'] = $product_type;//商品类型

		foreach ($sameGroupIds as $k => $t_pid)
			if (!isset($typeMap[$t_pid]) || $typeMap[$t_pid]['type'] != $product_type) {
				unset($sameGroupIds[$k]);
			}

		//获取商品基本信息
		$product = IProductCommonInfoTTC::gets($sameGroupIds);
		if (false === ($product)) {
			self::$errCode = IProductCommonInfoTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[get IProductCommonInfoTTC failed]' . IProductCommonInfoTTC::$errMsg;
			return false;
		}

		if (count($product) == 0) {
			self::$errCode = 409;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id) is not exist";
			return false;
		}

		//ixiuzeng添加获取商品的库存
		$productInventoryInfo = IProductInventory::getProductInventeory($product_id, $wh_id, $district);

		if (false === $productInventoryInfo) {
			$productWhInfo['virtual_num'] = 0;
			$productWhInfo['num_available'] = 0;
			$productWhInfo['psystock'] = $wh_id;
			$productWhInfo['status'] = PRODUCT_STATUS_VALID;
		} else {
			$productWhInfo['virtual_num'] = $productInventoryInfo['virtual_num'];
			$productWhInfo['num_available'] = $productInventoryInfo['num_available'];
			$productWhInfo['psystock'] = $productInventoryInfo['supply_stock_id'];
		}


		$peer_pid = 0;
		$multiItemArray = array(); //记录颜色，尺寸到商品id的映射
		$finalItem = 0; //如果请求的商品id信息不存在，则返回与之父id相同的商品信息

		$colorList = array();
		$sizeList = array();
		$methodList = array();

		global $_PROD_SIZE_2, $_ColorList;

		$genColorStart = 10000;
		$genSizeStart = 10000;

		$result['method_value'] = 0;
		$result['method'] = "";
		$result['methodList'] = array();

		foreach ($product as $key => $item) {
			if ($item['product_id'] == $product_id) {
				$finalItem = &$product[$key];
			}
			if (isset($_ColorList[$item['color']])) {
				$colorList[$item['color']] = $_ColorList[$item['color']];
			} else if ($item['color'] == 0) { //颜色值为NULL，
				$colorList[0] = "";
			} else {
				$item['color'] = $genColorStart++;
				$colorList[$item['color']] = "";
			}

			if (isset($_PROD_SIZE_2[$item['size']])) {
				$sizeList[$item['size']] = $_PROD_SIZE_2[$item['size']]['Size2Name'];
			} else {
				$sizeList[$item['size']] = "";
			}


			if (isset($typeMap[$item['product_id']])) {
				$item['status'] = $typeMap[$item['product_id']]['status'];
			} else {
				$item['status'] = 0;
			}

			$pid = $item['product_id'];
			$isCustom = array_key_exists(intval($pid), $methodMap);
			if (isset($multiItemArray[$item['color']][$item['size']]) && !$isCustom && (
				$multiItemArray[$item['color']][$item['size']]['product_id'] == $pid ||
					$multiItemArray[$item['color']][$item['size']]['status'] >= $item['status'])
			) {
				continue;
			}

			$multiItemArray[$item['color']][$item['size']]['product_id'] = $item['product_id'];
			$multiItemArray[$item['color']][$item['size']]['product_char_id'] = $item['product_char_id'];
			$multiItemArray[$item['color']][$item['size']]['color'] = $item['color'];
			$multiItemArray[$item['color']][$item['size']]['size'] = $item['size'];
			$multiItemArray[$item['color']][$item['size']]['status'] = $item['status'];

			if ($isCustom) {
				global $_CP_Method_Data;
				$item_method = $methodMap[$pid];
				if ($pid == $product_id) {
					$result['method_value'] = $item_method;
					$result['method'] = $_CP_Method_Data[$item_method]['Name'];
					$result['methodList'] = array(
						CP_YCHF => "预存话费送手机",
						CP_XHRW => "购机入网送话费",
						CP_GMLJ => "购买裸机",
					);
				}


				$multiItemArray[$item['color']][$item['size']]['method_items'][$item_method] = array(
					'product_id'      => $item['product_id'],
					'product_char_id' => $item['product_char_id'],
					'color'           => $item['color'],
					'size'            => $item['size'],
					'status'          => $item['status'],
					'method'          => $item_method
				);
			}

		}

		//如果颜色分组>=2，踢掉颜色为空的组
		if ($finalItem['color'] == 0) {
			foreach ($multiItemArray as $k => $tpm) {
				if ($k != 0) {
					unset($multiItemArray[$k]);
				}
			}
			ksort($multiItemArray[0]);
		} else if (count($multiItemArray) >= 2) {
			unset($multiItemArray[0]);
			foreach ($multiItemArray as $k => &$t) {
				ksort($multiItemArray[$k]);
			}
		}
		ksort($multiItemArray);
		if (0 === $finalItem) {
			self::$errCode = 411;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id) is not exist";
			return false;
		}

		$result['product_id'] = $finalItem['product_id'];
		$result['c3_ids'] = $finalItem['c3_ids'];
		$result['product_char_id'] = $finalItem['product_char_id'];
		$result['status'] = $productWhInfo['status'];
		$result['flag'] = $productWhInfo['flag'];
		$result['product_sale_type'] = $productWhInfo['product_sale_type'];
		$result['name'] = $finalItem['name'];
		$result['pic_num'] = $finalItem['pic_num'];
		$result['manufacturer'] = $finalItem['manufacturer'];
		$result['mode'] = $finalItem['mode'];
		$result['color'] = isset($_ColorList[$finalItem['color']]) ? $_ColorList[$finalItem['color']] : "";
		$result['color_value'] = $finalItem['color'];
		$result['size'] = isset($_PROD_SIZE_2[$finalItem['size']]) ? $_PROD_SIZE_2[$finalItem['size']]['Size2Name'] : "";
		$result['size_value'] = $finalItem['size'];

		$result['canInstallment'] = false;
		$result['lowest_num'] = empty($productWhInfo['lowest_num']) ? 1 : $productWhInfo['lowest_num'];

		//ixiuzeng添加,根据c3_ids判断是否是否属于上门安装的服务
		$result['is_install'] = in_array($finalItem['c3_ids'], array(736, 739)) ? true : false;

		//watson修改，分期付款不再区分类类目&&招行费率及上下限调整，2013年5月7日
		/*
		if (311 == $finalItem['c3_ids']) {
			if (isset($methodMap[$product_id])) {
				if ($methodMap[$product_id] != CP_YCHF && $methodMap[$product_id] != CP_GJRW && $productWhInfo['price'] >= INSTALLMENT_CELLPHONE_PRICE_MIN && $productWhInfo['price'] <= INSTALLMENT_CELLPHONE_PRICE_MAX) {
					$result['canInstallment'] = true;
				}
			} else {
				if ($productWhInfo['price'] >= INSTALLMENT_CELLPHONE_PRICE_MIN && $productWhInfo['price'] <= INSTALLMENT_CELLPHONE_PRICE_MAX) {
					$result['canInstallment'] = true;
				}
			}
		} else {
			if ($productWhInfo['price'] >= INSTALLMENT_NOTCELLPHONE_PRICE_MIN && $productWhInfo['price'] <= INSTALLMENT_NOTCELLPHONE_PRICE_MAX) {
				$result['canInstallment'] = true;
			}
		}
		if (true === $result['canInstallment'])*/ {
			global $_InstallmentBank;
			$result['installmentPrice'] = array();
			if (is_array($_InstallmentBank)) {
				foreach ($_InstallmentBank as $key => $bank) {
					foreach ($bank['installments'] as $k => $installment) {
						if ($productWhInfo['price'] >= $installment['minprice'] && $productWhInfo['price'] <= $installment['maxprice']) {		
							$result['canInstallment'] = true;					
							$result['installmentPrice'][$key]['bankname'] = $bank['bank'];
							$result['installmentPrice'][$key]['installments'][$k]['month'] = $k;
							$result['installmentPrice'][$key]['installments'][$k]['additionFeeTotal'] = $k * round($installment['rate'] * $productWhInfo['price'] / $k);
							$result['installmentPrice'][$key]['installments'][$k]['additionFeePerMonth'] = round($installment['rate'] * $productWhInfo['price'] / $k);
						}
					}
				}
			}
		}

		global $_RestrictedTransType;
		$result['restricted_trans_type'] = $_RestrictedTransType[$productWhInfo['restricted_trans_type']];

		$now = time();
		if ($now >= $productWhInfo['promotion_start'] || $now <= $productWhInfo['promotion_end']) {
			$result['promotion_word'] = $productWhInfo['promotion_word'];
		} else {
			$result['promotion_word'] = "";
		}

		if (($productWhInfo['flag'] & TIME_LIMITED_RUSHING_BUY) == TIME_LIMITED_RUSHING_BUY) {
			$result['rushing_buy'] = true;
		} else {
			$result['rushing_buy'] = false;
		}

		if (($productWhInfo['flag'] & CAN_VAT_INVOICE) == CAN_VAT_INVOICE) {
			$result['canVAT'] = true;
		} else {
			$result['canVAT'] = false;
		}

		if (($productWhInfo['flag'] & COUPON_PRODUCT) == COUPON_PRODUCT) {
			$result['canUseCoupon'] = false;
		} else {
			$result['canUseCoupon'] = true;
		}

		if (count($product) > 1) {
			$result['multi_item'] = true;
		} else {
			$result['multi_item'] = false;
		}

		$result['multi_item_map'] = $multiItemArray;
		$result['colorList'] = $colorList;
		$result['sizeList'] = $sizeList;

		$result['market_price'] = $productWhInfo['market_price'];
		$result['price'] = $productWhInfo['price'] + $productWhInfo['cash_back'];
		$result['num_limit'] = $productWhInfo['num_limit'];
		$result['canAddToWireLessCart'] = (($wh_id == 1 && $productWhInfo['psystock'] == 1) ? true : false);

		global $_StockTips, $_StockStatus;
		global $_StockToDCTransitDays;
		global $_StockID_Name;
		$des_dc = IProductInventory::getDCFromDistrict($district, $wh_id); //根据三级地址和站id获得默认dc号码
		if ($productWhInfo['virtual_num'] + $productWhInfo['num_available'] > 0) {
			if ($productWhInfo['num_available'] > 0) {
				if (!isset($_StockToDCTransitDays[$productWhInfo['psystock']][$des_dc]) || ($_StockToDCTransitDays[$productWhInfo['psystock']][$des_dc] == 0)) {
					$result['stock'] = $_StockTips['available'];
					$result['stock_status'] = $_StockStatus['available'];
				} else {
					$result['stock'] = "有货，待{$_StockID_Name[$productWhInfo['psystock']]}调拨，{$_StockToDCTransitDays[$productWhInfo['psystock']][$des_dc]}天后配送";
					$result['stock_status'] = $_StockStatus['arrivalN'];
				}
			} else if ($productWhInfo['arrival_days'] == VIRTUAL_STOCK_ARRAY_1_3DAYS) {
				$result['stock'] = $_StockTips['arrival1-3'];
				$result['stock_status'] = $_StockStatus['arrival1-3'];
			} else if ($productWhInfo['arrival_days'] == VIRTUAL_STOCK_ARRAY_2_7DAYS) {
				$result['stock'] = $_StockTips['arrival2-7'];
				$result['stock_status'] = $_StockStatus['arrival2-7'];
			} else {
				$result['stock'] = $_StockTips['not_available'];
				$result['stock_status'] = $_StockStatus['not_available'];
			}
		} else {
			$result['stock'] = $_StockTips['not_available'];
			$result['stock_status'] = $_StockStatus['not_available'];
		}

		//拉取商品多价格信息
		$userLevel = -1;
		$isTrader = 0;
		if (isset($multiPriceInfo['uid']) && $multiPriceInfo['uid'] > 0) {
			$userInfo = IUsersTTC::get($multiPriceInfo['uid'], array(), array('type', 'level', 'retailerLevel'));
			if (isset($userInfo[0])) {
				$userLevel = $userInfo[0]['level'];
				$isTrader = $userInfo[0]['retailerLevel'];
			}
		}
		$multiPrice = IMultiPrice::getListPrices(array(
			'product_id'     => $product_id,
			'wh_id'          => $wh_id,
			'uid'            => (isset($multiPriceInfo['uid']) ? $multiPriceInfo['uid'] : 0),
			'level'          => $userLevel,
			'IsTrader'       => $isTrader,
			'price_id'       => (isset($multiPriceInfo['price_id']) ? $multiPriceInfo['price_id'] : 0),
			'multiPriceType' => $productWhInfo['multiprice_type']
		));

		if (is_array($multiPrice) && is_array($multiPrice['Prices'])) {
			$result['multiPrice'] = $multiPrice;
		}


		global $_District;
		if ($district > 0 && isset($_District[$district])) {
			$items = array(
				$product_id => array(
					'product_id'      => $product_id,
					'buy_count'       => !empty($productWhInfo['lowest_num']) ? $productWhInfo['lowest_num'] : 1,
					'main_product_id' => 0,
					'price_id'        => 0,
					'OTag'            => "",
				)
			);

			$products = array(
				$product_id => array_merge($productWhInfo, $finalItem)
			);

			$ret = IPreOrder::getItemInfo($items, $wh_id, $products, $district);
			if (false === $ret) {
				self::$errCode = IPreOrder::$errCode;
				self::$errMsg = IPreOrder::$errMsg;
				// 出错了，不返回配送信息
				return $result;
			}

			$items = $ret['items'];
			$forbidList = $ret['forbidList'];

			// 拆分订单
			$divideOrder = IPreOrder::DivideOrder($items, $wh_id);
			if (false === $divideOrder) {
				self::$errCode = IPreOrder::$errCode;
				self::$errMsg = IPreOrder::$errMsg;
				// 出错了，不返回配送信息
				return $result;
			}

			// 订单的包裹信息，包括虚库，重量，具体的包裹信息等等
			$order = $divideOrder['order'];


			$deliveryInfo = IPreOrder::getOrderDeliveryInfo($order, $district, $wh_id, $products, $forbidList);
			if ($deliveryInfo === false) {
				self::$errCode = IPreOrder::$errCode;
				self::$errMsg = IPreOrder::$errMsg;
				// 出错了，不返回配送信息
				return $result;
			}

			$items = $deliveryInfo['items'];
			$shippingType = $deliveryInfo['shippingType'];

			// 判断是否支持货到付款
			$result['isCOD'] = false;
			foreach ($shippingType as $shipType) {
				if ($shipType['isCOD'] == 1) {
					$result['isCOD'] = true;
					break;
				}
			}

			// 商品只有一个
			$result['stock'] = $items[0]['stock_desc'];
			$result['stock_status'] = $items[0]['stock_status'];

		}
		return $result;
	}

	//输入：  array(1,3,5)
	//输出： array(1=>10, 3 => 30, 5 => 0), 其中父id为0，或者不存在表示没有父商品
	public static function getProductsParent($productIds)
	{
		if (!is_array($productIds) || empty($productIds)) {
			return array();
		}
		$p_product_ids = IProductIDMapTTC::gets($productIds, array('id_type' => 1), array('id', 'relative_id'));
		if (false === $p_product_ids) {
			self::$errCode = IProductIDMapTTC::$errCode;
			self::$errMsg = IProductIDMapTTC::$errMsg;
			return false;
		}

		$result = array();
		foreach ($p_product_ids as $p) {
			$result[$p['id']] = $p['relative_id'];
		}
		return $result;
	}


	public static function getProductsInfo($productIds, $wh_id = 1, $needCostPrice = false, $needGiftsinfo = false, $district_id = 0)
	{
		if (empty($productIds)) {
			return array();
		}

		$commInfo = IProductCommonInfoTTC::gets($productIds);
		if (false === $commInfo) {
			self::$errCode = IProductCommonInfoTTC::$errCode;
			self::$errMsg = IProductCommonInfoTTC::$errMsg;
			return false;
		}

		if (empty($commInfo)) {
			return array();
		}

		$result = array();
		$whInfo = IProductInfoTTC::gets($productIds, array('wh_id' => $wh_id));
		if (false === $whInfo) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg = IProductInfoTTC::$errMsg;
			return false;
		}


		//ixiuzeng添加获取多个商品的库存

		$ret = IProductInventory::setProductsInventoryInfo($productIds, $wh_id, $whInfo, $district_id);
		if (false === $ret) {
			self::$errCode = IProductInventory::$errCode;
			self::$errMsg = IProductInventory::$errMsg;
			return false;
		}


		$productsInventoryInfo = $ret['inventoryInfo'];
		$whInfo = $ret['productWhInfo'];

		$giftValidInventory = array();
		while (true == $needGiftsinfo) {
			$gifts = IGiftNewTTC::gets(array_unique($productIds), array('status' => GIFT_STATUS_OK), array('product_id', 'gift_num', 'gift_id', 'show_order', 'type', 'stock_id'));
			if (false === ($gifts)) {
				self::$errCode = IGiftNewTTC::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . IGiftNewTTC::$errMsg;
				return false;
			}
			if (count($gifts) == 0) {
				break;
			}

			//剔除掉与主商品不在一个物理分仓
			global $_StockToStation;
			$giftsValid = array();
			$products_gifts_type = array();
			foreach ($productsInventoryInfo as $pii) {
				foreach ($gifts as $gi) {
					if (($pii['product_id'] == $gi['product_id']) && ($_StockToStation[$pii['supply_stock_id']] == $gi['stock_id'])) {
						$giftsValid[] = $gi;
						$products_gifts_type[$gi['product_id']][$gi['gift_id']][$gi['stock_id']] = $gi['type'];
					}
				}
			}
			if (count($giftsValid) == 0) {
				break;
			}
			unset($gifts);

			$gifts_ids = array();
			foreach ($giftsValid as $g) {
				$gifts_ids[] = $g['gift_id'];
			}

			//分别剔除掉每个商品中所有没有库存的赠品
			$giftsInventorys = IInventoryStockTTC::gets(array_unique($gifts_ids), array('status' => 0));
			if (false === ($giftsInventorys)) {
				self::$errCode = IInventoryStockTTC::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . IInventoryStockTTC::$errMsg;
				return false;
			}


			foreach ($giftsValid as $gv) {
				foreach ($giftsInventorys as $gsi) {
					if (($gv['gift_id'] == $gsi['product_id']) && ($productsInventoryInfo[$gv['product_id']]['supply_stock_id'] == $gsi['stock_id'])) {
						if (($gsi['num_available'] + $gsi['virtual_num'] > 0) || (COMPONENT_TYPE == $products_gifts_type[$gv['product_id']][$gv['gift_id']][$gv['stock_id']])) {
							$giftValidInventory[] = $gv;
						}
						break;
					}
				}
			}
			if (count($giftValidInventory) == 0) {
				break;
			}

			$gifts_final_ids = array();
			foreach ($giftValidInventory as $gvi) {
				$gifts_final_ids[] = $gvi['gift_id'];
			}


			//获取增品的公共信息
			$gift_common_info = IProductCommonInfoTTC::gets(array_unique($gifts_final_ids));
			if (empty($gift_common_info)) {
				self::$errCode = IProductCommonInfoTTC::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . IProductCommonInfoTTC::$errMsg;
				return false;
			}

			$gift_wh_info = IProductInfoTTC::gets(array_unique($gifts_final_ids), array('wh_id' => $wh_id));
			if (empty($gift_wh_info)) {
				self::$errCode = IProductInfoTTC::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . IProductInfoTTC::$errMsg;
				return false;
			}
			foreach ($gift_wh_info as $key => &$gwi) {
				$gwi['num_available'] = 0;
				$gwi['virtual_num'] = 0;
			}
			unset($gwi);
			$commInfo = array_merge($commInfo, $gift_common_info);
			$whInfo = array_merge($whInfo, $gift_wh_info);
			break;
		}

		foreach ($commInfo as $ci) {
			$result[$ci['product_id']] = $ci;
			//ixiuzeng添加,根据c3_ids判断是否是否属于上门安装的服务
			$result[$ci['product_id']]['is_install'] = in_array($ci['c3_ids'], array(736, 739)) ? true : false;
		}

		global $_StockTips, $_RestrictedTransType;

		$now = time();
		foreach ($whInfo as $wi) {
			if (!isset($result[$wi['product_id']])) {
				continue;
			}
			$product_id = $wi['product_id'];

			unset($wi['product_id']);
			unset($wi['updatetime']);
			foreach ($wi as $key => $wwi) {
				$result[$product_id][$key] = $wwi;
			}

			$result[$product_id]['show_price'] = $wi['price'] + $wi['cash_back'];

			if ($wi['virtual_num'] + $wi['num_available'] > 0) {
				if ($wi['num_available'] > 0) {
					$result[$product_id]['stock'] = $_StockTips['available'];
				} else if ($wi['arrival_days'] == VIRTUAL_STOCK_ARRAY_1_3DAYS) {
					$result[$product_id]['stock'] = $_StockTips['arrival1-3'];
				} else if ($wi['arrival_days'] == VIRTUAL_STOCK_ARRAY_2_7DAYS) {
					$result[$product_id]['stock'] = $_StockTips['arrival2-7'];
				} else {
					$result[$product_id]['stock'] = $_StockTips['not_available'];
				}
			} else {
				$result[$product_id]['stock'] = $_StockTips['not_available'];
			}

			if ($now >= $wi['promotion_start'] || $now <= $wi['promotion_end']) {
				$result[$product_id]['promotion_word'] = $wi['promotion_word'];
			} else {
				$result[$product_id]['promotion_word'] = "";
			}
			$result[$product_id]['restricted_trans_desc'] = isset($_RestrictedTransType[$wi['restricted_trans_type']]) ? $_RestrictedTransType[$wi['restricted_trans_type']] : '';
			$result[$product_id]['restricted_trans_type'] = $wi['restricted_trans_type'];
			$result[$product_id]['lowest_num'] = !empty($wi['lowest_num']) ? $wi['lowest_num'] : 1;
		}

		foreach ($result as $key => &$re) {
			if (!isset($re['price'])) {
				unset($result[$key]);
				continue;
			}
			if ($needCostPrice === false) {
				unset($result[$key]['cost_price']);
				unset($result[$key]['virtual_num']);
				unset($result[$key]['num_available']);
			}

		}
		unset($re);

		//如果需要返回赠品信息，则执行以下代码
		if ($needGiftsinfo === true) {
			$resultsGifts = array();
			foreach ($giftValidInventory as $g) {
				foreach ($gift_wh_info as $gwh) {
					// foreach + if 查找该礼品的商品信息
					if ($g['gift_id'] != $gwh['product_id'])
						continue;

					// 找到了
					if ($gwh['status'] == PRODUCT_STATUS_NORMAL) {
						//赠品组件的状态不可能是出售状态
						//echo "状态错误\n";
						continue;
					}

					foreach ($gift_common_info as $gc) {
						// foreach + if 查找礼品信息
						if ($gc['product_id'] == $g['gift_id']) {
							$itemGifts = array();
							$itemGifts['product_id'] = $gc['product_id'];
							$itemGifts['name'] = $gc['name'];
							$itemGifts['product_char_id'] = $gc['product_char_id'];
							$itemGifts['pic_num'] = $gc['pic_num'];
							$itemGifts['price'] = $gwh['market_price'];
							$itemGifts['show_order'] = $g['show_order'];
							$itemGifts['type'] = $g['type'];
							$itemGifts['num'] = $g['gift_num'];

							$resultsGifts[$g['product_id']][$itemGifts['product_id']] = $itemGifts;
							break;
						}
					}
					// 前面“查找该礼品的商品信息”成功，没必要再查找了，开始遍历下一件礼品
					break;
				}
			}
			//赠品的信息获取结束


			//将增品与主商品的合并
			foreach ($result as &$res) {
				$res['gifts'] = array();
				foreach ($resultsGifts as $key => $resGift) {
					if ($res['product_id'] == $key) {
						$res['gifts'] = $resGift;
						break;
					}
				}
			}
			unset($res);
		}

		return $result;
	}

	/**
	 * 获取商品的图片地址
	 * @param $productId 商品的“ProductID”属性
	 * @param $type      ：bpic ,800;mpic,800;mm,300;middle,120;small,80;ss,50;pic200,200;pic160,160;pic60,60
	 * @param $picIdx    商品的第几张图片
	 * @return string 图片绝对地址
	 */
	public static function getPic($productId, $type = 'mm', $picIdx = 0)
	{
		//$productId = substr($productId, 0, 10);
		$pieces = explode('R', $productId); // 二手商品末尾有R
		$productId = $pieces[0];
		$pieces = explode('-', $productId, 3);
		return 'http://img' . (intval($pieces[2]) % 2 ? '1' : '2') . '.icson.com/product/' . $type . '/' . $pieces[0] . '/' . $pieces[1] . '/' . $productId . ($picIdx == 0 ? '' : ('-' . ($picIdx < 10 ? ('0' . $picIdx) : $picIdx))) . '.jpg';
		//return 'http://img2.icson.com/IcsonPic/' . $type . '/' . $productId . ($picIdx==0 ? '' : ('-' . ($picIdx < 10 ? ('0' . $picIdx) : $picIdx))) . '.jpg';
	}

	public static function getProductIdFromSearch($sysnos, $siteId)
	{
		$CONFIG = array(
			'1'    => 0,
			'1001' => 100000000,
			'2001' => 200000000,
			'3001' => 300000000,
			'4001' => 400000000,
			'5001' => 500000000
		);

		$offset = isset($CONFIG[$siteId]) ? $CONFIG[$siteId] : 0;

		if (is_array($sysnos)) {
			$ret = array();
			foreach ($sysnos as $sysno) {
				$sInt = intval($sysno);
				if ($sInt > $offset) {
					$ret[] = intval($sysno) - $offset;
				} else {
					$ret[] = intval($sysno);
				}
			}
		} else {
			$sInt = intval($sysnos);
			if ($sInt > $offset) {
				$ret = intval($sysnos) - $offset;
			} else {
				$ret = intval($sysnos);
			}

		}

		return $ret;
	}

	// 是否为节能补贴商品
	// $isflag=ture，表示传入的参数$param是商品的flag， false表示是商品的product_id
	public static function isEnergySubsidyProduct($param, $isflag = false)
	{
		if (!$isflag) {
			if (!is_numeric($param)) {
				self::$errMsg = basename(__FILE__, '.php') . " | line:" . __LINE__ . ",pid($param)参数不是整数:";
				return false;
			}
			$wh_id = IUser::getSiteId();
			$exist = IProductInfoTTC::get($param, array('wh_id' => $wh_id), array('flag'));
			if (false === $exist) {
				Logger::info("query IProductInfoTTC failed(" . $param . ")" . IProductInfoTTC::$errMsg);
				return false;
			}

			if (1 != count($exist)) {
				Logger::info("query IProductTTC failed(" . $param . ")" . "not exist");
				return false;
			}

			if (!isset($exist[0]['flag'])) {
				Logger::info("query IProductTTC failed(" . $param . ")" . "has no flag");
				return false;
			}
			$param = $exist[0]['flag'];
		}

		if (($param & PRODUCT_ENERGY_SUBSIDY) == PRODUCT_ENERGY_SUBSIDY) {
			return true;
		}
		return false;
	}

	// 是否是延保商品
	// $isflag=ture，表示传入的参数$param是商品的flag， false表示是商品的product_id
	public static function isExtendInsuranceProduct($param, $isflag = false)
	{
		if (!$isflag) {
			if (!is_numeric($param)) {
				self::$errMsg = basename(__FILE__, '.php') . " | line:" . __LINE__ . ",pid($param)参数不是整数:";
				return false;
			}
			$wh_id = IUser::getSiteId();
			$exist = IProductInfoTTC::get($param, array('wh_id' => $wh_id), array('flag'));
			if (false === $exist) {
				Logger::info("query IProductInfoTTC failed(" . $param . ")" . IProductInfoTTC::$errMsg);
				return false;
			}

			if (1 != count($exist)) {
				Logger::info("query IProductTTC failed(" . $param . ")" . "not exist");
				return false;
			}

			if (!isset($exist[0]['flag'])) {
				Logger::info("query IProductTTC failed(" . $param . ")" . "has no flag");
				return false;
			}
			$param = $exist[0]['flag'];
		}

		if (($param & PRODUCT_EXTENDED_INSURANCE) == PRODUCT_EXTENDED_INSURANCE) {
			return true;
		}
		return false;
	}

	/*
		特殊商品，不加入普通购物车，
		为以后扩展，采用传入数组的方式
	*/
	public static function isCanNotAddToNormalCart(&$product)
	{

		if (!isset($product['flag'])) {
			self::$errMsg = "no flag!";
			return false;
		}
		// 定制机商品
		if (($product['flag'] & CP_GJRW) == CP_GJRW) {
			return CP_GJRW;
		} else if (($product['flag'] & CP_YCHF) == CP_YCHF) {
			return CP_YCHF;
		} else if (($product['flag'] & CP_XHRW) == CP_XHRW) {
			return CP_XHRW;
		}
		/*
		else if ( ($product['flag'] & PRODUCT_ENERGY_SUBSIDY ) == PRODUCT_ENERGY_SUBSIDY )
		{
			return PRODUCT_ENERGY_SUBSIDY;
		}*/

		self::$errMsg = "flag error!" . $product['flag'];
		return false;
	}

	/**
	 * 从网购平台获取product信息
	 * @param array $productIds
	 * @return boolean|array
	 */
	public static function getWgIdFromProductId($productIds, $siteId)
	{
		$QQ_BUY_COOPERATOR_ID = '855006089';
		$QQ_BUY_QUERY_URL = 'http://api.buy.qq.com/item/getBatchRealTimeSkuBasicListByQuery.xhtml';
		$QQ_BUY_SKEY = '9e1430b6b8360c87bde229fc55ea6fc8';

		$queryStr = 'cooperatorId=' . $QQ_BUY_COOPERATOR_ID;
		$skuParams = array();
		//拼装skuInfo字符串，同一key对应多value的情况，key只出现一次，value按出现顺序排列，不再按字母排序。
		//skuInfo102716|^|NULL|^|NULL102707|^|NULL|^|NULL
		foreach ($productIds as $k => $v) {
			$skuParams[] = implode('|^|', array($v, 'NULL', 'NULL'));
		}

		$toBeSigned = 'getBatchRealTimeSkuBasicListByQuery'
			. str_replace(array('&', '='), array('', ''), $queryStr)
			. 'skuInfo' . implode('', $skuParams)
			. $QQ_BUY_SKEY;
		$sign = md5($toBeSigned);

		$queryStr .= '&skuInfo=' . implode('&skuInfo=', $skuParams) . '&sign=' . $sign;
		$url = $QQ_BUY_QUERY_URL . '?' . $queryStr;
		$ret = NetUtil::cURLHTTPGet($url);
		if (!$ret) {
			self::$errCode = NetUtil::$errCode;
			self::$errMsg = NetUtil::$errMsg;
			return false;
		}

		$XML = new SimpleXMLElement($ret);

		if (0 != (int)$XML->errorCode) {
			self::$errCode = $XML->errorCode;
			self::$errMsg = $XML->errorMessage;
			return false;
		}
		$results = $XML->resultList->result;

		$infos = array();
		$wgStockMap = array(
			'1001' => '1',
			'2001' => '29',
			'3001' => '30',
			'1'    => '30'
		);
		$stockId = isset($wgStockMap[$siteId]) ? $wgStockMap[$siteId] : '';
		if (empty($stockId)) return $infos;
		foreach ($results as $v) {
			$sku = $v->skuList->sku;
			if (!$sku) {
				continue;
			}
			$pid = (int)$sku->cooperatorSkuCode;
			$infos[$pid]['itemId'] = (string)strtoupper($sku->itemId);
			$infos[$pid]['skuSaleAttr'] = (string)$sku->skuSaleAttr;
			$infos[$pid]['skuId'] = (string)$sku->skuId;
			$infos[$pid]['skuReferPrice'] = (int)$sku->skuReferPrice;
			$infos[$pid]['skuTitle'] = (string)$sku->skuTitle;
			$infos[$pid]['storeHouseId'] = 1;
			$infos[$pid]['stockPrice'] = 0.00;
			$infos[$pid]['stockPromotionDesc'] = '';
			$infos[$pid]['stockRealNum'] = 0;
			if ($sku->stockList && ($stocks = $sku->stockList->stock)) {
				foreach ($stocks as $vv) {
					if ($stockId == $vv->storeHouseId) {
						$infos[$pid]['storeHouseId'] = (int)$vv->storeHouseId;
						$infos[$pid]['stockPrice'] = (int)$vv->stockPrice;
						$infos[$pid]['stockPromotionDesc'] = (string)$vv->stockPromotionDesc;
						$infos[$pid]['stockRealNum'] = (int)($vv->stockRealNum - $vv->stockLockNum - $vv->stockSellingNum);
						break;
					}
				}
			}
		}

		return $infos;
	}

	/**
	 * @static 获得预约商品的信息
	 * @param $pids
	 * @param $wh_id
	 * @return array|bool
	 */
	public static function getAppointInfo($pids, $wh_id)
	{
		$appointProducts = array(); //IPreOrder::$appointProduct;

		$products = self::getWhInfos($pids, array('wh_id' => $wh_id));
		if (false === $products)
			return false;

		Logger::info(var_export($products, true));
		foreach ($products as $p) {
			if (true or ($p['flag'] & APPOINT_PRODUCT) == APPOINT_PRODUCT) {
				$appointProducts[] = $p['product_id'];
			}
		}
		Logger::info(var_export($appointProducts, true));
		if (empty($appointProducts)) {
			return array();
		}

		$result = EA_Promotion::getAppointInfo($appointProducts, $wh_id);
		if (false === $result) {
			self::$errMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:" . IProduct::$errMsg;
			self::$errCode = IProduct::$errCode;
			return false;
		}

		Logger::info(var_export($result, true));
		return $result;
	}

}