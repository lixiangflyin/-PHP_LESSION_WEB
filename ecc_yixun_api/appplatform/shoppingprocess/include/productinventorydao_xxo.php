<?php

//source idl: com.icson.deal.idl.GetProductInfoResp.java

if (!class_exists('ProductInfo',false)) {
class ProductInfo
{
		/**
		 * 协议版本号
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
		var $dwProductId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cProductId_u; //uint8_t

		/**
		 * 分站id
		 *
		 * 版本 >= 0
		 */
		var $dwWhId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cWhId_u; //uint8_t

		/**
		 * 标志位
		 *
		 * 版本 >= 0
		 */
		var $nFlag; //int

		/**
		 * 版本 >= 0
		 */
		var $cFlag_u; //uint8_t

		/**
		 * type
		 *
		 * 版本 >= 0
		 */
		var $nType; //int

		/**
		 * 版本 >= 0
		 */
		var $cType_u; //uint8_t

		/**
		 * type2
		 *
		 * 版本 >= 0
		 */
		var $nType2; //int

		/**
		 * 版本 >= 0
		 */
		var $cType2_u; //uint8_t

		/**
		 * 状态
		 *
		 * 版本 >= 0
		 */
		var $nStatus; //int

		/**
		 * 版本 >= 0
		 */
		var $cStatus_u; //uint8_t

		/**
		 * 限运类型
		 *
		 * 版本 >= 0
		 */
		var $nRestrictedTransType; //int

		/**
		 * 版本 >= 0
		 */
		var $cRestrictedTransType_u; //uint8_t

		/**
		 * 在架时间
		 *
		 * 版本 >= 0
		 */
		var $dwOnShelfTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cOnShelfTime_u; //uint8_t

		/**
		 * 促销语
		 *
		 * 版本 >= 0
		 */
		var $strPromotionWord; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPromotionWord_u; //uint8_t

		/**
		 * 促销开始时间
		 *
		 * 版本 >= 0
		 */
		var $dwPromotionStart; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPromotionStart_u; //uint8_t

		/**
		 * 促销结束时间
		 *
		 * 版本 >= 0
		 */
		var $dwPromotionEnd; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPromotionEnd_u; //uint8_t

		/**
		 * 可用库存
		 *
		 * 版本 >= 0
		 */
		var $nAvailableNum; //int

		/**
		 * 版本 >= 0
		 */
		var $cAvailableNum_u; //uint8_t

		/**
		 * 虚拟库存
		 *
		 * 版本 >= 0
		 */
		var $nVirtualNum; //int

		/**
		 * 版本 >= 0
		 */
		var $cVirtualNum_u; //uint8_t

		/**
		 * arrival_days
		 *
		 * 版本 >= 0
		 */
		var $nArrivalDays; //int

		/**
		 * 版本 >= 0
		 */
		var $cArrivalDays_u; //uint8_t

		/**
		 * 市场价
		 *
		 * 版本 >= 0
		 */
		var $nMarketPrice; //int

		/**
		 * 版本 >= 0
		 */
		var $cMarketPrice_u; //uint8_t

		/**
		 * 价格
		 *
		 * 版本 >= 0
		 */
		var $nPrice; //int

		/**
		 * 版本 >= 0
		 */
		var $cPrice_u; //uint8_t

		/**
		 * 返现
		 *
		 * 版本 >= 0
		 */
		var $nCashBack; //int

		/**
		 * 版本 >= 0
		 */
		var $cCashBack_u; //uint8_t

		/**
		 * cost_price
		 *
		 * 版本 >= 0
		 */
		var $nCostPrice; //int

		/**
		 * 版本 >= 0
		 */
		var $cCostPrice_u; //uint8_t

		/**
		 * 限制数量
		 *
		 * 版本 >= 0
		 */
		var $nNumLimit; //int

		/**
		 * 版本 >= 0
		 */
		var $cNumLimit_u; //uint8_t

		/**
		 * is_clear_wh
		 *
		 * 版本 >= 0
		 */
		var $nIsClearWh; //int

		/**
		 * 版本 >= 0
		 */
		var $cIsClearWh_u; //uint8_t

		/**
		 * point_type
		 *
		 * 版本 >= 0
		 */
		var $nPointType; //int

		/**
		 * 版本 >= 0
		 */
		var $cPointType_u; //uint8_t

		/**
		 * point
		 *
		 * 版本 >= 0
		 */
		var $nPoint; //int

		/**
		 * 版本 >= 0
		 */
		var $cPoint_u; //uint8_t

		/**
		 * vip价格
		 *
		 * 版本 >= 0
		 */
		var $strVipPrice; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVipPrice_u; //uint8_t

		/**
		 * 更新时间
		 *
		 * 版本 >= 0
		 */
		var $dwUpdateTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cUpdateTime_u; //uint8_t

		/**
		 * psystock
		 *
		 * 版本 >= 0
		 */
		var $dwPsyStock; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPsyStock_u; //uint8_t

		/**
		 * 多价类型
		 *
		 * 版本 >= 0
		 */
		var $nMultiPriceType; //int

		/**
		 * 版本 >= 0
		 */
		var $cMultiPriceType_u; //uint8_t

		/**
		 * product_sale_type
		 *
		 * 版本 >= 0
		 */
		var $nProductSaleType; //int

		/**
		 * 版本 >= 0
		 */
		var $cProductSaleType_u; //uint8_t

		/**
		 * business_unit_cost_price
		 *
		 * 版本 >= 0
		 */
		var $nBusinessUnitCostPrice; //int

		/**
		 * 版本 >= 0
		 */
		var $cBusinessUnitCostPrice_u; //uint8_t

		/**
		 * sale_model
		 *
		 * 版本 >= 0
		 */
		var $nSaleModel; //int

		/**
		 * 版本 >= 0
		 */
		var $cSaleModel_u; //uint8_t

		/**
		 * lowest_num
		 *
		 * 版本 >= 0
		 */
		var $nLowestNum; //int

		/**
		 * 版本 >= 0
		 */
		var $cLowestNum_u; //uint8_t

		/**
		 * booking_type
		 *
		 * 版本 >= 0
		 */
		var $nBookingType; //int

		/**
		 * 版本 >= 0
		 */
		var $cBookingType_u; //uint8_t

		/**
		 * booking_value
		 *
		 * 版本 >= 0
		 */
		var $strBookingValue; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cBookingValue_u; //uint8_t

		/**
		 * 三级类目id
		 *
		 * 版本 >= 0
		 */
		var $strC3Ids; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cC3Ids_u; //uint8_t

		/**
		 * product_char_id
		 *
		 * 版本 >= 0
		 */
		var $strProductCharId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cProductCharId_u; //uint8_t

		/**
		 * mode
		 *
		 * 版本 >= 0
		 */
		var $strMode; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cMode_u; //uint8_t

		/**
		 * 名字
		 *
		 * 版本 >= 0
		 */
		var $strName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cName_u; //uint8_t

		/**
		 * 重量
		 *
		 * 版本 >= 0
		 */
		var $dwWeight; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cWeight_u; //uint8_t

		/**
		 * 图片数量
		 *
		 * 版本 >= 0
		 */
		var $dwPicNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPicNum_u; //uint8_t

		/**
		 * barcode
		 *
		 * 版本 >= 0
		 */
		var $strBarcode; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cBarcode_u; //uint8_t

		/**
		 * 颜色
		 *
		 * 版本 >= 0
		 */
		var $nColor; //int

		/**
		 * 版本 >= 0
		 */
		var $cColor_u; //uint8_t

		/**
		 * 尺码
		 *
		 * 版本 >= 0
		 */
		var $nProductSize; //int

		/**
		 * 版本 >= 0
		 */
		var $cProductSize_u; //uint8_t

		/**
		 * manufacturer
		 *
		 * 版本 >= 0
		 */
		var $nManufacturer; //int

		/**
		 * 版本 >= 0
		 */
		var $cManufacturer_u; //uint8_t

		/**
		 * warranty
		 *
		 * 版本 >= 0
		 */
		var $strWarranty; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cWarranty_u; //uint8_t

		/**
		 * masterid
		 *
		 * 版本 >= 0
		 */
		var $dwMasterid; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cMasterid_u; //uint8_t

		/**
		 * 卖家仓(地址)id
		 *
		 * 版本 >= 1
		 */
		var $nSellerAddressId; //int

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cSellerAddressId_u; //uint8_t

		/**
		 * 卖家id
		 *
		 * 版本 >= 1
		 */
		var $nSellerId; //int

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cSellerId_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwProductId = 0; // uint32_t
			 $this->cProductId_u = 0; // uint8_t
			 $this->dwWhId = 0; // uint32_t
			 $this->cWhId_u = 0; // uint8_t
			 $this->nFlag = 0; // int
			 $this->cFlag_u = 0; // uint8_t
			 $this->nType = 0; // int
			 $this->cType_u = 0; // uint8_t
			 $this->nType2 = 0; // int
			 $this->cType2_u = 0; // uint8_t
			 $this->nStatus = 0; // int
			 $this->cStatus_u = 0; // uint8_t
			 $this->nRestrictedTransType = 0; // int
			 $this->cRestrictedTransType_u = 0; // uint8_t
			 $this->dwOnShelfTime = 0; // uint32_t
			 $this->cOnShelfTime_u = 0; // uint8_t
			 $this->strPromotionWord = ""; // std::string
			 $this->cPromotionWord_u = 0; // uint8_t
			 $this->dwPromotionStart = 0; // uint32_t
			 $this->cPromotionStart_u = 0; // uint8_t
			 $this->dwPromotionEnd = 0; // uint32_t
			 $this->cPromotionEnd_u = 0; // uint8_t
			 $this->nAvailableNum = 0; // int
			 $this->cAvailableNum_u = 0; // uint8_t
			 $this->nVirtualNum = 0; // int
			 $this->cVirtualNum_u = 0; // uint8_t
			 $this->nArrivalDays = 0; // int
			 $this->cArrivalDays_u = 0; // uint8_t
			 $this->nMarketPrice = 0; // int
			 $this->cMarketPrice_u = 0; // uint8_t
			 $this->nPrice = 0; // int
			 $this->cPrice_u = 0; // uint8_t
			 $this->nCashBack = 0; // int
			 $this->cCashBack_u = 0; // uint8_t
			 $this->nCostPrice = 0; // int
			 $this->cCostPrice_u = 0; // uint8_t
			 $this->nNumLimit = 0; // int
			 $this->cNumLimit_u = 0; // uint8_t
			 $this->nIsClearWh = 0; // int
			 $this->cIsClearWh_u = 0; // uint8_t
			 $this->nPointType = 0; // int
			 $this->cPointType_u = 0; // uint8_t
			 $this->nPoint = 0; // int
			 $this->cPoint_u = 0; // uint8_t
			 $this->strVipPrice = ""; // std::string
			 $this->cVipPrice_u = 0; // uint8_t
			 $this->dwUpdateTime = 0; // uint32_t
			 $this->cUpdateTime_u = 0; // uint8_t
			 $this->dwPsyStock = 0; // uint32_t
			 $this->cPsyStock_u = 0; // uint8_t
			 $this->nMultiPriceType = 0; // int
			 $this->cMultiPriceType_u = 0; // uint8_t
			 $this->nProductSaleType = 0; // int
			 $this->cProductSaleType_u = 0; // uint8_t
			 $this->nBusinessUnitCostPrice = 0; // int
			 $this->cBusinessUnitCostPrice_u = 0; // uint8_t
			 $this->nSaleModel = 0; // int
			 $this->cSaleModel_u = 0; // uint8_t
			 $this->nLowestNum = 0; // int
			 $this->cLowestNum_u = 0; // uint8_t
			 $this->nBookingType = 0; // int
			 $this->cBookingType_u = 0; // uint8_t
			 $this->strBookingValue = ""; // std::string
			 $this->cBookingValue_u = 0; // uint8_t
			 $this->strC3Ids = ""; // std::string
			 $this->cC3Ids_u = 0; // uint8_t
			 $this->strProductCharId = ""; // std::string
			 $this->cProductCharId_u = 0; // uint8_t
			 $this->strMode = ""; // std::string
			 $this->cMode_u = 0; // uint8_t
			 $this->strName = ""; // std::string
			 $this->cName_u = 0; // uint8_t
			 $this->dwWeight = 0; // uint32_t
			 $this->cWeight_u = 0; // uint8_t
			 $this->dwPicNum = 0; // uint32_t
			 $this->cPicNum_u = 0; // uint8_t
			 $this->strBarcode = ""; // std::string
			 $this->cBarcode_u = 0; // uint8_t
			 $this->nColor = 0; // int
			 $this->cColor_u = 0; // uint8_t
			 $this->nProductSize = 0; // int
			 $this->cProductSize_u = 0; // uint8_t
			 $this->nManufacturer = 0; // int
			 $this->cManufacturer_u = 0; // uint8_t
			 $this->strWarranty = ""; // std::string
			 $this->cWarranty_u = 0; // uint8_t
			 $this->dwMasterid = 0; // uint32_t
			 $this->cMasterid_u = 0; // uint8_t
			 $this->nSellerAddressId = 0; // int
			 $this->cSellerAddressId_u = 0; // uint8_t
			 $this->nSellerId = 0; // int
			 $this->cSellerId_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwProductId); // 序列化商品id 类型为uint32_t
			$bs->pushUint8_t($this->cProductId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwWhId); // 序列化分站id 类型为uint32_t
			$bs->pushUint8_t($this->cWhId_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nFlag); // 序列化标志位 类型为int
			$bs->pushUint8_t($this->cFlag_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nType); // 序列化type 类型为int
			$bs->pushUint8_t($this->cType_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nType2); // 序列化type2 类型为int
			$bs->pushUint8_t($this->cType2_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nStatus); // 序列化状态 类型为int
			$bs->pushUint8_t($this->cStatus_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nRestrictedTransType); // 序列化限运类型 类型为int
			$bs->pushUint8_t($this->cRestrictedTransType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwOnShelfTime); // 序列化在架时间 类型为uint32_t
			$bs->pushUint8_t($this->cOnShelfTime_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPromotionWord); // 序列化促销语 类型为std::string
			$bs->pushUint8_t($this->cPromotionWord_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPromotionStart); // 序列化促销开始时间 类型为uint32_t
			$bs->pushUint8_t($this->cPromotionStart_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPromotionEnd); // 序列化促销结束时间 类型为uint32_t
			$bs->pushUint8_t($this->cPromotionEnd_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nAvailableNum); // 序列化可用库存 类型为int
			$bs->pushUint8_t($this->cAvailableNum_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nVirtualNum); // 序列化虚拟库存 类型为int
			$bs->pushUint8_t($this->cVirtualNum_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nArrivalDays); // 序列化arrival_days 类型为int
			$bs->pushUint8_t($this->cArrivalDays_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nMarketPrice); // 序列化市场价 类型为int
			$bs->pushUint8_t($this->cMarketPrice_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nPrice); // 序列化价格 类型为int
			$bs->pushUint8_t($this->cPrice_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nCashBack); // 序列化返现 类型为int
			$bs->pushUint8_t($this->cCashBack_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nCostPrice); // 序列化cost_price 类型为int
			$bs->pushUint8_t($this->cCostPrice_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nNumLimit); // 序列化限制数量 类型为int
			$bs->pushUint8_t($this->cNumLimit_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nIsClearWh); // 序列化is_clear_wh 类型为int
			$bs->pushUint8_t($this->cIsClearWh_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nPointType); // 序列化point_type 类型为int
			$bs->pushUint8_t($this->cPointType_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nPoint); // 序列化point 类型为int
			$bs->pushUint8_t($this->cPoint_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strVipPrice); // 序列化vip价格 类型为std::string
			$bs->pushUint8_t($this->cVipPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwUpdateTime); // 序列化更新时间 类型为uint32_t
			$bs->pushUint8_t($this->cUpdateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPsyStock); // 序列化psystock 类型为uint32_t
			$bs->pushUint8_t($this->cPsyStock_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nMultiPriceType); // 序列化多价类型 类型为int
			$bs->pushUint8_t($this->cMultiPriceType_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nProductSaleType); // 序列化product_sale_type 类型为int
			$bs->pushUint8_t($this->cProductSaleType_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nBusinessUnitCostPrice); // 序列化business_unit_cost_price 类型为int
			$bs->pushUint8_t($this->cBusinessUnitCostPrice_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nSaleModel); // 序列化sale_model 类型为int
			$bs->pushUint8_t($this->cSaleModel_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nLowestNum); // 序列化lowest_num 类型为int
			$bs->pushUint8_t($this->cLowestNum_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nBookingType); // 序列化booking_type 类型为int
			$bs->pushUint8_t($this->cBookingType_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strBookingValue); // 序列化booking_value 类型为std::string
			$bs->pushUint8_t($this->cBookingValue_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strC3Ids); // 序列化三级类目id 类型为std::string
			$bs->pushUint8_t($this->cC3Ids_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strProductCharId); // 序列化product_char_id 类型为std::string
			$bs->pushUint8_t($this->cProductCharId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strMode); // 序列化mode 类型为std::string
			$bs->pushUint8_t($this->cMode_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strName); // 序列化名字 类型为std::string
			$bs->pushUint8_t($this->cName_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwWeight); // 序列化重量 类型为uint32_t
			$bs->pushUint8_t($this->cWeight_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPicNum); // 序列化图片数量 类型为uint32_t
			$bs->pushUint8_t($this->cPicNum_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strBarcode); // 序列化barcode 类型为std::string
			$bs->pushUint8_t($this->cBarcode_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nColor); // 序列化颜色 类型为int
			$bs->pushUint8_t($this->cColor_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nProductSize); // 序列化尺码 类型为int
			$bs->pushUint8_t($this->cProductSize_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nManufacturer); // 序列化manufacturer 类型为int
			$bs->pushUint8_t($this->cManufacturer_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strWarranty); // 序列化warranty 类型为std::string
			$bs->pushUint8_t($this->cWarranty_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwMasterid); // 序列化masterid 类型为uint32_t
			$bs->pushUint8_t($this->cMasterid_u); // 序列化 类型为uint8_t
			if(  $this->dwVersion >= 1 ){
				$bs->pushInt32_t($this->nSellerAddressId); // 序列化卖家仓(地址)id 类型为int
			}
			if(  $this->dwVersion >= 1 ){
				$bs->pushUint8_t($this->cSellerAddressId_u); // 序列化 类型为uint8_t
			}
			if(  $this->dwVersion >= 1 ){
				$bs->pushInt32_t($this->nSellerId); // 序列化卖家id 类型为int
			}
			if(  $this->dwVersion >= 1 ){
				$bs->pushUint8_t($this->cSellerId_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwProductId = $bs->popUint32_t(); // 反序列化商品id 类型为uint32_t
			$this->cProductId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwWhId = $bs->popUint32_t(); // 反序列化分站id 类型为uint32_t
			$this->cWhId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nFlag = $bs->popInt32_t(); // 反序列化标志位 类型为int
			$this->cFlag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nType = $bs->popInt32_t(); // 反序列化type 类型为int
			$this->cType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nType2 = $bs->popInt32_t(); // 反序列化type2 类型为int
			$this->cType2_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nStatus = $bs->popInt32_t(); // 反序列化状态 类型为int
			$this->cStatus_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nRestrictedTransType = $bs->popInt32_t(); // 反序列化限运类型 类型为int
			$this->cRestrictedTransType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwOnShelfTime = $bs->popUint32_t(); // 反序列化在架时间 类型为uint32_t
			$this->cOnShelfTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPromotionWord = $bs->popString(); // 反序列化促销语 类型为std::string
			$this->cPromotionWord_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPromotionStart = $bs->popUint32_t(); // 反序列化促销开始时间 类型为uint32_t
			$this->cPromotionStart_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPromotionEnd = $bs->popUint32_t(); // 反序列化促销结束时间 类型为uint32_t
			$this->cPromotionEnd_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nAvailableNum = $bs->popInt32_t(); // 反序列化可用库存 类型为int
			$this->cAvailableNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nVirtualNum = $bs->popInt32_t(); // 反序列化虚拟库存 类型为int
			$this->cVirtualNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nArrivalDays = $bs->popInt32_t(); // 反序列化arrival_days 类型为int
			$this->cArrivalDays_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nMarketPrice = $bs->popInt32_t(); // 反序列化市场价 类型为int
			$this->cMarketPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nPrice = $bs->popInt32_t(); // 反序列化价格 类型为int
			$this->cPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nCashBack = $bs->popInt32_t(); // 反序列化返现 类型为int
			$this->cCashBack_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nCostPrice = $bs->popInt32_t(); // 反序列化cost_price 类型为int
			$this->cCostPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nNumLimit = $bs->popInt32_t(); // 反序列化限制数量 类型为int
			$this->cNumLimit_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nIsClearWh = $bs->popInt32_t(); // 反序列化is_clear_wh 类型为int
			$this->cIsClearWh_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nPointType = $bs->popInt32_t(); // 反序列化point_type 类型为int
			$this->cPointType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nPoint = $bs->popInt32_t(); // 反序列化point 类型为int
			$this->cPoint_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strVipPrice = $bs->popString(); // 反序列化vip价格 类型为std::string
			$this->cVipPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwUpdateTime = $bs->popUint32_t(); // 反序列化更新时间 类型为uint32_t
			$this->cUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPsyStock = $bs->popUint32_t(); // 反序列化psystock 类型为uint32_t
			$this->cPsyStock_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nMultiPriceType = $bs->popInt32_t(); // 反序列化多价类型 类型为int
			$this->cMultiPriceType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nProductSaleType = $bs->popInt32_t(); // 反序列化product_sale_type 类型为int
			$this->cProductSaleType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nBusinessUnitCostPrice = $bs->popInt32_t(); // 反序列化business_unit_cost_price 类型为int
			$this->cBusinessUnitCostPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nSaleModel = $bs->popInt32_t(); // 反序列化sale_model 类型为int
			$this->cSaleModel_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nLowestNum = $bs->popInt32_t(); // 反序列化lowest_num 类型为int
			$this->cLowestNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nBookingType = $bs->popInt32_t(); // 反序列化booking_type 类型为int
			$this->cBookingType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strBookingValue = $bs->popString(); // 反序列化booking_value 类型为std::string
			$this->cBookingValue_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strC3Ids = $bs->popString(); // 反序列化三级类目id 类型为std::string
			$this->cC3Ids_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strProductCharId = $bs->popString(); // 反序列化product_char_id 类型为std::string
			$this->cProductCharId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strMode = $bs->popString(); // 反序列化mode 类型为std::string
			$this->cMode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strName = $bs->popString(); // 反序列化名字 类型为std::string
			$this->cName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwWeight = $bs->popUint32_t(); // 反序列化重量 类型为uint32_t
			$this->cWeight_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPicNum = $bs->popUint32_t(); // 反序列化图片数量 类型为uint32_t
			$this->cPicNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strBarcode = $bs->popString(); // 反序列化barcode 类型为std::string
			$this->cBarcode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nColor = $bs->popInt32_t(); // 反序列化颜色 类型为int
			$this->cColor_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nProductSize = $bs->popInt32_t(); // 反序列化尺码 类型为int
			$this->cProductSize_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nManufacturer = $bs->popInt32_t(); // 反序列化manufacturer 类型为int
			$this->cManufacturer_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strWarranty = $bs->popString(); // 反序列化warranty 类型为std::string
			$this->cWarranty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwMasterid = $bs->popUint32_t(); // 反序列化masterid 类型为uint32_t
			$this->cMasterid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->dwVersion >= 1 ){
				$this->nSellerAddressId = $bs->popInt32_t(); // 反序列化卖家仓(地址)id 类型为int
			}
			if(  $this->dwVersion >= 1 ){
				$this->cSellerAddressId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->dwVersion >= 1 ){
				$this->nSellerId = $bs->popInt32_t(); // 反序列化卖家id 类型为int
			}
			if(  $this->dwVersion >= 1 ){
				$this->cSellerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}

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


//source idl: com.icson.deal.idl.GetProductInfoReq.java

if (!class_exists('ProductParam',false)) {
class ProductParam
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 商品id列表
		 *
		 * 版本 >= 0
		 */
		var $vecProductIdList; //std::vector<uint32_t> 

		/**
		 * 版本 >= 0
		 */
		var $cProductIdList_u; //uint8_t

		/**
		 * 分站id
		 *
		 * 版本 >= 0
		 */
		var $dwWhId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cWhId_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->vecProductIdList = new stl_vector('uint32_t'); // std::vector<uint32_t> 
			 $this->cProductIdList_u = 0; // uint8_t
			 $this->dwWhId = 0; // uint32_t
			 $this->cWhId_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecProductIdList,'stl_vector'); // 序列化商品id列表 类型为std::vector<uint32_t> 
			$bs->pushUint8_t($this->cProductIdList_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwWhId); // 序列化分站id 类型为uint32_t
			$bs->pushUint8_t($this->cWhId_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecProductIdList = $bs->popObject('stl_vector<uint32_t>'); // 反序列化商品id列表 类型为std::vector<uint32_t> 
			$this->cProductIdList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwWhId = $bs->popUint32_t(); // 反序列化分站id 类型为uint32_t
			$this->cWhId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.deal.idl.GetInventeoryInfoResp.java

if (!class_exists('InventoryInfo',false)) {
class InventoryInfo
{
		/**
		 * 协议版本号
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
		var $dwProductId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cProductId_u; //uint8_t

		/**
		 * 销售分仓id
		 *
		 * 版本 >= 0
		 */
		var $dwSaleStockId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSaleStockId_u; //uint8_t

		/**
		 * 供货分仓id
		 *
		 * 版本 >= 0
		 */
		var $dwSupplyStockId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSupplyStockId_u; //uint8_t

		/**
		 * 可用库存
		 *
		 * 版本 >= 0
		 */
		var $nAvailableNum; //int

		/**
		 * 版本 >= 0
		 */
		var $cAvailableNum_u; //uint8_t

		/**
		 * 虚拟库存
		 *
		 * 版本 >= 0
		 */
		var $nVirtualNum; //int

		/**
		 * 版本 >= 0
		 */
		var $cVirtualNum_u; //uint8_t

		/**
		 * 财务库存
		 *
		 * 版本 >= 0
		 */
		var $nAccountNum; //int

		/**
		 * 版本 >= 0
		 */
		var $cAccountNum_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwProductId = 0; // uint32_t
			 $this->cProductId_u = 0; // uint8_t
			 $this->dwSaleStockId = 0; // uint32_t
			 $this->cSaleStockId_u = 0; // uint8_t
			 $this->dwSupplyStockId = 0; // uint32_t
			 $this->cSupplyStockId_u = 0; // uint8_t
			 $this->nAvailableNum = 0; // int
			 $this->cAvailableNum_u = 0; // uint8_t
			 $this->nVirtualNum = 0; // int
			 $this->cVirtualNum_u = 0; // uint8_t
			 $this->nAccountNum = 0; // int
			 $this->cAccountNum_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwProductId); // 序列化商品id 类型为uint32_t
			$bs->pushUint8_t($this->cProductId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSaleStockId); // 序列化销售分仓id 类型为uint32_t
			$bs->pushUint8_t($this->cSaleStockId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSupplyStockId); // 序列化供货分仓id 类型为uint32_t
			$bs->pushUint8_t($this->cSupplyStockId_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nAvailableNum); // 序列化可用库存 类型为int
			$bs->pushUint8_t($this->cAvailableNum_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nVirtualNum); // 序列化虚拟库存 类型为int
			$bs->pushUint8_t($this->cVirtualNum_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nAccountNum); // 序列化财务库存 类型为int
			$bs->pushUint8_t($this->cAccountNum_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwProductId = $bs->popUint32_t(); // 反序列化商品id 类型为uint32_t
			$this->cProductId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSaleStockId = $bs->popUint32_t(); // 反序列化销售分仓id 类型为uint32_t
			$this->cSaleStockId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSupplyStockId = $bs->popUint32_t(); // 反序列化供货分仓id 类型为uint32_t
			$this->cSupplyStockId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nAvailableNum = $bs->popInt32_t(); // 反序列化可用库存 类型为int
			$this->cAvailableNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nVirtualNum = $bs->popInt32_t(); // 反序列化虚拟库存 类型为int
			$this->cVirtualNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nAccountNum = $bs->popInt32_t(); // 反序列化财务库存 类型为int
			$this->cAccountNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.deal.idl.GetInventeoryInfoReq.java

if (!class_exists('InventoryParam',false)) {
class InventoryParam
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 商品id列表
		 *
		 * 版本 >= 0
		 */
		var $vecProductIdList; //std::vector<uint32_t> 

		/**
		 * 版本 >= 0
		 */
		var $cProductIdList_u; //uint8_t

		/**
		 * 三级地址id
		 *
		 * 版本 >= 0
		 */
		var $dwDistrictId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cDistrictId_u; //uint8_t

		/**
		 * 分站id
		 *
		 * 版本 >= 0
		 */
		var $dwWhId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cWhId_u; //uint8_t

		/**
		 * 物理仓id
		 *
		 * 版本 >= 0
		 */
		var $dwStockId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockId_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->vecProductIdList = new stl_vector('uint32_t'); // std::vector<uint32_t> 
			 $this->cProductIdList_u = 0; // uint8_t
			 $this->dwDistrictId = 0; // uint32_t
			 $this->cDistrictId_u = 0; // uint8_t
			 $this->dwWhId = 0; // uint32_t
			 $this->cWhId_u = 0; // uint8_t
			 $this->dwStockId = 0; // uint32_t
			 $this->cStockId_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecProductIdList,'stl_vector'); // 序列化商品id列表 类型为std::vector<uint32_t> 
			$bs->pushUint8_t($this->cProductIdList_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwDistrictId); // 序列化三级地址id 类型为uint32_t
			$bs->pushUint8_t($this->cDistrictId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwWhId); // 序列化分站id 类型为uint32_t
			$bs->pushUint8_t($this->cWhId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockId); // 序列化物理仓id 类型为uint32_t
			$bs->pushUint8_t($this->cStockId_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecProductIdList = $bs->popObject('stl_vector<uint32_t>'); // 反序列化商品id列表 类型为std::vector<uint32_t> 
			$this->cProductIdList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwDistrictId = $bs->popUint32_t(); // 反序列化三级地址id 类型为uint32_t
			$this->cDistrictId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwWhId = $bs->popUint32_t(); // 反序列化分站id 类型为uint32_t
			$this->cWhId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockId = $bs->popUint32_t(); // 反序列化物理仓id 类型为uint32_t
			$this->cStockId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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