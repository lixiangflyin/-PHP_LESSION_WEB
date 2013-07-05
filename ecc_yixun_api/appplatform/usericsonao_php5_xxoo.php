<?php
namespace b2b2c\user\po;	//source idl: com.b2b2c.user.idl.ModifyExpLevVirExpByIcsonUidReq.java
class PointsAndLevelPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号(版本>=0)
	private $icsonUid;	//<uint64_t> 易讯uid,必填(版本>=0)
	private $experience;	//<uint32_t> 用户经验值(版本>=0)
	private $icsonMemberLevel;	//<uint32_t> 易迅会员等级(版本>=0)
	private $virtualExp;	//<uint32_t> 易讯虚拟经验值(版本>=0)
	private $reserveStr;	//<std::string> reserve string(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $icsonUid_u;	//<uint8_t> (版本>=0)
	private $experience_u;	//<uint8_t> (版本>=0)
	private $icsonMemberLevel_u;	//<uint8_t> (版本>=0)
	private $virtualExp_u;	//<uint8_t> (版本>=0)
	private $reserveStr_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->icsonUid = 0;	//<uint64_t>
		$this->experience = 0;	//<uint32_t>
		$this->icsonMemberLevel = 0;	//<uint32_t>
		$this->virtualExp = 0;	//<uint32_t>
		$this->reserveStr = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->icsonUid_u = 0;	//<uint8_t>
		$this->experience_u = 0;	//<uint8_t>
		$this->icsonMemberLevel_u = 0;	//<uint8_t>
		$this->virtualExp_u = 0;	//<uint8_t>
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
			exit("\b2b2c\user\po\PointsAndLevelPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\user\po\PointsAndLevelPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 版本号
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易讯uid,必填
		$bs->pushUint32_t($this->experience);	//<uint32_t> 用户经验值
		$bs->pushUint32_t($this->icsonMemberLevel);	//<uint32_t> 易迅会员等级
		$bs->pushUint32_t($this->virtualExp);	//<uint32_t> 易讯虚拟经验值
		$bs->pushString($this->reserveStr);	//<std::string> reserve string
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonUid_u);	//<uint8_t> 
		$bs->pushUint8_t($this->experience_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonMemberLevel_u);	//<uint8_t> 
		$bs->pushUint8_t($this->virtualExp_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserveStr_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号
		$this->_arr_value['icsonUid'] = $bs->popUint64_t();	//<uint64_t> 易讯uid,必填
		$this->_arr_value['experience'] = $bs->popUint32_t();	//<uint32_t> 用户经验值
		$this->_arr_value['icsonMemberLevel'] = $bs->popUint32_t();	//<uint32_t> 易迅会员等级
		$this->_arr_value['virtualExp'] = $bs->popUint32_t();	//<uint32_t> 易讯虚拟经验值
		$this->_arr_value['reserveStr'] = $bs->popString();	//<std::string> reserve string
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonUid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['experience_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonMemberLevel_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['virtualExp_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace b2b2c\user\po;	//source idl: com.b2b2c.user.idl.IcsonUniformLoginReq.java
class LoginInfoPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号(版本>=0)
	private $loginFrom;	//<uint32_t> 登录来源，参见user_comm_define.h中的E_LOGIN_FROM_TYPE(版本>=0)
	private $loginIntensityType;	//<uint32_t> 登录强度类型，0--默认，普通登录 1--弱登录，参见user_comm_define.h中的E_LOGIN_INTENSITY_TYPE(版本>=0)
	private $accountType;	//<uint32_t> 用户登录帐号类型，必需，0-无效值 1-QQ号(填1则QQNumber和QQSkey必填) 2-个性化帐号(填2则loginAccount和passwd必填) 3-openid(填3则openid和openidFrom必填)，参见user_comm_define.h中的E_ICSON_USER_ACCOUNT_TYPE(版本>=0)
	private $qQNumber;	//<uint64_t> 用户QQ号，accountType填1时必填，目前仅支持32位(版本>=0)
	private $qQSkey;	//<std::string> QQ号用户的skey，accountType填1时必填(版本>=0)
	private $loginAccount;	//<std::string> 个性登录帐号（如易迅注册帐号、LoginXXX+Openid等），accountType填2时必填(版本>=0)
	private $passwd;	//<std::string> 个性化帐号登录密码，accountType填2时必填(版本>=0)
	private $openid;	//<std::string> Openid值，accountType填3时必填(版本>=0)
	private $openidFrom;	//<uint32_t> openid来源，参见user_comm_define.h中的E_LOGIN_OPENID_FROM(版本>=0)
	private $reserveInt;	//<uint32_t> reserve int(版本>=0)
	private $reserveStr;	//<std::string> reserve string(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $loginFrom_u;	//<uint8_t> (版本>=0)
	private $loginIntensityType_u;	//<uint8_t> (版本>=0)
	private $accountType_u;	//<uint8_t> (版本>=0)
	private $qQNumber_u;	//<uint8_t> (版本>=0)
	private $qQSkey_u;	//<uint8_t> (版本>=0)
	private $loginAccount_u;	//<uint8_t> (版本>=0)
	private $passwd_u;	//<uint8_t> (版本>=0)
	private $openid_u;	//<uint8_t> (版本>=0)
	private $openidFrom_u;	//<uint8_t> (版本>=0)
	private $reserveInt_u;	//<uint8_t> (版本>=0)
	private $reserveStr_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->loginFrom = 0;	//<uint32_t>
		$this->loginIntensityType = 0;	//<uint32_t>
		$this->accountType = 0;	//<uint32_t>
		$this->qQNumber = 0;	//<uint64_t>
		$this->qQSkey = "";	//<std::string>
		$this->loginAccount = "";	//<std::string>
		$this->passwd = "";	//<std::string>
		$this->openid = "";	//<std::string>
		$this->openidFrom = 0;	//<uint32_t>
		$this->reserveInt = 0;	//<uint32_t>
		$this->reserveStr = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->loginFrom_u = 0;	//<uint8_t>
		$this->loginIntensityType_u = 0;	//<uint8_t>
		$this->accountType_u = 0;	//<uint8_t>
		$this->qQNumber_u = 0;	//<uint8_t>
		$this->qQSkey_u = 0;	//<uint8_t>
		$this->loginAccount_u = 0;	//<uint8_t>
		$this->passwd_u = 0;	//<uint8_t>
		$this->openid_u = 0;	//<uint8_t>
		$this->openidFrom_u = 0;	//<uint8_t>
		$this->reserveInt_u = 0;	//<uint8_t>
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
			exit("\b2b2c\user\po\LoginInfoPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\user\po\LoginInfoPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 版本号
		$bs->pushUint32_t($this->loginFrom);	//<uint32_t> 登录来源，参见user_comm_define.h中的E_LOGIN_FROM_TYPE
		$bs->pushUint32_t($this->loginIntensityType);	//<uint32_t> 登录强度类型，0--默认，普通登录 1--弱登录，参见user_comm_define.h中的E_LOGIN_INTENSITY_TYPE
		$bs->pushUint32_t($this->accountType);	//<uint32_t> 用户登录帐号类型，必需，0-无效值 1-QQ号(填1则QQNumber和QQSkey必填) 2-个性化帐号(填2则loginAccount和passwd必填) 3-openid(填3则openid和openidFrom必填)，参见user_comm_define.h中的E_ICSON_USER_ACCOUNT_TYPE
		$bs->pushUint64_t($this->qQNumber);	//<uint64_t> 用户QQ号，accountType填1时必填，目前仅支持32位
		$bs->pushString($this->qQSkey);	//<std::string> QQ号用户的skey，accountType填1时必填
		$bs->pushString($this->loginAccount);	//<std::string> 个性登录帐号（如易迅注册帐号、LoginXXX+Openid等），accountType填2时必填
		$bs->pushString($this->passwd);	//<std::string> 个性化帐号登录密码，accountType填2时必填
		$bs->pushString($this->openid);	//<std::string> Openid值，accountType填3时必填
		$bs->pushUint32_t($this->openidFrom);	//<uint32_t> openid来源，参见user_comm_define.h中的E_LOGIN_OPENID_FROM
		$bs->pushUint32_t($this->reserveInt);	//<uint32_t> reserve int
		$bs->pushString($this->reserveStr);	//<std::string> reserve string
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->loginFrom_u);	//<uint8_t> 
		$bs->pushUint8_t($this->loginIntensityType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->accountType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->qQNumber_u);	//<uint8_t> 
		$bs->pushUint8_t($this->qQSkey_u);	//<uint8_t> 
		$bs->pushUint8_t($this->loginAccount_u);	//<uint8_t> 
		$bs->pushUint8_t($this->passwd_u);	//<uint8_t> 
		$bs->pushUint8_t($this->openid_u);	//<uint8_t> 
		$bs->pushUint8_t($this->openidFrom_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserveInt_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserveStr_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号
		$this->_arr_value['loginFrom'] = $bs->popUint32_t();	//<uint32_t> 登录来源，参见user_comm_define.h中的E_LOGIN_FROM_TYPE
		$this->_arr_value['loginIntensityType'] = $bs->popUint32_t();	//<uint32_t> 登录强度类型，0--默认，普通登录 1--弱登录，参见user_comm_define.h中的E_LOGIN_INTENSITY_TYPE
		$this->_arr_value['accountType'] = $bs->popUint32_t();	//<uint32_t> 用户登录帐号类型，必需，0-无效值 1-QQ号(填1则QQNumber和QQSkey必填) 2-个性化帐号(填2则loginAccount和passwd必填) 3-openid(填3则openid和openidFrom必填)，参见user_comm_define.h中的E_ICSON_USER_ACCOUNT_TYPE
		$this->_arr_value['qQNumber'] = $bs->popUint64_t();	//<uint64_t> 用户QQ号，accountType填1时必填，目前仅支持32位
		$this->_arr_value['qQSkey'] = $bs->popString();	//<std::string> QQ号用户的skey，accountType填1时必填
		$this->_arr_value['loginAccount'] = $bs->popString();	//<std::string> 个性登录帐号（如易迅注册帐号、LoginXXX+Openid等），accountType填2时必填
		$this->_arr_value['passwd'] = $bs->popString();	//<std::string> 个性化帐号登录密码，accountType填2时必填
		$this->_arr_value['openid'] = $bs->popString();	//<std::string> Openid值，accountType填3时必填
		$this->_arr_value['openidFrom'] = $bs->popUint32_t();	//<uint32_t> openid来源，参见user_comm_define.h中的E_LOGIN_OPENID_FROM
		$this->_arr_value['reserveInt'] = $bs->popUint32_t();	//<uint32_t> reserve int
		$this->_arr_value['reserveStr'] = $bs->popString();	//<std::string> reserve string
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['loginFrom_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['loginIntensityType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['accountType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['qQNumber_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['qQSkey_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['loginAccount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['passwd_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['openid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['openidFrom_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserveInt_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace b2b2c\user\po;	//source idl: com.b2b2c.user.idl.UserIcsonAo.java
class BuyerInfoPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号(版本>=0)
	private $wgUid;	//<uint64_t> 网购用户内部id，非QQ号，目前仅支持32位(版本>=0)
	private $icsonUid;	//<uint64_t> 易迅用户内部id，目前仅支持32位(版本>=0)
	private $qQNumber;	//<uint64_t> 绑定的用户QQ号，目前仅支持32位(版本>=0)
	private $loginAccount;	//<std::string> 用户帐号名，包括易迅注册帐号、非qq帐号的第三方联合登录，如LoginAlipay+openid等字符串帐户名(版本>=0)
	private $accountType;	//<uint8_t> 用户帐号类型，0-QQ号 1-个性化帐号，参见user_comm_define.h中的E_USER_LOGINNANE_TYPE(版本>=0)
	private $truename;	//<std::string> 真实姓名(版本>=0)
	private $nickname;	//<std::string> 昵称(版本>=0)
	private $bitProperty;	//<std::bitset<128> > 用户属性位BitSet，属性位代表的意义请参见b2b2c_define.h中的USER_PROPERTY(版本>=0)
	private $userFlagLevel;	//<std::map<uint32_t,uint32_t> > 用户属性级别，如彩钻级别，Map中第一个uint32_t表示用户属性位值，第二个uint32_t表示级别值(版本>=0)
	private $sex;	//<uint8_t> 性别, 0-不明 1-男 2-女 参见user_comm_define.h中的E_USER_SEX(版本>=0)
	private $age;	//<uint8_t> 年龄(版本>=0)
	private $mobile;	//<std::string> 手机号，如绑定手机的用户属性位为1，则表示绑定的手机号(版本>=0)
	private $email;	//<std::string> 电子邮箱，如绑定邮箱的用户属性位为1，则表示绑定的邮箱(版本>=0)
	private $phone;	//<std::string> 固定电话(版本>=0)
	private $fax;	//<std::string> 传真(版本>=0)
	private $region;	//<uint32_t> 用户所在地区id(版本>=0)
	private $postcode;	//<std::string> 邮政编码(版本>=0)
	private $address;	//<std::string> 用户详细住址(版本>=0)
	private $identityType;	//<uint8_t> 身份证件类型，1-身份证 参见user_comm_define.h中E_USER_IDTYPE(版本>=0)
	private $identityNum;	//<std::string> 身份证件号码(版本>=0)
	private $buyerCredit;	//<int> 用户信用值(版本>=0)
	private $experience;	//<uint32_t> 用户经验值(版本>=0)
	private $cftAccount;	//<std::string> 财付通账号(版本>=0)
	private $loginLevel;	//<uint8_t> 登录级别，预留(版本>=0)
	private $userType;	//<uint8_t> 用户类型，从易迅导入，参见user_comm_define.h中E_USER_TYPE(版本>=0)
	private $retailerLevel;	//<uint8_t> 经销商等级，从易迅导入(版本>=0)
	private $icsonMemberLevel;	//<uint8_t> 易迅会员等级，从易迅导入(版本>=0)
	private $lastUpdateTime;	//<uint32_t> 最后修改时间(版本>=0)
	private $regTime;	//<uint32_t> 用户注册时间(版本>=0)
	private $reserveStr;	//<std::string> reserve string(版本>=0)
	private $reserveInt;	//<uint32_t> reserve int(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $wgUid_u;	//<uint8_t> (版本>=0)
	private $icsonUid_u;	//<uint8_t> (版本>=0)
	private $qQNumber_u;	//<uint8_t> (版本>=0)
	private $loginAccount_u;	//<uint8_t> (版本>=0)
	private $accountType_u;	//<uint8_t> (版本>=0)
	private $truename_u;	//<uint8_t> (版本>=0)
	private $nickname_u;	//<uint8_t> (版本>=0)
	private $bitProperty_u;	//<uint8_t> (版本>=0)
	private $userFlagLevel_u;	//<uint8_t> (版本>=0)
	private $sex_u;	//<uint8_t> (版本>=0)
	private $age_u;	//<uint8_t> (版本>=0)
	private $mobile_u;	//<uint8_t> (版本>=0)
	private $email_u;	//<uint8_t> (版本>=0)
	private $phone_u;	//<uint8_t> (版本>=0)
	private $fax_u;	//<uint8_t> (版本>=0)
	private $region_u;	//<uint8_t> (版本>=0)
	private $postcode_u;	//<uint8_t> (版本>=0)
	private $address_u;	//<uint8_t> (版本>=0)
	private $identityType_u;	//<uint8_t> (版本>=0)
	private $identityNum_u;	//<uint8_t> (版本>=0)
	private $buyerCredit_u;	//<uint8_t> (版本>=0)
	private $experience_u;	//<uint8_t> (版本>=0)
	private $cftAccount_u;	//<uint8_t> (版本>=0)
	private $loginLevel_u;	//<uint8_t> (版本>=0)
	private $userType_u;	//<uint8_t> (版本>=0)
	private $retailerLevel_u;	//<uint8_t> (版本>=0)
	private $icsonMemberLevel_u;	//<uint8_t> (版本>=0)
	private $lastUpdateTime_u;	//<uint8_t> (版本>=0)
	private $regTime_u;	//<uint8_t> (版本>=0)
	private $reserveStr_u;	//<uint8_t> (版本>=0)
	private $reserveInt_u;	//<uint8_t> (版本>=0)
	private $weChatId;	//<std::string> 微信号码(版本>=20130314)
	private $weChatId_u;	//<uint8_t> (版本>=20130314)
	private $virtualExpPoints;	//<uint32_t> 虚拟经验值(版本>=20130429)
	private $virtualExpPoints_u;	//<uint8_t> (版本>=20130429)

	function __construct(){
		$this->version = 20130429;	//<uint32_t>
		$this->wgUid = 0;	//<uint64_t>
		$this->icsonUid = 0;	//<uint64_t>
		$this->qQNumber = 0;	//<uint64_t>
		$this->loginAccount = "";	//<std::string>
		$this->accountType = 0;	//<uint8_t>
		$this->truename = "";	//<std::string>
		$this->nickname = "";	//<std::string>
		$this->bitProperty = new \stl_bitset2('128');	//<std::bitset<128> >
		$this->userFlagLevel = new \stl_map2('uint32_t,uint32_t');	//<std::map<uint32_t,uint32_t> >
		$this->sex = 0;	//<uint8_t>
		$this->age = 0;	//<uint8_t>
		$this->mobile = "";	//<std::string>
		$this->email = "";	//<std::string>
		$this->phone = "";	//<std::string>
		$this->fax = "";	//<std::string>
		$this->region = 0;	//<uint32_t>
		$this->postcode = "";	//<std::string>
		$this->address = "";	//<std::string>
		$this->identityType = 0;	//<uint8_t>
		$this->identityNum = "";	//<std::string>
		$this->buyerCredit = 0;	//<int>
		$this->experience = 0;	//<uint32_t>
		$this->cftAccount = "";	//<std::string>
		$this->loginLevel = 0;	//<uint8_t>
		$this->userType = 0;	//<uint8_t>
		$this->retailerLevel = 0;	//<uint8_t>
		$this->icsonMemberLevel = 0;	//<uint8_t>
		$this->lastUpdateTime = 0;	//<uint32_t>
		$this->regTime = 0;	//<uint32_t>
		$this->reserveStr = "";	//<std::string>
		$this->reserveInt = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->wgUid_u = 0;	//<uint8_t>
		$this->icsonUid_u = 0;	//<uint8_t>
		$this->qQNumber_u = 0;	//<uint8_t>
		$this->loginAccount_u = 0;	//<uint8_t>
		$this->accountType_u = 0;	//<uint8_t>
		$this->truename_u = 0;	//<uint8_t>
		$this->nickname_u = 0;	//<uint8_t>
		$this->bitProperty_u = 0;	//<uint8_t>
		$this->userFlagLevel_u = 0;	//<uint8_t>
		$this->sex_u = 0;	//<uint8_t>
		$this->age_u = 0;	//<uint8_t>
		$this->mobile_u = 0;	//<uint8_t>
		$this->email_u = 0;	//<uint8_t>
		$this->phone_u = 0;	//<uint8_t>
		$this->fax_u = 0;	//<uint8_t>
		$this->region_u = 0;	//<uint8_t>
		$this->postcode_u = 0;	//<uint8_t>
		$this->address_u = 0;	//<uint8_t>
		$this->identityType_u = 0;	//<uint8_t>
		$this->identityNum_u = 0;	//<uint8_t>
		$this->buyerCredit_u = 0;	//<uint8_t>
		$this->experience_u = 0;	//<uint8_t>
		$this->cftAccount_u = 0;	//<uint8_t>
		$this->loginLevel_u = 0;	//<uint8_t>
		$this->userType_u = 0;	//<uint8_t>
		$this->retailerLevel_u = 0;	//<uint8_t>
		$this->icsonMemberLevel_u = 0;	//<uint8_t>
		$this->lastUpdateTime_u = 0;	//<uint8_t>
		$this->regTime_u = 0;	//<uint8_t>
		$this->reserveStr_u = 0;	//<uint8_t>
		$this->reserveInt_u = 0;	//<uint8_t>
		$this->weChatId = "";	//<std::string>
		$this->weChatId_u = 0;	//<uint8_t>
		$this->virtualExpPoints = 0;	//<uint32_t>
		$this->virtualExpPoints_u = 0;	//<uint8_t>
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
			exit("\b2b2c\user\po\BuyerInfoPo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\user\po\BuyerInfoPo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 版本号
		$bs->pushUint64_t($this->wgUid);	//<uint64_t> 网购用户内部id，非QQ号，目前仅支持32位
		$bs->pushUint64_t($this->icsonUid);	//<uint64_t> 易迅用户内部id，目前仅支持32位
		$bs->pushUint64_t($this->qQNumber);	//<uint64_t> 绑定的用户QQ号，目前仅支持32位
		$bs->pushString($this->loginAccount);	//<std::string> 用户帐号名，包括易迅注册帐号、非qq帐号的第三方联合登录，如LoginAlipay+openid等字符串帐户名
		$bs->pushUint8_t($this->accountType);	//<uint8_t> 用户帐号类型，0-QQ号 1-个性化帐号，参见user_comm_define.h中的E_USER_LOGINNANE_TYPE
		$bs->pushString($this->truename);	//<std::string> 真实姓名
		$bs->pushString($this->nickname);	//<std::string> 昵称
		$bs->pushObject($this->bitProperty,'stl_bitset');	//<std::bitset<128> > 用户属性位BitSet，属性位代表的意义请参见b2b2c_define.h中的USER_PROPERTY
		$bs->pushObject($this->userFlagLevel,'stl_map');	//<std::map<uint32_t,uint32_t> > 用户属性级别，如彩钻级别，Map中第一个uint32_t表示用户属性位值，第二个uint32_t表示级别值
		$bs->pushUint8_t($this->sex);	//<uint8_t> 性别, 0-不明 1-男 2-女 参见user_comm_define.h中的E_USER_SEX
		$bs->pushUint8_t($this->age);	//<uint8_t> 年龄
		$bs->pushString($this->mobile);	//<std::string> 手机号，如绑定手机的用户属性位为1，则表示绑定的手机号
		$bs->pushString($this->email);	//<std::string> 电子邮箱，如绑定邮箱的用户属性位为1，则表示绑定的邮箱
		$bs->pushString($this->phone);	//<std::string> 固定电话
		$bs->pushString($this->fax);	//<std::string> 传真
		$bs->pushUint32_t($this->region);	//<uint32_t> 用户所在地区id
		$bs->pushString($this->postcode);	//<std::string> 邮政编码
		$bs->pushString($this->address);	//<std::string> 用户详细住址
		$bs->pushUint8_t($this->identityType);	//<uint8_t> 身份证件类型，1-身份证 参见user_comm_define.h中E_USER_IDTYPE
		$bs->pushString($this->identityNum);	//<std::string> 身份证件号码
		$bs->pushInt32_t($this->buyerCredit);	//<int> 用户信用值
		$bs->pushUint32_t($this->experience);	//<uint32_t> 用户经验值
		$bs->pushString($this->cftAccount);	//<std::string> 财付通账号
		$bs->pushUint8_t($this->loginLevel);	//<uint8_t> 登录级别，预留
		$bs->pushUint8_t($this->userType);	//<uint8_t> 用户类型，从易迅导入，参见user_comm_define.h中E_USER_TYPE
		$bs->pushUint8_t($this->retailerLevel);	//<uint8_t> 经销商等级，从易迅导入
		$bs->pushUint8_t($this->icsonMemberLevel);	//<uint8_t> 易迅会员等级，从易迅导入
		$bs->pushUint32_t($this->lastUpdateTime);	//<uint32_t> 最后修改时间
		$bs->pushUint32_t($this->regTime);	//<uint32_t> 用户注册时间
		$bs->pushString($this->reserveStr);	//<std::string> reserve string
		$bs->pushUint32_t($this->reserveInt);	//<uint32_t> reserve int
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->wgUid_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonUid_u);	//<uint8_t> 
		$bs->pushUint8_t($this->qQNumber_u);	//<uint8_t> 
		$bs->pushUint8_t($this->loginAccount_u);	//<uint8_t> 
		$bs->pushUint8_t($this->accountType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->truename_u);	//<uint8_t> 
		$bs->pushUint8_t($this->nickname_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bitProperty_u);	//<uint8_t> 
		$bs->pushUint8_t($this->userFlagLevel_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sex_u);	//<uint8_t> 
		$bs->pushUint8_t($this->age_u);	//<uint8_t> 
		$bs->pushUint8_t($this->mobile_u);	//<uint8_t> 
		$bs->pushUint8_t($this->email_u);	//<uint8_t> 
		$bs->pushUint8_t($this->phone_u);	//<uint8_t> 
		$bs->pushUint8_t($this->fax_u);	//<uint8_t> 
		$bs->pushUint8_t($this->region_u);	//<uint8_t> 
		$bs->pushUint8_t($this->postcode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->address_u);	//<uint8_t> 
		$bs->pushUint8_t($this->identityType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->identityNum_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerCredit_u);	//<uint8_t> 
		$bs->pushUint8_t($this->experience_u);	//<uint8_t> 
		$bs->pushUint8_t($this->cftAccount_u);	//<uint8_t> 
		$bs->pushUint8_t($this->loginLevel_u);	//<uint8_t> 
		$bs->pushUint8_t($this->userType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->retailerLevel_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonMemberLevel_u);	//<uint8_t> 
		$bs->pushUint8_t($this->lastUpdateTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->regTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserveStr_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reserveInt_u);	//<uint8_t> 
		if($this->version >= 20130314){
			$bs->pushString($this->weChatId);	//<std::string> 微信号码
		}
		if($this->version >= 20130314){
			$bs->pushUint8_t($this->weChatId_u);	//<uint8_t> 
		}
		if($this->version >= 20130429){
			$bs->pushUint32_t($this->virtualExpPoints);	//<uint32_t> 虚拟经验值
		}
		if($this->version >= 20130429){
			$bs->pushUint8_t($this->virtualExpPoints_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号
		$this->_arr_value['wgUid'] = $bs->popUint64_t();	//<uint64_t> 网购用户内部id，非QQ号，目前仅支持32位
		$this->_arr_value['icsonUid'] = $bs->popUint64_t();	//<uint64_t> 易迅用户内部id，目前仅支持32位
		$this->_arr_value['qQNumber'] = $bs->popUint64_t();	//<uint64_t> 绑定的用户QQ号，目前仅支持32位
		$this->_arr_value['loginAccount'] = $bs->popString();	//<std::string> 用户帐号名，包括易迅注册帐号、非qq帐号的第三方联合登录，如LoginAlipay+openid等字符串帐户名
		$this->_arr_value['accountType'] = $bs->popUint8_t();	//<uint8_t> 用户帐号类型，0-QQ号 1-个性化帐号，参见user_comm_define.h中的E_USER_LOGINNANE_TYPE
		$this->_arr_value['truename'] = $bs->popString();	//<std::string> 真实姓名
		$this->_arr_value['nickname'] = $bs->popString();	//<std::string> 昵称
		$this->_arr_value['bitProperty'] = $bs->popObject('stl_bitset<128>');	//<std::bitset<128> > 用户属性位BitSet，属性位代表的意义请参见b2b2c_define.h中的USER_PROPERTY
		$this->_arr_value['userFlagLevel'] = $bs->popObject('stl_map<uint32_t,uint32_t>');	//<std::map<uint32_t,uint32_t> > 用户属性级别，如彩钻级别，Map中第一个uint32_t表示用户属性位值，第二个uint32_t表示级别值
		$this->_arr_value['sex'] = $bs->popUint8_t();	//<uint8_t> 性别, 0-不明 1-男 2-女 参见user_comm_define.h中的E_USER_SEX
		$this->_arr_value['age'] = $bs->popUint8_t();	//<uint8_t> 年龄
		$this->_arr_value['mobile'] = $bs->popString();	//<std::string> 手机号，如绑定手机的用户属性位为1，则表示绑定的手机号
		$this->_arr_value['email'] = $bs->popString();	//<std::string> 电子邮箱，如绑定邮箱的用户属性位为1，则表示绑定的邮箱
		$this->_arr_value['phone'] = $bs->popString();	//<std::string> 固定电话
		$this->_arr_value['fax'] = $bs->popString();	//<std::string> 传真
		$this->_arr_value['region'] = $bs->popUint32_t();	//<uint32_t> 用户所在地区id
		$this->_arr_value['postcode'] = $bs->popString();	//<std::string> 邮政编码
		$this->_arr_value['address'] = $bs->popString();	//<std::string> 用户详细住址
		$this->_arr_value['identityType'] = $bs->popUint8_t();	//<uint8_t> 身份证件类型，1-身份证 参见user_comm_define.h中E_USER_IDTYPE
		$this->_arr_value['identityNum'] = $bs->popString();	//<std::string> 身份证件号码
		$this->_arr_value['buyerCredit'] = $bs->popInt32_t();	//<int> 用户信用值
		$this->_arr_value['experience'] = $bs->popUint32_t();	//<uint32_t> 用户经验值
		$this->_arr_value['cftAccount'] = $bs->popString();	//<std::string> 财付通账号
		$this->_arr_value['loginLevel'] = $bs->popUint8_t();	//<uint8_t> 登录级别，预留
		$this->_arr_value['userType'] = $bs->popUint8_t();	//<uint8_t> 用户类型，从易迅导入，参见user_comm_define.h中E_USER_TYPE
		$this->_arr_value['retailerLevel'] = $bs->popUint8_t();	//<uint8_t> 经销商等级，从易迅导入
		$this->_arr_value['icsonMemberLevel'] = $bs->popUint8_t();	//<uint8_t> 易迅会员等级，从易迅导入
		$this->_arr_value['lastUpdateTime'] = $bs->popUint32_t();	//<uint32_t> 最后修改时间
		$this->_arr_value['regTime'] = $bs->popUint32_t();	//<uint32_t> 用户注册时间
		$this->_arr_value['reserveStr'] = $bs->popString();	//<std::string> reserve string
		$this->_arr_value['reserveInt'] = $bs->popUint32_t();	//<uint32_t> reserve int
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['wgUid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonUid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['qQNumber_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['loginAccount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['accountType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['truename_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['nickname_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bitProperty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['userFlagLevel_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sex_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['age_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mobile_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['email_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['phone_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['fax_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['region_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['postcode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['address_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['identityType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['identityNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerCredit_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['experience_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cftAccount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['loginLevel_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['userType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['retailerLevel_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonMemberLevel_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['lastUpdateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['regTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserveStr_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserveInt_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 20130314){
			$this->_arr_value['weChatId'] = $bs->popString();	//<std::string> 微信号码
		}
		if($this->version >= 20130314){
			$this->_arr_value['weChatId_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 20130429){
			$this->_arr_value['virtualExpPoints'] = $bs->popUint32_t();	//<uint32_t> 虚拟经验值
		}
		if($this->version >= 20130429){
			$this->_arr_value['virtualExpPoints_u'] = $bs->popUint8_t();	//<uint8_t> 
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
