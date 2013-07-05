<?php
// source idl: com.b2b2c.cms.OpenBiAo.java
require_once PHPLIB_ROOT . "lib/app_platform/dao/openbiao_xxo.php";

class GetContentReq {
	var $source;
	var $sceneId;
	var $userParam;
	var $reserveIn;

	function __construct() {
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->userParam = new UserParam(); // b2b2c::cms::po::CUserParam
		 $this->reserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->source); // ���л�������Դ ����Ϊstd::string
		$bs->pushUint32_t($this->sceneId); // ���л�����ID ����Ϊuint32_t
		$bs->pushObject($this->userParam,'UserParam'); // ���л�������Ϣ ����Ϊb2b2c::cms::po::CUserParam
		$bs->pushString($this->reserveIn); // ���л��������� ����Ϊstd::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x92171001;
	}
}

class GetContentResp {
	var $result;
	var $resultList;
	var $contentTpl;
	var $errMsg;
	var $reserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->resultList = $bs->popObject('stl_map<uint32_t,stl_vector<Content> >'); // �����л�������Ϣ�б� ����Ϊstd::map<uint32_t,std::vector<b2b2c::cms::po::CContent> > 
		$this->contentTpl = $bs->popObject('ContentTemplate'); // �����л�����ģ�� ����Ϊb2b2c::cms::po::CContentTemplate
		$this->errMsg = $bs->popString(); // �����л�������Ϣ ����Ϊstd::string
		$this->reserveOut = $bs->popString(); // �����л��������� ����Ϊstd::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x92178001;
	}
}
?>