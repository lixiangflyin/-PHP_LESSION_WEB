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
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID 类型为uint32_t
		$bs->pushObject($this->userParam,'UserParam'); // 序列化请求信息 类型为b2b2c::cms::po::CUserParam
		$bs->pushString($this->reserveIn); // 序列化保留参数 类型为std::string

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
		$this->resultList = $bs->popObject('stl_map<uint32_t,stl_vector<Content> >'); // 反序列化内容信息列表 类型为std::map<uint32_t,std::vector<b2b2c::cms::po::CContent> > 
		$this->contentTpl = $bs->popObject('ContentTemplate'); // 反序列化内容模版 类型为b2b2c::cms::po::CContentTemplate
		$this->errMsg = $bs->popString(); // 反序列化错误消息 类型为std::string
		$this->reserveOut = $bs->popString(); // 反序列化保留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x92178001;
	}
}
?>