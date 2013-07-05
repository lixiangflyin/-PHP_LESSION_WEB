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
		'source_id' => 'ddwPriceSourceId', // ��ԴID
		'scene_id' => 'ddwPriceSceneId', // ����ID
		'price_base' => 'dwPriceBase', // ���۵Ļ�׼��
		'price_op_type' => 'dwPricePromoteType', // ��Ʒ������۵��Żݷ�ʽ��1�ۿۣ�2���ۣ�3����
		'price_op_num' => 'dwUnitPriceOpNum', // ��Ʒ������۵Ĳ�������98�۴� 98����10Ԫ�� 10������Ϊ5Ԫ�� 5
		'price_before' => 'dwPriceBeforePromoted', // �ÿ���Ʒ���Ż�ǰ�۸�
		'price_after' => 'dwPriceAfterPromoted', // �ÿ���Ʒ���Żݺ�۸�
		'price_desc' => 'strPriceDesc', // ��۹�������
		'price_number' => 'strPriceNumber', // ����ά��,��ʵ�ּ۸���� 
		'stock_limit' => 'dwPriceBuyLimitFlag', // �Ƿ��޹�
		'stock_all' => 'dwPriceBuyMaxLimit', // �����޹�����
		'stock_rest' => 'dwPriceBuyRestLimit', // ʣ���޹�����
		'start_time' => 'dwPriceStartTime', // ����ʼʱ��
		'end_time' => 'dwPriceEndTime', // �������ʱ��
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
			// ��۽ӿ����������ߣ���������Ϊ�������
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
			// ��۽ӿ����������ߣ���������Ϊ�������
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
			// ���ܲ�������ʾԭ��
			return $price['price_base'];// - $price['price_op_num'];
		} else if($price['source_id'] == PRICE_TYPE_LADDER) {
			// ���ݼۣ�Ӧ����ʾ��Ѹ��
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
			// �п������
			return ceil($price['stock_rest'] / $price['stock_all'] * 100);
		} else {
			return 100;
		}
	}
}