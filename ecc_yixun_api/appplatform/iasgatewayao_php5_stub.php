<?php
// source idl: com.ecc.deal.idl.IasGatewayAo.java
namespace ecc;
require_once "iasgatewayao_php5_xxoo.php";

namespace ecc\deal\ao;
class CheckOnlinePaymentReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 来源(版本>=0)
	private $businessDealId;	//<std::string> erp订单号(版本>=0)
	private $tradeNo;	//<std::string> 交易流水号(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->businessDealId = "";	//<std::string>
		$this->tradeNo = "";	//<std::string>
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
			exit("CheckOnlinePaymentReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("CheckOnlinePayment\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->source);	//<std::string> 来源
		$bs->pushString($this->businessDealId);	//<std::string> erp订单号
		$bs->pushString($this->tradeNo);	//<std::string> 交易流水号
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x632e1802;
	}
}

class CheckOnlinePaymentResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $isSync;	//<bool> 是否已经同步至IAS(版本>=0)
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
		$this->_arr_value['isSync'] = $bs->popBool();	//<bool> 是否已经同步至IAS
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['reserveOut'] = $bs->popString();	//<std::string> 输出预留参数

	}

	function getCmdId() {
		return 0x632e8802;
	}
}

namespace ecc\deal\ao;
class OnlinePayNotifyReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $source;	//<std::string> 来源(版本>=0)
	private $bdealParams;	//<ecc::deal::po::COnlinePayBdealParams> 支付交易单参数(版本>=0)
	private $reserveIn;	//<std::string> 接口预留参数(版本>=0)

	function __construct() {
		$this->source = "";	//<std::string>
		$this->bdealParams = new \ecc\deal\po\OnlinePayBdealParams();	//<ecc::deal::po::COnlinePayBdealParams>
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
			exit("OnlinePayNotifyReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("OnlinePayNotify\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->source);	//<std::string> 来源
		$bs->pushObject($this->bdealParams,'\ecc\deal\po\OnlinePayBdealParams');	//<ecc::deal::po::COnlinePayBdealParams> 支付交易单参数
		$bs->pushString($this->reserveIn);	//<std::string> 接口预留参数

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x632e1801;
	}
}

class OnlinePayNotifyResp{
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
		return 0x632e8801;
	}
}
