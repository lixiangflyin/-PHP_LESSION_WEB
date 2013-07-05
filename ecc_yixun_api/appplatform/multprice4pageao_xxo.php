<?php

//source idl: com.icson.multprice.idl.MultPrice4PageAo.java

if (!class_exists('ViewTimedPricePo',false)) {
class ViewTimedPricePo
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 *  timedPrice index 合法值为1-10，最大支持10个timefield的设置 其中coss最多5个(1-5)，用户5个 10个不排序 TODO:
		 *
		 * 版本 >= 0
		 */
		var $wTimedPriceIndex; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceIndex_u; //uint8_t

		/**
		 * 多价状态 0-已审核 1-待审核 2-中止 3-删除
		 *
		 * 版本 >= 0
		 */
		var $wTimedPriceState; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceState_u; //uint8_t

		/**
		 *  规则名称 支持64个字符
		 *
		 * 版本 >= 0
		 */
		var $strTimedPriceName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceName_u; //uint8_t

		/**
		 *  timedPrice 次数,可不填，default为1次
		 *
		 * 版本 >= 0
		 */
		var $wTimedPriceCount; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceCount_u; //uint8_t

		/**
		 *  timedPrice 持续时间 单位s，必填 由结束时间-开始时间 
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPriceLastLong; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceLastLong_u; //uint8_t

		/**
		 *  timedPrice 开始时间 必填
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPriceStartTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceStartTime_u; //uint8_t

		/**
		 *  timedPrice 价格操作类型，打折(精确度为10000) 扣减 覆盖 原价不变等，必填
		 *
		 * 版本 >= 0
		 */
		var $wTimedPriceOperationType; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceOperationType_u; //uint8_t

		/**
		 *  timedPrice 操作数 如操作类型为打折 此对应具体多少折扣 为价格是 单位分 必填
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPriceOperationNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceOperationNum_u; //uint8_t

		/**
		 *  timedPrice 属性 仅用于读接口
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPriceProperty; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceProperty_u; //uint8_t

		/**
		 *  timedPrice 自定义促销规则，暂不填
		 *
		 * 版本 >= 0
		 */
		var $strTimedPriceCustomerPromotionRule; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceCustomerPromotionRule_u; //uint8_t

		/**
		 *  timedPrice 价格基准类型，必填
		 *
		 * 版本 >= 0
		 */
		var $wTimedPriceBasePriceType; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceBasePriceType_u; //uint8_t

		/**
		 *  促销语描述，最大支持120个字(字符) 选填
		 *
		 * 版本 >= 0
		 */
		var $strTimedPricePromotionDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cTimedPricePromotionDesc_u; //uint8_t

		/**
		 * 规则生效次数
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPriceMaxUseNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceMaxUseNum_u; //uint8_t

		/**
		 * 适用仓库，格式待定义
		 *
		 * 版本 >= 0
		 */
		var $strTimedPriceStoreHouse; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceStoreHouse_u; //uint8_t

		/**
		 * 活动关联id，格式待定义
		 *
		 * 版本 >= 0
		 */
		var $strTimedPriceActiveId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceActiveId_u; //uint8_t

		/**
		 * 成本分摊人 待定义
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPriceCostResponse; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceCostResponse_u; //uint8_t

		/**
		 * 预告时间时间
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPriceForeCastTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceForeCastTime_u; //uint8_t

		/**
		 * 限购规则
		 *
		 * 版本 >= 0
		 */
		var $strTimedPriceBuyLimitRule; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceBuyLimitRule_u; //uint8_t

		/**
		 * 扩展字段
		 *
		 * 版本 >= 0
		 */
		var $mapExt; //std::map<std::string,std::string> 

		/**
		 * 版本 >= 0
		 */
		var $cExt_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->wTimedPriceIndex = 0; // uint16_t
			 $this->cTimedPriceIndex_u = 0; // uint8_t
			 $this->wTimedPriceState = 0; // uint16_t
			 $this->cTimedPriceState_u = 0; // uint8_t
			 $this->strTimedPriceName = ""; // std::string
			 $this->cTimedPriceName_u = 0; // uint8_t
			 $this->wTimedPriceCount = 0; // uint16_t
			 $this->cTimedPriceCount_u = 0; // uint8_t
			 $this->dwTimedPriceLastLong = 0; // uint32_t
			 $this->cTimedPriceLastLong_u = 0; // uint8_t
			 $this->dwTimedPriceStartTime = 0; // uint32_t
			 $this->cTimedPriceStartTime_u = 0; // uint8_t
			 $this->wTimedPriceOperationType = 0; // uint16_t
			 $this->cTimedPriceOperationType_u = 0; // uint8_t
			 $this->dwTimedPriceOperationNum = 0; // uint32_t
			 $this->cTimedPriceOperationNum_u = 0; // uint8_t
			 $this->dwTimedPriceProperty = 0; // uint32_t
			 $this->cTimedPriceProperty_u = 0; // uint8_t
			 $this->strTimedPriceCustomerPromotionRule = ""; // std::string
			 $this->cTimedPriceCustomerPromotionRule_u = 0; // uint8_t
			 $this->wTimedPriceBasePriceType = 0; // uint16_t
			 $this->cTimedPriceBasePriceType_u = 0; // uint8_t
			 $this->strTimedPricePromotionDesc = ""; // std::string
			 $this->cTimedPricePromotionDesc_u = 0; // uint8_t
			 $this->dwTimedPriceMaxUseNum = 0; // uint32_t
			 $this->cTimedPriceMaxUseNum_u = 0; // uint8_t
			 $this->strTimedPriceStoreHouse = ""; // std::string
			 $this->cTimedPriceStoreHouse_u = 0; // uint8_t
			 $this->strTimedPriceActiveId = ""; // std::string
			 $this->cTimedPriceActiveId_u = 0; // uint8_t
			 $this->dwTimedPriceCostResponse = 0; // uint32_t
			 $this->cTimedPriceCostResponse_u = 0; // uint8_t
			 $this->dwTimedPriceForeCastTime = 0; // uint32_t
			 $this->cTimedPriceForeCastTime_u = 0; // uint8_t
			 $this->strTimedPriceBuyLimitRule = ""; // std::string
			 $this->cTimedPriceBuyLimitRule_u = 0; // uint8_t
			 $this->mapExt = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
			 $this->cExt_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wTimedPriceIndex); // 序列化 timedPrice index 合法值为1-10，最大支持10个timefield的设置 其中coss最多5个(1-5)，用户5个 10个不排序 TODO: 类型为uint16_t
			$bs->pushUint8_t($this->cTimedPriceIndex_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wTimedPriceState); // 序列化多价状态 0-已审核 1-待审核 2-中止 3-删除 类型为uint16_t
			$bs->pushUint8_t($this->cTimedPriceState_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strTimedPriceName); // 序列化 规则名称 支持64个字符 类型为std::string
			$bs->pushUint8_t($this->cTimedPriceName_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wTimedPriceCount); // 序列化 timedPrice 次数,可不填，default为1次 类型为uint16_t
			$bs->pushUint8_t($this->cTimedPriceCount_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPriceLastLong); // 序列化 timedPrice 持续时间 单位s，必填 由结束时间-开始时间  类型为uint32_t
			$bs->pushUint8_t($this->cTimedPriceLastLong_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPriceStartTime); // 序列化 timedPrice 开始时间 必填 类型为uint32_t
			$bs->pushUint8_t($this->cTimedPriceStartTime_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wTimedPriceOperationType); // 序列化 timedPrice 价格操作类型，打折(精确度为10000) 扣减 覆盖 原价不变等，必填 类型为uint16_t
			$bs->pushUint8_t($this->cTimedPriceOperationType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPriceOperationNum); // 序列化 timedPrice 操作数 如操作类型为打折 此对应具体多少折扣 为价格是 单位分 必填 类型为uint32_t
			$bs->pushUint8_t($this->cTimedPriceOperationNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPriceProperty); // 序列化 timedPrice 属性 仅用于读接口 类型为uint32_t
			$bs->pushUint8_t($this->cTimedPriceProperty_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strTimedPriceCustomerPromotionRule); // 序列化 timedPrice 自定义促销规则，暂不填 类型为std::string
			$bs->pushUint8_t($this->cTimedPriceCustomerPromotionRule_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wTimedPriceBasePriceType); // 序列化 timedPrice 价格基准类型，必填 类型为uint16_t
			$bs->pushUint8_t($this->cTimedPriceBasePriceType_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strTimedPricePromotionDesc); // 序列化 促销语描述，最大支持120个字(字符) 选填 类型为std::string
			$bs->pushUint8_t($this->cTimedPricePromotionDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPriceMaxUseNum); // 序列化规则生效次数 类型为uint32_t
			$bs->pushUint8_t($this->cTimedPriceMaxUseNum_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strTimedPriceStoreHouse); // 序列化适用仓库，格式待定义 类型为std::string
			$bs->pushUint8_t($this->cTimedPriceStoreHouse_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strTimedPriceActiveId); // 序列化活动关联id，格式待定义 类型为std::string
			$bs->pushUint8_t($this->cTimedPriceActiveId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPriceCostResponse); // 序列化成本分摊人 待定义 类型为uint32_t
			$bs->pushUint8_t($this->cTimedPriceCostResponse_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPriceForeCastTime); // 序列化预告时间时间 类型为uint32_t
			$bs->pushUint8_t($this->cTimedPriceForeCastTime_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strTimedPriceBuyLimitRule); // 序列化限购规则 类型为std::string
			$bs->pushUint8_t($this->cTimedPriceBuyLimitRule_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->mapExt,'stl_map'); // 序列化扩展字段 类型为std::map<std::string,std::string> 
			$bs->pushUint8_t($this->cExt_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wTimedPriceIndex = $bs->popUint16_t(); // 反序列化 timedPrice index 合法值为1-10，最大支持10个timefield的设置 其中coss最多5个(1-5)，用户5个 10个不排序 TODO: 类型为uint16_t
			$this->cTimedPriceIndex_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wTimedPriceState = $bs->popUint16_t(); // 反序列化多价状态 0-已审核 1-待审核 2-中止 3-删除 类型为uint16_t
			$this->cTimedPriceState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strTimedPriceName = $bs->popString(); // 反序列化 规则名称 支持64个字符 类型为std::string
			$this->cTimedPriceName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wTimedPriceCount = $bs->popUint16_t(); // 反序列化 timedPrice 次数,可不填，default为1次 类型为uint16_t
			$this->cTimedPriceCount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPriceLastLong = $bs->popUint32_t(); // 反序列化 timedPrice 持续时间 单位s，必填 由结束时间-开始时间  类型为uint32_t
			$this->cTimedPriceLastLong_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPriceStartTime = $bs->popUint32_t(); // 反序列化 timedPrice 开始时间 必填 类型为uint32_t
			$this->cTimedPriceStartTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wTimedPriceOperationType = $bs->popUint16_t(); // 反序列化 timedPrice 价格操作类型，打折(精确度为10000) 扣减 覆盖 原价不变等，必填 类型为uint16_t
			$this->cTimedPriceOperationType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPriceOperationNum = $bs->popUint32_t(); // 反序列化 timedPrice 操作数 如操作类型为打折 此对应具体多少折扣 为价格是 单位分 必填 类型为uint32_t
			$this->cTimedPriceOperationNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPriceProperty = $bs->popUint32_t(); // 反序列化 timedPrice 属性 仅用于读接口 类型为uint32_t
			$this->cTimedPriceProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strTimedPriceCustomerPromotionRule = $bs->popString(); // 反序列化 timedPrice 自定义促销规则，暂不填 类型为std::string
			$this->cTimedPriceCustomerPromotionRule_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wTimedPriceBasePriceType = $bs->popUint16_t(); // 反序列化 timedPrice 价格基准类型，必填 类型为uint16_t
			$this->cTimedPriceBasePriceType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strTimedPricePromotionDesc = $bs->popString(); // 反序列化 促销语描述，最大支持120个字(字符) 选填 类型为std::string
			$this->cTimedPricePromotionDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPriceMaxUseNum = $bs->popUint32_t(); // 反序列化规则生效次数 类型为uint32_t
			$this->cTimedPriceMaxUseNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strTimedPriceStoreHouse = $bs->popString(); // 反序列化适用仓库，格式待定义 类型为std::string
			$this->cTimedPriceStoreHouse_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strTimedPriceActiveId = $bs->popString(); // 反序列化活动关联id，格式待定义 类型为std::string
			$this->cTimedPriceActiveId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPriceCostResponse = $bs->popUint32_t(); // 反序列化成本分摊人 待定义 类型为uint32_t
			$this->cTimedPriceCostResponse_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPriceForeCastTime = $bs->popUint32_t(); // 反序列化预告时间时间 类型为uint32_t
			$this->cTimedPriceForeCastTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strTimedPriceBuyLimitRule = $bs->popString(); // 反序列化限购规则 类型为std::string
			$this->cTimedPriceBuyLimitRule_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->mapExt = $bs->popObject('stl_map<stl_string,stl_string>'); // 反序列化扩展字段 类型为std::map<std::string,std::string> 
			$this->cExt_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

			/**********************为了支持多个版本的客户端************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************为了支持多个版本的客户端************************/
			

			return $this;
		}

		 function getClassLen() {
			$len_bs = new ByteStream();
			$len_bs->setRealWrite(false);
			$this->serialize_internal($len_bs);
			$class_len = $len_bs->getWrittenLength();

			return $class_len;
		}

}
}


