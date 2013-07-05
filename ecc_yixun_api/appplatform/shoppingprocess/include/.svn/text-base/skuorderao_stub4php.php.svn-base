<?php
// source idl: com.b2b2c.skuorder.idl.SkuOrderAo.java
require_once "skuorderao_xxo.php";

class BatchLockItemReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $lockItemPo;
	var $InLocalkey;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->lockItemPo = new LockItemPo(); // b2b2c::skuorder::po::CLockItemPo
		 $this->InLocalkey = ""; // std::string
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，必填 类型为uint32_t
		$bs->pushObject($this->lockItemPo,'LockItemPo'); // 序列化锁定库存po 类型为b2b2c::skuorder::po::CLockItemPo
		$bs->pushString($this->InLocalkey); // 序列化异步调用接口返回，确认所用请求参数（如购物车等），根据需要选填 类型为std::string
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA092180A;
	}
}

class BatchLockItemResp {
	var $result;
	var $errmsg;
	var $OutLocalkey;
	var $resultLockItemPo;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->OutLocalkey = $bs->popString(); // 反序列化异步调用接口返回，确认所用返回参数（如购物车），根据需要选填 类型为std::string
		$this->resultLockItemPo = $bs->popObject('ResultLockItemPo'); // 反序列化商品锁定后返回的po信息 类型为b2b2c::skuorder::po::CResultLockItemPo
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA092880A;
	}
}

class BatchUnlockItemReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $unlockItemPo;
	var $InLocalkey;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->unlockItemPo = new stl_vector('UnlockItemPo'); // std::vector<b2b2c::skuorder::po::CUnlockItemPo> 
		 $this->InLocalkey = ""; // std::string
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，必填 类型为uint32_t
		$bs->pushObject($this->unlockItemPo,'stl_vector'); // 序列化解锁商品po 类型为std::vector<b2b2c::skuorder::po::CUnlockItemPo> 
		$bs->pushString($this->InLocalkey); // 序列化异步调用接口返回，确认所用请求参数（如购物车等），根据需要选填 类型为std::string
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA092180B;
	}
}

class BatchUnlockItemResp {
	var $result;
	var $errmsg;
	var $resultUnlockItemPo;
	var $OutLocalkey;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->resultUnlockItemPo = $bs->popObject('stl_vector<ResultUnlockItemPo>'); // 反序列化解锁返回po 类型为std::vector<b2b2c::skuorder::po::CResultUnlockItemPo> 
		$this->OutLocalkey = $bs->popString(); // 反序列化异步调用接口返回，确认所用返回参数（如购物车），根据需要选填 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA092880B;
	}
}

class DecreaseItemReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $FixupInfoPo;
	var $InLocalkey;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->FixupInfoPo = new FixupInfoPo(); // b2b2c::skuorder::po::CFixupInfoPo
		 $this->InLocalkey = ""; // std::string
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，必填 类型为uint32_t
		$bs->pushObject($this->FixupInfoPo,'FixupInfoPo'); // 序列化商品出价信息，必填 类型为b2b2c::skuorder::po::CFixupInfoPo
		$bs->pushString($this->InLocalkey); // 序列化异步调用接口返回，确认所用请求参数（如购物车等），根据需要选填 类型为std::string
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0921802;
	}
}

class DecreaseItemResp {
	var $result;
	var $errmsg;
	var $OutLocalkey;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->OutLocalkey = $bs->popString(); // 反序列化异步调用接口返回，确认所用返回参数（如购物车），根据需要选填 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0928802;
	}
}

class DecreaseProductReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $optionId;
	var $fixupInfoPo;
	var $eventPo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->optionId = 0; // uint32_t
		 $this->fixupInfoPo = new OmsFixupInfoPo(); // b2b2c::skuorder::po::COmsFixupInfoPo
		 $this->eventPo = new Event4AppPo(); // b2b2c::skuorder::po::CEvent4AppPo
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，必填 类型为uint32_t
		$bs->pushUint32_t($this->optionId); // 序列化选项，可选 类型为uint32_t
		$bs->pushObject($this->fixupInfoPo,'OmsFixupInfoPo'); // 序列化实扣请求 ,必填 类型为b2b2c::skuorder::po::COmsFixupInfoPo
		$bs->pushObject($this->eventPo,'Event4AppPo'); // 序列化事务单，必填 类型为b2b2c::skuorder::po::CEvent4AppPo
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA092180E;
	}
}

class DecreaseProductResp {
	var $result;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA092880E;
	}
}

class LockItemByDealNeedReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $FixupInfoPo;
	var $InLocalkey;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->FixupInfoPo = new FixupInfoPo(); // b2b2c::skuorder::po::CFixupInfoPo
		 $this->InLocalkey = ""; // std::string
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，必填 类型为uint32_t
		$bs->pushObject($this->FixupInfoPo,'FixupInfoPo'); // 序列化商品出价信息，必填 类型为b2b2c::skuorder::po::CFixupInfoPo
		$bs->pushString($this->InLocalkey); // 序列化异步调用接口返回，确认所用请求参数（如购物车等），根据需要选填 类型为std::string
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0921808;
	}
}

class LockItemByDealNeedResp {
	var $result;
	var $errmsg;
	var $OutLocalkey;
	var $FixupInfoRspPo;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->OutLocalkey = $bs->popString(); // 反序列化异步调用接口返回，确认所用返回参数（如购物车），根据需要选填 类型为std::string
		$this->FixupInfoRspPo = $bs->popObject('FixupInfoRspPo'); // 反序列化根据订单等业务类型需要，商品锁定生成出价记录成功后的返回参数信息 类型为b2b2c::skuorder::po::CFixupInfoRspPo
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0928808;
	}
}

class LockProductReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $optionId;
	var $lockType;
	var $fixupInfoPo;
	var $eventPo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->optionId = 0; // uint32_t
		 $this->lockType = 0; // uint32_t
		 $this->fixupInfoPo = new OmsFixupInfoPo(); // b2b2c::skuorder::po::COmsFixupInfoPo
		 $this->eventPo = new Event4AppPo(); // b2b2c::skuorder::po::CEvent4AppPo
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，必填 类型为uint32_t
		$bs->pushUint32_t($this->optionId); // 序列化选项，可选 类型为uint32_t
		$bs->pushUint32_t($this->lockType); // 序列化非活动库存锁定填0 类型为uint32_t
		$bs->pushObject($this->fixupInfoPo,'OmsFixupInfoPo'); // 序列化锁定请求 ,必填 类型为b2b2c::skuorder::po::COmsFixupInfoPo
		$bs->pushObject($this->eventPo,'Event4AppPo'); // 序列化事务单，必填 类型为b2b2c::skuorder::po::CEvent4AppPo
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA092180C;
	}
}

class LockProductResp {
	var $result;
	var $errmsg;
	var $outFixupInfoPo;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outFixupInfoPo = $bs->popObject('OmsFixupInfoPo'); // 反序列化 锁定返回  类型为b2b2c::skuorder::po::COmsFixupInfoPo
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA092880C;
	}
}

class ModifyLockNumReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $optionId;
	var $fixupInfoPo;
	var $eventPo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->optionId = 0; // uint32_t
		 $this->fixupInfoPo = new OmsFixupInfoPo(); // b2b2c::skuorder::po::COmsFixupInfoPo
		 $this->eventPo = new Event4AppPo(); // b2b2c::skuorder::po::CEvent4AppPo
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，必填 类型为uint32_t
		$bs->pushUint32_t($this->optionId); // 序列化选项，可选 类型为uint32_t
		$bs->pushObject($this->fixupInfoPo,'OmsFixupInfoPo'); // 序列化修改订单锁定请求 ,必填 类型为b2b2c::skuorder::po::COmsFixupInfoPo
		$bs->pushObject($this->eventPo,'Event4AppPo'); // 序列化事务单，必填 类型为b2b2c::skuorder::po::CEvent4AppPo
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0921810;
	}
}

class ModifyLockNumResp {
	var $result;
	var $errmsg;
	var $outFixupInfoPo;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outFixupInfoPo = $bs->popObject('OmsFixupInfoPo'); // 反序列化 修改订单锁定返回  类型为b2b2c::skuorder::po::COmsFixupInfoPo
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0928810;
	}
}

class PayLockItemReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $FixupInfoPo;
	var $InLocalkey;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->FixupInfoPo = new FixupInfoPo(); // b2b2c::skuorder::po::CFixupInfoPo
		 $this->InLocalkey = ""; // std::string
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，必填 类型为uint32_t
		$bs->pushObject($this->FixupInfoPo,'FixupInfoPo'); // 序列化商品出价信息，必填 类型为b2b2c::skuorder::po::CFixupInfoPo
		$bs->pushString($this->InLocalkey); // 序列化异步调用接口返回，确认所用请求参数（如购物车等），根据需要选填 类型为std::string
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0921807;
	}
}

class PayLockItemResp {
	var $result;
	var $errmsg;
	var $OutLocalkey;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->OutLocalkey = $bs->popString(); // 反序列化异步调用接口返回，确认所用返回参数（如购物车），根据需要选填 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0928807;
	}
}

class RealLockReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $optionId;
	var $fixupInfoPo;
	var $eventPo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->optionId = 0; // uint32_t
		 $this->fixupInfoPo = new OmsFixupInfoPo(); // b2b2c::skuorder::po::COmsFixupInfoPo
		 $this->eventPo = new Event4AppPo(); // b2b2c::skuorder::po::CEvent4AppPo
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，必填 类型为uint32_t
		$bs->pushUint32_t($this->optionId); // 序列化选项，可选 类型为uint32_t
		$bs->pushObject($this->fixupInfoPo,'OmsFixupInfoPo'); // 序列化转移锁定请求 ,必填 类型为b2b2c::skuorder::po::COmsFixupInfoPo
		$bs->pushObject($this->eventPo,'Event4AppPo'); // 序列化事务单，必填 类型为b2b2c::skuorder::po::CEvent4AppPo
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA092180F;
	}
}

class RealLockResp {
	var $result;
	var $errmsg;
	var $outFixupInfoPo;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outFixupInfoPo = $bs->popObject('OmsFixupInfoPo'); // 反序列化 转移锁定返回  类型为b2b2c::skuorder::po::COmsFixupInfoPo
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA092880F;
	}
}

class SuccessiveDecreaseItemReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $FixupInfoPo;
	var $changedDirection;
	var $InLocalkey;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint64_t
		 $this->FixupInfoPo = new FixupInfoPo(); // b2b2c::skuorder::po::CFixupInfoPo
		 $this->changedDirection = 0; // uint32_t
		 $this->InLocalkey = ""; // std::string
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，必填 类型为uint32_t
		$bs->pushUint64_t($this->option); // 序列化选项,option =0 时，表示订单调用，需要验证前次扣减序列号；option =1 时，表示fixup daemon后台的对账修复数据调用，此时不必检查前次扣减序列号； 类型为uint64_t
		$bs->pushObject($this->FixupInfoPo,'FixupInfoPo'); // 序列化商品出价信息，必填 类型为b2b2c::skuorder::po::CFixupInfoPo
		$bs->pushUint32_t($this->changedDirection); // 序列化逐次扣减的方向，必填，参考modify_stocknum_direction定义 类型为uint32_t
		$bs->pushString($this->InLocalkey); // 序列化异步调用接口返回，确认所用请求参数（如购物车等），根据需要选填 类型为std::string
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0921809;
	}
}

class SuccessiveDecreaseItemResp {
	var $result;
	var $errmsg;
	var $OutLocalkey;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->OutLocalkey = $bs->popString(); // 反序列化异步调用接口返回，确认所用返回参数（如购物车），根据需要选填 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0928809;
	}
}

class UnlockItemReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $FixupInfoPo;
	var $InLocalkey;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->FixupInfoPo = new FixupInfoPo(); // b2b2c::skuorder::po::CFixupInfoPo
		 $this->InLocalkey = ""; // std::string
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，必填 类型为uint32_t
		$bs->pushObject($this->FixupInfoPo,'FixupInfoPo'); // 序列化商品出价信息，必填 类型为b2b2c::skuorder::po::CFixupInfoPo
		$bs->pushString($this->InLocalkey); // 序列化异步调用接口返回，确认所用请求参数（如购物车等），根据需要选填 类型为std::string
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0921803;
	}
}

class UnlockItemResp {
	var $result;
	var $errmsg;
	var $OutLocalkey;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->OutLocalkey = $bs->popString(); // 反序列化异步调用接口返回，确认所用返回参数（如购物车），根据需要选填 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0928803;
	}
}

class UnlockProductReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $optionId;
	var $fixupInfoPo;
	var $eventPo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->optionId = 0; // uint32_t
		 $this->fixupInfoPo = new OmsFixupInfoPo(); // b2b2c::skuorder::po::COmsFixupInfoPo
		 $this->eventPo = new Event4AppPo(); // b2b2c::skuorder::po::CEvent4AppPo
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，必填 类型为uint32_t
		$bs->pushUint32_t($this->optionId); // 序列化选项，可选 类型为uint32_t
		$bs->pushObject($this->fixupInfoPo,'OmsFixupInfoPo'); // 序列化解锁请求 ,必填 类型为b2b2c::skuorder::po::COmsFixupInfoPo
		$bs->pushObject($this->eventPo,'Event4AppPo'); // 序列化事务单，必填 类型为b2b2c::skuorder::po::CEvent4AppPo
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA092180D;
	}
}

class UnlockProductResp {
	var $result;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA092880D;
	}
}
?>