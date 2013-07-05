<?php

//source idl: com.b2b2c.user.idl.IcsonUniformLoginReq.java

if (!class_exists('LoginInfoPo',false)) {
class LoginInfoPo
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 登录来源，参见user_comm_define.h中的E_LOGIN_FROM_TYPE
		 *
		 * 版本 >= 0
		 */
		var $dwLoginFrom; //uint32_t

		/**
		 * 登录强度类型，0--默认，普通登录 1--弱登录，参见user_comm_define.h中的E_LOGIN_INTENSITY_TYPE
		 *
		 * 版本 >= 0
		 */
		var $dwLoginIntensityType; //uint32_t

		/**
		 * 用户登录帐号类型，必需，0-无效值 1-QQ号(填1则QQNumber和QQSkey必填，或loginAccount填Login_QQ_*) 2-个性化帐号(填2则loginAccount和passwd必填) 3-openid(填3则openid和openidFrom必填)，参见user_comm_define.h中的E_ICSON_USER_ACCOUNT_TYPE
		 *
		 * 版本 >= 0
		 */
		var $dwAccountType; //uint32_t

		/**
		 * 用户QQ号，accountType填1时必填（除了loginAccount填Login_QQ_*情形），目前仅支持32位
		 *
		 * 版本 >= 0
		 */
		var $ddwQQNumber; //uint64_t

		/**
		 * QQ号用户的skey，accountType填1时必填（除了loginAccount填Login_QQ_*情形）
		 *
		 * 版本 >= 0
		 */
		var $strQQSkey; //std::string

		/**
		 * 登录帐号（如Login_QQ_*、易迅注册帐号、LoginXXX+Openid等），accountType填2时必填
		 *
		 * 版本 >= 0
		 */
		var $strLoginAccount; //std::string

		/**
		 * 个性化帐号登录密码，accountType填2时必填
		 *
		 * 版本 >= 0
		 */
		var $strPasswd; //std::string

		/**
		 * Openid值，accountType填3时必填
		 *
		 * 版本 >= 0
		 */
		var $strOpenid; //std::string

		/**
		 * openid来源，参见user_comm_define.h中的E_LOGIN_OPENID_FROM
		 *
		 * 版本 >= 0
		 */
		var $dwOpenidFrom; //uint32_t

		/**
		 * reserve int
		 *
		 * 版本 >= 0
		 */
		var $dwReserveInt; //uint32_t

		/**
		 * reserve string
		 *
		 * 版本 >= 0
		 */
		var $strReserveStr; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cLoginFrom_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cLoginIntensityType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cAccountType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cQQNumber_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cQQSkey_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cLoginAccount_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPasswd_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOpenid_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOpenidFrom_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserveInt_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserveStr_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->dwLoginFrom = 0; // uint32_t
			 $this->dwLoginIntensityType = 0; // uint32_t
			 $this->dwAccountType = 0; // uint32_t
			 $this->ddwQQNumber = 0; // uint64_t
			 $this->strQQSkey = ""; // std::string
			 $this->strLoginAccount = ""; // std::string
			 $this->strPasswd = ""; // std::string
			 $this->strOpenid = ""; // std::string
			 $this->dwOpenidFrom = 0; // uint32_t
			 $this->dwReserveInt = 0; // uint32_t
			 $this->strReserveStr = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cLoginFrom_u = 0; // uint8_t
			 $this->cLoginIntensityType_u = 0; // uint8_t
			 $this->cAccountType_u = 0; // uint8_t
			 $this->cQQNumber_u = 0; // uint8_t
			 $this->cQQSkey_u = 0; // uint8_t
			 $this->cLoginAccount_u = 0; // uint8_t
			 $this->cPasswd_u = 0; // uint8_t
			 $this->cOpenid_u = 0; // uint8_t
			 $this->cOpenidFrom_u = 0; // uint8_t
			 $this->cReserveInt_u = 0; // uint8_t
			 $this->cReserveStr_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号 类型为uint32_t
			$bs->pushUint32_t($this->dwLoginFrom); // 序列化登录来源，参见user_comm_define.h中的E_LOGIN_FROM_TYPE 类型为uint32_t
			$bs->pushUint32_t($this->dwLoginIntensityType); // 序列化登录强度类型，0--默认，普通登录 1--弱登录，参见user_comm_define.h中的E_LOGIN_INTENSITY_TYPE 类型为uint32_t
			$bs->pushUint32_t($this->dwAccountType); // 序列化用户登录帐号类型，必需，0-无效值 1-QQ号(填1则QQNumber和QQSkey必填，或loginAccount填Login_QQ_*) 2-个性化帐号(填2则loginAccount和passwd必填) 3-openid(填3则openid和openidFrom必填)，参见user_comm_define.h中的E_ICSON_USER_ACCOUNT_TYPE 类型为uint32_t
			$bs->pushUint64_t($this->ddwQQNumber); // 序列化用户QQ号，accountType填1时必填（除了loginAccount填Login_QQ_*情形），目前仅支持32位 类型为uint64_t
			$bs->pushString($this->strQQSkey); // 序列化QQ号用户的skey，accountType填1时必填（除了loginAccount填Login_QQ_*情形） 类型为std::string
			$bs->pushString($this->strLoginAccount); // 序列化登录帐号（如Login_QQ_*、易迅注册帐号、LoginXXX+Openid等），accountType填2时必填 类型为std::string
			$bs->pushString($this->strPasswd); // 序列化个性化帐号登录密码，accountType填2时必填 类型为std::string
			$bs->pushString($this->strOpenid); // 序列化Openid值，accountType填3时必填 类型为std::string
			$bs->pushUint32_t($this->dwOpenidFrom); // 序列化openid来源，参见user_comm_define.h中的E_LOGIN_OPENID_FROM 类型为uint32_t
			$bs->pushUint32_t($this->dwReserveInt); // 序列化reserve int 类型为uint32_t
			$bs->pushString($this->strReserveStr); // 序列化reserve string 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cLoginFrom_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cLoginIntensityType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cAccountType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cQQNumber_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cQQSkey_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cLoginAccount_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPasswd_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOpenid_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOpenidFrom_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserveInt_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserveStr_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号 类型为uint32_t
			$this->dwLoginFrom = $bs->popUint32_t(); // 反序列化登录来源，参见user_comm_define.h中的E_LOGIN_FROM_TYPE 类型为uint32_t
			$this->dwLoginIntensityType = $bs->popUint32_t(); // 反序列化登录强度类型，0--默认，普通登录 1--弱登录，参见user_comm_define.h中的E_LOGIN_INTENSITY_TYPE 类型为uint32_t
			$this->dwAccountType = $bs->popUint32_t(); // 反序列化用户登录帐号类型，必需，0-无效值 1-QQ号(填1则QQNumber和QQSkey必填，或loginAccount填Login_QQ_*) 2-个性化帐号(填2则loginAccount和passwd必填) 3-openid(填3则openid和openidFrom必填)，参见user_comm_define.h中的E_ICSON_USER_ACCOUNT_TYPE 类型为uint32_t
			$this->ddwQQNumber = $bs->popUint64_t(); // 反序列化用户QQ号，accountType填1时必填（除了loginAccount填Login_QQ_*情形），目前仅支持32位 类型为uint64_t
			$this->strQQSkey = $bs->popString(); // 反序列化QQ号用户的skey，accountType填1时必填（除了loginAccount填Login_QQ_*情形） 类型为std::string
			$this->strLoginAccount = $bs->popString(); // 反序列化登录帐号（如Login_QQ_*、易迅注册帐号、LoginXXX+Openid等），accountType填2时必填 类型为std::string
			$this->strPasswd = $bs->popString(); // 反序列化个性化帐号登录密码，accountType填2时必填 类型为std::string
			$this->strOpenid = $bs->popString(); // 反序列化Openid值，accountType填3时必填 类型为std::string
			$this->dwOpenidFrom = $bs->popUint32_t(); // 反序列化openid来源，参见user_comm_define.h中的E_LOGIN_OPENID_FROM 类型为uint32_t
			$this->dwReserveInt = $bs->popUint32_t(); // 反序列化reserve int 类型为uint32_t
			$this->strReserveStr = $bs->popString(); // 反序列化reserve string 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cLoginFrom_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cLoginIntensityType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cAccountType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cQQNumber_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cQQSkey_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cLoginAccount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPasswd_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOpenid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOpenidFrom_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserveInt_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserveStr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

			/**********************为了支持多个版本的客户端************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************为了支持多个版本的客户端************************/
			

			return $this;
		}

		 function getClassLen() {
			$len_bs = new ByteStream();
			$len_bs->setRealWrite(false);
			$this->serialize_internal($len_bs);
			$class_len = $len_bs->getWrittenLength();

			return $class_len;
		}

}
}