//source idl: com.icson.multprice.idl.MultPrice4PageAo.java

if (!class_exists('MultPriceRules4PageBo',false)) {
class MultPriceRules4PageBo
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 商品id,调用方输入
		 *
		 * 版本 >= 0
		 */
		var $strItemId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cItemId_u; //uint8_t

		/**
		 * sku id ,有就写,以后可能有,选填
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 多价规则Bo,string对应场景id
		 *
		 * 版本 >= 0
		 */
		var $mapMultPrice4PageBoList; //std::map<std::string,icson::multprice::bo::CMultPrice4PageBo> 

		/**
		 * 版本 >= 0
		 */
		var $cMultPriceRuleBo_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->strItemId = ""; // std::string
			 $this->cItemId_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->mapMultPrice4PageBoList = new stl_map('stl_string,MultPrice4PageBo'); // std::map<std::string,icson::multprice::bo::CMultPrice4PageBo> 
			 $this->cMultPriceRuleBo_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strItemId); // 序列化商品id,调用方输入 类型为std::string
			$bs->pushUint8_t($this->cItemId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化sku id ,有就写,以后可能有,选填 类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->mapMultPrice4PageBoList,'stl_map'); // 序列化多价规则Bo,string对应场景id 类型为std::map<std::string,icson::multprice::bo::CMultPrice4PageBo> 
			$bs->pushUint8_t($this->cMultPriceRuleBo_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strItemId = $bs->popString(); // 反序列化商品id,调用方输入 类型为std::string
			$this->cItemId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化sku id ,有就写,以后可能有,选填 类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->mapMultPrice4PageBoList = $bs->popObject('stl_map<stl_string,MultPrice4PageBo>'); // 反序列化多价规则Bo,string对应场景id 类型为std::map<std::string,icson::multprice::bo::CMultPrice4PageBo> 
			$this->cMultPriceRuleBo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

			/**********************为了支持多个版本的客户端************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************为了支持多个版本的客户端************************/
			

			return $this;
		}

		 function getClassLen() {
			$len_bs = new ByteStream();
			$len_bs->setRealWrite(false);
			$this->serialize_internal($len_bs);
			$class_len = $len_bs->getWrittenLength();

			return $class_len;
		}

}
}


