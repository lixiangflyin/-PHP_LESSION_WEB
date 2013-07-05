<?php
require_once "spsdetailpromotion_xxo.php";

//请求
class GetFullDiscountRuleListReq {
	var $uin;
	var $source;
	var $scene;
	var $whId;
	var $regionId;
	var $channelId;
	var $DetailItemBoListIn;
	var $inReserve;
	var $Extent;

	function Serialize(&$bs) {
		$bs->pushUint64_t($this->uin); // 序列化用户ID 类型为uint64_t
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->scene); // 序列化场景id 类型为uint32_t
		$bs->pushUint32_t($this->whId); // 序列化站点id 类型为uint32_t
		$bs->pushUint32_t($this->regionId); // 序列化地域 id，选填 类型为uint32_t
		$bs->pushString($this->channelId); // 序列化渠道id 类型为std::string
		$bs->pushObject($this->DetailItemBoListIn, 'stl_vector'); // 序列化输入的商品列表 类型为std::vector<icson::promotion::bo::CSpsDetailItemBo> 
		$bs->pushString($this->inReserve); // 序列化保留字段 类型为std::string
		$bs->pushObject($this->Extent, 'stl_map'); // 序列化请求保留字，拓展用，选填  类型为std::map<std::string,std::string> 

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x98141801;
	}
}
//回复
class GetFullDiscountRuleListResp {
	var $result;
	var $DetailItemBoListOut;
	var $errCode;
	var $outReserve;

	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->DetailItemBoListOut = $bs->popObject('stl_vector<SpsDetailItemBo> '); // 反序列化输出的商品列表 类型为std::vector<icson::promotion::bo::CSpsDetailItemBo> 
		$this->errCode = $bs->popUint32_t(); // 反序列化错误码 类型为uint32_t
		$this->outReserve = $bs->popString(); // 反序列化保留字段 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x98148801;
	}
}

?>