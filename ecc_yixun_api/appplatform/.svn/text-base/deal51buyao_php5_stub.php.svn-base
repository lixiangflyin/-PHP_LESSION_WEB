<?php
// source idl: com.ecc.deal.idl.Deal51BuyAo.java
namespace ecc;
require_once "deal51buyao_php5_xxoo.php";

namespace ecc\deal\ao;
class AuditDealReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数(版本>=0)
	private $auditParams;	//<ecc::deal::bo::CEventParamsAuditDealBo> 审核订单参数(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
		$this->auditParams = new \ecc\deal\bo\EventParamsAuditDealBo();	//<ecc::deal::bo::CEventParamsAuditDealBo>
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
			exit("AuditDealReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("AuditDealReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数
		$bs->pushObject($this->auditParams,'\ecc\deal\bo\EventParamsAuditDealBo');	//<ecc::deal::bo::CEventParamsAuditDealBo> 审核订单参数
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041808;
	}
}

class AuditDealResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dealInfo;	//<ecc::deal::po::CDealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['dealInfo'] = $bs->popObject('\ecc\deal\po\DealPo');	//<ecc::deal::po::CDealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x63048808;
	}
}

namespace ecc\deal\ao;
class BackfillDealInfoReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础参数(版本>=0)
	private $backfillParams;	//<ecc::deal::bo::CBackfillDealBo> 下单的订单信息(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
		$this->backfillParams = new \ecc\deal\bo\BackfillDealBo();	//<ecc::deal::bo::CBackfillDealBo>
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
			exit("BackfillDealInfoReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("BackfillDealInfoReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础参数
		$bs->pushObject($this->backfillParams,'\ecc\deal\bo\BackfillDealBo');	//<ecc::deal::bo::CBackfillDealBo> 下单的订单信息
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041802;
	}
}

class BackfillDealInfoResp{
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
		return 0x63048802;
	}
}

namespace ecc\deal\ao;
class CSCreateBuyDealReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础参数(版本>=0)
	private $orderList;	//<ecc::deal::po::COrderPoList> 下单的订单信息(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
		$this->orderList = new \ecc\deal\po\OrderPoList();	//<ecc::deal::po::COrderPoList>
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
			exit("CSCreateBuyDealReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("CSCreateBuyDealReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础参数
		$bs->pushObject($this->orderList,'\ecc\deal\po\OrderPoList');	//<ecc::deal::po::COrderPoList> 下单的订单信息
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x6304181c;
	}
}

class CSCreateBuyDealResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $bdealInfo;	//<ecc::deal::po::CBdealPo> 返回的交易单信息(版本>=0)
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
		$this->_arr_value['bdealInfo'] = $bs->popObject('\ecc\deal\po\BdealPo');	//<ecc::deal::po::CBdealPo> 返回的交易单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x6304881c;
	}
}

namespace ecc\deal\ao;
class CancelBuyDealReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 事件参数(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
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
			exit("CancelBuyDealReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("CancelBuyDealReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 事件参数
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041805;
	}
}

class CancelBuyDealResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $bdealInfo;	//<ecc::deal::po::CBdealPo> 返回的交易单信息(版本>=0)
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
		$this->_arr_value['bdealInfo'] = $bs->popObject('\ecc\deal\po\BdealPo');	//<ecc::deal::po::CBdealPo> 返回的交易单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x63048805;
	}
}

namespace ecc\deal\ao;
class CancelDealReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 事件参数(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
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
			exit("CancelDealReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("CancelDealReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 事件参数
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041806;
	}
}

class CancelDealResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dealInfo;	//<ecc::deal::po::CDealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['dealInfo'] = $bs->popObject('\ecc\deal\po\DealPo');	//<ecc::deal::po::CDealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x63048806;
	}
}

namespace ecc\deal\ao;
class CancelSupersessionReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
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
			exit("CancelSupersessionReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("CancelSupersessionReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x6304181e;
	}
}

class CancelSupersessionResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dealInfo;	//<ecc::deal::po::CDealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['dealInfo'] = $bs->popObject('\ecc\deal\po\DealPo');	//<ecc::deal::po::CDealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x6304881e;
	}
}

