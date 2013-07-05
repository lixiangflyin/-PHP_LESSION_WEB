<?php
// source idl: com.b2b2c.icsonboss.ao.idl.IcsonBossAo.java
require_once "icsonbossao_xxo.php";

class BatchGetSkuBySkuIdReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $skuId;
	var $cooperatorId;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint64_t
		 $this->skuId = new stl_set('uint64_t'); // std::set<uint64_t> 
		 $this->cooperatorId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填  类型为std::string
		$bs->pushString($this->source); // 序列化来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID，必填 类型为uint32_t
		$bs->pushUint64_t($this->option); // 序列化选项，暂未用 类型为uint64_t
		$bs->pushObject($this->skuId,'stl_set'); // 序列化SKUID，必填 类型为std::set<uint64_t> 
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴主帐号，选填，作为过滤条件 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化保留输入参数 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA880180D;
	}
}

class BatchGetSkuBySkuIdResp {
	var $result;
	var $errmsg;
	var $skuBasicList;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->skuBasicList = $bs->popObject('stl_map<uint64_t,BossSkuBasicPo>'); // 反序列化返回结果SKU信息 类型为std::map<uint64_t,b2b2c::icsonboss::po::CBossSkuBasicPo> 
		$this->outReserve = $bs->popString(); // 反序列化保留输出参数，未使用 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA880880D;
	}
}

class BatchGetSkuInfoListByIcsonIdReq {
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
		 $this->option = 0; // uint64_t
		 $this->cooperatorId = 0; // uint32_t
		 $this->icsonId = new stl_set('stl_string'); // std::set<std::string> 
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID，必填 类型为uint32_t
		$bs->pushUint64_t($this->option); // 序列化选项，暂未用 类型为uint64_t
		$bs->pushUint32_t($this->cooperatorId); // 序列化合作伙伴ID，易迅为855006089 类型为uint32_t
		$bs->pushObject($this->icsonId,'stl_set'); // 序列化目前支持最多批量20个，需要转换的易迅ID集合(sysNum Id或者produceNum Id)，两种ID暂时不用加前缀，produceNum通过15-058-152中有-来区分sysnum，必填 类型为std::set<std::string> 
		$bs->pushString($this->inReserve); // 序列化请求保留字  类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA880180A;
	}
}

class BatchGetSkuInfoListByIcsonIdResp {
	var $result;
	var $errmsg;
	var $conversionSkuBasicPo;
	var $batchConversionIcsonIdErrorPo;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->conversionSkuBasicPo = $bs->popObject('stl_map<stl_string,stl_vector<ConversionSkuBasicPo> >'); // 反序列化易迅ID转换后成功获取的SkuID等信息 类型为std::map<std::string,std::vector<b2b2c::icsonboss::po::CConversionSkuBasicPo> > 
		$this->batchConversionIcsonIdErrorPo = $bs->popObject('stl_map<stl_string,BatchConversionIcsonIdErrorPo>'); // 反序列化转换失败的易迅ID对应的错误码信息 类型为std::map<std::string,b2b2c::icsonboss::po::CBatchConversionIcsonIdErrorPo> 
		$this->outReserve = $bs->popString(); // 反序列化返回保留字   类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA880880A;
	}
}

class DelMultPriceRuleByQueryWithAuthReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $skuId;
	var $multPriceQueryPo;
	var $authWeb;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint8_t
		 $this->skuId = 0; // uint64_t
		 $this->multPriceQueryPo = new MultPriceQueryPo(); // b2b2c::icsonboss::po::CMultPriceQueryPo
		 $this->authWeb = new AuthorizationField4Web(); // b2b2c::comm::CAuthorizationField4Web
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID，必填 类型为uint32_t
		$bs->pushUint8_t($this->option); // 序列化选项，暂未用 类型为uint8_t
		$bs->pushUint64_t($this->skuId); // 序列化SKUID，必填 类型为uint64_t
		$bs->pushObject($this->multPriceQueryPo,'MultPriceQueryPo'); // 序列化删除过滤器，必填 类型为b2b2c::icsonboss::po::CMultPriceQueryPo
		$bs->pushObject($this->authWeb,'AuthorizationField4Web'); // 序列化权限操作字段，必填 类型为b2b2c::comm::CAuthorizationField4Web
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA8801809;
	}
}

