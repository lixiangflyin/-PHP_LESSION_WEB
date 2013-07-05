<?php
// source idl: icson.score.ao.IcsonScoreAo.java
require_once "icsonscoreao_xxo.php";

class ScoreAddReq {
	var $machineKey;
	var $source;
	var $busiCode;
	var $busiVerifyCode;
	var $operationName;
	var $busiUniqId;
	var $AddScorePo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->busiCode = 0; // uint32_t
		 $this->busiVerifyCode = ""; // std::string
		 $this->operationName = ""; // std::string
		 $this->busiUniqId = ""; // std::string
		 $this->AddScorePo = new AddScorePo(); // icson::score::po::CAddScorePo
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码,客户机器IP,必须 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源,必须 类型为std::string
		$bs->pushUint32_t($this->busiCode); // 序列化业务码，找kuijiang申请,必须 类型为uint32_t
		$bs->pushString($this->busiVerifyCode); // 序列化业务码密码，找kuijiang申请,必须 类型为std::string
		$bs->pushString($this->operationName); // 序列化操作者姓名，表明业务名称，不能为空 类型为std::string
		$bs->pushString($this->busiUniqId); // 序列化判断本次请求的唯一标识,必须 类型为std::string
		$bs->pushObject($this->AddScorePo,'AddScorePo'); // 序列化 积分发放Po，必须   类型为icson::score::po::CAddScorePo
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x90c01801;
	}
}

class ScoreAddResp {
	var $result;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息   类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字   类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x90c08801;
	}
}

class ScoreSubReq {
	var $machineKey;
	var $source;
	var $busiCode;
	var $busiVerifyCode;
	var $operationName;
	var $busiUniqId;
	var $subScorePo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->busiCode = 0; // uint32_t
		 $this->busiVerifyCode = ""; // std::string
		 $this->operationName = ""; // std::string
		 $this->busiUniqId = ""; // std::string
		 $this->subScorePo = new SubScorePo(); // icson::score::po::CSubScorePo
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码,客户机器IP,必须 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源,必须 类型为std::string
		$bs->pushUint32_t($this->busiCode); // 序列化业务码，找kuijiang申请,必须 类型为uint32_t
		$bs->pushString($this->busiVerifyCode); // 序列化业务码密码，找kuijiang申请,必须 类型为std::string
		$bs->pushString($this->operationName); // 序列化操作者姓名，表明业务名称，不能为空 类型为std::string
		$bs->pushString($this->busiUniqId); // 序列化判断本次请求的唯一标识,暂不控制 类型为std::string
		$bs->pushObject($this->subScorePo,'SubScorePo'); // 序列化 积分扣减Po，必须   类型为icson::score::po::CSubScorePo
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x90c01802;
	}
}

class ScoreSubResp {
	var $result;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息   类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字   类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x90c08802;
	}
}
?>