<?php
// source idl: com.b2b2c.user.idl.UserIcsonAo.java
require_once "usericsonao_xxo.php";

class AddBindInfoWithIcsonUidReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $authCode;
	var $icsonUid;
	var $BindInfoType;
	var $BindInfo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->authCode = ""; // std::string
		 $this->icsonUid = 0; // uint64_t
		 $this->BindInfoType = 0; // uint8_t
		 $this->BindInfo = ""; // std::string
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，保留，默认填0即可 类型为uint32_t
		$bs->pushString($this->authCode); // 序列化鉴权码，必需，具体请联系stonenie/silenchen获取 类型为std::string
		$bs->pushUint64_t($this->icsonUid); // 序列化易迅用户id，目前仅支持32位 类型为uint64_t
		$bs->pushUint8_t($this->BindInfoType); // 序列化绑定帐号类型，必需，0-无效值 1-email(填1则BindInfo填email地址) 2-手机号(填2则BindInfo填手机号)，参见user_comm_define.h中的E_ICSON_USER_BIND_ACCOUNT_TYPE 类型为uint8_t
		$bs->pushString($this->BindInfo); // 序列化绑定帐号名（目前支持email或手机号） 类型为std::string
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91826;
	}
}

class AddBindInfoWithIcsonUidResp {
	var $result;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0A98826;
	}
}

class CheckLoginByIcsonUidReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，保留，默认填0即可 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91842;
	}
}

class CheckLoginByIcsonUidResp {
	var $result;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0A98842;
	}
}

class GetSkeyReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $authCode;
	var $icsonUid;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->authCode = ""; // std::string
		 $this->icsonUid = 0; // uint64_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，保留，默认填0即可 类型为uint32_t
		$bs->pushString($this->authCode); // 序列化鉴权码，必需，具体请联系stonenie/silenchen获取 类型为std::string
		$bs->pushUint64_t($this->icsonUid); // 序列化易迅用户id，目前仅支持32位 类型为uint64_t
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91843;
	}
}

class GetSkeyResp {
	var $result;
	var $skey;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->skey = $bs->popString(); // 反序列化用户skey 类型为std::string
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0A98843;
	}
}

class GetUserInfoByBindInfoReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $BindInfoType;
	var $BindInfo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint32_t
		 $this->BindInfoType = 0; // uint8_t
		 $this->BindInfo = ""; // std::string
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，保留，默认填0即可 类型为uint32_t
		$bs->pushUint32_t($this->option); // 序列化选项掩码，保留，默认填0即可 类型为uint32_t
		$bs->pushUint8_t($this->BindInfoType); // 序列化绑定帐号类型，必需，0-无效值 1-email(填1则BindInfo填email地址) 2-手机号(填2则BindInfo填手机号)，参见user_comm_define.h中的E_ICSON_USER_BIND_ACCOUNT_TYPE 类型为uint8_t
		$bs->pushString($this->BindInfo); // 序列化绑定帐号名，目前支持email或手机号 类型为std::string
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91803;
	}
}

class GetUserInfoByBindInfoResp {
	var $result;
	var $buyerInfoPo;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->buyerInfoPo = $bs->popObject('BuyerInfoPo'); // 反序列化买家信息po 类型为b2b2c::user::po::CBuyerInfoPo
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0A98803;
	}
}

class GetUserInfoByIcsonUidReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $icsonUid;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint32_t
		 $this->icsonUid = 0; // uint64_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，0-取oidb属性失败不返回0；1-取oidb属性失败返回0，参见user_comm_define.h中的E_GET_USERINFO_SCENE 类型为uint32_t
		$bs->pushUint32_t($this->option); // 序列化选项掩码，0--默认值，不取用户oidb属性位，1--额外取用户oidb属性位(仅针对QQ用户)，具体参见user_comm_define.h中的E_GETUSER_OPTION 类型为uint32_t
		$bs->pushUint64_t($this->icsonUid); // 序列化易迅用户id，目前仅支持32位 类型为uint64_t
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91801;
	}
}

