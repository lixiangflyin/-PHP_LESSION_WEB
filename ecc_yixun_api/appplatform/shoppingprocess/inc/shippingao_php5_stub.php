<?php
// source idl: com.icson.deal.idl.ShippingAo.java
namespace icson;
require_once "shippingao_php5_xxoo.php";

namespace icson\deal\ao\shipping;
class getPackagesReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $productList;	//<std::map<uint32_t,icson::deal::bo::CShippingParam> > 商品信息 <productId, ShippingParam>(版本>=0)
	private $whId;	//<uint32_t> 分站ID(版本>=0)
	private $destination;	//<uint32_t> 目的区域ID(版本>=0)
	private $dc;	//<std::string> 目的地DC(版本>=0)
	private $extIn;	//<std::map<std::string,std::string> > 请求保留字，拓展用，选填 (版本>=0)
	private $sceneId;	//<uint32_t> 场景ID(版本>=0)
	private $source;	//<std::string> 来源，客户端IP(版本>=0)
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $reserveIn;	//<std::string> 保留输入(版本>=0)

	function __construct() {
		$this->productList = new \stl_map2('uint32_t,\icson\deal\bo\ShippingParam');	//<std::map<uint32_t,icson::deal::bo::CShippingParam> >
		$this->whId = 0;	//<uint32_t>
		$this->destination = 0;	//<uint32_t>
		$this->dc = "";	//<std::string>
		$this->extIn = new \stl_map2('stl_string,stl_string');	//<std::map<std::string,std::string> >
		$this->sceneId = 0;	//<uint32_t>
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
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
			exit("getPackagesReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("getPackages\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushObject($this->productList,'stl_map');	//<std::map<uint32_t,icson::deal::bo::CShippingParam> > 商品信息 <productId, ShippingParam>
		$bs->pushUint32_t($this->whId);	//<uint32_t> 分站ID
		$bs->pushUint32_t($this->destination);	//<uint32_t> 目的区域ID
		$bs->pushString($this->dc);	//<std::string> 目的地DC
		$bs->pushObject($this->extIn,'stl_map');	//<std::map<std::string,std::string> > 请求保留字，拓展用，选填 
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景ID
		$bs->pushString($this->source);	//<std::string> 来源，客户端IP
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->reserveIn);	//<std::string> 保留输入

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91151006;
	}
}

class getPackagesResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $packages;	//<std::map<std::string,icson::deal::bo::CShippingPackageInfo> > <packageId, ShippingPackageInfo>(版本>=0)
	private $extOut;	//<std::map<std::string,std::string> > 返回保留字(版本>=0)
	private $errMsg;	//<std::string> 错误消息(版本>=0)
	private $reserveOut;	//<std::string> 保留输出(版本>=0)

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
		$this->_arr_value['packages'] = $bs->popObject('stl_map<stl_string,\icson\deal\bo\ShippingPackageInfo>');	//<std::map<std::string,icson::deal::bo::CShippingPackageInfo> > <packageId, ShippingPackageInfo>
		$this->_arr_value['extOut'] = $bs->popObject('stl_map<stl_string,stl_string>');	//<std::map<std::string,std::string> > 返回保留字
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string> 错误消息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 保留输出

	}

	function getCmdId() {
		return 0x91158006;
	}
}

