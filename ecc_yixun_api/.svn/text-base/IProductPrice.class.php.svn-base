<?php

require_once PHPLIB_ROOT . 'api/appplatform/platform/web_stub_cntl.php';
require_once(PHPLIB_ROOT . 'api/appplatform/multprice4pageao_stub4php.php');
require_once(PHPLIB_ROOT . 'inc/pricetype.inc.php');

class IProductPrice {
	
	const PRODUCT_PRICE_API_CALLER = 'product_price_api';
	
	const MAX_PRODUCT_COUNT = 40;
	
	const PROMOTE_TYPE_DISCOUNT = 1;
	const PROMOTE_TYPE_REDUCE = 2;
	const PROMOTE_TYPE_FIX = 3;
	
	public static $errCode;
	public static $errMsg;
	
	private static $_PRICE_KEY_MAP = array(
		'source_id' => 'ddwPriceSourceId', // 来源ID
		'scene_id' => 'ddwPriceSceneId', // 场景ID
		'price_base' => 'dwPriceBase', // 批价的基准价
		'price_op_type' => 'dwPricePromoteType', // 商品促销多价的优惠方式，1折扣，2减价，3定价
		'price_op_num' => 'dwUnitPriceOpNum', // 商品促销多价的操作金额，如98折传 98，减10元传 10，定价为5元传 5
		'price_before' => 'dwPriceBeforePromoted', // 该款商品的优惠前价格
		'price_after' => 'dwPriceAfterPromoted', // 该款商品的优惠后价格
		'price_desc' => 'strPriceDesc', // 多价规则描述
		'price_number' => 'strPriceNumber', // 数量维度,可实现价格阶梯 
		'stock_limit' => 'dwPriceBuyLimitFlag', // 是否限购
		'stock_all' => 'dwPriceBuyMaxLimit', // 总体限购次数
		'stock_rest' => 'dwPriceBuyRestLimit', // 剩余限购次数
		'start_time' => 'dwPriceStartTime', // 规则开始时间
		'end_time' => 'dwPriceEndTime', // 规则结束时间
	);
	
	private static function clearErr() {
		self::$errCode = 0;
		self::$errMsg = '';
	}
	
	public static function getAllPrice($site_id, $product_ids, $uin = null) {
		self::clearErr();
		
		if(empty($product_ids)) {
			return array();
		}

		if(empty($uin)) {
			$uin = rand();
		}
		
		$cntl = new WebStubCntl();
		$cntl->setCallerName(self::PRODUCT_PRICE_API_CALLER);
		$cntl->setDwUin($uin);
		
		$req = new GetMultprice4pageReq();
		$req->machineKey = time();
		$req->source = __FILE__;
		$req->substationId = $site_id;
		//$req->uin = $uin;
		
		$result = array();
		while(!empty($product_ids)) {
			// 多价接口有数量上线，若超过分为多次请求
			$pids = array_splice($product_ids, 0, self::MAX_PRODUCT_COUNT);
			$product_params = array();
			foreach ($pids as $pid) {
				$page_bo = new MultPriceItem4PageBo();
				$page_bo->dwIsAll = 1;
				$page_bo->cIsAll_u = 1;
				$page_bo->strItemId = $pid;
				$page_bo->cItemId_u = 1;
				$page_bo->dwIsStockNum = 1;
				$page_bo->cIsStockNum_u = 1;
				$product_params[] = $page_bo;
			}
			$req->multPriceItemBo4PageList->setValue($product_params);
			
			$resp = new GetMultprice4pageResp();
			
			$ret = $cntl->invoke($req, $resp);
			if($ret == 0) {
				if($resp->result < 9000) {
					//var_export($resp->multPriceRules4PageBoList->getValue());
					$price_rule_objs = $resp->multPriceRules4PageBoList->getValue();
					$prices = array();
					foreach ($price_rule_objs as $product_id => $price_rule_obj) {
						$multiprice_objs = $price_rule_obj->mapMultPrice4PageBoList->getValue();
						foreach ($multiprice_objs as $price_key => $price_obj) {
							$price = ArrayUtil::objToArray($price_obj, self::$_PRICE_KEY_MAP);
							if($price === false) {
								Logger::err(ArrayUtil::$errCode . ' : ' . ArrayUtil::$errMsg);
							} else {
								$price['show_price'] = self::getShowPrice($price);
								$price['stock_percent'] = self::getStockPercent($price);
								$prices[$product_id][$price_key] = ArrayUtil::utf8ToGbk($price);
							}
						}
					}
					
					foreach ($prices as $k => $p) {
						$result[$k] = $p;
					}
					//return $prices;
				} else {
					self::$errCode = ErrorConfig::getErrorCode('invoke_error');
					self::$errMsg = '[' . $resp->result . ']' . $resp->errmsg;
					Logger::err(self::$errCode . ' : ' . self::$errMsg);
					return false;
				}
			} else {
				self::$errCode = ErrorConfig::getErrorCode('net_error');
				self::$errMsg = "Failed to get price with site {$site_id}, products " . implode(', ', $product_ids) . ".[ ret : $ret ]";
				Logger::err(self::$errCode . ' : ' . self::$errMsg);
				return false;
			}
		}
		
		return $result;
	}
	
