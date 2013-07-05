<?php

//source idl: com.icson.sps.idl.SpsBaseinfo.java

//if (!class_exists('MultPriceBo')) {
class MultPriceBo
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
		 * 价格类型，预留，暂时不用 
		 *
		 * 版本 >= 0
		 */
		var $dwPriceType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceType_u; //uint8_t

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
		 * 多价规则名称描述，选填 
		 *
		 * 版本 >= 0
		 */
		var $strPriceName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceName_u; //uint8_t

		/**
		 * 价格规则描述 
		 *
		 * 版本 >= 0
		 */
		var $strPriceDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceDesc_u; //uint8_t

		/**
		 * 活动规则url，暂时不用 
		 *
		 * 版本 >= 0
		 */
		var $strPricePromotionUrl; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPricePromotionUrl_u; //uint8_t

		/**
		 * 批价的基准价类型，单个商品，预留 
		 *
		 * 版本 >= 0
		 */
		var $dwPriceBase; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceBase_u; //uint8_t

		/**
		 * 商品促销多价的优惠方式，1定价，2减价，3折扣 
		 *
		 * 版本 >= 0
		 */
		var $wPriceOpType; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceOpType_u; //uint8_t

		/**
		 * 商品促销多价的操作金额，不考虑商品数量，如98折传 98，减10元传 10，定价为5元传 5 
		 *
		 * 版本 >= 0
		 */
		var $dwUnitPriceOpNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cUnitPriceOpNum_u; //uint8_t

		/**
		 * 该款商品的优惠前价格，有n件商品，则为n件总值 
		 *
		 * 版本 >= 0
		 */
		var $dwPriceBeforeFavor; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceBeforeFavor_u; //uint8_t

		/**
		 * 该款商品的优惠后价格，有n件商品，则为n件总值 
		 *
		 * 版本 >= 0
		 */
		var $dwPriceAfterFavor; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceAfterFavor_u; //uint8_t

		/**
		 * 该款商品总优惠的金额，必填 
		 *
		 * 版本 >= 0
		 */
		var $dwPriceDiscount; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceDiscount_u; //uint8_t

		/**
		 * 单个商品优惠前价格，即不考虑商品数量 
		 *
		 * 版本 >= 0
		 */
		var $dwUnitPriceBeforeFavor; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cUnitPriceBeforeFavor_u; //uint8_t

		/**
		 * 单个商品多价优惠后的价价格，即不考虑商品数量 
		 *
		 * 版本 >= 0
		 */
		var $dwUnitPriceAfterFavor; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cUnitPriceAfterFavor_u; //uint8_t

		/**
		 * 单个商品多价的优惠金额，即不考虑商品数量 
		 *
		 * 版本 >= 0
		 */
		var $dwUnitPriceDiscount; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cUnitPriceDiscount_u; //uint8_t

		/**
		 * 该款商品非节能补贴的优惠金额，必填 
		 *
		 * 版本 >= 0
		 */
		var $dwMultPriceDiscount; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cMultPriceDiscount_u; //uint8_t

		/**
		 * 该款商品节能补贴的优惠金额，必填 
		 *
		 * 版本 >= 0
		 */
		var $dwEnergySaveDiscount; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cEnergySaveDiscount_u; //uint8_t

		/**
		 * 节能补贴名称，选填 
		 *
		 * 版本 >= 0
		 */
		var $strEnergySaveName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cEnergySaveName_u; //uint8_t

		/**
		 * 节能补贴描述 
		 *
		 * 版本 >= 0
		 */
		var $strEnergySaveDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cEnergySaveDesc_u; //uint8_t

		/**
		 * 价格规则，目前仅阶梯价使用 
		 *
		 * 版本 >= 0
		 */
		var $strPriceRule; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceRule_u; //uint8_t

		/**
		 * 阶梯价差额数，即差X件，可享受阶梯规则，如大于0，则可用于展示 
		 *
		 * 版本 >= 0
		 */
		var $dwNeedNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cNeedNum_u; //uint8_t

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
		 * 限购规则 
		 *
		 * 版本 >= 0
		 */
		var $strPriceBuyLimitRule; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceBuyLimitRule_u; //uint8_t

		/**
		 * 限制标志位，超过限购时为1，表示商品不可购买 
		 *
		 * 版本 >= 0
		 */
		var $dwPriceBuyLimitFlag; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceBuyLimitFlag_u; //uint8_t

		/**
		 * 商品剩余的限购数量 
		 *
		 * 版本 >= 0
		 */
		var $dwPriceBuyLimitNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceBuyLimitNum_u; //uint8_t

		/**
		 * 成本分摊人 
		 *
		 * 版本 >= 0
		 */
		var $dwPriceCoster; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceCoster_u; //uint8_t

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
			 $this->ddwPriceSceneId = 0; // uint64_t
			 $this->cPriceSceneId_u = 0; // uint8_t
			 $this->ddwPriceSourceId = 0; // uint64_t
			 $this->cPriceSourceId_u = 0; // uint8_t
			 $this->strPriceName = ""; // std::string
			 $this->cPriceName_u = 0; // uint8_t
			 $this->strPriceDesc = ""; // std::string
			 $this->cPriceDesc_u = 0; // uint8_t
			 $this->strPricePromotionUrl = ""; // std::string
			 $this->cPricePromotionUrl_u = 0; // uint8_t
			 $this->dwPriceBase = 0; // uint32_t
			 $this->cPriceBase_u = 0; // uint8_t
			 $this->wPriceOpType = 0; // uint16_t
			 $this->cPriceOpType_u = 0; // uint8_t
			 $this->dwUnitPriceOpNum = 0; // uint32_t
			 $this->cUnitPriceOpNum_u = 0; // uint8_t
			 $this->dwPriceBeforeFavor = 0; // uint32_t
			 $this->cPriceBeforeFavor_u = 0; // uint8_t
			 $this->dwPriceAfterFavor = 0; // uint32_t
			 $this->cPriceAfterFavor_u = 0; // uint8_t
			 $this->dwPriceDiscount = 0; // uint32_t
			 $this->cPriceDiscount_u = 0; // uint8_t
			 $this->dwUnitPriceBeforeFavor = 0; // uint32_t
			 $this->cUnitPriceBeforeFavor_u = 0; // uint8_t
			 $this->dwUnitPriceAfterFavor = 0; // uint32_t
			 $this->cUnitPriceAfterFavor_u = 0; // uint8_t
			 $this->dwUnitPriceDiscount = 0; // uint32_t
			 $this->cUnitPriceDiscount_u = 0; // uint8_t
			 $this->dwMultPriceDiscount = 0; // uint32_t
			 $this->cMultPriceDiscount_u = 0; // uint8_t
			 $this->dwEnergySaveDiscount = 0; // uint32_t
			 $this->cEnergySaveDiscount_u = 0; // uint8_t
			 $this->strEnergySaveName = ""; // std::string
			 $this->cEnergySaveName_u = 0; // uint8_t
			 $this->strEnergySaveDesc = ""; // std::string
			 $this->cEnergySaveDesc_u = 0; // uint8_t
			 $this->strPriceRule = ""; // std::string
			 $this->cPriceRule_u = 0; // uint8_t
			 $this->dwNeedNum = 0; // uint32_t
			 $this->cNeedNum_u = 0; // uint8_t
			 $this->dwPriceStartTime = 0; // uint32_t
			 $this->cPriceStartTime_u = 0; // uint8_t
			 $this->dwPriceEndTime = 0; // uint32_t
			 $this->cPriceEndTime_u = 0; // uint8_t
			 $this->strPriceBuyLimitRule = ""; // std::string
			 $this->cPriceBuyLimitRule_u = 0; // uint8_t
			 $this->dwPriceBuyLimitFlag = 0; // uint32_t
			 $this->cPriceBuyLimitFlag_u = 0; // uint8_t
			 $this->dwPriceBuyLimitNum = 0; // uint32_t
			 $this->cPriceBuyLimitNum_u = 0; // uint8_t
			 $this->dwPriceCoster = 0; // uint32_t
			 $this->cPriceCoster_u = 0; // uint8_t
			 $this->mapExt = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
			 $this->cExt_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号  类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceType); // 序列化价格类型，预留，暂时不用  类型为uint32_t
			$bs->pushUint8_t($this->cPriceType_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwPriceSceneId); // 序列化场景 id  类型为uint64_t
			$bs->pushUint8_t($this->cPriceSceneId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwPriceSourceId); // 序列化来源 id  类型为uint64_t
			$bs->pushUint8_t($this->cPriceSourceId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceName); // 序列化多价规则名称描述，选填  类型为std::string
			$bs->pushUint8_t($this->cPriceName_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceDesc); // 序列化价格规则描述  类型为std::string
			$bs->pushUint8_t($this->cPriceDesc_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPricePromotionUrl); // 序列化活动规则url，暂时不用  类型为std::string
			$bs->pushUint8_t($this->cPricePromotionUrl_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceBase); // 序列化批价的基准价类型，单个商品，预留  类型为uint32_t
			$bs->pushUint8_t($this->cPriceBase_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wPriceOpType); // 序列化商品促销多价的优惠方式，1定价，2减价，3折扣  类型为uint16_t
			$bs->pushUint8_t($this->cPriceOpType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwUnitPriceOpNum); // 序列化商品促销多价的操作金额，不考虑商品数量，如98折传 98，减10元传 10，定价为5元传 5  类型为uint32_t
			$bs->pushUint8_t($this->cUnitPriceOpNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceBeforeFavor); // 序列化该款商品的优惠前价格，有n件商品，则为n件总值  类型为uint32_t
			$bs->pushUint8_t($this->cPriceBeforeFavor_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceAfterFavor); // 序列化该款商品的优惠后价格，有n件商品，则为n件总值  类型为uint32_t
			$bs->pushUint8_t($this->cPriceAfterFavor_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceDiscount); // 序列化该款商品总优惠的金额，必填  类型为uint32_t
			$bs->pushUint8_t($this->cPriceDiscount_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwUnitPriceBeforeFavor); // 序列化单个商品优惠前价格，即不考虑商品数量  类型为uint32_t
			$bs->pushUint8_t($this->cUnitPriceBeforeFavor_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwUnitPriceAfterFavor); // 序列化单个商品多价优惠后的价价格，即不考虑商品数量  类型为uint32_t
			$bs->pushUint8_t($this->cUnitPriceAfterFavor_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwUnitPriceDiscount); // 序列化单个商品多价的优惠金额，即不考虑商品数量  类型为uint32_t
			$bs->pushUint8_t($this->cUnitPriceDiscount_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwMultPriceDiscount); // 序列化该款商品非节能补贴的优惠金额，必填  类型为uint32_t
			$bs->pushUint8_t($this->cMultPriceDiscount_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwEnergySaveDiscount); // 序列化该款商品节能补贴的优惠金额，必填  类型为uint32_t
			$bs->pushUint8_t($this->cEnergySaveDiscount_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strEnergySaveName); // 序列化节能补贴名称，选填  类型为std::string
			$bs->pushUint8_t($this->cEnergySaveName_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strEnergySaveDesc); // 序列化节能补贴描述  类型为std::string
			$bs->pushUint8_t($this->cEnergySaveDesc_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceRule); // 序列化价格规则，目前仅阶梯价使用  类型为std::string
			$bs->pushUint8_t($this->cPriceRule_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwNeedNum); // 序列化阶梯价差额数，即差X件，可享受阶梯规则，如大于0，则可用于展示  类型为uint32_t
			$bs->pushUint8_t($this->cNeedNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceStartTime); // 序列化规则开始时间，必填  类型为uint32_t
			$bs->pushUint8_t($this->cPriceStartTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceEndTime); // 序列化规则结束时间，必填  类型为uint32_t
			$bs->pushUint8_t($this->cPriceEndTime_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceBuyLimitRule); // 序列化限购规则  类型为std::string
			$bs->pushUint8_t($this->cPriceBuyLimitRule_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceBuyLimitFlag); // 序列化限制标志位，超过限购时为1，表示商品不可购买  类型为uint32_t
			$bs->pushUint8_t($this->cPriceBuyLimitFlag_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceBuyLimitNum); // 序列化商品剩余的限购数量  类型为uint32_t
			$bs->pushUint8_t($this->cPriceBuyLimitNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceCoster); // 序列化成本分摊人  类型为uint32_t
			$bs->pushUint8_t($this->cPriceCoster_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->mapExt, 'stl_map'); // 序列化扩展字段 类型为std::map<std::string,std::string> 
			$bs->pushUint8_t($this->cExt_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号  类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceType = $bs->popUint32_t(); // 反序列化价格类型，预留，暂时不用  类型为uint32_t
			$this->cPriceType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwPriceSceneId = $bs->popUint64_t(); // 反序列化场景 id  类型为uint64_t
			$this->cPriceSceneId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwPriceSourceId = $bs->popUint64_t(); // 反序列化来源 id  类型为uint64_t
			$this->cPriceSourceId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceName = $bs->popString(); // 反序列化多价规则名称描述，选填  类型为std::string
			$this->cPriceName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceDesc = $bs->popString(); // 反序列化价格规则描述  类型为std::string
			$this->cPriceDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPricePromotionUrl = $bs->popString(); // 反序列化活动规则url，暂时不用  类型为std::string
			$this->cPricePromotionUrl_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceBase = $bs->popUint32_t(); // 反序列化批价的基准价类型，单个商品，预留  类型为uint32_t
			$this->cPriceBase_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wPriceOpType = $bs->popUint16_t(); // 反序列化商品促销多价的优惠方式，1定价，2减价，3折扣  类型为uint16_t
			$this->cPriceOpType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwUnitPriceOpNum = $bs->popUint32_t(); // 反序列化商品促销多价的操作金额，不考虑商品数量，如98折传 98，减10元传 10，定价为5元传 5  类型为uint32_t
			$this->cUnitPriceOpNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceBeforeFavor = $bs->popUint32_t(); // 反序列化该款商品的优惠前价格，有n件商品，则为n件总值  类型为uint32_t
			$this->cPriceBeforeFavor_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceAfterFavor = $bs->popUint32_t(); // 反序列化该款商品的优惠后价格，有n件商品，则为n件总值  类型为uint32_t
			$this->cPriceAfterFavor_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceDiscount = $bs->popUint32_t(); // 反序列化该款商品总优惠的金额，必填  类型为uint32_t
			$this->cPriceDiscount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwUnitPriceBeforeFavor = $bs->popUint32_t(); // 反序列化单个商品优惠前价格，即不考虑商品数量  类型为uint32_t
			$this->cUnitPriceBeforeFavor_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwUnitPriceAfterFavor = $bs->popUint32_t(); // 反序列化单个商品多价优惠后的价价格，即不考虑商品数量  类型为uint32_t
			$this->cUnitPriceAfterFavor_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwUnitPriceDiscount = $bs->popUint32_t(); // 反序列化单个商品多价的优惠金额，即不考虑商品数量  类型为uint32_t
			$this->cUnitPriceDiscount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwMultPriceDiscount = $bs->popUint32_t(); // 反序列化该款商品非节能补贴的优惠金额，必填  类型为uint32_t
			$this->cMultPriceDiscount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwEnergySaveDiscount = $bs->popUint32_t(); // 反序列化该款商品节能补贴的优惠金额，必填  类型为uint32_t
			$this->cEnergySaveDiscount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strEnergySaveName = $bs->popString(); // 反序列化节能补贴名称，选填  类型为std::string
			$this->cEnergySaveName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strEnergySaveDesc = $bs->popString(); // 反序列化节能补贴描述  类型为std::string
			$this->cEnergySaveDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceRule = $bs->popString(); // 反序列化价格规则，目前仅阶梯价使用  类型为std::string
			$this->cPriceRule_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwNeedNum = $bs->popUint32_t(); // 反序列化阶梯价差额数，即差X件，可享受阶梯规则，如大于0，则可用于展示  类型为uint32_t
			$this->cNeedNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceStartTime = $bs->popUint32_t(); // 反序列化规则开始时间，必填  类型为uint32_t
			$this->cPriceStartTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceEndTime = $bs->popUint32_t(); // 反序列化规则结束时间，必填  类型为uint32_t
			$this->cPriceEndTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceBuyLimitRule = $bs->popString(); // 反序列化限购规则  类型为std::string
			$this->cPriceBuyLimitRule_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceBuyLimitFlag = $bs->popUint32_t(); // 反序列化限制标志位，超过限购时为1，表示商品不可购买  类型为uint32_t
			$this->cPriceBuyLimitFlag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceBuyLimitNum = $bs->popUint32_t(); // 反序列化商品剩余的限购数量  类型为uint32_t
			$this->cPriceBuyLimitNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceCoster = $bs->popUint32_t(); // 反序列化成本分摊人  类型为uint32_t
			$this->cPriceCoster_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->mapExt = $bs->popObject('stl_map<stl_string,stl_string> '); // 反序列化扩展字段 类型为std::map<std::string,std::string> 
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
//}


//source idl: com.icson.sps.idl.SpsBaseinfo.java

//if (!class_exists('SpsItemBo')) {
class SpsItemBo
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
		 * 商品id，调用方输入
		 *
		 * 版本 >= 0
		 */
		var $strItemId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cItemId_u; //uint8_t

		/**
		 * 商品品类id,调用方输入,有就填写，就是易讯的小类
		 *
		 * 版本 >= 0
		 */
		var $dwMetaId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cMetaId_u; //uint8_t

		/**
		 * 卖家id,调用方输入,以后可能要用，现在可不填
		 *
		 * 版本 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * 品牌id,调用方输入，有就填进来哈
		 *
		 * 版本 >= 0
		 */
		var $ddwBrand; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cBrand_u; //uint8_t

		/**
		 * SKUID，以后可能用
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 商品仓id，调用方传入
		 *
		 * 版本 >= 0
		 */
		var $dwItemWareHouseid; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cItemWareHouseid_u; //uint8_t

		/**
		 * 价格来源id及场景id, 字符串格式为来源id|场景id
		 *
		 * 版本 >= 0
		 */
		var $setPriceSourceScene; //std::set<std::string> 

		/**
		 * 版本 >= 0
		 */
		var $cPriceSourceScene_u; //uint8_t

		/**
		 * edm代码,调用方输入[多价新增]
		 *
		 * 版本 >= 0
		 */
		var $setEdmCode; //std::set<std::string> 

		/**
		 * 版本 >= 0
		 */
		var $cEdmCode_u; //uint8_t

		/**
		 * 活动id,调用方输入，暂时不用
		 *
		 * 版本 >= 0
		 */
		var $setActId; //std::set<uint32_t> 

		/**
		 * 版本 >= 0
		 */
		var $cActId_u; //uint8_t

		/**
		 * 商品促销批价前价格,n件商品，即为n件之和，这里注意，如果在促销之前有其他优惠减价，要传入的是优惠后价格
		 *
		 * 版本 >= 0
		 */
		var $dwItemPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cItemPrice_u; //uint8_t

		/**
		 * 商品促销批价前单价,不考虑商品件数，调用方输入 
		 *
		 * 版本 >= 0
		 */
		var $dwItemUnitPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cItemUnitPrice_u; //uint8_t

		/**
		 * 分摊到商品维度的优惠券优惠金额,调用方输入 
		 *
		 * 版本 >= 0
		 */
		var $dwItemCouponDiscount; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cItemCouponDiscount_u; //uint8_t

		/**
		 * 商品数量,调用方输入 
		 *
		 * 版本 >= 0
		 */
		var $dwItemNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cItemNum_u; //uint8_t

		/**
		 * 套餐id,调用方输入,最好填上 
		 *
		 * 版本 >= 0
		 */
		var $dwPkgId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPkgId_u; //uint8_t

		/**
		 * 商品类型：0为普通商品，1为套餐赠品等，标识是否为套餐商品或赠品等，根据商品系统确定，调用方输入,一定要填写 
		 *
		 * 版本 >= 0
		 */
		var $dwItemType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cItemType_u; //uint8_t

		/**
		 * 商品类目id Vector,内部使用，目前就3个，大中小类 
		 *
		 * 版本 >= 0
		 */
		var $vecItemCategoryIdList; //std::vector<uint64_t> 

		/**
		 * 版本 >= 0
		 */
		var $cItemCategoryIdList_u; //uint8_t

		/**
		 * 满立减/赠后价格,满送券的记录在批价路径上 
		 *
		 * 版本 >= 0
		 */
		var $dwItemFullMinusPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cItemFullMinusPrice_u; //uint8_t

		/**
		 * 满立减/赠折扣 
		 *
		 * 版本 >= 0
		 */
		var $dwItemFullMinusDiscount; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cItemFullMinusDiscount_u; //uint8_t

		/**
		 * 满加价购后价格,一期不用 
		 *
		 * 版本 >= 0
		 */
		var $dwItemFullAddPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cItemFullAddPrice_u; //uint8_t

		/**
		 * 满加价购优惠，一期不用 
		 *
		 * 版本 >= 0
		 */
		var $dwItemFullAddDiscount; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cItemFullAddDiscount_u; //uint8_t

		/**
		 * 操作路径列表 
		 *
		 * 版本 >= 0
		 */
		var $vecSpsItemOpPathList; //std::vector<icson::promotion::bo::CSpsItemOpPathBo> 

		/**
		 * 版本 >= 0
		 */
		var $cSpsItemOpPathList_u; //uint8_t

		/**
		 * 商品促销后价格,接口输出，就是输出的优惠价格 
		 *
		 * 版本 >= 0
		 */
		var $dwItemPromotionPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cItemPromotionPrice_u; //uint8_t

		/**
		 * 商品促销优惠,接口输出 
		 *
		 * 版本 >= 0
		 */
		var $dwItemPromotionDiscount; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cItemPromotionDiscount_u; //uint8_t

		/**
		 * 该商品是否包邮，1不包邮，2包邮，接口输出,一期不管 
		 *
		 * 版本 >= 0
		 */
		var $dwItemMailFree; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cItemMailFree_u; //uint8_t

		/**
		 * 商品的多价list [多价使用]，购物流程vector只有一个元素 
		 *
		 * 版本 >= 0
		 */
		var $vecPriceInfoList; //std::vector<icson::multprice::bo::CMultPriceBo> 

		/**
		 * 版本 >= 0
		 */
		var $cPriceInfoList_u; //uint8_t

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
			 $this->dwMetaId = 0; // uint32_t
			 $this->cMetaId_u = 0; // uint8_t
			 $this->ddwSellerId = 0; // uint64_t
			 $this->cSellerId_u = 0; // uint8_t
			 $this->ddwBrand = 0; // uint64_t
			 $this->cBrand_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->dwItemWareHouseid = 0; // uint32_t
			 $this->cItemWareHouseid_u = 0; // uint8_t
			 $this->setPriceSourceScene = new stl_set('stl_string'); // std::set<std::string> 
			 $this->cPriceSourceScene_u = 0; // uint8_t
			 $this->setEdmCode = new stl_set('stl_string'); // std::set<std::string> 
			 $this->cEdmCode_u = 0; // uint8_t
			 $this->setActId = new stl_set('uint32_t'); // std::set<uint32_t> 
			 $this->cActId_u = 0; // uint8_t
			 $this->dwItemPrice = 0; // uint32_t
			 $this->cItemPrice_u = 0; // uint8_t
			 $this->dwItemUnitPrice = 0; // uint32_t
			 $this->cItemUnitPrice_u = 0; // uint8_t
			 $this->dwItemCouponDiscount = 0; // uint32_t
			 $this->cItemCouponDiscount_u = 0; // uint8_t
			 $this->dwItemNum = 0; // uint32_t
			 $this->cItemNum_u = 0; // uint8_t
			 $this->dwPkgId = 0; // uint32_t
			 $this->cPkgId_u = 0; // uint8_t
			 $this->dwItemType = 0; // uint32_t
			 $this->cItemType_u = 0; // uint8_t
			 $this->vecItemCategoryIdList = new stl_vector('uint64_t'); // std::vector<uint64_t> 
			 $this->cItemCategoryIdList_u = 0; // uint8_t
			 $this->dwItemFullMinusPrice = 0; // uint32_t
			 $this->cItemFullMinusPrice_u = 0; // uint8_t
			 $this->dwItemFullMinusDiscount = 0; // uint32_t
			 $this->cItemFullMinusDiscount_u = 0; // uint8_t
			 $this->dwItemFullAddPrice = 0; // uint32_t
			 $this->cItemFullAddPrice_u = 0; // uint8_t
			 $this->dwItemFullAddDiscount = 0; // uint32_t
			 $this->cItemFullAddDiscount_u = 0; // uint8_t
			 $this->vecSpsItemOpPathList = new stl_vector('SpsItemOpPathBo'); // std::vector<icson::promotion::bo::CSpsItemOpPathBo> 
			 $this->cSpsItemOpPathList_u = 0; // uint8_t
			 $this->dwItemPromotionPrice = 0; // uint32_t
			 $this->cItemPromotionPrice_u = 0; // uint8_t
			 $this->dwItemPromotionDiscount = 0; // uint32_t
			 $this->cItemPromotionDiscount_u = 0; // uint8_t
			 $this->dwItemMailFree = 0; // uint32_t
			 $this->cItemMailFree_u = 0; // uint8_t
			 $this->vecPriceInfoList = new stl_vector('MultPriceBo'); // std::vector<icson::multprice::bo::CMultPriceBo> 
			 $this->cPriceInfoList_u = 0; // uint8_t
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
			$bs->pushString($this->strItemId); // 序列化商品id，调用方输入 类型为std::string
			$bs->pushUint8_t($this->cItemId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwMetaId); // 序列化商品品类id,调用方输入,有就填写，就是易讯的小类 类型为uint32_t
			$bs->pushUint8_t($this->cMetaId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSellerId); // 序列化卖家id,调用方输入,以后可能要用，现在可不填 类型为uint64_t
			$bs->pushUint8_t($this->cSellerId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwBrand); // 序列化品牌id,调用方输入，有就填进来哈 类型为uint64_t
			$bs->pushUint8_t($this->cBrand_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化SKUID，以后可能用 类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwItemWareHouseid); // 序列化商品仓id，调用方传入 类型为uint32_t
			$bs->pushUint8_t($this->cItemWareHouseid_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->setPriceSourceScene, 'stl_set'); // 序列化价格来源id及场景id, 字符串格式为来源id|场景id 类型为std::set<std::string> 
			$bs->pushUint8_t($this->cPriceSourceScene_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->setEdmCode, 'stl_set'); // 序列化edm代码,调用方输入[多价新增] 类型为std::set<std::string> 
			$bs->pushUint8_t($this->cEdmCode_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->setActId, 'stl_set'); // 序列化活动id,调用方输入，暂时不用 类型为std::set<uint32_t> 
			$bs->pushUint8_t($this->cActId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwItemPrice); // 序列化商品促销批价前价格,n件商品，即为n件之和，这里注意，如果在促销之前有其他优惠减价，要传入的是优惠后价格 类型为uint32_t
			$bs->pushUint8_t($this->cItemPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwItemUnitPrice); // 序列化商品促销批价前单价,不考虑商品件数，调用方输入  类型为uint32_t
			$bs->pushUint8_t($this->cItemUnitPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwItemCouponDiscount); // 序列化分摊到商品维度的优惠券优惠金额,调用方输入  类型为uint32_t
			$bs->pushUint8_t($this->cItemCouponDiscount_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwItemNum); // 序列化商品数量,调用方输入  类型为uint32_t
			$bs->pushUint8_t($this->cItemNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPkgId); // 序列化套餐id,调用方输入,最好填上  类型为uint32_t
			$bs->pushUint8_t($this->cPkgId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwItemType); // 序列化商品类型：0为普通商品，1为套餐赠品等，标识是否为套餐商品或赠品等，根据商品系统确定，调用方输入,一定要填写  类型为uint32_t
			$bs->pushUint8_t($this->cItemType_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecItemCategoryIdList, 'stl_vector'); // 序列化商品类目id Vector,内部使用，目前就3个，大中小类  类型为std::vector<uint64_t> 
			$bs->pushUint8_t($this->cItemCategoryIdList_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwItemFullMinusPrice); // 序列化满立减/赠后价格,满送券的记录在批价路径上  类型为uint32_t
			$bs->pushUint8_t($this->cItemFullMinusPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwItemFullMinusDiscount); // 序列化满立减/赠折扣  类型为uint32_t
			$bs->pushUint8_t($this->cItemFullMinusDiscount_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwItemFullAddPrice); // 序列化满加价购后价格,一期不用  类型为uint32_t
			$bs->pushUint8_t($this->cItemFullAddPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwItemFullAddDiscount); // 序列化满加价购优惠，一期不用  类型为uint32_t
			$bs->pushUint8_t($this->cItemFullAddDiscount_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecSpsItemOpPathList, 'stl_vector'); // 序列化操作路径列表  类型为std::vector<icson::promotion::bo::CSpsItemOpPathBo> 
			$bs->pushUint8_t($this->cSpsItemOpPathList_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwItemPromotionPrice); // 序列化商品促销后价格,接口输出，就是输出的优惠价格  类型为uint32_t
			$bs->pushUint8_t($this->cItemPromotionPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwItemPromotionDiscount); // 序列化商品促销优惠,接口输出  类型为uint32_t
			$bs->pushUint8_t($this->cItemPromotionDiscount_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwItemMailFree); // 序列化该商品是否包邮，1不包邮，2包邮，接口输出,一期不管  类型为uint32_t
			$bs->pushUint8_t($this->cItemMailFree_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecPriceInfoList, 'stl_vector'); // 序列化商品的多价list [多价使用]，购物流程vector只有一个元素  类型为std::vector<icson::multprice::bo::CMultPriceBo> 
			$bs->pushUint8_t($this->cPriceInfoList_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->mapExt, 'stl_map'); // 序列化扩展字段 类型为std::map<std::string,std::string> 
			$bs->pushUint8_t($this->cExt_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号  类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strItemId = $bs->popString(); // 反序列化商品id，调用方输入 类型为std::string
			$this->cItemId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwMetaId = $bs->popUint32_t(); // 反序列化商品品类id,调用方输入,有就填写，就是易讯的小类 类型为uint32_t
			$this->cMetaId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSellerId = $bs->popUint64_t(); // 反序列化卖家id,调用方输入,以后可能要用，现在可不填 类型为uint64_t
			$this->cSellerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwBrand = $bs->popUint64_t(); // 反序列化品牌id,调用方输入，有就填进来哈 类型为uint64_t
			$this->cBrand_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化SKUID，以后可能用 类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwItemWareHouseid = $bs->popUint32_t(); // 反序列化商品仓id，调用方传入 类型为uint32_t
			$this->cItemWareHouseid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->setPriceSourceScene = $bs->popObject('stl_set<stl_string> '); // 反序列化价格来源id及场景id, 字符串格式为来源id|场景id 类型为std::set<std::string> 
			$this->cPriceSourceScene_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->setEdmCode = $bs->popObject('stl_set<stl_string> '); // 反序列化edm代码,调用方输入[多价新增] 类型为std::set<std::string> 
			$this->cEdmCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->setActId = $bs->popObject('stl_set<uint32_t> '); // 反序列化活动id,调用方输入，暂时不用 类型为std::set<uint32_t> 
			$this->cActId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwItemPrice = $bs->popUint32_t(); // 反序列化商品促销批价前价格,n件商品，即为n件之和，这里注意，如果在促销之前有其他优惠减价，要传入的是优惠后价格 类型为uint32_t
			$this->cItemPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwItemUnitPrice = $bs->popUint32_t(); // 反序列化商品促销批价前单价,不考虑商品件数，调用方输入  类型为uint32_t
			$this->cItemUnitPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwItemCouponDiscount = $bs->popUint32_t(); // 反序列化分摊到商品维度的优惠券优惠金额,调用方输入  类型为uint32_t
			$this->cItemCouponDiscount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwItemNum = $bs->popUint32_t(); // 反序列化商品数量,调用方输入  类型为uint32_t
			$this->cItemNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPkgId = $bs->popUint32_t(); // 反序列化套餐id,调用方输入,最好填上  类型为uint32_t
			$this->cPkgId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwItemType = $bs->popUint32_t(); // 反序列化商品类型：0为普通商品，1为套餐赠品等，标识是否为套餐商品或赠品等，根据商品系统确定，调用方输入,一定要填写  类型为uint32_t
			$this->cItemType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecItemCategoryIdList = $bs->popObject('stl_vector<uint64_t> '); // 反序列化商品类目id Vector,内部使用，目前就3个，大中小类  类型为std::vector<uint64_t> 
			$this->cItemCategoryIdList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwItemFullMinusPrice = $bs->popUint32_t(); // 反序列化满立减/赠后价格,满送券的记录在批价路径上  类型为uint32_t
			$this->cItemFullMinusPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwItemFullMinusDiscount = $bs->popUint32_t(); // 反序列化满立减/赠折扣  类型为uint32_t
			$this->cItemFullMinusDiscount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwItemFullAddPrice = $bs->popUint32_t(); // 反序列化满加价购后价格,一期不用  类型为uint32_t
			$this->cItemFullAddPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwItemFullAddDiscount = $bs->popUint32_t(); // 反序列化满加价购优惠，一期不用  类型为uint32_t
			$this->cItemFullAddDiscount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecSpsItemOpPathList = $bs->popObject('stl_vector<SpsItemOpPathBo> '); // 反序列化操作路径列表  类型为std::vector<icson::promotion::bo::CSpsItemOpPathBo> 
			$this->cSpsItemOpPathList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwItemPromotionPrice = $bs->popUint32_t(); // 反序列化商品促销后价格,接口输出，就是输出的优惠价格  类型为uint32_t
			$this->cItemPromotionPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwItemPromotionDiscount = $bs->popUint32_t(); // 反序列化商品促销优惠,接口输出  类型为uint32_t
			$this->cItemPromotionDiscount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwItemMailFree = $bs->popUint32_t(); // 反序列化该商品是否包邮，1不包邮，2包邮，接口输出,一期不管  类型为uint32_t
			$this->cItemMailFree_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecPriceInfoList = $bs->popObject('stl_vector<MultPriceBo> '); // 反序列化商品的多价list [多价使用]，购物流程vector只有一个元素  类型为std::vector<icson::multprice::bo::CMultPriceBo> 
			$this->cPriceInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->mapExt = $bs->popObject('stl_map<stl_string,stl_string> '); // 反序列化扩展字段 类型为std::map<std::string,std::string> 
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
//}


//source idl: com.icson.sps.idl.SpsBaseinfo.java

//if (!class_exists('SpsItemOpPathBo')) {
class SpsItemOpPathBo
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
		 * 促销类型:参考文档，可能同时包括多价：1和促销：2
		 *
		 * 版本 >= 0
		 */
		var $dwRuleType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cRuleType_u; //uint8_t

		/**
		 * 优惠前商品价格 
		 *
		 * 版本 >= 0
		 */
		var $dwBeforePrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cBeforePrice_u; //uint8_t

		/**
		 * 优惠后商品价格 
		 *
		 * 版本 >= 0
		 */
		var $dwAfterPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cAfterPrice_u; //uint8_t

		/**
		 * 促销规则ID 
		 *
		 * 版本 >= 0
		 */
		var $dwRuleId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cRuleId_u; //uint8_t

		/**
		 * 优惠描述信息 
		 *
		 * 版本 >= 0
		 */
		var $strDescInfo; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cDescInfo_u; //uint8_t

		/**
		 * 优惠信息，记录送积分之类的 
		 *
		 * 版本 >= 0
		 */
		var $strDiscountInfo; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cDiscountInfo_u; //uint8_t

		/**
		 * 优惠信息类型，1减金额，2券id，3折扣，4商品id，5积分，6折扣 
		 *
		 * 版本 >= 0
		 */
		var $dwDiscountType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cDiscountType_u; //uint8_t

		/**
		 * 满足条件信息 
		 *
		 * 版本 >= 0
		 */
		var $strConditionInfo; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cConditionInfo_u; //uint8_t

		/**
		 * 满足条件类型 0:无条件，1：金额，2：数量 
		 *
		 * 版本 >= 0
		 */
		var $dwConditionType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cConditionType_u; //uint8_t

		/**
		 * 满足条件梯度下标，自动梯度则为自动次数(商详不用) 
		 *
		 * 版本 >= 0
		 */
		var $dwConditionIndex; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cConditionIndex_u; //uint8_t

		/**
		 * 规则卖家id，以后可能会用,一期无用 
		 *
		 * 版本 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * 成本分摊人 
		 *
		 * 版本 >= 0
		 */
		var $dwPriceCoster; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceCoster_u; //uint8_t

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
			 $this->dwRuleType = 0; // uint32_t
			 $this->cRuleType_u = 0; // uint8_t
			 $this->dwBeforePrice = 0; // uint32_t
			 $this->cBeforePrice_u = 0; // uint8_t
			 $this->dwAfterPrice = 0; // uint32_t
			 $this->cAfterPrice_u = 0; // uint8_t
			 $this->dwRuleId = 0; // uint32_t
			 $this->cRuleId_u = 0; // uint8_t
			 $this->strDescInfo = ""; // std::string
			 $this->cDescInfo_u = 0; // uint8_t
			 $this->strDiscountInfo = ""; // std::string
			 $this->cDiscountInfo_u = 0; // uint8_t
			 $this->dwDiscountType = 0; // uint32_t
			 $this->cDiscountType_u = 0; // uint8_t
			 $this->strConditionInfo = ""; // std::string
			 $this->cConditionInfo_u = 0; // uint8_t
			 $this->dwConditionType = 0; // uint32_t
			 $this->cConditionType_u = 0; // uint8_t
			 $this->dwConditionIndex = 0; // uint32_t
			 $this->cConditionIndex_u = 0; // uint8_t
			 $this->ddwSellerId = 0; // uint64_t
			 $this->cSellerId_u = 0; // uint8_t
			 $this->dwPriceCoster = 0; // uint32_t
			 $this->cPriceCoster_u = 0; // uint8_t
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
			$bs->pushUint32_t($this->dwRuleType); // 序列化促销类型:参考文档，可能同时包括多价：1和促销：2 类型为uint32_t
			$bs->pushUint8_t($this->cRuleType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwBeforePrice); // 序列化优惠前商品价格  类型为uint32_t
			$bs->pushUint8_t($this->cBeforePrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwAfterPrice); // 序列化优惠后商品价格  类型为uint32_t
			$bs->pushUint8_t($this->cAfterPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwRuleId); // 序列化促销规则ID  类型为uint32_t
			$bs->pushUint8_t($this->cRuleId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strDescInfo); // 序列化优惠描述信息  类型为std::string
			$bs->pushUint8_t($this->cDescInfo_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strDiscountInfo); // 序列化优惠信息，记录送积分之类的  类型为std::string
			$bs->pushUint8_t($this->cDiscountInfo_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwDiscountType); // 序列化优惠信息类型，1减金额，2券id，3折扣，4商品id，5积分，6折扣  类型为uint32_t
			$bs->pushUint8_t($this->cDiscountType_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strConditionInfo); // 序列化满足条件信息  类型为std::string
			$bs->pushUint8_t($this->cConditionInfo_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwConditionType); // 序列化满足条件类型 0:无条件，1：金额，2：数量  类型为uint32_t
			$bs->pushUint8_t($this->cConditionType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwConditionIndex); // 序列化满足条件梯度下标，自动梯度则为自动次数(商详不用)  类型为uint32_t
			$bs->pushUint8_t($this->cConditionIndex_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSellerId); // 序列化规则卖家id，以后可能会用,一期无用  类型为uint64_t
			$bs->pushUint8_t($this->cSellerId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceCoster); // 序列化成本分摊人  类型为uint32_t
			$bs->pushUint8_t($this->cPriceCoster_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->mapExt, 'stl_map'); // 序列化扩展字段 类型为std::map<std::string,std::string> 
			$bs->pushUint8_t($this->cExt_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号  类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRuleType = $bs->popUint32_t(); // 反序列化促销类型:参考文档，可能同时包括多价：1和促销：2 类型为uint32_t
			$this->cRuleType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwBeforePrice = $bs->popUint32_t(); // 反序列化优惠前商品价格  类型为uint32_t
			$this->cBeforePrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwAfterPrice = $bs->popUint32_t(); // 反序列化优惠后商品价格  类型为uint32_t
			$this->cAfterPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRuleId = $bs->popUint32_t(); // 反序列化促销规则ID  类型为uint32_t
			$this->cRuleId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strDescInfo = $bs->popString(); // 反序列化优惠描述信息  类型为std::string
			$this->cDescInfo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strDiscountInfo = $bs->popString(); // 反序列化优惠信息，记录送积分之类的  类型为std::string
			$this->cDiscountInfo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwDiscountType = $bs->popUint32_t(); // 反序列化优惠信息类型，1减金额，2券id，3折扣，4商品id，5积分，6折扣  类型为uint32_t
			$this->cDiscountType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strConditionInfo = $bs->popString(); // 反序列化满足条件信息  类型为std::string
			$this->cConditionInfo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwConditionType = $bs->popUint32_t(); // 反序列化满足条件类型 0:无条件，1：金额，2：数量  类型为uint32_t
			$this->cConditionType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwConditionIndex = $bs->popUint32_t(); // 反序列化满足条件梯度下标，自动梯度则为自动次数(商详不用)  类型为uint32_t
			$this->cConditionIndex_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSellerId = $bs->popUint64_t(); // 反序列化规则卖家id，以后可能会用,一期无用  类型为uint64_t
			$this->cSellerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceCoster = $bs->popUint32_t(); // 反序列化成本分摊人  类型为uint32_t
			$this->cPriceCoster_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->mapExt = $bs->popObject('stl_map<stl_string,stl_string> '); // 反序列化扩展字段 类型为std::map<std::string,std::string> 
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
//}


//source idl: com.icson.sps.idl.SpsBaseinfo.java

//if (!class_exists('SpsOperationInfoItemBo')) {
class SpsOperationInfoItemBo
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
		 * 规则ID
		 *
		 * 版本 >= 0
		 */
		var $dwRuleId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cRuleId_u; //uint8_t

		/**
		 * 促销类型:参考文档，可能同时包括多价:1和促销:2 
		 *
		 * 版本 >= 0
		 */
		var $dwOpType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cOpType_u; //uint8_t

		/**
		 * 运营信息 
		 *
		 * 版本 >= 0
		 */
		var $strOpInfo; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cOpInfo_u; //uint8_t

		/**
		 * 运营信息描述对应的url 
		 *
		 * 版本 >= 0
		 */
		var $strUrl; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cUrl_u; //uint8_t

		/**
		 * 当前规则的使用状态(商详页不用)：1(规则匹配且满足)，2(规则匹配但不满足)，3(因梯度价，满足与待满足同时存在，暂时不考虑)
		 *
		 * 版本 >= 0
		 */
		var $dwUseRuleState; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cUseRuleState_u; //uint8_t

		/**
		 * 匹配当前规则的商品价格总和(商详页无用)，该总和可能满足规则，也可能不满足 
		 *
		 * 版本 >= 0
		 */
		var $dwRuleSumValue; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cRuleSumValue_u; //uint8_t

		/**
		 * 梯度类型,0为自动梯度，1为手动梯度 
		 *
		 * 版本 >= 0
		 */
		var $dwStagePriceType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStagePriceType_u; //uint8_t

		/**
		 * 已满足规则的条件value类型:0无条件 1价格，2件数 
		 *
		 * 版本 >= 0
		 */
		var $dwConditionType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cConditionType_u; //uint8_t

		/**
		 * 已满足规则的条件value，如满100，此处为10000，手动梯度的话为整个梯度价的vector，存了每个价格，自动梯度则只有一个值 
		 *
		 * 版本 >= 0
		 */
		var $vecConditionValue; //std::vector<uint32_t> 

		/**
		 * 版本 >= 0
		 */
		var $cConditionValue_u; //uint8_t

		/**
		 * 如果是手动梯度价，则为梯度的最大限制 
		 *
		 * 版本 >= 0
		 */
		var $dwAutoStageMax; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cAutoStageMax_u; //uint8_t

		/**
		 * 满足梯度价下标，从1开始（商详不用） 
		 *
		 * 版本 >= 0
		 */
		var $dwStagePriceIndex; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStagePriceIndex_u; //uint8_t

		/**
		 * 满足规则的优惠value类型：1减金额，2券id，3折扣，4商品id，5积分，6折扣，满包邮时此字段无用,手动梯度为整个梯度 
		 *
		 * 版本 >= 0
		 */
		var $dwDiscountType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cDiscountType_u; //uint8_t

		/**
		 * 满足规则的优惠value，如满XX减50，此处为5000；满送券，此处为券id,送积分时此处为积分，折扣时显示**折；满包邮时此字段无用,手动梯度的话为整个梯度价的vector，存了每个价格，自动梯度则只有一个 
		 *
		 * 版本 >= 0
		 */
		var $vecDiscountValue; //std::vector<std::string> 

		/**
		 * 版本 >= 0
		 */
		var $cDiscountValue_u; //uint8_t

		/**
		 * 满足规则的优惠的使用数量(商详页无用)，如优惠券的数量，无数量要求时，默认为1，满包邮时此字段无用 
		 *
		 * 版本 >= 0
		 */
		var $dwDiscountUseNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cDiscountUseNum_u; //uint8_t

		/**
		 * 待满足规则的差额(商详页不用)，如差10元，可使用满立减，此处为1000
		 *
		 * 版本 >= 0
		 */
		var $dwUnfillDiffValue; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cUnfillDiffValue_u; //uint8_t

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
			 $this->dwRuleId = 0; // uint32_t
			 $this->cRuleId_u = 0; // uint8_t
			 $this->dwOpType = 0; // uint32_t
			 $this->cOpType_u = 0; // uint8_t
			 $this->strOpInfo = ""; // std::string
			 $this->cOpInfo_u = 0; // uint8_t
			 $this->strUrl = ""; // std::string
			 $this->cUrl_u = 0; // uint8_t
			 $this->dwUseRuleState = 0; // uint32_t
			 $this->cUseRuleState_u = 0; // uint8_t
			 $this->dwRuleSumValue = 0; // uint32_t
			 $this->cRuleSumValue_u = 0; // uint8_t
			 $this->dwStagePriceType = 0; // uint32_t
			 $this->cStagePriceType_u = 0; // uint8_t
			 $this->dwConditionType = 0; // uint32_t
			 $this->cConditionType_u = 0; // uint8_t
			 $this->vecConditionValue = new stl_vector('uint32_t'); // std::vector<uint32_t> 
			 $this->cConditionValue_u = 0; // uint8_t
			 $this->dwAutoStageMax = 0; // uint32_t
			 $this->cAutoStageMax_u = 0; // uint8_t
			 $this->dwStagePriceIndex = 0; // uint32_t
			 $this->cStagePriceIndex_u = 0; // uint8_t
			 $this->dwDiscountType = 0; // uint32_t
			 $this->cDiscountType_u = 0; // uint8_t
			 $this->vecDiscountValue = new stl_vector('stl_string'); // std::vector<std::string> 
			 $this->cDiscountValue_u = 0; // uint8_t
			 $this->dwDiscountUseNum = 0; // uint32_t
			 $this->cDiscountUseNum_u = 0; // uint8_t
			 $this->dwUnfillDiffValue = 0; // uint32_t
			 $this->cUnfillDiffValue_u = 0; // uint8_t
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
			$bs->pushUint32_t($this->dwRuleId); // 序列化规则ID 类型为uint32_t
			$bs->pushUint8_t($this->cRuleId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwOpType); // 序列化促销类型:参考文档，可能同时包括多价:1和促销:2  类型为uint32_t
			$bs->pushUint8_t($this->cOpType_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strOpInfo); // 序列化运营信息  类型为std::string
			$bs->pushUint8_t($this->cOpInfo_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strUrl); // 序列化运营信息描述对应的url  类型为std::string
			$bs->pushUint8_t($this->cUrl_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwUseRuleState); // 序列化当前规则的使用状态(商详页不用)：1(规则匹配且满足)，2(规则匹配但不满足)，3(因梯度价，满足与待满足同时存在，暂时不考虑) 类型为uint32_t
			$bs->pushUint8_t($this->cUseRuleState_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwRuleSumValue); // 序列化匹配当前规则的商品价格总和(商详页无用)，该总和可能满足规则，也可能不满足  类型为uint32_t
			$bs->pushUint8_t($this->cRuleSumValue_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStagePriceType); // 序列化梯度类型,0为自动梯度，1为手动梯度  类型为uint32_t
			$bs->pushUint8_t($this->cStagePriceType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwConditionType); // 序列化已满足规则的条件value类型:0无条件 1价格，2件数  类型为uint32_t
			$bs->pushUint8_t($this->cConditionType_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecConditionValue, 'stl_vector'); // 序列化已满足规则的条件value，如满100，此处为10000，手动梯度的话为整个梯度价的vector，存了每个价格，自动梯度则只有一个值  类型为std::vector<uint32_t> 
			$bs->pushUint8_t($this->cConditionValue_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwAutoStageMax); // 序列化如果是手动梯度价，则为梯度的最大限制  类型为uint32_t
			$bs->pushUint8_t($this->cAutoStageMax_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStagePriceIndex); // 序列化满足梯度价下标，从1开始（商详不用）  类型为uint32_t
			$bs->pushUint8_t($this->cStagePriceIndex_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwDiscountType); // 序列化满足规则的优惠value类型：1减金额，2券id，3折扣，4商品id，5积分，6折扣，满包邮时此字段无用,手动梯度为整个梯度  类型为uint32_t
			$bs->pushUint8_t($this->cDiscountType_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecDiscountValue, 'stl_vector'); // 序列化满足规则的优惠value，如满XX减50，此处为5000；满送券，此处为券id,送积分时此处为积分，折扣时显示**折；满包邮时此字段无用,手动梯度的话为整个梯度价的vector，存了每个价格，自动梯度则只有一个  类型为std::vector<std::string> 
			$bs->pushUint8_t($this->cDiscountValue_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwDiscountUseNum); // 序列化满足规则的优惠的使用数量(商详页无用)，如优惠券的数量，无数量要求时，默认为1，满包邮时此字段无用  类型为uint32_t
			$bs->pushUint8_t($this->cDiscountUseNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwUnfillDiffValue); // 序列化待满足规则的差额(商详页不用)，如差10元，可使用满立减，此处为1000 类型为uint32_t
			$bs->pushUint8_t($this->cUnfillDiffValue_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->mapExt, 'stl_map'); // 序列化扩展字段 类型为std::map<std::string,std::string> 
			$bs->pushUint8_t($this->cExt_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号  类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRuleId = $bs->popUint32_t(); // 反序列化规则ID 类型为uint32_t
			$this->cRuleId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwOpType = $bs->popUint32_t(); // 反序列化促销类型:参考文档，可能同时包括多价:1和促销:2  类型为uint32_t
			$this->cOpType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strOpInfo = $bs->popString(); // 反序列化运营信息  类型为std::string
			$this->cOpInfo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strUrl = $bs->popString(); // 反序列化运营信息描述对应的url  类型为std::string
			$this->cUrl_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwUseRuleState = $bs->popUint32_t(); // 反序列化当前规则的使用状态(商详页不用)：1(规则匹配且满足)，2(规则匹配但不满足)，3(因梯度价，满足与待满足同时存在，暂时不考虑) 类型为uint32_t
			$this->cUseRuleState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRuleSumValue = $bs->popUint32_t(); // 反序列化匹配当前规则的商品价格总和(商详页无用)，该总和可能满足规则，也可能不满足  类型为uint32_t
			$this->cRuleSumValue_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStagePriceType = $bs->popUint32_t(); // 反序列化梯度类型,0为自动梯度，1为手动梯度  类型为uint32_t
			$this->cStagePriceType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwConditionType = $bs->popUint32_t(); // 反序列化已满足规则的条件value类型:0无条件 1价格，2件数  类型为uint32_t
			$this->cConditionType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecConditionValue = $bs->popObject('stl_vector<uint32_t> '); // 反序列化已满足规则的条件value，如满100，此处为10000，手动梯度的话为整个梯度价的vector，存了每个价格，自动梯度则只有一个值  类型为std::vector<uint32_t> 
			$this->cConditionValue_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwAutoStageMax = $bs->popUint32_t(); // 反序列化如果是手动梯度价，则为梯度的最大限制  类型为uint32_t
			$this->cAutoStageMax_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStagePriceIndex = $bs->popUint32_t(); // 反序列化满足梯度价下标，从1开始（商详不用）  类型为uint32_t
			$this->cStagePriceIndex_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwDiscountType = $bs->popUint32_t(); // 反序列化满足规则的优惠value类型：1减金额，2券id，3折扣，4商品id，5积分，6折扣，满包邮时此字段无用,手动梯度为整个梯度  类型为uint32_t
			$this->cDiscountType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecDiscountValue = $bs->popObject('stl_vector<stl_string> '); // 反序列化满足规则的优惠value，如满XX减50，此处为5000；满送券，此处为券id,送积分时此处为积分，折扣时显示**折；满包邮时此字段无用,手动梯度的话为整个梯度价的vector，存了每个价格，自动梯度则只有一个  类型为std::vector<std::string> 
			$this->cDiscountValue_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwDiscountUseNum = $bs->popUint32_t(); // 反序列化满足规则的优惠的使用数量(商详页无用)，如优惠券的数量，无数量要求时，默认为1，满包邮时此字段无用  类型为uint32_t
			$this->cDiscountUseNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwUnfillDiffValue = $bs->popUint32_t(); // 反序列化待满足规则的差额(商详页不用)，如差10元，可使用满立减，此处为1000 类型为uint32_t
			$this->cUnfillDiffValue_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->mapExt = $bs->popObject('stl_map<stl_string,stl_string> '); // 反序列化扩展字段 类型为std::map<std::string,std::string> 
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
//}

?>