class DelMultPriceRuleByQueryWithAuthResp {
	var $result;
	var $errmsg;
	var $multPriceRulesPo;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息，调试使用 类型为std::string
		$this->multPriceRulesPo = $bs->popObject('BossMultPriceRulesForSkuPo'); // 反序列化SKU多价信息 类型为b2b2c::icsonboss::po::CBossMultPriceRulesForSkuPo
		$this->outReserve = $bs->popString(); // 反序列化返回保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA8808809;
	}
}

class DelMultPriceSceneBySceneIdWithAuthReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $priceSceneId;
	var $authWeb;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint8_t
		 $this->priceSceneId = 0; // uint64_t
		 $this->authWeb = new AuthorizationField4Web(); // b2b2c::comm::CAuthorizationField4Web
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID，必填 类型为uint32_t
		$bs->pushUint8_t($this->option); // 序列化选项，暂未用 类型为uint8_t
		$bs->pushUint64_t($this->priceSceneId); // 序列化场景ID 类型为uint64_t
		$bs->pushObject($this->authWeb,'AuthorizationField4Web'); // 序列化权限操作字段，必填 类型为b2b2c::comm::CAuthorizationField4Web
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA8801806;
	}
}

class DelMultPriceSceneBySceneIdWithAuthResp {
	var $result;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息，调试使用 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化返回保留字   类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA8808806;
	}
}

class DelPriceMultSourceBySourceIdWithAuthReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $priceSourceId;
	var $authWeb;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint8_t
		 $this->priceSourceId = 0; // uint64_t
		 $this->authWeb = new AuthorizationField4Web(); // b2b2c::comm::CAuthorizationField4Web
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID，必填 类型为uint32_t
		$bs->pushUint8_t($this->option); // 序列化选项，暂未用 类型为uint8_t
		$bs->pushUint64_t($this->priceSourceId); // 序列化来源ID，必填 类型为uint64_t
		$bs->pushObject($this->authWeb,'AuthorizationField4Web'); // 序列化权限操作字段，必填 类型为b2b2c::comm::CAuthorizationField4Web
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA8801807;
	}
}

class DelPriceMultSourceBySourceIdWithAuthResp {
	var $result;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息，调试使用  类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化返回保留字   类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA8808807;
	}
}

class GetAllMultPriceSceneInfoReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint8_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID，必填 类型为uint32_t
		$bs->pushUint8_t($this->option); // 序列化选项，暂未用 类型为uint8_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA880180B;
	}
}

class GetAllMultPriceSceneInfoResp {
	var $result;
	var $errmsg;
	var $multPriceScenePo;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息，调试使用  类型为std::string
		$this->multPriceScenePo = $bs->popObject('stl_vector<BossMultPriceScenePo>'); // 反序列化多价场景列表 类型为std::vector<b2b2c::icsonboss::po::CBossMultPriceScenePo> 
		$this->outReserve = $bs->popString(); // 反序列化返回保留字   类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA880880B;
	}
}

class GetAllMultPriceSourceInfoReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint8_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID，必填 类型为uint32_t
		$bs->pushUint8_t($this->option); // 序列化选项，暂未用 类型为uint8_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA880180C;
	}
}

class GetAllMultPriceSourceInfoResp {
	var $result;
	var $errmsg;
	var $multPriceSourcePo;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息，调试使用 类型为std::string
		$this->multPriceSourcePo = $bs->popObject('stl_vector<BossMultPriceSourcePo>'); // 反序列化多价来源列表 类型为std::vector<b2b2c::icsonboss::po::CBossMultPriceSourcePo> 
		$this->outReserve = $bs->popString(); // 反序列化返回保留字   类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA880880C;
	}
}

class GetMultPriceRuleByQueryReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $priceQueryPo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint8_t
		 $this->priceQueryPo = new MultPriceQueryPo(); // b2b2c::icsonboss::po::CMultPriceQueryPo
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID，必填 类型为uint32_t
		$bs->pushUint8_t($this->option); // 序列化选项，暂未用 类型为uint8_t
		$bs->pushObject($this->priceQueryPo,'MultPriceQueryPo'); // 序列化查询过滤器，其中SKUID必填 类型为b2b2c::icsonboss::po::CMultPriceQueryPo
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA8801801;
	}
}

