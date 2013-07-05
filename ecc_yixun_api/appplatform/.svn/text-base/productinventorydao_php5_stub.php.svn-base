<?php
// source idl: com.icson.deal.idl.ProductInventoryDao.java
namespace icson;
require_once "productinventorydao_php5_xxoo.php";

namespace icson\deal\dao\productinventory;
class GetDCByDistrictAndSiteReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $districtId;	//<uint32_t> 三级地址id(版本>=0)
	private $siteId;	//<uint32_t> 分站id(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->districtId = 0;	//<uint32_t>
		$this->siteId = 0;	//<uint32_t>
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
			exit("GetDCByDistrictAndSiteReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetDCByDistrictAndSite\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->source);	//<std::string> 请求来源
		$bs->pushUint32_t($this->districtId);	//<uint32_t> 三级地址id
		$bs->pushUint32_t($this->siteId);	//<uint32_t> 分站id

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91131005;
	}
}

class GetDCByDistrictAndSiteResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dcId;	//<std::string> dcid(配送中心)(版本>=0)
	private $errMsg;	//<std::string> 错误消息(版本>=0)

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
		$this->_arr_value['dcId'] = $bs->popString();	//<std::string> dcid(配送中心)
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string> 错误消息

	}

	function getCmdId() {
		return 0x91138005;
	}
}

namespace icson\deal\dao\productinventory;
class GetInventeoryInfoReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $inventoryParam;	//<icson::deal::bo::CInventoryParam> 请求参数(版本>=0)
	private $reserveIn;	//<std::string> 保留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->inventoryParam = new \icson\deal\bo\InventoryParam();	//<icson::deal::bo::CInventoryParam>
		$this->reserveIn = "";	//<std::string>
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
			exit("GetInventeoryInfoReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetInventeoryInfo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->source);	//<std::string> 请求来源
		$bs->pushObject($this->inventoryParam,'\icson\deal\bo\InventoryParam');	//<icson::deal::bo::CInventoryParam> 请求参数
		$bs->pushString($this->reserveIn);	//<std::string> 保留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91131001;
	}
}

class GetInventeoryInfoResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dcId;	//<std::string> DC id(版本>=0)
	private $inventoryInfoList;	//<std::map<uint32_t,icson::deal::bo::CInventoryInfo> > 库存信息(版本>=0)
	private $errMsg;	//<std::string> 错误消息(版本>=0)
	private $reserveOut;	//<std::string> 保留参数(版本>=0)

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
		$this->_arr_value['dcId'] = $bs->popString();	//<std::string> DC id
		$this->_arr_value['inventoryInfoList'] = $bs->popObject('stl_map<uint32_t,\icson\deal\bo\InventoryInfo>');	//<std::map<uint32_t,icson::deal::bo::CInventoryInfo> > 库存信息
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string> 错误消息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 保留参数

	}

	function getCmdId() {
		return 0x91138001;
	}
}

namespace icson\deal\dao\productinventory;
class GetInventeoryInfo4AppReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $inventoryParam;	//<icson::deal::bo::CInventoryParam> 请求参数(版本>=0)
	private $reserveIn;	//<std::string> 保留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->inventoryParam = new \icson\deal\bo\InventoryParam();	//<icson::deal::bo::CInventoryParam>
		$this->reserveIn = "";	//<std::string>
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
			exit("GetInventeoryInfo4AppReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetInventeoryInfo4App\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->source);	//<std::string> 请求来源
		$bs->pushObject($this->inventoryParam,'\icson\deal\bo\InventoryParam');	//<icson::deal::bo::CInventoryParam> 请求参数
		$bs->pushString($this->reserveIn);	//<std::string> 保留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91131008;
	}
}

class GetInventeoryInfo4AppResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dcId;	//<std::string> DC id(版本>=0)
	private $inventoryInfoList;	//<std::map<uint32_t,icson::deal::bo::CInventoryInfo> > 库存信息(版本>=0)
	private $errMsg;	//<std::string> 错误消息(版本>=0)
	private $reserveOut;	//<std::string> 保留参数(版本>=0)

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
		$this->_arr_value['dcId'] = $bs->popString();	//<std::string> DC id
		$this->_arr_value['inventoryInfoList'] = $bs->popObject('stl_map<uint32_t,\icson\deal\bo\InventoryInfo>');	//<std::map<uint32_t,icson::deal::bo::CInventoryInfo> > 库存信息
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string> 错误消息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 保留参数

	}

	function getCmdId() {
		return 0x91138008;
	}
}

