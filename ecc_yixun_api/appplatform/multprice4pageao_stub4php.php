<?php
// source idl: com.icson.multprice.idl.MultPrice4PageAo.java
require_once "multprice4pageao_xxo.php";

class GetMultprice4pageReq {
	var $machineKey;
	var $source;
	var $regionId;
	var $substationId;
	var $uin;
	var $multPriceItemBo4PageList;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->regionId = 0; // uint32_t
		 $this->substationId = 0; // uint32_t
		 $this->uin = 0; // uint32_t
		 $this->multPriceItemBo4PageList = new stl_vector('MultPriceItem4PageBo'); // std::vector<icson::multprice::bo::CMultPriceItem4PageBo> 
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化用户机器码 类型为std::string
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->regionId); // 序列化地域 id，选填 类型为uint32_t
		$bs->pushUint32_t($this->substationId); // 序列化分站id 类型为uint32_t
		$bs->pushUint32_t($this->uin); // 序列化用户id 类型为uint32_t
		$bs->pushObject($this->multPriceItemBo4PageList,'stl_vector'); // 序列化查询的商品信息 类型为std::vector<icson::multprice::bo::CMultPriceItem4PageBo> 
		$bs->pushString($this->inReserve); // 序列化 保留输入参数,未使用  类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x9a011801;
	}
}

class GetMultprice4pageResp {
	var $result;
	var $multPriceRules4PageBoList;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->multPriceRules4PageBoList = $bs->popObject('stl_map<stl_string,MultPriceRules4PageBo>'); // 反序列化商品多价信息列表,string商品itemid 类型为std::map<std::string,icson::multprice::bo::CMultPriceRules4PageBo> 
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化 保留输出参数,未使用  类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x9a018801;
	}
}
?>