<?php
namespace icson\dashou\bo;	//source idl: com.icson.dashou.idl.GetTogetherSellRuleDetailResp.java
class TogethersellRuleBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t>  协议版本号 (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $type;	//<uint16_t> 需要获取的搭售类型，套餐 0x01 , 随心配 0x02， 延保 0x04，赠品 0x08，赠券 0x10，预约规则 0x20(版本>=0)
	private $type_u;	//<uint8_t> (版本>=0)
	private $ruleId;	//<uint32_t> 规则id(版本>=0)
	private $ruleId_u;	//<uint8_t> (版本>=0)
	private $rulePackage;	//<icson::dashou::bo::CDSPackage> 套餐信息列表(版本>=0)
	private $rulePackage_u;	//<uint8_t> (版本>=0)
	private $ruleCoupon;	//<icson::dashou::bo::CDSCoupon> 单品赠券列表(版本>=0)
	private $ruleCoupon_u;	//<uint8_t> (版本>=0)
	private $ruleGift;	//<icson::dashou::bo::CDSGift>  赠品组件列表(版本>=0)
	private $ruleGift_u;	//<uint8_t> (版本>=0)
	private $ruleRelative;	//<icson::dashou::bo::CDSRelativity> 随心配列表(版本>=0)
	private $ruleRelative_u;	//<uint8_t> (版本>=0)
	private $ruleWarranty;	//<icson::dashou::bo::CDSWarranty> 延保列表(版本>=0)
	private $ruleWarranty_u;	//<uint8_t> (版本>=0)
	private $ruleAppointment;	//<icson::dashou::bo::CDSAppointment> 预约规则列表(版本>=0)
	private $ruleAppointment_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->version_u = 0;	//<uint8_t>
		$this->type = 0;	//<uint16_t>
		$this->type_u = 0;	//<uint8_t>
		$this->ruleId = 0;	//<uint32_t>
		$this->ruleId_u = 0;	//<uint8_t>
		$this->rulePackage = new \icson\dashou\bo\DSPackage();	//<icson::dashou::bo::CDSPackage>
		$this->rulePackage_u = 0;	//<uint8_t>
		$this->ruleCoupon = new \icson\dashou\bo\DSCoupon();	//<icson::dashou::bo::CDSCoupon>
		$this->ruleCoupon_u = 0;	//<uint8_t>
		$this->ruleGift = new \icson\dashou\bo\DSGift();	//<icson::dashou::bo::CDSGift>
		$this->ruleGift_u = 0;	//<uint8_t>
		$this->ruleRelative = new \icson\dashou\bo\DSRelativity();	//<icson::dashou::bo::CDSRelativity>
		$this->ruleRelative_u = 0;	//<uint8_t>
		$this->ruleWarranty = new \icson\dashou\bo\DSWarranty();	//<icson::dashou::bo::CDSWarranty>
		$this->ruleWarranty_u = 0;	//<uint8_t>
		$this->ruleAppointment = new \icson\dashou\bo\DSAppointment();	//<icson::dashou::bo::CDSAppointment>
		$this->ruleAppointment_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\dashou\bo\TogethersellRuleBo\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();
					if(class_exists($class,false)){
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
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
			exit("icson\dashou\bo\TogethersellRuleBo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint16_t($this->version);	//<uint16_t>  协议版本号 
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint16_t($this->type);	//<uint16_t> 需要获取的搭售类型，套餐 0x01 , 随心配 0x02， 延保 0x04，赠品 0x08，赠券 0x10，预约规则 0x20
		$bs->pushUint8_t($this->type_u);	//<uint8_t> 
		$bs->pushUint32_t($this->ruleId);	//<uint32_t> 规则id
		$bs->pushUint8_t($this->ruleId_u);	//<uint8_t> 
		$bs->pushObject($this->rulePackage,'\icson\dashou\bo\DSPackage');	//<icson::dashou::bo::CDSPackage> 套餐信息列表
		$bs->pushUint8_t($this->rulePackage_u);	//<uint8_t> 
		$bs->pushObject($this->ruleCoupon,'\icson\dashou\bo\DSCoupon');	//<icson::dashou::bo::CDSCoupon> 单品赠券列表
		$bs->pushUint8_t($this->ruleCoupon_u);	//<uint8_t> 
		$bs->pushObject($this->ruleGift,'\icson\dashou\bo\DSGift');	//<icson::dashou::bo::CDSGift>  赠品组件列表
		$bs->pushUint8_t($this->ruleGift_u);	//<uint8_t> 
		$bs->pushObject($this->ruleRelative,'\icson\dashou\bo\DSRelativity');	//<icson::dashou::bo::CDSRelativity> 随心配列表
		$bs->pushUint8_t($this->ruleRelative_u);	//<uint8_t> 
		$bs->pushObject($this->ruleWarranty,'\icson\dashou\bo\DSWarranty');	//<icson::dashou::bo::CDSWarranty> 延保列表
		$bs->pushUint8_t($this->ruleWarranty_u);	//<uint8_t> 
		$bs->pushObject($this->ruleAppointment,'\icson\dashou\bo\DSAppointment');	//<icson::dashou::bo::CDSAppointment> 预约规则列表
		$bs->pushUint8_t($this->ruleAppointment_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t>  协议版本号 
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['type'] = $bs->popUint16_t();	//<uint16_t> 需要获取的搭售类型，套餐 0x01 , 随心配 0x02， 延保 0x04，赠品 0x08，赠券 0x10，预约规则 0x20
		$this->_arr_value['type_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleId'] = $bs->popUint32_t();	//<uint32_t> 规则id
		$this->_arr_value['ruleId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['rulePackage'] = $bs->popObject('\icson\dashou\bo\DSPackage');	//<icson::dashou::bo::CDSPackage> 套餐信息列表
		$this->_arr_value['rulePackage_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleCoupon'] = $bs->popObject('\icson\dashou\bo\DSCoupon');	//<icson::dashou::bo::CDSCoupon> 单品赠券列表
		$this->_arr_value['ruleCoupon_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleGift'] = $bs->popObject('\icson\dashou\bo\DSGift');	//<icson::dashou::bo::CDSGift>  赠品组件列表
		$this->_arr_value['ruleGift_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleRelative'] = $bs->popObject('\icson\dashou\bo\DSRelativity');	//<icson::dashou::bo::CDSRelativity> 随心配列表
		$this->_arr_value['ruleRelative_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleWarranty'] = $bs->popObject('\icson\dashou\bo\DSWarranty');	//<icson::dashou::bo::CDSWarranty> 延保列表
		$this->_arr_value['ruleWarranty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleAppointment'] = $bs->popObject('\icson\dashou\bo\DSAppointment');	//<icson::dashou::bo::CDSAppointment> 预约规则列表
		$this->_arr_value['ruleAppointment_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\dashou\bo;	//source idl: com.icson.dashou.idl.GetTogetherSellRuleDetailReq.java
class RuleFilterBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号   (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $type;	//<uint16_t> 需要获取的搭售类型，套餐 0x01 , 随心配 0x02， 延保 0x04，赠品 0x08，赠券 0x10，预约规则 0x20(版本>=0)
	private $ruleType_u;	//<uint8_t> (版本>=0)
	private $ruleId;	//<std::string> 关系ID(版本>=0)
	private $ruleId_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->type = 0;	//<uint16_t>
		$this->ruleType_u = 0;	//<uint8_t>
		$this->ruleId = "";	//<std::string>
		$this->ruleId_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\dashou\bo\RuleFilterBo\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();
					if(class_exists($class,false)){
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
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
			exit("icson\dashou\bo\RuleFilterBo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint16_t($this->type);	//<uint16_t> 需要获取的搭售类型，套餐 0x01 , 随心配 0x02， 延保 0x04，赠品 0x08，赠券 0x10，预约规则 0x20
		$bs->pushUint8_t($this->ruleType_u);	//<uint8_t> 
		$bs->pushString($this->ruleId);	//<std::string> 关系ID
		$bs->pushUint8_t($this->ruleId_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号   
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['type'] = $bs->popUint16_t();	//<uint16_t> 需要获取的搭售类型，套餐 0x01 , 随心配 0x02， 延保 0x04，赠品 0x08，赠券 0x10，预约规则 0x20
		$this->_arr_value['ruleType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleId'] = $bs->popString();	//<std::string> 关系ID
		$this->_arr_value['ruleId_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\dashou\bo;	//source idl: com.icson.dashou.idl.GetTogetherSellResp.java
class TogethersellItemBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t>  协议版本号 (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $mainproductId;	//<uint32_t> 主商品ID(版本>=0)
	private $mainproductId_u;	//<uint8_t> (版本>=0)
	private $skuId;	//<uint64_t> skuid 备用 (版本>=0)
	private $skuId_u;	//<uint8_t> (版本>=0)
	private $mainIdPackage;	//<std::vector<icson::dashou::bo::CDSPackage> >  套餐信息列表(版本>=0)
	private $mainIdPackage_u;	//<uint8_t> (版本>=0)
	private $mainIdCoupon;	//<std::vector<icson::dashou::bo::CDSCoupon> > 单品赠券列表(版本>=0)
	private $mainIdCoupon_u;	//<uint8_t> (版本>=0)
	private $mainIdGift;	//<std::vector<icson::dashou::bo::CDSGift> >  赠品组件列表(版本>=0)
	private $mainIdGift_u;	//<uint8_t> (版本>=0)
	private $mainIdRelative;	//<std::vector<icson::dashou::bo::CDSRelativityClass> > 随心配列表(版本>=0)
	private $mainIdRelative_u;	//<uint8_t> (版本>=0)
	private $mainIdWarranty;	//<std::vector<icson::dashou::bo::CDSWarranty> > 延保列表(版本>=0)
	private $mainIdWarranty_u;	//<uint8_t> (版本>=0)
	private $mainIdAppointment;	//<std::vector<icson::dashou::bo::CDSAppointment> > 预约列表(版本>=0)
	private $mainIdAppointment_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->version_u = 0;	//<uint8_t>
		$this->mainproductId = 0;	//<uint32_t>
		$this->mainproductId_u = 0;	//<uint8_t>
		$this->skuId = 0;	//<uint64_t>
		$this->skuId_u = 0;	//<uint8_t>
		$this->mainIdPackage = new \stl_vector2('\icson\dashou\bo\DSPackage');	//<std::vector<icson::dashou::bo::CDSPackage> >
		$this->mainIdPackage_u = 0;	//<uint8_t>
		$this->mainIdCoupon = new \stl_vector2('\icson\dashou\bo\DSCoupon');	//<std::vector<icson::dashou::bo::CDSCoupon> >
		$this->mainIdCoupon_u = 0;	//<uint8_t>
		$this->mainIdGift = new \stl_vector2('\icson\dashou\bo\DSGift');	//<std::vector<icson::dashou::bo::CDSGift> >
		$this->mainIdGift_u = 0;	//<uint8_t>
		$this->mainIdRelative = new \stl_vector2('\icson\dashou\bo\DSRelativityClass');	//<std::vector<icson::dashou::bo::CDSRelativityClass> >
		$this->mainIdRelative_u = 0;	//<uint8_t>
		$this->mainIdWarranty = new \stl_vector2('\icson\dashou\bo\DSWarranty');	//<std::vector<icson::dashou::bo::CDSWarranty> >
		$this->mainIdWarranty_u = 0;	//<uint8_t>
		$this->mainIdAppointment = new \stl_vector2('\icson\dashou\bo\DSAppointment');	//<std::vector<icson::dashou::bo::CDSAppointment> >
		$this->mainIdAppointment_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\dashou\bo\TogethersellItemBo\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();
					if(class_exists($class,false)){
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
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
			exit("icson\dashou\bo\TogethersellItemBo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint16_t($this->version);	//<uint16_t>  协议版本号 
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->mainproductId);	//<uint32_t> 主商品ID
		$bs->pushUint8_t($this->mainproductId_u);	//<uint8_t> 
		$bs->pushUint64_t($this->skuId);	//<uint64_t> skuid 备用 
		$bs->pushUint8_t($this->skuId_u);	//<uint8_t> 
		$bs->pushObject($this->mainIdPackage,'stl_vector');	//<std::vector<icson::dashou::bo::CDSPackage> >  套餐信息列表
		$bs->pushUint8_t($this->mainIdPackage_u);	//<uint8_t> 
		$bs->pushObject($this->mainIdCoupon,'stl_vector');	//<std::vector<icson::dashou::bo::CDSCoupon> > 单品赠券列表
		$bs->pushUint8_t($this->mainIdCoupon_u);	//<uint8_t> 
		$bs->pushObject($this->mainIdGift,'stl_vector');	//<std::vector<icson::dashou::bo::CDSGift> >  赠品组件列表
		$bs->pushUint8_t($this->mainIdGift_u);	//<uint8_t> 
		$bs->pushObject($this->mainIdRelative,'stl_vector');	//<std::vector<icson::dashou::bo::CDSRelativityClass> > 随心配列表
		$bs->pushUint8_t($this->mainIdRelative_u);	//<uint8_t> 
		$bs->pushObject($this->mainIdWarranty,'stl_vector');	//<std::vector<icson::dashou::bo::CDSWarranty> > 延保列表
		$bs->pushUint8_t($this->mainIdWarranty_u);	//<uint8_t> 
		$bs->pushObject($this->mainIdAppointment,'stl_vector');	//<std::vector<icson::dashou::bo::CDSAppointment> > 预约列表
		$bs->pushUint8_t($this->mainIdAppointment_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t>  协议版本号 
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mainproductId'] = $bs->popUint32_t();	//<uint32_t> 主商品ID
		$this->_arr_value['mainproductId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuId'] = $bs->popUint64_t();	//<uint64_t> skuid 备用 
		$this->_arr_value['skuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mainIdPackage'] = $bs->popObject('stl_vector<\icson\dashou\bo\DSPackage>');	//<std::vector<icson::dashou::bo::CDSPackage> >  套餐信息列表
		$this->_arr_value['mainIdPackage_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mainIdCoupon'] = $bs->popObject('stl_vector<\icson\dashou\bo\DSCoupon>');	//<std::vector<icson::dashou::bo::CDSCoupon> > 单品赠券列表
		$this->_arr_value['mainIdCoupon_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mainIdGift'] = $bs->popObject('stl_vector<\icson\dashou\bo\DSGift>');	//<std::vector<icson::dashou::bo::CDSGift> >  赠品组件列表
		$this->_arr_value['mainIdGift_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mainIdRelative'] = $bs->popObject('stl_vector<\icson\dashou\bo\DSRelativityClass>');	//<std::vector<icson::dashou::bo::CDSRelativityClass> > 随心配列表
		$this->_arr_value['mainIdRelative_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mainIdWarranty'] = $bs->popObject('stl_vector<\icson\dashou\bo\DSWarranty>');	//<std::vector<icson::dashou::bo::CDSWarranty> > 延保列表
		$this->_arr_value['mainIdWarranty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mainIdAppointment'] = $bs->popObject('stl_vector<\icson\dashou\bo\DSAppointment>');	//<std::vector<icson::dashou::bo::CDSAppointment> > 预约列表
		$this->_arr_value['mainIdAppointment_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\dashou\bo;	//source idl: com.icson.dashou.idl.TogethersellItemBo.java
class DSRelativityClass{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t>  协议版本号 (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $classId;	//<std::string> 随心配分类Id，目前是小类目id(版本>=0)
	private $classId_u;	//<uint8_t> (版本>=0)
	private $className;	//<std::string> 随心配分类名称(版本>=0)
	private $className_u;	//<uint8_t> (版本>=0)
	private $showOrder;	//<uint32_t> 聚类显示顺序 只对随心配有效(版本>=0)
	private $showOrder_u;	//<uint8_t> (版本>=0)
	private $vecRelative;	//<std::vector<icson::dashou::bo::CDSRelativity> > 随心配配置(版本>=0)
	private $vecRelative_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->version_u = 0;	//<uint8_t>
		$this->classId = "";	//<std::string>
		$this->classId_u = 0;	//<uint8_t>
		$this->className = "";	//<std::string>
		$this->className_u = 0;	//<uint8_t>
		$this->showOrder = 0;	//<uint32_t>
		$this->showOrder_u = 0;	//<uint8_t>
		$this->vecRelative = new \stl_vector2('\icson\dashou\bo\DSRelativity');	//<std::vector<icson::dashou::bo::CDSRelativity> >
		$this->vecRelative_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\dashou\bo\DSRelativityClass\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();
					if(class_exists($class,false)){
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
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
			exit("icson\dashou\bo\DSRelativityClass\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint16_t($this->version);	//<uint16_t>  协议版本号 
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushString($this->classId);	//<std::string> 随心配分类Id，目前是小类目id
		$bs->pushUint8_t($this->classId_u);	//<uint8_t> 
		$bs->pushString($this->className);	//<std::string> 随心配分类名称
		$bs->pushUint8_t($this->className_u);	//<uint8_t> 
		$bs->pushUint32_t($this->showOrder);	//<uint32_t> 聚类显示顺序 只对随心配有效
		$bs->pushUint8_t($this->showOrder_u);	//<uint8_t> 
		$bs->pushObject($this->vecRelative,'stl_vector');	//<std::vector<icson::dashou::bo::CDSRelativity> > 随心配配置
		$bs->pushUint8_t($this->vecRelative_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t>  协议版本号 
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['classId'] = $bs->popString();	//<std::string> 随心配分类Id，目前是小类目id
		$this->_arr_value['classId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['className'] = $bs->popString();	//<std::string> 随心配分类名称
		$this->_arr_value['className_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['showOrder'] = $bs->popUint32_t();	//<uint32_t> 聚类显示顺序 只对随心配有效
		$this->_arr_value['showOrder_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['vecRelative'] = $bs->popObject('stl_vector<\icson\dashou\bo\DSRelativity>');	//<std::vector<icson::dashou::bo::CDSRelativity> > 随心配配置
		$this->_arr_value['vecRelative_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\dashou\bo;	//source idl: com.icson.dashou.idl.GetTogetherSellReq.java
class DSMainProduct{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号   (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $productId;	//<uint32_t> product_id(版本>=0)
	private $productId_u;	//<uint8_t> (版本>=0)
	private $skuId;	//<uint64_t> skuid 备用 (版本>=0)
	private $skuId_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->productId = 0;	//<uint32_t>
		$this->productId_u = 0;	//<uint8_t>
		$this->skuId = 0;	//<uint64_t>
		$this->skuId_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\dashou\bo\DSMainProduct\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();
					if(class_exists($class,false)){
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
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
			exit("icson\dashou\bo\DSMainProduct\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint32_t($this->productId);	//<uint32_t> product_id
		$bs->pushUint8_t($this->productId_u);	//<uint8_t> 
		$bs->pushUint64_t($this->skuId);	//<uint64_t> skuid 备用 
		$bs->pushUint8_t($this->skuId_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号   
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productId'] = $bs->popUint32_t();	//<uint32_t> product_id
		$this->_arr_value['productId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuId'] = $bs->popUint64_t();	//<uint64_t> skuid 备用 
		$this->_arr_value['skuId_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\dashou\bo;	//source idl: com.icson.dashou.idl.CheckTogetherSellPackageResp.java
class CheckTogetherSellPackageResultBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号   (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $inValidTogetherSell;	//<std::vector<icson::dashou::bo::CTogetherSellCheckPackageRuleBo> > 失效关系列表(版本>=0)
	private $inValidTogetherSell_u;	//<uint8_t> (版本>=0)
	private $validTogetherSellMatched;	//<std::vector<icson::dashou::bo::CTogetherSellCheckPackageRuleBo> > 生效匹配的关系匹配数量列表(版本>=0)
	private $validTogetherSellMatched_u;	//<uint8_t> (版本>=0)
	private $togetherSellVect;	//<std::vector<icson::dashou::bo::CTogethersellBuyBo> > 搭售信息列表(版本>=0)
	private $togetherSellVect_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->inValidTogetherSell = new \stl_vector2('\icson\dashou\bo\TogetherSellCheckPackageRuleBo');	//<std::vector<icson::dashou::bo::CTogetherSellCheckPackageRuleBo> >
		$this->inValidTogetherSell_u = 0;	//<uint8_t>
		$this->validTogetherSellMatched = new \stl_vector2('\icson\dashou\bo\TogetherSellCheckPackageRuleBo');	//<std::vector<icson::dashou::bo::CTogetherSellCheckPackageRuleBo> >
		$this->validTogetherSellMatched_u = 0;	//<uint8_t>
		$this->togetherSellVect = new \stl_vector2('\icson\dashou\bo\TogethersellBuyBo');	//<std::vector<icson::dashou::bo::CTogethersellBuyBo> >
		$this->togetherSellVect_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\dashou\bo\CheckTogetherSellPackageResultBo\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();
					if(class_exists($class,false)){
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
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
			exit("icson\dashou\bo\CheckTogetherSellPackageResultBo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushObject($this->inValidTogetherSell,'stl_vector');	//<std::vector<icson::dashou::bo::CTogetherSellCheckPackageRuleBo> > 失效关系列表
		$bs->pushUint8_t($this->inValidTogetherSell_u);	//<uint8_t> 
		$bs->pushObject($this->validTogetherSellMatched,'stl_vector');	//<std::vector<icson::dashou::bo::CTogetherSellCheckPackageRuleBo> > 生效匹配的关系匹配数量列表
		$bs->pushUint8_t($this->validTogetherSellMatched_u);	//<uint8_t> 
		$bs->pushObject($this->togetherSellVect,'stl_vector');	//<std::vector<icson::dashou::bo::CTogethersellBuyBo> > 搭售信息列表
		$bs->pushUint8_t($this->togetherSellVect_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号   
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['inValidTogetherSell'] = $bs->popObject('stl_vector<\icson\dashou\bo\TogetherSellCheckPackageRuleBo>');	//<std::vector<icson::dashou::bo::CTogetherSellCheckPackageRuleBo> > 失效关系列表
		$this->_arr_value['inValidTogetherSell_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['validTogetherSellMatched'] = $bs->popObject('stl_vector<\icson\dashou\bo\TogetherSellCheckPackageRuleBo>');	//<std::vector<icson::dashou::bo::CTogetherSellCheckPackageRuleBo> > 生效匹配的关系匹配数量列表
		$this->_arr_value['validTogetherSellMatched_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['togetherSellVect'] = $bs->popObject('stl_vector<\icson\dashou\bo\TogethersellBuyBo>');	//<std::vector<icson::dashou::bo::CTogethersellBuyBo> > 搭售信息列表
		$this->_arr_value['togetherSellVect_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\dashou\bo;	//source idl: com.icson.dashou.idl.CheckTogetherSellPackageReq.java
class CheckTogetherSellPkgParamBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号   (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $togetherSellCheckVec;	//<std::vector<icson::dashou::bo::CTogetherSellCheckPackageRuleBo> >  验证入参数据(版本>=0)
	private $togetherSellCheckVec_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->togetherSellCheckVec = new \stl_vector2('\icson\dashou\bo\TogetherSellCheckPackageRuleBo');	//<std::vector<icson::dashou::bo::CTogetherSellCheckPackageRuleBo> >
		$this->togetherSellCheckVec_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\dashou\bo\CheckTogetherSellPkgParamBo\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();
					if(class_exists($class,false)){
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
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
			exit("icson\dashou\bo\CheckTogetherSellPkgParamBo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushObject($this->togetherSellCheckVec,'stl_vector');	//<std::vector<icson::dashou::bo::CTogetherSellCheckPackageRuleBo> >  验证入参数据
		$bs->pushUint8_t($this->togetherSellCheckVec_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号   
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['togetherSellCheckVec'] = $bs->popObject('stl_vector<\icson\dashou\bo\TogetherSellCheckPackageRuleBo>');	//<std::vector<icson::dashou::bo::CTogetherSellCheckPackageRuleBo> >  验证入参数据
		$this->_arr_value['togetherSellCheckVec_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\dashou\bo;	//source idl: com.icson.dashou.idl.CheckTogetherSellPkgParamBo.java
class TogetherSellCheckPackageRuleBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号   (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $ruleId;	//<std::string> 关系ID ，这里的关系id购物车必须要存储用于验证，否则不是从随心配渠道进来的也会享受优惠，导致数据不一致(版本>=0)
	private $ruleId_u;	//<uint8_t> (版本>=0)
	private $discount;	//<uint32_t> 单个套餐优惠额(版本>=0)
	private $discount_u;	//<uint8_t> (版本>=0)
	private $buyNum;	//<uint32_t> 购买实际数量/匹配数量(版本>=0)
	private $buyNum_u;	//<uint8_t> (版本>=0)
	private $invalidReason;	//<uint32_t> 失效原因(版本>=0)
	private $invalidReason_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->ruleId = "";	//<std::string>
		$this->ruleId_u = 0;	//<uint8_t>
		$this->discount = 0;	//<uint32_t>
		$this->discount_u = 0;	//<uint8_t>
		$this->buyNum = 0;	//<uint32_t>
		$this->buyNum_u = 0;	//<uint8_t>
		$this->invalidReason = 0;	//<uint32_t>
		$this->invalidReason_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\dashou\bo\TogetherSellCheckPackageRuleBo\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();
					if(class_exists($class,false)){
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
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
			exit("icson\dashou\bo\TogetherSellCheckPackageRuleBo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushString($this->ruleId);	//<std::string> 关系ID ，这里的关系id购物车必须要存储用于验证，否则不是从随心配渠道进来的也会享受优惠，导致数据不一致
		$bs->pushUint8_t($this->ruleId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->discount);	//<uint32_t> 单个套餐优惠额
		$bs->pushUint8_t($this->discount_u);	//<uint8_t> 
		$bs->pushUint32_t($this->buyNum);	//<uint32_t> 购买实际数量/匹配数量
		$bs->pushUint8_t($this->buyNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->invalidReason);	//<uint32_t> 失效原因
		$bs->pushUint8_t($this->invalidReason_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号   
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleId'] = $bs->popString();	//<std::string> 关系ID ，这里的关系id购物车必须要存储用于验证，否则不是从随心配渠道进来的也会享受优惠，导致数据不一致
		$this->_arr_value['ruleId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['discount'] = $bs->popUint32_t();	//<uint32_t> 单个套餐优惠额
		$this->_arr_value['discount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyNum'] = $bs->popUint32_t();	//<uint32_t> 购买实际数量/匹配数量
		$this->_arr_value['buyNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['invalidReason'] = $bs->popUint32_t();	//<uint32_t> 失效原因
		$this->_arr_value['invalidReason_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\dashou\bo;	//source idl: com.icson.dashou.idl.CheckTogetherSellResp.java
class CheckTogetherSellResultBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号   (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $inValidTogetherSell;	//<std::vector<icson::dashou::bo::CTogetherSellCheckBo> > 失效关系列表(版本>=0)
	private $inValidTogetherSell_u;	//<uint8_t> (版本>=0)
	private $validTogetherSellMatched;	//<std::vector<icson::dashou::bo::CTogetherSellCheckBo> > 生效匹配的关系匹配数量列表(版本>=0)
	private $validTogetherSellMatched_u;	//<uint8_t> (版本>=0)
	private $togetherSellVect;	//<std::vector<icson::dashou::bo::CTogethersellBuyBo> > 搭售非套餐信息列表(版本>=0)
	private $togetherSellVect_u;	//<uint8_t> (版本>=0)
	private $package;	//<std::vector<icson::dashou::bo::CDSPackage> >  套餐信息列表(版本>=0)
	private $package_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->inValidTogetherSell = new \stl_vector2('\icson\dashou\bo\TogetherSellCheckBo');	//<std::vector<icson::dashou::bo::CTogetherSellCheckBo> >
		$this->inValidTogetherSell_u = 0;	//<uint8_t>
		$this->validTogetherSellMatched = new \stl_vector2('\icson\dashou\bo\TogetherSellCheckBo');	//<std::vector<icson::dashou::bo::CTogetherSellCheckBo> >
		$this->validTogetherSellMatched_u = 0;	//<uint8_t>
		$this->togetherSellVect = new \stl_vector2('\icson\dashou\bo\TogethersellBuyBo');	//<std::vector<icson::dashou::bo::CTogethersellBuyBo> >
		$this->togetherSellVect_u = 0;	//<uint8_t>
		$this->package = new \stl_vector2('\icson\dashou\bo\DSPackage');	//<std::vector<icson::dashou::bo::CDSPackage> >
		$this->package_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\dashou\bo\CheckTogetherSellResultBo\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();
					if(class_exists($class,false)){
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
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
			exit("icson\dashou\bo\CheckTogetherSellResultBo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushObject($this->inValidTogetherSell,'stl_vector');	//<std::vector<icson::dashou::bo::CTogetherSellCheckBo> > 失效关系列表
		$bs->pushUint8_t($this->inValidTogetherSell_u);	//<uint8_t> 
		$bs->pushObject($this->validTogetherSellMatched,'stl_vector');	//<std::vector<icson::dashou::bo::CTogetherSellCheckBo> > 生效匹配的关系匹配数量列表
		$bs->pushUint8_t($this->validTogetherSellMatched_u);	//<uint8_t> 
		$bs->pushObject($this->togetherSellVect,'stl_vector');	//<std::vector<icson::dashou::bo::CTogethersellBuyBo> > 搭售非套餐信息列表
		$bs->pushUint8_t($this->togetherSellVect_u);	//<uint8_t> 
		$bs->pushObject($this->package,'stl_vector');	//<std::vector<icson::dashou::bo::CDSPackage> >  套餐信息列表
		$bs->pushUint8_t($this->package_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号   
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['inValidTogetherSell'] = $bs->popObject('stl_vector<\icson\dashou\bo\TogetherSellCheckBo>');	//<std::vector<icson::dashou::bo::CTogetherSellCheckBo> > 失效关系列表
		$this->_arr_value['inValidTogetherSell_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['validTogetherSellMatched'] = $bs->popObject('stl_vector<\icson\dashou\bo\TogetherSellCheckBo>');	//<std::vector<icson::dashou::bo::CTogetherSellCheckBo> > 生效匹配的关系匹配数量列表
		$this->_arr_value['validTogetherSellMatched_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['togetherSellVect'] = $bs->popObject('stl_vector<\icson\dashou\bo\TogethersellBuyBo>');	//<std::vector<icson::dashou::bo::CTogethersellBuyBo> > 搭售非套餐信息列表
		$this->_arr_value['togetherSellVect_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['package'] = $bs->popObject('stl_vector<\icson\dashou\bo\DSPackage>');	//<std::vector<icson::dashou::bo::CDSPackage> >  套餐信息列表
		$this->_arr_value['package_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\dashou\bo;	//source idl: com.icson.dashou.idl.CheckTogetherSellResultBo.java
class TogethersellBuyBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t>  协议版本号 (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $mainproductId;	//<uint32_t> 主商品ID(版本>=0)
	private $mainproductId_u;	//<uint8_t> (版本>=0)
	private $skuId;	//<uint64_t> skuid 备用 (版本>=0)
	private $skuId_u;	//<uint8_t> (版本>=0)
	private $mainIdPackage;	//<std::vector<icson::dashou::bo::CDSPackage> >  套餐信息列表(版本>=0)
	private $mainIdPackage_u;	//<uint8_t> (版本>=0)
	private $mainIdCoupon;	//<std::vector<icson::dashou::bo::CDSCoupon> > 单品赠券列表(版本>=0)
	private $mainIdCoupon_u;	//<uint8_t> (版本>=0)
	private $mainIdGift;	//<std::vector<icson::dashou::bo::CDSGift> >  赠品组件列表(版本>=0)
	private $mainIdGift_u;	//<uint8_t> (版本>=0)
	private $mainIdRelative;	//<std::vector<icson::dashou::bo::CDSRelativity> > 随心配列表(版本>=0)
	private $mainIdRelative_u;	//<uint8_t> (版本>=0)
	private $mainIdWarranty;	//<std::vector<icson::dashou::bo::CDSWarranty> > 延保列表(版本>=0)
	private $mainIdWarranty_u;	//<uint8_t> (版本>=0)
	private $mainIdAppointment;	//<std::vector<icson::dashou::bo::CDSAppointment> > 预约列表(版本>=0)
	private $mainIdAppointment_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->version_u = 0;	//<uint8_t>
		$this->mainproductId = 0;	//<uint32_t>
		$this->mainproductId_u = 0;	//<uint8_t>
		$this->skuId = 0;	//<uint64_t>
		$this->skuId_u = 0;	//<uint8_t>
		$this->mainIdPackage = new \stl_vector2('\icson\dashou\bo\DSPackage');	//<std::vector<icson::dashou::bo::CDSPackage> >
		$this->mainIdPackage_u = 0;	//<uint8_t>
		$this->mainIdCoupon = new \stl_vector2('\icson\dashou\bo\DSCoupon');	//<std::vector<icson::dashou::bo::CDSCoupon> >
		$this->mainIdCoupon_u = 0;	//<uint8_t>
		$this->mainIdGift = new \stl_vector2('\icson\dashou\bo\DSGift');	//<std::vector<icson::dashou::bo::CDSGift> >
		$this->mainIdGift_u = 0;	//<uint8_t>
		$this->mainIdRelative = new \stl_vector2('\icson\dashou\bo\DSRelativity');	//<std::vector<icson::dashou::bo::CDSRelativity> >
		$this->mainIdRelative_u = 0;	//<uint8_t>
		$this->mainIdWarranty = new \stl_vector2('\icson\dashou\bo\DSWarranty');	//<std::vector<icson::dashou::bo::CDSWarranty> >
		$this->mainIdWarranty_u = 0;	//<uint8_t>
		$this->mainIdAppointment = new \stl_vector2('\icson\dashou\bo\DSAppointment');	//<std::vector<icson::dashou::bo::CDSAppointment> >
		$this->mainIdAppointment_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\dashou\bo\TogethersellBuyBo\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();
					if(class_exists($class,false)){
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
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
			exit("icson\dashou\bo\TogethersellBuyBo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint16_t($this->version);	//<uint16_t>  协议版本号 
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->mainproductId);	//<uint32_t> 主商品ID
		$bs->pushUint8_t($this->mainproductId_u);	//<uint8_t> 
		$bs->pushUint64_t($this->skuId);	//<uint64_t> skuid 备用 
		$bs->pushUint8_t($this->skuId_u);	//<uint8_t> 
		$bs->pushObject($this->mainIdPackage,'stl_vector');	//<std::vector<icson::dashou::bo::CDSPackage> >  套餐信息列表
		$bs->pushUint8_t($this->mainIdPackage_u);	//<uint8_t> 
		$bs->pushObject($this->mainIdCoupon,'stl_vector');	//<std::vector<icson::dashou::bo::CDSCoupon> > 单品赠券列表
		$bs->pushUint8_t($this->mainIdCoupon_u);	//<uint8_t> 
		$bs->pushObject($this->mainIdGift,'stl_vector');	//<std::vector<icson::dashou::bo::CDSGift> >  赠品组件列表
		$bs->pushUint8_t($this->mainIdGift_u);	//<uint8_t> 
		$bs->pushObject($this->mainIdRelative,'stl_vector');	//<std::vector<icson::dashou::bo::CDSRelativity> > 随心配列表
		$bs->pushUint8_t($this->mainIdRelative_u);	//<uint8_t> 
		$bs->pushObject($this->mainIdWarranty,'stl_vector');	//<std::vector<icson::dashou::bo::CDSWarranty> > 延保列表
		$bs->pushUint8_t($this->mainIdWarranty_u);	//<uint8_t> 
		$bs->pushObject($this->mainIdAppointment,'stl_vector');	//<std::vector<icson::dashou::bo::CDSAppointment> > 预约列表
		$bs->pushUint8_t($this->mainIdAppointment_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t>  协议版本号 
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mainproductId'] = $bs->popUint32_t();	//<uint32_t> 主商品ID
		$this->_arr_value['mainproductId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuId'] = $bs->popUint64_t();	//<uint64_t> skuid 备用 
		$this->_arr_value['skuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mainIdPackage'] = $bs->popObject('stl_vector<\icson\dashou\bo\DSPackage>');	//<std::vector<icson::dashou::bo::CDSPackage> >  套餐信息列表
		$this->_arr_value['mainIdPackage_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mainIdCoupon'] = $bs->popObject('stl_vector<\icson\dashou\bo\DSCoupon>');	//<std::vector<icson::dashou::bo::CDSCoupon> > 单品赠券列表
		$this->_arr_value['mainIdCoupon_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mainIdGift'] = $bs->popObject('stl_vector<\icson\dashou\bo\DSGift>');	//<std::vector<icson::dashou::bo::CDSGift> >  赠品组件列表
		$this->_arr_value['mainIdGift_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mainIdRelative'] = $bs->popObject('stl_vector<\icson\dashou\bo\DSRelativity>');	//<std::vector<icson::dashou::bo::CDSRelativity> > 随心配列表
		$this->_arr_value['mainIdRelative_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mainIdWarranty'] = $bs->popObject('stl_vector<\icson\dashou\bo\DSWarranty>');	//<std::vector<icson::dashou::bo::CDSWarranty> > 延保列表
		$this->_arr_value['mainIdWarranty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mainIdAppointment'] = $bs->popObject('stl_vector<\icson\dashou\bo\DSAppointment>');	//<std::vector<icson::dashou::bo::CDSAppointment> > 预约列表
		$this->_arr_value['mainIdAppointment_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\dashou\bo;	//source idl: com.icson.dashou.idl.TogethersellBuyBo.java
class DSAppointment{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t>  协议版本号 (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $id;	//<uint32_t>  活动规则id (版本>=0)
	private $id_u;	//<uint8_t> (版本>=0)
	private $name;	//<std::string>  活动规则名称 (版本>=0)
	private $name_u;	//<uint8_t> (版本>=0)
	private $pid_list;	//<std::vector<std::string> >  商品信息的二进制字符串数组(版本>=0)
	private $pid_list_u;	//<uint8_t> (版本>=0)
	private $type;	//<uint8_t>  类型(版本>=0)
	private $type_u;	//<uint8_t> (版本>=0)
	private $wh_id;	//<uint32_t>  分站id(版本>=0)
	private $wh_id_u;	//<uint8_t> (版本>=0)
	private $join_limit;	//<uint32_t>  join_limit(版本>=0)
	private $join_limit_u;	//<uint8_t> (版本>=0)
	private $user_include;	//<std::string>  user_include(版本>=0)
	private $user_include_u;	//<uint8_t> (版本>=0)
	private $accounting_type;	//<uint8_t>  accounting_type(版本>=0)
	private $accounting_type_u;	//<uint8_t> (版本>=0)
	private $status;	//<int>  status(版本>=0)
	private $status_u;	//<uint8_t> (版本>=0)
	private $url;	//<std::string>  url(版本>=0)
	private $url_u;	//<uint8_t> (版本>=0)
	private $order_time_from;	//<uint32_t>  order_time_from(版本>=0)
	private $order_time_from_u;	//<uint8_t> (版本>=0)
	private $order_time_to;	//<uint32_t>  order_time_to(版本>=0)
	private $order_time_to_u;	//<uint8_t> (版本>=0)
	private $buy_time_from;	//<uint32_t>  buy_time_from(版本>=0)
	private $buy_time_from_u;	//<uint8_t> (版本>=0)
	private $buy_time_to;	//<uint32_t>  buy_time_to(版本>=0)
	private $buy_time_to_u;	//<uint8_t> (版本>=0)
	private $eventid;	//<uint32_t>  eventid(版本>=0)
	private $eventid_u;	//<uint8_t> (版本>=0)
	private $event_url;	//<std::string>  event_url(版本>=0)
	private $event_url_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->version_u = 0;	//<uint8_t>
		$this->id = 0;	//<uint32_t>
		$this->id_u = 0;	//<uint8_t>
		$this->name = "";	//<std::string>
		$this->name_u = 0;	//<uint8_t>
		$this->pid_list = new \stl_vector2('stl_string');	//<std::vector<std::string> >
		$this->pid_list_u = 0;	//<uint8_t>
		$this->type = 0;	//<uint8_t>
		$this->type_u = 0;	//<uint8_t>
		$this->wh_id = 0;	//<uint32_t>
		$this->wh_id_u = 0;	//<uint8_t>
		$this->join_limit = 0;	//<uint32_t>
		$this->join_limit_u = 0;	//<uint8_t>
		$this->user_include = "";	//<std::string>
		$this->user_include_u = 0;	//<uint8_t>
		$this->accounting_type = 0;	//<uint8_t>
		$this->accounting_type_u = 0;	//<uint8_t>
		$this->status = 0;	//<int>
		$this->status_u = 0;	//<uint8_t>
		$this->url = "";	//<std::string>
		$this->url_u = 0;	//<uint8_t>
		$this->order_time_from = 0;	//<uint32_t>
		$this->order_time_from_u = 0;	//<uint8_t>
		$this->order_time_to = 0;	//<uint32_t>
		$this->order_time_to_u = 0;	//<uint8_t>
		$this->buy_time_from = 0;	//<uint32_t>
		$this->buy_time_from_u = 0;	//<uint8_t>
		$this->buy_time_to = 0;	//<uint32_t>
		$this->buy_time_to_u = 0;	//<uint8_t>
		$this->eventid = 0;	//<uint32_t>
		$this->eventid_u = 0;	//<uint8_t>
		$this->event_url = "";	//<std::string>
		$this->event_url_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\dashou\bo\DSAppointment\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();
					if(class_exists($class,false)){
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
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
			exit("icson\dashou\bo\DSAppointment\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint16_t($this->version);	//<uint16_t>  协议版本号 
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->id);	//<uint32_t>  活动规则id 
		$bs->pushUint8_t($this->id_u);	//<uint8_t> 
		$bs->pushString($this->name);	//<std::string>  活动规则名称 
		$bs->pushUint8_t($this->name_u);	//<uint8_t> 
		$bs->pushObject($this->pid_list,'stl_vector');	//<std::vector<std::string> >  商品信息的二进制字符串数组
		$bs->pushUint8_t($this->pid_list_u);	//<uint8_t> 
		$bs->pushUint8_t($this->type);	//<uint8_t>  类型
		$bs->pushUint8_t($this->type_u);	//<uint8_t> 
		$bs->pushUint32_t($this->wh_id);	//<uint32_t>  分站id
		$bs->pushUint8_t($this->wh_id_u);	//<uint8_t> 
		$bs->pushUint32_t($this->join_limit);	//<uint32_t>  join_limit
		$bs->pushUint8_t($this->join_limit_u);	//<uint8_t> 
		$bs->pushString($this->user_include);	//<std::string>  user_include
		$bs->pushUint8_t($this->user_include_u);	//<uint8_t> 
		$bs->pushUint8_t($this->accounting_type);	//<uint8_t>  accounting_type
		$bs->pushUint8_t($this->accounting_type_u);	//<uint8_t> 
		$bs->pushInt32_t($this->status);	//<int>  status
		$bs->pushUint8_t($this->status_u);	//<uint8_t> 
		$bs->pushString($this->url);	//<std::string>  url
		$bs->pushUint8_t($this->url_u);	//<uint8_t> 
		$bs->pushUint32_t($this->order_time_from);	//<uint32_t>  order_time_from
		$bs->pushUint8_t($this->order_time_from_u);	//<uint8_t> 
		$bs->pushUint32_t($this->order_time_to);	//<uint32_t>  order_time_to
		$bs->pushUint8_t($this->order_time_to_u);	//<uint8_t> 
		$bs->pushUint32_t($this->buy_time_from);	//<uint32_t>  buy_time_from
		$bs->pushUint8_t($this->buy_time_from_u);	//<uint8_t> 
		$bs->pushUint32_t($this->buy_time_to);	//<uint32_t>  buy_time_to
		$bs->pushUint8_t($this->buy_time_to_u);	//<uint8_t> 
		$bs->pushUint32_t($this->eventid);	//<uint32_t>  eventid
		$bs->pushUint8_t($this->eventid_u);	//<uint8_t> 
		$bs->pushString($this->event_url);	//<std::string>  event_url
		$bs->pushUint8_t($this->event_url_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t>  协议版本号 
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['id'] = $bs->popUint32_t();	//<uint32_t>  活动规则id 
		$this->_arr_value['id_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['name'] = $bs->popString();	//<std::string>  活动规则名称 
		$this->_arr_value['name_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['pid_list'] = $bs->popObject('stl_vector<stl_string>');	//<std::vector<std::string> >  商品信息的二进制字符串数组
		$this->_arr_value['pid_list_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['type'] = $bs->popUint8_t();	//<uint8_t>  类型
		$this->_arr_value['type_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['wh_id'] = $bs->popUint32_t();	//<uint32_t>  分站id
		$this->_arr_value['wh_id_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['join_limit'] = $bs->popUint32_t();	//<uint32_t>  join_limit
		$this->_arr_value['join_limit_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['user_include'] = $bs->popString();	//<std::string>  user_include
		$this->_arr_value['user_include_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['accounting_type'] = $bs->popUint8_t();	//<uint8_t>  accounting_type
		$this->_arr_value['accounting_type_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['status'] = $bs->popInt32_t();	//<int>  status
		$this->_arr_value['status_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['url'] = $bs->popString();	//<std::string>  url
		$this->_arr_value['url_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['order_time_from'] = $bs->popUint32_t();	//<uint32_t>  order_time_from
		$this->_arr_value['order_time_from_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['order_time_to'] = $bs->popUint32_t();	//<uint32_t>  order_time_to
		$this->_arr_value['order_time_to_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buy_time_from'] = $bs->popUint32_t();	//<uint32_t>  buy_time_from
		$this->_arr_value['buy_time_from_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buy_time_to'] = $bs->popUint32_t();	//<uint32_t>  buy_time_to
		$this->_arr_value['buy_time_to_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['eventid'] = $bs->popUint32_t();	//<uint32_t>  eventid
		$this->_arr_value['eventid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['event_url'] = $bs->popString();	//<std::string>  event_url
		$this->_arr_value['event_url_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\dashou\bo;	//source idl: com.icson.dashou.idl.TogethersellBuyBo.java
class DSRelativity{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t>  协议版本号 (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $ruleId;	//<uint32_t>  规则ID(版本>=0)
	private $ruleId_u;	//<uint8_t> (版本>=0)
	private $relativityId;	//<uint32_t> 随心配搭配商品Id(版本>=0)
	private $relativityId_u;	//<uint8_t> (版本>=0)
	private $skuId;	//<uint64_t> 随心配skuid 备用 (版本>=0)
	private $skuId_u;	//<uint8_t> (版本>=0)
	private $discount;	//<uint32_t> 随心配商品优惠额和Property一致(版本>=0)
	private $discount_u;	//<uint8_t> (版本>=0)
	private $showOrder;	//<uint32_t> 前端展示顺序(版本>=0)
	private $showOrder_u;	//<uint8_t> (版本>=0)
	private $sortNum;	//<uint32_t> 排序依据(版本>=0)
	private $sortNum_u;	//<uint8_t> (版本>=0)
	private $type;	//<int> 类型(版本>=0)
	private $type_u;	//<uint8_t> (版本>=0)
	private $property;	//<std::string> property(版本>=0)
	private $property_u;	//<uint8_t> (版本>=0)
	private $updatetime;	//<uint32_t> updatetime(版本>=0)
	private $updatetime_u;	//<uint8_t> (版本>=0)
	private $itemInfo;	//<icson::dashou::bo::CItemInfoBo> 配品详情信息(版本>=0)
	private $itemInfo_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->version_u = 0;	//<uint8_t>
		$this->ruleId = 0;	//<uint32_t>
		$this->ruleId_u = 0;	//<uint8_t>
		$this->relativityId = 0;	//<uint32_t>
		$this->relativityId_u = 0;	//<uint8_t>
		$this->skuId = 0;	//<uint64_t>
		$this->skuId_u = 0;	//<uint8_t>
		$this->discount = 0;	//<uint32_t>
		$this->discount_u = 0;	//<uint8_t>
		$this->showOrder = 0;	//<uint32_t>
		$this->showOrder_u = 0;	//<uint8_t>
		$this->sortNum = 0;	//<uint32_t>
		$this->sortNum_u = 0;	//<uint8_t>
		$this->type = 0;	//<int>
		$this->type_u = 0;	//<uint8_t>
		$this->property = "";	//<std::string>
		$this->property_u = 0;	//<uint8_t>
		$this->updatetime = 0;	//<uint32_t>
		$this->updatetime_u = 0;	//<uint8_t>
		$this->itemInfo = new \icson\dashou\bo\ItemInfoBo();	//<icson::dashou::bo::CItemInfoBo>
		$this->itemInfo_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\dashou\bo\DSRelativity\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();
					if(class_exists($class,false)){
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
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
			exit("icson\dashou\bo\DSRelativity\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint16_t($this->version);	//<uint16_t>  协议版本号 
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->ruleId);	//<uint32_t>  规则ID
		$bs->pushUint8_t($this->ruleId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->relativityId);	//<uint32_t> 随心配搭配商品Id
		$bs->pushUint8_t($this->relativityId_u);	//<uint8_t> 
		$bs->pushUint64_t($this->skuId);	//<uint64_t> 随心配skuid 备用 
		$bs->pushUint8_t($this->skuId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->discount);	//<uint32_t> 随心配商品优惠额和Property一致
		$bs->pushUint8_t($this->discount_u);	//<uint8_t> 
		$bs->pushUint32_t($this->showOrder);	//<uint32_t> 前端展示顺序
		$bs->pushUint8_t($this->showOrder_u);	//<uint8_t> 
		$bs->pushUint32_t($this->sortNum);	//<uint32_t> 排序依据
		$bs->pushUint8_t($this->sortNum_u);	//<uint8_t> 
		$bs->pushInt32_t($this->type);	//<int> 类型
		$bs->pushUint8_t($this->type_u);	//<uint8_t> 
		$bs->pushString($this->property);	//<std::string> property
		$bs->pushUint8_t($this->property_u);	//<uint8_t> 
		$bs->pushUint32_t($this->updatetime);	//<uint32_t> updatetime
		$bs->pushUint8_t($this->updatetime_u);	//<uint8_t> 
		$bs->pushObject($this->itemInfo,'\icson\dashou\bo\ItemInfoBo');	//<icson::dashou::bo::CItemInfoBo> 配品详情信息
		$bs->pushUint8_t($this->itemInfo_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t>  协议版本号 
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleId'] = $bs->popUint32_t();	//<uint32_t>  规则ID
		$this->_arr_value['ruleId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['relativityId'] = $bs->popUint32_t();	//<uint32_t> 随心配搭配商品Id
		$this->_arr_value['relativityId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuId'] = $bs->popUint64_t();	//<uint64_t> 随心配skuid 备用 
		$this->_arr_value['skuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['discount'] = $bs->popUint32_t();	//<uint32_t> 随心配商品优惠额和Property一致
		$this->_arr_value['discount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['showOrder'] = $bs->popUint32_t();	//<uint32_t> 前端展示顺序
		$this->_arr_value['showOrder_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sortNum'] = $bs->popUint32_t();	//<uint32_t> 排序依据
		$this->_arr_value['sortNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['type'] = $bs->popInt32_t();	//<int> 类型
		$this->_arr_value['type_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['property'] = $bs->popString();	//<std::string> property
		$this->_arr_value['property_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['updatetime'] = $bs->popUint32_t();	//<uint32_t> updatetime
		$this->_arr_value['updatetime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemInfo'] = $bs->popObject('\icson\dashou\bo\ItemInfoBo');	//<icson::dashou::bo::CItemInfoBo> 配品详情信息
		$this->_arr_value['itemInfo_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\dashou\bo;	//source idl: com.icson.dashou.idl.TogethersellBuyBo.java
class DSPackage{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t>  协议版本号 (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $promotionName;	//<std::string>  促销规则名称(版本>=0)
	private $promotionName_u;	//<uint8_t> (版本>=0)
	private $ruleId;	//<uint32_t>  套餐对应的规则Id(版本>=0)
	private $ruleId_u;	//<uint8_t> (版本>=0)
	private $vecPackageInfo;	//<std::vector<icson::dashou::bo::CDSPackageInfo> > 套餐商品信息列表(版本>=0)
	private $vecPackageInfo_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->version_u = 0;	//<uint8_t>
		$this->promotionName = "";	//<std::string>
		$this->promotionName_u = 0;	//<uint8_t>
		$this->ruleId = 0;	//<uint32_t>
		$this->ruleId_u = 0;	//<uint8_t>
		$this->vecPackageInfo = new \stl_vector2('\icson\dashou\bo\DSPackageInfo');	//<std::vector<icson::dashou::bo::CDSPackageInfo> >
		$this->vecPackageInfo_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\dashou\bo\DSPackage\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();
					if(class_exists($class,false)){
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
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
			exit("icson\dashou\bo\DSPackage\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint16_t($this->version);	//<uint16_t>  协议版本号 
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushString($this->promotionName);	//<std::string>  促销规则名称
		$bs->pushUint8_t($this->promotionName_u);	//<uint8_t> 
		$bs->pushUint32_t($this->ruleId);	//<uint32_t>  套餐对应的规则Id
		$bs->pushUint8_t($this->ruleId_u);	//<uint8_t> 
		$bs->pushObject($this->vecPackageInfo,'stl_vector');	//<std::vector<icson::dashou::bo::CDSPackageInfo> > 套餐商品信息列表
		$bs->pushUint8_t($this->vecPackageInfo_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t>  协议版本号 
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['promotionName'] = $bs->popString();	//<std::string>  促销规则名称
		$this->_arr_value['promotionName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleId'] = $bs->popUint32_t();	//<uint32_t>  套餐对应的规则Id
		$this->_arr_value['ruleId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['vecPackageInfo'] = $bs->popObject('stl_vector<\icson\dashou\bo\DSPackageInfo>');	//<std::vector<icson::dashou::bo::CDSPackageInfo> > 套餐商品信息列表
		$this->_arr_value['vecPackageInfo_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\dashou\bo;	//source idl: com.icson.dashou.idl.DSPackage.java
class DSPackageInfo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t>  协议版本号 (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $packageCashBack;	//<uint32_t> 套餐商品优惠价格(版本>=0)
	private $packageCashBack_u;	//<uint8_t> (版本>=0)
	private $productId;	//<uint32_t> 商品id(版本>=0)
	private $productId_u;	//<uint8_t> (版本>=0)
	private $skuId;	//<uint64_t> 套餐skuid 备用 (版本>=0)
	private $skuId_u;	//<uint8_t> (版本>=0)
	private $whId;	//<uint32_t> 分站id(版本>=0)
	private $whId_u;	//<uint8_t> (版本>=0)
	private $promotionWord;	//<std::string> 促销语言(版本>=0)
	private $promotionWord_u;	//<uint8_t> (版本>=0)
	private $cashBack;	//<int> cash back(版本>=0)
	private $cashBack_u;	//<uint8_t> (版本>=0)
	private $costPrice;	//<int> cost_price(版本>=0)
	private $costPrice_u;	//<uint8_t> (版本>=0)
	private $numLimit;	//<int> 限制数量(版本>=0)
	private $numLimit_u;	//<uint8_t> (版本>=0)
	private $itemInfo;	//<icson::dashou::bo::CItemInfoBo> 配品详情信息(版本>=0)
	private $itemInfo_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->version_u = 0;	//<uint8_t>
		$this->packageCashBack = 0;	//<uint32_t>
		$this->packageCashBack_u = 0;	//<uint8_t>
		$this->productId = 0;	//<uint32_t>
		$this->productId_u = 0;	//<uint8_t>
		$this->skuId = 0;	//<uint64_t>
		$this->skuId_u = 0;	//<uint8_t>
		$this->whId = 0;	//<uint32_t>
		$this->whId_u = 0;	//<uint8_t>
		$this->promotionWord = "";	//<std::string>
		$this->promotionWord_u = 0;	//<uint8_t>
		$this->cashBack = 0;	//<int>
		$this->cashBack_u = 0;	//<uint8_t>
		$this->costPrice = 0;	//<int>
		$this->costPrice_u = 0;	//<uint8_t>
		$this->numLimit = 0;	//<int>
		$this->numLimit_u = 0;	//<uint8_t>
		$this->itemInfo = new \icson\dashou\bo\ItemInfoBo();	//<icson::dashou::bo::CItemInfoBo>
		$this->itemInfo_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\dashou\bo\DSPackageInfo\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();
					if(class_exists($class,false)){
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
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
			exit("icson\dashou\bo\DSPackageInfo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint16_t($this->version);	//<uint16_t>  协议版本号 
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->packageCashBack);	//<uint32_t> 套餐商品优惠价格
		$bs->pushUint8_t($this->packageCashBack_u);	//<uint8_t> 
		$bs->pushUint32_t($this->productId);	//<uint32_t> 商品id
		$bs->pushUint8_t($this->productId_u);	//<uint8_t> 
		$bs->pushUint64_t($this->skuId);	//<uint64_t> 套餐skuid 备用 
		$bs->pushUint8_t($this->skuId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->whId);	//<uint32_t> 分站id
		$bs->pushUint8_t($this->whId_u);	//<uint8_t> 
		$bs->pushString($this->promotionWord);	//<std::string> 促销语言
		$bs->pushUint8_t($this->promotionWord_u);	//<uint8_t> 
		$bs->pushInt32_t($this->cashBack);	//<int> cash back
		$bs->pushUint8_t($this->cashBack_u);	//<uint8_t> 
		$bs->pushInt32_t($this->costPrice);	//<int> cost_price
		$bs->pushUint8_t($this->costPrice_u);	//<uint8_t> 
		$bs->pushInt32_t($this->numLimit);	//<int> 限制数量
		$bs->pushUint8_t($this->numLimit_u);	//<uint8_t> 
		$bs->pushObject($this->itemInfo,'\icson\dashou\bo\ItemInfoBo');	//<icson::dashou::bo::CItemInfoBo> 配品详情信息
		$bs->pushUint8_t($this->itemInfo_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t>  协议版本号 
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['packageCashBack'] = $bs->popUint32_t();	//<uint32_t> 套餐商品优惠价格
		$this->_arr_value['packageCashBack_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productId'] = $bs->popUint32_t();	//<uint32_t> 商品id
		$this->_arr_value['productId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuId'] = $bs->popUint64_t();	//<uint64_t> 套餐skuid 备用 
		$this->_arr_value['skuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['whId'] = $bs->popUint32_t();	//<uint32_t> 分站id
		$this->_arr_value['whId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['promotionWord'] = $bs->popString();	//<std::string> 促销语言
		$this->_arr_value['promotionWord_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cashBack'] = $bs->popInt32_t();	//<int> cash back
		$this->_arr_value['cashBack_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['costPrice'] = $bs->popInt32_t();	//<int> cost_price
		$this->_arr_value['costPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['numLimit'] = $bs->popInt32_t();	//<int> 限制数量
		$this->_arr_value['numLimit_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemInfo'] = $bs->popObject('\icson\dashou\bo\ItemInfoBo');	//<icson::dashou::bo::CItemInfoBo> 配品详情信息
		$this->_arr_value['itemInfo_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\dashou\bo;	//source idl: com.icson.dashou.idl.TogethersellBuyBo.java
class DSCoupon{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t>  协议版本号 (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $ruleId;	//<uint32_t>  对应的单品促销规则Id (版本>=0)
	private $ruleId_u;	//<uint8_t> (版本>=0)
	private $promotionName;	//<std::string> 单品促销名称(版本>=0)
	private $promotionName_u;	//<uint8_t> (版本>=0)
	private $vecCouponInfo;	//<std::vector<icson::dashou::bo::CDSCouponInfo> > 优惠券信息列表(版本>=0)
	private $vecCouponInfo_u;	//<uint8_t> (版本>=0)
	private $vecPidList;	//<std::vector<uint32_t> > pidList(版本>=0)
	private $vecPidList_u;	//<uint8_t> (版本>=0)
	private $beginTime;	//<uint32_t> 单品促销有效开始时间(版本>=0)
	private $beginTime_u;	//<uint8_t> (版本>=0)
	private $endTime;	//<uint32_t> 单品促销有效的结束时间(版本>=0)
	private $endTime_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->version_u = 0;	//<uint8_t>
		$this->ruleId = 0;	//<uint32_t>
		$this->ruleId_u = 0;	//<uint8_t>
		$this->promotionName = "";	//<std::string>
		$this->promotionName_u = 0;	//<uint8_t>
		$this->vecCouponInfo = new \stl_vector2('\icson\dashou\bo\DSCouponInfo');	//<std::vector<icson::dashou::bo::CDSCouponInfo> >
		$this->vecCouponInfo_u = 0;	//<uint8_t>
		$this->vecPidList = new \stl_vector2('uint32_t');	//<std::vector<uint32_t> >
		$this->vecPidList_u = 0;	//<uint8_t>
		$this->beginTime = 0;	//<uint32_t>
		$this->beginTime_u = 0;	//<uint8_t>
		$this->endTime = 0;	//<uint32_t>
		$this->endTime_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\dashou\bo\DSCoupon\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();
					if(class_exists($class,false)){
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
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
			exit("icson\dashou\bo\DSCoupon\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint16_t($this->version);	//<uint16_t>  协议版本号 
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->ruleId);	//<uint32_t>  对应的单品促销规则Id 
		$bs->pushUint8_t($this->ruleId_u);	//<uint8_t> 
		$bs->pushString($this->promotionName);	//<std::string> 单品促销名称
		$bs->pushUint8_t($this->promotionName_u);	//<uint8_t> 
		$bs->pushObject($this->vecCouponInfo,'stl_vector');	//<std::vector<icson::dashou::bo::CDSCouponInfo> > 优惠券信息列表
		$bs->pushUint8_t($this->vecCouponInfo_u);	//<uint8_t> 
		$bs->pushObject($this->vecPidList,'stl_vector');	//<std::vector<uint32_t> > pidList
		$bs->pushUint8_t($this->vecPidList_u);	//<uint8_t> 
		$bs->pushUint32_t($this->beginTime);	//<uint32_t> 单品促销有效开始时间
		$bs->pushUint8_t($this->beginTime_u);	//<uint8_t> 
		$bs->pushUint32_t($this->endTime);	//<uint32_t> 单品促销有效的结束时间
		$bs->pushUint8_t($this->endTime_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t>  协议版本号 
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleId'] = $bs->popUint32_t();	//<uint32_t>  对应的单品促销规则Id 
		$this->_arr_value['ruleId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['promotionName'] = $bs->popString();	//<std::string> 单品促销名称
		$this->_arr_value['promotionName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['vecCouponInfo'] = $bs->popObject('stl_vector<\icson\dashou\bo\DSCouponInfo>');	//<std::vector<icson::dashou::bo::CDSCouponInfo> > 优惠券信息列表
		$this->_arr_value['vecCouponInfo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['vecPidList'] = $bs->popObject('stl_vector<uint32_t>');	//<std::vector<uint32_t> > pidList
		$this->_arr_value['vecPidList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['beginTime'] = $bs->popUint32_t();	//<uint32_t> 单品促销有效开始时间
		$this->_arr_value['beginTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['endTime'] = $bs->popUint32_t();	//<uint32_t> 单品促销有效的结束时间
		$this->_arr_value['endTime_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\dashou\bo;	//source idl: com.icson.dashou.idl.DSCoupon.java
class DSCouponInfo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t>  协议版本号 (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $batch;	//<uint32_t>  优惠券id (版本>=0)
	private $batch_u;	//<uint8_t> (版本>=0)
	private $status;	//<int> 优惠券状态(版本>=0)
	private $status_u;	//<uint8_t> (版本>=0)
	private $name;	//<std::string> 优惠券名称(版本>=0)
	private $name_u;	//<uint8_t> (版本>=0)
	private $amt;	//<int> 优惠券amt(版本>=0)
	private $amt_u;	//<uint8_t> (版本>=0)
	private $validTimeFrom;	//<uint32_t> valid_time_from(版本>=0)
	private $validTimeFrom_u;	//<uint8_t> (版本>=0)
	private $validTimeTo;	//<uint32_t> valid_time_to(版本>=0)
	private $validTimeTo_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->version_u = 0;	//<uint8_t>
		$this->batch = 0;	//<uint32_t>
		$this->batch_u = 0;	//<uint8_t>
		$this->status = 0;	//<int>
		$this->status_u = 0;	//<uint8_t>
		$this->name = "";	//<std::string>
		$this->name_u = 0;	//<uint8_t>
		$this->amt = 0;	//<int>
		$this->amt_u = 0;	//<uint8_t>
		$this->validTimeFrom = 0;	//<uint32_t>
		$this->validTimeFrom_u = 0;	//<uint8_t>
		$this->validTimeTo = 0;	//<uint32_t>
		$this->validTimeTo_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\dashou\bo\DSCouponInfo\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();
					if(class_exists($class,false)){
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
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
			exit("icson\dashou\bo\DSCouponInfo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint16_t($this->version);	//<uint16_t>  协议版本号 
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->batch);	//<uint32_t>  优惠券id 
		$bs->pushUint8_t($this->batch_u);	//<uint8_t> 
		$bs->pushInt32_t($this->status);	//<int> 优惠券状态
		$bs->pushUint8_t($this->status_u);	//<uint8_t> 
		$bs->pushString($this->name);	//<std::string> 优惠券名称
		$bs->pushUint8_t($this->name_u);	//<uint8_t> 
		$bs->pushInt32_t($this->amt);	//<int> 优惠券amt
		$bs->pushUint8_t($this->amt_u);	//<uint8_t> 
		$bs->pushUint32_t($this->validTimeFrom);	//<uint32_t> valid_time_from
		$bs->pushUint8_t($this->validTimeFrom_u);	//<uint8_t> 
		$bs->pushUint32_t($this->validTimeTo);	//<uint32_t> valid_time_to
		$bs->pushUint8_t($this->validTimeTo_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t>  协议版本号 
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['batch'] = $bs->popUint32_t();	//<uint32_t>  优惠券id 
		$this->_arr_value['batch_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['status'] = $bs->popInt32_t();	//<int> 优惠券状态
		$this->_arr_value['status_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['name'] = $bs->popString();	//<std::string> 优惠券名称
		$this->_arr_value['name_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['amt'] = $bs->popInt32_t();	//<int> 优惠券amt
		$this->_arr_value['amt_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['validTimeFrom'] = $bs->popUint32_t();	//<uint32_t> valid_time_from
		$this->_arr_value['validTimeFrom_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['validTimeTo'] = $bs->popUint32_t();	//<uint32_t> valid_time_to
		$this->_arr_value['validTimeTo_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\dashou\bo;	//source idl: com.icson.dashou.idl.TogethersellBuyBo.java
class DSGift{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t>  协议版本号 (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $giftId;	//<uint32_t>  赠品id(版本>=0)
	private $giftId_u;	//<uint8_t> (版本>=0)
	private $skuId;	//<uint64_t> 赠品skuid 备用 (版本>=0)
	private $skuId_u;	//<uint8_t> (版本>=0)
	private $num;	//<uint32_t> 赠品搭配数量(版本>=0)
	private $num_u;	//<uint8_t> (版本>=0)
	private $type;	//<uint32_t> 赠品/组件类型(版本>=0)
	private $type_u;	//<uint8_t> (版本>=0)
	private $showOrder;	//<int> 赠品的show order(版本>=0)
	private $showOrder_u;	//<uint8_t> (版本>=0)
	private $station;	//<uint32_t> 赠品的station(版本>=0)
	private $station_u;	//<uint8_t> (版本>=0)
	private $stockNum;	//<uint32_t> stock_num(版本>=0)
	private $stockNum_u;	//<uint8_t> (版本>=0)
	private $itemInfo;	//<icson::dashou::bo::CItemInfoBo> 配品详情信息(版本>=0)
	private $itemInfo_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->version_u = 0;	//<uint8_t>
		$this->giftId = 0;	//<uint32_t>
		$this->giftId_u = 0;	//<uint8_t>
		$this->skuId = 0;	//<uint64_t>
		$this->skuId_u = 0;	//<uint8_t>
		$this->num = 0;	//<uint32_t>
		$this->num_u = 0;	//<uint8_t>
		$this->type = 0;	//<uint32_t>
		$this->type_u = 0;	//<uint8_t>
		$this->showOrder = 0;	//<int>
		$this->showOrder_u = 0;	//<uint8_t>
		$this->station = 0;	//<uint32_t>
		$this->station_u = 0;	//<uint8_t>
		$this->stockNum = 0;	//<uint32_t>
		$this->stockNum_u = 0;	//<uint8_t>
		$this->itemInfo = new \icson\dashou\bo\ItemInfoBo();	//<icson::dashou::bo::CItemInfoBo>
		$this->itemInfo_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\dashou\bo\DSGift\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();
					if(class_exists($class,false)){
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
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
			exit("icson\dashou\bo\DSGift\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint16_t($this->version);	//<uint16_t>  协议版本号 
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->giftId);	//<uint32_t>  赠品id
		$bs->pushUint8_t($this->giftId_u);	//<uint8_t> 
		$bs->pushUint64_t($this->skuId);	//<uint64_t> 赠品skuid 备用 
		$bs->pushUint8_t($this->skuId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->num);	//<uint32_t> 赠品搭配数量
		$bs->pushUint8_t($this->num_u);	//<uint8_t> 
		$bs->pushUint32_t($this->type);	//<uint32_t> 赠品/组件类型
		$bs->pushUint8_t($this->type_u);	//<uint8_t> 
		$bs->pushInt32_t($this->showOrder);	//<int> 赠品的show order
		$bs->pushUint8_t($this->showOrder_u);	//<uint8_t> 
		$bs->pushUint32_t($this->station);	//<uint32_t> 赠品的station
		$bs->pushUint8_t($this->station_u);	//<uint8_t> 
		$bs->pushUint32_t($this->stockNum);	//<uint32_t> stock_num
		$bs->pushUint8_t($this->stockNum_u);	//<uint8_t> 
		$bs->pushObject($this->itemInfo,'\icson\dashou\bo\ItemInfoBo');	//<icson::dashou::bo::CItemInfoBo> 配品详情信息
		$bs->pushUint8_t($this->itemInfo_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t>  协议版本号 
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['giftId'] = $bs->popUint32_t();	//<uint32_t>  赠品id
		$this->_arr_value['giftId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuId'] = $bs->popUint64_t();	//<uint64_t> 赠品skuid 备用 
		$this->_arr_value['skuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['num'] = $bs->popUint32_t();	//<uint32_t> 赠品搭配数量
		$this->_arr_value['num_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['type'] = $bs->popUint32_t();	//<uint32_t> 赠品/组件类型
		$this->_arr_value['type_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['showOrder'] = $bs->popInt32_t();	//<int> 赠品的show order
		$this->_arr_value['showOrder_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['station'] = $bs->popUint32_t();	//<uint32_t> 赠品的station
		$this->_arr_value['station_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockNum'] = $bs->popUint32_t();	//<uint32_t> stock_num
		$this->_arr_value['stockNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemInfo'] = $bs->popObject('\icson\dashou\bo\ItemInfoBo');	//<icson::dashou::bo::CItemInfoBo> 配品详情信息
		$this->_arr_value['itemInfo_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\dashou\bo;	//source idl: com.icson.dashou.idl.TogethersellBuyBo.java
class DSWarranty{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t>  协议版本号 (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $ruleId;	//<uint32_t>  规则ID(版本>=0)
	private $ruleId_u;	//<uint8_t> (版本>=0)
	private $categoryId;	//<uint32_t> 小类ID(版本>=0)
	private $categoryId_u;	//<uint8_t> (版本>=0)
	private $ruleName;	//<std::string> 延保规则商品名称(版本>=0)
	private $ruleName_u;	//<uint8_t> (版本>=0)
	private $warrantyProductId;	//<uint32_t> 延保商品ID(版本>=0)
	private $warrantyProductId_u;	//<uint8_t> (版本>=0)
	private $skuId;	//<uint64_t> 延保skuid 备用 (版本>=0)
	private $skuId_u;	//<uint8_t> (版本>=0)
	private $warrantyYears;	//<uint32_t> 延保的年限(版本>=0)
	private $warrantyYears_u;	//<uint8_t> (版本>=0)
	private $warrantyName;	//<std::string> 延保商品名称(版本>=0)
	private $warrantyName_u;	//<uint8_t> (版本>=0)
	private $priceStart;	//<uint32_t> 起始金额(版本>=0)
	private $priceStart_u;	//<uint8_t> (版本>=0)
	private $priceEnd;	//<uint32_t> 截止金额(版本>=0)
	private $priceEnd_u;	//<uint8_t> (版本>=0)
	private $ruleStatus;	//<uint32_t> 规则状态(版本>=0)
	private $ruleStatus_u;	//<uint8_t> (版本>=0)
	private $favor;	//<uint32_t> 优惠金额(版本>=0)
	private $favor_u;	//<uint8_t> (版本>=0)
	private $warrantyPrice;	//<uint32_t> 延保商品价格(版本>=0)
	private $warrantyPrice_u;	//<uint8_t> (版本>=0)
	private $station;	//<uint32_t> 延保的station(版本>=0)
	private $station_u;	//<uint8_t> (版本>=0)
	private $warrantyType;	//<uint32_t> 延保的类型(版本>=0)
	private $warrantyType_u;	//<uint8_t> (版本>=0)
	private $itemInfo;	//<icson::dashou::bo::CItemInfoBo> 配品详情信息(版本>=0)
	private $itemInfo_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->version_u = 0;	//<uint8_t>
		$this->ruleId = 0;	//<uint32_t>
		$this->ruleId_u = 0;	//<uint8_t>
		$this->categoryId = 0;	//<uint32_t>
		$this->categoryId_u = 0;	//<uint8_t>
		$this->ruleName = "";	//<std::string>
		$this->ruleName_u = 0;	//<uint8_t>
		$this->warrantyProductId = 0;	//<uint32_t>
		$this->warrantyProductId_u = 0;	//<uint8_t>
		$this->skuId = 0;	//<uint64_t>
		$this->skuId_u = 0;	//<uint8_t>
		$this->warrantyYears = 0;	//<uint32_t>
		$this->warrantyYears_u = 0;	//<uint8_t>
		$this->warrantyName = "";	//<std::string>
		$this->warrantyName_u = 0;	//<uint8_t>
		$this->priceStart = 0;	//<uint32_t>
		$this->priceStart_u = 0;	//<uint8_t>
		$this->priceEnd = 0;	//<uint32_t>
		$this->priceEnd_u = 0;	//<uint8_t>
		$this->ruleStatus = 0;	//<uint32_t>
		$this->ruleStatus_u = 0;	//<uint8_t>
		$this->favor = 0;	//<uint32_t>
		$this->favor_u = 0;	//<uint8_t>
		$this->warrantyPrice = 0;	//<uint32_t>
		$this->warrantyPrice_u = 0;	//<uint8_t>
		$this->station = 0;	//<uint32_t>
		$this->station_u = 0;	//<uint8_t>
		$this->warrantyType = 0;	//<uint32_t>
		$this->warrantyType_u = 0;	//<uint8_t>
		$this->itemInfo = new \icson\dashou\bo\ItemInfoBo();	//<icson::dashou::bo::CItemInfoBo>
		$this->itemInfo_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\dashou\bo\DSWarranty\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();
					if(class_exists($class,false)){
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
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
			exit("icson\dashou\bo\DSWarranty\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint16_t($this->version);	//<uint16_t>  协议版本号 
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->ruleId);	//<uint32_t>  规则ID
		$bs->pushUint8_t($this->ruleId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->categoryId);	//<uint32_t> 小类ID
		$bs->pushUint8_t($this->categoryId_u);	//<uint8_t> 
		$bs->pushString($this->ruleName);	//<std::string> 延保规则商品名称
		$bs->pushUint8_t($this->ruleName_u);	//<uint8_t> 
		$bs->pushUint32_t($this->warrantyProductId);	//<uint32_t> 延保商品ID
		$bs->pushUint8_t($this->warrantyProductId_u);	//<uint8_t> 
		$bs->pushUint64_t($this->skuId);	//<uint64_t> 延保skuid 备用 
		$bs->pushUint8_t($this->skuId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->warrantyYears);	//<uint32_t> 延保的年限
		$bs->pushUint8_t($this->warrantyYears_u);	//<uint8_t> 
		$bs->pushString($this->warrantyName);	//<std::string> 延保商品名称
		$bs->pushUint8_t($this->warrantyName_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceStart);	//<uint32_t> 起始金额
		$bs->pushUint8_t($this->priceStart_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceEnd);	//<uint32_t> 截止金额
		$bs->pushUint8_t($this->priceEnd_u);	//<uint8_t> 
		$bs->pushUint32_t($this->ruleStatus);	//<uint32_t> 规则状态
		$bs->pushUint8_t($this->ruleStatus_u);	//<uint8_t> 
		$bs->pushUint32_t($this->favor);	//<uint32_t> 优惠金额
		$bs->pushUint8_t($this->favor_u);	//<uint8_t> 
		$bs->pushUint32_t($this->warrantyPrice);	//<uint32_t> 延保商品价格
		$bs->pushUint8_t($this->warrantyPrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->station);	//<uint32_t> 延保的station
		$bs->pushUint8_t($this->station_u);	//<uint8_t> 
		$bs->pushUint32_t($this->warrantyType);	//<uint32_t> 延保的类型
		$bs->pushUint8_t($this->warrantyType_u);	//<uint8_t> 
		$bs->pushObject($this->itemInfo,'\icson\dashou\bo\ItemInfoBo');	//<icson::dashou::bo::CItemInfoBo> 配品详情信息
		$bs->pushUint8_t($this->itemInfo_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t>  协议版本号 
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleId'] = $bs->popUint32_t();	//<uint32_t>  规则ID
		$this->_arr_value['ruleId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['categoryId'] = $bs->popUint32_t();	//<uint32_t> 小类ID
		$this->_arr_value['categoryId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleName'] = $bs->popString();	//<std::string> 延保规则商品名称
		$this->_arr_value['ruleName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['warrantyProductId'] = $bs->popUint32_t();	//<uint32_t> 延保商品ID
		$this->_arr_value['warrantyProductId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuId'] = $bs->popUint64_t();	//<uint64_t> 延保skuid 备用 
		$this->_arr_value['skuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['warrantyYears'] = $bs->popUint32_t();	//<uint32_t> 延保的年限
		$this->_arr_value['warrantyYears_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['warrantyName'] = $bs->popString();	//<std::string> 延保商品名称
		$this->_arr_value['warrantyName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceStart'] = $bs->popUint32_t();	//<uint32_t> 起始金额
		$this->_arr_value['priceStart_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceEnd'] = $bs->popUint32_t();	//<uint32_t> 截止金额
		$this->_arr_value['priceEnd_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleStatus'] = $bs->popUint32_t();	//<uint32_t> 规则状态
		$this->_arr_value['ruleStatus_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['favor'] = $bs->popUint32_t();	//<uint32_t> 优惠金额
		$this->_arr_value['favor_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['warrantyPrice'] = $bs->popUint32_t();	//<uint32_t> 延保商品价格
		$this->_arr_value['warrantyPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['station'] = $bs->popUint32_t();	//<uint32_t> 延保的station
		$this->_arr_value['station_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['warrantyType'] = $bs->popUint32_t();	//<uint32_t> 延保的类型
		$this->_arr_value['warrantyType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemInfo'] = $bs->popObject('\icson\dashou\bo\ItemInfoBo');	//<icson::dashou::bo::CItemInfoBo> 配品详情信息
		$this->_arr_value['itemInfo_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\dashou\bo;	//source idl: com.icson.dashou.idl.DSWarranty.java
class ItemInfoBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号   (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $productName;	//<std::string> 商品名称(版本>=0)
	private $productName_u;	//<uint8_t> (版本>=0)
	private $productCharId;	//<std::string> 商品char_id(版本>=0)
	private $productCharId_u;	//<uint8_t> (版本>=0)
	private $marketPrice;	//<uint32_t> 市场价(版本>=0)
	private $marketPrice_u;	//<uint8_t> (版本>=0)
	private $icsonPrice;	//<uint32_t> 易迅价(版本>=0)
	private $icsonPrice_u;	//<uint8_t> (版本>=0)
	private $weight;	//<uint32_t> 商品的重量(版本>=0)
	private $weight_u;	//<uint8_t> (版本>=0)
	private $restrictedTransType;	//<int> 限运类型(版本>=0)
	private $restrictedTransType_u;	//<uint8_t> (版本>=0)
	private $availableNum;	//<int> 可用库存(版本>=0)
	private $availableNum_u;	//<uint8_t> (版本>=0)
	private $virtualNum;	//<int> 虚拟库存(版本>=0)
	private $virtualNum_u;	//<uint8_t> (版本>=0)
	private $psyStock;	//<uint32_t> psystock(版本>=0)
	private $psyStock_u;	//<uint8_t> (版本>=0)
	private $arrivalDays;	//<int> arrival_days(版本>=0)
	private $arrivalDays_u;	//<uint8_t> (版本>=0)
	private $c3Ids;	//<std::string> 三级类目Id(版本>=0)
	private $c3Ids_u;	//<uint8_t> (版本>=0)
	private $c3IdName;	//<std::string> 三级类目名称Id(版本>=0)
	private $c3IdName_u;	//<uint8_t> (版本>=0)
	private $picNum;	//<uint32_t> 图片数量(版本>=0)
	private $picNum_u;	//<uint8_t> (版本>=0)
	private $color;	//<uint64_t> 颜色(版本>=0)
	private $color_u;	//<uint8_t> (版本>=0)
	private $colorText;	//<std::string> 商品颜色名称(版本>=0)
	private $colorText_u;	//<uint8_t> (版本>=0)
	private $productSize;	//<uint64_t> 尺码(版本>=0)
	private $productSize_u;	//<uint8_t> (版本>=0)
	private $productSizeText;	//<std::string> 商品规格明文(版本>=0)
	private $productSizeText_u;	//<uint8_t> (版本>=0)
	private $multiPriceType;	//<int> 多价类型(版本>=0)
	private $multiPriceType_u;	//<uint8_t> (版本>=0)
	private $logoUrl;	//<std::map<std::string,std::string> > 图片Url map size->url 如：http://img0.wgimg.com/qqbuy/855006089/item-00000000000000000000003E86B55530.0.jpg/320?50E2EA7E (版本>=0)
	private $logoUrl_u;	//<uint8_t> (版本>=0)
	private $flag;	//<uint32_t> 商品flag 例如：延保、赠品、组件等(版本>=0)
	private $flag_u;	//<uint8_t> (版本>=0)
	private $status;	//<int> 商品状态 参见enum SkuState状态 0-在售 1-售完 2-下架 3-强制下架 4-删除 5-强制删除 (版本>=0)
	private $status_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->productName = "";	//<std::string>
		$this->productName_u = 0;	//<uint8_t>
		$this->productCharId = "";	//<std::string>
		$this->productCharId_u = 0;	//<uint8_t>
		$this->marketPrice = 0;	//<uint32_t>
		$this->marketPrice_u = 0;	//<uint8_t>
		$this->icsonPrice = 0;	//<uint32_t>
		$this->icsonPrice_u = 0;	//<uint8_t>
		$this->weight = 0;	//<uint32_t>
		$this->weight_u = 0;	//<uint8_t>
		$this->restrictedTransType = 0;	//<int>
		$this->restrictedTransType_u = 0;	//<uint8_t>
		$this->availableNum = 0;	//<int>
		$this->availableNum_u = 0;	//<uint8_t>
		$this->virtualNum = 0;	//<int>
		$this->virtualNum_u = 0;	//<uint8_t>
		$this->psyStock = 0;	//<uint32_t>
		$this->psyStock_u = 0;	//<uint8_t>
		$this->arrivalDays = 0;	//<int>
		$this->arrivalDays_u = 0;	//<uint8_t>
		$this->c3Ids = "";	//<std::string>
		$this->c3Ids_u = 0;	//<uint8_t>
		$this->c3IdName = "";	//<std::string>
		$this->c3IdName_u = 0;	//<uint8_t>
		$this->picNum = 0;	//<uint32_t>
		$this->picNum_u = 0;	//<uint8_t>
		$this->color = 0;	//<uint64_t>
		$this->color_u = 0;	//<uint8_t>
		$this->colorText = "";	//<std::string>
		$this->colorText_u = 0;	//<uint8_t>
		$this->productSize = 0;	//<uint64_t>
		$this->productSize_u = 0;	//<uint8_t>
		$this->productSizeText = "";	//<std::string>
		$this->productSizeText_u = 0;	//<uint8_t>
		$this->multiPriceType = 0;	//<int>
		$this->multiPriceType_u = 0;	//<uint8_t>
		$this->logoUrl = new \stl_map2('stl_string,stl_string');	//<std::map<std::string,std::string> >
		$this->logoUrl_u = 0;	//<uint8_t>
		$this->flag = 0;	//<uint32_t>
		$this->flag_u = 0;	//<uint8_t>
		$this->status = 0;	//<int>
		$this->status_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\dashou\bo\ItemInfoBo\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();
					if(class_exists($class,false)){
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
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
			exit("icson\dashou\bo\ItemInfoBo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushString($this->productName);	//<std::string> 商品名称
		$bs->pushUint8_t($this->productName_u);	//<uint8_t> 
		$bs->pushString($this->productCharId);	//<std::string> 商品char_id
		$bs->pushUint8_t($this->productCharId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->marketPrice);	//<uint32_t> 市场价
		$bs->pushUint8_t($this->marketPrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->icsonPrice);	//<uint32_t> 易迅价
		$bs->pushUint8_t($this->icsonPrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->weight);	//<uint32_t> 商品的重量
		$bs->pushUint8_t($this->weight_u);	//<uint8_t> 
		$bs->pushInt32_t($this->restrictedTransType);	//<int> 限运类型
		$bs->pushUint8_t($this->restrictedTransType_u);	//<uint8_t> 
		$bs->pushInt32_t($this->availableNum);	//<int> 可用库存
		$bs->pushUint8_t($this->availableNum_u);	//<uint8_t> 
		$bs->pushInt32_t($this->virtualNum);	//<int> 虚拟库存
		$bs->pushUint8_t($this->virtualNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->psyStock);	//<uint32_t> psystock
		$bs->pushUint8_t($this->psyStock_u);	//<uint8_t> 
		$bs->pushInt32_t($this->arrivalDays);	//<int> arrival_days
		$bs->pushUint8_t($this->arrivalDays_u);	//<uint8_t> 
		$bs->pushString($this->c3Ids);	//<std::string> 三级类目Id
		$bs->pushUint8_t($this->c3Ids_u);	//<uint8_t> 
		$bs->pushString($this->c3IdName);	//<std::string> 三级类目名称Id
		$bs->pushUint8_t($this->c3IdName_u);	//<uint8_t> 
		$bs->pushUint32_t($this->picNum);	//<uint32_t> 图片数量
		$bs->pushUint8_t($this->picNum_u);	//<uint8_t> 
		$bs->pushUint64_t($this->color);	//<uint64_t> 颜色
		$bs->pushUint8_t($this->color_u);	//<uint8_t> 
		$bs->pushString($this->colorText);	//<std::string> 商品颜色名称
		$bs->pushUint8_t($this->colorText_u);	//<uint8_t> 
		$bs->pushUint64_t($this->productSize);	//<uint64_t> 尺码
		$bs->pushUint8_t($this->productSize_u);	//<uint8_t> 
		$bs->pushString($this->productSizeText);	//<std::string> 商品规格明文
		$bs->pushUint8_t($this->productSizeText_u);	//<uint8_t> 
		$bs->pushInt32_t($this->multiPriceType);	//<int> 多价类型
		$bs->pushUint8_t($this->multiPriceType_u);	//<uint8_t> 
		$bs->pushObject($this->logoUrl,'stl_map');	//<std::map<std::string,std::string> > 图片Url map size->url 如：http://img0.wgimg.com/qqbuy/855006089/item-00000000000000000000003E86B55530.0.jpg/320?50E2EA7E 
		$bs->pushUint8_t($this->logoUrl_u);	//<uint8_t> 
		$bs->pushUint32_t($this->flag);	//<uint32_t> 商品flag 例如：延保、赠品、组件等
		$bs->pushUint8_t($this->flag_u);	//<uint8_t> 
		$bs->pushInt32_t($this->status);	//<int> 商品状态 参见enum SkuState状态 0-在售 1-售完 2-下架 3-强制下架 4-删除 5-强制删除 
		$bs->pushUint8_t($this->status_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号   
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productName'] = $bs->popString();	//<std::string> 商品名称
		$this->_arr_value['productName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productCharId'] = $bs->popString();	//<std::string> 商品char_id
		$this->_arr_value['productCharId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['marketPrice'] = $bs->popUint32_t();	//<uint32_t> 市场价
		$this->_arr_value['marketPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonPrice'] = $bs->popUint32_t();	//<uint32_t> 易迅价
		$this->_arr_value['icsonPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['weight'] = $bs->popUint32_t();	//<uint32_t> 商品的重量
		$this->_arr_value['weight_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['restrictedTransType'] = $bs->popInt32_t();	//<int> 限运类型
		$this->_arr_value['restrictedTransType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['availableNum'] = $bs->popInt32_t();	//<int> 可用库存
		$this->_arr_value['availableNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['virtualNum'] = $bs->popInt32_t();	//<int> 虚拟库存
		$this->_arr_value['virtualNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['psyStock'] = $bs->popUint32_t();	//<uint32_t> psystock
		$this->_arr_value['psyStock_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['arrivalDays'] = $bs->popInt32_t();	//<int> arrival_days
		$this->_arr_value['arrivalDays_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['c3Ids'] = $bs->popString();	//<std::string> 三级类目Id
		$this->_arr_value['c3Ids_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['c3IdName'] = $bs->popString();	//<std::string> 三级类目名称Id
		$this->_arr_value['c3IdName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['picNum'] = $bs->popUint32_t();	//<uint32_t> 图片数量
		$this->_arr_value['picNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['color'] = $bs->popUint64_t();	//<uint64_t> 颜色
		$this->_arr_value['color_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['colorText'] = $bs->popString();	//<std::string> 商品颜色名称
		$this->_arr_value['colorText_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productSize'] = $bs->popUint64_t();	//<uint64_t> 尺码
		$this->_arr_value['productSize_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productSizeText'] = $bs->popString();	//<std::string> 商品规格明文
		$this->_arr_value['productSizeText_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['multiPriceType'] = $bs->popInt32_t();	//<int> 多价类型
		$this->_arr_value['multiPriceType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['logoUrl'] = $bs->popObject('stl_map<stl_string,stl_string>');	//<std::map<std::string,std::string> > 图片Url map size->url 如：http://img0.wgimg.com/qqbuy/855006089/item-00000000000000000000003E86B55530.0.jpg/320?50E2EA7E 
		$this->_arr_value['logoUrl_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['flag'] = $bs->popUint32_t();	//<uint32_t> 商品flag 例如：延保、赠品、组件等
		$this->_arr_value['flag_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['status'] = $bs->popInt32_t();	//<int> 商品状态 参见enum SkuState状态 0-在售 1-售完 2-下架 3-强制下架 4-删除 5-强制删除 
		$this->_arr_value['status_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\dashou\bo;	//source idl: com.icson.dashou.idl.CheckTogetherSellReq.java
class CheckTogetherSellParamBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号   (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $togetherSellCheckVec;	//<std::vector<icson::dashou::bo::CTogetherSellCheckBo> >  验证入参数据(版本>=0)
	private $togetherSellCheckVec_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->togetherSellCheckVec = new \stl_vector2('\icson\dashou\bo\TogetherSellCheckBo');	//<std::vector<icson::dashou::bo::CTogetherSellCheckBo> >
		$this->togetherSellCheckVec_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\dashou\bo\CheckTogetherSellParamBo\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();
					if(class_exists($class,false)){
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
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
			exit("icson\dashou\bo\CheckTogetherSellParamBo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushObject($this->togetherSellCheckVec,'stl_vector');	//<std::vector<icson::dashou::bo::CTogetherSellCheckBo> >  验证入参数据
		$bs->pushUint8_t($this->togetherSellCheckVec_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号   
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['togetherSellCheckVec'] = $bs->popObject('stl_vector<\icson\dashou\bo\TogetherSellCheckBo>');	//<std::vector<icson::dashou::bo::CTogetherSellCheckBo> >  验证入参数据
		$this->_arr_value['togetherSellCheckVec_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\dashou\bo;	//source idl: com.icson.dashou.idl.CheckTogetherSellParamBo.java
class TogetherSellCheckBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号   (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $type;	//<uint32_t> 类型  0为商品 1 为套餐(版本>=0)
	private $type_u;	//<uint8_t> (版本>=0)
	private $mainProductId;	//<uint32_t> 主商品id(版本>=0)
	private $mainProductId_u;	//<uint8_t> (版本>=0)
	private $mainSkuId;	//<uint64_t> 主商品skuid ，备用 (版本>=0)
	private $mainSkuId_u;	//<uint8_t> (版本>=0)
	private $mainBuyNum;	//<uint32_t> 主商品购买数量(版本>=0)
	private $mainBuyNum_u;	//<uint8_t> (版本>=0)
	private $rulesChecked;	//<std::vector<icson::dashou::bo::CTogetherSellCheckRuleBo> > 需验证规则(版本>=0)
	private $rulesChecked_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->type = 0;	//<uint32_t>
		$this->type_u = 0;	//<uint8_t>
		$this->mainProductId = 0;	//<uint32_t>
		$this->mainProductId_u = 0;	//<uint8_t>
		$this->mainSkuId = 0;	//<uint64_t>
		$this->mainSkuId_u = 0;	//<uint8_t>
		$this->mainBuyNum = 0;	//<uint32_t>
		$this->mainBuyNum_u = 0;	//<uint8_t>
		$this->rulesChecked = new \stl_vector2('\icson\dashou\bo\TogetherSellCheckRuleBo');	//<std::vector<icson::dashou::bo::CTogetherSellCheckRuleBo> >
		$this->rulesChecked_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\dashou\bo\TogetherSellCheckBo\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();
					if(class_exists($class,false)){
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
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
			exit("icson\dashou\bo\TogetherSellCheckBo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint32_t($this->type);	//<uint32_t> 类型  0为商品 1 为套餐
		$bs->pushUint8_t($this->type_u);	//<uint8_t> 
		$bs->pushUint32_t($this->mainProductId);	//<uint32_t> 主商品id
		$bs->pushUint8_t($this->mainProductId_u);	//<uint8_t> 
		$bs->pushUint64_t($this->mainSkuId);	//<uint64_t> 主商品skuid ，备用 
		$bs->pushUint8_t($this->mainSkuId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->mainBuyNum);	//<uint32_t> 主商品购买数量
		$bs->pushUint8_t($this->mainBuyNum_u);	//<uint8_t> 
		$bs->pushObject($this->rulesChecked,'stl_vector');	//<std::vector<icson::dashou::bo::CTogetherSellCheckRuleBo> > 需验证规则
		$bs->pushUint8_t($this->rulesChecked_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号   
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['type'] = $bs->popUint32_t();	//<uint32_t> 类型  0为商品 1 为套餐
		$this->_arr_value['type_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mainProductId'] = $bs->popUint32_t();	//<uint32_t> 主商品id
		$this->_arr_value['mainProductId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mainSkuId'] = $bs->popUint64_t();	//<uint64_t> 主商品skuid ，备用 
		$this->_arr_value['mainSkuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mainBuyNum'] = $bs->popUint32_t();	//<uint32_t> 主商品购买数量
		$this->_arr_value['mainBuyNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['rulesChecked'] = $bs->popObject('stl_vector<\icson\dashou\bo\TogetherSellCheckRuleBo>');	//<std::vector<icson::dashou::bo::CTogetherSellCheckRuleBo> > 需验证规则
		$this->_arr_value['rulesChecked_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\dashou\bo;	//source idl: com.icson.dashou.idl.TogetherSellCheckBo.java
class TogetherSellCheckRuleBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号   (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $ruleType;	//<uint32_t> 关系类型， 2-延保 3-随心配(版本>=0)
	private $ruleType_u;	//<uint8_t> (版本>=0)
	private $ruleId;	//<std::string> 关系ID ，这里的关系id购物车必须要存储用于验证，否则不是从随心配渠道进来的也会享受优惠，导致数据不一致(版本>=0)
	private $ruleId_u;	//<uint8_t> (版本>=0)
	private $subProductId;	//<uint32_t> 配商品id(版本>=0)
	private $subProductId_u;	//<uint8_t> (版本>=0)
	private $subSkuId;	//<uint64_t> 配商品skuid ，备用 (版本>=0)
	private $subSkuId_u;	//<uint8_t> (版本>=0)
	private $discount;	//<uint32_t> 配品单件优惠额(版本>=0)
	private $discount_u;	//<uint8_t> (版本>=0)
	private $price;	//<uint32_t> 配品单件批价价格(版本>=0)
	private $price_u;	//<uint8_t> (版本>=0)
	private $subApportion;	//<uint32_t> 配品单件分担的成本(版本>=0)
	private $subApportion_u;	//<uint8_t> (版本>=0)
	private $mainApportion;	//<uint32_t> 主品单件分担的成本(版本>=0)
	private $maiApportion_u;	//<uint8_t> (版本>=0)
	private $buyNum;	//<uint32_t> 购买实际数量/匹配数量/不匹配数量(版本>=0)
	private $buyNum_u;	//<uint8_t> (版本>=0)
	private $invalidReason;	//<uint32_t> 失效原因(版本>=0)
	private $invalidReason_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->ruleType = 0;	//<uint32_t>
		$this->ruleType_u = 0;	//<uint8_t>
		$this->ruleId = "";	//<std::string>
		$this->ruleId_u = 0;	//<uint8_t>
		$this->subProductId = 0;	//<uint32_t>
		$this->subProductId_u = 0;	//<uint8_t>
		$this->subSkuId = 0;	//<uint64_t>
		$this->subSkuId_u = 0;	//<uint8_t>
		$this->discount = 0;	//<uint32_t>
		$this->discount_u = 0;	//<uint8_t>
		$this->price = 0;	//<uint32_t>
		$this->price_u = 0;	//<uint8_t>
		$this->subApportion = 0;	//<uint32_t>
		$this->subApportion_u = 0;	//<uint8_t>
		$this->mainApportion = 0;	//<uint32_t>
		$this->maiApportion_u = 0;	//<uint8_t>
		$this->buyNum = 0;	//<uint32_t>
		$this->buyNum_u = 0;	//<uint8_t>
		$this->invalidReason = 0;	//<uint32_t>
		$this->invalidReason_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\dashou\bo\TogetherSellCheckRuleBo\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();
					if(class_exists($class,false)){
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
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
			exit("icson\dashou\bo\TogetherSellCheckRuleBo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint32_t($this->ruleType);	//<uint32_t> 关系类型， 2-延保 3-随心配
		$bs->pushUint8_t($this->ruleType_u);	//<uint8_t> 
		$bs->pushString($this->ruleId);	//<std::string> 关系ID ，这里的关系id购物车必须要存储用于验证，否则不是从随心配渠道进来的也会享受优惠，导致数据不一致
		$bs->pushUint8_t($this->ruleId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->subProductId);	//<uint32_t> 配商品id
		$bs->pushUint8_t($this->subProductId_u);	//<uint8_t> 
		$bs->pushUint64_t($this->subSkuId);	//<uint64_t> 配商品skuid ，备用 
		$bs->pushUint8_t($this->subSkuId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->discount);	//<uint32_t> 配品单件优惠额
		$bs->pushUint8_t($this->discount_u);	//<uint8_t> 
		$bs->pushUint32_t($this->price);	//<uint32_t> 配品单件批价价格
		$bs->pushUint8_t($this->price_u);	//<uint8_t> 
		$bs->pushUint32_t($this->subApportion);	//<uint32_t> 配品单件分担的成本
		$bs->pushUint8_t($this->subApportion_u);	//<uint8_t> 
		$bs->pushUint32_t($this->mainApportion);	//<uint32_t> 主品单件分担的成本
		$bs->pushUint8_t($this->maiApportion_u);	//<uint8_t> 
		$bs->pushUint32_t($this->buyNum);	//<uint32_t> 购买实际数量/匹配数量/不匹配数量
		$bs->pushUint8_t($this->buyNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->invalidReason);	//<uint32_t> 失效原因
		$bs->pushUint8_t($this->invalidReason_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号   
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleType'] = $bs->popUint32_t();	//<uint32_t> 关系类型， 2-延保 3-随心配
		$this->_arr_value['ruleType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleId'] = $bs->popString();	//<std::string> 关系ID ，这里的关系id购物车必须要存储用于验证，否则不是从随心配渠道进来的也会享受优惠，导致数据不一致
		$this->_arr_value['ruleId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['subProductId'] = $bs->popUint32_t();	//<uint32_t> 配商品id
		$this->_arr_value['subProductId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['subSkuId'] = $bs->popUint64_t();	//<uint64_t> 配商品skuid ，备用 
		$this->_arr_value['subSkuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['discount'] = $bs->popUint32_t();	//<uint32_t> 配品单件优惠额
		$this->_arr_value['discount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['price'] = $bs->popUint32_t();	//<uint32_t> 配品单件批价价格
		$this->_arr_value['price_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['subApportion'] = $bs->popUint32_t();	//<uint32_t> 配品单件分担的成本
		$this->_arr_value['subApportion_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mainApportion'] = $bs->popUint32_t();	//<uint32_t> 主品单件分担的成本
		$this->_arr_value['maiApportion_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyNum'] = $bs->popUint32_t();	//<uint32_t> 购买实际数量/匹配数量/不匹配数量
		$this->_arr_value['buyNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['invalidReason'] = $bs->popUint32_t();	//<uint32_t> 失效原因
		$this->_arr_value['invalidReason_u'] = $bs->popUint8_t();	//<uint8_t> 

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
