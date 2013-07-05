<?php

require_once(PHPLIB_ROOT . 'api/appplatform/platform/web_stub_cntl.php');
require_once(PHPLIB_ROOT . 'api/appplatform/contentdao_stub4php.php');
require_once(PHPLIB_ROOT . 'api/appplatform/icsonbossao_stub4php.php');
require_once(PHPLIB_ROOT . 'api/appplatform/ncadao_stub4php.php');

require_once(PHPLIB_ROOT . 'inc/pricetype.inc.php');

/**
 * 团购接口
 * 
 * @author yakehuang
 * @version 2.0
 */
class ITuans
{
	// 访问ao服务的标识名称
	const TUAN_POOL_API_CALLER = 'tuan_pool_api';
	
	// 告警特性id
	const ALARM_NORMAL = 629976;
	
	// 团购对应的多价规则名称，多价中只有设置为该名称才被认为是团购商品
	const MPRICE_DESC = '团购价';
	
	// 获取品类的场景ID
	const SKU_SCENEID = 10012;
	
	public static $errCode	= 0;
	public static $errMsg	= '';
	
	private static $_PRODUCT_KEY_MAP = array(
		'id' => 'dwId', // ID
		'sysno' => 'strCommodityId', // 商品ID
		'product_name' => 'strTitle', // 商品名称
		'pic_url' => 'strPicUrl', // 商品默认图片
		'pic_url_80' => 'strPicUrl80', // 商品80像素图片
		'sold_num' => 'dwSoldNum', // 已销售数量
		'c3id' => 'strClassId', // 分类ID
		'c3name' => 'strCategoryName', // 分类名称
		'on_market_date' => 'dwOnMarketDate', // 上市时间
		'price' => 'dwPrice', // 商品价格
		'sort_num' => 'dwSortNumber', // 排序编号
		'default_display' => 'dwDefaultDisplay', // 是否是spu下的主显示商品
		'primary_product_id' => 'strPrimaryGoods', // 同spu下的主商品id
		'url' => 'strUrl', // 商品链接
		'market_price' => 'dwMarketPrice', // 市场价格
		'class_name' => 'strClassName', // 前端展示样式名
		'promote_text' => 'strPromoteText', // 商品促销语
		'short_promote_text' => 'strShortPromoteText', // 商品促销简语
		'inventory' => 'dwInventory', // 库存
		'wg_sku_id' => 'strSkuId', // 网购SKU ID
		'wg_spu_id' => 'strSpuId', // 网购SPU ID
		'sale_tag' => 'strTag', // 运营标签，商品打标属性，如热卖、新品
		'rush_begin_time' => 'dwStarttime', // 抢购开始时间
		'rush_end_time' => 'dwEndtime', // 抢购结束时间
		'rush_group_id' => 'strGroupid', // 抢购批次号
		'rush_token' => 'dwToken', // 抢购标记位，是否防刷
		'custorm_data' => 'strCustomData', // 自定义数据
		'state' => 'dwState', // 抢购商品状态，0正常，1下架
		'sale_attr' => 'strSaleAttr', // 销售属性串
		'ext_data' => 'strExtData', // 扩展数据，结构是json字符串
		'score' => 'dwScore', // 商品优质得分
		'multiprices' => 'strAreaStockInfo' // 多价信息
	);
	