namespace ecc\deal\ao;
class CloseDealReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数(版本>=0)
	private $closeParams;	//<ecc::deal::bo::CEventParamsCloseDealBo> 关闭订单参数(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
		$this->closeParams = new \ecc\deal\bo\EventParamsCloseDealBo();	//<ecc::deal::bo::CEventParamsCloseDealBo>
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
			exit("CloseDealReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("CloseDealReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数
		$bs->pushObject($this->closeParams,'\ecc\deal\bo\EventParamsCloseDealBo');	//<ecc::deal::bo::CEventParamsCloseDealBo> 关闭订单参数
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041807;
	}
}

class CloseDealResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dealInfo;	//<ecc::deal::po::CDealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['dealInfo'] = $bs->popObject('\ecc\deal\po\DealPo');	//<ecc::deal::po::CDealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x63048807;
	}
}

namespace ecc\deal\ao;
class ConfirmRecvReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数(版本>=0)
	private $signParams;	//<ecc::deal::bo::CEventParamsCorpSignBo> 签收事件参数(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
		$this->signParams = new \ecc\deal\bo\EventParamsCorpSignBo();	//<ecc::deal::bo::CEventParamsCorpSignBo>
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
			exit("ConfirmRecvReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("ConfirmRecvReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数
		$bs->pushObject($this->signParams,'\ecc\deal\bo\EventParamsCorpSignBo');	//<ecc::deal::bo::CEventParamsCorpSignBo> 签收事件参数
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x6304180a;
	}
}

class ConfirmRecvResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dealInfo;	//<ecc::deal::po::CDealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['dealInfo'] = $bs->popObject('\ecc\deal\po\DealPo');	//<ecc::deal::po::CDealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x6304880a;
	}
}

namespace ecc\deal\ao;
class CreateBuyDealReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础参数(版本>=0)
	private $orderList;	//<ecc::deal::po::COrderPoList> 下单的订单信息(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
		$this->orderList = new \ecc\deal\po\OrderPoList();	//<ecc::deal::po::COrderPoList>
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
			exit("CreateBuyDealReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("CreateBuyDealReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础参数
		$bs->pushObject($this->orderList,'\ecc\deal\po\OrderPoList');	//<ecc::deal::po::COrderPoList> 下单的订单信息
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041801;
	}
}

class CreateBuyDealResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $bdealInfo;	//<ecc::deal::po::CBdealPo> 返回的交易单信息(版本>=0)
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
		$this->_arr_value['bdealInfo'] = $bs->popObject('\ecc\deal\po\BdealPo');	//<ecc::deal::po::CBdealPo> 返回的交易单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x63048801;
	}
}

namespace ecc\deal\ao;
class CreateRefundReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数(版本>=0)
	private $refundParams;	//<ecc::deal::bo::CEventParamsCorpCreateRefundBo> 退款参数(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
		$this->refundParams = new \ecc\deal\bo\EventParamsCorpCreateRefundBo();	//<ecc::deal::bo::CEventParamsCorpCreateRefundBo>
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
			exit("CreateRefundReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("CreateRefundReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数
		$bs->pushObject($this->refundParams,'\ecc\deal\bo\EventParamsCorpCreateRefundBo');	//<ecc::deal::bo::CEventParamsCorpCreateRefundBo> 退款参数
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x6304180d;
	}
}

class CreateRefundResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dealInfo;	//<ecc::deal::po::CDealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['dealInfo'] = $bs->popObject('\ecc\deal\po\DealPo');	//<ecc::deal::po::CDealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x6304880d;
	}
}

namespace ecc\deal\ao;
class MarkShipReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数(版本>=0)
	private $shipParams;	//<ecc::deal::bo::CEventParamsCorpShipBo> 发货参数(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
		$this->shipParams = new \ecc\deal\bo\EventParamsCorpShipBo();	//<ecc::deal::bo::CEventParamsCorpShipBo>
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
			exit("MarkShipReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("MarkShipReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数
		$bs->pushObject($this->shipParams,'\ecc\deal\bo\EventParamsCorpShipBo');	//<ecc::deal::bo::CEventParamsCorpShipBo> 发货参数
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041809;
	}
}

class MarkShipResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dealInfo;	//<ecc::deal::po::CDealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['dealInfo'] = $bs->popObject('\ecc\deal\po\DealPo');	//<ecc::deal::po::CDealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x63048809;
	}
}

