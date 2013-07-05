<?php
// source idl: com.icson.promotion.idl.SpsRule4Others.java

//require_once "spsrule4others_xxo.php";

//请求
class GetRuleForGuanguanReq {
	var $uin;
	var $source;
	var $scene;
	var $ruleId;
	var $inReserve;


	function __construct() {
		 $this->uin = 0; // uint64_t
		 $this->source = ""; // std::string
		 $this->scene = 0; // uint32_t
		 $this->ruleId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushUint64_t($this->uin); // 序列化用户ID 类型为uint64_t
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->scene); // 序列化场景id 类型为uint32_t
		$bs->pushUint32_t($this->ruleId); // 序列化站点id 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化保留字段 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x9a501801;
	}
}
//回复
class GetRuleForGuanguanResp {
	var $result;
	var $opinfo;
	var $desc;
	var $remark;
	var $ruleid;
	var $errCode;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->opinfo = $bs->popString(); // 反序列化 类型为std::string
		$this->desc = $bs->popString(); // 反序列化 类型为std::string
		$this->remark = $bs->popString(); // 反序列化 类型为std::string
		$this->ruleid = $bs->popUint32_t(); // 反序列化 类型为uint32_t
		$this->errCode = $bs->popUint32_t(); // 反序列化错误码 类型为uint32_t
		$this->outReserve = $bs->popString(); // 反序列化保留字段 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x9a508801;
	}
}

?>