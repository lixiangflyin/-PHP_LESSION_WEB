<?php
// source idl: com.paipai.vb2c.active.ao.idl.ActiveAo.java
require_once "activeao_xxo.php";

class JoinActiveReq {
	var $source;
	var $activeRequestPo;

	function __construct() {

		 $this->source = ""; // std::string

		 $this->activeRequestPo = new ActiveRequestPo(); // vb2c::active::po::CActiveRequestPo

	}	

	function Serialize(&$bs){
		$bs->pushString($this->source); // 序列化source 类型为std::string

		$bs->pushObject($this->activeRequestPo,'ActiveRequestPo'); // 序列化freqlimit req 类型为vb2c::active::po::CActiveRequestPo


		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x70AD1801;
	}
}

class JoinActiveResp {
	var $result;
	var $activeResponePo;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->activeResponePo = $bs->popObject('ActiveResponePo'); // 反序列化result 类型为vb2c::active::po::CActiveResponePo



	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x70AD8801;
	}
}

class RollBackActiveReq {
	var $source;
	var $activeRequestPo;

	function __construct() {

		 $this->source = ""; // std::string

		 $this->activeRequestPo = new ActiveRequestPo(); // vb2c::active::po::CActiveRequestPo

	}	

	function Serialize(&$bs){
		$bs->pushString($this->source); // 序列化source 类型为std::string

		$bs->pushObject($this->activeRequestPo,'ActiveRequestPo'); // 序列化freqlimit req 类型为vb2c::active::po::CActiveRequestPo


		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x70AD1802;
	}
}

class RollBackActiveResp {
	var $result;
	var $rollBackResult;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->rollBackResult = $bs->popObject('uint8_t'); // 反序列化result 类型为bool



	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x70AD8802;
	}
}
?>