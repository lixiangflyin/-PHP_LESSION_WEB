<?php

require_once(PHPLIB_ROOT . 'api/appplatform/platform/web_stub_cntl.php');
require_once(PHPLIB_ROOT . 'api/appplatform/contentdao_stub4php.php');

require_once(PHPLIB_ROOT . 'inc/pricetype.inc.php');
require_once(PHPLIB_ROOT . 'inc/thh.inc.php');


class IThh
{
	const ALARM_NORMAL = 631770;
	const HIGH_PRI_ALARM_NORMAL = 635025;
	
	const ZS_TYPE_ID = 1;
	const THH_TYPE_ID = 2;
	
	const MIN_TYPE_ID = 1;
	const MAX_TYPE_ID = 2;
	
	const ZS_FLOOR_MAXID = 5;
	const THH_FLOOR_MAXID = 5;
	
	public static $errCode	= 0;
	public static $errMsg	= '';
	
	public static $title = array(
			IThh::ZS_TYPE_ID => array(
					1 => '特价秒杀',
					2 => '爆款热卖',
					3 => '限时抢购',
					4 => '精品推荐',
					5 => 'QQ会员专区'
				),
			IThh::THH_TYPE_ID => array(
					1 => '今夜当红',
					2 => '暗夜秒杀',
					3 => '品牌特卖',
					4 => 'QQ会员专区',
					5 => '备份楼层'
				)
		);
	
	public static function getTitle($type_id, $floor_id)
	{
		if (isset(self::$title[$type_id]) && isset(self::$title[$type_id][$floor_id])) {
			return self::$title[$type_id][$floor_id];
		}
		
		return false;
	}
	
	public static function getAd($site_id)
	{
		$pool_id = self::getSourcePoolId($site_id);
		if ($pool_id === null) {
			Logger::err('Get sourcePoolId, siteID: {$site_id}');
			return false;
		}
		
		$datas = IContentPool::getSourceByPoolForThh($pool_id);
		
		return $datas;
	}
	
