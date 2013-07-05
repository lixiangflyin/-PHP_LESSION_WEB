<?php
// source idl: com.icson.smart_tf.idl.ContentDao.java
require_once PHPLIB_ROOT . "api/appplatform/contentdao_xxo.php";

class GetContentReq {
	var $source;
	var $sceneId;
	var $userParam;
	var $contentParam;
	var $reserveIn;

	function __construct() {
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->userParam = new UserParam(); // b2b2c::cms::po::CUserParam
		 $this->contentParam = new stl_vector('ContentParam'); // std::vector<b2b2c::cms::po::CContentParam> 
		 $this->reserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID 类型为uint32_t
		$bs->pushObject($this->userParam,'UserParam'); // 序列化用户请求参数 类型为b2b2c::cms::po::CUserParam
		$bs->pushObject($this->contentParam,'stl_vector'); // 序列化内容请求参数 类型为std::vector<b2b2c::cms::po::CContentParam> 
		$bs->pushString($this->reserveIn); // 序列化保留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x92161001;
	}
}

class GetContentResp {
	var $result;
	var $resultList;
	var $errMsg;
	var $reserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->resultList = $bs->popObject('stl_map<uint32_t,stl_vector<Content> >'); // 反序列化内容信息列表 类型为std::map<uint32_t,std::vector<b2b2c::cms::po::CContent> > 
		$this->errMsg = $bs->popString(); // 反序列化错误消息 类型为std::string
		$this->reserveOut = $bs->popString(); // 反序列化保留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x92168001;
	}
}

class GetProductReq {
	var $source;
	var $sceneId;
	var $reqParam;
	var $reserveIn;

	function __construct() {
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->reqParam = new ProductParam(); // b2b2c::cms::po::CProductParam
		 $this->reserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID 类型为uint32_t
		$bs->pushObject($this->reqParam,'ProductParam'); // 序列化请求信息 类型为b2b2c::cms::po::CProductParam
		$bs->pushString($this->reserveIn); // 序列化保留参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x92161101;
	}
}

class GetProductResp {
	var $result;
	var $productList;
	var $errMsg;
	var $reserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->productList = $bs->popObject('stl_vector<Content>'); // 反序列化商品信息列表 类型为std::vector<b2b2c::cms::po::CContent> 
		$this->errMsg = $bs->popString(); // 反序列化错误消息 类型为std::string
		$this->reserveOut = $bs->popString(); // 反序列化保留参数 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x92168101;
	}
}
?>