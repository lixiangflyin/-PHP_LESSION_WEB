<?php
// source idl: com.b2b2c.nca.idl.NcaDao.java
require_once "ncadao_xxo.php";

class GetAllMetaClassReq {
	var $Source;
	var $InReserve;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->InReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化Source 类型为std::string
		$bs->pushString($this->InReserve); // 序列化InReserve 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x53601805;
	}
}

class GetAllMetaClassResp {
	var $result;
	var $Nav;
	var $OutReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->Nav = $bs->popObject('stl_vector<NavEntry_v3>'); // 反序列化品类数据 类型为std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
		$this->OutReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x53608805;
	}
}

class GetAllMetaClass_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011805;
	}
}

class GetAllMetaClass_WGResp {
	var $result;
	var $errmsg;
	var $nav;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->nav = $bs->popObject('stl_vector<NavEntryDdo>'); // 反序列化品类数据 类型为std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018805;
	}
}

class GetAttrTextReq {
	var $Source;
	var $InReserve;
	var $MapId;
	var $NavId;
	var $InAttrBoList;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->InReserve = ""; // std::string
		 $this->MapId = 0; // uint32_t
		 $this->NavId = 0; // uint32_t
		 $this->InAttrBoList = new stl_vector('AttrBo_v3'); // std::vector<c2cent::bo::nca_v3::CAttrBo_v3> 
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化Source 类型为std::string
		$bs->pushString($this->InReserve); // 序列化InReserve 类型为std::string
		$bs->pushUint32_t($this->MapId); // 序列化地图id 类型为uint32_t
		$bs->pushUint32_t($this->NavId); // 序列化导航id 类型为uint32_t
		$bs->pushObject($this->InAttrBoList,'stl_vector'); // 序列化属性列表 类型为std::vector<c2cent::bo::nca_v3::CAttrBo_v3> 

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x5360180a;
	}
}

class GetAttrTextResp {
	var $result;
	var $OutAttrBoList;
	var $OutReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->OutAttrBoList = $bs->popObject('stl_vector<AttrBo_v3>'); // 反序列化属性列表 类型为std::vector<c2cent::bo::nca_v3::CAttrBo_v3> 
		$this->OutReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x5360880a;
	}
}

class GetAttrText_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $mapId;
	var $navId;
	var $inAttrBoList;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->mapId = 0; // uint32_t
		 $this->navId = 0; // uint32_t
		 $this->inAttrBoList = new stl_vector('AttrDdo'); // std::vector<b2b2c::nca::ddo::CAttrDdo> 
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->mapId); // 序列化地图id，必填 类型为uint32_t
		$bs->pushUint32_t($this->navId); // 序列化导航id，必填 类型为uint32_t
		$bs->pushObject($this->inAttrBoList,'stl_vector'); // 序列化属性列表，必填 类型为std::vector<b2b2c::nca::ddo::CAttrDdo> 
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA001180a;
	}
}

class GetAttrText_WGResp {
	var $result;
	var $errmsg;
	var $outAttrBoList;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outAttrBoList = $bs->popObject('stl_vector<AttrDdo>'); // 反序列化属性列表 类型为std::vector<b2b2c::nca::ddo::CAttrDdo> 
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA001880a;
	}
}

class GetGroupNavReq {
	var $Source;
	var $InReserve;
	var $MapId;
	var $GroupId;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->InReserve = ""; // std::string
		 $this->MapId = 0; // uint32_t
		 $this->GroupId = 0; // uint32_t
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化Source 类型为std::string
		$bs->pushString($this->InReserve); // 序列化InReserve 类型为std::string
		$bs->pushUint32_t($this->MapId); // 序列化地图id 类型为uint32_t
		$bs->pushUint32_t($this->GroupId); // 序列化业务号,即数据文件中mty标识的数字 类型为uint32_t

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x5360180f;
	}
}

class GetGroupNavResp {
	var $result;
	var $NavList;
	var $OutReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->NavList = $bs->popObject('stl_vector<NavBo_v3>'); // 反序列化业务下所有的导航数据 类型为std::vector<c2cent::bo::nca_v3::CNavBo_v3> 
		$this->OutReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x5360880f;
	}
}

class GetMetaByCatalogReq {
	var $Source;
	var $InReserve;
	var $Catalog;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->InReserve = ""; // std::string
		 $this->Catalog = 0; // uint32_t
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化Source 类型为std::string
		$bs->pushString($this->InReserve); // 序列化InReserve 类型为std::string
		$bs->pushUint32_t($this->Catalog); // 序列化分类 类型为uint32_t

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x53601806;
	}
}

class GetMetaByCatalogResp {
	var $result;
	var $Nav;
	var $OutReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->Nav = $bs->popObject('stl_vector<NavEntry_v3>'); // 反序列化品类数据 类型为std::vector<c2cent::bo::nca_v3::CNavEntry_v3> 
		$this->OutReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x53608806;
	}
}

class GetMetaByCatalog_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $catalog;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->catalog = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->catalog); // 序列化分类，必填 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011806;
	}
}

class GetMetaByCatalog_WGResp {
	var $result;
	var $errmsg;
	var $nav;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->nav = $bs->popObject('stl_vector<NavEntryDdo>'); // 反序列化品类数据 类型为std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018806;
	}
}

class GetMetaClassReq {
	var $Source;
	var $InReserve;
	var $MetaId;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->InReserve = ""; // std::string
		 $this->MetaId = 0; // uint32_t
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化Source 类型为std::string
		$bs->pushString($this->InReserve); // 序列化InReserve 类型为std::string
		$bs->pushUint32_t($this->MetaId); // 序列化品类id 类型为uint32_t

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x53601801;
	}
}

