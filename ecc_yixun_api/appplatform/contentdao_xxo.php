<?php

//source idl: com.icson.smart_tf.idl.ContentDao.java

if (!class_exists('UserParam')) {
class UserParam
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
		 * 是否使用BI, 0: 不使用BI, 1: 使用BI
		 *
		 * 版本 >= 0
		 */
		var $dwUseBi; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cUseBi_u; //uint8_t

		/**
		 * 地域ID
		 *
		 * 版本 >= 0
		 */
		var $dwRegionId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cRegionId_u; //uint8_t

		/**
		 * UIN
		 *
		 * 版本 >= 0
		 */
		var $ddwUin; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cUin_u; //uint8_t

		/**
		 * 识别码
		 *
		 * 版本 >= 0
		 */
		var $ddwVisitKey; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cVisitKey_u; //uint8_t

		/**
		 * 客户端IP
		 *
		 * 版本 >= 0
		 */
		var $dwClientIp; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cClientIp_u; //uint8_t

		/**
		 * 请求时间
		 *
		 * 版本 >= 0
		 */
		var $dwRequestTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cRequestTime_u; //uint8_t

		/**
		 * 来源URL
		 *
		 * 版本 >= 0
		 */
		var $strFromUrl; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cFromUrl_u; //uint8_t

		/**
		 * 分站ID
		 *
		 * 版本 >= 0
		 */
		var $dwSiteId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSiteId_u; //uint8_t

		/**
		 * 省市ID
		 *
		 * 版本 >= 0
		 */
		var $strAreaId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cAreaId_u; //uint8_t

		/**
		 * 策略参数
		 *
		 * 版本 >= 0
		 */
		var $strStrategyKey; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cStrategyKey_u; //uint8_t

		/**
		 * 投放位置ID
		 *
		 * 版本 >= 0
		 */
		var $strPositionId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPositionId_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwUseBi = 0; // uint32_t
			 $this->cUseBi_u = 0; // uint8_t
			 $this->dwRegionId = 0; // uint32_t
			 $this->cRegionId_u = 0; // uint8_t
			 $this->ddwUin = 0; // uint64_t
			 $this->cUin_u = 0; // uint8_t
			 $this->ddwVisitKey = 0; // uint64_t
			 $this->cVisitKey_u = 0; // uint8_t
			 $this->dwClientIp = 0; // uint32_t
			 $this->cClientIp_u = 0; // uint8_t
			 $this->dwRequestTime = 0; // uint32_t
			 $this->cRequestTime_u = 0; // uint8_t
			 $this->strFromUrl = ""; // std::string
			 $this->cFromUrl_u = 0; // uint8_t
			 $this->dwSiteId = 0; // uint32_t
			 $this->cSiteId_u = 0; // uint8_t
			 $this->strAreaId = ""; // std::string
			 $this->cAreaId_u = 0; // uint8_t
			 $this->strStrategyKey = ""; // std::string
			 $this->cStrategyKey_u = 0; // uint8_t
			 $this->strPositionId = ""; // std::string
			 $this->cPositionId_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwUseBi); // 序列化是否使用BI, 0: 不使用BI, 1: 使用BI 类型为uint32_t
			$bs->pushUint8_t($this->cUseBi_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwRegionId); // 序列化地域ID 类型为uint32_t
			$bs->pushUint8_t($this->cRegionId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwUin); // 序列化UIN 类型为uint64_t
			$bs->pushUint8_t($this->cUin_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwVisitKey); // 序列化识别码 类型为uint64_t
			$bs->pushUint8_t($this->cVisitKey_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwClientIp); // 序列化客户端IP 类型为uint32_t
			$bs->pushUint8_t($this->cClientIp_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwRequestTime); // 序列化请求时间 类型为uint32_t
			$bs->pushUint8_t($this->cRequestTime_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strFromUrl); // 序列化来源URL 类型为std::string
			$bs->pushUint8_t($this->cFromUrl_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSiteId); // 序列化分站ID 类型为uint32_t
			$bs->pushUint8_t($this->cSiteId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strAreaId); // 序列化省市ID 类型为std::string
			$bs->pushUint8_t($this->cAreaId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strStrategyKey); // 序列化策略参数 类型为std::string
			$bs->pushUint8_t($this->cStrategyKey_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPositionId); // 序列化投放位置ID 类型为std::string
			$bs->pushUint8_t($this->cPositionId_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwUseBi = $bs->popUint32_t(); // 反序列化是否使用BI, 0: 不使用BI, 1: 使用BI 类型为uint32_t
			$this->cUseBi_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRegionId = $bs->popUint32_t(); // 反序列化地域ID 类型为uint32_t
			$this->cRegionId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwUin = $bs->popUint64_t(); // 反序列化UIN 类型为uint64_t
			$this->cUin_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwVisitKey = $bs->popUint64_t(); // 反序列化识别码 类型为uint64_t
			$this->cVisitKey_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwClientIp = $bs->popUint32_t(); // 反序列化客户端IP 类型为uint32_t
			$this->cClientIp_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRequestTime = $bs->popUint32_t(); // 反序列化请求时间 类型为uint32_t
			$this->cRequestTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strFromUrl = $bs->popString(); // 反序列化来源URL 类型为std::string
			$this->cFromUrl_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSiteId = $bs->popUint32_t(); // 反序列化分站ID 类型为uint32_t
			$this->cSiteId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strAreaId = $bs->popString(); // 反序列化省市ID 类型为std::string
			$this->cAreaId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strStrategyKey = $bs->popString(); // 反序列化策略参数 类型为std::string
			$this->cStrategyKey_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPositionId = $bs->popString(); // 反序列化投放位置ID 类型为std::string
			$this->cPositionId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.smart_tf.idl.ContentDao.java

if (!class_exists('ProductParam')) {
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
		 * 商品ID列表
		 *
		 * 版本 >= 0
		 */
		var $vecProductIdList; //std::vector<std::string> 

		/**
		 * 版本 >= 0
		 */
		var $cProductIdList_u; //uint8_t

		/**
		 * 分站ID
		 *
		 * 版本 >= 0
		 */
		var $dwSiteId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSiteId_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->vecProductIdList = new stl_vector('stl_string'); // std::vector<std::string> 
			 $this->cProductIdList_u = 0; // uint8_t
			 $this->dwSiteId = 0; // uint32_t
			 $this->cSiteId_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecProductIdList,'stl_vector'); // 序列化商品ID列表 类型为std::vector<std::string> 
			$bs->pushUint8_t($this->cProductIdList_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSiteId); // 序列化分站ID 类型为uint32_t
			$bs->pushUint8_t($this->cSiteId_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecProductIdList = $bs->popObject('stl_vector<stl_string>'); // 反序列化商品ID列表 类型为std::vector<std::string> 
			$this->cProductIdList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSiteId = $bs->popUint32_t(); // 反序列化分站ID 类型为uint32_t
			$this->cSiteId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.smart_tf.idl.ContentDao.java

if (!class_exists('PoolInfo')) {
class PoolInfo
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
		 * 商品池id
		 *
		 * 版本 >= 0
		 */
		var $dwPoolId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPoolId_u; //uint8_t

		/**
		 * 商品池名字
		 *
		 * 版本 >= 0
		 */
		var $strPoolName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPoolName_u; //uint8_t

		/**
		 * 商品池类型
		 *
		 * 版本 >= 0
		 */
		var $dwPoolType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPoolType_u; //uint8_t

		/**
		 * 排序字段
		 *
		 * 版本 >= 0
		 */
		var $strOrderField; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cOrderField_u; //uint8_t

		/**
		 * orderDir
		 *
		 * 版本 >= 0
		 */
		var $dwOrderDir; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cOrderDir_u; //uint8_t

		/**
		 * relatedUser
		 *
		 * 版本 >= 0
		 */
		var $strRelatedUser; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cRelatedUser_u; //uint8_t

		/**
		 * description
		 *
		 * 版本 >= 0
		 */
		var $strDescription; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cDescription_u; //uint8_t

		/**
		 * updateInterval
		 *
		 * 版本 >= 0
		 */
		var $dwUpdateInterval; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cUpdateInterval_u; //uint8_t

		/**
		 * poolEngName
		 *
		 * 版本 >= 0
		 */
		var $strPoolEngName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPoolEngName_u; //uint8_t

		/**
		 * 商品url
		 *
		 * 版本 >= 0
		 */
		var $strUrl; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cUrl_u; //uint8_t

		/**
		 * lastPriceUpdate
		 *
		 * 版本 >= 0
		 */
		var $dwLastPriceUpdate; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cLastPriceUpdate_u; //uint8_t

		/**
		 * customDataList
		 *
		 * 版本 >= 0
		 */
		var $strCustomDataList; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cCustomDataList_u; //uint8_t

		/**
		 * folderId
		 *
		 * 版本 >= 0
		 */
		var $dwFolderId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cFolderId_u; //uint8_t

		/**
		 * builtIn
		 *
		 * 版本 >= 0
		 */
		var $dwBuiltIn; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cBuiltIn_u; //uint8_t

		/**
		 * 商品池当前期
		 *
		 * 版本 >= 0
		 */
		var $dwCurrentTerm; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cCurrentTerm_u; //uint8_t

		/**
		 * 策略类型
		 *
		 * 版本 >= 0
		 */
		var $dwStrategy; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStrategy_u; //uint8_t

		/**
		 * 位标记
		 *
		 * 版本 >= 0
		 */
		var $dwBitProperty; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cBitProperty_u; //uint8_t

		/**
		 * 扩展字段
		 *
		 * 版本 >= 0
		 */
		var $strExtData; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cExtData_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwPoolId = 0; // uint32_t
			 $this->cPoolId_u = 0; // uint8_t
			 $this->strPoolName = ""; // std::string
			 $this->cPoolName_u = 0; // uint8_t
			 $this->dwPoolType = 0; // uint32_t
			 $this->cPoolType_u = 0; // uint8_t
			 $this->strOrderField = ""; // std::string
			 $this->cOrderField_u = 0; // uint8_t
			 $this->dwOrderDir = 0; // uint32_t
			 $this->cOrderDir_u = 0; // uint8_t
			 $this->strRelatedUser = ""; // std::string
			 $this->cRelatedUser_u = 0; // uint8_t
			 $this->strDescription = ""; // std::string
			 $this->cDescription_u = 0; // uint8_t
			 $this->dwUpdateInterval = 0; // uint32_t
			 $this->cUpdateInterval_u = 0; // uint8_t
			 $this->strPoolEngName = ""; // std::string
			 $this->cPoolEngName_u = 0; // uint8_t
			 $this->strUrl = ""; // std::string
			 $this->cUrl_u = 0; // uint8_t
			 $this->dwLastPriceUpdate = 0; // uint32_t
			 $this->cLastPriceUpdate_u = 0; // uint8_t
			 $this->strCustomDataList = ""; // std::string
			 $this->cCustomDataList_u = 0; // uint8_t
			 $this->dwFolderId = 0; // uint32_t
			 $this->cFolderId_u = 0; // uint8_t
			 $this->dwBuiltIn = 0; // uint32_t
			 $this->cBuiltIn_u = 0; // uint8_t
			 $this->dwCurrentTerm = 0; // uint32_t
			 $this->cCurrentTerm_u = 0; // uint8_t
			 $this->dwStrategy = 0; // uint32_t
			 $this->cStrategy_u = 0; // uint8_t
			 $this->dwBitProperty = 0; // uint32_t
			 $this->cBitProperty_u = 0; // uint8_t
			 $this->strExtData = ""; // std::string
			 $this->cExtData_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPoolId); // 序列化商品池id 类型为uint32_t
			$bs->pushUint8_t($this->cPoolId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPoolName); // 序列化商品池名字 类型为std::string
			$bs->pushUint8_t($this->cPoolName_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPoolType); // 序列化商品池类型 类型为uint32_t
			$bs->pushUint8_t($this->cPoolType_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strOrderField); // 序列化排序字段 类型为std::string
			$bs->pushUint8_t($this->cOrderField_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwOrderDir); // 序列化orderDir 类型为uint32_t
			$bs->pushUint8_t($this->cOrderDir_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strRelatedUser); // 序列化relatedUser 类型为std::string
			$bs->pushUint8_t($this->cRelatedUser_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strDescription); // 序列化description 类型为std::string
			$bs->pushUint8_t($this->cDescription_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwUpdateInterval); // 序列化updateInterval 类型为uint32_t
			$bs->pushUint8_t($this->cUpdateInterval_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPoolEngName); // 序列化poolEngName 类型为std::string
			$bs->pushUint8_t($this->cPoolEngName_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strUrl); // 序列化商品url 类型为std::string
			$bs->pushUint8_t($this->cUrl_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwLastPriceUpdate); // 序列化lastPriceUpdate 类型为uint32_t
			$bs->pushUint8_t($this->cLastPriceUpdate_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strCustomDataList); // 序列化customDataList 类型为std::string
			$bs->pushUint8_t($this->cCustomDataList_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwFolderId); // 序列化folderId 类型为uint32_t
			$bs->pushUint8_t($this->cFolderId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwBuiltIn); // 序列化builtIn 类型为uint32_t
			$bs->pushUint8_t($this->cBuiltIn_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwCurrentTerm); // 序列化商品池当前期 类型为uint32_t
			$bs->pushUint8_t($this->cCurrentTerm_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStrategy); // 序列化策略类型 类型为uint32_t
			$bs->pushUint8_t($this->cStrategy_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwBitProperty); // 序列化位标记 类型为uint32_t
			$bs->pushUint8_t($this->cBitProperty_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strExtData); // 序列化扩展字段 类型为std::string
			$bs->pushUint8_t($this->cExtData_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPoolId = $bs->popUint32_t(); // 反序列化商品池id 类型为uint32_t
			$this->cPoolId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPoolName = $bs->popString(); // 反序列化商品池名字 类型为std::string
			$this->cPoolName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPoolType = $bs->popUint32_t(); // 反序列化商品池类型 类型为uint32_t
			$this->cPoolType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strOrderField = $bs->popString(); // 反序列化排序字段 类型为std::string
			$this->cOrderField_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwOrderDir = $bs->popUint32_t(); // 反序列化orderDir 类型为uint32_t
			$this->cOrderDir_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strRelatedUser = $bs->popString(); // 反序列化relatedUser 类型为std::string
			$this->cRelatedUser_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strDescription = $bs->popString(); // 反序列化description 类型为std::string
			$this->cDescription_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwUpdateInterval = $bs->popUint32_t(); // 反序列化updateInterval 类型为uint32_t
			$this->cUpdateInterval_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPoolEngName = $bs->popString(); // 反序列化poolEngName 类型为std::string
			$this->cPoolEngName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strUrl = $bs->popString(); // 反序列化商品url 类型为std::string
			$this->cUrl_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwLastPriceUpdate = $bs->popUint32_t(); // 反序列化lastPriceUpdate 类型为uint32_t
			$this->cLastPriceUpdate_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strCustomDataList = $bs->popString(); // 反序列化customDataList 类型为std::string
			$this->cCustomDataList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwFolderId = $bs->popUint32_t(); // 反序列化folderId 类型为uint32_t
			$this->cFolderId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwBuiltIn = $bs->popUint32_t(); // 反序列化builtIn 类型为uint32_t
			$this->cBuiltIn_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwCurrentTerm = $bs->popUint32_t(); // 反序列化商品池当前期 类型为uint32_t
			$this->cCurrentTerm_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStrategy = $bs->popUint32_t(); // 反序列化策略类型 类型为uint32_t
			$this->cStrategy_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwBitProperty = $bs->popUint32_t(); // 反序列化位标记 类型为uint32_t
			$this->cBitProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strExtData = $bs->popString(); // 反序列化扩展字段 类型为std::string
			$this->cExtData_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.smart_tf.idl.GetProductResp.java

if (!class_exists('Content')) {
class Content
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
		 * 内容id
		 *
		 * 版本 >= 0
		 */
		var $dwId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cId_u; //uint8_t

		/**
		 * 商品id
		 *
		 * 版本 >= 0
		 */
		var $strCommodityId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cCommodityId_u; //uint8_t

		/**
		 * 商品标题
		 *
		 * 版本 >= 0
		 */
		var $strTitle; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cTitle_u; //uint8_t

		/**
		 * 商品默认图url
		 *
		 * 版本 >= 0
		 */
		var $strPicUrl; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPicUrl_u; //uint8_t

		/**
		 * 商品80像素图url
		 *
		 * 版本 >= 0
		 */
		var $strPicUrl80; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPicUrl80_u; //uint8_t

		/**
		 * 已售数量
		 *
		 * 版本 >= 0
		 */
		var $dwSoldNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSoldNum_u; //uint8_t

		/**
		 * 所属频道
		 *
		 * 版本 >= 0
		 */
		var $strChannel; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cChannel_u; //uint8_t

		/**
		 * 搜索类目id
		 *
		 * 版本 >= 0
		 */
		var $strClassId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cClassId_u; //uint8_t

		/**
		 * 搜索类目名
		 *
		 * 版本 >= 0
		 */
		var $strCategoryName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cCategoryName_u; //uint8_t

		/**
		 * 上市日期
		 *
		 * 版本 >= 0
		 */
		var $dwOnMarketDate; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cOnMarketDate_u; //uint8_t

		/**
		 * 类型(isFrenzy)
		 *
		 * 版本 >= 0
		 */
		var $dwType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cType_u; //uint8_t

		/**
		 * 网购价格
		 *
		 * 版本 >= 0
		 */
		var $dwPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPrice_u; //uint8_t

		/**
		 * 排序序号，越小越排前
		 *
		 * 版本 >= 0
		 */
		var $dwSortNumber; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSortNumber_u; //uint8_t

		/**
		 * 是否是spu下的主显示商品
		 *
		 * 版本 >= 0
		 */
		var $dwDefaultDisplay; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cDefaultDisplay_u; //uint8_t

		/**
		 * 同spu下的主商品id
		 *
		 * 版本 >= 0
		 */
		var $strPrimaryGoods; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPrimaryGoods_u; //uint8_t

		/**
		 * 商品url
		 *
		 * 版本 >= 0
		 */
		var $strUrl; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cUrl_u; //uint8_t

		/**
		 * 商品市场价格
		 *
		 * 版本 >= 0
		 */
		var $dwMarketPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cMarketPrice_u; //uint8_t

		/**
		 * 前端展示样式名
		 *
		 * 版本 >= 0
		 */
		var $strClassName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cClassName_u; //uint8_t

		/**
		 * 推广语
		 *
		 * 版本 >= 0
		 */
		var $strPromoteText; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPromoteText_u; //uint8_t

		/**
		 * 简短推广语
		 *
		 * 版本 >= 0
		 */
		var $strShortPromoteText; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cShortPromoteText_u; //uint8_t

		/**
		 * 库存数量
		 *
		 * 版本 >= 0
		 */
		var $dwInventory; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cInventory_u; //uint8_t

		/**
		 * 合作伙伴子账号
		 *
		 * 版本 >= 0
		 */
		var $strPartnerId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPartnerId_u; //uint8_t

		/**
		 * 网购侧skuid
		 *
		 * 版本 >= 0
		 */
		var $strSkuId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 网购侧spuid
		 *
		 * 版本 >= 0
		 */
		var $strSpuId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSpuId_u; //uint8_t

		/**
		 * 运营标签，商品打标属性，如热卖、新品
		 *
		 * 版本 >= 0
		 */
		var $strTag; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cTag_u; //uint8_t

		/**
		 * 抢购开始时间，unix时间戳
		 *
		 * 版本 >= 0
		 */
		var $dwStarttime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStarttime_u; //uint8_t

		/**
		 * 抢购结束时间，unix时间戳
		 *
		 * 版本 >= 0
		 */
		var $dwEndtime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cEndtime_u; //uint8_t

		/**
		 * 抢购批次id
		 *
		 * 版本 >= 0
		 */
		var $strGroupid; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cGroupid_u; //uint8_t

		/**
		 * 抢购标记位，是否防刷
		 *
		 * 版本 >= 0
		 */
		var $dwToken; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cToken_u; //uint8_t

		/**
		 * 自定义数据
		 *
		 * 版本 >= 0
		 */
		var $strCustomData; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cCustomData_u; //uint8_t

		/**
		 * 抢购商品状态，0正常，1下架
		 *
		 * 版本 >= 0
		 */
		var $dwState; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cState_u; //uint8_t

		/**
		 * 销售属性串
		 *
		 * 版本 >= 0
		 */
		var $strSaleAttr; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSaleAttr_u; //uint8_t

		/**
		 * 扩展数据，结构是json字符串
		 *
		 * 版本 >= 0
		 */
		var $strExtData; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cExtData_u; //uint8_t

		/**
		 * 商品优质得分
		 *
		 * 版本 >= 0
		 */
		var $dwScore; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cScore_u; //uint8_t

		/**
		 * 商品多价库存信息，结构是json字符串
		 *
		 * 版本 >= 1
		 */
		var $strAreaStockInfo; //std::string

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cAreaStockInfo_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwId = 0; // uint32_t
			 $this->cId_u = 0; // uint8_t
			 $this->strCommodityId = ""; // std::string
			 $this->cCommodityId_u = 0; // uint8_t
			 $this->strTitle = ""; // std::string
			 $this->cTitle_u = 0; // uint8_t
			 $this->strPicUrl = ""; // std::string
			 $this->cPicUrl_u = 0; // uint8_t
			 $this->strPicUrl80 = ""; // std::string
			 $this->cPicUrl80_u = 0; // uint8_t
			 $this->dwSoldNum = 0; // uint32_t
			 $this->cSoldNum_u = 0; // uint8_t
			 $this->strChannel = ""; // std::string
			 $this->cChannel_u = 0; // uint8_t
			 $this->strClassId = ""; // std::string
			 $this->cClassId_u = 0; // uint8_t
			 $this->strCategoryName = ""; // std::string
			 $this->cCategoryName_u = 0; // uint8_t
			 $this->dwOnMarketDate = 0; // uint32_t
			 $this->cOnMarketDate_u = 0; // uint8_t
			 $this->dwType = 0; // uint32_t
			 $this->cType_u = 0; // uint8_t
			 $this->dwPrice = 0; // uint32_t
			 $this->cPrice_u = 0; // uint8_t
			 $this->dwSortNumber = 0; // uint32_t
			 $this->cSortNumber_u = 0; // uint8_t
			 $this->dwDefaultDisplay = 0; // uint32_t
			 $this->cDefaultDisplay_u = 0; // uint8_t
			 $this->strPrimaryGoods = ""; // std::string
			 $this->cPrimaryGoods_u = 0; // uint8_t
			 $this->strUrl = ""; // std::string
			 $this->cUrl_u = 0; // uint8_t
			 $this->dwMarketPrice = 0; // uint32_t
			 $this->cMarketPrice_u = 0; // uint8_t
			 $this->strClassName = ""; // std::string
			 $this->cClassName_u = 0; // uint8_t
			 $this->strPromoteText = ""; // std::string
			 $this->cPromoteText_u = 0; // uint8_t
			 $this->strShortPromoteText = ""; // std::string
			 $this->cShortPromoteText_u = 0; // uint8_t
			 $this->dwInventory = 0; // uint32_t
			 $this->cInventory_u = 0; // uint8_t
			 $this->strPartnerId = ""; // std::string
			 $this->cPartnerId_u = 0; // uint8_t
			 $this->strSkuId = ""; // std::string
			 $this->cSkuId_u = 0; // uint8_t
			 $this->strSpuId = ""; // std::string
			 $this->cSpuId_u = 0; // uint8_t
			 $this->strTag = ""; // std::string
			 $this->cTag_u = 0; // uint8_t
			 $this->dwStarttime = 0; // uint32_t
			 $this->cStarttime_u = 0; // uint8_t
			 $this->dwEndtime = 0; // uint32_t
			 $this->cEndtime_u = 0; // uint8_t
			 $this->strGroupid = ""; // std::string
			 $this->cGroupid_u = 0; // uint8_t
			 $this->dwToken = 0; // uint32_t
			 $this->cToken_u = 0; // uint8_t
			 $this->strCustomData = ""; // std::string
			 $this->cCustomData_u = 0; // uint8_t
			 $this->dwState = 0; // uint32_t
			 $this->cState_u = 0; // uint8_t
			 $this->strSaleAttr = ""; // std::string
			 $this->cSaleAttr_u = 0; // uint8_t
			 $this->strExtData = ""; // std::string
			 $this->cExtData_u = 0; // uint8_t
			 $this->dwScore = 0; // uint32_t
			 $this->cScore_u = 0; // uint8_t
			 $this->strAreaStockInfo = ""; // std::string
			 $this->cAreaStockInfo_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwId); // 序列化内容id 类型为uint32_t
			$bs->pushUint8_t($this->cId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strCommodityId); // 序列化商品id 类型为std::string
			$bs->pushUint8_t($this->cCommodityId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strTitle); // 序列化商品标题 类型为std::string
			$bs->pushUint8_t($this->cTitle_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPicUrl); // 序列化商品默认图url 类型为std::string
			$bs->pushUint8_t($this->cPicUrl_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPicUrl80); // 序列化商品80像素图url 类型为std::string
			$bs->pushUint8_t($this->cPicUrl80_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSoldNum); // 序列化已售数量 类型为uint32_t
			$bs->pushUint8_t($this->cSoldNum_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strChannel); // 序列化所属频道 类型为std::string
			$bs->pushUint8_t($this->cChannel_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strClassId); // 序列化搜索类目id 类型为std::string
			$bs->pushUint8_t($this->cClassId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strCategoryName); // 序列化搜索类目名 类型为std::string
			$bs->pushUint8_t($this->cCategoryName_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwOnMarketDate); // 序列化上市日期 类型为uint32_t
			$bs->pushUint8_t($this->cOnMarketDate_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwType); // 序列化类型(isFrenzy) 类型为uint32_t
			$bs->pushUint8_t($this->cType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPrice); // 序列化网购价格 类型为uint32_t
			$bs->pushUint8_t($this->cPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSortNumber); // 序列化排序序号，越小越排前 类型为uint32_t
			$bs->pushUint8_t($this->cSortNumber_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwDefaultDisplay); // 序列化是否是spu下的主显示商品 类型为uint32_t
			$bs->pushUint8_t($this->cDefaultDisplay_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPrimaryGoods); // 序列化同spu下的主商品id 类型为std::string
			$bs->pushUint8_t($this->cPrimaryGoods_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strUrl); // 序列化商品url 类型为std::string
			$bs->pushUint8_t($this->cUrl_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwMarketPrice); // 序列化商品市场价格 类型为uint32_t
			$bs->pushUint8_t($this->cMarketPrice_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strClassName); // 序列化前端展示样式名 类型为std::string
			$bs->pushUint8_t($this->cClassName_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPromoteText); // 序列化推广语 类型为std::string
			$bs->pushUint8_t($this->cPromoteText_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strShortPromoteText); // 序列化简短推广语 类型为std::string
			$bs->pushUint8_t($this->cShortPromoteText_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwInventory); // 序列化库存数量 类型为uint32_t
			$bs->pushUint8_t($this->cInventory_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPartnerId); // 序列化合作伙伴子账号 类型为std::string
			$bs->pushUint8_t($this->cPartnerId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSkuId); // 序列化网购侧skuid 类型为std::string
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSpuId); // 序列化网购侧spuid 类型为std::string
			$bs->pushUint8_t($this->cSpuId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strTag); // 序列化运营标签，商品打标属性，如热卖、新品 类型为std::string
			$bs->pushUint8_t($this->cTag_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStarttime); // 序列化抢购开始时间，unix时间戳 类型为uint32_t
			$bs->pushUint8_t($this->cStarttime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwEndtime); // 序列化抢购结束时间，unix时间戳 类型为uint32_t
			$bs->pushUint8_t($this->cEndtime_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strGroupid); // 序列化抢购批次id 类型为std::string
			$bs->pushUint8_t($this->cGroupid_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwToken); // 序列化抢购标记位，是否防刷 类型为uint32_t
			$bs->pushUint8_t($this->cToken_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strCustomData); // 序列化自定义数据 类型为std::string
			$bs->pushUint8_t($this->cCustomData_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwState); // 序列化抢购商品状态，0正常，1下架 类型为uint32_t
			$bs->pushUint8_t($this->cState_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSaleAttr); // 序列化销售属性串 类型为std::string
			$bs->pushUint8_t($this->cSaleAttr_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strExtData); // 序列化扩展数据，结构是json字符串 类型为std::string
			$bs->pushUint8_t($this->cExtData_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwScore); // 序列化商品优质得分 类型为uint32_t
			$bs->pushUint8_t($this->cScore_u); // 序列化 类型为uint8_t
			if(  $this->dwVersion >= 1 ){
				$bs->pushString($this->strAreaStockInfo); // 序列化商品多价库存信息，结构是json字符串 类型为std::string
			}
			if(  $this->dwVersion >= 1 ){
				$bs->pushUint8_t($this->cAreaStockInfo_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwId = $bs->popUint32_t(); // 反序列化内容id 类型为uint32_t
			$this->cId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strCommodityId = $bs->popString(); // 反序列化商品id 类型为std::string
			$this->cCommodityId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strTitle = $bs->popString(); // 反序列化商品标题 类型为std::string
			$this->cTitle_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPicUrl = $bs->popString(); // 反序列化商品默认图url 类型为std::string
			$this->cPicUrl_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPicUrl80 = $bs->popString(); // 反序列化商品80像素图url 类型为std::string
			$this->cPicUrl80_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSoldNum = $bs->popUint32_t(); // 反序列化已售数量 类型为uint32_t
			$this->cSoldNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strChannel = $bs->popString(); // 反序列化所属频道 类型为std::string
			$this->cChannel_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strClassId = $bs->popString(); // 反序列化搜索类目id 类型为std::string
			$this->cClassId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strCategoryName = $bs->popString(); // 反序列化搜索类目名 类型为std::string
			$this->cCategoryName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwOnMarketDate = $bs->popUint32_t(); // 反序列化上市日期 类型为uint32_t
			$this->cOnMarketDate_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwType = $bs->popUint32_t(); // 反序列化类型(isFrenzy) 类型为uint32_t
			$this->cType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPrice = $bs->popUint32_t(); // 反序列化网购价格 类型为uint32_t
			$this->cPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSortNumber = $bs->popUint32_t(); // 反序列化排序序号，越小越排前 类型为uint32_t
			$this->cSortNumber_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwDefaultDisplay = $bs->popUint32_t(); // 反序列化是否是spu下的主显示商品 类型为uint32_t
			$this->cDefaultDisplay_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPrimaryGoods = $bs->popString(); // 反序列化同spu下的主商品id 类型为std::string
			$this->cPrimaryGoods_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strUrl = $bs->popString(); // 反序列化商品url 类型为std::string
			$this->cUrl_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwMarketPrice = $bs->popUint32_t(); // 反序列化商品市场价格 类型为uint32_t
			$this->cMarketPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strClassName = $bs->popString(); // 反序列化前端展示样式名 类型为std::string
			$this->cClassName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPromoteText = $bs->popString(); // 反序列化推广语 类型为std::string
			$this->cPromoteText_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strShortPromoteText = $bs->popString(); // 反序列化简短推广语 类型为std::string
			$this->cShortPromoteText_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwInventory = $bs->popUint32_t(); // 反序列化库存数量 类型为uint32_t
			$this->cInventory_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPartnerId = $bs->popString(); // 反序列化合作伙伴子账号 类型为std::string
			$this->cPartnerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSkuId = $bs->popString(); // 反序列化网购侧skuid 类型为std::string
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSpuId = $bs->popString(); // 反序列化网购侧spuid 类型为std::string
			$this->cSpuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strTag = $bs->popString(); // 反序列化运营标签，商品打标属性，如热卖、新品 类型为std::string
			$this->cTag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStarttime = $bs->popUint32_t(); // 反序列化抢购开始时间，unix时间戳 类型为uint32_t
			$this->cStarttime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwEndtime = $bs->popUint32_t(); // 反序列化抢购结束时间，unix时间戳 类型为uint32_t
			$this->cEndtime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strGroupid = $bs->popString(); // 反序列化抢购批次id 类型为std::string
			$this->cGroupid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwToken = $bs->popUint32_t(); // 反序列化抢购标记位，是否防刷 类型为uint32_t
			$this->cToken_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strCustomData = $bs->popString(); // 反序列化自定义数据 类型为std::string
			$this->cCustomData_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwState = $bs->popUint32_t(); // 反序列化抢购商品状态，0正常，1下架 类型为uint32_t
			$this->cState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSaleAttr = $bs->popString(); // 反序列化销售属性串 类型为std::string
			$this->cSaleAttr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strExtData = $bs->popString(); // 反序列化扩展数据，结构是json字符串 类型为std::string
			$this->cExtData_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwScore = $bs->popUint32_t(); // 反序列化商品优质得分 类型为uint32_t
			$this->cScore_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->dwVersion >= 1 ){
				$this->strAreaStockInfo = $bs->popString(); // 反序列化商品多价库存信息，结构是json字符串 类型为std::string
			}
			if(  $this->dwVersion >= 1 ){
				$this->cAreaStockInfo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.icson.smart_tf.idl.GetContentReq.java

if (!class_exists('ContentParam')) {
class ContentParam
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
		 * 内容池ID
		 *
		 * 版本 >= 0
		 */
		var $dwPoolId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPoolId_u; //uint8_t

		/**
		 * 内容池类型
		 *
		 * 版本 >= 0
		 */
		var $dwPoolType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPoolType_u; //uint8_t

		/**
		 * 期数
		 *
		 * 版本 >= 0
		 */
		var $dwTerm; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTerm_u; //uint8_t

		/**
		 * 起始记录序号
		 *
		 * 版本 >= 0
		 */
		var $dwStart; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStart_u; //uint8_t

		/**
		 * 内容数
		 *
		 * 版本 >= 0
		 */
		var $dwNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cNum_u; //uint8_t

		/**
		 * 填充位置Id
		 *
		 * 版本 >= 0
		 */
		var $strPosId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPosId_u; //uint8_t

		/**
		 * 期数偏移，例如-1表示上一期，1表示下一期
		 *
		 * 版本 >= 1
		 */
		var $nTermOffset; //int

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cTermOffset_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwPoolId = 0; // uint32_t
			 $this->cPoolId_u = 0; // uint8_t
			 $this->dwPoolType = 0; // uint32_t
			 $this->cPoolType_u = 0; // uint8_t
			 $this->dwTerm = 0; // uint32_t
			 $this->cTerm_u = 0; // uint8_t
			 $this->dwStart = 0; // uint32_t
			 $this->cStart_u = 0; // uint8_t
			 $this->dwNum = 0; // uint32_t
			 $this->cNum_u = 0; // uint8_t
			 $this->strPosId = ""; // std::string
			 $this->cPosId_u = 0; // uint8_t
			 $this->nTermOffset = 0; // int
			 $this->cTermOffset_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPoolId); // 序列化内容池ID 类型为uint32_t
			$bs->pushUint8_t($this->cPoolId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPoolType); // 序列化内容池类型 类型为uint32_t
			$bs->pushUint8_t($this->cPoolType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTerm); // 序列化期数 类型为uint32_t
			$bs->pushUint8_t($this->cTerm_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStart); // 序列化起始记录序号 类型为uint32_t
			$bs->pushUint8_t($this->cStart_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwNum); // 序列化内容数 类型为uint32_t
			$bs->pushUint8_t($this->cNum_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPosId); // 序列化填充位置Id 类型为std::string
			$bs->pushUint8_t($this->cPosId_u); // 序列化 类型为uint8_t
			if(  $this->dwVersion >= 1 ){
				$bs->pushInt32_t($this->nTermOffset); // 序列化期数偏移，例如-1表示上一期，1表示下一期 类型为int
			}
			if(  $this->dwVersion >= 1 ){
				$bs->pushUint8_t($this->cTermOffset_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPoolId = $bs->popUint32_t(); // 反序列化内容池ID 类型为uint32_t
			$this->cPoolId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPoolType = $bs->popUint32_t(); // 反序列化内容池类型 类型为uint32_t
			$this->cPoolType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTerm = $bs->popUint32_t(); // 反序列化期数 类型为uint32_t
			$this->cTerm_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStart = $bs->popUint32_t(); // 反序列化起始记录序号 类型为uint32_t
			$this->cStart_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwNum = $bs->popUint32_t(); // 反序列化内容数 类型为uint32_t
			$this->cNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPosId = $bs->popString(); // 反序列化填充位置Id 类型为std::string
			$this->cPosId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->dwVersion >= 1 ){
				$this->nTermOffset = $bs->popInt32_t(); // 反序列化期数偏移，例如-1表示上一期，1表示下一期 类型为int
			}
			if(  $this->dwVersion >= 1 ){
				$this->cTermOffset_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.icson.smart_tf.idl.ContentDao.java

if (!class_exists('ContentTemplate')) {
class ContentTemplate
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
		 * 内容ID
		 *
		 * 版本 >= 0
		 */
		var $ddwContentId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cContentId_u; //uint8_t

		/**
		 * 内容key, 如cid-1
		 *
		 * 版本 >= 0
		 */
		var $strContentKey; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cContentKey_u; //uint8_t

		/**
		 * 模版路径
		 *
		 * 版本 >= 0
		 */
		var $strTplPath; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cTplPath_u; //uint8_t

		/**
		 * js路径
		 *
		 * 版本 >= 0
		 */
		var $strJsPath; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cJsPath_u; //uint8_t

		/**
		 * 内容参数信息
		 *
		 * 版本 >= 0
		 */
		var $vecContentParam; //std::vector<b2b2c::cms::po::CContentParam> 

		/**
		 * 版本 >= 0
		 */
		var $cContentParam_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->ddwContentId = 0; // uint64_t
			 $this->cContentId_u = 0; // uint8_t
			 $this->strContentKey = ""; // std::string
			 $this->cContentKey_u = 0; // uint8_t
			 $this->strTplPath = ""; // std::string
			 $this->cTplPath_u = 0; // uint8_t
			 $this->strJsPath = ""; // std::string
			 $this->cJsPath_u = 0; // uint8_t
			 $this->vecContentParam = new stl_vector('ContentParam'); // std::vector<b2b2c::cms::po::CContentParam> 
			 $this->cContentParam_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwContentId); // 序列化内容ID 类型为uint64_t
			$bs->pushUint8_t($this->cContentId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strContentKey); // 序列化内容key, 如cid-1 类型为std::string
			$bs->pushUint8_t($this->cContentKey_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strTplPath); // 序列化模版路径 类型为std::string
			$bs->pushUint8_t($this->cTplPath_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strJsPath); // 序列化js路径 类型为std::string
			$bs->pushUint8_t($this->cJsPath_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecContentParam,'stl_vector'); // 序列化内容参数信息 类型为std::vector<b2b2c::cms::po::CContentParam> 
			$bs->pushUint8_t($this->cContentParam_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwContentId = $bs->popUint64_t(); // 反序列化内容ID 类型为uint64_t
			$this->cContentId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strContentKey = $bs->popString(); // 反序列化内容key, 如cid-1 类型为std::string
			$this->cContentKey_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strTplPath = $bs->popString(); // 反序列化模版路径 类型为std::string
			$this->cTplPath_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strJsPath = $bs->popString(); // 反序列化js路径 类型为std::string
			$this->cJsPath_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecContentParam = $bs->popObject('stl_vector<ContentParam>'); // 反序列化内容参数信息 类型为std::vector<b2b2c::cms::po::CContentParam> 
			$this->cContentParam_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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