<?php
require_once PHPLIB_ROOT . 'inc/pricetype.inc.php';

class IEventInfo
{
	public static $errCode = 0;
	public static $errMsg = '';
	private static $isAllSite = 0;
	private static $darkNightIds = array(
		'1' => array (
			'dev' => '100',
			'test' => '84',
			'test55' => '5289',
			'online' => '1115'
		),
		'1001' => array (
			'dev' => '133',
			'test' => '89',
			'test55' => '5289',
			'online' => '1116'
		),
		'2001' => array (
			'dev' => '134',
			'test' => '86',
			'test55' => '5289',
			'online' => '1117'
		),
		'3001' => array (
			'dev' => '169',
			'test' => '105',
			'test55' => '5289',
			'online' => '1995'
		),
		'4001' => array (
			'dev' => '144',
			'test' => '100',
			'test55' => '5289',
			'online' => '1215'
		),
		'5001' => array (
			'dev' => '170',
			'test' => '107',
			'test55' => '5289',
			'online' => '2447'
		),
	);

	private static $morningIds = array(
		'1' => array (
			'dev' => '100',
			'test' => '84',
			'test55' => '5289',
			'online' => '4373'
		),
		'1001' => array (
			'dev' => '133',
			'test' => '89',
			'test55' => '5289',
			'online' => '4374'
		),
		'2001' => array (
			'dev' => '134',
			'test' => '86',
			'test55' => '5289',
			'online' => '4375'
		),
		'3001' => array (
			'dev' => '169',
			'test' => '105',
			'test55' => '5289',
			'online' => '4376'
		),
		'4001' => array (
			'dev' => '144',
			'test' => '100',
			'test55' => '5289',
			'online' => '4377'
		),
		'5001' => array (
			'dev' => '170',
			'test' => '107',
			'test55' => '5289',
			'online' => '4378'
		),
	);
	
	public static function getEventById($eventId) {
		$DB = Config::getDB('icson_admin_event');
		$sql = 'SELECT * FROM t_basic WHERE activity_id=' . $eventId;
		$event = $DB->getRows($sql);
		if ($event === false) {
			self::$errCode = $DB->errCode;
			self::$errMsg = $DB->errMsg;
			return false;
		} else {
			if(isset($event[0])) {
				$event[0]['params'] = ToolUtil::gbJsonDecode($event[0]['params']);
			}
			return !empty($event) && isset($event[0]) ? $event[0] : array();
		}
		
	}
	

	public static function getProductIdsByBlockId($blockId) {
		$prodIds = array();
		$DB = Config::getDB('icson_admin_event');
		$sql = 'SELECT product_id FROM t_product WHERE block_id=' . $blockId . ' ORDER BY order_id ASC';
		$products = $DB->getRows($sql);
		if ($products === false) {
			self::$errCode = $DB->errCode;
			self::$errMsg = $DB->errMsg;
			return $prodIds;
		} else {
			foreach ($products as $product) {
				$prodIds[] = $product['product_id'];
			}
			$prodIds = array_unique($prodIds);
		}
		return $prodIds;
	}
	

	public static function getSpecialProductBlock($eventId, $baseInfo) {
		global $_PRICE_IDS;
		$prodInfo = array();
		$DB = Config::getDB('icson_admin_event');
		$sql = 'SELECT block_id, pool_id FROM t_block WHERE status=1 AND content_type=2 AND activity_id=' . $eventId;
		$spblock = $DB->getRows($sql);
		if ($spblock === false) {
			self::$errCode = $DB->errCode;
			self::$errMsg = $DB->errMsg;
			return $prodInfo;
		} else if (empty($spblock)) {
			return $prodInfo;
		} else {
			$price_time = empty($baseInfo['params']['price_time']) ? 0 : strtotime($baseInfo['params']['price_time']);
			if(empty($spblock[0]['pool_id'])) {
				$prodIds = self::getProductIdsByBlockId($spblock[0]['block_id']);
				if (!empty($prodIds)) {
					$price_params = array();
					foreach ($prodIds as $pid) {
						$price_params[] = array(
							'product_id' => $pid,
							'price_time' => $price_time
						);
					}
					$productInfos = IProduct::getProductsInfo($prodIds, $baseInfo['where_id'], true);
					//$productPrice = IProductPrice::getAllPrice($baseInfo['where_id'], $prodIds);
					$productPrice = self::getAllPrice($baseInfo['where_id'], $price_params);
					
					if(count($baseInfo['sites']) > 1) {
						$allSitePrices = array();
						foreach ($baseInfo['sites'] as $site_id) {
							//$allSitePrices[$k] = IProductPrice::getAllPrice($k, $prodIds);
							$allSitePrices[$site_id] = self::getAllPrice($site_id, $price_params);
						}
					}
					
					foreach ($prodIds as $prodId) {
						if (isset($productInfos[$prodId]) && !empty($productInfos[$prodId])) {
							$productInfo = $productInfos[$prodId];
							$productInfo['source_id'] = $baseInfo['price_c1_id'];
							$productInfo['scene_id'] = $baseInfo['price_c2_id'];
							$productInfo['channel_id'] = $baseInfo['price_c3_id'];
							$productInfo['label'] = isset($_PRICE_IDS[$baseInfo['price_c1_id']]['children'][$baseInfo['price_c2_id']]['children'][$baseInfo['price_c3_id']]['name'])
												? $_PRICE_IDS[$baseInfo['price_c1_id']]['children'][$baseInfo['price_c2_id']]['children'][$baseInfo['price_c3_id']]['name'] : '';
							$productInfo['price_id'] = 0;//$mutiPrice['price_id'];
							$productInfo['m_price'] = self::getPrice($productPrice[$prodId], $baseInfo['price_c1_id'], $baseInfo['price_c2_id']);
							$productInfo['item_url'] = 'http://item.51buy.com/item-' . $productInfo['product_id'] . '.html';
							if($baseInfo['price_c3_id']) {
								if(strpos($productInfo['item_url'], '?') !== false) {
									$productInfo['item_url'] .= "&chid={$baseInfo['price_c3_id']}";
								} else {
									$productInfo['item_url'] .= "?chid={$baseInfo['price_c3_id']}";
								}
							}
							$prodImgs = self::getProductImgs($productInfo['product_char_id']);
							$productInfo = array_merge($productInfo, $prodImgs);
							if (count($baseInfo['sites']) > 1) {
								foreach ($baseInfo['sites'] as $site_id) {
									$productInfo['stock_all'][$site_id] = self::getStockRest($allSitePrices[$site_id][$prodId], $baseInfo['price_c1_id'], $baseInfo['price_c2_id']);
									$productInfo['show_price_all'][$site_id] = self::getPrice($allSitePrices[$site_id][$prodId], PRICE_TYPE_ICSON, ID_TYPE_ICSON_ALL);
									$productInfo['market_price_all'][$site_id] = $productInfo['market_price'];
									$productInfo['m_price_all'][$site_id] = self::getStockRest($allSitePrices[$site_id][$prodId], $baseInfo['price_c1_id'], $baseInfo['price_c2_id']);
									$productInfo['item_url_all'][$site_id] = $productInfo['item_url'];
								}
							}
							$prodInfo[] = $productInfo;
						}		
					}
				}
			} else {
				$products = IContentPool::getProductByPool($spblock[0]['pool_id']);
				if($products === false) {
					Logger::err(IContentPool::$errCode . ' : ' . IContentPool::$errMsg);
					$products = array();
				}
				
				$product_ids = array();
				$price_params = array();
				foreach($products as $p) {
					$product_ids[] = $p['product_id'];
					$price_params[] = array(
						'product_id' => $p['product_id'],
						'price_time' => $price_time
					);
				}
				$product_infos = IProduct::getProductsInfo($product_ids, $baseInfo['where_id'], true);
				//$productPrice = IProductPrice::getAllPrice($baseInfo['where_id'], $product_ids);
				$productPrice = self::getAllPrice($baseInfo['where_id'], $price_params);
				
				if(count($baseInfo['sites']) > 1) {
					$allSitePrices = array();
					foreach ($baseInfo['sites'] as $site_id) {
						//$allSitePrices[$k] = IProductPrice::getAllPrice($k, $product_ids);
						$allSitePrices[$site_id] = self::getAllPrice($site_id, $price_params);
					}
				}
				
				foreach ($products as $p) {
					if(!empty($product_infos[$p['product_id']])) {
						$productInfo = $product_infos[$p['product_id']];
						$productInfo['c3_ids'] = $p['category_id'];
						$productInfo['onshelf_time'] = $p['on_market_date'];
						$productInfo['promotion_word'] = $p['promote_text'];
						$productInfo['market_price'] = $p['market_price'];
						$productInfo['price'] = self::getPrice($productPrice[$p['product_id']], PRICE_TYPE_ICSON, ID_TYPE_ICSON_ALL);//$p['multiprices'][$baseInfo['where_id']]['price'];
						$productInfo['show_price'] = self::getPrice($productPrice[$p['product_id']], PRICE_TYPE_ICSON, ID_TYPE_ICSON_ALL);
						/*if($baseInfo['price_c1_id'] == PRICE_TYPE_ICSON || !isset($p['multiprices'][$baseInfo['where_id']]["{$baseInfo['price_c1_id']}:{$baseInfo['price_c2_id']}"])) {
							$productInfo['m_price'] = $p['multiprices'][$baseInfo['where_id']]['price'];
						} else {
							$productInfo['m_price'] = $p['multiprices'][$baseInfo['where_id']]["{$baseInfo['price_c1_id']}:{$baseInfo['price_c2_id']}"]['mPrice'];
						}*/
						$productInfo['m_price'] = self::getPrice($productPrice[$p['product_id']], $baseInfo['price_c1_id'], $baseInfo['price_c2_id']);
						$productInfo['price_id'] = 0;//$baseInfo['mutipriceid'];
						$productInfo['source_id'] = $baseInfo['price_c1_id'];
						$productInfo['scene_id'] = $baseInfo['price_c2_id'];
						$productInfo['channel_id'] = $baseInfo['price_c3_id'];
						$productInfo['label'] = isset($_PRICE_IDS[$baseInfo['price_c1_id']]['children'][$baseInfo['price_c2_id']]['children'][$baseInfo['price_c3_id']]['name'])
												? $_PRICE_IDS[$baseInfo['price_c1_id']]['children'][$baseInfo['price_c2_id']]['children'][$baseInfo['price_c3_id']]['name'] : '';
						if($baseInfo['price_c3_id']) {
							if(strpos($p['url'], '?') !== false) {
								$p['url'] .= "&chid={$baseInfo['price_c3_id']}";
							} else {
								$p['url'] .= "?chid={$baseInfo['price_c3_id']}";
							}
						}
						$productInfo['item_url'] = $p['url'];
						$prodImgs = self::getProductImgs($productInfo['product_char_id']);
						$productInfo = array_merge($productInfo, $prodImgs);
						
						if(count($baseInfo['sites']) > 1) {
							foreach ($baseInfo['sites'] as $site_id) {
								$productInfo['stock_all'][$site_id] = self::getStockRest($allSitePrices[$site_id][$p['product_id']], $baseInfo['price_c1_id'], $baseInfo['price_c2_id']);
								$productInfo['show_price_all'][$site_id] = self::getPrice($allSitePrices[$site_id][$p['product_id']], PRICE_TYPE_ICSON, ID_TYPE_ICSON_ALL);
								$productInfo['market_price_all'][$site_id] = $productInfo['market_price'];
								$productInfo['m_price_all'][$site_id] = self::getPrice($allSitePrices[$site_id][$p['product_id']], $baseInfo['price_c1_id'], $baseInfo['price_c2_id']);
								$productInfo['item_url_all'][$site_id] = $p['url'];
							}
						}
						
						$prodInfo[] = $productInfo;
					}
				}
			}
		}
		return $prodInfo;
	}
	