class GetMetaClassResp {
	var $result;
	var $Meta;
	var $OutReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->Meta = $bs->popObject('NavBo_v3'); // 反序列化品类数据 类型为c2cent::bo::nca_v3::CNavBo_v3
		$this->OutReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x53608801;
	}
}

class GetMetaClassAttrDic_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $metaId;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->metaId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->metaId); // 序列化品类id，必填 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011811;
	}
}

class GetMetaClassAttrDic_WGResp {
	var $result;
	var $errmsg;
	var $attrDic;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->attrDic = $bs->popObject('stl_map<uint32_t,AttrDdo>'); // 反序列化品类属性字典 类型为std::map<uint32_t,b2b2c::nca::ddo::CAttrDdo> 
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018811;
	}
}

class GetMetaClassExReq {
	var $Source;
	var $InReserve;
	var $MetaId;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->InReserve = ""; // std::string
		 $this->MetaId = 0; // uint32_t
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化Source 类型为std::string
		$bs->pushString($this->InReserve); // 序列化InReserve 类型为std::string
		$bs->pushUint32_t($this->MetaId); // 序列化品类id 类型为uint32_t

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x53601802;
	}
}

class GetMetaClassExResp {
	var $result;
	var $Meta;
	var $OutReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->Meta = $bs->popObject('NavBoEx_v3'); // 反序列化品类数据 类型为c2cent::bo::nca_v3::CNavBoEx_v3
		$this->OutReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x53608802;
	}
}

class GetMetaClassEx_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $metaId;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->metaId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->metaId); // 序列化品类id，必填 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011802;
	}
}

class GetMetaClassEx_WGResp {
	var $result;
	var $errmsg;
	var $meta;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->meta = $bs->popObject('NavExDdo'); // 反序列化品类数据 类型为b2b2c::nca::ddo::CNavExDdo
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018802;
	}
}

class GetMetaClass_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $metaId;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->metaId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->metaId); // 序列化品类Id，必填 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011801;
	}
}

class GetMetaClass_WGResp {
	var $result;
	var $errmsg;
	var $meta;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->meta = $bs->popObject('NavDdo'); // 反序列化品类数据 类型为b2b2c::nca::ddo::CNavDdo
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018801;
	}
}

class GetMetaV2_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $pubMapId;
	var $searchMapId;
	var $metaId;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->pubMapId = 0; // uint32_t
		 $this->searchMapId = 0; // uint32_t
		 $this->metaId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->pubMapId); // 序列化发布地图id，必填 类型为uint32_t
		$bs->pushUint32_t($this->searchMapId); // 序列化搜索地图id，必填 类型为uint32_t
		$bs->pushUint32_t($this->metaId); // 序列化品类id，必填 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011818;
	}
}

class GetMetaV2_WGResp {
	var $result;
	var $errmsg;
	var $meta;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->meta = $bs->popObject('NavDdo'); // 反序列化品类数据 类型为b2b2c::nca::ddo::CNavDdo
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018818;
	}
}

class GetMeta_ALLReq {
	var $machineKey;
	var $source;
	var $APIControl;
	var $MetaId;
	var $NeedAttrDic;
	var $AttrOnly;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->APIControl = new APIControl(); // b2b2c::nca::ddo::CAPIControl
		 $this->MetaId = 0; // uint32_t
		 $this->NeedAttrDic = 0; // uint32_t
		 $this->AttrOnly = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushObject($this->APIControl,'APIControl'); // 序列化调用控制，业务相关 类型为b2b2c::nca::ddo::CAPIControl
		$bs->pushUint32_t($this->MetaId); // 序列化品类Id 类型为uint32_t
		$bs->pushUint32_t($this->NeedAttrDic); // 序列化是否需要填充属性字典 类型为uint32_t
		$bs->pushUint32_t($this->AttrOnly); // 序列化属性字典中是否只需要属性项，而不需要属性值 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011820;
	}
}

class GetMeta_ALLResp {
	var $result;
	var $errmsg;
	var $Meta;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->Meta = $bs->popObject('NavExDdo'); // 反序列化品类数据 类型为b2b2c::nca::ddo::CNavExDdo
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018820;
	}
}

class GetMetas_ALLReq {
	var $machineKey;
	var $source;
	var $APIControl;
	var $MetaId;
	var $NeedAttrDic;
	var $AttrOnly;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->APIControl = new APIControl(); // b2b2c::nca::ddo::CAPIControl
		 $this->MetaId = new stl_set('uint32_t'); // std::set<uint32_t> 
		 $this->NeedAttrDic = 0; // uint32_t
		 $this->AttrOnly = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushObject($this->APIControl,'APIControl'); // 序列化调用控制，业务相关 类型为b2b2c::nca::ddo::CAPIControl
		$bs->pushObject($this->MetaId,'stl_set'); // 序列化品类Id，批量，不填表示获取全部的品类 类型为std::set<uint32_t> 
		$bs->pushUint32_t($this->NeedAttrDic); // 序列化是否需要填充属性字典 类型为uint32_t
		$bs->pushUint32_t($this->AttrOnly); // 序列化属性字典中是否只需要属性项，而不需要属性值 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011821;
	}
}

class GetMetas_ALLResp {
	var $result;
	var $errmsg;
	var $Meta;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->Meta = $bs->popObject('stl_map<uint32_t,NavExDdo>'); // 反序列化品类数据 类型为std::map<uint32_t,b2b2c::nca::ddo::CNavExDdo> 
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018821;
	}
}

class GetMultiFullPath_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $mapId;
	var $metaId;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->mapId = 0; // uint32_t
		 $this->metaId = new stl_set('uint32_t'); // std::set<uint32_t> 
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->mapId); // 序列化地图id，必填 类型为uint32_t
		$bs->pushObject($this->metaId,'stl_set'); // 序列化品类id，必填，一次最多300个 类型为std::set<uint32_t> 
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011816;
	}
}

