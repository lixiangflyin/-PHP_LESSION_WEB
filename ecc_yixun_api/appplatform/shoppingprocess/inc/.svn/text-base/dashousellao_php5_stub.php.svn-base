<?php
// source idl: com.icson.dashou.idl.DaShouSellAo.java
namespace icson;
require_once "dashousellao_php5_xxoo.php";

namespace icson\dashou\ao\dashousell;
class CheckTogetherSellReq{
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 用户机器码(版本>=0)
	private $source;	//<std::string> 请求来源(版本>=0)
	private $sceneId;	//<uint32_t> 场景id(版本>=0)
	private $whId;	//<uint32_t> 站点id(版本>=0)
	private $regionId;	//<uint32_t> 地域 id(版本>=0)
	private $uid;	//<uint64_t> 用户ID(版本>=0)
	private $checkParam;	//<icson::dashou::bo::CCheckTogetherSellParamBo> 详细业务参数队列(版本>=0)
	private $reserveIn;	//<std::string> ReserveIn(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->whId = 0;	//<uint32_t>
		$this->regionId = 0;	//<uint32_t>
		$this->uid = 0;	//<uint64_t>
		$this->checkParam = new \icson\dashou\bo\CheckTogetherSellParamBo();	//<icson::dashou::bo::CCheckTogetherSellParamBo>
		$this->reserveIn = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("CheckTogetherSellReq\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("CheckTogetherSellReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 用户机器码
		$bs->pushString($this->source);	//<std::string> 请求来源
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id
		$bs->pushUint32_t($this->whId);	//<uint32_t> 站点id
		$bs->pushUint32_t($this->regionId);	//<uint32_t> 地域 id
		$bs->pushUint64_t($this->uid);	//<uint64_t> 用户ID
		$bs->pushObject($this->checkParam,'\icson\dashou\bo\CheckTogetherSellParamBo');	//<icson::dashou::bo::CCheckTogetherSellParamBo> 详细业务参数队列
		$bs->pushString($this->reserveIn);	//<std::string> ReserveIn

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x89051802;
	}
}

class CheckTogetherSellResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $checkResult;	//<icson::dashou::bo::CCheckTogetherSellResultBo> check结果(版本>=0)
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $outReserve;	//<std::string>  保留输出参数,未使用 (版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['checkResult'] = $bs->popObject('\icson\dashou\bo\CheckTogetherSellResultBo');	//<icson::dashou::bo::CCheckTogetherSellResultBo> check结果
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string>  保留输出参数,未使用 

	}

	function getCmdId() {
		return 0x89058802;
	}
}

namespace icson\dashou\ao\dashousell;
class CheckTogetherSellPackageReq{
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 用户机器码(版本>=0)
	private $source;	//<std::string> 请求来源(版本>=0)
	private $sceneId;	//<uint32_t> 场景id(版本>=0)
	private $whId;	//<uint32_t> 站点id(版本>=0)
	private $regionId;	//<uint32_t> 地域 id(版本>=0)
	private $uid;	//<uint64_t> 用户ID(版本>=0)
	private $checkParam;	//<icson::dashou::bo::CCheckTogetherSellPkgParamBo> 需要校验的规则详情，通过套餐规则id校验套餐关系可以调用该接口(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->whId = 0;	//<uint32_t>
		$this->regionId = 0;	//<uint32_t>
		$this->uid = 0;	//<uint64_t>
		$this->checkParam = new \icson\dashou\bo\CheckTogetherSellPkgParamBo();	//<icson::dashou::bo::CCheckTogetherSellPkgParamBo>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("CheckTogetherSellPackageReq\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("CheckTogetherSellPackageReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 用户机器码
		$bs->pushString($this->source);	//<std::string> 请求来源
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id
		$bs->pushUint32_t($this->whId);	//<uint32_t> 站点id
		$bs->pushUint32_t($this->regionId);	//<uint32_t> 地域 id
		$bs->pushUint64_t($this->uid);	//<uint64_t> 用户ID
		$bs->pushObject($this->checkParam,'\icson\dashou\bo\CheckTogetherSellPkgParamBo');	//<icson::dashou::bo::CCheckTogetherSellPkgParamBo> 需要校验的规则详情，通过套餐规则id校验套餐关系可以调用该接口

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x89051804;
	}
}

class CheckTogetherSellPackageResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $checkResult;	//<icson::dashou::bo::CCheckTogetherSellPackageResultBo> 验证结果列表(版本>=0)
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $outReserve;	//<std::string>  保留输出参数,未使用 (版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['checkResult'] = $bs->popObject('\icson\dashou\bo\CheckTogetherSellPackageResultBo');	//<icson::dashou::bo::CCheckTogetherSellPackageResultBo> 验证结果列表
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string>  保留输出参数,未使用 

	}

	function getCmdId() {
		return 0x89058804;
	}
}

