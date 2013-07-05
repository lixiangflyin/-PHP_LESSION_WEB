<?php
// source idl: com.b2b2c.sku.idl.DetailViewAo.java
namespace b2b2c;
require_once "detailviewao_php5_xxoo.php";

namespace b2b2c\sku\ao;
class BatchGetIcsonCrossSaleRelationReq{
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $source;	//<std::string> 调用来源，必填(版本>=0)
	private $sceneId;	//<uint32_t> 如果使用appplatform调用 填命令号；如果php调用 请向@alibowang申请；必填(版本>=0)
	private $option;	//<uint32_t> 选项，暂未用(版本>=0)
	private $icsonId;	//<std::set<std::string> > 易迅ID，必填；易迅ID含：易迅商品系统编码(如sysno:528211 或者icson-52811)或者产品编码(如pid:15-058-152)(版本>=0)
	private $cooperatorId;	//<uint32_t> 合作伙伴id，必填(版本>=0)
	private $inReserve;	//<std::string> 入参保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->option = 0;	//<uint32_t>
		$this->icsonId = new \stl_set2('stl_string');	//<std::set<std::string> >
		$this->cooperatorId = 0;	//<uint32_t>
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("BatchGetIcsonCrossSaleRelationReq\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();	
					if(class_exists($class,false)){						
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}	
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);				
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
			}else{
				if($name=="version" && ($val < 0 || $val > $this->version)){
					exit("Version error.It must be > 0 and < {$this->version} (default version).Now value is {$val}.");
				}
				$this->$name=$val;
			}
			if(isset($this->{$name.'_u'})){
				$this->{$name.'_u'}=1;
			}
		}else{
			exit("BatchGetIcsonCrossSaleRelationReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->source);	//<std::string> 调用来源，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 如果使用appplatform调用 填命令号；如果php调用 请向@alibowang申请；必填
		$bs->pushUint32_t($this->option);	//<uint32_t> 选项，暂未用
		$bs->pushObject($this->icsonId,'stl_set');	//<std::set<std::string> > 易迅ID，必填；易迅ID含：易迅商品系统编码(如sysno:528211 或者icson-52811)或者产品编码(如pid:15-058-152)
		$bs->pushUint32_t($this->cooperatorId);	//<uint32_t> 合作伙伴id，必填
		$bs->pushString($this->inReserve);	//<std::string> 入参保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA1A01804;
	}
}

class BatchGetIcsonCrossSaleRelationResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $crossSaleRelationInfo;	//<std::map<std::string,std::vector<b2b2c::detailview::po::CViewCrossSaleRelationPo> > > 跨仓销售设置信息，只返回有效信息 key:icsonid value:仓库信息集合(版本>=0)
	private $outReserve;	//<std::string> 出参保留字(版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['crossSaleRelationInfo'] = $bs->popObject('stl_map<stl_string,stl_vector<\b2b2c\detailview\po\ViewCrossSaleRelationPo> >');	//<std::map<std::string,std::vector<b2b2c::detailview::po::CViewCrossSaleRelationPo> > > 跨仓销售设置信息，只返回有效信息 key:icsonid value:仓库信息集合
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 出参保留字

	}

	function getCmdId() {
		return 0xA1A08804;
	}
}