//source idl: com.icson.multprice.idl.MultPriceRules4PageBo.java

if (!class_exists('MultPrice4PageBo',false)) {
class MultPrice4PageBo
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 价格类型，0:基准价;1:场景价;2:来源价;3:积分价;4:身份价;5.来源场景价; 必填
		 *
		 * 版本 >= 0
		 */
		var $dwPriceType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceType_u; //uint8_t

		/**
		 * 价格规则索引，暂时作为存在多个价格时的选择的根据
		 *
		 * 版本 >= 0
		 */
		var $dwPriceIndex; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceIndex_u; //uint8_t

		/**
		 * skuId，必填
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 地域 id，必填
		 *
		 * 版本 >= 0
		 */
		var $dwRegionId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cRegionId_u; //uint8_t

		/**
		 * 场景 id
		 *
		 * 版本 >= 0
		 */
		var $ddwPriceSceneId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceSceneId_u; //uint8_t

		/**
		 * 来源 id
		 *
		 * 版本 >= 0
		 */
		var $ddwPriceSourceId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceSourceId_u; //uint8_t

		/**
		 * 多价成本分摊比例
		 *
		 * 版本 >= 0
		 */
		var $strPriceCostRatio; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceCostRatio_u; //uint8_t

		/**
		 * 多价规则描述，选填
		 *
		 * 版本 >= 0
		 */
		var $strPriceDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceDesc_u; //uint8_t

		/**
		 * 活动规则描述
		 *
		 * 版本 >= 0
		 */
		var $strPricePromotionDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPricePromotionDesc_u; //uint8_t

		/**
		 * 活动规则url
		 *
		 * 版本 >= 0
		 */
		var $strPricePromotionUrl; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPricePromotionUrl_u; //uint8_t

		/**
		 * 批价的基准价，单个商品，必填
		 *
		 * 版本 >= 0
		 */
		var $dwPriceBase; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceBase_u; //uint8_t

		/**
		 * 商品促销多价的优惠方式，1折扣，2减价，3定价
		 *
		 * 版本 >= 0
		 */
		var $dwPricePromoteType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPricePromoteType_u; //uint8_t

		/**
		 * 商品促销多价的操作金额，如98折传 98，减10元传 10，定价为5元传 5
		 *
		 * 版本 >= 0
		 */
		var $dwUnitPriceOpNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cUnitPriceOpNum_u; //uint8_t

		/**
		 * 该款商品的优惠前价格
		 *
		 * 版本 >= 0
		 */
		var $dwPriceBeforePromoted; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceBeforePromoted_u; //uint8_t

		/**
		 * 该款商品的优惠后价格
		 *
		 * 版本 >= 0
		 */
		var $dwPriceAfterPromoted; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceAfterPromoted_u; //uint8_t

		/**
		 * 是否限购,选填
		 *
		 * 版本 >= 0
		 */
		var $dwPriceBuyLimitFlag; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceBuyLimitFlag_u; //uint8_t

		/**
		 * 总体限购次数,选填
		 *
		 * 版本 >= 0
		 */
		var $dwPriceBuyMaxLimit; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceBuyMaxLimit_u; //uint8_t

		/**
		 * 剩余限购次数,选填
		 *
		 * 版本 >= 0
		 */
		var $dwPriceBuyRestLimit; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceBuyRestLimit_u; //uint8_t

		/**
		 * 数量维度,可实现价格阶梯 格式待定
		 *
		 * 版本 >= 0
		 */
		var $strPriceNumber; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceNumber_u; //uint8_t

		/**
		 * 时间阶梯 待定义
		 *
		 * 版本 >= 0
		 */
		var $vecTimeLadderPrice; //std::vector<icson::multprice::bo::CViewTimedPricePo> 

		/**
		 * 版本 >= 0
		 */
		var $cTimeLadderPrice_u; //uint8_t

		/**
		 * 规则开始时间，必填
		 *
		 * 版本 >= 0
		 */
		var $dwPriceStartTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceStartTime_u; //uint8_t

		/**
		 * 规则结束时间，必填
		 *
		 * 版本 >= 0
		 */
		var $dwPriceEndTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceEndTime_u; //uint8_t

		/**
		 * 预告时间
		 *
		 * 版本 >= 0
		 */
		var $dwPriceForeCastTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceForeCastTime_u; //uint8_t

		/**
		 * 扩展字段
		 *
		 * 版本 >= 0
		 */
		var $mapExt; //std::map<std::string,std::string> 

		/**
		 * 版本 >= 0
		 */
		var $cExt_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwPriceType = 0; // uint32_t
			 $this->cPriceType_u = 0; // uint8_t
			 $this->dwPriceIndex = 0; // uint32_t
			 $this->cPriceIndex_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->dwRegionId = 0; // uint32_t
			 $this->cRegionId_u = 0; // uint8_t
			 $this->ddwPriceSceneId = 0; // uint64_t
			 $this->cPriceSceneId_u = 0; // uint8_t
			 $this->ddwPriceSourceId = 0; // uint64_t
			 $this->cPriceSourceId_u = 0; // uint8_t
			 $this->strPriceCostRatio = ""; // std::string
			 $this->cPriceCostRatio_u = 0; // uint8_t
			 $this->strPriceDesc = ""; // std::string
			 $this->cPriceDesc_u = 0; // uint8_t
			 $this->strPricePromotionDesc = ""; // std::string
			 $this->cPricePromotionDesc_u = 0; // uint8_t
			 $this->strPricePromotionUrl = ""; // std::string
			 $this->cPricePromotionUrl_u = 0; // uint8_t
			 $this->dwPriceBase = 0; // uint32_t
			 $this->cPriceBase_u = 0; // uint8_t
			 $this->dwPricePromoteType = 0; // uint32_t
			 $this->cPricePromoteType_u = 0; // uint8_t
			 $this->dwUnitPriceOpNum = 0; // uint32_t
			 $this->cUnitPriceOpNum_u = 0; // uint8_t
			 $this->dwPriceBeforePromoted = 0; // uint32_t
			 $this->cPriceBeforePromoted_u = 0; // uint8_t
			 $this->dwPriceAfterPromoted = 0; // uint32_t
			 $this->cPriceAfterPromoted_u = 0; // uint8_t
			 $this->dwPriceBuyLimitFlag = 0; // uint32_t
			 $this->cPriceBuyLimitFlag_u = 0; // uint8_t
			 $this->dwPriceBuyMaxLimit = 0; // uint32_t
			 $this->cPriceBuyMaxLimit_u = 0; // uint8_t
			 $this->dwPriceBuyRestLimit = 0; // uint32_t
			 $this->cPriceBuyRestLimit_u = 0; // uint8_t
			 $this->strPriceNumber = ""; // std::string
			 $this->cPriceNumber_u = 0; // uint8_t
			 $this->vecTimeLadderPrice = new stl_vector('ViewTimedPricePo'); // std::vector<icson::multprice::bo::CViewTimedPricePo> 
			 $this->cTimeLadderPrice_u = 0; // uint8_t
			 $this->dwPriceStartTime = 0; // uint32_t
			 $this->cPriceStartTime_u = 0; // uint8_t
			 $this->dwPriceEndTime = 0; // uint32_t
			 $this->cPriceEndTime_u = 0; // uint8_t
			 $this->dwPriceForeCastTime = 0; // uint32_t
			 $this->cPriceForeCastTime_u = 0; // uint8_t
			 $this->mapExt = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
			 $this->cExt_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceType); // 序列化价格类型，0:基准价;1:场景价;2:来源价;3:积分价;4:身份价;5.来源场景价; 必填 类型为uint32_t
			$bs->pushUint8_t($this->cPriceType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceIndex); // 序列化价格规则索引，暂时作为存在多个价格时的选择的根据 类型为uint32_t
			$bs->pushUint8_t($this->cPriceIndex_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化skuId，必填 类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwRegionId); // 序列化地域 id，必填 类型为uint32_t
			$bs->pushUint8_t($this->cRegionId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwPriceSceneId); // 序列化场景 id 类型为uint64_t
			$bs->pushUint8_t($this->cPriceSceneId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwPriceSourceId); // 序列化来源 id 类型为uint64_t
			$bs->pushUint8_t($this->cPriceSourceId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceCostRatio); // 序列化多价成本分摊比例 类型为std::string
			$bs->pushUint8_t($this->cPriceCostRatio_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceDesc); // 序列化多价规则描述，选填 类型为std::string
			$bs->pushUint8_t($this->cPriceDesc_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPricePromotionDesc); // 序列化活动规则描述 类型为std::string
			$bs->pushUint8_t($this->cPricePromotionDesc_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPricePromotionUrl); // 序列化活动规则url 类型为std::string
			$bs->pushUint8_t($this->cPricePromotionUrl_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceBase); // 序列化批价的基准价，单个商品，必填 类型为uint32_t
			$bs->pushUint8_t($this->cPriceBase_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPricePromoteType); // 序列化商品促销多价的优惠方式，1折扣，2减价，3定价 类型为uint32_t
			$bs->pushUint8_t($this->cPricePromoteType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwUnitPriceOpNum); // 序列化商品促销多价的操作金额，如98折传 98，减10元传 10，定价为5元传 5 类型为uint32_t
			$bs->pushUint8_t($this->cUnitPriceOpNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceBeforePromoted); // 序列化该款商品的优惠前价格 类型为uint32_t
			$bs->pushUint8_t($this->cPriceBeforePromoted_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceAfterPromoted); // 序列化该款商品的优惠后价格 类型为uint32_t
			$bs->pushUint8_t($this->cPriceAfterPromoted_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceBuyLimitFlag); // 序列化是否限购,选填 类型为uint32_t
			$bs->pushUint8_t($this->cPriceBuyLimitFlag_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceBuyMaxLimit); // 序列化总体限购次数,选填 类型为uint32_t
			$bs->pushUint8_t($this->cPriceBuyMaxLimit_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceBuyRestLimit); // 序列化剩余限购次数,选填 类型为uint32_t
			$bs->pushUint8_t($this->cPriceBuyRestLimit_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceNumber); // 序列化数量维度,可实现价格阶梯 格式待定 类型为std::string
			$bs->pushUint8_t($this->cPriceNumber_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecTimeLadderPrice,'stl_vector'); // 序列化时间阶梯 待定义 类型为std::vector<icson::multprice::bo::CViewTimedPricePo> 
			$bs->pushUint8_t($this->cTimeLadderPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceStartTime); // 序列化规则开始时间，必填 类型为uint32_t
			$bs->pushUint8_t($this->cPriceStartTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceEndTime); // 序列化规则结束时间，必填 类型为uint32_t
			$bs->pushUint8_t($this->cPriceEndTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceForeCastTime); // 序列化预告时间 类型为uint32_t
			$bs->pushUint8_t($this->cPriceForeCastTime_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->mapExt,'stl_map'); // 序列化扩展字段 类型为std::map<std::string,std::string> 
			$bs->pushUint8_t($this->cExt_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceType = $bs->popUint32_t(); // 反序列化价格类型，0:基准价;1:场景价;2:来源价;3:积分价;4:身份价;5.来源场景价; 必填 类型为uint32_t
			$this->cPriceType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceIndex = $bs->popUint32_t(); // 反序列化价格规则索引，暂时作为存在多个价格时的选择的根据 类型为uint32_t
			$this->cPriceIndex_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化skuId，必填 类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRegionId = $bs->popUint32_t(); // 反序列化地域 id，必填 类型为uint32_t
			$this->cRegionId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwPriceSceneId = $bs->popUint64_t(); // 反序列化场景 id 类型为uint64_t
			$this->cPriceSceneId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwPriceSourceId = $bs->popUint64_t(); // 反序列化来源 id 类型为uint64_t
			$this->cPriceSourceId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceCostRatio = $bs->popString(); // 反序列化多价成本分摊比例 类型为std::string
			$this->cPriceCostRatio_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceDesc = $bs->popString(); // 反序列化多价规则描述，选填 类型为std::string
			$this->cPriceDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPricePromotionDesc = $bs->popString(); // 反序列化活动规则描述 类型为std::string
			$this->cPricePromotionDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPricePromotionUrl = $bs->popString(); // 反序列化活动规则url 类型为std::string
			$this->cPricePromotionUrl_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceBase = $bs->popUint32_t(); // 反序列化批价的基准价，单个商品，必填 类型为uint32_t
			$this->cPriceBase_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPricePromoteType = $bs->popUint32_t(); // 反序列化商品促销多价的优惠方式，1折扣，2减价，3定价 类型为uint32_t
			$this->cPricePromoteType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwUnitPriceOpNum = $bs->popUint32_t(); // 反序列化商品促销多价的操作金额，如98折传 98，减10元传 10，定价为5元传 5 类型为uint32_t
			$this->cUnitPriceOpNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceBeforePromoted = $bs->popUint32_t(); // 反序列化该款商品的优惠前价格 类型为uint32_t
			$this->cPriceBeforePromoted_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceAfterPromoted = $bs->popUint32_t(); // 反序列化该款商品的优惠后价格 类型为uint32_t
			$this->cPriceAfterPromoted_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceBuyLimitFlag = $bs->popUint32_t(); // 反序列化是否限购,选填 类型为uint32_t
			$this->cPriceBuyLimitFlag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceBuyMaxLimit = $bs->popUint32_t(); // 反序列化总体限购次数,选填 类型为uint32_t
			$this->cPriceBuyMaxLimit_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceBuyRestLimit = $bs->popUint32_t(); // 反序列化剩余限购次数,选填 类型为uint32_t
			$this->cPriceBuyRestLimit_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceNumber = $bs->popString(); // 反序列化数量维度,可实现价格阶梯 格式待定 类型为std::string
			$this->cPriceNumber_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecTimeLadderPrice = $bs->popObject('stl_vector<ViewTimedPricePo>'); // 反序列化时间阶梯 待定义 类型为std::vector<icson::multprice::bo::CViewTimedPricePo> 
			$this->cTimeLadderPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceStartTime = $bs->popUint32_t(); // 反序列化规则开始时间，必填 类型为uint32_t
			$this->cPriceStartTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceEndTime = $bs->popUint32_t(); // 反序列化规则结束时间，必填 类型为uint32_t
			$this->cPriceEndTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceForeCastTime = $bs->popUint32_t(); // 反序列化预告时间 类型为uint32_t
			$this->cPriceForeCastTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->mapExt = $bs->popObject('stl_map<stl_string,stl_string>'); // 反序列化扩展字段 类型为std::map<std::string,std::string> 
			$this->cExt_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

			/**********************为了支持多个版本的客户端************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************为了支持多个版本的客户端************************/
			

			return $this;
		}

		 function getClassLen() {
			$len_bs = new ByteStream();
			$len_bs->setRealWrite(false);
			$this->serialize_internal($len_bs);
			$class_len = $len_bs->getWrittenLength();

			return $class_len;
		}

}
}