	// 为手机接口特殊处理
	public static function getSpecialProductBlock2($eventId, $baseInfo) {
		global $_PRICE_IDS;
		$prodInfo = array();
		$DB = Config::getDB('icson_admin_event');
		$sql = 'SELECT block_id, pool_id FROM t_block WHERE status=1 AND content_type=2 AND activity_id=' . $eventId;
		$spblock = $DB->getRows($sql);
		if ($spblock === false) {
			self::$errCode = $DB->errCode;
			self::$errMsg = $DB->errMsg;
			return $prodInfo;
		} else if (empty($spblock)) {
			return $prodInfo;
		} else {
			if(empty($spblock[0]['pool_id'])) {
				$prodIds = self::getProductIdsByBlockId($spblock[0]['block_id']);
			} else {
				$prodIds = array();
				$products = IContentPool::getProductByPool($spblock[0]['pool_id']);
				if($products === false) {
					Logger::err(IContentPool::$errCode . ' : ' . IContentPool::$errMsg);
					$products = array();
				}
				foreach ($products as $p) {
					$prodIds[] = $p['product_id'];
				}
			}
			
			if (!empty($prodIds)) {
				$productInfos = IProduct::getProductsInfo($prodIds, $baseInfo['where_id'], true);
				
				foreach ($prodIds as $prodId) {
					if (isset($productInfos[$prodId]) && !empty($productInfos[$prodId])) {
						$productInfo = $productInfos[$prodId];
						$mutiPrice = self::getMutiPriceOnly($productInfo['product_id'], $baseInfo);
						$productInfo['source_id'] = $baseInfo['price_c1_id'];
						$productInfo['scene_id'] = $baseInfo['price_c2_id'];
						$productInfo['channel_id'] = $baseInfo['price_c3_id'];
						$productInfo['label'] = isset($_PRICE_IDS[$baseInfo['price_c1_id']]['children'][$baseInfo['price_c2_id']]['children'][$baseInfo['price_c3_id']]['name'])
											? $_PRICE_IDS[$baseInfo['price_c1_id']]['children'][$baseInfo['price_c2_id']]['children'][$baseInfo['price_c3_id']]['name'] : '';
						$productInfo['price_id'] = $mutiPrice['price_id'];
						$productInfo['m_price'] = $mutiPrice['m_price'];
						$productInfo['item_url'] = 'http://item.51buy.com/item-' . $productInfo['product_id'] . '.html';
						$productInfo['item_url'] .= !empty($mutiPrice['price_id']) ? '?event_id=' . $baseInfo['activity_id'] . '&price_id=' . $mutiPrice['price_id'] : '';
						if($baseInfo['price_c3_id']) {
							if(strpos($productInfo['item_url'], '?') !== false) {
								$productInfo['item_url'] .= "&chid={$baseInfo['price_c3_id']}";
							} else {
								$productInfo['item_url'] .= "?chid={$baseInfo['price_c3_id']}";
							}
						}
						$prodImgs = self::getProductImgs($productInfo['product_char_id']);
						$productInfo = array_merge($productInfo, $prodImgs);
						if (self::$isAllSite) {
							$allSitePrices = self::getAllSitePrices($productInfo['product_id'], $baseInfo);
							$productInfo = array_merge($productInfo, $allSitePrices);
						}
						$prodInfo[] = $productInfo;
					}		
				}
				
				/*if ($productInfos !== false) {
					foreach ($productInfos as $productInfo) {
						$mutiPrice = self::getMutiPriceOnly($productInfo['product_id'], $baseInfo);
						$productInfo['m_price'] = $mutiPrice['m_price'];
						$productInfo['item_url'] = 'http://item.51buy.com/item-' . $productInfo['product_id'] . '.html';
						$productInfo['item_url'] .= !empty($mutiPrice['price_id']) ? '?event_id=' . $baseInfo['activity_id'] . '&price_id=' . $mutiPrice['price_id'] : '';
						$prodImgs = self::getProductImgs($productInfo['product_char_id']);
						$productInfo = array_merge($productInfo, $prodImgs);
						if (self::$isAllSite) {
							$allSitePrices = self::getAllSitePrices($productInfo['product_id'], $baseInfo);
							$productInfo = array_merge($productInfo, $allSitePrices);
						}
						$prodInfo[] = $productInfo;
					}
				}*/
			}
		}
		return $prodInfo;
	}
	
	
	public static function getProductBlock($eventId, $baseInfo) {
		global $_PRICE_IDS;
		$prodInfo = array();
		$DB = Config::getDB('icson_admin_event');
		$sql = 'SELECT * FROM t_block WHERE status=1 AND content_type=0 AND activity_id=' . $eventId;
		$pblock = $DB->getRows($sql);
		if ($pblock === false) {
			self::$errCode = $DB->errCode;
			self::$errMsg = $DB->errMsg;
			return $prodInfo;
		} else {
			foreach ($pblock as $pblockInfo) {
				$pblockInfo['params'] = ToolUtil::gbJsonDecode($pblockInfo['params']);
				$subProdInfo = array();
				$subProdInfo['title'] = $pblockInfo['block_title'];
				$subProdInfo['link'] = $pblockInfo['block_description'];
				$subProdInfo['size'] = $pblockInfo['content_num'];
				$subProdInfo['list'] = array();
				
				if(!empty($pblockInfo['params']['price_switch'])) {
					$source_id = $pblockInfo['params']['price_c1_id'];
					$scene_id = $pblockInfo['params']['price_c2_id'];
					$channel_id = $pblockInfo['params']['price_c3_id'];
					$price_time = empty($pblockInfo['params']['price_time']) ? 0 : strtotime($pblockInfo['params']['price_time']);
				} else {
					$source_id = $baseInfo['price_c1_id'];
					$scene_id = $baseInfo['price_c2_id'];
					$channel_id = $baseInfo['price_c3_id'];
					$price_time = empty($baseInfo['params']['price_time']) ? 0 : strtotime($baseInfo['params']['price_time']);
				}

				$subProdInfo['source_id'] = $source_id;
				$subProdInfo['scene_id'] = $scene_id;
				$subProdInfo['channel_id'] = $channel_id;
				$subProdInfo['price_time'] = $price_time;
				
				if(empty($pblockInfo['pool_id'])) {
					$prodIds = self::getProductIdsByBlockId($pblockInfo['block_id']);
					if (!empty($prodIds)) {
						$price_params = array();
						foreach ($prodIds as $pid) {
							$price_params[] = array(
								'product_id' => $pid,
								'price_time' => $price_time
							);
						}
						$productInfos = IProduct::getProductsInfo($prodIds, $baseInfo['where_id'], true);
						//$productPrice = IProductPrice::getAllPrice($baseInfo['where_id'], $prodIds);
						$productPrice = self::getAllPrice($baseInfo['where_id'], $price_params);
						
						if(count($baseInfo['sites']) > 1) {
							$allSitePrices = array();
							foreach ($baseInfo['sites'] as $site_id) {
								//$allSitePrices[$k] = IProductPrice::getAllPrice($k, $prodIds);
								$allSitePrices[$site_id] = self::getAllPrice($site_id, $price_params);
							}
						}
						
						foreach ($prodIds as $prodId) {
							if (isset($productInfos[$prodId]) && !empty($productInfos[$prodId])) {
								$productInfo = $productInfos[$prodId];
								
								//$mutiPrice = self::getMutiPriceOnly($productInfo['product_id'], $baseInfo);
								$productInfo['source_id'] = $source_id;
								$productInfo['scene_id'] = $scene_id;
								$productInfo['channel_id'] = $channel_id;
								$productInfo['label'] = isset($_PRICE_IDS[$source_id]['children'][$scene_id]['children'][$channel_id]['name'])
											? $_PRICE_IDS[$source_id]['children'][$scene_id]['children'][$channel_id]['name'] : '';
								$productInfo['price_id'] = 0;//$mutiPrice['price_id'];
								$productInfo['m_price'] = self::getPrice($productPrice[$prodId], $source_id, $scene_id);
								$productInfo['item_url'] = 'http://item.51buy.com/item-' . $productInfo['product_id'] . '.html';
								//$productInfo['item_url'] .= !empty($mutiPrice['price_id']) ? '?event_id=' . $baseInfo['activity_id'] . '&price_id=' . $mutiPrice['price_id'] : '';
								if($channel_id) {
									if(strpos($productInfo['item_url'], '?') !== false) {
										$productInfo['item_url'] .= "&chid={$channel_id}";
									} else {
										$productInfo['item_url'] .= "?chid={$channel_id}";
									}
								}
								$prodImgs = self::getProductImgs($productInfo['product_char_id']);
								$productInfo = array_merge($productInfo, $prodImgs);
								if (count($baseInfo['sites']) > 1) {
									foreach ($baseInfo['sites'] as $site_id) {
										$productInfo['stock_all'][$site_id] = self::getStockRest($allSitePrices[$site_id][$prodId], $source_id, $scene_id);
										$productInfo['show_price_all'][$site_id] = self::getPrice($allSitePrices[$site_id][$prodId], PRICE_TYPE_ICSON, ID_TYPE_ICSON_ALL);
										$productInfo['market_price_all'][$site_id] = $productInfo['market_price'];
										$productInfo['m_price_all'][$site_id] = self::getStockRest($allSitePrices[$site_id][$prodId], $source_id, $scene_id);
										$productInfo['item_url_all'][$site_id] = $productInfo['item_url'];
									}
								}
								$subProdInfo['list'][] = $productInfo;
							}
						}
						
						if (count($baseInfo['sites']) <= 1 && count($subProdInfo['list'])) {
							foreach ($subProdInfo['list'] as $k => $v) {
								$stockNum = $v['virtual_num'] + $v['num_available'];
								if ($v['m_price'] > $v['show_price']/* || $stockNum <= 0*/) {
									unset($subProdInfo['list'][$k]);
									$v['m_price'] = $v['show_price'];
									$v['item_url'] = preg_replace("/&?price_id=\d+/", '', $v['item_url']);
									array_push($subProdInfo['list'], $v);
								}
							}
							$subProdInfo['list'] = array_values($subProdInfo['list']);
						}
						
						/*
						foreach ($productInfos as $productInfo) {
							$mutiPrice = self::getMutiPriceOnly($productInfo['product_id'], $baseInfo);
							$productInfo['m_price'] = $mutiPrice['m_price'];
							$productInfo['item_url'] = 'http://item.51buy.com/item-' . $productInfo['product_id'] . '.html';
							$productInfo['item_url'] .= !empty($mutiPrice['price_id']) ? '?event_id=' . $baseInfo['activity_id'] . '&price_id=' . $mutiPrice['price_id'] : '';
							$prodImgs = self::getProductImgs($productInfo['product_char_id']);
							$productInfo = array_merge($productInfo, $prodImgs);
							if (self::$isAllSite) {
								$allSitePrices = self::getAllSitePrices($productInfo['product_id'], $baseInfo);
								$productInfo = array_merge($productInfo, $allSitePrices);
							}
							$subProdInfo['list'][] = $productInfo;
						}*/
					}
				} else {
					$products = IContentPool::getProductByPool($pblockInfo['pool_id']);
					if($products === false) {
						Logger::err(IContentPool::$errCode . ' : ' . IContentPool::$errMsg);
						$products = array();
					}
					
					$product_ids = array();
					$price_params = array();
					foreach($products as $p) {
						$product_ids[] = $p['product_id'];
						$price_params[] = array(
							'product_id' => $p['product_id'],
							'price_time' => $price_time
						);
					}
					$product_infos = IProduct::getProductsInfo($product_ids, $baseInfo['where_id'], true);
					//$productPrice = IProductPrice::getAllPrice($baseInfo['where_id'], $product_ids);
					$productPrice = self::getAllPrice($baseInfo['where_id'], $price_params);
					
					if(count($baseInfo['sites']) > 1) {
						$allSitePrices = array();
						foreach ($baseInfo['sites'] as $site_id) {
							//$allSitePrices[$k] = IProductPrice::getAllPrice($k, $product_ids);
							$allSitePrices[$site_id] = self::getAllPrice($site_id, $price_params);
						}
					}
					
					foreach ($products as $p) {
						if(!empty($product_infos[$p['product_id']])) {
							$productInfo = $product_infos[$p['product_id']];
							$productInfo['c3_ids'] = $p['category_id'];
							$productInfo['onshelf_time'] = $p['on_market_date'];
							$productInfo['promotion_word'] = $p['promote_text'];
							$productInfo['market_price'] = $p['market_price'];
							$productInfo['price'] = self::getPrice($productPrice[$p['product_id']], PRICE_TYPE_ICSON, ID_TYPE_ICSON_ALL);//$p['multiprices'][$baseInfo['where_id']]['price'];
							$productInfo['show_price'] = self::getPrice($productPrice[$p['product_id']], PRICE_TYPE_ICSON, ID_TYPE_ICSON_ALL);
							/*if($baseInfo['price_c1_id'] == PRICE_TYPE_ICSON || !isset($p['multiprices'][$baseInfo['where_id']]["{$baseInfo['price_c1_id']}:{$baseInfo['price_c2_id']}"])) {
								$productInfo['m_price'] = $p['multiprices'][$baseInfo['where_id']]['price'];
							} else {
								$productInfo['m_price'] = $p['multiprices'][$baseInfo['where_id']]["{$baseInfo['price_c1_id']}:{$baseInfo['price_c2_id']}"]['mPrice'];
							}*/
							$productInfo['m_price'] = self::getPrice($productPrice[$p['product_id']], $source_id, $scene_id);
							$productInfo['price_id'] = 0;//$baseInfo['mutipriceid'];
							$productInfo['source_id'] = $source_id;
							$productInfo['scene_id'] = $scene_id;
							$productInfo['channel_id'] = $channel_id;
							$productInfo['label'] = isset($_PRICE_IDS[$source_id]['children'][$scene_id]['children'][$channel_id]['name'])
										? $_PRICE_IDS[$source_id]['children'][$scene_id]['children'][$channel_id]['name'] : '';
							if($channel_id) {
								if(strpos($p['url'], '?') !== false) {
									$p['url'] .= "&chid={$channel_id}";
								} else {
									$p['url'] .= "?chid={$channel_id}";
								}
							}
							$productInfo['item_url'] = $p['url'];
							$prodImgs = self::getProductImgs($productInfo['product_char_id']);
							$productInfo = array_merge($productInfo, $prodImgs);
							
							if(count($baseInfo['sites']) > 1) {
								foreach ($baseInfo['sites'] as $site_id) {
									$productInfo['stock_all'][$site_id] = self::getStockRest($allSitePrices[$site_id][$p['product_id']], $source_id, $scene_id);
									$productInfo['show_price_all'][$site_id] = self::getPrice($allSitePrices[$site_id][$p['product_id']], PRICE_TYPE_ICSON, ID_TYPE_ICSON_ALL);
									$productInfo['market_price_all'][$site_id] = $productInfo['market_price'];
									$productInfo['m_price_all'][$site_id] = self::getPrice($allSitePrices[$site_id][$p['product_id']], $source_id, $scene_id);
									$productInfo['item_url_all'][$site_id] = $p['url'];
								}
							}
							
							$subProdInfo['list'][] = $productInfo;
						}
					}
					
					if (count($baseInfo['sites']) <= 1 && count($subProdInfo['list'])) {
						foreach ($subProdInfo['list'] as $k => $v) {
							$stockNum = $v['virtual_num'] + $v['num_available'];
							if ($v['m_price'] > $v['show_price']/* || $stockNum <= 0*/) {
								unset($subProdInfo['list'][$k]);
								$v['m_price'] = $v['show_price'];
								array_push($subProdInfo['list'], $v);
							}
						}
						$subProdInfo['list'] = array_values($subProdInfo['list']);
					}
				}
				$prodInfo[] = $subProdInfo;
			}
		}
		return $prodInfo;
	}
	
