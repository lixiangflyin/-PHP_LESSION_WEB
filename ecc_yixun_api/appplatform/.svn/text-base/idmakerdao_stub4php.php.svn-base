<?php
// source idl: com.paipai.idl.idmaker.IdMakerDao.java

//require_once "idmakerdao_xxo.php";

//请求
class GetNeedIdsForU32Req {
	var $BizType;
	var $ReqSize;


	function __construct() {
		 $this->BizType = 0; // uint32_t
		 $this->ReqSize = 0; // uint32_t
	}	


	function Serialize(&$bs) {
		$bs->pushUint32_t($this->BizType); // 序列化业务类型 类型为uint32_t
		$bs->pushUint32_t($this->ReqSize); // 序列化用户请求ID个数 类型为uint32_t

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x10901802;
	}
}
//回复
class GetNeedIdsForU32Resp {
	var $result;
	var $RespSize;
	var $StartId;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->RespSize = $bs->popUint32_t(); // 反序列化实际返回ID个数 类型为uint32_t
		$this->StartId = $bs->popUint32_t(); // 反序列化开始ID值 类型为uint32_t


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x10908802;
	}
}
//请求
class GetNeedIdsForU64Req {
	var $BizType;
	var $ReqSize;


	function __construct() {
		 $this->BizType = 0; // uint32_t
		 $this->ReqSize = 0; // uint32_t
	}	


	function Serialize(&$bs) {
		$bs->pushUint32_t($this->BizType); // 序列化业务类型 类型为uint32_t
		$bs->pushUint32_t($this->ReqSize); // 序列化用户请求ID个数 类型为uint32_t

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x10901801;
	}
}
//回复
class GetNeedIdsForU64Resp {
	var $result;
	var $RespSize;
	var $StartId;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->RespSize = $bs->popUint32_t(); // 反序列化实际返回ID个数 类型为uint32_t
		$this->StartId = $bs->popUint64_t(); // 反序列化开始ID值 类型为uint64_t


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x10908801;
	}
}

?>