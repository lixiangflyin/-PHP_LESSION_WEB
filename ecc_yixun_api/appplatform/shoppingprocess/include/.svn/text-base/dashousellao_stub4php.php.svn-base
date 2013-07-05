<?php
// source idl: com.icson.dashou.idl.DaShouSellAo.java
require_once "dashousellao_xxo.php";

class CheckTogetherSellReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $whId;
	var $regionId;
	var $Uid;
	var $checkParam;
	var $ReserveIn;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->whId = 0; // uint32_t
		 $this->regionId = 0; // uint32_t
		 $this->Uid = 0; // uint64_t
		 $this->checkParam = new CheckTogetherSellParamBo(); // icson::dashou::bo::CCheckTogetherSellParamBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化用户机器码 类型为std::string
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id 类型为uint32_t
		$bs->pushUint32_t($this->whId); // 序列化站点id 类型为uint32_t
		$bs->pushUint32_t($this->regionId); // 序列化地域 id 类型为uint32_t
		$bs->pushUint64_t($this->Uid); // 序列化用户ID 类型为uint64_t
		$bs->pushObject($this->checkParam,'CheckTogetherSellParamBo'); // 序列化详细业务参数队列 类型为icson::dashou::bo::CCheckTogetherSellParamBo
		$bs->pushString($this->ReserveIn); // 序列化ReserveIn 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x89051802;
	}
}

class CheckTogetherSellResp {
	var $result;
	var $checkResult;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->checkResult = $bs->popObject('CheckTogetherSellResultBo'); // 反序列化check结果 类型为icson::dashou::bo::CCheckTogetherSellResultBo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化 保留输出参数,未使用  类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x89058802;
	}
}

class CheckTogetherSellPackageReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $whId;
	var $regionId;
	var $Uid;
	var $checkParam;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->whId = 0; // uint32_t
		 $this->regionId = 0; // uint32_t
		 $this->Uid = 0; // uint64_t
		 $this->checkParam = new CheckTogetherSellPkgParamBo(); // icson::dashou::bo::CCheckTogetherSellPkgParamBo
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化用户机器码 类型为std::string
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id 类型为uint32_t
		$bs->pushUint32_t($this->whId); // 序列化站点id 类型为uint32_t
		$bs->pushUint32_t($this->regionId); // 序列化地域 id 类型为uint32_t
		$bs->pushUint64_t($this->Uid); // 序列化用户ID 类型为uint64_t
		$bs->pushObject($this->checkParam,'CheckTogetherSellPkgParamBo'); // 序列化需要校验的规则详情，通过套餐规则id校验套餐关系可以调用该接口 类型为icson::dashou::bo::CCheckTogetherSellPkgParamBo

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x89051804;
	}
}

class CheckTogetherSellPackageResp {
	var $result;
	var $checkResult;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->checkResult = $bs->popObject('CheckTogetherSellPackageResultBo'); // 反序列化验证结果列表 类型为icson::dashou::bo::CCheckTogetherSellPackageResultBo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化 保留输出参数,未使用  类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x89058804;
	}
}

class GetTogetherSellReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $whId;
	var $regionId;
	var $Uid;
	var $flag;
	var $MainproductList;
	var $ReserveIn;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->whId = 0; // uint32_t
		 $this->regionId = 0; // uint32_t
		 $this->Uid = 0; // uint64_t
		 $this->flag = new stl_bitset('64'); // std::bitset<64> 
		 $this->MainproductList = new stl_vector('DSMainProduct'); // std::vector<icson::dashou::bo::CDSMainProduct> 
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化用户机器码 类型为std::string
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id 类型为uint32_t
		$bs->pushUint32_t($this->whId); // 序列化站点id 类型为uint32_t
		$bs->pushUint32_t($this->regionId); // 序列化地域 id 类型为uint32_t
		$bs->pushUint64_t($this->Uid); // 序列化用户ID 类型为uint64_t
		$bs->pushObject($this->flag,'stl_bitset'); // 序列化取哪些类型的搭售数据 类型为std::bitset<64> 
		$bs->pushObject($this->MainproductList,'stl_vector'); // 序列化 主商品参数信息 类型为std::vector<icson::dashou::bo::CDSMainProduct> 
		$bs->pushString($this->ReserveIn); // 序列化ReserveIn 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x89051801;
	}
}

class GetTogetherSellResp {
	var $result;
	var $MainTogetherSell;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->MainTogetherSell = $bs->popObject('stl_vector<TogethersellItemBo>'); // 反序列化 规则id为key，value为对应搭售全部信息 类型为std::vector<icson::dashou::bo::CTogethersellItemBo> 
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x89058801;
	}
}

class GetTogetherSellRuleDetailReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $whId;
	var $regionId;
	var $Uid;
	var $ruleFilter;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->whId = 0; // uint32_t
		 $this->regionId = 0; // uint32_t
		 $this->Uid = 0; // uint64_t
		 $this->ruleFilter = new stl_vector('RuleFilterBo'); // std::vector<icson::dashou::bo::CRuleFilterBo> 
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化用户机器码 类型为std::string
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id 类型为uint32_t
		$bs->pushUint32_t($this->whId); // 序列化站点id 类型为uint32_t
		$bs->pushUint32_t($this->regionId); // 序列化地域 id 类型为uint32_t
		$bs->pushUint64_t($this->Uid); // 序列化用户ID 类型为uint64_t
		$bs->pushObject($this->ruleFilter,'stl_vector'); // 序列化需要查询的规则详情，目前后台只返回套餐的规则数据，其他几个业务还没有这个需求 类型为std::vector<icson::dashou::bo::CRuleFilterBo> 

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x89051803;
	}
}

class GetTogetherSellRuleDetailResp {
	var $result;
	var $MainTogethersell;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->MainTogethersell = $bs->popObject('stl_vector<TogethersellRuleBo>'); // 反序列化 规则id为key，value为对应规则详情 类型为std::vector<icson::dashou::bo::CTogethersellRuleBo> 
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化 保留输出参数,未使用  类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x89058803;
	}
}
?>