	// 为手机接口特殊处理
	public static function getProductBlock2($eventId, $baseInfo) {
		global $_PRICE_IDS;
		$prodInfo = array();
		$DB = Config::getDB('icson_admin_event');
		$sql = 'SELECT * FROM t_block WHERE status=1 AND content_type=0 AND activity_id=' . $eventId;
		$pblock = $DB->getRows($sql);
		if ($pblock === false) {
			self::$errCode = $DB->errCode;
			self::$errMsg = $DB->errMsg;
			return $prodInfo;
		} else {
			foreach ($pblock as $pblockInfo) {
				$subProdInfo = array();
				$subProdInfo['title'] = $pblockInfo['block_title'];
				$subProdInfo['link'] = $pblockInfo['block_description'];
				$subProdInfo['size'] = $pblockInfo['content_num'];
				$subProdInfo['list'] = array();
				if(empty($pblockInfo['pool_id'])) {
					$prodIds = self::getProductIdsByBlockId($pblockInfo['block_id']);
				} else {
					$prodIds = array();
					$products = IContentPool::getProductByPool($pblockInfo['pool_id']);
					if($products === false) {
						Logger::err(IContentPool::$errCode . ' : ' . IContentPool::$errMsg);
						$products = array();
					}
					foreach ($products as $p) {
						$prodIds[] = $p['product_id'];
					}
				}
				
				if (!empty($prodIds)) {
					$productInfos = IProduct::getProductsInfo($prodIds, $baseInfo['where_id'], true);
					foreach ($prodIds as $prodId) {
						if (isset($productInfos[$prodId]) && !empty($productInfos[$prodId])) {
							$productInfo = $productInfos[$prodId];
							
							$mutiPrice = self::getMutiPriceOnly($productInfo['product_id'], $baseInfo);
							$productInfo['source_id'] = $baseInfo['price_c1_id'];
							$productInfo['scene_id'] = $baseInfo['price_c2_id'];
							$productInfo['channel_id'] = $baseInfo['price_c3_id'];
							$productInfo['label'] = isset($_PRICE_IDS[$baseInfo['price_c1_id']]['children'][$baseInfo['price_c2_id']]['children'][$baseInfo['price_c3_id']]['name'])
										? $_PRICE_IDS[$baseInfo['price_c1_id']]['children'][$baseInfo['price_c2_id']]['children'][$baseInfo['price_c3_id']]['name'] : '';
							$productInfo['price_id'] = $mutiPrice['price_id'];
							$productInfo['m_price'] = $mutiPrice['m_price'];
							$productInfo['item_url'] = 'http://item.51buy.com/item-' . $productInfo['product_id'] . '.html';
							$productInfo['item_url'] .= !empty($mutiPrice['price_id']) ? '?event_id=' . $baseInfo['activity_id'] . '&price_id=' . $mutiPrice['price_id'] : '';
							if($baseInfo['price_c3_id']) {
								if(strpos($productInfo['item_url'], '?') !== false) {
									$productInfo['item_url'] .= "&chid={$baseInfo['price_c3_id']}";
								} else {
									$productInfo['item_url'] .= "?chid={$baseInfo['price_c3_id']}";
								}
							}
							$prodImgs = self::getProductImgs($productInfo['product_char_id']);
							$productInfo = array_merge($productInfo, $prodImgs);
							if (self::$isAllSite) {
								$allSitePrices = self::getAllSitePrices($productInfo['product_id'], $baseInfo);
								$productInfo = array_merge($productInfo, $allSitePrices);
							}
							$subProdInfo['list'][] = $productInfo;
						}
					}
					
					if (isset($baseInfo['where_id']) && !empty($baseInfo['where_id']) && count($subProdInfo['list'])) {
						foreach ($subProdInfo['list'] as $k => $v) {
							$stockNum = $v['virtual_num'] + $v['num_available'];
							if ($v['m_price'] > $v['show_price']/* || $stockNum <= 0*/) {
								unset($subProdInfo['list'][$k]);
								$v['m_price'] = $v['show_price'];
								$v['item_url'] = preg_replace("/&?price_id=\d+/", '', $v['item_url']);
								array_push($subProdInfo['list'], $v);
							}
						}
						$subProdInfo['list'] = array_values($subProdInfo['list']);
					}
					
					/*
					foreach ($productInfos as $productInfo) {
						$mutiPrice = self::getMutiPriceOnly($productInfo['product_id'], $baseInfo);
						$productInfo['m_price'] = $mutiPrice['m_price'];
						$productInfo['item_url'] = 'http://item.51buy.com/item-' . $productInfo['product_id'] . '.html';
						$productInfo['item_url'] .= !empty($mutiPrice['price_id']) ? '?event_id=' . $baseInfo['activity_id'] . '&price_id=' . $mutiPrice['price_id'] : '';
						$prodImgs = self::getProductImgs($productInfo['product_char_id']);
						$productInfo = array_merge($productInfo, $prodImgs);
						if (self::$isAllSite) {
							$allSitePrices = self::getAllSitePrices($productInfo['product_id'], $baseInfo);
							$productInfo = array_merge($productInfo, $allSitePrices);
						}
						$subProdInfo['list'][] = $productInfo;
					}*/
				}
				
				$prodInfo[] = $subProdInfo;
			}
		}
		return $prodInfo;
	}
	
	
	public static function getAllSitePrices($productId, $baseInfo) {
		$allPrices = array();
		foreach (self::$darkNightIds as $key => $val) {
			$prodInfo = IProduct::getProductsInfo(array($productId), $key);
			$allPrices['stock_all'][$key] = isset($prodInfo[$productId]['stock']) ? $prodInfo[$productId]['stock'] : '';
			$allPrices['show_price_all'][$key] = isset($prodInfo[$productId]['show_price']) ? $prodInfo[$productId]['show_price'] : 0;
			$allPrices['market_price_all'][$key] = isset($prodInfo[$productId]['market_price']) ? $prodInfo[$productId]['market_price'] : 0;
			//$allPrices['price_all'][$key] = isset($prodInfo[$productId]['price']) ? $prodInfo[$productId]['price'] : 0;
			$baseInfo['where_id'] = $key;
			$mutiPrice = self::getMutiPriceOnly($productId, $baseInfo);
			$allPrices['m_price_all'][$key] = $mutiPrice['m_price'];
			$itemUrl = 'http://item.51buy.com/item-' . $productId . '.html';
			$itemUrl .= !empty($mutiPrice['price_id']) && !empty($mutiPrice['m_price']) ? '?event_id=' . $baseInfo['activity_id'] . '&price_id=' . $mutiPrice['price_id'] : '';
			$allPrices['item_url_all'][$key] = $itemUrl;
		}
		return $allPrices;
	}
	
	
	public static function getProductImgs($productCharId) {
		$productImgs = array();
		$productImgs['pic800'] = IProduct::getPic($productCharId, 'bpic');//bpic图片地址
		$productImgs['picm800'] = IProduct::getPic($productCharId, 'mpic');//mpic图片地址
		$productImgs['pic300'] = IProduct::getPic($productCharId, 'mm');//mm图片地址
		$productImgs['pic120'] = IProduct::getPic($productCharId, 'middle');//middle图片地址
		$productImgs['pic80'] = IProduct::getPic($productCharId, 'small');//small图片地址
		$productImgs['pic50'] = IProduct::getPic($productCharId, 'ss');//ss图片地址
		$productImgs['pic200'] = IProduct::getPic($productCharId, 'pic200');//pic200图片地址
		$productImgs['pic160'] = IProduct::getPic($productCharId, 'pic160');//pic160图片地址
		$productImgs['pic60'] = IProduct::getPic($productCharId, 'pic60');//pic60图片地址
		return $productImgs;
	}
	
	
	public static function getAdBlock($eventId) {
		$adInfo = array();
		$DB = Config::getDB('icson_admin_event');
		$sql = 'SELECT block_id FROM t_block WHERE status=1 AND content_type=1 AND activity_id=' . $eventId;
		$adblock = $DB->getRows($sql);
		if ($adblock === false) {
			self::$errCode = $DB->errCode;
			self::$errMsg = $DB->errMsg;
			return $adInfo;
		} else if (empty($adblock)) {
			return $adInfo;
		} else {
			$adInfo = self::getPicTextByBlockId($adblock[0]['block_id']);
		}
		return $adInfo;
	}
	
	
	public static function getPicTextByBlockId($blockId) {
		$picTextInfo = array();
		$DB = Config::getDB('icson_admin_event');
		$sql = 'SELECT * FROM t_picture_text WHERE block_id=' . $blockId . ' ORDER BY order_id ASC';
		$picTexts = $DB->getRows($sql);
		if ($picTexts === false) {
			self::$errCode = $DB->errCode;
			self::$errMsg = $DB->errMsg;
			return $picTextInfo;
		} else if (empty($picTexts)) {
			return $picTextInfo;
		} else {
			foreach ($picTexts as $picText) {
				$subPicText = array();
				$subPicText['desc'] = $picText['description'];
				$subPicText['url'] = $picText['url'];
				$subPicText['picUrl'] = $picText['pic_url'];
				$picTextInfo[] = $subPicText;
			}
		}
		return $picTextInfo;
	}
	
	
	public static function getEventInfo($eventId) {
		$out = array();
		if (!$eventId) {
			self::$errCode = 10001;
			self::$errMsg = '活动ID不能为空';
			return false;
		}
		
		$event = self::getEventById($eventId);
		if ($event === false) {
			return false;
		} else if (empty($event)) {
			self::$errCode = 10002;
			self::$errMsg = '此活动不存在';
			return false;
		} else {
			if ($event['site_type'] == 2) {
				self::$errCode = 10004;
				self::$errMsg = '此活动为网购侧活动';
				return false;
			}
			if ($event['where_id'] == 0) {
				self::$isAllSite = 1;
			}

			$area = self::getAreaById($event['area_id']);
			if($area === false) {
				return false;
			}

			$now = date('Y-m-d H:i:s');
			if ($event['state'] == 2 || $event['end_time'] <= $now) {
				self::$errCode = 10005;
				self::$errMsg = '此活动已结束';
				return false;
			} else {	
				$out['name']= $event['name'];
				$out['siteId'] = $area['default_site'];
				$out['date']['start'] = $event['start_time'];
				$out['date']['end'] = $event['end_time'];
				$out['desc'] = $event['content'];
				
				$eventId = $event['activity_type'] && $event['used_id'] ? $event['used_id'] : $eventId;
				if($event['used_id']) {
					$sub_act_info = self::getEventById($event['used_id']);
					$event['params'] = $sub_act_info['params'];
				}

				$out['source_id'] = $event['price_c1_id'];
				$out['scene_id'] = $event['price_c2_id'];
				$out['channel_id'] = $event['price_c3_id'];
				$out['price_time'] = empty($event['params']['price_time']) ? 0 : $event['params']['price_time'];
				$out['act_type'] = $event['act_type'];
				
				$baseInfo = array(
					'activity_id' => $event['activity_id'],
					'mutipriceid' => $event['mutipriceid'],
					'price_c1_id' => $event['price_c1_id'],
					'price_c2_id' => $event['price_c2_id'],
					'price_c3_id' => $event['price_c3_id'],
					'used_id' => $eventId,
					'where_id' => $area['default_site'],
					'params' => $event['params'],
					'sites' => $area['sites']
				);
				
				try {
					$out['spblock'] = self::getSpecialProductBlock($eventId, $baseInfo);
					$out['pblock'] = self::getProductBlock($eventId, $baseInfo);
					$out['adblock'] = self::getAdBlock($eventId);
				} catch(BaseException $e) {
					self::$errCode = $e->errCode;
					self::$errMsg = $e->errMsg;
					return false;
				}
			}
		}
			
		return $out;
	}
	