//source idl: com.icson.multprice.idl.MultPrice4PageAo.java

if (!class_exists('MultPriceItem4PageBo',false)) {
class MultPriceItem4PageBo
{
		/**
		 *  版本号 
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 商品id,调用方输入
		 *
		 * 版本 >= 0
		 */
		var $strItemId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cItemId_u; //uint8_t

		/**
		 * sku id ,有就写,以后可能有
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * activeid,活动id用于获取场景价,必填
		 *
		 * 版本 >= 0
		 */
		var $ddwActiveid; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cActiveid_u; //uint8_t

		/**
		 * isAll,是否取所有类型的价格 1:是 0:否 必填
		 *
		 * 版本 >= 0
		 */
		var $dwIsAll; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cIsAll_u; //uint8_t

		/**
		 * isStockNum,是否取库存 1:是 0:否 必填，即使选了取库存也还得鉴权
		 *
		 * 版本 >= 0
		 */
		var $dwIsStockNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cIsStockNum_u; //uint8_t

		/**
		 * 格式SourceId:SceneId,附加价格类型，调用方输入
		 *
		 * 版本 >= 0
		 */
		var $vecAddtionPriceType; //std::vector<std::string> 

		/**
		 * 版本 >= 0
		 */
		var $cAddtionPriceType_u; //uint8_t

		/**
		 * 价格生效开始时间,调用方输入
		 *
		 * 版本 >= 0
		 */
		var $dwPriceStartTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceStartTime_u; //uint8_t

		/**
		 * 价格生效结束时间,调用方输入
		 *
		 * 版本 >= 0
		 */
		var $dwPriceEndTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceEndTime_u; //uint8_t

		/**
		 * 扩展字段
		 *
		 * 版本 >= 0
		 */
		var $mapExt; //std::map<std::string,std::string> 

		/**
		 * 版本 >= 0
		 */
		var $cExt_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->strItemId = ""; // std::string
			 $this->cItemId_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->ddwActiveid = 0; // uint64_t
			 $this->cActiveid_u = 0; // uint8_t
			 $this->dwIsAll = 0; // uint32_t
			 $this->cIsAll_u = 0; // uint8_t
			 $this->dwIsStockNum = 0; // uint32_t
			 $this->cIsStockNum_u = 0; // uint8_t
			 $this->vecAddtionPriceType = new stl_vector('stl_string'); // std::vector<std::string> 
			 $this->cAddtionPriceType_u = 0; // uint8_t
			 $this->dwPriceStartTime = 0; // uint32_t
			 $this->cPriceStartTime_u = 0; // uint8_t
			 $this->dwPriceEndTime = 0; // uint32_t
			 $this->cPriceEndTime_u = 0; // uint8_t
			 $this->mapExt = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
			 $this->cExt_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号  类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strItemId); // 序列化商品id,调用方输入 类型为std::string
			$bs->pushUint8_t($this->cItemId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化sku id ,有就写,以后可能有 类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwActiveid); // 序列化activeid,活动id用于获取场景价,必填 类型为uint64_t
			$bs->pushUint8_t($this->cActiveid_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwIsAll); // 序列化isAll,是否取所有类型的价格 1:是 0:否 必填 类型为uint32_t
			$bs->pushUint8_t($this->cIsAll_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwIsStockNum); // 序列化isStockNum,是否取库存 1:是 0:否 必填，即使选了取库存也还得鉴权 类型为uint32_t
			$bs->pushUint8_t($this->cIsStockNum_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecAddtionPriceType,'stl_vector'); // 序列化格式SourceId:SceneId,附加价格类型，调用方输入 类型为std::vector<std::string> 
			$bs->pushUint8_t($this->cAddtionPriceType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceStartTime); // 序列化价格生效开始时间,调用方输入 类型为uint32_t
			$bs->pushUint8_t($this->cPriceStartTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceEndTime); // 序列化价格生效结束时间,调用方输入 类型为uint32_t
			$bs->pushUint8_t($this->cPriceEndTime_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->mapExt,'stl_map'); // 序列化扩展字段 类型为std::map<std::string,std::string> 
			$bs->pushUint8_t($this->cExt_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号  类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strItemId = $bs->popString(); // 反序列化商品id,调用方输入 类型为std::string
			$this->cItemId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化sku id ,有就写,以后可能有 类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwActiveid = $bs->popUint64_t(); // 反序列化activeid,活动id用于获取场景价,必填 类型为uint64_t
			$this->cActiveid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwIsAll = $bs->popUint32_t(); // 反序列化isAll,是否取所有类型的价格 1:是 0:否 必填 类型为uint32_t
			$this->cIsAll_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwIsStockNum = $bs->popUint32_t(); // 反序列化isStockNum,是否取库存 1:是 0:否 必填，即使选了取库存也还得鉴权 类型为uint32_t
			$this->cIsStockNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecAddtionPriceType = $bs->popObject('stl_vector<stl_string>'); // 反序列化格式SourceId:SceneId,附加价格类型，调用方输入 类型为std::vector<std::string> 
			$this->cAddtionPriceType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceStartTime = $bs->popUint32_t(); // 反序列化价格生效开始时间,调用方输入 类型为uint32_t
			$this->cPriceStartTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceEndTime = $bs->popUint32_t(); // 反序列化价格生效结束时间,调用方输入 类型为uint32_t
			$this->cPriceEndTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->mapExt = $bs->popObject('stl_map<stl_string,stl_string>'); // 反序列化扩展字段 类型为std::map<std::string,std::string> 
			$this->cExt_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

			/**********************为了支持多个版本的客户端************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************为了支持多个版本的客户端************************/
			

			return $this;
		}

		 function getClassLen() {
			$len_bs = new ByteStream();
			$len_bs->setRealWrite(false);
			$this->serialize_internal($len_bs);
			$class_len = $len_bs->getWrittenLength();

			return $class_len;
		}

}
}

?>