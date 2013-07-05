<?php
namespace icson\promotionrestrict\bo;	//source idl: com.icson.promotionrestrict.idl.GetActiveBatchPromotionRestrictReq.java
if (!class_exists('icson\promotionrestrict\bo\PromotionRestrictParamInfo_Bo', false)) {
class PromotionRestrictParamInfo_Bo{
	private $_arr_value=array();	//数组形式的类
	private $bussinessId;	//<uint32_t> 业务Id  多价/促销(版本>=0)
	private $edm1;	//<uint32_t> edm1,调用方输入,调用方自定义,一般为多价/促销的规则ID(版本>=0)
	private $edm2;	//<uint64_t> edm2,调用方输入,调用方自定义(版本>=0)
	private $edm3;	//<std::string> edm3,调用方输入,调用方自定义(版本>=0)
	private $num;	//<uint32_t> 生效次数/单品数量,调用方输入(版本>=0)
	private $isRestrict;	//<uint8_t> 是否被限 0未限，1被限(版本>=0)
	private $surplus;	//<uint32_t> 本次可生效的最小次数(版本>=0)
	private $threshold;	//<uint32_t> surplus对应的阀值(版本>=0)
	private $dwDeductTime;	//<uint32_t> 扣减时间 扣减时输出，回滚是输入(版本>=0)
	private $desc;	//<std::string> 限购策略描述(版本>=0)

	function __construct(){
		$this->bussinessId = 0;	//<uint32_t>
		$this->edm1 = 0;	//<uint32_t>
		$this->edm2 = 0;	//<uint64_t>
		$this->edm3 = "";	//<std::string>
		$this->num = 0;	//<uint32_t>
		$this->isRestrict = 0;	//<uint8_t>
		$this->surplus = 0;	//<uint32_t>
		$this->threshold = 0;	//<uint32_t>
		$this->dwDeductTime = 0;	//<uint32_t>
		$this->desc = "";	//<std::string>
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
			exit("\icson\promotionrestrict\bo\PromotionRestrictParamInfo_Bo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\promotionrestrict\bo\PromotionRestrictParamInfo_Bo\\{$name}：请直接赋值为数组，无需new ***。");
		$base = array('bool','byte','uint8_t','int8_t','uint16_t','int16_t','uint32_t','int32_t','uint64_t','int64_t','long','int','string','stl_string');
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(!in_array($class, $base)){
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
	function __get($name){
		return $this->$name;
	}

	function serialize($bs){
		$bs->pushUint32_t($this->getClassLen());
		$this->serialize_internal($bs);
	}

	function serialize_internal($bs){
		$bs->pushUint32_t($this->bussinessId);	//<uint32_t> 业务Id  多价/促销
		$bs->pushUint32_t($this->edm1);	//<uint32_t> edm1,调用方输入,调用方自定义,一般为多价/促销的规则ID
		$bs->pushUint64_t($this->edm2);	//<uint64_t> edm2,调用方输入,调用方自定义
		$bs->pushString($this->edm3);	//<std::string> edm3,调用方输入,调用方自定义
		$bs->pushUint32_t($this->num);	//<uint32_t> 生效次数/单品数量,调用方输入
		$bs->pushUint8_t($this->isRestrict);	//<uint8_t> 是否被限 0未限，1被限
		$bs->pushUint32_t($this->surplus);	//<uint32_t> 本次可生效的最小次数
		$bs->pushUint32_t($this->threshold);	//<uint32_t> surplus对应的阀值
		$bs->pushUint32_t($this->dwDeductTime);	//<uint32_t> 扣减时间 扣减时输出，回滚是输入
		$bs->pushString($this->desc);	//<std::string> 限购策略描述
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['bussinessId'] = $bs->popUint32_t();	//<uint32_t> 业务Id  多价/促销
		$this->_arr_value['edm1'] = $bs->popUint32_t();	//<uint32_t> edm1,调用方输入,调用方自定义,一般为多价/促销的规则ID
		$this->_arr_value['edm2'] = $bs->popUint64_t();	//<uint64_t> edm2,调用方输入,调用方自定义
		$this->_arr_value['edm3'] = $bs->popString();	//<std::string> edm3,调用方输入,调用方自定义
		$this->_arr_value['num'] = $bs->popUint32_t();	//<uint32_t> 生效次数/单品数量,调用方输入
		$this->_arr_value['isRestrict'] = $bs->popUint8_t();	//<uint8_t> 是否被限 0未限，1被限
		$this->_arr_value['surplus'] = $bs->popUint32_t();	//<uint32_t> 本次可生效的最小次数
		$this->_arr_value['threshold'] = $bs->popUint32_t();	//<uint32_t> surplus对应的阀值
		$this->_arr_value['dwDeductTime'] = $bs->popUint32_t();	//<uint32_t> 扣减时间 扣减时输出，回滚是输入
		$this->_arr_value['desc'] = $bs->popString();	//<std::string> 限购策略描述

		/**********************为了支持多个版本的客户端************************/
		$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
		for($idx = 0;$idx < $needPopLen;$idx++){
			$bs->popUint8_t();
		}
		/**********************为了支持多个版本的客户端************************/
		
		return $this->_arr_value;
	}

	function getClassLen(){
		$len_bs = new \ByteStream2();
		$len_bs->setRealWrite(false);
		$this->serialize_internal($len_bs);
		$class_len = $len_bs->getWrittenLength();

		return $class_len;
	}
}
}
