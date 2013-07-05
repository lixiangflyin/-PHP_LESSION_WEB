<?php

//source idl: com.icson.dashou.idl.GetTogetherSellRuleDetailResp.java

if (!class_exists('TogethersellRuleBo' , false )) {
class TogethersellRuleBo
{
		/**
		 *  协议版本号 
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 需要获取的搭售类型，套餐 0x01 , 随心配 0x02， 延保 0x04，赠品 0x08，赠券 0x10，预约规则 0x20
		 *
		 * 版本 >= 0
		 */
		var $wType; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cType_u; //uint8_t

		/**
		 * 规则id
		 *
		 * 版本 >= 0
		 */
		var $dwRuleId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cRuleId_u; //uint8_t

		/**
		 * 套餐信息列表
		 *
		 * 版本 >= 0
		 */
		var $oRulePackage; //icson::dashou::bo::CDSPackage

		/**
		 * 版本 >= 0
		 */
		var $cRulePackage_u; //uint8_t

		/**
		 * 单品赠券列表
		 *
		 * 版本 >= 0
		 */
		var $oRuleCoupon; //icson::dashou::bo::CDSCoupon

		/**
		 * 版本 >= 0
		 */
		var $cRuleCoupon_u; //uint8_t

		/**
		 *  赠品组件列表
		 *
		 * 版本 >= 0
		 */
		var $oRuleGift; //icson::dashou::bo::CDSGift

		/**
		 * 版本 >= 0
		 */
		var $cRuleGift_u; //uint8_t

		/**
		 * 随心配列表
		 *
		 * 版本 >= 0
		 */
		var $oRuleRelative; //icson::dashou::bo::CDSRelativity

		/**
		 * 版本 >= 0
		 */
		var $cRuleRelative_u; //uint8_t

		/**
		 * 延保列表
		 *
		 * 版本 >= 0
		 */
		var $oRuleWarranty; //icson::dashou::bo::CDSWarranty

		/**
		 * 版本 >= 0
		 */
		var $cRuleWarranty_u; //uint8_t

		/**
		 * 预约规则列表
		 *
		 * 版本 >= 0
		 */
		var $oRuleAppointment; //icson::dashou::bo::CDSAppointment

		/**
		 * 版本 >= 0
		 */
		var $cRuleAppointment_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->wType = 0; // uint16_t
			 $this->cType_u = 0; // uint8_t
			 $this->dwRuleId = 0; // uint32_t
			 $this->cRuleId_u = 0; // uint8_t
			 $this->oRulePackage = new DSPackage(); // icson::dashou::bo::CDSPackage
			 $this->cRulePackage_u = 0; // uint8_t
			 $this->oRuleCoupon = new DSCoupon(); // icson::dashou::bo::CDSCoupon
			 $this->cRuleCoupon_u = 0; // uint8_t
			 $this->oRuleGift = new DSGift(); // icson::dashou::bo::CDSGift
			 $this->cRuleGift_u = 0; // uint8_t
			 $this->oRuleRelative = new DSRelativity(); // icson::dashou::bo::CDSRelativity
			 $this->cRuleRelative_u = 0; // uint8_t
			 $this->oRuleWarranty = new DSWarranty(); // icson::dashou::bo::CDSWarranty
			 $this->cRuleWarranty_u = 0; // uint8_t
			 $this->oRuleAppointment = new DSAppointment(); // icson::dashou::bo::CDSAppointment
			 $this->cRuleAppointment_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化 协议版本号  类型为uint16_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wType); // 序列化需要获取的搭售类型，套餐 0x01 , 随心配 0x02， 延保 0x04，赠品 0x08，赠券 0x10，预约规则 0x20 类型为uint16_t
			$bs->pushUint8_t($this->cType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwRuleId); // 序列化规则id 类型为uint32_t
			$bs->pushUint8_t($this->cRuleId_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->oRulePackage,'DSPackage'); // 序列化套餐信息列表 类型为icson::dashou::bo::CDSPackage
			$bs->pushUint8_t($this->cRulePackage_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->oRuleCoupon,'DSCoupon'); // 序列化单品赠券列表 类型为icson::dashou::bo::CDSCoupon
			$bs->pushUint8_t($this->cRuleCoupon_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->oRuleGift,'DSGift'); // 序列化 赠品组件列表 类型为icson::dashou::bo::CDSGift
			$bs->pushUint8_t($this->cRuleGift_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->oRuleRelative,'DSRelativity'); // 序列化随心配列表 类型为icson::dashou::bo::CDSRelativity
			$bs->pushUint8_t($this->cRuleRelative_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->oRuleWarranty,'DSWarranty'); // 序列化延保列表 类型为icson::dashou::bo::CDSWarranty
			$bs->pushUint8_t($this->cRuleWarranty_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->oRuleAppointment,'DSAppointment'); // 序列化预约规则列表 类型为icson::dashou::bo::CDSAppointment
			$bs->pushUint8_t($this->cRuleAppointment_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化 协议版本号  类型为uint16_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wType = $bs->popUint16_t(); // 反序列化需要获取的搭售类型，套餐 0x01 , 随心配 0x02， 延保 0x04，赠品 0x08，赠券 0x10，预约规则 0x20 类型为uint16_t
			$this->cType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRuleId = $bs->popUint32_t(); // 反序列化规则id 类型为uint32_t
			$this->cRuleId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->oRulePackage = $bs->popObject('DSPackage'); // 反序列化套餐信息列表 类型为icson::dashou::bo::CDSPackage
			$this->cRulePackage_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->oRuleCoupon = $bs->popObject('DSCoupon'); // 反序列化单品赠券列表 类型为icson::dashou::bo::CDSCoupon
			$this->cRuleCoupon_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->oRuleGift = $bs->popObject('DSGift'); // 反序列化 赠品组件列表 类型为icson::dashou::bo::CDSGift
			$this->cRuleGift_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->oRuleRelative = $bs->popObject('DSRelativity'); // 反序列化随心配列表 类型为icson::dashou::bo::CDSRelativity
			$this->cRuleRelative_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->oRuleWarranty = $bs->popObject('DSWarranty'); // 反序列化延保列表 类型为icson::dashou::bo::CDSWarranty
			$this->cRuleWarranty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->oRuleAppointment = $bs->popObject('DSAppointment'); // 反序列化预约规则列表 类型为icson::dashou::bo::CDSAppointment
			$this->cRuleAppointment_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.dashou.idl.GetTogetherSellRuleDetailReq.java

if (!class_exists('RuleFilterBo' , false)) {
class RuleFilterBo
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
		 * 需要获取的搭售类型，套餐 0x01 , 随心配 0x02， 延保 0x04，赠品 0x08，赠券 0x10，预约规则 0x20
		 *
		 * 版本 >= 0
		 */
		var $wType; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cRuleType_u; //uint8_t

		/**
		 * 关系ID
		 *
		 * 版本 >= 0
		 */
		var $strRuleId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cRuleId_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->wType = 0; // uint16_t
			 $this->cRuleType_u = 0; // uint8_t
			 $this->strRuleId = ""; // std::string
			 $this->cRuleId_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wType); // 序列化需要获取的搭售类型，套餐 0x01 , 随心配 0x02， 延保 0x04，赠品 0x08，赠券 0x10，预约规则 0x20 类型为uint16_t
			$bs->pushUint8_t($this->cRuleType_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strRuleId); // 序列化关系ID 类型为std::string
			$bs->pushUint8_t($this->cRuleId_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wType = $bs->popUint16_t(); // 反序列化需要获取的搭售类型，套餐 0x01 , 随心配 0x02， 延保 0x04，赠品 0x08，赠券 0x10，预约规则 0x20 类型为uint16_t
			$this->cRuleType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strRuleId = $bs->popString(); // 反序列化关系ID 类型为std::string
			$this->cRuleId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.dashou.idl.GetTogetherSellResp.java

if (!class_exists('TogethersellItemBo' , false)) {
class TogethersellItemBo
{
		/**
		 *  协议版本号 
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 主商品ID
		 *
		 * 版本 >= 0
		 */
		var $dwMainproductId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cMainproductId_u; //uint8_t

		/**
		 * skuid 备用 
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 *  套餐信息列表
		 *
		 * 版本 >= 0
		 */
		var $vecMainIdPackage; //std::vector<icson::dashou::bo::CDSPackage> 

		/**
		 * 版本 >= 0
		 */
		var $cMainIdPackage_u; //uint8_t

		/**
		 * 单品赠券列表
		 *
		 * 版本 >= 0
		 */
		var $vecMainIdCoupon; //std::vector<icson::dashou::bo::CDSCoupon> 

		/**
		 * 版本 >= 0
		 */
		var $cMainIdCoupon_u; //uint8_t

		/**
		 *  赠品组件列表
		 *
		 * 版本 >= 0
		 */
		var $vecMainIdGift; //std::vector<icson::dashou::bo::CDSGift> 

		/**
		 * 版本 >= 0
		 */
		var $cMainIdGift_u; //uint8_t

		/**
		 * 随心配列表
		 *
		 * 版本 >= 0
		 */
		var $vecMainIdRelative; //std::vector<icson::dashou::bo::CDSRelativityClass> 

		/**
		 * 版本 >= 0
		 */
		var $cMainIdRelative_u; //uint8_t

		/**
		 * 延保列表
		 *
		 * 版本 >= 0
		 */
		var $vecMainIdWarranty; //std::vector<icson::dashou::bo::CDSWarranty> 

		/**
		 * 版本 >= 0
		 */
		var $cMainIdWarranty_u; //uint8_t

		/**
		 * 预约列表
		 *
		 * 版本 >= 0
		 */
		var $vecMainIdAppointment; //std::vector<icson::dashou::bo::CDSAppointment> 

		/**
		 * 版本 >= 0
		 */
		var $cMainIdAppointment_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwMainproductId = 0; // uint32_t
			 $this->cMainproductId_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->vecMainIdPackage = new stl_vector('DSPackage'); // std::vector<icson::dashou::bo::CDSPackage> 
			 $this->cMainIdPackage_u = 0; // uint8_t
			 $this->vecMainIdCoupon = new stl_vector('DSCoupon'); // std::vector<icson::dashou::bo::CDSCoupon> 
			 $this->cMainIdCoupon_u = 0; // uint8_t
			 $this->vecMainIdGift = new stl_vector('DSGift'); // std::vector<icson::dashou::bo::CDSGift> 
			 $this->cMainIdGift_u = 0; // uint8_t
			 $this->vecMainIdRelative = new stl_vector('DSRelativityClass'); // std::vector<icson::dashou::bo::CDSRelativityClass> 
			 $this->cMainIdRelative_u = 0; // uint8_t
			 $this->vecMainIdWarranty = new stl_vector('DSWarranty'); // std::vector<icson::dashou::bo::CDSWarranty> 
			 $this->cMainIdWarranty_u = 0; // uint8_t
			 $this->vecMainIdAppointment = new stl_vector('DSAppointment'); // std::vector<icson::dashou::bo::CDSAppointment> 
			 $this->cMainIdAppointment_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化 协议版本号  类型为uint16_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwMainproductId); // 序列化主商品ID 类型为uint32_t
			$bs->pushUint8_t($this->cMainproductId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化skuid 备用  类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecMainIdPackage,'stl_vector'); // 序列化 套餐信息列表 类型为std::vector<icson::dashou::bo::CDSPackage> 
			$bs->pushUint8_t($this->cMainIdPackage_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecMainIdCoupon,'stl_vector'); // 序列化单品赠券列表 类型为std::vector<icson::dashou::bo::CDSCoupon> 
			$bs->pushUint8_t($this->cMainIdCoupon_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecMainIdGift,'stl_vector'); // 序列化 赠品组件列表 类型为std::vector<icson::dashou::bo::CDSGift> 
			$bs->pushUint8_t($this->cMainIdGift_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecMainIdRelative,'stl_vector'); // 序列化随心配列表 类型为std::vector<icson::dashou::bo::CDSRelativityClass> 
			$bs->pushUint8_t($this->cMainIdRelative_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecMainIdWarranty,'stl_vector'); // 序列化延保列表 类型为std::vector<icson::dashou::bo::CDSWarranty> 
			$bs->pushUint8_t($this->cMainIdWarranty_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecMainIdAppointment,'stl_vector'); // 序列化预约列表 类型为std::vector<icson::dashou::bo::CDSAppointment> 
			$bs->pushUint8_t($this->cMainIdAppointment_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化 协议版本号  类型为uint16_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwMainproductId = $bs->popUint32_t(); // 反序列化主商品ID 类型为uint32_t
			$this->cMainproductId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化skuid 备用  类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecMainIdPackage = $bs->popObject('stl_vector<DSPackage>'); // 反序列化 套餐信息列表 类型为std::vector<icson::dashou::bo::CDSPackage> 
			$this->cMainIdPackage_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecMainIdCoupon = $bs->popObject('stl_vector<DSCoupon>'); // 反序列化单品赠券列表 类型为std::vector<icson::dashou::bo::CDSCoupon> 
			$this->cMainIdCoupon_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecMainIdGift = $bs->popObject('stl_vector<DSGift>'); // 反序列化 赠品组件列表 类型为std::vector<icson::dashou::bo::CDSGift> 
			$this->cMainIdGift_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecMainIdRelative = $bs->popObject('stl_vector<DSRelativityClass>'); // 反序列化随心配列表 类型为std::vector<icson::dashou::bo::CDSRelativityClass> 
			$this->cMainIdRelative_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecMainIdWarranty = $bs->popObject('stl_vector<DSWarranty>'); // 反序列化延保列表 类型为std::vector<icson::dashou::bo::CDSWarranty> 
			$this->cMainIdWarranty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecMainIdAppointment = $bs->popObject('stl_vector<DSAppointment>'); // 反序列化预约列表 类型为std::vector<icson::dashou::bo::CDSAppointment> 
			$this->cMainIdAppointment_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.dashou.idl.TogethersellItemBo.java

if (!class_exists('DSRelativityClass' , false)) {
class DSRelativityClass
{
		/**
		 *  协议版本号 
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 随心配分类Id，目前是小类目id
		 *
		 * 版本 >= 0
		 */
		var $strClassId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cClassId_u; //uint8_t

		/**
		 * 随心配分类名称
		 *
		 * 版本 >= 0
		 */
		var $strClassName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cClassName_u; //uint8_t

		/**
		 * 聚类显示顺序 只对随心配有效
		 *
		 * 版本 >= 0
		 */
		var $dwShowOrder; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cShowOrder_u; //uint8_t

		/**
		 * 随心配配置
		 *
		 * 版本 >= 0
		 */
		var $vecVecRelative; //std::vector<icson::dashou::bo::CDSRelativity> 

		/**
		 * 版本 >= 0
		 */
		var $cVecRelative_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->strClassId = ""; // std::string
			 $this->cClassId_u = 0; // uint8_t
			 $this->strClassName = ""; // std::string
			 $this->cClassName_u = 0; // uint8_t
			 $this->dwShowOrder = 0; // uint32_t
			 $this->cShowOrder_u = 0; // uint8_t
			 $this->vecVecRelative = new stl_vector('DSRelativity'); // std::vector<icson::dashou::bo::CDSRelativity> 
			 $this->cVecRelative_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化 协议版本号  类型为uint16_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strClassId); // 序列化随心配分类Id，目前是小类目id 类型为std::string
			$bs->pushUint8_t($this->cClassId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strClassName); // 序列化随心配分类名称 类型为std::string
			$bs->pushUint8_t($this->cClassName_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwShowOrder); // 序列化聚类显示顺序 只对随心配有效 类型为uint32_t
			$bs->pushUint8_t($this->cShowOrder_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecVecRelative,'stl_vector'); // 序列化随心配配置 类型为std::vector<icson::dashou::bo::CDSRelativity> 
			$bs->pushUint8_t($this->cVecRelative_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化 协议版本号  类型为uint16_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strClassId = $bs->popString(); // 反序列化随心配分类Id，目前是小类目id 类型为std::string
			$this->cClassId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strClassName = $bs->popString(); // 反序列化随心配分类名称 类型为std::string
			$this->cClassName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwShowOrder = $bs->popUint32_t(); // 反序列化聚类显示顺序 只对随心配有效 类型为uint32_t
			$this->cShowOrder_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecVecRelative = $bs->popObject('stl_vector<DSRelativity>'); // 反序列化随心配配置 类型为std::vector<icson::dashou::bo::CDSRelativity> 
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


//source idl: com.icson.dashou.idl.GetTogetherSellReq.java

if (!class_exists('DSMainProduct' , false)) {
class DSMainProduct
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
		 * product_id
		 *
		 * 版本 >= 0
		 */
		var $dwProductId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cProductId_u; //uint8_t

		/**
		 * skuid 备用 
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwProductId = 0; // uint32_t
			 $this->cProductId_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwProductId); // 序列化product_id 类型为uint32_t
			$bs->pushUint8_t($this->cProductId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化skuid 备用  类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwProductId = $bs->popUint32_t(); // 反序列化product_id 类型为uint32_t
			$this->cProductId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化skuid 备用  类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.dashou.idl.CheckTogetherSellPackageResp.java

if (!class_exists('CheckTogetherSellPackageResultBo' , false)) {
class CheckTogetherSellPackageResultBo
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
		 * 失效关系列表
		 *
		 * 版本 >= 0
		 */
		var $vecInValidTogetherSell; //std::vector<icson::dashou::bo::CTogetherSellCheckPackageRuleBo> 

		/**
		 * 版本 >= 0
		 */
		var $cInValidTogetherSell_u; //uint8_t

		/**
		 * 生效匹配的关系匹配数量列表
		 *
		 * 版本 >= 0
		 */
		var $vecValidTogetherSellMatched; //std::vector<icson::dashou::bo::CTogetherSellCheckPackageRuleBo> 

		/**
		 * 版本 >= 0
		 */
		var $cValidTogetherSellMatched_u; //uint8_t

		/**
		 * 搭售信息列表
		 *
		 * 版本 >= 0
		 */
		var $vecTogetherSellVect; //std::vector<icson::dashou::bo::CTogethersellBuyBo> 

		/**
		 * 版本 >= 0
		 */
		var $cTogetherSellVect_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->vecInValidTogetherSell = new stl_vector('TogetherSellCheckPackageRuleBo'); // std::vector<icson::dashou::bo::CTogetherSellCheckPackageRuleBo> 
			 $this->cInValidTogetherSell_u = 0; // uint8_t
			 $this->vecValidTogetherSellMatched = new stl_vector('TogetherSellCheckPackageRuleBo'); // std::vector<icson::dashou::bo::CTogetherSellCheckPackageRuleBo> 
			 $this->cValidTogetherSellMatched_u = 0; // uint8_t
			 $this->vecTogetherSellVect = new stl_vector('TogethersellBuyBo'); // std::vector<icson::dashou::bo::CTogethersellBuyBo> 
			 $this->cTogetherSellVect_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecInValidTogetherSell,'stl_vector'); // 序列化失效关系列表 类型为std::vector<icson::dashou::bo::CTogetherSellCheckPackageRuleBo> 
			$bs->pushUint8_t($this->cInValidTogetherSell_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecValidTogetherSellMatched,'stl_vector'); // 序列化生效匹配的关系匹配数量列表 类型为std::vector<icson::dashou::bo::CTogetherSellCheckPackageRuleBo> 
			$bs->pushUint8_t($this->cValidTogetherSellMatched_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecTogetherSellVect,'stl_vector'); // 序列化搭售信息列表 类型为std::vector<icson::dashou::bo::CTogethersellBuyBo> 
			$bs->pushUint8_t($this->cTogetherSellVect_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecInValidTogetherSell = $bs->popObject('stl_vector<TogetherSellCheckPackageRuleBo>'); // 反序列化失效关系列表 类型为std::vector<icson::dashou::bo::CTogetherSellCheckPackageRuleBo> 
			$this->cInValidTogetherSell_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecValidTogetherSellMatched = $bs->popObject('stl_vector<TogetherSellCheckPackageRuleBo>'); // 反序列化生效匹配的关系匹配数量列表 类型为std::vector<icson::dashou::bo::CTogetherSellCheckPackageRuleBo> 
			$this->cValidTogetherSellMatched_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecTogetherSellVect = $bs->popObject('stl_vector<TogethersellBuyBo>'); // 反序列化搭售信息列表 类型为std::vector<icson::dashou::bo::CTogethersellBuyBo> 
			$this->cTogetherSellVect_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.dashou.idl.CheckTogetherSellPackageReq.java

if (!class_exists('CheckTogetherSellPkgParamBo' , false)) {
class CheckTogetherSellPkgParamBo
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
		 *  验证入参数据
		 *
		 * 版本 >= 0
		 */
		var $vecTogetherSellCheckVec; //std::vector<icson::dashou::bo::CTogetherSellCheckPackageRuleBo> 

		/**
		 * 版本 >= 0
		 */
		var $cTogetherSellCheckVec_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->vecTogetherSellCheckVec = new stl_vector('TogetherSellCheckPackageRuleBo'); // std::vector<icson::dashou::bo::CTogetherSellCheckPackageRuleBo> 
			 $this->cTogetherSellCheckVec_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecTogetherSellCheckVec,'stl_vector'); // 序列化 验证入参数据 类型为std::vector<icson::dashou::bo::CTogetherSellCheckPackageRuleBo> 
			$bs->pushUint8_t($this->cTogetherSellCheckVec_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecTogetherSellCheckVec = $bs->popObject('stl_vector<TogetherSellCheckPackageRuleBo>'); // 反序列化 验证入参数据 类型为std::vector<icson::dashou::bo::CTogetherSellCheckPackageRuleBo> 
			$this->cTogetherSellCheckVec_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.dashou.idl.CheckTogetherSellPkgParamBo.java

if (!class_exists('TogetherSellCheckPackageRuleBo' , false)) {
class TogetherSellCheckPackageRuleBo
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
		 * 关系ID ，这里的关系id购物车必须要存储用于验证，否则不是从随心配渠道进来的也会享受优惠，导致数据不一致
		 *
		 * 版本 >= 0
		 */
		var $strRuleId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cRuleId_u; //uint8_t

		/**
		 * 单个套餐优惠额
		 *
		 * 版本 >= 0
		 */
		var $dwDiscount; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cDiscount_u; //uint8_t

		/**
		 * 购买实际数量/匹配数量
		 *
		 * 版本 >= 0
		 */
		var $dwBuyNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyNum_u; //uint8_t

		/**
		 * 失效原因
		 *
		 * 版本 >= 0
		 */
		var $dwInvalidReason; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cInvalidReason_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->strRuleId = ""; // std::string
			 $this->cRuleId_u = 0; // uint8_t
			 $this->dwDiscount = 0; // uint32_t
			 $this->cDiscount_u = 0; // uint8_t
			 $this->dwBuyNum = 0; // uint32_t
			 $this->cBuyNum_u = 0; // uint8_t
			 $this->dwInvalidReason = 0; // uint32_t
			 $this->cInvalidReason_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strRuleId); // 序列化关系ID ，这里的关系id购物车必须要存储用于验证，否则不是从随心配渠道进来的也会享受优惠，导致数据不一致 类型为std::string
			$bs->pushUint8_t($this->cRuleId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwDiscount); // 序列化单个套餐优惠额 类型为uint32_t
			$bs->pushUint8_t($this->cDiscount_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwBuyNum); // 序列化购买实际数量/匹配数量 类型为uint32_t
			$bs->pushUint8_t($this->cBuyNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwInvalidReason); // 序列化失效原因 类型为uint32_t
			$bs->pushUint8_t($this->cInvalidReason_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strRuleId = $bs->popString(); // 反序列化关系ID ，这里的关系id购物车必须要存储用于验证，否则不是从随心配渠道进来的也会享受优惠，导致数据不一致 类型为std::string
			$this->cRuleId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwDiscount = $bs->popUint32_t(); // 反序列化单个套餐优惠额 类型为uint32_t
			$this->cDiscount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwBuyNum = $bs->popUint32_t(); // 反序列化购买实际数量/匹配数量 类型为uint32_t
			$this->cBuyNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwInvalidReason = $bs->popUint32_t(); // 反序列化失效原因 类型为uint32_t
			$this->cInvalidReason_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.dashou.idl.CheckTogetherSellResp.java

if (!class_exists('CheckTogetherSellResultBo' , false)) {
class CheckTogetherSellResultBo
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
		 * 失效关系列表
		 *
		 * 版本 >= 0
		 */
		var $vecInValidTogetherSell; //std::vector<icson::dashou::bo::CTogetherSellCheckBo> 

		/**
		 * 版本 >= 0
		 */
		var $cInValidTogetherSell_u; //uint8_t

		/**
		 * 生效匹配的关系匹配数量列表
		 *
		 * 版本 >= 0
		 */
		var $vecValidTogetherSellMatched; //std::vector<icson::dashou::bo::CTogetherSellCheckBo> 

		/**
		 * 版本 >= 0
		 */
		var $cValidTogetherSellMatched_u; //uint8_t

		/**
		 * 搭售非套餐信息列表
		 *
		 * 版本 >= 0
		 */
		var $vecTogetherSellVect; //std::vector<icson::dashou::bo::CTogethersellBuyBo> 

		/**
		 * 版本 >= 0
		 */
		var $cTogetherSellVect_u; //uint8_t

		/**
		 *  套餐信息列表
		 *
		 * 版本 >= 0
		 */
		var $vecPackage; //std::vector<icson::dashou::bo::CDSPackage> 

		/**
		 * 版本 >= 0
		 */
		var $cPackage_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->vecInValidTogetherSell = new stl_vector('TogetherSellCheckBo'); // std::vector<icson::dashou::bo::CTogetherSellCheckBo> 
			 $this->cInValidTogetherSell_u = 0; // uint8_t
			 $this->vecValidTogetherSellMatched = new stl_vector('TogetherSellCheckBo'); // std::vector<icson::dashou::bo::CTogetherSellCheckBo> 
			 $this->cValidTogetherSellMatched_u = 0; // uint8_t
			 $this->vecTogetherSellVect = new stl_vector('TogethersellBuyBo'); // std::vector<icson::dashou::bo::CTogethersellBuyBo> 
			 $this->cTogetherSellVect_u = 0; // uint8_t
			 $this->vecPackage = new stl_vector('DSPackage'); // std::vector<icson::dashou::bo::CDSPackage> 
			 $this->cPackage_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecInValidTogetherSell,'stl_vector'); // 序列化失效关系列表 类型为std::vector<icson::dashou::bo::CTogetherSellCheckBo> 
			$bs->pushUint8_t($this->cInValidTogetherSell_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecValidTogetherSellMatched,'stl_vector'); // 序列化生效匹配的关系匹配数量列表 类型为std::vector<icson::dashou::bo::CTogetherSellCheckBo> 
			$bs->pushUint8_t($this->cValidTogetherSellMatched_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecTogetherSellVect,'stl_vector'); // 序列化搭售非套餐信息列表 类型为std::vector<icson::dashou::bo::CTogethersellBuyBo> 
			$bs->pushUint8_t($this->cTogetherSellVect_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecPackage,'stl_vector'); // 序列化 套餐信息列表 类型为std::vector<icson::dashou::bo::CDSPackage> 
			$bs->pushUint8_t($this->cPackage_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecInValidTogetherSell = $bs->popObject('stl_vector<TogetherSellCheckBo>'); // 反序列化失效关系列表 类型为std::vector<icson::dashou::bo::CTogetherSellCheckBo> 
			$this->cInValidTogetherSell_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecValidTogetherSellMatched = $bs->popObject('stl_vector<TogetherSellCheckBo>'); // 反序列化生效匹配的关系匹配数量列表 类型为std::vector<icson::dashou::bo::CTogetherSellCheckBo> 
			$this->cValidTogetherSellMatched_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecTogetherSellVect = $bs->popObject('stl_vector<TogethersellBuyBo>'); // 反序列化搭售非套餐信息列表 类型为std::vector<icson::dashou::bo::CTogethersellBuyBo> 
			$this->cTogetherSellVect_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecPackage = $bs->popObject('stl_vector<DSPackage>'); // 反序列化 套餐信息列表 类型为std::vector<icson::dashou::bo::CDSPackage> 
			$this->cPackage_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.dashou.idl.CheckTogetherSellResultBo.java

if (!class_exists('TogethersellBuyBo' , false)) {
class TogethersellBuyBo
{
		/**
		 *  协议版本号 
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 主商品ID
		 *
		 * 版本 >= 0
		 */
		var $dwMainproductId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cMainproductId_u; //uint8_t

		/**
		 * skuid 备用 
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 *  套餐信息列表
		 *
		 * 版本 >= 0
		 */
		var $vecMainIdPackage; //std::vector<icson::dashou::bo::CDSPackage> 

		/**
		 * 版本 >= 0
		 */
		var $cMainIdPackage_u; //uint8_t

		/**
		 * 单品赠券列表
		 *
		 * 版本 >= 0
		 */
		var $vecMainIdCoupon; //std::vector<icson::dashou::bo::CDSCoupon> 

		/**
		 * 版本 >= 0
		 */
		var $cMainIdCoupon_u; //uint8_t

		/**
		 *  赠品组件列表
		 *
		 * 版本 >= 0
		 */
		var $vecMainIdGift; //std::vector<icson::dashou::bo::CDSGift> 

		/**
		 * 版本 >= 0
		 */
		var $cMainIdGift_u; //uint8_t

		/**
		 * 随心配列表
		 *
		 * 版本 >= 0
		 */
		var $vecMainIdRelative; //std::vector<icson::dashou::bo::CDSRelativity> 

		/**
		 * 版本 >= 0
		 */
		var $cMainIdRelative_u; //uint8_t

		/**
		 * 延保列表
		 *
		 * 版本 >= 0
		 */
		var $vecMainIdWarranty; //std::vector<icson::dashou::bo::CDSWarranty> 

		/**
		 * 版本 >= 0
		 */
		var $cMainIdWarranty_u; //uint8_t

		/**
		 * 预约列表
		 *
		 * 版本 >= 0
		 */
		var $vecMainIdAppointment; //std::vector<icson::dashou::bo::CDSAppointment> 

		/**
		 * 版本 >= 0
		 */
		var $cMainIdAppointment_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwMainproductId = 0; // uint32_t
			 $this->cMainproductId_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->vecMainIdPackage = new stl_vector('DSPackage'); // std::vector<icson::dashou::bo::CDSPackage> 
			 $this->cMainIdPackage_u = 0; // uint8_t
			 $this->vecMainIdCoupon = new stl_vector('DSCoupon'); // std::vector<icson::dashou::bo::CDSCoupon> 
			 $this->cMainIdCoupon_u = 0; // uint8_t
			 $this->vecMainIdGift = new stl_vector('DSGift'); // std::vector<icson::dashou::bo::CDSGift> 
			 $this->cMainIdGift_u = 0; // uint8_t
			 $this->vecMainIdRelative = new stl_vector('DSRelativity'); // std::vector<icson::dashou::bo::CDSRelativity> 
			 $this->cMainIdRelative_u = 0; // uint8_t
			 $this->vecMainIdWarranty = new stl_vector('DSWarranty'); // std::vector<icson::dashou::bo::CDSWarranty> 
			 $this->cMainIdWarranty_u = 0; // uint8_t
			 $this->vecMainIdAppointment = new stl_vector('DSAppointment'); // std::vector<icson::dashou::bo::CDSAppointment> 
			 $this->cMainIdAppointment_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化 协议版本号  类型为uint16_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwMainproductId); // 序列化主商品ID 类型为uint32_t
			$bs->pushUint8_t($this->cMainproductId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化skuid 备用  类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecMainIdPackage,'stl_vector'); // 序列化 套餐信息列表 类型为std::vector<icson::dashou::bo::CDSPackage> 
			$bs->pushUint8_t($this->cMainIdPackage_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecMainIdCoupon,'stl_vector'); // 序列化单品赠券列表 类型为std::vector<icson::dashou::bo::CDSCoupon> 
			$bs->pushUint8_t($this->cMainIdCoupon_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecMainIdGift,'stl_vector'); // 序列化 赠品组件列表 类型为std::vector<icson::dashou::bo::CDSGift> 
			$bs->pushUint8_t($this->cMainIdGift_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecMainIdRelative,'stl_vector'); // 序列化随心配列表 类型为std::vector<icson::dashou::bo::CDSRelativity> 
			$bs->pushUint8_t($this->cMainIdRelative_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecMainIdWarranty,'stl_vector'); // 序列化延保列表 类型为std::vector<icson::dashou::bo::CDSWarranty> 
			$bs->pushUint8_t($this->cMainIdWarranty_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecMainIdAppointment,'stl_vector'); // 序列化预约列表 类型为std::vector<icson::dashou::bo::CDSAppointment> 
			$bs->pushUint8_t($this->cMainIdAppointment_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化 协议版本号  类型为uint16_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwMainproductId = $bs->popUint32_t(); // 反序列化主商品ID 类型为uint32_t
			$this->cMainproductId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化skuid 备用  类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecMainIdPackage = $bs->popObject('stl_vector<DSPackage>'); // 反序列化 套餐信息列表 类型为std::vector<icson::dashou::bo::CDSPackage> 
			$this->cMainIdPackage_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecMainIdCoupon = $bs->popObject('stl_vector<DSCoupon>'); // 反序列化单品赠券列表 类型为std::vector<icson::dashou::bo::CDSCoupon> 
			$this->cMainIdCoupon_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecMainIdGift = $bs->popObject('stl_vector<DSGift>'); // 反序列化 赠品组件列表 类型为std::vector<icson::dashou::bo::CDSGift> 
			$this->cMainIdGift_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecMainIdRelative = $bs->popObject('stl_vector<DSRelativity>'); // 反序列化随心配列表 类型为std::vector<icson::dashou::bo::CDSRelativity> 
			$this->cMainIdRelative_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecMainIdWarranty = $bs->popObject('stl_vector<DSWarranty>'); // 反序列化延保列表 类型为std::vector<icson::dashou::bo::CDSWarranty> 
			$this->cMainIdWarranty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecMainIdAppointment = $bs->popObject('stl_vector<DSAppointment>'); // 反序列化预约列表 类型为std::vector<icson::dashou::bo::CDSAppointment> 
			$this->cMainIdAppointment_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.dashou.idl.TogethersellBuyBo.java

if (!class_exists('DSAppointment' , false)) {
class DSAppointment
{
		/**
		 *  协议版本号 
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 *  活动规则id 
		 *
		 * 版本 >= 0
		 */
		var $dwId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cId_u; //uint8_t

		/**
		 *  活动规则名称 
		 *
		 * 版本 >= 0
		 */
		var $strName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cName_u; //uint8_t

		/**
		 *  商品信息的二进制字符串数组
		 *
		 * 版本 >= 0
		 */
		var $vecPid_list; //std::vector<std::string> 

		/**
		 * 版本 >= 0
		 */
		var $cPid_list_u; //uint8_t

		/**
		 *  类型
		 *
		 * 版本 >= 0
		 */
		var $cType; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cType_u; //uint8_t

		/**
		 *  分站id
		 *
		 * 版本 >= 0
		 */
		var $dwWh_id; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cWh_id_u; //uint8_t

		/**
		 *  join_limit
		 *
		 * 版本 >= 0
		 */
		var $dwJoin_limit; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cJoin_limit_u; //uint8_t

		/**
		 *  user_include
		 *
		 * 版本 >= 0
		 */
		var $strUser_include; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cUser_include_u; //uint8_t

		/**
		 *  accounting_type
		 *
		 * 版本 >= 0
		 */
		var $cAccounting_type; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cAccounting_type_u; //uint8_t

		/**
		 *  status
		 *
		 * 版本 >= 0
		 */
		var $nStatus; //int

		/**
		 * 版本 >= 0
		 */
		var $cStatus_u; //uint8_t

		/**
		 *  url
		 *
		 * 版本 >= 0
		 */
		var $strUrl; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cUrl_u; //uint8_t

		/**
		 *  order_time_from
		 *
		 * 版本 >= 0
		 */
		var $dwOrder_time_from; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cOrder_time_from_u; //uint8_t

		/**
		 *  order_time_to
		 *
		 * 版本 >= 0
		 */
		var $dwOrder_time_to; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cOrder_time_to_u; //uint8_t

		/**
		 *  buy_time_from
		 *
		 * 版本 >= 0
		 */
		var $dwBuy_time_from; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cBuy_time_from_u; //uint8_t

		/**
		 *  buy_time_to
		 *
		 * 版本 >= 0
		 */
		var $dwBuy_time_to; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cBuy_time_to_u; //uint8_t

		/**
		 *  eventid
		 *
		 * 版本 >= 0
		 */
		var $dwEventid; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cEventid_u; //uint8_t

		/**
		 *  event_url
		 *
		 * 版本 >= 0
		 */
		var $strEvent_url; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cEvent_url_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwId = 0; // uint32_t
			 $this->cId_u = 0; // uint8_t
			 $this->strName = ""; // std::string
			 $this->cName_u = 0; // uint8_t
			 $this->vecPid_list = new stl_vector('stl_string'); // std::vector<std::string> 
			 $this->cPid_list_u = 0; // uint8_t
			 $this->cType = 0; // uint8_t
			 $this->cType_u = 0; // uint8_t
			 $this->dwWh_id = 0; // uint32_t
			 $this->cWh_id_u = 0; // uint8_t
			 $this->dwJoin_limit = 0; // uint32_t
			 $this->cJoin_limit_u = 0; // uint8_t
			 $this->strUser_include = ""; // std::string
			 $this->cUser_include_u = 0; // uint8_t
			 $this->cAccounting_type = 0; // uint8_t
			 $this->cAccounting_type_u = 0; // uint8_t
			 $this->nStatus = 0; // int
			 $this->cStatus_u = 0; // uint8_t
			 $this->strUrl = ""; // std::string
			 $this->cUrl_u = 0; // uint8_t
			 $this->dwOrder_time_from = 0; // uint32_t
			 $this->cOrder_time_from_u = 0; // uint8_t
			 $this->dwOrder_time_to = 0; // uint32_t
			 $this->cOrder_time_to_u = 0; // uint8_t
			 $this->dwBuy_time_from = 0; // uint32_t
			 $this->cBuy_time_from_u = 0; // uint8_t
			 $this->dwBuy_time_to = 0; // uint32_t
			 $this->cBuy_time_to_u = 0; // uint8_t
			 $this->dwEventid = 0; // uint32_t
			 $this->cEventid_u = 0; // uint8_t
			 $this->strEvent_url = ""; // std::string
			 $this->cEvent_url_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化 协议版本号  类型为uint16_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwId); // 序列化 活动规则id  类型为uint32_t
			$bs->pushUint8_t($this->cId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strName); // 序列化 活动规则名称  类型为std::string
			$bs->pushUint8_t($this->cName_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecPid_list,'stl_vector'); // 序列化 商品信息的二进制字符串数组 类型为std::vector<std::string> 
			$bs->pushUint8_t($this->cPid_list_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cType); // 序列化 类型 类型为uint8_t
			$bs->pushUint8_t($this->cType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwWh_id); // 序列化 分站id 类型为uint32_t
			$bs->pushUint8_t($this->cWh_id_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwJoin_limit); // 序列化 join_limit 类型为uint32_t
			$bs->pushUint8_t($this->cJoin_limit_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strUser_include); // 序列化 user_include 类型为std::string
			$bs->pushUint8_t($this->cUser_include_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cAccounting_type); // 序列化 accounting_type 类型为uint8_t
			$bs->pushUint8_t($this->cAccounting_type_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nStatus); // 序列化 status 类型为int
			$bs->pushUint8_t($this->cStatus_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strUrl); // 序列化 url 类型为std::string
			$bs->pushUint8_t($this->cUrl_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwOrder_time_from); // 序列化 order_time_from 类型为uint32_t
			$bs->pushUint8_t($this->cOrder_time_from_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwOrder_time_to); // 序列化 order_time_to 类型为uint32_t
			$bs->pushUint8_t($this->cOrder_time_to_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwBuy_time_from); // 序列化 buy_time_from 类型为uint32_t
			$bs->pushUint8_t($this->cBuy_time_from_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwBuy_time_to); // 序列化 buy_time_to 类型为uint32_t
			$bs->pushUint8_t($this->cBuy_time_to_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwEventid); // 序列化 eventid 类型为uint32_t
			$bs->pushUint8_t($this->cEventid_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strEvent_url); // 序列化 event_url 类型为std::string
			$bs->pushUint8_t($this->cEvent_url_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化 协议版本号  类型为uint16_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwId = $bs->popUint32_t(); // 反序列化 活动规则id  类型为uint32_t
			$this->cId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strName = $bs->popString(); // 反序列化 活动规则名称  类型为std::string
			$this->cName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecPid_list = $bs->popObject('stl_vector<stl_string>'); // 反序列化 商品信息的二进制字符串数组 类型为std::vector<std::string> 
			$this->cPid_list_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cType = $bs->popUint8_t(); // 反序列化 类型 类型为uint8_t
			$this->cType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwWh_id = $bs->popUint32_t(); // 反序列化 分站id 类型为uint32_t
			$this->cWh_id_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwJoin_limit = $bs->popUint32_t(); // 反序列化 join_limit 类型为uint32_t
			$this->cJoin_limit_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strUser_include = $bs->popString(); // 反序列化 user_include 类型为std::string
			$this->cUser_include_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cAccounting_type = $bs->popUint8_t(); // 反序列化 accounting_type 类型为uint8_t
			$this->cAccounting_type_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nStatus = $bs->popInt32_t(); // 反序列化 status 类型为int
			$this->cStatus_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strUrl = $bs->popString(); // 反序列化 url 类型为std::string
			$this->cUrl_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwOrder_time_from = $bs->popUint32_t(); // 反序列化 order_time_from 类型为uint32_t
			$this->cOrder_time_from_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwOrder_time_to = $bs->popUint32_t(); // 反序列化 order_time_to 类型为uint32_t
			$this->cOrder_time_to_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwBuy_time_from = $bs->popUint32_t(); // 反序列化 buy_time_from 类型为uint32_t
			$this->cBuy_time_from_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwBuy_time_to = $bs->popUint32_t(); // 反序列化 buy_time_to 类型为uint32_t
			$this->cBuy_time_to_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwEventid = $bs->popUint32_t(); // 反序列化 eventid 类型为uint32_t
			$this->cEventid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strEvent_url = $bs->popString(); // 反序列化 event_url 类型为std::string
			$this->cEvent_url_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.dashou.idl.TogethersellBuyBo.java

if (!class_exists('DSRelativity' , false)) {
class DSRelativity
{
		/**
		 *  协议版本号 
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 *  规则ID
		 *
		 * 版本 >= 0
		 */
		var $dwRuleId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cRuleId_u; //uint8_t

		/**
		 * 随心配搭配商品Id
		 *
		 * 版本 >= 0
		 */
		var $dwRelativityId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cRelativityId_u; //uint8_t

		/**
		 * 随心配skuid 备用 
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 随心配商品优惠额和Property一致
		 *
		 * 版本 >= 0
		 */
		var $dwDiscount; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cDiscount_u; //uint8_t

		/**
		 * 前端展示顺序
		 *
		 * 版本 >= 0
		 */
		var $dwShowOrder; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cShowOrder_u; //uint8_t

		/**
		 * 排序依据
		 *
		 * 版本 >= 0
		 */
		var $dwSortNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSortNum_u; //uint8_t

		/**
		 * 类型
		 *
		 * 版本 >= 0
		 */
		var $nType; //int

		/**
		 * 版本 >= 0
		 */
		var $cType_u; //uint8_t

		/**
		 * property
		 *
		 * 版本 >= 0
		 */
		var $strProperty; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cProperty_u; //uint8_t

		/**
		 * updatetime
		 *
		 * 版本 >= 0
		 */
		var $dwUpdatetime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cUpdatetime_u; //uint8_t

		/**
		 * 配品详情信息
		 *
		 * 版本 >= 0
		 */
		var $oItemInfo; //icson::dashou::bo::CItemInfoBo

		/**
		 * 版本 >= 0
		 */
		var $cItemInfo_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwRuleId = 0; // uint32_t
			 $this->cRuleId_u = 0; // uint8_t
			 $this->dwRelativityId = 0; // uint32_t
			 $this->cRelativityId_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->dwDiscount = 0; // uint32_t
			 $this->cDiscount_u = 0; // uint8_t
			 $this->dwShowOrder = 0; // uint32_t
			 $this->cShowOrder_u = 0; // uint8_t
			 $this->dwSortNum = 0; // uint32_t
			 $this->cSortNum_u = 0; // uint8_t
			 $this->nType = 0; // int
			 $this->cType_u = 0; // uint8_t
			 $this->strProperty = ""; // std::string
			 $this->cProperty_u = 0; // uint8_t
			 $this->dwUpdatetime = 0; // uint32_t
			 $this->cUpdatetime_u = 0; // uint8_t
			 $this->oItemInfo = new ItemInfoBo(); // icson::dashou::bo::CItemInfoBo
			 $this->cItemInfo_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化 协议版本号  类型为uint16_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwRuleId); // 序列化 规则ID 类型为uint32_t
			$bs->pushUint8_t($this->cRuleId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwRelativityId); // 序列化随心配搭配商品Id 类型为uint32_t
			$bs->pushUint8_t($this->cRelativityId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化随心配skuid 备用  类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwDiscount); // 序列化随心配商品优惠额和Property一致 类型为uint32_t
			$bs->pushUint8_t($this->cDiscount_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwShowOrder); // 序列化前端展示顺序 类型为uint32_t
			$bs->pushUint8_t($this->cShowOrder_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSortNum); // 序列化排序依据 类型为uint32_t
			$bs->pushUint8_t($this->cSortNum_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nType); // 序列化类型 类型为int
			$bs->pushUint8_t($this->cType_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strProperty); // 序列化property 类型为std::string
			$bs->pushUint8_t($this->cProperty_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwUpdatetime); // 序列化updatetime 类型为uint32_t
			$bs->pushUint8_t($this->cUpdatetime_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->oItemInfo,'ItemInfoBo'); // 序列化配品详情信息 类型为icson::dashou::bo::CItemInfoBo
			$bs->pushUint8_t($this->cItemInfo_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化 协议版本号  类型为uint16_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRuleId = $bs->popUint32_t(); // 反序列化 规则ID 类型为uint32_t
			$this->cRuleId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRelativityId = $bs->popUint32_t(); // 反序列化随心配搭配商品Id 类型为uint32_t
			$this->cRelativityId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化随心配skuid 备用  类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwDiscount = $bs->popUint32_t(); // 反序列化随心配商品优惠额和Property一致 类型为uint32_t
			$this->cDiscount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwShowOrder = $bs->popUint32_t(); // 反序列化前端展示顺序 类型为uint32_t
			$this->cShowOrder_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSortNum = $bs->popUint32_t(); // 反序列化排序依据 类型为uint32_t
			$this->cSortNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nType = $bs->popInt32_t(); // 反序列化类型 类型为int
			$this->cType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strProperty = $bs->popString(); // 反序列化property 类型为std::string
			$this->cProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwUpdatetime = $bs->popUint32_t(); // 反序列化updatetime 类型为uint32_t
			$this->cUpdatetime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->oItemInfo = $bs->popObject('ItemInfoBo'); // 反序列化配品详情信息 类型为icson::dashou::bo::CItemInfoBo
			$this->cItemInfo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.dashou.idl.TogethersellBuyBo.java

if (!class_exists('DSPackage' , false)) {
class DSPackage
{
		/**
		 *  协议版本号 
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 *  促销规则名称
		 *
		 * 版本 >= 0
		 */
		var $strPromotionName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPromotionName_u; //uint8_t

		/**
		 *  套餐对应的规则Id
		 *
		 * 版本 >= 0
		 */
		var $dwRuleId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cRuleId_u; //uint8_t

		/**
		 * 套餐商品信息列表
		 *
		 * 版本 >= 0
		 */
		var $vecVecPackageInfo; //std::vector<icson::dashou::bo::CDSPackageInfo> 

		/**
		 * 版本 >= 0
		 */
		var $cVecPackageInfo_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->strPromotionName = ""; // std::string
			 $this->cPromotionName_u = 0; // uint8_t
			 $this->dwRuleId = 0; // uint32_t
			 $this->cRuleId_u = 0; // uint8_t
			 $this->vecVecPackageInfo = new stl_vector('DSPackageInfo'); // std::vector<icson::dashou::bo::CDSPackageInfo> 
			 $this->cVecPackageInfo_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化 协议版本号  类型为uint16_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPromotionName); // 序列化 促销规则名称 类型为std::string
			$bs->pushUint8_t($this->cPromotionName_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwRuleId); // 序列化 套餐对应的规则Id 类型为uint32_t
			$bs->pushUint8_t($this->cRuleId_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecVecPackageInfo,'stl_vector'); // 序列化套餐商品信息列表 类型为std::vector<icson::dashou::bo::CDSPackageInfo> 
			$bs->pushUint8_t($this->cVecPackageInfo_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化 协议版本号  类型为uint16_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPromotionName = $bs->popString(); // 反序列化 促销规则名称 类型为std::string
			$this->cPromotionName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRuleId = $bs->popUint32_t(); // 反序列化 套餐对应的规则Id 类型为uint32_t
			$this->cRuleId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecVecPackageInfo = $bs->popObject('stl_vector<DSPackageInfo>'); // 反序列化套餐商品信息列表 类型为std::vector<icson::dashou::bo::CDSPackageInfo> 
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


//source idl: com.icson.dashou.idl.DSPackage.java

if (!class_exists('DSPackageInfo' , false)) {
class DSPackageInfo
{
		/**
		 *  协议版本号 
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 套餐商品优惠价格
		 *
		 * 版本 >= 0
		 */
		var $dwPackageCashBack; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPackageCashBack_u; //uint8_t

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
		 * 套餐skuid 备用 
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

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
		 * 促销语言
		 *
		 * 版本 >= 0
		 */
		var $strPromotionWord; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPromotionWord_u; //uint8_t

		/**
		 * cash back
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
		 * 配品详情信息
		 *
		 * 版本 >= 0
		 */
		var $oItemInfo; //icson::dashou::bo::CItemInfoBo

		/**
		 * 版本 >= 0
		 */
		var $cItemInfo_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwPackageCashBack = 0; // uint32_t
			 $this->cPackageCashBack_u = 0; // uint8_t
			 $this->dwProductId = 0; // uint32_t
			 $this->cProductId_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->dwWhId = 0; // uint32_t
			 $this->cWhId_u = 0; // uint8_t
			 $this->strPromotionWord = ""; // std::string
			 $this->cPromotionWord_u = 0; // uint8_t
			 $this->nCashBack = 0; // int
			 $this->cCashBack_u = 0; // uint8_t
			 $this->nCostPrice = 0; // int
			 $this->cCostPrice_u = 0; // uint8_t
			 $this->nNumLimit = 0; // int
			 $this->cNumLimit_u = 0; // uint8_t
			 $this->oItemInfo = new ItemInfoBo(); // icson::dashou::bo::CItemInfoBo
			 $this->cItemInfo_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化 协议版本号  类型为uint16_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPackageCashBack); // 序列化套餐商品优惠价格 类型为uint32_t
			$bs->pushUint8_t($this->cPackageCashBack_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwProductId); // 序列化商品id 类型为uint32_t
			$bs->pushUint8_t($this->cProductId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化套餐skuid 备用  类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwWhId); // 序列化分站id 类型为uint32_t
			$bs->pushUint8_t($this->cWhId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPromotionWord); // 序列化促销语言 类型为std::string
			$bs->pushUint8_t($this->cPromotionWord_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nCashBack); // 序列化cash back 类型为int
			$bs->pushUint8_t($this->cCashBack_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nCostPrice); // 序列化cost_price 类型为int
			$bs->pushUint8_t($this->cCostPrice_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nNumLimit); // 序列化限制数量 类型为int
			$bs->pushUint8_t($this->cNumLimit_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->oItemInfo,'ItemInfoBo'); // 序列化配品详情信息 类型为icson::dashou::bo::CItemInfoBo
			$bs->pushUint8_t($this->cItemInfo_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化 协议版本号  类型为uint16_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPackageCashBack = $bs->popUint32_t(); // 反序列化套餐商品优惠价格 类型为uint32_t
			$this->cPackageCashBack_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwProductId = $bs->popUint32_t(); // 反序列化商品id 类型为uint32_t
			$this->cProductId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化套餐skuid 备用  类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwWhId = $bs->popUint32_t(); // 反序列化分站id 类型为uint32_t
			$this->cWhId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPromotionWord = $bs->popString(); // 反序列化促销语言 类型为std::string
			$this->cPromotionWord_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nCashBack = $bs->popInt32_t(); // 反序列化cash back 类型为int
			$this->cCashBack_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nCostPrice = $bs->popInt32_t(); // 反序列化cost_price 类型为int
			$this->cCostPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nNumLimit = $bs->popInt32_t(); // 反序列化限制数量 类型为int
			$this->cNumLimit_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->oItemInfo = $bs->popObject('ItemInfoBo'); // 反序列化配品详情信息 类型为icson::dashou::bo::CItemInfoBo
			$this->cItemInfo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.dashou.idl.TogethersellBuyBo.java

if (!class_exists('DSCoupon' , false)) {
class DSCoupon
{
		/**
		 *  协议版本号 
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 *  对应的单品促销规则Id 
		 *
		 * 版本 >= 0
		 */
		var $dwRuleId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cRuleId_u; //uint8_t

		/**
		 * 单品促销名称
		 *
		 * 版本 >= 0
		 */
		var $strPromotionName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPromotionName_u; //uint8_t

		/**
		 * 优惠券信息列表
		 *
		 * 版本 >= 0
		 */
		var $vecVecCouponInfo; //std::vector<icson::dashou::bo::CDSCouponInfo> 

		/**
		 * 版本 >= 0
		 */
		var $cVecCouponInfo_u; //uint8_t

		/**
		 * pidList
		 *
		 * 版本 >= 0
		 */
		var $vecVecPidList; //std::vector<uint32_t> 

		/**
		 * 版本 >= 0
		 */
		var $cVecPidList_u; //uint8_t

		/**
		 * 单品促销有效开始时间
		 *
		 * 版本 >= 0
		 */
		var $dwBeginTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cBeginTime_u; //uint8_t

		/**
		 * 单品促销有效的结束时间
		 *
		 * 版本 >= 0
		 */
		var $dwEndTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cEndTime_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwRuleId = 0; // uint32_t
			 $this->cRuleId_u = 0; // uint8_t
			 $this->strPromotionName = ""; // std::string
			 $this->cPromotionName_u = 0; // uint8_t
			 $this->vecVecCouponInfo = new stl_vector('DSCouponInfo'); // std::vector<icson::dashou::bo::CDSCouponInfo> 
			 $this->cVecCouponInfo_u = 0; // uint8_t
			 $this->vecVecPidList = new stl_vector('uint32_t'); // std::vector<uint32_t> 
			 $this->cVecPidList_u = 0; // uint8_t
			 $this->dwBeginTime = 0; // uint32_t
			 $this->cBeginTime_u = 0; // uint8_t
			 $this->dwEndTime = 0; // uint32_t
			 $this->cEndTime_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化 协议版本号  类型为uint16_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwRuleId); // 序列化 对应的单品促销规则Id  类型为uint32_t
			$bs->pushUint8_t($this->cRuleId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPromotionName); // 序列化单品促销名称 类型为std::string
			$bs->pushUint8_t($this->cPromotionName_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecVecCouponInfo,'stl_vector'); // 序列化优惠券信息列表 类型为std::vector<icson::dashou::bo::CDSCouponInfo> 
			$bs->pushUint8_t($this->cVecCouponInfo_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecVecPidList,'stl_vector'); // 序列化pidList 类型为std::vector<uint32_t> 
			$bs->pushUint8_t($this->cVecPidList_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwBeginTime); // 序列化单品促销有效开始时间 类型为uint32_t
			$bs->pushUint8_t($this->cBeginTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwEndTime); // 序列化单品促销有效的结束时间 类型为uint32_t
			$bs->pushUint8_t($this->cEndTime_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化 协议版本号  类型为uint16_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRuleId = $bs->popUint32_t(); // 反序列化 对应的单品促销规则Id  类型为uint32_t
			$this->cRuleId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPromotionName = $bs->popString(); // 反序列化单品促销名称 类型为std::string
			$this->cPromotionName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecVecCouponInfo = $bs->popObject('stl_vector<DSCouponInfo>'); // 反序列化优惠券信息列表 类型为std::vector<icson::dashou::bo::CDSCouponInfo> 
			$this->cVecCouponInfo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecVecPidList = $bs->popObject('stl_vector<uint32_t>'); // 反序列化pidList 类型为std::vector<uint32_t> 
			$this->cVecPidList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwBeginTime = $bs->popUint32_t(); // 反序列化单品促销有效开始时间 类型为uint32_t
			$this->cBeginTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwEndTime = $bs->popUint32_t(); // 反序列化单品促销有效的结束时间 类型为uint32_t
			$this->cEndTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.dashou.idl.DSCoupon.java

if (!class_exists('DSCouponInfo' , false)) {
class DSCouponInfo
{
		/**
		 *  协议版本号 
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 *  优惠券id 
		 *
		 * 版本 >= 0
		 */
		var $dwBatch; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cBatch_u; //uint8_t

		/**
		 * 优惠券状态
		 *
		 * 版本 >= 0
		 */
		var $nStatus; //int

		/**
		 * 版本 >= 0
		 */
		var $cStatus_u; //uint8_t

		/**
		 * 优惠券名称
		 *
		 * 版本 >= 0
		 */
		var $strName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cName_u; //uint8_t

		/**
		 * 优惠券amt
		 *
		 * 版本 >= 0
		 */
		var $nAmt; //int

		/**
		 * 版本 >= 0
		 */
		var $cAmt_u; //uint8_t

		/**
		 * valid_time_from
		 *
		 * 版本 >= 0
		 */
		var $dwValidTimeFrom; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cValidTimeFrom_u; //uint8_t

		/**
		 * valid_time_to
		 *
		 * 版本 >= 0
		 */
		var $dwValidTimeTo; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cValidTimeTo_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwBatch = 0; // uint32_t
			 $this->cBatch_u = 0; // uint8_t
			 $this->nStatus = 0; // int
			 $this->cStatus_u = 0; // uint8_t
			 $this->strName = ""; // std::string
			 $this->cName_u = 0; // uint8_t
			 $this->nAmt = 0; // int
			 $this->cAmt_u = 0; // uint8_t
			 $this->dwValidTimeFrom = 0; // uint32_t
			 $this->cValidTimeFrom_u = 0; // uint8_t
			 $this->dwValidTimeTo = 0; // uint32_t
			 $this->cValidTimeTo_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化 协议版本号  类型为uint16_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwBatch); // 序列化 优惠券id  类型为uint32_t
			$bs->pushUint8_t($this->cBatch_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nStatus); // 序列化优惠券状态 类型为int
			$bs->pushUint8_t($this->cStatus_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strName); // 序列化优惠券名称 类型为std::string
			$bs->pushUint8_t($this->cName_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nAmt); // 序列化优惠券amt 类型为int
			$bs->pushUint8_t($this->cAmt_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwValidTimeFrom); // 序列化valid_time_from 类型为uint32_t
			$bs->pushUint8_t($this->cValidTimeFrom_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwValidTimeTo); // 序列化valid_time_to 类型为uint32_t
			$bs->pushUint8_t($this->cValidTimeTo_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化 协议版本号  类型为uint16_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwBatch = $bs->popUint32_t(); // 反序列化 优惠券id  类型为uint32_t
			$this->cBatch_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nStatus = $bs->popInt32_t(); // 反序列化优惠券状态 类型为int
			$this->cStatus_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strName = $bs->popString(); // 反序列化优惠券名称 类型为std::string
			$this->cName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nAmt = $bs->popInt32_t(); // 反序列化优惠券amt 类型为int
			$this->cAmt_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwValidTimeFrom = $bs->popUint32_t(); // 反序列化valid_time_from 类型为uint32_t
			$this->cValidTimeFrom_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwValidTimeTo = $bs->popUint32_t(); // 反序列化valid_time_to 类型为uint32_t
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


//source idl: com.icson.dashou.idl.TogethersellBuyBo.java

if (!class_exists('DSGift' , false)) {
class DSGift
{
		/**
		 *  协议版本号 
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 *  赠品id
		 *
		 * 版本 >= 0
		 */
		var $dwGiftId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cGiftId_u; //uint8_t

		/**
		 * 赠品skuid 备用 
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 赠品搭配数量
		 *
		 * 版本 >= 0
		 */
		var $dwNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cNum_u; //uint8_t

		/**
		 * 赠品/组件类型
		 *
		 * 版本 >= 0
		 */
		var $dwType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cType_u; //uint8_t

		/**
		 * 赠品的show order
		 *
		 * 版本 >= 0
		 */
		var $nShowOrder; //int

		/**
		 * 版本 >= 0
		 */
		var $cShowOrder_u; //uint8_t

		/**
		 * 赠品的station
		 *
		 * 版本 >= 0
		 */
		var $dwStation; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStation_u; //uint8_t

		/**
		 * stock_num
		 *
		 * 版本 >= 0
		 */
		var $dwStockNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockNum_u; //uint8_t

		/**
		 * 配品详情信息
		 *
		 * 版本 >= 0
		 */
		var $oItemInfo; //icson::dashou::bo::CItemInfoBo

		/**
		 * 版本 >= 0
		 */
		var $cItemInfo_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwGiftId = 0; // uint32_t
			 $this->cGiftId_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->dwNum = 0; // uint32_t
			 $this->cNum_u = 0; // uint8_t
			 $this->dwType = 0; // uint32_t
			 $this->cType_u = 0; // uint8_t
			 $this->nShowOrder = 0; // int
			 $this->cShowOrder_u = 0; // uint8_t
			 $this->dwStation = 0; // uint32_t
			 $this->cStation_u = 0; // uint8_t
			 $this->dwStockNum = 0; // uint32_t
			 $this->cStockNum_u = 0; // uint8_t
			 $this->oItemInfo = new ItemInfoBo(); // icson::dashou::bo::CItemInfoBo
			 $this->cItemInfo_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化 协议版本号  类型为uint16_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwGiftId); // 序列化 赠品id 类型为uint32_t
			$bs->pushUint8_t($this->cGiftId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化赠品skuid 备用  类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwNum); // 序列化赠品搭配数量 类型为uint32_t
			$bs->pushUint8_t($this->cNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwType); // 序列化赠品/组件类型 类型为uint32_t
			$bs->pushUint8_t($this->cType_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nShowOrder); // 序列化赠品的show order 类型为int
			$bs->pushUint8_t($this->cShowOrder_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStation); // 序列化赠品的station 类型为uint32_t
			$bs->pushUint8_t($this->cStation_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockNum); // 序列化stock_num 类型为uint32_t
			$bs->pushUint8_t($this->cStockNum_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->oItemInfo,'ItemInfoBo'); // 序列化配品详情信息 类型为icson::dashou::bo::CItemInfoBo
			$bs->pushUint8_t($this->cItemInfo_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化 协议版本号  类型为uint16_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwGiftId = $bs->popUint32_t(); // 反序列化 赠品id 类型为uint32_t
			$this->cGiftId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化赠品skuid 备用  类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwNum = $bs->popUint32_t(); // 反序列化赠品搭配数量 类型为uint32_t
			$this->cNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwType = $bs->popUint32_t(); // 反序列化赠品/组件类型 类型为uint32_t
			$this->cType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nShowOrder = $bs->popInt32_t(); // 反序列化赠品的show order 类型为int
			$this->cShowOrder_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStation = $bs->popUint32_t(); // 反序列化赠品的station 类型为uint32_t
			$this->cStation_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockNum = $bs->popUint32_t(); // 反序列化stock_num 类型为uint32_t
			$this->cStockNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->oItemInfo = $bs->popObject('ItemInfoBo'); // 反序列化配品详情信息 类型为icson::dashou::bo::CItemInfoBo
			$this->cItemInfo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.dashou.idl.TogethersellBuyBo.java

if (!class_exists('DSWarranty' , false)) {
class DSWarranty
{
		/**
		 *  协议版本号 
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 *  规则ID
		 *
		 * 版本 >= 0
		 */
		var $dwRuleId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cRuleId_u; //uint8_t

		/**
		 * 小类ID
		 *
		 * 版本 >= 0
		 */
		var $dwCategoryId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cCategoryId_u; //uint8_t

		/**
		 * 延保规则商品名称
		 *
		 * 版本 >= 0
		 */
		var $strRuleName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cRuleName_u; //uint8_t

		/**
		 * 延保商品ID
		 *
		 * 版本 >= 0
		 */
		var $dwWarrantyProductId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cWarrantyProductId_u; //uint8_t

		/**
		 * 延保skuid 备用 
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 延保的年限
		 *
		 * 版本 >= 0
		 */
		var $dwWarrantyYears; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cWarrantyYears_u; //uint8_t

		/**
		 * 延保商品名称
		 *
		 * 版本 >= 0
		 */
		var $strWarrantyName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cWarrantyName_u; //uint8_t

		/**
		 * 起始金额
		 *
		 * 版本 >= 0
		 */
		var $dwPriceStart; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceStart_u; //uint8_t

		/**
		 * 截止金额
		 *
		 * 版本 >= 0
		 */
		var $dwPriceEnd; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceEnd_u; //uint8_t

		/**
		 * 规则状态
		 *
		 * 版本 >= 0
		 */
		var $dwRuleStatus; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cRuleStatus_u; //uint8_t

		/**
		 * 优惠金额
		 *
		 * 版本 >= 0
		 */
		var $dwFavor; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cFavor_u; //uint8_t

		/**
		 * 延保商品价格
		 *
		 * 版本 >= 0
		 */
		var $dwWarrantyPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cWarrantyPrice_u; //uint8_t

		/**
		 * 延保的station
		 *
		 * 版本 >= 0
		 */
		var $dwStation; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStation_u; //uint8_t

		/**
		 * 延保的类型
		 *
		 * 版本 >= 0
		 */
		var $dwWarrantyType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cWarrantyType_u; //uint8_t

		/**
		 * 配品详情信息
		 *
		 * 版本 >= 0
		 */
		var $oItemInfo; //icson::dashou::bo::CItemInfoBo

		/**
		 * 版本 >= 0
		 */
		var $cItemInfo_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwRuleId = 0; // uint32_t
			 $this->cRuleId_u = 0; // uint8_t
			 $this->dwCategoryId = 0; // uint32_t
			 $this->cCategoryId_u = 0; // uint8_t
			 $this->strRuleName = ""; // std::string
			 $this->cRuleName_u = 0; // uint8_t
			 $this->dwWarrantyProductId = 0; // uint32_t
			 $this->cWarrantyProductId_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->dwWarrantyYears = 0; // uint32_t
			 $this->cWarrantyYears_u = 0; // uint8_t
			 $this->strWarrantyName = ""; // std::string
			 $this->cWarrantyName_u = 0; // uint8_t
			 $this->dwPriceStart = 0; // uint32_t
			 $this->cPriceStart_u = 0; // uint8_t
			 $this->dwPriceEnd = 0; // uint32_t
			 $this->cPriceEnd_u = 0; // uint8_t
			 $this->dwRuleStatus = 0; // uint32_t
			 $this->cRuleStatus_u = 0; // uint8_t
			 $this->dwFavor = 0; // uint32_t
			 $this->cFavor_u = 0; // uint8_t
			 $this->dwWarrantyPrice = 0; // uint32_t
			 $this->cWarrantyPrice_u = 0; // uint8_t
			 $this->dwStation = 0; // uint32_t
			 $this->cStation_u = 0; // uint8_t
			 $this->dwWarrantyType = 0; // uint32_t
			 $this->cWarrantyType_u = 0; // uint8_t
			 $this->oItemInfo = new ItemInfoBo(); // icson::dashou::bo::CItemInfoBo
			 $this->cItemInfo_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化 协议版本号  类型为uint16_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwRuleId); // 序列化 规则ID 类型为uint32_t
			$bs->pushUint8_t($this->cRuleId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwCategoryId); // 序列化小类ID 类型为uint32_t
			$bs->pushUint8_t($this->cCategoryId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strRuleName); // 序列化延保规则商品名称 类型为std::string
			$bs->pushUint8_t($this->cRuleName_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwWarrantyProductId); // 序列化延保商品ID 类型为uint32_t
			$bs->pushUint8_t($this->cWarrantyProductId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化延保skuid 备用  类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwWarrantyYears); // 序列化延保的年限 类型为uint32_t
			$bs->pushUint8_t($this->cWarrantyYears_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strWarrantyName); // 序列化延保商品名称 类型为std::string
			$bs->pushUint8_t($this->cWarrantyName_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceStart); // 序列化起始金额 类型为uint32_t
			$bs->pushUint8_t($this->cPriceStart_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceEnd); // 序列化截止金额 类型为uint32_t
			$bs->pushUint8_t($this->cPriceEnd_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwRuleStatus); // 序列化规则状态 类型为uint32_t
			$bs->pushUint8_t($this->cRuleStatus_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwFavor); // 序列化优惠金额 类型为uint32_t
			$bs->pushUint8_t($this->cFavor_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwWarrantyPrice); // 序列化延保商品价格 类型为uint32_t
			$bs->pushUint8_t($this->cWarrantyPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStation); // 序列化延保的station 类型为uint32_t
			$bs->pushUint8_t($this->cStation_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwWarrantyType); // 序列化延保的类型 类型为uint32_t
			$bs->pushUint8_t($this->cWarrantyType_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->oItemInfo,'ItemInfoBo'); // 序列化配品详情信息 类型为icson::dashou::bo::CItemInfoBo
			$bs->pushUint8_t($this->cItemInfo_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化 协议版本号  类型为uint16_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRuleId = $bs->popUint32_t(); // 反序列化 规则ID 类型为uint32_t
			$this->cRuleId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwCategoryId = $bs->popUint32_t(); // 反序列化小类ID 类型为uint32_t
			$this->cCategoryId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strRuleName = $bs->popString(); // 反序列化延保规则商品名称 类型为std::string
			$this->cRuleName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwWarrantyProductId = $bs->popUint32_t(); // 反序列化延保商品ID 类型为uint32_t
			$this->cWarrantyProductId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化延保skuid 备用  类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwWarrantyYears = $bs->popUint32_t(); // 反序列化延保的年限 类型为uint32_t
			$this->cWarrantyYears_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strWarrantyName = $bs->popString(); // 反序列化延保商品名称 类型为std::string
			$this->cWarrantyName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceStart = $bs->popUint32_t(); // 反序列化起始金额 类型为uint32_t
			$this->cPriceStart_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceEnd = $bs->popUint32_t(); // 反序列化截止金额 类型为uint32_t
			$this->cPriceEnd_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRuleStatus = $bs->popUint32_t(); // 反序列化规则状态 类型为uint32_t
			$this->cRuleStatus_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwFavor = $bs->popUint32_t(); // 反序列化优惠金额 类型为uint32_t
			$this->cFavor_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwWarrantyPrice = $bs->popUint32_t(); // 反序列化延保商品价格 类型为uint32_t
			$this->cWarrantyPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStation = $bs->popUint32_t(); // 反序列化延保的station 类型为uint32_t
			$this->cStation_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwWarrantyType = $bs->popUint32_t(); // 反序列化延保的类型 类型为uint32_t
			$this->cWarrantyType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->oItemInfo = $bs->popObject('ItemInfoBo'); // 反序列化配品详情信息 类型为icson::dashou::bo::CItemInfoBo
			$this->cItemInfo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.dashou.idl.DSWarranty.java

if (!class_exists('ItemInfoBo' , false)) {
class ItemInfoBo
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
		 * 商品名称
		 *
		 * 版本 >= 0
		 */
		var $strProductName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cProductName_u; //uint8_t

		/**
		 * 商品char_id
		 *
		 * 版本 >= 0
		 */
		var $strProductCharId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cProductCharId_u; //uint8_t

		/**
		 * 市场价
		 *
		 * 版本 >= 0
		 */
		var $dwMarketPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cMarketPrice_u; //uint8_t

		/**
		 * 易迅价
		 *
		 * 版本 >= 0
		 */
		var $dwIcsonPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonPrice_u; //uint8_t

		/**
		 * 商品的重量
		 *
		 * 版本 >= 0
		 */
		var $dwWeight; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cWeight_u; //uint8_t

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
		 * 三级类目Id
		 *
		 * 版本 >= 0
		 */
		var $strC3Ids; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cC3Ids_u; //uint8_t

		/**
		 * 三级类目名称Id
		 *
		 * 版本 >= 0
		 */
		var $strC3IdName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cC3IdName_u; //uint8_t

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
		 * 颜色
		 *
		 * 版本 >= 0
		 */
		var $ddwColor; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cColor_u; //uint8_t

		/**
		 * 商品颜色名称
		 *
		 * 版本 >= 0
		 */
		var $strColorText; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cColorText_u; //uint8_t

		/**
		 * 尺码
		 *
		 * 版本 >= 0
		 */
		var $ddwProductSize; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cProductSize_u; //uint8_t

		/**
		 * 商品规格明文
		 *
		 * 版本 >= 0
		 */
		var $strProductSizeText; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cProductSizeText_u; //uint8_t

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
		 * 商品flag 例如：延保、赠品、组件等
		 *
		 * 版本 >= 0
		 */
		var $dwFlag; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cFlag_u; //uint8_t

		/**
		 * 商品状态 参见enum SkuState状态 0-在售 1-售完 2-下架 3-强制下架 4-删除 5-强制删除 
		 *
		 * 版本 >= 0
		 */
		var $nStatus; //int

		/**
		 * 版本 >= 0
		 */
		var $cStatus_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->strProductName = ""; // std::string
			 $this->cProductName_u = 0; // uint8_t
			 $this->strProductCharId = ""; // std::string
			 $this->cProductCharId_u = 0; // uint8_t
			 $this->dwMarketPrice = 0; // uint32_t
			 $this->cMarketPrice_u = 0; // uint8_t
			 $this->dwIcsonPrice = 0; // uint32_t
			 $this->cIcsonPrice_u = 0; // uint8_t
			 $this->dwWeight = 0; // uint32_t
			 $this->cWeight_u = 0; // uint8_t
			 $this->nRestrictedTransType = 0; // int
			 $this->cRestrictedTransType_u = 0; // uint8_t
			 $this->nAvailableNum = 0; // int
			 $this->cAvailableNum_u = 0; // uint8_t
			 $this->nVirtualNum = 0; // int
			 $this->cVirtualNum_u = 0; // uint8_t
			 $this->dwPsyStock = 0; // uint32_t
			 $this->cPsyStock_u = 0; // uint8_t
			 $this->nArrivalDays = 0; // int
			 $this->cArrivalDays_u = 0; // uint8_t
			 $this->strC3Ids = ""; // std::string
			 $this->cC3Ids_u = 0; // uint8_t
			 $this->strC3IdName = ""; // std::string
			 $this->cC3IdName_u = 0; // uint8_t
			 $this->dwPicNum = 0; // uint32_t
			 $this->cPicNum_u = 0; // uint8_t
			 $this->ddwColor = 0; // uint64_t
			 $this->cColor_u = 0; // uint8_t
			 $this->strColorText = ""; // std::string
			 $this->cColorText_u = 0; // uint8_t
			 $this->ddwProductSize = 0; // uint64_t
			 $this->cProductSize_u = 0; // uint8_t
			 $this->strProductSizeText = ""; // std::string
			 $this->cProductSizeText_u = 0; // uint8_t
			 $this->nMultiPriceType = 0; // int
			 $this->cMultiPriceType_u = 0; // uint8_t
			 $this->mapLogoUrl = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
			 $this->cLogoUrl_u = 0; // uint8_t
			 $this->dwFlag = 0; // uint32_t
			 $this->cFlag_u = 0; // uint8_t
			 $this->nStatus = 0; // int
			 $this->cStatus_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strProductName); // 序列化商品名称 类型为std::string
			$bs->pushUint8_t($this->cProductName_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strProductCharId); // 序列化商品char_id 类型为std::string
			$bs->pushUint8_t($this->cProductCharId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwMarketPrice); // 序列化市场价 类型为uint32_t
			$bs->pushUint8_t($this->cMarketPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwIcsonPrice); // 序列化易迅价 类型为uint32_t
			$bs->pushUint8_t($this->cIcsonPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwWeight); // 序列化商品的重量 类型为uint32_t
			$bs->pushUint8_t($this->cWeight_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nRestrictedTransType); // 序列化限运类型 类型为int
			$bs->pushUint8_t($this->cRestrictedTransType_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nAvailableNum); // 序列化可用库存 类型为int
			$bs->pushUint8_t($this->cAvailableNum_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nVirtualNum); // 序列化虚拟库存 类型为int
			$bs->pushUint8_t($this->cVirtualNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPsyStock); // 序列化psystock 类型为uint32_t
			$bs->pushUint8_t($this->cPsyStock_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nArrivalDays); // 序列化arrival_days 类型为int
			$bs->pushUint8_t($this->cArrivalDays_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strC3Ids); // 序列化三级类目Id 类型为std::string
			$bs->pushUint8_t($this->cC3Ids_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strC3IdName); // 序列化三级类目名称Id 类型为std::string
			$bs->pushUint8_t($this->cC3IdName_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPicNum); // 序列化图片数量 类型为uint32_t
			$bs->pushUint8_t($this->cPicNum_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwColor); // 序列化颜色 类型为uint64_t
			$bs->pushUint8_t($this->cColor_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strColorText); // 序列化商品颜色名称 类型为std::string
			$bs->pushUint8_t($this->cColorText_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwProductSize); // 序列化尺码 类型为uint64_t
			$bs->pushUint8_t($this->cProductSize_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strProductSizeText); // 序列化商品规格明文 类型为std::string
			$bs->pushUint8_t($this->cProductSizeText_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nMultiPriceType); // 序列化多价类型 类型为int
			$bs->pushUint8_t($this->cMultiPriceType_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->mapLogoUrl,'stl_map'); // 序列化图片Url map size->url 如：http://img0.wgimg.com/qqbuy/855006089/item-00000000000000000000003E86B55530.0.jpg/320?50E2EA7E  类型为std::map<std::string,std::string> 
			$bs->pushUint8_t($this->cLogoUrl_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwFlag); // 序列化商品flag 例如：延保、赠品、组件等 类型为uint32_t
			$bs->pushUint8_t($this->cFlag_u); // 序列化 类型为uint8_t
			$bs->pushInt32_t($this->nStatus); // 序列化商品状态 参见enum SkuState状态 0-在售 1-售完 2-下架 3-强制下架 4-删除 5-强制删除  类型为int
			$bs->pushUint8_t($this->cStatus_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strProductName = $bs->popString(); // 反序列化商品名称 类型为std::string
			$this->cProductName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strProductCharId = $bs->popString(); // 反序列化商品char_id 类型为std::string
			$this->cProductCharId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwMarketPrice = $bs->popUint32_t(); // 反序列化市场价 类型为uint32_t
			$this->cMarketPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwIcsonPrice = $bs->popUint32_t(); // 反序列化易迅价 类型为uint32_t
			$this->cIcsonPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwWeight = $bs->popUint32_t(); // 反序列化商品的重量 类型为uint32_t
			$this->cWeight_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nRestrictedTransType = $bs->popInt32_t(); // 反序列化限运类型 类型为int
			$this->cRestrictedTransType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nAvailableNum = $bs->popInt32_t(); // 反序列化可用库存 类型为int
			$this->cAvailableNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nVirtualNum = $bs->popInt32_t(); // 反序列化虚拟库存 类型为int
			$this->cVirtualNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPsyStock = $bs->popUint32_t(); // 反序列化psystock 类型为uint32_t
			$this->cPsyStock_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nArrivalDays = $bs->popInt32_t(); // 反序列化arrival_days 类型为int
			$this->cArrivalDays_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strC3Ids = $bs->popString(); // 反序列化三级类目Id 类型为std::string
			$this->cC3Ids_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strC3IdName = $bs->popString(); // 反序列化三级类目名称Id 类型为std::string
			$this->cC3IdName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPicNum = $bs->popUint32_t(); // 反序列化图片数量 类型为uint32_t
			$this->cPicNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwColor = $bs->popUint64_t(); // 反序列化颜色 类型为uint64_t
			$this->cColor_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strColorText = $bs->popString(); // 反序列化商品颜色名称 类型为std::string
			$this->cColorText_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwProductSize = $bs->popUint64_t(); // 反序列化尺码 类型为uint64_t
			$this->cProductSize_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strProductSizeText = $bs->popString(); // 反序列化商品规格明文 类型为std::string
			$this->cProductSizeText_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nMultiPriceType = $bs->popInt32_t(); // 反序列化多价类型 类型为int
			$this->cMultiPriceType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->mapLogoUrl = $bs->popObject('stl_map<stl_string,stl_string>'); // 反序列化图片Url map size->url 如：http://img0.wgimg.com/qqbuy/855006089/item-00000000000000000000003E86B55530.0.jpg/320?50E2EA7E  类型为std::map<std::string,std::string> 
			$this->cLogoUrl_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwFlag = $bs->popUint32_t(); // 反序列化商品flag 例如：延保、赠品、组件等 类型为uint32_t
			$this->cFlag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->nStatus = $bs->popInt32_t(); // 反序列化商品状态 参见enum SkuState状态 0-在售 1-售完 2-下架 3-强制下架 4-删除 5-强制删除  类型为int
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


//source idl: com.icson.dashou.idl.CheckTogetherSellReq.java

if (!class_exists('CheckTogetherSellParamBo' , false)) {
class CheckTogetherSellParamBo
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
		 *  验证入参数据
		 *
		 * 版本 >= 0
		 */
		var $vecTogetherSellCheckVec; //std::vector<icson::dashou::bo::CTogetherSellCheckBo> 

		/**
		 * 版本 >= 0
		 */
		var $cTogetherSellCheckVec_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->vecTogetherSellCheckVec = new stl_vector('TogetherSellCheckBo'); // std::vector<icson::dashou::bo::CTogetherSellCheckBo> 
			 $this->cTogetherSellCheckVec_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecTogetherSellCheckVec,'stl_vector'); // 序列化 验证入参数据 类型为std::vector<icson::dashou::bo::CTogetherSellCheckBo> 
			$bs->pushUint8_t($this->cTogetherSellCheckVec_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecTogetherSellCheckVec = $bs->popObject('stl_vector<TogetherSellCheckBo>'); // 反序列化 验证入参数据 类型为std::vector<icson::dashou::bo::CTogetherSellCheckBo> 
			$this->cTogetherSellCheckVec_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.dashou.idl.CheckTogetherSellParamBo.java

if (!class_exists('TogetherSellCheckBo' , false)) {
class TogetherSellCheckBo
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
		 * 类型  0为商品 1 为套餐
		 *
		 * 版本 >= 0
		 */
		var $dwType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cType_u; //uint8_t

		/**
		 * 主商品id
		 *
		 * 版本 >= 0
		 */
		var $dwMainProductId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cMainProductId_u; //uint8_t

		/**
		 * 主商品skuid ，备用 
		 *
		 * 版本 >= 0
		 */
		var $ddwMainSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cMainSkuId_u; //uint8_t

		/**
		 * 主商品购买数量
		 *
		 * 版本 >= 0
		 */
		var $dwMainBuyNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cMainBuyNum_u; //uint8_t

		/**
		 * 需验证规则
		 *
		 * 版本 >= 0
		 */
		var $vecRulesChecked; //std::vector<icson::dashou::bo::CTogetherSellCheckRuleBo> 

		/**
		 * 版本 >= 0
		 */
		var $cRulesChecked_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwType = 0; // uint32_t
			 $this->cType_u = 0; // uint8_t
			 $this->dwMainProductId = 0; // uint32_t
			 $this->cMainProductId_u = 0; // uint8_t
			 $this->ddwMainSkuId = 0; // uint64_t
			 $this->cMainSkuId_u = 0; // uint8_t
			 $this->dwMainBuyNum = 0; // uint32_t
			 $this->cMainBuyNum_u = 0; // uint8_t
			 $this->vecRulesChecked = new stl_vector('TogetherSellCheckRuleBo'); // std::vector<icson::dashou::bo::CTogetherSellCheckRuleBo> 
			 $this->cRulesChecked_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwType); // 序列化类型  0为商品 1 为套餐 类型为uint32_t
			$bs->pushUint8_t($this->cType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwMainProductId); // 序列化主商品id 类型为uint32_t
			$bs->pushUint8_t($this->cMainProductId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwMainSkuId); // 序列化主商品skuid ，备用  类型为uint64_t
			$bs->pushUint8_t($this->cMainSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwMainBuyNum); // 序列化主商品购买数量 类型为uint32_t
			$bs->pushUint8_t($this->cMainBuyNum_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecRulesChecked,'stl_vector'); // 序列化需验证规则 类型为std::vector<icson::dashou::bo::CTogetherSellCheckRuleBo> 
			$bs->pushUint8_t($this->cRulesChecked_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwType = $bs->popUint32_t(); // 反序列化类型  0为商品 1 为套餐 类型为uint32_t
			$this->cType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwMainProductId = $bs->popUint32_t(); // 反序列化主商品id 类型为uint32_t
			$this->cMainProductId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwMainSkuId = $bs->popUint64_t(); // 反序列化主商品skuid ，备用  类型为uint64_t
			$this->cMainSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwMainBuyNum = $bs->popUint32_t(); // 反序列化主商品购买数量 类型为uint32_t
			$this->cMainBuyNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecRulesChecked = $bs->popObject('stl_vector<TogetherSellCheckRuleBo>'); // 反序列化需验证规则 类型为std::vector<icson::dashou::bo::CTogetherSellCheckRuleBo> 
			$this->cRulesChecked_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.dashou.idl.TogetherSellCheckBo.java

if (!class_exists('TogetherSellCheckRuleBo' , false)) {
class TogetherSellCheckRuleBo
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
		 * 关系类型， 2-延保 3-随心配
		 *
		 * 版本 >= 0
		 */
		var $dwRuleType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cRuleType_u; //uint8_t

		/**
		 * 关系ID ，这里的关系id购物车必须要存储用于验证，否则不是从随心配渠道进来的也会享受优惠，导致数据不一致
		 *
		 * 版本 >= 0
		 */
		var $strRuleId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cRuleId_u; //uint8_t

		/**
		 * 配商品id
		 *
		 * 版本 >= 0
		 */
		var $dwSubProductId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSubProductId_u; //uint8_t

		/**
		 * 配商品skuid ，备用 
		 *
		 * 版本 >= 0
		 */
		var $ddwSubSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSubSkuId_u; //uint8_t

		/**
		 * 配品单件优惠额
		 *
		 * 版本 >= 0
		 */
		var $dwDiscount; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cDiscount_u; //uint8_t

		/**
		 * 配品单件批价价格
		 *
		 * 版本 >= 0
		 */
		var $dwPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPrice_u; //uint8_t

		/**
		 * 配品单件分担的成本
		 *
		 * 版本 >= 0
		 */
		var $dwSubApportion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSubApportion_u; //uint8_t

		/**
		 * 主品单件分担的成本
		 *
		 * 版本 >= 0
		 */
		var $dwMainApportion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cMaiApportion_u; //uint8_t

		/**
		 * 购买实际数量/匹配数量/不匹配数量
		 *
		 * 版本 >= 0
		 */
		var $dwBuyNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyNum_u; //uint8_t

		/**
		 * 失效原因
		 *
		 * 版本 >= 0
		 */
		var $dwInvalidReason; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cInvalidReason_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwRuleType = 0; // uint32_t
			 $this->cRuleType_u = 0; // uint8_t
			 $this->strRuleId = ""; // std::string
			 $this->cRuleId_u = 0; // uint8_t
			 $this->dwSubProductId = 0; // uint32_t
			 $this->cSubProductId_u = 0; // uint8_t
			 $this->ddwSubSkuId = 0; // uint64_t
			 $this->cSubSkuId_u = 0; // uint8_t
			 $this->dwDiscount = 0; // uint32_t
			 $this->cDiscount_u = 0; // uint8_t
			 $this->dwPrice = 0; // uint32_t
			 $this->cPrice_u = 0; // uint8_t
			 $this->dwSubApportion = 0; // uint32_t
			 $this->cSubApportion_u = 0; // uint8_t
			 $this->dwMainApportion = 0; // uint32_t
			 $this->cMaiApportion_u = 0; // uint8_t
			 $this->dwBuyNum = 0; // uint32_t
			 $this->cBuyNum_u = 0; // uint8_t
			 $this->dwInvalidReason = 0; // uint32_t
			 $this->cInvalidReason_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwRuleType); // 序列化关系类型， 2-延保 3-随心配 类型为uint32_t
			$bs->pushUint8_t($this->cRuleType_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strRuleId); // 序列化关系ID ，这里的关系id购物车必须要存储用于验证，否则不是从随心配渠道进来的也会享受优惠，导致数据不一致 类型为std::string
			$bs->pushUint8_t($this->cRuleId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSubProductId); // 序列化配商品id 类型为uint32_t
			$bs->pushUint8_t($this->cSubProductId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSubSkuId); // 序列化配商品skuid ，备用  类型为uint64_t
			$bs->pushUint8_t($this->cSubSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwDiscount); // 序列化配品单件优惠额 类型为uint32_t
			$bs->pushUint8_t($this->cDiscount_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPrice); // 序列化配品单件批价价格 类型为uint32_t
			$bs->pushUint8_t($this->cPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSubApportion); // 序列化配品单件分担的成本 类型为uint32_t
			$bs->pushUint8_t($this->cSubApportion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwMainApportion); // 序列化主品单件分担的成本 类型为uint32_t
			$bs->pushUint8_t($this->cMaiApportion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwBuyNum); // 序列化购买实际数量/匹配数量/不匹配数量 类型为uint32_t
			$bs->pushUint8_t($this->cBuyNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwInvalidReason); // 序列化失效原因 类型为uint32_t
			$bs->pushUint8_t($this->cInvalidReason_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRuleType = $bs->popUint32_t(); // 反序列化关系类型， 2-延保 3-随心配 类型为uint32_t
			$this->cRuleType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strRuleId = $bs->popString(); // 反序列化关系ID ，这里的关系id购物车必须要存储用于验证，否则不是从随心配渠道进来的也会享受优惠，导致数据不一致 类型为std::string
			$this->cRuleId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSubProductId = $bs->popUint32_t(); // 反序列化配商品id 类型为uint32_t
			$this->cSubProductId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSubSkuId = $bs->popUint64_t(); // 反序列化配商品skuid ，备用  类型为uint64_t
			$this->cSubSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwDiscount = $bs->popUint32_t(); // 反序列化配品单件优惠额 类型为uint32_t
			$this->cDiscount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPrice = $bs->popUint32_t(); // 反序列化配品单件批价价格 类型为uint32_t
			$this->cPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSubApportion = $bs->popUint32_t(); // 反序列化配品单件分担的成本 类型为uint32_t
			$this->cSubApportion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwMainApportion = $bs->popUint32_t(); // 反序列化主品单件分担的成本 类型为uint32_t
			$this->cMaiApportion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwBuyNum = $bs->popUint32_t(); // 反序列化购买实际数量/匹配数量/不匹配数量 类型为uint32_t
			$this->cBuyNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwInvalidReason = $bs->popUint32_t(); // 反序列化失效原因 类型为uint32_t
			$this->cInvalidReason_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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