<?php
// source idl: com.icson.deal.idl.ProductInventoryDao.java
require_once "productinventorydao_xxo.php";

class GetDCByDistrictAndSiteReq {
	var $source;
	var $districtId;
	var $siteId;

	function __construct() {
		 $this->source = ""; // std::string
		 $this->districtId = 0; // uint32_t
		 $this->siteId = 0; // uint32_t
	}	

	function Serialize(&$bs){
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->districtId); // 序列化三级地址id 类型为uint32_t
		$bs->pushUint32_t($this->siteId); // 序列化分站id 类型为uint32_t

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91131005;
	}
}

class GetDCByDistrictAndSiteResp {
	var $result;
	var $dcId;
	var $errMsg;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->dcId = $bs->popString(); // 反序列化dcid(配送中心) 类型为std::string
		$this->errMsg = $bs->popString(); // 反序列化错误消息 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91138005;
	}
}

class GetInventeoryInfoReq {
	var $source;
	var $inventoryParam;
	var $reserveIn;

	function __construct() {
		 $this->source = ""; // std::string
		 $this->inventoryParam = new InventoryParam(); // icson::deal::bo::CInventoryParam
		 $this->reserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushObject($this->inventoryParam,'InventoryParam'); // 序列化请求参数 类型为icson::deal::bo::CInventoryParam
		$bs->pushString($this->reserveIn); // 序列化保留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91131001;
	}
}

class GetInventeoryInfoResp {
	var $result;
	var $dcId;
	var $inventoryInfoList;
	var $errMsg;
	var $reserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->dcId = $bs->popString(); // 反序列化DC id 类型为std::string
		$this->inventoryInfoList = $bs->popObject('stl_map<uint32_t,InventoryInfo>'); // 反序列化库存信息 类型为std::map<uint32_t,icson::deal::bo::CInventoryInfo> 
		$this->errMsg = $bs->popString(); // 反序列化错误消息 类型为std::string
		$this->reserveOut = $bs->popString(); // 反序列化保留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91138001;
	}
}

class GetInventeoryInfoByStockIdReq {
	var $source;
	var $inventoryParam;
	var $reserveIn;

	function __construct() {
		 $this->source = ""; // std::string
		 $this->inventoryParam = new InventoryParam(); // icson::deal::bo::CInventoryParam
		 $this->reserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushObject($this->inventoryParam,'InventoryParam'); // 序列化请求参数 类型为icson::deal::bo::CInventoryParam
		$bs->pushString($this->reserveIn); // 序列化保留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91131002;
	}
}

class GetInventeoryInfoByStockIdResp {
	var $result;
	var $inventoryInfoList;
	var $errMsg;
	var $reserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->inventoryInfoList = $bs->popObject('stl_map<uint32_t,InventoryInfo>'); // 反序列化库存信息 类型为std::map<uint32_t,icson::deal::bo::CInventoryInfo> 
		$this->errMsg = $bs->popString(); // 反序列化错误消息 类型为std::string
		$this->reserveOut = $bs->popString(); // 反序列化保留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91138002;
	}
}

class GetProductInfoReq {
	var $source;
	var $productParam;
	var $reserveIn;

	function __construct() {
		 $this->source = ""; // std::string
		 $this->productParam = new ProductParam(); // icson::deal::bo::CProductParam
		 $this->reserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushObject($this->productParam,'ProductParam'); // 序列化请求参数 类型为icson::deal::bo::CProductParam
		$bs->pushString($this->reserveIn); // 序列化保留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91131003;
	}
}

class GetProductInfoResp {
	var $result;
	var $productInfoList;
	var $errMsg;
	var $reserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->productInfoList = $bs->popObject('stl_map<uint32_t,ProductInfo>'); // 反序列化商品信息 类型为std::map<uint32_t,icson::deal::bo::CProductInfo> 
		$this->errMsg = $bs->popString(); // 反序列化错误消息 类型为std::string
		$this->reserveOut = $bs->popString(); // 反序列化保留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91138003;
	}
}

class GetSiteByStockReq {
	var $source;
	var $stockId;

	function __construct() {
		 $this->source = ""; // std::string
		 $this->stockId = new stl_vector('uint32_t'); // std::vector<uint32_t> 
	}	

	function Serialize(&$bs){
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushObject($this->stockId,'stl_vector'); // 序列化物理仓id列表 类型为std::vector<uint32_t> 

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91131004;
	}
}

class GetSiteByStockResp {
	var $result;
	var $stockToSite;
	var $errMsg;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->stockToSite = $bs->popObject('stl_map<uint32_t,uint32_t>'); // 反序列化物理仓id与分站id对应的map 类型为std::map<uint32_t,uint32_t> 
		$this->errMsg = $bs->popString(); // 反序列化错误消息 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91138004;
	}
}
?>