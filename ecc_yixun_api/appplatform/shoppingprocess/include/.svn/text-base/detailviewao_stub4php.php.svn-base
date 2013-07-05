<?php
// source idl: com.b2b2c.sku.idl.DetailViewAo.java
require_once "detailviewao_xxo.php";

class BatchGetIcsonCrossSaleRelationReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $icsonId;
	var $cooperatorId;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint32_t
		 $this->icsonId = new stl_set('stl_string'); // std::set<std::string> 
		 $this->cooperatorId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化如果使用appplatform调用 填命令号；如果php调用 请向@alibowang申请；必填 类型为uint32_t
		$bs->pushUint32_t($this->option); // 序列化选项，暂未用 类型为uint32_t
		$bs->pushObject($this->icsonId,'stl_set'); // 序列化易迅ID，必填；易迅ID含：易迅商品系统编码(如sysno:528211 或者icson-52811)或者产品编码(如pid:15-058-152) 类型为std::set<std::string> 
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化入参保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA1A01804;
	}
}

class BatchGetIcsonCrossSaleRelationResp {
	var $result;
	var $errmsg;
	var $crossSaleRelationInfo;
	var $OutReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->crossSaleRelationInfo = $bs->popObject('stl_map<stl_string,stl_vector<ViewCrossSaleRelationPo> >'); // 反序列化跨仓销售设置信息，只返回有效信息 key:icsonid value:仓库信息集合 类型为std::map<std::string,std::vector<b2b2c::detailview::po::CViewCrossSaleRelationPo> > 
		$this->OutReserve = $bs->popString(); // 反序列化出参保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA1A08804;
	}
}

class BatchGetMultPriceRule4PromotionReq {
	var $machineKey;
	var $source;
	var $scene;
	var $option;
	var $commodityIdQueryPo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->scene = 0; // uint32_t
		 $this->option = 0; // uint64_t
		 $this->commodityIdQueryPo = new stl_map('stl_string,ViewMultPriceQueryPo'); // std::map<std::string,b2b2c::detailview::po::CViewMultPriceQueryPo> 
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->scene); // 序列化如果使用appplatform调用 填命令号；如果php调用 请向@alibowang申请；必填 类型为uint32_t
		$bs->pushUint64_t($this->option); // 序列化选项，暂未用 类型为uint64_t
		$bs->pushObject($this->commodityIdQueryPo,'stl_map'); // 序列化需要获取多价的commodityid列表 兼容三个平台commodity 内部做区分 如易迅 key为icson-102923,当ViewMultPriceQueryPo为空时不进行过滤 类型为std::map<std::string,b2b2c::detailview::po::CViewMultPriceQueryPo> 
		$bs->pushString($this->inReserve); // 序列化请求保留字  类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA1A01803;
	}
}

class BatchGetMultPriceRule4PromotionResp {
	var $result;
	var $errmsg;
	var $mapViewMultPriceRulesForSkuPo;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息，调试使用 类型为std::string
		$this->mapViewMultPriceRulesForSkuPo = $bs->popObject('stl_map<stl_string,ViewMultPriceRulesForSkuPo>'); // 反序列化多价规格列表，commodityid->多价规则列表 类型为std::map<std::string,b2b2c::detailview::po::CViewMultPriceRulesForSkuPo> 
		$this->outReserve = $bs->popString(); // 反序列化返回保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA1A08803;
	}
}

class BatchGetMultPriceRule4SearchReq {
	var $machineKey;
	var $source;
	var $scene;
	var $option;
	var $commodityIdQueryPo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->scene = 0; // uint32_t
		 $this->option = 0; // uint64_t
		 $this->commodityIdQueryPo = new stl_map('stl_string,ViewMultPriceQueryPo'); // std::map<std::string,b2b2c::detailview::po::CViewMultPriceQueryPo> 
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->scene); // 序列化如果使用appplatform调用 填命令号；如果php调用 请向@alibowang申请；必填 类型为uint32_t
		$bs->pushUint64_t($this->option); // 序列化选项，暂未用 类型为uint64_t
		$bs->pushObject($this->commodityIdQueryPo,'stl_map'); // 序列化需要获取多价的commodityid列表 兼容三个平台commodity 内部做区分 如易迅 key为icson-102923,当ViewMultPriceQueryPo为空时不进行过滤 类型为std::map<std::string,b2b2c::detailview::po::CViewMultPriceQueryPo> 
		$bs->pushString($this->inReserve); // 序列化请求保留字  类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA1A01806;
	}
}

