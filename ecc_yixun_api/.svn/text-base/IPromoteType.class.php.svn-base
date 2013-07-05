<?php
require_once('Config.php');
require_once(PHPLIB_ROOT . 'api/appplatform/platform/web_stub_cntl.php');
require_once(PHPLIB_ROOT . 'api/appplatform/contentdao_stub4php.php');
require_once(PHPLIB_ROOT . 'api/appplatform/icsonbossao_stub4php.php');
require_once(PHPLIB_ROOT . 'api/appplatform/ncadao_stub4php.php');
require_once(PHPLIB_ROOT . 'api/appplatform/storehouseao_php5_stub.php');

Logger::init();

/**
 * 商品打标操作
 *
 * @author rongxu <rongxu@tencent.com>
 * @version created by rongxu 2013-6-20
 *
 */
class IPromoteType {

	/**
	 * @var 早晚市的标
	 */
	const SCENE_ID_MORNING_AND_DINNER_SALES = 10013;

	/**
	 * @var 周末清仓的标
	 */
	const SCENE_ID_WEEKEND_CLEARANCE_SALES = 10014;

	/**
	 * @var 团购的标
	 */
	const SCENE_ID_TUAN_PAGE = 10012;

	/**
	 * @var 当前业务类型
	 */
	private static $sceneId;

	/**
	 * @var 商品ids
	 */
	private static $productIds;

	/**
	 * @var 商品skuids
	 */
	private static $skuIds;

	/**
	 * @var 站点id
	 */
	private static $whId;

	/**
	 * @var 打标操作类型
	 */
	private static $opType;

	/**
	 * @var 添加操作
	 */
	const OP_ADD = 0x2;

	/**
	 * @var 修改操作
	 */
	const OP_MODIFY = 0x1;

	/**
	 * @var 删除操作
	 */
	const OP_DELETE = 0x4;

	/**
	 * @var 标记操作
	 */
	const OP_LOOK = 0x8;

	/**
	 * @var 有团购打标
	 */
	const OP_SET_TUAN = 10;

	/**
	 * @var 有团购取消标
	 */
	const OP_UNSET_TUAN= 11;

	/**
	 * @var 早晚市打标
	 */
	const OP_SET_MORNING_AND_DINNER= 12;

	/**
	 * @var 早晚市取消标
	 */
	const OP_UNSET_MORNING_AND_DINNER = 13;

	/**
	 * @var 周末清仓打标
	 */
	const OP_SET_WEEKEND_CLEARANCE = 14;

	/**
	 * @var 周末清仓取消标
	 */
	const OP_UNSET_WEEKEND_CLEARANCE = 15;

	/**
	 * @var 业务打标操作
	 */
	private static $opOperation;

	/**
	 * @var 访问ao的api名称
	 */
	const VST_AO_API = 'promoteType';

	/**
	 * 合作伙伴ID，易迅为855006089
	 */
	const CO_OPERATORID = 855006089;

	/**
	 * @var 分仓id
	 */
	private static $storeHouseIds;

	public static $errCode	= 0;
	public static $errMsg	= '';

	/**
	 * @var 保存当前运行的早晚市商品列表ids
	 */
	const MONING_AND_DINNER_SET_TYPE_KEY = 'run_time_productids_morning_and_dinner';

	/**
	 * @var 保存当前运行的团购商品列表ids
	 */
	const TUAN_SET_TYPE_KEY = 'run_time_productids_tuan';

	/**
	 * @var 保存当前运行的周末清仓商品列表ids
	 */
	const WEEKEND_SET_TYPE_KEY = 'run_time_productids_weekend';

	/**
	 * @var 接口限制20个商品
	 */
	const TYPE_NUM = 20;

	/**
	 * 商品打标 多于20个商品
	 * @param $productIds 商品ids
	 * @param $whId 站点id
	 * @param $opOperation 具体打标操作
	 * @return boolen
	 */
	public static function operatorAll($productIds, $whId, $opOperation) {

		$count = count($productIds);
		$offset = 0;
		$pageMax = ceil($count/self::TYPE_NUM);
		
		do {
			$productIdsLimits = array_slice($productIds, $offset, self::TYPE_NUM);
			$pageMax--;
			$offset += self::TYPE_NUM;

			if (self::operator($productIdsLimits, $whId, $opOperation) === false) {
				if ($opOperation == self::OP_SET_MORNING_AND_DINNER 
					|| $opOperation == self::OP_UNSET_TUAN 
					|| $opOperation == self::OP_UNSET_WEEKEND_CLEARANCE) {
					//打标失败记录日志
					Logger::err('promote type set failure : whid:' . $whId . ' op:' . $opOperation);
				} else {
					//取消打标失败记录cmem
					Logger::err('promote type cancel failure : whid:' . $whId . ' op:' . $opOperation);
				}
			}

		} while ($pageMax > 0);	
		
	}

