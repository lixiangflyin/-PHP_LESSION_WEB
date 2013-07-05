<?php
// source idl: com.b2b2c.user.idl.UserApiAo.java
namespace b2b2c;
require_once "userapiao_php5_xxoo.php";

namespace b2b2c\user\ao;
class ImportCopartnerInvoiceReq{
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，易迅侧填1(版本>=0)
	private $loginName;	//<std::string> 登录帐号，必需(版本>=0)
	private $loginNameType;	//<uint32_t> 登录帐号类型，0-QQ号 1-个性化帐号 100-第三方帐号，必需(版本>=0)
	private $copartnerInvoice;	//<std::vector<b2b2c::invoice::po::CCopartnerInvoicePo> > 合作方发票簿po，必需(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->loginName = "";	//<std::string>
		$this->loginNameType = 0;	//<uint32_t>
		$this->copartnerInvoice = new \stl_vector2('\b2b2c\invoice\po\CopartnerInvoicePo');	//<std::vector<b2b2c::invoice::po::CCopartnerInvoicePo> >
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("ImportCopartnerInvoiceReq\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("ImportCopartnerInvoiceReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，易迅侧填1
		$bs->pushString($this->loginName);	//<std::string> 登录帐号，必需
		$bs->pushUint32_t($this->loginNameType);	//<uint32_t> 登录帐号类型，0-QQ号 1-个性化帐号 100-第三方帐号，必需
		$bs->pushObject($this->copartnerInvoice,'stl_vector');	//<std::vector<b2b2c::invoice::po::CCopartnerInvoicePo> > 合作方发票簿po，必需
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A41803;
	}
}

class ImportCopartnerInvoiceResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误提示信息(版本>=0)
	private $outReserve;	//<std::string> 输出保留字(版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0A48803;
	}
}

namespace b2b2c\user\ao;
class ImportCopartnerRecvaddrReq{
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，易迅侧填1(版本>=0)
	private $loginName;	//<std::string> 登录帐号，必需(版本>=0)
	private $loginNameType;	//<uint32_t> 登录帐号类型，0-QQ号 1-个性化帐号 100-第三方帐号，必需(版本>=0)
	private $copartnerRecvaddr;	//<std::vector<b2b2c::recvaddr::po::CCopartnerRecvaddrPo> > 合作方收货地址po，必需(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->loginName = "";	//<std::string>
		$this->loginNameType = 0;	//<uint32_t>
		$this->copartnerRecvaddr = new \stl_vector2('\b2b2c\recvaddr\po\CopartnerRecvaddrPo');	//<std::vector<b2b2c::recvaddr::po::CCopartnerRecvaddrPo> >
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("ImportCopartnerRecvaddrReq\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("ImportCopartnerRecvaddrReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，易迅侧填1
		$bs->pushString($this->loginName);	//<std::string> 登录帐号，必需
		$bs->pushUint32_t($this->loginNameType);	//<uint32_t> 登录帐号类型，0-QQ号 1-个性化帐号 100-第三方帐号，必需
		$bs->pushObject($this->copartnerRecvaddr,'stl_vector');	//<std::vector<b2b2c::recvaddr::po::CCopartnerRecvaddrPo> > 合作方收货地址po，必需
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A41802;
	}
}

class ImportCopartnerRecvaddrResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误提示信息(版本>=0)
	private $outReserve;	//<std::string> 输出保留字(版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0A48802;
	}
}

namespace b2b2c\user\ao;
class ImportCopartnerUserInfoReq{
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，易迅侧填1(版本>=0)
	private $loginName;	//<std::string> 登录帐号，必需(版本>=0)
	private $loginNameType;	//<uint32_t> 登录帐号类型，0-QQ号 1-个性化帐号 100-第三方帐号，必需(版本>=0)
	private $copartnerUserInfo;	//<b2b2c::user::po::CCopartnerUserInfoPo> 合作方用户信息po，必需(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->loginName = "";	//<std::string>
		$this->loginNameType = 0;	//<uint32_t>
		$this->copartnerUserInfo = new \b2b2c\user\po\CopartnerUserInfoPo();	//<b2b2c::user::po::CCopartnerUserInfoPo>
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("ImportCopartnerUserInfoReq\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("ImportCopartnerUserInfoReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，易迅侧填1
		$bs->pushString($this->loginName);	//<std::string> 登录帐号，必需
		$bs->pushUint32_t($this->loginNameType);	//<uint32_t> 登录帐号类型，0-QQ号 1-个性化帐号 100-第三方帐号，必需
		$bs->pushObject($this->copartnerUserInfo,'\b2b2c\user\po\CopartnerUserInfoPo');	//<b2b2c::user::po::CCopartnerUserInfoPo> 合作方用户信息po，必需
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A41801;
	}
}

class ImportCopartnerUserInfoResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误提示信息(版本>=0)
	private $outReserve;	//<std::string> 输出保留字(版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0A48801;
	}
}

namespace b2b2c\user\ao;
class SetNonNewUserFlagReq{
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $uin;	//<uint32_t> 用户uin(版本>=0)
	private $uinType;	//<uint32_t> 用户uin类型，必需，0-QQ号 1-用户内部id，参见E_USER_UID_TYPE(版本>=0)
	private $flagValue;	//<uint8_t> 非新用户用户标的设置值，0-复位 1-置位(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->uin = 0;	//<uint32_t>
		$this->uinType = 0;	//<uint32_t>
		$this->flagValue = 0;	//<uint8_t>
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("SetNonNewUserFlagReq\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("SetNonNewUserFlagReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->uin);	//<uint32_t> 用户uin
		$bs->pushUint32_t($this->uinType);	//<uint32_t> 用户uin类型，必需，0-QQ号 1-用户内部id，参见E_USER_UID_TYPE
		$bs->pushUint8_t($this->flagValue);	//<uint8_t> 非新用户用户标的设置值，0-复位 1-置位
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A41804;
	}
}

class SetNonNewUserFlagResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误提示信息(版本>=0)
	private $outReserve;	//<std::string> 输出保留字(版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0A48804;
	}
}
