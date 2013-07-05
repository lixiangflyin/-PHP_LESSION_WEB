<?php
// source idl: com.b2b2c.user.idl.UserIcsonAo.java
namespace b2b2c;
require_once "usericsonao_php5_xxoo.php";

namespace b2b2c\user\ao;
class AddBindInfoWithIcsonUidReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，保留，默认填0即可(版本>=0)
	private $authCode;	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取(版本>=0)
	private $icsonUid;	//<uint64_t> 易迅用户id，目前仅支持32位(版本>=0)
	private $bindInfoType;	//<uint8_t> 绑定帐号类型，必需，0-无效值 1-email(填1则BindInfo填email地址) 2-手机号(填2则BindInfo填手机号)，参见user_comm_define.h中的E_ICSON_USER_BIND_ACCOUNT_TYPE(版本>=0)
	private $bindInfo;	//<std::string> 绑定帐号名（目前支持email或手机号）(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->authCode = "";	//<std::string>
		$this->icsonUid = 0;	//<uint64_t>
		$this->bindInfoType = 0;	//<uint8_t>
		$this->bindInfo = "";	//<std::string>
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
			exit("AddBindInfoWithIcsonUidReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("AddBindInfoWithIcsonUidReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，保留，默认填0即可
		$bs->pushString($this->authCode);	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅用户id，目前仅支持32位
		$bs->pushUint8_t($this->bindInfoType);	//<uint8_t> 绑定帐号类型，必需，0-无效值 1-email(填1则BindInfo填email地址) 2-手机号(填2则BindInfo填手机号)，参见user_comm_define.h中的E_ICSON_USER_BIND_ACCOUNT_TYPE
		$bs->pushString($this->bindInfo);	//<std::string> 绑定帐号名（目前支持email或手机号）
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91826;
	}
}

class AddBindInfoWithIcsonUidResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误提示信息(版本>=0)
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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0A98826;
	}
}

namespace b2b2c\user\ao;
class CheckLoginByIcsonUidReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，保留，默认填0即可(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
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
			exit("CheckLoginByIcsonUidReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("CheckLoginByIcsonUidReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，保留，默认填0即可
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91842;
	}
}

class CheckLoginByIcsonUidResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误提示信息(版本>=0)
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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0A98842;
	}
}

namespace b2b2c\user\ao;
class GetSkeyReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，保留，默认填0即可(版本>=0)
	private $authCode;	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取(版本>=0)
	private $icsonUid;	//<uint64_t> 易迅用户id，目前仅支持32位(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->authCode = "";	//<std::string>
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
			exit("GetSkeyReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetSkeyReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，保留，默认填0即可
		$bs->pushString($this->authCode);	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅用户id，目前仅支持32位
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91843;
	}
}

class GetSkeyResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $skey;	//<std::string> 用户skey(版本>=0)
	private $errmsg;	//<std::string> 错误提示信息(版本>=0)
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
		$this->_arr_value['skey'] = $bs->popString();	//<std::string> 用户skey
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0A98843;
	}
}

namespace b2b2c\user\ao;
class GetUserInfoByBindInfoReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，保留，默认填0即可(版本>=0)
	private $option;	//<uint32_t> 选项掩码，保留，默认填0即可(版本>=0)
	private $bindInfoType;	//<uint8_t> 绑定帐号类型，必需，0-无效值 1-email(填1则BindInfo填email地址) 2-手机号(填2则BindInfo填手机号)，参见user_comm_define.h中的E_ICSON_USER_BIND_ACCOUNT_TYPE(版本>=0)
	private $bindInfo;	//<std::string> 绑定帐号名，目前支持email或手机号(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->option = 0;	//<uint32_t>
		$this->bindInfoType = 0;	//<uint8_t>
		$this->bindInfo = "";	//<std::string>
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
			exit("GetUserInfoByBindInfoReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetUserInfoByBindInfoReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，保留，默认填0即可
		$bs->pushUint32_t($this->option);	//<uint32_t> 选项掩码，保留，默认填0即可
		$bs->pushUint8_t($this->bindInfoType);	//<uint8_t> 绑定帐号类型，必需，0-无效值 1-email(填1则BindInfo填email地址) 2-手机号(填2则BindInfo填手机号)，参见user_comm_define.h中的E_ICSON_USER_BIND_ACCOUNT_TYPE
		$bs->pushString($this->bindInfo);	//<std::string> 绑定帐号名，目前支持email或手机号
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91803;
	}
}

class GetUserInfoByBindInfoResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $buyerInfoPo;	//<b2b2c::user::po::CBuyerInfoPo> 买家信息po(版本>=0)
	private $errmsg;	//<std::string> 错误提示信息(版本>=0)
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
		$this->_arr_value['buyerInfoPo'] = $bs->popObject('\b2b2c\user\po\BuyerInfoPo');	//<b2b2c::user::po::CBuyerInfoPo> 买家信息po
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0A98803;
	}
}

namespace b2b2c\user\ao;
class GetUserInfoByIcsonUidReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，0-取oidb属性失败也返回0；1-取oidb属性失败返回错误码，参见user_comm_define.h中的E_GET_USERINFO_SCENE(版本>=0)
	private $option;	//<uint32_t> 选项掩码，0--默认值，不取用户oidb属性位，1--额外取用户oidb属性位(仅针对QQ用户)，具体参见user_comm_define.h中的E_GETUSER_OPTION(版本>=0)
	private $icsonUid;	//<uint64_t> 易迅用户id，目前仅支持32位(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->option = 0;	//<uint32_t>
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
			exit("GetUserInfoByIcsonUidReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetUserInfoByIcsonUidReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，0-取oidb属性失败也返回0；1-取oidb属性失败返回错误码，参见user_comm_define.h中的E_GET_USERINFO_SCENE
		$bs->pushUint32_t($this->option);	//<uint32_t> 选项掩码，0--默认值，不取用户oidb属性位，1--额外取用户oidb属性位(仅针对QQ用户)，具体参见user_comm_define.h中的E_GETUSER_OPTION
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅用户id，目前仅支持32位
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91801;
	}
}

class GetUserInfoByIcsonUidResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $buyerInfoPo;	//<b2b2c::user::po::CBuyerInfoPo> 买家信息po(版本>=0)
	private $errmsg;	//<std::string> 错误提示信息(版本>=0)
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
		$this->_arr_value['buyerInfoPo'] = $bs->popObject('\b2b2c\user\po\BuyerInfoPo');	//<b2b2c::user::po::CBuyerInfoPo> 买家信息po
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0A98801;
	}
}

namespace b2b2c\user\ao;
class GetUserInfoByQQorAccountReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，保留，默认填0即可(版本>=0)
	private $option;	//<uint32_t> 选项掩码，保留，默认填0即可(版本>=0)
	private $accountType;	//<uint8_t> 用户帐号类型，必需，0-无效值 1-QQ号(填1则QQNumber必填) 2-个性化帐号(填2则loginAccount必填)，参见user_comm_define.h中的E_ICSON_USER_ACCOUNT_TYPE(版本>=0)
	private $qQNumber;	//<uint64_t> 用户QQ号，accountType填1时必填，目前仅支持32位(版本>=0)
	private $loginAccount;	//<std::string> 个性登录帐号（如易迅注册帐号、LoginXXX+Openid等），accountType填2时必填(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->option = 0;	//<uint32_t>
		$this->accountType = 0;	//<uint8_t>
		$this->qQNumber = 0;	//<uint64_t>
		$this->loginAccount = "";	//<std::string>
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
			exit("GetUserInfoByQQorAccountReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetUserInfoByQQorAccountReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，保留，默认填0即可
		$bs->pushUint32_t($this->option);	//<uint32_t> 选项掩码，保留，默认填0即可
		$bs->pushUint8_t($this->accountType);	//<uint8_t> 用户帐号类型，必需，0-无效值 1-QQ号(填1则QQNumber必填) 2-个性化帐号(填2则loginAccount必填)，参见user_comm_define.h中的E_ICSON_USER_ACCOUNT_TYPE
		$bs->pushUint64_t($this->qQNumber);	//<uint64_t> 用户QQ号，accountType填1时必填，目前仅支持32位
		$bs->pushString($this->loginAccount);	//<std::string> 个性登录帐号（如易迅注册帐号、LoginXXX+Openid等），accountType填2时必填
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91802;
	}
}

class GetUserInfoByQQorAccountResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $buyerInfoPo;	//<b2b2c::user::po::CBuyerInfoPo> 买家信息po(版本>=0)
	private $errmsg;	//<std::string> 错误提示信息(版本>=0)
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
		$this->_arr_value['buyerInfoPo'] = $bs->popObject('\b2b2c\user\po\BuyerInfoPo');	//<b2b2c::user::po::CBuyerInfoPo> 买家信息po
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0A98802;
	}
}

namespace b2b2c\user\ao;
class GetWgUidByIcsonUidReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，保留，默认填0即可(版本>=0)
	private $icsonUid;	//<uint64_t> 易迅用户id，目前仅支持32位(版本>=0)
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
			exit("GetWgUidByIcsonUidReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetWgUidByIcsonUidReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，保留，默认填0即可
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅用户id，目前仅支持32位
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91806;
	}
}

class GetWgUidByIcsonUidResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $wgUid;	//<uint64_t> 网购用户id，目前仅支持32位(版本>=0)
	private $errmsg;	//<std::string> 错误提示信息(版本>=0)
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
		$this->_arr_value['wgUid'] = $bs->popUint64_t();	//<uint64_t> 网购用户id，目前仅支持32位
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0A98806;
	}
}

namespace b2b2c\user\ao;
class IcsonUniformLoginReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，保留，默认填0即可(版本>=0)
	private $authCode;	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取(版本>=0)
	private $loginInfoPo;	//<b2b2c::user::po::CLoginInfoPo> 登录信息po(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->authCode = "";	//<std::string>
		$this->loginInfoPo = new \b2b2c\user\po\LoginInfoPo();	//<b2b2c::user::po::CLoginInfoPo>
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
			exit("IcsonUniformLoginReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("IcsonUniformLoginReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，保留，默认填0即可
		$bs->pushString($this->authCode);	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取
		$bs->pushObject($this->loginInfoPo,'\b2b2c\user\po\LoginInfoPo');	//<b2b2c::user::po::CLoginInfoPo> 登录信息po
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91845;
	}
}

class IcsonUniformLoginResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $icsonUid;	//<uint64_t> 易迅用户id，目前仅支持32位(版本>=0)
	private $skey;	//<std::string> sessionKey，当accountType填1时输出为空(版本>=0)
	private $nickname;	//<std::string> 用户昵称，当accountType填1时取的是oidb昵称(版本>=0)
	private $errmsg;	//<std::string> 错误提示信息(版本>=0)
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
		$this->_arr_value['icsonUid'] = $bs->popUint64_t();	//<uint64_t> 易迅用户id，目前仅支持32位
		$this->_arr_value['skey'] = $bs->popString();	//<std::string> sessionKey，当accountType填1时输出为空
		$this->_arr_value['nickname'] = $bs->popString();	//<std::string> 用户昵称，当accountType填1时取的是oidb昵称
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0A98845;
	}
}

