<?php

//source idl: com.icson.promotionrestrict.idl.PromotionRestrictBaseInfo.java

//if (!class_exists('PromotionRestrictParamInfo_Bo')) {
class PromotionRestrictParamInfo_Bo
{
		/**
		 * 业务Id  多价/促销
		 *
		 * 版本 >= 0
		 */
		var $dwBussinessId; //uint32_t

		/**
		 * edm1,调用方输入,调用方自定义,一般为多价/促销的规则ID
		 *
		 * 版本 >= 0
		 */
		var $dwEdm1; //uint32_t

		/**
		 * edm2,调用方输入,调用方自定义
		 *
		 * 版本 >= 0
		 */
		var $ddwEdm2; //uint64_t

		/**
		 * edm3,调用方输入,调用方自定义
		 *
		 * 版本 >= 0
		 */
		var $strEdm3; //std::string

		/**
		 * 生效次数/单品数量,调用方输入
		 *
		 * 版本 >= 0
		 */
		var $dwNum; //uint32_t

		/**
		 * 是否被限 0未限，1被限
		 *
		 * 版本 >= 0
		 */
		var $cIsRestrict; //uint8_t

		/**
		 * 本次可生效的最小次数
		 *
		 * 版本 >= 0
		 */
		var $dwSurplus; //uint32_t

		/**
		 * surplus对应的阀值
		 *
		 * 版本 >= 0
		 */
		var $dwThreshold; //uint32_t

		/**
		 * 扣减时间 扣减时输出，回滚是输入
		 *
		 * 版本 >= 0
		 */
		var $dwDwDeductTime; //uint32_t

		/**
		 * 限购策略描述
		 *
		 * 版本 >= 0
		 */
		var $strDesc; //std::string


		 function __construct() {
			 $this->dwBussinessId = 0; // uint32_t
			 $this->dwEdm1 = 0; // uint32_t
			 $this->ddwEdm2 = 0; // uint64_t
			 $this->strEdm3 = ""; // std::string
			 $this->dwNum = 0; // uint32_t
			 $this->cIsRestrict = 0; // uint8_t
			 $this->dwSurplus = 0; // uint32_t
			 $this->dwThreshold = 0; // uint32_t
			 $this->dwDwDeductTime = 0; // uint32_t
			 $this->strDesc = ""; // std::string
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwBussinessId); // 序列化业务Id  多价/促销 类型为uint32_t
			$bs->pushUint32_t($this->dwEdm1); // 序列化edm1,调用方输入,调用方自定义,一般为多价/促销的规则ID 类型为uint32_t
			$bs->pushUint64_t($this->ddwEdm2); // 序列化edm2,调用方输入,调用方自定义 类型为uint64_t
			$bs->pushString($this->strEdm3); // 序列化edm3,调用方输入,调用方自定义 类型为std::string
			$bs->pushUint32_t($this->dwNum); // 序列化生效次数/单品数量,调用方输入 类型为uint32_t
			$bs->pushUint8_t($this->cIsRestrict); // 序列化是否被限 0未限，1被限 类型为uint8_t
			$bs->pushUint32_t($this->dwSurplus); // 序列化本次可生效的最小次数 类型为uint32_t
			$bs->pushUint32_t($this->dwThreshold); // 序列化surplus对应的阀值 类型为uint32_t
			$bs->pushUint32_t($this->dwDwDeductTime); // 序列化扣减时间 扣减时输出，回滚是输入 类型为uint32_t
			$bs->pushString($this->strDesc); // 序列化限购策略描述 类型为std::string
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwBussinessId = $bs->popUint32_t(); // 反序列化业务Id  多价/促销 类型为uint32_t
			$this->dwEdm1 = $bs->popUint32_t(); // 反序列化edm1,调用方输入,调用方自定义,一般为多价/促销的规则ID 类型为uint32_t
			$this->ddwEdm2 = $bs->popUint64_t(); // 反序列化edm2,调用方输入,调用方自定义 类型为uint64_t
			$this->strEdm3 = $bs->popString(); // 反序列化edm3,调用方输入,调用方自定义 类型为std::string
			$this->dwNum = $bs->popUint32_t(); // 反序列化生效次数/单品数量,调用方输入 类型为uint32_t
			$this->cIsRestrict = $bs->popUint8_t(); // 反序列化是否被限 0未限，1被限 类型为uint8_t
			$this->dwSurplus = $bs->popUint32_t(); // 反序列化本次可生效的最小次数 类型为uint32_t
			$this->dwThreshold = $bs->popUint32_t(); // 反序列化surplus对应的阀值 类型为uint32_t
			$this->dwDwDeductTime = $bs->popUint32_t(); // 反序列化扣减时间 扣减时输出，回滚是输入 类型为uint32_t
			$this->strDesc = $bs->popString(); // 反序列化限购策略描述 类型为std::string

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
//}


//source idl: com.icson.promotionrestrict.idl.PromotionRestrictBaseInfo.java

//if (!class_exists('PromotionRestrictPolicyInfo_Bo')) {
class PromotionRestrictPolicyInfo_Bo
{
		/**
		 * RuleKey 类型|key   类型为多价/促销  key的构成  多价为 规则ID+skuID  促销为活动类型+规则ID
		 *
		 * 版本 >= 0
		 */
		var $strRuleKey; //std::string

