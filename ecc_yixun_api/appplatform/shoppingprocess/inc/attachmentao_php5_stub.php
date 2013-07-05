<?php
// source idl: com.icson.deal.idl.AttachmentAo.java
namespace icson;
require_once "attachmentao_php5_xxoo.php";

namespace icson\deal\ao\attachment;
class GetAppointInfoReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $mainproduct;	//<icson::deal::ddo::attachment::CMainProduct> 主商品信息(版本>=0)
	private $stationId;	//<uint32_t> 站id(版本>=0)
	private $reserveIn;	//<std::string> 保留字段(版本>=0)
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，必填(版本>=0)

	function __construct() {
		$this->mainproduct = new \icson\deal\ddo\attachment\MainProduct();	//<icson::deal::ddo::attachment::CMainProduct>
		$this->stationId = 0;	//<uint32_t>
		$this->reserveIn = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
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
			exit("GetAppointInfoReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetAppointInfo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushObject($this->mainproduct,'\icson\deal\ddo\attachment\MainProduct');	//<icson::deal::ddo::attachment::CMainProduct> 主商品信息
		$bs->pushUint32_t($this->stationId);	//<uint32_t> 站id
		$bs->pushString($this->reserveIn);	//<std::string> 保留字段
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，必填

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91141806;
	}
}

class GetAppointInfoResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $appointment;	//<std::map<uint32_t,icson::deal::ddo::attachment::CAppointment> > 预约活动阿规则信息(版本>=0)
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
		$this->_arr_value['appointment'] = $bs->popObject('stl_map<uint32_t,\icson\deal\ddo\attachment\Appointment>');	//<std::map<uint32_t,icson::deal::ddo::attachment::CAppointment> > 预约活动阿规则信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0x91148806;
	}
}

namespace icson\deal\ao\attachment;
class GetAttachmentReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $stationId;	//<uint32_t>  站id (版本>=0)
	private $areaId;	//<uint32_t>  地域id (版本>=0)
	private $mainproduct;	//<icson::deal::ddo::attachment::CMainProduct>  主商品信息(版本>=0)
	private $reserveIn;	//<std::string> ReserveIn(版本>=0)
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，必填(版本>=0)

	function __construct() {
		$this->stationId = 0;	//<uint32_t>
		$this->areaId = 0;	//<uint32_t>
		$this->mainproduct = new \icson\deal\ddo\attachment\MainProduct();	//<icson::deal::ddo::attachment::CMainProduct>
		$this->reserveIn = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
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
			exit("GetAttachmentReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetAttachment\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->stationId);	//<uint32_t>  站id 
		$bs->pushUint32_t($this->areaId);	//<uint32_t>  地域id 
		$bs->pushObject($this->mainproduct,'\icson\deal\ddo\attachment\MainProduct');	//<icson::deal::ddo::attachment::CMainProduct>  主商品信息
		$bs->pushString($this->reserveIn);	//<std::string> ReserveIn
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，必填

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91141805;
	}
}

class GetAttachmentResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $mapMainAttachment;	//<std::map<uint32_t,icson::deal::ddo::attachment::CAttachment> >  随心配信息列表(版本>=0)
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
		$this->_arr_value['mapMainAttachment'] = $bs->popObject('stl_map<uint32_t,\icson\deal\ddo\attachment\Attachment>');	//<std::map<uint32_t,icson::deal::ddo::attachment::CAttachment> >  随心配信息列表
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0x91148805;
	}
}

namespace icson\deal\ao\attachment;
class GetGiftReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $stationId;	//<uint32_t>  站id (版本>=0)
	private $areaId;	//<uint32_t>  地域id (版本>=0)
	private $mainproduct;	//<icson::deal::ddo::attachment::CMainProduct>  主商品信息(版本>=0)
	private $reserveIn;	//<std::string> ReserveIn(版本>=0)
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，必填(版本>=0)

	function __construct() {
		$this->stationId = 0;	//<uint32_t>
		$this->areaId = 0;	//<uint32_t>
		$this->mainproduct = new \icson\deal\ddo\attachment\MainProduct();	//<icson::deal::ddo::attachment::CMainProduct>
		$this->reserveIn = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
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
			exit("GetGiftReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetGift\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->stationId);	//<uint32_t>  站id 
		$bs->pushUint32_t($this->areaId);	//<uint32_t>  地域id 
		$bs->pushObject($this->mainproduct,'\icson\deal\ddo\attachment\MainProduct');	//<icson::deal::ddo::attachment::CMainProduct>  主商品信息
		$bs->pushString($this->reserveIn);	//<std::string> ReserveIn
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，必填

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91141801;
	}
}

class GetGiftResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $mapMainIdGift;	//<std::map<uint32_t,std::vector<icson::deal::ddo::attachment::CGift> > >  赠品信息列表(版本>=0)
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
		$this->_arr_value['mapMainIdGift'] = $bs->popObject('stl_map<uint32_t,stl_vector<\icson\deal\ddo\attachment\Gift> >');	//<std::map<uint32_t,std::vector<icson::deal::ddo::attachment::CGift> > >  赠品信息列表
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0x91148801;
	}
}