class GetMultiFullPath_WGResp {
	var $result;
	var $errmsg;
	var $fullPath;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->fullPath = $bs->popObject('stl_map<uint32_t,stl_vector<NavEntryDdo> >'); // 反序列化key是品类id，Value是对应的全路径 类型为std::map<uint32_t,std::vector<b2b2c::nca::ddo::CNavEntryDdo> > 
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018816;
	}
}

class GetNavReq {
	var $Source;
	var $InReserve;
	var $MapId;
	var $NavId;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->InReserve = ""; // std::string
		 $this->MapId = 0; // uint32_t
		 $this->NavId = 0; // uint32_t
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化Source 类型为std::string
		$bs->pushString($this->InReserve); // 序列化InReserve 类型为std::string
		$bs->pushUint32_t($this->MapId); // 序列化地图id 类型为uint32_t
		$bs->pushUint32_t($this->NavId); // 序列化导航id 类型为uint32_t

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x53601803;
	}
}

class GetNavResp {
	var $result;
	var $Nav;
	var $OutReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->Nav = $bs->popObject('NavBo_v3'); // 反序列化导航数据 类型为c2cent::bo::nca_v3::CNavBo_v3
		$this->OutReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x53608803;
	}
}

class GetNavAttrOp_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $mapId;
	var $metaId;
	var $attrId;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->mapId = 0; // uint32_t
		 $this->metaId = 0; // uint32_t
		 $this->attrId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->mapId); // 序列化地图id，必填 类型为uint32_t
		$bs->pushUint32_t($this->metaId); // 序列化品类id，必填 类型为uint32_t
		$bs->pushUint32_t($this->attrId); // 序列化属性项id 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011817;
	}
}

class GetNavAttrOp_WGResp {
	var $result;
	var $errmsg;
	var $attr;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->attr = $bs->popObject('AttrDdo'); // 反序列化属性实体里有导航属性关系里所有属性值 类型为b2b2c::nca::ddo::CAttrDdo
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018817;
	}
}

class GetNavExReq {
	var $Source;
	var $InReserve;
	var $MapId;
	var $NavId;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->InReserve = ""; // std::string
		 $this->MapId = 0; // uint32_t
		 $this->NavId = 0; // uint32_t
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化Source 类型为std::string
		$bs->pushString($this->InReserve); // 序列化InReserve 类型为std::string
		$bs->pushUint32_t($this->MapId); // 序列化地图id 类型为uint32_t
		$bs->pushUint32_t($this->NavId); // 序列化导航id 类型为uint32_t

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x53601804;
	}
}

class GetNavExResp {
	var $result;
	var $Nav;
	var $OutReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->Nav = $bs->popObject('NavBoEx_v3'); // 反序列化导航数据 类型为c2cent::bo::nca_v3::CNavBoEx_v3
		$this->OutReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x53608804;
	}
}

class GetNavExOrder_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $mapId;
	var $navId;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->mapId = 0; // uint32_t
		 $this->navId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->mapId); // 序列化地图id，必填 类型为uint32_t
		$bs->pushUint32_t($this->navId); // 序列化导航id，必填 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011815;
	}
}

class GetNavExOrder_WGResp {
	var $result;
	var $errmsg;
	var $navOrder;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->navOrder = $bs->popObject('NavExOrderDdo'); // 反序列化导航数据 类型为b2b2c::nca::ddo::CNavExOrderDdo
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018815;
	}
}

class GetNavEx_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $mapId;
	var $navId;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->mapId = 0; // uint32_t
		 $this->navId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->mapId); // 序列化地图id，必填 类型为uint32_t
		$bs->pushUint32_t($this->navId); // 序列化导航id，必填 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011804;
	}
}

class GetNavEx_WGResp {
	var $result;
	var $errmsg;
	var $nav;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->nav = $bs->popObject('NavExDdo'); // 反序列化导航数据 类型为b2b2c::nca::ddo::CNavExDdo
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018804;
	}
}

class GetNav_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $mapId;
	var $navId;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->mapId = 0; // uint32_t
		 $this->navId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->mapId); // 序列化地图id，必填 类型为uint32_t
		$bs->pushUint32_t($this->navId); // 序列化导航id，必填 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011803;
	}
}

class GetNav_WGResp {
	var $result;
	var $errmsg;
	var $nav;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->nav = $bs->popObject('NavDdo'); // 反序列化导航数据 类型为b2b2c::nca::ddo::CNavDdo
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018803;
	}
}

class GetOrderNavExReq {
	var $Source;
	var $InReserve;
	var $MapId;
	var $NavId;
	var $OrderType;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->InReserve = ""; // std::string
		 $this->MapId = 0; // uint32_t
		 $this->NavId = 0; // uint32_t
		 $this->OrderType = 0; // uint32_t
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化Source 类型为std::string
		$bs->pushString($this->InReserve); // 序列化InReserve 类型为std::string
		$bs->pushUint32_t($this->MapId); // 序列化地图id 类型为uint32_t
		$bs->pushUint32_t($this->NavId); // 序列化导航id 类型为uint32_t
		$bs->pushUint32_t($this->OrderType); // 序列化排序方法 1表示按照order字段升序排序 类型为uint32_t

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x53601810;
	}
}

class GetOrderNavExResp {
	var $result;
	var $Nav;
	var $OutReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->Nav = $bs->popObject('OrderNavBoEx_v3'); // 反序列化导航数据 类型为c2cent::bo::nca_v3::COrderNavBoEx_v3
		$this->OutReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x53608810;
	}
}