class GetMultPriceRuleByQueryResp {
	var $result;
	var $errmsg;
	var $multPriceRulesPo;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息，调试使用 类型为std::string
		$this->multPriceRulesPo = $bs->popObject('BossMultPriceRulesForSkuPo'); // 反序列化SKU多价信息 类型为b2b2c::icsonboss::po::CBossMultPriceRulesForSkuPo
		$this->outReserve = $bs->popString(); // 反序列化返回保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA8808801;
	}
}

class GetMultPriceSceneInfoBySceneIdReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $priceSceneId;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint8_t
		 $this->priceSceneId = 0; // uint64_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID，必填 类型为uint32_t
		$bs->pushUint8_t($this->option); // 序列化选项，暂未用 类型为uint8_t
		$bs->pushUint64_t($this->priceSceneId); // 序列化多价场景ID，必填 类型为uint64_t
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA8801804;
	}
}

class GetMultPriceSceneInfoBySceneIdResp {
	var $result;
	var $errmsg;
	var $multPriceScenePo;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息，调试使用 类型为std::string
		$this->multPriceScenePo = $bs->popObject('BossMultPriceScenePo'); // 反序列化多价场景 类型为b2b2c::icsonboss::po::CBossMultPriceScenePo
		$this->outReserve = $bs->popString(); // 反序列化返回保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA8808804;
	}
}

class GetMultPriceSourceInfoBySourceIdReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $priceSourceId;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint8_t
		 $this->priceSourceId = 0; // uint64_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID，必填 类型为uint32_t
		$bs->pushUint8_t($this->option); // 序列化选项，暂未用 类型为uint8_t
		$bs->pushUint64_t($this->priceSourceId); // 序列化多价来源ID，必填 类型为uint64_t
		$bs->pushString($this->inReserve); // 序列化请求保留字  类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA8801805;
	}
}

class GetMultPriceSourceInfoBySourceIdResp {
	var $result;
	var $errmsg;
	var $multPriceSourcePo;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息，调试使用 类型为std::string
		$this->multPriceSourcePo = $bs->popObject('BossMultPriceSourcePo'); // 反序列化多价来源 类型为b2b2c::icsonboss::po::CBossMultPriceSourcePo
		$this->outReserve = $bs->popString(); // 反序列化返回保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA8808805;
	}
}

class OperateStock4AdminWithAuthReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $skuStoreHouse;
	var $operation;
	var $authWeb;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint64_t
		 $this->skuStoreHouse = new stl_map('uint64_t,stl_set<uint32_t> '); // std::map<uint64_t,std::set<uint32_t> > 
		 $this->operation = new stl_map('uint16_t,stl_string'); // std::map<uint16_t,std::string> 
		 $this->authWeb = new AuthorizationField4Web(); // b2b2c::comm::CAuthorizationField4Web
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID，必填 类型为uint32_t
		$bs->pushUint64_t($this->option); // 序列化选项，暂未用 类型为uint64_t
		$bs->pushObject($this->skuStoreHouse,'stl_map'); // 序列化一个SKUID，与一组StoreHouseId进行组合，必填 类型为std::map<uint64_t,std::set<uint32_t> > 
		$bs->pushObject($this->operation,'stl_map'); // 序列化Operation->Value，Value对于不同的操作有不同的取值要求或者无意义，目前是保留字段Operation取值请参考b2b2c_define.h中的stock_operation_boss，对上边组合出的对象执行的一组相同的操作，必填 类型为std::map<uint16_t,std::string> 
		$bs->pushObject($this->authWeb,'AuthorizationField4Web'); // 序列化权限操作字段，必填 类型为b2b2c::comm::CAuthorizationField4Web
		$bs->pushString($this->inReserve); // 序列化请求保留字  类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA8801810;
	}
}

class OperateStock4AdminWithAuthResp {
	var $result;
	var $errmsg;
	var $errorCode;
	var $errorMsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->errorCode = $bs->popObject('stl_map<uint64_t,stl_map<uint32_t,uint32_t> >'); // 反序列化错误码，SKUID->StoreHouseId->错误码 类型为std::map<uint64_t,std::map<uint32_t,uint32_t> > 
		$this->errorMsg = $bs->popObject('stl_map<uint64_t,stl_map<uint32_t,stl_string> >'); // 反序列化错误信息，SKUID->StoreHouseId->错误信息 类型为std::map<uint64_t,std::map<uint32_t,std::string> > 
		$this->outReserve = $bs->popString(); // 反序列化返回保留字   类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA8808810;
	}
}