namespace b2b2c\user\ao;
class IcsonUserLoginReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，保留，默认填0即可(版本>=0)
	private $authCode;	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取(版本>=0)
	private $accountType;	//<uint8_t> 用户帐号类型，必需，0-无效值 1-QQ号(填1则QQNumber必填) 2-个性化帐号(填2则loginAccount必填)，参见user_comm_define.h中的E_ICSON_USER_ACCOUNT_TYPE(版本>=0)
	private $qQNumber;	//<uint64_t> 用户QQ号，accountType填1时必填，目前仅支持32位(版本>=0)
	private $loginAccount;	//<std::string> 个性登录帐号（如易迅注册帐号、LoginXXX+Openid等），accountType填2时必填(版本>=0)
	private $passwd;	//<std::string> 个性化帐号登录密码，accountType填2时必填(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->authCode = "";	//<std::string>
		$this->accountType = 0;	//<uint8_t>
		$this->qQNumber = 0;	//<uint64_t>
		$this->loginAccount = "";	//<std::string>
		$this->passwd = "";	//<std::string>
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
			exit("IcsonUserLoginReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("IcsonUserLoginReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，保留，默认填0即可
		$bs->pushString($this->authCode);	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取
		$bs->pushUint8_t($this->accountType);	//<uint8_t> 用户帐号类型，必需，0-无效值 1-QQ号(填1则QQNumber必填) 2-个性化帐号(填2则loginAccount必填)，参见user_comm_define.h中的E_ICSON_USER_ACCOUNT_TYPE
		$bs->pushUint64_t($this->qQNumber);	//<uint64_t> 用户QQ号，accountType填1时必填，目前仅支持32位
		$bs->pushString($this->loginAccount);	//<std::string> 个性登录帐号（如易迅注册帐号、LoginXXX+Openid等），accountType填2时必填
		$bs->pushString($this->passwd);	//<std::string> 个性化帐号登录密码，accountType填2时必填
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91841;
	}
}

class IcsonUserLoginResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $icsonUid;	//<uint64_t> 易迅用户id，目前仅支持32位(版本>=0)
	private $errmsg;	//<std::string> 错误提示信息(版本>=0)
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
		$this->_arr_value['icsonUid'] = $bs->popUint64_t();	//<uint64_t> 易迅用户id，目前仅支持32位
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0A98841;
	}
}

namespace b2b2c\user\ao;
class IcsonUserLogoutReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，保留，默认填0即可(版本>=0)
	private $authCode;	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->authCode = "";	//<std::string>
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
			exit("IcsonUserLogoutReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("IcsonUserLogoutReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，保留，默认填0即可
		$bs->pushString($this->authCode);	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91844;
	}
}

class IcsonUserLogoutResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误提示信息(版本>=0)
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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0A98844;
	}
}

namespace b2b2c\user\ao;
class IsBindInfoBindedReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，保留，默认填0即可(版本>=0)
	private $icsonUid;	//<uint64_t> 易迅用户id，目前仅支持32位(版本>=0)
	private $bindInfoType;	//<uint8_t> 绑定帐号类型，必需，0-无效值 1-email(填1则BindInfo填email地址) 2-手机号(填2则BindInfo填手机号)，参见user_comm_define.h中的E_ICSON_USER_BIND_ACCOUNT_TYPE(版本>=0)
	private $bindInfo;	//<std::string> 绑定帐号名（目前支持email或手机号）(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->icsonUid = 0;	//<uint64_t>
		$this->bindInfoType = 0;	//<uint8_t>
		$this->bindInfo = "";	//<std::string>
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
			exit("IsBindInfoBindedReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("IsBindInfoBindedReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，保留，默认填0即可
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅用户id，目前仅支持32位
		$bs->pushUint8_t($this->bindInfoType);	//<uint8_t> 绑定帐号类型，必需，0-无效值 1-email(填1则BindInfo填email地址) 2-手机号(填2则BindInfo填手机号)，参见user_comm_define.h中的E_ICSON_USER_BIND_ACCOUNT_TYPE
		$bs->pushString($this->bindInfo);	//<std::string> 绑定帐号名（目前支持email或手机号）
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91804;
	}
}

class IsBindInfoBindedResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $retValue;	//<uint8_t> 结果值，0-未绑定 1-已绑定(版本>=0)
	private $errmsg;	//<std::string> 错误提示信息(版本>=0)
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
		$this->_arr_value['retValue'] = $bs->popUint8_t();	//<uint8_t> 结果值，0-未绑定 1-已绑定
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0A98804;
	}
}