class GetPathByNavId_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $mapId;
	var $navId;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->mapId = 0; // uint32_t
		 $this->navId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->mapId); // 序列化地图id，必填 类型为uint32_t
		$bs->pushUint32_t($this->navId); // 序列化导航id，必填 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA001180f;
	}
}

class GetPathByNavId_WGResp {
	var $result;
	var $errmsg;
	var $fullPath;
	var $childNav;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->fullPath = $bs->popObject('stl_vector<NavEntryDdo>'); // 反序列化导航路径 类型为std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
		$this->childNav = $bs->popObject('stl_vector<NavEntryDdo>'); // 反序列化子节点集合 类型为std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA001880f;
	}
}

class GetPubNav_ALLReq {
	var $machineKey;
	var $source;
	var $APIControl;
	var $NavId;
	var $NeedAttrDic;
	var $AttrOnly;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->APIControl = new APIControl(); // b2b2c::nca::ddo::CAPIControl
		 $this->NavId = 0; // uint32_t
		 $this->NeedAttrDic = 0; // uint32_t
		 $this->AttrOnly = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushObject($this->APIControl,'APIControl'); // 序列化调用控制，业务相关 类型为b2b2c::nca::ddo::CAPIControl
		$bs->pushUint32_t($this->NavId); // 序列化导航Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->NeedAttrDic); // 序列化是否需要填充属性字典。叶子导航是品类，这个时候是有属性的 类型为uint32_t
		$bs->pushUint32_t($this->AttrOnly); // 序列化属性字典中是否只需要属性项，而不需要属性值 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011822;
	}
}

class GetPubNav_ALLResp {
	var $result;
	var $errmsg;
	var $Nav;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->Nav = $bs->popObject('NavExDdo'); // 反序列化品类数据 类型为b2b2c::nca::ddo::CNavExDdo
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018822;
	}
}

class GetPubNavs_ALLReq {
	var $machineKey;
	var $source;
	var $APIControl;
	var $NavId;
	var $NeedAttrDic;
	var $AttrOnly;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->APIControl = new APIControl(); // b2b2c::nca::ddo::CAPIControl
		 $this->NavId = new stl_set('uint32_t'); // std::set<uint32_t> 
		 $this->NeedAttrDic = 0; // uint32_t
		 $this->AttrOnly = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushObject($this->APIControl,'APIControl'); // 序列化调用控制，业务相关 类型为b2b2c::nca::ddo::CAPIControl
		$bs->pushObject($this->NavId,'stl_set'); // 序列化导航Id，批量，必填 类型为std::set<uint32_t> 
		$bs->pushUint32_t($this->NeedAttrDic); // 序列化是否需要填充属性字典。叶子导航是品类，这个时候是有属性的 类型为uint32_t
		$bs->pushUint32_t($this->AttrOnly); // 序列化属性字典中是否只需要属性项，而不需要属性值 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011823;
	}
}

class GetPubNavs_ALLResp {
	var $result;
	var $errmsg;
	var $Nav;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->Nav = $bs->popObject('stl_map<uint32_t,NavExDdo>'); // 反序列化品类数据 类型为std::map<uint32_t,b2b2c::nca::ddo::CNavExDdo> 
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018823;
	}
}

class GetPubPathReq {
	var $Source;
	var $InReserve;
	var $NavId;
	var $AttrId;
	var $OptionId;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->InReserve = ""; // std::string
		 $this->NavId = 0; // uint32_t
		 $this->AttrId = 0; // uint32_t
		 $this->OptionId = 0; // uint32_t
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化Source 类型为std::string
		$bs->pushString($this->InReserve); // 序列化InReserve 类型为std::string
		$bs->pushUint32_t($this->NavId); // 序列化导航id 类型为uint32_t
		$bs->pushUint32_t($this->AttrId); // 序列化属性项id 类型为uint32_t
		$bs->pushUint32_t($this->OptionId); // 序列化属性值id 类型为uint32_t

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x5360180e;
	}
}

class GetPubPathResp {
	var $result;
	var $SubNode;
	var $OutReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->SubNode = $bs->popObject('stl_vector<PublistNode_v3>'); // 反序列化发布路径节点数据 类型为std::vector<c2cent::bo::nca_v3::CPublistNode_v3> 
		$this->OutReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x5360880e;
	}
}

class GetPubPath_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $navId;
	var $attrId;
	var $optionId;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->navId = 0; // uint32_t
		 $this->attrId = 0; // uint32_t
		 $this->optionId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->navId); // 序列化 导航id，必填 类型为uint32_t
		$bs->pushUint32_t($this->attrId); // 序列化 属性项id，必填 类型为uint32_t
		$bs->pushUint32_t($this->optionId); // 序列化 属性值id，必填 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA001180e;
	}
}

class GetPubPath_WGResp {
	var $result;
	var $errmsg;
	var $subNode;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->subNode = $bs->popObject('stl_vector<PublistNodeDdo>'); // 反序列化发布路径节点数据 类型为std::vector<b2b2c::nca::ddo::CPublistNodeDdo> 
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA001880e;
	}
}

class GetPublishInfoReq {
	var $Source;
	var $InReserve;
	var $MetaClassId;
	var $ClassPath;
	var $AttrPath;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->InReserve = ""; // std::string
		 $this->MetaClassId = 0; // uint32_t
		 $this->ClassPath = ""; // std::string
		 $this->AttrPath = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化Source 类型为std::string
		$bs->pushString($this->InReserve); // 序列化InReserve 类型为std::string
		$bs->pushUint32_t($this->MetaClassId); // 序列化类目id 类型为uint32_t
		$bs->pushString($this->ClassPath); // 序列化非空则取一级属性 类型为std::string
		$bs->pushString($this->AttrPath); // 序列化属性串 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x5360180d;
	}
}

