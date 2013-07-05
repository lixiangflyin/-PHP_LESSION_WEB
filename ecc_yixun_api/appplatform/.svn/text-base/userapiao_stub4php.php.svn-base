<?php
// source idl: idl.UserApiAo.java

require_once "userapiao_xxo.php";

//请求
class ImportCopartnerInvoiceReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $loginName;
	var $loginNameType;
	var $copartnerInvoice;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->loginName = ""; // std::string
		 $this->loginNameType = 0; // uint32_t
		 $this->copartnerInvoice = new stl_vector('CopartnerInvoicePo'); // std::vector<b2b2c::invoice::po::CCopartnerInvoicePo> 
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，易迅侧填1 类型为uint32_t
		$bs->pushString($this->loginName); // 序列化登录帐号，必需 类型为std::string
		$bs->pushUint32_t($this->loginNameType); // 序列化登录帐号类型，0-QQ号 1-个性化帐号 100-第三方帐号，必需 类型为uint32_t
		$bs->pushObject($this->copartnerInvoice, 'stl_vector'); // 序列化合作方发票簿po，必需 类型为std::vector<b2b2c::invoice::po::CCopartnerInvoicePo> 
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0A41803;
	}
}
//回复
class ImportCopartnerInvoiceResp {
	var $result;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0A48803;
	}
}
//请求
class ImportCopartnerRecvaddrReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $loginName;
	var $loginNameType;
	var $copartnerRecvaddr;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->loginName = ""; // std::string
		 $this->loginNameType = 0; // uint32_t
		 $this->copartnerRecvaddr = new stl_vector('CopartnerRecvaddrPo'); // std::vector<b2b2c::recvaddr::po::CCopartnerRecvaddrPo> 
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，易迅侧填1 类型为uint32_t
		$bs->pushString($this->loginName); // 序列化登录帐号，必需 类型为std::string
		$bs->pushUint32_t($this->loginNameType); // 序列化登录帐号类型，0-QQ号 1-个性化帐号 100-第三方帐号，必需 类型为uint32_t
		$bs->pushObject($this->copartnerRecvaddr, 'stl_vector'); // 序列化合作方收货地址po，必需 类型为std::vector<b2b2c::recvaddr::po::CCopartnerRecvaddrPo> 
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0A41802;
	}
}
//回复
class ImportCopartnerRecvaddrResp {
	var $result;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0A48802;
	}
}
//请求
class ImportCopartnerUserInfoReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $loginName;
	var $loginNameType;
	var $copartnerUserInfo;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->loginName = ""; // std::string
		 $this->loginNameType = 0; // uint32_t
		 $this->copartnerUserInfo = new CopartnerUserInfoPo(); // b2b2c::user::po::CCopartnerUserInfoPo
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，易迅侧填1 类型为uint32_t
		$bs->pushString($this->loginName); // 序列化登录帐号，必需 类型为std::string
		$bs->pushUint32_t($this->loginNameType); // 序列化登录帐号类型，0-QQ号 1-个性化帐号 100-第三方帐号，必需 类型为uint32_t
		$bs->pushObject($this->copartnerUserInfo, 'CopartnerUserInfoPo'); // 序列化合作方用户信息po，必需 类型为b2b2c::user::po::CCopartnerUserInfoPo
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0A41801;
	}
}
//回复
class ImportCopartnerUserInfoResp {
	var $result;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0A48801;
	}
}
//请求
class SetNonNewUserFlagReq {
	var $machineKey;
	var $source;
	var $uin;
	var $uinType;
	var $flagValue;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->uin = 0; // uint32_t
		 $this->uinType = 0; // uint32_t
		 $this->flagValue = 0; // uint8_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->uin); // 序列化用户uin 类型为uint32_t
		$bs->pushUint32_t($this->uinType); // 序列化用户uin类型，必需，0-QQ号 1-用户内部id，参见E_USER_UID_TYPE 类型为uint32_t
		$bs->pushUint8_t($this->flagValue); // 序列化非新用户用户标的设置值，0-复位 1-置位 类型为uint8_t
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0A41804;
	}
}
//回复
class SetNonNewUserFlagResp {
	var $result;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0A48804;
	}
}

?>