<?php

//source idl: paipai.DetailMain.java

if (!class_exists('MultPriceInputInfo', false)) {
class MultPriceInputInfo
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
		 * 多价场景id，活动页面数据
		 *
		 * 版本 >= 0
		 */
		var $dwPriceScencId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceScencId_u; //uint8_t

		/**
		 * 多价来源id，活动页面数据
		 *
		 * 版本 >= 0
		 */
		var $dwPriceSourceId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceSourceId_u; //uint8_t

		/**
		 * edm代码,调用方输入
		 *
		 * 版本 >= 0
		 */
		var $strEdmCode; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cEdmCode_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwPriceScencId = 0; // uint32_t
			 $this->cPriceScencId_u = 0; // uint8_t
			 $this->dwPriceSourceId = 0; // uint32_t
			 $this->cPriceSourceId_u = 0; // uint8_t
			 $this->strEdmCode = ""; // std::string
			 $this->cEdmCode_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceScencId); // 序列化多价场景id，活动页面数据 类型为uint32_t
			$bs->pushUint8_t($this->cPriceScencId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceSourceId); // 序列化多价来源id，活动页面数据 类型为uint32_t
			$bs->pushUint8_t($this->cPriceSourceId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strEdmCode); // 序列化edm代码,调用方输入 类型为std::string
			$bs->pushUint8_t($this->cEdmCode_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceScencId = $bs->popUint32_t(); // 反序列化多价场景id，活动页面数据 类型为uint32_t
			$this->cPriceScencId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceSourceId = $bs->popUint32_t(); // 反序列化多价来源id，活动页面数据 类型为uint32_t
			$this->cPriceSourceId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strEdmCode = $bs->popString(); // 反序列化edm代码,调用方输入 类型为std::string
			$this->cEdmCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: paipai.DetailMain.java

if (!class_exists('MultPrice4MobilePo', false)) {
class MultPrice4MobilePo
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
		 * 价格类型;预留
		 *
		 * 版本 >= 0
		 */
		var $dwPriceType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceType_u; //uint8_t

		/**
		 * 价格使用方式，1是用于下单的价格，0是用于提示的价格(主要是涉及会员身份的提示)
		 *
		 * 版本 >= 0
		 */
		var $dwPriceUse; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceUse_u; //uint8_t

		/**
		 * 地域 id，预留
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
		 * 多价规则名称，如 QQ会员专享价
		 *
		 * 版本 >= 0
		 */
		var $strPriceName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceName_u; //uint8_t

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
		 * 活动规则url，预留
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
		 * 商品促销多价的优惠方式，0，无优惠，1定价，2减价，3折扣
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
		 * 规则预告时间，选填
		 *
		 * 版本 >= 0
		 */
		var $dwNoticeTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cNoticeTime_u; //uint8_t

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
			 $this->dwPriceUse = 0; // uint32_t
			 $this->cPriceUse_u = 0; // uint8_t
			 $this->dwRegionId = 0; // uint32_t
			 $this->cRegionId_u = 0; // uint8_t
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
			 $this->dwPriceAfterFavor = 0; // uint32_t
			 $this->cPriceAfterFavor_u = 0; // uint8_t
			 $this->dwPriceDiscount = 0; // uint32_t
			 $this->cPriceDiscount_u = 0; // uint8_t
			 $this->dwUnitPriceAfterFavor = 0; // uint32_t
			 $this->cUnitPriceAfterFavor_u = 0; // uint8_t
			 $this->dwUnitPriceDiscount = 0; // uint32_t
			 $this->cUnitPriceDiscount_u = 0; // uint8_t
			 $this->strPriceRule = ""; // std::string
			 $this->cPriceRule_u = 0; // uint8_t
			 $this->dwPriceStartTime = 0; // uint32_t
			 $this->cPriceStartTime_u = 0; // uint8_t
			 $this->dwPriceEndTime = 0; // uint32_t
			 $this->cPriceEndTime_u = 0; // uint8_t
			 $this->dwNoticeTime = 0; // uint32_t
			 $this->cNoticeTime_u = 0; // uint8_t
			 $this->strPriceBuyLimitRule = ""; // std::string
			 $this->cPriceBuyLimitRule_u = 0; // uint8_t
			 $this->dwPriceBuyLimitFlag = 0; // uint32_t
			 $this->cPriceBuyLimitFlag_u = 0; // uint8_t
			 $this->dwPriceBuyLimitNum = 0; // uint32_t
			 $this->cPriceBuyLimitNum_u = 0; // uint8_t
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
			$bs->pushUint32_t($this->dwPriceType); // 序列化价格类型;预留 类型为uint32_t
			$bs->pushUint8_t($this->cPriceType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceUse); // 序列化价格使用方式，1是用于下单的价格，0是用于提示的价格(主要是涉及会员身份的提示) 类型为uint32_t
			$bs->pushUint8_t($this->cPriceUse_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwRegionId); // 序列化地域 id，预留 类型为uint32_t
			$bs->pushUint8_t($this->cRegionId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwPriceSceneId); // 序列化场景 id 类型为uint64_t
			$bs->pushUint8_t($this->cPriceSceneId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwPriceSourceId); // 序列化来源 id 类型为uint64_t
			$bs->pushUint8_t($this->cPriceSourceId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceName); // 序列化多价规则名称，如 QQ会员专享价 类型为std::string
			$bs->pushUint8_t($this->cPriceName_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceDesc); // 序列化多价规则描述，选填 类型为std::string
			$bs->pushUint8_t($this->cPriceDesc_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPricePromotionUrl); // 序列化活动规则url，预留 类型为std::string
			$bs->pushUint8_t($this->cPricePromotionUrl_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceBase); // 序列化批价的基准价类型，单个商品，预留 类型为uint32_t
			$bs->pushUint8_t($this->cPriceBase_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wPriceOpType); // 序列化商品促销多价的优惠方式，0，无优惠，1定价，2减价，3折扣 类型为uint16_t
			$bs->pushUint8_t($this->cPriceOpType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwUnitPriceOpNum); // 序列化商品促销多价的操作金额，不考虑商品数量，如98折传 98，减10元传 10，定价为5元传 5 类型为uint32_t
			$bs->pushUint8_t($this->cUnitPriceOpNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceAfterFavor); // 序列化该款商品的优惠后价格，有n件商品，则为n件总值 类型为uint32_t
			$bs->pushUint8_t($this->cPriceAfterFavor_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceDiscount); // 序列化该款商品总优惠的金额，必填 类型为uint32_t
			$bs->pushUint8_t($this->cPriceDiscount_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwUnitPriceAfterFavor); // 序列化单个商品多价优惠后的价价格，即不考虑商品数量 类型为uint32_t
			$bs->pushUint8_t($this->cUnitPriceAfterFavor_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwUnitPriceDiscount); // 序列化单个商品多价的优惠金额，即不考虑商品数量 类型为uint32_t
			$bs->pushUint8_t($this->cUnitPriceDiscount_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceRule); // 序列化价格规则，目前仅阶梯价使用 类型为std::string
			$bs->pushUint8_t($this->cPriceRule_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceStartTime); // 序列化规则开始时间，必填 类型为uint32_t
			$bs->pushUint8_t($this->cPriceStartTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceEndTime); // 序列化规则结束时间，必填 类型为uint32_t
			$bs->pushUint8_t($this->cPriceEndTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwNoticeTime); // 序列化规则预告时间，选填 类型为uint32_t
			$bs->pushUint8_t($this->cNoticeTime_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceBuyLimitRule); // 序列化限购规则 类型为std::string
			$bs->pushUint8_t($this->cPriceBuyLimitRule_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceBuyLimitFlag); // 序列化限制标志位，超过限购时为1，表示商品不可购买 类型为uint32_t
			$bs->pushUint8_t($this->cPriceBuyLimitFlag_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceBuyLimitNum); // 序列化商品剩余的限购数量 类型为uint32_t
			$bs->pushUint8_t($this->cPriceBuyLimitNum_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->mapExt, 'stl_map'); // 序列化扩展字段 类型为std::map<std::string,std::string> 
			$bs->pushUint8_t($this->cExt_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceType = $bs->popUint32_t(); // 反序列化价格类型;预留 类型为uint32_t
			$this->cPriceType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceUse = $bs->popUint32_t(); // 反序列化价格使用方式，1是用于下单的价格，0是用于提示的价格(主要是涉及会员身份的提示) 类型为uint32_t
			$this->cPriceUse_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRegionId = $bs->popUint32_t(); // 反序列化地域 id，预留 类型为uint32_t
			$this->cRegionId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwPriceSceneId = $bs->popUint64_t(); // 反序列化场景 id 类型为uint64_t
			$this->cPriceSceneId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwPriceSourceId = $bs->popUint64_t(); // 反序列化来源 id 类型为uint64_t
			$this->cPriceSourceId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceName = $bs->popString(); // 反序列化多价规则名称，如 QQ会员专享价 类型为std::string
			$this->cPriceName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceDesc = $bs->popString(); // 反序列化多价规则描述，选填 类型为std::string
			$this->cPriceDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPricePromotionUrl = $bs->popString(); // 反序列化活动规则url，预留 类型为std::string
			$this->cPricePromotionUrl_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceBase = $bs->popUint32_t(); // 反序列化批价的基准价类型，单个商品，预留 类型为uint32_t
			$this->cPriceBase_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wPriceOpType = $bs->popUint16_t(); // 反序列化商品促销多价的优惠方式，0，无优惠，1定价，2减价，3折扣 类型为uint16_t
			$this->cPriceOpType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwUnitPriceOpNum = $bs->popUint32_t(); // 反序列化商品促销多价的操作金额，不考虑商品数量，如98折传 98，减10元传 10，定价为5元传 5 类型为uint32_t
			$this->cUnitPriceOpNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceAfterFavor = $bs->popUint32_t(); // 反序列化该款商品的优惠后价格，有n件商品，则为n件总值 类型为uint32_t
			$this->cPriceAfterFavor_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceDiscount = $bs->popUint32_t(); // 反序列化该款商品总优惠的金额，必填 类型为uint32_t
			$this->cPriceDiscount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwUnitPriceAfterFavor = $bs->popUint32_t(); // 反序列化单个商品多价优惠后的价价格，即不考虑商品数量 类型为uint32_t
			$this->cUnitPriceAfterFavor_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwUnitPriceDiscount = $bs->popUint32_t(); // 反序列化单个商品多价的优惠金额，即不考虑商品数量 类型为uint32_t
			$this->cUnitPriceDiscount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceRule = $bs->popString(); // 反序列化价格规则，目前仅阶梯价使用 类型为std::string
			$this->cPriceRule_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceStartTime = $bs->popUint32_t(); // 反序列化规则开始时间，必填 类型为uint32_t
			$this->cPriceStartTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceEndTime = $bs->popUint32_t(); // 反序列化规则结束时间，必填 类型为uint32_t
			$this->cPriceEndTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwNoticeTime = $bs->popUint32_t(); // 反序列化规则预告时间，选填 类型为uint32_t
			$this->cNoticeTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceBuyLimitRule = $bs->popString(); // 反序列化限购规则 类型为std::string
			$this->cPriceBuyLimitRule_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceBuyLimitFlag = $bs->popUint32_t(); // 反序列化限制标志位，超过限购时为1，表示商品不可购买 类型为uint32_t
			$this->cPriceBuyLimitFlag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceBuyLimitNum = $bs->popUint32_t(); // 反序列化商品剩余的限购数量 类型为uint32_t
			$this->cPriceBuyLimitNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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
}


//source idl: paipai.DetailMain.java

if (!class_exists('ItemMultPriceInfo4MobilePo', false)) {
class ItemMultPriceInfo4MobilePo
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
		 * 商品id
		 *
		 * 版本 >= 0
		 */
		var $strItemId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cItemId_u; //uint8_t

		/**
		 * sku id
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 商品仓id
		 *
		 * 版本 >= 0
		 */
		var $dwItemWareHouseid; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cItemWareHouseid_u; //uint8_t

		/**
		 * 活动id,调用方输入，没有时不填
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
		 * 商品数量
		 *
		 * 版本 >= 0
		 */
		var $dwItemNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cItemNum_u; //uint8_t

		/**
		 * 商品的多价list
		 *
		 * 版本 >= 0
		 */
		var $vecPriceInfoList; //std::vector<icson::detail::po::CMultPrice4MobilePo> 

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
			 $this->dwItemNum = 0; // uint32_t
			 $this->cItemNum_u = 0; // uint8_t
			 $this->vecPriceInfoList = new stl_vector('MultPrice4MobilePo'); // std::vector<icson::detail::po::CMultPrice4MobilePo> 
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
			$bs->pushString($this->strItemId); // 序列化商品id 类型为std::string
			$bs->pushUint8_t($this->cItemId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化sku id 类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwItemWareHouseid); // 序列化商品仓id 类型为uint32_t
			$bs->pushUint8_t($this->cItemWareHouseid_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->setPriceSourceScene, 'stl_set'); // 序列化活动id,调用方输入，没有时不填 类型为std::set<std::string> 
			$bs->pushUint8_t($this->cPriceSourceScene_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->setEdmCode, 'stl_set'); // 序列化edm代码,调用方输入[多价新增] 类型为std::set<std::string> 
			$bs->pushUint8_t($this->cEdmCode_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->setActId, 'stl_set'); // 序列化活动id,调用方输入，暂时不用 类型为std::set<uint32_t> 
			$bs->pushUint8_t($this->cActId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwItemNum); // 序列化商品数量 类型为uint32_t
			$bs->pushUint8_t($this->cItemNum_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecPriceInfoList, 'stl_vector'); // 序列化商品的多价list 类型为std::vector<icson::detail::po::CMultPrice4MobilePo> 
			$bs->pushUint8_t($this->cPriceInfoList_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->mapExt, 'stl_map'); // 序列化扩展字段 类型为std::map<std::string,std::string> 
			$bs->pushUint8_t($this->cExt_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号  类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strItemId = $bs->popString(); // 反序列化商品id 类型为std::string
			$this->cItemId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化sku id 类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwItemWareHouseid = $bs->popUint32_t(); // 反序列化商品仓id 类型为uint32_t
			$this->cItemWareHouseid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->setPriceSourceScene = $bs->popObject('stl_set<stl_string> '); // 反序列化活动id,调用方输入，没有时不填 类型为std::set<std::string> 
			$this->cPriceSourceScene_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->setEdmCode = $bs->popObject('stl_set<stl_string> '); // 反序列化edm代码,调用方输入[多价新增] 类型为std::set<std::string> 
			$this->cEdmCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->setActId = $bs->popObject('stl_set<uint32_t> '); // 反序列化活动id,调用方输入，暂时不用 类型为std::set<uint32_t> 
			$this->cActId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwItemNum = $bs->popUint32_t(); // 反序列化商品数量 类型为uint32_t
			$this->cItemNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecPriceInfoList = $bs->popObject('stl_vector<MultPrice4MobilePo> '); // 反序列化商品的多价list 类型为std::vector<icson::detail::po::CMultPrice4MobilePo> 
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
}


//source idl: paipai.DetailMain.java

if (!class_exists('DetailPureData4Mobile', false)) {
class DetailPureData4Mobile
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
		 * 商品id
		 *
		 * 版本 >= 0
		 */
		var $strItemId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cItemId_u; //uint8_t

		/**
		 * 商品标题
		 *
		 * 版本 >= 0
		 */
		var $strSkuTitle; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSkuTitle_u; //uint8_t

		/**
		 * 商品促销语
		 *
		 * 版本 >= 0
		 */
		var $strSkuPromotDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSkuPromotDesc_u; //uint8_t

		/**
		 * 商品编号
		 *
		 * 版本 >= 0
		 */
		var $strProductCharId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cProductCharId_u; //uint8_t

		/**
		 * 大一统sku id
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 图片Url map size->url 如：http://img0.wgimg.com/qqbuy/855006089/item-00000000000000000000003E86B55530.0.jpg/320?50E2EA7E 
		 *
		 * 版本 >= 0
		 */
		var $mapLogoUrl; //std::map<std::string,std::string> 

		/**
		 * 版本 >= 0
		 */
		var $cLogoUrl_u; //uint8_t

		/**
		 * Sku销售属性串，竖线分割的id集合,从小到大排列 例如：2483|2486
		 *
		 * 版本 >= 0
		 */
		var $strSkuSaleAttr; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSkuSaleAttr_u; //uint8_t

		/**
		 * sku销售属性解析后明文例如：颜色|尺码
		 *
		 * 版本 >= 0
		 */
		var $strSkuSaleAttrText; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSkuSaleAttrText_u; //uint8_t

		/**
		 * 最小购买数量
		 *
		 * 版本 >= 0
		 */
		var $dwMinBuyCount; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cMinBuyCount_u; //uint8_t

		/**
		 * Sku 参见enum SkuState状态 0-在售 1-售完 2-下架 3-强制下架 4-删除 5-强制删除 
		 *
		 * 版本 >= 0
		 */
		var $cSkuState; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuState_u; //uint8_t

		/**
		 * 导航栏页面片
		 *
		 * 版本 >= 0
		 */
		var $strCrumbData; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cCrumbData_u; //uint8_t

		/**
		 * 是否限运，0表示不限运，1表示限运
		 *
		 * 版本 >= 0
		 */
		var $cIsRestrictedTrans; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIsRestrictedTrans_u; //uint8_t

		/**
		 * 是否支持货到付款，0表示不支持，1表示支持
		 *
		 * 版本 >= 0
		 */
		var $cIsCOD; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIsCOD_u; //uint8_t

		/**
		 * 是否支持贵就赔
		 *
		 * 版本 >= 0
		 */
		var $cIsGJP; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIsGJP_u; //uint8_t

		/**
		 * 是否支持价格保护
		 *
		 * 版本 >= 0
		 */
		var $cIsPriceProtected; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIsPriceProtected_u; //uint8_t

		/**
		 * 是否支持上门安装
		 *
		 * 版本 >= 0
		 */
		var $cIsHomeInstall; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIsHomeInstall_u; //uint8_t

		/**
		 * 是否提供延保服务
		 *
		 * 版本 >= 0
		 */
		var $cIsExtendedInsurance; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIsExtendedInsurance_u; //uint8_t

		/**
		 * 是否开增值税发票
		 *
		 * 版本 >= 0
		 */
		var $cIsVAT; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIsVAT_u; //uint8_t

		/**
		 * 是否可以使用优惠劵
		 *
		 * 版本 >= 0
		 */
		var $cIsCouponProduct; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIsCouponProduct_u; //uint8_t

		/**
		 * 是否为限时抢购，TIME_LIMITED_RUSHING_BUY
		 *
		 * 版本 >= 0
		 */
		var $cIsRushingbuy; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIsRushingbuy_u; //uint8_t

		/**
		 * 是否为预售商品，APPOINT_PRODUCT
		 *
		 * 版本 >= 0
		 */
		var $cIsAppointProduct; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIsAppointProduct_u; //uint8_t

		/**
		 * 图片数量
		 *
		 * 版本 >= 0
		 */
		var $dwPicNumber; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPicNumber_u; //uint8_t

		/**
		 * 商详多价商品价格信息列表（输出）
		 *
		 * 版本 >= 0
		 */
		var $mapItemPriceInfoListOut; //std::map<std::string,icson::detail::po::CItemMultPriceInfo4MobilePo> 


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->strItemId = ""; // std::string
			 $this->cItemId_u = 0; // uint8_t
			 $this->strSkuTitle = ""; // std::string
			 $this->cSkuTitle_u = 0; // uint8_t
			 $this->strSkuPromotDesc = ""; // std::string
			 $this->cSkuPromotDesc_u = 0; // uint8_t
			 $this->strProductCharId = ""; // std::string
			 $this->cProductCharId_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->mapLogoUrl = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
			 $this->cLogoUrl_u = 0; // uint8_t
			 $this->strSkuSaleAttr = ""; // std::string
			 $this->cSkuSaleAttr_u = 0; // uint8_t
			 $this->strSkuSaleAttrText = ""; // std::string
			 $this->cSkuSaleAttrText_u = 0; // uint8_t
			 $this->dwMinBuyCount = 0; // uint32_t
			 $this->cMinBuyCount_u = 0; // uint8_t
			 $this->cSkuState = 0; // uint8_t
			 $this->cSkuState_u = 0; // uint8_t
			 $this->strCrumbData = ""; // std::string
			 $this->cCrumbData_u = 0; // uint8_t
			 $this->cIsRestrictedTrans = 0; // uint8_t
			 $this->cIsRestrictedTrans_u = 0; // uint8_t
			 $this->cIsCOD = 0; // uint8_t
			 $this->cIsCOD_u = 0; // uint8_t
			 $this->cIsGJP = 0; // uint8_t
			 $this->cIsGJP_u = 0; // uint8_t
			 $this->cIsPriceProtected = 0; // uint8_t
			 $this->cIsPriceProtected_u = 0; // uint8_t
			 $this->cIsHomeInstall = 0; // uint8_t
			 $this->cIsHomeInstall_u = 0; // uint8_t
			 $this->cIsExtendedInsurance = 0; // uint8_t
			 $this->cIsExtendedInsurance_u = 0; // uint8_t
			 $this->cIsVAT = 0; // uint8_t
			 $this->cIsVAT_u = 0; // uint8_t
			 $this->cIsCouponProduct = 0; // uint8_t
			 $this->cIsCouponProduct_u = 0; // uint8_t
			 $this->cIsRushingbuy = 0; // uint8_t
			 $this->cIsRushingbuy_u = 0; // uint8_t
			 $this->cIsAppointProduct = 0; // uint8_t
			 $this->cIsAppointProduct_u = 0; // uint8_t
			 $this->dwPicNumber = 0; // uint32_t
			 $this->cPicNumber_u = 0; // uint8_t
			 $this->mapItemPriceInfoListOut = new stl_map('ItemMultPriceInfo4MobilePo'); // std::map<std::string,icson::detail::po::CItemMultPriceInfo4MobilePo> 
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strItemId); // 序列化商品id 类型为std::string
			$bs->pushUint8_t($this->cItemId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSkuTitle); // 序列化商品标题 类型为std::string
			$bs->pushUint8_t($this->cSkuTitle_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSkuPromotDesc); // 序列化商品促销语 类型为std::string
			$bs->pushUint8_t($this->cSkuPromotDesc_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strProductCharId); // 序列化商品编号 类型为std::string
			$bs->pushUint8_t($this->cProductCharId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化大一统sku id 类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->mapLogoUrl, 'stl_map'); // 序列化图片Url map size->url 如：http://img0.wgimg.com/qqbuy/855006089/item-00000000000000000000003E86B55530.0.jpg/320?50E2EA7E  类型为std::map<std::string,std::string> 
			$bs->pushUint8_t($this->cLogoUrl_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSkuSaleAttr); // 序列化Sku销售属性串，竖线分割的id集合,从小到大排列 例如：2483|2486 类型为std::string
			$bs->pushUint8_t($this->cSkuSaleAttr_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSkuSaleAttrText); // 序列化sku销售属性解析后明文例如：颜色|尺码 类型为std::string
			$bs->pushUint8_t($this->cSkuSaleAttrText_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwMinBuyCount); // 序列化最小购买数量 类型为uint32_t
			$bs->pushUint8_t($this->cMinBuyCount_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSkuState); // 序列化Sku 参见enum SkuState状态 0-在售 1-售完 2-下架 3-强制下架 4-删除 5-强制删除  类型为uint8_t
			$bs->pushUint8_t($this->cSkuState_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strCrumbData); // 序列化导航栏页面片 类型为std::string
			$bs->pushUint8_t($this->cCrumbData_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIsRestrictedTrans); // 序列化是否限运，0表示不限运，1表示限运 类型为uint8_t
			$bs->pushUint8_t($this->cIsRestrictedTrans_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIsCOD); // 序列化是否支持货到付款，0表示不支持，1表示支持 类型为uint8_t
			$bs->pushUint8_t($this->cIsCOD_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIsGJP); // 序列化是否支持贵就赔 类型为uint8_t
			$bs->pushUint8_t($this->cIsGJP_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIsPriceProtected); // 序列化是否支持价格保护 类型为uint8_t
			$bs->pushUint8_t($this->cIsPriceProtected_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIsHomeInstall); // 序列化是否支持上门安装 类型为uint8_t
			$bs->pushUint8_t($this->cIsHomeInstall_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIsExtendedInsurance); // 序列化是否提供延保服务 类型为uint8_t
			$bs->pushUint8_t($this->cIsExtendedInsurance_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIsVAT); // 序列化是否开增值税发票 类型为uint8_t
			$bs->pushUint8_t($this->cIsVAT_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIsCouponProduct); // 序列化是否可以使用优惠劵 类型为uint8_t
			$bs->pushUint8_t($this->cIsCouponProduct_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIsRushingbuy); // 序列化是否为限时抢购，TIME_LIMITED_RUSHING_BUY 类型为uint8_t
			$bs->pushUint8_t($this->cIsRushingbuy_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIsAppointProduct); // 序列化是否为预售商品，APPOINT_PRODUCT 类型为uint8_t
			$bs->pushUint8_t($this->cIsAppointProduct_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPicNumber); // 序列化图片数量 类型为uint32_t
			$bs->pushUint8_t($this->cPicNumber_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->mapItemPriceInfoListOut, 'stl_map'); // 序列化商详多价商品价格信息列表（输出） 类型为std::map<std::string,icson::detail::po::CItemMultPriceInfo4MobilePo> 
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strItemId = $bs->popString(); // 反序列化商品id 类型为std::string
			$this->cItemId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSkuTitle = $bs->popString(); // 反序列化商品标题 类型为std::string
			$this->cSkuTitle_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSkuPromotDesc = $bs->popString(); // 反序列化商品促销语 类型为std::string
			$this->cSkuPromotDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strProductCharId = $bs->popString(); // 反序列化商品编号 类型为std::string
			$this->cProductCharId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化大一统sku id 类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->mapLogoUrl = $bs->popObject('stl_map<stl_string,stl_string> '); // 反序列化图片Url map size->url 如：http://img0.wgimg.com/qqbuy/855006089/item-00000000000000000000003E86B55530.0.jpg/320?50E2EA7E  类型为std::map<std::string,std::string> 
			$this->cLogoUrl_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSkuSaleAttr = $bs->popString(); // 反序列化Sku销售属性串，竖线分割的id集合,从小到大排列 例如：2483|2486 类型为std::string
			$this->cSkuSaleAttr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSkuSaleAttrText = $bs->popString(); // 反序列化sku销售属性解析后明文例如：颜色|尺码 类型为std::string
			$this->cSkuSaleAttrText_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwMinBuyCount = $bs->popUint32_t(); // 反序列化最小购买数量 类型为uint32_t
			$this->cMinBuyCount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSkuState = $bs->popUint8_t(); // 反序列化Sku 参见enum SkuState状态 0-在售 1-售完 2-下架 3-强制下架 4-删除 5-强制删除  类型为uint8_t
			$this->cSkuState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strCrumbData = $bs->popString(); // 反序列化导航栏页面片 类型为std::string
			$this->cCrumbData_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIsRestrictedTrans = $bs->popUint8_t(); // 反序列化是否限运，0表示不限运，1表示限运 类型为uint8_t
			$this->cIsRestrictedTrans_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIsCOD = $bs->popUint8_t(); // 反序列化是否支持货到付款，0表示不支持，1表示支持 类型为uint8_t
			$this->cIsCOD_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIsGJP = $bs->popUint8_t(); // 反序列化是否支持贵就赔 类型为uint8_t
			$this->cIsGJP_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIsPriceProtected = $bs->popUint8_t(); // 反序列化是否支持价格保护 类型为uint8_t
			$this->cIsPriceProtected_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIsHomeInstall = $bs->popUint8_t(); // 反序列化是否支持上门安装 类型为uint8_t
			$this->cIsHomeInstall_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIsExtendedInsurance = $bs->popUint8_t(); // 反序列化是否提供延保服务 类型为uint8_t
			$this->cIsExtendedInsurance_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIsVAT = $bs->popUint8_t(); // 反序列化是否开增值税发票 类型为uint8_t
			$this->cIsVAT_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIsCouponProduct = $bs->popUint8_t(); // 反序列化是否可以使用优惠劵 类型为uint8_t
			$this->cIsCouponProduct_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIsRushingbuy = $bs->popUint8_t(); // 反序列化是否为限时抢购，TIME_LIMITED_RUSHING_BUY 类型为uint8_t
			$this->cIsRushingbuy_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIsAppointProduct = $bs->popUint8_t(); // 反序列化是否为预售商品，APPOINT_PRODUCT 类型为uint8_t
			$this->cIsAppointProduct_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPicNumber = $bs->popUint32_t(); // 反序列化图片数量 类型为uint32_t
			$this->cPicNumber_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->mapItemPriceInfoListOut = $bs->popObject('stl_map<stl_string,ItemMultPriceInfo4MobilePo> '); // 反序列化商详多价商品价格信息列表（输出） 类型为std::map<std::string,icson::detail::po::CItemMultPriceInfo4MobilePo> 

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