namespace b2b2c\sku\ao;
class BatchGetMultPriceRule4PromotionReq{
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $source;	//<std::string> 调用来源，必填(版本>=0)
	private $scene;	//<uint32_t> 如果使用appplatform调用 填命令号；如果php调用 请向@alibowang申请；必填(版本>=0)
	private $option;	//<uint64_t> 选项，暂未用(版本>=0)
	private $commodityIdQueryPo;	//<std::map<std::string,b2b2c::detailview::po::CViewMultPriceQueryPo> > 需要获取多价的commodityid列表 兼容三个平台commodity 内部做区分 如易迅 key为icson-102923,当ViewMultPriceQueryPo为空时不进行过滤(版本>=0)
	private $inReserve;	//<std::string> 请求保留字 (版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->scene = 0;	//<uint32_t>
		$this->option = 0;	//<uint64_t>
		$this->commodityIdQueryPo = new \stl_map2('stl_string,\b2b2c\detailview\po\ViewMultPriceQueryPo');	//<std::map<std::string,b2b2c::detailview::po::CViewMultPriceQueryPo> >
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("BatchGetMultPriceRule4PromotionReq\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();	
					if(class_exists($class,false)){						
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}	
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);				
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
			}else{
				if($name=="version" && ($val < 0 || $val > $this->version)){
					exit("Version error.It must be > 0 and < {$this->version} (default version).Now value is {$val}.");
				}
				$this->$name=$val;
			}
			if(isset($this->{$name.'_u'})){
				$this->{$name.'_u'}=1;
			}
		}else{
			exit("BatchGetMultPriceRule4PromotionReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->source);	//<std::string> 调用来源，必填
		$bs->pushUint32_t($this->scene);	//<uint32_t> 如果使用appplatform调用 填命令号；如果php调用 请向@alibowang申请；必填
		$bs->pushUint64_t($this->option);	//<uint64_t> 选项，暂未用
		$bs->pushObject($this->commodityIdQueryPo,'stl_map');	//<std::map<std::string,b2b2c::detailview::po::CViewMultPriceQueryPo> > 需要获取多价的commodityid列表 兼容三个平台commodity 内部做区分 如易迅 key为icson-102923,当ViewMultPriceQueryPo为空时不进行过滤
		$bs->pushString($this->inReserve);	//<std::string> 请求保留字 

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA1A01803;
	}
}

class BatchGetMultPriceRule4PromotionResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息，调试使用(版本>=0)
	private $mapViewMultPriceRulesForSkuPo;	//<std::map<std::string,b2b2c::detailview::po::CViewMultPriceRulesForSkuPo> > 多价规格列表，commodityid->多价规则列表(版本>=0)
	private $outReserve;	//<std::string> 返回保留字(版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息，调试使用
		$this->_arr_value['mapViewMultPriceRulesForSkuPo'] = $bs->popObject('stl_map<stl_string,\b2b2c\detailview\po\ViewMultPriceRulesForSkuPo>');	//<std::map<std::string,b2b2c::detailview::po::CViewMultPriceRulesForSkuPo> > 多价规格列表，commodityid->多价规则列表
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 返回保留字

	}

	function getCmdId() {
		return 0xA1A08803;
	}
}

namespace b2b2c\sku\ao;
class BatchGetMultPriceRule4SearchReq{
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $source;	//<std::string> 调用来源，必填(版本>=0)
	private $scene;	//<uint32_t> 如果使用appplatform调用 填命令号；如果php调用 请向@alibowang申请；必填(版本>=0)
	private $option;	//<uint64_t> 选项，暂未用(版本>=0)
	private $commodityIdQueryPo;	//<std::map<std::string,b2b2c::detailview::po::CViewMultPriceQueryPo> > 需要获取多价的commodityid列表 兼容三个平台commodity 内部做区分 如易迅 key为icson-102923,当ViewMultPriceQueryPo为空时不进行过滤(版本>=0)
	private $inReserve;	//<std::string> 请求保留字 (版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->scene = 0;	//<uint32_t>
		$this->option = 0;	//<uint64_t>
		$this->commodityIdQueryPo = new \stl_map2('stl_string,\b2b2c\detailview\po\ViewMultPriceQueryPo');	//<std::map<std::string,b2b2c::detailview::po::CViewMultPriceQueryPo> >
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("BatchGetMultPriceRule4SearchReq\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();	
					if(class_exists($class,false)){						
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}	
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);				
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
			}else{
				if($name=="version" && ($val < 0 || $val > $this->version)){
					exit("Version error.It must be > 0 and < {$this->version} (default version).Now value is {$val}.");
				}
				$this->$name=$val;
			}
			if(isset($this->{$name.'_u'})){
				$this->{$name.'_u'}=1;
			}
		}else{
			exit("BatchGetMultPriceRule4SearchReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->source);	//<std::string> 调用来源，必填
		$bs->pushUint32_t($this->scene);	//<uint32_t> 如果使用appplatform调用 填命令号；如果php调用 请向@alibowang申请；必填
		$bs->pushUint64_t($this->option);	//<uint64_t> 选项，暂未用
		$bs->pushObject($this->commodityIdQueryPo,'stl_map');	//<std::map<std::string,b2b2c::detailview::po::CViewMultPriceQueryPo> > 需要获取多价的commodityid列表 兼容三个平台commodity 内部做区分 如易迅 key为icson-102923,当ViewMultPriceQueryPo为空时不进行过滤
		$bs->pushString($this->inReserve);	//<std::string> 请求保留字 

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA1A01806;
	}
}