	public static function getEventInfo_old($eventId) {
		$out = array();
		if (!$eventId) {
			self::$errCode = 10001;
			self::$errMsg = '活动ID不能为空';
			return false;
		}
		
		$event = self::getEventById($eventId);
		if ($event === false) {
			return false;
		} else if (empty($event)) {
			self::$errCode = 10002;
			self::$errMsg = '此活动不存在';
			return false;
		} else {
			if ($event['site_type'] == 2) {
				self::$errCode = 10004;
				self::$errMsg = '此活动为网购侧活动';
				return false;
			}
			if ($event['where_id'] == 0) {
				self::$isAllSite = 1;
			}
			$now = date('Y-m-d H:i:s');
			if ($event['state'] == 2 || $event['end_time'] <= $now) {
				self::$errCode = 10005;
				self::$errMsg = '此活动已结束';
				return false;
			} else {	
				$out['name']= $event['name'];
				$out['siteId'] = $event['where_id'];
				$out['date']['start'] = $event['start_time'];
				$out['date']['end'] = $event['end_time'];
				$out['desc'] = $event['content'];
				
				$eventId = $event['activity_type'] && $event['used_id'] ? $event['used_id'] : $eventId;
				$whereId = !$event['where_id'] ? 1 : $event['where_id'];
				
				$baseInfo = array(
					'activity_id' => $event['activity_id'],
					'mutipriceid' => $event['mutipriceid'],
					'price_c1_id' => $event['price_c1_id'],
					'price_c2_id' => $event['price_c2_id'],
					'price_c3_id' => $event['price_c3_id'],
					'used_id' => $eventId,
					'where_id' => $whereId
				);
				
				$out['spblock'] = self::getSpecialProductBlock2($eventId, $baseInfo);
				$out['pblock'] = self::getProductBlock2($eventId, $baseInfo);
				$out['adblock'] = self::getAdBlock($eventId);
			}
		}
			
		return $out;
	}
	
	
	public static function getProductMutiPrice($aid, $pid) {
		$DB = Config::getDB('icson_admin_event');
		$sql = "SELECT * FROM t_product_mutiprice WHERE active_id = $aid AND product_id = $pid";
		$rs = $DB->getRows($sql);
		return $rs;
	}
	
	
	public static function getMutiPriceOnly($productId, $baseInfo) {
		$mPrice = 0;
		$mutiPriceId = $baseInfo['mutipriceid'];
		$mutiPriceIds = self::getProductMutiPrice($baseInfo['used_id'], $productId);
		if (isset($mutiPriceIds[0]['mutipriceid'])) {
			$mutiPriceId = $mutiPriceIds[0]['mutipriceid'];
		}
		
		if ($mutiPriceId > 0) {
			$whId = ($baseInfo['where_id'] > 0 ? $baseInfo['where_id'] : 1);
			$price = IMultiPrice::getPriceOnly($productId, $mutiPriceId, $whId);
			if (!empty($price['price'])) {
				$mPrice = $price['price'];
			}
		}
		return array('m_price' => $mPrice, 'price_id' => $mutiPriceId);
	}
	
	
	public static function getDarkNightInfo( $siteId ) {
		$envName = Config::getEnvName();
		$envName = !empty($envName) ? substr($envName, 0, -1) : 'online';
		$envName = $envName == 'beta' ? 'online' : $envName;
		if( !isset( self::$darkNightIds[ $siteId ][$envName] ) ){
			self::$errCode = 10006;
			self::$errMsg = "siteId: $siteId is not found.";
			return false;
		}

		return self::getEventInfo( self::$darkNightIds[ $siteId ][$envName] );
		
	}

