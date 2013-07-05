<?php

//source idl: com.paipai.vb2c.active.ao.idl.ActiveAo.java

if (!class_exists('TimeRegionPo')) {
class TimeRegionPo
{
		/**
		 * 时间区间的开始范围
		 *
		 * 版本 >= 0
		 */
		var $dwBegin; //uint32_t

		/**
		 * 时间区间的结束范围
		 *
		 * 版本 >= 0
		 */
		var $dwEnd; //uint32_t


		 function __construct() {
			 $this->dwBegin = 0; // uint32_t
			 $this->dwEnd = 0; // uint32_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwBegin); // 序列化时间区间的开始范围 类型为uint32_t
			$bs->pushUint32_t($this->dwEnd); // 序列化时间区间的结束范围 类型为uint32_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwBegin = $bs->popUint32_t(); // 反序列化时间区间的开始范围 类型为uint32_t
			$this->dwEnd = $bs->popUint32_t(); // 反序列化时间区间的结束范围 类型为uint32_t

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


//source idl: com.paipai.vb2c.active.ao.idl.ActiveAo.java

if (!class_exists('ActiveResponePo')) {
class ActiveResponePo
{
		/**
		 * 版本控制
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 参加活动的结果，0：成功；其他：具体失败原因的错误码
		 *
		 * 版本 >= 0
		 */
		var $dwResult; //uint32_t

		/**
		 * 返回各检查项的，key:检查项名；value：(key-规则值 value-实际值
		 *
		 * 版本 >= 0
		 */
		var $mapRuleValue; //std::map<std::string,vb2c::active::po::CRuleValuePo> 


		 function __construct() {
			 $this->dwVersion = 20130118; // uint32_t
			 $this->dwResult = 0; // uint32_t
			 $this->mapRuleValue = new stl_map('stl_string,RuleValuePo'); // std::map<std::string,vb2c::active::po::CRuleValuePo> 
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本控制 类型为uint32_t
			$bs->pushUint32_t($this->dwResult); // 序列化参加活动的结果，0：成功；其他：具体失败原因的错误码 类型为uint32_t
			$bs->pushObject($this->mapRuleValue,'stl_map'); // 序列化返回各检查项的，key:检查项名；value：(key-规则值 value-实际值 类型为std::map<std::string,vb2c::active::po::CRuleValuePo> 
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本控制 类型为uint32_t
			$this->dwResult = $bs->popUint32_t(); // 反序列化参加活动的结果，0：成功；其他：具体失败原因的错误码 类型为uint32_t
			$this->mapRuleValue = $bs->popObject('stl_map<stl_string,RuleValuePo>'); // 反序列化返回各检查项的，key:检查项名；value：(key-规则值 value-实际值 类型为std::map<std::string,vb2c::active::po::CRuleValuePo> 

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


//source idl: com.paipai.vb2c.active.ao.idl.ActiveResponePo.java

if (!class_exists('RuleValuePo')) {
class RuleValuePo
{
		/**
		 * 配置规则值
		 *
		 * 版本 >= 0
		 */
		var $strConfigValue; //std::string

		/**
		 * 当前值
		 *
		 * 版本 >= 0
		 */
		var $strCurValue; //std::string


		 function __construct() {
			 $this->strConfigValue = ""; // std::string
			 $this->strCurValue = ""; // std::string
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushString($this->strConfigValue); // 序列化配置规则值 类型为std::string
			$bs->pushString($this->strCurValue); // 序列化当前值 类型为std::string
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->strConfigValue = $bs->popString(); // 反序列化配置规则值 类型为std::string
			$this->strCurValue = $bs->popString(); // 反序列化当前值 类型为std::string

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


//source idl: com.paipai.vb2c.active.ao.idl.ActiveAo.java

if (!class_exists('ActiveRequestPo')) {
class ActiveRequestPo
{
		/**
		 * 版本控制
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 活动名
		 *
		 * 版本 >= 0
		 */
		var $strActiveName; //std::string

		/**
		 * 活动类型,1:话费活动;2网游活动;3:保险活动...
		 *
		 * 版本 >= 0
		 */
		var $dwActiveType; //uint32_t

		/**
		 * 是否是参加活动预校验，只做规则检查不做属性或频率计数修改
		 *
		 * 版本 >= 0
		 */
		var $bPreCheckTag; //bool

		/**
		 * vb2c_tag值，从vb2c_tag中取出渠道号检查是否活动渠道好等
		 *
		 * 版本 >= 0
		 */
		var $strVb2cTag; //std::string

		/**
		 * 参加活动的qq号码
		 *
		 * 版本 >= 0
		 */
		var $dwUin; //uint32_t

		/**
		 * 参加活动的手机号码，参加的活动无手机号码时可不填
		 *
		 * 版本 >= 0
		 */
		var $strMobileNum; //std::string

		/**
		 * 参加活动的面值
		 *
		 * 版本 >= 0
		 */
		var $dwAmount; //uint32_t

		/**
		 * 一般为1，本次请求的活动计数，比如3：本次uin请求参加3次活动
		 *
		 * 版本 >= 0
		 */
		var $dwReqCount; //uint32_t

		/**
		 * 拓展参数结构接口，各种检查项通过key-value形式传入
		 *
		 * 版本 >= 0
		 */
		var $mapExt; //std::map<std::string,std::string> 


		 function __construct(){
			 $this->dwVersion = 20130118; // uint32_t
			 $this->strActiveName = ""; // std::string
			 $this->dwActiveType = 0; // uint32_t
			 $this->bPreCheckTag = true; // bool
			 $this->strVb2cTag = ""; // std::string
			 $this->dwUin = 0; // uint32_t
			 $this->strMobileNum = ""; // std::string
			 $this->dwAmount = 0; // uint32_t
			 $this->dwReqCount = 0; // uint32_t
			 $this->mapExt = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本控制 类型为uint32_t
			$bs->pushString($this->strActiveName); // 序列化活动名 类型为std::string
			$bs->pushUint32_t($this->dwActiveType); // 序列化活动类型,1:话费活动;2网游活动;3:保险活动... 类型为uint32_t
			$bs->pushObject($this->bPreCheckTag,'uint8_t'); // 序列化是否是参加活动预校验，只做规则检查不做属性或频率计数修改 类型为bool
			$bs->pushString($this->strVb2cTag); // 序列化vb2c_tag值，从vb2c_tag中取出渠道号检查是否活动渠道好等 类型为std::string
			$bs->pushUint32_t($this->dwUin); // 序列化参加活动的qq号码 类型为uint32_t
			$bs->pushString($this->strMobileNum); // 序列化参加活动的手机号码，参加的活动无手机号码时可不填 类型为std::string
			$bs->pushUint32_t($this->dwAmount); // 序列化参加活动的面值 类型为uint32_t
			$bs->pushUint32_t($this->dwReqCount); // 序列化一般为1，本次请求的活动计数，比如3：本次uin请求参加3次活动 类型为uint32_t
			$bs->pushObject($this->mapExt,'stl_map'); // 序列化拓展参数结构接口，各种检查项通过key-value形式传入 类型为std::map<std::string,std::string> 
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本控制 类型为uint32_t
			$this->strActiveName = $bs->popString(); // 反序列化活动名 类型为std::string
			$this->dwActiveType = $bs->popUint32_t(); // 反序列化活动类型,1:话费活动;2网游活动;3:保险活动... 类型为uint32_t
			$this->bPreCheckTag = $bs->popObject('uint8_t'); // 反序列化是否是参加活动预校验，只做规则检查不做属性或频率计数修改 类型为bool
			$this->strVb2cTag = $bs->popString(); // 反序列化vb2c_tag值，从vb2c_tag中取出渠道号检查是否活动渠道好等 类型为std::string
			$this->dwUin = $bs->popUint32_t(); // 反序列化参加活动的qq号码 类型为uint32_t
			$this->strMobileNum = $bs->popString(); // 反序列化参加活动的手机号码，参加的活动无手机号码时可不填 类型为std::string
			$this->dwAmount = $bs->popUint32_t(); // 反序列化参加活动的面值 类型为uint32_t
			$this->dwReqCount = $bs->popUint32_t(); // 反序列化一般为1，本次请求的活动计数，比如3：本次uin请求参加3次活动 类型为uint32_t
			$this->mapExt = $bs->popObject('stl_map<stl_string,stl_string>'); // 反序列化拓展参数结构接口，各种检查项通过key-value形式传入 类型为std::map<std::string,std::string> 

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