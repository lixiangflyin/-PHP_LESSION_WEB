<?php
// source idl: com.icson.deal.idl.ShippingAo.java
require_once "shippingao_xxo.php";

class getPackagesReq {
	var $productList;
	var $whId;
	var $destination;
	var $dc;
	var $extIn;
	var $sceneId;
	var $source;
	var $machineKey;
	var $ReserveIn;

	function __construct() {
		 $this->productList = new stl_map('uint32_t,ShippingParam'); // std::map<uint32_t,icson::deal::bo::CShippingParam> 
		 $this->whId = 0; // uint32_t
		 $this->destination = 0; // uint32_t
		 $this->dc = ""; // std::string
		 $this->extIn = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
		 $this->sceneId = 0; // uint32_t
		 $this->source = ""; // std::string
		 $this->machineKey = ""; // std::string
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushObject($this->productList,'stl_map'); // 序列化商品信息 <productId, ShippingParam> 类型为std::map<uint32_t,icson::deal::bo::CShippingParam> 
		$bs->pushUint32_t($this->whId); // 序列化分站ID 类型为uint32_t
		$bs->pushUint32_t($this->destination); // 序列化目的区域ID 类型为uint32_t
		$bs->pushString($this->dc); // 序列化目的地DC 类型为std::string
		$bs->pushObject($this->extIn,'stl_map'); // 序列化请求保留字，拓展用，选填  类型为std::map<std::string,std::string> 
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID 类型为uint32_t
		$bs->pushString($this->source); // 序列化来源，客户端IP 类型为std::string
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->ReserveIn); // 序列化保留输入 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91151006;
	}
}

class getPackagesResp {
	var $result;
	var $Packages;
	var $extOut;
	var $errMsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->Packages = $bs->popObject('stl_map<stl_string,ShippingPackageInfo>'); // 反序列化<packageId, ShippingPackageInfo> 类型为std::map<std::string,icson::deal::bo::CShippingPackageInfo> 
		$this->extOut = $bs->popObject('stl_map<stl_string,stl_string>'); // 反序列化返回保留字 类型为std::map<std::string,std::string> 
		$this->errMsg = $bs->popString(); // 反序列化错误消息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化保留输出 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91158006;
	}
}

class getShippingInfo4CartReq {
	var $shippingParamList;
	var $whId;
	var $destination;
	var $dc;
	var $extIn;
	var $sceneId;
	var $source;
	var $machineKey;
	var $ReserveIn;

	function __construct() {
		 $this->shippingParamList = new stl_map('uint32_t,ShippingSmallParam'); // std::map<uint32_t,icson::deal::bo::CShippingSmallParam> 
		 $this->whId = 0; // uint32_t
		 $this->destination = 0; // uint32_t
		 $this->dc = ""; // std::string
		 $this->extIn = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
		 $this->sceneId = 0; // uint32_t
		 $this->source = ""; // std::string
		 $this->machineKey = ""; // std::string
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushObject($this->shippingParamList,'stl_map'); // 序列化商品信息 <productId, ShippingSmallParam> 类型为std::map<uint32_t,icson::deal::bo::CShippingSmallParam> 
		$bs->pushUint32_t($this->whId); // 序列化分站ID 类型为uint32_t
		$bs->pushUint32_t($this->destination); // 序列化目的区域ID 类型为uint32_t
		$bs->pushString($this->dc); // 序列化目的地DC 类型为std::string
		$bs->pushObject($this->extIn,'stl_map'); // 序列化请求保留字，拓展用，选填  类型为std::map<std::string,std::string> 
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID 类型为uint32_t
		$bs->pushString($this->source); // 序列化来源，客户端IP 类型为std::string
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->ReserveIn); // 序列化保留输入 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91151002;
	}
}

class getShippingInfo4CartResp {
	var $result;
	var $baseShippingInfoList;
	var $extOut;
	var $errMsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->baseShippingInfoList = $bs->popObject('stl_map<uint32_t,BaseShippingInfo>'); // 反序列化<productId, BaseShippingInfo> 类型为std::map<uint32_t,icson::deal::bo::CBaseShippingInfo> 
		$this->extOut = $bs->popObject('stl_map<stl_string,stl_string>'); // 反序列化返回保留字 类型为std::map<std::string,std::string> 
		$this->errMsg = $bs->popString(); // 反序列化错误消息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化保留输出 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91158002;
	}
}

