<?php
// source idl: com.icson.promotionrestrict.idl.PromotionRestrictAo.java

//require_once "promotionrestrictao_xxo.php";

//请求
class GetActiveBatchPromotionRestrictReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $uin;
	var $restrictParamListIn;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->uin = 0; // uint64_t
		 $this->restrictParamListIn = new stl_vector('PromotionRestrictParamInfo_Bo'); // std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化用户机器码 类型为std::string
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id 类型为uint32_t
		$bs->pushUint64_t($this->uin); // 序列化用户Id 类型为uint64_t
		$bs->pushObject($this->restrictParamListIn, 'stl_vector'); // 序列化详细业务参数队列 类型为std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x9A101805;
	}
}
//回复
class GetActiveBatchPromotionRestrictResp {
	var $result;
	var $restrictParamListOut;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->restrictParamListOut = $bs->popObject('stl_vector<PromotionRestrictParamInfo_Bo> '); // 反序列化详细业务参数队列 类型为std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化 保留输出参数,未使用  类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x9A108805;
	}
}
//请求
class GetDealBatchPromotionRestrictReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $uin;
	var $restrictParamListIn;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->uin = 0; // uint64_t
		 $this->restrictParamListIn = new stl_vector('PromotionRestrictParamInfo_Bo'); // std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化用户机器码 类型为std::string
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id 类型为uint32_t
		$bs->pushUint64_t($this->uin); // 序列化用户Id 类型为uint64_t
		$bs->pushObject($this->restrictParamListIn, 'stl_vector'); // 序列化详细业务参数队列 类型为std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x9A101802;
	}
}
//回复
class GetDealBatchPromotionRestrictResp {
	var $result;
	var $restrictParamListOut;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->restrictParamListOut = $bs->popObject('stl_vector<PromotionRestrictParamInfo_Bo> '); // 反序列化详细业务参数队列 类型为std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化 保留输出参数,未使用  类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x9A108802;
	}
}
//请求
class GetShopCartBatchPromotionRestrictReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $uin;
	var $restrictParamListIn;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->uin = 0; // uint64_t
		 $this->restrictParamListIn = new stl_vector('PromotionRestrictParamInfo_Bo'); // std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化用户机器码 类型为std::string
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id 类型为uint32_t
		$bs->pushUint64_t($this->uin); // 序列化用户Id 类型为uint64_t
		$bs->pushObject($this->restrictParamListIn, 'stl_vector'); // 序列化详细业务参数队列 类型为std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x9A101803;
	}
}
//回复
class GetShopCartBatchPromotionRestrictResp {
	var $result;
	var $restrictParamListOut;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->restrictParamListOut = $bs->popObject('stl_vector<PromotionRestrictParamInfo_Bo> '); // 反序列化详细业务参数队列 类型为std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化 保留输出参数,未使用  类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x9A108803;
	}
}
//请求
class GetSingleRulePromotionRestrictReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $uin;
	var $restrictParamListIn;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->uin = 0; // uint64_t
		 $this->restrictParamListIn = new stl_vector('PromotionRestrictParamInfo_Bo'); // std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化用户机器码 类型为std::string
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id 类型为uint32_t
		$bs->pushUint64_t($this->uin); // 序列化用户Id 类型为uint64_t
		$bs->pushObject($this->restrictParamListIn, 'stl_vector'); // 序列化详细业务参数队列 类型为std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x9A101801;
	}
}
//回复
class GetSingleRulePromotionRestrictResp {
	var $result;
	var $restrictParamListOnt;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->restrictParamListOnt = $bs->popObject('stl_vector<PromotionRestrictParamInfo_Bo> '); // 反序列化详细业务参数队列 类型为std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化 保留输出参数,未使用  类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x9A108801;
	}
}
//请求
class RollbackDealBatchPromotionRestrictReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $uin;
	var $restrictParamListIn;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->uin = 0; // uint64_t
		 $this->restrictParamListIn = new stl_vector('PromotionRestrictParamInfo_Bo'); // std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化用户机器码 类型为std::string
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id 类型为uint32_t
		$bs->pushUint64_t($this->uin); // 序列化用户Id 类型为uint64_t
		$bs->pushObject($this->restrictParamListIn, 'stl_vector'); // 序列化详细业务参数队列 类型为std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x9A101804;
	}
}
//回复
class RollbackDealBatchPromotionRestrictResp {
	var $result;
	var $restrictParamListOut;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->restrictParamListOut = $bs->popObject('stl_vector<PromotionRestrictParamInfo_Bo> '); // 反序列化详细业务参数队列 类型为std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化 保留输出参数,未使用  类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x9A108804;
	}
}

?>