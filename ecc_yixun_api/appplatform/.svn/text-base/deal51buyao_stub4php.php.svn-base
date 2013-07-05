<?php
// source idl: com.ecc.deal.idl.Deal51BuyAo.java
require_once "deal51buyao_xxo.php";

class AuditDealReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $AuditParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->AuditParams = new EventParamsAuditDealBo(); // ecc::deal::bo::CEventParamsAuditDealBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础事件参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->AuditParams,'EventParamsAuditDealBo'); // 序列化审核订单参数 类型为ecc::deal::bo::CEventParamsAuditDealBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041808;
	}
}

class AuditDealResp {
	var $result;
	var $DealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfo = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x63048808;
	}
}

class CSCreateBuyDealReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $OrderList;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->OrderList = new OrderPoList(); // ecc::deal::po::COrderPoList
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->OrderList,'OrderPoList'); // 序列化下单的订单信息 类型为ecc::deal::po::COrderPoList
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x6304181c;
	}
}

class CSCreateBuyDealResp {
	var $result;
	var $BdealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->BdealInfo = $bs->popObject('BdealPo'); // 反序列化返回的交易单信息 类型为ecc::deal::po::CBdealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x6304881c;
	}
}

class CSCreateDealReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $OrderParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->OrderParams = new OrderPo(); // ecc::deal::po::COrderPo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->OrderParams,'OrderPo'); // 序列化下单的订单信息 类型为ecc::deal::po::COrderPo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x6304181d;
	}
}

class CSCreateDealResp {
	var $result;
	var $DealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfo = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x6304881d;
	}
}

class CancelBuyDealReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化事件参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041805;
	}
}

class CancelBuyDealResp {
	var $result;
	var $BdealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->BdealInfo = $bs->popObject('BdealPo'); // 反序列化返回的交易单信息 类型为ecc::deal::po::CBdealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x63048805;
	}
}

class CancelDealReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化事件参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041806;
	}
}

class CancelDealResp {
	var $result;
	var $DealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfo = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x63048806;
	}
}

class CancelSupersessionReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础事件参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x6304181e;
	}
}

class CancelSupersessionResp {
	var $result;
	var $DealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfo = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x6304881e;
	}
}

class CloseDealReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $CloseParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->CloseParams = new EventParamsCloseDealBo(); // ecc::deal::bo::CEventParamsCloseDealBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础事件参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->CloseParams,'EventParamsCloseDealBo'); // 序列化关闭订单参数 类型为ecc::deal::bo::CEventParamsCloseDealBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041807;
	}
}

class CloseDealResp {
	var $result;
	var $DealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfo = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x63048807;
	}
}

class ConfirmRecvReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $SignParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->SignParams = new EventParamsCorpSignBo(); // ecc::deal::bo::CEventParamsCorpSignBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础事件参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->SignParams,'EventParamsCorpSignBo'); // 序列化签收事件参数 类型为ecc::deal::bo::CEventParamsCorpSignBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x6304180a;
	}
}

class ConfirmRecvResp {
	var $result;
	var $DealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfo = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x6304880a;
	}
}

class CreateBuyDealReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $OrderList;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->OrderList = new OrderPoList(); // ecc::deal::po::COrderPoList
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->OrderList,'OrderPoList'); // 序列化下单的订单信息 类型为ecc::deal::po::COrderPoList
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041801;
	}
}

class CreateBuyDealResp {
	var $result;
	var $BdealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->BdealInfo = $bs->popObject('BdealPo'); // 反序列化返回的交易单信息 类型为ecc::deal::po::CBdealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x63048801;
	}
}

class CreateDealReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $OrderParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->OrderParams = new OrderPo(); // ecc::deal::po::COrderPo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->OrderParams,'OrderPo'); // 序列化下单的订单信息 类型为ecc::deal::po::COrderPo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041802;
	}
}

class CreateDealResp {
	var $result;
	var $DealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfo = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x63048802;
	}
}

class CreateRefundReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $RefundParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->RefundParams = new EventParamsCorpCreateRefundBo(); // ecc::deal::bo::CEventParamsCorpCreateRefundBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础事件参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->RefundParams,'EventParamsCorpCreateRefundBo'); // 序列化退款参数 类型为ecc::deal::bo::CEventParamsCorpCreateRefundBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x6304180d;
	}
}

class CreateRefundResp {
	var $result;
	var $DealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfo = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x6304880d;
	}
}

class MarkShipReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $ShipParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->ShipParams = new EventParamsCorpShipBo(); // ecc::deal::bo::CEventParamsCorpShipBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础事件参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->ShipParams,'EventParamsCorpShipBo'); // 序列化发货参数 类型为ecc::deal::bo::CEventParamsCorpShipBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041809;
	}
}

class MarkShipResp {
	var $result;
	var $DealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfo = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x63048809;
	}
}

class ModifyCouponReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $CouponParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->CouponParams = new EventParamsModifyCouponBo(); // ecc::deal::bo::CEventParamsModifyCouponBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础事件参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->CouponParams,'EventParamsModifyCouponBo'); // 序列化修改参数 类型为ecc::deal::bo::CEventParamsModifyCouponBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041814;
	}
}

class ModifyCouponResp {
	var $result;
	var $DealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfo = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x63048814;
	}
}

class ModifyDealPriceReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $ModifyPriceParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->ModifyPriceParams = new EventParamsModifyDealPriceBo(); // ecc::deal::bo::CEventParamsModifyDealPriceBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础事件参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->ModifyPriceParams,'EventParamsModifyDealPriceBo'); // 序列化修改参数 类型为ecc::deal::bo::CEventParamsModifyDealPriceBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041816;
	}
}

class ModifyDealPriceResp {
	var $result;
	var $DealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfo = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x63048816;
	}
}

class ModifyInvoiceReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $InvoiceParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->InvoiceParams = new EventParamsModifyInvoiceBo(); // ecc::deal::bo::CEventParamsModifyInvoiceBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础事件参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->InvoiceParams,'EventParamsModifyInvoiceBo'); // 序列化修改参数 类型为ecc::deal::bo::CEventParamsModifyInvoiceBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041813;
	}
}

class ModifyInvoiceResp {
	var $result;
	var $DealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfo = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x63048813;
	}
}

class ModifyPayTypeReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $ModifyParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->ModifyParams = new EventParamsModifyPayTypeBo(); // ecc::deal::bo::CEventParamsModifyPayTypeBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础事件参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->ModifyParams,'EventParamsModifyPayTypeBo'); // 序列化修改参数 类型为ecc::deal::bo::CEventParamsModifyPayTypeBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041811;
	}
}

class ModifyPayTypeResp {
	var $result;
	var $DealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfo = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x63048811;
	}
}

class ModifyReceiveInfoReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $RecvInfoParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->RecvInfoParams = new EventParamsModifyRecvInfoBo(); // ecc::deal::bo::CEventParamsModifyRecvInfoBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础事件参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->RecvInfoParams,'EventParamsModifyRecvInfoBo'); // 序列化修改参数 类型为ecc::deal::bo::CEventParamsModifyRecvInfoBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041812;
	}
}

class ModifyReceiveInfoResp {
	var $result;
	var $DealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfo = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x63048812;
	}
}

class ModifyScoreReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $ScoreParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->ScoreParams = new EventParamsModifyScoreBo(); // ecc::deal::bo::CEventParamsModifyScoreBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础事件参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->ScoreParams,'EventParamsModifyScoreBo'); // 序列化修改参数 类型为ecc::deal::bo::CEventParamsModifyScoreBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041815;
	}
}

class ModifyScoreResp {
	var $result;
	var $DealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfo = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x63048815;
	}
}

class ModifySeparateInvoiceReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $ModifyParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->ModifyParams = new SyncSeparateInvoiceBo(); // ecc::deal::bo::CSyncSeparateInvoiceBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础事件参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->ModifyParams,'SyncSeparateInvoiceBo'); // 序列化修改发票参数 类型为ecc::deal::bo::CSyncSeparateInvoiceBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041820;
	}
}

class ModifySeparateInvoiceResp {
	var $result;
	var $DealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfo = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x63048820;
	}
}

class ModifyValueAddedTaxInvoiceReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $ModifyParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->ModifyParams = new SyncValueAddedTaxInvoiceBo(); // ecc::deal::bo::CSyncValueAddedTaxInvoiceBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础事件参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->ModifyParams,'SyncValueAddedTaxInvoiceBo'); // 序列化修改发票参数 类型为ecc::deal::bo::CSyncValueAddedTaxInvoiceBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x6304181f;
	}
}

class ModifyValueAddedTaxInvoiceResp {
	var $result;
	var $DealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfo = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x6304881f;
	}
}

class NotifyBuyDealPaymentReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $PayParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->PayParams = new EventParamsPayBo(); // ecc::deal::bo::CEventParamsPayBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础事件参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->PayParams,'EventParamsPayBo'); // 序列化支付通知事件参数 类型为ecc::deal::bo::CEventParamsPayBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041803;
	}
}

