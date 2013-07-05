<?php
// source idl: com.icson.multprice.idl.MultPrice4PageAo.java
require_once "multprice4pageao_xxo.php";

class GetMultprice4pageReq {
	var $machineKey;
	var $source;
	var $regionId;
	var $substationId;
	var $uin;
	var $multPriceItemBo4PageList;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->regionId = 0; // uint32_t
		 $this->substationId = 0; // uint32_t
		 $this->uin = 0; // uint32_t
		 $this->multPriceItemBo4PageList = new stl_vector('MultPriceItem4PageBo'); // std::vector<icson::multprice::bo::CMultPriceItem4PageBo> 
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // ���л��û������� ����Ϊstd::string
		$bs->pushString($this->source); // ���л�������Դ ����Ϊstd::string
		$bs->pushUint32_t($this->regionId); // ���л����� id��ѡ�� ����Ϊuint32_t
		$bs->pushUint32_t($this->substationId); // ���л���վid ����Ϊuint32_t
		$bs->pushUint32_t($this->uin); // ���л��û�id ����Ϊuint32_t
		$bs->pushObject($this->multPriceItemBo4PageList,'stl_vector'); // ���л���ѯ����Ʒ��Ϣ ����Ϊstd::vector<icson::multprice::bo::CMultPriceItem4PageBo> 
		$bs->pushString($this->inReserve); // ���л� �����������,δʹ��  ����Ϊstd::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x9a011801;
	}
}

class GetMultprice4pageResp {
	var $result;
	var $multPriceRules4PageBoList;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->multPriceRules4PageBoList = $bs->popObject('stl_map<stl_string,MultPriceRules4PageBo>'); // �����л���Ʒ�����Ϣ�б�,string��Ʒitemid ����Ϊstd::map<std::string,icson::multprice::bo::CMultPriceRules4PageBo> 
		$this->errmsg = $bs->popString(); // �����л�������Ϣ ����Ϊstd::string
		$this->outReserve = $bs->popString(); // �����л� �����������,δʹ��  ����Ϊstd::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x9a018801;
	}
}
?>