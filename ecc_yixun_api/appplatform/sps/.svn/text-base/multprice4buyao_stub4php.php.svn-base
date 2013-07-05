<?php
// source idl: com.icson.multprice.idl.MultPrice4BuyAo.java

//equire_once "multprice4buyao_xxo.php";

//请求
class CalcMultPriceReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $uin;
	var $whId;
	var $regionId;
	var $channelId;
	var $ItemPriceInfoListIn;
	var $inReserve;
	var $Extent;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->uin = 0; // uint64_t
		 $this->whId = 0; // uint32_t
		 $this->regionId = 0; // uint32_t
		 $this->channelId = ""; // std::string
		 $this->ItemPriceInfoListIn = new stl_map('SpsItemBo'); // std::map<std::string,icson::promotion::bo::CSpsItemBo> 
		 $this->inReserve = ""; // std::string
		 $this->Extent = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化用户机器码 类型为std::string
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化调用场景id，必填，1:普通购物车，2:节能补贴购物车 类型为uint32_t
		$bs->pushUint64_t($this->uin); // 序列化用户id 类型为uint64_t
		$bs->pushUint32_t($this->whId); // 序列化站点id 类型为uint32_t
		$bs->pushUint32_t($this->regionId); // 序列化地域id，选填 类型为uint32_t
		$bs->pushString($this->channelId); // 序列化渠道id 类型为std::string
		$bs->pushObject($this->ItemPriceInfoListIn, 'stl_map'); // 序列化多价商品价格信息列表（输入） 类型为std::map<std::string,icson::promotion::bo::CSpsItemBo> 
		$bs->pushString($this->inReserve); // 序列化 保留输入参数,未使用  类型为std::string
		$bs->pushObject($this->Extent, 'stl_map'); // 序列化请求保留字，拓展用，选填  类型为std::map<std::string,std::string> 

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x9A001801;
	}
}
//回复
class CalcMultPriceResp {
	var $result;
	var $ItemPriceInfoListOut;
	var $restrictParamList;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->ItemPriceInfoListOut = $bs->popObject('stl_map<stl_string,SpsItemBo> '); // 反序列化多价商品价格信息列表（输出） 类型为std::map<std::string,icson::promotion::bo::CSpsItemBo> 
		$this->restrictParamList = $bs->popObject('stl_vector<PromotionRestrictParamInfo_Bo> '); // 反序列化频率限制的结构体,扣减和回退限制时实用 类型为std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化 保留输出参数,未使用  类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x9A008801;
	}
}

?>