class GetPublishInfoResp {
	var $result;
	var $Nav;
	var $OutReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->Nav = $bs->popObject('NavBoEx_v3'); // 反序列化导航数据 类型为c2cent::bo::nca_v3::CNavBoEx_v3
		$this->OutReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x5360880d;
	}
}

class GetPublishInfo_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $metaClassId;
	var $classPath;
	var $attrPath;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->metaClassId = 0; // uint32_t
		 $this->classPath = ""; // std::string
		 $this->attrPath = ""; // std::string
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->metaClassId); // 序列化类目id，必填 类型为uint32_t
		$bs->pushString($this->classPath); // 序列化非空则取一级属性，必填 类型为std::string
		$bs->pushString($this->attrPath); // 序列化属性串，必填 类型为std::string
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA001180d;
	}
}

class GetPublishInfo_WGResp {
	var $result;
	var $errmsg;
	var $nav;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->nav = $bs->popObject('NavExDdo'); // 反序列化导航数据 类型为b2b2c::nca::ddo::CNavExDdo
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA001880d;
	}
}

class GetSearchInfo4SX_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $mapId;
	var $metaId;
	var $attrIn;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->mapId = 0; // uint32_t
		 $this->metaId = 0; // uint32_t
		 $this->attrIn = new stl_map('uint32_t,stl_set<uint32_t> '); // std::map<uint32_t,std::set<uint32_t> > 
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->mapId); // 序列化地图id，必填 类型为uint32_t
		$bs->pushUint32_t($this->metaId); // 序列化品类id，必填 类型为uint32_t
		$bs->pushObject($this->attrIn,'stl_map'); // 序列化入参过滤值，key是属性项id，value是值id的集合，必填 类型为std::map<uint32_t,std::set<uint32_t> > 
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0021801;
	}
}

class GetSearchInfo4SX_WGResp {
	var $result;
	var $errmsg;
	var $attrOut;
	var $brotherNode;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->attrOut = $bs->popObject('stl_vector<AttrDdo>'); // 反序列化排序的属性项 类型为std::vector<b2b2c::nca::ddo::CAttrDdo> 
		$this->brotherNode = $bs->popObject('stl_map<uint32_t,stl_vector<NavEntryDdo> >'); // 反序列化key是面包屑每级的导航id，Value是面包屑每级的兄弟节点列表 类型为std::map<uint32_t,std::vector<b2b2c::nca::ddo::CNavEntryDdo> > 
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0028801;
	}
}

class GetSearchNav_ALLReq {
	var $machineKey;
	var $source;
	var $APIControl;
	var $NavId;
	var $NeedAttrDic;
	var $AttrOnly;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->APIControl = new APIControl(); // b2b2c::nca::ddo::CAPIControl
		 $this->NavId = 0; // uint32_t
		 $this->NeedAttrDic = 0; // uint32_t
		 $this->AttrOnly = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushObject($this->APIControl,'APIControl'); // 序列化调用控制，业务相关 类型为b2b2c::nca::ddo::CAPIControl
		$bs->pushUint32_t($this->NavId); // 序列化导航Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->NeedAttrDic); // 序列化是否需要填充属性字典。叶子导航是品类，这个时候是有属性的 类型为uint32_t
		$bs->pushUint32_t($this->AttrOnly); // 序列化属性字典中是否只需要属性项，而不需要属性值 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011824;
	}
}

class GetSearchNav_ALLResp {
	var $result;
	var $errmsg;
	var $Nav;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->Nav = $bs->popObject('NavExDdo'); // 反序列化品类数据 类型为b2b2c::nca::ddo::CNavExDdo
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018824;
	}
}

class GetSearchNavs_ALLReq {
	var $machineKey;
	var $source;
	var $APIControl;
	var $NavId;
	var $NeedAttrDic;
	var $AttrOnly;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->APIControl = new APIControl(); // b2b2c::nca::ddo::CAPIControl
		 $this->NavId = new stl_set('uint32_t'); // std::set<uint32_t> 
		 $this->NeedAttrDic = 0; // uint32_t
		 $this->AttrOnly = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushObject($this->APIControl,'APIControl'); // 序列化调用控制，业务相关 类型为b2b2c::nca::ddo::CAPIControl
		$bs->pushObject($this->NavId,'stl_set'); // 序列化导航Id，批量，必填 类型为std::set<uint32_t> 
		$bs->pushUint32_t($this->NeedAttrDic); // 序列化是否需要填充属性字典。叶子导航是品类，这个时候是有属性的 类型为uint32_t
		$bs->pushUint32_t($this->AttrOnly); // 序列化属性字典中是否只需要属性项，而不需要属性值 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011825;
	}
}

class GetSearchNavs_ALLResp {
	var $result;
	var $errmsg;
	var $Nav;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->Nav = $bs->popObject('stl_map<uint32_t,NavExDdo>'); // 反序列化品类数据 类型为std::map<uint32_t,b2b2c::nca::ddo::CNavExDdo> 
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018825;
	}
}

class GetStaticAttrReq {
	var $Source;
	var $InReserve;
	var $AttrId;
	var $IsNeedOptions;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->InReserve = ""; // std::string
		 $this->AttrId = 0; // uint32_t
		 $this->IsNeedOptions = 0; // uint32_t
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化Source 类型为std::string
		$bs->pushString($this->InReserve); // 序列化InReserve 类型为std::string
		$bs->pushUint32_t($this->AttrId); // 序列化属性项Id 类型为uint32_t
		$bs->pushUint32_t($this->IsNeedOptions); // 序列化是否需要属性值,0:不需要,1：需要 类型为uint32_t

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x53601807;
	}
}

class GetStaticAttrResp {
	var $result;
	var $Attr;
	var $OutReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->Attr = $bs->popObject('AttrBo_v3'); // 反序列化属性项 类型为c2cent::bo::nca_v3::CAttrBo_v3
		$this->OutReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x53608807;
	}
}

