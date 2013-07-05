<?php

//source idl: icson.score.ao.ScoreSubReq.java

if (!class_exists('SubScorePo',false)) {
class SubScorePo
{
		/**
		 * �汾�� 
		 *
		 * �汾 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * �ۼ����ֵ���Ѹid, ��֧��32λ������
		 *
		 * �汾 >= 0
		 */
		var $ddwUid; //uint64_t

		/**
		 * ������ϸ����(����),����
		 *
		 * �汾 >= 0
		 */
		var $dwType; //uint32_t

		/**
		 * ���Ź���id
		 *
		 * �汾 >= 0
		 */
		var $dwRuleId; //uint32_t

		/**
		 * ��Ѷ��Ա�ȼ����и��ݻ�Ա�ȼ�������ֵıش���������
		 *
		 * �汾 >= 0
		 */
		var $dwVipLevel; //uint32_t

		/**
		 * ���ֹ���������ӡ��и���ҵ��������м�����ֵıش��������۵���Ʒ�۸����͵Ķ����µ���
		 *
		 * �汾 >= 0
		 */
		var $dwFactor; //uint32_t

		/**
		 * �ۼ�������
		 *
		 * �汾 >= 0
		 */
		var $dwAddScoreNum; //uint32_t

		/**
		 * �ۼ��˻������
		 *
		 * �汾 >= 0
		 */
		var $dwAddCashNum; //uint32_t

		/**
		 * �Ƿ�ʹ�ÿۼ�����
		 *
		 * �汾 >= 0
		 */
		var $dwIsMulty; //uint32_t

		/**
		 * �Ƿ����ۼ�
		 *
		 * �汾 >= 0
		 */
		var $dwIsExtra; //uint32_t

		/**
		 * ���ű�ע,ҵ����д����д����Ӧ���׶��������ֶ�
		 *
		 * �汾 >= 0
		 */
		var $strRemarks; //std::string

		/**
		 * ������:�µ�ԭ��ۼ�ʱ�������ű���, ��������
		 *
		 * �汾 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * ������Ŀ��ʱ����д, ��������
		 *
		 * �汾 >= 0
		 */
		var $dwLimitclass; //uint32_t

		/**
		 * ������Ʒ��:��Ʒ����ʱ����
		 *
		 * �汾 >= 0
		 */
		var $strProductId; //std::string

		/**
		 * ��������1
		 *
		 * �汾 >= 0
		 */
		var $dwExt_1; //uint32_t

		/**
		 * ��������2
		 *
		 * �汾 >= 0
		 */
		var $dwExt_2; //uint32_t

		/**
		 * ��������3
		 *
		 * �汾 >= 0
		 */
		var $strExt_3; //std::string

		/**
		 * ��������4
		 *
		 * �汾 >= 0
		 */
		var $strExt_4; //std::string

		/**
		 * ��������4
		 *
		 * �汾 >= 0
		 */
		var $strExt_5; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cUid_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRuleId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cVipLevel_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cFactor_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cAddScoreNum_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cAddCashNum_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIsMulty_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIsExtra_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRemarks_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cLimitclass_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cProductId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExt_1_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExt_2_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExt_3_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExt_4_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExt_5_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->ddwUid = 0; // uint64_t
			 $this->dwType = 0; // uint32_t
			 $this->dwRuleId = 1; // uint32_t
			 $this->dwVipLevel = 0; // uint32_t
			 $this->dwFactor = 0; // uint32_t
			 $this->dwAddScoreNum = 0; // uint32_t
			 $this->dwAddCashNum = 0; // uint32_t
			 $this->dwIsMulty = 0; // uint32_t
			 $this->dwIsExtra = 0; // uint32_t
			 $this->strRemarks = ""; // std::string
			 $this->strDealId = ""; // std::string
			 $this->dwLimitclass = 0; // uint32_t
			 $this->strProductId = ""; // std::string
			 $this->dwExt_1 = 0; // uint32_t
			 $this->dwExt_2 = 0; // uint32_t
			 $this->strExt_3 = ""; // std::string
			 $this->strExt_4 = ""; // std::string
			 $this->strExt_5 = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cUid_u = 0; // uint8_t
			 $this->cType_u = 0; // uint8_t
			 $this->cRuleId_u = 0; // uint8_t
			 $this->cVipLevel_u = 0; // uint8_t
			 $this->cFactor_u = 0; // uint8_t
			 $this->cAddScoreNum_u = 0; // uint8_t
			 $this->cAddCashNum_u = 0; // uint8_t
			 $this->cIsMulty_u = 0; // uint8_t
			 $this->cIsExtra_u = 0; // uint8_t
			 $this->cRemarks_u = 0; // uint8_t
			 $this->cDealId_u = 0; // uint8_t
			 $this->cLimitclass_u = 0; // uint8_t
			 $this->cProductId_u = 0; // uint8_t
			 $this->cExt_1_u = 0; // uint8_t
			 $this->cExt_2_u = 0; // uint8_t
			 $this->cExt_3_u = 0; // uint8_t
			 $this->cExt_4_u = 0; // uint8_t
			 $this->cExt_5_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // ���л��汾��  ����Ϊuint32_t
			$bs->pushUint64_t($this->ddwUid); // ���л��ۼ����ֵ���Ѹid, ��֧��32λ������ ����Ϊuint64_t
			$bs->pushUint32_t($this->dwType); // ���л�������ϸ����(����),���� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRuleId); // ���л����Ź���id ����Ϊuint32_t
			$bs->pushUint32_t($this->dwVipLevel); // ���л���Ѷ��Ա�ȼ����и��ݻ�Ա�ȼ�������ֵıش��������� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwFactor); // ���л����ֹ���������ӡ��и���ҵ��������м�����ֵıش��������۵���Ʒ�۸����͵Ķ����µ��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwAddScoreNum); // ���л��ۼ������� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwAddCashNum); // ���л��ۼ��˻������ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwIsMulty); // ���л��Ƿ�ʹ�ÿۼ����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwIsExtra); // ���л��Ƿ����ۼ� ����Ϊuint32_t
			$bs->pushString($this->strRemarks); // ���л����ű�ע,ҵ����д����д����Ӧ���׶��������ֶ� ����Ϊstd::string
			$bs->pushString($this->strDealId); // ���л�������:�µ�ԭ��ۼ�ʱ�������ű���, �������� ����Ϊstd::string
			$bs->pushUint32_t($this->dwLimitclass); // ���л�������Ŀ��ʱ����д, �������� ����Ϊuint32_t
			$bs->pushString($this->strProductId); // ���л�������Ʒ��:��Ʒ����ʱ���� ����Ϊstd::string
			$bs->pushUint32_t($this->dwExt_1); // ���л���������1 ����Ϊuint32_t
			$bs->pushUint32_t($this->dwExt_2); // ���л���������2 ����Ϊuint32_t
			$bs->pushString($this->strExt_3); // ���л���������3 ����Ϊstd::string
			$bs->pushString($this->strExt_4); // ���л���������4 ����Ϊstd::string
			$bs->pushString($this->strExt_5); // ���л���������4 ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cUid_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRuleId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cVipLevel_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cFactor_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cAddScoreNum_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cAddCashNum_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIsMulty_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIsExtra_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRemarks_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cLimitclass_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cProductId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExt_1_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExt_2_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExt_3_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExt_4_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExt_5_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // �����л��汾��  ����Ϊuint32_t
			$this->ddwUid = $bs->popUint64_t(); // �����л��ۼ����ֵ���Ѹid, ��֧��32λ������ ����Ϊuint64_t
			$this->dwType = $bs->popUint32_t(); // �����л�������ϸ����(����),���� ����Ϊuint32_t
			$this->dwRuleId = $bs->popUint32_t(); // �����л����Ź���id ����Ϊuint32_t
			$this->dwVipLevel = $bs->popUint32_t(); // �����л���Ѷ��Ա�ȼ����и��ݻ�Ա�ȼ�������ֵıش��������� ����Ϊuint32_t
			$this->dwFactor = $bs->popUint32_t(); // �����л����ֹ���������ӡ��и���ҵ��������м�����ֵıش��������۵���Ʒ�۸����͵Ķ����µ��� ����Ϊuint32_t
			$this->dwAddScoreNum = $bs->popUint32_t(); // �����л��ۼ������� ����Ϊuint32_t
			$this->dwAddCashNum = $bs->popUint32_t(); // �����л��ۼ��˻������ ����Ϊuint32_t
			$this->dwIsMulty = $bs->popUint32_t(); // �����л��Ƿ�ʹ�ÿۼ����� ����Ϊuint32_t
			$this->dwIsExtra = $bs->popUint32_t(); // �����л��Ƿ����ۼ� ����Ϊuint32_t
			$this->strRemarks = $bs->popString(); // �����л����ű�ע,ҵ����д����д����Ӧ���׶��������ֶ� ����Ϊstd::string
			$this->strDealId = $bs->popString(); // �����л�������:�µ�ԭ��ۼ�ʱ�������ű���, �������� ����Ϊstd::string
			$this->dwLimitclass = $bs->popUint32_t(); // �����л�������Ŀ��ʱ����д, �������� ����Ϊuint32_t
			$this->strProductId = $bs->popString(); // �����л�������Ʒ��:��Ʒ����ʱ���� ����Ϊstd::string
			$this->dwExt_1 = $bs->popUint32_t(); // �����л���������1 ����Ϊuint32_t
			$this->dwExt_2 = $bs->popUint32_t(); // �����л���������2 ����Ϊuint32_t
			$this->strExt_3 = $bs->popString(); // �����л���������3 ����Ϊstd::string
			$this->strExt_4 = $bs->popString(); // �����л���������4 ����Ϊstd::string
			$this->strExt_5 = $bs->popString(); // �����л���������4 ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cUid_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRuleId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cVipLevel_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cFactor_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cAddScoreNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cAddCashNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIsMulty_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIsExtra_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRemarks_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cLimitclass_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cProductId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExt_1_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExt_2_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExt_3_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExt_4_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExt_5_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: icson.score.ao.IcsonScoreAo.java

if (!class_exists('AddScorePo')) {
class AddScorePo
{
		/**
		 * �汾�� 
		 *
		 * �汾 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * ���Ż��ֵ���Ѹid, ��֧��32λ������
		 *
		 * �汾 >= 0
		 */
		var $ddwUid; //uint64_t

		/**
		 * ������ϸ����(����),����
		 *
		 * �汾 >= 0
		 */
		var $dwType; //uint32_t

		/**
		 * ���Ź���id
		 *
		 * �汾 >= 0
		 */
		var $dwRuleId; //uint32_t

		/**
		 * ��Ѷ��Ա�ȼ����и��ݻ�Ա�ȼ�������ֵıش���������
		 *
		 * �汾 >= 0
		 */
		var $dwVipLevel; //uint32_t

		/**
		 * ���ֹ���������ӡ��и���ҵ��������м�����ֵıش��������۵���Ʒ�۸����͵Ķ����µ���,��λ��
		 *
		 * �汾 >= 0
		 */
		var $dwFactor; //uint32_t

		/**
		 * ���Ŵ�����������ҵ��������ֵı��봫�ͣ���ERP����Ʒ��
		 *
		 * �汾 >= 0
		 */
		var $dwAddScoreNum; //uint32_t

		/**
		 * �����ֽ��������ҵ�������˻����ı��봫�ͣ��綩������
		 *
		 * �汾 >= 0
		 */
		var $dwAddCashNum; //uint32_t

		/**
		 * �Ƿ�ʹ�÷��ű���
		 *
		 * �汾 >= 0
		 */
		var $dwIsMulty; //uint32_t

		/**
		 * �Ƿ���⽱��
		 *
		 * �汾 >= 0
		 */
		var $dwIsExtra; //uint32_t

		/**
		 * ���ű�ע,ҵ����д����д����Ӧ���׶��������ֶ�
		 *
		 * �汾 >= 0
		 */
		var $strRemarks; //std::string

		/**
		 * ������:�����ۼ�������ȡ��������ԭ�򲹳������ѱ��ۼ��Ļ���ʱ,�����Ӧ�Ŀۼ��Ķ�����,��������
		 *
		 * �汾 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * ������Ŀ����Ҫ��д,��������
		 *
		 * �汾 >= 0
		 */
		var $dwLimitclass; //uint32_t

		/**
		 * ������Ʒ��:��Ʒ����ʱ����
		 *
		 * �汾 >= 0
		 */
		var $strProductId; //std::string

		/**
		 * ��������1
		 *
		 * �汾 >= 0
		 */
		var $dwExt_1; //uint32_t

		/**
		 * ��������2
		 *
		 * �汾 >= 0
		 */
		var $dwExt_2; //uint32_t

		/**
		 * ��������3
		 *
		 * �汾 >= 0
		 */
		var $strExt_3; //std::string

		/**
		 * ��������4
		 *
		 * �汾 >= 0
		 */
		var $strExt_4; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cUid_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRuleId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cVipLevel_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cFactor_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cAddScoreNum_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cAddCashNum_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIsMulty_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIsExtra_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRemarks_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cLimitclass_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cProductId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExt_1_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExt_2_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExt_3_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExt_4_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->ddwUid = 0; // uint64_t
			 $this->dwType = 0; // uint32_t
			 $this->dwRuleId = 1; // uint32_t
			 $this->dwVipLevel = 0; // uint32_t
			 $this->dwFactor = 0; // uint32_t
			 $this->dwAddScoreNum = 0; // uint32_t
			 $this->dwAddCashNum = 0; // uint32_t
			 $this->dwIsMulty = 0; // uint32_t
			 $this->dwIsExtra = 0; // uint32_t
			 $this->strRemarks = ""; // std::string
			 $this->strDealId = ""; // std::string
			 $this->dwLimitclass = 0; // uint32_t
			 $this->strProductId = ""; // std::string
			 $this->dwExt_1 = 0; // uint32_t
			 $this->dwExt_2 = 0; // uint32_t
			 $this->strExt_3 = ""; // std::string
			 $this->strExt_4 = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cUid_u = 0; // uint8_t
			 $this->cType_u = 0; // uint8_t
			 $this->cRuleId_u = 0; // uint8_t
			 $this->cVipLevel_u = 0; // uint8_t
			 $this->cFactor_u = 0; // uint8_t
			 $this->cAddScoreNum_u = 0; // uint8_t
			 $this->cAddCashNum_u = 0; // uint8_t
			 $this->cIsMulty_u = 0; // uint8_t
			 $this->cIsExtra_u = 0; // uint8_t
			 $this->cRemarks_u = 0; // uint8_t
			 $this->cDealId_u = 0; // uint8_t
			 $this->cLimitclass_u = 0; // uint8_t
			 $this->cProductId_u = 0; // uint8_t
			 $this->cExt_1_u = 0; // uint8_t
			 $this->cExt_2_u = 0; // uint8_t
			 $this->cExt_3_u = 0; // uint8_t
			 $this->cExt_4_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // ���л��汾��  ����Ϊuint32_t
			$bs->pushUint64_t($this->ddwUid); // ���л����Ż��ֵ���Ѹid, ��֧��32λ������ ����Ϊuint64_t
			$bs->pushUint32_t($this->dwType); // ���л�������ϸ����(����),���� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRuleId); // ���л����Ź���id ����Ϊuint32_t
			$bs->pushUint32_t($this->dwVipLevel); // ���л���Ѷ��Ա�ȼ����и��ݻ�Ա�ȼ�������ֵıش��������� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwFactor); // ���л����ֹ���������ӡ��и���ҵ��������м�����ֵıش��������۵���Ʒ�۸����͵Ķ����µ���,��λ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwAddScoreNum); // ���л����Ŵ�����������ҵ��������ֵı��봫�ͣ���ERP����Ʒ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwAddCashNum); // ���л������ֽ��������ҵ�������˻����ı��봫�ͣ��綩������ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwIsMulty); // ���л��Ƿ�ʹ�÷��ű��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwIsExtra); // ���л��Ƿ���⽱�� ����Ϊuint32_t
			$bs->pushString($this->strRemarks); // ���л����ű�ע,ҵ����д����д����Ӧ���׶��������ֶ� ����Ϊstd::string
			$bs->pushString($this->strDealId); // ���л�������:�����ۼ�������ȡ��������ԭ�򲹳������ѱ��ۼ��Ļ���ʱ,�����Ӧ�Ŀۼ��Ķ�����,�������� ����Ϊstd::string
			$bs->pushUint32_t($this->dwLimitclass); // ���л�������Ŀ����Ҫ��д,�������� ����Ϊuint32_t
			$bs->pushString($this->strProductId); // ���л�������Ʒ��:��Ʒ����ʱ���� ����Ϊstd::string
			$bs->pushUint32_t($this->dwExt_1); // ���л���������1 ����Ϊuint32_t
			$bs->pushUint32_t($this->dwExt_2); // ���л���������2 ����Ϊuint32_t
			$bs->pushString($this->strExt_3); // ���л���������3 ����Ϊstd::string
			$bs->pushString($this->strExt_4); // ���л���������4 ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cUid_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRuleId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cVipLevel_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cFactor_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cAddScoreNum_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cAddCashNum_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIsMulty_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIsExtra_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRemarks_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cLimitclass_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cProductId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExt_1_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExt_2_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExt_3_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExt_4_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // �����л��汾��  ����Ϊuint32_t
			$this->ddwUid = $bs->popUint64_t(); // �����л����Ż��ֵ���Ѹid, ��֧��32λ������ ����Ϊuint64_t
			$this->dwType = $bs->popUint32_t(); // �����л�������ϸ����(����),���� ����Ϊuint32_t
			$this->dwRuleId = $bs->popUint32_t(); // �����л����Ź���id ����Ϊuint32_t
			$this->dwVipLevel = $bs->popUint32_t(); // �����л���Ѷ��Ա�ȼ����и��ݻ�Ա�ȼ�������ֵıش��������� ����Ϊuint32_t
			$this->dwFactor = $bs->popUint32_t(); // �����л����ֹ���������ӡ��и���ҵ��������м�����ֵıش��������۵���Ʒ�۸����͵Ķ����µ���,��λ�� ����Ϊuint32_t
			$this->dwAddScoreNum = $bs->popUint32_t(); // �����л����Ŵ�����������ҵ��������ֵı��봫�ͣ���ERP����Ʒ�� ����Ϊuint32_t
			$this->dwAddCashNum = $bs->popUint32_t(); // �����л������ֽ��������ҵ�������˻����ı��봫�ͣ��綩������ ����Ϊuint32_t
			$this->dwIsMulty = $bs->popUint32_t(); // �����л��Ƿ�ʹ�÷��ű��� ����Ϊuint32_t
			$this->dwIsExtra = $bs->popUint32_t(); // �����л��Ƿ���⽱�� ����Ϊuint32_t
			$this->strRemarks = $bs->popString(); // �����л����ű�ע,ҵ����д����д����Ӧ���׶��������ֶ� ����Ϊstd::string
			$this->strDealId = $bs->popString(); // �����л�������:�����ۼ�������ȡ��������ԭ�򲹳������ѱ��ۼ��Ļ���ʱ,�����Ӧ�Ŀۼ��Ķ�����,�������� ����Ϊstd::string
			$this->dwLimitclass = $bs->popUint32_t(); // �����л�������Ŀ����Ҫ��д,�������� ����Ϊuint32_t
			$this->strProductId = $bs->popString(); // �����л�������Ʒ��:��Ʒ����ʱ���� ����Ϊstd::string
			$this->dwExt_1 = $bs->popUint32_t(); // �����л���������1 ����Ϊuint32_t
			$this->dwExt_2 = $bs->popUint32_t(); // �����л���������2 ����Ϊuint32_t
			$this->strExt_3 = $bs->popString(); // �����л���������3 ����Ϊstd::string
			$this->strExt_4 = $bs->popString(); // �����л���������4 ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cUid_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRuleId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cVipLevel_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cFactor_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cAddScoreNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cAddCashNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIsMulty_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIsExtra_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRemarks_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cLimitclass_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cProductId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExt_1_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExt_2_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExt_3_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExt_4_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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