namespace icson\deal\dao\productinventory;
class GetInventeoryInfo4BuyReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $inventoryParam;	//<icson::deal::bo::CInventoryParam> 请求参数(版本>=0)
	private $reserveIn;	//<std::string> 保留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->inventoryParam = new \icson\deal\bo\InventoryParam();	//<icson::deal::bo::CInventoryParam>
		$this->reserveIn = "";	//<std::string>
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
			exit("GetInventeoryInfo4BuyReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetInventeoryInfo4Buy\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->source);	//<std::string> 请求来源
		$bs->pushObject($this->inventoryParam,'\icson\deal\bo\InventoryParam');	//<icson::deal::bo::CInventoryParam> 请求参数
		$bs->pushString($this->reserveIn);	//<std::string> 保留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91131007;
	}
}

class GetInventeoryInfo4BuyResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dcId;	//<std::string> DC id(版本>=0)
	private $inventoryInfoList;	//<std::map<uint32_t,icson::deal::bo::CInventoryInfo> > 库存信息(版本>=0)
	private $errMsg;	//<std::string> 错误消息(版本>=0)
	private $reserveOut;	//<std::string> 保留参数(版本>=0)

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
		$this->_arr_value['dcId'] = $bs->popString();	//<std::string> DC id
		$this->_arr_value['inventoryInfoList'] = $bs->popObject('stl_map<uint32_t,\icson\deal\bo\InventoryInfo>');	//<std::map<uint32_t,icson::deal::bo::CInventoryInfo> > 库存信息
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string> 错误消息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 保留参数

	}

	function getCmdId() {
		return 0x91138007;
	}
}

namespace icson\deal\dao\productinventory;
class GetInventeoryInfo4OtherReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $inventoryParam;	//<icson::deal::bo::CInventoryParam> 请求参数(版本>=0)
	private $reserveIn;	//<std::string> 保留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->inventoryParam = new \icson\deal\bo\InventoryParam();	//<icson::deal::bo::CInventoryParam>
		$this->reserveIn = "";	//<std::string>
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
			exit("GetInventeoryInfo4OtherReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetInventeoryInfo4Other\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->source);	//<std::string> 请求来源
		$bs->pushObject($this->inventoryParam,'\icson\deal\bo\InventoryParam');	//<icson::deal::bo::CInventoryParam> 请求参数
		$bs->pushString($this->reserveIn);	//<std::string> 保留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91131009;
	}
}

class GetInventeoryInfo4OtherResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dcId;	//<std::string> DC id(版本>=0)
	private $inventoryInfoList;	//<std::map<uint32_t,icson::deal::bo::CInventoryInfo> > 库存信息(版本>=0)
	private $errMsg;	//<std::string> 错误消息(版本>=0)
	private $reserveOut;	//<std::string> 保留参数(版本>=0)

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
		$this->_arr_value['dcId'] = $bs->popString();	//<std::string> DC id
		$this->_arr_value['inventoryInfoList'] = $bs->popObject('stl_map<uint32_t,\icson\deal\bo\InventoryInfo>');	//<std::map<uint32_t,icson::deal::bo::CInventoryInfo> > 库存信息
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string> 错误消息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 保留参数

	}

	function getCmdId() {
		return 0x91138009;
	}
}

namespace icson\deal\dao\productinventory;
class GetInventeoryInfo4SearchReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $inventoryParam;	//<icson::deal::bo::CInventoryParam> 请求参数(版本>=0)
	private $reserveIn;	//<std::string> 保留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->inventoryParam = new \icson\deal\bo\InventoryParam();	//<icson::deal::bo::CInventoryParam>
		$this->reserveIn = "";	//<std::string>
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
			exit("GetInventeoryInfo4SearchReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetInventeoryInfo4Search\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->source);	//<std::string> 请求来源
		$bs->pushObject($this->inventoryParam,'\icson\deal\bo\InventoryParam');	//<icson::deal::bo::CInventoryParam> 请求参数
		$bs->pushString($this->reserveIn);	//<std::string> 保留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91131006;
	}
}

