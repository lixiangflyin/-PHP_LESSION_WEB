<?php
// source idl: com.icson.deal.idl.AttachmentAo.java
require_once "attachmentao_xxo.php";

class GetAttachmentReq {
	var $stationId;
	var $areaId;
	var $Mainproduct;
	var $ReserveIn;
	var $machineKey;
	var $sceneId;

	function __construct() {
		 $this->stationId = 0; // uint32_t
		 $this->areaId = 0; // uint32_t
		 $this->Mainproduct = new MainProduct(); // icson::deal::ddo::attachment::CMainProduct
		 $this->ReserveIn = ""; // std::string
		 $this->machineKey = ""; // std::string
		 $this->sceneId = 0; // uint32_t
	}	

	function Serialize(&$bs){
		$bs->pushUint32_t($this->stationId); // 序列化 站id  类型为uint32_t
		$bs->pushUint32_t($this->areaId); // 序列化 地域id  类型为uint32_t
		$bs->pushObject($this->Mainproduct,'MainProduct'); // 序列化 主商品信息 类型为icson::deal::ddo::attachment::CMainProduct
		$bs->pushString($this->ReserveIn); // 序列化ReserveIn 类型为std::string
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，必填 类型为uint32_t

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91141805;
	}
}

class GetAttachmentResp {
	var $result;
	var $MapMainAttachment;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->MapMainAttachment = $bs->popObject('stl_map<uint32_t,Attachment>'); // 反序列化 随心配信息列表 类型为std::map<uint32_t,icson::deal::ddo::attachment::CAttachment> 
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91148805;
	}
}

class GetGiftReq {
	var $stationId;
	var $areaId;
	var $Mainproduct;
	var $ReserveIn;
	var $machineKey;
	var $sceneId;

	function __construct() {
		 $this->stationId = 0; // uint32_t
		 $this->areaId = 0; // uint32_t
		 $this->Mainproduct = new MainProduct(); // icson::deal::ddo::attachment::CMainProduct
		 $this->ReserveIn = ""; // std::string
		 $this->machineKey = ""; // std::string
		 $this->sceneId = 0; // uint32_t
	}	

	function Serialize(&$bs){
		$bs->pushUint32_t($this->stationId); // 序列化 站id  类型为uint32_t
		$bs->pushUint32_t($this->areaId); // 序列化 地域id  类型为uint32_t
		$bs->pushObject($this->Mainproduct,'MainProduct'); // 序列化 主商品信息 类型为icson::deal::ddo::attachment::CMainProduct
		$bs->pushString($this->ReserveIn); // 序列化ReserveIn 类型为std::string
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，必填 类型为uint32_t

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91141801;
	}
}

class GetGiftResp {
	var $result;
	var $MapMainIdGift;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->MapMainIdGift = $bs->popObject('stl_map<uint32_t,stl_vector<Gift> >'); // 反序列化 赠品信息列表 类型为std::map<uint32_t,std::vector<icson::deal::ddo::attachment::CGift> > 
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91148801;
	}
}

class GetPackageByRuleIdsReq {
	var $stationId;
	var $areaId;
	var $rulesId;
	var $ReserveIn;
	var $machineKey;
	var $sceneId;

	function __construct() {
		 $this->stationId = 0; // uint32_t
		 $this->areaId = 0; // uint32_t
		 $this->rulesId = new stl_vector('uint32_t'); // std::vector<uint32_t> 
		 $this->ReserveIn = ""; // std::string
		 $this->machineKey = ""; // std::string
		 $this->sceneId = 0; // uint32_t
	}	

	function Serialize(&$bs){
		$bs->pushUint32_t($this->stationId); // 序列化 站id  类型为uint32_t
		$bs->pushUint32_t($this->areaId); // 序列化 地域id  类型为uint32_t
		$bs->pushObject($this->rulesId,'stl_vector'); // 序列化 规则id列表 类型为std::vector<uint32_t> 
		$bs->pushString($this->ReserveIn); // 序列化ReserveIn 类型为std::string
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，必填 类型为uint32_t

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91141804;
	}
}

class GetPackageByRuleIdsResp {
	var $result;
	var $MapMRuleIdPackage;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->MapMRuleIdPackage = $bs->popObject('stl_map<uint32_t,Package>'); // 反序列化 随心配信息列表 类型为std::map<uint32_t,icson::deal::ddo::attachment::CPackage> 
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91148804;
	}
}

class GetPromotionReq {
	var $stationId;
	var $areaId;
	var $Mainproduct;
	var $type;
	var $ReserveIn;
	var $machineKey;
	var $sceneId;

	function __construct() {
		 $this->stationId = 0; // uint32_t
		 $this->areaId = 0; // uint32_t
		 $this->Mainproduct = new MainProduct(); // icson::deal::ddo::attachment::CMainProduct
		 $this->type = 0; // uint32_t
		 $this->ReserveIn = ""; // std::string
		 $this->machineKey = ""; // std::string
		 $this->sceneId = 0; // uint32_t
	}	

	function Serialize(&$bs){
		$bs->pushUint32_t($this->stationId); // 序列化 站id  类型为uint32_t
		$bs->pushUint32_t($this->areaId); // 序列化 地域id  类型为uint32_t
		$bs->pushObject($this->Mainproduct,'MainProduct'); // 序列化 主商品信息 类型为icson::deal::ddo::attachment::CMainProduct
		$bs->pushUint32_t($this->type); // 序列化 查找类型 0 表示两者都需要查， 1 表示查找单品赠券 2 表示套餐 类型为uint32_t
		$bs->pushString($this->ReserveIn); // 序列化ReserveIn 类型为std::string
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，必填 类型为uint32_t

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91141803;
	}
}

class GetPromotionResp {
	var $result;
	var $promotion;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->promotion = $bs->popObject('stl_map<uint32_t,Promotion>'); // 反序列化单品促销信息 类型为std::map<uint32_t,icson::deal::ddo::attachment::CPromotion> 
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91148803;
	}
}

class GetRelativityReq {
	var $stationId;
	var $areaId;
	var $Mainproduct;
	var $ReserveIn;
	var $machineKey;
	var $sceneId;

	function __construct() {
		 $this->stationId = 0; // uint32_t
		 $this->areaId = 0; // uint32_t
		 $this->Mainproduct = new MainProduct(); // icson::deal::ddo::attachment::CMainProduct
		 $this->ReserveIn = ""; // std::string
		 $this->machineKey = ""; // std::string
		 $this->sceneId = 0; // uint32_t
	}	

	function Serialize(&$bs){
		$bs->pushUint32_t($this->stationId); // 序列化 站id  类型为uint32_t
		$bs->pushUint32_t($this->areaId); // 序列化 地域id  类型为uint32_t
		$bs->pushObject($this->Mainproduct,'MainProduct'); // 序列化 主商品信息 类型为icson::deal::ddo::attachment::CMainProduct
		$bs->pushString($this->ReserveIn); // 序列化ReserveIn 类型为std::string
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，必填 类型为uint32_t

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91141802;
	}
}

class GetRelativityResp {
	var $result;
	var $MapMainIdRelativity;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->MapMainIdRelativity = $bs->popObject('stl_map<uint32_t,stl_vector<Relativity> >'); // 反序列化 随心配信息列表 类型为std::map<uint32_t,std::vector<icson::deal::ddo::attachment::CRelativity> > 
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91148802;
	}
}
?>