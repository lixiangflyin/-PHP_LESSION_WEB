<?php
// source idl: com.icson.deal.idl.PayTypeAo.java
namespace icson;
require_once "paytypeao_php5_xxoo.php";

namespace icson\deal\ao\paytype;
class GetAllPayTypeInfoReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $payTypeParam;	//<icson::deal::bo::CPayTypeParam> 请求参数(版本>=0)
	private $reserveIn;	//<std::string> 保留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->payTypeParam = new \icson\deal\bo\PayTypeParam();	//<icson::deal::bo::CPayTypeParam>
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
			exit("GetAllPayTypeInfoReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetAllPayTypeInfo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushObject($this->payTypeParam,'\icson\deal\bo\PayTypeParam');	//<icson::deal::bo::CPayTypeParam> 请求参数
		$bs->pushString($this->reserveIn);	//<std::string> 保留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x890b1001;
	}
}

class GetAllPayTypeInfoResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $payTypeInfo;	//<icson::deal::bo::CPayTypeInfo> 支付方式信息(版本>=0)
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
		$this->_arr_value['payTypeInfo'] = $bs->popObject('\icson\deal\bo\PayTypeInfo');	//<icson::deal::bo::CPayTypeInfo> 支付方式信息
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string> 错误消息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 保留参数

	}

	function getCmdId() {
		return 0x890b8001;
	}
}

namespace icson\deal\ao\paytype;
class GetPayTypeInfoReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $payTypeParam;	//<icson::deal::bo::CPayTypeParam> 请求参数(版本>=0)
	private $reserveIn;	//<std::string> 保留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->payTypeParam = new \icson\deal\bo\PayTypeParam();	//<icson::deal::bo::CPayTypeParam>
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
			exit("GetPayTypeInfoReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetPayTypeInfo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushObject($this->payTypeParam,'\icson\deal\bo\PayTypeParam');	//<icson::deal::bo::CPayTypeParam> 请求参数
		$bs->pushString($this->reserveIn);	//<std::string> 保留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x890b1002;
	}
}

class GetPayTypeInfoResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $payTypeInfo;	//<icson::deal::bo::CPayTypeInfo> 支付方式信息(版本>=0)
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
		$this->_arr_value['payTypeInfo'] = $bs->popObject('\icson\deal\bo\PayTypeInfo');	//<icson::deal::bo::CPayTypeInfo> 支付方式信息
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string> 错误消息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 保留参数

	}

	function getCmdId() {
		return 0x890b8002;
	}
}
