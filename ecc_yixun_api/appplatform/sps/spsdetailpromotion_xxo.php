<?php
require_once "/data/release/PHPLIB/api/appplatform/sps/spsbaseinfo_xxo.php";

class SpsDetailItemBo
{
		/**
		 *  �汾�� 
		 *
		 */
		var $dwVersion; //uint32_t

		/**
		 */
		var $cVersion_u; //uint8_t

		/**
		 * ��Ʒid,���÷�����
		 *
		 */
		var $strItemId; //std::string

		/**
		 */
		var $cItemId_u; //uint8_t

		/**
		 * Ʒ��id,���÷����룬�о��������
		 *
		 */
		var $ddwBrand; //uint64_t

		/**
		 */
		var $cBrand_u; //uint8_t

		/**
		 * ��Ʒ��id,���÷�����
		 *
		 */
		var $dwItemWareHouseid; //uint32_t

		/**
		 */
		var $cItemWareHouseid_u; //uint8_t

		/**
		 * ��Ʒ��Ŀid Vector,�ܴ���ʹ��룬Ŀǰ��3��������С��
		 *
		 */
		var $vecItemCategoryIdList; //std::vector<uint64_t> 

		/**
		 */
		var $cItemCategoryIdList_u; //uint8_t

		/**
		 * ������Ϣ�б�
		 *
		 */
		var $vecSpsOpInfoListOut; //std::vector<icson::promotion::bo::CSpsOperationInfoItemBo> 

		/**
		 */
		var $cSpsOpInfoListOut_u; //uint8_t

		/**
		 * ��չ�ֶ�
		 *
		 */
		var $mapExt; //std::map<std::string,std::string> 

		/**
		 */
		var $cExt_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = new uint32_t(); // uint32_t
			 $this->cVersion_u = new uint8_t(); // uint8_t
			 $this->strItemId = ""; // std::string
			 $this->cItemId_u = new uint8_t(); // uint8_t
			 $this->ddwBrand = new uint64_t(); // uint64_t
			 $this->cBrand_u = new uint8_t(); // uint8_t
			 $this->dwItemWareHouseid = new uint32_t(); // uint32_t
			 $this->cItemWareHouseid_u = new uint8_t(); // uint8_t
			 $this->vecItemCategoryIdList = new stl_vector('uint64_t'); // std::vector<uint64_t> 
			 $this->cItemCategoryIdList_u = new uint8_t(); // uint8_t
			 $this->vecSpsOpInfoListOut = new stl_vector('SpsOperationInfoItemBo'); // std::vector<icson::promotion::bo::CSpsOperationInfoItemBo> 
			 $this->cSpsOpInfoListOut_u = new uint8_t(); // uint8_t
			 $this->mapExt = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
			 $this->cExt_u = new uint8_t(); // uint8_t
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
			$bs->pushUint64_t($this->ddwBrand); // ���л�Ʒ��id,���÷����룬�о�������� ����Ϊuint64_t
			$bs->pushUint8_t($this->cBrand_u); // ���л� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwItemWareHouseid); // ���л���Ʒ��id,���÷����� ����Ϊuint32_t
			$bs->pushUint8_t($this->cItemWareHouseid_u); // ���л� ����Ϊuint8_t
			$bs->pushObject($this->vecItemCategoryIdList, 'stl_vector'); // ���л���Ʒ��Ŀid Vector,�ܴ���ʹ��룬Ŀǰ��3��������С�� ����Ϊstd::vector<uint64_t> 
			$bs->pushUint8_t($this->cItemCategoryIdList_u); // ���л� ����Ϊuint8_t
			$bs->pushObject($this->vecSpsOpInfoListOut, 'stl_vector'); // ���л�������Ϣ�б� ����Ϊstd::vector<icson::promotion::bo::CSpsOperationInfoItemBo> 
			$bs->pushUint8_t($this->cSpsOpInfoListOut_u); // ���л� ����Ϊuint8_t
			$bs->pushObject($this->mapExt, 'stl_map'); // ���л���չ�ֶ� ����Ϊstd::map<std::string,std::string> 
			$bs->pushUint8_t($this->cExt_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // �����л� �汾��  ����Ϊuint32_t
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->strItemId = $bs->popString(); // �����л���Ʒid,���÷����� ����Ϊstd::string
			$this->cItemId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->ddwBrand = $bs->popUint64_t(); // �����л�Ʒ��id,���÷����룬�о�������� ����Ϊuint64_t
			$this->cBrand_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->dwItemWareHouseid = $bs->popUint32_t(); // �����л���Ʒ��id,���÷����� ����Ϊuint32_t
			$this->cItemWareHouseid_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->vecItemCategoryIdList = $bs->popObject('stl_vector<uint64_t> '); // �����л���Ʒ��Ŀid Vector,�ܴ���ʹ��룬Ŀǰ��3��������С�� ����Ϊstd::vector<uint64_t> 
			$this->cItemCategoryIdList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->vecSpsOpInfoListOut = $bs->popObject('stl_vector<SpsOperationInfoItemBo> '); // �����л�������Ϣ�б� ����Ϊstd::vector<icson::promotion::bo::CSpsOperationInfoItemBo> 
			$this->cSpsOpInfoListOut_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->mapExt = $bs->popObject('stl_map<stl_string,stl_string> '); // �����л���չ�ֶ� ����Ϊstd::map<std::string,std::string> 
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
?>