class GetUserInfoByIcsonUidResp {
	var $result;
	var $buyerInfoPo;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->buyerInfoPo = $bs->popObject('BuyerInfoPo'); // 反序列化买家信息po 类型为b2b2c::user::po::CBuyerInfoPo
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0A98801;
	}
}

class GetUserInfoByQQorAccountReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $option;
	var $accountType;
	var $qQNumber;
	var $loginAccount;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->option = 0; // uint32_t
		 $this->accountType = 0; // uint8_t
		 $this->qQNumber = 0; // uint64_t
		 $this->loginAccount = ""; // std::string
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，保留，默认填0即可 类型为uint32_t
		$bs->pushUint32_t($this->option); // 序列化选项掩码，保留，默认填0即可 类型为uint32_t
		$bs->pushUint8_t($this->accountType); // 序列化用户帐号类型，必需，0-无效值 1-QQ号(填1则QQNumber必填) 2-个性化帐号(填2则loginAccount必填)，参见user_comm_define.h中的E_ICSON_USER_ACCOUNT_TYPE 类型为uint8_t
		$bs->pushUint64_t($this->qQNumber); // 序列化用户QQ号，accountType填1时必填，目前仅支持32位 类型为uint64_t
		$bs->pushString($this->loginAccount); // 序列化个性登录帐号（如易迅注册帐号、LoginXXX+Openid等），accountType填2时必填 类型为std::string
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91802;
	}
}

class GetUserInfoByQQorAccountResp {
	var $result;
	var $buyerInfoPo;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->buyerInfoPo = $bs->popObject('BuyerInfoPo'); // 反序列化买家信息po 类型为b2b2c::user::po::CBuyerInfoPo
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0A98802;
	}
}

class GetWgUidByIcsonUidReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $icsonUid;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->icsonUid = 0; // uint64_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，保留，默认填0即可 类型为uint32_t
		$bs->pushUint64_t($this->icsonUid); // 序列化易迅用户id，目前仅支持32位 类型为uint64_t
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91806;
	}
}

class GetWgUidByIcsonUidResp {
	var $result;
	var $wgUid;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->wgUid = $bs->popUint64_t(); // 反序列化网购用户id，目前仅支持32位 类型为uint64_t
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0A98806;
	}
}

class IcsonUniformLoginReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $authCode;
	var $loginInfoPo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->authCode = ""; // std::string
		 $this->loginInfoPo = new LoginInfoPo(); // b2b2c::user::po::CLoginInfoPo
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，保留，默认填0即可 类型为uint32_t
		$bs->pushString($this->authCode); // 序列化鉴权码，必需，具体请联系stonenie/silenchen获取 类型为std::string
		$bs->pushObject($this->loginInfoPo,'LoginInfoPo'); // 序列化登录信息po 类型为b2b2c::user::po::CLoginInfoPo
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91845;
	}
}

class IcsonUniformLoginResp {
	var $result;
	var $icsonUid;
	var $skey;
	var $nickname;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->icsonUid = $bs->popUint64_t(); // 反序列化易迅用户id，目前仅支持32位 类型为uint64_t
		$this->skey = $bs->popString(); // 反序列化sessionKey，当accountType填1时输出为空 类型为std::string
		$this->nickname = $bs->popString(); // 反序列化用户昵称，当accountType填1时取的是oidb昵称 类型为std::string
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0A98845;
	}
}

class IcsonUserLoginReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $authCode;
	var $accountType;
	var $qQNumber;
	var $loginAccount;
	var $passwd;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->authCode = ""; // std::string
		 $this->accountType = 0; // uint8_t
		 $this->qQNumber = 0; // uint64_t
		 $this->loginAccount = ""; // std::string
		 $this->passwd = ""; // std::string
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，保留，默认填0即可 类型为uint32_t
		$bs->pushString($this->authCode); // 序列化鉴权码，必需，具体请联系stonenie/silenchen获取 类型为std::string
		$bs->pushUint8_t($this->accountType); // 序列化用户帐号类型，必需，0-无效值 1-QQ号(填1则QQNumber必填) 2-个性化帐号(填2则loginAccount必填)，参见user_comm_define.h中的E_ICSON_USER_ACCOUNT_TYPE 类型为uint8_t
		$bs->pushUint64_t($this->qQNumber); // 序列化用户QQ号，accountType填1时必填，目前仅支持32位 类型为uint64_t
		$bs->pushString($this->loginAccount); // 序列化个性登录帐号（如易迅注册帐号、LoginXXX+Openid等），accountType填2时必填 类型为std::string
		$bs->pushString($this->passwd); // 序列化个性化帐号登录密码，accountType填2时必填 类型为std::string
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91841;
	}
}

class IcsonUserLoginResp {
	var $result;
	var $icsonUid;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->icsonUid = $bs->popUint64_t(); // 反序列化易迅用户id，目前仅支持32位 类型为uint64_t
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0A98841;
	}
}

class IcsonUserLogoutReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $authCode;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->authCode = ""; // std::string
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，保留，默认填0即可 类型为uint32_t
		$bs->pushString($this->authCode); // 序列化鉴权码，必需，具体请联系stonenie/silenchen获取 类型为std::string
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91844;
	}
}

class IcsonUserLogoutResp {
	var $result;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0A98844;
	}
}

class IsBindInfoBindedReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $icsonUid;
	var $BindInfoType;
	var $BindInfo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->icsonUid = 0; // uint64_t
		 $this->BindInfoType = 0; // uint8_t
		 $this->BindInfo = ""; // std::string
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，保留，默认填0即可 类型为uint32_t
		$bs->pushUint64_t($this->icsonUid); // 序列化易迅用户id，目前仅支持32位 类型为uint64_t
		$bs->pushUint8_t($this->BindInfoType); // 序列化绑定帐号类型，必需，0-无效值 1-email(填1则BindInfo填email地址) 2-手机号(填2则BindInfo填手机号)，参见user_comm_define.h中的E_ICSON_USER_BIND_ACCOUNT_TYPE 类型为uint8_t
		$bs->pushString($this->BindInfo); // 序列化绑定帐号名（目前支持email或手机号） 类型为std::string
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91804;
	}
}

class IsBindInfoBindedResp {
	var $result;
	var $retValue;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->retValue = $bs->popUint8_t(); // 反序列化结果值，0-未绑定 1-已绑定 类型为uint8_t
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0A98804;
	}
}

class IsQQorAccountRegisteredReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $accountType;
	var $qQNumber;
	var $loginAccount;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->accountType = 0; // uint8_t
		 $this->qQNumber = 0; // uint64_t
		 $this->loginAccount = ""; // std::string
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，保留，默认填0即可 类型为uint32_t
		$bs->pushUint8_t($this->accountType); // 序列化用户帐号类型，必需，0-无效值 1-QQ号(填1则QQNumber必填) 2-个性化帐号(填2则loginAccount必填)，参见user_comm_define.h中的E_ICSON_USER_ACCOUNT_TYPE 类型为uint8_t
		$bs->pushUint64_t($this->qQNumber); // 序列化用户QQ号，accountType填1时必填，目前仅支持32位 类型为uint64_t
		$bs->pushString($this->loginAccount); // 序列化个性登录帐号（如易迅注册帐号、LoginXXX+Openid等），accountType填2时必填 类型为std::string
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91805;
	}
}

class IsQQorAccountRegisteredResp {
	var $result;
	var $retValue;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->retValue = $bs->popUint8_t(); // 反序列化结果值，0-未注册 1-已注册 类型为uint8_t
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0A98805;
	}
}

class ModifyAccountPasswdByIcsonUidReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $authCode;
	var $icsonUid;
	var $oldPasswd;
	var $newPasswd;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->authCode = ""; // std::string
		 $this->icsonUid = 0; // uint64_t
		 $this->oldPasswd = ""; // std::string
		 $this->newPasswd = ""; // std::string
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，保留，默认填0即可 类型为uint32_t
		$bs->pushString($this->authCode); // 序列化鉴权码，必需，具体请联系stonenie/silenchen获取 类型为std::string
		$bs->pushUint64_t($this->icsonUid); // 序列化易迅用户id，目前仅支持32位 类型为uint64_t
		$bs->pushString($this->oldPasswd); // 序列化个性化帐号的老登录密码 类型为std::string
		$bs->pushString($this->newPasswd); // 序列化个性化帐号的新登录密码 类型为std::string
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91824;
	}
}

class ModifyAccountPasswdByIcsonUidResp {
	var $result;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0A98824;
	}
}

class ModifyBasicUserInfoByIcsonUidReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $authCode;
	var $icsonUid;
	var $buyerInfoPo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->authCode = ""; // std::string
		 $this->icsonUid = 0; // uint64_t
		 $this->buyerInfoPo = new BuyerInfoPo(); // b2b2c::user::po::CBuyerInfoPo
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，保留，默认填0即可 类型为uint32_t
		$bs->pushString($this->authCode); // 序列化鉴权码，必需，具体请联系stonenie/silenchen获取 类型为std::string
		$bs->pushUint64_t($this->icsonUid); // 序列化易迅用户id，目前仅支持32位 类型为uint64_t
		$bs->pushObject($this->buyerInfoPo,'BuyerInfoPo'); // 序列化买家信息po 类型为b2b2c::user::po::CBuyerInfoPo
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91821;
	}
}

class ModifyBasicUserInfoByIcsonUidResp {
	var $result;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0A98821;
	}
}

class ModifyExperienceByIcsonUidReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $authCode;
	var $icsonUid;
	var $experience;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->authCode = ""; // std::string
		 $this->icsonUid = 0; // uint64_t
		 $this->experience = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，保留，默认填0即可 类型为uint32_t
		$bs->pushString($this->authCode); // 序列化鉴权码，必需，具体请联系stonenie/silenchen获取 类型为std::string
		$bs->pushUint64_t($this->icsonUid); // 序列化易迅用户id，目前仅支持32位 类型为uint64_t
		$bs->pushUint32_t($this->experience); // 序列化用户经验值 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91822;
	}
}

class ModifyExperienceByIcsonUidResp {
	var $result;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0A98822;
	}
}

class ModifyIcsonMemberLevelByIcsonUidReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $authCode;
	var $icsonUid;
	var $icsonMemberLevel;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->authCode = ""; // std::string
		 $this->icsonUid = 0; // uint64_t
		 $this->icsonMemberLevel = 0; // uint32_t
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，保留，默认填0即可 类型为uint32_t
		$bs->pushString($this->authCode); // 序列化鉴权码，必需，具体请联系stonenie/silenchen获取 类型为std::string
		$bs->pushUint64_t($this->icsonUid); // 序列化易迅用户id，目前仅支持32位 类型为uint64_t
		$bs->pushUint32_t($this->icsonMemberLevel); // 序列化易迅会员等级 类型为uint32_t
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91823;
	}
}

class ModifyIcsonMemberLevelByIcsonUidResp {
	var $result;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0A98823;
	}
}

class RemoveBindInfoWithIcsonUidReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $authCode;
	var $icsonUid;
	var $BindInfoType;
	var $BindInfo;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->authCode = ""; // std::string
		 $this->icsonUid = 0; // uint64_t
		 $this->BindInfoType = 0; // uint8_t
		 $this->BindInfo = ""; // std::string
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，保留，默认填0即可 类型为uint32_t
		$bs->pushString($this->authCode); // 序列化鉴权码，必需，具体请联系stonenie/silenchen获取 类型为std::string
		$bs->pushUint64_t($this->icsonUid); // 序列化易迅用户id，目前仅支持32位 类型为uint64_t
		$bs->pushUint8_t($this->BindInfoType); // 序列化绑定帐号类型，必需，0-无效值 1-email(填1则BindInfo填email地址) 2-手机号(填2则BindInfo填手机号)，参见user_comm_define.h中的E_ICSON_USER_BIND_ACCOUNT_TYPE 类型为uint8_t
		$bs->pushString($this->BindInfo); // 序列化绑定帐号名（目前支持email或手机号） 类型为std::string
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91827;
	}
}

