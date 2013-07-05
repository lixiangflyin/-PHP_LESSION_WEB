<?php
namespace icson\vipuser\ddo;	//source idl: com.b2b2c.kf.idl.DAO_51Buy_VipUser.java
class UserAllInfo{
	private $_arr_value=array();	//数组形式的类
	private $baseInfo;	//<icson::vipuser::ddo::CUserBaseInfo>  用户基本信息 (版本>=0)
	private $kfInfo;	//<icson::vipuser::ddo::CKfInfo>  VIP客服信息 (版本>=0)
	private $isVip;	//<uint32_t>  是否VIP (版本>=0)
	private $baseInfo_u;	//<uint8_t> (版本>=0)
	private $uin_u;	//<uint8_t> (版本>=0)
	private $isVip_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->baseInfo = new \icson\vipuser\ddo\UserBaseInfo();	//<icson::vipuser::ddo::CUserBaseInfo>
		$this->kfInfo = new \icson\vipuser\ddo\KfInfo();	//<icson::vipuser::ddo::CKfInfo>
		$this->isVip = 0;	//<uint32_t>
		$this->baseInfo_u = 0;	//<uint8_t>
		$this->uin_u = 0;	//<uint8_t>
		$this->isVip_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\vipuser\ddo\UserAllInfo\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("icson\vipuser\ddo\UserAllInfo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushObject($this->baseInfo,'\icson\vipuser\ddo\UserBaseInfo');	//<icson::vipuser::ddo::CUserBaseInfo>  用户基本信息 
		$bs->pushObject($this->kfInfo,'\icson\vipuser\ddo\KfInfo');	//<icson::vipuser::ddo::CKfInfo>  VIP客服信息 
		$bs->pushUint32_t($this->isVip);	//<uint32_t>  是否VIP 
		$bs->pushUint8_t($this->baseInfo_u);	//<uint8_t> 
		$bs->pushUint8_t($this->uin_u);	//<uint8_t> 
		$bs->pushUint8_t($this->isVip_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['baseInfo'] = $bs->popObject('\icson\vipuser\ddo\UserBaseInfo');	//<icson::vipuser::ddo::CUserBaseInfo>  用户基本信息 
		$this->_arr_value['kfInfo'] = $bs->popObject('\icson\vipuser\ddo\KfInfo');	//<icson::vipuser::ddo::CKfInfo>  VIP客服信息 
		$this->_arr_value['isVip'] = $bs->popUint32_t();	//<uint32_t>  是否VIP 
		$this->_arr_value['baseInfo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['uin_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['isVip_u'] = $bs->popUint8_t();	//<uint8_t> 

		/**********************为了支持多个版本的客户端************************/
		$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
		for($idx = 0;$idx < $needPopLen;$idx++){
			$bs->popUint8_t();
		}
		/**********************为了支持多个版本的客户端************************/
		
		return $this->_arr_value;
	}

	function getClassLen(){
		$len_bs = new \ByteStream();
		$len_bs->setRealWrite(false);
		$this->serialize_internal($len_bs);
		$class_len = $len_bs->getWrittenLength();

		return $class_len;
	}
}

namespace icson\vipuser\ddo;	//source idl: com.b2b2c.kf.idl.UserAllInfo.java
class UserBaseInfo{
	private $_arr_value=array();	//数组形式的类
	private $uid;	//<uint64_t>  uid (版本>=0)
	private $uname;	//<std::string>  uname (版本>=0)
	private $qq;	//<uint64_t>  qq (版本>=0)
	private $level;	//<std::string>  等级，对应字段class (版本>=0)
	private $mobile;	//<uint64_t>  mobile (版本>=0)
	private $email;	//<std::string>  email (版本>=0)
	private $address;	//<std::string>  address (版本>=0)
	private $name;	//<std::string>  name (版本>=0)
	private $sex;	//<std::string>  sex (版本>=0)
	private $birthday;	//<std::string>  birthday (版本>=0)
	private $etime;	//<uint32_t>  etime (版本>=0)
	private $stime;	//<uint32_t>  stime (版本>=0)
	private $kfId;	//<uint32_t>  kfId (版本>=0)
	private $state;	//<uint32_t>  state (版本>=0)
	private $uid_u;	//<uint8_t> (版本>=0)
	private $uname_u;	//<uint8_t> (版本>=0)
	private $qq_u;	//<uint8_t> (版本>=0)
	private $level_u;	//<uint8_t> (版本>=0)
	private $mobile_u;	//<uint8_t> (版本>=0)
	private $email_u;	//<uint8_t> (版本>=0)
	private $address_u;	//<uint8_t> (版本>=0)
	private $name_u;	//<uint8_t> (版本>=0)
	private $sex_u;	//<uint8_t> (版本>=0)
	private $birthday_u;	//<uint8_t> (版本>=0)
	private $etime_u;	//<uint8_t> (版本>=0)
	private $stime_u;	//<uint8_t> (版本>=0)
	private $kfId_u;	//<uint8_t> (版本>=0)
	private $state_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->uid = 0;	//<uint64_t>
		$this->uname = "";	//<std::string>
		$this->qq = 0;	//<uint64_t>
		$this->level = "";	//<std::string>
		$this->mobile = 0;	//<uint64_t>
		$this->email = "";	//<std::string>
		$this->address = "";	//<std::string>
		$this->name = "";	//<std::string>
		$this->sex = "";	//<std::string>
		$this->birthday = "";	//<std::string>
		$this->etime = 0;	//<uint32_t>
		$this->stime = 0;	//<uint32_t>
		$this->kfId = 0;	//<uint32_t>
		$this->state = 0;	//<uint32_t>
		$this->uid_u = 0;	//<uint8_t>
		$this->uname_u = 0;	//<uint8_t>
		$this->qq_u = 0;	//<uint8_t>
		$this->level_u = 0;	//<uint8_t>
		$this->mobile_u = 0;	//<uint8_t>
		$this->email_u = 0;	//<uint8_t>
		$this->address_u = 0;	//<uint8_t>
		$this->name_u = 0;	//<uint8_t>
		$this->sex_u = 0;	//<uint8_t>
		$this->birthday_u = 0;	//<uint8_t>
		$this->etime_u = 0;	//<uint8_t>
		$this->stime_u = 0;	//<uint8_t>
		$this->kfId_u = 0;	//<uint8_t>
		$this->state_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\vipuser\ddo\UserBaseInfo\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("icson\vipuser\ddo\UserBaseInfo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint64_t($this->uid);	//<uint64_t>  uid 
		$bs->pushString($this->uname);	//<std::string>  uname 
		$bs->pushUint64_t($this->qq);	//<uint64_t>  qq 
		$bs->pushString($this->level);	//<std::string>  等级，对应字段class 
		$bs->pushUint64_t($this->mobile);	//<uint64_t>  mobile 
		$bs->pushString($this->email);	//<std::string>  email 
		$bs->pushString($this->address);	//<std::string>  address 
		$bs->pushString($this->name);	//<std::string>  name 
		$bs->pushString($this->sex);	//<std::string>  sex 
		$bs->pushString($this->birthday);	//<std::string>  birthday 
		$bs->pushUint32_t($this->etime);	//<uint32_t>  etime 
		$bs->pushUint32_t($this->stime);	//<uint32_t>  stime 
		$bs->pushUint32_t($this->kfId);	//<uint32_t>  kfId 
		$bs->pushUint32_t($this->state);	//<uint32_t>  state 
		$bs->pushUint8_t($this->uid_u);	//<uint8_t> 
		$bs->pushUint8_t($this->uname_u);	//<uint8_t> 
		$bs->pushUint8_t($this->qq_u);	//<uint8_t> 
		$bs->pushUint8_t($this->level_u);	//<uint8_t> 
		$bs->pushUint8_t($this->mobile_u);	//<uint8_t> 
		$bs->pushUint8_t($this->email_u);	//<uint8_t> 
		$bs->pushUint8_t($this->address_u);	//<uint8_t> 
		$bs->pushUint8_t($this->name_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sex_u);	//<uint8_t> 
		$bs->pushUint8_t($this->birthday_u);	//<uint8_t> 
		$bs->pushUint8_t($this->etime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->stime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->kfId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->state_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['uid'] = $bs->popUint64_t();	//<uint64_t>  uid 
		$this->_arr_value['uname'] = $bs->popString();	//<std::string>  uname 
		$this->_arr_value['qq'] = $bs->popUint64_t();	//<uint64_t>  qq 
		$this->_arr_value['level'] = $bs->popString();	//<std::string>  等级，对应字段class 
		$this->_arr_value['mobile'] = $bs->popUint64_t();	//<uint64_t>  mobile 
		$this->_arr_value['email'] = $bs->popString();	//<std::string>  email 
		$this->_arr_value['address'] = $bs->popString();	//<std::string>  address 
		$this->_arr_value['name'] = $bs->popString();	//<std::string>  name 
		$this->_arr_value['sex'] = $bs->popString();	//<std::string>  sex 
		$this->_arr_value['birthday'] = $bs->popString();	//<std::string>  birthday 
		$this->_arr_value['etime'] = $bs->popUint32_t();	//<uint32_t>  etime 
		$this->_arr_value['stime'] = $bs->popUint32_t();	//<uint32_t>  stime 
		$this->_arr_value['kfId'] = $bs->popUint32_t();	//<uint32_t>  kfId 
		$this->_arr_value['state'] = $bs->popUint32_t();	//<uint32_t>  state 
		$this->_arr_value['uid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['uname_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['qq_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['level_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mobile_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['email_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['address_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['name_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sex_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['birthday_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['etime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['kfId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['state_u'] = $bs->popUint8_t();	//<uint8_t> 

		/**********************为了支持多个版本的客户端************************/
		$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
		for($idx = 0;$idx < $needPopLen;$idx++){
			$bs->popUint8_t();
		}
		/**********************为了支持多个版本的客户端************************/
		
		return $this->_arr_value;
	}

	function getClassLen(){
		$len_bs = new \ByteStream();
		$len_bs->setRealWrite(false);
		$this->serialize_internal($len_bs);
		$class_len = $len_bs->getWrittenLength();

		return $class_len;
	}
}

namespace icson\vipuser\ddo;	//source idl: com.b2b2c.kf.idl.DAO_51Buy_VipUser.java
class KfInfo{
	private $_arr_value=array();	//数组形式的类
	private $name;	//<std::string>  姓名 (版本>=0)
	private $mobile;	//<uint64_t>  电话 (版本>=0)
	private $qq;	//<uint64_t>  QQ号 (版本>=0)
	private $name_u;	//<uint8_t> (版本>=0)
	private $mobile_u;	//<uint8_t> (版本>=0)
	private $qq_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->name = "";	//<std::string>
		$this->mobile = 0;	//<uint64_t>
		$this->qq = 0;	//<uint64_t>
		$this->name_u = 0;	//<uint8_t>
		$this->mobile_u = 0;	//<uint8_t>
		$this->qq_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\vipuser\ddo\KfInfo\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("icson\vipuser\ddo\KfInfo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushString($this->name);	//<std::string>  姓名 
		$bs->pushUint64_t($this->mobile);	//<uint64_t>  电话 
		$bs->pushUint64_t($this->qq);	//<uint64_t>  QQ号 
		$bs->pushUint8_t($this->name_u);	//<uint8_t> 
		$bs->pushUint8_t($this->mobile_u);	//<uint8_t> 
		$bs->pushUint8_t($this->qq_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['name'] = $bs->popString();	//<std::string>  姓名 
		$this->_arr_value['mobile'] = $bs->popUint64_t();	//<uint64_t>  电话 
		$this->_arr_value['qq'] = $bs->popUint64_t();	//<uint64_t>  QQ号 
		$this->_arr_value['name_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mobile_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['qq_u'] = $bs->popUint8_t();	//<uint8_t> 

		/**********************为了支持多个版本的客户端************************/
		$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
		for($idx = 0;$idx < $needPopLen;$idx++){
			$bs->popUint8_t();
		}
		/**********************为了支持多个版本的客户端************************/
		
		return $this->_arr_value;
	}

	function getClassLen(){
		$len_bs = new \ByteStream();
		$len_bs->setRealWrite(false);
		$this->serialize_internal($len_bs);
		$class_len = $len_bs->getWrittenLength();

		return $class_len;
	}
}
