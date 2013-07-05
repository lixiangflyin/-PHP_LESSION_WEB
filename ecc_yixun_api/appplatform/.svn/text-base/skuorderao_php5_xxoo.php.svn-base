<?php
namespace b2b2c\skuorder\po;	//source idl: com.b2b2c.skuorder.idl.DecreaseProductReq.java
class Event4AppPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号   (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $eventId;	//<uint64_t> 事件单号 (版本>=0)
	private $eventId_u;	//<uint8_t> (版本>=0)
	private $eventType;	//<uint32_t> 事件类型 (版本>=0)
	private $eventType_u;	//<uint8_t> (版本>=0)
	private $eventSubType;	//<uint32_t> 事件子类型 (版本>=0)
	private $eventSubType_u;	//<uint8_t> (版本>=0)
	private $eventSourceId;	//<uint32_t> 单据来源(版本>=0)
	private $eventSourceId_u;	//<uint8_t> (版本>=0)
	private $eventModifyType;	//<uint32_t> 修改类型(版本>=0)
	private $eventModifyType_u;	//<uint8_t> (版本>=0)
	private $eventCreateTime;	//<uint32_t> 事件创建时间事件 (版本>=0)
	private $eventCreateTime_u;	//<uint8_t> (版本>=0)
	private $eventExcuteTime;	//<uint32_t> 事件执行时间事件 (版本>=0)
	private $eventExcuteTime_u;	//<uint8_t> (版本>=0)
	private $operatorId;	//<std::string> 操作者Id (版本>=0)
	private $operatorId_u;	//<uint8_t> (版本>=0)
	private $principalId;	//<std::string> 负责人Id (版本>=0)
	private $principalId_u;	//<uint8_t> (版本>=0)
	private $operatorClientIp;	//<uint32_t> 操作者ip (版本>=0)
	private $operatorClientIp_u;	//<uint8_t> (版本>=0)
	private $operationReason;	//<std::string> 备注 (版本>=0)
	private $operationReason_u;	//<uint8_t> (版本>=0)
	private $reserveDdw;	//<uint64_t> 保留字段dw(版本>=0)
	private $reserveDdw_u;	//<uint8_t> (版本>=0)
	private $reserveStr;	//<std::string> 保留字段str(版本>=0)
	private $reserveStr_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->eventId = 0;	//<uint64_t>
		$this->eventId_u = 0;	//<uint8_t>
		$this->eventType = 0;	//<uint32_t>
		$this->eventType_u = 0;	//<uint8_t>
		$this->eventSubType = 0;	//<uint32_t>
		$this->eventSubType_u = 0;	//<uint8_t>
		$this->eventSourceId = 0;	//<uint32_t>
		$this->eventSourceId_u = 0;	//<uint8_t>
		$this->eventModifyType = 0;	//<uint32_t>
		$this->eventModifyType_u = 0;	//<uint8_t>
		$this->eventCreateTime = 0;	//<uint32_t>
		$this->eventCreateTime_u = 0;	//<uint8_t>
		$this->eventExcuteTime = 0;	//<uint32_t>
		$this->eventExcuteTime_u = 0;	//<uint8_t>
		$this->operatorId = "";	//<std::string>
		$this->operatorId_u = 0;	//<uint8_t>
		$this->principalId = "";	//<std::string>
		$this->principalId_u = 0;	//<uint8_t>
		$this->operatorClientIp = 0;	//<uint32_t>
		$this->operatorClientIp_u = 0;	//<uint8_t>
		$this->operationReason = "";	//<std::string>
		$this->operationReason_u = 0;	//<uint8_t>
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
			exit("\b2b2c\skuorder\po\Event4AppPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\skuorder\po\Event4AppPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint64_t($this->eventId);	//<uint64_t> 事件单号 
		$bs->pushUint8_t($this->eventId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->eventType);	//<uint32_t> 事件类型 
		$bs->pushUint8_t($this->eventType_u);	//<uint8_t> 
		$bs->pushUint32_t($this->eventSubType);	//<uint32_t> 事件子类型 
		$bs->pushUint8_t($this->eventSubType_u);	//<uint8_t> 
		$bs->pushUint32_t($this->eventSourceId);	//<uint32_t> 单据来源
		$bs->pushUint8_t($this->eventSourceId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->eventModifyType);	//<uint32_t> 修改类型
		$bs->pushUint8_t($this->eventModifyType_u);	//<uint8_t> 
		$bs->pushUint32_t($this->eventCreateTime);	//<uint32_t> 事件创建时间事件 
		$bs->pushUint8_t($this->eventCreateTime_u);	//<uint8_t> 
		$bs->pushUint32_t($this->eventExcuteTime);	//<uint32_t> 事件执行时间事件 
		$bs->pushUint8_t($this->eventExcuteTime_u);	//<uint8_t> 
		$bs->pushString($this->operatorId);	//<std::string> 操作者Id 
		$bs->pushUint8_t($this->operatorId_u);	//<uint8_t> 
		$bs->pushString($this->principalId);	//<std::string> 负责人Id 
		$bs->pushUint8_t($this->principalId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->operatorClientIp);	//<uint32_t> 操作者ip 
		$bs->pushUint8_t($this->operatorClientIp_u);	//<uint8_t> 
		$bs->pushString($this->operationReason);	//<std::string> 备注 
		$bs->pushUint8_t($this->operationReason_u);	//<uint8_t> 
		$bs->pushUint64_t($this->reserveDdw);	//<uint64_t> 保留字段dw
		$bs->pushUint8_t($this->reserveDdw_u);	//<uint8_t> 
		$bs->pushString($this->reserveStr);	//<std::string> 保留字段str
		$bs->pushUint8_t($this->reserveStr_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号   
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['eventId'] = $bs->popUint64_t();	//<uint64_t> 事件单号 
		$this->_arr_value['eventId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['eventType'] = $bs->popUint32_t();	//<uint32_t> 事件类型 
		$this->_arr_value['eventType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['eventSubType'] = $bs->popUint32_t();	//<uint32_t> 事件子类型 
		$this->_arr_value['eventSubType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['eventSourceId'] = $bs->popUint32_t();	//<uint32_t> 单据来源
		$this->_arr_value['eventSourceId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['eventModifyType'] = $bs->popUint32_t();	//<uint32_t> 修改类型
		$this->_arr_value['eventModifyType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['eventCreateTime'] = $bs->popUint32_t();	//<uint32_t> 事件创建时间事件 
		$this->_arr_value['eventCreateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['eventExcuteTime'] = $bs->popUint32_t();	//<uint32_t> 事件执行时间事件 
		$this->_arr_value['eventExcuteTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operatorId'] = $bs->popString();	//<std::string> 操作者Id 
		$this->_arr_value['operatorId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['principalId'] = $bs->popString();	//<std::string> 负责人Id 
		$this->_arr_value['principalId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operatorClientIp'] = $bs->popUint32_t();	//<uint32_t> 操作者ip 
		$this->_arr_value['operatorClientIp_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operationReason'] = $bs->popString();	//<std::string> 备注 
		$this->_arr_value['operationReason_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserveDdw'] = $bs->popUint64_t();	//<uint64_t> 保留字段dw
		$this->_arr_value['reserveDdw_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserveStr'] = $bs->popString();	//<std::string> 保留字段str
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

namespace b2b2c\skuorder\po;	//source idl: com.b2b2c.skuorder.idl.DecreaseProductReq.java
class OmsFixupInfoPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $inventoySysno;	//<uint64_t> 系统编号，不可外部传入修改(版本>=0)
	private $inventoySysno_u;	//<uint8_t> (版本>=0)
	private $productSysno;	//<uint64_t> 产品系统编号，必填(版本>=0)
	private $productSysno_u;	//<uint8_t> (版本>=0)
	private $stockSysno;	//<uint64_t> 仓库编号，必填(版本>=0)
	private $stockSysno_u;	//<uint8_t> (版本>=0)
	private $orderToken;	//<uint64_t> 订单token，必填(版本>=0)
	private $orderToken_u;	//<uint8_t> (版本>=0)
	private $orderSequence;	//<uint64_t> 订单sequence，必填(版本>=0)
	private $orderSequence_u;	//<uint8_t> (版本>=0)
	private $orderSysno;	//<uint64_t> 订单编号，传入覆盖(版本>=0)
	private $orderSysno_u;	//<uint8_t> (版本>=0)
	private $userNo;	//<uint64_t> 买家编号，必填(版本>=0)
	private $userNo_u;	//<uint8_t> (版本>=0)
	private $ownerSysno;	//<uint64_t> 货主编号，不可外部传入修改(版本>=0)
	private $ownerSysno_u;	//<uint8_t> (版本>=0)
	private $platform;	//<uint64_t> 平台编号，必填(版本>=0)
	private $platform_u;	//<uint8_t> (版本>=0)
	private $state;	//<uint32_t> 状态，不可外部传入修改(版本>=0)
	private $state_u;	//<uint8_t> (版本>=0)
	private $orderDecreasedNum;	//<uint32_t> 订单锁定数量，必填(版本>=0)
	private $orderDecreasedNum_u;	//<uint8_t> (版本>=0)
	private $realDecreasedNum;	//<uint32_t> 实库锁定数量，不可外部传入修改(版本>=0)
	private $realDecreasedNum_u;	//<uint8_t> (版本>=0)
	private $oversellDecreasedNum;	//<uint32_t> 可超卖锁定数量，不可外部传入修改(版本>=0)
	private $oversellDecreasedNum_u;	//<uint8_t> (版本>=0)
	private $virtualDecreasedNum;	//<uint32_t> 虚库锁定数量，不可外部传入修改(版本>=0)
	private $virtualDecreasedNum_u;	//<uint8_t> (版本>=0)
	private $activeDecreasedNum;	//<uint32_t> 活动锁定数量，不可外部传入修改(版本>=0)
	private $activeDecreasedNum_u;	//<uint8_t> (版本>=0)
	private $orderSource;	//<uint32_t> 订单来源，必填(版本>=0)
	private $orderSource_u;	//<uint8_t> (版本>=0)
	private $orderType;	//<uint32_t> 订单类型，必填(版本>=0)
	private $orderType_u;	//<uint8_t> (版本>=0)
	private $activeSysno;	//<uint32_t> 促销编号，促销必填(版本>=0)
	private $activeSysno_u;	//<uint8_t> (版本>=0)
	private $lastUpdateTime;	//<uint32_t> 最后修改时间(版本>=0)
	private $lastUpdateTime_u;	//<uint8_t> (版本>=0)
	private $addTime;	//<uint32_t> 添加时间(版本>=0)
	private $addTime_u;	//<uint8_t> (版本>=0)
	private $fixupHash;	//<std::string> 关键字段的hash值(版本>=0)
	private $fixupHash_u;	//<uint8_t> (版本>=0)
	private $reserve;	//<std::string> 添加时间(版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->inventoySysno = 0;	//<uint64_t>
		$this->inventoySysno_u = 0;	//<uint8_t>
		$this->productSysno = 0;	//<uint64_t>
		$this->productSysno_u = 0;	//<uint8_t>
		$this->stockSysno = 0;	//<uint64_t>
		$this->stockSysno_u = 0;	//<uint8_t>
		$this->orderToken = 0;	//<uint64_t>
		$this->orderToken_u = 0;	//<uint8_t>
		$this->orderSequence = 0;	//<uint64_t>
		$this->orderSequence_u = 0;	//<uint8_t>
		$this->orderSysno = 0;	//<uint64_t>
		$this->orderSysno_u = 0;	//<uint8_t>
		$this->userNo = 0;	//<uint64_t>
		$this->userNo_u = 0;	//<uint8_t>
		$this->ownerSysno = 0;	//<uint64_t>
		$this->ownerSysno_u = 0;	//<uint8_t>
		$this->platform = 0;	//<uint64_t>
		$this->platform_u = 0;	//<uint8_t>
		$this->state = 0;	//<uint32_t>
		$this->state_u = 0;	//<uint8_t>
		$this->orderDecreasedNum = 0;	//<uint32_t>
		$this->orderDecreasedNum_u = 0;	//<uint8_t>
		$this->realDecreasedNum = 0;	//<uint32_t>
		$this->realDecreasedNum_u = 0;	//<uint8_t>
		$this->oversellDecreasedNum = 0;	//<uint32_t>
		$this->oversellDecreasedNum_u = 0;	//<uint8_t>
		$this->virtualDecreasedNum = 0;	//<uint32_t>
		$this->virtualDecreasedNum_u = 0;	//<uint8_t>
		$this->activeDecreasedNum = 0;	//<uint32_t>
		$this->activeDecreasedNum_u = 0;	//<uint8_t>
		$this->orderSource = 0;	//<uint32_t>
		$this->orderSource_u = 0;	//<uint8_t>
		$this->orderType = 0;	//<uint32_t>
		$this->orderType_u = 0;	//<uint8_t>
		$this->activeSysno = 0;	//<uint32_t>
		$this->activeSysno_u = 0;	//<uint8_t>
		$this->lastUpdateTime = 0;	//<uint32_t>
		$this->lastUpdateTime_u = 0;	//<uint8_t>
		$this->addTime = 0;	//<uint32_t>
		$this->addTime_u = 0;	//<uint8_t>
		$this->fixupHash = "";	//<std::string>
		$this->fixupHash_u = 0;	//<uint8_t>
		$this->reserve = "";	//<std::string>
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
			exit("\b2b2c\skuorder\po\OmsFixupInfoPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\skuorder\po\OmsFixupInfoPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint64_t($this->inventoySysno);	//<uint64_t> 系统编号，不可外部传入修改
		$bs->pushUint8_t($this->inventoySysno_u);	//<uint8_t> 
		$bs->pushUint64_t($this->productSysno);	//<uint64_t> 产品系统编号，必填
		$bs->pushUint8_t($this->productSysno_u);	//<uint8_t> 
		$bs->pushUint64_t($this->stockSysno);	//<uint64_t> 仓库编号，必填
		$bs->pushUint8_t($this->stockSysno_u);	//<uint8_t> 
		$bs->pushUint64_t($this->orderToken);	//<uint64_t> 订单token，必填
		$bs->pushUint8_t($this->orderToken_u);	//<uint8_t> 
		$bs->pushUint64_t($this->orderSequence);	//<uint64_t> 订单sequence，必填
		$bs->pushUint8_t($this->orderSequence_u);	//<uint8_t> 
		$bs->pushUint64_t($this->orderSysno);	//<uint64_t> 订单编号，传入覆盖
		$bs->pushUint8_t($this->orderSysno_u);	//<uint8_t> 
		$bs->pushUint64_t($this->userNo);	//<uint64_t> 买家编号，必填
		$bs->pushUint8_t($this->userNo_u);	//<uint8_t> 
		$bs->pushUint64_t($this->ownerSysno);	//<uint64_t> 货主编号，不可外部传入修改
		$bs->pushUint8_t($this->ownerSysno_u);	//<uint8_t> 
		$bs->pushUint64_t($this->platform);	//<uint64_t> 平台编号，必填
		$bs->pushUint8_t($this->platform_u);	//<uint8_t> 
		$bs->pushUint32_t($this->state);	//<uint32_t> 状态，不可外部传入修改
		$bs->pushUint8_t($this->state_u);	//<uint8_t> 
		$bs->pushUint32_t($this->orderDecreasedNum);	//<uint32_t> 订单锁定数量，必填
		$bs->pushUint8_t($this->orderDecreasedNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->realDecreasedNum);	//<uint32_t> 实库锁定数量，不可外部传入修改
		$bs->pushUint8_t($this->realDecreasedNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->oversellDecreasedNum);	//<uint32_t> 可超卖锁定数量，不可外部传入修改
		$bs->pushUint8_t($this->oversellDecreasedNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->virtualDecreasedNum);	//<uint32_t> 虚库锁定数量，不可外部传入修改
		$bs->pushUint8_t($this->virtualDecreasedNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->activeDecreasedNum);	//<uint32_t> 活动锁定数量，不可外部传入修改
		$bs->pushUint8_t($this->activeDecreasedNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->orderSource);	//<uint32_t> 订单来源，必填
		$bs->pushUint8_t($this->orderSource_u);	//<uint8_t> 
		$bs->pushUint32_t($this->orderType);	//<uint32_t> 订单类型，必填
		$bs->pushUint8_t($this->orderType_u);	//<uint8_t> 
		$bs->pushUint32_t($this->activeSysno);	//<uint32_t> 促销编号，促销必填
		$bs->pushUint8_t($this->activeSysno_u);	//<uint8_t> 
		$bs->pushUint32_t($this->lastUpdateTime);	//<uint32_t> 最后修改时间
		$bs->pushUint8_t($this->lastUpdateTime_u);	//<uint8_t> 
		$bs->pushUint32_t($this->addTime);	//<uint32_t> 添加时间
		$bs->pushUint8_t($this->addTime_u);	//<uint8_t> 
		$bs->pushString($this->fixupHash);	//<std::string> 关键字段的hash值
		$bs->pushUint8_t($this->fixupHash_u);	//<uint8_t> 
		$bs->pushString($this->reserve);	//<std::string> 添加时间
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['inventoySysno'] = $bs->popUint64_t();	//<uint64_t> 系统编号，不可外部传入修改
		$this->_arr_value['inventoySysno_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productSysno'] = $bs->popUint64_t();	//<uint64_t> 产品系统编号，必填
		$this->_arr_value['productSysno_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockSysno'] = $bs->popUint64_t();	//<uint64_t> 仓库编号，必填
		$this->_arr_value['stockSysno_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['orderToken'] = $bs->popUint64_t();	//<uint64_t> 订单token，必填
		$this->_arr_value['orderToken_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['orderSequence'] = $bs->popUint64_t();	//<uint64_t> 订单sequence，必填
		$this->_arr_value['orderSequence_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['orderSysno'] = $bs->popUint64_t();	//<uint64_t> 订单编号，传入覆盖
		$this->_arr_value['orderSysno_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['userNo'] = $bs->popUint64_t();	//<uint64_t> 买家编号，必填
		$this->_arr_value['userNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ownerSysno'] = $bs->popUint64_t();	//<uint64_t> 货主编号，不可外部传入修改
		$this->_arr_value['ownerSysno_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['platform'] = $bs->popUint64_t();	//<uint64_t> 平台编号，必填
		$this->_arr_value['platform_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['state'] = $bs->popUint32_t();	//<uint32_t> 状态，不可外部传入修改
		$this->_arr_value['state_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['orderDecreasedNum'] = $bs->popUint32_t();	//<uint32_t> 订单锁定数量，必填
		$this->_arr_value['orderDecreasedNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['realDecreasedNum'] = $bs->popUint32_t();	//<uint32_t> 实库锁定数量，不可外部传入修改
		$this->_arr_value['realDecreasedNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['oversellDecreasedNum'] = $bs->popUint32_t();	//<uint32_t> 可超卖锁定数量，不可外部传入修改
		$this->_arr_value['oversellDecreasedNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['virtualDecreasedNum'] = $bs->popUint32_t();	//<uint32_t> 虚库锁定数量，不可外部传入修改
		$this->_arr_value['virtualDecreasedNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['activeDecreasedNum'] = $bs->popUint32_t();	//<uint32_t> 活动锁定数量，不可外部传入修改
		$this->_arr_value['activeDecreasedNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['orderSource'] = $bs->popUint32_t();	//<uint32_t> 订单来源，必填
		$this->_arr_value['orderSource_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['orderType'] = $bs->popUint32_t();	//<uint32_t> 订单类型，必填
		$this->_arr_value['orderType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['activeSysno'] = $bs->popUint32_t();	//<uint32_t> 促销编号，促销必填
		$this->_arr_value['activeSysno_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['lastUpdateTime'] = $bs->popUint32_t();	//<uint32_t> 最后修改时间
		$this->_arr_value['lastUpdateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['addTime'] = $bs->popUint32_t();	//<uint32_t> 添加时间
		$this->_arr_value['addTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['fixupHash'] = $bs->popString();	//<std::string> 关键字段的hash值
		$this->_arr_value['fixupHash_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 添加时间
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

namespace b2b2c\skuorder\po;	//source idl: com.b2b2c.skuorder.idl.BatchUnlockItemResp.java
class ResultUnlockItemPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $orderId;	//<std::string> 订单id(版本>=0)
	private $orderId_u;	//<uint8_t> (版本>=0)
	private $result;	//<uint32_t> 解锁结果，0表示成功，非0表示失败(版本>=0)
	private $result_u;	//<uint8_t> (版本>=0)
	private $errMsg;	//<std::string> 解锁错误信息(版本>=0)
	private $errMsg_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->orderId = "";	//<std::string>
		$this->orderId_u = 0;	//<uint8_t>
		$this->result = 0;	//<uint32_t>
		$this->result_u = 0;	//<uint8_t>
		$this->errMsg = "";	//<std::string>
		$this->errMsg_u = 0;	//<uint8_t>
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
			exit("\b2b2c\skuorder\po\ResultUnlockItemPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\skuorder\po\ResultUnlockItemPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 版本
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushString($this->orderId);	//<std::string> 订单id
		$bs->pushUint8_t($this->orderId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->result);	//<uint32_t> 解锁结果，0表示成功，非0表示失败
		$bs->pushUint8_t($this->result_u);	//<uint8_t> 
		$bs->pushString($this->errMsg);	//<std::string> 解锁错误信息
		$bs->pushUint8_t($this->errMsg_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['orderId'] = $bs->popString();	//<std::string> 订单id
		$this->_arr_value['orderId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['result'] = $bs->popUint32_t();	//<uint32_t> 解锁结果，0表示成功，非0表示失败
		$this->_arr_value['result_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string> 解锁错误信息
		$this->_arr_value['errMsg_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace b2b2c\skuorder\po;	//source idl: com.b2b2c.skuorder.idl.BatchUnlockItemReq.java
class UnlockItemPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $releaseStockPo;	//<b2b2c::skuorder::po::CApiReleaseStockPo> api释放库存信息ReqPo(版本>=0)
	private $releaseStockPo_u;	//<uint8_t> (版本>=0)
	private $fixupInfoPo;	//<std::vector<b2b2c::skuorder::po::CFixupInfoPo> > 网购释放库存信息ReqPo(版本>=0)
	private $fixupInfoPo_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->releaseStockPo = new \b2b2c\skuorder\po\ApiReleaseStockPo();	//<b2b2c::skuorder::po::CApiReleaseStockPo>
		$this->releaseStockPo_u = 0;	//<uint8_t>
		$this->fixupInfoPo = new \stl_vector2('\b2b2c\skuorder\po\FixupInfoPo');	//<std::vector<b2b2c::skuorder::po::CFixupInfoPo> >
		$this->fixupInfoPo_u = 0;	//<uint8_t>
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
			exit("\b2b2c\skuorder\po\UnlockItemPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\skuorder\po\UnlockItemPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 版本
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushObject($this->releaseStockPo,'\b2b2c\skuorder\po\ApiReleaseStockPo');	//<b2b2c::skuorder::po::CApiReleaseStockPo> api释放库存信息ReqPo
		$bs->pushUint8_t($this->releaseStockPo_u);	//<uint8_t> 
		$bs->pushObject($this->fixupInfoPo,'stl_vector');	//<std::vector<b2b2c::skuorder::po::CFixupInfoPo> > 网购释放库存信息ReqPo
		$bs->pushUint8_t($this->fixupInfoPo_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['releaseStockPo'] = $bs->popObject('\b2b2c\skuorder\po\ApiReleaseStockPo');	//<b2b2c::skuorder::po::CApiReleaseStockPo> api释放库存信息ReqPo
		$this->_arr_value['releaseStockPo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['fixupInfoPo'] = $bs->popObject('stl_vector<\b2b2c\skuorder\po\FixupInfoPo>');	//<std::vector<b2b2c::skuorder::po::CFixupInfoPo> > 网购释放库存信息ReqPo
		$this->_arr_value['fixupInfoPo_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace b2b2c\skuorder\po;	//source idl: com.b2b2c.skuorder.idl.BatchLockItemResp.java
class ResultLockItemPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $sequenceId;	//<std::string> 网购下单序列号(版本>=0)
	private $sequenceId_u;	//<uint8_t> (版本>=0)
	private $packPo;	//<std::vector<b2b2c::skuorder::po::CApiPackagePo> > 分包信息 (版本>=0)
	private $packPo_u;	//<uint8_t> (版本>=0)
	private $fixupInfoRspPo;	//<std::map<uint64_t,b2b2c::skuorder::po::CFixupInfoRspPo> > 商品锁定后的出价信息(版本>=0)
	private $fixupInfoRspPo_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->sequenceId = "";	//<std::string>
		$this->sequenceId_u = 0;	//<uint8_t>
		$this->packPo = new \stl_vector2('\b2b2c\skuorder\po\ApiPackagePo');	//<std::vector<b2b2c::skuorder::po::CApiPackagePo> >
		$this->packPo_u = 0;	//<uint8_t>
		$this->fixupInfoRspPo = new \stl_map2('uint64_t,\b2b2c\skuorder\po\FixupInfoRspPo');	//<std::map<uint64_t,b2b2c::skuorder::po::CFixupInfoRspPo> >
		$this->fixupInfoRspPo_u = 0;	//<uint8_t>
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
			exit("\b2b2c\skuorder\po\ResultLockItemPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\skuorder\po\ResultLockItemPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->sequenceId);	//<std::string> 网购下单序列号
		$bs->pushUint8_t($this->sequenceId_u);	//<uint8_t> 
		$bs->pushObject($this->packPo,'stl_vector');	//<std::vector<b2b2c::skuorder::po::CApiPackagePo> > 分包信息 
		$bs->pushUint8_t($this->packPo_u);	//<uint8_t> 
		$bs->pushObject($this->fixupInfoRspPo,'stl_map');	//<std::map<uint64_t,b2b2c::skuorder::po::CFixupInfoRspPo> > 商品锁定后的出价信息
		$bs->pushUint8_t($this->fixupInfoRspPo_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sequenceId'] = $bs->popString();	//<std::string> 网购下单序列号
		$this->_arr_value['sequenceId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['packPo'] = $bs->popObject('stl_vector<\b2b2c\skuorder\po\ApiPackagePo>');	//<std::vector<b2b2c::skuorder::po::CApiPackagePo> > 分包信息 
		$this->_arr_value['packPo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['fixupInfoRspPo'] = $bs->popObject('stl_map<uint64_t,\b2b2c\skuorder\po\FixupInfoRspPo>');	//<std::map<uint64_t,b2b2c::skuorder::po::CFixupInfoRspPo> > 商品锁定后的出价信息
		$this->_arr_value['fixupInfoRspPo_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace b2b2c\skuorder\po;	//source idl: com.b2b2c.skuorder.idl.ResultLockItemPo.java
class FixupInfoRspPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号 (版本>=0)
	private $stockState;	//<uint8_t> 锁定时的商品实际库存状态，锁定成功时的接口返回参数(版本>=0)
	private $surplusNum;	//<uint32_t> 锁定完成后，实际剩余库存数量（普通锁定返回普通剩余库存，活动锁定返回活动剩余库存），锁定成功时的接口返回参数(版本>=0)
	private $lockNum;	//<uint32_t> 本次完成实际锁定的数量，锁定成功时的接口返回参数(版本>=0)
	private $cooperatorProtocolId;	//<uint64_t> 锁定商品成功后返回的结算规则ID，锁定成功时的接口返回参数(版本>=0)
	private $reserveDw;	//<uint32_t> 保留字段dw(版本>=0)
	private $reserveStr;	//<std::string> 保留字段str(版本>=0)
	private $version_u;	//<uint8_t> 版本号_u(版本>=0)
	private $stockState_u;	//<uint8_t> 锁定时的商品实际库存状态，锁定成功时的接口返回参数_u(版本>=0)
	private $surplusNum_u;	//<uint8_t> 实际剩余库存数量，锁定成功时的接口返回参数_u(版本>=0)
	private $lockNum_u;	//<uint8_t> 实际锁定数量，锁定成功时的接口返回参数_u(版本>=0)
	private $cooperatorProtocolId_u;	//<uint8_t> 锁定商品成功后返回的结算规则ID，锁定成功时的接口返回参数_u(版本>=0)
	private $reserveDw_u;	//<uint8_t> 保留字段dw_u(版本>=0)
	private $reserveStr_u;	//<uint8_t> 保留字段str_u(版本>=0)

	function __construct(){
		$this->version = 1;	//<uint32_t>
		$this->stockState = 0;	//<uint8_t>
		$this->surplusNum = 0;	//<uint32_t>
		$this->lockNum = 0;	//<uint32_t>
		$this->cooperatorProtocolId = 0;	//<uint64_t>
		$this->reserveDw = 0;	//<uint32_t>
		$this->reserveStr = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->stockState_u = 0;	//<uint8_t>
		$this->surplusNum_u = 0;	//<uint8_t>
		$this->lockNum_u = 0;	//<uint8_t>
		$this->cooperatorProtocolId_u = 0;	//<uint8_t>
		$this->reserveDw_u = 0;	//<uint8_t>
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
			exit("\b2b2c\skuorder\po\FixupInfoRspPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\skuorder\po\FixupInfoRspPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint8_t($this->stockState);	//<uint8_t> 锁定时的商品实际库存状态，锁定成功时的接口返回参数
		$bs->pushUint32_t($this->surplusNum);	//<uint32_t> 锁定完成后，实际剩余库存数量（普通锁定返回普通剩余库存，活动锁定返回活动剩余库存），锁定成功时的接口返回参数
		$bs->pushUint32_t($this->lockNum);	//<uint32_t> 本次完成实际锁定的数量，锁定成功时的接口返回参数
		$bs->pushUint64_t($this->cooperatorProtocolId);	//<uint64_t> 锁定商品成功后返回的结算规则ID，锁定成功时的接口返回参数
		$bs->pushUint32_t($this->reserveDw);	//<uint32_t> 保留字段dw
		$bs->pushString($this->reserveStr);	//<std::string> 保留字段str
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 版本号_u
		$bs->pushUint8_t($this->stockState_u);	//<uint8_t> 锁定时的商品实际库存状态，锁定成功时的接口返回参数_u
		$bs->pushUint8_t($this->surplusNum_u);	//<uint8_t> 实际剩余库存数量，锁定成功时的接口返回参数_u
		$bs->pushUint8_t($this->lockNum_u);	//<uint8_t> 实际锁定数量，锁定成功时的接口返回参数_u
		$bs->pushUint8_t($this->cooperatorProtocolId_u);	//<uint8_t> 锁定商品成功后返回的结算规则ID，锁定成功时的接口返回参数_u
		$bs->pushUint8_t($this->reserveDw_u);	//<uint8_t> 保留字段dw_u
		$bs->pushUint8_t($this->reserveStr_u);	//<uint8_t> 保留字段str_u
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号 
		$this->_arr_value['stockState'] = $bs->popUint8_t();	//<uint8_t> 锁定时的商品实际库存状态，锁定成功时的接口返回参数
		$this->_arr_value['surplusNum'] = $bs->popUint32_t();	//<uint32_t> 锁定完成后，实际剩余库存数量（普通锁定返回普通剩余库存，活动锁定返回活动剩余库存），锁定成功时的接口返回参数
		$this->_arr_value['lockNum'] = $bs->popUint32_t();	//<uint32_t> 本次完成实际锁定的数量，锁定成功时的接口返回参数
		$this->_arr_value['cooperatorProtocolId'] = $bs->popUint64_t();	//<uint64_t> 锁定商品成功后返回的结算规则ID，锁定成功时的接口返回参数
		$this->_arr_value['reserveDw'] = $bs->popUint32_t();	//<uint32_t> 保留字段dw
		$this->_arr_value['reserveStr'] = $bs->popString();	//<std::string> 保留字段str
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 版本号_u
		$this->_arr_value['stockState_u'] = $bs->popUint8_t();	//<uint8_t> 锁定时的商品实际库存状态，锁定成功时的接口返回参数_u
		$this->_arr_value['surplusNum_u'] = $bs->popUint8_t();	//<uint8_t> 实际剩余库存数量，锁定成功时的接口返回参数_u
		$this->_arr_value['lockNum_u'] = $bs->popUint8_t();	//<uint8_t> 实际锁定数量，锁定成功时的接口返回参数_u
		$this->_arr_value['cooperatorProtocolId_u'] = $bs->popUint8_t();	//<uint8_t> 锁定商品成功后返回的结算规则ID，锁定成功时的接口返回参数_u
		$this->_arr_value['reserveDw_u'] = $bs->popUint8_t();	//<uint8_t> 保留字段dw_u
		$this->_arr_value['reserveStr_u'] = $bs->popUint8_t();	//<uint8_t> 保留字段str_u

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

namespace b2b2c\skuorder\po;	//source idl: com.b2b2c.skuorder.idl.BatchLockItemReq.java
class LockItemPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $orderPo;	//<b2b2c::skuorder::po::CApiOrderPo> 订单信息(版本>=0)
	private $orderPo_u;	//<uint8_t> (版本>=0)
	private $fixupInfoPo;	//<std::vector<b2b2c::skuorder::po::CFixupInfoPo> > 商品出价信息Vector(版本>=0)
	private $fixupInfoPo_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->orderPo = new \b2b2c\skuorder\po\ApiOrderPo();	//<b2b2c::skuorder::po::CApiOrderPo>
		$this->orderPo_u = 0;	//<uint8_t>
		$this->fixupInfoPo = new \stl_vector2('\b2b2c\skuorder\po\FixupInfoPo');	//<std::vector<b2b2c::skuorder::po::CFixupInfoPo> >
		$this->fixupInfoPo_u = 0;	//<uint8_t>
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
			exit("\b2b2c\skuorder\po\LockItemPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\skuorder\po\LockItemPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushObject($this->orderPo,'\b2b2c\skuorder\po\ApiOrderPo');	//<b2b2c::skuorder::po::CApiOrderPo> 订单信息
		$bs->pushUint8_t($this->orderPo_u);	//<uint8_t> 
		$bs->pushObject($this->fixupInfoPo,'stl_vector');	//<std::vector<b2b2c::skuorder::po::CFixupInfoPo> > 商品出价信息Vector
		$bs->pushUint8_t($this->fixupInfoPo_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['orderPo'] = $bs->popObject('\b2b2c\skuorder\po\ApiOrderPo');	//<b2b2c::skuorder::po::CApiOrderPo> 订单信息
		$this->_arr_value['orderPo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['fixupInfoPo'] = $bs->popObject('stl_vector<\b2b2c\skuorder\po\FixupInfoPo>');	//<std::vector<b2b2c::skuorder::po::CFixupInfoPo> > 商品出价信息Vector
		$this->_arr_value['fixupInfoPo_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace b2b2c\skuorder\po;	//source idl: com.b2b2c.skuorder.idl.LockItemPo.java
class FixupInfoPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint8_t> 版本号 (版本>=0)
	private $skuId;	//<uint64_t> skuID，订单或购买接口传入，必填，一致(版本>=0)
	private $skuSnapVersion;	//<uint16_t> sku快照版本，订单或购买接口传入，必填，一致(版本>=0)
	private $userUin;	//<uint32_t> 用户uin，订单或购买接口传入，必填，一致(版本>=0)
	private $orderToken;	//<uint64_t> 订单token，订单或购买接口传入，必填，一致(版本>=0)
	private $orderSequence;	//<uint32_t> 订单sequence，订单或购买接口传入，必填，一致(版本>=0)
	private $stockId;	//<uint64_t> 库存ID，订单或购买接口传入，必填，一致(版本>=0)
	private $cooperatorSubAccountId;	//<uint64_t> 合作伙伴子帐号ID，订单或购买接口传入，必填，一致(版本>=0)
	private $fixupState;	//<uint64_t> 出价记录状态，不可外部传入修改(版本>=0)
	private $orderId;	//<std::string> 订单ID，订单接口传入，扣减时传入，必填，传入覆盖(版本>=0)
	private $skuTitle;	//<std::string> 商品标题，从SKU接口获取(版本>=0)
	private $orderPrice;	//<uint32_t> 商品订单价格，订单或购买接口传入，必填，传入覆盖(版本>=0)
	private $stockPrice;	//<uint32_t> 商品库存价格，从SKU接口获取(版本>=0)
	private $orderNum;	//<uint32_t> 购买数量，购买锁定和解锁时，必填，一致; 订单实扣时忽略;逐次扣减商品时的扣减商品个数(版本>=0)
	private $promoteId;	//<uint64_t> 促销活动ID，订单或购买接口传入，必填，0或非0一致(版本>=0)
	private $orderType;	//<uint8_t> 订单类型，购买接口传入，必填，定义参考b2b2c_define.h中(版本>=1)
	private $lockMode;	//<uint8_t> 锁定模式，购买接口传入，必填，定义参考b2b2c_define.h中(版本>=1)
	private $needCheckStockstate;	//<uint8_t> 锁定状态控制（需要商品检查的库存状态），购买接口传入，必填，定义参考b2b2c_define.h中(版本>=1)
	private $stockstate;	//<uint8_t> 锁定时的库存状态,发送msgq消息时所用，订单等上层业务逻辑忽略(版本>=1)
	private $cooperatorProtocolId;	//<uint64_t> 合作协议规则ID，发送msgq消息时所用，订单等上层业务逻辑忽略(版本>=1)
	private $fixupAddTime;	//<uint32_t> 价记录生成时间，不可外部传入修改(版本>=0)
	private $fixupPayTime;	//<uint32_t> 出价记录付款时间，不可外部传入修改(版本>=1)
	private $fixupLastUpdateTime;	//<uint32_t> 出价记录最后更新时间，不可外部传入修改(版本>=0)
	private $reserveDw;	//<uint32_t> 保留字段dw(版本>=0)
	private $reserveStr;	//<std::string> 保留字段str(版本>=0)
	private $version_u;	//<uint8_t> 版本号_u(版本>=0)
	private $skuId_u;	//<uint8_t> skuID_u(版本>=0)
	private $skuSnapVersion_u;	//<uint8_t> sku快照版本_u(版本>=0)
	private $userUin_u;	//<uint8_t> 用户uin_u(版本>=0)
	private $orderToken_u;	//<uint8_t> 订单token_u(版本>=0)
	private $orderSequence_u;	//<uint8_t> 订单sequence_u(版本>=0)
	private $stockId_u;	//<uint8_t> 库存ID_u(版本>=0)
	private $cooperatorSubAccountId_u;	//<uint8_t> 合作伙伴子帐号ID_u(版本>=0)
	private $fixupState_u;	//<uint8_t> 出价记录状态_u(版本>=0)
	private $orderId_u;	//<uint8_t> 订单ID_u(版本>=0)
	private $skuTitle_u;	//<uint8_t> 商品标题_u(版本>=0)
	private $orderPrice_u;	//<uint8_t> 商品订单价格_u(版本>=0)
	private $stockPrice_u;	//<uint8_t> 商品库存价格_u(版本>=0)
	private $orderNum_u;	//<uint8_t> 购买数量_u(版本>=0)
	private $promoteId_u;	//<uint8_t> 促销活动ID_u(版本>=0)
	private $orderType_u;	//<uint8_t> 订单类型_u(版本>=1)
	private $lockMode_u;	//<uint8_t> 锁定模式_u(版本>=1)
	private $needCheckStockstate_u;	//<uint8_t> 锁定状态控制（需要商品检查的库存状态）_u(版本>=1)
	private $stockstate_u;	//<uint8_t> 锁定时的库存状态,发送msgq消息时所用，订单等上层业务逻辑忽略_u(版本>=1)
	private $cooperatorProtocolId_u;	//<uint8_t> 合作协议规则ID，发送msgq消息时所用，订单等上层业务逻辑忽略_u(版本>=1)
	private $fixupAddTime_u;	//<uint8_t> 价记录生成时间_u(版本>=0)
	private $fixupPayTime_u;	//<uint8_t> 出价记录付款时间_u(版本>=1)
	private $fixupLastUpdateTime_u;	//<uint8_t> 出价记录最后更新时间_u(版本>=0)
	private $reserveDw_u;	//<uint8_t> 保留字段dw_u(版本>=0)
	private $reserveStr_u;	//<uint8_t> 保留字段str_u(版本>=0)
	private $lastSerialId;	//<uint64_t> 上次商品逐次扣减时的前次serialId(版本>=2)
	private $lastSerialId_u;	//<uint8_t> 上次商品逐次扣减时的serialId_u(版本>=2)
	private $thisSerialId;	//<uint64_t> 本次商品逐次扣减时的serialId(版本>=2)
	private $thisSerialId_u;	//<uint8_t> 本次商品逐次扣减时的serialId_u(版本>=2)
	private $queryCooperatorProtocolId;	//<uint8_t> 只查询结算id，不进行实际锁商品:1表示只差结算id， 0表示按照正常逻辑(版本>=3)
	private $queryCooperatorProtocolId_u;	//<uint8_t> queryCooperatorProtocolId ver(版本>=3)

	function __construct(){
		$this->version = 3;	//<uint8_t>
		$this->skuId = 0;	//<uint64_t>
		$this->skuSnapVersion = 0;	//<uint16_t>
		$this->userUin = 0;	//<uint32_t>
		$this->orderToken = 0;	//<uint64_t>
		$this->orderSequence = 0;	//<uint32_t>
		$this->stockId = 0;	//<uint64_t>
		$this->cooperatorSubAccountId = 0;	//<uint64_t>
		$this->fixupState = 0;	//<uint64_t>
		$this->orderId = "";	//<std::string>
		$this->skuTitle = "";	//<std::string>
		$this->orderPrice = 0;	//<uint32_t>
		$this->stockPrice = 0;	//<uint32_t>
		$this->orderNum = 0;	//<uint32_t>
		$this->promoteId = 0;	//<uint64_t>
		$this->orderType = 0;	//<uint8_t>
		$this->lockMode = 0;	//<uint8_t>
		$this->needCheckStockstate = 0;	//<uint8_t>
		$this->stockstate = 0;	//<uint8_t>
		$this->cooperatorProtocolId = 0;	//<uint64_t>
		$this->fixupAddTime = 0;	//<uint32_t>
		$this->fixupPayTime = 0;	//<uint32_t>
		$this->fixupLastUpdateTime = 0;	//<uint32_t>
		$this->reserveDw = 0;	//<uint32_t>
		$this->reserveStr = "";	//<std::string>
		$this->version_u = 2;	//<uint8_t>
		$this->skuId_u = 0;	//<uint8_t>
		$this->skuSnapVersion_u = 0;	//<uint8_t>
		$this->userUin_u = 0;	//<uint8_t>
		$this->orderToken_u = 0;	//<uint8_t>
		$this->orderSequence_u = 0;	//<uint8_t>
		$this->stockId_u = 0;	//<uint8_t>
		$this->cooperatorSubAccountId_u = 0;	//<uint8_t>
		$this->fixupState_u = 0;	//<uint8_t>
		$this->orderId_u = 0;	//<uint8_t>
		$this->skuTitle_u = 0;	//<uint8_t>
		$this->orderPrice_u = 0;	//<uint8_t>
		$this->stockPrice_u = 0;	//<uint8_t>
		$this->orderNum_u = 0;	//<uint8_t>
		$this->promoteId_u = 0;	//<uint8_t>
		$this->orderType_u = 0;	//<uint8_t>
		$this->lockMode_u = 0;	//<uint8_t>
		$this->needCheckStockstate_u = 0;	//<uint8_t>
		$this->stockstate_u = 0;	//<uint8_t>
		$this->cooperatorProtocolId_u = 0;	//<uint8_t>
		$this->fixupAddTime_u = 0;	//<uint8_t>
		$this->fixupPayTime_u = 0;	//<uint8_t>
		$this->fixupLastUpdateTime_u = 0;	//<uint8_t>
		$this->reserveDw_u = 0;	//<uint8_t>
		$this->reserveStr_u = 0;	//<uint8_t>
		$this->lastSerialId = 0;	//<uint64_t>
		$this->lastSerialId_u = 0;	//<uint8_t>
		$this->thisSerialId = 0;	//<uint64_t>
		$this->thisSerialId_u = 0;	//<uint8_t>
		$this->queryCooperatorProtocolId = 0;	//<uint8_t>
		$this->queryCooperatorProtocolId_u = 0;	//<uint8_t>
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
			exit("\b2b2c\skuorder\po\FixupInfoPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\skuorder\po\FixupInfoPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint8_t($this->version);	//<uint8_t> 版本号 
		$bs->pushUint64_t($this->skuId);	//<uint64_t> skuID，订单或购买接口传入，必填，一致
		$bs->pushUint16_t($this->skuSnapVersion);	//<uint16_t> sku快照版本，订单或购买接口传入，必填，一致
		$bs->pushUint32_t($this->userUin);	//<uint32_t> 用户uin，订单或购买接口传入，必填，一致
		$bs->pushUint64_t($this->orderToken);	//<uint64_t> 订单token，订单或购买接口传入，必填，一致
		$bs->pushUint32_t($this->orderSequence);	//<uint32_t> 订单sequence，订单或购买接口传入，必填，一致
		$bs->pushUint64_t($this->stockId);	//<uint64_t> 库存ID，订单或购买接口传入，必填，一致
		$bs->pushUint64_t($this->cooperatorSubAccountId);	//<uint64_t> 合作伙伴子帐号ID，订单或购买接口传入，必填，一致
		$bs->pushUint64_t($this->fixupState);	//<uint64_t> 出价记录状态，不可外部传入修改
		$bs->pushString($this->orderId);	//<std::string> 订单ID，订单接口传入，扣减时传入，必填，传入覆盖
		$bs->pushString($this->skuTitle);	//<std::string> 商品标题，从SKU接口获取
		$bs->pushUint32_t($this->orderPrice);	//<uint32_t> 商品订单价格，订单或购买接口传入，必填，传入覆盖
		$bs->pushUint32_t($this->stockPrice);	//<uint32_t> 商品库存价格，从SKU接口获取
		$bs->pushUint32_t($this->orderNum);	//<uint32_t> 购买数量，购买锁定和解锁时，必填，一致; 订单实扣时忽略;逐次扣减商品时的扣减商品个数
		$bs->pushUint64_t($this->promoteId);	//<uint64_t> 促销活动ID，订单或购买接口传入，必填，0或非0一致
		if($this->version >= 1){
			$bs->pushUint8_t($this->orderType);	//<uint8_t> 订单类型，购买接口传入，必填，定义参考b2b2c_define.h中
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->lockMode);	//<uint8_t> 锁定模式，购买接口传入，必填，定义参考b2b2c_define.h中
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->needCheckStockstate);	//<uint8_t> 锁定状态控制（需要商品检查的库存状态），购买接口传入，必填，定义参考b2b2c_define.h中
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->stockstate);	//<uint8_t> 锁定时的库存状态,发送msgq消息时所用，订单等上层业务逻辑忽略
		}
		if($this->version >= 1){
			$bs->pushUint64_t($this->cooperatorProtocolId);	//<uint64_t> 合作协议规则ID，发送msgq消息时所用，订单等上层业务逻辑忽略
		}
		$bs->pushUint32_t($this->fixupAddTime);	//<uint32_t> 价记录生成时间，不可外部传入修改
		if($this->version >= 1){
			$bs->pushUint32_t($this->fixupPayTime);	//<uint32_t> 出价记录付款时间，不可外部传入修改
		}
		$bs->pushUint32_t($this->fixupLastUpdateTime);	//<uint32_t> 出价记录最后更新时间，不可外部传入修改
		$bs->pushUint32_t($this->reserveDw);	//<uint32_t> 保留字段dw
		$bs->pushString($this->reserveStr);	//<std::string> 保留字段str
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 版本号_u
		$bs->pushUint8_t($this->skuId_u);	//<uint8_t> skuID_u
		$bs->pushUint8_t($this->skuSnapVersion_u);	//<uint8_t> sku快照版本_u
		$bs->pushUint8_t($this->userUin_u);	//<uint8_t> 用户uin_u
		$bs->pushUint8_t($this->orderToken_u);	//<uint8_t> 订单token_u
		$bs->pushUint8_t($this->orderSequence_u);	//<uint8_t> 订单sequence_u
		$bs->pushUint8_t($this->stockId_u);	//<uint8_t> 库存ID_u
		$bs->pushUint8_t($this->cooperatorSubAccountId_u);	//<uint8_t> 合作伙伴子帐号ID_u
		$bs->pushUint8_t($this->fixupState_u);	//<uint8_t> 出价记录状态_u
		$bs->pushUint8_t($this->orderId_u);	//<uint8_t> 订单ID_u
		$bs->pushUint8_t($this->skuTitle_u);	//<uint8_t> 商品标题_u
		$bs->pushUint8_t($this->orderPrice_u);	//<uint8_t> 商品订单价格_u
		$bs->pushUint8_t($this->stockPrice_u);	//<uint8_t> 商品库存价格_u
		$bs->pushUint8_t($this->orderNum_u);	//<uint8_t> 购买数量_u
		$bs->pushUint8_t($this->promoteId_u);	//<uint8_t> 促销活动ID_u
		if($this->version >= 1){
			$bs->pushUint8_t($this->orderType_u);	//<uint8_t> 订单类型_u
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->lockMode_u);	//<uint8_t> 锁定模式_u
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->needCheckStockstate_u);	//<uint8_t> 锁定状态控制（需要商品检查的库存状态）_u
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->stockstate_u);	//<uint8_t> 锁定时的库存状态,发送msgq消息时所用，订单等上层业务逻辑忽略_u
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->cooperatorProtocolId_u);	//<uint8_t> 合作协议规则ID，发送msgq消息时所用，订单等上层业务逻辑忽略_u
		}
		$bs->pushUint8_t($this->fixupAddTime_u);	//<uint8_t> 价记录生成时间_u
		if($this->version >= 1){
			$bs->pushUint8_t($this->fixupPayTime_u);	//<uint8_t> 出价记录付款时间_u
		}
		$bs->pushUint8_t($this->fixupLastUpdateTime_u);	//<uint8_t> 出价记录最后更新时间_u
		$bs->pushUint8_t($this->reserveDw_u);	//<uint8_t> 保留字段dw_u
		$bs->pushUint8_t($this->reserveStr_u);	//<uint8_t> 保留字段str_u
		if($this->version >= 2){
			$bs->pushUint64_t($this->lastSerialId);	//<uint64_t> 上次商品逐次扣减时的前次serialId
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->lastSerialId_u);	//<uint8_t> 上次商品逐次扣减时的serialId_u
		}
		if($this->version >= 2){
			$bs->pushUint64_t($this->thisSerialId);	//<uint64_t> 本次商品逐次扣减时的serialId
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->thisSerialId_u);	//<uint8_t> 本次商品逐次扣减时的serialId_u
		}
		if($this->version >= 3){
			$bs->pushUint8_t($this->queryCooperatorProtocolId);	//<uint8_t> 只查询结算id，不进行实际锁商品:1表示只差结算id， 0表示按照正常逻辑
		}
		if($this->version >= 3){
			$bs->pushUint8_t($this->queryCooperatorProtocolId_u);	//<uint8_t> queryCooperatorProtocolId ver
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint8_t();	//<uint8_t> 版本号 
		$this->_arr_value['skuId'] = $bs->popUint64_t();	//<uint64_t> skuID，订单或购买接口传入，必填，一致
		$this->_arr_value['skuSnapVersion'] = $bs->popUint16_t();	//<uint16_t> sku快照版本，订单或购买接口传入，必填，一致
		$this->_arr_value['userUin'] = $bs->popUint32_t();	//<uint32_t> 用户uin，订单或购买接口传入，必填，一致
		$this->_arr_value['orderToken'] = $bs->popUint64_t();	//<uint64_t> 订单token，订单或购买接口传入，必填，一致
		$this->_arr_value['orderSequence'] = $bs->popUint32_t();	//<uint32_t> 订单sequence，订单或购买接口传入，必填，一致
		$this->_arr_value['stockId'] = $bs->popUint64_t();	//<uint64_t> 库存ID，订单或购买接口传入，必填，一致
		$this->_arr_value['cooperatorSubAccountId'] = $bs->popUint64_t();	//<uint64_t> 合作伙伴子帐号ID，订单或购买接口传入，必填，一致
		$this->_arr_value['fixupState'] = $bs->popUint64_t();	//<uint64_t> 出价记录状态，不可外部传入修改
		$this->_arr_value['orderId'] = $bs->popString();	//<std::string> 订单ID，订单接口传入，扣减时传入，必填，传入覆盖
		$this->_arr_value['skuTitle'] = $bs->popString();	//<std::string> 商品标题，从SKU接口获取
		$this->_arr_value['orderPrice'] = $bs->popUint32_t();	//<uint32_t> 商品订单价格，订单或购买接口传入，必填，传入覆盖
		$this->_arr_value['stockPrice'] = $bs->popUint32_t();	//<uint32_t> 商品库存价格，从SKU接口获取
		$this->_arr_value['orderNum'] = $bs->popUint32_t();	//<uint32_t> 购买数量，购买锁定和解锁时，必填，一致; 订单实扣时忽略;逐次扣减商品时的扣减商品个数
		$this->_arr_value['promoteId'] = $bs->popUint64_t();	//<uint64_t> 促销活动ID，订单或购买接口传入，必填，0或非0一致
		if($this->version >= 1){
			$this->_arr_value['orderType'] = $bs->popUint8_t();	//<uint8_t> 订单类型，购买接口传入，必填，定义参考b2b2c_define.h中
		}
		if($this->version >= 1){
			$this->_arr_value['lockMode'] = $bs->popUint8_t();	//<uint8_t> 锁定模式，购买接口传入，必填，定义参考b2b2c_define.h中
		}
		if($this->version >= 1){
			$this->_arr_value['needCheckStockstate'] = $bs->popUint8_t();	//<uint8_t> 锁定状态控制（需要商品检查的库存状态），购买接口传入，必填，定义参考b2b2c_define.h中
		}
		if($this->version >= 1){
			$this->_arr_value['stockstate'] = $bs->popUint8_t();	//<uint8_t> 锁定时的库存状态,发送msgq消息时所用，订单等上层业务逻辑忽略
		}
		if($this->version >= 1){
			$this->_arr_value['cooperatorProtocolId'] = $bs->popUint64_t();	//<uint64_t> 合作协议规则ID，发送msgq消息时所用，订单等上层业务逻辑忽略
		}
		$this->_arr_value['fixupAddTime'] = $bs->popUint32_t();	//<uint32_t> 价记录生成时间，不可外部传入修改
		if($this->version >= 1){
			$this->_arr_value['fixupPayTime'] = $bs->popUint32_t();	//<uint32_t> 出价记录付款时间，不可外部传入修改
		}
		$this->_arr_value['fixupLastUpdateTime'] = $bs->popUint32_t();	//<uint32_t> 出价记录最后更新时间，不可外部传入修改
		$this->_arr_value['reserveDw'] = $bs->popUint32_t();	//<uint32_t> 保留字段dw
		$this->_arr_value['reserveStr'] = $bs->popString();	//<std::string> 保留字段str
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 版本号_u
		$this->_arr_value['skuId_u'] = $bs->popUint8_t();	//<uint8_t> skuID_u
		$this->_arr_value['skuSnapVersion_u'] = $bs->popUint8_t();	//<uint8_t> sku快照版本_u
		$this->_arr_value['userUin_u'] = $bs->popUint8_t();	//<uint8_t> 用户uin_u
		$this->_arr_value['orderToken_u'] = $bs->popUint8_t();	//<uint8_t> 订单token_u
		$this->_arr_value['orderSequence_u'] = $bs->popUint8_t();	//<uint8_t> 订单sequence_u
		$this->_arr_value['stockId_u'] = $bs->popUint8_t();	//<uint8_t> 库存ID_u
		$this->_arr_value['cooperatorSubAccountId_u'] = $bs->popUint8_t();	//<uint8_t> 合作伙伴子帐号ID_u
		$this->_arr_value['fixupState_u'] = $bs->popUint8_t();	//<uint8_t> 出价记录状态_u
		$this->_arr_value['orderId_u'] = $bs->popUint8_t();	//<uint8_t> 订单ID_u
		$this->_arr_value['skuTitle_u'] = $bs->popUint8_t();	//<uint8_t> 商品标题_u
		$this->_arr_value['orderPrice_u'] = $bs->popUint8_t();	//<uint8_t> 商品订单价格_u
		$this->_arr_value['stockPrice_u'] = $bs->popUint8_t();	//<uint8_t> 商品库存价格_u
		$this->_arr_value['orderNum_u'] = $bs->popUint8_t();	//<uint8_t> 购买数量_u
		$this->_arr_value['promoteId_u'] = $bs->popUint8_t();	//<uint8_t> 促销活动ID_u
		if($this->version >= 1){
			$this->_arr_value['orderType_u'] = $bs->popUint8_t();	//<uint8_t> 订单类型_u
		}
		if($this->version >= 1){
			$this->_arr_value['lockMode_u'] = $bs->popUint8_t();	//<uint8_t> 锁定模式_u
		}
		if($this->version >= 1){
			$this->_arr_value['needCheckStockstate_u'] = $bs->popUint8_t();	//<uint8_t> 锁定状态控制（需要商品检查的库存状态）_u
		}
		if($this->version >= 1){
			$this->_arr_value['stockstate_u'] = $bs->popUint8_t();	//<uint8_t> 锁定时的库存状态,发送msgq消息时所用，订单等上层业务逻辑忽略_u
		}
		if($this->version >= 1){
			$this->_arr_value['cooperatorProtocolId_u'] = $bs->popUint8_t();	//<uint8_t> 合作协议规则ID，发送msgq消息时所用，订单等上层业务逻辑忽略_u
		}
		$this->_arr_value['fixupAddTime_u'] = $bs->popUint8_t();	//<uint8_t> 价记录生成时间_u
		if($this->version >= 1){
			$this->_arr_value['fixupPayTime_u'] = $bs->popUint8_t();	//<uint8_t> 出价记录付款时间_u
		}
		$this->_arr_value['fixupLastUpdateTime_u'] = $bs->popUint8_t();	//<uint8_t> 出价记录最后更新时间_u
		$this->_arr_value['reserveDw_u'] = $bs->popUint8_t();	//<uint8_t> 保留字段dw_u
		$this->_arr_value['reserveStr_u'] = $bs->popUint8_t();	//<uint8_t> 保留字段str_u
		if($this->version >= 2){
			$this->_arr_value['lastSerialId'] = $bs->popUint64_t();	//<uint64_t> 上次商品逐次扣减时的前次serialId
		}
		if($this->version >= 2){
			$this->_arr_value['lastSerialId_u'] = $bs->popUint8_t();	//<uint8_t> 上次商品逐次扣减时的serialId_u
		}
		if($this->version >= 2){
			$this->_arr_value['thisSerialId'] = $bs->popUint64_t();	//<uint64_t> 本次商品逐次扣减时的serialId
		}
		if($this->version >= 2){
			$this->_arr_value['thisSerialId_u'] = $bs->popUint8_t();	//<uint8_t> 本次商品逐次扣减时的serialId_u
		}
		if($this->version >= 3){
			$this->_arr_value['queryCooperatorProtocolId'] = $bs->popUint8_t();	//<uint8_t> 只查询结算id，不进行实际锁商品:1表示只差结算id， 0表示按照正常逻辑
		}
		if($this->version >= 3){
			$this->_arr_value['queryCooperatorProtocolId_u'] = $bs->popUint8_t();	//<uint8_t> queryCooperatorProtocolId ver
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

namespace b2b2c\skuorder\po;	//source idl: com.b2b2c.skuorder.idl.SkuOrderAo.java
class ApiReleaseStockPo{
	private $_arr_value=array();	//数组形式的类
	private $uid;	//<uint32_t> 用户id(版本>=0)
	private $uid_u;	//<uint8_t> (版本>=0)
	private $cooperatorId;	//<uint32_t> 合作伙伴id(版本>=0)
	private $cooperatorId_u;	//<uint8_t> (版本>=0)
	private $orderId;	//<std::string> 订单id(版本>=0)
	private $orderId_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->uid = 0;	//<uint32_t>
		$this->uid_u = 0;	//<uint8_t>
		$this->cooperatorId = 0;	//<uint32_t>
		$this->cooperatorId_u = 0;	//<uint8_t>
		$this->orderId = "";	//<std::string>
		$this->orderId_u = 0;	//<uint8_t>
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
			exit("\b2b2c\skuorder\po\ApiReleaseStockPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\skuorder\po\ApiReleaseStockPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->uid);	//<uint32_t> 用户id
		$bs->pushUint8_t($this->uid_u);	//<uint8_t> 
		$bs->pushUint32_t($this->cooperatorId);	//<uint32_t> 合作伙伴id
		$bs->pushUint8_t($this->cooperatorId_u);	//<uint8_t> 
		$bs->pushString($this->orderId);	//<std::string> 订单id
		$bs->pushUint8_t($this->orderId_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['uid'] = $bs->popUint32_t();	//<uint32_t> 用户id
		$this->_arr_value['uid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cooperatorId'] = $bs->popUint32_t();	//<uint32_t> 合作伙伴id
		$this->_arr_value['cooperatorId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['orderId'] = $bs->popString();	//<std::string> 订单id
		$this->_arr_value['orderId_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace b2b2c\skuorder\po;	//source idl: com.b2b2c.skuorder.idl.SkuOrderAo.java
class ApiOrderPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $uid;	//<uint32_t> 用户id(版本>=0)
	private $uid_u;	//<uint8_t> (版本>=0)
	private $cooperatorId;	//<uint32_t> 合作伙伴id(版本>=0)
	private $cooperatorId_u;	//<uint8_t> (版本>=0)
	private $sequenceId;	//<std::string> 网购下单序列号(版本>=0)
	private $sequenceId_u;	//<uint8_t> (版本>=0)
	private $receiver;	//<std::string> 收件人姓名(版本>=0)
	private $receiver_u;	//<uint8_t> (版本>=0)
	private $receiveAddrId;	//<uint32_t> 收件地址id(版本>=0)
	private $receiveAddrId_u;	//<uint8_t> (版本>=0)
	private $receiveAddrDetail;	//<std::string> 收件详细地址(版本>=0)
	private $receiveAddrDetail_u;	//<uint8_t> (版本>=0)
	private $receiverTel;	//<std::string> 收件人电话(版本>=0)
	private $receiverTel_u;	//<uint8_t> (版本>=0)
	private $receiverMobile;	//<std::string> 收件人移动电话(版本>=0)
	private $receiverMobile_u;	//<uint8_t> (版本>=0)
	private $zipCode;	//<uint32_t> 邮政编码，EMS必须要填(版本>=0)
	private $zipCode_u;	//<uint8_t> (版本>=0)
	private $paymentTypeId;	//<uint32_t> 支付类型(版本>=0)
	private $paymentTypeId_u;	//<uint8_t> (版本>=0)
	private $invoiceTitle;	//<std::string> 发票抬头(版本>=0)
	private $invoiceTitle_u;	//<uint8_t> (版本>=0)
	private $packageList;	//<std::vector<b2b2c::skuorder::po::CApiPackagePo> > 包裹列表  (版本>=0)
	private $packageList_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->uid = 0;	//<uint32_t>
		$this->uid_u = 0;	//<uint8_t>
		$this->cooperatorId = 0;	//<uint32_t>
		$this->cooperatorId_u = 0;	//<uint8_t>
		$this->sequenceId = "";	//<std::string>
		$this->sequenceId_u = 0;	//<uint8_t>
		$this->receiver = "";	//<std::string>
		$this->receiver_u = 0;	//<uint8_t>
		$this->receiveAddrId = 0;	//<uint32_t>
		$this->receiveAddrId_u = 0;	//<uint8_t>
		$this->receiveAddrDetail = "";	//<std::string>
		$this->receiveAddrDetail_u = 0;	//<uint8_t>
		$this->receiverTel = "";	//<std::string>
		$this->receiverTel_u = 0;	//<uint8_t>
		$this->receiverMobile = "";	//<std::string>
		$this->receiverMobile_u = 0;	//<uint8_t>
		$this->zipCode = 0;	//<uint32_t>
		$this->zipCode_u = 0;	//<uint8_t>
		$this->paymentTypeId = 0;	//<uint32_t>
		$this->paymentTypeId_u = 0;	//<uint8_t>
		$this->invoiceTitle = "";	//<std::string>
		$this->invoiceTitle_u = 0;	//<uint8_t>
		$this->packageList = new \stl_vector2('\b2b2c\skuorder\po\ApiPackagePo');	//<std::vector<b2b2c::skuorder::po::CApiPackagePo> >
		$this->packageList_u = 0;	//<uint8_t>
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
			exit("\b2b2c\skuorder\po\ApiOrderPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\skuorder\po\ApiOrderPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->uid);	//<uint32_t> 用户id
		$bs->pushUint8_t($this->uid_u);	//<uint8_t> 
		$bs->pushUint32_t($this->cooperatorId);	//<uint32_t> 合作伙伴id
		$bs->pushUint8_t($this->cooperatorId_u);	//<uint8_t> 
		$bs->pushString($this->sequenceId);	//<std::string> 网购下单序列号
		$bs->pushUint8_t($this->sequenceId_u);	//<uint8_t> 
		$bs->pushString($this->receiver);	//<std::string> 收件人姓名
		$bs->pushUint8_t($this->receiver_u);	//<uint8_t> 
		$bs->pushUint32_t($this->receiveAddrId);	//<uint32_t> 收件地址id
		$bs->pushUint8_t($this->receiveAddrId_u);	//<uint8_t> 
		$bs->pushString($this->receiveAddrDetail);	//<std::string> 收件详细地址
		$bs->pushUint8_t($this->receiveAddrDetail_u);	//<uint8_t> 
		$bs->pushString($this->receiverTel);	//<std::string> 收件人电话
		$bs->pushUint8_t($this->receiverTel_u);	//<uint8_t> 
		$bs->pushString($this->receiverMobile);	//<std::string> 收件人移动电话
		$bs->pushUint8_t($this->receiverMobile_u);	//<uint8_t> 
		$bs->pushUint32_t($this->zipCode);	//<uint32_t> 邮政编码，EMS必须要填
		$bs->pushUint8_t($this->zipCode_u);	//<uint8_t> 
		$bs->pushUint32_t($this->paymentTypeId);	//<uint32_t> 支付类型
		$bs->pushUint8_t($this->paymentTypeId_u);	//<uint8_t> 
		$bs->pushString($this->invoiceTitle);	//<std::string> 发票抬头
		$bs->pushUint8_t($this->invoiceTitle_u);	//<uint8_t> 
		$bs->pushObject($this->packageList,'stl_vector');	//<std::vector<b2b2c::skuorder::po::CApiPackagePo> > 包裹列表  
		$bs->pushUint8_t($this->packageList_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['uid'] = $bs->popUint32_t();	//<uint32_t> 用户id
		$this->_arr_value['uid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cooperatorId'] = $bs->popUint32_t();	//<uint32_t> 合作伙伴id
		$this->_arr_value['cooperatorId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sequenceId'] = $bs->popString();	//<std::string> 网购下单序列号
		$this->_arr_value['sequenceId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['receiver'] = $bs->popString();	//<std::string> 收件人姓名
		$this->_arr_value['receiver_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['receiveAddrId'] = $bs->popUint32_t();	//<uint32_t> 收件地址id
		$this->_arr_value['receiveAddrId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['receiveAddrDetail'] = $bs->popString();	//<std::string> 收件详细地址
		$this->_arr_value['receiveAddrDetail_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['receiverTel'] = $bs->popString();	//<std::string> 收件人电话
		$this->_arr_value['receiverTel_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['receiverMobile'] = $bs->popString();	//<std::string> 收件人移动电话
		$this->_arr_value['receiverMobile_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['zipCode'] = $bs->popUint32_t();	//<uint32_t> 邮政编码，EMS必须要填
		$this->_arr_value['zipCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['paymentTypeId'] = $bs->popUint32_t();	//<uint32_t> 支付类型
		$this->_arr_value['paymentTypeId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['invoiceTitle'] = $bs->popString();	//<std::string> 发票抬头
		$this->_arr_value['invoiceTitle_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['packageList'] = $bs->popObject('stl_vector<\b2b2c\skuorder\po\ApiPackagePo>');	//<std::vector<b2b2c::skuorder::po::CApiPackagePo> > 包裹列表  
		$this->_arr_value['packageList_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace b2b2c\skuorder\po;	//source idl: com.b2b2c.skuorder.idl.ApiOrderPo.java
class ApiPackagePo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $orderId;	//<std::string> 易迅订单id,输出(版本>=0)
	private $orderId_u;	//<uint8_t> (版本>=0)
	private $skuList;	//<std::vector<b2b2c::skuorder::po::CApiSkuInfoPo> > sku列表  (版本>=0)
	private $skuList_u;	//<uint8_t> (版本>=0)
	private $storehouseId;	//<uint32_t> 逻辑仓id	(版本>=0)
	private $storehouseId_u;	//<uint8_t> (版本>=0)
	private $realStorehouseId;	//<uint32_t> 物理仓id,用于分单的输出，下单的输入(版本>=0)
	private $realStorehouseId_u;	//<uint8_t> (版本>=0)
	private $price;	//<uint32_t> 包裹总价（分单总价）	(版本>=0)
	private $price_u;	//<uint8_t> (版本>=0)
	private $deliveryTypeId;	//<uint32_t> 配送方式id(版本>=0)
	private $deliveryTypeId_u;	//<uint8_t> (版本>=0)
	private $deliveryPrice;	//<uint32_t> 包裹运费价格（分单运费价格）(版本>=0)
	private $deliveryPrice_u;	//<uint8_t> (版本>=0)
	private $expectDate;	//<std::string> 期望送达时间(版本>=0)
	private $expectDate_u;	//<uint8_t> (版本>=0)
	private $expectSpan;	//<uint32_t> 期望送达时间段(版本>=0)
	private $expectSpan_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->orderId = "";	//<std::string>
		$this->orderId_u = 0;	//<uint8_t>
		$this->skuList = new \stl_vector2('\b2b2c\skuorder\po\ApiSkuInfoPo');	//<std::vector<b2b2c::skuorder::po::CApiSkuInfoPo> >
		$this->skuList_u = 0;	//<uint8_t>
		$this->storehouseId = 0;	//<uint32_t>
		$this->storehouseId_u = 0;	//<uint8_t>
		$this->realStorehouseId = 0;	//<uint32_t>
		$this->realStorehouseId_u = 0;	//<uint8_t>
		$this->price = 0;	//<uint32_t>
		$this->price_u = 0;	//<uint8_t>
		$this->deliveryTypeId = 0;	//<uint32_t>
		$this->deliveryTypeId_u = 0;	//<uint8_t>
		$this->deliveryPrice = 0;	//<uint32_t>
		$this->deliveryPrice_u = 0;	//<uint8_t>
		$this->expectDate = "";	//<std::string>
		$this->expectDate_u = 0;	//<uint8_t>
		$this->expectSpan = 0;	//<uint32_t>
		$this->expectSpan_u = 0;	//<uint8_t>
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
			exit("\b2b2c\skuorder\po\ApiPackagePo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\skuorder\po\ApiPackagePo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushString($this->orderId);	//<std::string> 易迅订单id,输出
		$bs->pushUint8_t($this->orderId_u);	//<uint8_t> 
		$bs->pushObject($this->skuList,'stl_vector');	//<std::vector<b2b2c::skuorder::po::CApiSkuInfoPo> > sku列表  
		$bs->pushUint8_t($this->skuList_u);	//<uint8_t> 
		$bs->pushUint32_t($this->storehouseId);	//<uint32_t> 逻辑仓id	
		$bs->pushUint8_t($this->storehouseId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->realStorehouseId);	//<uint32_t> 物理仓id,用于分单的输出，下单的输入
		$bs->pushUint8_t($this->realStorehouseId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->price);	//<uint32_t> 包裹总价（分单总价）	
		$bs->pushUint8_t($this->price_u);	//<uint8_t> 
		$bs->pushUint32_t($this->deliveryTypeId);	//<uint32_t> 配送方式id
		$bs->pushUint8_t($this->deliveryTypeId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->deliveryPrice);	//<uint32_t> 包裹运费价格（分单运费价格）
		$bs->pushUint8_t($this->deliveryPrice_u);	//<uint8_t> 
		$bs->pushString($this->expectDate);	//<std::string> 期望送达时间
		$bs->pushUint8_t($this->expectDate_u);	//<uint8_t> 
		$bs->pushUint32_t($this->expectSpan);	//<uint32_t> 期望送达时间段
		$bs->pushUint8_t($this->expectSpan_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['orderId'] = $bs->popString();	//<std::string> 易迅订单id,输出
		$this->_arr_value['orderId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuList'] = $bs->popObject('stl_vector<\b2b2c\skuorder\po\ApiSkuInfoPo>');	//<std::vector<b2b2c::skuorder::po::CApiSkuInfoPo> > sku列表  
		$this->_arr_value['skuList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['storehouseId'] = $bs->popUint32_t();	//<uint32_t> 逻辑仓id	
		$this->_arr_value['storehouseId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['realStorehouseId'] = $bs->popUint32_t();	//<uint32_t> 物理仓id,用于分单的输出，下单的输入
		$this->_arr_value['realStorehouseId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['price'] = $bs->popUint32_t();	//<uint32_t> 包裹总价（分单总价）	
		$this->_arr_value['price_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['deliveryTypeId'] = $bs->popUint32_t();	//<uint32_t> 配送方式id
		$this->_arr_value['deliveryTypeId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['deliveryPrice'] = $bs->popUint32_t();	//<uint32_t> 包裹运费价格（分单运费价格）
		$this->_arr_value['deliveryPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['expectDate'] = $bs->popString();	//<std::string> 期望送达时间
		$this->_arr_value['expectDate_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['expectSpan'] = $bs->popUint32_t();	//<uint32_t> 期望送达时间段
		$this->_arr_value['expectSpan_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace b2b2c\skuorder\po;	//source idl: com.b2b2c.skuorder.idl.ApiPackagePo.java
class ApiSkuInfoPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $skuId;	//<uint64_t> SKU ID(版本>=0)
	private $skuId_u;	//<uint8_t> (版本>=0)
	private $storehouseId;	//<uint32_t> 平台逻辑仓id(版本>=0)
	private $storehouseId_u;	//<uint8_t> (版本>=0)
	private $stockCount;	//<uint32_t> 商品实际可扣库存数，只是查询接口用到(版本>=0)
	private $stockCount_u;	//<uint8_t> (版本>=0)
	private $productId;	//<std::string> 易迅商品id(版本>=0)
	private $productId_u;	//<uint8_t> (版本>=0)
	private $num;	//<uint32_t> 购买商品数量，分单和锁定接口用到(版本>=0)
	private $num_u;	//<uint8_t> (版本>=0)
	private $price;	//<uint32_t> 商品在发货仓的价格'分'。，分单和锁定接口用到(版本>=0)
	private $price_u;	//<uint8_t> (版本>=0)
	private $giftList;	//<std::vector<b2b2c::skuorder::po::CApiGiftPo> > sku列表  ，锁定接口用到(版本>=0)
	private $giftList_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->skuId = 0;	//<uint64_t>
		$this->skuId_u = 0;	//<uint8_t>
		$this->storehouseId = 0;	//<uint32_t>
		$this->storehouseId_u = 0;	//<uint8_t>
		$this->stockCount = 0;	//<uint32_t>
		$this->stockCount_u = 0;	//<uint8_t>
		$this->productId = "";	//<std::string>
		$this->productId_u = 0;	//<uint8_t>
		$this->num = 0;	//<uint32_t>
		$this->num_u = 0;	//<uint8_t>
		$this->price = 0;	//<uint32_t>
		$this->price_u = 0;	//<uint8_t>
		$this->giftList = new \stl_vector2('\b2b2c\skuorder\po\ApiGiftPo');	//<std::vector<b2b2c::skuorder::po::CApiGiftPo> >
		$this->giftList_u = 0;	//<uint8_t>
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
			exit("\b2b2c\skuorder\po\ApiSkuInfoPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\skuorder\po\ApiSkuInfoPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint64_t($this->skuId);	//<uint64_t> SKU ID
		$bs->pushUint8_t($this->skuId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->storehouseId);	//<uint32_t> 平台逻辑仓id
		$bs->pushUint8_t($this->storehouseId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->stockCount);	//<uint32_t> 商品实际可扣库存数，只是查询接口用到
		$bs->pushUint8_t($this->stockCount_u);	//<uint8_t> 
		$bs->pushString($this->productId);	//<std::string> 易迅商品id
		$bs->pushUint8_t($this->productId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->num);	//<uint32_t> 购买商品数量，分单和锁定接口用到
		$bs->pushUint8_t($this->num_u);	//<uint8_t> 
		$bs->pushUint32_t($this->price);	//<uint32_t> 商品在发货仓的价格'分'。，分单和锁定接口用到
		$bs->pushUint8_t($this->price_u);	//<uint8_t> 
		$bs->pushObject($this->giftList,'stl_vector');	//<std::vector<b2b2c::skuorder::po::CApiGiftPo> > sku列表  ，锁定接口用到
		$bs->pushUint8_t($this->giftList_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuId'] = $bs->popUint64_t();	//<uint64_t> SKU ID
		$this->_arr_value['skuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['storehouseId'] = $bs->popUint32_t();	//<uint32_t> 平台逻辑仓id
		$this->_arr_value['storehouseId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockCount'] = $bs->popUint32_t();	//<uint32_t> 商品实际可扣库存数，只是查询接口用到
		$this->_arr_value['stockCount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productId'] = $bs->popString();	//<std::string> 易迅商品id
		$this->_arr_value['productId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['num'] = $bs->popUint32_t();	//<uint32_t> 购买商品数量，分单和锁定接口用到
		$this->_arr_value['num_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['price'] = $bs->popUint32_t();	//<uint32_t> 商品在发货仓的价格'分'。，分单和锁定接口用到
		$this->_arr_value['price_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['giftList'] = $bs->popObject('stl_vector<\b2b2c\skuorder\po\ApiGiftPo>');	//<std::vector<b2b2c::skuorder::po::CApiGiftPo> > sku列表  ，锁定接口用到
		$this->_arr_value['giftList_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace b2b2c\skuorder\po;	//source idl: com.b2b2c.skuorder.idl.SkuOrderAo.java
class ApiGiftPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $skuId;	//<uint64_t> 赠品skuid(版本>=0)
	private $skuId_u;	//<uint8_t> (版本>=0)
	private $productId;	//<std::string> 赠品商品id(版本>=0)
	private $productId_u;	//<uint8_t> (版本>=0)
	private $num;	//<uint32_t> 赠品数量	(版本>=0)
	private $num_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->skuId = 0;	//<uint64_t>
		$this->skuId_u = 0;	//<uint8_t>
		$this->productId = "";	//<std::string>
		$this->productId_u = 0;	//<uint8_t>
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
			exit("\b2b2c\skuorder\po\ApiGiftPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\skuorder\po\ApiGiftPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint64_t($this->skuId);	//<uint64_t> 赠品skuid
		$bs->pushUint8_t($this->skuId_u);	//<uint8_t> 
		$bs->pushString($this->productId);	//<std::string> 赠品商品id
		$bs->pushUint8_t($this->productId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->num);	//<uint32_t> 赠品数量	
		$bs->pushUint8_t($this->num_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuId'] = $bs->popUint64_t();	//<uint64_t> 赠品skuid
		$this->_arr_value['skuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productId'] = $bs->popString();	//<std::string> 赠品商品id
		$this->_arr_value['productId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['num'] = $bs->popUint32_t();	//<uint32_t> 赠品数量	
		$this->_arr_value['num_u'] = $bs->popUint8_t();	//<uint8_t> 

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
