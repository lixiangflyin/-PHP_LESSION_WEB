<?php
// source idl: com.b2b2c.touch.idl.TouchDao.java
namespace b2b2c;
require_once "touchdao_php5_xxoo.php";

namespace b2b2c\touch\dao;
class DeleteDealNoPayReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $scene;	//<uint32_t> 请求来源场景(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $record;	//<b2b2c::touch::ddo::CTouchDealNoPayDo> 消息记录(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->scene = 0;	//<uint32_t>
		$this->machineKey = "";	//<std::string>
		$this->record = new \b2b2c\touch\ddo\TouchDealNoPayDo();	//<b2b2c::touch::ddo::CTouchDealNoPayDo>
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
			exit("DeleteDealNoPayReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("DeleteDealNoPayReq\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();	
			if(class_exists($class,false)){						
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}	
				}
			}else{
				$arr=$val;
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
		$bs->pushUint32_t($this->scene);	//<uint32_t> 请求来源场景
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushObject($this->record,'\b2b2c\touch\ddo\TouchDealNoPayDo');	//<b2b2c::touch::ddo::CTouchDealNoPayDo> 消息记录
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91011808;
	}
}

class DeleteDealNoPayResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $reserveOut;	//<std::string> 输出预留参数(版本>=0)

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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x91018808;
	}
}

namespace b2b2c\touch\dao;
class GetAtTimeOkReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $scene;	//<uint32_t> 请求来源场景(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $channel;	//<uint32_t> 渠道ID(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->scene = 0;	//<uint32_t>
		$this->machineKey = "";	//<std::string>
		$this->channel = 0;	//<uint32_t>
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
			exit("GetAtTimeOkReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetAtTimeOkReq\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();	
			if(class_exists($class,false)){						
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}	
				}
			}else{
				$arr=$val;
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
		$bs->pushUint32_t($this->scene);	//<uint32_t> 请求来源场景
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushUint32_t($this->channel);	//<uint32_t> 渠道ID
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91011807;
	}
}

class GetAtTimeOkResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $atTimeDoList;	//<std::vector<b2b2c::touch::ddo::CTouchAtTimeDo> > 消息表(版本>=0)
	private $reserveOut;	//<std::string> 输出预留参数(版本>=0)

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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['atTimeDoList'] = $bs->popObject('stl_vector<\b2b2c\touch\ddo\TouchAtTimeDo>');	//<std::vector<b2b2c::touch::ddo::CTouchAtTimeDo> > 消息表
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x91018807;
	}
}

namespace b2b2c\touch\dao;
class GetRealTimeReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $scene;	//<uint32_t> 请求来源场景(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $channel;	//<uint32_t> 渠道ID(版本>=0)
	private $minPriority;	//<uint32_t> 最小优先级(版本>=0)
	private $maxPriority;	//<uint32_t> 最大优先级(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->scene = 0;	//<uint32_t>
		$this->machineKey = "";	//<std::string>
		$this->channel = 0;	//<uint32_t>
		$this->minPriority = 0;	//<uint32_t>
		$this->maxPriority = 0;	//<uint32_t>
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
			exit("GetRealTimeReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetRealTimeReq\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();	
			if(class_exists($class,false)){						
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}	
				}
			}else{
				$arr=$val;
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
		$bs->pushUint32_t($this->scene);	//<uint32_t> 请求来源场景
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushUint32_t($this->channel);	//<uint32_t> 渠道ID
		$bs->pushUint32_t($this->minPriority);	//<uint32_t> 最小优先级
		$bs->pushUint32_t($this->maxPriority);	//<uint32_t> 最大优先级
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91011804;
	}
}

class GetRealTimeResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $realTimeDoList;	//<std::vector<b2b2c::touch::ddo::CTouchRealTimeDo> > 消息表(版本>=0)
	private $reserveOut;	//<std::string> 输出预留参数(版本>=0)

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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['realTimeDoList'] = $bs->popObject('stl_vector<\b2b2c\touch\ddo\TouchRealTimeDo>');	//<std::vector<b2b2c::touch::ddo::CTouchRealTimeDo> > 消息表
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x91018804;
	}
}

namespace b2b2c\touch\dao;
class InsertAtTimeReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $scene;	//<uint32_t> 请求来源场景(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $record;	//<b2b2c::touch::ddo::CTouchAtTimeDo> (版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->scene = 0;	//<uint32_t>
		$this->machineKey = "";	//<std::string>
		$this->record = new \b2b2c\touch\ddo\TouchAtTimeDo();	//<b2b2c::touch::ddo::CTouchAtTimeDo>
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
			exit("InsertAtTimeReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("InsertAtTimeReq\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();	
			if(class_exists($class,false)){						
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}	
				}
			}else{
				$arr=$val;
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
		$bs->pushUint32_t($this->scene);	//<uint32_t> 请求来源场景
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushObject($this->record,'\b2b2c\touch\ddo\TouchAtTimeDo');	//<b2b2c::touch::ddo::CTouchAtTimeDo> 
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91011801;
	}
}

class InsertAtTimeResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $reserveOut;	//<std::string> 输出预留参数(版本>=0)

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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x91018801;
	}
}

namespace b2b2c\touch\dao;
class InsertDealNoPayReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $scene;	//<uint32_t> 请求来源场景(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $record;	//<b2b2c::touch::ddo::CTouchDealNoPayDo> 消息记录(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->scene = 0;	//<uint32_t>
		$this->machineKey = "";	//<std::string>
		$this->record = new \b2b2c\touch\ddo\TouchDealNoPayDo();	//<b2b2c::touch::ddo::CTouchDealNoPayDo>
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
			exit("InsertDealNoPayReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("InsertDealNoPayReq\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();	
			if(class_exists($class,false)){						
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}	
				}
			}else{
				$arr=$val;
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
		$bs->pushUint32_t($this->scene);	//<uint32_t> 请求来源场景
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushObject($this->record,'\b2b2c\touch\ddo\TouchDealNoPayDo');	//<b2b2c::touch::ddo::CTouchDealNoPayDo> 消息记录
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91011803;
	}
}

class InsertDealNoPayResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $reserveOut;	//<std::string> 输出预留参数(版本>=0)

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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x91018803;
	}
}

namespace b2b2c\touch\dao;
class InsertRealTimeReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $scene;	//<uint32_t> 请求来源场景(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $record;	//<b2b2c::touch::ddo::CTouchRealTimeDo> 消息记录(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->scene = 0;	//<uint32_t>
		$this->machineKey = "";	//<std::string>
		$this->record = new \b2b2c\touch\ddo\TouchRealTimeDo();	//<b2b2c::touch::ddo::CTouchRealTimeDo>
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
			exit("InsertRealTimeReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("InsertRealTimeReq\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();	
			if(class_exists($class,false)){						
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}	
				}
			}else{
				$arr=$val;
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
		$bs->pushUint32_t($this->scene);	//<uint32_t> 请求来源场景
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushObject($this->record,'\b2b2c\touch\ddo\TouchRealTimeDo');	//<b2b2c::touch::ddo::CTouchRealTimeDo> 消息记录
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91011802;
	}
}

class InsertRealTimeResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $reserveOut;	//<std::string> 输出预留参数(版本>=0)

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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x91018802;
	}
}

namespace b2b2c\touch\dao;
class InsertRealTimeFailLogReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $scene;	//<uint32_t> 请求来源场景(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $record;	//<b2b2c::touch::ddo::CTouchRealTimeDo> 消息记录(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->scene = 0;	//<uint32_t>
		$this->machineKey = "";	//<std::string>
		$this->record = new \b2b2c\touch\ddo\TouchRealTimeDo();	//<b2b2c::touch::ddo::CTouchRealTimeDo>
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
			exit("InsertRealTimeFailLogReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("InsertRealTimeFailLogReq\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();	
			if(class_exists($class,false)){						
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}	
				}
			}else{
				$arr=$val;
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
		$bs->pushUint32_t($this->scene);	//<uint32_t> 请求来源场景
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushObject($this->record,'\b2b2c\touch\ddo\TouchRealTimeDo');	//<b2b2c::touch::ddo::CTouchRealTimeDo> 消息记录
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91011806;
	}
}

class InsertRealTimeFailLogResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $reserveOut;	//<std::string> 输出预留参数(版本>=0)

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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x91018806;
	}
}

namespace b2b2c\touch\dao;
class InsertRealTimeSuccessLogReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $scene;	//<uint32_t> 请求来源场景(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $record;	//<b2b2c::touch::ddo::CTouchRealTimeDo> 消息记录(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->scene = 0;	//<uint32_t>
		$this->machineKey = "";	//<std::string>
		$this->record = new \b2b2c\touch\ddo\TouchRealTimeDo();	//<b2b2c::touch::ddo::CTouchRealTimeDo>
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
			exit("InsertRealTimeSuccessLogReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("InsertRealTimeSuccessLogReq\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();	
			if(class_exists($class,false)){						
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}	
				}
			}else{
				$arr=$val;
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
		$bs->pushUint32_t($this->scene);	//<uint32_t> 请求来源场景
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushObject($this->record,'\b2b2c\touch\ddo\TouchRealTimeDo');	//<b2b2c::touch::ddo::CTouchRealTimeDo> 消息记录
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91011805;
	}
}

class InsertRealTimeSuccessLogResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $reserveOut;	//<std::string> 输出预留参数(版本>=0)

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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x91018805;
	}
}
