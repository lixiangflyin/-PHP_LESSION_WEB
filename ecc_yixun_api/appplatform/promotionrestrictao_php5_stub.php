<?php
// source idl: com.icson.promotionrestrict.idl.PromotionRestrictAo.java
namespace icson;
//require_once "promotionrestrictao_php5_xxoo.php";

namespace icson\promotionrestrict\ao\promotionrestrict;
class GetActiveBatchPromotionRestrictReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 用户机器码(版本>=0)
	private $source;	//<std::string> 请求来源(版本>=0)
	private $sceneId;	//<uint32_t> 场景id(版本>=0)
	private $uin;	//<uint64_t> 用户Id(版本>=0)
	private $restrictParamListIn;	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> > 详细业务参数队列(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->uin = 0;	//<uint64_t>
		$this->restrictParamListIn = new \stl_vector2('\icson\promotionrestrict\bo\PromotionRestrictParamInfo_Bo');	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> >
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				$this->initClass($name,$val,$this->$name);
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
			exit("GetActiveBatchPromotionRestrictReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetActiveBatchPromotionRestrict\\{$name}：请直接赋值为数组，无需new ***。");
		$base=array('bool','byte','uint8_t','int8_t','uint16_t','int16_t','uint32_t','int32_t','uint64_t','int64_t','long','int','string','stl_string');
		if(strpos(get_class($obj), 'stl_')===0){			
			$class=$obj->element_type;
			$arr = array();	
			if(in_array($class, $base)){
				$arr=$val;
			}else if(strpos($class,'stl_')===0){
				$cls=explode("<", $class);
				$cls="\\".trim($cls[0])."2";
				$start=strpos($obj->element_type,'<')+1;
				$end= strrpos($obj->element_type,'>');
				$parm= trim(substr($obj->element_type, $start,$end-$start));
				foreach($val as $k => $v){					
					$arr[$k]=new $cls($parm);
					$this->initClass($name.'\\'.$k,$v,$arr[$k]);
				}		
			}else{
				foreach ($val as $key => $value) {
					$arr[$key]=new $class();
					foreach($value as $k => $v){
						if(is_object($arr[$key]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$key]->$k);
						}else{
							$arr[$key]->$k=$v;
						}
					}	
				}					
			}
			$obj->setValue($arr);				
		}else{
			foreach($val as $k => $v){
				if(is_object($obj->$k)){
					$this->initClass($name.'\\'.$k,$v,$obj->$k);
				}else{
					$obj->$k=$v;
				}	
			}
		}	
	}
	
	function getRouteKey(){
		if($this->_routeKey){
			return $this->{$this->_routeKey};
		}
		
		return null;
	}
	
	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 用户机器码
		$bs->pushString($this->source);	//<std::string> 请求来源
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id
		$bs->pushUint64_t($this->uin);	//<uint64_t> 用户Id
		$bs->pushObject($this->restrictParamListIn,'stl_vector');	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> > 详细业务参数队列

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x9A101805;
	}
}

class GetActiveBatchPromotionRestrictResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $restrictParamListOut;	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> > 详细业务参数队列(版本>=0)
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $outReserve;	//<std::string>  保留输出参数,未使用 (版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			if(array_key_exists('errMsg', $this->_arr_value)){
				$name='errMsg';
			}else{
				return "errmsg is not define.";
			}
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['restrictParamListOut'] = $bs->popObject('stl_vector<\icson\promotionrestrict\bo\PromotionRestrictParamInfo_Bo>');	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> > 详细业务参数队列
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string>  保留输出参数,未使用 

	}

	function getCmdId() {
		return 0x9A108805;
	}
}

