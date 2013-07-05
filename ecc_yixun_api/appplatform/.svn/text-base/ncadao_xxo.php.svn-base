<?php

//source idl: com.b2b2c.nca.idl.NcaDao.java

if (!class_exists('SubAttrOptionDdo')) {
class SubAttrOptionDdo
{
		/**
		 *  版本号, version需要小写 
		 *
		 * 版本 >= 0
		 */
		var $cVersion; //uint8_t

		/**
		 *  属性项id 
		 *
		 * 版本 >= 0
		 */
		var $dwAttrId; //uint32_t

		/**
		 *  属性值id 
		 *
		 * 版本 >= 0
		 */
		var $dwOptionId; //uint32_t

		/**
		 *  值对property 
		 *
		 * 版本 >= 0
		 */
		var $dwProperty; //uint32_t


		 function __construct() {
			 $this->cVersion = 0; // uint8_t
			 $this->dwAttrId = 0; // uint32_t
			 $this->dwOptionId = 0; // uint32_t
			 $this->dwProperty = 0; // uint32_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint8_t($this->cVersion); // 序列化 版本号, version需要小写  类型为uint8_t
			$bs->pushUint32_t($this->dwAttrId); // 序列化 属性项id  类型为uint32_t
			$bs->pushUint32_t($this->dwOptionId); // 序列化 属性值id  类型为uint32_t
			$bs->pushUint32_t($this->dwProperty); // 序列化 值对property  类型为uint32_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->cVersion = $bs->popUint8_t(); // 反序列化 版本号, version需要小写  类型为uint8_t
			$this->dwAttrId = $bs->popUint32_t(); // 反序列化 属性项id  类型为uint32_t
			$this->dwOptionId = $bs->popUint32_t(); // 反序列化 属性值id  类型为uint32_t
			$this->dwProperty = $bs->popUint32_t(); // 反序列化 值对property  类型为uint32_t

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


//source idl: com.b2b2c.nca.idl.SearchPubNavByKey_WGResp.java

if (!class_exists('NavMatchKeyDdo')) {
class NavMatchKeyDdo
{
		/**
		 *  版本号, version需要小写 
		 *
		 * 版本 >= 0
		 */
		var $cVersion; //uint8_t

		/**
		 *  导航id 
		 *
		 * 版本 >= 0
		 */
		var $dwNavId; //uint32_t

		/**
		 *  Matchinfo 
		 *
		 * 版本 >= 0
		 */
		var $strMatchInfo; //std::string

		/**
		 *  PathInfo 
		 *
		 * 版本 >= 0
		 */
		var $strPathInfo; //std::string

		/**
		 *  MatchType 
		 *
		 * 版本 >= 0
		 */
		var $dwMatchType; //uint32_t


		 function __construct() {
			 $this->cVersion = 0; // uint8_t
			 $this->dwNavId = 0; // uint32_t
			 $this->strMatchInfo = ""; // std::string
			 $this->strPathInfo = ""; // std::string
			 $this->dwMatchType = 0; // uint32_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint8_t($this->cVersion); // 序列化 版本号, version需要小写  类型为uint8_t
			$bs->pushUint32_t($this->dwNavId); // 序列化 导航id  类型为uint32_t
			$bs->pushString($this->strMatchInfo); // 序列化 Matchinfo  类型为std::string
			$bs->pushString($this->strPathInfo); // 序列化 PathInfo  类型为std::string
			$bs->pushUint32_t($this->dwMatchType); // 序列化 MatchType  类型为uint32_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->cVersion = $bs->popUint8_t(); // 反序列化 版本号, version需要小写  类型为uint8_t
			$this->dwNavId = $bs->popUint32_t(); // 反序列化 导航id  类型为uint32_t
			$this->strMatchInfo = $bs->popString(); // 反序列化 Matchinfo  类型为std::string
			$this->strPathInfo = $bs->popString(); // 反序列化 PathInfo  类型为std::string
			$this->dwMatchType = $bs->popUint32_t(); // 反序列化 MatchType  类型为uint32_t

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


//source idl: com.b2b2c.nca.idl.SearchPubNavByKeyResp.java

if (!class_exists('NavMatchKey_v3')) {
class NavMatchKey_v3
{
		/**
		 * 版本号, version需要小写
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 导航id
		 *
		 * 版本 >= 0
		 */
		var $dwNavId; //uint32_t

		/**
		 * Matchinfo
		 *
		 * 版本 >= 0
		 */
		var $strMatchInfo; //std::string

		/**
		 * PathInfo
		 *
		 * 版本 >= 0
		 */
		var $strPathInfo; //std::string

		/**
		 * MatchType
		 *
		 * 版本 >= 0
		 */
		var $dwMatchType; //uint32_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->dwNavId = 0; // uint32_t
			 $this->strMatchInfo = ""; // std::string
			 $this->strPathInfo = ""; // std::string
			 $this->dwMatchType = 0; // uint32_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号, version需要小写 类型为uint32_t
			$bs->pushUint32_t($this->dwNavId); // 序列化导航id 类型为uint32_t
			$bs->pushString($this->strMatchInfo); // 序列化Matchinfo 类型为std::string
			$bs->pushString($this->strPathInfo); // 序列化PathInfo 类型为std::string
			$bs->pushUint32_t($this->dwMatchType); // 序列化MatchType 类型为uint32_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号, version需要小写 类型为uint32_t
			$this->dwNavId = $bs->popUint32_t(); // 反序列化导航id 类型为uint32_t
			$this->strMatchInfo = $bs->popString(); // 反序列化Matchinfo 类型为std::string
			$this->strPathInfo = $bs->popString(); // 反序列化PathInfo 类型为std::string
			$this->dwMatchType = $bs->popUint32_t(); // 反序列化MatchType 类型为uint32_t

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


//source idl: com.b2b2c.nca.idl.NcaDao.java

if (!class_exists('PublistNodeDdo')) {
class PublistNodeDdo
{
		/**
		 *  版本号, version需要小写 
		 *
		 * 版本 >= 0
		 */
		var $cVersion; //uint8_t

		/**
		 *  导航id 
		 *
		 * 版本 >= 0
		 */
		var $dwNavId; //uint32_t

		/**
		 *  属性项id 
		 *
		 * 版本 >= 0
		 */
		var $dwAttrId; //uint32_t

		/**
		 *  属性值id 
		 *
		 * 版本 >= 0
		 */
		var $dwOptionId; //uint32_t

		/**
		 *  类型:1属性，3类目，4品类 
		 *
		 * 版本 >= 0
		 */
		var $dwType; //uint32_t

		/**
		 *  name 
		 *
		 * 版本 >= 0
		 */
		var $strName; //std::string

		/**
		 *  property 
		 *
		 * 版本 >= 0
		 */
		var $strPropertyStr; //std::string

		/**
		 *  是否有后继节点 
		 *
		 * 版本 >= 0
		 */
		var $dwAnyChildren; //uint32_t

		/**
		 *  sDesc 
		 *
		 * 版本 >= 0
		 */
		var $strDesc; //std::string


		 function __construct() {
			 $this->cVersion = 0; // uint8_t
			 $this->dwNavId = 0; // uint32_t
			 $this->dwAttrId = 0; // uint32_t
			 $this->dwOptionId = 0; // uint32_t
			 $this->dwType = 0; // uint32_t
			 $this->strName = ""; // std::string
			 $this->strPropertyStr = ""; // std::string
			 $this->dwAnyChildren = 0; // uint32_t
			 $this->strDesc = ""; // std::string
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint8_t($this->cVersion); // 序列化 版本号, version需要小写  类型为uint8_t
			$bs->pushUint32_t($this->dwNavId); // 序列化 导航id  类型为uint32_t
			$bs->pushUint32_t($this->dwAttrId); // 序列化 属性项id  类型为uint32_t
			$bs->pushUint32_t($this->dwOptionId); // 序列化 属性值id  类型为uint32_t
			$bs->pushUint32_t($this->dwType); // 序列化 类型:1属性，3类目，4品类  类型为uint32_t
			$bs->pushString($this->strName); // 序列化 name  类型为std::string
			$bs->pushString($this->strPropertyStr); // 序列化 property  类型为std::string
			$bs->pushUint32_t($this->dwAnyChildren); // 序列化 是否有后继节点  类型为uint32_t
			$bs->pushString($this->strDesc); // 序列化 sDesc  类型为std::string
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->cVersion = $bs->popUint8_t(); // 反序列化 版本号, version需要小写  类型为uint8_t
			$this->dwNavId = $bs->popUint32_t(); // 反序列化 导航id  类型为uint32_t
			$this->dwAttrId = $bs->popUint32_t(); // 反序列化 属性项id  类型为uint32_t
			$this->dwOptionId = $bs->popUint32_t(); // 反序列化 属性值id  类型为uint32_t
			$this->dwType = $bs->popUint32_t(); // 反序列化 类型:1属性，3类目，4品类  类型为uint32_t
			$this->strName = $bs->popString(); // 反序列化 name  类型为std::string
			$this->strPropertyStr = $bs->popString(); // 反序列化 property  类型为std::string
			$this->dwAnyChildren = $bs->popUint32_t(); // 反序列化 是否有后继节点  类型为uint32_t
			$this->strDesc = $bs->popString(); // 反序列化 sDesc  类型为std::string

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


//source idl: com.b2b2c.nca.idl.ParseAttrTexts_ALLResp.java

if (!class_exists('AttrDdo')) {
class AttrDdo
{
		/**
		 *  版本号, version需要小写 
		 *
		 * 版本 >= 0
		 */
		var $cVersion; //uint8_t

		/**
		 *  属性项id 
		 *
		 * 版本 >= 0
		 */
		var $dwAttrId; //uint32_t

		/**
		 *  导航id 
		 *
		 * 版本 >= 0
		 */
		var $dwNavId; //uint32_t

		/**
		 *  属性项名称 
		 *
		 * 版本 >= 0
		 */
		var $strName; //std::string

		/**
		 *  property 
		 *
		 * 版本 >= 0
		 */
		var $dwProperty; //uint32_t

		/**
		 *  类型 
		 *
		 * 版本 >= 0
		 */
		var $dwType; //uint32_t

		/**
		 *  父属性项id 
		 *
		 * 版本 >= 0
		 */
		var $dwPAttrId; //uint32_t

		/**
		 *  父属性值id 
		 *
		 * 版本 >= 0
		 */
		var $dwPOptionId; //uint32_t

		/**
		 *  属性项描述 
		 *
		 * 版本 >= 0
		 */
		var $strDesc; //std::string

		/**
		 *  属性项排序 
		 *
		 * 版本 >= 0
		 */
		var $dwOrder; //uint32_t

		/**
		 *  属性值集合 
		 *
		 * 版本 >= 0
		 */
		var $vecOptions; //std::vector<b2b2c::nca::ddo::COptionDdo> 

		/**
		 *  是否选项，0为否，其余为是 
		 *
		 * 版本 >= 140
		 */
		var $dwIsOptional; //uint32_t

		/**
		 *  是否文本，0为否，其余为是 
		 *
		 * 版本 >= 140
		 */
		var $dwIsText; //uint32_t

		/**
		 *  是否单选，0为否，其余为是 
		 *
		 * 版本 >= 140
		 */
		var $dwIsSingle; //uint32_t

		/**
		 *  是否多选，0为否，其余为是 
		 *
		 * 版本 >= 140
		 */
		var $dwIsMulti; //uint32_t

		/**
		 *  是否可选，0为否，其余为是 
		 *
		 * 版本 >= 140
		 */
		var $dwIsMust; //uint32_t

		/**
		 *  是否关键属性，0为否，其余为是 
		 *
		 * 版本 >= 140
		 */
		var $dwIsSpuKey; //uint32_t

		/**
		 *  是否SPU一般属性，0为否，其余为是 
		 *
		 * 版本 >= 140
		 */
		var $dwIsSpuComm; //uint32_t

		/**
		 *  是否销售属性，0为否，其余为是 
		 *
		 * 版本 >= 140
		 */
		var $dwIsSkuSale; //uint32_t

		/**
		 *  是否一般属性，0为否，其余为是 
		 *
		 * 版本 >= 140
		 */
		var $dwIsSkuComm; //uint32_t

		/**
		 *  是否搜索聚合属性，0为否，其余为是 
		 *
		 * 版本 >= 140
		 */
		var $dwIsSearchJoint; //uint32_t

		/**
		 *  是否商详隐藏属性，0为否，其余为是 
		 *
		 * 版本 >= 140
		 */
		var $dwIsHideSX; //uint32_t


		 function __construct() {
			 $this->cVersion = 140; // uint8_t
			 $this->dwAttrId = 0; // uint32_t
			 $this->dwNavId = 0; // uint32_t
			 $this->strName = ""; // std::string
			 $this->dwProperty = 0; // uint32_t
			 $this->dwType = 0; // uint32_t
			 $this->dwPAttrId = 0; // uint32_t
			 $this->dwPOptionId = 0; // uint32_t
			 $this->strDesc = ""; // std::string
			 $this->dwOrder = 0; // uint32_t
			 $this->vecOptions = new stl_vector('OptionDdo'); // std::vector<b2b2c::nca::ddo::COptionDdo> 
			 $this->dwIsOptional = 0; // uint32_t
			 $this->dwIsText = 0; // uint32_t
			 $this->dwIsSingle = 0; // uint32_t
			 $this->dwIsMulti = 0; // uint32_t
			 $this->dwIsMust = 0; // uint32_t
			 $this->dwIsSpuKey = 0; // uint32_t
			 $this->dwIsSpuComm = 0; // uint32_t
			 $this->dwIsSkuSale = 0; // uint32_t
			 $this->dwIsSkuComm = 0; // uint32_t
			 $this->dwIsSearchJoint = 0; // uint32_t
			 $this->dwIsHideSX = 0; // uint32_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint8_t($this->cVersion); // 序列化 版本号, version需要小写  类型为uint8_t
			$bs->pushUint32_t($this->dwAttrId); // 序列化 属性项id  类型为uint32_t
			$bs->pushUint32_t($this->dwNavId); // 序列化 导航id  类型为uint32_t
			$bs->pushString($this->strName); // 序列化 属性项名称  类型为std::string
			$bs->pushUint32_t($this->dwProperty); // 序列化 property  类型为uint32_t
			$bs->pushUint32_t($this->dwType); // 序列化 类型  类型为uint32_t
			$bs->pushUint32_t($this->dwPAttrId); // 序列化 父属性项id  类型为uint32_t
			$bs->pushUint32_t($this->dwPOptionId); // 序列化 父属性值id  类型为uint32_t
			$bs->pushString($this->strDesc); // 序列化 属性项描述  类型为std::string
			$bs->pushUint32_t($this->dwOrder); // 序列化 属性项排序  类型为uint32_t
			$bs->pushObject($this->vecOptions,'stl_vector'); // 序列化 属性值集合  类型为std::vector<b2b2c::nca::ddo::COptionDdo> 
			if(  $this->cVersion >= 140 ){
				$bs->pushUint32_t($this->dwIsOptional); // 序列化 是否选项，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$bs->pushUint32_t($this->dwIsText); // 序列化 是否文本，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$bs->pushUint32_t($this->dwIsSingle); // 序列化 是否单选，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$bs->pushUint32_t($this->dwIsMulti); // 序列化 是否多选，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$bs->pushUint32_t($this->dwIsMust); // 序列化 是否可选，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$bs->pushUint32_t($this->dwIsSpuKey); // 序列化 是否关键属性，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$bs->pushUint32_t($this->dwIsSpuComm); // 序列化 是否SPU一般属性，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$bs->pushUint32_t($this->dwIsSkuSale); // 序列化 是否销售属性，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$bs->pushUint32_t($this->dwIsSkuComm); // 序列化 是否一般属性，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$bs->pushUint32_t($this->dwIsSearchJoint); // 序列化 是否搜索聚合属性，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$bs->pushUint32_t($this->dwIsHideSX); // 序列化 是否商详隐藏属性，0为否，其余为是  类型为uint32_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->cVersion = $bs->popUint8_t(); // 反序列化 版本号, version需要小写  类型为uint8_t
			$this->dwAttrId = $bs->popUint32_t(); // 反序列化 属性项id  类型为uint32_t
			$this->dwNavId = $bs->popUint32_t(); // 反序列化 导航id  类型为uint32_t
			$this->strName = $bs->popString(); // 反序列化 属性项名称  类型为std::string
			$this->dwProperty = $bs->popUint32_t(); // 反序列化 property  类型为uint32_t
			$this->dwType = $bs->popUint32_t(); // 反序列化 类型  类型为uint32_t
			$this->dwPAttrId = $bs->popUint32_t(); // 反序列化 父属性项id  类型为uint32_t
			$this->dwPOptionId = $bs->popUint32_t(); // 反序列化 父属性值id  类型为uint32_t
			$this->strDesc = $bs->popString(); // 反序列化 属性项描述  类型为std::string
			$this->dwOrder = $bs->popUint32_t(); // 反序列化 属性项排序  类型为uint32_t
			$this->vecOptions = $bs->popObject('stl_vector<OptionDdo>'); // 反序列化 属性值集合  类型为std::vector<b2b2c::nca::ddo::COptionDdo> 
			if(  $this->cVersion >= 140 ){
				$this->dwIsOptional = $bs->popUint32_t(); // 反序列化 是否选项，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$this->dwIsText = $bs->popUint32_t(); // 反序列化 是否文本，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$this->dwIsSingle = $bs->popUint32_t(); // 反序列化 是否单选，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$this->dwIsMulti = $bs->popUint32_t(); // 反序列化 是否多选，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$this->dwIsMust = $bs->popUint32_t(); // 反序列化 是否可选，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$this->dwIsSpuKey = $bs->popUint32_t(); // 反序列化 是否关键属性，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$this->dwIsSpuComm = $bs->popUint32_t(); // 反序列化 是否SPU一般属性，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$this->dwIsSkuSale = $bs->popUint32_t(); // 反序列化 是否销售属性，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$this->dwIsSkuComm = $bs->popUint32_t(); // 反序列化 是否一般属性，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$this->dwIsSearchJoint = $bs->popUint32_t(); // 反序列化 是否搜索聚合属性，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$this->dwIsHideSX = $bs->popUint32_t(); // 反序列化 是否商详隐藏属性，0为否，其余为是  类型为uint32_t
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


//source idl: com.b2b2c.nca.idl.AttrDdo.java

if (!class_exists('OptionDdo')) {
class OptionDdo
{
		/**
		 *  版本号, version需要小写 
		 *
		 * 版本 >= 0
		 */
		var $cVersion; //uint8_t

		/**
		 *  属性项id 
		 *
		 * 版本 >= 0
		 */
		var $dwAttrId; //uint32_t

		/**
		 *  属性值id 
		 *
		 * 版本 >= 0
		 */
		var $dwOptionId; //uint32_t

		/**
		 *  类型 
		 *
		 * 版本 >= 0
		 */
		var $dwType; //uint32_t

		/**
		 *  property 
		 *
		 * 版本 >= 0
		 */
		var $dwProperty; //uint32_t

		/**
		 *  属性值排序 
		 *
		 * 版本 >= 0
		 */
		var $dwOrder; //uint32_t

		/**
		 *  属性值名称 
		 *
		 * 版本 >= 0
		 */
		var $strName; //std::string

		/**
		 *  属性值下的子属性值对 
		 *
		 * 版本 >= 0
		 */
		var $mapSubAttrIds; //std::map<uint32_t,std::vector<b2b2c::nca::ddo::CSubAttrOptionDdo> > 


		 function __construct() {
			 $this->cVersion = 0; // uint8_t
			 $this->dwAttrId = 0; // uint32_t
			 $this->dwOptionId = 0; // uint32_t
			 $this->dwType = 0; // uint32_t
			 $this->dwProperty = 0; // uint32_t
			 $this->dwOrder = 0; // uint32_t
			 $this->strName = ""; // std::string
			 $this->mapSubAttrIds = new stl_map('uint32_t,stl_vector<SubAttrOptionDdo> '); // std::map<uint32_t,std::vector<b2b2c::nca::ddo::CSubAttrOptionDdo> > 
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint8_t($this->cVersion); // 序列化 版本号, version需要小写  类型为uint8_t
			$bs->pushUint32_t($this->dwAttrId); // 序列化 属性项id  类型为uint32_t
			$bs->pushUint32_t($this->dwOptionId); // 序列化 属性值id  类型为uint32_t
			$bs->pushUint32_t($this->dwType); // 序列化 类型  类型为uint32_t
			$bs->pushUint32_t($this->dwProperty); // 序列化 property  类型为uint32_t
			$bs->pushUint32_t($this->dwOrder); // 序列化 属性值排序  类型为uint32_t
			$bs->pushString($this->strName); // 序列化 属性值名称  类型为std::string
			$bs->pushObject($this->mapSubAttrIds,'stl_map'); // 序列化 属性值下的子属性值对  类型为std::map<uint32_t,std::vector<b2b2c::nca::ddo::CSubAttrOptionDdo> > 
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->cVersion = $bs->popUint8_t(); // 反序列化 版本号, version需要小写  类型为uint8_t
			$this->dwAttrId = $bs->popUint32_t(); // 反序列化 属性项id  类型为uint32_t
			$this->dwOptionId = $bs->popUint32_t(); // 反序列化 属性值id  类型为uint32_t
			$this->dwType = $bs->popUint32_t(); // 反序列化 类型  类型为uint32_t
			$this->dwProperty = $bs->popUint32_t(); // 反序列化 property  类型为uint32_t
			$this->dwOrder = $bs->popUint32_t(); // 反序列化 属性值排序  类型为uint32_t
			$this->strName = $bs->popString(); // 反序列化 属性值名称  类型为std::string
			$this->mapSubAttrIds = $bs->popObject('stl_map<uint32_t,stl_vector<SubAttrOptionDdo> >'); // 反序列化 属性值下的子属性值对  类型为std::map<uint32_t,std::vector<b2b2c::nca::ddo::CSubAttrOptionDdo> > 

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


//source idl: com.b2b2c.nca.idl.ParseAttrTexts_ALLReq.java

if (!class_exists('APIControl')) {
class APIControl
{
		/**
		 * 版本号, version需要小写
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 入参编码类型，1:GBK，2:UTF-8
		 *
		 * 版本 >= 0
		 */
		var $dwCharset; //uint32_t

		/**
		 * 来源，1:易讯
		 *
		 * 版本 >= 0
		 */
		var $dwSource; //uint32_t

		/**
		 * 跟Source有关的选项
		 *
		 * 版本 >= 0
		 */
		var $dwOption; //uint32_t

		/**
		 * 回参编码类型，0表示与入参编码类型相同，1:GBK，2:UTF-8
		 *
		 * 版本 >= 0
		 */
		var $dwCharsetRsp; //uint32_t


		 function __construct() {
			 $this->dwVersion = 1; // uint32_t
			 $this->dwCharset = 0; // uint32_t
			 $this->dwSource = 0; // uint32_t
			 $this->dwOption = 0; // uint32_t
			 $this->dwCharsetRsp = 0; // uint32_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号, version需要小写 类型为uint32_t
			$bs->pushUint32_t($this->dwCharset); // 序列化入参编码类型，1:GBK，2:UTF-8 类型为uint32_t
			$bs->pushUint32_t($this->dwSource); // 序列化来源，1:易讯 类型为uint32_t
			$bs->pushUint32_t($this->dwOption); // 序列化跟Source有关的选项 类型为uint32_t
			$bs->pushUint32_t($this->dwCharsetRsp); // 序列化回参编码类型，0表示与入参编码类型相同，1:GBK，2:UTF-8 类型为uint32_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号, version需要小写 类型为uint32_t
			$this->dwCharset = $bs->popUint32_t(); // 反序列化入参编码类型，1:GBK，2:UTF-8 类型为uint32_t
			$this->dwSource = $bs->popUint32_t(); // 反序列化来源，1:易讯 类型为uint32_t
			$this->dwOption = $bs->popUint32_t(); // 反序列化跟Source有关的选项 类型为uint32_t
			$this->dwCharsetRsp = $bs->popUint32_t(); // 反序列化回参编码类型，0表示与入参编码类型相同，1:GBK，2:UTF-8 类型为uint32_t

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


//source idl: com.b2b2c.nca.idl.ParseAttrTextResp.java

if (!class_exists('AttrBo_v3')) {
class AttrBo_v3
{
		/**
		 * 版本号, version需要小写
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 属性项id
		 *
		 * 版本 >= 0
		 */
		var $dwAttrId; //uint32_t

		/**
		 * 导航id
		 *
		 * 版本 >= 0
		 */
		var $dwNavId; //uint32_t

		/**
		 * 属性项名称
		 *
		 * 版本 >= 0
		 */
		var $strName; //std::string

		/**
		 * property
		 *
		 * 版本 >= 0
		 */
		var $dwProperty; //uint32_t

		/**
		 * 类型
		 *
		 * 版本 >= 0
		 */
		var $dwType; //uint32_t

		/**
		 * 父属性项id
		 *
		 * 版本 >= 0
		 */
		var $dwPAttrId; //uint32_t

		/**
		 * 父属性值id
		 *
		 * 版本 >= 0
		 */
		var $dwPOptionId; //uint32_t

		/**
		 * 属性项描述
		 *
		 * 版本 >= 0
		 */
		var $strDesc; //std::string

		/**
		 * 属性项排序
		 *
		 * 版本 >= 0
		 */
		var $dwOrder; //uint32_t

		/**
		 * 属性值集合
		 *
		 * 版本 >= 0
		 */
		var $vecOptions; //std::vector<c2cent::bo::nca_v3::COptionBo_v3> 


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->dwAttrId = 0; // uint32_t
			 $this->dwNavId = 0; // uint32_t
			 $this->strName = ""; // std::string
			 $this->dwProperty = 0; // uint32_t
			 $this->dwType = 0; // uint32_t
			 $this->dwPAttrId = 0; // uint32_t
			 $this->dwPOptionId = 0; // uint32_t
			 $this->strDesc = ""; // std::string
			 $this->dwOrder = 0; // uint32_t
			 $this->vecOptions = new stl_vector('OptionBo_v3'); // std::vector<c2cent::bo::nca_v3::COptionBo_v3> 
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号, version需要小写 类型为uint32_t
			$bs->pushUint32_t($this->dwAttrId); // 序列化属性项id 类型为uint32_t
			$bs->pushUint32_t($this->dwNavId); // 序列化导航id 类型为uint32_t
			$bs->pushString($this->strName); // 序列化属性项名称 类型为std::string
			$bs->pushUint32_t($this->dwProperty); // 序列化property 类型为uint32_t
			$bs->pushUint32_t($this->dwType); // 序列化类型 类型为uint32_t
			$bs->pushUint32_t($this->dwPAttrId); // 序列化父属性项id 类型为uint32_t
			$bs->pushUint32_t($this->dwPOptionId); // 序列化父属性值id 类型为uint32_t
			$bs->pushString($this->strDesc); // 序列化属性项描述 类型为std::string
			$bs->pushUint32_t($this->dwOrder); // 序列化属性项排序 类型为uint32_t
			$bs->pushObject($this->vecOptions,'stl_vector'); // 序列化属性值集合 类型为std::vector<c2cent::bo::nca_v3::COptionBo_v3> 
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号, version需要小写 类型为uint32_t
			$this->dwAttrId = $bs->popUint32_t(); // 反序列化属性项id 类型为uint32_t
			$this->dwNavId = $bs->popUint32_t(); // 反序列化导航id 类型为uint32_t
			$this->strName = $bs->popString(); // 反序列化属性项名称 类型为std::string
			$this->dwProperty = $bs->popUint32_t(); // 反序列化property 类型为uint32_t
			$this->dwType = $bs->popUint32_t(); // 反序列化类型 类型为uint32_t
			$this->dwPAttrId = $bs->popUint32_t(); // 反序列化父属性项id 类型为uint32_t
			$this->dwPOptionId = $bs->popUint32_t(); // 反序列化父属性值id 类型为uint32_t
			$this->strDesc = $bs->popString(); // 反序列化属性项描述 类型为std::string
			$this->dwOrder = $bs->popUint32_t(); // 反序列化属性项排序 类型为uint32_t
			$this->vecOptions = $bs->popObject('stl_vector<OptionBo_v3>'); // 反序列化属性值集合 类型为std::vector<c2cent::bo::nca_v3::COptionBo_v3> 

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


//source idl: com.b2b2c.nca.idl.AttrBo_v3.java

if (!class_exists('OptionBo_v3')) {
class OptionBo_v3
{
		/**
		 * 版本号, version需要小写
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 属性项id
		 *
		 * 版本 >= 0
		 */
		var $dwAttrId; //uint32_t

		/**
		 * 属性值id
		 *
		 * 版本 >= 0
		 */
		var $dwOptionId; //uint32_t

		/**
		 * 类型
		 *
		 * 版本 >= 0
		 */
		var $dwType; //uint32_t

		/**
		 * property
		 *
		 * 版本 >= 0
		 */
		var $dwProperty; //uint32_t

		/**
		 * 属性值排序
		 *
		 * 版本 >= 0
		 */
		var $dwOrder; //uint32_t

		/**
		 * 属性值名称
		 *
		 * 版本 >= 0
		 */
		var $strName; //std::string

		/**
		 * 属性值下的子属性值对
		 *
		 * 版本 >= 0
		 */
		var $mapSubAttrIds; //std::map<uint32_t,std::vector<c2cent::bo::nca_v3::CSubAttrOption_v3> > 


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->dwAttrId = 0; // uint32_t
			 $this->dwOptionId = 0; // uint32_t
			 $this->dwType = 0; // uint32_t
			 $this->dwProperty = 0; // uint32_t
			 $this->dwOrder = 0; // uint32_t
			 $this->strName = ""; // std::string
			 $this->mapSubAttrIds = new stl_map('uint32_t,stl_vector<SubAttrOption_v3> '); // std::map<uint32_t,std::vector<c2cent::bo::nca_v3::CSubAttrOption_v3> > 
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号, version需要小写 类型为uint32_t
			$bs->pushUint32_t($this->dwAttrId); // 序列化属性项id 类型为uint32_t
			$bs->pushUint32_t($this->dwOptionId); // 序列化属性值id 类型为uint32_t
			$bs->pushUint32_t($this->dwType); // 序列化类型 类型为uint32_t
			$bs->pushUint32_t($this->dwProperty); // 序列化property 类型为uint32_t
			$bs->pushUint32_t($this->dwOrder); // 序列化属性值排序 类型为uint32_t
			$bs->pushString($this->strName); // 序列化属性值名称 类型为std::string
			$bs->pushObject($this->mapSubAttrIds,'stl_map'); // 序列化属性值下的子属性值对 类型为std::map<uint32_t,std::vector<c2cent::bo::nca_v3::CSubAttrOption_v3> > 
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号, version需要小写 类型为uint32_t
			$this->dwAttrId = $bs->popUint32_t(); // 反序列化属性项id 类型为uint32_t
			$this->dwOptionId = $bs->popUint32_t(); // 反序列化属性值id 类型为uint32_t
			$this->dwType = $bs->popUint32_t(); // 反序列化类型 类型为uint32_t
			$this->dwProperty = $bs->popUint32_t(); // 反序列化property 类型为uint32_t
			$this->dwOrder = $bs->popUint32_t(); // 反序列化属性值排序 类型为uint32_t
			$this->strName = $bs->popString(); // 反序列化属性值名称 类型为std::string
			$this->mapSubAttrIds = $bs->popObject('stl_map<uint32_t,stl_vector<SubAttrOption_v3> >'); // 反序列化属性值下的子属性值对 类型为std::map<uint32_t,std::vector<c2cent::bo::nca_v3::CSubAttrOption_v3> > 

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


//source idl: com.b2b2c.nca.idl.OptionBo_v3.java

if (!class_exists('SubAttrOption_v3')) {
class SubAttrOption_v3
{
		/**
		 * 版本号, version需要小写
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 属性项id
		 *
		 * 版本 >= 0
		 */
		var $dwAttrId; //uint32_t

		/**
		 * 属性值id
		 *
		 * 版本 >= 0
		 */
		var $dwOptionId; //uint32_t

		/**
		 * 值对property
		 *
		 * 版本 >= 0
		 */
		var $dwProperty; //uint32_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->dwAttrId = 0; // uint32_t
			 $this->dwOptionId = 0; // uint32_t
			 $this->dwProperty = 0; // uint32_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号, version需要小写 类型为uint32_t
			$bs->pushUint32_t($this->dwAttrId); // 序列化属性项id 类型为uint32_t
			$bs->pushUint32_t($this->dwOptionId); // 序列化属性值id 类型为uint32_t
			$bs->pushUint32_t($this->dwProperty); // 序列化值对property 类型为uint32_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号, version需要小写 类型为uint32_t
			$this->dwAttrId = $bs->popUint32_t(); // 反序列化属性项id 类型为uint32_t
			$this->dwOptionId = $bs->popUint32_t(); // 反序列化属性值id 类型为uint32_t
			$this->dwProperty = $bs->popUint32_t(); // 反序列化值对property 类型为uint32_t

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


//source idl: com.b2b2c.nca.idl.ParseAttr4SX_WGResp.java

if (!class_exists('NavEntryDdo')) {
class NavEntryDdo
{
		/**
		 *  版本号, version需要小写 
		 *
		 * 版本 >= 0
		 */
		var $cVersion; //uint8_t

		/**
		 *  导航id 
		 *
		 * 版本 >= 0
		 */
		var $dwNavId; //uint32_t

		/**
		 *  地图id 
		 *
		 * 版本 >= 0
		 */
		var $dwMapId; //uint32_t

		/**
		 *  父导航id 
		 *
		 * 版本 >= 0
		 */
		var $dwPNavId; //uint32_t

		/**
		 *  导航名称 
		 *
		 * 版本 >= 0
		 */
		var $strName; //std::string

		/**
		 *  导航类型 
		 *
		 * 版本 >= 0
		 */
		var $dwType; //uint32_t

		/**
		 *  导航分类 
		 *
		 * 版本 >= 0
		 */
		var $dwCatalog; //uint32_t

		/**
		 *  备注 
		 *
		 * 版本 >= 0
		 */
		var $strNote; //std::string

		/**
		 *  排序字段 
		 *
		 * 版本 >= 0
		 */
		var $dwOrder; //uint32_t

		/**
		 *  导航property 
		 *
		 * 版本 >= 0
		 */
		var $strPropertyStr; //std::string

		/**
		 *  搜索条件 
		 *
		 * 版本 >= 0
		 */
		var $strSearchCond; //std::string

		/**
		 *  是否有属性 
		 *
		 * 版本 >= 0
		 */
		var $dwHasAttr; //uint32_t

		/**
		 *  导航预留自定义串1 
		 *
		 * 版本 >= 0
		 */
		var $strCustomStr1; //std::string

		/**
		 *  导航预留自定义串2 
		 *
		 * 版本 >= 0
		 */
		var $strCustomStr2; //std::string

		/**
		 *  导航预留自定义整形字段1 
		 *
		 * 版本 >= 0
		 */
		var $dwCustomUint1; //uint32_t

		/**
		 *  导航预留自定义整形字段2 
		 *
		 * 版本 >= 0
		 */
		var $dwCustomUint2; //uint32_t

		/**
		 *  是否预删除，0为否，其余为是 
		 *
		 * 版本 >= 140
		 */
		var $dwIsPreDelete; //uint32_t

		/**
		 *  是否合作伙伴优先，0为否，其余为是 
		 *
		 * 版本 >= 140
		 */
		var $dwIsCooperatorFirst; //uint32_t

		/**
		 *  是否低价优先，0为否，其余为是 
		 *
		 * 版本 >= 140
		 */
		var $dwIsLowPriceFirst; //uint32_t

		/**
		 *  是否高价优先，0为否，其余为是 
		 *
		 * 版本 >= 140
		 */
		var $dwIsHighPriceFirst; //uint32_t


		 function __construct() {
			 $this->cVersion = 140; // uint8_t
			 $this->dwNavId = 0; // uint32_t
			 $this->dwMapId = 0; // uint32_t
			 $this->dwPNavId = 0; // uint32_t
			 $this->strName = ""; // std::string
			 $this->dwType = 0; // uint32_t
			 $this->dwCatalog = 0; // uint32_t
			 $this->strNote = ""; // std::string
			 $this->dwOrder = 0; // uint32_t
			 $this->strPropertyStr = ""; // std::string
			 $this->strSearchCond = ""; // std::string
			 $this->dwHasAttr = 0; // uint32_t
			 $this->strCustomStr1 = ""; // std::string
			 $this->strCustomStr2 = ""; // std::string
			 $this->dwCustomUint1 = 0; // uint32_t
			 $this->dwCustomUint2 = 0; // uint32_t
			 $this->dwIsPreDelete = 0; // uint32_t
			 $this->dwIsCooperatorFirst = 0; // uint32_t
			 $this->dwIsLowPriceFirst = 0; // uint32_t
			 $this->dwIsHighPriceFirst = 0; // uint32_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint8_t($this->cVersion); // 序列化 版本号, version需要小写  类型为uint8_t
			$bs->pushUint32_t($this->dwNavId); // 序列化 导航id  类型为uint32_t
			$bs->pushUint32_t($this->dwMapId); // 序列化 地图id  类型为uint32_t
			$bs->pushUint32_t($this->dwPNavId); // 序列化 父导航id  类型为uint32_t
			$bs->pushString($this->strName); // 序列化 导航名称  类型为std::string
			$bs->pushUint32_t($this->dwType); // 序列化 导航类型  类型为uint32_t
			$bs->pushUint32_t($this->dwCatalog); // 序列化 导航分类  类型为uint32_t
			$bs->pushString($this->strNote); // 序列化 备注  类型为std::string
			$bs->pushUint32_t($this->dwOrder); // 序列化 排序字段  类型为uint32_t
			$bs->pushString($this->strPropertyStr); // 序列化 导航property  类型为std::string
			$bs->pushString($this->strSearchCond); // 序列化 搜索条件  类型为std::string
			$bs->pushUint32_t($this->dwHasAttr); // 序列化 是否有属性  类型为uint32_t
			$bs->pushString($this->strCustomStr1); // 序列化 导航预留自定义串1  类型为std::string
			$bs->pushString($this->strCustomStr2); // 序列化 导航预留自定义串2  类型为std::string
			$bs->pushUint32_t($this->dwCustomUint1); // 序列化 导航预留自定义整形字段1  类型为uint32_t
			$bs->pushUint32_t($this->dwCustomUint2); // 序列化 导航预留自定义整形字段2  类型为uint32_t
			if(  $this->cVersion >= 140 ){
				$bs->pushUint32_t($this->dwIsPreDelete); // 序列化 是否预删除，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$bs->pushUint32_t($this->dwIsCooperatorFirst); // 序列化 是否合作伙伴优先，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$bs->pushUint32_t($this->dwIsLowPriceFirst); // 序列化 是否低价优先，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$bs->pushUint32_t($this->dwIsHighPriceFirst); // 序列化 是否高价优先，0为否，其余为是  类型为uint32_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->cVersion = $bs->popUint8_t(); // 反序列化 版本号, version需要小写  类型为uint8_t
			$this->dwNavId = $bs->popUint32_t(); // 反序列化 导航id  类型为uint32_t
			$this->dwMapId = $bs->popUint32_t(); // 反序列化 地图id  类型为uint32_t
			$this->dwPNavId = $bs->popUint32_t(); // 反序列化 父导航id  类型为uint32_t
			$this->strName = $bs->popString(); // 反序列化 导航名称  类型为std::string
			$this->dwType = $bs->popUint32_t(); // 反序列化 导航类型  类型为uint32_t
			$this->dwCatalog = $bs->popUint32_t(); // 反序列化 导航分类  类型为uint32_t
			$this->strNote = $bs->popString(); // 反序列化 备注  类型为std::string
			$this->dwOrder = $bs->popUint32_t(); // 反序列化 排序字段  类型为uint32_t
			$this->strPropertyStr = $bs->popString(); // 反序列化 导航property  类型为std::string
			$this->strSearchCond = $bs->popString(); // 反序列化 搜索条件  类型为std::string
			$this->dwHasAttr = $bs->popUint32_t(); // 反序列化 是否有属性  类型为uint32_t
			$this->strCustomStr1 = $bs->popString(); // 反序列化 导航预留自定义串1  类型为std::string
			$this->strCustomStr2 = $bs->popString(); // 反序列化 导航预留自定义串2  类型为std::string
			$this->dwCustomUint1 = $bs->popUint32_t(); // 反序列化 导航预留自定义整形字段1  类型为uint32_t
			$this->dwCustomUint2 = $bs->popUint32_t(); // 反序列化 导航预留自定义整形字段2  类型为uint32_t
			if(  $this->cVersion >= 140 ){
				$this->dwIsPreDelete = $bs->popUint32_t(); // 反序列化 是否预删除，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$this->dwIsCooperatorFirst = $bs->popUint32_t(); // 反序列化 是否合作伙伴优先，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$this->dwIsLowPriceFirst = $bs->popUint32_t(); // 反序列化 是否低价优先，0为否，其余为是  类型为uint32_t
			}
			if(  $this->cVersion >= 140 ){
				$this->dwIsHighPriceFirst = $bs->popUint32_t(); // 反序列化 是否高价优先，0为否，其余为是  类型为uint32_t
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


//source idl: com.b2b2c.nca.idl.NcaDao.java

if (!class_exists('NavExOrderDdo')) {
class NavExOrderDdo
{
		/**
		 *  版本号, version需要小写 
		 *
		 * 版本 >= 0
		 */
		var $cVersion; //uint8_t

		/**
		 *  导航信息 
		 *
		 * 版本 >= 0
		 */
		var $oNavNode; //b2b2c::nca::ddo::CNavEntryDdo

		/**
		 *  导航路径 
		 *
		 * 版本 >= 0
		 */
		var $vecFullPath; //std::vector<b2b2c::nca::ddo::CNavEntryDdo> 

		/**
		 *  搜索导航路径 
		 *
		 * 版本 >= 0
		 */
		var $vecMetaSearchPath; //std::vector<b2b2c::nca::ddo::CNavEntryDdo> 

		/**
		 *  儿子导航 
		 *
		 * 版本 >= 0
		 */
		var $vecChildNode; //std::vector<b2b2c::nca::ddo::CNavEntryDdo> 

		/**
		 *  直接儿子属性 
		 *
		 * 版本 >= 0
		 */
		var $mapChildAttrId; //std::map<uint32_t,std::vector<b2b2c::nca::ddo::CSubAttrOptionDdo> > 

		/**
		 *  属性字典 
		 *
		 * 版本 >= 0
		 */
		var $vecAttrDic; //std::vector<b2b2c::nca::ddo::CAttrDdo> 


		 function __construct() {
			 $this->cVersion = 0; // uint8_t
			 $this->oNavNode = new NavEntryDdo(); // b2b2c::nca::ddo::CNavEntryDdo
			 $this->vecFullPath = new stl_vector('NavEntryDdo'); // std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
			 $this->vecMetaSearchPath = new stl_vector('NavEntryDdo'); // std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
			 $this->vecChildNode = new stl_vector('NavEntryDdo'); // std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
			 $this->mapChildAttrId = new stl_map('uint32_t,stl_vector<SubAttrOptionDdo> '); // std::map<uint32_t,std::vector<b2b2c::nca::ddo::CSubAttrOptionDdo> > 
			 $this->vecAttrDic = new stl_vector('AttrDdo'); // std::vector<b2b2c::nca::ddo::CAttrDdo> 
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint8_t($this->cVersion); // 序列化 版本号, version需要小写  类型为uint8_t
			$bs->pushObject($this->oNavNode,'NavEntryDdo'); // 序列化 导航信息  类型为b2b2c::nca::ddo::CNavEntryDdo
			$bs->pushObject($this->vecFullPath,'stl_vector'); // 序列化 导航路径  类型为std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
			$bs->pushObject($this->vecMetaSearchPath,'stl_vector'); // 序列化 搜索导航路径  类型为std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
			$bs->pushObject($this->vecChildNode,'stl_vector'); // 序列化 儿子导航  类型为std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
			$bs->pushObject($this->mapChildAttrId,'stl_map'); // 序列化 直接儿子属性  类型为std::map<uint32_t,std::vector<b2b2c::nca::ddo::CSubAttrOptionDdo> > 
			$bs->pushObject($this->vecAttrDic,'stl_vector'); // 序列化 属性字典  类型为std::vector<b2b2c::nca::ddo::CAttrDdo> 
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->cVersion = $bs->popUint8_t(); // 反序列化 版本号, version需要小写  类型为uint8_t
			$this->oNavNode = $bs->popObject('NavEntryDdo'); // 反序列化 导航信息  类型为b2b2c::nca::ddo::CNavEntryDdo
			$this->vecFullPath = $bs->popObject('stl_vector<NavEntryDdo>'); // 反序列化 导航路径  类型为std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
			$this->vecMetaSearchPath = $bs->popObject('stl_vector<NavEntryDdo>'); // 反序列化 搜索导航路径  类型为std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
			$this->vecChildNode = $bs->popObject('stl_vector<NavEntryDdo>'); // 反序列化 儿子导航  类型为std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
			$this->mapChildAttrId = $bs->popObject('stl_map<uint32_t,stl_vector<SubAttrOptionDdo> >'); // 反序列化 直接儿子属性  类型为std::map<uint32_t,std::vector<b2b2c::nca::ddo::CSubAttrOptionDdo> > 
			$this->vecAttrDic = $bs->popObject('stl_vector<AttrDdo>'); // 反序列化 属性字典  类型为std::vector<b2b2c::nca::ddo::CAttrDdo> 

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


//source idl: com.b2b2c.nca.idl.NcaDao.java

if (!class_exists('NavExDdo')) {
class NavExDdo
{
		/**
		 *  版本号, version需要小写 
		 *
		 * 版本 >= 0
		 */
		var $cVersion; //uint8_t

		/**
		 *  导航信息 
		 *
		 * 版本 >= 0
		 */
		var $oNavNode; //b2b2c::nca::ddo::CNavEntryDdo

		/**
		 *  导航路径 
		 *
		 * 版本 >= 0
		 */
		var $vecFullPath; //std::vector<b2b2c::nca::ddo::CNavEntryDdo> 

		/**
		 *  搜索导航路径 
		 *
		 * 版本 >= 0
		 */
		var $vecMetaSearchPath; //std::vector<b2b2c::nca::ddo::CNavEntryDdo> 

		/**
		 *  儿子导航 
		 *
		 * 版本 >= 0
		 */
		var $vecChildNode; //std::vector<b2b2c::nca::ddo::CNavEntryDdo> 

		/**
		 *  直接儿子属性 
		 *
		 * 版本 >= 0
		 */
		var $mapChildAttrId; //std::map<uint32_t,std::vector<b2b2c::nca::ddo::CSubAttrOptionDdo> > 

		/**
		 *  属性字典 
		 *
		 * 版本 >= 0
		 */
		var $mapAttrDic; //std::map<uint32_t,b2b2c::nca::ddo::CAttrDdo> 


		 function __construct() {
			 $this->cVersion = 0; // uint8_t
			 $this->oNavNode = new NavEntryDdo(); // b2b2c::nca::ddo::CNavEntryDdo
			 $this->vecFullPath = new stl_vector('NavEntryDdo'); // std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
			 $this->vecMetaSearchPath = new stl_vector('NavEntryDdo'); // std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
			 $this->vecChildNode = new stl_vector('NavEntryDdo'); // std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
			 $this->mapChildAttrId = new stl_map('uint32_t,stl_vector<SubAttrOptionDdo> '); // std::map<uint32_t,std::vector<b2b2c::nca::ddo::CSubAttrOptionDdo> > 
			 $this->mapAttrDic = new stl_map('uint32_t,AttrDdo'); // std::map<uint32_t,b2b2c::nca::ddo::CAttrDdo> 
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint8_t($this->cVersion); // 序列化 版本号, version需要小写  类型为uint8_t
			$bs->pushObject($this->oNavNode,'NavEntryDdo'); // 序列化 导航信息  类型为b2b2c::nca::ddo::CNavEntryDdo
			$bs->pushObject($this->vecFullPath,'stl_vector'); // 序列化 导航路径  类型为std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
			$bs->pushObject($this->vecMetaSearchPath,'stl_vector'); // 序列化 搜索导航路径  类型为std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
			$bs->pushObject($this->vecChildNode,'stl_vector'); // 序列化 儿子导航  类型为std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
			$bs->pushObject($this->mapChildAttrId,'stl_map'); // 序列化 直接儿子属性  类型为std::map<uint32_t,std::vector<b2b2c::nca::ddo::CSubAttrOptionDdo> > 
			$bs->pushObject($this->mapAttrDic,'stl_map'); // 序列化 属性字典  类型为std::map<uint32_t,b2b2c::nca::ddo::CAttrDdo> 
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->cVersion = $bs->popUint8_t(); // 反序列化 版本号, version需要小写  类型为uint8_t
			$this->oNavNode = $bs->popObject('NavEntryDdo'); // 反序列化 导航信息  类型为b2b2c::nca::ddo::CNavEntryDdo
			$this->vecFullPath = $bs->popObject('stl_vector<NavEntryDdo>'); // 反序列化 导航路径  类型为std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
			$this->vecMetaSearchPath = $bs->popObject('stl_vector<NavEntryDdo>'); // 反序列化 搜索导航路径  类型为std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
			$this->vecChildNode = $bs->popObject('stl_vector<NavEntryDdo>'); // 反序列化 儿子导航  类型为std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
			$this->mapChildAttrId = $bs->popObject('stl_map<uint32_t,stl_vector<SubAttrOptionDdo> >'); // 反序列化 直接儿子属性  类型为std::map<uint32_t,std::vector<b2b2c::nca::ddo::CSubAttrOptionDdo> > 
			$this->mapAttrDic = $bs->popObject('stl_map<uint32_t,AttrDdo>'); // 反序列化 属性字典  类型为std::map<uint32_t,b2b2c::nca::ddo::CAttrDdo> 

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


//source idl: com.b2b2c.nca.idl.NcaDao.java

if (!class_exists('NavDdo')) {
class NavDdo
{
		/**
		 *  版本号, version需要小写 
		 *
		 * 版本 >= 0
		 */
		var $cVersion; //uint8_t

		/**
		 *  导航信息 
		 *
		 * 版本 >= 0
		 */
		var $oNavNode; //b2b2c::nca::ddo::CNavEntryDdo

		/**
		 *  导航路径 
		 *
		 * 版本 >= 0
		 */
		var $vecFullPath; //std::vector<b2b2c::nca::ddo::CNavEntryDdo> 

		/**
		 *  搜索导航路径 
		 *
		 * 版本 >= 0
		 */
		var $vecMetaSearchPath; //std::vector<b2b2c::nca::ddo::CNavEntryDdo> 

		/**
		 *  儿子导航 
		 *
		 * 版本 >= 0
		 */
		var $vecChildNode; //std::vector<b2b2c::nca::ddo::CNavEntryDdo> 


		 function __construct() {
			 $this->cVersion = 0; // uint8_t
			 $this->oNavNode = new NavEntryDdo(); // b2b2c::nca::ddo::CNavEntryDdo
			 $this->vecFullPath = new stl_vector('NavEntryDdo'); // std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
			 $this->vecMetaSearchPath = new stl_vector('NavEntryDdo'); // std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
			 $this->vecChildNode = new stl_vector('NavEntryDdo'); // std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint8_t($this->cVersion); // 序列化 版本号, version需要小写  类型为uint8_t
			$bs->pushObject($this->oNavNode,'NavEntryDdo'); // 序列化 导航信息  类型为b2b2c::nca::ddo::CNavEntryDdo
			$bs->pushObject($this->vecFullPath,'stl_vector'); // 序列化 导航路径  类型为std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
			$bs->pushObject($this->vecMetaSearchPath,'stl_vector'); // 序列化 搜索导航路径  类型为std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
			$bs->pushObject($this->vecChildNode,'stl_vector'); // 序列化 儿子导航  类型为std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->cVersion = $bs->popUint8_t(); // 反序列化 版本号, version需要小写  类型为uint8_t
			$this->oNavNode = $bs->popObject('NavEntryDdo'); // 反序列化 导航信息  类型为b2b2c::nca::ddo::CNavEntryDdo
			$this->vecFullPath = $bs->popObject('stl_vector<NavEntryDdo>'); // 反序列化 导航路径  类型为std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
			$this->vecMetaSearchPath = $bs->popObject('stl_vector<NavEntryDdo>'); // 反序列化 搜索导航路径  类型为std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
			$this->vecChildNode = $bs->popObject('stl_vector<NavEntryDdo>'); // 反序列化 儿子导航  类型为std::vector<b2b2c::nca::ddo::CNavEntryDdo> 

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


//source idl: com.b2b2c.nca.idl.GetPublishInfoResp.java

if (!class_exists('NavBoEx_v3')) {
class NavBoEx_v3
{
		/**
		 * 版本号, version需要小写
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 导航信息
		 *
		 * 版本 >= 0
		 */
		var $oNavNode; //c2cent::bo::nca_v3::CNavEntry_v3

		/**
		 * 导航路径
		 *
		 * 版本 >= 0
		 */
		var $vecFullPath; //std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 

		/**
		 * 搜索导航路径
		 *
		 * 版本 >= 0
		 */
		var $vecMetaSearchPath; //std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 

		/**
		 * 儿子导航
		 *
		 * 版本 >= 0
		 */
		var $vecChildNode; //std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 

		/**
		 * 直接儿子属性
		 *
		 * 版本 >= 0
		 */
		var $mapChildAttrId; //std::map<uint32_t,std::vector<c2cent::bo::nca_v3::CSubAttrOption_v3> > 

		/**
		 * 属性字典
		 *
		 * 版本 >= 0
		 */
		var $mapAttrDic; //std::map<uint32_t,c2cent::bo::nca_v3::CAttrBo_v3> 


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->oNavNode = new NavEntry_v3(); // c2cent::bo::nca_v3::CNavEntry_v3
			 $this->vecFullPath = new stl_vector('NavEntry_v3'); // std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
			 $this->vecMetaSearchPath = new stl_vector('NavEntry_v3'); // std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
			 $this->vecChildNode = new stl_vector('NavEntry_v3'); // std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
			 $this->mapChildAttrId = new stl_map('uint32_t,stl_vector<SubAttrOption_v3> '); // std::map<uint32_t,std::vector<c2cent::bo::nca_v3::CSubAttrOption_v3> > 
			 $this->mapAttrDic = new stl_map('uint32_t,AttrBo_v3'); // std::map<uint32_t,c2cent::bo::nca_v3::CAttrBo_v3> 
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号, version需要小写 类型为uint32_t
			$bs->pushObject($this->oNavNode,'NavEntry_v3'); // 序列化导航信息 类型为c2cent::bo::nca_v3::CNavEntry_v3
			$bs->pushObject($this->vecFullPath,'stl_vector'); // 序列化导航路径 类型为std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
			$bs->pushObject($this->vecMetaSearchPath,'stl_vector'); // 序列化搜索导航路径 类型为std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
			$bs->pushObject($this->vecChildNode,'stl_vector'); // 序列化儿子导航 类型为std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
			$bs->pushObject($this->mapChildAttrId,'stl_map'); // 序列化直接儿子属性 类型为std::map<uint32_t,std::vector<c2cent::bo::nca_v3::CSubAttrOption_v3> > 
			$bs->pushObject($this->mapAttrDic,'stl_map'); // 序列化属性字典 类型为std::map<uint32_t,c2cent::bo::nca_v3::CAttrBo_v3> 
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号, version需要小写 类型为uint32_t
			$this->oNavNode = $bs->popObject('NavEntry_v3'); // 反序列化导航信息 类型为c2cent::bo::nca_v3::CNavEntry_v3
			$this->vecFullPath = $bs->popObject('stl_vector<NavEntry_v3>'); // 反序列化导航路径 类型为std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
			$this->vecMetaSearchPath = $bs->popObject('stl_vector<NavEntry_v3>'); // 反序列化搜索导航路径 类型为std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
			$this->vecChildNode = $bs->popObject('stl_vector<NavEntry_v3>'); // 反序列化儿子导航 类型为std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
			$this->mapChildAttrId = $bs->popObject('stl_map<uint32_t,stl_vector<SubAttrOption_v3> >'); // 反序列化直接儿子属性 类型为std::map<uint32_t,std::vector<c2cent::bo::nca_v3::CSubAttrOption_v3> > 
			$this->mapAttrDic = $bs->popObject('stl_map<uint32_t,AttrBo_v3>'); // 反序列化属性字典 类型为std::map<uint32_t,c2cent::bo::nca_v3::CAttrBo_v3> 

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


//source idl: com.b2b2c.nca.idl.NavBoEx_v3.java

if (!class_exists('NavEntry_v3')) {
class NavEntry_v3
{
		/**
		 * 版本号, version需要小写
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 导航id
		 *
		 * 版本 >= 0
		 */
		var $dwNavId; //uint32_t

		/**
		 * 地图id
		 *
		 * 版本 >= 0
		 */
		var $dwMapId; //uint32_t

		/**
		 * 父导航id
		 *
		 * 版本 >= 0
		 */
		var $dwPNavId; //uint32_t

		/**
		 * 导航名称
		 *
		 * 版本 >= 0
		 */
		var $strName; //std::string

		/**
		 * 导航类型
		 *
		 * 版本 >= 0
		 */
		var $dwType; //uint32_t

		/**
		 * 导航分类
		 *
		 * 版本 >= 0
		 */
		var $dwCatalog; //uint32_t

		/**
		 * 备注
		 *
		 * 版本 >= 0
		 */
		var $strNote; //std::string

		/**
		 * 排序字段
		 *
		 * 版本 >= 0
		 */
		var $dwOrder; //uint32_t

		/**
		 * 导航property
		 *
		 * 版本 >= 0
		 */
		var $strPropertyStr; //std::string

		/**
		 * 搜索条件
		 *
		 * 版本 >= 0
		 */
		var $strSearchCond; //std::string

		/**
		 * 是否有属性
		 *
		 * 版本 >= 0
		 */
		var $dwHasAttr; //uint32_t

		/**
		 * 导航预留自定义串1
		 *
		 * 版本 >= 0
		 */
		var $strCustomStr1; //std::string

		/**
		 * 导航预留自定义串2
		 *
		 * 版本 >= 0
		 */
		var $strCustomStr2; //std::string

		/**
		 *  metaclass type
		 *
		 * 版本 >= 0
		 */
		var $dwMetaCatalog; //uint32_t

		/**
		 * 导航预留自定义整形字段2
		 *
		 * 版本 >= 0
		 */
		var $dwCustomUint2; //uint32_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->dwNavId = 0; // uint32_t
			 $this->dwMapId = 0; // uint32_t
			 $this->dwPNavId = 0; // uint32_t
			 $this->strName = ""; // std::string
			 $this->dwType = 0; // uint32_t
			 $this->dwCatalog = 0; // uint32_t
			 $this->strNote = ""; // std::string
			 $this->dwOrder = 0; // uint32_t
			 $this->strPropertyStr = ""; // std::string
			 $this->strSearchCond = ""; // std::string
			 $this->dwHasAttr = 0; // uint32_t
			 $this->strCustomStr1 = ""; // std::string
			 $this->strCustomStr2 = ""; // std::string
			 $this->dwMetaCatalog = 0; // uint32_t
			 $this->dwCustomUint2 = 0; // uint32_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号, version需要小写 类型为uint32_t
			$bs->pushUint32_t($this->dwNavId); // 序列化导航id 类型为uint32_t
			$bs->pushUint32_t($this->dwMapId); // 序列化地图id 类型为uint32_t
			$bs->pushUint32_t($this->dwPNavId); // 序列化父导航id 类型为uint32_t
			$bs->pushString($this->strName); // 序列化导航名称 类型为std::string
			$bs->pushUint32_t($this->dwType); // 序列化导航类型 类型为uint32_t
			$bs->pushUint32_t($this->dwCatalog); // 序列化导航分类 类型为uint32_t
			$bs->pushString($this->strNote); // 序列化备注 类型为std::string
			$bs->pushUint32_t($this->dwOrder); // 序列化排序字段 类型为uint32_t
			$bs->pushString($this->strPropertyStr); // 序列化导航property 类型为std::string
			$bs->pushString($this->strSearchCond); // 序列化搜索条件 类型为std::string
			$bs->pushUint32_t($this->dwHasAttr); // 序列化是否有属性 类型为uint32_t
			$bs->pushString($this->strCustomStr1); // 序列化导航预留自定义串1 类型为std::string
			$bs->pushString($this->strCustomStr2); // 序列化导航预留自定义串2 类型为std::string
			$bs->pushUint32_t($this->dwMetaCatalog); // 序列化 metaclass type 类型为uint32_t
			$bs->pushUint32_t($this->dwCustomUint2); // 序列化导航预留自定义整形字段2 类型为uint32_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号, version需要小写 类型为uint32_t
			$this->dwNavId = $bs->popUint32_t(); // 反序列化导航id 类型为uint32_t
			$this->dwMapId = $bs->popUint32_t(); // 反序列化地图id 类型为uint32_t
			$this->dwPNavId = $bs->popUint32_t(); // 反序列化父导航id 类型为uint32_t
			$this->strName = $bs->popString(); // 反序列化导航名称 类型为std::string
			$this->dwType = $bs->popUint32_t(); // 反序列化导航类型 类型为uint32_t
			$this->dwCatalog = $bs->popUint32_t(); // 反序列化导航分类 类型为uint32_t
			$this->strNote = $bs->popString(); // 反序列化备注 类型为std::string
			$this->dwOrder = $bs->popUint32_t(); // 反序列化排序字段 类型为uint32_t
			$this->strPropertyStr = $bs->popString(); // 反序列化导航property 类型为std::string
			$this->strSearchCond = $bs->popString(); // 反序列化搜索条件 类型为std::string
			$this->dwHasAttr = $bs->popUint32_t(); // 反序列化是否有属性 类型为uint32_t
			$this->strCustomStr1 = $bs->popString(); // 反序列化导航预留自定义串1 类型为std::string
			$this->strCustomStr2 = $bs->popString(); // 反序列化导航预留自定义串2 类型为std::string
			$this->dwMetaCatalog = $bs->popUint32_t(); // 反序列化 metaclass type 类型为uint32_t
			$this->dwCustomUint2 = $bs->popUint32_t(); // 反序列化导航预留自定义整形字段2 类型为uint32_t

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


//source idl: com.b2b2c.nca.idl.GetPubPathResp.java

if (!class_exists('PublistNode_v3')) {
class PublistNode_v3
{
		/**
		 * 版本号, version需要小写
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 导航id
		 *
		 * 版本 >= 0
		 */
		var $dwNavId; //uint32_t

		/**
		 * 属性项id
		 *
		 * 版本 >= 0
		 */
		var $dwAttrId; //uint32_t

		/**
		 * 属性值id
		 *
		 * 版本 >= 0
		 */
		var $dwOptionId; //uint32_t

		/**
		 * 类型:1属性，3类目，4品类
		 *
		 * 版本 >= 0
		 */
		var $dwType; //uint32_t

		/**
		 * name
		 *
		 * 版本 >= 0
		 */
		var $strName; //std::string

		/**
		 * property
		 *
		 * 版本 >= 0
		 */
		var $strPropertyStr; //std::string

		/**
		 * 是否有后继节点
		 *
		 * 版本 >= 0
		 */
		var $dwAnyChildren; //uint32_t

		/**
		 * sDesc
		 *
		 * 版本 >= 0
		 */
		var $strDesc; //std::string


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->dwNavId = 0; // uint32_t
			 $this->dwAttrId = 0; // uint32_t
			 $this->dwOptionId = 0; // uint32_t
			 $this->dwType = 0; // uint32_t
			 $this->strName = ""; // std::string
			 $this->strPropertyStr = ""; // std::string
			 $this->dwAnyChildren = 0; // uint32_t
			 $this->strDesc = ""; // std::string
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号, version需要小写 类型为uint32_t
			$bs->pushUint32_t($this->dwNavId); // 序列化导航id 类型为uint32_t
			$bs->pushUint32_t($this->dwAttrId); // 序列化属性项id 类型为uint32_t
			$bs->pushUint32_t($this->dwOptionId); // 序列化属性值id 类型为uint32_t
			$bs->pushUint32_t($this->dwType); // 序列化类型:1属性，3类目，4品类 类型为uint32_t
			$bs->pushString($this->strName); // 序列化name 类型为std::string
			$bs->pushString($this->strPropertyStr); // 序列化property 类型为std::string
			$bs->pushUint32_t($this->dwAnyChildren); // 序列化是否有后继节点 类型为uint32_t
			$bs->pushString($this->strDesc); // 序列化sDesc 类型为std::string
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号, version需要小写 类型为uint32_t
			$this->dwNavId = $bs->popUint32_t(); // 反序列化导航id 类型为uint32_t
			$this->dwAttrId = $bs->popUint32_t(); // 反序列化属性项id 类型为uint32_t
			$this->dwOptionId = $bs->popUint32_t(); // 反序列化属性值id 类型为uint32_t
			$this->dwType = $bs->popUint32_t(); // 反序列化类型:1属性，3类目，4品类 类型为uint32_t
			$this->strName = $bs->popString(); // 反序列化name 类型为std::string
			$this->strPropertyStr = $bs->popString(); // 反序列化property 类型为std::string
			$this->dwAnyChildren = $bs->popUint32_t(); // 反序列化是否有后继节点 类型为uint32_t
			$this->strDesc = $bs->popString(); // 反序列化sDesc 类型为std::string

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


//source idl: com.b2b2c.nca.idl.GetOrderNavExResp.java

if (!class_exists('OrderNavBoEx_v3')) {
class OrderNavBoEx_v3
{
		/**
		 * 版本号, version需要小写
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 导航信息
		 *
		 * 版本 >= 0
		 */
		var $oNavNode; //c2cent::bo::nca_v3::CNavEntry_v3

		/**
		 * 导航路径
		 *
		 * 版本 >= 0
		 */
		var $vecFullPath; //std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 

		/**
		 * 搜索导航路径
		 *
		 * 版本 >= 0
		 */
		var $vecMetaSearchPath; //std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 

		/**
		 * 儿子导航
		 *
		 * 版本 >= 0
		 */
		var $vecChildNode; //std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 

		/**
		 * 直接儿子属性
		 *
		 * 版本 >= 0
		 */
		var $vecChildAttrId; //std::vector<std::vector<c2cent::bo::nca_v3::CSubAttrOption_v3> > 

		/**
		 * 属性字典
		 *
		 * 版本 >= 0
		 */
		var $mapAttrDic; //std::map<uint32_t,c2cent::bo::nca_v3::CAttrBo_v3> 


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->oNavNode = new NavEntry_v3(); // c2cent::bo::nca_v3::CNavEntry_v3
			 $this->vecFullPath = new stl_vector('NavEntry_v3'); // std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
			 $this->vecMetaSearchPath = new stl_vector('NavEntry_v3'); // std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
			 $this->vecChildNode = new stl_vector('NavEntry_v3'); // std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
			 $this->vecChildAttrId = new stl_vector('stl_vector<SubAttrOption_v3> '); // std::vector<std::vector<c2cent::bo::nca_v3::CSubAttrOption_v3> > 
			 $this->mapAttrDic = new stl_map('uint32_t,AttrBo_v3'); // std::map<uint32_t,c2cent::bo::nca_v3::CAttrBo_v3> 
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号, version需要小写 类型为uint32_t
			$bs->pushObject($this->oNavNode,'NavEntry_v3'); // 序列化导航信息 类型为c2cent::bo::nca_v3::CNavEntry_v3
			$bs->pushObject($this->vecFullPath,'stl_vector'); // 序列化导航路径 类型为std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
			$bs->pushObject($this->vecMetaSearchPath,'stl_vector'); // 序列化搜索导航路径 类型为std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
			$bs->pushObject($this->vecChildNode,'stl_vector'); // 序列化儿子导航 类型为std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
			$bs->pushObject($this->vecChildAttrId,'stl_vector'); // 序列化直接儿子属性 类型为std::vector<std::vector<c2cent::bo::nca_v3::CSubAttrOption_v3> > 
			$bs->pushObject($this->mapAttrDic,'stl_map'); // 序列化属性字典 类型为std::map<uint32_t,c2cent::bo::nca_v3::CAttrBo_v3> 
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号, version需要小写 类型为uint32_t
			$this->oNavNode = $bs->popObject('NavEntry_v3'); // 反序列化导航信息 类型为c2cent::bo::nca_v3::CNavEntry_v3
			$this->vecFullPath = $bs->popObject('stl_vector<NavEntry_v3>'); // 反序列化导航路径 类型为std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
			$this->vecMetaSearchPath = $bs->popObject('stl_vector<NavEntry_v3>'); // 反序列化搜索导航路径 类型为std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
			$this->vecChildNode = $bs->popObject('stl_vector<NavEntry_v3>'); // 反序列化儿子导航 类型为std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
			$this->vecChildAttrId = $bs->popObject('stl_vector<stl_vector<SubAttrOption_v3> >'); // 反序列化直接儿子属性 类型为std::vector<std::vector<c2cent::bo::nca_v3::CSubAttrOption_v3> > 
			$this->mapAttrDic = $bs->popObject('stl_map<uint32_t,AttrBo_v3>'); // 反序列化属性字典 类型为std::map<uint32_t,c2cent::bo::nca_v3::CAttrBo_v3> 

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


//source idl: com.b2b2c.nca.idl.GetNavResp.java

if (!class_exists('NavBo_v3')) {
class NavBo_v3
{
		/**
		 * 版本号, version需要小写
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 导航信息
		 *
		 * 版本 >= 0
		 */
		var $oNavNode; //c2cent::bo::nca_v3::CNavEntry_v3

		/**
		 * 导航路径
		 *
		 * 版本 >= 0
		 */
		var $vecFullPath; //std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 

		/**
		 * 搜索导航路径
		 *
		 * 版本 >= 0
		 */
		var $vecMetaSearchPath; //std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 

		/**
		 * 儿子导航
		 *
		 * 版本 >= 0
		 */
		var $vecChildNode; //std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->oNavNode = new NavEntry_v3(); // c2cent::bo::nca_v3::CNavEntry_v3
			 $this->vecFullPath = new stl_vector('NavEntry_v3'); // std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
			 $this->vecMetaSearchPath = new stl_vector('NavEntry_v3'); // std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
			 $this->vecChildNode = new stl_vector('NavEntry_v3'); // std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号, version需要小写 类型为uint32_t
			$bs->pushObject($this->oNavNode,'NavEntry_v3'); // 序列化导航信息 类型为c2cent::bo::nca_v3::CNavEntry_v3
			$bs->pushObject($this->vecFullPath,'stl_vector'); // 序列化导航路径 类型为std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
			$bs->pushObject($this->vecMetaSearchPath,'stl_vector'); // 序列化搜索导航路径 类型为std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
			$bs->pushObject($this->vecChildNode,'stl_vector'); // 序列化儿子导航 类型为std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号, version需要小写 类型为uint32_t
			$this->oNavNode = $bs->popObject('NavEntry_v3'); // 反序列化导航信息 类型为c2cent::bo::nca_v3::CNavEntry_v3
			$this->vecFullPath = $bs->popObject('stl_vector<NavEntry_v3>'); // 反序列化导航路径 类型为std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
			$this->vecMetaSearchPath = $bs->popObject('stl_vector<NavEntry_v3>'); // 反序列化搜索导航路径 类型为std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
			$this->vecChildNode = $bs->popObject('stl_vector<NavEntry_v3>'); // 反序列化儿子导航 类型为std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 

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