namespace icson\deal\ao\shipping;
class getShippingInfo4CartReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $shippingParamList;	//<std::map<uint32_t,icson::deal::bo::CShippingSmallParam> > 商品信息 <productId, ShippingSmallParam>(版本>=0)
	private $whId;	//<uint32_t> 分站ID(版本>=0)
	private $destination;	//<uint32_t> 目的区域ID(版本>=0)
	private $dc;	//<std::string> 目的地DC(版本>=0)
	private $extIn;	//<std::map<std::string,std::string> > 请求保留字，拓展用，选填 (版本>=0)
	private $sceneId;	//<uint32_t> 场景ID(版本>=0)
	private $source;	//<std::string> 来源，客户端IP(版本>=0)
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $reserveIn;	//<std::string> 保留输入(版本>=0)

	function __construct() {
		$this->shippingParamList = new \stl_map2('uint32_t,\icson\deal\bo\ShippingSmallParam');	//<std::map<uint32_t,icson::deal::bo::CShippingSmallParam> >
		$this->whId = 0;	//<uint32_t>
		$this->destination = 0;	//<uint32_t>
		$this->dc = "";	//<std::string>
		$this->extIn = new \stl_map2('stl_string,stl_string');	//<std::map<std::string,std::string> >
		$this->sceneId = 0;	//<uint32_t>
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
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
			exit("getShippingInfo4CartReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("getShippingInfo4Cart\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushObject($this->shippingParamList,'stl_map');	//<std::map<uint32_t,icson::deal::bo::CShippingSmallParam> > 商品信息 <productId, ShippingSmallParam>
		$bs->pushUint32_t($this->whId);	//<uint32_t> 分站ID
		$bs->pushUint32_t($this->destination);	//<uint32_t> 目的区域ID
		$bs->pushString($this->dc);	//<std::string> 目的地DC
		$bs->pushObject($this->extIn,'stl_map');	//<std::map<std::string,std::string> > 请求保留字，拓展用，选填 
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景ID
		$bs->pushString($this->source);	//<std::string> 来源，客户端IP
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->reserveIn);	//<std::string> 保留输入

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91151002;
	}
}

class getShippingInfo4CartResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $baseShippingInfoList;	//<std::map<uint32_t,icson::deal::bo::CBaseShippingInfo> > <productId, BaseShippingInfo>(版本>=0)
	private $extOut;	//<std::map<std::string,std::string> > 返回保留字(版本>=0)
	private $errMsg;	//<std::string> 错误消息(版本>=0)
	private $reserveOut;	//<std::string> 保留输出(版本>=0)

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
		$this->_arr_value['baseShippingInfoList'] = $bs->popObject('stl_map<uint32_t,\icson\deal\bo\BaseShippingInfo>');	//<std::map<uint32_t,icson::deal::bo::CBaseShippingInfo> > <productId, BaseShippingInfo>
		$this->_arr_value['extOut'] = $bs->popObject('stl_map<stl_string,stl_string>');	//<std::map<std::string,std::string> > 返回保留字
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string> 错误消息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 保留输出

	}

	function getCmdId() {
		return 0x91158002;
	}
}

namespace icson\deal\ao\shipping;
class getShippingInfo4ItemReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $shippingParamList;	//<std::map<uint32_t,icson::deal::bo::CShippingSmallParam> > 商品信息 <productId, ShippingSmallParam>(版本>=0)
	private $whId;	//<uint32_t> 分站ID(版本>=0)
	private $destination;	//<uint32_t> 目的区域ID(版本>=0)
	private $dc;	//<std::string> 目的地DC(版本>=0)
	private $extIn;	//<std::map<std::string,std::string> > 请求保留字，拓展用，选填 (版本>=0)
	private $sceneId;	//<uint32_t> 场景ID(版本>=0)
	private $source;	//<std::string> 来源，客户端IP(版本>=0)
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $reserveIn;	//<std::string> 保留输入(版本>=0)

	function __construct() {
		$this->shippingParamList = new \stl_map2('uint32_t,\icson\deal\bo\ShippingSmallParam');	//<std::map<uint32_t,icson::deal::bo::CShippingSmallParam> >
		$this->whId = 0;	//<uint32_t>
		$this->destination = 0;	//<uint32_t>
		$this->dc = "";	//<std::string>
		$this->extIn = new \stl_map2('stl_string,stl_string');	//<std::map<std::string,std::string> >
		$this->sceneId = 0;	//<uint32_t>
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
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
			exit("getShippingInfo4ItemReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("getShippingInfo4Item\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushObject($this->shippingParamList,'stl_map');	//<std::map<uint32_t,icson::deal::bo::CShippingSmallParam> > 商品信息 <productId, ShippingSmallParam>
		$bs->pushUint32_t($this->whId);	//<uint32_t> 分站ID
		$bs->pushUint32_t($this->destination);	//<uint32_t> 目的区域ID
		$bs->pushString($this->dc);	//<std::string> 目的地DC
		$bs->pushObject($this->extIn,'stl_map');	//<std::map<std::string,std::string> > 请求保留字，拓展用，选填 
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景ID
		$bs->pushString($this->source);	//<std::string> 来源，客户端IP
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->reserveIn);	//<std::string> 保留输入

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91151001;
	}
}

