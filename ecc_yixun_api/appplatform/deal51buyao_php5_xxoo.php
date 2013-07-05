<?php
namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.SysQueryBdealReq.java
class DealQueryBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 版本号(版本>=0)
	private $dealId;	//<uint64_t> 订单id(版本>=0)
	private $tradeId;	//<uint64_t> 子单id(版本>=0)
	private $sellerId;	//<uint64_t> 卖家id(版本>=0)
	private $buyerId;	//<uint64_t> 买家id(版本>=0)
	private $dealCode;	//<std::string> 订单编码(版本>=0)
	private $tradeCode;	//<std::string> 子单编码(版本>=0)
	private $businessDealId;	//<std::string> 业务订单号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $dealId_u;	//<uint8_t> (版本>=0)
	private $tradeId_u;	//<uint8_t> (版本>=0)
	private $sellerId_u;	//<uint8_t> (版本>=0)
	private $buyerId_u;	//<uint8_t> (版本>=0)
	private $dealCode_u;	//<uint8_t> (版本>=0)
	private $tradeCode_u;	//<uint8_t> (版本>=0)
	private $businessDealId_u;	//<uint8_t> (版本>=0)
	private $bdealId;	//<uint64_t> 交易单id(版本>=1)
	private $bdealCode;	//<std::string> 交易单编码(版本>=1)
	private $bdealId_u;	//<uint8_t> (版本>=1)
	private $bdealCode_u;	//<uint8_t> (版本>=1)

	function __construct(){
		$this->version = 1;	//<uint16_t>
		$this->dealId = 0;	//<uint64_t>
		$this->tradeId = 0;	//<uint64_t>
		$this->sellerId = 0;	//<uint64_t>
		$this->buyerId = 0;	//<uint64_t>
		$this->dealCode = "";	//<std::string>
		$this->tradeCode = "";	//<std::string>
		$this->businessDealId = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->dealId_u = 0;	//<uint8_t>
		$this->tradeId_u = 0;	//<uint8_t>
		$this->sellerId_u = 0;	//<uint8_t>
		$this->buyerId_u = 0;	//<uint8_t>
		$this->dealCode_u = 0;	//<uint8_t>
		$this->tradeCode_u = 0;	//<uint8_t>
		$this->businessDealId_u = 0;	//<uint8_t>
		$this->bdealId = 0;	//<uint64_t>
		$this->bdealCode = "";	//<std::string>
		$this->bdealId_u = 0;	//<uint8_t>
		$this->bdealCode_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\bo\DealQueryBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\DealQueryBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 版本号
		$bs->pushUint64_t($this->dealId);	//<uint64_t> 订单id
		$bs->pushUint64_t($this->tradeId);	//<uint64_t> 子单id
		$bs->pushUint64_t($this->sellerId);	//<uint64_t> 卖家id
		$bs->pushUint64_t($this->buyerId);	//<uint64_t> 买家id
		$bs->pushString($this->dealCode);	//<std::string> 订单编码
		$bs->pushString($this->tradeCode);	//<std::string> 子单编码
		$bs->pushString($this->businessDealId);	//<std::string> 业务订单号
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->businessDealId_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushUint64_t($this->bdealId);	//<uint64_t> 交易单id
		}
		if($this->version >= 1){
			$bs->pushString($this->bdealCode);	//<std::string> 交易单编码
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->bdealId_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->bdealCode_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 版本号
		$this->_arr_value['dealId'] = $bs->popUint64_t();	//<uint64_t> 订单id
		$this->_arr_value['tradeId'] = $bs->popUint64_t();	//<uint64_t> 子单id
		$this->_arr_value['sellerId'] = $bs->popUint64_t();	//<uint64_t> 卖家id
		$this->_arr_value['buyerId'] = $bs->popUint64_t();	//<uint64_t> 买家id
		$this->_arr_value['dealCode'] = $bs->popString();	//<std::string> 订单编码
		$this->_arr_value['tradeCode'] = $bs->popString();	//<std::string> 子单编码
		$this->_arr_value['businessDealId'] = $bs->popString();	//<std::string> 业务订单号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['businessDealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['bdealId'] = $bs->popUint64_t();	//<uint64_t> 交易单id
		}
		if($this->version >= 1){
			$this->_arr_value['bdealCode'] = $bs->popString();	//<std::string> 交易单编码
		}
		if($this->version >= 1){
			$this->_arr_value['bdealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['bdealCode_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.SyncRefundReq.java
class EventParamsCorpSyncRefundBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $dealId;	//<std::string> 订单单id(版本>=0)
	private $tradeId;	//<uint64_t> 子单id(版本>=0)
	private $skuId;	//<uint64_t> 商品skuid, 如果没有子单（商品）维度信息，可不填(版本>=0)
	private $operateTime;	//<uint32_t> 操作时间(版本>=0)
	private $refundState;	//<uint32_t> 退款状态, 1-开始;2-客服已审核;3-已退款;4-财务已审核;5-财务驳回初始;6-作废(版本>=0)
	private $desc;	//<std::string> 描述(版本>=0)
	private $reserve;	//<std::string> 保留字段(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $dealId_u;	//<uint8_t> (版本>=0)
	private $tradeId_u;	//<uint8_t> (版本>=0)
	private $skuId_u;	//<uint8_t> (版本>=0)
	private $operateTime_u;	//<uint8_t> (版本>=0)
	private $refundState_u;	//<uint8_t> (版本>=0)
	private $desc_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)
	private $businessRefundId;	//<std::string> 业务退款单id(版本>=1)
	private $businessRefundId_u;	//<uint8_t> (版本>=1)

	function __construct(){
		$this->version = 1;	//<uint16_t>
		$this->dealId = "";	//<std::string>
		$this->tradeId = 0;	//<uint64_t>
		$this->skuId = 0;	//<uint64_t>
		$this->operateTime = 0;	//<uint32_t>
		$this->refundState = 0;	//<uint32_t>
		$this->desc = "";	//<std::string>
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->dealId_u = 0;	//<uint8_t>
		$this->tradeId_u = 0;	//<uint8_t>
		$this->skuId_u = 0;	//<uint8_t>
		$this->operateTime_u = 0;	//<uint8_t>
		$this->refundState_u = 0;	//<uint8_t>
		$this->desc_u = 0;	//<uint8_t>
		$this->reserve_u = 0;	//<uint8_t>
		$this->businessRefundId = "";	//<std::string>
		$this->businessRefundId_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\bo\EventParamsCorpSyncRefundBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\EventParamsCorpSyncRefundBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushString($this->dealId);	//<std::string> 订单单id
		$bs->pushUint64_t($this->tradeId);	//<uint64_t> 子单id
		$bs->pushUint64_t($this->skuId);	//<uint64_t> 商品skuid, 如果没有子单（商品）维度信息，可不填
		$bs->pushUint32_t($this->operateTime);	//<uint32_t> 操作时间
		$bs->pushUint32_t($this->refundState);	//<uint32_t> 退款状态, 1-开始;2-客服已审核;3-已退款;4-财务已审核;5-财务驳回初始;6-作废
		$bs->pushString($this->desc);	//<std::string> 描述
		$bs->pushString($this->reserve);	//<std::string> 保留字段
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->skuId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operateTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->desc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushString($this->businessRefundId);	//<std::string> 业务退款单id
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->businessRefundId_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['dealId'] = $bs->popString();	//<std::string> 订单单id
		$this->_arr_value['tradeId'] = $bs->popUint64_t();	//<uint64_t> 子单id
		$this->_arr_value['skuId'] = $bs->popUint64_t();	//<uint64_t> 商品skuid, 如果没有子单（商品）维度信息，可不填
		$this->_arr_value['operateTime'] = $bs->popUint32_t();	//<uint32_t> 操作时间
		$this->_arr_value['refundState'] = $bs->popUint32_t();	//<uint32_t> 退款状态, 1-开始;2-客服已审核;3-已退款;4-财务已审核;5-财务驳回初始;6-作废
		$this->_arr_value['desc'] = $bs->popString();	//<std::string> 描述
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 保留字段
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['desc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserve_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['businessRefundId'] = $bs->popString();	//<std::string> 业务退款单id
		}
		if($this->version >= 1){
			$this->_arr_value['businessRefundId_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.SyncPickingReq.java
class EventParamsPickBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $operateTime;	//<uint32_t> 操作时间(版本>=0)
	private $pickState;	//<uint32_t> 拣货状态: 1-开始;2-完成;3-失败;(版本>=0)
	private $pickDesc;	//<std::string> 描述(版本>=0)
	private $reserve;	//<std::string> 保留字段(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $operateTime_u;	//<uint8_t> (版本>=0)
	private $pickState_u;	//<uint8_t> (版本>=0)
	private $pickDesc_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->operateTime = 0;	//<uint32_t>
		$this->pickState = 0;	//<uint32_t>
		$this->pickDesc = "";	//<std::string>
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->operateTime_u = 0;	//<uint8_t>
		$this->pickState_u = 0;	//<uint8_t>
		$this->pickDesc_u = 0;	//<uint8_t>
		$this->reserve_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\bo\EventParamsPickBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\EventParamsPickBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushUint32_t($this->operateTime);	//<uint32_t> 操作时间
		$bs->pushUint32_t($this->pickState);	//<uint32_t> 拣货状态: 1-开始;2-完成;3-失败;
		$bs->pushString($this->pickDesc);	//<std::string> 描述
		$bs->pushString($this->reserve);	//<std::string> 保留字段
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operateTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->pickState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->pickDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['operateTime'] = $bs->popUint32_t();	//<uint32_t> 操作时间
		$this->_arr_value['pickState'] = $bs->popUint32_t();	//<uint32_t> 拣货状态: 1-开始;2-完成;3-失败;
		$this->_arr_value['pickDesc'] = $bs->popString();	//<std::string> 描述
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 保留字段
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['pickState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['pickDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserve_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.SyncDealActionReq.java
class SyncDealActionBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 版本号(版本>=0)
	private $dealId;	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702(版本>=0)
	private $tradeId;	//<uint64_t> 商品子单ID，商品子单维度操作时填写，订单维度操作可不填(版本>=0)
	private $operateTime;	//<uint32_t> 操作时间(版本>=0)
	private $curState;	//<uint32_t> 操作时的订单状态(版本>=0)
	private $operationType;	//<uint16_t> 操作类型: 101-物流信息同步;102-签收;103-拒签;...更多请业务方补充(版本>=0)
	private $operatorName;	//<std::string> 操作者，请和EventParamsBaseBo中的OperatorNmae填写相同(版本>=0)
	private $operatorType;	//<uint16_t> 操作者类别:1-买家;2-卖家(客服);3-系统;4-BOSS;5-支付系统;6-API;(版本>=0)
	private $isCanSeen;	//<uint8_t> 操作描述是否前台可见，配合OperationDesc使用，取值:0-不可见;1-可见(版本>=0)
	private $operationDesc;	//<std::string> 操作描述，如果IsCanSeen为可见，此描述会在前端网站流水中展示，不能超过1024个字(版本>=0)
	private $sysRemark;	//<std::string> 系统内部描述，前台不可见，不能超过128个字(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $dealId_u;	//<uint8_t> (版本>=0)
	private $tradeId_u;	//<uint8_t> (版本>=0)
	private $operateTime_u;	//<uint8_t> (版本>=0)
	private $curState_u;	//<uint8_t> (版本>=0)
	private $operationType_u;	//<uint8_t> (版本>=0)
	private $operatorName_u;	//<uint8_t> (版本>=0)
	private $operatorType_u;	//<uint8_t> (版本>=0)
	private $isCanSeen_u;	//<uint8_t> (版本>=0)
	private $operationDesc_u;	//<uint8_t> (版本>=0)
	private $sysRemark_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->dealId = "";	//<std::string>
		$this->tradeId = 0;	//<uint64_t>
		$this->operateTime = 0;	//<uint32_t>
		$this->curState = 0;	//<uint32_t>
		$this->operationType = 0;	//<uint16_t>
		$this->operatorName = "";	//<std::string>
		$this->operatorType = 0;	//<uint16_t>
		$this->isCanSeen = 0;	//<uint8_t>
		$this->operationDesc = "";	//<std::string>
		$this->sysRemark = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->dealId_u = 0;	//<uint8_t>
		$this->tradeId_u = 0;	//<uint8_t>
		$this->operateTime_u = 0;	//<uint8_t>
		$this->curState_u = 0;	//<uint8_t>
		$this->operationType_u = 0;	//<uint8_t>
		$this->operatorName_u = 0;	//<uint8_t>
		$this->operatorType_u = 0;	//<uint8_t>
		$this->isCanSeen_u = 0;	//<uint8_t>
		$this->operationDesc_u = 0;	//<uint8_t>
		$this->sysRemark_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\bo\SyncDealActionBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\SyncDealActionBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 版本号
		$bs->pushString($this->dealId);	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		$bs->pushUint64_t($this->tradeId);	//<uint64_t> 商品子单ID，商品子单维度操作时填写，订单维度操作可不填
		$bs->pushUint32_t($this->operateTime);	//<uint32_t> 操作时间
		$bs->pushUint32_t($this->curState);	//<uint32_t> 操作时的订单状态
		$bs->pushUint16_t($this->operationType);	//<uint16_t> 操作类型: 101-物流信息同步;102-签收;103-拒签;...更多请业务方补充
		$bs->pushString($this->operatorName);	//<std::string> 操作者，请和EventParamsBaseBo中的OperatorNmae填写相同
		$bs->pushUint16_t($this->operatorType);	//<uint16_t> 操作者类别:1-买家;2-卖家(客服);3-系统;4-BOSS;5-支付系统;6-API;
		$bs->pushUint8_t($this->isCanSeen);	//<uint8_t> 操作描述是否前台可见，配合OperationDesc使用，取值:0-不可见;1-可见
		$bs->pushString($this->operationDesc);	//<std::string> 操作描述，如果IsCanSeen为可见，此描述会在前端网站流水中展示，不能超过1024个字
		$bs->pushString($this->sysRemark);	//<std::string> 系统内部描述，前台不可见，不能超过128个字
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operateTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->curState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operationType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operatorName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operatorType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->isCanSeen_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operationDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sysRemark_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 版本号
		$this->_arr_value['dealId'] = $bs->popString();	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		$this->_arr_value['tradeId'] = $bs->popUint64_t();	//<uint64_t> 商品子单ID，商品子单维度操作时填写，订单维度操作可不填
		$this->_arr_value['operateTime'] = $bs->popUint32_t();	//<uint32_t> 操作时间
		$this->_arr_value['curState'] = $bs->popUint32_t();	//<uint32_t> 操作时的订单状态
		$this->_arr_value['operationType'] = $bs->popUint16_t();	//<uint16_t> 操作类型: 101-物流信息同步;102-签收;103-拒签;...更多请业务方补充
		$this->_arr_value['operatorName'] = $bs->popString();	//<std::string> 操作者，请和EventParamsBaseBo中的OperatorNmae填写相同
		$this->_arr_value['operatorType'] = $bs->popUint16_t();	//<uint16_t> 操作者类别:1-买家;2-卖家(客服);3-系统;4-BOSS;5-支付系统;6-API;
		$this->_arr_value['isCanSeen'] = $bs->popUint8_t();	//<uint8_t> 操作描述是否前台可见，配合OperationDesc使用，取值:0-不可见;1-可见
		$this->_arr_value['operationDesc'] = $bs->popString();	//<std::string> 操作描述，如果IsCanSeen为可见，此描述会在前端网站流水中展示，不能超过1024个字
		$this->_arr_value['sysRemark'] = $bs->popString();	//<std::string> 系统内部描述，前台不可见，不能超过128个字
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['curState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operationType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operatorName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operatorType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['isCanSeen_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operationDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sysRemark_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.OperateGoodsReq.java
class EventParamsOperGoodsBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $operateTime;	//<uint32_t> 操作时间(版本>=0)
	private $addList;	//<std::vector<ecc::deal::bo::CEventParamsAddGoodsBo> > 增加商品列表(版本>=0)
	private $removeList;	//<std::vector<ecc::deal::bo::CEventParamsRemoveGoodsBo> > 删除商品列表(版本>=0)
	private $operateDesc;	//<std::string> 描述(版本>=0)
	private $reserve;	//<std::string> 保留字段(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $operateTime_u;	//<uint8_t> (版本>=0)
	private $addList_u;	//<uint8_t> (版本>=0)
	private $removeList_u;	//<uint8_t> (版本>=0)
	private $operateDesc_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->operateTime = 0;	//<uint32_t>
		$this->addList = new \stl_vector2('\ecc\deal\bo\EventParamsAddGoodsBo');	//<std::vector<ecc::deal::bo::CEventParamsAddGoodsBo> >
		$this->removeList = new \stl_vector2('\ecc\deal\bo\EventParamsRemoveGoodsBo');	//<std::vector<ecc::deal::bo::CEventParamsRemoveGoodsBo> >
		$this->operateDesc = "";	//<std::string>
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->operateTime_u = 0;	//<uint8_t>
		$this->addList_u = 0;	//<uint8_t>
		$this->removeList_u = 0;	//<uint8_t>
		$this->operateDesc_u = 0;	//<uint8_t>
		$this->reserve_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\bo\EventParamsOperGoodsBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\EventParamsOperGoodsBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushUint32_t($this->operateTime);	//<uint32_t> 操作时间
		$bs->pushObject($this->addList,'stl_vector');	//<std::vector<ecc::deal::bo::CEventParamsAddGoodsBo> > 增加商品列表
		$bs->pushObject($this->removeList,'stl_vector');	//<std::vector<ecc::deal::bo::CEventParamsRemoveGoodsBo> > 删除商品列表
		$bs->pushString($this->operateDesc);	//<std::string> 描述
		$bs->pushString($this->reserve);	//<std::string> 保留字段
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operateTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->addList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->removeList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operateDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['operateTime'] = $bs->popUint32_t();	//<uint32_t> 操作时间
		$this->_arr_value['addList'] = $bs->popObject('stl_vector<\ecc\deal\bo\EventParamsAddGoodsBo>');	//<std::vector<ecc::deal::bo::CEventParamsAddGoodsBo> > 增加商品列表
		$this->_arr_value['removeList'] = $bs->popObject('stl_vector<\ecc\deal\bo\EventParamsRemoveGoodsBo>');	//<std::vector<ecc::deal::bo::CEventParamsRemoveGoodsBo> > 删除商品列表
		$this->_arr_value['operateDesc'] = $bs->popString();	//<std::string> 描述
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 保留字段
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['addList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['removeList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operateDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserve_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.EventParamsOperGoodsBo.java
class EventParamsRemoveGoodsBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $tradeId;	//<uint64_t> 子单id(版本>=0)
	private $skuId;	//<uint64_t> 子单skuid(版本>=0)
	private $reserve;	//<std::string> 保留字段(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $tradeId_u;	//<uint8_t> (版本>=0)
	private $skuId_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)
	private $num;	//<uint32_t> 删除数量(版本>=1)
	private $num_u;	//<uint8_t> (版本>=1)

	function __construct(){
		$this->version = 1;	//<uint16_t>
		$this->tradeId = 0;	//<uint64_t>
		$this->skuId = 0;	//<uint64_t>
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->tradeId_u = 0;	//<uint8_t>
		$this->skuId_u = 0;	//<uint8_t>
		$this->reserve_u = 0;	//<uint8_t>
		$this->num = 0;	//<uint32_t>
		$this->num_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\bo\EventParamsRemoveGoodsBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\EventParamsRemoveGoodsBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushUint64_t($this->tradeId);	//<uint64_t> 子单id
		$bs->pushUint64_t($this->skuId);	//<uint64_t> 子单skuid
		$bs->pushString($this->reserve);	//<std::string> 保留字段
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->skuId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushUint32_t($this->num);	//<uint32_t> 删除数量
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->num_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['tradeId'] = $bs->popUint64_t();	//<uint64_t> 子单id
		$this->_arr_value['skuId'] = $bs->popUint64_t();	//<uint64_t> 子单skuid
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 保留字段
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserve_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['num'] = $bs->popUint32_t();	//<uint32_t> 删除数量
		}
		if($this->version >= 1){
			$this->_arr_value['num_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.EventParamsOperGoodsBo.java
class EventParamsAddGoodsBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $itemType;	//<uint32_t> 商品类型；1：普通商品；2：套餐主商品；3：套餐副商品；4：赠品主商品；5：赠品副商品；6：组件(版本>=0)
	private $itemClassId;	//<uint32_t> 品类（类目）ID(版本>=0)
	private $itemTitle;	//<std::string> 商品标题(版本>=0)
	private $itemAttrCode;	//<std::string> 商品销售属性编码(版本>=0)
	private $itemAttr;	//<std::string> 商品销售属性描述(版本>=0)
	private $itemId;	//<std::string> 商品显示ID，由业务定义(版本>=0)
	private $itemSkuId;	//<uint64_t> 商品SKUID(版本>=0)
	private $itemLocalCode;	//<std::string> 商品商家本地编码(版本>=0)
	private $itemLocalStockCode;	//<std::string> 商品商家本地库存编码(版本>=0)
	private $itemBarCode;	//<std::string> 商品条形码(版本>=0)
	private $itemStockId;	//<uint64_t> 商品库存ID(版本>=0)
	private $itemStoreHouseId;	//<uint32_t> 商品仓库ID(版本>=0)
	private $itemPhyisicalStorage;	//<std::string> 商品所属物理仓(版本>=0)
	private $itemLogo;	//<std::string> 商品图片Logo，业务自定义(版本>=0)
	private $itemSnapVersion;	//<uint32_t> 商品快照版本号(版本>=0)
	private $itemResetTime;	//<uint32_t> 商品重置时间戳(版本>=0)
	private $itemWeight;	//<uint32_t> 商品重量(版本>=0)
	private $itemVolume;	//<uint32_t> 商品体积(版本>=0)
	private $mainItemId;	//<uint64_t> 商品套餐主商品ID(版本>=0)
	private $itemAccessoryDesc;	//<std::string> 商品标配说明(版本>=0)
	private $itemCostPrice;	//<uint32_t> 商品成本价(版本>=0)
	private $itemOriginPrice;	//<uint32_t> 商品市场价(版本>=0)
	private $itemSoldPrice;	//<uint32_t> 商品销售单价(版本>=0)
	private $itemB2CMarket;	//<std::string> 自营B2C市场(版本>=0)
	private $itemB2CPM;	//<std::string> 自营B2CPM(版本>=0)
	private $itemUseVirtualStock;	//<uint8_t> 自营B2C是否占用虚库(版本>=0)
	private $buyPrice;	//<uint32_t> 商品成交价(版本>=0)
	private $buyNum;	//<uint32_t> 商品成交件数(版本>=0)
	private $tradeTotalFee;	//<uint32_t> 商品单总金额,下单金额(版本>=0)
	private $tradeAdjustFee;	//<int> 商品单调价金额(版本>=0)
	private $tradePayment;	//<uint32_t> 实付总金额(版本>=0)
	private $tradeDiscountTotal;	//<int> 优惠总金额(版本>=0)
	private $payScore;	//<uint32_t> 积分支付值(版本>=0)
	private $tradeOpSerialNo;	//<uint16_t> 商品单库存操作序列号(版本>=0)
	private $obtainScore;	//<uint32_t> 获得积分值(版本>=0)
	private $tradeCommProperty;	//<uint32_t> 通用属性值(版本>=0)
	private $tradeBusinessProperty;	//<uint32_t> 业务属性值(版本>=0)
	private $warranty;	//<std::string> 保修条款(版本>=0)
	private $icsonEdmCode;	//<std::string> 易迅edm编码(版本>=0)
	private $icsonOTag;	//<std::string> 易迅OTag(版本>=0)
	private $icsonTradeShopGuideCost;	//<std::string> 易迅店铺导购费用(版本>=0)
	private $icsonCSPhoneType;	//<std::string> 易迅定制机类型(版本>=0)
	private $icsonCSPhoneOperator;	//<std::string> 易迅定制机运营商(版本>=0)
	private $icsonCSPhoneNumber;	//<std::string> 易迅定制机号码(版本>=0)
	private $icsonCSPhoneArea;	//<std::string> 易迅定制机归属地(版本>=0)
	private $icsonCSPhonePackageId;	//<std::string> 易迅定制机套餐id(版本>=0)
	private $icsonCSPhoneUserName;	//<std::string> 易迅定制机用户姓名(版本>=0)
	private $icsonCSPhoneUserAddr;	//<std::string> 易迅定制机用户地址(版本>=0)
	private $icsonCSPhoneUserMobile;	//<std::string> 易迅定制机用户联系手机(版本>=0)
	private $icsonCSPhoneUserTel;	//<std::string> 易迅定制机用户联系电话(版本>=0)
	private $icsonCSPhoneIdCardNo;	//<std::string> 易迅定制机身份证号码(版本>=0)
	private $icsonCSPhoneIdCardAddr;	//<std::string> 易迅定制机身份证地址(版本>=0)
	private $icsonCSPhoneIdCardDate;	//<std::string> 易迅定制机身份证有效期(版本>=0)
	private $icsonCSPhoneZipCode;	//<std::string> 易迅定制机邮政编码(版本>=0)
	private $icsonCSPhoneCardPrice;	//<std::string> 易迅定制机卡价格(版本>=0)
	private $icsonCSPhonePackagePrice;	//<std::string> 易迅定制机套餐价格(版本>=0)
	private $reserve;	//<std::string> 保留字段(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $itemType_u;	//<uint8_t> (版本>=0)
	private $itemClassId_u;	//<uint8_t> (版本>=0)
	private $itemTitle_u;	//<uint8_t> (版本>=0)
	private $itemAttrCode_u;	//<uint8_t> (版本>=0)
	private $itemAttr_u;	//<uint8_t> (版本>=0)
	private $itemId_u;	//<uint8_t> (版本>=0)
	private $itemSkuId_u;	//<uint8_t> (版本>=0)
	private $itemLocalCode_u;	//<uint8_t> (版本>=0)
	private $itemLocalStockCode_u;	//<uint8_t> (版本>=0)
	private $itemBarCode_u;	//<uint8_t> (版本>=0)
	private $itemStockId_u;	//<uint8_t> (版本>=0)
	private $itemStoreHouseId_u;	//<uint8_t> (版本>=0)
	private $itemPhyisicalStorage_u;	//<uint8_t> (版本>=0)
	private $itemLogo_u;	//<uint8_t> (版本>=0)
	private $itemSnapVersion_u;	//<uint8_t> (版本>=0)
	private $itemResetTime_u;	//<uint8_t> (版本>=0)
	private $itemWeight_u;	//<uint8_t> (版本>=0)
	private $itemVolume_u;	//<uint8_t> (版本>=0)
	private $mainItemId_u;	//<uint8_t> (版本>=0)
	private $itemAccessoryDesc_u;	//<uint8_t> (版本>=0)
	private $itemCostPrice_u;	//<uint8_t> (版本>=0)
	private $itemOriginPrice_u;	//<uint8_t> (版本>=0)
	private $itemSoldPrice_u;	//<uint8_t> (版本>=0)
	private $itemB2CMarket_u;	//<uint8_t> (版本>=0)
	private $itemB2CPM_u;	//<uint8_t> (版本>=0)
	private $itemUseVirtualStock_u;	//<uint8_t> (版本>=0)
	private $buyPrice_u;	//<uint8_t> (版本>=0)
	private $buyNum_u;	//<uint8_t> (版本>=0)
	private $tradeTotalFee_u;	//<uint8_t> (版本>=0)
	private $tradeAdjustFee_u;	//<uint8_t> (版本>=0)
	private $tradePayment_u;	//<uint8_t> (版本>=0)
	private $tradeDiscountTotal_u;	//<uint8_t> (版本>=0)
	private $payScore_u;	//<uint8_t> (版本>=0)
	private $tradeOpSerialNo_u;	//<uint8_t> (版本>=0)
	private $obtainScore_u;	//<uint8_t> (版本>=0)
	private $tradeCommProperty_u;	//<uint8_t> (版本>=0)
	private $tradeBusinessProperty_u;	//<uint8_t> (版本>=0)
	private $warranty_u;	//<uint8_t> (版本>=0)
	private $icsonEdmCode_u;	//<uint8_t> (版本>=0)
	private $icsonOTag_u;	//<uint8_t> (版本>=0)
	private $icsonTradeShopGuideCost_u;	//<uint8_t> (版本>=0)
	private $icsonCSPhoneType_u;	//<uint8_t> (版本>=0)
	private $icsonCSPhoneOperator_u;	//<uint8_t> (版本>=0)
	private $icsonCSPhoneNumber_u;	//<uint8_t> (版本>=0)
	private $icsonCSPhoneArea_u;	//<uint8_t> (版本>=0)
	private $icsonCSPhonePackageId_u;	//<uint8_t> (版本>=0)
	private $icsonCSPhoneUserName_u;	//<uint8_t> (版本>=0)
	private $icsonCSPhoneUserAddr_u;	//<uint8_t> (版本>=0)
	private $icsonCSPhoneUserMobile_u;	//<uint8_t> (版本>=0)
	private $icsonCSPhoneUserTel_u;	//<uint8_t> (版本>=0)
	private $icsonCSPhoneIdCardNo_u;	//<uint8_t> (版本>=0)
	private $icsonCSPhoneIdCardAddr_u;	//<uint8_t> (版本>=0)
	private $icsonCSPhoneIdCardDate_u;	//<uint8_t> (版本>=0)
	private $icsonCSPhoneZipCode_u;	//<uint8_t> (版本>=0)
	private $icsonCSPhoneCardPrice_u;	//<uint8_t> (版本>=0)
	private $icsonCSPhonePackagePrice_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)
	private $productId;	//<uint64_t> 产品id(版本>=1)
	private $productCode;	//<std::string> 产品id编码(版本>=1)
	private $icsonTradeFlag;	//<std::string> 易迅商品子单flag(版本>=1)
	private $icsonPointType;	//<std::string> 易迅积分兑换类型(版本>=1)
	private $icsonTradeCashBack;	//<uint32_t> 子单返现金额(版本>=1)
	private $icsonUnitCostInvoice;	//<std::string> 去税后成本(版本>=1)
	private $productId_u;	//<uint8_t> (版本>=1)
	private $productCode_u;	//<uint8_t> (版本>=1)
	private $icsonTradeFlag_u;	//<uint8_t> (版本>=1)
	private $icsonPointType_u;	//<uint8_t> (版本>=1)
	private $icsonTradeCashBack_u;	//<uint8_t> (版本>=1)
	private $icsonUnitCostInvoice_u;	//<uint8_t> (版本>=1)

	function __construct(){
		$this->version = 1;	//<uint16_t>
		$this->itemType = 0;	//<uint32_t>
		$this->itemClassId = 0;	//<uint32_t>
		$this->itemTitle = "";	//<std::string>
		$this->itemAttrCode = "";	//<std::string>
		$this->itemAttr = "";	//<std::string>
		$this->itemId = "";	//<std::string>
		$this->itemSkuId = 0;	//<uint64_t>
		$this->itemLocalCode = "";	//<std::string>
		$this->itemLocalStockCode = "";	//<std::string>
		$this->itemBarCode = "";	//<std::string>
		$this->itemStockId = 0;	//<uint64_t>
		$this->itemStoreHouseId = 0;	//<uint32_t>
		$this->itemPhyisicalStorage = "";	//<std::string>
		$this->itemLogo = "";	//<std::string>
		$this->itemSnapVersion = 0;	//<uint32_t>
		$this->itemResetTime = 0;	//<uint32_t>
		$this->itemWeight = 0;	//<uint32_t>
		$this->itemVolume = 0;	//<uint32_t>
		$this->mainItemId = 0;	//<uint64_t>
		$this->itemAccessoryDesc = "";	//<std::string>
		$this->itemCostPrice = 0;	//<uint32_t>
		$this->itemOriginPrice = 0;	//<uint32_t>
		$this->itemSoldPrice = 0;	//<uint32_t>
		$this->itemB2CMarket = "";	//<std::string>
		$this->itemB2CPM = "";	//<std::string>
		$this->itemUseVirtualStock = 0;	//<uint8_t>
		$this->buyPrice = 0;	//<uint32_t>
		$this->buyNum = 0;	//<uint32_t>
		$this->tradeTotalFee = 0;	//<uint32_t>
		$this->tradeAdjustFee = 0;	//<int>
		$this->tradePayment = 0;	//<uint32_t>
		$this->tradeDiscountTotal = 0;	//<int>
		$this->payScore = 0;	//<uint32_t>
		$this->tradeOpSerialNo = 0;	//<uint16_t>
		$this->obtainScore = 0;	//<uint32_t>
		$this->tradeCommProperty = 0;	//<uint32_t>
		$this->tradeBusinessProperty = 0;	//<uint32_t>
		$this->warranty = "";	//<std::string>
		$this->icsonEdmCode = "";	//<std::string>
		$this->icsonOTag = "";	//<std::string>
		$this->icsonTradeShopGuideCost = "";	//<std::string>
		$this->icsonCSPhoneType = "";	//<std::string>
		$this->icsonCSPhoneOperator = "";	//<std::string>
		$this->icsonCSPhoneNumber = "";	//<std::string>
		$this->icsonCSPhoneArea = "";	//<std::string>
		$this->icsonCSPhonePackageId = "";	//<std::string>
		$this->icsonCSPhoneUserName = "";	//<std::string>
		$this->icsonCSPhoneUserAddr = "";	//<std::string>
		$this->icsonCSPhoneUserMobile = "";	//<std::string>
		$this->icsonCSPhoneUserTel = "";	//<std::string>
		$this->icsonCSPhoneIdCardNo = "";	//<std::string>
		$this->icsonCSPhoneIdCardAddr = "";	//<std::string>
		$this->icsonCSPhoneIdCardDate = "";	//<std::string>
		$this->icsonCSPhoneZipCode = "";	//<std::string>
		$this->icsonCSPhoneCardPrice = "";	//<std::string>
		$this->icsonCSPhonePackagePrice = "";	//<std::string>
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->itemType_u = 0;	//<uint8_t>
		$this->itemClassId_u = 0;	//<uint8_t>
		$this->itemTitle_u = 0;	//<uint8_t>
		$this->itemAttrCode_u = 0;	//<uint8_t>
		$this->itemAttr_u = 0;	//<uint8_t>
		$this->itemId_u = 0;	//<uint8_t>
		$this->itemSkuId_u = 0;	//<uint8_t>
		$this->itemLocalCode_u = 0;	//<uint8_t>
		$this->itemLocalStockCode_u = 0;	//<uint8_t>
		$this->itemBarCode_u = 0;	//<uint8_t>
		$this->itemStockId_u = 0;	//<uint8_t>
		$this->itemStoreHouseId_u = 0;	//<uint8_t>
		$this->itemPhyisicalStorage_u = 0;	//<uint8_t>
		$this->itemLogo_u = 0;	//<uint8_t>
		$this->itemSnapVersion_u = 0;	//<uint8_t>
		$this->itemResetTime_u = 0;	//<uint8_t>
		$this->itemWeight_u = 0;	//<uint8_t>
		$this->itemVolume_u = 0;	//<uint8_t>
		$this->mainItemId_u = 0;	//<uint8_t>
		$this->itemAccessoryDesc_u = 0;	//<uint8_t>
		$this->itemCostPrice_u = 0;	//<uint8_t>
		$this->itemOriginPrice_u = 0;	//<uint8_t>
		$this->itemSoldPrice_u = 0;	//<uint8_t>
		$this->itemB2CMarket_u = 0;	//<uint8_t>
		$this->itemB2CPM_u = 0;	//<uint8_t>
		$this->itemUseVirtualStock_u = 0;	//<uint8_t>
		$this->buyPrice_u = 0;	//<uint8_t>
		$this->buyNum_u = 0;	//<uint8_t>
		$this->tradeTotalFee_u = 0;	//<uint8_t>
		$this->tradeAdjustFee_u = 0;	//<uint8_t>
		$this->tradePayment_u = 0;	//<uint8_t>
		$this->tradeDiscountTotal_u = 0;	//<uint8_t>
		$this->payScore_u = 0;	//<uint8_t>
		$this->tradeOpSerialNo_u = 0;	//<uint8_t>
		$this->obtainScore_u = 0;	//<uint8_t>
		$this->tradeCommProperty_u = 0;	//<uint8_t>
		$this->tradeBusinessProperty_u = 0;	//<uint8_t>
		$this->warranty_u = 0;	//<uint8_t>
		$this->icsonEdmCode_u = 0;	//<uint8_t>
		$this->icsonOTag_u = 0;	//<uint8_t>
		$this->icsonTradeShopGuideCost_u = 0;	//<uint8_t>
		$this->icsonCSPhoneType_u = 0;	//<uint8_t>
		$this->icsonCSPhoneOperator_u = 0;	//<uint8_t>
		$this->icsonCSPhoneNumber_u = 0;	//<uint8_t>
		$this->icsonCSPhoneArea_u = 0;	//<uint8_t>
		$this->icsonCSPhonePackageId_u = 0;	//<uint8_t>
		$this->icsonCSPhoneUserName_u = 0;	//<uint8_t>
		$this->icsonCSPhoneUserAddr_u = 0;	//<uint8_t>
		$this->icsonCSPhoneUserMobile_u = 0;	//<uint8_t>
		$this->icsonCSPhoneUserTel_u = 0;	//<uint8_t>
		$this->icsonCSPhoneIdCardNo_u = 0;	//<uint8_t>
		$this->icsonCSPhoneIdCardAddr_u = 0;	//<uint8_t>
		$this->icsonCSPhoneIdCardDate_u = 0;	//<uint8_t>
		$this->icsonCSPhoneZipCode_u = 0;	//<uint8_t>
		$this->icsonCSPhoneCardPrice_u = 0;	//<uint8_t>
		$this->icsonCSPhonePackagePrice_u = 0;	//<uint8_t>
		$this->reserve_u = 0;	//<uint8_t>
		$this->productId = 0;	//<uint64_t>
		$this->productCode = "";	//<std::string>
		$this->icsonTradeFlag = "";	//<std::string>
		$this->icsonPointType = "";	//<std::string>
		$this->icsonTradeCashBack = 0;	//<uint32_t>
		$this->icsonUnitCostInvoice = "";	//<std::string>
		$this->productId_u = 0;	//<uint8_t>
		$this->productCode_u = 0;	//<uint8_t>
		$this->icsonTradeFlag_u = 0;	//<uint8_t>
		$this->icsonPointType_u = 0;	//<uint8_t>
		$this->icsonTradeCashBack_u = 0;	//<uint8_t>
		$this->icsonUnitCostInvoice_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\bo\EventParamsAddGoodsBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\EventParamsAddGoodsBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushUint32_t($this->itemType);	//<uint32_t> 商品类型；1：普通商品；2：套餐主商品；3：套餐副商品；4：赠品主商品；5：赠品副商品；6：组件
		$bs->pushUint32_t($this->itemClassId);	//<uint32_t> 品类（类目）ID
		$bs->pushString($this->itemTitle);	//<std::string> 商品标题
		$bs->pushString($this->itemAttrCode);	//<std::string> 商品销售属性编码
		$bs->pushString($this->itemAttr);	//<std::string> 商品销售属性描述
		$bs->pushString($this->itemId);	//<std::string> 商品显示ID，由业务定义
		$bs->pushUint64_t($this->itemSkuId);	//<uint64_t> 商品SKUID
		$bs->pushString($this->itemLocalCode);	//<std::string> 商品商家本地编码
		$bs->pushString($this->itemLocalStockCode);	//<std::string> 商品商家本地库存编码
		$bs->pushString($this->itemBarCode);	//<std::string> 商品条形码
		$bs->pushUint64_t($this->itemStockId);	//<uint64_t> 商品库存ID
		$bs->pushUint32_t($this->itemStoreHouseId);	//<uint32_t> 商品仓库ID
		$bs->pushString($this->itemPhyisicalStorage);	//<std::string> 商品所属物理仓
		$bs->pushString($this->itemLogo);	//<std::string> 商品图片Logo，业务自定义
		$bs->pushUint32_t($this->itemSnapVersion);	//<uint32_t> 商品快照版本号
		$bs->pushUint32_t($this->itemResetTime);	//<uint32_t> 商品重置时间戳
		$bs->pushUint32_t($this->itemWeight);	//<uint32_t> 商品重量
		$bs->pushUint32_t($this->itemVolume);	//<uint32_t> 商品体积
		$bs->pushUint64_t($this->mainItemId);	//<uint64_t> 商品套餐主商品ID
		$bs->pushString($this->itemAccessoryDesc);	//<std::string> 商品标配说明
		$bs->pushUint32_t($this->itemCostPrice);	//<uint32_t> 商品成本价
		$bs->pushUint32_t($this->itemOriginPrice);	//<uint32_t> 商品市场价
		$bs->pushUint32_t($this->itemSoldPrice);	//<uint32_t> 商品销售单价
		$bs->pushString($this->itemB2CMarket);	//<std::string> 自营B2C市场
		$bs->pushString($this->itemB2CPM);	//<std::string> 自营B2CPM
		$bs->pushUint8_t($this->itemUseVirtualStock);	//<uint8_t> 自营B2C是否占用虚库
		$bs->pushUint32_t($this->buyPrice);	//<uint32_t> 商品成交价
		$bs->pushUint32_t($this->buyNum);	//<uint32_t> 商品成交件数
		$bs->pushUint32_t($this->tradeTotalFee);	//<uint32_t> 商品单总金额,下单金额
		$bs->pushInt32_t($this->tradeAdjustFee);	//<int> 商品单调价金额
		$bs->pushUint32_t($this->tradePayment);	//<uint32_t> 实付总金额
		$bs->pushInt32_t($this->tradeDiscountTotal);	//<int> 优惠总金额
		$bs->pushUint32_t($this->payScore);	//<uint32_t> 积分支付值
		$bs->pushUint16_t($this->tradeOpSerialNo);	//<uint16_t> 商品单库存操作序列号
		$bs->pushUint32_t($this->obtainScore);	//<uint32_t> 获得积分值
		$bs->pushUint32_t($this->tradeCommProperty);	//<uint32_t> 通用属性值
		$bs->pushUint32_t($this->tradeBusinessProperty);	//<uint32_t> 业务属性值
		$bs->pushString($this->warranty);	//<std::string> 保修条款
		$bs->pushString($this->icsonEdmCode);	//<std::string> 易迅edm编码
		$bs->pushString($this->icsonOTag);	//<std::string> 易迅OTag
		$bs->pushString($this->icsonTradeShopGuideCost);	//<std::string> 易迅店铺导购费用
		$bs->pushString($this->icsonCSPhoneType);	//<std::string> 易迅定制机类型
		$bs->pushString($this->icsonCSPhoneOperator);	//<std::string> 易迅定制机运营商
		$bs->pushString($this->icsonCSPhoneNumber);	//<std::string> 易迅定制机号码
		$bs->pushString($this->icsonCSPhoneArea);	//<std::string> 易迅定制机归属地
		$bs->pushString($this->icsonCSPhonePackageId);	//<std::string> 易迅定制机套餐id
		$bs->pushString($this->icsonCSPhoneUserName);	//<std::string> 易迅定制机用户姓名
		$bs->pushString($this->icsonCSPhoneUserAddr);	//<std::string> 易迅定制机用户地址
		$bs->pushString($this->icsonCSPhoneUserMobile);	//<std::string> 易迅定制机用户联系手机
		$bs->pushString($this->icsonCSPhoneUserTel);	//<std::string> 易迅定制机用户联系电话
		$bs->pushString($this->icsonCSPhoneIdCardNo);	//<std::string> 易迅定制机身份证号码
		$bs->pushString($this->icsonCSPhoneIdCardAddr);	//<std::string> 易迅定制机身份证地址
		$bs->pushString($this->icsonCSPhoneIdCardDate);	//<std::string> 易迅定制机身份证有效期
		$bs->pushString($this->icsonCSPhoneZipCode);	//<std::string> 易迅定制机邮政编码
		$bs->pushString($this->icsonCSPhoneCardPrice);	//<std::string> 易迅定制机卡价格
		$bs->pushString($this->icsonCSPhonePackagePrice);	//<std::string> 易迅定制机套餐价格
		$bs->pushString($this->reserve);	//<std::string> 保留字段
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemClassId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemTitle_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemAttrCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemAttr_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemSkuId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemLocalCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemLocalStockCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemBarCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemStockId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemStoreHouseId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemPhyisicalStorage_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemLogo_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemSnapVersion_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemResetTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemWeight_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemVolume_u);	//<uint8_t> 
		$bs->pushUint8_t($this->mainItemId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemAccessoryDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemCostPrice_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemOriginPrice_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemSoldPrice_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemB2CMarket_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemB2CPM_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemUseVirtualStock_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyPrice_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyNum_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeTotalFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeAdjustFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradePayment_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeDiscountTotal_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payScore_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeOpSerialNo_u);	//<uint8_t> 
		$bs->pushUint8_t($this->obtainScore_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeCommProperty_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeBusinessProperty_u);	//<uint8_t> 
		$bs->pushUint8_t($this->warranty_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonEdmCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonOTag_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonTradeShopGuideCost_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonCSPhoneType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonCSPhoneOperator_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonCSPhoneNumber_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonCSPhoneArea_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonCSPhonePackageId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonCSPhoneUserName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonCSPhoneUserAddr_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonCSPhoneUserMobile_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonCSPhoneUserTel_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonCSPhoneIdCardNo_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonCSPhoneIdCardAddr_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonCSPhoneIdCardDate_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonCSPhoneZipCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonCSPhoneCardPrice_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonCSPhonePackagePrice_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushUint64_t($this->productId);	//<uint64_t> 产品id
		}
		if($this->version >= 1){
			$bs->pushString($this->productCode);	//<std::string> 产品id编码
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonTradeFlag);	//<std::string> 易迅商品子单flag
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonPointType);	//<std::string> 易迅积分兑换类型
		}
		if($this->version >= 1){
			$bs->pushUint32_t($this->icsonTradeCashBack);	//<uint32_t> 子单返现金额
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonUnitCostInvoice);	//<std::string> 去税后成本
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->productId_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->productCode_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonTradeFlag_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonPointType_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonTradeCashBack_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonUnitCostInvoice_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['itemType'] = $bs->popUint32_t();	//<uint32_t> 商品类型；1：普通商品；2：套餐主商品；3：套餐副商品；4：赠品主商品；5：赠品副商品；6：组件
		$this->_arr_value['itemClassId'] = $bs->popUint32_t();	//<uint32_t> 品类（类目）ID
		$this->_arr_value['itemTitle'] = $bs->popString();	//<std::string> 商品标题
		$this->_arr_value['itemAttrCode'] = $bs->popString();	//<std::string> 商品销售属性编码
		$this->_arr_value['itemAttr'] = $bs->popString();	//<std::string> 商品销售属性描述
		$this->_arr_value['itemId'] = $bs->popString();	//<std::string> 商品显示ID，由业务定义
		$this->_arr_value['itemSkuId'] = $bs->popUint64_t();	//<uint64_t> 商品SKUID
		$this->_arr_value['itemLocalCode'] = $bs->popString();	//<std::string> 商品商家本地编码
		$this->_arr_value['itemLocalStockCode'] = $bs->popString();	//<std::string> 商品商家本地库存编码
		$this->_arr_value['itemBarCode'] = $bs->popString();	//<std::string> 商品条形码
		$this->_arr_value['itemStockId'] = $bs->popUint64_t();	//<uint64_t> 商品库存ID
		$this->_arr_value['itemStoreHouseId'] = $bs->popUint32_t();	//<uint32_t> 商品仓库ID
		$this->_arr_value['itemPhyisicalStorage'] = $bs->popString();	//<std::string> 商品所属物理仓
		$this->_arr_value['itemLogo'] = $bs->popString();	//<std::string> 商品图片Logo，业务自定义
		$this->_arr_value['itemSnapVersion'] = $bs->popUint32_t();	//<uint32_t> 商品快照版本号
		$this->_arr_value['itemResetTime'] = $bs->popUint32_t();	//<uint32_t> 商品重置时间戳
		$this->_arr_value['itemWeight'] = $bs->popUint32_t();	//<uint32_t> 商品重量
		$this->_arr_value['itemVolume'] = $bs->popUint32_t();	//<uint32_t> 商品体积
		$this->_arr_value['mainItemId'] = $bs->popUint64_t();	//<uint64_t> 商品套餐主商品ID
		$this->_arr_value['itemAccessoryDesc'] = $bs->popString();	//<std::string> 商品标配说明
		$this->_arr_value['itemCostPrice'] = $bs->popUint32_t();	//<uint32_t> 商品成本价
		$this->_arr_value['itemOriginPrice'] = $bs->popUint32_t();	//<uint32_t> 商品市场价
		$this->_arr_value['itemSoldPrice'] = $bs->popUint32_t();	//<uint32_t> 商品销售单价
		$this->_arr_value['itemB2CMarket'] = $bs->popString();	//<std::string> 自营B2C市场
		$this->_arr_value['itemB2CPM'] = $bs->popString();	//<std::string> 自营B2CPM
		$this->_arr_value['itemUseVirtualStock'] = $bs->popUint8_t();	//<uint8_t> 自营B2C是否占用虚库
		$this->_arr_value['buyPrice'] = $bs->popUint32_t();	//<uint32_t> 商品成交价
		$this->_arr_value['buyNum'] = $bs->popUint32_t();	//<uint32_t> 商品成交件数
		$this->_arr_value['tradeTotalFee'] = $bs->popUint32_t();	//<uint32_t> 商品单总金额,下单金额
		$this->_arr_value['tradeAdjustFee'] = $bs->popInt32_t();	//<int> 商品单调价金额
		$this->_arr_value['tradePayment'] = $bs->popUint32_t();	//<uint32_t> 实付总金额
		$this->_arr_value['tradeDiscountTotal'] = $bs->popInt32_t();	//<int> 优惠总金额
		$this->_arr_value['payScore'] = $bs->popUint32_t();	//<uint32_t> 积分支付值
		$this->_arr_value['tradeOpSerialNo'] = $bs->popUint16_t();	//<uint16_t> 商品单库存操作序列号
		$this->_arr_value['obtainScore'] = $bs->popUint32_t();	//<uint32_t> 获得积分值
		$this->_arr_value['tradeCommProperty'] = $bs->popUint32_t();	//<uint32_t> 通用属性值
		$this->_arr_value['tradeBusinessProperty'] = $bs->popUint32_t();	//<uint32_t> 业务属性值
		$this->_arr_value['warranty'] = $bs->popString();	//<std::string> 保修条款
		$this->_arr_value['icsonEdmCode'] = $bs->popString();	//<std::string> 易迅edm编码
		$this->_arr_value['icsonOTag'] = $bs->popString();	//<std::string> 易迅OTag
		$this->_arr_value['icsonTradeShopGuideCost'] = $bs->popString();	//<std::string> 易迅店铺导购费用
		$this->_arr_value['icsonCSPhoneType'] = $bs->popString();	//<std::string> 易迅定制机类型
		$this->_arr_value['icsonCSPhoneOperator'] = $bs->popString();	//<std::string> 易迅定制机运营商
		$this->_arr_value['icsonCSPhoneNumber'] = $bs->popString();	//<std::string> 易迅定制机号码
		$this->_arr_value['icsonCSPhoneArea'] = $bs->popString();	//<std::string> 易迅定制机归属地
		$this->_arr_value['icsonCSPhonePackageId'] = $bs->popString();	//<std::string> 易迅定制机套餐id
		$this->_arr_value['icsonCSPhoneUserName'] = $bs->popString();	//<std::string> 易迅定制机用户姓名
		$this->_arr_value['icsonCSPhoneUserAddr'] = $bs->popString();	//<std::string> 易迅定制机用户地址
		$this->_arr_value['icsonCSPhoneUserMobile'] = $bs->popString();	//<std::string> 易迅定制机用户联系手机
		$this->_arr_value['icsonCSPhoneUserTel'] = $bs->popString();	//<std::string> 易迅定制机用户联系电话
		$this->_arr_value['icsonCSPhoneIdCardNo'] = $bs->popString();	//<std::string> 易迅定制机身份证号码
		$this->_arr_value['icsonCSPhoneIdCardAddr'] = $bs->popString();	//<std::string> 易迅定制机身份证地址
		$this->_arr_value['icsonCSPhoneIdCardDate'] = $bs->popString();	//<std::string> 易迅定制机身份证有效期
		$this->_arr_value['icsonCSPhoneZipCode'] = $bs->popString();	//<std::string> 易迅定制机邮政编码
		$this->_arr_value['icsonCSPhoneCardPrice'] = $bs->popString();	//<std::string> 易迅定制机卡价格
		$this->_arr_value['icsonCSPhonePackagePrice'] = $bs->popString();	//<std::string> 易迅定制机套餐价格
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 保留字段
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemClassId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemTitle_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemAttrCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemAttr_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemSkuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemLocalCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemLocalStockCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemBarCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemStockId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemStoreHouseId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemPhyisicalStorage_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemLogo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemSnapVersion_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemResetTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemWeight_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemVolume_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mainItemId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemAccessoryDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemCostPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemOriginPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemSoldPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemB2CMarket_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemB2CPM_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemUseVirtualStock_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeTotalFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeAdjustFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradePayment_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeDiscountTotal_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payScore_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeOpSerialNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['obtainScore_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeCommProperty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeBusinessProperty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['warranty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonEdmCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonOTag_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonTradeShopGuideCost_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonCSPhoneType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonCSPhoneOperator_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonCSPhoneNumber_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonCSPhoneArea_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonCSPhonePackageId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonCSPhoneUserName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonCSPhoneUserAddr_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonCSPhoneUserMobile_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonCSPhoneUserTel_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonCSPhoneIdCardNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonCSPhoneIdCardAddr_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonCSPhoneIdCardDate_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonCSPhoneZipCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonCSPhoneCardPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonCSPhonePackagePrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserve_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['productId'] = $bs->popUint64_t();	//<uint64_t> 产品id
		}
		if($this->version >= 1){
			$this->_arr_value['productCode'] = $bs->popString();	//<std::string> 产品id编码
		}
		if($this->version >= 1){
			$this->_arr_value['icsonTradeFlag'] = $bs->popString();	//<std::string> 易迅商品子单flag
		}
		if($this->version >= 1){
			$this->_arr_value['icsonPointType'] = $bs->popString();	//<std::string> 易迅积分兑换类型
		}
		if($this->version >= 1){
			$this->_arr_value['icsonTradeCashBack'] = $bs->popUint32_t();	//<uint32_t> 子单返现金额
		}
		if($this->version >= 1){
			$this->_arr_value['icsonUnitCostInvoice'] = $bs->popString();	//<std::string> 去税后成本
		}
		if($this->version >= 1){
			$this->_arr_value['productId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['productCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonTradeFlag_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonPointType_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonTradeCashBack_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonUnitCostInvoice_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.NotifyBuyDealPaymentReq.java
class EventParamsPayBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $feeCash;	//<uint32_t> 现金支付金额(版本>=0)
	private $feeTicket;	//<uint32_t> 财付通现金券支付金额(版本>=0)
	private $feeVFee;	//<uint32_t> 折扣券支付金额(版本>=0)
	private $feeScore;	//<uint32_t> 积分支付金额(版本>=0)
	private $feeCaibei;	//<uint32_t> 彩贝支付金额(版本>=0)
	private $feeOther;	//<uint32_t> 其他支付金额(版本>=0)
	private $procedureFee;	//<uint32_t> 交易手续费，第三方支付平台或银行支付时返回(版本>=0)
	private $payTime;	//<uint32_t> 支付时间(版本>=0)
	private $payId;	//<uint64_t> 支付单号，统一订单后台的支付单id，没有则不传(版本>=0)
	private $payDealId;	//<std::string> 支付订单号，如财付通单号，支付宝单号等(版本>=0)
	private $bankType;	//<std::string> 银行类型(版本>=0)
	private $otherPayAccount;	//<std::string> 他人代付帐号(版本>=0)
	private $bindAccount;	//<std::string> 绑定账户(版本>=0)
	private $payBusinessId;	//<std::string> 支付业务单号，支付系统的业务订单号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $feeCash_u;	//<uint8_t> (版本>=0)
	private $feeTicket_u;	//<uint8_t> (版本>=0)
	private $feeVFee_u;	//<uint8_t> (版本>=0)
	private $feeScore_u;	//<uint8_t> (版本>=0)
	private $feeCaibei_u;	//<uint8_t> (版本>=0)
	private $feeOther_u;	//<uint8_t> (版本>=0)
	private $procedureFee_u;	//<uint8_t> (版本>=0)
	private $payTime_u;	//<uint8_t> (版本>=0)
	private $payId_u;	//<uint8_t> (版本>=0)
	private $payDealId_u;	//<uint8_t> (版本>=0)
	private $bankType_u;	//<uint8_t> (版本>=0)
	private $otherPayAccount_u;	//<uint8_t> (版本>=0)
	private $bindAccount_u;	//<uint8_t> (版本>=0)
	private $payBusinessId_u;	//<uint8_t> (版本>=0)
	private $paySeqId;	//<std::string> 统一支付平台的支付单号(版本>=1)
	private $paySeqId_u;	//<uint8_t> (版本>=1)

	function __construct(){
		$this->version = 1;	//<uint16_t>
		$this->feeCash = 0;	//<uint32_t>
		$this->feeTicket = 0;	//<uint32_t>
		$this->feeVFee = 0;	//<uint32_t>
		$this->feeScore = 0;	//<uint32_t>
		$this->feeCaibei = 0;	//<uint32_t>
		$this->feeOther = 0;	//<uint32_t>
		$this->procedureFee = 0;	//<uint32_t>
		$this->payTime = 0;	//<uint32_t>
		$this->payId = 0;	//<uint64_t>
		$this->payDealId = "";	//<std::string>
		$this->bankType = "";	//<std::string>
		$this->otherPayAccount = "";	//<std::string>
		$this->bindAccount = "";	//<std::string>
		$this->payBusinessId = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->feeCash_u = 0;	//<uint8_t>
		$this->feeTicket_u = 0;	//<uint8_t>
		$this->feeVFee_u = 0;	//<uint8_t>
		$this->feeScore_u = 0;	//<uint8_t>
		$this->feeCaibei_u = 0;	//<uint8_t>
		$this->feeOther_u = 0;	//<uint8_t>
		$this->procedureFee_u = 0;	//<uint8_t>
		$this->payTime_u = 0;	//<uint8_t>
		$this->payId_u = 0;	//<uint8_t>
		$this->payDealId_u = 0;	//<uint8_t>
		$this->bankType_u = 0;	//<uint8_t>
		$this->otherPayAccount_u = 0;	//<uint8_t>
		$this->bindAccount_u = 0;	//<uint8_t>
		$this->payBusinessId_u = 0;	//<uint8_t>
		$this->paySeqId = "";	//<std::string>
		$this->paySeqId_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\bo\EventParamsPayBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\EventParamsPayBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushUint32_t($this->feeCash);	//<uint32_t> 现金支付金额
		$bs->pushUint32_t($this->feeTicket);	//<uint32_t> 财付通现金券支付金额
		$bs->pushUint32_t($this->feeVFee);	//<uint32_t> 折扣券支付金额
		$bs->pushUint32_t($this->feeScore);	//<uint32_t> 积分支付金额
		$bs->pushUint32_t($this->feeCaibei);	//<uint32_t> 彩贝支付金额
		$bs->pushUint32_t($this->feeOther);	//<uint32_t> 其他支付金额
		$bs->pushUint32_t($this->procedureFee);	//<uint32_t> 交易手续费，第三方支付平台或银行支付时返回
		$bs->pushUint32_t($this->payTime);	//<uint32_t> 支付时间
		$bs->pushUint64_t($this->payId);	//<uint64_t> 支付单号，统一订单后台的支付单id，没有则不传
		$bs->pushString($this->payDealId);	//<std::string> 支付订单号，如财付通单号，支付宝单号等
		$bs->pushString($this->bankType);	//<std::string> 银行类型
		$bs->pushString($this->otherPayAccount);	//<std::string> 他人代付帐号
		$bs->pushString($this->bindAccount);	//<std::string> 绑定账户
		$bs->pushString($this->payBusinessId);	//<std::string> 支付业务单号，支付系统的业务订单号
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->feeCash_u);	//<uint8_t> 
		$bs->pushUint8_t($this->feeTicket_u);	//<uint8_t> 
		$bs->pushUint8_t($this->feeVFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->feeScore_u);	//<uint8_t> 
		$bs->pushUint8_t($this->feeCaibei_u);	//<uint8_t> 
		$bs->pushUint8_t($this->feeOther_u);	//<uint8_t> 
		$bs->pushUint8_t($this->procedureFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payDealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bankType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->otherPayAccount_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bindAccount_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payBusinessId_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushString($this->paySeqId);	//<std::string> 统一支付平台的支付单号
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->paySeqId_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['feeCash'] = $bs->popUint32_t();	//<uint32_t> 现金支付金额
		$this->_arr_value['feeTicket'] = $bs->popUint32_t();	//<uint32_t> 财付通现金券支付金额
		$this->_arr_value['feeVFee'] = $bs->popUint32_t();	//<uint32_t> 折扣券支付金额
		$this->_arr_value['feeScore'] = $bs->popUint32_t();	//<uint32_t> 积分支付金额
		$this->_arr_value['feeCaibei'] = $bs->popUint32_t();	//<uint32_t> 彩贝支付金额
		$this->_arr_value['feeOther'] = $bs->popUint32_t();	//<uint32_t> 其他支付金额
		$this->_arr_value['procedureFee'] = $bs->popUint32_t();	//<uint32_t> 交易手续费，第三方支付平台或银行支付时返回
		$this->_arr_value['payTime'] = $bs->popUint32_t();	//<uint32_t> 支付时间
		$this->_arr_value['payId'] = $bs->popUint64_t();	//<uint64_t> 支付单号，统一订单后台的支付单id，没有则不传
		$this->_arr_value['payDealId'] = $bs->popString();	//<std::string> 支付订单号，如财付通单号，支付宝单号等
		$this->_arr_value['bankType'] = $bs->popString();	//<std::string> 银行类型
		$this->_arr_value['otherPayAccount'] = $bs->popString();	//<std::string> 他人代付帐号
		$this->_arr_value['bindAccount'] = $bs->popString();	//<std::string> 绑定账户
		$this->_arr_value['payBusinessId'] = $bs->popString();	//<std::string> 支付业务单号，支付系统的业务订单号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['feeCash_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['feeTicket_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['feeVFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['feeScore_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['feeCaibei_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['feeOther_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['procedureFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payDealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bankType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['otherPayAccount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bindAccount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payBusinessId_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['paySeqId'] = $bs->popString();	//<std::string> 统一支付平台的支付单号
		}
		if($this->version >= 1){
			$this->_arr_value['paySeqId_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.ModifyValueAddedTaxInvoiceReq.java
class SyncValueAddedTaxInvoiceBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 版本号(版本>=0)
	private $operateTime;	//<uint32_t> 操作时间(版本>=0)
	private $operationDesc;	//<std::string> 操作描述(版本>=0)
	private $companyName;	//<std::string> 公司名称(版本>=0)
	private $companyAddr;	//<std::string> 公司地址(版本>=0)
	private $companyPhone;	//<std::string> 公司电话(版本>=0)
	private $companyTaxNo;	//<std::string> 税号(版本>=0)
	private $bankAccount;	//<std::string> 银行账户(版本>=0)
	private $bankInfo;	//<std::string> 银行信息(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $operateTime_u;	//<uint8_t> (版本>=0)
	private $operationDesc_u;	//<uint8_t> (版本>=0)
	private $companyName_u;	//<uint8_t> (版本>=0)
	private $companyAddr_u;	//<uint8_t> (版本>=0)
	private $companyPhone_u;	//<uint8_t> (版本>=0)
	private $companyTaxNo_u;	//<uint8_t> (版本>=0)
	private $bankAccount_u;	//<uint8_t> (版本>=0)
	private $bankInfo_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->operateTime = 0;	//<uint32_t>
		$this->operationDesc = "";	//<std::string>
		$this->companyName = "";	//<std::string>
		$this->companyAddr = "";	//<std::string>
		$this->companyPhone = "";	//<std::string>
		$this->companyTaxNo = "";	//<std::string>
		$this->bankAccount = "";	//<std::string>
		$this->bankInfo = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->operateTime_u = 0;	//<uint8_t>
		$this->operationDesc_u = 0;	//<uint8_t>
		$this->companyName_u = 0;	//<uint8_t>
		$this->companyAddr_u = 0;	//<uint8_t>
		$this->companyPhone_u = 0;	//<uint8_t>
		$this->companyTaxNo_u = 0;	//<uint8_t>
		$this->bankAccount_u = 0;	//<uint8_t>
		$this->bankInfo_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\bo\SyncValueAddedTaxInvoiceBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\SyncValueAddedTaxInvoiceBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 版本号
		$bs->pushUint32_t($this->operateTime);	//<uint32_t> 操作时间
		$bs->pushString($this->operationDesc);	//<std::string> 操作描述
		$bs->pushString($this->companyName);	//<std::string> 公司名称
		$bs->pushString($this->companyAddr);	//<std::string> 公司地址
		$bs->pushString($this->companyPhone);	//<std::string> 公司电话
		$bs->pushString($this->companyTaxNo);	//<std::string> 税号
		$bs->pushString($this->bankAccount);	//<std::string> 银行账户
		$bs->pushString($this->bankInfo);	//<std::string> 银行信息
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operateTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operationDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->companyName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->companyAddr_u);	//<uint8_t> 
		$bs->pushUint8_t($this->companyPhone_u);	//<uint8_t> 
		$bs->pushUint8_t($this->companyTaxNo_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bankAccount_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bankInfo_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 版本号
		$this->_arr_value['operateTime'] = $bs->popUint32_t();	//<uint32_t> 操作时间
		$this->_arr_value['operationDesc'] = $bs->popString();	//<std::string> 操作描述
		$this->_arr_value['companyName'] = $bs->popString();	//<std::string> 公司名称
		$this->_arr_value['companyAddr'] = $bs->popString();	//<std::string> 公司地址
		$this->_arr_value['companyPhone'] = $bs->popString();	//<std::string> 公司电话
		$this->_arr_value['companyTaxNo'] = $bs->popString();	//<std::string> 税号
		$this->_arr_value['bankAccount'] = $bs->popString();	//<std::string> 银行账户
		$this->_arr_value['bankInfo'] = $bs->popString();	//<std::string> 银行信息
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operationDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['companyName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['companyAddr_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['companyPhone_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['companyTaxNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bankAccount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bankInfo_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.ModifySeparateInvoiceReq.java
class SyncSeparateInvoiceBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 版本号(版本>=0)
	private $operateTime;	//<uint32_t> 操作时间(版本>=0)
	private $operationDesc;	//<std::string> 操作描述(版本>=0)
	private $shipType;	//<uint32_t> 运送方式(版本>=0)
	private $recvRegionId;	//<uint32_t> 收货地址id(版本>=0)
	private $recvAddr;	//<std::string> 收货地址(版本>=0)
	private $recvName;	//<std::string> 收货人(版本>=0)
	private $recvMobile;	//<std::string> 收货人手机(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $operateTime_u;	//<uint8_t> (版本>=0)
	private $operationDesc_u;	//<uint8_t> (版本>=0)
	private $shipType_u;	//<uint8_t> (版本>=0)
	private $recvRegionId_u;	//<uint8_t> (版本>=0)
	private $recvAddr_u;	//<uint8_t> (版本>=0)
	private $recvName_u;	//<uint8_t> (版本>=0)
	private $recvMobile_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->operateTime = 0;	//<uint32_t>
		$this->operationDesc = "";	//<std::string>
		$this->shipType = 0;	//<uint32_t>
		$this->recvRegionId = 0;	//<uint32_t>
		$this->recvAddr = "";	//<std::string>
		$this->recvName = "";	//<std::string>
		$this->recvMobile = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->operateTime_u = 0;	//<uint8_t>
		$this->operationDesc_u = 0;	//<uint8_t>
		$this->shipType_u = 0;	//<uint8_t>
		$this->recvRegionId_u = 0;	//<uint8_t>
		$this->recvAddr_u = 0;	//<uint8_t>
		$this->recvName_u = 0;	//<uint8_t>
		$this->recvMobile_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\bo\SyncSeparateInvoiceBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\SyncSeparateInvoiceBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 版本号
		$bs->pushUint32_t($this->operateTime);	//<uint32_t> 操作时间
		$bs->pushString($this->operationDesc);	//<std::string> 操作描述
		$bs->pushUint32_t($this->shipType);	//<uint32_t> 运送方式
		$bs->pushUint32_t($this->recvRegionId);	//<uint32_t> 收货地址id
		$bs->pushString($this->recvAddr);	//<std::string> 收货地址
		$bs->pushString($this->recvName);	//<std::string> 收货人
		$bs->pushString($this->recvMobile);	//<std::string> 收货人手机
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operateTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operationDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->shipType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvRegionId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvAddr_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvMobile_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 版本号
		$this->_arr_value['operateTime'] = $bs->popUint32_t();	//<uint32_t> 操作时间
		$this->_arr_value['operationDesc'] = $bs->popString();	//<std::string> 操作描述
		$this->_arr_value['shipType'] = $bs->popUint32_t();	//<uint32_t> 运送方式
		$this->_arr_value['recvRegionId'] = $bs->popUint32_t();	//<uint32_t> 收货地址id
		$this->_arr_value['recvAddr'] = $bs->popString();	//<std::string> 收货地址
		$this->_arr_value['recvName'] = $bs->popString();	//<std::string> 收货人
		$this->_arr_value['recvMobile'] = $bs->popString();	//<std::string> 收货人手机
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operationDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shipType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvRegionId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvAddr_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvMobile_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.ModifyScoreReq.java
class EventParamsModifyScoreBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $operateTime;	//<uint32_t> 操作时间(版本>=0)
	private $payScore;	//<uint32_t> 使用积分值，指的是积分兑换金额，单位为分(版本>=0)
	private $operateDesc;	//<std::string> 描述(版本>=0)
	private $reserve;	//<std::string> 保留字段(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $operateTime_u;	//<uint8_t> (版本>=0)
	private $payScore_u;	//<uint8_t> (版本>=0)
	private $operateDesc_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)
	private $cashScore;	//<uint32_t> 现金积分，金额单位是分(版本>=1)
	private $promotionScore;	//<uint32_t> 促销积分，金额单位是分(版本>=1)
	private $pointObtain;	//<uint32_t> 获得积分(版本>=1)
	private $cashScore_u;	//<uint32_t> (版本>=1)
	private $promotionScore_u;	//<uint32_t> (版本>=1)
	private $pointObtain_u;	//<uint8_t> (版本>=1)

	function __construct(){
		$this->version = 1;	//<uint16_t>
		$this->operateTime = 0;	//<uint32_t>
		$this->payScore = 0;	//<uint32_t>
		$this->operateDesc = "";	//<std::string>
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->operateTime_u = 0;	//<uint8_t>
		$this->payScore_u = 0;	//<uint8_t>
		$this->operateDesc_u = 0;	//<uint8_t>
		$this->reserve_u = 0;	//<uint8_t>
		$this->cashScore = 0;	//<uint32_t>
		$this->promotionScore = 0;	//<uint32_t>
		$this->pointObtain = 0;	//<uint32_t>
		$this->cashScore_u = 0;	//<uint32_t>
		$this->promotionScore_u = 0;	//<uint32_t>
		$this->pointObtain_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\bo\EventParamsModifyScoreBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\EventParamsModifyScoreBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushUint32_t($this->operateTime);	//<uint32_t> 操作时间
		$bs->pushUint32_t($this->payScore);	//<uint32_t> 使用积分值，指的是积分兑换金额，单位为分
		$bs->pushString($this->operateDesc);	//<std::string> 描述
		$bs->pushString($this->reserve);	//<std::string> 保留字段
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operateTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payScore_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operateDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushUint32_t($this->cashScore);	//<uint32_t> 现金积分，金额单位是分
		}
		if($this->version >= 1){
			$bs->pushUint32_t($this->promotionScore);	//<uint32_t> 促销积分，金额单位是分
		}
		if($this->version >= 1){
			$bs->pushUint32_t($this->pointObtain);	//<uint32_t> 获得积分
		}
		if($this->version >= 1){
			$bs->pushUint32_t($this->cashScore_u);	//<uint32_t> 
		}
		if($this->version >= 1){
			$bs->pushUint32_t($this->promotionScore_u);	//<uint32_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->pointObtain_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['operateTime'] = $bs->popUint32_t();	//<uint32_t> 操作时间
		$this->_arr_value['payScore'] = $bs->popUint32_t();	//<uint32_t> 使用积分值，指的是积分兑换金额，单位为分
		$this->_arr_value['operateDesc'] = $bs->popString();	//<std::string> 描述
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 保留字段
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payScore_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operateDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserve_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['cashScore'] = $bs->popUint32_t();	//<uint32_t> 现金积分，金额单位是分
		}
		if($this->version >= 1){
			$this->_arr_value['promotionScore'] = $bs->popUint32_t();	//<uint32_t> 促销积分，金额单位是分
		}
		if($this->version >= 1){
			$this->_arr_value['pointObtain'] = $bs->popUint32_t();	//<uint32_t> 获得积分
		}
		if($this->version >= 1){
			$this->_arr_value['cashScore_u'] = $bs->popUint32_t();	//<uint32_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['promotionScore_u'] = $bs->popUint32_t();	//<uint32_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['pointObtain_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.ModifyReceiveInfoReq.java
class EventParamsModifyRecvInfoBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $operateTime;	//<uint32_t> 操作时间(版本>=0)
	private $regionCodeGB;	//<uint32_t> 收货地址区域id(国标:网购拍拍)(版本>=0)
	private $regionCodeGBD;	//<uint32_t> 收货地址区域id(国标细化:易迅)(版本>=0)
	private $recvAddress;	//<std::string> 收货地址(版本>=0)
	private $recvPostcode;	//<std::string> 邮编(版本>=0)
	private $recvName;	//<std::string> 联系人(版本>=0)
	private $recvMobile;	//<uint64_t> 联系手机(版本>=0)
	private $recvPhone;	//<std::string> 联系电话(版本>=0)
	private $operateDesc;	//<std::string> 描述(版本>=0)
	private $reserve;	//<std::string> 保留字段(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $operateTime_u;	//<uint8_t> (版本>=0)
	private $regionCodeGB_u;	//<uint8_t> (版本>=0)
	private $regionCodeGBD_u;	//<uint8_t> (版本>=0)
	private $recvAddress_u;	//<uint8_t> (版本>=0)
	private $recvPostcode_u;	//<uint8_t> (版本>=0)
	private $recvName_u;	//<uint8_t> (版本>=0)
	private $recvMobile_u;	//<uint8_t> (版本>=0)
	private $recvPhone_u;	//<uint8_t> (版本>=0)
	private $operateDesc_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)
	private $bizShipType;	//<uint32_t> 业务定义的配送方式，如易迅配送方式等(版本>=1)
	private $unpShipType;	//<uint32_t> 统一订单配送方式，统一订单定义(版本>=1)
	private $bizShipType_u;	//<uint8_t> (版本>=1)
	private $unpShipType_u;	//<uint8_t> (版本>=1)

	function __construct(){
		$this->version = 1;	//<uint16_t>
		$this->operateTime = 0;	//<uint32_t>
		$this->regionCodeGB = 0;	//<uint32_t>
		$this->regionCodeGBD = 0;	//<uint32_t>
		$this->recvAddress = "";	//<std::string>
		$this->recvPostcode = "";	//<std::string>
		$this->recvName = "";	//<std::string>
		$this->recvMobile = 0;	//<uint64_t>
		$this->recvPhone = "";	//<std::string>
		$this->operateDesc = "";	//<std::string>
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->operateTime_u = 0;	//<uint8_t>
		$this->regionCodeGB_u = 0;	//<uint8_t>
		$this->regionCodeGBD_u = 0;	//<uint8_t>
		$this->recvAddress_u = 0;	//<uint8_t>
		$this->recvPostcode_u = 0;	//<uint8_t>
		$this->recvName_u = 0;	//<uint8_t>
		$this->recvMobile_u = 0;	//<uint8_t>
		$this->recvPhone_u = 0;	//<uint8_t>
		$this->operateDesc_u = 0;	//<uint8_t>
		$this->reserve_u = 0;	//<uint8_t>
		$this->bizShipType = 0;	//<uint32_t>
		$this->unpShipType = 0;	//<uint32_t>
		$this->bizShipType_u = 0;	//<uint8_t>
		$this->unpShipType_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\bo\EventParamsModifyRecvInfoBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\EventParamsModifyRecvInfoBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushUint32_t($this->operateTime);	//<uint32_t> 操作时间
		$bs->pushUint32_t($this->regionCodeGB);	//<uint32_t> 收货地址区域id(国标:网购拍拍)
		$bs->pushUint32_t($this->regionCodeGBD);	//<uint32_t> 收货地址区域id(国标细化:易迅)
		$bs->pushString($this->recvAddress);	//<std::string> 收货地址
		$bs->pushString($this->recvPostcode);	//<std::string> 邮编
		$bs->pushString($this->recvName);	//<std::string> 联系人
		$bs->pushUint64_t($this->recvMobile);	//<uint64_t> 联系手机
		$bs->pushString($this->recvPhone);	//<std::string> 联系电话
		$bs->pushString($this->operateDesc);	//<std::string> 描述
		$bs->pushString($this->reserve);	//<std::string> 保留字段
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operateTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->regionCodeGB_u);	//<uint8_t> 
		$bs->pushUint8_t($this->regionCodeGBD_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvAddress_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvPostcode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvMobile_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvPhone_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operateDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushUint32_t($this->bizShipType);	//<uint32_t> 业务定义的配送方式，如易迅配送方式等
		}
		if($this->version >= 1){
			$bs->pushUint32_t($this->unpShipType);	//<uint32_t> 统一订单配送方式，统一订单定义
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->bizShipType_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->unpShipType_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['operateTime'] = $bs->popUint32_t();	//<uint32_t> 操作时间
		$this->_arr_value['regionCodeGB'] = $bs->popUint32_t();	//<uint32_t> 收货地址区域id(国标:网购拍拍)
		$this->_arr_value['regionCodeGBD'] = $bs->popUint32_t();	//<uint32_t> 收货地址区域id(国标细化:易迅)
		$this->_arr_value['recvAddress'] = $bs->popString();	//<std::string> 收货地址
		$this->_arr_value['recvPostcode'] = $bs->popString();	//<std::string> 邮编
		$this->_arr_value['recvName'] = $bs->popString();	//<std::string> 联系人
		$this->_arr_value['recvMobile'] = $bs->popUint64_t();	//<uint64_t> 联系手机
		$this->_arr_value['recvPhone'] = $bs->popString();	//<std::string> 联系电话
		$this->_arr_value['operateDesc'] = $bs->popString();	//<std::string> 描述
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 保留字段
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['regionCodeGB_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['regionCodeGBD_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvAddress_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvPostcode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvMobile_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvPhone_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operateDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserve_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['bizShipType'] = $bs->popUint32_t();	//<uint32_t> 业务定义的配送方式，如易迅配送方式等
		}
		if($this->version >= 1){
			$this->_arr_value['unpShipType'] = $bs->popUint32_t();	//<uint32_t> 统一订单配送方式，统一订单定义
		}
		if($this->version >= 1){
			$this->_arr_value['bizShipType_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['unpShipType_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.ModifyPayTypeReq.java
class EventParamsModifyPayTypeBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $operateTime;	//<uint32_t> 操作时间(版本>=0)
	private $payType;	//<uint32_t> 支付方式(版本>=0)
	private $payTypeName;	//<std::string> 支付方式名称(版本>=0)
	private $operateDesc;	//<std::string> 描述(版本>=0)
	private $reserve;	//<std::string> 保留字段(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $operateTime_u;	//<uint8_t> (版本>=0)
	private $payType_u;	//<uint8_t> (版本>=0)
	private $payTypeName_u;	//<uint8_t> (版本>=0)
	private $operateDesc_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->operateTime = 0;	//<uint32_t>
		$this->payType = 0;	//<uint32_t>
		$this->payTypeName = "";	//<std::string>
		$this->operateDesc = "";	//<std::string>
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->operateTime_u = 0;	//<uint8_t>
		$this->payType_u = 0;	//<uint8_t>
		$this->payTypeName_u = 0;	//<uint8_t>
		$this->operateDesc_u = 0;	//<uint8_t>
		$this->reserve_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\bo\EventParamsModifyPayTypeBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\EventParamsModifyPayTypeBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushUint32_t($this->operateTime);	//<uint32_t> 操作时间
		$bs->pushUint32_t($this->payType);	//<uint32_t> 支付方式
		$bs->pushString($this->payTypeName);	//<std::string> 支付方式名称
		$bs->pushString($this->operateDesc);	//<std::string> 描述
		$bs->pushString($this->reserve);	//<std::string> 保留字段
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operateTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payTypeName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operateDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['operateTime'] = $bs->popUint32_t();	//<uint32_t> 操作时间
		$this->_arr_value['payType'] = $bs->popUint32_t();	//<uint32_t> 支付方式
		$this->_arr_value['payTypeName'] = $bs->popString();	//<std::string> 支付方式名称
		$this->_arr_value['operateDesc'] = $bs->popString();	//<std::string> 描述
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 保留字段
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payTypeName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operateDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserve_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.ModifyInvoiceReq.java
class EventParamsModifyInvoiceBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $operateTime;	//<uint32_t> 操作时间，必填(版本>=0)
	private $invoiceType;	//<uint8_t> 发票类型，必填(版本>=0)
	private $invoiceHead;	//<std::string> 发票抬头(版本>=0)
	private $invoiceContent;	//<std::string> 发票内容(版本>=0)
	private $operateDesc;	//<std::string> 描述(版本>=0)
	private $reserve;	//<std::string> 保留字段(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $operateTime_u;	//<uint8_t> (版本>=0)
	private $invoiceType_u;	//<uint8_t> (版本>=0)
	private $invoiceHead_u;	//<uint8_t> (版本>=0)
	private $invoiceContent_u;	//<uint8_t> (版本>=0)
	private $operateDesc_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)
	private $isBlurry;	//<uint8_t> 是否模糊开票，必填(版本>=1)
	private $isVat;	//<uint8_t> 是否自动开票，必填(版本>=1)
	private $isBlurry_u;	//<uint8_t> (版本>=1)
	private $isVat_u;	//<uint8_t> (版本>=1)

	function __construct(){
		$this->version = 1;	//<uint16_t>
		$this->operateTime = 0;	//<uint32_t>
		$this->invoiceType = 0;	//<uint8_t>
		$this->invoiceHead = "";	//<std::string>
		$this->invoiceContent = "";	//<std::string>
		$this->operateDesc = "";	//<std::string>
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->operateTime_u = 0;	//<uint8_t>
		$this->invoiceType_u = 0;	//<uint8_t>
		$this->invoiceHead_u = 0;	//<uint8_t>
		$this->invoiceContent_u = 0;	//<uint8_t>
		$this->operateDesc_u = 0;	//<uint8_t>
		$this->reserve_u = 0;	//<uint8_t>
		$this->isBlurry = 0;	//<uint8_t>
		$this->isVat = 0;	//<uint8_t>
		$this->isBlurry_u = 0;	//<uint8_t>
		$this->isVat_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\bo\EventParamsModifyInvoiceBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\EventParamsModifyInvoiceBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushUint32_t($this->operateTime);	//<uint32_t> 操作时间，必填
		$bs->pushUint8_t($this->invoiceType);	//<uint8_t> 发票类型，必填
		$bs->pushString($this->invoiceHead);	//<std::string> 发票抬头
		$bs->pushString($this->invoiceContent);	//<std::string> 发票内容
		$bs->pushString($this->operateDesc);	//<std::string> 描述
		$bs->pushString($this->reserve);	//<std::string> 保留字段
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operateTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->invoiceType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->invoiceHead_u);	//<uint8_t> 
		$bs->pushUint8_t($this->invoiceContent_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operateDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushUint8_t($this->isBlurry);	//<uint8_t> 是否模糊开票，必填
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->isVat);	//<uint8_t> 是否自动开票，必填
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->isBlurry_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->isVat_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['operateTime'] = $bs->popUint32_t();	//<uint32_t> 操作时间，必填
		$this->_arr_value['invoiceType'] = $bs->popUint8_t();	//<uint8_t> 发票类型，必填
		$this->_arr_value['invoiceHead'] = $bs->popString();	//<std::string> 发票抬头
		$this->_arr_value['invoiceContent'] = $bs->popString();	//<std::string> 发票内容
		$this->_arr_value['operateDesc'] = $bs->popString();	//<std::string> 描述
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 保留字段
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['invoiceType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['invoiceHead_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['invoiceContent_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operateDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserve_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['isBlurry'] = $bs->popUint8_t();	//<uint8_t> 是否模糊开票，必填
		}
		if($this->version >= 1){
			$this->_arr_value['isVat'] = $bs->popUint8_t();	//<uint8_t> 是否自动开票，必填
		}
		if($this->version >= 1){
			$this->_arr_value['isBlurry_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['isVat_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.ModifyDealPriceReq.java
class EventParamsModifyDealPriceBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $operateTime;	//<uint32_t> 操作时间(版本>=0)
	private $isShipFeeModify;	//<uint8_t> 是否修改运费，修改填1，否则填0。配合NewShipFee使用(版本>=0)
	private $newShipFee;	//<uint32_t> 最新运费，IsShipFeeModify设置后必填(版本>=0)
	private $isDealFeeModify;	//<uint8_t> 是否修改订单金额，修改填1，否则填0。配合DealAdjustFee使用(版本>=0)
	private $dealAdjustFee;	//<int> 订单调整金额，正数表示加价，负数表示减价，IsDealFeeModify设置后必填(版本>=0)
	private $tradePriceList;	//<std::vector<ecc::deal::bo::CEventParamsModifyTradePriceBo> > 子单金额修改信息(版本>=0)
	private $newDealTotalFee;	//<uint32_t> 最新订单总金额，必填(版本>=0)
	private $operateDesc;	//<std::string> 描述(版本>=0)
	private $orderType;	//<uint32_t> 订单类型(版本>=0)
	private $reserve;	//<std::string> 保留字段(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $operateTime_u;	//<uint8_t> (版本>=0)
	private $isShipFeeModify_u;	//<uint8_t> (版本>=0)
	private $newShipFee_u;	//<uint8_t> (版本>=0)
	private $isDealFeeModify_u;	//<uint8_t> (版本>=0)
	private $dealAdjustFee_u;	//<uint8_t> (版本>=0)
	private $tradePriceList_u;	//<uint8_t> (版本>=0)
	private $newDealTotalFee_u;	//<uint8_t> (版本>=0)
	private $operateDesc_u;	//<uint8_t> (版本>=0)
	private $orderType_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)
	private $dealDiscountAmt;	//<uint32_t> 最新订单折扣金额(版本>=1)
	private $dealDiscountAmt_u;	//<uint8_t> (版本>=1)
	private $soldAmount;	//<uint32_t> 销售金额(版本>=2)
	private $pointObtain;	//<uint32_t> 获得积分值，订单赠送积分(版本>=2)
	private $insuranceFee;	//<uint32_t> 运费保险费，保费(版本>=2)
	private $pointPay;	//<uint32_t> 支付积分，金额单位是分(版本>=2)
	private $cashScore;	//<uint32_t> 现金积分，金额单位是分(版本>=2)
	private $promotionScore;	//<uint32_t> 促销积分，金额单位是分(版本>=2)
	private $settlementFee;	//<uint32_t> 结算金额(版本>=2)
	private $payProcedure;	//<uint32_t> 支付手续费（主要用于分期付款）(版本>=2)
	private $shipFeeDiscount;	//<uint32_t> 运费优惠(版本>=2)
	private $hasServiceProduct;	//<uint8_t> 是否需要装机服务（兼容性审核）(版本>=2)
	private $soldAmount_u;	//<uint8_t> (版本>=2)
	private $pointObtain_u;	//<uint8_t> (版本>=2)
	private $insuranceFee_u;	//<uint8_t> (版本>=2)
	private $pointPay_u;	//<uint8_t> (版本>=2)
	private $cashScore_u;	//<uint8_t> (版本>=2)
	private $promotionScore_u;	//<uint8_t> (版本>=2)
	private $settlementFee_u;	//<uint8_t> (版本>=2)
	private $payProcedure_u;	//<uint8_t> (版本>=2)
	private $shipFeeDiscount_u;	//<uint8_t> (版本>=2)
	private $hasServiceProduct_u;	//<uint8_t> (版本>=2)

	function __construct(){
		$this->version = 2;	//<uint16_t>
		$this->operateTime = 0;	//<uint32_t>
		$this->isShipFeeModify = 0;	//<uint8_t>
		$this->newShipFee = 0;	//<uint32_t>
		$this->isDealFeeModify = 0;	//<uint8_t>
		$this->dealAdjustFee = 0;	//<int>
		$this->tradePriceList = new \stl_vector2('\ecc\deal\bo\EventParamsModifyTradePriceBo');	//<std::vector<ecc::deal::bo::CEventParamsModifyTradePriceBo> >
		$this->newDealTotalFee = 0;	//<uint32_t>
		$this->operateDesc = "";	//<std::string>
		$this->orderType = 0;	//<uint32_t>
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->operateTime_u = 0;	//<uint8_t>
		$this->isShipFeeModify_u = 0;	//<uint8_t>
		$this->newShipFee_u = 0;	//<uint8_t>
		$this->isDealFeeModify_u = 0;	//<uint8_t>
		$this->dealAdjustFee_u = 0;	//<uint8_t>
		$this->tradePriceList_u = 0;	//<uint8_t>
		$this->newDealTotalFee_u = 0;	//<uint8_t>
		$this->operateDesc_u = 0;	//<uint8_t>
		$this->orderType_u = 0;	//<uint8_t>
		$this->reserve_u = 0;	//<uint8_t>
		$this->dealDiscountAmt = 0;	//<uint32_t>
		$this->dealDiscountAmt_u = 0;	//<uint8_t>
		$this->soldAmount = 0;	//<uint32_t>
		$this->pointObtain = 0;	//<uint32_t>
		$this->insuranceFee = 0;	//<uint32_t>
		$this->pointPay = 0;	//<uint32_t>
		$this->cashScore = 0;	//<uint32_t>
		$this->promotionScore = 0;	//<uint32_t>
		$this->settlementFee = 0;	//<uint32_t>
		$this->payProcedure = 0;	//<uint32_t>
		$this->shipFeeDiscount = 0;	//<uint32_t>
		$this->hasServiceProduct = 0;	//<uint8_t>
		$this->soldAmount_u = 0;	//<uint8_t>
		$this->pointObtain_u = 0;	//<uint8_t>
		$this->insuranceFee_u = 0;	//<uint8_t>
		$this->pointPay_u = 0;	//<uint8_t>
		$this->cashScore_u = 0;	//<uint8_t>
		$this->promotionScore_u = 0;	//<uint8_t>
		$this->settlementFee_u = 0;	//<uint8_t>
		$this->payProcedure_u = 0;	//<uint8_t>
		$this->shipFeeDiscount_u = 0;	//<uint8_t>
		$this->hasServiceProduct_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\bo\EventParamsModifyDealPriceBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\EventParamsModifyDealPriceBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushUint32_t($this->operateTime);	//<uint32_t> 操作时间
		$bs->pushUint8_t($this->isShipFeeModify);	//<uint8_t> 是否修改运费，修改填1，否则填0。配合NewShipFee使用
		$bs->pushUint32_t($this->newShipFee);	//<uint32_t> 最新运费，IsShipFeeModify设置后必填
		$bs->pushUint8_t($this->isDealFeeModify);	//<uint8_t> 是否修改订单金额，修改填1，否则填0。配合DealAdjustFee使用
		$bs->pushInt32_t($this->dealAdjustFee);	//<int> 订单调整金额，正数表示加价，负数表示减价，IsDealFeeModify设置后必填
		$bs->pushObject($this->tradePriceList,'stl_vector');	//<std::vector<ecc::deal::bo::CEventParamsModifyTradePriceBo> > 子单金额修改信息
		$bs->pushUint32_t($this->newDealTotalFee);	//<uint32_t> 最新订单总金额，必填
		$bs->pushString($this->operateDesc);	//<std::string> 描述
		$bs->pushUint32_t($this->orderType);	//<uint32_t> 订单类型
		$bs->pushString($this->reserve);	//<std::string> 保留字段
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operateTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->isShipFeeModify_u);	//<uint8_t> 
		$bs->pushUint8_t($this->newShipFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->isDealFeeModify_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealAdjustFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradePriceList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->newDealTotalFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operateDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->orderType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushUint32_t($this->dealDiscountAmt);	//<uint32_t> 最新订单折扣金额
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->dealDiscountAmt_u);	//<uint8_t> 
		}
		if($this->version >= 2){
			$bs->pushUint32_t($this->soldAmount);	//<uint32_t> 销售金额
		}
		if($this->version >= 2){
			$bs->pushUint32_t($this->pointObtain);	//<uint32_t> 获得积分值，订单赠送积分
		}
		if($this->version >= 2){
			$bs->pushUint32_t($this->insuranceFee);	//<uint32_t> 运费保险费，保费
		}
		if($this->version >= 2){
			$bs->pushUint32_t($this->pointPay);	//<uint32_t> 支付积分，金额单位是分
		}
		if($this->version >= 2){
			$bs->pushUint32_t($this->cashScore);	//<uint32_t> 现金积分，金额单位是分
		}
		if($this->version >= 2){
			$bs->pushUint32_t($this->promotionScore);	//<uint32_t> 促销积分，金额单位是分
		}
		if($this->version >= 2){
			$bs->pushUint32_t($this->settlementFee);	//<uint32_t> 结算金额
		}
		if($this->version >= 2){
			$bs->pushUint32_t($this->payProcedure);	//<uint32_t> 支付手续费（主要用于分期付款）
		}
		if($this->version >= 2){
			$bs->pushUint32_t($this->shipFeeDiscount);	//<uint32_t> 运费优惠
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->hasServiceProduct);	//<uint8_t> 是否需要装机服务（兼容性审核）
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->soldAmount_u);	//<uint8_t> 
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->pointObtain_u);	//<uint8_t> 
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->insuranceFee_u);	//<uint8_t> 
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->pointPay_u);	//<uint8_t> 
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->cashScore_u);	//<uint8_t> 
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->promotionScore_u);	//<uint8_t> 
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->settlementFee_u);	//<uint8_t> 
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->payProcedure_u);	//<uint8_t> 
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->shipFeeDiscount_u);	//<uint8_t> 
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->hasServiceProduct_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['operateTime'] = $bs->popUint32_t();	//<uint32_t> 操作时间
		$this->_arr_value['isShipFeeModify'] = $bs->popUint8_t();	//<uint8_t> 是否修改运费，修改填1，否则填0。配合NewShipFee使用
		$this->_arr_value['newShipFee'] = $bs->popUint32_t();	//<uint32_t> 最新运费，IsShipFeeModify设置后必填
		$this->_arr_value['isDealFeeModify'] = $bs->popUint8_t();	//<uint8_t> 是否修改订单金额，修改填1，否则填0。配合DealAdjustFee使用
		$this->_arr_value['dealAdjustFee'] = $bs->popInt32_t();	//<int> 订单调整金额，正数表示加价，负数表示减价，IsDealFeeModify设置后必填
		$this->_arr_value['tradePriceList'] = $bs->popObject('stl_vector<\ecc\deal\bo\EventParamsModifyTradePriceBo>');	//<std::vector<ecc::deal::bo::CEventParamsModifyTradePriceBo> > 子单金额修改信息
		$this->_arr_value['newDealTotalFee'] = $bs->popUint32_t();	//<uint32_t> 最新订单总金额，必填
		$this->_arr_value['operateDesc'] = $bs->popString();	//<std::string> 描述
		$this->_arr_value['orderType'] = $bs->popUint32_t();	//<uint32_t> 订单类型
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 保留字段
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['isShipFeeModify_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['newShipFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['isDealFeeModify_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealAdjustFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradePriceList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['newDealTotalFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operateDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['orderType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserve_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['dealDiscountAmt'] = $bs->popUint32_t();	//<uint32_t> 最新订单折扣金额
		}
		if($this->version >= 1){
			$this->_arr_value['dealDiscountAmt_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 2){
			$this->_arr_value['soldAmount'] = $bs->popUint32_t();	//<uint32_t> 销售金额
		}
		if($this->version >= 2){
			$this->_arr_value['pointObtain'] = $bs->popUint32_t();	//<uint32_t> 获得积分值，订单赠送积分
		}
		if($this->version >= 2){
			$this->_arr_value['insuranceFee'] = $bs->popUint32_t();	//<uint32_t> 运费保险费，保费
		}
		if($this->version >= 2){
			$this->_arr_value['pointPay'] = $bs->popUint32_t();	//<uint32_t> 支付积分，金额单位是分
		}
		if($this->version >= 2){
			$this->_arr_value['cashScore'] = $bs->popUint32_t();	//<uint32_t> 现金积分，金额单位是分
		}
		if($this->version >= 2){
			$this->_arr_value['promotionScore'] = $bs->popUint32_t();	//<uint32_t> 促销积分，金额单位是分
		}
		if($this->version >= 2){
			$this->_arr_value['settlementFee'] = $bs->popUint32_t();	//<uint32_t> 结算金额
		}
		if($this->version >= 2){
			$this->_arr_value['payProcedure'] = $bs->popUint32_t();	//<uint32_t> 支付手续费（主要用于分期付款）
		}
		if($this->version >= 2){
			$this->_arr_value['shipFeeDiscount'] = $bs->popUint32_t();	//<uint32_t> 运费优惠
		}
		if($this->version >= 2){
			$this->_arr_value['hasServiceProduct'] = $bs->popUint8_t();	//<uint8_t> 是否需要装机服务（兼容性审核）
		}
		if($this->version >= 2){
			$this->_arr_value['soldAmount_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 2){
			$this->_arr_value['pointObtain_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 2){
			$this->_arr_value['insuranceFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 2){
			$this->_arr_value['pointPay_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 2){
			$this->_arr_value['cashScore_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 2){
			$this->_arr_value['promotionScore_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 2){
			$this->_arr_value['settlementFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 2){
			$this->_arr_value['payProcedure_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 2){
			$this->_arr_value['shipFeeDiscount_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 2){
			$this->_arr_value['hasServiceProduct_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.EventParamsModifyDealPriceBo.java
class EventParamsModifyTradePriceBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $tradeId;	//<uint64_t> 子单id(版本>=0)
	private $skuId;	//<uint64_t> 子单skuid(版本>=0)
	private $isBuyNumModify;	//<uint8_t> 是否修改商品数量，修改填1，否则填0。配合NewBuyNum使用(版本>=0)
	private $newBuyNum;	//<uint32_t> 最新商品数量，IsBuyNumModify设置后必填(版本>=0)
	private $isTradeFeeModify;	//<uint8_t> 是否修改子单金额，修改填1，否则填0。配合TradeAdjustFee使用(版本>=0)
	private $tradeAdjustFee;	//<int> 订单调整金额，正数表示加价，负数表示减价，IsTradeFeeModify设置后必填(版本>=0)
	private $newTradeTotalFee;	//<uint32_t> 最新子单总金额，必填(版本>=0)
	private $reserve;	//<std::string> 保留字段(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $tradeId_u;	//<uint8_t> (版本>=0)
	private $skuId_u;	//<uint8_t> (版本>=0)
	private $isBuyNumModify_u;	//<uint8_t> (版本>=0)
	private $newBuyNum_u;	//<uint8_t> (版本>=0)
	private $isTradeFeeModify_u;	//<uint8_t> (版本>=0)
	private $tradeAdjustFee_u;	//<uint8_t> (版本>=0)
	private $newTradeTotalFee_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)
	private $price;	//<uint32_t> 商品价格，必填(版本>=1)
	private $costPrice;	//<uint32_t> 成本价，必填(版本>=1)
	private $tradeDiscountAmt;	//<uint32_t> 折扣金额(版本>=1)
	private $price_u;	//<uint8_t> (版本>=1)
	private $costPrice_u;	//<uint8_t> (版本>=1)
	private $tradeDiscountAmt_u;	//<uint8_t> (版本>=1)

	function __construct(){
		$this->version = 1;	//<uint16_t>
		$this->tradeId = 0;	//<uint64_t>
		$this->skuId = 0;	//<uint64_t>
		$this->isBuyNumModify = 0;	//<uint8_t>
		$this->newBuyNum = 0;	//<uint32_t>
		$this->isTradeFeeModify = 0;	//<uint8_t>
		$this->tradeAdjustFee = 0;	//<int>
		$this->newTradeTotalFee = 0;	//<uint32_t>
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->tradeId_u = 0;	//<uint8_t>
		$this->skuId_u = 0;	//<uint8_t>
		$this->isBuyNumModify_u = 0;	//<uint8_t>
		$this->newBuyNum_u = 0;	//<uint8_t>
		$this->isTradeFeeModify_u = 0;	//<uint8_t>
		$this->tradeAdjustFee_u = 0;	//<uint8_t>
		$this->newTradeTotalFee_u = 0;	//<uint8_t>
		$this->reserve_u = 0;	//<uint8_t>
		$this->price = 0;	//<uint32_t>
		$this->costPrice = 0;	//<uint32_t>
		$this->tradeDiscountAmt = 0;	//<uint32_t>
		$this->price_u = 0;	//<uint8_t>
		$this->costPrice_u = 0;	//<uint8_t>
		$this->tradeDiscountAmt_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\bo\EventParamsModifyTradePriceBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\EventParamsModifyTradePriceBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushUint64_t($this->tradeId);	//<uint64_t> 子单id
		$bs->pushUint64_t($this->skuId);	//<uint64_t> 子单skuid
		$bs->pushUint8_t($this->isBuyNumModify);	//<uint8_t> 是否修改商品数量，修改填1，否则填0。配合NewBuyNum使用
		$bs->pushUint32_t($this->newBuyNum);	//<uint32_t> 最新商品数量，IsBuyNumModify设置后必填
		$bs->pushUint8_t($this->isTradeFeeModify);	//<uint8_t> 是否修改子单金额，修改填1，否则填0。配合TradeAdjustFee使用
		$bs->pushInt32_t($this->tradeAdjustFee);	//<int> 订单调整金额，正数表示加价，负数表示减价，IsTradeFeeModify设置后必填
		$bs->pushUint32_t($this->newTradeTotalFee);	//<uint32_t> 最新子单总金额，必填
		$bs->pushString($this->reserve);	//<std::string> 保留字段
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->skuId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->isBuyNumModify_u);	//<uint8_t> 
		$bs->pushUint8_t($this->newBuyNum_u);	//<uint8_t> 
		$bs->pushUint8_t($this->isTradeFeeModify_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeAdjustFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->newTradeTotalFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushUint32_t($this->price);	//<uint32_t> 商品价格，必填
		}
		if($this->version >= 1){
			$bs->pushUint32_t($this->costPrice);	//<uint32_t> 成本价，必填
		}
		if($this->version >= 1){
			$bs->pushUint32_t($this->tradeDiscountAmt);	//<uint32_t> 折扣金额
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->price_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->costPrice_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->tradeDiscountAmt_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['tradeId'] = $bs->popUint64_t();	//<uint64_t> 子单id
		$this->_arr_value['skuId'] = $bs->popUint64_t();	//<uint64_t> 子单skuid
		$this->_arr_value['isBuyNumModify'] = $bs->popUint8_t();	//<uint8_t> 是否修改商品数量，修改填1，否则填0。配合NewBuyNum使用
		$this->_arr_value['newBuyNum'] = $bs->popUint32_t();	//<uint32_t> 最新商品数量，IsBuyNumModify设置后必填
		$this->_arr_value['isTradeFeeModify'] = $bs->popUint8_t();	//<uint8_t> 是否修改子单金额，修改填1，否则填0。配合TradeAdjustFee使用
		$this->_arr_value['tradeAdjustFee'] = $bs->popInt32_t();	//<int> 订单调整金额，正数表示加价，负数表示减价，IsTradeFeeModify设置后必填
		$this->_arr_value['newTradeTotalFee'] = $bs->popUint32_t();	//<uint32_t> 最新子单总金额，必填
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 保留字段
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['isBuyNumModify_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['newBuyNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['isTradeFeeModify_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeAdjustFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['newTradeTotalFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserve_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['price'] = $bs->popUint32_t();	//<uint32_t> 商品价格，必填
		}
		if($this->version >= 1){
			$this->_arr_value['costPrice'] = $bs->popUint32_t();	//<uint32_t> 成本价，必填
		}
		if($this->version >= 1){
			$this->_arr_value['tradeDiscountAmt'] = $bs->popUint32_t();	//<uint32_t> 折扣金额
		}
		if($this->version >= 1){
			$this->_arr_value['price_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['costPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['tradeDiscountAmt_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.ModifyCouponReq.java
class EventParamsModifyCouponBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $operateTime;	//<uint32_t> 操作时间(版本>=0)
	private $couponType;	//<uint32_t> 优惠类型(版本>=0)
	private $couponFee;	//<uint32_t> 优惠金额(版本>=0)
	private $ruleId;	//<uint32_t> 规则id(版本>=0)
	private $activeNo;	//<uint64_t> 活动编号，如无则不填(版本>=0)
	private $couponCode;	//<std::string> 优惠券编码(版本>=0)
	private $operateDesc;	//<std::string> 描述(版本>=0)
	private $reserve;	//<std::string> 保留字段(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $operateTime_u;	//<uint8_t> (版本>=0)
	private $couponType_u;	//<uint8_t> (版本>=0)
	private $couponFee_u;	//<uint8_t> (版本>=0)
	private $ruleId_u;	//<uint8_t> (版本>=0)
	private $activeNo_u;	//<uint8_t> (版本>=0)
	private $couponCode_u;	//<uint8_t> (版本>=0)
	private $operateDesc_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->operateTime = 0;	//<uint32_t>
		$this->couponType = 0;	//<uint32_t>
		$this->couponFee = 0;	//<uint32_t>
		$this->ruleId = 0;	//<uint32_t>
		$this->activeNo = 0;	//<uint64_t>
		$this->couponCode = "";	//<std::string>
		$this->operateDesc = "";	//<std::string>
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->operateTime_u = 0;	//<uint8_t>
		$this->couponType_u = 0;	//<uint8_t>
		$this->couponFee_u = 0;	//<uint8_t>
		$this->ruleId_u = 0;	//<uint8_t>
		$this->activeNo_u = 0;	//<uint8_t>
		$this->couponCode_u = 0;	//<uint8_t>
		$this->operateDesc_u = 0;	//<uint8_t>
		$this->reserve_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\bo\EventParamsModifyCouponBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\EventParamsModifyCouponBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushUint32_t($this->operateTime);	//<uint32_t> 操作时间
		$bs->pushUint32_t($this->couponType);	//<uint32_t> 优惠类型
		$bs->pushUint32_t($this->couponFee);	//<uint32_t> 优惠金额
		$bs->pushUint32_t($this->ruleId);	//<uint32_t> 规则id
		$bs->pushUint64_t($this->activeNo);	//<uint64_t> 活动编号，如无则不填
		$bs->pushString($this->couponCode);	//<std::string> 优惠券编码
		$bs->pushString($this->operateDesc);	//<std::string> 描述
		$bs->pushString($this->reserve);	//<std::string> 保留字段
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operateTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->couponType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->couponFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->ruleId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->activeNo_u);	//<uint8_t> 
		$bs->pushUint8_t($this->couponCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operateDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['operateTime'] = $bs->popUint32_t();	//<uint32_t> 操作时间
		$this->_arr_value['couponType'] = $bs->popUint32_t();	//<uint32_t> 优惠类型
		$this->_arr_value['couponFee'] = $bs->popUint32_t();	//<uint32_t> 优惠金额
		$this->_arr_value['ruleId'] = $bs->popUint32_t();	//<uint32_t> 规则id
		$this->_arr_value['activeNo'] = $bs->popUint64_t();	//<uint64_t> 活动编号，如无则不填
		$this->_arr_value['couponCode'] = $bs->popString();	//<std::string> 优惠券编码
		$this->_arr_value['operateDesc'] = $bs->popString();	//<std::string> 描述
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 保留字段
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['couponType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['couponFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['activeNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['couponCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operateDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserve_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.MarkShipReq.java
class EventParamsCorpShipBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $sendTime;	//<uint32_t> 发货（出库）时间(版本>=0)
	private $wuliuCompanyId;	//<std::string> 物流公司id(版本>=0)
	private $wuliuCompanyName;	//<std::string> 物流公司名称(版本>=0)
	private $wuliuCode;	//<std::string> 物流运单号(版本>=0)
	private $shipType;	//<uint32_t> 运送方式(版本>=0)
	private $sendDesc;	//<std::string> 发货（出库）描述(版本>=0)
	private $modifyCostPriceList;	//<std::vector<ecc::deal::bo::CEventParamsCorpModifyTradeBo> > 修改成本价，如果不涉及修改成本价，请将vector置空(版本>=0)
	private $reserve;	//<std::string> 保留字段(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $sendTime_u;	//<uint8_t> (版本>=0)
	private $wuliuCompanyId_u;	//<uint8_t> (版本>=0)
	private $wuliuCompanyName_u;	//<uint8_t> (版本>=0)
	private $wuliuCode_u;	//<uint8_t> (版本>=0)
	private $shipType_u;	//<uint8_t> (版本>=0)
	private $sendDesc_u;	//<uint8_t> (版本>=0)
	private $modifyCostPriceList_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->sendTime = 0;	//<uint32_t>
		$this->wuliuCompanyId = "";	//<std::string>
		$this->wuliuCompanyName = "";	//<std::string>
		$this->wuliuCode = "";	//<std::string>
		$this->shipType = 0;	//<uint32_t>
		$this->sendDesc = "";	//<std::string>
		$this->modifyCostPriceList = new \stl_vector2('\ecc\deal\bo\EventParamsCorpModifyTradeBo');	//<std::vector<ecc::deal::bo::CEventParamsCorpModifyTradeBo> >
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->sendTime_u = 0;	//<uint8_t>
		$this->wuliuCompanyId_u = 0;	//<uint8_t>
		$this->wuliuCompanyName_u = 0;	//<uint8_t>
		$this->wuliuCode_u = 0;	//<uint8_t>
		$this->shipType_u = 0;	//<uint8_t>
		$this->sendDesc_u = 0;	//<uint8_t>
		$this->modifyCostPriceList_u = 0;	//<uint8_t>
		$this->reserve_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\bo\EventParamsCorpShipBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\EventParamsCorpShipBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushUint32_t($this->sendTime);	//<uint32_t> 发货（出库）时间
		$bs->pushString($this->wuliuCompanyId);	//<std::string> 物流公司id
		$bs->pushString($this->wuliuCompanyName);	//<std::string> 物流公司名称
		$bs->pushString($this->wuliuCode);	//<std::string> 物流运单号
		$bs->pushUint32_t($this->shipType);	//<uint32_t> 运送方式
		$bs->pushString($this->sendDesc);	//<std::string> 发货（出库）描述
		$bs->pushObject($this->modifyCostPriceList,'stl_vector');	//<std::vector<ecc::deal::bo::CEventParamsCorpModifyTradeBo> > 修改成本价，如果不涉及修改成本价，请将vector置空
		$bs->pushString($this->reserve);	//<std::string> 保留字段
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sendTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->wuliuCompanyId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->wuliuCompanyName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->wuliuCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->shipType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sendDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->modifyCostPriceList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['sendTime'] = $bs->popUint32_t();	//<uint32_t> 发货（出库）时间
		$this->_arr_value['wuliuCompanyId'] = $bs->popString();	//<std::string> 物流公司id
		$this->_arr_value['wuliuCompanyName'] = $bs->popString();	//<std::string> 物流公司名称
		$this->_arr_value['wuliuCode'] = $bs->popString();	//<std::string> 物流运单号
		$this->_arr_value['shipType'] = $bs->popUint32_t();	//<uint32_t> 运送方式
		$this->_arr_value['sendDesc'] = $bs->popString();	//<std::string> 发货（出库）描述
		$this->_arr_value['modifyCostPriceList'] = $bs->popObject('stl_vector<\ecc\deal\bo\EventParamsCorpModifyTradeBo>');	//<std::vector<ecc::deal::bo::CEventParamsCorpModifyTradeBo> > 修改成本价，如果不涉及修改成本价，请将vector置空
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 保留字段
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sendTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['wuliuCompanyId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['wuliuCompanyName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['wuliuCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shipType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sendDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['modifyCostPriceList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserve_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.CreateRefundReq.java
class EventParamsCorpCreateRefundBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $dealId;	//<std::string> 订单id(版本>=0)
	private $tradeId;	//<uint64_t> 子单id, 如果没有子单（商品）维度信息，可不填(版本>=0)
	private $skuId;	//<uint64_t> 商品skuid, 如果没有子单（商品）维度信息，可不填(版本>=0)
	private $refundType;	//<uint32_t> 退款类型(版本>=0)
	private $refundReasonType;	//<uint32_t> 退款原因类型(版本>=0)
	private $refundReasonDesc;	//<std::string> 退款原因描述(版本>=0)
	private $buyerRefundFee;	//<uint32_t> 退款给买家金额(版本>=0)
	private $reserve;	//<std::string> 保留字段(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $dealId_u;	//<uint8_t> (版本>=0)
	private $tradeId_u;	//<uint8_t> (版本>=0)
	private $skuId_u;	//<uint8_t> (版本>=0)
	private $refundType_u;	//<uint8_t> (版本>=0)
	private $refundReasonType_u;	//<uint8_t> (版本>=0)
	private $refundReasonDesc_u;	//<uint8_t> (版本>=0)
	private $buyerRefundFee_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)
	private $businessRefundId;	//<std::string> 业务退款单id(版本>=1)
	private $businessRefundId_u;	//<uint8_t> (版本>=1)
	private $num;	//<uint32_t> 退款/退货数量(版本>=2)
	private $num_u;	//<uint8_t> (版本>=2)

	function __construct(){
		$this->version = 2;	//<uint16_t>
		$this->dealId = "";	//<std::string>
		$this->tradeId = 0;	//<uint64_t>
		$this->skuId = 0;	//<uint64_t>
		$this->refundType = 0;	//<uint32_t>
		$this->refundReasonType = 0;	//<uint32_t>
		$this->refundReasonDesc = "";	//<std::string>
		$this->buyerRefundFee = 0;	//<uint32_t>
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->dealId_u = 0;	//<uint8_t>
		$this->tradeId_u = 0;	//<uint8_t>
		$this->skuId_u = 0;	//<uint8_t>
		$this->refundType_u = 0;	//<uint8_t>
		$this->refundReasonType_u = 0;	//<uint8_t>
		$this->refundReasonDesc_u = 0;	//<uint8_t>
		$this->buyerRefundFee_u = 0;	//<uint8_t>
		$this->reserve_u = 0;	//<uint8_t>
		$this->businessRefundId = "";	//<std::string>
		$this->businessRefundId_u = 0;	//<uint8_t>
		$this->num = 0;	//<uint32_t>
		$this->num_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\bo\EventParamsCorpCreateRefundBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\EventParamsCorpCreateRefundBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushString($this->dealId);	//<std::string> 订单id
		$bs->pushUint64_t($this->tradeId);	//<uint64_t> 子单id, 如果没有子单（商品）维度信息，可不填
		$bs->pushUint64_t($this->skuId);	//<uint64_t> 商品skuid, 如果没有子单（商品）维度信息，可不填
		$bs->pushUint32_t($this->refundType);	//<uint32_t> 退款类型
		$bs->pushUint32_t($this->refundReasonType);	//<uint32_t> 退款原因类型
		$bs->pushString($this->refundReasonDesc);	//<std::string> 退款原因描述
		$bs->pushUint32_t($this->buyerRefundFee);	//<uint32_t> 退款给买家金额
		$bs->pushString($this->reserve);	//<std::string> 保留字段
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->skuId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundReasonType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundReasonDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerRefundFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushString($this->businessRefundId);	//<std::string> 业务退款单id
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->businessRefundId_u);	//<uint8_t> 
		}
		if($this->version >= 2){
			$bs->pushUint32_t($this->num);	//<uint32_t> 退款/退货数量
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->num_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['dealId'] = $bs->popString();	//<std::string> 订单id
		$this->_arr_value['tradeId'] = $bs->popUint64_t();	//<uint64_t> 子单id, 如果没有子单（商品）维度信息，可不填
		$this->_arr_value['skuId'] = $bs->popUint64_t();	//<uint64_t> 商品skuid, 如果没有子单（商品）维度信息，可不填
		$this->_arr_value['refundType'] = $bs->popUint32_t();	//<uint32_t> 退款类型
		$this->_arr_value['refundReasonType'] = $bs->popUint32_t();	//<uint32_t> 退款原因类型
		$this->_arr_value['refundReasonDesc'] = $bs->popString();	//<std::string> 退款原因描述
		$this->_arr_value['buyerRefundFee'] = $bs->popUint32_t();	//<uint32_t> 退款给买家金额
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 保留字段
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundReasonType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundReasonDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerRefundFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserve_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['businessRefundId'] = $bs->popString();	//<std::string> 业务退款单id
		}
		if($this->version >= 1){
			$this->_arr_value['businessRefundId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 2){
			$this->_arr_value['num'] = $bs->popUint32_t();	//<uint32_t> 退款/退货数量
		}
		if($this->version >= 2){
			$this->_arr_value['num_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.ConfirmRecvReq.java
class EventParamsCorpSignBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $signTime;	//<uint32_t> 签收(拒签)时间(版本>=0)
	private $signDesc;	//<std::string> 签收(拒签)描述(版本>=0)
	private $refuseTradeList;	//<std::vector<uint64_t> > 拒签的子单列表，个别子单拒签时填写，整单签收或整单拒签时可不填(版本>=0)
	private $reserve;	//<std::string> 保留字段(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $signTime_u;	//<uint8_t> (版本>=0)
	private $signDesc_u;	//<uint8_t> (版本>=0)
	private $refuseTradeList_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)
	private $returnList;	//<ecc::deal::bo::CEventParamsCorpModifyTradeBo> 拒签的子单列表，个别子单拒签时填写，整单签收或整单拒签时可不填(版本>=1)
	private $returnList_u;	//<uint32_t> (版本>=1)

	function __construct(){
		$this->version = 1;	//<uint16_t>
		$this->signTime = 0;	//<uint32_t>
		$this->signDesc = "";	//<std::string>
		$this->refuseTradeList = new \stl_vector2('uint64_t');	//<std::vector<uint64_t> >
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->signTime_u = 0;	//<uint8_t>
		$this->signDesc_u = 0;	//<uint8_t>
		$this->refuseTradeList_u = 0;	//<uint8_t>
		$this->reserve_u = 0;	//<uint8_t>
		$this->returnList = new \ecc\deal\bo\EventParamsCorpModifyTradeBo();	//<ecc::deal::bo::CEventParamsCorpModifyTradeBo>
		$this->returnList_u = 0;	//<uint32_t>
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
			exit("\ecc\deal\bo\EventParamsCorpSignBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\EventParamsCorpSignBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushUint32_t($this->signTime);	//<uint32_t> 签收(拒签)时间
		$bs->pushString($this->signDesc);	//<std::string> 签收(拒签)描述
		$bs->pushObject($this->refuseTradeList,'stl_vector');	//<std::vector<uint64_t> > 拒签的子单列表，个别子单拒签时填写，整单签收或整单拒签时可不填
		$bs->pushString($this->reserve);	//<std::string> 保留字段
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->signTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->signDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refuseTradeList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushObject($this->returnList,'\ecc\deal\bo\EventParamsCorpModifyTradeBo');	//<ecc::deal::bo::CEventParamsCorpModifyTradeBo> 拒签的子单列表，个别子单拒签时填写，整单签收或整单拒签时可不填
		}
		if($this->version >= 1){
			$bs->pushUint32_t($this->returnList_u);	//<uint32_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['signTime'] = $bs->popUint32_t();	//<uint32_t> 签收(拒签)时间
		$this->_arr_value['signDesc'] = $bs->popString();	//<std::string> 签收(拒签)描述
		$this->_arr_value['refuseTradeList'] = $bs->popObject('stl_vector<uint64_t>');	//<std::vector<uint64_t> > 拒签的子单列表，个别子单拒签时填写，整单签收或整单拒签时可不填
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 保留字段
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['signTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['signDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refuseTradeList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserve_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['returnList'] = $bs->popObject('\ecc\deal\bo\EventParamsCorpModifyTradeBo');	//<ecc::deal::bo::CEventParamsCorpModifyTradeBo> 拒签的子单列表，个别子单拒签时填写，整单签收或整单拒签时可不填
		}
		if($this->version >= 1){
			$this->_arr_value['returnList_u'] = $bs->popUint32_t();	//<uint32_t> 
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

namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.EventParamsCorpSignBo.java
class EventParamsCorpModifyTradeBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $tradeId;	//<uint64_t> 子单id(版本>=0)
	private $skuId;	//<uint64_t> 子单skuid(版本>=0)
	private $costPrice;	//<uint32_t> 商品子单成本价，必须是CostPrice_u等于1时才有效(版本>=0)
	private $reserve;	//<std::string> 保留字段(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $tradeId_u;	//<uint8_t> (版本>=0)
	private $skuId_u;	//<uint8_t> (版本>=0)
	private $costPrice_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)
	private $returnNum;	//<uint32_t> 退货数量，必须是ReturnNum_u等于1时才有效(版本>=1)
	private $returnNum_u;	//<uint8_t> (版本>=1)

	function __construct(){
		$this->version = 1;	//<uint16_t>
		$this->tradeId = 0;	//<uint64_t>
		$this->skuId = 0;	//<uint64_t>
		$this->costPrice = 0;	//<uint32_t>
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->tradeId_u = 0;	//<uint8_t>
		$this->skuId_u = 0;	//<uint8_t>
		$this->costPrice_u = 0;	//<uint8_t>
		$this->reserve_u = 0;	//<uint8_t>
		$this->returnNum = 0;	//<uint32_t>
		$this->returnNum_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\bo\EventParamsCorpModifyTradeBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\EventParamsCorpModifyTradeBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushUint64_t($this->tradeId);	//<uint64_t> 子单id
		$bs->pushUint64_t($this->skuId);	//<uint64_t> 子单skuid
		$bs->pushUint32_t($this->costPrice);	//<uint32_t> 商品子单成本价，必须是CostPrice_u等于1时才有效
		$bs->pushString($this->reserve);	//<std::string> 保留字段
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->skuId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->costPrice_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushUint32_t($this->returnNum);	//<uint32_t> 退货数量，必须是ReturnNum_u等于1时才有效
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->returnNum_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['tradeId'] = $bs->popUint64_t();	//<uint64_t> 子单id
		$this->_arr_value['skuId'] = $bs->popUint64_t();	//<uint64_t> 子单skuid
		$this->_arr_value['costPrice'] = $bs->popUint32_t();	//<uint32_t> 商品子单成本价，必须是CostPrice_u等于1时才有效
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 保留字段
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['costPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserve_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['returnNum'] = $bs->popUint32_t();	//<uint32_t> 退货数量，必须是ReturnNum_u等于1时才有效
		}
		if($this->version >= 1){
			$this->_arr_value['returnNum_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.CloseDealReq.java
class EventParamsCloseDealBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $operateScene;	//<uint32_t> 关闭订单场景: 1-客服关闭;2-系统关闭;3-客服代用户关闭;4-经理(主管)关闭(版本>=0)
	private $closeTime;	//<uint32_t> 关闭时间(版本>=0)
	private $closeReasonType;	//<uint32_t> 关闭原因(版本>=0)
	private $closeReasonDesc;	//<std::string> 描述信息(版本>=0)
	private $tradeList;	//<std::vector<uint64_t> > 子单列表，个别子单关闭时填写，不填则整单关闭(版本>=0)
	private $reserve;	//<std::string> 保留字段(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $operateScene_u;	//<uint8_t> (版本>=0)
	private $closeTime_u;	//<uint8_t> (版本>=0)
	private $closeReasonType_u;	//<uint8_t> (版本>=0)
	private $closeReasonDesc_u;	//<uint8_t> (版本>=0)
	private $tradeList_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->operateScene = 0;	//<uint32_t>
		$this->closeTime = 0;	//<uint32_t>
		$this->closeReasonType = 0;	//<uint32_t>
		$this->closeReasonDesc = "";	//<std::string>
		$this->tradeList = new \stl_vector2('uint64_t');	//<std::vector<uint64_t> >
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->operateScene_u = 0;	//<uint8_t>
		$this->closeTime_u = 0;	//<uint8_t>
		$this->closeReasonType_u = 0;	//<uint8_t>
		$this->closeReasonDesc_u = 0;	//<uint8_t>
		$this->tradeList_u = 0;	//<uint8_t>
		$this->reserve_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\bo\EventParamsCloseDealBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\EventParamsCloseDealBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushUint32_t($this->operateScene);	//<uint32_t> 关闭订单场景: 1-客服关闭;2-系统关闭;3-客服代用户关闭;4-经理(主管)关闭
		$bs->pushUint32_t($this->closeTime);	//<uint32_t> 关闭时间
		$bs->pushUint32_t($this->closeReasonType);	//<uint32_t> 关闭原因
		$bs->pushString($this->closeReasonDesc);	//<std::string> 描述信息
		$bs->pushObject($this->tradeList,'stl_vector');	//<std::vector<uint64_t> > 子单列表，个别子单关闭时填写，不填则整单关闭
		$bs->pushString($this->reserve);	//<std::string> 保留字段
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operateScene_u);	//<uint8_t> 
		$bs->pushUint8_t($this->closeTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->closeReasonType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->closeReasonDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['operateScene'] = $bs->popUint32_t();	//<uint32_t> 关闭订单场景: 1-客服关闭;2-系统关闭;3-客服代用户关闭;4-经理(主管)关闭
		$this->_arr_value['closeTime'] = $bs->popUint32_t();	//<uint32_t> 关闭时间
		$this->_arr_value['closeReasonType'] = $bs->popUint32_t();	//<uint32_t> 关闭原因
		$this->_arr_value['closeReasonDesc'] = $bs->popString();	//<std::string> 描述信息
		$this->_arr_value['tradeList'] = $bs->popObject('stl_vector<uint64_t>');	//<std::vector<uint64_t> > 子单列表，个别子单关闭时填写，不填则整单关闭
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 保留字段
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operateScene_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['closeTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['closeReasonType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['closeReasonDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserve_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.CSCreateBuyDealResp.java
class BdealPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $bdealId;	//<uint64_t> 交易单号，买卖家一次交易行为描述(版本>=0)
	private $bdealCode;	//<std::string> 交易单编号，即字符串格式的交易单号(版本>=0)
	private $businessDealId;	//<std::string> 业务订单编号，第三方托管订单(版本>=0)
	private $buyerId;	//<uint64_t> 买家ID(版本>=0)
	private $buyerAccount;	//<std::string> 买家帐号(版本>=0)
	private $buyerNickName;	//<std::string> 买家姓名(版本>=0)
	private $buyerNick;	//<std::string> 买家昵称(版本>=0)
	private $sellerId;	//<uint64_t> 商家ID(版本>=0)
	private $sellerTitle;	//<std::string> 商家真实名称(版本>=0)
	private $sellerNick;	//<std::string> 卖家昵称(版本>=0)
	private $businessId;	//<uint32_t> 业务ID: 1:拍拍业务员；2:易迅业务(版本>=0)
	private $bdealType;	//<uint8_t> 交易单类型：1：购物车；2：一口价；3：抢购；4：拍卖；5：预售(版本>=0)
	private $bdealSource;	//<uint32_t> 下单渠道：1：业务主站；2：移动app；3：移动wap(版本>=0)
	private $bdealPayType;	//<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款(版本>=0)
	private $bdealState;	//<uint32_t> 交易单状态(版本>=0)
	private $preBdealState;	//<uint32_t> 交易单前一个状态(版本>=0)
	private $itemTitleList;	//<std::string> 商品标题列表(版本>=0)
	private $itemSkuidList;	//<std::string> 商品skuID列表(版本>=0)
	private $bdealTotalFee;	//<uint32_t> 交易单总金额，只记录下单时的金额，后续改价不会变，不能作为计算价格依据(版本>=0)
	private $bdealPayment;	//<uint32_t> 实付总金额，交易单的真实支付金额，计算价格的依据(版本>=0)
	private $bdealRefer;	//<std::string> refer(版本>=0)
	private $bdealIp;	//<std::string> 下单IP(版本>=0)
	private $promotionDesc;	//<std::string> 促销信息描述(版本>=0)
	private $bdealGenTime;	//<uint32_t> 交易单生成时间(版本>=0)
	private $bdealPayTime;	//<uint32_t> 交易单付款时间(版本>=0)
	private $bdealEndTime;	//<uint32_t> 交易单结束时间(版本>=0)
	private $recvName;	//<std::string> 收货人(版本>=0)
	private $recvRegionCode;	//<uint32_t> 地区编码(版本>=0)
	private $recvRegionCodeExt;	//<std::string> 扩展地区编码(版本>=0)
	private $recvAddress;	//<std::string> 地址(版本>=0)
	private $recvPostCode;	//<std::string> 邮编(版本>=0)
	private $recvPhone;	//<std::string> 电话(版本>=0)
	private $recvMobile;	//<uint64_t> 手机(版本>=0)
	private $bdealFlag;	//<uint32_t> 交易单标记(版本>=0)
	private $delFlag;	//<uint32_t> 订单有效标记(版本>=0)
	private $visibleState;	//<uint32_t> 可见标识(版本>=0)
	private $bdealDigest;	//<std::string> 交易单摘要(版本>=0)
	private $lastUpdateTime;	//<uint32_t> 最后更新时间(版本>=0)
	private $dealInfoList;	//<ecc::deal::po::CDealPoList> 订单列表(版本>=0)
	private $payInfoList;	//<ecc::deal::po::CPayInfoPoList> 支付信息表(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $bdealId_u;	//<uint8_t> (版本>=0)
	private $bdealCode_u;	//<uint8_t> (版本>=0)
	private $businessDealId_u;	//<uint8_t> (版本>=0)
	private $buyerId_u;	//<uint8_t> (版本>=0)
	private $buyerAccount_u;	//<uint8_t> (版本>=0)
	private $buyerNickName_u;	//<uint8_t> (版本>=0)
	private $buyerNick_u;	//<uint8_t> (版本>=0)
	private $sellerId_u;	//<uint8_t> (版本>=0)
	private $sellerTitle_u;	//<uint8_t> (版本>=0)
	private $sellerNick_u;	//<uint8_t> (版本>=0)
	private $businessId_u;	//<uint8_t> (版本>=0)
	private $bdealType_u;	//<uint8_t> (版本>=0)
	private $bdealSource_u;	//<uint8_t> (版本>=0)
	private $bdealPayType_u;	//<uint8_t> (版本>=0)
	private $bdealState_u;	//<uint8_t> (版本>=0)
	private $preBdealState_u;	//<uint8_t> (版本>=0)
	private $itemTitleList_u;	//<uint8_t> (版本>=0)
	private $itemSkuidList_u;	//<uint8_t> (版本>=0)
	private $bdealTotalFee_u;	//<uint8_t> (版本>=0)
	private $bdealPayment_u;	//<uint8_t> (版本>=0)
	private $bdealRefer_u;	//<uint8_t> (版本>=0)
	private $bdealIp_u;	//<uint8_t> (版本>=0)
	private $promotionDesc_u;	//<uint8_t> (版本>=0)
	private $bdealGenTime_u;	//<uint8_t> (版本>=0)
	private $bdealPayTime_u;	//<uint8_t> (版本>=0)
	private $bdealEndTime_u;	//<uint8_t> (版本>=0)
	private $recvName_u;	//<uint8_t> (版本>=0)
	private $recvRegionCode_u;	//<uint8_t> (版本>=0)
	private $recvRegionCodeExt_u;	//<uint8_t> (版本>=0)
	private $recvAddress_u;	//<uint8_t> (版本>=0)
	private $recvPostCode_u;	//<uint8_t> (版本>=0)
	private $recvPhone_u;	//<uint8_t> (版本>=0)
	private $recvMobile_u;	//<uint8_t> (版本>=0)
	private $bdealFlag_u;	//<uint8_t> (版本>=0)
	private $delFlag_u;	//<uint8_t> (版本>=0)
	private $visibleState_u;	//<uint8_t> (版本>=0)
	private $bdealDigest_u;	//<uint8_t> (版本>=0)
	private $lastUpdateTime_u;	//<uint8_t> (版本>=0)
	private $dealInfoList_u;	//<uint8_t> (版本>=0)
	private $payInfoList_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->bdealId = 0;	//<uint64_t>
		$this->bdealCode = "";	//<std::string>
		$this->businessDealId = "";	//<std::string>
		$this->buyerId = 0;	//<uint64_t>
		$this->buyerAccount = "";	//<std::string>
		$this->buyerNickName = "";	//<std::string>
		$this->buyerNick = "";	//<std::string>
		$this->sellerId = 0;	//<uint64_t>
		$this->sellerTitle = "";	//<std::string>
		$this->sellerNick = "";	//<std::string>
		$this->businessId = 0;	//<uint32_t>
		$this->bdealType = 0;	//<uint8_t>
		$this->bdealSource = 0;	//<uint32_t>
		$this->bdealPayType = 0;	//<uint8_t>
		$this->bdealState = 0;	//<uint32_t>
		$this->preBdealState = 0;	//<uint32_t>
		$this->itemTitleList = "";	//<std::string>
		$this->itemSkuidList = "";	//<std::string>
		$this->bdealTotalFee = 0;	//<uint32_t>
		$this->bdealPayment = 0;	//<uint32_t>
		$this->bdealRefer = "";	//<std::string>
		$this->bdealIp = "";	//<std::string>
		$this->promotionDesc = "";	//<std::string>
		$this->bdealGenTime = 0;	//<uint32_t>
		$this->bdealPayTime = 0;	//<uint32_t>
		$this->bdealEndTime = 0;	//<uint32_t>
		$this->recvName = "";	//<std::string>
		$this->recvRegionCode = 0;	//<uint32_t>
		$this->recvRegionCodeExt = "";	//<std::string>
		$this->recvAddress = "";	//<std::string>
		$this->recvPostCode = "";	//<std::string>
		$this->recvPhone = "";	//<std::string>
		$this->recvMobile = 0;	//<uint64_t>
		$this->bdealFlag = 0;	//<uint32_t>
		$this->delFlag = 0;	//<uint32_t>
		$this->visibleState = 0;	//<uint32_t>
		$this->bdealDigest = "";	//<std::string>
		$this->lastUpdateTime = 0;	//<uint32_t>
		$this->dealInfoList = new \ecc\deal\po\DealPoList();	//<ecc::deal::po::CDealPoList>
		$this->payInfoList = new \ecc\deal\po\PayInfoPoList();	//<ecc::deal::po::CPayInfoPoList>
		$this->version_u = 0;	//<uint8_t>
		$this->bdealId_u = 0;	//<uint8_t>
		$this->bdealCode_u = 0;	//<uint8_t>
		$this->businessDealId_u = 0;	//<uint8_t>
		$this->buyerId_u = 0;	//<uint8_t>
		$this->buyerAccount_u = 0;	//<uint8_t>
		$this->buyerNickName_u = 0;	//<uint8_t>
		$this->buyerNick_u = 0;	//<uint8_t>
		$this->sellerId_u = 0;	//<uint8_t>
		$this->sellerTitle_u = 0;	//<uint8_t>
		$this->sellerNick_u = 0;	//<uint8_t>
		$this->businessId_u = 0;	//<uint8_t>
		$this->bdealType_u = 0;	//<uint8_t>
		$this->bdealSource_u = 0;	//<uint8_t>
		$this->bdealPayType_u = 0;	//<uint8_t>
		$this->bdealState_u = 0;	//<uint8_t>
		$this->preBdealState_u = 0;	//<uint8_t>
		$this->itemTitleList_u = 0;	//<uint8_t>
		$this->itemSkuidList_u = 0;	//<uint8_t>
		$this->bdealTotalFee_u = 0;	//<uint8_t>
		$this->bdealPayment_u = 0;	//<uint8_t>
		$this->bdealRefer_u = 0;	//<uint8_t>
		$this->bdealIp_u = 0;	//<uint8_t>
		$this->promotionDesc_u = 0;	//<uint8_t>
		$this->bdealGenTime_u = 0;	//<uint8_t>
		$this->bdealPayTime_u = 0;	//<uint8_t>
		$this->bdealEndTime_u = 0;	//<uint8_t>
		$this->recvName_u = 0;	//<uint8_t>
		$this->recvRegionCode_u = 0;	//<uint8_t>
		$this->recvRegionCodeExt_u = 0;	//<uint8_t>
		$this->recvAddress_u = 0;	//<uint8_t>
		$this->recvPostCode_u = 0;	//<uint8_t>
		$this->recvPhone_u = 0;	//<uint8_t>
		$this->recvMobile_u = 0;	//<uint8_t>
		$this->bdealFlag_u = 0;	//<uint8_t>
		$this->delFlag_u = 0;	//<uint8_t>
		$this->visibleState_u = 0;	//<uint8_t>
		$this->bdealDigest_u = 0;	//<uint8_t>
		$this->lastUpdateTime_u = 0;	//<uint8_t>
		$this->dealInfoList_u = 0;	//<uint8_t>
		$this->payInfoList_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\po\BdealPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\BdealPo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushUint64_t($this->bdealId);	//<uint64_t> 交易单号，买卖家一次交易行为描述
		$bs->pushString($this->bdealCode);	//<std::string> 交易单编号，即字符串格式的交易单号
		$bs->pushString($this->businessDealId);	//<std::string> 业务订单编号，第三方托管订单
		$bs->pushUint64_t($this->buyerId);	//<uint64_t> 买家ID
		$bs->pushString($this->buyerAccount);	//<std::string> 买家帐号
		$bs->pushString($this->buyerNickName);	//<std::string> 买家姓名
		$bs->pushString($this->buyerNick);	//<std::string> 买家昵称
		$bs->pushUint64_t($this->sellerId);	//<uint64_t> 商家ID
		$bs->pushString($this->sellerTitle);	//<std::string> 商家真实名称
		$bs->pushString($this->sellerNick);	//<std::string> 卖家昵称
		$bs->pushUint32_t($this->businessId);	//<uint32_t> 业务ID: 1:拍拍业务员；2:易迅业务
		$bs->pushUint8_t($this->bdealType);	//<uint8_t> 交易单类型：1：购物车；2：一口价；3：抢购；4：拍卖；5：预售
		$bs->pushUint32_t($this->bdealSource);	//<uint32_t> 下单渠道：1：业务主站；2：移动app；3：移动wap
		$bs->pushUint8_t($this->bdealPayType);	//<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款
		$bs->pushUint32_t($this->bdealState);	//<uint32_t> 交易单状态
		$bs->pushUint32_t($this->preBdealState);	//<uint32_t> 交易单前一个状态
		$bs->pushString($this->itemTitleList);	//<std::string> 商品标题列表
		$bs->pushString($this->itemSkuidList);	//<std::string> 商品skuID列表
		$bs->pushUint32_t($this->bdealTotalFee);	//<uint32_t> 交易单总金额，只记录下单时的金额，后续改价不会变，不能作为计算价格依据
		$bs->pushUint32_t($this->bdealPayment);	//<uint32_t> 实付总金额，交易单的真实支付金额，计算价格的依据
		$bs->pushString($this->bdealRefer);	//<std::string> refer
		$bs->pushString($this->bdealIp);	//<std::string> 下单IP
		$bs->pushString($this->promotionDesc);	//<std::string> 促销信息描述
		$bs->pushUint32_t($this->bdealGenTime);	//<uint32_t> 交易单生成时间
		$bs->pushUint32_t($this->bdealPayTime);	//<uint32_t> 交易单付款时间
		$bs->pushUint32_t($this->bdealEndTime);	//<uint32_t> 交易单结束时间
		$bs->pushString($this->recvName);	//<std::string> 收货人
		$bs->pushUint32_t($this->recvRegionCode);	//<uint32_t> 地区编码
		$bs->pushString($this->recvRegionCodeExt);	//<std::string> 扩展地区编码
		$bs->pushString($this->recvAddress);	//<std::string> 地址
		$bs->pushString($this->recvPostCode);	//<std::string> 邮编
		$bs->pushString($this->recvPhone);	//<std::string> 电话
		$bs->pushUint64_t($this->recvMobile);	//<uint64_t> 手机
		$bs->pushUint32_t($this->bdealFlag);	//<uint32_t> 交易单标记
		$bs->pushUint32_t($this->delFlag);	//<uint32_t> 订单有效标记
		$bs->pushUint32_t($this->visibleState);	//<uint32_t> 可见标识
		$bs->pushString($this->bdealDigest);	//<std::string> 交易单摘要
		$bs->pushUint32_t($this->lastUpdateTime);	//<uint32_t> 最后更新时间
		$bs->pushObject($this->dealInfoList,'\ecc\deal\po\DealPoList');	//<ecc::deal::po::CDealPoList> 订单列表
		$bs->pushObject($this->payInfoList,'\ecc\deal\po\PayInfoPoList');	//<ecc::deal::po::CPayInfoPoList> 支付信息表
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->businessDealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerAccount_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerNickName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerNick_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerTitle_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerNick_u);	//<uint8_t> 
		$bs->pushUint8_t($this->businessId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealSource_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealPayType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->preBdealState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemTitleList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemSkuidList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealTotalFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealPayment_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealRefer_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealIp_u);	//<uint8_t> 
		$bs->pushUint8_t($this->promotionDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealGenTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealPayTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealEndTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvRegionCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvRegionCodeExt_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvAddress_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvPostCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvPhone_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvMobile_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealFlag_u);	//<uint8_t> 
		$bs->pushUint8_t($this->delFlag_u);	//<uint8_t> 
		$bs->pushUint8_t($this->visibleState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealDigest_u);	//<uint8_t> 
		$bs->pushUint8_t($this->lastUpdateTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealInfoList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payInfoList_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['bdealId'] = $bs->popUint64_t();	//<uint64_t> 交易单号，买卖家一次交易行为描述
		$this->_arr_value['bdealCode'] = $bs->popString();	//<std::string> 交易单编号，即字符串格式的交易单号
		$this->_arr_value['businessDealId'] = $bs->popString();	//<std::string> 业务订单编号，第三方托管订单
		$this->_arr_value['buyerId'] = $bs->popUint64_t();	//<uint64_t> 买家ID
		$this->_arr_value['buyerAccount'] = $bs->popString();	//<std::string> 买家帐号
		$this->_arr_value['buyerNickName'] = $bs->popString();	//<std::string> 买家姓名
		$this->_arr_value['buyerNick'] = $bs->popString();	//<std::string> 买家昵称
		$this->_arr_value['sellerId'] = $bs->popUint64_t();	//<uint64_t> 商家ID
		$this->_arr_value['sellerTitle'] = $bs->popString();	//<std::string> 商家真实名称
		$this->_arr_value['sellerNick'] = $bs->popString();	//<std::string> 卖家昵称
		$this->_arr_value['businessId'] = $bs->popUint32_t();	//<uint32_t> 业务ID: 1:拍拍业务员；2:易迅业务
		$this->_arr_value['bdealType'] = $bs->popUint8_t();	//<uint8_t> 交易单类型：1：购物车；2：一口价；3：抢购；4：拍卖；5：预售
		$this->_arr_value['bdealSource'] = $bs->popUint32_t();	//<uint32_t> 下单渠道：1：业务主站；2：移动app；3：移动wap
		$this->_arr_value['bdealPayType'] = $bs->popUint8_t();	//<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款
		$this->_arr_value['bdealState'] = $bs->popUint32_t();	//<uint32_t> 交易单状态
		$this->_arr_value['preBdealState'] = $bs->popUint32_t();	//<uint32_t> 交易单前一个状态
		$this->_arr_value['itemTitleList'] = $bs->popString();	//<std::string> 商品标题列表
		$this->_arr_value['itemSkuidList'] = $bs->popString();	//<std::string> 商品skuID列表
		$this->_arr_value['bdealTotalFee'] = $bs->popUint32_t();	//<uint32_t> 交易单总金额，只记录下单时的金额，后续改价不会变，不能作为计算价格依据
		$this->_arr_value['bdealPayment'] = $bs->popUint32_t();	//<uint32_t> 实付总金额，交易单的真实支付金额，计算价格的依据
		$this->_arr_value['bdealRefer'] = $bs->popString();	//<std::string> refer
		$this->_arr_value['bdealIp'] = $bs->popString();	//<std::string> 下单IP
		$this->_arr_value['promotionDesc'] = $bs->popString();	//<std::string> 促销信息描述
		$this->_arr_value['bdealGenTime'] = $bs->popUint32_t();	//<uint32_t> 交易单生成时间
		$this->_arr_value['bdealPayTime'] = $bs->popUint32_t();	//<uint32_t> 交易单付款时间
		$this->_arr_value['bdealEndTime'] = $bs->popUint32_t();	//<uint32_t> 交易单结束时间
		$this->_arr_value['recvName'] = $bs->popString();	//<std::string> 收货人
		$this->_arr_value['recvRegionCode'] = $bs->popUint32_t();	//<uint32_t> 地区编码
		$this->_arr_value['recvRegionCodeExt'] = $bs->popString();	//<std::string> 扩展地区编码
		$this->_arr_value['recvAddress'] = $bs->popString();	//<std::string> 地址
		$this->_arr_value['recvPostCode'] = $bs->popString();	//<std::string> 邮编
		$this->_arr_value['recvPhone'] = $bs->popString();	//<std::string> 电话
		$this->_arr_value['recvMobile'] = $bs->popUint64_t();	//<uint64_t> 手机
		$this->_arr_value['bdealFlag'] = $bs->popUint32_t();	//<uint32_t> 交易单标记
		$this->_arr_value['delFlag'] = $bs->popUint32_t();	//<uint32_t> 订单有效标记
		$this->_arr_value['visibleState'] = $bs->popUint32_t();	//<uint32_t> 可见标识
		$this->_arr_value['bdealDigest'] = $bs->popString();	//<std::string> 交易单摘要
		$this->_arr_value['lastUpdateTime'] = $bs->popUint32_t();	//<uint32_t> 最后更新时间
		$this->_arr_value['dealInfoList'] = $bs->popObject('\ecc\deal\po\DealPoList');	//<ecc::deal::po::CDealPoList> 订单列表
		$this->_arr_value['payInfoList'] = $bs->popObject('\ecc\deal\po\PayInfoPoList');	//<ecc::deal::po::CPayInfoPoList> 支付信息表
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['businessDealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerAccount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerNickName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerNick_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerTitle_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerNick_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['businessId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealSource_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealPayType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['preBdealState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemTitleList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemSkuidList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealTotalFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealPayment_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealRefer_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealIp_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['promotionDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealGenTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealPayTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealEndTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvRegionCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvRegionCodeExt_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvAddress_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvPostCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvPhone_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvMobile_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealFlag_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['delFlag_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['visibleState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealDigest_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['lastUpdateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.BdealPo.java
class DealPoList{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $dealInfoList;	//<std::vector<ecc::deal::po::CDealPo> > 订单列表(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $dealInfoList_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->dealInfoList = new \stl_vector2('\ecc\deal\po\DealPo');	//<std::vector<ecc::deal::po::CDealPo> >
		$this->version_u = 0;	//<uint8_t>
		$this->dealInfoList_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\po\DealPoList\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\DealPoList\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushObject($this->dealInfoList,'stl_vector');	//<std::vector<ecc::deal::po::CDealPo> > 订单列表
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealInfoList_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['dealInfoList'] = $bs->popObject('stl_vector<\ecc\deal\po\DealPo>');	//<std::vector<ecc::deal::po::CDealPo> > 订单列表
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.CSCreateBuyDealReq.java
class OrderPoList{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $orderInfoList;	//<std::vector<ecc::deal::po::COrderPo> > 订单列表(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $orderInfoList_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->orderInfoList = new \stl_vector2('\ecc\deal\po\OrderPo');	//<std::vector<ecc::deal::po::COrderPo> >
		$this->version_u = 0;	//<uint8_t>
		$this->orderInfoList_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\po\OrderPoList\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\OrderPoList\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushObject($this->orderInfoList,'stl_vector');	//<std::vector<ecc::deal::po::COrderPo> > 订单列表
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->orderInfoList_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['orderInfoList'] = $bs->popObject('stl_vector<\ecc\deal\po\OrderPo>');	//<std::vector<ecc::deal::po::COrderPo> > 订单列表
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['orderInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.OrderPoList.java
class OrderPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $dealId;	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702，可为空(版本>=0)
	private $dealId64;	//<uint64_t> 订单单号，拍拍订单同步可使用，可为空(版本>=0)
	private $bdealId;	//<uint64_t> 交易单号，可为空(版本>=0)
	private $businessDealId;	//<std::string> 业务订单编号，第三方托管订单(版本>=0)
	private $buyerId;	//<uint64_t> 买家ID(版本>=0)
	private $buyerAccount;	//<std::string> 买家帐号(版本>=0)
	private $buyerNickName;	//<std::string> 买家姓名(版本>=0)
	private $buyerNick;	//<std::string> 买家昵称(版本>=0)
	private $sellerId;	//<uint64_t> 商家ID(版本>=0)
	private $sellerTitle;	//<std::string> 商家真实名称(版本>=0)
	private $sellerNick;	//<std::string> 卖家昵称(版本>=0)
	private $businessId;	//<uint32_t> 业务ID(版本>=0)
	private $dealType;	//<uint8_t> 订单类型(版本>=0)
	private $dealSource;	//<uint32_t> 下单渠道：1：业务主站；2：移动app；3：移动wap(版本>=0)
	private $dealPayType;	//<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款(版本>=0)
	private $dealState;	//<uint32_t> 订单状态(版本>=0)
	private $dealProperty;	//<uint32_t> 订单属性值，通用(版本>=0)
	private $dealProperty1;	//<uint32_t> 订单属性值，业务1扩展用(版本>=0)
	private $dealProperty2;	//<uint32_t> 订单属性值，业务2扩展用(版本>=0)
	private $dealProperty3;	//<uint32_t> 订单属性值，业务3扩展用(版本>=0)
	private $dealProperty4;	//<uint32_t> 订单属性值，业务4扩展用(版本>=0)
	private $itemSkuidList;	//<std::string> 商品skuID列表(版本>=0)
	private $itemTitleList;	//<std::string> 商品标题列表(版本>=0)
	private $dealTotalFee;	//<uint32_t> 订单总金额,下单金额(版本>=0)
	private $dealAdjustFee;	//<int> 调价金额(版本>=0)
	private $dealPayment;	//<uint32_t> 实付总金额(版本>=0)
	private $dealDownPayment;	//<uint32_t> C2B预售定金金额(版本>=0)
	private $dealDiscountTotal;	//<int> 优惠总金额; 活动列表优惠金额汇总(版本>=0)
	private $dealItemTotalFee;	//<uint32_t> 商品子单总金额(版本>=0)
	private $dealWhoPayShippingFee;	//<uint32_t> 谁支付邮费，1：卖家；2：买家(版本>=0)
	private $dealShippingFee;	//<uint32_t> 邮费金额(版本>=0)
	private $dealWhoPayCodFee;	//<uint32_t> 谁承担COD手续费，1：卖家承担；2：买家；3：平台承担(版本>=0)
	private $dealCodFee;	//<uint32_t> COD手续额(版本>=0)
	private $dealWhoPayInsuranceFee;	//<uint32_t> 谁支付保险费，1：卖家赠送；2：买家；3：平台承担(版本>=0)
	private $dealInsuranceFee;	//<uint32_t> 运费保险费(版本>=0)
	private $dealSysAdjustFee;	//<int> 系统调价金额，用于区分COD卖家调价金额和用于凑整的COD优惠金额(版本>=0)
	private $payScore;	//<uint32_t> 积分支付值(版本>=0)
	private $obtainScore;	//<uint32_t> 获得积分值(版本>=0)
	private $dealGenTime;	//<uint32_t> 订单生成时间(版本>=0)
	private $sendFromDesc;	//<std::string> 订单发货地描述(版本>=0)
	private $dealSeq;	//<uint64_t> 下单时间戳(版本>=0)
	private $dealMd5;	//<uint64_t> 下单md5(版本>=0)
	private $dealIp;	//<std::string> 下单IP(版本>=0)
	private $dealRefer;	//<std::string> refer(版本>=0)
	private $dealVisitKey;	//<std::string> visitkey(版本>=0)
	private $promotionDesc;	//<std::string> 订单促销信息描述(版本>=0)
	private $recvName;	//<std::string> 收货人(版本>=0)
	private $recvRegionCode;	//<uint32_t> 地区编码(版本>=0)
	private $recvAddress;	//<std::string> 地址(版本>=0)
	private $recvPostCode;	//<std::string> 邮编(版本>=0)
	private $recvPhone;	//<std::string> 电话(版本>=0)
	private $recvMobile;	//<uint64_t> 手机(版本>=0)
	private $expectRecvTime;	//<uint32_t> 期望收货时间,天(版本>=0)
	private $expectRecvTimeSpan;	//<std::string> 期望收货时段(版本>=0)
	private $recvRemark;	//<std::string> 收货附言(版本>=0)
	private $recvMask;	//<uint32_t> 收货属性值(版本>=0)
	private $expressType;	//<uint8_t> 配送方式；1：平邮；2：快递；3：EMS；4：B2C自建物流；5：用户配送点自提(版本>=0)
	private $expressCompanyID;	//<std::string> 物流公司ID(版本>=0)
	private $expressCompanyName;	//<std::string> 物流公司名称(版本>=0)
	private $invoiceType;	//<uint8_t> 发票类型(版本>=0)
	private $invoiceHead;	//<std::string> 发票抬头(版本>=0)
	private $invoiceContent;	//<std::string> 发票内容(版本>=0)
	private $cftDealId;	//<std::string> Cft支付单号(版本>=0)
	private $lastUpdateTime;	//<uint32_t> 最后更新时间(版本>=0)
	private $tradeInfoList;	//<ecc::deal::po::COrderTradePoList> 商品子单列表(版本>=0)
	private $payInfoList;	//<ecc::deal::po::COrderPayInfoPoList> 支付信息表(版本>=0)
	private $actionLogInfoList;	//<ecc::deal::po::CDealActionLogPoList> 流水日志表(版本>=0)
	private $dealExtInfoMap;	//<std::multimap<uint32_t,std::string> > 订单扩展信息 (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $dealId_u;	//<uint8_t> (版本>=0)
	private $dealId64_u;	//<uint8_t> (版本>=0)
	private $bdealId_u;	//<uint8_t> (版本>=0)
	private $businessDealId_u;	//<uint8_t> (版本>=0)
	private $buyerId_u;	//<uint8_t> (版本>=0)
	private $buyerAccount_u;	//<uint8_t> (版本>=0)
	private $buyerNickName_u;	//<uint8_t> (版本>=0)
	private $buyerNick_u;	//<uint8_t> (版本>=0)
	private $sellerId_u;	//<uint8_t> (版本>=0)
	private $sellerTitle_u;	//<uint8_t> (版本>=0)
	private $sellerNick_u;	//<uint8_t> (版本>=0)
	private $businessId_u;	//<uint8_t> (版本>=0)
	private $dealType_u;	//<uint8_t> (版本>=0)
	private $dealSource_u;	//<uint8_t> (版本>=0)
	private $dealPayType_u;	//<uint8_t> (版本>=0)
	private $dealState_u;	//<uint8_t> (版本>=0)
	private $dealProperty_u;	//<uint8_t> (版本>=0)
	private $dealProperty1_u;	//<uint8_t> (版本>=0)
	private $dealProperty2_u;	//<uint8_t> (版本>=0)
	private $dealProperty3_u;	//<uint8_t> (版本>=0)
	private $dealProperty4_u;	//<uint8_t> (版本>=0)
	private $itemSkuidList_u;	//<uint8_t> (版本>=0)
	private $itemTitleList_u;	//<uint8_t> (版本>=0)
	private $dealTotalFee_u;	//<uint8_t> (版本>=0)
	private $dealAdjustFee_u;	//<uint8_t> (版本>=0)
	private $dealPayment_u;	//<uint8_t> (版本>=0)
	private $dealDownPayment_u;	//<uint8_t> (版本>=0)
	private $dealDiscountTotal_u;	//<uint8_t> (版本>=0)
	private $dealItemTotalFee_u;	//<uint8_t> (版本>=0)
	private $dealWhoPayShippingFee_u;	//<uint8_t> (版本>=0)
	private $dealShippingFee_u;	//<uint8_t> (版本>=0)
	private $dealWhoPayCodFee_u;	//<uint8_t> (版本>=0)
	private $dealCodFee_u;	//<uint8_t> (版本>=0)
	private $dealWhoPayInsuranceFee_u;	//<uint8_t> (版本>=0)
	private $dealInsuranceFee_u;	//<uint8_t> (版本>=0)
	private $dealSysAdjustFee_u;	//<uint8_t> (版本>=0)
	private $payScore_u;	//<uint8_t> (版本>=0)
	private $obtainScore_u;	//<uint8_t> (版本>=0)
	private $dealGenTime_u;	//<uint8_t> (版本>=0)
	private $sendFromDesc_u;	//<uint8_t> (版本>=0)
	private $dealSeq_u;	//<uint8_t> (版本>=0)
	private $dealMd5_u;	//<uint8_t> (版本>=0)
	private $dealIp_u;	//<uint8_t> (版本>=0)
	private $dealRefer_u;	//<uint8_t> (版本>=0)
	private $dealVisitKey_u;	//<uint8_t> (版本>=0)
	private $promotionDesc_u;	//<uint8_t> (版本>=0)
	private $recvName_u;	//<uint8_t> (版本>=0)
	private $recvRegionCode_u;	//<uint8_t> (版本>=0)
	private $recvAddress_u;	//<uint8_t> (版本>=0)
	private $recvPostCode_u;	//<uint8_t> (版本>=0)
	private $recvPhone_u;	//<uint8_t> (版本>=0)
	private $recvMobile_u;	//<uint8_t> (版本>=0)
	private $expectRecvTime_u;	//<uint8_t> (版本>=0)
	private $expectRecvTimeSpan_u;	//<uint8_t> (版本>=0)
	private $recvRemark_u;	//<uint8_t> (版本>=0)
	private $recvMask_u;	//<uint8_t> (版本>=0)
	private $expressType_u;	//<uint8_t> (版本>=0)
	private $expressCompanyID_u;	//<uint8_t> (版本>=0)
	private $expressCompanyName_u;	//<uint8_t> (版本>=0)
	private $invoiceType_u;	//<uint8_t> (版本>=0)
	private $invoiceHead_u;	//<uint8_t> (版本>=0)
	private $invoiceContent_u;	//<uint8_t> (版本>=0)
	private $cftDealId_u;	//<uint8_t> (版本>=0)
	private $lastUpdateTime_u;	//<uint8_t> (版本>=0)
	private $tradeInfoList_u;	//<uint8_t> (版本>=0)
	private $payInfoList_u;	//<uint8_t> (版本>=0)
	private $actionLogInfoList_u;	//<uint8_t> (版本>=0)
	private $dealExtInfoMap_u;	//<uint8_t> (版本>=0)
	private $bdealCode;	//<std::string> 交易单编号，即字符串格式的交易单号，可为空(版本>=1)
	private $businessBdealId;	//<std::string> 业务交易单号，可为空(版本>=1)
	private $siteId;	//<uint32_t> 分站ID(版本>=1)
	private $dealCouponFee;	//<int> 优惠券金额(版本>=1)
	private $cashScore;	//<uint32_t> 现金积分支付值(版本>=1)
	private $promotionScore;	//<uint32_t> 促销积分支付值(版本>=1)
	private $recvRegionCodeExt;	//<std::string> 扩展地区编码(版本>=1)
	private $dealDigest;	//<std::string> 订单摘要(版本>=1)
	private $payInstallmentBank;	//<std::string> 分期付款银行(版本>=1)
	private $payInstallmentNum;	//<uint16_t> 分期付款期数(版本>=1)
	private $payInstallmentPayment;	//<uint32_t> 分期付款每期金额(版本>=1)
	private $icsonShippingType;	//<std::string> 易迅配送方式(版本>=1)
	private $icsonPayType;	//<std::string> 易迅支付方式(版本>=1)
	private $icsonAccount;	//<std::string> 易迅内部帐号ID(版本>=1)
	private $icsonMasterLs;	//<std::string> 易迅跟踪信息(版本>=1)
	private $icsonRate;	//<std::string> 易迅平衡比率(版本>=1)
	private $icsonBankRate;	//<std::string> 易迅银行利率(版本>=1)
	private $icsonShopId;	//<std::string> 易迅店铺id(版本>=1)
	private $icsonShopGuideId;	//<std::string> 易迅店铺导购id(版本>=1)
	private $icsonShopGuideCost;	//<std::string> 易迅店铺导购费用(版本>=1)
	private $icsonShopGuideName;	//<std::string> 易迅店铺导购名称(版本>=1)
	private $icsonSubsidyType;	//<std::string> 易迅节能补贴类型(版本>=1)
	private $icsonSubsidyName;	//<std::string> 易迅节能补贴姓名(版本>=1)
	private $icsonSubsidyIdCard;	//<std::string> 易迅节能补贴身份证(版本>=1)
	private $icsonCSOrderOperatorId;	//<std::string> 易迅客服下单操作员ID(版本>=1)
	private $icsonCSOrderOperatorName;	//<std::string> 易迅客服下单操作员名称(版本>=1)
	private $icsonInvoiceCompanyName;	//<std::string> 易迅发票公司名称(版本>=1)
	private $icsonInvoiceCompanyAddr;	//<std::string> 易迅发票公司地址(版本>=1)
	private $icsonInvoiceCompanyPhone;	//<std::string> 易迅发票公司电话(版本>=1)
	private $icsonInvoiceCompanyTaxNo;	//<std::string> 易迅发票公司税号(版本>=1)
	private $icsonInvoiceCompanyBankNo;	//<std::string> 易迅发票公司银行账户(版本>=1)
	private $icsonInvoiceCompanyBankName;	//<std::string> 易迅发票公司银行名称(版本>=1)
	private $icsonInvoiceRecvName;	//<std::string> 易迅发票收货人(版本>=1)
	private $icsonInvoiceRecvAddr;	//<std::string> 易迅发票收货地址(版本>=1)
	private $icsonInvoiceRecvRegionId;	//<std::string> 易迅发票收货地址ID(版本>=1)
	private $icsonInvoiceRecvMobile;	//<std::string> 易迅发票收货手机(版本>=1)
	private $icsonInvoiceRecvTel;	//<std::string> 易迅发票收货电话(版本>=1)
	private $icsonInvoiceRecvZip;	//<std::string> 易迅发票收货邮编(版本>=1)
	private $icsonInvoiceShipType;	//<std::string> 易迅发票配送方式(版本>=1)
	private $icsonInvoiceShipFee;	//<std::string> 易迅发票配送费用(版本>=1)
	private $icsonDealFlag;	//<std::string> 易迅订单flag(版本>=1)
	private $icsonStockNo;	//<std::string> 易迅订单物流仓库编号(版本>=1)
	private $bdealCode_u;	//<uint8_t> (版本>=1)
	private $businessBdealId_u;	//<uint8_t> (版本>=1)
	private $siteId_u;	//<uint8_t> (版本>=1)
	private $dealCouponFee_u;	//<uint8_t> (版本>=1)
	private $cashScore_u;	//<uint8_t> (版本>=1)
	private $promotionScore_u;	//<uint8_t> (版本>=1)
	private $recvRegionCodeExt_u;	//<uint8_t> (版本>=1)
	private $dealDigest_u;	//<uint8_t> (版本>=1)
	private $payInstallmentBank_u;	//<uint8_t> 分期付款银行UFlag(版本>=1)
	private $payInstallmentNum_u;	//<uint8_t> 分期付款期数UFlag(版本>=1)
	private $payInstallmentPayment_u;	//<uint8_t> 分期付款每期金额UFlag(版本>=1)
	private $icsonShippingType_u;	//<uint8_t> 易迅配送方式UFlag(版本>=1)
	private $icsonPayType_u;	//<uint8_t> 易迅支付方式UFlag(版本>=1)
	private $icsonAccount_u;	//<uint8_t> (版本>=1)
	private $icsonMasterLs_u;	//<uint8_t> (版本>=1)
	private $icsonRate_u;	//<uint8_t> (版本>=1)
	private $icsonBankRate_u;	//<uint8_t> (版本>=1)
	private $icsonShopId_u;	//<uint8_t> (版本>=1)
	private $icsonShopGuideId_u;	//<uint8_t> (版本>=1)
	private $icsonShopGuideCost_u;	//<uint8_t> (版本>=1)
	private $icsonShopGuideName_u;	//<uint8_t> (版本>=1)
	private $icsonSubsidyType_u;	//<uint8_t> (版本>=1)
	private $icsonSubsidyName_u;	//<uint8_t> (版本>=1)
	private $icsonSubsidyIdCard_u;	//<uint8_t> (版本>=1)
	private $icsonCSOrderOperatorId_u;	//<uint8_t> (版本>=1)
	private $icsonCSOrderOperatorName_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceCompanyName_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceCompanyAddr_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceCompanyPhone_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceCompanyTaxNo_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceCompanyBankNo_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceCompanyBankName_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceRecvName_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceRecvAddr_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceRecvRegionId_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceRecvMobile_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceRecvTel_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceRecvZip_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceShipType_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceShipFee_u;	//<uint8_t> (版本>=1)
	private $icsonDealFlag_u;	//<uint8_t> 易迅订单flag(版本>=1)
	private $icsonStockNo_u;	//<uint8_t> 易迅订单物流仓库编号(版本>=1)
	private $payChannel;	//<uint8_t> 支付渠道(版本>=2)
	private $payServiceFee;	//<uint32_t> 支付手续费(版本>=2)
	private $icsonDealCashBack;	//<uint32_t> 订单返现金额(版本>=2)
	private $payChannel_u;	//<uint8_t> 支付渠道UFlag(版本>=2)
	private $payServiceFee_u;	//<uint8_t> 支付手续费UFlag(版本>=2)
	private $icsonDealCashBack_u;	//<uint8_t> 订单返现金额UFlag(版本>=2)
	private $payInstallmentFee;	//<uint32_t> 分期付款手续费(版本>=3)
	private $payInstallmentFee_u;	//<uint8_t> 分期付款手续费UFlag(版本>=3)
	private $icsonDealCode;	//<std::string> 易迅订单号，带10开头(版本>=4)
	private $icsonDealCode_u;	//<uint8_t> 订单返现金额UFlag(版本>=4)
	private $icsonInvoiceStockNo;	//<std::string> 易迅货票分离仓库id(版本>=5)
	private $icsonInvoiceSiteId;	//<std::string> 易迅货票分离分站id(版本>=5)
	private $icsonInvoiceStockNo_u;	//<uint8_t> (版本>=5)
	private $icsonInvoiceSiteId_u;	//<uint8_t> (版本>=5)
	private $sellerCorpId;	//<uint64_t> 易迅联营商家id(版本>=6)
	private $lmsVolume;	//<std::string> 体积(版本>=6)
	private $lmsWeight;	//<std::string> 重量(版本>=6)
	private $lmsLongest;	//<std::string> 最长边(版本>=6)
	private $sellerCorpId_u;	//<uint8_t> (版本>=6)
	private $lmsVolume_u;	//<uint8_t> (版本>=6)
	private $lmsWeight_u;	//<uint8_t> (版本>=6)
	private $lmsLongest_u;	//<uint8_t> (版本>=6)
	private $dealActiveInfoList;	//<ecc::deal::po::CTradeActivePoList> 订单活动列表(版本>=7)
	private $dealActiveInfoList_u;	//<uint8_t> (版本>=7)

	function __construct(){
		$this->version = 7;	//<uint16_t>
		$this->dealId = "";	//<std::string>
		$this->dealId64 = 0;	//<uint64_t>
		$this->bdealId = 0;	//<uint64_t>
		$this->businessDealId = "";	//<std::string>
		$this->buyerId = 0;	//<uint64_t>
		$this->buyerAccount = "";	//<std::string>
		$this->buyerNickName = "";	//<std::string>
		$this->buyerNick = "";	//<std::string>
		$this->sellerId = 0;	//<uint64_t>
		$this->sellerTitle = "";	//<std::string>
		$this->sellerNick = "";	//<std::string>
		$this->businessId = 0;	//<uint32_t>
		$this->dealType = 0;	//<uint8_t>
		$this->dealSource = 0;	//<uint32_t>
		$this->dealPayType = 0;	//<uint8_t>
		$this->dealState = 0;	//<uint32_t>
		$this->dealProperty = 0;	//<uint32_t>
		$this->dealProperty1 = 0;	//<uint32_t>
		$this->dealProperty2 = 0;	//<uint32_t>
		$this->dealProperty3 = 0;	//<uint32_t>
		$this->dealProperty4 = 0;	//<uint32_t>
		$this->itemSkuidList = "";	//<std::string>
		$this->itemTitleList = "";	//<std::string>
		$this->dealTotalFee = 0;	//<uint32_t>
		$this->dealAdjustFee = 0;	//<int>
		$this->dealPayment = 0;	//<uint32_t>
		$this->dealDownPayment = 0;	//<uint32_t>
		$this->dealDiscountTotal = 0;	//<int>
		$this->dealItemTotalFee = 0;	//<uint32_t>
		$this->dealWhoPayShippingFee = 0;	//<uint32_t>
		$this->dealShippingFee = 0;	//<uint32_t>
		$this->dealWhoPayCodFee = 0;	//<uint32_t>
		$this->dealCodFee = 0;	//<uint32_t>
		$this->dealWhoPayInsuranceFee = 0;	//<uint32_t>
		$this->dealInsuranceFee = 0;	//<uint32_t>
		$this->dealSysAdjustFee = 0;	//<int>
		$this->payScore = 0;	//<uint32_t>
		$this->obtainScore = 0;	//<uint32_t>
		$this->dealGenTime = 0;	//<uint32_t>
		$this->sendFromDesc = "";	//<std::string>
		$this->dealSeq = 0;	//<uint64_t>
		$this->dealMd5 = 0;	//<uint64_t>
		$this->dealIp = "";	//<std::string>
		$this->dealRefer = "";	//<std::string>
		$this->dealVisitKey = "";	//<std::string>
		$this->promotionDesc = "";	//<std::string>
		$this->recvName = "";	//<std::string>
		$this->recvRegionCode = 0;	//<uint32_t>
		$this->recvAddress = "";	//<std::string>
		$this->recvPostCode = "";	//<std::string>
		$this->recvPhone = "";	//<std::string>
		$this->recvMobile = 0;	//<uint64_t>
		$this->expectRecvTime = 0;	//<uint32_t>
		$this->expectRecvTimeSpan = "";	//<std::string>
		$this->recvRemark = "";	//<std::string>
		$this->recvMask = 0;	//<uint32_t>
		$this->expressType = 0;	//<uint8_t>
		$this->expressCompanyID = "";	//<std::string>
		$this->expressCompanyName = "";	//<std::string>
		$this->invoiceType = 0;	//<uint8_t>
		$this->invoiceHead = "";	//<std::string>
		$this->invoiceContent = "";	//<std::string>
		$this->cftDealId = "";	//<std::string>
		$this->lastUpdateTime = 0;	//<uint32_t>
		$this->tradeInfoList = new \ecc\deal\po\OrderTradePoList();	//<ecc::deal::po::COrderTradePoList>
		$this->payInfoList = new \ecc\deal\po\OrderPayInfoPoList();	//<ecc::deal::po::COrderPayInfoPoList>
		$this->actionLogInfoList = new \ecc\deal\po\DealActionLogPoList();	//<ecc::deal::po::CDealActionLogPoList>
		$this->dealExtInfoMap = new \stl_multimap2('uint32_t,stl_string');	//<std::multimap<uint32_t,std::string> >
		$this->version_u = 0;	//<uint8_t>
		$this->dealId_u = 0;	//<uint8_t>
		$this->dealId64_u = 0;	//<uint8_t>
		$this->bdealId_u = 0;	//<uint8_t>
		$this->businessDealId_u = 0;	//<uint8_t>
		$this->buyerId_u = 0;	//<uint8_t>
		$this->buyerAccount_u = 0;	//<uint8_t>
		$this->buyerNickName_u = 0;	//<uint8_t>
		$this->buyerNick_u = 0;	//<uint8_t>
		$this->sellerId_u = 0;	//<uint8_t>
		$this->sellerTitle_u = 0;	//<uint8_t>
		$this->sellerNick_u = 0;	//<uint8_t>
		$this->businessId_u = 0;	//<uint8_t>
		$this->dealType_u = 0;	//<uint8_t>
		$this->dealSource_u = 0;	//<uint8_t>
		$this->dealPayType_u = 0;	//<uint8_t>
		$this->dealState_u = 0;	//<uint8_t>
		$this->dealProperty_u = 0;	//<uint8_t>
		$this->dealProperty1_u = 0;	//<uint8_t>
		$this->dealProperty2_u = 0;	//<uint8_t>
		$this->dealProperty3_u = 0;	//<uint8_t>
		$this->dealProperty4_u = 0;	//<uint8_t>
		$this->itemSkuidList_u = 0;	//<uint8_t>
		$this->itemTitleList_u = 0;	//<uint8_t>
		$this->dealTotalFee_u = 0;	//<uint8_t>
		$this->dealAdjustFee_u = 0;	//<uint8_t>
		$this->dealPayment_u = 0;	//<uint8_t>
		$this->dealDownPayment_u = 0;	//<uint8_t>
		$this->dealDiscountTotal_u = 0;	//<uint8_t>
		$this->dealItemTotalFee_u = 0;	//<uint8_t>
		$this->dealWhoPayShippingFee_u = 0;	//<uint8_t>
		$this->dealShippingFee_u = 0;	//<uint8_t>
		$this->dealWhoPayCodFee_u = 0;	//<uint8_t>
		$this->dealCodFee_u = 0;	//<uint8_t>
		$this->dealWhoPayInsuranceFee_u = 0;	//<uint8_t>
		$this->dealInsuranceFee_u = 0;	//<uint8_t>
		$this->dealSysAdjustFee_u = 0;	//<uint8_t>
		$this->payScore_u = 0;	//<uint8_t>
		$this->obtainScore_u = 0;	//<uint8_t>
		$this->dealGenTime_u = 0;	//<uint8_t>
		$this->sendFromDesc_u = 0;	//<uint8_t>
		$this->dealSeq_u = 0;	//<uint8_t>
		$this->dealMd5_u = 0;	//<uint8_t>
		$this->dealIp_u = 0;	//<uint8_t>
		$this->dealRefer_u = 0;	//<uint8_t>
		$this->dealVisitKey_u = 0;	//<uint8_t>
		$this->promotionDesc_u = 0;	//<uint8_t>
		$this->recvName_u = 0;	//<uint8_t>
		$this->recvRegionCode_u = 0;	//<uint8_t>
		$this->recvAddress_u = 0;	//<uint8_t>
		$this->recvPostCode_u = 0;	//<uint8_t>
		$this->recvPhone_u = 0;	//<uint8_t>
		$this->recvMobile_u = 0;	//<uint8_t>
		$this->expectRecvTime_u = 0;	//<uint8_t>
		$this->expectRecvTimeSpan_u = 0;	//<uint8_t>
		$this->recvRemark_u = 0;	//<uint8_t>
		$this->recvMask_u = 0;	//<uint8_t>
		$this->expressType_u = 0;	//<uint8_t>
		$this->expressCompanyID_u = 0;	//<uint8_t>
		$this->expressCompanyName_u = 0;	//<uint8_t>
		$this->invoiceType_u = 0;	//<uint8_t>
		$this->invoiceHead_u = 0;	//<uint8_t>
		$this->invoiceContent_u = 0;	//<uint8_t>
		$this->cftDealId_u = 0;	//<uint8_t>
		$this->lastUpdateTime_u = 0;	//<uint8_t>
		$this->tradeInfoList_u = 0;	//<uint8_t>
		$this->payInfoList_u = 0;	//<uint8_t>
		$this->actionLogInfoList_u = 0;	//<uint8_t>
		$this->dealExtInfoMap_u = 0;	//<uint8_t>
		$this->bdealCode = "";	//<std::string>
		$this->businessBdealId = "";	//<std::string>
		$this->siteId = 0;	//<uint32_t>
		$this->dealCouponFee = 0;	//<int>
		$this->cashScore = 0;	//<uint32_t>
		$this->promotionScore = 0;	//<uint32_t>
		$this->recvRegionCodeExt = "";	//<std::string>
		$this->dealDigest = "";	//<std::string>
		$this->payInstallmentBank = "";	//<std::string>
		$this->payInstallmentNum = 0;	//<uint16_t>
		$this->payInstallmentPayment = 0;	//<uint32_t>
		$this->icsonShippingType = "";	//<std::string>
		$this->icsonPayType = "";	//<std::string>
		$this->icsonAccount = "";	//<std::string>
		$this->icsonMasterLs = "";	//<std::string>
		$this->icsonRate = "";	//<std::string>
		$this->icsonBankRate = "";	//<std::string>
		$this->icsonShopId = "";	//<std::string>
		$this->icsonShopGuideId = "";	//<std::string>
		$this->icsonShopGuideCost = "";	//<std::string>
		$this->icsonShopGuideName = "";	//<std::string>
		$this->icsonSubsidyType = "";	//<std::string>
		$this->icsonSubsidyName = "";	//<std::string>
		$this->icsonSubsidyIdCard = "";	//<std::string>
		$this->icsonCSOrderOperatorId = "";	//<std::string>
		$this->icsonCSOrderOperatorName = "";	//<std::string>
		$this->icsonInvoiceCompanyName = "";	//<std::string>
		$this->icsonInvoiceCompanyAddr = "";	//<std::string>
		$this->icsonInvoiceCompanyPhone = "";	//<std::string>
		$this->icsonInvoiceCompanyTaxNo = "";	//<std::string>
		$this->icsonInvoiceCompanyBankNo = "";	//<std::string>
		$this->icsonInvoiceCompanyBankName = "";	//<std::string>
		$this->icsonInvoiceRecvName = "";	//<std::string>
		$this->icsonInvoiceRecvAddr = "";	//<std::string>
		$this->icsonInvoiceRecvRegionId = "";	//<std::string>
		$this->icsonInvoiceRecvMobile = "";	//<std::string>
		$this->icsonInvoiceRecvTel = "";	//<std::string>
		$this->icsonInvoiceRecvZip = "";	//<std::string>
		$this->icsonInvoiceShipType = "";	//<std::string>
		$this->icsonInvoiceShipFee = "";	//<std::string>
		$this->icsonDealFlag = "";	//<std::string>
		$this->icsonStockNo = "";	//<std::string>
		$this->bdealCode_u = 0;	//<uint8_t>
		$this->businessBdealId_u = 0;	//<uint8_t>
		$this->siteId_u = 0;	//<uint8_t>
		$this->dealCouponFee_u = 0;	//<uint8_t>
		$this->cashScore_u = 0;	//<uint8_t>
		$this->promotionScore_u = 0;	//<uint8_t>
		$this->recvRegionCodeExt_u = 0;	//<uint8_t>
		$this->dealDigest_u = 0;	//<uint8_t>
		$this->payInstallmentBank_u = 0;	//<uint8_t>
		$this->payInstallmentNum_u = 0;	//<uint8_t>
		$this->payInstallmentPayment_u = 0;	//<uint8_t>
		$this->icsonShippingType_u = 0;	//<uint8_t>
		$this->icsonPayType_u = 0;	//<uint8_t>
		$this->icsonAccount_u = 0;	//<uint8_t>
		$this->icsonMasterLs_u = 0;	//<uint8_t>
		$this->icsonRate_u = 0;	//<uint8_t>
		$this->icsonBankRate_u = 0;	//<uint8_t>
		$this->icsonShopId_u = 0;	//<uint8_t>
		$this->icsonShopGuideId_u = 0;	//<uint8_t>
		$this->icsonShopGuideCost_u = 0;	//<uint8_t>
		$this->icsonShopGuideName_u = 0;	//<uint8_t>
		$this->icsonSubsidyType_u = 0;	//<uint8_t>
		$this->icsonSubsidyName_u = 0;	//<uint8_t>
		$this->icsonSubsidyIdCard_u = 0;	//<uint8_t>
		$this->icsonCSOrderOperatorId_u = 0;	//<uint8_t>
		$this->icsonCSOrderOperatorName_u = 0;	//<uint8_t>
		$this->icsonInvoiceCompanyName_u = 0;	//<uint8_t>
		$this->icsonInvoiceCompanyAddr_u = 0;	//<uint8_t>
		$this->icsonInvoiceCompanyPhone_u = 0;	//<uint8_t>
		$this->icsonInvoiceCompanyTaxNo_u = 0;	//<uint8_t>
		$this->icsonInvoiceCompanyBankNo_u = 0;	//<uint8_t>
		$this->icsonInvoiceCompanyBankName_u = 0;	//<uint8_t>
		$this->icsonInvoiceRecvName_u = 0;	//<uint8_t>
		$this->icsonInvoiceRecvAddr_u = 0;	//<uint8_t>
		$this->icsonInvoiceRecvRegionId_u = 0;	//<uint8_t>
		$this->icsonInvoiceRecvMobile_u = 0;	//<uint8_t>
		$this->icsonInvoiceRecvTel_u = 0;	//<uint8_t>
		$this->icsonInvoiceRecvZip_u = 0;	//<uint8_t>
		$this->icsonInvoiceShipType_u = 0;	//<uint8_t>
		$this->icsonInvoiceShipFee_u = 0;	//<uint8_t>
		$this->icsonDealFlag_u = 0;	//<uint8_t>
		$this->icsonStockNo_u = 0;	//<uint8_t>
		$this->payChannel = 0;	//<uint8_t>
		$this->payServiceFee = 0;	//<uint32_t>
		$this->icsonDealCashBack = 0;	//<uint32_t>
		$this->payChannel_u = 0;	//<uint8_t>
		$this->payServiceFee_u = 0;	//<uint8_t>
		$this->icsonDealCashBack_u = 0;	//<uint8_t>
		$this->payInstallmentFee = 0;	//<uint32_t>
		$this->payInstallmentFee_u = 0;	//<uint8_t>
		$this->icsonDealCode = "";	//<std::string>
		$this->icsonDealCode_u = 0;	//<uint8_t>
		$this->icsonInvoiceStockNo = "";	//<std::string>
		$this->icsonInvoiceSiteId = "";	//<std::string>
		$this->icsonInvoiceStockNo_u = 0;	//<uint8_t>
		$this->icsonInvoiceSiteId_u = 0;	//<uint8_t>
		$this->sellerCorpId = 0;	//<uint64_t>
		$this->lmsVolume = "";	//<std::string>
		$this->lmsWeight = "";	//<std::string>
		$this->lmsLongest = "";	//<std::string>
		$this->sellerCorpId_u = 0;	//<uint8_t>
		$this->lmsVolume_u = 0;	//<uint8_t>
		$this->lmsWeight_u = 0;	//<uint8_t>
		$this->lmsLongest_u = 0;	//<uint8_t>
		$this->dealActiveInfoList = new \ecc\deal\po\TradeActivePoList();	//<ecc::deal::po::CTradeActivePoList>
		$this->dealActiveInfoList_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\po\OrderPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\OrderPo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushString($this->dealId);	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702，可为空
		$bs->pushUint64_t($this->dealId64);	//<uint64_t> 订单单号，拍拍订单同步可使用，可为空
		$bs->pushUint64_t($this->bdealId);	//<uint64_t> 交易单号，可为空
		$bs->pushString($this->businessDealId);	//<std::string> 业务订单编号，第三方托管订单
		$bs->pushUint64_t($this->buyerId);	//<uint64_t> 买家ID
		$bs->pushString($this->buyerAccount);	//<std::string> 买家帐号
		$bs->pushString($this->buyerNickName);	//<std::string> 买家姓名
		$bs->pushString($this->buyerNick);	//<std::string> 买家昵称
		$bs->pushUint64_t($this->sellerId);	//<uint64_t> 商家ID
		$bs->pushString($this->sellerTitle);	//<std::string> 商家真实名称
		$bs->pushString($this->sellerNick);	//<std::string> 卖家昵称
		$bs->pushUint32_t($this->businessId);	//<uint32_t> 业务ID
		$bs->pushUint8_t($this->dealType);	//<uint8_t> 订单类型
		$bs->pushUint32_t($this->dealSource);	//<uint32_t> 下单渠道：1：业务主站；2：移动app；3：移动wap
		$bs->pushUint8_t($this->dealPayType);	//<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款
		$bs->pushUint32_t($this->dealState);	//<uint32_t> 订单状态
		$bs->pushUint32_t($this->dealProperty);	//<uint32_t> 订单属性值，通用
		$bs->pushUint32_t($this->dealProperty1);	//<uint32_t> 订单属性值，业务1扩展用
		$bs->pushUint32_t($this->dealProperty2);	//<uint32_t> 订单属性值，业务2扩展用
		$bs->pushUint32_t($this->dealProperty3);	//<uint32_t> 订单属性值，业务3扩展用
		$bs->pushUint32_t($this->dealProperty4);	//<uint32_t> 订单属性值，业务4扩展用
		$bs->pushString($this->itemSkuidList);	//<std::string> 商品skuID列表
		$bs->pushString($this->itemTitleList);	//<std::string> 商品标题列表
		$bs->pushUint32_t($this->dealTotalFee);	//<uint32_t> 订单总金额,下单金额
		$bs->pushInt32_t($this->dealAdjustFee);	//<int> 调价金额
		$bs->pushUint32_t($this->dealPayment);	//<uint32_t> 实付总金额
		$bs->pushUint32_t($this->dealDownPayment);	//<uint32_t> C2B预售定金金额
		$bs->pushInt32_t($this->dealDiscountTotal);	//<int> 优惠总金额; 活动列表优惠金额汇总
		$bs->pushUint32_t($this->dealItemTotalFee);	//<uint32_t> 商品子单总金额
		$bs->pushUint32_t($this->dealWhoPayShippingFee);	//<uint32_t> 谁支付邮费，1：卖家；2：买家
		$bs->pushUint32_t($this->dealShippingFee);	//<uint32_t> 邮费金额
		$bs->pushUint32_t($this->dealWhoPayCodFee);	//<uint32_t> 谁承担COD手续费，1：卖家承担；2：买家；3：平台承担
		$bs->pushUint32_t($this->dealCodFee);	//<uint32_t> COD手续额
		$bs->pushUint32_t($this->dealWhoPayInsuranceFee);	//<uint32_t> 谁支付保险费，1：卖家赠送；2：买家；3：平台承担
		$bs->pushUint32_t($this->dealInsuranceFee);	//<uint32_t> 运费保险费
		$bs->pushInt32_t($this->dealSysAdjustFee);	//<int> 系统调价金额，用于区分COD卖家调价金额和用于凑整的COD优惠金额
		$bs->pushUint32_t($this->payScore);	//<uint32_t> 积分支付值
		$bs->pushUint32_t($this->obtainScore);	//<uint32_t> 获得积分值
		$bs->pushUint32_t($this->dealGenTime);	//<uint32_t> 订单生成时间
		$bs->pushString($this->sendFromDesc);	//<std::string> 订单发货地描述
		$bs->pushUint64_t($this->dealSeq);	//<uint64_t> 下单时间戳
		$bs->pushUint64_t($this->dealMd5);	//<uint64_t> 下单md5
		$bs->pushString($this->dealIp);	//<std::string> 下单IP
		$bs->pushString($this->dealRefer);	//<std::string> refer
		$bs->pushString($this->dealVisitKey);	//<std::string> visitkey
		$bs->pushString($this->promotionDesc);	//<std::string> 订单促销信息描述
		$bs->pushString($this->recvName);	//<std::string> 收货人
		$bs->pushUint32_t($this->recvRegionCode);	//<uint32_t> 地区编码
		$bs->pushString($this->recvAddress);	//<std::string> 地址
		$bs->pushString($this->recvPostCode);	//<std::string> 邮编
		$bs->pushString($this->recvPhone);	//<std::string> 电话
		$bs->pushUint64_t($this->recvMobile);	//<uint64_t> 手机
		$bs->pushUint32_t($this->expectRecvTime);	//<uint32_t> 期望收货时间,天
		$bs->pushString($this->expectRecvTimeSpan);	//<std::string> 期望收货时段
		$bs->pushString($this->recvRemark);	//<std::string> 收货附言
		$bs->pushUint32_t($this->recvMask);	//<uint32_t> 收货属性值
		$bs->pushUint8_t($this->expressType);	//<uint8_t> 配送方式；1：平邮；2：快递；3：EMS；4：B2C自建物流；5：用户配送点自提
		$bs->pushString($this->expressCompanyID);	//<std::string> 物流公司ID
		$bs->pushString($this->expressCompanyName);	//<std::string> 物流公司名称
		$bs->pushUint8_t($this->invoiceType);	//<uint8_t> 发票类型
		$bs->pushString($this->invoiceHead);	//<std::string> 发票抬头
		$bs->pushString($this->invoiceContent);	//<std::string> 发票内容
		$bs->pushString($this->cftDealId);	//<std::string> Cft支付单号
		$bs->pushUint32_t($this->lastUpdateTime);	//<uint32_t> 最后更新时间
		$bs->pushObject($this->tradeInfoList,'\ecc\deal\po\OrderTradePoList');	//<ecc::deal::po::COrderTradePoList> 商品子单列表
		$bs->pushObject($this->payInfoList,'\ecc\deal\po\OrderPayInfoPoList');	//<ecc::deal::po::COrderPayInfoPoList> 支付信息表
		$bs->pushObject($this->actionLogInfoList,'\ecc\deal\po\DealActionLogPoList');	//<ecc::deal::po::CDealActionLogPoList> 流水日志表
		$bs->pushObject($this->dealExtInfoMap,'stl_multimap');	//<std::multimap<uint32_t,std::string> > 订单扩展信息 
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId64_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->businessDealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerAccount_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerNickName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerNick_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerTitle_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerNick_u);	//<uint8_t> 
		$bs->pushUint8_t($this->businessId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealSource_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealPayType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealProperty_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealProperty1_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealProperty2_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealProperty3_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealProperty4_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemSkuidList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemTitleList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealTotalFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealAdjustFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealPayment_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealDownPayment_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealDiscountTotal_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealItemTotalFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealWhoPayShippingFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealShippingFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealWhoPayCodFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealCodFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealWhoPayInsuranceFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealInsuranceFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealSysAdjustFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payScore_u);	//<uint8_t> 
		$bs->pushUint8_t($this->obtainScore_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealGenTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sendFromDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealSeq_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealMd5_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealIp_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealRefer_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealVisitKey_u);	//<uint8_t> 
		$bs->pushUint8_t($this->promotionDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvRegionCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvAddress_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvPostCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvPhone_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvMobile_u);	//<uint8_t> 
		$bs->pushUint8_t($this->expectRecvTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->expectRecvTimeSpan_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvRemark_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvMask_u);	//<uint8_t> 
		$bs->pushUint8_t($this->expressType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->expressCompanyID_u);	//<uint8_t> 
		$bs->pushUint8_t($this->expressCompanyName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->invoiceType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->invoiceHead_u);	//<uint8_t> 
		$bs->pushUint8_t($this->invoiceContent_u);	//<uint8_t> 
		$bs->pushUint8_t($this->cftDealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->lastUpdateTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeInfoList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payInfoList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->actionLogInfoList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealExtInfoMap_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushString($this->bdealCode);	//<std::string> 交易单编号，即字符串格式的交易单号，可为空
		}
		if($this->version >= 1){
			$bs->pushString($this->businessBdealId);	//<std::string> 业务交易单号，可为空
		}
		if($this->version >= 1){
			$bs->pushUint32_t($this->siteId);	//<uint32_t> 分站ID
		}
		if($this->version >= 1){
			$bs->pushInt32_t($this->dealCouponFee);	//<int> 优惠券金额
		}
		if($this->version >= 1){
			$bs->pushUint32_t($this->cashScore);	//<uint32_t> 现金积分支付值
		}
		if($this->version >= 1){
			$bs->pushUint32_t($this->promotionScore);	//<uint32_t> 促销积分支付值
		}
		if($this->version >= 1){
			$bs->pushString($this->recvRegionCodeExt);	//<std::string> 扩展地区编码
		}
		if($this->version >= 1){
			$bs->pushString($this->dealDigest);	//<std::string> 订单摘要
		}
		if($this->version >= 1){
			$bs->pushString($this->payInstallmentBank);	//<std::string> 分期付款银行
		}
		if($this->version >= 1){
			$bs->pushUint16_t($this->payInstallmentNum);	//<uint16_t> 分期付款期数
		}
		if($this->version >= 1){
			$bs->pushUint32_t($this->payInstallmentPayment);	//<uint32_t> 分期付款每期金额
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonShippingType);	//<std::string> 易迅配送方式
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonPayType);	//<std::string> 易迅支付方式
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonAccount);	//<std::string> 易迅内部帐号ID
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonMasterLs);	//<std::string> 易迅跟踪信息
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonRate);	//<std::string> 易迅平衡比率
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonBankRate);	//<std::string> 易迅银行利率
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonShopId);	//<std::string> 易迅店铺id
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonShopGuideId);	//<std::string> 易迅店铺导购id
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonShopGuideCost);	//<std::string> 易迅店铺导购费用
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonShopGuideName);	//<std::string> 易迅店铺导购名称
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonSubsidyType);	//<std::string> 易迅节能补贴类型
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonSubsidyName);	//<std::string> 易迅节能补贴姓名
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonSubsidyIdCard);	//<std::string> 易迅节能补贴身份证
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSOrderOperatorId);	//<std::string> 易迅客服下单操作员ID
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSOrderOperatorName);	//<std::string> 易迅客服下单操作员名称
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceCompanyName);	//<std::string> 易迅发票公司名称
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceCompanyAddr);	//<std::string> 易迅发票公司地址
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceCompanyPhone);	//<std::string> 易迅发票公司电话
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceCompanyTaxNo);	//<std::string> 易迅发票公司税号
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceCompanyBankNo);	//<std::string> 易迅发票公司银行账户
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceCompanyBankName);	//<std::string> 易迅发票公司银行名称
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceRecvName);	//<std::string> 易迅发票收货人
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceRecvAddr);	//<std::string> 易迅发票收货地址
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceRecvRegionId);	//<std::string> 易迅发票收货地址ID
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceRecvMobile);	//<std::string> 易迅发票收货手机
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceRecvTel);	//<std::string> 易迅发票收货电话
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceRecvZip);	//<std::string> 易迅发票收货邮编
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceShipType);	//<std::string> 易迅发票配送方式
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceShipFee);	//<std::string> 易迅发票配送费用
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonDealFlag);	//<std::string> 易迅订单flag
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonStockNo);	//<std::string> 易迅订单物流仓库编号
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->bdealCode_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->businessBdealId_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->siteId_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->dealCouponFee_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->cashScore_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->promotionScore_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->recvRegionCodeExt_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->dealDigest_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->payInstallmentBank_u);	//<uint8_t> 分期付款银行UFlag
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->payInstallmentNum_u);	//<uint8_t> 分期付款期数UFlag
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->payInstallmentPayment_u);	//<uint8_t> 分期付款每期金额UFlag
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonShippingType_u);	//<uint8_t> 易迅配送方式UFlag
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonPayType_u);	//<uint8_t> 易迅支付方式UFlag
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonAccount_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonMasterLs_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonRate_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonBankRate_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonShopId_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonShopGuideId_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonShopGuideCost_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonShopGuideName_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonSubsidyType_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonSubsidyName_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonSubsidyIdCard_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSOrderOperatorId_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSOrderOperatorName_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceCompanyName_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceCompanyAddr_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceCompanyPhone_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceCompanyTaxNo_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceCompanyBankNo_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceCompanyBankName_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceRecvName_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceRecvAddr_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceRecvRegionId_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceRecvMobile_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceRecvTel_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceRecvZip_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceShipType_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceShipFee_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonDealFlag_u);	//<uint8_t> 易迅订单flag
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonStockNo_u);	//<uint8_t> 易迅订单物流仓库编号
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->payChannel);	//<uint8_t> 支付渠道
		}
		if($this->version >= 2){
			$bs->pushUint32_t($this->payServiceFee);	//<uint32_t> 支付手续费
		}
		if($this->version >= 2){
			$bs->pushUint32_t($this->icsonDealCashBack);	//<uint32_t> 订单返现金额
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->payChannel_u);	//<uint8_t> 支付渠道UFlag
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->payServiceFee_u);	//<uint8_t> 支付手续费UFlag
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->icsonDealCashBack_u);	//<uint8_t> 订单返现金额UFlag
		}
		if($this->version >= 3){
			$bs->pushUint32_t($this->payInstallmentFee);	//<uint32_t> 分期付款手续费
		}
		if($this->version >= 3){
			$bs->pushUint8_t($this->payInstallmentFee_u);	//<uint8_t> 分期付款手续费UFlag
		}
		if($this->version >= 4){
			$bs->pushString($this->icsonDealCode);	//<std::string> 易迅订单号，带10开头
		}
		if($this->version >= 4){
			$bs->pushUint8_t($this->icsonDealCode_u);	//<uint8_t> 订单返现金额UFlag
		}
		if($this->version >= 5){
			$bs->pushString($this->icsonInvoiceStockNo);	//<std::string> 易迅货票分离仓库id
		}
		if($this->version >= 5){
			$bs->pushString($this->icsonInvoiceSiteId);	//<std::string> 易迅货票分离分站id
		}
		if($this->version >= 5){
			$bs->pushUint8_t($this->icsonInvoiceStockNo_u);	//<uint8_t> 
		}
		if($this->version >= 5){
			$bs->pushUint8_t($this->icsonInvoiceSiteId_u);	//<uint8_t> 
		}
		if($this->version >= 6){
			$bs->pushUint64_t($this->sellerCorpId);	//<uint64_t> 易迅联营商家id
		}
		if($this->version >= 6){
			$bs->pushString($this->lmsVolume);	//<std::string> 体积
		}
		if($this->version >= 6){
			$bs->pushString($this->lmsWeight);	//<std::string> 重量
		}
		if($this->version >= 6){
			$bs->pushString($this->lmsLongest);	//<std::string> 最长边
		}
		if($this->version >= 6){
			$bs->pushUint8_t($this->sellerCorpId_u);	//<uint8_t> 
		}
		if($this->version >= 6){
			$bs->pushUint8_t($this->lmsVolume_u);	//<uint8_t> 
		}
		if($this->version >= 6){
			$bs->pushUint8_t($this->lmsWeight_u);	//<uint8_t> 
		}
		if($this->version >= 6){
			$bs->pushUint8_t($this->lmsLongest_u);	//<uint8_t> 
		}
		if($this->version >= 7){
			$bs->pushObject($this->dealActiveInfoList,'\ecc\deal\po\TradeActivePoList');	//<ecc::deal::po::CTradeActivePoList> 订单活动列表
		}
		if($this->version >= 7){
			$bs->pushUint8_t($this->dealActiveInfoList_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['dealId'] = $bs->popString();	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702，可为空
		$this->_arr_value['dealId64'] = $bs->popUint64_t();	//<uint64_t> 订单单号，拍拍订单同步可使用，可为空
		$this->_arr_value['bdealId'] = $bs->popUint64_t();	//<uint64_t> 交易单号，可为空
		$this->_arr_value['businessDealId'] = $bs->popString();	//<std::string> 业务订单编号，第三方托管订单
		$this->_arr_value['buyerId'] = $bs->popUint64_t();	//<uint64_t> 买家ID
		$this->_arr_value['buyerAccount'] = $bs->popString();	//<std::string> 买家帐号
		$this->_arr_value['buyerNickName'] = $bs->popString();	//<std::string> 买家姓名
		$this->_arr_value['buyerNick'] = $bs->popString();	//<std::string> 买家昵称
		$this->_arr_value['sellerId'] = $bs->popUint64_t();	//<uint64_t> 商家ID
		$this->_arr_value['sellerTitle'] = $bs->popString();	//<std::string> 商家真实名称
		$this->_arr_value['sellerNick'] = $bs->popString();	//<std::string> 卖家昵称
		$this->_arr_value['businessId'] = $bs->popUint32_t();	//<uint32_t> 业务ID
		$this->_arr_value['dealType'] = $bs->popUint8_t();	//<uint8_t> 订单类型
		$this->_arr_value['dealSource'] = $bs->popUint32_t();	//<uint32_t> 下单渠道：1：业务主站；2：移动app；3：移动wap
		$this->_arr_value['dealPayType'] = $bs->popUint8_t();	//<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款
		$this->_arr_value['dealState'] = $bs->popUint32_t();	//<uint32_t> 订单状态
		$this->_arr_value['dealProperty'] = $bs->popUint32_t();	//<uint32_t> 订单属性值，通用
		$this->_arr_value['dealProperty1'] = $bs->popUint32_t();	//<uint32_t> 订单属性值，业务1扩展用
		$this->_arr_value['dealProperty2'] = $bs->popUint32_t();	//<uint32_t> 订单属性值，业务2扩展用
		$this->_arr_value['dealProperty3'] = $bs->popUint32_t();	//<uint32_t> 订单属性值，业务3扩展用
		$this->_arr_value['dealProperty4'] = $bs->popUint32_t();	//<uint32_t> 订单属性值，业务4扩展用
		$this->_arr_value['itemSkuidList'] = $bs->popString();	//<std::string> 商品skuID列表
		$this->_arr_value['itemTitleList'] = $bs->popString();	//<std::string> 商品标题列表
		$this->_arr_value['dealTotalFee'] = $bs->popUint32_t();	//<uint32_t> 订单总金额,下单金额
		$this->_arr_value['dealAdjustFee'] = $bs->popInt32_t();	//<int> 调价金额
		$this->_arr_value['dealPayment'] = $bs->popUint32_t();	//<uint32_t> 实付总金额
		$this->_arr_value['dealDownPayment'] = $bs->popUint32_t();	//<uint32_t> C2B预售定金金额
		$this->_arr_value['dealDiscountTotal'] = $bs->popInt32_t();	//<int> 优惠总金额; 活动列表优惠金额汇总
		$this->_arr_value['dealItemTotalFee'] = $bs->popUint32_t();	//<uint32_t> 商品子单总金额
		$this->_arr_value['dealWhoPayShippingFee'] = $bs->popUint32_t();	//<uint32_t> 谁支付邮费，1：卖家；2：买家
		$this->_arr_value['dealShippingFee'] = $bs->popUint32_t();	//<uint32_t> 邮费金额
		$this->_arr_value['dealWhoPayCodFee'] = $bs->popUint32_t();	//<uint32_t> 谁承担COD手续费，1：卖家承担；2：买家；3：平台承担
		$this->_arr_value['dealCodFee'] = $bs->popUint32_t();	//<uint32_t> COD手续额
		$this->_arr_value['dealWhoPayInsuranceFee'] = $bs->popUint32_t();	//<uint32_t> 谁支付保险费，1：卖家赠送；2：买家；3：平台承担
		$this->_arr_value['dealInsuranceFee'] = $bs->popUint32_t();	//<uint32_t> 运费保险费
		$this->_arr_value['dealSysAdjustFee'] = $bs->popInt32_t();	//<int> 系统调价金额，用于区分COD卖家调价金额和用于凑整的COD优惠金额
		$this->_arr_value['payScore'] = $bs->popUint32_t();	//<uint32_t> 积分支付值
		$this->_arr_value['obtainScore'] = $bs->popUint32_t();	//<uint32_t> 获得积分值
		$this->_arr_value['dealGenTime'] = $bs->popUint32_t();	//<uint32_t> 订单生成时间
		$this->_arr_value['sendFromDesc'] = $bs->popString();	//<std::string> 订单发货地描述
		$this->_arr_value['dealSeq'] = $bs->popUint64_t();	//<uint64_t> 下单时间戳
		$this->_arr_value['dealMd5'] = $bs->popUint64_t();	//<uint64_t> 下单md5
		$this->_arr_value['dealIp'] = $bs->popString();	//<std::string> 下单IP
		$this->_arr_value['dealRefer'] = $bs->popString();	//<std::string> refer
		$this->_arr_value['dealVisitKey'] = $bs->popString();	//<std::string> visitkey
		$this->_arr_value['promotionDesc'] = $bs->popString();	//<std::string> 订单促销信息描述
		$this->_arr_value['recvName'] = $bs->popString();	//<std::string> 收货人
		$this->_arr_value['recvRegionCode'] = $bs->popUint32_t();	//<uint32_t> 地区编码
		$this->_arr_value['recvAddress'] = $bs->popString();	//<std::string> 地址
		$this->_arr_value['recvPostCode'] = $bs->popString();	//<std::string> 邮编
		$this->_arr_value['recvPhone'] = $bs->popString();	//<std::string> 电话
		$this->_arr_value['recvMobile'] = $bs->popUint64_t();	//<uint64_t> 手机
		$this->_arr_value['expectRecvTime'] = $bs->popUint32_t();	//<uint32_t> 期望收货时间,天
		$this->_arr_value['expectRecvTimeSpan'] = $bs->popString();	//<std::string> 期望收货时段
		$this->_arr_value['recvRemark'] = $bs->popString();	//<std::string> 收货附言
		$this->_arr_value['recvMask'] = $bs->popUint32_t();	//<uint32_t> 收货属性值
		$this->_arr_value['expressType'] = $bs->popUint8_t();	//<uint8_t> 配送方式；1：平邮；2：快递；3：EMS；4：B2C自建物流；5：用户配送点自提
		$this->_arr_value['expressCompanyID'] = $bs->popString();	//<std::string> 物流公司ID
		$this->_arr_value['expressCompanyName'] = $bs->popString();	//<std::string> 物流公司名称
		$this->_arr_value['invoiceType'] = $bs->popUint8_t();	//<uint8_t> 发票类型
		$this->_arr_value['invoiceHead'] = $bs->popString();	//<std::string> 发票抬头
		$this->_arr_value['invoiceContent'] = $bs->popString();	//<std::string> 发票内容
		$this->_arr_value['cftDealId'] = $bs->popString();	//<std::string> Cft支付单号
		$this->_arr_value['lastUpdateTime'] = $bs->popUint32_t();	//<uint32_t> 最后更新时间
		$this->_arr_value['tradeInfoList'] = $bs->popObject('\ecc\deal\po\OrderTradePoList');	//<ecc::deal::po::COrderTradePoList> 商品子单列表
		$this->_arr_value['payInfoList'] = $bs->popObject('\ecc\deal\po\OrderPayInfoPoList');	//<ecc::deal::po::COrderPayInfoPoList> 支付信息表
		$this->_arr_value['actionLogInfoList'] = $bs->popObject('\ecc\deal\po\DealActionLogPoList');	//<ecc::deal::po::CDealActionLogPoList> 流水日志表
		$this->_arr_value['dealExtInfoMap'] = $bs->popObject('stl_multimap<uint32_t,stl_string>');	//<std::multimap<uint32_t,std::string> > 订单扩展信息 
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId64_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['businessDealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerAccount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerNickName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerNick_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerTitle_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerNick_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['businessId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealSource_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealPayType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealProperty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealProperty1_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealProperty2_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealProperty3_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealProperty4_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemSkuidList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemTitleList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealTotalFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealAdjustFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealPayment_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealDownPayment_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealDiscountTotal_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealItemTotalFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealWhoPayShippingFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealShippingFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealWhoPayCodFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealCodFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealWhoPayInsuranceFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealInsuranceFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealSysAdjustFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payScore_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['obtainScore_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealGenTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sendFromDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealSeq_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealMd5_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealIp_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealRefer_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealVisitKey_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['promotionDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvRegionCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvAddress_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvPostCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvPhone_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvMobile_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['expectRecvTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['expectRecvTimeSpan_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvRemark_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvMask_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['expressType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['expressCompanyID_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['expressCompanyName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['invoiceType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['invoiceHead_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['invoiceContent_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cftDealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['lastUpdateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['actionLogInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealExtInfoMap_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['bdealCode'] = $bs->popString();	//<std::string> 交易单编号，即字符串格式的交易单号，可为空
		}
		if($this->version >= 1){
			$this->_arr_value['businessBdealId'] = $bs->popString();	//<std::string> 业务交易单号，可为空
		}
		if($this->version >= 1){
			$this->_arr_value['siteId'] = $bs->popUint32_t();	//<uint32_t> 分站ID
		}
		if($this->version >= 1){
			$this->_arr_value['dealCouponFee'] = $bs->popInt32_t();	//<int> 优惠券金额
		}
		if($this->version >= 1){
			$this->_arr_value['cashScore'] = $bs->popUint32_t();	//<uint32_t> 现金积分支付值
		}
		if($this->version >= 1){
			$this->_arr_value['promotionScore'] = $bs->popUint32_t();	//<uint32_t> 促销积分支付值
		}
		if($this->version >= 1){
			$this->_arr_value['recvRegionCodeExt'] = $bs->popString();	//<std::string> 扩展地区编码
		}
		if($this->version >= 1){
			$this->_arr_value['dealDigest'] = $bs->popString();	//<std::string> 订单摘要
		}
		if($this->version >= 1){
			$this->_arr_value['payInstallmentBank'] = $bs->popString();	//<std::string> 分期付款银行
		}
		if($this->version >= 1){
			$this->_arr_value['payInstallmentNum'] = $bs->popUint16_t();	//<uint16_t> 分期付款期数
		}
		if($this->version >= 1){
			$this->_arr_value['payInstallmentPayment'] = $bs->popUint32_t();	//<uint32_t> 分期付款每期金额
		}
		if($this->version >= 1){
			$this->_arr_value['icsonShippingType'] = $bs->popString();	//<std::string> 易迅配送方式
		}
		if($this->version >= 1){
			$this->_arr_value['icsonPayType'] = $bs->popString();	//<std::string> 易迅支付方式
		}
		if($this->version >= 1){
			$this->_arr_value['icsonAccount'] = $bs->popString();	//<std::string> 易迅内部帐号ID
		}
		if($this->version >= 1){
			$this->_arr_value['icsonMasterLs'] = $bs->popString();	//<std::string> 易迅跟踪信息
		}
		if($this->version >= 1){
			$this->_arr_value['icsonRate'] = $bs->popString();	//<std::string> 易迅平衡比率
		}
		if($this->version >= 1){
			$this->_arr_value['icsonBankRate'] = $bs->popString();	//<std::string> 易迅银行利率
		}
		if($this->version >= 1){
			$this->_arr_value['icsonShopId'] = $bs->popString();	//<std::string> 易迅店铺id
		}
		if($this->version >= 1){
			$this->_arr_value['icsonShopGuideId'] = $bs->popString();	//<std::string> 易迅店铺导购id
		}
		if($this->version >= 1){
			$this->_arr_value['icsonShopGuideCost'] = $bs->popString();	//<std::string> 易迅店铺导购费用
		}
		if($this->version >= 1){
			$this->_arr_value['icsonShopGuideName'] = $bs->popString();	//<std::string> 易迅店铺导购名称
		}
		if($this->version >= 1){
			$this->_arr_value['icsonSubsidyType'] = $bs->popString();	//<std::string> 易迅节能补贴类型
		}
		if($this->version >= 1){
			$this->_arr_value['icsonSubsidyName'] = $bs->popString();	//<std::string> 易迅节能补贴姓名
		}
		if($this->version >= 1){
			$this->_arr_value['icsonSubsidyIdCard'] = $bs->popString();	//<std::string> 易迅节能补贴身份证
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSOrderOperatorId'] = $bs->popString();	//<std::string> 易迅客服下单操作员ID
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSOrderOperatorName'] = $bs->popString();	//<std::string> 易迅客服下单操作员名称
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceCompanyName'] = $bs->popString();	//<std::string> 易迅发票公司名称
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceCompanyAddr'] = $bs->popString();	//<std::string> 易迅发票公司地址
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceCompanyPhone'] = $bs->popString();	//<std::string> 易迅发票公司电话
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceCompanyTaxNo'] = $bs->popString();	//<std::string> 易迅发票公司税号
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceCompanyBankNo'] = $bs->popString();	//<std::string> 易迅发票公司银行账户
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceCompanyBankName'] = $bs->popString();	//<std::string> 易迅发票公司银行名称
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceRecvName'] = $bs->popString();	//<std::string> 易迅发票收货人
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceRecvAddr'] = $bs->popString();	//<std::string> 易迅发票收货地址
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceRecvRegionId'] = $bs->popString();	//<std::string> 易迅发票收货地址ID
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceRecvMobile'] = $bs->popString();	//<std::string> 易迅发票收货手机
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceRecvTel'] = $bs->popString();	//<std::string> 易迅发票收货电话
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceRecvZip'] = $bs->popString();	//<std::string> 易迅发票收货邮编
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceShipType'] = $bs->popString();	//<std::string> 易迅发票配送方式
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceShipFee'] = $bs->popString();	//<std::string> 易迅发票配送费用
		}
		if($this->version >= 1){
			$this->_arr_value['icsonDealFlag'] = $bs->popString();	//<std::string> 易迅订单flag
		}
		if($this->version >= 1){
			$this->_arr_value['icsonStockNo'] = $bs->popString();	//<std::string> 易迅订单物流仓库编号
		}
		if($this->version >= 1){
			$this->_arr_value['bdealCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['businessBdealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['siteId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['dealCouponFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['cashScore_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['promotionScore_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['recvRegionCodeExt_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['dealDigest_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['payInstallmentBank_u'] = $bs->popUint8_t();	//<uint8_t> 分期付款银行UFlag
		}
		if($this->version >= 1){
			$this->_arr_value['payInstallmentNum_u'] = $bs->popUint8_t();	//<uint8_t> 分期付款期数UFlag
		}
		if($this->version >= 1){
			$this->_arr_value['payInstallmentPayment_u'] = $bs->popUint8_t();	//<uint8_t> 分期付款每期金额UFlag
		}
		if($this->version >= 1){
			$this->_arr_value['icsonShippingType_u'] = $bs->popUint8_t();	//<uint8_t> 易迅配送方式UFlag
		}
		if($this->version >= 1){
			$this->_arr_value['icsonPayType_u'] = $bs->popUint8_t();	//<uint8_t> 易迅支付方式UFlag
		}
		if($this->version >= 1){
			$this->_arr_value['icsonAccount_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonMasterLs_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonRate_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonBankRate_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonShopId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonShopGuideId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonShopGuideCost_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonShopGuideName_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonSubsidyType_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonSubsidyName_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonSubsidyIdCard_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSOrderOperatorId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSOrderOperatorName_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceCompanyName_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceCompanyAddr_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceCompanyPhone_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceCompanyTaxNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceCompanyBankNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceCompanyBankName_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceRecvName_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceRecvAddr_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceRecvRegionId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceRecvMobile_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceRecvTel_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceRecvZip_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceShipType_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceShipFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonDealFlag_u'] = $bs->popUint8_t();	//<uint8_t> 易迅订单flag
		}
		if($this->version >= 1){
			$this->_arr_value['icsonStockNo_u'] = $bs->popUint8_t();	//<uint8_t> 易迅订单物流仓库编号
		}
		if($this->version >= 2){
			$this->_arr_value['payChannel'] = $bs->popUint8_t();	//<uint8_t> 支付渠道
		}
		if($this->version >= 2){
			$this->_arr_value['payServiceFee'] = $bs->popUint32_t();	//<uint32_t> 支付手续费
		}
		if($this->version >= 2){
			$this->_arr_value['icsonDealCashBack'] = $bs->popUint32_t();	//<uint32_t> 订单返现金额
		}
		if($this->version >= 2){
			$this->_arr_value['payChannel_u'] = $bs->popUint8_t();	//<uint8_t> 支付渠道UFlag
		}
		if($this->version >= 2){
			$this->_arr_value['payServiceFee_u'] = $bs->popUint8_t();	//<uint8_t> 支付手续费UFlag
		}
		if($this->version >= 2){
			$this->_arr_value['icsonDealCashBack_u'] = $bs->popUint8_t();	//<uint8_t> 订单返现金额UFlag
		}
		if($this->version >= 3){
			$this->_arr_value['payInstallmentFee'] = $bs->popUint32_t();	//<uint32_t> 分期付款手续费
		}
		if($this->version >= 3){
			$this->_arr_value['payInstallmentFee_u'] = $bs->popUint8_t();	//<uint8_t> 分期付款手续费UFlag
		}
		if($this->version >= 4){
			$this->_arr_value['icsonDealCode'] = $bs->popString();	//<std::string> 易迅订单号，带10开头
		}
		if($this->version >= 4){
			$this->_arr_value['icsonDealCode_u'] = $bs->popUint8_t();	//<uint8_t> 订单返现金额UFlag
		}
		if($this->version >= 5){
			$this->_arr_value['icsonInvoiceStockNo'] = $bs->popString();	//<std::string> 易迅货票分离仓库id
		}
		if($this->version >= 5){
			$this->_arr_value['icsonInvoiceSiteId'] = $bs->popString();	//<std::string> 易迅货票分离分站id
		}
		if($this->version >= 5){
			$this->_arr_value['icsonInvoiceStockNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 5){
			$this->_arr_value['icsonInvoiceSiteId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 6){
			$this->_arr_value['sellerCorpId'] = $bs->popUint64_t();	//<uint64_t> 易迅联营商家id
		}
		if($this->version >= 6){
			$this->_arr_value['lmsVolume'] = $bs->popString();	//<std::string> 体积
		}
		if($this->version >= 6){
			$this->_arr_value['lmsWeight'] = $bs->popString();	//<std::string> 重量
		}
		if($this->version >= 6){
			$this->_arr_value['lmsLongest'] = $bs->popString();	//<std::string> 最长边
		}
		if($this->version >= 6){
			$this->_arr_value['sellerCorpId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 6){
			$this->_arr_value['lmsVolume_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 6){
			$this->_arr_value['lmsWeight_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 6){
			$this->_arr_value['lmsLongest_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 7){
			$this->_arr_value['dealActiveInfoList'] = $bs->popObject('\ecc\deal\po\TradeActivePoList');	//<ecc::deal::po::CTradeActivePoList> 订单活动列表
		}
		if($this->version >= 7){
			$this->_arr_value['dealActiveInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.OrderPo.java
class OrderTradePoList{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $tradeInfoList;	//<std::vector<ecc::deal::po::COrderTradePo> > 商品单列表(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $tradeInfoList_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->tradeInfoList = new \stl_vector2('\ecc\deal\po\OrderTradePo');	//<std::vector<ecc::deal::po::COrderTradePo> >
		$this->version_u = 0;	//<uint8_t>
		$this->tradeInfoList_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\po\OrderTradePoList\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\OrderTradePoList\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushObject($this->tradeInfoList,'stl_vector');	//<std::vector<ecc::deal::po::COrderTradePo> > 商品单列表
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeInfoList_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['tradeInfoList'] = $bs->popObject('stl_vector<\ecc\deal\po\OrderTradePo>');	//<std::vector<ecc::deal::po::COrderTradePo> > 商品单列表
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.OrderTradePoList.java
class OrderTradePo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $dealId;	//<std::string> 订单编号，可为空(版本>=0)
	private $dealId64;	//<uint64_t> 订单单号，拍拍订单同步可使用，可为空(版本>=0)
	private $bdealId;	//<uint64_t> 交易单号，可为空(版本>=0)
	private $tradeId;	//<uint64_t> 商品订单号，拍拍订单同步可使用，可为空(版本>=0)
	private $buyerId;	//<uint64_t> 买家ID(版本>=0)
	private $buyerNickName;	//<std::string> 买家昵称(版本>=0)
	private $sellerId;	//<uint64_t> 商家ID(版本>=0)
	private $sellerTitle;	//<std::string> 商家名称(版本>=0)
	private $businessId;	//<uint32_t> 业务ID(版本>=0)
	private $tradeType;	//<uint8_t> 订单类型(版本>=0)
	private $tradeSource;	//<uint32_t> 下单渠道：1：业务主站；2：移动app；3：移动wap(版本>=0)
	private $tradePayType;	//<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款(版本>=0)
	private $shippingfeeTemplateId;	//<std::string> 运费模版ID(版本>=0)
	private $shippingfeeDesc;	//<std::string> 运费描述(版本>=0)
	private $itemShippingfee;	//<uint32_t> 商品运费,不参与金额计算，只做展示，商品系统传入(版本>=0)
	private $itemType;	//<uint32_t> 商品类型；1：普通商品；2：套餐主商品；3：套餐副商品；4：赠品主商品；5：赠品副商品; 6: 组件(版本>=0)
	private $itemClassId;	//<uint32_t> 品类（类目）ID(版本>=0)
	private $itemTitle;	//<std::string> 商品标题(版本>=0)
	private $itemAttrCode;	//<std::string> 商品销售属性编码(版本>=0)
	private $itemAttr;	//<std::string> 商品销售属性描述(版本>=0)
	private $itemId;	//<std::string> 商品ID，由业务定义(版本>=0)
	private $itemSkuId;	//<uint64_t> 商品SKUID(版本>=0)
	private $itemLocalCode;	//<std::string> 商品商家本地编码(版本>=0)
	private $itemLocalStockCode;	//<std::string> 商品商家本地库存编码(版本>=0)
	private $itemBarCode;	//<std::string> 商品条形码(版本>=0)
	private $itemSpuId;	//<uint64_t> 商品SPUID(版本>=0)
	private $itemStockId;	//<uint64_t> 商品库存ID(版本>=0)
	private $itemStoreHouseId;	//<uint32_t> 商品仓库ID(版本>=0)
	private $itemPhyisicalStorage;	//<std::string> 商品所属物理仓(版本>=0)
	private $itemLogo;	//<std::string> 商品图片Logo(版本>=0)
	private $itemSnapVersion;	//<uint32_t> 商品快照版本号(版本>=0)
	private $itemResetTime;	//<uint32_t> 商品重置时间戳(版本>=0)
	private $itemWeight;	//<uint32_t> 商品重量(版本>=0)
	private $itemVolume;	//<uint32_t> 商品体积(版本>=0)
	private $mainItemId;	//<uint64_t> 商品套餐主商品ID(版本>=0)
	private $itemAccessoryDesc;	//<std::string> 商品标配说明(版本>=0)
	private $itemCostPrice;	//<uint32_t> 商品成本价(版本>=0)
	private $itemOriginPrice;	//<uint32_t> 商品市场价(版本>=0)
	private $itemSoldPrice;	//<uint32_t> 商品销售单价(版本>=0)
	private $itemB2CMarket;	//<std::string> 自营B2C市场(版本>=0)
	private $itemB2CPM;	//<std::string> 自营B2CPM(版本>=0)
	private $itemUseVirtualStock;	//<uint8_t> 自营B2C是否占用虚库(版本>=0)
	private $buyPrice;	//<uint32_t> 商品成交价(版本>=0)
	private $buyNum;	//<uint32_t> 商品成交件数(版本>=0)
	private $tradeTotalFee;	//<uint32_t> 商品单总金额,下单金额(版本>=0)
	private $tradeAdjustFee;	//<int> 商品单调价金额(版本>=0)
	private $tradePayment;	//<uint32_t> 实付总金额(版本>=0)
	private $tradeDiscountTotal;	//<int> 优惠总金额(版本>=0)
	private $tradePaipaiHongbaoUsed;	//<uint32_t> Paipai红包使用金额(版本>=0)
	private $payScore;	//<uint32_t> 积分支付值(版本>=0)
	private $tradeGenTime;	//<uint32_t> 商品单生成时间(版本>=0)
	private $tradeOpSerialNo;	//<uint16_t> 商品单库存操作序列号(版本>=0)
	private $obtainScore;	//<uint32_t> 获得积分值(版本>=0)
	private $tradeState;	//<uint32_t> 商品单状态(版本>=0)
	private $tradeProperty;	//<uint32_t> 商品单属性值(版本>=0)
	private $tradeProperty1;	//<uint32_t> 商品单属性值1(版本>=0)
	private $tradeProperty2;	//<uint32_t> 商品单属性值2(版本>=0)
	private $tradeProperty3;	//<uint32_t> 商品单属性值3(版本>=0)
	private $tradeProperty4;	//<uint32_t> 商品单属性值4(版本>=0)
	private $itemTimeoutFlag;	//<uint32_t> 商品超时标识(版本>=0)
	private $lastUpdateTime;	//<uint32_t> 最后更新时间(版本>=0)
	private $activeInfoList;	//<ecc::deal::po::CTradeActivePoList> 商品活动列表(版本>=0)
	private $dealExtInfoMap;	//<std::multimap<uint32_t,std::string> > 订单扩展信息 (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $dealId_u;	//<uint8_t> (版本>=0)
	private $dealId64_u;	//<uint8_t> (版本>=0)
	private $bdealId_u;	//<uint8_t> (版本>=0)
	private $tradeId_u;	//<uint8_t> (版本>=0)
	private $buyerId_u;	//<uint8_t> (版本>=0)
	private $buyerNickName_u;	//<uint8_t> (版本>=0)
	private $sellerId_u;	//<uint8_t> (版本>=0)
	private $sellerTitle_u;	//<uint8_t> (版本>=0)
	private $businessId_u;	//<uint8_t> (版本>=0)
	private $tradeType_u;	//<uint8_t> (版本>=0)
	private $tradeSource_u;	//<uint8_t> (版本>=0)
	private $tradePayType_u;	//<uint8_t> (版本>=0)
	private $shippingfeeTemplateId_u;	//<uint8_t> (版本>=0)
	private $shippingfeeDesc_u;	//<uint8_t> (版本>=0)
	private $itemShippingfee_u;	//<uint8_t> (版本>=0)
	private $itemType_u;	//<uint8_t> (版本>=0)
	private $itemClassId_u;	//<uint8_t> (版本>=0)
	private $itemTitle_u;	//<uint8_t> (版本>=0)
	private $itemAttrCode_u;	//<uint8_t> (版本>=0)
	private $itemAttr_u;	//<uint8_t> (版本>=0)
	private $itemId_u;	//<uint8_t> (版本>=0)
	private $itemSkuId_u;	//<uint8_t> (版本>=0)
	private $itemLocalCode_u;	//<uint8_t> (版本>=0)
	private $itemLocalStockCode_u;	//<uint8_t> (版本>=0)
	private $itemBarCode_u;	//<uint8_t> (版本>=0)
	private $itemSpuId_u;	//<uint8_t> (版本>=0)
	private $itemStockId_u;	//<uint8_t> (版本>=0)
	private $itemStoreHouseId_u;	//<uint8_t> (版本>=0)
	private $itemPhyisicalStorage_u;	//<uint8_t> (版本>=0)
	private $itemLogo_u;	//<uint8_t> (版本>=0)
	private $itemSnapVersion_u;	//<uint8_t> (版本>=0)
	private $itemResetTime_u;	//<uint8_t> (版本>=0)
	private $itemWeight_u;	//<uint8_t> (版本>=0)
	private $itemVolume_u;	//<uint8_t> (版本>=0)
	private $mainItemId_u;	//<uint8_t> (版本>=0)
	private $itemAccessoryDesc_u;	//<uint8_t> (版本>=0)
	private $itemCostPrice_u;	//<uint8_t> (版本>=0)
	private $itemOriginPrice_u;	//<uint8_t> (版本>=0)
	private $itemSoldPrice_u;	//<uint8_t> (版本>=0)
	private $itemB2CMarket_u;	//<uint8_t> (版本>=0)
	private $itemB2CPM_u;	//<uint8_t> (版本>=0)
	private $itemUseVirtualStock_u;	//<uint8_t> (版本>=0)
	private $buyPrice_u;	//<uint8_t> (版本>=0)
	private $buyNum_u;	//<uint8_t> (版本>=0)
	private $tradeTotalFee_u;	//<uint8_t> (版本>=0)
	private $tradeAdjustFee_u;	//<uint8_t> (版本>=0)
	private $tradePayment_u;	//<uint8_t> (版本>=0)
	private $tradeDiscountTotal_u;	//<uint8_t> (版本>=0)
	private $tradePaipaiHongbaoUsed_u;	//<uint8_t> (版本>=0)
	private $payScore_u;	//<uint8_t> (版本>=0)
	private $tradeGenTime_u;	//<uint8_t> (版本>=0)
	private $tradeOpSerialNo_u;	//<uint8_t> (版本>=0)
	private $obtainScore_u;	//<uint8_t> (版本>=0)
	private $tradeState_u;	//<uint8_t> (版本>=0)
	private $tradeProperty_u;	//<uint8_t> (版本>=0)
	private $tradeProperty1_u;	//<uint8_t> (版本>=0)
	private $tradeProperty2_u;	//<uint8_t> (版本>=0)
	private $tradeProperty3_u;	//<uint8_t> (版本>=0)
	private $tradeProperty4_u;	//<uint8_t> (版本>=0)
	private $itemTimeoutFlag_u;	//<uint8_t> (版本>=0)
	private $lastUpdateTime_u;	//<uint8_t> (版本>=0)
	private $activeInfoList_u;	//<uint8_t> (版本>=0)
	private $dealExtInfoMap_u;	//<uint8_t> (版本>=0)
	private $warranty;	//<std::string> 保修条款(版本>=1)
	private $productId;	//<uint64_t> 产品id(版本>=1)
	private $productCode;	//<std::string> 产品id编码(版本>=1)
	private $icsonEdmCode;	//<std::string> 易迅edm编码(版本>=1)
	private $icsonOTag;	//<std::string> 易迅OTag(版本>=1)
	private $icsonTradeShopGuideCost;	//<std::string> 易迅店铺导购费用(版本>=1)
	private $icsonCSPhoneType;	//<std::string> 易迅定制机类型(版本>=1)
	private $icsonCSPhoneOperator;	//<std::string> 易迅定制机运营商(版本>=1)
	private $icsonCSPhoneNumber;	//<std::string> 易迅定制机号码(版本>=1)
	private $icsonCSPhoneArea;	//<std::string> 易迅定制机归属地(版本>=1)
	private $icsonCSPhonePackageId;	//<std::string> 易迅定制机套餐id(版本>=1)
	private $icsonCSPhoneUserName;	//<std::string> 易迅定制机用户姓名(版本>=1)
	private $icsonCSPhoneUserAddr;	//<std::string> 易迅定制机用户地址(版本>=1)
	private $icsonCSPhoneUserMobile;	//<std::string> 易迅定制机用户联系手机(版本>=1)
	private $icsonCSPhoneUserTel;	//<std::string> 易迅定制机用户联系电话(版本>=1)
	private $icsonCSPhoneIdCardNo;	//<std::string> 易迅定制机身份证号码(版本>=1)
	private $icsonCSPhoneIdCardAddr;	//<std::string> 易迅定制机身份证地址(版本>=1)
	private $icsonCSPhoneIdCardDate;	//<std::string> 易迅定制机身份证有效期(版本>=1)
	private $icsonCSPhoneZipCode;	//<std::string> 易迅定制机邮政编码(版本>=1)
	private $icsonCSPhoneCardPrice;	//<std::string> 易迅定制机卡价格(版本>=1)
	private $icsonCSPhonePackagePrice;	//<std::string> 易迅定制机套餐价格(版本>=1)
	private $icsonTradeFlag;	//<std::string> 易迅商品子单flag(版本>=1)
	private $icsonPointType;	//<std::string> 易迅积分兑换类型(版本>=1)
	private $icsonPackageIds;	//<std::string> 易迅商品子单套餐id(版本>=1)
	private $warranty_u;	//<uint8_t> (版本>=1)
	private $productId_u;	//<uint8_t> (版本>=1)
	private $productCode_u;	//<uint8_t> (版本>=1)
	private $icsonEdmCode_u;	//<uint8_t> (版本>=1)
	private $icsonOTag_u;	//<uint8_t> (版本>=1)
	private $icsonTradeShopGuideCost_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneType_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneOperator_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneNumber_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneArea_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhonePackageId_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneUserName_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneUserAddr_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneUserMobile_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneUserTel_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneIdCardNo_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneIdCardAddr_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneIdCardDate_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneZipCode_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneCardPrice_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhonePackagePrice_u;	//<uint8_t> (版本>=1)
	private $icsonTradeFlag_u;	//<uint8_t> 易迅商品子单flag(版本>=1)
	private $icsonPointType_u;	//<uint8_t> 易迅积分兑换类型(版本>=1)
	private $icsonPackageIds_u;	//<uint8_t> 易迅商品子单套餐id(版本>=1)
	private $icsonTradeCashBack;	//<uint32_t> 子单返现金额(版本>=2)
	private $icsonTradeCashBack_u;	//<uint8_t> 子单返现金额UFlag(版本>=2)
	private $icsonUnitCostInvoice;	//<std::string> 去税后成本(版本>=3)
	private $icsonUnitCostInvoice_u;	//<uint8_t> 去税后成本UFlag(版本>=3)

	function __construct(){
		$this->version = 3;	//<uint16_t>
		$this->dealId = "";	//<std::string>
		$this->dealId64 = 0;	//<uint64_t>
		$this->bdealId = 0;	//<uint64_t>
		$this->tradeId = 0;	//<uint64_t>
		$this->buyerId = 0;	//<uint64_t>
		$this->buyerNickName = "";	//<std::string>
		$this->sellerId = 0;	//<uint64_t>
		$this->sellerTitle = "";	//<std::string>
		$this->businessId = 0;	//<uint32_t>
		$this->tradeType = 0;	//<uint8_t>
		$this->tradeSource = 0;	//<uint32_t>
		$this->tradePayType = 0;	//<uint8_t>
		$this->shippingfeeTemplateId = "";	//<std::string>
		$this->shippingfeeDesc = "";	//<std::string>
		$this->itemShippingfee = 0;	//<uint32_t>
		$this->itemType = 0;	//<uint32_t>
		$this->itemClassId = 0;	//<uint32_t>
		$this->itemTitle = "";	//<std::string>
		$this->itemAttrCode = "";	//<std::string>
		$this->itemAttr = "";	//<std::string>
		$this->itemId = "";	//<std::string>
		$this->itemSkuId = 0;	//<uint64_t>
		$this->itemLocalCode = "";	//<std::string>
		$this->itemLocalStockCode = "";	//<std::string>
		$this->itemBarCode = "";	//<std::string>
		$this->itemSpuId = 0;	//<uint64_t>
		$this->itemStockId = 0;	//<uint64_t>
		$this->itemStoreHouseId = 0;	//<uint32_t>
		$this->itemPhyisicalStorage = "";	//<std::string>
		$this->itemLogo = "";	//<std::string>
		$this->itemSnapVersion = 0;	//<uint32_t>
		$this->itemResetTime = 0;	//<uint32_t>
		$this->itemWeight = 0;	//<uint32_t>
		$this->itemVolume = 0;	//<uint32_t>
		$this->mainItemId = 0;	//<uint64_t>
		$this->itemAccessoryDesc = "";	//<std::string>
		$this->itemCostPrice = 0;	//<uint32_t>
		$this->itemOriginPrice = 0;	//<uint32_t>
		$this->itemSoldPrice = 0;	//<uint32_t>
		$this->itemB2CMarket = "";	//<std::string>
		$this->itemB2CPM = "";	//<std::string>
		$this->itemUseVirtualStock = 0;	//<uint8_t>
		$this->buyPrice = 0;	//<uint32_t>
		$this->buyNum = 0;	//<uint32_t>
		$this->tradeTotalFee = 0;	//<uint32_t>
		$this->tradeAdjustFee = 0;	//<int>
		$this->tradePayment = 0;	//<uint32_t>
		$this->tradeDiscountTotal = 0;	//<int>
		$this->tradePaipaiHongbaoUsed = 0;	//<uint32_t>
		$this->payScore = 0;	//<uint32_t>
		$this->tradeGenTime = 0;	//<uint32_t>
		$this->tradeOpSerialNo = 0;	//<uint16_t>
		$this->obtainScore = 0;	//<uint32_t>
		$this->tradeState = 0;	//<uint32_t>
		$this->tradeProperty = 0;	//<uint32_t>
		$this->tradeProperty1 = 0;	//<uint32_t>
		$this->tradeProperty2 = 0;	//<uint32_t>
		$this->tradeProperty3 = 0;	//<uint32_t>
		$this->tradeProperty4 = 0;	//<uint32_t>
		$this->itemTimeoutFlag = 0;	//<uint32_t>
		$this->lastUpdateTime = 0;	//<uint32_t>
		$this->activeInfoList = new \ecc\deal\po\TradeActivePoList();	//<ecc::deal::po::CTradeActivePoList>
		$this->dealExtInfoMap = new \stl_multimap2('uint32_t,stl_string');	//<std::multimap<uint32_t,std::string> >
		$this->version_u = 0;	//<uint8_t>
		$this->dealId_u = 0;	//<uint8_t>
		$this->dealId64_u = 0;	//<uint8_t>
		$this->bdealId_u = 0;	//<uint8_t>
		$this->tradeId_u = 0;	//<uint8_t>
		$this->buyerId_u = 0;	//<uint8_t>
		$this->buyerNickName_u = 0;	//<uint8_t>
		$this->sellerId_u = 0;	//<uint8_t>
		$this->sellerTitle_u = 0;	//<uint8_t>
		$this->businessId_u = 0;	//<uint8_t>
		$this->tradeType_u = 0;	//<uint8_t>
		$this->tradeSource_u = 0;	//<uint8_t>
		$this->tradePayType_u = 0;	//<uint8_t>
		$this->shippingfeeTemplateId_u = 0;	//<uint8_t>
		$this->shippingfeeDesc_u = 0;	//<uint8_t>
		$this->itemShippingfee_u = 0;	//<uint8_t>
		$this->itemType_u = 0;	//<uint8_t>
		$this->itemClassId_u = 0;	//<uint8_t>
		$this->itemTitle_u = 0;	//<uint8_t>
		$this->itemAttrCode_u = 0;	//<uint8_t>
		$this->itemAttr_u = 0;	//<uint8_t>
		$this->itemId_u = 0;	//<uint8_t>
		$this->itemSkuId_u = 0;	//<uint8_t>
		$this->itemLocalCode_u = 0;	//<uint8_t>
		$this->itemLocalStockCode_u = 0;	//<uint8_t>
		$this->itemBarCode_u = 0;	//<uint8_t>
		$this->itemSpuId_u = 0;	//<uint8_t>
		$this->itemStockId_u = 0;	//<uint8_t>
		$this->itemStoreHouseId_u = 0;	//<uint8_t>
		$this->itemPhyisicalStorage_u = 0;	//<uint8_t>
		$this->itemLogo_u = 0;	//<uint8_t>
		$this->itemSnapVersion_u = 0;	//<uint8_t>
		$this->itemResetTime_u = 0;	//<uint8_t>
		$this->itemWeight_u = 0;	//<uint8_t>
		$this->itemVolume_u = 0;	//<uint8_t>
		$this->mainItemId_u = 0;	//<uint8_t>
		$this->itemAccessoryDesc_u = 0;	//<uint8_t>
		$this->itemCostPrice_u = 0;	//<uint8_t>
		$this->itemOriginPrice_u = 0;	//<uint8_t>
		$this->itemSoldPrice_u = 0;	//<uint8_t>
		$this->itemB2CMarket_u = 0;	//<uint8_t>
		$this->itemB2CPM_u = 0;	//<uint8_t>
		$this->itemUseVirtualStock_u = 0;	//<uint8_t>
		$this->buyPrice_u = 0;	//<uint8_t>
		$this->buyNum_u = 0;	//<uint8_t>
		$this->tradeTotalFee_u = 0;	//<uint8_t>
		$this->tradeAdjustFee_u = 0;	//<uint8_t>
		$this->tradePayment_u = 0;	//<uint8_t>
		$this->tradeDiscountTotal_u = 0;	//<uint8_t>
		$this->tradePaipaiHongbaoUsed_u = 0;	//<uint8_t>
		$this->payScore_u = 0;	//<uint8_t>
		$this->tradeGenTime_u = 0;	//<uint8_t>
		$this->tradeOpSerialNo_u = 0;	//<uint8_t>
		$this->obtainScore_u = 0;	//<uint8_t>
		$this->tradeState_u = 0;	//<uint8_t>
		$this->tradeProperty_u = 0;	//<uint8_t>
		$this->tradeProperty1_u = 0;	//<uint8_t>
		$this->tradeProperty2_u = 0;	//<uint8_t>
		$this->tradeProperty3_u = 0;	//<uint8_t>
		$this->tradeProperty4_u = 0;	//<uint8_t>
		$this->itemTimeoutFlag_u = 0;	//<uint8_t>
		$this->lastUpdateTime_u = 0;	//<uint8_t>
		$this->activeInfoList_u = 0;	//<uint8_t>
		$this->dealExtInfoMap_u = 0;	//<uint8_t>
		$this->warranty = "";	//<std::string>
		$this->productId = 0;	//<uint64_t>
		$this->productCode = "";	//<std::string>
		$this->icsonEdmCode = "";	//<std::string>
		$this->icsonOTag = "";	//<std::string>
		$this->icsonTradeShopGuideCost = "";	//<std::string>
		$this->icsonCSPhoneType = "";	//<std::string>
		$this->icsonCSPhoneOperator = "";	//<std::string>
		$this->icsonCSPhoneNumber = "";	//<std::string>
		$this->icsonCSPhoneArea = "";	//<std::string>
		$this->icsonCSPhonePackageId = "";	//<std::string>
		$this->icsonCSPhoneUserName = "";	//<std::string>
		$this->icsonCSPhoneUserAddr = "";	//<std::string>
		$this->icsonCSPhoneUserMobile = "";	//<std::string>
		$this->icsonCSPhoneUserTel = "";	//<std::string>
		$this->icsonCSPhoneIdCardNo = "";	//<std::string>
		$this->icsonCSPhoneIdCardAddr = "";	//<std::string>
		$this->icsonCSPhoneIdCardDate = "";	//<std::string>
		$this->icsonCSPhoneZipCode = "";	//<std::string>
		$this->icsonCSPhoneCardPrice = "";	//<std::string>
		$this->icsonCSPhonePackagePrice = "";	//<std::string>
		$this->icsonTradeFlag = "";	//<std::string>
		$this->icsonPointType = "";	//<std::string>
		$this->icsonPackageIds = "";	//<std::string>
		$this->warranty_u = 0;	//<uint8_t>
		$this->productId_u = 0;	//<uint8_t>
		$this->productCode_u = 0;	//<uint8_t>
		$this->icsonEdmCode_u = 0;	//<uint8_t>
		$this->icsonOTag_u = 0;	//<uint8_t>
		$this->icsonTradeShopGuideCost_u = 0;	//<uint8_t>
		$this->icsonCSPhoneType_u = 0;	//<uint8_t>
		$this->icsonCSPhoneOperator_u = 0;	//<uint8_t>
		$this->icsonCSPhoneNumber_u = 0;	//<uint8_t>
		$this->icsonCSPhoneArea_u = 0;	//<uint8_t>
		$this->icsonCSPhonePackageId_u = 0;	//<uint8_t>
		$this->icsonCSPhoneUserName_u = 0;	//<uint8_t>
		$this->icsonCSPhoneUserAddr_u = 0;	//<uint8_t>
		$this->icsonCSPhoneUserMobile_u = 0;	//<uint8_t>
		$this->icsonCSPhoneUserTel_u = 0;	//<uint8_t>
		$this->icsonCSPhoneIdCardNo_u = 0;	//<uint8_t>
		$this->icsonCSPhoneIdCardAddr_u = 0;	//<uint8_t>
		$this->icsonCSPhoneIdCardDate_u = 0;	//<uint8_t>
		$this->icsonCSPhoneZipCode_u = 0;	//<uint8_t>
		$this->icsonCSPhoneCardPrice_u = 0;	//<uint8_t>
		$this->icsonCSPhonePackagePrice_u = 0;	//<uint8_t>
		$this->icsonTradeFlag_u = 0;	//<uint8_t>
		$this->icsonPointType_u = 0;	//<uint8_t>
		$this->icsonPackageIds_u = 0;	//<uint8_t>
		$this->icsonTradeCashBack = 0;	//<uint32_t>
		$this->icsonTradeCashBack_u = 0;	//<uint8_t>
		$this->icsonUnitCostInvoice = "";	//<std::string>
		$this->icsonUnitCostInvoice_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\po\OrderTradePo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\OrderTradePo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushString($this->dealId);	//<std::string> 订单编号，可为空
		$bs->pushUint64_t($this->dealId64);	//<uint64_t> 订单单号，拍拍订单同步可使用，可为空
		$bs->pushUint64_t($this->bdealId);	//<uint64_t> 交易单号，可为空
		$bs->pushUint64_t($this->tradeId);	//<uint64_t> 商品订单号，拍拍订单同步可使用，可为空
		$bs->pushUint64_t($this->buyerId);	//<uint64_t> 买家ID
		$bs->pushString($this->buyerNickName);	//<std::string> 买家昵称
		$bs->pushUint64_t($this->sellerId);	//<uint64_t> 商家ID
		$bs->pushString($this->sellerTitle);	//<std::string> 商家名称
		$bs->pushUint32_t($this->businessId);	//<uint32_t> 业务ID
		$bs->pushUint8_t($this->tradeType);	//<uint8_t> 订单类型
		$bs->pushUint32_t($this->tradeSource);	//<uint32_t> 下单渠道：1：业务主站；2：移动app；3：移动wap
		$bs->pushUint8_t($this->tradePayType);	//<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款
		$bs->pushString($this->shippingfeeTemplateId);	//<std::string> 运费模版ID
		$bs->pushString($this->shippingfeeDesc);	//<std::string> 运费描述
		$bs->pushUint32_t($this->itemShippingfee);	//<uint32_t> 商品运费,不参与金额计算，只做展示，商品系统传入
		$bs->pushUint32_t($this->itemType);	//<uint32_t> 商品类型；1：普通商品；2：套餐主商品；3：套餐副商品；4：赠品主商品；5：赠品副商品; 6: 组件
		$bs->pushUint32_t($this->itemClassId);	//<uint32_t> 品类（类目）ID
		$bs->pushString($this->itemTitle);	//<std::string> 商品标题
		$bs->pushString($this->itemAttrCode);	//<std::string> 商品销售属性编码
		$bs->pushString($this->itemAttr);	//<std::string> 商品销售属性描述
		$bs->pushString($this->itemId);	//<std::string> 商品ID，由业务定义
		$bs->pushUint64_t($this->itemSkuId);	//<uint64_t> 商品SKUID
		$bs->pushString($this->itemLocalCode);	//<std::string> 商品商家本地编码
		$bs->pushString($this->itemLocalStockCode);	//<std::string> 商品商家本地库存编码
		$bs->pushString($this->itemBarCode);	//<std::string> 商品条形码
		$bs->pushUint64_t($this->itemSpuId);	//<uint64_t> 商品SPUID
		$bs->pushUint64_t($this->itemStockId);	//<uint64_t> 商品库存ID
		$bs->pushUint32_t($this->itemStoreHouseId);	//<uint32_t> 商品仓库ID
		$bs->pushString($this->itemPhyisicalStorage);	//<std::string> 商品所属物理仓
		$bs->pushString($this->itemLogo);	//<std::string> 商品图片Logo
		$bs->pushUint32_t($this->itemSnapVersion);	//<uint32_t> 商品快照版本号
		$bs->pushUint32_t($this->itemResetTime);	//<uint32_t> 商品重置时间戳
		$bs->pushUint32_t($this->itemWeight);	//<uint32_t> 商品重量
		$bs->pushUint32_t($this->itemVolume);	//<uint32_t> 商品体积
		$bs->pushUint64_t($this->mainItemId);	//<uint64_t> 商品套餐主商品ID
		$bs->pushString($this->itemAccessoryDesc);	//<std::string> 商品标配说明
		$bs->pushUint32_t($this->itemCostPrice);	//<uint32_t> 商品成本价
		$bs->pushUint32_t($this->itemOriginPrice);	//<uint32_t> 商品市场价
		$bs->pushUint32_t($this->itemSoldPrice);	//<uint32_t> 商品销售单价
		$bs->pushString($this->itemB2CMarket);	//<std::string> 自营B2C市场
		$bs->pushString($this->itemB2CPM);	//<std::string> 自营B2CPM
		$bs->pushUint8_t($this->itemUseVirtualStock);	//<uint8_t> 自营B2C是否占用虚库
		$bs->pushUint32_t($this->buyPrice);	//<uint32_t> 商品成交价
		$bs->pushUint32_t($this->buyNum);	//<uint32_t> 商品成交件数
		$bs->pushUint32_t($this->tradeTotalFee);	//<uint32_t> 商品单总金额,下单金额
		$bs->pushInt32_t($this->tradeAdjustFee);	//<int> 商品单调价金额
		$bs->pushUint32_t($this->tradePayment);	//<uint32_t> 实付总金额
		$bs->pushInt32_t($this->tradeDiscountTotal);	//<int> 优惠总金额
		$bs->pushUint32_t($this->tradePaipaiHongbaoUsed);	//<uint32_t> Paipai红包使用金额
		$bs->pushUint32_t($this->payScore);	//<uint32_t> 积分支付值
		$bs->pushUint32_t($this->tradeGenTime);	//<uint32_t> 商品单生成时间
		$bs->pushUint16_t($this->tradeOpSerialNo);	//<uint16_t> 商品单库存操作序列号
		$bs->pushUint32_t($this->obtainScore);	//<uint32_t> 获得积分值
		$bs->pushUint32_t($this->tradeState);	//<uint32_t> 商品单状态
		$bs->pushUint32_t($this->tradeProperty);	//<uint32_t> 商品单属性值
		$bs->pushUint32_t($this->tradeProperty1);	//<uint32_t> 商品单属性值1
		$bs->pushUint32_t($this->tradeProperty2);	//<uint32_t> 商品单属性值2
		$bs->pushUint32_t($this->tradeProperty3);	//<uint32_t> 商品单属性值3
		$bs->pushUint32_t($this->tradeProperty4);	//<uint32_t> 商品单属性值4
		$bs->pushUint32_t($this->itemTimeoutFlag);	//<uint32_t> 商品超时标识
		$bs->pushUint32_t($this->lastUpdateTime);	//<uint32_t> 最后更新时间
		$bs->pushObject($this->activeInfoList,'\ecc\deal\po\TradeActivePoList');	//<ecc::deal::po::CTradeActivePoList> 商品活动列表
		$bs->pushObject($this->dealExtInfoMap,'stl_multimap');	//<std::multimap<uint32_t,std::string> > 订单扩展信息 
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId64_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerNickName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerTitle_u);	//<uint8_t> 
		$bs->pushUint8_t($this->businessId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeSource_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradePayType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->shippingfeeTemplateId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->shippingfeeDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemShippingfee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemClassId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemTitle_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemAttrCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemAttr_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemSkuId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemLocalCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemLocalStockCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemBarCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemSpuId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemStockId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemStoreHouseId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemPhyisicalStorage_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemLogo_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemSnapVersion_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemResetTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemWeight_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemVolume_u);	//<uint8_t> 
		$bs->pushUint8_t($this->mainItemId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemAccessoryDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemCostPrice_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemOriginPrice_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemSoldPrice_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemB2CMarket_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemB2CPM_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemUseVirtualStock_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyPrice_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyNum_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeTotalFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeAdjustFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradePayment_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeDiscountTotal_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradePaipaiHongbaoUsed_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payScore_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeGenTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeOpSerialNo_u);	//<uint8_t> 
		$bs->pushUint8_t($this->obtainScore_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeProperty_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeProperty1_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeProperty2_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeProperty3_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeProperty4_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemTimeoutFlag_u);	//<uint8_t> 
		$bs->pushUint8_t($this->lastUpdateTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->activeInfoList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealExtInfoMap_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushString($this->warranty);	//<std::string> 保修条款
		}
		if($this->version >= 1){
			$bs->pushUint64_t($this->productId);	//<uint64_t> 产品id
		}
		if($this->version >= 1){
			$bs->pushString($this->productCode);	//<std::string> 产品id编码
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonEdmCode);	//<std::string> 易迅edm编码
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonOTag);	//<std::string> 易迅OTag
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonTradeShopGuideCost);	//<std::string> 易迅店铺导购费用
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneType);	//<std::string> 易迅定制机类型
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneOperator);	//<std::string> 易迅定制机运营商
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneNumber);	//<std::string> 易迅定制机号码
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneArea);	//<std::string> 易迅定制机归属地
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhonePackageId);	//<std::string> 易迅定制机套餐id
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneUserName);	//<std::string> 易迅定制机用户姓名
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneUserAddr);	//<std::string> 易迅定制机用户地址
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneUserMobile);	//<std::string> 易迅定制机用户联系手机
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneUserTel);	//<std::string> 易迅定制机用户联系电话
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneIdCardNo);	//<std::string> 易迅定制机身份证号码
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneIdCardAddr);	//<std::string> 易迅定制机身份证地址
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneIdCardDate);	//<std::string> 易迅定制机身份证有效期
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneZipCode);	//<std::string> 易迅定制机邮政编码
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneCardPrice);	//<std::string> 易迅定制机卡价格
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhonePackagePrice);	//<std::string> 易迅定制机套餐价格
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonTradeFlag);	//<std::string> 易迅商品子单flag
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonPointType);	//<std::string> 易迅积分兑换类型
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonPackageIds);	//<std::string> 易迅商品子单套餐id
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->warranty_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->productId_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->productCode_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonEdmCode_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonOTag_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonTradeShopGuideCost_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneType_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneOperator_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneNumber_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneArea_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhonePackageId_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneUserName_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneUserAddr_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneUserMobile_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneUserTel_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneIdCardNo_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneIdCardAddr_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneIdCardDate_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneZipCode_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneCardPrice_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhonePackagePrice_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonTradeFlag_u);	//<uint8_t> 易迅商品子单flag
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonPointType_u);	//<uint8_t> 易迅积分兑换类型
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonPackageIds_u);	//<uint8_t> 易迅商品子单套餐id
		}
		if($this->version >= 2){
			$bs->pushUint32_t($this->icsonTradeCashBack);	//<uint32_t> 子单返现金额
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->icsonTradeCashBack_u);	//<uint8_t> 子单返现金额UFlag
		}
		if($this->version >= 3){
			$bs->pushString($this->icsonUnitCostInvoice);	//<std::string> 去税后成本
		}
		if($this->version >= 3){
			$bs->pushUint8_t($this->icsonUnitCostInvoice_u);	//<uint8_t> 去税后成本UFlag
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['dealId'] = $bs->popString();	//<std::string> 订单编号，可为空
		$this->_arr_value['dealId64'] = $bs->popUint64_t();	//<uint64_t> 订单单号，拍拍订单同步可使用，可为空
		$this->_arr_value['bdealId'] = $bs->popUint64_t();	//<uint64_t> 交易单号，可为空
		$this->_arr_value['tradeId'] = $bs->popUint64_t();	//<uint64_t> 商品订单号，拍拍订单同步可使用，可为空
		$this->_arr_value['buyerId'] = $bs->popUint64_t();	//<uint64_t> 买家ID
		$this->_arr_value['buyerNickName'] = $bs->popString();	//<std::string> 买家昵称
		$this->_arr_value['sellerId'] = $bs->popUint64_t();	//<uint64_t> 商家ID
		$this->_arr_value['sellerTitle'] = $bs->popString();	//<std::string> 商家名称
		$this->_arr_value['businessId'] = $bs->popUint32_t();	//<uint32_t> 业务ID
		$this->_arr_value['tradeType'] = $bs->popUint8_t();	//<uint8_t> 订单类型
		$this->_arr_value['tradeSource'] = $bs->popUint32_t();	//<uint32_t> 下单渠道：1：业务主站；2：移动app；3：移动wap
		$this->_arr_value['tradePayType'] = $bs->popUint8_t();	//<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款
		$this->_arr_value['shippingfeeTemplateId'] = $bs->popString();	//<std::string> 运费模版ID
		$this->_arr_value['shippingfeeDesc'] = $bs->popString();	//<std::string> 运费描述
		$this->_arr_value['itemShippingfee'] = $bs->popUint32_t();	//<uint32_t> 商品运费,不参与金额计算，只做展示，商品系统传入
		$this->_arr_value['itemType'] = $bs->popUint32_t();	//<uint32_t> 商品类型；1：普通商品；2：套餐主商品；3：套餐副商品；4：赠品主商品；5：赠品副商品; 6: 组件
		$this->_arr_value['itemClassId'] = $bs->popUint32_t();	//<uint32_t> 品类（类目）ID
		$this->_arr_value['itemTitle'] = $bs->popString();	//<std::string> 商品标题
		$this->_arr_value['itemAttrCode'] = $bs->popString();	//<std::string> 商品销售属性编码
		$this->_arr_value['itemAttr'] = $bs->popString();	//<std::string> 商品销售属性描述
		$this->_arr_value['itemId'] = $bs->popString();	//<std::string> 商品ID，由业务定义
		$this->_arr_value['itemSkuId'] = $bs->popUint64_t();	//<uint64_t> 商品SKUID
		$this->_arr_value['itemLocalCode'] = $bs->popString();	//<std::string> 商品商家本地编码
		$this->_arr_value['itemLocalStockCode'] = $bs->popString();	//<std::string> 商品商家本地库存编码
		$this->_arr_value['itemBarCode'] = $bs->popString();	//<std::string> 商品条形码
		$this->_arr_value['itemSpuId'] = $bs->popUint64_t();	//<uint64_t> 商品SPUID
		$this->_arr_value['itemStockId'] = $bs->popUint64_t();	//<uint64_t> 商品库存ID
		$this->_arr_value['itemStoreHouseId'] = $bs->popUint32_t();	//<uint32_t> 商品仓库ID
		$this->_arr_value['itemPhyisicalStorage'] = $bs->popString();	//<std::string> 商品所属物理仓
		$this->_arr_value['itemLogo'] = $bs->popString();	//<std::string> 商品图片Logo
		$this->_arr_value['itemSnapVersion'] = $bs->popUint32_t();	//<uint32_t> 商品快照版本号
		$this->_arr_value['itemResetTime'] = $bs->popUint32_t();	//<uint32_t> 商品重置时间戳
		$this->_arr_value['itemWeight'] = $bs->popUint32_t();	//<uint32_t> 商品重量
		$this->_arr_value['itemVolume'] = $bs->popUint32_t();	//<uint32_t> 商品体积
		$this->_arr_value['mainItemId'] = $bs->popUint64_t();	//<uint64_t> 商品套餐主商品ID
		$this->_arr_value['itemAccessoryDesc'] = $bs->popString();	//<std::string> 商品标配说明
		$this->_arr_value['itemCostPrice'] = $bs->popUint32_t();	//<uint32_t> 商品成本价
		$this->_arr_value['itemOriginPrice'] = $bs->popUint32_t();	//<uint32_t> 商品市场价
		$this->_arr_value['itemSoldPrice'] = $bs->popUint32_t();	//<uint32_t> 商品销售单价
		$this->_arr_value['itemB2CMarket'] = $bs->popString();	//<std::string> 自营B2C市场
		$this->_arr_value['itemB2CPM'] = $bs->popString();	//<std::string> 自营B2CPM
		$this->_arr_value['itemUseVirtualStock'] = $bs->popUint8_t();	//<uint8_t> 自营B2C是否占用虚库
		$this->_arr_value['buyPrice'] = $bs->popUint32_t();	//<uint32_t> 商品成交价
		$this->_arr_value['buyNum'] = $bs->popUint32_t();	//<uint32_t> 商品成交件数
		$this->_arr_value['tradeTotalFee'] = $bs->popUint32_t();	//<uint32_t> 商品单总金额,下单金额
		$this->_arr_value['tradeAdjustFee'] = $bs->popInt32_t();	//<int> 商品单调价金额
		$this->_arr_value['tradePayment'] = $bs->popUint32_t();	//<uint32_t> 实付总金额
		$this->_arr_value['tradeDiscountTotal'] = $bs->popInt32_t();	//<int> 优惠总金额
		$this->_arr_value['tradePaipaiHongbaoUsed'] = $bs->popUint32_t();	//<uint32_t> Paipai红包使用金额
		$this->_arr_value['payScore'] = $bs->popUint32_t();	//<uint32_t> 积分支付值
		$this->_arr_value['tradeGenTime'] = $bs->popUint32_t();	//<uint32_t> 商品单生成时间
		$this->_arr_value['tradeOpSerialNo'] = $bs->popUint16_t();	//<uint16_t> 商品单库存操作序列号
		$this->_arr_value['obtainScore'] = $bs->popUint32_t();	//<uint32_t> 获得积分值
		$this->_arr_value['tradeState'] = $bs->popUint32_t();	//<uint32_t> 商品单状态
		$this->_arr_value['tradeProperty'] = $bs->popUint32_t();	//<uint32_t> 商品单属性值
		$this->_arr_value['tradeProperty1'] = $bs->popUint32_t();	//<uint32_t> 商品单属性值1
		$this->_arr_value['tradeProperty2'] = $bs->popUint32_t();	//<uint32_t> 商品单属性值2
		$this->_arr_value['tradeProperty3'] = $bs->popUint32_t();	//<uint32_t> 商品单属性值3
		$this->_arr_value['tradeProperty4'] = $bs->popUint32_t();	//<uint32_t> 商品单属性值4
		$this->_arr_value['itemTimeoutFlag'] = $bs->popUint32_t();	//<uint32_t> 商品超时标识
		$this->_arr_value['lastUpdateTime'] = $bs->popUint32_t();	//<uint32_t> 最后更新时间
		$this->_arr_value['activeInfoList'] = $bs->popObject('\ecc\deal\po\TradeActivePoList');	//<ecc::deal::po::CTradeActivePoList> 商品活动列表
		$this->_arr_value['dealExtInfoMap'] = $bs->popObject('stl_multimap<uint32_t,stl_string>');	//<std::multimap<uint32_t,std::string> > 订单扩展信息 
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId64_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerNickName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerTitle_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['businessId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeSource_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradePayType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shippingfeeTemplateId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shippingfeeDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemShippingfee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemClassId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemTitle_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemAttrCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemAttr_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemSkuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemLocalCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemLocalStockCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemBarCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemSpuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemStockId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemStoreHouseId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemPhyisicalStorage_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemLogo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemSnapVersion_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemResetTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemWeight_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemVolume_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mainItemId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemAccessoryDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemCostPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemOriginPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemSoldPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemB2CMarket_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemB2CPM_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemUseVirtualStock_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeTotalFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeAdjustFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradePayment_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeDiscountTotal_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradePaipaiHongbaoUsed_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payScore_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeGenTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeOpSerialNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['obtainScore_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeProperty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeProperty1_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeProperty2_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeProperty3_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeProperty4_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemTimeoutFlag_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['lastUpdateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['activeInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealExtInfoMap_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['warranty'] = $bs->popString();	//<std::string> 保修条款
		}
		if($this->version >= 1){
			$this->_arr_value['productId'] = $bs->popUint64_t();	//<uint64_t> 产品id
		}
		if($this->version >= 1){
			$this->_arr_value['productCode'] = $bs->popString();	//<std::string> 产品id编码
		}
		if($this->version >= 1){
			$this->_arr_value['icsonEdmCode'] = $bs->popString();	//<std::string> 易迅edm编码
		}
		if($this->version >= 1){
			$this->_arr_value['icsonOTag'] = $bs->popString();	//<std::string> 易迅OTag
		}
		if($this->version >= 1){
			$this->_arr_value['icsonTradeShopGuideCost'] = $bs->popString();	//<std::string> 易迅店铺导购费用
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneType'] = $bs->popString();	//<std::string> 易迅定制机类型
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneOperator'] = $bs->popString();	//<std::string> 易迅定制机运营商
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneNumber'] = $bs->popString();	//<std::string> 易迅定制机号码
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneArea'] = $bs->popString();	//<std::string> 易迅定制机归属地
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhonePackageId'] = $bs->popString();	//<std::string> 易迅定制机套餐id
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneUserName'] = $bs->popString();	//<std::string> 易迅定制机用户姓名
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneUserAddr'] = $bs->popString();	//<std::string> 易迅定制机用户地址
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneUserMobile'] = $bs->popString();	//<std::string> 易迅定制机用户联系手机
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneUserTel'] = $bs->popString();	//<std::string> 易迅定制机用户联系电话
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneIdCardNo'] = $bs->popString();	//<std::string> 易迅定制机身份证号码
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneIdCardAddr'] = $bs->popString();	//<std::string> 易迅定制机身份证地址
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneIdCardDate'] = $bs->popString();	//<std::string> 易迅定制机身份证有效期
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneZipCode'] = $bs->popString();	//<std::string> 易迅定制机邮政编码
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneCardPrice'] = $bs->popString();	//<std::string> 易迅定制机卡价格
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhonePackagePrice'] = $bs->popString();	//<std::string> 易迅定制机套餐价格
		}
		if($this->version >= 1){
			$this->_arr_value['icsonTradeFlag'] = $bs->popString();	//<std::string> 易迅商品子单flag
		}
		if($this->version >= 1){
			$this->_arr_value['icsonPointType'] = $bs->popString();	//<std::string> 易迅积分兑换类型
		}
		if($this->version >= 1){
			$this->_arr_value['icsonPackageIds'] = $bs->popString();	//<std::string> 易迅商品子单套餐id
		}
		if($this->version >= 1){
			$this->_arr_value['warranty_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['productId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['productCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonEdmCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonOTag_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonTradeShopGuideCost_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneType_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneOperator_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneNumber_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneArea_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhonePackageId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneUserName_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneUserAddr_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneUserMobile_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneUserTel_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneIdCardNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneIdCardAddr_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneIdCardDate_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneZipCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneCardPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhonePackagePrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonTradeFlag_u'] = $bs->popUint8_t();	//<uint8_t> 易迅商品子单flag
		}
		if($this->version >= 1){
			$this->_arr_value['icsonPointType_u'] = $bs->popUint8_t();	//<uint8_t> 易迅积分兑换类型
		}
		if($this->version >= 1){
			$this->_arr_value['icsonPackageIds_u'] = $bs->popUint8_t();	//<uint8_t> 易迅商品子单套餐id
		}
		if($this->version >= 2){
			$this->_arr_value['icsonTradeCashBack'] = $bs->popUint32_t();	//<uint32_t> 子单返现金额
		}
		if($this->version >= 2){
			$this->_arr_value['icsonTradeCashBack_u'] = $bs->popUint8_t();	//<uint8_t> 子单返现金额UFlag
		}
		if($this->version >= 3){
			$this->_arr_value['icsonUnitCostInvoice'] = $bs->popString();	//<std::string> 去税后成本
		}
		if($this->version >= 3){
			$this->_arr_value['icsonUnitCostInvoice_u'] = $bs->popUint8_t();	//<uint8_t> 去税后成本UFlag
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

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.OrderPo.java
class OrderPayInfoPoList{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 版本号(版本>=0)
	private $payInfoList;	//<std::vector<ecc::deal::po::COrderPayInfoPo> > 支付单列表(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $payInfoList_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->payInfoList = new \stl_vector2('\ecc\deal\po\OrderPayInfoPo');	//<std::vector<ecc::deal::po::COrderPayInfoPo> >
		$this->version_u = 0;	//<uint8_t>
		$this->payInfoList_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\po\OrderPayInfoPoList\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\OrderPayInfoPoList\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 版本号
		$bs->pushObject($this->payInfoList,'stl_vector');	//<std::vector<ecc::deal::po::COrderPayInfoPo> > 支付单列表
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payInfoList_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 版本号
		$this->_arr_value['payInfoList'] = $bs->popObject('stl_vector<\ecc\deal\po\OrderPayInfoPo>');	//<std::vector<ecc::deal::po::COrderPayInfoPo> > 支付单列表
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.OrderPayInfoPoList.java
class OrderPayInfoPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 版本号(版本>=0)
	private $payId;	//<uint64_t> 支付单ID，拍拍订单同步可使用，可为空(版本>=0)
	private $dealId;	//<std::string> 订单编号，可为空(版本>=0)
	private $dealId64;	//<uint64_t> 订单单号，拍拍订单同步可使用，可为空(版本>=0)
	private $bdealId;	//<uint64_t> 交易单号，可为空(版本>=0)
	private $buyerId;	//<uint64_t> 买家ID(版本>=0)
	private $buyerNickName;	//<std::string> 买家昵称(版本>=0)
	private $sellerId;	//<uint64_t> 商家ID(版本>=0)
	private $sellerTitle;	//<std::string> 商家名称(版本>=0)
	private $itemTitleList;	//<std::string> 商品标题列表(版本>=0)
	private $payTotalFee;	//<uint32_t> 支付总金额(版本>=0)
	private $payDealTotalFee;	//<uint32_t> 订单待付金额，等于商品实付金额+退运险(版本>=0)
	private $payShippingFee;	//<uint32_t> 邮费金额(版本>=0)
	private $payAccount;	//<std::string> 支付帐号(版本>=0)
	private $payState;	//<uint32_t> 支付单状态，1，未支付；2，支付完成(版本>=0)
	private $payProperty;	//<uint32_t> 支付单标记(版本>=0)
	private $payType;	//<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款(版本>=0)
	private $payChannel;	//<uint8_t> 支付渠道(版本>=0)
	private $payBank;	//<std::string> 支付银行ID(版本>=0)
	private $payDealId;	//<std::string> 支付订单编号(版本>=0)
	private $payGenTime;	//<uint32_t> 支付单生成时间(版本>=0)
	private $payEnableBeginTime;	//<uint32_t> 支付单有效起始时间(版本>=0)
	private $payEnableEndTime;	//<uint32_t> 支付单有效结束时间(版本>=0)
	private $payServiceFee;	//<uint32_t> 支付手续费(版本>=0)
	private $whoPayCodFee;	//<uint32_t> 谁承担COD手续费，1：卖家承担；2：买家；3：平台承担(版本>=0)
	private $payCodCftServiceFee;	//<uint32_t> COD财付通支付手续费(版本>=0)
	private $payCodPaipaiServiceFee;	//<uint32_t> CODPaipai支付手续费(版本>=0)
	private $payCodServiceAdjustFee;	//<int> COD手续费调价金额(版本>=0)
	private $payCodWuliuServiceFee;	//<uint32_t> COD物流支付手续费(版本>=0)
	private $payInstallmentBank;	//<std::string> 分期付款银行(版本>=0)
	private $payInstallmentNum;	//<uint16_t> 分期付款期数(版本>=0)
	private $payInstallmentPayment;	//<uint32_t> 分期付款每期金额(版本>=0)
	private $lastUpdateTime;	//<uint32_t> 最后更新时间(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $payId_u;	//<uint8_t> (版本>=0)
	private $dealId_u;	//<uint8_t> (版本>=0)
	private $dealId64_u;	//<uint8_t> (版本>=0)
	private $bdealId_u;	//<uint8_t> (版本>=0)
	private $buyerId_u;	//<uint8_t> (版本>=0)
	private $buyerNickName_u;	//<uint8_t> (版本>=0)
	private $sellerId_u;	//<uint8_t> (版本>=0)
	private $sellerTitle_u;	//<uint8_t> (版本>=0)
	private $itemTitleList_u;	//<uint8_t> (版本>=0)
	private $payTotalFee_u;	//<uint8_t> (版本>=0)
	private $payDealTotalFee_u;	//<uint8_t> (版本>=0)
	private $payShippingFee_u;	//<uint8_t> (版本>=0)
	private $payAccount_u;	//<uint8_t> (版本>=0)
	private $payState_u;	//<uint8_t> (版本>=0)
	private $payProperty_u;	//<uint8_t> (版本>=0)
	private $payType_u;	//<uint8_t> (版本>=0)
	private $payChannel_u;	//<uint8_t> (版本>=0)
	private $payBank_u;	//<uint8_t> (版本>=0)
	private $payDealId_u;	//<uint8_t> (版本>=0)
	private $payGenTime_u;	//<uint8_t> (版本>=0)
	private $payEnableBeginTime_u;	//<uint8_t> (版本>=0)
	private $payEnableEndTime_u;	//<uint8_t> (版本>=0)
	private $payServiceFee_u;	//<uint8_t> (版本>=0)
	private $whoPayCodFee_u;	//<uint8_t> (版本>=0)
	private $payCodCftServiceFee_u;	//<uint8_t> (版本>=0)
	private $payCodPaipaiServiceFee_u;	//<uint8_t> (版本>=0)
	private $payCodServiceAdjustFee_u;	//<uint8_t> (版本>=0)
	private $payCodWuliuServiceFee_u;	//<uint8_t> (版本>=0)
	private $payInstallmentBank_u;	//<uint8_t> (版本>=0)
	private $payInstallmentNum_u;	//<uint8_t> (版本>=0)
	private $payInstallmentPayment_u;	//<uint8_t> (版本>=0)
	private $lastUpdateTime_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->payId = 0;	//<uint64_t>
		$this->dealId = "";	//<std::string>
		$this->dealId64 = 0;	//<uint64_t>
		$this->bdealId = 0;	//<uint64_t>
		$this->buyerId = 0;	//<uint64_t>
		$this->buyerNickName = "";	//<std::string>
		$this->sellerId = 0;	//<uint64_t>
		$this->sellerTitle = "";	//<std::string>
		$this->itemTitleList = "";	//<std::string>
		$this->payTotalFee = 0;	//<uint32_t>
		$this->payDealTotalFee = 0;	//<uint32_t>
		$this->payShippingFee = 0;	//<uint32_t>
		$this->payAccount = "";	//<std::string>
		$this->payState = 0;	//<uint32_t>
		$this->payProperty = 0;	//<uint32_t>
		$this->payType = 0;	//<uint8_t>
		$this->payChannel = 0;	//<uint8_t>
		$this->payBank = "";	//<std::string>
		$this->payDealId = "";	//<std::string>
		$this->payGenTime = 0;	//<uint32_t>
		$this->payEnableBeginTime = 0;	//<uint32_t>
		$this->payEnableEndTime = 0;	//<uint32_t>
		$this->payServiceFee = 0;	//<uint32_t>
		$this->whoPayCodFee = 0;	//<uint32_t>
		$this->payCodCftServiceFee = 0;	//<uint32_t>
		$this->payCodPaipaiServiceFee = 0;	//<uint32_t>
		$this->payCodServiceAdjustFee = 0;	//<int>
		$this->payCodWuliuServiceFee = 0;	//<uint32_t>
		$this->payInstallmentBank = "";	//<std::string>
		$this->payInstallmentNum = 0;	//<uint16_t>
		$this->payInstallmentPayment = 0;	//<uint32_t>
		$this->lastUpdateTime = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->payId_u = 0;	//<uint8_t>
		$this->dealId_u = 0;	//<uint8_t>
		$this->dealId64_u = 0;	//<uint8_t>
		$this->bdealId_u = 0;	//<uint8_t>
		$this->buyerId_u = 0;	//<uint8_t>
		$this->buyerNickName_u = 0;	//<uint8_t>
		$this->sellerId_u = 0;	//<uint8_t>
		$this->sellerTitle_u = 0;	//<uint8_t>
		$this->itemTitleList_u = 0;	//<uint8_t>
		$this->payTotalFee_u = 0;	//<uint8_t>
		$this->payDealTotalFee_u = 0;	//<uint8_t>
		$this->payShippingFee_u = 0;	//<uint8_t>
		$this->payAccount_u = 0;	//<uint8_t>
		$this->payState_u = 0;	//<uint8_t>
		$this->payProperty_u = 0;	//<uint8_t>
		$this->payType_u = 0;	//<uint8_t>
		$this->payChannel_u = 0;	//<uint8_t>
		$this->payBank_u = 0;	//<uint8_t>
		$this->payDealId_u = 0;	//<uint8_t>
		$this->payGenTime_u = 0;	//<uint8_t>
		$this->payEnableBeginTime_u = 0;	//<uint8_t>
		$this->payEnableEndTime_u = 0;	//<uint8_t>
		$this->payServiceFee_u = 0;	//<uint8_t>
		$this->whoPayCodFee_u = 0;	//<uint8_t>
		$this->payCodCftServiceFee_u = 0;	//<uint8_t>
		$this->payCodPaipaiServiceFee_u = 0;	//<uint8_t>
		$this->payCodServiceAdjustFee_u = 0;	//<uint8_t>
		$this->payCodWuliuServiceFee_u = 0;	//<uint8_t>
		$this->payInstallmentBank_u = 0;	//<uint8_t>
		$this->payInstallmentNum_u = 0;	//<uint8_t>
		$this->payInstallmentPayment_u = 0;	//<uint8_t>
		$this->lastUpdateTime_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\po\OrderPayInfoPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\OrderPayInfoPo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 版本号
		$bs->pushUint64_t($this->payId);	//<uint64_t> 支付单ID，拍拍订单同步可使用，可为空
		$bs->pushString($this->dealId);	//<std::string> 订单编号，可为空
		$bs->pushUint64_t($this->dealId64);	//<uint64_t> 订单单号，拍拍订单同步可使用，可为空
		$bs->pushUint64_t($this->bdealId);	//<uint64_t> 交易单号，可为空
		$bs->pushUint64_t($this->buyerId);	//<uint64_t> 买家ID
		$bs->pushString($this->buyerNickName);	//<std::string> 买家昵称
		$bs->pushUint64_t($this->sellerId);	//<uint64_t> 商家ID
		$bs->pushString($this->sellerTitle);	//<std::string> 商家名称
		$bs->pushString($this->itemTitleList);	//<std::string> 商品标题列表
		$bs->pushUint32_t($this->payTotalFee);	//<uint32_t> 支付总金额
		$bs->pushUint32_t($this->payDealTotalFee);	//<uint32_t> 订单待付金额，等于商品实付金额+退运险
		$bs->pushUint32_t($this->payShippingFee);	//<uint32_t> 邮费金额
		$bs->pushString($this->payAccount);	//<std::string> 支付帐号
		$bs->pushUint32_t($this->payState);	//<uint32_t> 支付单状态，1，未支付；2，支付完成
		$bs->pushUint32_t($this->payProperty);	//<uint32_t> 支付单标记
		$bs->pushUint8_t($this->payType);	//<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款
		$bs->pushUint8_t($this->payChannel);	//<uint8_t> 支付渠道
		$bs->pushString($this->payBank);	//<std::string> 支付银行ID
		$bs->pushString($this->payDealId);	//<std::string> 支付订单编号
		$bs->pushUint32_t($this->payGenTime);	//<uint32_t> 支付单生成时间
		$bs->pushUint32_t($this->payEnableBeginTime);	//<uint32_t> 支付单有效起始时间
		$bs->pushUint32_t($this->payEnableEndTime);	//<uint32_t> 支付单有效结束时间
		$bs->pushUint32_t($this->payServiceFee);	//<uint32_t> 支付手续费
		$bs->pushUint32_t($this->whoPayCodFee);	//<uint32_t> 谁承担COD手续费，1：卖家承担；2：买家；3：平台承担
		$bs->pushUint32_t($this->payCodCftServiceFee);	//<uint32_t> COD财付通支付手续费
		$bs->pushUint32_t($this->payCodPaipaiServiceFee);	//<uint32_t> CODPaipai支付手续费
		$bs->pushInt32_t($this->payCodServiceAdjustFee);	//<int> COD手续费调价金额
		$bs->pushUint32_t($this->payCodWuliuServiceFee);	//<uint32_t> COD物流支付手续费
		$bs->pushString($this->payInstallmentBank);	//<std::string> 分期付款银行
		$bs->pushUint16_t($this->payInstallmentNum);	//<uint16_t> 分期付款期数
		$bs->pushUint32_t($this->payInstallmentPayment);	//<uint32_t> 分期付款每期金额
		$bs->pushUint32_t($this->lastUpdateTime);	//<uint32_t> 最后更新时间
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId64_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerNickName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerTitle_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemTitleList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payTotalFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payDealTotalFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payShippingFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payAccount_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payProperty_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payChannel_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payBank_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payDealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payGenTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payEnableBeginTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payEnableEndTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payServiceFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->whoPayCodFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payCodCftServiceFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payCodPaipaiServiceFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payCodServiceAdjustFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payCodWuliuServiceFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payInstallmentBank_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payInstallmentNum_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payInstallmentPayment_u);	//<uint8_t> 
		$bs->pushUint8_t($this->lastUpdateTime_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 版本号
		$this->_arr_value['payId'] = $bs->popUint64_t();	//<uint64_t> 支付单ID，拍拍订单同步可使用，可为空
		$this->_arr_value['dealId'] = $bs->popString();	//<std::string> 订单编号，可为空
		$this->_arr_value['dealId64'] = $bs->popUint64_t();	//<uint64_t> 订单单号，拍拍订单同步可使用，可为空
		$this->_arr_value['bdealId'] = $bs->popUint64_t();	//<uint64_t> 交易单号，可为空
		$this->_arr_value['buyerId'] = $bs->popUint64_t();	//<uint64_t> 买家ID
		$this->_arr_value['buyerNickName'] = $bs->popString();	//<std::string> 买家昵称
		$this->_arr_value['sellerId'] = $bs->popUint64_t();	//<uint64_t> 商家ID
		$this->_arr_value['sellerTitle'] = $bs->popString();	//<std::string> 商家名称
		$this->_arr_value['itemTitleList'] = $bs->popString();	//<std::string> 商品标题列表
		$this->_arr_value['payTotalFee'] = $bs->popUint32_t();	//<uint32_t> 支付总金额
		$this->_arr_value['payDealTotalFee'] = $bs->popUint32_t();	//<uint32_t> 订单待付金额，等于商品实付金额+退运险
		$this->_arr_value['payShippingFee'] = $bs->popUint32_t();	//<uint32_t> 邮费金额
		$this->_arr_value['payAccount'] = $bs->popString();	//<std::string> 支付帐号
		$this->_arr_value['payState'] = $bs->popUint32_t();	//<uint32_t> 支付单状态，1，未支付；2，支付完成
		$this->_arr_value['payProperty'] = $bs->popUint32_t();	//<uint32_t> 支付单标记
		$this->_arr_value['payType'] = $bs->popUint8_t();	//<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款
		$this->_arr_value['payChannel'] = $bs->popUint8_t();	//<uint8_t> 支付渠道
		$this->_arr_value['payBank'] = $bs->popString();	//<std::string> 支付银行ID
		$this->_arr_value['payDealId'] = $bs->popString();	//<std::string> 支付订单编号
		$this->_arr_value['payGenTime'] = $bs->popUint32_t();	//<uint32_t> 支付单生成时间
		$this->_arr_value['payEnableBeginTime'] = $bs->popUint32_t();	//<uint32_t> 支付单有效起始时间
		$this->_arr_value['payEnableEndTime'] = $bs->popUint32_t();	//<uint32_t> 支付单有效结束时间
		$this->_arr_value['payServiceFee'] = $bs->popUint32_t();	//<uint32_t> 支付手续费
		$this->_arr_value['whoPayCodFee'] = $bs->popUint32_t();	//<uint32_t> 谁承担COD手续费，1：卖家承担；2：买家；3：平台承担
		$this->_arr_value['payCodCftServiceFee'] = $bs->popUint32_t();	//<uint32_t> COD财付通支付手续费
		$this->_arr_value['payCodPaipaiServiceFee'] = $bs->popUint32_t();	//<uint32_t> CODPaipai支付手续费
		$this->_arr_value['payCodServiceAdjustFee'] = $bs->popInt32_t();	//<int> COD手续费调价金额
		$this->_arr_value['payCodWuliuServiceFee'] = $bs->popUint32_t();	//<uint32_t> COD物流支付手续费
		$this->_arr_value['payInstallmentBank'] = $bs->popString();	//<std::string> 分期付款银行
		$this->_arr_value['payInstallmentNum'] = $bs->popUint16_t();	//<uint16_t> 分期付款期数
		$this->_arr_value['payInstallmentPayment'] = $bs->popUint32_t();	//<uint32_t> 分期付款每期金额
		$this->_arr_value['lastUpdateTime'] = $bs->popUint32_t();	//<uint32_t> 最后更新时间
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId64_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerNickName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerTitle_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemTitleList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payTotalFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payDealTotalFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payShippingFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payAccount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payProperty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payChannel_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payBank_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payDealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payGenTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payEnableBeginTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payEnableEndTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payServiceFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['whoPayCodFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payCodCftServiceFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payCodPaipaiServiceFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payCodServiceAdjustFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payCodWuliuServiceFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payInstallmentBank_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payInstallmentNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payInstallmentPayment_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['lastUpdateTime_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.BackfillDealInfoReq.java
class BackfillDealBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 版本号(版本>=0)
	private $bdealId;	//<std::string> 统一订单后台交易单号(版本>=0)
	private $dealId;	//<std::string> 统一订单后台订单号(版本>=0)
	private $businessBdealId;	//<std::string> 业务父订单号(版本>=0)
	private $businessDealId;	//<std::string> 业务订单号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $bdealId_u;	//<uint8_t> (版本>=0)
	private $dealId_u;	//<uint8_t> (版本>=0)
	private $businessBdealId_u;	//<uint8_t> (版本>=0)
	private $businessDealId_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->bdealId = "";	//<std::string>
		$this->dealId = "";	//<std::string>
		$this->businessBdealId = "";	//<std::string>
		$this->businessDealId = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->bdealId_u = 0;	//<uint8_t>
		$this->dealId_u = 0;	//<uint8_t>
		$this->businessBdealId_u = 0;	//<uint8_t>
		$this->businessDealId_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\bo\BackfillDealBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\BackfillDealBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 版本号
		$bs->pushString($this->bdealId);	//<std::string> 统一订单后台交易单号
		$bs->pushString($this->dealId);	//<std::string> 统一订单后台订单号
		$bs->pushString($this->businessBdealId);	//<std::string> 业务父订单号
		$bs->pushString($this->businessDealId);	//<std::string> 业务订单号
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->businessBdealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->businessDealId_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 版本号
		$this->_arr_value['bdealId'] = $bs->popString();	//<std::string> 统一订单后台交易单号
		$this->_arr_value['dealId'] = $bs->popString();	//<std::string> 统一订单后台订单号
		$this->_arr_value['businessBdealId'] = $bs->popString();	//<std::string> 业务父订单号
		$this->_arr_value['businessDealId'] = $bs->popString();	//<std::string> 业务订单号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['businessBdealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['businessDealId_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.AuditDealResp.java
class DealPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $dealId;	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702(版本>=0)
	private $dealId64;	//<uint64_t> 订单单号，统一平台内部单号(版本>=0)
	private $bdealId;	//<uint64_t> 交易单号，买卖家一次交易行为描述(版本>=0)
	private $businessDealId;	//<std::string> 业务订单编号，第三方托管订单(版本>=0)
	private $buyerId;	//<uint64_t> 买家ID(版本>=0)
	private $buyerAccount;	//<std::string> 买家帐号(版本>=0)
	private $buyerNickName;	//<std::string> 买家姓名(版本>=0)
	private $buyerNick;	//<std::string> 买家昵称(版本>=0)
	private $sellerId;	//<uint64_t> 商家ID(版本>=0)
	private $sellerTitle;	//<std::string> 商家真实名称(版本>=0)
	private $sellerNick;	//<std::string> 卖家昵称(版本>=0)
	private $businessId;	//<uint32_t> 业务ID(版本>=0)
	private $dealType;	//<uint8_t> 订单类型(版本>=0)
	private $dealSource;	//<uint32_t> 下单渠道：1：业务主站；2：移动app；3：移动wap(版本>=0)
	private $dealPayType;	//<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款(版本>=0)
	private $dealState;	//<uint32_t> 订单状态(版本>=0)
	private $preDealState;	//<uint32_t> 订单前一个状态(版本>=0)
	private $dealProperty;	//<uint32_t> 订单属性值，通用(版本>=0)
	private $dealProperty1;	//<uint32_t> 订单属性值，业务1扩展用(版本>=0)
	private $dealProperty2;	//<uint32_t> 订单属性值，业务2扩展用(版本>=0)
	private $dealProperty3;	//<uint32_t> 订单属性值，业务3扩展用(版本>=0)
	private $dealProperty4;	//<uint32_t> 订单属性值，业务4扩展用(版本>=0)
	private $refundState;	//<uint32_t> 退款状态, 各子单退款状态的汇总, 0:无退款,1:退款中,2:退款完成(版本>=0)
	private $evalState;	//<uint32_t> 评价评论状态(版本>=0)
	private $itemSkuidList;	//<std::string> 商品skuID列表(版本>=0)
	private $itemTitleList;	//<std::string> 商品标题列表(版本>=0)
	private $dealTotalFee;	//<uint32_t> 订单总金额,下单金额(版本>=0)
	private $dealAdjustFee;	//<int> 调价金额(版本>=0)
	private $dealPayment;	//<uint32_t> 实付总金额(版本>=0)
	private $dealDownPayment;	//<uint32_t> C2B预售定金金额(版本>=0)
	private $dealDiscountTotal;	//<int> 优惠总金额(版本>=0)
	private $dealItemTotalFee;	//<uint32_t> 商品总金额(版本>=0)
	private $dealWhoPayShippingFee;	//<uint32_t> 谁支付邮费，1：卖家；2：买家(版本>=0)
	private $dealShippingFee;	//<uint32_t> 邮费金额(版本>=0)
	private $dealWhoPayCodFee;	//<uint32_t> 谁承担COD手续费，1：卖家承担；2：买家；3：平台承担(版本>=0)
	private $dealCodFee;	//<uint32_t> COD手续额(版本>=0)
	private $dealWhoPayInsuranceFee;	//<uint32_t> 谁支付保险费，1：卖家赠送；2：买家；3：平台承担(版本>=0)
	private $dealInsuranceFee;	//<uint32_t> 运费保险费(版本>=0)
	private $dealSysAdjustFee;	//<int> 系统调价金额，用于区分COD卖家调价金额和用于凑整的COD优惠金额(版本>=0)
	private $dealRefundTotalFee;	//<uint32_t> 退款总金额费(版本>=0)
	private $payScore;	//<uint32_t> 积分支付值(版本>=0)
	private $obtainScore;	//<uint32_t> 获得积分值(版本>=0)
	private $dealGenTime;	//<uint32_t> 商品单生成时间(版本>=0)
	private $sendFromDesc;	//<std::string> 订单发货地描述(版本>=0)
	private $dealSeq;	//<uint64_t> 下单时间戳(版本>=0)
	private $dealMd5;	//<uint64_t> 下单md5(版本>=0)
	private $dealIp;	//<std::string> 下单IP(版本>=0)
	private $dealRefer;	//<std::string> refer(版本>=0)
	private $dealVisitKey;	//<std::string> visitkey(版本>=0)
	private $promotionDesc;	//<std::string> 订单促销信息描述(版本>=0)
	private $recvName;	//<std::string> 收货人(版本>=0)
	private $recvRegionCode;	//<uint32_t> 地区编码(版本>=0)
	private $recvAddress;	//<std::string> 地址(版本>=0)
	private $recvPostCode;	//<std::string> 邮编(版本>=0)
	private $recvPhone;	//<std::string> 电话(版本>=0)
	private $recvMobile;	//<uint64_t> 手机(版本>=0)
	private $expectRecvTime;	//<uint32_t> 期望收货时间,天(版本>=0)
	private $expectRecvTimeSpan;	//<std::string> 期望收货时段(版本>=0)
	private $recvRemark;	//<std::string> 收货附言(版本>=0)
	private $recvMask;	//<uint32_t> 收货属性值(版本>=0)
	private $expressType;	//<uint8_t> 配送方式；1：平邮；2：快递；3：EMS；4：B2C自建物流；5：用户配送点自提(版本>=0)
	private $expressCompanyID;	//<std::string> 物流公司ID(版本>=0)
	private $expressCompanyName;	//<std::string> 物流公司名称(版本>=0)
	private $expressDealID;	//<std::string> 物流公司订单号(版本>=0)
	private $expectArriveDays;	//<uint16_t> 预计到达天数(版本>=0)
	private $wuliuDealId;	//<std::string> 物流订单号，物流系统物流单(版本>=0)
	private $invoiceType;	//<uint8_t> 发票类型(版本>=0)
	private $invoiceHead;	//<std::string> 发票抬头(版本>=0)
	private $invoiceContent;	//<std::string> 发票内容(版本>=0)
	private $payAccount;	//<std::string> 支付帐号(版本>=0)
	private $cftDealId;	//<std::string> Cft支付单号(版本>=0)
	private $dealPayTime;	//<uint32_t> 付款完成时间(版本>=0)
	private $dealPayReturnTime;	//<uint32_t> 付款返回时间(版本>=0)
	private $dealCheckTime;	//<uint32_t> 审核时间(版本>=0)
	private $dealCheckVersion;	//<uint32_t> 审核版本号(版本>=0)
	private $dealCheckDesc;	//<std::string> 审核描述(版本>=0)
	private $dealSellerSendTime;	//<uint32_t> 商家发货时间(版本>=0)
	private $dealConsignTime;	//<uint32_t> 标记发货时间(版本>=0)
	private $dealConfirmRecvTime;	//<uint32_t> 签收时间(版本>=0)
	private $dealEndTime;	//<uint32_t> 结束时间(版本>=0)
	private $dealRecvFeeTime;	//<uint32_t> 打款完成时间(版本>=0)
	private $dealRecvFeeReturnTime;	//<uint32_t> 打款返回时间(版本>=0)
	private $dealBuyerRecvFee;	//<uint32_t> 打款买家总金额(版本>=0)
	private $dealSellerRecvFee;	//<uint32_t> 打款卖家总金额(版本>=0)
	private $dealPayCash;	//<uint32_t> 支付现金金额(版本>=0)
	private $dealPayTicket;	//<uint32_t> 支付财付券金额(版本>=0)
	private $dealPayCredit;	//<uint32_t> 支付积分金额(版本>=0)
	private $dealPayOther;	//<uint32_t> 其他支付金额(版本>=0)
	private $delayConfirmDays;	//<uint32_t> 延长确认收货天数(版本>=0)
	private $buyerTag;	//<uint8_t> 买家标记(版本>=0)
	private $buyerNote;	//<std::string> 买家备注(版本>=0)
	private $sellerTag;	//<uint8_t> 卖家标记(版本>=0)
	private $sellerNote;	//<std::string> 卖家备注(版本>=0)
	private $dataVersion;	//<uint32_t> 数据版本号(版本>=0)
	private $delFlag;	//<uint32_t> 订单有效标记(版本>=0)
	private $visibleState;	//<uint32_t> 可见标识(版本>=0)
	private $lastUpdateTime;	//<uint32_t> 最后更新时间(版本>=0)
	private $tradeInfoList;	//<ecc::deal::po::CTradePoList> 商品子单列表(版本>=0)
	private $payInfoList;	//<ecc::deal::po::CPayInfoPoList> 支付信息表(版本>=0)
	private $wuliuInfoList;	//<ecc::deal::po::CDealWuliuPoList> 物流信息表(版本>=0)
	private $recvFeeInfoList;	//<ecc::deal::po::CRecvFeePoList> 打款信息表(版本>=0)
	private $refundInfoList;	//<ecc::deal::po::CDealRefundPoList> 退款信息表(版本>=0)
	private $actionLogInfoList;	//<ecc::deal::po::CDealActionLogPoList> 流水日志表(版本>=0)
	private $dealExtInfoMap;	//<std::multimap<uint32_t,std::string> > 订单扩展信息 (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $dealId_u;	//<uint8_t> (版本>=0)
	private $dealId64_u;	//<uint8_t> (版本>=0)
	private $bdealId_u;	//<uint8_t> (版本>=0)
	private $businessDealId_u;	//<uint8_t> (版本>=0)
	private $buyerId_u;	//<uint8_t> (版本>=0)
	private $buyerAccount_u;	//<uint8_t> (版本>=0)
	private $buyerNickName_u;	//<uint8_t> (版本>=0)
	private $buyerNick_u;	//<uint8_t> (版本>=0)
	private $sellerId_u;	//<uint8_t> (版本>=0)
	private $sellerTitle_u;	//<uint8_t> (版本>=0)
	private $sellerNick_u;	//<uint8_t> (版本>=0)
	private $businessId_u;	//<uint8_t> (版本>=0)
	private $dealType_u;	//<uint8_t> (版本>=0)
	private $dealSource_u;	//<uint8_t> (版本>=0)
	private $dealPayType_u;	//<uint8_t> (版本>=0)
	private $dealState_u;	//<uint8_t> (版本>=0)
	private $preDealState_u;	//<uint8_t> (版本>=0)
	private $dealProperty_u;	//<uint8_t> (版本>=0)
	private $dealProperty1_u;	//<uint8_t> (版本>=0)
	private $dealProperty2_u;	//<uint8_t> (版本>=0)
	private $dealProperty3_u;	//<uint8_t> (版本>=0)
	private $dealProperty4_u;	//<uint8_t> (版本>=0)
	private $refundState_u;	//<uint8_t> (版本>=0)
	private $evalState_u;	//<uint8_t> (版本>=0)
	private $itemSkuidList_u;	//<uint8_t> (版本>=0)
	private $itemTitleList_u;	//<uint8_t> (版本>=0)
	private $dealTotalFee_u;	//<uint8_t> (版本>=0)
	private $dealAdjustFee_u;	//<uint8_t> (版本>=0)
	private $dealPayment_u;	//<uint8_t> (版本>=0)
	private $dealDownPayment_u;	//<uint8_t> (版本>=0)
	private $dealDiscountTotal_u;	//<uint8_t> (版本>=0)
	private $dealItemTotalFee_u;	//<uint8_t> (版本>=0)
	private $dealWhoPayShippingFee_u;	//<uint8_t> (版本>=0)
	private $dealShippingFee_u;	//<uint8_t> (版本>=0)
	private $dealWhoPayCodFee_u;	//<uint8_t> (版本>=0)
	private $dealCodFee_u;	//<uint8_t> (版本>=0)
	private $dealWhoPayInsuranceFee_u;	//<uint8_t> (版本>=0)
	private $dealInsuranceFee_u;	//<uint8_t> (版本>=0)
	private $dealSysAdjustFee_u;	//<uint8_t> (版本>=0)
	private $dealRefundTotalFee_u;	//<uint8_t> (版本>=0)
	private $payScore_u;	//<uint8_t> (版本>=0)
	private $obtainScore_u;	//<uint8_t> (版本>=0)
	private $dealGenTime_u;	//<uint8_t> (版本>=0)
	private $sendFromDesc_u;	//<uint8_t> (版本>=0)
	private $dealSeq_u;	//<uint8_t> (版本>=0)
	private $dealMd5_u;	//<uint8_t> (版本>=0)
	private $dealIp_u;	//<uint8_t> (版本>=0)
	private $dealRefer_u;	//<uint8_t> (版本>=0)
	private $dealVisitKey_u;	//<uint8_t> (版本>=0)
	private $promotionDesc_u;	//<uint8_t> (版本>=0)
	private $recvName_u;	//<uint8_t> (版本>=0)
	private $recvRegionCode_u;	//<uint8_t> (版本>=0)
	private $recvAddress_u;	//<uint8_t> (版本>=0)
	private $recvPostCode_u;	//<uint8_t> (版本>=0)
	private $recvPhone_u;	//<uint8_t> (版本>=0)
	private $recvMobile_u;	//<uint8_t> (版本>=0)
	private $expectRecvTime_u;	//<uint8_t> (版本>=0)
	private $expectRecvTimeSpan_u;	//<uint8_t> (版本>=0)
	private $recvRemark_u;	//<uint8_t> (版本>=0)
	private $recvMask_u;	//<uint8_t> (版本>=0)
	private $expressType_u;	//<uint8_t> (版本>=0)
	private $expressCompanyID_u;	//<uint8_t> (版本>=0)
	private $expressCompanyName_u;	//<uint8_t> (版本>=0)
	private $expressDealID_u;	//<uint8_t> (版本>=0)
	private $expectArriveDays_u;	//<uint8_t> (版本>=0)
	private $wuliuDealId_u;	//<uint8_t> (版本>=0)
	private $invoiceType_u;	//<uint8_t> (版本>=0)
	private $invoiceHead_u;	//<uint8_t> (版本>=0)
	private $invoiceContent_u;	//<uint8_t> (版本>=0)
	private $payAccount_u;	//<uint8_t> (版本>=0)
	private $cftDealId_u;	//<uint8_t> (版本>=0)
	private $dealPayTime_u;	//<uint8_t> (版本>=0)
	private $dealPayReturnTime_u;	//<uint8_t> (版本>=0)
	private $dealCheckTime_u;	//<uint8_t> (版本>=0)
	private $dealCheckVersion_u;	//<uint8_t> (版本>=0)
	private $dealCheckDesc_u;	//<uint8_t> (版本>=0)
	private $dealSellerSendTime_u;	//<uint8_t> (版本>=0)
	private $dealConsignTime_u;	//<uint8_t> (版本>=0)
	private $dealConfirmRecvTime_u;	//<uint8_t> (版本>=0)
	private $dealEndTime_u;	//<uint8_t> (版本>=0)
	private $dealRecvFeeTime_u;	//<uint8_t> (版本>=0)
	private $dealRecvFeeReturnTime_u;	//<uint8_t> (版本>=0)
	private $dealBuyerRecvFee_u;	//<uint8_t> (版本>=0)
	private $dealSellerRecvFee_u;	//<uint8_t> (版本>=0)
	private $dealPayCash_u;	//<uint8_t> (版本>=0)
	private $dealPayTicket_u;	//<uint8_t> (版本>=0)
	private $dealPayCredit_u;	//<uint8_t> (版本>=0)
	private $dealPayOther_u;	//<uint8_t> (版本>=0)
	private $delayConfirmDays_u;	//<uint8_t> (版本>=0)
	private $buyerTag_u;	//<uint8_t> (版本>=0)
	private $buyerNote_u;	//<uint8_t> (版本>=0)
	private $sellerTag_u;	//<uint8_t> (版本>=0)
	private $sellerNote_u;	//<uint8_t> (版本>=0)
	private $dataVersion_u;	//<uint8_t> (版本>=0)
	private $delFlag_u;	//<uint8_t> (版本>=0)
	private $visibleState_u;	//<uint8_t> (版本>=0)
	private $lastUpdateTime_u;	//<uint8_t> (版本>=0)
	private $tradeInfoList_u;	//<uint8_t> (版本>=0)
	private $payInfoList_u;	//<uint8_t> (版本>=0)
	private $wuliuInfoList_u;	//<uint8_t> (版本>=0)
	private $recvFeeInfoList_u;	//<uint8_t> (版本>=0)
	private $refundInfoList_u;	//<uint8_t> (版本>=0)
	private $actionLogInfoList_u;	//<uint8_t> (版本>=0)
	private $dealExtInfoMap_u;	//<uint8_t> (版本>=0)
	private $bdealCode;	//<std::string> 交易单编号，即字符串格式的交易单号(版本>=1)
	private $businessBdealId;	//<std::string> 业务交易单号(版本>=1)
	private $siteId;	//<uint32_t> 分站ID(版本>=1)
	private $dealCouponFee;	//<int> 优惠券金额(版本>=1)
	private $cashScore;	//<uint32_t> 现金积分支付值(版本>=1)
	private $promotionScore;	//<uint32_t> 促销积分支付值(版本>=1)
	private $recvRegionCodeExt;	//<std::string> 扩展地区编码(版本>=1)
	private $dealDigest;	//<std::string> 订单摘要(版本>=1)
	private $icsonShippingType;	//<std::string> 易迅配送方式(版本>=1)
	private $icsonPayType;	//<std::string> 易迅支付方式(版本>=1)
	private $icsonAccount;	//<std::string> 易迅内部帐号ID(版本>=1)
	private $icsonMasterLs;	//<std::string> 易迅跟踪信息(版本>=1)
	private $icsonRate;	//<std::string> 易迅平衡比率(版本>=1)
	private $icsonBankRate;	//<std::string> 易迅银行利率(版本>=1)
	private $icsonShopId;	//<std::string> 易迅店铺id(版本>=1)
	private $icsonShopGuideId;	//<std::string> 易迅店铺导购id(版本>=1)
	private $icsonShopGuideCost;	//<std::string> 易迅店铺导购费用(版本>=1)
	private $icsonShopGuideName;	//<std::string> 易迅店铺导购名称(版本>=1)
	private $icsonSubsidyType;	//<std::string> 易迅节能补贴类型(版本>=1)
	private $icsonSubsidyName;	//<std::string> 易迅节能补贴姓名(版本>=1)
	private $icsonSubsidyIdCard;	//<std::string> 易迅节能补贴身份证(版本>=1)
	private $icsonCSOrderOperatorId;	//<std::string> 易迅客服下单操作员ID(版本>=1)
	private $icsonCSOrderOperatorName;	//<std::string> 易迅客服下单操作员名称(版本>=1)
	private $icsonInvoiceCompanyName;	//<std::string> 易迅发票公司名称(版本>=1)
	private $icsonInvoiceCompanyAddr;	//<std::string> 易迅发票公司地址(版本>=1)
	private $icsonInvoiceCompanyPhone;	//<std::string> 易迅发票公司电话(版本>=1)
	private $icsonInvoiceCompanyTaxNo;	//<std::string> 易迅发票公司税号(版本>=1)
	private $icsonInvoiceCompanyBankNo;	//<std::string> 易迅发票公司银行账户(版本>=1)
	private $icsonInvoiceCompanyBankName;	//<std::string> 易迅发票公司银行名称(版本>=1)
	private $icsonInvoiceRecvName;	//<std::string> 易迅发票收货人(版本>=1)
	private $icsonInvoiceRecvAddr;	//<std::string> 易迅发票收货地址(版本>=1)
	private $icsonInvoiceRecvRegionId;	//<std::string> 易迅发票收货地址ID(版本>=1)
	private $icsonInvoiceRecvMobile;	//<std::string> 易迅发票收货手机(版本>=1)
	private $icsonInvoiceRecvTel;	//<std::string> 易迅发票收货电话(版本>=1)
	private $icsonInvoiceRecvZip;	//<std::string> 易迅发票收货邮编(版本>=1)
	private $icsonInvoiceShipType;	//<std::string> 易迅发票配送方式(版本>=1)
	private $icsonInvoiceShipFee;	//<std::string> 易迅发票配送费用(版本>=1)
	private $icsonDealFlag;	//<std::string> 易迅订单flag(版本>=1)
	private $icsonStockNo;	//<std::string> 易迅订单物流仓库编号(版本>=1)
	private $bdealCode_u;	//<uint8_t> (版本>=1)
	private $businessBdealId_u;	//<uint8_t> (版本>=1)
	private $siteId_u;	//<uint8_t> (版本>=1)
	private $dealCouponFee_u;	//<uint8_t> (版本>=1)
	private $cashScore_u;	//<uint8_t> (版本>=1)
	private $promotionScore_u;	//<uint8_t> (版本>=1)
	private $recvRegionCodeExt_u;	//<uint8_t> (版本>=1)
	private $dealDigest_u;	//<uint8_t> (版本>=1)
	private $icsonShippingType_u;	//<uint8_t> 易迅配送方式UFlag(版本>=1)
	private $icsonPayType_u;	//<uint8_t> 易迅支付方式UFlag(版本>=1)
	private $icsonAccount_u;	//<uint8_t> (版本>=1)
	private $icsonMasterLs_u;	//<uint8_t> (版本>=1)
	private $icsonRate_u;	//<uint8_t> (版本>=1)
	private $icsonBankRate_u;	//<uint8_t> (版本>=1)
	private $icsonShopId_u;	//<uint8_t> (版本>=1)
	private $icsonShopGuideId_u;	//<uint8_t> (版本>=1)
	private $icsonShopGuideCost_u;	//<uint8_t> (版本>=1)
	private $icsonShopGuideName_u;	//<uint8_t> (版本>=1)
	private $icsonSubsidyType_u;	//<uint8_t> (版本>=1)
	private $icsonSubsidyName_u;	//<uint8_t> (版本>=1)
	private $icsonSubsidyIdCard_u;	//<uint8_t> (版本>=1)
	private $icsonCSOrderOperatorId_u;	//<uint8_t> (版本>=1)
	private $icsonCSOrderOperatorName_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceCompanyName_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceCompanyAddr_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceCompanyPhone_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceCompanyTaxNo_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceCompanyBankNo_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceCompanyBankName_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceRecvName_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceRecvAddr_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceRecvRegionId_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceRecvMobile_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceRecvTel_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceRecvZip_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceShipType_u;	//<uint8_t> (版本>=1)
	private $icsonInvoiceShipFee_u;	//<uint8_t> (版本>=1)
	private $icsonDealFlag_u;	//<uint8_t> 易迅订单flag(版本>=1)
	private $icsonStockNo_u;	//<uint8_t> 易迅订单物流仓库编号(版本>=1)
	private $icsonDealCashBack;	//<uint32_t> 订单返现金额(版本>=2)
	private $icsonDealCashBack_u;	//<uint8_t> 订单返现金额UFlag(版本>=2)
	private $icsonDealCode;	//<std::string> 易迅订单号，带10开头(版本>=3)
	private $icsonDealCode_u;	//<uint8_t> 订单返现金额UFlag(版本>=3)
	private $icsonInvoiceStockNo;	//<std::string> 易迅货票分离仓库id(版本>=4)
	private $icsonInvoiceSiteId;	//<std::string> 易迅货票分离分站id(版本>=4)
	private $icsonInvoiceStockNo_u;	//<uint8_t> (版本>=4)
	private $icsonInvoiceSiteId_u;	//<uint8_t> (版本>=4)
	private $sellerCorpId;	//<uint64_t> 易迅联营商家id(版本>=5)
	private $lmsVolume;	//<std::string> 体积(版本>=5)
	private $lmsWeight;	//<std::string> 重量(版本>=5)
	private $lmsLongest;	//<std::string> 最长边(版本>=5)
	private $sellerCorpId_u;	//<uint8_t> (版本>=5)
	private $lmsVolume_u;	//<uint8_t> (版本>=5)
	private $lmsWeight_u;	//<uint8_t> (版本>=5)
	private $lmsLongest_u;	//<uint8_t> (版本>=5)
	private $dealActiveInfoList;	//<ecc::deal::po::CTradeActivePoList> 订单活动列表(版本>=6)
	private $dealActiveInfoList_u;	//<uint8_t> (版本>=6)

	function __construct(){
		$this->version = 6;	//<uint16_t>
		$this->dealId = "";	//<std::string>
		$this->dealId64 = 0;	//<uint64_t>
		$this->bdealId = 0;	//<uint64_t>
		$this->businessDealId = "";	//<std::string>
		$this->buyerId = 0;	//<uint64_t>
		$this->buyerAccount = "";	//<std::string>
		$this->buyerNickName = "";	//<std::string>
		$this->buyerNick = "";	//<std::string>
		$this->sellerId = 0;	//<uint64_t>
		$this->sellerTitle = "";	//<std::string>
		$this->sellerNick = "";	//<std::string>
		$this->businessId = 0;	//<uint32_t>
		$this->dealType = 0;	//<uint8_t>
		$this->dealSource = 0;	//<uint32_t>
		$this->dealPayType = 0;	//<uint8_t>
		$this->dealState = 0;	//<uint32_t>
		$this->preDealState = 0;	//<uint32_t>
		$this->dealProperty = 0;	//<uint32_t>
		$this->dealProperty1 = 0;	//<uint32_t>
		$this->dealProperty2 = 0;	//<uint32_t>
		$this->dealProperty3 = 0;	//<uint32_t>
		$this->dealProperty4 = 0;	//<uint32_t>
		$this->refundState = 0;	//<uint32_t>
		$this->evalState = 0;	//<uint32_t>
		$this->itemSkuidList = "";	//<std::string>
		$this->itemTitleList = "";	//<std::string>
		$this->dealTotalFee = 0;	//<uint32_t>
		$this->dealAdjustFee = 0;	//<int>
		$this->dealPayment = 0;	//<uint32_t>
		$this->dealDownPayment = 0;	//<uint32_t>
		$this->dealDiscountTotal = 0;	//<int>
		$this->dealItemTotalFee = 0;	//<uint32_t>
		$this->dealWhoPayShippingFee = 0;	//<uint32_t>
		$this->dealShippingFee = 0;	//<uint32_t>
		$this->dealWhoPayCodFee = 0;	//<uint32_t>
		$this->dealCodFee = 0;	//<uint32_t>
		$this->dealWhoPayInsuranceFee = 0;	//<uint32_t>
		$this->dealInsuranceFee = 0;	//<uint32_t>
		$this->dealSysAdjustFee = 0;	//<int>
		$this->dealRefundTotalFee = 0;	//<uint32_t>
		$this->payScore = 0;	//<uint32_t>
		$this->obtainScore = 0;	//<uint32_t>
		$this->dealGenTime = 0;	//<uint32_t>
		$this->sendFromDesc = "";	//<std::string>
		$this->dealSeq = 0;	//<uint64_t>
		$this->dealMd5 = 0;	//<uint64_t>
		$this->dealIp = "";	//<std::string>
		$this->dealRefer = "";	//<std::string>
		$this->dealVisitKey = "";	//<std::string>
		$this->promotionDesc = "";	//<std::string>
		$this->recvName = "";	//<std::string>
		$this->recvRegionCode = 0;	//<uint32_t>
		$this->recvAddress = "";	//<std::string>
		$this->recvPostCode = "";	//<std::string>
		$this->recvPhone = "";	//<std::string>
		$this->recvMobile = 0;	//<uint64_t>
		$this->expectRecvTime = 0;	//<uint32_t>
		$this->expectRecvTimeSpan = "";	//<std::string>
		$this->recvRemark = "";	//<std::string>
		$this->recvMask = 0;	//<uint32_t>
		$this->expressType = 0;	//<uint8_t>
		$this->expressCompanyID = "";	//<std::string>
		$this->expressCompanyName = "";	//<std::string>
		$this->expressDealID = "";	//<std::string>
		$this->expectArriveDays = 0;	//<uint16_t>
		$this->wuliuDealId = "";	//<std::string>
		$this->invoiceType = 0;	//<uint8_t>
		$this->invoiceHead = "";	//<std::string>
		$this->invoiceContent = "";	//<std::string>
		$this->payAccount = "";	//<std::string>
		$this->cftDealId = "";	//<std::string>
		$this->dealPayTime = 0;	//<uint32_t>
		$this->dealPayReturnTime = 0;	//<uint32_t>
		$this->dealCheckTime = 0;	//<uint32_t>
		$this->dealCheckVersion = 0;	//<uint32_t>
		$this->dealCheckDesc = "";	//<std::string>
		$this->dealSellerSendTime = 0;	//<uint32_t>
		$this->dealConsignTime = 0;	//<uint32_t>
		$this->dealConfirmRecvTime = 0;	//<uint32_t>
		$this->dealEndTime = 0;	//<uint32_t>
		$this->dealRecvFeeTime = 0;	//<uint32_t>
		$this->dealRecvFeeReturnTime = 0;	//<uint32_t>
		$this->dealBuyerRecvFee = 0;	//<uint32_t>
		$this->dealSellerRecvFee = 0;	//<uint32_t>
		$this->dealPayCash = 0;	//<uint32_t>
		$this->dealPayTicket = 0;	//<uint32_t>
		$this->dealPayCredit = 0;	//<uint32_t>
		$this->dealPayOther = 0;	//<uint32_t>
		$this->delayConfirmDays = 0;	//<uint32_t>
		$this->buyerTag = 0;	//<uint8_t>
		$this->buyerNote = "";	//<std::string>
		$this->sellerTag = 0;	//<uint8_t>
		$this->sellerNote = "";	//<std::string>
		$this->dataVersion = 0;	//<uint32_t>
		$this->delFlag = 0;	//<uint32_t>
		$this->visibleState = 0;	//<uint32_t>
		$this->lastUpdateTime = 0;	//<uint32_t>
		$this->tradeInfoList = new \ecc\deal\po\TradePoList();	//<ecc::deal::po::CTradePoList>
		$this->payInfoList = new \ecc\deal\po\PayInfoPoList();	//<ecc::deal::po::CPayInfoPoList>
		$this->wuliuInfoList = new \ecc\deal\po\DealWuliuPoList();	//<ecc::deal::po::CDealWuliuPoList>
		$this->recvFeeInfoList = new \ecc\deal\po\RecvFeePoList();	//<ecc::deal::po::CRecvFeePoList>
		$this->refundInfoList = new \ecc\deal\po\DealRefundPoList();	//<ecc::deal::po::CDealRefundPoList>
		$this->actionLogInfoList = new \ecc\deal\po\DealActionLogPoList();	//<ecc::deal::po::CDealActionLogPoList>
		$this->dealExtInfoMap = new \stl_multimap2('uint32_t,stl_string');	//<std::multimap<uint32_t,std::string> >
		$this->version_u = 0;	//<uint8_t>
		$this->dealId_u = 0;	//<uint8_t>
		$this->dealId64_u = 0;	//<uint8_t>
		$this->bdealId_u = 0;	//<uint8_t>
		$this->businessDealId_u = 0;	//<uint8_t>
		$this->buyerId_u = 0;	//<uint8_t>
		$this->buyerAccount_u = 0;	//<uint8_t>
		$this->buyerNickName_u = 0;	//<uint8_t>
		$this->buyerNick_u = 0;	//<uint8_t>
		$this->sellerId_u = 0;	//<uint8_t>
		$this->sellerTitle_u = 0;	//<uint8_t>
		$this->sellerNick_u = 0;	//<uint8_t>
		$this->businessId_u = 0;	//<uint8_t>
		$this->dealType_u = 0;	//<uint8_t>
		$this->dealSource_u = 0;	//<uint8_t>
		$this->dealPayType_u = 0;	//<uint8_t>
		$this->dealState_u = 0;	//<uint8_t>
		$this->preDealState_u = 0;	//<uint8_t>
		$this->dealProperty_u = 0;	//<uint8_t>
		$this->dealProperty1_u = 0;	//<uint8_t>
		$this->dealProperty2_u = 0;	//<uint8_t>
		$this->dealProperty3_u = 0;	//<uint8_t>
		$this->dealProperty4_u = 0;	//<uint8_t>
		$this->refundState_u = 0;	//<uint8_t>
		$this->evalState_u = 0;	//<uint8_t>
		$this->itemSkuidList_u = 0;	//<uint8_t>
		$this->itemTitleList_u = 0;	//<uint8_t>
		$this->dealTotalFee_u = 0;	//<uint8_t>
		$this->dealAdjustFee_u = 0;	//<uint8_t>
		$this->dealPayment_u = 0;	//<uint8_t>
		$this->dealDownPayment_u = 0;	//<uint8_t>
		$this->dealDiscountTotal_u = 0;	//<uint8_t>
		$this->dealItemTotalFee_u = 0;	//<uint8_t>
		$this->dealWhoPayShippingFee_u = 0;	//<uint8_t>
		$this->dealShippingFee_u = 0;	//<uint8_t>
		$this->dealWhoPayCodFee_u = 0;	//<uint8_t>
		$this->dealCodFee_u = 0;	//<uint8_t>
		$this->dealWhoPayInsuranceFee_u = 0;	//<uint8_t>
		$this->dealInsuranceFee_u = 0;	//<uint8_t>
		$this->dealSysAdjustFee_u = 0;	//<uint8_t>
		$this->dealRefundTotalFee_u = 0;	//<uint8_t>
		$this->payScore_u = 0;	//<uint8_t>
		$this->obtainScore_u = 0;	//<uint8_t>
		$this->dealGenTime_u = 0;	//<uint8_t>
		$this->sendFromDesc_u = 0;	//<uint8_t>
		$this->dealSeq_u = 0;	//<uint8_t>
		$this->dealMd5_u = 0;	//<uint8_t>
		$this->dealIp_u = 0;	//<uint8_t>
		$this->dealRefer_u = 0;	//<uint8_t>
		$this->dealVisitKey_u = 0;	//<uint8_t>
		$this->promotionDesc_u = 0;	//<uint8_t>
		$this->recvName_u = 0;	//<uint8_t>
		$this->recvRegionCode_u = 0;	//<uint8_t>
		$this->recvAddress_u = 0;	//<uint8_t>
		$this->recvPostCode_u = 0;	//<uint8_t>
		$this->recvPhone_u = 0;	//<uint8_t>
		$this->recvMobile_u = 0;	//<uint8_t>
		$this->expectRecvTime_u = 0;	//<uint8_t>
		$this->expectRecvTimeSpan_u = 0;	//<uint8_t>
		$this->recvRemark_u = 0;	//<uint8_t>
		$this->recvMask_u = 0;	//<uint8_t>
		$this->expressType_u = 0;	//<uint8_t>
		$this->expressCompanyID_u = 0;	//<uint8_t>
		$this->expressCompanyName_u = 0;	//<uint8_t>
		$this->expressDealID_u = 0;	//<uint8_t>
		$this->expectArriveDays_u = 0;	//<uint8_t>
		$this->wuliuDealId_u = 0;	//<uint8_t>
		$this->invoiceType_u = 0;	//<uint8_t>
		$this->invoiceHead_u = 0;	//<uint8_t>
		$this->invoiceContent_u = 0;	//<uint8_t>
		$this->payAccount_u = 0;	//<uint8_t>
		$this->cftDealId_u = 0;	//<uint8_t>
		$this->dealPayTime_u = 0;	//<uint8_t>
		$this->dealPayReturnTime_u = 0;	//<uint8_t>
		$this->dealCheckTime_u = 0;	//<uint8_t>
		$this->dealCheckVersion_u = 0;	//<uint8_t>
		$this->dealCheckDesc_u = 0;	//<uint8_t>
		$this->dealSellerSendTime_u = 0;	//<uint8_t>
		$this->dealConsignTime_u = 0;	//<uint8_t>
		$this->dealConfirmRecvTime_u = 0;	//<uint8_t>
		$this->dealEndTime_u = 0;	//<uint8_t>
		$this->dealRecvFeeTime_u = 0;	//<uint8_t>
		$this->dealRecvFeeReturnTime_u = 0;	//<uint8_t>
		$this->dealBuyerRecvFee_u = 0;	//<uint8_t>
		$this->dealSellerRecvFee_u = 0;	//<uint8_t>
		$this->dealPayCash_u = 0;	//<uint8_t>
		$this->dealPayTicket_u = 0;	//<uint8_t>
		$this->dealPayCredit_u = 0;	//<uint8_t>
		$this->dealPayOther_u = 0;	//<uint8_t>
		$this->delayConfirmDays_u = 0;	//<uint8_t>
		$this->buyerTag_u = 0;	//<uint8_t>
		$this->buyerNote_u = 0;	//<uint8_t>
		$this->sellerTag_u = 0;	//<uint8_t>
		$this->sellerNote_u = 0;	//<uint8_t>
		$this->dataVersion_u = 0;	//<uint8_t>
		$this->delFlag_u = 0;	//<uint8_t>
		$this->visibleState_u = 0;	//<uint8_t>
		$this->lastUpdateTime_u = 0;	//<uint8_t>
		$this->tradeInfoList_u = 0;	//<uint8_t>
		$this->payInfoList_u = 0;	//<uint8_t>
		$this->wuliuInfoList_u = 0;	//<uint8_t>
		$this->recvFeeInfoList_u = 0;	//<uint8_t>
		$this->refundInfoList_u = 0;	//<uint8_t>
		$this->actionLogInfoList_u = 0;	//<uint8_t>
		$this->dealExtInfoMap_u = 0;	//<uint8_t>
		$this->bdealCode = "";	//<std::string>
		$this->businessBdealId = "";	//<std::string>
		$this->siteId = 0;	//<uint32_t>
		$this->dealCouponFee = 0;	//<int>
		$this->cashScore = 0;	//<uint32_t>
		$this->promotionScore = 0;	//<uint32_t>
		$this->recvRegionCodeExt = "";	//<std::string>
		$this->dealDigest = "";	//<std::string>
		$this->icsonShippingType = "";	//<std::string>
		$this->icsonPayType = "";	//<std::string>
		$this->icsonAccount = "";	//<std::string>
		$this->icsonMasterLs = "";	//<std::string>
		$this->icsonRate = "";	//<std::string>
		$this->icsonBankRate = "";	//<std::string>
		$this->icsonShopId = "";	//<std::string>
		$this->icsonShopGuideId = "";	//<std::string>
		$this->icsonShopGuideCost = "";	//<std::string>
		$this->icsonShopGuideName = "";	//<std::string>
		$this->icsonSubsidyType = "";	//<std::string>
		$this->icsonSubsidyName = "";	//<std::string>
		$this->icsonSubsidyIdCard = "";	//<std::string>
		$this->icsonCSOrderOperatorId = "";	//<std::string>
		$this->icsonCSOrderOperatorName = "";	//<std::string>
		$this->icsonInvoiceCompanyName = "";	//<std::string>
		$this->icsonInvoiceCompanyAddr = "";	//<std::string>
		$this->icsonInvoiceCompanyPhone = "";	//<std::string>
		$this->icsonInvoiceCompanyTaxNo = "";	//<std::string>
		$this->icsonInvoiceCompanyBankNo = "";	//<std::string>
		$this->icsonInvoiceCompanyBankName = "";	//<std::string>
		$this->icsonInvoiceRecvName = "";	//<std::string>
		$this->icsonInvoiceRecvAddr = "";	//<std::string>
		$this->icsonInvoiceRecvRegionId = "";	//<std::string>
		$this->icsonInvoiceRecvMobile = "";	//<std::string>
		$this->icsonInvoiceRecvTel = "";	//<std::string>
		$this->icsonInvoiceRecvZip = "";	//<std::string>
		$this->icsonInvoiceShipType = "";	//<std::string>
		$this->icsonInvoiceShipFee = "";	//<std::string>
		$this->icsonDealFlag = "";	//<std::string>
		$this->icsonStockNo = "";	//<std::string>
		$this->bdealCode_u = 0;	//<uint8_t>
		$this->businessBdealId_u = 0;	//<uint8_t>
		$this->siteId_u = 0;	//<uint8_t>
		$this->dealCouponFee_u = 0;	//<uint8_t>
		$this->cashScore_u = 0;	//<uint8_t>
		$this->promotionScore_u = 0;	//<uint8_t>
		$this->recvRegionCodeExt_u = 0;	//<uint8_t>
		$this->dealDigest_u = 0;	//<uint8_t>
		$this->icsonShippingType_u = 0;	//<uint8_t>
		$this->icsonPayType_u = 0;	//<uint8_t>
		$this->icsonAccount_u = 0;	//<uint8_t>
		$this->icsonMasterLs_u = 0;	//<uint8_t>
		$this->icsonRate_u = 0;	//<uint8_t>
		$this->icsonBankRate_u = 0;	//<uint8_t>
		$this->icsonShopId_u = 0;	//<uint8_t>
		$this->icsonShopGuideId_u = 0;	//<uint8_t>
		$this->icsonShopGuideCost_u = 0;	//<uint8_t>
		$this->icsonShopGuideName_u = 0;	//<uint8_t>
		$this->icsonSubsidyType_u = 0;	//<uint8_t>
		$this->icsonSubsidyName_u = 0;	//<uint8_t>
		$this->icsonSubsidyIdCard_u = 0;	//<uint8_t>
		$this->icsonCSOrderOperatorId_u = 0;	//<uint8_t>
		$this->icsonCSOrderOperatorName_u = 0;	//<uint8_t>
		$this->icsonInvoiceCompanyName_u = 0;	//<uint8_t>
		$this->icsonInvoiceCompanyAddr_u = 0;	//<uint8_t>
		$this->icsonInvoiceCompanyPhone_u = 0;	//<uint8_t>
		$this->icsonInvoiceCompanyTaxNo_u = 0;	//<uint8_t>
		$this->icsonInvoiceCompanyBankNo_u = 0;	//<uint8_t>
		$this->icsonInvoiceCompanyBankName_u = 0;	//<uint8_t>
		$this->icsonInvoiceRecvName_u = 0;	//<uint8_t>
		$this->icsonInvoiceRecvAddr_u = 0;	//<uint8_t>
		$this->icsonInvoiceRecvRegionId_u = 0;	//<uint8_t>
		$this->icsonInvoiceRecvMobile_u = 0;	//<uint8_t>
		$this->icsonInvoiceRecvTel_u = 0;	//<uint8_t>
		$this->icsonInvoiceRecvZip_u = 0;	//<uint8_t>
		$this->icsonInvoiceShipType_u = 0;	//<uint8_t>
		$this->icsonInvoiceShipFee_u = 0;	//<uint8_t>
		$this->icsonDealFlag_u = 0;	//<uint8_t>
		$this->icsonStockNo_u = 0;	//<uint8_t>
		$this->icsonDealCashBack = 0;	//<uint32_t>
		$this->icsonDealCashBack_u = 0;	//<uint8_t>
		$this->icsonDealCode = "";	//<std::string>
		$this->icsonDealCode_u = 0;	//<uint8_t>
		$this->icsonInvoiceStockNo = "";	//<std::string>
		$this->icsonInvoiceSiteId = "";	//<std::string>
		$this->icsonInvoiceStockNo_u = 0;	//<uint8_t>
		$this->icsonInvoiceSiteId_u = 0;	//<uint8_t>
		$this->sellerCorpId = 0;	//<uint64_t>
		$this->lmsVolume = "";	//<std::string>
		$this->lmsWeight = "";	//<std::string>
		$this->lmsLongest = "";	//<std::string>
		$this->sellerCorpId_u = 0;	//<uint8_t>
		$this->lmsVolume_u = 0;	//<uint8_t>
		$this->lmsWeight_u = 0;	//<uint8_t>
		$this->lmsLongest_u = 0;	//<uint8_t>
		$this->dealActiveInfoList = new \ecc\deal\po\TradeActivePoList();	//<ecc::deal::po::CTradeActivePoList>
		$this->dealActiveInfoList_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\po\DealPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\DealPo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushString($this->dealId);	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		$bs->pushUint64_t($this->dealId64);	//<uint64_t> 订单单号，统一平台内部单号
		$bs->pushUint64_t($this->bdealId);	//<uint64_t> 交易单号，买卖家一次交易行为描述
		$bs->pushString($this->businessDealId);	//<std::string> 业务订单编号，第三方托管订单
		$bs->pushUint64_t($this->buyerId);	//<uint64_t> 买家ID
		$bs->pushString($this->buyerAccount);	//<std::string> 买家帐号
		$bs->pushString($this->buyerNickName);	//<std::string> 买家姓名
		$bs->pushString($this->buyerNick);	//<std::string> 买家昵称
		$bs->pushUint64_t($this->sellerId);	//<uint64_t> 商家ID
		$bs->pushString($this->sellerTitle);	//<std::string> 商家真实名称
		$bs->pushString($this->sellerNick);	//<std::string> 卖家昵称
		$bs->pushUint32_t($this->businessId);	//<uint32_t> 业务ID
		$bs->pushUint8_t($this->dealType);	//<uint8_t> 订单类型
		$bs->pushUint32_t($this->dealSource);	//<uint32_t> 下单渠道：1：业务主站；2：移动app；3：移动wap
		$bs->pushUint8_t($this->dealPayType);	//<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款
		$bs->pushUint32_t($this->dealState);	//<uint32_t> 订单状态
		$bs->pushUint32_t($this->preDealState);	//<uint32_t> 订单前一个状态
		$bs->pushUint32_t($this->dealProperty);	//<uint32_t> 订单属性值，通用
		$bs->pushUint32_t($this->dealProperty1);	//<uint32_t> 订单属性值，业务1扩展用
		$bs->pushUint32_t($this->dealProperty2);	//<uint32_t> 订单属性值，业务2扩展用
		$bs->pushUint32_t($this->dealProperty3);	//<uint32_t> 订单属性值，业务3扩展用
		$bs->pushUint32_t($this->dealProperty4);	//<uint32_t> 订单属性值，业务4扩展用
		$bs->pushUint32_t($this->refundState);	//<uint32_t> 退款状态, 各子单退款状态的汇总, 0:无退款,1:退款中,2:退款完成
		$bs->pushUint32_t($this->evalState);	//<uint32_t> 评价评论状态
		$bs->pushString($this->itemSkuidList);	//<std::string> 商品skuID列表
		$bs->pushString($this->itemTitleList);	//<std::string> 商品标题列表
		$bs->pushUint32_t($this->dealTotalFee);	//<uint32_t> 订单总金额,下单金额
		$bs->pushInt32_t($this->dealAdjustFee);	//<int> 调价金额
		$bs->pushUint32_t($this->dealPayment);	//<uint32_t> 实付总金额
		$bs->pushUint32_t($this->dealDownPayment);	//<uint32_t> C2B预售定金金额
		$bs->pushInt32_t($this->dealDiscountTotal);	//<int> 优惠总金额
		$bs->pushUint32_t($this->dealItemTotalFee);	//<uint32_t> 商品总金额
		$bs->pushUint32_t($this->dealWhoPayShippingFee);	//<uint32_t> 谁支付邮费，1：卖家；2：买家
		$bs->pushUint32_t($this->dealShippingFee);	//<uint32_t> 邮费金额
		$bs->pushUint32_t($this->dealWhoPayCodFee);	//<uint32_t> 谁承担COD手续费，1：卖家承担；2：买家；3：平台承担
		$bs->pushUint32_t($this->dealCodFee);	//<uint32_t> COD手续额
		$bs->pushUint32_t($this->dealWhoPayInsuranceFee);	//<uint32_t> 谁支付保险费，1：卖家赠送；2：买家；3：平台承担
		$bs->pushUint32_t($this->dealInsuranceFee);	//<uint32_t> 运费保险费
		$bs->pushInt32_t($this->dealSysAdjustFee);	//<int> 系统调价金额，用于区分COD卖家调价金额和用于凑整的COD优惠金额
		$bs->pushUint32_t($this->dealRefundTotalFee);	//<uint32_t> 退款总金额费
		$bs->pushUint32_t($this->payScore);	//<uint32_t> 积分支付值
		$bs->pushUint32_t($this->obtainScore);	//<uint32_t> 获得积分值
		$bs->pushUint32_t($this->dealGenTime);	//<uint32_t> 商品单生成时间
		$bs->pushString($this->sendFromDesc);	//<std::string> 订单发货地描述
		$bs->pushUint64_t($this->dealSeq);	//<uint64_t> 下单时间戳
		$bs->pushUint64_t($this->dealMd5);	//<uint64_t> 下单md5
		$bs->pushString($this->dealIp);	//<std::string> 下单IP
		$bs->pushString($this->dealRefer);	//<std::string> refer
		$bs->pushString($this->dealVisitKey);	//<std::string> visitkey
		$bs->pushString($this->promotionDesc);	//<std::string> 订单促销信息描述
		$bs->pushString($this->recvName);	//<std::string> 收货人
		$bs->pushUint32_t($this->recvRegionCode);	//<uint32_t> 地区编码
		$bs->pushString($this->recvAddress);	//<std::string> 地址
		$bs->pushString($this->recvPostCode);	//<std::string> 邮编
		$bs->pushString($this->recvPhone);	//<std::string> 电话
		$bs->pushUint64_t($this->recvMobile);	//<uint64_t> 手机
		$bs->pushUint32_t($this->expectRecvTime);	//<uint32_t> 期望收货时间,天
		$bs->pushString($this->expectRecvTimeSpan);	//<std::string> 期望收货时段
		$bs->pushString($this->recvRemark);	//<std::string> 收货附言
		$bs->pushUint32_t($this->recvMask);	//<uint32_t> 收货属性值
		$bs->pushUint8_t($this->expressType);	//<uint8_t> 配送方式；1：平邮；2：快递；3：EMS；4：B2C自建物流；5：用户配送点自提
		$bs->pushString($this->expressCompanyID);	//<std::string> 物流公司ID
		$bs->pushString($this->expressCompanyName);	//<std::string> 物流公司名称
		$bs->pushString($this->expressDealID);	//<std::string> 物流公司订单号
		$bs->pushUint16_t($this->expectArriveDays);	//<uint16_t> 预计到达天数
		$bs->pushString($this->wuliuDealId);	//<std::string> 物流订单号，物流系统物流单
		$bs->pushUint8_t($this->invoiceType);	//<uint8_t> 发票类型
		$bs->pushString($this->invoiceHead);	//<std::string> 发票抬头
		$bs->pushString($this->invoiceContent);	//<std::string> 发票内容
		$bs->pushString($this->payAccount);	//<std::string> 支付帐号
		$bs->pushString($this->cftDealId);	//<std::string> Cft支付单号
		$bs->pushUint32_t($this->dealPayTime);	//<uint32_t> 付款完成时间
		$bs->pushUint32_t($this->dealPayReturnTime);	//<uint32_t> 付款返回时间
		$bs->pushUint32_t($this->dealCheckTime);	//<uint32_t> 审核时间
		$bs->pushUint32_t($this->dealCheckVersion);	//<uint32_t> 审核版本号
		$bs->pushString($this->dealCheckDesc);	//<std::string> 审核描述
		$bs->pushUint32_t($this->dealSellerSendTime);	//<uint32_t> 商家发货时间
		$bs->pushUint32_t($this->dealConsignTime);	//<uint32_t> 标记发货时间
		$bs->pushUint32_t($this->dealConfirmRecvTime);	//<uint32_t> 签收时间
		$bs->pushUint32_t($this->dealEndTime);	//<uint32_t> 结束时间
		$bs->pushUint32_t($this->dealRecvFeeTime);	//<uint32_t> 打款完成时间
		$bs->pushUint32_t($this->dealRecvFeeReturnTime);	//<uint32_t> 打款返回时间
		$bs->pushUint32_t($this->dealBuyerRecvFee);	//<uint32_t> 打款买家总金额
		$bs->pushUint32_t($this->dealSellerRecvFee);	//<uint32_t> 打款卖家总金额
		$bs->pushUint32_t($this->dealPayCash);	//<uint32_t> 支付现金金额
		$bs->pushUint32_t($this->dealPayTicket);	//<uint32_t> 支付财付券金额
		$bs->pushUint32_t($this->dealPayCredit);	//<uint32_t> 支付积分金额
		$bs->pushUint32_t($this->dealPayOther);	//<uint32_t> 其他支付金额
		$bs->pushUint32_t($this->delayConfirmDays);	//<uint32_t> 延长确认收货天数
		$bs->pushUint8_t($this->buyerTag);	//<uint8_t> 买家标记
		$bs->pushString($this->buyerNote);	//<std::string> 买家备注
		$bs->pushUint8_t($this->sellerTag);	//<uint8_t> 卖家标记
		$bs->pushString($this->sellerNote);	//<std::string> 卖家备注
		$bs->pushUint32_t($this->dataVersion);	//<uint32_t> 数据版本号
		$bs->pushUint32_t($this->delFlag);	//<uint32_t> 订单有效标记
		$bs->pushUint32_t($this->visibleState);	//<uint32_t> 可见标识
		$bs->pushUint32_t($this->lastUpdateTime);	//<uint32_t> 最后更新时间
		$bs->pushObject($this->tradeInfoList,'\ecc\deal\po\TradePoList');	//<ecc::deal::po::CTradePoList> 商品子单列表
		$bs->pushObject($this->payInfoList,'\ecc\deal\po\PayInfoPoList');	//<ecc::deal::po::CPayInfoPoList> 支付信息表
		$bs->pushObject($this->wuliuInfoList,'\ecc\deal\po\DealWuliuPoList');	//<ecc::deal::po::CDealWuliuPoList> 物流信息表
		$bs->pushObject($this->recvFeeInfoList,'\ecc\deal\po\RecvFeePoList');	//<ecc::deal::po::CRecvFeePoList> 打款信息表
		$bs->pushObject($this->refundInfoList,'\ecc\deal\po\DealRefundPoList');	//<ecc::deal::po::CDealRefundPoList> 退款信息表
		$bs->pushObject($this->actionLogInfoList,'\ecc\deal\po\DealActionLogPoList');	//<ecc::deal::po::CDealActionLogPoList> 流水日志表
		$bs->pushObject($this->dealExtInfoMap,'stl_multimap');	//<std::multimap<uint32_t,std::string> > 订单扩展信息 
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId64_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->businessDealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerAccount_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerNickName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerNick_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerTitle_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerNick_u);	//<uint8_t> 
		$bs->pushUint8_t($this->businessId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealSource_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealPayType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->preDealState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealProperty_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealProperty1_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealProperty2_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealProperty3_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealProperty4_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->evalState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemSkuidList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemTitleList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealTotalFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealAdjustFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealPayment_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealDownPayment_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealDiscountTotal_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealItemTotalFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealWhoPayShippingFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealShippingFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealWhoPayCodFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealCodFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealWhoPayInsuranceFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealInsuranceFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealSysAdjustFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealRefundTotalFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payScore_u);	//<uint8_t> 
		$bs->pushUint8_t($this->obtainScore_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealGenTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sendFromDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealSeq_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealMd5_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealIp_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealRefer_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealVisitKey_u);	//<uint8_t> 
		$bs->pushUint8_t($this->promotionDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvRegionCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvAddress_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvPostCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvPhone_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvMobile_u);	//<uint8_t> 
		$bs->pushUint8_t($this->expectRecvTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->expectRecvTimeSpan_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvRemark_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvMask_u);	//<uint8_t> 
		$bs->pushUint8_t($this->expressType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->expressCompanyID_u);	//<uint8_t> 
		$bs->pushUint8_t($this->expressCompanyName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->expressDealID_u);	//<uint8_t> 
		$bs->pushUint8_t($this->expectArriveDays_u);	//<uint8_t> 
		$bs->pushUint8_t($this->wuliuDealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->invoiceType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->invoiceHead_u);	//<uint8_t> 
		$bs->pushUint8_t($this->invoiceContent_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payAccount_u);	//<uint8_t> 
		$bs->pushUint8_t($this->cftDealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealPayTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealPayReturnTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealCheckTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealCheckVersion_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealCheckDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealSellerSendTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealConsignTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealConfirmRecvTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealEndTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealRecvFeeTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealRecvFeeReturnTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealBuyerRecvFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealSellerRecvFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealPayCash_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealPayTicket_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealPayCredit_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealPayOther_u);	//<uint8_t> 
		$bs->pushUint8_t($this->delayConfirmDays_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerTag_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerNote_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerTag_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerNote_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dataVersion_u);	//<uint8_t> 
		$bs->pushUint8_t($this->delFlag_u);	//<uint8_t> 
		$bs->pushUint8_t($this->visibleState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->lastUpdateTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeInfoList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payInfoList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->wuliuInfoList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvFeeInfoList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundInfoList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->actionLogInfoList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealExtInfoMap_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushString($this->bdealCode);	//<std::string> 交易单编号，即字符串格式的交易单号
		}
		if($this->version >= 1){
			$bs->pushString($this->businessBdealId);	//<std::string> 业务交易单号
		}
		if($this->version >= 1){
			$bs->pushUint32_t($this->siteId);	//<uint32_t> 分站ID
		}
		if($this->version >= 1){
			$bs->pushInt32_t($this->dealCouponFee);	//<int> 优惠券金额
		}
		if($this->version >= 1){
			$bs->pushUint32_t($this->cashScore);	//<uint32_t> 现金积分支付值
		}
		if($this->version >= 1){
			$bs->pushUint32_t($this->promotionScore);	//<uint32_t> 促销积分支付值
		}
		if($this->version >= 1){
			$bs->pushString($this->recvRegionCodeExt);	//<std::string> 扩展地区编码
		}
		if($this->version >= 1){
			$bs->pushString($this->dealDigest);	//<std::string> 订单摘要
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonShippingType);	//<std::string> 易迅配送方式
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonPayType);	//<std::string> 易迅支付方式
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonAccount);	//<std::string> 易迅内部帐号ID
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonMasterLs);	//<std::string> 易迅跟踪信息
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonRate);	//<std::string> 易迅平衡比率
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonBankRate);	//<std::string> 易迅银行利率
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonShopId);	//<std::string> 易迅店铺id
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonShopGuideId);	//<std::string> 易迅店铺导购id
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonShopGuideCost);	//<std::string> 易迅店铺导购费用
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonShopGuideName);	//<std::string> 易迅店铺导购名称
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonSubsidyType);	//<std::string> 易迅节能补贴类型
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonSubsidyName);	//<std::string> 易迅节能补贴姓名
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonSubsidyIdCard);	//<std::string> 易迅节能补贴身份证
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSOrderOperatorId);	//<std::string> 易迅客服下单操作员ID
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSOrderOperatorName);	//<std::string> 易迅客服下单操作员名称
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceCompanyName);	//<std::string> 易迅发票公司名称
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceCompanyAddr);	//<std::string> 易迅发票公司地址
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceCompanyPhone);	//<std::string> 易迅发票公司电话
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceCompanyTaxNo);	//<std::string> 易迅发票公司税号
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceCompanyBankNo);	//<std::string> 易迅发票公司银行账户
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceCompanyBankName);	//<std::string> 易迅发票公司银行名称
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceRecvName);	//<std::string> 易迅发票收货人
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceRecvAddr);	//<std::string> 易迅发票收货地址
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceRecvRegionId);	//<std::string> 易迅发票收货地址ID
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceRecvMobile);	//<std::string> 易迅发票收货手机
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceRecvTel);	//<std::string> 易迅发票收货电话
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceRecvZip);	//<std::string> 易迅发票收货邮编
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceShipType);	//<std::string> 易迅发票配送方式
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonInvoiceShipFee);	//<std::string> 易迅发票配送费用
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonDealFlag);	//<std::string> 易迅订单flag
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonStockNo);	//<std::string> 易迅订单物流仓库编号
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->bdealCode_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->businessBdealId_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->siteId_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->dealCouponFee_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->cashScore_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->promotionScore_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->recvRegionCodeExt_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->dealDigest_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonShippingType_u);	//<uint8_t> 易迅配送方式UFlag
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonPayType_u);	//<uint8_t> 易迅支付方式UFlag
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonAccount_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonMasterLs_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonRate_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonBankRate_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonShopId_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonShopGuideId_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonShopGuideCost_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonShopGuideName_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonSubsidyType_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonSubsidyName_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonSubsidyIdCard_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSOrderOperatorId_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSOrderOperatorName_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceCompanyName_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceCompanyAddr_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceCompanyPhone_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceCompanyTaxNo_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceCompanyBankNo_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceCompanyBankName_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceRecvName_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceRecvAddr_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceRecvRegionId_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceRecvMobile_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceRecvTel_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceRecvZip_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceShipType_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonInvoiceShipFee_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonDealFlag_u);	//<uint8_t> 易迅订单flag
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonStockNo_u);	//<uint8_t> 易迅订单物流仓库编号
		}
		if($this->version >= 2){
			$bs->pushUint32_t($this->icsonDealCashBack);	//<uint32_t> 订单返现金额
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->icsonDealCashBack_u);	//<uint8_t> 订单返现金额UFlag
		}
		if($this->version >= 3){
			$bs->pushString($this->icsonDealCode);	//<std::string> 易迅订单号，带10开头
		}
		if($this->version >= 3){
			$bs->pushUint8_t($this->icsonDealCode_u);	//<uint8_t> 订单返现金额UFlag
		}
		if($this->version >= 4){
			$bs->pushString($this->icsonInvoiceStockNo);	//<std::string> 易迅货票分离仓库id
		}
		if($this->version >= 4){
			$bs->pushString($this->icsonInvoiceSiteId);	//<std::string> 易迅货票分离分站id
		}
		if($this->version >= 4){
			$bs->pushUint8_t($this->icsonInvoiceStockNo_u);	//<uint8_t> 
		}
		if($this->version >= 4){
			$bs->pushUint8_t($this->icsonInvoiceSiteId_u);	//<uint8_t> 
		}
		if($this->version >= 5){
			$bs->pushUint64_t($this->sellerCorpId);	//<uint64_t> 易迅联营商家id
		}
		if($this->version >= 5){
			$bs->pushString($this->lmsVolume);	//<std::string> 体积
		}
		if($this->version >= 5){
			$bs->pushString($this->lmsWeight);	//<std::string> 重量
		}
		if($this->version >= 5){
			$bs->pushString($this->lmsLongest);	//<std::string> 最长边
		}
		if($this->version >= 5){
			$bs->pushUint8_t($this->sellerCorpId_u);	//<uint8_t> 
		}
		if($this->version >= 5){
			$bs->pushUint8_t($this->lmsVolume_u);	//<uint8_t> 
		}
		if($this->version >= 5){
			$bs->pushUint8_t($this->lmsWeight_u);	//<uint8_t> 
		}
		if($this->version >= 5){
			$bs->pushUint8_t($this->lmsLongest_u);	//<uint8_t> 
		}
		if($this->version >= 6){
			$bs->pushObject($this->dealActiveInfoList,'\ecc\deal\po\TradeActivePoList');	//<ecc::deal::po::CTradeActivePoList> 订单活动列表
		}
		if($this->version >= 6){
			$bs->pushUint8_t($this->dealActiveInfoList_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['dealId'] = $bs->popString();	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		$this->_arr_value['dealId64'] = $bs->popUint64_t();	//<uint64_t> 订单单号，统一平台内部单号
		$this->_arr_value['bdealId'] = $bs->popUint64_t();	//<uint64_t> 交易单号，买卖家一次交易行为描述
		$this->_arr_value['businessDealId'] = $bs->popString();	//<std::string> 业务订单编号，第三方托管订单
		$this->_arr_value['buyerId'] = $bs->popUint64_t();	//<uint64_t> 买家ID
		$this->_arr_value['buyerAccount'] = $bs->popString();	//<std::string> 买家帐号
		$this->_arr_value['buyerNickName'] = $bs->popString();	//<std::string> 买家姓名
		$this->_arr_value['buyerNick'] = $bs->popString();	//<std::string> 买家昵称
		$this->_arr_value['sellerId'] = $bs->popUint64_t();	//<uint64_t> 商家ID
		$this->_arr_value['sellerTitle'] = $bs->popString();	//<std::string> 商家真实名称
		$this->_arr_value['sellerNick'] = $bs->popString();	//<std::string> 卖家昵称
		$this->_arr_value['businessId'] = $bs->popUint32_t();	//<uint32_t> 业务ID
		$this->_arr_value['dealType'] = $bs->popUint8_t();	//<uint8_t> 订单类型
		$this->_arr_value['dealSource'] = $bs->popUint32_t();	//<uint32_t> 下单渠道：1：业务主站；2：移动app；3：移动wap
		$this->_arr_value['dealPayType'] = $bs->popUint8_t();	//<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款
		$this->_arr_value['dealState'] = $bs->popUint32_t();	//<uint32_t> 订单状态
		$this->_arr_value['preDealState'] = $bs->popUint32_t();	//<uint32_t> 订单前一个状态
		$this->_arr_value['dealProperty'] = $bs->popUint32_t();	//<uint32_t> 订单属性值，通用
		$this->_arr_value['dealProperty1'] = $bs->popUint32_t();	//<uint32_t> 订单属性值，业务1扩展用
		$this->_arr_value['dealProperty2'] = $bs->popUint32_t();	//<uint32_t> 订单属性值，业务2扩展用
		$this->_arr_value['dealProperty3'] = $bs->popUint32_t();	//<uint32_t> 订单属性值，业务3扩展用
		$this->_arr_value['dealProperty4'] = $bs->popUint32_t();	//<uint32_t> 订单属性值，业务4扩展用
		$this->_arr_value['refundState'] = $bs->popUint32_t();	//<uint32_t> 退款状态, 各子单退款状态的汇总, 0:无退款,1:退款中,2:退款完成
		$this->_arr_value['evalState'] = $bs->popUint32_t();	//<uint32_t> 评价评论状态
		$this->_arr_value['itemSkuidList'] = $bs->popString();	//<std::string> 商品skuID列表
		$this->_arr_value['itemTitleList'] = $bs->popString();	//<std::string> 商品标题列表
		$this->_arr_value['dealTotalFee'] = $bs->popUint32_t();	//<uint32_t> 订单总金额,下单金额
		$this->_arr_value['dealAdjustFee'] = $bs->popInt32_t();	//<int> 调价金额
		$this->_arr_value['dealPayment'] = $bs->popUint32_t();	//<uint32_t> 实付总金额
		$this->_arr_value['dealDownPayment'] = $bs->popUint32_t();	//<uint32_t> C2B预售定金金额
		$this->_arr_value['dealDiscountTotal'] = $bs->popInt32_t();	//<int> 优惠总金额
		$this->_arr_value['dealItemTotalFee'] = $bs->popUint32_t();	//<uint32_t> 商品总金额
		$this->_arr_value['dealWhoPayShippingFee'] = $bs->popUint32_t();	//<uint32_t> 谁支付邮费，1：卖家；2：买家
		$this->_arr_value['dealShippingFee'] = $bs->popUint32_t();	//<uint32_t> 邮费金额
		$this->_arr_value['dealWhoPayCodFee'] = $bs->popUint32_t();	//<uint32_t> 谁承担COD手续费，1：卖家承担；2：买家；3：平台承担
		$this->_arr_value['dealCodFee'] = $bs->popUint32_t();	//<uint32_t> COD手续额
		$this->_arr_value['dealWhoPayInsuranceFee'] = $bs->popUint32_t();	//<uint32_t> 谁支付保险费，1：卖家赠送；2：买家；3：平台承担
		$this->_arr_value['dealInsuranceFee'] = $bs->popUint32_t();	//<uint32_t> 运费保险费
		$this->_arr_value['dealSysAdjustFee'] = $bs->popInt32_t();	//<int> 系统调价金额，用于区分COD卖家调价金额和用于凑整的COD优惠金额
		$this->_arr_value['dealRefundTotalFee'] = $bs->popUint32_t();	//<uint32_t> 退款总金额费
		$this->_arr_value['payScore'] = $bs->popUint32_t();	//<uint32_t> 积分支付值
		$this->_arr_value['obtainScore'] = $bs->popUint32_t();	//<uint32_t> 获得积分值
		$this->_arr_value['dealGenTime'] = $bs->popUint32_t();	//<uint32_t> 商品单生成时间
		$this->_arr_value['sendFromDesc'] = $bs->popString();	//<std::string> 订单发货地描述
		$this->_arr_value['dealSeq'] = $bs->popUint64_t();	//<uint64_t> 下单时间戳
		$this->_arr_value['dealMd5'] = $bs->popUint64_t();	//<uint64_t> 下单md5
		$this->_arr_value['dealIp'] = $bs->popString();	//<std::string> 下单IP
		$this->_arr_value['dealRefer'] = $bs->popString();	//<std::string> refer
		$this->_arr_value['dealVisitKey'] = $bs->popString();	//<std::string> visitkey
		$this->_arr_value['promotionDesc'] = $bs->popString();	//<std::string> 订单促销信息描述
		$this->_arr_value['recvName'] = $bs->popString();	//<std::string> 收货人
		$this->_arr_value['recvRegionCode'] = $bs->popUint32_t();	//<uint32_t> 地区编码
		$this->_arr_value['recvAddress'] = $bs->popString();	//<std::string> 地址
		$this->_arr_value['recvPostCode'] = $bs->popString();	//<std::string> 邮编
		$this->_arr_value['recvPhone'] = $bs->popString();	//<std::string> 电话
		$this->_arr_value['recvMobile'] = $bs->popUint64_t();	//<uint64_t> 手机
		$this->_arr_value['expectRecvTime'] = $bs->popUint32_t();	//<uint32_t> 期望收货时间,天
		$this->_arr_value['expectRecvTimeSpan'] = $bs->popString();	//<std::string> 期望收货时段
		$this->_arr_value['recvRemark'] = $bs->popString();	//<std::string> 收货附言
		$this->_arr_value['recvMask'] = $bs->popUint32_t();	//<uint32_t> 收货属性值
		$this->_arr_value['expressType'] = $bs->popUint8_t();	//<uint8_t> 配送方式；1：平邮；2：快递；3：EMS；4：B2C自建物流；5：用户配送点自提
		$this->_arr_value['expressCompanyID'] = $bs->popString();	//<std::string> 物流公司ID
		$this->_arr_value['expressCompanyName'] = $bs->popString();	//<std::string> 物流公司名称
		$this->_arr_value['expressDealID'] = $bs->popString();	//<std::string> 物流公司订单号
		$this->_arr_value['expectArriveDays'] = $bs->popUint16_t();	//<uint16_t> 预计到达天数
		$this->_arr_value['wuliuDealId'] = $bs->popString();	//<std::string> 物流订单号，物流系统物流单
		$this->_arr_value['invoiceType'] = $bs->popUint8_t();	//<uint8_t> 发票类型
		$this->_arr_value['invoiceHead'] = $bs->popString();	//<std::string> 发票抬头
		$this->_arr_value['invoiceContent'] = $bs->popString();	//<std::string> 发票内容
		$this->_arr_value['payAccount'] = $bs->popString();	//<std::string> 支付帐号
		$this->_arr_value['cftDealId'] = $bs->popString();	//<std::string> Cft支付单号
		$this->_arr_value['dealPayTime'] = $bs->popUint32_t();	//<uint32_t> 付款完成时间
		$this->_arr_value['dealPayReturnTime'] = $bs->popUint32_t();	//<uint32_t> 付款返回时间
		$this->_arr_value['dealCheckTime'] = $bs->popUint32_t();	//<uint32_t> 审核时间
		$this->_arr_value['dealCheckVersion'] = $bs->popUint32_t();	//<uint32_t> 审核版本号
		$this->_arr_value['dealCheckDesc'] = $bs->popString();	//<std::string> 审核描述
		$this->_arr_value['dealSellerSendTime'] = $bs->popUint32_t();	//<uint32_t> 商家发货时间
		$this->_arr_value['dealConsignTime'] = $bs->popUint32_t();	//<uint32_t> 标记发货时间
		$this->_arr_value['dealConfirmRecvTime'] = $bs->popUint32_t();	//<uint32_t> 签收时间
		$this->_arr_value['dealEndTime'] = $bs->popUint32_t();	//<uint32_t> 结束时间
		$this->_arr_value['dealRecvFeeTime'] = $bs->popUint32_t();	//<uint32_t> 打款完成时间
		$this->_arr_value['dealRecvFeeReturnTime'] = $bs->popUint32_t();	//<uint32_t> 打款返回时间
		$this->_arr_value['dealBuyerRecvFee'] = $bs->popUint32_t();	//<uint32_t> 打款买家总金额
		$this->_arr_value['dealSellerRecvFee'] = $bs->popUint32_t();	//<uint32_t> 打款卖家总金额
		$this->_arr_value['dealPayCash'] = $bs->popUint32_t();	//<uint32_t> 支付现金金额
		$this->_arr_value['dealPayTicket'] = $bs->popUint32_t();	//<uint32_t> 支付财付券金额
		$this->_arr_value['dealPayCredit'] = $bs->popUint32_t();	//<uint32_t> 支付积分金额
		$this->_arr_value['dealPayOther'] = $bs->popUint32_t();	//<uint32_t> 其他支付金额
		$this->_arr_value['delayConfirmDays'] = $bs->popUint32_t();	//<uint32_t> 延长确认收货天数
		$this->_arr_value['buyerTag'] = $bs->popUint8_t();	//<uint8_t> 买家标记
		$this->_arr_value['buyerNote'] = $bs->popString();	//<std::string> 买家备注
		$this->_arr_value['sellerTag'] = $bs->popUint8_t();	//<uint8_t> 卖家标记
		$this->_arr_value['sellerNote'] = $bs->popString();	//<std::string> 卖家备注
		$this->_arr_value['dataVersion'] = $bs->popUint32_t();	//<uint32_t> 数据版本号
		$this->_arr_value['delFlag'] = $bs->popUint32_t();	//<uint32_t> 订单有效标记
		$this->_arr_value['visibleState'] = $bs->popUint32_t();	//<uint32_t> 可见标识
		$this->_arr_value['lastUpdateTime'] = $bs->popUint32_t();	//<uint32_t> 最后更新时间
		$this->_arr_value['tradeInfoList'] = $bs->popObject('\ecc\deal\po\TradePoList');	//<ecc::deal::po::CTradePoList> 商品子单列表
		$this->_arr_value['payInfoList'] = $bs->popObject('\ecc\deal\po\PayInfoPoList');	//<ecc::deal::po::CPayInfoPoList> 支付信息表
		$this->_arr_value['wuliuInfoList'] = $bs->popObject('\ecc\deal\po\DealWuliuPoList');	//<ecc::deal::po::CDealWuliuPoList> 物流信息表
		$this->_arr_value['recvFeeInfoList'] = $bs->popObject('\ecc\deal\po\RecvFeePoList');	//<ecc::deal::po::CRecvFeePoList> 打款信息表
		$this->_arr_value['refundInfoList'] = $bs->popObject('\ecc\deal\po\DealRefundPoList');	//<ecc::deal::po::CDealRefundPoList> 退款信息表
		$this->_arr_value['actionLogInfoList'] = $bs->popObject('\ecc\deal\po\DealActionLogPoList');	//<ecc::deal::po::CDealActionLogPoList> 流水日志表
		$this->_arr_value['dealExtInfoMap'] = $bs->popObject('stl_multimap<uint32_t,stl_string>');	//<std::multimap<uint32_t,std::string> > 订单扩展信息 
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId64_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['businessDealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerAccount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerNickName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerNick_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerTitle_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerNick_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['businessId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealSource_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealPayType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['preDealState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealProperty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealProperty1_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealProperty2_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealProperty3_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealProperty4_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['evalState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemSkuidList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemTitleList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealTotalFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealAdjustFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealPayment_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealDownPayment_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealDiscountTotal_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealItemTotalFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealWhoPayShippingFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealShippingFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealWhoPayCodFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealCodFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealWhoPayInsuranceFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealInsuranceFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealSysAdjustFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealRefundTotalFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payScore_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['obtainScore_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealGenTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sendFromDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealSeq_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealMd5_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealIp_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealRefer_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealVisitKey_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['promotionDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvRegionCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvAddress_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvPostCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvPhone_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvMobile_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['expectRecvTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['expectRecvTimeSpan_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvRemark_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvMask_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['expressType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['expressCompanyID_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['expressCompanyName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['expressDealID_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['expectArriveDays_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['wuliuDealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['invoiceType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['invoiceHead_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['invoiceContent_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payAccount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cftDealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealPayTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealPayReturnTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealCheckTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealCheckVersion_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealCheckDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealSellerSendTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealConsignTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealConfirmRecvTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealEndTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealRecvFeeTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealRecvFeeReturnTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealBuyerRecvFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealSellerRecvFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealPayCash_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealPayTicket_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealPayCredit_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealPayOther_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['delayConfirmDays_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerTag_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerNote_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerTag_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerNote_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dataVersion_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['delFlag_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['visibleState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['lastUpdateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['wuliuInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvFeeInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['actionLogInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealExtInfoMap_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['bdealCode'] = $bs->popString();	//<std::string> 交易单编号，即字符串格式的交易单号
		}
		if($this->version >= 1){
			$this->_arr_value['businessBdealId'] = $bs->popString();	//<std::string> 业务交易单号
		}
		if($this->version >= 1){
			$this->_arr_value['siteId'] = $bs->popUint32_t();	//<uint32_t> 分站ID
		}
		if($this->version >= 1){
			$this->_arr_value['dealCouponFee'] = $bs->popInt32_t();	//<int> 优惠券金额
		}
		if($this->version >= 1){
			$this->_arr_value['cashScore'] = $bs->popUint32_t();	//<uint32_t> 现金积分支付值
		}
		if($this->version >= 1){
			$this->_arr_value['promotionScore'] = $bs->popUint32_t();	//<uint32_t> 促销积分支付值
		}
		if($this->version >= 1){
			$this->_arr_value['recvRegionCodeExt'] = $bs->popString();	//<std::string> 扩展地区编码
		}
		if($this->version >= 1){
			$this->_arr_value['dealDigest'] = $bs->popString();	//<std::string> 订单摘要
		}
		if($this->version >= 1){
			$this->_arr_value['icsonShippingType'] = $bs->popString();	//<std::string> 易迅配送方式
		}
		if($this->version >= 1){
			$this->_arr_value['icsonPayType'] = $bs->popString();	//<std::string> 易迅支付方式
		}
		if($this->version >= 1){
			$this->_arr_value['icsonAccount'] = $bs->popString();	//<std::string> 易迅内部帐号ID
		}
		if($this->version >= 1){
			$this->_arr_value['icsonMasterLs'] = $bs->popString();	//<std::string> 易迅跟踪信息
		}
		if($this->version >= 1){
			$this->_arr_value['icsonRate'] = $bs->popString();	//<std::string> 易迅平衡比率
		}
		if($this->version >= 1){
			$this->_arr_value['icsonBankRate'] = $bs->popString();	//<std::string> 易迅银行利率
		}
		if($this->version >= 1){
			$this->_arr_value['icsonShopId'] = $bs->popString();	//<std::string> 易迅店铺id
		}
		if($this->version >= 1){
			$this->_arr_value['icsonShopGuideId'] = $bs->popString();	//<std::string> 易迅店铺导购id
		}
		if($this->version >= 1){
			$this->_arr_value['icsonShopGuideCost'] = $bs->popString();	//<std::string> 易迅店铺导购费用
		}
		if($this->version >= 1){
			$this->_arr_value['icsonShopGuideName'] = $bs->popString();	//<std::string> 易迅店铺导购名称
		}
		if($this->version >= 1){
			$this->_arr_value['icsonSubsidyType'] = $bs->popString();	//<std::string> 易迅节能补贴类型
		}
		if($this->version >= 1){
			$this->_arr_value['icsonSubsidyName'] = $bs->popString();	//<std::string> 易迅节能补贴姓名
		}
		if($this->version >= 1){
			$this->_arr_value['icsonSubsidyIdCard'] = $bs->popString();	//<std::string> 易迅节能补贴身份证
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSOrderOperatorId'] = $bs->popString();	//<std::string> 易迅客服下单操作员ID
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSOrderOperatorName'] = $bs->popString();	//<std::string> 易迅客服下单操作员名称
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceCompanyName'] = $bs->popString();	//<std::string> 易迅发票公司名称
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceCompanyAddr'] = $bs->popString();	//<std::string> 易迅发票公司地址
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceCompanyPhone'] = $bs->popString();	//<std::string> 易迅发票公司电话
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceCompanyTaxNo'] = $bs->popString();	//<std::string> 易迅发票公司税号
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceCompanyBankNo'] = $bs->popString();	//<std::string> 易迅发票公司银行账户
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceCompanyBankName'] = $bs->popString();	//<std::string> 易迅发票公司银行名称
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceRecvName'] = $bs->popString();	//<std::string> 易迅发票收货人
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceRecvAddr'] = $bs->popString();	//<std::string> 易迅发票收货地址
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceRecvRegionId'] = $bs->popString();	//<std::string> 易迅发票收货地址ID
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceRecvMobile'] = $bs->popString();	//<std::string> 易迅发票收货手机
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceRecvTel'] = $bs->popString();	//<std::string> 易迅发票收货电话
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceRecvZip'] = $bs->popString();	//<std::string> 易迅发票收货邮编
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceShipType'] = $bs->popString();	//<std::string> 易迅发票配送方式
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceShipFee'] = $bs->popString();	//<std::string> 易迅发票配送费用
		}
		if($this->version >= 1){
			$this->_arr_value['icsonDealFlag'] = $bs->popString();	//<std::string> 易迅订单flag
		}
		if($this->version >= 1){
			$this->_arr_value['icsonStockNo'] = $bs->popString();	//<std::string> 易迅订单物流仓库编号
		}
		if($this->version >= 1){
			$this->_arr_value['bdealCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['businessBdealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['siteId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['dealCouponFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['cashScore_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['promotionScore_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['recvRegionCodeExt_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['dealDigest_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonShippingType_u'] = $bs->popUint8_t();	//<uint8_t> 易迅配送方式UFlag
		}
		if($this->version >= 1){
			$this->_arr_value['icsonPayType_u'] = $bs->popUint8_t();	//<uint8_t> 易迅支付方式UFlag
		}
		if($this->version >= 1){
			$this->_arr_value['icsonAccount_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonMasterLs_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonRate_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonBankRate_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonShopId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonShopGuideId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonShopGuideCost_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonShopGuideName_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonSubsidyType_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonSubsidyName_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonSubsidyIdCard_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSOrderOperatorId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSOrderOperatorName_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceCompanyName_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceCompanyAddr_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceCompanyPhone_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceCompanyTaxNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceCompanyBankNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceCompanyBankName_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceRecvName_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceRecvAddr_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceRecvRegionId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceRecvMobile_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceRecvTel_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceRecvZip_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceShipType_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonInvoiceShipFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonDealFlag_u'] = $bs->popUint8_t();	//<uint8_t> 易迅订单flag
		}
		if($this->version >= 1){
			$this->_arr_value['icsonStockNo_u'] = $bs->popUint8_t();	//<uint8_t> 易迅订单物流仓库编号
		}
		if($this->version >= 2){
			$this->_arr_value['icsonDealCashBack'] = $bs->popUint32_t();	//<uint32_t> 订单返现金额
		}
		if($this->version >= 2){
			$this->_arr_value['icsonDealCashBack_u'] = $bs->popUint8_t();	//<uint8_t> 订单返现金额UFlag
		}
		if($this->version >= 3){
			$this->_arr_value['icsonDealCode'] = $bs->popString();	//<std::string> 易迅订单号，带10开头
		}
		if($this->version >= 3){
			$this->_arr_value['icsonDealCode_u'] = $bs->popUint8_t();	//<uint8_t> 订单返现金额UFlag
		}
		if($this->version >= 4){
			$this->_arr_value['icsonInvoiceStockNo'] = $bs->popString();	//<std::string> 易迅货票分离仓库id
		}
		if($this->version >= 4){
			$this->_arr_value['icsonInvoiceSiteId'] = $bs->popString();	//<std::string> 易迅货票分离分站id
		}
		if($this->version >= 4){
			$this->_arr_value['icsonInvoiceStockNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 4){
			$this->_arr_value['icsonInvoiceSiteId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 5){
			$this->_arr_value['sellerCorpId'] = $bs->popUint64_t();	//<uint64_t> 易迅联营商家id
		}
		if($this->version >= 5){
			$this->_arr_value['lmsVolume'] = $bs->popString();	//<std::string> 体积
		}
		if($this->version >= 5){
			$this->_arr_value['lmsWeight'] = $bs->popString();	//<std::string> 重量
		}
		if($this->version >= 5){
			$this->_arr_value['lmsLongest'] = $bs->popString();	//<std::string> 最长边
		}
		if($this->version >= 5){
			$this->_arr_value['sellerCorpId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 5){
			$this->_arr_value['lmsVolume_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 5){
			$this->_arr_value['lmsWeight_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 5){
			$this->_arr_value['lmsLongest_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 6){
			$this->_arr_value['dealActiveInfoList'] = $bs->popObject('\ecc\deal\po\TradeActivePoList');	//<ecc::deal::po::CTradeActivePoList> 订单活动列表
		}
		if($this->version >= 6){
			$this->_arr_value['dealActiveInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.DealPo.java
class TradePoList{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $tradeInfoList;	//<std::vector<ecc::deal::po::CTradePo> > 商品单列表(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $tradeInfoList_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->tradeInfoList = new \stl_vector2('\ecc\deal\po\TradePo');	//<std::vector<ecc::deal::po::CTradePo> >
		$this->version_u = 0;	//<uint8_t>
		$this->tradeInfoList_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\po\TradePoList\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\TradePoList\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushObject($this->tradeInfoList,'stl_vector');	//<std::vector<ecc::deal::po::CTradePo> > 商品单列表
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeInfoList_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['tradeInfoList'] = $bs->popObject('stl_vector<\ecc\deal\po\TradePo>');	//<std::vector<ecc::deal::po::CTradePo> > 商品单列表
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.TradePoList.java
class TradePo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $dealId;	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702(版本>=0)
	private $dealId64;	//<uint64_t> 订单单号，统一平台内部单号(版本>=0)
	private $bdealId;	//<uint64_t> 交易单号，买卖家一次交易行为描述(版本>=0)
	private $tradeId;	//<uint64_t> 商品订单号(版本>=0)
	private $recvFeeId;	//<uint64_t> 打款单ID(版本>=0)
	private $buyerId;	//<uint64_t> 买家ID(版本>=0)
	private $buyerNickName;	//<std::string> 买家昵称(版本>=0)
	private $sellerId;	//<uint64_t> 商家ID(版本>=0)
	private $sellerTitle;	//<std::string> 商家名称(版本>=0)
	private $businessId;	//<uint32_t> 业务ID(版本>=0)
	private $tradeType;	//<uint8_t> 订单类型(版本>=0)
	private $tradeSource;	//<uint32_t> 下单渠道：1：业务主站；2：移动app；3：移动wap(版本>=0)
	private $tradePayType;	//<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款(版本>=0)
	private $token;	//<std::string> 打款Token，兼容拍拍商品单(版本>=0)
	private $drawId;	//<std::string> 打款DrawId，兼容拍拍商品单(版本>=0)
	private $shippingfeeTemplateId;	//<std::string> 运费模版ID(版本>=0)
	private $shippingfeeDesc;	//<std::string> 运费描述(版本>=0)
	private $itemShippingfee;	//<uint32_t> 商品运费(版本>=0)
	private $itemType;	//<uint32_t> 商品类型；1：普通商品；2：套餐主商品；3：套餐副商品；4：赠品主商品；5：赠品副商品; 6:组件(版本>=0)
	private $itemClassId;	//<uint32_t> 品类（类目）ID(版本>=0)
	private $itemTitle;	//<std::string> 商品标题(版本>=0)
	private $itemAttrCode;	//<std::string> 商品销售属性编码(版本>=0)
	private $itemAttr;	//<std::string> 商品销售属性描述(版本>=0)
	private $itemId;	//<std::string> 商品ID，由业务定义(版本>=0)
	private $itemSkuId;	//<uint64_t> 商品SKUID(版本>=0)
	private $itemLocalCode;	//<std::string> 商品商家本地编码(版本>=0)
	private $itemLocalStockCode;	//<std::string> 商品商家本地库存编码(版本>=0)
	private $itemBarCode;	//<std::string> 商品条形码(版本>=0)
	private $itemSpuId;	//<uint64_t> 商品SPUID(版本>=0)
	private $itemStockId;	//<uint64_t> 商品库存ID(版本>=0)
	private $itemStoreHouseId;	//<uint32_t> 商品仓库ID(版本>=0)
	private $itemPhyisicalStorage;	//<std::string> 商品所属物理仓(版本>=0)
	private $itemLogo;	//<std::string> 商品图片Logo(版本>=0)
	private $itemSnapVersion;	//<uint32_t> 商品快照版本号(版本>=0)
	private $itemResetTime;	//<uint32_t> 商品重置时间戳(版本>=0)
	private $itemWeight;	//<uint32_t> 商品重量(版本>=0)
	private $itemVolume;	//<uint32_t> 商品体积(版本>=0)
	private $mainItemId;	//<uint64_t> 商品套餐主商品ID(版本>=0)
	private $itemAccessoryDesc;	//<std::string> 商品标配说明(版本>=0)
	private $itemCostPrice;	//<uint32_t> 商品成本价(版本>=0)
	private $itemOriginPrice;	//<uint32_t> 商品市场价(版本>=0)
	private $itemSoldPrice;	//<uint32_t> 商品销售单价(版本>=0)
	private $itemB2CMarket;	//<std::string> 自营B2C市场(版本>=0)
	private $itemB2CPM;	//<std::string> 自营B2CPM(版本>=0)
	private $itemUseVirtualStock;	//<uint8_t> 自营B2C是否占用虚库(版本>=0)
	private $buyPrice;	//<uint32_t> 商品成交价(版本>=0)
	private $buyNum;	//<uint32_t> 商品成交件数(版本>=0)
	private $tradeTotalFee;	//<uint32_t> 商品单总金额,下单金额(版本>=0)
	private $tradeAdjustFee;	//<int> 商品单调价金额(版本>=0)
	private $tradePayment;	//<uint32_t> 实付总金额(版本>=0)
	private $tradeDiscountTotal;	//<int> 优惠总金额(版本>=0)
	private $tradePaipaiHongbaoUsed;	//<uint32_t> Paipai红包使用金额(版本>=0)
	private $payScore;	//<uint32_t> 积分支付值(版本>=0)
	private $tradeGenTime;	//<uint32_t> 商品单生成时间(版本>=0)
	private $tradeOpSerialNo;	//<uint16_t> 商品单库存操作序列号(版本>=0)
	private $obtainScore;	//<uint32_t> 获得积分值(版本>=0)
	private $tradeState;	//<uint32_t> 商品单状态(版本>=0)
	private $preTradeState;	//<uint32_t> 商品单前一个状态(版本>=0)
	private $tradeProperty;	//<uint32_t> 商品单属性值(版本>=0)
	private $tradeProperty1;	//<uint32_t> 商品单属性值1(版本>=0)
	private $tradeProperty2;	//<uint32_t> 商品单属性值2(版本>=0)
	private $tradeProperty3;	//<uint32_t> 商品单属性值3(版本>=0)
	private $tradeProperty4;	//<uint32_t> 商品单属性值4(版本>=0)
	private $refundState;	//<uint32_t> 退款状态, 各退款单的汇总状态, 0:无退款,1:退款中,2:退款完成(版本>=0)
	private $refundDetailState;	//<uint32_t> 冗余退款单的退款状态，拍拍同步订单使用(版本>=0)
	private $dealRefundState;	//<uint32_t> 订单退款状态, 冗余DealDo上的值, 各子单退款状态的汇总, 0:无退款,1:退款中,2:退款完成(版本>=0)
	private $evalState;	//<uint32_t> 评价评论状态(版本>=0)
	private $tradePayTime;	//<uint32_t> 付款时间(版本>=0)
	private $tradeCheckTime;	//<uint32_t> 审核时间(版本>=0)
	private $tradeConsignTime;	//<uint32_t> 标记发货时间(版本>=0)
	private $tradeMarkNoStockTime;	//<uint32_t> 标记缺货时间(版本>=0)
	private $delayConfirmDays;	//<uint32_t> 延长确认收货天数(版本>=0)
	private $tradeConfirmRecvTime;	//<uint32_t> 签收时间(版本>=0)
	private $tradeEndTime;	//<uint32_t> 结束时间(版本>=0)
	private $tradeRecvFeeTime;	//<uint32_t> 打款时间(版本>=0)
	private $tradeRecvFeeReturnTime;	//<uint32_t> 打款返回时间(版本>=0)
	private $stockoutNum;	//<uint32_t> 商品缺货总件数(版本>=0)
	private $refuseNum;	//<uint32_t> 拒收总件数(版本>=0)
	private $doneNum;	//<uint32_t> 实际成交件数(版本>=0)
	private $closeReasonType;	//<uint8_t> 订单关闭原因类型(版本>=0)
	private $closeReasonDesc;	//<std::string> 订单关闭原因描述(版本>=0)
	private $sellerTotalRecvFee;	//<uint32_t> 卖家到账总金额(版本>=0)
	private $buyerTotalRecvFee;	//<uint32_t> 买家到账总金额(版本>=0)
	private $itemTimeoutFlag;	//<uint32_t> 商品超时标识(版本>=0)
	private $lastUpdateTime;	//<uint32_t> 最后更新时间(版本>=0)
	private $activeInfoList;	//<ecc::deal::po::CTradeActivePoList> 商品活动列表(版本>=0)
	private $dealExtInfoMap;	//<std::multimap<uint32_t,std::string> > 订单扩展信息 (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $dealId_u;	//<uint8_t> (版本>=0)
	private $dealId64_u;	//<uint8_t> (版本>=0)
	private $bdealId_u;	//<uint8_t> (版本>=0)
	private $tradeId_u;	//<uint8_t> (版本>=0)
	private $recvFeeId_u;	//<uint8_t> (版本>=0)
	private $buyerId_u;	//<uint8_t> (版本>=0)
	private $buyerNickName_u;	//<uint8_t> (版本>=0)
	private $sellerId_u;	//<uint8_t> (版本>=0)
	private $sellerTitle_u;	//<uint8_t> (版本>=0)
	private $businessId_u;	//<uint8_t> (版本>=0)
	private $tradeType_u;	//<uint8_t> (版本>=0)
	private $tradeSource_u;	//<uint8_t> (版本>=0)
	private $tradePayType_u;	//<uint8_t> (版本>=0)
	private $token_u;	//<uint8_t> (版本>=0)
	private $drawId_u;	//<uint8_t> (版本>=0)
	private $shippingfeeTemplateId_u;	//<uint8_t> (版本>=0)
	private $shippingfeeDesc_u;	//<uint8_t> (版本>=0)
	private $itemShippingfee_u;	//<uint8_t> (版本>=0)
	private $itemType_u;	//<uint8_t> (版本>=0)
	private $itemClassId_u;	//<uint8_t> (版本>=0)
	private $itemTitle_u;	//<uint8_t> (版本>=0)
	private $itemAttrCode_u;	//<uint8_t> (版本>=0)
	private $itemAttr_u;	//<uint8_t> (版本>=0)
	private $itemId_u;	//<uint8_t> (版本>=0)
	private $itemSkuId_u;	//<uint8_t> (版本>=0)
	private $itemLocalCode_u;	//<uint8_t> (版本>=0)
	private $itemLocalStockCode_u;	//<uint8_t> (版本>=0)
	private $itemBarCode_u;	//<uint8_t> (版本>=0)
	private $itemSpuId_u;	//<uint8_t> (版本>=0)
	private $itemStockId_u;	//<uint8_t> (版本>=0)
	private $itemStoreHouseId_u;	//<uint8_t> (版本>=0)
	private $itemPhyisicalStorage_u;	//<uint8_t> (版本>=0)
	private $itemLogo_u;	//<uint8_t> (版本>=0)
	private $itemSnapVersion_u;	//<uint8_t> (版本>=0)
	private $itemResetTime_u;	//<uint8_t> (版本>=0)
	private $itemWeight_u;	//<uint8_t> (版本>=0)
	private $itemVolume_u;	//<uint8_t> (版本>=0)
	private $mainItemId_u;	//<uint8_t> (版本>=0)
	private $itemAccessoryDesc_u;	//<uint8_t> (版本>=0)
	private $itemCostPrice_u;	//<uint8_t> (版本>=0)
	private $itemOriginPrice_u;	//<uint8_t> (版本>=0)
	private $itemSoldPrice_u;	//<uint8_t> (版本>=0)
	private $itemB2CMarket_u;	//<uint8_t> (版本>=0)
	private $itemB2CPM_u;	//<uint8_t> (版本>=0)
	private $itemUseVirtualStock_u;	//<uint8_t> (版本>=0)
	private $buyPrice_u;	//<uint8_t> (版本>=0)
	private $buyNum_u;	//<uint8_t> (版本>=0)
	private $tradeTotalFee_u;	//<uint8_t> (版本>=0)
	private $tradeAdjustFee_u;	//<uint8_t> (版本>=0)
	private $tradePayment_u;	//<uint8_t> (版本>=0)
	private $tradeDiscountTotal_u;	//<uint8_t> (版本>=0)
	private $tradePaipaiHongbaoUsed_u;	//<uint8_t> (版本>=0)
	private $payScore_u;	//<uint8_t> (版本>=0)
	private $tradeGenTime_u;	//<uint8_t> (版本>=0)
	private $tradeOpSerialNo_u;	//<uint8_t> (版本>=0)
	private $obtainScore_u;	//<uint8_t> (版本>=0)
	private $tradeState_u;	//<uint8_t> (版本>=0)
	private $preTradeState_u;	//<uint8_t> (版本>=0)
	private $tradeProperty_u;	//<uint8_t> (版本>=0)
	private $tradeProperty1_u;	//<uint8_t> (版本>=0)
	private $tradeProperty2_u;	//<uint8_t> (版本>=0)
	private $tradeProperty3_u;	//<uint8_t> (版本>=0)
	private $tradeProperty4_u;	//<uint8_t> (版本>=0)
	private $refundState_u;	//<uint8_t> (版本>=0)
	private $refundDetailState_u;	//<uint8_t> (版本>=0)
	private $dealRefundState_u;	//<uint8_t> (版本>=0)
	private $evalState_u;	//<uint8_t> (版本>=0)
	private $tradePayTime_u;	//<uint8_t> (版本>=0)
	private $tradeCheckTime_u;	//<uint8_t> (版本>=0)
	private $tradeConsignTime_u;	//<uint8_t> (版本>=0)
	private $tradeMarkNoStockTime_u;	//<uint8_t> (版本>=0)
	private $delayConfirmDays_u;	//<uint8_t> (版本>=0)
	private $tradeConfirmRecvTime_u;	//<uint8_t> (版本>=0)
	private $tradeEndTime_u;	//<uint8_t> (版本>=0)
	private $tradeRecvFeeTime_u;	//<uint8_t> (版本>=0)
	private $tradeRecvFeeReturnTime_u;	//<uint8_t> (版本>=0)
	private $stockoutNum_u;	//<uint8_t> (版本>=0)
	private $refuseNum_u;	//<uint8_t> (版本>=0)
	private $doneNum_u;	//<uint8_t> (版本>=0)
	private $closeReasonType_u;	//<uint8_t> (版本>=0)
	private $closeReasonDesc_u;	//<uint8_t> (版本>=0)
	private $sellerTotalRecvFee_u;	//<uint8_t> (版本>=0)
	private $buyerTotalRecvFee_u;	//<uint8_t> (版本>=0)
	private $itemTimeoutFlag_u;	//<uint8_t> (版本>=0)
	private $lastUpdateTime_u;	//<uint8_t> (版本>=0)
	private $activeInfoList_u;	//<uint8_t> (版本>=0)
	private $dealExtInfoMap_u;	//<uint8_t> (版本>=0)
	private $tradeSellerSendTime;	//<uint32_t> 标记发货时间(版本>=1)
	private $warranty;	//<std::string> 保修条款(版本>=1)
	private $productId;	//<uint64_t> 产品id(版本>=1)
	private $productCode;	//<std::string> 产品id编码(版本>=1)
	private $icsonEdmCode;	//<std::string> 易迅edm编码(版本>=1)
	private $icsonOTag;	//<std::string> 易迅OTag(版本>=1)
	private $icsonTradeShopGuideCost;	//<std::string> 易迅店铺导购费用(版本>=1)
	private $icsonCSPhoneType;	//<std::string> 易迅定制机类型(版本>=1)
	private $icsonCSPhoneOperator;	//<std::string> 易迅定制机运营商(版本>=1)
	private $icsonCSPhoneNumber;	//<std::string> 易迅定制机号码(版本>=1)
	private $icsonCSPhoneArea;	//<std::string> 易迅定制机归属地(版本>=1)
	private $icsonCSPhonePackageId;	//<std::string> 易迅定制机套餐id(版本>=1)
	private $icsonCSPhoneUserName;	//<std::string> 易迅定制机用户姓名(版本>=1)
	private $icsonCSPhoneUserAddr;	//<std::string> 易迅定制机用户地址(版本>=1)
	private $icsonCSPhoneUserMobile;	//<std::string> 易迅定制机用户联系手机(版本>=1)
	private $icsonCSPhoneUserTel;	//<std::string> 易迅定制机用户联系电话(版本>=1)
	private $icsonCSPhoneIdCardNo;	//<std::string> 易迅定制机身份证号码(版本>=1)
	private $icsonCSPhoneIdCardAddr;	//<std::string> 易迅定制机身份证地址(版本>=1)
	private $icsonCSPhoneIdCardDate;	//<std::string> 易迅定制机身份证有效期(版本>=1)
	private $icsonCSPhoneZipCode;	//<std::string> 易迅定制机邮政编码(版本>=1)
	private $icsonCSPhoneCardPrice;	//<std::string> 易迅定制机卡价格(版本>=1)
	private $icsonCSPhonePackagePrice;	//<std::string> 易迅定制机套餐价格(版本>=1)
	private $icsonTradeFlag;	//<std::string> 易迅商品子单flag(版本>=1)
	private $icsonPointType;	//<std::string> 易迅积分兑换类型(版本>=1)
	private $icsonPackageIds;	//<std::string> 易迅商品子单套餐id(版本>=1)
	private $tradeSellerSendTime_u;	//<uint8_t> (版本>=1)
	private $warranty_u;	//<uint8_t> (版本>=1)
	private $productId_u;	//<uint8_t> (版本>=1)
	private $productCode_u;	//<uint8_t> (版本>=1)
	private $icsonEdmCode_u;	//<uint8_t> (版本>=1)
	private $icsonOTag_u;	//<uint8_t> (版本>=1)
	private $icsonTradeShopGuideCost_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneType_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneOperator_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneNumber_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneArea_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhonePackageId_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneUserName_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneUserAddr_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneUserMobile_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneUserTel_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneIdCardNo_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneIdCardAddr_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneIdCardDate_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneZipCode_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhoneCardPrice_u;	//<uint8_t> (版本>=1)
	private $icsonCSPhonePackagePrice_u;	//<uint8_t> (版本>=1)
	private $icsonTradeFlag_u;	//<uint8_t> 易迅商品子单flag(版本>=1)
	private $icsonPointType_u;	//<uint8_t> 易迅积分兑换类型(版本>=1)
	private $icsonPackageIds_u;	//<uint8_t> 易迅商品子单套餐id(版本>=1)
	private $icsonTradeCashBack;	//<uint32_t> 子单返现金额(版本>=2)
	private $icsonTradeCashBack_u;	//<uint8_t> 子单返现金额UFlag(版本>=2)
	private $icsonUnitCostInvoice;	//<std::string> 去税后成本(版本>=3)
	private $icsonUnitCostInvoice_u;	//<uint8_t> 去税后成本UFlag(版本>=3)

	function __construct(){
		$this->version = 3;	//<uint16_t>
		$this->dealId = "";	//<std::string>
		$this->dealId64 = 0;	//<uint64_t>
		$this->bdealId = 0;	//<uint64_t>
		$this->tradeId = 0;	//<uint64_t>
		$this->recvFeeId = 0;	//<uint64_t>
		$this->buyerId = 0;	//<uint64_t>
		$this->buyerNickName = "";	//<std::string>
		$this->sellerId = 0;	//<uint64_t>
		$this->sellerTitle = "";	//<std::string>
		$this->businessId = 0;	//<uint32_t>
		$this->tradeType = 0;	//<uint8_t>
		$this->tradeSource = 0;	//<uint32_t>
		$this->tradePayType = 0;	//<uint8_t>
		$this->token = "";	//<std::string>
		$this->drawId = "";	//<std::string>
		$this->shippingfeeTemplateId = "";	//<std::string>
		$this->shippingfeeDesc = "";	//<std::string>
		$this->itemShippingfee = 0;	//<uint32_t>
		$this->itemType = 0;	//<uint32_t>
		$this->itemClassId = 0;	//<uint32_t>
		$this->itemTitle = "";	//<std::string>
		$this->itemAttrCode = "";	//<std::string>
		$this->itemAttr = "";	//<std::string>
		$this->itemId = "";	//<std::string>
		$this->itemSkuId = 0;	//<uint64_t>
		$this->itemLocalCode = "";	//<std::string>
		$this->itemLocalStockCode = "";	//<std::string>
		$this->itemBarCode = "";	//<std::string>
		$this->itemSpuId = 0;	//<uint64_t>
		$this->itemStockId = 0;	//<uint64_t>
		$this->itemStoreHouseId = 0;	//<uint32_t>
		$this->itemPhyisicalStorage = "";	//<std::string>
		$this->itemLogo = "";	//<std::string>
		$this->itemSnapVersion = 0;	//<uint32_t>
		$this->itemResetTime = 0;	//<uint32_t>
		$this->itemWeight = 0;	//<uint32_t>
		$this->itemVolume = 0;	//<uint32_t>
		$this->mainItemId = 0;	//<uint64_t>
		$this->itemAccessoryDesc = "";	//<std::string>
		$this->itemCostPrice = 0;	//<uint32_t>
		$this->itemOriginPrice = 0;	//<uint32_t>
		$this->itemSoldPrice = 0;	//<uint32_t>
		$this->itemB2CMarket = "";	//<std::string>
		$this->itemB2CPM = "";	//<std::string>
		$this->itemUseVirtualStock = 0;	//<uint8_t>
		$this->buyPrice = 0;	//<uint32_t>
		$this->buyNum = 0;	//<uint32_t>
		$this->tradeTotalFee = 0;	//<uint32_t>
		$this->tradeAdjustFee = 0;	//<int>
		$this->tradePayment = 0;	//<uint32_t>
		$this->tradeDiscountTotal = 0;	//<int>
		$this->tradePaipaiHongbaoUsed = 0;	//<uint32_t>
		$this->payScore = 0;	//<uint32_t>
		$this->tradeGenTime = 0;	//<uint32_t>
		$this->tradeOpSerialNo = 0;	//<uint16_t>
		$this->obtainScore = 0;	//<uint32_t>
		$this->tradeState = 0;	//<uint32_t>
		$this->preTradeState = 0;	//<uint32_t>
		$this->tradeProperty = 0;	//<uint32_t>
		$this->tradeProperty1 = 0;	//<uint32_t>
		$this->tradeProperty2 = 0;	//<uint32_t>
		$this->tradeProperty3 = 0;	//<uint32_t>
		$this->tradeProperty4 = 0;	//<uint32_t>
		$this->refundState = 0;	//<uint32_t>
		$this->refundDetailState = 0;	//<uint32_t>
		$this->dealRefundState = 0;	//<uint32_t>
		$this->evalState = 0;	//<uint32_t>
		$this->tradePayTime = 0;	//<uint32_t>
		$this->tradeCheckTime = 0;	//<uint32_t>
		$this->tradeConsignTime = 0;	//<uint32_t>
		$this->tradeMarkNoStockTime = 0;	//<uint32_t>
		$this->delayConfirmDays = 0;	//<uint32_t>
		$this->tradeConfirmRecvTime = 0;	//<uint32_t>
		$this->tradeEndTime = 0;	//<uint32_t>
		$this->tradeRecvFeeTime = 0;	//<uint32_t>
		$this->tradeRecvFeeReturnTime = 0;	//<uint32_t>
		$this->stockoutNum = 0;	//<uint32_t>
		$this->refuseNum = 0;	//<uint32_t>
		$this->doneNum = 0;	//<uint32_t>
		$this->closeReasonType = 0;	//<uint8_t>
		$this->closeReasonDesc = "";	//<std::string>
		$this->sellerTotalRecvFee = 0;	//<uint32_t>
		$this->buyerTotalRecvFee = 0;	//<uint32_t>
		$this->itemTimeoutFlag = 0;	//<uint32_t>
		$this->lastUpdateTime = 0;	//<uint32_t>
		$this->activeInfoList = new \ecc\deal\po\TradeActivePoList();	//<ecc::deal::po::CTradeActivePoList>
		$this->dealExtInfoMap = new \stl_multimap2('uint32_t,stl_string');	//<std::multimap<uint32_t,std::string> >
		$this->version_u = 0;	//<uint8_t>
		$this->dealId_u = 0;	//<uint8_t>
		$this->dealId64_u = 0;	//<uint8_t>
		$this->bdealId_u = 0;	//<uint8_t>
		$this->tradeId_u = 0;	//<uint8_t>
		$this->recvFeeId_u = 0;	//<uint8_t>
		$this->buyerId_u = 0;	//<uint8_t>
		$this->buyerNickName_u = 0;	//<uint8_t>
		$this->sellerId_u = 0;	//<uint8_t>
		$this->sellerTitle_u = 0;	//<uint8_t>
		$this->businessId_u = 0;	//<uint8_t>
		$this->tradeType_u = 0;	//<uint8_t>
		$this->tradeSource_u = 0;	//<uint8_t>
		$this->tradePayType_u = 0;	//<uint8_t>
		$this->token_u = 0;	//<uint8_t>
		$this->drawId_u = 0;	//<uint8_t>
		$this->shippingfeeTemplateId_u = 0;	//<uint8_t>
		$this->shippingfeeDesc_u = 0;	//<uint8_t>
		$this->itemShippingfee_u = 0;	//<uint8_t>
		$this->itemType_u = 0;	//<uint8_t>
		$this->itemClassId_u = 0;	//<uint8_t>
		$this->itemTitle_u = 0;	//<uint8_t>
		$this->itemAttrCode_u = 0;	//<uint8_t>
		$this->itemAttr_u = 0;	//<uint8_t>
		$this->itemId_u = 0;	//<uint8_t>
		$this->itemSkuId_u = 0;	//<uint8_t>
		$this->itemLocalCode_u = 0;	//<uint8_t>
		$this->itemLocalStockCode_u = 0;	//<uint8_t>
		$this->itemBarCode_u = 0;	//<uint8_t>
		$this->itemSpuId_u = 0;	//<uint8_t>
		$this->itemStockId_u = 0;	//<uint8_t>
		$this->itemStoreHouseId_u = 0;	//<uint8_t>
		$this->itemPhyisicalStorage_u = 0;	//<uint8_t>
		$this->itemLogo_u = 0;	//<uint8_t>
		$this->itemSnapVersion_u = 0;	//<uint8_t>
		$this->itemResetTime_u = 0;	//<uint8_t>
		$this->itemWeight_u = 0;	//<uint8_t>
		$this->itemVolume_u = 0;	//<uint8_t>
		$this->mainItemId_u = 0;	//<uint8_t>
		$this->itemAccessoryDesc_u = 0;	//<uint8_t>
		$this->itemCostPrice_u = 0;	//<uint8_t>
		$this->itemOriginPrice_u = 0;	//<uint8_t>
		$this->itemSoldPrice_u = 0;	//<uint8_t>
		$this->itemB2CMarket_u = 0;	//<uint8_t>
		$this->itemB2CPM_u = 0;	//<uint8_t>
		$this->itemUseVirtualStock_u = 0;	//<uint8_t>
		$this->buyPrice_u = 0;	//<uint8_t>
		$this->buyNum_u = 0;	//<uint8_t>
		$this->tradeTotalFee_u = 0;	//<uint8_t>
		$this->tradeAdjustFee_u = 0;	//<uint8_t>
		$this->tradePayment_u = 0;	//<uint8_t>
		$this->tradeDiscountTotal_u = 0;	//<uint8_t>
		$this->tradePaipaiHongbaoUsed_u = 0;	//<uint8_t>
		$this->payScore_u = 0;	//<uint8_t>
		$this->tradeGenTime_u = 0;	//<uint8_t>
		$this->tradeOpSerialNo_u = 0;	//<uint8_t>
		$this->obtainScore_u = 0;	//<uint8_t>
		$this->tradeState_u = 0;	//<uint8_t>
		$this->preTradeState_u = 0;	//<uint8_t>
		$this->tradeProperty_u = 0;	//<uint8_t>
		$this->tradeProperty1_u = 0;	//<uint8_t>
		$this->tradeProperty2_u = 0;	//<uint8_t>
		$this->tradeProperty3_u = 0;	//<uint8_t>
		$this->tradeProperty4_u = 0;	//<uint8_t>
		$this->refundState_u = 0;	//<uint8_t>
		$this->refundDetailState_u = 0;	//<uint8_t>
		$this->dealRefundState_u = 0;	//<uint8_t>
		$this->evalState_u = 0;	//<uint8_t>
		$this->tradePayTime_u = 0;	//<uint8_t>
		$this->tradeCheckTime_u = 0;	//<uint8_t>
		$this->tradeConsignTime_u = 0;	//<uint8_t>
		$this->tradeMarkNoStockTime_u = 0;	//<uint8_t>
		$this->delayConfirmDays_u = 0;	//<uint8_t>
		$this->tradeConfirmRecvTime_u = 0;	//<uint8_t>
		$this->tradeEndTime_u = 0;	//<uint8_t>
		$this->tradeRecvFeeTime_u = 0;	//<uint8_t>
		$this->tradeRecvFeeReturnTime_u = 0;	//<uint8_t>
		$this->stockoutNum_u = 0;	//<uint8_t>
		$this->refuseNum_u = 0;	//<uint8_t>
		$this->doneNum_u = 0;	//<uint8_t>
		$this->closeReasonType_u = 0;	//<uint8_t>
		$this->closeReasonDesc_u = 0;	//<uint8_t>
		$this->sellerTotalRecvFee_u = 0;	//<uint8_t>
		$this->buyerTotalRecvFee_u = 0;	//<uint8_t>
		$this->itemTimeoutFlag_u = 0;	//<uint8_t>
		$this->lastUpdateTime_u = 0;	//<uint8_t>
		$this->activeInfoList_u = 0;	//<uint8_t>
		$this->dealExtInfoMap_u = 0;	//<uint8_t>
		$this->tradeSellerSendTime = 0;	//<uint32_t>
		$this->warranty = "";	//<std::string>
		$this->productId = 0;	//<uint64_t>
		$this->productCode = "";	//<std::string>
		$this->icsonEdmCode = "";	//<std::string>
		$this->icsonOTag = "";	//<std::string>
		$this->icsonTradeShopGuideCost = "";	//<std::string>
		$this->icsonCSPhoneType = "";	//<std::string>
		$this->icsonCSPhoneOperator = "";	//<std::string>
		$this->icsonCSPhoneNumber = "";	//<std::string>
		$this->icsonCSPhoneArea = "";	//<std::string>
		$this->icsonCSPhonePackageId = "";	//<std::string>
		$this->icsonCSPhoneUserName = "";	//<std::string>
		$this->icsonCSPhoneUserAddr = "";	//<std::string>
		$this->icsonCSPhoneUserMobile = "";	//<std::string>
		$this->icsonCSPhoneUserTel = "";	//<std::string>
		$this->icsonCSPhoneIdCardNo = "";	//<std::string>
		$this->icsonCSPhoneIdCardAddr = "";	//<std::string>
		$this->icsonCSPhoneIdCardDate = "";	//<std::string>
		$this->icsonCSPhoneZipCode = "";	//<std::string>
		$this->icsonCSPhoneCardPrice = "";	//<std::string>
		$this->icsonCSPhonePackagePrice = "";	//<std::string>
		$this->icsonTradeFlag = "";	//<std::string>
		$this->icsonPointType = "";	//<std::string>
		$this->icsonPackageIds = "";	//<std::string>
		$this->tradeSellerSendTime_u = 0;	//<uint8_t>
		$this->warranty_u = 0;	//<uint8_t>
		$this->productId_u = 0;	//<uint8_t>
		$this->productCode_u = 0;	//<uint8_t>
		$this->icsonEdmCode_u = 0;	//<uint8_t>
		$this->icsonOTag_u = 0;	//<uint8_t>
		$this->icsonTradeShopGuideCost_u = 0;	//<uint8_t>
		$this->icsonCSPhoneType_u = 0;	//<uint8_t>
		$this->icsonCSPhoneOperator_u = 0;	//<uint8_t>
		$this->icsonCSPhoneNumber_u = 0;	//<uint8_t>
		$this->icsonCSPhoneArea_u = 0;	//<uint8_t>
		$this->icsonCSPhonePackageId_u = 0;	//<uint8_t>
		$this->icsonCSPhoneUserName_u = 0;	//<uint8_t>
		$this->icsonCSPhoneUserAddr_u = 0;	//<uint8_t>
		$this->icsonCSPhoneUserMobile_u = 0;	//<uint8_t>
		$this->icsonCSPhoneUserTel_u = 0;	//<uint8_t>
		$this->icsonCSPhoneIdCardNo_u = 0;	//<uint8_t>
		$this->icsonCSPhoneIdCardAddr_u = 0;	//<uint8_t>
		$this->icsonCSPhoneIdCardDate_u = 0;	//<uint8_t>
		$this->icsonCSPhoneZipCode_u = 0;	//<uint8_t>
		$this->icsonCSPhoneCardPrice_u = 0;	//<uint8_t>
		$this->icsonCSPhonePackagePrice_u = 0;	//<uint8_t>
		$this->icsonTradeFlag_u = 0;	//<uint8_t>
		$this->icsonPointType_u = 0;	//<uint8_t>
		$this->icsonPackageIds_u = 0;	//<uint8_t>
		$this->icsonTradeCashBack = 0;	//<uint32_t>
		$this->icsonTradeCashBack_u = 0;	//<uint8_t>
		$this->icsonUnitCostInvoice = "";	//<std::string>
		$this->icsonUnitCostInvoice_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\po\TradePo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\TradePo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushString($this->dealId);	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		$bs->pushUint64_t($this->dealId64);	//<uint64_t> 订单单号，统一平台内部单号
		$bs->pushUint64_t($this->bdealId);	//<uint64_t> 交易单号，买卖家一次交易行为描述
		$bs->pushUint64_t($this->tradeId);	//<uint64_t> 商品订单号
		$bs->pushUint64_t($this->recvFeeId);	//<uint64_t> 打款单ID
		$bs->pushUint64_t($this->buyerId);	//<uint64_t> 买家ID
		$bs->pushString($this->buyerNickName);	//<std::string> 买家昵称
		$bs->pushUint64_t($this->sellerId);	//<uint64_t> 商家ID
		$bs->pushString($this->sellerTitle);	//<std::string> 商家名称
		$bs->pushUint32_t($this->businessId);	//<uint32_t> 业务ID
		$bs->pushUint8_t($this->tradeType);	//<uint8_t> 订单类型
		$bs->pushUint32_t($this->tradeSource);	//<uint32_t> 下单渠道：1：业务主站；2：移动app；3：移动wap
		$bs->pushUint8_t($this->tradePayType);	//<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款
		$bs->pushString($this->token);	//<std::string> 打款Token，兼容拍拍商品单
		$bs->pushString($this->drawId);	//<std::string> 打款DrawId，兼容拍拍商品单
		$bs->pushString($this->shippingfeeTemplateId);	//<std::string> 运费模版ID
		$bs->pushString($this->shippingfeeDesc);	//<std::string> 运费描述
		$bs->pushUint32_t($this->itemShippingfee);	//<uint32_t> 商品运费
		$bs->pushUint32_t($this->itemType);	//<uint32_t> 商品类型；1：普通商品；2：套餐主商品；3：套餐副商品；4：赠品主商品；5：赠品副商品; 6:组件
		$bs->pushUint32_t($this->itemClassId);	//<uint32_t> 品类（类目）ID
		$bs->pushString($this->itemTitle);	//<std::string> 商品标题
		$bs->pushString($this->itemAttrCode);	//<std::string> 商品销售属性编码
		$bs->pushString($this->itemAttr);	//<std::string> 商品销售属性描述
		$bs->pushString($this->itemId);	//<std::string> 商品ID，由业务定义
		$bs->pushUint64_t($this->itemSkuId);	//<uint64_t> 商品SKUID
		$bs->pushString($this->itemLocalCode);	//<std::string> 商品商家本地编码
		$bs->pushString($this->itemLocalStockCode);	//<std::string> 商品商家本地库存编码
		$bs->pushString($this->itemBarCode);	//<std::string> 商品条形码
		$bs->pushUint64_t($this->itemSpuId);	//<uint64_t> 商品SPUID
		$bs->pushUint64_t($this->itemStockId);	//<uint64_t> 商品库存ID
		$bs->pushUint32_t($this->itemStoreHouseId);	//<uint32_t> 商品仓库ID
		$bs->pushString($this->itemPhyisicalStorage);	//<std::string> 商品所属物理仓
		$bs->pushString($this->itemLogo);	//<std::string> 商品图片Logo
		$bs->pushUint32_t($this->itemSnapVersion);	//<uint32_t> 商品快照版本号
		$bs->pushUint32_t($this->itemResetTime);	//<uint32_t> 商品重置时间戳
		$bs->pushUint32_t($this->itemWeight);	//<uint32_t> 商品重量
		$bs->pushUint32_t($this->itemVolume);	//<uint32_t> 商品体积
		$bs->pushUint64_t($this->mainItemId);	//<uint64_t> 商品套餐主商品ID
		$bs->pushString($this->itemAccessoryDesc);	//<std::string> 商品标配说明
		$bs->pushUint32_t($this->itemCostPrice);	//<uint32_t> 商品成本价
		$bs->pushUint32_t($this->itemOriginPrice);	//<uint32_t> 商品市场价
		$bs->pushUint32_t($this->itemSoldPrice);	//<uint32_t> 商品销售单价
		$bs->pushString($this->itemB2CMarket);	//<std::string> 自营B2C市场
		$bs->pushString($this->itemB2CPM);	//<std::string> 自营B2CPM
		$bs->pushUint8_t($this->itemUseVirtualStock);	//<uint8_t> 自营B2C是否占用虚库
		$bs->pushUint32_t($this->buyPrice);	//<uint32_t> 商品成交价
		$bs->pushUint32_t($this->buyNum);	//<uint32_t> 商品成交件数
		$bs->pushUint32_t($this->tradeTotalFee);	//<uint32_t> 商品单总金额,下单金额
		$bs->pushInt32_t($this->tradeAdjustFee);	//<int> 商品单调价金额
		$bs->pushUint32_t($this->tradePayment);	//<uint32_t> 实付总金额
		$bs->pushInt32_t($this->tradeDiscountTotal);	//<int> 优惠总金额
		$bs->pushUint32_t($this->tradePaipaiHongbaoUsed);	//<uint32_t> Paipai红包使用金额
		$bs->pushUint32_t($this->payScore);	//<uint32_t> 积分支付值
		$bs->pushUint32_t($this->tradeGenTime);	//<uint32_t> 商品单生成时间
		$bs->pushUint16_t($this->tradeOpSerialNo);	//<uint16_t> 商品单库存操作序列号
		$bs->pushUint32_t($this->obtainScore);	//<uint32_t> 获得积分值
		$bs->pushUint32_t($this->tradeState);	//<uint32_t> 商品单状态
		$bs->pushUint32_t($this->preTradeState);	//<uint32_t> 商品单前一个状态
		$bs->pushUint32_t($this->tradeProperty);	//<uint32_t> 商品单属性值
		$bs->pushUint32_t($this->tradeProperty1);	//<uint32_t> 商品单属性值1
		$bs->pushUint32_t($this->tradeProperty2);	//<uint32_t> 商品单属性值2
		$bs->pushUint32_t($this->tradeProperty3);	//<uint32_t> 商品单属性值3
		$bs->pushUint32_t($this->tradeProperty4);	//<uint32_t> 商品单属性值4
		$bs->pushUint32_t($this->refundState);	//<uint32_t> 退款状态, 各退款单的汇总状态, 0:无退款,1:退款中,2:退款完成
		$bs->pushUint32_t($this->refundDetailState);	//<uint32_t> 冗余退款单的退款状态，拍拍同步订单使用
		$bs->pushUint32_t($this->dealRefundState);	//<uint32_t> 订单退款状态, 冗余DealDo上的值, 各子单退款状态的汇总, 0:无退款,1:退款中,2:退款完成
		$bs->pushUint32_t($this->evalState);	//<uint32_t> 评价评论状态
		$bs->pushUint32_t($this->tradePayTime);	//<uint32_t> 付款时间
		$bs->pushUint32_t($this->tradeCheckTime);	//<uint32_t> 审核时间
		$bs->pushUint32_t($this->tradeConsignTime);	//<uint32_t> 标记发货时间
		$bs->pushUint32_t($this->tradeMarkNoStockTime);	//<uint32_t> 标记缺货时间
		$bs->pushUint32_t($this->delayConfirmDays);	//<uint32_t> 延长确认收货天数
		$bs->pushUint32_t($this->tradeConfirmRecvTime);	//<uint32_t> 签收时间
		$bs->pushUint32_t($this->tradeEndTime);	//<uint32_t> 结束时间
		$bs->pushUint32_t($this->tradeRecvFeeTime);	//<uint32_t> 打款时间
		$bs->pushUint32_t($this->tradeRecvFeeReturnTime);	//<uint32_t> 打款返回时间
		$bs->pushUint32_t($this->stockoutNum);	//<uint32_t> 商品缺货总件数
		$bs->pushUint32_t($this->refuseNum);	//<uint32_t> 拒收总件数
		$bs->pushUint32_t($this->doneNum);	//<uint32_t> 实际成交件数
		$bs->pushUint8_t($this->closeReasonType);	//<uint8_t> 订单关闭原因类型
		$bs->pushString($this->closeReasonDesc);	//<std::string> 订单关闭原因描述
		$bs->pushUint32_t($this->sellerTotalRecvFee);	//<uint32_t> 卖家到账总金额
		$bs->pushUint32_t($this->buyerTotalRecvFee);	//<uint32_t> 买家到账总金额
		$bs->pushUint32_t($this->itemTimeoutFlag);	//<uint32_t> 商品超时标识
		$bs->pushUint32_t($this->lastUpdateTime);	//<uint32_t> 最后更新时间
		$bs->pushObject($this->activeInfoList,'\ecc\deal\po\TradeActivePoList');	//<ecc::deal::po::CTradeActivePoList> 商品活动列表
		$bs->pushObject($this->dealExtInfoMap,'stl_multimap');	//<std::multimap<uint32_t,std::string> > 订单扩展信息 
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId64_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvFeeId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerNickName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerTitle_u);	//<uint8_t> 
		$bs->pushUint8_t($this->businessId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeSource_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradePayType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->token_u);	//<uint8_t> 
		$bs->pushUint8_t($this->drawId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->shippingfeeTemplateId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->shippingfeeDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemShippingfee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemClassId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemTitle_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemAttrCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemAttr_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemSkuId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemLocalCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemLocalStockCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemBarCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemSpuId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemStockId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemStoreHouseId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemPhyisicalStorage_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemLogo_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemSnapVersion_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemResetTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemWeight_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemVolume_u);	//<uint8_t> 
		$bs->pushUint8_t($this->mainItemId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemAccessoryDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemCostPrice_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemOriginPrice_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemSoldPrice_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemB2CMarket_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemB2CPM_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemUseVirtualStock_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyPrice_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyNum_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeTotalFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeAdjustFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradePayment_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeDiscountTotal_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradePaipaiHongbaoUsed_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payScore_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeGenTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeOpSerialNo_u);	//<uint8_t> 
		$bs->pushUint8_t($this->obtainScore_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->preTradeState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeProperty_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeProperty1_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeProperty2_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeProperty3_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeProperty4_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundDetailState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealRefundState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->evalState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradePayTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeCheckTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeConsignTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeMarkNoStockTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->delayConfirmDays_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeConfirmRecvTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeEndTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeRecvFeeTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeRecvFeeReturnTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->stockoutNum_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refuseNum_u);	//<uint8_t> 
		$bs->pushUint8_t($this->doneNum_u);	//<uint8_t> 
		$bs->pushUint8_t($this->closeReasonType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->closeReasonDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerTotalRecvFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerTotalRecvFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemTimeoutFlag_u);	//<uint8_t> 
		$bs->pushUint8_t($this->lastUpdateTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->activeInfoList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealExtInfoMap_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushUint32_t($this->tradeSellerSendTime);	//<uint32_t> 标记发货时间
		}
		if($this->version >= 1){
			$bs->pushString($this->warranty);	//<std::string> 保修条款
		}
		if($this->version >= 1){
			$bs->pushUint64_t($this->productId);	//<uint64_t> 产品id
		}
		if($this->version >= 1){
			$bs->pushString($this->productCode);	//<std::string> 产品id编码
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonEdmCode);	//<std::string> 易迅edm编码
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonOTag);	//<std::string> 易迅OTag
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonTradeShopGuideCost);	//<std::string> 易迅店铺导购费用
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneType);	//<std::string> 易迅定制机类型
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneOperator);	//<std::string> 易迅定制机运营商
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneNumber);	//<std::string> 易迅定制机号码
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneArea);	//<std::string> 易迅定制机归属地
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhonePackageId);	//<std::string> 易迅定制机套餐id
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneUserName);	//<std::string> 易迅定制机用户姓名
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneUserAddr);	//<std::string> 易迅定制机用户地址
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneUserMobile);	//<std::string> 易迅定制机用户联系手机
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneUserTel);	//<std::string> 易迅定制机用户联系电话
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneIdCardNo);	//<std::string> 易迅定制机身份证号码
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneIdCardAddr);	//<std::string> 易迅定制机身份证地址
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneIdCardDate);	//<std::string> 易迅定制机身份证有效期
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneZipCode);	//<std::string> 易迅定制机邮政编码
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhoneCardPrice);	//<std::string> 易迅定制机卡价格
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonCSPhonePackagePrice);	//<std::string> 易迅定制机套餐价格
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonTradeFlag);	//<std::string> 易迅商品子单flag
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonPointType);	//<std::string> 易迅积分兑换类型
		}
		if($this->version >= 1){
			$bs->pushString($this->icsonPackageIds);	//<std::string> 易迅商品子单套餐id
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->tradeSellerSendTime_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->warranty_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->productId_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->productCode_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonEdmCode_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonOTag_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonTradeShopGuideCost_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneType_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneOperator_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneNumber_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneArea_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhonePackageId_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneUserName_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneUserAddr_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneUserMobile_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneUserTel_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneIdCardNo_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneIdCardAddr_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneIdCardDate_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneZipCode_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhoneCardPrice_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonCSPhonePackagePrice_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonTradeFlag_u);	//<uint8_t> 易迅商品子单flag
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonPointType_u);	//<uint8_t> 易迅积分兑换类型
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->icsonPackageIds_u);	//<uint8_t> 易迅商品子单套餐id
		}
		if($this->version >= 2){
			$bs->pushUint32_t($this->icsonTradeCashBack);	//<uint32_t> 子单返现金额
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->icsonTradeCashBack_u);	//<uint8_t> 子单返现金额UFlag
		}
		if($this->version >= 3){
			$bs->pushString($this->icsonUnitCostInvoice);	//<std::string> 去税后成本
		}
		if($this->version >= 3){
			$bs->pushUint8_t($this->icsonUnitCostInvoice_u);	//<uint8_t> 去税后成本UFlag
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['dealId'] = $bs->popString();	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		$this->_arr_value['dealId64'] = $bs->popUint64_t();	//<uint64_t> 订单单号，统一平台内部单号
		$this->_arr_value['bdealId'] = $bs->popUint64_t();	//<uint64_t> 交易单号，买卖家一次交易行为描述
		$this->_arr_value['tradeId'] = $bs->popUint64_t();	//<uint64_t> 商品订单号
		$this->_arr_value['recvFeeId'] = $bs->popUint64_t();	//<uint64_t> 打款单ID
		$this->_arr_value['buyerId'] = $bs->popUint64_t();	//<uint64_t> 买家ID
		$this->_arr_value['buyerNickName'] = $bs->popString();	//<std::string> 买家昵称
		$this->_arr_value['sellerId'] = $bs->popUint64_t();	//<uint64_t> 商家ID
		$this->_arr_value['sellerTitle'] = $bs->popString();	//<std::string> 商家名称
		$this->_arr_value['businessId'] = $bs->popUint32_t();	//<uint32_t> 业务ID
		$this->_arr_value['tradeType'] = $bs->popUint8_t();	//<uint8_t> 订单类型
		$this->_arr_value['tradeSource'] = $bs->popUint32_t();	//<uint32_t> 下单渠道：1：业务主站；2：移动app；3：移动wap
		$this->_arr_value['tradePayType'] = $bs->popUint8_t();	//<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款
		$this->_arr_value['token'] = $bs->popString();	//<std::string> 打款Token，兼容拍拍商品单
		$this->_arr_value['drawId'] = $bs->popString();	//<std::string> 打款DrawId，兼容拍拍商品单
		$this->_arr_value['shippingfeeTemplateId'] = $bs->popString();	//<std::string> 运费模版ID
		$this->_arr_value['shippingfeeDesc'] = $bs->popString();	//<std::string> 运费描述
		$this->_arr_value['itemShippingfee'] = $bs->popUint32_t();	//<uint32_t> 商品运费
		$this->_arr_value['itemType'] = $bs->popUint32_t();	//<uint32_t> 商品类型；1：普通商品；2：套餐主商品；3：套餐副商品；4：赠品主商品；5：赠品副商品; 6:组件
		$this->_arr_value['itemClassId'] = $bs->popUint32_t();	//<uint32_t> 品类（类目）ID
		$this->_arr_value['itemTitle'] = $bs->popString();	//<std::string> 商品标题
		$this->_arr_value['itemAttrCode'] = $bs->popString();	//<std::string> 商品销售属性编码
		$this->_arr_value['itemAttr'] = $bs->popString();	//<std::string> 商品销售属性描述
		$this->_arr_value['itemId'] = $bs->popString();	//<std::string> 商品ID，由业务定义
		$this->_arr_value['itemSkuId'] = $bs->popUint64_t();	//<uint64_t> 商品SKUID
		$this->_arr_value['itemLocalCode'] = $bs->popString();	//<std::string> 商品商家本地编码
		$this->_arr_value['itemLocalStockCode'] = $bs->popString();	//<std::string> 商品商家本地库存编码
		$this->_arr_value['itemBarCode'] = $bs->popString();	//<std::string> 商品条形码
		$this->_arr_value['itemSpuId'] = $bs->popUint64_t();	//<uint64_t> 商品SPUID
		$this->_arr_value['itemStockId'] = $bs->popUint64_t();	//<uint64_t> 商品库存ID
		$this->_arr_value['itemStoreHouseId'] = $bs->popUint32_t();	//<uint32_t> 商品仓库ID
		$this->_arr_value['itemPhyisicalStorage'] = $bs->popString();	//<std::string> 商品所属物理仓
		$this->_arr_value['itemLogo'] = $bs->popString();	//<std::string> 商品图片Logo
		$this->_arr_value['itemSnapVersion'] = $bs->popUint32_t();	//<uint32_t> 商品快照版本号
		$this->_arr_value['itemResetTime'] = $bs->popUint32_t();	//<uint32_t> 商品重置时间戳
		$this->_arr_value['itemWeight'] = $bs->popUint32_t();	//<uint32_t> 商品重量
		$this->_arr_value['itemVolume'] = $bs->popUint32_t();	//<uint32_t> 商品体积
		$this->_arr_value['mainItemId'] = $bs->popUint64_t();	//<uint64_t> 商品套餐主商品ID
		$this->_arr_value['itemAccessoryDesc'] = $bs->popString();	//<std::string> 商品标配说明
		$this->_arr_value['itemCostPrice'] = $bs->popUint32_t();	//<uint32_t> 商品成本价
		$this->_arr_value['itemOriginPrice'] = $bs->popUint32_t();	//<uint32_t> 商品市场价
		$this->_arr_value['itemSoldPrice'] = $bs->popUint32_t();	//<uint32_t> 商品销售单价
		$this->_arr_value['itemB2CMarket'] = $bs->popString();	//<std::string> 自营B2C市场
		$this->_arr_value['itemB2CPM'] = $bs->popString();	//<std::string> 自营B2CPM
		$this->_arr_value['itemUseVirtualStock'] = $bs->popUint8_t();	//<uint8_t> 自营B2C是否占用虚库
		$this->_arr_value['buyPrice'] = $bs->popUint32_t();	//<uint32_t> 商品成交价
		$this->_arr_value['buyNum'] = $bs->popUint32_t();	//<uint32_t> 商品成交件数
		$this->_arr_value['tradeTotalFee'] = $bs->popUint32_t();	//<uint32_t> 商品单总金额,下单金额
		$this->_arr_value['tradeAdjustFee'] = $bs->popInt32_t();	//<int> 商品单调价金额
		$this->_arr_value['tradePayment'] = $bs->popUint32_t();	//<uint32_t> 实付总金额
		$this->_arr_value['tradeDiscountTotal'] = $bs->popInt32_t();	//<int> 优惠总金额
		$this->_arr_value['tradePaipaiHongbaoUsed'] = $bs->popUint32_t();	//<uint32_t> Paipai红包使用金额
		$this->_arr_value['payScore'] = $bs->popUint32_t();	//<uint32_t> 积分支付值
		$this->_arr_value['tradeGenTime'] = $bs->popUint32_t();	//<uint32_t> 商品单生成时间
		$this->_arr_value['tradeOpSerialNo'] = $bs->popUint16_t();	//<uint16_t> 商品单库存操作序列号
		$this->_arr_value['obtainScore'] = $bs->popUint32_t();	//<uint32_t> 获得积分值
		$this->_arr_value['tradeState'] = $bs->popUint32_t();	//<uint32_t> 商品单状态
		$this->_arr_value['preTradeState'] = $bs->popUint32_t();	//<uint32_t> 商品单前一个状态
		$this->_arr_value['tradeProperty'] = $bs->popUint32_t();	//<uint32_t> 商品单属性值
		$this->_arr_value['tradeProperty1'] = $bs->popUint32_t();	//<uint32_t> 商品单属性值1
		$this->_arr_value['tradeProperty2'] = $bs->popUint32_t();	//<uint32_t> 商品单属性值2
		$this->_arr_value['tradeProperty3'] = $bs->popUint32_t();	//<uint32_t> 商品单属性值3
		$this->_arr_value['tradeProperty4'] = $bs->popUint32_t();	//<uint32_t> 商品单属性值4
		$this->_arr_value['refundState'] = $bs->popUint32_t();	//<uint32_t> 退款状态, 各退款单的汇总状态, 0:无退款,1:退款中,2:退款完成
		$this->_arr_value['refundDetailState'] = $bs->popUint32_t();	//<uint32_t> 冗余退款单的退款状态，拍拍同步订单使用
		$this->_arr_value['dealRefundState'] = $bs->popUint32_t();	//<uint32_t> 订单退款状态, 冗余DealDo上的值, 各子单退款状态的汇总, 0:无退款,1:退款中,2:退款完成
		$this->_arr_value['evalState'] = $bs->popUint32_t();	//<uint32_t> 评价评论状态
		$this->_arr_value['tradePayTime'] = $bs->popUint32_t();	//<uint32_t> 付款时间
		$this->_arr_value['tradeCheckTime'] = $bs->popUint32_t();	//<uint32_t> 审核时间
		$this->_arr_value['tradeConsignTime'] = $bs->popUint32_t();	//<uint32_t> 标记发货时间
		$this->_arr_value['tradeMarkNoStockTime'] = $bs->popUint32_t();	//<uint32_t> 标记缺货时间
		$this->_arr_value['delayConfirmDays'] = $bs->popUint32_t();	//<uint32_t> 延长确认收货天数
		$this->_arr_value['tradeConfirmRecvTime'] = $bs->popUint32_t();	//<uint32_t> 签收时间
		$this->_arr_value['tradeEndTime'] = $bs->popUint32_t();	//<uint32_t> 结束时间
		$this->_arr_value['tradeRecvFeeTime'] = $bs->popUint32_t();	//<uint32_t> 打款时间
		$this->_arr_value['tradeRecvFeeReturnTime'] = $bs->popUint32_t();	//<uint32_t> 打款返回时间
		$this->_arr_value['stockoutNum'] = $bs->popUint32_t();	//<uint32_t> 商品缺货总件数
		$this->_arr_value['refuseNum'] = $bs->popUint32_t();	//<uint32_t> 拒收总件数
		$this->_arr_value['doneNum'] = $bs->popUint32_t();	//<uint32_t> 实际成交件数
		$this->_arr_value['closeReasonType'] = $bs->popUint8_t();	//<uint8_t> 订单关闭原因类型
		$this->_arr_value['closeReasonDesc'] = $bs->popString();	//<std::string> 订单关闭原因描述
		$this->_arr_value['sellerTotalRecvFee'] = $bs->popUint32_t();	//<uint32_t> 卖家到账总金额
		$this->_arr_value['buyerTotalRecvFee'] = $bs->popUint32_t();	//<uint32_t> 买家到账总金额
		$this->_arr_value['itemTimeoutFlag'] = $bs->popUint32_t();	//<uint32_t> 商品超时标识
		$this->_arr_value['lastUpdateTime'] = $bs->popUint32_t();	//<uint32_t> 最后更新时间
		$this->_arr_value['activeInfoList'] = $bs->popObject('\ecc\deal\po\TradeActivePoList');	//<ecc::deal::po::CTradeActivePoList> 商品活动列表
		$this->_arr_value['dealExtInfoMap'] = $bs->popObject('stl_multimap<uint32_t,stl_string>');	//<std::multimap<uint32_t,std::string> > 订单扩展信息 
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId64_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvFeeId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerNickName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerTitle_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['businessId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeSource_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradePayType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['token_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['drawId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shippingfeeTemplateId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shippingfeeDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemShippingfee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemClassId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemTitle_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemAttrCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemAttr_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemSkuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemLocalCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemLocalStockCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemBarCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemSpuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemStockId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemStoreHouseId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemPhyisicalStorage_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemLogo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemSnapVersion_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemResetTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemWeight_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemVolume_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mainItemId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemAccessoryDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemCostPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemOriginPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemSoldPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemB2CMarket_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemB2CPM_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemUseVirtualStock_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeTotalFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeAdjustFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradePayment_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeDiscountTotal_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradePaipaiHongbaoUsed_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payScore_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeGenTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeOpSerialNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['obtainScore_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['preTradeState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeProperty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeProperty1_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeProperty2_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeProperty3_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeProperty4_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundDetailState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealRefundState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['evalState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradePayTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeCheckTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeConsignTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeMarkNoStockTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['delayConfirmDays_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeConfirmRecvTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeEndTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeRecvFeeTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeRecvFeeReturnTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockoutNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refuseNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['doneNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['closeReasonType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['closeReasonDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerTotalRecvFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerTotalRecvFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemTimeoutFlag_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['lastUpdateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['activeInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealExtInfoMap_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['tradeSellerSendTime'] = $bs->popUint32_t();	//<uint32_t> 标记发货时间
		}
		if($this->version >= 1){
			$this->_arr_value['warranty'] = $bs->popString();	//<std::string> 保修条款
		}
		if($this->version >= 1){
			$this->_arr_value['productId'] = $bs->popUint64_t();	//<uint64_t> 产品id
		}
		if($this->version >= 1){
			$this->_arr_value['productCode'] = $bs->popString();	//<std::string> 产品id编码
		}
		if($this->version >= 1){
			$this->_arr_value['icsonEdmCode'] = $bs->popString();	//<std::string> 易迅edm编码
		}
		if($this->version >= 1){
			$this->_arr_value['icsonOTag'] = $bs->popString();	//<std::string> 易迅OTag
		}
		if($this->version >= 1){
			$this->_arr_value['icsonTradeShopGuideCost'] = $bs->popString();	//<std::string> 易迅店铺导购费用
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneType'] = $bs->popString();	//<std::string> 易迅定制机类型
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneOperator'] = $bs->popString();	//<std::string> 易迅定制机运营商
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneNumber'] = $bs->popString();	//<std::string> 易迅定制机号码
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneArea'] = $bs->popString();	//<std::string> 易迅定制机归属地
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhonePackageId'] = $bs->popString();	//<std::string> 易迅定制机套餐id
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneUserName'] = $bs->popString();	//<std::string> 易迅定制机用户姓名
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneUserAddr'] = $bs->popString();	//<std::string> 易迅定制机用户地址
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneUserMobile'] = $bs->popString();	//<std::string> 易迅定制机用户联系手机
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneUserTel'] = $bs->popString();	//<std::string> 易迅定制机用户联系电话
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneIdCardNo'] = $bs->popString();	//<std::string> 易迅定制机身份证号码
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneIdCardAddr'] = $bs->popString();	//<std::string> 易迅定制机身份证地址
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneIdCardDate'] = $bs->popString();	//<std::string> 易迅定制机身份证有效期
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneZipCode'] = $bs->popString();	//<std::string> 易迅定制机邮政编码
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneCardPrice'] = $bs->popString();	//<std::string> 易迅定制机卡价格
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhonePackagePrice'] = $bs->popString();	//<std::string> 易迅定制机套餐价格
		}
		if($this->version >= 1){
			$this->_arr_value['icsonTradeFlag'] = $bs->popString();	//<std::string> 易迅商品子单flag
		}
		if($this->version >= 1){
			$this->_arr_value['icsonPointType'] = $bs->popString();	//<std::string> 易迅积分兑换类型
		}
		if($this->version >= 1){
			$this->_arr_value['icsonPackageIds'] = $bs->popString();	//<std::string> 易迅商品子单套餐id
		}
		if($this->version >= 1){
			$this->_arr_value['tradeSellerSendTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['warranty_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['productId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['productCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonEdmCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonOTag_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonTradeShopGuideCost_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneType_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneOperator_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneNumber_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneArea_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhonePackageId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneUserName_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneUserAddr_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneUserMobile_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneUserTel_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneIdCardNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneIdCardAddr_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneIdCardDate_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneZipCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhoneCardPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonCSPhonePackagePrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['icsonTradeFlag_u'] = $bs->popUint8_t();	//<uint8_t> 易迅商品子单flag
		}
		if($this->version >= 1){
			$this->_arr_value['icsonPointType_u'] = $bs->popUint8_t();	//<uint8_t> 易迅积分兑换类型
		}
		if($this->version >= 1){
			$this->_arr_value['icsonPackageIds_u'] = $bs->popUint8_t();	//<uint8_t> 易迅商品子单套餐id
		}
		if($this->version >= 2){
			$this->_arr_value['icsonTradeCashBack'] = $bs->popUint32_t();	//<uint32_t> 子单返现金额
		}
		if($this->version >= 2){
			$this->_arr_value['icsonTradeCashBack_u'] = $bs->popUint8_t();	//<uint8_t> 子单返现金额UFlag
		}
		if($this->version >= 3){
			$this->_arr_value['icsonUnitCostInvoice'] = $bs->popString();	//<std::string> 去税后成本
		}
		if($this->version >= 3){
			$this->_arr_value['icsonUnitCostInvoice_u'] = $bs->popUint8_t();	//<uint8_t> 去税后成本UFlag
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

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.DealPo.java
class RecvFeePoList{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 版本号(版本>=0)
	private $recvFeeInfoList;	//<std::vector<ecc::deal::po::CRecvFeePo> > 打款单列表(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $recvFeeInfoList_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->recvFeeInfoList = new \stl_vector2('\ecc\deal\po\RecvFeePo');	//<std::vector<ecc::deal::po::CRecvFeePo> >
		$this->version_u = 0;	//<uint8_t>
		$this->recvFeeInfoList_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\po\RecvFeePoList\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\RecvFeePoList\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 版本号
		$bs->pushObject($this->recvFeeInfoList,'stl_vector');	//<std::vector<ecc::deal::po::CRecvFeePo> > 打款单列表
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvFeeInfoList_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 版本号
		$this->_arr_value['recvFeeInfoList'] = $bs->popObject('stl_vector<\ecc\deal\po\RecvFeePo>');	//<std::vector<ecc::deal::po::CRecvFeePo> > 打款单列表
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvFeeInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.RecvFeePoList.java
class RecvFeePo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 版本号(版本>=0)
	private $control;	//<uint32_t> 打款单DB操作类型，0:Insert 1:Update(版本>=0)
	private $recvFeeId;	//<uint64_t> 退款单ID(版本>=0)
	private $dealId;	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702(版本>=0)
	private $dealId64;	//<uint64_t> 订单单号，统一平台内部单号(版本>=0)
	private $payId;	//<uint64_t> 支付单ID(版本>=0)
	private $cftDealId;	//<std::string> 财付通订单ID(版本>=0)
	private $drawId;	//<std::string> 打款标识(版本>=0)
	private $drawToken;	//<std::string> 打款token(版本>=0)
	private $buyerId;	//<uint64_t> 买家ID(版本>=0)
	private $buyerAccount;	//<std::string> 买家帐号(版本>=0)
	private $buyerRecvFee;	//<uint32_t> 买家收到金额(版本>=0)
	private $sellerId;	//<uint64_t> 商家ID(版本>=0)
	private $sellerAccount;	//<std::string> 商家帐号(版本>=0)
	private $sellerRecvFee;	//<uint32_t> 卖家收到金额(版本>=0)
	private $itemTitleList;	//<std::string> 商品标题列表(版本>=0)
	private $recvFeeState;	//<uint32_t> 打款单状态，1，已发起打款；2，打款完成(版本>=0)
	private $recvFeeType;	//<uint32_t> 打款单类型，1确认收货打款  2全额退款打款 3售后打款 4仲裁后打款(版本>=0)
	private $recvFeeFinishTime;	//<uint32_t> 打款完成时间(版本>=0)
	private $recvFeeReturnTime;	//<uint32_t> 打款返回时间(版本>=0)
	private $recvFeeGenTime;	//<uint32_t> 打款发起时间(版本>=0)
	private $lastUpdateTime;	//<uint32_t> 最后更新时间(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $control_u;	//<uint8_t> (版本>=0)
	private $recvFeeId_u;	//<uint8_t> (版本>=0)
	private $dealId_u;	//<uint8_t> (版本>=0)
	private $dealId64_u;	//<uint8_t> (版本>=0)
	private $payId_u;	//<uint8_t> (版本>=0)
	private $cftDealId_u;	//<uint8_t> (版本>=0)
	private $drawId_u;	//<uint8_t> (版本>=0)
	private $drawToken_u;	//<uint8_t> (版本>=0)
	private $buyerId_u;	//<uint8_t> (版本>=0)
	private $buyerAccount_u;	//<uint8_t> (版本>=0)
	private $buyerRecvFee_u;	//<uint8_t> (版本>=0)
	private $sellerId_u;	//<uint8_t> (版本>=0)
	private $sellerAccount_u;	//<uint8_t> (版本>=0)
	private $sellerRecvFee_u;	//<uint8_t> (版本>=0)
	private $itemTitleList_u;	//<uint8_t> (版本>=0)
	private $recvFeeState_u;	//<uint8_t> (版本>=0)
	private $recvFeeType_u;	//<uint8_t> (版本>=0)
	private $recvFeeFinishTime_u;	//<uint8_t> (版本>=0)
	private $recvFeeReturnTime_u;	//<uint8_t> (版本>=0)
	private $recvFeeGenTime_u;	//<uint8_t> (版本>=0)
	private $lastUpdateTime_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->control = 0;	//<uint32_t>
		$this->recvFeeId = 0;	//<uint64_t>
		$this->dealId = "";	//<std::string>
		$this->dealId64 = 0;	//<uint64_t>
		$this->payId = 0;	//<uint64_t>
		$this->cftDealId = "";	//<std::string>
		$this->drawId = "";	//<std::string>
		$this->drawToken = "";	//<std::string>
		$this->buyerId = 0;	//<uint64_t>
		$this->buyerAccount = "";	//<std::string>
		$this->buyerRecvFee = 0;	//<uint32_t>
		$this->sellerId = 0;	//<uint64_t>
		$this->sellerAccount = "";	//<std::string>
		$this->sellerRecvFee = 0;	//<uint32_t>
		$this->itemTitleList = "";	//<std::string>
		$this->recvFeeState = 0;	//<uint32_t>
		$this->recvFeeType = 0;	//<uint32_t>
		$this->recvFeeFinishTime = 0;	//<uint32_t>
		$this->recvFeeReturnTime = 0;	//<uint32_t>
		$this->recvFeeGenTime = 0;	//<uint32_t>
		$this->lastUpdateTime = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->control_u = 0;	//<uint8_t>
		$this->recvFeeId_u = 0;	//<uint8_t>
		$this->dealId_u = 0;	//<uint8_t>
		$this->dealId64_u = 0;	//<uint8_t>
		$this->payId_u = 0;	//<uint8_t>
		$this->cftDealId_u = 0;	//<uint8_t>
		$this->drawId_u = 0;	//<uint8_t>
		$this->drawToken_u = 0;	//<uint8_t>
		$this->buyerId_u = 0;	//<uint8_t>
		$this->buyerAccount_u = 0;	//<uint8_t>
		$this->buyerRecvFee_u = 0;	//<uint8_t>
		$this->sellerId_u = 0;	//<uint8_t>
		$this->sellerAccount_u = 0;	//<uint8_t>
		$this->sellerRecvFee_u = 0;	//<uint8_t>
		$this->itemTitleList_u = 0;	//<uint8_t>
		$this->recvFeeState_u = 0;	//<uint8_t>
		$this->recvFeeType_u = 0;	//<uint8_t>
		$this->recvFeeFinishTime_u = 0;	//<uint8_t>
		$this->recvFeeReturnTime_u = 0;	//<uint8_t>
		$this->recvFeeGenTime_u = 0;	//<uint8_t>
		$this->lastUpdateTime_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\po\RecvFeePo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\RecvFeePo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 版本号
		$bs->pushUint32_t($this->control);	//<uint32_t> 打款单DB操作类型，0:Insert 1:Update
		$bs->pushUint64_t($this->recvFeeId);	//<uint64_t> 退款单ID
		$bs->pushString($this->dealId);	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		$bs->pushUint64_t($this->dealId64);	//<uint64_t> 订单单号，统一平台内部单号
		$bs->pushUint64_t($this->payId);	//<uint64_t> 支付单ID
		$bs->pushString($this->cftDealId);	//<std::string> 财付通订单ID
		$bs->pushString($this->drawId);	//<std::string> 打款标识
		$bs->pushString($this->drawToken);	//<std::string> 打款token
		$bs->pushUint64_t($this->buyerId);	//<uint64_t> 买家ID
		$bs->pushString($this->buyerAccount);	//<std::string> 买家帐号
		$bs->pushUint32_t($this->buyerRecvFee);	//<uint32_t> 买家收到金额
		$bs->pushUint64_t($this->sellerId);	//<uint64_t> 商家ID
		$bs->pushString($this->sellerAccount);	//<std::string> 商家帐号
		$bs->pushUint32_t($this->sellerRecvFee);	//<uint32_t> 卖家收到金额
		$bs->pushString($this->itemTitleList);	//<std::string> 商品标题列表
		$bs->pushUint32_t($this->recvFeeState);	//<uint32_t> 打款单状态，1，已发起打款；2，打款完成
		$bs->pushUint32_t($this->recvFeeType);	//<uint32_t> 打款单类型，1确认收货打款  2全额退款打款 3售后打款 4仲裁后打款
		$bs->pushUint32_t($this->recvFeeFinishTime);	//<uint32_t> 打款完成时间
		$bs->pushUint32_t($this->recvFeeReturnTime);	//<uint32_t> 打款返回时间
		$bs->pushUint32_t($this->recvFeeGenTime);	//<uint32_t> 打款发起时间
		$bs->pushUint32_t($this->lastUpdateTime);	//<uint32_t> 最后更新时间
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->control_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvFeeId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId64_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->cftDealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->drawId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->drawToken_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerAccount_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerRecvFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerAccount_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerRecvFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemTitleList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvFeeState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvFeeType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvFeeFinishTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvFeeReturnTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvFeeGenTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->lastUpdateTime_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 版本号
		$this->_arr_value['control'] = $bs->popUint32_t();	//<uint32_t> 打款单DB操作类型，0:Insert 1:Update
		$this->_arr_value['recvFeeId'] = $bs->popUint64_t();	//<uint64_t> 退款单ID
		$this->_arr_value['dealId'] = $bs->popString();	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		$this->_arr_value['dealId64'] = $bs->popUint64_t();	//<uint64_t> 订单单号，统一平台内部单号
		$this->_arr_value['payId'] = $bs->popUint64_t();	//<uint64_t> 支付单ID
		$this->_arr_value['cftDealId'] = $bs->popString();	//<std::string> 财付通订单ID
		$this->_arr_value['drawId'] = $bs->popString();	//<std::string> 打款标识
		$this->_arr_value['drawToken'] = $bs->popString();	//<std::string> 打款token
		$this->_arr_value['buyerId'] = $bs->popUint64_t();	//<uint64_t> 买家ID
		$this->_arr_value['buyerAccount'] = $bs->popString();	//<std::string> 买家帐号
		$this->_arr_value['buyerRecvFee'] = $bs->popUint32_t();	//<uint32_t> 买家收到金额
		$this->_arr_value['sellerId'] = $bs->popUint64_t();	//<uint64_t> 商家ID
		$this->_arr_value['sellerAccount'] = $bs->popString();	//<std::string> 商家帐号
		$this->_arr_value['sellerRecvFee'] = $bs->popUint32_t();	//<uint32_t> 卖家收到金额
		$this->_arr_value['itemTitleList'] = $bs->popString();	//<std::string> 商品标题列表
		$this->_arr_value['recvFeeState'] = $bs->popUint32_t();	//<uint32_t> 打款单状态，1，已发起打款；2，打款完成
		$this->_arr_value['recvFeeType'] = $bs->popUint32_t();	//<uint32_t> 打款单类型，1确认收货打款  2全额退款打款 3售后打款 4仲裁后打款
		$this->_arr_value['recvFeeFinishTime'] = $bs->popUint32_t();	//<uint32_t> 打款完成时间
		$this->_arr_value['recvFeeReturnTime'] = $bs->popUint32_t();	//<uint32_t> 打款返回时间
		$this->_arr_value['recvFeeGenTime'] = $bs->popUint32_t();	//<uint32_t> 打款发起时间
		$this->_arr_value['lastUpdateTime'] = $bs->popUint32_t();	//<uint32_t> 最后更新时间
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['control_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvFeeId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId64_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cftDealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['drawId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['drawToken_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerAccount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerRecvFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerAccount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerRecvFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemTitleList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvFeeState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvFeeType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvFeeFinishTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvFeeReturnTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvFeeGenTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['lastUpdateTime_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.DealPo.java
class DealWuliuPoList{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 版本号(版本>=0)
	private $wuliuInfoList;	//<std::vector<ecc::deal::po::CDealWuliuPo> > 物流单列表(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $wuliuInfoList_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->wuliuInfoList = new \stl_vector2('\ecc\deal\po\DealWuliuPo');	//<std::vector<ecc::deal::po::CDealWuliuPo> >
		$this->version_u = 0;	//<uint8_t>
		$this->wuliuInfoList_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\po\DealWuliuPoList\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\DealWuliuPoList\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 版本号
		$bs->pushObject($this->wuliuInfoList,'stl_vector');	//<std::vector<ecc::deal::po::CDealWuliuPo> > 物流单列表
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->wuliuInfoList_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 版本号
		$this->_arr_value['wuliuInfoList'] = $bs->popObject('stl_vector<\ecc\deal\po\DealWuliuPo>');	//<std::vector<ecc::deal::po::CDealWuliuPo> > 物流单列表
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['wuliuInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.DealWuliuPoList.java
class DealWuliuPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 版本号(版本>=0)
	private $control;	//<uint32_t> 物流单DB操作类型，0:Insert 1:Update(版本>=0)
	private $dealId;	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702(版本>=0)
	private $dealId64;	//<uint64_t> 订单单号，统一平台内部单号(版本>=0)
	private $innerWuliuId;	//<uint64_t> 统一平台内部物流单号(版本>=0)
	private $buyerId;	//<uint64_t> 买家ID(版本>=0)
	private $buyerNickName;	//<std::string> 买家昵称(版本>=0)
	private $sellerId;	//<uint64_t> 商家ID(版本>=0)
	private $sellerTitle;	//<std::string> 商家名称(版本>=0)
	private $wuliuDealId;	//<std::string> 物流订单号，物流系统维护(版本>=0)
	private $expressType;	//<uint8_t> 配送方式；1：平邮；2：快递；3：EMS；4：B2C自建物流；5：用户配送点自提(版本>=0)
	private $expressCompanyID;	//<std::string> 物流公司ID(版本>=0)
	private $expressCompanyName;	//<std::string> 物流公司名称(版本>=0)
	private $expressDealID;	//<std::string> 物流公司订单号(版本>=0)
	private $expectArriveDays;	//<uint16_t> 预计到达天数(版本>=0)
	private $tradeInfoList;	//<std::string> 商品单信息列表：TradeId1:件数1;TradeId2:件数2..(版本>=0)
	private $itemTitleList;	//<std::string> 商品标题列表(版本>=0)
	private $recvName;	//<std::string> 收货人姓名(版本>=0)
	private $recvRegionCode;	//<uint32_t> 收货地区编码(版本>=0)
	private $recvAddress;	//<std::string> 收货地址(版本>=0)
	private $recvPostCode;	//<std::string> 邮编(版本>=0)
	private $recvPhone;	//<std::string> 收货人电话(版本>=0)
	private $recvMobile;	//<uint64_t> 收货人手机(版本>=0)
	private $recvExpectDate;	//<uint32_t> 期望收货日期(版本>=0)
	private $recvExpectTimeSpan;	//<std::string> 期望收货时间段(版本>=0)
	private $recvRemark;	//<std::string> 收货附言(版本>=0)
	private $recvMask;	//<uint32_t> 收货属性(版本>=0)
	private $sellerConsignNote;	//<std::string> 商家发货附言(版本>=0)
	private $wuliuGetItemAddr;	//<std::string> 物流取件地址(版本>=0)
	private $wuliuSendTime;	//<uint32_t> 物流发货时间(版本>=0)
	private $wuliuRecvTime;	//<uint32_t> 物流收货时间(版本>=0)
	private $wuliuGenTime;	//<uint32_t> 物流单生成时间(版本>=0)
	private $lastUpdateTime;	//<uint32_t> 记录更新时间(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $control_u;	//<uint8_t> (版本>=0)
	private $dealId_u;	//<uint8_t> (版本>=0)
	private $dealId64_u;	//<uint8_t> (版本>=0)
	private $innerWuliuId_u;	//<uint8_t> (版本>=0)
	private $buyerId_u;	//<uint8_t> (版本>=0)
	private $buyerNickName_u;	//<uint8_t> (版本>=0)
	private $sellerId_u;	//<uint8_t> (版本>=0)
	private $sellerTitle_u;	//<uint8_t> (版本>=0)
	private $wuliuDealId_u;	//<uint8_t> (版本>=0)
	private $expressType_u;	//<uint8_t> (版本>=0)
	private $expressCompanyID_u;	//<uint8_t> (版本>=0)
	private $expressCompanyName_u;	//<uint8_t> (版本>=0)
	private $expressDealID_u;	//<uint8_t> (版本>=0)
	private $expectArriveDays_u;	//<uint8_t> (版本>=0)
	private $tradeInfoList_u;	//<uint8_t> (版本>=0)
	private $itemTitleList_u;	//<uint8_t> (版本>=0)
	private $recvName_u;	//<uint8_t> (版本>=0)
	private $recvRegionCode_u;	//<uint8_t> (版本>=0)
	private $recvAddress_u;	//<uint8_t> (版本>=0)
	private $recvPostCode_u;	//<uint8_t> (版本>=0)
	private $recvPhone_u;	//<uint8_t> (版本>=0)
	private $recvMobile_u;	//<uint8_t> (版本>=0)
	private $recvExpectDate_u;	//<uint8_t> (版本>=0)
	private $recvExpectTimeSpan_u;	//<uint8_t> (版本>=0)
	private $recvRemark_u;	//<uint8_t> (版本>=0)
	private $recvMask_u;	//<uint8_t> (版本>=0)
	private $sellerConsignNote_u;	//<uint8_t> (版本>=0)
	private $wuliuGetItemAddr_u;	//<uint8_t> (版本>=0)
	private $wuliuSendTime_u;	//<uint8_t> (版本>=0)
	private $wuliuRecvTime_u;	//<uint8_t> (版本>=0)
	private $wuliuGenTime_u;	//<uint8_t> (版本>=0)
	private $lastUpdateTime_u;	//<uint8_t> (版本>=0)
	private $recvRegionCodeExt;	//<std::string> 扩展地区编码(版本>=1)
	private $recvRegionCodeExt_u;	//<uint8_t> 扩展地区编码UFlag(版本>=1)

	function __construct(){
		$this->version = 1;	//<uint16_t>
		$this->control = 0;	//<uint32_t>
		$this->dealId = "";	//<std::string>
		$this->dealId64 = 0;	//<uint64_t>
		$this->innerWuliuId = 0;	//<uint64_t>
		$this->buyerId = 0;	//<uint64_t>
		$this->buyerNickName = "";	//<std::string>
		$this->sellerId = 0;	//<uint64_t>
		$this->sellerTitle = "";	//<std::string>
		$this->wuliuDealId = "";	//<std::string>
		$this->expressType = 0;	//<uint8_t>
		$this->expressCompanyID = "";	//<std::string>
		$this->expressCompanyName = "";	//<std::string>
		$this->expressDealID = "";	//<std::string>
		$this->expectArriveDays = 0;	//<uint16_t>
		$this->tradeInfoList = "";	//<std::string>
		$this->itemTitleList = "";	//<std::string>
		$this->recvName = "";	//<std::string>
		$this->recvRegionCode = 0;	//<uint32_t>
		$this->recvAddress = "";	//<std::string>
		$this->recvPostCode = "";	//<std::string>
		$this->recvPhone = "";	//<std::string>
		$this->recvMobile = 0;	//<uint64_t>
		$this->recvExpectDate = 0;	//<uint32_t>
		$this->recvExpectTimeSpan = "";	//<std::string>
		$this->recvRemark = "";	//<std::string>
		$this->recvMask = 0;	//<uint32_t>
		$this->sellerConsignNote = "";	//<std::string>
		$this->wuliuGetItemAddr = "";	//<std::string>
		$this->wuliuSendTime = 0;	//<uint32_t>
		$this->wuliuRecvTime = 0;	//<uint32_t>
		$this->wuliuGenTime = 0;	//<uint32_t>
		$this->lastUpdateTime = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->control_u = 0;	//<uint8_t>
		$this->dealId_u = 0;	//<uint8_t>
		$this->dealId64_u = 0;	//<uint8_t>
		$this->innerWuliuId_u = 0;	//<uint8_t>
		$this->buyerId_u = 0;	//<uint8_t>
		$this->buyerNickName_u = 0;	//<uint8_t>
		$this->sellerId_u = 0;	//<uint8_t>
		$this->sellerTitle_u = 0;	//<uint8_t>
		$this->wuliuDealId_u = 0;	//<uint8_t>
		$this->expressType_u = 0;	//<uint8_t>
		$this->expressCompanyID_u = 0;	//<uint8_t>
		$this->expressCompanyName_u = 0;	//<uint8_t>
		$this->expressDealID_u = 0;	//<uint8_t>
		$this->expectArriveDays_u = 0;	//<uint8_t>
		$this->tradeInfoList_u = 0;	//<uint8_t>
		$this->itemTitleList_u = 0;	//<uint8_t>
		$this->recvName_u = 0;	//<uint8_t>
		$this->recvRegionCode_u = 0;	//<uint8_t>
		$this->recvAddress_u = 0;	//<uint8_t>
		$this->recvPostCode_u = 0;	//<uint8_t>
		$this->recvPhone_u = 0;	//<uint8_t>
		$this->recvMobile_u = 0;	//<uint8_t>
		$this->recvExpectDate_u = 0;	//<uint8_t>
		$this->recvExpectTimeSpan_u = 0;	//<uint8_t>
		$this->recvRemark_u = 0;	//<uint8_t>
		$this->recvMask_u = 0;	//<uint8_t>
		$this->sellerConsignNote_u = 0;	//<uint8_t>
		$this->wuliuGetItemAddr_u = 0;	//<uint8_t>
		$this->wuliuSendTime_u = 0;	//<uint8_t>
		$this->wuliuRecvTime_u = 0;	//<uint8_t>
		$this->wuliuGenTime_u = 0;	//<uint8_t>
		$this->lastUpdateTime_u = 0;	//<uint8_t>
		$this->recvRegionCodeExt = "";	//<std::string>
		$this->recvRegionCodeExt_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\po\DealWuliuPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\DealWuliuPo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 版本号
		$bs->pushUint32_t($this->control);	//<uint32_t> 物流单DB操作类型，0:Insert 1:Update
		$bs->pushString($this->dealId);	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		$bs->pushUint64_t($this->dealId64);	//<uint64_t> 订单单号，统一平台内部单号
		$bs->pushUint64_t($this->innerWuliuId);	//<uint64_t> 统一平台内部物流单号
		$bs->pushUint64_t($this->buyerId);	//<uint64_t> 买家ID
		$bs->pushString($this->buyerNickName);	//<std::string> 买家昵称
		$bs->pushUint64_t($this->sellerId);	//<uint64_t> 商家ID
		$bs->pushString($this->sellerTitle);	//<std::string> 商家名称
		$bs->pushString($this->wuliuDealId);	//<std::string> 物流订单号，物流系统维护
		$bs->pushUint8_t($this->expressType);	//<uint8_t> 配送方式；1：平邮；2：快递；3：EMS；4：B2C自建物流；5：用户配送点自提
		$bs->pushString($this->expressCompanyID);	//<std::string> 物流公司ID
		$bs->pushString($this->expressCompanyName);	//<std::string> 物流公司名称
		$bs->pushString($this->expressDealID);	//<std::string> 物流公司订单号
		$bs->pushUint16_t($this->expectArriveDays);	//<uint16_t> 预计到达天数
		$bs->pushString($this->tradeInfoList);	//<std::string> 商品单信息列表：TradeId1:件数1;TradeId2:件数2..
		$bs->pushString($this->itemTitleList);	//<std::string> 商品标题列表
		$bs->pushString($this->recvName);	//<std::string> 收货人姓名
		$bs->pushUint32_t($this->recvRegionCode);	//<uint32_t> 收货地区编码
		$bs->pushString($this->recvAddress);	//<std::string> 收货地址
		$bs->pushString($this->recvPostCode);	//<std::string> 邮编
		$bs->pushString($this->recvPhone);	//<std::string> 收货人电话
		$bs->pushUint64_t($this->recvMobile);	//<uint64_t> 收货人手机
		$bs->pushUint32_t($this->recvExpectDate);	//<uint32_t> 期望收货日期
		$bs->pushString($this->recvExpectTimeSpan);	//<std::string> 期望收货时间段
		$bs->pushString($this->recvRemark);	//<std::string> 收货附言
		$bs->pushUint32_t($this->recvMask);	//<uint32_t> 收货属性
		$bs->pushString($this->sellerConsignNote);	//<std::string> 商家发货附言
		$bs->pushString($this->wuliuGetItemAddr);	//<std::string> 物流取件地址
		$bs->pushUint32_t($this->wuliuSendTime);	//<uint32_t> 物流发货时间
		$bs->pushUint32_t($this->wuliuRecvTime);	//<uint32_t> 物流收货时间
		$bs->pushUint32_t($this->wuliuGenTime);	//<uint32_t> 物流单生成时间
		$bs->pushUint32_t($this->lastUpdateTime);	//<uint32_t> 记录更新时间
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->control_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId64_u);	//<uint8_t> 
		$bs->pushUint8_t($this->innerWuliuId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerNickName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerTitle_u);	//<uint8_t> 
		$bs->pushUint8_t($this->wuliuDealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->expressType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->expressCompanyID_u);	//<uint8_t> 
		$bs->pushUint8_t($this->expressCompanyName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->expressDealID_u);	//<uint8_t> 
		$bs->pushUint8_t($this->expectArriveDays_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeInfoList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemTitleList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvRegionCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvAddress_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvPostCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvPhone_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvMobile_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvExpectDate_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvExpectTimeSpan_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvRemark_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvMask_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerConsignNote_u);	//<uint8_t> 
		$bs->pushUint8_t($this->wuliuGetItemAddr_u);	//<uint8_t> 
		$bs->pushUint8_t($this->wuliuSendTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->wuliuRecvTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->wuliuGenTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->lastUpdateTime_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushString($this->recvRegionCodeExt);	//<std::string> 扩展地区编码
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->recvRegionCodeExt_u);	//<uint8_t> 扩展地区编码UFlag
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 版本号
		$this->_arr_value['control'] = $bs->popUint32_t();	//<uint32_t> 物流单DB操作类型，0:Insert 1:Update
		$this->_arr_value['dealId'] = $bs->popString();	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		$this->_arr_value['dealId64'] = $bs->popUint64_t();	//<uint64_t> 订单单号，统一平台内部单号
		$this->_arr_value['innerWuliuId'] = $bs->popUint64_t();	//<uint64_t> 统一平台内部物流单号
		$this->_arr_value['buyerId'] = $bs->popUint64_t();	//<uint64_t> 买家ID
		$this->_arr_value['buyerNickName'] = $bs->popString();	//<std::string> 买家昵称
		$this->_arr_value['sellerId'] = $bs->popUint64_t();	//<uint64_t> 商家ID
		$this->_arr_value['sellerTitle'] = $bs->popString();	//<std::string> 商家名称
		$this->_arr_value['wuliuDealId'] = $bs->popString();	//<std::string> 物流订单号，物流系统维护
		$this->_arr_value['expressType'] = $bs->popUint8_t();	//<uint8_t> 配送方式；1：平邮；2：快递；3：EMS；4：B2C自建物流；5：用户配送点自提
		$this->_arr_value['expressCompanyID'] = $bs->popString();	//<std::string> 物流公司ID
		$this->_arr_value['expressCompanyName'] = $bs->popString();	//<std::string> 物流公司名称
		$this->_arr_value['expressDealID'] = $bs->popString();	//<std::string> 物流公司订单号
		$this->_arr_value['expectArriveDays'] = $bs->popUint16_t();	//<uint16_t> 预计到达天数
		$this->_arr_value['tradeInfoList'] = $bs->popString();	//<std::string> 商品单信息列表：TradeId1:件数1;TradeId2:件数2..
		$this->_arr_value['itemTitleList'] = $bs->popString();	//<std::string> 商品标题列表
		$this->_arr_value['recvName'] = $bs->popString();	//<std::string> 收货人姓名
		$this->_arr_value['recvRegionCode'] = $bs->popUint32_t();	//<uint32_t> 收货地区编码
		$this->_arr_value['recvAddress'] = $bs->popString();	//<std::string> 收货地址
		$this->_arr_value['recvPostCode'] = $bs->popString();	//<std::string> 邮编
		$this->_arr_value['recvPhone'] = $bs->popString();	//<std::string> 收货人电话
		$this->_arr_value['recvMobile'] = $bs->popUint64_t();	//<uint64_t> 收货人手机
		$this->_arr_value['recvExpectDate'] = $bs->popUint32_t();	//<uint32_t> 期望收货日期
		$this->_arr_value['recvExpectTimeSpan'] = $bs->popString();	//<std::string> 期望收货时间段
		$this->_arr_value['recvRemark'] = $bs->popString();	//<std::string> 收货附言
		$this->_arr_value['recvMask'] = $bs->popUint32_t();	//<uint32_t> 收货属性
		$this->_arr_value['sellerConsignNote'] = $bs->popString();	//<std::string> 商家发货附言
		$this->_arr_value['wuliuGetItemAddr'] = $bs->popString();	//<std::string> 物流取件地址
		$this->_arr_value['wuliuSendTime'] = $bs->popUint32_t();	//<uint32_t> 物流发货时间
		$this->_arr_value['wuliuRecvTime'] = $bs->popUint32_t();	//<uint32_t> 物流收货时间
		$this->_arr_value['wuliuGenTime'] = $bs->popUint32_t();	//<uint32_t> 物流单生成时间
		$this->_arr_value['lastUpdateTime'] = $bs->popUint32_t();	//<uint32_t> 记录更新时间
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['control_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId64_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['innerWuliuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerNickName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerTitle_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['wuliuDealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['expressType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['expressCompanyID_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['expressCompanyName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['expressDealID_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['expectArriveDays_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemTitleList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvRegionCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvAddress_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvPostCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvPhone_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvMobile_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvExpectDate_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvExpectTimeSpan_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvRemark_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvMask_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerConsignNote_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['wuliuGetItemAddr_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['wuliuSendTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['wuliuRecvTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['wuliuGenTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['lastUpdateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['recvRegionCodeExt'] = $bs->popString();	//<std::string> 扩展地区编码
		}
		if($this->version >= 1){
			$this->_arr_value['recvRegionCodeExt_u'] = $bs->popUint8_t();	//<uint8_t> 扩展地区编码UFlag
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

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.DealPo.java
class DealActionLogPoList{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 版本号(版本>=0)
	private $dealActionLogInfoList;	//<std::vector<ecc::deal::po::CDealActionLogPo> > 流水列表(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $dealActionLogInfoList_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->dealActionLogInfoList = new \stl_vector2('\ecc\deal\po\DealActionLogPo');	//<std::vector<ecc::deal::po::CDealActionLogPo> >
		$this->version_u = 0;	//<uint8_t>
		$this->dealActionLogInfoList_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\po\DealActionLogPoList\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\DealActionLogPoList\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 版本号
		$bs->pushObject($this->dealActionLogInfoList,'stl_vector');	//<std::vector<ecc::deal::po::CDealActionLogPo> > 流水列表
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealActionLogInfoList_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 版本号
		$this->_arr_value['dealActionLogInfoList'] = $bs->popObject('stl_vector<\ecc\deal\po\DealActionLogPo>');	//<std::vector<ecc::deal::po::CDealActionLogPo> > 流水列表
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealActionLogInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.DealActionLogPoList.java
class DealActionLogPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 版本号(版本>=0)
	private $dealLogId;	//<uint32_t> 订单流水ID(版本>=0)
	private $dealId;	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702(版本>=0)
	private $dealId64;	//<uint64_t> 订单单号，统一平台内部单号(版本>=0)
	private $tradeId;	//<uint64_t> 商品单ID(版本>=0)
	private $buyerId;	//<uint64_t> 买家ID(版本>=0)
	private $sellerId;	//<uint64_t> 商家ID(版本>=0)
	private $operatorType;	//<uint16_t> 订单操作者类别(版本>=0)
	private $operateTime;	//<uint32_t> 流水操作时间(版本>=0)
	private $operationType;	//<uint16_t> 流水操作类型(版本>=0)
	private $operationDesc;	//<std::string> 流水操作描述(版本>=0)
	private $fromState;	//<uint32_t> 操作前状态(版本>=0)
	private $toState;	//<uint32_t> 操作后状态(版本>=0)
	private $operateIP;	//<std::string> 操作来源IP(版本>=0)
	private $operationRemark;	//<std::string> 操作备注(版本>=0)
	private $machineKey;	//<std::string> MachineKey(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $dealLogId_u;	//<uint8_t> (版本>=0)
	private $dealId_u;	//<uint8_t> (版本>=0)
	private $dealId64_u;	//<uint8_t> (版本>=0)
	private $tradeId_u;	//<uint8_t> (版本>=0)
	private $buyerId_u;	//<uint8_t> (版本>=0)
	private $sellerId_u;	//<uint8_t> (版本>=0)
	private $operatorType_u;	//<uint8_t> (版本>=0)
	private $operateTime_u;	//<uint8_t> (版本>=0)
	private $operationType_u;	//<uint8_t> (版本>=0)
	private $operationDesc_u;	//<uint8_t> (版本>=0)
	private $fromState_u;	//<uint8_t> (版本>=0)
	private $toState_u;	//<uint8_t> (版本>=0)
	private $operateIP_u;	//<uint8_t> (版本>=0)
	private $operationRemark_u;	//<uint8_t> (版本>=0)
	private $machineKey_u;	//<uint8_t> (版本>=0)
	private $logType;	//<uint32_t> 流水类型(版本>=1)
	private $logType_u;	//<uint8_t> (版本>=1)

	function __construct(){
		$this->version = 1;	//<uint16_t>
		$this->dealLogId = 0;	//<uint32_t>
		$this->dealId = "";	//<std::string>
		$this->dealId64 = 0;	//<uint64_t>
		$this->tradeId = 0;	//<uint64_t>
		$this->buyerId = 0;	//<uint64_t>
		$this->sellerId = 0;	//<uint64_t>
		$this->operatorType = 0;	//<uint16_t>
		$this->operateTime = 0;	//<uint32_t>
		$this->operationType = 0;	//<uint16_t>
		$this->operationDesc = "";	//<std::string>
		$this->fromState = 0;	//<uint32_t>
		$this->toState = 0;	//<uint32_t>
		$this->operateIP = "";	//<std::string>
		$this->operationRemark = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->dealLogId_u = 0;	//<uint8_t>
		$this->dealId_u = 0;	//<uint8_t>
		$this->dealId64_u = 0;	//<uint8_t>
		$this->tradeId_u = 0;	//<uint8_t>
		$this->buyerId_u = 0;	//<uint8_t>
		$this->sellerId_u = 0;	//<uint8_t>
		$this->operatorType_u = 0;	//<uint8_t>
		$this->operateTime_u = 0;	//<uint8_t>
		$this->operationType_u = 0;	//<uint8_t>
		$this->operationDesc_u = 0;	//<uint8_t>
		$this->fromState_u = 0;	//<uint8_t>
		$this->toState_u = 0;	//<uint8_t>
		$this->operateIP_u = 0;	//<uint8_t>
		$this->operationRemark_u = 0;	//<uint8_t>
		$this->machineKey_u = 0;	//<uint8_t>
		$this->logType = 0;	//<uint32_t>
		$this->logType_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\po\DealActionLogPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\DealActionLogPo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 版本号
		$bs->pushUint32_t($this->dealLogId);	//<uint32_t> 订单流水ID
		$bs->pushString($this->dealId);	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		$bs->pushUint64_t($this->dealId64);	//<uint64_t> 订单单号，统一平台内部单号
		$bs->pushUint64_t($this->tradeId);	//<uint64_t> 商品单ID
		$bs->pushUint64_t($this->buyerId);	//<uint64_t> 买家ID
		$bs->pushUint64_t($this->sellerId);	//<uint64_t> 商家ID
		$bs->pushUint16_t($this->operatorType);	//<uint16_t> 订单操作者类别
		$bs->pushUint32_t($this->operateTime);	//<uint32_t> 流水操作时间
		$bs->pushUint16_t($this->operationType);	//<uint16_t> 流水操作类型
		$bs->pushString($this->operationDesc);	//<std::string> 流水操作描述
		$bs->pushUint32_t($this->fromState);	//<uint32_t> 操作前状态
		$bs->pushUint32_t($this->toState);	//<uint32_t> 操作后状态
		$bs->pushString($this->operateIP);	//<std::string> 操作来源IP
		$bs->pushString($this->operationRemark);	//<std::string> 操作备注
		$bs->pushString($this->machineKey);	//<std::string> MachineKey
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealLogId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId64_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operatorType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operateTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operationType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operationDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->fromState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->toState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operateIP_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operationRemark_u);	//<uint8_t> 
		$bs->pushUint8_t($this->machineKey_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushUint32_t($this->logType);	//<uint32_t> 流水类型
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->logType_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 版本号
		$this->_arr_value['dealLogId'] = $bs->popUint32_t();	//<uint32_t> 订单流水ID
		$this->_arr_value['dealId'] = $bs->popString();	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		$this->_arr_value['dealId64'] = $bs->popUint64_t();	//<uint64_t> 订单单号，统一平台内部单号
		$this->_arr_value['tradeId'] = $bs->popUint64_t();	//<uint64_t> 商品单ID
		$this->_arr_value['buyerId'] = $bs->popUint64_t();	//<uint64_t> 买家ID
		$this->_arr_value['sellerId'] = $bs->popUint64_t();	//<uint64_t> 商家ID
		$this->_arr_value['operatorType'] = $bs->popUint16_t();	//<uint16_t> 订单操作者类别
		$this->_arr_value['operateTime'] = $bs->popUint32_t();	//<uint32_t> 流水操作时间
		$this->_arr_value['operationType'] = $bs->popUint16_t();	//<uint16_t> 流水操作类型
		$this->_arr_value['operationDesc'] = $bs->popString();	//<std::string> 流水操作描述
		$this->_arr_value['fromState'] = $bs->popUint32_t();	//<uint32_t> 操作前状态
		$this->_arr_value['toState'] = $bs->popUint32_t();	//<uint32_t> 操作后状态
		$this->_arr_value['operateIP'] = $bs->popString();	//<std::string> 操作来源IP
		$this->_arr_value['operationRemark'] = $bs->popString();	//<std::string> 操作备注
		$this->_arr_value['machineKey'] = $bs->popString();	//<std::string> MachineKey
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealLogId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId64_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operatorType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operationType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operationDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['fromState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['toState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operateIP_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operationRemark_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['machineKey_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['logType'] = $bs->popUint32_t();	//<uint32_t> 流水类型
		}
		if($this->version >= 1){
			$this->_arr_value['logType_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.DealPo.java
class PayInfoPoList{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 版本号(版本>=0)
	private $payInfoList;	//<std::vector<ecc::deal::po::CPayInfoPo> > 支付单列表(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $payInfoList_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->payInfoList = new \stl_vector2('\ecc\deal\po\PayInfoPo');	//<std::vector<ecc::deal::po::CPayInfoPo> >
		$this->version_u = 0;	//<uint8_t>
		$this->payInfoList_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\po\PayInfoPoList\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\PayInfoPoList\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 版本号
		$bs->pushObject($this->payInfoList,'stl_vector');	//<std::vector<ecc::deal::po::CPayInfoPo> > 支付单列表
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payInfoList_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 版本号
		$this->_arr_value['payInfoList'] = $bs->popObject('stl_vector<\ecc\deal\po\PayInfoPo>');	//<std::vector<ecc::deal::po::CPayInfoPo> > 支付单列表
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.PayInfoPoList.java
class PayInfoPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 版本号(版本>=0)
	private $control;	//<uint32_t> 支付单DB操作类型，0:Insert 1:Update(版本>=0)
	private $payId;	//<uint64_t> 支付单ID(版本>=0)
	private $dealId;	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702(版本>=0)
	private $dealId64;	//<uint64_t> 订单单号，统一平台内部单号(版本>=0)
	private $bdealId;	//<uint64_t> 交易单号，买卖家一次交易行为描述(版本>=0)
	private $buyerId;	//<uint64_t> 买家ID(版本>=0)
	private $buyerNickName;	//<std::string> 买家昵称(版本>=0)
	private $sellerId;	//<uint64_t> 商家ID(版本>=0)
	private $sellerTitle;	//<std::string> 商家名称(版本>=0)
	private $itemTitleList;	//<std::string> 商品标题列表(版本>=0)
	private $payTotalFee;	//<uint32_t> 支付总金额(版本>=0)
	private $payDealTotalFee;	//<uint32_t> 订单待付金额，等于商品实付金额+退运险(版本>=0)
	private $payShippingFee;	//<uint32_t> 邮费金额(版本>=0)
	private $payAccount;	//<std::string> 支付帐号(版本>=0)
	private $payState;	//<uint32_t> 支付单状态，1，未支付；2，支付完成(版本>=0)
	private $payProperty;	//<uint32_t> 支付单标记(版本>=0)
	private $payType;	//<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款(版本>=0)
	private $payChannel;	//<uint8_t> 支付渠道(版本>=0)
	private $payBank;	//<std::string> 支付银行ID(版本>=0)
	private $payDealId;	//<std::string> 支付订单编号(版本>=0)
	private $payGenTime;	//<uint32_t> 支付单生成时间(版本>=0)
	private $payEnableBeginTime;	//<uint32_t> 支付单有效起始时间(版本>=0)
	private $payEnableEndTime;	//<uint32_t> 支付单有效结束时间(版本>=0)
	private $payFinishTime;	//<uint32_t> 支付完成时间(版本>=0)
	private $payReturnTime;	//<uint32_t> 支付返回时间(版本>=0)
	private $recvFeeFinishTime;	//<uint32_t> 打款完成时间(版本>=0)
	private $recvFeeReturnTime;	//<uint32_t> 打款返回时间(版本>=0)
	private $payBuyerRecvFee;	//<uint32_t> 打款买家总金额(版本>=0)
	private $paySellerRecvFee;	//<uint32_t> 打款卖家总金额(版本>=0)
	private $cftDealGenTime;	//<uint32_t> 财付通订单生成时间(版本>=0)
	private $payCashFee;	//<uint32_t> 现金支付金额(版本>=0)
	private $payTicketFee;	//<uint32_t> 现金券支付金额(版本>=0)
	private $payCreditFee;	//<uint32_t> 积分支付金额(版本>=0)
	private $payOthersFee;	//<uint32_t> 其他支付金额(版本>=0)
	private $payServiceFee;	//<uint32_t> 支付手续费(版本>=0)
	private $whoPayCodFee;	//<uint32_t> 谁承担COD手续费，1：卖家承担；2：买家；3：平台承担(版本>=0)
	private $payCodCftServiceFee;	//<uint32_t> COD财付通支付手续费(版本>=0)
	private $payCodPaipaiServiceFee;	//<uint32_t> CODPaipai支付手续费(版本>=0)
	private $payCodServiceAdjustFee;	//<int> COD手续费调价金额(版本>=0)
	private $payCodPaipaiConsignTime;	//<uint32_t> CODPaipai签收时间(版本>=0)
	private $payCodWuliuServiceFee;	//<uint32_t> COD物流支付手续费(版本>=0)
	private $payCodWuliuRecvFee;	//<uint32_t> COD物流打款金额(版本>=0)
	private $payCodSellerRecvFee;	//<uint32_t> COD卖家打款金额(版本>=0)
	private $payCodWuliuConsignTime;	//<uint32_t> COD物流签收时间(版本>=0)
	private $payCodWuliuCollectionMoney;	//<uint32_t> COD物流代收货款(版本>=0)
	private $payCodWuliuSpid;	//<std::string> COD物流SPID(版本>=0)
	private $payInstallmentBank;	//<std::string> 分期付款银行(版本>=0)
	private $payInstallmentNum;	//<uint16_t> 分期付款期数(版本>=0)
	private $payInstallmentPayment;	//<uint32_t> 分期付款每期金额(版本>=0)
	private $lastUpdateTime;	//<uint32_t> 最后更新时间(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $control_u;	//<uint8_t> (版本>=0)
	private $payId_u;	//<uint8_t> (版本>=0)
	private $dealId_u;	//<uint8_t> (版本>=0)
	private $dealId64_u;	//<uint8_t> (版本>=0)
	private $bdealId_u;	//<uint8_t> (版本>=0)
	private $buyerId_u;	//<uint8_t> (版本>=0)
	private $buyerNickName_u;	//<uint8_t> (版本>=0)
	private $sellerId_u;	//<uint8_t> (版本>=0)
	private $sellerTitle_u;	//<uint8_t> (版本>=0)
	private $itemTitleList_u;	//<uint8_t> (版本>=0)
	private $payTotalFee_u;	//<uint8_t> (版本>=0)
	private $payDealTotalFee_u;	//<uint8_t> (版本>=0)
	private $payShippingFee_u;	//<uint8_t> (版本>=0)
	private $payAccount_u;	//<uint8_t> (版本>=0)
	private $payState_u;	//<uint8_t> (版本>=0)
	private $payProperty_u;	//<uint8_t> (版本>=0)
	private $payType_u;	//<uint8_t> (版本>=0)
	private $payChannel_u;	//<uint8_t> (版本>=0)
	private $payBank_u;	//<uint8_t> (版本>=0)
	private $payDealId_u;	//<uint8_t> (版本>=0)
	private $payGenTime_u;	//<uint8_t> (版本>=0)
	private $payEnableBeginTime_u;	//<uint8_t> (版本>=0)
	private $payEnableEndTime_u;	//<uint8_t> (版本>=0)
	private $payFinishTime_u;	//<uint8_t> (版本>=0)
	private $payReturnTime_u;	//<uint8_t> (版本>=0)
	private $recvFeeFinishTime_u;	//<uint8_t> (版本>=0)
	private $recvFeeReturnTime_u;	//<uint8_t> (版本>=0)
	private $payBuyerRecvFee_u;	//<uint8_t> (版本>=0)
	private $paySellerRecvFee_u;	//<uint8_t> (版本>=0)
	private $cftDealGenTime_u;	//<uint8_t> (版本>=0)
	private $payCashFee_u;	//<uint8_t> (版本>=0)
	private $payTicketFee_u;	//<uint8_t> (版本>=0)
	private $payCreditFee_u;	//<uint8_t> (版本>=0)
	private $payOthersFee_u;	//<uint8_t> (版本>=0)
	private $payServiceFee_u;	//<uint8_t> (版本>=0)
	private $whoPayCodFee_u;	//<uint8_t> (版本>=0)
	private $payCodCftServiceFee_u;	//<uint8_t> (版本>=0)
	private $payCodPaipaiServiceFee_u;	//<uint8_t> (版本>=0)
	private $payCodServiceAdjustFee_u;	//<uint8_t> (版本>=0)
	private $payCodPaipaiConsignTime_u;	//<uint8_t> (版本>=0)
	private $payCodWuliuServiceFee_u;	//<uint8_t> (版本>=0)
	private $payCodWuliuRecvFee_u;	//<uint8_t> (版本>=0)
	private $payCodSellerRecvFee_u;	//<uint8_t> (版本>=0)
	private $payCodWuliuConsignTime_u;	//<uint8_t> (版本>=0)
	private $payCodWuliuCollectionMoney_u;	//<uint8_t> (版本>=0)
	private $payCodWuliuSpid_u;	//<uint8_t> (版本>=0)
	private $payInstallmentBank_u;	//<uint8_t> (版本>=0)
	private $payInstallmentNum_u;	//<uint8_t> (版本>=0)
	private $payInstallmentPayment_u;	//<uint8_t> (版本>=0)
	private $lastUpdateTime_u;	//<uint8_t> (版本>=0)
	private $payBusinessId;	//<std::string> 支付业务单号, 支付系统的业务订单号(版本>=1)
	private $payBusinessId_u;	//<uint8_t> 支付业务单号, 支付系统的业务订单号(版本>=1)

	function __construct(){
		$this->version = 1;	//<uint16_t>
		$this->control = 0;	//<uint32_t>
		$this->payId = 0;	//<uint64_t>
		$this->dealId = "";	//<std::string>
		$this->dealId64 = 0;	//<uint64_t>
		$this->bdealId = 0;	//<uint64_t>
		$this->buyerId = 0;	//<uint64_t>
		$this->buyerNickName = "";	//<std::string>
		$this->sellerId = 0;	//<uint64_t>
		$this->sellerTitle = "";	//<std::string>
		$this->itemTitleList = "";	//<std::string>
		$this->payTotalFee = 0;	//<uint32_t>
		$this->payDealTotalFee = 0;	//<uint32_t>
		$this->payShippingFee = 0;	//<uint32_t>
		$this->payAccount = "";	//<std::string>
		$this->payState = 0;	//<uint32_t>
		$this->payProperty = 0;	//<uint32_t>
		$this->payType = 0;	//<uint8_t>
		$this->payChannel = 0;	//<uint8_t>
		$this->payBank = "";	//<std::string>
		$this->payDealId = "";	//<std::string>
		$this->payGenTime = 0;	//<uint32_t>
		$this->payEnableBeginTime = 0;	//<uint32_t>
		$this->payEnableEndTime = 0;	//<uint32_t>
		$this->payFinishTime = 0;	//<uint32_t>
		$this->payReturnTime = 0;	//<uint32_t>
		$this->recvFeeFinishTime = 0;	//<uint32_t>
		$this->recvFeeReturnTime = 0;	//<uint32_t>
		$this->payBuyerRecvFee = 0;	//<uint32_t>
		$this->paySellerRecvFee = 0;	//<uint32_t>
		$this->cftDealGenTime = 0;	//<uint32_t>
		$this->payCashFee = 0;	//<uint32_t>
		$this->payTicketFee = 0;	//<uint32_t>
		$this->payCreditFee = 0;	//<uint32_t>
		$this->payOthersFee = 0;	//<uint32_t>
		$this->payServiceFee = 0;	//<uint32_t>
		$this->whoPayCodFee = 0;	//<uint32_t>
		$this->payCodCftServiceFee = 0;	//<uint32_t>
		$this->payCodPaipaiServiceFee = 0;	//<uint32_t>
		$this->payCodServiceAdjustFee = 0;	//<int>
		$this->payCodPaipaiConsignTime = 0;	//<uint32_t>
		$this->payCodWuliuServiceFee = 0;	//<uint32_t>
		$this->payCodWuliuRecvFee = 0;	//<uint32_t>
		$this->payCodSellerRecvFee = 0;	//<uint32_t>
		$this->payCodWuliuConsignTime = 0;	//<uint32_t>
		$this->payCodWuliuCollectionMoney = 0;	//<uint32_t>
		$this->payCodWuliuSpid = "";	//<std::string>
		$this->payInstallmentBank = "";	//<std::string>
		$this->payInstallmentNum = 0;	//<uint16_t>
		$this->payInstallmentPayment = 0;	//<uint32_t>
		$this->lastUpdateTime = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->control_u = 0;	//<uint8_t>
		$this->payId_u = 0;	//<uint8_t>
		$this->dealId_u = 0;	//<uint8_t>
		$this->dealId64_u = 0;	//<uint8_t>
		$this->bdealId_u = 0;	//<uint8_t>
		$this->buyerId_u = 0;	//<uint8_t>
		$this->buyerNickName_u = 0;	//<uint8_t>
		$this->sellerId_u = 0;	//<uint8_t>
		$this->sellerTitle_u = 0;	//<uint8_t>
		$this->itemTitleList_u = 0;	//<uint8_t>
		$this->payTotalFee_u = 0;	//<uint8_t>
		$this->payDealTotalFee_u = 0;	//<uint8_t>
		$this->payShippingFee_u = 0;	//<uint8_t>
		$this->payAccount_u = 0;	//<uint8_t>
		$this->payState_u = 0;	//<uint8_t>
		$this->payProperty_u = 0;	//<uint8_t>
		$this->payType_u = 0;	//<uint8_t>
		$this->payChannel_u = 0;	//<uint8_t>
		$this->payBank_u = 0;	//<uint8_t>
		$this->payDealId_u = 0;	//<uint8_t>
		$this->payGenTime_u = 0;	//<uint8_t>
		$this->payEnableBeginTime_u = 0;	//<uint8_t>
		$this->payEnableEndTime_u = 0;	//<uint8_t>
		$this->payFinishTime_u = 0;	//<uint8_t>
		$this->payReturnTime_u = 0;	//<uint8_t>
		$this->recvFeeFinishTime_u = 0;	//<uint8_t>
		$this->recvFeeReturnTime_u = 0;	//<uint8_t>
		$this->payBuyerRecvFee_u = 0;	//<uint8_t>
		$this->paySellerRecvFee_u = 0;	//<uint8_t>
		$this->cftDealGenTime_u = 0;	//<uint8_t>
		$this->payCashFee_u = 0;	//<uint8_t>
		$this->payTicketFee_u = 0;	//<uint8_t>
		$this->payCreditFee_u = 0;	//<uint8_t>
		$this->payOthersFee_u = 0;	//<uint8_t>
		$this->payServiceFee_u = 0;	//<uint8_t>
		$this->whoPayCodFee_u = 0;	//<uint8_t>
		$this->payCodCftServiceFee_u = 0;	//<uint8_t>
		$this->payCodPaipaiServiceFee_u = 0;	//<uint8_t>
		$this->payCodServiceAdjustFee_u = 0;	//<uint8_t>
		$this->payCodPaipaiConsignTime_u = 0;	//<uint8_t>
		$this->payCodWuliuServiceFee_u = 0;	//<uint8_t>
		$this->payCodWuliuRecvFee_u = 0;	//<uint8_t>
		$this->payCodSellerRecvFee_u = 0;	//<uint8_t>
		$this->payCodWuliuConsignTime_u = 0;	//<uint8_t>
		$this->payCodWuliuCollectionMoney_u = 0;	//<uint8_t>
		$this->payCodWuliuSpid_u = 0;	//<uint8_t>
		$this->payInstallmentBank_u = 0;	//<uint8_t>
		$this->payInstallmentNum_u = 0;	//<uint8_t>
		$this->payInstallmentPayment_u = 0;	//<uint8_t>
		$this->lastUpdateTime_u = 0;	//<uint8_t>
		$this->payBusinessId = "";	//<std::string>
		$this->payBusinessId_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\po\PayInfoPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\PayInfoPo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 版本号
		$bs->pushUint32_t($this->control);	//<uint32_t> 支付单DB操作类型，0:Insert 1:Update
		$bs->pushUint64_t($this->payId);	//<uint64_t> 支付单ID
		$bs->pushString($this->dealId);	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		$bs->pushUint64_t($this->dealId64);	//<uint64_t> 订单单号，统一平台内部单号
		$bs->pushUint64_t($this->bdealId);	//<uint64_t> 交易单号，买卖家一次交易行为描述
		$bs->pushUint64_t($this->buyerId);	//<uint64_t> 买家ID
		$bs->pushString($this->buyerNickName);	//<std::string> 买家昵称
		$bs->pushUint64_t($this->sellerId);	//<uint64_t> 商家ID
		$bs->pushString($this->sellerTitle);	//<std::string> 商家名称
		$bs->pushString($this->itemTitleList);	//<std::string> 商品标题列表
		$bs->pushUint32_t($this->payTotalFee);	//<uint32_t> 支付总金额
		$bs->pushUint32_t($this->payDealTotalFee);	//<uint32_t> 订单待付金额，等于商品实付金额+退运险
		$bs->pushUint32_t($this->payShippingFee);	//<uint32_t> 邮费金额
		$bs->pushString($this->payAccount);	//<std::string> 支付帐号
		$bs->pushUint32_t($this->payState);	//<uint32_t> 支付单状态，1，未支付；2，支付完成
		$bs->pushUint32_t($this->payProperty);	//<uint32_t> 支付单标记
		$bs->pushUint8_t($this->payType);	//<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款
		$bs->pushUint8_t($this->payChannel);	//<uint8_t> 支付渠道
		$bs->pushString($this->payBank);	//<std::string> 支付银行ID
		$bs->pushString($this->payDealId);	//<std::string> 支付订单编号
		$bs->pushUint32_t($this->payGenTime);	//<uint32_t> 支付单生成时间
		$bs->pushUint32_t($this->payEnableBeginTime);	//<uint32_t> 支付单有效起始时间
		$bs->pushUint32_t($this->payEnableEndTime);	//<uint32_t> 支付单有效结束时间
		$bs->pushUint32_t($this->payFinishTime);	//<uint32_t> 支付完成时间
		$bs->pushUint32_t($this->payReturnTime);	//<uint32_t> 支付返回时间
		$bs->pushUint32_t($this->recvFeeFinishTime);	//<uint32_t> 打款完成时间
		$bs->pushUint32_t($this->recvFeeReturnTime);	//<uint32_t> 打款返回时间
		$bs->pushUint32_t($this->payBuyerRecvFee);	//<uint32_t> 打款买家总金额
		$bs->pushUint32_t($this->paySellerRecvFee);	//<uint32_t> 打款卖家总金额
		$bs->pushUint32_t($this->cftDealGenTime);	//<uint32_t> 财付通订单生成时间
		$bs->pushUint32_t($this->payCashFee);	//<uint32_t> 现金支付金额
		$bs->pushUint32_t($this->payTicketFee);	//<uint32_t> 现金券支付金额
		$bs->pushUint32_t($this->payCreditFee);	//<uint32_t> 积分支付金额
		$bs->pushUint32_t($this->payOthersFee);	//<uint32_t> 其他支付金额
		$bs->pushUint32_t($this->payServiceFee);	//<uint32_t> 支付手续费
		$bs->pushUint32_t($this->whoPayCodFee);	//<uint32_t> 谁承担COD手续费，1：卖家承担；2：买家；3：平台承担
		$bs->pushUint32_t($this->payCodCftServiceFee);	//<uint32_t> COD财付通支付手续费
		$bs->pushUint32_t($this->payCodPaipaiServiceFee);	//<uint32_t> CODPaipai支付手续费
		$bs->pushInt32_t($this->payCodServiceAdjustFee);	//<int> COD手续费调价金额
		$bs->pushUint32_t($this->payCodPaipaiConsignTime);	//<uint32_t> CODPaipai签收时间
		$bs->pushUint32_t($this->payCodWuliuServiceFee);	//<uint32_t> COD物流支付手续费
		$bs->pushUint32_t($this->payCodWuliuRecvFee);	//<uint32_t> COD物流打款金额
		$bs->pushUint32_t($this->payCodSellerRecvFee);	//<uint32_t> COD卖家打款金额
		$bs->pushUint32_t($this->payCodWuliuConsignTime);	//<uint32_t> COD物流签收时间
		$bs->pushUint32_t($this->payCodWuliuCollectionMoney);	//<uint32_t> COD物流代收货款
		$bs->pushString($this->payCodWuliuSpid);	//<std::string> COD物流SPID
		$bs->pushString($this->payInstallmentBank);	//<std::string> 分期付款银行
		$bs->pushUint16_t($this->payInstallmentNum);	//<uint16_t> 分期付款期数
		$bs->pushUint32_t($this->payInstallmentPayment);	//<uint32_t> 分期付款每期金额
		$bs->pushUint32_t($this->lastUpdateTime);	//<uint32_t> 最后更新时间
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->control_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId64_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerNickName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerTitle_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemTitleList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payTotalFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payDealTotalFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payShippingFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payAccount_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payProperty_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payChannel_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payBank_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payDealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payGenTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payEnableBeginTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payEnableEndTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payFinishTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payReturnTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvFeeFinishTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvFeeReturnTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payBuyerRecvFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->paySellerRecvFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->cftDealGenTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payCashFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payTicketFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payCreditFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payOthersFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payServiceFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->whoPayCodFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payCodCftServiceFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payCodPaipaiServiceFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payCodServiceAdjustFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payCodPaipaiConsignTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payCodWuliuServiceFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payCodWuliuRecvFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payCodSellerRecvFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payCodWuliuConsignTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payCodWuliuCollectionMoney_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payCodWuliuSpid_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payInstallmentBank_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payInstallmentNum_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payInstallmentPayment_u);	//<uint8_t> 
		$bs->pushUint8_t($this->lastUpdateTime_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushString($this->payBusinessId);	//<std::string> 支付业务单号, 支付系统的业务订单号
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->payBusinessId_u);	//<uint8_t> 支付业务单号, 支付系统的业务订单号
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 版本号
		$this->_arr_value['control'] = $bs->popUint32_t();	//<uint32_t> 支付单DB操作类型，0:Insert 1:Update
		$this->_arr_value['payId'] = $bs->popUint64_t();	//<uint64_t> 支付单ID
		$this->_arr_value['dealId'] = $bs->popString();	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		$this->_arr_value['dealId64'] = $bs->popUint64_t();	//<uint64_t> 订单单号，统一平台内部单号
		$this->_arr_value['bdealId'] = $bs->popUint64_t();	//<uint64_t> 交易单号，买卖家一次交易行为描述
		$this->_arr_value['buyerId'] = $bs->popUint64_t();	//<uint64_t> 买家ID
		$this->_arr_value['buyerNickName'] = $bs->popString();	//<std::string> 买家昵称
		$this->_arr_value['sellerId'] = $bs->popUint64_t();	//<uint64_t> 商家ID
		$this->_arr_value['sellerTitle'] = $bs->popString();	//<std::string> 商家名称
		$this->_arr_value['itemTitleList'] = $bs->popString();	//<std::string> 商品标题列表
		$this->_arr_value['payTotalFee'] = $bs->popUint32_t();	//<uint32_t> 支付总金额
		$this->_arr_value['payDealTotalFee'] = $bs->popUint32_t();	//<uint32_t> 订单待付金额，等于商品实付金额+退运险
		$this->_arr_value['payShippingFee'] = $bs->popUint32_t();	//<uint32_t> 邮费金额
		$this->_arr_value['payAccount'] = $bs->popString();	//<std::string> 支付帐号
		$this->_arr_value['payState'] = $bs->popUint32_t();	//<uint32_t> 支付单状态，1，未支付；2，支付完成
		$this->_arr_value['payProperty'] = $bs->popUint32_t();	//<uint32_t> 支付单标记
		$this->_arr_value['payType'] = $bs->popUint8_t();	//<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款
		$this->_arr_value['payChannel'] = $bs->popUint8_t();	//<uint8_t> 支付渠道
		$this->_arr_value['payBank'] = $bs->popString();	//<std::string> 支付银行ID
		$this->_arr_value['payDealId'] = $bs->popString();	//<std::string> 支付订单编号
		$this->_arr_value['payGenTime'] = $bs->popUint32_t();	//<uint32_t> 支付单生成时间
		$this->_arr_value['payEnableBeginTime'] = $bs->popUint32_t();	//<uint32_t> 支付单有效起始时间
		$this->_arr_value['payEnableEndTime'] = $bs->popUint32_t();	//<uint32_t> 支付单有效结束时间
		$this->_arr_value['payFinishTime'] = $bs->popUint32_t();	//<uint32_t> 支付完成时间
		$this->_arr_value['payReturnTime'] = $bs->popUint32_t();	//<uint32_t> 支付返回时间
		$this->_arr_value['recvFeeFinishTime'] = $bs->popUint32_t();	//<uint32_t> 打款完成时间
		$this->_arr_value['recvFeeReturnTime'] = $bs->popUint32_t();	//<uint32_t> 打款返回时间
		$this->_arr_value['payBuyerRecvFee'] = $bs->popUint32_t();	//<uint32_t> 打款买家总金额
		$this->_arr_value['paySellerRecvFee'] = $bs->popUint32_t();	//<uint32_t> 打款卖家总金额
		$this->_arr_value['cftDealGenTime'] = $bs->popUint32_t();	//<uint32_t> 财付通订单生成时间
		$this->_arr_value['payCashFee'] = $bs->popUint32_t();	//<uint32_t> 现金支付金额
		$this->_arr_value['payTicketFee'] = $bs->popUint32_t();	//<uint32_t> 现金券支付金额
		$this->_arr_value['payCreditFee'] = $bs->popUint32_t();	//<uint32_t> 积分支付金额
		$this->_arr_value['payOthersFee'] = $bs->popUint32_t();	//<uint32_t> 其他支付金额
		$this->_arr_value['payServiceFee'] = $bs->popUint32_t();	//<uint32_t> 支付手续费
		$this->_arr_value['whoPayCodFee'] = $bs->popUint32_t();	//<uint32_t> 谁承担COD手续费，1：卖家承担；2：买家；3：平台承担
		$this->_arr_value['payCodCftServiceFee'] = $bs->popUint32_t();	//<uint32_t> COD财付通支付手续费
		$this->_arr_value['payCodPaipaiServiceFee'] = $bs->popUint32_t();	//<uint32_t> CODPaipai支付手续费
		$this->_arr_value['payCodServiceAdjustFee'] = $bs->popInt32_t();	//<int> COD手续费调价金额
		$this->_arr_value['payCodPaipaiConsignTime'] = $bs->popUint32_t();	//<uint32_t> CODPaipai签收时间
		$this->_arr_value['payCodWuliuServiceFee'] = $bs->popUint32_t();	//<uint32_t> COD物流支付手续费
		$this->_arr_value['payCodWuliuRecvFee'] = $bs->popUint32_t();	//<uint32_t> COD物流打款金额
		$this->_arr_value['payCodSellerRecvFee'] = $bs->popUint32_t();	//<uint32_t> COD卖家打款金额
		$this->_arr_value['payCodWuliuConsignTime'] = $bs->popUint32_t();	//<uint32_t> COD物流签收时间
		$this->_arr_value['payCodWuliuCollectionMoney'] = $bs->popUint32_t();	//<uint32_t> COD物流代收货款
		$this->_arr_value['payCodWuliuSpid'] = $bs->popString();	//<std::string> COD物流SPID
		$this->_arr_value['payInstallmentBank'] = $bs->popString();	//<std::string> 分期付款银行
		$this->_arr_value['payInstallmentNum'] = $bs->popUint16_t();	//<uint16_t> 分期付款期数
		$this->_arr_value['payInstallmentPayment'] = $bs->popUint32_t();	//<uint32_t> 分期付款每期金额
		$this->_arr_value['lastUpdateTime'] = $bs->popUint32_t();	//<uint32_t> 最后更新时间
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['control_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId64_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerNickName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerTitle_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemTitleList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payTotalFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payDealTotalFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payShippingFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payAccount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payProperty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payChannel_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payBank_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payDealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payGenTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payEnableBeginTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payEnableEndTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payFinishTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payReturnTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvFeeFinishTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvFeeReturnTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payBuyerRecvFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['paySellerRecvFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cftDealGenTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payCashFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payTicketFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payCreditFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payOthersFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payServiceFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['whoPayCodFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payCodCftServiceFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payCodPaipaiServiceFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payCodServiceAdjustFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payCodPaipaiConsignTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payCodWuliuServiceFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payCodWuliuRecvFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payCodSellerRecvFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payCodWuliuConsignTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payCodWuliuCollectionMoney_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payCodWuliuSpid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payInstallmentBank_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payInstallmentNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payInstallmentPayment_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['lastUpdateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['payBusinessId'] = $bs->popString();	//<std::string> 支付业务单号, 支付系统的业务订单号
		}
		if($this->version >= 1){
			$this->_arr_value['payBusinessId_u'] = $bs->popUint8_t();	//<uint8_t> 支付业务单号, 支付系统的业务订单号
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

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.DealPo.java
class DealRefundPoList{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 版本号(版本>=0)
	private $dealRefundInfoList;	//<std::vector<ecc::deal::po::CDealRefundPo> > 退款单列表(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $dealRefundInfoList_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->dealRefundInfoList = new \stl_vector2('\ecc\deal\po\DealRefundPo');	//<std::vector<ecc::deal::po::CDealRefundPo> >
		$this->version_u = 0;	//<uint8_t>
		$this->dealRefundInfoList_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\po\DealRefundPoList\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\DealRefundPoList\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 版本号
		$bs->pushObject($this->dealRefundInfoList,'stl_vector');	//<std::vector<ecc::deal::po::CDealRefundPo> > 退款单列表
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealRefundInfoList_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 版本号
		$this->_arr_value['dealRefundInfoList'] = $bs->popObject('stl_vector<\ecc\deal\po\DealRefundPo>');	//<std::vector<ecc::deal::po::CDealRefundPo> > 退款单列表
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealRefundInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.DealRefundPoList.java
class DealRefundPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 版本号(版本>=0)
	private $control;	//<uint32_t> 退款单DB操作类型，0:Insert 1:Update(版本>=0)
	private $refundDetailId;	//<uint64_t> 退款单ID(版本>=0)
	private $dealId;	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702(版本>=0)
	private $dealId64;	//<uint64_t> 订单单号，统一平台内部单号(版本>=0)
	private $tradeId;	//<uint64_t> 商品单ID(版本>=0)
	private $itemSkuidList;	//<std::string> 商品skuID列表(版本>=0)
	private $itemTitleList;	//<std::string> 商品标题列表(版本>=0)
	private $buyerId;	//<uint64_t> 买家ID(版本>=0)
	private $buyerAccount;	//<std::string> 买家帐号(版本>=0)
	private $buyerNickName;	//<std::string> 买家昵称(版本>=0)
	private $sellerId;	//<uint64_t> 商家ID(版本>=0)
	private $sellerTitle;	//<std::string> 商家名称(版本>=0)
	private $dealPayType;	//<uint8_t> 退款订单支付方式(版本>=0)
	private $refundType;	//<uint8_t> 退款单类型(版本>=0)
	private $itemBuyPrice;	//<uint32_t> 订单商品成交单价(版本>=0)
	private $itemBuyNum;	//<uint32_t> 订单商品购买件数，按商品单退款有效(版本>=0)
	private $refundItemNum;	//<uint32_t> 退款商品件数，按商品单退款有效(版本>=0)
	private $refundDealTotalFee;	//<uint32_t> 退款订单总金额(版本>=0)
	private $refundItemTotalFee;	//<uint32_t> 退款商品总金额(版本>=0)
	private $refundItemDiscountTotalFee;	//<int> 退款商品优惠总金额(版本>=0)
	private $refundItemActiveDesc;	//<std::string> 退款商品占优惠列表(版本>=0)
	private $refundItemAdjustTotalFee;	//<int> 退款商品调价总金额(版本>=0)
	private $refundShippingFee;	//<uint32_t> 退款商品邮费总金额(版本>=0)
	private $refundTotalFee;	//<uint32_t> 退款单总金额(版本>=0)
	private $refundSellerRecvFee;	//<uint32_t> 退款单卖家收到金额(版本>=0)
	private $refundBuyerRecvFee;	//<uint32_t> 退款单买家收到金额(版本>=0)
	private $refundState;	//<uint32_t> 退款单状态, 参考UNPDealState_E中有关退款的各个状态值(版本>=0)
	private $preRefundState;	//<uint32_t> 退款单前一个状态(版本>=0)
	private $refundProperty;	//<uint64_t> 退款单属性(版本>=0)
	private $refundGenTime;	//<uint32_t> 退款单生成时间(版本>=0)
	private $refundApplyTime;	//<uint32_t> 退款申请时间，买家(版本>=0)
	private $refundRecvFeeTime;	//<uint32_t> 退款打款完成时间(版本>=0)
	private $refundRecvFeeReturnTime;	//<uint32_t> 退款打款返回时间(版本>=0)
	private $refundFinishTime;	//<uint32_t> 退款完成时间，退款协议达成(版本>=0)
	private $itemReturnSendTime;	//<uint32_t> 买家发送退货时间，有退货时有效(版本>=0)
	private $itemReturnWuliuInfo;	//<std::string> 买家发送退货物流信息，有退货时有效(版本>=0)
	private $itemReturnDesc;	//<std::string> 买家退货描述，有退货时有效(版本>=0)
	private $itemReturnTradeState;	//<uint8_t> 退货收货状态，有退货时有效，1，收到货，2，未收到货(版本>=0)
	private $refundReasonType;	//<uint8_t> 退款原因类型(版本>=0)
	private $refundReasonDesc;	//<std::string> 退款原因描述(版本>=0)
	private $sellerAgreeRefundTime;	//<uint32_t> 卖家同意退款时间(版本>=0)
	private $sellerAgreeItemReturnTime;	//<uint32_t> 卖家同意退货时间(版本>=0)
	private $sellerRefuseRefundTime;	//<uint32_t> 卖家拒绝退款时间(版本>=0)
	private $sellerItemReturnAddress;	//<std::string> 卖家退货地址(版本>=0)
	private $sellerProcessRefundMsg;	//<std::string> 卖家处理退款附言(版本>=0)
	private $sellerProcessItemReturnMsg;	//<std::string> 卖家处理退货附言(版本>=0)
	private $recvFeeId;	//<uint64_t> 退款单打款ID(版本>=0)
	private $dealCreateTime;	//<uint32_t> 订单生成时间(版本>=0)
	private $timeoutFlag;	//<uint32_t> 超时标识(版本>=0)
	private $lastUpdateTime;	//<uint32_t> 记录更新时间(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $control_u;	//<uint8_t> (版本>=0)
	private $refundDetailId_u;	//<uint8_t> (版本>=0)
	private $dealId_u;	//<uint8_t> (版本>=0)
	private $dealId64_u;	//<uint8_t> (版本>=0)
	private $tradeId_u;	//<uint8_t> (版本>=0)
	private $itemSkuidList_u;	//<uint8_t> (版本>=0)
	private $itemTitleList_u;	//<uint8_t> (版本>=0)
	private $buyerId_u;	//<uint8_t> (版本>=0)
	private $buyerAccount_u;	//<uint8_t> (版本>=0)
	private $buyerNickName_u;	//<uint8_t> (版本>=0)
	private $sellerId_u;	//<uint8_t> (版本>=0)
	private $sellerTitle_u;	//<uint8_t> (版本>=0)
	private $dealPayType_u;	//<uint8_t> (版本>=0)
	private $refundType_u;	//<uint8_t> (版本>=0)
	private $itemBuyPrice_u;	//<uint8_t> (版本>=0)
	private $itemBuyNum_u;	//<uint8_t> (版本>=0)
	private $refundItemNum_u;	//<uint8_t> (版本>=0)
	private $refundDealTotalFee_u;	//<uint8_t> (版本>=0)
	private $refundItemTotalFee_u;	//<uint8_t> (版本>=0)
	private $refundItemDiscountTotalFee_u;	//<uint8_t> (版本>=0)
	private $refundItemActiveDesc_u;	//<uint8_t> (版本>=0)
	private $refundItemAdjustTotalFee_u;	//<uint8_t> (版本>=0)
	private $refundShippingFee_u;	//<uint8_t> (版本>=0)
	private $refundTotalFee_u;	//<uint8_t> (版本>=0)
	private $refundSellerRecvFee_u;	//<uint8_t> (版本>=0)
	private $refundBuyerRecvFee_u;	//<uint8_t> (版本>=0)
	private $refundState_u;	//<uint8_t> (版本>=0)
	private $preRefundState_u;	//<uint8_t> (版本>=0)
	private $refundProperty_u;	//<uint8_t> (版本>=0)
	private $refundGenTime_u;	//<uint8_t> (版本>=0)
	private $refundApplyTime_u;	//<uint8_t> (版本>=0)
	private $refundRecvFeeTime_u;	//<uint8_t> (版本>=0)
	private $refundRecvFeeReturnTime_u;	//<uint8_t> (版本>=0)
	private $refundFinishTime_u;	//<uint8_t> (版本>=0)
	private $itemReturnSendTime_u;	//<uint8_t> (版本>=0)
	private $itemReturnWuliuInfo_u;	//<uint8_t> (版本>=0)
	private $itemReturnDesc_u;	//<uint8_t> (版本>=0)
	private $itemReturnTradeState_u;	//<uint8_t> (版本>=0)
	private $refundReasonType_u;	//<uint8_t> (版本>=0)
	private $refundReasonDesc_u;	//<uint8_t> (版本>=0)
	private $sellerAgreeRefundTime_u;	//<uint8_t> (版本>=0)
	private $sellerAgreeItemReturnTime_u;	//<uint8_t> (版本>=0)
	private $sellerRefuseRefundTime_u;	//<uint8_t> (版本>=0)
	private $sellerItemReturnAddress_u;	//<uint8_t> (版本>=0)
	private $sellerProcessRefundMsg_u;	//<uint8_t> (版本>=0)
	private $sellerProcessItemReturnMsg_u;	//<uint8_t> (版本>=0)
	private $recvFeeId_u;	//<uint8_t> (版本>=0)
	private $dealCreateTime_u;	//<uint8_t> (版本>=0)
	private $timeoutFlag_u;	//<uint8_t> (版本>=0)
	private $lastUpdateTime_u;	//<uint8_t> (版本>=0)
	private $businessRefundId;	//<std::string> 业务退款单号(版本>=1)
	private $businessRefundId_u;	//<uint8_t> (版本>=1)

	function __construct(){
		$this->version = 1;	//<uint16_t>
		$this->control = 0;	//<uint32_t>
		$this->refundDetailId = 0;	//<uint64_t>
		$this->dealId = "";	//<std::string>
		$this->dealId64 = 0;	//<uint64_t>
		$this->tradeId = 0;	//<uint64_t>
		$this->itemSkuidList = "";	//<std::string>
		$this->itemTitleList = "";	//<std::string>
		$this->buyerId = 0;	//<uint64_t>
		$this->buyerAccount = "";	//<std::string>
		$this->buyerNickName = "";	//<std::string>
		$this->sellerId = 0;	//<uint64_t>
		$this->sellerTitle = "";	//<std::string>
		$this->dealPayType = 0;	//<uint8_t>
		$this->refundType = 0;	//<uint8_t>
		$this->itemBuyPrice = 0;	//<uint32_t>
		$this->itemBuyNum = 0;	//<uint32_t>
		$this->refundItemNum = 0;	//<uint32_t>
		$this->refundDealTotalFee = 0;	//<uint32_t>
		$this->refundItemTotalFee = 0;	//<uint32_t>
		$this->refundItemDiscountTotalFee = 0;	//<int>
		$this->refundItemActiveDesc = "";	//<std::string>
		$this->refundItemAdjustTotalFee = 0;	//<int>
		$this->refundShippingFee = 0;	//<uint32_t>
		$this->refundTotalFee = 0;	//<uint32_t>
		$this->refundSellerRecvFee = 0;	//<uint32_t>
		$this->refundBuyerRecvFee = 0;	//<uint32_t>
		$this->refundState = 0;	//<uint32_t>
		$this->preRefundState = 0;	//<uint32_t>
		$this->refundProperty = 0;	//<uint64_t>
		$this->refundGenTime = 0;	//<uint32_t>
		$this->refundApplyTime = 0;	//<uint32_t>
		$this->refundRecvFeeTime = 0;	//<uint32_t>
		$this->refundRecvFeeReturnTime = 0;	//<uint32_t>
		$this->refundFinishTime = 0;	//<uint32_t>
		$this->itemReturnSendTime = 0;	//<uint32_t>
		$this->itemReturnWuliuInfo = "";	//<std::string>
		$this->itemReturnDesc = "";	//<std::string>
		$this->itemReturnTradeState = 0;	//<uint8_t>
		$this->refundReasonType = 0;	//<uint8_t>
		$this->refundReasonDesc = "";	//<std::string>
		$this->sellerAgreeRefundTime = 0;	//<uint32_t>
		$this->sellerAgreeItemReturnTime = 0;	//<uint32_t>
		$this->sellerRefuseRefundTime = 0;	//<uint32_t>
		$this->sellerItemReturnAddress = "";	//<std::string>
		$this->sellerProcessRefundMsg = "";	//<std::string>
		$this->sellerProcessItemReturnMsg = "";	//<std::string>
		$this->recvFeeId = 0;	//<uint64_t>
		$this->dealCreateTime = 0;	//<uint32_t>
		$this->timeoutFlag = 0;	//<uint32_t>
		$this->lastUpdateTime = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->control_u = 0;	//<uint8_t>
		$this->refundDetailId_u = 0;	//<uint8_t>
		$this->dealId_u = 0;	//<uint8_t>
		$this->dealId64_u = 0;	//<uint8_t>
		$this->tradeId_u = 0;	//<uint8_t>
		$this->itemSkuidList_u = 0;	//<uint8_t>
		$this->itemTitleList_u = 0;	//<uint8_t>
		$this->buyerId_u = 0;	//<uint8_t>
		$this->buyerAccount_u = 0;	//<uint8_t>
		$this->buyerNickName_u = 0;	//<uint8_t>
		$this->sellerId_u = 0;	//<uint8_t>
		$this->sellerTitle_u = 0;	//<uint8_t>
		$this->dealPayType_u = 0;	//<uint8_t>
		$this->refundType_u = 0;	//<uint8_t>
		$this->itemBuyPrice_u = 0;	//<uint8_t>
		$this->itemBuyNum_u = 0;	//<uint8_t>
		$this->refundItemNum_u = 0;	//<uint8_t>
		$this->refundDealTotalFee_u = 0;	//<uint8_t>
		$this->refundItemTotalFee_u = 0;	//<uint8_t>
		$this->refundItemDiscountTotalFee_u = 0;	//<uint8_t>
		$this->refundItemActiveDesc_u = 0;	//<uint8_t>
		$this->refundItemAdjustTotalFee_u = 0;	//<uint8_t>
		$this->refundShippingFee_u = 0;	//<uint8_t>
		$this->refundTotalFee_u = 0;	//<uint8_t>
		$this->refundSellerRecvFee_u = 0;	//<uint8_t>
		$this->refundBuyerRecvFee_u = 0;	//<uint8_t>
		$this->refundState_u = 0;	//<uint8_t>
		$this->preRefundState_u = 0;	//<uint8_t>
		$this->refundProperty_u = 0;	//<uint8_t>
		$this->refundGenTime_u = 0;	//<uint8_t>
		$this->refundApplyTime_u = 0;	//<uint8_t>
		$this->refundRecvFeeTime_u = 0;	//<uint8_t>
		$this->refundRecvFeeReturnTime_u = 0;	//<uint8_t>
		$this->refundFinishTime_u = 0;	//<uint8_t>
		$this->itemReturnSendTime_u = 0;	//<uint8_t>
		$this->itemReturnWuliuInfo_u = 0;	//<uint8_t>
		$this->itemReturnDesc_u = 0;	//<uint8_t>
		$this->itemReturnTradeState_u = 0;	//<uint8_t>
		$this->refundReasonType_u = 0;	//<uint8_t>
		$this->refundReasonDesc_u = 0;	//<uint8_t>
		$this->sellerAgreeRefundTime_u = 0;	//<uint8_t>
		$this->sellerAgreeItemReturnTime_u = 0;	//<uint8_t>
		$this->sellerRefuseRefundTime_u = 0;	//<uint8_t>
		$this->sellerItemReturnAddress_u = 0;	//<uint8_t>
		$this->sellerProcessRefundMsg_u = 0;	//<uint8_t>
		$this->sellerProcessItemReturnMsg_u = 0;	//<uint8_t>
		$this->recvFeeId_u = 0;	//<uint8_t>
		$this->dealCreateTime_u = 0;	//<uint8_t>
		$this->timeoutFlag_u = 0;	//<uint8_t>
		$this->lastUpdateTime_u = 0;	//<uint8_t>
		$this->businessRefundId = "";	//<std::string>
		$this->businessRefundId_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\po\DealRefundPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\DealRefundPo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 版本号
		$bs->pushUint32_t($this->control);	//<uint32_t> 退款单DB操作类型，0:Insert 1:Update
		$bs->pushUint64_t($this->refundDetailId);	//<uint64_t> 退款单ID
		$bs->pushString($this->dealId);	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		$bs->pushUint64_t($this->dealId64);	//<uint64_t> 订单单号，统一平台内部单号
		$bs->pushUint64_t($this->tradeId);	//<uint64_t> 商品单ID
		$bs->pushString($this->itemSkuidList);	//<std::string> 商品skuID列表
		$bs->pushString($this->itemTitleList);	//<std::string> 商品标题列表
		$bs->pushUint64_t($this->buyerId);	//<uint64_t> 买家ID
		$bs->pushString($this->buyerAccount);	//<std::string> 买家帐号
		$bs->pushString($this->buyerNickName);	//<std::string> 买家昵称
		$bs->pushUint64_t($this->sellerId);	//<uint64_t> 商家ID
		$bs->pushString($this->sellerTitle);	//<std::string> 商家名称
		$bs->pushUint8_t($this->dealPayType);	//<uint8_t> 退款订单支付方式
		$bs->pushUint8_t($this->refundType);	//<uint8_t> 退款单类型
		$bs->pushUint32_t($this->itemBuyPrice);	//<uint32_t> 订单商品成交单价
		$bs->pushUint32_t($this->itemBuyNum);	//<uint32_t> 订单商品购买件数，按商品单退款有效
		$bs->pushUint32_t($this->refundItemNum);	//<uint32_t> 退款商品件数，按商品单退款有效
		$bs->pushUint32_t($this->refundDealTotalFee);	//<uint32_t> 退款订单总金额
		$bs->pushUint32_t($this->refundItemTotalFee);	//<uint32_t> 退款商品总金额
		$bs->pushInt32_t($this->refundItemDiscountTotalFee);	//<int> 退款商品优惠总金额
		$bs->pushString($this->refundItemActiveDesc);	//<std::string> 退款商品占优惠列表
		$bs->pushInt32_t($this->refundItemAdjustTotalFee);	//<int> 退款商品调价总金额
		$bs->pushUint32_t($this->refundShippingFee);	//<uint32_t> 退款商品邮费总金额
		$bs->pushUint32_t($this->refundTotalFee);	//<uint32_t> 退款单总金额
		$bs->pushUint32_t($this->refundSellerRecvFee);	//<uint32_t> 退款单卖家收到金额
		$bs->pushUint32_t($this->refundBuyerRecvFee);	//<uint32_t> 退款单买家收到金额
		$bs->pushUint32_t($this->refundState);	//<uint32_t> 退款单状态, 参考UNPDealState_E中有关退款的各个状态值
		$bs->pushUint32_t($this->preRefundState);	//<uint32_t> 退款单前一个状态
		$bs->pushUint64_t($this->refundProperty);	//<uint64_t> 退款单属性
		$bs->pushUint32_t($this->refundGenTime);	//<uint32_t> 退款单生成时间
		$bs->pushUint32_t($this->refundApplyTime);	//<uint32_t> 退款申请时间，买家
		$bs->pushUint32_t($this->refundRecvFeeTime);	//<uint32_t> 退款打款完成时间
		$bs->pushUint32_t($this->refundRecvFeeReturnTime);	//<uint32_t> 退款打款返回时间
		$bs->pushUint32_t($this->refundFinishTime);	//<uint32_t> 退款完成时间，退款协议达成
		$bs->pushUint32_t($this->itemReturnSendTime);	//<uint32_t> 买家发送退货时间，有退货时有效
		$bs->pushString($this->itemReturnWuliuInfo);	//<std::string> 买家发送退货物流信息，有退货时有效
		$bs->pushString($this->itemReturnDesc);	//<std::string> 买家退货描述，有退货时有效
		$bs->pushUint8_t($this->itemReturnTradeState);	//<uint8_t> 退货收货状态，有退货时有效，1，收到货，2，未收到货
		$bs->pushUint8_t($this->refundReasonType);	//<uint8_t> 退款原因类型
		$bs->pushString($this->refundReasonDesc);	//<std::string> 退款原因描述
		$bs->pushUint32_t($this->sellerAgreeRefundTime);	//<uint32_t> 卖家同意退款时间
		$bs->pushUint32_t($this->sellerAgreeItemReturnTime);	//<uint32_t> 卖家同意退货时间
		$bs->pushUint32_t($this->sellerRefuseRefundTime);	//<uint32_t> 卖家拒绝退款时间
		$bs->pushString($this->sellerItemReturnAddress);	//<std::string> 卖家退货地址
		$bs->pushString($this->sellerProcessRefundMsg);	//<std::string> 卖家处理退款附言
		$bs->pushString($this->sellerProcessItemReturnMsg);	//<std::string> 卖家处理退货附言
		$bs->pushUint64_t($this->recvFeeId);	//<uint64_t> 退款单打款ID
		$bs->pushUint32_t($this->dealCreateTime);	//<uint32_t> 订单生成时间
		$bs->pushUint32_t($this->timeoutFlag);	//<uint32_t> 超时标识
		$bs->pushUint32_t($this->lastUpdateTime);	//<uint32_t> 记录更新时间
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->control_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundDetailId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId64_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemSkuidList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemTitleList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerAccount_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerNickName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerTitle_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealPayType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemBuyPrice_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemBuyNum_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundItemNum_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundDealTotalFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundItemTotalFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundItemDiscountTotalFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundItemActiveDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundItemAdjustTotalFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundShippingFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundTotalFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundSellerRecvFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundBuyerRecvFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->preRefundState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundProperty_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundGenTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundApplyTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundRecvFeeTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundRecvFeeReturnTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundFinishTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemReturnSendTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemReturnWuliuInfo_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemReturnDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->itemReturnTradeState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundReasonType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->refundReasonDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerAgreeRefundTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerAgreeItemReturnTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerRefuseRefundTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerItemReturnAddress_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerProcessRefundMsg_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerProcessItemReturnMsg_u);	//<uint8_t> 
		$bs->pushUint8_t($this->recvFeeId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealCreateTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->timeoutFlag_u);	//<uint8_t> 
		$bs->pushUint8_t($this->lastUpdateTime_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushString($this->businessRefundId);	//<std::string> 业务退款单号
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->businessRefundId_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 版本号
		$this->_arr_value['control'] = $bs->popUint32_t();	//<uint32_t> 退款单DB操作类型，0:Insert 1:Update
		$this->_arr_value['refundDetailId'] = $bs->popUint64_t();	//<uint64_t> 退款单ID
		$this->_arr_value['dealId'] = $bs->popString();	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		$this->_arr_value['dealId64'] = $bs->popUint64_t();	//<uint64_t> 订单单号，统一平台内部单号
		$this->_arr_value['tradeId'] = $bs->popUint64_t();	//<uint64_t> 商品单ID
		$this->_arr_value['itemSkuidList'] = $bs->popString();	//<std::string> 商品skuID列表
		$this->_arr_value['itemTitleList'] = $bs->popString();	//<std::string> 商品标题列表
		$this->_arr_value['buyerId'] = $bs->popUint64_t();	//<uint64_t> 买家ID
		$this->_arr_value['buyerAccount'] = $bs->popString();	//<std::string> 买家帐号
		$this->_arr_value['buyerNickName'] = $bs->popString();	//<std::string> 买家昵称
		$this->_arr_value['sellerId'] = $bs->popUint64_t();	//<uint64_t> 商家ID
		$this->_arr_value['sellerTitle'] = $bs->popString();	//<std::string> 商家名称
		$this->_arr_value['dealPayType'] = $bs->popUint8_t();	//<uint8_t> 退款订单支付方式
		$this->_arr_value['refundType'] = $bs->popUint8_t();	//<uint8_t> 退款单类型
		$this->_arr_value['itemBuyPrice'] = $bs->popUint32_t();	//<uint32_t> 订单商品成交单价
		$this->_arr_value['itemBuyNum'] = $bs->popUint32_t();	//<uint32_t> 订单商品购买件数，按商品单退款有效
		$this->_arr_value['refundItemNum'] = $bs->popUint32_t();	//<uint32_t> 退款商品件数，按商品单退款有效
		$this->_arr_value['refundDealTotalFee'] = $bs->popUint32_t();	//<uint32_t> 退款订单总金额
		$this->_arr_value['refundItemTotalFee'] = $bs->popUint32_t();	//<uint32_t> 退款商品总金额
		$this->_arr_value['refundItemDiscountTotalFee'] = $bs->popInt32_t();	//<int> 退款商品优惠总金额
		$this->_arr_value['refundItemActiveDesc'] = $bs->popString();	//<std::string> 退款商品占优惠列表
		$this->_arr_value['refundItemAdjustTotalFee'] = $bs->popInt32_t();	//<int> 退款商品调价总金额
		$this->_arr_value['refundShippingFee'] = $bs->popUint32_t();	//<uint32_t> 退款商品邮费总金额
		$this->_arr_value['refundTotalFee'] = $bs->popUint32_t();	//<uint32_t> 退款单总金额
		$this->_arr_value['refundSellerRecvFee'] = $bs->popUint32_t();	//<uint32_t> 退款单卖家收到金额
		$this->_arr_value['refundBuyerRecvFee'] = $bs->popUint32_t();	//<uint32_t> 退款单买家收到金额
		$this->_arr_value['refundState'] = $bs->popUint32_t();	//<uint32_t> 退款单状态, 参考UNPDealState_E中有关退款的各个状态值
		$this->_arr_value['preRefundState'] = $bs->popUint32_t();	//<uint32_t> 退款单前一个状态
		$this->_arr_value['refundProperty'] = $bs->popUint64_t();	//<uint64_t> 退款单属性
		$this->_arr_value['refundGenTime'] = $bs->popUint32_t();	//<uint32_t> 退款单生成时间
		$this->_arr_value['refundApplyTime'] = $bs->popUint32_t();	//<uint32_t> 退款申请时间，买家
		$this->_arr_value['refundRecvFeeTime'] = $bs->popUint32_t();	//<uint32_t> 退款打款完成时间
		$this->_arr_value['refundRecvFeeReturnTime'] = $bs->popUint32_t();	//<uint32_t> 退款打款返回时间
		$this->_arr_value['refundFinishTime'] = $bs->popUint32_t();	//<uint32_t> 退款完成时间，退款协议达成
		$this->_arr_value['itemReturnSendTime'] = $bs->popUint32_t();	//<uint32_t> 买家发送退货时间，有退货时有效
		$this->_arr_value['itemReturnWuliuInfo'] = $bs->popString();	//<std::string> 买家发送退货物流信息，有退货时有效
		$this->_arr_value['itemReturnDesc'] = $bs->popString();	//<std::string> 买家退货描述，有退货时有效
		$this->_arr_value['itemReturnTradeState'] = $bs->popUint8_t();	//<uint8_t> 退货收货状态，有退货时有效，1，收到货，2，未收到货
		$this->_arr_value['refundReasonType'] = $bs->popUint8_t();	//<uint8_t> 退款原因类型
		$this->_arr_value['refundReasonDesc'] = $bs->popString();	//<std::string> 退款原因描述
		$this->_arr_value['sellerAgreeRefundTime'] = $bs->popUint32_t();	//<uint32_t> 卖家同意退款时间
		$this->_arr_value['sellerAgreeItemReturnTime'] = $bs->popUint32_t();	//<uint32_t> 卖家同意退货时间
		$this->_arr_value['sellerRefuseRefundTime'] = $bs->popUint32_t();	//<uint32_t> 卖家拒绝退款时间
		$this->_arr_value['sellerItemReturnAddress'] = $bs->popString();	//<std::string> 卖家退货地址
		$this->_arr_value['sellerProcessRefundMsg'] = $bs->popString();	//<std::string> 卖家处理退款附言
		$this->_arr_value['sellerProcessItemReturnMsg'] = $bs->popString();	//<std::string> 卖家处理退货附言
		$this->_arr_value['recvFeeId'] = $bs->popUint64_t();	//<uint64_t> 退款单打款ID
		$this->_arr_value['dealCreateTime'] = $bs->popUint32_t();	//<uint32_t> 订单生成时间
		$this->_arr_value['timeoutFlag'] = $bs->popUint32_t();	//<uint32_t> 超时标识
		$this->_arr_value['lastUpdateTime'] = $bs->popUint32_t();	//<uint32_t> 记录更新时间
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['control_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundDetailId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId64_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemSkuidList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemTitleList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerAccount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerNickName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerTitle_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealPayType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemBuyPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemBuyNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundItemNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundDealTotalFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundItemTotalFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundItemDiscountTotalFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundItemActiveDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundItemAdjustTotalFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundShippingFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundTotalFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundSellerRecvFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundBuyerRecvFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['preRefundState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundProperty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundGenTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundApplyTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundRecvFeeTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundRecvFeeReturnTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundFinishTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemReturnSendTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemReturnWuliuInfo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemReturnDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemReturnTradeState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundReasonType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['refundReasonDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerAgreeRefundTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerAgreeItemReturnTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerRefuseRefundTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerItemReturnAddress_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerProcessRefundMsg_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerProcessItemReturnMsg_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['recvFeeId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealCreateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timeoutFlag_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['lastUpdateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['businessRefundId'] = $bs->popString();	//<std::string> 业务退款单号
		}
		if($this->version >= 1){
			$this->_arr_value['businessRefundId_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.DealPo.java
class TradeActivePoList{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $tradeActiveInfoList;	//<std::vector<ecc::deal::po::CTradeActivePo> > 商品但活动列表(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $tradeActiveInfoList_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->tradeActiveInfoList = new \stl_vector2('\ecc\deal\po\TradeActivePo');	//<std::vector<ecc::deal::po::CTradeActivePo> >
		$this->version_u = 0;	//<uint8_t>
		$this->tradeActiveInfoList_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\po\TradeActivePoList\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\TradeActivePoList\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushObject($this->tradeActiveInfoList,'stl_vector');	//<std::vector<ecc::deal::po::CTradeActivePo> > 商品但活动列表
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeActiveInfoList_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['tradeActiveInfoList'] = $bs->popObject('stl_vector<\ecc\deal\po\TradeActivePo>');	//<std::vector<ecc::deal::po::CTradeActivePo> > 商品但活动列表
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeActiveInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.TradeActivePoList.java
class TradeActivePo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $id;	//<uint64_t> 记录id(版本>=0)
	private $tradeId;	//<uint64_t> 商品订单编号(版本>=0)
	private $dealId;	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702(版本>=0)
	private $dealId64;	//<uint64_t> 订单单号，统一平台内部单号(版本>=0)
	private $bdealId;	//<uint64_t> 交易订单编号(版本>=0)
	private $buyerId;	//<uint64_t> 买家ID(版本>=0)
	private $sellerId;	//<uint64_t> 商家ID(版本>=0)
	private $activeType;	//<uint16_t> 活动类型，平台统一定义.1:VIP价 2:满减  3:满送 4:满包邮 5:优惠券 (版本>=0)
	private $activeNo;	//<uint64_t> 活动编号(版本>=0)
	private $activeRuleId;	//<uint32_t> 活动命中规则编号(版本>=0)
	private $activeDesc;	//<std::string> 活动描述(版本>=0)
	private $adjustFee;	//<int> 调价金额，商品调价记录用，单件活动(版本>=0)
	private $preActiveFee;	//<uint32_t> 活动前本商品订单金额(版本>=0)
	private $favorFee;	//<int> 活动本商品订单优惠金额，正数表示优惠，负数表示加钱(版本>=0)
	private $activeParam1;	//<uint32_t> 活动参数1(版本>=0)
	private $activeParam2;	//<uint32_t> 活动参数2(版本>=0)
	private $activeParam3;	//<uint32_t> 活动参数3(版本>=0)
	private $activeParam4;	//<uint32_t> 活动参数4(版本>=0)
	private $activeParam5;	//<uint64_t> 活动参数5(版本>=0)
	private $activeParam6;	//<uint64_t> 活动参数6(版本>=0)
	private $activeParam7;	//<std::string> 活动参数7(版本>=0)
	private $activeParam8;	//<std::string> 活动参数8(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $id_u;	//<uint8_t> (版本>=0)
	private $tradeId_u;	//<uint8_t> (版本>=0)
	private $dealId_u;	//<uint8_t> (版本>=0)
	private $dealId64_u;	//<uint8_t> (版本>=0)
	private $bdealId_u;	//<uint8_t> (版本>=0)
	private $buyerId_u;	//<uint8_t> (版本>=0)
	private $sellerId_u;	//<uint8_t> (版本>=0)
	private $activeNo_u;	//<uint8_t> (版本>=0)
	private $activeType_u;	//<uint8_t> (版本>=0)
	private $activeRuleId_u;	//<uint8_t> (版本>=0)
	private $activeDesc_u;	//<uint8_t> (版本>=0)
	private $adjustFee_u;	//<uint8_t> (版本>=0)
	private $preActiveFee_u;	//<uint8_t> (版本>=0)
	private $favorFee_u;	//<uint8_t> (版本>=0)
	private $activeParam1_u;	//<uint8_t> (版本>=0)
	private $activeParam2_u;	//<uint8_t> (版本>=0)
	private $activeParam3_u;	//<uint8_t> (版本>=0)
	private $activeParam4_u;	//<uint8_t> (版本>=0)
	private $activeParam5_u;	//<uint8_t> (版本>=0)
	private $activeParam6_u;	//<uint8_t> (版本>=0)
	private $activeParam7_u;	//<uint8_t> (版本>=0)
	private $activeParam8_u;	//<uint8_t> (版本>=0)
	private $activeRecordType;	//<uint32_t> 记录类型: 0-子单维度,1-订单维度(版本>=1)
	private $activeItemNum;	//<uint32_t> 活动商品数(版本>=1)
	private $activeRecordType_u;	//<uint8_t> (版本>=1)
	private $activeItemNum_u;	//<uint8_t> (版本>=1)

	function __construct(){
		$this->version = 1;	//<uint16_t>
		$this->id = 0;	//<uint64_t>
		$this->tradeId = 0;	//<uint64_t>
		$this->dealId = "";	//<std::string>
		$this->dealId64 = 0;	//<uint64_t>
		$this->bdealId = 0;	//<uint64_t>
		$this->buyerId = 0;	//<uint64_t>
		$this->sellerId = 0;	//<uint64_t>
		$this->activeType = 0;	//<uint16_t>
		$this->activeNo = 0;	//<uint64_t>
		$this->activeRuleId = 0;	//<uint32_t>
		$this->activeDesc = "";	//<std::string>
		$this->adjustFee = 0;	//<int>
		$this->preActiveFee = 0;	//<uint32_t>
		$this->favorFee = 0;	//<int>
		$this->activeParam1 = 0;	//<uint32_t>
		$this->activeParam2 = 0;	//<uint32_t>
		$this->activeParam3 = 0;	//<uint32_t>
		$this->activeParam4 = 0;	//<uint32_t>
		$this->activeParam5 = 0;	//<uint64_t>
		$this->activeParam6 = 0;	//<uint64_t>
		$this->activeParam7 = "";	//<std::string>
		$this->activeParam8 = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->id_u = 0;	//<uint8_t>
		$this->tradeId_u = 0;	//<uint8_t>
		$this->dealId_u = 0;	//<uint8_t>
		$this->dealId64_u = 0;	//<uint8_t>
		$this->bdealId_u = 0;	//<uint8_t>
		$this->buyerId_u = 0;	//<uint8_t>
		$this->sellerId_u = 0;	//<uint8_t>
		$this->activeNo_u = 0;	//<uint8_t>
		$this->activeType_u = 0;	//<uint8_t>
		$this->activeRuleId_u = 0;	//<uint8_t>
		$this->activeDesc_u = 0;	//<uint8_t>
		$this->adjustFee_u = 0;	//<uint8_t>
		$this->preActiveFee_u = 0;	//<uint8_t>
		$this->favorFee_u = 0;	//<uint8_t>
		$this->activeParam1_u = 0;	//<uint8_t>
		$this->activeParam2_u = 0;	//<uint8_t>
		$this->activeParam3_u = 0;	//<uint8_t>
		$this->activeParam4_u = 0;	//<uint8_t>
		$this->activeParam5_u = 0;	//<uint8_t>
		$this->activeParam6_u = 0;	//<uint8_t>
		$this->activeParam7_u = 0;	//<uint8_t>
		$this->activeParam8_u = 0;	//<uint8_t>
		$this->activeRecordType = 0;	//<uint32_t>
		$this->activeItemNum = 0;	//<uint32_t>
		$this->activeRecordType_u = 0;	//<uint8_t>
		$this->activeItemNum_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\po\TradeActivePo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\TradeActivePo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushUint64_t($this->id);	//<uint64_t> 记录id
		$bs->pushUint64_t($this->tradeId);	//<uint64_t> 商品订单编号
		$bs->pushString($this->dealId);	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		$bs->pushUint64_t($this->dealId64);	//<uint64_t> 订单单号，统一平台内部单号
		$bs->pushUint64_t($this->bdealId);	//<uint64_t> 交易订单编号
		$bs->pushUint64_t($this->buyerId);	//<uint64_t> 买家ID
		$bs->pushUint64_t($this->sellerId);	//<uint64_t> 商家ID
		$bs->pushUint16_t($this->activeType);	//<uint16_t> 活动类型，平台统一定义.1:VIP价 2:满减  3:满送 4:满包邮 5:优惠券 
		$bs->pushUint64_t($this->activeNo);	//<uint64_t> 活动编号
		$bs->pushUint32_t($this->activeRuleId);	//<uint32_t> 活动命中规则编号
		$bs->pushString($this->activeDesc);	//<std::string> 活动描述
		$bs->pushInt32_t($this->adjustFee);	//<int> 调价金额，商品调价记录用，单件活动
		$bs->pushUint32_t($this->preActiveFee);	//<uint32_t> 活动前本商品订单金额
		$bs->pushInt32_t($this->favorFee);	//<int> 活动本商品订单优惠金额，正数表示优惠，负数表示加钱
		$bs->pushUint32_t($this->activeParam1);	//<uint32_t> 活动参数1
		$bs->pushUint32_t($this->activeParam2);	//<uint32_t> 活动参数2
		$bs->pushUint32_t($this->activeParam3);	//<uint32_t> 活动参数3
		$bs->pushUint32_t($this->activeParam4);	//<uint32_t> 活动参数4
		$bs->pushUint64_t($this->activeParam5);	//<uint64_t> 活动参数5
		$bs->pushUint64_t($this->activeParam6);	//<uint64_t> 活动参数6
		$bs->pushString($this->activeParam7);	//<std::string> 活动参数7
		$bs->pushString($this->activeParam8);	//<std::string> 活动参数8
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->id_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId64_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->activeNo_u);	//<uint8_t> 
		$bs->pushUint8_t($this->activeType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->activeRuleId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->activeDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->adjustFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->preActiveFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->favorFee_u);	//<uint8_t> 
		$bs->pushUint8_t($this->activeParam1_u);	//<uint8_t> 
		$bs->pushUint8_t($this->activeParam2_u);	//<uint8_t> 
		$bs->pushUint8_t($this->activeParam3_u);	//<uint8_t> 
		$bs->pushUint8_t($this->activeParam4_u);	//<uint8_t> 
		$bs->pushUint8_t($this->activeParam5_u);	//<uint8_t> 
		$bs->pushUint8_t($this->activeParam6_u);	//<uint8_t> 
		$bs->pushUint8_t($this->activeParam7_u);	//<uint8_t> 
		$bs->pushUint8_t($this->activeParam8_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushUint32_t($this->activeRecordType);	//<uint32_t> 记录类型: 0-子单维度,1-订单维度
		}
		if($this->version >= 1){
			$bs->pushUint32_t($this->activeItemNum);	//<uint32_t> 活动商品数
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->activeRecordType_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->activeItemNum_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['id'] = $bs->popUint64_t();	//<uint64_t> 记录id
		$this->_arr_value['tradeId'] = $bs->popUint64_t();	//<uint64_t> 商品订单编号
		$this->_arr_value['dealId'] = $bs->popString();	//<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		$this->_arr_value['dealId64'] = $bs->popUint64_t();	//<uint64_t> 订单单号，统一平台内部单号
		$this->_arr_value['bdealId'] = $bs->popUint64_t();	//<uint64_t> 交易订单编号
		$this->_arr_value['buyerId'] = $bs->popUint64_t();	//<uint64_t> 买家ID
		$this->_arr_value['sellerId'] = $bs->popUint64_t();	//<uint64_t> 商家ID
		$this->_arr_value['activeType'] = $bs->popUint16_t();	//<uint16_t> 活动类型，平台统一定义.1:VIP价 2:满减  3:满送 4:满包邮 5:优惠券 
		$this->_arr_value['activeNo'] = $bs->popUint64_t();	//<uint64_t> 活动编号
		$this->_arr_value['activeRuleId'] = $bs->popUint32_t();	//<uint32_t> 活动命中规则编号
		$this->_arr_value['activeDesc'] = $bs->popString();	//<std::string> 活动描述
		$this->_arr_value['adjustFee'] = $bs->popInt32_t();	//<int> 调价金额，商品调价记录用，单件活动
		$this->_arr_value['preActiveFee'] = $bs->popUint32_t();	//<uint32_t> 活动前本商品订单金额
		$this->_arr_value['favorFee'] = $bs->popInt32_t();	//<int> 活动本商品订单优惠金额，正数表示优惠，负数表示加钱
		$this->_arr_value['activeParam1'] = $bs->popUint32_t();	//<uint32_t> 活动参数1
		$this->_arr_value['activeParam2'] = $bs->popUint32_t();	//<uint32_t> 活动参数2
		$this->_arr_value['activeParam3'] = $bs->popUint32_t();	//<uint32_t> 活动参数3
		$this->_arr_value['activeParam4'] = $bs->popUint32_t();	//<uint32_t> 活动参数4
		$this->_arr_value['activeParam5'] = $bs->popUint64_t();	//<uint64_t> 活动参数5
		$this->_arr_value['activeParam6'] = $bs->popUint64_t();	//<uint64_t> 活动参数6
		$this->_arr_value['activeParam7'] = $bs->popString();	//<std::string> 活动参数7
		$this->_arr_value['activeParam8'] = $bs->popString();	//<std::string> 活动参数8
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['id_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId64_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['activeNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['activeType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['activeRuleId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['activeDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['adjustFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['preActiveFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['favorFee_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['activeParam1_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['activeParam2_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['activeParam3_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['activeParam4_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['activeParam5_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['activeParam6_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['activeParam7_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['activeParam8_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['activeRecordType'] = $bs->popUint32_t();	//<uint32_t> 记录类型: 0-子单维度,1-订单维度
		}
		if($this->version >= 1){
			$this->_arr_value['activeItemNum'] = $bs->popUint32_t();	//<uint32_t> 活动商品数
		}
		if($this->version >= 1){
			$this->_arr_value['activeRecordType_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['activeItemNum_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.AuditDealReq.java
class EventParamsBaseBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $buyerId;	//<uint64_t> 买家id(版本>=0)
	private $sellerId;	//<uint64_t> 卖家id(版本>=0)
	private $eventId;	//<uint32_t> 事件id,订单系统分配(版本>=0)
	private $operatorRole;	//<uint32_t> 操作者角色(版本>=0)
	private $eventSource;	//<std::string> 事件来源，业务必填，请填写调用服务名或文件名(版本>=0)
	private $dealId;	//<std::string> 订单id(版本>=0)
	private $tradeId;	//<uint64_t> 子单id(版本>=0)
	private $clientIp;	//<std::string> 来源ip(版本>=0)
	private $machineKey;	//<std::string> 机器码(版本>=0)
	private $operatorName;	//<std::string> 操作人(版本>=0)
	private $reserve;	//<std::string> 保留字段(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $buyerId_u;	//<uint8_t> (版本>=0)
	private $sellerId_u;	//<uint8_t> (版本>=0)
	private $eventId_u;	//<uint8_t> (版本>=0)
	private $operatorRole_u;	//<uint8_t> (版本>=0)
	private $eventSource_u;	//<uint8_t> (版本>=0)
	private $dealId_u;	//<uint8_t> (版本>=0)
	private $tradeId_u;	//<uint8_t> (版本>=0)
	private $clientIp_u;	//<uint8_t> (版本>=0)
	private $machineKey_u;	//<uint8_t> (版本>=0)
	private $operatorName_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)
	private $bdealId;	//<std::string> 交易单号(版本>=1)
	private $bdealId_u;	//<uint8_t> (版本>=1)

	function __construct(){
		$this->version = 1;	//<uint16_t>
		$this->buyerId = 0;	//<uint64_t>
		$this->sellerId = 0;	//<uint64_t>
		$this->eventId = 0;	//<uint32_t>
		$this->operatorRole = 0;	//<uint32_t>
		$this->eventSource = "";	//<std::string>
		$this->dealId = "";	//<std::string>
		$this->tradeId = 0;	//<uint64_t>
		$this->clientIp = "";	//<std::string>
		$this->machineKey = "";	//<std::string>
		$this->operatorName = "";	//<std::string>
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->buyerId_u = 0;	//<uint8_t>
		$this->sellerId_u = 0;	//<uint8_t>
		$this->eventId_u = 0;	//<uint8_t>
		$this->operatorRole_u = 0;	//<uint8_t>
		$this->eventSource_u = 0;	//<uint8_t>
		$this->dealId_u = 0;	//<uint8_t>
		$this->tradeId_u = 0;	//<uint8_t>
		$this->clientIp_u = 0;	//<uint8_t>
		$this->machineKey_u = 0;	//<uint8_t>
		$this->operatorName_u = 0;	//<uint8_t>
		$this->reserve_u = 0;	//<uint8_t>
		$this->bdealId = "";	//<std::string>
		$this->bdealId_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\bo\EventParamsBaseBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\EventParamsBaseBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushUint64_t($this->buyerId);	//<uint64_t> 买家id
		$bs->pushUint64_t($this->sellerId);	//<uint64_t> 卖家id
		$bs->pushUint32_t($this->eventId);	//<uint32_t> 事件id,订单系统分配
		$bs->pushUint32_t($this->operatorRole);	//<uint32_t> 操作者角色
		$bs->pushString($this->eventSource);	//<std::string> 事件来源，业务必填，请填写调用服务名或文件名
		$bs->pushString($this->dealId);	//<std::string> 订单id
		$bs->pushUint64_t($this->tradeId);	//<uint64_t> 子单id
		$bs->pushString($this->clientIp);	//<std::string> 来源ip
		$bs->pushString($this->machineKey);	//<std::string> 机器码
		$bs->pushString($this->operatorName);	//<std::string> 操作人
		$bs->pushString($this->reserve);	//<std::string> 保留字段
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sellerId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->eventId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operatorRole_u);	//<uint8_t> 
		$bs->pushUint8_t($this->eventSource_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->clientIp_u);	//<uint8_t> 
		$bs->pushUint8_t($this->machineKey_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operatorName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushString($this->bdealId);	//<std::string> 交易单号
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->bdealId_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['buyerId'] = $bs->popUint64_t();	//<uint64_t> 买家id
		$this->_arr_value['sellerId'] = $bs->popUint64_t();	//<uint64_t> 卖家id
		$this->_arr_value['eventId'] = $bs->popUint32_t();	//<uint32_t> 事件id,订单系统分配
		$this->_arr_value['operatorRole'] = $bs->popUint32_t();	//<uint32_t> 操作者角色
		$this->_arr_value['eventSource'] = $bs->popString();	//<std::string> 事件来源，业务必填，请填写调用服务名或文件名
		$this->_arr_value['dealId'] = $bs->popString();	//<std::string> 订单id
		$this->_arr_value['tradeId'] = $bs->popUint64_t();	//<uint64_t> 子单id
		$this->_arr_value['clientIp'] = $bs->popString();	//<std::string> 来源ip
		$this->_arr_value['machineKey'] = $bs->popString();	//<std::string> 机器码
		$this->_arr_value['operatorName'] = $bs->popString();	//<std::string> 操作人
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 保留字段
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['eventId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operatorRole_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['eventSource_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['clientIp_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['machineKey_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operatorName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserve_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['bdealId'] = $bs->popString();	//<std::string> 交易单号
		}
		if($this->version >= 1){
			$this->_arr_value['bdealId_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace ecc\deal\bo;	//source idl: com.ecc.deal.idl.AuditDealReq.java
class EventParamsAuditDealBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $auditTime;	//<uint32_t> 审核时间(版本>=0)
	private $auditDesc;	//<std::string> 审核描述,不超过128个字(版本>=0)
	private $auditResult;	//<uint32_t> 审核结果: 1-审核通过;2-取消审核;(版本>=0)
	private $reserve;	//<std::string> 保留字段(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $auditTime_u;	//<uint8_t> (版本>=0)
	private $auditDesc_u;	//<uint8_t> (版本>=0)
	private $auditResult_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->auditTime = 0;	//<uint32_t>
		$this->auditDesc = "";	//<std::string>
		$this->auditResult = 0;	//<uint32_t>
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->auditTime_u = 0;	//<uint8_t>
		$this->auditDesc_u = 0;	//<uint8_t>
		$this->auditResult_u = 0;	//<uint8_t>
		$this->reserve_u = 0;	//<uint8_t>
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
			exit("\ecc\deal\bo\EventParamsAuditDealBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\bo\EventParamsAuditDealBo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushUint32_t($this->auditTime);	//<uint32_t> 审核时间
		$bs->pushString($this->auditDesc);	//<std::string> 审核描述,不超过128个字
		$bs->pushUint32_t($this->auditResult);	//<uint32_t> 审核结果: 1-审核通过;2-取消审核;
		$bs->pushString($this->reserve);	//<std::string> 保留字段
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->auditTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->auditDesc_u);	//<uint8_t> 
		$bs->pushUint8_t($this->auditResult_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['auditTime'] = $bs->popUint32_t();	//<uint32_t> 审核时间
		$this->_arr_value['auditDesc'] = $bs->popString();	//<std::string> 审核描述,不超过128个字
		$this->_arr_value['auditResult'] = $bs->popUint32_t();	//<uint32_t> 审核结果: 1-审核通过;2-取消审核;
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 保留字段
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['auditTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['auditDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['auditResult_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserve_u'] = $bs->popUint8_t();	//<uint8_t> 

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
