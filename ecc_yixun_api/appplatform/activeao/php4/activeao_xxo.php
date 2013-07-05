<?php

//source idl: com.paipai.vb2c.active.ao.idl.ActiveAo.java

if (!class_exists('TimeRegionPo')) {
class TimeRegionPo
{
		/**
		 * ʱ������Ŀ�ʼ��Χ
		 *
		 * �汾 >= 0
		 */
		var $dwBegin; //uint32_t

		/**
		 * ʱ������Ľ�����Χ
		 *
		 * �汾 >= 0
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
			$bs->pushUint32_t($this->dwBegin); // ���л�ʱ������Ŀ�ʼ��Χ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwEnd); // ���л�ʱ������Ľ�����Χ ����Ϊuint32_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwBegin = $bs->popUint32_t(); // �����л�ʱ������Ŀ�ʼ��Χ ����Ϊuint32_t
			$this->dwEnd = $bs->popUint32_t(); // �����л�ʱ������Ľ�����Χ ����Ϊuint32_t

			/**********************Ϊ��֧�ֶ���汾�Ŀͻ���************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************Ϊ��֧�ֶ���汾�Ŀͻ���************************/
			

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
		 * �汾����
		 *
		 * �汾 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * �μӻ�Ľ����0���ɹ�������������ʧ��ԭ��Ĵ�����
		 *
		 * �汾 >= 0
		 */
		var $dwResult; //uint32_t

		/**
		 * ���ظ������ģ�key:���������value��(key-����ֵ value-ʵ��ֵ
		 *
		 * �汾 >= 0
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
			$bs->pushUint32_t($this->dwVersion); // ���л��汾���� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwResult); // ���л��μӻ�Ľ����0���ɹ�������������ʧ��ԭ��Ĵ����� ����Ϊuint32_t
			$bs->pushObject($this->mapRuleValue,'stl_map'); // ���л����ظ������ģ�key:���������value��(key-����ֵ value-ʵ��ֵ ����Ϊstd::map<std::string,vb2c::active::po::CRuleValuePo> 
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // �����л��汾���� ����Ϊuint32_t
			$this->dwResult = $bs->popUint32_t(); // �����л��μӻ�Ľ����0���ɹ�������������ʧ��ԭ��Ĵ����� ����Ϊuint32_t
			$this->mapRuleValue = $bs->popObject('stl_map<stl_string,RuleValuePo>'); // �����л����ظ������ģ�key:���������value��(key-����ֵ value-ʵ��ֵ ����Ϊstd::map<std::string,vb2c::active::po::CRuleValuePo> 

			/**********************Ϊ��֧�ֶ���汾�Ŀͻ���************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************Ϊ��֧�ֶ���汾�Ŀͻ���************************/
			

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
		 * ���ù���ֵ
		 *
		 * �汾 >= 0
		 */
		var $strConfigValue; //std::string

		/**
		 * ��ǰֵ
		 *
		 * �汾 >= 0
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
			$bs->pushString($this->strConfigValue); // ���л����ù���ֵ ����Ϊstd::string
			$bs->pushString($this->strCurValue); // ���л���ǰֵ ����Ϊstd::string
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->strConfigValue = $bs->popString(); // �����л����ù���ֵ ����Ϊstd::string
			$this->strCurValue = $bs->popString(); // �����л���ǰֵ ����Ϊstd::string

			/**********************Ϊ��֧�ֶ���汾�Ŀͻ���************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************Ϊ��֧�ֶ���汾�Ŀͻ���************************/
			

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
		 * �汾����
		 *
		 * �汾 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * ���
		 *
		 * �汾 >= 0
		 */
		var $strActiveName; //std::string

		/**
		 * �����,1:���ѻ;2���λ;3:���ջ...
		 *
		 * �汾 >= 0
		 */
		var $dwActiveType; //uint32_t

		/**
		 * �Ƿ��ǲμӻԤУ�飬ֻ�������鲻�����Ի�Ƶ�ʼ����޸�
		 *
		 * �汾 >= 0
		 */
		var $bPreCheckTag; //bool

		/**
		 * vb2c_tagֵ����vb2c_tag��ȡ�������ż���Ƿ������õ�
		 *
		 * �汾 >= 0
		 */
		var $strVb2cTag; //std::string

		/**
		 * �μӻ��qq����
		 *
		 * �汾 >= 0
		 */
		var $dwUin; //uint32_t

		/**
		 * �μӻ���ֻ����룬�μӵĻ���ֻ�����ʱ�ɲ���
		 *
		 * �汾 >= 0
		 */
		var $strMobileNum; //std::string

		/**
		 * �μӻ����ֵ
		 *
		 * �汾 >= 0
		 */
		var $dwAmount; //uint32_t

		/**
		 * һ��Ϊ1����������Ļ����������3������uin����μ�3�λ
		 *
		 * �汾 >= 0
		 */
		var $dwReqCount; //uint32_t

		/**
		 * ��չ�����ṹ�ӿڣ����ּ����ͨ��key-value��ʽ����
		 *
		 * �汾 >= 0
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
			$bs->pushUint32_t($this->dwVersion); // ���л��汾���� ����Ϊuint32_t
			$bs->pushString($this->strActiveName); // ���л���� ����Ϊstd::string
			$bs->pushUint32_t($this->dwActiveType); // ���л������,1:���ѻ;2���λ;3:���ջ... ����Ϊuint32_t
			$bs->pushObject($this->bPreCheckTag,'uint8_t'); // ���л��Ƿ��ǲμӻԤУ�飬ֻ�������鲻�����Ի�Ƶ�ʼ����޸� ����Ϊbool
			$bs->pushString($this->strVb2cTag); // ���л�vb2c_tagֵ����vb2c_tag��ȡ�������ż���Ƿ������õ� ����Ϊstd::string
			$bs->pushUint32_t($this->dwUin); // ���л��μӻ��qq���� ����Ϊuint32_t
			$bs->pushString($this->strMobileNum); // ���л��μӻ���ֻ����룬�μӵĻ���ֻ�����ʱ�ɲ��� ����Ϊstd::string
			$bs->pushUint32_t($this->dwAmount); // ���л��μӻ����ֵ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwReqCount); // ���л�һ��Ϊ1����������Ļ����������3������uin����μ�3�λ ����Ϊuint32_t
			$bs->pushObject($this->mapExt,'stl_map'); // ���л���չ�����ṹ�ӿڣ����ּ����ͨ��key-value��ʽ���� ����Ϊstd::map<std::string,std::string> 
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // �����л��汾���� ����Ϊuint32_t
			$this->strActiveName = $bs->popString(); // �����л���� ����Ϊstd::string
			$this->dwActiveType = $bs->popUint32_t(); // �����л������,1:���ѻ;2���λ;3:���ջ... ����Ϊuint32_t
			$this->bPreCheckTag = $bs->popObject('uint8_t'); // �����л��Ƿ��ǲμӻԤУ�飬ֻ�������鲻�����Ի�Ƶ�ʼ����޸� ����Ϊbool
			$this->strVb2cTag = $bs->popString(); // �����л�vb2c_tagֵ����vb2c_tag��ȡ�������ż���Ƿ������õ� ����Ϊstd::string
			$this->dwUin = $bs->popUint32_t(); // �����л��μӻ��qq���� ����Ϊuint32_t
			$this->strMobileNum = $bs->popString(); // �����л��μӻ���ֻ����룬�μӵĻ���ֻ�����ʱ�ɲ��� ����Ϊstd::string
			$this->dwAmount = $bs->popUint32_t(); // �����л��μӻ����ֵ ����Ϊuint32_t
			$this->dwReqCount = $bs->popUint32_t(); // �����л�һ��Ϊ1����������Ļ����������3������uin����μ�3�λ ����Ϊuint32_t
			$this->mapExt = $bs->popObject('stl_map<stl_string,stl_string>'); // �����л���չ�����ṹ�ӿڣ����ּ����ͨ��key-value��ʽ���� ����Ϊstd::map<std::string,std::string> 

			/**********************Ϊ��֧�ֶ���汾�Ŀͻ���************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************Ϊ��֧�ֶ���汾�Ŀͻ���************************/
			

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