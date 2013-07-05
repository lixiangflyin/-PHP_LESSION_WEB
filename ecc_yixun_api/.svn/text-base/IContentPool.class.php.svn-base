<?php

require_once PHPLIB_ROOT . 'api/appplatform/platform/web_stub_cntl.php';
require_once(PHPLIB_ROOT . 'api/appplatform/contentdao_stub4php.php');

/**
 * 商品池/素材池数据获取接口
 * @author smithhuang
 * @version 1.0 暂只提供单个或者多个商品池的数据获取
 */

class IContentPool {
	
	/**
	 * 用于上报的调用者ID
	 * @var string
	 */
	const CONTENT_POOL_API_CALLER = 'content_pool_api';
	
	public static $errCode = 0;
	public static $errMsg = '';
	
	private static $_PRODUCT_KEY_MAP = array(
		'id' => 'dwId', // ID
		'product_id' => 'strCommodityId', // 商品ID
		'product_name' => 'strTitle', // 商品名称
		'pic_url' => 'strPicUrl', // 商品默认图片
		'pic_url_80' => 'strPicUrl80', // 商品80像素图片
		'sold_num' => 'dwSoldNum', // 已销售数量
		'category_id' => 'strClassId', // 分类ID
		'category_name' => 'strCategoryName', // 分类名称
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
		'rush_start_time' => 'dwStarttime', // 抢购开始时间
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
	
	private static function clearErr() {
		self::$errCode = 0;
		self::$errMsg = '';
	}
	
	/**
	 * 获取单个商品池某一期的数据，若不设期数则为当前期
	 * @param int $pool_id 商品池ID
	 * @param int $term_id 期数
	 */
	public static function getProductByPool($pool_id, $term_id = 0) {
		self::clearErr();
		
		$cntl = new WebStubCntl();
		$cntl->setCallerName(self::CONTENT_POOL_API_CALLER);
		
		$req = new GetContentReq();
		$content_param = new ContentParam();
		$content_param->dwPoolId = $pool_id;
		$content_param->cPoolId_u = 1;
		
		if(!empty($term_id)) {
			$content_param->dwTerm = $term_id;
			$content_param->cTerm_u = 1;
		}
		
		$req->contentParam->setValue(array( $content_param ));
		
		$resp = new GetContentResp();
		
		$ret = $cntl->invoke($req, $resp);
		if($ret == 0) {
			if($resp->result == 0) {
				$product_objs = $resp->resultList->getValue();
				$products = array();
				if(isset($product_objs[$pool_id])) {
					foreach ($product_objs[$pool_id] as $obj) {
						$product = ArrayUtil::objToArray($obj, self::$_PRODUCT_KEY_MAP);
						if($product === false) {
							Logger::err(ArrayUtil::$errCode . ' : ' . ArrayUtil::$errMsg);
						} else {
							$product['ext_data'] = json_decode('{' . $product['ext_data'] . '}', true);
							$product['multiprices'] = json_decode($product['multiprices'], true);
							$products[] = ArrayUtil::utf8ToGbk($product);
						}
					}
				} else {
					Logger::warn("Products not found with pool id $pool_id.");
				}
				
				//usort($products, array(self, 'compareProduct'));
				return $products;
			} else {
				self::$errCode = ErrorConfig::getErrorCode('invoke_error');
				self::$errMsg = '[' . $resp->result . ']' . $resp->errMsg;
				Logger::err(self::$errCode . ' : ' . self::$errMsg);
				return false;
			}
		} else {
			self::$errCode = ErrorConfig::getErrorCode('net_error');
			self::$errMsg = "Failed to get products with pool id $pool_id, term $term_id.";
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
	}
	
	public static function getSourceByPoolForThh($pool_id, $term_id = 0) {
		self::clearErr();
	
		$cntl = new WebStubCntl();
		$cntl->setCallerName(self::CONTENT_POOL_API_CALLER);
	
		$req = new GetContentReq();
		$content_param = new ContentParam();
		$content_param->dwPoolId = $pool_id;
		$content_param->cPoolId_u = 1;
	
		if(!empty($term_id)) {
			$content_param->dwTerm = $term_id;
			$content_param->cTerm_u = 1;
		}
	
		$req->contentParam->setValue(array( $content_param ));
	
		$resp = new GetContentResp();
	
		$ret = $cntl->invoke($req, $resp);
		if($ret == 0) {
			if($resp->result == 0) {
				$product_objs = $resp->resultList->getValue();
				$products = array();
				
				if(isset($product_objs[$pool_id])) {
					for ($i = 0; $i < $product_objs[$pool_id]->size; $i++) {
						$pvalue = $product_objs[$pool_id][$i];
						if (isset($pvalue->strExtData)) {
							$item = json_decode('{' . $pvalue->strExtData . '}');
							if (isset($item->list) && !empty($item->list)) {
								$product = array();
								$product['img_wide'] = $item->list[0]->picUrl;
								$product['img_narrow'] = $item->list[0]->picUrl2;
								$product['url'] = $item->list[0]->url;
								$product['content'] = $item->list[0]->title;
								$products[] = ArrayUtil::utf8ToGbk($product);
							}
						}
					}
					return $products;
				} else {
					Logger::warn("Source not found with pool id $pool_id.");
				}
				
				return $products;
			} else {
				self::$errCode = ErrorConfig::getErrorCode('invoke_error');
				self::$errMsg = '[' . $resp->result . ']' . $resp->errMsg;
				Logger::err(self::$errCode . ' : ' . self::$errMsg);
				return false;
			}
		} else {
			self::$errCode = ErrorConfig::getErrorCode('net_error');
			self::$errMsg = "Failed to get sources with pool id $pool_id, term $term_id.";
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
	}
	
	/**
	 * 获取多个商品池的数据
	 * @param array $pools 商品池ID与期数的数组，如 array( array( 'pool_id' => 1 ), array( 'pool_id' => 1, 'term_id' => 1 ) )
	 */
	public static function getProductByPools($pools) {
		self::clearErr();
		
		if(!is_array($pools)) {
			self::$errCode = ErrorConfig::getErrorCode('unexpected_input');
			self::$errMsg = 'Parameter 1 should be array.';
		}
		
		$cntl = new WebStubCntl();
		$cntl->setCallerName(self::CONTENT_POOL_API_CALLER);
		
		$req = new GetContentReq();
		$content_params = array();
		foreach ($pools as $pool) {
			if(empty($pool['pool_id'])) {
				continue;
			}
			
			$content_param = new ContentParam();
			$content_param->dwPoolId = $pool['pool_id'];
			$content_param->cPoolId_u = 1;
			
			if(!empty($pool['term_id'])) {
				$content_param->dwTerm = $pool['term_id'];
				$content_param->cTerm_u = 1;
			}
			
			$content_params[] = $content_param;
		}
		$req->contentParam->setValue($content_params);
		
		$resp = new GetContentResp();
		
		$ret = $cntl->invoke($req, $resp);
		if($ret == 0) {
			if($resp->result == 0) {
				$pool_arr = $resp->resultList->getValue();
				$products = array();
				foreach ($pool_arr as $pool_id => $product_objs) {
					$pool_products = array();
					foreach ($product_objs as $obj) {
						$product = ArrayUtil::objToArray($obj, self::$_PRODUCT_KEY_MAP);
						if($product === false) {
							Logger::err(ArrayUtil::$errCode . ' : ' . ArrayUtil::$errMsg);
						} else {
							$product['ext_data'] = json_decode('{' . $product['ext_data'] . '}', true);
							$product['multiprices'] = json_decode($product['multiprices'], true);
							$pool_products[] = ArrayUtil::utf8ToGbk($product);
						}
					}
					//usort($pool_products, array(self, 'compareProduct'));
					$products[] = $pool_products;
				}
				
				return $products;
			} else {
				self::$errCode = ErrorConfig::getErrorCode('invoke_error');
				self::$errMsg = '[' . $resp->result . ']' . $resp->errMsg;
				Logger::err(self::$errCode . ' : ' . self::$errMsg);
				return false;
			}
		} else {
			self::$errCode = ErrorConfig::getErrorCode('net_error');
			self::$errMsg = "Failed to get products with pool id $pool_id, term $term_id.";
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
	}
}