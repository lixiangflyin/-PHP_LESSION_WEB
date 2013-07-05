<?php
// source idl: com.b2b2c.account.idl.PointsAccountAo.java
namespace b2b2c;
require_once "pointsaccountao_php5_xxoo.php";

namespace b2b2c\account\ao;
class GetPointsAccountReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，保留(版本>=0)
	private $icsonUid;	//<uint64_t> 易迅id, 暂支持32位(版本>=0)
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
			exit("GetPointsAccountReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetPointsAccount\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，保留
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅id, 暂支持32位
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x81EA1801;
	}
}

class GetPointsAccountResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $pointsAccountPo;	//<b2b2c::account::po::CPointsAccountPo> 积分总账信息(版本>=0)
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
		$this->_arr_value['pointsAccountPo'] = $bs->popObject('\b2b2c\account\po\PointsAccountPo');	//<b2b2c::account::po::CPointsAccountPo> 积分总账信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0x81EA8801;
	}
}

namespace b2b2c\account\ao;
class GetPointsAccountDetailReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需(版本>=0)
	private $source;	//<std::string> 调用来源，必需(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，保留(版本>=0)
	private $pointsDetailFilterPo;	//<b2b2c::account::po::CPointsAccountDetailFilterPo> 积分明细查询过滤器(版本>=0)
	private $inReserve;	//<std::string> 输入保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->pointsDetailFilterPo = new \b2b2c\account\po\PointsAccountDetailFilterPo();	//<b2b2c::account::po::CPointsAccountDetailFilterPo>
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
			exit("GetPointsAccountDetailReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetPointsAccountDetail\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需
		$bs->pushString($this->source);	//<std::string> 调用来源，必需
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，保留
		$bs->pushObject($this->pointsDetailFilterPo,'\b2b2c\account\po\PointsAccountDetailFilterPo');	//<b2b2c::account::po::CPointsAccountDetailFilterPo> 积分明细查询过滤器
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x81EA1802;
	}
}

class GetPointsAccountDetailResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $pointsAccountDetailPoList;	//<b2b2c::account::po::CPointsAccountDetailPoList> 积分明细列表(版本>=0)
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
		$this->_arr_value['pointsAccountDetailPoList'] = $bs->popObject('\b2b2c\account\po\PointsAccountDetailPoList');	//<b2b2c::account::po::CPointsAccountDetailPoList> 积分明细列表
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0x81EA8802;
	}
}

namespace b2b2c\account\ao;
class PointsDeductReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需  (版本>=0)
	private $source;	//<std::string> 调用来源，必需  (版本>=0)
	private $sceneId;	//<uint32_t> 场景id，保留  (版本>=0)
	private $pointsVerifyPo;	//<b2b2c::account::po::CPointsAccessVerifyPo> 积分操作安全校验信息PO，必需  (版本>=0)
	private $pointsOutPo;	//<b2b2c::account::po::CPointsOutPo> 积分扣减Po，必需  (版本>=0)
	private $inReserve;	//<std::string> 输入保留字  (版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->pointsVerifyPo = new \b2b2c\account\po\PointsAccessVerifyPo();	//<b2b2c::account::po::CPointsAccessVerifyPo>
		$this->pointsOutPo = new \b2b2c\account\po\PointsOutPo();	//<b2b2c::account::po::CPointsOutPo>
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
			exit("PointsDeductReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("PointsDeduct\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需  
		$bs->pushString($this->source);	//<std::string> 调用来源，必需  
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，保留  
		$bs->pushObject($this->pointsVerifyPo,'\b2b2c\account\po\PointsAccessVerifyPo');	//<b2b2c::account::po::CPointsAccessVerifyPo> 积分操作安全校验信息PO，必需  
		$bs->pushObject($this->pointsOutPo,'\b2b2c\account\po\PointsOutPo');	//<b2b2c::account::po::CPointsOutPo> 积分扣减Po，必需  
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字  

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x81EA1804;
	}
}

class PointsDeductResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $promotionPoints;	//<uint32_t> 扣减促销积分值(版本>=0)
	private $cashPoints;	//<uint32_t> 扣减现金积分值(版本>=0)
	private $errmsg;	//<std::string> 错误提示信息  (版本>=0)
	private $outReserve;	//<std::string> 输出保留字  (版本>=0)

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
		$this->_arr_value['promotionPoints'] = $bs->popUint32_t();	//<uint32_t> 扣减促销积分值
		$this->_arr_value['cashPoints'] = $bs->popUint32_t();	//<uint32_t> 扣减现金积分值
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息  
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字  

	}

	function getCmdId() {
		return 0x81EA8804;
	}
}