class GetStaticAttrOp_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $attrId;
	var $OptionId;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->attrId = 0; // uint32_t
		 $this->OptionId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->attrId); // 序列化属性项Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->OptionId); // 序列化指定属性值id 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011814;
	}
}

class GetStaticAttrOp_WGResp {
	var $result;
	var $errmsg;
	var $attr;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->attr = $bs->popObject('AttrDdo'); // 反序列化属性项 类型为b2b2c::nca::ddo::CAttrDdo
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018814;
	}
}

class GetStaticAttr_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $attrId;
	var $isNeedOptions;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->attrId = 0; // uint32_t
		 $this->isNeedOptions = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->attrId); // 序列化属性项Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->isNeedOptions); // 序列化是否需要属性值，必填;0:不需要,1：需要  类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011807;
	}
}

class GetStaticAttr_WGResp {
	var $result;
	var $errmsg;
	var $attr;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->attr = $bs->popObject('AttrDdo'); // 反序列化属性项 类型为b2b2c::nca::ddo::CAttrDdo
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018807;
	}
}

class IsAttrStrValidReq {
	var $Source;
	var $InReserve;
	var $MapId;
	var $NavId;
	var $AttrString;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->InReserve = ""; // std::string
		 $this->MapId = 0; // uint32_t
		 $this->NavId = 0; // uint32_t
		 $this->AttrString = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化Source 类型为std::string
		$bs->pushString($this->InReserve); // 序列化InReserve 类型为std::string
		$bs->pushUint32_t($this->MapId); // 序列化地图id 类型为uint32_t
		$bs->pushUint32_t($this->NavId); // 序列化导航id 类型为uint32_t
		$bs->pushString($this->AttrString); // 序列化属性串 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x5360180b;
	}
}

class IsAttrStrValidResp {
	var $result;
	var $sReason;
	var $OutReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->sReason = $bs->popString(); // 反序列化错误消息 类型为std::string
		$this->OutReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x5360880b;
	}
}

class IsAttrStrValid_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $mapId;
	var $navId;
	var $attrString;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->mapId = 0; // uint32_t
		 $this->navId = 0; // uint32_t
		 $this->attrString = ""; // std::string
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->mapId); // 序列化地图id，必填 类型为uint32_t
		$bs->pushUint32_t($this->navId); // 序列化导航id，必填 类型为uint32_t
		$bs->pushString($this->attrString); // 序列化属性串，必填 类型为std::string
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA001180b;
	}
}

class IsAttrStrValid_WGResp {
	var $result;
	var $errmsg;
	var $reason;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->reason = $bs->popString(); // 反序列化错误消息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA001880b;
	}
}

class MakeAttrTextReq {
	var $Source;
	var $InReserve;
	var $MapId;
	var $NavId;
	var $AttrBoList;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->InReserve = ""; // std::string
		 $this->MapId = 0; // uint32_t
		 $this->NavId = 0; // uint32_t
		 $this->AttrBoList = new stl_vector('AttrBo_v3'); // std::vector<c2cent::bo::nca_v3::CAttrBo_v3> 
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化Source 类型为std::string
		$bs->pushString($this->InReserve); // 序列化InReserve 类型为std::string
		$bs->pushUint32_t($this->MapId); // 序列化地图id 类型为uint32_t
		$bs->pushUint32_t($this->NavId); // 序列化导航id 类型为uint32_t
		$bs->pushObject($this->AttrBoList,'stl_vector'); // 序列化属性结构体列表 类型为std::vector<c2cent::bo::nca_v3::CAttrBo_v3> 

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x53601808;
	}
}

class MakeAttrTextResp {
	var $result;
	var $AttrString;
	var $OutReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->AttrString = $bs->popString(); // 反序列化属性串 类型为std::string
		$this->OutReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x53608808;
	}
}

class MakeAttrText_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $mapId;
	var $navId;
	var $attrBoList;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->mapId = 0; // uint32_t
		 $this->navId = 0; // uint32_t
		 $this->attrBoList = new stl_vector('AttrDdo'); // std::vector<b2b2c::nca::ddo::CAttrDdo> 
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->mapId); // 序列化地图id，必填 类型为uint32_t
		$bs->pushUint32_t($this->navId); // 序列化导航id，必填 类型为uint32_t
		$bs->pushObject($this->attrBoList,'stl_vector'); // 序列化 属性结构体列表  类型为std::vector<b2b2c::nca::ddo::CAttrDdo> 
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011808;
	}
}

class MakeAttrText_WGResp {
	var $result;
	var $errmsg;
	var $attrString;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->attrString = $bs->popString(); // 反序列化属性串 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018808;
	}
}

class ParseAttr4SXOnly_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $mapId;
	var $metaId;
	var $saleAttrsIn;
	var $commAttrsIn;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->mapId = 0; // uint32_t
		 $this->metaId = 0; // uint32_t
		 $this->saleAttrsIn = new stl_map('uint32_t,stl_vector<uint32_t> '); // std::map<uint32_t,std::vector<uint32_t> > 
		 $this->commAttrsIn = new stl_map('uint32_t,stl_string'); // std::map<uint32_t,std::string> 
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->mapId); // 序列化地图id，必填 类型为uint32_t
		$bs->pushUint32_t($this->metaId); // 序列化品类id，必填 类型为uint32_t
		$bs->pushObject($this->saleAttrsIn,'stl_map'); // 序列化解析销售属性，key是属性项id，值是需要解释的项id的集合，必填 类型为std::map<uint32_t,std::vector<uint32_t> > 
		$bs->pushObject($this->commAttrsIn,'stl_map'); // 序列化解析一般展示属性，传进来是个属性id串,key作为这个串的标志，不限定是什么值，必填 类型为std::map<uint32_t,std::string> 
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0021810;
	}
}