class getShippingInfo4ItemResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $baseShippingInfoList;	//<std::map<uint32_t,icson::deal::bo::CBaseShippingInfo> > <productId, BaseShippingInfo>(版本>=0)
	private $extOut;	//<std::map<std::string,std::string> > 返回保留字(版本>=0)
	private $errMsg;	//<std::string> 错误消息(版本>=0)
	private $reserveOut;	//<std::string> 保留输出(版本>=0)

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
		$this->_arr_value['baseShippingInfoList'] = $bs->popObject('stl_map<uint32_t,\icson\deal\bo\BaseShippingInfo>');	//<std::map<uint32_t,icson::deal::bo::CBaseShippingInfo> > <productId, BaseShippingInfo>
		$this->_arr_value['extOut'] = $bs->popObject('stl_map<stl_string,stl_string>');	//<std::map<std::string,std::string> > 返回保留字
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string> 错误消息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 保留输出

	}

	function getCmdId() {
		return 0x91158001;
	}
}

namespace icson\deal\ao\shipping;
class getShippingInfo4OrderReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $whId;	//<uint32_t> 分站ID(版本>=0)
	private $destination;	//<uint32_t> 目的区域ID(版本>=0)
	private $dc;	//<std::string> 目的地DC(版本>=0)
	private $userLevel;	//<uint32_t> 用户level(版本>=0)
	private $productList;	//<std::map<uint32_t,icson::deal::bo::CShippingParam> > <product_id, ShippingParam> 商品信息(版本>=0)
	private $couponPrice;	//<uint32_t> 使用优惠券后减免的金额(版本>=0)
	private $extIn;	//<std::map<std::string,std::string> > 请求保留字，拓展用，选填 (版本>=0)
	private $sceneId;	//<uint32_t> 场景ID(版本>=0)
	private $source;	//<std::string> 来源，客户端IP(版本>=0)
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $reserveIn;	//<std::string> 保留输入(版本>=0)

	function __construct() {
		$this->whId = 0;	//<uint32_t>
		$this->destination = 0;	//<uint32_t>
		$this->dc = "";	//<std::string>
		$this->userLevel = 0;	//<uint32_t>
		$this->productList = new \stl_map2('uint32_t,\icson\deal\bo\ShippingParam');	//<std::map<uint32_t,icson::deal::bo::CShippingParam> >
		$this->couponPrice = 0;	//<uint32_t>
		$this->extIn = new \stl_map2('stl_string,stl_string');	//<std::map<std::string,std::string> >
		$this->sceneId = 0;	//<uint32_t>
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
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
			exit("getShippingInfo4OrderReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("getShippingInfo4Order\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->whId);	//<uint32_t> 分站ID
		$bs->pushUint32_t($this->destination);	//<uint32_t> 目的区域ID
		$bs->pushString($this->dc);	//<std::string> 目的地DC
		$bs->pushUint32_t($this->userLevel);	//<uint32_t> 用户level
		$bs->pushObject($this->productList,'stl_map');	//<std::map<uint32_t,icson::deal::bo::CShippingParam> > <product_id, ShippingParam> 商品信息
		$bs->pushUint32_t($this->couponPrice);	//<uint32_t> 使用优惠券后减免的金额
		$bs->pushObject($this->extIn,'stl_map');	//<std::map<std::string,std::string> > 请求保留字，拓展用，选填 
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景ID
		$bs->pushString($this->source);	//<std::string> 来源，客户端IP
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->reserveIn);	//<std::string> 保留输入

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91151003;
	}
}