namespace icson\promotionrestrict\ao\promotionrestrict;
class GetDealBatchPromotionRestrictReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 用户机器码(版本>=0)
	private $source;	//<std::string> 请求来源(版本>=0)
	private $sceneId;	//<uint32_t> 场景id(版本>=0)
	private $uin;	//<uint64_t> 用户Id(版本>=0)
	private $restrictParamListIn;	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> > 详细业务参数队列(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->uin = 0;	//<uint64_t>
		$this->restrictParamListIn = new \stl_vector2('\icson\promotionrestrict\bo\PromotionRestrictParamInfo_Bo');	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> >
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				$this->initClass($name,$val,$this->$name);
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
			exit("GetDealBatchPromotionRestrictReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetDealBatchPromotionRestrict\\{$name}：请直接赋值为数组，无需new ***。");
		$base=array('bool','byte','uint8_t','int8_t','uint16_t','int16_t','uint32_t','int32_t','uint64_t','int64_t','long','int','string','stl_string');
		if(strpos(get_class($obj), 'stl_')===0){			
			$class=$obj->element_type;
			$arr = array();	
			if(in_array($class, $base)){
				$arr=$val;
			}else if(strpos($class,'stl_')===0){
				$cls=explode("<", $class);
				$cls="\\".trim($cls[0])."2";
				$start=strpos($obj->element_type,'<')+1;
				$end= strrpos($obj->element_type,'>');
				$parm= trim(substr($obj->element_type, $start,$end-$start));
				foreach($val as $k => $v){					
					$arr[$k]=new $cls($parm);
					$this->initClass($name.'\\'.$k,$v,$arr[$k]);
				}		
			}else{
				foreach ($val as $key => $value) {
					$arr[$key]=new $class();
					foreach($value as $k => $v){
						if(is_object($arr[$key]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$key]->$k);
						}else{
							$arr[$key]->$k=$v;
						}
					}	
				}					
			}
			$obj->setValue($arr);				
		}else{
			foreach($val as $k => $v){
				if(is_object($obj->$k)){
					$this->initClass($name.'\\'.$k,$v,$obj->$k);
				}else{
					$obj->$k=$v;
				}	
			}
		}	
	}
	
	function getRouteKey(){
		if($this->_routeKey){
			return $this->{$this->_routeKey};
		}
		
		return null;
	}
	
	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 用户机器码
		$bs->pushString($this->source);	//<std::string> 请求来源
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id
		$bs->pushUint64_t($this->uin);	//<uint64_t> 用户Id
		$bs->pushObject($this->restrictParamListIn,'stl_vector');	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> > 详细业务参数队列

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x9A101802;
	}
}

class GetDealBatchPromotionRestrictResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $restrictParamListOut;	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> > 详细业务参数队列(版本>=0)
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $outReserve;	//<std::string>  保留输出参数,未使用 (版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			if(array_key_exists('errMsg', $this->_arr_value)){
				$name='errMsg';
			}else{
				return "errmsg is not define.";
			}
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['restrictParamListOut'] = $bs->popObject('stl_vector<\icson\promotionrestrict\bo\PromotionRestrictParamInfo_Bo>');	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> > 详细业务参数队列
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string>  保留输出参数,未使用 

	}

	function getCmdId() {
		return 0x9A108802;
	}
}

namespace icson\promotionrestrict\ao\promotionrestrict;
class GetShopCartBatchPromotionRestrictReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 用户机器码(版本>=0)
	private $source;	//<std::string> 请求来源(版本>=0)
	private $sceneId;	//<uint32_t> 场景id(版本>=0)
	private $uin;	//<uint64_t> 用户Id(版本>=0)
	private $restrictParamListIn;	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> > 详细业务参数队列(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->uin = 0;	//<uint64_t>
		$this->restrictParamListIn = new \stl_vector2('\icson\promotionrestrict\bo\PromotionRestrictParamInfo_Bo');	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> >
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				$this->initClass($name,$val,$this->$name);
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
			exit("GetShopCartBatchPromotionRestrictReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetShopCartBatchPromotionRestrict\\{$name}：请直接赋值为数组，无需new ***。");
		$base=array('bool','byte','uint8_t','int8_t','uint16_t','int16_t','uint32_t','int32_t','uint64_t','int64_t','long','int','string','stl_string');
		if(strpos(get_class($obj), 'stl_')===0){			
			$class=$obj->element_type;
			$arr = array();	
			if(in_array($class, $base)){
				$arr=$val;
			}else if(strpos($class,'stl_')===0){
				$cls=explode("<", $class);
				$cls="\\".trim($cls[0])."2";
				$start=strpos($obj->element_type,'<')+1;
				$end= strrpos($obj->element_type,'>');
				$parm= trim(substr($obj->element_type, $start,$end-$start));
				foreach($val as $k => $v){					
					$arr[$k]=new $cls($parm);
					$this->initClass($name.'\\'.$k,$v,$arr[$k]);
				}		
			}else{
				foreach ($val as $key => $value) {
					$arr[$key]=new $class();
					foreach($value as $k => $v){
						if(is_object($arr[$key]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$key]->$k);
						}else{
							$arr[$key]->$k=$v;
						}
					}	
				}					
			}
			$obj->setValue($arr);				
		}else{
			foreach($val as $k => $v){
				if(is_object($obj->$k)){
					$this->initClass($name.'\\'.$k,$v,$obj->$k);
				}else{
					$obj->$k=$v;
				}	
			}
		}	
	}
	
	function getRouteKey(){
		if($this->_routeKey){
			return $this->{$this->_routeKey};
		}
		
		return null;
	}
	
	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 用户机器码
		$bs->pushString($this->source);	//<std::string> 请求来源
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id
		$bs->pushUint64_t($this->uin);	//<uint64_t> 用户Id
		$bs->pushObject($this->restrictParamListIn,'stl_vector');	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> > 详细业务参数队列

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x9A101803;
	}
}

class GetShopCartBatchPromotionRestrictResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $restrictParamListOut;	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> > 详细业务参数队列(版本>=0)
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $outReserve;	//<std::string>  保留输出参数,未使用 (版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			if(array_key_exists('errMsg', $this->_arr_value)){
				$name='errMsg';
			}else{
				return "errmsg is not define.";
			}
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['restrictParamListOut'] = $bs->popObject('stl_vector<\icson\promotionrestrict\bo\PromotionRestrictParamInfo_Bo>');	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> > 详细业务参数队列
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string>  保留输出参数,未使用 

	}

	function getCmdId() {
		return 0x9A108803;
	}
}

namespace icson\promotionrestrict\ao\promotionrestrict;
class GetSingleRulePromotionRestrictReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 用户机器码(版本>=0)
	private $source;	//<std::string> 请求来源(版本>=0)
	private $sceneId;	//<uint32_t> 场景id(版本>=0)
	private $uin;	//<uint64_t> 用户Id(版本>=0)
	private $restrictParamListIn;	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> > 详细业务参数队列(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->uin = 0;	//<uint64_t>
		$this->restrictParamListIn = new \stl_vector2('\icson\promotionrestrict\bo\PromotionRestrictParamInfo_Bo');	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> >
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				$this->initClass($name,$val,$this->$name);
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
			exit("GetSingleRulePromotionRestrictReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetSingleRulePromotionRestrict\\{$name}：请直接赋值为数组，无需new ***。");
		$base=array('bool','byte','uint8_t','int8_t','uint16_t','int16_t','uint32_t','int32_t','uint64_t','int64_t','long','int','string','stl_string');
		if(strpos(get_class($obj), 'stl_')===0){			
			$class=$obj->element_type;
			$arr = array();	
			if(in_array($class, $base)){
				$arr=$val;
			}else if(strpos($class,'stl_')===0){
				$cls=explode("<", $class);
				$cls="\\".trim($cls[0])."2";
				$start=strpos($obj->element_type,'<')+1;
				$end= strrpos($obj->element_type,'>');
				$parm= trim(substr($obj->element_type, $start,$end-$start));
				foreach($val as $k => $v){					
					$arr[$k]=new $cls($parm);
					$this->initClass($name.'\\'.$k,$v,$arr[$k]);
				}		
			}else{
				foreach ($val as $key => $value) {
					$arr[$key]=new $class();
					foreach($value as $k => $v){
						if(is_object($arr[$key]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$key]->$k);
						}else{
							$arr[$key]->$k=$v;
						}
					}	
				}					
			}
			$obj->setValue($arr);				
		}else{
			foreach($val as $k => $v){
				if(is_object($obj->$k)){
					$this->initClass($name.'\\'.$k,$v,$obj->$k);
				}else{
					$obj->$k=$v;
				}	
			}
		}	
	}
	
	function getRouteKey(){
		if($this->_routeKey){
			return $this->{$this->_routeKey};
		}
		
		return null;
	}
	
	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 用户机器码
		$bs->pushString($this->source);	//<std::string> 请求来源
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id
		$bs->pushUint64_t($this->uin);	//<uint64_t> 用户Id
		$bs->pushObject($this->restrictParamListIn,'stl_vector');	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> > 详细业务参数队列

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x9A101801;
	}
}

class GetSingleRulePromotionRestrictResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $restrictParamListOnt;	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> > 详细业务参数队列(版本>=0)
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $outReserve;	//<std::string>  保留输出参数,未使用 (版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			if(array_key_exists('errMsg', $this->_arr_value)){
				$name='errMsg';
			}else{
				return "errmsg is not define.";
			}
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['restrictParamListOnt'] = $bs->popObject('stl_vector<\icson\promotionrestrict\bo\PromotionRestrictParamInfo_Bo>');	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> > 详细业务参数队列
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string>  保留输出参数,未使用 

	}

	function getCmdId() {
		return 0x9A108801;
	}
}

namespace icson\promotionrestrict\ao\promotionrestrict;
class RollbackDealBatchPromotionRestrictReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 用户机器码(版本>=0)
	private $source;	//<std::string> 请求来源(版本>=0)
	private $sceneId;	//<uint32_t> 场景id(版本>=0)
	private $uin;	//<uint64_t> 用户Id(版本>=0)
	private $restrictParamListIn;	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> > 详细业务参数队列(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->uin = 0;	//<uint64_t>
		$this->restrictParamListIn = new \stl_vector2('\icson\promotionrestrict\bo\PromotionRestrictParamInfo_Bo');	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> >
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				$this->initClass($name,$val,$this->$name);
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
			exit("RollbackDealBatchPromotionRestrictReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("RollbackDealBatchPromotionRestrict\\{$name}：请直接赋值为数组，无需new ***。");
		$base=array('bool','byte','uint8_t','int8_t','uint16_t','int16_t','uint32_t','int32_t','uint64_t','int64_t','long','int','string','stl_string');
		if(strpos(get_class($obj), 'stl_')===0){			
			$class=$obj->element_type;
			$arr = array();	
			if(in_array($class, $base)){
				$arr=$val;
			}else if(strpos($class,'stl_')===0){
				$cls=explode("<", $class);
				$cls="\\".trim($cls[0])."2";
				$start=strpos($obj->element_type,'<')+1;
				$end= strrpos($obj->element_type,'>');
				$parm= trim(substr($obj->element_type, $start,$end-$start));
				foreach($val as $k => $v){					
					$arr[$k]=new $cls($parm);
					$this->initClass($name.'\\'.$k,$v,$arr[$k]);
				}		
			}else{
				foreach ($val as $key => $value) {
					$arr[$key]=new $class();
					foreach($value as $k => $v){
						if(is_object($arr[$key]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$key]->$k);
						}else{
							$arr[$key]->$k=$v;
						}
					}	
				}					
			}
			$obj->setValue($arr);				
		}else{
			foreach($val as $k => $v){
				if(is_object($obj->$k)){
					$this->initClass($name.'\\'.$k,$v,$obj->$k);
				}else{
					$obj->$k=$v;
				}	
			}
		}	
	}
	
	function getRouteKey(){
		if($this->_routeKey){
			return $this->{$this->_routeKey};
		}
		
		return null;
	}
	
	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 用户机器码
		$bs->pushString($this->source);	//<std::string> 请求来源
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id
		$bs->pushUint64_t($this->uin);	//<uint64_t> 用户Id
		$bs->pushObject($this->restrictParamListIn,'stl_vector');	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> > 详细业务参数队列

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x9A101804;
	}
}

class RollbackDealBatchPromotionRestrictResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $restrictParamListOut;	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> > 详细业务参数队列(版本>=0)
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $outReserve;	//<std::string>  保留输出参数,未使用 (版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			if(array_key_exists('errMsg', $this->_arr_value)){
				$name='errMsg';
			}else{
				return "errmsg is not define.";
			}
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['restrictParamListOut'] = $bs->popObject('stl_vector<\icson\promotionrestrict\bo\PromotionRestrictParamInfo_Bo>');	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> > 详细业务参数队列
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string>  保留输出参数,未使用 

	}

	function getCmdId() {
		return 0x9A108804;
	}
}