class ParseAttr4SXOnly_WGResp {
	var $result;
	var $errmsg;
	var $fullPath;
	var $saleAttrsOut;
	var $commAttrsOut;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->fullPath = $bs->popObject('stl_vector<NavEntryDdo>'); // 反序列化面包屑 类型为std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
		$this->saleAttrsOut = $bs->popObject('stl_map<uint32_t,AttrDdo>'); // 反序列化解析销售属性 类型为std::map<uint32_t,b2b2c::nca::ddo::CAttrDdo> 
		$this->commAttrsOut = $bs->popObject('stl_map<uint32_t,stl_string>'); // 反序列化解析一般展示属性 类型为std::map<uint32_t,std::string> 
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0028810;
	}
}

class ParseAttr4SX_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $mapId;
	var $metaId;
	var $saleAttrsIn;
	var $commAttrsIn;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->mapId = 0; // uint32_t
		 $this->metaId = 0; // uint32_t
		 $this->saleAttrsIn = new stl_map('uint32_t,stl_vector<uint32_t> '); // std::map<uint32_t,std::vector<uint32_t> > 
		 $this->commAttrsIn = new stl_map('uint32_t,stl_string'); // std::map<uint32_t,std::string> 
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->mapId); // 序列化地图id，必填 类型为uint32_t
		$bs->pushUint32_t($this->metaId); // 序列化品类id，必填 类型为uint32_t
		$bs->pushObject($this->saleAttrsIn,'stl_map'); // 序列化解析销售属性，key是属性项id，值是需要解释的项id的集合，必填 类型为std::map<uint32_t,std::vector<uint32_t> > 
		$bs->pushObject($this->commAttrsIn,'stl_map'); // 序列化解析一般展示属性，传进来是个属性id串,key作为这个串的标志，不限定是什么值，必填 类型为std::map<uint32_t,std::string> 
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011810;
	}
}

class ParseAttr4SX_WGResp {
	var $result;
	var $errmsg;
	var $fullPath;
	var $saleAttrsOut;
	var $commAttrsOut;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->fullPath = $bs->popObject('stl_vector<NavEntryDdo>'); // 反序列化面包屑 类型为std::vector<b2b2c::nca::ddo::CNavEntryDdo> 
		$this->saleAttrsOut = $bs->popObject('stl_map<uint32_t,AttrDdo>'); // 反序列化解析销售属性 类型为std::map<uint32_t,b2b2c::nca::ddo::CAttrDdo> 
		$this->commAttrsOut = $bs->popObject('stl_map<uint32_t,stl_string>'); // 反序列化解析一般展示属性 类型为std::map<uint32_t,std::string> 
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018810;
	}
}

class ParseAttrTextReq {
	var $Source;
	var $InReserve;
	var $MapId;
	var $NavId;
	var $AttrString;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->InReserve = ""; // std::string
		 $this->MapId = 0; // uint32_t
		 $this->NavId = 0; // uint32_t
		 $this->AttrString = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化Source 类型为std::string
		$bs->pushString($this->InReserve); // 序列化InReserve 类型为std::string
		$bs->pushUint32_t($this->MapId); // 序列化地图id 类型为uint32_t
		$bs->pushUint32_t($this->NavId); // 序列化导航id 类型为uint32_t
		$bs->pushString($this->AttrString); // 序列化属性串 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x53601809;
	}
}

class ParseAttrTextResp {
	var $result;
	var $AttrBoList;
	var $OutReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->AttrBoList = $bs->popObject('stl_vector<AttrBo_v3>'); // 反序列化属性 类型为std::vector<c2cent::bo::nca_v3::CAttrBo_v3> 
		$this->OutReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x53608809;
	}
}

class ParseAttrTextMultiMeta_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $mapId;
	var $commAttrsIn;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->mapId = 0; // uint32_t
		 $this->commAttrsIn = new stl_map('uint32_t,stl_map<uint32_t,stl_string> '); // std::map<uint32_t,std::map<uint32_t,std::string> > 
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->mapId); // 序列化地图id，必填 类型为uint32_t
		$bs->pushObject($this->commAttrsIn,'stl_map'); // 序列化属性串，必填，外层map的key是一个标志，内层map的key是品类 类型为std::map<uint32_t,std::map<uint32_t,std::string> > 
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011813;
	}
}

class ParseAttrTextMultiMeta_WGResp {
	var $result;
	var $errmsg;
	var $commAttrsOut;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->commAttrsOut = $bs->popObject('stl_map<uint32_t,stl_string>'); // 反序列化属性串，必填，map的key是一个标志，string是解析好的属性串 类型为std::map<uint32_t,std::string> 
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018813;
	}
}

class ParseAttrTextNoCheck_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $mapId;
	var $navId;
	var $attrString;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->mapId = 0; // uint32_t
		 $this->navId = 0; // uint32_t
		 $this->attrString = ""; // std::string
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->mapId); // 序列化地图id，必填 类型为uint32_t
		$bs->pushUint32_t($this->navId); // 序列化导航id，必填 类型为uint32_t
		$bs->pushString($this->attrString); // 序列化属性串，必填 类型为std::string
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011812;
	}
}

class ParseAttrTextNoCheck_WGResp {
	var $result;
	var $errmsg;
	var $attrBoList;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->attrBoList = $bs->popObject('stl_vector<AttrDdo>'); // 反序列化属性 类型为std::vector<b2b2c::nca::ddo::CAttrDdo> 
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018812;
	}
}