class GetInventeoryInfo4SearchResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dcId;	//<std::string> DC id(版本>=0)
	private $inventoryInfoList;	//<std::map<uint32_t,icson::deal::bo::CInventoryInfo> > 库存信息(版本>=0)
	private $errMsg;	//<std::string> 错误消息(版本>=0)
	private $reserveOut;	//<std::string> 保留参数(版本>=0)

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
		$this->_arr_value['dcId'] = $bs->popString();	//<std::string> DC id
		$this->_arr_value['inventoryInfoList'] = $bs->popObject('stl_map<uint32_t,\icson\deal\bo\InventoryInfo>');	//<std::map<uint32_t,icson::deal::bo::CInventoryInfo> > 库存信息
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string> 错误消息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 保留参数

	}

	function getCmdId() {
		return 0x91138006;
	}
}

namespace icson\deal\dao\productinventory;
class GetInventeoryInfoByStockIdReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $inventoryParam;	//<icson::deal::bo::CInventoryParam> 请求参数(版本>=0)
	private $reserveIn;	//<std::string> 保留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->inventoryParam = new \icson\deal\bo\InventoryParam();	//<icson::deal::bo::CInventoryParam>
		$this->reserveIn = "";	//<std::string>
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
			exit("GetInventeoryInfoByStockIdReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetInventeoryInfoByStockId\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->source);	//<std::string> 请求来源
		$bs->pushObject($this->inventoryParam,'\icson\deal\bo\InventoryParam');	//<icson::deal::bo::CInventoryParam> 请求参数
		$bs->pushString($this->reserveIn);	//<std::string> 保留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91131002;
	}
}

class GetInventeoryInfoByStockIdResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $inventoryInfoList;	//<std::map<uint32_t,icson::deal::bo::CInventoryInfo> > 库存信息(版本>=0)
	private $errMsg;	//<std::string> 错误消息(版本>=0)
	private $reserveOut;	//<std::string> 保留参数(版本>=0)

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
		$this->_arr_value['inventoryInfoList'] = $bs->popObject('stl_map<uint32_t,\icson\deal\bo\InventoryInfo>');	//<std::map<uint32_t,icson::deal::bo::CInventoryInfo> > 库存信息
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string> 错误消息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 保留参数

	}

	function getCmdId() {
		return 0x91138002;
	}
}

namespace icson\deal\dao\productinventory;
class GetProductInfoReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $productParam;	//<icson::deal::bo::CProductParam> 请求参数(版本>=0)
	private $reserveIn;	//<std::string> 保留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->productParam = new \icson\deal\bo\ProductParam();	//<icson::deal::bo::CProductParam>
		$this->reserveIn = "";	//<std::string>
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
			exit("GetProductInfoReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetProductInfo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->source);	//<std::string> 请求来源
		$bs->pushObject($this->productParam,'\icson\deal\bo\ProductParam');	//<icson::deal::bo::CProductParam> 请求参数
		$bs->pushString($this->reserveIn);	//<std::string> 保留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91131003;
	}
}

class GetProductInfoResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $productInfoList;	//<std::map<uint32_t,icson::deal::bo::CProductInfo> > 商品信息(版本>=0)
	private $errMsg;	//<std::string> 错误消息(版本>=0)
	private $reserveOut;	//<std::string> 保留参数(版本>=0)

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
		$this->_arr_value['productInfoList'] = $bs->popObject('stl_map<uint32_t,\icson\deal\bo\ProductInfo>');	//<std::map<uint32_t,icson::deal::bo::CProductInfo> > 商品信息
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string> 错误消息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 保留参数

	}

	function getCmdId() {
		return 0x91138003;
	}
}

namespace icson\deal\dao\productinventory;
class GetSiteByStockReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $stockId;	//<std::vector<uint32_t> > 物理仓id列表(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->stockId = new \stl_vector2('uint32_t');	//<std::vector<uint32_t> >
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
			exit("GetSiteByStockReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetSiteByStock\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->source);	//<std::string> 请求来源
		$bs->pushObject($this->stockId,'stl_vector');	//<std::vector<uint32_t> > 物理仓id列表

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91131004;
	}
}

class GetSiteByStockResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $stockToSite;	//<std::map<uint32_t,uint32_t> > 物理仓id与分站id对应的map(版本>=0)
	private $errMsg;	//<std::string> 错误消息(版本>=0)

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
		$this->_arr_value['stockToSite'] = $bs->popObject('stl_map<uint32_t,uint32_t>');	//<std::map<uint32_t,uint32_t> > 物理仓id与分站id对应的map
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string> 错误消息

	}

	function getCmdId() {
		return 0x91138004;
	}
}
