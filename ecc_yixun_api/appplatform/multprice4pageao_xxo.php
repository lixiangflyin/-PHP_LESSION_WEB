<?php

//source idl: com.icson.multprice.idl.MultPrice4PageAo.java

if (!class_exists('ViewTimedPricePo',false)) {
class ViewTimedPricePo
{
		/**
		 *  �汾��   
		 *
		 * �汾 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 *  timedPrice index �Ϸ�ֵΪ1-10�����֧��10��timefield������ ����coss���5��(1-5)���û�5�� 10�������� TODO:
		 *
		 * �汾 >= 0
		 */
		var $wTimedPriceIndex; //uint16_t

		/**
		 * �汾 >= 0
		 */
		var $cTimedPriceIndex_u; //uint8_t

		/**
		 * ���״̬ 0-����� 1-����� 2-��ֹ 3-ɾ��
		 *
		 * �汾 >= 0
		 */
		var $wTimedPriceState; //uint16_t

		/**
		 * �汾 >= 0
		 */
		var $cTimedPriceState_u; //uint8_t

		/**
		 *  �������� ֧��64���ַ�
		 *
		 * �汾 >= 0
		 */
		var $strTimedPriceName; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cTimedPriceName_u; //uint8_t

		/**
		 *  timedPrice ����,�ɲ��defaultΪ1��
		 *
		 * �汾 >= 0
		 */
		var $wTimedPriceCount; //uint16_t

		/**
		 * �汾 >= 0
		 */
		var $cTimedPriceCount_u; //uint8_t

		/**
		 *  timedPrice ����ʱ�� ��λs������ �ɽ���ʱ��-��ʼʱ�� 
		 *
		 * �汾 >= 0
		 */
		var $dwTimedPriceLastLong; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cTimedPriceLastLong_u; //uint8_t

		/**
		 *  timedPrice ��ʼʱ�� ����
		 *
		 * �汾 >= 0
		 */
		var $dwTimedPriceStartTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cTimedPriceStartTime_u; //uint8_t

		/**
		 *  timedPrice �۸�������ͣ�����(��ȷ��Ϊ10000) �ۼ� ���� ԭ�۲���ȣ�����
		 *
		 * �汾 >= 0
		 */
		var $wTimedPriceOperationType; //uint16_t

		/**
		 * �汾 >= 0
		 */
		var $cTimedPriceOperationType_u; //uint8_t

		/**
		 *  timedPrice ������ ���������Ϊ���� �˶�Ӧ��������ۿ� Ϊ�۸��� ��λ�� ����
		 *
		 * �汾 >= 0
		 */
		var $dwTimedPriceOperationNum; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cTimedPriceOperationNum_u; //uint8_t

		/**
		 *  timedPrice ���� �����ڶ��ӿ�
		 *
		 * �汾 >= 0
		 */
		var $dwTimedPriceProperty; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cTimedPriceProperty_u; //uint8_t

		/**
		 *  timedPrice �Զ�����������ݲ���
		 *
		 * �汾 >= 0
		 */
		var $strTimedPriceCustomerPromotionRule; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cTimedPriceCustomerPromotionRule_u; //uint8_t

		/**
		 *  timedPrice �۸��׼���ͣ�����
		 *
		 * �汾 >= 0
		 */
		var $wTimedPriceBasePriceType; //uint16_t

		/**
		 * �汾 >= 0
		 */
		var $cTimedPriceBasePriceType_u; //uint8_t

		/**
		 *  ���������������֧��120����(�ַ�) ѡ��
		 *
		 * �汾 >= 0
		 */
		var $strTimedPricePromotionDesc; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cTimedPricePromotionDesc_u; //uint8_t

		/**
		 * ������Ч����
		 *
		 * �汾 >= 0
		 */
		var $dwTimedPriceMaxUseNum; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cTimedPriceMaxUseNum_u; //uint8_t

		/**
		 * ���òֿ⣬��ʽ������
		 *
		 * �汾 >= 0
		 */
		var $strTimedPriceStoreHouse; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cTimedPriceStoreHouse_u; //uint8_t

		/**
		 * �����id����ʽ������
		 *
		 * �汾 >= 0
		 */
		var $strTimedPriceActiveId; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cTimedPriceActiveId_u; //uint8_t

		/**
		 * �ɱ���̯�� ������
		 *
		 * �汾 >= 0
		 */
		var $dwTimedPriceCostResponse; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cTimedPriceCostResponse_u; //uint8_t

		/**
		 * Ԥ��ʱ��ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwTimedPriceForeCastTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cTimedPriceForeCastTime_u; //uint8_t

		/**
		 * �޹�����
		 *
		 * �汾 >= 0
		 */
		var $strTimedPriceBuyLimitRule; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cTimedPriceBuyLimitRule_u; //uint8_t

		/**
		 * ��չ�ֶ�
		 *
		 * �汾 >= 0
		 */
		var $mapExt; //std::map<std::string,std::string> 

		/**
		 * �汾 >= 0
		 */
		var $cExt_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->wTimedPriceIndex = 0; // uint16_t
			 $this->cTimedPriceIndex_u = 0; // uint8_t
			 $this->wTimedPriceState = 0; // uint16_t
			 $this->cTimedPriceState_u = 0; // uint8_t
			 $this->strTimedPriceName = ""; // std::string
			 $this->cTimedPriceName_u = 0; // uint8_t
			 $this->wTimedPriceCount = 0; // uint16_t
			 $this->cTimedPriceCount_u = 0; // uint8_t
			 $this->dwTimedPriceLastLong = 0; // uint32_t
			 $this->cTimedPriceLastLong_u = 0; // uint8_t
			 $this->dwTimedPriceStartTime = 0; // uint32_t
			 $this->cTimedPriceStartTime_u = 0; // uint8_t
			 $this->wTimedPriceOperationType = 0; // uint16_t
			 $this->cTimedPriceOperationType_u = 0; // uint8_t
			 $this->dwTimedPriceOperationNum = 0; // uint32_t
			 $this->cTimedPriceOperationNum_u = 0; // uint8_t
			 $this->dwTimedPriceProperty = 0; // uint32_t
			 $this->cTimedPriceProperty_u = 0; // uint8_t
			 $this->strTimedPriceCustomerPromotionRule = ""; // std::string
			 $this->cTimedPriceCustomerPromotionRule_u = 0; // uint8_t
			 $this->wTimedPriceBasePriceType = 0; // uint16_t
			 $this->cTimedPriceBasePriceType_u = 0; // uint8_t
			 $this->strTimedPricePromotionDesc = ""; // std::string
			 $this->cTimedPricePromotionDesc_u = 0; // uint8_t
			 $this->dwTimedPriceMaxUseNum = 0; // uint32_t
			 $this->cTimedPriceMaxUseNum_u = 0; // uint8_t
			 $this->strTimedPriceStoreHouse = ""; // std::string
			 $this->cTimedPriceStoreHouse_u = 0; // uint8_t
			 $this->strTimedPriceActiveId = ""; // std::string
			 $this->cTimedPriceActiveId_u = 0; // uint8_t
			 $this->dwTimedPriceCostResponse = 0; // uint32_t
			 $this->cTimedPriceCostResponse_u = 0; // uint8_t
			 $this->dwTimedPriceForeCastTime = 0; // uint32_t
			 $this->cTimedPriceForeCastTime_u = 0; // uint8_t
			 $this->strTimedPriceBuyLimitRule = ""; // std::string
			 $this->cTimedPriceBuyLimitRule_u = 0; // uint8_t
			 $this->mapExt = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
			 $this->cExt_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // ���л� �汾��    ����Ϊuint32_t
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint16_t($this->wTimedPriceIndex); // ���л� timedPrice index �Ϸ�ֵΪ1-10�����֧��10��timefield������ ����coss���5��(1-5)���û�5�� 10�������� TODO: ����Ϊuint16_t
			$bs->pushUint8_t($this->cTimedPriceIndex_u); // ���л� ����Ϊuint8_t
			$bs->pushUint16_t($this->wTimedPriceState); // ���л����״̬ 0-����� 1-����� 2-��ֹ 3-ɾ�� ����Ϊuint16_t
			$bs->pushUint8_t($this->cTimedPriceState_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strTimedPriceName); // ���л� �������� ֧��64���ַ� ����Ϊstd::string
			$bs->pushUint8_t($this->cTimedPriceName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint16_t($this->wTimedPriceCount); // ���л� timedPrice ����,�ɲ��defaultΪ1�� ����Ϊuint16_t
			$bs->pushUint8_t($this->cTimedPriceCount_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwTimedPriceLastLong); // ���л� timedPrice ����ʱ�� ��λs������ �ɽ���ʱ��-��ʼʱ��  ����Ϊuint32_t
			$bs->pushUint8_t($this->cTimedPriceLastLong_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwTimedPriceStartTime); // ���л� timedPrice ��ʼʱ�� ���� ����Ϊuint32_t
			$bs->pushUint8_t($this->cTimedPriceStartTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint16_t($this->wTimedPriceOperationType); // ���л� timedPrice �۸�������ͣ�����(��ȷ��Ϊ10000) �ۼ� ���� ԭ�۲���ȣ����� ����Ϊuint16_t
			$bs->pushUint8_t($this->cTimedPriceOperationType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwTimedPriceOperationNum); // ���л� timedPrice ������ ���������Ϊ���� �˶�Ӧ��������ۿ� Ϊ�۸��� ��λ�� ���� ����Ϊuint32_t
			$bs->pushUint8_t($this->cTimedPriceOperationNum_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwTimedPriceProperty); // ���л� timedPrice ���� �����ڶ��ӿ� ����Ϊuint32_t
			$bs->pushUint8_t($this->cTimedPriceProperty_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strTimedPriceCustomerPromotionRule); // ���л� timedPrice �Զ�����������ݲ��� ����Ϊstd::string
			$bs->pushUint8_t($this->cTimedPriceCustomerPromotionRule_u); // ���л� ����Ϊuint8_t
			$bs->pushUint16_t($this->wTimedPriceBasePriceType); // ���л� timedPrice �۸��׼���ͣ����� ����Ϊuint16_t
			$bs->pushUint8_t($this->cTimedPriceBasePriceType_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strTimedPricePromotionDesc); // ���л� ���������������֧��120����(�ַ�) ѡ�� ����Ϊstd::string
			$bs->pushUint8_t($this->cTimedPricePromotionDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwTimedPriceMaxUseNum); // ���л�������Ч���� ����Ϊuint32_t
			$bs->pushUint8_t($this->cTimedPriceMaxUseNum_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strTimedPriceStoreHouse); // ���л����òֿ⣬��ʽ������ ����Ϊstd::string
			$bs->pushUint8_t($this->cTimedPriceStoreHouse_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strTimedPriceActiveId); // ���л������id����ʽ������ ����Ϊstd::string
			$bs->pushUint8_t($this->cTimedPriceActiveId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwTimedPriceCostResponse); // ���л��ɱ���̯�� ������ ����Ϊuint32_t
			$bs->pushUint8_t($this->cTimedPriceCostResponse_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwTimedPriceForeCastTime); // ���л�Ԥ��ʱ��ʱ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cTimedPriceForeCastTime_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strTimedPriceBuyLimitRule); // ���л��޹����� ����Ϊstd::string
			$bs->pushUint8_t($this->cTimedPriceBuyLimitRule_u); // ���л� ����Ϊuint8_t
			$bs->pushObject($this->mapExt,'stl_map'); // ���л���չ�ֶ� ����Ϊstd::map<std::string,std::string> 
			$bs->pushUint8_t($this->cExt_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // �����л� �汾��    ����Ϊuint32_t
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->wTimedPriceIndex = $bs->popUint16_t(); // �����л� timedPrice index �Ϸ�ֵΪ1-10�����֧��10��timefield������ ����coss���5��(1-5)���û�5�� 10�������� TODO: ����Ϊuint16_t
			$this->cTimedPriceIndex_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->wTimedPriceState = $bs->popUint16_t(); // �����л����״̬ 0-����� 1-����� 2-��ֹ 3-ɾ�� ����Ϊuint16_t
			$this->cTimedPriceState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strTimedPriceName = $bs->popString(); // �����л� �������� ֧��64���ַ� ����Ϊstd::string
			$this->cTimedPriceName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->wTimedPriceCount = $bs->popUint16_t(); // �����л� timedPrice ����,�ɲ��defaultΪ1�� ����Ϊuint16_t
			$this->cTimedPriceCount_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwTimedPriceLastLong = $bs->popUint32_t(); // �����л� timedPrice ����ʱ�� ��λs������ �ɽ���ʱ��-��ʼʱ��  ����Ϊuint32_t
			$this->cTimedPriceLastLong_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwTimedPriceStartTime = $bs->popUint32_t(); // �����л� timedPrice ��ʼʱ�� ���� ����Ϊuint32_t
			$this->cTimedPriceStartTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->wTimedPriceOperationType = $bs->popUint16_t(); // �����л� timedPrice �۸�������ͣ�����(��ȷ��Ϊ10000) �ۼ� ���� ԭ�۲���ȣ����� ����Ϊuint16_t
			$this->cTimedPriceOperationType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwTimedPriceOperationNum = $bs->popUint32_t(); // �����л� timedPrice ������ ���������Ϊ���� �˶�Ӧ��������ۿ� Ϊ�۸��� ��λ�� ���� ����Ϊuint32_t
			$this->cTimedPriceOperationNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwTimedPriceProperty = $bs->popUint32_t(); // �����л� timedPrice ���� �����ڶ��ӿ� ����Ϊuint32_t
			$this->cTimedPriceProperty_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strTimedPriceCustomerPromotionRule = $bs->popString(); // �����л� timedPrice �Զ�����������ݲ��� ����Ϊstd::string
			$this->cTimedPriceCustomerPromotionRule_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->wTimedPriceBasePriceType = $bs->popUint16_t(); // �����л� timedPrice �۸��׼���ͣ����� ����Ϊuint16_t
			$this->cTimedPriceBasePriceType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strTimedPricePromotionDesc = $bs->popString(); // �����л� ���������������֧��120����(�ַ�) ѡ�� ����Ϊstd::string
			$this->cTimedPricePromotionDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwTimedPriceMaxUseNum = $bs->popUint32_t(); // �����л�������Ч���� ����Ϊuint32_t
			$this->cTimedPriceMaxUseNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strTimedPriceStoreHouse = $bs->popString(); // �����л����òֿ⣬��ʽ������ ����Ϊstd::string
			$this->cTimedPriceStoreHouse_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strTimedPriceActiveId = $bs->popString(); // �����л������id����ʽ������ ����Ϊstd::string
			$this->cTimedPriceActiveId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwTimedPriceCostResponse = $bs->popUint32_t(); // �����л��ɱ���̯�� ������ ����Ϊuint32_t
			$this->cTimedPriceCostResponse_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwTimedPriceForeCastTime = $bs->popUint32_t(); // �����л�Ԥ��ʱ��ʱ�� ����Ϊuint32_t
			$this->cTimedPriceForeCastTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strTimedPriceBuyLimitRule = $bs->popString(); // �����л��޹����� ����Ϊstd::string
			$this->cTimedPriceBuyLimitRule_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->mapExt = $bs->popObject('stl_map<stl_string,stl_string>'); // �����л���չ�ֶ� ����Ϊstd::map<std::string,std::string> 
			$this->cExt_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.icson.multprice.idl.MultPrice4PageAo.java

if (!class_exists('MultPriceRules4PageBo',false)) {
class MultPriceRules4PageBo
{
		/**
		 *  �汾��   
		 *
		 * �汾 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * ��Ʒid,���÷�����
		 *
		 * �汾 >= 0
		 */
		var $strItemId; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cItemId_u; //uint8_t

		/**
		 * sku id ,�о�д,�Ժ������,ѡ��
		 *
		 * �汾 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * ��۹���Bo,string��Ӧ����id
		 *
		 * �汾 >= 0
		 */
		var $mapMultPrice4PageBoList; //std::map<std::string,icson::multprice::bo::CMultPrice4PageBo> 

		/**
		 * �汾 >= 0
		 */
		var $cMultPriceRuleBo_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->strItemId = ""; // std::string
			 $this->cItemId_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->mapMultPrice4PageBoList = new stl_map('stl_string,MultPrice4PageBo'); // std::map<std::string,icson::multprice::bo::CMultPrice4PageBo> 
			 $this->cMultPriceRuleBo_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // ���л� �汾��    ����Ϊuint32_t
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strItemId); // ���л���Ʒid,���÷����� ����Ϊstd::string
			$bs->pushUint8_t($this->cItemId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwSkuId); // ���л�sku id ,�о�д,�Ժ������,ѡ�� ����Ϊuint64_t
			$bs->pushUint8_t($this->cSkuId_u); // ���л� ����Ϊuint8_t
			$bs->pushObject($this->mapMultPrice4PageBoList,'stl_map'); // ���л���۹���Bo,string��Ӧ����id ����Ϊstd::map<std::string,icson::multprice::bo::CMultPrice4PageBo> 
			$bs->pushUint8_t($this->cMultPriceRuleBo_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // �����л� �汾��    ����Ϊuint32_t
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strItemId = $bs->popString(); // �����л���Ʒid,���÷����� ����Ϊstd::string
			$this->cItemId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // �����л�sku id ,�о�д,�Ժ������,ѡ�� ����Ϊuint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->mapMultPrice4PageBoList = $bs->popObject('stl_map<stl_string,MultPrice4PageBo>'); // �����л���۹���Bo,string��Ӧ����id ����Ϊstd::map<std::string,icson::multprice::bo::CMultPrice4PageBo> 
			$this->cMultPriceRuleBo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.icson.multprice.idl.MultPriceRules4PageBo.java

if (!class_exists('MultPrice4PageBo',false)) {
class MultPrice4PageBo
{
		/**
		 * �汾��
		 *
		 * �汾 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �۸����ͣ�0:��׼��;1:������;2:��Դ��;3:���ּ�;4:��ݼ�;5.��Դ������; ����
		 *
		 * �汾 >= 0
		 */
		var $dwPriceType; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceType_u; //uint8_t

		/**
		 * �۸������������ʱ��Ϊ���ڶ���۸�ʱ��ѡ��ĸ���
		 *
		 * �汾 >= 0
		 */
		var $dwPriceIndex; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceIndex_u; //uint8_t

		/**
		 * skuId������
		 *
		 * �汾 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * ���� id������
		 *
		 * �汾 >= 0
		 */
		var $dwRegionId; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cRegionId_u; //uint8_t

		/**
		 * ���� id
		 *
		 * �汾 >= 0
		 */
		var $ddwPriceSceneId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceSceneId_u; //uint8_t

		/**
		 * ��Դ id
		 *
		 * �汾 >= 0
		 */
		var $ddwPriceSourceId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceSourceId_u; //uint8_t

		/**
		 * ��۳ɱ���̯����
		 *
		 * �汾 >= 0
		 */
		var $strPriceCostRatio; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPriceCostRatio_u; //uint8_t

		/**
		 * ��۹���������ѡ��
		 *
		 * �汾 >= 0
		 */
		var $strPriceDesc; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPriceDesc_u; //uint8_t

		/**
		 * ���������
		 *
		 * �汾 >= 0
		 */
		var $strPricePromotionDesc; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPricePromotionDesc_u; //uint8_t

		/**
		 * �����url
		 *
		 * �汾 >= 0
		 */
		var $strPricePromotionUrl; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPricePromotionUrl_u; //uint8_t

		/**
		 * ���۵Ļ�׼�ۣ�������Ʒ������
		 *
		 * �汾 >= 0
		 */
		var $dwPriceBase; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceBase_u; //uint8_t

		/**
		 * ��Ʒ������۵��Żݷ�ʽ��1�ۿۣ�2���ۣ�3����
		 *
		 * �汾 >= 0
		 */
		var $dwPricePromoteType; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPricePromoteType_u; //uint8_t

		/**
		 * ��Ʒ������۵Ĳ�������98�۴� 98����10Ԫ�� 10������Ϊ5Ԫ�� 5
		 *
		 * �汾 >= 0
		 */
		var $dwUnitPriceOpNum; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cUnitPriceOpNum_u; //uint8_t

		/**
		 * �ÿ���Ʒ���Ż�ǰ�۸�
		 *
		 * �汾 >= 0
		 */
		var $dwPriceBeforePromoted; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceBeforePromoted_u; //uint8_t

		/**
		 * �ÿ���Ʒ���Żݺ�۸�
		 *
		 * �汾 >= 0
		 */
		var $dwPriceAfterPromoted; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceAfterPromoted_u; //uint8_t

		/**
		 * �Ƿ��޹�,ѡ��
		 *
		 * �汾 >= 0
		 */
		var $dwPriceBuyLimitFlag; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceBuyLimitFlag_u; //uint8_t

		/**
		 * �����޹�����,ѡ��
		 *
		 * �汾 >= 0
		 */
		var $dwPriceBuyMaxLimit; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceBuyMaxLimit_u; //uint8_t

		/**
		 * ʣ���޹�����,ѡ��
		 *
		 * �汾 >= 0
		 */
		var $dwPriceBuyRestLimit; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceBuyRestLimit_u; //uint8_t

		/**
		 * ����ά��,��ʵ�ּ۸���� ��ʽ����
		 *
		 * �汾 >= 0
		 */
		var $strPriceNumber; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPriceNumber_u; //uint8_t

		/**
		 * ʱ����� ������
		 *
		 * �汾 >= 0
		 */
		var $vecTimeLadderPrice; //std::vector<icson::multprice::bo::CViewTimedPricePo> 

		/**
		 * �汾 >= 0
		 */
		var $cTimeLadderPrice_u; //uint8_t

		/**
		 * ����ʼʱ�䣬����
		 *
		 * �汾 >= 0
		 */
		var $dwPriceStartTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceStartTime_u; //uint8_t

		/**
		 * �������ʱ�䣬����
		 *
		 * �汾 >= 0
		 */
		var $dwPriceEndTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceEndTime_u; //uint8_t

		/**
		 * Ԥ��ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwPriceForeCastTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceForeCastTime_u; //uint8_t

		/**
		 * ��չ�ֶ�
		 *
		 * �汾 >= 0
		 */
		var $mapExt; //std::map<std::string,std::string> 

		/**
		 * �汾 >= 0
		 */
		var $cExt_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwPriceType = 0; // uint32_t
			 $this->cPriceType_u = 0; // uint8_t
			 $this->dwPriceIndex = 0; // uint32_t
			 $this->cPriceIndex_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->dwRegionId = 0; // uint32_t
			 $this->cRegionId_u = 0; // uint8_t
			 $this->ddwPriceSceneId = 0; // uint64_t
			 $this->cPriceSceneId_u = 0; // uint8_t
			 $this->ddwPriceSourceId = 0; // uint64_t
			 $this->cPriceSourceId_u = 0; // uint8_t
			 $this->strPriceCostRatio = ""; // std::string
			 $this->cPriceCostRatio_u = 0; // uint8_t
			 $this->strPriceDesc = ""; // std::string
			 $this->cPriceDesc_u = 0; // uint8_t
			 $this->strPricePromotionDesc = ""; // std::string
			 $this->cPricePromotionDesc_u = 0; // uint8_t
			 $this->strPricePromotionUrl = ""; // std::string
			 $this->cPricePromotionUrl_u = 0; // uint8_t
			 $this->dwPriceBase = 0; // uint32_t
			 $this->cPriceBase_u = 0; // uint8_t
			 $this->dwPricePromoteType = 0; // uint32_t
			 $this->cPricePromoteType_u = 0; // uint8_t
			 $this->dwUnitPriceOpNum = 0; // uint32_t
			 $this->cUnitPriceOpNum_u = 0; // uint8_t
			 $this->dwPriceBeforePromoted = 0; // uint32_t
			 $this->cPriceBeforePromoted_u = 0; // uint8_t
			 $this->dwPriceAfterPromoted = 0; // uint32_t
			 $this->cPriceAfterPromoted_u = 0; // uint8_t
			 $this->dwPriceBuyLimitFlag = 0; // uint32_t
			 $this->cPriceBuyLimitFlag_u = 0; // uint8_t
			 $this->dwPriceBuyMaxLimit = 0; // uint32_t
			 $this->cPriceBuyMaxLimit_u = 0; // uint8_t
			 $this->dwPriceBuyRestLimit = 0; // uint32_t
			 $this->cPriceBuyRestLimit_u = 0; // uint8_t
			 $this->strPriceNumber = ""; // std::string
			 $this->cPriceNumber_u = 0; // uint8_t
			 $this->vecTimeLadderPrice = new stl_vector('ViewTimedPricePo'); // std::vector<icson::multprice::bo::CViewTimedPricePo> 
			 $this->cTimeLadderPrice_u = 0; // uint8_t
			 $this->dwPriceStartTime = 0; // uint32_t
			 $this->cPriceStartTime_u = 0; // uint8_t
			 $this->dwPriceEndTime = 0; // uint32_t
			 $this->cPriceEndTime_u = 0; // uint8_t
			 $this->dwPriceForeCastTime = 0; // uint32_t
			 $this->cPriceForeCastTime_u = 0; // uint8_t
			 $this->mapExt = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
			 $this->cExt_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // ���л��汾�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceType); // ���л��۸����ͣ�0:��׼��;1:������;2:��Դ��;3:���ּ�;4:��ݼ�;5.��Դ������; ���� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceIndex); // ���л��۸������������ʱ��Ϊ���ڶ���۸�ʱ��ѡ��ĸ��� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceIndex_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwSkuId); // ���л�skuId������ ����Ϊuint64_t
			$bs->pushUint8_t($this->cSkuId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwRegionId); // ���л����� id������ ����Ϊuint32_t
			$bs->pushUint8_t($this->cRegionId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwPriceSceneId); // ���л����� id ����Ϊuint64_t
			$bs->pushUint8_t($this->cPriceSceneId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwPriceSourceId); // ���л���Դ id ����Ϊuint64_t
			$bs->pushUint8_t($this->cPriceSourceId_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceCostRatio); // ���л���۳ɱ���̯���� ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceCostRatio_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceDesc); // ���л���۹���������ѡ�� ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPricePromotionDesc); // ���л���������� ����Ϊstd::string
			$bs->pushUint8_t($this->cPricePromotionDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPricePromotionUrl); // ���л������url ����Ϊstd::string
			$bs->pushUint8_t($this->cPricePromotionUrl_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceBase); // ���л����۵Ļ�׼�ۣ�������Ʒ������ ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceBase_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPricePromoteType); // ���л���Ʒ������۵��Żݷ�ʽ��1�ۿۣ�2���ۣ�3���� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPricePromoteType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwUnitPriceOpNum); // ���л���Ʒ������۵Ĳ�������98�۴� 98����10Ԫ�� 10������Ϊ5Ԫ�� 5 ����Ϊuint32_t
			$bs->pushUint8_t($this->cUnitPriceOpNum_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceBeforePromoted); // ���л��ÿ���Ʒ���Ż�ǰ�۸� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceBeforePromoted_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceAfterPromoted); // ���л��ÿ���Ʒ���Żݺ�۸� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceAfterPromoted_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceBuyLimitFlag); // ���л��Ƿ��޹�,ѡ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceBuyLimitFlag_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceBuyMaxLimit); // ���л������޹�����,ѡ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceBuyMaxLimit_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceBuyRestLimit); // ���л�ʣ���޹�����,ѡ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceBuyRestLimit_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceNumber); // ���л�����ά��,��ʵ�ּ۸���� ��ʽ���� ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceNumber_u); // ���л� ����Ϊuint8_t
			$bs->pushObject($this->vecTimeLadderPrice,'stl_vector'); // ���л�ʱ����� ������ ����Ϊstd::vector<icson::multprice::bo::CViewTimedPricePo> 
			$bs->pushUint8_t($this->cTimeLadderPrice_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceStartTime); // ���л�����ʼʱ�䣬���� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceStartTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceEndTime); // ���л��������ʱ�䣬���� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceEndTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceForeCastTime); // ���л�Ԥ��ʱ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceForeCastTime_u); // ���л� ����Ϊuint8_t
			$bs->pushObject($this->mapExt,'stl_map'); // ���л���չ�ֶ� ����Ϊstd::map<std::string,std::string> 
			$bs->pushUint8_t($this->cExt_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // �����л��汾�� ����Ϊuint32_t
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceType = $bs->popUint32_t(); // �����л��۸����ͣ�0:��׼��;1:������;2:��Դ��;3:���ּ�;4:��ݼ�;5.��Դ������; ���� ����Ϊuint32_t
			$this->cPriceType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceIndex = $bs->popUint32_t(); // �����л��۸������������ʱ��Ϊ���ڶ���۸�ʱ��ѡ��ĸ��� ����Ϊuint32_t
			$this->cPriceIndex_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // �����л�skuId������ ����Ϊuint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwRegionId = $bs->popUint32_t(); // �����л����� id������ ����Ϊuint32_t
			$this->cRegionId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwPriceSceneId = $bs->popUint64_t(); // �����л����� id ����Ϊuint64_t
			$this->cPriceSceneId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwPriceSourceId = $bs->popUint64_t(); // �����л���Դ id ����Ϊuint64_t
			$this->cPriceSourceId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceCostRatio = $bs->popString(); // �����л���۳ɱ���̯���� ����Ϊstd::string
			$this->cPriceCostRatio_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceDesc = $bs->popString(); // �����л���۹���������ѡ�� ����Ϊstd::string
			$this->cPriceDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPricePromotionDesc = $bs->popString(); // �����л���������� ����Ϊstd::string
			$this->cPricePromotionDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPricePromotionUrl = $bs->popString(); // �����л������url ����Ϊstd::string
			$this->cPricePromotionUrl_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceBase = $bs->popUint32_t(); // �����л����۵Ļ�׼�ۣ�������Ʒ������ ����Ϊuint32_t
			$this->cPriceBase_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPricePromoteType = $bs->popUint32_t(); // �����л���Ʒ������۵��Żݷ�ʽ��1�ۿۣ�2���ۣ�3���� ����Ϊuint32_t
			$this->cPricePromoteType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwUnitPriceOpNum = $bs->popUint32_t(); // �����л���Ʒ������۵Ĳ�������98�۴� 98����10Ԫ�� 10������Ϊ5Ԫ�� 5 ����Ϊuint32_t
			$this->cUnitPriceOpNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceBeforePromoted = $bs->popUint32_t(); // �����л��ÿ���Ʒ���Ż�ǰ�۸� ����Ϊuint32_t
			$this->cPriceBeforePromoted_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceAfterPromoted = $bs->popUint32_t(); // �����л��ÿ���Ʒ���Żݺ�۸� ����Ϊuint32_t
			$this->cPriceAfterPromoted_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceBuyLimitFlag = $bs->popUint32_t(); // �����л��Ƿ��޹�,ѡ�� ����Ϊuint32_t
			$this->cPriceBuyLimitFlag_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceBuyMaxLimit = $bs->popUint32_t(); // �����л������޹�����,ѡ�� ����Ϊuint32_t
			$this->cPriceBuyMaxLimit_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceBuyRestLimit = $bs->popUint32_t(); // �����л�ʣ���޹�����,ѡ�� ����Ϊuint32_t
			$this->cPriceBuyRestLimit_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceNumber = $bs->popString(); // �����л�����ά��,��ʵ�ּ۸���� ��ʽ���� ����Ϊstd::string
			$this->cPriceNumber_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->vecTimeLadderPrice = $bs->popObject('stl_vector<ViewTimedPricePo>'); // �����л�ʱ����� ������ ����Ϊstd::vector<icson::multprice::bo::CViewTimedPricePo> 
			$this->cTimeLadderPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceStartTime = $bs->popUint32_t(); // �����л�����ʼʱ�䣬���� ����Ϊuint32_t
			$this->cPriceStartTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceEndTime = $bs->popUint32_t(); // �����л��������ʱ�䣬���� ����Ϊuint32_t
			$this->cPriceEndTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceForeCastTime = $bs->popUint32_t(); // �����л�Ԥ��ʱ�� ����Ϊuint32_t
			$this->cPriceForeCastTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->mapExt = $bs->popObject('stl_map<stl_string,stl_string>'); // �����л���չ�ֶ� ����Ϊstd::map<std::string,std::string> 
			$this->cExt_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.icson.multprice.idl.MultPrice4PageAo.java

if (!class_exists('MultPriceItem4PageBo',false)) {
class MultPriceItem4PageBo
{
		/**
		 *  �汾�� 
		 *
		 * �汾 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * ��Ʒid,���÷�����
		 *
		 * �汾 >= 0
		 */
		var $strItemId; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cItemId_u; //uint8_t

		/**
		 * sku id ,�о�д,�Ժ������
		 *
		 * �汾 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * activeid,�id���ڻ�ȡ������,����
		 *
		 * �汾 >= 0
		 */
		var $ddwActiveid; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cActiveid_u; //uint8_t

		/**
		 * isAll,�Ƿ�ȡ�������͵ļ۸� 1:�� 0:�� ����
		 *
		 * �汾 >= 0
		 */
		var $dwIsAll; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cIsAll_u; //uint8_t

		/**
		 * isStockNum,�Ƿ�ȡ��� 1:�� 0:�� �����ʹѡ��ȡ���Ҳ���ü�Ȩ
		 *
		 * �汾 >= 0
		 */
		var $dwIsStockNum; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cIsStockNum_u; //uint8_t

		/**
		 * ��ʽSourceId:SceneId,���Ӽ۸����ͣ����÷�����
		 *
		 * �汾 >= 0
		 */
		var $vecAddtionPriceType; //std::vector<std::string> 

		/**
		 * �汾 >= 0
		 */
		var $cAddtionPriceType_u; //uint8_t

		/**
		 * �۸���Ч��ʼʱ��,���÷�����
		 *
		 * �汾 >= 0
		 */
		var $dwPriceStartTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceStartTime_u; //uint8_t

		/**
		 * �۸���Ч����ʱ��,���÷�����
		 *
		 * �汾 >= 0
		 */
		var $dwPriceEndTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceEndTime_u; //uint8_t

		/**
		 * ��չ�ֶ�
		 *
		 * �汾 >= 0
		 */
		var $mapExt; //std::map<std::string,std::string> 

		/**
		 * �汾 >= 0
		 */
		var $cExt_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->strItemId = ""; // std::string
			 $this->cItemId_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->ddwActiveid = 0; // uint64_t
			 $this->cActiveid_u = 0; // uint8_t
			 $this->dwIsAll = 0; // uint32_t
			 $this->cIsAll_u = 0; // uint8_t
			 $this->dwIsStockNum = 0; // uint32_t
			 $this->cIsStockNum_u = 0; // uint8_t
			 $this->vecAddtionPriceType = new stl_vector('stl_string'); // std::vector<std::string> 
			 $this->cAddtionPriceType_u = 0; // uint8_t
			 $this->dwPriceStartTime = 0; // uint32_t
			 $this->cPriceStartTime_u = 0; // uint8_t
			 $this->dwPriceEndTime = 0; // uint32_t
			 $this->cPriceEndTime_u = 0; // uint8_t
			 $this->mapExt = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
			 $this->cExt_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // ���л� �汾��  ����Ϊuint32_t
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strItemId); // ���л���Ʒid,���÷����� ����Ϊstd::string
			$bs->pushUint8_t($this->cItemId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwSkuId); // ���л�sku id ,�о�д,�Ժ������ ����Ϊuint64_t
			$bs->pushUint8_t($this->cSkuId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwActiveid); // ���л�activeid,�id���ڻ�ȡ������,���� ����Ϊuint64_t
			$bs->pushUint8_t($this->cActiveid_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwIsAll); // ���л�isAll,�Ƿ�ȡ�������͵ļ۸� 1:�� 0:�� ���� ����Ϊuint32_t
			$bs->pushUint8_t($this->cIsAll_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwIsStockNum); // ���л�isStockNum,�Ƿ�ȡ��� 1:�� 0:�� �����ʹѡ��ȡ���Ҳ���ü�Ȩ ����Ϊuint32_t
			$bs->pushUint8_t($this->cIsStockNum_u); // ���л� ����Ϊuint8_t
			$bs->pushObject($this->vecAddtionPriceType,'stl_vector'); // ���л���ʽSourceId:SceneId,���Ӽ۸����ͣ����÷����� ����Ϊstd::vector<std::string> 
			$bs->pushUint8_t($this->cAddtionPriceType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceStartTime); // ���л��۸���Ч��ʼʱ��,���÷����� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceStartTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceEndTime); // ���л��۸���Ч����ʱ��,���÷����� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceEndTime_u); // ���л� ����Ϊuint8_t
			$bs->pushObject($this->mapExt,'stl_map'); // ���л���չ�ֶ� ����Ϊstd::map<std::string,std::string> 
			$bs->pushUint8_t($this->cExt_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // �����л� �汾��  ����Ϊuint32_t
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strItemId = $bs->popString(); // �����л���Ʒid,���÷����� ����Ϊstd::string
			$this->cItemId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // �����л�sku id ,�о�д,�Ժ������ ����Ϊuint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwActiveid = $bs->popUint64_t(); // �����л�activeid,�id���ڻ�ȡ������,���� ����Ϊuint64_t
			$this->cActiveid_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwIsAll = $bs->popUint32_t(); // �����л�isAll,�Ƿ�ȡ�������͵ļ۸� 1:�� 0:�� ���� ����Ϊuint32_t
			$this->cIsAll_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwIsStockNum = $bs->popUint32_t(); // �����л�isStockNum,�Ƿ�ȡ��� 1:�� 0:�� �����ʹѡ��ȡ���Ҳ���ü�Ȩ ����Ϊuint32_t
			$this->cIsStockNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->vecAddtionPriceType = $bs->popObject('stl_vector<stl_string>'); // �����л���ʽSourceId:SceneId,���Ӽ۸����ͣ����÷����� ����Ϊstd::vector<std::string> 
			$this->cAddtionPriceType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceStartTime = $bs->popUint32_t(); // �����л��۸���Ч��ʼʱ��,���÷����� ����Ϊuint32_t
			$this->cPriceStartTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceEndTime = $bs->popUint32_t(); // �����л��۸���Ч����ʱ��,���÷����� ����Ϊuint32_t
			$this->cPriceEndTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->mapExt = $bs->popObject('stl_map<stl_string,stl_string>'); // �����л���չ�ֶ� ����Ϊstd::map<std::string,std::string> 
			$this->cExt_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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