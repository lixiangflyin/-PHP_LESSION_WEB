<?php
// source idl: com.icson.sps.idl.SpsRule4Others.java
namespace icson;
require_once "spsrule4others_php5_xxoo.php";

namespace icson\promotion\ao\detail;
class GetRuleForGuanguanReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $uin;	//<uint64_t> 用户ID(版本>=0)
	private $source;	//<std::string> 请求来源(版本>=0)
	private $scene;	//<uint32_t> 场景id(版本>=0)
	private $ruleId;	//<uint32_t> 站点id(版本>=0)
	private $inReserve;	//<std::string> 保留字段(版本>=0)

	function __construct() {
		$this->uin = 0;	//<uint64_t>
		$this->source = "";	//<std::string>
		$this->scene = 0;	//<uint32_t>
		$this->ruleId = 0;	//<uint32_t>
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
			exit("GetRuleForGuanguanReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetRuleForGuanguan\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint64_t($this->uin);	//<uint64_t> 用户ID
		$bs->pushString($this->source);	//<std::string> 请求来源
		$bs->pushUint32_t($this->scene);	//<uint32_t> 场景id
		$bs->pushUint32_t($this->ruleId);	//<uint32_t> 站点id
		$bs->pushString($this->inReserve);	//<std::string> 保留字段

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x9a501801;
	}
}

class GetRuleForGuanguanResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $opinfo;	//<std::string> (版本>=0)
	private $desc;	//<std::string> (版本>=0)
	private $remark;	//<std::string> (版本>=0)
	private $ruleid;	//<uint32_t> (版本>=0)
	private $errCode;	//<uint32_t> 错误码(版本>=0)
	private $outReserve;	//<std::string> 保留字段(版本>=0)

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
		$this->_arr_value['opinfo'] = $bs->popString();	//<std::string> 
		$this->_arr_value['desc'] = $bs->popString();	//<std::string> 
		$this->_arr_value['remark'] = $bs->popString();	//<std::string> 
		$this->_arr_value['ruleid'] = $bs->popUint32_t();	//<uint32_t> 
		$this->_arr_value['errCode'] = $bs->popUint32_t();	//<uint32_t> 错误码
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 保留字段

	}

	function getCmdId() {
		return 0x9a508801;
	}
}
