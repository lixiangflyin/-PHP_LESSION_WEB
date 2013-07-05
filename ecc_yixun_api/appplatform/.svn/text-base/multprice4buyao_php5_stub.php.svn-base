<?php
// source idl: com.icson.multprice.idl.MultPrice4BuyAo.java
namespace icson;
require_once "multprice4buyao_php5_xxoo.php";

namespace icson\multprice\ao\multprice4buy;
class CalcMultPriceReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $machineKey;	//<std::string> 用户机器码(版本>=0)
	private $source;	//<std::string> 请求来源(版本>=0)
	private $sceneId;	//<uint32_t> 调用场景id，必填，1:普通购物车，2:节能补贴购物车(版本>=0)
	private $uin;	//<uint64_t> 用户id(版本>=0)
	private $whId;	//<uint32_t> 站点id(版本>=0)
	private $regionId;	//<uint32_t> 地域id，选填(版本>=0)
	private $channelId;	//<std::string> 渠道id(版本>=0)
	private $itemPriceInfoListIn;	//<std::map<std::string,icson::promotion::bo::CSpsItemBo> > 多价商品价格信息列表（输入）(版本>=0)
	private $inReserve;	//<std::string>  保留输入参数,未使用 (版本>=0)
	private $extent;	//<std::map<std::string,std::string> > 请求保留字，拓展用，选填 (版本>=0)

	function __construct() {
		$this->machineKey = "";	//<std::string>
		$this->source = "";	//<std::string>
		$this->sceneId = 0;	//<uint32_t>
		$this->uin = 0;	//<uint64_t>
		$this->whId = 0;	//<uint32_t>
		$this->regionId = 0;	//<uint32_t>
		$this->channelId = "";	//<std::string>
		$this->itemPriceInfoListIn = new \stl_map2('stl_string,\icson\promotion\bo\SpsItemBo');	//<std::map<std::string,icson::promotion::bo::CSpsItemBo> >
		$this->inReserve = "";	//<std::string>
		$this->extent = new \stl_map2('stl_string,stl_string');	//<std::map<std::string,std::string> >
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
			exit("CalcMultPriceReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("CalcMultPrice\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->machineKey);	//<std::string> 用户机器码
		$bs->pushString($this->source);	//<std::string> 请求来源
		$bs->pushUint32_t($this->sceneId);	//<uint32_t> 调用场景id，必填，1:普通购物车，2:节能补贴购物车
		$bs->pushUint64_t($this->uin);	//<uint64_t> 用户id
		$bs->pushUint32_t($this->whId);	//<uint32_t> 站点id
		$bs->pushUint32_t($this->regionId);	//<uint32_t> 地域id，选填
		$bs->pushString($this->channelId);	//<std::string> 渠道id
		$bs->pushObject($this->itemPriceInfoListIn,'stl_map');	//<std::map<std::string,icson::promotion::bo::CSpsItemBo> > 多价商品价格信息列表（输入）
		$bs->pushString($this->inReserve);	//<std::string>  保留输入参数,未使用 
		$bs->pushObject($this->extent,'stl_map');	//<std::map<std::string,std::string> > 请求保留字，拓展用，选填 

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x9A001801;
	}
}

class CalcMultPriceResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $itemPriceInfoListOut;	//<std::map<std::string,icson::promotion::bo::CSpsItemBo> > 多价商品价格信息列表（输出）(版本>=0)
	private $restrictParamList;	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> > 频率限制的结构体,扣减和回退限制时实用(版本>=0)
	private $errmsg;	//<std::string> 错误信息(版本>=0)
	private $outReserve;	//<std::string>  保留输出参数,未使用 (版本>=0)

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
		$this->_arr_value['itemPriceInfoListOut'] = $bs->popObject('stl_map<stl_string,\icson\promotion\bo\SpsItemBo>');	//<std::map<std::string,icson::promotion::bo::CSpsItemBo> > 多价商品价格信息列表（输出）
		$this->_arr_value['restrictParamList'] = $bs->popObject('stl_vector<\icson\promotionrestrict\bo\PromotionRestrictParamInfo_Bo>');	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> > 频率限制的结构体,扣减和回退限制时实用
		$this->_arr_value['errmsg'] = $bs->popString();	//<std::string> 错误信息
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string>  保留输出参数,未使用 

	}

	function getCmdId() {
		return 0x9A008801;
	}
}
