<?php

//source idl: com.icson.deal.idl.GetAllPayTypeInfoResp.java

if (!class_exists('PayTypeInfo',false)) {
class PayTypeInfo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 支付方式列表
		 *
		 * 版本 >= 0
		 */
		var $vecPayTypeList; //std::vector<icson::deal::bo::CPayType> 

		/**
		 * 版本 >= 0
		 */
		var $cPayTypeList_u; //uint8_t

		/**
		 * 分期付款配置
		 *
		 * 版本 >= 0
		 */
		var $vecInstallmentConfigList; //std::vector<icson::deal::bo::CInstallmentConfig> 

		/**
		 * 版本 >= 0
		 */
		var $cInstallmentConfigList_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->vecPayTypeList = new stl_vector('PayType'); // std::vector<icson::deal::bo::CPayType> 
			 $this->cPayTypeList_u = 0; // uint8_t
			 $this->vecInstallmentConfigList = new stl_vector('InstallmentConfig'); // std::vector<icson::deal::bo::CInstallmentConfig> 
			 $this->cInstallmentConfigList_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecPayTypeList,'stl_vector'); // 序列化支付方式列表 类型为std::vector<icson::deal::bo::CPayType> 
			$bs->pushUint8_t($this->cPayTypeList_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecInstallmentConfigList,'stl_vector'); // 序列化分期付款配置 类型为std::vector<icson::deal::bo::CInstallmentConfig> 
			$bs->pushUint8_t($this->cInstallmentConfigList_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecPayTypeList = $bs->popObject('stl_vector<PayType>'); // 反序列化支付方式列表 类型为std::vector<icson::deal::bo::CPayType> 
			$this->cPayTypeList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecInstallmentConfigList = $bs->popObject('stl_vector<InstallmentConfig>'); // 反序列化分期付款配置 类型为std::vector<icson::deal::bo::CInstallmentConfig> 
			$this->cInstallmentConfigList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.deal.idl.PayTypeInfo.java

if (!class_exists('InstallmentConfig',false)) {
class InstallmentConfig
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 支付方式id
		 *
		 * 版本 >= 0
		 */
		var $dwPayTypeId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPayTypeId_u; //uint8_t

		/**
		 * 分期银行名称
		 *
		 * 版本 >= 0
		 */
		var $strBankName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cBankName_u; //uint8_t

		/**
		 * 分期下各期设置
		 *
		 * 版本 >= 0
		 */
		var $vecInstallmentTermList; //std::vector<icson::deal::bo::CInstallmentTerm> 

		/**
		 * 版本 >= 0
		 */
		var $cInstallmentTermList_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwPayTypeId = 0; // uint32_t
			 $this->cPayTypeId_u = 0; // uint8_t
			 $this->strBankName = ""; // std::string
			 $this->cBankName_u = 0; // uint8_t
			 $this->vecInstallmentTermList = new stl_vector('InstallmentTerm'); // std::vector<icson::deal::bo::CInstallmentTerm> 
			 $this->cInstallmentTermList_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPayTypeId); // 序列化支付方式id 类型为uint32_t
			$bs->pushUint8_t($this->cPayTypeId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strBankName); // 序列化分期银行名称 类型为std::string
			$bs->pushUint8_t($this->cBankName_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecInstallmentTermList,'stl_vector'); // 序列化分期下各期设置 类型为std::vector<icson::deal::bo::CInstallmentTerm> 
			$bs->pushUint8_t($this->cInstallmentTermList_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPayTypeId = $bs->popUint32_t(); // 反序列化支付方式id 类型为uint32_t
			$this->cPayTypeId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strBankName = $bs->popString(); // 反序列化分期银行名称 类型为std::string
			$this->cBankName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecInstallmentTermList = $bs->popObject('stl_vector<InstallmentTerm>'); // 反序列化分期下各期设置 类型为std::vector<icson::deal::bo::CInstallmentTerm> 
			$this->cInstallmentTermList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.deal.idl.InstallmentConfig.java

if (!class_exists('InstallmentTerm',false)) {
class InstallmentTerm
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 分的期数
		 *
		 * 版本 >= 0
		 */
		var $dwTermNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTermNum_u; //uint8_t

		/**
		 * 该期最小金额
		 *
		 * 版本 >= 0
		 */
		var $dwMinPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cMinPrice_u; //uint8_t

		/**
		 * 该期最大金额
		 *
		 * 版本 >= 0
		 */
		var $dwMaxPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cMaxPrice_u; //uint8_t

		/**
		 * 费率 * 1000000
		 *
		 * 版本 >= 0
		 */
		var $dwRate; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cRate_u; //uint8_t

		/**
		 * BackRate * 1000000
		 *
		 * 版本 >= 0
		 */
		var $dwBackRate; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cBackRate_u; //uint8_t

		/**
		 * BankSynNo
		 *
		 * 版本 >= 0
		 */
		var $dwBankSynNo; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cBankSynNo_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwTermNum = 0; // uint32_t
			 $this->cTermNum_u = 0; // uint8_t
			 $this->dwMinPrice = 0; // uint32_t
			 $this->cMinPrice_u = 0; // uint8_t
			 $this->dwMaxPrice = 0; // uint32_t
			 $this->cMaxPrice_u = 0; // uint8_t
			 $this->dwRate = 0; // uint32_t
			 $this->cRate_u = 0; // uint8_t
			 $this->dwBackRate = 0; // uint32_t
			 $this->cBackRate_u = 0; // uint8_t
			 $this->dwBankSynNo = 0; // uint32_t
			 $this->cBankSynNo_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTermNum); // 序列化分的期数 类型为uint32_t
			$bs->pushUint8_t($this->cTermNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwMinPrice); // 序列化该期最小金额 类型为uint32_t
			$bs->pushUint8_t($this->cMinPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwMaxPrice); // 序列化该期最大金额 类型为uint32_t
			$bs->pushUint8_t($this->cMaxPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwRate); // 序列化费率 * 1000000 类型为uint32_t
			$bs->pushUint8_t($this->cRate_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwBackRate); // 序列化BackRate * 1000000 类型为uint32_t
			$bs->pushUint8_t($this->cBackRate_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwBankSynNo); // 序列化BankSynNo 类型为uint32_t
			$bs->pushUint8_t($this->cBankSynNo_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTermNum = $bs->popUint32_t(); // 反序列化分的期数 类型为uint32_t
			$this->cTermNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwMinPrice = $bs->popUint32_t(); // 反序列化该期最小金额 类型为uint32_t
			$this->cMinPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwMaxPrice = $bs->popUint32_t(); // 反序列化该期最大金额 类型为uint32_t
			$this->cMaxPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRate = $bs->popUint32_t(); // 反序列化费率 * 1000000 类型为uint32_t
			$this->cRate_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwBackRate = $bs->popUint32_t(); // 反序列化BackRate * 1000000 类型为uint32_t
			$this->cBackRate_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwBankSynNo = $bs->popUint32_t(); // 反序列化BankSynNo 类型为uint32_t
			$this->cBankSynNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.deal.idl.PayTypeInfo.java

if (!class_exists('PayType',false)) {
class PayType
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 支付方式id
		 *
		 * 版本 >= 0
		 */
		var $dwPayTypeId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPayTypeId_u; //uint8_t

		/**
		 * String 类型的支付方式id
		 *
		 * 版本 >= 0
		 */
		var $strStrPayTypeId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cStrPayTypeId_u; //uint8_t

		/**
		 * 支付方式名称
		 *
		 * 版本 >= 0
		 */
		var $strPayTypeName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPayTypeName_u; //uint8_t

		/**
		 * 支付方式描述
		 *
		 * 版本 >= 0
		 */
		var $strPayTypeDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPayTypeDesc_u; //uint8_t

		/**
		 * Period
		 *
		 * 版本 >= 0
		 */
		var $strPeriod; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPeriod_u; //uint8_t

		/**
		 * PaymentPage
		 *
		 * 版本 >= 0
		 */
		var $strPaymentPage; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPaymentPage_u; //uint8_t

		/**
		 * PayRate * 1000000
		 *
		 * 版本 >= 0
		 */
		var $dwPayRate; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPayRate_u; //uint8_t

		/**
		 * 是否在线支付
		 *
		 * 版本 >= 0
		 */
		var $dwIsNet; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cIsNet_u; //uint8_t

		/**
		 * IsPayWhenRecv
		 *
		 * 版本 >= 0
		 */
		var $dwIsPayWhenRecv; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cIsPayWhenRecv_u; //uint8_t

		/**
		 * OrderNumber
		 *
		 * 版本 >= 0
		 */
		var $strOrderNumber; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cOrderNumber_u; //uint8_t

		/**
		 * 是否线上展示
		 *
		 * 版本 >= 0
		 */
		var $dwIsOnlineShow; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cIsOnlineShow_u; //uint8_t

		/**
		 * ReturnRate * 1000000
		 *
		 * 版本 >= 0
		 */
		var $dwReturnRate; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cReturnRate_u; //uint8_t

		/**
		 * 是否是在线支付银行
		 *
		 * 版本 >= 0
		 */
		var $dwIsNetBank; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cIsNetBank_u; //uint8_t

		/**
		 * 是否分期付款支付方式
		 *
		 * 版本 >= 0
		 */
		var $dwIsInstallment; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cIsInstallment_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwPayTypeId = 0; // uint32_t
			 $this->cPayTypeId_u = 0; // uint8_t
			 $this->strStrPayTypeId = ""; // std::string
			 $this->cStrPayTypeId_u = 0; // uint8_t
			 $this->strPayTypeName = ""; // std::string
			 $this->cPayTypeName_u = 0; // uint8_t
			 $this->strPayTypeDesc = ""; // std::string
			 $this->cPayTypeDesc_u = 0; // uint8_t
			 $this->strPeriod = ""; // std::string
			 $this->cPeriod_u = 0; // uint8_t
			 $this->strPaymentPage = ""; // std::string
			 $this->cPaymentPage_u = 0; // uint8_t
			 $this->dwPayRate = 0; // uint32_t
			 $this->cPayRate_u = 0; // uint8_t
			 $this->dwIsNet = 0; // uint32_t
			 $this->cIsNet_u = 0; // uint8_t
			 $this->dwIsPayWhenRecv = 0; // uint32_t
			 $this->cIsPayWhenRecv_u = 0; // uint8_t
			 $this->strOrderNumber = ""; // std::string
			 $this->cOrderNumber_u = 0; // uint8_t
			 $this->dwIsOnlineShow = 0; // uint32_t
			 $this->cIsOnlineShow_u = 0; // uint8_t
			 $this->dwReturnRate = 0; // uint32_t
			 $this->cReturnRate_u = 0; // uint8_t
			 $this->dwIsNetBank = 0; // uint32_t
			 $this->cIsNetBank_u = 0; // uint8_t
			 $this->dwIsInstallment = 0; // uint32_t
			 $this->cIsInstallment_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPayTypeId); // 序列化支付方式id 类型为uint32_t
			$bs->pushUint8_t($this->cPayTypeId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strStrPayTypeId); // 序列化String 类型的支付方式id 类型为std::string
			$bs->pushUint8_t($this->cStrPayTypeId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPayTypeName); // 序列化支付方式名称 类型为std::string
			$bs->pushUint8_t($this->cPayTypeName_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPayTypeDesc); // 序列化支付方式描述 类型为std::string
			$bs->pushUint8_t($this->cPayTypeDesc_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPeriod); // 序列化Period 类型为std::string
			$bs->pushUint8_t($this->cPeriod_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPaymentPage); // 序列化PaymentPage 类型为std::string
			$bs->pushUint8_t($this->cPaymentPage_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPayRate); // 序列化PayRate * 1000000 类型为uint32_t
			$bs->pushUint8_t($this->cPayRate_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwIsNet); // 序列化是否在线支付 类型为uint32_t
			$bs->pushUint8_t($this->cIsNet_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwIsPayWhenRecv); // 序列化IsPayWhenRecv 类型为uint32_t
			$bs->pushUint8_t($this->cIsPayWhenRecv_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strOrderNumber); // 序列化OrderNumber 类型为std::string
			$bs->pushUint8_t($this->cOrderNumber_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwIsOnlineShow); // 序列化是否线上展示 类型为uint32_t
			$bs->pushUint8_t($this->cIsOnlineShow_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwReturnRate); // 序列化ReturnRate * 1000000 类型为uint32_t
			$bs->pushUint8_t($this->cReturnRate_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwIsNetBank); // 序列化是否是在线支付银行 类型为uint32_t
			$bs->pushUint8_t($this->cIsNetBank_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwIsInstallment); // 序列化是否分期付款支付方式 类型为uint32_t
			$bs->pushUint8_t($this->cIsInstallment_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPayTypeId = $bs->popUint32_t(); // 反序列化支付方式id 类型为uint32_t
			$this->cPayTypeId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strStrPayTypeId = $bs->popString(); // 反序列化String 类型的支付方式id 类型为std::string
			$this->cStrPayTypeId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPayTypeName = $bs->popString(); // 反序列化支付方式名称 类型为std::string
			$this->cPayTypeName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPayTypeDesc = $bs->popString(); // 反序列化支付方式描述 类型为std::string
			$this->cPayTypeDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPeriod = $bs->popString(); // 反序列化Period 类型为std::string
			$this->cPeriod_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPaymentPage = $bs->popString(); // 反序列化PaymentPage 类型为std::string
			$this->cPaymentPage_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPayRate = $bs->popUint32_t(); // 反序列化PayRate * 1000000 类型为uint32_t
			$this->cPayRate_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwIsNet = $bs->popUint32_t(); // 反序列化是否在线支付 类型为uint32_t
			$this->cIsNet_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwIsPayWhenRecv = $bs->popUint32_t(); // 反序列化IsPayWhenRecv 类型为uint32_t
			$this->cIsPayWhenRecv_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strOrderNumber = $bs->popString(); // 反序列化OrderNumber 类型为std::string
			$this->cOrderNumber_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwIsOnlineShow = $bs->popUint32_t(); // 反序列化是否线上展示 类型为uint32_t
			$this->cIsOnlineShow_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwReturnRate = $bs->popUint32_t(); // 反序列化ReturnRate * 1000000 类型为uint32_t
			$this->cReturnRate_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwIsNetBank = $bs->popUint32_t(); // 反序列化是否是在线支付银行 类型为uint32_t
			$this->cIsNetBank_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwIsInstallment = $bs->popUint32_t(); // 反序列化是否分期付款支付方式 类型为uint32_t
			$this->cIsInstallment_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.icson.deal.idl.GetAllPayTypeInfoReq.java

if (!class_exists('PayTypeParam',false)) {
class PayTypeParam
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 支付方式id
		 *
		 * 版本 >= 0
		 */
		var $dwPayTypeId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPayTypeId_u; //uint8_t

		/**
		 * 配送方式id
		 *
		 * 版本 >= 0
		 */
		var $dwShipTypeId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cShipTypeId_u; //uint8_t

		/**
		 * 分站id
		 *
		 * 版本 >= 0
		 */
		var $dwWhId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cWhId_u; //uint8_t

		/**
		 * 用户uid
		 *
		 * 版本 >= 0
		 */
		var $dwUid; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cUid_u; //uint8_t

		/**
		 * 用户类型
		 *
		 * 版本 >= 0
		 */
		var $strUserType; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cUserType_u; //uint8_t

		/**
		 * 购物车类型
		 *
		 * 版本 >= 0
		 */
		var $dwCartType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cCartType_u; //uint8_t

		/**
		 * 商品id列表
		 *
		 * 版本 >= 0
		 */
		var $vecProductIdList; //std::vector<uint32_t> 

		/**
		 * 版本 >= 0
		 */
		var $cProductIdList_u; //uint8_t

		/**
		 * 价格
		 *
		 * 版本 >= 0
		 */
		var $dwPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPrice_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwPayTypeId = 0; // uint32_t
			 $this->cPayTypeId_u = 0; // uint8_t
			 $this->dwShipTypeId = 0; // uint32_t
			 $this->cShipTypeId_u = 0; // uint8_t
			 $this->dwWhId = 0; // uint32_t
			 $this->cWhId_u = 0; // uint8_t
			 $this->dwUid = 0; // uint32_t
			 $this->cUid_u = 0; // uint8_t
			 $this->strUserType = ""; // std::string
			 $this->cUserType_u = 0; // uint8_t
			 $this->dwCartType = 0; // uint32_t
			 $this->cCartType_u = 0; // uint8_t
			 $this->vecProductIdList = new stl_vector('uint32_t'); // std::vector<uint32_t> 
			 $this->cProductIdList_u = 0; // uint8_t
			 $this->dwPrice = 0; // uint32_t
			 $this->cPrice_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化协议版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPayTypeId); // 序列化支付方式id 类型为uint32_t
			$bs->pushUint8_t($this->cPayTypeId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwShipTypeId); // 序列化配送方式id 类型为uint32_t
			$bs->pushUint8_t($this->cShipTypeId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwWhId); // 序列化分站id 类型为uint32_t
			$bs->pushUint8_t($this->cWhId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwUid); // 序列化用户uid 类型为uint32_t
			$bs->pushUint8_t($this->cUid_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strUserType); // 序列化用户类型 类型为std::string
			$bs->pushUint8_t($this->cUserType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwCartType); // 序列化购物车类型 类型为uint32_t
			$bs->pushUint8_t($this->cCartType_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecProductIdList,'stl_vector'); // 序列化商品id列表 类型为std::vector<uint32_t> 
			$bs->pushUint8_t($this->cProductIdList_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPrice); // 序列化价格 类型为uint32_t
			$bs->pushUint8_t($this->cPrice_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化协议版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPayTypeId = $bs->popUint32_t(); // 反序列化支付方式id 类型为uint32_t
			$this->cPayTypeId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwShipTypeId = $bs->popUint32_t(); // 反序列化配送方式id 类型为uint32_t
			$this->cShipTypeId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwWhId = $bs->popUint32_t(); // 反序列化分站id 类型为uint32_t
			$this->cWhId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwUid = $bs->popUint32_t(); // 反序列化用户uid 类型为uint32_t
			$this->cUid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strUserType = $bs->popString(); // 反序列化用户类型 类型为std::string
			$this->cUserType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwCartType = $bs->popUint32_t(); // 反序列化购物车类型 类型为uint32_t
			$this->cCartType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecProductIdList = $bs->popObject('stl_vector<uint32_t>'); // 反序列化商品id列表 类型为std::vector<uint32_t> 
			$this->cProductIdList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPrice = $bs->popUint32_t(); // 反序列化价格 类型为uint32_t
			$this->cPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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