<?php
// source idl: com.b2b2c.icsonrecvaddr.idl.IcsonRecvAddressAo.java
namespace b2b2c;
require_once "icsonrecvaddressao_php5_xxoo.php";

namespace b2b2c\icson_recvaddr\ao;
class AddIcsonRecvAddrReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，一般为用户登录后在浏览器cookie中的打标，用于标识请求来源浏览器，内部调用可以填随机字符串(版本>=0)
	private $source;	//<std::string> 调用来源，为接口调用方的文件名(版本>=0)
	private $sceneId;	//<uint32_t> 场景ID(版本>=0)
	private $authKey;	//<std::string> 接口请求校验键值，如果传入的校验键值不对，请求会被拒绝(版本>=0)
	private $icsonUid;	//<uint64_t> 易迅用户ID(版本>=0)
	private $icsonRecvAddrPo;	//<b2b2c::icson_recvaddr::po::CIcsonRecvAddrPo> 易迅用户收货地址Po(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->authKey = "";	//<std::string>
		$this->icsonUid = 0;	//<uint64_t>
		$this->icsonRecvAddrPo = new \b2b2c\icson_recvaddr\po\IcsonRecvAddrPo();	//<b2b2c::icson_recvaddr::po::CIcsonRecvAddrPo>
		$this->inReserve = "";	//<std::string>
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
			exit("AddIcsonRecvAddrReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("AddIcsonRecvAddr\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，一般为用户登录后在浏览器cookie中的打标，用于标识请求来源浏览器，内部调用可以填随机字符串
		$bs->pushString($this->source);	//<std::string> 调用来源，为接口调用方的文件名
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景ID
		$bs->pushString($this->authKey);	//<std::string> 接口请求校验键值，如果传入的校验键值不对，请求会被拒绝
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅用户ID
		$bs->pushObject($this->icsonRecvAddrPo,'\b2b2c\icson_recvaddr\po\IcsonRecvAddrPo');	//<b2b2c::icson_recvaddr::po::CIcsonRecvAddrPo> 易迅用户收货地址Po
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x31041802;
	}
}

class AddIcsonRecvAddrResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errMsg;	//<std::string> 错误信息(版本>=0)
	private $outReserve;	//<std::string> 输出保留字(版本>=0)

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
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0x31048802;
	}
}

namespace b2b2c\icson_recvaddr\ao;
class DelIcsonRecvAddrReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，一般为用户登录后在浏览器cookie中的打标，用于标识请求来源浏览器，内部调用可以填随机字符串(版本>=0)
	private $source;	//<std::string> 调用来源，为接口调用方的文件名(版本>=0)
	private $sceneId;	//<uint32_t> 场景ID(版本>=0)
	private $authKey;	//<std::string> 接口请求校验键值，如果传入的校验键值不对，请求会被拒绝(版本>=0)
	private $icsonUid;	//<uint64_t> 易迅用户ID(版本>=0)
	private $icsonAid;	//<uint64_t> 易迅用户收货地址ID(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->authKey = "";	//<std::string>
		$this->icsonUid = 0;	//<uint64_t>
		$this->icsonAid = 0;	//<uint64_t>
		$this->inReserve = "";	//<std::string>
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
			exit("DelIcsonRecvAddrReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("DelIcsonRecvAddr\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，一般为用户登录后在浏览器cookie中的打标，用于标识请求来源浏览器，内部调用可以填随机字符串
		$bs->pushString($this->source);	//<std::string> 调用来源，为接口调用方的文件名
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景ID
		$bs->pushString($this->authKey);	//<std::string> 接口请求校验键值，如果传入的校验键值不对，请求会被拒绝
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅用户ID
		$bs->pushUint64_t($this->icsonAid);	//<uint64_t> 易迅用户收货地址ID
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x31041804;
	}
}

class DelIcsonRecvAddrResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errMsg;	//<std::string> 错误信息(版本>=0)
	private $outReserve;	//<std::string> 输出保留字(版本>=0)

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
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0x31048804;
	}
}

namespace b2b2c\icson_recvaddr\ao;
class GetIcsonRecvAddrReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，一般为用户登录后在浏览器cookie中的打标，用于标识请求来源浏览器，内部调用可以填随机字符串(版本>=0)
	private $source;	//<std::string> 调用来源，为接口调用方的文件名(版本>=0)
	private $sceneId;	//<uint32_t> 场景ID(版本>=0)
	private $icsonUid;	//<uint64_t> 易迅用户ID(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->icsonUid = 0;	//<uint64_t>
		$this->inReserve = "";	//<std::string>
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
			exit("GetIcsonRecvAddrReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetIcsonRecvAddr\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，一般为用户登录后在浏览器cookie中的打标，用于标识请求来源浏览器，内部调用可以填随机字符串
		$bs->pushString($this->source);	//<std::string> 调用来源，为接口调用方的文件名
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景ID
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅用户ID
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x31041801;
	}
}

class GetIcsonRecvAddrResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $icsonRecvAddrPoList;	//<b2b2c::icson_recvaddr::po::CIcsonRecvAddrPoList> 易迅用户收货地址Po列表(版本>=0)
	private $errMsg;	//<std::string> 错误信息(版本>=0)
	private $outReserve;	//<std::string> 输出保留字(版本>=0)

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
		$this->_arr_value['icsonRecvAddrPoList'] = $bs->popObject('\b2b2c\icson_recvaddr\po\IcsonRecvAddrPoList');	//<b2b2c::icson_recvaddr::po::CIcsonRecvAddrPoList> 易迅用户收货地址Po列表
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0x31048801;
	}
}

namespace b2b2c\icson_recvaddr\ao;
class MofidyIcsonRecvAddrReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，一般为用户登录后在浏览器cookie中的打标，用于标识请求来源浏览器，内部调用可以填随机字符串(版本>=0)
	private $source;	//<std::string> 调用来源，为接口调用方的文件名(版本>=0)
	private $sceneId;	//<uint32_t> 场景ID(版本>=0)
	private $authKey;	//<std::string> 接口请求校验键值，如果传入的校验键值不对，请求会被拒绝(版本>=0)
	private $newIcsonRecvAddrPo;	//<b2b2c::icson_recvaddr::po::CIcsonRecvAddrPo> 易迅用户收货地址Po(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->authKey = "";	//<std::string>
		$this->newIcsonRecvAddrPo = new \b2b2c\icson_recvaddr\po\IcsonRecvAddrPo();	//<b2b2c::icson_recvaddr::po::CIcsonRecvAddrPo>
		$this->inReserve = "";	//<std::string>
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
			exit("MofidyIcsonRecvAddrReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("MofidyIcsonRecvAddr\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，一般为用户登录后在浏览器cookie中的打标，用于标识请求来源浏览器，内部调用可以填随机字符串
		$bs->pushString($this->source);	//<std::string> 调用来源，为接口调用方的文件名
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景ID
		$bs->pushString($this->authKey);	//<std::string> 接口请求校验键值，如果传入的校验键值不对，请求会被拒绝
		$bs->pushObject($this->newIcsonRecvAddrPo,'\b2b2c\icson_recvaddr\po\IcsonRecvAddrPo');	//<b2b2c::icson_recvaddr::po::CIcsonRecvAddrPo> 易迅用户收货地址Po
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x31041803;
	}
}

class MofidyIcsonRecvAddrResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errMsg;	//<std::string> 错误信息(版本>=0)
	private $outReserve;	//<std::string> 输出保留字(版本>=0)

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
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0x31048803;
	}
}

namespace b2b2c\icson_recvaddr\ao;
class MofidyIcsonRecvAddrDflValueReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，一般为用户登录后在浏览器cookie中的打标，用于标识请求来源浏览器，内部调用可以填随机字符串(版本>=0)
	private $source;	//<std::string> 调用来源，为接口调用方的文件名(版本>=0)
	private $sceneId;	//<uint32_t> 场景ID(版本>=0)
	private $authKey;	//<std::string> 接口请求校验键值，如果传入的校验键值不对，请求会被拒绝(版本>=0)
	private $icsonUid;	//<uint64_t> 易迅用户ID(版本>=0)
	private $newIcsonRecvAddrPo;	//<b2b2c::icson_recvaddr::po::CIcsonRecvAddrPo> 易迅用户收货地址Po(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->authKey = "";	//<std::string>
		$this->icsonUid = 0;	//<uint64_t>
		$this->newIcsonRecvAddrPo = new \b2b2c\icson_recvaddr\po\IcsonRecvAddrPo();	//<b2b2c::icson_recvaddr::po::CIcsonRecvAddrPo>
		$this->inReserve = "";	//<std::string>
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
			exit("MofidyIcsonRecvAddrDflValueReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("MofidyIcsonRecvAddrDflValue\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，一般为用户登录后在浏览器cookie中的打标，用于标识请求来源浏览器，内部调用可以填随机字符串
		$bs->pushString($this->source);	//<std::string> 调用来源，为接口调用方的文件名
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景ID
		$bs->pushString($this->authKey);	//<std::string> 接口请求校验键值，如果传入的校验键值不对，请求会被拒绝
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅用户ID
		$bs->pushObject($this->newIcsonRecvAddrPo,'\b2b2c\icson_recvaddr\po\IcsonRecvAddrPo');	//<b2b2c::icson_recvaddr::po::CIcsonRecvAddrPo> 易迅用户收货地址Po
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x31041805;
	}
}

class MofidyIcsonRecvAddrDflValueResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errMsg;	//<std::string> 错误信息(版本>=0)
	private $outReserve;	//<std::string> 输出保留字(版本>=0)

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
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0x31048805;
	}
}