class getShippingInfo4ItemReq {
	var $shippingParamList;
	var $whId;
	var $destination;
	var $dc;
	var $extIn;
	var $sceneId;
	var $source;
	var $machineKey;
	var $ReserveIn;

	function __construct() {
		 $this->shippingParamList = new stl_map('uint32_t,ShippingSmallParam'); // std::map<uint32_t,icson::deal::bo::CShippingSmallParam> 
		 $this->whId = 0; // uint32_t
		 $this->destination = 0; // uint32_t
		 $this->dc = ""; // std::string
		 $this->extIn = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
		 $this->sceneId = 0; // uint32_t
		 $this->source = ""; // std::string
		 $this->machineKey = ""; // std::string
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushObject($this->shippingParamList,'stl_map'); // 序列化商品信息 <productId, ShippingSmallParam> 类型为std::map<uint32_t,icson::deal::bo::CShippingSmallParam> 
		$bs->pushUint32_t($this->whId); // 序列化分站ID 类型为uint32_t
		$bs->pushUint32_t($this->destination); // 序列化目的区域ID 类型为uint32_t
		$bs->pushString($this->dc); // 序列化目的地DC 类型为std::string
		$bs->pushObject($this->extIn,'stl_map'); // 序列化请求保留字，拓展用，选填  类型为std::map<std::string,std::string> 
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID 类型为uint32_t
		$bs->pushString($this->source); // 序列化来源，客户端IP 类型为std::string
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->ReserveIn); // 序列化保留输入 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91151001;
	}
}

class getShippingInfo4ItemResp {
	var $result;
	var $baseShippingInfoList;
	var $extOut;
	var $errMsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->baseShippingInfoList = $bs->popObject('stl_map<uint32_t,BaseShippingInfo>'); // 反序列化<productId, BaseShippingInfo> 类型为std::map<uint32_t,icson::deal::bo::CBaseShippingInfo> 
		$this->extOut = $bs->popObject('stl_map<stl_string,stl_string>'); // 反序列化返回保留字 类型为std::map<std::string,std::string> 
		$this->errMsg = $bs->popString(); // 反序列化错误消息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化保留输出 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91158001;
	}
}

class getShippingInfo4OrderReq {
	var $whId;
	var $destination;
	var $dc;
	var $userLevel;
	var $productList;
	var $couponPrice;
	var $extIn;
	var $sceneId;
	var $source;
	var $machineKey;
	var $ReserveIn;

	function __construct() {
		 $this->whId = 0; // uint32_t
		 $this->destination = 0; // uint32_t
		 $this->dc = ""; // std::string
		 $this->userLevel = 0; // uint32_t
		 $this->productList = new stl_map('uint32_t,ShippingParam'); // std::map<uint32_t,icson::deal::bo::CShippingParam> 
		 $this->couponPrice = 0; // uint32_t
		 $this->extIn = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
		 $this->sceneId = 0; // uint32_t
		 $this->source = ""; // std::string
		 $this->machineKey = ""; // std::string
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushUint32_t($this->whId); // 序列化分站ID 类型为uint32_t
		$bs->pushUint32_t($this->destination); // 序列化目的区域ID 类型为uint32_t
		$bs->pushString($this->dc); // 序列化目的地DC 类型为std::string
		$bs->pushUint32_t($this->userLevel); // 序列化用户level 类型为uint32_t
		$bs->pushObject($this->productList,'stl_map'); // 序列化<product_id, ShippingParam> 商品信息 类型为std::map<uint32_t,icson::deal::bo::CShippingParam> 
		$bs->pushUint32_t($this->couponPrice); // 序列化使用优惠券后减免的金额 类型为uint32_t
		$bs->pushObject($this->extIn,'stl_map'); // 序列化请求保留字，拓展用，选填  类型为std::map<std::string,std::string> 
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID 类型为uint32_t
		$bs->pushString($this->source); // 序列化来源，客户端IP 类型为std::string
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->ReserveIn); // 序列化保留输入 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91151003;
	}
}

