<?php

//source idl: com.b2b2c.icsonrecvaddr.idl.GetIcsonRecvAddrResp.java

if (!class_exists('IcsonRecvAddrPoList', false)) {
class IcsonRecvAddrPoList
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 易迅收货地址Po列表
		 *
		 * 版本 >= 0
		 */
		var $vecIcsonRecvAddrPoList; //std::vector<b2b2c::icson_recvaddr::po::CIcsonRecvAddrPo> 

		/**
		 * 预留字段
		 *
		 * 版本 >= 0
		 */
		var $strReserved; //std::string

		/**
		 * 版本号_u
		 *
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 易迅收货地址Po列表_u
		 *
		 * 版本 >= 0
		 */
		var $cIcsonRecvAddrPoList_u; //uint8_t

		/**
		 * 预留字段_u
		 *
		 * 版本 >= 0
		 */
		var $cReserved_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->vecIcsonRecvAddrPoList = new stl_vector('IcsonRecvAddrPo'); // std::vector<b2b2c::icson_recvaddr::po::CIcsonRecvAddrPo> 
			 $this->strReserved = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cIcsonRecvAddrPoList_u = 0; // uint8_t
			 $this->cReserved_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号 类型为uint32_t
			$bs->pushObject($this->vecIcsonRecvAddrPoList,'stl_vector'); // 序列化易迅收货地址Po列表 类型为std::vector<b2b2c::icson_recvaddr::po::CIcsonRecvAddrPo> 
			$bs->pushString($this->strReserved); // 序列化预留字段 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化版本号_u 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonRecvAddrPoList_u); // 序列化易迅收货地址Po列表_u 类型为uint8_t
			$bs->pushUint8_t($this->cReserved_u); // 序列化预留字段_u 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号 类型为uint32_t
			$this->vecIcsonRecvAddrPoList = $bs->popObject('stl_vector<IcsonRecvAddrPo>'); // 反序列化易迅收货地址Po列表 类型为std::vector<b2b2c::icson_recvaddr::po::CIcsonRecvAddrPo> 
			$this->strReserved = $bs->popString(); // 反序列化预留字段 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化版本号_u 类型为uint8_t
			$this->cIcsonRecvAddrPoList_u = $bs->popUint8_t(); // 反序列化易迅收货地址Po列表_u 类型为uint8_t
			$this->cReserved_u = $bs->popUint8_t(); // 反序列化预留字段_u 类型为uint8_t

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


//source idl: com.b2b2c.icsonrecvaddr.idl.IcsonRecvAddressAo.java


final class AreaIdType
{
	const AREA_ID_GB = 1; // 国标区域ID
	const AREA_ID_ICSON = 2; // 易迅区域ID
	const AREA_ID_GB_EXTEND = 3; // 国标扩展ID
}


//source idl: com.b2b2c.icsonrecvaddr.idl.AddIcsonRecvAddrReq.java

if (!class_exists('IcsonRecvAddrPo', false)) {
class IcsonRecvAddrPo
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 易迅收货地址记录ID
		 *
		 * 版本 >= 0
		 */
		var $ddwIcsonAid; //uint64_t

		/**
		 * 易迅发票ID
		 *
		 * 版本 >= 0
		 */
		var $dwIid; //uint32_t

		/**
		 * 易迅用户ID
		 *
		 * 版本 >= 0
		 */
		var $ddwIcsonUid; //uint64_t

		/**
		 * 用户姓名
		 *
		 * 版本 >= 0
		 */
		var $strName; //std::string

		/**
		 * 用户手机号
		 *
		 * 版本 >= 0
		 */
		var $strMobile; //std::string

		/**
		 * 用户普通电话
		 *
		 * 版本 >= 0
		 */
		var $strPhone; //std::string

		/**
		 * 用户传真
		 *
		 * 版本 >= 0
		 */
		var $strFax; //std::string

		/**
		 * 邮编
		 *
		 * 版本 >= 0
		 */
		var $strZipCode; //std::string

		/**
		 * 区域ID映射表
		 *
		 * 版本 >= 0
		 */
		var $mapDistrictIdMap; //std::map<uint32_t,uint32_t> 

		/**
		 * 用户详细收货地址
		 *
		 * 版本 >= 0
		 */
		var $strAddress; //std::string

		/**
		 * 地址标注
		 *
		 * 版本 >= 0
		 */
		var $strWorkplace; //std::string

		/**
		 * 排序因子
		 *
		 * 版本 >= 0
		 */
		var $dwSortfactor; //uint32_t

		/**
		 * 记录更新时间
		 *
		 * 版本 >= 0
		 */
		var $dwUpdateTime; //uint32_t

		/**
		 * 记录创建时间
		 *
		 * 版本 >= 0
		 */
		var $dwCreateTime; //uint32_t

		/**
		 * 默认送货方式
		 *
		 * 版本 >= 0
		 */
		var $dwDefaultShipping; //uint32_t

		/**
		 * 默认支付类型
		 *
		 * 版本 >= 0
		 */
		var $dwDefaultPayType; //uint32_t

		/**
		 * 上次使用时间
		 *
		 * 版本 >= 0
		 */
		var $dwLastUseTime; //uint32_t

		/**
		 * 网购收货地址ID
		 *
		 * 版本 >= 0
		 */
		var $dwWgAid; //uint32_t

		/**
		 * 地址类型
		 *
		 * 版本 >= 0
		 */
		var $dwAddrType; //uint32_t

		/**
		 * 使用次数
		 *
		 * 版本 >= 0
		 */
		var $dwUsedCount; //uint32_t

		/**
		 * 属性,0x1标识默认地址
		 *
		 * 版本 >= 0
		 */
		var $dwProperty; //uint32_t

		/**
		 * 结果与查询的行政区划冲突
		 *
		 * 版本 >= 0
		 */
		var $dwPcdConfictFlag; //uint32_t

		/**
		 * 经度
		 *
		 * 版本 >= 0
		 */
		var $dwPointX; //uint32_t

		/**
		 * 纬度
		 *
		 * 版本 >= 0
		 */
		var $dwPointY; //uint32_t

		/**
		 * 查询字符串与查询结果的相似度
		 *
		 * 版本 >= 0
		 */
		var $dwSimilarity; //uint32_t

		/**
		 * 预留
		 *
		 * 版本 >= 0
		 */
		var $strReserved; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonAid_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIid_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonUid_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cMobile_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPhone_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cFax_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cZipCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDistrictIdMap_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cAddress_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cWorkplace_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSortfactor_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cUpdateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCreateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDefaultShipping_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDefaultPayType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cLastUseTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cWgAid_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cAddrType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cUsedCount_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cProperty_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPcdConfictFlag_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPointX_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPointY_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSimilarity_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserved_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->ddwIcsonAid = 0; // uint64_t
			 $this->dwIid = 0; // uint32_t
			 $this->ddwIcsonUid = 0; // uint64_t
			 $this->strName = ""; // std::string
			 $this->strMobile = ""; // std::string
			 $this->strPhone = ""; // std::string
			 $this->strFax = ""; // std::string
			 $this->strZipCode = ""; // std::string
			 $this->mapDistrictIdMap = new stl_map('uint32_t,uint32_t'); // std::map<uint32_t,uint32_t> 
			 $this->strAddress = ""; // std::string
			 $this->strWorkplace = ""; // std::string
			 $this->dwSortfactor = 0; // uint32_t
			 $this->dwUpdateTime = 0; // uint32_t
			 $this->dwCreateTime = 0; // uint32_t
			 $this->dwDefaultShipping = 0; // uint32_t
			 $this->dwDefaultPayType = 0; // uint32_t
			 $this->dwLastUseTime = 0; // uint32_t
			 $this->dwWgAid = 0; // uint32_t
			 $this->dwAddrType = 0; // uint32_t
			 $this->dwUsedCount = 0; // uint32_t
			 $this->dwProperty = 0; // uint32_t
			 $this->dwPcdConfictFlag = 0; // uint32_t
			 $this->dwPointX = 0; // uint32_t
			 $this->dwPointY = 0; // uint32_t
			 $this->dwSimilarity = 0; // uint32_t
			 $this->strReserved = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cIcsonAid_u = 0; // uint8_t
			 $this->cIid_u = 0; // uint8_t
			 $this->cIcsonUid_u = 0; // uint8_t
			 $this->cName_u = 0; // uint8_t
			 $this->cMobile_u = 0; // uint8_t
			 $this->cPhone_u = 0; // uint8_t
			 $this->cFax_u = 0; // uint8_t
			 $this->cZipCode_u = 0; // uint8_t
			 $this->cDistrictIdMap_u = 0; // uint8_t
			 $this->cAddress_u = 0; // uint8_t
			 $this->cWorkplace_u = 0; // uint8_t
			 $this->cSortfactor_u = 0; // uint8_t
			 $this->cUpdateTime_u = 0; // uint8_t
			 $this->cCreateTime_u = 0; // uint8_t
			 $this->cDefaultShipping_u = 0; // uint8_t
			 $this->cDefaultPayType_u = 0; // uint8_t
			 $this->cLastUseTime_u = 0; // uint8_t
			 $this->cWgAid_u = 0; // uint8_t
			 $this->cAddrType_u = 0; // uint8_t
			 $this->cUsedCount_u = 0; // uint8_t
			 $this->cProperty_u = 0; // uint8_t
			 $this->cPcdConfictFlag_u = 0; // uint8_t
			 $this->cPointX_u = 0; // uint8_t
			 $this->cPointY_u = 0; // uint8_t
			 $this->cSimilarity_u = 0; // uint8_t
			 $this->cReserved_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号 类型为uint32_t
			$bs->pushUint64_t($this->ddwIcsonAid); // 序列化易迅收货地址记录ID 类型为uint64_t
			$bs->pushUint32_t($this->dwIid); // 序列化易迅发票ID 类型为uint32_t
			$bs->pushUint64_t($this->ddwIcsonUid); // 序列化易迅用户ID 类型为uint64_t
			$bs->pushString($this->strName); // 序列化用户姓名 类型为std::string
			$bs->pushString($this->strMobile); // 序列化用户手机号 类型为std::string
			$bs->pushString($this->strPhone); // 序列化用户普通电话 类型为std::string
			$bs->pushString($this->strFax); // 序列化用户传真 类型为std::string
			$bs->pushString($this->strZipCode); // 序列化邮编 类型为std::string
			$bs->pushObject($this->mapDistrictIdMap,'stl_map'); // 序列化区域ID映射表 类型为std::map<uint32_t,uint32_t> 
			$bs->pushString($this->strAddress); // 序列化用户详细收货地址 类型为std::string
			$bs->pushString($this->strWorkplace); // 序列化地址标注 类型为std::string
			$bs->pushUint32_t($this->dwSortfactor); // 序列化排序因子 类型为uint32_t
			$bs->pushUint32_t($this->dwUpdateTime); // 序列化记录更新时间 类型为uint32_t
			$bs->pushUint32_t($this->dwCreateTime); // 序列化记录创建时间 类型为uint32_t
			$bs->pushUint32_t($this->dwDefaultShipping); // 序列化默认送货方式 类型为uint32_t
			$bs->pushUint32_t($this->dwDefaultPayType); // 序列化默认支付类型 类型为uint32_t
			$bs->pushUint32_t($this->dwLastUseTime); // 序列化上次使用时间 类型为uint32_t
			$bs->pushUint32_t($this->dwWgAid); // 序列化网购收货地址ID 类型为uint32_t
			$bs->pushUint32_t($this->dwAddrType); // 序列化地址类型 类型为uint32_t
			$bs->pushUint32_t($this->dwUsedCount); // 序列化使用次数 类型为uint32_t
			$bs->pushUint32_t($this->dwProperty); // 序列化属性,0x1标识默认地址 类型为uint32_t
			$bs->pushUint32_t($this->dwPcdConfictFlag); // 序列化结果与查询的行政区划冲突 类型为uint32_t
			$bs->pushUint32_t($this->dwPointX); // 序列化经度 类型为uint32_t
			$bs->pushUint32_t($this->dwPointY); // 序列化纬度 类型为uint32_t
			$bs->pushUint32_t($this->dwSimilarity); // 序列化查询字符串与查询结果的相似度 类型为uint32_t
			$bs->pushString($this->strReserved); // 序列化预留 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonAid_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIid_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonUid_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cMobile_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPhone_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cFax_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cZipCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDistrictIdMap_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cAddress_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cWorkplace_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSortfactor_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cUpdateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCreateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDefaultShipping_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDefaultPayType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cLastUseTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cWgAid_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cAddrType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cUsedCount_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cProperty_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPcdConfictFlag_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPointX_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPointY_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSimilarity_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserved_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号 类型为uint32_t
			$this->ddwIcsonAid = $bs->popUint64_t(); // 反序列化易迅收货地址记录ID 类型为uint64_t
			$this->dwIid = $bs->popUint32_t(); // 反序列化易迅发票ID 类型为uint32_t
			$this->ddwIcsonUid = $bs->popUint64_t(); // 反序列化易迅用户ID 类型为uint64_t
			$this->strName = $bs->popString(); // 反序列化用户姓名 类型为std::string
			$this->strMobile = $bs->popString(); // 反序列化用户手机号 类型为std::string
			$this->strPhone = $bs->popString(); // 反序列化用户普通电话 类型为std::string
			$this->strFax = $bs->popString(); // 反序列化用户传真 类型为std::string
			$this->strZipCode = $bs->popString(); // 反序列化邮编 类型为std::string
			$this->mapDistrictIdMap = $bs->popObject('stl_map<uint32_t,uint32_t>'); // 反序列化区域ID映射表 类型为std::map<uint32_t,uint32_t> 
			$this->strAddress = $bs->popString(); // 反序列化用户详细收货地址 类型为std::string
			$this->strWorkplace = $bs->popString(); // 反序列化地址标注 类型为std::string
			$this->dwSortfactor = $bs->popUint32_t(); // 反序列化排序因子 类型为uint32_t
			$this->dwUpdateTime = $bs->popUint32_t(); // 反序列化记录更新时间 类型为uint32_t
			$this->dwCreateTime = $bs->popUint32_t(); // 反序列化记录创建时间 类型为uint32_t
			$this->dwDefaultShipping = $bs->popUint32_t(); // 反序列化默认送货方式 类型为uint32_t
			$this->dwDefaultPayType = $bs->popUint32_t(); // 反序列化默认支付类型 类型为uint32_t
			$this->dwLastUseTime = $bs->popUint32_t(); // 反序列化上次使用时间 类型为uint32_t
			$this->dwWgAid = $bs->popUint32_t(); // 反序列化网购收货地址ID 类型为uint32_t
			$this->dwAddrType = $bs->popUint32_t(); // 反序列化地址类型 类型为uint32_t
			$this->dwUsedCount = $bs->popUint32_t(); // 反序列化使用次数 类型为uint32_t
			$this->dwProperty = $bs->popUint32_t(); // 反序列化属性,0x1标识默认地址 类型为uint32_t
			$this->dwPcdConfictFlag = $bs->popUint32_t(); // 反序列化结果与查询的行政区划冲突 类型为uint32_t
			$this->dwPointX = $bs->popUint32_t(); // 反序列化经度 类型为uint32_t
			$this->dwPointY = $bs->popUint32_t(); // 反序列化纬度 类型为uint32_t
			$this->dwSimilarity = $bs->popUint32_t(); // 反序列化查询字符串与查询结果的相似度 类型为uint32_t
			$this->strReserved = $bs->popString(); // 反序列化预留 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonAid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonUid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cMobile_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPhone_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cFax_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cZipCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDistrictIdMap_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cAddress_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cWorkplace_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSortfactor_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCreateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDefaultShipping_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDefaultPayType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cLastUseTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cWgAid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cAddrType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cUsedCount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPcdConfictFlag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPointX_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPointY_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSimilarity_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserved_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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