namespace b2b2c\account\ao;
class PointsDeductV2Req{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需  (版本>=0)
	private $source;	//<std::string> 调用来源，必需  (版本>=0)
	private $sceneId;	//<uint32_t> 场景id，保留  (版本>=0)
	private $pointsVerifyPo;	//<b2b2c::account::po::CPointsAccessVerifyPo> 积分操作安全校验信息PO，必需  (版本>=0)
	private $pointsOutReqPo;	//<b2b2c::account::po::CPointsOutReqPo> 积分扣减Po，必需  (版本>=0)
	private $inReserve;	//<std::string> 输入保留字  (版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->pointsVerifyPo = new \b2b2c\account\po\PointsAccessVerifyPo();	//<b2b2c::account::po::CPointsAccessVerifyPo>
		$this->pointsOutReqPo = new \b2b2c\account\po\PointsOutReqPo();	//<b2b2c::account::po::CPointsOutReqPo>
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
			exit("PointsDeductV2Req\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("PointsDeductV2\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需  
		$bs->pushString($this->source);	//<std::string> 调用来源，必需  
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，保留  
		$bs->pushObject($this->pointsVerifyPo,'\b2b2c\account\po\PointsAccessVerifyPo');	//<b2b2c::account::po::CPointsAccessVerifyPo> 积分操作安全校验信息PO，必需  
		$bs->pushObject($this->pointsOutReqPo,'\b2b2c\account\po\PointsOutReqPo');	//<b2b2c::account::po::CPointsOutReqPo> 积分扣减Po，必需  
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字  

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x81EA1805;
	}
}

class PointsDeductV2Resp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $pointsOutRespPo;	//<b2b2c::account::po::CPointsOutRespPo> 积分扣减Po返回值(版本>=0)
	private $errmsg;	//<std::string> 错误提示信息  (版本>=0)
	private $outReserve;	//<std::string> 输出保留字  (版本>=0)

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
		$this->_arr_value['pointsOutRespPo'] = $bs->popObject('\b2b2c\account\po\PointsOutRespPo');	//<b2b2c::account::po::CPointsOutRespPo> 积分扣减Po返回值
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误提示信息  
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字  

	}

	function getCmdId() {
		return 0x81EA8805;
	}
}

namespace b2b2c\account\ao;
class PointsDeliverReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必需  (版本>=0)
	private $source;	//<std::string> 调用来源，必需  (版本>=0)
	private $sceneId;	//<uint32_t> 场景id， 0:促销积分为普通发放 (默认) 1:促销积分为礼品卡发放  (版本>=0)
	private $pointsVerifyPo;	//<b2b2c::account::po::CPointsAccessVerifyPo> 积分操作安全校验信息PO，必需  (版本>=0)
	private $pointsInPo;	//<b2b2c::account::po::CPointsInPo> 积分发放Po，必需  (版本>=0)
	private $inReserve;	//<std::string> 输入保留字段(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->pointsVerifyPo = new \b2b2c\account\po\PointsAccessVerifyPo();	//<b2b2c::account::po::CPointsAccessVerifyPo>
		$this->pointsInPo = new \b2b2c\account\po\PointsInPo();	//<b2b2c::account::po::CPointsInPo>
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
			exit("PointsDeliverReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("PointsDeliver\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必需  
		$bs->pushString($this->source);	//<std::string> 调用来源，必需  
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id， 0:促销积分为普通发放 (默认) 1:促销积分为礼品卡发放  
		$bs->pushObject($this->pointsVerifyPo,'\b2b2c\account\po\PointsAccessVerifyPo');	//<b2b2c::account::po::CPointsAccessVerifyPo> 积分操作安全校验信息PO，必需  
		$bs->pushObject($this->pointsInPo,'\b2b2c\account\po\PointsInPo');	//<b2b2c::account::po::CPointsInPo> 积分发放Po，必需  
		$bs->pushString($this->inReserve);	//<std::string> 输入保留字段

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x81EA1803;
	}
}

class PointsDeliverResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误提示信息  (版本>=0)
	private $outReserve;	//<std::string> 输出保留字  (版本>=0)

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
		return 0x81EA8803;
	}
}
