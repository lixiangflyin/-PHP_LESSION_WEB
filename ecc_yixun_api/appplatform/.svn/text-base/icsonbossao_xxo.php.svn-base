<?php

//source idl: com.b2b2c.icsonboss.ao.idl.UpdateStockPriceWithAuthReq.java

if (!class_exists('BossStockPricePo')) {
class BossStockPricePo
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * skuid 必填
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 仓库id 目前对应逻辑仓Id 易迅分站id需要转换成逻辑仓id
		 *
		 * 版本 >= 0
		 */
		var $dwStoreHouseId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStoreHouseId_u; //uint8_t

		/**
		 * 库存价格，单位分 对应易迅价 非多价 
		 *
		 * 版本 >= 0
		 */
		var $dwStockPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockPrice_u; //uint8_t

		/**
		 * 库存成本价格，单位分
		 *
		 * 版本 >= 0
		 */
		var $dwStockCostPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockCostPrice_u; //uint8_t

		/**
		 * 业务成本，单位分
		 *
		 * 版本 >= 0
		 */
		var $dwStockBusinessCost; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockBusinessCost_u; //uint8_t

		/**
		 * 设置价格时 stockhash必填 算法参考 GetStockHash公共函数(数量和状态填0 其他必填) b2b2c/comm/b2b2c_define.h 
		 *
		 * 版本 >= 0
		 */
		var $strStockHash; //std::string

		/**
		 * 版本 >= 0
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
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化skuid 必填 类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStoreHouseId); // 序列化仓库id 目前对应逻辑仓Id 易迅分站id需要转换成逻辑仓id 类型为uint32_t
			$bs->pushUint8_t($this->cStoreHouseId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockPrice); // 序列化库存价格，单位分 对应易迅价 非多价  类型为uint32_t
			$bs->pushUint8_t($this->cStockPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockCostPrice); // 序列化库存成本价格，单位分 类型为uint32_t
			$bs->pushUint8_t($this->cStockCostPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockBusinessCost); // 序列化业务成本，单位分 类型为uint32_t
			$bs->pushUint8_t($this->cStockBusinessCost_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strStockHash); // 序列化设置价格时 stockhash必填 算法参考 GetStockHash公共函数(数量和状态填0 其他必填) b2b2c/comm/b2b2c_define.h  类型为std::string
			$bs->pushUint8_t($this->cStockHash_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化skuid 必填 类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStoreHouseId = $bs->popUint32_t(); // 反序列化仓库id 目前对应逻辑仓Id 易迅分站id需要转换成逻辑仓id 类型为uint32_t
			$this->cStoreHouseId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockPrice = $bs->popUint32_t(); // 反序列化库存价格，单位分 对应易迅价 非多价  类型为uint32_t
			$this->cStockPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockCostPrice = $bs->popUint32_t(); // 反序列化库存成本价格，单位分 类型为uint32_t
			$this->cStockCostPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockBusinessCost = $bs->popUint32_t(); // 反序列化业务成本，单位分 类型为uint32_t
			$this->cStockBusinessCost_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strStockHash = $bs->popString(); // 反序列化设置价格时 stockhash必填 算法参考 GetStockHash公共函数(数量和状态填0 其他必填) b2b2c/comm/b2b2c_define.h  类型为std::string
			$this->cStockHash_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.b2b2c.icsonboss.ao.idl.GetAllMultPriceSourceInfoResp.java

if (!class_exists('BossMultPriceSourcePo')) {
class BossMultPriceSourcePo
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 来源id
		 *
		 * 版本 >= 0
		 */
		var $ddwPriceSourceId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceSourceId_u; //uint8_t

		/**
		 * 来源名称
		 *
		 * 版本 >= 0
		 */
		var $strPriceSourceName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceSourceName_u; //uint8_t

		/**
		 * 来源描述
		 *
		 * 版本 >= 0
		 */
		var $strPriceSourceDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceSourceDesc_u; //uint8_t

		/**
		 * 来源状态
		 *
		 * 版本 >= 0
		 */
		var $wPriceSourceState; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceSourceState_u; //uint8_t

		/**
		 * 来源密钥
		 *
		 * 版本 >= 0
		 */
		var $strPriceSourceSecretKey; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceSourceSecretKey_u; //uint8_t

		/**
		 * 来源创建者id
		 *
		 * 版本 >= 0
		 */
		var $strPriceSourceCreaterId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceSourceCreaterId_u; //uint8_t

		/**
		 * 来源最后修改人
		 *
		 * 版本 >= 0
		 */
		var $strPriceSourceLastModifiyer; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceSourceLastModifiyer_u; //uint8_t

		/**
		 * 来源添加时间
		 *
		 * 版本 >= 0
		 */
		var $dwPriceSourceAddTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceSourceAddTime_u; //uint8_t

		/**
		 * 来源最后更新时间
		 *
		 * 版本 >= 0
		 */
		var $dwPriceSourceLastUpdateTime; //uint32_t

		/**
		 * 版本 >= 0
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
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwPriceSourceId); // 序列化来源id 类型为uint64_t
			$bs->pushUint8_t($this->cPriceSourceId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceSourceName); // 序列化来源名称 类型为std::string
			$bs->pushUint8_t($this->cPriceSourceName_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceSourceDesc); // 序列化来源描述 类型为std::string
			$bs->pushUint8_t($this->cPriceSourceDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wPriceSourceState); // 序列化来源状态 类型为uint16_t
			$bs->pushUint8_t($this->cPriceSourceState_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceSourceSecretKey); // 序列化来源密钥 类型为std::string
			$bs->pushUint8_t($this->cPriceSourceSecretKey_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceSourceCreaterId); // 序列化来源创建者id 类型为std::string
			$bs->pushUint8_t($this->cPriceSourceCreaterId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceSourceLastModifiyer); // 序列化来源最后修改人 类型为std::string
			$bs->pushUint8_t($this->cPriceSourceLastModifiyer_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceSourceAddTime); // 序列化来源添加时间 类型为uint32_t
			$bs->pushUint8_t($this->cPriceSourceAddTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceSourceLastUpdateTime); // 序列化来源最后更新时间 类型为uint32_t
			$bs->pushUint8_t($this->cPriceSourceLastUpdateTime_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwPriceSourceId = $bs->popUint64_t(); // 反序列化来源id 类型为uint64_t
			$this->cPriceSourceId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceSourceName = $bs->popString(); // 反序列化来源名称 类型为std::string
			$this->cPriceSourceName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceSourceDesc = $bs->popString(); // 反序列化来源描述 类型为std::string
			$this->cPriceSourceDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wPriceSourceState = $bs->popUint16_t(); // 反序列化来源状态 类型为uint16_t
			$this->cPriceSourceState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceSourceSecretKey = $bs->popString(); // 反序列化来源密钥 类型为std::string
			$this->cPriceSourceSecretKey_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceSourceCreaterId = $bs->popString(); // 反序列化来源创建者id 类型为std::string
			$this->cPriceSourceCreaterId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceSourceLastModifiyer = $bs->popString(); // 反序列化来源最后修改人 类型为std::string
			$this->cPriceSourceLastModifiyer_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceSourceAddTime = $bs->popUint32_t(); // 反序列化来源添加时间 类型为uint32_t
			$this->cPriceSourceAddTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceSourceLastUpdateTime = $bs->popUint32_t(); // 反序列化来源最后更新时间 类型为uint32_t
			$this->cPriceSourceLastUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.b2b2c.icsonboss.ao.idl.GetAllMultPriceSceneInfoResp.java

if (!class_exists('BossMultPriceScenePo')) {
class BossMultPriceScenePo
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 场景id
		 *
		 * 版本 >= 0
		 */
		var $ddwPriceSceneId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceSceneId_u; //uint8_t

		/**
		 * 场景名称
		 *
		 * 版本 >= 0
		 */
		var $strPriceSceneName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceSceneName_u; //uint8_t

		/**
		 * 场景描述
		 *
		 * 版本 >= 0
		 */
		var $strPriceSceneDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceSceneDesc_u; //uint8_t

		/**
		 * 场景状态
		 *
		 * 版本 >= 0
		 */
		var $wPriceSceneState; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceSceneState_u; //uint8_t

		/**
		 * 场景创建者id
		 *
		 * 版本 >= 0
		 */
		var $strPriceSceneCreaterId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceSceneCreaterId_u; //uint8_t

		/**
		 * 场景最后修改人
		 *
		 * 版本 >= 0
		 */
		var $strPriceSceneLastModifiyer; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceSceneLastModifiyer_u; //uint8_t

		/**
		 * 场景添加时间
		 *
		 * 版本 >= 0
		 */
		var $dwPriceSceneAddTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceSceneAddTime_u; //uint8_t

		/**
		 * 场景最后更新时间
		 *
		 * 版本 >= 0
		 */
		var $dwPriceSceneLastUpdateTime; //uint32_t

		/**
		 * 版本 >= 0
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
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwPriceSceneId); // 序列化场景id 类型为uint64_t
			$bs->pushUint8_t($this->cPriceSceneId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceSceneName); // 序列化场景名称 类型为std::string
			$bs->pushUint8_t($this->cPriceSceneName_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceSceneDesc); // 序列化场景描述 类型为std::string
			$bs->pushUint8_t($this->cPriceSceneDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wPriceSceneState); // 序列化场景状态 类型为uint16_t
			$bs->pushUint8_t($this->cPriceSceneState_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceSceneCreaterId); // 序列化场景创建者id 类型为std::string
			$bs->pushUint8_t($this->cPriceSceneCreaterId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceSceneLastModifiyer); // 序列化场景最后修改人 类型为std::string
			$bs->pushUint8_t($this->cPriceSceneLastModifiyer_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceSceneAddTime); // 序列化场景添加时间 类型为uint32_t
			$bs->pushUint8_t($this->cPriceSceneAddTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceSceneLastUpdateTime); // 序列化场景最后更新时间 类型为uint32_t
			$bs->pushUint8_t($this->cPriceSceneLastUpdateTime_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwPriceSceneId = $bs->popUint64_t(); // 反序列化场景id 类型为uint64_t
			$this->cPriceSceneId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceSceneName = $bs->popString(); // 反序列化场景名称 类型为std::string
			$this->cPriceSceneName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceSceneDesc = $bs->popString(); // 反序列化场景描述 类型为std::string
			$this->cPriceSceneDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wPriceSceneState = $bs->popUint16_t(); // 反序列化场景状态 类型为uint16_t
			$this->cPriceSceneState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceSceneCreaterId = $bs->popString(); // 反序列化场景创建者id 类型为std::string
			$this->cPriceSceneCreaterId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceSceneLastModifiyer = $bs->popString(); // 反序列化场景最后修改人 类型为std::string
			$this->cPriceSceneLastModifiyer_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceSceneAddTime = $bs->popUint32_t(); // 反序列化场景添加时间 类型为uint32_t
			$this->cPriceSceneAddTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceSceneLastUpdateTime = $bs->popUint32_t(); // 反序列化场景最后更新时间 类型为uint32_t
			$this->cPriceSceneLastUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.b2b2c.icsonboss.ao.idl.DelMultPriceRuleByQueryWithAuthResp.java

if (!class_exists('BossMultPriceRulesForSkuPo')) {
class BossMultPriceRulesForSkuPo
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * sku id  写接口必填
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 合作伙伴子帐号，可不填 
		 *
		 * 版本 >= 0
		 */
		var $ddwCooperatorSubAccountId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorSubAccountId_u; //uint8_t

		/**
		 * 多价规则Po
		 *
		 * 版本 >= 0
		 */
		var $vecBossMultPriceRulePo; //std::vector<b2b2c::icsonboss::po::CBossMultPriceRulePo> 

		/**
		 * 版本 >= 0
		 */
		var $cBossMultPriceRulePo_u; //uint8_t

		/**
		 * sku基本信息 仅供读接口使用，写接口忽略
		 *
		 * 版本 >= 0
		 */
		var $oBossSkuBaiscPo; //b2b2c::icsonboss::po::CBossSkuBasicPo

		/**
		 * 版本 >= 0
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
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化sku id  写接口必填 类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwCooperatorSubAccountId); // 序列化合作伙伴子帐号，可不填  类型为uint64_t
			$bs->pushUint8_t($this->cCooperatorSubAccountId_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecBossMultPriceRulePo,'stl_vector'); // 序列化多价规则Po 类型为std::vector<b2b2c::icsonboss::po::CBossMultPriceRulePo> 
			$bs->pushUint8_t($this->cBossMultPriceRulePo_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->oBossSkuBaiscPo,'BossSkuBasicPo'); // 序列化sku基本信息 仅供读接口使用，写接口忽略 类型为b2b2c::icsonboss::po::CBossSkuBasicPo
			$bs->pushUint8_t($this->cBossSkuBaiscPo_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化sku id  写接口必填 类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwCooperatorSubAccountId = $bs->popUint64_t(); // 反序列化合作伙伴子帐号，可不填  类型为uint64_t
			$this->cCooperatorSubAccountId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecBossMultPriceRulePo = $bs->popObject('stl_vector<BossMultPriceRulePo>'); // 反序列化多价规则Po 类型为std::vector<b2b2c::icsonboss::po::CBossMultPriceRulePo> 
			$this->cBossMultPriceRulePo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->oBossSkuBaiscPo = $bs->popObject('BossSkuBasicPo'); // 反序列化sku基本信息 仅供读接口使用，写接口忽略 类型为b2b2c::icsonboss::po::CBossSkuBasicPo
			$this->cBossSkuBaiscPo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.b2b2c.icsonboss.ao.idl.BossMultPriceRulesForSkuPo.java

if (!class_exists('BossMultPriceRulePo')) {
class BossMultPriceRulePo
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 地域 id，写入时必填，不关心地域的可以填100000，表示全国
		 *
		 * 版本 >= 0
		 */
		var $dwRegionId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cRegionId_u; //uint8_t

		/**
		 * 场景 id 必填
		 *
		 * 版本 >= 0
		 */
		var $ddwPriceSceneId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceSceneId_u; //uint8_t

		/**
		 * 来源 id 必填
		 *
		 * 版本 >= 0
		 */
		var $ddwPriceSourceId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceSourceId_u; //uint8_t

		/**
		 * 规则名称
		 *
		 * 版本 >= 0
		 */
		var $strPriceName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceName_u; //uint8_t

		/**
		 * 数量维度,可实现价格阶梯 格式待定
		 *
		 * 版本 >= 0
		 */
		var $strPriceNumber; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceNumber_u; //uint8_t

		/**
		 * 仅读接口,用多价属性
		 *
		 * 版本 >= 0
		 */
		var $bitsetPriceBitProperty; //std::bitset<32> 

		/**
		 * 版本 >= 0
		 */
		var $cPriceBitProperty_u; //uint8_t

		/**
		 * 仅写接口用,price 属性 include bit位,用于设置
		 *
		 * 版本 >= 0
		 */
		var $bitsetPriceBitInclude; //std::bitset<32> 

		/**
		 * 版本 >= 0
		 */
		var $cPriceBitInclude_u; //uint8_t

		/**
		 * 仅写接口用,price 属性 include bit位,用于取消
		 *
		 * 版本 >= 0
		 */
		var $bitsetPriceBitExclude; //std::bitset<32> 

		/**
		 * 版本 >= 0
		 */
		var $cPriceBitExclude_u; //uint8_t

		/**
		 * 多价状态 0-已审核 1-待审核 2-中止 3-删除
		 *
		 * 版本 >= 0
		 */
		var $wPriceState; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceState_u; //uint8_t

		/**
		 * 多价展示操作行为类型 0-原价不变 1-打折 2-扣减 3-覆盖(一口价)
		 *
		 * 版本 >= 0
		 */
		var $wPriceShowOperationType; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceShowOperationType_u; //uint8_t

		/**
		 * 多价展示操作数
		 *
		 * 版本 >= 0
		 */
		var $dwPriceShowOperationNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceShowOperationNum_u; //uint8_t

		/**
		 * 多价成本分摊比例
		 *
		 * 版本 >= 0
		 */
		var $strPriceCostRatio; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceCostRatio_u; //uint8_t

		/**
		 * 成本分摊人 待定义
		 *
		 * 版本 >= 0
		 */
		var $dwPriceCostResponse; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceCostResponse_u; //uint8_t

		/**
		 * timefield开关 如果没有设置且设置了bosstimedfieldPo 则自动设置为1
		 *
		 * 版本 >= 0
		 */
		var $wPriceTimeFieldFlag; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceTimeFieldFlag_u; //uint8_t

		/**
		 * 多价时间维度 
		 *
		 * 版本 >= 0
		 */
		var $vecBossTimePricePo; //std::vector<b2b2c::icsonboss::po::CBossTimedPricePo> 

		/**
		 * 版本 >= 0
		 */
		var $cBossTimePricePo_u; //uint8_t

		/**
		 * 多价规则描述，选填
		 *
		 * 版本 >= 0
		 */
		var $strPriceDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceDesc_u; //uint8_t

		/**
		 * 用户身份规则，选填
		 *
		 * 版本 >= 0
		 */
		var $strPriceUserIdentityRule; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceUserIdentityRule_u; //uint8_t

		/**
		 * 规则开始时间，必填
		 *
		 * 版本 >= 0
		 */
		var $dwPriceStartTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceStartTime_u; //uint8_t

		/**
		 * 规则结束时间，必填
		 *
		 * 版本 >= 0
		 */
		var $dwPriceEndTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceEndTime_u; //uint8_t

		/**
		 * 多价下单操作行为类型，必填 定义同priceShowOperationType
		 *
		 * 版本 >= 0
		 */
		var $wPriceDealOperationType; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceDealOperationType_u; //uint8_t

		/**
		 * 多价下单操作数，必填
		 *
		 * 版本 >= 0
		 */
		var $dwPriceDealOperationNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceDealOperationNum_u; //uint8_t

		/**
		 * 展示价与下单价不同原因，选填
		 *
		 * 版本 >= 0
		 */
		var $strPriceDiffReason; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceDiffReason_u; //uint8_t

		/**
		 * 下单价描述，选填
		 *
		 * 版本 >= 0
		 */
		var $strPriceDealDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceDealDesc_u; //uint8_t

		/**
		 * 活动规则描述
		 *
		 * 版本 >= 0
		 */
		var $strPricePromotionDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPricePromotionDesc_u; //uint8_t

		/**
		 * 基准价，必填 0-库存价即仓价 其他待定义
		 *
		 * 版本 >= 0
		 */
		var $dwPriceBase; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceBase_u; //uint8_t

		/**
		 * 是否限购，必填
		 *
		 * 版本 >= 0
		 */
		var $wPriceBuyLimitFlag; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceBuyLimitFlag_u; //uint8_t

		/**
		 * 限购规则，选填 待定义
		 *
		 * 版本 >= 0
		 */
		var $strPriceBuyLimitRule; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceBuyLimitRule_u; //uint8_t

		/**
		 * 验证类型，选填，default 0
		 *
		 * 版本 >= 0
		 */
		var $wPriceVerifyType; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceVerifyType_u; //uint8_t

		/**
		 * 规则生效次数
		 *
		 * 版本 >= 0
		 */
		var $dwPriceMaxUseNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceMaxUseNum_u; //uint8_t

		/**
		 * 节能补贴价 default为0
		 *
		 * 版本 >= 0
		 */
		var $dwPriceEnergySaving; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceEnergySaving_u; //uint8_t

		/**
		 * 预告时间时间
		 *
		 * 版本 >= 0
		 */
		var $dwPriceForeCastTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceForeCastTime_u; //uint8_t

		/**
		 * 适用仓库，格式待定义
		 *
		 * 版本 >= 0
		 */
		var $strPriceStoreHouse; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceStoreHouse_u; //uint8_t

		/**
		 * 活动关联id，格式待定义
		 *
		 * 版本 >= 0
		 */
		var $strPriceActiveId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceActiveId_u; //uint8_t

		/**
		 * 创建者id，必填
		 *
		 * 版本 >= 0
		 */
		var $strPriceCreaterId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceCreaterId_u; //uint8_t

		/**
		 * 最后修改人，不填
		 *
		 * 版本 >= 0
		 */
		var $strPriceLastModifiyer; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceLastModifiyer_u; //uint8_t

		/**
		 * 添加时间，不填
		 *
		 * 版本 >= 0
		 */
		var $dwPriceAddTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceAddTime_u; //uint8_t

		/**
		 * 最后更新时间，不填
		 *
		 * 版本 >= 0
		 */
		var $dwPriceLastUpdateTime; //uint32_t

		/**
		 * 版本 >= 0
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
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwRegionId); // 序列化地域 id，写入时必填，不关心地域的可以填100000，表示全国 类型为uint32_t
			$bs->pushUint8_t($this->cRegionId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwPriceSceneId); // 序列化场景 id 必填 类型为uint64_t
			$bs->pushUint8_t($this->cPriceSceneId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwPriceSourceId); // 序列化来源 id 必填 类型为uint64_t
			$bs->pushUint8_t($this->cPriceSourceId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceName); // 序列化规则名称 类型为std::string
			$bs->pushUint8_t($this->cPriceName_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceNumber); // 序列化数量维度,可实现价格阶梯 格式待定 类型为std::string
			$bs->pushUint8_t($this->cPriceNumber_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->bitsetPriceBitProperty,'stl_bitset'); // 序列化仅读接口,用多价属性 类型为std::bitset<32> 
			$bs->pushUint8_t($this->cPriceBitProperty_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->bitsetPriceBitInclude,'stl_bitset'); // 序列化仅写接口用,price 属性 include bit位,用于设置 类型为std::bitset<32> 
			$bs->pushUint8_t($this->cPriceBitInclude_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->bitsetPriceBitExclude,'stl_bitset'); // 序列化仅写接口用,price 属性 include bit位,用于取消 类型为std::bitset<32> 
			$bs->pushUint8_t($this->cPriceBitExclude_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wPriceState); // 序列化多价状态 0-已审核 1-待审核 2-中止 3-删除 类型为uint16_t
			$bs->pushUint8_t($this->cPriceState_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wPriceShowOperationType); // 序列化多价展示操作行为类型 0-原价不变 1-打折 2-扣减 3-覆盖(一口价) 类型为uint16_t
			$bs->pushUint8_t($this->cPriceShowOperationType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceShowOperationNum); // 序列化多价展示操作数 类型为uint32_t
			$bs->pushUint8_t($this->cPriceShowOperationNum_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceCostRatio); // 序列化多价成本分摊比例 类型为std::string
			$bs->pushUint8_t($this->cPriceCostRatio_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceCostResponse); // 序列化成本分摊人 待定义 类型为uint32_t
			$bs->pushUint8_t($this->cPriceCostResponse_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wPriceTimeFieldFlag); // 序列化timefield开关 如果没有设置且设置了bosstimedfieldPo 则自动设置为1 类型为uint16_t
			$bs->pushUint8_t($this->cPriceTimeFieldFlag_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecBossTimePricePo,'stl_vector'); // 序列化多价时间维度  类型为std::vector<b2b2c::icsonboss::po::CBossTimedPricePo> 
			$bs->pushUint8_t($this->cBossTimePricePo_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceDesc); // 序列化多价规则描述，选填 类型为std::string
			$bs->pushUint8_t($this->cPriceDesc_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceUserIdentityRule); // 序列化用户身份规则，选填 类型为std::string
			$bs->pushUint8_t($this->cPriceUserIdentityRule_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceStartTime); // 序列化规则开始时间，必填 类型为uint32_t
			$bs->pushUint8_t($this->cPriceStartTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceEndTime); // 序列化规则结束时间，必填 类型为uint32_t
			$bs->pushUint8_t($this->cPriceEndTime_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wPriceDealOperationType); // 序列化多价下单操作行为类型，必填 定义同priceShowOperationType 类型为uint16_t
			$bs->pushUint8_t($this->cPriceDealOperationType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceDealOperationNum); // 序列化多价下单操作数，必填 类型为uint32_t
			$bs->pushUint8_t($this->cPriceDealOperationNum_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceDiffReason); // 序列化展示价与下单价不同原因，选填 类型为std::string
			$bs->pushUint8_t($this->cPriceDiffReason_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceDealDesc); // 序列化下单价描述，选填 类型为std::string
			$bs->pushUint8_t($this->cPriceDealDesc_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPricePromotionDesc); // 序列化活动规则描述 类型为std::string
			$bs->pushUint8_t($this->cPricePromotionDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceBase); // 序列化基准价，必填 0-库存价即仓价 其他待定义 类型为uint32_t
			$bs->pushUint8_t($this->cPriceBase_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wPriceBuyLimitFlag); // 序列化是否限购，必填 类型为uint16_t
			$bs->pushUint8_t($this->cPriceBuyLimitFlag_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceBuyLimitRule); // 序列化限购规则，选填 待定义 类型为std::string
			$bs->pushUint8_t($this->cPriceBuyLimitRule_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wPriceVerifyType); // 序列化验证类型，选填，default 0 类型为uint16_t
			$bs->pushUint8_t($this->cPriceVerifyType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceMaxUseNum); // 序列化规则生效次数 类型为uint32_t
			$bs->pushUint8_t($this->cPriceMaxUseNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceEnergySaving); // 序列化节能补贴价 default为0 类型为uint32_t
			$bs->pushUint8_t($this->cPriceEnergySaving_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceForeCastTime); // 序列化预告时间时间 类型为uint32_t
			$bs->pushUint8_t($this->cPriceForeCastTime_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceStoreHouse); // 序列化适用仓库，格式待定义 类型为std::string
			$bs->pushUint8_t($this->cPriceStoreHouse_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceActiveId); // 序列化活动关联id，格式待定义 类型为std::string
			$bs->pushUint8_t($this->cPriceActiveId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceCreaterId); // 序列化创建者id，必填 类型为std::string
			$bs->pushUint8_t($this->cPriceCreaterId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceLastModifiyer); // 序列化最后修改人，不填 类型为std::string
			$bs->pushUint8_t($this->cPriceLastModifiyer_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceAddTime); // 序列化添加时间，不填 类型为uint32_t
			$bs->pushUint8_t($this->cPriceAddTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceLastUpdateTime); // 序列化最后更新时间，不填 类型为uint32_t
			$bs->pushUint8_t($this->cPriceLastUpdateTime_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRegionId = $bs->popUint32_t(); // 反序列化地域 id，写入时必填，不关心地域的可以填100000，表示全国 类型为uint32_t
			$this->cRegionId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwPriceSceneId = $bs->popUint64_t(); // 反序列化场景 id 必填 类型为uint64_t
			$this->cPriceSceneId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwPriceSourceId = $bs->popUint64_t(); // 反序列化来源 id 必填 类型为uint64_t
			$this->cPriceSourceId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceName = $bs->popString(); // 反序列化规则名称 类型为std::string
			$this->cPriceName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceNumber = $bs->popString(); // 反序列化数量维度,可实现价格阶梯 格式待定 类型为std::string
			$this->cPriceNumber_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->bitsetPriceBitProperty = $bs->popObject('stl_bitset<32>'); // 反序列化仅读接口,用多价属性 类型为std::bitset<32> 
			$this->cPriceBitProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->bitsetPriceBitInclude = $bs->popObject('stl_bitset<32>'); // 反序列化仅写接口用,price 属性 include bit位,用于设置 类型为std::bitset<32> 
			$this->cPriceBitInclude_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->bitsetPriceBitExclude = $bs->popObject('stl_bitset<32>'); // 反序列化仅写接口用,price 属性 include bit位,用于取消 类型为std::bitset<32> 
			$this->cPriceBitExclude_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wPriceState = $bs->popUint16_t(); // 反序列化多价状态 0-已审核 1-待审核 2-中止 3-删除 类型为uint16_t
			$this->cPriceState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wPriceShowOperationType = $bs->popUint16_t(); // 反序列化多价展示操作行为类型 0-原价不变 1-打折 2-扣减 3-覆盖(一口价) 类型为uint16_t
			$this->cPriceShowOperationType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceShowOperationNum = $bs->popUint32_t(); // 反序列化多价展示操作数 类型为uint32_t
			$this->cPriceShowOperationNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceCostRatio = $bs->popString(); // 反序列化多价成本分摊比例 类型为std::string
			$this->cPriceCostRatio_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceCostResponse = $bs->popUint32_t(); // 反序列化成本分摊人 待定义 类型为uint32_t
			$this->cPriceCostResponse_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wPriceTimeFieldFlag = $bs->popUint16_t(); // 反序列化timefield开关 如果没有设置且设置了bosstimedfieldPo 则自动设置为1 类型为uint16_t
			$this->cPriceTimeFieldFlag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecBossTimePricePo = $bs->popObject('stl_vector<BossTimedPricePo>'); // 反序列化多价时间维度  类型为std::vector<b2b2c::icsonboss::po::CBossTimedPricePo> 
			$this->cBossTimePricePo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceDesc = $bs->popString(); // 反序列化多价规则描述，选填 类型为std::string
			$this->cPriceDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceUserIdentityRule = $bs->popString(); // 反序列化用户身份规则，选填 类型为std::string
			$this->cPriceUserIdentityRule_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceStartTime = $bs->popUint32_t(); // 反序列化规则开始时间，必填 类型为uint32_t
			$this->cPriceStartTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceEndTime = $bs->popUint32_t(); // 反序列化规则结束时间，必填 类型为uint32_t
			$this->cPriceEndTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wPriceDealOperationType = $bs->popUint16_t(); // 反序列化多价下单操作行为类型，必填 定义同priceShowOperationType 类型为uint16_t
			$this->cPriceDealOperationType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceDealOperationNum = $bs->popUint32_t(); // 反序列化多价下单操作数，必填 类型为uint32_t
			$this->cPriceDealOperationNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceDiffReason = $bs->popString(); // 反序列化展示价与下单价不同原因，选填 类型为std::string
			$this->cPriceDiffReason_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceDealDesc = $bs->popString(); // 反序列化下单价描述，选填 类型为std::string
			$this->cPriceDealDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPricePromotionDesc = $bs->popString(); // 反序列化活动规则描述 类型为std::string
			$this->cPricePromotionDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceBase = $bs->popUint32_t(); // 反序列化基准价，必填 0-库存价即仓价 其他待定义 类型为uint32_t
			$this->cPriceBase_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wPriceBuyLimitFlag = $bs->popUint16_t(); // 反序列化是否限购，必填 类型为uint16_t
			$this->cPriceBuyLimitFlag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceBuyLimitRule = $bs->popString(); // 反序列化限购规则，选填 待定义 类型为std::string
			$this->cPriceBuyLimitRule_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wPriceVerifyType = $bs->popUint16_t(); // 反序列化验证类型，选填，default 0 类型为uint16_t
			$this->cPriceVerifyType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceMaxUseNum = $bs->popUint32_t(); // 反序列化规则生效次数 类型为uint32_t
			$this->cPriceMaxUseNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceEnergySaving = $bs->popUint32_t(); // 反序列化节能补贴价 default为0 类型为uint32_t
			$this->cPriceEnergySaving_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceForeCastTime = $bs->popUint32_t(); // 反序列化预告时间时间 类型为uint32_t
			$this->cPriceForeCastTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceStoreHouse = $bs->popString(); // 反序列化适用仓库，格式待定义 类型为std::string
			$this->cPriceStoreHouse_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceActiveId = $bs->popString(); // 反序列化活动关联id，格式待定义 类型为std::string
			$this->cPriceActiveId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceCreaterId = $bs->popString(); // 反序列化创建者id，必填 类型为std::string
			$this->cPriceCreaterId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceLastModifiyer = $bs->popString(); // 反序列化最后修改人，不填 类型为std::string
			$this->cPriceLastModifiyer_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceAddTime = $bs->popUint32_t(); // 反序列化添加时间，不填 类型为uint32_t
			$this->cPriceAddTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceLastUpdateTime = $bs->popUint32_t(); // 反序列化最后更新时间，不填 类型为uint32_t
			$this->cPriceLastUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.b2b2c.icsonboss.ao.idl.BossMultPriceRulePo.java

if (!class_exists('BossTimedPricePo')) {
class BossTimedPricePo
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 *  timedPrice index 合法值为1-10，最大支持10个timefield的设置 其中coss最多5个(1-5)，用户5个 10个不排序 TODO:
		 *
		 * 版本 >= 0
		 */
		var $wTimedPriceIndex; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceIndex_u; //uint8_t

		/**
		 * 多价状态 0-已审核 1-待审核 2-中止 3-删除
		 *
		 * 版本 >= 0
		 */
		var $wTimedPriceState; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceState_u; //uint8_t

		/**
		 *  规则名称 支持64个字符
		 *
		 * 版本 >= 0
		 */
		var $strTimedPriceName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceName_u; //uint8_t

		/**
		 *  timedPrice 次数,可不填，default为1次
		 *
		 * 版本 >= 0
		 */
		var $wTimedPriceCount; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceCount_u; //uint8_t

		/**
		 *  timedPrice 持续时间 单位s，必填 由结束时间-开始时间 
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPriceLastLong; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceLastLong_u; //uint8_t

		/**
		 *  timedPrice 开始时间 必填
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPriceStartTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceStartTime_u; //uint8_t

		/**
		 *  timedPrice 价格操作类型，打折(精确度为10000) 扣减 覆盖 原价不变等，必填
		 *
		 * 版本 >= 0
		 */
		var $wTimedPriceOperationType; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceOperationType_u; //uint8_t

		/**
		 *  timedPrice 操作数 如操作类型为打折 此对应具体多少折扣 为价格是 单位分 必填
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPriceOperationNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceOperationNum_u; //uint8_t

		/**
		 *  timedPrice 属性 仅用于读接口
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPriceProperty; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceProperty_u; //uint8_t

		/**
		 * 属性 include bit位 仅用于写接口 设置属性
		 *
		 * 版本 >= 0
		 */
		var $bitsetTimedPriceBitInclude; //std::bitset<32> 

		/**
		 * 属性 include bit位 flag
		 *
		 * 版本 >= 0
		 */
		var $cTimedPriceBitInclude_u; //uint8_t

		/**
		 * 属性 exclude bit位 仅用于写接口 取消属性
		 *
		 * 版本 >= 0
		 */
		var $bitsetTimePriceBitExclude; //std::bitset<32> 

		/**
		 * 属性 exclude bit位 flag
		 *
		 * 版本 >= 0
		 */
		var $cTimePriceBitExclude_u; //uint8_t

		/**
		 *  timedPrice 自定义促销规则，暂不填
		 *
		 * 版本 >= 0
		 */
		var $strTimedPriceCustomerPromotionRule; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceCustomerPromotionRule_u; //uint8_t

		/**
		 *  timedPrice 价格基准类型，必填
		 *
		 * 版本 >= 0
		 */
		var $wTimedPriceBasePriceType; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceBasePriceType_u; //uint8_t

		/**
		 *  促销语描述，最大支持120个字(字符) 选填
		 *
		 * 版本 >= 0
		 */
		var $strTimedPricePromotionDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cTimedPricePromotionDesc_u; //uint8_t

		/**
		 * 规则生效次数
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPriceMaxUseNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceMaxUseNum_u; //uint8_t

		/**
		 * 适用仓库，格式待定义
		 *
		 * 版本 >= 0
		 */
		var $strTimedPriceStoreHouse; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceStoreHouse_u; //uint8_t

		/**
		 * 活动关联id，格式待定义
		 *
		 * 版本 >= 0
		 */
		var $strTimedPriceActiveId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceActiveId_u; //uint8_t

		/**
		 * 成本分摊人 待定义
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPriceCostResponse; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceCostResponse_u; //uint8_t

		/**
		 * 预告时间时间
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPriceForeCastTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceForeCastTime_u; //uint8_t

		/**
		 * 限购规则
		 *
		 * 版本 >= 0
		 */
		var $strTimedPriceBuyLimitRule; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceBuyLimitRule_u; //uint8_t

		/**
		 * 创建者id，必填
		 *
		 * 版本 >= 0
		 */
		var $strTimedPriceCreaterId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceCreaterId_u; //uint8_t

		/**
		 * string为skuid+regionid+timedPriceIndex+timedPriceStartTime+timedPriceLastLong+timedPriceOperationType+timedPriceOperationNum 字段之间无分隔符
		 *
		 * 版本 >= 0
		 */
		var $strTimedPriceCheckHash; //std::string

		/**
		 *  flag
		 *
		 * 版本 >= 0
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
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wTimedPriceIndex); // 序列化 timedPrice index 合法值为1-10，最大支持10个timefield的设置 其中coss最多5个(1-5)，用户5个 10个不排序 TODO: 类型为uint16_t
			$bs->pushUint8_t($this->cTimedPriceIndex_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wTimedPriceState); // 序列化多价状态 0-已审核 1-待审核 2-中止 3-删除 类型为uint16_t
			$bs->pushUint8_t($this->cTimedPriceState_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strTimedPriceName); // 序列化 规则名称 支持64个字符 类型为std::string
			$bs->pushUint8_t($this->cTimedPriceName_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wTimedPriceCount); // 序列化 timedPrice 次数,可不填，default为1次 类型为uint16_t
			$bs->pushUint8_t($this->cTimedPriceCount_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPriceLastLong); // 序列化 timedPrice 持续时间 单位s，必填 由结束时间-开始时间  类型为uint32_t
			$bs->pushUint8_t($this->cTimedPriceLastLong_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPriceStartTime); // 序列化 timedPrice 开始时间 必填 类型为uint32_t
			$bs->pushUint8_t($this->cTimedPriceStartTime_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wTimedPriceOperationType); // 序列化 timedPrice 价格操作类型，打折(精确度为10000) 扣减 覆盖 原价不变等，必填 类型为uint16_t
			$bs->pushUint8_t($this->cTimedPriceOperationType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPriceOperationNum); // 序列化 timedPrice 操作数 如操作类型为打折 此对应具体多少折扣 为价格是 单位分 必填 类型为uint32_t
			$bs->pushUint8_t($this->cTimedPriceOperationNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPriceProperty); // 序列化 timedPrice 属性 仅用于读接口 类型为uint32_t
			$bs->pushUint8_t($this->cTimedPriceProperty_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->bitsetTimedPriceBitInclude,'stl_bitset'); // 序列化属性 include bit位 仅用于写接口 设置属性 类型为std::bitset<32> 
			$bs->pushUint8_t($this->cTimedPriceBitInclude_u); // 序列化属性 include bit位 flag 类型为uint8_t
			$bs->pushObject($this->bitsetTimePriceBitExclude,'stl_bitset'); // 序列化属性 exclude bit位 仅用于写接口 取消属性 类型为std::bitset<32> 
			$bs->pushUint8_t($this->cTimePriceBitExclude_u); // 序列化属性 exclude bit位 flag 类型为uint8_t
			$bs->pushString($this->strTimedPriceCustomerPromotionRule); // 序列化 timedPrice 自定义促销规则，暂不填 类型为std::string
			$bs->pushUint8_t($this->cTimedPriceCustomerPromotionRule_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wTimedPriceBasePriceType); // 序列化 timedPrice 价格基准类型，必填 类型为uint16_t
			$bs->pushUint8_t($this->cTimedPriceBasePriceType_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strTimedPricePromotionDesc); // 序列化 促销语描述，最大支持120个字(字符) 选填 类型为std::string
			$bs->pushUint8_t($this->cTimedPricePromotionDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPriceMaxUseNum); // 序列化规则生效次数 类型为uint32_t
			$bs->pushUint8_t($this->cTimedPriceMaxUseNum_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strTimedPriceStoreHouse); // 序列化适用仓库，格式待定义 类型为std::string
			$bs->pushUint8_t($this->cTimedPriceStoreHouse_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strTimedPriceActiveId); // 序列化活动关联id，格式待定义 类型为std::string
			$bs->pushUint8_t($this->cTimedPriceActiveId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPriceCostResponse); // 序列化成本分摊人 待定义 类型为uint32_t
			$bs->pushUint8_t($this->cTimedPriceCostResponse_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPriceForeCastTime); // 序列化预告时间时间 类型为uint32_t
			$bs->pushUint8_t($this->cTimedPriceForeCastTime_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strTimedPriceBuyLimitRule); // 序列化限购规则 类型为std::string
			$bs->pushUint8_t($this->cTimedPriceBuyLimitRule_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strTimedPriceCreaterId); // 序列化创建者id，必填 类型为std::string
			$bs->pushUint8_t($this->cTimedPriceCreaterId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strTimedPriceCheckHash); // 序列化string为skuid+regionid+timedPriceIndex+timedPriceStartTime+timedPriceLastLong+timedPriceOperationType+timedPriceOperationNum 字段之间无分隔符 类型为std::string
			$bs->pushUint8_t($this->cTimedPriceCheckHash_u); // 序列化 flag 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wTimedPriceIndex = $bs->popUint16_t(); // 反序列化 timedPrice index 合法值为1-10，最大支持10个timefield的设置 其中coss最多5个(1-5)，用户5个 10个不排序 TODO: 类型为uint16_t
			$this->cTimedPriceIndex_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wTimedPriceState = $bs->popUint16_t(); // 反序列化多价状态 0-已审核 1-待审核 2-中止 3-删除 类型为uint16_t
			$this->cTimedPriceState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strTimedPriceName = $bs->popString(); // 反序列化 规则名称 支持64个字符 类型为std::string
			$this->cTimedPriceName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wTimedPriceCount = $bs->popUint16_t(); // 反序列化 timedPrice 次数,可不填，default为1次 类型为uint16_t
			$this->cTimedPriceCount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPriceLastLong = $bs->popUint32_t(); // 反序列化 timedPrice 持续时间 单位s，必填 由结束时间-开始时间  类型为uint32_t
			$this->cTimedPriceLastLong_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPriceStartTime = $bs->popUint32_t(); // 反序列化 timedPrice 开始时间 必填 类型为uint32_t
			$this->cTimedPriceStartTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wTimedPriceOperationType = $bs->popUint16_t(); // 反序列化 timedPrice 价格操作类型，打折(精确度为10000) 扣减 覆盖 原价不变等，必填 类型为uint16_t
			$this->cTimedPriceOperationType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPriceOperationNum = $bs->popUint32_t(); // 反序列化 timedPrice 操作数 如操作类型为打折 此对应具体多少折扣 为价格是 单位分 必填 类型为uint32_t
			$this->cTimedPriceOperationNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPriceProperty = $bs->popUint32_t(); // 反序列化 timedPrice 属性 仅用于读接口 类型为uint32_t
			$this->cTimedPriceProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->bitsetTimedPriceBitInclude = $bs->popObject('stl_bitset<32>'); // 反序列化属性 include bit位 仅用于写接口 设置属性 类型为std::bitset<32> 
			$this->cTimedPriceBitInclude_u = $bs->popUint8_t(); // 反序列化属性 include bit位 flag 类型为uint8_t
			$this->bitsetTimePriceBitExclude = $bs->popObject('stl_bitset<32>'); // 反序列化属性 exclude bit位 仅用于写接口 取消属性 类型为std::bitset<32> 
			$this->cTimePriceBitExclude_u = $bs->popUint8_t(); // 反序列化属性 exclude bit位 flag 类型为uint8_t
			$this->strTimedPriceCustomerPromotionRule = $bs->popString(); // 反序列化 timedPrice 自定义促销规则，暂不填 类型为std::string
			$this->cTimedPriceCustomerPromotionRule_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wTimedPriceBasePriceType = $bs->popUint16_t(); // 反序列化 timedPrice 价格基准类型，必填 类型为uint16_t
			$this->cTimedPriceBasePriceType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strTimedPricePromotionDesc = $bs->popString(); // 反序列化 促销语描述，最大支持120个字(字符) 选填 类型为std::string
			$this->cTimedPricePromotionDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPriceMaxUseNum = $bs->popUint32_t(); // 反序列化规则生效次数 类型为uint32_t
			$this->cTimedPriceMaxUseNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strTimedPriceStoreHouse = $bs->popString(); // 反序列化适用仓库，格式待定义 类型为std::string
			$this->cTimedPriceStoreHouse_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strTimedPriceActiveId = $bs->popString(); // 反序列化活动关联id，格式待定义 类型为std::string
			$this->cTimedPriceActiveId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPriceCostResponse = $bs->popUint32_t(); // 反序列化成本分摊人 待定义 类型为uint32_t
			$this->cTimedPriceCostResponse_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPriceForeCastTime = $bs->popUint32_t(); // 反序列化预告时间时间 类型为uint32_t
			$this->cTimedPriceForeCastTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strTimedPriceBuyLimitRule = $bs->popString(); // 反序列化限购规则 类型为std::string
			$this->cTimedPriceBuyLimitRule_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strTimedPriceCreaterId = $bs->popString(); // 反序列化创建者id，必填 类型为std::string
			$this->cTimedPriceCreaterId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strTimedPriceCheckHash = $bs->popString(); // 反序列化string为skuid+regionid+timedPriceIndex+timedPriceStartTime+timedPriceLastLong+timedPriceOperationType+timedPriceOperationNum 字段之间无分隔符 类型为std::string
			$this->cTimedPriceCheckHash_u = $bs->popUint8_t(); // 反序列化 flag 类型为uint8_t

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


//source idl: com.b2b2c.icsonboss.ao.idl.DelMultPriceRuleByQueryWithAuthReq.java

if (!class_exists('AuthorizationField4Web')) {
class AuthorizationField4Web
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 操作类型,给出具体值 
		 *
		 * 版本 >= 0
		 */
		var $dwOperationType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cOperationType_u; //uint8_t

		/**
		 * 操作者类型 
		 *
		 * 版本 >= 0
		 */
		var $dwOperatorType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cOperatorType_u; //uint8_t

		/**
		 * 操作者Id 
		 *
		 * 版本 >= 0
		 */
		var $strOperatorId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cOperatorId_u; //uint8_t

		/**
		 * 操作者权限类型 
		 *
		 * 版本 >= 0
		 */
		var $dwOperatorAuthType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cOperatorAuthType_u; //uint8_t

		/**
		 * 操作者权限Id 
		 *
		 * 版本 >= 0
		 */
		var $ddwOperatorAuthId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cOperatorAuthId_u; //uint8_t

		/**
		 * 操作原因 
		 *
		 * 版本 >= 0
		 */
		var $strOperationReason; //std::string

		/**
		 * 版本 >= 0
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
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwOperationType); // 序列化操作类型,给出具体值  类型为uint32_t
			$bs->pushUint8_t($this->cOperationType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwOperatorType); // 序列化操作者类型  类型为uint32_t
			$bs->pushUint8_t($this->cOperatorType_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strOperatorId); // 序列化操作者Id  类型为std::string
			$bs->pushUint8_t($this->cOperatorId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwOperatorAuthType); // 序列化操作者权限类型  类型为uint32_t
			$bs->pushUint8_t($this->cOperatorAuthType_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwOperatorAuthId); // 序列化操作者权限Id  类型为uint64_t
			$bs->pushUint8_t($this->cOperatorAuthId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strOperationReason); // 序列化操作原因  类型为std::string
			$bs->pushUint8_t($this->cOperationReason_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwOperationType = $bs->popUint32_t(); // 反序列化操作类型,给出具体值  类型为uint32_t
			$this->cOperationType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwOperatorType = $bs->popUint32_t(); // 反序列化操作者类型  类型为uint32_t
			$this->cOperatorType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strOperatorId = $bs->popString(); // 反序列化操作者Id  类型为std::string
			$this->cOperatorId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwOperatorAuthType = $bs->popUint32_t(); // 反序列化操作者权限类型  类型为uint32_t
			$this->cOperatorAuthType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwOperatorAuthId = $bs->popUint64_t(); // 反序列化操作者权限Id  类型为uint64_t
			$this->cOperatorAuthId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strOperationReason = $bs->popString(); // 反序列化操作原因  类型为std::string
			$this->cOperationReason_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.b2b2c.icsonboss.ao.idl.DelMultPriceRuleByQueryWithAuthReq.java

if (!class_exists('MultPriceQueryPo')) {
class MultPriceQueryPo
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * sku id 必填
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 地域 id，选填
		 *
		 * 版本 >= 0
		 */
		var $dwRegionId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cRegionId_u; //uint8_t

		/**
		 * 场景 id，选填
		 *
		 * 版本 >= 0
		 */
		var $ddwPriceSceneId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceSceneId_u; //uint8_t

		/**
		 * 来源 id，选填
		 *
		 * 版本 >= 0
		 */
		var $ddwPriceSourceId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceSourceId_u; //uint8_t

		/**
		 * 创建者id，选填
		 *
		 * 版本 >= 0
		 */
		var $strPriceCreaterId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceCreaterId_u; //uint8_t

		/**
		 * 需要进行的删除操作的字段(物理删除) 用bitset表示 前提是skuid/region/sourceid/sceneid都填了
		 *
		 * 版本 >= 0
		 */
		var $bitsetBitDelOperation; //std::bitset<32> 

		/**
		 * 版本 >= 0
		 */
		var $cBitDelOperation_u; //uint8_t

		/**
		 * 时间维度index 需要删除时间维度时有效
		 *
		 * 版本 >= 0
		 */
		var $setTimedPriceIndex; //std::set<uint32_t> 

		/**
		 * 版本 >= 0
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
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化sku id 必填 类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwRegionId); // 序列化地域 id，选填 类型为uint32_t
			$bs->pushUint8_t($this->cRegionId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwPriceSceneId); // 序列化场景 id，选填 类型为uint64_t
			$bs->pushUint8_t($this->cPriceSceneId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwPriceSourceId); // 序列化来源 id，选填 类型为uint64_t
			$bs->pushUint8_t($this->cPriceSourceId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceCreaterId); // 序列化创建者id，选填 类型为std::string
			$bs->pushUint8_t($this->cPriceCreaterId_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->bitsetBitDelOperation,'stl_bitset'); // 序列化需要进行的删除操作的字段(物理删除) 用bitset表示 前提是skuid/region/sourceid/sceneid都填了 类型为std::bitset<32> 
			$bs->pushUint8_t($this->cBitDelOperation_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->setTimedPriceIndex,'stl_set'); // 序列化时间维度index 需要删除时间维度时有效 类型为std::set<uint32_t> 
			$bs->pushUint8_t($this->cTimedPriceIndex_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化sku id 必填 类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRegionId = $bs->popUint32_t(); // 反序列化地域 id，选填 类型为uint32_t
			$this->cRegionId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwPriceSceneId = $bs->popUint64_t(); // 反序列化场景 id，选填 类型为uint64_t
			$this->cPriceSceneId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwPriceSourceId = $bs->popUint64_t(); // 反序列化来源 id，选填 类型为uint64_t
			$this->cPriceSourceId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceCreaterId = $bs->popString(); // 反序列化创建者id，选填 类型为std::string
			$this->cPriceCreaterId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->bitsetBitDelOperation = $bs->popObject('stl_bitset<32>'); // 反序列化需要进行的删除操作的字段(物理删除) 用bitset表示 前提是skuid/region/sourceid/sceneid都填了 类型为std::bitset<32> 
			$this->cBitDelOperation_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->setTimedPriceIndex = $bs->popObject('stl_set<uint32_t>'); // 反序列化时间维度index 需要删除时间维度时有效 类型为std::set<uint32_t> 
			$this->cTimedPriceIndex_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.b2b2c.icsonboss.ao.idl.BatchGetSkuInfoListByIcsonIdResp.java

if (!class_exists('BatchConversionIcsonIdErrorPo')) {
class BatchConversionIcsonIdErrorPo
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 接口返回错误码
		 *
		 * 版本 >= 0
		 */
		var $dwErrorNo; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cErrorNo_u; //uint8_t

		/**
		 * 接口返回外部用错误信息
		 *
		 * 版本 >= 0
		 */
		var $strErrorMsgOutter; //std::string

		/**
		 * 版本 >= 0
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
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwErrorNo); // 序列化接口返回错误码 类型为uint32_t
			$bs->pushUint8_t($this->cErrorNo_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strErrorMsgOutter); // 序列化接口返回外部用错误信息 类型为std::string
			$bs->pushUint8_t($this->cErrorMsgOutter_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwErrorNo = $bs->popUint32_t(); // 反序列化接口返回错误码 类型为uint32_t
			$this->cErrorNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strErrorMsgOutter = $bs->popString(); // 反序列化接口返回外部用错误信息 类型为std::string
			$this->cErrorMsgOutter_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.b2b2c.icsonboss.ao.idl.BatchGetSkuInfoListByIcsonIdResp.java

if (!class_exists('ConversionSkuBasicPo')) {
class ConversionSkuBasicPo
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * SKU状态
		 *
		 * 版本 >= 0
		 */
		var $wSkuState; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuState_u; //uint8_t

		/**
		 * SKUID
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
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
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wSkuState); // 序列化SKU状态 类型为uint16_t
			$bs->pushUint8_t($this->cSkuState_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化SKUID 类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wSkuState = $bs->popUint16_t(); // 反序列化SKU状态 类型为uint16_t
			$this->cSkuState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化SKUID 类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.b2b2c.icsonboss.ao.idl.BatchGetSkuBySkuIdResp.java

if (!class_exists('BossSkuBasicPo')) {
class BossSkuBasicPo
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $cVersion; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * skuid  
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 合作伙伴ID 主号+子号  
		 *
		 * 版本 >= 0
		 */
		var $ddwCooperatorId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorId_u; //uint8_t

		/**
		 * spuId  
		 *
		 * 版本 >= 0
		 */
		var $ddwSpuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSpuId_u; //uint8_t

		/**
		 * hash 64bit 
		 *
		 * 版本 >= 0
		 */
		var $ddwHash; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cHash_u; //uint8_t

		/**
		 * ItemID  
		 *
		 * 版本 >= 0
		 */
		var $ddwItemId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cItemId_u; //uint8_t

		/**
		 * 品类ID  
		 *
		 * 版本 >= 0
		 */
		var $dwCategoryId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cCategoryId_u; //uint8_t

		/**
		 * ssuid 
		 *
		 * 版本 >= 0
		 */
		var $ddwSsuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSsuId_u; //uint8_t

		/**
		 * Sku主图ID  
		 *
		 * 版本 >= 0
		 */
		var $dwMainPicLog; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cMainPicLog_u; //uint8_t

		/**
		 * 供应商Sku编码  
		 *
		 * 版本 >= 0
		 */
		var $strCooperatorSkuCode; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorSkuCode_u; //uint8_t

		/**
		 * 生产商条形码  
		 *
		 * 版本 >= 0
		 */
		var $strProducerBarCode; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cProducerBarCode_u; //uint8_t

		/**
		 * 国际通行条形码  
		 *
		 * 版本 >= 0
		 */
		var $strInteBarCode; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cInteBarCode_u; //uint8_t

		/**
		 * Sku标题  
		 *
		 * 版本 >= 0
		 */
		var $strTitle; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cTitle_u; //uint8_t

		/**
		 * Sku引题  
		 *
		 * 版本 >= 0
		 */
		var $strHeadTitle; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cHeadTitle_u; //uint8_t

		/**
		 * Sku副题  
		 *
		 * 版本 >= 0
		 */
		var $strSubTitle; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSubTitle_u; //uint8_t

		/**
		 * Sku促销语  
		 *
		 * 版本 >= 0
		 */
		var $strPromotionDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPromotionDesc_u; //uint8_t

		/**
		 * Sku销售属性串  
		 *
		 * 版本 >= 0
		 */
		var $strSaleAttr; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSaleAttr_u; //uint8_t

		/**
		 * Sku销售属性串描述  
		 *
		 * 版本 >= 0
		 */
		var $strSaleAttrDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSaleAttrDesc_u; //uint8_t

		/**
		 * Sku参考价格,精确到分  
		 *
		 * 版本 >= 0
		 */
		var $dwRefPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cRefPrice_u; //uint8_t

		/**
		 * Sku 状态  
		 *
		 * 版本 >= 0
		 */
		var $cState; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cState_u; //uint8_t

		/**
		 * Sku 重量 克  
		 *
		 * 版本 >= 0
		 */
		var $dwWeight; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cWeight_u; //uint8_t

		/**
		 * Sku 体积 立方厘米  
		 *
		 * 版本 >= 0
		 */
		var $dwVolume; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVolume_u; //uint8_t

		/**
		 * Sku 类目属性串  
		 *
		 * 版本 >= 0
		 */
		var $strCategoryAttr; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cCategoryAttr_u; //uint8_t

		/**
		 * Sku 自定义属性  
		 *
		 * 版本 >= 0
		 */
		var $strCustomizeAttr; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cCustomizeAttr_u; //uint8_t

		/**
		 * Sku 关键词  
		 *
		 * 版本 >= 0
		 */
		var $strKeyWord; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cKeyWord_u; //uint8_t

		/**
		 * Sku 分类  
		 *
		 * 版本 >= 0
		 */
		var $strClassify; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cClassify_u; //uint8_t

		/**
		 * Sku 搜索因子  
		 *
		 * 版本 >= 0
		 */
		var $dwSearchFactor; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSearchFactor_u; //uint8_t

		/**
		 * Sku 税率  
		 *
		 * 版本 >= 0
		 */
		var $dwVatRate; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVatRate_u; //uint8_t

		/**
		 * Sku 当前快照版本  
		 *
		 * 版本 >= 0
		 */
		var $wSnapVersion; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cSnapVersion_u; //uint8_t

		/**
		 * Sku 购买限制 0 -- 无限制  
		 *
		 * 版本 >= 0
		 */
		var $dwBuyLimit; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyLimit_u; //uint8_t

		/**
		 * Sku 最后上架时间  
		 *
		 * 版本 >= 0
		 */
		var $dwLastUpTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cLastUpTime_u; //uint8_t

		/**
		 * Sku 最后下架时间  
		 *
		 * 版本 >= 0
		 */
		var $dwLastDownTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cLastDownTime_u; //uint8_t

		/**
		 * Sku 添加时间  
		 *
		 * 版本 >= 0
		 */
		var $dwAddTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cAddTime_u; //uint8_t

		/**
		 * Sku 最后快照生成时间  
		 *
		 * 版本 >= 0
		 */
		var $dwLastSnapTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cLastSnapTime_u; //uint8_t

		/**
		 * Sku 最后修改时间  
		 *
		 * 版本 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t

		/**
		 * 一个Sku所对应的库存信息  
		 *
		 * 版本 >= 0
		 */
		var $vecStockInfo; //std::vector<b2b2c::icsonboss::po::CBossStockPo> 

		/**
		 * 版本 >= 0
		 */
		var $cStockInfo_u; //uint8_t

		/**
		 * Sku属性 include bit位
		 *
		 * 版本 >= 0
		 */
		var $bitsetBitInclude; //std::bitset<128> 

		/**
		 * Sku属性 include bit位 flag
		 *
		 * 版本 >= 0
		 */
		var $cBitInclude_u; //uint8_t

		/**
		 * Sku属性 exclude bit位
		 *
		 * 版本 >= 0
		 */
		var $bitsetBitExclude; //std::bitset<128> 

		/**
		 * Sku属性 exclude bit位 flag
		 *
		 * 版本 >= 0
		 */
		var $cBitExclude_u; //uint8_t

		/**
		 * reserve字段1
		 *
		 * 版本 >= 0
		 */
		var $strReserve1; //std::string

		/**
		 * reserve字段1 flag
		 *
		 * 版本 >= 0
		 */
		var $cReserve1_u; //uint8_t

		/**
		 * 主图ID最后更新时间
		 *
		 * 版本 >= 0
		 */
		var $dwMainLogoLastUpdateTime; //uint32_t

		/**
		 * 主图ID最后更新时间 flag
		 *
		 * 版本 >= 0
		 */
		var $cMainLogoLastUpdateTime_u; //uint8_t

		/**
		 * 主图Url map size->url 如：60x60, http://img3.paipaiimg.com/item-4EA7C11F-000000000000000000000004A3C50612.1.60x60.jpg
		 *
		 * 版本 >= 0
		 */
		var $mapMainLogoUrl; //std::map<std::string,std::string> 

		/**
		 * 主图Url map flag
		 *
		 * 版本 >= 0
		 */
		var $cMainLogoUrl_u; //uint8_t

		/**
		 * 尺码表Id
		 *
		 * 版本 >= 0
		 */
		var $dwSkuSizeTableId; //uint32_t

		/**
		 * 尺码表Id flag
		 *
		 * 版本 >= 0
		 */
		var $cSkuSizeTableId_u; //uint8_t

		/**
		 * Sku属性  
		 *
		 * 版本 >= 0
		 */
		var $bitsetBitProperty; //std::bitset<128> 

		/**
		 * Sku属性 flag 
		 *
		 * 版本 >= 0
		 */
		var $cBitProperty_u; //uint8_t

		/**
		 * 自定义分类  设置时用
		 *
		 * 版本 >= 0
		 */
		var $setCustomCategary; //std::set<uint32_t> 

		/**
		 * 自定义分类_u
		 *
		 * 版本 >= 0
		 */
		var $cCustomCategary_u; //uint8_t

		/**
		 * 模板告警 
		 *
		 * 版本 >= 0
		 */
		var $setAlarmGroups; //std::set<uint32_t> 

		/**
		 * 模板告警 flag
		 *
		 * 版本 >= 0
		 */
		var $cAlarmGroups_u; //uint8_t

		/**
		 * 商品类型 0:正常商品 1:二手商品 2:坏品 3:服务 
		 *
		 * 版本 >= 0
		 */
		var $dwSkuType; //uint32_t

		/**
		 * 商品类型 0:正常商品 1:二手商品 2:坏品 3:服务 flag 
		 *
		 * 版本 >= 0
		 */
		var $cSkuType_u; //uint8_t

		/**
		 * 易迅sku扩展信息 
		 *
		 * 版本 >= 0
		 */
		var $oBossSkuIcsonPo; //b2b2c::icsonboss::po::CBossSkuIcsonPo

		/**
		 * 易迅sku扩展信息 flag 
		 *
		 * 版本 >= 0
		 */
		var $cBossSkuIcsonPo_u; //uint8_t

		/**
		 * 运营类型 0:开放接入/1:自营/2:联营入库/3：联营入配/4：其它联营 
		 *
		 * 版本 >= 0
		 */
		var $dwSkuOperationModel; //uint32_t

		/**
		 * 运营类型 0:开放接入/1:自营/2:联营入库/3：联营入配/4：其它联营 
		 *
		 * 版本 >= 0
		 */
		var $cSkuOperationModel_u; //uint8_t

		/**
		 * 商品长度，单位毫米
		 *
		 * 版本 >= 0
		 */
		var $wSkuSizeX; //uint16_t

		/**
		 * 商品长度，单位毫米
		 *
		 * 版本 >= 0
		 */
		var $cSkuSizeX_u; //uint8_t

		/**
		 * 商品宽度，单位毫米
		 *
		 * 版本 >= 0
		 */
		var $wSkuSizeY; //uint16_t

		/**
		 * 商品宽度，单位毫米
		 *
		 * 版本 >= 0
		 */
		var $cSkuSizeY_u; //uint8_t

		/**
		 * 商品高度，单位毫米
		 *
		 * 版本 >= 0
		 */
		var $wSkuSizeZ; //uint16_t

		/**
		 * 商品高度，单位毫米
		 *
		 * 版本 >= 0
		 */
		var $cSkuSizeZ_u; //uint8_t

		/**
		 * 组件清单, coSkuCode(易迅sysno) -> 组件数量
		 *
		 * 版本 >= 0
		 */
		var $mapSkuComponent; //std::map<std::string,uint16_t> 

		/**
		 * 组件清单, coSkuCode(易迅sysno) -> 组件数量_u
		 *
		 * 版本 >= 0
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
			$bs->pushUint8_t($this->cVersion); // 序列化 版本号    类型为uint8_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化skuid   类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwCooperatorId); // 序列化合作伙伴ID 主号+子号   类型为uint64_t
			$bs->pushUint8_t($this->cCooperatorId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSpuId); // 序列化spuId   类型为uint64_t
			$bs->pushUint8_t($this->cSpuId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwHash); // 序列化hash 64bit  类型为uint64_t
			$bs->pushUint8_t($this->cHash_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwItemId); // 序列化ItemID   类型为uint64_t
			$bs->pushUint8_t($this->cItemId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwCategoryId); // 序列化品类ID   类型为uint32_t
			$bs->pushUint8_t($this->cCategoryId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSsuId); // 序列化ssuid  类型为uint64_t
			$bs->pushUint8_t($this->cSsuId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwMainPicLog); // 序列化Sku主图ID   类型为uint32_t
			$bs->pushUint8_t($this->cMainPicLog_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strCooperatorSkuCode); // 序列化供应商Sku编码   类型为std::string
			$bs->pushUint8_t($this->cCooperatorSkuCode_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strProducerBarCode); // 序列化生产商条形码   类型为std::string
			$bs->pushUint8_t($this->cProducerBarCode_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strInteBarCode); // 序列化国际通行条形码   类型为std::string
			$bs->pushUint8_t($this->cInteBarCode_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strTitle); // 序列化Sku标题   类型为std::string
			$bs->pushUint8_t($this->cTitle_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strHeadTitle); // 序列化Sku引题   类型为std::string
			$bs->pushUint8_t($this->cHeadTitle_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSubTitle); // 序列化Sku副题   类型为std::string
			$bs->pushUint8_t($this->cSubTitle_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPromotionDesc); // 序列化Sku促销语   类型为std::string
			$bs->pushUint8_t($this->cPromotionDesc_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSaleAttr); // 序列化Sku销售属性串   类型为std::string
			$bs->pushUint8_t($this->cSaleAttr_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSaleAttrDesc); // 序列化Sku销售属性串描述   类型为std::string
			$bs->pushUint8_t($this->cSaleAttrDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwRefPrice); // 序列化Sku参考价格,精确到分   类型为uint32_t
			$bs->pushUint8_t($this->cRefPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cState); // 序列化Sku 状态   类型为uint8_t
			$bs->pushUint8_t($this->cState_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwWeight); // 序列化Sku 重量 克   类型为uint32_t
			$bs->pushUint8_t($this->cWeight_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwVolume); // 序列化Sku 体积 立方厘米   类型为uint32_t
			$bs->pushUint8_t($this->cVolume_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strCategoryAttr); // 序列化Sku 类目属性串   类型为std::string
			$bs->pushUint8_t($this->cCategoryAttr_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strCustomizeAttr); // 序列化Sku 自定义属性   类型为std::string
			$bs->pushUint8_t($this->cCustomizeAttr_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strKeyWord); // 序列化Sku 关键词   类型为std::string
			$bs->pushUint8_t($this->cKeyWord_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strClassify); // 序列化Sku 分类   类型为std::string
			$bs->pushUint8_t($this->cClassify_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSearchFactor); // 序列化Sku 搜索因子   类型为uint32_t
			$bs->pushUint8_t($this->cSearchFactor_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwVatRate); // 序列化Sku 税率   类型为uint32_t
			$bs->pushUint8_t($this->cVatRate_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wSnapVersion); // 序列化Sku 当前快照版本   类型为uint16_t
			$bs->pushUint8_t($this->cSnapVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwBuyLimit); // 序列化Sku 购买限制 0 -- 无限制   类型为uint32_t
			$bs->pushUint8_t($this->cBuyLimit_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwLastUpTime); // 序列化Sku 最后上架时间   类型为uint32_t
			$bs->pushUint8_t($this->cLastUpTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwLastDownTime); // 序列化Sku 最后下架时间   类型为uint32_t
			$bs->pushUint8_t($this->cLastDownTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwAddTime); // 序列化Sku 添加时间   类型为uint32_t
			$bs->pushUint8_t($this->cAddTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwLastSnapTime); // 序列化Sku 最后快照生成时间   类型为uint32_t
			$bs->pushUint8_t($this->cLastSnapTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // 序列化Sku 最后修改时间   类型为uint32_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecStockInfo,'stl_vector'); // 序列化一个Sku所对应的库存信息   类型为std::vector<b2b2c::icsonboss::po::CBossStockPo> 
			$bs->pushUint8_t($this->cStockInfo_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->bitsetBitInclude,'stl_bitset'); // 序列化Sku属性 include bit位 类型为std::bitset<128> 
			$bs->pushUint8_t($this->cBitInclude_u); // 序列化Sku属性 include bit位 flag 类型为uint8_t
			$bs->pushObject($this->bitsetBitExclude,'stl_bitset'); // 序列化Sku属性 exclude bit位 类型为std::bitset<128> 
			$bs->pushUint8_t($this->cBitExclude_u); // 序列化Sku属性 exclude bit位 flag 类型为uint8_t
			$bs->pushString($this->strReserve1); // 序列化reserve字段1 类型为std::string
			$bs->pushUint8_t($this->cReserve1_u); // 序列化reserve字段1 flag 类型为uint8_t
			$bs->pushUint32_t($this->dwMainLogoLastUpdateTime); // 序列化主图ID最后更新时间 类型为uint32_t
			$bs->pushUint8_t($this->cMainLogoLastUpdateTime_u); // 序列化主图ID最后更新时间 flag 类型为uint8_t
			$bs->pushObject($this->mapMainLogoUrl,'stl_map'); // 序列化主图Url map size->url 如：60x60, http://img3.paipaiimg.com/item-4EA7C11F-000000000000000000000004A3C50612.1.60x60.jpg 类型为std::map<std::string,std::string> 
			$bs->pushUint8_t($this->cMainLogoUrl_u); // 序列化主图Url map flag 类型为uint8_t
			$bs->pushUint32_t($this->dwSkuSizeTableId); // 序列化尺码表Id 类型为uint32_t
			$bs->pushUint8_t($this->cSkuSizeTableId_u); // 序列化尺码表Id flag 类型为uint8_t
			$bs->pushObject($this->bitsetBitProperty,'stl_bitset'); // 序列化Sku属性   类型为std::bitset<128> 
			$bs->pushUint8_t($this->cBitProperty_u); // 序列化Sku属性 flag  类型为uint8_t
			$bs->pushObject($this->setCustomCategary,'stl_set'); // 序列化自定义分类  设置时用 类型为std::set<uint32_t> 
			$bs->pushUint8_t($this->cCustomCategary_u); // 序列化自定义分类_u 类型为uint8_t
			$bs->pushObject($this->setAlarmGroups,'stl_set'); // 序列化模板告警  类型为std::set<uint32_t> 
			$bs->pushUint8_t($this->cAlarmGroups_u); // 序列化模板告警 flag 类型为uint8_t
			$bs->pushUint32_t($this->dwSkuType); // 序列化商品类型 0:正常商品 1:二手商品 2:坏品 3:服务  类型为uint32_t
			$bs->pushUint8_t($this->cSkuType_u); // 序列化商品类型 0:正常商品 1:二手商品 2:坏品 3:服务 flag  类型为uint8_t
			$bs->pushObject($this->oBossSkuIcsonPo,'BossSkuIcsonPo'); // 序列化易迅sku扩展信息  类型为b2b2c::icsonboss::po::CBossSkuIcsonPo
			$bs->pushUint8_t($this->cBossSkuIcsonPo_u); // 序列化易迅sku扩展信息 flag  类型为uint8_t
			$bs->pushUint32_t($this->dwSkuOperationModel); // 序列化运营类型 0:开放接入/1:自营/2:联营入库/3：联营入配/4：其它联营  类型为uint32_t
			$bs->pushUint8_t($this->cSkuOperationModel_u); // 序列化运营类型 0:开放接入/1:自营/2:联营入库/3：联营入配/4：其它联营  类型为uint8_t
			$bs->pushUint16_t($this->wSkuSizeX); // 序列化商品长度，单位毫米 类型为uint16_t
			$bs->pushUint8_t($this->cSkuSizeX_u); // 序列化商品长度，单位毫米 类型为uint8_t
			$bs->pushUint16_t($this->wSkuSizeY); // 序列化商品宽度，单位毫米 类型为uint16_t
			$bs->pushUint8_t($this->cSkuSizeY_u); // 序列化商品宽度，单位毫米 类型为uint8_t
			$bs->pushUint16_t($this->wSkuSizeZ); // 序列化商品高度，单位毫米 类型为uint16_t
			$bs->pushUint8_t($this->cSkuSizeZ_u); // 序列化商品高度，单位毫米 类型为uint8_t
			$bs->pushObject($this->mapSkuComponent,'stl_map'); // 序列化组件清单, coSkuCode(易迅sysno) -> 组件数量 类型为std::map<std::string,uint16_t> 
			$bs->pushUint8_t($this->cSkuComponent_u); // 序列化组件清单, coSkuCode(易迅sysno) -> 组件数量_u 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->cVersion = $bs->popUint8_t(); // 反序列化 版本号    类型为uint8_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化skuid   类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwCooperatorId = $bs->popUint64_t(); // 反序列化合作伙伴ID 主号+子号   类型为uint64_t
			$this->cCooperatorId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSpuId = $bs->popUint64_t(); // 反序列化spuId   类型为uint64_t
			$this->cSpuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwHash = $bs->popUint64_t(); // 反序列化hash 64bit  类型为uint64_t
			$this->cHash_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwItemId = $bs->popUint64_t(); // 反序列化ItemID   类型为uint64_t
			$this->cItemId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwCategoryId = $bs->popUint32_t(); // 反序列化品类ID   类型为uint32_t
			$this->cCategoryId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSsuId = $bs->popUint64_t(); // 反序列化ssuid  类型为uint64_t
			$this->cSsuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwMainPicLog = $bs->popUint32_t(); // 反序列化Sku主图ID   类型为uint32_t
			$this->cMainPicLog_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strCooperatorSkuCode = $bs->popString(); // 反序列化供应商Sku编码   类型为std::string
			$this->cCooperatorSkuCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strProducerBarCode = $bs->popString(); // 反序列化生产商条形码   类型为std::string
			$this->cProducerBarCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strInteBarCode = $bs->popString(); // 反序列化国际通行条形码   类型为std::string
			$this->cInteBarCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strTitle = $bs->popString(); // 反序列化Sku标题   类型为std::string
			$this->cTitle_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strHeadTitle = $bs->popString(); // 反序列化Sku引题   类型为std::string
			$this->cHeadTitle_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSubTitle = $bs->popString(); // 反序列化Sku副题   类型为std::string
			$this->cSubTitle_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPromotionDesc = $bs->popString(); // 反序列化Sku促销语   类型为std::string
			$this->cPromotionDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSaleAttr = $bs->popString(); // 反序列化Sku销售属性串   类型为std::string
			$this->cSaleAttr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSaleAttrDesc = $bs->popString(); // 反序列化Sku销售属性串描述   类型为std::string
			$this->cSaleAttrDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRefPrice = $bs->popUint32_t(); // 反序列化Sku参考价格,精确到分   类型为uint32_t
			$this->cRefPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cState = $bs->popUint8_t(); // 反序列化Sku 状态   类型为uint8_t
			$this->cState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwWeight = $bs->popUint32_t(); // 反序列化Sku 重量 克   类型为uint32_t
			$this->cWeight_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwVolume = $bs->popUint32_t(); // 反序列化Sku 体积 立方厘米   类型为uint32_t
			$this->cVolume_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strCategoryAttr = $bs->popString(); // 反序列化Sku 类目属性串   类型为std::string
			$this->cCategoryAttr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strCustomizeAttr = $bs->popString(); // 反序列化Sku 自定义属性   类型为std::string
			$this->cCustomizeAttr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strKeyWord = $bs->popString(); // 反序列化Sku 关键词   类型为std::string
			$this->cKeyWord_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strClassify = $bs->popString(); // 反序列化Sku 分类   类型为std::string
			$this->cClassify_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSearchFactor = $bs->popUint32_t(); // 反序列化Sku 搜索因子   类型为uint32_t
			$this->cSearchFactor_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwVatRate = $bs->popUint32_t(); // 反序列化Sku 税率   类型为uint32_t
			$this->cVatRate_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wSnapVersion = $bs->popUint16_t(); // 反序列化Sku 当前快照版本   类型为uint16_t
			$this->cSnapVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwBuyLimit = $bs->popUint32_t(); // 反序列化Sku 购买限制 0 -- 无限制   类型为uint32_t
			$this->cBuyLimit_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwLastUpTime = $bs->popUint32_t(); // 反序列化Sku 最后上架时间   类型为uint32_t
			$this->cLastUpTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwLastDownTime = $bs->popUint32_t(); // 反序列化Sku 最后下架时间   类型为uint32_t
			$this->cLastDownTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwAddTime = $bs->popUint32_t(); // 反序列化Sku 添加时间   类型为uint32_t
			$this->cAddTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwLastSnapTime = $bs->popUint32_t(); // 反序列化Sku 最后快照生成时间   类型为uint32_t
			$this->cLastSnapTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // 反序列化Sku 最后修改时间   类型为uint32_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecStockInfo = $bs->popObject('stl_vector<BossStockPo>'); // 反序列化一个Sku所对应的库存信息   类型为std::vector<b2b2c::icsonboss::po::CBossStockPo> 
			$this->cStockInfo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->bitsetBitInclude = $bs->popObject('stl_bitset<128>'); // 反序列化Sku属性 include bit位 类型为std::bitset<128> 
			$this->cBitInclude_u = $bs->popUint8_t(); // 反序列化Sku属性 include bit位 flag 类型为uint8_t
			$this->bitsetBitExclude = $bs->popObject('stl_bitset<128>'); // 反序列化Sku属性 exclude bit位 类型为std::bitset<128> 
			$this->cBitExclude_u = $bs->popUint8_t(); // 反序列化Sku属性 exclude bit位 flag 类型为uint8_t
			$this->strReserve1 = $bs->popString(); // 反序列化reserve字段1 类型为std::string
			$this->cReserve1_u = $bs->popUint8_t(); // 反序列化reserve字段1 flag 类型为uint8_t
			$this->dwMainLogoLastUpdateTime = $bs->popUint32_t(); // 反序列化主图ID最后更新时间 类型为uint32_t
			$this->cMainLogoLastUpdateTime_u = $bs->popUint8_t(); // 反序列化主图ID最后更新时间 flag 类型为uint8_t
			$this->mapMainLogoUrl = $bs->popObject('stl_map<stl_string,stl_string>'); // 反序列化主图Url map size->url 如：60x60, http://img3.paipaiimg.com/item-4EA7C11F-000000000000000000000004A3C50612.1.60x60.jpg 类型为std::map<std::string,std::string> 
			$this->cMainLogoUrl_u = $bs->popUint8_t(); // 反序列化主图Url map flag 类型为uint8_t
			$this->dwSkuSizeTableId = $bs->popUint32_t(); // 反序列化尺码表Id 类型为uint32_t
			$this->cSkuSizeTableId_u = $bs->popUint8_t(); // 反序列化尺码表Id flag 类型为uint8_t
			$this->bitsetBitProperty = $bs->popObject('stl_bitset<128>'); // 反序列化Sku属性   类型为std::bitset<128> 
			$this->cBitProperty_u = $bs->popUint8_t(); // 反序列化Sku属性 flag  类型为uint8_t
			$this->setCustomCategary = $bs->popObject('stl_set<uint32_t>'); // 反序列化自定义分类  设置时用 类型为std::set<uint32_t> 
			$this->cCustomCategary_u = $bs->popUint8_t(); // 反序列化自定义分类_u 类型为uint8_t
			$this->setAlarmGroups = $bs->popObject('stl_set<uint32_t>'); // 反序列化模板告警  类型为std::set<uint32_t> 
			$this->cAlarmGroups_u = $bs->popUint8_t(); // 反序列化模板告警 flag 类型为uint8_t
			$this->dwSkuType = $bs->popUint32_t(); // 反序列化商品类型 0:正常商品 1:二手商品 2:坏品 3:服务  类型为uint32_t
			$this->cSkuType_u = $bs->popUint8_t(); // 反序列化商品类型 0:正常商品 1:二手商品 2:坏品 3:服务 flag  类型为uint8_t
			$this->oBossSkuIcsonPo = $bs->popObject('BossSkuIcsonPo'); // 反序列化易迅sku扩展信息  类型为b2b2c::icsonboss::po::CBossSkuIcsonPo
			$this->cBossSkuIcsonPo_u = $bs->popUint8_t(); // 反序列化易迅sku扩展信息 flag  类型为uint8_t
			$this->dwSkuOperationModel = $bs->popUint32_t(); // 反序列化运营类型 0:开放接入/1:自营/2:联营入库/3：联营入配/4：其它联营  类型为uint32_t
			$this->cSkuOperationModel_u = $bs->popUint8_t(); // 反序列化运营类型 0:开放接入/1:自营/2:联营入库/3：联营入配/4：其它联营  类型为uint8_t
			$this->wSkuSizeX = $bs->popUint16_t(); // 反序列化商品长度，单位毫米 类型为uint16_t
			$this->cSkuSizeX_u = $bs->popUint8_t(); // 反序列化商品长度，单位毫米 类型为uint8_t
			$this->wSkuSizeY = $bs->popUint16_t(); // 反序列化商品宽度，单位毫米 类型为uint16_t
			$this->cSkuSizeY_u = $bs->popUint8_t(); // 反序列化商品宽度，单位毫米 类型为uint8_t
			$this->wSkuSizeZ = $bs->popUint16_t(); // 反序列化商品高度，单位毫米 类型为uint16_t
			$this->cSkuSizeZ_u = $bs->popUint8_t(); // 反序列化商品高度，单位毫米 类型为uint8_t
			$this->mapSkuComponent = $bs->popObject('stl_map<stl_string,uint16_t>'); // 反序列化组件清单, coSkuCode(易迅sysno) -> 组件数量 类型为std::map<std::string,uint16_t> 
			$this->cSkuComponent_u = $bs->popUint8_t(); // 反序列化组件清单, coSkuCode(易迅sysno) -> 组件数量_u 类型为uint8_t

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


//source idl: com.b2b2c.icsonboss.ao.idl.BossSkuBasicPo.java

if (!class_exists('BossSkuIcsonPo')) {
class BossSkuIcsonPo
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * skuid  
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 易迅产品编号  
		 *
		 * 版本 >= 0
		 */
		var $strProductId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cProductId_u; //uint8_t

		/**
		 * 品牌编号  
		 *
		 * 版本 >= 0
		 */
		var $ddwManufacturerSysNo; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cManufacturerSysNo_u; //uint8_t

		/**
		 * 商品型号  
		 *
		 * 版本 >= 0
		 */
		var $strProductMode; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cProductMode_u; //uint8_t

		/**
		 * 大类编号  
		 *
		 * 版本 >= 0
		 */
		var $ddwC1SysNo; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cC1SysNo_u; //uint8_t

		/**
		 * 中类编号  
		 *
		 * 版本 >= 0
		 */
		var $ddwC2SysNo; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cC2SysNo_u; //uint8_t

		/**
		 * 小类编号  
		 *
		 * 版本 >= 0
		 */
		var $ddwC3SysNo; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cC3SysNo_u; //uint8_t

		/**
		 * 小四类编号  
		 *
		 * 版本 >= 0
		 */
		var $ddwC4SysNo; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cC4SysNo_u; //uint8_t

		/**
		 * 小五类编号  
		 *
		 * 版本 >= 0
		 */
		var $ddwC5SysNo; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cC5SysNo_u; //uint8_t

		/**
		 * 商品颜色编号，前期用作销售属性展示  
		 *
		 * 版本 >= 0
		 */
		var $ddwProductColor; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cProductColor_u; //uint8_t

		/**
		 * 商品规格，前期用作销售属性展示  
		 *
		 * 版本 >= 0
		 */
		var $ddwProductSize; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cProductSize_u; //uint8_t

		/**
		 * 对应主商品的易迅ID  
		 *
		 * 版本 >= 0
		 */
		var $ddwMasterProductSysNo; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cMasterProductSysNo_u; //uint8_t

		/**
		 * 当小于商品的实际图片时，仅显示前面部分图片  
		 *
		 * 版本 >= 0
		 */
		var $dwShowPicCount; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cShowPicCount_u; //uint8_t

		/**
		 *  
		 *
		 * 版本 >= 0
		 */
		var $strAttrs; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cAttrs_u; //uint8_t

		/**
		 * '易迅侧商品特殊属性，格式为 1:节能减排|2:延保产品，目前用于显示节能减排/延保产品标志 
		 *
		 * 版本 >= 0
		 */
		var $strSpecialAttrs; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSpecialAttrs_u; //uint8_t

		/**
		 * 二手商品来源, 0:拍照拆包/1:包装破损/2:主件维修/3:附件维修/4:主件换新/5:附件换新/6:顾客误买/7:厂家检测无故障  
		 *
		 * 版本 >= 0
		 */
		var $dwSndSource; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSndSource_u; //uint8_t

		/**
		 * 二手保修截止时间 
		 *
		 * 版本 >= 0
		 */
		var $dwSndWarrantyTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSndWarrantyTime_u; //uint8_t

		/**
		 * 二手商品品相, 0:全新/1:九成新/2:八成新/3:七成新/4:七成以下 
		 *
		 * 版本 >= 0
		 */
		var $dwSndClass; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSndClass_u; //uint8_t

		/**
		 * 二手商品性能, 0:未使用过，原包装拆封，功能完好/1:被使用过，功能完好/2:被维修过，功能完好/3:外包装破损，未拆封 
		 *
		 * 版本 >= 0
		 */
		var $dwSndPerformance; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSndPerformance_u; //uint8_t

		/**
		 * 二手顾客使用时间
		 *
		 * 版本 >= 0
		 */
		var $dwSndUsedDays; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSndUsedDays_u; //uint8_t

		/**
		 * 二手是否实物拍摄, 0:无/1:有
		 *
		 * 版本 >= 0
		 */
		var $dwSndHavePhoto; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSndHavePhoto_u; //uint8_t

		/**
		 * 二手备注信息
		 *
		 * 版本 >= 0
		 */
		var $strSndMemo; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSndMemo_u; //uint8_t

		/**
		 * 二手包装附件
		 *
		 * 版本 >= 0
		 */
		var $strSndAttach; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSndAttach_u; //uint8_t

		/**
		 * 创建时间
		 *
		 * 版本 >= 0
		 */
		var $dwCreateTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cCreateTime_u; //uint8_t

		/**
		 * 最后更新时间
		 *
		 * 版本 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t

		/**
		 * 合约机业务类型
		 *
		 * 版本 >= 0
		 */
		var $dwContractSaleModel; //uint32_t

		/**
		 * 合约机业务类型 flag
		 *
		 * 版本 >= 0
		 */
		var $cContractSaleModel_u; //uint8_t

		/**
		 * 爱车宝扩展属性类目信息
		 *
		 * 版本 >= 0
		 */
		var $strCarAttrInfo; //std::string

		/**
		 * 爱车宝扩展属性类目信息 flag
		 *
		 * 版本 >= 0
		 */
		var $cCarAttrInfo_u; //uint8_t

		/**
		 * 货主
		 *
		 * 版本 >= 0
		 */
		var $dwSkuOwner; //uint32_t

		/**
		 * 货主 flag
		 *
		 * 版本 >= 0
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
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化skuid   类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strProductId); // 序列化易迅产品编号   类型为std::string
			$bs->pushUint8_t($this->cProductId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwManufacturerSysNo); // 序列化品牌编号   类型为uint64_t
			$bs->pushUint8_t($this->cManufacturerSysNo_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strProductMode); // 序列化商品型号   类型为std::string
			$bs->pushUint8_t($this->cProductMode_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwC1SysNo); // 序列化大类编号   类型为uint64_t
			$bs->pushUint8_t($this->cC1SysNo_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwC2SysNo); // 序列化中类编号   类型为uint64_t
			$bs->pushUint8_t($this->cC2SysNo_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwC3SysNo); // 序列化小类编号   类型为uint64_t
			$bs->pushUint8_t($this->cC3SysNo_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwC4SysNo); // 序列化小四类编号   类型为uint64_t
			$bs->pushUint8_t($this->cC4SysNo_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwC5SysNo); // 序列化小五类编号   类型为uint64_t
			$bs->pushUint8_t($this->cC5SysNo_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwProductColor); // 序列化商品颜色编号，前期用作销售属性展示   类型为uint64_t
			$bs->pushUint8_t($this->cProductColor_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwProductSize); // 序列化商品规格，前期用作销售属性展示   类型为uint64_t
			$bs->pushUint8_t($this->cProductSize_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwMasterProductSysNo); // 序列化对应主商品的易迅ID   类型为uint64_t
			$bs->pushUint8_t($this->cMasterProductSysNo_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwShowPicCount); // 序列化当小于商品的实际图片时，仅显示前面部分图片   类型为uint32_t
			$bs->pushUint8_t($this->cShowPicCount_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strAttrs); // 序列化  类型为std::string
			$bs->pushUint8_t($this->cAttrs_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSpecialAttrs); // 序列化'易迅侧商品特殊属性，格式为 1:节能减排|2:延保产品，目前用于显示节能减排/延保产品标志  类型为std::string
			$bs->pushUint8_t($this->cSpecialAttrs_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSndSource); // 序列化二手商品来源, 0:拍照拆包/1:包装破损/2:主件维修/3:附件维修/4:主件换新/5:附件换新/6:顾客误买/7:厂家检测无故障   类型为uint32_t
			$bs->pushUint8_t($this->cSndSource_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSndWarrantyTime); // 序列化二手保修截止时间  类型为uint32_t
			$bs->pushUint8_t($this->cSndWarrantyTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSndClass); // 序列化二手商品品相, 0:全新/1:九成新/2:八成新/3:七成新/4:七成以下  类型为uint32_t
			$bs->pushUint8_t($this->cSndClass_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSndPerformance); // 序列化二手商品性能, 0:未使用过，原包装拆封，功能完好/1:被使用过，功能完好/2:被维修过，功能完好/3:外包装破损，未拆封  类型为uint32_t
			$bs->pushUint8_t($this->cSndPerformance_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSndUsedDays); // 序列化二手顾客使用时间 类型为uint32_t
			$bs->pushUint8_t($this->cSndUsedDays_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSndHavePhoto); // 序列化二手是否实物拍摄, 0:无/1:有 类型为uint32_t
			$bs->pushUint8_t($this->cSndHavePhoto_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSndMemo); // 序列化二手备注信息 类型为std::string
			$bs->pushUint8_t($this->cSndMemo_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSndAttach); // 序列化二手包装附件 类型为std::string
			$bs->pushUint8_t($this->cSndAttach_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwCreateTime); // 序列化创建时间 类型为uint32_t
			$bs->pushUint8_t($this->cCreateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // 序列化最后更新时间 类型为uint32_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwContractSaleModel); // 序列化合约机业务类型 类型为uint32_t
			$bs->pushUint8_t($this->cContractSaleModel_u); // 序列化合约机业务类型 flag 类型为uint8_t
			$bs->pushString($this->strCarAttrInfo); // 序列化爱车宝扩展属性类目信息 类型为std::string
			$bs->pushUint8_t($this->cCarAttrInfo_u); // 序列化爱车宝扩展属性类目信息 flag 类型为uint8_t
			$bs->pushUint32_t($this->dwSkuOwner); // 序列化货主 类型为uint32_t
			$bs->pushUint8_t($this->cSkuOwner_u); // 序列化货主 flag 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化skuid   类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strProductId = $bs->popString(); // 反序列化易迅产品编号   类型为std::string
			$this->cProductId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwManufacturerSysNo = $bs->popUint64_t(); // 反序列化品牌编号   类型为uint64_t
			$this->cManufacturerSysNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strProductMode = $bs->popString(); // 反序列化商品型号   类型为std::string
			$this->cProductMode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwC1SysNo = $bs->popUint64_t(); // 反序列化大类编号   类型为uint64_t
			$this->cC1SysNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwC2SysNo = $bs->popUint64_t(); // 反序列化中类编号   类型为uint64_t
			$this->cC2SysNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwC3SysNo = $bs->popUint64_t(); // 反序列化小类编号   类型为uint64_t
			$this->cC3SysNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwC4SysNo = $bs->popUint64_t(); // 反序列化小四类编号   类型为uint64_t
			$this->cC4SysNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwC5SysNo = $bs->popUint64_t(); // 反序列化小五类编号   类型为uint64_t
			$this->cC5SysNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwProductColor = $bs->popUint64_t(); // 反序列化商品颜色编号，前期用作销售属性展示   类型为uint64_t
			$this->cProductColor_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwProductSize = $bs->popUint64_t(); // 反序列化商品规格，前期用作销售属性展示   类型为uint64_t
			$this->cProductSize_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwMasterProductSysNo = $bs->popUint64_t(); // 反序列化对应主商品的易迅ID   类型为uint64_t
			$this->cMasterProductSysNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwShowPicCount = $bs->popUint32_t(); // 反序列化当小于商品的实际图片时，仅显示前面部分图片   类型为uint32_t
			$this->cShowPicCount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strAttrs = $bs->popString(); // 反序列化  类型为std::string
			$this->cAttrs_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSpecialAttrs = $bs->popString(); // 反序列化'易迅侧商品特殊属性，格式为 1:节能减排|2:延保产品，目前用于显示节能减排/延保产品标志  类型为std::string
			$this->cSpecialAttrs_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSndSource = $bs->popUint32_t(); // 反序列化二手商品来源, 0:拍照拆包/1:包装破损/2:主件维修/3:附件维修/4:主件换新/5:附件换新/6:顾客误买/7:厂家检测无故障   类型为uint32_t
			$this->cSndSource_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSndWarrantyTime = $bs->popUint32_t(); // 反序列化二手保修截止时间  类型为uint32_t
			$this->cSndWarrantyTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSndClass = $bs->popUint32_t(); // 反序列化二手商品品相, 0:全新/1:九成新/2:八成新/3:七成新/4:七成以下  类型为uint32_t
			$this->cSndClass_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSndPerformance = $bs->popUint32_t(); // 反序列化二手商品性能, 0:未使用过，原包装拆封，功能完好/1:被使用过，功能完好/2:被维修过，功能完好/3:外包装破损，未拆封  类型为uint32_t
			$this->cSndPerformance_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSndUsedDays = $bs->popUint32_t(); // 反序列化二手顾客使用时间 类型为uint32_t
			$this->cSndUsedDays_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSndHavePhoto = $bs->popUint32_t(); // 反序列化二手是否实物拍摄, 0:无/1:有 类型为uint32_t
			$this->cSndHavePhoto_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSndMemo = $bs->popString(); // 反序列化二手备注信息 类型为std::string
			$this->cSndMemo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSndAttach = $bs->popString(); // 反序列化二手包装附件 类型为std::string
			$this->cSndAttach_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwCreateTime = $bs->popUint32_t(); // 反序列化创建时间 类型为uint32_t
			$this->cCreateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // 反序列化最后更新时间 类型为uint32_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwContractSaleModel = $bs->popUint32_t(); // 反序列化合约机业务类型 类型为uint32_t
			$this->cContractSaleModel_u = $bs->popUint8_t(); // 反序列化合约机业务类型 flag 类型为uint8_t
			$this->strCarAttrInfo = $bs->popString(); // 反序列化爱车宝扩展属性类目信息 类型为std::string
			$this->cCarAttrInfo_u = $bs->popUint8_t(); // 反序列化爱车宝扩展属性类目信息 flag 类型为uint8_t
			$this->dwSkuOwner = $bs->popUint32_t(); // 反序列化货主 类型为uint32_t
			$this->cSkuOwner_u = $bs->popUint8_t(); // 反序列化货主 flag 类型为uint8_t

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


//source idl: com.b2b2c.icsonboss.ao.idl.BossSkuBasicPo.java

if (!class_exists('BossStockPo')) {
class BossStockPo
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $cVersion; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * stockId,库存id  
		 *
		 * 版本 >= 0
		 */
		var $ddwStockId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cStockId_u; //uint8_t

		/**
		 * sku id  
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 仓库Id  
		 *
		 * 版本 >= 0
		 */
		var $dwStoreHouseId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStoreHouseId_u; //uint8_t

		/**
		 * 仓库名称
		 *
		 * 版本 >= 0
		 */
		var $strStoreHouseName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cStoreHouseName_u; //uint8_t

		/**
		 * 合作伙伴ID 主号+子号  
		 *
		 * 版本 >= 0
		 */
		var $ddwCooperatorId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorId_u; //uint8_t

		/**
		 * 供应商库存编码,内码  
		 *
		 * 版本 >= 0
		 */
		var $strCooperatorStockCode; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorStockCode_u; //uint8_t

		/**
		 * 供应商商品条形码  
		 *
		 * 版本 >= 0
		 */
		var $strCooperatorBarCode; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorBarCode_u; //uint8_t

		/**
		 * 库存价格，单位分  
		 *
		 * 版本 >= 0
		 */
		var $dwStockPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockPrice_u; //uint8_t

		/**
		 * 库存上次价格  
		 *
		 * 版本 >= 0
		 */
		var $dwStockPrePrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockPrePrice_u; //uint8_t

		/**
		 * 库存成本价格  
		 *
		 * 版本 >= 0
		 */
		var $dwStockCostPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockCostPrice_u; //uint8_t

		/**
		 * 库存初始数量  
		 *
		 * 版本 >= 0
		 */
		var $dwStockInitialNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockInitialNum_u; //uint8_t

		/**
		 * 库存虚拟数量  
		 *
		 * 版本 >= 0
		 */
		var $dwStockVirtualNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockVirtualNum_u; //uint8_t

		/**
		 * 库存实际数量  
		 *
		 * 版本 >= 0
		 */
		var $dwStockRealNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockRealNum_u; //uint8_t

		/**
		 * 库存活动锁定数  
		 *
		 * 版本 >= 0
		 */
		var $dwPromotionLockNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPromotionLockNum_u; //uint8_t

		/**
		 * 普通销售锁定增减  
		 *
		 * 版本 >= 0
		 */
		var $dwNormalSellingLock; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cNormalSellingLock_u; //uint8_t

		/**
		 * 活动销售锁定增减  
		 *
		 * 版本 >= 0
		 */
		var $dwPromotionSellingLock; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPromotionSellingLock_u; //uint8_t

		/**
		 * 预计发送天数-出货时间 仓库到物流的时间   
		 *
		 * 版本 >= 0
		 */
		var $strEstimateDispatch; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cEstimateDispatch_u; //uint8_t

		/**
		 * 库存状态 link@  
		 *
		 * 版本 >= 0
		 */
		var $cStockState; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cStockState_u; //uint8_t

		/**
		 * 限运地域  
		 *
		 * 版本 >= 0
		 */
		var $setLimitArea; //std::set<uint32_t> 

		/**
		 * 版本 >= 0
		 */
		var $cLimitArea_u; //uint8_t

		/**
		 * 覆盖地域  
		 *
		 * 版本 >= 0
		 */
		var $setCoverArea; //std::set<uint32_t> 

		/**
		 * 版本 >= 0
		 */
		var $cCoverArea_u; //uint8_t

		/**
		 * 库存限运规则  
		 *
		 * 版本 >= 0
		 */
		var $strLimitrule; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cLimitrule_u; //uint8_t

		/**
		 * 库存购买总数,下单件数  
		 *
		 * 版本 >= 0
		 */
		var $dwOrderNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cOrderNum_u; //uint8_t

		/**
		 * 库存销售总数，订单流程走完的数量  
		 *
		 * 版本 >= 0
		 */
		var $dwSoldNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSoldNum_u; //uint8_t

		/**
		 * 库存添加时间  
		 *
		 * 版本 >= 0
		 */
		var $dwAddTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cAddTime_u; //uint8_t

		/**
		 * 库存最后修改时间  
		 *
		 * 版本 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t

		/**
		 * 完成付款后的锁定数量 
		 *
		 * 版本 >= 0
		 */
		var $dwStockPayedNum; //uint32_t

		/**
		 * 完成付款后的锁定数量 flag
		 *
		 * 版本 >= 0
		 */
		var $cStockPayedNum_u; //uint8_t

		/**
		 * 保留字段 
		 *
		 * 版本 >= 0
		 */
		var $strReverse; //std::string

		/**
		 * 保留字段 flag
		 *
		 * 版本 >= 0
		 */
		var $cReverse_u; //uint8_t

		/**
		 * 促销付款后的锁定数量 
		 *
		 * 版本 >= 0
		 */
		var $dwStockProPayedNum; //uint32_t

		/**
		 * 促销付款后的锁定数量 flag
		 *
		 * 版本 >= 0
		 */
		var $cStockProPayedNum_u; //uint8_t

		/**
		 * 合作伙伴真实同步数量 
		 *
		 * 版本 >= 0
		 */
		var $dwStockRealSynNum; //uint32_t

		/**
		 * 合作伙伴真实同步数量 flag
		 *
		 * 版本 >= 0
		 */
		var $cStockRealSynNum_u; //uint8_t

		/**
		 * 促销描述 
		 *
		 * 版本 >= 0
		 */
		var $strStockPromotionDesc; //std::string

		/**
		 * 促销描述 flag
		 *
		 * 版本 >= 0
		 */
		var $cStockPromotionDesc_u; //uint8_t

		/**
		 * 库存属性  
		 *
		 * 版本 >= 0
		 */
		var $bitsetBitProperty; //std::bitset<32> 

		/**
		 * 库存属性 flag
		 *
		 * 版本 >= 0
		 */
		var $cBitProperty_u; //uint8_t

		/**
		 * stock属性 include bit位 设置bit位 
		 *
		 * 版本 >= 0
		 */
		var $bitsetStockBitInclude; //std::bitset<32> 

		/**
		 * stock属性 include bit位 设置bit位 flag
		 *
		 * 版本 >= 0
		 */
		var $cStockBitInclude_u; //uint8_t

		/**
		 * stock属性 include bit位 取消bit位
		 *
		 * 版本 >= 0
		 */
		var $bitsetStockBitExclude; //std::bitset<32> 

		/**
		 * stock属性 include bit位 取消bit位 flag
		 *
		 * 版本 >= 0
		 */
		var $cStockBitExclude_u; //uint8_t

		/**
		 * 起购数量 最小购买数量 
		 *
		 * 版本 >= 0
		 */
		var $dwStockMinBuyNum; //uint32_t

		/**
		 * 起购数量 最小购买数量 flag
		 *
		 * 版本 >= 0
		 */
		var $cStockMinBuyNum_u; //uint8_t

		/**
		 * 限购数量 最大购买数量 相当于sku字段中的限购数量字段
		 *
		 * 版本 >= 0
		 */
		var $dwStockMaxBuyNum; //uint32_t

		/**
		 * 限购数量 最大购买数量 flag
		 *
		 * 版本 >= 0
		 */
		var $cStockMaxBuyNum_u; //uint8_t

		/**
		 * 合约机业务类型
		 *
		 * 版本 >= 0
		 */
		var $dwStockSellMode; //uint32_t

		/**
		 * 合约机业务类型 flag
		 *
		 * 版本 >= 0
		 */
		var $cStockSellMode_u; //uint8_t

		/**
		 * 业务成本
		 *
		 * 版本 >= 0
		 */
		var $dwStockBusinessCost; //uint32_t

		/**
		 * 业务成本 flag
		 *
		 * 版本 >= 0
		 */
		var $cStockBusinessCost_u; //uint8_t

		/**
		 * 易迅限运规则编码，具体由易迅侧服务解释
		 *
		 * 版本 >= 0
		 */
		var $dwStockLimitCode; //uint32_t

		/**
		 * 易迅限运规则编码，具体由易迅侧服务解释 flag
		 *
		 * 版本 >= 0
		 */
		var $cStockLimitCode_u; //uint8_t

		/**
		 * 促销类型 0:普通/1:新品/2:特卖/3:进口/4:限时/5:人气/6:独家/7:首发
		 *
		 * 版本 >= 0
		 */
		var $dwPromotionType; //uint32_t

		/**
		 * 促销类型 0:普通/1:新品/2:特卖/3:进口/4:限时/5:人气/6:独家/7:首发 flag
		 *
		 * 版本 >= 0
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
			$bs->pushUint8_t($this->cVersion); // 序列化 版本号    类型为uint8_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwStockId); // 序列化stockId,库存id   类型为uint64_t
			$bs->pushUint8_t($this->cStockId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化sku id   类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStoreHouseId); // 序列化仓库Id   类型为uint32_t
			$bs->pushUint8_t($this->cStoreHouseId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strStoreHouseName); // 序列化仓库名称 类型为std::string
			$bs->pushUint8_t($this->cStoreHouseName_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwCooperatorId); // 序列化合作伙伴ID 主号+子号   类型为uint64_t
			$bs->pushUint8_t($this->cCooperatorId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strCooperatorStockCode); // 序列化供应商库存编码,内码   类型为std::string
			$bs->pushUint8_t($this->cCooperatorStockCode_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strCooperatorBarCode); // 序列化供应商商品条形码   类型为std::string
			$bs->pushUint8_t($this->cCooperatorBarCode_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockPrice); // 序列化库存价格，单位分   类型为uint32_t
			$bs->pushUint8_t($this->cStockPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockPrePrice); // 序列化库存上次价格   类型为uint32_t
			$bs->pushUint8_t($this->cStockPrePrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockCostPrice); // 序列化库存成本价格   类型为uint32_t
			$bs->pushUint8_t($this->cStockCostPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockInitialNum); // 序列化库存初始数量   类型为uint32_t
			$bs->pushUint8_t($this->cStockInitialNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockVirtualNum); // 序列化库存虚拟数量   类型为uint32_t
			$bs->pushUint8_t($this->cStockVirtualNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockRealNum); // 序列化库存实际数量   类型为uint32_t
			$bs->pushUint8_t($this->cStockRealNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPromotionLockNum); // 序列化库存活动锁定数   类型为uint32_t
			$bs->pushUint8_t($this->cPromotionLockNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwNormalSellingLock); // 序列化普通销售锁定增减   类型为uint32_t
			$bs->pushUint8_t($this->cNormalSellingLock_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPromotionSellingLock); // 序列化活动销售锁定增减   类型为uint32_t
			$bs->pushUint8_t($this->cPromotionSellingLock_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strEstimateDispatch); // 序列化预计发送天数-出货时间 仓库到物流的时间    类型为std::string
			$bs->pushUint8_t($this->cEstimateDispatch_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cStockState); // 序列化库存状态 link@   类型为uint8_t
			$bs->pushUint8_t($this->cStockState_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->setLimitArea,'stl_set'); // 序列化限运地域   类型为std::set<uint32_t> 
			$bs->pushUint8_t($this->cLimitArea_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->setCoverArea,'stl_set'); // 序列化覆盖地域   类型为std::set<uint32_t> 
			$bs->pushUint8_t($this->cCoverArea_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strLimitrule); // 序列化库存限运规则   类型为std::string
			$bs->pushUint8_t($this->cLimitrule_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwOrderNum); // 序列化库存购买总数,下单件数   类型为uint32_t
			$bs->pushUint8_t($this->cOrderNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSoldNum); // 序列化库存销售总数，订单流程走完的数量   类型为uint32_t
			$bs->pushUint8_t($this->cSoldNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwAddTime); // 序列化库存添加时间   类型为uint32_t
			$bs->pushUint8_t($this->cAddTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // 序列化库存最后修改时间   类型为uint32_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockPayedNum); // 序列化完成付款后的锁定数量  类型为uint32_t
			$bs->pushUint8_t($this->cStockPayedNum_u); // 序列化完成付款后的锁定数量 flag 类型为uint8_t
			$bs->pushString($this->strReverse); // 序列化保留字段  类型为std::string
			$bs->pushUint8_t($this->cReverse_u); // 序列化保留字段 flag 类型为uint8_t
			$bs->pushUint32_t($this->dwStockProPayedNum); // 序列化促销付款后的锁定数量  类型为uint32_t
			$bs->pushUint8_t($this->cStockProPayedNum_u); // 序列化促销付款后的锁定数量 flag 类型为uint8_t
			$bs->pushUint32_t($this->dwStockRealSynNum); // 序列化合作伙伴真实同步数量  类型为uint32_t
			$bs->pushUint8_t($this->cStockRealSynNum_u); // 序列化合作伙伴真实同步数量 flag 类型为uint8_t
			$bs->pushString($this->strStockPromotionDesc); // 序列化促销描述  类型为std::string
			$bs->pushUint8_t($this->cStockPromotionDesc_u); // 序列化促销描述 flag 类型为uint8_t
			$bs->pushObject($this->bitsetBitProperty,'stl_bitset'); // 序列化库存属性   类型为std::bitset<32> 
			$bs->pushUint8_t($this->cBitProperty_u); // 序列化库存属性 flag 类型为uint8_t
			$bs->pushObject($this->bitsetStockBitInclude,'stl_bitset'); // 序列化stock属性 include bit位 设置bit位  类型为std::bitset<32> 
			$bs->pushUint8_t($this->cStockBitInclude_u); // 序列化stock属性 include bit位 设置bit位 flag 类型为uint8_t
			$bs->pushObject($this->bitsetStockBitExclude,'stl_bitset'); // 序列化stock属性 include bit位 取消bit位 类型为std::bitset<32> 
			$bs->pushUint8_t($this->cStockBitExclude_u); // 序列化stock属性 include bit位 取消bit位 flag 类型为uint8_t
			$bs->pushUint32_t($this->dwStockMinBuyNum); // 序列化起购数量 最小购买数量  类型为uint32_t
			$bs->pushUint8_t($this->cStockMinBuyNum_u); // 序列化起购数量 最小购买数量 flag 类型为uint8_t
			$bs->pushUint32_t($this->dwStockMaxBuyNum); // 序列化限购数量 最大购买数量 相当于sku字段中的限购数量字段 类型为uint32_t
			$bs->pushUint8_t($this->cStockMaxBuyNum_u); // 序列化限购数量 最大购买数量 flag 类型为uint8_t
			$bs->pushUint32_t($this->dwStockSellMode); // 序列化合约机业务类型 类型为uint32_t
			$bs->pushUint8_t($this->cStockSellMode_u); // 序列化合约机业务类型 flag 类型为uint8_t
			$bs->pushUint32_t($this->dwStockBusinessCost); // 序列化业务成本 类型为uint32_t
			$bs->pushUint8_t($this->cStockBusinessCost_u); // 序列化业务成本 flag 类型为uint8_t
			$bs->pushUint32_t($this->dwStockLimitCode); // 序列化易迅限运规则编码，具体由易迅侧服务解释 类型为uint32_t
			$bs->pushUint8_t($this->cStockLimitCode_u); // 序列化易迅限运规则编码，具体由易迅侧服务解释 flag 类型为uint8_t
			$bs->pushUint32_t($this->dwPromotionType); // 序列化促销类型 0:普通/1:新品/2:特卖/3:进口/4:限时/5:人气/6:独家/7:首发 类型为uint32_t
			$bs->pushUint8_t($this->cPromotionType_u); // 序列化促销类型 0:普通/1:新品/2:特卖/3:进口/4:限时/5:人气/6:独家/7:首发 flag 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->cVersion = $bs->popUint8_t(); // 反序列化 版本号    类型为uint8_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwStockId = $bs->popUint64_t(); // 反序列化stockId,库存id   类型为uint64_t
			$this->cStockId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化sku id   类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStoreHouseId = $bs->popUint32_t(); // 反序列化仓库Id   类型为uint32_t
			$this->cStoreHouseId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strStoreHouseName = $bs->popString(); // 反序列化仓库名称 类型为std::string
			$this->cStoreHouseName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwCooperatorId = $bs->popUint64_t(); // 反序列化合作伙伴ID 主号+子号   类型为uint64_t
			$this->cCooperatorId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strCooperatorStockCode = $bs->popString(); // 反序列化供应商库存编码,内码   类型为std::string
			$this->cCooperatorStockCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strCooperatorBarCode = $bs->popString(); // 反序列化供应商商品条形码   类型为std::string
			$this->cCooperatorBarCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockPrice = $bs->popUint32_t(); // 反序列化库存价格，单位分   类型为uint32_t
			$this->cStockPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockPrePrice = $bs->popUint32_t(); // 反序列化库存上次价格   类型为uint32_t
			$this->cStockPrePrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockCostPrice = $bs->popUint32_t(); // 反序列化库存成本价格   类型为uint32_t
			$this->cStockCostPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockInitialNum = $bs->popUint32_t(); // 反序列化库存初始数量   类型为uint32_t
			$this->cStockInitialNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockVirtualNum = $bs->popUint32_t(); // 反序列化库存虚拟数量   类型为uint32_t
			$this->cStockVirtualNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockRealNum = $bs->popUint32_t(); // 反序列化库存实际数量   类型为uint32_t
			$this->cStockRealNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPromotionLockNum = $bs->popUint32_t(); // 反序列化库存活动锁定数   类型为uint32_t
			$this->cPromotionLockNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwNormalSellingLock = $bs->popUint32_t(); // 反序列化普通销售锁定增减   类型为uint32_t
			$this->cNormalSellingLock_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPromotionSellingLock = $bs->popUint32_t(); // 反序列化活动销售锁定增减   类型为uint32_t
			$this->cPromotionSellingLock_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strEstimateDispatch = $bs->popString(); // 反序列化预计发送天数-出货时间 仓库到物流的时间    类型为std::string
			$this->cEstimateDispatch_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cStockState = $bs->popUint8_t(); // 反序列化库存状态 link@   类型为uint8_t
			$this->cStockState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->setLimitArea = $bs->popObject('stl_set<uint32_t>'); // 反序列化限运地域   类型为std::set<uint32_t> 
			$this->cLimitArea_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->setCoverArea = $bs->popObject('stl_set<uint32_t>'); // 反序列化覆盖地域   类型为std::set<uint32_t> 
			$this->cCoverArea_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strLimitrule = $bs->popString(); // 反序列化库存限运规则   类型为std::string
			$this->cLimitrule_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwOrderNum = $bs->popUint32_t(); // 反序列化库存购买总数,下单件数   类型为uint32_t
			$this->cOrderNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSoldNum = $bs->popUint32_t(); // 反序列化库存销售总数，订单流程走完的数量   类型为uint32_t
			$this->cSoldNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwAddTime = $bs->popUint32_t(); // 反序列化库存添加时间   类型为uint32_t
			$this->cAddTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // 反序列化库存最后修改时间   类型为uint32_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockPayedNum = $bs->popUint32_t(); // 反序列化完成付款后的锁定数量  类型为uint32_t
			$this->cStockPayedNum_u = $bs->popUint8_t(); // 反序列化完成付款后的锁定数量 flag 类型为uint8_t
			$this->strReverse = $bs->popString(); // 反序列化保留字段  类型为std::string
			$this->cReverse_u = $bs->popUint8_t(); // 反序列化保留字段 flag 类型为uint8_t
			$this->dwStockProPayedNum = $bs->popUint32_t(); // 反序列化促销付款后的锁定数量  类型为uint32_t
			$this->cStockProPayedNum_u = $bs->popUint8_t(); // 反序列化促销付款后的锁定数量 flag 类型为uint8_t
			$this->dwStockRealSynNum = $bs->popUint32_t(); // 反序列化合作伙伴真实同步数量  类型为uint32_t
			$this->cStockRealSynNum_u = $bs->popUint8_t(); // 反序列化合作伙伴真实同步数量 flag 类型为uint8_t
			$this->strStockPromotionDesc = $bs->popString(); // 反序列化促销描述  类型为std::string
			$this->cStockPromotionDesc_u = $bs->popUint8_t(); // 反序列化促销描述 flag 类型为uint8_t
			$this->bitsetBitProperty = $bs->popObject('stl_bitset<32>'); // 反序列化库存属性   类型为std::bitset<32> 
			$this->cBitProperty_u = $bs->popUint8_t(); // 反序列化库存属性 flag 类型为uint8_t
			$this->bitsetStockBitInclude = $bs->popObject('stl_bitset<32>'); // 反序列化stock属性 include bit位 设置bit位  类型为std::bitset<32> 
			$this->cStockBitInclude_u = $bs->popUint8_t(); // 反序列化stock属性 include bit位 设置bit位 flag 类型为uint8_t
			$this->bitsetStockBitExclude = $bs->popObject('stl_bitset<32>'); // 反序列化stock属性 include bit位 取消bit位 类型为std::bitset<32> 
			$this->cStockBitExclude_u = $bs->popUint8_t(); // 反序列化stock属性 include bit位 取消bit位 flag 类型为uint8_t
			$this->dwStockMinBuyNum = $bs->popUint32_t(); // 反序列化起购数量 最小购买数量  类型为uint32_t
			$this->cStockMinBuyNum_u = $bs->popUint8_t(); // 反序列化起购数量 最小购买数量 flag 类型为uint8_t
			$this->dwStockMaxBuyNum = $bs->popUint32_t(); // 反序列化限购数量 最大购买数量 相当于sku字段中的限购数量字段 类型为uint32_t
			$this->cStockMaxBuyNum_u = $bs->popUint8_t(); // 反序列化限购数量 最大购买数量 flag 类型为uint8_t
			$this->dwStockSellMode = $bs->popUint32_t(); // 反序列化合约机业务类型 类型为uint32_t
			$this->cStockSellMode_u = $bs->popUint8_t(); // 反序列化合约机业务类型 flag 类型为uint8_t
			$this->dwStockBusinessCost = $bs->popUint32_t(); // 反序列化业务成本 类型为uint32_t
			$this->cStockBusinessCost_u = $bs->popUint8_t(); // 反序列化业务成本 flag 类型为uint8_t
			$this->dwStockLimitCode = $bs->popUint32_t(); // 反序列化易迅限运规则编码，具体由易迅侧服务解释 类型为uint32_t
			$this->cStockLimitCode_u = $bs->popUint8_t(); // 反序列化易迅限运规则编码，具体由易迅侧服务解释 flag 类型为uint8_t
			$this->dwPromotionType = $bs->popUint32_t(); // 反序列化促销类型 0:普通/1:新品/2:特卖/3:进口/4:限时/5:人气/6:独家/7:首发 类型为uint32_t
			$this->cPromotionType_u = $bs->popUint8_t(); // 反序列化促销类型 0:普通/1:新品/2:特卖/3:进口/4:限时/5:人气/6:独家/7:首发 flag 类型为uint8_t

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