class getShippingInfo4OrderResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $orderShipping;	//<icson::deal::bo::COrderShippingInfo> 订单配送信息(版本>=0)
	private $extOut;	//<std::map<std::string,std::string> > 返回保留字(版本>=0)
	private $errMsg;	//<std::string> 错误消息(版本>=0)
	private $reserveOut;	//<std::string> 保留输出(版本>=0)

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
		$this->_arr_value['orderShipping'] = $bs->popObject('\icson\deal\bo\OrderShippingInfo');	//<icson::deal::bo::COrderShippingInfo> 订单配送信息
		$this->_arr_value['extOut'] = $bs->popObject('stl_map<stl_string,stl_string>');	//<std::map<std::string,std::string> > 返回保留字
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string> 错误消息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 保留输出

	}

	function getCmdId() {
		return 0x91158003;
	}
}

namespace icson\deal\ao\shipping;
class getShippingInfo4OtherReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $whId;	//<uint32_t> 分站ID(版本>=0)
	private $destination;	//<uint32_t> 目的区域ID(版本>=0)
	private $dc;	//<std::string> 目的地DC(版本>=0)
	private $userLevel;	//<uint32_t> 用户level(版本>=0)
	private $productList;	//<std::map<uint32_t,icson::deal::bo::CShippingParam> > <product_id, ShippingParam> 商品信息(版本>=0)
	private $couponPrice;	//<uint32_t> 使用优惠券后减免的金额(版本>=0)
	private $extIn;	//<std::map<std::string,std::string> > 请求保留字，拓展用，选填 (版本>=0)
	private $sceneId;	//<uint32_t> 场景ID(版本>=0)
	private $source;	//<std::string> 来源，客户端IP(版本>=0)
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $reserveIn;	//<std::string> 保留输入(版本>=0)

	function __construct() {
		$this->whId = 0;	//<uint32_t>
		$this->destination = 0;	//<uint32_t>
		$this->dc = "";	//<std::string>
		$this->userLevel = 0;	//<uint32_t>
		$this->productList = new \stl_map2('uint32_t,\icson\deal\bo\ShippingParam');	//<std::map<uint32_t,icson::deal::bo::CShippingParam> >
		$this->couponPrice = 0;	//<uint32_t>
		$this->extIn = new \stl_map2('stl_string,stl_string');	//<std::map<std::string,std::string> >
		$this->sceneId = 0;	//<uint32_t>
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
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
			exit("getShippingInfo4OtherReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("getShippingInfo4Other\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->whId);	//<uint32_t> 分站ID
		$bs->pushUint32_t($this->destination);	//<uint32_t> 目的区域ID
		$bs->pushString($this->dc);	//<std::string> 目的地DC
		$bs->pushUint32_t($this->userLevel);	//<uint32_t> 用户level
		$bs->pushObject($this->productList,'stl_map');	//<std::map<uint32_t,icson::deal::bo::CShippingParam> > <product_id, ShippingParam> 商品信息
		$bs->pushUint32_t($this->couponPrice);	//<uint32_t> 使用优惠券后减免的金额
		$bs->pushObject($this->extIn,'stl_map');	//<std::map<std::string,std::string> > 请求保留字，拓展用，选填 
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景ID
		$bs->pushString($this->source);	//<std::string> 来源，客户端IP
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->reserveIn);	//<std::string> 保留输入

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91151004;
	}
}