class NotifyBuyDealPaymentResp {
	var $result;
	var $BdealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->BdealInfo = $bs->popObject('BdealPo'); // 反序列化返回的交易单信息 类型为ecc::deal::po::CBdealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x63048803;
	}
}

class NotifyDealPaymentReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $PayParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->PayParams = new EventParamsPayBo(); // ecc::deal::bo::CEventParamsPayBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础事件参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->PayParams,'EventParamsPayBo'); // 序列化支付通知事件参数 类型为ecc::deal::bo::CEventParamsPayBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041804;
	}
}

class NotifyDealPaymentResp {
	var $result;
	var $DealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfo = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x63048804;
	}
}

class OperateGoodsReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $OperGoodsParams;
	var $ModifyPriceParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->OperGoodsParams = new EventParamsOperGoodsBo(); // ecc::deal::bo::CEventParamsOperGoodsBo
		 $this->ModifyPriceParams = new EventParamsModifyDealPriceBo(); // ecc::deal::bo::CEventParamsModifyDealPriceBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础事件参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->OperGoodsParams,'EventParamsOperGoodsBo'); // 序列化增删商品参数 类型为ecc::deal::bo::CEventParamsOperGoodsBo
		$bs->pushObject($this->ModifyPriceParams,'EventParamsModifyDealPriceBo'); // 序列化修改价格参数 类型为ecc::deal::bo::CEventParamsModifyDealPriceBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041817;
	}
}

class OperateGoodsResp {
	var $result;
	var $DealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfo = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x63048817;
	}
}

class RefuseDealReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $SignParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->SignParams = new EventParamsCorpSignBo(); // ecc::deal::bo::CEventParamsCorpSignBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础事件参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->SignParams,'EventParamsCorpSignBo'); // 序列化签收事件参数 类型为ecc::deal::bo::CEventParamsCorpSignBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x6304180b;
	}
}

class RefuseDealResp {
	var $result;
	var $DealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfo = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x6304880b;
	}
}

class SyncDealActionReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $ActionParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->ActionParams = new SyncDealActionBo(); // ecc::deal::bo::CSyncDealActionBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->ActionParams,'SyncDealActionBo'); // 序列化订单操作信息 类型为ecc::deal::bo::CSyncDealActionBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041810;
	}
}

class SyncDealActionResp {
	var $result;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x63048810;
	}
}

class SyncNonMonetaryDealInfoReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $DealInfoIn;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->DealInfoIn = new DealPo(); // ecc::deal::po::CDealPo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础事件参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->DealInfoIn,'DealPo'); // 序列化修改订单的内容，填充需要修改的字段及其UFlag，不修改的字段请勿填写 类型为ecc::deal::po::CDealPo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x6304180f;
	}
}

class SyncNonMonetaryDealInfoResp {
	var $result;
	var $DealInfoUpdate;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfoUpdate = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x6304880f;
	}
}

class SyncPickingReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $PickParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->PickParams = new EventParamsPickBo(); // ecc::deal::bo::CEventParamsPickBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础事件参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->PickParams,'EventParamsPickBo'); // 序列化签收事件参数 类型为ecc::deal::bo::CEventParamsPickBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x6304180c;
	}
}

class SyncPickingResp {
	var $result;
	var $DealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfo = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x6304880c;
	}
}

class SyncRefundReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $BaseParams;
	var $RefundParams;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->BaseParams = new EventParamsBaseBo(); // ecc::deal::bo::CEventParamsBaseBo
		 $this->RefundParams = new EventParamsCorpSyncRefundBo(); // ecc::deal::bo::CEventParamsCorpSyncRefundBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushObject($this->BaseParams,'EventParamsBaseBo'); // 序列化基础事件参数 类型为ecc::deal::bo::CEventParamsBaseBo
		$bs->pushObject($this->RefundParams,'EventParamsCorpSyncRefundBo'); // 序列化退款参数 类型为ecc::deal::bo::CEventParamsCorpSyncRefundBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x6304180e;
	}
}

class SyncRefundResp {
	var $result;
	var $DealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfo = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x6304880e;
	}
}

class SysQueryBdealReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $InfoType;
	var $HistoryFlag;
	var $Version;
	var $QueryFilter;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->InfoType = 0; // uint32_t
		 $this->HistoryFlag = 0; // uint8_t
		 $this->Version = 0; // uint32_t
		 $this->QueryFilter = new DealQueryBo(); // ecc::deal::bo::CDealQueryBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushUint32_t($this->InfoType); // 序列化信息类型 类型为uint32_t
		$bs->pushUint8_t($this->HistoryFlag); // 序列化历史订单标识，0当前订单 1历史订单 类型为uint8_t
		$bs->pushUint32_t($this->Version); // 序列化需要返回的数据版本 类型为uint32_t
		$bs->pushObject($this->QueryFilter,'DealQueryBo'); // 序列化查询条件 类型为ecc::deal::bo::CDealQueryBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x6304181b;
	}
}

class SysQueryBdealResp {
	var $result;
	var $BdealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->BdealInfo = $bs->popObject('BdealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CBdealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x6304881b;
	}
}

class SysQueryDealReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $InfoType;
	var $HistoryFlag;
	var $Version;
	var $QueryFilter;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->InfoType = 0; // uint32_t
		 $this->HistoryFlag = 0; // uint8_t
		 $this->Version = 0; // uint32_t
		 $this->QueryFilter = new DealQueryBo(); // ecc::deal::bo::CDealQueryBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushUint32_t($this->InfoType); // 序列化信息类型 类型为uint32_t
		$bs->pushUint8_t($this->HistoryFlag); // 序列化历史订单标识，0当前订单 1历史订单 类型为uint8_t
		$bs->pushUint32_t($this->Version); // 序列化需要返回的数据版本 类型为uint32_t
		$bs->pushObject($this->QueryFilter,'DealQueryBo'); // 序列化查询条件 类型为ecc::deal::bo::CDealQueryBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041819;
	}
}

class SysQueryDealResp {
	var $result;
	var $DealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfo = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x63048819;
	}
}

class UserQueryBdealReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $InfoType;
	var $HistoryFlag;
	var $Version;
	var $QueryFilter;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->InfoType = 0; // uint32_t
		 $this->HistoryFlag = 0; // uint8_t
		 $this->Version = 0; // uint32_t
		 $this->QueryFilter = new DealQueryBo(); // ecc::deal::bo::CDealQueryBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushUint32_t($this->InfoType); // 序列化信息类型 类型为uint32_t
		$bs->pushUint8_t($this->HistoryFlag); // 序列化历史订单标识，0当前订单 1历史订单 类型为uint8_t
		$bs->pushUint32_t($this->Version); // 序列化需要返回的数据版本 类型为uint32_t
		$bs->pushObject($this->QueryFilter,'DealQueryBo'); // 序列化查询条件 类型为ecc::deal::bo::CDealQueryBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x6304181a;
	}
}

class UserQueryBdealResp {
	var $result;
	var $BdealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->BdealInfo = $bs->popObject('BdealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CBdealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x6304881a;
	}
}

class UserQueryDealReq {
	var $Source;
	var $MachineKey;
	var $VerifyToken;
	var $InfoType;
	var $HistoryFlag;
	var $Version;
	var $QueryFilter;
	var $ReserveIn;

	function __construct() {
		 $this->Source = ""; // std::string
		 $this->MachineKey = ""; // std::string
		 $this->VerifyToken = ""; // std::string
		 $this->InfoType = 0; // uint32_t
		 $this->HistoryFlag = 0; // uint8_t
		 $this->Version = 0; // uint32_t
		 $this->QueryFilter = new DealQueryBo(); // ecc::deal::bo::CDealQueryBo
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->Source); // 序列化请求来源 类型为std::string
		$bs->pushString($this->MachineKey); // 序列化用户的MachineKey 类型为std::string
		$bs->pushString($this->VerifyToken); // 序列化订单系统分配的校验token 类型为std::string
		$bs->pushUint32_t($this->InfoType); // 序列化信息类型 类型为uint32_t
		$bs->pushUint8_t($this->HistoryFlag); // 序列化历史订单标识，0当前订单 1历史订单 类型为uint8_t
		$bs->pushUint32_t($this->Version); // 序列化需要返回的数据版本 类型为uint32_t
		$bs->pushObject($this->QueryFilter,'DealQueryBo'); // 序列化查询条件 类型为ecc::deal::bo::CDealQueryBo
		$bs->pushString($this->ReserveIn); // 序列化接口预留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041818;
	}
}

class UserQueryDealResp {
	var $result;
	var $DealInfo;
	var $errmsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->DealInfo = $bs->popObject('DealPo'); // 反序列化返回的订单信息 类型为ecc::deal::po::CDealPo
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化输出预留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x63048818;
	}
}
?>