class getShippingInfo4OrderResp {
	var $result;
	var $orderShipping;
	var $extOut;
	var $errMsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->orderShipping = $bs->popObject('OrderShippingInfo'); // 反序列化订单配送信息 类型为icson::deal::bo::COrderShippingInfo
		$this->extOut = $bs->popObject('stl_map<stl_string,stl_string>'); // 反序列化返回保留字 类型为std::map<std::string,std::string> 
		$this->errMsg = $bs->popString(); // 反序列化错误消息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化保留输出 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91158003;
	}
}

class getShippingInfo4OtherReq {
	var $whId;
	var $destination;
	var $dc;
	var $userLevel;
	var $productList;
	var $couponPrice;
	var $extIn;
	var $sceneId;
	var $source;
	var $machineKey;
	var $ReserveIn;

	function __construct() {
		 $this->whId = 0; // uint32_t
		 $this->destination = 0; // uint32_t
		 $this->dc = ""; // std::string
		 $this->userLevel = 0; // uint32_t
		 $this->productList = new stl_map('uint32_t,ShippingParam'); // std::map<uint32_t,icson::deal::bo::CShippingParam> 
		 $this->couponPrice = 0; // uint32_t
		 $this->extIn = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
		 $this->sceneId = 0; // uint32_t
		 $this->source = ""; // std::string
		 $this->machineKey = ""; // std::string
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushUint32_t($this->whId); // 序列化分站ID 类型为uint32_t
		$bs->pushUint32_t($this->destination); // 序列化目的区域ID 类型为uint32_t
		$bs->pushString($this->dc); // 序列化目的地DC 类型为std::string
		$bs->pushUint32_t($this->userLevel); // 序列化用户level 类型为uint32_t
		$bs->pushObject($this->productList,'stl_map'); // 序列化<product_id, ShippingParam> 商品信息 类型为std::map<uint32_t,icson::deal::bo::CShippingParam> 
		$bs->pushUint32_t($this->couponPrice); // 序列化使用优惠券后减免的金额 类型为uint32_t
		$bs->pushObject($this->extIn,'stl_map'); // 序列化请求保留字，拓展用，选填  类型为std::map<std::string,std::string> 
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID 类型为uint32_t
		$bs->pushString($this->source); // 序列化来源，客户端IP 类型为std::string
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->ReserveIn); // 序列化保留输入 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91151004;
	}
}

class getShippingInfo4OtherResp {
	var $result;
	var $orderShipping;
	var $extOut;
	var $errMsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->orderShipping = $bs->popObject('OrderShippingInfo'); // 反序列化配送信息 类型为icson::deal::bo::COrderShippingInfo
		$this->extOut = $bs->popObject('stl_map<stl_string,stl_string>'); // 反序列化返回保留字 类型为std::map<std::string,std::string> 
		$this->errMsg = $bs->popString(); // 反序列化错误消息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化保留输出 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91158004;
	}
}

class getShippingInfo4PlaceOrderReq {
	var $whId;
	var $destination;
	var $dc;
	var $userLevel;
	var $productList;
	var $orderPrice;
	var $extIn;
	var $sceneId;
	var $source;
	var $machineKey;
	var $ReserveIn;

	function __construct() {
		 $this->whId = 0; // uint32_t
		 $this->destination = 0; // uint32_t
		 $this->dc = ""; // std::string
		 $this->userLevel = 0; // uint32_t
		 $this->productList = new stl_map('uint32_t,ShippingParam'); // std::map<uint32_t,icson::deal::bo::CShippingParam> 
		 $this->orderPrice = 0; // uint32_t
		 $this->extIn = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
		 $this->sceneId = 0; // uint32_t
		 $this->source = ""; // std::string
		 $this->machineKey = ""; // std::string
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushUint32_t($this->whId); // 序列化分站ID 类型为uint32_t
		$bs->pushUint32_t($this->destination); // 序列化目的区域ID 类型为uint32_t
		$bs->pushString($this->dc); // 序列化目的地DC 类型为std::string
		$bs->pushUint32_t($this->userLevel); // 序列化用户level 类型为uint32_t
		$bs->pushObject($this->productList,'stl_map'); // 序列化<product_id, ShippingParam> 商品信息 类型为std::map<uint32_t,icson::deal::bo::CShippingParam> 
		$bs->pushUint32_t($this->orderPrice); // 序列化订单的支付金额（除去优惠券的费用） 类型为uint32_t
		$bs->pushObject($this->extIn,'stl_map'); // 序列化请求保留字，拓展用，选填  类型为std::map<std::string,std::string> 
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID 类型为uint32_t
		$bs->pushString($this->source); // 序列化来源，客户端IP 类型为std::string
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->ReserveIn); // 序列化保留输入 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91151005;
	}
}

