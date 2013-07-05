<?php

//source idl: com.icson.deal.idl.GetAttachmentReq.java

if (!class_exists('MainProduct',false)) {
class MainProduct
{
		/**
		 *  协议版本号 
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 *  主商品Id列表 
		 *
		 * 版本 >= 0
		 */
		var $vecMainProductIdList; //std::vector<uint32_t> 

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cMainProductIdList_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->vecMainProductIdList = new stl_vector('uint32_t'); // std::vector<uint32_t> 
			 $this->cVersion_u = 0; // uint8_t
			 $this->cMainProductIdList_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化 协议版本号  类型为uint16_t
			$bs->pushObject($this->vecMainProductIdList,'stl_vector'); // 序列化 主商品Id列表  类型为std::vector<uint32_t> 
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cMainProductIdList_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化 协议版本号  类型为uint16_t
			$this->vecMainProductIdList = $bs->popObject('stl_vector<uint32_t>'); // 反序列化 主商品Id列表  类型为std::vector<uint32_t> 
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cMainProductIdList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.deal.idl.AttachmentAo.java

if (!class_exists('Attachment',false)) {
class Attachment
{
		/**
		 *  协议版本号 
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 *  套餐信息列表
		 *
		 * 版本 >= 0
		 */
		var $oPromotion; //icson::deal::ddo::attachment::CPromotion

		/**
		 *  赠品组件列表
		 *
		 * 版本 >= 0
		 */
		var $vecVecGift; //std::vector<icson::deal::ddo::attachment::CGift> 

		/**
		 * 随心配列表
		 *
		 * 版本 >= 0
		 */
		var $vecVecRelative; //std::vector<icson::deal::ddo::attachment::CRelativity> 

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPromotion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cVecGift_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cVecRelative_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->oPromotion = new Promotion(); // icson::deal::ddo::attachment::CPromotion
			 $this->vecVecGift = new stl_vector('Gift'); // std::vector<icson::deal::ddo::attachment::CGift> 
			 $this->vecVecRelative = new stl_vector('Relativity'); // std::vector<icson::deal::ddo::attachment::CRelativity> 
			 $this->cVersion_u = 0; // uint8_t
			 $this->cPromotion_u = 0; // uint8_t
			 $this->cVecGift_u = 0; // uint8_t
			 $this->cVecRelative_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化 协议版本号  类型为uint16_t
			$bs->pushObject($this->oPromotion,'Promotion'); // 序列化 套餐信息列表 类型为icson::deal::ddo::attachment::CPromotion
			$bs->pushObject($this->vecVecGift,'stl_vector'); // 序列化 赠品组件列表 类型为std::vector<icson::deal::ddo::attachment::CGift> 
			$bs->pushObject($this->vecVecRelative,'stl_vector'); // 序列化随心配列表 类型为std::vector<icson::deal::ddo::attachment::CRelativity> 
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPromotion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cVecGift_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cVecRelative_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化 协议版本号  类型为uint16_t
			$this->oPromotion = $bs->popObject('Promotion'); // 反序列化 套餐信息列表 类型为icson::deal::ddo::attachment::CPromotion
			$this->vecVecGift = $bs->popObject('stl_vector<Gift>'); // 反序列化 赠品组件列表 类型为std::vector<icson::deal::ddo::attachment::CGift> 
			$this->vecVecRelative = $bs->popObject('stl_vector<Relativity>'); // 反序列化随心配列表 类型为std::vector<icson::deal::ddo::attachment::CRelativity> 
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPromotion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cVecGift_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cVecRelative_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.deal.idl.Attachment.java

if (!class_exists('Relativity',false)) {
class Relativity
{
		/**
		 *  协议版本号 
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 随心配搭配商品Id
		 *
		 * 版本 >= 0
		 */
		var $dwRelativityId; //uint32_t

		/**
		 * 随心配商品价格
		 *
		 * 版本 >= 0
		 */
		var $nPrice; //int

		/**
		 * 随心配商品市场价格
		 *
		 * 版本 >= 0
		 */
		var $nMarketPrice; //int

		/**
		 * 随心配商品名称
		 *
		 * 版本 >= 0
		 */
		var $strName; //std::string

		/**
		 * 随心配商品char_id
		 *
		 * 版本 >= 0
		 */
		var $strProductCharId; //std::string

		/**
		 * 排序依据
		 *
		 * 版本 >= 0
		 */
		var $nSortNum; //int

		/**
		 * 类型
		 *
		 * 版本 >= 0
		 */
		var $nType; //int

		/**
		 * property
		 *
		 * 版本 >= 0
		 */
		var $strProperty; //std::string

		/**
		 * updatetime
		 *
		 * 版本 >= 0
		 */
		var $dwUpdatetime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRelativityId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPrice_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cMarketPrice_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cProductCharId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSortNum_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cProperty_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cUpdatetime_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->dwRelativityId = 0; // uint32_t
			 $this->nPrice = 0; // int
			 $this->nMarketPrice = 0; // int
			 $this->strName = ""; // std::string
			 $this->strProductCharId = ""; // std::string
			 $this->nSortNum = 0; // int
			 $this->nType = 0; // int
			 $this->strProperty = ""; // std::string
			 $this->dwUpdatetime = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->cRelativityId_u = 0; // uint8_t
			 $this->cPrice_u = 0; // uint8_t
			 $this->cMarketPrice_u = 0; // uint8_t
			 $this->cName_u = 0; // uint8_t
			 $this->cProductCharId_u = 0; // uint8_t
			 $this->cSortNum_u = 0; // uint8_t
			 $this->cType_u = 0; // uint8_t
			 $this->cProperty_u = 0; // uint8_t
			 $this->cUpdatetime_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化 协议版本号  类型为uint16_t
			$bs->pushUint32_t($this->dwRelativityId); // 序列化随心配搭配商品Id 类型为uint32_t
			$bs->pushInt32_t($this->nPrice); // 序列化随心配商品价格 类型为int
			$bs->pushInt32_t($this->nMarketPrice); // 序列化随心配商品市场价格 类型为int
			$bs->pushString($this->strName); // 序列化随心配商品名称 类型为std::string
			$bs->pushString($this->strProductCharId); // 序列化随心配商品char_id 类型为std::string
			$bs->pushInt32_t($this->nSortNum); // 序列化排序依据 类型为int
			$bs->pushInt32_t($this->nType); // 序列化类型 类型为int
			$bs->pushString($this->strProperty); // 序列化property 类型为std::string
			$bs->pushUint32_t($this->dwUpdatetime); // 序列化updatetime 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRelativityId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cMarketPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cProductCharId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSortNum_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cProperty_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cUpdatetime_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化 协议版本号  类型为uint16_t
			$this->dwRelativityId = $bs->popUint32_t(); // 反序列化随心配搭配商品Id 类型为uint32_t
			$this->nPrice = $bs->popInt32_t(); // 反序列化随心配商品价格 类型为int
			$this->nMarketPrice = $bs->popInt32_t(); // 反序列化随心配商品市场价格 类型为int
			$this->strName = $bs->popString(); // 反序列化随心配商品名称 类型为std::string
			$this->strProductCharId = $bs->popString(); // 反序列化随心配商品char_id 类型为std::string
			$this->nSortNum = $bs->popInt32_t(); // 反序列化排序依据 类型为int
			$this->nType = $bs->popInt32_t(); // 反序列化类型 类型为int
			$this->strProperty = $bs->popString(); // 反序列化property 类型为std::string
			$this->dwUpdatetime = $bs->popUint32_t(); // 反序列化updatetime 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRelativityId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cMarketPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cProductCharId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSortNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cUpdatetime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.deal.idl.Attachment.java

if (!class_exists('Promotion',false)) {
class Promotion
{
		/**
		 *  协议版本号 
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 *  套餐信息列表
		 *
		 * 版本 >= 0
		 */
		var $vecVecMainIdPackage; //std::vector<icson::deal::ddo::attachment::CPackage> 

		/**
		 * 优惠券列表
		 *
		 * 版本 >= 0
		 */
		var $vecVecMainIdCoupon; //std::vector<icson::deal::ddo::attachment::CCoupon> 

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cVecMainIdPackage_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cVecMainIdCoupon_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->vecVecMainIdPackage = new stl_vector('Package'); // std::vector<icson::deal::ddo::attachment::CPackage> 
			 $this->vecVecMainIdCoupon = new stl_vector('Coupon'); // std::vector<icson::deal::ddo::attachment::CCoupon> 
			 $this->cVersion_u = 0; // uint8_t
			 $this->cVecMainIdPackage_u = 0; // uint8_t
			 $this->cVecMainIdCoupon_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化 协议版本号  类型为uint16_t
			$bs->pushObject($this->vecVecMainIdPackage,'stl_vector'); // 序列化 套餐信息列表 类型为std::vector<icson::deal::ddo::attachment::CPackage> 
			$bs->pushObject($this->vecVecMainIdCoupon,'stl_vector'); // 序列化优惠券列表 类型为std::vector<icson::deal::ddo::attachment::CCoupon> 
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cVecMainIdPackage_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cVecMainIdCoupon_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化 协议版本号  类型为uint16_t
			$this->vecVecMainIdPackage = $bs->popObject('stl_vector<Package>'); // 反序列化 套餐信息列表 类型为std::vector<icson::deal::ddo::attachment::CPackage> 
			$this->vecVecMainIdCoupon = $bs->popObject('stl_vector<Coupon>'); // 反序列化优惠券列表 类型为std::vector<icson::deal::ddo::attachment::CCoupon> 
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cVecMainIdPackage_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cVecMainIdCoupon_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.deal.idl.Promotion.java

if (!class_exists('Coupon',false)) {
class Coupon
{
		/**
		 *  协议版本号 
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 *  对应的单品促销规则Id 
		 *
		 * 版本 >= 0
		 */
		var $dwRuleId; //uint32_t

		/**
		 * 单品促销名称
		 *
		 * 版本 >= 0
		 */
		var $strPromotionName; //std::string

		/**
		 * 优惠券信息列表
		 *
		 * 版本 >= 0
		 */
		var $vecVecCouponInfo; //std::vector<icson::deal::ddo::attachment::CCouponInfo> 

		/**
		 * pidList
		 *
		 * 版本 >= 0
		 */
		var $vecVecPidList; //std::vector<uint32_t> 

		/**
		 * 单品促销有效开始时间
		 *
		 * 版本 >= 0
		 */
		var $dwBeginTime; //uint32_t

		/**
		 * 单品促销有效的结束时间
		 *
		 * 版本 >= 0
		 */
		var $dwEndTime; //uint32_t

		/**
		 * account_type
		 *
		 * 版本 >= 0
		 */
		var $dwAccountType; //uint32_t

		/**
		 * wh_id
		 *
		 * 版本 >= 0
		 */
		var $dwWhId; //uint32_t

		/**
		 * join_limit
		 *
		 * 版本 >= 0
		 */
		var $dwJoinLimit; //uint32_t

		/**
		 * url
		 *
		 * 版本 >= 0
		 */
		var $strUrl; //std::string

		/**
		 * comment
		 *
		 * 版本 >= 0
		 */
		var $strComment; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRuleId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPromotionName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cVecCouponInfo_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cVecPidList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBeginTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cEndTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cAccountType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cWhId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cJoinLimit_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cUrl_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cComment_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->dwRuleId = 0; // uint32_t
			 $this->strPromotionName = ""; // std::string
			 $this->vecVecCouponInfo = new stl_vector('CouponInfo'); // std::vector<icson::deal::ddo::attachment::CCouponInfo> 
			 $this->vecVecPidList = new stl_vector('uint32_t'); // std::vector<uint32_t> 
			 $this->dwBeginTime = 0; // uint32_t
			 $this->dwEndTime = 0; // uint32_t
			 $this->dwAccountType = 0; // uint32_t
			 $this->dwWhId = 0; // uint32_t
			 $this->dwJoinLimit = 0; // uint32_t
			 $this->strUrl = ""; // std::string
			 $this->strComment = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cRuleId_u = 0; // uint8_t
			 $this->cPromotionName_u = 0; // uint8_t
			 $this->cVecCouponInfo_u = 0; // uint8_t
			 $this->cVecPidList_u = 0; // uint8_t
			 $this->cBeginTime_u = 0; // uint8_t
			 $this->cEndTime_u = 0; // uint8_t
			 $this->cAccountType_u = 0; // uint8_t
			 $this->cWhId_u = 0; // uint8_t
			 $this->cJoinLimit_u = 0; // uint8_t
			 $this->cUrl_u = 0; // uint8_t
			 $this->cComment_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化 协议版本号  类型为uint16_t
			$bs->pushUint32_t($this->dwRuleId); // 序列化 对应的单品促销规则Id  类型为uint32_t
			$bs->pushString($this->strPromotionName); // 序列化单品促销名称 类型为std::string
			$bs->pushObject($this->vecVecCouponInfo,'stl_vector'); // 序列化优惠券信息列表 类型为std::vector<icson::deal::ddo::attachment::CCouponInfo> 
			$bs->pushObject($this->vecVecPidList,'stl_vector'); // 序列化pidList 类型为std::vector<uint32_t> 
			$bs->pushUint32_t($this->dwBeginTime); // 序列化单品促销有效开始时间 类型为uint32_t
			$bs->pushUint32_t($this->dwEndTime); // 序列化单品促销有效的结束时间 类型为uint32_t
			$bs->pushUint32_t($this->dwAccountType); // 序列化account_type 类型为uint32_t
			$bs->pushUint32_t($this->dwWhId); // 序列化wh_id 类型为uint32_t
			$bs->pushUint32_t($this->dwJoinLimit); // 序列化join_limit 类型为uint32_t
			$bs->pushString($this->strUrl); // 序列化url 类型为std::string
			$bs->pushString($this->strComment); // 序列化comment 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRuleId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPromotionName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cVecCouponInfo_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cVecPidList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBeginTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cEndTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cAccountType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cWhId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cJoinLimit_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cUrl_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cComment_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化 协议版本号  类型为uint16_t
			$this->dwRuleId = $bs->popUint32_t(); // 反序列化 对应的单品促销规则Id  类型为uint32_t
			$this->strPromotionName = $bs->popString(); // 反序列化单品促销名称 类型为std::string
			$this->vecVecCouponInfo = $bs->popObject('stl_vector<CouponInfo>'); // 反序列化优惠券信息列表 类型为std::vector<icson::deal::ddo::attachment::CCouponInfo> 
			$this->vecVecPidList = $bs->popObject('stl_vector<uint32_t>'); // 反序列化pidList 类型为std::vector<uint32_t> 
			$this->dwBeginTime = $bs->popUint32_t(); // 反序列化单品促销有效开始时间 类型为uint32_t
			$this->dwEndTime = $bs->popUint32_t(); // 反序列化单品促销有效的结束时间 类型为uint32_t
			$this->dwAccountType = $bs->popUint32_t(); // 反序列化account_type 类型为uint32_t
			$this->dwWhId = $bs->popUint32_t(); // 反序列化wh_id 类型为uint32_t
			$this->dwJoinLimit = $bs->popUint32_t(); // 反序列化join_limit 类型为uint32_t
			$this->strUrl = $bs->popString(); // 反序列化url 类型为std::string
			$this->strComment = $bs->popString(); // 反序列化comment 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRuleId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPromotionName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cVecCouponInfo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cVecPidList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBeginTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cEndTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cAccountType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cWhId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cJoinLimit_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cUrl_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cComment_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.deal.idl.Coupon.java

if (!class_exists('CouponInfo',false)) {
class CouponInfo
{
		/**
		 *  协议版本号 
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 *  优惠券id 
		 *
		 * 版本 >= 0
		 */
		var $dwBatch; //uint32_t

		/**
		 * 优惠券状态
		 *
		 * 版本 >= 0
		 */
		var $nStatus; //int

		/**
		 * 优惠券名称
		 *
		 * 版本 >= 0
		 */
		var $strName; //std::string

		/**
		 * 优惠券amt
		 *
		 * 版本 >= 0
		 */
		var $nAmt; //int

		/**
		 * valid_time_from
		 *
		 * 版本 >= 0
		 */
		var $dwValidTimeFrom; //uint32_t

		/**
		 * valid_time_to
		 *
		 * 版本 >= 0
		 */
		var $dwValidTimeTo; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBatch_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cStatus_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cAmt_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cValidTimeFrom_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cValidTimeTo_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->dwBatch = 0; // uint32_t
			 $this->nStatus = 0; // int
			 $this->strName = ""; // std::string
			 $this->nAmt = 0; // int
			 $this->dwValidTimeFrom = 0; // uint32_t
			 $this->dwValidTimeTo = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->cBatch_u = 0; // uint8_t
			 $this->cStatus_u = 0; // uint8_t
			 $this->cName_u = 0; // uint8_t
			 $this->cAmt_u = 0; // uint8_t
			 $this->cValidTimeFrom_u = 0; // uint8_t
			 $this->cValidTimeTo_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化 协议版本号  类型为uint16_t
			$bs->pushUint32_t($this->dwBatch); // 序列化 优惠券id  类型为uint32_t
			$bs->pushInt32_t($this->nStatus); // 序列化优惠券状态 类型为int
			$bs->pushString($this->strName); // 序列化优惠券名称 类型为std::string
			$bs->pushInt32_t($this->nAmt); // 序列化优惠券amt 类型为int
			$bs->pushUint32_t($this->dwValidTimeFrom); // 序列化valid_time_from 类型为uint32_t
			$bs->pushUint32_t($this->dwValidTimeTo); // 序列化valid_time_to 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBatch_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cStatus_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cAmt_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cValidTimeFrom_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cValidTimeTo_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化 协议版本号  类型为uint16_t
			$this->dwBatch = $bs->popUint32_t(); // 反序列化 优惠券id  类型为uint32_t
			$this->nStatus = $bs->popInt32_t(); // 反序列化优惠券状态 类型为int
			$this->strName = $bs->popString(); // 反序列化优惠券名称 类型为std::string
			$this->nAmt = $bs->popInt32_t(); // 反序列化优惠券amt 类型为int
			$this->dwValidTimeFrom = $bs->popUint32_t(); // 反序列化valid_time_from 类型为uint32_t
			$this->dwValidTimeTo = $bs->popUint32_t(); // 反序列化valid_time_to 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBatch_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cStatus_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cAmt_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cValidTimeFrom_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cValidTimeTo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.deal.idl.Promotion.java

if (!class_exists('Package',false)) {
class Package
{
		/**
		 *  协议版本号 
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 *  促销规则名称
		 *
		 * 版本 >= 0
		 */
		var $strPromotionName; //std::string

		/**
		 *  套餐对应的规则Id
		 *
		 * 版本 >= 0
		 */
		var $dwRuleId; //uint32_t

		/**
		 * 套餐商品信息列表
		 *
		 * 版本 >= 0
		 */
		var $vecVecPackageInfo; //std::vector<icson::deal::ddo::attachment::CPackageInfo> 

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPromotionName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRuleId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cVecPackageInfo_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->strPromotionName = ""; // std::string
			 $this->dwRuleId = 0; // uint32_t
			 $this->vecVecPackageInfo = new stl_vector('PackageInfo'); // std::vector<icson::deal::ddo::attachment::CPackageInfo> 
			 $this->cVersion_u = 0; // uint8_t
			 $this->cPromotionName_u = 0; // uint8_t
			 $this->cRuleId_u = 0; // uint8_t
			 $this->cVecPackageInfo_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化 协议版本号  类型为uint16_t
			$bs->pushString($this->strPromotionName); // 序列化 促销规则名称 类型为std::string
			$bs->pushUint32_t($this->dwRuleId); // 序列化 套餐对应的规则Id 类型为uint32_t
			$bs->pushObject($this->vecVecPackageInfo,'stl_vector'); // 序列化套餐商品信息列表 类型为std::vector<icson::deal::ddo::attachment::CPackageInfo> 
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPromotionName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRuleId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cVecPackageInfo_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化 协议版本号  类型为uint16_t
			$this->strPromotionName = $bs->popString(); // 反序列化 促销规则名称 类型为std::string
			$this->dwRuleId = $bs->popUint32_t(); // 反序列化 套餐对应的规则Id 类型为uint32_t
			$this->vecVecPackageInfo = $bs->popObject('stl_vector<PackageInfo>'); // 反序列化套餐商品信息列表 类型为std::vector<icson::deal::ddo::attachment::CPackageInfo> 
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPromotionName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRuleId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cVecPackageInfo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.deal.idl.Package.java

if (!class_exists('PackageInfo',false)) {
class PackageInfo
{
		/**
		 *  协议版本号 
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 套餐商品优惠价格
		 *
		 * 版本 >= 0
		 */
		var $dwPackageCashBack; //uint32_t

		/**
		 * 商品id
		 *
		 * 版本 >= 0
		 */
		var $dwProductId; //uint32_t

		/**
		 * 商品名称
		 *
		 * 版本 >= 0
		 */
		var $strName; //std::string

		/**
		 * 商品价格
		 *
		 * 版本 >= 0
		 */
		var $nPrice; //int

		/**
		 * 商品市场价格
		 *
		 * 版本 >= 0
		 */
		var $nMarketPrice; //int

		/**
		 * 商品char_id
		 *
		 * 版本 >= 0
		 */
		var $strProductCharId; //std::string

		/**
		 * 分站id
		 *
		 * 版本 >= 0
		 */
		var $dwWhId; //uint32_t

		/**
		 * 标志位
		 *
		 * 版本 >= 0
		 */
		var $nFlag; //int

		/**
		 * 状态
		 *
		 * 版本 >= 0
		 */
		var $nStatus; //int

		/**
		 * 限运类型
		 *
		 * 版本 >= 0
		 */
		var $nRestrictedTransType; //int

		/**
		 * 促销语言
		 *
		 * 版本 >= 0
		 */
		var $strPromotionWord; //std::string

		/**
		 * 可用库存
		 *
		 * 版本 >= 0
		 */
		var $nAvailableNum; //int

		/**
		 * 虚拟库存
		 *
		 * 版本 >= 0
		 */
		var $nVirtualNum; //int

		/**
		 * psystock
		 *
		 * 版本 >= 0
		 */
		var $dwPsyStock; //uint32_t

		/**
		 * arrival_days
		 *
		 * 版本 >= 0
		 */
		var $nArrivalDays; //int

		/**
		 * cash back
		 *
		 * 版本 >= 0
		 */
		var $nCashBack; //int

		/**
		 * cost_price
		 *
		 * 版本 >= 0
		 */
		var $nCostPrice; //int

		/**
		 * 限制数量
		 *
		 * 版本 >= 0
		 */
		var $nNumLimit; //int

		/**
		 * 三级类目Id
		 *
		 * 版本 >= 0
		 */
		var $strC3Ids; //std::string

		/**
		 * 重量
		 *
		 * 版本 >= 0
		 */
		var $dwWeight; //uint32_t

		/**
		 * 图片数量
		 *
		 * 版本 >= 0
		 */
		var $dwPicNum; //uint32_t

		/**
		 * 颜色
		 *
		 * 版本 >= 0
		 */
		var $nColor; //int

		/**
		 * 尺码
		 *
		 * 版本 >= 0
		 */
		var $nProductSize; //int

		/**
		 * 多价类型
		 *
		 * 版本 >= 0
		 */
		var $nMultiPriceType; //int

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPackageCashBack_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cProductId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPrice_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cMarketPrice_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cProductCharId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cWhId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cFlag_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cStatus_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRestrictedTransType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPromotionWord_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cAvailableNum_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cVirtualNum_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPsyStock_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cArrivalDays_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCashBack_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCostPrice_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cNumLimit_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cC3Ids_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cWeight_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPicNum_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cColor_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cProductSize_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cMultiPriceType_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->dwPackageCashBack = 0; // uint32_t
			 $this->dwProductId = 0; // uint32_t
			 $this->strName = ""; // std::string
			 $this->nPrice = 0; // int
			 $this->nMarketPrice = 0; // int
			 $this->strProductCharId = ""; // std::string
			 $this->dwWhId = 0; // uint32_t
			 $this->nFlag = 0; // int
			 $this->nStatus = 0; // int
			 $this->nRestrictedTransType = 0; // int
			 $this->strPromotionWord = ""; // std::string
			 $this->nAvailableNum = 0; // int
			 $this->nVirtualNum = 0; // int
			 $this->dwPsyStock = 0; // uint32_t
			 $this->nArrivalDays = 0; // int
			 $this->nCashBack = 0; // int
			 $this->nCostPrice = 0; // int
			 $this->nNumLimit = 0; // int
			 $this->strC3Ids = ""; // std::string
			 $this->dwWeight = 0; // uint32_t
			 $this->dwPicNum = 0; // uint32_t
			 $this->nColor = 0; // int
			 $this->nProductSize = 0; // int
			 $this->nMultiPriceType = 0; // int
			 $this->cVersion_u = 0; // uint8_t
			 $this->cPackageCashBack_u = 0; // uint8_t
			 $this->cProductId_u = 0; // uint8_t
			 $this->cName_u = 0; // uint8_t
			 $this->cPrice_u = 0; // uint8_t
			 $this->cMarketPrice_u = 0; // uint8_t
			 $this->cProductCharId_u = 0; // uint8_t
			 $this->cWhId_u = 0; // uint8_t
			 $this->cFlag_u = 0; // uint8_t
			 $this->cStatus_u = 0; // uint8_t
			 $this->cRestrictedTransType_u = 0; // uint8_t
			 $this->cPromotionWord_u = 0; // uint8_t
			 $this->cAvailableNum_u = 0; // uint8_t
			 $this->cVirtualNum_u = 0; // uint8_t
			 $this->cPsyStock_u = 0; // uint8_t
			 $this->cArrivalDays_u = 0; // uint8_t
			 $this->cCashBack_u = 0; // uint8_t
			 $this->cCostPrice_u = 0; // uint8_t
			 $this->cNumLimit_u = 0; // uint8_t
			 $this->cC3Ids_u = 0; // uint8_t
			 $this->cWeight_u = 0; // uint8_t
			 $this->cPicNum_u = 0; // uint8_t
			 $this->cColor_u = 0; // uint8_t
			 $this->cProductSize_u = 0; // uint8_t
			 $this->cMultiPriceType_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化 协议版本号  类型为uint16_t
			$bs->pushUint32_t($this->dwPackageCashBack); // 序列化套餐商品优惠价格 类型为uint32_t
			$bs->pushUint32_t($this->dwProductId); // 序列化商品id 类型为uint32_t
			$bs->pushString($this->strName); // 序列化商品名称 类型为std::string
			$bs->pushInt32_t($this->nPrice); // 序列化商品价格 类型为int
			$bs->pushInt32_t($this->nMarketPrice); // 序列化商品市场价格 类型为int
			$bs->pushString($this->strProductCharId); // 序列化商品char_id 类型为std::string
			$bs->pushUint32_t($this->dwWhId); // 序列化分站id 类型为uint32_t
			$bs->pushInt32_t($this->nFlag); // 序列化标志位 类型为int
			$bs->pushInt32_t($this->nStatus); // 序列化状态 类型为int
			$bs->pushInt32_t($this->nRestrictedTransType); // 序列化限运类型 类型为int
			$bs->pushString($this->strPromotionWord); // 序列化促销语言 类型为std::string
			$bs->pushInt32_t($this->nAvailableNum); // 序列化可用库存 类型为int
			$bs->pushInt32_t($this->nVirtualNum); // 序列化虚拟库存 类型为int
			$bs->pushUint32_t($this->dwPsyStock); // 序列化psystock 类型为uint32_t
			$bs->pushInt32_t($this->nArrivalDays); // 序列化arrival_days 类型为int
			$bs->pushInt32_t($this->nCashBack); // 序列化cash back 类型为int
			$bs->pushInt32_t($this->nCostPrice); // 序列化cost_price 类型为int
			$bs->pushInt32_t($this->nNumLimit); // 序列化限制数量 类型为int
			$bs->pushString($this->strC3Ids); // 序列化三级类目Id 类型为std::string
			$bs->pushUint32_t($this->dwWeight); // 序列化重量 类型为uint32_t
			$bs->pushUint32_t($this->dwPicNum); // 序列化图片数量 类型为uint32_t
			$bs->pushInt32_t($this->nColor); // 序列化颜色 类型为int
			$bs->pushInt32_t($this->nProductSize); // 序列化尺码 类型为int
			$bs->pushInt32_t($this->nMultiPriceType); // 序列化多价类型 类型为int
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPackageCashBack_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cProductId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cMarketPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cProductCharId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cWhId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cFlag_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cStatus_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRestrictedTransType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPromotionWord_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cAvailableNum_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cVirtualNum_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPsyStock_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cArrivalDays_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCashBack_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCostPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cNumLimit_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cC3Ids_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cWeight_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPicNum_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cColor_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cProductSize_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cMultiPriceType_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化 协议版本号  类型为uint16_t
			$this->dwPackageCashBack = $bs->popUint32_t(); // 反序列化套餐商品优惠价格 类型为uint32_t
			$this->dwProductId = $bs->popUint32_t(); // 反序列化商品id 类型为uint32_t
			$this->strName = $bs->popString(); // 反序列化商品名称 类型为std::string
			$this->nPrice = $bs->popInt32_t(); // 反序列化商品价格 类型为int
			$this->nMarketPrice = $bs->popInt32_t(); // 反序列化商品市场价格 类型为int
			$this->strProductCharId = $bs->popString(); // 反序列化商品char_id 类型为std::string
			$this->dwWhId = $bs->popUint32_t(); // 反序列化分站id 类型为uint32_t
			$this->nFlag = $bs->popInt32_t(); // 反序列化标志位 类型为int
			$this->nStatus = $bs->popInt32_t(); // 反序列化状态 类型为int
			$this->nRestrictedTransType = $bs->popInt32_t(); // 反序列化限运类型 类型为int
			$this->strPromotionWord = $bs->popString(); // 反序列化促销语言 类型为std::string
			$this->nAvailableNum = $bs->popInt32_t(); // 反序列化可用库存 类型为int
			$this->nVirtualNum = $bs->popInt32_t(); // 反序列化虚拟库存 类型为int
			$this->dwPsyStock = $bs->popUint32_t(); // 反序列化psystock 类型为uint32_t
			$this->nArrivalDays = $bs->popInt32_t(); // 反序列化arrival_days 类型为int
			$this->nCashBack = $bs->popInt32_t(); // 反序列化cash back 类型为int
			$this->nCostPrice = $bs->popInt32_t(); // 反序列化cost_price 类型为int
			$this->nNumLimit = $bs->popInt32_t(); // 反序列化限制数量 类型为int
			$this->strC3Ids = $bs->popString(); // 反序列化三级类目Id 类型为std::string
			$this->dwWeight = $bs->popUint32_t(); // 反序列化重量 类型为uint32_t
			$this->dwPicNum = $bs->popUint32_t(); // 反序列化图片数量 类型为uint32_t
			$this->nColor = $bs->popInt32_t(); // 反序列化颜色 类型为int
			$this->nProductSize = $bs->popInt32_t(); // 反序列化尺码 类型为int
			$this->nMultiPriceType = $bs->popInt32_t(); // 反序列化多价类型 类型为int
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPackageCashBack_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cProductId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cMarketPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cProductCharId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cWhId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cFlag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cStatus_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRestrictedTransType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPromotionWord_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cAvailableNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cVirtualNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPsyStock_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cArrivalDays_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCashBack_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCostPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cNumLimit_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cC3Ids_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cWeight_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPicNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cColor_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cProductSize_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cMultiPriceType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.deal.idl.Attachment.java

if (!class_exists('Gift',false)) {
class Gift
{
		/**
		 *  协议版本号 
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 *  赠品id
		 *
		 * 版本 >= 0
		 */
		var $dwGiftId; //uint32_t

		/**
		 * 赠品搭配数量
		 *
		 * 版本 >= 0
		 */
		var $dwNum; //uint32_t

		/**
		 * 赠品/组件类型
		 *
		 * 版本 >= 0
		 */
		var $dwType; //uint32_t

		/**
		 * 赠品状态
		 *
		 * 版本 >= 0
		 */
		var $nStatus; //int

		/**
		 * 赠品的show order
		 *
		 * 版本 >= 0
		 */
		var $nShowOrder; //int

		/**
		 * 赠品名称
		 *
		 * 版本 >= 0
		 */
		var $strName; //std::string

		/**
		 * 赠品商品char_id
		 *
		 * 版本 >= 0
		 */
		var $strProductCharId; //std::string

		/**
		 * 赠品价格
		 *
		 * 版本 >= 0
		 */
		var $dwMarketPrice; //uint32_t

		/**
		 * 赠品的station
		 *
		 * 版本 >= 0
		 */
		var $dwStation; //uint32_t

		/**
		 * 赠品的重量
		 *
		 * 版本 >= 0
		 */
		var $dwWeight; //uint32_t

		/**
		 * stock_num
		 *
		 * 版本 >= 0
		 */
		var $dwStockNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cGiftId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cNum_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cStatus_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cShowOrder_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cProductCharId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cMarketPrice_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cStation_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cWeight_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cStockNum_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->dwGiftId = 0; // uint32_t
			 $this->dwNum = 0; // uint32_t
			 $this->dwType = 0; // uint32_t
			 $this->nStatus = 0; // int
			 $this->nShowOrder = 0; // int
			 $this->strName = ""; // std::string
			 $this->strProductCharId = ""; // std::string
			 $this->dwMarketPrice = 0; // uint32_t
			 $this->dwStation = 0; // uint32_t
			 $this->dwWeight = 0; // uint32_t
			 $this->dwStockNum = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->cGiftId_u = 0; // uint8_t
			 $this->cNum_u = 0; // uint8_t
			 $this->cType_u = 0; // uint8_t
			 $this->cStatus_u = 0; // uint8_t
			 $this->cShowOrder_u = 0; // uint8_t
			 $this->cName_u = 0; // uint8_t
			 $this->cProductCharId_u = 0; // uint8_t
			 $this->cMarketPrice_u = 0; // uint8_t
			 $this->cStation_u = 0; // uint8_t
			 $this->cWeight_u = 0; // uint8_t
			 $this->cStockNum_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化 协议版本号  类型为uint16_t
			$bs->pushUint32_t($this->dwGiftId); // 序列化 赠品id 类型为uint32_t
			$bs->pushUint32_t($this->dwNum); // 序列化赠品搭配数量 类型为uint32_t
			$bs->pushUint32_t($this->dwType); // 序列化赠品/组件类型 类型为uint32_t
			$bs->pushInt32_t($this->nStatus); // 序列化赠品状态 类型为int
			$bs->pushInt32_t($this->nShowOrder); // 序列化赠品的show order 类型为int
			$bs->pushString($this->strName); // 序列化赠品名称 类型为std::string
			$bs->pushString($this->strProductCharId); // 序列化赠品商品char_id 类型为std::string
			$bs->pushUint32_t($this->dwMarketPrice); // 序列化赠品价格 类型为uint32_t
			$bs->pushUint32_t($this->dwStation); // 序列化赠品的station 类型为uint32_t
			$bs->pushUint32_t($this->dwWeight); // 序列化赠品的重量 类型为uint32_t
			$bs->pushUint32_t($this->dwStockNum); // 序列化stock_num 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cGiftId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cNum_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cStatus_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cShowOrder_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cProductCharId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cMarketPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cStation_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cWeight_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cStockNum_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化 协议版本号  类型为uint16_t
			$this->dwGiftId = $bs->popUint32_t(); // 反序列化 赠品id 类型为uint32_t
			$this->dwNum = $bs->popUint32_t(); // 反序列化赠品搭配数量 类型为uint32_t
			$this->dwType = $bs->popUint32_t(); // 反序列化赠品/组件类型 类型为uint32_t
			$this->nStatus = $bs->popInt32_t(); // 反序列化赠品状态 类型为int
			$this->nShowOrder = $bs->popInt32_t(); // 反序列化赠品的show order 类型为int
			$this->strName = $bs->popString(); // 反序列化赠品名称 类型为std::string
			$this->strProductCharId = $bs->popString(); // 反序列化赠品商品char_id 类型为std::string
			$this->dwMarketPrice = $bs->popUint32_t(); // 反序列化赠品价格 类型为uint32_t
			$this->dwStation = $bs->popUint32_t(); // 反序列化赠品的station 类型为uint32_t
			$this->dwWeight = $bs->popUint32_t(); // 反序列化赠品的重量 类型为uint32_t
			$this->dwStockNum = $bs->popUint32_t(); // 反序列化stock_num 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cGiftId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cStatus_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cShowOrder_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cProductCharId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cMarketPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cStation_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cWeight_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cStockNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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