namespace icson\dashou\ao\dashousell;
class GetTogetherSellReq{
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 用户机器码(版本>=0)
	private $source;	//<std::string> 请求来源(版本>=0)
	private $sceneId;	//<uint32_t> 场景id(版本>=0)
	private $whId;	//<uint32_t> 站点id(版本>=0)
	private $regionId;	//<uint32_t> 地域 id(版本>=0)
	private $uid;	//<uint64_t> 用户ID(版本>=0)
	private $flag;	//<std::bitset<64> > 取哪些类型的搭售数据(版本>=0)
	private $mainproductList;	//<std::vector<icson::dashou::bo::CDSMainProduct> >  主商品参数信息(版本>=0)
	private $reserveIn;	//<std::string> ReserveIn(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->whId = 0;	//<uint32_t>
		$this->regionId = 0;	//<uint32_t>
		$this->uid = 0;	//<uint64_t>
		$this->flag = new \stl_bitset2('64');	//<std::bitset<64> >
		$this->mainproductList = new \stl_vector2('\icson\dashou\bo\DSMainProduct');	//<std::vector<icson::dashou::bo::CDSMainProduct> >
		$this->reserveIn = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("GetTogetherSellReq\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("GetTogetherSellReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 用户机器码
		$bs->pushString($this->source);	//<std::string> 请求来源
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id
		$bs->pushUint32_t($this->whId);	//<uint32_t> 站点id
		$bs->pushUint32_t($this->regionId);	//<uint32_t> 地域 id
		$bs->pushUint64_t($this->uid);	//<uint64_t> 用户ID
		$bs->pushObject($this->flag,'stl_bitset');	//<std::bitset<64> > 取哪些类型的搭售数据
		$bs->pushObject($this->mainproductList,'stl_vector');	//<std::vector<icson::dashou::bo::CDSMainProduct> >  主商品参数信息
		$bs->pushString($this->reserveIn);	//<std::string> ReserveIn

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x89051801;
	}
}

class GetTogetherSellResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $mainTogetherSell;	//<std::vector<icson::dashou::bo::CTogethersellItemBo> >  规则id为key，value为对应搭售全部信息(版本>=0)
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $outReserve;	//<std::string> 输出保留字(版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['mainTogetherSell'] = $bs->popObject('stl_vector<\icson\dashou\bo\TogethersellItemBo>');	//<std::vector<icson::dashou::bo::CTogethersellItemBo> >  规则id为key，value为对应搭售全部信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0x89058801;
	}
}

namespace icson\dashou\ao\dashousell;
class GetTogetherSellRuleDetailReq{
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 用户机器码(版本>=0)
	private $source;	//<std::string> 请求来源(版本>=0)
	private $sceneId;	//<uint32_t> 场景id(版本>=0)
	private $whId;	//<uint32_t> 站点id(版本>=0)
	private $regionId;	//<uint32_t> 地域 id(版本>=0)
	private $uid;	//<uint64_t> 用户ID(版本>=0)
	private $ruleFilter;	//<std::vector<icson::dashou::bo::CRuleFilterBo> > 需要查询的规则详情，目前后台只返回套餐的规则数据，其他几个业务还没有这个需求(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->whId = 0;	//<uint32_t>
		$this->regionId = 0;	//<uint32_t>
		$this->uid = 0;	//<uint64_t>
		$this->ruleFilter = new \stl_vector2('\icson\dashou\bo\RuleFilterBo');	//<std::vector<icson::dashou::bo::CRuleFilterBo> >
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("GetTogetherSellRuleDetailReq\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("GetTogetherSellRuleDetailReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 用户机器码
		$bs->pushString($this->source);	//<std::string> 请求来源
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id
		$bs->pushUint32_t($this->whId);	//<uint32_t> 站点id
		$bs->pushUint32_t($this->regionId);	//<uint32_t> 地域 id
		$bs->pushUint64_t($this->uid);	//<uint64_t> 用户ID
		$bs->pushObject($this->ruleFilter,'stl_vector');	//<std::vector<icson::dashou::bo::CRuleFilterBo> > 需要查询的规则详情，目前后台只返回套餐的规则数据，其他几个业务还没有这个需求

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x89051803;
	}
}

class GetTogetherSellRuleDetailResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $mainTogethersell;	//<std::vector<icson::dashou::bo::CTogethersellRuleBo> >  规则id为key，value为对应规则详情(版本>=0)
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $outReserve;	//<std::string>  保留输出参数,未使用 (版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['mainTogethersell'] = $bs->popObject('stl_vector<\icson\dashou\bo\TogethersellRuleBo>');	//<std::vector<icson::dashou::bo::CTogethersellRuleBo> >  规则id为key，value为对应规则详情
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string>  保留输出参数,未使用 

	}

	function getCmdId() {
		return 0x89058803;
	}
}
