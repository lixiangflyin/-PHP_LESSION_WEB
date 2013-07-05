<?php
// source idl: paipai.DetailMain.java

require_once "detailmain_xxo.php";

//请求
class getCommodityDataFor51buyReq {
	var $commodityId;
	var $areaId;
	var $cooperatorId;
	var $sceneId;
	var $userData;


	function __construct() {
		 $this->commodityId = ""; // std::string
		 $this->areaId = 0; // uint32_t
		 $this->cooperatorId = 0; // uint32_t
		 $this->sceneId = 0; // uint32_t
		 $this->userData = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->commodityId); // 序列化 商品id 兼容三个平台commodity 内部做区分 如易迅填：icson-102923,必填  类型为std::string
		$bs->pushUint32_t($this->areaId); // 序列化 地域Id  类型为uint32_t
		$bs->pushUint32_t($this->cooperatorId); // 序列化 合作伙伴id,可以不填,填了只返回该合作伙伴的商品  类型为uint32_t
		$bs->pushUint32_t($this->sceneId); // 序列化 场景id，预留参数  类型为uint32_t
		$bs->pushObject($this->userData, 'stl_map'); // 序列化 用户数据，包含uin, ip, vk等等  类型为std::map<std::string,std::string> 

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x90A01001;
	}
}
//回复
class getCommodityDataFor51buyResp {
	var $result;
	var $commodityData;
	var $jsonData;
	var $errMsg;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->commodityData = $bs->popString(); // 反序列化 主屏数据  类型为std::string
		$this->jsonData = $bs->popString(); // 反序列化 商品JSON数据  类型为std::string
		$this->errMsg = $bs->popString(); // 反序列化 可以用来存error message  类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x90A08001;
	}
}
//请求
class getCommodityPureData4MobileReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $commodityId;
	var $areaId;
	var $cooperatorId;
	var $whareHouseId;
	var $userip;
	var $priceInputInfo;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint32_t
		 $this->commodityId = ""; // std::string
		 $this->areaId = 0; // uint32_t
		 $this->cooperatorId = 0; // uint32_t
		 $this->whareHouseId = 0; // uint32_t
		 $this->userip = ""; // std::string
		 $this->priceInputInfo = new MultPriceInputInfo(); // CMultPriceInputInfo
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化客户端机器码（浏览器客户端唯一ID），必填  类型为std::string
		$bs->pushString($this->source); // 序列化调用来源 填文件名or函数名即可，必填  类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化如果使用appplatform调用 填命令号，必填 类型为uint32_t
		$bs->pushUint32_t($this->option); // 序列化 option，数据类型内容参数,默认填0，表示拉取全部数据  类型为uint32_t
		$bs->pushString($this->commodityId); // 序列化 易讯商品id 如id:102923,必填  类型为std::string
		$bs->pushUint32_t($this->areaId); // 序列化 地域Id 网购地域id 类型为uint32_t
		$bs->pushUint32_t($this->cooperatorId); // 序列化 合作伙伴id,易讯商品此处填写855006089  类型为uint32_t
		$bs->pushUint32_t($this->whareHouseId); // 序列化 仓库id，比如上海仓填1  类型为uint32_t
		$bs->pushString($this->userip); // 序列化用户ip地址 类型为std::string
		$bs->pushObject($this->priceInputInfo, 'MultPriceInputInfo'); // 序列化多价输入参数列表 类型为CMultPriceInputInfo

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x90A01002;
	}
}
//回复
class getCommodityPureData4MobileResp {
	var $result;
	var $viewPureData4Mobile;
	var $errMsg;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->viewPureData4Mobile = $bs->popObject('stl_map<stl_string,DetailPureData4Mobile> '); // 反序列化 主屏数据 ，key内容为商品id，value为商品信息 类型为std::map<std::string,CDetailPureData4Mobile> 
		$this->errMsg = $bs->popString(); // 反序列化 可以用来存error message  类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x90A08002;
	}
}

?>