class BatchGetMultPriceRule4SearchResp {
	var $result;
	var $errmsg;
	var $mapViewMultPriceRulesForSkuPo;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息，调试使用 类型为std::string
		$this->mapViewMultPriceRulesForSkuPo = $bs->popObject('stl_map<stl_string,ViewMultPriceRulesForSkuPo>'); // 反序列化多价规格列表，commodityid->多价规则列表 类型为std::map<std::string,b2b2c::detailview::po::CViewMultPriceRulesForSkuPo> 
		$this->outReserve = $bs->popString(); // 反序列化返回保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA1A08806;
	}
}

class BatchGetSkuByIcsonIdReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $cooperatorId;
	var $icsonId;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint32_t
		 $this->cooperatorId = 0; // uint32_t
		 $this->icsonId = new stl_set('stl_string'); // std::set<std::string> 
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化如果使用appplatform调用 填命令号；如果php调用 请向@alibowang申请；必填 类型为uint32_t
		$bs->pushUint32_t($this->option); // 序列化选项，暂未用 类型为uint32_t
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴id，必填 类型为uint32_t
		$bs->pushObject($this->icsonId,'stl_set'); // 序列化易迅ID，必填；易迅ID含：易迅商品系统编码(如sysno:528211 或者icson-52811)或者产品编码(如pid:15-058-152) 类型为std::set<std::string> 
		$bs->pushString($this->inReserve); // 序列化入参保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA1A01805;
	}
}

class BatchGetSkuByIcsonIdResp {
	var $result;
	var $errmsg;
	var $skuPo;
	var $OutReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->skuPo = $bs->popObject('stl_map<stl_string,ViewSkuPo>'); // 反序列化SKU信息 类型为std::map<std::string,b2b2c::detailview::po::CViewSkuPo> 
		$this->OutReserve = $bs->popString(); // 反序列化出参保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA1A08805;
	}
}

class FetchSkuInfo4DetailReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $commodityId;
	var $areaId;
	var $cooperatorId;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint64_t
		 $this->commodityId = ""; // std::string
		 $this->areaId = 0; // uint32_t
		 $this->cooperatorId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化客户端机器码（浏览器客户端唯一ID），必填  类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，填文件名or函数名即可，必填  类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化如果使用appplatform调用填命令号；如果php调用，请向@alibowang申请；必填 类型为uint32_t
		$bs->pushUint64_t($this->option); // 序列化选项， bit位表示，第一个bit位取单品，defualt取全部主子商品 类型为uint64_t
		$bs->pushString($this->commodityId); // 序列化Commodityid 兼容三个平台commodity 内部做区分 如易迅填：icson-102923，必填 类型为std::string
		$bs->pushUint32_t($this->areaId); // 序列化地域ID， 网购现行国标地域编码，不填或者填写错误将不进行地域过滤 类型为uint32_t
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴ID，选填；为0：返回全部SKU，非0：返回指定合作伙伴的SKU 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA1A01801;
	}
}

class FetchSkuInfo4DetailResp {
	var $result;
	var $errmsg;
	var $viewSpuPo;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息，调试使用  类型为std::string
		$this->viewSpuPo = $bs->popObject('ViewSpuPo'); // 反序列化商品信息 类型为b2b2c::detailview::po::CViewSpuPo
		$this->outReserve = $bs->popString(); // 反序列化返回保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA1A08801;
	}
}

class FetchSkuListInfoReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $skuListFilter;
	var $areaId;
	var $inReserve;
	var $inLocalKey;
	var $Extent;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint64_t
		 $this->skuListFilter = new stl_vector('ViewSkuFilterPo'); // std::vector<b2b2c::detailview::po::CViewSkuFilterPo> 
		 $this->areaId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
		 $this->inLocalKey = ""; // std::string
		 $this->Extent = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化客户端机器码（浏览器客户端唯一ID），必填  类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，填文件名or函数名即可，必填   类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化如果使用appplatform调用 填命令号；如果php调用 请向@alibowang申请；必填 类型为uint32_t
		$bs->pushUint64_t($this->option); // 序列化选项，option等于1时 供搜索使用 --- 待实现 类型为uint64_t
		$bs->pushObject($this->skuListFilter,'stl_vector'); // 序列化过滤器，必填 类型为std::vector<b2b2c::detailview::po::CViewSkuFilterPo> 
		$bs->pushUint32_t($this->areaId); // 序列化地域ID，必填，网购现行国标地域编码  类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 ，选填 类型为std::string
		$bs->pushString($this->inLocalKey); // 序列化请求保留字，选填 类型为std::string
		$bs->pushObject($this->Extent,'stl_map'); // 序列化请求保留字，拓展用，选填  类型为std::map<std::string,std::string> 

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA1A01802;
	}
}

class FetchSkuListInfoResp {
	var $result;
	var $errmsg;
	var $viewSpu;
	var $viewSpuPoError;
	var $outLocalKey;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息，调试使用  类型为std::string
		$this->viewSpu = $bs->popObject('stl_map<stl_string,ViewSpuPo>'); // 反序列化商品信息，commodityid->商品信息 类型为std::map<std::string,b2b2c::detailview::po::CViewSpuPo> 
		$this->viewSpuPoError = $bs->popObject('stl_map<stl_string,ViewSkuErrorPo>'); // 反序列化错误信息，commodityid->错误信息 类型为std::map<std::string,b2b2c::detailview::po::CViewSkuErrorPo> 
		$this->outLocalKey = $bs->popString(); // 反序列化请求保留字Key，恒等于inLocalKey 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化返回保留字  类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA1A08802;
	}
}

class FetchSkuListInfo4ShopCartReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $skuListFilter;
	var $areaId;
	var $inReserve;
	var $inLocalKey;
	var $Extent;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint64_t
		 $this->skuListFilter = new stl_vector('ViewSkuFilterPo'); // std::vector<b2b2c::detailview::po::CViewSkuFilterPo> 
		 $this->areaId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
		 $this->inLocalKey = ""; // std::string
		 $this->Extent = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化客户端机器码（浏览器客户端唯一ID），必填  类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，填文件名or函数名即可，必填   类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化使用时需要向@alibowang申请；必填 类型为uint32_t
		$bs->pushUint64_t($this->option); // 序列化选项，暂未用 类型为uint64_t
		$bs->pushObject($this->skuListFilter,'stl_vector'); // 序列化过滤器，必填 参考相关Po 类型为std::vector<b2b2c::detailview::po::CViewSkuFilterPo> 
		$bs->pushUint32_t($this->areaId); // 序列化地域ID，必填，网购现行国标地域编码 需要进行地域过滤时使用，如无需过滤 可以填0 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 ，选填  类型为std::string
		$bs->pushString($this->inLocalKey); // 序列化请求保留字，选填 暂未用 类型为std::string
		$bs->pushObject($this->Extent,'stl_map'); // 序列化请求保留字，拓展用，选填 暂未用  类型为std::map<std::string,std::string> 

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA1A01807;
	}
}

class FetchSkuListInfo4ShopCartResp {
	var $result;
	var $errmsg;
	var $viewSpu;
	var $viewSpuPoError;
	var $outLocalKey;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息，调试使用  类型为std::string
		$this->viewSpu = $bs->popObject('stl_map<stl_string,ViewSpuPo>'); // 反序列化商品信息，commodityid->商品信息 icson-1234 ---> SpuPo 类型为std::map<std::string,b2b2c::detailview::po::CViewSpuPo> 
		$this->viewSpuPoError = $bs->popObject('stl_map<stl_string,ViewSkuErrorPo>'); // 反序列化错误信息，commodityid->错误信息 类型为std::map<std::string,b2b2c::detailview::po::CViewSkuErrorPo> 
		$this->outLocalKey = $bs->popString(); // 反序列化请求保留字Key，恒等于inLocalKey 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化返回保留字  类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA1A08807;
	}
}
?>