	public static function getCurrentProducts($site_id, $type_id, $floor_id)
	{
		self::clearErr();
		
		$pool_id = self::getProductPoolId($site_id, $type_id, $floor_id);
		if ($pool_id === null) {
			self::$errCode = 101;
			self::$errMsg = "Failed to get pool id with site id $site_id type id $type_id floor id $floor_id";
			Logger::err("Fail to get productPoolId, siteID: {$site_id}, typeID:{$type_id}, floorID:{$floor_id}, " . self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
		
		$products = IContentPool::getProductByPool($pool_id);
		
		if ($products === false) {
			self::$errCode = 201;
			self::$errMsg = "Net error, failed to get products with pool id $pool_id";
			Logger::err("Get productPool, siteID: {$site_id}, typeID:{$type_id}, floorID:{$floor_id}, poolID:{$pool_id}, " . self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
		
		return $products;
	}
	
	public static function currentZsThh($wh_id, $type_id, $floor_id, $use_vip_price, $notify=false)
	{
		global $_SITE_WAREHOUSE_MAP_CFG;
		
		$site_id = false;
		foreach ($_SITE_WAREHOUSE_MAP_CFG as $k => $v) {
			if (in_array($wh_id, $v)) {
				$site_id = $k;
				break;
			}
		}
		
		if ($site_id === false) {
			return array();
		}
		
		return self::currentZsThhNew($site_id, $wh_id, $type_id, $floor_id, $use_vip_price, $notify, false);
	}
	
	/**
	 * 获得组装的数据
	 * 
	 */
	public static function currentZsThhNew($site_id, $wh_id, $type_id, $floor_id, $use_vip_price, $notify=false)
	{
		global $_SITE_THH_CFG, $_WAREHOUSE_THH_CFG;
		$datas = array();
		
		// 初始化log信息
		if ($type_id == IThh::ZS_TYPE_ID) {
			$channel = "早市";
		} elseif ($type_id == IThh::THH_TYPE_ID) {
			$channel = "天黑黑";
		} else {
			$channel = "未知";
			Logger::err("获取市场的商品数据失败，未知的频道类别 - {$type_id}");
		}
		$site_name = isset($_SITE_THH_CFG[$site_id]) ? $_SITE_THH_CFG[$site_id]['label'] : '未知';
		$wh_name = isset($_WAREHOUSE_THH_CFG[$wh_id]) ? $_WAREHOUSE_THH_CFG[$wh_id]['label'] : '未知';
		$floor_name = IThh::getTitle($type_id, $floor_id);
		
		// 商品池商品
		$products = self::getCurrentProducts($site_id, $type_id, $floor_id);
		if ($products === false || empty($products)) {
			Logger::err("Empty productpool, site: {$site_name}-{$site_id}, warehouse: {$wh_name}-{$wh_id}, channel: {$channel}-{$type_id}, floor: {$floor_name}-{$floor_id}.");
			return $datas;
		}
		
		// check return of productpool
		if (self::checkProducts($products, $site_id, $type_id, $floor_id) === false) {
			$msg = "商品池商品无效, site: {$site_name}-{$site_id}, warehouse: {$wh_name}-{$wh_id}, channel: {$channel}-{$type_id}, floor: {$floor_name}-{$floor_id}.";
			Logger::err($msg);
			if ($notify)
				qp_itil_write(IThh::ALARM_NORMAL, $msg);
			return array();
		}
		
		// 根据 type_id 获取需要展示的活动的时间
		$event_time = self::getEventTime($type_id);
		if ($event_time === false) {
			$msg = "计算多价时间失败, site: {$site_name}-{$site_id}, warehouse: {$wh_name}-{$wh_id}, channel: {$channel}-{$type_id}, floor: {$floor_name}-{$floor_id}.";
			Logger::err($msg);
			if ($notify)
				qp_itil_write(IThh::ALARM_NORMAL, $msg);
			return $datas;
		}

		$time_pids = array();
		$pids = array();
		foreach ($products as $product) {
			$item = array();
			$item['product_id'] = $product['product_id'];
			$item['price_time'] = $event_time;
			$time_pids[] = $item;
			$pids[] = $product['product_id'];
		}
		
		$err_pids = array();
		// 根据时间取多价信息
		$multprices = IProductPrice::getAllPriceInTime($wh_id, $time_pids);
		
		// check multprices
		if (self::checkMultPrices($multprices, $wh_id, $time_pids) === false) {
			$msg = "商品池商品无效, site: {$site_name}-{$site_id}, warehouse: {$wh_name}-{$wh_id}, channel: {$channel}-{$type_id}, floor: {$floor_name}-{$floor_id}.";
			Logger::err($msg);
			if ($notify)
				qp_itil_write(IThh::ALARM_NORMAL, $msg);
			return array();
		}
		
		$product_infos = IProduct::getProductsInfo($pids, $wh_id, true);
		foreach ($products as $product) {
			if(!isset($product_infos[$product['product_id']])) {
				$err_pids[] = $product['product_id'];
				Logger::err("Product {$product['product_id']} not found, site: {$site_name}-{$site_id}, warehouse: {$wh_name}-{$wh_id}, channel: {$channel}-{$type_id}, floor: {$floor_name}-{$floor_id}.");
				continue;
			}
			
			if (isset($multprices[$product['product_id']])) {
				$data					= array();
				$pid					= $product['product_id'];
				$data['sys_id']			= $pid;
				$data['pd_desc']		= $product['short_promote_text'];
				$data['pd_id']			= $product_infos[$pid]['product_char_id'];
				$data['pd_name']		= $product['product_name'];
				$data['pd_url']			= $product['url'];
				$data['pd_weight']		= $product_infos[$pid]['weight'];
				$data['pd_pic_num']		= $product_infos[$pid]['pic_num'];
				$data['pd_pic800']		= IProduct::getPic($product_infos[$pid]['product_char_id'], 'bpic');//bpic图片地址
				$data['pd_picm800']		= IProduct::getPic($product_infos[$pid]['product_char_id'], 'mpic');//mpic图片地址
				$data['pd_pic300']		= IProduct::getPic($product_infos[$pid]['product_char_id'], 'mm');
				$data['pd_pic120']		= IProduct::getPic($product_infos[$pid]['product_char_id'], 'middle');
				$data['pd_pic80']		= IProduct::getPic($product_infos[$pid]['product_char_id'], 'small');
				$data['pd_pic50']		= IProduct::getPic($product_infos[$pid]['product_char_id'], 'ss');
				$data['pd_pic200']		= IProduct::getPic($product_infos[$pid]['product_char_id'], 'pic200');
				$data['pd_pic160']		= IProduct::getPic($product_infos[$pid]['product_char_id'], 'pic160');
				$data['pd_pic60']		= IProduct::getPic($product_infos[$pid]['product_char_id'], 'pic60');
				$data['pd_color']		= $product_infos[$pid]['color'];
				$data['pd_size']		= $product_infos[$pid]['size'];
				$data['pd_onshelf_time'] = $product['on_market_date'];//上货时间
				$data['pd_promotion']	= $product['promote_text'];
				$data['state']			= $product['state'];
				
				// rewrite url
				if ($type_id == IThh::ZS_TYPE_ID) {
					if ($use_vip_price) {
						$channel_id = CHANNEL_TYPE_QQ_VIP;
					} else {
						$channel_id = CHANNEL_TYPE_MORNING_MARKET;
					}
				} elseif ($type_id == IThh::THH_TYPE_ID) {
					if ($use_vip_price) {
						$channel_id = CHANNEL_TYPE_QQ_VIP;
					} else {
						$channel_id = CHANNEL_TYPE_NIGHT_MARKET;
					}
				} else {
					$channel_id = 0;
					Logger::err("获取市场的渠道标识失败，未知的频道类别 - {$type_id}, site: {$site_name}-{$site_id}, warehouse: {$wh_name}-{$wh_id}, channel: {$channel}-{$type_id}, floor: {$floor_name}-{$floor_id}");
				}
				
				if($channel_id && strpos($data['pd_url'], '?') !== false) {
					$data['pd_url'] .= "&chid={$channel_id}";
				}
				
				$data['channel_id'] = $channel_id;

				if (self::getProductPrice($type_id, $multprices[$pid], $data, $use_vip_price) === false) {
					$err_pids[] = $pid;
					continue;
				}
				$data['pd_show_price'] = sprintf("%0.2f", $data['pd_show_price'] / 100);
				$data['pd_show_price_old'] = sprintf("%0.2f", $data['pd_show_price_old'] / 100);
				
				$datas[] = $data;
			} else {
				//skip this product
				$err_pids[] = $product['product_id'];
				Logger::err("Product {$product['product_id']} no multiprice, site: {$site_name}-{$site_id}, warehouse: {$wh_name}-{$wh_id}, channel: {$channel}-{$type_id}, floor: {$floor_name}-{$floor_id}.");
				continue;
			}
		}
		
		self::checkProductStock($datas, $wh_id);
		
		if (!empty($err_pids)) {
			// log err
			$msg = "有问题的商品ID: " . implode(',', $err_pids) . ", @(site: {$site_name}-{$site_id}, warehouse: {$wh_name}-{$wh_id}, channel: {$channel}-{$type_id}, floor: {$floor_name}-{$floor_id})";
			Logger::err($msg);
			if ($notify) {
				//qp_itil_write(IThh::ALARM_NORMAL, $msg);
			}
		}
		
		return $datas;
	}
	
	public static function checkProducts($products, $site_id, $type_id, $floor_id)
	{
		// TODO
		return true;
	}
	
	public static function checkMultPrices($multprices, $wh_id, $time_pids)
	{
		// TODO
		return true;
	}
	
	public static function checkJson($js_str)
	{
		// TODO
		return true;
	}
	
	public static function checkProductStock(&$products, $wh_id)
	{
		$unlimit_pids = array();
		foreach ($products as $product) {
			if (!$product['pd_stock_limit_flag']) {
				$pid = $product['sys_id'];
				$unlimit_pids[] = $pid;
			}
		}
		
		// 批量时，每批次的量需要控制
		$batch_size = 100;
		$count = ceil(count($unlimit_pids) / $batch_size);
		$inventeorys = array();
		for ($i = 0; $i < $count; $i++) {
			$tmp_pids = array_slice($unlimit_pids, $i * $batch_size, $batch_size);
			
			$tmp_inventeorys = self::requestErpProductInfo($tmp_pids, $wh_id, 1, false);
			foreach ($tmp_inventeorys as $k => $v) {
				$inventeorys[$k] = $v;
			}
		
			unset($tmp_pids);
			$tmp_pids = null;
			unset($tmp_inventeorys);
			$tmp_inventeorys = null;
		}
		
		//$inventeorys = self::requestErpProductInfo($unlimit_pids, $wh_id, 1, false);
		if (!empty($inventeorys)) {
			for ($i = 0; $i < count($products); $i++) {
				if (!$product['pd_stock_limit_flag']) {
					$pid = $products[$i]['sys_id'];
					if (isset($inventeorys[$pid]) && isset($inventeorys[$pid]['stock_percent'])) {
						$products[$i]['pd_stock'] = $inventeorys[$pid]['stock_percent'];
					}
				}
			}
		}
		
		return;
	}
	
	public static function getProductPrice($type_id, $multprice, &$product, $use_vip_price=false)
	{
		$price_desc = "";
		if ($type_id == IThh::ZS_TYPE_ID) {
			$price_desc = "早市价";
		} elseif ($type_id == IThh::THH_TYPE_ID) {
			$price_desc = "天黑黑价";
		} else {
			Logger::err("获取商品的多价描述失败，未知的频道类别 - {$type_id}");
			return false;
		}
		
		// 渠道价
		$channel_price_key = PRICE_TYPE_CHANNEL . ':' . ID_TYPE_CHANNEL_ALL;
		// 一般促销价
		$promote_price_key = PRICE_TYPE_PROMOTE . ':' . ID_TYPE_PROMOTE_ALL;
		// 易迅价
		$icson_price_key = PRICE_TYPE_ICSON . ':' . ID_TYPE_ICSON_ALL;
		// QQ会员价
		$qq_vip_price_key = PRICE_TYPE_VIP . ':' . ID_TYPE_VIP_QQ_VIP;
		
		if ($use_vip_price) {
			$multprice_key = $qq_vip_price_key;
			if (!isset($multprice[$qq_vip_price_key]) || $multprice[$qq_vip_price_key]['show_price'] > $multprice[$icson_price_key]['show_price']) {
				Logger::err("Product {$product['sys_id']} has wrong or no qq_vip_price.");
				return false;
			}
			$product['pd_show_price'] = $multprice[$multprice_key]['show_price'];
		} elseif (isset($multprice[$channel_price_key])) {
			$multprice_key = $channel_price_key;
			if ((isset($multprice[$promote_price_key]) && $multprice[$channel_price_key]['show_price'] > $multprice[$promote_price_key]['price_after']) || $multprice[$channel_price_key]['show_price'] > $multprice[$icson_price_key]['show_price']) {
				Logger::err("Product {$product['sys_id']} has wrong channel_price.");
				return false;
			}

			// 多价规则名称校验
			if ($price_desc != $multprice[$multprice_key]['price_desc']) {
				Logger::err("Product {$product['sys_id']} has wrong multprice desc.");
				return false;
			}
			
			$product['pd_show_price'] = $multprice[$multprice_key]['show_price'];
		} elseif (isset($multprice[$promote_price_key])) {
			$multprice_key = $promote_price_key;
			if ($multprice[$promote_price_key]['price_after'] > $multprice[$icson_price_key]['show_price']) {
				Logger::err("Product {$product['sys_id']} has wrong promote_price.");
				return false;
			}
			
			// 多价规则名称校验
			if ($price_desc != $multprice[$multprice_key]['price_desc']) {
				Logger::err("Product {$product['sys_id']} has wrong multprice desc.");
				return false;
			}
			
			$product['pd_show_price'] = $multprice[$multprice_key]['price_after'];
		} else {
			Logger::err("Product {$product['sys_id']} has no price except icson_price.");
			return false;
		}
		
		$product['pd_show_price_old'] = $multprice[$icson_price_key]['show_price'];
		
		$product['pd_stock_limit_flag'] = $multprice[$multprice_key]['stock_limit'];
		$product['pd_stock'] = $multprice[$multprice_key]['stock_percent'];
		$product['pd_price_start'] = $multprice[$multprice_key]['start_time'];
		
		return true;
	}
	
	/**
	 * 获得指定站点的团购商品池ID
	 * 
	 * @param int $site_id
	 */
	public static function getProductPoolId($site_id, $type_id, $floor_id)
	{
		$db	= Config::getDB('icson_event');
		$settings = $db->getRows("SELECT * FROM tuan_settings WHERE skey='productpool_{$site_id}_{$type_id}_{$floor_id}'");
		if (!empty($settings)) {
			return intval($settings[0]['svalue']);
		} else {
			return null;
		}
	}
	
	public static function getSourcePoolId($site_id)
	{
		$db	= Config::getDB('icson_event');
		$settings = $db->getRows("SELECT * FROM tuan_settings WHERE skey='adpool_{$site_id}'");
		if (!empty($settings)) {
			return intval($settings[0]['svalue']);
		} else {
			return null;
		}
	}
	
	public static function getUsedTemplateKey($type_id) {
		return IDataCache::getPrefix(BIZ_TYPE_ZSTHH_TEMPLATE) . $type_id . '_used';
	}
	
	public static function getReservedTemplateKey($type_id) {
		return IDataCache::getPrefix(BIZ_TYPE_ZSTHH_TEMPLATE) . $type_id . '_reserved';
	}
	
	private static function clearErr() {
		self::$errCode = 0;
		self::$errMsg = '';
	}
	
	/**
	 * 1.早市第一个楼层2个商品
	 * 2.早市第二个楼层4个商品
	 * 3.天黑黑第一个楼层3个商品
	 * 以上3个楼层的商品一旦不足，取商品池中的下一个有库存商品补充，如果依然不足，再取无库存的补充
	 * 4.天黑黑第二个楼层最低5个商品，最多10个
	 * 5.天黑黑第四个楼层最低5个商品，最多10个
	 * 6.早市第五个楼层是会员楼层，最少5个，最多10个，如果不满足，就隐藏楼层，但是不影响页面刷新
	 * 7.天黑黑第四个楼层是会员楼层，最少5个，最多10个，如果不满足，就隐藏楼层，但是不影响页面刷新
	 * 8.早市的第四个楼层（精品推荐），废弃
	 * 对于其它楼层，无库存的统一置底
	 * 
	 * 功能：
	 * 1. 重排序楼层商品
	 * 2. 根据规则保留特定商品，并检查商品数量
	 * 3. 设定ytag以及与ytag相关的cart/grade
	 * 
	 * @param int $type_id 活动市场的类别ID
	 * @param int $floor_id 楼层ID
	 * @param array $products 此楼层的有效商品
	 * @param bool $json_flag 是否用于json数据, 目前json和html数据相同
	 * @param bool $force_flag 是否强制得到结果，即使数据不足
	 * 				非强制情况下，数量不足返回false
	 * 				强制情况下，有多少数据就返回多少，不收最低数量限制
	 * @return array 排序后的商品\n
	 * 			false 表明不符合楼层规则，此楼层数据有问题
	 */
	public static function reorderProduct($type_id, $floor_id, $products, $json_flag=false, $force_flag=false) {
		$has_stock_products = array();
		$out_stock_products = array();
		$ret_stock_products = array();
		$default_min_product_num = 1;
		
		foreach ($products as $product) {
			if ($product['pd_stock'] > 0) {
				$has_stock_products[] = $product;
			} else {
				$out_stock_products[] = $product;
			}
		}
		
		if ($type_id == IThh::ZS_TYPE_ID) { // 早市
			if ($floor_id == 1) { // 早市第一个楼层2个商品
				$min_product_num = 2;
				$max_product_num = 2;
				if (count($products) < $min_product_num && !$force_flag) {
					return false;
				}
				
				if (count($has_stock_products) >= $max_product_num) {
					$ret_stock_products = array_slice($has_stock_products, 0, $max_product_num);
				} else {
					$left = $max_product_num - count($has_stock_products);
					$ret_stock_products = array_merge($has_stock_products, array_slice($out_stock_products, 0, $left));
				}
			} elseif ($floor_id == 2) { // 早市第二个楼层4个商品
				$min_product_num = 4;
				$max_product_num = 4;
				if (count($products) < $min_product_num && !$force_flag) {
					return false;
				}
				
				if (count($has_stock_products) >= $max_product_num) {
					$ret_stock_products = array_slice($has_stock_products, 0, $max_product_num);
				} else {
					$left = $max_product_num - count($has_stock_products);
					$ret_stock_products = array_merge($has_stock_products, array_slice($out_stock_products, 0, $left));
				}
			} elseif ($floor_id == 3) { // 早市第三个楼层，有‘已售完’的逻辑
				if (count($products) < $default_min_product_num && !$force_flag) {
					return false;
				}
				// 防止过多的已售完商品出现
				if (count($has_stock_products) > 0 && count($out_stock_products) >= 12) {
					$out_stock_products = array_slice($out_stock_products, 0, 4);
				}
				$ret_stock_products = array_merge($has_stock_products, $out_stock_products);
			} elseif ($floor_id == 5) { // 早市第五个楼层是会员楼层，如果无数据不影响全局
				$min_product_num = 5;
				$max_product_num = 10;
				if (count($products) < $min_product_num && !$force_flag) {
					return array(); // 允许此楼层空数据，不影响整个页面的刷新
				}
				
				if (count($has_stock_products) >= $max_product_num) {
					$ret_stock_products = array_slice($has_stock_products, 0, $max_product_num);
				} else {
					$left = $max_product_num - count($has_stock_products);
					$ret_stock_products = array_merge($has_stock_products, array_slice($out_stock_products, 0, $left));
				}
			} else {
				if (count($products) < $default_min_product_num && !$force_flag) {
					return false;
				}
				$ret_stock_products = array_merge($has_stock_products, $out_stock_products);
			}
		} elseif ($type_id == IThh::THH_TYPE_ID) {
			if ($floor_id == 1) { // 天黑黑第一个楼层3个商品
				$min_product_num = 3;
				$max_product_num = 3;
				if (count($products) < $min_product_num && !$force_flag) {
					return false;
				}
				
				if (count($has_stock_products) >= $max_product_num) {
					$ret_stock_products = array_slice($has_stock_products, 0, $max_product_num);
				} else {
					$left = $max_product_num - count($has_stock_products);
					$ret_stock_products = array_merge($has_stock_products, array_slice($out_stock_products, 0, $left));
				}
			} elseif ($floor_id == 2) {
				$min_product_num = 5;
				$max_product_num = 10;
				if (count($products) < $min_product_num && !$force_flag) {
					return false;
				}
				
				if (count($has_stock_products) >= $max_product_num) {
					$ret_stock_products = array_slice($has_stock_products, 0, $max_product_num);
				} else {
					$left = $max_product_num - count($has_stock_products);
					$ret_stock_products = array_merge($has_stock_products, array_slice($out_stock_products, 0, $left));
				}
			} elseif ($floor_id == 3) { // 第三个楼层，有‘已售完’的逻辑
				if (count($products) < $default_min_product_num && !$force_flag) {
					return false;
				}
				// 防止过多的已售完商品出现
				if (count($has_stock_products) > 0 && count($out_stock_products) >= 12) {
					$out_stock_products = array_slice($out_stock_products, 0, 4);
				}
				$ret_stock_products = array_merge($has_stock_products, $out_stock_products);
			} elseif ($floor_id == 4) { // 会员楼层，如无数据不影响整个页面的刷新
				$min_product_num = 5;
				$max_product_num = 10;
				if (count($products) < $min_product_num && !$force_flag) {
					return array(); // 允许此楼层空数据，不影响整个页面的刷新
				}
				
				if (count($has_stock_products) >= $max_product_num) {
					$ret_stock_products = array_slice($has_stock_products, 0, $max_product_num);
				} else {
					$left = $max_product_num - count($has_stock_products);
					$ret_stock_products = array_merge($has_stock_products, array_slice($out_stock_products, 0, $left));
				}
			} elseif ($floor_id == 5) { // 备份楼层，如无数据不影响整个页面的刷新
				$ret_stock_products = array_merge($has_stock_products, $out_stock_products);
			} else {
				if (count($products) < $default_min_product_num && !$force_flag) {
					return false;
				}
				$ret_stock_products = array_merge($has_stock_products, $out_stock_products);
			}
		} else {
			Logger::err("排序市场楼层的商品数据失败，未知的频道类别 - {$type_id}");
			return false;
		}
		
		// 获取其他信息
		$pids = array();
		foreach ($ret_stock_products as $p) {
			$pids[] = $p['sys_id'];
		}
		
		// 评论信息, 批量时，每批次的量需要控制
		$product_reviews = array();
		if (!empty($pids)) {
			$batch_size = 32;
			$count = ceil(count($pids) / $batch_size);
			for ($i = 0; $i < $count; $i++) {
				$tmp_pids = array_slice($pids, $i * $batch_size, $batch_size);
				
				$tmp_reviews = IReviews::getProductsReviewCount($tmp_pids, false);
				foreach ($tmp_reviews as $k => $v) {
					$product_reviews[$k] = $v;
				}
				
				unset($tmp_pids);
				$tmp_pids = null;
				unset($tmp_reviews);
				$tmp_reviews = null;
			}
		}
		
		/*if ($json_flag) {
			for ($i = 0; $i < count($ret_stock_products); $i++) {
				$review = isset($product_reviews[$ret_stock_products[$i]['sys_id']]) ? $product_reviews[$ret_stock_products[$i]['sys_id']] : array();
				$reviewCount = isset($review['total']) ? $review['total'] : 0;
				$ret_stock_products[$i]['grade'] = $reviewCount;
			}
		} else {*/
			// 组合购买链接，评论链接
			$ytag_base1 = 60000 + $floor_id * 1000;
			$ytag_base2 = 30000 + $floor_id * 1000;
			$ytag_base3 = 50000 + $floor_id * 1000;
			$ytag_base4 = 40000 + $floor_id * 1000;
			for ($i = 0; $i < count($ret_stock_products); $i++) {
				$ret_stock_products[$i]['pd_ytag1'] = $ytag_base1 + $i;
				$ret_stock_products[$i]['pd_ytag2'] = $ytag_base2 + $i;
				
				$ret_stock_products[$i]['cart'] = self::_getCartTag($ret_stock_products[$i]['sys_id'], $ret_stock_products[$i]['pd_url'], $ret_stock_products[$i]['state'], $ret_stock_products[$i]['pd_stock'], $ret_stock_products[$i]['channel_id'], $ret_stock_products[$i]['pd_price_start'], $ytag_base3 + $i);
				$ret_stock_products[$i]['grade'] = self::_getGradeTag($product_reviews, $ret_stock_products[$i]['sys_id'], $ytag_base4 + $i);
			}
		//}
		
		return $ret_stock_products;
	}
	
	public static function requestErpProductInfo($pidArr, $whereId, $siteType = 1, $bNeedDMSAndLastOrderPrice = true){
		global $_WEBSITE_CFG;
		$prodInfo = array();
		$whereId = $whereId ? $whereId : 1;
		if (!is_array($pidArr) || empty($pidArr)) {
			return $prodInfo;
		}
		$ids = implode(',', $pidArr);
		//$oldDB = Config::getMSDB($_WEBSITE_CFG[$whereId]['connectionName']);
		$oldDB = Config::getMSDB('ICSON_Product'); //ERP数据库迁移
		if ($oldDB === false) {
			return $prodInfo;
		}
	
		if ($bNeedDMSAndLastOrderPrice) {
			$sql = "SELECT  p.DMS 'day_sale_count', pp.LastOrderPrice 'new_buy_price', p.SysNo
					FROM Product p INNER JOIN Product_Price pp ON pp.ProductSysNo = p.SysNo
					WHERE pp.SubStationSysNo=" . $whereId . " AND p.SysNo IN (" . $ids . ")";
			$products = $oldDB->getRows($sql);
			if ($products === false) {
				return $prodInfo;
			}
				
			foreach ($products as $p) {
				$prodInfo[$p['SysNo']]['day_sale_count'] = sprintf("%0.2f", $p['day_sale_count']);
				$prodInfo[$p['SysNo']]['new_buy_price'] = sprintf("%0.2f", $p['new_buy_price']);
			}
		}
	
		if ($siteType == 2) {
			$qqBuyInfo = IProduct::getWgIdFromProductId($pidArr, $whereId);
		}
	
		$pro = IProductInventory::getProductsInventeory($pidArr, $whereId);
		if (isset($pro) && is_array($pro) && count($pro)) {
			foreach ($pro as $p) {
				$prodInfo[$p['product_id']]['account_count'] = isset($p['account_num']) ? $p['account_num'] : 0;
				$prodInfo[$p['product_id']]['available_count'] = isset($p['num_available']) && isset($p['virtual_num']) ? $p['num_available'] + $p['virtual_num'] : 0;
			}
		}
	
		$dicountArr = self::requestErpGetdiscount($pidArr, $whereId);
	
		foreach ($pidArr as $pid) {
			$prodInfo[$pid]['day_sale_count'] = isset($prodInfo[$pid]['day_sale_count']) ? $prodInfo[$pid]['day_sale_count'] : '0.00';
			$prodInfo[$pid]['new_buy_price'] = isset($prodInfo[$pid]['new_buy_price']) ? $prodInfo[$pid]['new_buy_price'] : '0.00';
			$prodInfo[$pid]['account_count'] = isset($prodInfo[$pid]['account_count']) ? $prodInfo[$pid]['account_count'] : 0;
			$prodInfo[$pid]['available_count'] = isset($prodInfo[$pid]['available_count']) ? $prodInfo[$pid]['available_count'] : 0;
			if ($siteType == 2) {
				$prodInfo[$pid]['available_count'] = isset($qqBuyInfo[$pid]['stockRealNum']) ? $qqBuyInfo[$pid]['stockRealNum'] : $prodInfo[$pid]['available_count'];
			}
			$totalCount = isset($dicountArr[$pid]['quantity']) ? $dicountArr[$pid]['quantity'] : $prodInfo[$pid]['account_count'];
				
			if ($prodInfo[$pid]['available_count'] <= 0) {
				$percent = 0;
			} else if($totalCount <= 0) {
				$percent = 100;
			} else if($totalCount <= $prodInfo[$pid]['available_count']) {
				$percent = 100;
			} else {
				$percent = ceil($prodInfo[$pid]['available_count'] * 100 / $totalCount);
			}
			$prodInfo[$pid]['stock_percent'] = $percent;
				
			if (!isset($dicountArr[$pid])) {
				$prodInfo[$pid]['pd_sell'] = '';
				$prodInfo[$pid]['pd_countdown'] = '';
			} else {
				$soldNum = 0;
				if (isset($dicountArr[$pid]['quantity']) && isset($prodInfo[$pid]['available_count'])) {
					$soldNum = $dicountArr[$pid]['quantity'] - $prodInfo[$pid]['available_count'];
				}
				$prodInfo[$pid]['pd_sell'] = $soldNum > 0 ? $soldNum : 0;
	
				$prodInfo[$pid]['pd_countdown'] = '';
				if (isset($dicountArr[$pid]['start_time']) && isset($dicountArr[$pid]['end_time'])) {
					$now = time();
					if (strtotime($dicountArr[$pid]['start_time']) > $now) {
						$prodInfo[$pid]['pd_countdown'] = '<div class="pro_countdown"><span style="display:none;">' . date('Y/m/d H:i:s', strtotime($dicountArr[$pid]['start_time'])) . '|' . date('Y/m/d H:i:s', strtotime($dicountArr[$pid]['end_time'])) . '</span><span>未开始</span></div>';
					} else if (strtotime($dicountArr[$pid]['end_time']) < $now) {
						$prodInfo[$pid]['pd_countdown'] = '<div class="pro_countdown"><span>已结束</span></div>';
					} else {
						$prodInfo[$pid]['pd_countdown'] = '<div class="pro_countdown"><span style="display:none;">' . date('Y/m/d H:i:s', strtotime($dicountArr[$pid]['start_time'])) . '|' . date('Y/m/d H:i:s', strtotime($dicountArr[$pid]['end_time'])) . '</span></div>';
					}
					//					$days = $hours = $minutes = $seconds = 0;
					//					$countdown = strtotime($dicountArr[$pid]['end_time']) - time();
					//					if ($countdown > 0) {
					//						$days = floor($countdown / 86400);
					//						$countdown = $countdown % 86400;
					//						$hours = floor($countdown / 3600);
					//						$countdown = $countdown % 3600;
					//						$minutes = floor($countdown / 60);
					//						$seconds = $countdown % 60;
					//					}
					//					$prodInfo[$pid]['pd_countdown'] = sprintf('<div class="pro_countdown"><span>%d</span>天<span>%02d</span>小时<span>%02d</span>分钟<span>%02d</span>秒</div>', $days, $hours, $minutes, $seconds);
				}
			}
		}
	
		return $prodInfo;
	}

	public static function requestErpGetdiscount($pidArr, $whereId) {
		global $_WEBSITE_CFG;
		$newProducts = array();
		$whereId = $whereId ? $whereId : 1;
		
		if (!is_array($pidArr) || empty($pidArr)) {
			return $newProducts;
		}
		$ids = implode(',', $pidArr);
		
		//$oldDB = Config::getMSDB($_WEBSITE_CFG[$whereId]['connectionName']);
		$oldDB = Config::getMSDB('ICSON_Product'); //ERP数据库迁移
		if ($oldDB === false) {
			return $newProducts;
		}
		$sql = "SELECT SysNo, ProductSysNo, CountDownCurrentPrice, CountDownQty, Type, CONVERT(varchar, StartTime, 120) AS StartTime, 
				CONVERT(varchar, EndTime, 120) AS EndTime FROM Sale_CountDown WHERE SubStationSysNo=" . $whereId . " AND ProductSysNo in (" . $ids . ") AND status=1";
		$products = $oldDB->getRows($sql);
		if ($products === false) {
			return $newProducts;
		}
		foreach ($products as $p) {
			$newProducts[$p['ProductSysNo']]['sys_num'] = $p['ProductSysNo'];
			$newProducts[$p['ProductSysNo']]['price'] = sprintf('%0.2f', $p['CountDownCurrentPrice']);
			$newProducts[$p['ProductSysNo']]['quantity'] = $p['CountDownQty'];
			$newProducts[$p['ProductSysNo']]['type'] = $p['Type'];
			$newProducts[$p['ProductSysNo']]['start_time'] = substr($p['StartTime'], 0, -3);
			$newProducts[$p['ProductSysNo']]['end_time'] = substr($p['EndTime'], 0, -3);
		}
		return $newProducts;
	}
	
	private static function _getCartTag($product_id, $url, $state, $inventory, $channel_id, $price_start_time, $tag = false) {
		$tag = !empty($tag) && intval($tag) ? ' ytag="' . intval($tag) . '"' : '';
		if ($state != 0) {//已下架 
			$cart = '<a' . $tag . ' href="' . $url . '" target="_blank" class="btn_common">已售完</a>';
		} else if($inventory <= 0) {//已售完
			$cart = '<a' . $tag . ' href="' . $url . '" target="_blank" class="btn_common">已售完</a>';
		} else {//有货
			$cart = '<a' . $tag . ' href="http://buy.51buy.com/cart.html?pid=' . $product_id . '&pnum=1' . ($channel_id ? "&chid={$channel_id}" : '') . '" target="_blank" class="btn_common" starttime="' . $price_start_time . '">加入购物车</a>';//加入购物车
		}
		return $cart;
	}
	
	private static function _getGradeTag($productsReviews, $pId, $tag = false) {
		$tag = !empty($tag) && intval($tag) ? ' ytag="' . intval($tag) . '"' : '';
		$grade = '';
		$review = isset($productsReviews[$pId]) ? $productsReviews[$pId] : array();
		$length = isset($review['experience_number']) && isset($review['satisfaction']) && !empty($review['experience_number']) ? round( $review['satisfaction'] * 20 / $review['experience_number'], 0) : 100;
		$reviewCount = isset($review['total']) ? $review['total'] : 0;
		if (empty($reviewCount)) {
			$grade = '<span class="txt">暂无评论</span>
				（<a' . $tag . '  target="_blank" href="http://item.51buy.com/review-toadddiscussion-' . $pId . '.html#review_box">我来第一个评论</a>）';
		} else {
			$grade = '<span class="icon_star"><b style="width: ' . $length . '%;"></b></span>
				（<a' . $tag . '  target="_blank" href="http://item.51buy.com/item-' . $pId . '.html#review_box">' . $reviewCount . '条</a>）';
		}
		return $grade;
	}
	
	public static function getEventTime($type_id)
	{
		$now_today = time();
		$time_today = ToolUtil::getDetailDateTime($now_today);
		if ($type_id == IThh::ZS_TYPE_ID) { // 早市
			if ($time_today['hour'] >= 0 && $time_today['hour'] < 7) { // 今天的预告
				return strtotime(sprintf("%d-%02d-%02d 10:59:59", $time_today['year'], $time_today['month'], $time_today['day']));
			} elseif ($time_today['hour'] >= 7 && $time_today['hour'] < 11) { // 进行中
				return strtotime(sprintf("%d-%02d-%02d 10:59:59", $time_today['year'], $time_today['month'], $time_today['day']));
			} elseif ($time_today['hour'] >= 11 && $time_today['hour'] < 18) { // 已结束
				return strtotime(sprintf("%d-%02d-%02d 10:59:59", $time_today['year'], $time_today['month'], $time_today['day']));
			} elseif ($time_today['hour'] >= 18 && $time_today['hour'] < 24) { // 明天的预告
				// 明天的早市活动
				$nextday = $now_today + 86400;
				$time_nextday = ToolUtil::getDetailDateTime($nextday);
				return strtotime(sprintf("%d-%02d-%02d 10:59:59", $time_nextday['year'], $time_nextday['month'], $time_nextday['day']));
			} else {
				Logger::err("获取市场的多价时间失败，@(" . json_encode($time_today) . ", {$type_id})");
			}
		} elseif ($type_id == IThh::THH_TYPE_ID) { // 天黑黑
			if ($time_today['hour'] >= 0 && $time_today['hour'] < 7) { // 昨天已结束的
				// 昨天的天黑黑活动
				$preday = $now_today - 86400;
				$time_preday = ToolUtil::getDetailDateTime($preday);
				return strtotime(sprintf("%d-%02d-%02d 23:59:59", $time_preday['year'], $time_preday['month'], $time_preday['day']));
			} elseif ($time_today['hour'] >= 7 && $time_today['hour'] < 11) { // 今天的预告
				return strtotime(sprintf("%d-%02d-%02d 23:59:59", $time_today['year'], $time_today['month'], $time_today['day']));
			} elseif ($time_today['hour'] >= 11 && $time_today['hour'] < 18) { // 今天的预告
				return strtotime(sprintf("%d-%02d-%02d 23:59:59", $time_today['year'], $time_today['month'], $time_today['day']));
			} elseif ($time_today['hour'] >= 18 && $time_today['hour'] < 24) { // 进行中
				return strtotime(sprintf("%d-%02d-%02d 23:59:59", $time_today['year'], $time_today['month'], $time_today['day']));
			} else {
				Logger::err("获取市场的多价时间失败，@(" . json_encode($time_today) . ", {$type_id})");
			}
		} else {
			Logger::err("获取市场的多价时间失败，未知的频道类别 - {$type_id}");
		}
		
		return false;
	}
}

// End Of Script