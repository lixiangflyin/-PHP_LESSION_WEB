<?php
// source idl: com.icson.promotionrestrict.idl.PromotionRestrictAo.java

//require_once "promotionrestrictao_xxo.php";

//����
class GetActiveBatchPromotionRestrictReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $uin;
	var $restrictParamListIn;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->uin = 0; // uint64_t
		 $this->restrictParamListIn = new stl_vector('PromotionRestrictParamInfo_Bo'); // std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // ���л��û������� ����Ϊstd::string
		$bs->pushString($this->source); // ���л�������Դ ����Ϊstd::string
		$bs->pushUint32_t($this->sceneId); // ���л�����id ����Ϊuint32_t
		$bs->pushUint64_t($this->uin); // ���л��û�Id ����Ϊuint64_t
		$bs->pushObject($this->restrictParamListIn, 'stl_vector'); // ���л���ϸҵ��������� ����Ϊstd::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x9A101805;
	}
}
//�ظ�
class GetActiveBatchPromotionRestrictResp {
	var $result;
	var $restrictParamListOut;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->restrictParamListOut = $bs->popObject('stl_vector<PromotionRestrictParamInfo_Bo> '); // �����л���ϸҵ��������� ����Ϊstd::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 
		$this->errmsg = $bs->popString(); // �����л�������Ϣ ����Ϊstd::string
		$this->outReserve = $bs->popString(); // �����л� �����������,δʹ��  ����Ϊstd::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x9A108805;
	}
}
//����
class GetDealBatchPromotionRestrictReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $uin;
	var $restrictParamListIn;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->uin = 0; // uint64_t
		 $this->restrictParamListIn = new stl_vector('PromotionRestrictParamInfo_Bo'); // std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // ���л��û������� ����Ϊstd::string
		$bs->pushString($this->source); // ���л�������Դ ����Ϊstd::string
		$bs->pushUint32_t($this->sceneId); // ���л�����id ����Ϊuint32_t
		$bs->pushUint64_t($this->uin); // ���л��û�Id ����Ϊuint64_t
		$bs->pushObject($this->restrictParamListIn, 'stl_vector'); // ���л���ϸҵ��������� ����Ϊstd::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x9A101802;
	}
}
//�ظ�
class GetDealBatchPromotionRestrictResp {
	var $result;
	var $restrictParamListOut;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->restrictParamListOut = $bs->popObject('stl_vector<PromotionRestrictParamInfo_Bo> '); // �����л���ϸҵ��������� ����Ϊstd::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 
		$this->errmsg = $bs->popString(); // �����л�������Ϣ ����Ϊstd::string
		$this->outReserve = $bs->popString(); // �����л� �����������,δʹ��  ����Ϊstd::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x9A108802;
	}
}
//����
class GetShopCartBatchPromotionRestrictReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $uin;
	var $restrictParamListIn;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->uin = 0; // uint64_t
		 $this->restrictParamListIn = new stl_vector('PromotionRestrictParamInfo_Bo'); // std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // ���л��û������� ����Ϊstd::string
		$bs->pushString($this->source); // ���л�������Դ ����Ϊstd::string
		$bs->pushUint32_t($this->sceneId); // ���л�����id ����Ϊuint32_t
		$bs->pushUint64_t($this->uin); // ���л��û�Id ����Ϊuint64_t
		$bs->pushObject($this->restrictParamListIn, 'stl_vector'); // ���л���ϸҵ��������� ����Ϊstd::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x9A101803;
	}
}
//�ظ�
class GetShopCartBatchPromotionRestrictResp {
	var $result;
	var $restrictParamListOut;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->restrictParamListOut = $bs->popObject('stl_vector<PromotionRestrictParamInfo_Bo> '); // �����л���ϸҵ��������� ����Ϊstd::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 
		$this->errmsg = $bs->popString(); // �����л�������Ϣ ����Ϊstd::string
		$this->outReserve = $bs->popString(); // �����л� �����������,δʹ��  ����Ϊstd::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x9A108803;
	}
}
//����
class GetSingleRulePromotionRestrictReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $uin;
	var $restrictParamListIn;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->uin = 0; // uint64_t
		 $this->restrictParamListIn = new stl_vector('PromotionRestrictParamInfo_Bo'); // std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // ���л��û������� ����Ϊstd::string
		$bs->pushString($this->source); // ���л�������Դ ����Ϊstd::string
		$bs->pushUint32_t($this->sceneId); // ���л�����id ����Ϊuint32_t
		$bs->pushUint64_t($this->uin); // ���л��û�Id ����Ϊuint64_t
		$bs->pushObject($this->restrictParamListIn, 'stl_vector'); // ���л���ϸҵ��������� ����Ϊstd::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x9A101801;
	}
}
//�ظ�
class GetSingleRulePromotionRestrictResp {
	var $result;
	var $restrictParamListOnt;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->restrictParamListOnt = $bs->popObject('stl_vector<PromotionRestrictParamInfo_Bo> '); // �����л���ϸҵ��������� ����Ϊstd::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 
		$this->errmsg = $bs->popString(); // �����л�������Ϣ ����Ϊstd::string
		$this->outReserve = $bs->popString(); // �����л� �����������,δʹ��  ����Ϊstd::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x9A108801;
	}
}
//����
class RollbackDealBatchPromotionRestrictReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $uin;
	var $restrictParamListIn;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->uin = 0; // uint64_t
		 $this->restrictParamListIn = new stl_vector('PromotionRestrictParamInfo_Bo'); // std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // ���л��û������� ����Ϊstd::string
		$bs->pushString($this->source); // ���л�������Դ ����Ϊstd::string
		$bs->pushUint32_t($this->sceneId); // ���л�����id ����Ϊuint32_t
		$bs->pushUint64_t($this->uin); // ���л��û�Id ����Ϊuint64_t
		$bs->pushObject($this->restrictParamListIn, 'stl_vector'); // ���л���ϸҵ��������� ����Ϊstd::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x9A101804;
	}
}
//�ظ�
class RollbackDealBatchPromotionRestrictResp {
	var $result;
	var $restrictParamListOut;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->restrictParamListOut = $bs->popObject('stl_vector<PromotionRestrictParamInfo_Bo> '); // �����л���ϸҵ��������� ����Ϊstd::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 
		$this->errmsg = $bs->popString(); // �����л�������Ϣ ����Ϊstd::string
		$this->outReserve = $bs->popString(); // �����л� �����������,δʹ��  ����Ϊstd::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x9A108804;
	}
}

?>