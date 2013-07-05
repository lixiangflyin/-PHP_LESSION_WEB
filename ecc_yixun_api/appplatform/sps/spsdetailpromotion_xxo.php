<?php
require_once "/data/release/PHPLIB/api/appplatform/sps/spsbaseinfo_xxo.php";

class SpsDetailItemBo
{
		/**
		 *  版本号 
		 *
		 */
		var $dwVersion; //uint32_t

		/**
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 商品id,调用方输入
		 *
		 */
		var $strItemId; //std::string

		/**
		 */
		var $cItemId_u; //uint8_t

		/**
		 * 品牌id,调用方输入，有就填进来哈
		 *
		 */
		var $ddwBrand; //uint64_t

		/**
		 */
		var $cBrand_u; //uint8_t

		/**
		 * 商品仓id,调用方输入
		 *
		 */
		var $dwItemWareHouseid; //uint32_t

		/**
		 */
		var $cItemWareHouseid_u; //uint8_t

		/**
		 * 商品类目id Vector,能传入就传入，目前就3个，大中小类
		 *
		 */
		var $vecItemCategoryIdList; //std::vector<uint64_t> 

		/**
		 */
		var $cItemCategoryIdList_u; //uint8_t

		/**
		 * 规则信息列表
		 *
		 */
		var $vecSpsOpInfoListOut; //std::vector<icson::promotion::bo::CSpsOperationInfoItemBo> 

		/**
		 */
		var $cSpsOpInfoListOut_u; //uint8_t

		/**
		 * 扩展字段
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
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号  类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strItemId); // 序列化商品id,调用方输入 类型为std::string
			$bs->pushUint8_t($this->cItemId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwBrand); // 序列化品牌id,调用方输入，有就填进来哈 类型为uint64_t
			$bs->pushUint8_t($this->cBrand_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwItemWareHouseid); // 序列化商品仓id,调用方输入 类型为uint32_t
			$bs->pushUint8_t($this->cItemWareHouseid_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecItemCategoryIdList, 'stl_vector'); // 序列化商品类目id Vector,能传入就传入，目前就3个，大中小类 类型为std::vector<uint64_t> 
			$bs->pushUint8_t($this->cItemCategoryIdList_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecSpsOpInfoListOut, 'stl_vector'); // 序列化规则信息列表 类型为std::vector<icson::promotion::bo::CSpsOperationInfoItemBo> 
			$bs->pushUint8_t($this->cSpsOpInfoListOut_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->mapExt, 'stl_map'); // 序列化扩展字段 类型为std::map<std::string,std::string> 
			$bs->pushUint8_t($this->cExt_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号  类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strItemId = $bs->popString(); // 反序列化商品id,调用方输入 类型为std::string
			$this->cItemId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwBrand = $bs->popUint64_t(); // 反序列化品牌id,调用方输入，有就填进来哈 类型为uint64_t
			$this->cBrand_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwItemWareHouseid = $bs->popUint32_t(); // 反序列化商品仓id,调用方输入 类型为uint32_t
			$this->cItemWareHouseid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecItemCategoryIdList = $bs->popObject('stl_vector<uint64_t> '); // 反序列化商品类目id Vector,能传入就传入，目前就3个，大中小类 类型为std::vector<uint64_t> 
			$this->cItemCategoryIdList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecSpsOpInfoListOut = $bs->popObject('stl_vector<SpsOperationInfoItemBo> '); // 反序列化规则信息列表 类型为std::vector<icson::promotion::bo::CSpsOperationInfoItemBo> 
			$this->cSpsOpInfoListOut_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->mapExt = $bs->popObject('stl_map<stl_string,stl_string> '); // 反序列化扩展字段 类型为std::map<std::string,std::string> 
			$this->cExt_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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
?>