namespace b2b2c\user\ao;
class IsQQorAccountRegisteredReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，保留，默认填0即可(版本>=0)
	private $accountType;	//<uint8_t> 用户帐号类型，必需，0-无效值 1-QQ号(填1则QQNumber必填) 2-个性化帐号(填2则loginAccount必填)，参见user_comm_define.h中的E_ICSON_USER_ACCOUNT_TYPE(版本>=0)
	private $qQNumber;	//<uint64_t> 用户QQ号，accountType填1时必填，目前仅支持32位(版本>=0)
	private $loginAccount;	//<std::string> 个性登录帐号（如易迅注册帐号、LoginXXX+Openid等），accountType填2时必填(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->accountType = 0;	//<uint8_t>
		$this->qQNumber = 0;	//<uint64_t>
		$this->loginAccount = "";	//<std::string>
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
			exit("IsQQorAccountRegisteredReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("IsQQorAccountRegisteredReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，保留，默认填0即可
		$bs->pushUint8_t($this->accountType);	//<uint8_t> 用户帐号类型，必需，0-无效值 1-QQ号(填1则QQNumber必填) 2-个性化帐号(填2则loginAccount必填)，参见user_comm_define.h中的E_ICSON_USER_ACCOUNT_TYPE
		$bs->pushUint64_t($this->qQNumber);	//<uint64_t> 用户QQ号，accountType填1时必填，目前仅支持32位
		$bs->pushString($this->loginAccount);	//<std::string> 个性登录帐号（如易迅注册帐号、LoginXXX+Openid等），accountType填2时必填
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91805;
	}
}

class IsQQorAccountRegisteredResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $retValue;	//<uint8_t> 结果值，0-未注册 1-已注册(版本>=0)
	private $errmsg;	//<std::string> 错误提示信息(版本>=0)
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
		$this->_arr_value['retValue'] = $bs->popUint8_t();	//<uint8_t> 结果值，0-未注册 1-已注册
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0A98805;
	}
}

namespace b2b2c\user\ao;
class ModifyAccountPasswdByIcsonUidReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，保留，默认填0即可(版本>=0)
	private $authCode;	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取(版本>=0)
	private $icsonUid;	//<uint64_t> 易迅用户id，目前仅支持32位(版本>=0)
	private $oldPasswd;	//<std::string> 个性化帐号的老登录密码(版本>=0)
	private $newPasswd;	//<std::string> 个性化帐号的新登录密码(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->authCode = "";	//<std::string>
		$this->icsonUid = 0;	//<uint64_t>
		$this->oldPasswd = "";	//<std::string>
		$this->newPasswd = "";	//<std::string>
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
			exit("ModifyAccountPasswdByIcsonUidReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("ModifyAccountPasswdByIcsonUidReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，保留，默认填0即可
		$bs->pushString($this->authCode);	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅用户id，目前仅支持32位
		$bs->pushString($this->oldPasswd);	//<std::string> 个性化帐号的老登录密码
		$bs->pushString($this->newPasswd);	//<std::string> 个性化帐号的新登录密码
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91824;
	}
}

class ModifyAccountPasswdByIcsonUidResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误提示信息(版本>=0)
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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0A98824;
	}
}

namespace b2b2c\user\ao;
class ModifyBasicUserInfoByIcsonUidReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，保留，默认填0即可(版本>=0)
	private $authCode;	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取(版本>=0)
	private $icsonUid;	//<uint64_t> 易迅用户id，目前仅支持32位(版本>=0)
	private $buyerInfoPo;	//<b2b2c::user::po::CBuyerInfoPo> 买家信息po(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->authCode = "";	//<std::string>
		$this->icsonUid = 0;	//<uint64_t>
		$this->buyerInfoPo = new \b2b2c\user\po\BuyerInfoPo();	//<b2b2c::user::po::CBuyerInfoPo>
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
			exit("ModifyBasicUserInfoByIcsonUidReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("ModifyBasicUserInfoByIcsonUidReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，保留，默认填0即可
		$bs->pushString($this->authCode);	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅用户id，目前仅支持32位
		$bs->pushObject($this->buyerInfoPo,'\b2b2c\user\po\BuyerInfoPo');	//<b2b2c::user::po::CBuyerInfoPo> 买家信息po
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91821;
	}
}

class ModifyBasicUserInfoByIcsonUidResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误提示信息(版本>=0)
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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0A98821;
	}
}

