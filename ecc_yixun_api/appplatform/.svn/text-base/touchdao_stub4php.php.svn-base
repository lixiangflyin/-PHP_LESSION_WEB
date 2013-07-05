<?php
// source idl: com.b2b2c.touch.idl.TouchDao.java

require_once "touchdao_xxo.php";

//请求
class DeleteDealNoPayReq {
	var $Source;
	var $Scene;
	var $MachineKey;
	var $Record;
	var $ReserveIn;


	function __construct() {
		 $this->Source = ""; // std::string
		 $this->Scene = 0; // uint32_t
		 $this->MachineKey = ""; // std::string
		 $this->Record = new TouchDealNoPayDo(); // b2b2c::touch::ddo::CTouchDealNoPayDo
		 $this->ReserveIn = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->Scene); // 序列化请求来源场景 类型为uint32_t
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushObject($this->Record, 'TouchDealNoPayDo'); // 序列化消息记录 类型为b2b2c::touch::ddo::CTouchDealNoPayDo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x91011808;
	}
}
//回复
class DeleteDealNoPayResp {
	var $result;
	var $errmsg;
	var $ReserveOut;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91018808;
	}
}
//请求
class GetAtTimeOkReq {
	var $Source;
	var $Scene;
	var $MachineKey;
	var $Channel;
	var $ReserveIn;


	function __construct() {
		 $this->Source = ""; // std::string
		 $this->Scene = 0; // uint32_t
		 $this->MachineKey = ""; // std::string
		 $this->Channel = 0; // uint32_t
		 $this->ReserveIn = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->Scene); // 序列化请求来源场景 类型为uint32_t
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushUint32_t($this->Channel); // 序列化渠道ID 类型为uint32_t
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x91011807;
	}
}
//回复
class GetAtTimeOkResp {
	var $result;
	var $errmsg;
	var $AtTimeDoList;
	var $ReserveOut;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->AtTimeDoList = $bs->popObject('stl_vector<TouchAtTimeDo> '); // 反序列化消息表 类型为std::vector<b2b2c::touch::ddo::CTouchAtTimeDo> 
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91018807;
	}
}
//请求
class GetRealTimeReq {
	var $Source;
	var $Scene;
	var $MachineKey;
	var $Channel;
	var $MinPriority;
	var $MaxPriority;
	var $ReserveIn;


	function __construct() {
		 $this->Source = ""; // std::string
		 $this->Scene = 0; // uint32_t
		 $this->MachineKey = ""; // std::string
		 $this->Channel = 0; // uint32_t
		 $this->MinPriority = 0; // uint32_t
		 $this->MaxPriority = 0; // uint32_t
		 $this->ReserveIn = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->Scene); // 序列化请求来源场景 类型为uint32_t
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushUint32_t($this->Channel); // 序列化渠道ID 类型为uint32_t
		$bs->pushUint32_t($this->MinPriority); // 序列化最小优先级 类型为uint32_t
		$bs->pushUint32_t($this->MaxPriority); // 序列化最大优先级 类型为uint32_t
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x91011804;
	}
}
//回复
class GetRealTimeResp {
	var $result;
	var $errmsg;
	var $RealTimeDoList;
	var $ReserveOut;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->RealTimeDoList = $bs->popObject('stl_vector<TouchRealTimeDo> '); // 反序列化消息表 类型为std::vector<b2b2c::touch::ddo::CTouchRealTimeDo> 
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91018804;
	}
}
//请求
class InsertAtTimeReq {
	var $Source;
	var $Scene;
	var $MachineKey;
	var $Record;
	var $ReserveIn;


	function __construct() {
		 $this->Source = ""; // std::string
		 $this->Scene = 0; // uint32_t
		 $this->MachineKey = ""; // std::string
		 $this->Record = new TouchAtTimeDo(); // b2b2c::touch::ddo::CTouchAtTimeDo
		 $this->ReserveIn = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->Scene); // 序列化请求来源场景 类型为uint32_t
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushObject($this->Record, 'TouchAtTimeDo'); // 序列化 类型为b2b2c::touch::ddo::CTouchAtTimeDo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x91011801;
	}
}
//回复
class InsertAtTimeResp {
	var $result;
	var $errmsg;
	var $ReserveOut;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91018801;
	}
}
//请求
class InsertDealNoPayReq {
	var $Source;
	var $Scene;
	var $MachineKey;
	var $Record;
	var $ReserveIn;


	function __construct() {
		 $this->Source = ""; // std::string
		 $this->Scene = 0; // uint32_t
		 $this->MachineKey = ""; // std::string
		 $this->Record = new TouchDealNoPayDo(); // b2b2c::touch::ddo::CTouchDealNoPayDo
		 $this->ReserveIn = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->Scene); // 序列化请求来源场景 类型为uint32_t
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushObject($this->Record, 'TouchDealNoPayDo'); // 序列化消息记录 类型为b2b2c::touch::ddo::CTouchDealNoPayDo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x91011803;
	}
}
//回复
class InsertDealNoPayResp {
	var $result;
	var $errmsg;
	var $ReserveOut;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91018803;
	}
}
//请求
class InsertRealTimeReq {
	var $Source;
	var $Scene;
	var $MachineKey;
	var $Record;
	var $ReserveIn;


	function __construct() {
		 $this->Source = ""; // std::string
		 $this->Scene = 0; // uint32_t
		 $this->MachineKey = ""; // std::string
		 $this->Record = new TouchRealTimeDo(); // b2b2c::touch::ddo::CTouchRealTimeDo
		 $this->ReserveIn = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->Scene); // 序列化请求来源场景 类型为uint32_t
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushObject($this->Record, 'TouchRealTimeDo'); // 序列化消息记录 类型为b2b2c::touch::ddo::CTouchRealTimeDo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x91011802;
	}
}
//回复
class InsertRealTimeResp {
	var $result;
	var $errmsg;
	var $ReserveOut;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91018802;
	}
}
//请求
class InsertRealTimeFailLogReq {
	var $Source;
	var $Scene;
	var $MachineKey;
	var $Record;
	var $ReserveIn;


	function __construct() {
		 $this->Source = ""; // std::string
		 $this->Scene = 0; // uint32_t
		 $this->MachineKey = ""; // std::string
		 $this->Record = new TouchRealTimeDo(); // b2b2c::touch::ddo::CTouchRealTimeDo
		 $this->ReserveIn = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->Scene); // 序列化请求来源场景 类型为uint32_t
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushObject($this->Record, 'TouchRealTimeDo'); // 序列化消息记录 类型为b2b2c::touch::ddo::CTouchRealTimeDo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x91011806;
	}
}
//回复
class InsertRealTimeFailLogResp {
	var $result;
	var $errmsg;
	var $ReserveOut;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91018806;
	}
}
//请求
class InsertRealTimeSuccessLogReq {
	var $Source;
	var $Scene;
	var $MachineKey;
	var $Record;
	var $ReserveIn;


	function __construct() {
		 $this->Source = ""; // std::string
		 $this->Scene = 0; // uint32_t
		 $this->MachineKey = ""; // std::string
		 $this->Record = new TouchRealTimeDo(); // b2b2c::touch::ddo::CTouchRealTimeDo
		 $this->ReserveIn = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->Scene); // 序列化请求来源场景 类型为uint32_t
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushObject($this->Record, 'TouchRealTimeDo'); // 序列化消息记录 类型为b2b2c::touch::ddo::CTouchRealTimeDo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x91011805;
	}
}
//回复
class InsertRealTimeSuccessLogResp {
	var $result;
	var $errmsg;
	var $ReserveOut;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91018805;
	}
}

?>