namespace ecc\deal\ao;
class ModifyCouponReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数(版本>=0)
	private $couponParams;	//<ecc::deal::bo::CEventParamsModifyCouponBo> 修改参数(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
		$this->couponParams = new \ecc\deal\bo\EventParamsModifyCouponBo();	//<ecc::deal::bo::CEventParamsModifyCouponBo>
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
			exit("ModifyCouponReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("ModifyCouponReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数
		$bs->pushObject($this->couponParams,'\ecc\deal\bo\EventParamsModifyCouponBo');	//<ecc::deal::bo::CEventParamsModifyCouponBo> 修改参数
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041814;
	}
}

class ModifyCouponResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dealInfo;	//<ecc::deal::po::CDealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['dealInfo'] = $bs->popObject('\ecc\deal\po\DealPo');	//<ecc::deal::po::CDealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x63048814;
	}
}

namespace ecc\deal\ao;
class ModifyDealPriceReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数(版本>=0)
	private $modifyPriceParams;	//<ecc::deal::bo::CEventParamsModifyDealPriceBo> 修改参数(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
		$this->modifyPriceParams = new \ecc\deal\bo\EventParamsModifyDealPriceBo();	//<ecc::deal::bo::CEventParamsModifyDealPriceBo>
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
			exit("ModifyDealPriceReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("ModifyDealPriceReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数
		$bs->pushObject($this->modifyPriceParams,'\ecc\deal\bo\EventParamsModifyDealPriceBo');	//<ecc::deal::bo::CEventParamsModifyDealPriceBo> 修改参数
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041816;
	}
}

class ModifyDealPriceResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dealInfo;	//<ecc::deal::po::CDealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['dealInfo'] = $bs->popObject('\ecc\deal\po\DealPo');	//<ecc::deal::po::CDealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x63048816;
	}
}

namespace ecc\deal\ao;
class ModifyInvoiceReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数(版本>=0)
	private $invoiceParams;	//<ecc::deal::bo::CEventParamsModifyInvoiceBo> 修改参数(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
		$this->invoiceParams = new \ecc\deal\bo\EventParamsModifyInvoiceBo();	//<ecc::deal::bo::CEventParamsModifyInvoiceBo>
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
			exit("ModifyInvoiceReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("ModifyInvoiceReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数
		$bs->pushObject($this->invoiceParams,'\ecc\deal\bo\EventParamsModifyInvoiceBo');	//<ecc::deal::bo::CEventParamsModifyInvoiceBo> 修改参数
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041813;
	}
}

class ModifyInvoiceResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dealInfo;	//<ecc::deal::po::CDealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['dealInfo'] = $bs->popObject('\ecc\deal\po\DealPo');	//<ecc::deal::po::CDealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x63048813;
	}
}

namespace ecc\deal\ao;
class ModifyPayTypeReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数(版本>=0)
	private $modifyParams;	//<ecc::deal::bo::CEventParamsModifyPayTypeBo> 修改参数(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
		$this->modifyParams = new \ecc\deal\bo\EventParamsModifyPayTypeBo();	//<ecc::deal::bo::CEventParamsModifyPayTypeBo>
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
			exit("ModifyPayTypeReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("ModifyPayTypeReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数
		$bs->pushObject($this->modifyParams,'\ecc\deal\bo\EventParamsModifyPayTypeBo');	//<ecc::deal::bo::CEventParamsModifyPayTypeBo> 修改参数
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041811;
	}
}

class ModifyPayTypeResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dealInfo;	//<ecc::deal::po::CDealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['dealInfo'] = $bs->popObject('\ecc\deal\po\DealPo');	//<ecc::deal::po::CDealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x63048811;
	}
}

namespace ecc\deal\ao;
class ModifyReceiveInfoReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数(版本>=0)
	private $recvInfoParams;	//<ecc::deal::bo::CEventParamsModifyRecvInfoBo> 修改参数(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
		$this->recvInfoParams = new \ecc\deal\bo\EventParamsModifyRecvInfoBo();	//<ecc::deal::bo::CEventParamsModifyRecvInfoBo>
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
			exit("ModifyReceiveInfoReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("ModifyReceiveInfoReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数
		$bs->pushObject($this->recvInfoParams,'\ecc\deal\bo\EventParamsModifyRecvInfoBo');	//<ecc::deal::bo::CEventParamsModifyRecvInfoBo> 修改参数
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041812;
	}
}

class ModifyReceiveInfoResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dealInfo;	//<ecc::deal::po::CDealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['dealInfo'] = $bs->popObject('\ecc\deal\po\DealPo');	//<ecc::deal::po::CDealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x63048812;
	}
}

namespace ecc\deal\ao;
class ModifyScoreReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数(版本>=0)
	private $scoreParams;	//<ecc::deal::bo::CEventParamsModifyScoreBo> 修改参数(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
		$this->scoreParams = new \ecc\deal\bo\EventParamsModifyScoreBo();	//<ecc::deal::bo::CEventParamsModifyScoreBo>
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
			exit("ModifyScoreReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("ModifyScoreReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数
		$bs->pushObject($this->scoreParams,'\ecc\deal\bo\EventParamsModifyScoreBo');	//<ecc::deal::bo::CEventParamsModifyScoreBo> 修改参数
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041815;
	}
}

class ModifyScoreResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dealInfo;	//<ecc::deal::po::CDealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['dealInfo'] = $bs->popObject('\ecc\deal\po\DealPo');	//<ecc::deal::po::CDealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x63048815;
	}
}

namespace ecc\deal\ao;
class ModifySeparateInvoiceReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数(版本>=0)
	private $modifyParams;	//<ecc::deal::bo::CSyncSeparateInvoiceBo> 修改发票参数(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
		$this->modifyParams = new \ecc\deal\bo\SyncSeparateInvoiceBo();	//<ecc::deal::bo::CSyncSeparateInvoiceBo>
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
			exit("ModifySeparateInvoiceReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("ModifySeparateInvoiceReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数
		$bs->pushObject($this->modifyParams,'\ecc\deal\bo\SyncSeparateInvoiceBo');	//<ecc::deal::bo::CSyncSeparateInvoiceBo> 修改发票参数
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041820;
	}
}

class ModifySeparateInvoiceResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dealInfo;	//<ecc::deal::po::CDealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['dealInfo'] = $bs->popObject('\ecc\deal\po\DealPo');	//<ecc::deal::po::CDealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x63048820;
	}
}

namespace ecc\deal\ao;
class ModifyValueAddedTaxInvoiceReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数(版本>=0)
	private $modifyParams;	//<ecc::deal::bo::CSyncValueAddedTaxInvoiceBo> 修改发票参数(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
		$this->modifyParams = new \ecc\deal\bo\SyncValueAddedTaxInvoiceBo();	//<ecc::deal::bo::CSyncValueAddedTaxInvoiceBo>
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
			exit("ModifyValueAddedTaxInvoiceReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("ModifyValueAddedTaxInvoiceReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数
		$bs->pushObject($this->modifyParams,'\ecc\deal\bo\SyncValueAddedTaxInvoiceBo');	//<ecc::deal::bo::CSyncValueAddedTaxInvoiceBo> 修改发票参数
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x6304181f;
	}
}

class ModifyValueAddedTaxInvoiceResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dealInfo;	//<ecc::deal::po::CDealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['dealInfo'] = $bs->popObject('\ecc\deal\po\DealPo');	//<ecc::deal::po::CDealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x6304881f;
	}
}

namespace ecc\deal\ao;
class NotifyBuyDealPaymentReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数(版本>=0)
	private $payParams;	//<ecc::deal::bo::CEventParamsPayBo> 支付通知事件参数(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
		$this->payParams = new \ecc\deal\bo\EventParamsPayBo();	//<ecc::deal::bo::CEventParamsPayBo>
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
			exit("NotifyBuyDealPaymentReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("NotifyBuyDealPaymentReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数
		$bs->pushObject($this->payParams,'\ecc\deal\bo\EventParamsPayBo');	//<ecc::deal::bo::CEventParamsPayBo> 支付通知事件参数
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041803;
	}
}

class NotifyBuyDealPaymentResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $bdealInfo;	//<ecc::deal::po::CBdealPo> 返回的交易单信息(版本>=0)
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
		$this->_arr_value['bdealInfo'] = $bs->popObject('\ecc\deal\po\BdealPo');	//<ecc::deal::po::CBdealPo> 返回的交易单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x63048803;
	}
}

