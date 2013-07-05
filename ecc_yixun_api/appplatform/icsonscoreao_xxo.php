<?php

//source idl: icson.score.ao.ScoreSubReq.java

if (!class_exists('SubScorePo',false)) {
class SubScorePo
{
		/**
		 * 版本号 
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 扣减积分的易迅id, 暂支持32位，必须
		 *
		 * 版本 >= 0
		 */
		var $ddwUid; //uint64_t

		/**
		 * 积分明细类型(场景),必须
		 *
		 * 版本 >= 0
		 */
		var $dwType; //uint32_t

		/**
		 * 发放规则id
		 *
		 * 版本 >= 0
		 */
		var $dwRuleId; //uint32_t

		/**
		 * 易讯会员等级，有根据会员等级计算积分的必传，如评论
		 *
		 * 版本 >= 0
		 */
		var $dwVipLevel; //uint32_t

		/**
		 * 积分规则计算因子。有根据业务参数进行计算积分的必传，如评论的商品价格，满送的订单下单额
		 *
		 * 版本 >= 0
		 */
		var $dwFactor; //uint32_t

		/**
		 * 扣减积分数
		 *
		 * 版本 >= 0
		 */
		var $dwAddScoreNum; //uint32_t

		/**
		 * 扣减账户余额数
		 *
		 * 版本 >= 0
		 */
		var $dwAddCashNum; //uint32_t

		/**
		 * 是否使用扣减倍数
		 *
		 * 版本 >= 0
		 */
		var $dwIsMulty; //uint32_t

		/**
		 * 是否额外扣减
		 *
		 * 版本 >= 0
		 */
		var $dwIsExtra; //uint32_t

		/**
		 * 发放备注,业务方填写，填写内容应该易读，必填字段
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
		 * 区分类目的时候填写, 其他不填
		 *
		 * 版本 >= 0
		 */
		var $dwLimitclass; //uint32_t

		/**
		 * 评论商品号:商品评论时传送
		 *
		 * 版本 >= 0
		 */
		var $strProductId; //std::string

		/**
		 * 保留参数1
		 *
		 * 版本 >= 0
		 */
		var $dwExt_1; //uint32_t

		/**
		 * 保留参数2
		 *
		 * 版本 >= 0
		 */
		var $dwExt_2; //uint32_t

		/**
		 * 保留参数3
		 *
		 * 版本 >= 0
		 */
		var $strExt_3; //std::string

		/**
		 * 保留参数4
		 *
		 * 版本 >= 0
		 */
		var $strExt_4; //std::string

		/**
		 * 保留参数4
		 *
		 * 版本 >= 0
		 */
		var $strExt_5; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cUid_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRuleId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cVipLevel_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cFactor_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cAddScoreNum_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cAddCashNum_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIsMulty_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIsExtra_u; //uint8_t

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
		var $cLimitclass_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cProductId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExt_1_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExt_2_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExt_3_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExt_4_u; //uint8_t

		/**
		 * 版本 >= 0
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
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号  类型为uint32_t
			$bs->pushUint64_t($this->ddwUid); // 序列化扣减积分的易迅id, 暂支持32位，必须 类型为uint64_t
			$bs->pushUint32_t($this->dwType); // 序列化积分明细类型(场景),必须 类型为uint32_t
			$bs->pushUint32_t($this->dwRuleId); // 序列化发放规则id 类型为uint32_t
			$bs->pushUint32_t($this->dwVipLevel); // 序列化易讯会员等级，有根据会员等级计算积分的必传，如评论 类型为uint32_t
			$bs->pushUint32_t($this->dwFactor); // 序列化积分规则计算因子。有根据业务参数进行计算积分的必传，如评论的商品价格，满送的订单下单额 类型为uint32_t
			$bs->pushUint32_t($this->dwAddScoreNum); // 序列化扣减积分数 类型为uint32_t
			$bs->pushUint32_t($this->dwAddCashNum); // 序列化扣减账户余额数 类型为uint32_t
			$bs->pushUint32_t($this->dwIsMulty); // 序列化是否使用扣减倍数 类型为uint32_t
			$bs->pushUint32_t($this->dwIsExtra); // 序列化是否额外扣减 类型为uint32_t
			$bs->pushString($this->strRemarks); // 序列化发放备注,业务方填写，填写内容应该易读，必填字段 类型为std::string
			$bs->pushString($this->strDealId); // 序列化订单号:下单原因扣减时，订单号必填, 其他不填 类型为std::string
			$bs->pushUint32_t($this->dwLimitclass); // 序列化区分类目的时候填写, 其他不填 类型为uint32_t
			$bs->pushString($this->strProductId); // 序列化评论商品号:商品评论时传送 类型为std::string
			$bs->pushUint32_t($this->dwExt_1); // 序列化保留参数1 类型为uint32_t
			$bs->pushUint32_t($this->dwExt_2); // 序列化保留参数2 类型为uint32_t
			$bs->pushString($this->strExt_3); // 序列化保留参数3 类型为std::string
			$bs->pushString($this->strExt_4); // 序列化保留参数4 类型为std::string
			$bs->pushString($this->strExt_5); // 序列化保留参数4 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cUid_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRuleId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cVipLevel_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cFactor_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cAddScoreNum_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cAddCashNum_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIsMulty_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIsExtra_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRemarks_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cLimitclass_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cProductId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExt_1_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExt_2_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExt_3_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExt_4_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExt_5_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号  类型为uint32_t
			$this->ddwUid = $bs->popUint64_t(); // 反序列化扣减积分的易迅id, 暂支持32位，必须 类型为uint64_t
			$this->dwType = $bs->popUint32_t(); // 反序列化积分明细类型(场景),必须 类型为uint32_t
			$this->dwRuleId = $bs->popUint32_t(); // 反序列化发放规则id 类型为uint32_t
			$this->dwVipLevel = $bs->popUint32_t(); // 反序列化易讯会员等级，有根据会员等级计算积分的必传，如评论 类型为uint32_t
			$this->dwFactor = $bs->popUint32_t(); // 反序列化积分规则计算因子。有根据业务参数进行计算积分的必传，如评论的商品价格，满送的订单下单额 类型为uint32_t
			$this->dwAddScoreNum = $bs->popUint32_t(); // 反序列化扣减积分数 类型为uint32_t
			$this->dwAddCashNum = $bs->popUint32_t(); // 反序列化扣减账户余额数 类型为uint32_t
			$this->dwIsMulty = $bs->popUint32_t(); // 反序列化是否使用扣减倍数 类型为uint32_t
			$this->dwIsExtra = $bs->popUint32_t(); // 反序列化是否额外扣减 类型为uint32_t
			$this->strRemarks = $bs->popString(); // 反序列化发放备注,业务方填写，填写内容应该易读，必填字段 类型为std::string
			$this->strDealId = $bs->popString(); // 反序列化订单号:下单原因扣减时，订单号必填, 其他不填 类型为std::string
			$this->dwLimitclass = $bs->popUint32_t(); // 反序列化区分类目的时候填写, 其他不填 类型为uint32_t
			$this->strProductId = $bs->popString(); // 反序列化评论商品号:商品评论时传送 类型为std::string
			$this->dwExt_1 = $bs->popUint32_t(); // 反序列化保留参数1 类型为uint32_t
			$this->dwExt_2 = $bs->popUint32_t(); // 反序列化保留参数2 类型为uint32_t
			$this->strExt_3 = $bs->popString(); // 反序列化保留参数3 类型为std::string
			$this->strExt_4 = $bs->popString(); // 反序列化保留参数4 类型为std::string
			$this->strExt_5 = $bs->popString(); // 反序列化保留参数4 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cUid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRuleId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cVipLevel_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cFactor_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cAddScoreNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cAddCashNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIsMulty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIsExtra_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRemarks_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cLimitclass_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cProductId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExt_1_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExt_2_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExt_3_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExt_4_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExt_5_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: icson.score.ao.IcsonScoreAo.java

if (!class_exists('AddScorePo')) {
class AddScorePo
{
		/**
		 * 版本号 
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 发放积分的易迅id, 暂支持32位，必须
		 *
		 * 版本 >= 0
		 */
		var $ddwUid; //uint64_t

		/**
		 * 积分明细类型(场景),必须
		 *
		 * 版本 >= 0
		 */
		var $dwType; //uint32_t

		/**
		 * 发放规则id
		 *
		 * 版本 >= 0
		 */
		var $dwRuleId; //uint32_t

		/**
		 * 易讯会员等级，有根据会员等级计算积分的必传，如评论
		 *
		 * 版本 >= 0
		 */
		var $dwVipLevel; //uint32_t

		/**
		 * 积分规则计算因子。有根据业务参数进行计算积分的必传，如评论的商品价格，满送的订单下单额,单位分
		 *
		 * 版本 >= 0
		 */
		var $dwFactor; //uint32_t

		/**
		 * 发放促销积分数，业务侧计算积分的必须传送，如ERP，礼品卡
		 *
		 * 版本 >= 0
		 */
		var $dwAddScoreNum; //uint32_t

		/**
		 * 发放现金积分数，业务侧计算账户余额的必须传送，如订单回退
		 *
		 * 版本 >= 0
		 */
		var $dwAddCashNum; //uint32_t

		/**
		 * 是否使用发放倍数
		 *
		 * 版本 >= 0
		 */
		var $dwIsMulty; //uint32_t

		/**
		 * 是否额外奖励
		 *
		 * 版本 >= 0
		 */
		var $dwIsExtra; //uint32_t

		/**
		 * 发放备注,业务方填写，填写内容应该易读，必填字段
		 *
		 * 版本 >= 0
		 */
		var $strRemarks; //std::string

		/**
		 * 订单号:订单扣减后由于取消订单等原因补偿发放已被扣减的积分时,需填对应的扣减的订单号,其他不填
		 *
		 * 版本 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * 区分类目的需要填写,其他不填
		 *
		 * 版本 >= 0
		 */
		var $dwLimitclass; //uint32_t

		/**
		 * 评论商品号:商品评论时传送
		 *
		 * 版本 >= 0
		 */
		var $strProductId; //std::string

		/**
		 * 保留参数1
		 *
		 * 版本 >= 0
		 */
		var $dwExt_1; //uint32_t

		/**
		 * 保留参数2
		 *
		 * 版本 >= 0
		 */
		var $dwExt_2; //uint32_t

		/**
		 * 保留参数3
		 *
		 * 版本 >= 0
		 */
		var $strExt_3; //std::string

		/**
		 * 保留参数4
		 *
		 * 版本 >= 0
		 */
		var $strExt_4; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cUid_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRuleId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cVipLevel_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cFactor_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cAddScoreNum_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cAddCashNum_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIsMulty_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIsExtra_u; //uint8_t

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
		var $cLimitclass_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cProductId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExt_1_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExt_2_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExt_3_u; //uint8_t

		/**
		 * 版本 >= 0
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
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号  类型为uint32_t
			$bs->pushUint64_t($this->ddwUid); // 序列化发放积分的易迅id, 暂支持32位，必须 类型为uint64_t
			$bs->pushUint32_t($this->dwType); // 序列化积分明细类型(场景),必须 类型为uint32_t
			$bs->pushUint32_t($this->dwRuleId); // 序列化发放规则id 类型为uint32_t
			$bs->pushUint32_t($this->dwVipLevel); // 序列化易讯会员等级，有根据会员等级计算积分的必传，如评论 类型为uint32_t
			$bs->pushUint32_t($this->dwFactor); // 序列化积分规则计算因子。有根据业务参数进行计算积分的必传，如评论的商品价格，满送的订单下单额,单位分 类型为uint32_t
			$bs->pushUint32_t($this->dwAddScoreNum); // 序列化发放促销积分数，业务侧计算积分的必须传送，如ERP，礼品卡 类型为uint32_t
			$bs->pushUint32_t($this->dwAddCashNum); // 序列化发放现金积分数，业务侧计算账户余额的必须传送，如订单回退 类型为uint32_t
			$bs->pushUint32_t($this->dwIsMulty); // 序列化是否使用发放倍数 类型为uint32_t
			$bs->pushUint32_t($this->dwIsExtra); // 序列化是否额外奖励 类型为uint32_t
			$bs->pushString($this->strRemarks); // 序列化发放备注,业务方填写，填写内容应该易读，必填字段 类型为std::string
			$bs->pushString($this->strDealId); // 序列化订单号:订单扣减后由于取消订单等原因补偿发放已被扣减的积分时,需填对应的扣减的订单号,其他不填 类型为std::string
			$bs->pushUint32_t($this->dwLimitclass); // 序列化区分类目的需要填写,其他不填 类型为uint32_t
			$bs->pushString($this->strProductId); // 序列化评论商品号:商品评论时传送 类型为std::string
			$bs->pushUint32_t($this->dwExt_1); // 序列化保留参数1 类型为uint32_t
			$bs->pushUint32_t($this->dwExt_2); // 序列化保留参数2 类型为uint32_t
			$bs->pushString($this->strExt_3); // 序列化保留参数3 类型为std::string
			$bs->pushString($this->strExt_4); // 序列化保留参数4 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cUid_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRuleId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cVipLevel_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cFactor_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cAddScoreNum_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cAddCashNum_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIsMulty_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIsExtra_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRemarks_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cLimitclass_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cProductId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExt_1_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExt_2_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExt_3_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExt_4_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号  类型为uint32_t
			$this->ddwUid = $bs->popUint64_t(); // 反序列化发放积分的易迅id, 暂支持32位，必须 类型为uint64_t
			$this->dwType = $bs->popUint32_t(); // 反序列化积分明细类型(场景),必须 类型为uint32_t
			$this->dwRuleId = $bs->popUint32_t(); // 反序列化发放规则id 类型为uint32_t
			$this->dwVipLevel = $bs->popUint32_t(); // 反序列化易讯会员等级，有根据会员等级计算积分的必传，如评论 类型为uint32_t
			$this->dwFactor = $bs->popUint32_t(); // 反序列化积分规则计算因子。有根据业务参数进行计算积分的必传，如评论的商品价格，满送的订单下单额,单位分 类型为uint32_t
			$this->dwAddScoreNum = $bs->popUint32_t(); // 反序列化发放促销积分数，业务侧计算积分的必须传送，如ERP，礼品卡 类型为uint32_t
			$this->dwAddCashNum = $bs->popUint32_t(); // 反序列化发放现金积分数，业务侧计算账户余额的必须传送，如订单回退 类型为uint32_t
			$this->dwIsMulty = $bs->popUint32_t(); // 反序列化是否使用发放倍数 类型为uint32_t
			$this->dwIsExtra = $bs->popUint32_t(); // 反序列化是否额外奖励 类型为uint32_t
			$this->strRemarks = $bs->popString(); // 反序列化发放备注,业务方填写，填写内容应该易读，必填字段 类型为std::string
			$this->strDealId = $bs->popString(); // 反序列化订单号:订单扣减后由于取消订单等原因补偿发放已被扣减的积分时,需填对应的扣减的订单号,其他不填 类型为std::string
			$this->dwLimitclass = $bs->popUint32_t(); // 反序列化区分类目的需要填写,其他不填 类型为uint32_t
			$this->strProductId = $bs->popString(); // 反序列化评论商品号:商品评论时传送 类型为std::string
			$this->dwExt_1 = $bs->popUint32_t(); // 反序列化保留参数1 类型为uint32_t
			$this->dwExt_2 = $bs->popUint32_t(); // 反序列化保留参数2 类型为uint32_t
			$this->strExt_3 = $bs->popString(); // 反序列化保留参数3 类型为std::string
			$this->strExt_4 = $bs->popString(); // 反序列化保留参数4 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cUid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRuleId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cVipLevel_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cFactor_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cAddScoreNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cAddCashNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIsMulty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIsExtra_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRemarks_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cLimitclass_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cProductId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExt_1_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExt_2_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExt_3_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExt_4_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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