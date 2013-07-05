<?php
// source idl: com.b2b2c.kf.idl.DAO_51Buy_VipUser.java
namespace icson;
require_once "dao_51buy_vipuser_php5_xxoo.php";

namespace icson\vipuser\dao;
class getUserInfoReq{
	private $_arr_value=array();	//数组形式的类
	private $id;	//<uint64_t>  uin|mobile (版本>=0)
	private $flag;	//<uint32_t>  1:uin|2:mobile (版本>=0)
	private $inReserve;	//<std::string>  备用 (版本>=0)

	function __construct() {
		$this->id = 0;	//<uint64_t>
		$this->flag = 0;	//<uint32_t>
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("getUserInfoReq\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("getUserInfoReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushUint64_t($this->id);	//<uint64_t>  uin|mobile 
		$bs->pushUint32_t($this->flag);	//<uint32_t>  1:uin|2:mobile 
		$bs->pushString($this->inReserve);	//<std::string>  备用 

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xE0041001;
	}
}

class getUserInfoResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $userInfo;	//<icson::vipuser::ddo::CUserAllInfo> (版本>=0)
	private $errMsg;	//<std::string>  错误信息 (版本>=0)
	private $outReserve;	//<std::string>  备用 (版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['userInfo'] = $bs->popObject('\icson\vipuser\ddo\UserAllInfo');	//<icson::vipuser::ddo::CUserAllInfo> 
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string>  错误信息 
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string>  备用 

	}

	function getCmdId() {
		return 0xE0048001;
	}
}

namespace icson\vipuser\dao;
class updateUserInfoReq{
	private $_arr_value=array();	//数组形式的类
	private $baseInfo;	//<icson::vipuser::ddo::CUserBaseInfo>  用户基本信息 (版本>=0)
	private $inReserve;	//<std::string>  备用 (版本>=0)

	function __construct() {
		$this->baseInfo = new \icson\vipuser\ddo\UserBaseInfo();	//<icson::vipuser::ddo::CUserBaseInfo>
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("updateUserInfoReq\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("updateUserInfoReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushObject($this->baseInfo,'\icson\vipuser\ddo\UserBaseInfo');	//<icson::vipuser::ddo::CUserBaseInfo>  用户基本信息 
		$bs->pushString($this->inReserve);	//<std::string>  备用 

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xE0041002;
	}
}

class updateUserInfoResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errMsg;	//<std::string>  错误信息 (版本>=0)
	private $outReserve;	//<std::string>  备用 (版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string>  错误信息 
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string>  备用 
	}

	function getCmdId() {
		return 0xE0048002;
	}
}