class getShippingInfo4OtherResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $orderShipping;	//<icson::deal::bo::COrderShippingInfo> 配送信息(版本>=0)
	private $extOut;	//<std::map<std::string,std::string> > 返回保留字(版本>=0)
	private $errMsg;	//<std::string> 错误消息(版本>=0)
	private $reserveOut;	//<std::string> 保留输出(版本>=0)

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
		$this->_arr_value['orderShipping'] = $bs->popObject('\icson\deal\bo\OrderShippingInfo');	//<icson::deal::bo::COrderShippingInfo> 配送信息
		$this->_arr_value['extOut'] = $bs->popObject('stl_map<stl_string,stl_string>');	//<std::map<std::string,std::string> > 返回保留字
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string> 错误消息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 保留输出

	}

	function getCmdId() {
		return 0x91158004;
	}
}

namespace icson\deal\ao\shipping;
class getShippingInfo4PlaceOrderReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $whId;	//<uint32_t> 分站ID(版本>=0)
	private $destination;	//<uint32_t> 目的区域ID(版本>=0)
	private $dc;	//<std::string> 目的地DC(版本>=0)
	private $userLevel;	//<uint32_t> 用户level(版本>=0)
	private $productList;	//<std::map<uint32_t,icson::deal::bo::CShippingParam> > <product_id, ShippingParam> 商品信息(版本>=0)
	private $orderPrice;	//<uint32_t> 订单的支付金额（除去优惠券的费用）(版本>=0)
	private $extIn;	//<std::map<std::string,std::string> > 请求保留字，拓展用，选填 (版本>=0)
	private $sceneId;	//<uint32_t> 场景ID(版本>=0)
	private $source;	//<std::string> 来源，客户端IP(版本>=0)
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $reserveIn;	//<std::string> 保留输入(版本>=0)

	function __construct() {
		$this->whId = 0;	//<uint32_t>
		$this->destination = 0;	//<uint32_t>
		$this->dc = "";	//<std::string>
		$this->userLevel = 0;	//<uint32_t>
		$this->productList = new \stl_map2('uint32_t,\icson\deal\bo\ShippingParam');	//<std::map<uint32_t,icson::deal::bo::CShippingParam> >
		$this->orderPrice = 0;	//<uint32_t>
		$this->extIn = new \stl_map2('stl_string,stl_string');	//<std::map<std::string,std::string> >
		$this->sceneId = 0;	//<uint32_t>
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
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
			exit("getShippingInfo4PlaceOrderReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("getShippingInfo4PlaceOrder\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->whId);	//<uint32_t> 分站ID
		$bs->pushUint32_t($this->destination);	//<uint32_t> 目的区域ID
		$bs->pushString($this->dc);	//<std::string> 目的地DC
		$bs->pushUint32_t($this->userLevel);	//<uint32_t> 用户level
		$bs->pushObject($this->productList,'stl_map');	//<std::map<uint32_t,icson::deal::bo::CShippingParam> > <product_id, ShippingParam> 商品信息
		$bs->pushUint32_t($this->orderPrice);	//<uint32_t> 订单的支付金额（除去优惠券的费用）
		$bs->pushObject($this->extIn,'stl_map');	//<std::map<std::string,std::string> > 请求保留字，拓展用，选填 
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景ID
		$bs->pushString($this->source);	//<std::string> 来源，客户端IP
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->reserveIn);	//<std::string> 保留输入

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91151005;
	}
}

class getShippingInfo4PlaceOrderResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $orderShipping;	//<icson::deal::bo::COrderShippingInfo> 配送信息(版本>=0)
	private $extOut;	//<std::map<std::string,std::string> > 返回保留字(版本>=0)
	private $errMsg;	//<std::string> 错误消息(版本>=0)
	private $reserveOut;	//<std::string> 保留输出(版本>=0)

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
		$this->_arr_value['orderShipping'] = $bs->popObject('\icson\deal\bo\OrderShippingInfo');	//<icson::deal::bo::COrderShippingInfo> 配送信息
		$this->_arr_value['extOut'] = $bs->popObject('stl_map<stl_string,stl_string>');	//<std::map<std::string,std::string> > 返回保留字
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string> 错误消息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 保留输出

	}

	function getCmdId() {
		return 0x91158005;
	}
}