class getShippingInfo4PlaceOrderResp {
	var $result;
	var $orderShipping;
	var $extOut;
	var $errMsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->orderShipping = $bs->popObject('OrderShippingInfo'); // 反序列化配送信息 类型为icson::deal::bo::COrderShippingInfo
		$this->extOut = $bs->popObject('stl_map<stl_string,stl_string>'); // 反序列化返回保留字 类型为std::map<std::string,std::string> 
		$this->errMsg = $bs->popString(); // 反序列化错误消息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化保留输出 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91158005;
	}
}

class getShippingOrsOrdersReq {
	var $whId;
	var $destination;
	var $dc;
	var $userLevel;
	var $userId;
	var $productList;
	var $couponPrice;
	var $extIn;
	var $sceneId;
	var $source;
	var $machineKey;
	var $ReserveIn;

	function __construct() {
		 $this->whId = 0; // uint32_t
		 $this->destination = 0; // uint32_t
		 $this->dc = ""; // std::string
		 $this->userLevel = 0; // uint32_t
		 $this->userId = 0; // uint32_t
		 $this->productList = new stl_map('uint32_t,ShippingParam'); // std::map<uint32_t,icson::deal::bo::CShippingParam> 
		 $this->couponPrice = 0; // uint32_t
		 $this->extIn = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
		 $this->sceneId = 0; // uint32_t
		 $this->source = ""; // std::string
		 $this->machineKey = ""; // std::string
		 $this->ReserveIn = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushUint32_t($this->whId); // 序列化分站ID 类型为uint32_t
		$bs->pushUint32_t($this->destination); // 序列化目的区域ID 类型为uint32_t
		$bs->pushString($this->dc); // 序列化目的地DC 类型为std::string
		$bs->pushUint32_t($this->userLevel); // 序列化用户level 类型为uint32_t
		$bs->pushUint32_t($this->userId); // 序列化用户ID 类型为uint32_t
		$bs->pushObject($this->productList,'stl_map'); // 序列化<product_id, ShippingParam> 商品信息 类型为std::map<uint32_t,icson::deal::bo::CShippingParam> 
		$bs->pushUint32_t($this->couponPrice); // 序列化使用优惠券后减免的金额 类型为uint32_t
		$bs->pushObject($this->extIn,'stl_map'); // 序列化请求保留字，拓展用，选填  类型为std::map<std::string,std::string> 
		$bs->pushUint32_t($this->sceneId); // 序列化场景ID 类型为uint32_t
		$bs->pushString($this->source); // 序列化来源，客户端IP 类型为std::string
		$bs->pushString($this->machineKey); // 序列化机器码，必填 类型为std::string
		$bs->pushString($this->ReserveIn); // 序列化保留输入 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0x91151007;
	}
}

class getShippingOrsOrdersResp {
	var $result;
	var $orderShipping;
	var $extOut;
	var $errMsg;
	var $ReserveOut;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->orderShipping = $bs->popObject('stl_map<stl_string,OrderShippingInfo>'); // 反序列化订单配送信息 类型为std::map<std::string,icson::deal::bo::COrderShippingInfo> 
		$this->extOut = $bs->popObject('stl_map<stl_string,stl_string>'); // 反序列化返回保留字 类型为std::map<std::string,std::string> 
		$this->errMsg = $bs->popString(); // 反序列化错误消息 类型为std::string
		$this->ReserveOut = $bs->popString(); // 反序列化保留输出 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0x91158007;
	}
}
?>