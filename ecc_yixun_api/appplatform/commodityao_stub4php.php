<?php
// source idl: com.b2b2c.commodity.idl.CommodityAo.java

require_once "commodityao_xxo.php";

//请求
class BaseModifyBasicReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $ordinaryInfo;
	var $skuAttr;
	var $skuId;
	var $cooperatorId;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->ordinaryInfo = new OrdinaryInfoPo(); // b2b2c::commodity::po::COrdinaryInfoPo
		 $this->skuAttr = ""; // std::string
		 $this->skuId = 0; // uint64_t
		 $this->cooperatorId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushObject($this->ordinaryInfo, 'OrdinaryInfoPo'); // 序列化一般信息，这个结构对应的就是sku信息里可以让合作伙伴修改的部分，必填 类型为b2b2c::commodity::po::COrdinaryInfoPo
		$bs->pushString($this->skuAttr); // 序列化sku一般属性，必填 类型为std::string
		$bs->pushUint64_t($this->skuId); // 序列化skuid，必填 类型为uint64_t
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0901822;
	}
}
//回复
class BaseModifyBasicResp {
	var $result;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0908822;
	}
}
//请求
class BaseModifyStockReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $stockInfo;
	var $skuId;
	var $cooperatorId;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->stockInfo = new stl_vector('StockInfoPo'); // std::vector<b2b2c::commodity::po::CStockInfoPo> 
		 $this->skuId = 0; // uint64_t
		 $this->cooperatorId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushObject($this->stockInfo, 'stl_vector'); // 序列化库存信息，必填 类型为std::vector<b2b2c::commodity::po::CStockInfoPo> 
		$bs->pushUint64_t($this->skuId); // 序列化skuid，必填 类型为uint64_t
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0901823;
	}
}
//回复
class BaseModifyStockResp {
	var $result;
	var $errmsg;
	var $afStockInfo;
	var $OutReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->afStockInfo = $bs->popObject('stl_vector<ApiStockPo> '); // 反序列化库存信息返回结构体 类型为std::vector<b2b2c::commodity::po::CApiStockPo> 
		$this->OutReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0908823;
	}
}
//请求
class BaseUploadBasicReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $keyInfo;
	var $ordinaryInfo;
	var $stockInfo;
	var $apiMultPriceRulesForSkuPo;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->keyInfo = new KeyInfoPo(); // b2b2c::commodity::po::CKeyInfoPo
		 $this->ordinaryInfo = new OrdinaryInfoPo(); // b2b2c::commodity::po::COrdinaryInfoPo
		 $this->stockInfo = new stl_vector('StockInfoPo'); // std::vector<b2b2c::commodity::po::CStockInfoPo> 
		 $this->apiMultPriceRulesForSkuPo = new ApiMultPriceRulesForSkuPo(); // b2b2c::commodity::po::CApiMultPriceRulesForSkuPo
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushObject($this->keyInfo, 'KeyInfoPo'); // 序列化关键信息，我们用来聚合spu和sku，必填 类型为b2b2c::commodity::po::CKeyInfoPo
		$bs->pushObject($this->ordinaryInfo, 'OrdinaryInfoPo'); // 序列化一般信息，合作伙伴信息提供用来展示或搜索的信息，必填 类型为b2b2c::commodity::po::COrdinaryInfoPo
		$bs->pushObject($this->stockInfo, 'stl_vector'); // 序列化库存信息，必填 类型为std::vector<b2b2c::commodity::po::CStockInfoPo> 
		$bs->pushObject($this->apiMultPriceRulesForSkuPo, 'ApiMultPriceRulesForSkuPo'); // 序列化sku多价信息，没有可不填 类型为b2b2c::commodity::po::CApiMultPriceRulesForSkuPo
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA090181E;
	}
}
//回复
class BaseUploadBasicResp {
	var $result;
	var $errmsg;
	var $skuId;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->skuId = $bs->popUint64_t(); // 反序列化skuid，合作伙伴那边的基本商品单位转换到我们这边的编码 类型为uint64_t
		$this->outReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA090881E;
	}
}
//请求
class BaseUploadDetailsReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $skuDetailInfo;
	var $skuId;
	var $cooperatorId;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->skuDetailInfo = new stl_vector('SkuDetailInfoPo'); // std::vector<b2b2c::commodity::po::CSkuDetailInfoPo> 
		 $this->skuId = 0; // uint64_t
		 $this->cooperatorId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushObject($this->skuDetailInfo, 'stl_vector'); // 序列化详情，必填 类型为std::vector<b2b2c::commodity::po::CSkuDetailInfoPo> 
		$bs->pushUint64_t($this->skuId); // 序列化skuid，必填 类型为uint64_t
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA090181F;
	}
}
//回复
class BaseUploadDetailsResp {
	var $result;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA090881F;
	}
}
//请求
class BaseUploadPictureReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $skuPic;
	var $skuId;
	var $cooperatorId;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->skuPic = new SkuPicPo(); // b2b2c::commodity::po::CSkuPicPo
		 $this->skuId = 0; // uint64_t
		 $this->cooperatorId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushObject($this->skuPic, 'SkuPicPo'); // 序列化图片，必填 类型为b2b2c::commodity::po::CSkuPicPo
		$bs->pushUint64_t($this->skuId); // 序列化skuid，必填 类型为uint64_t
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0901821;
	}
}
//回复
class BaseUploadPictureResp {
	var $result;
	var $errmsg;
	var $picName;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->picName = $bs->popString(); // 反序列化图片名称 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0908821;
	}
}
//请求
class BatchUpdateMultPriceRuleReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $skuId;
	var $ApiMultPriceRulesForSkuPo;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint8_t
		 $this->skuId = 0; // uint64_t
		 $this->ApiMultPriceRulesForSkuPo = new ApiMultPriceRulesForSkuPo(); // b2b2c::commodity::po::CApiMultPriceRulesForSkuPo
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化机器码，必填  类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填  类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，必填  类型为uint32_t
		$bs->pushUint8_t($this->option); // 序列化选项，暂未用  类型为uint8_t
		$bs->pushUint64_t($this->skuId); // 序列化skuid 类型为uint64_t
		$bs->pushObject($this->ApiMultPriceRulesForSkuPo, 'ApiMultPriceRulesForSkuPo'); // 序列化sku多价信息 类型为b2b2c::commodity::po::CApiMultPriceRulesForSkuPo
		$bs->pushString($this->inReserve); // 序列化请求保留字  类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0901811;
	}
}
//回复
class BatchUpdateMultPriceRuleResp {
	var $result;
	var $errmsg;
	var $afApiMultPriceRulesForSkuPo;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息,调试使用  类型为std::string
		$this->afApiMultPriceRulesForSkuPo = $bs->popObject('ApiMultPriceRulesForSkuPo'); // 反序列化sku多价信息返回结构体 类型为b2b2c::commodity::po::CApiMultPriceRulesForSkuPo
		$this->outReserve = $bs->popString(); // 反序列化返回保留字   类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0908811;
	}
}
//请求
class DelCommodityPicReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $skuId;
	var $cooperatorId;
	var $metaId;
	var $index;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->skuId = 0; // uint64_t
		 $this->cooperatorId = 0; // uint32_t
		 $this->metaId = 0; // uint32_t
		 $this->index = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint64_t($this->skuId); // 序列化skuid，必填 类型为uint64_t
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填 类型为uint32_t
		$bs->pushUint32_t($this->metaId); // 序列化sku所属品类id 类型为uint32_t
		$bs->pushUint32_t($this->index); // 序列化需要删除的图片index 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA090180b;
	}
}
//回复
class DelCommodityPicResp {
	var $result;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA090880b;
	}
}
//请求
class DelMultPriceRuleBySkuIdReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $cooperatorId;
	var $skuId;
	var $multPriceQueryPo;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint8_t
		 $this->cooperatorId = 0; // uint32_t
		 $this->skuId = 0; // uint64_t
		 $this->multPriceQueryPo = new MultPriceQueryPo(); // b2b2c::commodity::po::CMultPriceQueryPo
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化机器码，必填  类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填  类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，必填  类型为uint32_t
		$bs->pushUint8_t($this->option); // 序列化选项，暂未用  类型为uint8_t
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填 类型为uint32_t
		$bs->pushUint64_t($this->skuId); // 序列化skuid，必填 类型为uint64_t
		$bs->pushObject($this->multPriceQueryPo, 'MultPriceQueryPo'); // 序列化query po，必填，根据querypo里面字段作为删除条件 类型为b2b2c::commodity::po::CMultPriceQueryPo
		$bs->pushString($this->inReserve); // 序列化请求保留字  类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0901812;
	}
}
//回复
class DelMultPriceRuleBySkuIdResp {
	var $result;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息,调试使用  类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化返回保留字   类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0908812;
	}
}
//请求
class DeleteSkuReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $skuId;
	var $cooperatorId;
	var $metaId;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->skuId = 0; // uint64_t
		 $this->cooperatorId = 0; // uint32_t
		 $this->metaId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint64_t($this->skuId); // 序列化skuid，必填 类型为uint64_t
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填 类型为uint32_t
		$bs->pushUint32_t($this->metaId); // 序列化sku所属品类id 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0901806;
	}
}
//回复
class DeleteSkuResp {
	var $result;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0908806;
	}
}
//请求
class DoReUploadReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $skuFilterPo;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint32_t
		 $this->skuFilterPo = new SkuFilterPo(); // b2b2c::commodity::po::CSkuFilterPo
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化机器码,必填  类型为std::string
		$bs->pushString($this->source); // 序列化请求来源标识,必填  类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id,必填  类型为uint32_t
		$bs->pushUint32_t($this->option); // 序列化选项，0--先检查再执行修改，1--只检查不修改  类型为uint32_t
		$bs->pushObject($this->skuFilterPo, 'SkuFilterPo'); // 序列化SkuFilterPo，必填 类型为b2b2c::commodity::po::CSkuFilterPo
		$bs->pushString($this->inReserve); // 序列化保留输入参数,未使用  类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0901816;
	}
}
//回复
class DoReUploadResp {
	var $result;
	var $errmsg;
	var $messRet;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->messRet = $bs->popObject('stl_vector<MessRetPo> '); // 反序列化返回信息 类型为std::vector<b2b2c::commodity::po::CMessRetPo> 
		$this->outReserve = $bs->popString(); // 反序列化保留输出参数,未使用 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0908816;
	}
}
//请求
class FetchSpuInfoReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $fetchSpuPoFilter;
	var $authorization;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint32_t
		 $this->fetchSpuPoFilter = new ApiFetchSpuPoFilter(); // b2b2c::commodity::po::CApiFetchSpuPoFilter
		 $this->authorization = new AuthorizationField4Web(); // b2b2c::comm::CAuthorizationField4Web
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化 机器码,必填  类型为std::string
		$bs->pushString($this->source); // 序列化 请求来源标识,必填  类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化 场景id,必填  类型为uint32_t
		$bs->pushUint32_t($this->option); // 序列化选项，暂未用  类型为uint32_t
		$bs->pushObject($this->fetchSpuPoFilter, 'ApiFetchSpuPoFilter'); // 序列化 spu filter, 必填 类型为b2b2c::commodity::po::CApiFetchSpuPoFilter
		$bs->pushObject($this->authorization, 'AuthorizationField4Web'); // 序列化权限记录 类型为b2b2c::comm::CAuthorizationField4Web
		$bs->pushString($this->inReserve); // 序列化 保留输入参数,未使用  类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA090180C;
	}
}
//回复
class FetchSpuInfoResp {
	var $result;
	var $errmsg;
	var $apiSpuPo;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化 错误信息 类型为std::string
		$this->apiSpuPo = $bs->popObject('ApiSpuPo'); // 反序列化 spu 信息 类型为b2b2c::commodity::po::CApiSpuPo
		$this->outReserve = $bs->popString(); // 反序列化 保留输出参数,未使用  类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA090880C;
	}
}
//请求
class GetCommodityIdReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $skuId;
	var $cooperatorId;
	var $metaId;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->skuId = 0; // uint64_t
		 $this->cooperatorId = 0; // uint32_t
		 $this->metaId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint64_t($this->skuId); // 序列化skuid，必填 类型为uint64_t
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填 类型为uint32_t
		$bs->pushUint32_t($this->metaId); // 序列化sku所属品类id 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0901809;
	}
}
//回复
class GetCommodityIdResp {
	var $result;
	var $errmsg;
	var $SpuCommodityId;
	var $CommCommodityId;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->SpuCommodityId = $bs->popString(); // 反序列化spu化商品id 类型为std::string
		$this->CommCommodityId = $bs->popString(); // 反序列化一般商品id 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0908809;
	}
}
//请求
class GetCommodityPicReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $skuId;
	var $cooperatorId;
	var $metaId;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->skuId = 0; // uint64_t
		 $this->cooperatorId = 0; // uint32_t
		 $this->metaId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint64_t($this->skuId); // 序列化skuid，必填 类型为uint64_t
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填 类型为uint32_t
		$bs->pushUint32_t($this->metaId); // 序列化sku所属品类id 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA090180a;
	}
}
//回复
class GetCommodityPicResp {
	var $result;
	var $errmsg;
	var $skuPicOut;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->skuPicOut = $bs->popObject('stl_vector<SkuPicOutPo> '); // 反序列化图片列表 类型为std::vector<b2b2c::commodity::po::CSkuPicOutPo> 
		$this->outReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA090880a;
	}
}
//请求
class GetMultPriceSourceAndSceneInfoReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $cooperatorId;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint8_t
		 $this->cooperatorId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化机器码，必填  类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填  类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，必填  类型为uint32_t
		$bs->pushUint8_t($this->option); // 序列化选项，暂未用  类型为uint8_t
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字  类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA090180F;
	}
}
//回复
class GetMultPriceSourceAndSceneInfoResp {
	var $result;
	var $errmsg;
	var $getMultPriceSourcePo;
	var $getMultPriceScenePo;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息,调试使用  类型为std::string
		$this->getMultPriceSourcePo = $bs->popObject('stl_vector<ApiMultPriceSourcePo> '); // 反序列化price source po  类型为std::vector<b2b2c::commodity::po::CApiMultPriceSourcePo> 
		$this->getMultPriceScenePo = $bs->popObject('stl_vector<ApiMultPriceScenePo> '); // 反序列化price source po  类型为std::vector<b2b2c::commodity::po::CApiMultPriceScenePo> 
		$this->outReserve = $bs->popString(); // 反序列化返回保留字   类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA090880F;
	}
}
//请求
class GetPicListbySkuidReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $skuId;
	var $cooperatorId;
	var $metaId;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->skuId = 0; // uint64_t
		 $this->cooperatorId = 0; // uint32_t
		 $this->metaId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint64_t($this->skuId); // 序列化skuid，必填 类型为uint64_t
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填 类型为uint32_t
		$bs->pushUint32_t($this->metaId); // 序列化sku所属品类id，可以不填 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA090180d;
	}
}
//回复
class GetPicListbySkuidResp {
	var $result;
	var $errmsg;
	var $skuPicOut;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->skuPicOut = $bs->popObject('stl_vector<ApiSkuPicPo> '); // 反序列化图片列表 类型为std::vector<b2b2c::commodity::po::CApiSkuPicPo> 
		$this->outReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA090880d;
	}
}
//请求
class GetSkuBasicListByFilterReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $skuVFilter;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint32_t
		 $this->skuVFilter = new ApiSkuVFilter(); // b2b2c::commodity::po::CApiSkuVFilter
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化 机器码,必填  类型为std::string
		$bs->pushString($this->source); // 序列化 请求来源标识,必填  类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化 场景id,必填  类型为uint32_t
		$bs->pushUint32_t($this->option); // 序列化选项，暂未用  类型为uint32_t
		$bs->pushObject($this->skuVFilter, 'ApiSkuVFilter'); // 序列化 Filter过滤器,必填 类型为b2b2c::commodity::po::CApiSkuVFilter
		$bs->pushString($this->inReserve); // 序列化 保留输入参数,未使用  类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA090180e;
	}
}
//回复
class GetSkuBasicListByFilterResp {
	var $result;
	var $errmsg;
	var $skuInfo;
	var $totalSize;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化 错误信息 类型为std::string
		$this->skuInfo = $bs->popObject('stl_vector<ApiSkuPo> '); // 反序列化SkuPo信息  返回信息无库存 sku图片详情信息 类型为std::vector<b2b2c::commodity::po::CApiSkuPo> 
		$this->totalSize = $bs->popUint32_t(); // 反序列化总长度 类型为uint32_t
		$this->outReserve = $bs->popString(); // 反序列化 保留输出参数,未使用  类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA090880e;
	}
}
//请求
class GetSkuBasicWithStockReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $skuId;
	var $cooperatorId;
	var $metaId;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->skuId = 0; // uint64_t
		 $this->cooperatorId = 0; // uint32_t
		 $this->metaId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint64_t($this->skuId); // 序列化skuid，必填 类型为uint64_t
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填 类型为uint32_t
		$bs->pushUint32_t($this->metaId); // 序列化sku所属品类id 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0901808;
	}
}
//回复
class GetSkuBasicWithStockResp {
	var $result;
	var $errmsg;
	var $SkuInfo;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->SkuInfo = $bs->popObject('SkuBasicPo'); // 反序列化商品Po信息  类型为b2b2c::sku::po::CSkuBasicPo
		$this->outReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0908808;
	}
}
//请求
class GetSkuDetailReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $skuId;
	var $cooperatorId;
	var $metaId;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->skuId = 0; // uint64_t
		 $this->cooperatorId = 0; // uint32_t
		 $this->metaId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint64_t($this->skuId); // 序列化skuid，必填 类型为uint64_t
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填 类型为uint32_t
		$bs->pushUint32_t($this->metaId); // 序列化sku所属品类id 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0901807;
	}
}
//回复
class GetSkuDetailResp {
	var $result;
	var $errmsg;
	var $skuDetailPo;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->skuDetailPo = $bs->popObject('stl_vector<SkuDetailPo> '); // 反序列化skuDeail po 信息  类型为std::vector<b2b2c::sku::po::CSkuDetailPo> 
		$this->outReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0908807;
	}
}
//请求
class GetSkuInfoReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $skuId;
	var $cooperatorId;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->skuId = 0; // uint64_t
		 $this->cooperatorId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint64_t($this->skuId); // 序列化skuid，必填 类型为uint64_t
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0901814;
	}
}
//回复
class GetSkuInfoResp {
	var $result;
	var $errmsg;
	var $apiSkuInfo;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->apiSkuInfo = $bs->popObject('ApiSkuPo'); // 反序列化商品Po信息  类型为b2b2c::commodity::po::CApiSkuPo
		$this->outReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0908814;
	}
}
//请求
class GetUrlBySkuIdReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $skuId;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint32_t
		 $this->skuId = 0; // uint64_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化 机器码,必填  类型为std::string
		$bs->pushString($this->source); // 序列化 请求来源标识,必填  类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化 场景id,必填  类型为uint32_t
		$bs->pushUint32_t($this->option); // 序列化 选项,未使用   类型为uint32_t
		$bs->pushUint64_t($this->skuId); // 序列化 skuid,必填  类型为uint64_t
		$bs->pushString($this->inReserve); // 序列化 保留输入参数,未使用   类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0901818;
	}
}
//回复
class GetUrlBySkuIdResp {
	var $result;
	var $errmsg;
	var $spuUrl;
	var $comUrl;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化 错误信息 类型为std::string
		$this->spuUrl = $bs->popString(); // 反序列化 返回结果 spu url  类型为std::string
		$this->comUrl = $bs->popString(); // 反序列化 返回结果 com url  类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化 保留输出参数,未使用  类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0908818;
	}
}
//请求
class ModifyBasicReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $ordinaryInfo;
	var $skuAttr;
	var $skuId;
	var $cooperatorId;
	var $metaId;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->ordinaryInfo = new OrdinaryInfoPo(); // b2b2c::commodity::po::COrdinaryInfoPo
		 $this->skuAttr = ""; // std::string
		 $this->skuId = 0; // uint64_t
		 $this->cooperatorId = 0; // uint32_t
		 $this->metaId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushObject($this->ordinaryInfo, 'OrdinaryInfoPo'); // 序列化一般信息，这个结构对应的就是sku信息里可以让合作伙伴修改的部分，必填 类型为b2b2c::commodity::po::COrdinaryInfoPo
		$bs->pushString($this->skuAttr); // 序列化sku一般属性，必填 类型为std::string
		$bs->pushUint64_t($this->skuId); // 序列化skuid，必填 类型为uint64_t
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填 类型为uint32_t
		$bs->pushUint32_t($this->metaId); // 序列化sku所属品类id 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0901804;
	}
}
//回复
class ModifyBasicResp {
	var $result;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0908804;
	}
}
//请求
class ModifyIcsonBasicReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $ordinaryInfo;
	var $icsonId;
	var $cooperatorId;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->ordinaryInfo = new OrdinaryInfoPo(); // b2b2c::commodity::po::COrdinaryInfoPo
		 $this->icsonId = ""; // std::string
		 $this->cooperatorId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushObject($this->ordinaryInfo, 'OrdinaryInfoPo'); // 序列化一般信息，这个结构对应的就是sku信息里可以让合作伙伴修改的部分，必填 类型为b2b2c::commodity::po::COrdinaryInfoPo
		$bs->pushString($this->icsonId); // 序列化icsonId，易迅ID，必填;易迅ID含：易迅商品系统编码(如sysno:528211)或者产品编码(如pid:15-058-152) 类型为std::string
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填,目前易迅填 855006089 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA090181C;
	}
}
//回复
class ModifyIcsonBasicResp {
	var $result;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA090881C;
	}
}
//请求
class ModifyIcsonStockReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $stockInfo;
	var $icsonId;
	var $cooperatorId;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->stockInfo = new stl_vector('StockInfoPo'); // std::vector<b2b2c::commodity::po::CStockInfoPo> 
		 $this->icsonId = ""; // std::string
		 $this->cooperatorId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushObject($this->stockInfo, 'stl_vector'); // 序列化库存信息，必填 类型为std::vector<b2b2c::commodity::po::CStockInfoPo> 
		$bs->pushString($this->icsonId); // 序列化icsonId，易迅ID，必填;易迅ID含：易迅商品系统编码(如sysno:528211)或者产品编码(如pid:15-058-152) 类型为std::string
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填,目前易迅填 855006089 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA090181D;
	}
}
//回复
class ModifyIcsonStockResp {
	var $result;
	var $errmsg;
	var $afStockInfo;
	var $OutReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->afStockInfo = $bs->popObject('stl_vector<ApiStockPo> '); // 反序列化库存信息返回结构体 类型为std::vector<b2b2c::commodity::po::CApiStockPo> 
		$this->OutReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA090881D;
	}
}
//请求
class ModifyStockReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $stockInfo;
	var $skuId;
	var $cooperatorId;
	var $metaId;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->stockInfo = new stl_vector('StockInfoPo'); // std::vector<b2b2c::commodity::po::CStockInfoPo> 
		 $this->skuId = 0; // uint64_t
		 $this->cooperatorId = 0; // uint32_t
		 $this->metaId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushObject($this->stockInfo, 'stl_vector'); // 序列化库存信息，必填 类型为std::vector<b2b2c::commodity::po::CStockInfoPo> 
		$bs->pushUint64_t($this->skuId); // 序列化skuid，必填 类型为uint64_t
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填 类型为uint32_t
		$bs->pushUint32_t($this->metaId); // 序列化sku所属品类id 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0901805;
	}
}
//回复
class ModifyStockResp {
	var $result;
	var $errmsg;
	var $messRet;
	var $OutReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->messRet = $bs->popObject('stl_vector<MessRetPo> '); // 反序列化库存返回信息 类型为std::vector<b2b2c::commodity::po::CMessRetPo> 
		$this->OutReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0908805;
	}
}
//请求
class ModifyStockV2Req {
	var $machineKey;
	var $source;
	var $sceneId;
	var $stockInfo;
	var $skuId;
	var $cooperatorId;
	var $metaId;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->stockInfo = new stl_vector('StockInfoPo'); // std::vector<b2b2c::commodity::po::CStockInfoPo> 
		 $this->skuId = 0; // uint64_t
		 $this->cooperatorId = 0; // uint32_t
		 $this->metaId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushObject($this->stockInfo, 'stl_vector'); // 序列化库存信息，必填 类型为std::vector<b2b2c::commodity::po::CStockInfoPo> 
		$bs->pushUint64_t($this->skuId); // 序列化skuid，必填 类型为uint64_t
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填 类型为uint32_t
		$bs->pushUint32_t($this->metaId); // 序列化sku所属品类id 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0901817;
	}
}
//回复
class ModifyStockV2Resp {
	var $result;
	var $errmsg;
	var $afStockInfo;
	var $OutReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->afStockInfo = $bs->popObject('stl_vector<ApiStockPo> '); // 反序列化库存信息返回结构体 类型为std::vector<b2b2c::commodity::po::CApiStockPo> 
		$this->OutReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0908817;
	}
}
//请求
class ReUploadReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $skuId;
	var $keyInfo;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint32_t
		 $this->skuId = 0; // uint64_t
		 $this->keyInfo = new KeyInfoPo(); // b2b2c::commodity::po::CKeyInfoPo
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化 机器码,必填  类型为std::string
		$bs->pushString($this->source); // 序列化 请求来源标识,必填  类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化 场景id,必填  类型为uint32_t
		$bs->pushUint32_t($this->option); // 序列化选项，暂未用  类型为uint32_t
		$bs->pushUint64_t($this->skuId); // 序列化skuid，必填 类型为uint64_t
		$bs->pushObject($this->keyInfo, 'KeyInfoPo'); // 序列化关键信息，我们用来聚合spu和sku，必填 类型为b2b2c::commodity::po::CKeyInfoPo
		$bs->pushString($this->inReserve); // 序列化 保留输入参数,未使用  类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0901815;
	}
}
//回复
class ReUploadResp {
	var $result;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0908815;
	}
}
//请求
class UploadBasicReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $keyInfo;
	var $ordinaryInfo;
	var $stockInfo;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->keyInfo = new KeyInfoPo(); // b2b2c::commodity::po::CKeyInfoPo
		 $this->ordinaryInfo = new OrdinaryInfoPo(); // b2b2c::commodity::po::COrdinaryInfoPo
		 $this->stockInfo = new stl_vector('StockInfoPo'); // std::vector<b2b2c::commodity::po::CStockInfoPo> 
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushObject($this->keyInfo, 'KeyInfoPo'); // 序列化关键信息，我们用来聚合spu和sku，必填 类型为b2b2c::commodity::po::CKeyInfoPo
		$bs->pushObject($this->ordinaryInfo, 'OrdinaryInfoPo'); // 序列化一般信息，合作伙伴信息提供用来展示或搜索的信息，必填 类型为b2b2c::commodity::po::COrdinaryInfoPo
		$bs->pushObject($this->stockInfo, 'stl_vector'); // 序列化库存信息，必填 类型为std::vector<b2b2c::commodity::po::CStockInfoPo> 
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0901801;
	}
}
//回复
class UploadBasicResp {
	var $result;
	var $errmsg;
	var $skuId;
	var $itemId;
	var $messRet;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->skuId = $bs->popUint64_t(); // 反序列化skuid，合作伙伴那边的基本商品单位转换到我们这边的编码 类型为uint64_t
		$this->itemId = $bs->popUint64_t(); // 反序列化itemid,合作伙伴那边关联商品ID转换到我们这边的id 类型为uint64_t
		$this->messRet = $bs->popObject('stl_vector<MessRetPo> '); // 反序列化库存返回信息 类型为std::vector<b2b2c::commodity::po::CMessRetPo> 
		$this->outReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0908801;
	}
}
//请求
class UploadBasicV2Req {
	var $machineKey;
	var $source;
	var $sceneId;
	var $keyInfo;
	var $ordinaryInfo;
	var $stockInfo;
	var $apiMultPriceRulesForSkuPo;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->keyInfo = new KeyInfoPo(); // b2b2c::commodity::po::CKeyInfoPo
		 $this->ordinaryInfo = new OrdinaryInfoPo(); // b2b2c::commodity::po::COrdinaryInfoPo
		 $this->stockInfo = new stl_vector('StockInfoPo'); // std::vector<b2b2c::commodity::po::CStockInfoPo> 
		 $this->apiMultPriceRulesForSkuPo = new ApiMultPriceRulesForSkuPo(); // b2b2c::commodity::po::CApiMultPriceRulesForSkuPo
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushObject($this->keyInfo, 'KeyInfoPo'); // 序列化关键信息，我们用来聚合spu和sku，必填 类型为b2b2c::commodity::po::CKeyInfoPo
		$bs->pushObject($this->ordinaryInfo, 'OrdinaryInfoPo'); // 序列化一般信息，合作伙伴信息提供用来展示或搜索的信息，必填 类型为b2b2c::commodity::po::COrdinaryInfoPo
		$bs->pushObject($this->stockInfo, 'stl_vector'); // 序列化库存信息，必填 类型为std::vector<b2b2c::commodity::po::CStockInfoPo> 
		$bs->pushObject($this->apiMultPriceRulesForSkuPo, 'ApiMultPriceRulesForSkuPo'); // 序列化sku多价信息，没有可不填 类型为b2b2c::commodity::po::CApiMultPriceRulesForSkuPo
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0901813;
	}
}
//回复
class UploadBasicV2Resp {
	var $result;
	var $errmsg;
	var $skuId;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->skuId = $bs->popUint64_t(); // 反序列化skuid，合作伙伴那边的基本商品单位转换到我们这边的编码 类型为uint64_t
		$this->outReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0908813;
	}
}
//请求
class UploadDetailsReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $skuDetailInfo;
	var $skuId;
	var $cooperatorId;
	var $metaId;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->skuDetailInfo = new stl_vector('SkuDetailInfoPo'); // std::vector<b2b2c::commodity::po::CSkuDetailInfoPo> 
		 $this->skuId = 0; // uint64_t
		 $this->cooperatorId = 0; // uint32_t
		 $this->metaId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushObject($this->skuDetailInfo, 'stl_vector'); // 序列化详情，必填 类型为std::vector<b2b2c::commodity::po::CSkuDetailInfoPo> 
		$bs->pushUint64_t($this->skuId); // 序列化skuid，必填 类型为uint64_t
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填 类型为uint32_t
		$bs->pushUint32_t($this->metaId); // 序列化sku所属品类id 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0901802;
	}
}
//回复
class UploadDetailsResp {
	var $result;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0908802;
	}
}
//请求
class UploadIcsonBasicReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $keyInfo;
	var $ordinaryInfo;
	var $stockInfo;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->keyInfo = new KeyInfoPo(); // b2b2c::commodity::po::CKeyInfoPo
		 $this->ordinaryInfo = new OrdinaryInfoPo(); // b2b2c::commodity::po::COrdinaryInfoPo
		 $this->stockInfo = new stl_vector('StockInfoPo'); // std::vector<b2b2c::commodity::po::CStockInfoPo> 
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushObject($this->keyInfo, 'KeyInfoPo'); // 序列化关键信息，我们用来聚合spu和sku，必填 类型为b2b2c::commodity::po::CKeyInfoPo
		$bs->pushObject($this->ordinaryInfo, 'OrdinaryInfoPo'); // 序列化一般信息，合作伙伴信息提供用来展示或搜索的信息，必填 类型为b2b2c::commodity::po::COrdinaryInfoPo
		$bs->pushObject($this->stockInfo, 'stl_vector'); // 序列化库存信息，必填 类型为std::vector<b2b2c::commodity::po::CStockInfoPo> 
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA090181A;
	}
}
//回复
class UploadIcsonBasicResp {
	var $result;
	var $errmsg;
	var $skuId;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->skuId = $bs->popUint64_t(); // 反序列化skuid，合作伙伴那边的基本商品单位转换到我们这边的编码 类型为uint64_t
		$this->outReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA090881A;
	}
}
//请求
class UploadIcsonCrossSaleRelationReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $icsonId;
	var $cooperatorId;
	var $crossSaleRelationInfo;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint32_t
		 $this->icsonId = ""; // std::string
		 $this->cooperatorId = 0; // uint32_t
		 $this->crossSaleRelationInfo = new stl_vector('CrossSaleRelationPo'); // std::vector<b2b2c::commodity::po::CCrossSaleRelationPo> 
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->option); // 序列化0：逐条覆盖 1：整体覆盖 类型为uint32_t
		$bs->pushString($this->icsonId); // 序列化icsonId，易迅ID，必填;易迅ID含：易迅商品系统编码(如sysno:528211)或者产品编码(如pid:15-058-152) 类型为std::string
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填 类型为uint32_t
		$bs->pushObject($this->crossSaleRelationInfo, 'stl_vector'); // 序列化库存信息，必填 类型为std::vector<b2b2c::commodity::po::CCrossSaleRelationPo> 
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0901824;
	}
}
//回复
class UploadIcsonCrossSaleRelationResp {
	var $result;
	var $errmsg;
	var $OutReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->OutReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0908823;
	}
}
//请求
class UploadIcsonDetailsReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $skuDetailInfo;
	var $icsonId;
	var $cooperatorId;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->skuDetailInfo = new stl_vector('SkuDetailInfoPo'); // std::vector<b2b2c::commodity::po::CSkuDetailInfoPo> 
		 $this->icsonId = ""; // std::string
		 $this->cooperatorId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushObject($this->skuDetailInfo, 'stl_vector'); // 序列化详情，必填 类型为std::vector<b2b2c::commodity::po::CSkuDetailInfoPo> 
		$bs->pushString($this->icsonId); // 序列化icsonId，易迅ID，必填;易迅ID含：易迅商品系统编码(如sysno:528211)或者产品编码(如pid:15-058-152) 类型为std::string
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填,目前易迅填 855006089 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA090181B;
	}
}
//回复
class UploadIcsonDetailsResp {
	var $result;
	var $errmsg;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA090881B;
	}
}
//请求
class UploadIcsonPictureReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $skuPic;
	var $icsonId;
	var $cooperatorId;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint32_t
		 $this->skuPic = new SkuPicPo(); // b2b2c::commodity::po::CSkuPicPo
		 $this->icsonId = ""; // std::string
		 $this->cooperatorId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushUint32_t($this->option); // 序列化 选项,未使用   类型为uint32_t
		$bs->pushObject($this->skuPic, 'SkuPicPo'); // 序列化图片，必填 类型为b2b2c::commodity::po::CSkuPicPo
		$bs->pushString($this->icsonId); // 序列化icsonId，易迅ID，必填;易迅ID含：易迅商品系统编码(如sysno:528211)或者产品编码(如pid:15-058-152)或(skuid:xxxxxx) 类型为std::string
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填,目前易迅填 855006089 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0901819;
	}
}
//回复
class UploadIcsonPictureResp {
	var $result;
	var $errmsg;
	var $picUrl;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->picUrl = $bs->popString(); // 反序列化图片URL 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0908819;
	}
}
//请求
class UploadPictureReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $skuPic;
	var $skuId;
	var $cooperatorId;
	var $metaId;
	var $inReserve;


	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->skuPic = new SkuPicPo(); // b2b2c::commodity::po::CSkuPicPo
		 $this->skuId = 0; // uint64_t
		 $this->cooperatorId = 0; // uint32_t
		 $this->metaId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	


	function Serialize(&$bs) {
		$bs->pushString($this->machineKey); // 序列化machinekey，必填 类型为std::string
		$bs->pushString($this->source); // 序列化Source，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景Id，必填 类型为uint32_t
		$bs->pushObject($this->skuPic, 'SkuPicPo'); // 序列化图片，必填 类型为b2b2c::commodity::po::CSkuPicPo
		$bs->pushUint64_t($this->skuId); // 序列化skuid，必填 类型为uint64_t
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填 类型为uint32_t
		$bs->pushUint32_t($this->metaId); // 序列化sku所属品类id 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化InReserve 类型为std::string

	
		return $bs->isGood();
	}
	
	function getCmdId() {
		return 0xA0901803;
	}
}
//回复
class UploadPictureResp {
	var $result;
	var $errmsg;
	var $picName;
	var $outReserve;



	function Unserialize(&$bs) {
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->picName = $bs->popString(); // 反序列化图片名称 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化OutReserve 类型为std::string


	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0908803;
	}
}

?>