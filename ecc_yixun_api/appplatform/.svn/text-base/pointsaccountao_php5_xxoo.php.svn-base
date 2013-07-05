<?php
namespace b2b2c\account\po;	//source idl: com.b2b2c.account.idl.PointsDeliverReq.java
class PointsInPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号 (版本>=0)
	private $icsonUid;	//<uint64_t> 易迅id, 暂支持32位(版本>=0)
	private $type;	//<uint32_t> 积分明细类型(场景)(版本>=0)
	private $promotionPoints;	//<uint32_t> 促销积分(版本>=0)
	private $cashPoints;	//<uint32_t> 现金积分(账户余额)(版本>=0)
	private $property;	//<uint32_t> 积分属性，保留(版本>=0)
	private $addtime;	//<uint32_t> 积分发放时间(版本>=0)
	private $remarks;	//<std::string> 明细备注(版本>=0)
	private $reserve;	//<std::string> 切换服务之前双写时，该字段填易迅网站生成的流水id，其他保留(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $icsonUid_u;	//<uint8_t> (版本>=0)
	private $type_u;	//<uint8_t> (版本>=0)
	private $promotionPoints_u;	//<uint8_t> (版本>=0)
	private $cashPoints_u;	//<uint8_t> (版本>=0)
	private $property_u;	//<uint8_t> (版本>=0)
	private $addtime_u;	//<uint8_t> (版本>=0)
	private $remarks_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)
	private $dealId;	//<std::string> 订单号: 订单扣减后由于取消订单等原因补偿发放已被扣减的积分时，需填对应的扣减的订单号, 其他不填(版本>=20130401)
	private $dealId_u;	//<uint8_t> (版本>=20130401)

	function __construct(){
		$this->version = 20130401;	//<uint32_t>
		$this->icsonUid = 0;	//<uint64_t>
		$this->type = 0;	//<uint32_t>
		$this->promotionPoints = 0;	//<uint32_t>
		$this->cashPoints = 0;	//<uint32_t>
		$this->property = 0;	//<uint32_t>
		$this->addtime = 0;	//<uint32_t>
		$this->remarks = "";	//<std::string>
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->icsonUid_u = 0;	//<uint8_t>
		$this->type_u = 0;	//<uint8_t>
		$this->promotionPoints_u = 0;	//<uint8_t>
		$this->cashPoints_u = 0;	//<uint8_t>
		$this->property_u = 0;	//<uint8_t>
		$this->addtime_u = 0;	//<uint8_t>
		$this->remarks_u = 0;	//<uint8_t>
		$this->reserve_u = 0;	//<uint8_t>
		$this->dealId = "";	//<std::string>
		$this->dealId_u = 0;	//<uint8_t>
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
			exit("\b2b2c\account\po\PointsInPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\account\po\PointsInPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅id, 暂支持32位
		$bs->pushUint32_t($this->type);	//<uint32_t> 积分明细类型(场景)
		$bs->pushUint32_t($this->promotionPoints);	//<uint32_t> 促销积分
		$bs->pushUint32_t($this->cashPoints);	//<uint32_t> 现金积分(账户余额)
		$bs->pushUint32_t($this->property);	//<uint32_t> 积分属性，保留
		$bs->pushUint32_t($this->addtime);	//<uint32_t> 积分发放时间
		$bs->pushString($this->remarks);	//<std::string> 明细备注
		$bs->pushString($this->reserve);	//<std::string> 切换服务之前双写时，该字段填易迅网站生成的流水id，其他保留
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonUid_u);	//<uint8_t> 
		$bs->pushUint8_t($this->type_u);	//<uint8_t> 
		$bs->pushUint8_t($this->promotionPoints_u);	//<uint8_t> 
		$bs->pushUint8_t($this->cashPoints_u);	//<uint8_t> 
		$bs->pushUint8_t($this->property_u);	//<uint8_t> 
		$bs->pushUint8_t($this->addtime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->remarks_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
		if($this->version >= 20130401){
			$bs->pushString($this->dealId);	//<std::string> 订单号: 订单扣减后由于取消订单等原因补偿发放已被扣减的积分时，需填对应的扣减的订单号, 其他不填
		}
		if($this->version >= 20130401){
			$bs->pushUint8_t($this->dealId_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号 
		$this->_arr_value['icsonUid'] = $bs->popUint64_t();	//<uint64_t> 易迅id, 暂支持32位
		$this->_arr_value['type'] = $bs->popUint32_t();	//<uint32_t> 积分明细类型(场景)
		$this->_arr_value['promotionPoints'] = $bs->popUint32_t();	//<uint32_t> 促销积分
		$this->_arr_value['cashPoints'] = $bs->popUint32_t();	//<uint32_t> 现金积分(账户余额)
		$this->_arr_value['property'] = $bs->popUint32_t();	//<uint32_t> 积分属性，保留
		$this->_arr_value['addtime'] = $bs->popUint32_t();	//<uint32_t> 积分发放时间
		$this->_arr_value['remarks'] = $bs->popString();	//<std::string> 明细备注
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 切换服务之前双写时，该字段填易迅网站生成的流水id，其他保留
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonUid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['type_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['promotionPoints_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cashPoints_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['property_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['addtime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['remarks_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserve_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 20130401){
			$this->_arr_value['dealId'] = $bs->popString();	//<std::string> 订单号: 订单扣减后由于取消订单等原因补偿发放已被扣减的积分时，需填对应的扣减的订单号, 其他不填
		}
		if($this->version >= 20130401){
			$this->_arr_value['dealId_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace b2b2c\account\po;	//source idl: com.b2b2c.account.idl.PointsDeductV2Resp.java
class PointsOutRespPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号 (版本>=0)
	private $promotionPoints;	//<uint32_t> 扣减促销积分值(版本>=0)
	private $cashPoints;	//<uint32_t> 扣减现金积分值(版本>=0)
	private $reserve;	//<std::string> 保留字段(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $promotionPoints_u;	//<uint8_t> (版本>=0)
	private $cashPoints_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->promotionPoints = 0;	//<uint32_t>
		$this->cashPoints = 0;	//<uint32_t>
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->promotionPoints_u = 0;	//<uint8_t>
		$this->cashPoints_u = 0;	//<uint8_t>
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
			exit("\b2b2c\account\po\PointsOutRespPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\account\po\PointsOutRespPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->promotionPoints);	//<uint32_t> 扣减促销积分值
		$bs->pushUint32_t($this->cashPoints);	//<uint32_t> 扣减现金积分值
		$bs->pushString($this->reserve);	//<std::string> 保留字段
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->promotionPoints_u);	//<uint8_t> 
		$bs->pushUint8_t($this->cashPoints_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号 
		$this->_arr_value['promotionPoints'] = $bs->popUint32_t();	//<uint32_t> 扣减促销积分值
		$this->_arr_value['cashPoints'] = $bs->popUint32_t();	//<uint32_t> 扣减现金积分值
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 保留字段
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['promotionPoints_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cashPoints_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace b2b2c\account\po;	//source idl: com.b2b2c.account.idl.PointsDeductV2Req.java
class PointsOutReqPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号 (版本>=0)
	private $icsonUid;	//<uint64_t> 易迅id, 暂支持32位(版本>=0)
	private $promotionPoints;	//<uint32_t> 促销积分总值(版本>=0)
	private $cashPoints;	//<uint32_t> 现金积分总值(版本>=0)
	private $type;	//<uint32_t> 积分明细类型(场景)(版本>=0)
	private $property;	//<uint32_t> 积分属性，保留(版本>=0)
	private $remarks;	//<std::string> 明细备注(版本>=0)
	private $dealId;	//<std::string> 订单号:下单原因扣减时，订单号必填, 其他不填(版本>=0)
	private $reserve;	//<std::string> 切换服务之前双写时，该字段填易迅网站生成的流水id， 其他保留(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $icsonUid_u;	//<uint8_t> (版本>=0)
	private $promotionPoints_u;	//<uint8_t> (版本>=0)
	private $cashPoints_u;	//<uint8_t> (版本>=0)
	private $type_u;	//<uint8_t> (版本>=0)
	private $property_u;	//<uint8_t> (版本>=0)
	private $remarks_u;	//<uint8_t> (版本>=0)
	private $dealId_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->icsonUid = 0;	//<uint64_t>
		$this->promotionPoints = 0;	//<uint32_t>
		$this->cashPoints = 0;	//<uint32_t>
		$this->type = 0;	//<uint32_t>
		$this->property = 0;	//<uint32_t>
		$this->remarks = "";	//<std::string>
		$this->dealId = "";	//<std::string>
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->icsonUid_u = 0;	//<uint8_t>
		$this->promotionPoints_u = 0;	//<uint8_t>
		$this->cashPoints_u = 0;	//<uint8_t>
		$this->type_u = 0;	//<uint8_t>
		$this->property_u = 0;	//<uint8_t>
		$this->remarks_u = 0;	//<uint8_t>
		$this->dealId_u = 0;	//<uint8_t>
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
			exit("\b2b2c\account\po\PointsOutReqPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\account\po\PointsOutReqPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅id, 暂支持32位
		$bs->pushUint32_t($this->promotionPoints);	//<uint32_t> 促销积分总值
		$bs->pushUint32_t($this->cashPoints);	//<uint32_t> 现金积分总值
		$bs->pushUint32_t($this->type);	//<uint32_t> 积分明细类型(场景)
		$bs->pushUint32_t($this->property);	//<uint32_t> 积分属性，保留
		$bs->pushString($this->remarks);	//<std::string> 明细备注
		$bs->pushString($this->dealId);	//<std::string> 订单号:下单原因扣减时，订单号必填, 其他不填
		$bs->pushString($this->reserve);	//<std::string> 切换服务之前双写时，该字段填易迅网站生成的流水id， 其他保留
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonUid_u);	//<uint8_t> 
		$bs->pushUint8_t($this->promotionPoints_u);	//<uint8_t> 
		$bs->pushUint8_t($this->cashPoints_u);	//<uint8_t> 
		$bs->pushUint8_t($this->type_u);	//<uint8_t> 
		$bs->pushUint8_t($this->property_u);	//<uint8_t> 
		$bs->pushUint8_t($this->remarks_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号 
		$this->_arr_value['icsonUid'] = $bs->popUint64_t();	//<uint64_t> 易迅id, 暂支持32位
		$this->_arr_value['promotionPoints'] = $bs->popUint32_t();	//<uint32_t> 促销积分总值
		$this->_arr_value['cashPoints'] = $bs->popUint32_t();	//<uint32_t> 现金积分总值
		$this->_arr_value['type'] = $bs->popUint32_t();	//<uint32_t> 积分明细类型(场景)
		$this->_arr_value['property'] = $bs->popUint32_t();	//<uint32_t> 积分属性，保留
		$this->_arr_value['remarks'] = $bs->popString();	//<std::string> 明细备注
		$this->_arr_value['dealId'] = $bs->popString();	//<std::string> 订单号:下单原因扣减时，订单号必填, 其他不填
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 切换服务之前双写时，该字段填易迅网站生成的流水id， 其他保留
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonUid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['promotionPoints_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cashPoints_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['type_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['property_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['remarks_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace b2b2c\account\po;	//source idl: com.b2b2c.account.idl.PointsDeductReq.java
class PointsOutPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号 (版本>=0)
	private $icsonUid;	//<uint64_t> 易迅id, 暂支持32位(版本>=0)
	private $points;	//<uint32_t> 扣减积分值(版本>=0)
	private $type;	//<uint32_t> 积分明细类型(场景)(版本>=0)
	private $property;	//<uint32_t> 积分属性，保留(版本>=0)
	private $remarks;	//<std::string> 明细备注(版本>=0)
	private $reserve;	//<std::string> 切换服务之前双写时，该字段填易迅网站生成的流水id， 其他保留(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $icsonUid_u;	//<uint8_t> (版本>=0)
	private $points_u;	//<uint8_t> (版本>=0)
	private $type_u;	//<uint8_t> (版本>=0)
	private $property_u;	//<uint8_t> (版本>=0)
	private $remarks_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->icsonUid = 0;	//<uint64_t>
		$this->points = 0;	//<uint32_t>
		$this->type = 0;	//<uint32_t>
		$this->property = 0;	//<uint32_t>
		$this->remarks = "";	//<std::string>
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->icsonUid_u = 0;	//<uint8_t>
		$this->points_u = 0;	//<uint8_t>
		$this->type_u = 0;	//<uint8_t>
		$this->property_u = 0;	//<uint8_t>
		$this->remarks_u = 0;	//<uint8_t>
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
			exit("\b2b2c\account\po\PointsOutPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\account\po\PointsOutPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅id, 暂支持32位
		$bs->pushUint32_t($this->points);	//<uint32_t> 扣减积分值
		$bs->pushUint32_t($this->type);	//<uint32_t> 积分明细类型(场景)
		$bs->pushUint32_t($this->property);	//<uint32_t> 积分属性，保留
		$bs->pushString($this->remarks);	//<std::string> 明细备注
		$bs->pushString($this->reserve);	//<std::string> 切换服务之前双写时，该字段填易迅网站生成的流水id， 其他保留
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonUid_u);	//<uint8_t> 
		$bs->pushUint8_t($this->points_u);	//<uint8_t> 
		$bs->pushUint8_t($this->type_u);	//<uint8_t> 
		$bs->pushUint8_t($this->property_u);	//<uint8_t> 
		$bs->pushUint8_t($this->remarks_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号 
		$this->_arr_value['icsonUid'] = $bs->popUint64_t();	//<uint64_t> 易迅id, 暂支持32位
		$this->_arr_value['points'] = $bs->popUint32_t();	//<uint32_t> 扣减积分值
		$this->_arr_value['type'] = $bs->popUint32_t();	//<uint32_t> 积分明细类型(场景)
		$this->_arr_value['property'] = $bs->popUint32_t();	//<uint32_t> 积分属性，保留
		$this->_arr_value['remarks'] = $bs->popString();	//<std::string> 明细备注
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 切换服务之前双写时，该字段填易迅网站生成的流水id， 其他保留
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonUid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['points_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['type_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['property_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['remarks_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace b2b2c\account\po;	//source idl: com.b2b2c.account.idl.PointsAccountAo.java
class PointsAccessVerifyPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号 (版本>=0)
	private $accessBussinessID;	//<uint32_t> 账户的接入业务ID， 向积分后台开发人员申请(版本>=0)
	private $operatorName;	//<std::string> 操作者名,业务方控制，可用于后台查询入账的操作人员  (版本>=0)
	private $operateVerifyCode;	//<std::string> 操作校验码，接口安全考虑 ， 向积分后台开发人员申请(版本>=0)
	private $reserve;	//<std::string> reserve  预留字段，无用  (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $accessBussinessID_u;	//<uint8_t> (版本>=0)
	private $operatorName_u;	//<uint8_t> (版本>=0)
	private $operateVerifyCode_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->accessBussinessID = 0;	//<uint32_t>
		$this->operatorName = "";	//<std::string>
		$this->operateVerifyCode = "";	//<std::string>
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->accessBussinessID_u = 0;	//<uint8_t>
		$this->operatorName_u = 0;	//<uint8_t>
		$this->operateVerifyCode_u = 0;	//<uint8_t>
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
			exit("\b2b2c\account\po\PointsAccessVerifyPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\account\po\PointsAccessVerifyPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->accessBussinessID);	//<uint32_t> 账户的接入业务ID， 向积分后台开发人员申请
		$bs->pushString($this->operatorName);	//<std::string> 操作者名,业务方控制，可用于后台查询入账的操作人员  
		$bs->pushString($this->operateVerifyCode);	//<std::string> 操作校验码，接口安全考虑 ， 向积分后台开发人员申请
		$bs->pushString($this->reserve);	//<std::string> reserve  预留字段，无用  
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->accessBussinessID_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operatorName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->operateVerifyCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号 
		$this->_arr_value['accessBussinessID'] = $bs->popUint32_t();	//<uint32_t> 账户的接入业务ID， 向积分后台开发人员申请
		$this->_arr_value['operatorName'] = $bs->popString();	//<std::string> 操作者名,业务方控制，可用于后台查询入账的操作人员  
		$this->_arr_value['operateVerifyCode'] = $bs->popString();	//<std::string> 操作校验码，接口安全考虑 ， 向积分后台开发人员申请
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> reserve  预留字段，无用  
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['accessBussinessID_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operatorName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['operateVerifyCode_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace b2b2c\account\po;	//source idl: com.b2b2c.account.idl.GetPointsAccountDetailResp.java
class PointsAccountDetailPoList{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号(版本>=0)
	private $icsonUid;	//<uint64_t> 易迅id, 暂支持32位(版本>=0)
	private $detailTotalNum;	//<uint32_t> 积分明细总数目(版本>=0)
	private $pointsAccountDetailPoList;	//<std::vector<b2b2c::account::po::CPointsAccountDetailPo> > 积分明细列表(版本>=0)
	private $reserve;	//<std::string> reserve  预留字段，无用(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $icsonUid_u;	//<uint8_t> (版本>=0)
	private $detailTotalNum_u;	//<uint8_t> (版本>=0)
	private $pointsAccountDetailPoList_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->icsonUid = 0;	//<uint64_t>
		$this->detailTotalNum = 0;	//<uint32_t>
		$this->pointsAccountDetailPoList = new \stl_vector2('\b2b2c\account\po\PointsAccountDetailPo');	//<std::vector<b2b2c::account::po::CPointsAccountDetailPo> >
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->icsonUid_u = 0;	//<uint8_t>
		$this->detailTotalNum_u = 0;	//<uint8_t>
		$this->pointsAccountDetailPoList_u = 0;	//<uint8_t>
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
			exit("\b2b2c\account\po\PointsAccountDetailPoList\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\account\po\PointsAccountDetailPoList\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅id, 暂支持32位
		$bs->pushUint32_t($this->detailTotalNum);	//<uint32_t> 积分明细总数目
		$bs->pushObject($this->pointsAccountDetailPoList,'stl_vector');	//<std::vector<b2b2c::account::po::CPointsAccountDetailPo> > 积分明细列表
		$bs->pushString($this->reserve);	//<std::string> reserve  预留字段，无用
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonUid_u);	//<uint8_t> 
		$bs->pushUint8_t($this->detailTotalNum_u);	//<uint8_t> 
		$bs->pushUint8_t($this->pointsAccountDetailPoList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号
		$this->_arr_value['icsonUid'] = $bs->popUint64_t();	//<uint64_t> 易迅id, 暂支持32位
		$this->_arr_value['detailTotalNum'] = $bs->popUint32_t();	//<uint32_t> 积分明细总数目
		$this->_arr_value['pointsAccountDetailPoList'] = $bs->popObject('stl_vector<\b2b2c\account\po\PointsAccountDetailPo>');	//<std::vector<b2b2c::account::po::CPointsAccountDetailPo> > 积分明细列表
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> reserve  预留字段，无用
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonUid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['detailTotalNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['pointsAccountDetailPoList_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace b2b2c\account\po;	//source idl: com.b2b2c.account.idl.PointsAccountDetailPoList.java
class PointsAccountDetailPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号(版本>=0)
	private $detailId;	//<uint64_t> 积分明细ID(版本>=0)
	private $totalAvailablePoints;	//<uint32_t> 账户总账可用积分值(版本>=0)
	private $detailPoints;	//<int> 积分明细值， 负数代表扣减积分数，正数代表发放积分数(版本>=0)
	private $pointsType;	//<uint32_t> 积分类型, 1：现金积分(账户余额)、2：促销积分(版本>=0)
	private $detailType;	//<uint32_t> 积分明细类型(场景)(版本>=0)
	private $detailState;	//<uint32_t> 积分明细状态：2：发放积分明细  5:已过期明细 6：扣减积分明细(版本>=0)
	private $detailProperty;	//<uint32_t> 积分明细属性，保留(版本>=0)
	private $detailAddtime;	//<uint32_t> 积分明细添加时间(版本>=0)
	private $detailLastmodifytime;	//<uint32_t> 积分明细最后修改时间，时间区间查询依据的是此字段(版本>=0)
	private $remarks;	//<std::string> 明细备注(版本>=0)
	private $reserve;	//<std::string> reserve  预留字段，无用(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $detailId_u;	//<uint8_t> (版本>=0)
	private $totalAvailablePoints_u;	//<uint8_t> (版本>=0)
	private $detailPoints_u;	//<uint8_t> (版本>=0)
	private $pointsType_u;	//<uint8_t> (版本>=0)
	private $detailType_u;	//<uint8_t> (版本>=0)
	private $detailState_u;	//<uint8_t> (版本>=0)
	private $detailProperty_u;	//<uint8_t> (版本>=0)
	private $detailAddtime_u;	//<uint8_t> (版本>=0)
	private $detailLastmodifytime_u;	//<uint8_t> (版本>=0)
	private $remarks_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)
	private $expiredTime;	//<uint32_t> 过期时间，只针对促销积分(版本>=20130401)
	private $expiredTime_u;	//<uint8_t> (版本>=20130401)

	function __construct(){
		$this->version = 20130401;	//<uint32_t>
		$this->detailId = 0;	//<uint64_t>
		$this->totalAvailablePoints = 0;	//<uint32_t>
		$this->detailPoints = 0;	//<int>
		$this->pointsType = 0;	//<uint32_t>
		$this->detailType = 0;	//<uint32_t>
		$this->detailState = 0;	//<uint32_t>
		$this->detailProperty = 0;	//<uint32_t>
		$this->detailAddtime = 0;	//<uint32_t>
		$this->detailLastmodifytime = 0;	//<uint32_t>
		$this->remarks = "";	//<std::string>
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->detailId_u = 0;	//<uint8_t>
		$this->totalAvailablePoints_u = 0;	//<uint8_t>
		$this->detailPoints_u = 0;	//<uint8_t>
		$this->pointsType_u = 0;	//<uint8_t>
		$this->detailType_u = 0;	//<uint8_t>
		$this->detailState_u = 0;	//<uint8_t>
		$this->detailProperty_u = 0;	//<uint8_t>
		$this->detailAddtime_u = 0;	//<uint8_t>
		$this->detailLastmodifytime_u = 0;	//<uint8_t>
		$this->remarks_u = 0;	//<uint8_t>
		$this->reserve_u = 0;	//<uint8_t>
		$this->expiredTime = 0;	//<uint32_t>
		$this->expiredTime_u = 0;	//<uint8_t>
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
			exit("\b2b2c\account\po\PointsAccountDetailPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\account\po\PointsAccountDetailPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint64_t($this->detailId);	//<uint64_t> 积分明细ID
		$bs->pushUint32_t($this->totalAvailablePoints);	//<uint32_t> 账户总账可用积分值
		$bs->pushInt32_t($this->detailPoints);	//<int> 积分明细值， 负数代表扣减积分数，正数代表发放积分数
		$bs->pushUint32_t($this->pointsType);	//<uint32_t> 积分类型, 1：现金积分(账户余额)、2：促销积分
		$bs->pushUint32_t($this->detailType);	//<uint32_t> 积分明细类型(场景)
		$bs->pushUint32_t($this->detailState);	//<uint32_t> 积分明细状态：2：发放积分明细  5:已过期明细 6：扣减积分明细
		$bs->pushUint32_t($this->detailProperty);	//<uint32_t> 积分明细属性，保留
		$bs->pushUint32_t($this->detailAddtime);	//<uint32_t> 积分明细添加时间
		$bs->pushUint32_t($this->detailLastmodifytime);	//<uint32_t> 积分明细最后修改时间，时间区间查询依据的是此字段
		$bs->pushString($this->remarks);	//<std::string> 明细备注
		$bs->pushString($this->reserve);	//<std::string> reserve  预留字段，无用
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->detailId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->totalAvailablePoints_u);	//<uint8_t> 
		$bs->pushUint8_t($this->detailPoints_u);	//<uint8_t> 
		$bs->pushUint8_t($this->pointsType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->detailType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->detailState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->detailProperty_u);	//<uint8_t> 
		$bs->pushUint8_t($this->detailAddtime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->detailLastmodifytime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->remarks_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
		if($this->version >= 20130401){
			$bs->pushUint32_t($this->expiredTime);	//<uint32_t> 过期时间，只针对促销积分
		}
		if($this->version >= 20130401){
			$bs->pushUint8_t($this->expiredTime_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号
		$this->_arr_value['detailId'] = $bs->popUint64_t();	//<uint64_t> 积分明细ID
		$this->_arr_value['totalAvailablePoints'] = $bs->popUint32_t();	//<uint32_t> 账户总账可用积分值
		$this->_arr_value['detailPoints'] = $bs->popInt32_t();	//<int> 积分明细值， 负数代表扣减积分数，正数代表发放积分数
		$this->_arr_value['pointsType'] = $bs->popUint32_t();	//<uint32_t> 积分类型, 1：现金积分(账户余额)、2：促销积分
		$this->_arr_value['detailType'] = $bs->popUint32_t();	//<uint32_t> 积分明细类型(场景)
		$this->_arr_value['detailState'] = $bs->popUint32_t();	//<uint32_t> 积分明细状态：2：发放积分明细  5:已过期明细 6：扣减积分明细
		$this->_arr_value['detailProperty'] = $bs->popUint32_t();	//<uint32_t> 积分明细属性，保留
		$this->_arr_value['detailAddtime'] = $bs->popUint32_t();	//<uint32_t> 积分明细添加时间
		$this->_arr_value['detailLastmodifytime'] = $bs->popUint32_t();	//<uint32_t> 积分明细最后修改时间，时间区间查询依据的是此字段
		$this->_arr_value['remarks'] = $bs->popString();	//<std::string> 明细备注
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> reserve  预留字段，无用
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['detailId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['totalAvailablePoints_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['detailPoints_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['pointsType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['detailType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['detailState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['detailProperty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['detailAddtime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['detailLastmodifytime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['remarks_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserve_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 20130401){
			$this->_arr_value['expiredTime'] = $bs->popUint32_t();	//<uint32_t> 过期时间，只针对促销积分
		}
		if($this->version >= 20130401){
			$this->_arr_value['expiredTime_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace b2b2c\account\po;	//source idl: com.b2b2c.account.idl.GetPointsAccountDetailReq.java
class PointsAccountDetailFilterPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号(版本>=0)
	private $icsonUid;	//<uint64_t> 易迅id, 暂支持32位(版本>=0)
	private $pointsType;	//<uint32_t> 积分类型, 1：现金积分(现金余额)、2：促销积分  默认0，查找所有积分明细(版本>=0)
	private $detailType;	//<uint32_t> 积分明细类型(场景)(版本>=0)
	private $detailState;	//<uint32_t> 积分明细状态, 0：查询所有状态明细, 2：发放积分明细  5:已过期明细 6：扣减积分明细  (版本>=0)
	private $pageid;	//<uint32_t> 分页查询，页码，从0开始(版本>=0)
	private $pagesize;	//<uint32_t> 分页查询，页大小，必须大于0，值不建议太大，影响查询效率，积分后台限制最大值20(版本>=0)
	private $startTime;	//<uint32_t> 查询时间区间，起始时间(版本>=0)
	private $endTime;	//<uint32_t> 查询时间区间，结束时间(版本>=0)
	private $reserve;	//<std::string> reserve  预留字段，无用(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $icsonUid_u;	//<uint8_t> (版本>=0)
	private $pointsType_u;	//<uint8_t> (版本>=0)
	private $detailType_u;	//<uint8_t> (版本>=0)
	private $detailState_u;	//<uint8_t> (版本>=0)
	private $pageid_u;	//<uint8_t> (版本>=0)
	private $pagesize_u;	//<uint8_t> (版本>=0)
	private $startTime_u;	//<uint8_t> (版本>=0)
	private $endTime_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->icsonUid = 0;	//<uint64_t>
		$this->pointsType = 0;	//<uint32_t>
		$this->detailType = 0;	//<uint32_t>
		$this->detailState = 0;	//<uint32_t>
		$this->pageid = 0;	//<uint32_t>
		$this->pagesize = 0;	//<uint32_t>
		$this->startTime = 0;	//<uint32_t>
		$this->endTime = 0;	//<uint32_t>
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->icsonUid_u = 0;	//<uint8_t>
		$this->pointsType_u = 0;	//<uint8_t>
		$this->detailType_u = 0;	//<uint8_t>
		$this->detailState_u = 0;	//<uint8_t>
		$this->pageid_u = 0;	//<uint8_t>
		$this->pagesize_u = 0;	//<uint8_t>
		$this->startTime_u = 0;	//<uint8_t>
		$this->endTime_u = 0;	//<uint8_t>
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
			exit("\b2b2c\account\po\PointsAccountDetailFilterPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\account\po\PointsAccountDetailFilterPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅id, 暂支持32位
		$bs->pushUint32_t($this->pointsType);	//<uint32_t> 积分类型, 1：现金积分(现金余额)、2：促销积分  默认0，查找所有积分明细
		$bs->pushUint32_t($this->detailType);	//<uint32_t> 积分明细类型(场景)
		$bs->pushUint32_t($this->detailState);	//<uint32_t> 积分明细状态, 0：查询所有状态明细, 2：发放积分明细  5:已过期明细 6：扣减积分明细  
		$bs->pushUint32_t($this->pageid);	//<uint32_t> 分页查询，页码，从0开始
		$bs->pushUint32_t($this->pagesize);	//<uint32_t> 分页查询，页大小，必须大于0，值不建议太大，影响查询效率，积分后台限制最大值20
		$bs->pushUint32_t($this->startTime);	//<uint32_t> 查询时间区间，起始时间
		$bs->pushUint32_t($this->endTime);	//<uint32_t> 查询时间区间，结束时间
		$bs->pushString($this->reserve);	//<std::string> reserve  预留字段，无用
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonUid_u);	//<uint8_t> 
		$bs->pushUint8_t($this->pointsType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->detailType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->detailState_u);	//<uint8_t> 
		$bs->pushUint8_t($this->pageid_u);	//<uint8_t> 
		$bs->pushUint8_t($this->pagesize_u);	//<uint8_t> 
		$bs->pushUint8_t($this->startTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->endTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号
		$this->_arr_value['icsonUid'] = $bs->popUint64_t();	//<uint64_t> 易迅id, 暂支持32位
		$this->_arr_value['pointsType'] = $bs->popUint32_t();	//<uint32_t> 积分类型, 1：现金积分(现金余额)、2：促销积分  默认0，查找所有积分明细
		$this->_arr_value['detailType'] = $bs->popUint32_t();	//<uint32_t> 积分明细类型(场景)
		$this->_arr_value['detailState'] = $bs->popUint32_t();	//<uint32_t> 积分明细状态, 0：查询所有状态明细, 2：发放积分明细  5:已过期明细 6：扣减积分明细  
		$this->_arr_value['pageid'] = $bs->popUint32_t();	//<uint32_t> 分页查询，页码，从0开始
		$this->_arr_value['pagesize'] = $bs->popUint32_t();	//<uint32_t> 分页查询，页大小，必须大于0，值不建议太大，影响查询效率，积分后台限制最大值20
		$this->_arr_value['startTime'] = $bs->popUint32_t();	//<uint32_t> 查询时间区间，起始时间
		$this->_arr_value['endTime'] = $bs->popUint32_t();	//<uint32_t> 查询时间区间，结束时间
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> reserve  预留字段，无用
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonUid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['pointsType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['detailType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['detailState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['pageid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['pagesize_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['startTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['endTime_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace b2b2c\account\po;	//source idl: com.b2b2c.account.idl.GetPointsAccountResp.java
class PointsAccountPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号(版本>=0)
	private $icsonUid;	//<uint64_t> 易迅id, 暂支持32位(版本>=0)
	private $totalAvailablePoints;	//<uint32_t> 可用积分总值, 等于promotionPoints+cashPoints的值(版本>=0)
	private $promotionPoints;	//<uint32_t> 促销积分总值(版本>=0)
	private $cashPoints;	//<uint32_t> 现金积分总值(账户余额)(版本>=0)
	private $property;	//<uint32_t> 积分属性值，保留(版本>=0)
	private $reserve;	//<std::string> reserve  预留字段，无用(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $icsonUid_u;	//<uint8_t> (版本>=0)
	private $totalAvailablePoints_u;	//<uint8_t> (版本>=0)
	private $promotionPoints_u;	//<uint8_t> (版本>=0)
	private $cashPoints_u;	//<uint8_t> (版本>=0)
	private $property_u;	//<uint8_t> (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)
	private $expiringPromotionPoints;	//<uint32_t> 即将过期的促销积分值(版本>=20130401)
	private $expiringPromotionPointsTime;	//<uint32_t> 即将过期的促销积分时间(秒)(版本>=20130401)
	private $expiringPromotionPoints_u;	//<uint8_t> (版本>=20130401)
	private $expiringPromotionPointsTime_u;	//<uint8_t> (版本>=20130401)

	function __construct(){
		$this->version = 20130401;	//<uint32_t>
		$this->icsonUid = 0;	//<uint64_t>
		$this->totalAvailablePoints = 0;	//<uint32_t>
		$this->promotionPoints = 0;	//<uint32_t>
		$this->cashPoints = 0;	//<uint32_t>
		$this->property = 0;	//<uint32_t>
		$this->reserve = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->icsonUid_u = 0;	//<uint8_t>
		$this->totalAvailablePoints_u = 0;	//<uint8_t>
		$this->promotionPoints_u = 0;	//<uint8_t>
		$this->cashPoints_u = 0;	//<uint8_t>
		$this->property_u = 0;	//<uint8_t>
		$this->reserve_u = 0;	//<uint8_t>
		$this->expiringPromotionPoints = 0;	//<uint32_t>
		$this->expiringPromotionPointsTime = 0;	//<uint32_t>
		$this->expiringPromotionPoints_u = 0;	//<uint8_t>
		$this->expiringPromotionPointsTime_u = 0;	//<uint8_t>
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
			exit("\b2b2c\account\po\PointsAccountPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\account\po\PointsAccountPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅id, 暂支持32位
		$bs->pushUint32_t($this->totalAvailablePoints);	//<uint32_t> 可用积分总值, 等于promotionPoints+cashPoints的值
		$bs->pushUint32_t($this->promotionPoints);	//<uint32_t> 促销积分总值
		$bs->pushUint32_t($this->cashPoints);	//<uint32_t> 现金积分总值(账户余额)
		$bs->pushUint32_t($this->property);	//<uint32_t> 积分属性值，保留
		$bs->pushString($this->reserve);	//<std::string> reserve  预留字段，无用
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonUid_u);	//<uint8_t> 
		$bs->pushUint8_t($this->totalAvailablePoints_u);	//<uint8_t> 
		$bs->pushUint8_t($this->promotionPoints_u);	//<uint8_t> 
		$bs->pushUint8_t($this->cashPoints_u);	//<uint8_t> 
		$bs->pushUint8_t($this->property_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
		if($this->version >= 20130401){
			$bs->pushUint32_t($this->expiringPromotionPoints);	//<uint32_t> 即将过期的促销积分值
		}
		if($this->version >= 20130401){
			$bs->pushUint32_t($this->expiringPromotionPointsTime);	//<uint32_t> 即将过期的促销积分时间(秒)
		}
		if($this->version >= 20130401){
			$bs->pushUint8_t($this->expiringPromotionPoints_u);	//<uint8_t> 
		}
		if($this->version >= 20130401){
			$bs->pushUint8_t($this->expiringPromotionPointsTime_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号
		$this->_arr_value['icsonUid'] = $bs->popUint64_t();	//<uint64_t> 易迅id, 暂支持32位
		$this->_arr_value['totalAvailablePoints'] = $bs->popUint32_t();	//<uint32_t> 可用积分总值, 等于promotionPoints+cashPoints的值
		$this->_arr_value['promotionPoints'] = $bs->popUint32_t();	//<uint32_t> 促销积分总值
		$this->_arr_value['cashPoints'] = $bs->popUint32_t();	//<uint32_t> 现金积分总值(账户余额)
		$this->_arr_value['property'] = $bs->popUint32_t();	//<uint32_t> 积分属性值，保留
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> reserve  预留字段，无用
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonUid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['totalAvailablePoints_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['promotionPoints_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cashPoints_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['property_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserve_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 20130401){
			$this->_arr_value['expiringPromotionPoints'] = $bs->popUint32_t();	//<uint32_t> 即将过期的促销积分值
		}
		if($this->version >= 20130401){
			$this->_arr_value['expiringPromotionPointsTime'] = $bs->popUint32_t();	//<uint32_t> 即将过期的促销积分时间(秒)
		}
		if($this->version >= 20130401){
			$this->_arr_value['expiringPromotionPoints_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 20130401){
			$this->_arr_value['expiringPromotionPointsTime_u'] = $bs->popUint8_t();	//<uint8_t> 
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