	/**
	 * 获得当期团购商品池子中的商品
	 * 
	 * @param int $site_id
	 */
	public static function getCurrentProducts($site_id)
	{
		$products = array();
		
		$pool_id = self::getProductPoolId($site_id);
		if ($pool_id === null) {
			self::$errCode = 101;
			self::$errMsg = "Failed to get pool id with site id $site_id";
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
		
		$content_param = new ContentParam();
		$content_param->dwPoolId = $pool_id;
		$content_param->cPoolId_u = 1;
		
		$req = new GetContentReq();
		$req->contentParam->setValue(array($content_param));
		
		$resp = new GetContentResp();
		
		$cntl = new WebStubCntl();
		$cntl->setCallerName(self::TUAN_POOL_API_CALLER);
		
		$ret = $cntl->invoke($req, $resp);
		
		if ($ret == 0) {
			if ($resp->result == 0) {
				$product_objs = $resp->resultList->getValue();
				if (isset($product_objs[$pool_id])) {
					foreach ($product_objs[$pool_id] as $obj) {
						$product = self::_objToArray($obj, self::$_PRODUCT_KEY_MAP);
						$product['ext_data'] = json_decode('{' . $product['ext_data'] . '}', true);
						$products[] = self::_utf8ToGbk($product);
					}
				}
			} else {
				self::$errCode = 202;
				self::$errMsg = '[' . $resp->result . ']' . $resp->errMsg;
				Logger::err(self::$errCode . ' : ' . self::$errMsg);
				return false;
			}
		} else {
			self::$errCode = 201;
			self::$errMsg = "Net error, failed to get products with pool id $pool_id";
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
		
		return $products;
	}
	
	/**
	 * 获得sku、品类和导航等信息
	 * @param array $icsonIds
	 */
	public static function getSkuByIcsonIds($icsonIds)
	{
		$cntl = new WebStubCntl();
		$machineKey = time();
		$source = __FILE__;
		$pageSize = 20;
		$page = 0;
		
		$skuInfos = array();
		$meta_ids = array();
		do {
			$partIcsonIds = array_slice($icsonIds, $page * $pageSize, $pageSize);
			if (empty($partIcsonIds)) break;
			
			$skuIds = array();
			$req = new BatchGetSkuInfoListByIcsonIdReq();
			$req->machineKey = $machineKey;
			$req->source = $source;
			$req->sceneId = self::SKU_SCENEID;
			$req->icsonId = new stl_set($partIcsonIds);
			$req->cooperatorId = 855006089;
			$resp = new BatchGetSkuInfoListByIcsonIdResp();
			$cntl->setCallerName(self::TUAN_POOL_API_CALLER);
			$ret = $cntl->invoke($req, $resp);
			if ($ret == 0) {
				if ($resp->result == 0) {
					$sku_objs = $resp->conversionSkuBasicPo->getValue();
					foreach ($sku_objs as $icsonId => $sku) {
						$sku_values = $sku->getValue();
						if (!empty($sku_values)) {
							$skuIds[$sku_values[0]->ddwSkuId] = $icsonId;
						}
					}
				} else {
					self::$errCode = 302;
					self::$errMsg = '[' . $resp->result . ']' . $resp->errmsg;
					Logger::err(self::$errCode . ' : ' . self::$errMsg);
					return false;
				}
			} else {
				self::$errCode = 301;
				self::$errMsg = "Failed to get sku convert infos, " . $cntl->getLastErrMsg();
				Logger::err(self::$errCode . ' : ' . self::$errMsg);
				return false;
			}
			
			if (empty($skuIds)) {
				self::$errCode = 303;
				self::$errMsg = "Sku ids null";
				Logger::err(self::$errCode . ' : ' . self::$errMsg);
				return false;
			}
			
			unset($req);
			unset($resp);
			unset($ret);
			
			$req = new BatchGetSkuBySkuIdReq();
			$req->machineKey = $machineKey;
			$req->source = $source;
			$req->sceneId = self::SKU_SCENEID;
			$paramSkuIds = array();
			foreach ($skuIds as $skuId => $icsonId) {
				$paramSkuIds[] = new uint64_t($skuId);
			}
			$req->skuId = new stl_set($paramSkuIds);
			$resp = new BatchGetSkuBySkuIdResp();
			$cntl->setCallerName(self::TUAN_POOL_API_CALLER);
			$ret = $cntl->invoke($req, $resp);
			if ($ret == 0) {
				if ($resp->result == 0) {
					$skuinfo_objs = $resp->skuBasicList->getValue();
					foreach ($skuinfo_objs as $skuinfo) {
						$icsonId = $skuIds[$skuinfo->ddwSkuId];
						$skuInfos[$icsonId] = array(
							'sysno' => $icsonId,
							'sku_id' => $skuinfo->ddwSkuId,
							'meta_id' => $skuinfo->dwCategoryId,
							'metas' => array()
						);
						$meta_ids[] = $skuinfo->dwCategoryId;
					}
				} else {
					self::$errCode = 402;
					self::$errMsg = '[' . $resp->result . ']' . $resp->errmsg;
					Logger::err(self::$errCode . ' : ' . self::$errMsg);
					return false;
				}
			} else {
				self::$errCode = 401;
				self::$errMsg = "Failed to get sku infos, " . $cntl->getLastErrMsg();
				Logger::err(self::$errCode . ' : ' . self::$errMsg);
				return false;
			}
			
			$page++;
		} while (count($partIcsonIds) == $pageSize);
		
		unset($req);
		unset($resp);
		unset($ret);
		unset($cntl);
		
		$apiCtrl = new APIControl();
		// 来源，1:易讯
		$apiCtrl->dwSource = 1;
		// 入参编码类型，1:GBK，2:UTF-8
		$apiCtrl->dwCharset = 2;
		$req = new GetMetas_ALLReq();
		$req->machineKey = $machineKey;
		$req->source = $source;
		$req->APIControl = $apiCtrl;
		$metaIds = array();
		$meta_ids = array_unique($meta_ids);
		foreach ($meta_ids as $id) {
			$metaIds[] = new uint32_t($id);
		}
		$req->MetaId = new stl_set($metaIds);
		$resp = new GetMetas_ALLResp();
		$cntl = new WebStubCntl();
		$cntl->setCallerName(self::TUAN_POOL_API_CALLER);
		$ret = $cntl->invoke($req, $resp);
		if ($ret == 0) {
			if ($resp->result == 0) {
				$meta_objs = $resp->Meta->getValue();
				foreach ($meta_objs as $meta_id => $meta) {
					$metas = array();
					if ($meta->vecMetaSearchPath->getSize() > 0) {
						foreach ($meta->vecMetaSearchPath as $path) {
							$metas[] = $path->dwNavId;
						}
					}
					foreach ($skuInfos as $icsonId => $skuinfo) {
						if ($skuinfo['meta_id'] == $meta_id) {
							$skuInfos[$icsonId]['metas'] = $metas;
						}
					}
				}
			} else {
				self::$errCode = 502;
				self::$errMsg = '[' . $resp->result . ']' . $resp->errmsg;
				Logger::err(self::$errCode . ' : ' . self::$errMsg);
				return false;
			}
		} else {
			self::$errCode = 501;
			self::$errMsg = "Failed to get meta infos, " . $cntl->getLastErrMsg();
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
		
		return $skuInfos;
	}
	
	/**
	 * 获得当期团购商品，过滤一些逻辑并组装数据
	 * 
	 * @param int $whId
	 */
	public static function currentTuan($whId)
	{
		$datas = array();
		
		// 商品池商品
		$products = self::getCurrentProducts($whId);
		if (empty($products)) {
			return $datas;
		}
		
		$pids = array();
		foreach ($products as $product) {
			$pids[] = $product['sysno'];
		}
		
		// 取品类信息
		$skuInfos = self::getSkuByIcsonIds($pids);
		if ($skuInfos === false) {
			$msg = "该站点团购商品获取sku和品类等信息失败，站点id:{$whId} " . self::$errCode . ':' . self::$errMsg;
			Logger::err($msg);
			echo $msg . "\n";
			qp_itil_write(self::ALARM_NORMAL, $msg);
		}
		
		// 取多价信息
		$multprices = IProductPrice::getAllPrice($whId, $pids);
		if ($multprices === false) {
			self::$errCode = IProductPrice::$errCode;
			self::$errMsg = IProductPrice::$errMsg;
			return $datas;
		}
		
		$productInfos = IProduct::getProductsInfo($pids, $whId, true);
		foreach ($products as $product) {
			// 判断是否有多价
			if (isset($multprices[$product['sysno']])) {
				$data					= array();
				$data['sysno']			= $product['sysno'];
				$data['price']			= $product['price'];
				$data['promotion_word']	= $product['promote_text'];
				// 用自定义值当做自定义商品组来使用
				$data['promotion_tag']	= $product['custorm_data'];
				$data['url']			= $product['url'];
				$data['c3id']			= $product['c3id'];
				$result					= ICategoryTTC::get($data['c3id'], array('level' => 3), array('id', 'parent_id'));
				$data['c2id']			= $result[0]['parent_id'];
				$result					= ICategoryTTC::get($data['c2id'], array('level' => 2), array('id', 'parent_id'));
				$data['c1id']			= $result[0]['parent_id'];
				
				$multprice = $multprices[$product['sysno']];
		
				// 一般促销价
				$promoteKey = PRICE_TYPE_PROMOTE . ':' . ID_TYPE_PROMOTE_ALL;
				// 节能补贴价
				$subsidyKey = PRICE_TYPE_SUBSIDY . ':' . ID_TYPE_SUBSIDY_ALL;
		
				$multpriceKey = null;
				if (isset($multprice[$promoteKey])
						&& $multprice[$promoteKey]['price_desc'] == self::MPRICE_DESC) {
					// 有一般促销价且多价规则名称是否相符
					$multpriceKey = $promoteKey;
				} else {
					// 如果没有一般促销价且没有节能补贴价，则过滤此商品
					if (!isset($multprice[$subsidyKey])) {
						continue;
					} else {
						$multpriceKey = $subsidyKey;
					}
				}
				
				// sku等信息
				if (isset($skuInfos[$data['sysno']])) {
					$data['sku_id'] = $skuInfos[$data['sysno']]['sku_id'];
					$data['meta_id'] = $skuInfos[$data['sysno']]['meta_id'];
					$data['metas'] = $skuInfos[$data['sysno']]['metas'];
				} else {
					$data['sku_id'] = $data['meta_id'] = '';
					$data['metas'] = array();
				}
				
				// 判断节能补贴
				$data['jieneng'] = isset($multprice[$subsidyKey]) ? $multprice[$subsidyKey]['price_op_num'] : null;
				
				// 判断下单立减
				$data['lijian'] = (isset($multprice[$multpriceKey])
									&& $multprice[$multpriceKey]['price_op_type'] == IProductPrice::PROMOTE_TYPE_REDUCE)
								? $multprice[$multpriceKey]['price_op_num']
								: null;
				
				$data['mult_price'] = $multprice[$multpriceKey];
				$data['show_price'] = $multprice[$multpriceKey]['show_price'];
				$data['begin_time'] = !empty($multprice[$multpriceKey]['start_time'])
									? date('Y-m-d H:i:s', $multprice[$multpriceKey]['start_time'])
									: 0;
				$data['end_time'] = !empty($multprice[$multpriceKey]['end_time'])
								  ? date('Y-m-d H:i:s', $multprice[$multpriceKey]['end_time'])
								  : 0;
		
				if ($multpriceKey && $multprice[$multpriceKey]['stock_limit']) {
					$data['stock_limit'] = 1;
					$data['stock_total'] = $multprice[$multpriceKey]['stock_all'];
					$data['stock_rest'] = $multprice[$multpriceKey]['stock_rest'];
				} else {
					$data['stock_limit'] = 0;
					$data['stock_total'] = $product['inventory'];
					$data['stock_rest'] = $product['inventory'];
				}
		
				$data['product_name'] = !empty($product['product_name'])
									  ? $product['product_name']
									  : $productInfos[$product['sysno']]['name'];
				$data['sale_type'] = $productInfos[$product['sysno']]['product_sale_type'];
				$data['product_char_id'] = $productInfos[$product['sysno']]['product_char_id'];
				
				$datas[] = $data;
			}
		}
		
		return $datas;
	}
	
	/**
	 * 根据新商品池过滤
	 * 
	 * @param array	$products
	 * @param int	$site_id
	 */
	public static function filterByProductPool($products, $site_id)
	{
		$pool_products = self::getCurrentProducts($site_id);
		
		if ($pool_products !== false) {
			$sysno_ids = array();
			foreach ($pool_products as $product) {
				$sysno_ids[] = $product['sysno'];
			}
			
			if (!empty($sysno_ids)) {
				foreach ($products as $key => $product) {
					if (!in_array($product['sysno'], $sysno_ids)) {
						unset($products[$key]);
					}
				}
			}
		}
		
		return $products;
	}
	
	/**
	 * 获得指定站点的团购商品池ID
	 * 
	 * @param int $site_id
	 */
	public static function getProductPoolId($site_id)
	{
		$db	= Config::getDB('icson_event');
		$settings = $db->getRows("SELECT * FROM tuan_settings WHERE skey='productpool_id_{$site_id}'");
		if (!empty($settings)) {
			return intval($settings[0]['svalue']);
		} else {
			return null;
		}
	}
	
	private static function _objToArray($obj, $config)
	{
		$arr = array();
		foreach ($config as $k => $v) {
			if (isset($obj->$v)) {
				$arr[$k] = $obj->$v;
			} else {
				$arr[$k] = null;
			}
		}
		
		return $arr;
	}
	
	private static function _utf8ToGbk($data, $recursive = false)
	{
		if(!is_array($data)) {
			return iconv('utf-8', 'gbk', $data);
		} else {
			$new_data = array();
			foreach ($data as $k => $v) {
				if(!is_array($v)) {
					$new_data[$k] = iconv('utf-8', 'gbk', $data[$k]);
				} else {
					if($recursive) {
						$new_data[$k] = self::utf8ToGbk($data[$k]);
					} else {
						$new_data[$k] = $data[$k];
					}
				}
			}
			return $new_data;
		}
	}
}