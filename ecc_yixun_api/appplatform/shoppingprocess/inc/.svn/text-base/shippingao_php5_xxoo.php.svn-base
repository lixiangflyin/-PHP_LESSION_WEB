<?php
namespace icson\deal\bo;	//source idl: com.icson.deal.idl.ShippingAo.java
if (!class_exists('icson\deal\bo\ShippingSmallParam', false)) {
class ShippingSmallParam{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 协议版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $productId;	//<uint32_t> 商品ID(版本>=0)
	private $productId_u;	//<uint8_t> (版本>=0)
	private $sellerId;	//<uint32_t> 商户ID（区分新联营）(版本>=0)
	private $sellerId_u;	//<uint8_t> (版本>=0)
	private $bookingType;	//<uint32_t> 商品预购类型(版本>=0)
	private $bookingType_u;	//<uint8_t> (版本>=0)
	private $bookingValue;	//<uint32_t> 商品预购值(版本>=0)
	private $bookingValue_u;	//<uint8_t> (版本>=0)
	private $restrictedTransType;	//<uint32_t> 商品限运类型(版本>=0)
	private $restrictedTransType_u;	//<uint8_t> (版本>=0)
	private $buyCount;	//<uint32_t> 购买数量(版本>=0)
	private $buyCount_u;	//<uint8_t> (版本>=0)
	private $inventoryInfo;	//<icson::deal::bo::CInventoryInfo> 需查询配送的商品库存信息(版本>=0)
	private $inventoryInfo_u;	//<uint8_t> (版本>=0)
	private $flag;	//<uint32_t> flag(版本>=1)
	private $flag_u;	//<uint8_t> (版本>=1)
	private $type;	//<uint32_t> type(版本>=1)
	private $type_u;	//<uint8_t> (版本>=1)

	function __construct(){
		$this->version = 1;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->productId = 0;	//<uint32_t>
		$this->productId_u = 0;	//<uint8_t>
		$this->sellerId = 0;	//<uint32_t>
		$this->sellerId_u = 0;	//<uint8_t>
		$this->bookingType = 0;	//<uint32_t>
		$this->bookingType_u = 0;	//<uint8_t>
		$this->bookingValue = 0;	//<uint32_t>
		$this->bookingValue_u = 0;	//<uint8_t>
		$this->restrictedTransType = 0;	//<uint32_t>
		$this->restrictedTransType_u = 0;	//<uint8_t>
		$this->buyCount = 0;	//<uint32_t>
		$this->buyCount_u = 0;	//<uint8_t>
		$this->inventoryInfo = new \icson\deal\bo\InventoryInfo();	//<icson::deal::bo::CInventoryInfo>
		$this->inventoryInfo_u = 0;	//<uint8_t>
		$this->flag = 0;	//<uint32_t>
		$this->flag_u = 0;	//<uint8_t>
		$this->type = 0;	//<uint32_t>
		$this->type_u = 0;	//<uint8_t>
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
			exit("\icson\deal\bo\ShippingSmallParam\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\bo\ShippingSmallParam\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 协议版本号
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->productId);	//<uint32_t> 商品ID
		$bs->pushUint8_t($this->productId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->sellerId);	//<uint32_t> 商户ID（区分新联营）
		$bs->pushUint8_t($this->sellerId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->bookingType);	//<uint32_t> 商品预购类型
		$bs->pushUint8_t($this->bookingType_u);	//<uint8_t> 
		$bs->pushUint32_t($this->bookingValue);	//<uint32_t> 商品预购值
		$bs->pushUint8_t($this->bookingValue_u);	//<uint8_t> 
		$bs->pushUint32_t($this->restrictedTransType);	//<uint32_t> 商品限运类型
		$bs->pushUint8_t($this->restrictedTransType_u);	//<uint8_t> 
		$bs->pushUint32_t($this->buyCount);	//<uint32_t> 购买数量
		$bs->pushUint8_t($this->buyCount_u);	//<uint8_t> 
		$bs->pushObject($this->inventoryInfo,'\icson\deal\bo\InventoryInfo');	//<icson::deal::bo::CInventoryInfo> 需查询配送的商品库存信息
		$bs->pushUint8_t($this->inventoryInfo_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushUint32_t($this->flag);	//<uint32_t> flag
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->flag_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint32_t($this->type);	//<uint32_t> type
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->type_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 协议版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productId'] = $bs->popUint32_t();	//<uint32_t> 商品ID
		$this->_arr_value['productId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerId'] = $bs->popUint32_t();	//<uint32_t> 商户ID（区分新联营）
		$this->_arr_value['sellerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bookingType'] = $bs->popUint32_t();	//<uint32_t> 商品预购类型
		$this->_arr_value['bookingType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bookingValue'] = $bs->popUint32_t();	//<uint32_t> 商品预购值
		$this->_arr_value['bookingValue_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['restrictedTransType'] = $bs->popUint32_t();	//<uint32_t> 商品限运类型
		$this->_arr_value['restrictedTransType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyCount'] = $bs->popUint32_t();	//<uint32_t> 购买数量
		$this->_arr_value['buyCount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['inventoryInfo'] = $bs->popObject('\icson\deal\bo\InventoryInfo');	//<icson::deal::bo::CInventoryInfo> 需查询配送的商品库存信息
		$this->_arr_value['inventoryInfo_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['flag'] = $bs->popUint32_t();	//<uint32_t> flag
		}
		if($this->version >= 1){
			$this->_arr_value['flag_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['type'] = $bs->popUint32_t();	//<uint32_t> type
		}
		if($this->version >= 1){
			$this->_arr_value['type_u'] = $bs->popUint8_t();	//<uint8_t> 
		}

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

namespace icson\deal\bo;	//source idl: com.icson.deal.idl.ShippingAo.java
if (!class_exists('icson\deal\bo\ShippingParam', false)) {
class ShippingParam{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 协议版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $productId;	//<uint32_t> 商品ID(版本>=0)
	private $productId_u;	//<uint8_t> (版本>=0)
	private $bookingType;	//<uint32_t> 商品预购类型(版本>=0)
	private $bookingType_u;	//<uint8_t> (版本>=0)
	private $bookingValue;	//<uint32_t> 商品预购值(版本>=0)
	private $bookingValue_u;	//<uint8_t> (版本>=0)
	private $restrictedTransType;	//<uint32_t> 商品限运类型(版本>=0)
	private $restrictedTransType_u;	//<uint8_t> (版本>=0)
	private $inventoryInfo;	//<icson::deal::bo::CInventoryInfo> 需查询配送的商品库存信息(版本>=0)
	private $inventoryInfo_u;	//<uint8_t> (版本>=0)
	private $sellerId;	//<uint32_t> 商户ID（区分新联营）(版本>=0)
	private $sellerId_u;	//<uint8_t> (版本>=0)
	private $sellerStockId;	//<uint32_t> 商户地址(仓)ID，新联营特性(版本>=0)
	private $sellerStockId_u;	//<uint8_t> (版本>=0)
	private $flag;	//<uint32_t> 商品flag(版本>=0)
	private $flag_u;	//<uint8_t> (版本>=0)
	private $price;	//<uint32_t> 商品价格，取促销处理后total_price_after(版本>=0)
	private $price_u;	//<uint8_t> (版本>=0)
	private $weight;	//<uint32_t> 商品重量(版本>=0)
	private $weight_u;	//<uint8_t> (版本>=0)
	private $buyCount;	//<uint32_t> 购买数量(版本>=0)
	private $buyCount_u;	//<uint8_t> (版本>=0)
	private $cashBack;	//<uint32_t> 返现(版本>=0)
	private $cashBack_u;	//<uint8_t> (版本>=0)
	private $c3Ids;	//<uint32_t> c3_ids，三级类目ID(版本>=0)
	private $c3Ids_u;	//<uint8_t> (版本>=0)
	private $giftList;	//<std::vector<icson::deal::bo::CGiftInfo4Shipping> > 赠品信息(版本>=0)
	private $giftList_u;	//<uint8_t> (版本>=0)
	private $type;	//<uint32_t> type(版本>=1)
	private $type_u;	//<uint8_t> (版本>=1)
	private $sizeInfo;	//<oms::ordersize::po::CProductUnitPo> 商品长宽高重信息(版本>=1)
	private $sizeInfo_u;	//<uint8_t> (版本>=1)

	function __construct(){
		$this->version = 1;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->productId = 0;	//<uint32_t>
		$this->productId_u = 0;	//<uint8_t>
		$this->bookingType = 0;	//<uint32_t>
		$this->bookingType_u = 0;	//<uint8_t>
		$this->bookingValue = 0;	//<uint32_t>
		$this->bookingValue_u = 0;	//<uint8_t>
		$this->restrictedTransType = 0;	//<uint32_t>
		$this->restrictedTransType_u = 0;	//<uint8_t>
		$this->inventoryInfo = new \icson\deal\bo\InventoryInfo();	//<icson::deal::bo::CInventoryInfo>
		$this->inventoryInfo_u = 0;	//<uint8_t>
		$this->sellerId = 0;	//<uint32_t>
		$this->sellerId_u = 0;	//<uint8_t>
		$this->sellerStockId = 0;	//<uint32_t>
		$this->sellerStockId_u = 0;	//<uint8_t>
		$this->flag = 0;	//<uint32_t>
		$this->flag_u = 0;	//<uint8_t>
		$this->price = 0;	//<uint32_t>
		$this->price_u = 0;	//<uint8_t>
		$this->weight = 0;	//<uint32_t>
		$this->weight_u = 0;	//<uint8_t>
		$this->buyCount = 0;	//<uint32_t>
		$this->buyCount_u = 0;	//<uint8_t>
		$this->cashBack = 0;	//<uint32_t>
		$this->cashBack_u = 0;	//<uint8_t>
		$this->c3Ids = 0;	//<uint32_t>
		$this->c3Ids_u = 0;	//<uint8_t>
		$this->giftList = new \stl_vector2('\icson\deal\bo\GiftInfo4Shipping');	//<std::vector<icson::deal::bo::CGiftInfo4Shipping> >
		$this->giftList_u = 0;	//<uint8_t>
		$this->type = 0;	//<uint32_t>
		$this->type_u = 0;	//<uint8_t>
		$this->sizeInfo = new \oms\ordersize\po\ProductUnitPo();	//<oms::ordersize::po::CProductUnitPo>
		$this->sizeInfo_u = 0;	//<uint8_t>
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
			exit("\icson\deal\bo\ShippingParam\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\bo\ShippingParam\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 协议版本号
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->productId);	//<uint32_t> 商品ID
		$bs->pushUint8_t($this->productId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->bookingType);	//<uint32_t> 商品预购类型
		$bs->pushUint8_t($this->bookingType_u);	//<uint8_t> 
		$bs->pushUint32_t($this->bookingValue);	//<uint32_t> 商品预购值
		$bs->pushUint8_t($this->bookingValue_u);	//<uint8_t> 
		$bs->pushUint32_t($this->restrictedTransType);	//<uint32_t> 商品限运类型
		$bs->pushUint8_t($this->restrictedTransType_u);	//<uint8_t> 
		$bs->pushObject($this->inventoryInfo,'\icson\deal\bo\InventoryInfo');	//<icson::deal::bo::CInventoryInfo> 需查询配送的商品库存信息
		$bs->pushUint8_t($this->inventoryInfo_u);	//<uint8_t> 
		$bs->pushUint32_t($this->sellerId);	//<uint32_t> 商户ID（区分新联营）
		$bs->pushUint8_t($this->sellerId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->sellerStockId);	//<uint32_t> 商户地址(仓)ID，新联营特性
		$bs->pushUint8_t($this->sellerStockId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->flag);	//<uint32_t> 商品flag
		$bs->pushUint8_t($this->flag_u);	//<uint8_t> 
		$bs->pushUint32_t($this->price);	//<uint32_t> 商品价格，取促销处理后total_price_after
		$bs->pushUint8_t($this->price_u);	//<uint8_t> 
		$bs->pushUint32_t($this->weight);	//<uint32_t> 商品重量
		$bs->pushUint8_t($this->weight_u);	//<uint8_t> 
		$bs->pushUint32_t($this->buyCount);	//<uint32_t> 购买数量
		$bs->pushUint8_t($this->buyCount_u);	//<uint8_t> 
		$bs->pushUint32_t($this->cashBack);	//<uint32_t> 返现
		$bs->pushUint8_t($this->cashBack_u);	//<uint8_t> 
		$bs->pushUint32_t($this->c3Ids);	//<uint32_t> c3_ids，三级类目ID
		$bs->pushUint8_t($this->c3Ids_u);	//<uint8_t> 
		$bs->pushObject($this->giftList,'stl_vector');	//<std::vector<icson::deal::bo::CGiftInfo4Shipping> > 赠品信息
		$bs->pushUint8_t($this->giftList_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushUint32_t($this->type);	//<uint32_t> type
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->type_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushObject($this->sizeInfo,'\oms\ordersize\po\ProductUnitPo');	//<oms::ordersize::po::CProductUnitPo> 商品长宽高重信息
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->sizeInfo_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 协议版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productId'] = $bs->popUint32_t();	//<uint32_t> 商品ID
		$this->_arr_value['productId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bookingType'] = $bs->popUint32_t();	//<uint32_t> 商品预购类型
		$this->_arr_value['bookingType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bookingValue'] = $bs->popUint32_t();	//<uint32_t> 商品预购值
		$this->_arr_value['bookingValue_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['restrictedTransType'] = $bs->popUint32_t();	//<uint32_t> 商品限运类型
		$this->_arr_value['restrictedTransType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['inventoryInfo'] = $bs->popObject('\icson\deal\bo\InventoryInfo');	//<icson::deal::bo::CInventoryInfo> 需查询配送的商品库存信息
		$this->_arr_value['inventoryInfo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerId'] = $bs->popUint32_t();	//<uint32_t> 商户ID（区分新联营）
		$this->_arr_value['sellerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerStockId'] = $bs->popUint32_t();	//<uint32_t> 商户地址(仓)ID，新联营特性
		$this->_arr_value['sellerStockId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['flag'] = $bs->popUint32_t();	//<uint32_t> 商品flag
		$this->_arr_value['flag_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['price'] = $bs->popUint32_t();	//<uint32_t> 商品价格，取促销处理后total_price_after
		$this->_arr_value['price_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['weight'] = $bs->popUint32_t();	//<uint32_t> 商品重量
		$this->_arr_value['weight_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyCount'] = $bs->popUint32_t();	//<uint32_t> 购买数量
		$this->_arr_value['buyCount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cashBack'] = $bs->popUint32_t();	//<uint32_t> 返现
		$this->_arr_value['cashBack_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['c3Ids'] = $bs->popUint32_t();	//<uint32_t> c3_ids，三级类目ID
		$this->_arr_value['c3Ids_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['giftList'] = $bs->popObject('stl_vector<\icson\deal\bo\GiftInfo4Shipping>');	//<std::vector<icson::deal::bo::CGiftInfo4Shipping> > 赠品信息
		$this->_arr_value['giftList_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['type'] = $bs->popUint32_t();	//<uint32_t> type
		}
		if($this->version >= 1){
			$this->_arr_value['type_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['sizeInfo'] = $bs->popObject('\oms\ordersize\po\ProductUnitPo');	//<oms::ordersize::po::CProductUnitPo> 商品长宽高重信息
		}
		if($this->version >= 1){
			$this->_arr_value['sizeInfo_u'] = $bs->popUint8_t();	//<uint8_t> 
		}

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

namespace icson\deal\bo;	//source idl: com.icson.deal.idl.ShippingParam.java
if (!class_exists('icson\deal\bo\InventoryInfo', false)) {
class InventoryInfo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 协议版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $productId;	//<uint32_t> 商品id(版本>=0)
	private $productId_u;	//<uint8_t> (版本>=0)
	private $saleStockId;	//<uint32_t> 销售分仓id(版本>=0)
	private $saleStockId_u;	//<uint8_t> (版本>=0)
	private $supplyStockId;	//<uint32_t> 供货分仓id(版本>=0)
	private $supplyStockId_u;	//<uint8_t> (版本>=0)
	private $availableNum;	//<int> 可用库存(版本>=0)
	private $availableNum_u;	//<uint8_t> (版本>=0)
	private $virtualNum;	//<int> 虚拟库存(版本>=0)
	private $virtualNum_u;	//<uint8_t> (版本>=0)
	private $accountNum;	//<int> 财务库存(版本>=0)
	private $accountNum_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->productId = 0;	//<uint32_t>
		$this->productId_u = 0;	//<uint8_t>
		$this->saleStockId = 0;	//<uint32_t>
		$this->saleStockId_u = 0;	//<uint8_t>
		$this->supplyStockId = 0;	//<uint32_t>
		$this->supplyStockId_u = 0;	//<uint8_t>
		$this->availableNum = 0;	//<int>
		$this->availableNum_u = 0;	//<uint8_t>
		$this->virtualNum = 0;	//<int>
		$this->virtualNum_u = 0;	//<uint8_t>
		$this->accountNum = 0;	//<int>
		$this->accountNum_u = 0;	//<uint8_t>
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
			exit("\icson\deal\bo\InventoryInfo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\bo\InventoryInfo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 协议版本号
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->productId);	//<uint32_t> 商品id
		$bs->pushUint8_t($this->productId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->saleStockId);	//<uint32_t> 销售分仓id
		$bs->pushUint8_t($this->saleStockId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->supplyStockId);	//<uint32_t> 供货分仓id
		$bs->pushUint8_t($this->supplyStockId_u);	//<uint8_t> 
		$bs->pushInt32_t($this->availableNum);	//<int> 可用库存
		$bs->pushUint8_t($this->availableNum_u);	//<uint8_t> 
		$bs->pushInt32_t($this->virtualNum);	//<int> 虚拟库存
		$bs->pushUint8_t($this->virtualNum_u);	//<uint8_t> 
		$bs->pushInt32_t($this->accountNum);	//<int> 财务库存
		$bs->pushUint8_t($this->accountNum_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 协议版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productId'] = $bs->popUint32_t();	//<uint32_t> 商品id
		$this->_arr_value['productId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['saleStockId'] = $bs->popUint32_t();	//<uint32_t> 销售分仓id
		$this->_arr_value['saleStockId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['supplyStockId'] = $bs->popUint32_t();	//<uint32_t> 供货分仓id
		$this->_arr_value['supplyStockId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['availableNum'] = $bs->popInt32_t();	//<int> 可用库存
		$this->_arr_value['availableNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['virtualNum'] = $bs->popInt32_t();	//<int> 虚拟库存
		$this->_arr_value['virtualNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['accountNum'] = $bs->popInt32_t();	//<int> 财务库存
		$this->_arr_value['accountNum_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\deal\bo;	//source idl: com.icson.deal.idl.ShippingAo.java
if (!class_exists('icson\deal\bo\OrderShippingInfo', false)) {
class OrderShippingInfo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 协议版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $packageList;	//<std::map<std::string,icson::deal::bo::CShippingPackageInfo> > <packageId, 包裹信息>(版本>=0)
	private $packageList_u;	//<uint8_t> (版本>=0)
	private $delayList;	//<std::map<std::string,icson::deal::bo::CDelayInfo> > <packageId, 延迟类型>(版本>=0)
	private $delayList_u;	//<uint8_t> (版本>=0)
	private $shipinfo;	//<std::vector<icson::deal::bo::CShippingInfo> > 订单配送信息(版本>=0)
	private $shipinfo_u;	//<uint8_t> (版本>=0)
	private $isCanVAT;	//<uint32_t> 可开增值票，1/0:是/否(版本>=0)
	private $isCanVAT_u;	//<uint8_t> (版本>=0)
	private $hasNoteBook;	//<uint32_t> 存在笔记本类商品，1/0:是/否(版本>=0)
	private $hasNoteBook_u;	//<uint8_t> (版本>=0)
	private $totalWeight;	//<uint32_t> 订单总重量(版本>=0)
	private $totalWeight_u;	//<uint8_t> (版本>=0)
	private $totalCut;	//<uint32_t> 订单总返现(版本>=0)
	private $totalCut_u;	//<uint8_t> (版本>=0)
	private $totalAmt;	//<uint32_t> 订单总金额，以促销2.0为准(版本>=0)
	private $totalAmt_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 1;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->packageList = new \stl_map2('stl_string,\icson\deal\bo\ShippingPackageInfo');	//<std::map<std::string,icson::deal::bo::CShippingPackageInfo> >
		$this->packageList_u = 0;	//<uint8_t>
		$this->delayList = new \stl_map2('stl_string,\icson\deal\bo\DelayInfo');	//<std::map<std::string,icson::deal::bo::CDelayInfo> >
		$this->delayList_u = 0;	//<uint8_t>
		$this->shipinfo = new \stl_vector2('\icson\deal\bo\ShippingInfo');	//<std::vector<icson::deal::bo::CShippingInfo> >
		$this->shipinfo_u = 0;	//<uint8_t>
		$this->isCanVAT = 0;	//<uint32_t>
		$this->isCanVAT_u = 0;	//<uint8_t>
		$this->hasNoteBook = 0;	//<uint32_t>
		$this->hasNoteBook_u = 0;	//<uint8_t>
		$this->totalWeight = 0;	//<uint32_t>
		$this->totalWeight_u = 0;	//<uint8_t>
		$this->totalCut = 0;	//<uint32_t>
		$this->totalCut_u = 0;	//<uint8_t>
		$this->totalAmt = 0;	//<uint32_t>
		$this->totalAmt_u = 0;	//<uint8_t>
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
			exit("\icson\deal\bo\OrderShippingInfo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\bo\OrderShippingInfo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 协议版本号
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushObject($this->packageList,'stl_map');	//<std::map<std::string,icson::deal::bo::CShippingPackageInfo> > <packageId, 包裹信息>
		$bs->pushUint8_t($this->packageList_u);	//<uint8_t> 
		$bs->pushObject($this->delayList,'stl_map');	//<std::map<std::string,icson::deal::bo::CDelayInfo> > <packageId, 延迟类型>
		$bs->pushUint8_t($this->delayList_u);	//<uint8_t> 
		$bs->pushObject($this->shipinfo,'stl_vector');	//<std::vector<icson::deal::bo::CShippingInfo> > 订单配送信息
		$bs->pushUint8_t($this->shipinfo_u);	//<uint8_t> 
		$bs->pushUint32_t($this->isCanVAT);	//<uint32_t> 可开增值票，1/0:是/否
		$bs->pushUint8_t($this->isCanVAT_u);	//<uint8_t> 
		$bs->pushUint32_t($this->hasNoteBook);	//<uint32_t> 存在笔记本类商品，1/0:是/否
		$bs->pushUint8_t($this->hasNoteBook_u);	//<uint8_t> 
		$bs->pushUint32_t($this->totalWeight);	//<uint32_t> 订单总重量
		$bs->pushUint8_t($this->totalWeight_u);	//<uint8_t> 
		$bs->pushUint32_t($this->totalCut);	//<uint32_t> 订单总返现
		$bs->pushUint8_t($this->totalCut_u);	//<uint8_t> 
		$bs->pushUint32_t($this->totalAmt);	//<uint32_t> 订单总金额，以促销2.0为准
		$bs->pushUint8_t($this->totalAmt_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 协议版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['packageList'] = $bs->popObject('stl_map<stl_string,\icson\deal\bo\ShippingPackageInfo>');	//<std::map<std::string,icson::deal::bo::CShippingPackageInfo> > <packageId, 包裹信息>
		$this->_arr_value['packageList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['delayList'] = $bs->popObject('stl_map<stl_string,\icson\deal\bo\DelayInfo>');	//<std::map<std::string,icson::deal::bo::CDelayInfo> > <packageId, 延迟类型>
		$this->_arr_value['delayList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shipinfo'] = $bs->popObject('stl_vector<\icson\deal\bo\ShippingInfo>');	//<std::vector<icson::deal::bo::CShippingInfo> > 订单配送信息
		$this->_arr_value['shipinfo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['isCanVAT'] = $bs->popUint32_t();	//<uint32_t> 可开增值票，1/0:是/否
		$this->_arr_value['isCanVAT_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['hasNoteBook'] = $bs->popUint32_t();	//<uint32_t> 存在笔记本类商品，1/0:是/否
		$this->_arr_value['hasNoteBook_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['totalWeight'] = $bs->popUint32_t();	//<uint32_t> 订单总重量
		$this->_arr_value['totalWeight_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['totalCut'] = $bs->popUint32_t();	//<uint32_t> 订单总返现
		$this->_arr_value['totalCut_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['totalAmt'] = $bs->popUint32_t();	//<uint32_t> 订单总金额，以促销2.0为准
		$this->_arr_value['totalAmt_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\deal\bo;	//source idl: com.icson.deal.idl.OrderShippingInfo.java
if (!class_exists('icson\deal\bo\ShippingInfo', false)) {
class ShippingInfo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 协议版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $shippingPrice;	//<uint32_t> 订单运费(版本>=0)
	private $shippingPrice_u;	//<uint8_t> (版本>=0)
	private $shippingCut;	//<uint32_t> 订单运费减免(版本>=0)
	private $shippingCut_u;	//<uint8_t> (版本>=0)
	private $shippingCost;	//<uint32_t> 订单运费成本(版本>=0)
	private $shippingCost_u;	//<uint8_t> (版本>=0)
	private $isFree;	//<uint32_t> 是否免运费(版本>=0)
	private $isFree_u;	//<uint8_t> (版本>=0)
	private $shippingFreeType;	//<uint32_t> 免运费类型(版本>=0)
	private $shippingFreeType_u;	//<uint8_t> (版本>=0)
	private $shippingFreeLimit;	//<uint32_t> 免运费阈值(版本>=0)
	private $shippingFreeLimit_u;	//<uint8_t> (版本>=0)
	private $sysNo;	//<uint32_t> (版本>=0)
	private $sysNo_u;	//<uint8_t> (版本>=0)
	private $shipTypeID;	//<uint32_t> (版本>=0)
	private $shipTypeID_u;	//<uint8_t> (版本>=0)
	private $shipTypeName;	//<std::string> 快递名称，e.g.:易迅快递(版本>=0)
	private $shipTypeName_u;	//<uint8_t> (版本>=0)
	private $shipTypeDesc;	//<std::string> 快递描述，e.g.:支持货到付款及POS机刷卡，上海市区一日三送...(版本>=0)
	private $shipTypeDesc_u;	//<uint8_t> (版本>=0)
	private $shippingId;	//<uint32_t> (版本>=0)
	private $shippingId_u;	//<uint8_t> (版本>=0)
	private $premiumRate;	//<std::string> PremiumRate(版本>=0)
	private $premiumRate_u;	//<uint8_t> (版本>=0)
	private $statusQueryType;	//<uint32_t> StatusQueryType(版本>=0)
	private $statusQueryType_u;	//<uint8_t> (版本>=0)
	private $statusQueryUrl;	//<std::string> StatusQueryUrl(版本>=0)
	private $statusQueryUrl_u;	//<uint8_t> (版本>=0)
	private $isCOD;	//<uint32_t> 是否支持货到付款，0/1:不支持/支持(版本>=0)
	private $isCOD_u;	//<uint8_t> (版本>=0)
	private $deliveryTime;	//<uint32_t> (版本>=0)
	private $deliveryTime_u;	//<uint8_t> (版本>=0)
	private $status;	//<uint32_t> (版本>=0)
	private $status_u;	//<uint8_t> (版本>=0)
	private $isOnlineShow;	//<uint32_t> (版本>=0)
	private $isOnlineShow_u;	//<uint8_t> (版本>=0)
	private $subShipping;	//<std::map<std::string,icson::deal::bo::CSubShippingInfo> > <packageId, 子单配送信息>(版本>=0)
	private $subShipping_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->shippingPrice = 0;	//<uint32_t>
		$this->shippingPrice_u = 0;	//<uint8_t>
		$this->shippingCut = 0;	//<uint32_t>
		$this->shippingCut_u = 0;	//<uint8_t>
		$this->shippingCost = 0;	//<uint32_t>
		$this->shippingCost_u = 0;	//<uint8_t>
		$this->isFree = 0;	//<uint32_t>
		$this->isFree_u = 0;	//<uint8_t>
		$this->shippingFreeType = 0;	//<uint32_t>
		$this->shippingFreeType_u = 0;	//<uint8_t>
		$this->shippingFreeLimit = 0;	//<uint32_t>
		$this->shippingFreeLimit_u = 0;	//<uint8_t>
		$this->sysNo = 0;	//<uint32_t>
		$this->sysNo_u = 0;	//<uint8_t>
		$this->shipTypeID = 0;	//<uint32_t>
		$this->shipTypeID_u = 0;	//<uint8_t>
		$this->shipTypeName = "";	//<std::string>
		$this->shipTypeName_u = 0;	//<uint8_t>
		$this->shipTypeDesc = "";	//<std::string>
		$this->shipTypeDesc_u = 0;	//<uint8_t>
		$this->shippingId = 0;	//<uint32_t>
		$this->shippingId_u = 0;	//<uint8_t>
		$this->premiumRate = "";	//<std::string>
		$this->premiumRate_u = 0;	//<uint8_t>
		$this->statusQueryType = 0;	//<uint32_t>
		$this->statusQueryType_u = 0;	//<uint8_t>
		$this->statusQueryUrl = "";	//<std::string>
		$this->statusQueryUrl_u = 0;	//<uint8_t>
		$this->isCOD = 0;	//<uint32_t>
		$this->isCOD_u = 0;	//<uint8_t>
		$this->deliveryTime = 0;	//<uint32_t>
		$this->deliveryTime_u = 0;	//<uint8_t>
		$this->status = 0;	//<uint32_t>
		$this->status_u = 0;	//<uint8_t>
		$this->isOnlineShow = 0;	//<uint32_t>
		$this->isOnlineShow_u = 0;	//<uint8_t>
		$this->subShipping = new \stl_map2('stl_string,\icson\deal\bo\SubShippingInfo');	//<std::map<std::string,icson::deal::bo::CSubShippingInfo> >
		$this->subShipping_u = 0;	//<uint8_t>
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
			exit("\icson\deal\bo\ShippingInfo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\bo\ShippingInfo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 协议版本号
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->shippingPrice);	//<uint32_t> 订单运费
		$bs->pushUint8_t($this->shippingPrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->shippingCut);	//<uint32_t> 订单运费减免
		$bs->pushUint8_t($this->shippingCut_u);	//<uint8_t> 
		$bs->pushUint32_t($this->shippingCost);	//<uint32_t> 订单运费成本
		$bs->pushUint8_t($this->shippingCost_u);	//<uint8_t> 
		$bs->pushUint32_t($this->isFree);	//<uint32_t> 是否免运费
		$bs->pushUint8_t($this->isFree_u);	//<uint8_t> 
		$bs->pushUint32_t($this->shippingFreeType);	//<uint32_t> 免运费类型
		$bs->pushUint8_t($this->shippingFreeType_u);	//<uint8_t> 
		$bs->pushUint32_t($this->shippingFreeLimit);	//<uint32_t> 免运费阈值
		$bs->pushUint8_t($this->shippingFreeLimit_u);	//<uint8_t> 
		$bs->pushUint32_t($this->sysNo);	//<uint32_t> 
		$bs->pushUint8_t($this->sysNo_u);	//<uint8_t> 
		$bs->pushUint32_t($this->shipTypeID);	//<uint32_t> 
		$bs->pushUint8_t($this->shipTypeID_u);	//<uint8_t> 
		$bs->pushString($this->shipTypeName);	//<std::string> 快递名称，e.g.:易迅快递
		$bs->pushUint8_t($this->shipTypeName_u);	//<uint8_t> 
		$bs->pushString($this->shipTypeDesc);	//<std::string> 快递描述，e.g.:支持货到付款及POS机刷卡，上海市区一日三送...
		$bs->pushUint8_t($this->shipTypeDesc_u);	//<uint8_t> 
		$bs->pushUint32_t($this->shippingId);	//<uint32_t> 
		$bs->pushUint8_t($this->shippingId_u);	//<uint8_t> 
		$bs->pushString($this->premiumRate);	//<std::string> PremiumRate
		$bs->pushUint8_t($this->premiumRate_u);	//<uint8_t> 
		$bs->pushUint32_t($this->statusQueryType);	//<uint32_t> StatusQueryType
		$bs->pushUint8_t($this->statusQueryType_u);	//<uint8_t> 
		$bs->pushString($this->statusQueryUrl);	//<std::string> StatusQueryUrl
		$bs->pushUint8_t($this->statusQueryUrl_u);	//<uint8_t> 
		$bs->pushUint32_t($this->isCOD);	//<uint32_t> 是否支持货到付款，0/1:不支持/支持
		$bs->pushUint8_t($this->isCOD_u);	//<uint8_t> 
		$bs->pushUint32_t($this->deliveryTime);	//<uint32_t> 
		$bs->pushUint8_t($this->deliveryTime_u);	//<uint8_t> 
		$bs->pushUint32_t($this->status);	//<uint32_t> 
		$bs->pushUint8_t($this->status_u);	//<uint8_t> 
		$bs->pushUint32_t($this->isOnlineShow);	//<uint32_t> 
		$bs->pushUint8_t($this->isOnlineShow_u);	//<uint8_t> 
		$bs->pushObject($this->subShipping,'stl_map');	//<std::map<std::string,icson::deal::bo::CSubShippingInfo> > <packageId, 子单配送信息>
		$bs->pushUint8_t($this->subShipping_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 协议版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shippingPrice'] = $bs->popUint32_t();	//<uint32_t> 订单运费
		$this->_arr_value['shippingPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shippingCut'] = $bs->popUint32_t();	//<uint32_t> 订单运费减免
		$this->_arr_value['shippingCut_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shippingCost'] = $bs->popUint32_t();	//<uint32_t> 订单运费成本
		$this->_arr_value['shippingCost_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['isFree'] = $bs->popUint32_t();	//<uint32_t> 是否免运费
		$this->_arr_value['isFree_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shippingFreeType'] = $bs->popUint32_t();	//<uint32_t> 免运费类型
		$this->_arr_value['shippingFreeType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shippingFreeLimit'] = $bs->popUint32_t();	//<uint32_t> 免运费阈值
		$this->_arr_value['shippingFreeLimit_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sysNo'] = $bs->popUint32_t();	//<uint32_t> 
		$this->_arr_value['sysNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shipTypeID'] = $bs->popUint32_t();	//<uint32_t> 
		$this->_arr_value['shipTypeID_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shipTypeName'] = $bs->popString();	//<std::string> 快递名称，e.g.:易迅快递
		$this->_arr_value['shipTypeName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shipTypeDesc'] = $bs->popString();	//<std::string> 快递描述，e.g.:支持货到付款及POS机刷卡，上海市区一日三送...
		$this->_arr_value['shipTypeDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shippingId'] = $bs->popUint32_t();	//<uint32_t> 
		$this->_arr_value['shippingId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['premiumRate'] = $bs->popString();	//<std::string> PremiumRate
		$this->_arr_value['premiumRate_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['statusQueryType'] = $bs->popUint32_t();	//<uint32_t> StatusQueryType
		$this->_arr_value['statusQueryType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['statusQueryUrl'] = $bs->popString();	//<std::string> StatusQueryUrl
		$this->_arr_value['statusQueryUrl_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['isCOD'] = $bs->popUint32_t();	//<uint32_t> 是否支持货到付款，0/1:不支持/支持
		$this->_arr_value['isCOD_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['deliveryTime'] = $bs->popUint32_t();	//<uint32_t> 
		$this->_arr_value['deliveryTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['status'] = $bs->popUint32_t();	//<uint32_t> 
		$this->_arr_value['status_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['isOnlineShow'] = $bs->popUint32_t();	//<uint32_t> 
		$this->_arr_value['isOnlineShow_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['subShipping'] = $bs->popObject('stl_map<stl_string,\icson\deal\bo\SubShippingInfo>');	//<std::map<std::string,icson::deal::bo::CSubShippingInfo> > <packageId, 子单配送信息>
		$this->_arr_value['subShipping_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\deal\bo;	//source idl: com.icson.deal.idl.ShippingInfo.java
if (!class_exists('icson\deal\bo\SubShippingInfo', false)) {
class SubShippingInfo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 协议版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $sellerId;	//<uint32_t> 卖家ID(版本>=0)
	private $sellerId_u;	//<uint8_t> (版本>=0)
	private $sellerStockId;	//<uint32_t> 商户地址(仓)ID，新联营特性(版本>=0)
	private $sellerStockId_u;	//<uint8_t> (版本>=0)
	private $psyStockId;	//<uint32_t> 发货仓ID(版本>=0)
	private $psyStockId_u;	//<uint8_t> (版本>=0)
	private $shippingFreeType;	//<uint32_t> 免运费类型(版本>=0)
	private $shippingFreeType_u;	//<uint8_t> (版本>=0)
	private $shippingFreeLimit;	//<uint32_t> 免运费阈值(版本>=0)
	private $shippingFreeLimit_u;	//<uint8_t> (版本>=0)
	private $shippingPrice;	//<uint32_t> 运费(版本>=0)
	private $shippingPrice_u;	//<uint8_t> (版本>=0)
	private $shippingPriceCut;	//<uint32_t> 减免(版本>=0)
	private $shippingPriceCut_u;	//<uint8_t> (版本>=0)
	private $shippingPriceCost;	//<uint32_t> 成本(版本>=0)
	private $shippingPriceCost_u;	//<uint8_t> (版本>=0)
	private $isArrivedLimitTime;	//<uint32_t> isArrivedLimitTime(版本>=0)
	private $isArrivedLimitTime_u;	//<uint8_t> (版本>=0)
	private $calendar;	//<std::vector<icson::deal::bo::CShipCalendar> > 配送日历，易迅快递可选一日N送配送时间(版本>=0)
	private $calendar_u;	//<uint8_t> (版本>=0)
	private $shipDate;	//<std::string> 最早配送时间，非易迅快递指定配送日期即可(版本>=0)
	private $shipDate_u;	//<uint8_t> (版本>=0)
	private $isCanXpress;	//<uint32_t> 是否可供随心送，1/0:可/不可(版本>=0)
	private $isCanXpress_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->sellerId = 0;	//<uint32_t>
		$this->sellerId_u = 0;	//<uint8_t>
		$this->sellerStockId = 0;	//<uint32_t>
		$this->sellerStockId_u = 0;	//<uint8_t>
		$this->psyStockId = 0;	//<uint32_t>
		$this->psyStockId_u = 0;	//<uint8_t>
		$this->shippingFreeType = 0;	//<uint32_t>
		$this->shippingFreeType_u = 0;	//<uint8_t>
		$this->shippingFreeLimit = 0;	//<uint32_t>
		$this->shippingFreeLimit_u = 0;	//<uint8_t>
		$this->shippingPrice = 0;	//<uint32_t>
		$this->shippingPrice_u = 0;	//<uint8_t>
		$this->shippingPriceCut = 0;	//<uint32_t>
		$this->shippingPriceCut_u = 0;	//<uint8_t>
		$this->shippingPriceCost = 0;	//<uint32_t>
		$this->shippingPriceCost_u = 0;	//<uint8_t>
		$this->isArrivedLimitTime = 0;	//<uint32_t>
		$this->isArrivedLimitTime_u = 0;	//<uint8_t>
		$this->calendar = new \stl_vector2('\icson\deal\bo\ShipCalendar');	//<std::vector<icson::deal::bo::CShipCalendar> >
		$this->calendar_u = 0;	//<uint8_t>
		$this->shipDate = "";	//<std::string>
		$this->shipDate_u = 0;	//<uint8_t>
		$this->isCanXpress = 0;	//<uint32_t>
		$this->isCanXpress_u = 0;	//<uint8_t>
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
			exit("\icson\deal\bo\SubShippingInfo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\bo\SubShippingInfo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 协议版本号
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->sellerId);	//<uint32_t> 卖家ID
		$bs->pushUint8_t($this->sellerId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->sellerStockId);	//<uint32_t> 商户地址(仓)ID，新联营特性
		$bs->pushUint8_t($this->sellerStockId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->psyStockId);	//<uint32_t> 发货仓ID
		$bs->pushUint8_t($this->psyStockId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->shippingFreeType);	//<uint32_t> 免运费类型
		$bs->pushUint8_t($this->shippingFreeType_u);	//<uint8_t> 
		$bs->pushUint32_t($this->shippingFreeLimit);	//<uint32_t> 免运费阈值
		$bs->pushUint8_t($this->shippingFreeLimit_u);	//<uint8_t> 
		$bs->pushUint32_t($this->shippingPrice);	//<uint32_t> 运费
		$bs->pushUint8_t($this->shippingPrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->shippingPriceCut);	//<uint32_t> 减免
		$bs->pushUint8_t($this->shippingPriceCut_u);	//<uint8_t> 
		$bs->pushUint32_t($this->shippingPriceCost);	//<uint32_t> 成本
		$bs->pushUint8_t($this->shippingPriceCost_u);	//<uint8_t> 
		$bs->pushUint32_t($this->isArrivedLimitTime);	//<uint32_t> isArrivedLimitTime
		$bs->pushUint8_t($this->isArrivedLimitTime_u);	//<uint8_t> 
		$bs->pushObject($this->calendar,'stl_vector');	//<std::vector<icson::deal::bo::CShipCalendar> > 配送日历，易迅快递可选一日N送配送时间
		$bs->pushUint8_t($this->calendar_u);	//<uint8_t> 
		$bs->pushString($this->shipDate);	//<std::string> 最早配送时间，非易迅快递指定配送日期即可
		$bs->pushUint8_t($this->shipDate_u);	//<uint8_t> 
		$bs->pushUint32_t($this->isCanXpress);	//<uint32_t> 是否可供随心送，1/0:可/不可
		$bs->pushUint8_t($this->isCanXpress_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 协议版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerId'] = $bs->popUint32_t();	//<uint32_t> 卖家ID
		$this->_arr_value['sellerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerStockId'] = $bs->popUint32_t();	//<uint32_t> 商户地址(仓)ID，新联营特性
		$this->_arr_value['sellerStockId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['psyStockId'] = $bs->popUint32_t();	//<uint32_t> 发货仓ID
		$this->_arr_value['psyStockId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shippingFreeType'] = $bs->popUint32_t();	//<uint32_t> 免运费类型
		$this->_arr_value['shippingFreeType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shippingFreeLimit'] = $bs->popUint32_t();	//<uint32_t> 免运费阈值
		$this->_arr_value['shippingFreeLimit_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shippingPrice'] = $bs->popUint32_t();	//<uint32_t> 运费
		$this->_arr_value['shippingPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shippingPriceCut'] = $bs->popUint32_t();	//<uint32_t> 减免
		$this->_arr_value['shippingPriceCut_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shippingPriceCost'] = $bs->popUint32_t();	//<uint32_t> 成本
		$this->_arr_value['shippingPriceCost_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['isArrivedLimitTime'] = $bs->popUint32_t();	//<uint32_t> isArrivedLimitTime
		$this->_arr_value['isArrivedLimitTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['calendar'] = $bs->popObject('stl_vector<\icson\deal\bo\ShipCalendar>');	//<std::vector<icson::deal::bo::CShipCalendar> > 配送日历，易迅快递可选一日N送配送时间
		$this->_arr_value['calendar_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shipDate'] = $bs->popString();	//<std::string> 最早配送时间，非易迅快递指定配送日期即可
		$this->_arr_value['shipDate_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['isCanXpress'] = $bs->popUint32_t();	//<uint32_t> 是否可供随心送，1/0:可/不可
		$this->_arr_value['isCanXpress_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\deal\bo;	//source idl: com.icson.deal.idl.SubShippingInfo.java
if (!class_exists('icson\deal\bo\ShipCalendar', false)) {
class ShipCalendar{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 协议版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $name;	//<std::string> 描述，e.g.:2013-04-04 星期四上午(版本>=0)
	private $name_u;	//<uint8_t> (版本>=0)
	private $shipDate;	//<std::string> 日期，e.g.:20130404(版本>=0)
	private $shipDate_u;	//<uint8_t> (版本>=0)
	private $weekDay;	//<uint32_t> 星期，e.g.:4(版本>=0)
	private $weekDay_u;	//<uint8_t> (版本>=0)
	private $timeSpan;	//<uint32_t> 一日几送，e.g.:2(版本>=0)
	private $timeSpan_u;	//<uint8_t> (版本>=0)
	private $status;	//<uint32_t> 状态，（0/2/2:可用/过期/限单 以往是0/-1/-2不建议使用负）(版本>=0)
	private $status_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->name = "";	//<std::string>
		$this->name_u = 0;	//<uint8_t>
		$this->shipDate = "";	//<std::string>
		$this->shipDate_u = 0;	//<uint8_t>
		$this->weekDay = 0;	//<uint32_t>
		$this->weekDay_u = 0;	//<uint8_t>
		$this->timeSpan = 0;	//<uint32_t>
		$this->timeSpan_u = 0;	//<uint8_t>
		$this->status = 0;	//<uint32_t>
		$this->status_u = 0;	//<uint8_t>
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
			exit("\icson\deal\bo\ShipCalendar\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\bo\ShipCalendar\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 协议版本号
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushString($this->name);	//<std::string> 描述，e.g.:2013-04-04 星期四上午
		$bs->pushUint8_t($this->name_u);	//<uint8_t> 
		$bs->pushString($this->shipDate);	//<std::string> 日期，e.g.:20130404
		$bs->pushUint8_t($this->shipDate_u);	//<uint8_t> 
		$bs->pushUint32_t($this->weekDay);	//<uint32_t> 星期，e.g.:4
		$bs->pushUint8_t($this->weekDay_u);	//<uint8_t> 
		$bs->pushUint32_t($this->timeSpan);	//<uint32_t> 一日几送，e.g.:2
		$bs->pushUint8_t($this->timeSpan_u);	//<uint8_t> 
		$bs->pushUint32_t($this->status);	//<uint32_t> 状态，（0/2/2:可用/过期/限单 以往是0/-1/-2不建议使用负）
		$bs->pushUint8_t($this->status_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 协议版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['name'] = $bs->popString();	//<std::string> 描述，e.g.:2013-04-04 星期四上午
		$this->_arr_value['name_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shipDate'] = $bs->popString();	//<std::string> 日期，e.g.:20130404
		$this->_arr_value['shipDate_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['weekDay'] = $bs->popUint32_t();	//<uint32_t> 星期，e.g.:4
		$this->_arr_value['weekDay_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timeSpan'] = $bs->popUint32_t();	//<uint32_t> 一日几送，e.g.:2
		$this->_arr_value['timeSpan_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['status'] = $bs->popUint32_t();	//<uint32_t> 状态，（0/2/2:可用/过期/限单 以往是0/-1/-2不建议使用负）
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
}

namespace icson\deal\bo;	//source idl: com.icson.deal.idl.OrderShippingInfo.java
if (!class_exists('icson\deal\bo\ShippingPackageInfo', false)) {
class ShippingPackageInfo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 协议版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $psyStockId;	//<uint32_t> 配送仓ID(版本>=0)
	private $psyStockId_u;	//<uint8_t> (版本>=0)
	private $stockWhId;	//<uint32_t> 仓的分站(版本>=0)
	private $stockWhId_u;	//<uint8_t> (版本>=0)
	private $sellMode;	//<uint32_t> 销售模式 1-自营 ，2-新联营(版本>=0)
	private $sellMode_u;	//<uint8_t> (版本>=0)
	private $sellerStockId;	//<uint32_t> 取货地址ID，新联营卖家仓ID(版本>=0)
	private $sellerStockId_u;	//<uint8_t> (版本>=0)
	private $sellerId;	//<uint32_t> 卖家ID，新联营(版本>=0)
	private $sellerId_u;	//<uint8_t> (版本>=0)
	private $dwItems;	//<std::map<uint32_t,std::map<std::string,uint32_t> > > 商品相关信息< product_id, < attribute, value > >(版本>=0)
	private $dwItems_u;	//<uint8_t> (版本>=0)
	private $strItems;	//<std::map<uint32_t,std::map<std::string,std::string> > > 商品相关信息< product_id, < attribute, value > >(版本>=0)
	private $strItems_u;	//<uint8_t> (版本>=0)
	private $delay;	//<icson::deal::bo::CDelayInfo> 延迟信息(版本>=0)
	private $delay_u;	//<uint8_t> (版本>=0)
	private $totalAmt;	//<uint32_t> 包的总金额(版本>=0)
	private $totalAmt_u;	//<uint8_t> (版本>=0)
	private $totalWeight;	//<uint32_t> 包的总重量(版本>=0)
	private $totalWeight_u;	//<uint8_t> (版本>=0)
	private $totalCut;	//<uint32_t> 包的总返现(版本>=0)
	private $totalCut_u;	//<uint8_t> (版本>=0)
	private $isCrossStock;	//<uint32_t> 是否跨仓，1/0:是/否(版本>=0)
	private $isCrossStock_u;	//<uint8_t> (版本>=0)
	private $isCanVAT;	//<uint32_t> 可开增值票，1/0:是/否(版本>=0)
	private $isCanVAT_u;	//<uint8_t> (版本>=0)
	private $hasNoteBook;	//<uint32_t> 存在笔记本类商品，1/0:是/否(版本>=0)
	private $hasNoteBook_u;	//<uint8_t> (版本>=0)
	private $sizeInfo;	//<oms::ordersize::po::COrderSizePo> 件型信息(版本>=1)
	private $sizeInfo_u;	//<uint8_t> (版本>=1)

	function __construct(){
		$this->version = 1;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->psyStockId = 0;	//<uint32_t>
		$this->psyStockId_u = 0;	//<uint8_t>
		$this->stockWhId = 0;	//<uint32_t>
		$this->stockWhId_u = 0;	//<uint8_t>
		$this->sellMode = 0;	//<uint32_t>
		$this->sellMode_u = 0;	//<uint8_t>
		$this->sellerStockId = 0;	//<uint32_t>
		$this->sellerStockId_u = 0;	//<uint8_t>
		$this->sellerId = 0;	//<uint32_t>
		$this->sellerId_u = 0;	//<uint8_t>
		$this->dwItems = new \stl_map2('uint32_t,stl_map<stl_string,uint32_t> ');	//<std::map<uint32_t,std::map<std::string,uint32_t> > >
		$this->dwItems_u = 0;	//<uint8_t>
		$this->strItems = new \stl_map2('uint32_t,stl_map<stl_string,stl_string> ');	//<std::map<uint32_t,std::map<std::string,std::string> > >
		$this->strItems_u = 0;	//<uint8_t>
		$this->delay = new \icson\deal\bo\DelayInfo();	//<icson::deal::bo::CDelayInfo>
		$this->delay_u = 0;	//<uint8_t>
		$this->totalAmt = 0;	//<uint32_t>
		$this->totalAmt_u = 0;	//<uint8_t>
		$this->totalWeight = 0;	//<uint32_t>
		$this->totalWeight_u = 0;	//<uint8_t>
		$this->totalCut = 0;	//<uint32_t>
		$this->totalCut_u = 0;	//<uint8_t>
		$this->isCrossStock = 0;	//<uint32_t>
		$this->isCrossStock_u = 0;	//<uint8_t>
		$this->isCanVAT = 0;	//<uint32_t>
		$this->isCanVAT_u = 0;	//<uint8_t>
		$this->hasNoteBook = 0;	//<uint32_t>
		$this->hasNoteBook_u = 0;	//<uint8_t>
		$this->sizeInfo = new \oms\ordersize\po\OrderSizePo();	//<oms::ordersize::po::COrderSizePo>
		$this->sizeInfo_u = 0;	//<uint8_t>
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
			exit("\icson\deal\bo\ShippingPackageInfo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\bo\ShippingPackageInfo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 协议版本号
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->psyStockId);	//<uint32_t> 配送仓ID
		$bs->pushUint8_t($this->psyStockId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->stockWhId);	//<uint32_t> 仓的分站
		$bs->pushUint8_t($this->stockWhId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->sellMode);	//<uint32_t> 销售模式 1-自营 ，2-新联营
		$bs->pushUint8_t($this->sellMode_u);	//<uint8_t> 
		$bs->pushUint32_t($this->sellerStockId);	//<uint32_t> 取货地址ID，新联营卖家仓ID
		$bs->pushUint8_t($this->sellerStockId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->sellerId);	//<uint32_t> 卖家ID，新联营
		$bs->pushUint8_t($this->sellerId_u);	//<uint8_t> 
		$bs->pushObject($this->dwItems,'stl_map');	//<std::map<uint32_t,std::map<std::string,uint32_t> > > 商品相关信息< product_id, < attribute, value > >
		$bs->pushUint8_t($this->dwItems_u);	//<uint8_t> 
		$bs->pushObject($this->strItems,'stl_map');	//<std::map<uint32_t,std::map<std::string,std::string> > > 商品相关信息< product_id, < attribute, value > >
		$bs->pushUint8_t($this->strItems_u);	//<uint8_t> 
		$bs->pushObject($this->delay,'\icson\deal\bo\DelayInfo');	//<icson::deal::bo::CDelayInfo> 延迟信息
		$bs->pushUint8_t($this->delay_u);	//<uint8_t> 
		$bs->pushUint32_t($this->totalAmt);	//<uint32_t> 包的总金额
		$bs->pushUint8_t($this->totalAmt_u);	//<uint8_t> 
		$bs->pushUint32_t($this->totalWeight);	//<uint32_t> 包的总重量
		$bs->pushUint8_t($this->totalWeight_u);	//<uint8_t> 
		$bs->pushUint32_t($this->totalCut);	//<uint32_t> 包的总返现
		$bs->pushUint8_t($this->totalCut_u);	//<uint8_t> 
		$bs->pushUint32_t($this->isCrossStock);	//<uint32_t> 是否跨仓，1/0:是/否
		$bs->pushUint8_t($this->isCrossStock_u);	//<uint8_t> 
		$bs->pushUint32_t($this->isCanVAT);	//<uint32_t> 可开增值票，1/0:是/否
		$bs->pushUint8_t($this->isCanVAT_u);	//<uint8_t> 
		$bs->pushUint32_t($this->hasNoteBook);	//<uint32_t> 存在笔记本类商品，1/0:是/否
		$bs->pushUint8_t($this->hasNoteBook_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushObject($this->sizeInfo,'\oms\ordersize\po\OrderSizePo');	//<oms::ordersize::po::COrderSizePo> 件型信息
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->sizeInfo_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 协议版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['psyStockId'] = $bs->popUint32_t();	//<uint32_t> 配送仓ID
		$this->_arr_value['psyStockId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockWhId'] = $bs->popUint32_t();	//<uint32_t> 仓的分站
		$this->_arr_value['stockWhId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellMode'] = $bs->popUint32_t();	//<uint32_t> 销售模式 1-自营 ，2-新联营
		$this->_arr_value['sellMode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerStockId'] = $bs->popUint32_t();	//<uint32_t> 取货地址ID，新联营卖家仓ID
		$this->_arr_value['sellerStockId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerId'] = $bs->popUint32_t();	//<uint32_t> 卖家ID，新联营
		$this->_arr_value['sellerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dwItems'] = $bs->popObject('stl_map<uint32_t,stl_map<stl_string,uint32_t> >');	//<std::map<uint32_t,std::map<std::string,uint32_t> > > 商品相关信息< product_id, < attribute, value > >
		$this->_arr_value['dwItems_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['strItems'] = $bs->popObject('stl_map<uint32_t,stl_map<stl_string,stl_string> >');	//<std::map<uint32_t,std::map<std::string,std::string> > > 商品相关信息< product_id, < attribute, value > >
		$this->_arr_value['strItems_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['delay'] = $bs->popObject('\icson\deal\bo\DelayInfo');	//<icson::deal::bo::CDelayInfo> 延迟信息
		$this->_arr_value['delay_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['totalAmt'] = $bs->popUint32_t();	//<uint32_t> 包的总金额
		$this->_arr_value['totalAmt_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['totalWeight'] = $bs->popUint32_t();	//<uint32_t> 包的总重量
		$this->_arr_value['totalWeight_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['totalCut'] = $bs->popUint32_t();	//<uint32_t> 包的总返现
		$this->_arr_value['totalCut_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['isCrossStock'] = $bs->popUint32_t();	//<uint32_t> 是否跨仓，1/0:是/否
		$this->_arr_value['isCrossStock_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['isCanVAT'] = $bs->popUint32_t();	//<uint32_t> 可开增值票，1/0:是/否
		$this->_arr_value['isCanVAT_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['hasNoteBook'] = $bs->popUint32_t();	//<uint32_t> 存在笔记本类商品，1/0:是/否
		$this->_arr_value['hasNoteBook_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['sizeInfo'] = $bs->popObject('\oms\ordersize\po\OrderSizePo');	//<oms::ordersize::po::COrderSizePo> 件型信息
		}
		if($this->version >= 1){
			$this->_arr_value['sizeInfo_u'] = $bs->popUint8_t();	//<uint8_t> 
		}

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

namespace oms\ordersize\po;	//source idl: com.icson.deal.idl.ShippingPackageInfo.java
if (!class_exists('oms\ordersize\po\OrderSizePo', false)) {
class OrderSizePo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  鐗堟湰鍙�(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $id;	//<uint64_t>  ID, 涓� OrderPo 閲岀殑 id 鏄搴旂殑,蹇呭～ (版本>=0)
	private $id_u;	//<uint8_t> (版本>=0)
	private $orderSize;	//<uint32_t> 璁㈠崟绫诲瀷(澶т欢璁㈠崟銆佷腑浠惰鍗曘�灏忎欢璁㈠崟) (版本>=0)
	private $orderSize_u;	//<uint8_t> (版本>=0)
	private $orderVolume;	//<uint64_t>  璁㈠崟鎬讳綋绉�绔嬫柟鍘樼背(版本>=0)
	private $orderVolume_u;	//<uint8_t> (版本>=0)
	private $orderWeight;	//<uint64_t>  璁㈠崟鎬婚噸閲�鍏�(版本>=0)
	private $orderWeight_u;	//<uint8_t> (版本>=0)
	private $orderMaxlength;	//<uint64_t>  璁㈠崟鏈�暱杈�姣背 (版本>=0)
	private $orderMaxlength_u;	//<uint8_t> (版本>=0)
	private $infoErrCode;	//<uint32_t>  濡傛灉閮ㄥ垎鍟嗗搧涓嶅瓨鍦�鎴栬�鍟嗗搧鐨勫昂瀵镐俊鎭笉瀛樺湪,杩斿洖鐗瑰畾鐨勯敊璇爜(版本>=0)
	private $infoErrCode_u;	//<uint8_t> (版本>=0)
	private $reserveDdw;	//<uint64_t> 淇濈暀瀛楁dw(版本>=0)
	private $reserveDdw_u;	//<uint8_t> (版本>=0)
	private $reserveStr;	//<std::string> 淇濈暀瀛楁str(版本>=0)
	private $reserveStr_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->id = 0;	//<uint64_t>
		$this->id_u = 0;	//<uint8_t>
		$this->orderSize = 0;	//<uint32_t>
		$this->orderSize_u = 0;	//<uint8_t>
		$this->orderVolume = 0;	//<uint64_t>
		$this->orderVolume_u = 0;	//<uint8_t>
		$this->orderWeight = 0;	//<uint64_t>
		$this->orderWeight_u = 0;	//<uint8_t>
		$this->orderMaxlength = 0;	//<uint64_t>
		$this->orderMaxlength_u = 0;	//<uint8_t>
		$this->infoErrCode = 0;	//<uint32_t>
		$this->infoErrCode_u = 0;	//<uint8_t>
		$this->reserveDdw = 0;	//<uint64_t>
		$this->reserveDdw_u = 0;	//<uint8_t>
		$this->reserveStr = "";	//<std::string>
		$this->reserveStr_u = 0;	//<uint8_t>
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
			exit("\oms\ordersize\po\OrderSizePo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\oms\ordersize\po\OrderSizePo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t>  鐗堟湰鍙�
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint64_t($this->id);	//<uint64_t>  ID, 涓� OrderPo 閲岀殑 id 鏄搴旂殑,蹇呭～ 
		$bs->pushUint8_t($this->id_u);	//<uint8_t> 
		$bs->pushUint32_t($this->orderSize);	//<uint32_t> 璁㈠崟绫诲瀷(澶т欢璁㈠崟銆佷腑浠惰鍗曘�灏忎欢璁㈠崟) 
		$bs->pushUint8_t($this->orderSize_u);	//<uint8_t> 
		$bs->pushUint64_t($this->orderVolume);	//<uint64_t>  璁㈠崟鎬讳綋绉�绔嬫柟鍘樼背
		$bs->pushUint8_t($this->orderVolume_u);	//<uint8_t> 
		$bs->pushUint64_t($this->orderWeight);	//<uint64_t>  璁㈠崟鎬婚噸閲�鍏�
		$bs->pushUint8_t($this->orderWeight_u);	//<uint8_t> 
		$bs->pushUint64_t($this->orderMaxlength);	//<uint64_t>  璁㈠崟鏈�暱杈�姣背 
		$bs->pushUint8_t($this->orderMaxlength_u);	//<uint8_t> 
		$bs->pushUint32_t($this->infoErrCode);	//<uint32_t>  濡傛灉閮ㄥ垎鍟嗗搧涓嶅瓨鍦�鎴栬�鍟嗗搧鐨勫昂瀵镐俊鎭笉瀛樺湪,杩斿洖鐗瑰畾鐨勯敊璇爜
		$bs->pushUint8_t($this->infoErrCode_u);	//<uint8_t> 
		$bs->pushUint64_t($this->reserveDdw);	//<uint64_t> 淇濈暀瀛楁dw
		$bs->pushUint8_t($this->reserveDdw_u);	//<uint8_t> 
		$bs->pushString($this->reserveStr);	//<std::string> 淇濈暀瀛楁str
		$bs->pushUint8_t($this->reserveStr_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  鐗堟湰鍙�
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['id'] = $bs->popUint64_t();	//<uint64_t>  ID, 涓� OrderPo 閲岀殑 id 鏄搴旂殑,蹇呭～ 
		$this->_arr_value['id_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['orderSize'] = $bs->popUint32_t();	//<uint32_t> 璁㈠崟绫诲瀷(澶т欢璁㈠崟銆佷腑浠惰鍗曘�灏忎欢璁㈠崟) 
		$this->_arr_value['orderSize_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['orderVolume'] = $bs->popUint64_t();	//<uint64_t>  璁㈠崟鎬讳綋绉�绔嬫柟鍘樼背
		$this->_arr_value['orderVolume_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['orderWeight'] = $bs->popUint64_t();	//<uint64_t>  璁㈠崟鎬婚噸閲�鍏�
		$this->_arr_value['orderWeight_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['orderMaxlength'] = $bs->popUint64_t();	//<uint64_t>  璁㈠崟鏈�暱杈�姣背 
		$this->_arr_value['orderMaxlength_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['infoErrCode'] = $bs->popUint32_t();	//<uint32_t>  濡傛灉閮ㄥ垎鍟嗗搧涓嶅瓨鍦�鎴栬�鍟嗗搧鐨勫昂瀵镐俊鎭笉瀛樺湪,杩斿洖鐗瑰畾鐨勯敊璇爜
		$this->_arr_value['infoErrCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserveDdw'] = $bs->popUint64_t();	//<uint64_t> 淇濈暀瀛楁dw
		$this->_arr_value['reserveDdw_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserveStr'] = $bs->popString();	//<std::string> 淇濈暀瀛楁str
		$this->_arr_value['reserveStr_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\deal\bo;	//source idl: com.icson.deal.idl.ShippingAo.java
if (!class_exists('icson\deal\bo\GiftInfo4Shipping', false)) {
class GiftInfo4Shipping{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 协议版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $giftWeight;	//<uint32_t> 赠品重量(版本>=0)
	private $giftWeight_u;	//<uint8_t> (版本>=0)
	private $stockNum;	//<uint32_t> 库存量(版本>=0)
	private $stockNum_u;	//<uint8_t> (版本>=0)
	private $giftNum;	//<uint32_t> 有效赠送数量（库存>赠送数量*主商品购买数 ? 赠送数量*主商品购买数 : 库存数 ）(版本>=0)
	private $giftNum_u;	//<uint8_t> (版本>=0)
	private $sizeInfo;	//<oms::ordersize::po::CProductUnitPo> 商品长宽高重信息(版本>=1)
	private $sizeInfo_u;	//<uint8_t> (版本>=1)

	function __construct(){
		$this->version = 1;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->giftWeight = 0;	//<uint32_t>
		$this->giftWeight_u = 0;	//<uint8_t>
		$this->stockNum = 0;	//<uint32_t>
		$this->stockNum_u = 0;	//<uint8_t>
		$this->giftNum = 0;	//<uint32_t>
		$this->giftNum_u = 0;	//<uint8_t>
		$this->sizeInfo = new \oms\ordersize\po\ProductUnitPo();	//<oms::ordersize::po::CProductUnitPo>
		$this->sizeInfo_u = 0;	//<uint8_t>
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
			exit("\icson\deal\bo\GiftInfo4Shipping\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\bo\GiftInfo4Shipping\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 协议版本号
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->giftWeight);	//<uint32_t> 赠品重量
		$bs->pushUint8_t($this->giftWeight_u);	//<uint8_t> 
		$bs->pushUint32_t($this->stockNum);	//<uint32_t> 库存量
		$bs->pushUint8_t($this->stockNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->giftNum);	//<uint32_t> 有效赠送数量（库存>赠送数量*主商品购买数 ? 赠送数量*主商品购买数 : 库存数 ）
		$bs->pushUint8_t($this->giftNum_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushObject($this->sizeInfo,'\oms\ordersize\po\ProductUnitPo');	//<oms::ordersize::po::CProductUnitPo> 商品长宽高重信息
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->sizeInfo_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 协议版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['giftWeight'] = $bs->popUint32_t();	//<uint32_t> 赠品重量
		$this->_arr_value['giftWeight_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockNum'] = $bs->popUint32_t();	//<uint32_t> 库存量
		$this->_arr_value['stockNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['giftNum'] = $bs->popUint32_t();	//<uint32_t> 有效赠送数量（库存>赠送数量*主商品购买数 ? 赠送数量*主商品购买数 : 库存数 ）
		$this->_arr_value['giftNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['sizeInfo'] = $bs->popObject('\oms\ordersize\po\ProductUnitPo');	//<oms::ordersize::po::CProductUnitPo> 商品长宽高重信息
		}
		if($this->version >= 1){
			$this->_arr_value['sizeInfo_u'] = $bs->popUint8_t();	//<uint8_t> 
		}

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

namespace oms\ordersize\po;	//source idl: com.icson.deal.idl.GiftInfo4Shipping.java
if (!class_exists('oms\ordersize\po\ProductUnitPo', false)) {
class ProductUnitPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  鐗堟湰鍙�(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $productSysno;	//<uint64_t>  鍟嗗搧ID,蹇呭～ (版本>=0)
	private $productSysno_u;	//<uint8_t> (版本>=0)
	private $productNum;	//<uint32_t>  鍟嗗搧鏁伴噺,蹇呭～(版本>=0)
	private $productNum_u;	//<uint8_t> (版本>=0)
	private $productLength;	//<uint64_t> 鍟嗗搧闀垮害,鍗曚綅姣背(版本>=0)
	private $productLength_u;	//<uint8_t> (版本>=0)
	private $productWidth;	//<uint64_t> 鍟嗗搧瀹藉害,鍗曚綅姣背(版本>=0)
	private $productWidth_u;	//<uint8_t> (版本>=0)
	private $productHeight;	//<uint64_t> 鍟嗗搧楂樺害,鍗曚綅姣背(版本>=0)
	private $productHeight_u;	//<uint8_t> (版本>=0)
	private $productWeight;	//<uint32_t> 鍟嗗搧  閲嶉噺 鍏� (版本>=0)
	private $productWeight_u;	//<uint8_t> (版本>=0)
	private $reserveDdw;	//<uint64_t> 淇濈暀瀛楁dw(版本>=0)
	private $reserveDdw_u;	//<uint8_t> (版本>=0)
	private $reserveStr;	//<std::string> 淇濈暀瀛楁str(版本>=0)
	private $reserveStr_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->productSysno = 0;	//<uint64_t>
		$this->productSysno_u = 0;	//<uint8_t>
		$this->productNum = 0;	//<uint32_t>
		$this->productNum_u = 0;	//<uint8_t>
		$this->productLength = 0;	//<uint64_t>
		$this->productLength_u = 0;	//<uint8_t>
		$this->productWidth = 0;	//<uint64_t>
		$this->productWidth_u = 0;	//<uint8_t>
		$this->productHeight = 0;	//<uint64_t>
		$this->productHeight_u = 0;	//<uint8_t>
		$this->productWeight = 0;	//<uint32_t>
		$this->productWeight_u = 0;	//<uint8_t>
		$this->reserveDdw = 0;	//<uint64_t>
		$this->reserveDdw_u = 0;	//<uint8_t>
		$this->reserveStr = "";	//<std::string>
		$this->reserveStr_u = 0;	//<uint8_t>
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
			exit("\oms\ordersize\po\ProductUnitPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\oms\ordersize\po\ProductUnitPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t>  鐗堟湰鍙�
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint64_t($this->productSysno);	//<uint64_t>  鍟嗗搧ID,蹇呭～ 
		$bs->pushUint8_t($this->productSysno_u);	//<uint8_t> 
		$bs->pushUint32_t($this->productNum);	//<uint32_t>  鍟嗗搧鏁伴噺,蹇呭～
		$bs->pushUint8_t($this->productNum_u);	//<uint8_t> 
		$bs->pushUint64_t($this->productLength);	//<uint64_t> 鍟嗗搧闀垮害,鍗曚綅姣背
		$bs->pushUint8_t($this->productLength_u);	//<uint8_t> 
		$bs->pushUint64_t($this->productWidth);	//<uint64_t> 鍟嗗搧瀹藉害,鍗曚綅姣背
		$bs->pushUint8_t($this->productWidth_u);	//<uint8_t> 
		$bs->pushUint64_t($this->productHeight);	//<uint64_t> 鍟嗗搧楂樺害,鍗曚綅姣背
		$bs->pushUint8_t($this->productHeight_u);	//<uint8_t> 
		$bs->pushUint32_t($this->productWeight);	//<uint32_t> 鍟嗗搧  閲嶉噺 鍏� 
		$bs->pushUint8_t($this->productWeight_u);	//<uint8_t> 
		$bs->pushUint64_t($this->reserveDdw);	//<uint64_t> 淇濈暀瀛楁dw
		$bs->pushUint8_t($this->reserveDdw_u);	//<uint8_t> 
		$bs->pushString($this->reserveStr);	//<std::string> 淇濈暀瀛楁str
		$bs->pushUint8_t($this->reserveStr_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  鐗堟湰鍙�
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productSysno'] = $bs->popUint64_t();	//<uint64_t>  鍟嗗搧ID,蹇呭～ 
		$this->_arr_value['productSysno_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productNum'] = $bs->popUint32_t();	//<uint32_t>  鍟嗗搧鏁伴噺,蹇呭～
		$this->_arr_value['productNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productLength'] = $bs->popUint64_t();	//<uint64_t> 鍟嗗搧闀垮害,鍗曚綅姣背
		$this->_arr_value['productLength_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productWidth'] = $bs->popUint64_t();	//<uint64_t> 鍟嗗搧瀹藉害,鍗曚綅姣背
		$this->_arr_value['productWidth_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productHeight'] = $bs->popUint64_t();	//<uint64_t> 鍟嗗搧楂樺害,鍗曚綅姣背
		$this->_arr_value['productHeight_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productWeight'] = $bs->popUint32_t();	//<uint32_t> 鍟嗗搧  閲嶉噺 鍏� 
		$this->_arr_value['productWeight_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserveDdw'] = $bs->popUint64_t();	//<uint64_t> 淇濈暀瀛楁dw
		$this->_arr_value['reserveDdw_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserveStr'] = $bs->popString();	//<std::string> 淇濈暀瀛楁str
		$this->_arr_value['reserveStr_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\deal\bo;	//source idl: com.icson.deal.idl.ShippingAo.java
if (!class_exists('icson\deal\bo\ExpectDate', false)) {
class ExpectDate{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 协议版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $sellerId;	//<uint32_t> 卖家ID(版本>=0)
	private $sellerId_u;	//<uint8_t> (版本>=0)
	private $sellerStockId;	//<uint32_t> 商户地址(仓)ID，新联营特性(版本>=0)
	private $sellerStockId_u;	//<uint8_t> (版本>=0)
	private $psyStockId;	//<uint32_t> 配送仓ID(版本>=0)
	private $psyStockId_u;	//<uint8_t> (版本>=0)
	private $shipDate;	//<std::string> 期望配送日期(版本>=0)
	private $shipDate_u;	//<uint8_t> (版本>=0)
	private $shipSpan;	//<uint32_t> 期望配送时段(版本>=0)
	private $shipSpan_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->sellerId = 0;	//<uint32_t>
		$this->sellerId_u = 0;	//<uint8_t>
		$this->sellerStockId = 0;	//<uint32_t>
		$this->sellerStockId_u = 0;	//<uint8_t>
		$this->psyStockId = 0;	//<uint32_t>
		$this->psyStockId_u = 0;	//<uint8_t>
		$this->shipDate = "";	//<std::string>
		$this->shipDate_u = 0;	//<uint8_t>
		$this->shipSpan = 0;	//<uint32_t>
		$this->shipSpan_u = 0;	//<uint8_t>
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
			exit("\icson\deal\bo\ExpectDate\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\bo\ExpectDate\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 协议版本号
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->sellerId);	//<uint32_t> 卖家ID
		$bs->pushUint8_t($this->sellerId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->sellerStockId);	//<uint32_t> 商户地址(仓)ID，新联营特性
		$bs->pushUint8_t($this->sellerStockId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->psyStockId);	//<uint32_t> 配送仓ID
		$bs->pushUint8_t($this->psyStockId_u);	//<uint8_t> 
		$bs->pushString($this->shipDate);	//<std::string> 期望配送日期
		$bs->pushUint8_t($this->shipDate_u);	//<uint8_t> 
		$bs->pushUint32_t($this->shipSpan);	//<uint32_t> 期望配送时段
		$bs->pushUint8_t($this->shipSpan_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 协议版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerId'] = $bs->popUint32_t();	//<uint32_t> 卖家ID
		$this->_arr_value['sellerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerStockId'] = $bs->popUint32_t();	//<uint32_t> 商户地址(仓)ID，新联营特性
		$this->_arr_value['sellerStockId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['psyStockId'] = $bs->popUint32_t();	//<uint32_t> 配送仓ID
		$this->_arr_value['psyStockId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shipDate'] = $bs->popString();	//<std::string> 期望配送日期
		$this->_arr_value['shipDate_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shipSpan'] = $bs->popUint32_t();	//<uint32_t> 期望配送时段
		$this->_arr_value['shipSpan_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\deal\bo;	//source idl: com.icson.deal.idl.ShippingAo.java
if (!class_exists('icson\deal\bo\BaseShippingInfo', false)) {
class BaseShippingInfo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 协议版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $stockDesc;	//<std::string> 配送描述（有货，当日可出库，支持货到付款...）(版本>=0)
	private $stockDesc_u;	//<uint8_t> (版本>=0)
	private $stockStatus;	//<uint32_t> 库存状态(版本>=0)
	private $stockStatus_u;	//<uint8_t> (版本>=0)
	private $isCod;	//<uint32_t> 是否支持货到付款，1/0:支持/不支持(版本>=0)
	private $isCod_u;	//<uint8_t> (版本>=0)
	private $delay;	//<icson::deal::bo::CDelayInfo> 延迟信息(版本>=0)
	private $delay_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->stockDesc = "";	//<std::string>
		$this->stockDesc_u = 0;	//<uint8_t>
		$this->stockStatus = 0;	//<uint32_t>
		$this->stockStatus_u = 0;	//<uint8_t>
		$this->isCod = 0;	//<uint32_t>
		$this->isCod_u = 0;	//<uint8_t>
		$this->delay = new \icson\deal\bo\DelayInfo();	//<icson::deal::bo::CDelayInfo>
		$this->delay_u = 0;	//<uint8_t>
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
			exit("\icson\deal\bo\BaseShippingInfo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\bo\BaseShippingInfo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 协议版本号
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushString($this->stockDesc);	//<std::string> 配送描述（有货，当日可出库，支持货到付款...）
		$bs->pushUint8_t($this->stockDesc_u);	//<uint8_t> 
		$bs->pushUint32_t($this->stockStatus);	//<uint32_t> 库存状态
		$bs->pushUint8_t($this->stockStatus_u);	//<uint8_t> 
		$bs->pushUint32_t($this->isCod);	//<uint32_t> 是否支持货到付款，1/0:支持/不支持
		$bs->pushUint8_t($this->isCod_u);	//<uint8_t> 
		$bs->pushObject($this->delay,'\icson\deal\bo\DelayInfo');	//<icson::deal::bo::CDelayInfo> 延迟信息
		$bs->pushUint8_t($this->delay_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 协议版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockDesc'] = $bs->popString();	//<std::string> 配送描述（有货，当日可出库，支持货到付款...）
		$this->_arr_value['stockDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockStatus'] = $bs->popUint32_t();	//<uint32_t> 库存状态
		$this->_arr_value['stockStatus_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['isCod'] = $bs->popUint32_t();	//<uint32_t> 是否支持货到付款，1/0:支持/不支持
		$this->_arr_value['isCod_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['delay'] = $bs->popObject('\icson\deal\bo\DelayInfo');	//<icson::deal::bo::CDelayInfo> 延迟信息
		$this->_arr_value['delay_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\deal\bo;	//source idl: com.icson.deal.idl.BaseShippingInfo.java
if (!class_exists('icson\deal\bo\DelayInfo', false)) {
class DelayInfo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 协议版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $delayType;	//<uint32_t> 延迟类型(版本>=0)
	private $delayType_u;	//<uint8_t> (版本>=0)
	private $delayValue;	//<uint32_t> 延迟值 vValue(版本>=0)
	private $delayValue_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->delayType = 0;	//<uint32_t>
		$this->delayType_u = 0;	//<uint8_t>
		$this->delayValue = 0;	//<uint32_t>
		$this->delayValue_u = 0;	//<uint8_t>
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
			exit("\icson\deal\bo\DelayInfo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\bo\DelayInfo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 协议版本号
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->delayType);	//<uint32_t> 延迟类型
		$bs->pushUint8_t($this->delayType_u);	//<uint8_t> 
		$bs->pushUint32_t($this->delayValue);	//<uint32_t> 延迟值 vValue
		$bs->pushUint8_t($this->delayValue_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 协议版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['delayType'] = $bs->popUint32_t();	//<uint32_t> 延迟类型
		$this->_arr_value['delayType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['delayValue'] = $bs->popUint32_t();	//<uint32_t> 延迟值 vValue
		$this->_arr_value['delayValue_u'] = $bs->popUint8_t();	//<uint8_t> 

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