//source idl: com.b2b2c.user.idl.UserIcsonAo.java

if (!class_exists('BuyerInfoPo',false)) {
class BuyerInfoPo
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 网购用户内部id，非QQ号，目前仅支持32位
		 *
		 * 版本 >= 0
		 */
		var $ddwWgUid; //uint64_t

		/**
		 * 易迅用户内部id，目前仅支持32位
		 *
		 * 版本 >= 0
		 */
		var $ddwIcsonUid; //uint64_t

		/**
		 * 绑定的用户QQ号，目前仅支持32位
		 *
		 * 版本 >= 0
		 */
		var $ddwQQNumber; //uint64_t

		/**
		 * 用户帐号名，包括易迅注册帐号、非qq帐号的第三方联合登录，如LoginAlipay+openid等字符串帐户名
		 *
		 * 版本 >= 0
		 */
		var $strLoginAccount; //std::string

		/**
		 * 用户帐号类型，0-QQ号 1-个性化帐号，参见user_comm_define.h中的E_USER_LOGINNANE_TYPE
		 *
		 * 版本 >= 0
		 */
		var $cAccountType; //uint8_t

		/**
		 * 真实姓名
		 *
		 * 版本 >= 0
		 */
		var $strTruename; //std::string

		/**
		 * 昵称
		 *
		 * 版本 >= 0
		 */
		var $strNickname; //std::string

		/**
		 * 用户属性位BitSet，属性位代表的意义请参见b2b2c_define.h中的USER_PROPERTY
		 *
		 * 版本 >= 0
		 */
		var $bitsetBitProperty; //std::bitset<128> 

		/**
		 * 用户属性级别，如彩钻级别，Map中第一个uint32_t表示用户属性位值，第二个uint32_t表示级别值
		 *
		 * 版本 >= 0
		 */
		var $mapUserFlagLevel; //std::map<uint32_t,uint32_t> 

		/**
		 * 性别, 0-不明 1-男 2-女 参见user_comm_define.h中的E_USER_SEX
		 *
		 * 版本 >= 0
		 */
		var $cSex; //uint8_t

		/**
		 * 年龄
		 *
		 * 版本 >= 0
		 */
		var $cAge; //uint8_t

		/**
		 * 手机号，如绑定手机的用户属性位为1，则表示绑定的手机号
		 *
		 * 版本 >= 0
		 */
		var $strMobile; //std::string

		/**
		 * 电子邮箱，如绑定邮箱的用户属性位为1，则表示绑定的邮箱
		 *
		 * 版本 >= 0
		 */
		var $strEmail; //std::string

		/**
		 * 固定电话
		 *
		 * 版本 >= 0
		 */
		var $strPhone; //std::string

		/**
		 * 传真
		 *
		 * 版本 >= 0
		 */
		var $strFax; //std::string

		/**
		 * 用户所在地区id
		 *
		 * 版本 >= 0
		 */
		var $dwRegion; //uint32_t

		/**
		 * 邮政编码
		 *
		 * 版本 >= 0
		 */
		var $strPostcode; //std::string

		/**
		 * 用户详细住址
		 *
		 * 版本 >= 0
		 */
		var $strAddress; //std::string

		/**
		 * 身份证件类型，1-身份证 参见user_comm_define.h中E_USER_IDTYPE
		 *
		 * 版本 >= 0
		 */
		var $cIdentityType; //uint8_t

		/**
		 * 身份证件号码
		 *
		 * 版本 >= 0
		 */
		var $strIdentityNum; //std::string

		/**
		 * 用户信用值
		 *
		 * 版本 >= 0
		 */
		var $nBuyerCredit; //int

		/**
		 * 用户经验值
		 *
		 * 版本 >= 0
		 */
		var $dwExperience; //uint32_t

		/**
		 * 财付通账号
		 *
		 * 版本 >= 0
		 */
		var $strCftAccount; //std::string

		/**
		 * 登录级别，预留
		 *
		 * 版本 >= 0
		 */
		var $cLoginLevel; //uint8_t

		/**
		 * 用户类型，从易迅导入，参见user_comm_define.h中E_USER_TYPE
		 *
		 * 版本 >= 0
		 */
		var $cUserType; //uint8_t

		/**
		 * 经销商等级，从易迅导入
		 *
		 * 版本 >= 0
		 */
		var $cRetailerLevel; //uint8_t

		/**
		 * 易迅会员等级，从易迅导入
		 *
		 * 版本 >= 0
		 */
		var $cIcsonMemberLevel; //uint8_t

		/**
		 * 最后修改时间
		 *
		 * 版本 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * 用户注册时间
		 *
		 * 版本 >= 0
		 */
		var $dwRegTime; //uint32_t

		/**
		 * reserve string
		 *
		 * 版本 >= 0
		 */
		var $strReserveStr; //std::string

		/**
		 * reserve int
		 *
		 * 版本 >= 0
		 */
		var $dwReserveInt; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cWgUid_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonUid_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cQQNumber_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cLoginAccount_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cAccountType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTruename_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cNickname_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBitProperty_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cUserFlagLevel_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSex_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cAge_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cMobile_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cEmail_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPhone_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cFax_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRegion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPostcode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cAddress_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIdentityType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIdentityNum_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerCredit_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExperience_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCftAccount_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cLoginLevel_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cUserType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRetailerLevel_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonMemberLevel_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRegTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserveStr_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserveInt_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->ddwWgUid = 0; // uint64_t
			 $this->ddwIcsonUid = 0; // uint64_t
			 $this->ddwQQNumber = 0; // uint64_t
			 $this->strLoginAccount = ""; // std::string
			 $this->cAccountType = 0; // uint8_t
			 $this->strTruename = ""; // std::string
			 $this->strNickname = ""; // std::string
			 $this->bitsetBitProperty = new stl_bitset('128'); // std::bitset<128> 
			 $this->mapUserFlagLevel = new stl_map('uint32_t,uint32_t'); // std::map<uint32_t,uint32_t> 
			 $this->cSex = 0; // uint8_t
			 $this->cAge = 0; // uint8_t
			 $this->strMobile = ""; // std::string
			 $this->strEmail = ""; // std::string
			 $this->strPhone = ""; // std::string
			 $this->strFax = ""; // std::string
			 $this->dwRegion = 0; // uint32_t
			 $this->strPostcode = ""; // std::string
			 $this->strAddress = ""; // std::string
			 $this->cIdentityType = 0; // uint8_t
			 $this->strIdentityNum = ""; // std::string
			 $this->nBuyerCredit = 0; // int
			 $this->dwExperience = 0; // uint32_t
			 $this->strCftAccount = ""; // std::string
			 $this->cLoginLevel = 0; // uint8_t
			 $this->cUserType = 0; // uint8_t
			 $this->cRetailerLevel = 0; // uint8_t
			 $this->cIcsonMemberLevel = 0; // uint8_t
			 $this->dwLastUpdateTime = 0; // uint32_t
			 $this->dwRegTime = 0; // uint32_t
			 $this->strReserveStr = ""; // std::string
			 $this->dwReserveInt = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->cWgUid_u = 0; // uint8_t
			 $this->cIcsonUid_u = 0; // uint8_t
			 $this->cQQNumber_u = 0; // uint8_t
			 $this->cLoginAccount_u = 0; // uint8_t
			 $this->cAccountType_u = 0; // uint8_t
			 $this->cTruename_u = 0; // uint8_t
			 $this->cNickname_u = 0; // uint8_t
			 $this->cBitProperty_u = 0; // uint8_t
			 $this->cUserFlagLevel_u = 0; // uint8_t
			 $this->cSex_u = 0; // uint8_t
			 $this->cAge_u = 0; // uint8_t
			 $this->cMobile_u = 0; // uint8_t
			 $this->cEmail_u = 0; // uint8_t
			 $this->cPhone_u = 0; // uint8_t
			 $this->cFax_u = 0; // uint8_t
			 $this->cRegion_u = 0; // uint8_t
			 $this->cPostcode_u = 0; // uint8_t
			 $this->cAddress_u = 0; // uint8_t
			 $this->cIdentityType_u = 0; // uint8_t
			 $this->cIdentityNum_u = 0; // uint8_t
			 $this->cBuyerCredit_u = 0; // uint8_t
			 $this->cExperience_u = 0; // uint8_t
			 $this->cCftAccount_u = 0; // uint8_t
			 $this->cLoginLevel_u = 0; // uint8_t
			 $this->cUserType_u = 0; // uint8_t
			 $this->cRetailerLevel_u = 0; // uint8_t
			 $this->cIcsonMemberLevel_u = 0; // uint8_t
			 $this->cLastUpdateTime_u = 0; // uint8_t
			 $this->cRegTime_u = 0; // uint8_t
			 $this->cReserveStr_u = 0; // uint8_t
			 $this->cReserveInt_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号 类型为uint32_t
			$bs->pushUint64_t($this->ddwWgUid); // 序列化网购用户内部id，非QQ号，目前仅支持32位 类型为uint64_t
			$bs->pushUint64_t($this->ddwIcsonUid); // 序列化易迅用户内部id，目前仅支持32位 类型为uint64_t
			$bs->pushUint64_t($this->ddwQQNumber); // 序列化绑定的用户QQ号，目前仅支持32位 类型为uint64_t
			$bs->pushString($this->strLoginAccount); // 序列化用户帐号名，包括易迅注册帐号、非qq帐号的第三方联合登录，如LoginAlipay+openid等字符串帐户名 类型为std::string
			$bs->pushUint8_t($this->cAccountType); // 序列化用户帐号类型，0-QQ号 1-个性化帐号，参见user_comm_define.h中的E_USER_LOGINNANE_TYPE 类型为uint8_t
			$bs->pushString($this->strTruename); // 序列化真实姓名 类型为std::string
			$bs->pushString($this->strNickname); // 序列化昵称 类型为std::string
			$bs->pushObject($this->bitsetBitProperty,'stl_bitset'); // 序列化用户属性位BitSet，属性位代表的意义请参见b2b2c_define.h中的USER_PROPERTY 类型为std::bitset<128> 
			$bs->pushObject($this->mapUserFlagLevel,'stl_map'); // 序列化用户属性级别，如彩钻级别，Map中第一个uint32_t表示用户属性位值，第二个uint32_t表示级别值 类型为std::map<uint32_t,uint32_t> 
			$bs->pushUint8_t($this->cSex); // 序列化性别, 0-不明 1-男 2-女 参见user_comm_define.h中的E_USER_SEX 类型为uint8_t
			$bs->pushUint8_t($this->cAge); // 序列化年龄 类型为uint8_t
			$bs->pushString($this->strMobile); // 序列化手机号，如绑定手机的用户属性位为1，则表示绑定的手机号 类型为std::string
			$bs->pushString($this->strEmail); // 序列化电子邮箱，如绑定邮箱的用户属性位为1，则表示绑定的邮箱 类型为std::string
			$bs->pushString($this->strPhone); // 序列化固定电话 类型为std::string
			$bs->pushString($this->strFax); // 序列化传真 类型为std::string
			$bs->pushUint32_t($this->dwRegion); // 序列化用户所在地区id 类型为uint32_t
			$bs->pushString($this->strPostcode); // 序列化邮政编码 类型为std::string
			$bs->pushString($this->strAddress); // 序列化用户详细住址 类型为std::string
			$bs->pushUint8_t($this->cIdentityType); // 序列化身份证件类型，1-身份证 参见user_comm_define.h中E_USER_IDTYPE 类型为uint8_t
			$bs->pushString($this->strIdentityNum); // 序列化身份证件号码 类型为std::string
			$bs->pushInt32_t($this->nBuyerCredit); // 序列化用户信用值 类型为int
			$bs->pushUint32_t($this->dwExperience); // 序列化用户经验值 类型为uint32_t
			$bs->pushString($this->strCftAccount); // 序列化财付通账号 类型为std::string
			$bs->pushUint8_t($this->cLoginLevel); // 序列化登录级别，预留 类型为uint8_t
			$bs->pushUint8_t($this->cUserType); // 序列化用户类型，从易迅导入，参见user_comm_define.h中E_USER_TYPE 类型为uint8_t
			$bs->pushUint8_t($this->cRetailerLevel); // 序列化经销商等级，从易迅导入 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonMemberLevel); // 序列化易迅会员等级，从易迅导入 类型为uint8_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // 序列化最后修改时间 类型为uint32_t
			$bs->pushUint32_t($this->dwRegTime); // 序列化用户注册时间 类型为uint32_t
			$bs->pushString($this->strReserveStr); // 序列化reserve string 类型为std::string
			$bs->pushUint32_t($this->dwReserveInt); // 序列化reserve int 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cWgUid_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonUid_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cQQNumber_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cLoginAccount_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cAccountType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTruename_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cNickname_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBitProperty_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cUserFlagLevel_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSex_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cAge_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cMobile_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cEmail_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPhone_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cFax_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRegion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPostcode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cAddress_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIdentityType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIdentityNum_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerCredit_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExperience_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCftAccount_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cLoginLevel_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cUserType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRetailerLevel_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonMemberLevel_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRegTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserveStr_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserveInt_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号 类型为uint32_t
			$this->ddwWgUid = $bs->popUint64_t(); // 反序列化网购用户内部id，非QQ号，目前仅支持32位 类型为uint64_t
			$this->ddwIcsonUid = $bs->popUint64_t(); // 反序列化易迅用户内部id，目前仅支持32位 类型为uint64_t
			$this->ddwQQNumber = $bs->popUint64_t(); // 反序列化绑定的用户QQ号，目前仅支持32位 类型为uint64_t
			$this->strLoginAccount = $bs->popString(); // 反序列化用户帐号名，包括易迅注册帐号、非qq帐号的第三方联合登录，如LoginAlipay+openid等字符串帐户名 类型为std::string
			$this->cAccountType = $bs->popUint8_t(); // 反序列化用户帐号类型，0-QQ号 1-个性化帐号，参见user_comm_define.h中的E_USER_LOGINNANE_TYPE 类型为uint8_t
			$this->strTruename = $bs->popString(); // 反序列化真实姓名 类型为std::string
			$this->strNickname = $bs->popString(); // 反序列化昵称 类型为std::string
			$this->bitsetBitProperty = $bs->popObject('stl_bitset<128>'); // 反序列化用户属性位BitSet，属性位代表的意义请参见b2b2c_define.h中的USER_PROPERTY 类型为std::bitset<128> 
			$this->mapUserFlagLevel = $bs->popObject('stl_map<uint32_t,uint32_t>'); // 反序列化用户属性级别，如彩钻级别，Map中第一个uint32_t表示用户属性位值，第二个uint32_t表示级别值 类型为std::map<uint32_t,uint32_t> 
			$this->cSex = $bs->popUint8_t(); // 反序列化性别, 0-不明 1-男 2-女 参见user_comm_define.h中的E_USER_SEX 类型为uint8_t
			$this->cAge = $bs->popUint8_t(); // 反序列化年龄 类型为uint8_t
			$this->strMobile = $bs->popString(); // 反序列化手机号，如绑定手机的用户属性位为1，则表示绑定的手机号 类型为std::string
			$this->strEmail = $bs->popString(); // 反序列化电子邮箱，如绑定邮箱的用户属性位为1，则表示绑定的邮箱 类型为std::string
			$this->strPhone = $bs->popString(); // 反序列化固定电话 类型为std::string
			$this->strFax = $bs->popString(); // 反序列化传真 类型为std::string
			$this->dwRegion = $bs->popUint32_t(); // 反序列化用户所在地区id 类型为uint32_t
			$this->strPostcode = $bs->popString(); // 反序列化邮政编码 类型为std::string
			$this->strAddress = $bs->popString(); // 反序列化用户详细住址 类型为std::string
			$this->cIdentityType = $bs->popUint8_t(); // 反序列化身份证件类型，1-身份证 参见user_comm_define.h中E_USER_IDTYPE 类型为uint8_t
			$this->strIdentityNum = $bs->popString(); // 反序列化身份证件号码 类型为std::string
			$this->nBuyerCredit = $bs->popInt32_t(); // 反序列化用户信用值 类型为int
			$this->dwExperience = $bs->popUint32_t(); // 反序列化用户经验值 类型为uint32_t
			$this->strCftAccount = $bs->popString(); // 反序列化财付通账号 类型为std::string
			$this->cLoginLevel = $bs->popUint8_t(); // 反序列化登录级别，预留 类型为uint8_t
			$this->cUserType = $bs->popUint8_t(); // 反序列化用户类型，从易迅导入，参见user_comm_define.h中E_USER_TYPE 类型为uint8_t
			$this->cRetailerLevel = $bs->popUint8_t(); // 反序列化经销商等级，从易迅导入 类型为uint8_t
			$this->cIcsonMemberLevel = $bs->popUint8_t(); // 反序列化易迅会员等级，从易迅导入 类型为uint8_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // 反序列化最后修改时间 类型为uint32_t
			$this->dwRegTime = $bs->popUint32_t(); // 反序列化用户注册时间 类型为uint32_t
			$this->strReserveStr = $bs->popString(); // 反序列化reserve string 类型为std::string
			$this->dwReserveInt = $bs->popUint32_t(); // 反序列化reserve int 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cWgUid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonUid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cQQNumber_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cLoginAccount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cAccountType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTruename_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cNickname_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBitProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cUserFlagLevel_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSex_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cAge_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cMobile_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cEmail_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPhone_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cFax_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRegion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPostcode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cAddress_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIdentityType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIdentityNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerCredit_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExperience_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCftAccount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cLoginLevel_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cUserType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRetailerLevel_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonMemberLevel_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRegTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserveStr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserveInt_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

			/**********************为了支持多个版本的客户端************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************为了支持多个版本的客户端************************/
			

			return $this;
		}

		 function getClassLen() {
			$len_bs = new ByteStream();
			$len_bs->setRealWrite(false);
			$this->serialize_internal($len_bs);
			$class_len = $len_bs->getWrittenLength();

			return $class_len;
		}

}
}

?>