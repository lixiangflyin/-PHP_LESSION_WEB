<?php
// source idl: com.icson.grossprofitcontrol.idl.GrossProfitRecordDao.java
require_once "grossprofitrecorddao_xxo.php";

class DeleteRecordReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $recordIn;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->recordIn = new GrossProfitControlRecord_Bo(); // icson::grossprofitcontrol::bo::CGrossProfitControlRecord_Bo
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化用户机器码 类型为std::string
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id 类型为uint32_t
		$bs->pushObject($this->recordIn,'GrossProfitControlRecord_Bo'); // 序列化管控申请结构 类型为icson::grossprofitcontrol::bo::CGrossProfitControlRecord_Bo
		$bs->pushString($this->inReserve); // 序列化 保留输入参数,未使用  类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x9A121804;
	}
}

class DeleteRecordResp {
	var $result;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化 保留输出参数,未使用  类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x9A128804;
	}
}

class GetIndexByOperatorReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $indexIn;
	var $priceStartTime;
	var $priceEndTime;
	var $recordStart;
	var $recordNum;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->indexIn = new GrossProfitIndex_Bo(); // icson::grossprofitcontrol::bo::CGrossProfitIndex_Bo
		 $this->priceStartTime = 0; // uint32_t
		 $this->priceEndTime = 0; // uint32_t
		 $this->recordStart = 0; // uint32_t
		 $this->recordNum = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化用户机器码 类型为std::string
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id 类型为uint32_t
		$bs->pushObject($this->indexIn,'GrossProfitIndex_Bo'); // 序列化管控申请结构 类型为icson::grossprofitcontrol::bo::CGrossProfitIndex_Bo
		$bs->pushUint32_t($this->priceStartTime); // 序列化起始时间，必填 类型为uint32_t
		$bs->pushUint32_t($this->priceEndTime); // 序列化结束时间，必填 类型为uint32_t
		$bs->pushUint32_t($this->recordStart); // 序列化获取开始条数 类型为uint32_t
		$bs->pushUint32_t($this->recordNum); // 序列化获取条数 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化 保留输入参数,未使用  类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x9A121805;
	}
}

class GetIndexByOperatorResp {
	var $result;
	var $totalNum;
	var $resultSet;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->totalNum = $bs->popUint32_t(); // 反序列化该条件下总条数 类型为uint32_t
		$this->resultSet = $bs->popObject('stl_vector<GrossProfitIndex_Bo>'); // 反序列化查询结果 类型为std::vector<icson::grossprofitcontrol::bo::CGrossProfitIndex_Bo> 
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化 保留输出参数,未使用  类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x9A128805;
	}
}

class GetMultiPriceHistoryBatchReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $productId;
	var $whId;
	var $priceStartTime;
	var $priceEndTime;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->productId = 0; // uint32_t
		 $this->whId = 0; // uint32_t
		 $this->priceStartTime = 0; // uint32_t
		 $this->priceEndTime = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化用户机器码 类型为std::string
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id 类型为uint32_t
		$bs->pushUint32_t($this->productId); // 序列化易迅product_Id 类型为uint32_t
		$bs->pushUint32_t($this->whId); // 序列化站点id 类型为uint32_t
		$bs->pushUint32_t($this->priceStartTime); // 序列化起始时间，必填 类型为uint32_t
		$bs->pushUint32_t($this->priceEndTime); // 序列化结束时间，必填 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化 保留输入参数,未使用  类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x9A121806;
	}
}

class GetMultiPriceHistoryBatchResp {
	var $result;
	var $recordSet;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->recordSet = $bs->popObject('stl_vector<GrossProfitControlRecord_Bo>'); // 反序列化Get结果 类型为std::vector<icson::grossprofitcontrol::bo::CGrossProfitControlRecord_Bo> 
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化 保留输出参数,未使用  类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x9A128806;
	}
}

class GetRecordReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $Key;
	var $approvalState;
	var $timeType;
	var $priceStartTime;
	var $priceEndTime;
	var $recordStart;
	var $recordNum;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->Key = new GrossProfitControlKey_Bo(); // icson::grossprofitcontrol::bo::CGrossProfitControlKey_Bo
		 $this->approvalState = 0; // uint16_t
		 $this->timeType = 0; // uint8_t
		 $this->priceStartTime = 0; // uint32_t
		 $this->priceEndTime = 0; // uint32_t
		 $this->recordStart = 0; // uint32_t
		 $this->recordNum = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化用户机器码 类型为std::string
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id 类型为uint32_t
		$bs->pushObject($this->Key,'GrossProfitControlKey_Bo'); // 序列化管控申请结构 类型为icson::grossprofitcontrol::bo::CGrossProfitControlKey_Bo
		$bs->pushUint16_t($this->approvalState); // 序列化审批结果/状态 0 待审核 1 已审核  2 审核不通过  3 终止 4 删除 类型为uint16_t
		$bs->pushUint8_t($this->timeType); // 序列化时间类型 1 记录插入时间 2规则有效期 类型为uint8_t
		$bs->pushUint32_t($this->priceStartTime); // 序列化起始时间，必填 类型为uint32_t
		$bs->pushUint32_t($this->priceEndTime); // 序列化结束时间，必填 类型为uint32_t
		$bs->pushUint32_t($this->recordStart); // 序列化获取开始条数 类型为uint32_t
		$bs->pushUint32_t($this->recordNum); // 序列化获取条数 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化 保留输入参数,未使用  类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x9A121802;
	}
}

class GetRecordResp {
	var $result;
	var $totalNum;
	var $recordSet;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->totalNum = $bs->popUint32_t(); // 反序列化总条数条数 类型为uint32_t
		$this->recordSet = $bs->popObject('stl_vector<GrossProfitControlRecord_Bo>'); // 反序列化Get结果 类型为std::vector<icson::grossprofitcontrol::bo::CGrossProfitControlRecord_Bo> 
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化 保留输出参数,未使用  类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x9A128802;
	}
}

class InsertRecordReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $recordIn;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->recordIn = new GrossProfitControlRecord_Bo(); // icson::grossprofitcontrol::bo::CGrossProfitControlRecord_Bo
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化用户机器码 类型为std::string
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id 类型为uint32_t
		$bs->pushObject($this->recordIn,'GrossProfitControlRecord_Bo'); // 序列化管控申请结构 类型为icson::grossprofitcontrol::bo::CGrossProfitControlRecord_Bo
		$bs->pushString($this->inReserve); // 序列化 保留输入参数,未使用  类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x9A121801;
	}
}

class InsertRecordResp {
	var $result;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化 保留输出参数,未使用  类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x9A128801;
	}
}

class UpdateRecordReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $recordIn;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->recordIn = new GrossProfitControlRecord_Bo(); // icson::grossprofitcontrol::bo::CGrossProfitControlRecord_Bo
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化用户机器码 类型为std::string
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id 类型为uint32_t
		$bs->pushObject($this->recordIn,'GrossProfitControlRecord_Bo'); // 序列化管控申请结构 类型为icson::grossprofitcontrol::bo::CGrossProfitControlRecord_Bo
		$bs->pushString($this->inReserve); // 序列化 保留输入参数,未使用  类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x9A121803;
	}
}

class UpdateRecordResp {
	var $result;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化 保留输出参数,未使用  类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x9A128803;
	}
}
?>