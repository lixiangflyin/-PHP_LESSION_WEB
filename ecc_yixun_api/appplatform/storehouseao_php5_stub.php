<?php
// source idl: com.b2b2c.storehouse.ao.idl.StoreHouseAo.java
namespace b2b2c;
require_once "storehouseao_php5_xxoo.php";

namespace b2b2c\storehouse\ao;
class DelStoreHouseReq{
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $source;	//<std::string> 调用来源，必填(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，必填(版本>=0)
	private $cooperatorId;	//<uint32_t> 合作伙伴主号ID，逻辑仓分表路由，必填(版本>=0)
	private $storeHouseId;	//<uint32_t> 仓库ID，必填(版本>=0)
	private $inReserve;	//<std::string> 请求保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->cooperatorId = 0;	//<uint32_t>
		$this->storeHouseId = 0;	//<uint32_t>
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("DelStoreHouseReq\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$this->$name=$this->$name->setValue($val);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
			}else{
				$this->$name=$val;
			}
			if(isset($this->{$name.'_u'})){
				$this->{$name.'_u'}=1;
			}
		}else{
			exit("DelStoreHouseReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->source);	//<std::string> 调用来源，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，必填
		$bs->pushUint32_t($this->cooperatorId);	//<uint32_t> 合作伙伴主号ID，逻辑仓分表路由，必填
		$bs->pushUint32_t($this->storeHouseId);	//<uint32_t> 仓库ID，必填
		$bs->pushString($this->inReserve);	//<std::string> 请求保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0221804;
	}
}

class DelStoreHouseResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $outReserve;	//<std::string> 输出保留字(版本>=0)

	function __get($name){
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0228804;
	}
}

namespace b2b2c\storehouse\ao;
class GetStoreHouseByCooperatorIdReq{
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $source;	//<std::string> 调用来源，必填(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，必填(版本>=0)
	private $cooperatorId;	//<uint32_t> 合作伙伴主号ID，必填(版本>=0)
	private $inReserve;	//<std::string> 请求保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->cooperatorId = 0;	//<uint32_t>
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("GetStoreHouseByCooperatorIdReq\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$this->$name=$this->$name->setValue($val);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
			}else{
				$this->$name=$val;
			}
			if(isset($this->{$name.'_u'})){
				$this->{$name.'_u'}=1;
			}
		}else{
			exit("GetStoreHouseByCooperatorIdReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->source);	//<std::string> 调用来源，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，必填
		$bs->pushUint32_t($this->cooperatorId);	//<uint32_t> 合作伙伴主号ID，必填
		$bs->pushString($this->inReserve);	//<std::string> 请求保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0221801;
	}
}

class GetStoreHouseByCooperatorIdResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $storeHousePo;	//<std::vector<b2b2c::storehouse::po::CStoreHousePo> > 合作伙伴下的逻辑仓信息(版本>=0)
	private $outReserve;	//<std::string> 输出保留字(版本>=0)

	function __get($name){
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['storeHousePo'] = $bs->popObject('stl_vector<\b2b2c\storehouse\po\StoreHousePo>');	//<std::vector<b2b2c::storehouse::po::CStoreHousePo> > 合作伙伴下的逻辑仓信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0228801;
	}
}

namespace b2b2c\storehouse\ao;
class GetStoreHouseByStockIdReq{
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $source;	//<std::string> 调用来源，必填(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，必填(版本>=0)
	private $cooperatorId;	//<uint32_t> 合作伙伴主号ID，逻辑仓分表路由，必填(版本>=0)
	private $storeHouseId;	//<uint32_t> 仓库ID，必填(版本>=0)
	private $inReserve;	//<std::string> 请求保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->cooperatorId = 0;	//<uint32_t>
		$this->storeHouseId = 0;	//<uint32_t>
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("GetStoreHouseByStockIdReq\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$this->$name=$this->$name->setValue($val);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
			}else{
				$this->$name=$val;
			}
			if(isset($this->{$name.'_u'})){
				$this->{$name.'_u'}=1;
			}
		}else{
			exit("GetStoreHouseByStockIdReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->source);	//<std::string> 调用来源，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，必填
		$bs->pushUint32_t($this->cooperatorId);	//<uint32_t> 合作伙伴主号ID，逻辑仓分表路由，必填
		$bs->pushUint32_t($this->storeHouseId);	//<uint32_t> 仓库ID，必填
		$bs->pushString($this->inReserve);	//<std::string> 请求保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0221802;
	}
}

class GetStoreHouseByStockIdResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $storeHousePo;	//<b2b2c::storehouse::po::CStoreHousePo> 逻辑仓基本信息(版本>=0)
	private $outReserve;	//<std::string> 输出保留字(版本>=0)

	function __get($name){
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['storeHousePo'] = $bs->popObject('\b2b2c\storehouse\po\StoreHousePo');	//<b2b2c::storehouse::po::CStoreHousePo> 逻辑仓基本信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0228802;
	}
}

namespace b2b2c\storehouse\ao;
class GetStoreHouseListReq{
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $source;	//<std::string> 调用来源，必填(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，必填(版本>=0)
	private $storeHouseId;	//<std::map<uint32_t,uint32_t> > 仓库ID与对应的所属合作伙伴id，必填(版本>=0)
	private $inReserve;	//<std::string> 请求保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->storeHouseId = new \stl_map2('uint32_t,uint32_t');	//<std::map<uint32_t,uint32_t> >
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("GetStoreHouseListReq\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$this->$name=$this->$name->setValue($val);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
			}else{
				$this->$name=$val;
			}
			if(isset($this->{$name.'_u'})){
				$this->{$name.'_u'}=1;
			}
		}else{
			exit("GetStoreHouseListReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->source);	//<std::string> 调用来源，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，必填
		$bs->pushObject($this->storeHouseId,'stl_map');	//<std::map<uint32_t,uint32_t> > 仓库ID与对应的所属合作伙伴id，必填
		$bs->pushString($this->inReserve);	//<std::string> 请求保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0221805;
	}
}

class GetStoreHouseListResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $storeHousePo;	//<std::vector<b2b2c::storehouse::po::CStoreHousePo> > 逻辑仓id列表拉取的逻辑仓信息列表(版本>=0)
	private $outReserve;	//<std::string> 输出保留字(版本>=0)

	function __get($name){
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['storeHousePo'] = $bs->popObject('stl_vector<\b2b2c\storehouse\po\StoreHousePo>');	//<std::vector<b2b2c::storehouse::po::CStoreHousePo> > 逻辑仓id列表拉取的逻辑仓信息列表
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0228805;
	}
}

namespace b2b2c\storehouse\ao;
class UpdateStoreHouseReq{
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 机器码，必填(版本>=0)
	private $source;	//<std::string> 调用来源，必填(版本>=0)
	private $sceneId;	//<uint32_t> 场景id，必填(版本>=0)
	private $storeHousePo;	//<b2b2c::storehouse::po::CStoreHousePo> 逻辑仓基本信息，必填(版本>=0)
	private $inReserve;	//<std::string> 请求保留字(版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->storeHousePo = new \b2b2c\storehouse\po\StoreHousePo();	//<b2b2c::storehouse::po::CStoreHousePo>
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("UpdateStoreHouseReq\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$this->$name=$this->$name->setValue($val);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
			}else{
				$this->$name=$val;
			}
			if(isset($this->{$name.'_u'})){
				$this->{$name.'_u'}=1;
			}
		}else{
			exit("UpdateStoreHouseReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushString($this->machineKey);	//<std::string> 机器码，必填
		$bs->pushString($this->source);	//<std::string> 调用来源，必填
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 场景id，必填
		$bs->pushObject($this->storeHousePo,'\b2b2c\storehouse\po\StoreHousePo');	//<b2b2c::storehouse::po::CStoreHousePo> 逻辑仓基本信息，必填
		$bs->pushString($this->inReserve);	//<std::string> 请求保留字

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0221803;
	}
}

class UpdateStoreHouseResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $outReserve;	//<std::string> 输出保留字(版本>=0)

	function __get($name){
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 输出保留字

	}

	function getCmdId() {
		return 0xA0228803;
	}
}