class RemoveBindInfoWithIcsonUidResp {
	var $result;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0A98827;
	}
}

class ResetAccountPasswdByIcsonUidReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $authCode;
	var $icsonUid;
	var $initPasswd;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->authCode = ""; // std::string
		 $this->icsonUid = 0; // uint64_t
		 $this->initPasswd = ""; // std::string
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，保留，默认填0即可 类型为uint32_t
		$bs->pushString($this->authCode); // 序列化鉴权码，必需，具体请联系stonenie/silenchen获取 类型为std::string
		$bs->pushUint64_t($this->icsonUid); // 序列化易迅用户id，目前仅支持32位 类型为uint64_t
		$bs->pushString($this->initPasswd); // 序列化重置后的登录密码 类型为std::string
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91825;
	}
}

class ResetAccountPasswdByIcsonUidResp {
	var $result;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0A98825;
	}
}

class UserRegisterReq {
	var $machineKey;
	var $source;
	var $sceneId;
	var $authCode;
	var $accountType;
	var $qQNumber;
	var $loginAccount;
	var $passwd;
	var $inReserve;

	function __construct() {
		 $this->machineKey = ""; // std::string
		 $this->source = ""; // std::string
		 $this->sceneId = 0; // uint32_t
		 $this->authCode = ""; // std::string
		 $this->accountType = 0; // uint8_t
		 $this->qQNumber = 0; // uint64_t
		 $this->loginAccount = ""; // std::string
		 $this->passwd = ""; // std::string
		 $this->inReserve = ""; // std::string
	}	

	function Serialize(&$bs){
		$bs->pushString($this->machineKey); // 序列化机器码，必需 类型为std::string
		$bs->pushString($this->source); // 序列化调用来源，必需 类型为std::string
		$bs->pushUint32_t($this->sceneId); // 序列化场景id，保留，默认填0即可 类型为uint32_t
		$bs->pushString($this->authCode); // 序列化鉴权码，必需，具体请联系stonenie/silenchen获取 类型为std::string
		$bs->pushUint8_t($this->accountType); // 序列化用户帐号类型，必需，0-无效值 1-QQ号(填1则QQNumber必填) 2-个性化帐号(填2则loginAccount必填)，参见user_comm_define.h中的E_ICSON_USER_ACCOUNT_TYPE 类型为uint8_t
		$bs->pushUint64_t($this->qQNumber); // 序列化用户QQ号，accountType填1时必填，目前仅支持32位 类型为uint64_t
		$bs->pushString($this->loginAccount); // 序列化个性登录帐号（如易迅注册帐号、LoginXXX+Openid等），accountType填2时必填 类型为std::string
		$bs->pushString($this->passwd); // 序列化个性化帐号登录密码 类型为std::string
		$bs->pushString($this->inReserve); // 序列化输入保留字 类型为std::string

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xA0A91828;
	}
}

class UserRegisterResp {
	var $result;
	var $icsonUid;
	var $errmsg;
	var $outReserve;

	function Unserialize(&$bs){
		$this->result = $bs->popUint32_t();
		$this->icsonUid = $bs->popUint64_t(); // 反序列化易迅用户id，目前仅支持32位 类型为uint64_t
		$this->errmsg = $bs->popString(); // 反序列化错误提示信息 类型为std::string
		$this->outReserve = $bs->popString(); // 反序列化输出保留字 类型为std::string

	
		return $bs->isGood();
	}

	function getCmdId() {
		return 0xA0A98828;
	}
}
?>