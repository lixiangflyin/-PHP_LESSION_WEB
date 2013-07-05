<?php
// source idl: com.icson.sps.idl.SpsSchedulePromotion.java
namespace icson;
require_once "spsschedulepromotion_php5_xxoo.php";

namespace icson\promotion\ao\schedule;
class CheckPromotionInfoReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $uin;	//<uint64_t> 用户ID,登录了就填，没登录填0(版本>=0)
	private $source;	//<std::string> 请求来源(版本>=0)
	private $scene;	//<uint32_t> 场景id，商详：1，购物车：2，订单确认页：3，提交订单：4(版本>=0)
	private $itemClassNum;	//<uint32_t> 商品总款数(版本>=0)
	private $itemNum;	//<uint32_t> 商品总件数(版本>=0)
	private $whId;	//<uint32_t> 站点id(版本>=0)
	private $regionId;	//<uint32_t> 地域 id，一期可以不填(版本>=0)
	private $channelId;	//<std::string> 渠道id，一期可以不填(版本>=0)
	private $rulelId;	//<std::vector<uint32_t> > 用户选择的促销规则id,可能有多个，一期只有一个(版本>=0)
	private $spsItemListIn;	//<std::vector<icson::promotion::bo::CSpsItemBo> > 促销商品信息列表（输入）(版本>=0)
	private $inReserve;	//<std::string> 保留字段(版本>=0)
	private $extent;	//<std::map<std::string,std::string> > 请求保留字，拓展用，选填 (版本>=0)

	function __construct() {
		$this->uin = 0;	//<uint64_t>
		$this->source = "";	//<std::string>
		$this->scene = 0;	//<uint32_t>
		$this->itemClassNum = 0;	//<uint32_t>
		$this->itemNum = 0;	//<uint32_t>
		$this->whId = 0;	//<uint32_t>
		$this->regionId = 0;	//<uint32_t>
		$this->channelId = "";	//<std::string>
		$this->rulelId = new \stl_vector2('uint32_t');	//<std::vector<uint32_t> >
		$this->spsItemListIn = new \stl_vector2('\icson\promotion\bo\SpsItemBo');	//<std::vector<icson::promotion::bo::CSpsItemBo> >
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
			exit("CheckPromotionInfoReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("CheckPromotionInfo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint64_t($this->uin);	//<uint64_t> 用户ID,登录了就填，没登录填0
		$bs->pushString($this->source);	//<std::string> 请求来源
		$bs->pushUint32_t($this->scene);	//<uint32_t> 场景id，商详：1，购物车：2，订单确认页：3，提交订单：4
		$bs->pushUint32_t($this->itemClassNum);	//<uint32_t> 商品总款数
		$bs->pushUint32_t($this->itemNum);	//<uint32_t> 商品总件数
		$bs->pushUint32_t($this->whId);	//<uint32_t> 站点id
		$bs->pushUint32_t($this->regionId);	//<uint32_t> 地域 id，一期可以不填
		$bs->pushString($this->channelId);	//<std::string> 渠道id，一期可以不填
		$bs->pushObject($this->rulelId,'stl_vector');	//<std::vector<uint32_t> > 用户选择的促销规则id,可能有多个，一期只有一个
		$bs->pushObject($this->spsItemListIn,'stl_vector');	//<std::vector<icson::promotion::bo::CSpsItemBo> > 促销商品信息列表（输入）
		$bs->pushString($this->inReserve);	//<std::string> 保留字段
		$bs->pushObject($this->extent,'stl_map');	//<std::map<std::string,std::string> > 请求保留字，拓展用，选填 

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x98151801;
	}
}

class CheckPromotionInfoResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $spsItemListOut;	//<std::vector<icson::promotion::bo::CSpsItemBo> > 促销商品信息列表（输出）(版本>=0)
	private $spsOpInfoListOut;	//<std::vector<icson::promotion::bo::CSpsOperationInfoItemBo> > 规则信息列表(版本>=0)
	private $restrictParamList;	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> > 频率限制的结构体,回退限制时实用，商详不用(版本>=0)
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
		$this->_arr_value['spsItemListOut'] = $bs->popObject('stl_vector<\icson\promotion\bo\SpsItemBo>');	//<std::vector<icson::promotion::bo::CSpsItemBo> > 促销商品信息列表（输出）
		$this->_arr_value['spsOpInfoListOut'] = $bs->popObject('stl_vector<\icson\promotion\bo\SpsOperationInfoItemBo>');	//<std::vector<icson::promotion::bo::CSpsOperationInfoItemBo> > 规则信息列表
		$this->_arr_value['restrictParamList'] = $bs->popObject('stl_vector<\icson\promotionrestrict\bo\PromotionRestrictParamInfo_Bo>');	//<std::vector<icson::promotionrestrict::bo::CPromotionRestrictParamInfo_Bo> > 频率限制的结构体,回退限制时实用，商详不用
		$this->_arr_value['errCode'] = $bs->popUint32_t();	//<uint32_t> 错误码
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 保留字段

	}

	function getCmdId() {
		return 0x98158801;
	}
}

