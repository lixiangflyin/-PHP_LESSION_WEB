<?php
// source idl: com.b2b2c.account.ao.PointsAccountAo.java
require_once "pointsaccountao_xxo.php";

class GetPointsAccountReq {
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
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，保留 类型为uint32_t
		$bs->pushUint64_t($this->icsonUid); // 序列化易迅id, 暂支持32位 类型为uint64_t
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x81EA1801;
	}
}

class GetPointsAccountResp {
	var $result;
	var $pointsAccountPo;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->pointsAccountPo = $bs->popObject('PointsAccountPo'); // 反序列化积分总账信息 类型为b2b2c::account::po::CPointsAccountPo
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x81EA8801;
	}
}

class GetPointsAccountDetailReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $PointsDetailFilterPo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->PointsDetailFilterPo = new PointsAccountDetailFilterPo(); // b2b2c::account::po::CPointsAccountDetailFilterPo
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，保留 类型为uint32_t
		$bs->pushObject($this->PointsDetailFilterPo,'PointsAccountDetailFilterPo'); // 序列化积分明细查询过滤器 类型为b2b2c::account::po::CPointsAccountDetailFilterPo
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x81EA1802;
	}
}

class GetPointsAccountDetailResp {
	var $result;
	var $pointsAccountDetailPoList;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->pointsAccountDetailPoList = $bs->popObject('PointsAccountDetailPoList'); // 反序列化积分明细列表 类型为b2b2c::account::po::CPointsAccountDetailPoList
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x81EA8802;
	}
}

class PointsDeductReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $pointsVerifyPo;
	var $pointsOutPo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->pointsVerifyPo = new PointsAccessVerifyPo(); // b2b2c::account::po::CPointsAccessVerifyPo
		 $this->pointsOutPo = new PointsOutPo(); // b2b2c::account::po::CPointsOutPo
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必需   类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需   类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，保留   类型为uint32_t
		$bs->pushObject($this->pointsVerifyPo,'PointsAccessVerifyPo'); // 序列化积分操作安全校验信息PO，必需   类型为b2b2c::account::po::CPointsAccessVerifyPo
		$bs->pushObject($this->pointsOutPo,'PointsOutPo'); // 序列化积分扣减Po，必需   类型为b2b2c::account::po::CPointsOutPo
		$bs->pushString($this->inReserve); // 序列化输入保留字   类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x81EA1804;
	}
}

class PointsDeductResp {
	var $result;
	var $promotionPoints;
	var $cashPoints;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->promotionPoints = $bs->popUint32_t(); // 反序列化扣减促销积分值 类型为uint32_t
		$this->cashPoints = $bs->popUint32_t(); // 反序列化扣减现金积分值 类型为uint32_t
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息   类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字   类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x81EA8804;
	}
}

class PointsDeductV2Req {
	var $machineKey;
	var $source;
	var $sceneId;
	var $pointsVerifyPo;
	var $pointsOutReqPo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->pointsVerifyPo = new PointsAccessVerifyPo(); // b2b2c::account::po::CPointsAccessVerifyPo
		 $this->pointsOutReqPo = new PointsOutReqPo(); // b2b2c::account::po::CPointsOutReqPo
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必需   类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需   类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，保留   类型为uint32_t
		$bs->pushObject($this->pointsVerifyPo,'PointsAccessVerifyPo'); // 序列化积分操作安全校验信息PO，必需   类型为b2b2c::account::po::CPointsAccessVerifyPo
		$bs->pushObject($this->pointsOutReqPo,'PointsOutReqPo'); // 序列化积分扣减Po，必需   类型为b2b2c::account::po::CPointsOutReqPo
		$bs->pushString($this->inReserve); // 序列化输入保留字   类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x81EA1805;
	}
}

class PointsDeductV2Resp {
	var $result;
	var $pointsOutRespPo;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->pointsOutRespPo = $bs->popObject('PointsOutRespPo'); // 反序列化积分扣减Po返回值 类型为b2b2c::account::po::CPointsOutRespPo
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息   类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字   类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x81EA8805;
	}
}

class PointsDeliverReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $pointsVerifyPo;
	var $pointsInPo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->pointsVerifyPo = new PointsAccessVerifyPo(); // b2b2c::account::po::CPointsAccessVerifyPo
		 $this->pointsInPo = new PointsInPo(); // b2b2c::account::po::CPointsInPo
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必需   类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需   类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id， 0:促销积分为普通发放 (默认) 1:促销积分为礼品卡发放   类型为uint32_t
		$bs->pushObject($this->pointsVerifyPo,'PointsAccessVerifyPo'); // 序列化积分操作安全校验信息PO，必需   类型为b2b2c::account::po::CPointsAccessVerifyPo
		$bs->pushObject($this->pointsInPo,'PointsInPo'); // 序列化积分发放Po，必需   类型为b2b2c::account::po::CPointsInPo
		$bs->pushString($this->inReserve); // 序列化输入保留字段 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x81EA1803;
	}
}

class PointsDeliverResp {
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
		return 0x81EA8803;
	}
}
?>