	/**
	 * 商品打标 少于20个商品
	 * @param $productIds 商品ids
	 * @param $whId 站点id
	 * @param $opOperation 具体打标操作
	 * @return boolen
	 */
	public static function operator($productIds, $whId, $opOperation) {
		
		if (count($productIds) > 20) return false;

		if (self::_iniz($productIds, $whId, $opOperation)) {

			self::$opType = self::OP_MODIFY;

			$req = self::_getReq();

			$resp = new OperateStock4AdminWithAuthResp();

			$cntl = new WebStubCntl();
			$cntl->setCallerName(self::VST_AO_API);
			$cntl->setDwOperatorId(self::CO_OPERATORID);
			$ret = $cntl->invoke($req, $resp);
			if ($ret == 0) {
				//var_dump($resp);
				//return false;
				if ($resp->result == 0) {
					self::$errCode = 0;
					self::$errMsg = 'promote success';
					Logger::err(self::$errCode . ' : ' . self::$errMsg);
					return true;
				} else {
					self::$errCode = 322;
					self::$errMsg = '[' . $resp->result . ']' . $resp->errmsg;
					Logger::err(self::$errCode . ' : ' . self::$errMsg);
					return false;
				}
			} else {
				self::$errCode = 321;
				self::$errMsg = "Failed to get sku convert infos, " . $cntl->getLastErrMsg();
				Logger::err(self::$errCode . ' : ' . self::$errMsg);
				return false;
			}
		}
		
	}

	/**
	 * 初始化数据
	 * @param $productIds 商品ids
	 * @param $whId 站点id
	 * @param $opOperation 具体打标操作
	 * @return boolen
	 */
	private static function _iniz($productIds, $whId, $opOperation) {
		if (empty($productIds) || empty($whId) || empty($opOperation)) {
			return false;
		}

		self::$productIds = $productIds;
		self::$whId = $whId;
		self::$opOperation = $opOperation;
		if ($opOperation == self::OP_SET_MORNING_AND_DINNER || $opOperation == self::OP_UNSET_MORNING_AND_DINNER) {
			self::$sceneId = self::SCENE_ID_MORNING_AND_DINNER_SALES;
		} else if ($opOperation == self::OP_SET_WEEKEND_CLEARANCE || $opOperation == self::OP_UNSET_WEEKEND_CLEARANCE) {
			self::$sceneId = self::SCENE_ID_WEEKEND_CLEARANCE_SALES;
		} else if ($opOperation == self::OP_SET_TUAN || $opOperation == self::OP_UNSET_MORNING_AND_DINNER) {
			self::$sceneId = self::SCENE_ID_TUAN_PAGE;
		} else {
			return false;
		}
		

		return true;
	}

	/**
	 * 获取请求对象
	 * @return OperateStock4AdminWithAuthReq
	 */
	private static function _getReq() {

		self::_getSkuStoreHouse();
		if (empty(self::$storeHouseIds)) {
			return false;
		}

		$storeHouseIds = new stl_set();
		$storeHouseIds->setType("uint32_t");
		$storeHouseIds->setValue(self::$storeHouseIds);

		$storeHouse = array();
//		self::$skuIds = array(100942, 100997);
		foreach (self::$skuIds as $skuId) {
			$storeHouse[$skuId] = $storeHouseIds;
		}

		$req = new OperateStock4AdminWithAuthReq();

		$req->machineKey = __FILE__;
		$req->source = __FILE__;
		$req->sceneId = self::$sceneId;
		$req->option = 0;

		$req->skuStoreHouse = new stl_map();
		$req->skuStoreHouse->setType('uint64_t', 'stl_set<uint32_t>');
		$req->skuStoreHouse->setValue($storeHouse);

		$req->operation = new stl_map();
		$req->operation->setType('uint16_t', 'stl_string');
		$req->operation->setValue(array(self::$opOperation => ''));

		$req->authWeb = self::_getAuthorFieldWeb();

		return $req;
	}

