<?php
namespace b2b2c\icson_recvaddr\po;	//source idl: com.b2b2c.icsonrecvaddr.idl.GetIcsonRecvAddrResp.java
class IcsonRecvAddrPoList{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号(版本>=0)
	private $icsonRecvAddrPoList;	//<std::vector<b2b2c::icson_recvaddr::po::CIcsonRecvAddrPo> > 易迅收货地址Po列表(版本>=0)
	private $reserved;	//<std::string> 预留字段(版本>=0)
	private $version_u;	//<uint8_t> 版本号_u(版本>=0)
	private $icsonRecvAddrPoList_u;	//<uint8_t> 易迅收货地址Po列表_u(版本>=0)
	private $reserved_u;	//<uint8_t> 预留字段_u(版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->icsonRecvAddrPoList = new \stl_vector2('\b2b2c\icson_recvaddr\po\IcsonRecvAddrPo');	//<std::vector<b2b2c::icson_recvaddr::po::CIcsonRecvAddrPo> >
		$this->reserved = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->icsonRecvAddrPoList_u = 0;	//<uint8_t>
		$this->reserved_u = 0;	//<uint8_t>
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
			exit("\b2b2c\icson_recvaddr\po\IcsonRecvAddrPoList\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\icson_recvaddr\po\IcsonRecvAddrPoList\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushObject($this->icsonRecvAddrPoList,'stl_vector');	//<std::vector<b2b2c::icson_recvaddr::po::CIcsonRecvAddrPo> > 易迅收货地址Po列表
		$bs->pushString($this->reserved);	//<std::string> 预留字段
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 版本号_u
		$bs->pushUint8_t($this->icsonRecvAddrPoList_u);	//<uint8_t> 易迅收货地址Po列表_u
		$bs->pushUint8_t($this->reserved_u);	//<uint8_t> 预留字段_u
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号
		$this->_arr_value['icsonRecvAddrPoList'] = $bs->popObject('stl_vector<\b2b2c\icson_recvaddr\po\IcsonRecvAddrPo>');	//<std::vector<b2b2c::icson_recvaddr::po::CIcsonRecvAddrPo> > 易迅收货地址Po列表
		$this->_arr_value['reserved'] = $bs->popString();	//<std::string> 预留字段
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 版本号_u
		$this->_arr_value['icsonRecvAddrPoList_u'] = $bs->popUint8_t();	//<uint8_t> 易迅收货地址Po列表_u
		$this->_arr_value['reserved_u'] = $bs->popUint8_t();	//<uint8_t> 预留字段_u

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


//source idl: com.b2b2c.icsonrecvaddr.idl.IcsonRecvAddressAo.java


final class AreaIdType
{
	const AREA_ID_GB = 1; // 国标区域ID
	const AREA_ID_ICSON = 2; // 易迅区域ID
	const AREA_ID_GB_EXTEND = 3; // 国标扩展ID
}

namespace b2b2c\icson_recvaddr\po;	//source idl: com.b2b2c.icsonrecvaddr.idl.AddIcsonRecvAddrReq.java
class IcsonRecvAddrPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号(版本>=0)
	private $icsonAid;	//<uint64_t> 易迅收货地址记录ID(版本>=0)
	private $iid;	//<uint32_t> 易迅发票ID(版本>=0)
	private $icsonUid;	//<uint64_t> 易迅用户ID(版本>=0)
	private $name;	//<std::string> 用户姓名(版本>=0)
	private $mobile;	//<std::string> 用户手机号(版本>=0)
	private $phone;	//<std::string> 用户普通电话(版本>=0)
	private $fax;	//<std::string> 用户传真(版本>=0)
	private $zipCode;	//<std::string> 邮编(版本>=0)
	private $districtIdMap;	//<std::map<uint32_t,uint32_t> > 区域ID映射表(版本>=0)
	private $address;	//<std::string> 用户详细收货地址(版本>=0)
	private $workplace;	//<std::string> 地址标注(版本>=0)
	private $sortfactor;	//<uint32_t> 排序因子(版本>=0)
	private $updateTime;	//<uint32_t> 记录更新时间(版本>=0)
	private $createTime;	//<uint32_t> 记录创建时间(版本>=0)
	private $defaultShipping;	//<uint32_t> 默认送货方式(版本>=0)
	private $defaultPayType;	//<uint32_t> 默认支付类型(版本>=0)
	private $lastUseTime;	//<uint32_t> 上次使用时间(版本>=0)
	private $wgAid;	//<uint32_t> 网购收货地址ID(版本>=0)
	private $addrType;	//<uint32_t> 地址类型(版本>=0)
	private $usedCount;	//<uint32_t> 使用次数(版本>=0)
	private $property;	//<uint32_t> 属性,0x1标识默认地址(版本>=0)
	private $pcdConfictFlag;	//<uint32_t> 结果与查询的行政区划冲突(版本>=0)
	private $pointX;	//<uint32_t> 经度(版本>=0)
	private $pointY;	//<uint32_t> 纬度(版本>=0)
	private $similarity;	//<uint32_t> 查询字符串与查询结果的相似度(版本>=0)
	private $reserved;	//<std::string> 预留(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $icsonAid_u;	//<uint8_t> (版本>=0)
	private $iid_u;	//<uint8_t> (版本>=0)
	private $icsonUid_u;	//<uint8_t> (版本>=0)
	private $name_u;	//<uint8_t> (版本>=0)
	private $mobile_u;	//<uint8_t> (版本>=0)
	private $phone_u;	//<uint8_t> (版本>=0)
	private $fax_u;	//<uint8_t> (版本>=0)
	private $zipCode_u;	//<uint8_t> (版本>=0)
	private $districtIdMap_u;	//<uint8_t> (版本>=0)
	private $address_u;	//<uint8_t> (版本>=0)
	private $workplace_u;	//<uint8_t> (版本>=0)
	private $sortfactor_u;	//<uint8_t> (版本>=0)
	private $updateTime_u;	//<uint8_t> (版本>=0)
	private $createTime_u;	//<uint8_t> (版本>=0)
	private $defaultShipping_u;	//<uint8_t> (版本>=0)
	private $defaultPayType_u;	//<uint8_t> (版本>=0)
	private $lastUseTime_u;	//<uint8_t> (版本>=0)
	private $wgAid_u;	//<uint8_t> (版本>=0)
	private $addrType_u;	//<uint8_t> (版本>=0)
	private $usedCount_u;	//<uint8_t> (版本>=0)
	private $property_u;	//<uint8_t> (版本>=0)
	private $pcdConfictFlag_u;	//<uint8_t> (版本>=0)
	private $pointX_u;	//<uint8_t> (版本>=0)
	private $pointY_u;	//<uint8_t> (版本>=0)
	private $similarity_u;	//<uint8_t> (版本>=0)
	private $reserved_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->icsonAid = 0;	//<uint64_t>
		$this->iid = 0;	//<uint32_t>
		$this->icsonUid = 0;	//<uint64_t>
		$this->name = "";	//<std::string>
		$this->mobile = "";	//<std::string>
		$this->phone = "";	//<std::string>
		$this->fax = "";	//<std::string>
		$this->zipCode = "";	//<std::string>
		$this->districtIdMap = new \stl_map2('uint32_t,uint32_t');	//<std::map<uint32_t,uint32_t> >
		$this->address = "";	//<std::string>
		$this->workplace = "";	//<std::string>
		$this->sortfactor = 0;	//<uint32_t>
		$this->updateTime = 0;	//<uint32_t>
		$this->createTime = 0;	//<uint32_t>
		$this->defaultShipping = 0;	//<uint32_t>
		$this->defaultPayType = 0;	//<uint32_t>
		$this->lastUseTime = 0;	//<uint32_t>
		$this->wgAid = 0;	//<uint32_t>
		$this->addrType = 0;	//<uint32_t>
		$this->usedCount = 0;	//<uint32_t>
		$this->property = 0;	//<uint32_t>
		$this->pcdConfictFlag = 0;	//<uint32_t>
		$this->pointX = 0;	//<uint32_t>
		$this->pointY = 0;	//<uint32_t>
		$this->similarity = 0;	//<uint32_t>
		$this->reserved = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->icsonAid_u = 0;	//<uint8_t>
		$this->iid_u = 0;	//<uint8_t>
		$this->icsonUid_u = 0;	//<uint8_t>
		$this->name_u = 0;	//<uint8_t>
		$this->mobile_u = 0;	//<uint8_t>
		$this->phone_u = 0;	//<uint8_t>
		$this->fax_u = 0;	//<uint8_t>
		$this->zipCode_u = 0;	//<uint8_t>
		$this->districtIdMap_u = 0;	//<uint8_t>
		$this->address_u = 0;	//<uint8_t>
		$this->workplace_u = 0;	//<uint8_t>
		$this->sortfactor_u = 0;	//<uint8_t>
		$this->updateTime_u = 0;	//<uint8_t>
		$this->createTime_u = 0;	//<uint8_t>
		$this->defaultShipping_u = 0;	//<uint8_t>
		$this->defaultPayType_u = 0;	//<uint8_t>
		$this->lastUseTime_u = 0;	//<uint8_t>
		$this->wgAid_u = 0;	//<uint8_t>
		$this->addrType_u = 0;	//<uint8_t>
		$this->usedCount_u = 0;	//<uint8_t>
		$this->property_u = 0;	//<uint8_t>
		$this->pcdConfictFlag_u = 0;	//<uint8_t>
		$this->pointX_u = 0;	//<uint8_t>
		$this->pointY_u = 0;	//<uint8_t>
		$this->similarity_u = 0;	//<uint8_t>
		$this->reserved_u = 0;	//<uint8_t>
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
			exit("\b2b2c\icson_recvaddr\po\IcsonRecvAddrPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\icson_recvaddr\po\IcsonRecvAddrPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint64_t($this->icsonAid);	//<uint64_t> 易迅收货地址记录ID
		$bs->pushUint32_t($this->iid);	//<uint32_t> 易迅发票ID
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅用户ID
		$bs->pushString($this->name);	//<std::string> 用户姓名
		$bs->pushString($this->mobile);	//<std::string> 用户手机号
		$bs->pushString($this->phone);	//<std::string> 用户普通电话
		$bs->pushString($this->fax);	//<std::string> 用户传真
		$bs->pushString($this->zipCode);	//<std::string> 邮编
		$bs->pushObject($this->districtIdMap,'stl_map');	//<std::map<uint32_t,uint32_t> > 区域ID映射表
		$bs->pushString($this->address);	//<std::string> 用户详细收货地址
		$bs->pushString($this->workplace);	//<std::string> 地址标注
		$bs->pushUint32_t($this->sortfactor);	//<uint32_t> 排序因子
		$bs->pushUint32_t($this->updateTime);	//<uint32_t> 记录更新时间
		$bs->pushUint32_t($this->createTime);	//<uint32_t> 记录创建时间
		$bs->pushUint32_t($this->defaultShipping);	//<uint32_t> 默认送货方式
		$bs->pushUint32_t($this->defaultPayType);	//<uint32_t> 默认支付类型
		$bs->pushUint32_t($this->lastUseTime);	//<uint32_t> 上次使用时间
		$bs->pushUint32_t($this->wgAid);	//<uint32_t> 网购收货地址ID
		$bs->pushUint32_t($this->addrType);	//<uint32_t> 地址类型
		$bs->pushUint32_t($this->usedCount);	//<uint32_t> 使用次数
		$bs->pushUint32_t($this->property);	//<uint32_t> 属性,0x1标识默认地址
		$bs->pushUint32_t($this->pcdConfictFlag);	//<uint32_t> 结果与查询的行政区划冲突
		$bs->pushUint32_t($this->pointX);	//<uint32_t> 经度
		$bs->pushUint32_t($this->pointY);	//<uint32_t> 纬度
		$bs->pushUint32_t($this->similarity);	//<uint32_t> 查询字符串与查询结果的相似度
		$bs->pushString($this->reserved);	//<std::string> 预留
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonAid_u);	//<uint8_t> 
		$bs->pushUint8_t($this->iid_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonUid_u);	//<uint8_t> 
		$bs->pushUint8_t($this->name_u);	//<uint8_t> 
		$bs->pushUint8_t($this->mobile_u);	//<uint8_t> 
		$bs->pushUint8_t($this->phone_u);	//<uint8_t> 
		$bs->pushUint8_t($this->fax_u);	//<uint8_t> 
		$bs->pushUint8_t($this->zipCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->districtIdMap_u);	//<uint8_t> 
		$bs->pushUint8_t($this->address_u);	//<uint8_t> 
		$bs->pushUint8_t($this->workplace_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sortfactor_u);	//<uint8_t> 
		$bs->pushUint8_t($this->updateTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->createTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->defaultShipping_u);	//<uint8_t> 
		$bs->pushUint8_t($this->defaultPayType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->lastUseTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->wgAid_u);	//<uint8_t> 
		$bs->pushUint8_t($this->addrType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->usedCount_u);	//<uint8_t> 
		$bs->pushUint8_t($this->property_u);	//<uint8_t> 
		$bs->pushUint8_t($this->pcdConfictFlag_u);	//<uint8_t> 
		$bs->pushUint8_t($this->pointX_u);	//<uint8_t> 
		$bs->pushUint8_t($this->pointY_u);	//<uint8_t> 
		$bs->pushUint8_t($this->similarity_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserved_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号
		$this->_arr_value['icsonAid'] = $bs->popUint64_t();	//<uint64_t> 易迅收货地址记录ID
		$this->_arr_value['iid'] = $bs->popUint32_t();	//<uint32_t> 易迅发票ID
		$this->_arr_value['icsonUid'] = $bs->popUint64_t();	//<uint64_t> 易迅用户ID
		$this->_arr_value['name'] = $bs->popString();	//<std::string> 用户姓名
		$this->_arr_value['mobile'] = $bs->popString();	//<std::string> 用户手机号
		$this->_arr_value['phone'] = $bs->popString();	//<std::string> 用户普通电话
		$this->_arr_value['fax'] = $bs->popString();	//<std::string> 用户传真
		$this->_arr_value['zipCode'] = $bs->popString();	//<std::string> 邮编
		$this->_arr_value['districtIdMap'] = $bs->popObject('stl_map<uint32_t,uint32_t>');	//<std::map<uint32_t,uint32_t> > 区域ID映射表
		$this->_arr_value['address'] = $bs->popString();	//<std::string> 用户详细收货地址
		$this->_arr_value['workplace'] = $bs->popString();	//<std::string> 地址标注
		$this->_arr_value['sortfactor'] = $bs->popUint32_t();	//<uint32_t> 排序因子
		$this->_arr_value['updateTime'] = $bs->popUint32_t();	//<uint32_t> 记录更新时间
		$this->_arr_value['createTime'] = $bs->popUint32_t();	//<uint32_t> 记录创建时间
		$this->_arr_value['defaultShipping'] = $bs->popUint32_t();	//<uint32_t> 默认送货方式
		$this->_arr_value['defaultPayType'] = $bs->popUint32_t();	//<uint32_t> 默认支付类型
		$this->_arr_value['lastUseTime'] = $bs->popUint32_t();	//<uint32_t> 上次使用时间
		$this->_arr_value['wgAid'] = $bs->popUint32_t();	//<uint32_t> 网购收货地址ID
		$this->_arr_value['addrType'] = $bs->popUint32_t();	//<uint32_t> 地址类型
		$this->_arr_value['usedCount'] = $bs->popUint32_t();	//<uint32_t> 使用次数
		$this->_arr_value['property'] = $bs->popUint32_t();	//<uint32_t> 属性,0x1标识默认地址
		$this->_arr_value['pcdConfictFlag'] = $bs->popUint32_t();	//<uint32_t> 结果与查询的行政区划冲突
		$this->_arr_value['pointX'] = $bs->popUint32_t();	//<uint32_t> 经度
		$this->_arr_value['pointY'] = $bs->popUint32_t();	//<uint32_t> 纬度
		$this->_arr_value['similarity'] = $bs->popUint32_t();	//<uint32_t> 查询字符串与查询结果的相似度
		$this->_arr_value['reserved'] = $bs->popString();	//<std::string> 预留
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonAid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['iid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonUid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['name_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mobile_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['phone_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['fax_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['zipCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['districtIdMap_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['address_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['workplace_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sortfactor_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['updateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['createTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['defaultShipping_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['defaultPayType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['lastUseTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['wgAid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['addrType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['usedCount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['property_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['pcdConfictFlag_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['pointX_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['pointY_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['similarity_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserved_u'] = $bs->popUint8_t();	//<uint8_t> 

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
