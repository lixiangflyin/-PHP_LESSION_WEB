<?php

//source idl: com.b2b2c.account.ao.PointsAccountAo.java

if (!class_exists('PointsOutRespPo',false)) {
class PointsOutRespPo
{
		/**
		 * 版本号 
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 扣减促销积分值
		 *
		 * 版本 >= 0
		 */
		var $dwPromotionPoints; //uint32_t

		/**
		 * 扣减现金积分值
		 *
		 * 版本 >= 0
		 */
		var $dwCashPoints; //uint32_t

		/**
		 * 保留字段
		 *
		 * 版本 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPromotionPoints_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCashPoints_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->dwPromotionPoints = 0; // uint32_t
			 $this->dwCashPoints = 0; // uint32_t
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cPromotionPoints_u = 0; // uint8_t
			 $this->cCashPoints_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号  类型为uint32_t
			$bs->pushUint32_t($this->dwPromotionPoints); // 序列化扣减促销积分值 类型为uint32_t
			$bs->pushUint32_t($this->dwCashPoints); // 序列化扣减现金积分值 类型为uint32_t
			$bs->pushString($this->strReserve); // 序列化保留字段 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPromotionPoints_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCashPoints_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号  类型为uint32_t
			$this->dwPromotionPoints = $bs->popUint32_t(); // 反序列化扣减促销积分值 类型为uint32_t
			$this->dwCashPoints = $bs->popUint32_t(); // 反序列化扣减现金积分值 类型为uint32_t
			$this->strReserve = $bs->popString(); // 反序列化保留字段 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPromotionPoints_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCashPoints_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserve_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.b2b2c.account.ao.PointsAccountAo.java

if (!class_exists('PointsOutReqPo',false)) {
class PointsOutReqPo
{
		/**
		 * 版本号 
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 易迅id, 暂支持32位
		 *
		 * 版本 >= 0
		 */
		var $ddwIcsonUid; //uint64_t

		/**
		 * 促销积分总值
		 *
		 * 版本 >= 0
		 */
		var $dwPromotionPoints; //uint32_t

		/**
		 * 现金积分总值
		 *
		 * 版本 >= 0
		 */
		var $dwCashPoints; //uint32_t

		/**
		 * 积分明细类型(场景)
		 *
		 * 版本 >= 0
		 */
		var $dwType; //uint32_t

		/**
		 * 积分属性，保留
		 *
		 * 版本 >= 0
		 */
		var $dwProperty; //uint32_t

		/**
		 * 明细备注
		 *
		 * 版本 >= 0
		 */
		var $strRemarks; //std::string

		/**
		 * 订单号:下单原因扣减时，订单号必填, 其他不填
		 *
		 * 版本 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * 切换服务之前双写时，该字段填易迅网站生成的流水id， 其他保留
		 *
		 * 版本 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonUid_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPromotionPoints_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCashPoints_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cProperty_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRemarks_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->ddwIcsonUid = 0; // uint64_t
			 $this->dwPromotionPoints = 0; // uint32_t
			 $this->dwCashPoints = 0; // uint32_t
			 $this->dwType = 0; // uint32_t
			 $this->dwProperty = 0; // uint32_t
			 $this->strRemarks = ""; // std::string
			 $this->strDealId = ""; // std::string
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cIcsonUid_u = 0; // uint8_t
			 $this->cPromotionPoints_u = 0; // uint8_t
			 $this->cCashPoints_u = 0; // uint8_t
			 $this->cType_u = 0; // uint8_t
			 $this->cProperty_u = 0; // uint8_t
			 $this->cRemarks_u = 0; // uint8_t
			 $this->cDealId_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号  类型为uint32_t
			$bs->pushUint64_t($this->ddwIcsonUid); // 序列化易迅id, 暂支持32位 类型为uint64_t
			$bs->pushUint32_t($this->dwPromotionPoints); // 序列化促销积分总值 类型为uint32_t
			$bs->pushUint32_t($this->dwCashPoints); // 序列化现金积分总值 类型为uint32_t
			$bs->pushUint32_t($this->dwType); // 序列化积分明细类型(场景) 类型为uint32_t
			$bs->pushUint32_t($this->dwProperty); // 序列化积分属性，保留 类型为uint32_t
			$bs->pushString($this->strRemarks); // 序列化明细备注 类型为std::string
			$bs->pushString($this->strDealId); // 序列化订单号:下单原因扣减时，订单号必填, 其他不填 类型为std::string
			$bs->pushString($this->strReserve); // 序列化切换服务之前双写时，该字段填易迅网站生成的流水id， 其他保留 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonUid_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPromotionPoints_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCashPoints_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cProperty_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRemarks_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号  类型为uint32_t
			$this->ddwIcsonUid = $bs->popUint64_t(); // 反序列化易迅id, 暂支持32位 类型为uint64_t
			$this->dwPromotionPoints = $bs->popUint32_t(); // 反序列化促销积分总值 类型为uint32_t
			$this->dwCashPoints = $bs->popUint32_t(); // 反序列化现金积分总值 类型为uint32_t
			$this->dwType = $bs->popUint32_t(); // 反序列化积分明细类型(场景) 类型为uint32_t
			$this->dwProperty = $bs->popUint32_t(); // 反序列化积分属性，保留 类型为uint32_t
			$this->strRemarks = $bs->popString(); // 反序列化明细备注 类型为std::string
			$this->strDealId = $bs->popString(); // 反序列化订单号:下单原因扣减时，订单号必填, 其他不填 类型为std::string
			$this->strReserve = $bs->popString(); // 反序列化切换服务之前双写时，该字段填易迅网站生成的流水id， 其他保留 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonUid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPromotionPoints_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCashPoints_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRemarks_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserve_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.b2b2c.account.ao.PointsAccountAo.java

if (!class_exists('PointsOutPo',false)) {
class PointsOutPo
{
		/**
		 * 版本号 
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 易迅id, 暂支持32位
		 *
		 * 版本 >= 0
		 */
		var $ddwIcsonUid; //uint64_t

		/**
		 * 扣减积分值
		 *
		 * 版本 >= 0
		 */
		var $dwPoints; //uint32_t

		/**
		 * 积分明细类型(场景)
		 *
		 * 版本 >= 0
		 */
		var $dwType; //uint32_t

		/**
		 * 积分属性，保留
		 *
		 * 版本 >= 0
		 */
		var $dwProperty; //uint32_t

		/**
		 * 明细备注
		 *
		 * 版本 >= 0
		 */
		var $strRemarks; //std::string

		/**
		 * 切换服务之前双写时，该字段填易迅网站生成的流水id， 其他保留
		 *
		 * 版本 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonUid_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPoints_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cProperty_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRemarks_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->ddwIcsonUid = 0; // uint64_t
			 $this->dwPoints = 0; // uint32_t
			 $this->dwType = 0; // uint32_t
			 $this->dwProperty = 0; // uint32_t
			 $this->strRemarks = ""; // std::string
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cIcsonUid_u = 0; // uint8_t
			 $this->cPoints_u = 0; // uint8_t
			 $this->cType_u = 0; // uint8_t
			 $this->cProperty_u = 0; // uint8_t
			 $this->cRemarks_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号  类型为uint32_t
			$bs->pushUint64_t($this->ddwIcsonUid); // 序列化易迅id, 暂支持32位 类型为uint64_t
			$bs->pushUint32_t($this->dwPoints); // 序列化扣减积分值 类型为uint32_t
			$bs->pushUint32_t($this->dwType); // 序列化积分明细类型(场景) 类型为uint32_t
			$bs->pushUint32_t($this->dwProperty); // 序列化积分属性，保留 类型为uint32_t
			$bs->pushString($this->strRemarks); // 序列化明细备注 类型为std::string
			$bs->pushString($this->strReserve); // 序列化切换服务之前双写时，该字段填易迅网站生成的流水id， 其他保留 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonUid_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPoints_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cProperty_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRemarks_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号  类型为uint32_t
			$this->ddwIcsonUid = $bs->popUint64_t(); // 反序列化易迅id, 暂支持32位 类型为uint64_t
			$this->dwPoints = $bs->popUint32_t(); // 反序列化扣减积分值 类型为uint32_t
			$this->dwType = $bs->popUint32_t(); // 反序列化积分明细类型(场景) 类型为uint32_t
			$this->dwProperty = $bs->popUint32_t(); // 反序列化积分属性，保留 类型为uint32_t
			$this->strRemarks = $bs->popString(); // 反序列化明细备注 类型为std::string
			$this->strReserve = $bs->popString(); // 反序列化切换服务之前双写时，该字段填易迅网站生成的流水id， 其他保留 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonUid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPoints_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRemarks_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserve_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.b2b2c.account.ao.PointsAccountAo.java

if (!class_exists('PointsInPo',false)) {
class PointsInPo
{
		/**
		 * 版本号 
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 易迅id, 暂支持32位
		 *
		 * 版本 >= 0
		 */
		var $ddwIcsonUid; //uint64_t

		/**
		 * 积分明细类型(场景)
		 *
		 * 版本 >= 0
		 */
		var $dwType; //uint32_t

		/**
		 * 促销积分
		 *
		 * 版本 >= 0
		 */
		var $dwPromotionPoints; //uint32_t

		/**
		 * 现金积分(账户余额)
		 *
		 * 版本 >= 0
		 */
		var $dwCashPoints; //uint32_t

		/**
		 * 积分属性，保留
		 *
		 * 版本 >= 0
		 */
		var $dwProperty; //uint32_t

		/**
		 * 积分发放时间
		 *
		 * 版本 >= 0
		 */
		var $dwAddtime; //uint32_t

		/**
		 * 明细备注
		 *
		 * 版本 >= 0
		 */
		var $strRemarks; //std::string

		/**
		 * 切换服务之前双写时，该字段填易迅网站生成的流水id，其他保留
		 *
		 * 版本 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonUid_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPromotionPoints_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCashPoints_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cProperty_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cAddtime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRemarks_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * 订单号: 订单扣减后由于取消订单等原因补偿发放已被扣减的积分时，需填对应的扣减的订单号, 其他不填
		 *
		 * 版本 >= 20130401
		 */
		var $strDealId; //std::string

		/**
		 * 
		 *
		 * 版本 >= 20130401
		 */
		var $cDealId_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 20130401; // uint32_t
			 $this->ddwIcsonUid = 0; // uint64_t
			 $this->dwType = 0; // uint32_t
			 $this->dwPromotionPoints = 0; // uint32_t
			 $this->dwCashPoints = 0; // uint32_t
			 $this->dwProperty = 0; // uint32_t
			 $this->dwAddtime = 0; // uint32_t
			 $this->strRemarks = ""; // std::string
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cIcsonUid_u = 0; // uint8_t
			 $this->cType_u = 0; // uint8_t
			 $this->cPromotionPoints_u = 0; // uint8_t
			 $this->cCashPoints_u = 0; // uint8_t
			 $this->cProperty_u = 0; // uint8_t
			 $this->cAddtime_u = 0; // uint8_t
			 $this->cRemarks_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
			 $this->strDealId = ""; // std::string
			 $this->cDealId_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号  类型为uint32_t
			$bs->pushUint64_t($this->ddwIcsonUid); // 序列化易迅id, 暂支持32位 类型为uint64_t
			$bs->pushUint32_t($this->dwType); // 序列化积分明细类型(场景) 类型为uint32_t
			$bs->pushUint32_t($this->dwPromotionPoints); // 序列化促销积分 类型为uint32_t
			$bs->pushUint32_t($this->dwCashPoints); // 序列化现金积分(账户余额) 类型为uint32_t
			$bs->pushUint32_t($this->dwProperty); // 序列化积分属性，保留 类型为uint32_t
			$bs->pushUint32_t($this->dwAddtime); // 序列化积分发放时间 类型为uint32_t
			$bs->pushString($this->strRemarks); // 序列化明细备注 类型为std::string
			$bs->pushString($this->strReserve); // 序列化切换服务之前双写时，该字段填易迅网站生成的流水id，其他保留 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonUid_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPromotionPoints_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCashPoints_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cProperty_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cAddtime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRemarks_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
			if(  $this->dwVersion >= 20130401 ){
				$bs->pushString($this->strDealId); // 序列化订单号: 订单扣减后由于取消订单等原因补偿发放已被扣减的积分时，需填对应的扣减的订单号, 其他不填 类型为std::string
			}
			if(  $this->dwVersion >= 20130401 ){
				$bs->pushUint8_t($this->cDealId_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号  类型为uint32_t
			$this->ddwIcsonUid = $bs->popUint64_t(); // 反序列化易迅id, 暂支持32位 类型为uint64_t
			$this->dwType = $bs->popUint32_t(); // 反序列化积分明细类型(场景) 类型为uint32_t
			$this->dwPromotionPoints = $bs->popUint32_t(); // 反序列化促销积分 类型为uint32_t
			$this->dwCashPoints = $bs->popUint32_t(); // 反序列化现金积分(账户余额) 类型为uint32_t
			$this->dwProperty = $bs->popUint32_t(); // 反序列化积分属性，保留 类型为uint32_t
			$this->dwAddtime = $bs->popUint32_t(); // 反序列化积分发放时间 类型为uint32_t
			$this->strRemarks = $bs->popString(); // 反序列化明细备注 类型为std::string
			$this->strReserve = $bs->popString(); // 反序列化切换服务之前双写时，该字段填易迅网站生成的流水id，其他保留 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonUid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPromotionPoints_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCashPoints_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cAddtime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRemarks_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserve_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->dwVersion >= 20130401 ){
				$this->strDealId = $bs->popString(); // 反序列化订单号: 订单扣减后由于取消订单等原因补偿发放已被扣减的积分时，需填对应的扣减的订单号, 其他不填 类型为std::string
			}
			if(  $this->dwVersion >= 20130401 ){
				$this->cDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}

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


//source idl: com.b2b2c.account.ao.PointsDeliverReq.java

if (!class_exists('PointsAccessVerifyPo',false)) {
class PointsAccessVerifyPo
{
		/**
		 * 版本号 
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 账户的接入业务ID， 向积分后台开发人员申请
		 *
		 * 版本 >= 0
		 */
		var $dwAccessBussinessID; //uint32_t

		/**
		 * 操作者名,业务方控制，可用于后台查询入账的操作人员  
		 *
		 * 版本 >= 0
		 */
		var $strOperatorName; //std::string

		/**
		 * 操作校验码，接口安全考虑 ， 向积分后台开发人员申请
		 *
		 * 版本 >= 0
		 */
		var $strOperateVerifyCode; //std::string

		/**
		 * reserve  预留字段，无用  
		 *
		 * 版本 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cAccessBussinessID_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperatorName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperateVerifyCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->dwAccessBussinessID = 0; // uint32_t
			 $this->strOperatorName = ""; // std::string
			 $this->strOperateVerifyCode = ""; // std::string
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cAccessBussinessID_u = 0; // uint8_t
			 $this->cOperatorName_u = 0; // uint8_t
			 $this->cOperateVerifyCode_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号  类型为uint32_t
			$bs->pushUint32_t($this->dwAccessBussinessID); // 序列化账户的接入业务ID， 向积分后台开发人员申请 类型为uint32_t
			$bs->pushString($this->strOperatorName); // 序列化操作者名,业务方控制，可用于后台查询入账的操作人员   类型为std::string
			$bs->pushString($this->strOperateVerifyCode); // 序列化操作校验码，接口安全考虑 ， 向积分后台开发人员申请 类型为std::string
			$bs->pushString($this->strReserve); // 序列化reserve  预留字段，无用   类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cAccessBussinessID_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperatorName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperateVerifyCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号  类型为uint32_t
			$this->dwAccessBussinessID = $bs->popUint32_t(); // 反序列化账户的接入业务ID， 向积分后台开发人员申请 类型为uint32_t
			$this->strOperatorName = $bs->popString(); // 反序列化操作者名,业务方控制，可用于后台查询入账的操作人员   类型为std::string
			$this->strOperateVerifyCode = $bs->popString(); // 反序列化操作校验码，接口安全考虑 ， 向积分后台开发人员申请 类型为std::string
			$this->strReserve = $bs->popString(); // 反序列化reserve  预留字段，无用   类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cAccessBussinessID_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperatorName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperateVerifyCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserve_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.b2b2c.account.ao.PointsAccountAo.java

if (!class_exists('PointsAccountPo',false)) {
class PointsAccountPo
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 易迅id, 暂支持32位
		 *
		 * 版本 >= 0
		 */
		var $ddwIcsonUid; //uint64_t

		/**
		 * 可用积分总值, 等于promotionPoints+cashPoints的值
		 *
		 * 版本 >= 0
		 */
		var $dwTotalAvailablePoints; //uint32_t

		/**
		 * 促销积分总值
		 *
		 * 版本 >= 0
		 */
		var $dwPromotionPoints; //uint32_t

		/**
		 * 现金积分总值(账户余额)
		 *
		 * 版本 >= 0
		 */
		var $dwCashPoints; //uint32_t

		/**
		 * 积分属性值，保留
		 *
		 * 版本 >= 0
		 */
		var $dwProperty; //uint32_t

		/**
		 * reserve  预留字段，无用
		 *
		 * 版本 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonUid_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTotalAvailablePoints_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPromotionPoints_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCashPoints_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cProperty_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * 即将过期的促销积分值
		 *
		 * 版本 >= 20130401
		 */
		var $dwExpiringPromotionPoints; //uint32_t

		/**
		 * 即将过期的促销积分时间(秒)
		 *
		 * 版本 >= 20130401
		 */
		var $dwExpiringPromotionPointsTime; //uint32_t

		/**
		 * 
		 *
		 * 版本 >= 20130401
		 */
		var $cExpiringPromotionPoints_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 20130401
		 */
		var $cExpiringPromotionPointsTime_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 20130401; // uint32_t
			 $this->ddwIcsonUid = 0; // uint64_t
			 $this->dwTotalAvailablePoints = 0; // uint32_t
			 $this->dwPromotionPoints = 0; // uint32_t
			 $this->dwCashPoints = 0; // uint32_t
			 $this->dwProperty = 0; // uint32_t
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cIcsonUid_u = 0; // uint8_t
			 $this->cTotalAvailablePoints_u = 0; // uint8_t
			 $this->cPromotionPoints_u = 0; // uint8_t
			 $this->cCashPoints_u = 0; // uint8_t
			 $this->cProperty_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
			 $this->dwExpiringPromotionPoints = 0; // uint32_t
			 $this->dwExpiringPromotionPointsTime = 0; // uint32_t
			 $this->cExpiringPromotionPoints_u = 0; // uint8_t
			 $this->cExpiringPromotionPointsTime_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号 类型为uint32_t
			$bs->pushUint64_t($this->ddwIcsonUid); // 序列化易迅id, 暂支持32位 类型为uint64_t
			$bs->pushUint32_t($this->dwTotalAvailablePoints); // 序列化可用积分总值, 等于promotionPoints+cashPoints的值 类型为uint32_t
			$bs->pushUint32_t($this->dwPromotionPoints); // 序列化促销积分总值 类型为uint32_t
			$bs->pushUint32_t($this->dwCashPoints); // 序列化现金积分总值(账户余额) 类型为uint32_t
			$bs->pushUint32_t($this->dwProperty); // 序列化积分属性值，保留 类型为uint32_t
			$bs->pushString($this->strReserve); // 序列化reserve  预留字段，无用 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonUid_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTotalAvailablePoints_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPromotionPoints_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCashPoints_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cProperty_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
			if(  $this->dwVersion >= 20130401 ){
				$bs->pushUint32_t($this->dwExpiringPromotionPoints); // 序列化即将过期的促销积分值 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130401 ){
				$bs->pushUint32_t($this->dwExpiringPromotionPointsTime); // 序列化即将过期的促销积分时间(秒) 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130401 ){
				$bs->pushUint8_t($this->cExpiringPromotionPoints_u); // 序列化 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130401 ){
				$bs->pushUint8_t($this->cExpiringPromotionPointsTime_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号 类型为uint32_t
			$this->ddwIcsonUid = $bs->popUint64_t(); // 反序列化易迅id, 暂支持32位 类型为uint64_t
			$this->dwTotalAvailablePoints = $bs->popUint32_t(); // 反序列化可用积分总值, 等于promotionPoints+cashPoints的值 类型为uint32_t
			$this->dwPromotionPoints = $bs->popUint32_t(); // 反序列化促销积分总值 类型为uint32_t
			$this->dwCashPoints = $bs->popUint32_t(); // 反序列化现金积分总值(账户余额) 类型为uint32_t
			$this->dwProperty = $bs->popUint32_t(); // 反序列化积分属性值，保留 类型为uint32_t
			$this->strReserve = $bs->popString(); // 反序列化reserve  预留字段，无用 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonUid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTotalAvailablePoints_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPromotionPoints_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCashPoints_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserve_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->dwVersion >= 20130401 ){
				$this->dwExpiringPromotionPoints = $bs->popUint32_t(); // 反序列化即将过期的促销积分值 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130401 ){
				$this->dwExpiringPromotionPointsTime = $bs->popUint32_t(); // 反序列化即将过期的促销积分时间(秒) 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130401 ){
				$this->cExpiringPromotionPoints_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130401 ){
				$this->cExpiringPromotionPointsTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}

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


//source idl: com.b2b2c.account.ao.PointsAccountAo.java

if (!class_exists('PointsAccountDetailPoList',false)) {
class PointsAccountDetailPoList
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 易迅id, 暂支持32位
		 *
		 * 版本 >= 0
		 */
		var $ddwIcsonUid; //uint64_t

		/**
		 * 积分明细总数目
		 *
		 * 版本 >= 0
		 */
		var $dwDetailTotalNum; //uint32_t

		/**
		 * 积分明细列表
		 *
		 * 版本 >= 0
		 */
		var $vecPointsAccountDetailPoList; //std::vector<b2b2c::account::po::CPointsAccountDetailPo> 

		/**
		 * reserve  预留字段，无用
		 *
		 * 版本 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonUid_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDetailTotalNum_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPointsAccountDetailPoList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->ddwIcsonUid = 0; // uint64_t
			 $this->dwDetailTotalNum = 0; // uint32_t
			 $this->vecPointsAccountDetailPoList = new stl_vector('PointsAccountDetailPo'); // std::vector<b2b2c::account::po::CPointsAccountDetailPo> 
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cIcsonUid_u = 0; // uint8_t
			 $this->cDetailTotalNum_u = 0; // uint8_t
			 $this->cPointsAccountDetailPoList_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号 类型为uint32_t
			$bs->pushUint64_t($this->ddwIcsonUid); // 序列化易迅id, 暂支持32位 类型为uint64_t
			$bs->pushUint32_t($this->dwDetailTotalNum); // 序列化积分明细总数目 类型为uint32_t
			$bs->pushObject($this->vecPointsAccountDetailPoList,'stl_vector'); // 序列化积分明细列表 类型为std::vector<b2b2c::account::po::CPointsAccountDetailPo> 
			$bs->pushString($this->strReserve); // 序列化reserve  预留字段，无用 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonUid_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDetailTotalNum_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPointsAccountDetailPoList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号 类型为uint32_t
			$this->ddwIcsonUid = $bs->popUint64_t(); // 反序列化易迅id, 暂支持32位 类型为uint64_t
			$this->dwDetailTotalNum = $bs->popUint32_t(); // 反序列化积分明细总数目 类型为uint32_t
			$this->vecPointsAccountDetailPoList = $bs->popObject('stl_vector<PointsAccountDetailPo>'); // 反序列化积分明细列表 类型为std::vector<b2b2c::account::po::CPointsAccountDetailPo> 
			$this->strReserve = $bs->popString(); // 反序列化reserve  预留字段，无用 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonUid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDetailTotalNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPointsAccountDetailPoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserve_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.b2b2c.account.ao.PointsAccountDetailPoList.java

if (!class_exists('PointsAccountDetailPo',false)) {
class PointsAccountDetailPo
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 积分明细ID
		 *
		 * 版本 >= 0
		 */
		var $ddwDetailId; //uint64_t

		/**
		 * 账户总账可用积分值
		 *
		 * 版本 >= 0
		 */
		var $dwTotalAvailablePoints; //uint32_t

		/**
		 * 积分明细值， 负数代表扣减积分数，正数代表发放积分数
		 *
		 * 版本 >= 0
		 */
		var $nDetailPoints; //int

		/**
		 * 积分类型, 1：现金积分(账户余额)、2：促销积分
		 *
		 * 版本 >= 0
		 */
		var $dwPointsType; //uint32_t

		/**
		 * 积分明细类型(场景)
		 *
		 * 版本 >= 0
		 */
		var $dwDetailType; //uint32_t

		/**
		 * 积分明细状态：2：发放积分明细  5:已过期明细 6：扣减积分明细
		 *
		 * 版本 >= 0
		 */
		var $dwDetailState; //uint32_t

		/**
		 * 积分明细属性，保留
		 *
		 * 版本 >= 0
		 */
		var $dwDetailProperty; //uint32_t

		/**
		 * 积分明细添加时间
		 *
		 * 版本 >= 0
		 */
		var $dwDetailAddtime; //uint32_t

		/**
		 * 积分明细最后修改时间，时间区间查询依据的是此字段
		 *
		 * 版本 >= 0
		 */
		var $dwDetailLastmodifytime; //uint32_t

		/**
		 * 明细备注
		 *
		 * 版本 >= 0
		 */
		var $strRemarks; //std::string

		/**
		 * reserve  预留字段，无用
		 *
		 * 版本 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDetailId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTotalAvailablePoints_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDetailPoints_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPointsType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDetailType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDetailState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDetailProperty_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDetailAddtime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDetailLastmodifytime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRemarks_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * 过期时间，只针对促销积分
		 *
		 * 版本 >= 20130401
		 */
		var $dwExpiredTime; //uint32_t

		/**
		 * 
		 *
		 * 版本 >= 20130401
		 */
		var $cExpiredTime_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 20130401; // uint32_t
			 $this->ddwDetailId = 0; // uint64_t
			 $this->dwTotalAvailablePoints = 0; // uint32_t
			 $this->nDetailPoints = 0; // int
			 $this->dwPointsType = 0; // uint32_t
			 $this->dwDetailType = 0; // uint32_t
			 $this->dwDetailState = 0; // uint32_t
			 $this->dwDetailProperty = 0; // uint32_t
			 $this->dwDetailAddtime = 0; // uint32_t
			 $this->dwDetailLastmodifytime = 0; // uint32_t
			 $this->strRemarks = ""; // std::string
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cDetailId_u = 0; // uint8_t
			 $this->cTotalAvailablePoints_u = 0; // uint8_t
			 $this->cDetailPoints_u = 0; // uint8_t
			 $this->cPointsType_u = 0; // uint8_t
			 $this->cDetailType_u = 0; // uint8_t
			 $this->cDetailState_u = 0; // uint8_t
			 $this->cDetailProperty_u = 0; // uint8_t
			 $this->cDetailAddtime_u = 0; // uint8_t
			 $this->cDetailLastmodifytime_u = 0; // uint8_t
			 $this->cRemarks_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
			 $this->dwExpiredTime = 0; // uint32_t
			 $this->cExpiredTime_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号 类型为uint32_t
			$bs->pushUint64_t($this->ddwDetailId); // 序列化积分明细ID 类型为uint64_t
			$bs->pushUint32_t($this->dwTotalAvailablePoints); // 序列化账户总账可用积分值 类型为uint32_t
			$bs->pushInt32_t($this->nDetailPoints); // 序列化积分明细值， 负数代表扣减积分数，正数代表发放积分数 类型为int
			$bs->pushUint32_t($this->dwPointsType); // 序列化积分类型, 1：现金积分(账户余额)、2：促销积分 类型为uint32_t
			$bs->pushUint32_t($this->dwDetailType); // 序列化积分明细类型(场景) 类型为uint32_t
			$bs->pushUint32_t($this->dwDetailState); // 序列化积分明细状态：2：发放积分明细  5:已过期明细 6：扣减积分明细 类型为uint32_t
			$bs->pushUint32_t($this->dwDetailProperty); // 序列化积分明细属性，保留 类型为uint32_t
			$bs->pushUint32_t($this->dwDetailAddtime); // 序列化积分明细添加时间 类型为uint32_t
			$bs->pushUint32_t($this->dwDetailLastmodifytime); // 序列化积分明细最后修改时间，时间区间查询依据的是此字段 类型为uint32_t
			$bs->pushString($this->strRemarks); // 序列化明细备注 类型为std::string
			$bs->pushString($this->strReserve); // 序列化reserve  预留字段，无用 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDetailId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTotalAvailablePoints_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDetailPoints_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPointsType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDetailType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDetailState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDetailProperty_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDetailAddtime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDetailLastmodifytime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRemarks_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
			if(  $this->dwVersion >= 20130401 ){
				$bs->pushUint32_t($this->dwExpiredTime); // 序列化过期时间，只针对促销积分 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130401 ){
				$bs->pushUint8_t($this->cExpiredTime_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号 类型为uint32_t
			$this->ddwDetailId = $bs->popUint64_t(); // 反序列化积分明细ID 类型为uint64_t
			$this->dwTotalAvailablePoints = $bs->popUint32_t(); // 反序列化账户总账可用积分值 类型为uint32_t
			$this->nDetailPoints = $bs->popInt32_t(); // 反序列化积分明细值， 负数代表扣减积分数，正数代表发放积分数 类型为int
			$this->dwPointsType = $bs->popUint32_t(); // 反序列化积分类型, 1：现金积分(账户余额)、2：促销积分 类型为uint32_t
			$this->dwDetailType = $bs->popUint32_t(); // 反序列化积分明细类型(场景) 类型为uint32_t
			$this->dwDetailState = $bs->popUint32_t(); // 反序列化积分明细状态：2：发放积分明细  5:已过期明细 6：扣减积分明细 类型为uint32_t
			$this->dwDetailProperty = $bs->popUint32_t(); // 反序列化积分明细属性，保留 类型为uint32_t
			$this->dwDetailAddtime = $bs->popUint32_t(); // 反序列化积分明细添加时间 类型为uint32_t
			$this->dwDetailLastmodifytime = $bs->popUint32_t(); // 反序列化积分明细最后修改时间，时间区间查询依据的是此字段 类型为uint32_t
			$this->strRemarks = $bs->popString(); // 反序列化明细备注 类型为std::string
			$this->strReserve = $bs->popString(); // 反序列化reserve  预留字段，无用 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDetailId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTotalAvailablePoints_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDetailPoints_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPointsType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDetailType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDetailState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDetailProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDetailAddtime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDetailLastmodifytime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRemarks_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserve_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->dwVersion >= 20130401 ){
				$this->dwExpiredTime = $bs->popUint32_t(); // 反序列化过期时间，只针对促销积分 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130401 ){
				$this->cExpiredTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}

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


//source idl: com.b2b2c.account.ao.PointsAccountAo.java

if (!class_exists('PointsAccountDetailFilterPo',false)) {
class PointsAccountDetailFilterPo
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 易迅id, 暂支持32位
		 *
		 * 版本 >= 0
		 */
		var $ddwIcsonUid; //uint64_t

		/**
		 * 积分类型, 1：现金积分(现金余额)、2：促销积分  默认0，查找所有积分明细
		 *
		 * 版本 >= 0
		 */
		var $dwPointsType; //uint32_t

		/**
		 * 积分明细类型(场景)
		 *
		 * 版本 >= 0
		 */
		var $dwDetailType; //uint32_t

		/**
		 * 积分明细状态, 0：查询所有状态明细, 2：发放积分明细  5:已过期明细 6：扣减积分明细  
		 *
		 * 版本 >= 0
		 */
		var $dwDetailState; //uint32_t

		/**
		 * 分页查询，页码，从0开始
		 *
		 * 版本 >= 0
		 */
		var $dwPageid; //uint32_t

		/**
		 * 分页查询，页大小，必须大于0，值不建议太大，影响查询效率，积分后台限制最大值20
		 *
		 * 版本 >= 0
		 */
		var $dwPagesize; //uint32_t

		/**
		 * 查询时间区间，起始时间
		 *
		 * 版本 >= 0
		 */
		var $dwStartTime; //uint32_t

		/**
		 * 查询时间区间，结束时间
		 *
		 * 版本 >= 0
		 */
		var $dwEndTime; //uint32_t

		/**
		 * reserve  预留字段，无用
		 *
		 * 版本 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonUid_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPointsType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDetailType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDetailState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPageid_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPagesize_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cStartTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cEndTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->ddwIcsonUid = 0; // uint64_t
			 $this->dwPointsType = 0; // uint32_t
			 $this->dwDetailType = 0; // uint32_t
			 $this->dwDetailState = 0; // uint32_t
			 $this->dwPageid = 0; // uint32_t
			 $this->dwPagesize = 0; // uint32_t
			 $this->dwStartTime = 0; // uint32_t
			 $this->dwEndTime = 0; // uint32_t
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cIcsonUid_u = 0; // uint8_t
			 $this->cPointsType_u = 0; // uint8_t
			 $this->cDetailType_u = 0; // uint8_t
			 $this->cDetailState_u = 0; // uint8_t
			 $this->cPageid_u = 0; // uint8_t
			 $this->cPagesize_u = 0; // uint8_t
			 $this->cStartTime_u = 0; // uint8_t
			 $this->cEndTime_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号 类型为uint32_t
			$bs->pushUint64_t($this->ddwIcsonUid); // 序列化易迅id, 暂支持32位 类型为uint64_t
			$bs->pushUint32_t($this->dwPointsType); // 序列化积分类型, 1：现金积分(现金余额)、2：促销积分  默认0，查找所有积分明细 类型为uint32_t
			$bs->pushUint32_t($this->dwDetailType); // 序列化积分明细类型(场景) 类型为uint32_t
			$bs->pushUint32_t($this->dwDetailState); // 序列化积分明细状态, 0：查询所有状态明细, 2：发放积分明细  5:已过期明细 6：扣减积分明细   类型为uint32_t
			$bs->pushUint32_t($this->dwPageid); // 序列化分页查询，页码，从0开始 类型为uint32_t
			$bs->pushUint32_t($this->dwPagesize); // 序列化分页查询，页大小，必须大于0，值不建议太大，影响查询效率，积分后台限制最大值20 类型为uint32_t
			$bs->pushUint32_t($this->dwStartTime); // 序列化查询时间区间，起始时间 类型为uint32_t
			$bs->pushUint32_t($this->dwEndTime); // 序列化查询时间区间，结束时间 类型为uint32_t
			$bs->pushString($this->strReserve); // 序列化reserve  预留字段，无用 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonUid_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPointsType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDetailType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDetailState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPageid_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPagesize_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cStartTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cEndTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号 类型为uint32_t
			$this->ddwIcsonUid = $bs->popUint64_t(); // 反序列化易迅id, 暂支持32位 类型为uint64_t
			$this->dwPointsType = $bs->popUint32_t(); // 反序列化积分类型, 1：现金积分(现金余额)、2：促销积分  默认0，查找所有积分明细 类型为uint32_t
			$this->dwDetailType = $bs->popUint32_t(); // 反序列化积分明细类型(场景) 类型为uint32_t
			$this->dwDetailState = $bs->popUint32_t(); // 反序列化积分明细状态, 0：查询所有状态明细, 2：发放积分明细  5:已过期明细 6：扣减积分明细   类型为uint32_t
			$this->dwPageid = $bs->popUint32_t(); // 反序列化分页查询，页码，从0开始 类型为uint32_t
			$this->dwPagesize = $bs->popUint32_t(); // 反序列化分页查询，页大小，必须大于0，值不建议太大，影响查询效率，积分后台限制最大值20 类型为uint32_t
			$this->dwStartTime = $bs->popUint32_t(); // 反序列化查询时间区间，起始时间 类型为uint32_t
			$this->dwEndTime = $bs->popUint32_t(); // 反序列化查询时间区间，结束时间 类型为uint32_t
			$this->strReserve = $bs->popString(); // 反序列化reserve  预留字段，无用 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonUid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPointsType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDetailType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDetailState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPageid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPagesize_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cStartTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cEndTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserve_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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