	/**
	 * 获取返回对象
	 * @return AuthorizationField4Web
	 */
	private static function _getAuthorFieldWeb() {
		$authorFieldWeb = new AuthorizationField4Web();

		$authorFieldWeb->dwOperationType = self::$opType;
		$authorFieldWeb->cOperationType_u = 1;
		$authorFieldWeb->dwOperatorType = 0x8;
		$authorFieldWeb->cOperatorType_u = 1;
		$authorFieldWeb->strOperatorId = "100";
		$authorFieldWeb->cOperatorId_u = 1;
		$authorFieldWeb->dwOperatorAuthType = 1;
		$authorFieldWeb->cOperatorAuthType_u = 1;
		$authorFieldWeb->ddwOperatorAuthId = 1;
		$authorFieldWeb->cOperatorAuthId_u = 1;
		$authorFieldWeb->strOperationReason = 'product promotetype';
		$authorFieldWeb->cOperationReason_u = 1;

		return $authorFieldWeb;
	}

	/**
	 * 获取分仓
	 * @return boolean
	 */
	private static function _getSkuStoreHouse() {
		self::_getSkuIdsByProductIds();
		if (empty(self::$skuIds)) {
			return false;
		}

		$req = new b2b2c\storehouse\ao\GetStoreHouseByCooperatorIdReq();
		$req->machineKey = __FILE__;
		$req->source = 0;
		$req->sceneId = 0;
		$req->cooperatorId = self::CO_OPERATORID;

		$resp = new b2b2c\storehouse\ao\GetStoreHouseByCooperatorIdResp();

		$cntl = new WebStubCntl();
		$cntl->setCallerName(self::VST_AO_API);
		$ret = $cntl->invoke($req, $resp);
		$storeHouseIds = array();
		if ($ret == 0) {
			if ($resp->result == 0) {
				$storeHousePos = $resp->storeHousePo->getValue();
				foreach ($storeHousePos as $storeHousePo) {
					if (!empty($storeHousePo)) {
						if ($storeHousePo['storeHouseCode'] == self::$whId && $storeHousePo['storeHouseType'] == 0) {
							$storeHouseIds[] = $storeHousePo['storeHouseId'];
						}
					}
				}

				self::$storeHouseIds = $storeHouseIds;
				return true;
			} else {
				self::$errCode = 312;
				self::$errMsg = '[' . $resp->result . ']' . $resp->errmsg;
				Logger::err(self::$errCode . ' : ' . self::$errMsg);
				return false;
			}
		} else {
			self::$errCode = 311;
			self::$errMsg = "Failed to get sku convert infos, " . $cntl->getLastErrMsg();
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
	}

	/**
	 * 根据易迅id获取skuIds
	 * @return boolen
	 */
	private static function _getSkuIdsByProductIds() {
		$req = new BatchGetSkuInfoListByIcsonIdReq();
		$req->machineKey = __FILE__;
		$req->source = 0;
		$req->sceneId = ITuans::SKU_SCENEID;
		$req->cooperatorId = self::CO_OPERATORID;
		$req->icsonId = new stl_set();
		$req->icsonId->setType('stl_string');
		$req->icsonId->setValue(self::$productIds);

		$resp = new BatchGetSkuInfoListByIcsonIdResp();

		$cntl = new WebStubCntl();
		$cntl->setCallerName(self::VST_AO_API);
		$ret = $cntl->invoke($req, $resp);
		$skuIds = array();
		if ($ret == 0) {
			if ($resp->result == 0) {
				$skuObjs = $resp->conversionSkuBasicPo->getValue();
				foreach ($skuObjs as $sku) {
					$skuValues = $sku->getValue();
					if (!empty($skuValues)) {
						$skuIds[] = $skuValues[0]->ddwSkuId;
					}
				}
				self::$skuIds = $skuIds;
				return true;
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
	}

	//以下是纯业务的处理函数

	/**
	 * 商品打标 多于20个商品，支持早晚市，团购等取消打标失败的情况
	 * @param $productIds 商品ids
	 * @param $whId 站点id
	 * @param $opOperation 具体打标操作
	 * @param $biz 早晚市，团购等业务
	 * @return boolen
	 */
	public static function operatorAllByWeb($productIds, $whId, $opOperation, $biz = '') {

		$count = count($productIds);
		$offset = 0;
		$pageMax = ceil($count/self::TYPE_NUM);
		
		do {
			$productIdsLimits = array_slice($productIds, $offset, self::TYPE_NUM);
			$pageMax--;
			$offset += self::TYPE_NUM;

			if (self::operator($productIdsLimits, $whId, $opOperation) === false) {
				if ($opOperation == self::OP_SET_MORNING_AND_DINNER 
					|| $opOperation == self::OP_SET_TUAN 
					|| $opOperation == self::OP_SET_WEEKEND_CLEARANCE) {
					//打标失败记录日志
					Logger::err('promote type set failure : whid:' . $whId . ' op:' . $opOperation);
				} else {
					//取消打标失败记录cmem
					Logger::err('promote type cancel failure : whid:' . $whId . ' op:' . $opOperation);
					if (!empty($biz)) {
						$cancelFailureKey = self::TEST_KEY . 'cancel_failure' . $biz . $whId;
						$cancelFailures = unserialize(IDataCache::getData($cancelFailureKey));
						if ($cancelFailures !== false) {
							$cancels = array_merge($cancelFailures, self::$productIds);
							$cancels = array_unique($cancels);
						} else {
							$cancels = self::$productIds;
						}
						IDataCache::setData($cancelFailureKey, serialize($cancels));
						
					}
				}
			}

		} while ($pageMax > 0);	
		
	}

	const TEST_KEY = '109';

	/**
	 * 设置早晚市打标与取消标
	 *
	 * @param $productIds 商品
	 * @param $whId 站点id
	 * 
	 */
	public static function setMorningAndDinner($productIds, $whId) {

		/**
		 * @var 业务
		 * @var 打标操作
		 * @var 设置打标操作
		 */
		$biz = self::MONING_AND_DINNER_SET_TYPE_KEY;
		$opSet = self::OP_SET_MORNING_AND_DINNER;
		$opUnset = self::OP_UNSET_MORNING_AND_DINNER;

		/**
		 * @var 记录当前节点数据的key
		 * @var 记录当前取消打标失败的数据的key
		 */
		$nodeKey = self::TEST_KEY . $biz . $whId;
		$cancelFailureKey = self::TEST_KEY . 'cancel_failure' . $biz . $whId;

		//1. 获取取消打标失败列表，取消打标
		$cancelFailure = IDataCache::getData($cancelFailureKey);
		//var_dump("取消打标失败数据", $cancelFailure);
		if (!empty($cancelFailure)) {
			$cancelFailure = unserialize($cancelFailure);
			IDataCache::delData($cancelFailureKey);
			self::operatorAllByWeb($cancelFailure, $whId, $opUnset, $biz);
		}

		//2. 获取上一节点的商品
		$preProductIds = unserialize(IDataCache::getData($nodeKey));
		//var_dump("上一个节点数据", $preProductIds);

		//3. 设置当前节点商品
		IDataCache::setData($nodeKey, serialize($productIds));
		//var_dump("当前节点数据", $productIds);

		//4. 设置打标
		self::operatorAllByWeb($productIds, $whId, $opSet);

		//5. 根据上一个节点与此时的商品比较得到需要取消打标的商品
		$cancelProductIds = self::getCancelProductIds($preProductIds, $productIds, $whId, $biz);
		//var_dump("当前节点需要取消打标的数据", $cancelProductIds);

		//6. 取消打标
		if (!empty($cancelProductIds)) {
			self::operatorAllByWeb($cancelProductIds, $whId, $opUnset, $biz);
		}
		
	}

	/**
	 * 设置团购打标与取消标
	 *
	 * @param $productIds 商品
	 * @param $whId 站点id
	 * 
	 */
	public static function setTuans($productIds, $whId) {
		
		/**
		 * @var 业务
		 * @var 打标操作
		 * @var 设置打标操作
		 */
		$biz = self::TUAN_SET_TYPE_KEY;
		$opSet = self::OP_SET_TUAN;
		$opUnset = self::OP_UNSET_TUAN;

		/**
		 * @var 记录当前节点数据的key
		 * @var 记录当前取消打标失败的数据的key
		 */
		$nodeKey = self::TEST_KEY . $biz . $whId;
		$cancelFailureKey = self::TEST_KEY . 'cancel_failure' . $biz . $whId;

		//1. 获取取消打标失败列表，取消打标
		$cancelFailure = IDataCache::getData($cancelFailureKey);
		//var_dump("取消打标失败数据", $cancelFailure);
		if (!empty($cancelFailure)) {
			$cancelFailure = unserialize($cancelFailure);
			IDataCache::delData($cancelFailureKey);
			self::operatorAllByWeb($cancelFailure, $whId, $opUnset, $biz);
		}

		//2. 获取上一节点的商品
		$preProductIds = unserialize(IDataCache::getData($nodeKey));
		//var_dump("上一个节点数据", $preProductIds);

		//3. 设置当前节点商品
		IDataCache::setData($nodeKey, serialize($productIds));
		//var_dump("当前节点数据", $productIds);

		//4. 设置打标
		self::operatorAllByWeb($productIds, $whId, $opSet);

		//5. 根据上一个节点与此时的商品比较得到需要取消打标的商品
		$cancelProductIds = self::getCancelProductIds($preProductIds, $productIds, $whId, $biz);
		//var_dump("当前节点需要取消打标的数据", $cancelProductIds);

		//6. 取消打标
		if (!empty($cancelProductIds)) {
			self::operatorAllByWeb($cancelProductIds, $whId, $opUnset, $biz);
		}
	}

	/**
	 * 设置周末清仓打标与取消标
	 *
	 * @param $productIds 商品
	 * @param $whId 站点id
	 * 
	 */
	public static function setWeekClearance($productIds, $whId) {
		
		/**
		 * @var 业务
		 * @var 打标操作
		 * @var 设置打标操作
		 */
		$biz = self::WEEKEND_SET_TYPE_KEY;
		$opSet = self::OP_SET_WEEKEND_CLEARANCE;
		$opUnset = self::OP_UNSET_WEEKEND_CLEARANCE;

		/**
		 * @var 记录当前节点数据的key
		 * @var 记录当前取消打标失败的数据的key
		 */
		$nodeKey = self::TEST_KEY . $biz . $whId;
		$cancelFailureKey = self::TEST_KEY . 'cancel_failure' . $biz . $whId;

		//1. 获取取消打标失败列表，取消打标
		$cancelFailure = IDataCache::getData($cancelFailureKey);
		//var_dump("取消打标失败数据", $cancelFailure);
		if (!empty($cancelFailure)) {
			$cancelFailure = unserialize($cancelFailure);
			IDataCache::delData($cancelFailureKey);
			self::operatorAllByWeb($cancelFailure, $whId, $opUnset, $biz);
		}

		//2. 获取上一节点的商品
		$preProductIds = unserialize(IDataCache::getData($nodeKey));
		//var_dump("上一个节点数据", $preProductIds);

		//3. 设置当前节点商品
		IDataCache::setData($nodeKey, serialize($productIds));
		//var_dump("当前节点数据", $productIds);

		//4. 设置打标
		self::operatorAllByWeb($productIds, $whId, $opSet);

		//5. 根据上一个节点与此时的商品比较得到需要取消打标的商品
		$cancelProductIds = self::getCancelProductIds($preProductIds, $productIds, $whId, $biz);
		//var_dump("当前节点需要取消打标的数据", $cancelProductIds);

		//6. 取消打标
		if (!empty($cancelProductIds)) {
			self::operatorAllByWeb($cancelProductIds, $whId, $opUnset, $biz);
		}
	}

	/**
	 * 获取需要取消打标的商品
	 * @param $preProductIds 当前的商品
	 * @param $productIds 商品
	 * @param $whId 站点id
	 * @param $biz 业务类型
	 * @return boolean or array
	 * 
	 */
	private static function getCancelProductIds($preProductIds, $productIds, $whId, $biz) {

		if (empty($preProductIds)) {
			return false;
		} else {
			$oldProductIds = array();
			foreach ($preProductIds as $preProductId) {
				if (!in_array($preProductId, $productIds)) {
					$oldProductIds[] = $preProductId;
				}
			}
			return $oldProductIds;
		}
	}

}


//demo
//IPromoteType::operator(array(20514,20515), 1001, IPromoteType::OP_SET_MORNING_AND_DINNER);
//IPromoteType::operator(array(20514,20515), 1001, IPromoteType::OP_UNSET_MORNING_AND_DINNER);
//IPromoteType::operator(array(20514,20515), 1, IPromoteType::OP_SET_MORNING_AND_DINNER);
//IPromoteType::operator(array(20514,20515), 1001, IPromoteType::OP_UNSET_MORNING_AND_DINNER);
/*
switch ($argv[1]) {
	case 1: $productIds = array(1,2);
	break;
	case 2: $productIds = array(1,3);
	break;
	case 3: $productIds = array(1,2);
	break;
	case 4: $productIds = array(1,2,3);
	break;
	case 5: $productIds = array(7,9);
	break;
	case 6: $productIds = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,
							21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,
							41,42,43);
	break;
	case 7: $productIds = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,
							51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,38,39,40,
							41,42,43);
	break;
	case 8: $productIds = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,
							51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,38,39,40,
							41,42,43);
	break;
}

IPromoteType::setMorningAndDinner($productIds, 1001);
*/