namespace icson\promotion\ao\schedule;
class GetPromotionInfoReq{
	private $_routeKey;
	private $_arr_value=array();	//数组形式的类
	private $uin;	//<uint64_t> 用户ID(版本>=0)
	private $source;	//<std::string> 请求来源(版本>=0)
	private $scene;	//<uint32_t> 场景id(版本>=0)
	private $itemClassNum;	//<uint32_t> 商品总款数(版本>=0)
	private $itemNum;	//<uint32_t> 商品总件数(版本>=0)
	private $whId;	//<uint32_t> 站点id(版本>=0)
	private $regionId;	//<uint32_t> 地域 id，一期可以不填(版本>=0)
	private $channelId;	//<std::string> 渠道id，一期可以不填(版本>=0)
	private $spsItemListIn;	//<std::vector<icson::promotion::bo::CSpsItemBo> > 促销商品信息列表（输入）(版本>=0)
	private $inReserve;	//<std::string> 保留字段(版本>=0)
	private $extent;	//<std::map<std::string,std::string> > 请求保留字，拓展用，选填 (版本>=0)

	function __construct() {
		$this->uin = 0;	//<uint64_t>
		$this->source = "";	//<std::string>
		$this->scene = 0;	//<uint32_t>
		$this->itemClassNum = 0;	//<uint32_t>
		$this->itemNum = 0;	//<uint32_t>
		$this->whId = 0;	//<uint32_t>
		$this->regionId = 0;	//<uint32_t>
		$this->channelId = "";	//<std::string>
		$this->spsItemListIn = new \stl_vector2('\icson\promotion\bo\SpsItemBo');	//<std::vector<icson::promotion::bo::CSpsItemBo> >
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
			exit("GetPromotionInfoReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("GetPromotionInfo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->itemClassNum);	//<uint32_t> 商品总款数
		$bs->pushUint32_t($this->itemNum);	//<uint32_t> 商品总件数
		$bs->pushUint32_t($this->whId);	//<uint32_t> 站点id
		$bs->pushUint32_t($this->regionId);	//<uint32_t> 地域 id，一期可以不填
		$bs->pushString($this->channelId);	//<std::string> 渠道id，一期可以不填
		$bs->pushObject($this->spsItemListIn,'stl_vector');	//<std::vector<icson::promotion::bo::CSpsItemBo> > 促销商品信息列表（输入）
		$bs->pushString($this->inReserve);	//<std::string> 保留字段
		$bs->pushObject($this->extent,'stl_map');	//<std::map<std::string,std::string> > 请求保留字，拓展用，选填 

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x98151802;
	}
}

class GetPromotionInfoResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $spsItemListOut;	//<std::vector<icson::promotion::bo::CSpsItemBo> > 促销商品信息列表（输出）(版本>=0)
	private $spsOpInfoListOut;	//<std::vector<icson::promotion::bo::CSpsOperationInfoItemBo> > 规则信息列表(版本>=0)
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
		$this->_arr_value['spsItemListOut'] = $bs->popObject('stl_vector<\icson\promotion\bo\SpsItemBo>');	//<std::vector<icson::promotion::bo::CSpsItemBo> > 促销商品信息列表（输出）
		$this->_arr_value['spsOpInfoListOut'] = $bs->popObject('stl_vector<\icson\promotion\bo\SpsOperationInfoItemBo>');	//<std::vector<icson::promotion::bo::CSpsOperationInfoItemBo> > 规则信息列表
		$this->_arr_value['errCode'] = $bs->popUint32_t();	//<uint32_t> 错误码
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string> 保留字段

	}

	function getCmdId() {
		return 0x98158802;
	}
}
