<?php
// source idl: com.icson.deal.idl.PayTypeAo.java
require_once "paytypeao_xxo.php";

class GetAllPayTypeInfoReq {
	var $source;
	var $payTypeParam;
	var $reserveIn;

	function __construct() {
		 $this->source = ""; // std::string
		 $this->payTypeParam = new PayTypeParam(); // icson::deal::bo::CPayTypeParam
		 $this->reserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushObject($this->payTypeParam,'PayTypeParam'); // 序列化请求参数 类型为icson::deal::bo::CPayTypeParam
		$bs->pushString($this->reserveIn); // 序列化保留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x890b1001;
	}
}

class GetAllPayTypeInfoResp {
	var $result;
	var $payTypeInfo;
	var $errMsg;
	var $reserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->payTypeInfo = $bs->popObject('PayTypeInfo'); // 反序列化支付方式信息 类型为icson::deal::bo::CPayTypeInfo
		$this->errMsg = $bs->popString(); // 反序列化错误消息 类型为std::string
		$this->reserveOut = $bs->popString(); // 反序列化保留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x890b8001;
	}
}

class GetPayTypeInfoReq {
	var $source;
	var $payTypeParam;
	var $reserveIn;

	function __construct() {
		 $this->source = ""; // std::string
		 $this->payTypeParam = new PayTypeParam(); // icson::deal::bo::CPayTypeParam
		 $this->reserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushObject($this->payTypeParam,'PayTypeParam'); // 序列化请求参数 类型为icson::deal::bo::CPayTypeParam
		$bs->pushString($this->reserveIn); // 序列化保留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x890b1002;
	}
}

class GetPayTypeInfoResp {
	var $result;
	var $payTypeInfo;
	var $errMsg;
	var $reserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->payTypeInfo = $bs->popObject('PayTypeInfo'); // 反序列化支付方式信息 类型为icson::deal::bo::CPayTypeInfo
		$this->errMsg = $bs->popString(); // 反序列化错误消息 类型为std::string
		$this->reserveOut = $bs->popString(); // 反序列化保留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x890b8002;
	}
}
?>