namespace ecc\deal\ao;
class NotifyDealPaymentReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数(版本>=0)
	private $payParams;	//<ecc::deal::bo::CEventParamsPayBo> 支付通知事件参数(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
		$this->payParams = new \ecc\deal\bo\EventParamsPayBo();	//<ecc::deal::bo::CEventParamsPayBo>
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
			exit("NotifyDealPaymentReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("NotifyDealPaymentReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数
		$bs->pushObject($this->payParams,'\ecc\deal\bo\EventParamsPayBo');	//<ecc::deal::bo::CEventParamsPayBo> 支付通知事件参数
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041804;
	}
}

class NotifyDealPaymentResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dealInfo;	//<ecc::deal::po::CDealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['dealInfo'] = $bs->popObject('\ecc\deal\po\DealPo');	//<ecc::deal::po::CDealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x63048804;
	}
}

namespace ecc\deal\ao;
class OperateGoodsReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数(版本>=0)
	private $operGoodsParams;	//<ecc::deal::bo::CEventParamsOperGoodsBo> 增删商品参数(版本>=0)
	private $modifyPriceParams;	//<ecc::deal::bo::CEventParamsModifyDealPriceBo> 修改价格参数(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
		$this->operGoodsParams = new \ecc\deal\bo\EventParamsOperGoodsBo();	//<ecc::deal::bo::CEventParamsOperGoodsBo>
		$this->modifyPriceParams = new \ecc\deal\bo\EventParamsModifyDealPriceBo();	//<ecc::deal::bo::CEventParamsModifyDealPriceBo>
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
			exit("OperateGoodsReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("OperateGoodsReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数
		$bs->pushObject($this->operGoodsParams,'\ecc\deal\bo\EventParamsOperGoodsBo');	//<ecc::deal::bo::CEventParamsOperGoodsBo> 增删商品参数
		$bs->pushObject($this->modifyPriceParams,'\ecc\deal\bo\EventParamsModifyDealPriceBo');	//<ecc::deal::bo::CEventParamsModifyDealPriceBo> 修改价格参数
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041817;
	}
}

class OperateGoodsResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dealInfo;	//<ecc::deal::po::CDealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['dealInfo'] = $bs->popObject('\ecc\deal\po\DealPo');	//<ecc::deal::po::CDealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x63048817;
	}
}

namespace ecc\deal\ao;
class RefuseDealReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数(版本>=0)
	private $signParams;	//<ecc::deal::bo::CEventParamsCorpSignBo> 签收事件参数(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
		$this->signParams = new \ecc\deal\bo\EventParamsCorpSignBo();	//<ecc::deal::bo::CEventParamsCorpSignBo>
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
			exit("RefuseDealReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("RefuseDealReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数
		$bs->pushObject($this->signParams,'\ecc\deal\bo\EventParamsCorpSignBo');	//<ecc::deal::bo::CEventParamsCorpSignBo> 签收事件参数
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x6304180b;
	}
}

class RefuseDealResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dealInfo;	//<ecc::deal::po::CDealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['dealInfo'] = $bs->popObject('\ecc\deal\po\DealPo');	//<ecc::deal::po::CDealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x6304880b;
	}
}

namespace ecc\deal\ao;
class SyncDealActionReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础参数(版本>=0)
	private $actionParams;	//<ecc::deal::bo::CSyncDealActionBo> 订单操作信息(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
		$this->actionParams = new \ecc\deal\bo\SyncDealActionBo();	//<ecc::deal::bo::CSyncDealActionBo>
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
			exit("SyncDealActionReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("SyncDealActionReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础参数
		$bs->pushObject($this->actionParams,'\ecc\deal\bo\SyncDealActionBo');	//<ecc::deal::bo::CSyncDealActionBo> 订单操作信息
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041810;
	}
}

class SyncDealActionResp{
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
		return 0x63048810;
	}
}

namespace ecc\deal\ao;
class SyncNonMonetaryDealInfoReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数(版本>=0)
	private $dealInfoIn;	//<ecc::deal::po::CDealPo> 修改订单的内容，填充需要修改的字段及其UFlag，不修改的字段请勿填写(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
		$this->dealInfoIn = new \ecc\deal\po\DealPo();	//<ecc::deal::po::CDealPo>
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
			exit("SyncNonMonetaryDealInfoReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("SyncNonMonetaryDealInfoReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数
		$bs->pushObject($this->dealInfoIn,'\ecc\deal\po\DealPo');	//<ecc::deal::po::CDealPo> 修改订单的内容，填充需要修改的字段及其UFlag，不修改的字段请勿填写
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x6304180f;
	}
}

class SyncNonMonetaryDealInfoResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dealInfoUpdate;	//<ecc::deal::po::CDealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['dealInfoUpdate'] = $bs->popObject('\ecc\deal\po\DealPo');	//<ecc::deal::po::CDealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x6304880f;
	}
}

namespace ecc\deal\ao;
class SyncPickingReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数(版本>=0)
	private $pickParams;	//<ecc::deal::bo::CEventParamsPickBo> 签收事件参数(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
		$this->pickParams = new \ecc\deal\bo\EventParamsPickBo();	//<ecc::deal::bo::CEventParamsPickBo>
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
			exit("SyncPickingReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("SyncPickingReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数
		$bs->pushObject($this->pickParams,'\ecc\deal\bo\EventParamsPickBo');	//<ecc::deal::bo::CEventParamsPickBo> 签收事件参数
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x6304180c;
	}
}

class SyncPickingResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dealInfo;	//<ecc::deal::po::CDealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['dealInfo'] = $bs->popObject('\ecc\deal\po\DealPo');	//<ecc::deal::po::CDealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x6304880c;
	}
}

namespace ecc\deal\ao;
class SyncRefundReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $baseParams;	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数(版本>=0)
	private $refundParams;	//<ecc::deal::bo::CEventParamsCorpSyncRefundBo> 退款参数(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->baseParams = new \ecc\deal\bo\EventParamsBaseBo();	//<ecc::deal::bo::CEventParamsBaseBo>
		$this->refundParams = new \ecc\deal\bo\EventParamsCorpSyncRefundBo();	//<ecc::deal::bo::CEventParamsCorpSyncRefundBo>
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
			exit("SyncRefundReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("SyncRefundReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushObject($this->baseParams,'\ecc\deal\bo\EventParamsBaseBo');	//<ecc::deal::bo::CEventParamsBaseBo> 基础事件参数
		$bs->pushObject($this->refundParams,'\ecc\deal\bo\EventParamsCorpSyncRefundBo');	//<ecc::deal::bo::CEventParamsCorpSyncRefundBo> 退款参数
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x6304180e;
	}
}

class SyncRefundResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dealInfo;	//<ecc::deal::po::CDealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['dealInfo'] = $bs->popObject('\ecc\deal\po\DealPo');	//<ecc::deal::po::CDealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x6304880e;
	}
}

namespace ecc\deal\ao;
class SysQueryBdealReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $infoType;	//<uint32_t> 信息类型(版本>=0)
	private $historyFlag;	//<uint8_t> 历史订单标识，0当前订单 1历史订单(版本>=0)
	private $version;	//<uint32_t> 需要返回的数据版本(版本>=0)
	private $queryFilter;	//<ecc::deal::bo::CDealQueryBo> 查询条件(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->infoType = 0;	//<uint32_t>
		$this->historyFlag = 0;	//<uint8_t>
		$this->version = 0;	//<uint32_t>
		$this->queryFilter = new \ecc\deal\bo\DealQueryBo();	//<ecc::deal::bo::CDealQueryBo>
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
			exit("SysQueryBdealReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("SysQueryBdealReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushUint32_t($this->infoType);	//<uint32_t> 信息类型
		$bs->pushUint8_t($this->historyFlag);	//<uint8_t> 历史订单标识，0当前订单 1历史订单
		$bs->pushUint32_t($this->version);	//<uint32_t> 需要返回的数据版本
		$bs->pushObject($this->queryFilter,'\ecc\deal\bo\DealQueryBo');	//<ecc::deal::bo::CDealQueryBo> 查询条件
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x6304181b;
	}
}

class SysQueryBdealResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $bdealInfo;	//<ecc::deal::po::CBdealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['bdealInfo'] = $bs->popObject('\ecc\deal\po\BdealPo');	//<ecc::deal::po::CBdealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x6304881b;
	}
}