	public static function getMorningInfo($siteId) {
		$envName = Config::getEnvName();
		$envName = !empty($envName) ? substr($envName, 0, -1) : 'online';
		$envName = $envName == 'beta' ? 'online' : $envName;
		if( !isset( self::$morningIds[$siteId][$envName] ) ){
			self::$errCode = 10006;
			self::$errMsg = "siteId: $siteId is not found.";
			return false;
		}

		return self::getEventInfo( self::$morningIds[ $siteId ][$envName] );
	}
	
	public static function getDarkNightInfo_old( $siteId ) {
		$envName = Config::getEnvName();
		$envName = !empty($envName) ? substr($envName, 0, -1) : 'online';
		$envName = $envName == 'beta' ? 'online' : $envName;
		if( !isset( self::$darkNightIds[ $siteId ][$envName] ) ){
			self::$errCode = 10006;
			self::$errMsg = "siteId: $siteId is not found.";
			return false;
		}

		return self::getEventInfo_old( self::$darkNightIds[ $siteId ][$envName] );
		
	}

	public static function getMorningInfo_old($siteId) {
		$envName = Config::getEnvName();
		$envName = !empty($envName) ? substr($envName, 0, -1) : 'online';
		$envName = $envName == 'beta' ? 'online' : $envName;
		if( !isset( self::$morningIds[$siteId][$envName] ) ){
			self::$errCode = 10006;
			self::$errMsg = "siteId: $siteId is not found.";
			return false;
		}

		return self::getEventInfo_old( self::$morningIds[ $siteId ][$envName] );
	}