class BatchGetMultPriceRule4SearchResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息，调试使用(版本>=0)
	private $mapViewMultPriceRulesForSkuPo;	//<std::map<std::string,b2b2c::detailview::po::CViewMultPriceRulesForSkuPo> > 多价规格列表，commodityid->多价规则列表(版本>=0)
	private $outReserve;	//<std::string> 返回保留字(版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息，调试使用
		$this->_arr_value['mapViewMultPriceRulesForSkuPo'] = $bs->popObject('stl_map<stl_string,\b2b2c\detailview\po\ViewMultPriceRulesForSkuPo>');	//<std::map<std::string,b2b2c::detailview::po::CViewMultPriceRulesForSkuPo> > 多价规格列表，commodityid->多价规则列表
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 返回保留字

	}

	function getCmdId() {
		return 0xA1A08806;
	}
}

namespace b2b2c\sku\ao;
class BatchGetSkuByIcsonIdReq{
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $source;	//<std::string> 调用来源，必填(版本>=0)
	private $sceneId;	//<uint32_t> 如果使用appplatform调用 填命令号；如果php调用 请向@alibowang申请；必填(版本>=0)
	private $option;	//<uint32_t> 选项，暂未用(版本>=0)
	private $cooperatorId;	//<uint32_t> 合作伙伴id，必填(版本>=0)
	private $icsonId;	//<std::set<std::string> > 易迅ID，必填；易迅ID含：易迅商品系统编码(如sysno:528211 或者icson-52811)或者产品编码(如pid:15-058-152)(版本>=0)
	private $inReserve;	//<std::string> 入参保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->option = 0;	//<uint32_t>
		$this->cooperatorId = 0;	//<uint32_t>
		$this->icsonId = new \stl_set2('stl_string');	//<std::set<std::string> >
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("BatchGetSkuByIcsonIdReq\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();	
					if(class_exists($class,false)){						
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}	
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);				
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
			}else{
				if($name=="version" && ($val < 0 || $val > $this->version)){
					exit("Version error.It must be > 0 and < {$this->version} (default version).Now value is {$val}.");
				}
				$this->$name=$val;
			}
			if(isset($this->{$name.'_u'})){
				$this->{$name.'_u'}=1;
			}
		}else{
			exit("BatchGetSkuByIcsonIdReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->source);	//<std::string> 调用来源，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 如果使用appplatform调用 填命令号；如果php调用 请向@alibowang申请；必填
		$bs->pushUint32_t($this->option);	//<uint32_t> 选项，暂未用
		$bs->pushUint32_t($this->cooperatorId);	//<uint32_t> 合作伙伴id，必填
		$bs->pushObject($this->icsonId,'stl_set');	//<std::set<std::string> > 易迅ID，必填；易迅ID含：易迅商品系统编码(如sysno:528211 或者icson-52811)或者产品编码(如pid:15-058-152)
		$bs->pushString($this->inReserve);	//<std::string> 入参保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA1A01805;
	}
}

class BatchGetSkuByIcsonIdResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $skuPo;	//<std::map<std::string,b2b2c::detailview::po::CViewSkuPo> > SKU信息(版本>=0)
	private $outReserve;	//<std::string> 出参保留字(版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['skuPo'] = $bs->popObject('stl_map<stl_string,\b2b2c\detailview\po\ViewSkuPo>');	//<std::map<std::string,b2b2c::detailview::po::CViewSkuPo> > SKU信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 出参保留字

	}

	function getCmdId() {
		return 0xA1A08805;
	}
}

namespace b2b2c\sku\ao;
class FetchSkuInfo4DetailReq{
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 客户端机器码（浏览器客户端唯一ID），必填 (版本>=0)
	private $source;	//<std::string> 调用来源，填文件名or函数名即可，必填 (版本>=0)
	private $sceneId;	//<uint32_t> 如果使用appplatform调用填命令号；如果php调用，请向@alibowang申请；必填(版本>=0)
	private $option;	//<uint64_t> 选项， bit位表示，第一个bit位取单品，defualt取全部主子商品(版本>=0)
	private $commodityId;	//<std::string> Commodityid 兼容三个平台commodity 内部做区分 如易迅填：icson-102923，必填(版本>=0)
	private $areaId;	//<uint32_t> 地域ID， 网购现行国标地域编码，不填或者填写错误将不进行地域过滤(版本>=0)
	private $cooperatorId;	//<uint32_t> 合作伙伴ID，选填；为0：返回全部SKU，非0：返回指定合作伙伴的SKU(版本>=0)
	private $inReserve;	//<std::string> 请求保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->option = 0;	//<uint64_t>
		$this->commodityId = "";	//<std::string>
		$this->areaId = 0;	//<uint32_t>
		$this->cooperatorId = 0;	//<uint32_t>
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("FetchSkuInfo4DetailReq\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();	
					if(class_exists($class,false)){						
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}	
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);				
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
			}else{
				if($name=="version" && ($val < 0 || $val > $this->version)){
					exit("Version error.It must be > 0 and < {$this->version} (default version).Now value is {$val}.");
				}
				$this->$name=$val;
			}
			if(isset($this->{$name.'_u'})){
				$this->{$name.'_u'}=1;
			}
		}else{
			exit("FetchSkuInfo4DetailReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 客户端机器码（浏览器客户端唯一ID），必填 
		$bs->pushString($this->source);	//<std::string> 调用来源，填文件名or函数名即可，必填 
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 如果使用appplatform调用填命令号；如果php调用，请向@alibowang申请；必填
		$bs->pushUint64_t($this->option);	//<uint64_t> 选项， bit位表示，第一个bit位取单品，defualt取全部主子商品
		$bs->pushString($this->commodityId);	//<std::string> Commodityid 兼容三个平台commodity 内部做区分 如易迅填：icson-102923，必填
		$bs->pushUint32_t($this->areaId);	//<uint32_t> 地域ID， 网购现行国标地域编码，不填或者填写错误将不进行地域过滤
		$bs->pushUint32_t($this->cooperatorId);	//<uint32_t> 合作伙伴ID，选填；为0：返回全部SKU，非0：返回指定合作伙伴的SKU
		$bs->pushString($this->inReserve);	//<std::string> 请求保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA1A01801;
	}
}

class FetchSkuInfo4DetailResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息，调试使用 (版本>=0)
	private $viewSpuPo;	//<b2b2c::detailview::po::CViewSpuPo> 商品信息(版本>=0)
	private $outReserve;	//<std::string> 返回保留字(版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息，调试使用 
		$this->_arr_value['viewSpuPo'] = $bs->popObject('\b2b2c\detailview\po\ViewSpuPo');	//<b2b2c::detailview::po::CViewSpuPo> 商品信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 返回保留字

	}

	function getCmdId() {
		return 0xA1A08801;
	}
}