class ParseAttrText_ALLReq {
	var $machineKey;
	var $source;
	var $APIControl;
	var $MetaId;
	var $AttrStr;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->APIControl = new APIControl(); // b2b2c::nca::ddo::CAPIControl
		 $this->MetaId = 0; // uint32_t
		 $this->AttrStr = ""; // std::string
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushObject($this->APIControl,'APIControl'); // 序列化调用控制，业务相关 类型为b2b2c::nca::ddo::CAPIControl
		$bs->pushUint32_t($this->MetaId); // 序列化品类id，必填 类型为uint32_t
		$bs->pushString($this->AttrStr); // 序列化属性串，必填 类型为std::string
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011826;
	}
}

class ParseAttrText_ALLResp {
	var $result;
	var $errmsg;
	var $Attr;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->Attr = $bs->popObject('stl_vector<AttrDdo>'); // 反序列化解析结果 类型为std::vector<b2b2c::nca::ddo::CAttrDdo> 
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018826;
	}
}

class ParseAttrText_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $mapId;
	var $navId;
	var $attrString;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->mapId = 0; // uint32_t
		 $this->navId = 0; // uint32_t
		 $this->attrString = ""; // std::string
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->mapId); // 序列化地图id，必填 类型为uint32_t
		$bs->pushUint32_t($this->navId); // 序列化导航id，必填 类型为uint32_t
		$bs->pushString($this->attrString); // 序列化属性串，必填 类型为std::string
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011809;
	}
}

class ParseAttrText_WGResp {
	var $result;
	var $errmsg;
	var $attrBoList;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->attrBoList = $bs->popObject('stl_vector<AttrDdo>'); // 反序列化属性 类型为std::vector<b2b2c::nca::ddo::CAttrDdo> 
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018809;
	}
}

class ParseAttrTexts_ALLReq {
	var $machineKey;
	var $source;
	var $APIControl;
	var $AttrIn;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->APIControl = new APIControl(); // b2b2c::nca::ddo::CAPIControl
		 $this->AttrIn = new stl_map('uint32_t,stl_set<stl_string> '); // std::map<uint32_t,std::set<std::string> > 
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushObject($this->APIControl,'APIControl'); // 序列化调用控制，业务相关 类型为b2b2c::nca::ddo::CAPIControl
		$bs->pushObject($this->AttrIn,'stl_map'); // 序列化key:品类id，value:属性串们，必填 类型为std::map<uint32_t,std::set<std::string> > 
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011827;
	}
}

class ParseAttrTexts_ALLResp {
	var $result;
	var $errmsg;
	var $AttrOut;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->AttrOut = $bs->popObject('stl_map<uint32_t,stl_map<stl_string,stl_vector<AttrDdo> > >'); // 反序列化key：品类id；value：又是一个map，其中key是属性串，value是解析结果 类型为std::map<uint32_t,std::map<std::string,std::vector<b2b2c::nca::ddo::CAttrDdo> > > 
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018827;
	}
}

class SearchPubNavByKeyReq {
	var $Source;
	var $InReserve;
	var $NeedAttr;
	var $Key;
	var $Count;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->InReserve = ""; // std::string
		 $this->NeedAttr = 0; // uint32_t
		 $this->Key = ""; // std::string
		 $this->Count = 0; // uint32_t
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化Source 类型为std::string
		$bs->pushString($this->InReserve); // 序列化InReserve 类型为std::string
		$bs->pushUint32_t($this->NeedAttr); // 序列化是否需要搜索属性,0:不需要,1:需要 类型为uint32_t
		$bs->pushString($this->Key); // 序列化关键词 类型为std::string
		$bs->pushUint32_t($this->Count); // 序列化需要的个数 类型为uint32_t

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x5360180c;
	}
}

class SearchPubNavByKeyResp {
	var $result;
	var $NavMatchKeyList;
	var $OutReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->NavMatchKeyList = $bs->popObject('stl_vector<NavMatchKey_v3>'); // 反序列化结果集 类型为std::vector<c2cent::bo::nca_v3::CNavMatchKey_v3> 
		$this->OutReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x5360880c;
	}
}

class SearchPubNavByKey_WGReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $needAttr;
	var $key;
	var $count;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->needAttr = 0; // uint32_t
		 $this->key = ""; // std::string
		 $this->count = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->needAttr); // 序列化是否需要搜索属性，必填;0:不需要,1:需要  类型为uint32_t
		$bs->pushString($this->key); // 序列化关键词，必填 类型为std::string
		$bs->pushUint32_t($this->count); // 序列化需要的个数，必填 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA001180c;
	}
}

class SearchPubNavByKey_WGResp {
	var $result;
	var $errmsg;
	var $navMatchKeyList;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->navMatchKeyList = $bs->popObject('stl_vector<NavMatchKeyDdo>'); // 反序列化 结果集  类型为std::vector<b2b2c::nca::ddo::CNavMatchKeyDdo> 
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA001880c;
	}
}

class TransAttrStr_WGReq {
	var $machineKey;
	var $source;
	var $metaId;
	var $AttrA;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->metaId = 0; // uint32_t
		 $this->AttrA = ""; // std::string
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码 类型为std::string
		$bs->pushString($this->source); // 序列化来源 类型为std::string
		$bs->pushUint32_t($this->metaId); // 序列化品类id，必填 类型为uint32_t
		$bs->pushString($this->AttrA); // 序列化源属性串，拍拍旧格式 类型为std::string
		$bs->pushString($this->inReserve); // 序列化保留字段 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0011819;
	}
}

class TransAttrStr_WGResp {
	var $result;
	var $errmsg;
	var $AttrC;
	var $TextAttrC;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->AttrC = $bs->popString(); // 反序列化目标属性串C，网购格式 类型为std::string
		$this->TextAttrC = $bs->popString(); // 反序列化目标属性串C，网购格式，所有属性项和属性值都解析成字符串 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0018819;
	}
}
?>