class OperateStock4PromotionWithAuthReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $skuStoreHouse;
	var $operation;
	var $authWeb;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint64_t
		 $this->skuStoreHouse = new stl_map('uint64_t,stl_set<uint32_t> '); // std::map<uint64_t,std::set<uint32_t> > 
		 $this->operation = new stl_map('uint16_t,stl_string'); // std::map<uint16_t,std::string> 
		 $this->authWeb = new AuthorizationField4Web(); // b2b2c::comm::CAuthorizationField4Web
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID，必填 类型为uint32_t
		$bs->pushUint64_t($this->option); // 序列化选项，暂未用 类型为uint64_t
		$bs->pushObject($this->skuStoreHouse,'stl_map'); // 序列化一个SKUID，与一组StoreHouseId进行组合，必填 类型为std::map<uint64_t,std::set<uint32_t> > 
		$bs->pushObject($this->operation,'stl_map'); // 序列化Operation->Value，Value对于不同的操作有不同的取值要求或者无意义，目前是保留字段Operation取值请参考b2b2c_define.h中的stock_operation_boss，对上边组合出的对象执行的一组相同的操作，必填 类型为std::map<uint16_t,std::string> 
		$bs->pushObject($this->authWeb,'AuthorizationField4Web'); // 序列化权限操作字段，必填 类型为b2b2c::comm::CAuthorizationField4Web
		$bs->pushString($this->inReserve); // 序列化请求保留字  类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA880180F;
	}
}

class OperateStock4PromotionWithAuthResp {
	var $result;
	var $errmsg;
	var $errorCode;
	var $errorMsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->errorCode = $bs->popObject('stl_map<uint64_t,stl_map<uint32_t,uint32_t> >'); // 反序列化错误码，SKUID->StoreHouseId->错误码 类型为std::map<uint64_t,std::map<uint32_t,uint32_t> > 
		$this->errorMsg = $bs->popObject('stl_map<uint64_t,stl_map<uint32_t,stl_string> >'); // 反序列化错误信息，SKUID->StoreHouseId->错误信息 类型为std::map<uint64_t,std::map<uint32_t,std::string> > 
		$this->outReserve = $bs->popString(); // 反序列化返回保留字   类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA880880F;
	}
}

class UpdateMultPriceRuleWithAuthReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $skuId;
	var $multPriceRulesPo;
	var $authWeb;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint8_t
		 $this->skuId = 0; // uint64_t
		 $this->multPriceRulesPo = new BossMultPriceRulesForSkuPo(); // b2b2c::icsonboss::po::CBossMultPriceRulesForSkuPo
		 $this->authWeb = new AuthorizationField4Web(); // b2b2c::comm::CAuthorizationField4Web
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID，必填 类型为uint32_t
		$bs->pushUint8_t($this->option); // 序列化选项，暂未用 类型为uint8_t
		$bs->pushUint64_t($this->skuId); // 序列化SKUID，必填 类型为uint64_t
		$bs->pushObject($this->multPriceRulesPo,'BossMultPriceRulesForSkuPo'); // 序列化SKU多价信息，必填 类型为b2b2c::icsonboss::po::CBossMultPriceRulesForSkuPo
		$bs->pushObject($this->authWeb,'AuthorizationField4Web'); // 序列化权限操作字段，必填 类型为b2b2c::comm::CAuthorizationField4Web
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA8801808;
	}
}

class UpdateMultPriceRuleWithAuthResp {
	var $result;
	var $errmsg;
	var $afterMultPriceRulesPo;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息，调试使用  类型为std::string
		$this->afterMultPriceRulesPo = $bs->popObject('BossMultPriceRulesForSkuPo'); // 反序列化SKU多价信息 类型为b2b2c::icsonboss::po::CBossMultPriceRulesForSkuPo
		$this->outReserve = $bs->popString(); // 反序列化返回保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA8808808;
	}
}