namespace icson\deal\ao\attachment;
class GetPackageByRuleIdsReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $stationId;	//<uint32_t>  站id (版本>=0)
	private $areaId;	//<uint32_t>  地域id (版本>=0)
	private $rulesId;	//<std::vector<uint32_t> >  规则id列表(版本>=0)
	private $reserveIn;	//<std::string> ReserveIn(版本>=0)
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，必填(版本>=0)

	function __construct() {
		$this->stationId = 0;	//<uint32_t>
		$this->areaId = 0;	//<uint32_t>
		$this->rulesId = new \stl_vector2('uint32_t');	//<std::vector<uint32_t> >
		$this->reserveIn = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
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
			exit("GetPackageByRuleIdsReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetPackageByRuleIds\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->stationId);	//<uint32_t>  站id 
		$bs->pushUint32_t($this->areaId);	//<uint32_t>  地域id 
		$bs->pushObject($this->rulesId,'stl_vector');	//<std::vector<uint32_t> >  规则id列表
		$bs->pushString($this->reserveIn);	//<std::string> ReserveIn
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，必填

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91141804;
	}
}

class GetPackageByRuleIdsResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $mapMRuleIdPackage;	//<std::map<uint32_t,icson::deal::ddo::attachment::CPackage> >  随心配信息列表(版本>=0)
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
		$this->_arr_value['mapMRuleIdPackage'] = $bs->popObject('stl_map<uint32_t,\icson\deal\ddo\attachment\Package>');	//<std::map<uint32_t,icson::deal::ddo::attachment::CPackage> >  随心配信息列表
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0x91148804;
	}
}

namespace icson\deal\ao\attachment;
class GetPromotionReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $stationId;	//<uint32_t>  站id (版本>=0)
	private $areaId;	//<uint32_t>  地域id (版本>=0)
	private $mainproduct;	//<icson::deal::ddo::attachment::CMainProduct>  主商品信息(版本>=0)
	private $type;	//<uint32_t>  查找类型 0 表示两者都需要查， 1 表示查找单品赠券 2 表示套餐(版本>=0)
	private $reserveIn;	//<std::string> ReserveIn(版本>=0)
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，必填(版本>=0)

	function __construct() {
		$this->stationId = 0;	//<uint32_t>
		$this->areaId = 0;	//<uint32_t>
		$this->mainproduct = new \icson\deal\ddo\attachment\MainProduct();	//<icson::deal::ddo::attachment::CMainProduct>
		$this->type = 0;	//<uint32_t>
		$this->reserveIn = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
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
			exit("GetPromotionReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetPromotion\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->stationId);	//<uint32_t>  站id 
		$bs->pushUint32_t($this->areaId);	//<uint32_t>  地域id 
		$bs->pushObject($this->mainproduct,'\icson\deal\ddo\attachment\MainProduct');	//<icson::deal::ddo::attachment::CMainProduct>  主商品信息
		$bs->pushUint32_t($this->type);	//<uint32_t>  查找类型 0 表示两者都需要查， 1 表示查找单品赠券 2 表示套餐
		$bs->pushString($this->reserveIn);	//<std::string> ReserveIn
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，必填

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91141803;
	}
}

class GetPromotionResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $promotion;	//<std::map<uint32_t,icson::deal::ddo::attachment::CPromotion> > 单品促销信息(版本>=0)
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
		$this->_arr_value['promotion'] = $bs->popObject('stl_map<uint32_t,\icson\deal\ddo\attachment\Promotion>');	//<std::map<uint32_t,icson::deal::ddo::attachment::CPromotion> > 单品促销信息
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0x91148803;
	}
}

namespace icson\deal\ao\attachment;
class GetRelativityReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $stationId;	//<uint32_t>  站id (版本>=0)
	private $areaId;	//<uint32_t>  地域id (版本>=0)
	private $mainproduct;	//<icson::deal::ddo::attachment::CMainProduct>  主商品信息(版本>=0)
	private $reserveIn;	//<std::string> ReserveIn(版本>=0)
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，必填(版本>=0)

	function __construct() {
		$this->stationId = 0;	//<uint32_t>
		$this->areaId = 0;	//<uint32_t>
		$this->mainproduct = new \icson\deal\ddo\attachment\MainProduct();	//<icson::deal::ddo::attachment::CMainProduct>
		$this->reserveIn = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
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
			exit("GetRelativityReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetRelativity\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->stationId);	//<uint32_t>  站id 
		$bs->pushUint32_t($this->areaId);	//<uint32_t>  地域id 
		$bs->pushObject($this->mainproduct,'\icson\deal\ddo\attachment\MainProduct');	//<icson::deal::ddo::attachment::CMainProduct>  主商品信息
		$bs->pushString($this->reserveIn);	//<std::string> ReserveIn
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，必填

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91141802;
	}
}

class GetRelativityResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $mapMainIdRelativity;	//<std::map<uint32_t,std::vector<icson::deal::ddo::attachment::CRelativity> > >  随心配信息列表(版本>=0)
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
		$this->_arr_value['mapMainIdRelativity'] = $bs->popObject('stl_map<uint32_t,stl_vector<\icson\deal\ddo\attachment\Relativity> >');	//<std::map<uint32_t,std::vector<icson::deal::ddo::attachment::CRelativity> > >  随心配信息列表
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0x91148802;
	}
}