namespace ecc\deal\ao;
class SysQueryDealReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $infoType;	//<uint32_t> 信息类型(版本>=0)
	private $historyFlag;	//<uint8_t> 历史订单标识，0当前订单 1历史订单(版本>=0)
	private $version;	//<uint32_t> 需要返回的数据版本(版本>=0)
	private $queryFilter;	//<ecc::deal::bo::CDealQueryBo> 查询条件(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->infoType = 0;	//<uint32_t>
		$this->historyFlag = 0;	//<uint8_t>
		$this->version = 0;	//<uint32_t>
		$this->queryFilter = new \ecc\deal\bo\DealQueryBo();	//<ecc::deal::bo::CDealQueryBo>
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
			exit("SysQueryDealReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("SysQueryDealReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushUint32_t($this->infoType);	//<uint32_t> 信息类型
		$bs->pushUint8_t($this->historyFlag);	//<uint8_t> 历史订单标识，0当前订单 1历史订单
		$bs->pushUint32_t($this->version);	//<uint32_t> 需要返回的数据版本
		$bs->pushObject($this->queryFilter,'\ecc\deal\bo\DealQueryBo');	//<ecc::deal::bo::CDealQueryBo> 查询条件
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041819;
	}
}

class SysQueryDealResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dealInfo;	//<ecc::deal::po::CDealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['dealInfo'] = $bs->popObject('\ecc\deal\po\DealPo');	//<ecc::deal::po::CDealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x63048819;
	}
}

namespace ecc\deal\ao;
class UserQueryBdealReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $infoType;	//<uint32_t> 信息类型(版本>=0)
	private $historyFlag;	//<uint8_t> 历史订单标识，0当前订单 1历史订单(版本>=0)
	private $version;	//<uint32_t> 需要返回的数据版本(版本>=0)
	private $queryFilter;	//<ecc::deal::bo::CDealQueryBo> 查询条件(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->infoType = 0;	//<uint32_t>
		$this->historyFlag = 0;	//<uint8_t>
		$this->version = 0;	//<uint32_t>
		$this->queryFilter = new \ecc\deal\bo\DealQueryBo();	//<ecc::deal::bo::CDealQueryBo>
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
			exit("UserQueryBdealReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("UserQueryBdealReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushUint32_t($this->infoType);	//<uint32_t> 信息类型
		$bs->pushUint8_t($this->historyFlag);	//<uint8_t> 历史订单标识，0当前订单 1历史订单
		$bs->pushUint32_t($this->version);	//<uint32_t> 需要返回的数据版本
		$bs->pushObject($this->queryFilter,'\ecc\deal\bo\DealQueryBo');	//<ecc::deal::bo::CDealQueryBo> 查询条件
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x6304181a;
	}
}

class UserQueryBdealResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $bdealInfo;	//<ecc::deal::po::CBdealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['bdealInfo'] = $bs->popObject('\ecc\deal\po\BdealPo');	//<ecc::deal::po::CBdealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x6304881a;
	}
}

namespace ecc\deal\ao;
class UserQueryDealReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 请求来源(版本>=0)
	private $machineKey;	//<std::string> 用户的MachineKey(版本>=0)
	private $verifyToken;	//<std::string> 订单系统分配的校验token(版本>=0)
	private $infoType;	//<uint32_t> 信息类型(版本>=0)
	private $historyFlag;	//<uint8_t> 历史订单标识，0当前订单 1历史订单(版本>=0)
	private $version;	//<uint32_t> 需要返回的数据版本(版本>=0)
	private $queryFilter;	//<ecc::deal::bo::CDealQueryBo> 查询条件(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->verifyToken = "";	//<std::string>
		$this->infoType = 0;	//<uint32_t>
		$this->historyFlag = 0;	//<uint8_t>
		$this->version = 0;	//<uint32_t>
		$this->queryFilter = new \ecc\deal\bo\DealQueryBo();	//<ecc::deal::bo::CDealQueryBo>
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
			exit("UserQueryDealReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("UserQueryDealReq\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户的MachineKey
		$bs->pushString($this->verifyToken);	//<std::string> 订单系统分配的校验token
		$bs->pushUint32_t($this->infoType);	//<uint32_t> 信息类型
		$bs->pushUint8_t($this->historyFlag);	//<uint8_t> 历史订单标识，0当前订单 1历史订单
		$bs->pushUint32_t($this->version);	//<uint32_t> 需要返回的数据版本
		$bs->pushObject($this->queryFilter,'\ecc\deal\bo\DealQueryBo');	//<ecc::deal::bo::CDealQueryBo> 查询条件
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x63041818;
	}
}

class UserQueryDealResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $dealInfo;	//<ecc::deal::po::CDealPo> 返回的订单信息(版本>=0)
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
		$this->_arr_value['dealInfo'] = $bs->popObject('\ecc\deal\po\DealPo');	//<ecc::deal::po::CDealPo> 返回的订单信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x63048818;
	}
}
