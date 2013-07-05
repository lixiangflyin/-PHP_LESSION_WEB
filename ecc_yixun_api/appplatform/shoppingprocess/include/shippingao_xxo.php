<?php

//source idl: com.icson.deal.idl.ShippingAo.java

if (!class_exists('ShippingSmallParam', false)) {
class ShippingSmallParam
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
		 * 商品ID
		 *
		 * 版本 >= 0
		 */
		var $dwProductId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cProductId_u; //uint8_t

		/**
		 * 商户ID（区分新联营）
		 *
		 * 版本 >= 0
		 */
		var $dwSellerId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * 商品预购类型
		 *
		 * 版本 >= 0
		 */
		var $dwBookingType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cBookingType_u; //uint8_t

		/**
		 * 商品预购值
		 *
		 * 版本 >= 0
		 */
		var $dwBookingValue; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cBookingValue_u; //uint8_t

		/**
		 * 商品限运类型
		 *
		 * 版本 >= 0
		 */
		var $dwRestrictedTransType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cRestrictedTransType_u; //uint8_t

		/**
		 * 购买数量
		 *
		 * 版本 >= 0
		 */
		var $dwBuyCount; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyCount_u; //uint8_t

		/**
		 * 需查询配送的商品库存信息
		 *
		 * 版本 >= 0
		 */
		var $oInventoryInfo; //icson::deal::bo::CInventoryInfo

		/**
		 * 版本 >= 0
		 */
		var $cInventoryInfo_u; //uint8_t

		/**
		 * flag
		 *
		 * 版本 >= 1
		 */
		var $dwFlag; //uint32_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cFlag_u; //uint8_t

		/**
		 * type
		 *
		 * 版本 >= 1
		 */
		var $dwType; //uint32_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cType_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwProductId = 0; // uint32_t
			 $this->cProductId_u = 0; // uint8_t
			 $this->dwSellerId = 0; // uint32_t
			 $this->cSellerId_u = 0; // uint8_t
			 $this->dwBookingType = 0; // uint32_t
			 $this->cBookingType_u = 0; // uint8_t
			 $this->dwBookingValue = 0; // uint32_t
			 $this->cBookingValue_u = 0; // uint8_t
			 $this->dwRestrictedTransType = 0; // uint32_t
			 $this->cRestrictedTransType_u = 0; // uint8_t
			 $this->dwBuyCount = 0; // uint32_t
			 $this->cBuyCount_u = 0; // uint8_t
			 $this->oInventoryInfo = new InventoryInfo(); // icson::deal::bo::CInventoryInfo
			 $this->cInventoryInfo_u = 0; // uint8_t
			 $this->dwFlag = 0; // uint32_t
			 $this->cFlag_u = 0; // uint8_t
			 $this->dwType = 0; // uint32_t
			 $this->cType_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwProductId); // 序列化商品ID 类型为uint32_t
			$bs->pushUint8_t($this->cProductId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSellerId); // 序列化商户ID（区分新联营） 类型为uint32_t
			$bs->pushUint8_t($this->cSellerId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwBookingType); // 序列化商品预购类型 类型为uint32_t
			$bs->pushUint8_t($this->cBookingType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwBookingValue); // 序列化商品预购值 类型为uint32_t
			$bs->pushUint8_t($this->cBookingValue_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwRestrictedTransType); // 序列化商品限运类型 类型为uint32_t
			$bs->pushUint8_t($this->cRestrictedTransType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwBuyCount); // 序列化购买数量 类型为uint32_t
			$bs->pushUint8_t($this->cBuyCount_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->oInventoryInfo,'InventoryInfo'); // 序列化需查询配送的商品库存信息 类型为icson::deal::bo::CInventoryInfo
			$bs->pushUint8_t($this->cInventoryInfo_u); // 序列化 类型为uint8_t
			if(  $this->dwVersion >= 1 ){
				$bs->pushUint32_t($this->dwFlag); // 序列化flag 类型为uint32_t
			}
			if(  $this->dwVersion >= 1 ){
				$bs->pushUint8_t($this->cFlag_u); // 序列化 类型为uint8_t
			}
			if(  $this->dwVersion >= 1 ){
				$bs->pushUint32_t($this->dwType); // 序列化type 类型为uint32_t
			}
			if(  $this->dwVersion >= 1 ){
				$bs->pushUint8_t($this->cType_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwProductId = $bs->popUint32_t(); // 反序列化商品ID 类型为uint32_t
			$this->cProductId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSellerId = $bs->popUint32_t(); // 反序列化商户ID（区分新联营） 类型为uint32_t
			$this->cSellerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwBookingType = $bs->popUint32_t(); // 反序列化商品预购类型 类型为uint32_t
			$this->cBookingType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwBookingValue = $bs->popUint32_t(); // 反序列化商品预购值 类型为uint32_t
			$this->cBookingValue_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRestrictedTransType = $bs->popUint32_t(); // 反序列化商品限运类型 类型为uint32_t
			$this->cRestrictedTransType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwBuyCount = $bs->popUint32_t(); // 反序列化购买数量 类型为uint32_t
			$this->cBuyCount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->oInventoryInfo = $bs->popObject('InventoryInfo'); // 反序列化需查询配送的商品库存信息 类型为icson::deal::bo::CInventoryInfo
			$this->cInventoryInfo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->dwVersion >= 1 ){
				$this->dwFlag = $bs->popUint32_t(); // 反序列化flag 类型为uint32_t
			}
			if(  $this->dwVersion >= 1 ){
				$this->cFlag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->dwVersion >= 1 ){
				$this->dwType = $bs->popUint32_t(); // 反序列化type 类型为uint32_t
			}
			if(  $this->dwVersion >= 1 ){
				$this->cType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.icson.deal.idl.ShippingAo.java

if (!class_exists('ShippingParam', false)) {
class ShippingParam
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
		 * 商品ID
		 *
		 * 版本 >= 0
		 */
		var $dwProductId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cProductId_u; //uint8_t

		/**
		 * 商品预购类型
		 *
		 * 版本 >= 0
		 */
		var $dwBookingType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cBookingType_u; //uint8_t

		/**
		 * 商品预购值
		 *
		 * 版本 >= 0
		 */
		var $dwBookingValue; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cBookingValue_u; //uint8_t

		/**
		 * 商品限运类型
		 *
		 * 版本 >= 0
		 */
		var $dwRestrictedTransType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cRestrictedTransType_u; //uint8_t

		/**
		 * 需查询配送的商品库存信息
		 *
		 * 版本 >= 0
		 */
		var $oInventoryInfo; //icson::deal::bo::CInventoryInfo

		/**
		 * 版本 >= 0
		 */
		var $cInventoryInfo_u; //uint8_t

		/**
		 * 商户ID（区分新联营）
		 *
		 * 版本 >= 0
		 */
		var $dwSellerId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * 商户地址(仓)ID，新联营特性
		 *
		 * 版本 >= 0
		 */
		var $dwSellerStockId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerStockId_u; //uint8_t

		/**
		 * 商品flag
		 *
		 * 版本 >= 0
		 */
		var $dwFlag; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cFlag_u; //uint8_t

		/**
		 * 商品价格，取促销处理后total_price_after
		 *
		 * 版本 >= 0
		 */
		var $dwPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPrice_u; //uint8_t

		/**
		 * 商品重量
		 *
		 * 版本 >= 0
		 */
		var $dwWeight; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cWeight_u; //uint8_t

		/**
		 * 购买数量
		 *
		 * 版本 >= 0
		 */
		var $dwBuyCount; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyCount_u; //uint8_t

		/**
		 * 返现
		 *
		 * 版本 >= 0
		 */
		var $dwCashBack; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cCashBack_u; //uint8_t

		/**
		 * c3_ids，三级类目ID
		 *
		 * 版本 >= 0
		 */
		var $dwC3Ids; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cC3Ids_u; //uint8_t

		/**
		 * 赠品信息
		 *
		 * 版本 >= 0
		 */
		var $vecGiftList; //std::vector<icson::deal::bo::CGiftInfo4Shipping> 

		/**
		 * 版本 >= 0
		 */
		var $cGiftList_u; //uint8_t

		/**
		 * type
		 *
		 * 版本 >= 1
		 */
		var $dwType; //uint32_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cType_u; //uint8_t

		/**
		 * 商品长宽高重信息
		 *
		 * 版本 >= 1
		 */
		var $oSizeInfo; //oms::ordersize::po::CProductUnitPo

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cSizeInfo_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwProductId = 0; // uint32_t
			 $this->cProductId_u = 0; // uint8_t
			 $this->dwBookingType = 0; // uint32_t
			 $this->cBookingType_u = 0; // uint8_t
			 $this->dwBookingValue = 0; // uint32_t
			 $this->cBookingValue_u = 0; // uint8_t
			 $this->dwRestrictedTransType = 0; // uint32_t
			 $this->cRestrictedTransType_u = 0; // uint8_t
			 $this->oInventoryInfo = new InventoryInfo(); // icson::deal::bo::CInventoryInfo
			 $this->cInventoryInfo_u = 0; // uint8_t
			 $this->dwSellerId = 0; // uint32_t
			 $this->cSellerId_u = 0; // uint8_t
			 $this->dwSellerStockId = 0; // uint32_t
			 $this->cSellerStockId_u = 0; // uint8_t
			 $this->dwFlag = 0; // uint32_t
			 $this->cFlag_u = 0; // uint8_t
			 $this->dwPrice = 0; // uint32_t
			 $this->cPrice_u = 0; // uint8_t
			 $this->dwWeight = 0; // uint32_t
			 $this->cWeight_u = 0; // uint8_t
			 $this->dwBuyCount = 0; // uint32_t
			 $this->cBuyCount_u = 0; // uint8_t
			 $this->dwCashBack = 0; // uint32_t
			 $this->cCashBack_u = 0; // uint8_t
			 $this->dwC3Ids = 0; // uint32_t
			 $this->cC3Ids_u = 0; // uint8_t
			 $this->vecGiftList = new stl_vector('GiftInfo4Shipping'); // std::vector<icson::deal::bo::CGiftInfo4Shipping> 
			 $this->cGiftList_u = 0; // uint8_t
			 $this->dwType = 0; // uint32_t
			 $this->cType_u = 0; // uint8_t
			 $this->oSizeInfo = new ProductUnitPo(); // oms::ordersize::po::CProductUnitPo
			 $this->cSizeInfo_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwProductId); // 序列化商品ID 类型为uint32_t
			$bs->pushUint8_t($this->cProductId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwBookingType); // 序列化商品预购类型 类型为uint32_t
			$bs->pushUint8_t($this->cBookingType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwBookingValue); // 序列化商品预购值 类型为uint32_t
			$bs->pushUint8_t($this->cBookingValue_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwRestrictedTransType); // 序列化商品限运类型 类型为uint32_t
			$bs->pushUint8_t($this->cRestrictedTransType_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->oInventoryInfo,'InventoryInfo'); // 序列化需查询配送的商品库存信息 类型为icson::deal::bo::CInventoryInfo
			$bs->pushUint8_t($this->cInventoryInfo_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSellerId); // 序列化商户ID（区分新联营） 类型为uint32_t
			$bs->pushUint8_t($this->cSellerId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSellerStockId); // 序列化商户地址(仓)ID，新联营特性 类型为uint32_t
			$bs->pushUint8_t($this->cSellerStockId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwFlag); // 序列化商品flag 类型为uint32_t
			$bs->pushUint8_t($this->cFlag_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPrice); // 序列化商品价格，取促销处理后total_price_after 类型为uint32_t
			$bs->pushUint8_t($this->cPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwWeight); // 序列化商品重量 类型为uint32_t
			$bs->pushUint8_t($this->cWeight_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwBuyCount); // 序列化购买数量 类型为uint32_t
			$bs->pushUint8_t($this->cBuyCount_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwCashBack); // 序列化返现 类型为uint32_t
			$bs->pushUint8_t($this->cCashBack_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwC3Ids); // 序列化c3_ids，三级类目ID 类型为uint32_t
			$bs->pushUint8_t($this->cC3Ids_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecGiftList,'stl_vector'); // 序列化赠品信息 类型为std::vector<icson::deal::bo::CGiftInfo4Shipping> 
			$bs->pushUint8_t($this->cGiftList_u); // 序列化 类型为uint8_t
			if(  $this->dwVersion >= 1 ){
				$bs->pushUint32_t($this->dwType); // 序列化type 类型为uint32_t
			}
			if(  $this->dwVersion >= 1 ){
				$bs->pushUint8_t($this->cType_u); // 序列化 类型为uint8_t
			}
			if(  $this->dwVersion >= 1 ){
				$bs->pushObject($this->oSizeInfo,'ProductUnitPo'); // 序列化商品长宽高重信息 类型为oms::ordersize::po::CProductUnitPo
			}
			if(  $this->dwVersion >= 1 ){
				$bs->pushUint8_t($this->cSizeInfo_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwProductId = $bs->popUint32_t(); // 反序列化商品ID 类型为uint32_t
			$this->cProductId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwBookingType = $bs->popUint32_t(); // 反序列化商品预购类型 类型为uint32_t
			$this->cBookingType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwBookingValue = $bs->popUint32_t(); // 反序列化商品预购值 类型为uint32_t
			$this->cBookingValue_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRestrictedTransType = $bs->popUint32_t(); // 反序列化商品限运类型 类型为uint32_t
			$this->cRestrictedTransType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->oInventoryInfo = $bs->popObject('InventoryInfo'); // 反序列化需查询配送的商品库存信息 类型为icson::deal::bo::CInventoryInfo
			$this->cInventoryInfo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSellerId = $bs->popUint32_t(); // 反序列化商户ID（区分新联营） 类型为uint32_t
			$this->cSellerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSellerStockId = $bs->popUint32_t(); // 反序列化商户地址(仓)ID，新联营特性 类型为uint32_t
			$this->cSellerStockId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwFlag = $bs->popUint32_t(); // 反序列化商品flag 类型为uint32_t
			$this->cFlag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPrice = $bs->popUint32_t(); // 反序列化商品价格，取促销处理后total_price_after 类型为uint32_t
			$this->cPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwWeight = $bs->popUint32_t(); // 反序列化商品重量 类型为uint32_t
			$this->cWeight_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwBuyCount = $bs->popUint32_t(); // 反序列化购买数量 类型为uint32_t
			$this->cBuyCount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwCashBack = $bs->popUint32_t(); // 反序列化返现 类型为uint32_t
			$this->cCashBack_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwC3Ids = $bs->popUint32_t(); // 反序列化c3_ids，三级类目ID 类型为uint32_t
			$this->cC3Ids_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecGiftList = $bs->popObject('stl_vector<GiftInfo4Shipping>'); // 反序列化赠品信息 类型为std::vector<icson::deal::bo::CGiftInfo4Shipping> 
			$this->cGiftList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->dwVersion >= 1 ){
				$this->dwType = $bs->popUint32_t(); // 反序列化type 类型为uint32_t
			}
			if(  $this->dwVersion >= 1 ){
				$this->cType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->dwVersion >= 1 ){
				$this->oSizeInfo = $bs->popObject('ProductUnitPo'); // 反序列化商品长宽高重信息 类型为oms::ordersize::po::CProductUnitPo
			}
			if(  $this->dwVersion >= 1 ){
				$this->cSizeInfo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.icson.deal.idl.ShippingParam.java

if (!class_exists('InventoryInfo', false)) {
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


//source idl: com.icson.deal.idl.ShippingAo.java

if (!class_exists('OrderShippingInfo', false)) {
class OrderShippingInfo
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
		 * <packageId, 包裹信息>
		 *
		 * 版本 >= 0
		 */
		var $mapPackageList; //std::map<std::string,icson::deal::bo::CShippingPackageInfo> 

		/**
		 * 版本 >= 0
		 */
		var $cPackageList_u; //uint8_t

		/**
		 * <packageId, 延迟类型>
		 *
		 * 版本 >= 0
		 */
		var $mapDelayList; //std::map<std::string,icson::deal::bo::CDelayInfo> 

		/**
		 * 版本 >= 0
		 */
		var $cDelayList_u; //uint8_t

		/**
		 * 订单配送信息
		 *
		 * 版本 >= 0
		 */
		var $vecShipinfo; //std::vector<icson::deal::bo::CShippingInfo> 

		/**
		 * 版本 >= 0
		 */
		var $cShipinfo_u; //uint8_t

		/**
		 * 可开增值票，1/0:是/否
		 *
		 * 版本 >= 0
		 */
		var $dwIsCanVAT; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cIsCanVAT_u; //uint8_t

		/**
		 * 存在笔记本类商品，1/0:是/否
		 *
		 * 版本 >= 0
		 */
		var $dwHasNoteBook; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cHasNoteBook_u; //uint8_t

		/**
		 * 订单总重量
		 *
		 * 版本 >= 0
		 */
		var $dwTotalWeight; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTotalWeight_u; //uint8_t

		/**
		 * 订单总返现
		 *
		 * 版本 >= 0
		 */
		var $dwTotalCut; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTotalCut_u; //uint8_t

		/**
		 * 订单总金额，以促销2.0为准
		 *
		 * 版本 >= 0
		 */
		var $dwTotalAmt; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTotalAmt_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->mapPackageList = new stl_map('stl_string,ShippingPackageInfo'); // std::map<std::string,icson::deal::bo::CShippingPackageInfo> 
			 $this->cPackageList_u = 0; // uint8_t
			 $this->mapDelayList = new stl_map('stl_string,DelayInfo'); // std::map<std::string,icson::deal::bo::CDelayInfo> 
			 $this->cDelayList_u = 0; // uint8_t
			 $this->vecShipinfo = new stl_vector('ShippingInfo'); // std::vector<icson::deal::bo::CShippingInfo> 
			 $this->cShipinfo_u = 0; // uint8_t
			 $this->dwIsCanVAT = 0; // uint32_t
			 $this->cIsCanVAT_u = 0; // uint8_t
			 $this->dwHasNoteBook = 0; // uint32_t
			 $this->cHasNoteBook_u = 0; // uint8_t
			 $this->dwTotalWeight = 0; // uint32_t
			 $this->cTotalWeight_u = 0; // uint8_t
			 $this->dwTotalCut = 0; // uint32_t
			 $this->cTotalCut_u = 0; // uint8_t
			 $this->dwTotalAmt = 0; // uint32_t
			 $this->cTotalAmt_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->mapPackageList,'stl_map'); // 序列化<packageId, 包裹信息> 类型为std::map<std::string,icson::deal::bo::CShippingPackageInfo> 
			$bs->pushUint8_t($this->cPackageList_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->mapDelayList,'stl_map'); // 序列化<packageId, 延迟类型> 类型为std::map<std::string,icson::deal::bo::CDelayInfo> 
			$bs->pushUint8_t($this->cDelayList_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecShipinfo,'stl_vector'); // 序列化订单配送信息 类型为std::vector<icson::deal::bo::CShippingInfo> 
			$bs->pushUint8_t($this->cShipinfo_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwIsCanVAT); // 序列化可开增值票，1/0:是/否 类型为uint32_t
			$bs->pushUint8_t($this->cIsCanVAT_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwHasNoteBook); // 序列化存在笔记本类商品，1/0:是/否 类型为uint32_t
			$bs->pushUint8_t($this->cHasNoteBook_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTotalWeight); // 序列化订单总重量 类型为uint32_t
			$bs->pushUint8_t($this->cTotalWeight_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTotalCut); // 序列化订单总返现 类型为uint32_t
			$bs->pushUint8_t($this->cTotalCut_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTotalAmt); // 序列化订单总金额，以促销2.0为准 类型为uint32_t
			$bs->pushUint8_t($this->cTotalAmt_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->mapPackageList = $bs->popObject('stl_map<stl_string,ShippingPackageInfo>'); // 反序列化<packageId, 包裹信息> 类型为std::map<std::string,icson::deal::bo::CShippingPackageInfo> 
			$this->cPackageList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->mapDelayList = $bs->popObject('stl_map<stl_string,DelayInfo>'); // 反序列化<packageId, 延迟类型> 类型为std::map<std::string,icson::deal::bo::CDelayInfo> 
			$this->cDelayList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecShipinfo = $bs->popObject('stl_vector<ShippingInfo>'); // 反序列化订单配送信息 类型为std::vector<icson::deal::bo::CShippingInfo> 
			$this->cShipinfo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwIsCanVAT = $bs->popUint32_t(); // 反序列化可开增值票，1/0:是/否 类型为uint32_t
			$this->cIsCanVAT_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwHasNoteBook = $bs->popUint32_t(); // 反序列化存在笔记本类商品，1/0:是/否 类型为uint32_t
			$this->cHasNoteBook_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTotalWeight = $bs->popUint32_t(); // 反序列化订单总重量 类型为uint32_t
			$this->cTotalWeight_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTotalCut = $bs->popUint32_t(); // 反序列化订单总返现 类型为uint32_t
			$this->cTotalCut_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTotalAmt = $bs->popUint32_t(); // 反序列化订单总金额，以促销2.0为准 类型为uint32_t
			$this->cTotalAmt_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.deal.idl.OrderShippingInfo.java

if (!class_exists('ShippingInfo', false)) {
class ShippingInfo
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
		 * 订单运费
		 *
		 * 版本 >= 0
		 */
		var $dwShippingPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cShippingPrice_u; //uint8_t

		/**
		 * 订单运费减免
		 *
		 * 版本 >= 0
		 */
		var $dwShippingCut; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cShippingCut_u; //uint8_t

		/**
		 * 订单运费成本
		 *
		 * 版本 >= 0
		 */
		var $dwShippingCost; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cShippingCost_u; //uint8_t

		/**
		 * 是否免运费
		 *
		 * 版本 >= 0
		 */
		var $dwIsFree; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cIsFree_u; //uint8_t

		/**
		 * 免运费类型
		 *
		 * 版本 >= 0
		 */
		var $dwShippingFreeType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cShippingFreeType_u; //uint8_t

		/**
		 * 免运费阈值
		 *
		 * 版本 >= 0
		 */
		var $dwShippingFreeLimit; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cShippingFreeLimit_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 0
		 */
		var $dwSysNo; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSysNo_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 0
		 */
		var $dwShipTypeID; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cShipTypeID_u; //uint8_t

		/**
		 * 快递名称，e.g.:易迅快递
		 *
		 * 版本 >= 0
		 */
		var $strShipTypeName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cShipTypeName_u; //uint8_t

		/**
		 * 快递描述，e.g.:支持货到付款及POS机刷卡，上海市区一日三送...
		 *
		 * 版本 >= 0
		 */
		var $strShipTypeDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cShipTypeDesc_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 0
		 */
		var $dwShippingId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cShippingId_u; //uint8_t

		/**
		 * PremiumRate
		 *
		 * 版本 >= 0
		 */
		var $strPremiumRate; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPremiumRate_u; //uint8_t

		/**
		 * StatusQueryType
		 *
		 * 版本 >= 0
		 */
		var $dwStatusQueryType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStatusQueryType_u; //uint8_t

		/**
		 * StatusQueryUrl
		 *
		 * 版本 >= 0
		 */
		var $strStatusQueryUrl; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cStatusQueryUrl_u; //uint8_t

		/**
		 * 是否支持货到付款，0/1:不支持/支持
		 *
		 * 版本 >= 0
		 */
		var $dwIsCOD; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cIsCOD_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 0
		 */
		var $dwDeliveryTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cDeliveryTime_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 0
		 */
		var $dwStatus; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStatus_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 0
		 */
		var $dwIsOnlineShow; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cIsOnlineShow_u; //uint8_t

		/**
		 * <packageId, 子单配送信息>
		 *
		 * 版本 >= 0
		 */
		var $mapSubShipping; //std::map<std::string,icson::deal::bo::CSubShippingInfo> 

		/**
		 * 版本 >= 0
		 */
		var $cSubShipping_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwShippingPrice = 0; // uint32_t
			 $this->cShippingPrice_u = 0; // uint8_t
			 $this->dwShippingCut = 0; // uint32_t
			 $this->cShippingCut_u = 0; // uint8_t
			 $this->dwShippingCost = 0; // uint32_t
			 $this->cShippingCost_u = 0; // uint8_t
			 $this->dwIsFree = 0; // uint32_t
			 $this->cIsFree_u = 0; // uint8_t
			 $this->dwShippingFreeType = 0; // uint32_t
			 $this->cShippingFreeType_u = 0; // uint8_t
			 $this->dwShippingFreeLimit = 0; // uint32_t
			 $this->cShippingFreeLimit_u = 0; // uint8_t
			 $this->dwSysNo = 0; // uint32_t
			 $this->cSysNo_u = 0; // uint8_t
			 $this->dwShipTypeID = 0; // uint32_t
			 $this->cShipTypeID_u = 0; // uint8_t
			 $this->strShipTypeName = ""; // std::string
			 $this->cShipTypeName_u = 0; // uint8_t
			 $this->strShipTypeDesc = ""; // std::string
			 $this->cShipTypeDesc_u = 0; // uint8_t
			 $this->dwShippingId = 0; // uint32_t
			 $this->cShippingId_u = 0; // uint8_t
			 $this->strPremiumRate = ""; // std::string
			 $this->cPremiumRate_u = 0; // uint8_t
			 $this->dwStatusQueryType = 0; // uint32_t
			 $this->cStatusQueryType_u = 0; // uint8_t
			 $this->strStatusQueryUrl = ""; // std::string
			 $this->cStatusQueryUrl_u = 0; // uint8_t
			 $this->dwIsCOD = 0; // uint32_t
			 $this->cIsCOD_u = 0; // uint8_t
			 $this->dwDeliveryTime = 0; // uint32_t
			 $this->cDeliveryTime_u = 0; // uint8_t
			 $this->dwStatus = 0; // uint32_t
			 $this->cStatus_u = 0; // uint8_t
			 $this->dwIsOnlineShow = 0; // uint32_t
			 $this->cIsOnlineShow_u = 0; // uint8_t
			 $this->mapSubShipping = new stl_map('stl_string,SubShippingInfo'); // std::map<std::string,icson::deal::bo::CSubShippingInfo> 
			 $this->cSubShipping_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwShippingPrice); // 序列化订单运费 类型为uint32_t
			$bs->pushUint8_t($this->cShippingPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwShippingCut); // 序列化订单运费减免 类型为uint32_t
			$bs->pushUint8_t($this->cShippingCut_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwShippingCost); // 序列化订单运费成本 类型为uint32_t
			$bs->pushUint8_t($this->cShippingCost_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwIsFree); // 序列化是否免运费 类型为uint32_t
			$bs->pushUint8_t($this->cIsFree_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwShippingFreeType); // 序列化免运费类型 类型为uint32_t
			$bs->pushUint8_t($this->cShippingFreeType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwShippingFreeLimit); // 序列化免运费阈值 类型为uint32_t
			$bs->pushUint8_t($this->cShippingFreeLimit_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSysNo); // 序列化 类型为uint32_t
			$bs->pushUint8_t($this->cSysNo_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwShipTypeID); // 序列化 类型为uint32_t
			$bs->pushUint8_t($this->cShipTypeID_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strShipTypeName); // 序列化快递名称，e.g.:易迅快递 类型为std::string
			$bs->pushUint8_t($this->cShipTypeName_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strShipTypeDesc); // 序列化快递描述，e.g.:支持货到付款及POS机刷卡，上海市区一日三送... 类型为std::string
			$bs->pushUint8_t($this->cShipTypeDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwShippingId); // 序列化 类型为uint32_t
			$bs->pushUint8_t($this->cShippingId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPremiumRate); // 序列化PremiumRate 类型为std::string
			$bs->pushUint8_t($this->cPremiumRate_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStatusQueryType); // 序列化StatusQueryType 类型为uint32_t
			$bs->pushUint8_t($this->cStatusQueryType_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strStatusQueryUrl); // 序列化StatusQueryUrl 类型为std::string
			$bs->pushUint8_t($this->cStatusQueryUrl_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwIsCOD); // 序列化是否支持货到付款，0/1:不支持/支持 类型为uint32_t
			$bs->pushUint8_t($this->cIsCOD_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwDeliveryTime); // 序列化 类型为uint32_t
			$bs->pushUint8_t($this->cDeliveryTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStatus); // 序列化 类型为uint32_t
			$bs->pushUint8_t($this->cStatus_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwIsOnlineShow); // 序列化 类型为uint32_t
			$bs->pushUint8_t($this->cIsOnlineShow_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->mapSubShipping,'stl_map'); // 序列化<packageId, 子单配送信息> 类型为std::map<std::string,icson::deal::bo::CSubShippingInfo> 
			$bs->pushUint8_t($this->cSubShipping_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwShippingPrice = $bs->popUint32_t(); // 反序列化订单运费 类型为uint32_t
			$this->cShippingPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwShippingCut = $bs->popUint32_t(); // 反序列化订单运费减免 类型为uint32_t
			$this->cShippingCut_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwShippingCost = $bs->popUint32_t(); // 反序列化订单运费成本 类型为uint32_t
			$this->cShippingCost_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwIsFree = $bs->popUint32_t(); // 反序列化是否免运费 类型为uint32_t
			$this->cIsFree_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwShippingFreeType = $bs->popUint32_t(); // 反序列化免运费类型 类型为uint32_t
			$this->cShippingFreeType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwShippingFreeLimit = $bs->popUint32_t(); // 反序列化免运费阈值 类型为uint32_t
			$this->cShippingFreeLimit_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSysNo = $bs->popUint32_t(); // 反序列化 类型为uint32_t
			$this->cSysNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwShipTypeID = $bs->popUint32_t(); // 反序列化 类型为uint32_t
			$this->cShipTypeID_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strShipTypeName = $bs->popString(); // 反序列化快递名称，e.g.:易迅快递 类型为std::string
			$this->cShipTypeName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strShipTypeDesc = $bs->popString(); // 反序列化快递描述，e.g.:支持货到付款及POS机刷卡，上海市区一日三送... 类型为std::string
			$this->cShipTypeDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwShippingId = $bs->popUint32_t(); // 反序列化 类型为uint32_t
			$this->cShippingId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPremiumRate = $bs->popString(); // 反序列化PremiumRate 类型为std::string
			$this->cPremiumRate_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStatusQueryType = $bs->popUint32_t(); // 反序列化StatusQueryType 类型为uint32_t
			$this->cStatusQueryType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strStatusQueryUrl = $bs->popString(); // 反序列化StatusQueryUrl 类型为std::string
			$this->cStatusQueryUrl_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwIsCOD = $bs->popUint32_t(); // 反序列化是否支持货到付款，0/1:不支持/支持 类型为uint32_t
			$this->cIsCOD_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwDeliveryTime = $bs->popUint32_t(); // 反序列化 类型为uint32_t
			$this->cDeliveryTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStatus = $bs->popUint32_t(); // 反序列化 类型为uint32_t
			$this->cStatus_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwIsOnlineShow = $bs->popUint32_t(); // 反序列化 类型为uint32_t
			$this->cIsOnlineShow_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->mapSubShipping = $bs->popObject('stl_map<stl_string,SubShippingInfo>'); // 反序列化<packageId, 子单配送信息> 类型为std::map<std::string,icson::deal::bo::CSubShippingInfo> 
			$this->cSubShipping_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.deal.idl.ShippingInfo.java

if (!class_exists('SubShippingInfo', false)) {
class SubShippingInfo
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
		 * 卖家ID
		 *
		 * 版本 >= 0
		 */
		var $dwSellerId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * 商户地址(仓)ID，新联营特性
		 *
		 * 版本 >= 0
		 */
		var $dwSellerStockId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerStockId_u; //uint8_t

		/**
		 * 发货仓ID
		 *
		 * 版本 >= 0
		 */
		var $dwPsyStockId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPsyStockId_u; //uint8_t

		/**
		 * 免运费类型
		 *
		 * 版本 >= 0
		 */
		var $dwShippingFreeType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cShippingFreeType_u; //uint8_t

		/**
		 * 免运费阈值
		 *
		 * 版本 >= 0
		 */
		var $dwShippingFreeLimit; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cShippingFreeLimit_u; //uint8_t

		/**
		 * 运费
		 *
		 * 版本 >= 0
		 */
		var $dwShippingPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cShippingPrice_u; //uint8_t

		/**
		 * 减免
		 *
		 * 版本 >= 0
		 */
		var $dwShippingPriceCut; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cShippingPriceCut_u; //uint8_t

		/**
		 * 成本
		 *
		 * 版本 >= 0
		 */
		var $dwShippingPriceCost; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cShippingPriceCost_u; //uint8_t

		/**
		 * isArrivedLimitTime
		 *
		 * 版本 >= 0
		 */
		var $dwIsArrivedLimitTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cIsArrivedLimitTime_u; //uint8_t

		/**
		 * 配送日历，易迅快递可选一日N送配送时间
		 *
		 * 版本 >= 0
		 */
		var $vecCalendar; //std::vector<icson::deal::bo::CShipCalendar> 

		/**
		 * 版本 >= 0
		 */
		var $cCalendar_u; //uint8_t

		/**
		 * 最早配送时间，非易迅快递指定配送日期即可
		 *
		 * 版本 >= 0
		 */
		var $strShipDate; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cShipDate_u; //uint8_t

		/**
		 * 是否可供随心送，1/0:可/不可
		 *
		 * 版本 >= 0
		 */
		var $dwIsCanXpress; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cIsCanXpress_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwSellerId = 0; // uint32_t
			 $this->cSellerId_u = 0; // uint8_t
			 $this->dwSellerStockId = 0; // uint32_t
			 $this->cSellerStockId_u = 0; // uint8_t
			 $this->dwPsyStockId = 0; // uint32_t
			 $this->cPsyStockId_u = 0; // uint8_t
			 $this->dwShippingFreeType = 0; // uint32_t
			 $this->cShippingFreeType_u = 0; // uint8_t
			 $this->dwShippingFreeLimit = 0; // uint32_t
			 $this->cShippingFreeLimit_u = 0; // uint8_t
			 $this->dwShippingPrice = 0; // uint32_t
			 $this->cShippingPrice_u = 0; // uint8_t
			 $this->dwShippingPriceCut = 0; // uint32_t
			 $this->cShippingPriceCut_u = 0; // uint8_t
			 $this->dwShippingPriceCost = 0; // uint32_t
			 $this->cShippingPriceCost_u = 0; // uint8_t
			 $this->dwIsArrivedLimitTime = 0; // uint32_t
			 $this->cIsArrivedLimitTime_u = 0; // uint8_t
			 $this->vecCalendar = new stl_vector('ShipCalendar'); // std::vector<icson::deal::bo::CShipCalendar> 
			 $this->cCalendar_u = 0; // uint8_t
			 $this->strShipDate = ""; // std::string
			 $this->cShipDate_u = 0; // uint8_t
			 $this->dwIsCanXpress = 0; // uint32_t
			 $this->cIsCanXpress_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSellerId); // 序列化卖家ID 类型为uint32_t
			$bs->pushUint8_t($this->cSellerId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSellerStockId); // 序列化商户地址(仓)ID，新联营特性 类型为uint32_t
			$bs->pushUint8_t($this->cSellerStockId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPsyStockId); // 序列化发货仓ID 类型为uint32_t
			$bs->pushUint8_t($this->cPsyStockId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwShippingFreeType); // 序列化免运费类型 类型为uint32_t
			$bs->pushUint8_t($this->cShippingFreeType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwShippingFreeLimit); // 序列化免运费阈值 类型为uint32_t
			$bs->pushUint8_t($this->cShippingFreeLimit_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwShippingPrice); // 序列化运费 类型为uint32_t
			$bs->pushUint8_t($this->cShippingPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwShippingPriceCut); // 序列化减免 类型为uint32_t
			$bs->pushUint8_t($this->cShippingPriceCut_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwShippingPriceCost); // 序列化成本 类型为uint32_t
			$bs->pushUint8_t($this->cShippingPriceCost_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwIsArrivedLimitTime); // 序列化isArrivedLimitTime 类型为uint32_t
			$bs->pushUint8_t($this->cIsArrivedLimitTime_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecCalendar,'stl_vector'); // 序列化配送日历，易迅快递可选一日N送配送时间 类型为std::vector<icson::deal::bo::CShipCalendar> 
			$bs->pushUint8_t($this->cCalendar_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strShipDate); // 序列化最早配送时间，非易迅快递指定配送日期即可 类型为std::string
			$bs->pushUint8_t($this->cShipDate_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwIsCanXpress); // 序列化是否可供随心送，1/0:可/不可 类型为uint32_t
			$bs->pushUint8_t($this->cIsCanXpress_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSellerId = $bs->popUint32_t(); // 反序列化卖家ID 类型为uint32_t
			$this->cSellerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSellerStockId = $bs->popUint32_t(); // 反序列化商户地址(仓)ID，新联营特性 类型为uint32_t
			$this->cSellerStockId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPsyStockId = $bs->popUint32_t(); // 反序列化发货仓ID 类型为uint32_t
			$this->cPsyStockId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwShippingFreeType = $bs->popUint32_t(); // 反序列化免运费类型 类型为uint32_t
			$this->cShippingFreeType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwShippingFreeLimit = $bs->popUint32_t(); // 反序列化免运费阈值 类型为uint32_t
			$this->cShippingFreeLimit_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwShippingPrice = $bs->popUint32_t(); // 反序列化运费 类型为uint32_t
			$this->cShippingPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwShippingPriceCut = $bs->popUint32_t(); // 反序列化减免 类型为uint32_t
			$this->cShippingPriceCut_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwShippingPriceCost = $bs->popUint32_t(); // 反序列化成本 类型为uint32_t
			$this->cShippingPriceCost_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwIsArrivedLimitTime = $bs->popUint32_t(); // 反序列化isArrivedLimitTime 类型为uint32_t
			$this->cIsArrivedLimitTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecCalendar = $bs->popObject('stl_vector<ShipCalendar>'); // 反序列化配送日历，易迅快递可选一日N送配送时间 类型为std::vector<icson::deal::bo::CShipCalendar> 
			$this->cCalendar_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strShipDate = $bs->popString(); // 反序列化最早配送时间，非易迅快递指定配送日期即可 类型为std::string
			$this->cShipDate_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwIsCanXpress = $bs->popUint32_t(); // 反序列化是否可供随心送，1/0:可/不可 类型为uint32_t
			$this->cIsCanXpress_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.deal.idl.SubShippingInfo.java

if (!class_exists('ShipCalendar', false)) {
class ShipCalendar
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
		 * 描述，e.g.:2013-04-04 星期四上午
		 *
		 * 版本 >= 0
		 */
		var $strName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cName_u; //uint8_t

		/**
		 * 日期，e.g.:20130404
		 *
		 * 版本 >= 0
		 */
		var $strShipDate; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cShipDate_u; //uint8_t

		/**
		 * 星期，e.g.:4
		 *
		 * 版本 >= 0
		 */
		var $dwWeekDay; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cWeekDay_u; //uint8_t

		/**
		 * 一日几送，e.g.:2
		 *
		 * 版本 >= 0
		 */
		var $dwTimeSpan; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimeSpan_u; //uint8_t

		/**
		 * 状态，（0/2/2:可用/过期/限单 以往是0/-1/-2不建议使用负）
		 *
		 * 版本 >= 0
		 */
		var $dwStatus; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStatus_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->strName = ""; // std::string
			 $this->cName_u = 0; // uint8_t
			 $this->strShipDate = ""; // std::string
			 $this->cShipDate_u = 0; // uint8_t
			 $this->dwWeekDay = 0; // uint32_t
			 $this->cWeekDay_u = 0; // uint8_t
			 $this->dwTimeSpan = 0; // uint32_t
			 $this->cTimeSpan_u = 0; // uint8_t
			 $this->dwStatus = 0; // uint32_t
			 $this->cStatus_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strName); // 序列化描述，e.g.:2013-04-04 星期四上午 类型为std::string
			$bs->pushUint8_t($this->cName_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strShipDate); // 序列化日期，e.g.:20130404 类型为std::string
			$bs->pushUint8_t($this->cShipDate_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwWeekDay); // 序列化星期，e.g.:4 类型为uint32_t
			$bs->pushUint8_t($this->cWeekDay_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimeSpan); // 序列化一日几送，e.g.:2 类型为uint32_t
			$bs->pushUint8_t($this->cTimeSpan_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStatus); // 序列化状态，（0/2/2:可用/过期/限单 以往是0/-1/-2不建议使用负） 类型为uint32_t
			$bs->pushUint8_t($this->cStatus_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strName = $bs->popString(); // 反序列化描述，e.g.:2013-04-04 星期四上午 类型为std::string
			$this->cName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strShipDate = $bs->popString(); // 反序列化日期，e.g.:20130404 类型为std::string
			$this->cShipDate_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwWeekDay = $bs->popUint32_t(); // 反序列化星期，e.g.:4 类型为uint32_t
			$this->cWeekDay_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimeSpan = $bs->popUint32_t(); // 反序列化一日几送，e.g.:2 类型为uint32_t
			$this->cTimeSpan_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStatus = $bs->popUint32_t(); // 反序列化状态，（0/2/2:可用/过期/限单 以往是0/-1/-2不建议使用负） 类型为uint32_t
			$this->cStatus_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.deal.idl.OrderShippingInfo.java

if (!class_exists('ShippingPackageInfo', false)) {
class ShippingPackageInfo
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
		 * 配送仓ID
		 *
		 * 版本 >= 0
		 */
		var $dwPsyStockId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPsyStockId_u; //uint8_t

		/**
		 * 仓的分站
		 *
		 * 版本 >= 0
		 */
		var $dwStockWhId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockWhId_u; //uint8_t

		/**
		 * 销售模式 1-自营 ，2-新联营
		 *
		 * 版本 >= 0
		 */
		var $dwSellMode; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSellMode_u; //uint8_t

		/**
		 * 取货地址ID，新联营卖家仓ID
		 *
		 * 版本 >= 0
		 */
		var $dwSellerStockId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerStockId_u; //uint8_t

		/**
		 * 卖家ID，新联营
		 *
		 * 版本 >= 0
		 */
		var $dwSellerId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * 商品相关信息< product_id, < attribute, value > >
		 *
		 * 版本 >= 0
		 */
		var $mapDwItems; //std::map<uint32_t,std::map<std::string,uint32_t> > 

		/**
		 * 版本 >= 0
		 */
		var $cDwItems_u; //uint8_t

		/**
		 * 商品相关信息< product_id, < attribute, value > >
		 *
		 * 版本 >= 0
		 */
		var $mapStrItems; //std::map<uint32_t,std::map<std::string,std::string> > 

		/**
		 * 版本 >= 0
		 */
		var $cStrItems_u; //uint8_t

		/**
		 * 延迟信息
		 *
		 * 版本 >= 0
		 */
		var $oDelay; //icson::deal::bo::CDelayInfo

		/**
		 * 版本 >= 0
		 */
		var $cDelay_u; //uint8_t

		/**
		 * 包的总金额
		 *
		 * 版本 >= 0
		 */
		var $dwTotalAmt; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTotalAmt_u; //uint8_t

		/**
		 * 包的总重量
		 *
		 * 版本 >= 0
		 */
		var $dwTotalWeight; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTotalWeight_u; //uint8_t

		/**
		 * 包的总返现
		 *
		 * 版本 >= 0
		 */
		var $dwTotalCut; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTotalCut_u; //uint8_t

		/**
		 * 是否跨仓，1/0:是/否
		 *
		 * 版本 >= 0
		 */
		var $dwIsCrossStock; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cIsCrossStock_u; //uint8_t

		/**
		 * 可开增值票，1/0:是/否
		 *
		 * 版本 >= 0
		 */
		var $dwIsCanVAT; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cIsCanVAT_u; //uint8_t

		/**
		 * 存在笔记本类商品，1/0:是/否
		 *
		 * 版本 >= 0
		 */
		var $dwHasNoteBook; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cHasNoteBook_u; //uint8_t

		/**
		 * 件型信息
		 *
		 * 版本 >= 1
		 */
		var $oSizeInfo; //oms::ordersize::po::COrderSizePo

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cSizeInfo_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwPsyStockId = 0; // uint32_t
			 $this->cPsyStockId_u = 0; // uint8_t
			 $this->dwStockWhId = 0; // uint32_t
			 $this->cStockWhId_u = 0; // uint8_t
			 $this->dwSellMode = 0; // uint32_t
			 $this->cSellMode_u = 0; // uint8_t
			 $this->dwSellerStockId = 0; // uint32_t
			 $this->cSellerStockId_u = 0; // uint8_t
			 $this->dwSellerId = 0; // uint32_t
			 $this->cSellerId_u = 0; // uint8_t
			 $this->mapDwItems = new stl_map('uint32_t,stl_map<stl_string,uint32_t> '); // std::map<uint32_t,std::map<std::string,uint32_t> > 
			 $this->cDwItems_u = 0; // uint8_t
			 $this->mapStrItems = new stl_map('uint32_t,stl_map<stl_string,stl_string> '); // std::map<uint32_t,std::map<std::string,std::string> > 
			 $this->cStrItems_u = 0; // uint8_t
			 $this->oDelay = new DelayInfo(); // icson::deal::bo::CDelayInfo
			 $this->cDelay_u = 0; // uint8_t
			 $this->dwTotalAmt = 0; // uint32_t
			 $this->cTotalAmt_u = 0; // uint8_t
			 $this->dwTotalWeight = 0; // uint32_t
			 $this->cTotalWeight_u = 0; // uint8_t
			 $this->dwTotalCut = 0; // uint32_t
			 $this->cTotalCut_u = 0; // uint8_t
			 $this->dwIsCrossStock = 0; // uint32_t
			 $this->cIsCrossStock_u = 0; // uint8_t
			 $this->dwIsCanVAT = 0; // uint32_t
			 $this->cIsCanVAT_u = 0; // uint8_t
			 $this->dwHasNoteBook = 0; // uint32_t
			 $this->cHasNoteBook_u = 0; // uint8_t
			 $this->oSizeInfo = new OrderSizePo(); // oms::ordersize::po::COrderSizePo
			 $this->cSizeInfo_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPsyStockId); // 序列化配送仓ID 类型为uint32_t
			$bs->pushUint8_t($this->cPsyStockId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockWhId); // 序列化仓的分站 类型为uint32_t
			$bs->pushUint8_t($this->cStockWhId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSellMode); // 序列化销售模式 1-自营 ，2-新联营 类型为uint32_t
			$bs->pushUint8_t($this->cSellMode_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSellerStockId); // 序列化取货地址ID，新联营卖家仓ID 类型为uint32_t
			$bs->pushUint8_t($this->cSellerStockId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSellerId); // 序列化卖家ID，新联营 类型为uint32_t
			$bs->pushUint8_t($this->cSellerId_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->mapDwItems,'stl_map'); // 序列化商品相关信息< product_id, < attribute, value > > 类型为std::map<uint32_t,std::map<std::string,uint32_t> > 
			$bs->pushUint8_t($this->cDwItems_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->mapStrItems,'stl_map'); // 序列化商品相关信息< product_id, < attribute, value > > 类型为std::map<uint32_t,std::map<std::string,std::string> > 
			$bs->pushUint8_t($this->cStrItems_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->oDelay,'DelayInfo'); // 序列化延迟信息 类型为icson::deal::bo::CDelayInfo
			$bs->pushUint8_t($this->cDelay_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTotalAmt); // 序列化包的总金额 类型为uint32_t
			$bs->pushUint8_t($this->cTotalAmt_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTotalWeight); // 序列化包的总重量 类型为uint32_t
			$bs->pushUint8_t($this->cTotalWeight_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTotalCut); // 序列化包的总返现 类型为uint32_t
			$bs->pushUint8_t($this->cTotalCut_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwIsCrossStock); // 序列化是否跨仓，1/0:是/否 类型为uint32_t
			$bs->pushUint8_t($this->cIsCrossStock_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwIsCanVAT); // 序列化可开增值票，1/0:是/否 类型为uint32_t
			$bs->pushUint8_t($this->cIsCanVAT_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwHasNoteBook); // 序列化存在笔记本类商品，1/0:是/否 类型为uint32_t
			$bs->pushUint8_t($this->cHasNoteBook_u); // 序列化 类型为uint8_t
			if(  $this->dwVersion >= 1 ){
				$bs->pushObject($this->oSizeInfo,'OrderSizePo'); // 序列化件型信息 类型为oms::ordersize::po::COrderSizePo
			}
			if(  $this->dwVersion >= 1 ){
				$bs->pushUint8_t($this->cSizeInfo_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPsyStockId = $bs->popUint32_t(); // 反序列化配送仓ID 类型为uint32_t
			$this->cPsyStockId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockWhId = $bs->popUint32_t(); // 反序列化仓的分站 类型为uint32_t
			$this->cStockWhId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSellMode = $bs->popUint32_t(); // 反序列化销售模式 1-自营 ，2-新联营 类型为uint32_t
			$this->cSellMode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSellerStockId = $bs->popUint32_t(); // 反序列化取货地址ID，新联营卖家仓ID 类型为uint32_t
			$this->cSellerStockId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSellerId = $bs->popUint32_t(); // 反序列化卖家ID，新联营 类型为uint32_t
			$this->cSellerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->mapDwItems = $bs->popObject('stl_map<uint32_t,stl_map<stl_string,uint32_t> >'); // 反序列化商品相关信息< product_id, < attribute, value > > 类型为std::map<uint32_t,std::map<std::string,uint32_t> > 
			$this->cDwItems_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->mapStrItems = $bs->popObject('stl_map<uint32_t,stl_map<stl_string,stl_string> >'); // 反序列化商品相关信息< product_id, < attribute, value > > 类型为std::map<uint32_t,std::map<std::string,std::string> > 
			$this->cStrItems_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->oDelay = $bs->popObject('DelayInfo'); // 反序列化延迟信息 类型为icson::deal::bo::CDelayInfo
			$this->cDelay_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTotalAmt = $bs->popUint32_t(); // 反序列化包的总金额 类型为uint32_t
			$this->cTotalAmt_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTotalWeight = $bs->popUint32_t(); // 反序列化包的总重量 类型为uint32_t
			$this->cTotalWeight_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTotalCut = $bs->popUint32_t(); // 反序列化包的总返现 类型为uint32_t
			$this->cTotalCut_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwIsCrossStock = $bs->popUint32_t(); // 反序列化是否跨仓，1/0:是/否 类型为uint32_t
			$this->cIsCrossStock_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwIsCanVAT = $bs->popUint32_t(); // 反序列化可开增值票，1/0:是/否 类型为uint32_t
			$this->cIsCanVAT_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwHasNoteBook = $bs->popUint32_t(); // 反序列化存在笔记本类商品，1/0:是/否 类型为uint32_t
			$this->cHasNoteBook_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->dwVersion >= 1 ){
				$this->oSizeInfo = $bs->popObject('OrderSizePo'); // 反序列化件型信息 类型为oms::ordersize::po::COrderSizePo
			}
			if(  $this->dwVersion >= 1 ){
				$this->cSizeInfo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.icson.deal.idl.ShippingPackageInfo.java

if (!class_exists('OrderSizePo', false)) {
class OrderSizePo
{
		/**
		 *  鐗堟湰鍙�
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 *  ID, 涓� OrderPo 閲岀殑 id 鏄搴旂殑,蹇呭～ 
		 *
		 * 版本 >= 0
		 */
		var $ddwId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cId_u; //uint8_t

		/**
		 * 璁㈠崟绫诲瀷(澶т欢璁㈠崟銆佷腑浠惰鍗曘�灏忎欢璁㈠崟) 
		 *
		 * 版本 >= 0
		 */
		var $dwOrderSize; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cOrderSize_u; //uint8_t

		/**
		 *  璁㈠崟鎬讳綋绉�绔嬫柟鍘樼背
		 *
		 * 版本 >= 0
		 */
		var $ddwOrderVolume; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cOrderVolume_u; //uint8_t

		/**
		 *  璁㈠崟鎬婚噸閲�鍏�
		 *
		 * 版本 >= 0
		 */
		var $ddwOrderWeight; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cOrderWeight_u; //uint8_t

		/**
		 *  璁㈠崟鏈�暱杈�姣背 
		 *
		 * 版本 >= 0
		 */
		var $ddwOrderMaxlength; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cOrderMaxlength_u; //uint8_t

		/**
		 *  濡傛灉閮ㄥ垎鍟嗗搧涓嶅瓨鍦�鎴栬�鍟嗗搧鐨勫昂瀵镐俊鎭笉瀛樺湪,杩斿洖鐗瑰畾鐨勯敊璇爜
		 *
		 * 版本 >= 0
		 */
		var $dwInfoErrCode; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cInfoErrCode_u; //uint8_t

		/**
		 * 淇濈暀瀛楁dw
		 *
		 * 版本 >= 0
		 */
		var $ddwReserveDdw; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cReserveDdw_u; //uint8_t

		/**
		 * 淇濈暀瀛楁str
		 *
		 * 版本 >= 0
		 */
		var $strReserveStr; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cReserveStr_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->ddwId = 0; // uint64_t
			 $this->cId_u = 0; // uint8_t
			 $this->dwOrderSize = 0; // uint32_t
			 $this->cOrderSize_u = 0; // uint8_t
			 $this->ddwOrderVolume = 0; // uint64_t
			 $this->cOrderVolume_u = 0; // uint8_t
			 $this->ddwOrderWeight = 0; // uint64_t
			 $this->cOrderWeight_u = 0; // uint8_t
			 $this->ddwOrderMaxlength = 0; // uint64_t
			 $this->cOrderMaxlength_u = 0; // uint8_t
			 $this->dwInfoErrCode = 0; // uint32_t
			 $this->cInfoErrCode_u = 0; // uint8_t
			 $this->ddwReserveDdw = 0; // uint64_t
			 $this->cReserveDdw_u = 0; // uint8_t
			 $this->strReserveStr = ""; // std::string
			 $this->cReserveStr_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 鐗堟湰鍙� 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwId); // 序列化 ID, 涓� OrderPo 閲岀殑 id 鏄搴旂殑,蹇呭～  类型为uint64_t
			$bs->pushUint8_t($this->cId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwOrderSize); // 序列化璁㈠崟绫诲瀷(澶т欢璁㈠崟銆佷腑浠惰鍗曘�灏忎欢璁㈠崟)  类型为uint32_t
			$bs->pushUint8_t($this->cOrderSize_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwOrderVolume); // 序列化 璁㈠崟鎬讳綋绉�绔嬫柟鍘樼背 类型为uint64_t
			$bs->pushUint8_t($this->cOrderVolume_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwOrderWeight); // 序列化 璁㈠崟鎬婚噸閲�鍏� 类型为uint64_t
			$bs->pushUint8_t($this->cOrderWeight_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwOrderMaxlength); // 序列化 璁㈠崟鏈�暱杈�姣背  类型为uint64_t
			$bs->pushUint8_t($this->cOrderMaxlength_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwInfoErrCode); // 序列化 濡傛灉閮ㄥ垎鍟嗗搧涓嶅瓨鍦�鎴栬�鍟嗗搧鐨勫昂瀵镐俊鎭笉瀛樺湪,杩斿洖鐗瑰畾鐨勯敊璇爜 类型为uint32_t
			$bs->pushUint8_t($this->cInfoErrCode_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwReserveDdw); // 序列化淇濈暀瀛楁dw 类型为uint64_t
			$bs->pushUint8_t($this->cReserveDdw_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strReserveStr); // 序列化淇濈暀瀛楁str 类型为std::string
			$bs->pushUint8_t($this->cReserveStr_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 鐗堟湰鍙� 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwId = $bs->popUint64_t(); // 反序列化 ID, 涓� OrderPo 閲岀殑 id 鏄搴旂殑,蹇呭～  类型为uint64_t
			$this->cId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwOrderSize = $bs->popUint32_t(); // 反序列化璁㈠崟绫诲瀷(澶т欢璁㈠崟銆佷腑浠惰鍗曘�灏忎欢璁㈠崟)  类型为uint32_t
			$this->cOrderSize_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwOrderVolume = $bs->popUint64_t(); // 反序列化 璁㈠崟鎬讳綋绉�绔嬫柟鍘樼背 类型为uint64_t
			$this->cOrderVolume_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwOrderWeight = $bs->popUint64_t(); // 反序列化 璁㈠崟鎬婚噸閲�鍏� 类型为uint64_t
			$this->cOrderWeight_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwOrderMaxlength = $bs->popUint64_t(); // 反序列化 璁㈠崟鏈�暱杈�姣背  类型为uint64_t
			$this->cOrderMaxlength_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwInfoErrCode = $bs->popUint32_t(); // 反序列化 濡傛灉閮ㄥ垎鍟嗗搧涓嶅瓨鍦�鎴栬�鍟嗗搧鐨勫昂瀵镐俊鎭笉瀛樺湪,杩斿洖鐗瑰畾鐨勯敊璇爜 类型为uint32_t
			$this->cInfoErrCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwReserveDdw = $bs->popUint64_t(); // 反序列化淇濈暀瀛楁dw 类型为uint64_t
			$this->cReserveDdw_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strReserveStr = $bs->popString(); // 反序列化淇濈暀瀛楁str 类型为std::string
			$this->cReserveStr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.deal.idl.ShippingAo.java

if (!class_exists('GiftInfo4Shipping', false)) {
class GiftInfo4Shipping
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
		 * 赠品重量
		 *
		 * 版本 >= 0
		 */
		var $dwGiftWeight; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cGiftWeight_u; //uint8_t

		/**
		 * 库存量
		 *
		 * 版本 >= 0
		 */
		var $dwStockNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockNum_u; //uint8_t

		/**
		 * 有效赠送数量（库存>赠送数量*主商品购买数 ? 赠送数量*主商品购买数 : 库存数 ）
		 *
		 * 版本 >= 0
		 */
		var $dwGiftNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cGiftNum_u; //uint8_t

		/**
		 * 商品长宽高重信息
		 *
		 * 版本 >= 1
		 */
		var $oSizeInfo; //oms::ordersize::po::CProductUnitPo

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cSizeInfo_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwGiftWeight = 0; // uint32_t
			 $this->cGiftWeight_u = 0; // uint8_t
			 $this->dwStockNum = 0; // uint32_t
			 $this->cStockNum_u = 0; // uint8_t
			 $this->dwGiftNum = 0; // uint32_t
			 $this->cGiftNum_u = 0; // uint8_t
			 $this->oSizeInfo = new ProductUnitPo(); // oms::ordersize::po::CProductUnitPo
			 $this->cSizeInfo_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwGiftWeight); // 序列化赠品重量 类型为uint32_t
			$bs->pushUint8_t($this->cGiftWeight_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockNum); // 序列化库存量 类型为uint32_t
			$bs->pushUint8_t($this->cStockNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwGiftNum); // 序列化有效赠送数量（库存>赠送数量*主商品购买数 ? 赠送数量*主商品购买数 : 库存数 ） 类型为uint32_t
			$bs->pushUint8_t($this->cGiftNum_u); // 序列化 类型为uint8_t
			if(  $this->dwVersion >= 1 ){
				$bs->pushObject($this->oSizeInfo,'ProductUnitPo'); // 序列化商品长宽高重信息 类型为oms::ordersize::po::CProductUnitPo
			}
			if(  $this->dwVersion >= 1 ){
				$bs->pushUint8_t($this->cSizeInfo_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwGiftWeight = $bs->popUint32_t(); // 反序列化赠品重量 类型为uint32_t
			$this->cGiftWeight_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockNum = $bs->popUint32_t(); // 反序列化库存量 类型为uint32_t
			$this->cStockNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwGiftNum = $bs->popUint32_t(); // 反序列化有效赠送数量（库存>赠送数量*主商品购买数 ? 赠送数量*主商品购买数 : 库存数 ） 类型为uint32_t
			$this->cGiftNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->dwVersion >= 1 ){
				$this->oSizeInfo = $bs->popObject('ProductUnitPo'); // 反序列化商品长宽高重信息 类型为oms::ordersize::po::CProductUnitPo
			}
			if(  $this->dwVersion >= 1 ){
				$this->cSizeInfo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.icson.deal.idl.GiftInfo4Shipping.java

if (!class_exists('ProductUnitPo', false)) {
class ProductUnitPo
{
		/**
		 *  鐗堟湰鍙�
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 *  鍟嗗搧ID,蹇呭～ 
		 *
		 * 版本 >= 0
		 */
		var $ddwProductSysno; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cProductSysno_u; //uint8_t

		/**
		 *  鍟嗗搧鏁伴噺,蹇呭～
		 *
		 * 版本 >= 0
		 */
		var $dwProductNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cProductNum_u; //uint8_t

		/**
		 * 鍟嗗搧闀垮害,鍗曚綅姣背
		 *
		 * 版本 >= 0
		 */
		var $ddwProductLength; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cProductLength_u; //uint8_t

		/**
		 * 鍟嗗搧瀹藉害,鍗曚綅姣背
		 *
		 * 版本 >= 0
		 */
		var $ddwProductWidth; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cProductWidth_u; //uint8_t

		/**
		 * 鍟嗗搧楂樺害,鍗曚綅姣背
		 *
		 * 版本 >= 0
		 */
		var $ddwProductHeight; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cProductHeight_u; //uint8_t

		/**
		 * 鍟嗗搧  閲嶉噺 鍏� 
		 *
		 * 版本 >= 0
		 */
		var $dwProductWeight; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cProductWeight_u; //uint8_t

		/**
		 * 淇濈暀瀛楁dw
		 *
		 * 版本 >= 0
		 */
		var $ddwReserveDdw; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cReserveDdw_u; //uint8_t

		/**
		 * 淇濈暀瀛楁str
		 *
		 * 版本 >= 0
		 */
		var $strReserveStr; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cReserveStr_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->ddwProductSysno = 0; // uint64_t
			 $this->cProductSysno_u = 0; // uint8_t
			 $this->dwProductNum = 0; // uint32_t
			 $this->cProductNum_u = 0; // uint8_t
			 $this->ddwProductLength = 0; // uint64_t
			 $this->cProductLength_u = 0; // uint8_t
			 $this->ddwProductWidth = 0; // uint64_t
			 $this->cProductWidth_u = 0; // uint8_t
			 $this->ddwProductHeight = 0; // uint64_t
			 $this->cProductHeight_u = 0; // uint8_t
			 $this->dwProductWeight = 0; // uint32_t
			 $this->cProductWeight_u = 0; // uint8_t
			 $this->ddwReserveDdw = 0; // uint64_t
			 $this->cReserveDdw_u = 0; // uint8_t
			 $this->strReserveStr = ""; // std::string
			 $this->cReserveStr_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 鐗堟湰鍙� 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwProductSysno); // 序列化 鍟嗗搧ID,蹇呭～  类型为uint64_t
			$bs->pushUint8_t($this->cProductSysno_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwProductNum); // 序列化 鍟嗗搧鏁伴噺,蹇呭～ 类型为uint32_t
			$bs->pushUint8_t($this->cProductNum_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwProductLength); // 序列化鍟嗗搧闀垮害,鍗曚綅姣背 类型为uint64_t
			$bs->pushUint8_t($this->cProductLength_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwProductWidth); // 序列化鍟嗗搧瀹藉害,鍗曚綅姣背 类型为uint64_t
			$bs->pushUint8_t($this->cProductWidth_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwProductHeight); // 序列化鍟嗗搧楂樺害,鍗曚綅姣背 类型为uint64_t
			$bs->pushUint8_t($this->cProductHeight_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwProductWeight); // 序列化鍟嗗搧  閲嶉噺 鍏�  类型为uint32_t
			$bs->pushUint8_t($this->cProductWeight_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwReserveDdw); // 序列化淇濈暀瀛楁dw 类型为uint64_t
			$bs->pushUint8_t($this->cReserveDdw_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strReserveStr); // 序列化淇濈暀瀛楁str 类型为std::string
			$bs->pushUint8_t($this->cReserveStr_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 鐗堟湰鍙� 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwProductSysno = $bs->popUint64_t(); // 反序列化 鍟嗗搧ID,蹇呭～  类型为uint64_t
			$this->cProductSysno_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwProductNum = $bs->popUint32_t(); // 反序列化 鍟嗗搧鏁伴噺,蹇呭～ 类型为uint32_t
			$this->cProductNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwProductLength = $bs->popUint64_t(); // 反序列化鍟嗗搧闀垮害,鍗曚綅姣背 类型为uint64_t
			$this->cProductLength_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwProductWidth = $bs->popUint64_t(); // 反序列化鍟嗗搧瀹藉害,鍗曚綅姣背 类型为uint64_t
			$this->cProductWidth_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwProductHeight = $bs->popUint64_t(); // 反序列化鍟嗗搧楂樺害,鍗曚綅姣背 类型为uint64_t
			$this->cProductHeight_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwProductWeight = $bs->popUint32_t(); // 反序列化鍟嗗搧  閲嶉噺 鍏�  类型为uint32_t
			$this->cProductWeight_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwReserveDdw = $bs->popUint64_t(); // 反序列化淇濈暀瀛楁dw 类型为uint64_t
			$this->cReserveDdw_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strReserveStr = $bs->popString(); // 反序列化淇濈暀瀛楁str 类型为std::string
			$this->cReserveStr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.deal.idl.ShippingAo.java

if (!class_exists('ExpectDate', false)) {
class ExpectDate
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
		 * 卖家ID
		 *
		 * 版本 >= 0
		 */
		var $dwSellerId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * 商户地址(仓)ID，新联营特性
		 *
		 * 版本 >= 0
		 */
		var $dwSellerStockId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerStockId_u; //uint8_t

		/**
		 * 配送仓ID
		 *
		 * 版本 >= 0
		 */
		var $dwPsyStockId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPsyStockId_u; //uint8_t

		/**
		 * 期望配送日期
		 *
		 * 版本 >= 0
		 */
		var $strShipDate; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cShipDate_u; //uint8_t

		/**
		 * 期望配送时段
		 *
		 * 版本 >= 0
		 */
		var $dwShipSpan; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cShipSpan_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwSellerId = 0; // uint32_t
			 $this->cSellerId_u = 0; // uint8_t
			 $this->dwSellerStockId = 0; // uint32_t
			 $this->cSellerStockId_u = 0; // uint8_t
			 $this->dwPsyStockId = 0; // uint32_t
			 $this->cPsyStockId_u = 0; // uint8_t
			 $this->strShipDate = ""; // std::string
			 $this->cShipDate_u = 0; // uint8_t
			 $this->dwShipSpan = 0; // uint32_t
			 $this->cShipSpan_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSellerId); // 序列化卖家ID 类型为uint32_t
			$bs->pushUint8_t($this->cSellerId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSellerStockId); // 序列化商户地址(仓)ID，新联营特性 类型为uint32_t
			$bs->pushUint8_t($this->cSellerStockId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPsyStockId); // 序列化配送仓ID 类型为uint32_t
			$bs->pushUint8_t($this->cPsyStockId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strShipDate); // 序列化期望配送日期 类型为std::string
			$bs->pushUint8_t($this->cShipDate_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwShipSpan); // 序列化期望配送时段 类型为uint32_t
			$bs->pushUint8_t($this->cShipSpan_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSellerId = $bs->popUint32_t(); // 反序列化卖家ID 类型为uint32_t
			$this->cSellerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSellerStockId = $bs->popUint32_t(); // 反序列化商户地址(仓)ID，新联营特性 类型为uint32_t
			$this->cSellerStockId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPsyStockId = $bs->popUint32_t(); // 反序列化配送仓ID 类型为uint32_t
			$this->cPsyStockId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strShipDate = $bs->popString(); // 反序列化期望配送日期 类型为std::string
			$this->cShipDate_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwShipSpan = $bs->popUint32_t(); // 反序列化期望配送时段 类型为uint32_t
			$this->cShipSpan_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.deal.idl.ShippingAo.java

if (!class_exists('BaseShippingInfo', false)) {
class BaseShippingInfo
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
		 * 配送描述（有货，当日可出库，支持货到付款...）
		 *
		 * 版本 >= 0
		 */
		var $strStockDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cStockDesc_u; //uint8_t

		/**
		 * 库存状态
		 *
		 * 版本 >= 0
		 */
		var $dwStockStatus; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockStatus_u; //uint8_t

		/**
		 * 是否支持货到付款，1/0:支持/不支持
		 *
		 * 版本 >= 0
		 */
		var $dwIsCod; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cIsCod_u; //uint8_t

		/**
		 * 延迟信息
		 *
		 * 版本 >= 0
		 */
		var $oDelay; //icson::deal::bo::CDelayInfo

		/**
		 * 版本 >= 0
		 */
		var $cDelay_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->strStockDesc = ""; // std::string
			 $this->cStockDesc_u = 0; // uint8_t
			 $this->dwStockStatus = 0; // uint32_t
			 $this->cStockStatus_u = 0; // uint8_t
			 $this->dwIsCod = 0; // uint32_t
			 $this->cIsCod_u = 0; // uint8_t
			 $this->oDelay = new DelayInfo(); // icson::deal::bo::CDelayInfo
			 $this->cDelay_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strStockDesc); // 序列化配送描述（有货，当日可出库，支持货到付款...） 类型为std::string
			$bs->pushUint8_t($this->cStockDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockStatus); // 序列化库存状态 类型为uint32_t
			$bs->pushUint8_t($this->cStockStatus_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwIsCod); // 序列化是否支持货到付款，1/0:支持/不支持 类型为uint32_t
			$bs->pushUint8_t($this->cIsCod_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->oDelay,'DelayInfo'); // 序列化延迟信息 类型为icson::deal::bo::CDelayInfo
			$bs->pushUint8_t($this->cDelay_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strStockDesc = $bs->popString(); // 反序列化配送描述（有货，当日可出库，支持货到付款...） 类型为std::string
			$this->cStockDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockStatus = $bs->popUint32_t(); // 反序列化库存状态 类型为uint32_t
			$this->cStockStatus_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwIsCod = $bs->popUint32_t(); // 反序列化是否支持货到付款，1/0:支持/不支持 类型为uint32_t
			$this->cIsCod_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->oDelay = $bs->popObject('DelayInfo'); // 反序列化延迟信息 类型为icson::deal::bo::CDelayInfo
			$this->cDelay_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.deal.idl.BaseShippingInfo.java

if (!class_exists('DelayInfo', false)) {
class DelayInfo
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
		 * 延迟类型
		 *
		 * 版本 >= 0
		 */
		var $dwDelayType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cDelayType_u; //uint8_t

		/**
		 * 延迟值 vValue
		 *
		 * 版本 >= 0
		 */
		var $dwDelayValue; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cDelayValue_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwDelayType = 0; // uint32_t
			 $this->cDelayType_u = 0; // uint8_t
			 $this->dwDelayValue = 0; // uint32_t
			 $this->cDelayValue_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwDelayType); // 序列化延迟类型 类型为uint32_t
			$bs->pushUint8_t($this->cDelayType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwDelayValue); // 序列化延迟值 vValue 类型为uint32_t
			$bs->pushUint8_t($this->cDelayValue_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwDelayType = $bs->popUint32_t(); // 反序列化延迟类型 类型为uint32_t
			$this->cDelayType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwDelayValue = $bs->popUint32_t(); // 反序列化延迟值 vValue 类型为uint32_t
			$this->cDelayValue_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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