	public static function getMorningInfo_new($siteId) {
		global $_WEBSITE_CFG;
		
		if(!isset($_WEBSITE_CFG[$siteId])){
			self::$errCode = 10006;
			self::$errMsg = "siteId: $siteId is not found.";
			return false;
		}
		
		$out = array();
		$out['name'] = '早市频道-' . $_WEBSITE_CFG[$siteId]['label'] . '站';
		$out['siteId'] = $siteId;
		$out['date']['start'] = 0;
		$out['date']['end'] = 0;
		$out['desc'] = $out['name'];
		
		$baseInfo = array(
			'activity_id' => 0,
			'mutipriceid' => 1,
			'price_c1_id' => PRICE_TYPE_CHANNEL,
			'price_c2_id' => ID_TYPE_CHANNEL_ALL,
			'price_c3_id' => CHANNEL_TYPE_MORNING_MARKET,
			'used_id' => 0,
			'where_id' => $siteId,
			'params' => NULL
		);
		
		$out['spblock'] = array();
		$typeId = IThh::ZS_TYPE_ID;
		$out['pblock'] = self::getZsthhProductBlock($siteId, $typeId, $baseInfo);
		$out['adblock'] = self::getZsthhAdBlock($siteId);
		
		return $out;
	}
	
	public static function getDarkNightInfo_new( $siteId ) {
		global $_WEBSITE_CFG;
		
		if(!isset($_WEBSITE_CFG[$siteId])){
			self::$errCode = 10006;
			self::$errMsg = "siteId: $siteId is not found.";
			return false;
		}
		
		$out = array();
		$out['name'] = '天黑黑频道-' . $_WEBSITE_CFG[$siteId]['label'] . '站';
		$out['siteId'] = $siteId;
		$out['date']['start'] = 0;
		$out['date']['end'] = 0;
		$out['desc'] = $out['name'];
		
		$baseInfo = array(
			'activity_id' => 0,
			'mutipriceid' => 1,
			'price_c1_id' => PRICE_TYPE_CHANNEL,
			'price_c2_id' => ID_TYPE_CHANNEL_ALL,
			'price_c3_id' => CHANNEL_TYPE_NIGHT_MARKET,
			'used_id' => 0,
			'where_id' => $siteId,
			'params' => NULL
		);
		
		$out['spblock'] = array();
		$typeId = IThh::THH_TYPE_ID;
		$out['pblock'] = self::getZsthhProductBlock($siteId, $typeId, $baseInfo);
		$out['adblock'] = self::getZsthhAdBlock($siteId);
		
		return $out;
	}
	
