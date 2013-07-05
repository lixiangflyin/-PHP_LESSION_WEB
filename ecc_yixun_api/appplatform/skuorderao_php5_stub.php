<?php
// source idl: com.b2b2c.skuorder.idl.SkuOrderAo.java
namespace b2b2c;
require_once "skuorderao_php5_xxoo.php";

namespace b2b2c\skuorder\ao;
class BatchLockItemReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $source;	//<std::string> 调用来源，必填(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，必填(版本>=0)
	private $lockItemPo;	//<b2b2c::skuorder::po::CLockItemPo> 锁定库存po(版本>=0)
	private $inLocalkey;	//<std::string> 异步调用接口返回，确认所用请求参数（如购物车等），根据需要选填(版本>=0)
	private $inReserve;	//<std::string> 请求保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->lockItemPo = new \b2b2c\skuorder\po\LockItemPo();	//<b2b2c::skuorder::po::CLockItemPo>
		$this->inLocalkey = "";	//<std::string>
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
			exit("BatchLockItemReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("BatchLockItem\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->source);	//<std::string> 调用来源，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，必填
		$bs->pushObject($this->lockItemPo,'\b2b2c\skuorder\po\LockItemPo');	//<b2b2c::skuorder::po::CLockItemPo> 锁定库存po
		$bs->pushString($this->inLocalkey);	//<std::string> 异步调用接口返回，确认所用请求参数（如购物车等），根据需要选填
		$bs->pushString($this->inReserve);	//<std::string> 请求保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA092180A;
	}
}

class BatchLockItemResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $outLocalkey;	//<std::string> 异步调用接口返回，确认所用返回参数（如购物车），根据需要选填(版本>=0)
	private $resultLockItemPo;	//<b2b2c::skuorder::po::CResultLockItemPo> 商品锁定后返回的po信息(版本>=0)
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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outLocalkey'] = $bs->popString();	//<std::string> 异步调用接口返回，确认所用返回参数（如购物车），根据需要选填
		$this->_arr_value['resultLockItemPo'] = $bs->popObject('\b2b2c\skuorder\po\ResultLockItemPo');	//<b2b2c::skuorder::po::CResultLockItemPo> 商品锁定后返回的po信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA092880A;
	}
}

namespace b2b2c\skuorder\ao;
class BatchUnlockItemReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $source;	//<std::string> 调用来源，必填(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，必填(版本>=0)
	private $unlockItemPo;	//<std::vector<b2b2c::skuorder::po::CUnlockItemPo> > 解锁商品po(版本>=0)
	private $inLocalkey;	//<std::string> 异步调用接口返回，确认所用请求参数（如购物车等），根据需要选填(版本>=0)
	private $inReserve;	//<std::string> 请求保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->unlockItemPo = new \stl_vector2('\b2b2c\skuorder\po\UnlockItemPo');	//<std::vector<b2b2c::skuorder::po::CUnlockItemPo> >
		$this->inLocalkey = "";	//<std::string>
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
			exit("BatchUnlockItemReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("BatchUnlockItem\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->source);	//<std::string> 调用来源，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，必填
		$bs->pushObject($this->unlockItemPo,'stl_vector');	//<std::vector<b2b2c::skuorder::po::CUnlockItemPo> > 解锁商品po
		$bs->pushString($this->inLocalkey);	//<std::string> 异步调用接口返回，确认所用请求参数（如购物车等），根据需要选填
		$bs->pushString($this->inReserve);	//<std::string> 请求保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA092180B;
	}
}

class BatchUnlockItemResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $resultUnlockItemPo;	//<std::vector<b2b2c::skuorder::po::CResultUnlockItemPo> > 解锁返回po(版本>=0)
	private $outLocalkey;	//<std::string> 异步调用接口返回，确认所用返回参数（如购物车），根据需要选填(版本>=0)
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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['resultUnlockItemPo'] = $bs->popObject('stl_vector<\b2b2c\skuorder\po\ResultUnlockItemPo>');	//<std::vector<b2b2c::skuorder::po::CResultUnlockItemPo> > 解锁返回po
		$this->_arr_value['outLocalkey'] = $bs->popString();	//<std::string> 异步调用接口返回，确认所用返回参数（如购物车），根据需要选填
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA092880B;
	}
}

namespace b2b2c\skuorder\ao;
class DecreaseItemReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $source;	//<std::string> 调用来源，必填(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，必填(版本>=0)
	private $fixupInfoPo;	//<b2b2c::skuorder::po::CFixupInfoPo> 商品出价信息，必填(版本>=0)
	private $inLocalkey;	//<std::string> 异步调用接口返回，确认所用请求参数（如购物车等），根据需要选填(版本>=0)
	private $inReserve;	//<std::string> 请求保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->fixupInfoPo = new \b2b2c\skuorder\po\FixupInfoPo();	//<b2b2c::skuorder::po::CFixupInfoPo>
		$this->inLocalkey = "";	//<std::string>
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
			exit("DecreaseItemReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("DecreaseItem\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->source);	//<std::string> 调用来源，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，必填
		$bs->pushObject($this->fixupInfoPo,'\b2b2c\skuorder\po\FixupInfoPo');	//<b2b2c::skuorder::po::CFixupInfoPo> 商品出价信息，必填
		$bs->pushString($this->inLocalkey);	//<std::string> 异步调用接口返回，确认所用请求参数（如购物车等），根据需要选填
		$bs->pushString($this->inReserve);	//<std::string> 请求保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0921802;
	}
}

class DecreaseItemResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $outLocalkey;	//<std::string> 异步调用接口返回，确认所用返回参数（如购物车），根据需要选填(版本>=0)
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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outLocalkey'] = $bs->popString();	//<std::string> 异步调用接口返回，确认所用返回参数（如购物车），根据需要选填
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0928802;
	}
}

namespace b2b2c\skuorder\ao;
class DecreaseProductReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $source;	//<std::string> 调用来源，必填(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，必填(版本>=0)
	private $optionId;	//<uint32_t> 选项，可选(版本>=0)
	private $fixupInfoPo;	//<b2b2c::skuorder::po::COmsFixupInfoPo> 实扣请求 ,必填(版本>=0)
	private $eventPo;	//<b2b2c::skuorder::po::CEvent4AppPo> 事务单，必填(版本>=0)
	private $inReserve;	//<std::string> 请求保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->optionId = 0;	//<uint32_t>
		$this->fixupInfoPo = new \b2b2c\skuorder\po\OmsFixupInfoPo();	//<b2b2c::skuorder::po::COmsFixupInfoPo>
		$this->eventPo = new \b2b2c\skuorder\po\Event4AppPo();	//<b2b2c::skuorder::po::CEvent4AppPo>
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
			exit("DecreaseProductReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("DecreaseProduct\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->source);	//<std::string> 调用来源，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，必填
		$bs->pushUint32_t($this->optionId);	//<uint32_t> 选项，可选
		$bs->pushObject($this->fixupInfoPo,'\b2b2c\skuorder\po\OmsFixupInfoPo');	//<b2b2c::skuorder::po::COmsFixupInfoPo> 实扣请求 ,必填
		$bs->pushObject($this->eventPo,'\b2b2c\skuorder\po\Event4AppPo');	//<b2b2c::skuorder::po::CEvent4AppPo> 事务单，必填
		$bs->pushString($this->inReserve);	//<std::string> 请求保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA092180E;
	}
}

class DecreaseProductResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA092880E;
	}
}

