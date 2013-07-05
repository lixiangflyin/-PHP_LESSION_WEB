<?php
// source idl: icson.score.ao.IcsonScoreAo.java
require_once "icsonscoreao_xxo.php";

class ScoreAddReq {
	var $machineKey;
	var $source;
	var $busiCode;
	var $busiVerifyCode;
	var $operationName;
	var $busiUniqId;
	var $AddScorePo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->busiCode = 0; // uint32_t
		 $this->busiVerifyCode = ""; // std::string
		 $this->operationName = ""; // std::string
		 $this->busiUniqId = ""; // std::string
		 $this->AddScorePo = new AddScorePo(); // icson::score::po::CAddScorePo
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // ���л�������,�ͻ�����IP,���� ����Ϊstd::string
		$bs->pushString($this->source); // ���л�������Դ,���� ����Ϊstd::string
		$bs->pushUint32_t($this->busiCode); // ���л�ҵ���룬��kuijiang����,���� ����Ϊuint32_t
		$bs->pushString($this->busiVerifyCode); // ���л�ҵ�������룬��kuijiang����,���� ����Ϊstd::string
		$bs->pushString($this->operationName); // ���л�����������������ҵ�����ƣ�����Ϊ�� ����Ϊstd::string
		$bs->pushString($this->busiUniqId); // ���л��жϱ��������Ψһ��ʶ,���� ����Ϊstd::string
		$bs->pushObject($this->AddScorePo,'AddScorePo'); // ���л� ���ַ���Po������   ����Ϊicson::score::po::CAddScorePo
		$bs->pushString($this->inReserve); // ���л����뱣���� ����Ϊstd::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x90c01801;
	}
}

class ScoreAddResp {
	var $result;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // �����л�������ʾ��Ϣ   ����Ϊstd::string
		$this->outReserve = $bs->popString(); // �����л����������   ����Ϊstd::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x90c08801;
	}
}

class ScoreSubReq {
	var $machineKey;
	var $source;
	var $busiCode;
	var $busiVerifyCode;
	var $operationName;
	var $busiUniqId;
	var $subScorePo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->busiCode = 0; // uint32_t
		 $this->busiVerifyCode = ""; // std::string
		 $this->operationName = ""; // std::string
		 $this->busiUniqId = ""; // std::string
		 $this->subScorePo = new SubScorePo(); // icson::score::po::CSubScorePo
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // ���л�������,�ͻ�����IP,���� ����Ϊstd::string
		$bs->pushString($this->source); // ���л�������Դ,���� ����Ϊstd::string
		$bs->pushUint32_t($this->busiCode); // ���л�ҵ���룬��kuijiang����,���� ����Ϊuint32_t
		$bs->pushString($this->busiVerifyCode); // ���л�ҵ�������룬��kuijiang����,���� ����Ϊstd::string
		$bs->pushString($this->operationName); // ���л�����������������ҵ�����ƣ�����Ϊ�� ����Ϊstd::string
		$bs->pushString($this->busiUniqId); // ���л��жϱ��������Ψһ��ʶ,�ݲ����� ����Ϊstd::string
		$bs->pushObject($this->subScorePo,'SubScorePo'); // ���л� ���ֿۼ�Po������   ����Ϊicson::score::po::CSubScorePo
		$bs->pushString($this->inReserve); // ���л����뱣���� ����Ϊstd::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x90c01802;
	}
}

class ScoreSubResp {
	var $result;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // �����л�������ʾ��Ϣ   ����Ϊstd::string
		$this->outReserve = $bs->popString(); // �����л����������   ����Ϊstd::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x90c08802;
	}
}
?>