	public static function getEventInfoForAdmin($eventId) {
		$out = array();
		if (!$eventId) {
			self::$errCode = 10001;
			self::$errMsg = '活动ID不能为空';
			return false;
		}
		
		$event = self::getEventById($eventId);
		if ($event === false) {
			return false;
		} else if (empty($event)) {
			self::$errCode = 10002;
			self::$errMsg = '此活动不存在';
			return false;
		} else {
			if ($event['where_id'] == 0) {
				self::$isAllSite = 1;
			}

			$area = self::getAreaById($event['area_id']);
			if($area === false) {
				return false;
			}

			$out['name']= $event['name'];
			$out['siteId'] = $area['default_site'];
			$out['date']['start'] = $event['start_time'];
			$out['date']['end'] = $event['end_time'];
			$out['desc'] = $event['content'];
			
			$now = date('Y-m-d H:i:s');
			if ($event['state'] == 2 || $event['end_time'] <= $now) {//此活动已结束
				$out['spblock'] = array();
				$out['pblock'] = array();
				$out['adblock'] = array();
			} else {	
				$eventId = $event['activity_type'] ? $event['used_id'] : $eventId;
				$whereId = !$event['where_id'] ? 1 : $event['where_id'];
				if($event['used_id']) {
					$sub_act_info = self::getEventById($event['used_id']);
					$event['params'] = $sub_act_info['params'];
				}

				$out['source_id'] = $event['price_c1_id'];
				$out['scene_id'] = $event['price_c2_id'];
				$out['channel_id'] = $event['price_c3_id'];
				$out['price_time'] = empty($event['params']['price_time']) ? 0 : $event['params']['price_time'];
				$out['act_type'] = $event['act_type'];

				$baseInfo = array(
					'activity_id' => $event['activity_id'],
					'mutipriceid' => $event['mutipriceid'],
					'price_c1_id' => $event['price_c1_id'],
					'price_c2_id' => $event['price_c2_id'],
					'price_c3_id' => $event['price_c3_id'],
					'used_id' => $eventId,
					'where_id' => $area['default_site'],
					'params' => $event['params'],
					'sites' => $area['sites']
				);
				
				try {
					$out['spblock'] = self::getSpecialProductBlock($eventId, $baseInfo);
					$out['pblock'] = self::getProductBlock($eventId, $baseInfo);
					$out['adblock'] = self::getAdBlock($eventId);
				} catch(BaseException $e) {
					self::$errCode = $e->errCode;
					self::$errMsg = $e->errMsg;
					return false;
				}
			}
		}
			
		return $out;
	}
	
	public static function getZsthhAdBlock($siteId) {
		$adInfo = array();
		$ads = IThh::getAd($siteId);
		foreach ($ads as $ad) {
			$info = array();
			$info['desc'] = $ad['content'];
			$info['url'] = $ad['url'];
			$info['picUrl'] = $ad['img_wide'];
			
			$adInfo[] = $info;
		}
		return $adInfo;
	}
	