namespace icson\deal\ao\shipping;
class getShippingOrsOrdersReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $whId;	//<uint32_t> 分站ID(版本>=0)
	private $destination;	//<uint32_t> 目的区域ID(版本>=0)
	private $dc;	//<std::string> 目的地DC(版本>=0)
	private $userLevel;	//<uint32_t> 用户level(版本>=0)
	private $userId;	//<uint32_t> 用户ID(版本>=0)
	private $productList;	//<std::map<uint32_t,icson::deal::bo::CShippingParam> > <product_id, ShippingParam> 商品信息(版本>=0)
	private $couponPrice;	//<uint32_t> 使用优惠券后减免的金额, 订单确认页该值传入为0, 在生成订单时应该传入订单金额. (版本>=0)
	private $extIn;	//<std::map<std::string,std::string> > 请求保留字，拓展用，选填 (版本>=0)
	private $sceneId;	//<uint32_t> 场景ID(版本>=0)
	private $source;	//<std::string> 来源，客户端IP(版本>=0)
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $reserveIn;	//<std::string> 保留输入(版本>=0)

	function __construct() {
		$this->whId = 0;	//<uint32_t>
		$this->destination = 0;	//<uint32_t>
		$this->dc = "";	//<std::string>
		$this->userLevel = 0;	//<uint32_t>
		$this->userId = 0;	//<uint32_t>
		$this->productList = new \stl_map2('uint32_t,\icson\deal\bo\ShippingParam');	//<std::map<uint32_t,icson::deal::bo::CShippingParam> >
		$this->couponPrice = 0;	//<uint32_t>
		$this->extIn = new \stl_map2('stl_string,stl_string');	//<std::map<std::string,std::string> >
		$this->sceneId = 0;	//<uint32_t>
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
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
			exit("getShippingOrsOrdersReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("getShippingOrsOrders\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->whId);	//<uint32_t> 分站ID
		$bs->pushUint32_t($this->destination);	//<uint32_t> 目的区域ID
		$bs->pushString($this->dc);	//<std::string> 目的地DC
		$bs->pushUint32_t($this->userLevel);	//<uint32_t> 用户level
		$bs->pushUint32_t($this->userId);	//<uint32_t> 用户ID
		$bs->pushObject($this->productList,'stl_map');	//<std::map<uint32_t,icson::deal::bo::CShippingParam> > <product_id, ShippingParam> 商品信息
		$bs->pushUint32_t($this->couponPrice);	//<uint32_t> 使用优惠券后减免的金额, 订单确认页该值传入为0, 在生成订单时应该传入订单金额. 
		$bs->pushObject($this->extIn,'stl_map');	//<std::map<std::string,std::string> > 请求保留字，拓展用，选填 
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景ID
		$bs->pushString($this->source);	//<std::string> 来源，客户端IP
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->reserveIn);	//<std::string> 保留输入

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91151007;
	}
}

class getShippingOrsOrdersResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $orderShipping;	//<std::map<std::string,icson::deal::bo::COrderShippingInfo> > 订单配送信息(版本>=0)
	private $extOut;	//<std::map<std::string,std::string> > 返回保留字(版本>=0)
	private $errMsg;	//<std::string> 错误消息(版本>=0)
	private $reserveOut;	//<std::string> 保留输出(版本>=0)

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
		$this->_arr_value['orderShipping'] = $bs->popObject('stl_map<stl_string,\icson\deal\bo\OrderShippingInfo>');	//<std::map<std::string,icson::deal::bo::COrderShippingInfo> > 订单配送信息
		$this->_arr_value['extOut'] = $bs->popObject('stl_map<stl_string,stl_string>');	//<std::map<std::string,std::string> > 返回保留字
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string> 错误消息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 保留输出

	}

	function getCmdId() {
		return 0x91158007;
	}
}
