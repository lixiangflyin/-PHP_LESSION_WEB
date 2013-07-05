<?php
// source idl: com.b2b2c.icsonrecvaddr.idl.IcsonRecvAddressAo.java
require_once "icsonrecvaddressao_xxo.php";

class AddIcsonRecvAddrReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $authKey;
	var $icsonUid;
	var $icsonRecvAddrPo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->authKey = ""; // std::string
		 $this->icsonUid = 0; // uint64_t
		 $this->icsonRecvAddrPo = new IcsonRecvAddrPo(); // b2b2c::icson_recvaddr::po::CIcsonRecvAddrPo
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，一般为用户登录后在浏览器cookie中的打标，用于标识请求来源浏览器，内部调用可以填随机字符串 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，为接口调用方的文件名 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID 类型为uint32_t
		$bs->pushString($this->authKey); // 序列化接口请求校验键值，如果传入的校验键值不对，请求会被拒绝 类型为std::string
		$bs->pushUint64_t($this->icsonUid); // 序列化易迅用户ID 类型为uint64_t
		$bs->pushObject($this->icsonRecvAddrPo,'IcsonRecvAddrPo'); // 序列化易迅用户收货地址Po 类型为b2b2c::icson_recvaddr::po::CIcsonRecvAddrPo
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x31041802;
	}
}

class AddIcsonRecvAddrResp {
	var $result;
	var $errMsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errMsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x31048802;
	}
}

class DelIcsonRecvAddrReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $authKey;
	var $icsonUid;
	var $icsonAid;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->authKey = ""; // std::string
		 $this->icsonUid = 0; // uint64_t
		 $this->icsonAid = 0; // uint64_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，一般为用户登录后在浏览器cookie中的打标，用于标识请求来源浏览器，内部调用可以填随机字符串 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，为接口调用方的文件名 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID 类型为uint32_t
		$bs->pushString($this->authKey); // 序列化接口请求校验键值，如果传入的校验键值不对，请求会被拒绝 类型为std::string
		$bs->pushUint64_t($this->icsonUid); // 序列化易迅用户ID 类型为uint64_t
		$bs->pushUint64_t($this->icsonAid); // 序列化易迅用户收货地址ID 类型为uint64_t
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x31041804;
	}
}

class DelIcsonRecvAddrResp {
	var $result;
	var $errMsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errMsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x31048804;
	}
}

class GetIcsonRecvAddrReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $icsonUid;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->icsonUid = 0; // uint64_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，一般为用户登录后在浏览器cookie中的打标，用于标识请求来源浏览器，内部调用可以填随机字符串 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，为接口调用方的文件名 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID 类型为uint32_t
		$bs->pushUint64_t($this->icsonUid); // 序列化易迅用户ID 类型为uint64_t
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x31041801;
	}
}

class GetIcsonRecvAddrResp {
	var $result;
	var $icsonRecvAddrPoList;
	var $errMsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->icsonRecvAddrPoList = $bs->popObject('IcsonRecvAddrPoList'); // 反序列化易迅用户收货地址Po列表 类型为b2b2c::icson_recvaddr::po::CIcsonRecvAddrPoList
		$this->errMsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x31048801;
	}
}

class MofidyIcsonRecvAddrReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $authKey;
	var $newIcsonRecvAddrPo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->authKey = ""; // std::string
		 $this->newIcsonRecvAddrPo = new IcsonRecvAddrPo(); // b2b2c::icson_recvaddr::po::CIcsonRecvAddrPo
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，一般为用户登录后在浏览器cookie中的打标，用于标识请求来源浏览器，内部调用可以填随机字符串 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，为接口调用方的文件名 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID 类型为uint32_t
		$bs->pushString($this->authKey); // 序列化接口请求校验键值，如果传入的校验键值不对，请求会被拒绝 类型为std::string
		$bs->pushObject($this->newIcsonRecvAddrPo,'IcsonRecvAddrPo'); // 序列化易迅用户收货地址Po 类型为b2b2c::icson_recvaddr::po::CIcsonRecvAddrPo
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x31041803;
	}
}

class MofidyIcsonRecvAddrResp {
	var $result;
	var $errMsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errMsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x31048803;
	}
}

class MofidyIcsonRecvAddrDflValueReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $authKey;
	var $icsonUid;
	var $newIcsonRecvAddrPo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->authKey = ""; // std::string
		 $this->icsonUid = 0; // uint64_t
		 $this->newIcsonRecvAddrPo = new IcsonRecvAddrPo(); // b2b2c::icson_recvaddr::po::CIcsonRecvAddrPo
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，一般为用户登录后在浏览器cookie中的打标，用于标识请求来源浏览器，内部调用可以填随机字符串 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，为接口调用方的文件名 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID 类型为uint32_t
		$bs->pushString($this->authKey); // 序列化接口请求校验键值，如果传入的校验键值不对，请求会被拒绝 类型为std::string
		$bs->pushUint64_t($this->icsonUid); // 序列化易迅用户ID 类型为uint64_t
		$bs->pushObject($this->newIcsonRecvAddrPo,'IcsonRecvAddrPo'); // 序列化易迅用户收货地址Po 类型为b2b2c::icson_recvaddr::po::CIcsonRecvAddrPo
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x31041805;
	}
}

class MofidyIcsonRecvAddrDflValueResp {
	var $result;
	var $errMsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errMsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x31048805;
	}
}
?>