	public static function getZsthhProductBlock($siteId, $typeId, $baseInfo) {
		global $_PRICE_IDS;
		$prodInfo = array();
		$DB = Config::getDB('icson_event');
		$sql = "SELECT * FROM tuan_settings where skey like 'productpool_{$siteId}_{$typeId}_%'";
		$pblock = $DB->getRows($sql);
		if ($pblock === false) {
			self::$errCode = $DB->errCode;
			self::$errMsg = $DB->errMsg;
			return $prodInfo;
		} else {
			foreach ($pblock as $pblockInfo) {
				$skey = $pblockInfo['skey'];
				if (preg_match("/productpool_(\d+)_(\d+)_(\d+)/i", $skey, $matches) == 0) {
					continue;
				}
				$floorId = $matches[3];
				
				$pblockInfo['params'] = NULL;
				$subProdInfo = array();
				$subProdInfo['title'] = IThh::getTitle($typeId, $floorId);
				$subProdInfo['link'] = '';
				$subProdInfo['size'] = 0;
				$subProdInfo['list'] = array();
				
				$source_id = $baseInfo['price_c1_id'];
				$scene_id = $baseInfo['price_c2_id'];
				$channel_id = $baseInfo['price_c3_id'];
				$price_time = IThh::getEventTime($typeId);
				
				$products = IContentPool::getProductByPool($pblockInfo['svalue']);
				if($products === false) {
					Logger::err(IContentPool::$errCode . ' : ' . IContentPool::$errMsg);
					$products = array();
				}
				
				$product_ids = array();
				$price_params = array();
				foreach($products as $p) {
					$product_ids[] = $p['product_id'];
					$price_params[] = array(
						'product_id' => $p['product_id'],
						'price_time' => $price_time
					);
				}
				$product_infos = IProduct::getProductsInfo($product_ids, $baseInfo['where_id'], true);
				$productPrice = self::getAllPrice($baseInfo['where_id'], $price_params);
				
				$useVipPrice = false;
				if ($typeId == IThh::THH_TYPE_ID) {
					if ($floorId == 4 || $floorId == 5) {
						$useVipPrice = true;
					} else {
						$useVipPrice = false;
					}
				} else {
					$useVipPrice = false;
				}
				
				foreach ($products as $p) {
					if(!empty($product_infos[$p['product_id']])) {
						$productInfo = $product_infos[$p['product_id']];
						$productInfo['c3_ids'] = $p['category_id'];
						$productInfo['onshelf_time'] = $p['on_market_date'];
						$productInfo['promotion_word'] = $p['short_promote_text'];
						$productInfo['market_price'] = $p['market_price'];
						if (IThh::getProductPrice($productPrice[$p['product_id']], $productInfo, $useVipPrice) === false) {
							continue;
						}
						//$productInfo['price'] = self::getPrice($productPrice[$p['product_id']], PRICE_TYPE_ICSON, ID_TYPE_ICSON_ALL);//$p['multiprices'][$baseInfo['where_id']]['price'];
						//$productInfo['show_price'] = self::getPrice($productPrice[$p['product_id']], PRICE_TYPE_ICSON, ID_TYPE_ICSON_ALL);
						$productInfo['price'] = $productInfo['pd_show_price'];
						$productInfo['show_price'] = $productInfo['pd_show_price'];

						$productInfo['m_price'] = $productInfo['pd_show_price'];
						$productInfo['price_id'] = 0;//$baseInfo['mutipriceid'];
						$productInfo['source_id'] = $source_id;
						$productInfo['scene_id'] = $scene_id;
						$productInfo['channel_id'] = $channel_id;
						$productInfo['label'] = isset($_PRICE_IDS[$source_id]['children'][$scene_id]['children'][$channel_id]['name'])
									? $_PRICE_IDS[$source_id]['children'][$scene_id]['children'][$channel_id]['name'] : '';
						if($channel_id) {
							if(strpos($p['url'], '?') !== false) {
								$p['url'] .= "&chid={$channel_id}";
							} else {
								$p['url'] .= "?chid={$channel_id}";
							}
						}
						$productInfo['item_url'] = $p['url'];
						$prodImgs = self::getProductImgs($productInfo['product_char_id']);
						$productInfo = array_merge($productInfo, $prodImgs);
						
						$subProdInfo['list'][] = $productInfo;
					}
				}
				
				if (count($subProdInfo['list'])) {
					$orderedProducts = IThh::reorderProduct($typeId, $floorId, $subProdInfo['list']);
					if ($orderedProducts === false) {
						continue;
					}
					for ($i = 0; $i < count($orderedProducts); $i++) {
						unset($orderedProducts[$i]['pd_show_price']);
						unset($orderedProducts[$i]['pd_stock']);
						unset($orderedProducts[$i]['pd_show_price_old']);
					}
					$subProdInfo['list'] = $orderedProducts;
				}
				
				if (isset($baseInfo['where_id']) && !empty($baseInfo['where_id']) && count($subProdInfo['list'])) {
					foreach ($subProdInfo['list'] as $k => $v) {
						$stockNum = $v['virtual_num'] + $v['num_available'];
						if ($v['m_price'] > $v['show_price']/* || $stockNum <= 0*/) {
							unset($subProdInfo['list'][$k]);
							$v['m_price'] = $v['show_price'];
							array_push($subProdInfo['list'], $v);
						}
					}
					$subProdInfo['list'] = array_values($subProdInfo['list']);
				}
				
				$prodInfo[] = $subProdInfo;
			}
		}
		return $prodInfo;
	}
	
	private static function getPrice($prices, $source_id, $scence_id) {
		$spike_price_key = PRICE_TYPE_SPIKE . ':' . ID_TYPE_SPIKE_ALL;
		if(isset($prices[$spike_price_key])) {
			// 抢购商品只有秒杀价和节能补贴价
			return $prices[$spike_price_key]['show_price'];
		} else {
			$promote_price_key = PRICE_TYPE_PROMOTE . ':' . ID_TYPE_PROMOTE_ALL;
			if($source_id != PRICE_TYPE_LADDER && $source_id != PRICE_TYPE_SUBSIDY && isset($prices["{$source_id}:{$scence_id}"])) {
				// 有对应价格而且不为阶梯价
				return $prices["{$source_id}:{$scence_id}"]['show_price'];
			} else if(isset($prices[$promote_price_key])) {
				// 有一般促销价展示一般促销价
				return $prices[$promote_price_key]['show_price'];
			} else {
				// 最后易迅价
				$icson_price_key = PRICE_TYPE_ICSON . ':' . ID_TYPE_ICSON_ALL;
				return $prices[$icson_price_key]['show_price'];
			}
		}
	}
	
	private static function getStockRest($prices, $source_id, $scence_id) {
		$spike_price_key = PRICE_TYPE_SPIKE . ':' . ID_TYPE_SPIKE_ALL;
		if(isset($prices[$spike_price_key])) {
			// 抢购商品只有秒杀价和节能补贴价
			return $prices[$spike_price_key]['stock_limit'] ? $prices[$spike_price_key]['stock_rest'] : '';
		} else {
			$promote_price_key = PRICE_TYPE_PROMOTE . ':' . ID_TYPE_PROMOTE_ALL;
			if($source_id != PRICE_TYPE_LADDER && $source_id != PRICE_TYPE_SUBSIDY && isset($prices["{$source_id}:{$scence_id}"])) {
				// 有对应价格而且不为阶梯价和节能补贴
				return $prices["{$source_id}:{$scence_id}"]['stock_limit'] ? $prices["{$source_id}:{$scence_id}"]['stock_rest'] : '';
			} else if(isset($prices[$promote_price_key])) {
				// 有一般促销价展示一般促销价
				return $prices[$promote_price_key]['stock_limit'] ? $prices[$promote_price_key]['stock_rest'] : '';
			} else {
				// 最后易迅价
				$icson_price_key = PRICE_TYPE_ICSON . ':' . ID_TYPE_ICSON_ALL;
				return $prices[$icson_price_key]['stock_limit'] ? $prices[$icson_price_key]['stock_rest'] : '';
			}
		}
	}

	private static function getAreaById($area_id) {
		try {
			$dao = new IMySQLDAO('icson_admin_event', 't_area_site_map');
			$res = $dao->getRows('', "id = {$area_id}", null, null);
			if(empty($res)) {
				throw new BaseException(ErrorConfig::getErrorCode('area_not_found'), "Failed to get area info with id {$area_id}.");
			}

			$area = $res[0];
			$_MASK_SITE = array(
				0x0001 => SITE_SH,
				0x0002 => SITE_SZ,
				0x0004 => SITE_BJ,
				0x0008 => SITE_WH,
				0x0010 => SITE_CQ,
				0x0020 => SITE_XA
			);
			$sites = array();

			foreach ($_MASK_SITE as $mask => $site_id) {
				if(($area['site'] & $mask) != 0) {
					$sites[] = $site_id;
				}
			}
			$area['sites'] = $sites;

			return $area;
		} catch(BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}

	private static function getAllPrice($site_id, $price_params) {
		$prices = IProductPrice::getAllPriceInTime($site_id, $price_params);
		if($prices === false && IProductPrice::$errCode == ErrorConfig::getErrorCode('net_error')) {
			Logger::warn('Time out to get product price.');
			$prices = IProductPrice::getAllPriceInTime($site_id, $price_params);
		}

		if($prices === false) {
			throw new BaseException(IProductPrice::$errCode, IProductPrice::$errMsg);
		}

		return $prices;
	}
}