namespace b2b2c\skuorder\ao;
class LockItemByDealNeedReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $source;	//<std::string> 调用来源，必填(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，必填(版本>=0)
	private $fixupInfoPo;	//<b2b2c::skuorder::po::CFixupInfoPo> 商品出价信息，必填(版本>=0)
	private $inLocalkey;	//<std::string> 异步调用接口返回，确认所用请求参数（如购物车等），根据需要选填(版本>=0)
	private $inReserve;	//<std::string> 请求保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->fixupInfoPo = new \b2b2c\skuorder\po\FixupInfoPo();	//<b2b2c::skuorder::po::CFixupInfoPo>
		$this->inLocalkey = "";	//<std::string>
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
			exit("LockItemByDealNeedReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("LockItemByDealNeed\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->source);	//<std::string> 调用来源，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，必填
		$bs->pushObject($this->fixupInfoPo,'\b2b2c\skuorder\po\FixupInfoPo');	//<b2b2c::skuorder::po::CFixupInfoPo> 商品出价信息，必填
		$bs->pushString($this->inLocalkey);	//<std::string> 异步调用接口返回，确认所用请求参数（如购物车等），根据需要选填
		$bs->pushString($this->inReserve);	//<std::string> 请求保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0921808;
	}
}

class LockItemByDealNeedResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $outLocalkey;	//<std::string> 异步调用接口返回，确认所用返回参数（如购物车），根据需要选填(版本>=0)
	private $fixupInfoRspPo;	//<b2b2c::skuorder::po::CFixupInfoRspPo> 根据订单等业务类型需要，商品锁定生成出价记录成功后的返回参数信息(版本>=0)
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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outLocalkey'] = $bs->popString();	//<std::string> 异步调用接口返回，确认所用返回参数（如购物车），根据需要选填
		$this->_arr_value['fixupInfoRspPo'] = $bs->popObject('\b2b2c\skuorder\po\FixupInfoRspPo');	//<b2b2c::skuorder::po::CFixupInfoRspPo> 根据订单等业务类型需要，商品锁定生成出价记录成功后的返回参数信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0928808;
	}
}

namespace b2b2c\skuorder\ao;
class LockProductReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $source;	//<std::string> 调用来源，必填(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，必填(版本>=0)
	private $optionId;	//<uint32_t> 选项，可选(版本>=0)
	private $lockType;	//<uint32_t> 非活动库存锁定填0(版本>=0)
	private $fixupInfoPo;	//<b2b2c::skuorder::po::COmsFixupInfoPo> 锁定请求 ,必填(版本>=0)
	private $eventPo;	//<b2b2c::skuorder::po::CEvent4AppPo> 事务单，必填(版本>=0)
	private $inReserve;	//<std::string> 请求保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->optionId = 0;	//<uint32_t>
		$this->lockType = 0;	//<uint32_t>
		$this->fixupInfoPo = new \b2b2c\skuorder\po\OmsFixupInfoPo();	//<b2b2c::skuorder::po::COmsFixupInfoPo>
		$this->eventPo = new \b2b2c\skuorder\po\Event4AppPo();	//<b2b2c::skuorder::po::CEvent4AppPo>
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
			exit("LockProductReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("LockProduct\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->source);	//<std::string> 调用来源，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，必填
		$bs->pushUint32_t($this->optionId);	//<uint32_t> 选项，可选
		$bs->pushUint32_t($this->lockType);	//<uint32_t> 非活动库存锁定填0
		$bs->pushObject($this->fixupInfoPo,'\b2b2c\skuorder\po\OmsFixupInfoPo');	//<b2b2c::skuorder::po::COmsFixupInfoPo> 锁定请求 ,必填
		$bs->pushObject($this->eventPo,'\b2b2c\skuorder\po\Event4AppPo');	//<b2b2c::skuorder::po::CEvent4AppPo> 事务单，必填
		$bs->pushString($this->inReserve);	//<std::string> 请求保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA092180C;
	}
}

class LockProductResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $outFixupInfoPo;	//<b2b2c::skuorder::po::COmsFixupInfoPo>  锁定返回 (版本>=0)
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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outFixupInfoPo'] = $bs->popObject('\b2b2c\skuorder\po\OmsFixupInfoPo');	//<b2b2c::skuorder::po::COmsFixupInfoPo>  锁定返回 
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA092880C;
	}
}

namespace b2b2c\skuorder\ao;
class ModifyLockNumReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $source;	//<std::string> 调用来源，必填(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，必填(版本>=0)
	private $optionId;	//<uint32_t> 选项，可选(版本>=0)
	private $fixupInfoPo;	//<b2b2c::skuorder::po::COmsFixupInfoPo> 修改订单锁定请求 ,必填(版本>=0)
	private $eventPo;	//<b2b2c::skuorder::po::CEvent4AppPo> 事务单，必填(版本>=0)
	private $inReserve;	//<std::string> 请求保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->optionId = 0;	//<uint32_t>
		$this->fixupInfoPo = new \b2b2c\skuorder\po\OmsFixupInfoPo();	//<b2b2c::skuorder::po::COmsFixupInfoPo>
		$this->eventPo = new \b2b2c\skuorder\po\Event4AppPo();	//<b2b2c::skuorder::po::CEvent4AppPo>
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
			exit("ModifyLockNumReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("ModifyLockNum\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->source);	//<std::string> 调用来源，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，必填
		$bs->pushUint32_t($this->optionId);	//<uint32_t> 选项，可选
		$bs->pushObject($this->fixupInfoPo,'\b2b2c\skuorder\po\OmsFixupInfoPo');	//<b2b2c::skuorder::po::COmsFixupInfoPo> 修改订单锁定请求 ,必填
		$bs->pushObject($this->eventPo,'\b2b2c\skuorder\po\Event4AppPo');	//<b2b2c::skuorder::po::CEvent4AppPo> 事务单，必填
		$bs->pushString($this->inReserve);	//<std::string> 请求保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0921810;
	}
}

class ModifyLockNumResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $outFixupInfoPo;	//<b2b2c::skuorder::po::COmsFixupInfoPo>  修改订单锁定返回 (版本>=0)
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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outFixupInfoPo'] = $bs->popObject('\b2b2c\skuorder\po\OmsFixupInfoPo');	//<b2b2c::skuorder::po::COmsFixupInfoPo>  修改订单锁定返回 
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0928810;
	}
}

namespace b2b2c\skuorder\ao;
class PayLockItemReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $source;	//<std::string> 调用来源，必填(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，必填(版本>=0)
	private $fixupInfoPo;	//<b2b2c::skuorder::po::CFixupInfoPo> 商品出价信息，必填(版本>=0)
	private $inLocalkey;	//<std::string> 异步调用接口返回，确认所用请求参数（如购物车等），根据需要选填(版本>=0)
	private $inReserve;	//<std::string> 请求保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->fixupInfoPo = new \b2b2c\skuorder\po\FixupInfoPo();	//<b2b2c::skuorder::po::CFixupInfoPo>
		$this->inLocalkey = "";	//<std::string>
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
			exit("PayLockItemReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("PayLockItem\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->source);	//<std::string> 调用来源，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，必填
		$bs->pushObject($this->fixupInfoPo,'\b2b2c\skuorder\po\FixupInfoPo');	//<b2b2c::skuorder::po::CFixupInfoPo> 商品出价信息，必填
		$bs->pushString($this->inLocalkey);	//<std::string> 异步调用接口返回，确认所用请求参数（如购物车等），根据需要选填
		$bs->pushString($this->inReserve);	//<std::string> 请求保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0921807;
	}
}

class PayLockItemResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $outLocalkey;	//<std::string> 异步调用接口返回，确认所用返回参数（如购物车），根据需要选填(版本>=0)
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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outLocalkey'] = $bs->popString();	//<std::string> 异步调用接口返回，确认所用返回参数（如购物车），根据需要选填
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0928807;
	}
}