namespace b2b2c\sku\ao;
class FetchSkuListInfoReq{
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 客户端机器码（浏览器客户端唯一ID），必填 (版本>=0)
	private $source;	//<std::string> 调用来源，填文件名or函数名即可，必填  (版本>=0)
	private $sceneId;	//<uint32_t> 如果使用appplatform调用 填命令号；如果php调用 请向@alibowang申请；必填(版本>=0)
	private $option;	//<uint64_t> 选项，option等于1时 供搜索使用 --- 待实现(版本>=0)
	private $skuListFilter;	//<std::vector<b2b2c::detailview::po::CViewSkuFilterPo> > 过滤器，必填(版本>=0)
	private $areaId;	//<uint32_t> 地域ID，必填，网购现行国标地域编码 (版本>=0)
	private $inReserve;	//<std::string> 请求保留字 ，选填(版本>=0)
	private $inLocalKey;	//<std::string> 请求保留字，选填(版本>=0)
	private $extent;	//<std::map<std::string,std::string> > 请求保留字，拓展用，选填 (版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->option = 0;	//<uint64_t>
		$this->skuListFilter = new \stl_vector2('\b2b2c\detailview\po\ViewSkuFilterPo');	//<std::vector<b2b2c::detailview::po::CViewSkuFilterPo> >
		$this->areaId = 0;	//<uint32_t>
		$this->inReserve = "";	//<std::string>
		$this->inLocalKey = "";	//<std::string>
		$this->extent = new \stl_map2('stl_string,stl_string');	//<std::map<std::string,std::string> >
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("FetchSkuListInfoReq\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();	
					if(class_exists($class,false)){						
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}	
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);				
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
			}else{
				if($name=="version" && ($val < 0 || $val > $this->version)){
					exit("Version error.It must be > 0 and < {$this->version} (default version).Now value is {$val}.");
				}
				$this->$name=$val;
			}
			if(isset($this->{$name.'_u'})){
				$this->{$name.'_u'}=1;
			}
		}else{
			exit("FetchSkuListInfoReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 客户端机器码（浏览器客户端唯一ID），必填 
		$bs->pushString($this->source);	//<std::string> 调用来源，填文件名or函数名即可，必填  
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 如果使用appplatform调用 填命令号；如果php调用 请向@alibowang申请；必填
		$bs->pushUint64_t($this->option);	//<uint64_t> 选项，option等于1时 供搜索使用 --- 待实现
		$bs->pushObject($this->skuListFilter,'stl_vector');	//<std::vector<b2b2c::detailview::po::CViewSkuFilterPo> > 过滤器，必填
		$bs->pushUint32_t($this->areaId);	//<uint32_t> 地域ID，必填，网购现行国标地域编码 
		$bs->pushString($this->inReserve);	//<std::string> 请求保留字 ，选填
		$bs->pushString($this->inLocalKey);	//<std::string> 请求保留字，选填
		$bs->pushObject($this->extent,'stl_map');	//<std::map<std::string,std::string> > 请求保留字，拓展用，选填 

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA1A01802;
	}
}

class FetchSkuListInfoResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息，调试使用 (版本>=0)
	private $viewSpu;	//<std::map<std::string,b2b2c::detailview::po::CViewSpuPo> > 商品信息，commodityid->商品信息(版本>=0)
	private $viewSpuPoError;	//<std::map<std::string,b2b2c::detailview::po::CViewSkuErrorPo> > 错误信息，commodityid->错误信息(版本>=0)
	private $outLocalKey;	//<std::string> 请求保留字Key，恒等于inLocalKey(版本>=0)
	private $outReserve;	//<std::string> 返回保留字 (版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息，调试使用 
		$this->_arr_value['viewSpu'] = $bs->popObject('stl_map<stl_string,\b2b2c\detailview\po\ViewSpuPo>');	//<std::map<std::string,b2b2c::detailview::po::CViewSpuPo> > 商品信息，commodityid->商品信息
		$this->_arr_value['viewSpuPoError'] = $bs->popObject('stl_map<stl_string,\b2b2c\detailview\po\ViewSkuErrorPo>');	//<std::map<std::string,b2b2c::detailview::po::CViewSkuErrorPo> > 错误信息，commodityid->错误信息
		$this->_arr_value['outLocalKey'] = $bs->popString();	//<std::string> 请求保留字Key，恒等于inLocalKey
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 返回保留字 

	}

	function getCmdId() {
		return 0xA1A08802;
	}
}

