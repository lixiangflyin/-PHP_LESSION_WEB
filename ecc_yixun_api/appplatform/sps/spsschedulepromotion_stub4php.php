<?php
// source idl: com.icson.promotion.idl.SpsSchedulePromotion.java

//require_once "spsschedulepromotion_xxo.php";

//请求
class CheckPromotionInfoReq {
	var $uin;
	var $source;
	var $scene;
	var $itemClassNum;
	var $itemNum;
	var $whId;
	var $regionId;
	var $channelId;
	var $rulelId;
	var $SpsItemListIn;
	var $inReserve;
	var $Extent;


	function __construct() {
		 $this->uin = 0; // uint64_t
		 $this->source = ""; // std::string
		 $this->scene = 0; // uint32_t
		 $this->itemClassNum = 0; // uint32_t
		 $this->itemNum = 0; // uint32_t
		 $this->whId = 0; // uint32_t
		 $this->regionId = 0; // uint32_t
		 $this->channelId = ""; // std::string
		 $this->rulelId = new stl_vector('uint32_t'); // std::vector<uint32_t> 
		 $this->SpsItemListIn = new stl_vector('SpsItemBo'); // std::vector<icson::promotion::bo::CSpsItemBo> 
		 $this->inReserve = ""; // std::string
		 $this->Extent = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
	}	


	function Serialize(&$bs) {
		$bs->pushUint64_t($this->uin); // 序列化用户ID,登录了就填，没登录填0 类型为uint64_t
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->scene); // 序列化场景id，商详：1，购物车：2，订单确认页：3，提交订单：4 类型为uint32_t
		$bs->pushUint32_t($this->itemClassNum); // 序列化商品总款数 类型为uint32_t
		$bs->pushUint32_t($this->itemNum); // 序列化商品总件数 类型为uint32_t
		$bs->pushUint32_t($this->whId); // 序列化站点id 类型为uint32_t
		$bs->pushUint32_t($this->regionId); // 序列化地域 id，一期可以不填 类型为uint32_t
		$bs->pushString($this->channelId); // 序列化渠道id，一期可以不填 类型为std::string
		$bs->pushObject($this->rulelId, 'stl_vector'); // 序列化用户选择的促销规则id,可能有多个，一期只有一个 类型为std::vector<uint32_t> 
		$bs->pushObject($this->SpsItemListIn, 'stl_vector'); // 序列化促销商品信息列表（输入） 类型为std::vector<icson::promotion::bo::CSpsItemBo> 
		$bs->pushString($this->inReserve); // 序列化保留字段 类型为std::string
		$bs->pushObject($this->Extent, 'stl_map'); // 序列化请求保留字，拓展用，选填  类型为std::map<std::string,std::string> 

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x98151801;
	}
}
//回复
class CheckPromotionInfoResp {
	var $result;
	var $SpsItemListOut;
	var $SpsOpInfoListOut;
	var $restrictParamList;
	var $errCode;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->SpsItemListOut = $bs->popObject('stl_vector<SpsItemBo> '); // 反序列化促销商品信息列表（输出） 类型为std::vector<icson::promotion::bo::CSpsItemBo> 
		$this->SpsOpInfoListOut = $bs->popObject('stl_vector<SpsOperationInfoItemBo> '); // 反序列化规则信息列表 类型为std::vector<icson::promotion::bo::CSpsOperationInfoItemBo> 
		$this->restrictParamList = $bs->popObject('stl_vector<PromotionRestrictParamInfo_Bo> '); // 反序列化频率限制的结构体,回退限制时实用，商详不用 类型为std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> 
		$this->errCode = $bs->popUint32_t(); // 反序列化错误码 类型为uint32_t
		$this->outReserve = $bs->popString(); // 反序列化保留字段 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x98158801;
	}
}
//请求
class GetPromotionInfoReq {
	var $uin;
	var $source;
	var $scene;
	var $itemClassNum;
	var $itemNum;
	var $whId;
	var $regionId;
	var $channelId;
	var $SpsItemListIn;
	var $inReserve;
	var $Extent;


	function __construct() {
		 $this->uin = 0; // uint64_t
		 $this->source = ""; // std::string
		 $this->scene = 0; // uint32_t
		 $this->itemClassNum = 0; // uint32_t
		 $this->itemNum = 0; // uint32_t
		 $this->whId = 0; // uint32_t
		 $this->regionId = 0; // uint32_t
		 $this->channelId = ""; // std::string
		 $this->SpsItemListIn = new stl_vector('SpsItemBo'); // std::vector<icson::promotion::bo::CSpsItemBo> 
		 $this->inReserve = ""; // std::string
		 $this->Extent = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
	}	


	function Serialize(&$bs) {
		$bs->pushUint64_t($this->uin); // 序列化用户ID 类型为uint64_t
		$bs->pushString($this->source); // 序列化请求来源 类型为std::string
		$bs->pushUint32_t($this->scene); // 序列化场景id 类型为uint32_t
		$bs->pushUint32_t($this->itemClassNum); // 序列化商品总款数 类型为uint32_t
		$bs->pushUint32_t($this->itemNum); // 序列化商品总件数 类型为uint32_t
		$bs->pushUint32_t($this->whId); // 序列化站点id 类型为uint32_t
		$bs->pushUint32_t($this->regionId); // 序列化地域 id，一期可以不填 类型为uint32_t
		$bs->pushString($this->channelId); // 序列化渠道id，一期可以不填 类型为std::string
		$bs->pushObject($this->SpsItemListIn, 'stl_vector'); // 序列化促销商品信息列表（输入） 类型为std::vector<icson::promotion::bo::CSpsItemBo> 
		$bs->pushString($this->inReserve); // 序列化保留字段 类型为std::string
		$bs->pushObject($this->Extent, 'stl_map'); // 序列化请求保留字，拓展用，选填  类型为std::map<std::string,std::string> 

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0x98151802;
	}
}
//回复
class GetPromotionInfoResp {
	var $result;
	var $SpsItemListOut;
	var $SpsOpInfoListOut;
	var $errCode;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->SpsItemListOut = $bs->popObject('stl_vector<SpsItemBo> '); // 反序列化促销商品信息列表（输出） 类型为std::vector<icson::promotion::bo::CSpsItemBo> 
		$this->SpsOpInfoListOut = $bs->popObject('stl_vector<SpsOperationInfoItemBo> '); // 反序列化规则信息列表 类型为std::vector<icson::promotion::bo::CSpsOperationInfoItemBo> 
		$this->errCode = $bs->popUint32_t(); // 反序列化错误码 类型为uint32_t
		$this->outReserve = $bs->popString(); // 反序列化保留字段 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x98158802;
	}
}

?>