namespace b2b2c\skuorder\ao;
class RealLockReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $source;	//<std::string> 调用来源，必填(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，必填(版本>=0)
	private $optionId;	//<uint32_t> 选项，可选(版本>=0)
	private $fixupInfoPo;	//<b2b2c::skuorder::po::COmsFixupInfoPo> 转移锁定请求 ,必填(版本>=0)
	private $eventPo;	//<b2b2c::skuorder::po::CEvent4AppPo> 事务单，必填(版本>=0)
	private $inReserve;	//<std::string> 请求保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->optionId = 0;	//<uint32_t>
		$this->fixupInfoPo = new \b2b2c\skuorder\po\OmsFixupInfoPo();	//<b2b2c::skuorder::po::COmsFixupInfoPo>
		$this->eventPo = new \b2b2c\skuorder\po\Event4AppPo();	//<b2b2c::skuorder::po::CEvent4AppPo>
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
			exit("RealLockReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("RealLock\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->source);	//<std::string> 调用来源，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，必填
		$bs->pushUint32_t($this->optionId);	//<uint32_t> 选项，可选
		$bs->pushObject($this->fixupInfoPo,'\b2b2c\skuorder\po\OmsFixupInfoPo');	//<b2b2c::skuorder::po::COmsFixupInfoPo> 转移锁定请求 ,必填
		$bs->pushObject($this->eventPo,'\b2b2c\skuorder\po\Event4AppPo');	//<b2b2c::skuorder::po::CEvent4AppPo> 事务单，必填
		$bs->pushString($this->inReserve);	//<std::string> 请求保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA092180F;
	}
}

class RealLockResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $outFixupInfoPo;	//<b2b2c::skuorder::po::COmsFixupInfoPo>  转移锁定返回 (版本>=0)
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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outFixupInfoPo'] = $bs->popObject('\b2b2c\skuorder\po\OmsFixupInfoPo');	//<b2b2c::skuorder::po::COmsFixupInfoPo>  转移锁定返回 
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA092880F;
	}
}

namespace b2b2c\skuorder\ao;
class SuccessiveDecreaseItemReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $source;	//<std::string> 调用来源，必填(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，必填(版本>=0)
	private $option;	//<uint64_t> 选项,option =0 时，表示订单调用，需要验证前次扣减序列号；option =1 时，表示fixup daemon后台的对账修复数据调用，此时不必检查前次扣减序列号；(版本>=0)
	private $fixupInfoPo;	//<b2b2c::skuorder::po::CFixupInfoPo> 商品出价信息，必填(版本>=0)
	private $changedDirection;	//<uint32_t> 逐次扣减的方向，必填，参考modify_stocknum_direction定义(版本>=0)
	private $inLocalkey;	//<std::string> 异步调用接口返回，确认所用请求参数（如购物车等），根据需要选填(版本>=0)
	private $inReserve;	//<std::string> 请求保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->option = 0;	//<uint64_t>
		$this->fixupInfoPo = new \b2b2c\skuorder\po\FixupInfoPo();	//<b2b2c::skuorder::po::CFixupInfoPo>
		$this->changedDirection = 0;	//<uint32_t>
		$this->inLocalkey = "";	//<std::string>
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
			exit("SuccessiveDecreaseItemReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("SuccessiveDecreaseItem\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->source);	//<std::string> 调用来源，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，必填
		$bs->pushUint64_t($this->option);	//<uint64_t> 选项,option =0 时，表示订单调用，需要验证前次扣减序列号；option =1 时，表示fixup daemon后台的对账修复数据调用，此时不必检查前次扣减序列号；
		$bs->pushObject($this->fixupInfoPo,'\b2b2c\skuorder\po\FixupInfoPo');	//<b2b2c::skuorder::po::CFixupInfoPo> 商品出价信息，必填
		$bs->pushUint32_t($this->changedDirection);	//<uint32_t> 逐次扣减的方向，必填，参考modify_stocknum_direction定义
		$bs->pushString($this->inLocalkey);	//<std::string> 异步调用接口返回，确认所用请求参数（如购物车等），根据需要选填
		$bs->pushString($this->inReserve);	//<std::string> 请求保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0921809;
	}
}

class SuccessiveDecreaseItemResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $outLocalkey;	//<std::string> 异步调用接口返回，确认所用返回参数（如购物车），根据需要选填(版本>=0)
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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outLocalkey'] = $bs->popString();	//<std::string> 异步调用接口返回，确认所用返回参数（如购物车），根据需要选填
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0928809;
	}
}

namespace b2b2c\skuorder\ao;
class UnlockItemReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $source;	//<std::string> 调用来源，必填(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，必填(版本>=0)
	private $fixupInfoPo;	//<b2b2c::skuorder::po::CFixupInfoPo> 商品出价信息，必填(版本>=0)
	private $inLocalkey;	//<std::string> 异步调用接口返回，确认所用请求参数（如购物车等），根据需要选填(版本>=0)
	private $inReserve;	//<std::string> 请求保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->fixupInfoPo = new \b2b2c\skuorder\po\FixupInfoPo();	//<b2b2c::skuorder::po::CFixupInfoPo>
		$this->inLocalkey = "";	//<std::string>
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
			exit("UnlockItemReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("UnlockItem\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->source);	//<std::string> 调用来源，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，必填
		$bs->pushObject($this->fixupInfoPo,'\b2b2c\skuorder\po\FixupInfoPo');	//<b2b2c::skuorder::po::CFixupInfoPo> 商品出价信息，必填
		$bs->pushString($this->inLocalkey);	//<std::string> 异步调用接口返回，确认所用请求参数（如购物车等），根据需要选填
		$bs->pushString($this->inReserve);	//<std::string> 请求保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0921803;
	}
}

class UnlockItemResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $outLocalkey;	//<std::string> 异步调用接口返回，确认所用返回参数（如购物车），根据需要选填(版本>=0)
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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outLocalkey'] = $bs->popString();	//<std::string> 异步调用接口返回，确认所用返回参数（如购物车），根据需要选填
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0928803;
	}
}

namespace b2b2c\skuorder\ao;
class UnlockProductReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $source;	//<std::string> 调用来源，必填(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，必填(版本>=0)
	private $optionId;	//<uint32_t> 选项，可选(版本>=0)
	private $fixupInfoPo;	//<b2b2c::skuorder::po::COmsFixupInfoPo> 解锁请求 ,必填(版本>=0)
	private $eventPo;	//<b2b2c::skuorder::po::CEvent4AppPo> 事务单，必填(版本>=0)
	private $inReserve;	//<std::string> 请求保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->optionId = 0;	//<uint32_t>
		$this->fixupInfoPo = new \b2b2c\skuorder\po\OmsFixupInfoPo();	//<b2b2c::skuorder::po::COmsFixupInfoPo>
		$this->eventPo = new \b2b2c\skuorder\po\Event4AppPo();	//<b2b2c::skuorder::po::CEvent4AppPo>
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
			exit("UnlockProductReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("UnlockProduct\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->source);	//<std::string> 调用来源，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，必填
		$bs->pushUint32_t($this->optionId);	//<uint32_t> 选项，可选
		$bs->pushObject($this->fixupInfoPo,'\b2b2c\skuorder\po\OmsFixupInfoPo');	//<b2b2c::skuorder::po::COmsFixupInfoPo> 解锁请求 ,必填
		$bs->pushObject($this->eventPo,'\b2b2c\skuorder\po\Event4AppPo');	//<b2b2c::skuorder::po::CEvent4AppPo> 事务单，必填
		$bs->pushString($this->inReserve);	//<std::string> 请求保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA092180D;
	}
}

class UnlockProductResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
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
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA092880D;
	}
}
