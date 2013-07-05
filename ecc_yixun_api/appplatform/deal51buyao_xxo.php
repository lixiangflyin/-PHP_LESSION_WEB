<?php

//source idl: com.ecc.deal.idl.UserQueryDealResp.java

if (!class_exists('DealPo')) {
class DealPo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		 *
		 * 版本 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * 订单单号，统一平台内部单号
		 *
		 * 版本 >= 0
		 */
		var $ddwDealId64; //uint64_t

		/**
		 * 交易单号，买卖家一次交易行为描述
		 *
		 * 版本 >= 0
		 */
		var $ddwBdealId; //uint64_t

		/**
		 * 业务订单编号，第三方托管订单
		 *
		 * 版本 >= 0
		 */
		var $strBusinessDealId; //std::string

		/**
		 * 买家ID
		 *
		 * 版本 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * 买家帐号
		 *
		 * 版本 >= 0
		 */
		var $strBuyerAccount; //std::string

		/**
		 * 买家姓名
		 *
		 * 版本 >= 0
		 */
		var $strBuyerNickName; //std::string

		/**
		 * 买家昵称
		 *
		 * 版本 >= 0
		 */
		var $strBuyerNick; //std::string

		/**
		 * 商家ID
		 *
		 * 版本 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * 商家真实名称
		 *
		 * 版本 >= 0
		 */
		var $strSellerTitle; //std::string

		/**
		 * 卖家昵称
		 *
		 * 版本 >= 0
		 */
		var $strSellerNick; //std::string

		/**
		 * 业务ID
		 *
		 * 版本 >= 0
		 */
		var $dwBusinessId; //uint32_t

		/**
		 * 订单类型
		 *
		 * 版本 >= 0
		 */
		var $cDealType; //uint8_t

		/**
		 * 下单渠道：1：业务主站；2：移动app；3：移动wap
		 *
		 * 版本 >= 0
		 */
		var $dwDealSource; //uint32_t

		/**
		 * 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款
		 *
		 * 版本 >= 0
		 */
		var $cDealPayType; //uint8_t

		/**
		 * 订单状态
		 *
		 * 版本 >= 0
		 */
		var $dwDealState; //uint32_t

		/**
		 * 订单前一个状态
		 *
		 * 版本 >= 0
		 */
		var $dwPreDealState; //uint32_t

		/**
		 * 订单属性值，通用
		 *
		 * 版本 >= 0
		 */
		var $dwDealProperty; //uint32_t

		/**
		 * 订单属性值，业务1扩展用
		 *
		 * 版本 >= 0
		 */
		var $dwDealProperty1; //uint32_t

		/**
		 * 订单属性值，业务2扩展用
		 *
		 * 版本 >= 0
		 */
		var $dwDealProperty2; //uint32_t

		/**
		 * 订单属性值，业务3扩展用
		 *
		 * 版本 >= 0
		 */
		var $dwDealProperty3; //uint32_t

		/**
		 * 订单属性值，业务4扩展用
		 *
		 * 版本 >= 0
		 */
		var $dwDealProperty4; //uint32_t

		/**
		 * 退款状态, 各子单退款状态的汇总, 0:无退款,1:退款中,2:退款完成
		 *
		 * 版本 >= 0
		 */
		var $dwRefundState; //uint32_t

		/**
		 * 评价评论状态
		 *
		 * 版本 >= 0
		 */
		var $dwEvalState; //uint32_t

		/**
		 * 商品skuID列表
		 *
		 * 版本 >= 0
		 */
		var $strItemSkuidList; //std::string

		/**
		 * 商品标题列表
		 *
		 * 版本 >= 0
		 */
		var $strItemTitleList; //std::string

		/**
		 * 订单总金额,下单金额
		 *
		 * 版本 >= 0
		 */
		var $dwDealTotalFee; //uint32_t

		/**
		 * 调价金额
		 *
		 * 版本 >= 0
		 */
		var $nDealAdjustFee; //int

		/**
		 * 实付总金额
		 *
		 * 版本 >= 0
		 */
		var $dwDealPayment; //uint32_t

		/**
		 * C2B预售定金金额
		 *
		 * 版本 >= 0
		 */
		var $dwDealDownPayment; //uint32_t

		/**
		 * 优惠总金额
		 *
		 * 版本 >= 0
		 */
		var $nDealDiscountTotal; //int

		/**
		 * 商品总金额
		 *
		 * 版本 >= 0
		 */
		var $dwDealItemTotalFee; //uint32_t

		/**
		 * 谁支付邮费，1：卖家；2：买家
		 *
		 * 版本 >= 0
		 */
		var $dwDealWhoPayShippingFee; //uint32_t

		/**
		 * 邮费金额
		 *
		 * 版本 >= 0
		 */
		var $dwDealShippingFee; //uint32_t

		/**
		 * 谁承担COD手续费，1：卖家承担；2：买家；3：平台承担
		 *
		 * 版本 >= 0
		 */
		var $dwDealWhoPayCodFee; //uint32_t

		/**
		 * COD手续额
		 *
		 * 版本 >= 0
		 */
		var $dwDealCodFee; //uint32_t

		/**
		 * 谁支付保险费，1：卖家赠送；2：买家；3：平台承担
		 *
		 * 版本 >= 0
		 */
		var $dwDealWhoPayInsuranceFee; //uint32_t

		/**
		 * 运费保险费
		 *
		 * 版本 >= 0
		 */
		var $dwDealInsuranceFee; //uint32_t

		/**
		 * 系统调价金额，用于区分COD卖家调价金额和用于凑整的COD优惠金额
		 *
		 * 版本 >= 0
		 */
		var $nDealSysAdjustFee; //int

		/**
		 * 退款总金额费
		 *
		 * 版本 >= 0
		 */
		var $dwDealRefundTotalFee; //uint32_t

		/**
		 * 积分支付值
		 *
		 * 版本 >= 0
		 */
		var $dwPayScore; //uint32_t

		/**
		 * 获得积分值
		 *
		 * 版本 >= 0
		 */
		var $dwObtainScore; //uint32_t

		/**
		 * 商品单生成时间
		 *
		 * 版本 >= 0
		 */
		var $dwDealGenTime; //uint32_t

		/**
		 * 订单发货地描述
		 *
		 * 版本 >= 0
		 */
		var $strSendFromDesc; //std::string

		/**
		 * 下单时间戳
		 *
		 * 版本 >= 0
		 */
		var $ddwDealSeq; //uint64_t

		/**
		 * 下单md5
		 *
		 * 版本 >= 0
		 */
		var $ddwDealMd5; //uint64_t

		/**
		 * 下单IP
		 *
		 * 版本 >= 0
		 */
		var $strDealIp; //std::string

		/**
		 * refer
		 *
		 * 版本 >= 0
		 */
		var $strDealRefer; //std::string

		/**
		 * visitkey
		 *
		 * 版本 >= 0
		 */
		var $strDealVisitKey; //std::string

		/**
		 * 订单促销信息描述
		 *
		 * 版本 >= 0
		 */
		var $strPromotionDesc; //std::string

		/**
		 * 收货人
		 *
		 * 版本 >= 0
		 */
		var $strRecvName; //std::string

		/**
		 * 地区编码
		 *
		 * 版本 >= 0
		 */
		var $dwRecvRegionCode; //uint32_t

		/**
		 * 地址
		 *
		 * 版本 >= 0
		 */
		var $strRecvAddress; //std::string

		/**
		 * 邮编
		 *
		 * 版本 >= 0
		 */
		var $strRecvPostCode; //std::string

		/**
		 * 电话
		 *
		 * 版本 >= 0
		 */
		var $strRecvPhone; //std::string

		/**
		 * 手机
		 *
		 * 版本 >= 0
		 */
		var $ddwRecvMobile; //uint64_t

		/**
		 * 期望收货时间,天
		 *
		 * 版本 >= 0
		 */
		var $dwExpectRecvTime; //uint32_t

		/**
		 * 期望收货时段
		 *
		 * 版本 >= 0
		 */
		var $strExpectRecvTimeSpan; //std::string

		/**
		 * 收货附言
		 *
		 * 版本 >= 0
		 */
		var $strRecvRemark; //std::string

		/**
		 * 收货属性值
		 *
		 * 版本 >= 0
		 */
		var $dwRecvMask; //uint32_t

		/**
		 * 配送方式；1：平邮；2：快递；3：EMS；4：B2C自建物流；5：用户配送点自提
		 *
		 * 版本 >= 0
		 */
		var $cExpressType; //uint8_t

		/**
		 * 物流公司ID
		 *
		 * 版本 >= 0
		 */
		var $strExpressCompanyID; //std::string

		/**
		 * 物流公司名称
		 *
		 * 版本 >= 0
		 */
		var $strExpressCompanyName; //std::string

		/**
		 * 物流公司订单号
		 *
		 * 版本 >= 0
		 */
		var $strExpressDealID; //std::string

		/**
		 * 预计到达天数
		 *
		 * 版本 >= 0
		 */
		var $wExpectArriveDays; //uint16_t

		/**
		 * 物流订单号，物流系统物流单
		 *
		 * 版本 >= 0
		 */
		var $strWuliuDealId; //std::string

		/**
		 * 发票类型
		 *
		 * 版本 >= 0
		 */
		var $cInvoiceType; //uint8_t

		/**
		 * 发票抬头
		 *
		 * 版本 >= 0
		 */
		var $strInvoiceHead; //std::string

		/**
		 * 发票内容
		 *
		 * 版本 >= 0
		 */
		var $strInvoiceContent; //std::string

		/**
		 * 支付帐号
		 *
		 * 版本 >= 0
		 */
		var $strPayAccount; //std::string

		/**
		 * Cft支付单号
		 *
		 * 版本 >= 0
		 */
		var $strCftDealId; //std::string

		/**
		 * 付款完成时间
		 *
		 * 版本 >= 0
		 */
		var $dwDealPayTime; //uint32_t

		/**
		 * 付款返回时间
		 *
		 * 版本 >= 0
		 */
		var $dwDealPayReturnTime; //uint32_t

		/**
		 * 审核时间
		 *
		 * 版本 >= 0
		 */
		var $dwDealCheckTime; //uint32_t

		/**
		 * 审核版本号
		 *
		 * 版本 >= 0
		 */
		var $dwDealCheckVersion; //uint32_t

		/**
		 * 审核描述
		 *
		 * 版本 >= 0
		 */
		var $strDealCheckDesc; //std::string

		/**
		 * 商家发货时间
		 *
		 * 版本 >= 0
		 */
		var $dwDealSellerSendTime; //uint32_t

		/**
		 * 标记发货时间
		 *
		 * 版本 >= 0
		 */
		var $dwDealConsignTime; //uint32_t

		/**
		 * 签收时间
		 *
		 * 版本 >= 0
		 */
		var $dwDealConfirmRecvTime; //uint32_t

		/**
		 * 结束时间
		 *
		 * 版本 >= 0
		 */
		var $dwDealEndTime; //uint32_t

		/**
		 * 打款完成时间
		 *
		 * 版本 >= 0
		 */
		var $dwDealRecvFeeTime; //uint32_t

		/**
		 * 打款返回时间
		 *
		 * 版本 >= 0
		 */
		var $dwDealRecvFeeReturnTime; //uint32_t

		/**
		 * 打款买家总金额
		 *
		 * 版本 >= 0
		 */
		var $dwDealBuyerRecvFee; //uint32_t

		/**
		 * 打款卖家总金额
		 *
		 * 版本 >= 0
		 */
		var $dwDealSellerRecvFee; //uint32_t

		/**
		 * 支付现金金额
		 *
		 * 版本 >= 0
		 */
		var $dwDealPayCash; //uint32_t

		/**
		 * 支付财付券金额
		 *
		 * 版本 >= 0
		 */
		var $dwDealPayTicket; //uint32_t

		/**
		 * 支付积分金额
		 *
		 * 版本 >= 0
		 */
		var $dwDealPayCredit; //uint32_t

		/**
		 * 其他支付金额
		 *
		 * 版本 >= 0
		 */
		var $dwDealPayOther; //uint32_t

		/**
		 * 延长确认收货天数
		 *
		 * 版本 >= 0
		 */
		var $dwDelayConfirmDays; //uint32_t

		/**
		 * 买家标记
		 *
		 * 版本 >= 0
		 */
		var $cBuyerTag; //uint8_t

		/**
		 * 买家备注
		 *
		 * 版本 >= 0
		 */
		var $strBuyerNote; //std::string

		/**
		 * 卖家标记
		 *
		 * 版本 >= 0
		 */
		var $cSellerTag; //uint8_t

		/**
		 * 卖家备注
		 *
		 * 版本 >= 0
		 */
		var $strSellerNote; //std::string

		/**
		 * 数据版本号
		 *
		 * 版本 >= 0
		 */
		var $dwDataVersion; //uint32_t

		/**
		 * 订单有效标记
		 *
		 * 版本 >= 0
		 */
		var $dwDelFlag; //uint32_t

		/**
		 * 可见标识
		 *
		 * 版本 >= 0
		 */
		var $dwVisibleState; //uint32_t

		/**
		 * 最后更新时间
		 *
		 * 版本 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * 商品子单列表
		 *
		 * 版本 >= 0
		 */
		var $oTradeInfoList; //ecc::deal::po::CTradePoList

		/**
		 * 支付信息表
		 *
		 * 版本 >= 0
		 */
		var $oPayInfoList; //ecc::deal::po::CPayInfoPoList

		/**
		 * 物流信息表
		 *
		 * 版本 >= 0
		 */
		var $oWuliuInfoList; //ecc::deal::po::CDealWuliuPoList

		/**
		 * 打款信息表
		 *
		 * 版本 >= 0
		 */
		var $oRecvFeeInfoList; //ecc::deal::po::CRecvFeePoList

		/**
		 * 退款信息表
		 *
		 * 版本 >= 0
		 */
		var $oRefundInfoList; //ecc::deal::po::CDealRefundPoList

		/**
		 * 流水日志表
		 *
		 * 版本 >= 0
		 */
		var $oActionLogInfoList; //ecc::deal::po::CDealActionLogPoList

		/**
		 * 订单扩展信息 
		 *
		 * 版本 >= 0
		 */
		var $mmapDealExtInfoMap; //std::multimap<uint32_t,std::string> 

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId64_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBdealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBusinessDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerAccount_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerNickName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerNick_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerTitle_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerNick_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBusinessId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealSource_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealPayType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPreDealState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealProperty_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealProperty1_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealProperty2_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealProperty3_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealProperty4_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cEvalState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemSkuidList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemTitleList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealTotalFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealAdjustFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealPayment_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealDownPayment_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealDiscountTotal_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealItemTotalFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealWhoPayShippingFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealShippingFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealWhoPayCodFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealCodFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealWhoPayInsuranceFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealInsuranceFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealSysAdjustFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealRefundTotalFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayScore_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cObtainScore_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealGenTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSendFromDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealSeq_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealMd5_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealIp_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealRefer_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealVisitKey_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPromotionDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvRegionCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvAddress_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvPostCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvPhone_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvMobile_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExpectRecvTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExpectRecvTimeSpan_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvRemark_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvMask_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExpressType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExpressCompanyID_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExpressCompanyName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExpressDealID_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExpectArriveDays_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cWuliuDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cInvoiceType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cInvoiceHead_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cInvoiceContent_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayAccount_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCftDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealPayTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealPayReturnTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealCheckTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealCheckVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealCheckDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealSellerSendTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealConsignTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealConfirmRecvTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealEndTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealRecvFeeTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealRecvFeeReturnTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealBuyerRecvFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealSellerRecvFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealPayCash_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealPayTicket_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealPayCredit_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealPayOther_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDelayConfirmDays_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerTag_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerNote_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerTag_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerNote_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDataVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDelFlag_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cVisibleState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeInfoList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayInfoList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cWuliuInfoList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvFeeInfoList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundInfoList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cActionLogInfoList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealExtInfoMap_u; //uint8_t

		/**
		 * 交易单编号，即字符串格式的交易单号
		 *
		 * 版本 >= 1
		 */
		var $strBdealCode; //std::string

		/**
		 * 业务交易单号
		 *
		 * 版本 >= 1
		 */
		var $strBusinessBdealId; //std::string

		/**
		 * 分站ID
		 *
		 * 版本 >= 1
		 */
		var $dwSiteId; //uint32_t

		/**
		 * 优惠券金额
		 *
		 * 版本 >= 1
		 */
		var $nDealCouponFee; //int

		/**
		 * 现金积分支付值
		 *
		 * 版本 >= 1
		 */
		var $dwCashScore; //uint32_t

		/**
		 * 促销积分支付值
		 *
		 * 版本 >= 1
		 */
		var $dwPromotionScore; //uint32_t

		/**
		 * 扩展地区编码
		 *
		 * 版本 >= 1
		 */
		var $strRecvRegionCodeExt; //std::string

		/**
		 * 订单摘要
		 *
		 * 版本 >= 1
		 */
		var $strDealDigest; //std::string

		/**
		 * 易迅配送方式
		 *
		 * 版本 >= 1
		 */
		var $strIcsonShippingType; //std::string

		/**
		 * 易迅支付方式
		 *
		 * 版本 >= 1
		 */
		var $strIcsonPayType; //std::string

		/**
		 * 易迅内部帐号ID
		 *
		 * 版本 >= 1
		 */
		var $strIcsonAccount; //std::string

		/**
		 * 易迅跟踪信息
		 *
		 * 版本 >= 1
		 */
		var $strIcsonMasterLs; //std::string

		/**
		 * 易迅平衡比率
		 *
		 * 版本 >= 1
		 */
		var $strIcsonRate; //std::string

		/**
		 * 易迅银行利率
		 *
		 * 版本 >= 1
		 */
		var $strIcsonBankRate; //std::string

		/**
		 * 易迅店铺id
		 *
		 * 版本 >= 1
		 */
		var $strIcsonShopId; //std::string

		/**
		 * 易迅店铺导购id
		 *
		 * 版本 >= 1
		 */
		var $strIcsonShopGuideId; //std::string

		/**
		 * 易迅店铺导购费用
		 *
		 * 版本 >= 1
		 */
		var $strIcsonShopGuideCost; //std::string

		/**
		 * 易迅店铺导购名称
		 *
		 * 版本 >= 1
		 */
		var $strIcsonShopGuideName; //std::string

		/**
		 * 易迅节能补贴类型
		 *
		 * 版本 >= 1
		 */
		var $strIcsonSubsidyType; //std::string

		/**
		 * 易迅节能补贴姓名
		 *
		 * 版本 >= 1
		 */
		var $strIcsonSubsidyName; //std::string

		/**
		 * 易迅节能补贴身份证
		 *
		 * 版本 >= 1
		 */
		var $strIcsonSubsidyIdCard; //std::string

		/**
		 * 易迅客服下单操作员ID
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSOrderOperatorId; //std::string

		/**
		 * 易迅客服下单操作员名称
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSOrderOperatorName; //std::string

		/**
		 * 易迅发票公司名称
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceCompanyName; //std::string

		/**
		 * 易迅发票公司地址
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceCompanyAddr; //std::string

		/**
		 * 易迅发票公司电话
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceCompanyPhone; //std::string

		/**
		 * 易迅发票公司税号
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceCompanyTaxNo; //std::string

		/**
		 * 易迅发票公司银行账户
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceCompanyBankNo; //std::string

		/**
		 * 易迅发票公司银行名称
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceCompanyBankName; //std::string

		/**
		 * 易迅发票收货人
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceRecvName; //std::string

		/**
		 * 易迅发票收货地址
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceRecvAddr; //std::string

		/**
		 * 易迅发票收货地址ID
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceRecvRegionId; //std::string

		/**
		 * 易迅发票收货手机
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceRecvMobile; //std::string

		/**
		 * 易迅发票收货电话
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceRecvTel; //std::string

		/**
		 * 易迅发票收货邮编
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceRecvZip; //std::string

		/**
		 * 易迅发票配送方式
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceShipType; //std::string

		/**
		 * 易迅发票配送费用
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceShipFee; //std::string

		/**
		 * 易迅订单flag
		 *
		 * 版本 >= 1
		 */
		var $strIcsonDealFlag; //std::string

		/**
		 * 易迅订单物流仓库编号
		 *
		 * 版本 >= 1
		 */
		var $strIcsonStockNo; //std::string

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cBdealCode_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cBusinessBdealId_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cSiteId_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cDealCouponFee_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cCashScore_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cPromotionScore_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cRecvRegionCodeExt_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cDealDigest_u; //uint8_t

		/**
		 * 易迅配送方式UFlag
		 *
		 * 版本 >= 1
		 */
		var $cIcsonShippingType_u; //uint8_t

		/**
		 * 易迅支付方式UFlag
		 *
		 * 版本 >= 1
		 */
		var $cIcsonPayType_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonAccount_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonMasterLs_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonRate_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonBankRate_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonShopId_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonShopGuideId_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonShopGuideCost_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonShopGuideName_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonSubsidyType_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonSubsidyName_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonSubsidyIdCard_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSOrderOperatorId_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSOrderOperatorName_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceCompanyName_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceCompanyAddr_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceCompanyPhone_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceCompanyTaxNo_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceCompanyBankNo_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceCompanyBankName_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceRecvName_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceRecvAddr_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceRecvRegionId_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceRecvMobile_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceRecvTel_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceRecvZip_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceShipType_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceShipFee_u; //uint8_t

		/**
		 * 易迅订单flag
		 *
		 * 版本 >= 1
		 */
		var $cIcsonDealFlag_u; //uint8_t

		/**
		 * 易迅订单物流仓库编号
		 *
		 * 版本 >= 1
		 */
		var $cIcsonStockNo_u; //uint8_t

		/**
		 * 订单返现金额
		 *
		 * 版本 >= 2
		 */
		var $dwIcsonDealCashBack; //uint32_t

		/**
		 * 订单返现金额UFlag
		 *
		 * 版本 >= 2
		 */
		var $cIcsonDealCashBack_u; //uint8_t

		/**
		 * 易迅订单号，带10开头
		 *
		 * 版本 >= 3
		 */
		var $strIcsonDealCode; //std::string

		/**
		 * 订单返现金额UFlag
		 *
		 * 版本 >= 3
		 */
		var $cIcsonDealCode_u; //uint8_t

		/**
		 * 易迅货票分离仓库id
		 *
		 * 版本 >= 4
		 */
		var $strIcsonInvoiceStockNo; //std::string

		/**
		 * 易迅货票分离分站id
		 *
		 * 版本 >= 4
		 */
		var $strIcsonInvoiceSiteId; //std::string

		/**
		 * 
		 *
		 * 版本 >= 4
		 */
		var $cIcsonInvoiceStockNo_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 4
		 */
		var $cIcsonInvoiceSiteId_u; //uint8_t

		/**
		 * 易迅联营商家id
		 *
		 * 版本 >= 5
		 */
		var $ddwSellerCorpId; //uint64_t

		/**
		 * 易迅联营体积
		 *
		 * 版本 >= 5
		 */
		var $strLmsVolume; //std::string

		/**
		 * 易迅联营重量
		 *
		 * 版本 >= 5
		 */
		var $strLmsWeight; //std::string

		/**
		 * 易迅联营最长边
		 *
		 * 版本 >= 5
		 */
		var $strLmsLongest; //std::string

		/**
		 * 
		 *
		 * 版本 >= 5
		 */
		var $cSellerCorpId_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 5
		 */
		var $cLmsVolume_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 5
		 */
		var $cLmsWeight_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 5
		 */
		var $cLmsLongest_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 5; // uint16_t
			 $this->strDealId = ""; // std::string
			 $this->ddwDealId64 = 0; // uint64_t
			 $this->ddwBdealId = 0; // uint64_t
			 $this->strBusinessDealId = ""; // std::string
			 $this->ddwBuyerId = 0; // uint64_t
			 $this->strBuyerAccount = ""; // std::string
			 $this->strBuyerNickName = ""; // std::string
			 $this->strBuyerNick = ""; // std::string
			 $this->ddwSellerId = 0; // uint64_t
			 $this->strSellerTitle = ""; // std::string
			 $this->strSellerNick = ""; // std::string
			 $this->dwBusinessId = 0; // uint32_t
			 $this->cDealType = 0; // uint8_t
			 $this->dwDealSource = 0; // uint32_t
			 $this->cDealPayType = 0; // uint8_t
			 $this->dwDealState = 0; // uint32_t
			 $this->dwPreDealState = 0; // uint32_t
			 $this->dwDealProperty = 0; // uint32_t
			 $this->dwDealProperty1 = 0; // uint32_t
			 $this->dwDealProperty2 = 0; // uint32_t
			 $this->dwDealProperty3 = 0; // uint32_t
			 $this->dwDealProperty4 = 0; // uint32_t
			 $this->dwRefundState = 0; // uint32_t
			 $this->dwEvalState = 0; // uint32_t
			 $this->strItemSkuidList = ""; // std::string
			 $this->strItemTitleList = ""; // std::string
			 $this->dwDealTotalFee = 0; // uint32_t
			 $this->nDealAdjustFee = 0; // int
			 $this->dwDealPayment = 0; // uint32_t
			 $this->dwDealDownPayment = 0; // uint32_t
			 $this->nDealDiscountTotal = 0; // int
			 $this->dwDealItemTotalFee = 0; // uint32_t
			 $this->dwDealWhoPayShippingFee = 0; // uint32_t
			 $this->dwDealShippingFee = 0; // uint32_t
			 $this->dwDealWhoPayCodFee = 0; // uint32_t
			 $this->dwDealCodFee = 0; // uint32_t
			 $this->dwDealWhoPayInsuranceFee = 0; // uint32_t
			 $this->dwDealInsuranceFee = 0; // uint32_t
			 $this->nDealSysAdjustFee = 0; // int
			 $this->dwDealRefundTotalFee = 0; // uint32_t
			 $this->dwPayScore = 0; // uint32_t
			 $this->dwObtainScore = 0; // uint32_t
			 $this->dwDealGenTime = 0; // uint32_t
			 $this->strSendFromDesc = ""; // std::string
			 $this->ddwDealSeq = 0; // uint64_t
			 $this->ddwDealMd5 = 0; // uint64_t
			 $this->strDealIp = ""; // std::string
			 $this->strDealRefer = ""; // std::string
			 $this->strDealVisitKey = ""; // std::string
			 $this->strPromotionDesc = ""; // std::string
			 $this->strRecvName = ""; // std::string
			 $this->dwRecvRegionCode = 0; // uint32_t
			 $this->strRecvAddress = ""; // std::string
			 $this->strRecvPostCode = ""; // std::string
			 $this->strRecvPhone = ""; // std::string
			 $this->ddwRecvMobile = 0; // uint64_t
			 $this->dwExpectRecvTime = 0; // uint32_t
			 $this->strExpectRecvTimeSpan = ""; // std::string
			 $this->strRecvRemark = ""; // std::string
			 $this->dwRecvMask = 0; // uint32_t
			 $this->cExpressType = 0; // uint8_t
			 $this->strExpressCompanyID = ""; // std::string
			 $this->strExpressCompanyName = ""; // std::string
			 $this->strExpressDealID = ""; // std::string
			 $this->wExpectArriveDays = 0; // uint16_t
			 $this->strWuliuDealId = ""; // std::string
			 $this->cInvoiceType = 0; // uint8_t
			 $this->strInvoiceHead = ""; // std::string
			 $this->strInvoiceContent = ""; // std::string
			 $this->strPayAccount = ""; // std::string
			 $this->strCftDealId = ""; // std::string
			 $this->dwDealPayTime = 0; // uint32_t
			 $this->dwDealPayReturnTime = 0; // uint32_t
			 $this->dwDealCheckTime = 0; // uint32_t
			 $this->dwDealCheckVersion = 0; // uint32_t
			 $this->strDealCheckDesc = ""; // std::string
			 $this->dwDealSellerSendTime = 0; // uint32_t
			 $this->dwDealConsignTime = 0; // uint32_t
			 $this->dwDealConfirmRecvTime = 0; // uint32_t
			 $this->dwDealEndTime = 0; // uint32_t
			 $this->dwDealRecvFeeTime = 0; // uint32_t
			 $this->dwDealRecvFeeReturnTime = 0; // uint32_t
			 $this->dwDealBuyerRecvFee = 0; // uint32_t
			 $this->dwDealSellerRecvFee = 0; // uint32_t
			 $this->dwDealPayCash = 0; // uint32_t
			 $this->dwDealPayTicket = 0; // uint32_t
			 $this->dwDealPayCredit = 0; // uint32_t
			 $this->dwDealPayOther = 0; // uint32_t
			 $this->dwDelayConfirmDays = 0; // uint32_t
			 $this->cBuyerTag = 0; // uint8_t
			 $this->strBuyerNote = ""; // std::string
			 $this->cSellerTag = 0; // uint8_t
			 $this->strSellerNote = ""; // std::string
			 $this->dwDataVersion = 0; // uint32_t
			 $this->dwDelFlag = 0; // uint32_t
			 $this->dwVisibleState = 0; // uint32_t
			 $this->dwLastUpdateTime = 0; // uint32_t
			 $this->oTradeInfoList = new TradePoList(); // ecc::deal::po::CTradePoList
			 $this->oPayInfoList = new PayInfoPoList(); // ecc::deal::po::CPayInfoPoList
			 $this->oWuliuInfoList = new DealWuliuPoList(); // ecc::deal::po::CDealWuliuPoList
			 $this->oRecvFeeInfoList = new RecvFeePoList(); // ecc::deal::po::CRecvFeePoList
			 $this->oRefundInfoList = new DealRefundPoList(); // ecc::deal::po::CDealRefundPoList
			 $this->oActionLogInfoList = new DealActionLogPoList(); // ecc::deal::po::CDealActionLogPoList
			 $this->mmapDealExtInfoMap = new stl_multimap('uint32_t,stl_string'); // std::multimap<uint32_t,std::string> 
			 $this->cVersion_u = 0; // uint8_t
			 $this->cDealId_u = 0; // uint8_t
			 $this->cDealId64_u = 0; // uint8_t
			 $this->cBdealId_u = 0; // uint8_t
			 $this->cBusinessDealId_u = 0; // uint8_t
			 $this->cBuyerId_u = 0; // uint8_t
			 $this->cBuyerAccount_u = 0; // uint8_t
			 $this->cBuyerNickName_u = 0; // uint8_t
			 $this->cBuyerNick_u = 0; // uint8_t
			 $this->cSellerId_u = 0; // uint8_t
			 $this->cSellerTitle_u = 0; // uint8_t
			 $this->cSellerNick_u = 0; // uint8_t
			 $this->cBusinessId_u = 0; // uint8_t
			 $this->cDealType_u = 0; // uint8_t
			 $this->cDealSource_u = 0; // uint8_t
			 $this->cDealPayType_u = 0; // uint8_t
			 $this->cDealState_u = 0; // uint8_t
			 $this->cPreDealState_u = 0; // uint8_t
			 $this->cDealProperty_u = 0; // uint8_t
			 $this->cDealProperty1_u = 0; // uint8_t
			 $this->cDealProperty2_u = 0; // uint8_t
			 $this->cDealProperty3_u = 0; // uint8_t
			 $this->cDealProperty4_u = 0; // uint8_t
			 $this->cRefundState_u = 0; // uint8_t
			 $this->cEvalState_u = 0; // uint8_t
			 $this->cItemSkuidList_u = 0; // uint8_t
			 $this->cItemTitleList_u = 0; // uint8_t
			 $this->cDealTotalFee_u = 0; // uint8_t
			 $this->cDealAdjustFee_u = 0; // uint8_t
			 $this->cDealPayment_u = 0; // uint8_t
			 $this->cDealDownPayment_u = 0; // uint8_t
			 $this->cDealDiscountTotal_u = 0; // uint8_t
			 $this->cDealItemTotalFee_u = 0; // uint8_t
			 $this->cDealWhoPayShippingFee_u = 0; // uint8_t
			 $this->cDealShippingFee_u = 0; // uint8_t
			 $this->cDealWhoPayCodFee_u = 0; // uint8_t
			 $this->cDealCodFee_u = 0; // uint8_t
			 $this->cDealWhoPayInsuranceFee_u = 0; // uint8_t
			 $this->cDealInsuranceFee_u = 0; // uint8_t
			 $this->cDealSysAdjustFee_u = 0; // uint8_t
			 $this->cDealRefundTotalFee_u = 0; // uint8_t
			 $this->cPayScore_u = 0; // uint8_t
			 $this->cObtainScore_u = 0; // uint8_t
			 $this->cDealGenTime_u = 0; // uint8_t
			 $this->cSendFromDesc_u = 0; // uint8_t
			 $this->cDealSeq_u = 0; // uint8_t
			 $this->cDealMd5_u = 0; // uint8_t
			 $this->cDealIp_u = 0; // uint8_t
			 $this->cDealRefer_u = 0; // uint8_t
			 $this->cDealVisitKey_u = 0; // uint8_t
			 $this->cPromotionDesc_u = 0; // uint8_t
			 $this->cRecvName_u = 0; // uint8_t
			 $this->cRecvRegionCode_u = 0; // uint8_t
			 $this->cRecvAddress_u = 0; // uint8_t
			 $this->cRecvPostCode_u = 0; // uint8_t
			 $this->cRecvPhone_u = 0; // uint8_t
			 $this->cRecvMobile_u = 0; // uint8_t
			 $this->cExpectRecvTime_u = 0; // uint8_t
			 $this->cExpectRecvTimeSpan_u = 0; // uint8_t
			 $this->cRecvRemark_u = 0; // uint8_t
			 $this->cRecvMask_u = 0; // uint8_t
			 $this->cExpressType_u = 0; // uint8_t
			 $this->cExpressCompanyID_u = 0; // uint8_t
			 $this->cExpressCompanyName_u = 0; // uint8_t
			 $this->cExpressDealID_u = 0; // uint8_t
			 $this->cExpectArriveDays_u = 0; // uint8_t
			 $this->cWuliuDealId_u = 0; // uint8_t
			 $this->cInvoiceType_u = 0; // uint8_t
			 $this->cInvoiceHead_u = 0; // uint8_t
			 $this->cInvoiceContent_u = 0; // uint8_t
			 $this->cPayAccount_u = 0; // uint8_t
			 $this->cCftDealId_u = 0; // uint8_t
			 $this->cDealPayTime_u = 0; // uint8_t
			 $this->cDealPayReturnTime_u = 0; // uint8_t
			 $this->cDealCheckTime_u = 0; // uint8_t
			 $this->cDealCheckVersion_u = 0; // uint8_t
			 $this->cDealCheckDesc_u = 0; // uint8_t
			 $this->cDealSellerSendTime_u = 0; // uint8_t
			 $this->cDealConsignTime_u = 0; // uint8_t
			 $this->cDealConfirmRecvTime_u = 0; // uint8_t
			 $this->cDealEndTime_u = 0; // uint8_t
			 $this->cDealRecvFeeTime_u = 0; // uint8_t
			 $this->cDealRecvFeeReturnTime_u = 0; // uint8_t
			 $this->cDealBuyerRecvFee_u = 0; // uint8_t
			 $this->cDealSellerRecvFee_u = 0; // uint8_t
			 $this->cDealPayCash_u = 0; // uint8_t
			 $this->cDealPayTicket_u = 0; // uint8_t
			 $this->cDealPayCredit_u = 0; // uint8_t
			 $this->cDealPayOther_u = 0; // uint8_t
			 $this->cDelayConfirmDays_u = 0; // uint8_t
			 $this->cBuyerTag_u = 0; // uint8_t
			 $this->cBuyerNote_u = 0; // uint8_t
			 $this->cSellerTag_u = 0; // uint8_t
			 $this->cSellerNote_u = 0; // uint8_t
			 $this->cDataVersion_u = 0; // uint8_t
			 $this->cDelFlag_u = 0; // uint8_t
			 $this->cVisibleState_u = 0; // uint8_t
			 $this->cLastUpdateTime_u = 0; // uint8_t
			 $this->cTradeInfoList_u = 0; // uint8_t
			 $this->cPayInfoList_u = 0; // uint8_t
			 $this->cWuliuInfoList_u = 0; // uint8_t
			 $this->cRecvFeeInfoList_u = 0; // uint8_t
			 $this->cRefundInfoList_u = 0; // uint8_t
			 $this->cActionLogInfoList_u = 0; // uint8_t
			 $this->cDealExtInfoMap_u = 0; // uint8_t
			 $this->strBdealCode = ""; // std::string
			 $this->strBusinessBdealId = ""; // std::string
			 $this->dwSiteId = 0; // uint32_t
			 $this->nDealCouponFee = 0; // int
			 $this->dwCashScore = 0; // uint32_t
			 $this->dwPromotionScore = 0; // uint32_t
			 $this->strRecvRegionCodeExt = ""; // std::string
			 $this->strDealDigest = ""; // std::string
			 $this->strIcsonShippingType = ""; // std::string
			 $this->strIcsonPayType = ""; // std::string
			 $this->strIcsonAccount = ""; // std::string
			 $this->strIcsonMasterLs = ""; // std::string
			 $this->strIcsonRate = ""; // std::string
			 $this->strIcsonBankRate = ""; // std::string
			 $this->strIcsonShopId = ""; // std::string
			 $this->strIcsonShopGuideId = ""; // std::string
			 $this->strIcsonShopGuideCost = ""; // std::string
			 $this->strIcsonShopGuideName = ""; // std::string
			 $this->strIcsonSubsidyType = ""; // std::string
			 $this->strIcsonSubsidyName = ""; // std::string
			 $this->strIcsonSubsidyIdCard = ""; // std::string
			 $this->strIcsonCSOrderOperatorId = ""; // std::string
			 $this->strIcsonCSOrderOperatorName = ""; // std::string
			 $this->strIcsonInvoiceCompanyName = ""; // std::string
			 $this->strIcsonInvoiceCompanyAddr = ""; // std::string
			 $this->strIcsonInvoiceCompanyPhone = ""; // std::string
			 $this->strIcsonInvoiceCompanyTaxNo = ""; // std::string
			 $this->strIcsonInvoiceCompanyBankNo = ""; // std::string
			 $this->strIcsonInvoiceCompanyBankName = ""; // std::string
			 $this->strIcsonInvoiceRecvName = ""; // std::string
			 $this->strIcsonInvoiceRecvAddr = ""; // std::string
			 $this->strIcsonInvoiceRecvRegionId = ""; // std::string
			 $this->strIcsonInvoiceRecvMobile = ""; // std::string
			 $this->strIcsonInvoiceRecvTel = ""; // std::string
			 $this->strIcsonInvoiceRecvZip = ""; // std::string
			 $this->strIcsonInvoiceShipType = ""; // std::string
			 $this->strIcsonInvoiceShipFee = ""; // std::string
			 $this->strIcsonDealFlag = ""; // std::string
			 $this->strIcsonStockNo = ""; // std::string
			 $this->cBdealCode_u = 0; // uint8_t
			 $this->cBusinessBdealId_u = 0; // uint8_t
			 $this->cSiteId_u = 0; // uint8_t
			 $this->cDealCouponFee_u = 0; // uint8_t
			 $this->cCashScore_u = 0; // uint8_t
			 $this->cPromotionScore_u = 0; // uint8_t
			 $this->cRecvRegionCodeExt_u = 0; // uint8_t
			 $this->cDealDigest_u = 0; // uint8_t
			 $this->cIcsonShippingType_u = 0; // uint8_t
			 $this->cIcsonPayType_u = 0; // uint8_t
			 $this->cIcsonAccount_u = 0; // uint8_t
			 $this->cIcsonMasterLs_u = 0; // uint8_t
			 $this->cIcsonRate_u = 0; // uint8_t
			 $this->cIcsonBankRate_u = 0; // uint8_t
			 $this->cIcsonShopId_u = 0; // uint8_t
			 $this->cIcsonShopGuideId_u = 0; // uint8_t
			 $this->cIcsonShopGuideCost_u = 0; // uint8_t
			 $this->cIcsonShopGuideName_u = 0; // uint8_t
			 $this->cIcsonSubsidyType_u = 0; // uint8_t
			 $this->cIcsonSubsidyName_u = 0; // uint8_t
			 $this->cIcsonSubsidyIdCard_u = 0; // uint8_t
			 $this->cIcsonCSOrderOperatorId_u = 0; // uint8_t
			 $this->cIcsonCSOrderOperatorName_u = 0; // uint8_t
			 $this->cIcsonInvoiceCompanyName_u = 0; // uint8_t
			 $this->cIcsonInvoiceCompanyAddr_u = 0; // uint8_t
			 $this->cIcsonInvoiceCompanyPhone_u = 0; // uint8_t
			 $this->cIcsonInvoiceCompanyTaxNo_u = 0; // uint8_t
			 $this->cIcsonInvoiceCompanyBankNo_u = 0; // uint8_t
			 $this->cIcsonInvoiceCompanyBankName_u = 0; // uint8_t
			 $this->cIcsonInvoiceRecvName_u = 0; // uint8_t
			 $this->cIcsonInvoiceRecvAddr_u = 0; // uint8_t
			 $this->cIcsonInvoiceRecvRegionId_u = 0; // uint8_t
			 $this->cIcsonInvoiceRecvMobile_u = 0; // uint8_t
			 $this->cIcsonInvoiceRecvTel_u = 0; // uint8_t
			 $this->cIcsonInvoiceRecvZip_u = 0; // uint8_t
			 $this->cIcsonInvoiceShipType_u = 0; // uint8_t
			 $this->cIcsonInvoiceShipFee_u = 0; // uint8_t
			 $this->cIcsonDealFlag_u = 0; // uint8_t
			 $this->cIcsonStockNo_u = 0; // uint8_t
			 $this->dwIcsonDealCashBack = 0; // uint32_t
			 $this->cIcsonDealCashBack_u = 0; // uint8_t
			 $this->strIcsonDealCode = ""; // std::string
			 $this->cIcsonDealCode_u = 0; // uint8_t
			 $this->strIcsonInvoiceStockNo = ""; // std::string
			 $this->strIcsonInvoiceSiteId = ""; // std::string
			 $this->cIcsonInvoiceStockNo_u = 0; // uint8_t
			 $this->cIcsonInvoiceSiteId_u = 0; // uint8_t
			 $this->ddwSellerCorpId = 0; // uint64_t
			 $this->strLmsVolume = ""; // std::string
			 $this->strLmsWeight = ""; // std::string
			 $this->strLmsLongest = ""; // std::string
			 $this->cSellerCorpId_u = 0; // uint8_t
			 $this->cLmsVolume_u = 0; // uint8_t
			 $this->cLmsWeight_u = 0; // uint8_t
			 $this->cLmsLongest_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushString($this->strDealId); // 序列化订单编号，格式:订单序号XXXXYYYY，如:101041051509351702 类型为std::string
			$bs->pushUint64_t($this->ddwDealId64); // 序列化订单单号，统一平台内部单号 类型为uint64_t
			$bs->pushUint64_t($this->ddwBdealId); // 序列化交易单号，买卖家一次交易行为描述 类型为uint64_t
			$bs->pushString($this->strBusinessDealId); // 序列化业务订单编号，第三方托管订单 类型为std::string
			$bs->pushUint64_t($this->ddwBuyerId); // 序列化买家ID 类型为uint64_t
			$bs->pushString($this->strBuyerAccount); // 序列化买家帐号 类型为std::string
			$bs->pushString($this->strBuyerNickName); // 序列化买家姓名 类型为std::string
			$bs->pushString($this->strBuyerNick); // 序列化买家昵称 类型为std::string
			$bs->pushUint64_t($this->ddwSellerId); // 序列化商家ID 类型为uint64_t
			$bs->pushString($this->strSellerTitle); // 序列化商家真实名称 类型为std::string
			$bs->pushString($this->strSellerNick); // 序列化卖家昵称 类型为std::string
			$bs->pushUint32_t($this->dwBusinessId); // 序列化业务ID 类型为uint32_t
			$bs->pushUint8_t($this->cDealType); // 序列化订单类型 类型为uint8_t
			$bs->pushUint32_t($this->dwDealSource); // 序列化下单渠道：1：业务主站；2：移动app；3：移动wap 类型为uint32_t
			$bs->pushUint8_t($this->cDealPayType); // 序列化支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款 类型为uint8_t
			$bs->pushUint32_t($this->dwDealState); // 序列化订单状态 类型为uint32_t
			$bs->pushUint32_t($this->dwPreDealState); // 序列化订单前一个状态 类型为uint32_t
			$bs->pushUint32_t($this->dwDealProperty); // 序列化订单属性值，通用 类型为uint32_t
			$bs->pushUint32_t($this->dwDealProperty1); // 序列化订单属性值，业务1扩展用 类型为uint32_t
			$bs->pushUint32_t($this->dwDealProperty2); // 序列化订单属性值，业务2扩展用 类型为uint32_t
			$bs->pushUint32_t($this->dwDealProperty3); // 序列化订单属性值，业务3扩展用 类型为uint32_t
			$bs->pushUint32_t($this->dwDealProperty4); // 序列化订单属性值，业务4扩展用 类型为uint32_t
			$bs->pushUint32_t($this->dwRefundState); // 序列化退款状态, 各子单退款状态的汇总, 0:无退款,1:退款中,2:退款完成 类型为uint32_t
			$bs->pushUint32_t($this->dwEvalState); // 序列化评价评论状态 类型为uint32_t
			$bs->pushString($this->strItemSkuidList); // 序列化商品skuID列表 类型为std::string
			$bs->pushString($this->strItemTitleList); // 序列化商品标题列表 类型为std::string
			$bs->pushUint32_t($this->dwDealTotalFee); // 序列化订单总金额,下单金额 类型为uint32_t
			$bs->pushInt32_t($this->nDealAdjustFee); // 序列化调价金额 类型为int
			$bs->pushUint32_t($this->dwDealPayment); // 序列化实付总金额 类型为uint32_t
			$bs->pushUint32_t($this->dwDealDownPayment); // 序列化C2B预售定金金额 类型为uint32_t
			$bs->pushInt32_t($this->nDealDiscountTotal); // 序列化优惠总金额 类型为int
			$bs->pushUint32_t($this->dwDealItemTotalFee); // 序列化商品总金额 类型为uint32_t
			$bs->pushUint32_t($this->dwDealWhoPayShippingFee); // 序列化谁支付邮费，1：卖家；2：买家 类型为uint32_t
			$bs->pushUint32_t($this->dwDealShippingFee); // 序列化邮费金额 类型为uint32_t
			$bs->pushUint32_t($this->dwDealWhoPayCodFee); // 序列化谁承担COD手续费，1：卖家承担；2：买家；3：平台承担 类型为uint32_t
			$bs->pushUint32_t($this->dwDealCodFee); // 序列化COD手续额 类型为uint32_t
			$bs->pushUint32_t($this->dwDealWhoPayInsuranceFee); // 序列化谁支付保险费，1：卖家赠送；2：买家；3：平台承担 类型为uint32_t
			$bs->pushUint32_t($this->dwDealInsuranceFee); // 序列化运费保险费 类型为uint32_t
			$bs->pushInt32_t($this->nDealSysAdjustFee); // 序列化系统调价金额，用于区分COD卖家调价金额和用于凑整的COD优惠金额 类型为int
			$bs->pushUint32_t($this->dwDealRefundTotalFee); // 序列化退款总金额费 类型为uint32_t
			$bs->pushUint32_t($this->dwPayScore); // 序列化积分支付值 类型为uint32_t
			$bs->pushUint32_t($this->dwObtainScore); // 序列化获得积分值 类型为uint32_t
			$bs->pushUint32_t($this->dwDealGenTime); // 序列化商品单生成时间 类型为uint32_t
			$bs->pushString($this->strSendFromDesc); // 序列化订单发货地描述 类型为std::string
			$bs->pushUint64_t($this->ddwDealSeq); // 序列化下单时间戳 类型为uint64_t
			$bs->pushUint64_t($this->ddwDealMd5); // 序列化下单md5 类型为uint64_t
			$bs->pushString($this->strDealIp); // 序列化下单IP 类型为std::string
			$bs->pushString($this->strDealRefer); // 序列化refer 类型为std::string
			$bs->pushString($this->strDealVisitKey); // 序列化visitkey 类型为std::string
			$bs->pushString($this->strPromotionDesc); // 序列化订单促销信息描述 类型为std::string
			$bs->pushString($this->strRecvName); // 序列化收货人 类型为std::string
			$bs->pushUint32_t($this->dwRecvRegionCode); // 序列化地区编码 类型为uint32_t
			$bs->pushString($this->strRecvAddress); // 序列化地址 类型为std::string
			$bs->pushString($this->strRecvPostCode); // 序列化邮编 类型为std::string
			$bs->pushString($this->strRecvPhone); // 序列化电话 类型为std::string
			$bs->pushUint64_t($this->ddwRecvMobile); // 序列化手机 类型为uint64_t
			$bs->pushUint32_t($this->dwExpectRecvTime); // 序列化期望收货时间,天 类型为uint32_t
			$bs->pushString($this->strExpectRecvTimeSpan); // 序列化期望收货时段 类型为std::string
			$bs->pushString($this->strRecvRemark); // 序列化收货附言 类型为std::string
			$bs->pushUint32_t($this->dwRecvMask); // 序列化收货属性值 类型为uint32_t
			$bs->pushUint8_t($this->cExpressType); // 序列化配送方式；1：平邮；2：快递；3：EMS；4：B2C自建物流；5：用户配送点自提 类型为uint8_t
			$bs->pushString($this->strExpressCompanyID); // 序列化物流公司ID 类型为std::string
			$bs->pushString($this->strExpressCompanyName); // 序列化物流公司名称 类型为std::string
			$bs->pushString($this->strExpressDealID); // 序列化物流公司订单号 类型为std::string
			$bs->pushUint16_t($this->wExpectArriveDays); // 序列化预计到达天数 类型为uint16_t
			$bs->pushString($this->strWuliuDealId); // 序列化物流订单号，物流系统物流单 类型为std::string
			$bs->pushUint8_t($this->cInvoiceType); // 序列化发票类型 类型为uint8_t
			$bs->pushString($this->strInvoiceHead); // 序列化发票抬头 类型为std::string
			$bs->pushString($this->strInvoiceContent); // 序列化发票内容 类型为std::string
			$bs->pushString($this->strPayAccount); // 序列化支付帐号 类型为std::string
			$bs->pushString($this->strCftDealId); // 序列化Cft支付单号 类型为std::string
			$bs->pushUint32_t($this->dwDealPayTime); // 序列化付款完成时间 类型为uint32_t
			$bs->pushUint32_t($this->dwDealPayReturnTime); // 序列化付款返回时间 类型为uint32_t
			$bs->pushUint32_t($this->dwDealCheckTime); // 序列化审核时间 类型为uint32_t
			$bs->pushUint32_t($this->dwDealCheckVersion); // 序列化审核版本号 类型为uint32_t
			$bs->pushString($this->strDealCheckDesc); // 序列化审核描述 类型为std::string
			$bs->pushUint32_t($this->dwDealSellerSendTime); // 序列化商家发货时间 类型为uint32_t
			$bs->pushUint32_t($this->dwDealConsignTime); // 序列化标记发货时间 类型为uint32_t
			$bs->pushUint32_t($this->dwDealConfirmRecvTime); // 序列化签收时间 类型为uint32_t
			$bs->pushUint32_t($this->dwDealEndTime); // 序列化结束时间 类型为uint32_t
			$bs->pushUint32_t($this->dwDealRecvFeeTime); // 序列化打款完成时间 类型为uint32_t
			$bs->pushUint32_t($this->dwDealRecvFeeReturnTime); // 序列化打款返回时间 类型为uint32_t
			$bs->pushUint32_t($this->dwDealBuyerRecvFee); // 序列化打款买家总金额 类型为uint32_t
			$bs->pushUint32_t($this->dwDealSellerRecvFee); // 序列化打款卖家总金额 类型为uint32_t
			$bs->pushUint32_t($this->dwDealPayCash); // 序列化支付现金金额 类型为uint32_t
			$bs->pushUint32_t($this->dwDealPayTicket); // 序列化支付财付券金额 类型为uint32_t
			$bs->pushUint32_t($this->dwDealPayCredit); // 序列化支付积分金额 类型为uint32_t
			$bs->pushUint32_t($this->dwDealPayOther); // 序列化其他支付金额 类型为uint32_t
			$bs->pushUint32_t($this->dwDelayConfirmDays); // 序列化延长确认收货天数 类型为uint32_t
			$bs->pushUint8_t($this->cBuyerTag); // 序列化买家标记 类型为uint8_t
			$bs->pushString($this->strBuyerNote); // 序列化买家备注 类型为std::string
			$bs->pushUint8_t($this->cSellerTag); // 序列化卖家标记 类型为uint8_t
			$bs->pushString($this->strSellerNote); // 序列化卖家备注 类型为std::string
			$bs->pushUint32_t($this->dwDataVersion); // 序列化数据版本号 类型为uint32_t
			$bs->pushUint32_t($this->dwDelFlag); // 序列化订单有效标记 类型为uint32_t
			$bs->pushUint32_t($this->dwVisibleState); // 序列化可见标识 类型为uint32_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // 序列化最后更新时间 类型为uint32_t
			$bs->pushObject($this->oTradeInfoList,'TradePoList'); // 序列化商品子单列表 类型为ecc::deal::po::CTradePoList
			$bs->pushObject($this->oPayInfoList,'PayInfoPoList'); // 序列化支付信息表 类型为ecc::deal::po::CPayInfoPoList
			$bs->pushObject($this->oWuliuInfoList,'DealWuliuPoList'); // 序列化物流信息表 类型为ecc::deal::po::CDealWuliuPoList
			$bs->pushObject($this->oRecvFeeInfoList,'RecvFeePoList'); // 序列化打款信息表 类型为ecc::deal::po::CRecvFeePoList
			$bs->pushObject($this->oRefundInfoList,'DealRefundPoList'); // 序列化退款信息表 类型为ecc::deal::po::CDealRefundPoList
			$bs->pushObject($this->oActionLogInfoList,'DealActionLogPoList'); // 序列化流水日志表 类型为ecc::deal::po::CDealActionLogPoList
			$bs->pushObject($this->mmapDealExtInfoMap,'stl_multimap'); // 序列化订单扩展信息  类型为std::multimap<uint32_t,std::string> 
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId64_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBdealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBusinessDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerAccount_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerNickName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerNick_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerTitle_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerNick_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBusinessId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealSource_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealPayType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPreDealState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealProperty_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealProperty1_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealProperty2_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealProperty3_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealProperty4_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cEvalState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemSkuidList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemTitleList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealTotalFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealAdjustFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealPayment_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealDownPayment_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealDiscountTotal_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealItemTotalFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealWhoPayShippingFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealShippingFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealWhoPayCodFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealCodFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealWhoPayInsuranceFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealInsuranceFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealSysAdjustFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealRefundTotalFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayScore_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cObtainScore_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealGenTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSendFromDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealSeq_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealMd5_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealIp_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealRefer_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealVisitKey_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPromotionDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvRegionCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvAddress_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvPostCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvPhone_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvMobile_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExpectRecvTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExpectRecvTimeSpan_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvRemark_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvMask_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExpressType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExpressCompanyID_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExpressCompanyName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExpressDealID_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExpectArriveDays_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cWuliuDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cInvoiceType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cInvoiceHead_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cInvoiceContent_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayAccount_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCftDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealPayTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealPayReturnTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealCheckTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealCheckVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealCheckDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealSellerSendTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealConsignTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealConfirmRecvTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealEndTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealRecvFeeTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealRecvFeeReturnTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealBuyerRecvFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealSellerRecvFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealPayCash_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealPayTicket_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealPayCredit_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealPayOther_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDelayConfirmDays_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerTag_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerNote_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerTag_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerNote_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDataVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDelFlag_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cVisibleState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeInfoList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayInfoList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cWuliuInfoList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvFeeInfoList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundInfoList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cActionLogInfoList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealExtInfoMap_u); // 序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strBdealCode); // 序列化交易单编号，即字符串格式的交易单号 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strBusinessBdealId); // 序列化业务交易单号 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwSiteId); // 序列化分站ID 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushInt32_t($this->nDealCouponFee); // 序列化优惠券金额 类型为int
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwCashScore); // 序列化现金积分支付值 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwPromotionScore); // 序列化促销积分支付值 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strRecvRegionCodeExt); // 序列化扩展地区编码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strDealDigest); // 序列化订单摘要 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonShippingType); // 序列化易迅配送方式 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonPayType); // 序列化易迅支付方式 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonAccount); // 序列化易迅内部帐号ID 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonMasterLs); // 序列化易迅跟踪信息 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonRate); // 序列化易迅平衡比率 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonBankRate); // 序列化易迅银行利率 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonShopId); // 序列化易迅店铺id 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonShopGuideId); // 序列化易迅店铺导购id 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonShopGuideCost); // 序列化易迅店铺导购费用 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonShopGuideName); // 序列化易迅店铺导购名称 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonSubsidyType); // 序列化易迅节能补贴类型 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonSubsidyName); // 序列化易迅节能补贴姓名 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonSubsidyIdCard); // 序列化易迅节能补贴身份证 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSOrderOperatorId); // 序列化易迅客服下单操作员ID 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSOrderOperatorName); // 序列化易迅客服下单操作员名称 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceCompanyName); // 序列化易迅发票公司名称 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceCompanyAddr); // 序列化易迅发票公司地址 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceCompanyPhone); // 序列化易迅发票公司电话 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceCompanyTaxNo); // 序列化易迅发票公司税号 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceCompanyBankNo); // 序列化易迅发票公司银行账户 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceCompanyBankName); // 序列化易迅发票公司银行名称 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceRecvName); // 序列化易迅发票收货人 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceRecvAddr); // 序列化易迅发票收货地址 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceRecvRegionId); // 序列化易迅发票收货地址ID 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceRecvMobile); // 序列化易迅发票收货手机 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceRecvTel); // 序列化易迅发票收货电话 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceRecvZip); // 序列化易迅发票收货邮编 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceShipType); // 序列化易迅发票配送方式 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceShipFee); // 序列化易迅发票配送费用 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonDealFlag); // 序列化易迅订单flag 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonStockNo); // 序列化易迅订单物流仓库编号 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cBdealCode_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cBusinessBdealId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cSiteId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cDealCouponFee_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cCashScore_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cPromotionScore_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cRecvRegionCodeExt_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cDealDigest_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonShippingType_u); // 序列化易迅配送方式UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonPayType_u); // 序列化易迅支付方式UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonAccount_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonMasterLs_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonRate_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonBankRate_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonShopId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonShopGuideId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonShopGuideCost_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonShopGuideName_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonSubsidyType_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonSubsidyName_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonSubsidyIdCard_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSOrderOperatorId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSOrderOperatorName_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceCompanyName_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceCompanyAddr_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceCompanyPhone_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceCompanyTaxNo_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceCompanyBankNo_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceCompanyBankName_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceRecvName_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceRecvAddr_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceRecvRegionId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceRecvMobile_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceRecvTel_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceRecvZip_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceShipType_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceShipFee_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonDealFlag_u); // 序列化易迅订单flag 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonStockNo_u); // 序列化易迅订单物流仓库编号 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwIcsonDealCashBack); // 序列化订单返现金额 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cIcsonDealCashBack_u); // 序列化订单返现金额UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 3 ){
				$bs->pushString($this->strIcsonDealCode); // 序列化易迅订单号，带10开头 类型为std::string
			}
			if(  $this->wVersion >= 3 ){
				$bs->pushUint8_t($this->cIcsonDealCode_u); // 序列化订单返现金额UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 4 ){
				$bs->pushString($this->strIcsonInvoiceStockNo); // 序列化易迅货票分离仓库id 类型为std::string
			}
			if(  $this->wVersion >= 4 ){
				$bs->pushString($this->strIcsonInvoiceSiteId); // 序列化易迅货票分离分站id 类型为std::string
			}
			if(  $this->wVersion >= 4 ){
				$bs->pushUint8_t($this->cIcsonInvoiceStockNo_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 4 ){
				$bs->pushUint8_t($this->cIcsonInvoiceSiteId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 5 ){
				$bs->pushUint64_t($this->ddwSellerCorpId); // 序列化易迅联营商家id 类型为uint64_t
			}
			if(  $this->wVersion >= 5 ){
				$bs->pushString($this->strLmsVolume); // 序列化易迅联营体积 类型为std::string
			}
			if(  $this->wVersion >= 5 ){
				$bs->pushString($this->strLmsWeight); // 序列化易迅联营重量 类型为std::string
			}
			if(  $this->wVersion >= 5 ){
				$bs->pushString($this->strLmsLongest); // 序列化易迅联营最长边 类型为std::string
			}
			if(  $this->wVersion >= 5 ){
				$bs->pushUint8_t($this->cSellerCorpId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 5 ){
				$bs->pushUint8_t($this->cLmsVolume_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 5 ){
				$bs->pushUint8_t($this->cLmsWeight_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 5 ){
				$bs->pushUint8_t($this->cLmsLongest_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->strDealId = $bs->popString(); // 反序列化订单编号，格式:订单序号XXXXYYYY，如:101041051509351702 类型为std::string
			$this->ddwDealId64 = $bs->popUint64_t(); // 反序列化订单单号，统一平台内部单号 类型为uint64_t
			$this->ddwBdealId = $bs->popUint64_t(); // 反序列化交易单号，买卖家一次交易行为描述 类型为uint64_t
			$this->strBusinessDealId = $bs->popString(); // 反序列化业务订单编号，第三方托管订单 类型为std::string
			$this->ddwBuyerId = $bs->popUint64_t(); // 反序列化买家ID 类型为uint64_t
			$this->strBuyerAccount = $bs->popString(); // 反序列化买家帐号 类型为std::string
			$this->strBuyerNickName = $bs->popString(); // 反序列化买家姓名 类型为std::string
			$this->strBuyerNick = $bs->popString(); // 反序列化买家昵称 类型为std::string
			$this->ddwSellerId = $bs->popUint64_t(); // 反序列化商家ID 类型为uint64_t
			$this->strSellerTitle = $bs->popString(); // 反序列化商家真实名称 类型为std::string
			$this->strSellerNick = $bs->popString(); // 反序列化卖家昵称 类型为std::string
			$this->dwBusinessId = $bs->popUint32_t(); // 反序列化业务ID 类型为uint32_t
			$this->cDealType = $bs->popUint8_t(); // 反序列化订单类型 类型为uint8_t
			$this->dwDealSource = $bs->popUint32_t(); // 反序列化下单渠道：1：业务主站；2：移动app；3：移动wap 类型为uint32_t
			$this->cDealPayType = $bs->popUint8_t(); // 反序列化支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款 类型为uint8_t
			$this->dwDealState = $bs->popUint32_t(); // 反序列化订单状态 类型为uint32_t
			$this->dwPreDealState = $bs->popUint32_t(); // 反序列化订单前一个状态 类型为uint32_t
			$this->dwDealProperty = $bs->popUint32_t(); // 反序列化订单属性值，通用 类型为uint32_t
			$this->dwDealProperty1 = $bs->popUint32_t(); // 反序列化订单属性值，业务1扩展用 类型为uint32_t
			$this->dwDealProperty2 = $bs->popUint32_t(); // 反序列化订单属性值，业务2扩展用 类型为uint32_t
			$this->dwDealProperty3 = $bs->popUint32_t(); // 反序列化订单属性值，业务3扩展用 类型为uint32_t
			$this->dwDealProperty4 = $bs->popUint32_t(); // 反序列化订单属性值，业务4扩展用 类型为uint32_t
			$this->dwRefundState = $bs->popUint32_t(); // 反序列化退款状态, 各子单退款状态的汇总, 0:无退款,1:退款中,2:退款完成 类型为uint32_t
			$this->dwEvalState = $bs->popUint32_t(); // 反序列化评价评论状态 类型为uint32_t
			$this->strItemSkuidList = $bs->popString(); // 反序列化商品skuID列表 类型为std::string
			$this->strItemTitleList = $bs->popString(); // 反序列化商品标题列表 类型为std::string
			$this->dwDealTotalFee = $bs->popUint32_t(); // 反序列化订单总金额,下单金额 类型为uint32_t
			$this->nDealAdjustFee = $bs->popInt32_t(); // 反序列化调价金额 类型为int
			$this->dwDealPayment = $bs->popUint32_t(); // 反序列化实付总金额 类型为uint32_t
			$this->dwDealDownPayment = $bs->popUint32_t(); // 反序列化C2B预售定金金额 类型为uint32_t
			$this->nDealDiscountTotal = $bs->popInt32_t(); // 反序列化优惠总金额 类型为int
			$this->dwDealItemTotalFee = $bs->popUint32_t(); // 反序列化商品总金额 类型为uint32_t
			$this->dwDealWhoPayShippingFee = $bs->popUint32_t(); // 反序列化谁支付邮费，1：卖家；2：买家 类型为uint32_t
			$this->dwDealShippingFee = $bs->popUint32_t(); // 反序列化邮费金额 类型为uint32_t
			$this->dwDealWhoPayCodFee = $bs->popUint32_t(); // 反序列化谁承担COD手续费，1：卖家承担；2：买家；3：平台承担 类型为uint32_t
			$this->dwDealCodFee = $bs->popUint32_t(); // 反序列化COD手续额 类型为uint32_t
			$this->dwDealWhoPayInsuranceFee = $bs->popUint32_t(); // 反序列化谁支付保险费，1：卖家赠送；2：买家；3：平台承担 类型为uint32_t
			$this->dwDealInsuranceFee = $bs->popUint32_t(); // 反序列化运费保险费 类型为uint32_t
			$this->nDealSysAdjustFee = $bs->popInt32_t(); // 反序列化系统调价金额，用于区分COD卖家调价金额和用于凑整的COD优惠金额 类型为int
			$this->dwDealRefundTotalFee = $bs->popUint32_t(); // 反序列化退款总金额费 类型为uint32_t
			$this->dwPayScore = $bs->popUint32_t(); // 反序列化积分支付值 类型为uint32_t
			$this->dwObtainScore = $bs->popUint32_t(); // 反序列化获得积分值 类型为uint32_t
			$this->dwDealGenTime = $bs->popUint32_t(); // 反序列化商品单生成时间 类型为uint32_t
			$this->strSendFromDesc = $bs->popString(); // 反序列化订单发货地描述 类型为std::string
			$this->ddwDealSeq = $bs->popUint64_t(); // 反序列化下单时间戳 类型为uint64_t
			$this->ddwDealMd5 = $bs->popUint64_t(); // 反序列化下单md5 类型为uint64_t
			$this->strDealIp = $bs->popString(); // 反序列化下单IP 类型为std::string
			$this->strDealRefer = $bs->popString(); // 反序列化refer 类型为std::string
			$this->strDealVisitKey = $bs->popString(); // 反序列化visitkey 类型为std::string
			$this->strPromotionDesc = $bs->popString(); // 反序列化订单促销信息描述 类型为std::string
			$this->strRecvName = $bs->popString(); // 反序列化收货人 类型为std::string
			$this->dwRecvRegionCode = $bs->popUint32_t(); // 反序列化地区编码 类型为uint32_t
			$this->strRecvAddress = $bs->popString(); // 反序列化地址 类型为std::string
			$this->strRecvPostCode = $bs->popString(); // 反序列化邮编 类型为std::string
			$this->strRecvPhone = $bs->popString(); // 反序列化电话 类型为std::string
			$this->ddwRecvMobile = $bs->popUint64_t(); // 反序列化手机 类型为uint64_t
			$this->dwExpectRecvTime = $bs->popUint32_t(); // 反序列化期望收货时间,天 类型为uint32_t
			$this->strExpectRecvTimeSpan = $bs->popString(); // 反序列化期望收货时段 类型为std::string
			$this->strRecvRemark = $bs->popString(); // 反序列化收货附言 类型为std::string
			$this->dwRecvMask = $bs->popUint32_t(); // 反序列化收货属性值 类型为uint32_t
			$this->cExpressType = $bs->popUint8_t(); // 反序列化配送方式；1：平邮；2：快递；3：EMS；4：B2C自建物流；5：用户配送点自提 类型为uint8_t
			$this->strExpressCompanyID = $bs->popString(); // 反序列化物流公司ID 类型为std::string
			$this->strExpressCompanyName = $bs->popString(); // 反序列化物流公司名称 类型为std::string
			$this->strExpressDealID = $bs->popString(); // 反序列化物流公司订单号 类型为std::string
			$this->wExpectArriveDays = $bs->popUint16_t(); // 反序列化预计到达天数 类型为uint16_t
			$this->strWuliuDealId = $bs->popString(); // 反序列化物流订单号，物流系统物流单 类型为std::string
			$this->cInvoiceType = $bs->popUint8_t(); // 反序列化发票类型 类型为uint8_t
			$this->strInvoiceHead = $bs->popString(); // 反序列化发票抬头 类型为std::string
			$this->strInvoiceContent = $bs->popString(); // 反序列化发票内容 类型为std::string
			$this->strPayAccount = $bs->popString(); // 反序列化支付帐号 类型为std::string
			$this->strCftDealId = $bs->popString(); // 反序列化Cft支付单号 类型为std::string
			$this->dwDealPayTime = $bs->popUint32_t(); // 反序列化付款完成时间 类型为uint32_t
			$this->dwDealPayReturnTime = $bs->popUint32_t(); // 反序列化付款返回时间 类型为uint32_t
			$this->dwDealCheckTime = $bs->popUint32_t(); // 反序列化审核时间 类型为uint32_t
			$this->dwDealCheckVersion = $bs->popUint32_t(); // 反序列化审核版本号 类型为uint32_t
			$this->strDealCheckDesc = $bs->popString(); // 反序列化审核描述 类型为std::string
			$this->dwDealSellerSendTime = $bs->popUint32_t(); // 反序列化商家发货时间 类型为uint32_t
			$this->dwDealConsignTime = $bs->popUint32_t(); // 反序列化标记发货时间 类型为uint32_t
			$this->dwDealConfirmRecvTime = $bs->popUint32_t(); // 反序列化签收时间 类型为uint32_t
			$this->dwDealEndTime = $bs->popUint32_t(); // 反序列化结束时间 类型为uint32_t
			$this->dwDealRecvFeeTime = $bs->popUint32_t(); // 反序列化打款完成时间 类型为uint32_t
			$this->dwDealRecvFeeReturnTime = $bs->popUint32_t(); // 反序列化打款返回时间 类型为uint32_t
			$this->dwDealBuyerRecvFee = $bs->popUint32_t(); // 反序列化打款买家总金额 类型为uint32_t
			$this->dwDealSellerRecvFee = $bs->popUint32_t(); // 反序列化打款卖家总金额 类型为uint32_t
			$this->dwDealPayCash = $bs->popUint32_t(); // 反序列化支付现金金额 类型为uint32_t
			$this->dwDealPayTicket = $bs->popUint32_t(); // 反序列化支付财付券金额 类型为uint32_t
			$this->dwDealPayCredit = $bs->popUint32_t(); // 反序列化支付积分金额 类型为uint32_t
			$this->dwDealPayOther = $bs->popUint32_t(); // 反序列化其他支付金额 类型为uint32_t
			$this->dwDelayConfirmDays = $bs->popUint32_t(); // 反序列化延长确认收货天数 类型为uint32_t
			$this->cBuyerTag = $bs->popUint8_t(); // 反序列化买家标记 类型为uint8_t
			$this->strBuyerNote = $bs->popString(); // 反序列化买家备注 类型为std::string
			$this->cSellerTag = $bs->popUint8_t(); // 反序列化卖家标记 类型为uint8_t
			$this->strSellerNote = $bs->popString(); // 反序列化卖家备注 类型为std::string
			$this->dwDataVersion = $bs->popUint32_t(); // 反序列化数据版本号 类型为uint32_t
			$this->dwDelFlag = $bs->popUint32_t(); // 反序列化订单有效标记 类型为uint32_t
			$this->dwVisibleState = $bs->popUint32_t(); // 反序列化可见标识 类型为uint32_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // 反序列化最后更新时间 类型为uint32_t
			$this->oTradeInfoList = $bs->popObject('TradePoList'); // 反序列化商品子单列表 类型为ecc::deal::po::CTradePoList
			$this->oPayInfoList = $bs->popObject('PayInfoPoList'); // 反序列化支付信息表 类型为ecc::deal::po::CPayInfoPoList
			$this->oWuliuInfoList = $bs->popObject('DealWuliuPoList'); // 反序列化物流信息表 类型为ecc::deal::po::CDealWuliuPoList
			$this->oRecvFeeInfoList = $bs->popObject('RecvFeePoList'); // 反序列化打款信息表 类型为ecc::deal::po::CRecvFeePoList
			$this->oRefundInfoList = $bs->popObject('DealRefundPoList'); // 反序列化退款信息表 类型为ecc::deal::po::CDealRefundPoList
			$this->oActionLogInfoList = $bs->popObject('DealActionLogPoList'); // 反序列化流水日志表 类型为ecc::deal::po::CDealActionLogPoList
			$this->mmapDealExtInfoMap = $bs->popObject('stl_multimap<uint32_t,stl_string>'); // 反序列化订单扩展信息  类型为std::multimap<uint32_t,std::string> 
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId64_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBdealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBusinessDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerAccount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerNickName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerNick_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerTitle_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerNick_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBusinessId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealSource_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealPayType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPreDealState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealProperty1_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealProperty2_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealProperty3_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealProperty4_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cEvalState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemSkuidList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemTitleList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealTotalFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealAdjustFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealPayment_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealDownPayment_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealDiscountTotal_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealItemTotalFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealWhoPayShippingFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealShippingFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealWhoPayCodFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealCodFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealWhoPayInsuranceFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealInsuranceFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealSysAdjustFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealRefundTotalFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayScore_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cObtainScore_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealGenTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSendFromDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealSeq_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealMd5_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealIp_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealRefer_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealVisitKey_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPromotionDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvRegionCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvAddress_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvPostCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvPhone_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvMobile_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExpectRecvTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExpectRecvTimeSpan_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvRemark_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvMask_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExpressType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExpressCompanyID_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExpressCompanyName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExpressDealID_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExpectArriveDays_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cWuliuDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cInvoiceType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cInvoiceHead_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cInvoiceContent_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayAccount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCftDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealPayTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealPayReturnTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealCheckTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealCheckVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealCheckDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealSellerSendTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealConsignTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealConfirmRecvTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealEndTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealRecvFeeTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealRecvFeeReturnTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealBuyerRecvFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealSellerRecvFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealPayCash_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealPayTicket_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealPayCredit_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealPayOther_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDelayConfirmDays_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerTag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerNote_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerTag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerNote_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDataVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDelFlag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cVisibleState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cWuliuInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvFeeInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cActionLogInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealExtInfoMap_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$this->strBdealCode = $bs->popString(); // 反序列化交易单编号，即字符串格式的交易单号 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strBusinessBdealId = $bs->popString(); // 反序列化业务交易单号 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->dwSiteId = $bs->popUint32_t(); // 反序列化分站ID 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->nDealCouponFee = $bs->popInt32_t(); // 反序列化优惠券金额 类型为int
			}
			if(  $this->wVersion >= 1 ){
				$this->dwCashScore = $bs->popUint32_t(); // 反序列化现金积分支付值 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->dwPromotionScore = $bs->popUint32_t(); // 反序列化促销积分支付值 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->strRecvRegionCodeExt = $bs->popString(); // 反序列化扩展地区编码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strDealDigest = $bs->popString(); // 反序列化订单摘要 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonShippingType = $bs->popString(); // 反序列化易迅配送方式 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonPayType = $bs->popString(); // 反序列化易迅支付方式 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonAccount = $bs->popString(); // 反序列化易迅内部帐号ID 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonMasterLs = $bs->popString(); // 反序列化易迅跟踪信息 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonRate = $bs->popString(); // 反序列化易迅平衡比率 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonBankRate = $bs->popString(); // 反序列化易迅银行利率 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonShopId = $bs->popString(); // 反序列化易迅店铺id 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonShopGuideId = $bs->popString(); // 反序列化易迅店铺导购id 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonShopGuideCost = $bs->popString(); // 反序列化易迅店铺导购费用 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonShopGuideName = $bs->popString(); // 反序列化易迅店铺导购名称 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonSubsidyType = $bs->popString(); // 反序列化易迅节能补贴类型 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonSubsidyName = $bs->popString(); // 反序列化易迅节能补贴姓名 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonSubsidyIdCard = $bs->popString(); // 反序列化易迅节能补贴身份证 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSOrderOperatorId = $bs->popString(); // 反序列化易迅客服下单操作员ID 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSOrderOperatorName = $bs->popString(); // 反序列化易迅客服下单操作员名称 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceCompanyName = $bs->popString(); // 反序列化易迅发票公司名称 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceCompanyAddr = $bs->popString(); // 反序列化易迅发票公司地址 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceCompanyPhone = $bs->popString(); // 反序列化易迅发票公司电话 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceCompanyTaxNo = $bs->popString(); // 反序列化易迅发票公司税号 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceCompanyBankNo = $bs->popString(); // 反序列化易迅发票公司银行账户 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceCompanyBankName = $bs->popString(); // 反序列化易迅发票公司银行名称 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceRecvName = $bs->popString(); // 反序列化易迅发票收货人 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceRecvAddr = $bs->popString(); // 反序列化易迅发票收货地址 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceRecvRegionId = $bs->popString(); // 反序列化易迅发票收货地址ID 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceRecvMobile = $bs->popString(); // 反序列化易迅发票收货手机 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceRecvTel = $bs->popString(); // 反序列化易迅发票收货电话 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceRecvZip = $bs->popString(); // 反序列化易迅发票收货邮编 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceShipType = $bs->popString(); // 反序列化易迅发票配送方式 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceShipFee = $bs->popString(); // 反序列化易迅发票配送费用 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonDealFlag = $bs->popString(); // 反序列化易迅订单flag 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonStockNo = $bs->popString(); // 反序列化易迅订单物流仓库编号 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cBdealCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cBusinessBdealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cSiteId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cDealCouponFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cCashScore_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cPromotionScore_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cRecvRegionCodeExt_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cDealDigest_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonShippingType_u = $bs->popUint8_t(); // 反序列化易迅配送方式UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonPayType_u = $bs->popUint8_t(); // 反序列化易迅支付方式UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonAccount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonMasterLs_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonRate_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonBankRate_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonShopId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonShopGuideId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonShopGuideCost_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonShopGuideName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonSubsidyType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonSubsidyName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonSubsidyIdCard_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSOrderOperatorId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSOrderOperatorName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceCompanyName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceCompanyAddr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceCompanyPhone_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceCompanyTaxNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceCompanyBankNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceCompanyBankName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceRecvName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceRecvAddr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceRecvRegionId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceRecvMobile_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceRecvTel_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceRecvZip_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceShipType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceShipFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonDealFlag_u = $bs->popUint8_t(); // 反序列化易迅订单flag 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonStockNo_u = $bs->popUint8_t(); // 反序列化易迅订单物流仓库编号 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwIcsonDealCashBack = $bs->popUint32_t(); // 反序列化订单返现金额 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cIcsonDealCashBack_u = $bs->popUint8_t(); // 反序列化订单返现金额UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 3 ){
				$this->strIcsonDealCode = $bs->popString(); // 反序列化易迅订单号，带10开头 类型为std::string
			}
			if(  $this->wVersion >= 3 ){
				$this->cIcsonDealCode_u = $bs->popUint8_t(); // 反序列化订单返现金额UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 4 ){
				$this->strIcsonInvoiceStockNo = $bs->popString(); // 反序列化易迅货票分离仓库id 类型为std::string
			}
			if(  $this->wVersion >= 4 ){
				$this->strIcsonInvoiceSiteId = $bs->popString(); // 反序列化易迅货票分离分站id 类型为std::string
			}
			if(  $this->wVersion >= 4 ){
				$this->cIcsonInvoiceStockNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 4 ){
				$this->cIcsonInvoiceSiteId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 5 ){
				$this->ddwSellerCorpId = $bs->popUint64_t(); // 反序列化易迅联营商家id 类型为uint64_t
			}
			if(  $this->wVersion >= 5 ){
				$this->strLmsVolume = $bs->popString(); // 反序列化易迅联营体积 类型为std::string
			}
			if(  $this->wVersion >= 5 ){
				$this->strLmsWeight = $bs->popString(); // 反序列化易迅联营重量 类型为std::string
			}
			if(  $this->wVersion >= 5 ){
				$this->strLmsLongest = $bs->popString(); // 反序列化易迅联营最长边 类型为std::string
			}
			if(  $this->wVersion >= 5 ){
				$this->cSellerCorpId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 5 ){
				$this->cLmsVolume_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 5 ){
				$this->cLmsWeight_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 5 ){
				$this->cLmsLongest_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.ecc.deal.idl.DealPo.java

if (!class_exists('PayInfoPoList')) {
class PayInfoPoList
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 支付单列表
		 *
		 * 版本 >= 0
		 */
		var $vecPayInfoList; //std::vector<ecc::deal::po::CPayInfoPo> 

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayInfoList_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->vecPayInfoList = new stl_vector('PayInfoPo'); // std::vector<ecc::deal::po::CPayInfoPo> 
			 $this->cVersion_u = 0; // uint8_t
			 $this->cPayInfoList_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化版本号 类型为uint16_t
			$bs->pushObject($this->vecPayInfoList,'stl_vector'); // 序列化支付单列表 类型为std::vector<ecc::deal::po::CPayInfoPo> 
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayInfoList_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化版本号 类型为uint16_t
			$this->vecPayInfoList = $bs->popObject('stl_vector<PayInfoPo>'); // 反序列化支付单列表 类型为std::vector<ecc::deal::po::CPayInfoPo> 
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.ecc.deal.idl.PayInfoPoList.java

if (!class_exists('PayInfoPo')) {
class PayInfoPo
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 支付单DB操作类型，0:Insert 1:Update
		 *
		 * 版本 >= 0
		 */
		var $dwControl; //uint32_t

		/**
		 * 支付单ID
		 *
		 * 版本 >= 0
		 */
		var $ddwPayId; //uint64_t

		/**
		 * 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		 *
		 * 版本 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * 订单单号，统一平台内部单号
		 *
		 * 版本 >= 0
		 */
		var $ddwDealId64; //uint64_t

		/**
		 * 交易单号，买卖家一次交易行为描述
		 *
		 * 版本 >= 0
		 */
		var $ddwBdealId; //uint64_t

		/**
		 * 买家ID
		 *
		 * 版本 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * 买家昵称
		 *
		 * 版本 >= 0
		 */
		var $strBuyerNickName; //std::string

		/**
		 * 商家ID
		 *
		 * 版本 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * 商家名称
		 *
		 * 版本 >= 0
		 */
		var $strSellerTitle; //std::string

		/**
		 * 商品标题列表
		 *
		 * 版本 >= 0
		 */
		var $strItemTitleList; //std::string

		/**
		 * 支付总金额
		 *
		 * 版本 >= 0
		 */
		var $dwPayTotalFee; //uint32_t

		/**
		 * 订单待付金额，等于商品实付金额+退运险
		 *
		 * 版本 >= 0
		 */
		var $dwPayDealTotalFee; //uint32_t

		/**
		 * 邮费金额
		 *
		 * 版本 >= 0
		 */
		var $dwPayShippingFee; //uint32_t

		/**
		 * 支付帐号
		 *
		 * 版本 >= 0
		 */
		var $strPayAccount; //std::string

		/**
		 * 支付单状态，1，未支付；2，支付完成
		 *
		 * 版本 >= 0
		 */
		var $dwPayState; //uint32_t

		/**
		 * 支付单标记
		 *
		 * 版本 >= 0
		 */
		var $dwPayProperty; //uint32_t

		/**
		 * 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款
		 *
		 * 版本 >= 0
		 */
		var $cPayType; //uint8_t

		/**
		 * 支付渠道
		 *
		 * 版本 >= 0
		 */
		var $cPayChannel; //uint8_t

		/**
		 * 支付银行ID
		 *
		 * 版本 >= 0
		 */
		var $strPayBank; //std::string

		/**
		 * 支付订单编号
		 *
		 * 版本 >= 0
		 */
		var $strPayDealId; //std::string

		/**
		 * 支付单生成时间
		 *
		 * 版本 >= 0
		 */
		var $dwPayGenTime; //uint32_t

		/**
		 * 支付单有效起始时间
		 *
		 * 版本 >= 0
		 */
		var $dwPayEnableBeginTime; //uint32_t

		/**
		 * 支付单有效结束时间
		 *
		 * 版本 >= 0
		 */
		var $dwPayEnableEndTime; //uint32_t

		/**
		 * 支付完成时间
		 *
		 * 版本 >= 0
		 */
		var $dwPayFinishTime; //uint32_t

		/**
		 * 支付返回时间
		 *
		 * 版本 >= 0
		 */
		var $dwPayReturnTime; //uint32_t

		/**
		 * 打款完成时间
		 *
		 * 版本 >= 0
		 */
		var $dwRecvFeeFinishTime; //uint32_t

		/**
		 * 打款返回时间
		 *
		 * 版本 >= 0
		 */
		var $dwRecvFeeReturnTime; //uint32_t

		/**
		 * 打款买家总金额
		 *
		 * 版本 >= 0
		 */
		var $dwPayBuyerRecvFee; //uint32_t

		/**
		 * 打款卖家总金额
		 *
		 * 版本 >= 0
		 */
		var $dwPaySellerRecvFee; //uint32_t

		/**
		 * 财付通订单生成时间
		 *
		 * 版本 >= 0
		 */
		var $dwCftDealGenTime; //uint32_t

		/**
		 * 现金支付金额
		 *
		 * 版本 >= 0
		 */
		var $dwPayCashFee; //uint32_t

		/**
		 * 现金券支付金额
		 *
		 * 版本 >= 0
		 */
		var $dwPayTicketFee; //uint32_t

		/**
		 * 积分支付金额
		 *
		 * 版本 >= 0
		 */
		var $dwPayCreditFee; //uint32_t

		/**
		 * 其他支付金额
		 *
		 * 版本 >= 0
		 */
		var $dwPayOthersFee; //uint32_t

		/**
		 * 支付手续费
		 *
		 * 版本 >= 0
		 */
		var $dwPayServiceFee; //uint32_t

		/**
		 * 谁承担COD手续费，1：卖家承担；2：买家；3：平台承担
		 *
		 * 版本 >= 0
		 */
		var $dwWhoPayCodFee; //uint32_t

		/**
		 * COD财付通支付手续费
		 *
		 * 版本 >= 0
		 */
		var $dwPayCodCftServiceFee; //uint32_t

		/**
		 * CODPaipai支付手续费
		 *
		 * 版本 >= 0
		 */
		var $dwPayCodPaipaiServiceFee; //uint32_t

		/**
		 * COD手续费调价金额
		 *
		 * 版本 >= 0
		 */
		var $nPayCodServiceAdjustFee; //int

		/**
		 * CODPaipai签收时间
		 *
		 * 版本 >= 0
		 */
		var $dwPayCodPaipaiConsignTime; //uint32_t

		/**
		 * COD物流支付手续费
		 *
		 * 版本 >= 0
		 */
		var $dwPayCodWuliuServiceFee; //uint32_t

		/**
		 * COD物流打款金额
		 *
		 * 版本 >= 0
		 */
		var $dwPayCodWuliuRecvFee; //uint32_t

		/**
		 * COD卖家打款金额
		 *
		 * 版本 >= 0
		 */
		var $dwPayCodSellerRecvFee; //uint32_t

		/**
		 * COD物流签收时间
		 *
		 * 版本 >= 0
		 */
		var $dwPayCodWuliuConsignTime; //uint32_t

		/**
		 * COD物流代收货款
		 *
		 * 版本 >= 0
		 */
		var $dwPayCodWuliuCollectionMoney; //uint32_t

		/**
		 * COD物流SPID
		 *
		 * 版本 >= 0
		 */
		var $strPayCodWuliuSpid; //std::string

		/**
		 * 分期付款银行
		 *
		 * 版本 >= 0
		 */
		var $strPayInstallmentBank; //std::string

		/**
		 * 分期付款期数
		 *
		 * 版本 >= 0
		 */
		var $wPayInstallmentNum; //uint16_t

		/**
		 * 分期付款每期金额
		 *
		 * 版本 >= 0
		 */
		var $dwPayInstallmentPayment; //uint32_t

		/**
		 * 最后更新时间
		 *
		 * 版本 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cControl_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId64_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBdealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerNickName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerTitle_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemTitleList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayTotalFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayDealTotalFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayShippingFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayAccount_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayProperty_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayChannel_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayBank_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayGenTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayEnableBeginTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayEnableEndTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayFinishTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayReturnTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvFeeFinishTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvFeeReturnTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayBuyerRecvFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPaySellerRecvFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCftDealGenTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayCashFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayTicketFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayCreditFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayOthersFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayServiceFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cWhoPayCodFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayCodCftServiceFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayCodPaipaiServiceFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayCodServiceAdjustFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayCodPaipaiConsignTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayCodWuliuServiceFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayCodWuliuRecvFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayCodSellerRecvFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayCodWuliuConsignTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayCodWuliuCollectionMoney_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayCodWuliuSpid_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayInstallmentBank_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayInstallmentNum_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayInstallmentPayment_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t

		/**
		 * 支付业务单号, 支付系统的业务订单号
		 *
		 * 版本 >= 1
		 */
		var $strPayBusinessId; //std::string

		/**
		 * 支付业务单号, 支付系统的业务订单号
		 *
		 * 版本 >= 1
		 */
		var $cPayBusinessId_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 1; // uint16_t
			 $this->dwControl = 0; // uint32_t
			 $this->ddwPayId = 0; // uint64_t
			 $this->strDealId = ""; // std::string
			 $this->ddwDealId64 = 0; // uint64_t
			 $this->ddwBdealId = 0; // uint64_t
			 $this->ddwBuyerId = 0; // uint64_t
			 $this->strBuyerNickName = ""; // std::string
			 $this->ddwSellerId = 0; // uint64_t
			 $this->strSellerTitle = ""; // std::string
			 $this->strItemTitleList = ""; // std::string
			 $this->dwPayTotalFee = 0; // uint32_t
			 $this->dwPayDealTotalFee = 0; // uint32_t
			 $this->dwPayShippingFee = 0; // uint32_t
			 $this->strPayAccount = ""; // std::string
			 $this->dwPayState = 0; // uint32_t
			 $this->dwPayProperty = 0; // uint32_t
			 $this->cPayType = 0; // uint8_t
			 $this->cPayChannel = 0; // uint8_t
			 $this->strPayBank = ""; // std::string
			 $this->strPayDealId = ""; // std::string
			 $this->dwPayGenTime = 0; // uint32_t
			 $this->dwPayEnableBeginTime = 0; // uint32_t
			 $this->dwPayEnableEndTime = 0; // uint32_t
			 $this->dwPayFinishTime = 0; // uint32_t
			 $this->dwPayReturnTime = 0; // uint32_t
			 $this->dwRecvFeeFinishTime = 0; // uint32_t
			 $this->dwRecvFeeReturnTime = 0; // uint32_t
			 $this->dwPayBuyerRecvFee = 0; // uint32_t
			 $this->dwPaySellerRecvFee = 0; // uint32_t
			 $this->dwCftDealGenTime = 0; // uint32_t
			 $this->dwPayCashFee = 0; // uint32_t
			 $this->dwPayTicketFee = 0; // uint32_t
			 $this->dwPayCreditFee = 0; // uint32_t
			 $this->dwPayOthersFee = 0; // uint32_t
			 $this->dwPayServiceFee = 0; // uint32_t
			 $this->dwWhoPayCodFee = 0; // uint32_t
			 $this->dwPayCodCftServiceFee = 0; // uint32_t
			 $this->dwPayCodPaipaiServiceFee = 0; // uint32_t
			 $this->nPayCodServiceAdjustFee = 0; // int
			 $this->dwPayCodPaipaiConsignTime = 0; // uint32_t
			 $this->dwPayCodWuliuServiceFee = 0; // uint32_t
			 $this->dwPayCodWuliuRecvFee = 0; // uint32_t
			 $this->dwPayCodSellerRecvFee = 0; // uint32_t
			 $this->dwPayCodWuliuConsignTime = 0; // uint32_t
			 $this->dwPayCodWuliuCollectionMoney = 0; // uint32_t
			 $this->strPayCodWuliuSpid = ""; // std::string
			 $this->strPayInstallmentBank = ""; // std::string
			 $this->wPayInstallmentNum = 0; // uint16_t
			 $this->dwPayInstallmentPayment = 0; // uint32_t
			 $this->dwLastUpdateTime = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->cControl_u = 0; // uint8_t
			 $this->cPayId_u = 0; // uint8_t
			 $this->cDealId_u = 0; // uint8_t
			 $this->cDealId64_u = 0; // uint8_t
			 $this->cBdealId_u = 0; // uint8_t
			 $this->cBuyerId_u = 0; // uint8_t
			 $this->cBuyerNickName_u = 0; // uint8_t
			 $this->cSellerId_u = 0; // uint8_t
			 $this->cSellerTitle_u = 0; // uint8_t
			 $this->cItemTitleList_u = 0; // uint8_t
			 $this->cPayTotalFee_u = 0; // uint8_t
			 $this->cPayDealTotalFee_u = 0; // uint8_t
			 $this->cPayShippingFee_u = 0; // uint8_t
			 $this->cPayAccount_u = 0; // uint8_t
			 $this->cPayState_u = 0; // uint8_t
			 $this->cPayProperty_u = 0; // uint8_t
			 $this->cPayType_u = 0; // uint8_t
			 $this->cPayChannel_u = 0; // uint8_t
			 $this->cPayBank_u = 0; // uint8_t
			 $this->cPayDealId_u = 0; // uint8_t
			 $this->cPayGenTime_u = 0; // uint8_t
			 $this->cPayEnableBeginTime_u = 0; // uint8_t
			 $this->cPayEnableEndTime_u = 0; // uint8_t
			 $this->cPayFinishTime_u = 0; // uint8_t
			 $this->cPayReturnTime_u = 0; // uint8_t
			 $this->cRecvFeeFinishTime_u = 0; // uint8_t
			 $this->cRecvFeeReturnTime_u = 0; // uint8_t
			 $this->cPayBuyerRecvFee_u = 0; // uint8_t
			 $this->cPaySellerRecvFee_u = 0; // uint8_t
			 $this->cCftDealGenTime_u = 0; // uint8_t
			 $this->cPayCashFee_u = 0; // uint8_t
			 $this->cPayTicketFee_u = 0; // uint8_t
			 $this->cPayCreditFee_u = 0; // uint8_t
			 $this->cPayOthersFee_u = 0; // uint8_t
			 $this->cPayServiceFee_u = 0; // uint8_t
			 $this->cWhoPayCodFee_u = 0; // uint8_t
			 $this->cPayCodCftServiceFee_u = 0; // uint8_t
			 $this->cPayCodPaipaiServiceFee_u = 0; // uint8_t
			 $this->cPayCodServiceAdjustFee_u = 0; // uint8_t
			 $this->cPayCodPaipaiConsignTime_u = 0; // uint8_t
			 $this->cPayCodWuliuServiceFee_u = 0; // uint8_t
			 $this->cPayCodWuliuRecvFee_u = 0; // uint8_t
			 $this->cPayCodSellerRecvFee_u = 0; // uint8_t
			 $this->cPayCodWuliuConsignTime_u = 0; // uint8_t
			 $this->cPayCodWuliuCollectionMoney_u = 0; // uint8_t
			 $this->cPayCodWuliuSpid_u = 0; // uint8_t
			 $this->cPayInstallmentBank_u = 0; // uint8_t
			 $this->cPayInstallmentNum_u = 0; // uint8_t
			 $this->cPayInstallmentPayment_u = 0; // uint8_t
			 $this->cLastUpdateTime_u = 0; // uint8_t
			 $this->strPayBusinessId = ""; // std::string
			 $this->cPayBusinessId_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化版本号 类型为uint16_t
			$bs->pushUint32_t($this->dwControl); // 序列化支付单DB操作类型，0:Insert 1:Update 类型为uint32_t
			$bs->pushUint64_t($this->ddwPayId); // 序列化支付单ID 类型为uint64_t
			$bs->pushString($this->strDealId); // 序列化订单编号，格式:订单序号XXXXYYYY，如:101041051509351702 类型为std::string
			$bs->pushUint64_t($this->ddwDealId64); // 序列化订单单号，统一平台内部单号 类型为uint64_t
			$bs->pushUint64_t($this->ddwBdealId); // 序列化交易单号，买卖家一次交易行为描述 类型为uint64_t
			$bs->pushUint64_t($this->ddwBuyerId); // 序列化买家ID 类型为uint64_t
			$bs->pushString($this->strBuyerNickName); // 序列化买家昵称 类型为std::string
			$bs->pushUint64_t($this->ddwSellerId); // 序列化商家ID 类型为uint64_t
			$bs->pushString($this->strSellerTitle); // 序列化商家名称 类型为std::string
			$bs->pushString($this->strItemTitleList); // 序列化商品标题列表 类型为std::string
			$bs->pushUint32_t($this->dwPayTotalFee); // 序列化支付总金额 类型为uint32_t
			$bs->pushUint32_t($this->dwPayDealTotalFee); // 序列化订单待付金额，等于商品实付金额+退运险 类型为uint32_t
			$bs->pushUint32_t($this->dwPayShippingFee); // 序列化邮费金额 类型为uint32_t
			$bs->pushString($this->strPayAccount); // 序列化支付帐号 类型为std::string
			$bs->pushUint32_t($this->dwPayState); // 序列化支付单状态，1，未支付；2，支付完成 类型为uint32_t
			$bs->pushUint32_t($this->dwPayProperty); // 序列化支付单标记 类型为uint32_t
			$bs->pushUint8_t($this->cPayType); // 序列化支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款 类型为uint8_t
			$bs->pushUint8_t($this->cPayChannel); // 序列化支付渠道 类型为uint8_t
			$bs->pushString($this->strPayBank); // 序列化支付银行ID 类型为std::string
			$bs->pushString($this->strPayDealId); // 序列化支付订单编号 类型为std::string
			$bs->pushUint32_t($this->dwPayGenTime); // 序列化支付单生成时间 类型为uint32_t
			$bs->pushUint32_t($this->dwPayEnableBeginTime); // 序列化支付单有效起始时间 类型为uint32_t
			$bs->pushUint32_t($this->dwPayEnableEndTime); // 序列化支付单有效结束时间 类型为uint32_t
			$bs->pushUint32_t($this->dwPayFinishTime); // 序列化支付完成时间 类型为uint32_t
			$bs->pushUint32_t($this->dwPayReturnTime); // 序列化支付返回时间 类型为uint32_t
			$bs->pushUint32_t($this->dwRecvFeeFinishTime); // 序列化打款完成时间 类型为uint32_t
			$bs->pushUint32_t($this->dwRecvFeeReturnTime); // 序列化打款返回时间 类型为uint32_t
			$bs->pushUint32_t($this->dwPayBuyerRecvFee); // 序列化打款买家总金额 类型为uint32_t
			$bs->pushUint32_t($this->dwPaySellerRecvFee); // 序列化打款卖家总金额 类型为uint32_t
			$bs->pushUint32_t($this->dwCftDealGenTime); // 序列化财付通订单生成时间 类型为uint32_t
			$bs->pushUint32_t($this->dwPayCashFee); // 序列化现金支付金额 类型为uint32_t
			$bs->pushUint32_t($this->dwPayTicketFee); // 序列化现金券支付金额 类型为uint32_t
			$bs->pushUint32_t($this->dwPayCreditFee); // 序列化积分支付金额 类型为uint32_t
			$bs->pushUint32_t($this->dwPayOthersFee); // 序列化其他支付金额 类型为uint32_t
			$bs->pushUint32_t($this->dwPayServiceFee); // 序列化支付手续费 类型为uint32_t
			$bs->pushUint32_t($this->dwWhoPayCodFee); // 序列化谁承担COD手续费，1：卖家承担；2：买家；3：平台承担 类型为uint32_t
			$bs->pushUint32_t($this->dwPayCodCftServiceFee); // 序列化COD财付通支付手续费 类型为uint32_t
			$bs->pushUint32_t($this->dwPayCodPaipaiServiceFee); // 序列化CODPaipai支付手续费 类型为uint32_t
			$bs->pushInt32_t($this->nPayCodServiceAdjustFee); // 序列化COD手续费调价金额 类型为int
			$bs->pushUint32_t($this->dwPayCodPaipaiConsignTime); // 序列化CODPaipai签收时间 类型为uint32_t
			$bs->pushUint32_t($this->dwPayCodWuliuServiceFee); // 序列化COD物流支付手续费 类型为uint32_t
			$bs->pushUint32_t($this->dwPayCodWuliuRecvFee); // 序列化COD物流打款金额 类型为uint32_t
			$bs->pushUint32_t($this->dwPayCodSellerRecvFee); // 序列化COD卖家打款金额 类型为uint32_t
			$bs->pushUint32_t($this->dwPayCodWuliuConsignTime); // 序列化COD物流签收时间 类型为uint32_t
			$bs->pushUint32_t($this->dwPayCodWuliuCollectionMoney); // 序列化COD物流代收货款 类型为uint32_t
			$bs->pushString($this->strPayCodWuliuSpid); // 序列化COD物流SPID 类型为std::string
			$bs->pushString($this->strPayInstallmentBank); // 序列化分期付款银行 类型为std::string
			$bs->pushUint16_t($this->wPayInstallmentNum); // 序列化分期付款期数 类型为uint16_t
			$bs->pushUint32_t($this->dwPayInstallmentPayment); // 序列化分期付款每期金额 类型为uint32_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // 序列化最后更新时间 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cControl_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId64_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBdealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerNickName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerTitle_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemTitleList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayTotalFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayDealTotalFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayShippingFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayAccount_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayProperty_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayChannel_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayBank_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayGenTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayEnableBeginTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayEnableEndTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayFinishTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayReturnTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvFeeFinishTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvFeeReturnTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayBuyerRecvFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPaySellerRecvFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCftDealGenTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayCashFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayTicketFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayCreditFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayOthersFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayServiceFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cWhoPayCodFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayCodCftServiceFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayCodPaipaiServiceFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayCodServiceAdjustFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayCodPaipaiConsignTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayCodWuliuServiceFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayCodWuliuRecvFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayCodSellerRecvFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayCodWuliuConsignTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayCodWuliuCollectionMoney_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayCodWuliuSpid_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayInstallmentBank_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayInstallmentNum_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayInstallmentPayment_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // 序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strPayBusinessId); // 序列化支付业务单号, 支付系统的业务订单号 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cPayBusinessId_u); // 序列化支付业务单号, 支付系统的业务订单号 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化版本号 类型为uint16_t
			$this->dwControl = $bs->popUint32_t(); // 反序列化支付单DB操作类型，0:Insert 1:Update 类型为uint32_t
			$this->ddwPayId = $bs->popUint64_t(); // 反序列化支付单ID 类型为uint64_t
			$this->strDealId = $bs->popString(); // 反序列化订单编号，格式:订单序号XXXXYYYY，如:101041051509351702 类型为std::string
			$this->ddwDealId64 = $bs->popUint64_t(); // 反序列化订单单号，统一平台内部单号 类型为uint64_t
			$this->ddwBdealId = $bs->popUint64_t(); // 反序列化交易单号，买卖家一次交易行为描述 类型为uint64_t
			$this->ddwBuyerId = $bs->popUint64_t(); // 反序列化买家ID 类型为uint64_t
			$this->strBuyerNickName = $bs->popString(); // 反序列化买家昵称 类型为std::string
			$this->ddwSellerId = $bs->popUint64_t(); // 反序列化商家ID 类型为uint64_t
			$this->strSellerTitle = $bs->popString(); // 反序列化商家名称 类型为std::string
			$this->strItemTitleList = $bs->popString(); // 反序列化商品标题列表 类型为std::string
			$this->dwPayTotalFee = $bs->popUint32_t(); // 反序列化支付总金额 类型为uint32_t
			$this->dwPayDealTotalFee = $bs->popUint32_t(); // 反序列化订单待付金额，等于商品实付金额+退运险 类型为uint32_t
			$this->dwPayShippingFee = $bs->popUint32_t(); // 反序列化邮费金额 类型为uint32_t
			$this->strPayAccount = $bs->popString(); // 反序列化支付帐号 类型为std::string
			$this->dwPayState = $bs->popUint32_t(); // 反序列化支付单状态，1，未支付；2，支付完成 类型为uint32_t
			$this->dwPayProperty = $bs->popUint32_t(); // 反序列化支付单标记 类型为uint32_t
			$this->cPayType = $bs->popUint8_t(); // 反序列化支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款 类型为uint8_t
			$this->cPayChannel = $bs->popUint8_t(); // 反序列化支付渠道 类型为uint8_t
			$this->strPayBank = $bs->popString(); // 反序列化支付银行ID 类型为std::string
			$this->strPayDealId = $bs->popString(); // 反序列化支付订单编号 类型为std::string
			$this->dwPayGenTime = $bs->popUint32_t(); // 反序列化支付单生成时间 类型为uint32_t
			$this->dwPayEnableBeginTime = $bs->popUint32_t(); // 反序列化支付单有效起始时间 类型为uint32_t
			$this->dwPayEnableEndTime = $bs->popUint32_t(); // 反序列化支付单有效结束时间 类型为uint32_t
			$this->dwPayFinishTime = $bs->popUint32_t(); // 反序列化支付完成时间 类型为uint32_t
			$this->dwPayReturnTime = $bs->popUint32_t(); // 反序列化支付返回时间 类型为uint32_t
			$this->dwRecvFeeFinishTime = $bs->popUint32_t(); // 反序列化打款完成时间 类型为uint32_t
			$this->dwRecvFeeReturnTime = $bs->popUint32_t(); // 反序列化打款返回时间 类型为uint32_t
			$this->dwPayBuyerRecvFee = $bs->popUint32_t(); // 反序列化打款买家总金额 类型为uint32_t
			$this->dwPaySellerRecvFee = $bs->popUint32_t(); // 反序列化打款卖家总金额 类型为uint32_t
			$this->dwCftDealGenTime = $bs->popUint32_t(); // 反序列化财付通订单生成时间 类型为uint32_t
			$this->dwPayCashFee = $bs->popUint32_t(); // 反序列化现金支付金额 类型为uint32_t
			$this->dwPayTicketFee = $bs->popUint32_t(); // 反序列化现金券支付金额 类型为uint32_t
			$this->dwPayCreditFee = $bs->popUint32_t(); // 反序列化积分支付金额 类型为uint32_t
			$this->dwPayOthersFee = $bs->popUint32_t(); // 反序列化其他支付金额 类型为uint32_t
			$this->dwPayServiceFee = $bs->popUint32_t(); // 反序列化支付手续费 类型为uint32_t
			$this->dwWhoPayCodFee = $bs->popUint32_t(); // 反序列化谁承担COD手续费，1：卖家承担；2：买家；3：平台承担 类型为uint32_t
			$this->dwPayCodCftServiceFee = $bs->popUint32_t(); // 反序列化COD财付通支付手续费 类型为uint32_t
			$this->dwPayCodPaipaiServiceFee = $bs->popUint32_t(); // 反序列化CODPaipai支付手续费 类型为uint32_t
			$this->nPayCodServiceAdjustFee = $bs->popInt32_t(); // 反序列化COD手续费调价金额 类型为int
			$this->dwPayCodPaipaiConsignTime = $bs->popUint32_t(); // 反序列化CODPaipai签收时间 类型为uint32_t
			$this->dwPayCodWuliuServiceFee = $bs->popUint32_t(); // 反序列化COD物流支付手续费 类型为uint32_t
			$this->dwPayCodWuliuRecvFee = $bs->popUint32_t(); // 反序列化COD物流打款金额 类型为uint32_t
			$this->dwPayCodSellerRecvFee = $bs->popUint32_t(); // 反序列化COD卖家打款金额 类型为uint32_t
			$this->dwPayCodWuliuConsignTime = $bs->popUint32_t(); // 反序列化COD物流签收时间 类型为uint32_t
			$this->dwPayCodWuliuCollectionMoney = $bs->popUint32_t(); // 反序列化COD物流代收货款 类型为uint32_t
			$this->strPayCodWuliuSpid = $bs->popString(); // 反序列化COD物流SPID 类型为std::string
			$this->strPayInstallmentBank = $bs->popString(); // 反序列化分期付款银行 类型为std::string
			$this->wPayInstallmentNum = $bs->popUint16_t(); // 反序列化分期付款期数 类型为uint16_t
			$this->dwPayInstallmentPayment = $bs->popUint32_t(); // 反序列化分期付款每期金额 类型为uint32_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // 反序列化最后更新时间 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cControl_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId64_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBdealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerNickName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerTitle_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemTitleList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayTotalFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayDealTotalFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayShippingFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayAccount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayChannel_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayBank_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayGenTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayEnableBeginTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayEnableEndTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayFinishTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayReturnTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvFeeFinishTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvFeeReturnTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayBuyerRecvFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPaySellerRecvFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCftDealGenTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayCashFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayTicketFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayCreditFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayOthersFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayServiceFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cWhoPayCodFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayCodCftServiceFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayCodPaipaiServiceFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayCodServiceAdjustFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayCodPaipaiConsignTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayCodWuliuServiceFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayCodWuliuRecvFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayCodSellerRecvFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayCodWuliuConsignTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayCodWuliuCollectionMoney_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayCodWuliuSpid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayInstallmentBank_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayInstallmentNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayInstallmentPayment_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$this->strPayBusinessId = $bs->popString(); // 反序列化支付业务单号, 支付系统的业务订单号 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cPayBusinessId_u = $bs->popUint8_t(); // 反序列化支付业务单号, 支付系统的业务订单号 类型为uint8_t
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


//source idl: com.ecc.deal.idl.DealPo.java

if (!class_exists('DealActionLogPoList')) {
class DealActionLogPoList
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 流水列表
		 *
		 * 版本 >= 0
		 */
		var $vecDealActionLogInfoList; //std::vector<ecc::deal::po::CDealActionLogPo> 

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealActionLogInfoList_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->vecDealActionLogInfoList = new stl_vector('DealActionLogPo'); // std::vector<ecc::deal::po::CDealActionLogPo> 
			 $this->cVersion_u = 0; // uint8_t
			 $this->cDealActionLogInfoList_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化版本号 类型为uint16_t
			$bs->pushObject($this->vecDealActionLogInfoList,'stl_vector'); // 序列化流水列表 类型为std::vector<ecc::deal::po::CDealActionLogPo> 
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealActionLogInfoList_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化版本号 类型为uint16_t
			$this->vecDealActionLogInfoList = $bs->popObject('stl_vector<DealActionLogPo>'); // 反序列化流水列表 类型为std::vector<ecc::deal::po::CDealActionLogPo> 
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealActionLogInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.ecc.deal.idl.DealActionLogPoList.java

if (!class_exists('DealActionLogPo')) {
class DealActionLogPo
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 订单流水ID
		 *
		 * 版本 >= 0
		 */
		var $dwDealLogId; //uint32_t

		/**
		 * 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		 *
		 * 版本 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * 订单单号，统一平台内部单号
		 *
		 * 版本 >= 0
		 */
		var $ddwDealId64; //uint64_t

		/**
		 * 商品单ID
		 *
		 * 版本 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * 买家ID
		 *
		 * 版本 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * 商家ID
		 *
		 * 版本 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * 订单操作者类别
		 *
		 * 版本 >= 0
		 */
		var $wOperatorType; //uint16_t

		/**
		 * 流水操作时间
		 *
		 * 版本 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * 流水操作类型
		 *
		 * 版本 >= 0
		 */
		var $wOperationType; //uint16_t

		/**
		 * 流水操作描述
		 *
		 * 版本 >= 0
		 */
		var $strOperationDesc; //std::string

		/**
		 * 操作前状态
		 *
		 * 版本 >= 0
		 */
		var $dwFromState; //uint32_t

		/**
		 * 操作后状态
		 *
		 * 版本 >= 0
		 */
		var $dwToState; //uint32_t

		/**
		 * 操作来源IP
		 *
		 * 版本 >= 0
		 */
		var $strOperateIP; //std::string

		/**
		 * 操作备注
		 *
		 * 版本 >= 0
		 */
		var $strOperationRemark; //std::string

		/**
		 * MachineKey
		 *
		 * 版本 >= 0
		 */
		var $strMachineKey; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealLogId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId64_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperatorType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperationType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperationDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cFromState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cToState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperateIP_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperationRemark_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cMachineKey_u; //uint8_t

		/**
		 * 流水类型
		 *
		 * 版本 >= 1
		 */
		var $dwLogType; //uint32_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cLogType_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 1; // uint16_t
			 $this->dwDealLogId = 0; // uint32_t
			 $this->strDealId = ""; // std::string
			 $this->ddwDealId64 = 0; // uint64_t
			 $this->ddwTradeId = 0; // uint64_t
			 $this->ddwBuyerId = 0; // uint64_t
			 $this->ddwSellerId = 0; // uint64_t
			 $this->wOperatorType = 0; // uint16_t
			 $this->dwOperateTime = 0; // uint32_t
			 $this->wOperationType = 0; // uint16_t
			 $this->strOperationDesc = ""; // std::string
			 $this->dwFromState = 0; // uint32_t
			 $this->dwToState = 0; // uint32_t
			 $this->strOperateIP = ""; // std::string
			 $this->strOperationRemark = ""; // std::string
			 $this->strMachineKey = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cDealLogId_u = 0; // uint8_t
			 $this->cDealId_u = 0; // uint8_t
			 $this->cDealId64_u = 0; // uint8_t
			 $this->cTradeId_u = 0; // uint8_t
			 $this->cBuyerId_u = 0; // uint8_t
			 $this->cSellerId_u = 0; // uint8_t
			 $this->cOperatorType_u = 0; // uint8_t
			 $this->cOperateTime_u = 0; // uint8_t
			 $this->cOperationType_u = 0; // uint8_t
			 $this->cOperationDesc_u = 0; // uint8_t
			 $this->cFromState_u = 0; // uint8_t
			 $this->cToState_u = 0; // uint8_t
			 $this->cOperateIP_u = 0; // uint8_t
			 $this->cOperationRemark_u = 0; // uint8_t
			 $this->cMachineKey_u = 0; // uint8_t
			 $this->dwLogType = 0; // uint32_t
			 $this->cLogType_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化版本号 类型为uint16_t
			$bs->pushUint32_t($this->dwDealLogId); // 序列化订单流水ID 类型为uint32_t
			$bs->pushString($this->strDealId); // 序列化订单编号，格式:订单序号XXXXYYYY，如:101041051509351702 类型为std::string
			$bs->pushUint64_t($this->ddwDealId64); // 序列化订单单号，统一平台内部单号 类型为uint64_t
			$bs->pushUint64_t($this->ddwTradeId); // 序列化商品单ID 类型为uint64_t
			$bs->pushUint64_t($this->ddwBuyerId); // 序列化买家ID 类型为uint64_t
			$bs->pushUint64_t($this->ddwSellerId); // 序列化商家ID 类型为uint64_t
			$bs->pushUint16_t($this->wOperatorType); // 序列化订单操作者类别 类型为uint16_t
			$bs->pushUint32_t($this->dwOperateTime); // 序列化流水操作时间 类型为uint32_t
			$bs->pushUint16_t($this->wOperationType); // 序列化流水操作类型 类型为uint16_t
			$bs->pushString($this->strOperationDesc); // 序列化流水操作描述 类型为std::string
			$bs->pushUint32_t($this->dwFromState); // 序列化操作前状态 类型为uint32_t
			$bs->pushUint32_t($this->dwToState); // 序列化操作后状态 类型为uint32_t
			$bs->pushString($this->strOperateIP); // 序列化操作来源IP 类型为std::string
			$bs->pushString($this->strOperationRemark); // 序列化操作备注 类型为std::string
			$bs->pushString($this->strMachineKey); // 序列化MachineKey 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealLogId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId64_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperatorType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperationType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperationDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cFromState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cToState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperateIP_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperationRemark_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cMachineKey_u); // 序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwLogType); // 序列化流水类型 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cLogType_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化版本号 类型为uint16_t
			$this->dwDealLogId = $bs->popUint32_t(); // 反序列化订单流水ID 类型为uint32_t
			$this->strDealId = $bs->popString(); // 反序列化订单编号，格式:订单序号XXXXYYYY，如:101041051509351702 类型为std::string
			$this->ddwDealId64 = $bs->popUint64_t(); // 反序列化订单单号，统一平台内部单号 类型为uint64_t
			$this->ddwTradeId = $bs->popUint64_t(); // 反序列化商品单ID 类型为uint64_t
			$this->ddwBuyerId = $bs->popUint64_t(); // 反序列化买家ID 类型为uint64_t
			$this->ddwSellerId = $bs->popUint64_t(); // 反序列化商家ID 类型为uint64_t
			$this->wOperatorType = $bs->popUint16_t(); // 反序列化订单操作者类别 类型为uint16_t
			$this->dwOperateTime = $bs->popUint32_t(); // 反序列化流水操作时间 类型为uint32_t
			$this->wOperationType = $bs->popUint16_t(); // 反序列化流水操作类型 类型为uint16_t
			$this->strOperationDesc = $bs->popString(); // 反序列化流水操作描述 类型为std::string
			$this->dwFromState = $bs->popUint32_t(); // 反序列化操作前状态 类型为uint32_t
			$this->dwToState = $bs->popUint32_t(); // 反序列化操作后状态 类型为uint32_t
			$this->strOperateIP = $bs->popString(); // 反序列化操作来源IP 类型为std::string
			$this->strOperationRemark = $bs->popString(); // 反序列化操作备注 类型为std::string
			$this->strMachineKey = $bs->popString(); // 反序列化MachineKey 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealLogId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId64_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperatorType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperationType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperationDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cFromState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cToState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperateIP_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperationRemark_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cMachineKey_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$this->dwLogType = $bs->popUint32_t(); // 反序列化流水类型 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cLogType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.ecc.deal.idl.DealPo.java

if (!class_exists('TradePoList')) {
class TradePoList
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 商品单列表
		 *
		 * 版本 >= 0
		 */
		var $vecTradeInfoList; //std::vector<ecc::deal::po::CTradePo> 

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeInfoList_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->vecTradeInfoList = new stl_vector('TradePo'); // std::vector<ecc::deal::po::CTradePo> 
			 $this->cVersion_u = 0; // uint8_t
			 $this->cTradeInfoList_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushObject($this->vecTradeInfoList,'stl_vector'); // 序列化商品单列表 类型为std::vector<ecc::deal::po::CTradePo> 
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeInfoList_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->vecTradeInfoList = $bs->popObject('stl_vector<TradePo>'); // 反序列化商品单列表 类型为std::vector<ecc::deal::po::CTradePo> 
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.ecc.deal.idl.TradePoList.java

if (!class_exists('TradePo')) {
class TradePo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		 *
		 * 版本 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * 订单单号，统一平台内部单号
		 *
		 * 版本 >= 0
		 */
		var $ddwDealId64; //uint64_t

		/**
		 * 交易单号，买卖家一次交易行为描述
		 *
		 * 版本 >= 0
		 */
		var $ddwBdealId; //uint64_t

		/**
		 * 商品订单号
		 *
		 * 版本 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * 打款单ID
		 *
		 * 版本 >= 0
		 */
		var $ddwRecvFeeId; //uint64_t

		/**
		 * 买家ID
		 *
		 * 版本 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * 买家昵称
		 *
		 * 版本 >= 0
		 */
		var $strBuyerNickName; //std::string

		/**
		 * 商家ID
		 *
		 * 版本 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * 商家名称
		 *
		 * 版本 >= 0
		 */
		var $strSellerTitle; //std::string

		/**
		 * 业务ID
		 *
		 * 版本 >= 0
		 */
		var $dwBusinessId; //uint32_t

		/**
		 * 订单类型
		 *
		 * 版本 >= 0
		 */
		var $cTradeType; //uint8_t

		/**
		 * 下单渠道：1：业务主站；2：移动app；3：移动wap
		 *
		 * 版本 >= 0
		 */
		var $dwTradeSource; //uint32_t

		/**
		 * 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款
		 *
		 * 版本 >= 0
		 */
		var $cTradePayType; //uint8_t

		/**
		 * 打款Token，兼容拍拍商品单
		 *
		 * 版本 >= 0
		 */
		var $strToken; //std::string

		/**
		 * 打款DrawId，兼容拍拍商品单
		 *
		 * 版本 >= 0
		 */
		var $strDrawId; //std::string

		/**
		 * 运费模版ID
		 *
		 * 版本 >= 0
		 */
		var $strShippingfeeTemplateId; //std::string

		/**
		 * 运费描述
		 *
		 * 版本 >= 0
		 */
		var $strShippingfeeDesc; //std::string

		/**
		 * 商品运费
		 *
		 * 版本 >= 0
		 */
		var $dwItemShippingfee; //uint32_t

		/**
		 * 商品类型；1：普通商品；2：套餐主商品；3：套餐副商品；4：赠品主商品；5：赠品副商品; 6:组件
		 *
		 * 版本 >= 0
		 */
		var $dwItemType; //uint32_t

		/**
		 * 品类（类目）ID
		 *
		 * 版本 >= 0
		 */
		var $dwItemClassId; //uint32_t

		/**
		 * 商品标题
		 *
		 * 版本 >= 0
		 */
		var $strItemTitle; //std::string

		/**
		 * 商品销售属性编码
		 *
		 * 版本 >= 0
		 */
		var $strItemAttrCode; //std::string

		/**
		 * 商品销售属性描述
		 *
		 * 版本 >= 0
		 */
		var $strItemAttr; //std::string

		/**
		 * 商品ID，由业务定义
		 *
		 * 版本 >= 0
		 */
		var $strItemId; //std::string

		/**
		 * 商品SKUID
		 *
		 * 版本 >= 0
		 */
		var $ddwItemSkuId; //uint64_t

		/**
		 * 商品商家本地编码
		 *
		 * 版本 >= 0
		 */
		var $strItemLocalCode; //std::string

		/**
		 * 商品商家本地库存编码
		 *
		 * 版本 >= 0
		 */
		var $strItemLocalStockCode; //std::string

		/**
		 * 商品条形码
		 *
		 * 版本 >= 0
		 */
		var $strItemBarCode; //std::string

		/**
		 * 商品SPUID
		 *
		 * 版本 >= 0
		 */
		var $ddwItemSpuId; //uint64_t

		/**
		 * 商品库存ID
		 *
		 * 版本 >= 0
		 */
		var $ddwItemStockId; //uint64_t

		/**
		 * 商品仓库ID
		 *
		 * 版本 >= 0
		 */
		var $dwItemStoreHouseId; //uint32_t

		/**
		 * 商品所属物理仓
		 *
		 * 版本 >= 0
		 */
		var $strItemPhyisicalStorage; //std::string

		/**
		 * 商品图片Logo
		 *
		 * 版本 >= 0
		 */
		var $strItemLogo; //std::string

		/**
		 * 商品快照版本号
		 *
		 * 版本 >= 0
		 */
		var $dwItemSnapVersion; //uint32_t

		/**
		 * 商品重置时间戳
		 *
		 * 版本 >= 0
		 */
		var $dwItemResetTime; //uint32_t

		/**
		 * 商品重量
		 *
		 * 版本 >= 0
		 */
		var $dwItemWeight; //uint32_t

		/**
		 * 商品体积
		 *
		 * 版本 >= 0
		 */
		var $dwItemVolume; //uint32_t

		/**
		 * 商品套餐主商品ID
		 *
		 * 版本 >= 0
		 */
		var $ddwMainItemId; //uint64_t

		/**
		 * 商品标配说明
		 *
		 * 版本 >= 0
		 */
		var $strItemAccessoryDesc; //std::string

		/**
		 * 商品成本价
		 *
		 * 版本 >= 0
		 */
		var $dwItemCostPrice; //uint32_t

		/**
		 * 商品市场价
		 *
		 * 版本 >= 0
		 */
		var $dwItemOriginPrice; //uint32_t

		/**
		 * 商品销售单价
		 *
		 * 版本 >= 0
		 */
		var $dwItemSoldPrice; //uint32_t

		/**
		 * 自营B2C市场
		 *
		 * 版本 >= 0
		 */
		var $strItemB2CMarket; //std::string

		/**
		 * 自营B2CPM
		 *
		 * 版本 >= 0
		 */
		var $strItemB2CPM; //std::string

		/**
		 * 自营B2C是否占用虚库
		 *
		 * 版本 >= 0
		 */
		var $cItemUseVirtualStock; //uint8_t

		/**
		 * 商品成交价
		 *
		 * 版本 >= 0
		 */
		var $dwBuyPrice; //uint32_t

		/**
		 * 商品成交件数
		 *
		 * 版本 >= 0
		 */
		var $dwBuyNum; //uint32_t

		/**
		 * 商品单总金额,下单金额
		 *
		 * 版本 >= 0
		 */
		var $dwTradeTotalFee; //uint32_t

		/**
		 * 商品单调价金额
		 *
		 * 版本 >= 0
		 */
		var $nTradeAdjustFee; //int

		/**
		 * 实付总金额
		 *
		 * 版本 >= 0
		 */
		var $dwTradePayment; //uint32_t

		/**
		 * 优惠总金额
		 *
		 * 版本 >= 0
		 */
		var $nTradeDiscountTotal; //int

		/**
		 * Paipai红包使用金额
		 *
		 * 版本 >= 0
		 */
		var $dwTradePaipaiHongbaoUsed; //uint32_t

		/**
		 * 积分支付值
		 *
		 * 版本 >= 0
		 */
		var $dwPayScore; //uint32_t

		/**
		 * 商品单生成时间
		 *
		 * 版本 >= 0
		 */
		var $dwTradeGenTime; //uint32_t

		/**
		 * 商品单库存操作序列号
		 *
		 * 版本 >= 0
		 */
		var $wTradeOpSerialNo; //uint16_t

		/**
		 * 获得积分值
		 *
		 * 版本 >= 0
		 */
		var $dwObtainScore; //uint32_t

		/**
		 * 商品单状态
		 *
		 * 版本 >= 0
		 */
		var $dwTradeState; //uint32_t

		/**
		 * 商品单前一个状态
		 *
		 * 版本 >= 0
		 */
		var $dwPreTradeState; //uint32_t

		/**
		 * 商品单属性值
		 *
		 * 版本 >= 0
		 */
		var $dwTradeProperty; //uint32_t

		/**
		 * 商品单属性值1
		 *
		 * 版本 >= 0
		 */
		var $dwTradeProperty1; //uint32_t

		/**
		 * 商品单属性值2
		 *
		 * 版本 >= 0
		 */
		var $dwTradeProperty2; //uint32_t

		/**
		 * 商品单属性值3
		 *
		 * 版本 >= 0
		 */
		var $dwTradeProperty3; //uint32_t

		/**
		 * 商品单属性值4
		 *
		 * 版本 >= 0
		 */
		var $dwTradeProperty4; //uint32_t

		/**
		 * 退款状态, 各退款单的汇总状态, 0:无退款,1:退款中,2:退款完成
		 *
		 * 版本 >= 0
		 */
		var $dwRefundState; //uint32_t

		/**
		 * 冗余退款单的退款状态，拍拍同步订单使用
		 *
		 * 版本 >= 0
		 */
		var $dwRefundDetailState; //uint32_t

		/**
		 * 订单退款状态, 冗余DealDo上的值, 各子单退款状态的汇总, 0:无退款,1:退款中,2:退款完成
		 *
		 * 版本 >= 0
		 */
		var $dwDealRefundState; //uint32_t

		/**
		 * 评价评论状态
		 *
		 * 版本 >= 0
		 */
		var $dwEvalState; //uint32_t

		/**
		 * 付款时间
		 *
		 * 版本 >= 0
		 */
		var $dwTradePayTime; //uint32_t

		/**
		 * 审核时间
		 *
		 * 版本 >= 0
		 */
		var $dwTradeCheckTime; //uint32_t

		/**
		 * 标记发货时间
		 *
		 * 版本 >= 0
		 */
		var $dwTradeConsignTime; //uint32_t

		/**
		 * 标记缺货时间
		 *
		 * 版本 >= 0
		 */
		var $dwTradeMarkNoStockTime; //uint32_t

		/**
		 * 延长确认收货天数
		 *
		 * 版本 >= 0
		 */
		var $dwDelayConfirmDays; //uint32_t

		/**
		 * 签收时间
		 *
		 * 版本 >= 0
		 */
		var $dwTradeConfirmRecvTime; //uint32_t

		/**
		 * 结束时间
		 *
		 * 版本 >= 0
		 */
		var $dwTradeEndTime; //uint32_t

		/**
		 * 打款时间
		 *
		 * 版本 >= 0
		 */
		var $dwTradeRecvFeeTime; //uint32_t

		/**
		 * 打款返回时间
		 *
		 * 版本 >= 0
		 */
		var $dwTradeRecvFeeReturnTime; //uint32_t

		/**
		 * 商品缺货总件数
		 *
		 * 版本 >= 0
		 */
		var $dwStockoutNum; //uint32_t

		/**
		 * 拒收总件数
		 *
		 * 版本 >= 0
		 */
		var $dwRefuseNum; //uint32_t

		/**
		 * 实际成交件数
		 *
		 * 版本 >= 0
		 */
		var $dwDoneNum; //uint32_t

		/**
		 * 订单关闭原因类型
		 *
		 * 版本 >= 0
		 */
		var $cCloseReasonType; //uint8_t

		/**
		 * 订单关闭原因描述
		 *
		 * 版本 >= 0
		 */
		var $strCloseReasonDesc; //std::string

		/**
		 * 卖家到账总金额
		 *
		 * 版本 >= 0
		 */
		var $dwSellerTotalRecvFee; //uint32_t

		/**
		 * 买家到账总金额
		 *
		 * 版本 >= 0
		 */
		var $dwBuyerTotalRecvFee; //uint32_t

		/**
		 * 商品超时标识
		 *
		 * 版本 >= 0
		 */
		var $dwItemTimeoutFlag; //uint32_t

		/**
		 * 最后更新时间
		 *
		 * 版本 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * 商品活动列表
		 *
		 * 版本 >= 0
		 */
		var $oActiveInfoList; //ecc::deal::po::CTradeActivePoList

		/**
		 * 订单扩展信息 
		 *
		 * 版本 >= 0
		 */
		var $mmapDealExtInfoMap; //std::multimap<uint32_t,std::string> 

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId64_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBdealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvFeeId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerNickName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerTitle_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBusinessId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeSource_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradePayType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cToken_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDrawId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cShippingfeeTemplateId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cShippingfeeDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemShippingfee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemClassId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemTitle_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemAttrCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemAttr_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemSkuId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemLocalCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemLocalStockCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemBarCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemSpuId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemStockId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemStoreHouseId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemPhyisicalStorage_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemLogo_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemSnapVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemResetTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemWeight_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemVolume_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cMainItemId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemAccessoryDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemCostPrice_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemOriginPrice_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemSoldPrice_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemB2CMarket_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemB2CPM_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemUseVirtualStock_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyPrice_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyNum_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeTotalFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeAdjustFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradePayment_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeDiscountTotal_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradePaipaiHongbaoUsed_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayScore_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeGenTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeOpSerialNo_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cObtainScore_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPreTradeState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeProperty_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeProperty1_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeProperty2_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeProperty3_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeProperty4_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundDetailState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealRefundState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cEvalState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradePayTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeCheckTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeConsignTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeMarkNoStockTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDelayConfirmDays_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeConfirmRecvTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeEndTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeRecvFeeTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeRecvFeeReturnTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cStockoutNum_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefuseNum_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDoneNum_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCloseReasonType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCloseReasonDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerTotalRecvFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerTotalRecvFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemTimeoutFlag_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cActiveInfoList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealExtInfoMap_u; //uint8_t

		/**
		 * 标记发货时间
		 *
		 * 版本 >= 1
		 */
		var $dwTradeSellerSendTime; //uint32_t

		/**
		 * 保修条款
		 *
		 * 版本 >= 1
		 */
		var $strWarranty; //std::string

		/**
		 * 产品id
		 *
		 * 版本 >= 1
		 */
		var $ddwProductId; //uint64_t

		/**
		 * 产品id编码
		 *
		 * 版本 >= 1
		 */
		var $strProductCode; //std::string

		/**
		 * 易迅edm编码
		 *
		 * 版本 >= 1
		 */
		var $strIcsonEdmCode; //std::string

		/**
		 * 易迅OTag
		 *
		 * 版本 >= 1
		 */
		var $strIcsonOTag; //std::string

		/**
		 * 易迅店铺导购费用
		 *
		 * 版本 >= 1
		 */
		var $strIcsonTradeShopGuideCost; //std::string

		/**
		 * 易迅定制机类型
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneType; //std::string

		/**
		 * 易迅定制机运营商
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneOperator; //std::string

		/**
		 * 易迅定制机号码
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneNumber; //std::string

		/**
		 * 易迅定制机归属地
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneArea; //std::string

		/**
		 * 易迅定制机套餐id
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhonePackageId; //std::string

		/**
		 * 易迅定制机用户姓名
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneUserName; //std::string

		/**
		 * 易迅定制机用户地址
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneUserAddr; //std::string

		/**
		 * 易迅定制机用户联系手机
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneUserMobile; //std::string

		/**
		 * 易迅定制机用户联系电话
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneUserTel; //std::string

		/**
		 * 易迅定制机身份证号码
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneIdCardNo; //std::string

		/**
		 * 易迅定制机身份证地址
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneIdCardAddr; //std::string

		/**
		 * 易迅定制机身份证有效期
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneIdCardDate; //std::string

		/**
		 * 易迅定制机邮政编码
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneZipCode; //std::string

		/**
		 * 易迅定制机卡价格
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneCardPrice; //std::string

		/**
		 * 易迅定制机套餐价格
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhonePackagePrice; //std::string

		/**
		 * 易迅商品子单flag
		 *
		 * 版本 >= 1
		 */
		var $strIcsonTradeFlag; //std::string

		/**
		 * 易迅积分兑换类型
		 *
		 * 版本 >= 1
		 */
		var $strIcsonPointType; //std::string

		/**
		 * 易迅商品子单套餐id
		 *
		 * 版本 >= 1
		 */
		var $strIcsonPackageIds; //std::string

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cTradeSellerSendTime_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cWarranty_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cProductId_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cProductCode_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonEdmCode_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonOTag_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonTradeShopGuideCost_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneType_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneOperator_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneNumber_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneArea_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhonePackageId_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneUserName_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneUserAddr_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneUserMobile_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneUserTel_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneIdCardNo_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneIdCardAddr_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneIdCardDate_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneZipCode_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneCardPrice_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhonePackagePrice_u; //uint8_t

		/**
		 * 易迅商品子单flag
		 *
		 * 版本 >= 1
		 */
		var $cIcsonTradeFlag_u; //uint8_t

		/**
		 * 易迅积分兑换类型
		 *
		 * 版本 >= 1
		 */
		var $cIcsonPointType_u; //uint8_t

		/**
		 * 易迅商品子单套餐id
		 *
		 * 版本 >= 1
		 */
		var $cIcsonPackageIds_u; //uint8_t

		/**
		 * 子单返现金额
		 *
		 * 版本 >= 2
		 */
		var $dwIcsonTradeCashBack; //uint32_t

		/**
		 * 子单返现金额UFlag
		 *
		 * 版本 >= 2
		 */
		var $cIcsonTradeCashBack_u; //uint8_t

		/**
		 * 去税后成本
		 *
		 * 版本 >= 3
		 */
		var $strIcsonUnitCostInvoice; //std::string

		/**
		 * 去税后成本UFlag
		 *
		 * 版本 >= 3
		 */
		var $cIcsonUnitCostInvoice_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 3; // uint16_t
			 $this->strDealId = ""; // std::string
			 $this->ddwDealId64 = 0; // uint64_t
			 $this->ddwBdealId = 0; // uint64_t
			 $this->ddwTradeId = 0; // uint64_t
			 $this->ddwRecvFeeId = 0; // uint64_t
			 $this->ddwBuyerId = 0; // uint64_t
			 $this->strBuyerNickName = ""; // std::string
			 $this->ddwSellerId = 0; // uint64_t
			 $this->strSellerTitle = ""; // std::string
			 $this->dwBusinessId = 0; // uint32_t
			 $this->cTradeType = 0; // uint8_t
			 $this->dwTradeSource = 0; // uint32_t
			 $this->cTradePayType = 0; // uint8_t
			 $this->strToken = ""; // std::string
			 $this->strDrawId = ""; // std::string
			 $this->strShippingfeeTemplateId = ""; // std::string
			 $this->strShippingfeeDesc = ""; // std::string
			 $this->dwItemShippingfee = 0; // uint32_t
			 $this->dwItemType = 0; // uint32_t
			 $this->dwItemClassId = 0; // uint32_t
			 $this->strItemTitle = ""; // std::string
			 $this->strItemAttrCode = ""; // std::string
			 $this->strItemAttr = ""; // std::string
			 $this->strItemId = ""; // std::string
			 $this->ddwItemSkuId = 0; // uint64_t
			 $this->strItemLocalCode = ""; // std::string
			 $this->strItemLocalStockCode = ""; // std::string
			 $this->strItemBarCode = ""; // std::string
			 $this->ddwItemSpuId = 0; // uint64_t
			 $this->ddwItemStockId = 0; // uint64_t
			 $this->dwItemStoreHouseId = 0; // uint32_t
			 $this->strItemPhyisicalStorage = ""; // std::string
			 $this->strItemLogo = ""; // std::string
			 $this->dwItemSnapVersion = 0; // uint32_t
			 $this->dwItemResetTime = 0; // uint32_t
			 $this->dwItemWeight = 0; // uint32_t
			 $this->dwItemVolume = 0; // uint32_t
			 $this->ddwMainItemId = 0; // uint64_t
			 $this->strItemAccessoryDesc = ""; // std::string
			 $this->dwItemCostPrice = 0; // uint32_t
			 $this->dwItemOriginPrice = 0; // uint32_t
			 $this->dwItemSoldPrice = 0; // uint32_t
			 $this->strItemB2CMarket = ""; // std::string
			 $this->strItemB2CPM = ""; // std::string
			 $this->cItemUseVirtualStock = 0; // uint8_t
			 $this->dwBuyPrice = 0; // uint32_t
			 $this->dwBuyNum = 0; // uint32_t
			 $this->dwTradeTotalFee = 0; // uint32_t
			 $this->nTradeAdjustFee = 0; // int
			 $this->dwTradePayment = 0; // uint32_t
			 $this->nTradeDiscountTotal = 0; // int
			 $this->dwTradePaipaiHongbaoUsed = 0; // uint32_t
			 $this->dwPayScore = 0; // uint32_t
			 $this->dwTradeGenTime = 0; // uint32_t
			 $this->wTradeOpSerialNo = 0; // uint16_t
			 $this->dwObtainScore = 0; // uint32_t
			 $this->dwTradeState = 0; // uint32_t
			 $this->dwPreTradeState = 0; // uint32_t
			 $this->dwTradeProperty = 0; // uint32_t
			 $this->dwTradeProperty1 = 0; // uint32_t
			 $this->dwTradeProperty2 = 0; // uint32_t
			 $this->dwTradeProperty3 = 0; // uint32_t
			 $this->dwTradeProperty4 = 0; // uint32_t
			 $this->dwRefundState = 0; // uint32_t
			 $this->dwRefundDetailState = 0; // uint32_t
			 $this->dwDealRefundState = 0; // uint32_t
			 $this->dwEvalState = 0; // uint32_t
			 $this->dwTradePayTime = 0; // uint32_t
			 $this->dwTradeCheckTime = 0; // uint32_t
			 $this->dwTradeConsignTime = 0; // uint32_t
			 $this->dwTradeMarkNoStockTime = 0; // uint32_t
			 $this->dwDelayConfirmDays = 0; // uint32_t
			 $this->dwTradeConfirmRecvTime = 0; // uint32_t
			 $this->dwTradeEndTime = 0; // uint32_t
			 $this->dwTradeRecvFeeTime = 0; // uint32_t
			 $this->dwTradeRecvFeeReturnTime = 0; // uint32_t
			 $this->dwStockoutNum = 0; // uint32_t
			 $this->dwRefuseNum = 0; // uint32_t
			 $this->dwDoneNum = 0; // uint32_t
			 $this->cCloseReasonType = 0; // uint8_t
			 $this->strCloseReasonDesc = ""; // std::string
			 $this->dwSellerTotalRecvFee = 0; // uint32_t
			 $this->dwBuyerTotalRecvFee = 0; // uint32_t
			 $this->dwItemTimeoutFlag = 0; // uint32_t
			 $this->dwLastUpdateTime = 0; // uint32_t
			 $this->oActiveInfoList = new TradeActivePoList(); // ecc::deal::po::CTradeActivePoList
			 $this->mmapDealExtInfoMap = new stl_multimap('uint32_t,stl_string'); // std::multimap<uint32_t,std::string> 
			 $this->cVersion_u = 0; // uint8_t
			 $this->cDealId_u = 0; // uint8_t
			 $this->cDealId64_u = 0; // uint8_t
			 $this->cBdealId_u = 0; // uint8_t
			 $this->cTradeId_u = 0; // uint8_t
			 $this->cRecvFeeId_u = 0; // uint8_t
			 $this->cBuyerId_u = 0; // uint8_t
			 $this->cBuyerNickName_u = 0; // uint8_t
			 $this->cSellerId_u = 0; // uint8_t
			 $this->cSellerTitle_u = 0; // uint8_t
			 $this->cBusinessId_u = 0; // uint8_t
			 $this->cTradeType_u = 0; // uint8_t
			 $this->cTradeSource_u = 0; // uint8_t
			 $this->cTradePayType_u = 0; // uint8_t
			 $this->cToken_u = 0; // uint8_t
			 $this->cDrawId_u = 0; // uint8_t
			 $this->cShippingfeeTemplateId_u = 0; // uint8_t
			 $this->cShippingfeeDesc_u = 0; // uint8_t
			 $this->cItemShippingfee_u = 0; // uint8_t
			 $this->cItemType_u = 0; // uint8_t
			 $this->cItemClassId_u = 0; // uint8_t
			 $this->cItemTitle_u = 0; // uint8_t
			 $this->cItemAttrCode_u = 0; // uint8_t
			 $this->cItemAttr_u = 0; // uint8_t
			 $this->cItemId_u = 0; // uint8_t
			 $this->cItemSkuId_u = 0; // uint8_t
			 $this->cItemLocalCode_u = 0; // uint8_t
			 $this->cItemLocalStockCode_u = 0; // uint8_t
			 $this->cItemBarCode_u = 0; // uint8_t
			 $this->cItemSpuId_u = 0; // uint8_t
			 $this->cItemStockId_u = 0; // uint8_t
			 $this->cItemStoreHouseId_u = 0; // uint8_t
			 $this->cItemPhyisicalStorage_u = 0; // uint8_t
			 $this->cItemLogo_u = 0; // uint8_t
			 $this->cItemSnapVersion_u = 0; // uint8_t
			 $this->cItemResetTime_u = 0; // uint8_t
			 $this->cItemWeight_u = 0; // uint8_t
			 $this->cItemVolume_u = 0; // uint8_t
			 $this->cMainItemId_u = 0; // uint8_t
			 $this->cItemAccessoryDesc_u = 0; // uint8_t
			 $this->cItemCostPrice_u = 0; // uint8_t
			 $this->cItemOriginPrice_u = 0; // uint8_t
			 $this->cItemSoldPrice_u = 0; // uint8_t
			 $this->cItemB2CMarket_u = 0; // uint8_t
			 $this->cItemB2CPM_u = 0; // uint8_t
			 $this->cItemUseVirtualStock_u = 0; // uint8_t
			 $this->cBuyPrice_u = 0; // uint8_t
			 $this->cBuyNum_u = 0; // uint8_t
			 $this->cTradeTotalFee_u = 0; // uint8_t
			 $this->cTradeAdjustFee_u = 0; // uint8_t
			 $this->cTradePayment_u = 0; // uint8_t
			 $this->cTradeDiscountTotal_u = 0; // uint8_t
			 $this->cTradePaipaiHongbaoUsed_u = 0; // uint8_t
			 $this->cPayScore_u = 0; // uint8_t
			 $this->cTradeGenTime_u = 0; // uint8_t
			 $this->cTradeOpSerialNo_u = 0; // uint8_t
			 $this->cObtainScore_u = 0; // uint8_t
			 $this->cTradeState_u = 0; // uint8_t
			 $this->cPreTradeState_u = 0; // uint8_t
			 $this->cTradeProperty_u = 0; // uint8_t
			 $this->cTradeProperty1_u = 0; // uint8_t
			 $this->cTradeProperty2_u = 0; // uint8_t
			 $this->cTradeProperty3_u = 0; // uint8_t
			 $this->cTradeProperty4_u = 0; // uint8_t
			 $this->cRefundState_u = 0; // uint8_t
			 $this->cRefundDetailState_u = 0; // uint8_t
			 $this->cDealRefundState_u = 0; // uint8_t
			 $this->cEvalState_u = 0; // uint8_t
			 $this->cTradePayTime_u = 0; // uint8_t
			 $this->cTradeCheckTime_u = 0; // uint8_t
			 $this->cTradeConsignTime_u = 0; // uint8_t
			 $this->cTradeMarkNoStockTime_u = 0; // uint8_t
			 $this->cDelayConfirmDays_u = 0; // uint8_t
			 $this->cTradeConfirmRecvTime_u = 0; // uint8_t
			 $this->cTradeEndTime_u = 0; // uint8_t
			 $this->cTradeRecvFeeTime_u = 0; // uint8_t
			 $this->cTradeRecvFeeReturnTime_u = 0; // uint8_t
			 $this->cStockoutNum_u = 0; // uint8_t
			 $this->cRefuseNum_u = 0; // uint8_t
			 $this->cDoneNum_u = 0; // uint8_t
			 $this->cCloseReasonType_u = 0; // uint8_t
			 $this->cCloseReasonDesc_u = 0; // uint8_t
			 $this->cSellerTotalRecvFee_u = 0; // uint8_t
			 $this->cBuyerTotalRecvFee_u = 0; // uint8_t
			 $this->cItemTimeoutFlag_u = 0; // uint8_t
			 $this->cLastUpdateTime_u = 0; // uint8_t
			 $this->cActiveInfoList_u = 0; // uint8_t
			 $this->cDealExtInfoMap_u = 0; // uint8_t
			 $this->dwTradeSellerSendTime = 0; // uint32_t
			 $this->strWarranty = ""; // std::string
			 $this->ddwProductId = 0; // uint64_t
			 $this->strProductCode = ""; // std::string
			 $this->strIcsonEdmCode = ""; // std::string
			 $this->strIcsonOTag = ""; // std::string
			 $this->strIcsonTradeShopGuideCost = ""; // std::string
			 $this->strIcsonCSPhoneType = ""; // std::string
			 $this->strIcsonCSPhoneOperator = ""; // std::string
			 $this->strIcsonCSPhoneNumber = ""; // std::string
			 $this->strIcsonCSPhoneArea = ""; // std::string
			 $this->strIcsonCSPhonePackageId = ""; // std::string
			 $this->strIcsonCSPhoneUserName = ""; // std::string
			 $this->strIcsonCSPhoneUserAddr = ""; // std::string
			 $this->strIcsonCSPhoneUserMobile = ""; // std::string
			 $this->strIcsonCSPhoneUserTel = ""; // std::string
			 $this->strIcsonCSPhoneIdCardNo = ""; // std::string
			 $this->strIcsonCSPhoneIdCardAddr = ""; // std::string
			 $this->strIcsonCSPhoneIdCardDate = ""; // std::string
			 $this->strIcsonCSPhoneZipCode = ""; // std::string
			 $this->strIcsonCSPhoneCardPrice = ""; // std::string
			 $this->strIcsonCSPhonePackagePrice = ""; // std::string
			 $this->strIcsonTradeFlag = ""; // std::string
			 $this->strIcsonPointType = ""; // std::string
			 $this->strIcsonPackageIds = ""; // std::string
			 $this->cTradeSellerSendTime_u = 0; // uint8_t
			 $this->cWarranty_u = 0; // uint8_t
			 $this->cProductId_u = 0; // uint8_t
			 $this->cProductCode_u = 0; // uint8_t
			 $this->cIcsonEdmCode_u = 0; // uint8_t
			 $this->cIcsonOTag_u = 0; // uint8_t
			 $this->cIcsonTradeShopGuideCost_u = 0; // uint8_t
			 $this->cIcsonCSPhoneType_u = 0; // uint8_t
			 $this->cIcsonCSPhoneOperator_u = 0; // uint8_t
			 $this->cIcsonCSPhoneNumber_u = 0; // uint8_t
			 $this->cIcsonCSPhoneArea_u = 0; // uint8_t
			 $this->cIcsonCSPhonePackageId_u = 0; // uint8_t
			 $this->cIcsonCSPhoneUserName_u = 0; // uint8_t
			 $this->cIcsonCSPhoneUserAddr_u = 0; // uint8_t
			 $this->cIcsonCSPhoneUserMobile_u = 0; // uint8_t
			 $this->cIcsonCSPhoneUserTel_u = 0; // uint8_t
			 $this->cIcsonCSPhoneIdCardNo_u = 0; // uint8_t
			 $this->cIcsonCSPhoneIdCardAddr_u = 0; // uint8_t
			 $this->cIcsonCSPhoneIdCardDate_u = 0; // uint8_t
			 $this->cIcsonCSPhoneZipCode_u = 0; // uint8_t
			 $this->cIcsonCSPhoneCardPrice_u = 0; // uint8_t
			 $this->cIcsonCSPhonePackagePrice_u = 0; // uint8_t
			 $this->cIcsonTradeFlag_u = 0; // uint8_t
			 $this->cIcsonPointType_u = 0; // uint8_t
			 $this->cIcsonPackageIds_u = 0; // uint8_t
			 $this->dwIcsonTradeCashBack = 0; // uint32_t
			 $this->cIcsonTradeCashBack_u = 0; // uint8_t
			 $this->strIcsonUnitCostInvoice = ""; // std::string
			 $this->cIcsonUnitCostInvoice_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushString($this->strDealId); // 序列化订单编号，格式:订单序号XXXXYYYY，如:101041051509351702 类型为std::string
			$bs->pushUint64_t($this->ddwDealId64); // 序列化订单单号，统一平台内部单号 类型为uint64_t
			$bs->pushUint64_t($this->ddwBdealId); // 序列化交易单号，买卖家一次交易行为描述 类型为uint64_t
			$bs->pushUint64_t($this->ddwTradeId); // 序列化商品订单号 类型为uint64_t
			$bs->pushUint64_t($this->ddwRecvFeeId); // 序列化打款单ID 类型为uint64_t
			$bs->pushUint64_t($this->ddwBuyerId); // 序列化买家ID 类型为uint64_t
			$bs->pushString($this->strBuyerNickName); // 序列化买家昵称 类型为std::string
			$bs->pushUint64_t($this->ddwSellerId); // 序列化商家ID 类型为uint64_t
			$bs->pushString($this->strSellerTitle); // 序列化商家名称 类型为std::string
			$bs->pushUint32_t($this->dwBusinessId); // 序列化业务ID 类型为uint32_t
			$bs->pushUint8_t($this->cTradeType); // 序列化订单类型 类型为uint8_t
			$bs->pushUint32_t($this->dwTradeSource); // 序列化下单渠道：1：业务主站；2：移动app；3：移动wap 类型为uint32_t
			$bs->pushUint8_t($this->cTradePayType); // 序列化支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款 类型为uint8_t
			$bs->pushString($this->strToken); // 序列化打款Token，兼容拍拍商品单 类型为std::string
			$bs->pushString($this->strDrawId); // 序列化打款DrawId，兼容拍拍商品单 类型为std::string
			$bs->pushString($this->strShippingfeeTemplateId); // 序列化运费模版ID 类型为std::string
			$bs->pushString($this->strShippingfeeDesc); // 序列化运费描述 类型为std::string
			$bs->pushUint32_t($this->dwItemShippingfee); // 序列化商品运费 类型为uint32_t
			$bs->pushUint32_t($this->dwItemType); // 序列化商品类型；1：普通商品；2：套餐主商品；3：套餐副商品；4：赠品主商品；5：赠品副商品; 6:组件 类型为uint32_t
			$bs->pushUint32_t($this->dwItemClassId); // 序列化品类（类目）ID 类型为uint32_t
			$bs->pushString($this->strItemTitle); // 序列化商品标题 类型为std::string
			$bs->pushString($this->strItemAttrCode); // 序列化商品销售属性编码 类型为std::string
			$bs->pushString($this->strItemAttr); // 序列化商品销售属性描述 类型为std::string
			$bs->pushString($this->strItemId); // 序列化商品ID，由业务定义 类型为std::string
			$bs->pushUint64_t($this->ddwItemSkuId); // 序列化商品SKUID 类型为uint64_t
			$bs->pushString($this->strItemLocalCode); // 序列化商品商家本地编码 类型为std::string
			$bs->pushString($this->strItemLocalStockCode); // 序列化商品商家本地库存编码 类型为std::string
			$bs->pushString($this->strItemBarCode); // 序列化商品条形码 类型为std::string
			$bs->pushUint64_t($this->ddwItemSpuId); // 序列化商品SPUID 类型为uint64_t
			$bs->pushUint64_t($this->ddwItemStockId); // 序列化商品库存ID 类型为uint64_t
			$bs->pushUint32_t($this->dwItemStoreHouseId); // 序列化商品仓库ID 类型为uint32_t
			$bs->pushString($this->strItemPhyisicalStorage); // 序列化商品所属物理仓 类型为std::string
			$bs->pushString($this->strItemLogo); // 序列化商品图片Logo 类型为std::string
			$bs->pushUint32_t($this->dwItemSnapVersion); // 序列化商品快照版本号 类型为uint32_t
			$bs->pushUint32_t($this->dwItemResetTime); // 序列化商品重置时间戳 类型为uint32_t
			$bs->pushUint32_t($this->dwItemWeight); // 序列化商品重量 类型为uint32_t
			$bs->pushUint32_t($this->dwItemVolume); // 序列化商品体积 类型为uint32_t
			$bs->pushUint64_t($this->ddwMainItemId); // 序列化商品套餐主商品ID 类型为uint64_t
			$bs->pushString($this->strItemAccessoryDesc); // 序列化商品标配说明 类型为std::string
			$bs->pushUint32_t($this->dwItemCostPrice); // 序列化商品成本价 类型为uint32_t
			$bs->pushUint32_t($this->dwItemOriginPrice); // 序列化商品市场价 类型为uint32_t
			$bs->pushUint32_t($this->dwItemSoldPrice); // 序列化商品销售单价 类型为uint32_t
			$bs->pushString($this->strItemB2CMarket); // 序列化自营B2C市场 类型为std::string
			$bs->pushString($this->strItemB2CPM); // 序列化自营B2CPM 类型为std::string
			$bs->pushUint8_t($this->cItemUseVirtualStock); // 序列化自营B2C是否占用虚库 类型为uint8_t
			$bs->pushUint32_t($this->dwBuyPrice); // 序列化商品成交价 类型为uint32_t
			$bs->pushUint32_t($this->dwBuyNum); // 序列化商品成交件数 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeTotalFee); // 序列化商品单总金额,下单金额 类型为uint32_t
			$bs->pushInt32_t($this->nTradeAdjustFee); // 序列化商品单调价金额 类型为int
			$bs->pushUint32_t($this->dwTradePayment); // 序列化实付总金额 类型为uint32_t
			$bs->pushInt32_t($this->nTradeDiscountTotal); // 序列化优惠总金额 类型为int
			$bs->pushUint32_t($this->dwTradePaipaiHongbaoUsed); // 序列化Paipai红包使用金额 类型为uint32_t
			$bs->pushUint32_t($this->dwPayScore); // 序列化积分支付值 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeGenTime); // 序列化商品单生成时间 类型为uint32_t
			$bs->pushUint16_t($this->wTradeOpSerialNo); // 序列化商品单库存操作序列号 类型为uint16_t
			$bs->pushUint32_t($this->dwObtainScore); // 序列化获得积分值 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeState); // 序列化商品单状态 类型为uint32_t
			$bs->pushUint32_t($this->dwPreTradeState); // 序列化商品单前一个状态 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeProperty); // 序列化商品单属性值 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeProperty1); // 序列化商品单属性值1 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeProperty2); // 序列化商品单属性值2 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeProperty3); // 序列化商品单属性值3 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeProperty4); // 序列化商品单属性值4 类型为uint32_t
			$bs->pushUint32_t($this->dwRefundState); // 序列化退款状态, 各退款单的汇总状态, 0:无退款,1:退款中,2:退款完成 类型为uint32_t
			$bs->pushUint32_t($this->dwRefundDetailState); // 序列化冗余退款单的退款状态，拍拍同步订单使用 类型为uint32_t
			$bs->pushUint32_t($this->dwDealRefundState); // 序列化订单退款状态, 冗余DealDo上的值, 各子单退款状态的汇总, 0:无退款,1:退款中,2:退款完成 类型为uint32_t
			$bs->pushUint32_t($this->dwEvalState); // 序列化评价评论状态 类型为uint32_t
			$bs->pushUint32_t($this->dwTradePayTime); // 序列化付款时间 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeCheckTime); // 序列化审核时间 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeConsignTime); // 序列化标记发货时间 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeMarkNoStockTime); // 序列化标记缺货时间 类型为uint32_t
			$bs->pushUint32_t($this->dwDelayConfirmDays); // 序列化延长确认收货天数 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeConfirmRecvTime); // 序列化签收时间 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeEndTime); // 序列化结束时间 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeRecvFeeTime); // 序列化打款时间 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeRecvFeeReturnTime); // 序列化打款返回时间 类型为uint32_t
			$bs->pushUint32_t($this->dwStockoutNum); // 序列化商品缺货总件数 类型为uint32_t
			$bs->pushUint32_t($this->dwRefuseNum); // 序列化拒收总件数 类型为uint32_t
			$bs->pushUint32_t($this->dwDoneNum); // 序列化实际成交件数 类型为uint32_t
			$bs->pushUint8_t($this->cCloseReasonType); // 序列化订单关闭原因类型 类型为uint8_t
			$bs->pushString($this->strCloseReasonDesc); // 序列化订单关闭原因描述 类型为std::string
			$bs->pushUint32_t($this->dwSellerTotalRecvFee); // 序列化卖家到账总金额 类型为uint32_t
			$bs->pushUint32_t($this->dwBuyerTotalRecvFee); // 序列化买家到账总金额 类型为uint32_t
			$bs->pushUint32_t($this->dwItemTimeoutFlag); // 序列化商品超时标识 类型为uint32_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // 序列化最后更新时间 类型为uint32_t
			$bs->pushObject($this->oActiveInfoList,'TradeActivePoList'); // 序列化商品活动列表 类型为ecc::deal::po::CTradeActivePoList
			$bs->pushObject($this->mmapDealExtInfoMap,'stl_multimap'); // 序列化订单扩展信息  类型为std::multimap<uint32_t,std::string> 
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId64_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBdealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvFeeId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerNickName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerTitle_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBusinessId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeSource_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradePayType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cToken_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDrawId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cShippingfeeTemplateId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cShippingfeeDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemShippingfee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemClassId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemTitle_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemAttrCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemAttr_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemLocalCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemLocalStockCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemBarCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemSpuId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemStockId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemStoreHouseId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemPhyisicalStorage_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemLogo_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemSnapVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemResetTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemWeight_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemVolume_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cMainItemId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemAccessoryDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemCostPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemOriginPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemSoldPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemB2CMarket_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemB2CPM_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemUseVirtualStock_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyNum_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeTotalFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeAdjustFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradePayment_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeDiscountTotal_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradePaipaiHongbaoUsed_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayScore_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeGenTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeOpSerialNo_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cObtainScore_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPreTradeState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeProperty_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeProperty1_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeProperty2_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeProperty3_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeProperty4_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundDetailState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealRefundState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cEvalState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradePayTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeCheckTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeConsignTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeMarkNoStockTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDelayConfirmDays_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeConfirmRecvTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeEndTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeRecvFeeTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeRecvFeeReturnTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cStockoutNum_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefuseNum_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDoneNum_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCloseReasonType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCloseReasonDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerTotalRecvFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerTotalRecvFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemTimeoutFlag_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cActiveInfoList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealExtInfoMap_u); // 序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwTradeSellerSendTime); // 序列化标记发货时间 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strWarranty); // 序列化保修条款 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint64_t($this->ddwProductId); // 序列化产品id 类型为uint64_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strProductCode); // 序列化产品id编码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonEdmCode); // 序列化易迅edm编码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonOTag); // 序列化易迅OTag 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonTradeShopGuideCost); // 序列化易迅店铺导购费用 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneType); // 序列化易迅定制机类型 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneOperator); // 序列化易迅定制机运营商 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneNumber); // 序列化易迅定制机号码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneArea); // 序列化易迅定制机归属地 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhonePackageId); // 序列化易迅定制机套餐id 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneUserName); // 序列化易迅定制机用户姓名 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneUserAddr); // 序列化易迅定制机用户地址 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneUserMobile); // 序列化易迅定制机用户联系手机 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneUserTel); // 序列化易迅定制机用户联系电话 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneIdCardNo); // 序列化易迅定制机身份证号码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneIdCardAddr); // 序列化易迅定制机身份证地址 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneIdCardDate); // 序列化易迅定制机身份证有效期 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneZipCode); // 序列化易迅定制机邮政编码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneCardPrice); // 序列化易迅定制机卡价格 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhonePackagePrice); // 序列化易迅定制机套餐价格 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonTradeFlag); // 序列化易迅商品子单flag 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonPointType); // 序列化易迅积分兑换类型 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonPackageIds); // 序列化易迅商品子单套餐id 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cTradeSellerSendTime_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cWarranty_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cProductId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cProductCode_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonEdmCode_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonOTag_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonTradeShopGuideCost_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneType_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneOperator_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneNumber_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneArea_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhonePackageId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneUserName_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneUserAddr_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneUserMobile_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneUserTel_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneIdCardNo_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneIdCardAddr_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneIdCardDate_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneZipCode_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneCardPrice_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhonePackagePrice_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonTradeFlag_u); // 序列化易迅商品子单flag 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonPointType_u); // 序列化易迅积分兑换类型 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonPackageIds_u); // 序列化易迅商品子单套餐id 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwIcsonTradeCashBack); // 序列化子单返现金额 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cIcsonTradeCashBack_u); // 序列化子单返现金额UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 3 ){
				$bs->pushString($this->strIcsonUnitCostInvoice); // 序列化去税后成本 类型为std::string
			}
			if(  $this->wVersion >= 3 ){
				$bs->pushUint8_t($this->cIcsonUnitCostInvoice_u); // 序列化去税后成本UFlag 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->strDealId = $bs->popString(); // 反序列化订单编号，格式:订单序号XXXXYYYY，如:101041051509351702 类型为std::string
			$this->ddwDealId64 = $bs->popUint64_t(); // 反序列化订单单号，统一平台内部单号 类型为uint64_t
			$this->ddwBdealId = $bs->popUint64_t(); // 反序列化交易单号，买卖家一次交易行为描述 类型为uint64_t
			$this->ddwTradeId = $bs->popUint64_t(); // 反序列化商品订单号 类型为uint64_t
			$this->ddwRecvFeeId = $bs->popUint64_t(); // 反序列化打款单ID 类型为uint64_t
			$this->ddwBuyerId = $bs->popUint64_t(); // 反序列化买家ID 类型为uint64_t
			$this->strBuyerNickName = $bs->popString(); // 反序列化买家昵称 类型为std::string
			$this->ddwSellerId = $bs->popUint64_t(); // 反序列化商家ID 类型为uint64_t
			$this->strSellerTitle = $bs->popString(); // 反序列化商家名称 类型为std::string
			$this->dwBusinessId = $bs->popUint32_t(); // 反序列化业务ID 类型为uint32_t
			$this->cTradeType = $bs->popUint8_t(); // 反序列化订单类型 类型为uint8_t
			$this->dwTradeSource = $bs->popUint32_t(); // 反序列化下单渠道：1：业务主站；2：移动app；3：移动wap 类型为uint32_t
			$this->cTradePayType = $bs->popUint8_t(); // 反序列化支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款 类型为uint8_t
			$this->strToken = $bs->popString(); // 反序列化打款Token，兼容拍拍商品单 类型为std::string
			$this->strDrawId = $bs->popString(); // 反序列化打款DrawId，兼容拍拍商品单 类型为std::string
			$this->strShippingfeeTemplateId = $bs->popString(); // 反序列化运费模版ID 类型为std::string
			$this->strShippingfeeDesc = $bs->popString(); // 反序列化运费描述 类型为std::string
			$this->dwItemShippingfee = $bs->popUint32_t(); // 反序列化商品运费 类型为uint32_t
			$this->dwItemType = $bs->popUint32_t(); // 反序列化商品类型；1：普通商品；2：套餐主商品；3：套餐副商品；4：赠品主商品；5：赠品副商品; 6:组件 类型为uint32_t
			$this->dwItemClassId = $bs->popUint32_t(); // 反序列化品类（类目）ID 类型为uint32_t
			$this->strItemTitle = $bs->popString(); // 反序列化商品标题 类型为std::string
			$this->strItemAttrCode = $bs->popString(); // 反序列化商品销售属性编码 类型为std::string
			$this->strItemAttr = $bs->popString(); // 反序列化商品销售属性描述 类型为std::string
			$this->strItemId = $bs->popString(); // 反序列化商品ID，由业务定义 类型为std::string
			$this->ddwItemSkuId = $bs->popUint64_t(); // 反序列化商品SKUID 类型为uint64_t
			$this->strItemLocalCode = $bs->popString(); // 反序列化商品商家本地编码 类型为std::string
			$this->strItemLocalStockCode = $bs->popString(); // 反序列化商品商家本地库存编码 类型为std::string
			$this->strItemBarCode = $bs->popString(); // 反序列化商品条形码 类型为std::string
			$this->ddwItemSpuId = $bs->popUint64_t(); // 反序列化商品SPUID 类型为uint64_t
			$this->ddwItemStockId = $bs->popUint64_t(); // 反序列化商品库存ID 类型为uint64_t
			$this->dwItemStoreHouseId = $bs->popUint32_t(); // 反序列化商品仓库ID 类型为uint32_t
			$this->strItemPhyisicalStorage = $bs->popString(); // 反序列化商品所属物理仓 类型为std::string
			$this->strItemLogo = $bs->popString(); // 反序列化商品图片Logo 类型为std::string
			$this->dwItemSnapVersion = $bs->popUint32_t(); // 反序列化商品快照版本号 类型为uint32_t
			$this->dwItemResetTime = $bs->popUint32_t(); // 反序列化商品重置时间戳 类型为uint32_t
			$this->dwItemWeight = $bs->popUint32_t(); // 反序列化商品重量 类型为uint32_t
			$this->dwItemVolume = $bs->popUint32_t(); // 反序列化商品体积 类型为uint32_t
			$this->ddwMainItemId = $bs->popUint64_t(); // 反序列化商品套餐主商品ID 类型为uint64_t
			$this->strItemAccessoryDesc = $bs->popString(); // 反序列化商品标配说明 类型为std::string
			$this->dwItemCostPrice = $bs->popUint32_t(); // 反序列化商品成本价 类型为uint32_t
			$this->dwItemOriginPrice = $bs->popUint32_t(); // 反序列化商品市场价 类型为uint32_t
			$this->dwItemSoldPrice = $bs->popUint32_t(); // 反序列化商品销售单价 类型为uint32_t
			$this->strItemB2CMarket = $bs->popString(); // 反序列化自营B2C市场 类型为std::string
			$this->strItemB2CPM = $bs->popString(); // 反序列化自营B2CPM 类型为std::string
			$this->cItemUseVirtualStock = $bs->popUint8_t(); // 反序列化自营B2C是否占用虚库 类型为uint8_t
			$this->dwBuyPrice = $bs->popUint32_t(); // 反序列化商品成交价 类型为uint32_t
			$this->dwBuyNum = $bs->popUint32_t(); // 反序列化商品成交件数 类型为uint32_t
			$this->dwTradeTotalFee = $bs->popUint32_t(); // 反序列化商品单总金额,下单金额 类型为uint32_t
			$this->nTradeAdjustFee = $bs->popInt32_t(); // 反序列化商品单调价金额 类型为int
			$this->dwTradePayment = $bs->popUint32_t(); // 反序列化实付总金额 类型为uint32_t
			$this->nTradeDiscountTotal = $bs->popInt32_t(); // 反序列化优惠总金额 类型为int
			$this->dwTradePaipaiHongbaoUsed = $bs->popUint32_t(); // 反序列化Paipai红包使用金额 类型为uint32_t
			$this->dwPayScore = $bs->popUint32_t(); // 反序列化积分支付值 类型为uint32_t
			$this->dwTradeGenTime = $bs->popUint32_t(); // 反序列化商品单生成时间 类型为uint32_t
			$this->wTradeOpSerialNo = $bs->popUint16_t(); // 反序列化商品单库存操作序列号 类型为uint16_t
			$this->dwObtainScore = $bs->popUint32_t(); // 反序列化获得积分值 类型为uint32_t
			$this->dwTradeState = $bs->popUint32_t(); // 反序列化商品单状态 类型为uint32_t
			$this->dwPreTradeState = $bs->popUint32_t(); // 反序列化商品单前一个状态 类型为uint32_t
			$this->dwTradeProperty = $bs->popUint32_t(); // 反序列化商品单属性值 类型为uint32_t
			$this->dwTradeProperty1 = $bs->popUint32_t(); // 反序列化商品单属性值1 类型为uint32_t
			$this->dwTradeProperty2 = $bs->popUint32_t(); // 反序列化商品单属性值2 类型为uint32_t
			$this->dwTradeProperty3 = $bs->popUint32_t(); // 反序列化商品单属性值3 类型为uint32_t
			$this->dwTradeProperty4 = $bs->popUint32_t(); // 反序列化商品单属性值4 类型为uint32_t
			$this->dwRefundState = $bs->popUint32_t(); // 反序列化退款状态, 各退款单的汇总状态, 0:无退款,1:退款中,2:退款完成 类型为uint32_t
			$this->dwRefundDetailState = $bs->popUint32_t(); // 反序列化冗余退款单的退款状态，拍拍同步订单使用 类型为uint32_t
			$this->dwDealRefundState = $bs->popUint32_t(); // 反序列化订单退款状态, 冗余DealDo上的值, 各子单退款状态的汇总, 0:无退款,1:退款中,2:退款完成 类型为uint32_t
			$this->dwEvalState = $bs->popUint32_t(); // 反序列化评价评论状态 类型为uint32_t
			$this->dwTradePayTime = $bs->popUint32_t(); // 反序列化付款时间 类型为uint32_t
			$this->dwTradeCheckTime = $bs->popUint32_t(); // 反序列化审核时间 类型为uint32_t
			$this->dwTradeConsignTime = $bs->popUint32_t(); // 反序列化标记发货时间 类型为uint32_t
			$this->dwTradeMarkNoStockTime = $bs->popUint32_t(); // 反序列化标记缺货时间 类型为uint32_t
			$this->dwDelayConfirmDays = $bs->popUint32_t(); // 反序列化延长确认收货天数 类型为uint32_t
			$this->dwTradeConfirmRecvTime = $bs->popUint32_t(); // 反序列化签收时间 类型为uint32_t
			$this->dwTradeEndTime = $bs->popUint32_t(); // 反序列化结束时间 类型为uint32_t
			$this->dwTradeRecvFeeTime = $bs->popUint32_t(); // 反序列化打款时间 类型为uint32_t
			$this->dwTradeRecvFeeReturnTime = $bs->popUint32_t(); // 反序列化打款返回时间 类型为uint32_t
			$this->dwStockoutNum = $bs->popUint32_t(); // 反序列化商品缺货总件数 类型为uint32_t
			$this->dwRefuseNum = $bs->popUint32_t(); // 反序列化拒收总件数 类型为uint32_t
			$this->dwDoneNum = $bs->popUint32_t(); // 反序列化实际成交件数 类型为uint32_t
			$this->cCloseReasonType = $bs->popUint8_t(); // 反序列化订单关闭原因类型 类型为uint8_t
			$this->strCloseReasonDesc = $bs->popString(); // 反序列化订单关闭原因描述 类型为std::string
			$this->dwSellerTotalRecvFee = $bs->popUint32_t(); // 反序列化卖家到账总金额 类型为uint32_t
			$this->dwBuyerTotalRecvFee = $bs->popUint32_t(); // 反序列化买家到账总金额 类型为uint32_t
			$this->dwItemTimeoutFlag = $bs->popUint32_t(); // 反序列化商品超时标识 类型为uint32_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // 反序列化最后更新时间 类型为uint32_t
			$this->oActiveInfoList = $bs->popObject('TradeActivePoList'); // 反序列化商品活动列表 类型为ecc::deal::po::CTradeActivePoList
			$this->mmapDealExtInfoMap = $bs->popObject('stl_multimap<uint32_t,stl_string>'); // 反序列化订单扩展信息  类型为std::multimap<uint32_t,std::string> 
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId64_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBdealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvFeeId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerNickName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerTitle_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBusinessId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeSource_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradePayType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cToken_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDrawId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cShippingfeeTemplateId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cShippingfeeDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemShippingfee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemClassId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemTitle_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemAttrCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemAttr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemLocalCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemLocalStockCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemBarCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemSpuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemStockId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemStoreHouseId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemPhyisicalStorage_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemLogo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemSnapVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemResetTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemWeight_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemVolume_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cMainItemId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemAccessoryDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemCostPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemOriginPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemSoldPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemB2CMarket_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemB2CPM_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemUseVirtualStock_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeTotalFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeAdjustFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradePayment_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeDiscountTotal_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradePaipaiHongbaoUsed_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayScore_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeGenTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeOpSerialNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cObtainScore_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPreTradeState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeProperty1_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeProperty2_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeProperty3_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeProperty4_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundDetailState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealRefundState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cEvalState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradePayTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeCheckTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeConsignTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeMarkNoStockTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDelayConfirmDays_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeConfirmRecvTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeEndTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeRecvFeeTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeRecvFeeReturnTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cStockoutNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefuseNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDoneNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCloseReasonType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCloseReasonDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerTotalRecvFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerTotalRecvFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemTimeoutFlag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cActiveInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealExtInfoMap_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$this->dwTradeSellerSendTime = $bs->popUint32_t(); // 反序列化标记发货时间 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->strWarranty = $bs->popString(); // 反序列化保修条款 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->ddwProductId = $bs->popUint64_t(); // 反序列化产品id 类型为uint64_t
			}
			if(  $this->wVersion >= 1 ){
				$this->strProductCode = $bs->popString(); // 反序列化产品id编码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonEdmCode = $bs->popString(); // 反序列化易迅edm编码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonOTag = $bs->popString(); // 反序列化易迅OTag 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonTradeShopGuideCost = $bs->popString(); // 反序列化易迅店铺导购费用 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneType = $bs->popString(); // 反序列化易迅定制机类型 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneOperator = $bs->popString(); // 反序列化易迅定制机运营商 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneNumber = $bs->popString(); // 反序列化易迅定制机号码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneArea = $bs->popString(); // 反序列化易迅定制机归属地 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhonePackageId = $bs->popString(); // 反序列化易迅定制机套餐id 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneUserName = $bs->popString(); // 反序列化易迅定制机用户姓名 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneUserAddr = $bs->popString(); // 反序列化易迅定制机用户地址 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneUserMobile = $bs->popString(); // 反序列化易迅定制机用户联系手机 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneUserTel = $bs->popString(); // 反序列化易迅定制机用户联系电话 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneIdCardNo = $bs->popString(); // 反序列化易迅定制机身份证号码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneIdCardAddr = $bs->popString(); // 反序列化易迅定制机身份证地址 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneIdCardDate = $bs->popString(); // 反序列化易迅定制机身份证有效期 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneZipCode = $bs->popString(); // 反序列化易迅定制机邮政编码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneCardPrice = $bs->popString(); // 反序列化易迅定制机卡价格 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhonePackagePrice = $bs->popString(); // 反序列化易迅定制机套餐价格 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonTradeFlag = $bs->popString(); // 反序列化易迅商品子单flag 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonPointType = $bs->popString(); // 反序列化易迅积分兑换类型 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonPackageIds = $bs->popString(); // 反序列化易迅商品子单套餐id 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cTradeSellerSendTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cWarranty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cProductId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cProductCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonEdmCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonOTag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonTradeShopGuideCost_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneOperator_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneNumber_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneArea_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhonePackageId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneUserName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneUserAddr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneUserMobile_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneUserTel_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneIdCardNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneIdCardAddr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneIdCardDate_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneZipCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneCardPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhonePackagePrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonTradeFlag_u = $bs->popUint8_t(); // 反序列化易迅商品子单flag 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonPointType_u = $bs->popUint8_t(); // 反序列化易迅积分兑换类型 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonPackageIds_u = $bs->popUint8_t(); // 反序列化易迅商品子单套餐id 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwIcsonTradeCashBack = $bs->popUint32_t(); // 反序列化子单返现金额 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cIcsonTradeCashBack_u = $bs->popUint8_t(); // 反序列化子单返现金额UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 3 ){
				$this->strIcsonUnitCostInvoice = $bs->popString(); // 反序列化去税后成本 类型为std::string
			}
			if(  $this->wVersion >= 3 ){
				$this->cIcsonUnitCostInvoice_u = $bs->popUint8_t(); // 反序列化去税后成本UFlag 类型为uint8_t
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


//source idl: com.ecc.deal.idl.TradePo.java

if (!class_exists('TradeActivePoList')) {
class TradeActivePoList
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 商品但活动列表
		 *
		 * 版本 >= 0
		 */
		var $vecTradeActiveInfoList; //std::vector<ecc::deal::po::CTradeActivePo> 

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeActiveInfoList_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->vecTradeActiveInfoList = new stl_vector('TradeActivePo'); // std::vector<ecc::deal::po::CTradeActivePo> 
			 $this->cVersion_u = 0; // uint8_t
			 $this->cTradeActiveInfoList_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushObject($this->vecTradeActiveInfoList,'stl_vector'); // 序列化商品但活动列表 类型为std::vector<ecc::deal::po::CTradeActivePo> 
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeActiveInfoList_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->vecTradeActiveInfoList = $bs->popObject('stl_vector<TradeActivePo>'); // 反序列化商品但活动列表 类型为std::vector<ecc::deal::po::CTradeActivePo> 
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeActiveInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.ecc.deal.idl.TradeActivePoList.java

if (!class_exists('TradeActivePo')) {
class TradeActivePo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 记录id
		 *
		 * 版本 >= 0
		 */
		var $ddwId; //uint64_t

		/**
		 * 商品订单编号
		 *
		 * 版本 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		 *
		 * 版本 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * 订单单号，统一平台内部单号
		 *
		 * 版本 >= 0
		 */
		var $ddwDealId64; //uint64_t

		/**
		 * 交易订单编号
		 *
		 * 版本 >= 0
		 */
		var $ddwBdealId; //uint64_t

		/**
		 * 买家ID
		 *
		 * 版本 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * 商家ID
		 *
		 * 版本 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * 活动类型，平台统一定义.1:VIP价 2:满减  3:满送 4:满包邮 5:优惠券 
		 *
		 * 版本 >= 0
		 */
		var $wActiveType; //uint16_t

		/**
		 * 活动编号
		 *
		 * 版本 >= 0
		 */
		var $ddwActiveNo; //uint64_t

		/**
		 * 活动命中规则编号
		 *
		 * 版本 >= 0
		 */
		var $dwActiveRuleId; //uint32_t

		/**
		 * 活动描述
		 *
		 * 版本 >= 0
		 */
		var $strActiveDesc; //std::string

		/**
		 * 调价金额，商品调价记录用，单件活动
		 *
		 * 版本 >= 0
		 */
		var $nAdjustFee; //int

		/**
		 * 活动前本商品订单金额
		 *
		 * 版本 >= 0
		 */
		var $dwPreActiveFee; //uint32_t

		/**
		 * 活动本商品订单优惠金额，正数表示优惠，负数表示加钱
		 *
		 * 版本 >= 0
		 */
		var $nFavorFee; //int

		/**
		 * 活动参数1
		 *
		 * 版本 >= 0
		 */
		var $dwActiveParam1; //uint32_t

		/**
		 * 活动参数2
		 *
		 * 版本 >= 0
		 */
		var $dwActiveParam2; //uint32_t

		/**
		 * 活动参数3
		 *
		 * 版本 >= 0
		 */
		var $dwActiveParam3; //uint32_t

		/**
		 * 活动参数4
		 *
		 * 版本 >= 0
		 */
		var $dwActiveParam4; //uint32_t

		/**
		 * 活动参数5
		 *
		 * 版本 >= 0
		 */
		var $ddwActiveParam5; //uint64_t

		/**
		 * 活动参数6
		 *
		 * 版本 >= 0
		 */
		var $ddwActiveParam6; //uint64_t

		/**
		 * 活动参数7
		 *
		 * 版本 >= 0
		 */
		var $strActiveParam7; //std::string

		/**
		 * 活动参数8
		 *
		 * 版本 >= 0
		 */
		var $strActiveParam8; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId64_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBdealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cActiveNo_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cActiveType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cActiveRuleId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cActiveDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cAdjustFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPreActiveFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cFavorFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cActiveParam1_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cActiveParam2_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cActiveParam3_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cActiveParam4_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cActiveParam5_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cActiveParam6_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cActiveParam7_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cActiveParam8_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->ddwId = 0; // uint64_t
			 $this->ddwTradeId = 0; // uint64_t
			 $this->strDealId = ""; // std::string
			 $this->ddwDealId64 = 0; // uint64_t
			 $this->ddwBdealId = 0; // uint64_t
			 $this->ddwBuyerId = 0; // uint64_t
			 $this->ddwSellerId = 0; // uint64_t
			 $this->wActiveType = 0; // uint16_t
			 $this->ddwActiveNo = 0; // uint64_t
			 $this->dwActiveRuleId = 0; // uint32_t
			 $this->strActiveDesc = ""; // std::string
			 $this->nAdjustFee = 0; // int
			 $this->dwPreActiveFee = 0; // uint32_t
			 $this->nFavorFee = 0; // int
			 $this->dwActiveParam1 = 0; // uint32_t
			 $this->dwActiveParam2 = 0; // uint32_t
			 $this->dwActiveParam3 = 0; // uint32_t
			 $this->dwActiveParam4 = 0; // uint32_t
			 $this->ddwActiveParam5 = 0; // uint64_t
			 $this->ddwActiveParam6 = 0; // uint64_t
			 $this->strActiveParam7 = ""; // std::string
			 $this->strActiveParam8 = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cId_u = 0; // uint8_t
			 $this->cTradeId_u = 0; // uint8_t
			 $this->cDealId_u = 0; // uint8_t
			 $this->cDealId64_u = 0; // uint8_t
			 $this->cBdealId_u = 0; // uint8_t
			 $this->cBuyerId_u = 0; // uint8_t
			 $this->cSellerId_u = 0; // uint8_t
			 $this->cActiveNo_u = 0; // uint8_t
			 $this->cActiveType_u = 0; // uint8_t
			 $this->cActiveRuleId_u = 0; // uint8_t
			 $this->cActiveDesc_u = 0; // uint8_t
			 $this->cAdjustFee_u = 0; // uint8_t
			 $this->cPreActiveFee_u = 0; // uint8_t
			 $this->cFavorFee_u = 0; // uint8_t
			 $this->cActiveParam1_u = 0; // uint8_t
			 $this->cActiveParam2_u = 0; // uint8_t
			 $this->cActiveParam3_u = 0; // uint8_t
			 $this->cActiveParam4_u = 0; // uint8_t
			 $this->cActiveParam5_u = 0; // uint8_t
			 $this->cActiveParam6_u = 0; // uint8_t
			 $this->cActiveParam7_u = 0; // uint8_t
			 $this->cActiveParam8_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushUint64_t($this->ddwId); // 序列化记录id 类型为uint64_t
			$bs->pushUint64_t($this->ddwTradeId); // 序列化商品订单编号 类型为uint64_t
			$bs->pushString($this->strDealId); // 序列化订单编号，格式:订单序号XXXXYYYY，如:101041051509351702 类型为std::string
			$bs->pushUint64_t($this->ddwDealId64); // 序列化订单单号，统一平台内部单号 类型为uint64_t
			$bs->pushUint64_t($this->ddwBdealId); // 序列化交易订单编号 类型为uint64_t
			$bs->pushUint64_t($this->ddwBuyerId); // 序列化买家ID 类型为uint64_t
			$bs->pushUint64_t($this->ddwSellerId); // 序列化商家ID 类型为uint64_t
			$bs->pushUint16_t($this->wActiveType); // 序列化活动类型，平台统一定义.1:VIP价 2:满减  3:满送 4:满包邮 5:优惠券  类型为uint16_t
			$bs->pushUint64_t($this->ddwActiveNo); // 序列化活动编号 类型为uint64_t
			$bs->pushUint32_t($this->dwActiveRuleId); // 序列化活动命中规则编号 类型为uint32_t
			$bs->pushString($this->strActiveDesc); // 序列化活动描述 类型为std::string
			$bs->pushInt32_t($this->nAdjustFee); // 序列化调价金额，商品调价记录用，单件活动 类型为int
			$bs->pushUint32_t($this->dwPreActiveFee); // 序列化活动前本商品订单金额 类型为uint32_t
			$bs->pushInt32_t($this->nFavorFee); // 序列化活动本商品订单优惠金额，正数表示优惠，负数表示加钱 类型为int
			$bs->pushUint32_t($this->dwActiveParam1); // 序列化活动参数1 类型为uint32_t
			$bs->pushUint32_t($this->dwActiveParam2); // 序列化活动参数2 类型为uint32_t
			$bs->pushUint32_t($this->dwActiveParam3); // 序列化活动参数3 类型为uint32_t
			$bs->pushUint32_t($this->dwActiveParam4); // 序列化活动参数4 类型为uint32_t
			$bs->pushUint64_t($this->ddwActiveParam5); // 序列化活动参数5 类型为uint64_t
			$bs->pushUint64_t($this->ddwActiveParam6); // 序列化活动参数6 类型为uint64_t
			$bs->pushString($this->strActiveParam7); // 序列化活动参数7 类型为std::string
			$bs->pushString($this->strActiveParam8); // 序列化活动参数8 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId64_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBdealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cActiveNo_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cActiveType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cActiveRuleId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cActiveDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cAdjustFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPreActiveFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cFavorFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cActiveParam1_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cActiveParam2_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cActiveParam3_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cActiveParam4_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cActiveParam5_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cActiveParam6_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cActiveParam7_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cActiveParam8_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->ddwId = $bs->popUint64_t(); // 反序列化记录id 类型为uint64_t
			$this->ddwTradeId = $bs->popUint64_t(); // 反序列化商品订单编号 类型为uint64_t
			$this->strDealId = $bs->popString(); // 反序列化订单编号，格式:订单序号XXXXYYYY，如:101041051509351702 类型为std::string
			$this->ddwDealId64 = $bs->popUint64_t(); // 反序列化订单单号，统一平台内部单号 类型为uint64_t
			$this->ddwBdealId = $bs->popUint64_t(); // 反序列化交易订单编号 类型为uint64_t
			$this->ddwBuyerId = $bs->popUint64_t(); // 反序列化买家ID 类型为uint64_t
			$this->ddwSellerId = $bs->popUint64_t(); // 反序列化商家ID 类型为uint64_t
			$this->wActiveType = $bs->popUint16_t(); // 反序列化活动类型，平台统一定义.1:VIP价 2:满减  3:满送 4:满包邮 5:优惠券  类型为uint16_t
			$this->ddwActiveNo = $bs->popUint64_t(); // 反序列化活动编号 类型为uint64_t
			$this->dwActiveRuleId = $bs->popUint32_t(); // 反序列化活动命中规则编号 类型为uint32_t
			$this->strActiveDesc = $bs->popString(); // 反序列化活动描述 类型为std::string
			$this->nAdjustFee = $bs->popInt32_t(); // 反序列化调价金额，商品调价记录用，单件活动 类型为int
			$this->dwPreActiveFee = $bs->popUint32_t(); // 反序列化活动前本商品订单金额 类型为uint32_t
			$this->nFavorFee = $bs->popInt32_t(); // 反序列化活动本商品订单优惠金额，正数表示优惠，负数表示加钱 类型为int
			$this->dwActiveParam1 = $bs->popUint32_t(); // 反序列化活动参数1 类型为uint32_t
			$this->dwActiveParam2 = $bs->popUint32_t(); // 反序列化活动参数2 类型为uint32_t
			$this->dwActiveParam3 = $bs->popUint32_t(); // 反序列化活动参数3 类型为uint32_t
			$this->dwActiveParam4 = $bs->popUint32_t(); // 反序列化活动参数4 类型为uint32_t
			$this->ddwActiveParam5 = $bs->popUint64_t(); // 反序列化活动参数5 类型为uint64_t
			$this->ddwActiveParam6 = $bs->popUint64_t(); // 反序列化活动参数6 类型为uint64_t
			$this->strActiveParam7 = $bs->popString(); // 反序列化活动参数7 类型为std::string
			$this->strActiveParam8 = $bs->popString(); // 反序列化活动参数8 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId64_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBdealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cActiveNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cActiveType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cActiveRuleId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cActiveDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cAdjustFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPreActiveFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cFavorFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cActiveParam1_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cActiveParam2_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cActiveParam3_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cActiveParam4_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cActiveParam5_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cActiveParam6_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cActiveParam7_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cActiveParam8_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.ecc.deal.idl.DealPo.java

if (!class_exists('RecvFeePoList')) {
class RecvFeePoList
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 打款单列表
		 *
		 * 版本 >= 0
		 */
		var $vecRecvFeeInfoList; //std::vector<ecc::deal::po::CRecvFeePo> 

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvFeeInfoList_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->vecRecvFeeInfoList = new stl_vector('RecvFeePo'); // std::vector<ecc::deal::po::CRecvFeePo> 
			 $this->cVersion_u = 0; // uint8_t
			 $this->cRecvFeeInfoList_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化版本号 类型为uint16_t
			$bs->pushObject($this->vecRecvFeeInfoList,'stl_vector'); // 序列化打款单列表 类型为std::vector<ecc::deal::po::CRecvFeePo> 
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvFeeInfoList_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化版本号 类型为uint16_t
			$this->vecRecvFeeInfoList = $bs->popObject('stl_vector<RecvFeePo>'); // 反序列化打款单列表 类型为std::vector<ecc::deal::po::CRecvFeePo> 
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvFeeInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.ecc.deal.idl.RecvFeePoList.java

if (!class_exists('RecvFeePo')) {
class RecvFeePo
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 打款单DB操作类型，0:Insert 1:Update
		 *
		 * 版本 >= 0
		 */
		var $dwControl; //uint32_t

		/**
		 * 退款单ID
		 *
		 * 版本 >= 0
		 */
		var $ddwRecvFeeId; //uint64_t

		/**
		 * 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		 *
		 * 版本 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * 订单单号，统一平台内部单号
		 *
		 * 版本 >= 0
		 */
		var $ddwDealId64; //uint64_t

		/**
		 * 支付单ID
		 *
		 * 版本 >= 0
		 */
		var $ddwPayId; //uint64_t

		/**
		 * 财付通订单ID
		 *
		 * 版本 >= 0
		 */
		var $strCftDealId; //std::string

		/**
		 * 打款标识
		 *
		 * 版本 >= 0
		 */
		var $strDrawId; //std::string

		/**
		 * 打款token
		 *
		 * 版本 >= 0
		 */
		var $strDrawToken; //std::string

		/**
		 * 买家ID
		 *
		 * 版本 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * 买家帐号
		 *
		 * 版本 >= 0
		 */
		var $strBuyerAccount; //std::string

		/**
		 * 买家收到金额
		 *
		 * 版本 >= 0
		 */
		var $dwBuyerRecvFee; //uint32_t

		/**
		 * 商家ID
		 *
		 * 版本 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * 商家帐号
		 *
		 * 版本 >= 0
		 */
		var $strSellerAccount; //std::string

		/**
		 * 卖家收到金额
		 *
		 * 版本 >= 0
		 */
		var $dwSellerRecvFee; //uint32_t

		/**
		 * 商品标题列表
		 *
		 * 版本 >= 0
		 */
		var $strItemTitleList; //std::string

		/**
		 * 打款单状态，1，已发起打款；2，打款完成
		 *
		 * 版本 >= 0
		 */
		var $dwRecvFeeState; //uint32_t

		/**
		 * 打款单类型，1确认收货打款  2全额退款打款 3售后打款 4仲裁后打款
		 *
		 * 版本 >= 0
		 */
		var $dwRecvFeeType; //uint32_t

		/**
		 * 打款完成时间
		 *
		 * 版本 >= 0
		 */
		var $dwRecvFeeFinishTime; //uint32_t

		/**
		 * 打款返回时间
		 *
		 * 版本 >= 0
		 */
		var $dwRecvFeeReturnTime; //uint32_t

		/**
		 * 打款发起时间
		 *
		 * 版本 >= 0
		 */
		var $dwRecvFeeGenTime; //uint32_t

		/**
		 * 最后更新时间
		 *
		 * 版本 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cControl_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvFeeId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId64_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCftDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDrawId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDrawToken_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerAccount_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerRecvFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerAccount_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerRecvFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemTitleList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvFeeState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvFeeType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvFeeFinishTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvFeeReturnTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvFeeGenTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->dwControl = 0; // uint32_t
			 $this->ddwRecvFeeId = 0; // uint64_t
			 $this->strDealId = ""; // std::string
			 $this->ddwDealId64 = 0; // uint64_t
			 $this->ddwPayId = 0; // uint64_t
			 $this->strCftDealId = ""; // std::string
			 $this->strDrawId = ""; // std::string
			 $this->strDrawToken = ""; // std::string
			 $this->ddwBuyerId = 0; // uint64_t
			 $this->strBuyerAccount = ""; // std::string
			 $this->dwBuyerRecvFee = 0; // uint32_t
			 $this->ddwSellerId = 0; // uint64_t
			 $this->strSellerAccount = ""; // std::string
			 $this->dwSellerRecvFee = 0; // uint32_t
			 $this->strItemTitleList = ""; // std::string
			 $this->dwRecvFeeState = 0; // uint32_t
			 $this->dwRecvFeeType = 0; // uint32_t
			 $this->dwRecvFeeFinishTime = 0; // uint32_t
			 $this->dwRecvFeeReturnTime = 0; // uint32_t
			 $this->dwRecvFeeGenTime = 0; // uint32_t
			 $this->dwLastUpdateTime = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->cControl_u = 0; // uint8_t
			 $this->cRecvFeeId_u = 0; // uint8_t
			 $this->cDealId_u = 0; // uint8_t
			 $this->cDealId64_u = 0; // uint8_t
			 $this->cPayId_u = 0; // uint8_t
			 $this->cCftDealId_u = 0; // uint8_t
			 $this->cDrawId_u = 0; // uint8_t
			 $this->cDrawToken_u = 0; // uint8_t
			 $this->cBuyerId_u = 0; // uint8_t
			 $this->cBuyerAccount_u = 0; // uint8_t
			 $this->cBuyerRecvFee_u = 0; // uint8_t
			 $this->cSellerId_u = 0; // uint8_t
			 $this->cSellerAccount_u = 0; // uint8_t
			 $this->cSellerRecvFee_u = 0; // uint8_t
			 $this->cItemTitleList_u = 0; // uint8_t
			 $this->cRecvFeeState_u = 0; // uint8_t
			 $this->cRecvFeeType_u = 0; // uint8_t
			 $this->cRecvFeeFinishTime_u = 0; // uint8_t
			 $this->cRecvFeeReturnTime_u = 0; // uint8_t
			 $this->cRecvFeeGenTime_u = 0; // uint8_t
			 $this->cLastUpdateTime_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化版本号 类型为uint16_t
			$bs->pushUint32_t($this->dwControl); // 序列化打款单DB操作类型，0:Insert 1:Update 类型为uint32_t
			$bs->pushUint64_t($this->ddwRecvFeeId); // 序列化退款单ID 类型为uint64_t
			$bs->pushString($this->strDealId); // 序列化订单编号，格式:订单序号XXXXYYYY，如:101041051509351702 类型为std::string
			$bs->pushUint64_t($this->ddwDealId64); // 序列化订单单号，统一平台内部单号 类型为uint64_t
			$bs->pushUint64_t($this->ddwPayId); // 序列化支付单ID 类型为uint64_t
			$bs->pushString($this->strCftDealId); // 序列化财付通订单ID 类型为std::string
			$bs->pushString($this->strDrawId); // 序列化打款标识 类型为std::string
			$bs->pushString($this->strDrawToken); // 序列化打款token 类型为std::string
			$bs->pushUint64_t($this->ddwBuyerId); // 序列化买家ID 类型为uint64_t
			$bs->pushString($this->strBuyerAccount); // 序列化买家帐号 类型为std::string
			$bs->pushUint32_t($this->dwBuyerRecvFee); // 序列化买家收到金额 类型为uint32_t
			$bs->pushUint64_t($this->ddwSellerId); // 序列化商家ID 类型为uint64_t
			$bs->pushString($this->strSellerAccount); // 序列化商家帐号 类型为std::string
			$bs->pushUint32_t($this->dwSellerRecvFee); // 序列化卖家收到金额 类型为uint32_t
			$bs->pushString($this->strItemTitleList); // 序列化商品标题列表 类型为std::string
			$bs->pushUint32_t($this->dwRecvFeeState); // 序列化打款单状态，1，已发起打款；2，打款完成 类型为uint32_t
			$bs->pushUint32_t($this->dwRecvFeeType); // 序列化打款单类型，1确认收货打款  2全额退款打款 3售后打款 4仲裁后打款 类型为uint32_t
			$bs->pushUint32_t($this->dwRecvFeeFinishTime); // 序列化打款完成时间 类型为uint32_t
			$bs->pushUint32_t($this->dwRecvFeeReturnTime); // 序列化打款返回时间 类型为uint32_t
			$bs->pushUint32_t($this->dwRecvFeeGenTime); // 序列化打款发起时间 类型为uint32_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // 序列化最后更新时间 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cControl_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvFeeId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId64_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCftDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDrawId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDrawToken_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerAccount_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerRecvFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerAccount_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerRecvFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemTitleList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvFeeState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvFeeType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvFeeFinishTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvFeeReturnTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvFeeGenTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化版本号 类型为uint16_t
			$this->dwControl = $bs->popUint32_t(); // 反序列化打款单DB操作类型，0:Insert 1:Update 类型为uint32_t
			$this->ddwRecvFeeId = $bs->popUint64_t(); // 反序列化退款单ID 类型为uint64_t
			$this->strDealId = $bs->popString(); // 反序列化订单编号，格式:订单序号XXXXYYYY，如:101041051509351702 类型为std::string
			$this->ddwDealId64 = $bs->popUint64_t(); // 反序列化订单单号，统一平台内部单号 类型为uint64_t
			$this->ddwPayId = $bs->popUint64_t(); // 反序列化支付单ID 类型为uint64_t
			$this->strCftDealId = $bs->popString(); // 反序列化财付通订单ID 类型为std::string
			$this->strDrawId = $bs->popString(); // 反序列化打款标识 类型为std::string
			$this->strDrawToken = $bs->popString(); // 反序列化打款token 类型为std::string
			$this->ddwBuyerId = $bs->popUint64_t(); // 反序列化买家ID 类型为uint64_t
			$this->strBuyerAccount = $bs->popString(); // 反序列化买家帐号 类型为std::string
			$this->dwBuyerRecvFee = $bs->popUint32_t(); // 反序列化买家收到金额 类型为uint32_t
			$this->ddwSellerId = $bs->popUint64_t(); // 反序列化商家ID 类型为uint64_t
			$this->strSellerAccount = $bs->popString(); // 反序列化商家帐号 类型为std::string
			$this->dwSellerRecvFee = $bs->popUint32_t(); // 反序列化卖家收到金额 类型为uint32_t
			$this->strItemTitleList = $bs->popString(); // 反序列化商品标题列表 类型为std::string
			$this->dwRecvFeeState = $bs->popUint32_t(); // 反序列化打款单状态，1，已发起打款；2，打款完成 类型为uint32_t
			$this->dwRecvFeeType = $bs->popUint32_t(); // 反序列化打款单类型，1确认收货打款  2全额退款打款 3售后打款 4仲裁后打款 类型为uint32_t
			$this->dwRecvFeeFinishTime = $bs->popUint32_t(); // 反序列化打款完成时间 类型为uint32_t
			$this->dwRecvFeeReturnTime = $bs->popUint32_t(); // 反序列化打款返回时间 类型为uint32_t
			$this->dwRecvFeeGenTime = $bs->popUint32_t(); // 反序列化打款发起时间 类型为uint32_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // 反序列化最后更新时间 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cControl_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvFeeId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId64_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCftDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDrawId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDrawToken_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerAccount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerRecvFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerAccount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerRecvFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemTitleList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvFeeState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvFeeType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvFeeFinishTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvFeeReturnTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvFeeGenTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.ecc.deal.idl.DealPo.java

if (!class_exists('DealWuliuPoList')) {
class DealWuliuPoList
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 物流单列表
		 *
		 * 版本 >= 0
		 */
		var $vecWuliuInfoList; //std::vector<ecc::deal::po::CDealWuliuPo> 

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cWuliuInfoList_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->vecWuliuInfoList = new stl_vector('DealWuliuPo'); // std::vector<ecc::deal::po::CDealWuliuPo> 
			 $this->cVersion_u = 0; // uint8_t
			 $this->cWuliuInfoList_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化版本号 类型为uint16_t
			$bs->pushObject($this->vecWuliuInfoList,'stl_vector'); // 序列化物流单列表 类型为std::vector<ecc::deal::po::CDealWuliuPo> 
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cWuliuInfoList_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化版本号 类型为uint16_t
			$this->vecWuliuInfoList = $bs->popObject('stl_vector<DealWuliuPo>'); // 反序列化物流单列表 类型为std::vector<ecc::deal::po::CDealWuliuPo> 
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cWuliuInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.ecc.deal.idl.DealWuliuPoList.java

if (!class_exists('DealWuliuPo')) {
class DealWuliuPo
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 物流单DB操作类型，0:Insert 1:Update
		 *
		 * 版本 >= 0
		 */
		var $dwControl; //uint32_t

		/**
		 * 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		 *
		 * 版本 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * 订单单号，统一平台内部单号
		 *
		 * 版本 >= 0
		 */
		var $ddwDealId64; //uint64_t

		/**
		 * 统一平台内部物流单号
		 *
		 * 版本 >= 0
		 */
		var $ddwInnerWuliuId; //uint64_t

		/**
		 * 买家ID
		 *
		 * 版本 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * 买家昵称
		 *
		 * 版本 >= 0
		 */
		var $strBuyerNickName; //std::string

		/**
		 * 商家ID
		 *
		 * 版本 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * 商家名称
		 *
		 * 版本 >= 0
		 */
		var $strSellerTitle; //std::string

		/**
		 * 物流订单号，物流系统维护
		 *
		 * 版本 >= 0
		 */
		var $strWuliuDealId; //std::string

		/**
		 * 配送方式；1：平邮；2：快递；3：EMS；4：B2C自建物流；5：用户配送点自提
		 *
		 * 版本 >= 0
		 */
		var $cExpressType; //uint8_t

		/**
		 * 物流公司ID
		 *
		 * 版本 >= 0
		 */
		var $strExpressCompanyID; //std::string

		/**
		 * 物流公司名称
		 *
		 * 版本 >= 0
		 */
		var $strExpressCompanyName; //std::string

		/**
		 * 物流公司订单号
		 *
		 * 版本 >= 0
		 */
		var $strExpressDealID; //std::string

		/**
		 * 预计到达天数
		 *
		 * 版本 >= 0
		 */
		var $wExpectArriveDays; //uint16_t

		/**
		 * 商品单信息列表：TradeId1:件数1;TradeId2:件数2..
		 *
		 * 版本 >= 0
		 */
		var $strTradeInfoList; //std::string

		/**
		 * 商品标题列表
		 *
		 * 版本 >= 0
		 */
		var $strItemTitleList; //std::string

		/**
		 * 收货人姓名
		 *
		 * 版本 >= 0
		 */
		var $strRecvName; //std::string

		/**
		 * 收货地区编码
		 *
		 * 版本 >= 0
		 */
		var $dwRecvRegionCode; //uint32_t

		/**
		 * 收货地址
		 *
		 * 版本 >= 0
		 */
		var $strRecvAddress; //std::string

		/**
		 * 邮编
		 *
		 * 版本 >= 0
		 */
		var $strRecvPostCode; //std::string

		/**
		 * 收货人电话
		 *
		 * 版本 >= 0
		 */
		var $strRecvPhone; //std::string

		/**
		 * 收货人手机
		 *
		 * 版本 >= 0
		 */
		var $ddwRecvMobile; //uint64_t

		/**
		 * 期望收货日期
		 *
		 * 版本 >= 0
		 */
		var $dwRecvExpectDate; //uint32_t

		/**
		 * 期望收货时间段
		 *
		 * 版本 >= 0
		 */
		var $strRecvExpectTimeSpan; //std::string

		/**
		 * 收货附言
		 *
		 * 版本 >= 0
		 */
		var $strRecvRemark; //std::string

		/**
		 * 收货属性
		 *
		 * 版本 >= 0
		 */
		var $dwRecvMask; //uint32_t

		/**
		 * 商家发货附言
		 *
		 * 版本 >= 0
		 */
		var $strSellerConsignNote; //std::string

		/**
		 * 物流取件地址
		 *
		 * 版本 >= 0
		 */
		var $strWuliuGetItemAddr; //std::string

		/**
		 * 物流发货时间
		 *
		 * 版本 >= 0
		 */
		var $dwWuliuSendTime; //uint32_t

		/**
		 * 物流收货时间
		 *
		 * 版本 >= 0
		 */
		var $dwWuliuRecvTime; //uint32_t

		/**
		 * 物流单生成时间
		 *
		 * 版本 >= 0
		 */
		var $dwWuliuGenTime; //uint32_t

		/**
		 * 记录更新时间
		 *
		 * 版本 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cControl_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId64_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cInnerWuliuId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerNickName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerTitle_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cWuliuDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExpressType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExpressCompanyID_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExpressCompanyName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExpressDealID_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExpectArriveDays_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeInfoList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemTitleList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvRegionCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvAddress_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvPostCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvPhone_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvMobile_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvExpectDate_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvExpectTimeSpan_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvRemark_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvMask_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerConsignNote_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cWuliuGetItemAddr_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cWuliuSendTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cWuliuRecvTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cWuliuGenTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t

		/**
		 * 扩展地区编码
		 *
		 * 版本 >= 1
		 */
		var $strRecvRegionCodeExt; //std::string

		/**
		 * 扩展地区编码UFlag
		 *
		 * 版本 >= 1
		 */
		var $cRecvRegionCodeExt_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 1; // uint16_t
			 $this->dwControl = 0; // uint32_t
			 $this->strDealId = ""; // std::string
			 $this->ddwDealId64 = 0; // uint64_t
			 $this->ddwInnerWuliuId = 0; // uint64_t
			 $this->ddwBuyerId = 0; // uint64_t
			 $this->strBuyerNickName = ""; // std::string
			 $this->ddwSellerId = 0; // uint64_t
			 $this->strSellerTitle = ""; // std::string
			 $this->strWuliuDealId = ""; // std::string
			 $this->cExpressType = 0; // uint8_t
			 $this->strExpressCompanyID = ""; // std::string
			 $this->strExpressCompanyName = ""; // std::string
			 $this->strExpressDealID = ""; // std::string
			 $this->wExpectArriveDays = 0; // uint16_t
			 $this->strTradeInfoList = ""; // std::string
			 $this->strItemTitleList = ""; // std::string
			 $this->strRecvName = ""; // std::string
			 $this->dwRecvRegionCode = 0; // uint32_t
			 $this->strRecvAddress = ""; // std::string
			 $this->strRecvPostCode = ""; // std::string
			 $this->strRecvPhone = ""; // std::string
			 $this->ddwRecvMobile = 0; // uint64_t
			 $this->dwRecvExpectDate = 0; // uint32_t
			 $this->strRecvExpectTimeSpan = ""; // std::string
			 $this->strRecvRemark = ""; // std::string
			 $this->dwRecvMask = 0; // uint32_t
			 $this->strSellerConsignNote = ""; // std::string
			 $this->strWuliuGetItemAddr = ""; // std::string
			 $this->dwWuliuSendTime = 0; // uint32_t
			 $this->dwWuliuRecvTime = 0; // uint32_t
			 $this->dwWuliuGenTime = 0; // uint32_t
			 $this->dwLastUpdateTime = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->cControl_u = 0; // uint8_t
			 $this->cDealId_u = 0; // uint8_t
			 $this->cDealId64_u = 0; // uint8_t
			 $this->cInnerWuliuId_u = 0; // uint8_t
			 $this->cBuyerId_u = 0; // uint8_t
			 $this->cBuyerNickName_u = 0; // uint8_t
			 $this->cSellerId_u = 0; // uint8_t
			 $this->cSellerTitle_u = 0; // uint8_t
			 $this->cWuliuDealId_u = 0; // uint8_t
			 $this->cExpressType_u = 0; // uint8_t
			 $this->cExpressCompanyID_u = 0; // uint8_t
			 $this->cExpressCompanyName_u = 0; // uint8_t
			 $this->cExpressDealID_u = 0; // uint8_t
			 $this->cExpectArriveDays_u = 0; // uint8_t
			 $this->cTradeInfoList_u = 0; // uint8_t
			 $this->cItemTitleList_u = 0; // uint8_t
			 $this->cRecvName_u = 0; // uint8_t
			 $this->cRecvRegionCode_u = 0; // uint8_t
			 $this->cRecvAddress_u = 0; // uint8_t
			 $this->cRecvPostCode_u = 0; // uint8_t
			 $this->cRecvPhone_u = 0; // uint8_t
			 $this->cRecvMobile_u = 0; // uint8_t
			 $this->cRecvExpectDate_u = 0; // uint8_t
			 $this->cRecvExpectTimeSpan_u = 0; // uint8_t
			 $this->cRecvRemark_u = 0; // uint8_t
			 $this->cRecvMask_u = 0; // uint8_t
			 $this->cSellerConsignNote_u = 0; // uint8_t
			 $this->cWuliuGetItemAddr_u = 0; // uint8_t
			 $this->cWuliuSendTime_u = 0; // uint8_t
			 $this->cWuliuRecvTime_u = 0; // uint8_t
			 $this->cWuliuGenTime_u = 0; // uint8_t
			 $this->cLastUpdateTime_u = 0; // uint8_t
			 $this->strRecvRegionCodeExt = ""; // std::string
			 $this->cRecvRegionCodeExt_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化版本号 类型为uint16_t
			$bs->pushUint32_t($this->dwControl); // 序列化物流单DB操作类型，0:Insert 1:Update 类型为uint32_t
			$bs->pushString($this->strDealId); // 序列化订单编号，格式:订单序号XXXXYYYY，如:101041051509351702 类型为std::string
			$bs->pushUint64_t($this->ddwDealId64); // 序列化订单单号，统一平台内部单号 类型为uint64_t
			$bs->pushUint64_t($this->ddwInnerWuliuId); // 序列化统一平台内部物流单号 类型为uint64_t
			$bs->pushUint64_t($this->ddwBuyerId); // 序列化买家ID 类型为uint64_t
			$bs->pushString($this->strBuyerNickName); // 序列化买家昵称 类型为std::string
			$bs->pushUint64_t($this->ddwSellerId); // 序列化商家ID 类型为uint64_t
			$bs->pushString($this->strSellerTitle); // 序列化商家名称 类型为std::string
			$bs->pushString($this->strWuliuDealId); // 序列化物流订单号，物流系统维护 类型为std::string
			$bs->pushUint8_t($this->cExpressType); // 序列化配送方式；1：平邮；2：快递；3：EMS；4：B2C自建物流；5：用户配送点自提 类型为uint8_t
			$bs->pushString($this->strExpressCompanyID); // 序列化物流公司ID 类型为std::string
			$bs->pushString($this->strExpressCompanyName); // 序列化物流公司名称 类型为std::string
			$bs->pushString($this->strExpressDealID); // 序列化物流公司订单号 类型为std::string
			$bs->pushUint16_t($this->wExpectArriveDays); // 序列化预计到达天数 类型为uint16_t
			$bs->pushString($this->strTradeInfoList); // 序列化商品单信息列表：TradeId1:件数1;TradeId2:件数2.. 类型为std::string
			$bs->pushString($this->strItemTitleList); // 序列化商品标题列表 类型为std::string
			$bs->pushString($this->strRecvName); // 序列化收货人姓名 类型为std::string
			$bs->pushUint32_t($this->dwRecvRegionCode); // 序列化收货地区编码 类型为uint32_t
			$bs->pushString($this->strRecvAddress); // 序列化收货地址 类型为std::string
			$bs->pushString($this->strRecvPostCode); // 序列化邮编 类型为std::string
			$bs->pushString($this->strRecvPhone); // 序列化收货人电话 类型为std::string
			$bs->pushUint64_t($this->ddwRecvMobile); // 序列化收货人手机 类型为uint64_t
			$bs->pushUint32_t($this->dwRecvExpectDate); // 序列化期望收货日期 类型为uint32_t
			$bs->pushString($this->strRecvExpectTimeSpan); // 序列化期望收货时间段 类型为std::string
			$bs->pushString($this->strRecvRemark); // 序列化收货附言 类型为std::string
			$bs->pushUint32_t($this->dwRecvMask); // 序列化收货属性 类型为uint32_t
			$bs->pushString($this->strSellerConsignNote); // 序列化商家发货附言 类型为std::string
			$bs->pushString($this->strWuliuGetItemAddr); // 序列化物流取件地址 类型为std::string
			$bs->pushUint32_t($this->dwWuliuSendTime); // 序列化物流发货时间 类型为uint32_t
			$bs->pushUint32_t($this->dwWuliuRecvTime); // 序列化物流收货时间 类型为uint32_t
			$bs->pushUint32_t($this->dwWuliuGenTime); // 序列化物流单生成时间 类型为uint32_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // 序列化记录更新时间 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cControl_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId64_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cInnerWuliuId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerNickName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerTitle_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cWuliuDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExpressType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExpressCompanyID_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExpressCompanyName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExpressDealID_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExpectArriveDays_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeInfoList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemTitleList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvRegionCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvAddress_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvPostCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvPhone_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvMobile_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvExpectDate_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvExpectTimeSpan_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvRemark_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvMask_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerConsignNote_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cWuliuGetItemAddr_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cWuliuSendTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cWuliuRecvTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cWuliuGenTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // 序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strRecvRegionCodeExt); // 序列化扩展地区编码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cRecvRegionCodeExt_u); // 序列化扩展地区编码UFlag 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化版本号 类型为uint16_t
			$this->dwControl = $bs->popUint32_t(); // 反序列化物流单DB操作类型，0:Insert 1:Update 类型为uint32_t
			$this->strDealId = $bs->popString(); // 反序列化订单编号，格式:订单序号XXXXYYYY，如:101041051509351702 类型为std::string
			$this->ddwDealId64 = $bs->popUint64_t(); // 反序列化订单单号，统一平台内部单号 类型为uint64_t
			$this->ddwInnerWuliuId = $bs->popUint64_t(); // 反序列化统一平台内部物流单号 类型为uint64_t
			$this->ddwBuyerId = $bs->popUint64_t(); // 反序列化买家ID 类型为uint64_t
			$this->strBuyerNickName = $bs->popString(); // 反序列化买家昵称 类型为std::string
			$this->ddwSellerId = $bs->popUint64_t(); // 反序列化商家ID 类型为uint64_t
			$this->strSellerTitle = $bs->popString(); // 反序列化商家名称 类型为std::string
			$this->strWuliuDealId = $bs->popString(); // 反序列化物流订单号，物流系统维护 类型为std::string
			$this->cExpressType = $bs->popUint8_t(); // 反序列化配送方式；1：平邮；2：快递；3：EMS；4：B2C自建物流；5：用户配送点自提 类型为uint8_t
			$this->strExpressCompanyID = $bs->popString(); // 反序列化物流公司ID 类型为std::string
			$this->strExpressCompanyName = $bs->popString(); // 反序列化物流公司名称 类型为std::string
			$this->strExpressDealID = $bs->popString(); // 反序列化物流公司订单号 类型为std::string
			$this->wExpectArriveDays = $bs->popUint16_t(); // 反序列化预计到达天数 类型为uint16_t
			$this->strTradeInfoList = $bs->popString(); // 反序列化商品单信息列表：TradeId1:件数1;TradeId2:件数2.. 类型为std::string
			$this->strItemTitleList = $bs->popString(); // 反序列化商品标题列表 类型为std::string
			$this->strRecvName = $bs->popString(); // 反序列化收货人姓名 类型为std::string
			$this->dwRecvRegionCode = $bs->popUint32_t(); // 反序列化收货地区编码 类型为uint32_t
			$this->strRecvAddress = $bs->popString(); // 反序列化收货地址 类型为std::string
			$this->strRecvPostCode = $bs->popString(); // 反序列化邮编 类型为std::string
			$this->strRecvPhone = $bs->popString(); // 反序列化收货人电话 类型为std::string
			$this->ddwRecvMobile = $bs->popUint64_t(); // 反序列化收货人手机 类型为uint64_t
			$this->dwRecvExpectDate = $bs->popUint32_t(); // 反序列化期望收货日期 类型为uint32_t
			$this->strRecvExpectTimeSpan = $bs->popString(); // 反序列化期望收货时间段 类型为std::string
			$this->strRecvRemark = $bs->popString(); // 反序列化收货附言 类型为std::string
			$this->dwRecvMask = $bs->popUint32_t(); // 反序列化收货属性 类型为uint32_t
			$this->strSellerConsignNote = $bs->popString(); // 反序列化商家发货附言 类型为std::string
			$this->strWuliuGetItemAddr = $bs->popString(); // 反序列化物流取件地址 类型为std::string
			$this->dwWuliuSendTime = $bs->popUint32_t(); // 反序列化物流发货时间 类型为uint32_t
			$this->dwWuliuRecvTime = $bs->popUint32_t(); // 反序列化物流收货时间 类型为uint32_t
			$this->dwWuliuGenTime = $bs->popUint32_t(); // 反序列化物流单生成时间 类型为uint32_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // 反序列化记录更新时间 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cControl_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId64_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cInnerWuliuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerNickName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerTitle_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cWuliuDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExpressType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExpressCompanyID_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExpressCompanyName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExpressDealID_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExpectArriveDays_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemTitleList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvRegionCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvAddress_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvPostCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvPhone_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvMobile_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvExpectDate_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvExpectTimeSpan_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvRemark_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvMask_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerConsignNote_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cWuliuGetItemAddr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cWuliuSendTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cWuliuRecvTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cWuliuGenTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$this->strRecvRegionCodeExt = $bs->popString(); // 反序列化扩展地区编码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cRecvRegionCodeExt_u = $bs->popUint8_t(); // 反序列化扩展地区编码UFlag 类型为uint8_t
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


//source idl: com.ecc.deal.idl.DealPo.java

if (!class_exists('DealRefundPoList')) {
class DealRefundPoList
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 退款单列表
		 *
		 * 版本 >= 0
		 */
		var $vecDealRefundInfoList; //std::vector<ecc::deal::po::CDealRefundPo> 

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealRefundInfoList_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->vecDealRefundInfoList = new stl_vector('DealRefundPo'); // std::vector<ecc::deal::po::CDealRefundPo> 
			 $this->cVersion_u = 0; // uint8_t
			 $this->cDealRefundInfoList_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化版本号 类型为uint16_t
			$bs->pushObject($this->vecDealRefundInfoList,'stl_vector'); // 序列化退款单列表 类型为std::vector<ecc::deal::po::CDealRefundPo> 
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealRefundInfoList_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化版本号 类型为uint16_t
			$this->vecDealRefundInfoList = $bs->popObject('stl_vector<DealRefundPo>'); // 反序列化退款单列表 类型为std::vector<ecc::deal::po::CDealRefundPo> 
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealRefundInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.ecc.deal.idl.DealRefundPoList.java

if (!class_exists('DealRefundPo')) {
class DealRefundPo
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 退款单DB操作类型，0:Insert 1:Update
		 *
		 * 版本 >= 0
		 */
		var $dwControl; //uint32_t

		/**
		 * 退款单ID
		 *
		 * 版本 >= 0
		 */
		var $ddwRefundDetailId; //uint64_t

		/**
		 * 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		 *
		 * 版本 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * 订单单号，统一平台内部单号
		 *
		 * 版本 >= 0
		 */
		var $ddwDealId64; //uint64_t

		/**
		 * 商品单ID
		 *
		 * 版本 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * 商品skuID列表
		 *
		 * 版本 >= 0
		 */
		var $strItemSkuidList; //std::string

		/**
		 * 商品标题列表
		 *
		 * 版本 >= 0
		 */
		var $strItemTitleList; //std::string

		/**
		 * 买家ID
		 *
		 * 版本 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * 买家帐号
		 *
		 * 版本 >= 0
		 */
		var $strBuyerAccount; //std::string

		/**
		 * 买家昵称
		 *
		 * 版本 >= 0
		 */
		var $strBuyerNickName; //std::string

		/**
		 * 商家ID
		 *
		 * 版本 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * 商家名称
		 *
		 * 版本 >= 0
		 */
		var $strSellerTitle; //std::string

		/**
		 * 退款订单支付方式
		 *
		 * 版本 >= 0
		 */
		var $cDealPayType; //uint8_t

		/**
		 * 退款单类型
		 *
		 * 版本 >= 0
		 */
		var $cRefundType; //uint8_t

		/**
		 * 订单商品成交单价
		 *
		 * 版本 >= 0
		 */
		var $dwItemBuyPrice; //uint32_t

		/**
		 * 订单商品购买件数，按商品单退款有效
		 *
		 * 版本 >= 0
		 */
		var $dwItemBuyNum; //uint32_t

		/**
		 * 退款商品件数，按商品单退款有效
		 *
		 * 版本 >= 0
		 */
		var $dwRefundItemNum; //uint32_t

		/**
		 * 退款订单总金额
		 *
		 * 版本 >= 0
		 */
		var $dwRefundDealTotalFee; //uint32_t

		/**
		 * 退款商品总金额
		 *
		 * 版本 >= 0
		 */
		var $dwRefundItemTotalFee; //uint32_t

		/**
		 * 退款商品优惠总金额
		 *
		 * 版本 >= 0
		 */
		var $nRefundItemDiscountTotalFee; //int

		/**
		 * 退款商品占优惠列表
		 *
		 * 版本 >= 0
		 */
		var $strRefundItemActiveDesc; //std::string

		/**
		 * 退款商品调价总金额
		 *
		 * 版本 >= 0
		 */
		var $nRefundItemAdjustTotalFee; //int

		/**
		 * 退款商品邮费总金额
		 *
		 * 版本 >= 0
		 */
		var $dwRefundShippingFee; //uint32_t

		/**
		 * 退款单总金额
		 *
		 * 版本 >= 0
		 */
		var $dwRefundTotalFee; //uint32_t

		/**
		 * 退款单卖家收到金额
		 *
		 * 版本 >= 0
		 */
		var $dwRefundSellerRecvFee; //uint32_t

		/**
		 * 退款单买家收到金额
		 *
		 * 版本 >= 0
		 */
		var $dwRefundBuyerRecvFee; //uint32_t

		/**
		 * 退款单状态, 参考UNPDealState_E中有关退款的各个状态值
		 *
		 * 版本 >= 0
		 */
		var $dwRefundState; //uint32_t

		/**
		 * 退款单前一个状态
		 *
		 * 版本 >= 0
		 */
		var $dwPreRefundState; //uint32_t

		/**
		 * 退款单属性
		 *
		 * 版本 >= 0
		 */
		var $ddwRefundProperty; //uint64_t

		/**
		 * 退款单生成时间
		 *
		 * 版本 >= 0
		 */
		var $dwRefundGenTime; //uint32_t

		/**
		 * 退款申请时间，买家
		 *
		 * 版本 >= 0
		 */
		var $dwRefundApplyTime; //uint32_t

		/**
		 * 退款打款完成时间
		 *
		 * 版本 >= 0
		 */
		var $dwRefundRecvFeeTime; //uint32_t

		/**
		 * 退款打款返回时间
		 *
		 * 版本 >= 0
		 */
		var $dwRefundRecvFeeReturnTime; //uint32_t

		/**
		 * 退款完成时间，退款协议达成
		 *
		 * 版本 >= 0
		 */
		var $dwRefundFinishTime; //uint32_t

		/**
		 * 买家发送退货时间，有退货时有效
		 *
		 * 版本 >= 0
		 */
		var $dwItemReturnSendTime; //uint32_t

		/**
		 * 买家发送退货物流信息，有退货时有效
		 *
		 * 版本 >= 0
		 */
		var $strItemReturnWuliuInfo; //std::string

		/**
		 * 买家退货描述，有退货时有效
		 *
		 * 版本 >= 0
		 */
		var $strItemReturnDesc; //std::string

		/**
		 * 退货收货状态，有退货时有效，1，收到货，2，未收到货
		 *
		 * 版本 >= 0
		 */
		var $cItemReturnTradeState; //uint8_t

		/**
		 * 退款原因类型
		 *
		 * 版本 >= 0
		 */
		var $cRefundReasonType; //uint8_t

		/**
		 * 退款原因描述
		 *
		 * 版本 >= 0
		 */
		var $strRefundReasonDesc; //std::string

		/**
		 * 卖家同意退款时间
		 *
		 * 版本 >= 0
		 */
		var $dwSellerAgreeRefundTime; //uint32_t

		/**
		 * 卖家同意退货时间
		 *
		 * 版本 >= 0
		 */
		var $dwSellerAgreeItemReturnTime; //uint32_t

		/**
		 * 卖家拒绝退款时间
		 *
		 * 版本 >= 0
		 */
		var $dwSellerRefuseRefundTime; //uint32_t

		/**
		 * 卖家退货地址
		 *
		 * 版本 >= 0
		 */
		var $strSellerItemReturnAddress; //std::string

		/**
		 * 卖家处理退款附言
		 *
		 * 版本 >= 0
		 */
		var $strSellerProcessRefundMsg; //std::string

		/**
		 * 卖家处理退货附言
		 *
		 * 版本 >= 0
		 */
		var $strSellerProcessItemReturnMsg; //std::string

		/**
		 * 退款单打款ID
		 *
		 * 版本 >= 0
		 */
		var $ddwRecvFeeId; //uint64_t

		/**
		 * 订单生成时间
		 *
		 * 版本 >= 0
		 */
		var $dwDealCreateTime; //uint32_t

		/**
		 * 超时标识
		 *
		 * 版本 >= 0
		 */
		var $dwTimeoutFlag; //uint32_t

		/**
		 * 记录更新时间
		 *
		 * 版本 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cControl_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundDetailId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId64_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemSkuidList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemTitleList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerAccount_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerNickName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerTitle_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealPayType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemBuyPrice_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemBuyNum_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundItemNum_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundDealTotalFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundItemTotalFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundItemDiscountTotalFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundItemActiveDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundItemAdjustTotalFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundShippingFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundTotalFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundSellerRecvFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundBuyerRecvFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPreRefundState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundProperty_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundGenTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundApplyTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundRecvFeeTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundRecvFeeReturnTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundFinishTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemReturnSendTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemReturnWuliuInfo_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemReturnDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemReturnTradeState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundReasonType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundReasonDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerAgreeRefundTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerAgreeItemReturnTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerRefuseRefundTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerItemReturnAddress_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerProcessRefundMsg_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerProcessItemReturnMsg_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvFeeId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealCreateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTimeoutFlag_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t

		/**
		 * 业务退款单号
		 *
		 * 版本 >= 1
		 */
		var $strBusinessRefundId; //std::string

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cBusinessRefundId_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 1; // uint16_t
			 $this->dwControl = 0; // uint32_t
			 $this->ddwRefundDetailId = 0; // uint64_t
			 $this->strDealId = ""; // std::string
			 $this->ddwDealId64 = 0; // uint64_t
			 $this->ddwTradeId = 0; // uint64_t
			 $this->strItemSkuidList = ""; // std::string
			 $this->strItemTitleList = ""; // std::string
			 $this->ddwBuyerId = 0; // uint64_t
			 $this->strBuyerAccount = ""; // std::string
			 $this->strBuyerNickName = ""; // std::string
			 $this->ddwSellerId = 0; // uint64_t
			 $this->strSellerTitle = ""; // std::string
			 $this->cDealPayType = 0; // uint8_t
			 $this->cRefundType = 0; // uint8_t
			 $this->dwItemBuyPrice = 0; // uint32_t
			 $this->dwItemBuyNum = 0; // uint32_t
			 $this->dwRefundItemNum = 0; // uint32_t
			 $this->dwRefundDealTotalFee = 0; // uint32_t
			 $this->dwRefundItemTotalFee = 0; // uint32_t
			 $this->nRefundItemDiscountTotalFee = 0; // int
			 $this->strRefundItemActiveDesc = ""; // std::string
			 $this->nRefundItemAdjustTotalFee = 0; // int
			 $this->dwRefundShippingFee = 0; // uint32_t
			 $this->dwRefundTotalFee = 0; // uint32_t
			 $this->dwRefundSellerRecvFee = 0; // uint32_t
			 $this->dwRefundBuyerRecvFee = 0; // uint32_t
			 $this->dwRefundState = 0; // uint32_t
			 $this->dwPreRefundState = 0; // uint32_t
			 $this->ddwRefundProperty = 0; // uint64_t
			 $this->dwRefundGenTime = 0; // uint32_t
			 $this->dwRefundApplyTime = 0; // uint32_t
			 $this->dwRefundRecvFeeTime = 0; // uint32_t
			 $this->dwRefundRecvFeeReturnTime = 0; // uint32_t
			 $this->dwRefundFinishTime = 0; // uint32_t
			 $this->dwItemReturnSendTime = 0; // uint32_t
			 $this->strItemReturnWuliuInfo = ""; // std::string
			 $this->strItemReturnDesc = ""; // std::string
			 $this->cItemReturnTradeState = 0; // uint8_t
			 $this->cRefundReasonType = 0; // uint8_t
			 $this->strRefundReasonDesc = ""; // std::string
			 $this->dwSellerAgreeRefundTime = 0; // uint32_t
			 $this->dwSellerAgreeItemReturnTime = 0; // uint32_t
			 $this->dwSellerRefuseRefundTime = 0; // uint32_t
			 $this->strSellerItemReturnAddress = ""; // std::string
			 $this->strSellerProcessRefundMsg = ""; // std::string
			 $this->strSellerProcessItemReturnMsg = ""; // std::string
			 $this->ddwRecvFeeId = 0; // uint64_t
			 $this->dwDealCreateTime = 0; // uint32_t
			 $this->dwTimeoutFlag = 0; // uint32_t
			 $this->dwLastUpdateTime = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->cControl_u = 0; // uint8_t
			 $this->cRefundDetailId_u = 0; // uint8_t
			 $this->cDealId_u = 0; // uint8_t
			 $this->cDealId64_u = 0; // uint8_t
			 $this->cTradeId_u = 0; // uint8_t
			 $this->cItemSkuidList_u = 0; // uint8_t
			 $this->cItemTitleList_u = 0; // uint8_t
			 $this->cBuyerId_u = 0; // uint8_t
			 $this->cBuyerAccount_u = 0; // uint8_t
			 $this->cBuyerNickName_u = 0; // uint8_t
			 $this->cSellerId_u = 0; // uint8_t
			 $this->cSellerTitle_u = 0; // uint8_t
			 $this->cDealPayType_u = 0; // uint8_t
			 $this->cRefundType_u = 0; // uint8_t
			 $this->cItemBuyPrice_u = 0; // uint8_t
			 $this->cItemBuyNum_u = 0; // uint8_t
			 $this->cRefundItemNum_u = 0; // uint8_t
			 $this->cRefundDealTotalFee_u = 0; // uint8_t
			 $this->cRefundItemTotalFee_u = 0; // uint8_t
			 $this->cRefundItemDiscountTotalFee_u = 0; // uint8_t
			 $this->cRefundItemActiveDesc_u = 0; // uint8_t
			 $this->cRefundItemAdjustTotalFee_u = 0; // uint8_t
			 $this->cRefundShippingFee_u = 0; // uint8_t
			 $this->cRefundTotalFee_u = 0; // uint8_t
			 $this->cRefundSellerRecvFee_u = 0; // uint8_t
			 $this->cRefundBuyerRecvFee_u = 0; // uint8_t
			 $this->cRefundState_u = 0; // uint8_t
			 $this->cPreRefundState_u = 0; // uint8_t
			 $this->cRefundProperty_u = 0; // uint8_t
			 $this->cRefundGenTime_u = 0; // uint8_t
			 $this->cRefundApplyTime_u = 0; // uint8_t
			 $this->cRefundRecvFeeTime_u = 0; // uint8_t
			 $this->cRefundRecvFeeReturnTime_u = 0; // uint8_t
			 $this->cRefundFinishTime_u = 0; // uint8_t
			 $this->cItemReturnSendTime_u = 0; // uint8_t
			 $this->cItemReturnWuliuInfo_u = 0; // uint8_t
			 $this->cItemReturnDesc_u = 0; // uint8_t
			 $this->cItemReturnTradeState_u = 0; // uint8_t
			 $this->cRefundReasonType_u = 0; // uint8_t
			 $this->cRefundReasonDesc_u = 0; // uint8_t
			 $this->cSellerAgreeRefundTime_u = 0; // uint8_t
			 $this->cSellerAgreeItemReturnTime_u = 0; // uint8_t
			 $this->cSellerRefuseRefundTime_u = 0; // uint8_t
			 $this->cSellerItemReturnAddress_u = 0; // uint8_t
			 $this->cSellerProcessRefundMsg_u = 0; // uint8_t
			 $this->cSellerProcessItemReturnMsg_u = 0; // uint8_t
			 $this->cRecvFeeId_u = 0; // uint8_t
			 $this->cDealCreateTime_u = 0; // uint8_t
			 $this->cTimeoutFlag_u = 0; // uint8_t
			 $this->cLastUpdateTime_u = 0; // uint8_t
			 $this->strBusinessRefundId = ""; // std::string
			 $this->cBusinessRefundId_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化版本号 类型为uint16_t
			$bs->pushUint32_t($this->dwControl); // 序列化退款单DB操作类型，0:Insert 1:Update 类型为uint32_t
			$bs->pushUint64_t($this->ddwRefundDetailId); // 序列化退款单ID 类型为uint64_t
			$bs->pushString($this->strDealId); // 序列化订单编号，格式:订单序号XXXXYYYY，如:101041051509351702 类型为std::string
			$bs->pushUint64_t($this->ddwDealId64); // 序列化订单单号，统一平台内部单号 类型为uint64_t
			$bs->pushUint64_t($this->ddwTradeId); // 序列化商品单ID 类型为uint64_t
			$bs->pushString($this->strItemSkuidList); // 序列化商品skuID列表 类型为std::string
			$bs->pushString($this->strItemTitleList); // 序列化商品标题列表 类型为std::string
			$bs->pushUint64_t($this->ddwBuyerId); // 序列化买家ID 类型为uint64_t
			$bs->pushString($this->strBuyerAccount); // 序列化买家帐号 类型为std::string
			$bs->pushString($this->strBuyerNickName); // 序列化买家昵称 类型为std::string
			$bs->pushUint64_t($this->ddwSellerId); // 序列化商家ID 类型为uint64_t
			$bs->pushString($this->strSellerTitle); // 序列化商家名称 类型为std::string
			$bs->pushUint8_t($this->cDealPayType); // 序列化退款订单支付方式 类型为uint8_t
			$bs->pushUint8_t($this->cRefundType); // 序列化退款单类型 类型为uint8_t
			$bs->pushUint32_t($this->dwItemBuyPrice); // 序列化订单商品成交单价 类型为uint32_t
			$bs->pushUint32_t($this->dwItemBuyNum); // 序列化订单商品购买件数，按商品单退款有效 类型为uint32_t
			$bs->pushUint32_t($this->dwRefundItemNum); // 序列化退款商品件数，按商品单退款有效 类型为uint32_t
			$bs->pushUint32_t($this->dwRefundDealTotalFee); // 序列化退款订单总金额 类型为uint32_t
			$bs->pushUint32_t($this->dwRefundItemTotalFee); // 序列化退款商品总金额 类型为uint32_t
			$bs->pushInt32_t($this->nRefundItemDiscountTotalFee); // 序列化退款商品优惠总金额 类型为int
			$bs->pushString($this->strRefundItemActiveDesc); // 序列化退款商品占优惠列表 类型为std::string
			$bs->pushInt32_t($this->nRefundItemAdjustTotalFee); // 序列化退款商品调价总金额 类型为int
			$bs->pushUint32_t($this->dwRefundShippingFee); // 序列化退款商品邮费总金额 类型为uint32_t
			$bs->pushUint32_t($this->dwRefundTotalFee); // 序列化退款单总金额 类型为uint32_t
			$bs->pushUint32_t($this->dwRefundSellerRecvFee); // 序列化退款单卖家收到金额 类型为uint32_t
			$bs->pushUint32_t($this->dwRefundBuyerRecvFee); // 序列化退款单买家收到金额 类型为uint32_t
			$bs->pushUint32_t($this->dwRefundState); // 序列化退款单状态, 参考UNPDealState_E中有关退款的各个状态值 类型为uint32_t
			$bs->pushUint32_t($this->dwPreRefundState); // 序列化退款单前一个状态 类型为uint32_t
			$bs->pushUint64_t($this->ddwRefundProperty); // 序列化退款单属性 类型为uint64_t
			$bs->pushUint32_t($this->dwRefundGenTime); // 序列化退款单生成时间 类型为uint32_t
			$bs->pushUint32_t($this->dwRefundApplyTime); // 序列化退款申请时间，买家 类型为uint32_t
			$bs->pushUint32_t($this->dwRefundRecvFeeTime); // 序列化退款打款完成时间 类型为uint32_t
			$bs->pushUint32_t($this->dwRefundRecvFeeReturnTime); // 序列化退款打款返回时间 类型为uint32_t
			$bs->pushUint32_t($this->dwRefundFinishTime); // 序列化退款完成时间，退款协议达成 类型为uint32_t
			$bs->pushUint32_t($this->dwItemReturnSendTime); // 序列化买家发送退货时间，有退货时有效 类型为uint32_t
			$bs->pushString($this->strItemReturnWuliuInfo); // 序列化买家发送退货物流信息，有退货时有效 类型为std::string
			$bs->pushString($this->strItemReturnDesc); // 序列化买家退货描述，有退货时有效 类型为std::string
			$bs->pushUint8_t($this->cItemReturnTradeState); // 序列化退货收货状态，有退货时有效，1，收到货，2，未收到货 类型为uint8_t
			$bs->pushUint8_t($this->cRefundReasonType); // 序列化退款原因类型 类型为uint8_t
			$bs->pushString($this->strRefundReasonDesc); // 序列化退款原因描述 类型为std::string
			$bs->pushUint32_t($this->dwSellerAgreeRefundTime); // 序列化卖家同意退款时间 类型为uint32_t
			$bs->pushUint32_t($this->dwSellerAgreeItemReturnTime); // 序列化卖家同意退货时间 类型为uint32_t
			$bs->pushUint32_t($this->dwSellerRefuseRefundTime); // 序列化卖家拒绝退款时间 类型为uint32_t
			$bs->pushString($this->strSellerItemReturnAddress); // 序列化卖家退货地址 类型为std::string
			$bs->pushString($this->strSellerProcessRefundMsg); // 序列化卖家处理退款附言 类型为std::string
			$bs->pushString($this->strSellerProcessItemReturnMsg); // 序列化卖家处理退货附言 类型为std::string
			$bs->pushUint64_t($this->ddwRecvFeeId); // 序列化退款单打款ID 类型为uint64_t
			$bs->pushUint32_t($this->dwDealCreateTime); // 序列化订单生成时间 类型为uint32_t
			$bs->pushUint32_t($this->dwTimeoutFlag); // 序列化超时标识 类型为uint32_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // 序列化记录更新时间 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cControl_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundDetailId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId64_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemSkuidList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemTitleList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerAccount_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerNickName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerTitle_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealPayType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemBuyPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemBuyNum_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundItemNum_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundDealTotalFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundItemTotalFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundItemDiscountTotalFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundItemActiveDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundItemAdjustTotalFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundShippingFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundTotalFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundSellerRecvFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundBuyerRecvFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPreRefundState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundProperty_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundGenTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundApplyTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundRecvFeeTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundRecvFeeReturnTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundFinishTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemReturnSendTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemReturnWuliuInfo_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemReturnDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemReturnTradeState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundReasonType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundReasonDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerAgreeRefundTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerAgreeItemReturnTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerRefuseRefundTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerItemReturnAddress_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerProcessRefundMsg_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerProcessItemReturnMsg_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvFeeId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealCreateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTimeoutFlag_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // 序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strBusinessRefundId); // 序列化业务退款单号 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cBusinessRefundId_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化版本号 类型为uint16_t
			$this->dwControl = $bs->popUint32_t(); // 反序列化退款单DB操作类型，0:Insert 1:Update 类型为uint32_t
			$this->ddwRefundDetailId = $bs->popUint64_t(); // 反序列化退款单ID 类型为uint64_t
			$this->strDealId = $bs->popString(); // 反序列化订单编号，格式:订单序号XXXXYYYY，如:101041051509351702 类型为std::string
			$this->ddwDealId64 = $bs->popUint64_t(); // 反序列化订单单号，统一平台内部单号 类型为uint64_t
			$this->ddwTradeId = $bs->popUint64_t(); // 反序列化商品单ID 类型为uint64_t
			$this->strItemSkuidList = $bs->popString(); // 反序列化商品skuID列表 类型为std::string
			$this->strItemTitleList = $bs->popString(); // 反序列化商品标题列表 类型为std::string
			$this->ddwBuyerId = $bs->popUint64_t(); // 反序列化买家ID 类型为uint64_t
			$this->strBuyerAccount = $bs->popString(); // 反序列化买家帐号 类型为std::string
			$this->strBuyerNickName = $bs->popString(); // 反序列化买家昵称 类型为std::string
			$this->ddwSellerId = $bs->popUint64_t(); // 反序列化商家ID 类型为uint64_t
			$this->strSellerTitle = $bs->popString(); // 反序列化商家名称 类型为std::string
			$this->cDealPayType = $bs->popUint8_t(); // 反序列化退款订单支付方式 类型为uint8_t
			$this->cRefundType = $bs->popUint8_t(); // 反序列化退款单类型 类型为uint8_t
			$this->dwItemBuyPrice = $bs->popUint32_t(); // 反序列化订单商品成交单价 类型为uint32_t
			$this->dwItemBuyNum = $bs->popUint32_t(); // 反序列化订单商品购买件数，按商品单退款有效 类型为uint32_t
			$this->dwRefundItemNum = $bs->popUint32_t(); // 反序列化退款商品件数，按商品单退款有效 类型为uint32_t
			$this->dwRefundDealTotalFee = $bs->popUint32_t(); // 反序列化退款订单总金额 类型为uint32_t
			$this->dwRefundItemTotalFee = $bs->popUint32_t(); // 反序列化退款商品总金额 类型为uint32_t
			$this->nRefundItemDiscountTotalFee = $bs->popInt32_t(); // 反序列化退款商品优惠总金额 类型为int
			$this->strRefundItemActiveDesc = $bs->popString(); // 反序列化退款商品占优惠列表 类型为std::string
			$this->nRefundItemAdjustTotalFee = $bs->popInt32_t(); // 反序列化退款商品调价总金额 类型为int
			$this->dwRefundShippingFee = $bs->popUint32_t(); // 反序列化退款商品邮费总金额 类型为uint32_t
			$this->dwRefundTotalFee = $bs->popUint32_t(); // 反序列化退款单总金额 类型为uint32_t
			$this->dwRefundSellerRecvFee = $bs->popUint32_t(); // 反序列化退款单卖家收到金额 类型为uint32_t
			$this->dwRefundBuyerRecvFee = $bs->popUint32_t(); // 反序列化退款单买家收到金额 类型为uint32_t
			$this->dwRefundState = $bs->popUint32_t(); // 反序列化退款单状态, 参考UNPDealState_E中有关退款的各个状态值 类型为uint32_t
			$this->dwPreRefundState = $bs->popUint32_t(); // 反序列化退款单前一个状态 类型为uint32_t
			$this->ddwRefundProperty = $bs->popUint64_t(); // 反序列化退款单属性 类型为uint64_t
			$this->dwRefundGenTime = $bs->popUint32_t(); // 反序列化退款单生成时间 类型为uint32_t
			$this->dwRefundApplyTime = $bs->popUint32_t(); // 反序列化退款申请时间，买家 类型为uint32_t
			$this->dwRefundRecvFeeTime = $bs->popUint32_t(); // 反序列化退款打款完成时间 类型为uint32_t
			$this->dwRefundRecvFeeReturnTime = $bs->popUint32_t(); // 反序列化退款打款返回时间 类型为uint32_t
			$this->dwRefundFinishTime = $bs->popUint32_t(); // 反序列化退款完成时间，退款协议达成 类型为uint32_t
			$this->dwItemReturnSendTime = $bs->popUint32_t(); // 反序列化买家发送退货时间，有退货时有效 类型为uint32_t
			$this->strItemReturnWuliuInfo = $bs->popString(); // 反序列化买家发送退货物流信息，有退货时有效 类型为std::string
			$this->strItemReturnDesc = $bs->popString(); // 反序列化买家退货描述，有退货时有效 类型为std::string
			$this->cItemReturnTradeState = $bs->popUint8_t(); // 反序列化退货收货状态，有退货时有效，1，收到货，2，未收到货 类型为uint8_t
			$this->cRefundReasonType = $bs->popUint8_t(); // 反序列化退款原因类型 类型为uint8_t
			$this->strRefundReasonDesc = $bs->popString(); // 反序列化退款原因描述 类型为std::string
			$this->dwSellerAgreeRefundTime = $bs->popUint32_t(); // 反序列化卖家同意退款时间 类型为uint32_t
			$this->dwSellerAgreeItemReturnTime = $bs->popUint32_t(); // 反序列化卖家同意退货时间 类型为uint32_t
			$this->dwSellerRefuseRefundTime = $bs->popUint32_t(); // 反序列化卖家拒绝退款时间 类型为uint32_t
			$this->strSellerItemReturnAddress = $bs->popString(); // 反序列化卖家退货地址 类型为std::string
			$this->strSellerProcessRefundMsg = $bs->popString(); // 反序列化卖家处理退款附言 类型为std::string
			$this->strSellerProcessItemReturnMsg = $bs->popString(); // 反序列化卖家处理退货附言 类型为std::string
			$this->ddwRecvFeeId = $bs->popUint64_t(); // 反序列化退款单打款ID 类型为uint64_t
			$this->dwDealCreateTime = $bs->popUint32_t(); // 反序列化订单生成时间 类型为uint32_t
			$this->dwTimeoutFlag = $bs->popUint32_t(); // 反序列化超时标识 类型为uint32_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // 反序列化记录更新时间 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cControl_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundDetailId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId64_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemSkuidList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemTitleList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerAccount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerNickName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerTitle_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealPayType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemBuyPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemBuyNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundItemNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundDealTotalFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundItemTotalFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundItemDiscountTotalFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundItemActiveDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundItemAdjustTotalFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundShippingFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundTotalFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundSellerRecvFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundBuyerRecvFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPreRefundState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundGenTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundApplyTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundRecvFeeTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundRecvFeeReturnTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundFinishTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemReturnSendTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemReturnWuliuInfo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemReturnDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemReturnTradeState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundReasonType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundReasonDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerAgreeRefundTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerAgreeItemReturnTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerRefuseRefundTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerItemReturnAddress_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerProcessRefundMsg_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerProcessItemReturnMsg_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvFeeId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealCreateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTimeoutFlag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$this->strBusinessRefundId = $bs->popString(); // 反序列化业务退款单号 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cBusinessRefundId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.ecc.deal.idl.UserQueryDealReq.java

if (!class_exists('DealQueryBo')) {
class DealQueryBo
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 订单id
		 *
		 * 版本 >= 0
		 */
		var $ddwDealId; //uint64_t

		/**
		 * 子单id
		 *
		 * 版本 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * 卖家id
		 *
		 * 版本 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * 买家id
		 *
		 * 版本 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * 订单编码
		 *
		 * 版本 >= 0
		 */
		var $strDealCode; //std::string

		/**
		 * 子单编码
		 *
		 * 版本 >= 0
		 */
		var $strTradeCode; //std::string

		/**
		 * 业务订单号
		 *
		 * 版本 >= 0
		 */
		var $strBusinessDealId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBusinessDealId_u; //uint8_t

		/**
		 * 交易单id
		 *
		 * 版本 >= 1
		 */
		var $ddwBdealId; //uint64_t

		/**
		 * 交易单编码
		 *
		 * 版本 >= 1
		 */
		var $strBdealCode; //std::string

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cBdealId_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cBdealCode_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 1; // uint16_t
			 $this->ddwDealId = 0; // uint64_t
			 $this->ddwTradeId = 0; // uint64_t
			 $this->ddwSellerId = 0; // uint64_t
			 $this->ddwBuyerId = 0; // uint64_t
			 $this->strDealCode = ""; // std::string
			 $this->strTradeCode = ""; // std::string
			 $this->strBusinessDealId = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cDealId_u = 0; // uint8_t
			 $this->cTradeId_u = 0; // uint8_t
			 $this->cSellerId_u = 0; // uint8_t
			 $this->cBuyerId_u = 0; // uint8_t
			 $this->cDealCode_u = 0; // uint8_t
			 $this->cTradeCode_u = 0; // uint8_t
			 $this->cBusinessDealId_u = 0; // uint8_t
			 $this->ddwBdealId = 0; // uint64_t
			 $this->strBdealCode = ""; // std::string
			 $this->cBdealId_u = 0; // uint8_t
			 $this->cBdealCode_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化版本号 类型为uint16_t
			$bs->pushUint64_t($this->ddwDealId); // 序列化订单id 类型为uint64_t
			$bs->pushUint64_t($this->ddwTradeId); // 序列化子单id 类型为uint64_t
			$bs->pushUint64_t($this->ddwSellerId); // 序列化卖家id 类型为uint64_t
			$bs->pushUint64_t($this->ddwBuyerId); // 序列化买家id 类型为uint64_t
			$bs->pushString($this->strDealCode); // 序列化订单编码 类型为std::string
			$bs->pushString($this->strTradeCode); // 序列化子单编码 类型为std::string
			$bs->pushString($this->strBusinessDealId); // 序列化业务订单号 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBusinessDealId_u); // 序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushUint64_t($this->ddwBdealId); // 序列化交易单id 类型为uint64_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strBdealCode); // 序列化交易单编码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cBdealId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cBdealCode_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化版本号 类型为uint16_t
			$this->ddwDealId = $bs->popUint64_t(); // 反序列化订单id 类型为uint64_t
			$this->ddwTradeId = $bs->popUint64_t(); // 反序列化子单id 类型为uint64_t
			$this->ddwSellerId = $bs->popUint64_t(); // 反序列化卖家id 类型为uint64_t
			$this->ddwBuyerId = $bs->popUint64_t(); // 反序列化买家id 类型为uint64_t
			$this->strDealCode = $bs->popString(); // 反序列化订单编码 类型为std::string
			$this->strTradeCode = $bs->popString(); // 反序列化子单编码 类型为std::string
			$this->strBusinessDealId = $bs->popString(); // 反序列化业务订单号 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBusinessDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$this->ddwBdealId = $bs->popUint64_t(); // 反序列化交易单id 类型为uint64_t
			}
			if(  $this->wVersion >= 1 ){
				$this->strBdealCode = $bs->popString(); // 反序列化交易单编码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cBdealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cBdealCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.ecc.deal.idl.UserQueryBdealResp.java

if (!class_exists('BdealPo')) {
class BdealPo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 交易单号，买卖家一次交易行为描述
		 *
		 * 版本 >= 0
		 */
		var $ddwBdealId; //uint64_t

		/**
		 * 交易单编号，即字符串格式的交易单号
		 *
		 * 版本 >= 0
		 */
		var $strBdealCode; //std::string

		/**
		 * 业务订单编号，第三方托管订单
		 *
		 * 版本 >= 0
		 */
		var $strBusinessDealId; //std::string

		/**
		 * 买家ID
		 *
		 * 版本 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * 买家帐号
		 *
		 * 版本 >= 0
		 */
		var $strBuyerAccount; //std::string

		/**
		 * 买家姓名
		 *
		 * 版本 >= 0
		 */
		var $strBuyerNickName; //std::string

		/**
		 * 买家昵称
		 *
		 * 版本 >= 0
		 */
		var $strBuyerNick; //std::string

		/**
		 * 商家ID
		 *
		 * 版本 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * 商家真实名称
		 *
		 * 版本 >= 0
		 */
		var $strSellerTitle; //std::string

		/**
		 * 卖家昵称
		 *
		 * 版本 >= 0
		 */
		var $strSellerNick; //std::string

		/**
		 * 业务ID: 1:拍拍业务员；2:易迅业务
		 *
		 * 版本 >= 0
		 */
		var $dwBusinessId; //uint32_t

		/**
		 * 交易单类型：1：购物车；2：一口价；3：抢购；4：拍卖；5：预售
		 *
		 * 版本 >= 0
		 */
		var $cBdealType; //uint8_t

		/**
		 * 下单渠道：1：业务主站；2：移动app；3：移动wap
		 *
		 * 版本 >= 0
		 */
		var $dwBdealSource; //uint32_t

		/**
		 * 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款
		 *
		 * 版本 >= 0
		 */
		var $cBdealPayType; //uint8_t

		/**
		 * 交易单状态
		 *
		 * 版本 >= 0
		 */
		var $dwBdealState; //uint32_t

		/**
		 * 交易单前一个状态
		 *
		 * 版本 >= 0
		 */
		var $dwPreBdealState; //uint32_t

		/**
		 * 商品标题列表
		 *
		 * 版本 >= 0
		 */
		var $strItemTitleList; //std::string

		/**
		 * 商品skuID列表
		 *
		 * 版本 >= 0
		 */
		var $strItemSkuidList; //std::string

		/**
		 * 交易单总金额，只记录下单时的金额，后续改价不会变，不能作为计算价格依据
		 *
		 * 版本 >= 0
		 */
		var $dwBdealTotalFee; //uint32_t

		/**
		 * 实付总金额，交易单的真实支付金额，计算价格的依据
		 *
		 * 版本 >= 0
		 */
		var $dwBdealPayment; //uint32_t

		/**
		 * refer
		 *
		 * 版本 >= 0
		 */
		var $strBdealRefer; //std::string

		/**
		 * 下单IP
		 *
		 * 版本 >= 0
		 */
		var $strBdealIp; //std::string

		/**
		 * 促销信息描述
		 *
		 * 版本 >= 0
		 */
		var $strPromotionDesc; //std::string

		/**
		 * 交易单生成时间
		 *
		 * 版本 >= 0
		 */
		var $dwBdealGenTime; //uint32_t

		/**
		 * 交易单付款时间
		 *
		 * 版本 >= 0
		 */
		var $dwBdealPayTime; //uint32_t

		/**
		 * 交易单结束时间
		 *
		 * 版本 >= 0
		 */
		var $dwBdealEndTime; //uint32_t

		/**
		 * 收货人
		 *
		 * 版本 >= 0
		 */
		var $strRecvName; //std::string

		/**
		 * 地区编码
		 *
		 * 版本 >= 0
		 */
		var $dwRecvRegionCode; //uint32_t

		/**
		 * 扩展地区编码
		 *
		 * 版本 >= 0
		 */
		var $strRecvRegionCodeExt; //std::string

		/**
		 * 地址
		 *
		 * 版本 >= 0
		 */
		var $strRecvAddress; //std::string

		/**
		 * 邮编
		 *
		 * 版本 >= 0
		 */
		var $strRecvPostCode; //std::string

		/**
		 * 电话
		 *
		 * 版本 >= 0
		 */
		var $strRecvPhone; //std::string

		/**
		 * 手机
		 *
		 * 版本 >= 0
		 */
		var $ddwRecvMobile; //uint64_t

		/**
		 * 交易单标记
		 *
		 * 版本 >= 0
		 */
		var $dwBdealFlag; //uint32_t

		/**
		 * 订单有效标记
		 *
		 * 版本 >= 0
		 */
		var $dwDelFlag; //uint32_t

		/**
		 * 可见标识
		 *
		 * 版本 >= 0
		 */
		var $dwVisibleState; //uint32_t

		/**
		 * 交易单摘要
		 *
		 * 版本 >= 0
		 */
		var $strBdealDigest; //std::string

		/**
		 * 最后更新时间
		 *
		 * 版本 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * 订单列表
		 *
		 * 版本 >= 0
		 */
		var $oDealInfoList; //ecc::deal::po::CDealPoList

		/**
		 * 支付信息表
		 *
		 * 版本 >= 0
		 */
		var $oPayInfoList; //ecc::deal::po::CPayInfoPoList

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBdealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBdealCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBusinessDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerAccount_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerNickName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerNick_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerTitle_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerNick_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBusinessId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBdealType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBdealSource_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBdealPayType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBdealState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPreBdealState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemTitleList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemSkuidList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBdealTotalFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBdealPayment_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBdealRefer_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBdealIp_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPromotionDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBdealGenTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBdealPayTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBdealEndTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvRegionCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvRegionCodeExt_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvAddress_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvPostCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvPhone_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvMobile_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBdealFlag_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDelFlag_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cVisibleState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBdealDigest_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealInfoList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayInfoList_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->ddwBdealId = 0; // uint64_t
			 $this->strBdealCode = ""; // std::string
			 $this->strBusinessDealId = ""; // std::string
			 $this->ddwBuyerId = 0; // uint64_t
			 $this->strBuyerAccount = ""; // std::string
			 $this->strBuyerNickName = ""; // std::string
			 $this->strBuyerNick = ""; // std::string
			 $this->ddwSellerId = 0; // uint64_t
			 $this->strSellerTitle = ""; // std::string
			 $this->strSellerNick = ""; // std::string
			 $this->dwBusinessId = 0; // uint32_t
			 $this->cBdealType = 0; // uint8_t
			 $this->dwBdealSource = 0; // uint32_t
			 $this->cBdealPayType = 0; // uint8_t
			 $this->dwBdealState = 0; // uint32_t
			 $this->dwPreBdealState = 0; // uint32_t
			 $this->strItemTitleList = ""; // std::string
			 $this->strItemSkuidList = ""; // std::string
			 $this->dwBdealTotalFee = 0; // uint32_t
			 $this->dwBdealPayment = 0; // uint32_t
			 $this->strBdealRefer = ""; // std::string
			 $this->strBdealIp = ""; // std::string
			 $this->strPromotionDesc = ""; // std::string
			 $this->dwBdealGenTime = 0; // uint32_t
			 $this->dwBdealPayTime = 0; // uint32_t
			 $this->dwBdealEndTime = 0; // uint32_t
			 $this->strRecvName = ""; // std::string
			 $this->dwRecvRegionCode = 0; // uint32_t
			 $this->strRecvRegionCodeExt = ""; // std::string
			 $this->strRecvAddress = ""; // std::string
			 $this->strRecvPostCode = ""; // std::string
			 $this->strRecvPhone = ""; // std::string
			 $this->ddwRecvMobile = 0; // uint64_t
			 $this->dwBdealFlag = 0; // uint32_t
			 $this->dwDelFlag = 0; // uint32_t
			 $this->dwVisibleState = 0; // uint32_t
			 $this->strBdealDigest = ""; // std::string
			 $this->dwLastUpdateTime = 0; // uint32_t
			 $this->oDealInfoList = new DealPoList(); // ecc::deal::po::CDealPoList
			 $this->oPayInfoList = new PayInfoPoList(); // ecc::deal::po::CPayInfoPoList
			 $this->cVersion_u = 0; // uint8_t
			 $this->cBdealId_u = 0; // uint8_t
			 $this->cBdealCode_u = 0; // uint8_t
			 $this->cBusinessDealId_u = 0; // uint8_t
			 $this->cBuyerId_u = 0; // uint8_t
			 $this->cBuyerAccount_u = 0; // uint8_t
			 $this->cBuyerNickName_u = 0; // uint8_t
			 $this->cBuyerNick_u = 0; // uint8_t
			 $this->cSellerId_u = 0; // uint8_t
			 $this->cSellerTitle_u = 0; // uint8_t
			 $this->cSellerNick_u = 0; // uint8_t
			 $this->cBusinessId_u = 0; // uint8_t
			 $this->cBdealType_u = 0; // uint8_t
			 $this->cBdealSource_u = 0; // uint8_t
			 $this->cBdealPayType_u = 0; // uint8_t
			 $this->cBdealState_u = 0; // uint8_t
			 $this->cPreBdealState_u = 0; // uint8_t
			 $this->cItemTitleList_u = 0; // uint8_t
			 $this->cItemSkuidList_u = 0; // uint8_t
			 $this->cBdealTotalFee_u = 0; // uint8_t
			 $this->cBdealPayment_u = 0; // uint8_t
			 $this->cBdealRefer_u = 0; // uint8_t
			 $this->cBdealIp_u = 0; // uint8_t
			 $this->cPromotionDesc_u = 0; // uint8_t
			 $this->cBdealGenTime_u = 0; // uint8_t
			 $this->cBdealPayTime_u = 0; // uint8_t
			 $this->cBdealEndTime_u = 0; // uint8_t
			 $this->cRecvName_u = 0; // uint8_t
			 $this->cRecvRegionCode_u = 0; // uint8_t
			 $this->cRecvRegionCodeExt_u = 0; // uint8_t
			 $this->cRecvAddress_u = 0; // uint8_t
			 $this->cRecvPostCode_u = 0; // uint8_t
			 $this->cRecvPhone_u = 0; // uint8_t
			 $this->cRecvMobile_u = 0; // uint8_t
			 $this->cBdealFlag_u = 0; // uint8_t
			 $this->cDelFlag_u = 0; // uint8_t
			 $this->cVisibleState_u = 0; // uint8_t
			 $this->cBdealDigest_u = 0; // uint8_t
			 $this->cLastUpdateTime_u = 0; // uint8_t
			 $this->cDealInfoList_u = 0; // uint8_t
			 $this->cPayInfoList_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushUint64_t($this->ddwBdealId); // 序列化交易单号，买卖家一次交易行为描述 类型为uint64_t
			$bs->pushString($this->strBdealCode); // 序列化交易单编号，即字符串格式的交易单号 类型为std::string
			$bs->pushString($this->strBusinessDealId); // 序列化业务订单编号，第三方托管订单 类型为std::string
			$bs->pushUint64_t($this->ddwBuyerId); // 序列化买家ID 类型为uint64_t
			$bs->pushString($this->strBuyerAccount); // 序列化买家帐号 类型为std::string
			$bs->pushString($this->strBuyerNickName); // 序列化买家姓名 类型为std::string
			$bs->pushString($this->strBuyerNick); // 序列化买家昵称 类型为std::string
			$bs->pushUint64_t($this->ddwSellerId); // 序列化商家ID 类型为uint64_t
			$bs->pushString($this->strSellerTitle); // 序列化商家真实名称 类型为std::string
			$bs->pushString($this->strSellerNick); // 序列化卖家昵称 类型为std::string
			$bs->pushUint32_t($this->dwBusinessId); // 序列化业务ID: 1:拍拍业务员；2:易迅业务 类型为uint32_t
			$bs->pushUint8_t($this->cBdealType); // 序列化交易单类型：1：购物车；2：一口价；3：抢购；4：拍卖；5：预售 类型为uint8_t
			$bs->pushUint32_t($this->dwBdealSource); // 序列化下单渠道：1：业务主站；2：移动app；3：移动wap 类型为uint32_t
			$bs->pushUint8_t($this->cBdealPayType); // 序列化支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款 类型为uint8_t
			$bs->pushUint32_t($this->dwBdealState); // 序列化交易单状态 类型为uint32_t
			$bs->pushUint32_t($this->dwPreBdealState); // 序列化交易单前一个状态 类型为uint32_t
			$bs->pushString($this->strItemTitleList); // 序列化商品标题列表 类型为std::string
			$bs->pushString($this->strItemSkuidList); // 序列化商品skuID列表 类型为std::string
			$bs->pushUint32_t($this->dwBdealTotalFee); // 序列化交易单总金额，只记录下单时的金额，后续改价不会变，不能作为计算价格依据 类型为uint32_t
			$bs->pushUint32_t($this->dwBdealPayment); // 序列化实付总金额，交易单的真实支付金额，计算价格的依据 类型为uint32_t
			$bs->pushString($this->strBdealRefer); // 序列化refer 类型为std::string
			$bs->pushString($this->strBdealIp); // 序列化下单IP 类型为std::string
			$bs->pushString($this->strPromotionDesc); // 序列化促销信息描述 类型为std::string
			$bs->pushUint32_t($this->dwBdealGenTime); // 序列化交易单生成时间 类型为uint32_t
			$bs->pushUint32_t($this->dwBdealPayTime); // 序列化交易单付款时间 类型为uint32_t
			$bs->pushUint32_t($this->dwBdealEndTime); // 序列化交易单结束时间 类型为uint32_t
			$bs->pushString($this->strRecvName); // 序列化收货人 类型为std::string
			$bs->pushUint32_t($this->dwRecvRegionCode); // 序列化地区编码 类型为uint32_t
			$bs->pushString($this->strRecvRegionCodeExt); // 序列化扩展地区编码 类型为std::string
			$bs->pushString($this->strRecvAddress); // 序列化地址 类型为std::string
			$bs->pushString($this->strRecvPostCode); // 序列化邮编 类型为std::string
			$bs->pushString($this->strRecvPhone); // 序列化电话 类型为std::string
			$bs->pushUint64_t($this->ddwRecvMobile); // 序列化手机 类型为uint64_t
			$bs->pushUint32_t($this->dwBdealFlag); // 序列化交易单标记 类型为uint32_t
			$bs->pushUint32_t($this->dwDelFlag); // 序列化订单有效标记 类型为uint32_t
			$bs->pushUint32_t($this->dwVisibleState); // 序列化可见标识 类型为uint32_t
			$bs->pushString($this->strBdealDigest); // 序列化交易单摘要 类型为std::string
			$bs->pushUint32_t($this->dwLastUpdateTime); // 序列化最后更新时间 类型为uint32_t
			$bs->pushObject($this->oDealInfoList,'DealPoList'); // 序列化订单列表 类型为ecc::deal::po::CDealPoList
			$bs->pushObject($this->oPayInfoList,'PayInfoPoList'); // 序列化支付信息表 类型为ecc::deal::po::CPayInfoPoList
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBdealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBdealCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBusinessDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerAccount_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerNickName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerNick_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerTitle_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerNick_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBusinessId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBdealType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBdealSource_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBdealPayType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBdealState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPreBdealState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemTitleList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemSkuidList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBdealTotalFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBdealPayment_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBdealRefer_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBdealIp_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPromotionDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBdealGenTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBdealPayTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBdealEndTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvRegionCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvRegionCodeExt_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvAddress_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvPostCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvPhone_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvMobile_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBdealFlag_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDelFlag_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cVisibleState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBdealDigest_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealInfoList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayInfoList_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->ddwBdealId = $bs->popUint64_t(); // 反序列化交易单号，买卖家一次交易行为描述 类型为uint64_t
			$this->strBdealCode = $bs->popString(); // 反序列化交易单编号，即字符串格式的交易单号 类型为std::string
			$this->strBusinessDealId = $bs->popString(); // 反序列化业务订单编号，第三方托管订单 类型为std::string
			$this->ddwBuyerId = $bs->popUint64_t(); // 反序列化买家ID 类型为uint64_t
			$this->strBuyerAccount = $bs->popString(); // 反序列化买家帐号 类型为std::string
			$this->strBuyerNickName = $bs->popString(); // 反序列化买家姓名 类型为std::string
			$this->strBuyerNick = $bs->popString(); // 反序列化买家昵称 类型为std::string
			$this->ddwSellerId = $bs->popUint64_t(); // 反序列化商家ID 类型为uint64_t
			$this->strSellerTitle = $bs->popString(); // 反序列化商家真实名称 类型为std::string
			$this->strSellerNick = $bs->popString(); // 反序列化卖家昵称 类型为std::string
			$this->dwBusinessId = $bs->popUint32_t(); // 反序列化业务ID: 1:拍拍业务员；2:易迅业务 类型为uint32_t
			$this->cBdealType = $bs->popUint8_t(); // 反序列化交易单类型：1：购物车；2：一口价；3：抢购；4：拍卖；5：预售 类型为uint8_t
			$this->dwBdealSource = $bs->popUint32_t(); // 反序列化下单渠道：1：业务主站；2：移动app；3：移动wap 类型为uint32_t
			$this->cBdealPayType = $bs->popUint8_t(); // 反序列化支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款 类型为uint8_t
			$this->dwBdealState = $bs->popUint32_t(); // 反序列化交易单状态 类型为uint32_t
			$this->dwPreBdealState = $bs->popUint32_t(); // 反序列化交易单前一个状态 类型为uint32_t
			$this->strItemTitleList = $bs->popString(); // 反序列化商品标题列表 类型为std::string
			$this->strItemSkuidList = $bs->popString(); // 反序列化商品skuID列表 类型为std::string
			$this->dwBdealTotalFee = $bs->popUint32_t(); // 反序列化交易单总金额，只记录下单时的金额，后续改价不会变，不能作为计算价格依据 类型为uint32_t
			$this->dwBdealPayment = $bs->popUint32_t(); // 反序列化实付总金额，交易单的真实支付金额，计算价格的依据 类型为uint32_t
			$this->strBdealRefer = $bs->popString(); // 反序列化refer 类型为std::string
			$this->strBdealIp = $bs->popString(); // 反序列化下单IP 类型为std::string
			$this->strPromotionDesc = $bs->popString(); // 反序列化促销信息描述 类型为std::string
			$this->dwBdealGenTime = $bs->popUint32_t(); // 反序列化交易单生成时间 类型为uint32_t
			$this->dwBdealPayTime = $bs->popUint32_t(); // 反序列化交易单付款时间 类型为uint32_t
			$this->dwBdealEndTime = $bs->popUint32_t(); // 反序列化交易单结束时间 类型为uint32_t
			$this->strRecvName = $bs->popString(); // 反序列化收货人 类型为std::string
			$this->dwRecvRegionCode = $bs->popUint32_t(); // 反序列化地区编码 类型为uint32_t
			$this->strRecvRegionCodeExt = $bs->popString(); // 反序列化扩展地区编码 类型为std::string
			$this->strRecvAddress = $bs->popString(); // 反序列化地址 类型为std::string
			$this->strRecvPostCode = $bs->popString(); // 反序列化邮编 类型为std::string
			$this->strRecvPhone = $bs->popString(); // 反序列化电话 类型为std::string
			$this->ddwRecvMobile = $bs->popUint64_t(); // 反序列化手机 类型为uint64_t
			$this->dwBdealFlag = $bs->popUint32_t(); // 反序列化交易单标记 类型为uint32_t
			$this->dwDelFlag = $bs->popUint32_t(); // 反序列化订单有效标记 类型为uint32_t
			$this->dwVisibleState = $bs->popUint32_t(); // 反序列化可见标识 类型为uint32_t
			$this->strBdealDigest = $bs->popString(); // 反序列化交易单摘要 类型为std::string
			$this->dwLastUpdateTime = $bs->popUint32_t(); // 反序列化最后更新时间 类型为uint32_t
			$this->oDealInfoList = $bs->popObject('DealPoList'); // 反序列化订单列表 类型为ecc::deal::po::CDealPoList
			$this->oPayInfoList = $bs->popObject('PayInfoPoList'); // 反序列化支付信息表 类型为ecc::deal::po::CPayInfoPoList
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBdealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBdealCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBusinessDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerAccount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerNickName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerNick_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerTitle_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerNick_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBusinessId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBdealType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBdealSource_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBdealPayType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBdealState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPreBdealState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemTitleList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemSkuidList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBdealTotalFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBdealPayment_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBdealRefer_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBdealIp_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPromotionDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBdealGenTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBdealPayTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBdealEndTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvRegionCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvRegionCodeExt_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvAddress_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvPostCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvPhone_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvMobile_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBdealFlag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDelFlag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cVisibleState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBdealDigest_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.ecc.deal.idl.BdealPo.java

if (!class_exists('DealPoList')) {
class DealPoList
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 订单列表
		 *
		 * 版本 >= 0
		 */
		var $vecDealInfoList; //std::vector<ecc::deal::po::CDealPo> 

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealInfoList_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->vecDealInfoList = new stl_vector('DealPo'); // std::vector<ecc::deal::po::CDealPo> 
			 $this->cVersion_u = 0; // uint8_t
			 $this->cDealInfoList_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushObject($this->vecDealInfoList,'stl_vector'); // 序列化订单列表 类型为std::vector<ecc::deal::po::CDealPo> 
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealInfoList_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->vecDealInfoList = $bs->popObject('stl_vector<DealPo>'); // 反序列化订单列表 类型为std::vector<ecc::deal::po::CDealPo> 
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.ecc.deal.idl.SyncRefundReq.java

if (!class_exists('EventParamsBaseBo')) {
class EventParamsBaseBo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 买家id
		 *
		 * 版本 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * 卖家id
		 *
		 * 版本 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * 事件id,订单系统分配
		 *
		 * 版本 >= 0
		 */
		var $dwEventId; //uint32_t

		/**
		 * 操作者角色
		 *
		 * 版本 >= 0
		 */
		var $dwOperatorRole; //uint32_t

		/**
		 * 事件来源，业务必填，请填写调用服务名或文件名
		 *
		 * 版本 >= 0
		 */
		var $strEventSource; //std::string

		/**
		 * 订单id
		 *
		 * 版本 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * 子单id
		 *
		 * 版本 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * 来源ip
		 *
		 * 版本 >= 0
		 */
		var $strClientIp; //std::string

		/**
		 * 机器码
		 *
		 * 版本 >= 0
		 */
		var $strMachineKey; //std::string

		/**
		 * 操作人
		 *
		 * 版本 >= 0
		 */
		var $strOperatorName; //std::string

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
		var $cBuyerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cEventId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperatorRole_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cEventSource_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cClientIp_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cMachineKey_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperatorName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * 交易单号
		 *
		 * 版本 >= 1
		 */
		var $strBdealId; //std::string

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cBdealId_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 1; // uint16_t
			 $this->ddwBuyerId = 0; // uint64_t
			 $this->ddwSellerId = 0; // uint64_t
			 $this->dwEventId = 0; // uint32_t
			 $this->dwOperatorRole = 0; // uint32_t
			 $this->strEventSource = ""; // std::string
			 $this->strDealId = ""; // std::string
			 $this->ddwTradeId = 0; // uint64_t
			 $this->strClientIp = ""; // std::string
			 $this->strMachineKey = ""; // std::string
			 $this->strOperatorName = ""; // std::string
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cBuyerId_u = 0; // uint8_t
			 $this->cSellerId_u = 0; // uint8_t
			 $this->cEventId_u = 0; // uint8_t
			 $this->cOperatorRole_u = 0; // uint8_t
			 $this->cEventSource_u = 0; // uint8_t
			 $this->cDealId_u = 0; // uint8_t
			 $this->cTradeId_u = 0; // uint8_t
			 $this->cClientIp_u = 0; // uint8_t
			 $this->cMachineKey_u = 0; // uint8_t
			 $this->cOperatorName_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
			 $this->strBdealId = ""; // std::string
			 $this->cBdealId_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushUint64_t($this->ddwBuyerId); // 序列化买家id 类型为uint64_t
			$bs->pushUint64_t($this->ddwSellerId); // 序列化卖家id 类型为uint64_t
			$bs->pushUint32_t($this->dwEventId); // 序列化事件id,订单系统分配 类型为uint32_t
			$bs->pushUint32_t($this->dwOperatorRole); // 序列化操作者角色 类型为uint32_t
			$bs->pushString($this->strEventSource); // 序列化事件来源，业务必填，请填写调用服务名或文件名 类型为std::string
			$bs->pushString($this->strDealId); // 序列化订单id 类型为std::string
			$bs->pushUint64_t($this->ddwTradeId); // 序列化子单id 类型为uint64_t
			$bs->pushString($this->strClientIp); // 序列化来源ip 类型为std::string
			$bs->pushString($this->strMachineKey); // 序列化机器码 类型为std::string
			$bs->pushString($this->strOperatorName); // 序列化操作人 类型为std::string
			$bs->pushString($this->strReserve); // 序列化保留字段 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cEventId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperatorRole_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cEventSource_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cClientIp_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cMachineKey_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperatorName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strBdealId); // 序列化交易单号 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cBdealId_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->ddwBuyerId = $bs->popUint64_t(); // 反序列化买家id 类型为uint64_t
			$this->ddwSellerId = $bs->popUint64_t(); // 反序列化卖家id 类型为uint64_t
			$this->dwEventId = $bs->popUint32_t(); // 反序列化事件id,订单系统分配 类型为uint32_t
			$this->dwOperatorRole = $bs->popUint32_t(); // 反序列化操作者角色 类型为uint32_t
			$this->strEventSource = $bs->popString(); // 反序列化事件来源，业务必填，请填写调用服务名或文件名 类型为std::string
			$this->strDealId = $bs->popString(); // 反序列化订单id 类型为std::string
			$this->ddwTradeId = $bs->popUint64_t(); // 反序列化子单id 类型为uint64_t
			$this->strClientIp = $bs->popString(); // 反序列化来源ip 类型为std::string
			$this->strMachineKey = $bs->popString(); // 反序列化机器码 类型为std::string
			$this->strOperatorName = $bs->popString(); // 反序列化操作人 类型为std::string
			$this->strReserve = $bs->popString(); // 反序列化保留字段 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cEventId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperatorRole_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cEventSource_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cClientIp_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cMachineKey_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperatorName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserve_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$this->strBdealId = $bs->popString(); // 反序列化交易单号 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cBdealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.ecc.deal.idl.SyncRefundReq.java

if (!class_exists('EventParamsCorpSyncRefundBo')) {
class EventParamsCorpSyncRefundBo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 订单单id
		 *
		 * 版本 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * 子单id
		 *
		 * 版本 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * 商品skuid, 如果没有子单（商品）维度信息，可不填
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 操作时间
		 *
		 * 版本 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * 退款状态, 1-开始;2-客服已审核;3-已退款;4-财务已审核;5-财务驳回初始;6-作废
		 *
		 * 版本 >= 0
		 */
		var $dwRefundState; //uint32_t

		/**
		 * 描述
		 *
		 * 版本 >= 0
		 */
		var $strDesc; //std::string

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
		var $cDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * 业务退款单id
		 *
		 * 版本 >= 1
		 */
		var $strBusinessRefundId; //std::string

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cBusinessRefundId_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 1; // uint16_t
			 $this->strDealId = ""; // std::string
			 $this->ddwTradeId = 0; // uint64_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->dwOperateTime = 0; // uint32_t
			 $this->dwRefundState = 0; // uint32_t
			 $this->strDesc = ""; // std::string
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cDealId_u = 0; // uint8_t
			 $this->cTradeId_u = 0; // uint8_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->cOperateTime_u = 0; // uint8_t
			 $this->cRefundState_u = 0; // uint8_t
			 $this->cDesc_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
			 $this->strBusinessRefundId = ""; // std::string
			 $this->cBusinessRefundId_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushString($this->strDealId); // 序列化订单单id 类型为std::string
			$bs->pushUint64_t($this->ddwTradeId); // 序列化子单id 类型为uint64_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化商品skuid, 如果没有子单（商品）维度信息，可不填 类型为uint64_t
			$bs->pushUint32_t($this->dwOperateTime); // 序列化操作时间 类型为uint32_t
			$bs->pushUint32_t($this->dwRefundState); // 序列化退款状态, 1-开始;2-客服已审核;3-已退款;4-财务已审核;5-财务驳回初始;6-作废 类型为uint32_t
			$bs->pushString($this->strDesc); // 序列化描述 类型为std::string
			$bs->pushString($this->strReserve); // 序列化保留字段 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strBusinessRefundId); // 序列化业务退款单id 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cBusinessRefundId_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->strDealId = $bs->popString(); // 反序列化订单单id 类型为std::string
			$this->ddwTradeId = $bs->popUint64_t(); // 反序列化子单id 类型为uint64_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化商品skuid, 如果没有子单（商品）维度信息，可不填 类型为uint64_t
			$this->dwOperateTime = $bs->popUint32_t(); // 反序列化操作时间 类型为uint32_t
			$this->dwRefundState = $bs->popUint32_t(); // 反序列化退款状态, 1-开始;2-客服已审核;3-已退款;4-财务已审核;5-财务驳回初始;6-作废 类型为uint32_t
			$this->strDesc = $bs->popString(); // 反序列化描述 类型为std::string
			$this->strReserve = $bs->popString(); // 反序列化保留字段 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserve_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$this->strBusinessRefundId = $bs->popString(); // 反序列化业务退款单id 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cBusinessRefundId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.ecc.deal.idl.SyncPickingReq.java

if (!class_exists('EventParamsPickBo')) {
class EventParamsPickBo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 操作时间
		 *
		 * 版本 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * 拣货状态: 1-开始;2-完成;3-失败;
		 *
		 * 版本 >= 0
		 */
		var $dwPickState; //uint32_t

		/**
		 * 描述
		 *
		 * 版本 >= 0
		 */
		var $strPickDesc; //std::string

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
		var $cOperateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPickState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPickDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->dwOperateTime = 0; // uint32_t
			 $this->dwPickState = 0; // uint32_t
			 $this->strPickDesc = ""; // std::string
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cOperateTime_u = 0; // uint8_t
			 $this->cPickState_u = 0; // uint8_t
			 $this->cPickDesc_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushUint32_t($this->dwOperateTime); // 序列化操作时间 类型为uint32_t
			$bs->pushUint32_t($this->dwPickState); // 序列化拣货状态: 1-开始;2-完成;3-失败; 类型为uint32_t
			$bs->pushString($this->strPickDesc); // 序列化描述 类型为std::string
			$bs->pushString($this->strReserve); // 序列化保留字段 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPickState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPickDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->dwOperateTime = $bs->popUint32_t(); // 反序列化操作时间 类型为uint32_t
			$this->dwPickState = $bs->popUint32_t(); // 反序列化拣货状态: 1-开始;2-完成;3-失败; 类型为uint32_t
			$this->strPickDesc = $bs->popString(); // 反序列化描述 类型为std::string
			$this->strReserve = $bs->popString(); // 反序列化保留字段 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPickState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPickDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.ecc.deal.idl.SyncDealActionReq.java

if (!class_exists('SyncDealActionBo')) {
class SyncDealActionBo
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702
		 *
		 * 版本 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * 商品子单ID，商品子单维度操作时填写，订单维度操作可不填
		 *
		 * 版本 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * 操作时间
		 *
		 * 版本 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * 操作时的订单状态
		 *
		 * 版本 >= 0
		 */
		var $dwCurState; //uint32_t

		/**
		 * 操作类型: 101-物流信息同步;102-签收;103-拒签;...更多请业务方补充
		 *
		 * 版本 >= 0
		 */
		var $wOperationType; //uint16_t

		/**
		 * 操作者，请和EventParamsBaseBo中的OperatorNmae填写相同
		 *
		 * 版本 >= 0
		 */
		var $strOperatorName; //std::string

		/**
		 * 操作者类别:1-买家;2-卖家(客服);3-系统;4-BOSS;5-支付系统;6-API;
		 *
		 * 版本 >= 0
		 */
		var $wOperatorType; //uint16_t

		/**
		 * 操作描述是否前台可见，配合OperationDesc使用，取值:0-不可见;1-可见
		 *
		 * 版本 >= 0
		 */
		var $cIsCanSeen; //uint8_t

		/**
		 * 操作描述，如果IsCanSeen为可见，此描述会在前端网站流水中展示，不能超过1024个字
		 *
		 * 版本 >= 0
		 */
		var $strOperationDesc; //std::string

		/**
		 * 系统内部描述，前台不可见，不能超过128个字
		 *
		 * 版本 >= 0
		 */
		var $strSysRemark; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCurState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperationType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperatorName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperatorType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIsCanSeen_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperationDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSysRemark_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->strDealId = ""; // std::string
			 $this->ddwTradeId = 0; // uint64_t
			 $this->dwOperateTime = 0; // uint32_t
			 $this->dwCurState = 0; // uint32_t
			 $this->wOperationType = 0; // uint16_t
			 $this->strOperatorName = ""; // std::string
			 $this->wOperatorType = 0; // uint16_t
			 $this->cIsCanSeen = 0; // uint8_t
			 $this->strOperationDesc = ""; // std::string
			 $this->strSysRemark = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cDealId_u = 0; // uint8_t
			 $this->cTradeId_u = 0; // uint8_t
			 $this->cOperateTime_u = 0; // uint8_t
			 $this->cCurState_u = 0; // uint8_t
			 $this->cOperationType_u = 0; // uint8_t
			 $this->cOperatorName_u = 0; // uint8_t
			 $this->cOperatorType_u = 0; // uint8_t
			 $this->cIsCanSeen_u = 0; // uint8_t
			 $this->cOperationDesc_u = 0; // uint8_t
			 $this->cSysRemark_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化版本号 类型为uint16_t
			$bs->pushString($this->strDealId); // 序列化订单编号，格式:订单序号XXXXYYYY，如:101041051509351702 类型为std::string
			$bs->pushUint64_t($this->ddwTradeId); // 序列化商品子单ID，商品子单维度操作时填写，订单维度操作可不填 类型为uint64_t
			$bs->pushUint32_t($this->dwOperateTime); // 序列化操作时间 类型为uint32_t
			$bs->pushUint32_t($this->dwCurState); // 序列化操作时的订单状态 类型为uint32_t
			$bs->pushUint16_t($this->wOperationType); // 序列化操作类型: 101-物流信息同步;102-签收;103-拒签;...更多请业务方补充 类型为uint16_t
			$bs->pushString($this->strOperatorName); // 序列化操作者，请和EventParamsBaseBo中的OperatorNmae填写相同 类型为std::string
			$bs->pushUint16_t($this->wOperatorType); // 序列化操作者类别:1-买家;2-卖家(客服);3-系统;4-BOSS;5-支付系统;6-API; 类型为uint16_t
			$bs->pushUint8_t($this->cIsCanSeen); // 序列化操作描述是否前台可见，配合OperationDesc使用，取值:0-不可见;1-可见 类型为uint8_t
			$bs->pushString($this->strOperationDesc); // 序列化操作描述，如果IsCanSeen为可见，此描述会在前端网站流水中展示，不能超过1024个字 类型为std::string
			$bs->pushString($this->strSysRemark); // 序列化系统内部描述，前台不可见，不能超过128个字 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCurState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperationType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperatorName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperatorType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIsCanSeen_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperationDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSysRemark_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化版本号 类型为uint16_t
			$this->strDealId = $bs->popString(); // 反序列化订单编号，格式:订单序号XXXXYYYY，如:101041051509351702 类型为std::string
			$this->ddwTradeId = $bs->popUint64_t(); // 反序列化商品子单ID，商品子单维度操作时填写，订单维度操作可不填 类型为uint64_t
			$this->dwOperateTime = $bs->popUint32_t(); // 反序列化操作时间 类型为uint32_t
			$this->dwCurState = $bs->popUint32_t(); // 反序列化操作时的订单状态 类型为uint32_t
			$this->wOperationType = $bs->popUint16_t(); // 反序列化操作类型: 101-物流信息同步;102-签收;103-拒签;...更多请业务方补充 类型为uint16_t
			$this->strOperatorName = $bs->popString(); // 反序列化操作者，请和EventParamsBaseBo中的OperatorNmae填写相同 类型为std::string
			$this->wOperatorType = $bs->popUint16_t(); // 反序列化操作者类别:1-买家;2-卖家(客服);3-系统;4-BOSS;5-支付系统;6-API; 类型为uint16_t
			$this->cIsCanSeen = $bs->popUint8_t(); // 反序列化操作描述是否前台可见，配合OperationDesc使用，取值:0-不可见;1-可见 类型为uint8_t
			$this->strOperationDesc = $bs->popString(); // 反序列化操作描述，如果IsCanSeen为可见，此描述会在前端网站流水中展示，不能超过1024个字 类型为std::string
			$this->strSysRemark = $bs->popString(); // 反序列化系统内部描述，前台不可见，不能超过128个字 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCurState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperationType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperatorName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperatorType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIsCanSeen_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperationDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSysRemark_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.ecc.deal.idl.RefuseDealReq.java

if (!class_exists('EventParamsCorpSignBo')) {
class EventParamsCorpSignBo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 签收(拒签)时间
		 *
		 * 版本 >= 0
		 */
		var $dwSignTime; //uint32_t

		/**
		 * 签收(拒签)描述
		 *
		 * 版本 >= 0
		 */
		var $strSignDesc; //std::string

		/**
		 * 拒签的子单列表，个别子单拒签时填写，整单签收或整单拒签时可不填
		 *
		 * 版本 >= 0
		 */
		var $vecRefuseTradeList; //std::vector<uint64_t> 

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
		var $cSignTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSignDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefuseTradeList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * 拒签的子单列表，个别子单拒签时填写，整单签收或整单拒签时可不填
		 *
		 * 版本 >= 1
		 */
		var $oReturnList; //ecc::deal::bo::CEventParamsCorpModifyTradeBo

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $dwReturnList_u; //uint32_t


		 function __construct() {
			 $this->wVersion = 1; // uint16_t
			 $this->dwSignTime = 0; // uint32_t
			 $this->strSignDesc = ""; // std::string
			 $this->vecRefuseTradeList = new stl_vector('uint64_t'); // std::vector<uint64_t> 
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cSignTime_u = 0; // uint8_t
			 $this->cSignDesc_u = 0; // uint8_t
			 $this->cRefuseTradeList_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
			 $this->oReturnList = new EventParamsCorpModifyTradeBo(); // ecc::deal::bo::CEventParamsCorpModifyTradeBo
			 $this->dwReturnList_u = 0; // uint32_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushUint32_t($this->dwSignTime); // 序列化签收(拒签)时间 类型为uint32_t
			$bs->pushString($this->strSignDesc); // 序列化签收(拒签)描述 类型为std::string
			$bs->pushObject($this->vecRefuseTradeList,'stl_vector'); // 序列化拒签的子单列表，个别子单拒签时填写，整单签收或整单拒签时可不填 类型为std::vector<uint64_t> 
			$bs->pushString($this->strReserve); // 序列化保留字段 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSignTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSignDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefuseTradeList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushObject($this->oReturnList,'EventParamsCorpModifyTradeBo'); // 序列化拒签的子单列表，个别子单拒签时填写，整单签收或整单拒签时可不填 类型为ecc::deal::bo::CEventParamsCorpModifyTradeBo
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwReturnList_u); // 序列化 类型为uint32_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->dwSignTime = $bs->popUint32_t(); // 反序列化签收(拒签)时间 类型为uint32_t
			$this->strSignDesc = $bs->popString(); // 反序列化签收(拒签)描述 类型为std::string
			$this->vecRefuseTradeList = $bs->popObject('stl_vector<uint64_t>'); // 反序列化拒签的子单列表，个别子单拒签时填写，整单签收或整单拒签时可不填 类型为std::vector<uint64_t> 
			$this->strReserve = $bs->popString(); // 反序列化保留字段 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSignTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSignDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefuseTradeList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserve_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$this->oReturnList = $bs->popObject('EventParamsCorpModifyTradeBo'); // 反序列化拒签的子单列表，个别子单拒签时填写，整单签收或整单拒签时可不填 类型为ecc::deal::bo::CEventParamsCorpModifyTradeBo
			}
			if(  $this->wVersion >= 1 ){
				$this->dwReturnList_u = $bs->popUint32_t(); // 反序列化 类型为uint32_t
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


//source idl: com.ecc.deal.idl.EventParamsCorpSignBo.java

if (!class_exists('EventParamsCorpModifyTradeBo')) {
class EventParamsCorpModifyTradeBo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 子单id
		 *
		 * 版本 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * 子单skuid
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 商品子单成本价，必须是CostPrice_u等于1时才有效
		 *
		 * 版本 >= 0
		 */
		var $dwCostPrice; //uint32_t

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
		var $cTradeId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCostPrice_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * 退货数量，必须是ReturnNum_u等于1时才有效
		 *
		 * 版本 >= 1
		 */
		var $dwReturnNum; //uint32_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cReturnNum_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 1; // uint16_t
			 $this->ddwTradeId = 0; // uint64_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->dwCostPrice = 0; // uint32_t
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cTradeId_u = 0; // uint8_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->cCostPrice_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
			 $this->dwReturnNum = 0; // uint32_t
			 $this->cReturnNum_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushUint64_t($this->ddwTradeId); // 序列化子单id 类型为uint64_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化子单skuid 类型为uint64_t
			$bs->pushUint32_t($this->dwCostPrice); // 序列化商品子单成本价，必须是CostPrice_u等于1时才有效 类型为uint32_t
			$bs->pushString($this->strReserve); // 序列化保留字段 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCostPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwReturnNum); // 序列化退货数量，必须是ReturnNum_u等于1时才有效 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cReturnNum_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->ddwTradeId = $bs->popUint64_t(); // 反序列化子单id 类型为uint64_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化子单skuid 类型为uint64_t
			$this->dwCostPrice = $bs->popUint32_t(); // 反序列化商品子单成本价，必须是CostPrice_u等于1时才有效 类型为uint32_t
			$this->strReserve = $bs->popString(); // 反序列化保留字段 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCostPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserve_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$this->dwReturnNum = $bs->popUint32_t(); // 反序列化退货数量，必须是ReturnNum_u等于1时才有效 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cReturnNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.ecc.deal.idl.OperateGoodsReq.java

if (!class_exists('EventParamsModifyDealPriceBo')) {
class EventParamsModifyDealPriceBo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 操作时间
		 *
		 * 版本 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * 是否修改运费，修改填1，否则填0。配合NewShipFee使用
		 *
		 * 版本 >= 0
		 */
		var $cIsShipFeeModify; //uint8_t

		/**
		 * 最新运费，IsShipFeeModify设置后必填
		 *
		 * 版本 >= 0
		 */
		var $dwNewShipFee; //uint32_t

		/**
		 * 是否修改订单金额，修改填1，否则填0。配合DealAdjustFee使用
		 *
		 * 版本 >= 0
		 */
		var $cIsDealFeeModify; //uint8_t

		/**
		 * 订单调整金额，正数表示加价，负数表示减价，IsDealFeeModify设置后必填
		 *
		 * 版本 >= 0
		 */
		var $nDealAdjustFee; //int

		/**
		 * 子单金额修改信息
		 *
		 * 版本 >= 0
		 */
		var $vecTradePriceList; //std::vector<ecc::deal::bo::CEventParamsModifyTradePriceBo> 

		/**
		 * 最新订单总金额，必填
		 *
		 * 版本 >= 0
		 */
		var $dwNewDealTotalFee; //uint32_t

		/**
		 * 描述
		 *
		 * 版本 >= 0
		 */
		var $strOperateDesc; //std::string

		/**
		 * 订单类型
		 *
		 * 版本 >= 0
		 */
		var $dwOrderType; //uint32_t

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
		var $cOperateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIsShipFeeModify_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cNewShipFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIsDealFeeModify_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealAdjustFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradePriceList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cNewDealTotalFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperateDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOrderType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * 最新订单折扣金额
		 *
		 * 版本 >= 1
		 */
		var $dwDealDiscountAmt; //uint32_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cDealDiscountAmt_u; //uint8_t

		/**
		 * 销售金额
		 *
		 * 版本 >= 2
		 */
		var $dwSoldAmount; //uint32_t

		/**
		 * 获得积分值，订单赠送积分
		 *
		 * 版本 >= 2
		 */
		var $dwPointObtain; //uint32_t

		/**
		 * 运费保险费，保费
		 *
		 * 版本 >= 2
		 */
		var $dwInsuranceFee; //uint32_t

		/**
		 * 支付积分，金额单位是分
		 *
		 * 版本 >= 2
		 */
		var $dwPointPay; //uint32_t

		/**
		 * 现金积分，金额单位是分
		 *
		 * 版本 >= 2
		 */
		var $dwCashScore; //uint32_t

		/**
		 * 促销积分，金额单位是分
		 *
		 * 版本 >= 2
		 */
		var $dwPromotionScore; //uint32_t

		/**
		 * 结算金额
		 *
		 * 版本 >= 2
		 */
		var $dwSettlementFee; //uint32_t

		/**
		 * 支付手续费（主要用于分期付款）
		 *
		 * 版本 >= 2
		 */
		var $dwPayProcedure; //uint32_t

		/**
		 * 运费优惠
		 *
		 * 版本 >= 2
		 */
		var $dwShipFeeDiscount; //uint32_t

		/**
		 * 是否需要装机服务（兼容性审核）
		 *
		 * 版本 >= 2
		 */
		var $cHasServiceProduct; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 2
		 */
		var $cSoldAmount_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 2
		 */
		var $cPointObtain_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 2
		 */
		var $cInsuranceFee_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 2
		 */
		var $cPointPay_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 2
		 */
		var $cCashScore_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 2
		 */
		var $cPromotionScore_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 2
		 */
		var $cSettlementFee_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 2
		 */
		var $cPayProcedure_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 2
		 */
		var $cShipFeeDiscount_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 2
		 */
		var $cHasServiceProduct_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 2; // uint16_t
			 $this->dwOperateTime = 0; // uint32_t
			 $this->cIsShipFeeModify = 0; // uint8_t
			 $this->dwNewShipFee = 0; // uint32_t
			 $this->cIsDealFeeModify = 0; // uint8_t
			 $this->nDealAdjustFee = 0; // int
			 $this->vecTradePriceList = new stl_vector('EventParamsModifyTradePriceBo'); // std::vector<ecc::deal::bo::CEventParamsModifyTradePriceBo> 
			 $this->dwNewDealTotalFee = 0; // uint32_t
			 $this->strOperateDesc = ""; // std::string
			 $this->dwOrderType = 0; // uint32_t
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cOperateTime_u = 0; // uint8_t
			 $this->cIsShipFeeModify_u = 0; // uint8_t
			 $this->cNewShipFee_u = 0; // uint8_t
			 $this->cIsDealFeeModify_u = 0; // uint8_t
			 $this->cDealAdjustFee_u = 0; // uint8_t
			 $this->cTradePriceList_u = 0; // uint8_t
			 $this->cNewDealTotalFee_u = 0; // uint8_t
			 $this->cOperateDesc_u = 0; // uint8_t
			 $this->cOrderType_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
			 $this->dwDealDiscountAmt = 0; // uint32_t
			 $this->cDealDiscountAmt_u = 0; // uint8_t
			 $this->dwSoldAmount = 0; // uint32_t
			 $this->dwPointObtain = 0; // uint32_t
			 $this->dwInsuranceFee = 0; // uint32_t
			 $this->dwPointPay = 0; // uint32_t
			 $this->dwCashScore = 0; // uint32_t
			 $this->dwPromotionScore = 0; // uint32_t
			 $this->dwSettlementFee = 0; // uint32_t
			 $this->dwPayProcedure = 0; // uint32_t
			 $this->dwShipFeeDiscount = 0; // uint32_t
			 $this->cHasServiceProduct = 0; // uint8_t
			 $this->cSoldAmount_u = 0; // uint8_t
			 $this->cPointObtain_u = 0; // uint8_t
			 $this->cInsuranceFee_u = 0; // uint8_t
			 $this->cPointPay_u = 0; // uint8_t
			 $this->cCashScore_u = 0; // uint8_t
			 $this->cPromotionScore_u = 0; // uint8_t
			 $this->cSettlementFee_u = 0; // uint8_t
			 $this->cPayProcedure_u = 0; // uint8_t
			 $this->cShipFeeDiscount_u = 0; // uint8_t
			 $this->cHasServiceProduct_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushUint32_t($this->dwOperateTime); // 序列化操作时间 类型为uint32_t
			$bs->pushUint8_t($this->cIsShipFeeModify); // 序列化是否修改运费，修改填1，否则填0。配合NewShipFee使用 类型为uint8_t
			$bs->pushUint32_t($this->dwNewShipFee); // 序列化最新运费，IsShipFeeModify设置后必填 类型为uint32_t
			$bs->pushUint8_t($this->cIsDealFeeModify); // 序列化是否修改订单金额，修改填1，否则填0。配合DealAdjustFee使用 类型为uint8_t
			$bs->pushInt32_t($this->nDealAdjustFee); // 序列化订单调整金额，正数表示加价，负数表示减价，IsDealFeeModify设置后必填 类型为int
			$bs->pushObject($this->vecTradePriceList,'stl_vector'); // 序列化子单金额修改信息 类型为std::vector<ecc::deal::bo::CEventParamsModifyTradePriceBo> 
			$bs->pushUint32_t($this->dwNewDealTotalFee); // 序列化最新订单总金额，必填 类型为uint32_t
			$bs->pushString($this->strOperateDesc); // 序列化描述 类型为std::string
			$bs->pushUint32_t($this->dwOrderType); // 序列化订单类型 类型为uint32_t
			$bs->pushString($this->strReserve); // 序列化保留字段 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIsShipFeeModify_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cNewShipFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIsDealFeeModify_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealAdjustFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradePriceList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cNewDealTotalFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperateDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOrderType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwDealDiscountAmt); // 序列化最新订单折扣金额 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cDealDiscountAmt_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwSoldAmount); // 序列化销售金额 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwPointObtain); // 序列化获得积分值，订单赠送积分 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwInsuranceFee); // 序列化运费保险费，保费 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwPointPay); // 序列化支付积分，金额单位是分 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwCashScore); // 序列化现金积分，金额单位是分 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwPromotionScore); // 序列化促销积分，金额单位是分 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwSettlementFee); // 序列化结算金额 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwPayProcedure); // 序列化支付手续费（主要用于分期付款） 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwShipFeeDiscount); // 序列化运费优惠 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cHasServiceProduct); // 序列化是否需要装机服务（兼容性审核） 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cSoldAmount_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cPointObtain_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cInsuranceFee_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cPointPay_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cCashScore_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cPromotionScore_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cSettlementFee_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cPayProcedure_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cShipFeeDiscount_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cHasServiceProduct_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->dwOperateTime = $bs->popUint32_t(); // 反序列化操作时间 类型为uint32_t
			$this->cIsShipFeeModify = $bs->popUint8_t(); // 反序列化是否修改运费，修改填1，否则填0。配合NewShipFee使用 类型为uint8_t
			$this->dwNewShipFee = $bs->popUint32_t(); // 反序列化最新运费，IsShipFeeModify设置后必填 类型为uint32_t
			$this->cIsDealFeeModify = $bs->popUint8_t(); // 反序列化是否修改订单金额，修改填1，否则填0。配合DealAdjustFee使用 类型为uint8_t
			$this->nDealAdjustFee = $bs->popInt32_t(); // 反序列化订单调整金额，正数表示加价，负数表示减价，IsDealFeeModify设置后必填 类型为int
			$this->vecTradePriceList = $bs->popObject('stl_vector<EventParamsModifyTradePriceBo>'); // 反序列化子单金额修改信息 类型为std::vector<ecc::deal::bo::CEventParamsModifyTradePriceBo> 
			$this->dwNewDealTotalFee = $bs->popUint32_t(); // 反序列化最新订单总金额，必填 类型为uint32_t
			$this->strOperateDesc = $bs->popString(); // 反序列化描述 类型为std::string
			$this->dwOrderType = $bs->popUint32_t(); // 反序列化订单类型 类型为uint32_t
			$this->strReserve = $bs->popString(); // 反序列化保留字段 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIsShipFeeModify_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cNewShipFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIsDealFeeModify_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealAdjustFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradePriceList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cNewDealTotalFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperateDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOrderType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserve_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$this->dwDealDiscountAmt = $bs->popUint32_t(); // 反序列化最新订单折扣金额 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cDealDiscountAmt_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwSoldAmount = $bs->popUint32_t(); // 反序列化销售金额 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwPointObtain = $bs->popUint32_t(); // 反序列化获得积分值，订单赠送积分 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwInsuranceFee = $bs->popUint32_t(); // 反序列化运费保险费，保费 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwPointPay = $bs->popUint32_t(); // 反序列化支付积分，金额单位是分 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwCashScore = $bs->popUint32_t(); // 反序列化现金积分，金额单位是分 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwPromotionScore = $bs->popUint32_t(); // 反序列化促销积分，金额单位是分 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwSettlementFee = $bs->popUint32_t(); // 反序列化结算金额 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwPayProcedure = $bs->popUint32_t(); // 反序列化支付手续费（主要用于分期付款） 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwShipFeeDiscount = $bs->popUint32_t(); // 反序列化运费优惠 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cHasServiceProduct = $bs->popUint8_t(); // 反序列化是否需要装机服务（兼容性审核） 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cSoldAmount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cPointObtain_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cInsuranceFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cPointPay_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cCashScore_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cPromotionScore_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cSettlementFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cPayProcedure_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cShipFeeDiscount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cHasServiceProduct_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.ecc.deal.idl.EventParamsModifyDealPriceBo.java

if (!class_exists('EventParamsModifyTradePriceBo')) {
class EventParamsModifyTradePriceBo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 子单id
		 *
		 * 版本 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * 子单skuid
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 是否修改商品数量，修改填1，否则填0。配合NewBuyNum使用
		 *
		 * 版本 >= 0
		 */
		var $cIsBuyNumModify; //uint8_t

		/**
		 * 最新商品数量，IsBuyNumModify设置后必填
		 *
		 * 版本 >= 0
		 */
		var $dwNewBuyNum; //uint32_t

		/**
		 * 是否修改子单金额，修改填1，否则填0。配合TradeAdjustFee使用
		 *
		 * 版本 >= 0
		 */
		var $cIsTradeFeeModify; //uint8_t

		/**
		 * 订单调整金额，正数表示加价，负数表示减价，IsTradeFeeModify设置后必填
		 *
		 * 版本 >= 0
		 */
		var $nTradeAdjustFee; //int

		/**
		 * 最新子单总金额，必填
		 *
		 * 版本 >= 0
		 */
		var $dwNewTradeTotalFee; //uint32_t

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
		var $cTradeId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIsBuyNumModify_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cNewBuyNum_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIsTradeFeeModify_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeAdjustFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cNewTradeTotalFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * 商品价格，必填
		 *
		 * 版本 >= 1
		 */
		var $dwPrice; //uint32_t

		/**
		 * 成本价，必填
		 *
		 * 版本 >= 1
		 */
		var $dwCostPrice; //uint32_t

		/**
		 * 折扣金额
		 *
		 * 版本 >= 1
		 */
		var $dwTradeDiscountAmt; //uint32_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cPrice_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cCostPrice_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cTradeDiscountAmt_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 1; // uint16_t
			 $this->ddwTradeId = 0; // uint64_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cIsBuyNumModify = 0; // uint8_t
			 $this->dwNewBuyNum = 0; // uint32_t
			 $this->cIsTradeFeeModify = 0; // uint8_t
			 $this->nTradeAdjustFee = 0; // int
			 $this->dwNewTradeTotalFee = 0; // uint32_t
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cTradeId_u = 0; // uint8_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->cIsBuyNumModify_u = 0; // uint8_t
			 $this->cNewBuyNum_u = 0; // uint8_t
			 $this->cIsTradeFeeModify_u = 0; // uint8_t
			 $this->cTradeAdjustFee_u = 0; // uint8_t
			 $this->cNewTradeTotalFee_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
			 $this->dwPrice = 0; // uint32_t
			 $this->dwCostPrice = 0; // uint32_t
			 $this->dwTradeDiscountAmt = 0; // uint32_t
			 $this->cPrice_u = 0; // uint8_t
			 $this->cCostPrice_u = 0; // uint8_t
			 $this->cTradeDiscountAmt_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushUint64_t($this->ddwTradeId); // 序列化子单id 类型为uint64_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化子单skuid 类型为uint64_t
			$bs->pushUint8_t($this->cIsBuyNumModify); // 序列化是否修改商品数量，修改填1，否则填0。配合NewBuyNum使用 类型为uint8_t
			$bs->pushUint32_t($this->dwNewBuyNum); // 序列化最新商品数量，IsBuyNumModify设置后必填 类型为uint32_t
			$bs->pushUint8_t($this->cIsTradeFeeModify); // 序列化是否修改子单金额，修改填1，否则填0。配合TradeAdjustFee使用 类型为uint8_t
			$bs->pushInt32_t($this->nTradeAdjustFee); // 序列化订单调整金额，正数表示加价，负数表示减价，IsTradeFeeModify设置后必填 类型为int
			$bs->pushUint32_t($this->dwNewTradeTotalFee); // 序列化最新子单总金额，必填 类型为uint32_t
			$bs->pushString($this->strReserve); // 序列化保留字段 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIsBuyNumModify_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cNewBuyNum_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIsTradeFeeModify_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeAdjustFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cNewTradeTotalFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwPrice); // 序列化商品价格，必填 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwCostPrice); // 序列化成本价，必填 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwTradeDiscountAmt); // 序列化折扣金额 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cPrice_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cCostPrice_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cTradeDiscountAmt_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->ddwTradeId = $bs->popUint64_t(); // 反序列化子单id 类型为uint64_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化子单skuid 类型为uint64_t
			$this->cIsBuyNumModify = $bs->popUint8_t(); // 反序列化是否修改商品数量，修改填1，否则填0。配合NewBuyNum使用 类型为uint8_t
			$this->dwNewBuyNum = $bs->popUint32_t(); // 反序列化最新商品数量，IsBuyNumModify设置后必填 类型为uint32_t
			$this->cIsTradeFeeModify = $bs->popUint8_t(); // 反序列化是否修改子单金额，修改填1，否则填0。配合TradeAdjustFee使用 类型为uint8_t
			$this->nTradeAdjustFee = $bs->popInt32_t(); // 反序列化订单调整金额，正数表示加价，负数表示减价，IsTradeFeeModify设置后必填 类型为int
			$this->dwNewTradeTotalFee = $bs->popUint32_t(); // 反序列化最新子单总金额，必填 类型为uint32_t
			$this->strReserve = $bs->popString(); // 反序列化保留字段 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIsBuyNumModify_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cNewBuyNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIsTradeFeeModify_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeAdjustFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cNewTradeTotalFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserve_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$this->dwPrice = $bs->popUint32_t(); // 反序列化商品价格，必填 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->dwCostPrice = $bs->popUint32_t(); // 反序列化成本价，必填 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->dwTradeDiscountAmt = $bs->popUint32_t(); // 反序列化折扣金额 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cCostPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cTradeDiscountAmt_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.ecc.deal.idl.OperateGoodsReq.java

if (!class_exists('EventParamsOperGoodsBo')) {
class EventParamsOperGoodsBo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 操作时间
		 *
		 * 版本 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * 增加商品列表
		 *
		 * 版本 >= 0
		 */
		var $vecAddList; //std::vector<ecc::deal::bo::CEventParamsAddGoodsBo> 

		/**
		 * 删除商品列表
		 *
		 * 版本 >= 0
		 */
		var $vecRemoveList; //std::vector<ecc::deal::bo::CEventParamsRemoveGoodsBo> 

		/**
		 * 描述
		 *
		 * 版本 >= 0
		 */
		var $strOperateDesc; //std::string

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
		var $cOperateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cAddList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRemoveList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperateDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->dwOperateTime = 0; // uint32_t
			 $this->vecAddList = new stl_vector('EventParamsAddGoodsBo'); // std::vector<ecc::deal::bo::CEventParamsAddGoodsBo> 
			 $this->vecRemoveList = new stl_vector('EventParamsRemoveGoodsBo'); // std::vector<ecc::deal::bo::CEventParamsRemoveGoodsBo> 
			 $this->strOperateDesc = ""; // std::string
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cOperateTime_u = 0; // uint8_t
			 $this->cAddList_u = 0; // uint8_t
			 $this->cRemoveList_u = 0; // uint8_t
			 $this->cOperateDesc_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushUint32_t($this->dwOperateTime); // 序列化操作时间 类型为uint32_t
			$bs->pushObject($this->vecAddList,'stl_vector'); // 序列化增加商品列表 类型为std::vector<ecc::deal::bo::CEventParamsAddGoodsBo> 
			$bs->pushObject($this->vecRemoveList,'stl_vector'); // 序列化删除商品列表 类型为std::vector<ecc::deal::bo::CEventParamsRemoveGoodsBo> 
			$bs->pushString($this->strOperateDesc); // 序列化描述 类型为std::string
			$bs->pushString($this->strReserve); // 序列化保留字段 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cAddList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRemoveList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperateDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->dwOperateTime = $bs->popUint32_t(); // 反序列化操作时间 类型为uint32_t
			$this->vecAddList = $bs->popObject('stl_vector<EventParamsAddGoodsBo>'); // 反序列化增加商品列表 类型为std::vector<ecc::deal::bo::CEventParamsAddGoodsBo> 
			$this->vecRemoveList = $bs->popObject('stl_vector<EventParamsRemoveGoodsBo>'); // 反序列化删除商品列表 类型为std::vector<ecc::deal::bo::CEventParamsRemoveGoodsBo> 
			$this->strOperateDesc = $bs->popString(); // 反序列化描述 类型为std::string
			$this->strReserve = $bs->popString(); // 反序列化保留字段 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cAddList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRemoveList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperateDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.ecc.deal.idl.EventParamsOperGoodsBo.java

if (!class_exists('EventParamsAddGoodsBo')) {
class EventParamsAddGoodsBo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 商品类型；1：普通商品；2：套餐主商品；3：套餐副商品；4：赠品主商品；5：赠品副商品；6：组件
		 *
		 * 版本 >= 0
		 */
		var $dwItemType; //uint32_t

		/**
		 * 品类（类目）ID
		 *
		 * 版本 >= 0
		 */
		var $dwItemClassId; //uint32_t

		/**
		 * 商品标题
		 *
		 * 版本 >= 0
		 */
		var $strItemTitle; //std::string

		/**
		 * 商品销售属性编码
		 *
		 * 版本 >= 0
		 */
		var $strItemAttrCode; //std::string

		/**
		 * 商品销售属性描述
		 *
		 * 版本 >= 0
		 */
		var $strItemAttr; //std::string

		/**
		 * 商品显示ID，由业务定义
		 *
		 * 版本 >= 0
		 */
		var $strItemId; //std::string

		/**
		 * 商品SKUID
		 *
		 * 版本 >= 0
		 */
		var $ddwItemSkuId; //uint64_t

		/**
		 * 商品商家本地编码
		 *
		 * 版本 >= 0
		 */
		var $strItemLocalCode; //std::string

		/**
		 * 商品商家本地库存编码
		 *
		 * 版本 >= 0
		 */
		var $strItemLocalStockCode; //std::string

		/**
		 * 商品条形码
		 *
		 * 版本 >= 0
		 */
		var $strItemBarCode; //std::string

		/**
		 * 商品库存ID
		 *
		 * 版本 >= 0
		 */
		var $ddwItemStockId; //uint64_t

		/**
		 * 商品仓库ID
		 *
		 * 版本 >= 0
		 */
		var $dwItemStoreHouseId; //uint32_t

		/**
		 * 商品所属物理仓
		 *
		 * 版本 >= 0
		 */
		var $strItemPhyisicalStorage; //std::string

		/**
		 * 商品图片Logo，业务自定义
		 *
		 * 版本 >= 0
		 */
		var $strItemLogo; //std::string

		/**
		 * 商品快照版本号
		 *
		 * 版本 >= 0
		 */
		var $dwItemSnapVersion; //uint32_t

		/**
		 * 商品重置时间戳
		 *
		 * 版本 >= 0
		 */
		var $dwItemResetTime; //uint32_t

		/**
		 * 商品重量
		 *
		 * 版本 >= 0
		 */
		var $dwItemWeight; //uint32_t

		/**
		 * 商品体积
		 *
		 * 版本 >= 0
		 */
		var $dwItemVolume; //uint32_t

		/**
		 * 商品套餐主商品ID
		 *
		 * 版本 >= 0
		 */
		var $ddwMainItemId; //uint64_t

		/**
		 * 商品标配说明
		 *
		 * 版本 >= 0
		 */
		var $strItemAccessoryDesc; //std::string

		/**
		 * 商品成本价
		 *
		 * 版本 >= 0
		 */
		var $dwItemCostPrice; //uint32_t

		/**
		 * 商品市场价
		 *
		 * 版本 >= 0
		 */
		var $dwItemOriginPrice; //uint32_t

		/**
		 * 商品销售单价
		 *
		 * 版本 >= 0
		 */
		var $dwItemSoldPrice; //uint32_t

		/**
		 * 自营B2C市场
		 *
		 * 版本 >= 0
		 */
		var $strItemB2CMarket; //std::string

		/**
		 * 自营B2CPM
		 *
		 * 版本 >= 0
		 */
		var $strItemB2CPM; //std::string

		/**
		 * 自营B2C是否占用虚库
		 *
		 * 版本 >= 0
		 */
		var $cItemUseVirtualStock; //uint8_t

		/**
		 * 商品成交价
		 *
		 * 版本 >= 0
		 */
		var $dwBuyPrice; //uint32_t

		/**
		 * 商品成交件数
		 *
		 * 版本 >= 0
		 */
		var $dwBuyNum; //uint32_t

		/**
		 * 商品单总金额,下单金额
		 *
		 * 版本 >= 0
		 */
		var $dwTradeTotalFee; //uint32_t

		/**
		 * 商品单调价金额
		 *
		 * 版本 >= 0
		 */
		var $nTradeAdjustFee; //int

		/**
		 * 实付总金额
		 *
		 * 版本 >= 0
		 */
		var $dwTradePayment; //uint32_t

		/**
		 * 优惠总金额
		 *
		 * 版本 >= 0
		 */
		var $nTradeDiscountTotal; //int

		/**
		 * 积分支付值
		 *
		 * 版本 >= 0
		 */
		var $dwPayScore; //uint32_t

		/**
		 * 商品单库存操作序列号
		 *
		 * 版本 >= 0
		 */
		var $wTradeOpSerialNo; //uint16_t

		/**
		 * 获得积分值
		 *
		 * 版本 >= 0
		 */
		var $dwObtainScore; //uint32_t

		/**
		 * 通用属性值
		 *
		 * 版本 >= 0
		 */
		var $dwTradeCommProperty; //uint32_t

		/**
		 * 业务属性值
		 *
		 * 版本 >= 0
		 */
		var $dwTradeBusinessProperty; //uint32_t

		/**
		 * 保修条款
		 *
		 * 版本 >= 0
		 */
		var $strWarranty; //std::string

		/**
		 * 易迅edm编码
		 *
		 * 版本 >= 0
		 */
		var $strIcsonEdmCode; //std::string

		/**
		 * 易迅OTag
		 *
		 * 版本 >= 0
		 */
		var $strIcsonOTag; //std::string

		/**
		 * 易迅店铺导购费用
		 *
		 * 版本 >= 0
		 */
		var $strIcsonTradeShopGuideCost; //std::string

		/**
		 * 易迅定制机类型
		 *
		 * 版本 >= 0
		 */
		var $strIcsonCSPhoneType; //std::string

		/**
		 * 易迅定制机运营商
		 *
		 * 版本 >= 0
		 */
		var $strIcsonCSPhoneOperator; //std::string

		/**
		 * 易迅定制机号码
		 *
		 * 版本 >= 0
		 */
		var $strIcsonCSPhoneNumber; //std::string

		/**
		 * 易迅定制机归属地
		 *
		 * 版本 >= 0
		 */
		var $strIcsonCSPhoneArea; //std::string

		/**
		 * 易迅定制机套餐id
		 *
		 * 版本 >= 0
		 */
		var $strIcsonCSPhonePackageId; //std::string

		/**
		 * 易迅定制机用户姓名
		 *
		 * 版本 >= 0
		 */
		var $strIcsonCSPhoneUserName; //std::string

		/**
		 * 易迅定制机用户地址
		 *
		 * 版本 >= 0
		 */
		var $strIcsonCSPhoneUserAddr; //std::string

		/**
		 * 易迅定制机用户联系手机
		 *
		 * 版本 >= 0
		 */
		var $strIcsonCSPhoneUserMobile; //std::string

		/**
		 * 易迅定制机用户联系电话
		 *
		 * 版本 >= 0
		 */
		var $strIcsonCSPhoneUserTel; //std::string

		/**
		 * 易迅定制机身份证号码
		 *
		 * 版本 >= 0
		 */
		var $strIcsonCSPhoneIdCardNo; //std::string

		/**
		 * 易迅定制机身份证地址
		 *
		 * 版本 >= 0
		 */
		var $strIcsonCSPhoneIdCardAddr; //std::string

		/**
		 * 易迅定制机身份证有效期
		 *
		 * 版本 >= 0
		 */
		var $strIcsonCSPhoneIdCardDate; //std::string

		/**
		 * 易迅定制机邮政编码
		 *
		 * 版本 >= 0
		 */
		var $strIcsonCSPhoneZipCode; //std::string

		/**
		 * 易迅定制机卡价格
		 *
		 * 版本 >= 0
		 */
		var $strIcsonCSPhoneCardPrice; //std::string

		/**
		 * 易迅定制机套餐价格
		 *
		 * 版本 >= 0
		 */
		var $strIcsonCSPhonePackagePrice; //std::string

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
		var $cItemType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemClassId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemTitle_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemAttrCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemAttr_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemSkuId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemLocalCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemLocalStockCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemBarCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemStockId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemStoreHouseId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemPhyisicalStorage_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemLogo_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemSnapVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemResetTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemWeight_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemVolume_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cMainItemId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemAccessoryDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemCostPrice_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemOriginPrice_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemSoldPrice_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemB2CMarket_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemB2CPM_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemUseVirtualStock_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyPrice_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyNum_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeTotalFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeAdjustFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradePayment_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeDiscountTotal_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayScore_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeOpSerialNo_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cObtainScore_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeCommProperty_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeBusinessProperty_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cWarranty_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonEdmCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonOTag_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonTradeShopGuideCost_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonCSPhoneType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonCSPhoneOperator_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonCSPhoneNumber_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonCSPhoneArea_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonCSPhonePackageId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonCSPhoneUserName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonCSPhoneUserAddr_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonCSPhoneUserMobile_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonCSPhoneUserTel_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonCSPhoneIdCardNo_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonCSPhoneIdCardAddr_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonCSPhoneIdCardDate_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonCSPhoneZipCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonCSPhoneCardPrice_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cIcsonCSPhonePackagePrice_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * 产品id
		 *
		 * 版本 >= 1
		 */
		var $ddwProductId; //uint64_t

		/**
		 * 产品id编码
		 *
		 * 版本 >= 1
		 */
		var $strProductCode; //std::string

		/**
		 * 易迅商品子单flag
		 *
		 * 版本 >= 1
		 */
		var $strIcsonTradeFlag; //std::string

		/**
		 * 易迅积分兑换类型
		 *
		 * 版本 >= 1
		 */
		var $strIcsonPointType; //std::string

		/**
		 * 子单返现金额
		 *
		 * 版本 >= 1
		 */
		var $dwIcsonTradeCashBack; //uint32_t

		/**
		 * 去税后成本
		 *
		 * 版本 >= 1
		 */
		var $strIcsonUnitCostInvoice; //std::string

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cProductId_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cProductCode_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonTradeFlag_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonPointType_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonTradeCashBack_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonUnitCostInvoice_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 1; // uint16_t
			 $this->dwItemType = 0; // uint32_t
			 $this->dwItemClassId = 0; // uint32_t
			 $this->strItemTitle = ""; // std::string
			 $this->strItemAttrCode = ""; // std::string
			 $this->strItemAttr = ""; // std::string
			 $this->strItemId = ""; // std::string
			 $this->ddwItemSkuId = 0; // uint64_t
			 $this->strItemLocalCode = ""; // std::string
			 $this->strItemLocalStockCode = ""; // std::string
			 $this->strItemBarCode = ""; // std::string
			 $this->ddwItemStockId = 0; // uint64_t
			 $this->dwItemStoreHouseId = 0; // uint32_t
			 $this->strItemPhyisicalStorage = ""; // std::string
			 $this->strItemLogo = ""; // std::string
			 $this->dwItemSnapVersion = 0; // uint32_t
			 $this->dwItemResetTime = 0; // uint32_t
			 $this->dwItemWeight = 0; // uint32_t
			 $this->dwItemVolume = 0; // uint32_t
			 $this->ddwMainItemId = 0; // uint64_t
			 $this->strItemAccessoryDesc = ""; // std::string
			 $this->dwItemCostPrice = 0; // uint32_t
			 $this->dwItemOriginPrice = 0; // uint32_t
			 $this->dwItemSoldPrice = 0; // uint32_t
			 $this->strItemB2CMarket = ""; // std::string
			 $this->strItemB2CPM = ""; // std::string
			 $this->cItemUseVirtualStock = 0; // uint8_t
			 $this->dwBuyPrice = 0; // uint32_t
			 $this->dwBuyNum = 0; // uint32_t
			 $this->dwTradeTotalFee = 0; // uint32_t
			 $this->nTradeAdjustFee = 0; // int
			 $this->dwTradePayment = 0; // uint32_t
			 $this->nTradeDiscountTotal = 0; // int
			 $this->dwPayScore = 0; // uint32_t
			 $this->wTradeOpSerialNo = 0; // uint16_t
			 $this->dwObtainScore = 0; // uint32_t
			 $this->dwTradeCommProperty = 0; // uint32_t
			 $this->dwTradeBusinessProperty = 0; // uint32_t
			 $this->strWarranty = ""; // std::string
			 $this->strIcsonEdmCode = ""; // std::string
			 $this->strIcsonOTag = ""; // std::string
			 $this->strIcsonTradeShopGuideCost = ""; // std::string
			 $this->strIcsonCSPhoneType = ""; // std::string
			 $this->strIcsonCSPhoneOperator = ""; // std::string
			 $this->strIcsonCSPhoneNumber = ""; // std::string
			 $this->strIcsonCSPhoneArea = ""; // std::string
			 $this->strIcsonCSPhonePackageId = ""; // std::string
			 $this->strIcsonCSPhoneUserName = ""; // std::string
			 $this->strIcsonCSPhoneUserAddr = ""; // std::string
			 $this->strIcsonCSPhoneUserMobile = ""; // std::string
			 $this->strIcsonCSPhoneUserTel = ""; // std::string
			 $this->strIcsonCSPhoneIdCardNo = ""; // std::string
			 $this->strIcsonCSPhoneIdCardAddr = ""; // std::string
			 $this->strIcsonCSPhoneIdCardDate = ""; // std::string
			 $this->strIcsonCSPhoneZipCode = ""; // std::string
			 $this->strIcsonCSPhoneCardPrice = ""; // std::string
			 $this->strIcsonCSPhonePackagePrice = ""; // std::string
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cItemType_u = 0; // uint8_t
			 $this->cItemClassId_u = 0; // uint8_t
			 $this->cItemTitle_u = 0; // uint8_t
			 $this->cItemAttrCode_u = 0; // uint8_t
			 $this->cItemAttr_u = 0; // uint8_t
			 $this->cItemId_u = 0; // uint8_t
			 $this->cItemSkuId_u = 0; // uint8_t
			 $this->cItemLocalCode_u = 0; // uint8_t
			 $this->cItemLocalStockCode_u = 0; // uint8_t
			 $this->cItemBarCode_u = 0; // uint8_t
			 $this->cItemStockId_u = 0; // uint8_t
			 $this->cItemStoreHouseId_u = 0; // uint8_t
			 $this->cItemPhyisicalStorage_u = 0; // uint8_t
			 $this->cItemLogo_u = 0; // uint8_t
			 $this->cItemSnapVersion_u = 0; // uint8_t
			 $this->cItemResetTime_u = 0; // uint8_t
			 $this->cItemWeight_u = 0; // uint8_t
			 $this->cItemVolume_u = 0; // uint8_t
			 $this->cMainItemId_u = 0; // uint8_t
			 $this->cItemAccessoryDesc_u = 0; // uint8_t
			 $this->cItemCostPrice_u = 0; // uint8_t
			 $this->cItemOriginPrice_u = 0; // uint8_t
			 $this->cItemSoldPrice_u = 0; // uint8_t
			 $this->cItemB2CMarket_u = 0; // uint8_t
			 $this->cItemB2CPM_u = 0; // uint8_t
			 $this->cItemUseVirtualStock_u = 0; // uint8_t
			 $this->cBuyPrice_u = 0; // uint8_t
			 $this->cBuyNum_u = 0; // uint8_t
			 $this->cTradeTotalFee_u = 0; // uint8_t
			 $this->cTradeAdjustFee_u = 0; // uint8_t
			 $this->cTradePayment_u = 0; // uint8_t
			 $this->cTradeDiscountTotal_u = 0; // uint8_t
			 $this->cPayScore_u = 0; // uint8_t
			 $this->cTradeOpSerialNo_u = 0; // uint8_t
			 $this->cObtainScore_u = 0; // uint8_t
			 $this->cTradeCommProperty_u = 0; // uint8_t
			 $this->cTradeBusinessProperty_u = 0; // uint8_t
			 $this->cWarranty_u = 0; // uint8_t
			 $this->cIcsonEdmCode_u = 0; // uint8_t
			 $this->cIcsonOTag_u = 0; // uint8_t
			 $this->cIcsonTradeShopGuideCost_u = 0; // uint8_t
			 $this->cIcsonCSPhoneType_u = 0; // uint8_t
			 $this->cIcsonCSPhoneOperator_u = 0; // uint8_t
			 $this->cIcsonCSPhoneNumber_u = 0; // uint8_t
			 $this->cIcsonCSPhoneArea_u = 0; // uint8_t
			 $this->cIcsonCSPhonePackageId_u = 0; // uint8_t
			 $this->cIcsonCSPhoneUserName_u = 0; // uint8_t
			 $this->cIcsonCSPhoneUserAddr_u = 0; // uint8_t
			 $this->cIcsonCSPhoneUserMobile_u = 0; // uint8_t
			 $this->cIcsonCSPhoneUserTel_u = 0; // uint8_t
			 $this->cIcsonCSPhoneIdCardNo_u = 0; // uint8_t
			 $this->cIcsonCSPhoneIdCardAddr_u = 0; // uint8_t
			 $this->cIcsonCSPhoneIdCardDate_u = 0; // uint8_t
			 $this->cIcsonCSPhoneZipCode_u = 0; // uint8_t
			 $this->cIcsonCSPhoneCardPrice_u = 0; // uint8_t
			 $this->cIcsonCSPhonePackagePrice_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
			 $this->ddwProductId = 0; // uint64_t
			 $this->strProductCode = ""; // std::string
			 $this->strIcsonTradeFlag = ""; // std::string
			 $this->strIcsonPointType = ""; // std::string
			 $this->dwIcsonTradeCashBack = 0; // uint32_t
			 $this->strIcsonUnitCostInvoice = ""; // std::string
			 $this->cProductId_u = 0; // uint8_t
			 $this->cProductCode_u = 0; // uint8_t
			 $this->cIcsonTradeFlag_u = 0; // uint8_t
			 $this->cIcsonPointType_u = 0; // uint8_t
			 $this->cIcsonTradeCashBack_u = 0; // uint8_t
			 $this->cIcsonUnitCostInvoice_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushUint32_t($this->dwItemType); // 序列化商品类型；1：普通商品；2：套餐主商品；3：套餐副商品；4：赠品主商品；5：赠品副商品；6：组件 类型为uint32_t
			$bs->pushUint32_t($this->dwItemClassId); // 序列化品类（类目）ID 类型为uint32_t
			$bs->pushString($this->strItemTitle); // 序列化商品标题 类型为std::string
			$bs->pushString($this->strItemAttrCode); // 序列化商品销售属性编码 类型为std::string
			$bs->pushString($this->strItemAttr); // 序列化商品销售属性描述 类型为std::string
			$bs->pushString($this->strItemId); // 序列化商品显示ID，由业务定义 类型为std::string
			$bs->pushUint64_t($this->ddwItemSkuId); // 序列化商品SKUID 类型为uint64_t
			$bs->pushString($this->strItemLocalCode); // 序列化商品商家本地编码 类型为std::string
			$bs->pushString($this->strItemLocalStockCode); // 序列化商品商家本地库存编码 类型为std::string
			$bs->pushString($this->strItemBarCode); // 序列化商品条形码 类型为std::string
			$bs->pushUint64_t($this->ddwItemStockId); // 序列化商品库存ID 类型为uint64_t
			$bs->pushUint32_t($this->dwItemStoreHouseId); // 序列化商品仓库ID 类型为uint32_t
			$bs->pushString($this->strItemPhyisicalStorage); // 序列化商品所属物理仓 类型为std::string
			$bs->pushString($this->strItemLogo); // 序列化商品图片Logo，业务自定义 类型为std::string
			$bs->pushUint32_t($this->dwItemSnapVersion); // 序列化商品快照版本号 类型为uint32_t
			$bs->pushUint32_t($this->dwItemResetTime); // 序列化商品重置时间戳 类型为uint32_t
			$bs->pushUint32_t($this->dwItemWeight); // 序列化商品重量 类型为uint32_t
			$bs->pushUint32_t($this->dwItemVolume); // 序列化商品体积 类型为uint32_t
			$bs->pushUint64_t($this->ddwMainItemId); // 序列化商品套餐主商品ID 类型为uint64_t
			$bs->pushString($this->strItemAccessoryDesc); // 序列化商品标配说明 类型为std::string
			$bs->pushUint32_t($this->dwItemCostPrice); // 序列化商品成本价 类型为uint32_t
			$bs->pushUint32_t($this->dwItemOriginPrice); // 序列化商品市场价 类型为uint32_t
			$bs->pushUint32_t($this->dwItemSoldPrice); // 序列化商品销售单价 类型为uint32_t
			$bs->pushString($this->strItemB2CMarket); // 序列化自营B2C市场 类型为std::string
			$bs->pushString($this->strItemB2CPM); // 序列化自营B2CPM 类型为std::string
			$bs->pushUint8_t($this->cItemUseVirtualStock); // 序列化自营B2C是否占用虚库 类型为uint8_t
			$bs->pushUint32_t($this->dwBuyPrice); // 序列化商品成交价 类型为uint32_t
			$bs->pushUint32_t($this->dwBuyNum); // 序列化商品成交件数 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeTotalFee); // 序列化商品单总金额,下单金额 类型为uint32_t
			$bs->pushInt32_t($this->nTradeAdjustFee); // 序列化商品单调价金额 类型为int
			$bs->pushUint32_t($this->dwTradePayment); // 序列化实付总金额 类型为uint32_t
			$bs->pushInt32_t($this->nTradeDiscountTotal); // 序列化优惠总金额 类型为int
			$bs->pushUint32_t($this->dwPayScore); // 序列化积分支付值 类型为uint32_t
			$bs->pushUint16_t($this->wTradeOpSerialNo); // 序列化商品单库存操作序列号 类型为uint16_t
			$bs->pushUint32_t($this->dwObtainScore); // 序列化获得积分值 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeCommProperty); // 序列化通用属性值 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeBusinessProperty); // 序列化业务属性值 类型为uint32_t
			$bs->pushString($this->strWarranty); // 序列化保修条款 类型为std::string
			$bs->pushString($this->strIcsonEdmCode); // 序列化易迅edm编码 类型为std::string
			$bs->pushString($this->strIcsonOTag); // 序列化易迅OTag 类型为std::string
			$bs->pushString($this->strIcsonTradeShopGuideCost); // 序列化易迅店铺导购费用 类型为std::string
			$bs->pushString($this->strIcsonCSPhoneType); // 序列化易迅定制机类型 类型为std::string
			$bs->pushString($this->strIcsonCSPhoneOperator); // 序列化易迅定制机运营商 类型为std::string
			$bs->pushString($this->strIcsonCSPhoneNumber); // 序列化易迅定制机号码 类型为std::string
			$bs->pushString($this->strIcsonCSPhoneArea); // 序列化易迅定制机归属地 类型为std::string
			$bs->pushString($this->strIcsonCSPhonePackageId); // 序列化易迅定制机套餐id 类型为std::string
			$bs->pushString($this->strIcsonCSPhoneUserName); // 序列化易迅定制机用户姓名 类型为std::string
			$bs->pushString($this->strIcsonCSPhoneUserAddr); // 序列化易迅定制机用户地址 类型为std::string
			$bs->pushString($this->strIcsonCSPhoneUserMobile); // 序列化易迅定制机用户联系手机 类型为std::string
			$bs->pushString($this->strIcsonCSPhoneUserTel); // 序列化易迅定制机用户联系电话 类型为std::string
			$bs->pushString($this->strIcsonCSPhoneIdCardNo); // 序列化易迅定制机身份证号码 类型为std::string
			$bs->pushString($this->strIcsonCSPhoneIdCardAddr); // 序列化易迅定制机身份证地址 类型为std::string
			$bs->pushString($this->strIcsonCSPhoneIdCardDate); // 序列化易迅定制机身份证有效期 类型为std::string
			$bs->pushString($this->strIcsonCSPhoneZipCode); // 序列化易迅定制机邮政编码 类型为std::string
			$bs->pushString($this->strIcsonCSPhoneCardPrice); // 序列化易迅定制机卡价格 类型为std::string
			$bs->pushString($this->strIcsonCSPhonePackagePrice); // 序列化易迅定制机套餐价格 类型为std::string
			$bs->pushString($this->strReserve); // 序列化保留字段 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemClassId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemTitle_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemAttrCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemAttr_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemLocalCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemLocalStockCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemBarCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemStockId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemStoreHouseId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemPhyisicalStorage_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemLogo_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemSnapVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemResetTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemWeight_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemVolume_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cMainItemId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemAccessoryDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemCostPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemOriginPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemSoldPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemB2CMarket_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemB2CPM_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemUseVirtualStock_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyNum_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeTotalFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeAdjustFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradePayment_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeDiscountTotal_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayScore_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeOpSerialNo_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cObtainScore_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeCommProperty_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeBusinessProperty_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cWarranty_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonEdmCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonOTag_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonTradeShopGuideCost_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneOperator_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneNumber_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneArea_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonCSPhonePackageId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneUserName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneUserAddr_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneUserMobile_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneUserTel_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneIdCardNo_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneIdCardAddr_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneIdCardDate_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneZipCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneCardPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cIcsonCSPhonePackagePrice_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushUint64_t($this->ddwProductId); // 序列化产品id 类型为uint64_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strProductCode); // 序列化产品id编码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonTradeFlag); // 序列化易迅商品子单flag 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonPointType); // 序列化易迅积分兑换类型 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwIcsonTradeCashBack); // 序列化子单返现金额 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonUnitCostInvoice); // 序列化去税后成本 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cProductId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cProductCode_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonTradeFlag_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonPointType_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonTradeCashBack_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonUnitCostInvoice_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->dwItemType = $bs->popUint32_t(); // 反序列化商品类型；1：普通商品；2：套餐主商品；3：套餐副商品；4：赠品主商品；5：赠品副商品；6：组件 类型为uint32_t
			$this->dwItemClassId = $bs->popUint32_t(); // 反序列化品类（类目）ID 类型为uint32_t
			$this->strItemTitle = $bs->popString(); // 反序列化商品标题 类型为std::string
			$this->strItemAttrCode = $bs->popString(); // 反序列化商品销售属性编码 类型为std::string
			$this->strItemAttr = $bs->popString(); // 反序列化商品销售属性描述 类型为std::string
			$this->strItemId = $bs->popString(); // 反序列化商品显示ID，由业务定义 类型为std::string
			$this->ddwItemSkuId = $bs->popUint64_t(); // 反序列化商品SKUID 类型为uint64_t
			$this->strItemLocalCode = $bs->popString(); // 反序列化商品商家本地编码 类型为std::string
			$this->strItemLocalStockCode = $bs->popString(); // 反序列化商品商家本地库存编码 类型为std::string
			$this->strItemBarCode = $bs->popString(); // 反序列化商品条形码 类型为std::string
			$this->ddwItemStockId = $bs->popUint64_t(); // 反序列化商品库存ID 类型为uint64_t
			$this->dwItemStoreHouseId = $bs->popUint32_t(); // 反序列化商品仓库ID 类型为uint32_t
			$this->strItemPhyisicalStorage = $bs->popString(); // 反序列化商品所属物理仓 类型为std::string
			$this->strItemLogo = $bs->popString(); // 反序列化商品图片Logo，业务自定义 类型为std::string
			$this->dwItemSnapVersion = $bs->popUint32_t(); // 反序列化商品快照版本号 类型为uint32_t
			$this->dwItemResetTime = $bs->popUint32_t(); // 反序列化商品重置时间戳 类型为uint32_t
			$this->dwItemWeight = $bs->popUint32_t(); // 反序列化商品重量 类型为uint32_t
			$this->dwItemVolume = $bs->popUint32_t(); // 反序列化商品体积 类型为uint32_t
			$this->ddwMainItemId = $bs->popUint64_t(); // 反序列化商品套餐主商品ID 类型为uint64_t
			$this->strItemAccessoryDesc = $bs->popString(); // 反序列化商品标配说明 类型为std::string
			$this->dwItemCostPrice = $bs->popUint32_t(); // 反序列化商品成本价 类型为uint32_t
			$this->dwItemOriginPrice = $bs->popUint32_t(); // 反序列化商品市场价 类型为uint32_t
			$this->dwItemSoldPrice = $bs->popUint32_t(); // 反序列化商品销售单价 类型为uint32_t
			$this->strItemB2CMarket = $bs->popString(); // 反序列化自营B2C市场 类型为std::string
			$this->strItemB2CPM = $bs->popString(); // 反序列化自营B2CPM 类型为std::string
			$this->cItemUseVirtualStock = $bs->popUint8_t(); // 反序列化自营B2C是否占用虚库 类型为uint8_t
			$this->dwBuyPrice = $bs->popUint32_t(); // 反序列化商品成交价 类型为uint32_t
			$this->dwBuyNum = $bs->popUint32_t(); // 反序列化商品成交件数 类型为uint32_t
			$this->dwTradeTotalFee = $bs->popUint32_t(); // 反序列化商品单总金额,下单金额 类型为uint32_t
			$this->nTradeAdjustFee = $bs->popInt32_t(); // 反序列化商品单调价金额 类型为int
			$this->dwTradePayment = $bs->popUint32_t(); // 反序列化实付总金额 类型为uint32_t
			$this->nTradeDiscountTotal = $bs->popInt32_t(); // 反序列化优惠总金额 类型为int
			$this->dwPayScore = $bs->popUint32_t(); // 反序列化积分支付值 类型为uint32_t
			$this->wTradeOpSerialNo = $bs->popUint16_t(); // 反序列化商品单库存操作序列号 类型为uint16_t
			$this->dwObtainScore = $bs->popUint32_t(); // 反序列化获得积分值 类型为uint32_t
			$this->dwTradeCommProperty = $bs->popUint32_t(); // 反序列化通用属性值 类型为uint32_t
			$this->dwTradeBusinessProperty = $bs->popUint32_t(); // 反序列化业务属性值 类型为uint32_t
			$this->strWarranty = $bs->popString(); // 反序列化保修条款 类型为std::string
			$this->strIcsonEdmCode = $bs->popString(); // 反序列化易迅edm编码 类型为std::string
			$this->strIcsonOTag = $bs->popString(); // 反序列化易迅OTag 类型为std::string
			$this->strIcsonTradeShopGuideCost = $bs->popString(); // 反序列化易迅店铺导购费用 类型为std::string
			$this->strIcsonCSPhoneType = $bs->popString(); // 反序列化易迅定制机类型 类型为std::string
			$this->strIcsonCSPhoneOperator = $bs->popString(); // 反序列化易迅定制机运营商 类型为std::string
			$this->strIcsonCSPhoneNumber = $bs->popString(); // 反序列化易迅定制机号码 类型为std::string
			$this->strIcsonCSPhoneArea = $bs->popString(); // 反序列化易迅定制机归属地 类型为std::string
			$this->strIcsonCSPhonePackageId = $bs->popString(); // 反序列化易迅定制机套餐id 类型为std::string
			$this->strIcsonCSPhoneUserName = $bs->popString(); // 反序列化易迅定制机用户姓名 类型为std::string
			$this->strIcsonCSPhoneUserAddr = $bs->popString(); // 反序列化易迅定制机用户地址 类型为std::string
			$this->strIcsonCSPhoneUserMobile = $bs->popString(); // 反序列化易迅定制机用户联系手机 类型为std::string
			$this->strIcsonCSPhoneUserTel = $bs->popString(); // 反序列化易迅定制机用户联系电话 类型为std::string
			$this->strIcsonCSPhoneIdCardNo = $bs->popString(); // 反序列化易迅定制机身份证号码 类型为std::string
			$this->strIcsonCSPhoneIdCardAddr = $bs->popString(); // 反序列化易迅定制机身份证地址 类型为std::string
			$this->strIcsonCSPhoneIdCardDate = $bs->popString(); // 反序列化易迅定制机身份证有效期 类型为std::string
			$this->strIcsonCSPhoneZipCode = $bs->popString(); // 反序列化易迅定制机邮政编码 类型为std::string
			$this->strIcsonCSPhoneCardPrice = $bs->popString(); // 反序列化易迅定制机卡价格 类型为std::string
			$this->strIcsonCSPhonePackagePrice = $bs->popString(); // 反序列化易迅定制机套餐价格 类型为std::string
			$this->strReserve = $bs->popString(); // 反序列化保留字段 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemClassId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemTitle_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemAttrCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemAttr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemLocalCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemLocalStockCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemBarCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemStockId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemStoreHouseId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemPhyisicalStorage_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemLogo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemSnapVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemResetTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemWeight_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemVolume_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cMainItemId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemAccessoryDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemCostPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemOriginPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemSoldPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemB2CMarket_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemB2CPM_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemUseVirtualStock_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeTotalFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeAdjustFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradePayment_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeDiscountTotal_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayScore_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeOpSerialNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cObtainScore_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeCommProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeBusinessProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cWarranty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonEdmCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonOTag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonTradeShopGuideCost_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonCSPhoneType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonCSPhoneOperator_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonCSPhoneNumber_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonCSPhoneArea_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonCSPhonePackageId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonCSPhoneUserName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonCSPhoneUserAddr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonCSPhoneUserMobile_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonCSPhoneUserTel_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonCSPhoneIdCardNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonCSPhoneIdCardAddr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonCSPhoneIdCardDate_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonCSPhoneZipCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonCSPhoneCardPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cIcsonCSPhonePackagePrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserve_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$this->ddwProductId = $bs->popUint64_t(); // 反序列化产品id 类型为uint64_t
			}
			if(  $this->wVersion >= 1 ){
				$this->strProductCode = $bs->popString(); // 反序列化产品id编码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonTradeFlag = $bs->popString(); // 反序列化易迅商品子单flag 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonPointType = $bs->popString(); // 反序列化易迅积分兑换类型 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->dwIcsonTradeCashBack = $bs->popUint32_t(); // 反序列化子单返现金额 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonUnitCostInvoice = $bs->popString(); // 反序列化去税后成本 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cProductId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cProductCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonTradeFlag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonPointType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonTradeCashBack_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonUnitCostInvoice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.ecc.deal.idl.EventParamsOperGoodsBo.java

if (!class_exists('EventParamsRemoveGoodsBo')) {
class EventParamsRemoveGoodsBo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 子单id
		 *
		 * 版本 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * 子单skuid
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

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
		var $cTradeId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * 删除数量
		 *
		 * 版本 >= 1
		 */
		var $dwNum; //uint32_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cNum_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 1; // uint16_t
			 $this->ddwTradeId = 0; // uint64_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cTradeId_u = 0; // uint8_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
			 $this->dwNum = 0; // uint32_t
			 $this->cNum_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushUint64_t($this->ddwTradeId); // 序列化子单id 类型为uint64_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化子单skuid 类型为uint64_t
			$bs->pushString($this->strReserve); // 序列化保留字段 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwNum); // 序列化删除数量 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cNum_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->ddwTradeId = $bs->popUint64_t(); // 反序列化子单id 类型为uint64_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化子单skuid 类型为uint64_t
			$this->strReserve = $bs->popString(); // 反序列化保留字段 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserve_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$this->dwNum = $bs->popUint32_t(); // 反序列化删除数量 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.ecc.deal.idl.NotifyDealPaymentReq.java

if (!class_exists('EventParamsPayBo')) {
class EventParamsPayBo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 现金支付金额
		 *
		 * 版本 >= 0
		 */
		var $dwFeeCash; //uint32_t

		/**
		 * 财付通现金券支付金额
		 *
		 * 版本 >= 0
		 */
		var $dwFeeTicket; //uint32_t

		/**
		 * 折扣券支付金额
		 *
		 * 版本 >= 0
		 */
		var $dwFeeVFee; //uint32_t

		/**
		 * 积分支付金额
		 *
		 * 版本 >= 0
		 */
		var $dwFeeScore; //uint32_t

		/**
		 * 彩贝支付金额
		 *
		 * 版本 >= 0
		 */
		var $dwFeeCaibei; //uint32_t

		/**
		 * 其他支付金额
		 *
		 * 版本 >= 0
		 */
		var $dwFeeOther; //uint32_t

		/**
		 * 交易手续费，第三方支付平台或银行支付时返回
		 *
		 * 版本 >= 0
		 */
		var $dwProcedureFee; //uint32_t

		/**
		 * 支付时间
		 *
		 * 版本 >= 0
		 */
		var $dwPayTime; //uint32_t

		/**
		 * 支付单号，统一订单后台的支付单id，没有则不传
		 *
		 * 版本 >= 0
		 */
		var $ddwPayId; //uint64_t

		/**
		 * 支付订单号，如财付通单号，支付宝单号等
		 *
		 * 版本 >= 0
		 */
		var $strPayDealId; //std::string

		/**
		 * 银行类型
		 *
		 * 版本 >= 0
		 */
		var $strBankType; //std::string

		/**
		 * 他人代付帐号
		 *
		 * 版本 >= 0
		 */
		var $strOtherPayAccount; //std::string

		/**
		 * 绑定账户
		 *
		 * 版本 >= 0
		 */
		var $strBindAccount; //std::string

		/**
		 * 支付业务单号，支付系统的业务订单号
		 *
		 * 版本 >= 0
		 */
		var $strPayBusinessId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cFeeCash_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cFeeTicket_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cFeeVFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cFeeScore_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cFeeCaibei_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cFeeOther_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cProcedureFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBankType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOtherPayAccount_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBindAccount_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayBusinessId_u; //uint8_t

		/**
		 * 统一支付平台的支付单号
		 *
		 * 版本 >= 1
		 */
		var $strPaySeqId; //std::string

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cPaySeqId_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 1; // uint16_t
			 $this->dwFeeCash = 0; // uint32_t
			 $this->dwFeeTicket = 0; // uint32_t
			 $this->dwFeeVFee = 0; // uint32_t
			 $this->dwFeeScore = 0; // uint32_t
			 $this->dwFeeCaibei = 0; // uint32_t
			 $this->dwFeeOther = 0; // uint32_t
			 $this->dwProcedureFee = 0; // uint32_t
			 $this->dwPayTime = 0; // uint32_t
			 $this->ddwPayId = 0; // uint64_t
			 $this->strPayDealId = ""; // std::string
			 $this->strBankType = ""; // std::string
			 $this->strOtherPayAccount = ""; // std::string
			 $this->strBindAccount = ""; // std::string
			 $this->strPayBusinessId = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cFeeCash_u = 0; // uint8_t
			 $this->cFeeTicket_u = 0; // uint8_t
			 $this->cFeeVFee_u = 0; // uint8_t
			 $this->cFeeScore_u = 0; // uint8_t
			 $this->cFeeCaibei_u = 0; // uint8_t
			 $this->cFeeOther_u = 0; // uint8_t
			 $this->cProcedureFee_u = 0; // uint8_t
			 $this->cPayTime_u = 0; // uint8_t
			 $this->cPayId_u = 0; // uint8_t
			 $this->cPayDealId_u = 0; // uint8_t
			 $this->cBankType_u = 0; // uint8_t
			 $this->cOtherPayAccount_u = 0; // uint8_t
			 $this->cBindAccount_u = 0; // uint8_t
			 $this->cPayBusinessId_u = 0; // uint8_t
			 $this->strPaySeqId = ""; // std::string
			 $this->cPaySeqId_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushUint32_t($this->dwFeeCash); // 序列化现金支付金额 类型为uint32_t
			$bs->pushUint32_t($this->dwFeeTicket); // 序列化财付通现金券支付金额 类型为uint32_t
			$bs->pushUint32_t($this->dwFeeVFee); // 序列化折扣券支付金额 类型为uint32_t
			$bs->pushUint32_t($this->dwFeeScore); // 序列化积分支付金额 类型为uint32_t
			$bs->pushUint32_t($this->dwFeeCaibei); // 序列化彩贝支付金额 类型为uint32_t
			$bs->pushUint32_t($this->dwFeeOther); // 序列化其他支付金额 类型为uint32_t
			$bs->pushUint32_t($this->dwProcedureFee); // 序列化交易手续费，第三方支付平台或银行支付时返回 类型为uint32_t
			$bs->pushUint32_t($this->dwPayTime); // 序列化支付时间 类型为uint32_t
			$bs->pushUint64_t($this->ddwPayId); // 序列化支付单号，统一订单后台的支付单id，没有则不传 类型为uint64_t
			$bs->pushString($this->strPayDealId); // 序列化支付订单号，如财付通单号，支付宝单号等 类型为std::string
			$bs->pushString($this->strBankType); // 序列化银行类型 类型为std::string
			$bs->pushString($this->strOtherPayAccount); // 序列化他人代付帐号 类型为std::string
			$bs->pushString($this->strBindAccount); // 序列化绑定账户 类型为std::string
			$bs->pushString($this->strPayBusinessId); // 序列化支付业务单号，支付系统的业务订单号 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cFeeCash_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cFeeTicket_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cFeeVFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cFeeScore_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cFeeCaibei_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cFeeOther_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cProcedureFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBankType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOtherPayAccount_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBindAccount_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayBusinessId_u); // 序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strPaySeqId); // 序列化统一支付平台的支付单号 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cPaySeqId_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->dwFeeCash = $bs->popUint32_t(); // 反序列化现金支付金额 类型为uint32_t
			$this->dwFeeTicket = $bs->popUint32_t(); // 反序列化财付通现金券支付金额 类型为uint32_t
			$this->dwFeeVFee = $bs->popUint32_t(); // 反序列化折扣券支付金额 类型为uint32_t
			$this->dwFeeScore = $bs->popUint32_t(); // 反序列化积分支付金额 类型为uint32_t
			$this->dwFeeCaibei = $bs->popUint32_t(); // 反序列化彩贝支付金额 类型为uint32_t
			$this->dwFeeOther = $bs->popUint32_t(); // 反序列化其他支付金额 类型为uint32_t
			$this->dwProcedureFee = $bs->popUint32_t(); // 反序列化交易手续费，第三方支付平台或银行支付时返回 类型为uint32_t
			$this->dwPayTime = $bs->popUint32_t(); // 反序列化支付时间 类型为uint32_t
			$this->ddwPayId = $bs->popUint64_t(); // 反序列化支付单号，统一订单后台的支付单id，没有则不传 类型为uint64_t
			$this->strPayDealId = $bs->popString(); // 反序列化支付订单号，如财付通单号，支付宝单号等 类型为std::string
			$this->strBankType = $bs->popString(); // 反序列化银行类型 类型为std::string
			$this->strOtherPayAccount = $bs->popString(); // 反序列化他人代付帐号 类型为std::string
			$this->strBindAccount = $bs->popString(); // 反序列化绑定账户 类型为std::string
			$this->strPayBusinessId = $bs->popString(); // 反序列化支付业务单号，支付系统的业务订单号 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cFeeCash_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cFeeTicket_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cFeeVFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cFeeScore_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cFeeCaibei_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cFeeOther_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cProcedureFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBankType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOtherPayAccount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBindAccount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayBusinessId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$this->strPaySeqId = $bs->popString(); // 反序列化统一支付平台的支付单号 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cPaySeqId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.ecc.deal.idl.ModifyValueAddedTaxInvoiceReq.java

if (!class_exists('SyncValueAddedTaxInvoiceBo')) {
class SyncValueAddedTaxInvoiceBo
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 操作时间
		 *
		 * 版本 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * 操作描述
		 *
		 * 版本 >= 0
		 */
		var $strOperationDesc; //std::string

		/**
		 * 公司名称
		 *
		 * 版本 >= 0
		 */
		var $strCompanyName; //std::string

		/**
		 * 公司地址
		 *
		 * 版本 >= 0
		 */
		var $strCompanyAddr; //std::string

		/**
		 * 公司电话
		 *
		 * 版本 >= 0
		 */
		var $strCompanyPhone; //std::string

		/**
		 * 税号
		 *
		 * 版本 >= 0
		 */
		var $strCompanyTaxNo; //std::string

		/**
		 * 银行账户
		 *
		 * 版本 >= 0
		 */
		var $strBankAccount; //std::string

		/**
		 * 银行信息
		 *
		 * 版本 >= 0
		 */
		var $strBankInfo; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperationDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCompanyName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCompanyAddr_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCompanyPhone_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCompanyTaxNo_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBankAccount_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBankInfo_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->dwOperateTime = 0; // uint32_t
			 $this->strOperationDesc = ""; // std::string
			 $this->strCompanyName = ""; // std::string
			 $this->strCompanyAddr = ""; // std::string
			 $this->strCompanyPhone = ""; // std::string
			 $this->strCompanyTaxNo = ""; // std::string
			 $this->strBankAccount = ""; // std::string
			 $this->strBankInfo = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cOperateTime_u = 0; // uint8_t
			 $this->cOperationDesc_u = 0; // uint8_t
			 $this->cCompanyName_u = 0; // uint8_t
			 $this->cCompanyAddr_u = 0; // uint8_t
			 $this->cCompanyPhone_u = 0; // uint8_t
			 $this->cCompanyTaxNo_u = 0; // uint8_t
			 $this->cBankAccount_u = 0; // uint8_t
			 $this->cBankInfo_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化版本号 类型为uint16_t
			$bs->pushUint32_t($this->dwOperateTime); // 序列化操作时间 类型为uint32_t
			$bs->pushString($this->strOperationDesc); // 序列化操作描述 类型为std::string
			$bs->pushString($this->strCompanyName); // 序列化公司名称 类型为std::string
			$bs->pushString($this->strCompanyAddr); // 序列化公司地址 类型为std::string
			$bs->pushString($this->strCompanyPhone); // 序列化公司电话 类型为std::string
			$bs->pushString($this->strCompanyTaxNo); // 序列化税号 类型为std::string
			$bs->pushString($this->strBankAccount); // 序列化银行账户 类型为std::string
			$bs->pushString($this->strBankInfo); // 序列化银行信息 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperationDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCompanyName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCompanyAddr_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCompanyPhone_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCompanyTaxNo_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBankAccount_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBankInfo_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化版本号 类型为uint16_t
			$this->dwOperateTime = $bs->popUint32_t(); // 反序列化操作时间 类型为uint32_t
			$this->strOperationDesc = $bs->popString(); // 反序列化操作描述 类型为std::string
			$this->strCompanyName = $bs->popString(); // 反序列化公司名称 类型为std::string
			$this->strCompanyAddr = $bs->popString(); // 反序列化公司地址 类型为std::string
			$this->strCompanyPhone = $bs->popString(); // 反序列化公司电话 类型为std::string
			$this->strCompanyTaxNo = $bs->popString(); // 反序列化税号 类型为std::string
			$this->strBankAccount = $bs->popString(); // 反序列化银行账户 类型为std::string
			$this->strBankInfo = $bs->popString(); // 反序列化银行信息 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperationDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCompanyName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCompanyAddr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCompanyPhone_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCompanyTaxNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBankAccount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBankInfo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.ecc.deal.idl.ModifySeparateInvoiceReq.java

if (!class_exists('SyncSeparateInvoiceBo')) {
class SyncSeparateInvoiceBo
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 操作时间
		 *
		 * 版本 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * 操作描述
		 *
		 * 版本 >= 0
		 */
		var $strOperationDesc; //std::string

		/**
		 * 运送方式
		 *
		 * 版本 >= 0
		 */
		var $dwShipType; //uint32_t

		/**
		 * 收货地址id
		 *
		 * 版本 >= 0
		 */
		var $dwRecvRegionId; //uint32_t

		/**
		 * 收货地址
		 *
		 * 版本 >= 0
		 */
		var $strRecvAddr; //std::string

		/**
		 * 收货人
		 *
		 * 版本 >= 0
		 */
		var $strRecvName; //std::string

		/**
		 * 收货人手机
		 *
		 * 版本 >= 0
		 */
		var $strRecvMobile; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperationDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cShipType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvRegionId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvAddr_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvMobile_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->dwOperateTime = 0; // uint32_t
			 $this->strOperationDesc = ""; // std::string
			 $this->dwShipType = 0; // uint32_t
			 $this->dwRecvRegionId = 0; // uint32_t
			 $this->strRecvAddr = ""; // std::string
			 $this->strRecvName = ""; // std::string
			 $this->strRecvMobile = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cOperateTime_u = 0; // uint8_t
			 $this->cOperationDesc_u = 0; // uint8_t
			 $this->cShipType_u = 0; // uint8_t
			 $this->cRecvRegionId_u = 0; // uint8_t
			 $this->cRecvAddr_u = 0; // uint8_t
			 $this->cRecvName_u = 0; // uint8_t
			 $this->cRecvMobile_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化版本号 类型为uint16_t
			$bs->pushUint32_t($this->dwOperateTime); // 序列化操作时间 类型为uint32_t
			$bs->pushString($this->strOperationDesc); // 序列化操作描述 类型为std::string
			$bs->pushUint32_t($this->dwShipType); // 序列化运送方式 类型为uint32_t
			$bs->pushUint32_t($this->dwRecvRegionId); // 序列化收货地址id 类型为uint32_t
			$bs->pushString($this->strRecvAddr); // 序列化收货地址 类型为std::string
			$bs->pushString($this->strRecvName); // 序列化收货人 类型为std::string
			$bs->pushString($this->strRecvMobile); // 序列化收货人手机 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperationDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cShipType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvRegionId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvAddr_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvMobile_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化版本号 类型为uint16_t
			$this->dwOperateTime = $bs->popUint32_t(); // 反序列化操作时间 类型为uint32_t
			$this->strOperationDesc = $bs->popString(); // 反序列化操作描述 类型为std::string
			$this->dwShipType = $bs->popUint32_t(); // 反序列化运送方式 类型为uint32_t
			$this->dwRecvRegionId = $bs->popUint32_t(); // 反序列化收货地址id 类型为uint32_t
			$this->strRecvAddr = $bs->popString(); // 反序列化收货地址 类型为std::string
			$this->strRecvName = $bs->popString(); // 反序列化收货人 类型为std::string
			$this->strRecvMobile = $bs->popString(); // 反序列化收货人手机 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperationDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cShipType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvRegionId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvAddr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvMobile_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.ecc.deal.idl.ModifyScoreReq.java

if (!class_exists('EventParamsModifyScoreBo')) {
class EventParamsModifyScoreBo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 操作时间
		 *
		 * 版本 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * 使用积分值，指的是积分兑换金额，单位为分
		 *
		 * 版本 >= 0
		 */
		var $dwPayScore; //uint32_t

		/**
		 * 描述
		 *
		 * 版本 >= 0
		 */
		var $strOperateDesc; //std::string

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
		var $cOperateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayScore_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperateDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * 现金积分，金额单位是分
		 *
		 * 版本 >= 1
		 */
		var $dwCashScore; //uint32_t

		/**
		 * 促销积分，金额单位是分
		 *
		 * 版本 >= 1
		 */
		var $dwPromotionScore; //uint32_t

		/**
		 * 获得积分
		 *
		 * 版本 >= 1
		 */
		var $dwPointObtain; //uint32_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $dwCashScore_u; //uint32_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $dwPromotionScore_u; //uint32_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cPointObtain_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 1; // uint16_t
			 $this->dwOperateTime = 0; // uint32_t
			 $this->dwPayScore = 0; // uint32_t
			 $this->strOperateDesc = ""; // std::string
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cOperateTime_u = 0; // uint8_t
			 $this->cPayScore_u = 0; // uint8_t
			 $this->cOperateDesc_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
			 $this->dwCashScore = 0; // uint32_t
			 $this->dwPromotionScore = 0; // uint32_t
			 $this->dwPointObtain = 0; // uint32_t
			 $this->dwCashScore_u = 0; // uint32_t
			 $this->dwPromotionScore_u = 0; // uint32_t
			 $this->cPointObtain_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushUint32_t($this->dwOperateTime); // 序列化操作时间 类型为uint32_t
			$bs->pushUint32_t($this->dwPayScore); // 序列化使用积分值，指的是积分兑换金额，单位为分 类型为uint32_t
			$bs->pushString($this->strOperateDesc); // 序列化描述 类型为std::string
			$bs->pushString($this->strReserve); // 序列化保留字段 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayScore_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperateDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwCashScore); // 序列化现金积分，金额单位是分 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwPromotionScore); // 序列化促销积分，金额单位是分 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwPointObtain); // 序列化获得积分 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwCashScore_u); // 序列化 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwPromotionScore_u); // 序列化 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cPointObtain_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->dwOperateTime = $bs->popUint32_t(); // 反序列化操作时间 类型为uint32_t
			$this->dwPayScore = $bs->popUint32_t(); // 反序列化使用积分值，指的是积分兑换金额，单位为分 类型为uint32_t
			$this->strOperateDesc = $bs->popString(); // 反序列化描述 类型为std::string
			$this->strReserve = $bs->popString(); // 反序列化保留字段 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayScore_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperateDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserve_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$this->dwCashScore = $bs->popUint32_t(); // 反序列化现金积分，金额单位是分 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->dwPromotionScore = $bs->popUint32_t(); // 反序列化促销积分，金额单位是分 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->dwPointObtain = $bs->popUint32_t(); // 反序列化获得积分 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->dwCashScore_u = $bs->popUint32_t(); // 反序列化 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->dwPromotionScore_u = $bs->popUint32_t(); // 反序列化 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cPointObtain_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.ecc.deal.idl.ModifyReceiveInfoReq.java

if (!class_exists('EventParamsModifyRecvInfoBo')) {
class EventParamsModifyRecvInfoBo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 操作时间
		 *
		 * 版本 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * 收货地址区域id(国标:网购拍拍)
		 *
		 * 版本 >= 0
		 */
		var $dwRegionCodeGB; //uint32_t

		/**
		 * 收货地址区域id(国标细化:易迅)
		 *
		 * 版本 >= 0
		 */
		var $dwRegionCodeGBD; //uint32_t

		/**
		 * 收货地址
		 *
		 * 版本 >= 0
		 */
		var $strRecvAddress; //std::string

		/**
		 * 邮编
		 *
		 * 版本 >= 0
		 */
		var $strRecvPostcode; //std::string

		/**
		 * 联系人
		 *
		 * 版本 >= 0
		 */
		var $strRecvName; //std::string

		/**
		 * 联系手机
		 *
		 * 版本 >= 0
		 */
		var $ddwRecvMobile; //uint64_t

		/**
		 * 联系电话
		 *
		 * 版本 >= 0
		 */
		var $strRecvPhone; //std::string

		/**
		 * 描述
		 *
		 * 版本 >= 0
		 */
		var $strOperateDesc; //std::string

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
		var $cOperateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRegionCodeGB_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRegionCodeGBD_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvAddress_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvPostcode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvMobile_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvPhone_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperateDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * 业务定义的配送方式，如易迅配送方式等
		 *
		 * 版本 >= 1
		 */
		var $dwBizShipType; //uint32_t

		/**
		 * 统一订单配送方式，统一订单定义
		 *
		 * 版本 >= 1
		 */
		var $dwUnpShipType; //uint32_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cBizShipType_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cUnpShipType_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 1; // uint16_t
			 $this->dwOperateTime = 0; // uint32_t
			 $this->dwRegionCodeGB = 0; // uint32_t
			 $this->dwRegionCodeGBD = 0; // uint32_t
			 $this->strRecvAddress = ""; // std::string
			 $this->strRecvPostcode = ""; // std::string
			 $this->strRecvName = ""; // std::string
			 $this->ddwRecvMobile = 0; // uint64_t
			 $this->strRecvPhone = ""; // std::string
			 $this->strOperateDesc = ""; // std::string
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cOperateTime_u = 0; // uint8_t
			 $this->cRegionCodeGB_u = 0; // uint8_t
			 $this->cRegionCodeGBD_u = 0; // uint8_t
			 $this->cRecvAddress_u = 0; // uint8_t
			 $this->cRecvPostcode_u = 0; // uint8_t
			 $this->cRecvName_u = 0; // uint8_t
			 $this->cRecvMobile_u = 0; // uint8_t
			 $this->cRecvPhone_u = 0; // uint8_t
			 $this->cOperateDesc_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
			 $this->dwBizShipType = 0; // uint32_t
			 $this->dwUnpShipType = 0; // uint32_t
			 $this->cBizShipType_u = 0; // uint8_t
			 $this->cUnpShipType_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushUint32_t($this->dwOperateTime); // 序列化操作时间 类型为uint32_t
			$bs->pushUint32_t($this->dwRegionCodeGB); // 序列化收货地址区域id(国标:网购拍拍) 类型为uint32_t
			$bs->pushUint32_t($this->dwRegionCodeGBD); // 序列化收货地址区域id(国标细化:易迅) 类型为uint32_t
			$bs->pushString($this->strRecvAddress); // 序列化收货地址 类型为std::string
			$bs->pushString($this->strRecvPostcode); // 序列化邮编 类型为std::string
			$bs->pushString($this->strRecvName); // 序列化联系人 类型为std::string
			$bs->pushUint64_t($this->ddwRecvMobile); // 序列化联系手机 类型为uint64_t
			$bs->pushString($this->strRecvPhone); // 序列化联系电话 类型为std::string
			$bs->pushString($this->strOperateDesc); // 序列化描述 类型为std::string
			$bs->pushString($this->strReserve); // 序列化保留字段 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRegionCodeGB_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRegionCodeGBD_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvAddress_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvPostcode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvMobile_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvPhone_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperateDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwBizShipType); // 序列化业务定义的配送方式，如易迅配送方式等 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwUnpShipType); // 序列化统一订单配送方式，统一订单定义 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cBizShipType_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cUnpShipType_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->dwOperateTime = $bs->popUint32_t(); // 反序列化操作时间 类型为uint32_t
			$this->dwRegionCodeGB = $bs->popUint32_t(); // 反序列化收货地址区域id(国标:网购拍拍) 类型为uint32_t
			$this->dwRegionCodeGBD = $bs->popUint32_t(); // 反序列化收货地址区域id(国标细化:易迅) 类型为uint32_t
			$this->strRecvAddress = $bs->popString(); // 反序列化收货地址 类型为std::string
			$this->strRecvPostcode = $bs->popString(); // 反序列化邮编 类型为std::string
			$this->strRecvName = $bs->popString(); // 反序列化联系人 类型为std::string
			$this->ddwRecvMobile = $bs->popUint64_t(); // 反序列化联系手机 类型为uint64_t
			$this->strRecvPhone = $bs->popString(); // 反序列化联系电话 类型为std::string
			$this->strOperateDesc = $bs->popString(); // 反序列化描述 类型为std::string
			$this->strReserve = $bs->popString(); // 反序列化保留字段 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRegionCodeGB_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRegionCodeGBD_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvAddress_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvPostcode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvMobile_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvPhone_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperateDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserve_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$this->dwBizShipType = $bs->popUint32_t(); // 反序列化业务定义的配送方式，如易迅配送方式等 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->dwUnpShipType = $bs->popUint32_t(); // 反序列化统一订单配送方式，统一订单定义 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cBizShipType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cUnpShipType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.ecc.deal.idl.ModifyPayTypeReq.java

if (!class_exists('EventParamsModifyPayTypeBo')) {
class EventParamsModifyPayTypeBo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 操作时间
		 *
		 * 版本 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * 支付方式
		 *
		 * 版本 >= 0
		 */
		var $dwPayType; //uint32_t

		/**
		 * 支付方式名称
		 *
		 * 版本 >= 0
		 */
		var $strPayTypeName; //std::string

		/**
		 * 描述
		 *
		 * 版本 >= 0
		 */
		var $strOperateDesc; //std::string

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
		var $cOperateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayTypeName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperateDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->dwOperateTime = 0; // uint32_t
			 $this->dwPayType = 0; // uint32_t
			 $this->strPayTypeName = ""; // std::string
			 $this->strOperateDesc = ""; // std::string
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cOperateTime_u = 0; // uint8_t
			 $this->cPayType_u = 0; // uint8_t
			 $this->cPayTypeName_u = 0; // uint8_t
			 $this->cOperateDesc_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushUint32_t($this->dwOperateTime); // 序列化操作时间 类型为uint32_t
			$bs->pushUint32_t($this->dwPayType); // 序列化支付方式 类型为uint32_t
			$bs->pushString($this->strPayTypeName); // 序列化支付方式名称 类型为std::string
			$bs->pushString($this->strOperateDesc); // 序列化描述 类型为std::string
			$bs->pushString($this->strReserve); // 序列化保留字段 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayTypeName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperateDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->dwOperateTime = $bs->popUint32_t(); // 反序列化操作时间 类型为uint32_t
			$this->dwPayType = $bs->popUint32_t(); // 反序列化支付方式 类型为uint32_t
			$this->strPayTypeName = $bs->popString(); // 反序列化支付方式名称 类型为std::string
			$this->strOperateDesc = $bs->popString(); // 反序列化描述 类型为std::string
			$this->strReserve = $bs->popString(); // 反序列化保留字段 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayTypeName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperateDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.ecc.deal.idl.ModifyInvoiceReq.java

if (!class_exists('EventParamsModifyInvoiceBo')) {
class EventParamsModifyInvoiceBo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 操作时间，必填
		 *
		 * 版本 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * 发票类型，必填
		 *
		 * 版本 >= 0
		 */
		var $cInvoiceType; //uint8_t

		/**
		 * 发票抬头
		 *
		 * 版本 >= 0
		 */
		var $strInvoiceHead; //std::string

		/**
		 * 发票内容
		 *
		 * 版本 >= 0
		 */
		var $strInvoiceContent; //std::string

		/**
		 * 描述
		 *
		 * 版本 >= 0
		 */
		var $strOperateDesc; //std::string

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
		var $cOperateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cInvoiceType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cInvoiceHead_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cInvoiceContent_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperateDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * 是否模糊开票，必填
		 *
		 * 版本 >= 1
		 */
		var $cIsBlurry; //uint8_t

		/**
		 * 是否自动开票，必填
		 *
		 * 版本 >= 1
		 */
		var $cIsVat; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIsBlurry_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIsVat_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 1; // uint16_t
			 $this->dwOperateTime = 0; // uint32_t
			 $this->cInvoiceType = 0; // uint8_t
			 $this->strInvoiceHead = ""; // std::string
			 $this->strInvoiceContent = ""; // std::string
			 $this->strOperateDesc = ""; // std::string
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cOperateTime_u = 0; // uint8_t
			 $this->cInvoiceType_u = 0; // uint8_t
			 $this->cInvoiceHead_u = 0; // uint8_t
			 $this->cInvoiceContent_u = 0; // uint8_t
			 $this->cOperateDesc_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
			 $this->cIsBlurry = 0; // uint8_t
			 $this->cIsVat = 0; // uint8_t
			 $this->cIsBlurry_u = 0; // uint8_t
			 $this->cIsVat_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushUint32_t($this->dwOperateTime); // 序列化操作时间，必填 类型为uint32_t
			$bs->pushUint8_t($this->cInvoiceType); // 序列化发票类型，必填 类型为uint8_t
			$bs->pushString($this->strInvoiceHead); // 序列化发票抬头 类型为std::string
			$bs->pushString($this->strInvoiceContent); // 序列化发票内容 类型为std::string
			$bs->pushString($this->strOperateDesc); // 序列化描述 类型为std::string
			$bs->pushString($this->strReserve); // 序列化保留字段 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cInvoiceType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cInvoiceHead_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cInvoiceContent_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperateDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIsBlurry); // 序列化是否模糊开票，必填 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIsVat); // 序列化是否自动开票，必填 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIsBlurry_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIsVat_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->dwOperateTime = $bs->popUint32_t(); // 反序列化操作时间，必填 类型为uint32_t
			$this->cInvoiceType = $bs->popUint8_t(); // 反序列化发票类型，必填 类型为uint8_t
			$this->strInvoiceHead = $bs->popString(); // 反序列化发票抬头 类型为std::string
			$this->strInvoiceContent = $bs->popString(); // 反序列化发票内容 类型为std::string
			$this->strOperateDesc = $bs->popString(); // 反序列化描述 类型为std::string
			$this->strReserve = $bs->popString(); // 反序列化保留字段 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cInvoiceType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cInvoiceHead_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cInvoiceContent_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperateDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserve_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$this->cIsBlurry = $bs->popUint8_t(); // 反序列化是否模糊开票，必填 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIsVat = $bs->popUint8_t(); // 反序列化是否自动开票，必填 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIsBlurry_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIsVat_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.ecc.deal.idl.ModifyCouponReq.java

if (!class_exists('EventParamsModifyCouponBo')) {
class EventParamsModifyCouponBo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 操作时间
		 *
		 * 版本 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * 优惠类型
		 *
		 * 版本 >= 0
		 */
		var $dwCouponType; //uint32_t

		/**
		 * 优惠金额
		 *
		 * 版本 >= 0
		 */
		var $dwCouponFee; //uint32_t

		/**
		 * 规则id
		 *
		 * 版本 >= 0
		 */
		var $dwRuleId; //uint32_t

		/**
		 * 活动编号，如无则不填
		 *
		 * 版本 >= 0
		 */
		var $ddwActiveNo; //uint64_t

		/**
		 * 优惠券编码
		 *
		 * 版本 >= 0
		 */
		var $strCouponCode; //std::string

		/**
		 * 描述
		 *
		 * 版本 >= 0
		 */
		var $strOperateDesc; //std::string

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
		var $cOperateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCouponType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCouponFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRuleId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cActiveNo_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCouponCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOperateDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->dwOperateTime = 0; // uint32_t
			 $this->dwCouponType = 0; // uint32_t
			 $this->dwCouponFee = 0; // uint32_t
			 $this->dwRuleId = 0; // uint32_t
			 $this->ddwActiveNo = 0; // uint64_t
			 $this->strCouponCode = ""; // std::string
			 $this->strOperateDesc = ""; // std::string
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cOperateTime_u = 0; // uint8_t
			 $this->cCouponType_u = 0; // uint8_t
			 $this->cCouponFee_u = 0; // uint8_t
			 $this->cRuleId_u = 0; // uint8_t
			 $this->cActiveNo_u = 0; // uint8_t
			 $this->cCouponCode_u = 0; // uint8_t
			 $this->cOperateDesc_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushUint32_t($this->dwOperateTime); // 序列化操作时间 类型为uint32_t
			$bs->pushUint32_t($this->dwCouponType); // 序列化优惠类型 类型为uint32_t
			$bs->pushUint32_t($this->dwCouponFee); // 序列化优惠金额 类型为uint32_t
			$bs->pushUint32_t($this->dwRuleId); // 序列化规则id 类型为uint32_t
			$bs->pushUint64_t($this->ddwActiveNo); // 序列化活动编号，如无则不填 类型为uint64_t
			$bs->pushString($this->strCouponCode); // 序列化优惠券编码 类型为std::string
			$bs->pushString($this->strOperateDesc); // 序列化描述 类型为std::string
			$bs->pushString($this->strReserve); // 序列化保留字段 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCouponType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCouponFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRuleId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cActiveNo_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCouponCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperateDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->dwOperateTime = $bs->popUint32_t(); // 反序列化操作时间 类型为uint32_t
			$this->dwCouponType = $bs->popUint32_t(); // 反序列化优惠类型 类型为uint32_t
			$this->dwCouponFee = $bs->popUint32_t(); // 反序列化优惠金额 类型为uint32_t
			$this->dwRuleId = $bs->popUint32_t(); // 反序列化规则id 类型为uint32_t
			$this->ddwActiveNo = $bs->popUint64_t(); // 反序列化活动编号，如无则不填 类型为uint64_t
			$this->strCouponCode = $bs->popString(); // 反序列化优惠券编码 类型为std::string
			$this->strOperateDesc = $bs->popString(); // 反序列化描述 类型为std::string
			$this->strReserve = $bs->popString(); // 反序列化保留字段 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCouponType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCouponFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRuleId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cActiveNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCouponCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperateDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.ecc.deal.idl.MarkShipReq.java

if (!class_exists('EventParamsCorpShipBo')) {
class EventParamsCorpShipBo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 发货（出库）时间
		 *
		 * 版本 >= 0
		 */
		var $dwSendTime; //uint32_t

		/**
		 * 物流公司id
		 *
		 * 版本 >= 0
		 */
		var $strWuliuCompanyId; //std::string

		/**
		 * 物流公司名称
		 *
		 * 版本 >= 0
		 */
		var $strWuliuCompanyName; //std::string

		/**
		 * 物流运单号
		 *
		 * 版本 >= 0
		 */
		var $strWuliuCode; //std::string

		/**
		 * 运送方式
		 *
		 * 版本 >= 0
		 */
		var $dwShipType; //uint32_t

		/**
		 * 发货（出库）描述
		 *
		 * 版本 >= 0
		 */
		var $strSendDesc; //std::string

		/**
		 * 修改成本价，如果不涉及修改成本价，请将vector置空
		 *
		 * 版本 >= 0
		 */
		var $vecModifyCostPriceList; //std::vector<ecc::deal::bo::CEventParamsCorpModifyTradeBo> 

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
		var $cSendTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cWuliuCompanyId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cWuliuCompanyName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cWuliuCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cShipType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSendDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cModifyCostPriceList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->dwSendTime = 0; // uint32_t
			 $this->strWuliuCompanyId = ""; // std::string
			 $this->strWuliuCompanyName = ""; // std::string
			 $this->strWuliuCode = ""; // std::string
			 $this->dwShipType = 0; // uint32_t
			 $this->strSendDesc = ""; // std::string
			 $this->vecModifyCostPriceList = new stl_vector('EventParamsCorpModifyTradeBo'); // std::vector<ecc::deal::bo::CEventParamsCorpModifyTradeBo> 
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cSendTime_u = 0; // uint8_t
			 $this->cWuliuCompanyId_u = 0; // uint8_t
			 $this->cWuliuCompanyName_u = 0; // uint8_t
			 $this->cWuliuCode_u = 0; // uint8_t
			 $this->cShipType_u = 0; // uint8_t
			 $this->cSendDesc_u = 0; // uint8_t
			 $this->cModifyCostPriceList_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushUint32_t($this->dwSendTime); // 序列化发货（出库）时间 类型为uint32_t
			$bs->pushString($this->strWuliuCompanyId); // 序列化物流公司id 类型为std::string
			$bs->pushString($this->strWuliuCompanyName); // 序列化物流公司名称 类型为std::string
			$bs->pushString($this->strWuliuCode); // 序列化物流运单号 类型为std::string
			$bs->pushUint32_t($this->dwShipType); // 序列化运送方式 类型为uint32_t
			$bs->pushString($this->strSendDesc); // 序列化发货（出库）描述 类型为std::string
			$bs->pushObject($this->vecModifyCostPriceList,'stl_vector'); // 序列化修改成本价，如果不涉及修改成本价，请将vector置空 类型为std::vector<ecc::deal::bo::CEventParamsCorpModifyTradeBo> 
			$bs->pushString($this->strReserve); // 序列化保留字段 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSendTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cWuliuCompanyId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cWuliuCompanyName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cWuliuCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cShipType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSendDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cModifyCostPriceList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->dwSendTime = $bs->popUint32_t(); // 反序列化发货（出库）时间 类型为uint32_t
			$this->strWuliuCompanyId = $bs->popString(); // 反序列化物流公司id 类型为std::string
			$this->strWuliuCompanyName = $bs->popString(); // 反序列化物流公司名称 类型为std::string
			$this->strWuliuCode = $bs->popString(); // 反序列化物流运单号 类型为std::string
			$this->dwShipType = $bs->popUint32_t(); // 反序列化运送方式 类型为uint32_t
			$this->strSendDesc = $bs->popString(); // 反序列化发货（出库）描述 类型为std::string
			$this->vecModifyCostPriceList = $bs->popObject('stl_vector<EventParamsCorpModifyTradeBo>'); // 反序列化修改成本价，如果不涉及修改成本价，请将vector置空 类型为std::vector<ecc::deal::bo::CEventParamsCorpModifyTradeBo> 
			$this->strReserve = $bs->popString(); // 反序列化保留字段 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSendTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cWuliuCompanyId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cWuliuCompanyName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cWuliuCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cShipType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSendDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cModifyCostPriceList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.ecc.deal.idl.CreateRefundReq.java

if (!class_exists('EventParamsCorpCreateRefundBo')) {
class EventParamsCorpCreateRefundBo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 订单id
		 *
		 * 版本 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * 子单id, 如果没有子单（商品）维度信息，可不填
		 *
		 * 版本 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * 商品skuid, 如果没有子单（商品）维度信息，可不填
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 退款类型
		 *
		 * 版本 >= 0
		 */
		var $dwRefundType; //uint32_t

		/**
		 * 退款原因类型
		 *
		 * 版本 >= 0
		 */
		var $dwRefundReasonType; //uint32_t

		/**
		 * 退款原因描述
		 *
		 * 版本 >= 0
		 */
		var $strRefundReasonDesc; //std::string

		/**
		 * 退款给买家金额
		 *
		 * 版本 >= 0
		 */
		var $dwBuyerRefundFee; //uint32_t

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
		var $cDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundReasonType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRefundReasonDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerRefundFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * 业务退款单id
		 *
		 * 版本 >= 1
		 */
		var $strBusinessRefundId; //std::string

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cBusinessRefundId_u; //uint8_t

		/**
		 * 退款/退货数量
		 *
		 * 版本 >= 2
		 */
		var $dwNum; //uint32_t

		/**
		 * 
		 *
		 * 版本 >= 2
		 */
		var $cNum_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 2; // uint16_t
			 $this->strDealId = ""; // std::string
			 $this->ddwTradeId = 0; // uint64_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->dwRefundType = 0; // uint32_t
			 $this->dwRefundReasonType = 0; // uint32_t
			 $this->strRefundReasonDesc = ""; // std::string
			 $this->dwBuyerRefundFee = 0; // uint32_t
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cDealId_u = 0; // uint8_t
			 $this->cTradeId_u = 0; // uint8_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->cRefundType_u = 0; // uint8_t
			 $this->cRefundReasonType_u = 0; // uint8_t
			 $this->cRefundReasonDesc_u = 0; // uint8_t
			 $this->cBuyerRefundFee_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
			 $this->strBusinessRefundId = ""; // std::string
			 $this->cBusinessRefundId_u = 0; // uint8_t
			 $this->dwNum = 0; // uint32_t
			 $this->cNum_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushString($this->strDealId); // 序列化订单id 类型为std::string
			$bs->pushUint64_t($this->ddwTradeId); // 序列化子单id, 如果没有子单（商品）维度信息，可不填 类型为uint64_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化商品skuid, 如果没有子单（商品）维度信息，可不填 类型为uint64_t
			$bs->pushUint32_t($this->dwRefundType); // 序列化退款类型 类型为uint32_t
			$bs->pushUint32_t($this->dwRefundReasonType); // 序列化退款原因类型 类型为uint32_t
			$bs->pushString($this->strRefundReasonDesc); // 序列化退款原因描述 类型为std::string
			$bs->pushUint32_t($this->dwBuyerRefundFee); // 序列化退款给买家金额 类型为uint32_t
			$bs->pushString($this->strReserve); // 序列化保留字段 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundReasonType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRefundReasonDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerRefundFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strBusinessRefundId); // 序列化业务退款单id 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cBusinessRefundId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwNum); // 序列化退款/退货数量 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cNum_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->strDealId = $bs->popString(); // 反序列化订单id 类型为std::string
			$this->ddwTradeId = $bs->popUint64_t(); // 反序列化子单id, 如果没有子单（商品）维度信息，可不填 类型为uint64_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化商品skuid, 如果没有子单（商品）维度信息，可不填 类型为uint64_t
			$this->dwRefundType = $bs->popUint32_t(); // 反序列化退款类型 类型为uint32_t
			$this->dwRefundReasonType = $bs->popUint32_t(); // 反序列化退款原因类型 类型为uint32_t
			$this->strRefundReasonDesc = $bs->popString(); // 反序列化退款原因描述 类型为std::string
			$this->dwBuyerRefundFee = $bs->popUint32_t(); // 反序列化退款给买家金额 类型为uint32_t
			$this->strReserve = $bs->popString(); // 反序列化保留字段 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundReasonType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRefundReasonDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerRefundFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserve_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$this->strBusinessRefundId = $bs->popString(); // 反序列化业务退款单id 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cBusinessRefundId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwNum = $bs->popUint32_t(); // 反序列化退款/退货数量 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.ecc.deal.idl.CreateDealReq.java

if (!class_exists('OrderPo')) {
class OrderPo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702，可为空
		 *
		 * 版本 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * 订单单号，拍拍订单同步可使用，可为空
		 *
		 * 版本 >= 0
		 */
		var $ddwDealId64; //uint64_t

		/**
		 * 交易单号，可为空
		 *
		 * 版本 >= 0
		 */
		var $ddwBdealId; //uint64_t

		/**
		 * 业务订单编号，第三方托管订单
		 *
		 * 版本 >= 0
		 */
		var $strBusinessDealId; //std::string

		/**
		 * 买家ID
		 *
		 * 版本 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * 买家帐号
		 *
		 * 版本 >= 0
		 */
		var $strBuyerAccount; //std::string

		/**
		 * 买家姓名
		 *
		 * 版本 >= 0
		 */
		var $strBuyerNickName; //std::string

		/**
		 * 买家昵称
		 *
		 * 版本 >= 0
		 */
		var $strBuyerNick; //std::string

		/**
		 * 商家ID
		 *
		 * 版本 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * 商家真实名称
		 *
		 * 版本 >= 0
		 */
		var $strSellerTitle; //std::string

		/**
		 * 卖家昵称
		 *
		 * 版本 >= 0
		 */
		var $strSellerNick; //std::string

		/**
		 * 业务ID
		 *
		 * 版本 >= 0
		 */
		var $dwBusinessId; //uint32_t

		/**
		 * 订单类型
		 *
		 * 版本 >= 0
		 */
		var $cDealType; //uint8_t

		/**
		 * 下单渠道：1：业务主站；2：移动app；3：移动wap
		 *
		 * 版本 >= 0
		 */
		var $dwDealSource; //uint32_t

		/**
		 * 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款
		 *
		 * 版本 >= 0
		 */
		var $cDealPayType; //uint8_t

		/**
		 * 订单状态
		 *
		 * 版本 >= 0
		 */
		var $dwDealState; //uint32_t

		/**
		 * 订单属性值，通用
		 *
		 * 版本 >= 0
		 */
		var $dwDealProperty; //uint32_t

		/**
		 * 订单属性值，业务1扩展用
		 *
		 * 版本 >= 0
		 */
		var $dwDealProperty1; //uint32_t

		/**
		 * 订单属性值，业务2扩展用
		 *
		 * 版本 >= 0
		 */
		var $dwDealProperty2; //uint32_t

		/**
		 * 订单属性值，业务3扩展用
		 *
		 * 版本 >= 0
		 */
		var $dwDealProperty3; //uint32_t

		/**
		 * 订单属性值，业务4扩展用
		 *
		 * 版本 >= 0
		 */
		var $dwDealProperty4; //uint32_t

		/**
		 * 商品skuID列表
		 *
		 * 版本 >= 0
		 */
		var $strItemSkuidList; //std::string

		/**
		 * 商品标题列表
		 *
		 * 版本 >= 0
		 */
		var $strItemTitleList; //std::string

		/**
		 * 订单总金额,下单金额
		 *
		 * 版本 >= 0
		 */
		var $dwDealTotalFee; //uint32_t

		/**
		 * 调价金额
		 *
		 * 版本 >= 0
		 */
		var $nDealAdjustFee; //int

		/**
		 * 实付总金额
		 *
		 * 版本 >= 0
		 */
		var $dwDealPayment; //uint32_t

		/**
		 * C2B预售定金金额
		 *
		 * 版本 >= 0
		 */
		var $dwDealDownPayment; //uint32_t

		/**
		 * 优惠总金额; 活动列表优惠金额汇总
		 *
		 * 版本 >= 0
		 */
		var $nDealDiscountTotal; //int

		/**
		 * 商品子单总金额
		 *
		 * 版本 >= 0
		 */
		var $dwDealItemTotalFee; //uint32_t

		/**
		 * 谁支付邮费，1：卖家；2：买家
		 *
		 * 版本 >= 0
		 */
		var $dwDealWhoPayShippingFee; //uint32_t

		/**
		 * 邮费金额
		 *
		 * 版本 >= 0
		 */
		var $dwDealShippingFee; //uint32_t

		/**
		 * 谁承担COD手续费，1：卖家承担；2：买家；3：平台承担
		 *
		 * 版本 >= 0
		 */
		var $dwDealWhoPayCodFee; //uint32_t

		/**
		 * COD手续额
		 *
		 * 版本 >= 0
		 */
		var $dwDealCodFee; //uint32_t

		/**
		 * 谁支付保险费，1：卖家赠送；2：买家；3：平台承担
		 *
		 * 版本 >= 0
		 */
		var $dwDealWhoPayInsuranceFee; //uint32_t

		/**
		 * 运费保险费
		 *
		 * 版本 >= 0
		 */
		var $dwDealInsuranceFee; //uint32_t

		/**
		 * 系统调价金额，用于区分COD卖家调价金额和用于凑整的COD优惠金额
		 *
		 * 版本 >= 0
		 */
		var $nDealSysAdjustFee; //int

		/**
		 * 积分支付值
		 *
		 * 版本 >= 0
		 */
		var $dwPayScore; //uint32_t

		/**
		 * 获得积分值
		 *
		 * 版本 >= 0
		 */
		var $dwObtainScore; //uint32_t

		/**
		 * 订单生成时间
		 *
		 * 版本 >= 0
		 */
		var $dwDealGenTime; //uint32_t

		/**
		 * 订单发货地描述
		 *
		 * 版本 >= 0
		 */
		var $strSendFromDesc; //std::string

		/**
		 * 下单时间戳
		 *
		 * 版本 >= 0
		 */
		var $ddwDealSeq; //uint64_t

		/**
		 * 下单md5
		 *
		 * 版本 >= 0
		 */
		var $ddwDealMd5; //uint64_t

		/**
		 * 下单IP
		 *
		 * 版本 >= 0
		 */
		var $strDealIp; //std::string

		/**
		 * refer
		 *
		 * 版本 >= 0
		 */
		var $strDealRefer; //std::string

		/**
		 * visitkey
		 *
		 * 版本 >= 0
		 */
		var $strDealVisitKey; //std::string

		/**
		 * 订单促销信息描述
		 *
		 * 版本 >= 0
		 */
		var $strPromotionDesc; //std::string

		/**
		 * 收货人
		 *
		 * 版本 >= 0
		 */
		var $strRecvName; //std::string

		/**
		 * 地区编码
		 *
		 * 版本 >= 0
		 */
		var $dwRecvRegionCode; //uint32_t

		/**
		 * 地址
		 *
		 * 版本 >= 0
		 */
		var $strRecvAddress; //std::string

		/**
		 * 邮编
		 *
		 * 版本 >= 0
		 */
		var $strRecvPostCode; //std::string

		/**
		 * 电话
		 *
		 * 版本 >= 0
		 */
		var $strRecvPhone; //std::string

		/**
		 * 手机
		 *
		 * 版本 >= 0
		 */
		var $ddwRecvMobile; //uint64_t

		/**
		 * 期望收货时间,天
		 *
		 * 版本 >= 0
		 */
		var $dwExpectRecvTime; //uint32_t

		/**
		 * 期望收货时段
		 *
		 * 版本 >= 0
		 */
		var $strExpectRecvTimeSpan; //std::string

		/**
		 * 收货附言
		 *
		 * 版本 >= 0
		 */
		var $strRecvRemark; //std::string

		/**
		 * 收货属性值
		 *
		 * 版本 >= 0
		 */
		var $dwRecvMask; //uint32_t

		/**
		 * 配送方式；1：平邮；2：快递；3：EMS；4：B2C自建物流；5：用户配送点自提
		 *
		 * 版本 >= 0
		 */
		var $cExpressType; //uint8_t

		/**
		 * 物流公司ID
		 *
		 * 版本 >= 0
		 */
		var $strExpressCompanyID; //std::string

		/**
		 * 物流公司名称
		 *
		 * 版本 >= 0
		 */
		var $strExpressCompanyName; //std::string

		/**
		 * 发票类型
		 *
		 * 版本 >= 0
		 */
		var $cInvoiceType; //uint8_t

		/**
		 * 发票抬头
		 *
		 * 版本 >= 0
		 */
		var $strInvoiceHead; //std::string

		/**
		 * 发票内容
		 *
		 * 版本 >= 0
		 */
		var $strInvoiceContent; //std::string

		/**
		 * Cft支付单号
		 *
		 * 版本 >= 0
		 */
		var $strCftDealId; //std::string

		/**
		 * 最后更新时间
		 *
		 * 版本 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * 商品子单列表
		 *
		 * 版本 >= 0
		 */
		var $oTradeInfoList; //ecc::deal::po::COrderTradePoList

		/**
		 * 支付信息表
		 *
		 * 版本 >= 0
		 */
		var $oPayInfoList; //ecc::deal::po::COrderPayInfoPoList

		/**
		 * 流水日志表
		 *
		 * 版本 >= 0
		 */
		var $oActionLogInfoList; //ecc::deal::po::CDealActionLogPoList

		/**
		 * 订单扩展信息 
		 *
		 * 版本 >= 0
		 */
		var $mmapDealExtInfoMap; //std::multimap<uint32_t,std::string> 

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId64_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBdealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBusinessDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerAccount_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerNickName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerNick_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerTitle_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerNick_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBusinessId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealSource_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealPayType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealProperty_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealProperty1_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealProperty2_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealProperty3_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealProperty4_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemSkuidList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemTitleList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealTotalFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealAdjustFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealPayment_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealDownPayment_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealDiscountTotal_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealItemTotalFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealWhoPayShippingFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealShippingFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealWhoPayCodFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealCodFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealWhoPayInsuranceFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealInsuranceFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealSysAdjustFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayScore_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cObtainScore_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealGenTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSendFromDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealSeq_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealMd5_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealIp_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealRefer_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealVisitKey_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPromotionDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvRegionCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvAddress_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvPostCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvPhone_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvMobile_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExpectRecvTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExpectRecvTimeSpan_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvRemark_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvMask_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExpressType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExpressCompanyID_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExpressCompanyName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cInvoiceType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cInvoiceHead_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cInvoiceContent_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCftDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeInfoList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayInfoList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cActionLogInfoList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealExtInfoMap_u; //uint8_t

		/**
		 * 交易单编号，即字符串格式的交易单号，可为空
		 *
		 * 版本 >= 1
		 */
		var $strBdealCode; //std::string

		/**
		 * 业务交易单号，可为空
		 *
		 * 版本 >= 1
		 */
		var $strBusinessBdealId; //std::string

		/**
		 * 分站ID
		 *
		 * 版本 >= 1
		 */
		var $dwSiteId; //uint32_t

		/**
		 * 优惠券金额
		 *
		 * 版本 >= 1
		 */
		var $nDealCouponFee; //int

		/**
		 * 现金积分支付值
		 *
		 * 版本 >= 1
		 */
		var $dwCashScore; //uint32_t

		/**
		 * 促销积分支付值
		 *
		 * 版本 >= 1
		 */
		var $dwPromotionScore; //uint32_t

		/**
		 * 扩展地区编码
		 *
		 * 版本 >= 1
		 */
		var $strRecvRegionCodeExt; //std::string

		/**
		 * 订单摘要
		 *
		 * 版本 >= 1
		 */
		var $strDealDigest; //std::string

		/**
		 * 分期付款银行
		 *
		 * 版本 >= 1
		 */
		var $strPayInstallmentBank; //std::string

		/**
		 * 分期付款期数
		 *
		 * 版本 >= 1
		 */
		var $wPayInstallmentNum; //uint16_t

		/**
		 * 分期付款每期金额
		 *
		 * 版本 >= 1
		 */
		var $dwPayInstallmentPayment; //uint32_t

		/**
		 * 易迅配送方式
		 *
		 * 版本 >= 1
		 */
		var $strIcsonShippingType; //std::string

		/**
		 * 易迅支付方式
		 *
		 * 版本 >= 1
		 */
		var $strIcsonPayType; //std::string

		/**
		 * 易迅内部帐号ID
		 *
		 * 版本 >= 1
		 */
		var $strIcsonAccount; //std::string

		/**
		 * 易迅跟踪信息
		 *
		 * 版本 >= 1
		 */
		var $strIcsonMasterLs; //std::string

		/**
		 * 易迅平衡比率
		 *
		 * 版本 >= 1
		 */
		var $strIcsonRate; //std::string

		/**
		 * 易迅银行利率
		 *
		 * 版本 >= 1
		 */
		var $strIcsonBankRate; //std::string

		/**
		 * 易迅店铺id
		 *
		 * 版本 >= 1
		 */
		var $strIcsonShopId; //std::string

		/**
		 * 易迅店铺导购id
		 *
		 * 版本 >= 1
		 */
		var $strIcsonShopGuideId; //std::string

		/**
		 * 易迅店铺导购费用
		 *
		 * 版本 >= 1
		 */
		var $strIcsonShopGuideCost; //std::string

		/**
		 * 易迅店铺导购名称
		 *
		 * 版本 >= 1
		 */
		var $strIcsonShopGuideName; //std::string

		/**
		 * 易迅节能补贴类型
		 *
		 * 版本 >= 1
		 */
		var $strIcsonSubsidyType; //std::string

		/**
		 * 易迅节能补贴姓名
		 *
		 * 版本 >= 1
		 */
		var $strIcsonSubsidyName; //std::string

		/**
		 * 易迅节能补贴身份证
		 *
		 * 版本 >= 1
		 */
		var $strIcsonSubsidyIdCard; //std::string

		/**
		 * 易迅客服下单操作员ID
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSOrderOperatorId; //std::string

		/**
		 * 易迅客服下单操作员名称
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSOrderOperatorName; //std::string

		/**
		 * 易迅发票公司名称
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceCompanyName; //std::string

		/**
		 * 易迅发票公司地址
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceCompanyAddr; //std::string

		/**
		 * 易迅发票公司电话
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceCompanyPhone; //std::string

		/**
		 * 易迅发票公司税号
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceCompanyTaxNo; //std::string

		/**
		 * 易迅发票公司银行账户
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceCompanyBankNo; //std::string

		/**
		 * 易迅发票公司银行名称
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceCompanyBankName; //std::string

		/**
		 * 易迅发票收货人
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceRecvName; //std::string

		/**
		 * 易迅发票收货地址
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceRecvAddr; //std::string

		/**
		 * 易迅发票收货地址ID
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceRecvRegionId; //std::string

		/**
		 * 易迅发票收货手机
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceRecvMobile; //std::string

		/**
		 * 易迅发票收货电话
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceRecvTel; //std::string

		/**
		 * 易迅发票收货邮编
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceRecvZip; //std::string

		/**
		 * 易迅发票配送方式
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceShipType; //std::string

		/**
		 * 易迅发票配送费用
		 *
		 * 版本 >= 1
		 */
		var $strIcsonInvoiceShipFee; //std::string

		/**
		 * 易迅订单flag
		 *
		 * 版本 >= 1
		 */
		var $strIcsonDealFlag; //std::string

		/**
		 * 易迅订单物流仓库编号
		 *
		 * 版本 >= 1
		 */
		var $strIcsonStockNo; //std::string

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cBdealCode_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cBusinessBdealId_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cSiteId_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cDealCouponFee_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cCashScore_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cPromotionScore_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cRecvRegionCodeExt_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cDealDigest_u; //uint8_t

		/**
		 * 分期付款银行UFlag
		 *
		 * 版本 >= 1
		 */
		var $cPayInstallmentBank_u; //uint8_t

		/**
		 * 分期付款期数UFlag
		 *
		 * 版本 >= 1
		 */
		var $cPayInstallmentNum_u; //uint8_t

		/**
		 * 分期付款每期金额UFlag
		 *
		 * 版本 >= 1
		 */
		var $cPayInstallmentPayment_u; //uint8_t

		/**
		 * 易迅配送方式UFlag
		 *
		 * 版本 >= 1
		 */
		var $cIcsonShippingType_u; //uint8_t

		/**
		 * 易迅支付方式UFlag
		 *
		 * 版本 >= 1
		 */
		var $cIcsonPayType_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonAccount_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonMasterLs_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonRate_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonBankRate_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonShopId_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonShopGuideId_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonShopGuideCost_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonShopGuideName_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonSubsidyType_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonSubsidyName_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonSubsidyIdCard_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSOrderOperatorId_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSOrderOperatorName_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceCompanyName_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceCompanyAddr_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceCompanyPhone_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceCompanyTaxNo_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceCompanyBankNo_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceCompanyBankName_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceRecvName_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceRecvAddr_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceRecvRegionId_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceRecvMobile_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceRecvTel_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceRecvZip_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceShipType_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonInvoiceShipFee_u; //uint8_t

		/**
		 * 易迅订单flag
		 *
		 * 版本 >= 1
		 */
		var $cIcsonDealFlag_u; //uint8_t

		/**
		 * 易迅订单物流仓库编号
		 *
		 * 版本 >= 1
		 */
		var $cIcsonStockNo_u; //uint8_t

		/**
		 * 支付渠道
		 *
		 * 版本 >= 2
		 */
		var $cPayChannel; //uint8_t

		/**
		 * 支付手续费
		 *
		 * 版本 >= 2
		 */
		var $dwPayServiceFee; //uint32_t

		/**
		 * 订单返现金额
		 *
		 * 版本 >= 2
		 */
		var $dwIcsonDealCashBack; //uint32_t

		/**
		 * 支付渠道UFlag
		 *
		 * 版本 >= 2
		 */
		var $cPayChannel_u; //uint8_t

		/**
		 * 支付手续费UFlag
		 *
		 * 版本 >= 2
		 */
		var $cPayServiceFee_u; //uint8_t

		/**
		 * 订单返现金额UFlag
		 *
		 * 版本 >= 2
		 */
		var $cIcsonDealCashBack_u; //uint8_t

		/**
		 * 分期付款手续费
		 *
		 * 版本 >= 3
		 */
		var $dwPayInstallmentFee; //uint32_t

		/**
		 * 分期付款手续费UFlag
		 *
		 * 版本 >= 3
		 */
		var $cPayInstallmentFee_u; //uint8_t

		/**
		 * 易迅订单号，带10开头
		 *
		 * 版本 >= 4
		 */
		var $strIcsonDealCode; //std::string

		/**
		 * 订单返现金额UFlag
		 *
		 * 版本 >= 4
		 */
		var $cIcsonDealCode_u; //uint8_t

		/**
		 * 易迅货票分离仓库id
		 *
		 * 版本 >= 5
		 */
		var $strIcsonInvoiceStockNo; //std::string

		/**
		 * 易迅货票分离分站id
		 *
		 * 版本 >= 5
		 */
		var $strIcsonInvoiceSiteId; //std::string

		/**
		 * 
		 *
		 * 版本 >= 5
		 */
		var $cIcsonInvoiceStockNo_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 5
		 */
		var $cIcsonInvoiceSiteId_u; //uint8_t

		/**
		 * 易迅联营商家id
		 *
		 * 版本 >= 6
		 */
		var $ddwSellerCorpId; //uint64_t

		/**
		 * 易迅联营体积
		 *
		 * 版本 >= 6
		 */
		var $strLmsVolume; //std::string

		/**
		 * 易迅联营重量
		 *
		 * 版本 >= 6
		 */
		var $strLmsWeight; //std::string

		/**
		 * 易迅联营最长边
		 *
		 * 版本 >= 6
		 */
		var $strLmsLongest; //std::string

		/**
		 * 
		 *
		 * 版本 >= 6
		 */
		var $cSellerCorpId_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 6
		 */
		var $cLmsVolume_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 6
		 */
		var $cLmsWeight_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 6
		 */
		var $cLmsLongest_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 6; // uint16_t
			 $this->strDealId = ""; // std::string
			 $this->ddwDealId64 = 0; // uint64_t
			 $this->ddwBdealId = 0; // uint64_t
			 $this->strBusinessDealId = ""; // std::string
			 $this->ddwBuyerId = 0; // uint64_t
			 $this->strBuyerAccount = ""; // std::string
			 $this->strBuyerNickName = ""; // std::string
			 $this->strBuyerNick = ""; // std::string
			 $this->ddwSellerId = 0; // uint64_t
			 $this->strSellerTitle = ""; // std::string
			 $this->strSellerNick = ""; // std::string
			 $this->dwBusinessId = 0; // uint32_t
			 $this->cDealType = 0; // uint8_t
			 $this->dwDealSource = 0; // uint32_t
			 $this->cDealPayType = 0; // uint8_t
			 $this->dwDealState = 0; // uint32_t
			 $this->dwDealProperty = 0; // uint32_t
			 $this->dwDealProperty1 = 0; // uint32_t
			 $this->dwDealProperty2 = 0; // uint32_t
			 $this->dwDealProperty3 = 0; // uint32_t
			 $this->dwDealProperty4 = 0; // uint32_t
			 $this->strItemSkuidList = ""; // std::string
			 $this->strItemTitleList = ""; // std::string
			 $this->dwDealTotalFee = 0; // uint32_t
			 $this->nDealAdjustFee = 0; // int
			 $this->dwDealPayment = 0; // uint32_t
			 $this->dwDealDownPayment = 0; // uint32_t
			 $this->nDealDiscountTotal = 0; // int
			 $this->dwDealItemTotalFee = 0; // uint32_t
			 $this->dwDealWhoPayShippingFee = 0; // uint32_t
			 $this->dwDealShippingFee = 0; // uint32_t
			 $this->dwDealWhoPayCodFee = 0; // uint32_t
			 $this->dwDealCodFee = 0; // uint32_t
			 $this->dwDealWhoPayInsuranceFee = 0; // uint32_t
			 $this->dwDealInsuranceFee = 0; // uint32_t
			 $this->nDealSysAdjustFee = 0; // int
			 $this->dwPayScore = 0; // uint32_t
			 $this->dwObtainScore = 0; // uint32_t
			 $this->dwDealGenTime = 0; // uint32_t
			 $this->strSendFromDesc = ""; // std::string
			 $this->ddwDealSeq = 0; // uint64_t
			 $this->ddwDealMd5 = 0; // uint64_t
			 $this->strDealIp = ""; // std::string
			 $this->strDealRefer = ""; // std::string
			 $this->strDealVisitKey = ""; // std::string
			 $this->strPromotionDesc = ""; // std::string
			 $this->strRecvName = ""; // std::string
			 $this->dwRecvRegionCode = 0; // uint32_t
			 $this->strRecvAddress = ""; // std::string
			 $this->strRecvPostCode = ""; // std::string
			 $this->strRecvPhone = ""; // std::string
			 $this->ddwRecvMobile = 0; // uint64_t
			 $this->dwExpectRecvTime = 0; // uint32_t
			 $this->strExpectRecvTimeSpan = ""; // std::string
			 $this->strRecvRemark = ""; // std::string
			 $this->dwRecvMask = 0; // uint32_t
			 $this->cExpressType = 0; // uint8_t
			 $this->strExpressCompanyID = ""; // std::string
			 $this->strExpressCompanyName = ""; // std::string
			 $this->cInvoiceType = 0; // uint8_t
			 $this->strInvoiceHead = ""; // std::string
			 $this->strInvoiceContent = ""; // std::string
			 $this->strCftDealId = ""; // std::string
			 $this->dwLastUpdateTime = 0; // uint32_t
			 $this->oTradeInfoList = new OrderTradePoList(); // ecc::deal::po::COrderTradePoList
			 $this->oPayInfoList = new OrderPayInfoPoList(); // ecc::deal::po::COrderPayInfoPoList
			 $this->oActionLogInfoList = new DealActionLogPoList(); // ecc::deal::po::CDealActionLogPoList
			 $this->mmapDealExtInfoMap = new stl_multimap('uint32_t,stl_string'); // std::multimap<uint32_t,std::string> 
			 $this->cVersion_u = 0; // uint8_t
			 $this->cDealId_u = 0; // uint8_t
			 $this->cDealId64_u = 0; // uint8_t
			 $this->cBdealId_u = 0; // uint8_t
			 $this->cBusinessDealId_u = 0; // uint8_t
			 $this->cBuyerId_u = 0; // uint8_t
			 $this->cBuyerAccount_u = 0; // uint8_t
			 $this->cBuyerNickName_u = 0; // uint8_t
			 $this->cBuyerNick_u = 0; // uint8_t
			 $this->cSellerId_u = 0; // uint8_t
			 $this->cSellerTitle_u = 0; // uint8_t
			 $this->cSellerNick_u = 0; // uint8_t
			 $this->cBusinessId_u = 0; // uint8_t
			 $this->cDealType_u = 0; // uint8_t
			 $this->cDealSource_u = 0; // uint8_t
			 $this->cDealPayType_u = 0; // uint8_t
			 $this->cDealState_u = 0; // uint8_t
			 $this->cDealProperty_u = 0; // uint8_t
			 $this->cDealProperty1_u = 0; // uint8_t
			 $this->cDealProperty2_u = 0; // uint8_t
			 $this->cDealProperty3_u = 0; // uint8_t
			 $this->cDealProperty4_u = 0; // uint8_t
			 $this->cItemSkuidList_u = 0; // uint8_t
			 $this->cItemTitleList_u = 0; // uint8_t
			 $this->cDealTotalFee_u = 0; // uint8_t
			 $this->cDealAdjustFee_u = 0; // uint8_t
			 $this->cDealPayment_u = 0; // uint8_t
			 $this->cDealDownPayment_u = 0; // uint8_t
			 $this->cDealDiscountTotal_u = 0; // uint8_t
			 $this->cDealItemTotalFee_u = 0; // uint8_t
			 $this->cDealWhoPayShippingFee_u = 0; // uint8_t
			 $this->cDealShippingFee_u = 0; // uint8_t
			 $this->cDealWhoPayCodFee_u = 0; // uint8_t
			 $this->cDealCodFee_u = 0; // uint8_t
			 $this->cDealWhoPayInsuranceFee_u = 0; // uint8_t
			 $this->cDealInsuranceFee_u = 0; // uint8_t
			 $this->cDealSysAdjustFee_u = 0; // uint8_t
			 $this->cPayScore_u = 0; // uint8_t
			 $this->cObtainScore_u = 0; // uint8_t
			 $this->cDealGenTime_u = 0; // uint8_t
			 $this->cSendFromDesc_u = 0; // uint8_t
			 $this->cDealSeq_u = 0; // uint8_t
			 $this->cDealMd5_u = 0; // uint8_t
			 $this->cDealIp_u = 0; // uint8_t
			 $this->cDealRefer_u = 0; // uint8_t
			 $this->cDealVisitKey_u = 0; // uint8_t
			 $this->cPromotionDesc_u = 0; // uint8_t
			 $this->cRecvName_u = 0; // uint8_t
			 $this->cRecvRegionCode_u = 0; // uint8_t
			 $this->cRecvAddress_u = 0; // uint8_t
			 $this->cRecvPostCode_u = 0; // uint8_t
			 $this->cRecvPhone_u = 0; // uint8_t
			 $this->cRecvMobile_u = 0; // uint8_t
			 $this->cExpectRecvTime_u = 0; // uint8_t
			 $this->cExpectRecvTimeSpan_u = 0; // uint8_t
			 $this->cRecvRemark_u = 0; // uint8_t
			 $this->cRecvMask_u = 0; // uint8_t
			 $this->cExpressType_u = 0; // uint8_t
			 $this->cExpressCompanyID_u = 0; // uint8_t
			 $this->cExpressCompanyName_u = 0; // uint8_t
			 $this->cInvoiceType_u = 0; // uint8_t
			 $this->cInvoiceHead_u = 0; // uint8_t
			 $this->cInvoiceContent_u = 0; // uint8_t
			 $this->cCftDealId_u = 0; // uint8_t
			 $this->cLastUpdateTime_u = 0; // uint8_t
			 $this->cTradeInfoList_u = 0; // uint8_t
			 $this->cPayInfoList_u = 0; // uint8_t
			 $this->cActionLogInfoList_u = 0; // uint8_t
			 $this->cDealExtInfoMap_u = 0; // uint8_t
			 $this->strBdealCode = ""; // std::string
			 $this->strBusinessBdealId = ""; // std::string
			 $this->dwSiteId = 0; // uint32_t
			 $this->nDealCouponFee = 0; // int
			 $this->dwCashScore = 0; // uint32_t
			 $this->dwPromotionScore = 0; // uint32_t
			 $this->strRecvRegionCodeExt = ""; // std::string
			 $this->strDealDigest = ""; // std::string
			 $this->strPayInstallmentBank = ""; // std::string
			 $this->wPayInstallmentNum = 0; // uint16_t
			 $this->dwPayInstallmentPayment = 0; // uint32_t
			 $this->strIcsonShippingType = ""; // std::string
			 $this->strIcsonPayType = ""; // std::string
			 $this->strIcsonAccount = ""; // std::string
			 $this->strIcsonMasterLs = ""; // std::string
			 $this->strIcsonRate = ""; // std::string
			 $this->strIcsonBankRate = ""; // std::string
			 $this->strIcsonShopId = ""; // std::string
			 $this->strIcsonShopGuideId = ""; // std::string
			 $this->strIcsonShopGuideCost = ""; // std::string
			 $this->strIcsonShopGuideName = ""; // std::string
			 $this->strIcsonSubsidyType = ""; // std::string
			 $this->strIcsonSubsidyName = ""; // std::string
			 $this->strIcsonSubsidyIdCard = ""; // std::string
			 $this->strIcsonCSOrderOperatorId = ""; // std::string
			 $this->strIcsonCSOrderOperatorName = ""; // std::string
			 $this->strIcsonInvoiceCompanyName = ""; // std::string
			 $this->strIcsonInvoiceCompanyAddr = ""; // std::string
			 $this->strIcsonInvoiceCompanyPhone = ""; // std::string
			 $this->strIcsonInvoiceCompanyTaxNo = ""; // std::string
			 $this->strIcsonInvoiceCompanyBankNo = ""; // std::string
			 $this->strIcsonInvoiceCompanyBankName = ""; // std::string
			 $this->strIcsonInvoiceRecvName = ""; // std::string
			 $this->strIcsonInvoiceRecvAddr = ""; // std::string
			 $this->strIcsonInvoiceRecvRegionId = ""; // std::string
			 $this->strIcsonInvoiceRecvMobile = ""; // std::string
			 $this->strIcsonInvoiceRecvTel = ""; // std::string
			 $this->strIcsonInvoiceRecvZip = ""; // std::string
			 $this->strIcsonInvoiceShipType = ""; // std::string
			 $this->strIcsonInvoiceShipFee = ""; // std::string
			 $this->strIcsonDealFlag = ""; // std::string
			 $this->strIcsonStockNo = ""; // std::string
			 $this->cBdealCode_u = 0; // uint8_t
			 $this->cBusinessBdealId_u = 0; // uint8_t
			 $this->cSiteId_u = 0; // uint8_t
			 $this->cDealCouponFee_u = 0; // uint8_t
			 $this->cCashScore_u = 0; // uint8_t
			 $this->cPromotionScore_u = 0; // uint8_t
			 $this->cRecvRegionCodeExt_u = 0; // uint8_t
			 $this->cDealDigest_u = 0; // uint8_t
			 $this->cPayInstallmentBank_u = 0; // uint8_t
			 $this->cPayInstallmentNum_u = 0; // uint8_t
			 $this->cPayInstallmentPayment_u = 0; // uint8_t
			 $this->cIcsonShippingType_u = 0; // uint8_t
			 $this->cIcsonPayType_u = 0; // uint8_t
			 $this->cIcsonAccount_u = 0; // uint8_t
			 $this->cIcsonMasterLs_u = 0; // uint8_t
			 $this->cIcsonRate_u = 0; // uint8_t
			 $this->cIcsonBankRate_u = 0; // uint8_t
			 $this->cIcsonShopId_u = 0; // uint8_t
			 $this->cIcsonShopGuideId_u = 0; // uint8_t
			 $this->cIcsonShopGuideCost_u = 0; // uint8_t
			 $this->cIcsonShopGuideName_u = 0; // uint8_t
			 $this->cIcsonSubsidyType_u = 0; // uint8_t
			 $this->cIcsonSubsidyName_u = 0; // uint8_t
			 $this->cIcsonSubsidyIdCard_u = 0; // uint8_t
			 $this->cIcsonCSOrderOperatorId_u = 0; // uint8_t
			 $this->cIcsonCSOrderOperatorName_u = 0; // uint8_t
			 $this->cIcsonInvoiceCompanyName_u = 0; // uint8_t
			 $this->cIcsonInvoiceCompanyAddr_u = 0; // uint8_t
			 $this->cIcsonInvoiceCompanyPhone_u = 0; // uint8_t
			 $this->cIcsonInvoiceCompanyTaxNo_u = 0; // uint8_t
			 $this->cIcsonInvoiceCompanyBankNo_u = 0; // uint8_t
			 $this->cIcsonInvoiceCompanyBankName_u = 0; // uint8_t
			 $this->cIcsonInvoiceRecvName_u = 0; // uint8_t
			 $this->cIcsonInvoiceRecvAddr_u = 0; // uint8_t
			 $this->cIcsonInvoiceRecvRegionId_u = 0; // uint8_t
			 $this->cIcsonInvoiceRecvMobile_u = 0; // uint8_t
			 $this->cIcsonInvoiceRecvTel_u = 0; // uint8_t
			 $this->cIcsonInvoiceRecvZip_u = 0; // uint8_t
			 $this->cIcsonInvoiceShipType_u = 0; // uint8_t
			 $this->cIcsonInvoiceShipFee_u = 0; // uint8_t
			 $this->cIcsonDealFlag_u = 0; // uint8_t
			 $this->cIcsonStockNo_u = 0; // uint8_t
			 $this->cPayChannel = 0; // uint8_t
			 $this->dwPayServiceFee = 0; // uint32_t
			 $this->dwIcsonDealCashBack = 0; // uint32_t
			 $this->cPayChannel_u = 0; // uint8_t
			 $this->cPayServiceFee_u = 0; // uint8_t
			 $this->cIcsonDealCashBack_u = 0; // uint8_t
			 $this->dwPayInstallmentFee = 0; // uint32_t
			 $this->cPayInstallmentFee_u = 0; // uint8_t
			 $this->strIcsonDealCode = ""; // std::string
			 $this->cIcsonDealCode_u = 0; // uint8_t
			 $this->strIcsonInvoiceStockNo = ""; // std::string
			 $this->strIcsonInvoiceSiteId = ""; // std::string
			 $this->cIcsonInvoiceStockNo_u = 0; // uint8_t
			 $this->cIcsonInvoiceSiteId_u = 0; // uint8_t
			 $this->ddwSellerCorpId = 0; // uint64_t
			 $this->strLmsVolume = ""; // std::string
			 $this->strLmsWeight = ""; // std::string
			 $this->strLmsLongest = ""; // std::string
			 $this->cSellerCorpId_u = 0; // uint8_t
			 $this->cLmsVolume_u = 0; // uint8_t
			 $this->cLmsWeight_u = 0; // uint8_t
			 $this->cLmsLongest_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushString($this->strDealId); // 序列化订单编号，格式:订单序号XXXXYYYY，如:101041051509351702，可为空 类型为std::string
			$bs->pushUint64_t($this->ddwDealId64); // 序列化订单单号，拍拍订单同步可使用，可为空 类型为uint64_t
			$bs->pushUint64_t($this->ddwBdealId); // 序列化交易单号，可为空 类型为uint64_t
			$bs->pushString($this->strBusinessDealId); // 序列化业务订单编号，第三方托管订单 类型为std::string
			$bs->pushUint64_t($this->ddwBuyerId); // 序列化买家ID 类型为uint64_t
			$bs->pushString($this->strBuyerAccount); // 序列化买家帐号 类型为std::string
			$bs->pushString($this->strBuyerNickName); // 序列化买家姓名 类型为std::string
			$bs->pushString($this->strBuyerNick); // 序列化买家昵称 类型为std::string
			$bs->pushUint64_t($this->ddwSellerId); // 序列化商家ID 类型为uint64_t
			$bs->pushString($this->strSellerTitle); // 序列化商家真实名称 类型为std::string
			$bs->pushString($this->strSellerNick); // 序列化卖家昵称 类型为std::string
			$bs->pushUint32_t($this->dwBusinessId); // 序列化业务ID 类型为uint32_t
			$bs->pushUint8_t($this->cDealType); // 序列化订单类型 类型为uint8_t
			$bs->pushUint32_t($this->dwDealSource); // 序列化下单渠道：1：业务主站；2：移动app；3：移动wap 类型为uint32_t
			$bs->pushUint8_t($this->cDealPayType); // 序列化支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款 类型为uint8_t
			$bs->pushUint32_t($this->dwDealState); // 序列化订单状态 类型为uint32_t
			$bs->pushUint32_t($this->dwDealProperty); // 序列化订单属性值，通用 类型为uint32_t
			$bs->pushUint32_t($this->dwDealProperty1); // 序列化订单属性值，业务1扩展用 类型为uint32_t
			$bs->pushUint32_t($this->dwDealProperty2); // 序列化订单属性值，业务2扩展用 类型为uint32_t
			$bs->pushUint32_t($this->dwDealProperty3); // 序列化订单属性值，业务3扩展用 类型为uint32_t
			$bs->pushUint32_t($this->dwDealProperty4); // 序列化订单属性值，业务4扩展用 类型为uint32_t
			$bs->pushString($this->strItemSkuidList); // 序列化商品skuID列表 类型为std::string
			$bs->pushString($this->strItemTitleList); // 序列化商品标题列表 类型为std::string
			$bs->pushUint32_t($this->dwDealTotalFee); // 序列化订单总金额,下单金额 类型为uint32_t
			$bs->pushInt32_t($this->nDealAdjustFee); // 序列化调价金额 类型为int
			$bs->pushUint32_t($this->dwDealPayment); // 序列化实付总金额 类型为uint32_t
			$bs->pushUint32_t($this->dwDealDownPayment); // 序列化C2B预售定金金额 类型为uint32_t
			$bs->pushInt32_t($this->nDealDiscountTotal); // 序列化优惠总金额; 活动列表优惠金额汇总 类型为int
			$bs->pushUint32_t($this->dwDealItemTotalFee); // 序列化商品子单总金额 类型为uint32_t
			$bs->pushUint32_t($this->dwDealWhoPayShippingFee); // 序列化谁支付邮费，1：卖家；2：买家 类型为uint32_t
			$bs->pushUint32_t($this->dwDealShippingFee); // 序列化邮费金额 类型为uint32_t
			$bs->pushUint32_t($this->dwDealWhoPayCodFee); // 序列化谁承担COD手续费，1：卖家承担；2：买家；3：平台承担 类型为uint32_t
			$bs->pushUint32_t($this->dwDealCodFee); // 序列化COD手续额 类型为uint32_t
			$bs->pushUint32_t($this->dwDealWhoPayInsuranceFee); // 序列化谁支付保险费，1：卖家赠送；2：买家；3：平台承担 类型为uint32_t
			$bs->pushUint32_t($this->dwDealInsuranceFee); // 序列化运费保险费 类型为uint32_t
			$bs->pushInt32_t($this->nDealSysAdjustFee); // 序列化系统调价金额，用于区分COD卖家调价金额和用于凑整的COD优惠金额 类型为int
			$bs->pushUint32_t($this->dwPayScore); // 序列化积分支付值 类型为uint32_t
			$bs->pushUint32_t($this->dwObtainScore); // 序列化获得积分值 类型为uint32_t
			$bs->pushUint32_t($this->dwDealGenTime); // 序列化订单生成时间 类型为uint32_t
			$bs->pushString($this->strSendFromDesc); // 序列化订单发货地描述 类型为std::string
			$bs->pushUint64_t($this->ddwDealSeq); // 序列化下单时间戳 类型为uint64_t
			$bs->pushUint64_t($this->ddwDealMd5); // 序列化下单md5 类型为uint64_t
			$bs->pushString($this->strDealIp); // 序列化下单IP 类型为std::string
			$bs->pushString($this->strDealRefer); // 序列化refer 类型为std::string
			$bs->pushString($this->strDealVisitKey); // 序列化visitkey 类型为std::string
			$bs->pushString($this->strPromotionDesc); // 序列化订单促销信息描述 类型为std::string
			$bs->pushString($this->strRecvName); // 序列化收货人 类型为std::string
			$bs->pushUint32_t($this->dwRecvRegionCode); // 序列化地区编码 类型为uint32_t
			$bs->pushString($this->strRecvAddress); // 序列化地址 类型为std::string
			$bs->pushString($this->strRecvPostCode); // 序列化邮编 类型为std::string
			$bs->pushString($this->strRecvPhone); // 序列化电话 类型为std::string
			$bs->pushUint64_t($this->ddwRecvMobile); // 序列化手机 类型为uint64_t
			$bs->pushUint32_t($this->dwExpectRecvTime); // 序列化期望收货时间,天 类型为uint32_t
			$bs->pushString($this->strExpectRecvTimeSpan); // 序列化期望收货时段 类型为std::string
			$bs->pushString($this->strRecvRemark); // 序列化收货附言 类型为std::string
			$bs->pushUint32_t($this->dwRecvMask); // 序列化收货属性值 类型为uint32_t
			$bs->pushUint8_t($this->cExpressType); // 序列化配送方式；1：平邮；2：快递；3：EMS；4：B2C自建物流；5：用户配送点自提 类型为uint8_t
			$bs->pushString($this->strExpressCompanyID); // 序列化物流公司ID 类型为std::string
			$bs->pushString($this->strExpressCompanyName); // 序列化物流公司名称 类型为std::string
			$bs->pushUint8_t($this->cInvoiceType); // 序列化发票类型 类型为uint8_t
			$bs->pushString($this->strInvoiceHead); // 序列化发票抬头 类型为std::string
			$bs->pushString($this->strInvoiceContent); // 序列化发票内容 类型为std::string
			$bs->pushString($this->strCftDealId); // 序列化Cft支付单号 类型为std::string
			$bs->pushUint32_t($this->dwLastUpdateTime); // 序列化最后更新时间 类型为uint32_t
			$bs->pushObject($this->oTradeInfoList,'OrderTradePoList'); // 序列化商品子单列表 类型为ecc::deal::po::COrderTradePoList
			$bs->pushObject($this->oPayInfoList,'OrderPayInfoPoList'); // 序列化支付信息表 类型为ecc::deal::po::COrderPayInfoPoList
			$bs->pushObject($this->oActionLogInfoList,'DealActionLogPoList'); // 序列化流水日志表 类型为ecc::deal::po::CDealActionLogPoList
			$bs->pushObject($this->mmapDealExtInfoMap,'stl_multimap'); // 序列化订单扩展信息  类型为std::multimap<uint32_t,std::string> 
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId64_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBdealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBusinessDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerAccount_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerNickName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerNick_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerTitle_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerNick_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBusinessId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealSource_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealPayType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealProperty_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealProperty1_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealProperty2_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealProperty3_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealProperty4_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemSkuidList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemTitleList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealTotalFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealAdjustFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealPayment_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealDownPayment_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealDiscountTotal_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealItemTotalFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealWhoPayShippingFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealShippingFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealWhoPayCodFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealCodFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealWhoPayInsuranceFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealInsuranceFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealSysAdjustFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayScore_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cObtainScore_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealGenTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSendFromDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealSeq_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealMd5_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealIp_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealRefer_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealVisitKey_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPromotionDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvRegionCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvAddress_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvPostCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvPhone_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvMobile_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExpectRecvTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExpectRecvTimeSpan_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvRemark_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvMask_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExpressType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExpressCompanyID_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExpressCompanyName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cInvoiceType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cInvoiceHead_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cInvoiceContent_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCftDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeInfoList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayInfoList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cActionLogInfoList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealExtInfoMap_u); // 序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strBdealCode); // 序列化交易单编号，即字符串格式的交易单号，可为空 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strBusinessBdealId); // 序列化业务交易单号，可为空 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwSiteId); // 序列化分站ID 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushInt32_t($this->nDealCouponFee); // 序列化优惠券金额 类型为int
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwCashScore); // 序列化现金积分支付值 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwPromotionScore); // 序列化促销积分支付值 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strRecvRegionCodeExt); // 序列化扩展地区编码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strDealDigest); // 序列化订单摘要 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strPayInstallmentBank); // 序列化分期付款银行 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint16_t($this->wPayInstallmentNum); // 序列化分期付款期数 类型为uint16_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwPayInstallmentPayment); // 序列化分期付款每期金额 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonShippingType); // 序列化易迅配送方式 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonPayType); // 序列化易迅支付方式 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonAccount); // 序列化易迅内部帐号ID 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonMasterLs); // 序列化易迅跟踪信息 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonRate); // 序列化易迅平衡比率 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonBankRate); // 序列化易迅银行利率 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonShopId); // 序列化易迅店铺id 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonShopGuideId); // 序列化易迅店铺导购id 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonShopGuideCost); // 序列化易迅店铺导购费用 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonShopGuideName); // 序列化易迅店铺导购名称 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonSubsidyType); // 序列化易迅节能补贴类型 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonSubsidyName); // 序列化易迅节能补贴姓名 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonSubsidyIdCard); // 序列化易迅节能补贴身份证 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSOrderOperatorId); // 序列化易迅客服下单操作员ID 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSOrderOperatorName); // 序列化易迅客服下单操作员名称 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceCompanyName); // 序列化易迅发票公司名称 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceCompanyAddr); // 序列化易迅发票公司地址 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceCompanyPhone); // 序列化易迅发票公司电话 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceCompanyTaxNo); // 序列化易迅发票公司税号 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceCompanyBankNo); // 序列化易迅发票公司银行账户 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceCompanyBankName); // 序列化易迅发票公司银行名称 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceRecvName); // 序列化易迅发票收货人 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceRecvAddr); // 序列化易迅发票收货地址 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceRecvRegionId); // 序列化易迅发票收货地址ID 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceRecvMobile); // 序列化易迅发票收货手机 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceRecvTel); // 序列化易迅发票收货电话 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceRecvZip); // 序列化易迅发票收货邮编 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceShipType); // 序列化易迅发票配送方式 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceShipFee); // 序列化易迅发票配送费用 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonDealFlag); // 序列化易迅订单flag 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonStockNo); // 序列化易迅订单物流仓库编号 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cBdealCode_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cBusinessBdealId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cSiteId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cDealCouponFee_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cCashScore_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cPromotionScore_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cRecvRegionCodeExt_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cDealDigest_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cPayInstallmentBank_u); // 序列化分期付款银行UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cPayInstallmentNum_u); // 序列化分期付款期数UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cPayInstallmentPayment_u); // 序列化分期付款每期金额UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonShippingType_u); // 序列化易迅配送方式UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonPayType_u); // 序列化易迅支付方式UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonAccount_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonMasterLs_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonRate_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonBankRate_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonShopId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonShopGuideId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonShopGuideCost_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonShopGuideName_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonSubsidyType_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonSubsidyName_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonSubsidyIdCard_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSOrderOperatorId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSOrderOperatorName_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceCompanyName_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceCompanyAddr_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceCompanyPhone_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceCompanyTaxNo_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceCompanyBankNo_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceCompanyBankName_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceRecvName_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceRecvAddr_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceRecvRegionId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceRecvMobile_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceRecvTel_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceRecvZip_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceShipType_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceShipFee_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonDealFlag_u); // 序列化易迅订单flag 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonStockNo_u); // 序列化易迅订单物流仓库编号 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cPayChannel); // 序列化支付渠道 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwPayServiceFee); // 序列化支付手续费 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwIcsonDealCashBack); // 序列化订单返现金额 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cPayChannel_u); // 序列化支付渠道UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cPayServiceFee_u); // 序列化支付手续费UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cIcsonDealCashBack_u); // 序列化订单返现金额UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 3 ){
				$bs->pushUint32_t($this->dwPayInstallmentFee); // 序列化分期付款手续费 类型为uint32_t
			}
			if(  $this->wVersion >= 3 ){
				$bs->pushUint8_t($this->cPayInstallmentFee_u); // 序列化分期付款手续费UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 4 ){
				$bs->pushString($this->strIcsonDealCode); // 序列化易迅订单号，带10开头 类型为std::string
			}
			if(  $this->wVersion >= 4 ){
				$bs->pushUint8_t($this->cIcsonDealCode_u); // 序列化订单返现金额UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 5 ){
				$bs->pushString($this->strIcsonInvoiceStockNo); // 序列化易迅货票分离仓库id 类型为std::string
			}
			if(  $this->wVersion >= 5 ){
				$bs->pushString($this->strIcsonInvoiceSiteId); // 序列化易迅货票分离分站id 类型为std::string
			}
			if(  $this->wVersion >= 5 ){
				$bs->pushUint8_t($this->cIcsonInvoiceStockNo_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 5 ){
				$bs->pushUint8_t($this->cIcsonInvoiceSiteId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 6 ){
				$bs->pushUint64_t($this->ddwSellerCorpId); // 序列化易迅联营商家id 类型为uint64_t
			}
			if(  $this->wVersion >= 6 ){
				$bs->pushString($this->strLmsVolume); // 序列化易迅联营体积 类型为std::string
			}
			if(  $this->wVersion >= 6 ){
				$bs->pushString($this->strLmsWeight); // 序列化易迅联营重量 类型为std::string
			}
			if(  $this->wVersion >= 6 ){
				$bs->pushString($this->strLmsLongest); // 序列化易迅联营最长边 类型为std::string
			}
			if(  $this->wVersion >= 6 ){
				$bs->pushUint8_t($this->cSellerCorpId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 6 ){
				$bs->pushUint8_t($this->cLmsVolume_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 6 ){
				$bs->pushUint8_t($this->cLmsWeight_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 6 ){
				$bs->pushUint8_t($this->cLmsLongest_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->strDealId = $bs->popString(); // 反序列化订单编号，格式:订单序号XXXXYYYY，如:101041051509351702，可为空 类型为std::string
			$this->ddwDealId64 = $bs->popUint64_t(); // 反序列化订单单号，拍拍订单同步可使用，可为空 类型为uint64_t
			$this->ddwBdealId = $bs->popUint64_t(); // 反序列化交易单号，可为空 类型为uint64_t
			$this->strBusinessDealId = $bs->popString(); // 反序列化业务订单编号，第三方托管订单 类型为std::string
			$this->ddwBuyerId = $bs->popUint64_t(); // 反序列化买家ID 类型为uint64_t
			$this->strBuyerAccount = $bs->popString(); // 反序列化买家帐号 类型为std::string
			$this->strBuyerNickName = $bs->popString(); // 反序列化买家姓名 类型为std::string
			$this->strBuyerNick = $bs->popString(); // 反序列化买家昵称 类型为std::string
			$this->ddwSellerId = $bs->popUint64_t(); // 反序列化商家ID 类型为uint64_t
			$this->strSellerTitle = $bs->popString(); // 反序列化商家真实名称 类型为std::string
			$this->strSellerNick = $bs->popString(); // 反序列化卖家昵称 类型为std::string
			$this->dwBusinessId = $bs->popUint32_t(); // 反序列化业务ID 类型为uint32_t
			$this->cDealType = $bs->popUint8_t(); // 反序列化订单类型 类型为uint8_t
			$this->dwDealSource = $bs->popUint32_t(); // 反序列化下单渠道：1：业务主站；2：移动app；3：移动wap 类型为uint32_t
			$this->cDealPayType = $bs->popUint8_t(); // 反序列化支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款 类型为uint8_t
			$this->dwDealState = $bs->popUint32_t(); // 反序列化订单状态 类型为uint32_t
			$this->dwDealProperty = $bs->popUint32_t(); // 反序列化订单属性值，通用 类型为uint32_t
			$this->dwDealProperty1 = $bs->popUint32_t(); // 反序列化订单属性值，业务1扩展用 类型为uint32_t
			$this->dwDealProperty2 = $bs->popUint32_t(); // 反序列化订单属性值，业务2扩展用 类型为uint32_t
			$this->dwDealProperty3 = $bs->popUint32_t(); // 反序列化订单属性值，业务3扩展用 类型为uint32_t
			$this->dwDealProperty4 = $bs->popUint32_t(); // 反序列化订单属性值，业务4扩展用 类型为uint32_t
			$this->strItemSkuidList = $bs->popString(); // 反序列化商品skuID列表 类型为std::string
			$this->strItemTitleList = $bs->popString(); // 反序列化商品标题列表 类型为std::string
			$this->dwDealTotalFee = $bs->popUint32_t(); // 反序列化订单总金额,下单金额 类型为uint32_t
			$this->nDealAdjustFee = $bs->popInt32_t(); // 反序列化调价金额 类型为int
			$this->dwDealPayment = $bs->popUint32_t(); // 反序列化实付总金额 类型为uint32_t
			$this->dwDealDownPayment = $bs->popUint32_t(); // 反序列化C2B预售定金金额 类型为uint32_t
			$this->nDealDiscountTotal = $bs->popInt32_t(); // 反序列化优惠总金额; 活动列表优惠金额汇总 类型为int
			$this->dwDealItemTotalFee = $bs->popUint32_t(); // 反序列化商品子单总金额 类型为uint32_t
			$this->dwDealWhoPayShippingFee = $bs->popUint32_t(); // 反序列化谁支付邮费，1：卖家；2：买家 类型为uint32_t
			$this->dwDealShippingFee = $bs->popUint32_t(); // 反序列化邮费金额 类型为uint32_t
			$this->dwDealWhoPayCodFee = $bs->popUint32_t(); // 反序列化谁承担COD手续费，1：卖家承担；2：买家；3：平台承担 类型为uint32_t
			$this->dwDealCodFee = $bs->popUint32_t(); // 反序列化COD手续额 类型为uint32_t
			$this->dwDealWhoPayInsuranceFee = $bs->popUint32_t(); // 反序列化谁支付保险费，1：卖家赠送；2：买家；3：平台承担 类型为uint32_t
			$this->dwDealInsuranceFee = $bs->popUint32_t(); // 反序列化运费保险费 类型为uint32_t
			$this->nDealSysAdjustFee = $bs->popInt32_t(); // 反序列化系统调价金额，用于区分COD卖家调价金额和用于凑整的COD优惠金额 类型为int
			$this->dwPayScore = $bs->popUint32_t(); // 反序列化积分支付值 类型为uint32_t
			$this->dwObtainScore = $bs->popUint32_t(); // 反序列化获得积分值 类型为uint32_t
			$this->dwDealGenTime = $bs->popUint32_t(); // 反序列化订单生成时间 类型为uint32_t
			$this->strSendFromDesc = $bs->popString(); // 反序列化订单发货地描述 类型为std::string
			$this->ddwDealSeq = $bs->popUint64_t(); // 反序列化下单时间戳 类型为uint64_t
			$this->ddwDealMd5 = $bs->popUint64_t(); // 反序列化下单md5 类型为uint64_t
			$this->strDealIp = $bs->popString(); // 反序列化下单IP 类型为std::string
			$this->strDealRefer = $bs->popString(); // 反序列化refer 类型为std::string
			$this->strDealVisitKey = $bs->popString(); // 反序列化visitkey 类型为std::string
			$this->strPromotionDesc = $bs->popString(); // 反序列化订单促销信息描述 类型为std::string
			$this->strRecvName = $bs->popString(); // 反序列化收货人 类型为std::string
			$this->dwRecvRegionCode = $bs->popUint32_t(); // 反序列化地区编码 类型为uint32_t
			$this->strRecvAddress = $bs->popString(); // 反序列化地址 类型为std::string
			$this->strRecvPostCode = $bs->popString(); // 反序列化邮编 类型为std::string
			$this->strRecvPhone = $bs->popString(); // 反序列化电话 类型为std::string
			$this->ddwRecvMobile = $bs->popUint64_t(); // 反序列化手机 类型为uint64_t
			$this->dwExpectRecvTime = $bs->popUint32_t(); // 反序列化期望收货时间,天 类型为uint32_t
			$this->strExpectRecvTimeSpan = $bs->popString(); // 反序列化期望收货时段 类型为std::string
			$this->strRecvRemark = $bs->popString(); // 反序列化收货附言 类型为std::string
			$this->dwRecvMask = $bs->popUint32_t(); // 反序列化收货属性值 类型为uint32_t
			$this->cExpressType = $bs->popUint8_t(); // 反序列化配送方式；1：平邮；2：快递；3：EMS；4：B2C自建物流；5：用户配送点自提 类型为uint8_t
			$this->strExpressCompanyID = $bs->popString(); // 反序列化物流公司ID 类型为std::string
			$this->strExpressCompanyName = $bs->popString(); // 反序列化物流公司名称 类型为std::string
			$this->cInvoiceType = $bs->popUint8_t(); // 反序列化发票类型 类型为uint8_t
			$this->strInvoiceHead = $bs->popString(); // 反序列化发票抬头 类型为std::string
			$this->strInvoiceContent = $bs->popString(); // 反序列化发票内容 类型为std::string
			$this->strCftDealId = $bs->popString(); // 反序列化Cft支付单号 类型为std::string
			$this->dwLastUpdateTime = $bs->popUint32_t(); // 反序列化最后更新时间 类型为uint32_t
			$this->oTradeInfoList = $bs->popObject('OrderTradePoList'); // 反序列化商品子单列表 类型为ecc::deal::po::COrderTradePoList
			$this->oPayInfoList = $bs->popObject('OrderPayInfoPoList'); // 反序列化支付信息表 类型为ecc::deal::po::COrderPayInfoPoList
			$this->oActionLogInfoList = $bs->popObject('DealActionLogPoList'); // 反序列化流水日志表 类型为ecc::deal::po::CDealActionLogPoList
			$this->mmapDealExtInfoMap = $bs->popObject('stl_multimap<uint32_t,stl_string>'); // 反序列化订单扩展信息  类型为std::multimap<uint32_t,std::string> 
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId64_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBdealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBusinessDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerAccount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerNickName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerNick_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerTitle_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerNick_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBusinessId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealSource_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealPayType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealProperty1_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealProperty2_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealProperty3_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealProperty4_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemSkuidList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemTitleList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealTotalFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealAdjustFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealPayment_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealDownPayment_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealDiscountTotal_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealItemTotalFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealWhoPayShippingFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealShippingFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealWhoPayCodFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealCodFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealWhoPayInsuranceFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealInsuranceFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealSysAdjustFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayScore_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cObtainScore_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealGenTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSendFromDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealSeq_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealMd5_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealIp_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealRefer_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealVisitKey_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPromotionDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvRegionCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvAddress_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvPostCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvPhone_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvMobile_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExpectRecvTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExpectRecvTimeSpan_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvRemark_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvMask_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExpressType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExpressCompanyID_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExpressCompanyName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cInvoiceType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cInvoiceHead_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cInvoiceContent_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCftDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cActionLogInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealExtInfoMap_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$this->strBdealCode = $bs->popString(); // 反序列化交易单编号，即字符串格式的交易单号，可为空 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strBusinessBdealId = $bs->popString(); // 反序列化业务交易单号，可为空 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->dwSiteId = $bs->popUint32_t(); // 反序列化分站ID 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->nDealCouponFee = $bs->popInt32_t(); // 反序列化优惠券金额 类型为int
			}
			if(  $this->wVersion >= 1 ){
				$this->dwCashScore = $bs->popUint32_t(); // 反序列化现金积分支付值 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->dwPromotionScore = $bs->popUint32_t(); // 反序列化促销积分支付值 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->strRecvRegionCodeExt = $bs->popString(); // 反序列化扩展地区编码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strDealDigest = $bs->popString(); // 反序列化订单摘要 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strPayInstallmentBank = $bs->popString(); // 反序列化分期付款银行 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->wPayInstallmentNum = $bs->popUint16_t(); // 反序列化分期付款期数 类型为uint16_t
			}
			if(  $this->wVersion >= 1 ){
				$this->dwPayInstallmentPayment = $bs->popUint32_t(); // 反序列化分期付款每期金额 类型为uint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonShippingType = $bs->popString(); // 反序列化易迅配送方式 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonPayType = $bs->popString(); // 反序列化易迅支付方式 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonAccount = $bs->popString(); // 反序列化易迅内部帐号ID 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonMasterLs = $bs->popString(); // 反序列化易迅跟踪信息 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonRate = $bs->popString(); // 反序列化易迅平衡比率 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonBankRate = $bs->popString(); // 反序列化易迅银行利率 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonShopId = $bs->popString(); // 反序列化易迅店铺id 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonShopGuideId = $bs->popString(); // 反序列化易迅店铺导购id 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonShopGuideCost = $bs->popString(); // 反序列化易迅店铺导购费用 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonShopGuideName = $bs->popString(); // 反序列化易迅店铺导购名称 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonSubsidyType = $bs->popString(); // 反序列化易迅节能补贴类型 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonSubsidyName = $bs->popString(); // 反序列化易迅节能补贴姓名 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonSubsidyIdCard = $bs->popString(); // 反序列化易迅节能补贴身份证 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSOrderOperatorId = $bs->popString(); // 反序列化易迅客服下单操作员ID 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSOrderOperatorName = $bs->popString(); // 反序列化易迅客服下单操作员名称 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceCompanyName = $bs->popString(); // 反序列化易迅发票公司名称 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceCompanyAddr = $bs->popString(); // 反序列化易迅发票公司地址 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceCompanyPhone = $bs->popString(); // 反序列化易迅发票公司电话 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceCompanyTaxNo = $bs->popString(); // 反序列化易迅发票公司税号 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceCompanyBankNo = $bs->popString(); // 反序列化易迅发票公司银行账户 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceCompanyBankName = $bs->popString(); // 反序列化易迅发票公司银行名称 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceRecvName = $bs->popString(); // 反序列化易迅发票收货人 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceRecvAddr = $bs->popString(); // 反序列化易迅发票收货地址 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceRecvRegionId = $bs->popString(); // 反序列化易迅发票收货地址ID 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceRecvMobile = $bs->popString(); // 反序列化易迅发票收货手机 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceRecvTel = $bs->popString(); // 反序列化易迅发票收货电话 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceRecvZip = $bs->popString(); // 反序列化易迅发票收货邮编 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceShipType = $bs->popString(); // 反序列化易迅发票配送方式 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceShipFee = $bs->popString(); // 反序列化易迅发票配送费用 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonDealFlag = $bs->popString(); // 反序列化易迅订单flag 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonStockNo = $bs->popString(); // 反序列化易迅订单物流仓库编号 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cBdealCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cBusinessBdealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cSiteId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cDealCouponFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cCashScore_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cPromotionScore_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cRecvRegionCodeExt_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cDealDigest_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cPayInstallmentBank_u = $bs->popUint8_t(); // 反序列化分期付款银行UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cPayInstallmentNum_u = $bs->popUint8_t(); // 反序列化分期付款期数UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cPayInstallmentPayment_u = $bs->popUint8_t(); // 反序列化分期付款每期金额UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonShippingType_u = $bs->popUint8_t(); // 反序列化易迅配送方式UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonPayType_u = $bs->popUint8_t(); // 反序列化易迅支付方式UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonAccount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonMasterLs_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonRate_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonBankRate_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonShopId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonShopGuideId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonShopGuideCost_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonShopGuideName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonSubsidyType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonSubsidyName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonSubsidyIdCard_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSOrderOperatorId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSOrderOperatorName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceCompanyName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceCompanyAddr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceCompanyPhone_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceCompanyTaxNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceCompanyBankNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceCompanyBankName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceRecvName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceRecvAddr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceRecvRegionId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceRecvMobile_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceRecvTel_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceRecvZip_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceShipType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceShipFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonDealFlag_u = $bs->popUint8_t(); // 反序列化易迅订单flag 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonStockNo_u = $bs->popUint8_t(); // 反序列化易迅订单物流仓库编号 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cPayChannel = $bs->popUint8_t(); // 反序列化支付渠道 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwPayServiceFee = $bs->popUint32_t(); // 反序列化支付手续费 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwIcsonDealCashBack = $bs->popUint32_t(); // 反序列化订单返现金额 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cPayChannel_u = $bs->popUint8_t(); // 反序列化支付渠道UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cPayServiceFee_u = $bs->popUint8_t(); // 反序列化支付手续费UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cIcsonDealCashBack_u = $bs->popUint8_t(); // 反序列化订单返现金额UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 3 ){
				$this->dwPayInstallmentFee = $bs->popUint32_t(); // 反序列化分期付款手续费 类型为uint32_t
			}
			if(  $this->wVersion >= 3 ){
				$this->cPayInstallmentFee_u = $bs->popUint8_t(); // 反序列化分期付款手续费UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 4 ){
				$this->strIcsonDealCode = $bs->popString(); // 反序列化易迅订单号，带10开头 类型为std::string
			}
			if(  $this->wVersion >= 4 ){
				$this->cIcsonDealCode_u = $bs->popUint8_t(); // 反序列化订单返现金额UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 5 ){
				$this->strIcsonInvoiceStockNo = $bs->popString(); // 反序列化易迅货票分离仓库id 类型为std::string
			}
			if(  $this->wVersion >= 5 ){
				$this->strIcsonInvoiceSiteId = $bs->popString(); // 反序列化易迅货票分离分站id 类型为std::string
			}
			if(  $this->wVersion >= 5 ){
				$this->cIcsonInvoiceStockNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 5 ){
				$this->cIcsonInvoiceSiteId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 6 ){
				$this->ddwSellerCorpId = $bs->popUint64_t(); // 反序列化易迅联营商家id 类型为uint64_t
			}
			if(  $this->wVersion >= 6 ){
				$this->strLmsVolume = $bs->popString(); // 反序列化易迅联营体积 类型为std::string
			}
			if(  $this->wVersion >= 6 ){
				$this->strLmsWeight = $bs->popString(); // 反序列化易迅联营重量 类型为std::string
			}
			if(  $this->wVersion >= 6 ){
				$this->strLmsLongest = $bs->popString(); // 反序列化易迅联营最长边 类型为std::string
			}
			if(  $this->wVersion >= 6 ){
				$this->cSellerCorpId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 6 ){
				$this->cLmsVolume_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 6 ){
				$this->cLmsWeight_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 6 ){
				$this->cLmsLongest_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.ecc.deal.idl.OrderPo.java

if (!class_exists('OrderTradePoList')) {
class OrderTradePoList
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 商品单列表
		 *
		 * 版本 >= 0
		 */
		var $vecTradeInfoList; //std::vector<ecc::deal::po::COrderTradePo> 

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeInfoList_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->vecTradeInfoList = new stl_vector('OrderTradePo'); // std::vector<ecc::deal::po::COrderTradePo> 
			 $this->cVersion_u = 0; // uint8_t
			 $this->cTradeInfoList_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushObject($this->vecTradeInfoList,'stl_vector'); // 序列化商品单列表 类型为std::vector<ecc::deal::po::COrderTradePo> 
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeInfoList_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->vecTradeInfoList = $bs->popObject('stl_vector<OrderTradePo>'); // 反序列化商品单列表 类型为std::vector<ecc::deal::po::COrderTradePo> 
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.ecc.deal.idl.OrderTradePoList.java

if (!class_exists('OrderTradePo')) {
class OrderTradePo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 订单编号，可为空
		 *
		 * 版本 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * 订单单号，拍拍订单同步可使用，可为空
		 *
		 * 版本 >= 0
		 */
		var $ddwDealId64; //uint64_t

		/**
		 * 交易单号，可为空
		 *
		 * 版本 >= 0
		 */
		var $ddwBdealId; //uint64_t

		/**
		 * 商品订单号，拍拍订单同步可使用，可为空
		 *
		 * 版本 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * 买家ID
		 *
		 * 版本 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * 买家昵称
		 *
		 * 版本 >= 0
		 */
		var $strBuyerNickName; //std::string

		/**
		 * 商家ID
		 *
		 * 版本 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * 商家名称
		 *
		 * 版本 >= 0
		 */
		var $strSellerTitle; //std::string

		/**
		 * 业务ID
		 *
		 * 版本 >= 0
		 */
		var $dwBusinessId; //uint32_t

		/**
		 * 订单类型
		 *
		 * 版本 >= 0
		 */
		var $cTradeType; //uint8_t

		/**
		 * 下单渠道：1：业务主站；2：移动app；3：移动wap
		 *
		 * 版本 >= 0
		 */
		var $dwTradeSource; //uint32_t

		/**
		 * 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款
		 *
		 * 版本 >= 0
		 */
		var $cTradePayType; //uint8_t

		/**
		 * 运费模版ID
		 *
		 * 版本 >= 0
		 */
		var $strShippingfeeTemplateId; //std::string

		/**
		 * 运费描述
		 *
		 * 版本 >= 0
		 */
		var $strShippingfeeDesc; //std::string

		/**
		 * 商品运费,不参与金额计算，只做展示，商品系统传入
		 *
		 * 版本 >= 0
		 */
		var $dwItemShippingfee; //uint32_t

		/**
		 * 商品类型；1：普通商品；2：套餐主商品；3：套餐副商品；4：赠品主商品；5：赠品副商品; 6: 组件
		 *
		 * 版本 >= 0
		 */
		var $dwItemType; //uint32_t

		/**
		 * 品类（类目）ID
		 *
		 * 版本 >= 0
		 */
		var $dwItemClassId; //uint32_t

		/**
		 * 商品标题
		 *
		 * 版本 >= 0
		 */
		var $strItemTitle; //std::string

		/**
		 * 商品销售属性编码
		 *
		 * 版本 >= 0
		 */
		var $strItemAttrCode; //std::string

		/**
		 * 商品销售属性描述
		 *
		 * 版本 >= 0
		 */
		var $strItemAttr; //std::string

		/**
		 * 商品ID，由业务定义
		 *
		 * 版本 >= 0
		 */
		var $strItemId; //std::string

		/**
		 * 商品SKUID
		 *
		 * 版本 >= 0
		 */
		var $ddwItemSkuId; //uint64_t

		/**
		 * 商品商家本地编码
		 *
		 * 版本 >= 0
		 */
		var $strItemLocalCode; //std::string

		/**
		 * 商品商家本地库存编码
		 *
		 * 版本 >= 0
		 */
		var $strItemLocalStockCode; //std::string

		/**
		 * 商品条形码
		 *
		 * 版本 >= 0
		 */
		var $strItemBarCode; //std::string

		/**
		 * 商品SPUID
		 *
		 * 版本 >= 0
		 */
		var $ddwItemSpuId; //uint64_t

		/**
		 * 商品库存ID
		 *
		 * 版本 >= 0
		 */
		var $ddwItemStockId; //uint64_t

		/**
		 * 商品仓库ID
		 *
		 * 版本 >= 0
		 */
		var $dwItemStoreHouseId; //uint32_t

		/**
		 * 商品所属物理仓
		 *
		 * 版本 >= 0
		 */
		var $strItemPhyisicalStorage; //std::string

		/**
		 * 商品图片Logo
		 *
		 * 版本 >= 0
		 */
		var $strItemLogo; //std::string

		/**
		 * 商品快照版本号
		 *
		 * 版本 >= 0
		 */
		var $dwItemSnapVersion; //uint32_t

		/**
		 * 商品重置时间戳
		 *
		 * 版本 >= 0
		 */
		var $dwItemResetTime; //uint32_t

		/**
		 * 商品重量
		 *
		 * 版本 >= 0
		 */
		var $dwItemWeight; //uint32_t

		/**
		 * 商品体积
		 *
		 * 版本 >= 0
		 */
		var $dwItemVolume; //uint32_t

		/**
		 * 商品套餐主商品ID
		 *
		 * 版本 >= 0
		 */
		var $ddwMainItemId; //uint64_t

		/**
		 * 商品标配说明
		 *
		 * 版本 >= 0
		 */
		var $strItemAccessoryDesc; //std::string

		/**
		 * 商品成本价
		 *
		 * 版本 >= 0
		 */
		var $dwItemCostPrice; //uint32_t

		/**
		 * 商品市场价
		 *
		 * 版本 >= 0
		 */
		var $dwItemOriginPrice; //uint32_t

		/**
		 * 商品销售单价
		 *
		 * 版本 >= 0
		 */
		var $dwItemSoldPrice; //uint32_t

		/**
		 * 自营B2C市场
		 *
		 * 版本 >= 0
		 */
		var $strItemB2CMarket; //std::string

		/**
		 * 自营B2CPM
		 *
		 * 版本 >= 0
		 */
		var $strItemB2CPM; //std::string

		/**
		 * 自营B2C是否占用虚库
		 *
		 * 版本 >= 0
		 */
		var $cItemUseVirtualStock; //uint8_t

		/**
		 * 商品成交价
		 *
		 * 版本 >= 0
		 */
		var $dwBuyPrice; //uint32_t

		/**
		 * 商品成交件数
		 *
		 * 版本 >= 0
		 */
		var $dwBuyNum; //uint32_t

		/**
		 * 商品单总金额,下单金额
		 *
		 * 版本 >= 0
		 */
		var $dwTradeTotalFee; //uint32_t

		/**
		 * 商品单调价金额
		 *
		 * 版本 >= 0
		 */
		var $nTradeAdjustFee; //int

		/**
		 * 实付总金额
		 *
		 * 版本 >= 0
		 */
		var $dwTradePayment; //uint32_t

		/**
		 * 优惠总金额
		 *
		 * 版本 >= 0
		 */
		var $nTradeDiscountTotal; //int

		/**
		 * Paipai红包使用金额
		 *
		 * 版本 >= 0
		 */
		var $dwTradePaipaiHongbaoUsed; //uint32_t

		/**
		 * 积分支付值
		 *
		 * 版本 >= 0
		 */
		var $dwPayScore; //uint32_t

		/**
		 * 商品单生成时间
		 *
		 * 版本 >= 0
		 */
		var $dwTradeGenTime; //uint32_t

		/**
		 * 商品单库存操作序列号
		 *
		 * 版本 >= 0
		 */
		var $wTradeOpSerialNo; //uint16_t

		/**
		 * 获得积分值
		 *
		 * 版本 >= 0
		 */
		var $dwObtainScore; //uint32_t

		/**
		 * 商品单状态
		 *
		 * 版本 >= 0
		 */
		var $dwTradeState; //uint32_t

		/**
		 * 商品单属性值
		 *
		 * 版本 >= 0
		 */
		var $dwTradeProperty; //uint32_t

		/**
		 * 商品单属性值1
		 *
		 * 版本 >= 0
		 */
		var $dwTradeProperty1; //uint32_t

		/**
		 * 商品单属性值2
		 *
		 * 版本 >= 0
		 */
		var $dwTradeProperty2; //uint32_t

		/**
		 * 商品单属性值3
		 *
		 * 版本 >= 0
		 */
		var $dwTradeProperty3; //uint32_t

		/**
		 * 商品单属性值4
		 *
		 * 版本 >= 0
		 */
		var $dwTradeProperty4; //uint32_t

		/**
		 * 商品超时标识
		 *
		 * 版本 >= 0
		 */
		var $dwItemTimeoutFlag; //uint32_t

		/**
		 * 最后更新时间
		 *
		 * 版本 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * 商品活动列表
		 *
		 * 版本 >= 0
		 */
		var $oActiveInfoList; //ecc::deal::po::CTradeActivePoList

		/**
		 * 订单扩展信息 
		 *
		 * 版本 >= 0
		 */
		var $mmapDealExtInfoMap; //std::multimap<uint32_t,std::string> 

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId64_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBdealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerNickName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerTitle_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBusinessId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeSource_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradePayType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cShippingfeeTemplateId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cShippingfeeDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemShippingfee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemClassId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemTitle_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemAttrCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemAttr_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemSkuId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemLocalCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemLocalStockCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemBarCode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemSpuId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemStockId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemStoreHouseId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemPhyisicalStorage_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemLogo_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemSnapVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemResetTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemWeight_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemVolume_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cMainItemId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemAccessoryDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemCostPrice_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemOriginPrice_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemSoldPrice_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemB2CMarket_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemB2CPM_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemUseVirtualStock_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyPrice_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyNum_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeTotalFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeAdjustFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradePayment_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeDiscountTotal_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradePaipaiHongbaoUsed_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayScore_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeGenTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeOpSerialNo_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cObtainScore_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeProperty_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeProperty1_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeProperty2_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeProperty3_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeProperty4_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemTimeoutFlag_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cActiveInfoList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealExtInfoMap_u; //uint8_t

		/**
		 * 保修条款
		 *
		 * 版本 >= 1
		 */
		var $strWarranty; //std::string

		/**
		 * 产品id
		 *
		 * 版本 >= 1
		 */
		var $ddwProductId; //uint64_t

		/**
		 * 产品id编码
		 *
		 * 版本 >= 1
		 */
		var $strProductCode; //std::string

		/**
		 * 易迅edm编码
		 *
		 * 版本 >= 1
		 */
		var $strIcsonEdmCode; //std::string

		/**
		 * 易迅OTag
		 *
		 * 版本 >= 1
		 */
		var $strIcsonOTag; //std::string

		/**
		 * 易迅店铺导购费用
		 *
		 * 版本 >= 1
		 */
		var $strIcsonTradeShopGuideCost; //std::string

		/**
		 * 易迅定制机类型
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneType; //std::string

		/**
		 * 易迅定制机运营商
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneOperator; //std::string

		/**
		 * 易迅定制机号码
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneNumber; //std::string

		/**
		 * 易迅定制机归属地
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneArea; //std::string

		/**
		 * 易迅定制机套餐id
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhonePackageId; //std::string

		/**
		 * 易迅定制机用户姓名
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneUserName; //std::string

		/**
		 * 易迅定制机用户地址
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneUserAddr; //std::string

		/**
		 * 易迅定制机用户联系手机
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneUserMobile; //std::string

		/**
		 * 易迅定制机用户联系电话
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneUserTel; //std::string

		/**
		 * 易迅定制机身份证号码
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneIdCardNo; //std::string

		/**
		 * 易迅定制机身份证地址
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneIdCardAddr; //std::string

		/**
		 * 易迅定制机身份证有效期
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneIdCardDate; //std::string

		/**
		 * 易迅定制机邮政编码
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneZipCode; //std::string

		/**
		 * 易迅定制机卡价格
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhoneCardPrice; //std::string

		/**
		 * 易迅定制机套餐价格
		 *
		 * 版本 >= 1
		 */
		var $strIcsonCSPhonePackagePrice; //std::string

		/**
		 * 易迅商品子单flag
		 *
		 * 版本 >= 1
		 */
		var $strIcsonTradeFlag; //std::string

		/**
		 * 易迅积分兑换类型
		 *
		 * 版本 >= 1
		 */
		var $strIcsonPointType; //std::string

		/**
		 * 易迅商品子单套餐id
		 *
		 * 版本 >= 1
		 */
		var $strIcsonPackageIds; //std::string

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cWarranty_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cProductId_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cProductCode_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonEdmCode_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonOTag_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonTradeShopGuideCost_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneType_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneOperator_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneNumber_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneArea_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhonePackageId_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneUserName_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneUserAddr_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneUserMobile_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneUserTel_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneIdCardNo_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneIdCardAddr_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneIdCardDate_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneZipCode_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhoneCardPrice_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonCSPhonePackagePrice_u; //uint8_t

		/**
		 * 易迅商品子单flag
		 *
		 * 版本 >= 1
		 */
		var $cIcsonTradeFlag_u; //uint8_t

		/**
		 * 易迅积分兑换类型
		 *
		 * 版本 >= 1
		 */
		var $cIcsonPointType_u; //uint8_t

		/**
		 * 易迅商品子单套餐id
		 *
		 * 版本 >= 1
		 */
		var $cIcsonPackageIds_u; //uint8_t

		/**
		 * 子单返现金额
		 *
		 * 版本 >= 2
		 */
		var $dwIcsonTradeCashBack; //uint32_t

		/**
		 * 子单返现金额UFlag
		 *
		 * 版本 >= 2
		 */
		var $cIcsonTradeCashBack_u; //uint8_t

		/**
		 * 去税后成本
		 *
		 * 版本 >= 3
		 */
		var $strIcsonUnitCostInvoice; //std::string

		/**
		 * 去税后成本UFlag
		 *
		 * 版本 >= 3
		 */
		var $cIcsonUnitCostInvoice_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 3; // uint16_t
			 $this->strDealId = ""; // std::string
			 $this->ddwDealId64 = 0; // uint64_t
			 $this->ddwBdealId = 0; // uint64_t
			 $this->ddwTradeId = 0; // uint64_t
			 $this->ddwBuyerId = 0; // uint64_t
			 $this->strBuyerNickName = ""; // std::string
			 $this->ddwSellerId = 0; // uint64_t
			 $this->strSellerTitle = ""; // std::string
			 $this->dwBusinessId = 0; // uint32_t
			 $this->cTradeType = 0; // uint8_t
			 $this->dwTradeSource = 0; // uint32_t
			 $this->cTradePayType = 0; // uint8_t
			 $this->strShippingfeeTemplateId = ""; // std::string
			 $this->strShippingfeeDesc = ""; // std::string
			 $this->dwItemShippingfee = 0; // uint32_t
			 $this->dwItemType = 0; // uint32_t
			 $this->dwItemClassId = 0; // uint32_t
			 $this->strItemTitle = ""; // std::string
			 $this->strItemAttrCode = ""; // std::string
			 $this->strItemAttr = ""; // std::string
			 $this->strItemId = ""; // std::string
			 $this->ddwItemSkuId = 0; // uint64_t
			 $this->strItemLocalCode = ""; // std::string
			 $this->strItemLocalStockCode = ""; // std::string
			 $this->strItemBarCode = ""; // std::string
			 $this->ddwItemSpuId = 0; // uint64_t
			 $this->ddwItemStockId = 0; // uint64_t
			 $this->dwItemStoreHouseId = 0; // uint32_t
			 $this->strItemPhyisicalStorage = ""; // std::string
			 $this->strItemLogo = ""; // std::string
			 $this->dwItemSnapVersion = 0; // uint32_t
			 $this->dwItemResetTime = 0; // uint32_t
			 $this->dwItemWeight = 0; // uint32_t
			 $this->dwItemVolume = 0; // uint32_t
			 $this->ddwMainItemId = 0; // uint64_t
			 $this->strItemAccessoryDesc = ""; // std::string
			 $this->dwItemCostPrice = 0; // uint32_t
			 $this->dwItemOriginPrice = 0; // uint32_t
			 $this->dwItemSoldPrice = 0; // uint32_t
			 $this->strItemB2CMarket = ""; // std::string
			 $this->strItemB2CPM = ""; // std::string
			 $this->cItemUseVirtualStock = 0; // uint8_t
			 $this->dwBuyPrice = 0; // uint32_t
			 $this->dwBuyNum = 0; // uint32_t
			 $this->dwTradeTotalFee = 0; // uint32_t
			 $this->nTradeAdjustFee = 0; // int
			 $this->dwTradePayment = 0; // uint32_t
			 $this->nTradeDiscountTotal = 0; // int
			 $this->dwTradePaipaiHongbaoUsed = 0; // uint32_t
			 $this->dwPayScore = 0; // uint32_t
			 $this->dwTradeGenTime = 0; // uint32_t
			 $this->wTradeOpSerialNo = 0; // uint16_t
			 $this->dwObtainScore = 0; // uint32_t
			 $this->dwTradeState = 0; // uint32_t
			 $this->dwTradeProperty = 0; // uint32_t
			 $this->dwTradeProperty1 = 0; // uint32_t
			 $this->dwTradeProperty2 = 0; // uint32_t
			 $this->dwTradeProperty3 = 0; // uint32_t
			 $this->dwTradeProperty4 = 0; // uint32_t
			 $this->dwItemTimeoutFlag = 0; // uint32_t
			 $this->dwLastUpdateTime = 0; // uint32_t
			 $this->oActiveInfoList = new TradeActivePoList(); // ecc::deal::po::CTradeActivePoList
			 $this->mmapDealExtInfoMap = new stl_multimap('uint32_t,stl_string'); // std::multimap<uint32_t,std::string> 
			 $this->cVersion_u = 0; // uint8_t
			 $this->cDealId_u = 0; // uint8_t
			 $this->cDealId64_u = 0; // uint8_t
			 $this->cBdealId_u = 0; // uint8_t
			 $this->cTradeId_u = 0; // uint8_t
			 $this->cBuyerId_u = 0; // uint8_t
			 $this->cBuyerNickName_u = 0; // uint8_t
			 $this->cSellerId_u = 0; // uint8_t
			 $this->cSellerTitle_u = 0; // uint8_t
			 $this->cBusinessId_u = 0; // uint8_t
			 $this->cTradeType_u = 0; // uint8_t
			 $this->cTradeSource_u = 0; // uint8_t
			 $this->cTradePayType_u = 0; // uint8_t
			 $this->cShippingfeeTemplateId_u = 0; // uint8_t
			 $this->cShippingfeeDesc_u = 0; // uint8_t
			 $this->cItemShippingfee_u = 0; // uint8_t
			 $this->cItemType_u = 0; // uint8_t
			 $this->cItemClassId_u = 0; // uint8_t
			 $this->cItemTitle_u = 0; // uint8_t
			 $this->cItemAttrCode_u = 0; // uint8_t
			 $this->cItemAttr_u = 0; // uint8_t
			 $this->cItemId_u = 0; // uint8_t
			 $this->cItemSkuId_u = 0; // uint8_t
			 $this->cItemLocalCode_u = 0; // uint8_t
			 $this->cItemLocalStockCode_u = 0; // uint8_t
			 $this->cItemBarCode_u = 0; // uint8_t
			 $this->cItemSpuId_u = 0; // uint8_t
			 $this->cItemStockId_u = 0; // uint8_t
			 $this->cItemStoreHouseId_u = 0; // uint8_t
			 $this->cItemPhyisicalStorage_u = 0; // uint8_t
			 $this->cItemLogo_u = 0; // uint8_t
			 $this->cItemSnapVersion_u = 0; // uint8_t
			 $this->cItemResetTime_u = 0; // uint8_t
			 $this->cItemWeight_u = 0; // uint8_t
			 $this->cItemVolume_u = 0; // uint8_t
			 $this->cMainItemId_u = 0; // uint8_t
			 $this->cItemAccessoryDesc_u = 0; // uint8_t
			 $this->cItemCostPrice_u = 0; // uint8_t
			 $this->cItemOriginPrice_u = 0; // uint8_t
			 $this->cItemSoldPrice_u = 0; // uint8_t
			 $this->cItemB2CMarket_u = 0; // uint8_t
			 $this->cItemB2CPM_u = 0; // uint8_t
			 $this->cItemUseVirtualStock_u = 0; // uint8_t
			 $this->cBuyPrice_u = 0; // uint8_t
			 $this->cBuyNum_u = 0; // uint8_t
			 $this->cTradeTotalFee_u = 0; // uint8_t
			 $this->cTradeAdjustFee_u = 0; // uint8_t
			 $this->cTradePayment_u = 0; // uint8_t
			 $this->cTradeDiscountTotal_u = 0; // uint8_t
			 $this->cTradePaipaiHongbaoUsed_u = 0; // uint8_t
			 $this->cPayScore_u = 0; // uint8_t
			 $this->cTradeGenTime_u = 0; // uint8_t
			 $this->cTradeOpSerialNo_u = 0; // uint8_t
			 $this->cObtainScore_u = 0; // uint8_t
			 $this->cTradeState_u = 0; // uint8_t
			 $this->cTradeProperty_u = 0; // uint8_t
			 $this->cTradeProperty1_u = 0; // uint8_t
			 $this->cTradeProperty2_u = 0; // uint8_t
			 $this->cTradeProperty3_u = 0; // uint8_t
			 $this->cTradeProperty4_u = 0; // uint8_t
			 $this->cItemTimeoutFlag_u = 0; // uint8_t
			 $this->cLastUpdateTime_u = 0; // uint8_t
			 $this->cActiveInfoList_u = 0; // uint8_t
			 $this->cDealExtInfoMap_u = 0; // uint8_t
			 $this->strWarranty = ""; // std::string
			 $this->ddwProductId = 0; // uint64_t
			 $this->strProductCode = ""; // std::string
			 $this->strIcsonEdmCode = ""; // std::string
			 $this->strIcsonOTag = ""; // std::string
			 $this->strIcsonTradeShopGuideCost = ""; // std::string
			 $this->strIcsonCSPhoneType = ""; // std::string
			 $this->strIcsonCSPhoneOperator = ""; // std::string
			 $this->strIcsonCSPhoneNumber = ""; // std::string
			 $this->strIcsonCSPhoneArea = ""; // std::string
			 $this->strIcsonCSPhonePackageId = ""; // std::string
			 $this->strIcsonCSPhoneUserName = ""; // std::string
			 $this->strIcsonCSPhoneUserAddr = ""; // std::string
			 $this->strIcsonCSPhoneUserMobile = ""; // std::string
			 $this->strIcsonCSPhoneUserTel = ""; // std::string
			 $this->strIcsonCSPhoneIdCardNo = ""; // std::string
			 $this->strIcsonCSPhoneIdCardAddr = ""; // std::string
			 $this->strIcsonCSPhoneIdCardDate = ""; // std::string
			 $this->strIcsonCSPhoneZipCode = ""; // std::string
			 $this->strIcsonCSPhoneCardPrice = ""; // std::string
			 $this->strIcsonCSPhonePackagePrice = ""; // std::string
			 $this->strIcsonTradeFlag = ""; // std::string
			 $this->strIcsonPointType = ""; // std::string
			 $this->strIcsonPackageIds = ""; // std::string
			 $this->cWarranty_u = 0; // uint8_t
			 $this->cProductId_u = 0; // uint8_t
			 $this->cProductCode_u = 0; // uint8_t
			 $this->cIcsonEdmCode_u = 0; // uint8_t
			 $this->cIcsonOTag_u = 0; // uint8_t
			 $this->cIcsonTradeShopGuideCost_u = 0; // uint8_t
			 $this->cIcsonCSPhoneType_u = 0; // uint8_t
			 $this->cIcsonCSPhoneOperator_u = 0; // uint8_t
			 $this->cIcsonCSPhoneNumber_u = 0; // uint8_t
			 $this->cIcsonCSPhoneArea_u = 0; // uint8_t
			 $this->cIcsonCSPhonePackageId_u = 0; // uint8_t
			 $this->cIcsonCSPhoneUserName_u = 0; // uint8_t
			 $this->cIcsonCSPhoneUserAddr_u = 0; // uint8_t
			 $this->cIcsonCSPhoneUserMobile_u = 0; // uint8_t
			 $this->cIcsonCSPhoneUserTel_u = 0; // uint8_t
			 $this->cIcsonCSPhoneIdCardNo_u = 0; // uint8_t
			 $this->cIcsonCSPhoneIdCardAddr_u = 0; // uint8_t
			 $this->cIcsonCSPhoneIdCardDate_u = 0; // uint8_t
			 $this->cIcsonCSPhoneZipCode_u = 0; // uint8_t
			 $this->cIcsonCSPhoneCardPrice_u = 0; // uint8_t
			 $this->cIcsonCSPhonePackagePrice_u = 0; // uint8_t
			 $this->cIcsonTradeFlag_u = 0; // uint8_t
			 $this->cIcsonPointType_u = 0; // uint8_t
			 $this->cIcsonPackageIds_u = 0; // uint8_t
			 $this->dwIcsonTradeCashBack = 0; // uint32_t
			 $this->cIcsonTradeCashBack_u = 0; // uint8_t
			 $this->strIcsonUnitCostInvoice = ""; // std::string
			 $this->cIcsonUnitCostInvoice_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushString($this->strDealId); // 序列化订单编号，可为空 类型为std::string
			$bs->pushUint64_t($this->ddwDealId64); // 序列化订单单号，拍拍订单同步可使用，可为空 类型为uint64_t
			$bs->pushUint64_t($this->ddwBdealId); // 序列化交易单号，可为空 类型为uint64_t
			$bs->pushUint64_t($this->ddwTradeId); // 序列化商品订单号，拍拍订单同步可使用，可为空 类型为uint64_t
			$bs->pushUint64_t($this->ddwBuyerId); // 序列化买家ID 类型为uint64_t
			$bs->pushString($this->strBuyerNickName); // 序列化买家昵称 类型为std::string
			$bs->pushUint64_t($this->ddwSellerId); // 序列化商家ID 类型为uint64_t
			$bs->pushString($this->strSellerTitle); // 序列化商家名称 类型为std::string
			$bs->pushUint32_t($this->dwBusinessId); // 序列化业务ID 类型为uint32_t
			$bs->pushUint8_t($this->cTradeType); // 序列化订单类型 类型为uint8_t
			$bs->pushUint32_t($this->dwTradeSource); // 序列化下单渠道：1：业务主站；2：移动app；3：移动wap 类型为uint32_t
			$bs->pushUint8_t($this->cTradePayType); // 序列化支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款 类型为uint8_t
			$bs->pushString($this->strShippingfeeTemplateId); // 序列化运费模版ID 类型为std::string
			$bs->pushString($this->strShippingfeeDesc); // 序列化运费描述 类型为std::string
			$bs->pushUint32_t($this->dwItemShippingfee); // 序列化商品运费,不参与金额计算，只做展示，商品系统传入 类型为uint32_t
			$bs->pushUint32_t($this->dwItemType); // 序列化商品类型；1：普通商品；2：套餐主商品；3：套餐副商品；4：赠品主商品；5：赠品副商品; 6: 组件 类型为uint32_t
			$bs->pushUint32_t($this->dwItemClassId); // 序列化品类（类目）ID 类型为uint32_t
			$bs->pushString($this->strItemTitle); // 序列化商品标题 类型为std::string
			$bs->pushString($this->strItemAttrCode); // 序列化商品销售属性编码 类型为std::string
			$bs->pushString($this->strItemAttr); // 序列化商品销售属性描述 类型为std::string
			$bs->pushString($this->strItemId); // 序列化商品ID，由业务定义 类型为std::string
			$bs->pushUint64_t($this->ddwItemSkuId); // 序列化商品SKUID 类型为uint64_t
			$bs->pushString($this->strItemLocalCode); // 序列化商品商家本地编码 类型为std::string
			$bs->pushString($this->strItemLocalStockCode); // 序列化商品商家本地库存编码 类型为std::string
			$bs->pushString($this->strItemBarCode); // 序列化商品条形码 类型为std::string
			$bs->pushUint64_t($this->ddwItemSpuId); // 序列化商品SPUID 类型为uint64_t
			$bs->pushUint64_t($this->ddwItemStockId); // 序列化商品库存ID 类型为uint64_t
			$bs->pushUint32_t($this->dwItemStoreHouseId); // 序列化商品仓库ID 类型为uint32_t
			$bs->pushString($this->strItemPhyisicalStorage); // 序列化商品所属物理仓 类型为std::string
			$bs->pushString($this->strItemLogo); // 序列化商品图片Logo 类型为std::string
			$bs->pushUint32_t($this->dwItemSnapVersion); // 序列化商品快照版本号 类型为uint32_t
			$bs->pushUint32_t($this->dwItemResetTime); // 序列化商品重置时间戳 类型为uint32_t
			$bs->pushUint32_t($this->dwItemWeight); // 序列化商品重量 类型为uint32_t
			$bs->pushUint32_t($this->dwItemVolume); // 序列化商品体积 类型为uint32_t
			$bs->pushUint64_t($this->ddwMainItemId); // 序列化商品套餐主商品ID 类型为uint64_t
			$bs->pushString($this->strItemAccessoryDesc); // 序列化商品标配说明 类型为std::string
			$bs->pushUint32_t($this->dwItemCostPrice); // 序列化商品成本价 类型为uint32_t
			$bs->pushUint32_t($this->dwItemOriginPrice); // 序列化商品市场价 类型为uint32_t
			$bs->pushUint32_t($this->dwItemSoldPrice); // 序列化商品销售单价 类型为uint32_t
			$bs->pushString($this->strItemB2CMarket); // 序列化自营B2C市场 类型为std::string
			$bs->pushString($this->strItemB2CPM); // 序列化自营B2CPM 类型为std::string
			$bs->pushUint8_t($this->cItemUseVirtualStock); // 序列化自营B2C是否占用虚库 类型为uint8_t
			$bs->pushUint32_t($this->dwBuyPrice); // 序列化商品成交价 类型为uint32_t
			$bs->pushUint32_t($this->dwBuyNum); // 序列化商品成交件数 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeTotalFee); // 序列化商品单总金额,下单金额 类型为uint32_t
			$bs->pushInt32_t($this->nTradeAdjustFee); // 序列化商品单调价金额 类型为int
			$bs->pushUint32_t($this->dwTradePayment); // 序列化实付总金额 类型为uint32_t
			$bs->pushInt32_t($this->nTradeDiscountTotal); // 序列化优惠总金额 类型为int
			$bs->pushUint32_t($this->dwTradePaipaiHongbaoUsed); // 序列化Paipai红包使用金额 类型为uint32_t
			$bs->pushUint32_t($this->dwPayScore); // 序列化积分支付值 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeGenTime); // 序列化商品单生成时间 类型为uint32_t
			$bs->pushUint16_t($this->wTradeOpSerialNo); // 序列化商品单库存操作序列号 类型为uint16_t
			$bs->pushUint32_t($this->dwObtainScore); // 序列化获得积分值 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeState); // 序列化商品单状态 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeProperty); // 序列化商品单属性值 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeProperty1); // 序列化商品单属性值1 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeProperty2); // 序列化商品单属性值2 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeProperty3); // 序列化商品单属性值3 类型为uint32_t
			$bs->pushUint32_t($this->dwTradeProperty4); // 序列化商品单属性值4 类型为uint32_t
			$bs->pushUint32_t($this->dwItemTimeoutFlag); // 序列化商品超时标识 类型为uint32_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // 序列化最后更新时间 类型为uint32_t
			$bs->pushObject($this->oActiveInfoList,'TradeActivePoList'); // 序列化商品活动列表 类型为ecc::deal::po::CTradeActivePoList
			$bs->pushObject($this->mmapDealExtInfoMap,'stl_multimap'); // 序列化订单扩展信息  类型为std::multimap<uint32_t,std::string> 
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId64_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBdealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerNickName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerTitle_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBusinessId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeSource_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradePayType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cShippingfeeTemplateId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cShippingfeeDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemShippingfee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemClassId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemTitle_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemAttrCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemAttr_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemLocalCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemLocalStockCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemBarCode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemSpuId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemStockId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemStoreHouseId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemPhyisicalStorage_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemLogo_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemSnapVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemResetTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemWeight_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemVolume_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cMainItemId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemAccessoryDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemCostPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemOriginPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemSoldPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemB2CMarket_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemB2CPM_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemUseVirtualStock_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyNum_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeTotalFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeAdjustFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradePayment_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeDiscountTotal_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradePaipaiHongbaoUsed_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayScore_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeGenTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeOpSerialNo_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cObtainScore_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeProperty_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeProperty1_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeProperty2_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeProperty3_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeProperty4_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemTimeoutFlag_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cActiveInfoList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealExtInfoMap_u); // 序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strWarranty); // 序列化保修条款 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint64_t($this->ddwProductId); // 序列化产品id 类型为uint64_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strProductCode); // 序列化产品id编码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonEdmCode); // 序列化易迅edm编码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonOTag); // 序列化易迅OTag 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonTradeShopGuideCost); // 序列化易迅店铺导购费用 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneType); // 序列化易迅定制机类型 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneOperator); // 序列化易迅定制机运营商 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneNumber); // 序列化易迅定制机号码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneArea); // 序列化易迅定制机归属地 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhonePackageId); // 序列化易迅定制机套餐id 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneUserName); // 序列化易迅定制机用户姓名 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneUserAddr); // 序列化易迅定制机用户地址 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneUserMobile); // 序列化易迅定制机用户联系手机 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneUserTel); // 序列化易迅定制机用户联系电话 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneIdCardNo); // 序列化易迅定制机身份证号码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneIdCardAddr); // 序列化易迅定制机身份证地址 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneIdCardDate); // 序列化易迅定制机身份证有效期 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneZipCode); // 序列化易迅定制机邮政编码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneCardPrice); // 序列化易迅定制机卡价格 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhonePackagePrice); // 序列化易迅定制机套餐价格 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonTradeFlag); // 序列化易迅商品子单flag 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonPointType); // 序列化易迅积分兑换类型 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonPackageIds); // 序列化易迅商品子单套餐id 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cWarranty_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cProductId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cProductCode_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonEdmCode_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonOTag_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonTradeShopGuideCost_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneType_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneOperator_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneNumber_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneArea_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhonePackageId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneUserName_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneUserAddr_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneUserMobile_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneUserTel_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneIdCardNo_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneIdCardAddr_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneIdCardDate_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneZipCode_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneCardPrice_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhonePackagePrice_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonTradeFlag_u); // 序列化易迅商品子单flag 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonPointType_u); // 序列化易迅积分兑换类型 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonPackageIds_u); // 序列化易迅商品子单套餐id 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwIcsonTradeCashBack); // 序列化子单返现金额 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cIcsonTradeCashBack_u); // 序列化子单返现金额UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 3 ){
				$bs->pushString($this->strIcsonUnitCostInvoice); // 序列化去税后成本 类型为std::string
			}
			if(  $this->wVersion >= 3 ){
				$bs->pushUint8_t($this->cIcsonUnitCostInvoice_u); // 序列化去税后成本UFlag 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->strDealId = $bs->popString(); // 反序列化订单编号，可为空 类型为std::string
			$this->ddwDealId64 = $bs->popUint64_t(); // 反序列化订单单号，拍拍订单同步可使用，可为空 类型为uint64_t
			$this->ddwBdealId = $bs->popUint64_t(); // 反序列化交易单号，可为空 类型为uint64_t
			$this->ddwTradeId = $bs->popUint64_t(); // 反序列化商品订单号，拍拍订单同步可使用，可为空 类型为uint64_t
			$this->ddwBuyerId = $bs->popUint64_t(); // 反序列化买家ID 类型为uint64_t
			$this->strBuyerNickName = $bs->popString(); // 反序列化买家昵称 类型为std::string
			$this->ddwSellerId = $bs->popUint64_t(); // 反序列化商家ID 类型为uint64_t
			$this->strSellerTitle = $bs->popString(); // 反序列化商家名称 类型为std::string
			$this->dwBusinessId = $bs->popUint32_t(); // 反序列化业务ID 类型为uint32_t
			$this->cTradeType = $bs->popUint8_t(); // 反序列化订单类型 类型为uint8_t
			$this->dwTradeSource = $bs->popUint32_t(); // 反序列化下单渠道：1：业务主站；2：移动app；3：移动wap 类型为uint32_t
			$this->cTradePayType = $bs->popUint8_t(); // 反序列化支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款 类型为uint8_t
			$this->strShippingfeeTemplateId = $bs->popString(); // 反序列化运费模版ID 类型为std::string
			$this->strShippingfeeDesc = $bs->popString(); // 反序列化运费描述 类型为std::string
			$this->dwItemShippingfee = $bs->popUint32_t(); // 反序列化商品运费,不参与金额计算，只做展示，商品系统传入 类型为uint32_t
			$this->dwItemType = $bs->popUint32_t(); // 反序列化商品类型；1：普通商品；2：套餐主商品；3：套餐副商品；4：赠品主商品；5：赠品副商品; 6: 组件 类型为uint32_t
			$this->dwItemClassId = $bs->popUint32_t(); // 反序列化品类（类目）ID 类型为uint32_t
			$this->strItemTitle = $bs->popString(); // 反序列化商品标题 类型为std::string
			$this->strItemAttrCode = $bs->popString(); // 反序列化商品销售属性编码 类型为std::string
			$this->strItemAttr = $bs->popString(); // 反序列化商品销售属性描述 类型为std::string
			$this->strItemId = $bs->popString(); // 反序列化商品ID，由业务定义 类型为std::string
			$this->ddwItemSkuId = $bs->popUint64_t(); // 反序列化商品SKUID 类型为uint64_t
			$this->strItemLocalCode = $bs->popString(); // 反序列化商品商家本地编码 类型为std::string
			$this->strItemLocalStockCode = $bs->popString(); // 反序列化商品商家本地库存编码 类型为std::string
			$this->strItemBarCode = $bs->popString(); // 反序列化商品条形码 类型为std::string
			$this->ddwItemSpuId = $bs->popUint64_t(); // 反序列化商品SPUID 类型为uint64_t
			$this->ddwItemStockId = $bs->popUint64_t(); // 反序列化商品库存ID 类型为uint64_t
			$this->dwItemStoreHouseId = $bs->popUint32_t(); // 反序列化商品仓库ID 类型为uint32_t
			$this->strItemPhyisicalStorage = $bs->popString(); // 反序列化商品所属物理仓 类型为std::string
			$this->strItemLogo = $bs->popString(); // 反序列化商品图片Logo 类型为std::string
			$this->dwItemSnapVersion = $bs->popUint32_t(); // 反序列化商品快照版本号 类型为uint32_t
			$this->dwItemResetTime = $bs->popUint32_t(); // 反序列化商品重置时间戳 类型为uint32_t
			$this->dwItemWeight = $bs->popUint32_t(); // 反序列化商品重量 类型为uint32_t
			$this->dwItemVolume = $bs->popUint32_t(); // 反序列化商品体积 类型为uint32_t
			$this->ddwMainItemId = $bs->popUint64_t(); // 反序列化商品套餐主商品ID 类型为uint64_t
			$this->strItemAccessoryDesc = $bs->popString(); // 反序列化商品标配说明 类型为std::string
			$this->dwItemCostPrice = $bs->popUint32_t(); // 反序列化商品成本价 类型为uint32_t
			$this->dwItemOriginPrice = $bs->popUint32_t(); // 反序列化商品市场价 类型为uint32_t
			$this->dwItemSoldPrice = $bs->popUint32_t(); // 反序列化商品销售单价 类型为uint32_t
			$this->strItemB2CMarket = $bs->popString(); // 反序列化自营B2C市场 类型为std::string
			$this->strItemB2CPM = $bs->popString(); // 反序列化自营B2CPM 类型为std::string
			$this->cItemUseVirtualStock = $bs->popUint8_t(); // 反序列化自营B2C是否占用虚库 类型为uint8_t
			$this->dwBuyPrice = $bs->popUint32_t(); // 反序列化商品成交价 类型为uint32_t
			$this->dwBuyNum = $bs->popUint32_t(); // 反序列化商品成交件数 类型为uint32_t
			$this->dwTradeTotalFee = $bs->popUint32_t(); // 反序列化商品单总金额,下单金额 类型为uint32_t
			$this->nTradeAdjustFee = $bs->popInt32_t(); // 反序列化商品单调价金额 类型为int
			$this->dwTradePayment = $bs->popUint32_t(); // 反序列化实付总金额 类型为uint32_t
			$this->nTradeDiscountTotal = $bs->popInt32_t(); // 反序列化优惠总金额 类型为int
			$this->dwTradePaipaiHongbaoUsed = $bs->popUint32_t(); // 反序列化Paipai红包使用金额 类型为uint32_t
			$this->dwPayScore = $bs->popUint32_t(); // 反序列化积分支付值 类型为uint32_t
			$this->dwTradeGenTime = $bs->popUint32_t(); // 反序列化商品单生成时间 类型为uint32_t
			$this->wTradeOpSerialNo = $bs->popUint16_t(); // 反序列化商品单库存操作序列号 类型为uint16_t
			$this->dwObtainScore = $bs->popUint32_t(); // 反序列化获得积分值 类型为uint32_t
			$this->dwTradeState = $bs->popUint32_t(); // 反序列化商品单状态 类型为uint32_t
			$this->dwTradeProperty = $bs->popUint32_t(); // 反序列化商品单属性值 类型为uint32_t
			$this->dwTradeProperty1 = $bs->popUint32_t(); // 反序列化商品单属性值1 类型为uint32_t
			$this->dwTradeProperty2 = $bs->popUint32_t(); // 反序列化商品单属性值2 类型为uint32_t
			$this->dwTradeProperty3 = $bs->popUint32_t(); // 反序列化商品单属性值3 类型为uint32_t
			$this->dwTradeProperty4 = $bs->popUint32_t(); // 反序列化商品单属性值4 类型为uint32_t
			$this->dwItemTimeoutFlag = $bs->popUint32_t(); // 反序列化商品超时标识 类型为uint32_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // 反序列化最后更新时间 类型为uint32_t
			$this->oActiveInfoList = $bs->popObject('TradeActivePoList'); // 反序列化商品活动列表 类型为ecc::deal::po::CTradeActivePoList
			$this->mmapDealExtInfoMap = $bs->popObject('stl_multimap<uint32_t,stl_string>'); // 反序列化订单扩展信息  类型为std::multimap<uint32_t,std::string> 
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId64_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBdealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerNickName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerTitle_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBusinessId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeSource_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradePayType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cShippingfeeTemplateId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cShippingfeeDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemShippingfee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemClassId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemTitle_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemAttrCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemAttr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemLocalCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemLocalStockCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemBarCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemSpuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemStockId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemStoreHouseId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemPhyisicalStorage_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemLogo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemSnapVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemResetTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemWeight_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemVolume_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cMainItemId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemAccessoryDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemCostPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemOriginPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemSoldPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemB2CMarket_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemB2CPM_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemUseVirtualStock_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeTotalFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeAdjustFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradePayment_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeDiscountTotal_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradePaipaiHongbaoUsed_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayScore_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeGenTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeOpSerialNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cObtainScore_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeProperty1_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeProperty2_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeProperty3_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeProperty4_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemTimeoutFlag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cActiveInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealExtInfoMap_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$this->strWarranty = $bs->popString(); // 反序列化保修条款 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->ddwProductId = $bs->popUint64_t(); // 反序列化产品id 类型为uint64_t
			}
			if(  $this->wVersion >= 1 ){
				$this->strProductCode = $bs->popString(); // 反序列化产品id编码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonEdmCode = $bs->popString(); // 反序列化易迅edm编码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonOTag = $bs->popString(); // 反序列化易迅OTag 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonTradeShopGuideCost = $bs->popString(); // 反序列化易迅店铺导购费用 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneType = $bs->popString(); // 反序列化易迅定制机类型 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneOperator = $bs->popString(); // 反序列化易迅定制机运营商 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneNumber = $bs->popString(); // 反序列化易迅定制机号码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneArea = $bs->popString(); // 反序列化易迅定制机归属地 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhonePackageId = $bs->popString(); // 反序列化易迅定制机套餐id 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneUserName = $bs->popString(); // 反序列化易迅定制机用户姓名 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneUserAddr = $bs->popString(); // 反序列化易迅定制机用户地址 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneUserMobile = $bs->popString(); // 反序列化易迅定制机用户联系手机 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneUserTel = $bs->popString(); // 反序列化易迅定制机用户联系电话 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneIdCardNo = $bs->popString(); // 反序列化易迅定制机身份证号码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneIdCardAddr = $bs->popString(); // 反序列化易迅定制机身份证地址 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneIdCardDate = $bs->popString(); // 反序列化易迅定制机身份证有效期 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneZipCode = $bs->popString(); // 反序列化易迅定制机邮政编码 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneCardPrice = $bs->popString(); // 反序列化易迅定制机卡价格 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhonePackagePrice = $bs->popString(); // 反序列化易迅定制机套餐价格 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonTradeFlag = $bs->popString(); // 反序列化易迅商品子单flag 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonPointType = $bs->popString(); // 反序列化易迅积分兑换类型 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonPackageIds = $bs->popString(); // 反序列化易迅商品子单套餐id 类型为std::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cWarranty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cProductId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cProductCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonEdmCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonOTag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonTradeShopGuideCost_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneOperator_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneNumber_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneArea_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhonePackageId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneUserName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneUserAddr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneUserMobile_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneUserTel_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneIdCardNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneIdCardAddr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneIdCardDate_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneZipCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneCardPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhonePackagePrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonTradeFlag_u = $bs->popUint8_t(); // 反序列化易迅商品子单flag 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonPointType_u = $bs->popUint8_t(); // 反序列化易迅积分兑换类型 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonPackageIds_u = $bs->popUint8_t(); // 反序列化易迅商品子单套餐id 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwIcsonTradeCashBack = $bs->popUint32_t(); // 反序列化子单返现金额 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cIcsonTradeCashBack_u = $bs->popUint8_t(); // 反序列化子单返现金额UFlag 类型为uint8_t
			}
			if(  $this->wVersion >= 3 ){
				$this->strIcsonUnitCostInvoice = $bs->popString(); // 反序列化去税后成本 类型为std::string
			}
			if(  $this->wVersion >= 3 ){
				$this->cIcsonUnitCostInvoice_u = $bs->popUint8_t(); // 反序列化去税后成本UFlag 类型为uint8_t
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


//source idl: com.ecc.deal.idl.OrderPo.java

if (!class_exists('OrderPayInfoPoList')) {
class OrderPayInfoPoList
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 支付单列表
		 *
		 * 版本 >= 0
		 */
		var $vecPayInfoList; //std::vector<ecc::deal::po::COrderPayInfoPo> 

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayInfoList_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->vecPayInfoList = new stl_vector('OrderPayInfoPo'); // std::vector<ecc::deal::po::COrderPayInfoPo> 
			 $this->cVersion_u = 0; // uint8_t
			 $this->cPayInfoList_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化版本号 类型为uint16_t
			$bs->pushObject($this->vecPayInfoList,'stl_vector'); // 序列化支付单列表 类型为std::vector<ecc::deal::po::COrderPayInfoPo> 
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayInfoList_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化版本号 类型为uint16_t
			$this->vecPayInfoList = $bs->popObject('stl_vector<OrderPayInfoPo>'); // 反序列化支付单列表 类型为std::vector<ecc::deal::po::COrderPayInfoPo> 
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.ecc.deal.idl.OrderPayInfoPoList.java

if (!class_exists('OrderPayInfoPo')) {
class OrderPayInfoPo
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 支付单ID，拍拍订单同步可使用，可为空
		 *
		 * 版本 >= 0
		 */
		var $ddwPayId; //uint64_t

		/**
		 * 订单编号，可为空
		 *
		 * 版本 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * 订单单号，拍拍订单同步可使用，可为空
		 *
		 * 版本 >= 0
		 */
		var $ddwDealId64; //uint64_t

		/**
		 * 交易单号，可为空
		 *
		 * 版本 >= 0
		 */
		var $ddwBdealId; //uint64_t

		/**
		 * 买家ID
		 *
		 * 版本 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * 买家昵称
		 *
		 * 版本 >= 0
		 */
		var $strBuyerNickName; //std::string

		/**
		 * 商家ID
		 *
		 * 版本 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * 商家名称
		 *
		 * 版本 >= 0
		 */
		var $strSellerTitle; //std::string

		/**
		 * 商品标题列表
		 *
		 * 版本 >= 0
		 */
		var $strItemTitleList; //std::string

		/**
		 * 支付总金额
		 *
		 * 版本 >= 0
		 */
		var $dwPayTotalFee; //uint32_t

		/**
		 * 订单待付金额，等于商品实付金额+退运险
		 *
		 * 版本 >= 0
		 */
		var $dwPayDealTotalFee; //uint32_t

		/**
		 * 邮费金额
		 *
		 * 版本 >= 0
		 */
		var $dwPayShippingFee; //uint32_t

		/**
		 * 支付帐号
		 *
		 * 版本 >= 0
		 */
		var $strPayAccount; //std::string

		/**
		 * 支付单状态，1，未支付；2，支付完成
		 *
		 * 版本 >= 0
		 */
		var $dwPayState; //uint32_t

		/**
		 * 支付单标记
		 *
		 * 版本 >= 0
		 */
		var $dwPayProperty; //uint32_t

		/**
		 * 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款
		 *
		 * 版本 >= 0
		 */
		var $cPayType; //uint8_t

		/**
		 * 支付渠道
		 *
		 * 版本 >= 0
		 */
		var $cPayChannel; //uint8_t

		/**
		 * 支付银行ID
		 *
		 * 版本 >= 0
		 */
		var $strPayBank; //std::string

		/**
		 * 支付订单编号
		 *
		 * 版本 >= 0
		 */
		var $strPayDealId; //std::string

		/**
		 * 支付单生成时间
		 *
		 * 版本 >= 0
		 */
		var $dwPayGenTime; //uint32_t

		/**
		 * 支付单有效起始时间
		 *
		 * 版本 >= 0
		 */
		var $dwPayEnableBeginTime; //uint32_t

		/**
		 * 支付单有效结束时间
		 *
		 * 版本 >= 0
		 */
		var $dwPayEnableEndTime; //uint32_t

		/**
		 * 支付手续费
		 *
		 * 版本 >= 0
		 */
		var $dwPayServiceFee; //uint32_t

		/**
		 * 谁承担COD手续费，1：卖家承担；2：买家；3：平台承担
		 *
		 * 版本 >= 0
		 */
		var $dwWhoPayCodFee; //uint32_t

		/**
		 * COD财付通支付手续费
		 *
		 * 版本 >= 0
		 */
		var $dwPayCodCftServiceFee; //uint32_t

		/**
		 * CODPaipai支付手续费
		 *
		 * 版本 >= 0
		 */
		var $dwPayCodPaipaiServiceFee; //uint32_t

		/**
		 * COD手续费调价金额
		 *
		 * 版本 >= 0
		 */
		var $nPayCodServiceAdjustFee; //int

		/**
		 * COD物流支付手续费
		 *
		 * 版本 >= 0
		 */
		var $dwPayCodWuliuServiceFee; //uint32_t

		/**
		 * 分期付款银行
		 *
		 * 版本 >= 0
		 */
		var $strPayInstallmentBank; //std::string

		/**
		 * 分期付款期数
		 *
		 * 版本 >= 0
		 */
		var $wPayInstallmentNum; //uint16_t

		/**
		 * 分期付款每期金额
		 *
		 * 版本 >= 0
		 */
		var $dwPayInstallmentPayment; //uint32_t

		/**
		 * 最后更新时间
		 *
		 * 版本 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cDealId64_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBdealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBuyerNickName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSellerTitle_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cItemTitleList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayTotalFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayDealTotalFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayShippingFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayAccount_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayState_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayProperty_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayChannel_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayBank_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayDealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayGenTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayEnableBeginTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayEnableEndTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayServiceFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cWhoPayCodFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayCodCftServiceFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayCodPaipaiServiceFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayCodServiceAdjustFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayCodWuliuServiceFee_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayInstallmentBank_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayInstallmentNum_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPayInstallmentPayment_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->ddwPayId = 0; // uint64_t
			 $this->strDealId = ""; // std::string
			 $this->ddwDealId64 = 0; // uint64_t
			 $this->ddwBdealId = 0; // uint64_t
			 $this->ddwBuyerId = 0; // uint64_t
			 $this->strBuyerNickName = ""; // std::string
			 $this->ddwSellerId = 0; // uint64_t
			 $this->strSellerTitle = ""; // std::string
			 $this->strItemTitleList = ""; // std::string
			 $this->dwPayTotalFee = 0; // uint32_t
			 $this->dwPayDealTotalFee = 0; // uint32_t
			 $this->dwPayShippingFee = 0; // uint32_t
			 $this->strPayAccount = ""; // std::string
			 $this->dwPayState = 0; // uint32_t
			 $this->dwPayProperty = 0; // uint32_t
			 $this->cPayType = 0; // uint8_t
			 $this->cPayChannel = 0; // uint8_t
			 $this->strPayBank = ""; // std::string
			 $this->strPayDealId = ""; // std::string
			 $this->dwPayGenTime = 0; // uint32_t
			 $this->dwPayEnableBeginTime = 0; // uint32_t
			 $this->dwPayEnableEndTime = 0; // uint32_t
			 $this->dwPayServiceFee = 0; // uint32_t
			 $this->dwWhoPayCodFee = 0; // uint32_t
			 $this->dwPayCodCftServiceFee = 0; // uint32_t
			 $this->dwPayCodPaipaiServiceFee = 0; // uint32_t
			 $this->nPayCodServiceAdjustFee = 0; // int
			 $this->dwPayCodWuliuServiceFee = 0; // uint32_t
			 $this->strPayInstallmentBank = ""; // std::string
			 $this->wPayInstallmentNum = 0; // uint16_t
			 $this->dwPayInstallmentPayment = 0; // uint32_t
			 $this->dwLastUpdateTime = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->cPayId_u = 0; // uint8_t
			 $this->cDealId_u = 0; // uint8_t
			 $this->cDealId64_u = 0; // uint8_t
			 $this->cBdealId_u = 0; // uint8_t
			 $this->cBuyerId_u = 0; // uint8_t
			 $this->cBuyerNickName_u = 0; // uint8_t
			 $this->cSellerId_u = 0; // uint8_t
			 $this->cSellerTitle_u = 0; // uint8_t
			 $this->cItemTitleList_u = 0; // uint8_t
			 $this->cPayTotalFee_u = 0; // uint8_t
			 $this->cPayDealTotalFee_u = 0; // uint8_t
			 $this->cPayShippingFee_u = 0; // uint8_t
			 $this->cPayAccount_u = 0; // uint8_t
			 $this->cPayState_u = 0; // uint8_t
			 $this->cPayProperty_u = 0; // uint8_t
			 $this->cPayType_u = 0; // uint8_t
			 $this->cPayChannel_u = 0; // uint8_t
			 $this->cPayBank_u = 0; // uint8_t
			 $this->cPayDealId_u = 0; // uint8_t
			 $this->cPayGenTime_u = 0; // uint8_t
			 $this->cPayEnableBeginTime_u = 0; // uint8_t
			 $this->cPayEnableEndTime_u = 0; // uint8_t
			 $this->cPayServiceFee_u = 0; // uint8_t
			 $this->cWhoPayCodFee_u = 0; // uint8_t
			 $this->cPayCodCftServiceFee_u = 0; // uint8_t
			 $this->cPayCodPaipaiServiceFee_u = 0; // uint8_t
			 $this->cPayCodServiceAdjustFee_u = 0; // uint8_t
			 $this->cPayCodWuliuServiceFee_u = 0; // uint8_t
			 $this->cPayInstallmentBank_u = 0; // uint8_t
			 $this->cPayInstallmentNum_u = 0; // uint8_t
			 $this->cPayInstallmentPayment_u = 0; // uint8_t
			 $this->cLastUpdateTime_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化版本号 类型为uint16_t
			$bs->pushUint64_t($this->ddwPayId); // 序列化支付单ID，拍拍订单同步可使用，可为空 类型为uint64_t
			$bs->pushString($this->strDealId); // 序列化订单编号，可为空 类型为std::string
			$bs->pushUint64_t($this->ddwDealId64); // 序列化订单单号，拍拍订单同步可使用，可为空 类型为uint64_t
			$bs->pushUint64_t($this->ddwBdealId); // 序列化交易单号，可为空 类型为uint64_t
			$bs->pushUint64_t($this->ddwBuyerId); // 序列化买家ID 类型为uint64_t
			$bs->pushString($this->strBuyerNickName); // 序列化买家昵称 类型为std::string
			$bs->pushUint64_t($this->ddwSellerId); // 序列化商家ID 类型为uint64_t
			$bs->pushString($this->strSellerTitle); // 序列化商家名称 类型为std::string
			$bs->pushString($this->strItemTitleList); // 序列化商品标题列表 类型为std::string
			$bs->pushUint32_t($this->dwPayTotalFee); // 序列化支付总金额 类型为uint32_t
			$bs->pushUint32_t($this->dwPayDealTotalFee); // 序列化订单待付金额，等于商品实付金额+退运险 类型为uint32_t
			$bs->pushUint32_t($this->dwPayShippingFee); // 序列化邮费金额 类型为uint32_t
			$bs->pushString($this->strPayAccount); // 序列化支付帐号 类型为std::string
			$bs->pushUint32_t($this->dwPayState); // 序列化支付单状态，1，未支付；2，支付完成 类型为uint32_t
			$bs->pushUint32_t($this->dwPayProperty); // 序列化支付单标记 类型为uint32_t
			$bs->pushUint8_t($this->cPayType); // 序列化支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款 类型为uint8_t
			$bs->pushUint8_t($this->cPayChannel); // 序列化支付渠道 类型为uint8_t
			$bs->pushString($this->strPayBank); // 序列化支付银行ID 类型为std::string
			$bs->pushString($this->strPayDealId); // 序列化支付订单编号 类型为std::string
			$bs->pushUint32_t($this->dwPayGenTime); // 序列化支付单生成时间 类型为uint32_t
			$bs->pushUint32_t($this->dwPayEnableBeginTime); // 序列化支付单有效起始时间 类型为uint32_t
			$bs->pushUint32_t($this->dwPayEnableEndTime); // 序列化支付单有效结束时间 类型为uint32_t
			$bs->pushUint32_t($this->dwPayServiceFee); // 序列化支付手续费 类型为uint32_t
			$bs->pushUint32_t($this->dwWhoPayCodFee); // 序列化谁承担COD手续费，1：卖家承担；2：买家；3：平台承担 类型为uint32_t
			$bs->pushUint32_t($this->dwPayCodCftServiceFee); // 序列化COD财付通支付手续费 类型为uint32_t
			$bs->pushUint32_t($this->dwPayCodPaipaiServiceFee); // 序列化CODPaipai支付手续费 类型为uint32_t
			$bs->pushInt32_t($this->nPayCodServiceAdjustFee); // 序列化COD手续费调价金额 类型为int
			$bs->pushUint32_t($this->dwPayCodWuliuServiceFee); // 序列化COD物流支付手续费 类型为uint32_t
			$bs->pushString($this->strPayInstallmentBank); // 序列化分期付款银行 类型为std::string
			$bs->pushUint16_t($this->wPayInstallmentNum); // 序列化分期付款期数 类型为uint16_t
			$bs->pushUint32_t($this->dwPayInstallmentPayment); // 序列化分期付款每期金额 类型为uint32_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // 序列化最后更新时间 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cDealId64_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBdealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBuyerNickName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSellerTitle_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cItemTitleList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayTotalFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayDealTotalFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayShippingFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayAccount_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayState_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayProperty_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayChannel_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayBank_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayDealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayGenTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayEnableBeginTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayEnableEndTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayServiceFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cWhoPayCodFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayCodCftServiceFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayCodPaipaiServiceFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayCodServiceAdjustFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayCodWuliuServiceFee_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayInstallmentBank_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayInstallmentNum_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPayInstallmentPayment_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化版本号 类型为uint16_t
			$this->ddwPayId = $bs->popUint64_t(); // 反序列化支付单ID，拍拍订单同步可使用，可为空 类型为uint64_t
			$this->strDealId = $bs->popString(); // 反序列化订单编号，可为空 类型为std::string
			$this->ddwDealId64 = $bs->popUint64_t(); // 反序列化订单单号，拍拍订单同步可使用，可为空 类型为uint64_t
			$this->ddwBdealId = $bs->popUint64_t(); // 反序列化交易单号，可为空 类型为uint64_t
			$this->ddwBuyerId = $bs->popUint64_t(); // 反序列化买家ID 类型为uint64_t
			$this->strBuyerNickName = $bs->popString(); // 反序列化买家昵称 类型为std::string
			$this->ddwSellerId = $bs->popUint64_t(); // 反序列化商家ID 类型为uint64_t
			$this->strSellerTitle = $bs->popString(); // 反序列化商家名称 类型为std::string
			$this->strItemTitleList = $bs->popString(); // 反序列化商品标题列表 类型为std::string
			$this->dwPayTotalFee = $bs->popUint32_t(); // 反序列化支付总金额 类型为uint32_t
			$this->dwPayDealTotalFee = $bs->popUint32_t(); // 反序列化订单待付金额，等于商品实付金额+退运险 类型为uint32_t
			$this->dwPayShippingFee = $bs->popUint32_t(); // 反序列化邮费金额 类型为uint32_t
			$this->strPayAccount = $bs->popString(); // 反序列化支付帐号 类型为std::string
			$this->dwPayState = $bs->popUint32_t(); // 反序列化支付单状态，1，未支付；2，支付完成 类型为uint32_t
			$this->dwPayProperty = $bs->popUint32_t(); // 反序列化支付单标记 类型为uint32_t
			$this->cPayType = $bs->popUint8_t(); // 反序列化支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款 类型为uint8_t
			$this->cPayChannel = $bs->popUint8_t(); // 反序列化支付渠道 类型为uint8_t
			$this->strPayBank = $bs->popString(); // 反序列化支付银行ID 类型为std::string
			$this->strPayDealId = $bs->popString(); // 反序列化支付订单编号 类型为std::string
			$this->dwPayGenTime = $bs->popUint32_t(); // 反序列化支付单生成时间 类型为uint32_t
			$this->dwPayEnableBeginTime = $bs->popUint32_t(); // 反序列化支付单有效起始时间 类型为uint32_t
			$this->dwPayEnableEndTime = $bs->popUint32_t(); // 反序列化支付单有效结束时间 类型为uint32_t
			$this->dwPayServiceFee = $bs->popUint32_t(); // 反序列化支付手续费 类型为uint32_t
			$this->dwWhoPayCodFee = $bs->popUint32_t(); // 反序列化谁承担COD手续费，1：卖家承担；2：买家；3：平台承担 类型为uint32_t
			$this->dwPayCodCftServiceFee = $bs->popUint32_t(); // 反序列化COD财付通支付手续费 类型为uint32_t
			$this->dwPayCodPaipaiServiceFee = $bs->popUint32_t(); // 反序列化CODPaipai支付手续费 类型为uint32_t
			$this->nPayCodServiceAdjustFee = $bs->popInt32_t(); // 反序列化COD手续费调价金额 类型为int
			$this->dwPayCodWuliuServiceFee = $bs->popUint32_t(); // 反序列化COD物流支付手续费 类型为uint32_t
			$this->strPayInstallmentBank = $bs->popString(); // 反序列化分期付款银行 类型为std::string
			$this->wPayInstallmentNum = $bs->popUint16_t(); // 反序列化分期付款期数 类型为uint16_t
			$this->dwPayInstallmentPayment = $bs->popUint32_t(); // 反序列化分期付款每期金额 类型为uint32_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // 反序列化最后更新时间 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cDealId64_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBdealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBuyerNickName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSellerTitle_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cItemTitleList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayTotalFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayDealTotalFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayShippingFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayAccount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayChannel_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayBank_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayDealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayGenTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayEnableBeginTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayEnableEndTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayServiceFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cWhoPayCodFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayCodCftServiceFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayCodPaipaiServiceFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayCodServiceAdjustFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayCodWuliuServiceFee_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayInstallmentBank_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayInstallmentNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPayInstallmentPayment_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.ecc.deal.idl.CreateBuyDealReq.java

if (!class_exists('OrderPoList')) {
class OrderPoList
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 订单列表
		 *
		 * 版本 >= 0
		 */
		var $vecOrderInfoList; //std::vector<ecc::deal::po::COrderPo> 

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cOrderInfoList_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->vecOrderInfoList = new stl_vector('OrderPo'); // std::vector<ecc::deal::po::COrderPo> 
			 $this->cVersion_u = 0; // uint8_t
			 $this->cOrderInfoList_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushObject($this->vecOrderInfoList,'stl_vector'); // 序列化订单列表 类型为std::vector<ecc::deal::po::COrderPo> 
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOrderInfoList_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->vecOrderInfoList = $bs->popObject('stl_vector<OrderPo>'); // 反序列化订单列表 类型为std::vector<ecc::deal::po::COrderPo> 
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOrderInfoList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.ecc.deal.idl.CloseDealReq.java

if (!class_exists('EventParamsCloseDealBo')) {
class EventParamsCloseDealBo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 关闭订单场景: 1-客服关闭;2-系统关闭;3-客服代用户关闭;4-经理(主管)关闭
		 *
		 * 版本 >= 0
		 */
		var $dwOperateScene; //uint32_t

		/**
		 * 关闭时间
		 *
		 * 版本 >= 0
		 */
		var $dwCloseTime; //uint32_t

		/**
		 * 关闭原因
		 *
		 * 版本 >= 0
		 */
		var $dwCloseReasonType; //uint32_t

		/**
		 * 描述信息
		 *
		 * 版本 >= 0
		 */
		var $strCloseReasonDesc; //std::string

		/**
		 * 子单列表，个别子单关闭时填写，不填则整单关闭
		 *
		 * 版本 >= 0
		 */
		var $vecTradeList; //std::vector<uint64_t> 

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
		var $cOperateScene_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCloseTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCloseReasonType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCloseReasonDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTradeList_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->dwOperateScene = 0; // uint32_t
			 $this->dwCloseTime = 0; // uint32_t
			 $this->dwCloseReasonType = 0; // uint32_t
			 $this->strCloseReasonDesc = ""; // std::string
			 $this->vecTradeList = new stl_vector('uint64_t'); // std::vector<uint64_t> 
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cOperateScene_u = 0; // uint8_t
			 $this->cCloseTime_u = 0; // uint8_t
			 $this->cCloseReasonType_u = 0; // uint8_t
			 $this->cCloseReasonDesc_u = 0; // uint8_t
			 $this->cTradeList_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushUint32_t($this->dwOperateScene); // 序列化关闭订单场景: 1-客服关闭;2-系统关闭;3-客服代用户关闭;4-经理(主管)关闭 类型为uint32_t
			$bs->pushUint32_t($this->dwCloseTime); // 序列化关闭时间 类型为uint32_t
			$bs->pushUint32_t($this->dwCloseReasonType); // 序列化关闭原因 类型为uint32_t
			$bs->pushString($this->strCloseReasonDesc); // 序列化描述信息 类型为std::string
			$bs->pushObject($this->vecTradeList,'stl_vector'); // 序列化子单列表，个别子单关闭时填写，不填则整单关闭 类型为std::vector<uint64_t> 
			$bs->pushString($this->strReserve); // 序列化保留字段 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cOperateScene_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCloseTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCloseReasonType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCloseReasonDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTradeList_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->dwOperateScene = $bs->popUint32_t(); // 反序列化关闭订单场景: 1-客服关闭;2-系统关闭;3-客服代用户关闭;4-经理(主管)关闭 类型为uint32_t
			$this->dwCloseTime = $bs->popUint32_t(); // 反序列化关闭时间 类型为uint32_t
			$this->dwCloseReasonType = $bs->popUint32_t(); // 反序列化关闭原因 类型为uint32_t
			$this->strCloseReasonDesc = $bs->popString(); // 反序列化描述信息 类型为std::string
			$this->vecTradeList = $bs->popObject('stl_vector<uint64_t>'); // 反序列化子单列表，个别子单关闭时填写，不填则整单关闭 类型为std::vector<uint64_t> 
			$this->strReserve = $bs->popString(); // 反序列化保留字段 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cOperateScene_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCloseTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCloseReasonType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCloseReasonDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTradeList_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.ecc.deal.idl.AuditDealReq.java

if (!class_exists('EventParamsAuditDealBo')) {
class EventParamsAuditDealBo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 审核时间
		 *
		 * 版本 >= 0
		 */
		var $dwAuditTime; //uint32_t

		/**
		 * 审核描述,不超过128个字
		 *
		 * 版本 >= 0
		 */
		var $strAuditDesc; //std::string

		/**
		 * 审核结果: 1-审核通过;2-取消审核;
		 *
		 * 版本 >= 0
		 */
		var $dwAuditResult; //uint32_t

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
		var $cAuditTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cAuditDesc_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cAuditResult_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->dwAuditTime = 0; // uint32_t
			 $this->strAuditDesc = ""; // std::string
			 $this->dwAuditResult = 0; // uint32_t
			 $this->strReserve = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cAuditTime_u = 0; // uint8_t
			 $this->cAuditDesc_u = 0; // uint8_t
			 $this->cAuditResult_u = 0; // uint8_t
			 $this->cReserve_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushUint32_t($this->dwAuditTime); // 序列化审核时间 类型为uint32_t
			$bs->pushString($this->strAuditDesc); // 序列化审核描述,不超过128个字 类型为std::string
			$bs->pushUint32_t($this->dwAuditResult); // 序列化审核结果: 1-审核通过;2-取消审核; 类型为uint32_t
			$bs->pushString($this->strReserve); // 序列化保留字段 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cAuditTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cAuditDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cAuditResult_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->dwAuditTime = $bs->popUint32_t(); // 反序列化审核时间 类型为uint32_t
			$this->strAuditDesc = $bs->popString(); // 反序列化审核描述,不超过128个字 类型为std::string
			$this->dwAuditResult = $bs->popUint32_t(); // 反序列化审核结果: 1-审核通过;2-取消审核; 类型为uint32_t
			$this->strReserve = $bs->popString(); // 反序列化保留字段 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cAuditTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cAuditDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cAuditResult_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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