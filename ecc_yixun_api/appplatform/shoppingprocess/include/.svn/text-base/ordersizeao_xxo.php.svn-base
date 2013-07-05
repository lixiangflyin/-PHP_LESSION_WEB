<?php

//source idl: com.oms.ordersize.idl.GetStockResp.java

if (!class_exists('StockPo', false)) {
class StockPo
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
		 * 规则id 必填
		 *
		 * 版本 >= 0
		 */
		var $ddwRuleId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cRuleId_u; //uint8_t

		/**
		 * 仓ID
		 *
		 * 版本 >= 0
		 */
		var $ddwStockSysno; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cStockSysno_u; //uint8_t

		/**
		 *  仓属性信息 
		 *
		 * 版本 >= 0
		 */
		var $dwStockProperty; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockProperty_u; //uint8_t

		/**
		 * 保留字段dw
		 *
		 * 版本 >= 0
		 */
		var $ddwReserveDdw; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cReserveDdw_u; //uint8_t

		/**
		 * 保留字段str
		 *
		 * 版本 >= 0
		 */
		var $strReserveStr; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cReserveStr_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->ddwRuleId = 0; // uint64_t
			 $this->cRuleId_u = 0; // uint8_t
			 $this->ddwStockSysno = 0; // uint64_t
			 $this->cStockSysno_u = 0; // uint8_t
			 $this->dwStockProperty = 0; // uint32_t
			 $this->cStockProperty_u = 0; // uint8_t
			 $this->ddwReserveDdw = 0; // uint64_t
			 $this->cReserveDdw_u = 0; // uint8_t
			 $this->strReserveStr = ""; // std::string
			 $this->cReserveStr_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号  类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwRuleId); // 序列化规则id 必填 类型为uint64_t
			$bs->pushUint8_t($this->cRuleId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwStockSysno); // 序列化仓ID 类型为uint64_t
			$bs->pushUint8_t($this->cStockSysno_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockProperty); // 序列化 仓属性信息  类型为uint32_t
			$bs->pushUint8_t($this->cStockProperty_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwReserveDdw); // 序列化保留字段dw 类型为uint64_t
			$bs->pushUint8_t($this->cReserveDdw_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strReserveStr); // 序列化保留字段str 类型为std::string
			$bs->pushUint8_t($this->cReserveStr_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号  类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwRuleId = $bs->popUint64_t(); // 反序列化规则id 必填 类型为uint64_t
			$this->cRuleId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwStockSysno = $bs->popUint64_t(); // 反序列化仓ID 类型为uint64_t
			$this->cStockSysno_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockProperty = $bs->popUint32_t(); // 反序列化 仓属性信息  类型为uint32_t
			$this->cStockProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwReserveDdw = $bs->popUint64_t(); // 反序列化保留字段dw 类型为uint64_t
			$this->cReserveDdw_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strReserveStr = $bs->popString(); // 反序列化保留字段str 类型为std::string
			$this->cReserveStr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.oms.ordersize.idl.GetRuleResp.java

if (!class_exists('RulePo', false)) {
class RulePo
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
		 * 规则id 必填
		 *
		 * 版本 >= 0
		 */
		var $ddwRuleId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cRuleId_u; //uint8_t

		/**
		 * sizetype
		 *
		 * 版本 >= 0
		 */
		var $dwSizeType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSizeType_u; //uint8_t

		/**
		 * 最大体积
		 *
		 * 版本 >= 0
		 */
		var $ddwVolumeMax; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cVolumeMax_u; //uint8_t

		/**
		 * 最小体积
		 *
		 * 版本 >= 0
		 */
		var $ddwVolumeMin; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cVolumeMin_u; //uint8_t

		/**
		 * 最大重量
		 *
		 * 版本 >= 0
		 */
		var $ddwWeightMax; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cWeightMax_u; //uint8_t

		/**
		 * 最小重量
		 *
		 * 版本 >= 0
		 */
		var $ddwWeightMin; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cWeightMin_u; //uint8_t

		/**
		 * 最大长度
		 *
		 * 版本 >= 0
		 */
		var $ddwMaxlengthMax; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cMaxlengthMax_u; //uint8_t

		/**
		 * 最小长度
		 *
		 * 版本 >= 0
		 */
		var $ddwMaxlengthMin; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cMaxlengthMin_u; //uint8_t

		/**
		 * 保留字段dw
		 *
		 * 版本 >= 0
		 */
		var $ddwReserveDdw; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cReserveDdw_u; //uint8_t

		/**
		 * 保留字段str
		 *
		 * 版本 >= 0
		 */
		var $strReserveStr; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cReserveStr_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->ddwRuleId = 0; // uint64_t
			 $this->cRuleId_u = 0; // uint8_t
			 $this->dwSizeType = 0; // uint32_t
			 $this->cSizeType_u = 0; // uint8_t
			 $this->ddwVolumeMax = 0; // uint64_t
			 $this->cVolumeMax_u = 0; // uint8_t
			 $this->ddwVolumeMin = 0; // uint64_t
			 $this->cVolumeMin_u = 0; // uint8_t
			 $this->ddwWeightMax = 0; // uint64_t
			 $this->cWeightMax_u = 0; // uint8_t
			 $this->ddwWeightMin = 0; // uint64_t
			 $this->cWeightMin_u = 0; // uint8_t
			 $this->ddwMaxlengthMax = 0; // uint64_t
			 $this->cMaxlengthMax_u = 0; // uint8_t
			 $this->ddwMaxlengthMin = 0; // uint64_t
			 $this->cMaxlengthMin_u = 0; // uint8_t
			 $this->ddwReserveDdw = 0; // uint64_t
			 $this->cReserveDdw_u = 0; // uint8_t
			 $this->strReserveStr = ""; // std::string
			 $this->cReserveStr_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号  类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwRuleId); // 序列化规则id 必填 类型为uint64_t
			$bs->pushUint8_t($this->cRuleId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSizeType); // 序列化sizetype 类型为uint32_t
			$bs->pushUint8_t($this->cSizeType_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwVolumeMax); // 序列化最大体积 类型为uint64_t
			$bs->pushUint8_t($this->cVolumeMax_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwVolumeMin); // 序列化最小体积 类型为uint64_t
			$bs->pushUint8_t($this->cVolumeMin_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwWeightMax); // 序列化最大重量 类型为uint64_t
			$bs->pushUint8_t($this->cWeightMax_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwWeightMin); // 序列化最小重量 类型为uint64_t
			$bs->pushUint8_t($this->cWeightMin_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwMaxlengthMax); // 序列化最大长度 类型为uint64_t
			$bs->pushUint8_t($this->cMaxlengthMax_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwMaxlengthMin); // 序列化最小长度 类型为uint64_t
			$bs->pushUint8_t($this->cMaxlengthMin_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwReserveDdw); // 序列化保留字段dw 类型为uint64_t
			$bs->pushUint8_t($this->cReserveDdw_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strReserveStr); // 序列化保留字段str 类型为std::string
			$bs->pushUint8_t($this->cReserveStr_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号  类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwRuleId = $bs->popUint64_t(); // 反序列化规则id 必填 类型为uint64_t
			$this->cRuleId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSizeType = $bs->popUint32_t(); // 反序列化sizetype 类型为uint32_t
			$this->cSizeType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwVolumeMax = $bs->popUint64_t(); // 反序列化最大体积 类型为uint64_t
			$this->cVolumeMax_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwVolumeMin = $bs->popUint64_t(); // 反序列化最小体积 类型为uint64_t
			$this->cVolumeMin_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwWeightMax = $bs->popUint64_t(); // 反序列化最大重量 类型为uint64_t
			$this->cWeightMax_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwWeightMin = $bs->popUint64_t(); // 反序列化最小重量 类型为uint64_t
			$this->cWeightMin_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwMaxlengthMax = $bs->popUint64_t(); // 反序列化最大长度 类型为uint64_t
			$this->cMaxlengthMax_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwMaxlengthMin = $bs->popUint64_t(); // 反序列化最小长度 类型为uint64_t
			$this->cMaxlengthMin_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwReserveDdw = $bs->popUint64_t(); // 反序列化保留字段dw 类型为uint64_t
			$this->cReserveDdw_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strReserveStr = $bs->popString(); // 反序列化保留字段str 类型为std::string
			$this->cReserveStr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.oms.ordersize.idl.CalOrderSizeResp.java

if (!class_exists('OrderSizePo', false)) {
class OrderSizePo
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
		 *  ID 用来区分不同单，必填 
		 *
		 * 版本 >= 0
		 */
		var $ddwId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cId_u; //uint8_t

		/**
		 *  订单类型(大件订单、中件订单、小件订单) 
		 *
		 * 版本 >= 0
		 */
		var $dwOrderSize; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cOrderSize_u; //uint8_t

		/**
		 *  订单总体积 立方厘米
		 *
		 * 版本 >= 0
		 */
		var $ddwOrderVolume; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cOrderVolume_u; //uint8_t

		/**
		 *  订单总重量 克 
		 *
		 * 版本 >= 0
		 */
		var $ddwOrderWeight; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cOrderWeight_u; //uint8_t

		/**
		 *  订单最长边 毫米 
		 *
		 * 版本 >= 0
		 */
		var $ddwOrderLongest; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cOrderLongest_u; //uint8_t

		/**
		 * 保留字段dw
		 *
		 * 版本 >= 0
		 */
		var $ddwReserveDdw; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cReserveDdw_u; //uint8_t

		/**
		 * 保留字段str
		 *
		 * 版本 >= 0
		 */
		var $strReserveStr; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cReserveStr_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->ddwId = 0; // uint64_t
			 $this->cId_u = 0; // uint8_t
			 $this->dwOrderSize = 0; // uint32_t
			 $this->cOrderSize_u = 0; // uint8_t
			 $this->ddwOrderVolume = 0; // uint64_t
			 $this->cOrderVolume_u = 0; // uint8_t
			 $this->ddwOrderWeight = 0; // uint64_t
			 $this->cOrderWeight_u = 0; // uint8_t
			 $this->ddwOrderLongest = 0; // uint64_t
			 $this->cOrderLongest_u = 0; // uint8_t
			 $this->ddwReserveDdw = 0; // uint64_t
			 $this->cReserveDdw_u = 0; // uint8_t
			 $this->strReserveStr = ""; // std::string
			 $this->cReserveStr_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号  类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwId); // 序列化 ID 用来区分不同单，必填  类型为uint64_t
			$bs->pushUint8_t($this->cId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwOrderSize); // 序列化 订单类型(大件订单、中件订单、小件订单)  类型为uint32_t
			$bs->pushUint8_t($this->cOrderSize_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwOrderVolume); // 序列化 订单总体积 立方厘米 类型为uint64_t
			$bs->pushUint8_t($this->cOrderVolume_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwOrderWeight); // 序列化 订单总重量 克  类型为uint64_t
			$bs->pushUint8_t($this->cOrderWeight_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwOrderLongest); // 序列化 订单最长边 毫米  类型为uint64_t
			$bs->pushUint8_t($this->cOrderLongest_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwReserveDdw); // 序列化保留字段dw 类型为uint64_t
			$bs->pushUint8_t($this->cReserveDdw_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strReserveStr); // 序列化保留字段str 类型为std::string
			$bs->pushUint8_t($this->cReserveStr_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号  类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwId = $bs->popUint64_t(); // 反序列化 ID 用来区分不同单，必填  类型为uint64_t
			$this->cId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwOrderSize = $bs->popUint32_t(); // 反序列化 订单类型(大件订单、中件订单、小件订单)  类型为uint32_t
			$this->cOrderSize_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwOrderVolume = $bs->popUint64_t(); // 反序列化 订单总体积 立方厘米 类型为uint64_t
			$this->cOrderVolume_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwOrderWeight = $bs->popUint64_t(); // 反序列化 订单总重量 克  类型为uint64_t
			$this->cOrderWeight_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwOrderLongest = $bs->popUint64_t(); // 反序列化 订单最长边 毫米  类型为uint64_t
			$this->cOrderLongest_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwReserveDdw = $bs->popUint64_t(); // 反序列化保留字段dw 类型为uint64_t
			$this->cReserveDdw_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strReserveStr = $bs->popString(); // 反序列化保留字段str 类型为std::string
			$this->cReserveStr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.oms.ordersize.idl.CalOrderSizeReq.java

if (!class_exists('OrderPo', false)) {
class OrderPo
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
		 *  ID 用来区分不同单，必填 
		 *
		 * 版本 >= 0
		 */
		var $ddwId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cId_u; //uint8_t

		/**
		 *  仓ID，必填 
		 *
		 * 版本 >= 0
		 */
		var $ddwStockSysno; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cStockSysno_u; //uint8_t

		/**
		 *  商品信息，必填 
		 *
		 * 版本 >= 0
		 */
		var $vecProductUnitPo; //std::vector<oms::ordersize::po::CProductUnitPo> 

		/**
		 * 版本 >= 0
		 */
		var $cProductUnitPo_u; //uint8_t

		/**
		 * 保留字段dw
		 *
		 * 版本 >= 0
		 */
		var $ddwReserveDdw; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cReserveDdw_u; //uint8_t

		/**
		 * 保留字段str
		 *
		 * 版本 >= 0
		 */
		var $strReserveStr; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cReserveStr_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->ddwId = 0; // uint64_t
			 $this->cId_u = 0; // uint8_t
			 $this->ddwStockSysno = 0; // uint64_t
			 $this->cStockSysno_u = 0; // uint8_t
			 $this->vecProductUnitPo = new stl_vector('ProductUnitPo'); // std::vector<oms::ordersize::po::CProductUnitPo> 
			 $this->cProductUnitPo_u = 0; // uint8_t
			 $this->ddwReserveDdw = 0; // uint64_t
			 $this->cReserveDdw_u = 0; // uint8_t
			 $this->strReserveStr = ""; // std::string
			 $this->cReserveStr_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号  类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwId); // 序列化 ID 用来区分不同单，必填  类型为uint64_t
			$bs->pushUint8_t($this->cId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwStockSysno); // 序列化 仓ID，必填  类型为uint64_t
			$bs->pushUint8_t($this->cStockSysno_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecProductUnitPo,'stl_vector'); // 序列化 商品信息，必填  类型为std::vector<oms::ordersize::po::CProductUnitPo> 
			$bs->pushUint8_t($this->cProductUnitPo_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwReserveDdw); // 序列化保留字段dw 类型为uint64_t
			$bs->pushUint8_t($this->cReserveDdw_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strReserveStr); // 序列化保留字段str 类型为std::string
			$bs->pushUint8_t($this->cReserveStr_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号  类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwId = $bs->popUint64_t(); // 反序列化 ID 用来区分不同单，必填  类型为uint64_t
			$this->cId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwStockSysno = $bs->popUint64_t(); // 反序列化 仓ID，必填  类型为uint64_t
			$this->cStockSysno_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecProductUnitPo = $bs->popObject('stl_vector<ProductUnitPo>'); // 反序列化 商品信息，必填  类型为std::vector<oms::ordersize::po::CProductUnitPo> 
			$this->cProductUnitPo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwReserveDdw = $bs->popUint64_t(); // 反序列化保留字段dw 类型为uint64_t
			$this->cReserveDdw_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strReserveStr = $bs->popString(); // 反序列化保留字段str 类型为std::string
			$this->cReserveStr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.oms.ordersize.idl.OrderPo.java

if (!class_exists('ProductUnitPo', false)) {
class ProductUnitPo
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
		 *  商品ID，必填 
		 *
		 * 版本 >= 0
		 */
		var $ddwProductSysno; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cProductSysno_u; //uint8_t

		/**
		 *  商品数量，必填 
		 *
		 * 版本 >= 0
		 */
		var $dwProductNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cProductNum_u; //uint8_t

		/**
		 *  商品长度，单位毫米 
		 *
		 * 版本 >= 0
		 */
		var $ddwProductLength; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cProductLength_u; //uint8_t

		/**
		 *  商品宽度，单位毫米 
		 *
		 * 版本 >= 0
		 */
		var $ddwProductWidth; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cProductWidth_u; //uint8_t

		/**
		 *  商品高度，单位毫米 
		 *
		 * 版本 >= 0
		 */
		var $ddwProductHeight; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cProductHeight_u; //uint8_t

		/**
		 *  商品  重量 克 
		 *
		 * 版本 >= 0
		 */
		var $dwProductWeight; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cProductWeight_u; //uint8_t

		/**
		 * 保留字段dw
		 *
		 * 版本 >= 0
		 */
		var $ddwReserveDdw; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cReserveDdw_u; //uint8_t

		/**
		 * 保留字段str
		 *
		 * 版本 >= 0
		 */
		var $strReserveStr; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cReserveStr_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->ddwProductSysno = 0; // uint64_t
			 $this->cProductSysno_u = 0; // uint8_t
			 $this->dwProductNum = 0; // uint32_t
			 $this->cProductNum_u = 0; // uint8_t
			 $this->ddwProductLength = 0; // uint64_t
			 $this->cProductLength_u = 0; // uint8_t
			 $this->ddwProductWidth = 0; // uint64_t
			 $this->cProductWidth_u = 0; // uint8_t
			 $this->ddwProductHeight = 0; // uint64_t
			 $this->cProductHeight_u = 0; // uint8_t
			 $this->dwProductWeight = 0; // uint32_t
			 $this->cProductWeight_u = 0; // uint8_t
			 $this->ddwReserveDdw = 0; // uint64_t
			 $this->cReserveDdw_u = 0; // uint8_t
			 $this->strReserveStr = ""; // std::string
			 $this->cReserveStr_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号  类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwProductSysno); // 序列化 商品ID，必填  类型为uint64_t
			$bs->pushUint8_t($this->cProductSysno_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwProductNum); // 序列化 商品数量，必填  类型为uint32_t
			$bs->pushUint8_t($this->cProductNum_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwProductLength); // 序列化 商品长度，单位毫米  类型为uint64_t
			$bs->pushUint8_t($this->cProductLength_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwProductWidth); // 序列化 商品宽度，单位毫米  类型为uint64_t
			$bs->pushUint8_t($this->cProductWidth_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwProductHeight); // 序列化 商品高度，单位毫米  类型为uint64_t
			$bs->pushUint8_t($this->cProductHeight_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwProductWeight); // 序列化 商品  重量 克  类型为uint32_t
			$bs->pushUint8_t($this->cProductWeight_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwReserveDdw); // 序列化保留字段dw 类型为uint64_t
			$bs->pushUint8_t($this->cReserveDdw_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strReserveStr); // 序列化保留字段str 类型为std::string
			$bs->pushUint8_t($this->cReserveStr_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号  类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwProductSysno = $bs->popUint64_t(); // 反序列化 商品ID，必填  类型为uint64_t
			$this->cProductSysno_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwProductNum = $bs->popUint32_t(); // 反序列化 商品数量，必填  类型为uint32_t
			$this->cProductNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwProductLength = $bs->popUint64_t(); // 反序列化 商品长度，单位毫米  类型为uint64_t
			$this->cProductLength_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwProductWidth = $bs->popUint64_t(); // 反序列化 商品宽度，单位毫米  类型为uint64_t
			$this->cProductWidth_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwProductHeight = $bs->popUint64_t(); // 反序列化 商品高度，单位毫米  类型为uint64_t
			$this->cProductHeight_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwProductWeight = $bs->popUint32_t(); // 反序列化 商品  重量 克  类型为uint32_t
			$this->cProductWeight_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwReserveDdw = $bs->popUint64_t(); // 反序列化保留字段dw 类型为uint64_t
			$this->cReserveDdw_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strReserveStr = $bs->popString(); // 反序列化保留字段str 类型为std::string
			$this->cReserveStr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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