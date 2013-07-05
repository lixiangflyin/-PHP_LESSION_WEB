<?php

//source idl: com.b2b2c.icsonboss.ao.idl.UpdateStockPriceWithAuthReq.java

if (!class_exists('BossStockPricePo')) {
class BossStockPricePo
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
		 * skuid ����
		 *
		 * �汾 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * �ֿ�id Ŀǰ��Ӧ�߼���Id ��Ѹ��վid��Ҫת�����߼���id
		 *
		 * �汾 >= 0
		 */
		var $dwStoreHouseId; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cStoreHouseId_u; //uint8_t

		/**
		 * ���۸񣬵�λ�� ��Ӧ��Ѹ�� �Ƕ�� 
		 *
		 * �汾 >= 0
		 */
		var $dwStockPrice; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cStockPrice_u; //uint8_t

		/**
		 * ���ɱ��۸񣬵�λ��
		 *
		 * �汾 >= 0
		 */
		var $dwStockCostPrice; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cStockCostPrice_u; //uint8_t

		/**
		 * ҵ��ɱ�����λ��
		 *
		 * �汾 >= 0
		 */
		var $dwStockBusinessCost; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cStockBusinessCost_u; //uint8_t

		/**
		 * ���ü۸�ʱ stockhash���� �㷨�ο� GetStockHash��������(������״̬��0 ��������) b2b2c/comm/b2b2c_define.h 
		 *
		 * �汾 >= 0
		 */
		var $strStockHash; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cStockHash_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->dwStoreHouseId = 0; // uint32_t
			 $this->cStoreHouseId_u = 0; // uint8_t
			 $this->dwStockPrice = 0; // uint32_t
			 $this->cStockPrice_u = 0; // uint8_t
			 $this->dwStockCostPrice = 0; // uint32_t
			 $this->cStockCostPrice_u = 0; // uint8_t
			 $this->dwStockBusinessCost = 0; // uint32_t
			 $this->cStockBusinessCost_u = 0; // uint8_t
			 $this->strStockHash = ""; // std::string
			 $this->cStockHash_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // ���л� �汾��    ����Ϊuint32_t
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwSkuId); // ���л�skuid ���� ����Ϊuint64_t
			$bs->pushUint8_t($this->cSkuId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwStoreHouseId); // ���л��ֿ�id Ŀǰ��Ӧ�߼���Id ��Ѹ��վid��Ҫת�����߼���id ����Ϊuint32_t
			$bs->pushUint8_t($this->cStoreHouseId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwStockPrice); // ���л����۸񣬵�λ�� ��Ӧ��Ѹ�� �Ƕ��  ����Ϊuint32_t
			$bs->pushUint8_t($this->cStockPrice_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwStockCostPrice); // ���л����ɱ��۸񣬵�λ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cStockCostPrice_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwStockBusinessCost); // ���л�ҵ��ɱ�����λ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cStockBusinessCost_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strStockHash); // ���л����ü۸�ʱ stockhash���� �㷨�ο� GetStockHash��������(������״̬��0 ��������) b2b2c/comm/b2b2c_define.h  ����Ϊstd::string
			$bs->pushUint8_t($this->cStockHash_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // �����л� �汾��    ����Ϊuint32_t
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // �����л�skuid ���� ����Ϊuint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwStoreHouseId = $bs->popUint32_t(); // �����л��ֿ�id Ŀǰ��Ӧ�߼���Id ��Ѹ��վid��Ҫת�����߼���id ����Ϊuint32_t
			$this->cStoreHouseId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwStockPrice = $bs->popUint32_t(); // �����л����۸񣬵�λ�� ��Ӧ��Ѹ�� �Ƕ��  ����Ϊuint32_t
			$this->cStockPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwStockCostPrice = $bs->popUint32_t(); // �����л����ɱ��۸񣬵�λ�� ����Ϊuint32_t
			$this->cStockCostPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwStockBusinessCost = $bs->popUint32_t(); // �����л�ҵ��ɱ�����λ�� ����Ϊuint32_t
			$this->cStockBusinessCost_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strStockHash = $bs->popString(); // �����л����ü۸�ʱ stockhash���� �㷨�ο� GetStockHash��������(������״̬��0 ��������) b2b2c/comm/b2b2c_define.h  ����Ϊstd::string
			$this->cStockHash_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.b2b2c.icsonboss.ao.idl.GetAllMultPriceSourceInfoResp.java

if (!class_exists('BossMultPriceSourcePo')) {
class BossMultPriceSourcePo
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
		 * ��Դid
		 *
		 * �汾 >= 0
		 */
		var $ddwPriceSourceId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceSourceId_u; //uint8_t

		/**
		 * ��Դ����
		 *
		 * �汾 >= 0
		 */
		var $strPriceSourceName; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPriceSourceName_u; //uint8_t

		/**
		 * ��Դ����
		 *
		 * �汾 >= 0
		 */
		var $strPriceSourceDesc; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPriceSourceDesc_u; //uint8_t

		/**
		 * ��Դ״̬
		 *
		 * �汾 >= 0
		 */
		var $wPriceSourceState; //uint16_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceSourceState_u; //uint8_t

		/**
		 * ��Դ��Կ
		 *
		 * �汾 >= 0
		 */
		var $strPriceSourceSecretKey; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPriceSourceSecretKey_u; //uint8_t

		/**
		 * ��Դ������id
		 *
		 * �汾 >= 0
		 */
		var $strPriceSourceCreaterId; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPriceSourceCreaterId_u; //uint8_t

		/**
		 * ��Դ����޸���
		 *
		 * �汾 >= 0
		 */
		var $strPriceSourceLastModifiyer; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPriceSourceLastModifiyer_u; //uint8_t

		/**
		 * ��Դ���ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwPriceSourceAddTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceSourceAddTime_u; //uint8_t

		/**
		 * ��Դ������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwPriceSourceLastUpdateTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceSourceLastUpdateTime_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->ddwPriceSourceId = 0; // uint64_t
			 $this->cPriceSourceId_u = 0; // uint8_t
			 $this->strPriceSourceName = ""; // std::string
			 $this->cPriceSourceName_u = 0; // uint8_t
			 $this->strPriceSourceDesc = ""; // std::string
			 $this->cPriceSourceDesc_u = 0; // uint8_t
			 $this->wPriceSourceState = 0; // uint16_t
			 $this->cPriceSourceState_u = 0; // uint8_t
			 $this->strPriceSourceSecretKey = ""; // std::string
			 $this->cPriceSourceSecretKey_u = 0; // uint8_t
			 $this->strPriceSourceCreaterId = ""; // std::string
			 $this->cPriceSourceCreaterId_u = 0; // uint8_t
			 $this->strPriceSourceLastModifiyer = ""; // std::string
			 $this->cPriceSourceLastModifiyer_u = 0; // uint8_t
			 $this->dwPriceSourceAddTime = 0; // uint32_t
			 $this->cPriceSourceAddTime_u = 0; // uint8_t
			 $this->dwPriceSourceLastUpdateTime = 0; // uint32_t
			 $this->cPriceSourceLastUpdateTime_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // ���л� �汾��    ����Ϊuint32_t
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwPriceSourceId); // ���л���Դid ����Ϊuint64_t
			$bs->pushUint8_t($this->cPriceSourceId_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceSourceName); // ���л���Դ���� ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceSourceName_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceSourceDesc); // ���л���Դ���� ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceSourceDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint16_t($this->wPriceSourceState); // ���л���Դ״̬ ����Ϊuint16_t
			$bs->pushUint8_t($this->cPriceSourceState_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceSourceSecretKey); // ���л���Դ��Կ ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceSourceSecretKey_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceSourceCreaterId); // ���л���Դ������id ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceSourceCreaterId_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceSourceLastModifiyer); // ���л���Դ����޸��� ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceSourceLastModifiyer_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceSourceAddTime); // ���л���Դ���ʱ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceSourceAddTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceSourceLastUpdateTime); // ���л���Դ������ʱ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceSourceLastUpdateTime_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // �����л� �汾��    ����Ϊuint32_t
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwPriceSourceId = $bs->popUint64_t(); // �����л���Դid ����Ϊuint64_t
			$this->cPriceSourceId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceSourceName = $bs->popString(); // �����л���Դ���� ����Ϊstd::string
			$this->cPriceSourceName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceSourceDesc = $bs->popString(); // �����л���Դ���� ����Ϊstd::string
			$this->cPriceSourceDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->wPriceSourceState = $bs->popUint16_t(); // �����л���Դ״̬ ����Ϊuint16_t
			$this->cPriceSourceState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceSourceSecretKey = $bs->popString(); // �����л���Դ��Կ ����Ϊstd::string
			$this->cPriceSourceSecretKey_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceSourceCreaterId = $bs->popString(); // �����л���Դ������id ����Ϊstd::string
			$this->cPriceSourceCreaterId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceSourceLastModifiyer = $bs->popString(); // �����л���Դ����޸��� ����Ϊstd::string
			$this->cPriceSourceLastModifiyer_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceSourceAddTime = $bs->popUint32_t(); // �����л���Դ���ʱ�� ����Ϊuint32_t
			$this->cPriceSourceAddTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceSourceLastUpdateTime = $bs->popUint32_t(); // �����л���Դ������ʱ�� ����Ϊuint32_t
			$this->cPriceSourceLastUpdateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.b2b2c.icsonboss.ao.idl.GetAllMultPriceSceneInfoResp.java

if (!class_exists('BossMultPriceScenePo')) {
class BossMultPriceScenePo
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
		 * ����id
		 *
		 * �汾 >= 0
		 */
		var $ddwPriceSceneId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceSceneId_u; //uint8_t

		/**
		 * ��������
		 *
		 * �汾 >= 0
		 */
		var $strPriceSceneName; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPriceSceneName_u; //uint8_t

		/**
		 * ��������
		 *
		 * �汾 >= 0
		 */
		var $strPriceSceneDesc; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPriceSceneDesc_u; //uint8_t

		/**
		 * ����״̬
		 *
		 * �汾 >= 0
		 */
		var $wPriceSceneState; //uint16_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceSceneState_u; //uint8_t

		/**
		 * ����������id
		 *
		 * �汾 >= 0
		 */
		var $strPriceSceneCreaterId; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPriceSceneCreaterId_u; //uint8_t

		/**
		 * ��������޸���
		 *
		 * �汾 >= 0
		 */
		var $strPriceSceneLastModifiyer; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPriceSceneLastModifiyer_u; //uint8_t

		/**
		 * �������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwPriceSceneAddTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceSceneAddTime_u; //uint8_t

		/**
		 * ����������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwPriceSceneLastUpdateTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceSceneLastUpdateTime_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->ddwPriceSceneId = 0; // uint64_t
			 $this->cPriceSceneId_u = 0; // uint8_t
			 $this->strPriceSceneName = ""; // std::string
			 $this->cPriceSceneName_u = 0; // uint8_t
			 $this->strPriceSceneDesc = ""; // std::string
			 $this->cPriceSceneDesc_u = 0; // uint8_t
			 $this->wPriceSceneState = 0; // uint16_t
			 $this->cPriceSceneState_u = 0; // uint8_t
			 $this->strPriceSceneCreaterId = ""; // std::string
			 $this->cPriceSceneCreaterId_u = 0; // uint8_t
			 $this->strPriceSceneLastModifiyer = ""; // std::string
			 $this->cPriceSceneLastModifiyer_u = 0; // uint8_t
			 $this->dwPriceSceneAddTime = 0; // uint32_t
			 $this->cPriceSceneAddTime_u = 0; // uint8_t
			 $this->dwPriceSceneLastUpdateTime = 0; // uint32_t
			 $this->cPriceSceneLastUpdateTime_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // ���л� �汾��    ����Ϊuint32_t
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwPriceSceneId); // ���л�����id ����Ϊuint64_t
			$bs->pushUint8_t($this->cPriceSceneId_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceSceneName); // ���л��������� ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceSceneName_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceSceneDesc); // ���л��������� ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceSceneDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint16_t($this->wPriceSceneState); // ���л�����״̬ ����Ϊuint16_t
			$bs->pushUint8_t($this->cPriceSceneState_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceSceneCreaterId); // ���л�����������id ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceSceneCreaterId_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceSceneLastModifiyer); // ���л���������޸��� ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceSceneLastModifiyer_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceSceneAddTime); // ���л��������ʱ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceSceneAddTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceSceneLastUpdateTime); // ���л�����������ʱ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceSceneLastUpdateTime_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // �����л� �汾��    ����Ϊuint32_t
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwPriceSceneId = $bs->popUint64_t(); // �����л�����id ����Ϊuint64_t
			$this->cPriceSceneId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceSceneName = $bs->popString(); // �����л��������� ����Ϊstd::string
			$this->cPriceSceneName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceSceneDesc = $bs->popString(); // �����л��������� ����Ϊstd::string
			$this->cPriceSceneDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->wPriceSceneState = $bs->popUint16_t(); // �����л�����״̬ ����Ϊuint16_t
			$this->cPriceSceneState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceSceneCreaterId = $bs->popString(); // �����л�����������id ����Ϊstd::string
			$this->cPriceSceneCreaterId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceSceneLastModifiyer = $bs->popString(); // �����л���������޸��� ����Ϊstd::string
			$this->cPriceSceneLastModifiyer_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceSceneAddTime = $bs->popUint32_t(); // �����л��������ʱ�� ����Ϊuint32_t
			$this->cPriceSceneAddTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceSceneLastUpdateTime = $bs->popUint32_t(); // �����л�����������ʱ�� ����Ϊuint32_t
			$this->cPriceSceneLastUpdateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.b2b2c.icsonboss.ao.idl.DelMultPriceRuleByQueryWithAuthResp.java

if (!class_exists('BossMultPriceRulesForSkuPo')) {
class BossMultPriceRulesForSkuPo
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
		 * sku id  д�ӿڱ���
		 *
		 * �汾 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * ����������ʺţ��ɲ��� 
		 *
		 * �汾 >= 0
		 */
		var $ddwCooperatorSubAccountId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cCooperatorSubAccountId_u; //uint8_t

		/**
		 * ��۹���Po
		 *
		 * �汾 >= 0
		 */
		var $vecBossMultPriceRulePo; //std::vector<b2b2c::icsonboss::po::CBossMultPriceRulePo> 

		/**
		 * �汾 >= 0
		 */
		var $cBossMultPriceRulePo_u; //uint8_t

		/**
		 * sku������Ϣ �������ӿ�ʹ�ã�д�ӿں���
		 *
		 * �汾 >= 0
		 */
		var $oBossSkuBaiscPo; //b2b2c::icsonboss::po::CBossSkuBasicPo

		/**
		 * �汾 >= 0
		 */
		var $cBossSkuBaiscPo_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->ddwCooperatorSubAccountId = 0; // uint64_t
			 $this->cCooperatorSubAccountId_u = 0; // uint8_t
			 $this->vecBossMultPriceRulePo = new stl_vector('BossMultPriceRulePo'); // std::vector<b2b2c::icsonboss::po::CBossMultPriceRulePo> 
			 $this->cBossMultPriceRulePo_u = 0; // uint8_t
			 $this->oBossSkuBaiscPo = new BossSkuBasicPo(); // b2b2c::icsonboss::po::CBossSkuBasicPo
			 $this->cBossSkuBaiscPo_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // ���л� �汾��    ����Ϊuint32_t
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwSkuId); // ���л�sku id  д�ӿڱ��� ����Ϊuint64_t
			$bs->pushUint8_t($this->cSkuId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwCooperatorSubAccountId); // ���л�����������ʺţ��ɲ���  ����Ϊuint64_t
			$bs->pushUint8_t($this->cCooperatorSubAccountId_u); // ���л� ����Ϊuint8_t
			$bs->pushObject($this->vecBossMultPriceRulePo,'stl_vector'); // ���л���۹���Po ����Ϊstd::vector<b2b2c::icsonboss::po::CBossMultPriceRulePo> 
			$bs->pushUint8_t($this->cBossMultPriceRulePo_u); // ���л� ����Ϊuint8_t
			$bs->pushObject($this->oBossSkuBaiscPo,'BossSkuBasicPo'); // ���л�sku������Ϣ �������ӿ�ʹ�ã�д�ӿں��� ����Ϊb2b2c::icsonboss::po::CBossSkuBasicPo
			$bs->pushUint8_t($this->cBossSkuBaiscPo_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // �����л� �汾��    ����Ϊuint32_t
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // �����л�sku id  д�ӿڱ��� ����Ϊuint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwCooperatorSubAccountId = $bs->popUint64_t(); // �����л�����������ʺţ��ɲ���  ����Ϊuint64_t
			$this->cCooperatorSubAccountId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->vecBossMultPriceRulePo = $bs->popObject('stl_vector<BossMultPriceRulePo>'); // �����л���۹���Po ����Ϊstd::vector<b2b2c::icsonboss::po::CBossMultPriceRulePo> 
			$this->cBossMultPriceRulePo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->oBossSkuBaiscPo = $bs->popObject('BossSkuBasicPo'); // �����л�sku������Ϣ �������ӿ�ʹ�ã�д�ӿں��� ����Ϊb2b2c::icsonboss::po::CBossSkuBasicPo
			$this->cBossSkuBaiscPo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.b2b2c.icsonboss.ao.idl.BossMultPriceRulesForSkuPo.java

if (!class_exists('BossMultPriceRulePo')) {
class BossMultPriceRulePo
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
		 * ���� id��д��ʱ��������ĵ���Ŀ�����100000����ʾȫ��
		 *
		 * �汾 >= 0
		 */
		var $dwRegionId; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cRegionId_u; //uint8_t

		/**
		 * ���� id ����
		 *
		 * �汾 >= 0
		 */
		var $ddwPriceSceneId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceSceneId_u; //uint8_t

		/**
		 * ��Դ id ����
		 *
		 * �汾 >= 0
		 */
		var $ddwPriceSourceId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceSourceId_u; //uint8_t

		/**
		 * ��������
		 *
		 * �汾 >= 0
		 */
		var $strPriceName; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPriceName_u; //uint8_t

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
		 * �����ӿ�,�ö������
		 *
		 * �汾 >= 0
		 */
		var $bitsetPriceBitProperty; //std::bitset<32> 

		/**
		 * �汾 >= 0
		 */
		var $cPriceBitProperty_u; //uint8_t

		/**
		 * ��д�ӿ���,price ���� include bitλ,��������
		 *
		 * �汾 >= 0
		 */
		var $bitsetPriceBitInclude; //std::bitset<32> 

		/**
		 * �汾 >= 0
		 */
		var $cPriceBitInclude_u; //uint8_t

		/**
		 * ��д�ӿ���,price ���� include bitλ,����ȡ��
		 *
		 * �汾 >= 0
		 */
		var $bitsetPriceBitExclude; //std::bitset<32> 

		/**
		 * �汾 >= 0
		 */
		var $cPriceBitExclude_u; //uint8_t

		/**
		 * ���״̬ 0-����� 1-����� 2-��ֹ 3-ɾ��
		 *
		 * �汾 >= 0
		 */
		var $wPriceState; //uint16_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceState_u; //uint8_t

		/**
		 * ���չʾ������Ϊ���� 0-ԭ�۲��� 1-���� 2-�ۼ� 3-����(һ�ڼ�)
		 *
		 * �汾 >= 0
		 */
		var $wPriceShowOperationType; //uint16_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceShowOperationType_u; //uint8_t

		/**
		 * ���չʾ������
		 *
		 * �汾 >= 0
		 */
		var $dwPriceShowOperationNum; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceShowOperationNum_u; //uint8_t

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
		 * �ɱ���̯�� ������
		 *
		 * �汾 >= 0
		 */
		var $dwPriceCostResponse; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceCostResponse_u; //uint8_t

		/**
		 * timefield���� ���û��������������bosstimedfieldPo ���Զ�����Ϊ1
		 *
		 * �汾 >= 0
		 */
		var $wPriceTimeFieldFlag; //uint16_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceTimeFieldFlag_u; //uint8_t

		/**
		 * ���ʱ��ά�� 
		 *
		 * �汾 >= 0
		 */
		var $vecBossTimePricePo; //std::vector<b2b2c::icsonboss::po::CBossTimedPricePo> 

		/**
		 * �汾 >= 0
		 */
		var $cBossTimePricePo_u; //uint8_t

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
		 * �û���ݹ���ѡ��
		 *
		 * �汾 >= 0
		 */
		var $strPriceUserIdentityRule; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPriceUserIdentityRule_u; //uint8_t

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
		 * ����µ�������Ϊ���ͣ����� ����ͬpriceShowOperationType
		 *
		 * �汾 >= 0
		 */
		var $wPriceDealOperationType; //uint16_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceDealOperationType_u; //uint8_t

		/**
		 * ����µ�������������
		 *
		 * �汾 >= 0
		 */
		var $dwPriceDealOperationNum; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceDealOperationNum_u; //uint8_t

		/**
		 * չʾ�����µ��۲�ͬԭ��ѡ��
		 *
		 * �汾 >= 0
		 */
		var $strPriceDiffReason; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPriceDiffReason_u; //uint8_t

		/**
		 * �µ���������ѡ��
		 *
		 * �汾 >= 0
		 */
		var $strPriceDealDesc; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPriceDealDesc_u; //uint8_t

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
		 * ��׼�ۣ����� 0-���ۼ��ּ� ����������
		 *
		 * �汾 >= 0
		 */
		var $dwPriceBase; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceBase_u; //uint8_t

		/**
		 * �Ƿ��޹�������
		 *
		 * �汾 >= 0
		 */
		var $wPriceBuyLimitFlag; //uint16_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceBuyLimitFlag_u; //uint8_t

		/**
		 * �޹�����ѡ�� ������
		 *
		 * �汾 >= 0
		 */
		var $strPriceBuyLimitRule; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPriceBuyLimitRule_u; //uint8_t

		/**
		 * ��֤���ͣ�ѡ�default 0
		 *
		 * �汾 >= 0
		 */
		var $wPriceVerifyType; //uint16_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceVerifyType_u; //uint8_t

		/**
		 * ������Ч����
		 *
		 * �汾 >= 0
		 */
		var $dwPriceMaxUseNum; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceMaxUseNum_u; //uint8_t

		/**
		 * ���ܲ����� defaultΪ0
		 *
		 * �汾 >= 0
		 */
		var $dwPriceEnergySaving; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceEnergySaving_u; //uint8_t

		/**
		 * Ԥ��ʱ��ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwPriceForeCastTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceForeCastTime_u; //uint8_t

		/**
		 * ���òֿ⣬��ʽ������
		 *
		 * �汾 >= 0
		 */
		var $strPriceStoreHouse; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPriceStoreHouse_u; //uint8_t

		/**
		 * �����id����ʽ������
		 *
		 * �汾 >= 0
		 */
		var $strPriceActiveId; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPriceActiveId_u; //uint8_t

		/**
		 * ������id������
		 *
		 * �汾 >= 0
		 */
		var $strPriceCreaterId; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPriceCreaterId_u; //uint8_t

		/**
		 * ����޸��ˣ�����
		 *
		 * �汾 >= 0
		 */
		var $strPriceLastModifiyer; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPriceLastModifiyer_u; //uint8_t

		/**
		 * ���ʱ�䣬����
		 *
		 * �汾 >= 0
		 */
		var $dwPriceAddTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceAddTime_u; //uint8_t

		/**
		 * ������ʱ�䣬����
		 *
		 * �汾 >= 0
		 */
		var $dwPriceLastUpdateTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceLastUpdateTime_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwRegionId = 0; // uint32_t
			 $this->cRegionId_u = 0; // uint8_t
			 $this->ddwPriceSceneId = 0; // uint64_t
			 $this->cPriceSceneId_u = 0; // uint8_t
			 $this->ddwPriceSourceId = 0; // uint64_t
			 $this->cPriceSourceId_u = 0; // uint8_t
			 $this->strPriceName = ""; // std::string
			 $this->cPriceName_u = 0; // uint8_t
			 $this->strPriceNumber = ""; // std::string
			 $this->cPriceNumber_u = 0; // uint8_t
			 $this->bitsetPriceBitProperty = new stl_bitset('32'); // std::bitset<32> 
			 $this->cPriceBitProperty_u = 0; // uint8_t
			 $this->bitsetPriceBitInclude = new stl_bitset('32'); // std::bitset<32> 
			 $this->cPriceBitInclude_u = 0; // uint8_t
			 $this->bitsetPriceBitExclude = new stl_bitset('32'); // std::bitset<32> 
			 $this->cPriceBitExclude_u = 0; // uint8_t
			 $this->wPriceState = 0; // uint16_t
			 $this->cPriceState_u = 0; // uint8_t
			 $this->wPriceShowOperationType = 0; // uint16_t
			 $this->cPriceShowOperationType_u = 0; // uint8_t
			 $this->dwPriceShowOperationNum = 0; // uint32_t
			 $this->cPriceShowOperationNum_u = 0; // uint8_t
			 $this->strPriceCostRatio = ""; // std::string
			 $this->cPriceCostRatio_u = 0; // uint8_t
			 $this->dwPriceCostResponse = 0; // uint32_t
			 $this->cPriceCostResponse_u = 0; // uint8_t
			 $this->wPriceTimeFieldFlag = 0; // uint16_t
			 $this->cPriceTimeFieldFlag_u = 0; // uint8_t
			 $this->vecBossTimePricePo = new stl_vector('BossTimedPricePo'); // std::vector<b2b2c::icsonboss::po::CBossTimedPricePo> 
			 $this->cBossTimePricePo_u = 0; // uint8_t
			 $this->strPriceDesc = ""; // std::string
			 $this->cPriceDesc_u = 0; // uint8_t
			 $this->strPriceUserIdentityRule = ""; // std::string
			 $this->cPriceUserIdentityRule_u = 0; // uint8_t
			 $this->dwPriceStartTime = 0; // uint32_t
			 $this->cPriceStartTime_u = 0; // uint8_t
			 $this->dwPriceEndTime = 0; // uint32_t
			 $this->cPriceEndTime_u = 0; // uint8_t
			 $this->wPriceDealOperationType = 0; // uint16_t
			 $this->cPriceDealOperationType_u = 0; // uint8_t
			 $this->dwPriceDealOperationNum = 0; // uint32_t
			 $this->cPriceDealOperationNum_u = 0; // uint8_t
			 $this->strPriceDiffReason = ""; // std::string
			 $this->cPriceDiffReason_u = 0; // uint8_t
			 $this->strPriceDealDesc = ""; // std::string
			 $this->cPriceDealDesc_u = 0; // uint8_t
			 $this->strPricePromotionDesc = ""; // std::string
			 $this->cPricePromotionDesc_u = 0; // uint8_t
			 $this->dwPriceBase = 0; // uint32_t
			 $this->cPriceBase_u = 0; // uint8_t
			 $this->wPriceBuyLimitFlag = 0; // uint16_t
			 $this->cPriceBuyLimitFlag_u = 0; // uint8_t
			 $this->strPriceBuyLimitRule = ""; // std::string
			 $this->cPriceBuyLimitRule_u = 0; // uint8_t
			 $this->wPriceVerifyType = 0; // uint16_t
			 $this->cPriceVerifyType_u = 0; // uint8_t
			 $this->dwPriceMaxUseNum = 0; // uint32_t
			 $this->cPriceMaxUseNum_u = 0; // uint8_t
			 $this->dwPriceEnergySaving = 0; // uint32_t
			 $this->cPriceEnergySaving_u = 0; // uint8_t
			 $this->dwPriceForeCastTime = 0; // uint32_t
			 $this->cPriceForeCastTime_u = 0; // uint8_t
			 $this->strPriceStoreHouse = ""; // std::string
			 $this->cPriceStoreHouse_u = 0; // uint8_t
			 $this->strPriceActiveId = ""; // std::string
			 $this->cPriceActiveId_u = 0; // uint8_t
			 $this->strPriceCreaterId = ""; // std::string
			 $this->cPriceCreaterId_u = 0; // uint8_t
			 $this->strPriceLastModifiyer = ""; // std::string
			 $this->cPriceLastModifiyer_u = 0; // uint8_t
			 $this->dwPriceAddTime = 0; // uint32_t
			 $this->cPriceAddTime_u = 0; // uint8_t
			 $this->dwPriceLastUpdateTime = 0; // uint32_t
			 $this->cPriceLastUpdateTime_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // ���л� �汾��    ����Ϊuint32_t
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwRegionId); // ���л����� id��д��ʱ��������ĵ���Ŀ�����100000����ʾȫ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cRegionId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwPriceSceneId); // ���л����� id ���� ����Ϊuint64_t
			$bs->pushUint8_t($this->cPriceSceneId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwPriceSourceId); // ���л���Դ id ���� ����Ϊuint64_t
			$bs->pushUint8_t($this->cPriceSourceId_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceName); // ���л��������� ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceName_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceNumber); // ���л�����ά��,��ʵ�ּ۸���� ��ʽ���� ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceNumber_u); // ���л� ����Ϊuint8_t
			$bs->pushObject($this->bitsetPriceBitProperty,'stl_bitset'); // ���л������ӿ�,�ö������ ����Ϊstd::bitset<32> 
			$bs->pushUint8_t($this->cPriceBitProperty_u); // ���л� ����Ϊuint8_t
			$bs->pushObject($this->bitsetPriceBitInclude,'stl_bitset'); // ���л���д�ӿ���,price ���� include bitλ,�������� ����Ϊstd::bitset<32> 
			$bs->pushUint8_t($this->cPriceBitInclude_u); // ���л� ����Ϊuint8_t
			$bs->pushObject($this->bitsetPriceBitExclude,'stl_bitset'); // ���л���д�ӿ���,price ���� include bitλ,����ȡ�� ����Ϊstd::bitset<32> 
			$bs->pushUint8_t($this->cPriceBitExclude_u); // ���л� ����Ϊuint8_t
			$bs->pushUint16_t($this->wPriceState); // ���л����״̬ 0-����� 1-����� 2-��ֹ 3-ɾ�� ����Ϊuint16_t
			$bs->pushUint8_t($this->cPriceState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint16_t($this->wPriceShowOperationType); // ���л����չʾ������Ϊ���� 0-ԭ�۲��� 1-���� 2-�ۼ� 3-����(һ�ڼ�) ����Ϊuint16_t
			$bs->pushUint8_t($this->cPriceShowOperationType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceShowOperationNum); // ���л����չʾ������ ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceShowOperationNum_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceCostRatio); // ���л���۳ɱ���̯���� ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceCostRatio_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceCostResponse); // ���л��ɱ���̯�� ������ ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceCostResponse_u); // ���л� ����Ϊuint8_t
			$bs->pushUint16_t($this->wPriceTimeFieldFlag); // ���л�timefield���� ���û��������������bosstimedfieldPo ���Զ�����Ϊ1 ����Ϊuint16_t
			$bs->pushUint8_t($this->cPriceTimeFieldFlag_u); // ���л� ����Ϊuint8_t
			$bs->pushObject($this->vecBossTimePricePo,'stl_vector'); // ���л����ʱ��ά��  ����Ϊstd::vector<b2b2c::icsonboss::po::CBossTimedPricePo> 
			$bs->pushUint8_t($this->cBossTimePricePo_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceDesc); // ���л���۹���������ѡ�� ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceUserIdentityRule); // ���л��û���ݹ���ѡ�� ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceUserIdentityRule_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceStartTime); // ���л�����ʼʱ�䣬���� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceStartTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceEndTime); // ���л��������ʱ�䣬���� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceEndTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint16_t($this->wPriceDealOperationType); // ���л�����µ�������Ϊ���ͣ����� ����ͬpriceShowOperationType ����Ϊuint16_t
			$bs->pushUint8_t($this->cPriceDealOperationType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceDealOperationNum); // ���л�����µ������������� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceDealOperationNum_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceDiffReason); // ���л�չʾ�����µ��۲�ͬԭ��ѡ�� ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceDiffReason_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceDealDesc); // ���л��µ���������ѡ�� ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceDealDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPricePromotionDesc); // ���л���������� ����Ϊstd::string
			$bs->pushUint8_t($this->cPricePromotionDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceBase); // ���л���׼�ۣ����� 0-���ۼ��ּ� ���������� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceBase_u); // ���л� ����Ϊuint8_t
			$bs->pushUint16_t($this->wPriceBuyLimitFlag); // ���л��Ƿ��޹������� ����Ϊuint16_t
			$bs->pushUint8_t($this->cPriceBuyLimitFlag_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceBuyLimitRule); // ���л��޹�����ѡ�� ������ ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceBuyLimitRule_u); // ���л� ����Ϊuint8_t
			$bs->pushUint16_t($this->wPriceVerifyType); // ���л���֤���ͣ�ѡ�default 0 ����Ϊuint16_t
			$bs->pushUint8_t($this->cPriceVerifyType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceMaxUseNum); // ���л�������Ч���� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceMaxUseNum_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceEnergySaving); // ���л����ܲ����� defaultΪ0 ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceEnergySaving_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceForeCastTime); // ���л�Ԥ��ʱ��ʱ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceForeCastTime_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceStoreHouse); // ���л����òֿ⣬��ʽ������ ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceStoreHouse_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceActiveId); // ���л������id����ʽ������ ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceActiveId_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceCreaterId); // ���л�������id������ ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceCreaterId_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceLastModifiyer); // ���л�����޸��ˣ����� ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceLastModifiyer_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceAddTime); // ���л����ʱ�䣬���� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceAddTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPriceLastUpdateTime); // ���л�������ʱ�䣬���� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPriceLastUpdateTime_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // �����л� �汾��    ����Ϊuint32_t
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwRegionId = $bs->popUint32_t(); // �����л����� id��д��ʱ��������ĵ���Ŀ�����100000����ʾȫ�� ����Ϊuint32_t
			$this->cRegionId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwPriceSceneId = $bs->popUint64_t(); // �����л����� id ���� ����Ϊuint64_t
			$this->cPriceSceneId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwPriceSourceId = $bs->popUint64_t(); // �����л���Դ id ���� ����Ϊuint64_t
			$this->cPriceSourceId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceName = $bs->popString(); // �����л��������� ����Ϊstd::string
			$this->cPriceName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceNumber = $bs->popString(); // �����л�����ά��,��ʵ�ּ۸���� ��ʽ���� ����Ϊstd::string
			$this->cPriceNumber_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->bitsetPriceBitProperty = $bs->popObject('stl_bitset<32>'); // �����л������ӿ�,�ö������ ����Ϊstd::bitset<32> 
			$this->cPriceBitProperty_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->bitsetPriceBitInclude = $bs->popObject('stl_bitset<32>'); // �����л���д�ӿ���,price ���� include bitλ,�������� ����Ϊstd::bitset<32> 
			$this->cPriceBitInclude_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->bitsetPriceBitExclude = $bs->popObject('stl_bitset<32>'); // �����л���д�ӿ���,price ���� include bitλ,����ȡ�� ����Ϊstd::bitset<32> 
			$this->cPriceBitExclude_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->wPriceState = $bs->popUint16_t(); // �����л����״̬ 0-����� 1-����� 2-��ֹ 3-ɾ�� ����Ϊuint16_t
			$this->cPriceState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->wPriceShowOperationType = $bs->popUint16_t(); // �����л����չʾ������Ϊ���� 0-ԭ�۲��� 1-���� 2-�ۼ� 3-����(һ�ڼ�) ����Ϊuint16_t
			$this->cPriceShowOperationType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceShowOperationNum = $bs->popUint32_t(); // �����л����չʾ������ ����Ϊuint32_t
			$this->cPriceShowOperationNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceCostRatio = $bs->popString(); // �����л���۳ɱ���̯���� ����Ϊstd::string
			$this->cPriceCostRatio_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceCostResponse = $bs->popUint32_t(); // �����л��ɱ���̯�� ������ ����Ϊuint32_t
			$this->cPriceCostResponse_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->wPriceTimeFieldFlag = $bs->popUint16_t(); // �����л�timefield���� ���û��������������bosstimedfieldPo ���Զ�����Ϊ1 ����Ϊuint16_t
			$this->cPriceTimeFieldFlag_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->vecBossTimePricePo = $bs->popObject('stl_vector<BossTimedPricePo>'); // �����л����ʱ��ά��  ����Ϊstd::vector<b2b2c::icsonboss::po::CBossTimedPricePo> 
			$this->cBossTimePricePo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceDesc = $bs->popString(); // �����л���۹���������ѡ�� ����Ϊstd::string
			$this->cPriceDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceUserIdentityRule = $bs->popString(); // �����л��û���ݹ���ѡ�� ����Ϊstd::string
			$this->cPriceUserIdentityRule_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceStartTime = $bs->popUint32_t(); // �����л�����ʼʱ�䣬���� ����Ϊuint32_t
			$this->cPriceStartTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceEndTime = $bs->popUint32_t(); // �����л��������ʱ�䣬���� ����Ϊuint32_t
			$this->cPriceEndTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->wPriceDealOperationType = $bs->popUint16_t(); // �����л�����µ�������Ϊ���ͣ����� ����ͬpriceShowOperationType ����Ϊuint16_t
			$this->cPriceDealOperationType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceDealOperationNum = $bs->popUint32_t(); // �����л�����µ������������� ����Ϊuint32_t
			$this->cPriceDealOperationNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceDiffReason = $bs->popString(); // �����л�չʾ�����µ��۲�ͬԭ��ѡ�� ����Ϊstd::string
			$this->cPriceDiffReason_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceDealDesc = $bs->popString(); // �����л��µ���������ѡ�� ����Ϊstd::string
			$this->cPriceDealDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPricePromotionDesc = $bs->popString(); // �����л���������� ����Ϊstd::string
			$this->cPricePromotionDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceBase = $bs->popUint32_t(); // �����л���׼�ۣ����� 0-���ۼ��ּ� ���������� ����Ϊuint32_t
			$this->cPriceBase_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->wPriceBuyLimitFlag = $bs->popUint16_t(); // �����л��Ƿ��޹������� ����Ϊuint16_t
			$this->cPriceBuyLimitFlag_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceBuyLimitRule = $bs->popString(); // �����л��޹�����ѡ�� ������ ����Ϊstd::string
			$this->cPriceBuyLimitRule_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->wPriceVerifyType = $bs->popUint16_t(); // �����л���֤���ͣ�ѡ�default 0 ����Ϊuint16_t
			$this->cPriceVerifyType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceMaxUseNum = $bs->popUint32_t(); // �����л�������Ч���� ����Ϊuint32_t
			$this->cPriceMaxUseNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceEnergySaving = $bs->popUint32_t(); // �����л����ܲ����� defaultΪ0 ����Ϊuint32_t
			$this->cPriceEnergySaving_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceForeCastTime = $bs->popUint32_t(); // �����л�Ԥ��ʱ��ʱ�� ����Ϊuint32_t
			$this->cPriceForeCastTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceStoreHouse = $bs->popString(); // �����л����òֿ⣬��ʽ������ ����Ϊstd::string
			$this->cPriceStoreHouse_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceActiveId = $bs->popString(); // �����л������id����ʽ������ ����Ϊstd::string
			$this->cPriceActiveId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceCreaterId = $bs->popString(); // �����л�������id������ ����Ϊstd::string
			$this->cPriceCreaterId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceLastModifiyer = $bs->popString(); // �����л�����޸��ˣ����� ����Ϊstd::string
			$this->cPriceLastModifiyer_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceAddTime = $bs->popUint32_t(); // �����л����ʱ�䣬���� ����Ϊuint32_t
			$this->cPriceAddTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPriceLastUpdateTime = $bs->popUint32_t(); // �����л�������ʱ�䣬���� ����Ϊuint32_t
			$this->cPriceLastUpdateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.b2b2c.icsonboss.ao.idl.BossMultPriceRulePo.java

if (!class_exists('BossTimedPricePo')) {
class BossTimedPricePo
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
		 * ���� include bitλ ������д�ӿ� ��������
		 *
		 * �汾 >= 0
		 */
		var $bitsetTimedPriceBitInclude; //std::bitset<32> 

		/**
		 * ���� include bitλ flag
		 *
		 * �汾 >= 0
		 */
		var $cTimedPriceBitInclude_u; //uint8_t

		/**
		 * ���� exclude bitλ ������д�ӿ� ȡ������
		 *
		 * �汾 >= 0
		 */
		var $bitsetTimePriceBitExclude; //std::bitset<32> 

		/**
		 * ���� exclude bitλ flag
		 *
		 * �汾 >= 0
		 */
		var $cTimePriceBitExclude_u; //uint8_t

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
		 * ������id������
		 *
		 * �汾 >= 0
		 */
		var $strTimedPriceCreaterId; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cTimedPriceCreaterId_u; //uint8_t

		/**
		 * stringΪskuid+regionid+timedPriceIndex+timedPriceStartTime+timedPriceLastLong+timedPriceOperationType+timedPriceOperationNum �ֶ�֮���޷ָ���
		 *
		 * �汾 >= 0
		 */
		var $strTimedPriceCheckHash; //std::string

		/**
		 *  flag
		 *
		 * �汾 >= 0
		 */
		var $cTimedPriceCheckHash_u; //uint8_t


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
			 $this->bitsetTimedPriceBitInclude = new stl_bitset('32'); // std::bitset<32> 
			 $this->cTimedPriceBitInclude_u = 0; // uint8_t
			 $this->bitsetTimePriceBitExclude = new stl_bitset('32'); // std::bitset<32> 
			 $this->cTimePriceBitExclude_u = 0; // uint8_t
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
			 $this->strTimedPriceCreaterId = ""; // std::string
			 $this->cTimedPriceCreaterId_u = 0; // uint8_t
			 $this->strTimedPriceCheckHash = ""; // std::string
			 $this->cTimedPriceCheckHash_u = 0; // uint8_t
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
			$bs->pushObject($this->bitsetTimedPriceBitInclude,'stl_bitset'); // ���л����� include bitλ ������д�ӿ� �������� ����Ϊstd::bitset<32> 
			$bs->pushUint8_t($this->cTimedPriceBitInclude_u); // ���л����� include bitλ flag ����Ϊuint8_t
			$bs->pushObject($this->bitsetTimePriceBitExclude,'stl_bitset'); // ���л����� exclude bitλ ������д�ӿ� ȡ������ ����Ϊstd::bitset<32> 
			$bs->pushUint8_t($this->cTimePriceBitExclude_u); // ���л����� exclude bitλ flag ����Ϊuint8_t
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
			$bs->pushString($this->strTimedPriceCreaterId); // ���л�������id������ ����Ϊstd::string
			$bs->pushUint8_t($this->cTimedPriceCreaterId_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strTimedPriceCheckHash); // ���л�stringΪskuid+regionid+timedPriceIndex+timedPriceStartTime+timedPriceLastLong+timedPriceOperationType+timedPriceOperationNum �ֶ�֮���޷ָ��� ����Ϊstd::string
			$bs->pushUint8_t($this->cTimedPriceCheckHash_u); // ���л� flag ����Ϊuint8_t
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
			$this->bitsetTimedPriceBitInclude = $bs->popObject('stl_bitset<32>'); // �����л����� include bitλ ������д�ӿ� �������� ����Ϊstd::bitset<32> 
			$this->cTimedPriceBitInclude_u = $bs->popUint8_t(); // �����л����� include bitλ flag ����Ϊuint8_t
			$this->bitsetTimePriceBitExclude = $bs->popObject('stl_bitset<32>'); // �����л����� exclude bitλ ������д�ӿ� ȡ������ ����Ϊstd::bitset<32> 
			$this->cTimePriceBitExclude_u = $bs->popUint8_t(); // �����л����� exclude bitλ flag ����Ϊuint8_t
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
			$this->strTimedPriceCreaterId = $bs->popString(); // �����л�������id������ ����Ϊstd::string
			$this->cTimedPriceCreaterId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strTimedPriceCheckHash = $bs->popString(); // �����л�stringΪskuid+regionid+timedPriceIndex+timedPriceStartTime+timedPriceLastLong+timedPriceOperationType+timedPriceOperationNum �ֶ�֮���޷ָ��� ����Ϊstd::string
			$this->cTimedPriceCheckHash_u = $bs->popUint8_t(); // �����л� flag ����Ϊuint8_t

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


//source idl: com.b2b2c.icsonboss.ao.idl.DelMultPriceRuleByQueryWithAuthReq.java

if (!class_exists('AuthorizationField4Web')) {
class AuthorizationField4Web
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
		 * ��������,��������ֵ 
		 *
		 * �汾 >= 0
		 */
		var $dwOperationType; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cOperationType_u; //uint8_t

		/**
		 * ���������� 
		 *
		 * �汾 >= 0
		 */
		var $dwOperatorType; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cOperatorType_u; //uint8_t

		/**
		 * ������Id 
		 *
		 * �汾 >= 0
		 */
		var $strOperatorId; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cOperatorId_u; //uint8_t

		/**
		 * ������Ȩ������ 
		 *
		 * �汾 >= 0
		 */
		var $dwOperatorAuthType; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cOperatorAuthType_u; //uint8_t

		/**
		 * ������Ȩ��Id 
		 *
		 * �汾 >= 0
		 */
		var $ddwOperatorAuthId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cOperatorAuthId_u; //uint8_t

		/**
		 * ����ԭ�� 
		 *
		 * �汾 >= 0
		 */
		var $strOperationReason; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cOperationReason_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwOperationType = 0; // uint32_t
			 $this->cOperationType_u = 0; // uint8_t
			 $this->dwOperatorType = 0; // uint32_t
			 $this->cOperatorType_u = 0; // uint8_t
			 $this->strOperatorId = ""; // std::string
			 $this->cOperatorId_u = 0; // uint8_t
			 $this->dwOperatorAuthType = 0; // uint32_t
			 $this->cOperatorAuthType_u = 0; // uint8_t
			 $this->ddwOperatorAuthId = 0; // uint64_t
			 $this->cOperatorAuthId_u = 0; // uint8_t
			 $this->strOperationReason = ""; // std::string
			 $this->cOperationReason_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // ���л� �汾��    ����Ϊuint32_t
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwOperationType); // ���л���������,��������ֵ  ����Ϊuint32_t
			$bs->pushUint8_t($this->cOperationType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwOperatorType); // ���л�����������  ����Ϊuint32_t
			$bs->pushUint8_t($this->cOperatorType_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strOperatorId); // ���л�������Id  ����Ϊstd::string
			$bs->pushUint8_t($this->cOperatorId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwOperatorAuthType); // ���л�������Ȩ������  ����Ϊuint32_t
			$bs->pushUint8_t($this->cOperatorAuthType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwOperatorAuthId); // ���л�������Ȩ��Id  ����Ϊuint64_t
			$bs->pushUint8_t($this->cOperatorAuthId_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strOperationReason); // ���л�����ԭ��  ����Ϊstd::string
			$bs->pushUint8_t($this->cOperationReason_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // �����л� �汾��    ����Ϊuint32_t
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwOperationType = $bs->popUint32_t(); // �����л���������,��������ֵ  ����Ϊuint32_t
			$this->cOperationType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwOperatorType = $bs->popUint32_t(); // �����л�����������  ����Ϊuint32_t
			$this->cOperatorType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strOperatorId = $bs->popString(); // �����л�������Id  ����Ϊstd::string
			$this->cOperatorId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwOperatorAuthType = $bs->popUint32_t(); // �����л�������Ȩ������  ����Ϊuint32_t
			$this->cOperatorAuthType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwOperatorAuthId = $bs->popUint64_t(); // �����л�������Ȩ��Id  ����Ϊuint64_t
			$this->cOperatorAuthId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strOperationReason = $bs->popString(); // �����л�����ԭ��  ����Ϊstd::string
			$this->cOperationReason_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.b2b2c.icsonboss.ao.idl.DelMultPriceRuleByQueryWithAuthReq.java

if (!class_exists('MultPriceQueryPo')) {
class MultPriceQueryPo
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
		 * sku id ����
		 *
		 * �汾 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * ���� id��ѡ��
		 *
		 * �汾 >= 0
		 */
		var $dwRegionId; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cRegionId_u; //uint8_t

		/**
		 * ���� id��ѡ��
		 *
		 * �汾 >= 0
		 */
		var $ddwPriceSceneId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceSceneId_u; //uint8_t

		/**
		 * ��Դ id��ѡ��
		 *
		 * �汾 >= 0
		 */
		var $ddwPriceSourceId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cPriceSourceId_u; //uint8_t

		/**
		 * ������id��ѡ��
		 *
		 * �汾 >= 0
		 */
		var $strPriceCreaterId; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPriceCreaterId_u; //uint8_t

		/**
		 * ��Ҫ���е�ɾ���������ֶ�(����ɾ��) ��bitset��ʾ ǰ����skuid/region/sourceid/sceneid������
		 *
		 * �汾 >= 0
		 */
		var $bitsetBitDelOperation; //std::bitset<32> 

		/**
		 * �汾 >= 0
		 */
		var $cBitDelOperation_u; //uint8_t

		/**
		 * ʱ��ά��index ��Ҫɾ��ʱ��ά��ʱ��Ч
		 *
		 * �汾 >= 0
		 */
		var $setTimedPriceIndex; //std::set<uint32_t> 

		/**
		 * �汾 >= 0
		 */
		var $cTimedPriceIndex_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->dwRegionId = 0; // uint32_t
			 $this->cRegionId_u = 0; // uint8_t
			 $this->ddwPriceSceneId = 0; // uint64_t
			 $this->cPriceSceneId_u = 0; // uint8_t
			 $this->ddwPriceSourceId = 0; // uint64_t
			 $this->cPriceSourceId_u = 0; // uint8_t
			 $this->strPriceCreaterId = ""; // std::string
			 $this->cPriceCreaterId_u = 0; // uint8_t
			 $this->bitsetBitDelOperation = new stl_bitset('32'); // std::bitset<32> 
			 $this->cBitDelOperation_u = 0; // uint8_t
			 $this->setTimedPriceIndex = new stl_set('uint32_t'); // std::set<uint32_t> 
			 $this->cTimedPriceIndex_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // ���л� �汾��    ����Ϊuint32_t
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwSkuId); // ���л�sku id ���� ����Ϊuint64_t
			$bs->pushUint8_t($this->cSkuId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwRegionId); // ���л����� id��ѡ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cRegionId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwPriceSceneId); // ���л����� id��ѡ�� ����Ϊuint64_t
			$bs->pushUint8_t($this->cPriceSceneId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwPriceSourceId); // ���л���Դ id��ѡ�� ����Ϊuint64_t
			$bs->pushUint8_t($this->cPriceSourceId_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPriceCreaterId); // ���л�������id��ѡ�� ����Ϊstd::string
			$bs->pushUint8_t($this->cPriceCreaterId_u); // ���л� ����Ϊuint8_t
			$bs->pushObject($this->bitsetBitDelOperation,'stl_bitset'); // ���л���Ҫ���е�ɾ���������ֶ�(����ɾ��) ��bitset��ʾ ǰ����skuid/region/sourceid/sceneid������ ����Ϊstd::bitset<32> 
			$bs->pushUint8_t($this->cBitDelOperation_u); // ���л� ����Ϊuint8_t
			$bs->pushObject($this->setTimedPriceIndex,'stl_set'); // ���л�ʱ��ά��index ��Ҫɾ��ʱ��ά��ʱ��Ч ����Ϊstd::set<uint32_t> 
			$bs->pushUint8_t($this->cTimedPriceIndex_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // �����л� �汾��    ����Ϊuint32_t
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // �����л�sku id ���� ����Ϊuint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwRegionId = $bs->popUint32_t(); // �����л����� id��ѡ�� ����Ϊuint32_t
			$this->cRegionId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwPriceSceneId = $bs->popUint64_t(); // �����л����� id��ѡ�� ����Ϊuint64_t
			$this->cPriceSceneId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwPriceSourceId = $bs->popUint64_t(); // �����л���Դ id��ѡ�� ����Ϊuint64_t
			$this->cPriceSourceId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPriceCreaterId = $bs->popString(); // �����л�������id��ѡ�� ����Ϊstd::string
			$this->cPriceCreaterId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->bitsetBitDelOperation = $bs->popObject('stl_bitset<32>'); // �����л���Ҫ���е�ɾ���������ֶ�(����ɾ��) ��bitset��ʾ ǰ����skuid/region/sourceid/sceneid������ ����Ϊstd::bitset<32> 
			$this->cBitDelOperation_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->setTimedPriceIndex = $bs->popObject('stl_set<uint32_t>'); // �����л�ʱ��ά��index ��Ҫɾ��ʱ��ά��ʱ��Ч ����Ϊstd::set<uint32_t> 
			$this->cTimedPriceIndex_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.b2b2c.icsonboss.ao.idl.BatchGetSkuInfoListByIcsonIdResp.java

if (!class_exists('BatchConversionIcsonIdErrorPo')) {
class BatchConversionIcsonIdErrorPo
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
		 * �ӿڷ��ش�����
		 *
		 * �汾 >= 0
		 */
		var $dwErrorNo; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cErrorNo_u; //uint8_t

		/**
		 * �ӿڷ����ⲿ�ô�����Ϣ
		 *
		 * �汾 >= 0
		 */
		var $strErrorMsgOutter; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cErrorMsgOutter_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwErrorNo = 0; // uint32_t
			 $this->cErrorNo_u = 0; // uint8_t
			 $this->strErrorMsgOutter = ""; // std::string
			 $this->cErrorMsgOutter_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // ���л� �汾��    ����Ϊuint32_t
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwErrorNo); // ���л��ӿڷ��ش����� ����Ϊuint32_t
			$bs->pushUint8_t($this->cErrorNo_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strErrorMsgOutter); // ���л��ӿڷ����ⲿ�ô�����Ϣ ����Ϊstd::string
			$bs->pushUint8_t($this->cErrorMsgOutter_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // �����л� �汾��    ����Ϊuint32_t
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwErrorNo = $bs->popUint32_t(); // �����л��ӿڷ��ش����� ����Ϊuint32_t
			$this->cErrorNo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strErrorMsgOutter = $bs->popString(); // �����л��ӿڷ����ⲿ�ô�����Ϣ ����Ϊstd::string
			$this->cErrorMsgOutter_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.b2b2c.icsonboss.ao.idl.BatchGetSkuInfoListByIcsonIdResp.java

if (!class_exists('ConversionSkuBasicPo')) {
class ConversionSkuBasicPo
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
		 * SKU״̬
		 *
		 * �汾 >= 0
		 */
		var $wSkuState; //uint16_t

		/**
		 * �汾 >= 0
		 */
		var $cSkuState_u; //uint8_t

		/**
		 * SKUID
		 *
		 * �汾 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cSkuId_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->wSkuState = 0; // uint16_t
			 $this->cSkuState_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // ���л��汾�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint16_t($this->wSkuState); // ���л�SKU״̬ ����Ϊuint16_t
			$bs->pushUint8_t($this->cSkuState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwSkuId); // ���л�SKUID ����Ϊuint64_t
			$bs->pushUint8_t($this->cSkuId_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // �����л��汾�� ����Ϊuint32_t
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->wSkuState = $bs->popUint16_t(); // �����л�SKU״̬ ����Ϊuint16_t
			$this->cSkuState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // �����л�SKUID ����Ϊuint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.b2b2c.icsonboss.ao.idl.BatchGetSkuBySkuIdResp.java

if (!class_exists('BossSkuBasicPo')) {
class BossSkuBasicPo
{
		/**
		 *  �汾��   
		 *
		 * �汾 >= 0
		 */
		var $cVersion; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * skuid  
		 *
		 * �汾 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * �������ID ����+�Ӻ�  
		 *
		 * �汾 >= 0
		 */
		var $ddwCooperatorId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cCooperatorId_u; //uint8_t

		/**
		 * spuId  
		 *
		 * �汾 >= 0
		 */
		var $ddwSpuId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cSpuId_u; //uint8_t

		/**
		 * hash 64bit 
		 *
		 * �汾 >= 0
		 */
		var $ddwHash; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cHash_u; //uint8_t

		/**
		 * ItemID  
		 *
		 * �汾 >= 0
		 */
		var $ddwItemId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cItemId_u; //uint8_t

		/**
		 * Ʒ��ID  
		 *
		 * �汾 >= 0
		 */
		var $dwCategoryId; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cCategoryId_u; //uint8_t

		/**
		 * ssuid 
		 *
		 * �汾 >= 0
		 */
		var $ddwSsuId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cSsuId_u; //uint8_t

		/**
		 * Sku��ͼID  
		 *
		 * �汾 >= 0
		 */
		var $dwMainPicLog; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cMainPicLog_u; //uint8_t

		/**
		 * ��Ӧ��Sku����  
		 *
		 * �汾 >= 0
		 */
		var $strCooperatorSkuCode; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cCooperatorSkuCode_u; //uint8_t

		/**
		 * ������������  
		 *
		 * �汾 >= 0
		 */
		var $strProducerBarCode; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cProducerBarCode_u; //uint8_t

		/**
		 * ����ͨ��������  
		 *
		 * �汾 >= 0
		 */
		var $strInteBarCode; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cInteBarCode_u; //uint8_t

		/**
		 * Sku����  
		 *
		 * �汾 >= 0
		 */
		var $strTitle; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cTitle_u; //uint8_t

		/**
		 * Sku����  
		 *
		 * �汾 >= 0
		 */
		var $strHeadTitle; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cHeadTitle_u; //uint8_t

		/**
		 * Sku����  
		 *
		 * �汾 >= 0
		 */
		var $strSubTitle; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cSubTitle_u; //uint8_t

		/**
		 * Sku������  
		 *
		 * �汾 >= 0
		 */
		var $strPromotionDesc; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cPromotionDesc_u; //uint8_t

		/**
		 * Sku�������Դ�  
		 *
		 * �汾 >= 0
		 */
		var $strSaleAttr; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cSaleAttr_u; //uint8_t

		/**
		 * Sku�������Դ�����  
		 *
		 * �汾 >= 0
		 */
		var $strSaleAttrDesc; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cSaleAttrDesc_u; //uint8_t

		/**
		 * Sku�ο��۸�,��ȷ����  
		 *
		 * �汾 >= 0
		 */
		var $dwRefPrice; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cRefPrice_u; //uint8_t

		/**
		 * Sku ״̬  
		 *
		 * �汾 >= 0
		 */
		var $cState; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cState_u; //uint8_t

		/**
		 * Sku ���� ��  
		 *
		 * �汾 >= 0
		 */
		var $dwWeight; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cWeight_u; //uint8_t

		/**
		 * Sku ��� ��������  
		 *
		 * �汾 >= 0
		 */
		var $dwVolume; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cVolume_u; //uint8_t

		/**
		 * Sku ��Ŀ���Դ�  
		 *
		 * �汾 >= 0
		 */
		var $strCategoryAttr; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cCategoryAttr_u; //uint8_t

		/**
		 * Sku �Զ�������  
		 *
		 * �汾 >= 0
		 */
		var $strCustomizeAttr; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cCustomizeAttr_u; //uint8_t

		/**
		 * Sku �ؼ���  
		 *
		 * �汾 >= 0
		 */
		var $strKeyWord; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cKeyWord_u; //uint8_t

		/**
		 * Sku ����  
		 *
		 * �汾 >= 0
		 */
		var $strClassify; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cClassify_u; //uint8_t

		/**
		 * Sku ��������  
		 *
		 * �汾 >= 0
		 */
		var $dwSearchFactor; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cSearchFactor_u; //uint8_t

		/**
		 * Sku ˰��  
		 *
		 * �汾 >= 0
		 */
		var $dwVatRate; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cVatRate_u; //uint8_t

		/**
		 * Sku ��ǰ���հ汾  
		 *
		 * �汾 >= 0
		 */
		var $wSnapVersion; //uint16_t

		/**
		 * �汾 >= 0
		 */
		var $cSnapVersion_u; //uint8_t

		/**
		 * Sku �������� 0 -- ������  
		 *
		 * �汾 >= 0
		 */
		var $dwBuyLimit; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyLimit_u; //uint8_t

		/**
		 * Sku ����ϼ�ʱ��  
		 *
		 * �汾 >= 0
		 */
		var $dwLastUpTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cLastUpTime_u; //uint8_t

		/**
		 * Sku ����¼�ʱ��  
		 *
		 * �汾 >= 0
		 */
		var $dwLastDownTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cLastDownTime_u; //uint8_t

		/**
		 * Sku ���ʱ��  
		 *
		 * �汾 >= 0
		 */
		var $dwAddTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cAddTime_u; //uint8_t

		/**
		 * Sku ����������ʱ��  
		 *
		 * �汾 >= 0
		 */
		var $dwLastSnapTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cLastSnapTime_u; //uint8_t

		/**
		 * Sku ����޸�ʱ��  
		 *
		 * �汾 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t

		/**
		 * һ��Sku����Ӧ�Ŀ����Ϣ  
		 *
		 * �汾 >= 0
		 */
		var $vecStockInfo; //std::vector<b2b2c::icsonboss::po::CBossStockPo> 

		/**
		 * �汾 >= 0
		 */
		var $cStockInfo_u; //uint8_t

		/**
		 * Sku���� include bitλ
		 *
		 * �汾 >= 0
		 */
		var $bitsetBitInclude; //std::bitset<128> 

		/**
		 * Sku���� include bitλ flag
		 *
		 * �汾 >= 0
		 */
		var $cBitInclude_u; //uint8_t

		/**
		 * Sku���� exclude bitλ
		 *
		 * �汾 >= 0
		 */
		var $bitsetBitExclude; //std::bitset<128> 

		/**
		 * Sku���� exclude bitλ flag
		 *
		 * �汾 >= 0
		 */
		var $cBitExclude_u; //uint8_t

		/**
		 * reserve�ֶ�1
		 *
		 * �汾 >= 0
		 */
		var $strReserve1; //std::string

		/**
		 * reserve�ֶ�1 flag
		 *
		 * �汾 >= 0
		 */
		var $cReserve1_u; //uint8_t

		/**
		 * ��ͼID������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwMainLogoLastUpdateTime; //uint32_t

		/**
		 * ��ͼID������ʱ�� flag
		 *
		 * �汾 >= 0
		 */
		var $cMainLogoLastUpdateTime_u; //uint8_t

		/**
		 * ��ͼUrl map size->url �磺60x60, http://img3.paipaiimg.com/item-4EA7C11F-000000000000000000000004A3C50612.1.60x60.jpg
		 *
		 * �汾 >= 0
		 */
		var $mapMainLogoUrl; //std::map<std::string,std::string> 

		/**
		 * ��ͼUrl map flag
		 *
		 * �汾 >= 0
		 */
		var $cMainLogoUrl_u; //uint8_t

		/**
		 * �����Id
		 *
		 * �汾 >= 0
		 */
		var $dwSkuSizeTableId; //uint32_t

		/**
		 * �����Id flag
		 *
		 * �汾 >= 0
		 */
		var $cSkuSizeTableId_u; //uint8_t

		/**
		 * Sku����  
		 *
		 * �汾 >= 0
		 */
		var $bitsetBitProperty; //std::bitset<128> 

		/**
		 * Sku���� flag 
		 *
		 * �汾 >= 0
		 */
		var $cBitProperty_u; //uint8_t

		/**
		 * �Զ������  ����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $setCustomCategary; //std::set<uint32_t> 

		/**
		 * �Զ������_u
		 *
		 * �汾 >= 0
		 */
		var $cCustomCategary_u; //uint8_t

		/**
		 * ģ��澯 
		 *
		 * �汾 >= 0
		 */
		var $setAlarmGroups; //std::set<uint32_t> 

		/**
		 * ģ��澯 flag
		 *
		 * �汾 >= 0
		 */
		var $cAlarmGroups_u; //uint8_t

		/**
		 * ��Ʒ���� 0:������Ʒ 1:������Ʒ 2:��Ʒ 3:���� 
		 *
		 * �汾 >= 0
		 */
		var $dwSkuType; //uint32_t

		/**
		 * ��Ʒ���� 0:������Ʒ 1:������Ʒ 2:��Ʒ 3:���� flag 
		 *
		 * �汾 >= 0
		 */
		var $cSkuType_u; //uint8_t

		/**
		 * ��Ѹsku��չ��Ϣ 
		 *
		 * �汾 >= 0
		 */
		var $oBossSkuIcsonPo; //b2b2c::icsonboss::po::CBossSkuIcsonPo

		/**
		 * ��Ѹsku��չ��Ϣ flag 
		 *
		 * �汾 >= 0
		 */
		var $cBossSkuIcsonPo_u; //uint8_t

		/**
		 * ��Ӫ���� 0:���Ž���/1:��Ӫ/2:��Ӫ���/3����Ӫ����/4��������Ӫ 
		 *
		 * �汾 >= 0
		 */
		var $dwSkuOperationModel; //uint32_t

		/**
		 * ��Ӫ���� 0:���Ž���/1:��Ӫ/2:��Ӫ���/3����Ӫ����/4��������Ӫ 
		 *
		 * �汾 >= 0
		 */
		var $cSkuOperationModel_u; //uint8_t

		/**
		 * ��Ʒ���ȣ���λ����
		 *
		 * �汾 >= 0
		 */
		var $wSkuSizeX; //uint16_t

		/**
		 * ��Ʒ���ȣ���λ����
		 *
		 * �汾 >= 0
		 */
		var $cSkuSizeX_u; //uint8_t

		/**
		 * ��Ʒ��ȣ���λ����
		 *
		 * �汾 >= 0
		 */
		var $wSkuSizeY; //uint16_t

		/**
		 * ��Ʒ��ȣ���λ����
		 *
		 * �汾 >= 0
		 */
		var $cSkuSizeY_u; //uint8_t

		/**
		 * ��Ʒ�߶ȣ���λ����
		 *
		 * �汾 >= 0
		 */
		var $wSkuSizeZ; //uint16_t

		/**
		 * ��Ʒ�߶ȣ���λ����
		 *
		 * �汾 >= 0
		 */
		var $cSkuSizeZ_u; //uint8_t

		/**
		 * ����嵥, coSkuCode(��Ѹsysno) -> �������
		 *
		 * �汾 >= 0
		 */
		var $mapSkuComponent; //std::map<std::string,uint16_t> 

		/**
		 * ����嵥, coSkuCode(��Ѹsysno) -> �������_u
		 *
		 * �汾 >= 0
		 */
		var $cSkuComponent_u; //uint8_t


		 function __construct() {
			 $this->cVersion = 0; // uint8_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->ddwCooperatorId = 0; // uint64_t
			 $this->cCooperatorId_u = 0; // uint8_t
			 $this->ddwSpuId = 0; // uint64_t
			 $this->cSpuId_u = 0; // uint8_t
			 $this->ddwHash = 0; // uint64_t
			 $this->cHash_u = 0; // uint8_t
			 $this->ddwItemId = 0; // uint64_t
			 $this->cItemId_u = 0; // uint8_t
			 $this->dwCategoryId = 0; // uint32_t
			 $this->cCategoryId_u = 0; // uint8_t
			 $this->ddwSsuId = 0; // uint64_t
			 $this->cSsuId_u = 0; // uint8_t
			 $this->dwMainPicLog = 0; // uint32_t
			 $this->cMainPicLog_u = 0; // uint8_t
			 $this->strCooperatorSkuCode = ""; // std::string
			 $this->cCooperatorSkuCode_u = 0; // uint8_t
			 $this->strProducerBarCode = ""; // std::string
			 $this->cProducerBarCode_u = 0; // uint8_t
			 $this->strInteBarCode = ""; // std::string
			 $this->cInteBarCode_u = 0; // uint8_t
			 $this->strTitle = ""; // std::string
			 $this->cTitle_u = 0; // uint8_t
			 $this->strHeadTitle = ""; // std::string
			 $this->cHeadTitle_u = 0; // uint8_t
			 $this->strSubTitle = ""; // std::string
			 $this->cSubTitle_u = 0; // uint8_t
			 $this->strPromotionDesc = ""; // std::string
			 $this->cPromotionDesc_u = 0; // uint8_t
			 $this->strSaleAttr = ""; // std::string
			 $this->cSaleAttr_u = 0; // uint8_t
			 $this->strSaleAttrDesc = ""; // std::string
			 $this->cSaleAttrDesc_u = 0; // uint8_t
			 $this->dwRefPrice = 0; // uint32_t
			 $this->cRefPrice_u = 0; // uint8_t
			 $this->cState = 0; // uint8_t
			 $this->cState_u = 0; // uint8_t
			 $this->dwWeight = 0; // uint32_t
			 $this->cWeight_u = 0; // uint8_t
			 $this->dwVolume = 0; // uint32_t
			 $this->cVolume_u = 0; // uint8_t
			 $this->strCategoryAttr = ""; // std::string
			 $this->cCategoryAttr_u = 0; // uint8_t
			 $this->strCustomizeAttr = ""; // std::string
			 $this->cCustomizeAttr_u = 0; // uint8_t
			 $this->strKeyWord = ""; // std::string
			 $this->cKeyWord_u = 0; // uint8_t
			 $this->strClassify = ""; // std::string
			 $this->cClassify_u = 0; // uint8_t
			 $this->dwSearchFactor = 0; // uint32_t
			 $this->cSearchFactor_u = 0; // uint8_t
			 $this->dwVatRate = 0; // uint32_t
			 $this->cVatRate_u = 0; // uint8_t
			 $this->wSnapVersion = 0; // uint16_t
			 $this->cSnapVersion_u = 0; // uint8_t
			 $this->dwBuyLimit = 0; // uint32_t
			 $this->cBuyLimit_u = 0; // uint8_t
			 $this->dwLastUpTime = 0; // uint32_t
			 $this->cLastUpTime_u = 0; // uint8_t
			 $this->dwLastDownTime = 0; // uint32_t
			 $this->cLastDownTime_u = 0; // uint8_t
			 $this->dwAddTime = 0; // uint32_t
			 $this->cAddTime_u = 0; // uint8_t
			 $this->dwLastSnapTime = 0; // uint32_t
			 $this->cLastSnapTime_u = 0; // uint8_t
			 $this->dwLastUpdateTime = 0; // uint32_t
			 $this->cLastUpdateTime_u = 0; // uint8_t
			 $this->vecStockInfo = new stl_vector('BossStockPo'); // std::vector<b2b2c::icsonboss::po::CBossStockPo> 
			 $this->cStockInfo_u = 0; // uint8_t
			 $this->bitsetBitInclude = new stl_bitset('128'); // std::bitset<128> 
			 $this->cBitInclude_u = 0; // uint8_t
			 $this->bitsetBitExclude = new stl_bitset('128'); // std::bitset<128> 
			 $this->cBitExclude_u = 0; // uint8_t
			 $this->strReserve1 = ""; // std::string
			 $this->cReserve1_u = 0; // uint8_t
			 $this->dwMainLogoLastUpdateTime = 0; // uint32_t
			 $this->cMainLogoLastUpdateTime_u = 0; // uint8_t
			 $this->mapMainLogoUrl = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
			 $this->cMainLogoUrl_u = 0; // uint8_t
			 $this->dwSkuSizeTableId = 0; // uint32_t
			 $this->cSkuSizeTableId_u = 0; // uint8_t
			 $this->bitsetBitProperty = new stl_bitset('128'); // std::bitset<128> 
			 $this->cBitProperty_u = 0; // uint8_t
			 $this->setCustomCategary = new stl_set('uint32_t'); // std::set<uint32_t> 
			 $this->cCustomCategary_u = 0; // uint8_t
			 $this->setAlarmGroups = new stl_set('uint32_t'); // std::set<uint32_t> 
			 $this->cAlarmGroups_u = 0; // uint8_t
			 $this->dwSkuType = 0; // uint32_t
			 $this->cSkuType_u = 0; // uint8_t
			 $this->oBossSkuIcsonPo = new BossSkuIcsonPo(); // b2b2c::icsonboss::po::CBossSkuIcsonPo
			 $this->cBossSkuIcsonPo_u = 0; // uint8_t
			 $this->dwSkuOperationModel = 0; // uint32_t
			 $this->cSkuOperationModel_u = 0; // uint8_t
			 $this->wSkuSizeX = 0; // uint16_t
			 $this->cSkuSizeX_u = 0; // uint8_t
			 $this->wSkuSizeY = 0; // uint16_t
			 $this->cSkuSizeY_u = 0; // uint8_t
			 $this->wSkuSizeZ = 0; // uint16_t
			 $this->cSkuSizeZ_u = 0; // uint8_t
			 $this->mapSkuComponent = new stl_map('stl_string,uint16_t'); // std::map<std::string,uint16_t> 
			 $this->cSkuComponent_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint8_t($this->cVersion); // ���л� �汾��    ����Ϊuint8_t
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwSkuId); // ���л�skuid   ����Ϊuint64_t
			$bs->pushUint8_t($this->cSkuId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwCooperatorId); // ���л��������ID ����+�Ӻ�   ����Ϊuint64_t
			$bs->pushUint8_t($this->cCooperatorId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwSpuId); // ���л�spuId   ����Ϊuint64_t
			$bs->pushUint8_t($this->cSpuId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwHash); // ���л�hash 64bit  ����Ϊuint64_t
			$bs->pushUint8_t($this->cHash_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwItemId); // ���л�ItemID   ����Ϊuint64_t
			$bs->pushUint8_t($this->cItemId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwCategoryId); // ���л�Ʒ��ID   ����Ϊuint32_t
			$bs->pushUint8_t($this->cCategoryId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwSsuId); // ���л�ssuid  ����Ϊuint64_t
			$bs->pushUint8_t($this->cSsuId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwMainPicLog); // ���л�Sku��ͼID   ����Ϊuint32_t
			$bs->pushUint8_t($this->cMainPicLog_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strCooperatorSkuCode); // ���л���Ӧ��Sku����   ����Ϊstd::string
			$bs->pushUint8_t($this->cCooperatorSkuCode_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strProducerBarCode); // ���л�������������   ����Ϊstd::string
			$bs->pushUint8_t($this->cProducerBarCode_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strInteBarCode); // ���л�����ͨ��������   ����Ϊstd::string
			$bs->pushUint8_t($this->cInteBarCode_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strTitle); // ���л�Sku����   ����Ϊstd::string
			$bs->pushUint8_t($this->cTitle_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strHeadTitle); // ���л�Sku����   ����Ϊstd::string
			$bs->pushUint8_t($this->cHeadTitle_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strSubTitle); // ���л�Sku����   ����Ϊstd::string
			$bs->pushUint8_t($this->cSubTitle_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strPromotionDesc); // ���л�Sku������   ����Ϊstd::string
			$bs->pushUint8_t($this->cPromotionDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strSaleAttr); // ���л�Sku�������Դ�   ����Ϊstd::string
			$bs->pushUint8_t($this->cSaleAttr_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strSaleAttrDesc); // ���л�Sku�������Դ�����   ����Ϊstd::string
			$bs->pushUint8_t($this->cSaleAttrDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwRefPrice); // ���л�Sku�ο��۸�,��ȷ����   ����Ϊuint32_t
			$bs->pushUint8_t($this->cRefPrice_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cState); // ���л�Sku ״̬   ����Ϊuint8_t
			$bs->pushUint8_t($this->cState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwWeight); // ���л�Sku ���� ��   ����Ϊuint32_t
			$bs->pushUint8_t($this->cWeight_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwVolume); // ���л�Sku ��� ��������   ����Ϊuint32_t
			$bs->pushUint8_t($this->cVolume_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strCategoryAttr); // ���л�Sku ��Ŀ���Դ�   ����Ϊstd::string
			$bs->pushUint8_t($this->cCategoryAttr_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strCustomizeAttr); // ���л�Sku �Զ�������   ����Ϊstd::string
			$bs->pushUint8_t($this->cCustomizeAttr_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strKeyWord); // ���л�Sku �ؼ���   ����Ϊstd::string
			$bs->pushUint8_t($this->cKeyWord_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strClassify); // ���л�Sku ����   ����Ϊstd::string
			$bs->pushUint8_t($this->cClassify_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwSearchFactor); // ���л�Sku ��������   ����Ϊuint32_t
			$bs->pushUint8_t($this->cSearchFactor_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwVatRate); // ���л�Sku ˰��   ����Ϊuint32_t
			$bs->pushUint8_t($this->cVatRate_u); // ���л� ����Ϊuint8_t
			$bs->pushUint16_t($this->wSnapVersion); // ���л�Sku ��ǰ���հ汾   ����Ϊuint16_t
			$bs->pushUint8_t($this->cSnapVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwBuyLimit); // ���л�Sku �������� 0 -- ������   ����Ϊuint32_t
			$bs->pushUint8_t($this->cBuyLimit_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwLastUpTime); // ���л�Sku ����ϼ�ʱ��   ����Ϊuint32_t
			$bs->pushUint8_t($this->cLastUpTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwLastDownTime); // ���л�Sku ����¼�ʱ��   ����Ϊuint32_t
			$bs->pushUint8_t($this->cLastDownTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwAddTime); // ���л�Sku ���ʱ��   ����Ϊuint32_t
			$bs->pushUint8_t($this->cAddTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwLastSnapTime); // ���л�Sku ����������ʱ��   ����Ϊuint32_t
			$bs->pushUint8_t($this->cLastSnapTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // ���л�Sku ����޸�ʱ��   ����Ϊuint32_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // ���л� ����Ϊuint8_t
			$bs->pushObject($this->vecStockInfo,'stl_vector'); // ���л�һ��Sku����Ӧ�Ŀ����Ϣ   ����Ϊstd::vector<b2b2c::icsonboss::po::CBossStockPo> 
			$bs->pushUint8_t($this->cStockInfo_u); // ���л� ����Ϊuint8_t
			$bs->pushObject($this->bitsetBitInclude,'stl_bitset'); // ���л�Sku���� include bitλ ����Ϊstd::bitset<128> 
			$bs->pushUint8_t($this->cBitInclude_u); // ���л�Sku���� include bitλ flag ����Ϊuint8_t
			$bs->pushObject($this->bitsetBitExclude,'stl_bitset'); // ���л�Sku���� exclude bitλ ����Ϊstd::bitset<128> 
			$bs->pushUint8_t($this->cBitExclude_u); // ���л�Sku���� exclude bitλ flag ����Ϊuint8_t
			$bs->pushString($this->strReserve1); // ���л�reserve�ֶ�1 ����Ϊstd::string
			$bs->pushUint8_t($this->cReserve1_u); // ���л�reserve�ֶ�1 flag ����Ϊuint8_t
			$bs->pushUint32_t($this->dwMainLogoLastUpdateTime); // ���л���ͼID������ʱ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cMainLogoLastUpdateTime_u); // ���л���ͼID������ʱ�� flag ����Ϊuint8_t
			$bs->pushObject($this->mapMainLogoUrl,'stl_map'); // ���л���ͼUrl map size->url �磺60x60, http://img3.paipaiimg.com/item-4EA7C11F-000000000000000000000004A3C50612.1.60x60.jpg ����Ϊstd::map<std::string,std::string> 
			$bs->pushUint8_t($this->cMainLogoUrl_u); // ���л���ͼUrl map flag ����Ϊuint8_t
			$bs->pushUint32_t($this->dwSkuSizeTableId); // ���л������Id ����Ϊuint32_t
			$bs->pushUint8_t($this->cSkuSizeTableId_u); // ���л������Id flag ����Ϊuint8_t
			$bs->pushObject($this->bitsetBitProperty,'stl_bitset'); // ���л�Sku����   ����Ϊstd::bitset<128> 
			$bs->pushUint8_t($this->cBitProperty_u); // ���л�Sku���� flag  ����Ϊuint8_t
			$bs->pushObject($this->setCustomCategary,'stl_set'); // ���л��Զ������  ����ʱ�� ����Ϊstd::set<uint32_t> 
			$bs->pushUint8_t($this->cCustomCategary_u); // ���л��Զ������_u ����Ϊuint8_t
			$bs->pushObject($this->setAlarmGroups,'stl_set'); // ���л�ģ��澯  ����Ϊstd::set<uint32_t> 
			$bs->pushUint8_t($this->cAlarmGroups_u); // ���л�ģ��澯 flag ����Ϊuint8_t
			$bs->pushUint32_t($this->dwSkuType); // ���л���Ʒ���� 0:������Ʒ 1:������Ʒ 2:��Ʒ 3:����  ����Ϊuint32_t
			$bs->pushUint8_t($this->cSkuType_u); // ���л���Ʒ���� 0:������Ʒ 1:������Ʒ 2:��Ʒ 3:���� flag  ����Ϊuint8_t
			$bs->pushObject($this->oBossSkuIcsonPo,'BossSkuIcsonPo'); // ���л���Ѹsku��չ��Ϣ  ����Ϊb2b2c::icsonboss::po::CBossSkuIcsonPo
			$bs->pushUint8_t($this->cBossSkuIcsonPo_u); // ���л���Ѹsku��չ��Ϣ flag  ����Ϊuint8_t
			$bs->pushUint32_t($this->dwSkuOperationModel); // ���л���Ӫ���� 0:���Ž���/1:��Ӫ/2:��Ӫ���/3����Ӫ����/4��������Ӫ  ����Ϊuint32_t
			$bs->pushUint8_t($this->cSkuOperationModel_u); // ���л���Ӫ���� 0:���Ž���/1:��Ӫ/2:��Ӫ���/3����Ӫ����/4��������Ӫ  ����Ϊuint8_t
			$bs->pushUint16_t($this->wSkuSizeX); // ���л���Ʒ���ȣ���λ���� ����Ϊuint16_t
			$bs->pushUint8_t($this->cSkuSizeX_u); // ���л���Ʒ���ȣ���λ���� ����Ϊuint8_t
			$bs->pushUint16_t($this->wSkuSizeY); // ���л���Ʒ��ȣ���λ���� ����Ϊuint16_t
			$bs->pushUint8_t($this->cSkuSizeY_u); // ���л���Ʒ��ȣ���λ���� ����Ϊuint8_t
			$bs->pushUint16_t($this->wSkuSizeZ); // ���л���Ʒ�߶ȣ���λ���� ����Ϊuint16_t
			$bs->pushUint8_t($this->cSkuSizeZ_u); // ���л���Ʒ�߶ȣ���λ���� ����Ϊuint8_t
			$bs->pushObject($this->mapSkuComponent,'stl_map'); // ���л�����嵥, coSkuCode(��Ѹsysno) -> ������� ����Ϊstd::map<std::string,uint16_t> 
			$bs->pushUint8_t($this->cSkuComponent_u); // ���л�����嵥, coSkuCode(��Ѹsysno) -> �������_u ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->cVersion = $bs->popUint8_t(); // �����л� �汾��    ����Ϊuint8_t
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // �����л�skuid   ����Ϊuint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwCooperatorId = $bs->popUint64_t(); // �����л��������ID ����+�Ӻ�   ����Ϊuint64_t
			$this->cCooperatorId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwSpuId = $bs->popUint64_t(); // �����л�spuId   ����Ϊuint64_t
			$this->cSpuId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwHash = $bs->popUint64_t(); // �����л�hash 64bit  ����Ϊuint64_t
			$this->cHash_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwItemId = $bs->popUint64_t(); // �����л�ItemID   ����Ϊuint64_t
			$this->cItemId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwCategoryId = $bs->popUint32_t(); // �����л�Ʒ��ID   ����Ϊuint32_t
			$this->cCategoryId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwSsuId = $bs->popUint64_t(); // �����л�ssuid  ����Ϊuint64_t
			$this->cSsuId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwMainPicLog = $bs->popUint32_t(); // �����л�Sku��ͼID   ����Ϊuint32_t
			$this->cMainPicLog_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strCooperatorSkuCode = $bs->popString(); // �����л���Ӧ��Sku����   ����Ϊstd::string
			$this->cCooperatorSkuCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strProducerBarCode = $bs->popString(); // �����л�������������   ����Ϊstd::string
			$this->cProducerBarCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strInteBarCode = $bs->popString(); // �����л�����ͨ��������   ����Ϊstd::string
			$this->cInteBarCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strTitle = $bs->popString(); // �����л�Sku����   ����Ϊstd::string
			$this->cTitle_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strHeadTitle = $bs->popString(); // �����л�Sku����   ����Ϊstd::string
			$this->cHeadTitle_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strSubTitle = $bs->popString(); // �����л�Sku����   ����Ϊstd::string
			$this->cSubTitle_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strPromotionDesc = $bs->popString(); // �����л�Sku������   ����Ϊstd::string
			$this->cPromotionDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strSaleAttr = $bs->popString(); // �����л�Sku�������Դ�   ����Ϊstd::string
			$this->cSaleAttr_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strSaleAttrDesc = $bs->popString(); // �����л�Sku�������Դ�����   ����Ϊstd::string
			$this->cSaleAttrDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwRefPrice = $bs->popUint32_t(); // �����л�Sku�ο��۸�,��ȷ����   ����Ϊuint32_t
			$this->cRefPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cState = $bs->popUint8_t(); // �����л�Sku ״̬   ����Ϊuint8_t
			$this->cState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwWeight = $bs->popUint32_t(); // �����л�Sku ���� ��   ����Ϊuint32_t
			$this->cWeight_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwVolume = $bs->popUint32_t(); // �����л�Sku ��� ��������   ����Ϊuint32_t
			$this->cVolume_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strCategoryAttr = $bs->popString(); // �����л�Sku ��Ŀ���Դ�   ����Ϊstd::string
			$this->cCategoryAttr_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strCustomizeAttr = $bs->popString(); // �����л�Sku �Զ�������   ����Ϊstd::string
			$this->cCustomizeAttr_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strKeyWord = $bs->popString(); // �����л�Sku �ؼ���   ����Ϊstd::string
			$this->cKeyWord_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strClassify = $bs->popString(); // �����л�Sku ����   ����Ϊstd::string
			$this->cClassify_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwSearchFactor = $bs->popUint32_t(); // �����л�Sku ��������   ����Ϊuint32_t
			$this->cSearchFactor_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwVatRate = $bs->popUint32_t(); // �����л�Sku ˰��   ����Ϊuint32_t
			$this->cVatRate_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->wSnapVersion = $bs->popUint16_t(); // �����л�Sku ��ǰ���հ汾   ����Ϊuint16_t
			$this->cSnapVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwBuyLimit = $bs->popUint32_t(); // �����л�Sku �������� 0 -- ������   ����Ϊuint32_t
			$this->cBuyLimit_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwLastUpTime = $bs->popUint32_t(); // �����л�Sku ����ϼ�ʱ��   ����Ϊuint32_t
			$this->cLastUpTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwLastDownTime = $bs->popUint32_t(); // �����л�Sku ����¼�ʱ��   ����Ϊuint32_t
			$this->cLastDownTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwAddTime = $bs->popUint32_t(); // �����л�Sku ���ʱ��   ����Ϊuint32_t
			$this->cAddTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwLastSnapTime = $bs->popUint32_t(); // �����л�Sku ����������ʱ��   ����Ϊuint32_t
			$this->cLastSnapTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // �����л�Sku ����޸�ʱ��   ����Ϊuint32_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->vecStockInfo = $bs->popObject('stl_vector<BossStockPo>'); // �����л�һ��Sku����Ӧ�Ŀ����Ϣ   ����Ϊstd::vector<b2b2c::icsonboss::po::CBossStockPo> 
			$this->cStockInfo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->bitsetBitInclude = $bs->popObject('stl_bitset<128>'); // �����л�Sku���� include bitλ ����Ϊstd::bitset<128> 
			$this->cBitInclude_u = $bs->popUint8_t(); // �����л�Sku���� include bitλ flag ����Ϊuint8_t
			$this->bitsetBitExclude = $bs->popObject('stl_bitset<128>'); // �����л�Sku���� exclude bitλ ����Ϊstd::bitset<128> 
			$this->cBitExclude_u = $bs->popUint8_t(); // �����л�Sku���� exclude bitλ flag ����Ϊuint8_t
			$this->strReserve1 = $bs->popString(); // �����л�reserve�ֶ�1 ����Ϊstd::string
			$this->cReserve1_u = $bs->popUint8_t(); // �����л�reserve�ֶ�1 flag ����Ϊuint8_t
			$this->dwMainLogoLastUpdateTime = $bs->popUint32_t(); // �����л���ͼID������ʱ�� ����Ϊuint32_t
			$this->cMainLogoLastUpdateTime_u = $bs->popUint8_t(); // �����л���ͼID������ʱ�� flag ����Ϊuint8_t
			$this->mapMainLogoUrl = $bs->popObject('stl_map<stl_string,stl_string>'); // �����л���ͼUrl map size->url �磺60x60, http://img3.paipaiimg.com/item-4EA7C11F-000000000000000000000004A3C50612.1.60x60.jpg ����Ϊstd::map<std::string,std::string> 
			$this->cMainLogoUrl_u = $bs->popUint8_t(); // �����л���ͼUrl map flag ����Ϊuint8_t
			$this->dwSkuSizeTableId = $bs->popUint32_t(); // �����л������Id ����Ϊuint32_t
			$this->cSkuSizeTableId_u = $bs->popUint8_t(); // �����л������Id flag ����Ϊuint8_t
			$this->bitsetBitProperty = $bs->popObject('stl_bitset<128>'); // �����л�Sku����   ����Ϊstd::bitset<128> 
			$this->cBitProperty_u = $bs->popUint8_t(); // �����л�Sku���� flag  ����Ϊuint8_t
			$this->setCustomCategary = $bs->popObject('stl_set<uint32_t>'); // �����л��Զ������  ����ʱ�� ����Ϊstd::set<uint32_t> 
			$this->cCustomCategary_u = $bs->popUint8_t(); // �����л��Զ������_u ����Ϊuint8_t
			$this->setAlarmGroups = $bs->popObject('stl_set<uint32_t>'); // �����л�ģ��澯  ����Ϊstd::set<uint32_t> 
			$this->cAlarmGroups_u = $bs->popUint8_t(); // �����л�ģ��澯 flag ����Ϊuint8_t
			$this->dwSkuType = $bs->popUint32_t(); // �����л���Ʒ���� 0:������Ʒ 1:������Ʒ 2:��Ʒ 3:����  ����Ϊuint32_t
			$this->cSkuType_u = $bs->popUint8_t(); // �����л���Ʒ���� 0:������Ʒ 1:������Ʒ 2:��Ʒ 3:���� flag  ����Ϊuint8_t
			$this->oBossSkuIcsonPo = $bs->popObject('BossSkuIcsonPo'); // �����л���Ѹsku��չ��Ϣ  ����Ϊb2b2c::icsonboss::po::CBossSkuIcsonPo
			$this->cBossSkuIcsonPo_u = $bs->popUint8_t(); // �����л���Ѹsku��չ��Ϣ flag  ����Ϊuint8_t
			$this->dwSkuOperationModel = $bs->popUint32_t(); // �����л���Ӫ���� 0:���Ž���/1:��Ӫ/2:��Ӫ���/3����Ӫ����/4��������Ӫ  ����Ϊuint32_t
			$this->cSkuOperationModel_u = $bs->popUint8_t(); // �����л���Ӫ���� 0:���Ž���/1:��Ӫ/2:��Ӫ���/3����Ӫ����/4��������Ӫ  ����Ϊuint8_t
			$this->wSkuSizeX = $bs->popUint16_t(); // �����л���Ʒ���ȣ���λ���� ����Ϊuint16_t
			$this->cSkuSizeX_u = $bs->popUint8_t(); // �����л���Ʒ���ȣ���λ���� ����Ϊuint8_t
			$this->wSkuSizeY = $bs->popUint16_t(); // �����л���Ʒ��ȣ���λ���� ����Ϊuint16_t
			$this->cSkuSizeY_u = $bs->popUint8_t(); // �����л���Ʒ��ȣ���λ���� ����Ϊuint8_t
			$this->wSkuSizeZ = $bs->popUint16_t(); // �����л���Ʒ�߶ȣ���λ���� ����Ϊuint16_t
			$this->cSkuSizeZ_u = $bs->popUint8_t(); // �����л���Ʒ�߶ȣ���λ���� ����Ϊuint8_t
			$this->mapSkuComponent = $bs->popObject('stl_map<stl_string,uint16_t>'); // �����л�����嵥, coSkuCode(��Ѹsysno) -> ������� ����Ϊstd::map<std::string,uint16_t> 
			$this->cSkuComponent_u = $bs->popUint8_t(); // �����л�����嵥, coSkuCode(��Ѹsysno) -> �������_u ����Ϊuint8_t

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


//source idl: com.b2b2c.icsonboss.ao.idl.BossSkuBasicPo.java

if (!class_exists('BossSkuIcsonPo')) {
class BossSkuIcsonPo
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
		 * skuid  
		 *
		 * �汾 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * ��Ѹ��Ʒ���  
		 *
		 * �汾 >= 0
		 */
		var $strProductId; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cProductId_u; //uint8_t

		/**
		 * Ʒ�Ʊ��  
		 *
		 * �汾 >= 0
		 */
		var $ddwManufacturerSysNo; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cManufacturerSysNo_u; //uint8_t

		/**
		 * ��Ʒ�ͺ�  
		 *
		 * �汾 >= 0
		 */
		var $strProductMode; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cProductMode_u; //uint8_t

		/**
		 * ������  
		 *
		 * �汾 >= 0
		 */
		var $ddwC1SysNo; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cC1SysNo_u; //uint8_t

		/**
		 * ������  
		 *
		 * �汾 >= 0
		 */
		var $ddwC2SysNo; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cC2SysNo_u; //uint8_t

		/**
		 * С����  
		 *
		 * �汾 >= 0
		 */
		var $ddwC3SysNo; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cC3SysNo_u; //uint8_t

		/**
		 * С������  
		 *
		 * �汾 >= 0
		 */
		var $ddwC4SysNo; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cC4SysNo_u; //uint8_t

		/**
		 * С������  
		 *
		 * �汾 >= 0
		 */
		var $ddwC5SysNo; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cC5SysNo_u; //uint8_t

		/**
		 * ��Ʒ��ɫ��ţ�ǰ��������������չʾ  
		 *
		 * �汾 >= 0
		 */
		var $ddwProductColor; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cProductColor_u; //uint8_t

		/**
		 * ��Ʒ���ǰ��������������չʾ  
		 *
		 * �汾 >= 0
		 */
		var $ddwProductSize; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cProductSize_u; //uint8_t

		/**
		 * ��Ӧ����Ʒ����ѸID  
		 *
		 * �汾 >= 0
		 */
		var $ddwMasterProductSysNo; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cMasterProductSysNo_u; //uint8_t

		/**
		 * ��С����Ʒ��ʵ��ͼƬʱ������ʾǰ�沿��ͼƬ  
		 *
		 * �汾 >= 0
		 */
		var $dwShowPicCount; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cShowPicCount_u; //uint8_t

		/**
		 *  
		 *
		 * �汾 >= 0
		 */
		var $strAttrs; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cAttrs_u; //uint8_t

		/**
		 * '��Ѹ����Ʒ�������ԣ���ʽΪ 1:���ܼ���|2:�ӱ���Ʒ��Ŀǰ������ʾ���ܼ���/�ӱ���Ʒ��־ 
		 *
		 * �汾 >= 0
		 */
		var $strSpecialAttrs; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cSpecialAttrs_u; //uint8_t

		/**
		 * ������Ʒ��Դ, 0:���ղ��/1:��װ����/2:����ά��/3:����ά��/4:��������/5:��������/6:�˿�����/7:���Ҽ���޹���  
		 *
		 * �汾 >= 0
		 */
		var $dwSndSource; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cSndSource_u; //uint8_t

		/**
		 * ���ֱ��޽�ֹʱ�� 
		 *
		 * �汾 >= 0
		 */
		var $dwSndWarrantyTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cSndWarrantyTime_u; //uint8_t

		/**
		 * ������ƷƷ��, 0:ȫ��/1:�ų���/2:�˳���/3:�߳���/4:�߳����� 
		 *
		 * �汾 >= 0
		 */
		var $dwSndClass; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cSndClass_u; //uint8_t

		/**
		 * ������Ʒ����, 0:δʹ�ù���ԭ��װ��⣬�������/1:��ʹ�ù����������/2:��ά�޹����������/3:���װ����δ��� 
		 *
		 * �汾 >= 0
		 */
		var $dwSndPerformance; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cSndPerformance_u; //uint8_t

		/**
		 * ���ֹ˿�ʹ��ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwSndUsedDays; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cSndUsedDays_u; //uint8_t

		/**
		 * �����Ƿ�ʵ������, 0:��/1:��
		 *
		 * �汾 >= 0
		 */
		var $dwSndHavePhoto; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cSndHavePhoto_u; //uint8_t

		/**
		 * ���ֱ�ע��Ϣ
		 *
		 * �汾 >= 0
		 */
		var $strSndMemo; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cSndMemo_u; //uint8_t

		/**
		 * ���ְ�װ����
		 *
		 * �汾 >= 0
		 */
		var $strSndAttach; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cSndAttach_u; //uint8_t

		/**
		 * ����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwCreateTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cCreateTime_u; //uint8_t

		/**
		 * ������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t

		/**
		 * ��Լ��ҵ������
		 *
		 * �汾 >= 0
		 */
		var $dwContractSaleModel; //uint32_t

		/**
		 * ��Լ��ҵ������ flag
		 *
		 * �汾 >= 0
		 */
		var $cContractSaleModel_u; //uint8_t

		/**
		 * ��������չ������Ŀ��Ϣ
		 *
		 * �汾 >= 0
		 */
		var $strCarAttrInfo; //std::string

		/**
		 * ��������չ������Ŀ��Ϣ flag
		 *
		 * �汾 >= 0
		 */
		var $cCarAttrInfo_u; //uint8_t

		/**
		 * ����
		 *
		 * �汾 >= 0
		 */
		var $dwSkuOwner; //uint32_t

		/**
		 * ���� flag
		 *
		 * �汾 >= 0
		 */
		var $cSkuOwner_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 1; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->strProductId = ""; // std::string
			 $this->cProductId_u = 0; // uint8_t
			 $this->ddwManufacturerSysNo = 0; // uint64_t
			 $this->cManufacturerSysNo_u = 0; // uint8_t
			 $this->strProductMode = ""; // std::string
			 $this->cProductMode_u = 0; // uint8_t
			 $this->ddwC1SysNo = 0; // uint64_t
			 $this->cC1SysNo_u = 0; // uint8_t
			 $this->ddwC2SysNo = 0; // uint64_t
			 $this->cC2SysNo_u = 0; // uint8_t
			 $this->ddwC3SysNo = 0; // uint64_t
			 $this->cC3SysNo_u = 0; // uint8_t
			 $this->ddwC4SysNo = 0; // uint64_t
			 $this->cC4SysNo_u = 0; // uint8_t
			 $this->ddwC5SysNo = 0; // uint64_t
			 $this->cC5SysNo_u = 0; // uint8_t
			 $this->ddwProductColor = 0; // uint64_t
			 $this->cProductColor_u = 0; // uint8_t
			 $this->ddwProductSize = 0; // uint64_t
			 $this->cProductSize_u = 0; // uint8_t
			 $this->ddwMasterProductSysNo = 0; // uint64_t
			 $this->cMasterProductSysNo_u = 0; // uint8_t
			 $this->dwShowPicCount = 0; // uint32_t
			 $this->cShowPicCount_u = 0; // uint8_t
			 $this->strAttrs = ""; // std::string
			 $this->cAttrs_u = 0; // uint8_t
			 $this->strSpecialAttrs = ""; // std::string
			 $this->cSpecialAttrs_u = 0; // uint8_t
			 $this->dwSndSource = 0; // uint32_t
			 $this->cSndSource_u = 0; // uint8_t
			 $this->dwSndWarrantyTime = 0; // uint32_t
			 $this->cSndWarrantyTime_u = 0; // uint8_t
			 $this->dwSndClass = 0; // uint32_t
			 $this->cSndClass_u = 0; // uint8_t
			 $this->dwSndPerformance = 0; // uint32_t
			 $this->cSndPerformance_u = 0; // uint8_t
			 $this->dwSndUsedDays = 0; // uint32_t
			 $this->cSndUsedDays_u = 0; // uint8_t
			 $this->dwSndHavePhoto = 0; // uint32_t
			 $this->cSndHavePhoto_u = 0; // uint8_t
			 $this->strSndMemo = ""; // std::string
			 $this->cSndMemo_u = 0; // uint8_t
			 $this->strSndAttach = ""; // std::string
			 $this->cSndAttach_u = 0; // uint8_t
			 $this->dwCreateTime = 0; // uint32_t
			 $this->cCreateTime_u = 0; // uint8_t
			 $this->dwLastUpdateTime = 0; // uint32_t
			 $this->cLastUpdateTime_u = 0; // uint8_t
			 $this->dwContractSaleModel = 0; // uint32_t
			 $this->cContractSaleModel_u = 0; // uint8_t
			 $this->strCarAttrInfo = ""; // std::string
			 $this->cCarAttrInfo_u = 0; // uint8_t
			 $this->dwSkuOwner = 0; // uint32_t
			 $this->cSkuOwner_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // ���л� �汾��    ����Ϊuint32_t
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwSkuId); // ���л�skuid   ����Ϊuint64_t
			$bs->pushUint8_t($this->cSkuId_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strProductId); // ���л���Ѹ��Ʒ���   ����Ϊstd::string
			$bs->pushUint8_t($this->cProductId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwManufacturerSysNo); // ���л�Ʒ�Ʊ��   ����Ϊuint64_t
			$bs->pushUint8_t($this->cManufacturerSysNo_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strProductMode); // ���л���Ʒ�ͺ�   ����Ϊstd::string
			$bs->pushUint8_t($this->cProductMode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwC1SysNo); // ���л�������   ����Ϊuint64_t
			$bs->pushUint8_t($this->cC1SysNo_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwC2SysNo); // ���л�������   ����Ϊuint64_t
			$bs->pushUint8_t($this->cC2SysNo_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwC3SysNo); // ���л�С����   ����Ϊuint64_t
			$bs->pushUint8_t($this->cC3SysNo_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwC4SysNo); // ���л�С������   ����Ϊuint64_t
			$bs->pushUint8_t($this->cC4SysNo_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwC5SysNo); // ���л�С������   ����Ϊuint64_t
			$bs->pushUint8_t($this->cC5SysNo_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwProductColor); // ���л���Ʒ��ɫ��ţ�ǰ��������������չʾ   ����Ϊuint64_t
			$bs->pushUint8_t($this->cProductColor_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwProductSize); // ���л���Ʒ���ǰ��������������չʾ   ����Ϊuint64_t
			$bs->pushUint8_t($this->cProductSize_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwMasterProductSysNo); // ���л���Ӧ����Ʒ����ѸID   ����Ϊuint64_t
			$bs->pushUint8_t($this->cMasterProductSysNo_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwShowPicCount); // ���л���С����Ʒ��ʵ��ͼƬʱ������ʾǰ�沿��ͼƬ   ����Ϊuint32_t
			$bs->pushUint8_t($this->cShowPicCount_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strAttrs); // ���л�  ����Ϊstd::string
			$bs->pushUint8_t($this->cAttrs_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strSpecialAttrs); // ���л�'��Ѹ����Ʒ�������ԣ���ʽΪ 1:���ܼ���|2:�ӱ���Ʒ��Ŀǰ������ʾ���ܼ���/�ӱ���Ʒ��־  ����Ϊstd::string
			$bs->pushUint8_t($this->cSpecialAttrs_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwSndSource); // ���л�������Ʒ��Դ, 0:���ղ��/1:��װ����/2:����ά��/3:����ά��/4:��������/5:��������/6:�˿�����/7:���Ҽ���޹���   ����Ϊuint32_t
			$bs->pushUint8_t($this->cSndSource_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwSndWarrantyTime); // ���л����ֱ��޽�ֹʱ��  ����Ϊuint32_t
			$bs->pushUint8_t($this->cSndWarrantyTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwSndClass); // ���л�������ƷƷ��, 0:ȫ��/1:�ų���/2:�˳���/3:�߳���/4:�߳�����  ����Ϊuint32_t
			$bs->pushUint8_t($this->cSndClass_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwSndPerformance); // ���л�������Ʒ����, 0:δʹ�ù���ԭ��װ��⣬�������/1:��ʹ�ù����������/2:��ά�޹����������/3:���װ����δ���  ����Ϊuint32_t
			$bs->pushUint8_t($this->cSndPerformance_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwSndUsedDays); // ���л����ֹ˿�ʹ��ʱ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cSndUsedDays_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwSndHavePhoto); // ���л������Ƿ�ʵ������, 0:��/1:�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cSndHavePhoto_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strSndMemo); // ���л����ֱ�ע��Ϣ ����Ϊstd::string
			$bs->pushUint8_t($this->cSndMemo_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strSndAttach); // ���л����ְ�װ���� ����Ϊstd::string
			$bs->pushUint8_t($this->cSndAttach_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwCreateTime); // ���л�����ʱ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cCreateTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // ���л�������ʱ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwContractSaleModel); // ���л���Լ��ҵ������ ����Ϊuint32_t
			$bs->pushUint8_t($this->cContractSaleModel_u); // ���л���Լ��ҵ������ flag ����Ϊuint8_t
			$bs->pushString($this->strCarAttrInfo); // ���л���������չ������Ŀ��Ϣ ����Ϊstd::string
			$bs->pushUint8_t($this->cCarAttrInfo_u); // ���л���������չ������Ŀ��Ϣ flag ����Ϊuint8_t
			$bs->pushUint32_t($this->dwSkuOwner); // ���л����� ����Ϊuint32_t
			$bs->pushUint8_t($this->cSkuOwner_u); // ���л����� flag ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // �����л� �汾��    ����Ϊuint32_t
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // �����л�skuid   ����Ϊuint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strProductId = $bs->popString(); // �����л���Ѹ��Ʒ���   ����Ϊstd::string
			$this->cProductId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwManufacturerSysNo = $bs->popUint64_t(); // �����л�Ʒ�Ʊ��   ����Ϊuint64_t
			$this->cManufacturerSysNo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strProductMode = $bs->popString(); // �����л���Ʒ�ͺ�   ����Ϊstd::string
			$this->cProductMode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwC1SysNo = $bs->popUint64_t(); // �����л�������   ����Ϊuint64_t
			$this->cC1SysNo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwC2SysNo = $bs->popUint64_t(); // �����л�������   ����Ϊuint64_t
			$this->cC2SysNo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwC3SysNo = $bs->popUint64_t(); // �����л�С����   ����Ϊuint64_t
			$this->cC3SysNo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwC4SysNo = $bs->popUint64_t(); // �����л�С������   ����Ϊuint64_t
			$this->cC4SysNo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwC5SysNo = $bs->popUint64_t(); // �����л�С������   ����Ϊuint64_t
			$this->cC5SysNo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwProductColor = $bs->popUint64_t(); // �����л���Ʒ��ɫ��ţ�ǰ��������������չʾ   ����Ϊuint64_t
			$this->cProductColor_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwProductSize = $bs->popUint64_t(); // �����л���Ʒ���ǰ��������������չʾ   ����Ϊuint64_t
			$this->cProductSize_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwMasterProductSysNo = $bs->popUint64_t(); // �����л���Ӧ����Ʒ����ѸID   ����Ϊuint64_t
			$this->cMasterProductSysNo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwShowPicCount = $bs->popUint32_t(); // �����л���С����Ʒ��ʵ��ͼƬʱ������ʾǰ�沿��ͼƬ   ����Ϊuint32_t
			$this->cShowPicCount_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strAttrs = $bs->popString(); // �����л�  ����Ϊstd::string
			$this->cAttrs_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strSpecialAttrs = $bs->popString(); // �����л�'��Ѹ����Ʒ�������ԣ���ʽΪ 1:���ܼ���|2:�ӱ���Ʒ��Ŀǰ������ʾ���ܼ���/�ӱ���Ʒ��־  ����Ϊstd::string
			$this->cSpecialAttrs_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwSndSource = $bs->popUint32_t(); // �����л�������Ʒ��Դ, 0:���ղ��/1:��װ����/2:����ά��/3:����ά��/4:��������/5:��������/6:�˿�����/7:���Ҽ���޹���   ����Ϊuint32_t
			$this->cSndSource_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwSndWarrantyTime = $bs->popUint32_t(); // �����л����ֱ��޽�ֹʱ��  ����Ϊuint32_t
			$this->cSndWarrantyTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwSndClass = $bs->popUint32_t(); // �����л�������ƷƷ��, 0:ȫ��/1:�ų���/2:�˳���/3:�߳���/4:�߳�����  ����Ϊuint32_t
			$this->cSndClass_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwSndPerformance = $bs->popUint32_t(); // �����л�������Ʒ����, 0:δʹ�ù���ԭ��װ��⣬�������/1:��ʹ�ù����������/2:��ά�޹����������/3:���װ����δ���  ����Ϊuint32_t
			$this->cSndPerformance_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwSndUsedDays = $bs->popUint32_t(); // �����л����ֹ˿�ʹ��ʱ�� ����Ϊuint32_t
			$this->cSndUsedDays_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwSndHavePhoto = $bs->popUint32_t(); // �����л������Ƿ�ʵ������, 0:��/1:�� ����Ϊuint32_t
			$this->cSndHavePhoto_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strSndMemo = $bs->popString(); // �����л����ֱ�ע��Ϣ ����Ϊstd::string
			$this->cSndMemo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strSndAttach = $bs->popString(); // �����л����ְ�װ���� ����Ϊstd::string
			$this->cSndAttach_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwCreateTime = $bs->popUint32_t(); // �����л�����ʱ�� ����Ϊuint32_t
			$this->cCreateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // �����л�������ʱ�� ����Ϊuint32_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwContractSaleModel = $bs->popUint32_t(); // �����л���Լ��ҵ������ ����Ϊuint32_t
			$this->cContractSaleModel_u = $bs->popUint8_t(); // �����л���Լ��ҵ������ flag ����Ϊuint8_t
			$this->strCarAttrInfo = $bs->popString(); // �����л���������չ������Ŀ��Ϣ ����Ϊstd::string
			$this->cCarAttrInfo_u = $bs->popUint8_t(); // �����л���������չ������Ŀ��Ϣ flag ����Ϊuint8_t
			$this->dwSkuOwner = $bs->popUint32_t(); // �����л����� ����Ϊuint32_t
			$this->cSkuOwner_u = $bs->popUint8_t(); // �����л����� flag ����Ϊuint8_t

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


//source idl: com.b2b2c.icsonboss.ao.idl.BossSkuBasicPo.java

if (!class_exists('BossStockPo')) {
class BossStockPo
{
		/**
		 *  �汾��   
		 *
		 * �汾 >= 0
		 */
		var $cVersion; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * stockId,���id  
		 *
		 * �汾 >= 0
		 */
		var $ddwStockId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cStockId_u; //uint8_t

		/**
		 * sku id  
		 *
		 * �汾 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * �ֿ�Id  
		 *
		 * �汾 >= 0
		 */
		var $dwStoreHouseId; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cStoreHouseId_u; //uint8_t

		/**
		 * �ֿ�����
		 *
		 * �汾 >= 0
		 */
		var $strStoreHouseName; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cStoreHouseName_u; //uint8_t

		/**
		 * �������ID ����+�Ӻ�  
		 *
		 * �汾 >= 0
		 */
		var $ddwCooperatorId; //uint64_t

		/**
		 * �汾 >= 0
		 */
		var $cCooperatorId_u; //uint8_t

		/**
		 * ��Ӧ�̿�����,����  
		 *
		 * �汾 >= 0
		 */
		var $strCooperatorStockCode; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cCooperatorStockCode_u; //uint8_t

		/**
		 * ��Ӧ����Ʒ������  
		 *
		 * �汾 >= 0
		 */
		var $strCooperatorBarCode; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cCooperatorBarCode_u; //uint8_t

		/**
		 * ���۸񣬵�λ��  
		 *
		 * �汾 >= 0
		 */
		var $dwStockPrice; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cStockPrice_u; //uint8_t

		/**
		 * ����ϴμ۸�  
		 *
		 * �汾 >= 0
		 */
		var $dwStockPrePrice; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cStockPrePrice_u; //uint8_t

		/**
		 * ���ɱ��۸�  
		 *
		 * �汾 >= 0
		 */
		var $dwStockCostPrice; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cStockCostPrice_u; //uint8_t

		/**
		 * ����ʼ����  
		 *
		 * �汾 >= 0
		 */
		var $dwStockInitialNum; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cStockInitialNum_u; //uint8_t

		/**
		 * �����������  
		 *
		 * �汾 >= 0
		 */
		var $dwStockVirtualNum; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cStockVirtualNum_u; //uint8_t

		/**
		 * ���ʵ������  
		 *
		 * �汾 >= 0
		 */
		var $dwStockRealNum; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cStockRealNum_u; //uint8_t

		/**
		 * ���������  
		 *
		 * �汾 >= 0
		 */
		var $dwPromotionLockNum; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPromotionLockNum_u; //uint8_t

		/**
		 * ��ͨ������������  
		 *
		 * �汾 >= 0
		 */
		var $dwNormalSellingLock; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cNormalSellingLock_u; //uint8_t

		/**
		 * �������������  
		 *
		 * �汾 >= 0
		 */
		var $dwPromotionSellingLock; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cPromotionSellingLock_u; //uint8_t

		/**
		 * Ԥ�Ʒ�������-����ʱ�� �ֿ⵽������ʱ��   
		 *
		 * �汾 >= 0
		 */
		var $strEstimateDispatch; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cEstimateDispatch_u; //uint8_t

		/**
		 * ���״̬ link@  
		 *
		 * �汾 >= 0
		 */
		var $cStockState; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cStockState_u; //uint8_t

		/**
		 * ���˵���  
		 *
		 * �汾 >= 0
		 */
		var $setLimitArea; //std::set<uint32_t> 

		/**
		 * �汾 >= 0
		 */
		var $cLimitArea_u; //uint8_t

		/**
		 * ���ǵ���  
		 *
		 * �汾 >= 0
		 */
		var $setCoverArea; //std::set<uint32_t> 

		/**
		 * �汾 >= 0
		 */
		var $cCoverArea_u; //uint8_t

		/**
		 * ������˹���  
		 *
		 * �汾 >= 0
		 */
		var $strLimitrule; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cLimitrule_u; //uint8_t

		/**
		 * ��湺������,�µ�����  
		 *
		 * �汾 >= 0
		 */
		var $dwOrderNum; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cOrderNum_u; //uint8_t

		/**
		 * ������������������������������  
		 *
		 * �汾 >= 0
		 */
		var $dwSoldNum; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cSoldNum_u; //uint8_t

		/**
		 * ������ʱ��  
		 *
		 * �汾 >= 0
		 */
		var $dwAddTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cAddTime_u; //uint8_t

		/**
		 * �������޸�ʱ��  
		 *
		 * �汾 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t

		/**
		 * ��ɸ������������� 
		 *
		 * �汾 >= 0
		 */
		var $dwStockPayedNum; //uint32_t

		/**
		 * ��ɸ������������� flag
		 *
		 * �汾 >= 0
		 */
		var $cStockPayedNum_u; //uint8_t

		/**
		 * �����ֶ� 
		 *
		 * �汾 >= 0
		 */
		var $strReverse; //std::string

		/**
		 * �����ֶ� flag
		 *
		 * �汾 >= 0
		 */
		var $cReverse_u; //uint8_t

		/**
		 * ������������������ 
		 *
		 * �汾 >= 0
		 */
		var $dwStockProPayedNum; //uint32_t

		/**
		 * ������������������ flag
		 *
		 * �汾 >= 0
		 */
		var $cStockProPayedNum_u; //uint8_t

		/**
		 * ���������ʵͬ������ 
		 *
		 * �汾 >= 0
		 */
		var $dwStockRealSynNum; //uint32_t

		/**
		 * ���������ʵͬ������ flag
		 *
		 * �汾 >= 0
		 */
		var $cStockRealSynNum_u; //uint8_t

		/**
		 * �������� 
		 *
		 * �汾 >= 0
		 */
		var $strStockPromotionDesc; //std::string

		/**
		 * �������� flag
		 *
		 * �汾 >= 0
		 */
		var $cStockPromotionDesc_u; //uint8_t

		/**
		 * �������  
		 *
		 * �汾 >= 0
		 */
		var $bitsetBitProperty; //std::bitset<32> 

		/**
		 * ������� flag
		 *
		 * �汾 >= 0
		 */
		var $cBitProperty_u; //uint8_t

		/**
		 * stock���� include bitλ ����bitλ 
		 *
		 * �汾 >= 0
		 */
		var $bitsetStockBitInclude; //std::bitset<32> 

		/**
		 * stock���� include bitλ ����bitλ flag
		 *
		 * �汾 >= 0
		 */
		var $cStockBitInclude_u; //uint8_t

		/**
		 * stock���� include bitλ ȡ��bitλ
		 *
		 * �汾 >= 0
		 */
		var $bitsetStockBitExclude; //std::bitset<32> 

		/**
		 * stock���� include bitλ ȡ��bitλ flag
		 *
		 * �汾 >= 0
		 */
		var $cStockBitExclude_u; //uint8_t

		/**
		 * ������ ��С�������� 
		 *
		 * �汾 >= 0
		 */
		var $dwStockMinBuyNum; //uint32_t

		/**
		 * ������ ��С�������� flag
		 *
		 * �汾 >= 0
		 */
		var $cStockMinBuyNum_u; //uint8_t

		/**
		 * �޹����� ��������� �൱��sku�ֶ��е��޹������ֶ�
		 *
		 * �汾 >= 0
		 */
		var $dwStockMaxBuyNum; //uint32_t

		/**
		 * �޹����� ��������� flag
		 *
		 * �汾 >= 0
		 */
		var $cStockMaxBuyNum_u; //uint8_t

		/**
		 * ��Լ��ҵ������
		 *
		 * �汾 >= 0
		 */
		var $dwStockSellMode; //uint32_t

		/**
		 * ��Լ��ҵ������ flag
		 *
		 * �汾 >= 0
		 */
		var $cStockSellMode_u; //uint8_t

		/**
		 * ҵ��ɱ�
		 *
		 * �汾 >= 0
		 */
		var $dwStockBusinessCost; //uint32_t

		/**
		 * ҵ��ɱ� flag
		 *
		 * �汾 >= 0
		 */
		var $cStockBusinessCost_u; //uint8_t

		/**
		 * ��Ѹ���˹�����룬��������Ѹ��������
		 *
		 * �汾 >= 0
		 */
		var $dwStockLimitCode; //uint32_t

		/**
		 * ��Ѹ���˹�����룬��������Ѹ�������� flag
		 *
		 * �汾 >= 0
		 */
		var $cStockLimitCode_u; //uint8_t

		/**
		 * �������� 0:��ͨ/1:��Ʒ/2:����/3:����/4:��ʱ/5:����/6:����/7:�׷�
		 *
		 * �汾 >= 0
		 */
		var $dwPromotionType; //uint32_t

		/**
		 * �������� 0:��ͨ/1:��Ʒ/2:����/3:����/4:��ʱ/5:����/6:����/7:�׷� flag
		 *
		 * �汾 >= 0
		 */
		var $cPromotionType_u; //uint8_t


		 function __construct() {
			 $this->cVersion = 0; // uint8_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->ddwStockId = 0; // uint64_t
			 $this->cStockId_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->dwStoreHouseId = 0; // uint32_t
			 $this->cStoreHouseId_u = 0; // uint8_t
			 $this->strStoreHouseName = ""; // std::string
			 $this->cStoreHouseName_u = 0; // uint8_t
			 $this->ddwCooperatorId = 0; // uint64_t
			 $this->cCooperatorId_u = 0; // uint8_t
			 $this->strCooperatorStockCode = ""; // std::string
			 $this->cCooperatorStockCode_u = 0; // uint8_t
			 $this->strCooperatorBarCode = ""; // std::string
			 $this->cCooperatorBarCode_u = 0; // uint8_t
			 $this->dwStockPrice = 0; // uint32_t
			 $this->cStockPrice_u = 0; // uint8_t
			 $this->dwStockPrePrice = 0; // uint32_t
			 $this->cStockPrePrice_u = 0; // uint8_t
			 $this->dwStockCostPrice = 0; // uint32_t
			 $this->cStockCostPrice_u = 0; // uint8_t
			 $this->dwStockInitialNum = 0; // uint32_t
			 $this->cStockInitialNum_u = 0; // uint8_t
			 $this->dwStockVirtualNum = 0; // uint32_t
			 $this->cStockVirtualNum_u = 0; // uint8_t
			 $this->dwStockRealNum = 0; // uint32_t
			 $this->cStockRealNum_u = 0; // uint8_t
			 $this->dwPromotionLockNum = 0; // uint32_t
			 $this->cPromotionLockNum_u = 0; // uint8_t
			 $this->dwNormalSellingLock = 0; // uint32_t
			 $this->cNormalSellingLock_u = 0; // uint8_t
			 $this->dwPromotionSellingLock = 0; // uint32_t
			 $this->cPromotionSellingLock_u = 0; // uint8_t
			 $this->strEstimateDispatch = ""; // std::string
			 $this->cEstimateDispatch_u = 0; // uint8_t
			 $this->cStockState = 0; // uint8_t
			 $this->cStockState_u = 0; // uint8_t
			 $this->setLimitArea = new stl_set('uint32_t'); // std::set<uint32_t> 
			 $this->cLimitArea_u = 0; // uint8_t
			 $this->setCoverArea = new stl_set('uint32_t'); // std::set<uint32_t> 
			 $this->cCoverArea_u = 0; // uint8_t
			 $this->strLimitrule = ""; // std::string
			 $this->cLimitrule_u = 0; // uint8_t
			 $this->dwOrderNum = 0; // uint32_t
			 $this->cOrderNum_u = 0; // uint8_t
			 $this->dwSoldNum = 0; // uint32_t
			 $this->cSoldNum_u = 0; // uint8_t
			 $this->dwAddTime = 0; // uint32_t
			 $this->cAddTime_u = 0; // uint8_t
			 $this->dwLastUpdateTime = 0; // uint32_t
			 $this->cLastUpdateTime_u = 0; // uint8_t
			 $this->dwStockPayedNum = 0; // uint32_t
			 $this->cStockPayedNum_u = 0; // uint8_t
			 $this->strReverse = ""; // std::string
			 $this->cReverse_u = 0; // uint8_t
			 $this->dwStockProPayedNum = 0; // uint32_t
			 $this->cStockProPayedNum_u = 0; // uint8_t
			 $this->dwStockRealSynNum = 0; // uint32_t
			 $this->cStockRealSynNum_u = 0; // uint8_t
			 $this->strStockPromotionDesc = ""; // std::string
			 $this->cStockPromotionDesc_u = 0; // uint8_t
			 $this->bitsetBitProperty = new stl_bitset('32'); // std::bitset<32> 
			 $this->cBitProperty_u = 0; // uint8_t
			 $this->bitsetStockBitInclude = new stl_bitset('32'); // std::bitset<32> 
			 $this->cStockBitInclude_u = 0; // uint8_t
			 $this->bitsetStockBitExclude = new stl_bitset('32'); // std::bitset<32> 
			 $this->cStockBitExclude_u = 0; // uint8_t
			 $this->dwStockMinBuyNum = 0; // uint32_t
			 $this->cStockMinBuyNum_u = 0; // uint8_t
			 $this->dwStockMaxBuyNum = 0; // uint32_t
			 $this->cStockMaxBuyNum_u = 0; // uint8_t
			 $this->dwStockSellMode = 0; // uint32_t
			 $this->cStockSellMode_u = 0; // uint8_t
			 $this->dwStockBusinessCost = 0; // uint32_t
			 $this->cStockBusinessCost_u = 0; // uint8_t
			 $this->dwStockLimitCode = 0; // uint32_t
			 $this->cStockLimitCode_u = 0; // uint8_t
			 $this->dwPromotionType = 0; // uint32_t
			 $this->cPromotionType_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint8_t($this->cVersion); // ���л� �汾��    ����Ϊuint8_t
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwStockId); // ���л�stockId,���id   ����Ϊuint64_t
			$bs->pushUint8_t($this->cStockId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwSkuId); // ���л�sku id   ����Ϊuint64_t
			$bs->pushUint8_t($this->cSkuId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwStoreHouseId); // ���л��ֿ�Id   ����Ϊuint32_t
			$bs->pushUint8_t($this->cStoreHouseId_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strStoreHouseName); // ���л��ֿ����� ����Ϊstd::string
			$bs->pushUint8_t($this->cStoreHouseName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint64_t($this->ddwCooperatorId); // ���л��������ID ����+�Ӻ�   ����Ϊuint64_t
			$bs->pushUint8_t($this->cCooperatorId_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strCooperatorStockCode); // ���л���Ӧ�̿�����,����   ����Ϊstd::string
			$bs->pushUint8_t($this->cCooperatorStockCode_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strCooperatorBarCode); // ���л���Ӧ����Ʒ������   ����Ϊstd::string
			$bs->pushUint8_t($this->cCooperatorBarCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwStockPrice); // ���л����۸񣬵�λ��   ����Ϊuint32_t
			$bs->pushUint8_t($this->cStockPrice_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwStockPrePrice); // ���л�����ϴμ۸�   ����Ϊuint32_t
			$bs->pushUint8_t($this->cStockPrePrice_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwStockCostPrice); // ���л����ɱ��۸�   ����Ϊuint32_t
			$bs->pushUint8_t($this->cStockCostPrice_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwStockInitialNum); // ���л�����ʼ����   ����Ϊuint32_t
			$bs->pushUint8_t($this->cStockInitialNum_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwStockVirtualNum); // ���л������������   ����Ϊuint32_t
			$bs->pushUint8_t($this->cStockVirtualNum_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwStockRealNum); // ���л����ʵ������   ����Ϊuint32_t
			$bs->pushUint8_t($this->cStockRealNum_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPromotionLockNum); // ���л����������   ����Ϊuint32_t
			$bs->pushUint8_t($this->cPromotionLockNum_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwNormalSellingLock); // ���л���ͨ������������   ����Ϊuint32_t
			$bs->pushUint8_t($this->cNormalSellingLock_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPromotionSellingLock); // ���л��������������   ����Ϊuint32_t
			$bs->pushUint8_t($this->cPromotionSellingLock_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strEstimateDispatch); // ���л�Ԥ�Ʒ�������-����ʱ�� �ֿ⵽������ʱ��    ����Ϊstd::string
			$bs->pushUint8_t($this->cEstimateDispatch_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cStockState); // ���л����״̬ link@   ����Ϊuint8_t
			$bs->pushUint8_t($this->cStockState_u); // ���л� ����Ϊuint8_t
			$bs->pushObject($this->setLimitArea,'stl_set'); // ���л����˵���   ����Ϊstd::set<uint32_t> 
			$bs->pushUint8_t($this->cLimitArea_u); // ���л� ����Ϊuint8_t
			$bs->pushObject($this->setCoverArea,'stl_set'); // ���л����ǵ���   ����Ϊstd::set<uint32_t> 
			$bs->pushUint8_t($this->cCoverArea_u); // ���л� ����Ϊuint8_t
			$bs->pushString($this->strLimitrule); // ���л�������˹���   ����Ϊstd::string
			$bs->pushUint8_t($this->cLimitrule_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwOrderNum); // ���л���湺������,�µ�����   ����Ϊuint32_t
			$bs->pushUint8_t($this->cOrderNum_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwSoldNum); // ���л�������������������������������   ����Ϊuint32_t
			$bs->pushUint8_t($this->cSoldNum_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwAddTime); // ���л�������ʱ��   ����Ϊuint32_t
			$bs->pushUint8_t($this->cAddTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // ���л��������޸�ʱ��   ����Ϊuint32_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwStockPayedNum); // ���л���ɸ�������������  ����Ϊuint32_t
			$bs->pushUint8_t($this->cStockPayedNum_u); // ���л���ɸ������������� flag ����Ϊuint8_t
			$bs->pushString($this->strReverse); // ���л������ֶ�  ����Ϊstd::string
			$bs->pushUint8_t($this->cReverse_u); // ���л������ֶ� flag ����Ϊuint8_t
			$bs->pushUint32_t($this->dwStockProPayedNum); // ���л�������������������  ����Ϊuint32_t
			$bs->pushUint8_t($this->cStockProPayedNum_u); // ���л������������������� flag ����Ϊuint8_t
			$bs->pushUint32_t($this->dwStockRealSynNum); // ���л����������ʵͬ������  ����Ϊuint32_t
			$bs->pushUint8_t($this->cStockRealSynNum_u); // ���л����������ʵͬ������ flag ����Ϊuint8_t
			$bs->pushString($this->strStockPromotionDesc); // ���л���������  ����Ϊstd::string
			$bs->pushUint8_t($this->cStockPromotionDesc_u); // ���л��������� flag ����Ϊuint8_t
			$bs->pushObject($this->bitsetBitProperty,'stl_bitset'); // ���л��������   ����Ϊstd::bitset<32> 
			$bs->pushUint8_t($this->cBitProperty_u); // ���л�������� flag ����Ϊuint8_t
			$bs->pushObject($this->bitsetStockBitInclude,'stl_bitset'); // ���л�stock���� include bitλ ����bitλ  ����Ϊstd::bitset<32> 
			$bs->pushUint8_t($this->cStockBitInclude_u); // ���л�stock���� include bitλ ����bitλ flag ����Ϊuint8_t
			$bs->pushObject($this->bitsetStockBitExclude,'stl_bitset'); // ���л�stock���� include bitλ ȡ��bitλ ����Ϊstd::bitset<32> 
			$bs->pushUint8_t($this->cStockBitExclude_u); // ���л�stock���� include bitλ ȡ��bitλ flag ����Ϊuint8_t
			$bs->pushUint32_t($this->dwStockMinBuyNum); // ���л������� ��С��������  ����Ϊuint32_t
			$bs->pushUint8_t($this->cStockMinBuyNum_u); // ���л������� ��С�������� flag ����Ϊuint8_t
			$bs->pushUint32_t($this->dwStockMaxBuyNum); // ���л��޹����� ��������� �൱��sku�ֶ��е��޹������ֶ� ����Ϊuint32_t
			$bs->pushUint8_t($this->cStockMaxBuyNum_u); // ���л��޹����� ��������� flag ����Ϊuint8_t
			$bs->pushUint32_t($this->dwStockSellMode); // ���л���Լ��ҵ������ ����Ϊuint32_t
			$bs->pushUint8_t($this->cStockSellMode_u); // ���л���Լ��ҵ������ flag ����Ϊuint8_t
			$bs->pushUint32_t($this->dwStockBusinessCost); // ���л�ҵ��ɱ� ����Ϊuint32_t
			$bs->pushUint8_t($this->cStockBusinessCost_u); // ���л�ҵ��ɱ� flag ����Ϊuint8_t
			$bs->pushUint32_t($this->dwStockLimitCode); // ���л���Ѹ���˹�����룬��������Ѹ�������� ����Ϊuint32_t
			$bs->pushUint8_t($this->cStockLimitCode_u); // ���л���Ѹ���˹�����룬��������Ѹ�������� flag ����Ϊuint8_t
			$bs->pushUint32_t($this->dwPromotionType); // ���л��������� 0:��ͨ/1:��Ʒ/2:����/3:����/4:��ʱ/5:����/6:����/7:�׷� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPromotionType_u); // ���л��������� 0:��ͨ/1:��Ʒ/2:����/3:����/4:��ʱ/5:����/6:����/7:�׷� flag ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->cVersion = $bs->popUint8_t(); // �����л� �汾��    ����Ϊuint8_t
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwStockId = $bs->popUint64_t(); // �����л�stockId,���id   ����Ϊuint64_t
			$this->cStockId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // �����л�sku id   ����Ϊuint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwStoreHouseId = $bs->popUint32_t(); // �����л��ֿ�Id   ����Ϊuint32_t
			$this->cStoreHouseId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strStoreHouseName = $bs->popString(); // �����л��ֿ����� ����Ϊstd::string
			$this->cStoreHouseName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwCooperatorId = $bs->popUint64_t(); // �����л��������ID ����+�Ӻ�   ����Ϊuint64_t
			$this->cCooperatorId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strCooperatorStockCode = $bs->popString(); // �����л���Ӧ�̿�����,����   ����Ϊstd::string
			$this->cCooperatorStockCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strCooperatorBarCode = $bs->popString(); // �����л���Ӧ����Ʒ������   ����Ϊstd::string
			$this->cCooperatorBarCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwStockPrice = $bs->popUint32_t(); // �����л����۸񣬵�λ��   ����Ϊuint32_t
			$this->cStockPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwStockPrePrice = $bs->popUint32_t(); // �����л�����ϴμ۸�   ����Ϊuint32_t
			$this->cStockPrePrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwStockCostPrice = $bs->popUint32_t(); // �����л����ɱ��۸�   ����Ϊuint32_t
			$this->cStockCostPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwStockInitialNum = $bs->popUint32_t(); // �����л�����ʼ����   ����Ϊuint32_t
			$this->cStockInitialNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwStockVirtualNum = $bs->popUint32_t(); // �����л������������   ����Ϊuint32_t
			$this->cStockVirtualNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwStockRealNum = $bs->popUint32_t(); // �����л����ʵ������   ����Ϊuint32_t
			$this->cStockRealNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPromotionLockNum = $bs->popUint32_t(); // �����л����������   ����Ϊuint32_t
			$this->cPromotionLockNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwNormalSellingLock = $bs->popUint32_t(); // �����л���ͨ������������   ����Ϊuint32_t
			$this->cNormalSellingLock_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwPromotionSellingLock = $bs->popUint32_t(); // �����л��������������   ����Ϊuint32_t
			$this->cPromotionSellingLock_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strEstimateDispatch = $bs->popString(); // �����л�Ԥ�Ʒ�������-����ʱ�� �ֿ⵽������ʱ��    ����Ϊstd::string
			$this->cEstimateDispatch_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cStockState = $bs->popUint8_t(); // �����л����״̬ link@   ����Ϊuint8_t
			$this->cStockState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->setLimitArea = $bs->popObject('stl_set<uint32_t>'); // �����л����˵���   ����Ϊstd::set<uint32_t> 
			$this->cLimitArea_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->setCoverArea = $bs->popObject('stl_set<uint32_t>'); // �����л����ǵ���   ����Ϊstd::set<uint32_t> 
			$this->cCoverArea_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strLimitrule = $bs->popString(); // �����л�������˹���   ����Ϊstd::string
			$this->cLimitrule_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwOrderNum = $bs->popUint32_t(); // �����л���湺������,�µ�����   ����Ϊuint32_t
			$this->cOrderNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwSoldNum = $bs->popUint32_t(); // �����л�������������������������������   ����Ϊuint32_t
			$this->cSoldNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwAddTime = $bs->popUint32_t(); // �����л�������ʱ��   ����Ϊuint32_t
			$this->cAddTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // �����л��������޸�ʱ��   ����Ϊuint32_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwStockPayedNum = $bs->popUint32_t(); // �����л���ɸ�������������  ����Ϊuint32_t
			$this->cStockPayedNum_u = $bs->popUint8_t(); // �����л���ɸ������������� flag ����Ϊuint8_t
			$this->strReverse = $bs->popString(); // �����л������ֶ�  ����Ϊstd::string
			$this->cReverse_u = $bs->popUint8_t(); // �����л������ֶ� flag ����Ϊuint8_t
			$this->dwStockProPayedNum = $bs->popUint32_t(); // �����л�������������������  ����Ϊuint32_t
			$this->cStockProPayedNum_u = $bs->popUint8_t(); // �����л������������������� flag ����Ϊuint8_t
			$this->dwStockRealSynNum = $bs->popUint32_t(); // �����л����������ʵͬ������  ����Ϊuint32_t
			$this->cStockRealSynNum_u = $bs->popUint8_t(); // �����л����������ʵͬ������ flag ����Ϊuint8_t
			$this->strStockPromotionDesc = $bs->popString(); // �����л���������  ����Ϊstd::string
			$this->cStockPromotionDesc_u = $bs->popUint8_t(); // �����л��������� flag ����Ϊuint8_t
			$this->bitsetBitProperty = $bs->popObject('stl_bitset<32>'); // �����л��������   ����Ϊstd::bitset<32> 
			$this->cBitProperty_u = $bs->popUint8_t(); // �����л�������� flag ����Ϊuint8_t
			$this->bitsetStockBitInclude = $bs->popObject('stl_bitset<32>'); // �����л�stock���� include bitλ ����bitλ  ����Ϊstd::bitset<32> 
			$this->cStockBitInclude_u = $bs->popUint8_t(); // �����л�stock���� include bitλ ����bitλ flag ����Ϊuint8_t
			$this->bitsetStockBitExclude = $bs->popObject('stl_bitset<32>'); // �����л�stock���� include bitλ ȡ��bitλ ����Ϊstd::bitset<32> 
			$this->cStockBitExclude_u = $bs->popUint8_t(); // �����л�stock���� include bitλ ȡ��bitλ flag ����Ϊuint8_t
			$this->dwStockMinBuyNum = $bs->popUint32_t(); // �����л������� ��С��������  ����Ϊuint32_t
			$this->cStockMinBuyNum_u = $bs->popUint8_t(); // �����л������� ��С�������� flag ����Ϊuint8_t
			$this->dwStockMaxBuyNum = $bs->popUint32_t(); // �����л��޹����� ��������� �൱��sku�ֶ��е��޹������ֶ� ����Ϊuint32_t
			$this->cStockMaxBuyNum_u = $bs->popUint8_t(); // �����л��޹����� ��������� flag ����Ϊuint8_t
			$this->dwStockSellMode = $bs->popUint32_t(); // �����л���Լ��ҵ������ ����Ϊuint32_t
			$this->cStockSellMode_u = $bs->popUint8_t(); // �����л���Լ��ҵ������ flag ����Ϊuint8_t
			$this->dwStockBusinessCost = $bs->popUint32_t(); // �����л�ҵ��ɱ� ����Ϊuint32_t
			$this->cStockBusinessCost_u = $bs->popUint8_t(); // �����л�ҵ��ɱ� flag ����Ϊuint8_t
			$this->dwStockLimitCode = $bs->popUint32_t(); // �����л���Ѹ���˹�����룬��������Ѹ�������� ����Ϊuint32_t
			$this->cStockLimitCode_u = $bs->popUint8_t(); // �����л���Ѹ���˹�����룬��������Ѹ�������� flag ����Ϊuint8_t
			$this->dwPromotionType = $bs->popUint32_t(); // �����л��������� 0:��ͨ/1:��Ʒ/2:����/3:����/4:��ʱ/5:����/6:����/7:�׷� ����Ϊuint32_t
			$this->cPromotionType_u = $bs->popUint8_t(); // �����л��������� 0:��ͨ/1:��Ʒ/2:����/3:����/4:��ʱ/5:����/6:����/7:�׷� flag ����Ϊuint8_t

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