namespace b2b2c\sku\ao;
class FetchSkuListInfo4ShopCartReq{
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 客户端机器码（浏览器客户端唯一ID），必填 (版本>=0)
	private $source;	//<std::string> 调用来源，填文件名or函数名即可，必填  (版本>=0)
	private $sceneId;	//<uint32_t> 使用时需要向@alibowang申请；必填(版本>=0)
	private $option;	//<uint64_t> 选项，暂未用(版本>=0)
	private $skuListFilter;	//<std::vector<b2b2c::detailview::po::CViewSkuFilterPo> > 过滤器，必填 参考相关Po(版本>=0)
	private $areaId;	//<uint32_t> 地域ID，必填，网购现行国标地域编码 需要进行地域过滤时使用，如无需过滤 可以填0(版本>=0)
	private $inReserve;	//<std::string> 请求保留字 ，选填 (版本>=0)
	private $inLocalKey;	//<std::string> 请求保留字，选填 暂未用(版本>=0)
	private $extent;	//<std::map<std::string,std::string> > 请求保留字，拓展用，选填 暂未用 (版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->option = 0;	//<uint64_t>
		$this->skuListFilter = new \stl_vector2('\b2b2c\detailview\po\ViewSkuFilterPo');	//<std::vector<b2b2c::detailview::po::CViewSkuFilterPo> >
		$this->areaId = 0;	//<uint32_t>
		$this->inReserve = "";	//<std::string>
		$this->inLocalKey = "";	//<std::string>
		$this->extent = new \stl_map2('stl_string,stl_string');	//<std::map<std::string,std::string> >
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("FetchSkuListInfo4ShopCartReq\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();	
					if(class_exists($class,false)){						
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}	
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);				
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
			}else{
				if($name=="version" && ($val < 0 || $val > $this->version)){
					exit("Version error.It must be > 0 and < {$this->version} (default version).Now value is {$val}.");
				}
				$this->$name=$val;
			}
			if(isset($this->{$name.'_u'})){
				$this->{$name.'_u'}=1;
			}
		}else{
			exit("FetchSkuListInfo4ShopCartReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 客户端机器码（浏览器客户端唯一ID），必填 
		$bs->pushString($this->source);	//<std::string> 调用来源，填文件名or函数名即可，必填  
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 使用时需要向@alibowang申请；必填
		$bs->pushUint64_t($this->option);	//<uint64_t> 选项，暂未用
		$bs->pushObject($this->skuListFilter,'stl_vector');	//<std::vector<b2b2c::detailview::po::CViewSkuFilterPo> > 过滤器，必填 参考相关Po
		$bs->pushUint32_t($this->areaId);	//<uint32_t> 地域ID，必填，网购现行国标地域编码 需要进行地域过滤时使用，如无需过滤 可以填0
		$bs->pushString($this->inReserve);	//<std::string> 请求保留字 ，选填 
		$bs->pushString($this->inLocalKey);	//<std::string> 请求保留字，选填 暂未用
		$bs->pushObject($this->extent,'stl_map');	//<std::map<std::string,std::string> > 请求保留字，拓展用，选填 暂未用 

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA1A01807;
	}
}

