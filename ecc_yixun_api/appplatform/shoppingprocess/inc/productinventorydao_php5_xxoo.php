<?php
namespace icson\deal\bo;	//source idl: com.icson.deal.idl.GetProductInfoResp.java
if (!class_exists('icson\deal\bo\ProductInfo', false)) {
class ProductInfo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 协议版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $productId;	//<uint32_t> 商品id(版本>=0)
	private $productId_u;	//<uint8_t> (版本>=0)
	private $whId;	//<uint32_t> 分站id(版本>=0)
	private $whId_u;	//<uint8_t> (版本>=0)
	private $flag;	//<int> 标志位(版本>=0)
	private $flag_u;	//<uint8_t> (版本>=0)
	private $type;	//<int> type(版本>=0)
	private $type_u;	//<uint8_t> (版本>=0)
	private $type2;	//<int> type2(版本>=0)
	private $type2_u;	//<uint8_t> (版本>=0)
	private $status;	//<int> 状态(版本>=0)
	private $status_u;	//<uint8_t> (版本>=0)
	private $restrictedTransType;	//<int> 限运类型(版本>=0)
	private $restrictedTransType_u;	//<uint8_t> (版本>=0)
	private $onShelfTime;	//<uint32_t> 在架时间(版本>=0)
	private $onShelfTime_u;	//<uint8_t> (版本>=0)
	private $promotionWord;	//<std::string> 促销语(版本>=0)
	private $promotionWord_u;	//<uint8_t> (版本>=0)
	private $promotionStart;	//<uint32_t> 促销开始时间(版本>=0)
	private $promotionStart_u;	//<uint8_t> (版本>=0)
	private $promotionEnd;	//<uint32_t> 促销结束时间(版本>=0)
	private $promotionEnd_u;	//<uint8_t> (版本>=0)
	private $availableNum;	//<int> 可用库存(版本>=0)
	private $availableNum_u;	//<uint8_t> (版本>=0)
	private $virtualNum;	//<int> 虚拟库存(版本>=0)
	private $virtualNum_u;	//<uint8_t> (版本>=0)
	private $arrivalDays;	//<int> arrival_days(版本>=0)
	private $arrivalDays_u;	//<uint8_t> (版本>=0)
	private $marketPrice;	//<int> 市场价(版本>=0)
	private $marketPrice_u;	//<uint8_t> (版本>=0)
	private $price;	//<int> 价格(版本>=0)
	private $price_u;	//<uint8_t> (版本>=0)
	private $cashBack;	//<int> 返现(版本>=0)
	private $cashBack_u;	//<uint8_t> (版本>=0)
	private $costPrice;	//<int> cost_price(版本>=0)
	private $costPrice_u;	//<uint8_t> (版本>=0)
	private $numLimit;	//<int> 限制数量(版本>=0)
	private $numLimit_u;	//<uint8_t> (版本>=0)
	private $isClearWh;	//<int> is_clear_wh(版本>=0)
	private $isClearWh_u;	//<uint8_t> (版本>=0)
	private $pointType;	//<int> point_type(版本>=0)
	private $pointType_u;	//<uint8_t> (版本>=0)
	private $point;	//<int> point(版本>=0)
	private $point_u;	//<uint8_t> (版本>=0)
	private $vipPrice;	//<std::string> vip价格(版本>=0)
	private $vipPrice_u;	//<uint8_t> (版本>=0)
	private $updateTime;	//<uint32_t> 更新时间(版本>=0)
	private $updateTime_u;	//<uint8_t> (版本>=0)
	private $psyStock;	//<uint32_t> psystock(版本>=0)
	private $psyStock_u;	//<uint8_t> (版本>=0)
	private $multiPriceType;	//<int> 多价类型(版本>=0)
	private $multiPriceType_u;	//<uint8_t> (版本>=0)
	private $productSaleType;	//<int> product_sale_type(版本>=0)
	private $productSaleType_u;	//<uint8_t> (版本>=0)
	private $businessUnitCostPrice;	//<int> business_unit_cost_price(版本>=0)
	private $businessUnitCostPrice_u;	//<uint8_t> (版本>=0)
	private $saleModel;	//<int> sale_model(版本>=0)
	private $saleModel_u;	//<uint8_t> (版本>=0)
	private $lowestNum;	//<int> lowest_num(版本>=0)
	private $lowestNum_u;	//<uint8_t> (版本>=0)
	private $bookingType;	//<int> booking_type(版本>=0)
	private $bookingType_u;	//<uint8_t> (版本>=0)
	private $bookingValue;	//<std::string> booking_value(版本>=0)
	private $bookingValue_u;	//<uint8_t> (版本>=0)
	private $c3Ids;	//<std::string> 三级类目id(版本>=0)
	private $c3Ids_u;	//<uint8_t> (版本>=0)
	private $productCharId;	//<std::string> product_char_id(版本>=0)
	private $productCharId_u;	//<uint8_t> (版本>=0)
	private $mode;	//<std::string> mode(版本>=0)
	private $mode_u;	//<uint8_t> (版本>=0)
	private $name;	//<std::string> 名字(版本>=0)
	private $name_u;	//<uint8_t> (版本>=0)
	private $weight;	//<uint32_t> 重量(版本>=0)
	private $weight_u;	//<uint8_t> (版本>=0)
	private $picNum;	//<uint32_t> 图片数量(版本>=0)
	private $picNum_u;	//<uint8_t> (版本>=0)
	private $barcode;	//<std::string> barcode(版本>=0)
	private $barcode_u;	//<uint8_t> (版本>=0)
	private $color;	//<int> 颜色(版本>=0)
	private $color_u;	//<uint8_t> (版本>=0)
	private $productSize;	//<int> 尺码(版本>=0)
	private $productSize_u;	//<uint8_t> (版本>=0)
	private $manufacturer;	//<int> manufacturer(版本>=0)
	private $manufacturer_u;	//<uint8_t> (版本>=0)
	private $warranty;	//<std::string> warranty(版本>=0)
	private $warranty_u;	//<uint8_t> (版本>=0)
	private $masterid;	//<uint32_t> masterid(版本>=0)
	private $masterid_u;	//<uint8_t> (版本>=0)
	private $sellerAddressId;	//<int> 卖家仓(地址)id(版本>=1)
	private $sellerAddressId_u;	//<uint8_t> (版本>=1)
	private $sellerId;	//<int> 卖家id(版本>=1)
	private $sellerId_u;	//<uint8_t> (版本>=1)

	function __construct(){
		$this->version = 1;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->productId = 0;	//<uint32_t>
		$this->productId_u = 0;	//<uint8_t>
		$this->whId = 0;	//<uint32_t>
		$this->whId_u = 0;	//<uint8_t>
		$this->flag = 0;	//<int>
		$this->flag_u = 0;	//<uint8_t>
		$this->type = 0;	//<int>
		$this->type_u = 0;	//<uint8_t>
		$this->type2 = 0;	//<int>
		$this->type2_u = 0;	//<uint8_t>
		$this->status = 0;	//<int>
		$this->status_u = 0;	//<uint8_t>
		$this->restrictedTransType = 0;	//<int>
		$this->restrictedTransType_u = 0;	//<uint8_t>
		$this->onShelfTime = 0;	//<uint32_t>
		$this->onShelfTime_u = 0;	//<uint8_t>
		$this->promotionWord = "";	//<std::string>
		$this->promotionWord_u = 0;	//<uint8_t>
		$this->promotionStart = 0;	//<uint32_t>
		$this->promotionStart_u = 0;	//<uint8_t>
		$this->promotionEnd = 0;	//<uint32_t>
		$this->promotionEnd_u = 0;	//<uint8_t>
		$this->availableNum = 0;	//<int>
		$this->availableNum_u = 0;	//<uint8_t>
		$this->virtualNum = 0;	//<int>
		$this->virtualNum_u = 0;	//<uint8_t>
		$this->arrivalDays = 0;	//<int>
		$this->arrivalDays_u = 0;	//<uint8_t>
		$this->marketPrice = 0;	//<int>
		$this->marketPrice_u = 0;	//<uint8_t>
		$this->price = 0;	//<int>
		$this->price_u = 0;	//<uint8_t>
		$this->cashBack = 0;	//<int>
		$this->cashBack_u = 0;	//<uint8_t>
		$this->costPrice = 0;	//<int>
		$this->costPrice_u = 0;	//<uint8_t>
		$this->numLimit = 0;	//<int>
		$this->numLimit_u = 0;	//<uint8_t>
		$this->isClearWh = 0;	//<int>
		$this->isClearWh_u = 0;	//<uint8_t>
		$this->pointType = 0;	//<int>
		$this->pointType_u = 0;	//<uint8_t>
		$this->point = 0;	//<int>
		$this->point_u = 0;	//<uint8_t>
		$this->vipPrice = "";	//<std::string>
		$this->vipPrice_u = 0;	//<uint8_t>
		$this->updateTime = 0;	//<uint32_t>
		$this->updateTime_u = 0;	//<uint8_t>
		$this->psyStock = 0;	//<uint32_t>
		$this->psyStock_u = 0;	//<uint8_t>
		$this->multiPriceType = 0;	//<int>
		$this->multiPriceType_u = 0;	//<uint8_t>
		$this->productSaleType = 0;	//<int>
		$this->productSaleType_u = 0;	//<uint8_t>
		$this->businessUnitCostPrice = 0;	//<int>
		$this->businessUnitCostPrice_u = 0;	//<uint8_t>
		$this->saleModel = 0;	//<int>
		$this->saleModel_u = 0;	//<uint8_t>
		$this->lowestNum = 0;	//<int>
		$this->lowestNum_u = 0;	//<uint8_t>
		$this->bookingType = 0;	//<int>
		$this->bookingType_u = 0;	//<uint8_t>
		$this->bookingValue = "";	//<std::string>
		$this->bookingValue_u = 0;	//<uint8_t>
		$this->c3Ids = "";	//<std::string>
		$this->c3Ids_u = 0;	//<uint8_t>
		$this->productCharId = "";	//<std::string>
		$this->productCharId_u = 0;	//<uint8_t>
		$this->mode = "";	//<std::string>
		$this->mode_u = 0;	//<uint8_t>
		$this->name = "";	//<std::string>
		$this->name_u = 0;	//<uint8_t>
		$this->weight = 0;	//<uint32_t>
		$this->weight_u = 0;	//<uint8_t>
		$this->picNum = 0;	//<uint32_t>
		$this->picNum_u = 0;	//<uint8_t>
		$this->barcode = "";	//<std::string>
		$this->barcode_u = 0;	//<uint8_t>
		$this->color = 0;	//<int>
		$this->color_u = 0;	//<uint8_t>
		$this->productSize = 0;	//<int>
		$this->productSize_u = 0;	//<uint8_t>
		$this->manufacturer = 0;	//<int>
		$this->manufacturer_u = 0;	//<uint8_t>
		$this->warranty = "";	//<std::string>
		$this->warranty_u = 0;	//<uint8_t>
		$this->masterid = 0;	//<uint32_t>
		$this->masterid_u = 0;	//<uint8_t>
		$this->sellerAddressId = 0;	//<int>
		$this->sellerAddressId_u = 0;	//<uint8_t>
		$this->sellerId = 0;	//<int>
		$this->sellerId_u = 0;	//<uint8_t>
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
			exit("\icson\deal\bo\ProductInfo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\bo\ProductInfo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->whId);	//<uint32_t> 分站id
		$bs->pushUint8_t($this->whId_u);	//<uint8_t> 
		$bs->pushInt32_t($this->flag);	//<int> 标志位
		$bs->pushUint8_t($this->flag_u);	//<uint8_t> 
		$bs->pushInt32_t($this->type);	//<int> type
		$bs->pushUint8_t($this->type_u);	//<uint8_t> 
		$bs->pushInt32_t($this->type2);	//<int> type2
		$bs->pushUint8_t($this->type2_u);	//<uint8_t> 
		$bs->pushInt32_t($this->status);	//<int> 状态
		$bs->pushUint8_t($this->status_u);	//<uint8_t> 
		$bs->pushInt32_t($this->restrictedTransType);	//<int> 限运类型
		$bs->pushUint8_t($this->restrictedTransType_u);	//<uint8_t> 
		$bs->pushUint32_t($this->onShelfTime);	//<uint32_t> 在架时间
		$bs->pushUint8_t($this->onShelfTime_u);	//<uint8_t> 
		$bs->pushString($this->promotionWord);	//<std::string> 促销语
		$bs->pushUint8_t($this->promotionWord_u);	//<uint8_t> 
		$bs->pushUint32_t($this->promotionStart);	//<uint32_t> 促销开始时间
		$bs->pushUint8_t($this->promotionStart_u);	//<uint8_t> 
		$bs->pushUint32_t($this->promotionEnd);	//<uint32_t> 促销结束时间
		$bs->pushUint8_t($this->promotionEnd_u);	//<uint8_t> 
		$bs->pushInt32_t($this->availableNum);	//<int> 可用库存
		$bs->pushUint8_t($this->availableNum_u);	//<uint8_t> 
		$bs->pushInt32_t($this->virtualNum);	//<int> 虚拟库存
		$bs->pushUint8_t($this->virtualNum_u);	//<uint8_t> 
		$bs->pushInt32_t($this->arrivalDays);	//<int> arrival_days
		$bs->pushUint8_t($this->arrivalDays_u);	//<uint8_t> 
		$bs->pushInt32_t($this->marketPrice);	//<int> 市场价
		$bs->pushUint8_t($this->marketPrice_u);	//<uint8_t> 
		$bs->pushInt32_t($this->price);	//<int> 价格
		$bs->pushUint8_t($this->price_u);	//<uint8_t> 
		$bs->pushInt32_t($this->cashBack);	//<int> 返现
		$bs->pushUint8_t($this->cashBack_u);	//<uint8_t> 
		$bs->pushInt32_t($this->costPrice);	//<int> cost_price
		$bs->pushUint8_t($this->costPrice_u);	//<uint8_t> 
		$bs->pushInt32_t($this->numLimit);	//<int> 限制数量
		$bs->pushUint8_t($this->numLimit_u);	//<uint8_t> 
		$bs->pushInt32_t($this->isClearWh);	//<int> is_clear_wh
		$bs->pushUint8_t($this->isClearWh_u);	//<uint8_t> 
		$bs->pushInt32_t($this->pointType);	//<int> point_type
		$bs->pushUint8_t($this->pointType_u);	//<uint8_t> 
		$bs->pushInt32_t($this->point);	//<int> point
		$bs->pushUint8_t($this->point_u);	//<uint8_t> 
		$bs->pushString($this->vipPrice);	//<std::string> vip价格
		$bs->pushUint8_t($this->vipPrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->updateTime);	//<uint32_t> 更新时间
		$bs->pushUint8_t($this->updateTime_u);	//<uint8_t> 
		$bs->pushUint32_t($this->psyStock);	//<uint32_t> psystock
		$bs->pushUint8_t($this->psyStock_u);	//<uint8_t> 
		$bs->pushInt32_t($this->multiPriceType);	//<int> 多价类型
		$bs->pushUint8_t($this->multiPriceType_u);	//<uint8_t> 
		$bs->pushInt32_t($this->productSaleType);	//<int> product_sale_type
		$bs->pushUint8_t($this->productSaleType_u);	//<uint8_t> 
		$bs->pushInt32_t($this->businessUnitCostPrice);	//<int> business_unit_cost_price
		$bs->pushUint8_t($this->businessUnitCostPrice_u);	//<uint8_t> 
		$bs->pushInt32_t($this->saleModel);	//<int> sale_model
		$bs->pushUint8_t($this->saleModel_u);	//<uint8_t> 
		$bs->pushInt32_t($this->lowestNum);	//<int> lowest_num
		$bs->pushUint8_t($this->lowestNum_u);	//<uint8_t> 
		$bs->pushInt32_t($this->bookingType);	//<int> booking_type
		$bs->pushUint8_t($this->bookingType_u);	//<uint8_t> 
		$bs->pushString($this->bookingValue);	//<std::string> booking_value
		$bs->pushUint8_t($this->bookingValue_u);	//<uint8_t> 
		$bs->pushString($this->c3Ids);	//<std::string> 三级类目id
		$bs->pushUint8_t($this->c3Ids_u);	//<uint8_t> 
		$bs->pushString($this->productCharId);	//<std::string> product_char_id
		$bs->pushUint8_t($this->productCharId_u);	//<uint8_t> 
		$bs->pushString($this->mode);	//<std::string> mode
		$bs->pushUint8_t($this->mode_u);	//<uint8_t> 
		$bs->pushString($this->name);	//<std::string> 名字
		$bs->pushUint8_t($this->name_u);	//<uint8_t> 
		$bs->pushUint32_t($this->weight);	//<uint32_t> 重量
		$bs->pushUint8_t($this->weight_u);	//<uint8_t> 
		$bs->pushUint32_t($this->picNum);	//<uint32_t> 图片数量
		$bs->pushUint8_t($this->picNum_u);	//<uint8_t> 
		$bs->pushString($this->barcode);	//<std::string> barcode
		$bs->pushUint8_t($this->barcode_u);	//<uint8_t> 
		$bs->pushInt32_t($this->color);	//<int> 颜色
		$bs->pushUint8_t($this->color_u);	//<uint8_t> 
		$bs->pushInt32_t($this->productSize);	//<int> 尺码
		$bs->pushUint8_t($this->productSize_u);	//<uint8_t> 
		$bs->pushInt32_t($this->manufacturer);	//<int> manufacturer
		$bs->pushUint8_t($this->manufacturer_u);	//<uint8_t> 
		$bs->pushString($this->warranty);	//<std::string> warranty
		$bs->pushUint8_t($this->warranty_u);	//<uint8_t> 
		$bs->pushUint32_t($this->masterid);	//<uint32_t> masterid
		$bs->pushUint8_t($this->masterid_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushInt32_t($this->sellerAddressId);	//<int> 卖家仓(地址)id
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->sellerAddressId_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushInt32_t($this->sellerId);	//<int> 卖家id
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->sellerId_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 协议版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productId'] = $bs->popUint32_t();	//<uint32_t> 商品id
		$this->_arr_value['productId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['whId'] = $bs->popUint32_t();	//<uint32_t> 分站id
		$this->_arr_value['whId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['flag'] = $bs->popInt32_t();	//<int> 标志位
		$this->_arr_value['flag_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['type'] = $bs->popInt32_t();	//<int> type
		$this->_arr_value['type_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['type2'] = $bs->popInt32_t();	//<int> type2
		$this->_arr_value['type2_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['status'] = $bs->popInt32_t();	//<int> 状态
		$this->_arr_value['status_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['restrictedTransType'] = $bs->popInt32_t();	//<int> 限运类型
		$this->_arr_value['restrictedTransType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['onShelfTime'] = $bs->popUint32_t();	//<uint32_t> 在架时间
		$this->_arr_value['onShelfTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['promotionWord'] = $bs->popString();	//<std::string> 促销语
		$this->_arr_value['promotionWord_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['promotionStart'] = $bs->popUint32_t();	//<uint32_t> 促销开始时间
		$this->_arr_value['promotionStart_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['promotionEnd'] = $bs->popUint32_t();	//<uint32_t> 促销结束时间
		$this->_arr_value['promotionEnd_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['availableNum'] = $bs->popInt32_t();	//<int> 可用库存
		$this->_arr_value['availableNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['virtualNum'] = $bs->popInt32_t();	//<int> 虚拟库存
		$this->_arr_value['virtualNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['arrivalDays'] = $bs->popInt32_t();	//<int> arrival_days
		$this->_arr_value['arrivalDays_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['marketPrice'] = $bs->popInt32_t();	//<int> 市场价
		$this->_arr_value['marketPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['price'] = $bs->popInt32_t();	//<int> 价格
		$this->_arr_value['price_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cashBack'] = $bs->popInt32_t();	//<int> 返现
		$this->_arr_value['cashBack_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['costPrice'] = $bs->popInt32_t();	//<int> cost_price
		$this->_arr_value['costPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['numLimit'] = $bs->popInt32_t();	//<int> 限制数量
		$this->_arr_value['numLimit_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['isClearWh'] = $bs->popInt32_t();	//<int> is_clear_wh
		$this->_arr_value['isClearWh_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['pointType'] = $bs->popInt32_t();	//<int> point_type
		$this->_arr_value['pointType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['point'] = $bs->popInt32_t();	//<int> point
		$this->_arr_value['point_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['vipPrice'] = $bs->popString();	//<std::string> vip价格
		$this->_arr_value['vipPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['updateTime'] = $bs->popUint32_t();	//<uint32_t> 更新时间
		$this->_arr_value['updateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['psyStock'] = $bs->popUint32_t();	//<uint32_t> psystock
		$this->_arr_value['psyStock_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['multiPriceType'] = $bs->popInt32_t();	//<int> 多价类型
		$this->_arr_value['multiPriceType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productSaleType'] = $bs->popInt32_t();	//<int> product_sale_type
		$this->_arr_value['productSaleType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['businessUnitCostPrice'] = $bs->popInt32_t();	//<int> business_unit_cost_price
		$this->_arr_value['businessUnitCostPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['saleModel'] = $bs->popInt32_t();	//<int> sale_model
		$this->_arr_value['saleModel_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['lowestNum'] = $bs->popInt32_t();	//<int> lowest_num
		$this->_arr_value['lowestNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bookingType'] = $bs->popInt32_t();	//<int> booking_type
		$this->_arr_value['bookingType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bookingValue'] = $bs->popString();	//<std::string> booking_value
		$this->_arr_value['bookingValue_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['c3Ids'] = $bs->popString();	//<std::string> 三级类目id
		$this->_arr_value['c3Ids_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productCharId'] = $bs->popString();	//<std::string> product_char_id
		$this->_arr_value['productCharId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mode'] = $bs->popString();	//<std::string> mode
		$this->_arr_value['mode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['name'] = $bs->popString();	//<std::string> 名字
		$this->_arr_value['name_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['weight'] = $bs->popUint32_t();	//<uint32_t> 重量
		$this->_arr_value['weight_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['picNum'] = $bs->popUint32_t();	//<uint32_t> 图片数量
		$this->_arr_value['picNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['barcode'] = $bs->popString();	//<std::string> barcode
		$this->_arr_value['barcode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['color'] = $bs->popInt32_t();	//<int> 颜色
		$this->_arr_value['color_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productSize'] = $bs->popInt32_t();	//<int> 尺码
		$this->_arr_value['productSize_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['manufacturer'] = $bs->popInt32_t();	//<int> manufacturer
		$this->_arr_value['manufacturer_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['warranty'] = $bs->popString();	//<std::string> warranty
		$this->_arr_value['warranty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['masterid'] = $bs->popUint32_t();	//<uint32_t> masterid
		$this->_arr_value['masterid_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['sellerAddressId'] = $bs->popInt32_t();	//<int> 卖家仓(地址)id
		}
		if($this->version >= 1){
			$this->_arr_value['sellerAddressId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['sellerId'] = $bs->popInt32_t();	//<int> 卖家id
		}
		if($this->version >= 1){
			$this->_arr_value['sellerId_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace icson\deal\bo;	//source idl: com.icson.deal.idl.GetProductInfoReq.java
if (!class_exists('icson\deal\bo\ProductParam', false)) {
class ProductParam{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 协议版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $productIdList;	//<std::vector<uint32_t> > 商品id列表(版本>=0)
	private $productIdList_u;	//<uint8_t> (版本>=0)
	private $whId;	//<uint32_t> 分站id(版本>=0)
	private $whId_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->productIdList = new \stl_vector2('uint32_t');	//<std::vector<uint32_t> >
		$this->productIdList_u = 0;	//<uint8_t>
		$this->whId = 0;	//<uint32_t>
		$this->whId_u = 0;	//<uint8_t>
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
			exit("\icson\deal\bo\ProductParam\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\bo\ProductParam\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushObject($this->productIdList,'stl_vector');	//<std::vector<uint32_t> > 商品id列表
		$bs->pushUint8_t($this->productIdList_u);	//<uint8_t> 
		$bs->pushUint32_t($this->whId);	//<uint32_t> 分站id
		$bs->pushUint8_t($this->whId_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 协议版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productIdList'] = $bs->popObject('stl_vector<uint32_t>');	//<std::vector<uint32_t> > 商品id列表
		$this->_arr_value['productIdList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['whId'] = $bs->popUint32_t();	//<uint32_t> 分站id
		$this->_arr_value['whId_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\deal\bo;	//source idl: com.icson.deal.idl.GetInventeoryInfoResp.java
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

namespace icson\deal\bo;	//source idl: com.icson.deal.idl.GetInventeoryInfoReq.java
if (!class_exists('icson\deal\bo\InventoryParam', false)) {
class InventoryParam{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 协议版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $productIdList;	//<std::vector<uint32_t> > 商品id列表(版本>=0)
	private $productIdList_u;	//<uint8_t> (版本>=0)
	private $districtId;	//<uint32_t> 三级地址id(版本>=0)
	private $districtId_u;	//<uint8_t> (版本>=0)
	private $whId;	//<uint32_t> 分站id(版本>=0)
	private $whId_u;	//<uint8_t> (版本>=0)
	private $stockId;	//<uint32_t> 物理仓id(版本>=0)
	private $stockId_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->productIdList = new \stl_vector2('uint32_t');	//<std::vector<uint32_t> >
		$this->productIdList_u = 0;	//<uint8_t>
		$this->districtId = 0;	//<uint32_t>
		$this->districtId_u = 0;	//<uint8_t>
		$this->whId = 0;	//<uint32_t>
		$this->whId_u = 0;	//<uint8_t>
		$this->stockId = 0;	//<uint32_t>
		$this->stockId_u = 0;	//<uint8_t>
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
			exit("\icson\deal\bo\InventoryParam\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\bo\InventoryParam\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushObject($this->productIdList,'stl_vector');	//<std::vector<uint32_t> > 商品id列表
		$bs->pushUint8_t($this->productIdList_u);	//<uint8_t> 
		$bs->pushUint32_t($this->districtId);	//<uint32_t> 三级地址id
		$bs->pushUint8_t($this->districtId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->whId);	//<uint32_t> 分站id
		$bs->pushUint8_t($this->whId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->stockId);	//<uint32_t> 物理仓id
		$bs->pushUint8_t($this->stockId_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 协议版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productIdList'] = $bs->popObject('stl_vector<uint32_t>');	//<std::vector<uint32_t> > 商品id列表
		$this->_arr_value['productIdList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['districtId'] = $bs->popUint32_t();	//<uint32_t> 三级地址id
		$this->_arr_value['districtId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['whId'] = $bs->popUint32_t();	//<uint32_t> 分站id
		$this->_arr_value['whId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockId'] = $bs->popUint32_t();	//<uint32_t> 物理仓id
		$this->_arr_value['stockId_u'] = $bs->popUint8_t();	//<uint8_t> 

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