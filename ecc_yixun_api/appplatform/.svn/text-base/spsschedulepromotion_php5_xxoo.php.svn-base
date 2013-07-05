<?php
namespace icson\promotionrestrict\bo;	//source idl: com.icson.sps.idl.CheckPromotionInfoResp.java
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

namespace icson\promotion\bo;	//source idl: com.icson.sps.idl.CheckPromotionInfoResp.java
if (!class_exists('icson\promotion\bo\SpsOperationInfoItemBo', false)) {
class SpsOperationInfoItemBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号 (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $ruleId;	//<uint32_t> 规则ID(版本>=0)
	private $ruleId_u;	//<uint8_t> (版本>=0)
	private $opType;	//<uint32_t> 促销类型:参考文档，可能同时包括多价:1和促销:2 (版本>=0)
	private $opType_u;	//<uint8_t> (版本>=0)
	private $opInfo;	//<std::string> 运营信息 (版本>=0)
	private $opInfo_u;	//<uint8_t> (版本>=0)
	private $url;	//<std::string> 运营信息描述对应的url (版本>=0)
	private $url_u;	//<uint8_t> (版本>=0)
	private $useRuleState;	//<uint32_t> 当前规则的使用状态(商详页不用)：1(规则匹配且满足)，2(规则匹配但不满足)，3(因梯度价，满足与待满足同时存在，暂时不考虑)(版本>=0)
	private $useRuleState_u;	//<uint8_t> (版本>=0)
	private $ruleSumValue;	//<uint32_t> 匹配当前规则的商品价格总和(商详页无用)，该总和可能满足规则，也可能不满足 (版本>=0)
	private $ruleSumValue_u;	//<uint8_t> (版本>=0)
	private $stagePriceType;	//<uint32_t> 梯度类型,0为自动梯度，1为手动梯度 (版本>=0)
	private $stagePriceType_u;	//<uint8_t> (版本>=0)
	private $conditionType;	//<uint32_t> 已满足规则的条件value类型:0无条件 1价格，2件数 (版本>=0)
	private $conditionType_u;	//<uint8_t> (版本>=0)
	private $conditionValue;	//<std::vector<uint32_t> > 已满足规则的条件value，如满100，此处为10000，手动梯度的话为整个梯度价的vector，存了每个价格，自动梯度则只有一个值 (版本>=0)
	private $conditionValue_u;	//<uint8_t> (版本>=0)
	private $autoStageMax;	//<uint32_t> 如果是手动梯度价，则为梯度的最大限制 (版本>=0)
	private $autoStageMax_u;	//<uint8_t> (版本>=0)
	private $stagePriceIndex;	//<uint32_t> 满足梯度价下标，从1开始（商详不用） (版本>=0)
	private $stagePriceIndex_u;	//<uint8_t> (版本>=0)
	private $discountType;	//<uint32_t> 满足规则的优惠value类型：1减金额，2券id，3折扣，4商品id，5积分，6折扣，满包邮时此字段无用,手动梯度为整个梯度 (版本>=0)
	private $discountType_u;	//<uint8_t> (版本>=0)
	private $discountValue;	//<std::vector<std::string> > 满足规则的优惠value，如满XX减50，此处为5000；满送券，此处为券id,送积分时此处为积分，折扣时显示**折；满包邮时此字段无用,手动梯度的话为整个梯度价的vector，存了每个价格，自动梯度则只有一个 (版本>=0)
	private $discountValue_u;	//<uint8_t> (版本>=0)
	private $discountUseNum;	//<uint32_t> 满足规则的优惠的使用数量(商详页无用)，如优惠券的数量，无数量要求时，默认为1，满包邮时此字段无用 (版本>=0)
	private $discountUseNum_u;	//<uint8_t> (版本>=0)
	private $unfillDiffValue;	//<uint32_t> 待满足规则的差额(商详页不用)，如差10元，可使用满立减，此处为1000(版本>=0)
	private $unfillDiffValue_u;	//<uint8_t> (版本>=0)
	private $ext;	//<std::map<std::string,std::string> > 扩展字段(版本>=0)
	private $ext_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->ruleId = 0;	//<uint32_t>
		$this->ruleId_u = 0;	//<uint8_t>
		$this->opType = 0;	//<uint32_t>
		$this->opType_u = 0;	//<uint8_t>
		$this->opInfo = "";	//<std::string>
		$this->opInfo_u = 0;	//<uint8_t>
		$this->url = "";	//<std::string>
		$this->url_u = 0;	//<uint8_t>
		$this->useRuleState = 0;	//<uint32_t>
		$this->useRuleState_u = 0;	//<uint8_t>
		$this->ruleSumValue = 0;	//<uint32_t>
		$this->ruleSumValue_u = 0;	//<uint8_t>
		$this->stagePriceType = 0;	//<uint32_t>
		$this->stagePriceType_u = 0;	//<uint8_t>
		$this->conditionType = 0;	//<uint32_t>
		$this->conditionType_u = 0;	//<uint8_t>
		$this->conditionValue = new \stl_vector2('uint32_t');	//<std::vector<uint32_t> >
		$this->conditionValue_u = 0;	//<uint8_t>
		$this->autoStageMax = 0;	//<uint32_t>
		$this->autoStageMax_u = 0;	//<uint8_t>
		$this->stagePriceIndex = 0;	//<uint32_t>
		$this->stagePriceIndex_u = 0;	//<uint8_t>
		$this->discountType = 0;	//<uint32_t>
		$this->discountType_u = 0;	//<uint8_t>
		$this->discountValue = new \stl_vector2('stl_string');	//<std::vector<std::string> >
		$this->discountValue_u = 0;	//<uint8_t>
		$this->discountUseNum = 0;	//<uint32_t>
		$this->discountUseNum_u = 0;	//<uint8_t>
		$this->unfillDiffValue = 0;	//<uint32_t>
		$this->unfillDiffValue_u = 0;	//<uint8_t>
		$this->ext = new \stl_map2('stl_string,stl_string');	//<std::map<std::string,std::string> >
		$this->ext_u = 0;	//<uint8_t>
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
			exit("\icson\promotion\bo\SpsOperationInfoItemBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\promotion\bo\SpsOperationInfoItemBo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t>  版本号 
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->ruleId);	//<uint32_t> 规则ID
		$bs->pushUint8_t($this->ruleId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->opType);	//<uint32_t> 促销类型:参考文档，可能同时包括多价:1和促销:2 
		$bs->pushUint8_t($this->opType_u);	//<uint8_t> 
		$bs->pushString($this->opInfo);	//<std::string> 运营信息 
		$bs->pushUint8_t($this->opInfo_u);	//<uint8_t> 
		$bs->pushString($this->url);	//<std::string> 运营信息描述对应的url 
		$bs->pushUint8_t($this->url_u);	//<uint8_t> 
		$bs->pushUint32_t($this->useRuleState);	//<uint32_t> 当前规则的使用状态(商详页不用)：1(规则匹配且满足)，2(规则匹配但不满足)，3(因梯度价，满足与待满足同时存在，暂时不考虑)
		$bs->pushUint8_t($this->useRuleState_u);	//<uint8_t> 
		$bs->pushUint32_t($this->ruleSumValue);	//<uint32_t> 匹配当前规则的商品价格总和(商详页无用)，该总和可能满足规则，也可能不满足 
		$bs->pushUint8_t($this->ruleSumValue_u);	//<uint8_t> 
		$bs->pushUint32_t($this->stagePriceType);	//<uint32_t> 梯度类型,0为自动梯度，1为手动梯度 
		$bs->pushUint8_t($this->stagePriceType_u);	//<uint8_t> 
		$bs->pushUint32_t($this->conditionType);	//<uint32_t> 已满足规则的条件value类型:0无条件 1价格，2件数 
		$bs->pushUint8_t($this->conditionType_u);	//<uint8_t> 
		$bs->pushObject($this->conditionValue,'stl_vector');	//<std::vector<uint32_t> > 已满足规则的条件value，如满100，此处为10000，手动梯度的话为整个梯度价的vector，存了每个价格，自动梯度则只有一个值 
		$bs->pushUint8_t($this->conditionValue_u);	//<uint8_t> 
		$bs->pushUint32_t($this->autoStageMax);	//<uint32_t> 如果是手动梯度价，则为梯度的最大限制 
		$bs->pushUint8_t($this->autoStageMax_u);	//<uint8_t> 
		$bs->pushUint32_t($this->stagePriceIndex);	//<uint32_t> 满足梯度价下标，从1开始（商详不用） 
		$bs->pushUint8_t($this->stagePriceIndex_u);	//<uint8_t> 
		$bs->pushUint32_t($this->discountType);	//<uint32_t> 满足规则的优惠value类型：1减金额，2券id，3折扣，4商品id，5积分，6折扣，满包邮时此字段无用,手动梯度为整个梯度 
		$bs->pushUint8_t($this->discountType_u);	//<uint8_t> 
		$bs->pushObject($this->discountValue,'stl_vector');	//<std::vector<std::string> > 满足规则的优惠value，如满XX减50，此处为5000；满送券，此处为券id,送积分时此处为积分，折扣时显示**折；满包邮时此字段无用,手动梯度的话为整个梯度价的vector，存了每个价格，自动梯度则只有一个 
		$bs->pushUint8_t($this->discountValue_u);	//<uint8_t> 
		$bs->pushUint32_t($this->discountUseNum);	//<uint32_t> 满足规则的优惠的使用数量(商详页无用)，如优惠券的数量，无数量要求时，默认为1，满包邮时此字段无用 
		$bs->pushUint8_t($this->discountUseNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->unfillDiffValue);	//<uint32_t> 待满足规则的差额(商详页不用)，如差10元，可使用满立减，此处为1000
		$bs->pushUint8_t($this->unfillDiffValue_u);	//<uint8_t> 
		$bs->pushObject($this->ext,'stl_map');	//<std::map<std::string,std::string> > 扩展字段
		$bs->pushUint8_t($this->ext_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号 
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleId'] = $bs->popUint32_t();	//<uint32_t> 规则ID
		$this->_arr_value['ruleId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['opType'] = $bs->popUint32_t();	//<uint32_t> 促销类型:参考文档，可能同时包括多价:1和促销:2 
		$this->_arr_value['opType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['opInfo'] = $bs->popString();	//<std::string> 运营信息 
		$this->_arr_value['opInfo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['url'] = $bs->popString();	//<std::string> 运营信息描述对应的url 
		$this->_arr_value['url_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['useRuleState'] = $bs->popUint32_t();	//<uint32_t> 当前规则的使用状态(商详页不用)：1(规则匹配且满足)，2(规则匹配但不满足)，3(因梯度价，满足与待满足同时存在，暂时不考虑)
		$this->_arr_value['useRuleState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleSumValue'] = $bs->popUint32_t();	//<uint32_t> 匹配当前规则的商品价格总和(商详页无用)，该总和可能满足规则，也可能不满足 
		$this->_arr_value['ruleSumValue_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stagePriceType'] = $bs->popUint32_t();	//<uint32_t> 梯度类型,0为自动梯度，1为手动梯度 
		$this->_arr_value['stagePriceType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['conditionType'] = $bs->popUint32_t();	//<uint32_t> 已满足规则的条件value类型:0无条件 1价格，2件数 
		$this->_arr_value['conditionType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['conditionValue'] = $bs->popObject('stl_vector<uint32_t>');	//<std::vector<uint32_t> > 已满足规则的条件value，如满100，此处为10000，手动梯度的话为整个梯度价的vector，存了每个价格，自动梯度则只有一个值 
		$this->_arr_value['conditionValue_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['autoStageMax'] = $bs->popUint32_t();	//<uint32_t> 如果是手动梯度价，则为梯度的最大限制 
		$this->_arr_value['autoStageMax_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stagePriceIndex'] = $bs->popUint32_t();	//<uint32_t> 满足梯度价下标，从1开始（商详不用） 
		$this->_arr_value['stagePriceIndex_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['discountType'] = $bs->popUint32_t();	//<uint32_t> 满足规则的优惠value类型：1减金额，2券id，3折扣，4商品id，5积分，6折扣，满包邮时此字段无用,手动梯度为整个梯度 
		$this->_arr_value['discountType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['discountValue'] = $bs->popObject('stl_vector<stl_string>');	//<std::vector<std::string> > 满足规则的优惠value，如满XX减50，此处为5000；满送券，此处为券id,送积分时此处为积分，折扣时显示**折；满包邮时此字段无用,手动梯度的话为整个梯度价的vector，存了每个价格，自动梯度则只有一个 
		$this->_arr_value['discountValue_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['discountUseNum'] = $bs->popUint32_t();	//<uint32_t> 满足规则的优惠的使用数量(商详页无用)，如优惠券的数量，无数量要求时，默认为1，满包邮时此字段无用 
		$this->_arr_value['discountUseNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['unfillDiffValue'] = $bs->popUint32_t();	//<uint32_t> 待满足规则的差额(商详页不用)，如差10元，可使用满立减，此处为1000
		$this->_arr_value['unfillDiffValue_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ext'] = $bs->popObject('stl_map<stl_string,stl_string>');	//<std::map<std::string,std::string> > 扩展字段
		$this->_arr_value['ext_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\promotion\bo;	//source idl: com.icson.sps.idl.CheckPromotionInfoReq.java
if (!class_exists('icson\promotion\bo\SpsItemBo', false)) {
class SpsItemBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号 (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $itemId;	//<std::string> 商品id，调用方输入(版本>=0)
	private $itemId_u;	//<uint8_t> (版本>=0)
	private $metaId;	//<uint32_t> 商品品类id,调用方输入,有就填写，就是易讯的小类(版本>=0)
	private $metaId_u;	//<uint8_t> (版本>=0)
	private $sellerId;	//<uint64_t> 卖家id,调用方输入,以后可能要用，现在可不填(版本>=0)
	private $sellerId_u;	//<uint8_t> (版本>=0)
	private $brand;	//<uint64_t> 品牌id,调用方输入，有就填进来哈(版本>=0)
	private $brand_u;	//<uint8_t> (版本>=0)
	private $skuId;	//<uint64_t> SKUID，以后可能用(版本>=0)
	private $skuId_u;	//<uint8_t> (版本>=0)
	private $itemWareHouseid;	//<uint32_t> 商品仓id，调用方传入(版本>=0)
	private $itemWareHouseid_u;	//<uint8_t> (版本>=0)
	private $priceSourceScene;	//<std::set<std::string> > 价格来源id及场景id, 字符串格式为来源id|场景id(版本>=0)
	private $priceSourceScene_u;	//<uint8_t> (版本>=0)
	private $edmCode;	//<std::set<std::string> > edm代码,调用方输入[多价新增](版本>=0)
	private $edmCode_u;	//<uint8_t> (版本>=0)
	private $actId;	//<std::set<uint32_t> > 活动id,调用方输入，暂时不用(版本>=0)
	private $actId_u;	//<uint8_t> (版本>=0)
	private $itemPrice;	//<uint32_t> 商品促销批价前价格,n件商品，即为n件之和，这里注意，如果在促销之前有其他优惠减价，要传入的是优惠后价格(版本>=0)
	private $itemPrice_u;	//<uint8_t> (版本>=0)
	private $itemUnitPrice;	//<uint32_t> 商品促销批价前单价,不考虑商品件数，调用方输入 (版本>=0)
	private $itemUnitPrice_u;	//<uint8_t> (版本>=0)
	private $itemCouponDiscount;	//<uint32_t> 分摊到商品维度的优惠券优惠金额,调用方输入 (版本>=0)
	private $itemCouponDiscount_u;	//<uint8_t> (版本>=0)
	private $itemNum;	//<uint32_t> 商品数量,调用方输入 (版本>=0)
	private $itemNum_u;	//<uint8_t> (版本>=0)
	private $pkgId;	//<uint32_t> 套餐id,调用方输入,最好填上 (版本>=0)
	private $pkgId_u;	//<uint8_t> (版本>=0)
	private $itemType;	//<uint32_t> 商品类型：0为普通商品，1为套餐赠品等，标识是否为套餐商品或赠品等，根据商品系统确定，调用方输入,一定要填写 (版本>=0)
	private $itemType_u;	//<uint8_t> (版本>=0)
	private $itemCategoryIdList;	//<std::vector<uint64_t> > 商品类目id Vector,内部使用，目前就3个，大中小类 (版本>=0)
	private $itemCategoryIdList_u;	//<uint8_t> (版本>=0)
	private $itemFullMinusPrice;	//<uint32_t> 满立减/赠后价格,满送券的记录在批价路径上 (版本>=0)
	private $itemFullMinusPrice_u;	//<uint8_t> (版本>=0)
	private $itemFullMinusDiscount;	//<uint32_t> 满立减/赠折扣 (版本>=0)
	private $itemFullMinusDiscount_u;	//<uint8_t> (版本>=0)
	private $itemFullAddPrice;	//<uint32_t> 满加价购后价格,一期不用 (版本>=0)
	private $itemFullAddPrice_u;	//<uint8_t> (版本>=0)
	private $itemFullAddDiscount;	//<uint32_t> 满加价购优惠，一期不用 (版本>=0)
	private $itemFullAddDiscount_u;	//<uint8_t> (版本>=0)
	private $spsItemOpPathList;	//<std::vector<icson::promotion::bo::CSpsItemOpPathBo> > 操作路径列表 (版本>=0)
	private $spsItemOpPathList_u;	//<uint8_t> (版本>=0)
	private $itemPromotionPrice;	//<uint32_t> 商品促销后价格,接口输出，就是输出的优惠价格 (版本>=0)
	private $itemPromotionPrice_u;	//<uint8_t> (版本>=0)
	private $itemPromotionDiscount;	//<uint32_t> 商品促销优惠,接口输出 (版本>=0)
	private $itemPromotionDiscount_u;	//<uint8_t> (版本>=0)
	private $itemMailFree;	//<uint32_t> 该商品是否包邮，1不包邮，2包邮，接口输出,一期不管 (版本>=0)
	private $itemMailFree_u;	//<uint8_t> (版本>=0)
	private $priceInfoList;	//<std::vector<icson::multprice::bo::CMultPriceBo> > 商品的多价list [多价使用]，购物流程vector只有一个元素 (版本>=0)
	private $priceInfoList_u;	//<uint8_t> (版本>=0)
	private $ext;	//<std::map<std::string,std::string> > 扩展字段(版本>=0)
	private $ext_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->itemId = "";	//<std::string>
		$this->itemId_u = 0;	//<uint8_t>
		$this->metaId = 0;	//<uint32_t>
		$this->metaId_u = 0;	//<uint8_t>
		$this->sellerId = 0;	//<uint64_t>
		$this->sellerId_u = 0;	//<uint8_t>
		$this->brand = 0;	//<uint64_t>
		$this->brand_u = 0;	//<uint8_t>
		$this->skuId = 0;	//<uint64_t>
		$this->skuId_u = 0;	//<uint8_t>
		$this->itemWareHouseid = 0;	//<uint32_t>
		$this->itemWareHouseid_u = 0;	//<uint8_t>
		$this->priceSourceScene = new \stl_set2('stl_string');	//<std::set<std::string> >
		$this->priceSourceScene_u = 0;	//<uint8_t>
		$this->edmCode = new \stl_set2('stl_string');	//<std::set<std::string> >
		$this->edmCode_u = 0;	//<uint8_t>
		$this->actId = new \stl_set2('uint32_t');	//<std::set<uint32_t> >
		$this->actId_u = 0;	//<uint8_t>
		$this->itemPrice = 0;	//<uint32_t>
		$this->itemPrice_u = 0;	//<uint8_t>
		$this->itemUnitPrice = 0;	//<uint32_t>
		$this->itemUnitPrice_u = 0;	//<uint8_t>
		$this->itemCouponDiscount = 0;	//<uint32_t>
		$this->itemCouponDiscount_u = 0;	//<uint8_t>
		$this->itemNum = 0;	//<uint32_t>
		$this->itemNum_u = 0;	//<uint8_t>
		$this->pkgId = 0;	//<uint32_t>
		$this->pkgId_u = 0;	//<uint8_t>
		$this->itemType = 0;	//<uint32_t>
		$this->itemType_u = 0;	//<uint8_t>
		$this->itemCategoryIdList = new \stl_vector2('uint64_t');	//<std::vector<uint64_t> >
		$this->itemCategoryIdList_u = 0;	//<uint8_t>
		$this->itemFullMinusPrice = 0;	//<uint32_t>
		$this->itemFullMinusPrice_u = 0;	//<uint8_t>
		$this->itemFullMinusDiscount = 0;	//<uint32_t>
		$this->itemFullMinusDiscount_u = 0;	//<uint8_t>
		$this->itemFullAddPrice = 0;	//<uint32_t>
		$this->itemFullAddPrice_u = 0;	//<uint8_t>
		$this->itemFullAddDiscount = 0;	//<uint32_t>
		$this->itemFullAddDiscount_u = 0;	//<uint8_t>
		$this->spsItemOpPathList = new \stl_vector2('\icson\promotion\bo\SpsItemOpPathBo');	//<std::vector<icson::promotion::bo::CSpsItemOpPathBo> >
		$this->spsItemOpPathList_u = 0;	//<uint8_t>
		$this->itemPromotionPrice = 0;	//<uint32_t>
		$this->itemPromotionPrice_u = 0;	//<uint8_t>
		$this->itemPromotionDiscount = 0;	//<uint32_t>
		$this->itemPromotionDiscount_u = 0;	//<uint8_t>
		$this->itemMailFree = 0;	//<uint32_t>
		$this->itemMailFree_u = 0;	//<uint8_t>
		$this->priceInfoList = new \stl_vector2('\icson\multprice\bo\MultPriceBo');	//<std::vector<icson::multprice::bo::CMultPriceBo> >
		$this->priceInfoList_u = 0;	//<uint8_t>
		$this->ext = new \stl_map2('stl_string,stl_string');	//<std::map<std::string,std::string> >
		$this->ext_u = 0;	//<uint8_t>
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
			exit("\icson\promotion\bo\SpsItemBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\promotion\bo\SpsItemBo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t>  版本号 
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushString($this->itemId);	//<std::string> 商品id，调用方输入
		$bs->pushUint8_t($this->itemId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->metaId);	//<uint32_t> 商品品类id,调用方输入,有就填写，就是易讯的小类
		$bs->pushUint8_t($this->metaId_u);	//<uint8_t> 
		$bs->pushUint64_t($this->sellerId);	//<uint64_t> 卖家id,调用方输入,以后可能要用，现在可不填
		$bs->pushUint8_t($this->sellerId_u);	//<uint8_t> 
		$bs->pushUint64_t($this->brand);	//<uint64_t> 品牌id,调用方输入，有就填进来哈
		$bs->pushUint8_t($this->brand_u);	//<uint8_t> 
		$bs->pushUint64_t($this->skuId);	//<uint64_t> SKUID，以后可能用
		$bs->pushUint8_t($this->skuId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemWareHouseid);	//<uint32_t> 商品仓id，调用方传入
		$bs->pushUint8_t($this->itemWareHouseid_u);	//<uint8_t> 
		$bs->pushObject($this->priceSourceScene,'stl_set');	//<std::set<std::string> > 价格来源id及场景id, 字符串格式为来源id|场景id
		$bs->pushUint8_t($this->priceSourceScene_u);	//<uint8_t> 
		$bs->pushObject($this->edmCode,'stl_set');	//<std::set<std::string> > edm代码,调用方输入[多价新增]
		$bs->pushUint8_t($this->edmCode_u);	//<uint8_t> 
		$bs->pushObject($this->actId,'stl_set');	//<std::set<uint32_t> > 活动id,调用方输入，暂时不用
		$bs->pushUint8_t($this->actId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemPrice);	//<uint32_t> 商品促销批价前价格,n件商品，即为n件之和，这里注意，如果在促销之前有其他优惠减价，要传入的是优惠后价格
		$bs->pushUint8_t($this->itemPrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemUnitPrice);	//<uint32_t> 商品促销批价前单价,不考虑商品件数，调用方输入 
		$bs->pushUint8_t($this->itemUnitPrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemCouponDiscount);	//<uint32_t> 分摊到商品维度的优惠券优惠金额,调用方输入 
		$bs->pushUint8_t($this->itemCouponDiscount_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemNum);	//<uint32_t> 商品数量,调用方输入 
		$bs->pushUint8_t($this->itemNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->pkgId);	//<uint32_t> 套餐id,调用方输入,最好填上 
		$bs->pushUint8_t($this->pkgId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemType);	//<uint32_t> 商品类型：0为普通商品，1为套餐赠品等，标识是否为套餐商品或赠品等，根据商品系统确定，调用方输入,一定要填写 
		$bs->pushUint8_t($this->itemType_u);	//<uint8_t> 
		$bs->pushObject($this->itemCategoryIdList,'stl_vector');	//<std::vector<uint64_t> > 商品类目id Vector,内部使用，目前就3个，大中小类 
		$bs->pushUint8_t($this->itemCategoryIdList_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemFullMinusPrice);	//<uint32_t> 满立减/赠后价格,满送券的记录在批价路径上 
		$bs->pushUint8_t($this->itemFullMinusPrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemFullMinusDiscount);	//<uint32_t> 满立减/赠折扣 
		$bs->pushUint8_t($this->itemFullMinusDiscount_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemFullAddPrice);	//<uint32_t> 满加价购后价格,一期不用 
		$bs->pushUint8_t($this->itemFullAddPrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemFullAddDiscount);	//<uint32_t> 满加价购优惠，一期不用 
		$bs->pushUint8_t($this->itemFullAddDiscount_u);	//<uint8_t> 
		$bs->pushObject($this->spsItemOpPathList,'stl_vector');	//<std::vector<icson::promotion::bo::CSpsItemOpPathBo> > 操作路径列表 
		$bs->pushUint8_t($this->spsItemOpPathList_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemPromotionPrice);	//<uint32_t> 商品促销后价格,接口输出，就是输出的优惠价格 
		$bs->pushUint8_t($this->itemPromotionPrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemPromotionDiscount);	//<uint32_t> 商品促销优惠,接口输出 
		$bs->pushUint8_t($this->itemPromotionDiscount_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemMailFree);	//<uint32_t> 该商品是否包邮，1不包邮，2包邮，接口输出,一期不管 
		$bs->pushUint8_t($this->itemMailFree_u);	//<uint8_t> 
		$bs->pushObject($this->priceInfoList,'stl_vector');	//<std::vector<icson::multprice::bo::CMultPriceBo> > 商品的多价list [多价使用]，购物流程vector只有一个元素 
		$bs->pushUint8_t($this->priceInfoList_u);	//<uint8_t> 
		$bs->pushObject($this->ext,'stl_map');	//<std::map<std::string,std::string> > 扩展字段
		$bs->pushUint8_t($this->ext_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号 
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemId'] = $bs->popString();	//<std::string> 商品id，调用方输入
		$this->_arr_value['itemId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['metaId'] = $bs->popUint32_t();	//<uint32_t> 商品品类id,调用方输入,有就填写，就是易讯的小类
		$this->_arr_value['metaId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerId'] = $bs->popUint64_t();	//<uint64_t> 卖家id,调用方输入,以后可能要用，现在可不填
		$this->_arr_value['sellerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['brand'] = $bs->popUint64_t();	//<uint64_t> 品牌id,调用方输入，有就填进来哈
		$this->_arr_value['brand_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuId'] = $bs->popUint64_t();	//<uint64_t> SKUID，以后可能用
		$this->_arr_value['skuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemWareHouseid'] = $bs->popUint32_t();	//<uint32_t> 商品仓id，调用方传入
		$this->_arr_value['itemWareHouseid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceSourceScene'] = $bs->popObject('stl_set<stl_string>');	//<std::set<std::string> > 价格来源id及场景id, 字符串格式为来源id|场景id
		$this->_arr_value['priceSourceScene_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['edmCode'] = $bs->popObject('stl_set<stl_string>');	//<std::set<std::string> > edm代码,调用方输入[多价新增]
		$this->_arr_value['edmCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['actId'] = $bs->popObject('stl_set<uint32_t>');	//<std::set<uint32_t> > 活动id,调用方输入，暂时不用
		$this->_arr_value['actId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemPrice'] = $bs->popUint32_t();	//<uint32_t> 商品促销批价前价格,n件商品，即为n件之和，这里注意，如果在促销之前有其他优惠减价，要传入的是优惠后价格
		$this->_arr_value['itemPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemUnitPrice'] = $bs->popUint32_t();	//<uint32_t> 商品促销批价前单价,不考虑商品件数，调用方输入 
		$this->_arr_value['itemUnitPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemCouponDiscount'] = $bs->popUint32_t();	//<uint32_t> 分摊到商品维度的优惠券优惠金额,调用方输入 
		$this->_arr_value['itemCouponDiscount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemNum'] = $bs->popUint32_t();	//<uint32_t> 商品数量,调用方输入 
		$this->_arr_value['itemNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['pkgId'] = $bs->popUint32_t();	//<uint32_t> 套餐id,调用方输入,最好填上 
		$this->_arr_value['pkgId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemType'] = $bs->popUint32_t();	//<uint32_t> 商品类型：0为普通商品，1为套餐赠品等，标识是否为套餐商品或赠品等，根据商品系统确定，调用方输入,一定要填写 
		$this->_arr_value['itemType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemCategoryIdList'] = $bs->popObject('stl_vector<uint64_t>');	//<std::vector<uint64_t> > 商品类目id Vector,内部使用，目前就3个，大中小类 
		$this->_arr_value['itemCategoryIdList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemFullMinusPrice'] = $bs->popUint32_t();	//<uint32_t> 满立减/赠后价格,满送券的记录在批价路径上 
		$this->_arr_value['itemFullMinusPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemFullMinusDiscount'] = $bs->popUint32_t();	//<uint32_t> 满立减/赠折扣 
		$this->_arr_value['itemFullMinusDiscount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemFullAddPrice'] = $bs->popUint32_t();	//<uint32_t> 满加价购后价格,一期不用 
		$this->_arr_value['itemFullAddPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemFullAddDiscount'] = $bs->popUint32_t();	//<uint32_t> 满加价购优惠，一期不用 
		$this->_arr_value['itemFullAddDiscount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['spsItemOpPathList'] = $bs->popObject('stl_vector<\icson\promotion\bo\SpsItemOpPathBo>');	//<std::vector<icson::promotion::bo::CSpsItemOpPathBo> > 操作路径列表 
		$this->_arr_value['spsItemOpPathList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemPromotionPrice'] = $bs->popUint32_t();	//<uint32_t> 商品促销后价格,接口输出，就是输出的优惠价格 
		$this->_arr_value['itemPromotionPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemPromotionDiscount'] = $bs->popUint32_t();	//<uint32_t> 商品促销优惠,接口输出 
		$this->_arr_value['itemPromotionDiscount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemMailFree'] = $bs->popUint32_t();	//<uint32_t> 该商品是否包邮，1不包邮，2包邮，接口输出,一期不管 
		$this->_arr_value['itemMailFree_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceInfoList'] = $bs->popObject('stl_vector<\icson\multprice\bo\MultPriceBo>');	//<std::vector<icson::multprice::bo::CMultPriceBo> > 商品的多价list [多价使用]，购物流程vector只有一个元素 
		$this->_arr_value['priceInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ext'] = $bs->popObject('stl_map<stl_string,stl_string>');	//<std::map<std::string,std::string> > 扩展字段
		$this->_arr_value['ext_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\promotion\bo;	//source idl: com.icson.sps.idl.SpsItemBo.java
if (!class_exists('icson\promotion\bo\SpsItemOpPathBo', false)) {
class SpsItemOpPathBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号 (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $ruleType;	//<uint32_t> 促销类型:参考文档，可能同时包括多价：1和促销：2(版本>=0)
	private $ruleType_u;	//<uint8_t> (版本>=0)
	private $beforePrice;	//<uint32_t> 优惠前商品价格 (版本>=0)
	private $beforePrice_u;	//<uint8_t> (版本>=0)
	private $afterPrice;	//<uint32_t> 优惠后商品价格 (版本>=0)
	private $afterPrice_u;	//<uint8_t> (版本>=0)
	private $ruleId;	//<uint32_t> 促销规则ID (版本>=0)
	private $ruleId_u;	//<uint8_t> (版本>=0)
	private $descInfo;	//<std::string> 优惠描述信息 (版本>=0)
	private $descInfo_u;	//<uint8_t> (版本>=0)
	private $discountInfo;	//<std::string> 优惠信息，记录送积分之类的 (版本>=0)
	private $discountInfo_u;	//<uint8_t> (版本>=0)
	private $discountType;	//<uint32_t> 优惠信息类型，1减金额，2券id，3折扣，4商品id，5积分，6折扣 (版本>=0)
	private $discountType_u;	//<uint8_t> (版本>=0)
	private $conditionInfo;	//<std::string> 满足条件信息 (版本>=0)
	private $conditionInfo_u;	//<uint8_t> (版本>=0)
	private $conditionType;	//<uint32_t> 满足条件类型 0:无条件，1：金额，2：数量 (版本>=0)
	private $conditionType_u;	//<uint8_t> (版本>=0)
	private $conditionIndex;	//<uint32_t> 满足条件梯度下标，自动梯度则为自动次数(商详不用) (版本>=0)
	private $conditionIndex_u;	//<uint8_t> (版本>=0)
	private $sellerId;	//<uint64_t> 规则卖家id，以后可能会用,一期无用 (版本>=0)
	private $sellerId_u;	//<uint8_t> (版本>=0)
	private $priceCoster;	//<uint32_t> 成本分摊人 (版本>=0)
	private $priceCoster_u;	//<uint8_t> (版本>=0)
	private $ext;	//<std::map<std::string,std::string> > 扩展字段(版本>=0)
	private $ext_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->ruleType = 0;	//<uint32_t>
		$this->ruleType_u = 0;	//<uint8_t>
		$this->beforePrice = 0;	//<uint32_t>
		$this->beforePrice_u = 0;	//<uint8_t>
		$this->afterPrice = 0;	//<uint32_t>
		$this->afterPrice_u = 0;	//<uint8_t>
		$this->ruleId = 0;	//<uint32_t>
		$this->ruleId_u = 0;	//<uint8_t>
		$this->descInfo = "";	//<std::string>
		$this->descInfo_u = 0;	//<uint8_t>
		$this->discountInfo = "";	//<std::string>
		$this->discountInfo_u = 0;	//<uint8_t>
		$this->discountType = 0;	//<uint32_t>
		$this->discountType_u = 0;	//<uint8_t>
		$this->conditionInfo = "";	//<std::string>
		$this->conditionInfo_u = 0;	//<uint8_t>
		$this->conditionType = 0;	//<uint32_t>
		$this->conditionType_u = 0;	//<uint8_t>
		$this->conditionIndex = 0;	//<uint32_t>
		$this->conditionIndex_u = 0;	//<uint8_t>
		$this->sellerId = 0;	//<uint64_t>
		$this->sellerId_u = 0;	//<uint8_t>
		$this->priceCoster = 0;	//<uint32_t>
		$this->priceCoster_u = 0;	//<uint8_t>
		$this->ext = new \stl_map2('stl_string,stl_string');	//<std::map<std::string,std::string> >
		$this->ext_u = 0;	//<uint8_t>
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
			exit("\icson\promotion\bo\SpsItemOpPathBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\promotion\bo\SpsItemOpPathBo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t>  版本号 
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->ruleType);	//<uint32_t> 促销类型:参考文档，可能同时包括多价：1和促销：2
		$bs->pushUint8_t($this->ruleType_u);	//<uint8_t> 
		$bs->pushUint32_t($this->beforePrice);	//<uint32_t> 优惠前商品价格 
		$bs->pushUint8_t($this->beforePrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->afterPrice);	//<uint32_t> 优惠后商品价格 
		$bs->pushUint8_t($this->afterPrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->ruleId);	//<uint32_t> 促销规则ID 
		$bs->pushUint8_t($this->ruleId_u);	//<uint8_t> 
		$bs->pushString($this->descInfo);	//<std::string> 优惠描述信息 
		$bs->pushUint8_t($this->descInfo_u);	//<uint8_t> 
		$bs->pushString($this->discountInfo);	//<std::string> 优惠信息，记录送积分之类的 
		$bs->pushUint8_t($this->discountInfo_u);	//<uint8_t> 
		$bs->pushUint32_t($this->discountType);	//<uint32_t> 优惠信息类型，1减金额，2券id，3折扣，4商品id，5积分，6折扣 
		$bs->pushUint8_t($this->discountType_u);	//<uint8_t> 
		$bs->pushString($this->conditionInfo);	//<std::string> 满足条件信息 
		$bs->pushUint8_t($this->conditionInfo_u);	//<uint8_t> 
		$bs->pushUint32_t($this->conditionType);	//<uint32_t> 满足条件类型 0:无条件，1：金额，2：数量 
		$bs->pushUint8_t($this->conditionType_u);	//<uint8_t> 
		$bs->pushUint32_t($this->conditionIndex);	//<uint32_t> 满足条件梯度下标，自动梯度则为自动次数(商详不用) 
		$bs->pushUint8_t($this->conditionIndex_u);	//<uint8_t> 
		$bs->pushUint64_t($this->sellerId);	//<uint64_t> 规则卖家id，以后可能会用,一期无用 
		$bs->pushUint8_t($this->sellerId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceCoster);	//<uint32_t> 成本分摊人 
		$bs->pushUint8_t($this->priceCoster_u);	//<uint8_t> 
		$bs->pushObject($this->ext,'stl_map');	//<std::map<std::string,std::string> > 扩展字段
		$bs->pushUint8_t($this->ext_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号 
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleType'] = $bs->popUint32_t();	//<uint32_t> 促销类型:参考文档，可能同时包括多价：1和促销：2
		$this->_arr_value['ruleType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['beforePrice'] = $bs->popUint32_t();	//<uint32_t> 优惠前商品价格 
		$this->_arr_value['beforePrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['afterPrice'] = $bs->popUint32_t();	//<uint32_t> 优惠后商品价格 
		$this->_arr_value['afterPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleId'] = $bs->popUint32_t();	//<uint32_t> 促销规则ID 
		$this->_arr_value['ruleId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['descInfo'] = $bs->popString();	//<std::string> 优惠描述信息 
		$this->_arr_value['descInfo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['discountInfo'] = $bs->popString();	//<std::string> 优惠信息，记录送积分之类的 
		$this->_arr_value['discountInfo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['discountType'] = $bs->popUint32_t();	//<uint32_t> 优惠信息类型，1减金额，2券id，3折扣，4商品id，5积分，6折扣 
		$this->_arr_value['discountType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['conditionInfo'] = $bs->popString();	//<std::string> 满足条件信息 
		$this->_arr_value['conditionInfo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['conditionType'] = $bs->popUint32_t();	//<uint32_t> 满足条件类型 0:无条件，1：金额，2：数量 
		$this->_arr_value['conditionType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['conditionIndex'] = $bs->popUint32_t();	//<uint32_t> 满足条件梯度下标，自动梯度则为自动次数(商详不用) 
		$this->_arr_value['conditionIndex_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerId'] = $bs->popUint64_t();	//<uint64_t> 规则卖家id，以后可能会用,一期无用 
		$this->_arr_value['sellerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceCoster'] = $bs->popUint32_t();	//<uint32_t> 成本分摊人 
		$this->_arr_value['priceCoster_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ext'] = $bs->popObject('stl_map<stl_string,stl_string>');	//<std::map<std::string,std::string> > 扩展字段
		$this->_arr_value['ext_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\multprice\bo;	//source idl: com.icson.sps.idl.SpsItemBo.java
if (!class_exists('icson\multprice\bo\MultPriceBo', false)) {
class MultPriceBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号 (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $priceType;	//<uint32_t> 价格类型，预留，暂时不用 (版本>=0)
	private $priceType_u;	//<uint8_t> (版本>=0)
	private $priceSceneId;	//<uint64_t> 场景 id (版本>=0)
	private $priceSceneId_u;	//<uint8_t> (版本>=0)
	private $priceSourceId;	//<uint64_t> 来源 id (版本>=0)
	private $priceSourceId_u;	//<uint8_t> (版本>=0)
	private $priceName;	//<std::string> 多价规则名称描述，选填 (版本>=0)
	private $priceName_u;	//<uint8_t> (版本>=0)
	private $priceDesc;	//<std::string> 价格规则描述 (版本>=0)
	private $priceDesc_u;	//<uint8_t> (版本>=0)
	private $pricePromotionUrl;	//<std::string> 活动规则url，暂时不用 (版本>=0)
	private $pricePromotionUrl_u;	//<uint8_t> (版本>=0)
	private $priceBase;	//<uint32_t> 批价的基准价类型，单个商品，预留 (版本>=0)
	private $priceBase_u;	//<uint8_t> (版本>=0)
	private $priceOpType;	//<uint16_t> 商品促销多价的优惠方式，1定价，2减价，3折扣 (版本>=0)
	private $priceOpType_u;	//<uint8_t> (版本>=0)
	private $unitPriceOpNum;	//<uint32_t> 商品促销多价的操作金额，不考虑商品数量，如98折传 98，减10元传 10，定价为5元传 5 (版本>=0)
	private $unitPriceOpNum_u;	//<uint8_t> (版本>=0)
	private $priceBeforeFavor;	//<uint32_t> 该款商品的优惠前价格，有n件商品，则为n件总值 (版本>=0)
	private $priceBeforeFavor_u;	//<uint8_t> (版本>=0)
	private $priceAfterFavor;	//<uint32_t> 该款商品的优惠后价格，有n件商品，则为n件总值 (版本>=0)
	private $priceAfterFavor_u;	//<uint8_t> (版本>=0)
	private $priceDiscount;	//<uint32_t> 该款商品总优惠的金额，必填 (版本>=0)
	private $priceDiscount_u;	//<uint8_t> (版本>=0)
	private $unitPriceBeforeFavor;	//<uint32_t> 单个商品优惠前价格，即不考虑商品数量 (版本>=0)
	private $unitPriceBeforeFavor_u;	//<uint8_t> (版本>=0)
	private $unitPriceAfterFavor;	//<uint32_t> 单个商品多价优惠后的价价格，即不考虑商品数量 (版本>=0)
	private $unitPriceAfterFavor_u;	//<uint8_t> (版本>=0)
	private $unitPriceDiscount;	//<uint32_t> 单个商品多价的优惠金额，即不考虑商品数量 (版本>=0)
	private $unitPriceDiscount_u;	//<uint8_t> (版本>=0)
	private $multPriceDiscount;	//<uint32_t> 该款商品非节能补贴的优惠金额，必填 (版本>=0)
	private $multPriceDiscount_u;	//<uint8_t> (版本>=0)
	private $energySaveDiscount;	//<uint32_t> 该款商品节能补贴的优惠金额，必填 (版本>=0)
	private $energySaveDiscount_u;	//<uint8_t> (版本>=0)
	private $energySaveName;	//<std::string> 节能补贴名称，选填 (版本>=0)
	private $energySaveName_u;	//<uint8_t> (版本>=0)
	private $energySaveDesc;	//<std::string> 节能补贴描述 (版本>=0)
	private $energySaveDesc_u;	//<uint8_t> (版本>=0)
	private $priceRule;	//<std::string> 价格规则，目前仅阶梯价使用 (版本>=0)
	private $priceRule_u;	//<uint8_t> (版本>=0)
	private $needNum;	//<uint32_t> 阶梯价差额数，即差X件，可享受阶梯规则，如大于0，则可用于展示 (版本>=0)
	private $needNum_u;	//<uint8_t> (版本>=0)
	private $priceStartTime;	//<uint32_t> 规则开始时间，必填 (版本>=0)
	private $priceStartTime_u;	//<uint8_t> (版本>=0)
	private $priceEndTime;	//<uint32_t> 规则结束时间，必填 (版本>=0)
	private $priceEndTime_u;	//<uint8_t> (版本>=0)
	private $priceBuyLimitRule;	//<std::string> 限购规则 (版本>=0)
	private $priceBuyLimitRule_u;	//<uint8_t> (版本>=0)
	private $priceBuyLimitFlag;	//<uint32_t> 限制标志位，超过限购时为1，表示商品不可购买 (版本>=0)
	private $priceBuyLimitFlag_u;	//<uint8_t> (版本>=0)
	private $priceBuyLimitNum;	//<uint32_t> 商品剩余的限购数量 (版本>=0)
	private $priceBuyLimitNum_u;	//<uint8_t> (版本>=0)
	private $priceCoster;	//<uint32_t> 成本分摊人 (版本>=0)
	private $priceCoster_u;	//<uint8_t> (版本>=0)
	private $ext;	//<std::map<std::string,std::string> > 扩展字段(版本>=0)
	private $ext_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->priceType = 0;	//<uint32_t>
		$this->priceType_u = 0;	//<uint8_t>
		$this->priceSceneId = 0;	//<uint64_t>
		$this->priceSceneId_u = 0;	//<uint8_t>
		$this->priceSourceId = 0;	//<uint64_t>
		$this->priceSourceId_u = 0;	//<uint8_t>
		$this->priceName = "";	//<std::string>
		$this->priceName_u = 0;	//<uint8_t>
		$this->priceDesc = "";	//<std::string>
		$this->priceDesc_u = 0;	//<uint8_t>
		$this->pricePromotionUrl = "";	//<std::string>
		$this->pricePromotionUrl_u = 0;	//<uint8_t>
		$this->priceBase = 0;	//<uint32_t>
		$this->priceBase_u = 0;	//<uint8_t>
		$this->priceOpType = 0;	//<uint16_t>
		$this->priceOpType_u = 0;	//<uint8_t>
		$this->unitPriceOpNum = 0;	//<uint32_t>
		$this->unitPriceOpNum_u = 0;	//<uint8_t>
		$this->priceBeforeFavor = 0;	//<uint32_t>
		$this->priceBeforeFavor_u = 0;	//<uint8_t>
		$this->priceAfterFavor = 0;	//<uint32_t>
		$this->priceAfterFavor_u = 0;	//<uint8_t>
		$this->priceDiscount = 0;	//<uint32_t>
		$this->priceDiscount_u = 0;	//<uint8_t>
		$this->unitPriceBeforeFavor = 0;	//<uint32_t>
		$this->unitPriceBeforeFavor_u = 0;	//<uint8_t>
		$this->unitPriceAfterFavor = 0;	//<uint32_t>
		$this->unitPriceAfterFavor_u = 0;	//<uint8_t>
		$this->unitPriceDiscount = 0;	//<uint32_t>
		$this->unitPriceDiscount_u = 0;	//<uint8_t>
		$this->multPriceDiscount = 0;	//<uint32_t>
		$this->multPriceDiscount_u = 0;	//<uint8_t>
		$this->energySaveDiscount = 0;	//<uint32_t>
		$this->energySaveDiscount_u = 0;	//<uint8_t>
		$this->energySaveName = "";	//<std::string>
		$this->energySaveName_u = 0;	//<uint8_t>
		$this->energySaveDesc = "";	//<std::string>
		$this->energySaveDesc_u = 0;	//<uint8_t>
		$this->priceRule = "";	//<std::string>
		$this->priceRule_u = 0;	//<uint8_t>
		$this->needNum = 0;	//<uint32_t>
		$this->needNum_u = 0;	//<uint8_t>
		$this->priceStartTime = 0;	//<uint32_t>
		$this->priceStartTime_u = 0;	//<uint8_t>
		$this->priceEndTime = 0;	//<uint32_t>
		$this->priceEndTime_u = 0;	//<uint8_t>
		$this->priceBuyLimitRule = "";	//<std::string>
		$this->priceBuyLimitRule_u = 0;	//<uint8_t>
		$this->priceBuyLimitFlag = 0;	//<uint32_t>
		$this->priceBuyLimitFlag_u = 0;	//<uint8_t>
		$this->priceBuyLimitNum = 0;	//<uint32_t>
		$this->priceBuyLimitNum_u = 0;	//<uint8_t>
		$this->priceCoster = 0;	//<uint32_t>
		$this->priceCoster_u = 0;	//<uint8_t>
		$this->ext = new \stl_map2('stl_string,stl_string');	//<std::map<std::string,std::string> >
		$this->ext_u = 0;	//<uint8_t>
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
			exit("\icson\multprice\bo\MultPriceBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\multprice\bo\MultPriceBo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 版本号 
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceType);	//<uint32_t> 价格类型，预留，暂时不用 
		$bs->pushUint8_t($this->priceType_u);	//<uint8_t> 
		$bs->pushUint64_t($this->priceSceneId);	//<uint64_t> 场景 id 
		$bs->pushUint8_t($this->priceSceneId_u);	//<uint8_t> 
		$bs->pushUint64_t($this->priceSourceId);	//<uint64_t> 来源 id 
		$bs->pushUint8_t($this->priceSourceId_u);	//<uint8_t> 
		$bs->pushString($this->priceName);	//<std::string> 多价规则名称描述，选填 
		$bs->pushUint8_t($this->priceName_u);	//<uint8_t> 
		$bs->pushString($this->priceDesc);	//<std::string> 价格规则描述 
		$bs->pushUint8_t($this->priceDesc_u);	//<uint8_t> 
		$bs->pushString($this->pricePromotionUrl);	//<std::string> 活动规则url，暂时不用 
		$bs->pushUint8_t($this->pricePromotionUrl_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceBase);	//<uint32_t> 批价的基准价类型，单个商品，预留 
		$bs->pushUint8_t($this->priceBase_u);	//<uint8_t> 
		$bs->pushUint16_t($this->priceOpType);	//<uint16_t> 商品促销多价的优惠方式，1定价，2减价，3折扣 
		$bs->pushUint8_t($this->priceOpType_u);	//<uint8_t> 
		$bs->pushUint32_t($this->unitPriceOpNum);	//<uint32_t> 商品促销多价的操作金额，不考虑商品数量，如98折传 98，减10元传 10，定价为5元传 5 
		$bs->pushUint8_t($this->unitPriceOpNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceBeforeFavor);	//<uint32_t> 该款商品的优惠前价格，有n件商品，则为n件总值 
		$bs->pushUint8_t($this->priceBeforeFavor_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceAfterFavor);	//<uint32_t> 该款商品的优惠后价格，有n件商品，则为n件总值 
		$bs->pushUint8_t($this->priceAfterFavor_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceDiscount);	//<uint32_t> 该款商品总优惠的金额，必填 
		$bs->pushUint8_t($this->priceDiscount_u);	//<uint8_t> 
		$bs->pushUint32_t($this->unitPriceBeforeFavor);	//<uint32_t> 单个商品优惠前价格，即不考虑商品数量 
		$bs->pushUint8_t($this->unitPriceBeforeFavor_u);	//<uint8_t> 
		$bs->pushUint32_t($this->unitPriceAfterFavor);	//<uint32_t> 单个商品多价优惠后的价价格，即不考虑商品数量 
		$bs->pushUint8_t($this->unitPriceAfterFavor_u);	//<uint8_t> 
		$bs->pushUint32_t($this->unitPriceDiscount);	//<uint32_t> 单个商品多价的优惠金额，即不考虑商品数量 
		$bs->pushUint8_t($this->unitPriceDiscount_u);	//<uint8_t> 
		$bs->pushUint32_t($this->multPriceDiscount);	//<uint32_t> 该款商品非节能补贴的优惠金额，必填 
		$bs->pushUint8_t($this->multPriceDiscount_u);	//<uint8_t> 
		$bs->pushUint32_t($this->energySaveDiscount);	//<uint32_t> 该款商品节能补贴的优惠金额，必填 
		$bs->pushUint8_t($this->energySaveDiscount_u);	//<uint8_t> 
		$bs->pushString($this->energySaveName);	//<std::string> 节能补贴名称，选填 
		$bs->pushUint8_t($this->energySaveName_u);	//<uint8_t> 
		$bs->pushString($this->energySaveDesc);	//<std::string> 节能补贴描述 
		$bs->pushUint8_t($this->energySaveDesc_u);	//<uint8_t> 
		$bs->pushString($this->priceRule);	//<std::string> 价格规则，目前仅阶梯价使用 
		$bs->pushUint8_t($this->priceRule_u);	//<uint8_t> 
		$bs->pushUint32_t($this->needNum);	//<uint32_t> 阶梯价差额数，即差X件，可享受阶梯规则，如大于0，则可用于展示 
		$bs->pushUint8_t($this->needNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceStartTime);	//<uint32_t> 规则开始时间，必填 
		$bs->pushUint8_t($this->priceStartTime_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceEndTime);	//<uint32_t> 规则结束时间，必填 
		$bs->pushUint8_t($this->priceEndTime_u);	//<uint8_t> 
		$bs->pushString($this->priceBuyLimitRule);	//<std::string> 限购规则 
		$bs->pushUint8_t($this->priceBuyLimitRule_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceBuyLimitFlag);	//<uint32_t> 限制标志位，超过限购时为1，表示商品不可购买 
		$bs->pushUint8_t($this->priceBuyLimitFlag_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceBuyLimitNum);	//<uint32_t> 商品剩余的限购数量 
		$bs->pushUint8_t($this->priceBuyLimitNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceCoster);	//<uint32_t> 成本分摊人 
		$bs->pushUint8_t($this->priceCoster_u);	//<uint8_t> 
		$bs->pushObject($this->ext,'stl_map');	//<std::map<std::string,std::string> > 扩展字段
		$bs->pushUint8_t($this->ext_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号 
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceType'] = $bs->popUint32_t();	//<uint32_t> 价格类型，预留，暂时不用 
		$this->_arr_value['priceType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceSceneId'] = $bs->popUint64_t();	//<uint64_t> 场景 id 
		$this->_arr_value['priceSceneId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceSourceId'] = $bs->popUint64_t();	//<uint64_t> 来源 id 
		$this->_arr_value['priceSourceId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceName'] = $bs->popString();	//<std::string> 多价规则名称描述，选填 
		$this->_arr_value['priceName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceDesc'] = $bs->popString();	//<std::string> 价格规则描述 
		$this->_arr_value['priceDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['pricePromotionUrl'] = $bs->popString();	//<std::string> 活动规则url，暂时不用 
		$this->_arr_value['pricePromotionUrl_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceBase'] = $bs->popUint32_t();	//<uint32_t> 批价的基准价类型，单个商品，预留 
		$this->_arr_value['priceBase_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceOpType'] = $bs->popUint16_t();	//<uint16_t> 商品促销多价的优惠方式，1定价，2减价，3折扣 
		$this->_arr_value['priceOpType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['unitPriceOpNum'] = $bs->popUint32_t();	//<uint32_t> 商品促销多价的操作金额，不考虑商品数量，如98折传 98，减10元传 10，定价为5元传 5 
		$this->_arr_value['unitPriceOpNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceBeforeFavor'] = $bs->popUint32_t();	//<uint32_t> 该款商品的优惠前价格，有n件商品，则为n件总值 
		$this->_arr_value['priceBeforeFavor_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceAfterFavor'] = $bs->popUint32_t();	//<uint32_t> 该款商品的优惠后价格，有n件商品，则为n件总值 
		$this->_arr_value['priceAfterFavor_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceDiscount'] = $bs->popUint32_t();	//<uint32_t> 该款商品总优惠的金额，必填 
		$this->_arr_value['priceDiscount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['unitPriceBeforeFavor'] = $bs->popUint32_t();	//<uint32_t> 单个商品优惠前价格，即不考虑商品数量 
		$this->_arr_value['unitPriceBeforeFavor_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['unitPriceAfterFavor'] = $bs->popUint32_t();	//<uint32_t> 单个商品多价优惠后的价价格，即不考虑商品数量 
		$this->_arr_value['unitPriceAfterFavor_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['unitPriceDiscount'] = $bs->popUint32_t();	//<uint32_t> 单个商品多价的优惠金额，即不考虑商品数量 
		$this->_arr_value['unitPriceDiscount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['multPriceDiscount'] = $bs->popUint32_t();	//<uint32_t> 该款商品非节能补贴的优惠金额，必填 
		$this->_arr_value['multPriceDiscount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['energySaveDiscount'] = $bs->popUint32_t();	//<uint32_t> 该款商品节能补贴的优惠金额，必填 
		$this->_arr_value['energySaveDiscount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['energySaveName'] = $bs->popString();	//<std::string> 节能补贴名称，选填 
		$this->_arr_value['energySaveName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['energySaveDesc'] = $bs->popString();	//<std::string> 节能补贴描述 
		$this->_arr_value['energySaveDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceRule'] = $bs->popString();	//<std::string> 价格规则，目前仅阶梯价使用 
		$this->_arr_value['priceRule_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['needNum'] = $bs->popUint32_t();	//<uint32_t> 阶梯价差额数，即差X件，可享受阶梯规则，如大于0，则可用于展示 
		$this->_arr_value['needNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceStartTime'] = $bs->popUint32_t();	//<uint32_t> 规则开始时间，必填 
		$this->_arr_value['priceStartTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceEndTime'] = $bs->popUint32_t();	//<uint32_t> 规则结束时间，必填 
		$this->_arr_value['priceEndTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceBuyLimitRule'] = $bs->popString();	//<std::string> 限购规则 
		$this->_arr_value['priceBuyLimitRule_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceBuyLimitFlag'] = $bs->popUint32_t();	//<uint32_t> 限制标志位，超过限购时为1，表示商品不可购买 
		$this->_arr_value['priceBuyLimitFlag_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceBuyLimitNum'] = $bs->popUint32_t();	//<uint32_t> 商品剩余的限购数量 
		$this->_arr_value['priceBuyLimitNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceCoster'] = $bs->popUint32_t();	//<uint32_t> 成本分摊人 
		$this->_arr_value['priceCoster_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ext'] = $bs->popObject('stl_map<stl_string,stl_string>');	//<std::map<std::string,std::string> > 扩展字段
		$this->_arr_value['ext_u'] = $bs->popUint8_t();	//<uint8_t> 

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