class FetchSkuListInfo4ShopCartResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息，调试使用 (版本>=0)
	private $viewSpu;	//<std::map<std::string,b2b2c::detailview::po::CViewSpuPo> > 商品信息，commodityid->商品信息 icson-1234 ---> SpuPo(版本>=0)
	private $viewSpuPoError;	//<std::map<std::string,b2b2c::detailview::po::CViewSkuErrorPo> > 错误信息，commodityid->错误信息(版本>=0)
	private $outLocalKey;	//<std::string> 请求保留字Key，恒等于inLocalKey(版本>=0)
	private $outReserve;	//<std::string> 返回保留字 (版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息，调试使用 
		$this->_arr_value['viewSpu'] = $bs->popObject('stl_map<stl_string,\b2b2c\detailview\po\ViewSpuPo>');	//<std::map<std::string,b2b2c::detailview::po::CViewSpuPo> > 商品信息，commodityid->商品信息 icson-1234 ---> SpuPo
		$this->_arr_value['viewSpuPoError'] = $bs->popObject('stl_map<stl_string,\b2b2c\detailview\po\ViewSkuErrorPo>');	//<std::map<std::string,b2b2c::detailview::po::CViewSkuErrorPo> > 错误信息，commodityid->错误信息
		$this->_arr_value['outLocalKey'] = $bs->popString();	//<std::string> 请求保留字Key，恒等于inLocalKey
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 返回保留字 

	}

	function getCmdId() {
		return 0xA1A08807;
	}
}

namespace b2b2c\sku\ao;
class MultiGetInventoryReq{
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> machinekey，必填(版本>=0)
	private $source;	//<std::string> Source，必填(版本>=0)
	private $sceneId;	//<uint32_t> 场景Id，必填(版本>=0)
	private $option;	//<uint32_t> 选项参数(版本>=0)
	private $inventoryMulFilterAdminPo;	//<b2b2c::detailview::po::CViewInventoryMulFilterAdminPo> 查询过滤条件Po， 必填(版本>=0)
	private $inLocalkey;	//<std::string> 输入key (版本>=0)
	private $inStrReserve;	//<std::string> inStrReserve(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->option = 0;	//<uint32_t>
		$this->inventoryMulFilterAdminPo = new \b2b2c\detailview\po\ViewInventoryMulFilterAdminPo();	//<b2b2c::detailview::po::CViewInventoryMulFilterAdminPo>
		$this->inLocalkey = "";	//<std::string>
		$this->inStrReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("MultiGetInventoryReq\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();	
					if(class_exists($class,false)){						
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}	
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);				
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
			}else{
				if($name=="version" && ($val < 0 || $val > $this->version)){
					exit("Version error.It must be > 0 and < {$this->version} (default version).Now value is {$val}.");
				}
				$this->$name=$val;
			}
			if(isset($this->{$name.'_u'})){
				$this->{$name.'_u'}=1;
			}
		}else{
			exit("MultiGetInventoryReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> machinekey，必填
		$bs->pushString($this->source);	//<std::string> Source，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景Id，必填
		$bs->pushUint32_t($this->option);	//<uint32_t> 选项参数
		$bs->pushObject($this->inventoryMulFilterAdminPo,'\b2b2c\detailview\po\ViewInventoryMulFilterAdminPo');	//<b2b2c::detailview::po::CViewInventoryMulFilterAdminPo> 查询过滤条件Po， 必填
		$bs->pushString($this->inLocalkey);	//<std::string> 输入key 
		$bs->pushString($this->inStrReserve);	//<std::string> inStrReserve

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA1A01808;
	}
}

class MultiGetInventoryResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $inventoyRecordPo;	//<std::map<uint64_t,std::vector<b2b2c::detailview::po::CViewOmsStockPo> > > 返回 整条库存详细数据List(版本>=0)
	private $outLocalkey;	//<std::string> 输出key (版本>=0)
	private $outReserve;	//<std::string> OutReserve(版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['inventoyRecordPo'] = $bs->popObject('stl_map<uint64_t,stl_vector<\b2b2c\detailview\po\ViewOmsStockPo> >');	//<std::map<uint64_t,std::vector<b2b2c::detailview::po::CViewOmsStockPo> > > 返回 整条库存详细数据List
		$this->_arr_value['outLocalkey'] = $bs->popString();	//<std::string> 输出key 
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> OutReserve

	}

	function getCmdId() {
		return 0xA1A08808;
	}
}