namespace b2b2c\user\ao;
class ModifyExpLevVirExpByIcsonUidReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，保留，默认填0即可(版本>=0)
	private $authCode;	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取(版本>=0)
	private $icsonUid;	//<uint64_t> 易迅用户id，目前仅支持32位(版本>=0)
	private $pointsAndLevelPo;	//<b2b2c::user::po::CPointsAndLevelPo> 更新po(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->authCode = "";	//<std::string>
		$this->icsonUid = 0;	//<uint64_t>
		$this->pointsAndLevelPo = new \b2b2c\user\po\PointsAndLevelPo();	//<b2b2c::user::po::CPointsAndLevelPo>
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
			exit("ModifyExpLevVirExpByIcsonUidReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("ModifyExpLevVirExpByIcsonUidReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，保留，默认填0即可
		$bs->pushString($this->authCode);	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅用户id，目前仅支持32位
		$bs->pushObject($this->pointsAndLevelPo,'\b2b2c\user\po\PointsAndLevelPo');	//<b2b2c::user::po::CPointsAndLevelPo> 更新po
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91846;
	}
}

class ModifyExpLevVirExpByIcsonUidResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误提示信息(版本>=0)
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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0A98846;
	}
}

namespace b2b2c\user\ao;
class ModifyExperienceByIcsonUidReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，保留，默认填0即可(版本>=0)
	private $authCode;	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取(版本>=0)
	private $icsonUid;	//<uint64_t> 易迅用户id，目前仅支持32位(版本>=0)
	private $experience;	//<uint32_t> 用户经验值(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->authCode = "";	//<std::string>
		$this->icsonUid = 0;	//<uint64_t>
		$this->experience = 0;	//<uint32_t>
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
			exit("ModifyExperienceByIcsonUidReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("ModifyExperienceByIcsonUidReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，保留，默认填0即可
		$bs->pushString($this->authCode);	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅用户id，目前仅支持32位
		$bs->pushUint32_t($this->experience);	//<uint32_t> 用户经验值
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91822;
	}
}

class ModifyExperienceByIcsonUidResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误提示信息(版本>=0)
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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0A98822;
	}
}

namespace b2b2c\user\ao;
class ModifyIcsonMemberLevelByIcsonUidReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，保留，默认填0即可(版本>=0)
	private $authCode;	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取(版本>=0)
	private $icsonUid;	//<uint64_t> 易迅用户id，目前仅支持32位(版本>=0)
	private $icsonMemberLevel;	//<uint32_t> 易迅会员等级(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->authCode = "";	//<std::string>
		$this->icsonUid = 0;	//<uint64_t>
		$this->icsonMemberLevel = 0;	//<uint32_t>
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
			exit("ModifyIcsonMemberLevelByIcsonUidReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("ModifyIcsonMemberLevelByIcsonUidReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，保留，默认填0即可
		$bs->pushString($this->authCode);	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅用户id，目前仅支持32位
		$bs->pushUint32_t($this->icsonMemberLevel);	//<uint32_t> 易迅会员等级
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91823;
	}
}

class ModifyIcsonMemberLevelByIcsonUidResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误提示信息(版本>=0)
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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0A98823;
	}
}

namespace b2b2c\user\ao;
class RemoveBindInfoWithIcsonUidReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，保留，默认填0即可(版本>=0)
	private $authCode;	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取(版本>=0)
	private $icsonUid;	//<uint64_t> 易迅用户id，目前仅支持32位(版本>=0)
	private $bindInfoType;	//<uint8_t> 绑定帐号类型，必需，0-无效值 1-email(填1则BindInfo填email地址) 2-手机号(填2则BindInfo填手机号)，参见user_comm_define.h中的E_ICSON_USER_BIND_ACCOUNT_TYPE(版本>=0)
	private $bindInfo;	//<std::string> 绑定帐号名（目前支持email或手机号）(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->authCode = "";	//<std::string>
		$this->icsonUid = 0;	//<uint64_t>
		$this->bindInfoType = 0;	//<uint8_t>
		$this->bindInfo = "";	//<std::string>
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
			exit("RemoveBindInfoWithIcsonUidReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("RemoveBindInfoWithIcsonUidReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，保留，默认填0即可
		$bs->pushString($this->authCode);	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅用户id，目前仅支持32位
		$bs->pushUint8_t($this->bindInfoType);	//<uint8_t> 绑定帐号类型，必需，0-无效值 1-email(填1则BindInfo填email地址) 2-手机号(填2则BindInfo填手机号)，参见user_comm_define.h中的E_ICSON_USER_BIND_ACCOUNT_TYPE
		$bs->pushString($this->bindInfo);	//<std::string> 绑定帐号名（目前支持email或手机号）
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91827;
	}
}

class RemoveBindInfoWithIcsonUidResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误提示信息(版本>=0)
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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0A98827;
	}
}

namespace b2b2c\user\ao;
class ResetAccountPasswdByIcsonUidReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，保留，默认填0即可(版本>=0)
	private $authCode;	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取(版本>=0)
	private $icsonUid;	//<uint64_t> 易迅用户id，目前仅支持32位(版本>=0)
	private $initPasswd;	//<std::string> 重置后的登录密码(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->authCode = "";	//<std::string>
		$this->icsonUid = 0;	//<uint64_t>
		$this->initPasswd = "";	//<std::string>
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
			exit("ResetAccountPasswdByIcsonUidReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("ResetAccountPasswdByIcsonUidReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，保留，默认填0即可
		$bs->pushString($this->authCode);	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅用户id，目前仅支持32位
		$bs->pushString($this->initPasswd);	//<std::string> 重置后的登录密码
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91825;
	}
}

class ResetAccountPasswdByIcsonUidResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误提示信息(版本>=0)
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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0A98825;
	}
}

namespace b2b2c\user\ao;
class UserRegisterReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，保留，默认填0即可(版本>=0)
	private $authCode;	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取(版本>=0)
	private $accountType;	//<uint8_t> 用户帐号类型，必需，0-无效值 1-QQ号(填1则QQNumber必填) 2-个性化帐号(填2则loginAccount必填)，参见user_comm_define.h中的E_ICSON_USER_ACCOUNT_TYPE(版本>=0)
	private $qQNumber;	//<uint64_t> 用户QQ号，accountType填1时必填，目前仅支持32位(版本>=0)
	private $loginAccount;	//<std::string> 个性登录帐号（如易迅注册帐号、LoginXXX+Openid等），accountType填2时必填(版本>=0)
	private $passwd;	//<std::string> 个性化帐号登录密码(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->authCode = "";	//<std::string>
		$this->accountType = 0;	//<uint8_t>
		$this->qQNumber = 0;	//<uint64_t>
		$this->loginAccount = "";	//<std::string>
		$this->passwd = "";	//<std::string>
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
			exit("UserRegisterReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("UserRegisterReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，保留，默认填0即可
		$bs->pushString($this->authCode);	//<std::string> 鉴权码，必需，具体请联系stonenie/silenchen获取
		$bs->pushUint8_t($this->accountType);	//<uint8_t> 用户帐号类型，必需，0-无效值 1-QQ号(填1则QQNumber必填) 2-个性化帐号(填2则loginAccount必填)，参见user_comm_define.h中的E_ICSON_USER_ACCOUNT_TYPE
		$bs->pushUint64_t($this->qQNumber);	//<uint64_t> 用户QQ号，accountType填1时必填，目前仅支持32位
		$bs->pushString($this->loginAccount);	//<std::string> 个性登录帐号（如易迅注册帐号、LoginXXX+Openid等），accountType填2时必填
		$bs->pushString($this->passwd);	//<std::string> 个性化帐号登录密码
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91828;
	}
}

class UserRegisterResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $icsonUid;	//<uint64_t> 易迅用户id，目前仅支持32位(版本>=0)
	private $errmsg;	//<std::string> 错误提示信息(版本>=0)
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
		$this->_arr_value['icsonUid'] = $bs->popUint64_t();	//<uint64_t> 易迅用户id，目前仅支持32位
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0A98828;
	}
}
