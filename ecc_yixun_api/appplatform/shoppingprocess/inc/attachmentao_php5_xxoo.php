<?php
namespace icson\deal\ddo\attachment;	//source idl: com.icson.deal.idl.GetAppointInfoReq.java
if (!class_exists('icson\deal\ddo\attachment\MainProduct', false)) {
class MainProduct{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t>  协议版本号 (版本>=0)
	private $mainProductIdList;	//<std::vector<uint32_t> >  主商品Id列表 (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $mainProductIdList_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->mainProductIdList = new \stl_vector2('uint32_t');	//<std::vector<uint32_t> >
		$this->version_u = 0;	//<uint8_t>
		$this->mainProductIdList_u = 0;	//<uint8_t>
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
			exit("\icson\deal\ddo\attachment\MainProduct\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\ddo\attachment\MainProduct\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint16_t($this->version);	//<uint16_t>  协议版本号 
		$bs->pushObject($this->mainProductIdList,'stl_vector');	//<std::vector<uint32_t> >  主商品Id列表 
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->mainProductIdList_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t>  协议版本号 
		$this->_arr_value['mainProductIdList'] = $bs->popObject('stl_vector<uint32_t>');	//<std::vector<uint32_t> >  主商品Id列表 
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mainProductIdList_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\deal\ddo\attachment;	//source idl: com.icson.deal.idl.AttachmentAo.java
if (!class_exists('icson\deal\ddo\attachment\Attachment', false)) {
class Attachment{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t>  协议版本号 (版本>=0)
	private $promotion;	//<icson::deal::ddo::attachment::CPromotion>  套餐信息列表(版本>=0)
	private $vecGift;	//<std::vector<icson::deal::ddo::attachment::CGift> >  赠品组件列表(版本>=0)
	private $vecRelative;	//<std::vector<icson::deal::ddo::attachment::CRelativity> > 随心配列表(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $promotion_u;	//<uint8_t> (版本>=0)
	private $vecGift_u;	//<uint8_t> (版本>=0)
	private $vecRelative_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->promotion = new \icson\deal\ddo\attachment\Promotion();	//<icson::deal::ddo::attachment::CPromotion>
		$this->vecGift = new \stl_vector2('\icson\deal\ddo\attachment\Gift');	//<std::vector<icson::deal::ddo::attachment::CGift> >
		$this->vecRelative = new \stl_vector2('\icson\deal\ddo\attachment\Relativity');	//<std::vector<icson::deal::ddo::attachment::CRelativity> >
		$this->version_u = 0;	//<uint8_t>
		$this->promotion_u = 0;	//<uint8_t>
		$this->vecGift_u = 0;	//<uint8_t>
		$this->vecRelative_u = 0;	//<uint8_t>
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
			exit("\icson\deal\ddo\attachment\Attachment\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\ddo\attachment\Attachment\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint16_t($this->version);	//<uint16_t>  协议版本号 
		$bs->pushObject($this->promotion,'\icson\deal\ddo\attachment\Promotion');	//<icson::deal::ddo::attachment::CPromotion>  套餐信息列表
		$bs->pushObject($this->vecGift,'stl_vector');	//<std::vector<icson::deal::ddo::attachment::CGift> >  赠品组件列表
		$bs->pushObject($this->vecRelative,'stl_vector');	//<std::vector<icson::deal::ddo::attachment::CRelativity> > 随心配列表
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->promotion_u);	//<uint8_t> 
		$bs->pushUint8_t($this->vecGift_u);	//<uint8_t> 
		$bs->pushUint8_t($this->vecRelative_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t>  协议版本号 
		$this->_arr_value['promotion'] = $bs->popObject('\icson\deal\ddo\attachment\Promotion');	//<icson::deal::ddo::attachment::CPromotion>  套餐信息列表
		$this->_arr_value['vecGift'] = $bs->popObject('stl_vector<\icson\deal\ddo\attachment\Gift>');	//<std::vector<icson::deal::ddo::attachment::CGift> >  赠品组件列表
		$this->_arr_value['vecRelative'] = $bs->popObject('stl_vector<\icson\deal\ddo\attachment\Relativity>');	//<std::vector<icson::deal::ddo::attachment::CRelativity> > 随心配列表
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['promotion_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['vecGift_u'] = $bs->popUint8_t();	//<uint8_t> 
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
}

namespace icson\deal\ddo\attachment;	//source idl: com.icson.deal.idl.Attachment.java
if (!class_exists('icson\deal\ddo\attachment\Gift', false)) {
class Gift{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t>  协议版本号 (版本>=0)
	private $giftId;	//<uint32_t>  赠品id(版本>=0)
	private $num;	//<uint32_t> 赠品搭配数量(版本>=0)
	private $type;	//<uint32_t> 赠品/组件类型(版本>=0)
	private $status;	//<int> 赠品状态(版本>=0)
	private $showOrder;	//<int> 赠品的show order(版本>=0)
	private $name;	//<std::string> 赠品名称(版本>=0)
	private $productCharId;	//<std::string> 赠品商品char_id(版本>=0)
	private $marketPrice;	//<uint32_t> 赠品价格(版本>=0)
	private $station;	//<uint32_t> 赠品的station(版本>=0)
	private $weight;	//<uint32_t> 赠品的重量(版本>=0)
	private $stockNum;	//<uint32_t> stock_num(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $giftId_u;	//<uint8_t> (版本>=0)
	private $num_u;	//<uint8_t> (版本>=0)
	private $type_u;	//<uint8_t> (版本>=0)
	private $status_u;	//<uint8_t> (版本>=0)
	private $showOrder_u;	//<uint8_t> (版本>=0)
	private $name_u;	//<uint8_t> (版本>=0)
	private $productCharId_u;	//<uint8_t> (版本>=0)
	private $marketPrice_u;	//<uint8_t> (版本>=0)
	private $station_u;	//<uint8_t> (版本>=0)
	private $weight_u;	//<uint8_t> (版本>=0)
	private $stockNum_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->giftId = 0;	//<uint32_t>
		$this->num = 0;	//<uint32_t>
		$this->type = 0;	//<uint32_t>
		$this->status = 0;	//<int>
		$this->showOrder = 0;	//<int>
		$this->name = "";	//<std::string>
		$this->productCharId = "";	//<std::string>
		$this->marketPrice = 0;	//<uint32_t>
		$this->station = 0;	//<uint32_t>
		$this->weight = 0;	//<uint32_t>
		$this->stockNum = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->giftId_u = 0;	//<uint8_t>
		$this->num_u = 0;	//<uint8_t>
		$this->type_u = 0;	//<uint8_t>
		$this->status_u = 0;	//<uint8_t>
		$this->showOrder_u = 0;	//<uint8_t>
		$this->name_u = 0;	//<uint8_t>
		$this->productCharId_u = 0;	//<uint8_t>
		$this->marketPrice_u = 0;	//<uint8_t>
		$this->station_u = 0;	//<uint8_t>
		$this->weight_u = 0;	//<uint8_t>
		$this->stockNum_u = 0;	//<uint8_t>
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
			exit("\icson\deal\ddo\attachment\Gift\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\ddo\attachment\Gift\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint16_t($this->version);	//<uint16_t>  协议版本号 
		$bs->pushUint32_t($this->giftId);	//<uint32_t>  赠品id
		$bs->pushUint32_t($this->num);	//<uint32_t> 赠品搭配数量
		$bs->pushUint32_t($this->type);	//<uint32_t> 赠品/组件类型
		$bs->pushInt32_t($this->status);	//<int> 赠品状态
		$bs->pushInt32_t($this->showOrder);	//<int> 赠品的show order
		$bs->pushString($this->name);	//<std::string> 赠品名称
		$bs->pushString($this->productCharId);	//<std::string> 赠品商品char_id
		$bs->pushUint32_t($this->marketPrice);	//<uint32_t> 赠品价格
		$bs->pushUint32_t($this->station);	//<uint32_t> 赠品的station
		$bs->pushUint32_t($this->weight);	//<uint32_t> 赠品的重量
		$bs->pushUint32_t($this->stockNum);	//<uint32_t> stock_num
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->giftId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->num_u);	//<uint8_t> 
		$bs->pushUint8_t($this->type_u);	//<uint8_t> 
		$bs->pushUint8_t($this->status_u);	//<uint8_t> 
		$bs->pushUint8_t($this->showOrder_u);	//<uint8_t> 
		$bs->pushUint8_t($this->name_u);	//<uint8_t> 
		$bs->pushUint8_t($this->productCharId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->marketPrice_u);	//<uint8_t> 
		$bs->pushUint8_t($this->station_u);	//<uint8_t> 
		$bs->pushUint8_t($this->weight_u);	//<uint8_t> 
		$bs->pushUint8_t($this->stockNum_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t>  协议版本号 
		$this->_arr_value['giftId'] = $bs->popUint32_t();	//<uint32_t>  赠品id
		$this->_arr_value['num'] = $bs->popUint32_t();	//<uint32_t> 赠品搭配数量
		$this->_arr_value['type'] = $bs->popUint32_t();	//<uint32_t> 赠品/组件类型
		$this->_arr_value['status'] = $bs->popInt32_t();	//<int> 赠品状态
		$this->_arr_value['showOrder'] = $bs->popInt32_t();	//<int> 赠品的show order
		$this->_arr_value['name'] = $bs->popString();	//<std::string> 赠品名称
		$this->_arr_value['productCharId'] = $bs->popString();	//<std::string> 赠品商品char_id
		$this->_arr_value['marketPrice'] = $bs->popUint32_t();	//<uint32_t> 赠品价格
		$this->_arr_value['station'] = $bs->popUint32_t();	//<uint32_t> 赠品的station
		$this->_arr_value['weight'] = $bs->popUint32_t();	//<uint32_t> 赠品的重量
		$this->_arr_value['stockNum'] = $bs->popUint32_t();	//<uint32_t> stock_num
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['giftId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['num_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['type_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['status_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['showOrder_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['name_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productCharId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['marketPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['station_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['weight_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockNum_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\deal\ddo\attachment;	//source idl: com.icson.deal.idl.Attachment.java
if (!class_exists('icson\deal\ddo\attachment\Promotion', false)) {
class Promotion{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t>  协议版本号 (版本>=0)
	private $vecMainIdPackage;	//<std::vector<icson::deal::ddo::attachment::CPackage> >  套餐信息列表(版本>=0)
	private $vecMainIdCoupon;	//<std::vector<icson::deal::ddo::attachment::CCoupon> > 优惠券列表(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $vecMainIdPackage_u;	//<uint8_t> (版本>=0)
	private $vecMainIdCoupon_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->vecMainIdPackage = new \stl_vector2('\icson\deal\ddo\attachment\Package');	//<std::vector<icson::deal::ddo::attachment::CPackage> >
		$this->vecMainIdCoupon = new \stl_vector2('\icson\deal\ddo\attachment\Coupon');	//<std::vector<icson::deal::ddo::attachment::CCoupon> >
		$this->version_u = 0;	//<uint8_t>
		$this->vecMainIdPackage_u = 0;	//<uint8_t>
		$this->vecMainIdCoupon_u = 0;	//<uint8_t>
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
			exit("\icson\deal\ddo\attachment\Promotion\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\ddo\attachment\Promotion\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint16_t($this->version);	//<uint16_t>  协议版本号 
		$bs->pushObject($this->vecMainIdPackage,'stl_vector');	//<std::vector<icson::deal::ddo::attachment::CPackage> >  套餐信息列表
		$bs->pushObject($this->vecMainIdCoupon,'stl_vector');	//<std::vector<icson::deal::ddo::attachment::CCoupon> > 优惠券列表
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->vecMainIdPackage_u);	//<uint8_t> 
		$bs->pushUint8_t($this->vecMainIdCoupon_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t>  协议版本号 
		$this->_arr_value['vecMainIdPackage'] = $bs->popObject('stl_vector<\icson\deal\ddo\attachment\Package>');	//<std::vector<icson::deal::ddo::attachment::CPackage> >  套餐信息列表
		$this->_arr_value['vecMainIdCoupon'] = $bs->popObject('stl_vector<\icson\deal\ddo\attachment\Coupon>');	//<std::vector<icson::deal::ddo::attachment::CCoupon> > 优惠券列表
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['vecMainIdPackage_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['vecMainIdCoupon_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\deal\ddo\attachment;	//source idl: com.icson.deal.idl.Promotion.java
if (!class_exists('icson\deal\ddo\attachment\Package', false)) {
class Package{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t>  协议版本号 (版本>=0)
	private $promotionName;	//<std::string>  促销规则名称(版本>=0)
	private $ruleId;	//<uint32_t>  套餐对应的规则Id(版本>=0)
	private $vecPackageInfo;	//<std::vector<icson::deal::ddo::attachment::CPackageInfo> > 套餐商品信息列表(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $promotionName_u;	//<uint8_t> (版本>=0)
	private $ruleId_u;	//<uint8_t> (版本>=0)
	private $vecPackageInfo_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->promotionName = "";	//<std::string>
		$this->ruleId = 0;	//<uint32_t>
		$this->vecPackageInfo = new \stl_vector2('\icson\deal\ddo\attachment\PackageInfo');	//<std::vector<icson::deal::ddo::attachment::CPackageInfo> >
		$this->version_u = 0;	//<uint8_t>
		$this->promotionName_u = 0;	//<uint8_t>
		$this->ruleId_u = 0;	//<uint8_t>
		$this->vecPackageInfo_u = 0;	//<uint8_t>
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
			exit("\icson\deal\ddo\attachment\Package\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\ddo\attachment\Package\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint16_t($this->version);	//<uint16_t>  协议版本号 
		$bs->pushString($this->promotionName);	//<std::string>  促销规则名称
		$bs->pushUint32_t($this->ruleId);	//<uint32_t>  套餐对应的规则Id
		$bs->pushObject($this->vecPackageInfo,'stl_vector');	//<std::vector<icson::deal::ddo::attachment::CPackageInfo> > 套餐商品信息列表
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->promotionName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->ruleId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->vecPackageInfo_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t>  协议版本号 
		$this->_arr_value['promotionName'] = $bs->popString();	//<std::string>  促销规则名称
		$this->_arr_value['ruleId'] = $bs->popUint32_t();	//<uint32_t>  套餐对应的规则Id
		$this->_arr_value['vecPackageInfo'] = $bs->popObject('stl_vector<\icson\deal\ddo\attachment\PackageInfo>');	//<std::vector<icson::deal::ddo::attachment::CPackageInfo> > 套餐商品信息列表
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['promotionName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleId_u'] = $bs->popUint8_t();	//<uint8_t> 
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
}

namespace icson\deal\ddo\attachment;	//source idl: com.icson.deal.idl.Package.java
if (!class_exists('icson\deal\ddo\attachment\PackageInfo', false)) {
class PackageInfo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t>  协议版本号 (版本>=0)
	private $packageCashBack;	//<uint32_t> 套餐商品优惠价格(版本>=0)
	private $productId;	//<uint32_t> 商品id(版本>=0)
	private $name;	//<std::string> 商品名称(版本>=0)
	private $price;	//<int> 商品价格(版本>=0)
	private $marketPrice;	//<int> 商品市场价格(版本>=0)
	private $productCharId;	//<std::string> 商品char_id(版本>=0)
	private $whId;	//<uint32_t> 分站id(版本>=0)
	private $flag;	//<int> 标志位(版本>=0)
	private $status;	//<int> 状态(版本>=0)
	private $restrictedTransType;	//<int> 限运类型(版本>=0)
	private $promotionWord;	//<std::string> 促销语言(版本>=0)
	private $availableNum;	//<int> 可用库存(版本>=0)
	private $virtualNum;	//<int> 虚拟库存(版本>=0)
	private $psyStock;	//<uint32_t> psystock(版本>=0)
	private $arrivalDays;	//<int> arrival_days(版本>=0)
	private $cashBack;	//<int> cash back(版本>=0)
	private $costPrice;	//<int> cost_price(版本>=0)
	private $numLimit;	//<int> 限制数量(版本>=0)
	private $c3Ids;	//<std::string> 三级类目Id(版本>=0)
	private $weight;	//<uint32_t> 重量(版本>=0)
	private $picNum;	//<uint32_t> 图片数量(版本>=0)
	private $color;	//<int> 颜色(版本>=0)
	private $productSize;	//<int> 尺码(版本>=0)
	private $multiPriceType;	//<int> 多价类型(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $packageCashBack_u;	//<uint8_t> (版本>=0)
	private $productId_u;	//<uint8_t> (版本>=0)
	private $name_u;	//<uint8_t> (版本>=0)
	private $price_u;	//<uint8_t> (版本>=0)
	private $marketPrice_u;	//<uint8_t> (版本>=0)
	private $productCharId_u;	//<uint8_t> (版本>=0)
	private $whId_u;	//<uint8_t> (版本>=0)
	private $flag_u;	//<uint8_t> (版本>=0)
	private $status_u;	//<uint8_t> (版本>=0)
	private $restrictedTransType_u;	//<uint8_t> (版本>=0)
	private $promotionWord_u;	//<uint8_t> (版本>=0)
	private $availableNum_u;	//<uint8_t> (版本>=0)
	private $virtualNum_u;	//<uint8_t> (版本>=0)
	private $psyStock_u;	//<uint8_t> (版本>=0)
	private $arrivalDays_u;	//<uint8_t> (版本>=0)
	private $cashBack_u;	//<uint8_t> (版本>=0)
	private $costPrice_u;	//<uint8_t> (版本>=0)
	private $numLimit_u;	//<uint8_t> (版本>=0)
	private $c3Ids_u;	//<uint8_t> (版本>=0)
	private $weight_u;	//<uint8_t> (版本>=0)
	private $picNum_u;	//<uint8_t> (版本>=0)
	private $color_u;	//<uint8_t> (版本>=0)
	private $productSize_u;	//<uint8_t> (版本>=0)
	private $multiPriceType_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->packageCashBack = 0;	//<uint32_t>
		$this->productId = 0;	//<uint32_t>
		$this->name = "";	//<std::string>
		$this->price = 0;	//<int>
		$this->marketPrice = 0;	//<int>
		$this->productCharId = "";	//<std::string>
		$this->whId = 0;	//<uint32_t>
		$this->flag = 0;	//<int>
		$this->status = 0;	//<int>
		$this->restrictedTransType = 0;	//<int>
		$this->promotionWord = "";	//<std::string>
		$this->availableNum = 0;	//<int>
		$this->virtualNum = 0;	//<int>
		$this->psyStock = 0;	//<uint32_t>
		$this->arrivalDays = 0;	//<int>
		$this->cashBack = 0;	//<int>
		$this->costPrice = 0;	//<int>
		$this->numLimit = 0;	//<int>
		$this->c3Ids = "";	//<std::string>
		$this->weight = 0;	//<uint32_t>
		$this->picNum = 0;	//<uint32_t>
		$this->color = 0;	//<int>
		$this->productSize = 0;	//<int>
		$this->multiPriceType = 0;	//<int>
		$this->version_u = 0;	//<uint8_t>
		$this->packageCashBack_u = 0;	//<uint8_t>
		$this->productId_u = 0;	//<uint8_t>
		$this->name_u = 0;	//<uint8_t>
		$this->price_u = 0;	//<uint8_t>
		$this->marketPrice_u = 0;	//<uint8_t>
		$this->productCharId_u = 0;	//<uint8_t>
		$this->whId_u = 0;	//<uint8_t>
		$this->flag_u = 0;	//<uint8_t>
		$this->status_u = 0;	//<uint8_t>
		$this->restrictedTransType_u = 0;	//<uint8_t>
		$this->promotionWord_u = 0;	//<uint8_t>
		$this->availableNum_u = 0;	//<uint8_t>
		$this->virtualNum_u = 0;	//<uint8_t>
		$this->psyStock_u = 0;	//<uint8_t>
		$this->arrivalDays_u = 0;	//<uint8_t>
		$this->cashBack_u = 0;	//<uint8_t>
		$this->costPrice_u = 0;	//<uint8_t>
		$this->numLimit_u = 0;	//<uint8_t>
		$this->c3Ids_u = 0;	//<uint8_t>
		$this->weight_u = 0;	//<uint8_t>
		$this->picNum_u = 0;	//<uint8_t>
		$this->color_u = 0;	//<uint8_t>
		$this->productSize_u = 0;	//<uint8_t>
		$this->multiPriceType_u = 0;	//<uint8_t>
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
			exit("\icson\deal\ddo\attachment\PackageInfo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\ddo\attachment\PackageInfo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint16_t($this->version);	//<uint16_t>  协议版本号 
		$bs->pushUint32_t($this->packageCashBack);	//<uint32_t> 套餐商品优惠价格
		$bs->pushUint32_t($this->productId);	//<uint32_t> 商品id
		$bs->pushString($this->name);	//<std::string> 商品名称
		$bs->pushInt32_t($this->price);	//<int> 商品价格
		$bs->pushInt32_t($this->marketPrice);	//<int> 商品市场价格
		$bs->pushString($this->productCharId);	//<std::string> 商品char_id
		$bs->pushUint32_t($this->whId);	//<uint32_t> 分站id
		$bs->pushInt32_t($this->flag);	//<int> 标志位
		$bs->pushInt32_t($this->status);	//<int> 状态
		$bs->pushInt32_t($this->restrictedTransType);	//<int> 限运类型
		$bs->pushString($this->promotionWord);	//<std::string> 促销语言
		$bs->pushInt32_t($this->availableNum);	//<int> 可用库存
		$bs->pushInt32_t($this->virtualNum);	//<int> 虚拟库存
		$bs->pushUint32_t($this->psyStock);	//<uint32_t> psystock
		$bs->pushInt32_t($this->arrivalDays);	//<int> arrival_days
		$bs->pushInt32_t($this->cashBack);	//<int> cash back
		$bs->pushInt32_t($this->costPrice);	//<int> cost_price
		$bs->pushInt32_t($this->numLimit);	//<int> 限制数量
		$bs->pushString($this->c3Ids);	//<std::string> 三级类目Id
		$bs->pushUint32_t($this->weight);	//<uint32_t> 重量
		$bs->pushUint32_t($this->picNum);	//<uint32_t> 图片数量
		$bs->pushInt32_t($this->color);	//<int> 颜色
		$bs->pushInt32_t($this->productSize);	//<int> 尺码
		$bs->pushInt32_t($this->multiPriceType);	//<int> 多价类型
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->packageCashBack_u);	//<uint8_t> 
		$bs->pushUint8_t($this->productId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->name_u);	//<uint8_t> 
		$bs->pushUint8_t($this->price_u);	//<uint8_t> 
		$bs->pushUint8_t($this->marketPrice_u);	//<uint8_t> 
		$bs->pushUint8_t($this->productCharId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->whId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->flag_u);	//<uint8_t> 
		$bs->pushUint8_t($this->status_u);	//<uint8_t> 
		$bs->pushUint8_t($this->restrictedTransType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->promotionWord_u);	//<uint8_t> 
		$bs->pushUint8_t($this->availableNum_u);	//<uint8_t> 
		$bs->pushUint8_t($this->virtualNum_u);	//<uint8_t> 
		$bs->pushUint8_t($this->psyStock_u);	//<uint8_t> 
		$bs->pushUint8_t($this->arrivalDays_u);	//<uint8_t> 
		$bs->pushUint8_t($this->cashBack_u);	//<uint8_t> 
		$bs->pushUint8_t($this->costPrice_u);	//<uint8_t> 
		$bs->pushUint8_t($this->numLimit_u);	//<uint8_t> 
		$bs->pushUint8_t($this->c3Ids_u);	//<uint8_t> 
		$bs->pushUint8_t($this->weight_u);	//<uint8_t> 
		$bs->pushUint8_t($this->picNum_u);	//<uint8_t> 
		$bs->pushUint8_t($this->color_u);	//<uint8_t> 
		$bs->pushUint8_t($this->productSize_u);	//<uint8_t> 
		$bs->pushUint8_t($this->multiPriceType_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t>  协议版本号 
		$this->_arr_value['packageCashBack'] = $bs->popUint32_t();	//<uint32_t> 套餐商品优惠价格
		$this->_arr_value['productId'] = $bs->popUint32_t();	//<uint32_t> 商品id
		$this->_arr_value['name'] = $bs->popString();	//<std::string> 商品名称
		$this->_arr_value['price'] = $bs->popInt32_t();	//<int> 商品价格
		$this->_arr_value['marketPrice'] = $bs->popInt32_t();	//<int> 商品市场价格
		$this->_arr_value['productCharId'] = $bs->popString();	//<std::string> 商品char_id
		$this->_arr_value['whId'] = $bs->popUint32_t();	//<uint32_t> 分站id
		$this->_arr_value['flag'] = $bs->popInt32_t();	//<int> 标志位
		$this->_arr_value['status'] = $bs->popInt32_t();	//<int> 状态
		$this->_arr_value['restrictedTransType'] = $bs->popInt32_t();	//<int> 限运类型
		$this->_arr_value['promotionWord'] = $bs->popString();	//<std::string> 促销语言
		$this->_arr_value['availableNum'] = $bs->popInt32_t();	//<int> 可用库存
		$this->_arr_value['virtualNum'] = $bs->popInt32_t();	//<int> 虚拟库存
		$this->_arr_value['psyStock'] = $bs->popUint32_t();	//<uint32_t> psystock
		$this->_arr_value['arrivalDays'] = $bs->popInt32_t();	//<int> arrival_days
		$this->_arr_value['cashBack'] = $bs->popInt32_t();	//<int> cash back
		$this->_arr_value['costPrice'] = $bs->popInt32_t();	//<int> cost_price
		$this->_arr_value['numLimit'] = $bs->popInt32_t();	//<int> 限制数量
		$this->_arr_value['c3Ids'] = $bs->popString();	//<std::string> 三级类目Id
		$this->_arr_value['weight'] = $bs->popUint32_t();	//<uint32_t> 重量
		$this->_arr_value['picNum'] = $bs->popUint32_t();	//<uint32_t> 图片数量
		$this->_arr_value['color'] = $bs->popInt32_t();	//<int> 颜色
		$this->_arr_value['productSize'] = $bs->popInt32_t();	//<int> 尺码
		$this->_arr_value['multiPriceType'] = $bs->popInt32_t();	//<int> 多价类型
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['packageCashBack_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['name_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['price_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['marketPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productCharId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['whId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['flag_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['status_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['restrictedTransType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['promotionWord_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['availableNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['virtualNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['psyStock_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['arrivalDays_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cashBack_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['costPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['numLimit_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['c3Ids_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['weight_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['picNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['color_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productSize_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['multiPriceType_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\deal\ddo\attachment;	//source idl: com.icson.deal.idl.Promotion.java
if (!class_exists('icson\deal\ddo\attachment\Coupon', false)) {
class Coupon{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t>  协议版本号 (版本>=0)
	private $ruleId;	//<uint32_t>  对应的单品促销规则Id (版本>=0)
	private $promotionName;	//<std::string> 单品促销名称(版本>=0)
	private $vecCouponInfo;	//<std::vector<icson::deal::ddo::attachment::CCouponInfo> > 优惠券信息列表(版本>=0)
	private $vecPidList;	//<std::vector<uint32_t> > pidList(版本>=0)
	private $beginTime;	//<uint32_t> 单品促销有效开始时间(版本>=0)
	private $endTime;	//<uint32_t> 单品促销有效的结束时间(版本>=0)
	private $accountType;	//<uint32_t> account_type(版本>=0)
	private $whId;	//<uint32_t> wh_id(版本>=0)
	private $joinLimit;	//<uint32_t> join_limit(版本>=0)
	private $url;	//<std::string> url(版本>=0)
	private $comment;	//<std::string> comment(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $ruleId_u;	//<uint8_t> (版本>=0)
	private $promotionName_u;	//<uint8_t> (版本>=0)
	private $vecCouponInfo_u;	//<uint8_t> (版本>=0)
	private $vecPidList_u;	//<uint8_t> (版本>=0)
	private $beginTime_u;	//<uint8_t> (版本>=0)
	private $endTime_u;	//<uint8_t> (版本>=0)
	private $accountType_u;	//<uint8_t> (版本>=0)
	private $whId_u;	//<uint8_t> (版本>=0)
	private $joinLimit_u;	//<uint8_t> (版本>=0)
	private $url_u;	//<uint8_t> (版本>=0)
	private $comment_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->ruleId = 0;	//<uint32_t>
		$this->promotionName = "";	//<std::string>
		$this->vecCouponInfo = new \stl_vector2('\icson\deal\ddo\attachment\CouponInfo');	//<std::vector<icson::deal::ddo::attachment::CCouponInfo> >
		$this->vecPidList = new \stl_vector2('uint32_t');	//<std::vector<uint32_t> >
		$this->beginTime = 0;	//<uint32_t>
		$this->endTime = 0;	//<uint32_t>
		$this->accountType = 0;	//<uint32_t>
		$this->whId = 0;	//<uint32_t>
		$this->joinLimit = 0;	//<uint32_t>
		$this->url = "";	//<std::string>
		$this->comment = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->ruleId_u = 0;	//<uint8_t>
		$this->promotionName_u = 0;	//<uint8_t>
		$this->vecCouponInfo_u = 0;	//<uint8_t>
		$this->vecPidList_u = 0;	//<uint8_t>
		$this->beginTime_u = 0;	//<uint8_t>
		$this->endTime_u = 0;	//<uint8_t>
		$this->accountType_u = 0;	//<uint8_t>
		$this->whId_u = 0;	//<uint8_t>
		$this->joinLimit_u = 0;	//<uint8_t>
		$this->url_u = 0;	//<uint8_t>
		$this->comment_u = 0;	//<uint8_t>
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
			exit("\icson\deal\ddo\attachment\Coupon\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\ddo\attachment\Coupon\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint16_t($this->version);	//<uint16_t>  协议版本号 
		$bs->pushUint32_t($this->ruleId);	//<uint32_t>  对应的单品促销规则Id 
		$bs->pushString($this->promotionName);	//<std::string> 单品促销名称
		$bs->pushObject($this->vecCouponInfo,'stl_vector');	//<std::vector<icson::deal::ddo::attachment::CCouponInfo> > 优惠券信息列表
		$bs->pushObject($this->vecPidList,'stl_vector');	//<std::vector<uint32_t> > pidList
		$bs->pushUint32_t($this->beginTime);	//<uint32_t> 单品促销有效开始时间
		$bs->pushUint32_t($this->endTime);	//<uint32_t> 单品促销有效的结束时间
		$bs->pushUint32_t($this->accountType);	//<uint32_t> account_type
		$bs->pushUint32_t($this->whId);	//<uint32_t> wh_id
		$bs->pushUint32_t($this->joinLimit);	//<uint32_t> join_limit
		$bs->pushString($this->url);	//<std::string> url
		$bs->pushString($this->comment);	//<std::string> comment
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->ruleId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->promotionName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->vecCouponInfo_u);	//<uint8_t> 
		$bs->pushUint8_t($this->vecPidList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->beginTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->endTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->accountType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->whId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->joinLimit_u);	//<uint8_t> 
		$bs->pushUint8_t($this->url_u);	//<uint8_t> 
		$bs->pushUint8_t($this->comment_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t>  协议版本号 
		$this->_arr_value['ruleId'] = $bs->popUint32_t();	//<uint32_t>  对应的单品促销规则Id 
		$this->_arr_value['promotionName'] = $bs->popString();	//<std::string> 单品促销名称
		$this->_arr_value['vecCouponInfo'] = $bs->popObject('stl_vector<\icson\deal\ddo\attachment\CouponInfo>');	//<std::vector<icson::deal::ddo::attachment::CCouponInfo> > 优惠券信息列表
		$this->_arr_value['vecPidList'] = $bs->popObject('stl_vector<uint32_t>');	//<std::vector<uint32_t> > pidList
		$this->_arr_value['beginTime'] = $bs->popUint32_t();	//<uint32_t> 单品促销有效开始时间
		$this->_arr_value['endTime'] = $bs->popUint32_t();	//<uint32_t> 单品促销有效的结束时间
		$this->_arr_value['accountType'] = $bs->popUint32_t();	//<uint32_t> account_type
		$this->_arr_value['whId'] = $bs->popUint32_t();	//<uint32_t> wh_id
		$this->_arr_value['joinLimit'] = $bs->popUint32_t();	//<uint32_t> join_limit
		$this->_arr_value['url'] = $bs->popString();	//<std::string> url
		$this->_arr_value['comment'] = $bs->popString();	//<std::string> comment
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['promotionName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['vecCouponInfo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['vecPidList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['beginTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['endTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['accountType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['whId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['joinLimit_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['url_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['comment_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\deal\ddo\attachment;	//source idl: com.icson.deal.idl.Coupon.java
if (!class_exists('icson\deal\ddo\attachment\CouponInfo', false)) {
class CouponInfo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t>  协议版本号 (版本>=0)
	private $batch;	//<uint32_t>  优惠券id (版本>=0)
	private $status;	//<int> 优惠券状态(版本>=0)
	private $name;	//<std::string> 优惠券名称(版本>=0)
	private $amt;	//<int> 优惠券amt(版本>=0)
	private $validTimeFrom;	//<uint32_t> valid_time_from(版本>=0)
	private $validTimeTo;	//<uint32_t> valid_time_to(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $batch_u;	//<uint8_t> (版本>=0)
	private $status_u;	//<uint8_t> (版本>=0)
	private $name_u;	//<uint8_t> (版本>=0)
	private $amt_u;	//<uint8_t> (版本>=0)
	private $validTimeFrom_u;	//<uint8_t> (版本>=0)
	private $validTimeTo_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->batch = 0;	//<uint32_t>
		$this->status = 0;	//<int>
		$this->name = "";	//<std::string>
		$this->amt = 0;	//<int>
		$this->validTimeFrom = 0;	//<uint32_t>
		$this->validTimeTo = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->batch_u = 0;	//<uint8_t>
		$this->status_u = 0;	//<uint8_t>
		$this->name_u = 0;	//<uint8_t>
		$this->amt_u = 0;	//<uint8_t>
		$this->validTimeFrom_u = 0;	//<uint8_t>
		$this->validTimeTo_u = 0;	//<uint8_t>
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
			exit("\icson\deal\ddo\attachment\CouponInfo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\ddo\attachment\CouponInfo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint16_t($this->version);	//<uint16_t>  协议版本号 
		$bs->pushUint32_t($this->batch);	//<uint32_t>  优惠券id 
		$bs->pushInt32_t($this->status);	//<int> 优惠券状态
		$bs->pushString($this->name);	//<std::string> 优惠券名称
		$bs->pushInt32_t($this->amt);	//<int> 优惠券amt
		$bs->pushUint32_t($this->validTimeFrom);	//<uint32_t> valid_time_from
		$bs->pushUint32_t($this->validTimeTo);	//<uint32_t> valid_time_to
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->batch_u);	//<uint8_t> 
		$bs->pushUint8_t($this->status_u);	//<uint8_t> 
		$bs->pushUint8_t($this->name_u);	//<uint8_t> 
		$bs->pushUint8_t($this->amt_u);	//<uint8_t> 
		$bs->pushUint8_t($this->validTimeFrom_u);	//<uint8_t> 
		$bs->pushUint8_t($this->validTimeTo_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t>  协议版本号 
		$this->_arr_value['batch'] = $bs->popUint32_t();	//<uint32_t>  优惠券id 
		$this->_arr_value['status'] = $bs->popInt32_t();	//<int> 优惠券状态
		$this->_arr_value['name'] = $bs->popString();	//<std::string> 优惠券名称
		$this->_arr_value['amt'] = $bs->popInt32_t();	//<int> 优惠券amt
		$this->_arr_value['validTimeFrom'] = $bs->popUint32_t();	//<uint32_t> valid_time_from
		$this->_arr_value['validTimeTo'] = $bs->popUint32_t();	//<uint32_t> valid_time_to
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['batch_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['status_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['name_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['amt_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['validTimeFrom_u'] = $bs->popUint8_t();	//<uint8_t> 
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
}

namespace icson\deal\ddo\attachment;	//source idl: com.icson.deal.idl.Attachment.java
if (!class_exists('icson\deal\ddo\attachment\Relativity', false)) {
class Relativity{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t>  协议版本号 (版本>=0)
	private $relativityId;	//<uint32_t> 随心配搭配商品Id(版本>=0)
	private $price;	//<int> 随心配商品价格(版本>=0)
	private $marketPrice;	//<int> 随心配商品市场价格(版本>=0)
	private $name;	//<std::string> 随心配商品名称(版本>=0)
	private $productCharId;	//<std::string> 随心配商品char_id(版本>=0)
	private $sortNum;	//<int> 排序依据(版本>=0)
	private $type;	//<int> 类型(版本>=0)
	private $property;	//<std::string> property(版本>=0)
	private $updatetime;	//<uint32_t> updatetime(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $relativityId_u;	//<uint8_t> (版本>=0)
	private $price_u;	//<uint8_t> (版本>=0)
	private $marketPrice_u;	//<uint8_t> (版本>=0)
	private $name_u;	//<uint8_t> (版本>=0)
	private $productCharId_u;	//<uint8_t> (版本>=0)
	private $sortNum_u;	//<uint8_t> (版本>=0)
	private $type_u;	//<uint8_t> (版本>=0)
	private $property_u;	//<uint8_t> (版本>=0)
	private $updatetime_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->relativityId = 0;	//<uint32_t>
		$this->price = 0;	//<int>
		$this->marketPrice = 0;	//<int>
		$this->name = "";	//<std::string>
		$this->productCharId = "";	//<std::string>
		$this->sortNum = 0;	//<int>
		$this->type = 0;	//<int>
		$this->property = "";	//<std::string>
		$this->updatetime = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->relativityId_u = 0;	//<uint8_t>
		$this->price_u = 0;	//<uint8_t>
		$this->marketPrice_u = 0;	//<uint8_t>
		$this->name_u = 0;	//<uint8_t>
		$this->productCharId_u = 0;	//<uint8_t>
		$this->sortNum_u = 0;	//<uint8_t>
		$this->type_u = 0;	//<uint8_t>
		$this->property_u = 0;	//<uint8_t>
		$this->updatetime_u = 0;	//<uint8_t>
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
			exit("\icson\deal\ddo\attachment\Relativity\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\ddo\attachment\Relativity\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint16_t($this->version);	//<uint16_t>  协议版本号 
		$bs->pushUint32_t($this->relativityId);	//<uint32_t> 随心配搭配商品Id
		$bs->pushInt32_t($this->price);	//<int> 随心配商品价格
		$bs->pushInt32_t($this->marketPrice);	//<int> 随心配商品市场价格
		$bs->pushString($this->name);	//<std::string> 随心配商品名称
		$bs->pushString($this->productCharId);	//<std::string> 随心配商品char_id
		$bs->pushInt32_t($this->sortNum);	//<int> 排序依据
		$bs->pushInt32_t($this->type);	//<int> 类型
		$bs->pushString($this->property);	//<std::string> property
		$bs->pushUint32_t($this->updatetime);	//<uint32_t> updatetime
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->relativityId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->price_u);	//<uint8_t> 
		$bs->pushUint8_t($this->marketPrice_u);	//<uint8_t> 
		$bs->pushUint8_t($this->name_u);	//<uint8_t> 
		$bs->pushUint8_t($this->productCharId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sortNum_u);	//<uint8_t> 
		$bs->pushUint8_t($this->type_u);	//<uint8_t> 
		$bs->pushUint8_t($this->property_u);	//<uint8_t> 
		$bs->pushUint8_t($this->updatetime_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t>  协议版本号 
		$this->_arr_value['relativityId'] = $bs->popUint32_t();	//<uint32_t> 随心配搭配商品Id
		$this->_arr_value['price'] = $bs->popInt32_t();	//<int> 随心配商品价格
		$this->_arr_value['marketPrice'] = $bs->popInt32_t();	//<int> 随心配商品市场价格
		$this->_arr_value['name'] = $bs->popString();	//<std::string> 随心配商品名称
		$this->_arr_value['productCharId'] = $bs->popString();	//<std::string> 随心配商品char_id
		$this->_arr_value['sortNum'] = $bs->popInt32_t();	//<int> 排序依据
		$this->_arr_value['type'] = $bs->popInt32_t();	//<int> 类型
		$this->_arr_value['property'] = $bs->popString();	//<std::string> property
		$this->_arr_value['updatetime'] = $bs->popUint32_t();	//<uint32_t> updatetime
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['relativityId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['price_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['marketPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['name_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productCharId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sortNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['type_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['property_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['updatetime_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\deal\ddo\attachment;	//source idl: com.icson.deal.idl.AttachmentAo.java
if (!class_exists('icson\deal\ddo\attachment\Appointment', false)) {
class Appointment{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t>  协议版本号 (版本>=0)
	private $id;	//<uint32_t>  活动规则id (版本>=0)
	private $name;	//<std::string>  活动规则名称 (版本>=0)
	private $pid_list;	//<std::vector<std::string> >  商品信息的二进制字符串数组(版本>=0)
	private $type;	//<uint8_t>  类型(版本>=0)
	private $wh_id;	//<uint32_t>  分站id(版本>=0)
	private $join_limit;	//<uint32_t>  join_limit(版本>=0)
	private $user_include;	//<std::string>  user_include(版本>=0)
	private $accounting_type;	//<uint8_t>  accounting_type(版本>=0)
	private $status;	//<int>  status(版本>=0)
	private $url;	//<std::string>  url(版本>=0)
	private $order_time_from;	//<uint32_t>  order_time_from(版本>=0)
	private $order_time_to;	//<uint32_t>  order_time_to(版本>=0)
	private $buy_time_from;	//<uint32_t>  buy_time_from(版本>=0)
	private $buy_time_to;	//<uint32_t>  buy_time_to(版本>=0)
	private $eventid;	//<uint32_t>  eventid(版本>=0)
	private $event_url;	//<std::string>  event_url(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $id_u;	//<uint8_t> (版本>=0)
	private $name_u;	//<uint8_t> (版本>=0)
	private $pid_list_u;	//<uint8_t> (版本>=0)
	private $type_u;	//<uint8_t> (版本>=0)
	private $wh_id_u;	//<uint8_t> (版本>=0)
	private $join_limit_u;	//<uint8_t> (版本>=0)
	private $user_include_u;	//<uint8_t> (版本>=0)
	private $accounting_type_u;	//<uint8_t> (版本>=0)
	private $status_u;	//<uint8_t> (版本>=0)
	private $url_u;	//<uint8_t> (版本>=0)
	private $order_time_from_u;	//<uint8_t> (版本>=0)
	private $order_time_to_u;	//<uint8_t> (版本>=0)
	private $buy_time_from_u;	//<uint8_t> (版本>=0)
	private $buy_time_to_u;	//<uint8_t> (版本>=0)
	private $eventid_u;	//<uint8_t> (版本>=0)
	private $event_url_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->id = 0;	//<uint32_t>
		$this->name = "";	//<std::string>
		$this->pid_list = new \stl_vector2('stl_string');	//<std::vector<std::string> >
		$this->type = 0;	//<uint8_t>
		$this->wh_id = 0;	//<uint32_t>
		$this->join_limit = 0;	//<uint32_t>
		$this->user_include = "";	//<std::string>
		$this->accounting_type = 0;	//<uint8_t>
		$this->status = 0;	//<int>
		$this->url = "";	//<std::string>
		$this->order_time_from = 0;	//<uint32_t>
		$this->order_time_to = 0;	//<uint32_t>
		$this->buy_time_from = 0;	//<uint32_t>
		$this->buy_time_to = 0;	//<uint32_t>
		$this->eventid = 0;	//<uint32_t>
		$this->event_url = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->id_u = 0;	//<uint8_t>
		$this->name_u = 0;	//<uint8_t>
		$this->pid_list_u = 0;	//<uint8_t>
		$this->type_u = 0;	//<uint8_t>
		$this->wh_id_u = 0;	//<uint8_t>
		$this->join_limit_u = 0;	//<uint8_t>
		$this->user_include_u = 0;	//<uint8_t>
		$this->accounting_type_u = 0;	//<uint8_t>
		$this->status_u = 0;	//<uint8_t>
		$this->url_u = 0;	//<uint8_t>
		$this->order_time_from_u = 0;	//<uint8_t>
		$this->order_time_to_u = 0;	//<uint8_t>
		$this->buy_time_from_u = 0;	//<uint8_t>
		$this->buy_time_to_u = 0;	//<uint8_t>
		$this->eventid_u = 0;	//<uint8_t>
		$this->event_url_u = 0;	//<uint8_t>
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
			exit("\icson\deal\ddo\attachment\Appointment\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\ddo\attachment\Appointment\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint16_t($this->version);	//<uint16_t>  协议版本号 
		$bs->pushUint32_t($this->id);	//<uint32_t>  活动规则id 
		$bs->pushString($this->name);	//<std::string>  活动规则名称 
		$bs->pushObject($this->pid_list,'stl_vector');	//<std::vector<std::string> >  商品信息的二进制字符串数组
		$bs->pushUint8_t($this->type);	//<uint8_t>  类型
		$bs->pushUint32_t($this->wh_id);	//<uint32_t>  分站id
		$bs->pushUint32_t($this->join_limit);	//<uint32_t>  join_limit
		$bs->pushString($this->user_include);	//<std::string>  user_include
		$bs->pushUint8_t($this->accounting_type);	//<uint8_t>  accounting_type
		$bs->pushInt32_t($this->status);	//<int>  status
		$bs->pushString($this->url);	//<std::string>  url
		$bs->pushUint32_t($this->order_time_from);	//<uint32_t>  order_time_from
		$bs->pushUint32_t($this->order_time_to);	//<uint32_t>  order_time_to
		$bs->pushUint32_t($this->buy_time_from);	//<uint32_t>  buy_time_from
		$bs->pushUint32_t($this->buy_time_to);	//<uint32_t>  buy_time_to
		$bs->pushUint32_t($this->eventid);	//<uint32_t>  eventid
		$bs->pushString($this->event_url);	//<std::string>  event_url
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->id_u);	//<uint8_t> 
		$bs->pushUint8_t($this->name_u);	//<uint8_t> 
		$bs->pushUint8_t($this->pid_list_u);	//<uint8_t> 
		$bs->pushUint8_t($this->type_u);	//<uint8_t> 
		$bs->pushUint8_t($this->wh_id_u);	//<uint8_t> 
		$bs->pushUint8_t($this->join_limit_u);	//<uint8_t> 
		$bs->pushUint8_t($this->user_include_u);	//<uint8_t> 
		$bs->pushUint8_t($this->accounting_type_u);	//<uint8_t> 
		$bs->pushUint8_t($this->status_u);	//<uint8_t> 
		$bs->pushUint8_t($this->url_u);	//<uint8_t> 
		$bs->pushUint8_t($this->order_time_from_u);	//<uint8_t> 
		$bs->pushUint8_t($this->order_time_to_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buy_time_from_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buy_time_to_u);	//<uint8_t> 
		$bs->pushUint8_t($this->eventid_u);	//<uint8_t> 
		$bs->pushUint8_t($this->event_url_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t>  协议版本号 
		$this->_arr_value['id'] = $bs->popUint32_t();	//<uint32_t>  活动规则id 
		$this->_arr_value['name'] = $bs->popString();	//<std::string>  活动规则名称 
		$this->_arr_value['pid_list'] = $bs->popObject('stl_vector<stl_string>');	//<std::vector<std::string> >  商品信息的二进制字符串数组
		$this->_arr_value['type'] = $bs->popUint8_t();	//<uint8_t>  类型
		$this->_arr_value['wh_id'] = $bs->popUint32_t();	//<uint32_t>  分站id
		$this->_arr_value['join_limit'] = $bs->popUint32_t();	//<uint32_t>  join_limit
		$this->_arr_value['user_include'] = $bs->popString();	//<std::string>  user_include
		$this->_arr_value['accounting_type'] = $bs->popUint8_t();	//<uint8_t>  accounting_type
		$this->_arr_value['status'] = $bs->popInt32_t();	//<int>  status
		$this->_arr_value['url'] = $bs->popString();	//<std::string>  url
		$this->_arr_value['order_time_from'] = $bs->popUint32_t();	//<uint32_t>  order_time_from
		$this->_arr_value['order_time_to'] = $bs->popUint32_t();	//<uint32_t>  order_time_to
		$this->_arr_value['buy_time_from'] = $bs->popUint32_t();	//<uint32_t>  buy_time_from
		$this->_arr_value['buy_time_to'] = $bs->popUint32_t();	//<uint32_t>  buy_time_to
		$this->_arr_value['eventid'] = $bs->popUint32_t();	//<uint32_t>  eventid
		$this->_arr_value['event_url'] = $bs->popString();	//<std::string>  event_url
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['id_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['name_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['pid_list_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['type_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['wh_id_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['join_limit_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['user_include_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['accounting_type_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['status_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['url_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['order_time_from_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['order_time_to_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buy_time_from_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buy_time_to_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['eventid_u'] = $bs->popUint8_t();	//<uint8_t> 
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
}