class UpdateMultPriceSceneBySceneIdWithAuthReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $priceSceneId;
	var $multPriceScenePo;
	var $authWeb;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint8_t
		 $this->priceSceneId = 0; // uint64_t
		 $this->multPriceScenePo = new BossMultPriceScenePo(); // b2b2c::icsonboss::po::CBossMultPriceScenePo
		 $this->authWeb = new AuthorizationField4Web(); // b2b2c::comm::CAuthorizationField4Web
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填  类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID，必填 类型为uint32_t
		$bs->pushUint8_t($this->option); // 序列化选项，暂未用 类型为uint8_t
		$bs->pushUint64_t($this->priceSceneId); // 序列化场景ID，为0表示新建 类型为uint64_t
		$bs->pushObject($this->multPriceScenePo,'BossMultPriceScenePo'); // 序列化多价场景，必填 类型为b2b2c::icsonboss::po::CBossMultPriceScenePo
		$bs->pushObject($this->authWeb,'AuthorizationField4Web'); // 序列化权限操作字段，必填 类型为b2b2c::comm::CAuthorizationField4Web
		$bs->pushString($this->inReserve); // 序列化请求保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA8801802;
	}
}

class UpdateMultPriceSceneBySceneIdWithAuthResp {
	var $result;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息，调试使用 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化返回保留字   类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA8808802;
	}
}

class UpdateMultPriceSourceBySourceIdWithAuthReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $priceSourceId;
	var $multPriceSourcePo;
	var $authWeb;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint8_t
		 $this->priceSourceId = 0; // uint64_t
		 $this->multPriceSourcePo = new BossMultPriceSourcePo(); // b2b2c::icsonboss::po::CBossMultPriceSourcePo
		 $this->authWeb = new AuthorizationField4Web(); // b2b2c::comm::CAuthorizationField4Web
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID，必填 类型为uint32_t
		$bs->pushUint8_t($this->option); // 序列化选项，暂未用 类型为uint8_t
		$bs->pushUint64_t($this->priceSourceId); // 序列化来源ID，为0 表示新建 类型为uint64_t
		$bs->pushObject($this->multPriceSourcePo,'BossMultPriceSourcePo'); // 序列化多价来源，必填 类型为b2b2c::icsonboss::po::CBossMultPriceSourcePo
		$bs->pushObject($this->authWeb,'AuthorizationField4Web'); // 序列化权限操作字段，必填 类型为b2b2c::comm::CAuthorizationField4Web
		$bs->pushString($this->inReserve); // 序列化请求保留字  类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA8801803;
	}
}

class UpdateMultPriceSourceBySourceIdWithAuthResp {
	var $result;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息，调试使用 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化返回保留字   类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA8808803;
	}
}

class UpdateStockPriceWithAuthReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $skuId;
	var $stockPricePo;
	var $authWeb;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint8_t
		 $this->skuId = 0; // uint64_t
		 $this->stockPricePo = new BossStockPricePo(); // b2b2c::icsonboss::po::CBossStockPricePo
		 $this->authWeb = new AuthorizationField4Web(); // b2b2c::comm::CAuthorizationField4Web
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必填 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID，必填 类型为uint32_t
		$bs->pushUint8_t($this->option); // 序列化选项，暂未用 类型为uint8_t
		$bs->pushUint64_t($this->skuId); // 序列化SKUID，必填 类型为uint64_t
		$bs->pushObject($this->stockPricePo,'BossStockPricePo'); // 序列化库存价格信息，必填 类型为b2b2c::icsonboss::po::CBossStockPricePo
		$bs->pushObject($this->authWeb,'AuthorizationField4Web'); // 序列化权限操作字段，必填 类型为b2b2c::comm::CAuthorizationField4Web
		$bs->pushString($this->inReserve); // 序列化请求保留字  类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA880180E;
	}
}

class UpdateStockPriceWithAuthResp {
	var $result;
	var $errmsg;
	var $stockPo;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误信息 类型为std::string
		$this->stockPo = $bs->popObject('BossStockPo'); // 反序列化修改后的库存数据 类型为b2b2c::icsonboss::po::CBossStockPo
		$this->outReserve = $bs->popString(); // 反序列化返回保留字   类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA880880E;
	}
}
?>