	public static function getAllPriceInTime($site_id, $price_params, $uin = null) {
		self::clearErr();
		
		if(empty($price_params)) {
			return array();
		}

		if(empty($uin)) {
			$uin = rand();
		}
		
		$cntl = new WebStubCntl();
		$cntl->setCallerName(self::PRODUCT_PRICE_API_CALLER);
		$cntl->setDwUin($uin);
		
		$req = new GetMultprice4pageReq();
		$req->machineKey = time();
		$req->source = __FILE__;
		$req->substationId = $site_id;
		//$req->uin = $uin;
		
		$result = array();
		$t_price_params = $price_params;
		while(!empty($t_price_params)) {
			// 多价接口有数量上线，若超过分为多次请求
			$price_params_set = array_splice($t_price_params, 0, self::MAX_PRODUCT_COUNT);
			$product_params = array();
			foreach ($price_params_set as $pp) {
				if(empty($pp['product_id'])) {
					continue;
				}
				$page_bo = new MultPriceItem4PageBo();
				$page_bo->dwIsAll = 1;
				$page_bo->cIsAll_u = 1;
				$page_bo->strItemId = $pp['product_id'];
				$page_bo->cItemId_u = 1;
				$page_bo->dwIsStockNum = 1;
				$page_bo->cIsStockNum_u = 1;
				if(!empty($pp['price_time'])) {
					$page_bo->dwPriceStartTime = $pp['price_time'];
					$page_bo->cPriceStartTime_u = 1;
					$page_bo->dwPriceEndTime = $pp['price_time'];
					$page_bo->cPriceEndTime_u = 1;
				}
				$product_params[] = $page_bo;
			}
			if(empty($product_params)) {
				continue;
			}
			$req->multPriceItemBo4PageList->setValue($product_params);
			
			$resp = new GetMultprice4pageResp();
			
			$ret = $cntl->invoke($req, $resp);
			if($ret == 0) {
				if($resp->result < 9000) {
					//var_export($resp->multPriceRules4PageBoList->getValue());
					$price_rule_objs = $resp->multPriceRules4PageBoList->getValue();
					$prices = array();
					foreach ($price_rule_objs as $product_id => $price_rule_obj) {
						$multiprice_objs = $price_rule_obj->mapMultPrice4PageBoList->getValue();
						foreach ($multiprice_objs as $price_key => $price_obj) {
							$price = ArrayUtil::objToArray($price_obj, self::$_PRICE_KEY_MAP);
							if($price === false) {
								Logger::err(ArrayUtil::$errCode . ' : ' . ArrayUtil::$errMsg);
							} else {
								$price['show_price'] = self::getShowPrice($price);
								$price['stock_percent'] = self::getStockPercent($price);
								$prices[$product_id][$price_key] = ArrayUtil::utf8ToGbk($price);
							}
						}
					}
					
					foreach ($prices as $k => $p) {
						$result[$k] = $p;
					}
					//return $prices;
				} else {
					self::$errCode = ErrorConfig::getErrorCode('invoke_error');
					self::$errMsg = '[' . $resp->result . ']' . $resp->errmsg;
					Logger::err(self::$errCode . ' : ' . self::$errMsg);
					return false;
				}
			} else {
				self::$errCode = ErrorConfig::getErrorCode('net_error');
				self::$errMsg = "Failed to get price with site {$site_id}, products " . ToolUtil::gbJsonEncode($price_params) . ".[ ret : $ret ]";
				Logger::err(self::$errCode . ' : ' . self::$errMsg);
				return false;
			}
		}
		
		return $result;
	}
	
	private static function getShowPrice($price) {
		if($price['source_id'] == PRICE_TYPE_SUBSIDY) {
			// 节能补贴，显示原价
			return $price['price_base'];// - $price['price_op_num'];
		} else if($price['source_id'] == PRICE_TYPE_LADDER) {
			// 阶梯价，应该显示易迅价
			return $price['price_base'];
		} else if($price['source_id'] == PRICE_TYPE_PROMOTE) {
			if($price['price_op_type'] == self::PROMOTE_TYPE_DISCOUNT) {
				return $price['price_base'] * $price['price_op_num'] / 100;
			} else if($price['price_op_type'] == self::PROMOTE_TYPE_REDUCE) {
				return $price['price_base'];// - $price['price_op_num'];
			} else {
				return $price['price_after'];
			}
		} else {
			return $price['price_after'];
		}
	}
	
	private static function getStockPercent($price) {
		if($price['stock_limit']) {
			// 有库存限制
			return ceil($price['stock_rest'] / $price['stock_all'] * 100);
		} else {
			return 100;
		}
	}
}