		/**
		 * 策略Id
		 *
		 * 版本 >= 0
		 */
		var $dwPolicyId; //uint32_t

		/**
		 * 策略类型 0总量，1用户
		 *
		 * 版本 >= 0
		 */
		var $cType; //uint8_t

		/**
		 * 频率类型 0 日，1 周 ，2 月，3 活动期间
		 *
		 * 版本 >= 0
		 */
		var $cFreqType; //uint8_t

		/**
		 * 规则阀值
		 *
		 * 版本 >= 0
		 */
		var $dwThreshold; //uint32_t

		/**
		 * 数据源类型, 1 cmem  2 ttc
		 *
		 * 版本 >= 0
		 */
		var $cDataSourceType; //uint8_t

		/**
		 * 周期开始时间
		 *
		 * 版本 >= 0
		 */
		var $dwTimeBegin; //uint32_t

		/**
		 * 周期结束时间
		 *
		 * 版本 >= 0
		 */
		var $dwTimeEnd; //uint32_t

		/**
		 * 策略是否生效
		 *
		 * 版本 >= 0
		 */
		var $cIsValid; //uint8_t


		 function __construct() {
			 $this->strRuleKey = ""; // std::string
			 $this->dwPolicyId = 0; // uint32_t
			 $this->cType = 0; // uint8_t
			 $this->cFreqType = 0; // uint8_t
			 $this->dwThreshold = 0; // uint32_t
			 $this->cDataSourceType = 0; // uint8_t
			 $this->dwTimeBegin = 0; // uint32_t
			 $this->dwTimeEnd = 0; // uint32_t
			 $this->cIsValid = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushString($this->strRuleKey); // 序列化RuleKey 类型|key   类型为多价/促销  key的构成  多价为 规则ID+skuID  促销为活动类型+规则ID 类型为std::string
			$bs->pushUint32_t($this->dwPolicyId); // 序列化策略Id 类型为uint32_t
			$bs->pushUint8_t($this->cType); // 序列化策略类型 0总量，1用户 类型为uint8_t
			$bs->pushUint8_t($this->cFreqType); // 序列化频率类型 0 日，1 周 ，2 月，3 活动期间 类型为uint8_t
			$bs->pushUint32_t($this->dwThreshold); // 序列化规则阀值 类型为uint32_t
			$bs->pushUint8_t($this->cDataSourceType); // 序列化数据源类型, 1 cmem  2 ttc 类型为uint8_t
			$bs->pushUint32_t($this->dwTimeBegin); // 序列化周期开始时间 类型为uint32_t
			$bs->pushUint32_t($this->dwTimeEnd); // 序列化周期结束时间 类型为uint32_t
			$bs->pushUint8_t($this->cIsValid); // 序列化策略是否生效 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->strRuleKey = $bs->popString(); // 反序列化RuleKey 类型|key   类型为多价/促销  key的构成  多价为 规则ID+skuID  促销为活动类型+规则ID 类型为std::string
			$this->dwPolicyId = $bs->popUint32_t(); // 反序列化策略Id 类型为uint32_t
			$this->cType = $bs->popUint8_t(); // 反序列化策略类型 0总量，1用户 类型为uint8_t
			$this->cFreqType = $bs->popUint8_t(); // 反序列化频率类型 0 日，1 周 ，2 月，3 活动期间 类型为uint8_t
			$this->dwThreshold = $bs->popUint32_t(); // 反序列化规则阀值 类型为uint32_t
			$this->cDataSourceType = $bs->popUint8_t(); // 反序列化数据源类型, 1 cmem  2 ttc 类型为uint8_t
			$this->dwTimeBegin = $bs->popUint32_t(); // 反序列化周期开始时间 类型为uint32_t
			$this->dwTimeEnd = $bs->popUint32_t(); // 反序列化周期结束时间 类型为uint32_t
			$this->cIsValid = $bs->popUint8_t(); // 反序列化策略是否生效 类型为uint8_t

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
//}

?>