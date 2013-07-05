<?php

//source idl: com.ecc.deal.idl.UserQueryDealResp.java

if (!class_exists('DealPo')) {
class DealPo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ������ţ���ʽ:�������XXXXYYYY����:101041051509351702
		 *
		 * �汾 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * �������ţ�ͳһƽ̨�ڲ�����
		 *
		 * �汾 >= 0
		 */
		var $ddwDealId64; //uint64_t

		/**
		 * ���׵��ţ�������һ�ν�����Ϊ����
		 *
		 * �汾 >= 0
		 */
		var $ddwBdealId; //uint64_t

		/**
		 * ҵ�񶩵���ţ��������йܶ���
		 *
		 * �汾 >= 0
		 */
		var $strBusinessDealId; //std::string

		/**
		 * ���ID
		 *
		 * �汾 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * ����ʺ�
		 *
		 * �汾 >= 0
		 */
		var $strBuyerAccount; //std::string

		/**
		 * �������
		 *
		 * �汾 >= 0
		 */
		var $strBuyerNickName; //std::string

		/**
		 * ����ǳ�
		 *
		 * �汾 >= 0
		 */
		var $strBuyerNick; //std::string

		/**
		 * �̼�ID
		 *
		 * �汾 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * �̼���ʵ����
		 *
		 * �汾 >= 0
		 */
		var $strSellerTitle; //std::string

		/**
		 * �����ǳ�
		 *
		 * �汾 >= 0
		 */
		var $strSellerNick; //std::string

		/**
		 * ҵ��ID
		 *
		 * �汾 >= 0
		 */
		var $dwBusinessId; //uint32_t

		/**
		 * ��������
		 *
		 * �汾 >= 0
		 */
		var $cDealType; //uint8_t

		/**
		 * �µ�������1��ҵ����վ��2���ƶ�app��3���ƶ�wap
		 *
		 * �汾 >= 0
		 */
		var $dwDealSource; //uint32_t

		/**
		 * ֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6���������
		 *
		 * �汾 >= 0
		 */
		var $cDealPayType; //uint8_t

		/**
		 * ����״̬
		 *
		 * �汾 >= 0
		 */
		var $dwDealState; //uint32_t

		/**
		 * ����ǰһ��״̬
		 *
		 * �汾 >= 0
		 */
		var $dwPreDealState; //uint32_t

		/**
		 * ��������ֵ��ͨ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealProperty; //uint32_t

		/**
		 * ��������ֵ��ҵ��1��չ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealProperty1; //uint32_t

		/**
		 * ��������ֵ��ҵ��2��չ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealProperty2; //uint32_t

		/**
		 * ��������ֵ��ҵ��3��չ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealProperty3; //uint32_t

		/**
		 * ��������ֵ��ҵ��4��չ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealProperty4; //uint32_t

		/**
		 * �˿�״̬, ���ӵ��˿�״̬�Ļ���, 0:���˿�,1:�˿���,2:�˿����
		 *
		 * �汾 >= 0
		 */
		var $dwRefundState; //uint32_t

		/**
		 * ��������״̬
		 *
		 * �汾 >= 0
		 */
		var $dwEvalState; //uint32_t

		/**
		 * ��ƷskuID�б�
		 *
		 * �汾 >= 0
		 */
		var $strItemSkuidList; //std::string

		/**
		 * ��Ʒ�����б�
		 *
		 * �汾 >= 0
		 */
		var $strItemTitleList; //std::string

		/**
		 * �����ܽ��,�µ����
		 *
		 * �汾 >= 0
		 */
		var $dwDealTotalFee; //uint32_t

		/**
		 * ���۽��
		 *
		 * �汾 >= 0
		 */
		var $nDealAdjustFee; //int

		/**
		 * ʵ���ܽ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealPayment; //uint32_t

		/**
		 * C2BԤ�۶�����
		 *
		 * �汾 >= 0
		 */
		var $dwDealDownPayment; //uint32_t

		/**
		 * �Ż��ܽ��
		 *
		 * �汾 >= 0
		 */
		var $nDealDiscountTotal; //int

		/**
		 * ��Ʒ�ܽ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealItemTotalFee; //uint32_t

		/**
		 * ˭֧���ʷѣ�1�����ң�2�����
		 *
		 * �汾 >= 0
		 */
		var $dwDealWhoPayShippingFee; //uint32_t

		/**
		 * �ʷѽ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealShippingFee; //uint32_t

		/**
		 * ˭�е�COD�����ѣ�1�����ҳе���2����ң�3��ƽ̨�е�
		 *
		 * �汾 >= 0
		 */
		var $dwDealWhoPayCodFee; //uint32_t

		/**
		 * COD������
		 *
		 * �汾 >= 0
		 */
		var $dwDealCodFee; //uint32_t

		/**
		 * ˭֧�����շѣ�1���������ͣ�2����ң�3��ƽ̨�е�
		 *
		 * �汾 >= 0
		 */
		var $dwDealWhoPayInsuranceFee; //uint32_t

		/**
		 * �˷ѱ��շ�
		 *
		 * �汾 >= 0
		 */
		var $dwDealInsuranceFee; //uint32_t

		/**
		 * ϵͳ���۽���������COD���ҵ��۽������ڴ�����COD�Żݽ��
		 *
		 * �汾 >= 0
		 */
		var $nDealSysAdjustFee; //int

		/**
		 * �˿��ܽ���
		 *
		 * �汾 >= 0
		 */
		var $dwDealRefundTotalFee; //uint32_t

		/**
		 * ����֧��ֵ
		 *
		 * �汾 >= 0
		 */
		var $dwPayScore; //uint32_t

		/**
		 * ��û���ֵ
		 *
		 * �汾 >= 0
		 */
		var $dwObtainScore; //uint32_t

		/**
		 * ��Ʒ������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealGenTime; //uint32_t

		/**
		 * ��������������
		 *
		 * �汾 >= 0
		 */
		var $strSendFromDesc; //std::string

		/**
		 * �µ�ʱ���
		 *
		 * �汾 >= 0
		 */
		var $ddwDealSeq; //uint64_t

		/**
		 * �µ�md5
		 *
		 * �汾 >= 0
		 */
		var $ddwDealMd5; //uint64_t

		/**
		 * �µ�IP
		 *
		 * �汾 >= 0
		 */
		var $strDealIp; //std::string

		/**
		 * refer
		 *
		 * �汾 >= 0
		 */
		var $strDealRefer; //std::string

		/**
		 * visitkey
		 *
		 * �汾 >= 0
		 */
		var $strDealVisitKey; //std::string

		/**
		 * ����������Ϣ����
		 *
		 * �汾 >= 0
		 */
		var $strPromotionDesc; //std::string

		/**
		 * �ջ���
		 *
		 * �汾 >= 0
		 */
		var $strRecvName; //std::string

		/**
		 * ��������
		 *
		 * �汾 >= 0
		 */
		var $dwRecvRegionCode; //uint32_t

		/**
		 * ��ַ
		 *
		 * �汾 >= 0
		 */
		var $strRecvAddress; //std::string

		/**
		 * �ʱ�
		 *
		 * �汾 >= 0
		 */
		var $strRecvPostCode; //std::string

		/**
		 * �绰
		 *
		 * �汾 >= 0
		 */
		var $strRecvPhone; //std::string

		/**
		 * �ֻ�
		 *
		 * �汾 >= 0
		 */
		var $ddwRecvMobile; //uint64_t

		/**
		 * �����ջ�ʱ��,��
		 *
		 * �汾 >= 0
		 */
		var $dwExpectRecvTime; //uint32_t

		/**
		 * �����ջ�ʱ��
		 *
		 * �汾 >= 0
		 */
		var $strExpectRecvTimeSpan; //std::string

		/**
		 * �ջ�����
		 *
		 * �汾 >= 0
		 */
		var $strRecvRemark; //std::string

		/**
		 * �ջ�����ֵ
		 *
		 * �汾 >= 0
		 */
		var $dwRecvMask; //uint32_t

		/**
		 * ���ͷ�ʽ��1��ƽ�ʣ�2����ݣ�3��EMS��4��B2C�Խ�������5���û����͵�����
		 *
		 * �汾 >= 0
		 */
		var $cExpressType; //uint8_t

		/**
		 * ������˾ID
		 *
		 * �汾 >= 0
		 */
		var $strExpressCompanyID; //std::string

		/**
		 * ������˾����
		 *
		 * �汾 >= 0
		 */
		var $strExpressCompanyName; //std::string

		/**
		 * ������˾������
		 *
		 * �汾 >= 0
		 */
		var $strExpressDealID; //std::string

		/**
		 * Ԥ�Ƶ�������
		 *
		 * �汾 >= 0
		 */
		var $wExpectArriveDays; //uint16_t

		/**
		 * ���������ţ�����ϵͳ������
		 *
		 * �汾 >= 0
		 */
		var $strWuliuDealId; //std::string

		/**
		 * ��Ʊ����
		 *
		 * �汾 >= 0
		 */
		var $cInvoiceType; //uint8_t

		/**
		 * ��Ʊ̧ͷ
		 *
		 * �汾 >= 0
		 */
		var $strInvoiceHead; //std::string

		/**
		 * ��Ʊ����
		 *
		 * �汾 >= 0
		 */
		var $strInvoiceContent; //std::string

		/**
		 * ֧���ʺ�
		 *
		 * �汾 >= 0
		 */
		var $strPayAccount; //std::string

		/**
		 * Cft֧������
		 *
		 * �汾 >= 0
		 */
		var $strCftDealId; //std::string

		/**
		 * �������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealPayTime; //uint32_t

		/**
		 * �����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealPayReturnTime; //uint32_t

		/**
		 * ���ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealCheckTime; //uint32_t

		/**
		 * ��˰汾��
		 *
		 * �汾 >= 0
		 */
		var $dwDealCheckVersion; //uint32_t

		/**
		 * �������
		 *
		 * �汾 >= 0
		 */
		var $strDealCheckDesc; //std::string

		/**
		 * �̼ҷ���ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealSellerSendTime; //uint32_t

		/**
		 * ��Ƿ���ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealConsignTime; //uint32_t

		/**
		 * ǩ��ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealConfirmRecvTime; //uint32_t

		/**
		 * ����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealEndTime; //uint32_t

		/**
		 * ������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealRecvFeeTime; //uint32_t

		/**
		 * ����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealRecvFeeReturnTime; //uint32_t

		/**
		 * �������ܽ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealBuyerRecvFee; //uint32_t

		/**
		 * ��������ܽ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealSellerRecvFee; //uint32_t

		/**
		 * ֧���ֽ���
		 *
		 * �汾 >= 0
		 */
		var $dwDealPayCash; //uint32_t

		/**
		 * ֧���Ƹ�ȯ���
		 *
		 * �汾 >= 0
		 */
		var $dwDealPayTicket; //uint32_t

		/**
		 * ֧�����ֽ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealPayCredit; //uint32_t

		/**
		 * ����֧�����
		 *
		 * �汾 >= 0
		 */
		var $dwDealPayOther; //uint32_t

		/**
		 * �ӳ�ȷ���ջ�����
		 *
		 * �汾 >= 0
		 */
		var $dwDelayConfirmDays; //uint32_t

		/**
		 * ��ұ��
		 *
		 * �汾 >= 0
		 */
		var $cBuyerTag; //uint8_t

		/**
		 * ��ұ�ע
		 *
		 * �汾 >= 0
		 */
		var $strBuyerNote; //std::string

		/**
		 * ���ұ��
		 *
		 * �汾 >= 0
		 */
		var $cSellerTag; //uint8_t

		/**
		 * ���ұ�ע
		 *
		 * �汾 >= 0
		 */
		var $strSellerNote; //std::string

		/**
		 * ���ݰ汾��
		 *
		 * �汾 >= 0
		 */
		var $dwDataVersion; //uint32_t

		/**
		 * ������Ч���
		 *
		 * �汾 >= 0
		 */
		var $dwDelFlag; //uint32_t

		/**
		 * �ɼ���ʶ
		 *
		 * �汾 >= 0
		 */
		var $dwVisibleState; //uint32_t

		/**
		 * ������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * ��Ʒ�ӵ��б�
		 *
		 * �汾 >= 0
		 */
		var $oTradeInfoList; //ecc::deal::po::CTradePoList

		/**
		 * ֧����Ϣ��
		 *
		 * �汾 >= 0
		 */
		var $oPayInfoList; //ecc::deal::po::CPayInfoPoList

		/**
		 * ������Ϣ��
		 *
		 * �汾 >= 0
		 */
		var $oWuliuInfoList; //ecc::deal::po::CDealWuliuPoList

		/**
		 * �����Ϣ��
		 *
		 * �汾 >= 0
		 */
		var $oRecvFeeInfoList; //ecc::deal::po::CRecvFeePoList

		/**
		 * �˿���Ϣ��
		 *
		 * �汾 >= 0
		 */
		var $oRefundInfoList; //ecc::deal::po::CDealRefundPoList

		/**
		 * ��ˮ��־��
		 *
		 * �汾 >= 0
		 */
		var $oActionLogInfoList; //ecc::deal::po::CDealActionLogPoList

		/**
		 * ������չ��Ϣ 
		 *
		 * �汾 >= 0
		 */
		var $mmapDealExtInfoMap; //std::multimap<uint32_t,std::string> 

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId64_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBdealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBusinessDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerAccount_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerNickName_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerNick_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerTitle_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerNick_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBusinessId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealSource_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealPayType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPreDealState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealProperty_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealProperty1_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealProperty2_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealProperty3_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealProperty4_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cEvalState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemSkuidList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemTitleList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealTotalFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealAdjustFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealPayment_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealDownPayment_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealDiscountTotal_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealItemTotalFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealWhoPayShippingFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealShippingFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealWhoPayCodFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealCodFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealWhoPayInsuranceFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealInsuranceFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealSysAdjustFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealRefundTotalFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayScore_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cObtainScore_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealGenTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSendFromDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealSeq_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealMd5_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealIp_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealRefer_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealVisitKey_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPromotionDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvName_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvRegionCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvAddress_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvPostCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvPhone_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvMobile_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExpectRecvTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExpectRecvTimeSpan_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvRemark_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvMask_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExpressType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExpressCompanyID_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExpressCompanyName_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExpressDealID_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExpectArriveDays_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cWuliuDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cInvoiceType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cInvoiceHead_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cInvoiceContent_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayAccount_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cCftDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealPayTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealPayReturnTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealCheckTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealCheckVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealCheckDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealSellerSendTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealConsignTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealConfirmRecvTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealEndTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealRecvFeeTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealRecvFeeReturnTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealBuyerRecvFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealSellerRecvFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealPayCash_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealPayTicket_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealPayCredit_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealPayOther_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDelayConfirmDays_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerTag_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerNote_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerTag_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerNote_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDataVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDelFlag_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cVisibleState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeInfoList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayInfoList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cWuliuInfoList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvFeeInfoList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundInfoList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cActionLogInfoList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealExtInfoMap_u; //uint8_t

		/**
		 * ���׵���ţ����ַ�����ʽ�Ľ��׵���
		 *
		 * �汾 >= 1
		 */
		var $strBdealCode; //std::string

		/**
		 * ҵ���׵���
		 *
		 * �汾 >= 1
		 */
		var $strBusinessBdealId; //std::string

		/**
		 * ��վID
		 *
		 * �汾 >= 1
		 */
		var $dwSiteId; //uint32_t

		/**
		 * �Ż�ȯ���
		 *
		 * �汾 >= 1
		 */
		var $nDealCouponFee; //int

		/**
		 * �ֽ����֧��ֵ
		 *
		 * �汾 >= 1
		 */
		var $dwCashScore; //uint32_t

		/**
		 * ��������֧��ֵ
		 *
		 * �汾 >= 1
		 */
		var $dwPromotionScore; //uint32_t

		/**
		 * ��չ��������
		 *
		 * �汾 >= 1
		 */
		var $strRecvRegionCodeExt; //std::string

		/**
		 * ����ժҪ
		 *
		 * �汾 >= 1
		 */
		var $strDealDigest; //std::string

		/**
		 * ��Ѹ���ͷ�ʽ
		 *
		 * �汾 >= 1
		 */
		var $strIcsonShippingType; //std::string

		/**
		 * ��Ѹ֧����ʽ
		 *
		 * �汾 >= 1
		 */
		var $strIcsonPayType; //std::string

		/**
		 * ��Ѹ�ڲ��ʺ�ID
		 *
		 * �汾 >= 1
		 */
		var $strIcsonAccount; //std::string

		/**
		 * ��Ѹ������Ϣ
		 *
		 * �汾 >= 1
		 */
		var $strIcsonMasterLs; //std::string

		/**
		 * ��Ѹƽ�����
		 *
		 * �汾 >= 1
		 */
		var $strIcsonRate; //std::string

		/**
		 * ��Ѹ��������
		 *
		 * �汾 >= 1
		 */
		var $strIcsonBankRate; //std::string

		/**
		 * ��Ѹ����id
		 *
		 * �汾 >= 1
		 */
		var $strIcsonShopId; //std::string

		/**
		 * ��Ѹ���̵���id
		 *
		 * �汾 >= 1
		 */
		var $strIcsonShopGuideId; //std::string

		/**
		 * ��Ѹ���̵�������
		 *
		 * �汾 >= 1
		 */
		var $strIcsonShopGuideCost; //std::string

		/**
		 * ��Ѹ���̵�������
		 *
		 * �汾 >= 1
		 */
		var $strIcsonShopGuideName; //std::string

		/**
		 * ��Ѹ���ܲ�������
		 *
		 * �汾 >= 1
		 */
		var $strIcsonSubsidyType; //std::string

		/**
		 * ��Ѹ���ܲ�������
		 *
		 * �汾 >= 1
		 */
		var $strIcsonSubsidyName; //std::string

		/**
		 * ��Ѹ���ܲ������֤
		 *
		 * �汾 >= 1
		 */
		var $strIcsonSubsidyIdCard; //std::string

		/**
		 * ��Ѹ�ͷ��µ�����ԱID
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSOrderOperatorId; //std::string

		/**
		 * ��Ѹ�ͷ��µ�����Ա����
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSOrderOperatorName; //std::string

		/**
		 * ��Ѹ��Ʊ��˾����
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceCompanyName; //std::string

		/**
		 * ��Ѹ��Ʊ��˾��ַ
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceCompanyAddr; //std::string

		/**
		 * ��Ѹ��Ʊ��˾�绰
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceCompanyPhone; //std::string

		/**
		 * ��Ѹ��Ʊ��˾˰��
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceCompanyTaxNo; //std::string

		/**
		 * ��Ѹ��Ʊ��˾�����˻�
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceCompanyBankNo; //std::string

		/**
		 * ��Ѹ��Ʊ��˾��������
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceCompanyBankName; //std::string

		/**
		 * ��Ѹ��Ʊ�ջ���
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceRecvName; //std::string

		/**
		 * ��Ѹ��Ʊ�ջ���ַ
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceRecvAddr; //std::string

		/**
		 * ��Ѹ��Ʊ�ջ���ַID
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceRecvRegionId; //std::string

		/**
		 * ��Ѹ��Ʊ�ջ��ֻ�
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceRecvMobile; //std::string

		/**
		 * ��Ѹ��Ʊ�ջ��绰
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceRecvTel; //std::string

		/**
		 * ��Ѹ��Ʊ�ջ��ʱ�
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceRecvZip; //std::string

		/**
		 * ��Ѹ��Ʊ���ͷ�ʽ
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceShipType; //std::string

		/**
		 * ��Ѹ��Ʊ���ͷ���
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceShipFee; //std::string

		/**
		 * ��Ѹ����flag
		 *
		 * �汾 >= 1
		 */
		var $strIcsonDealFlag; //std::string

		/**
		 * ��Ѹ���������ֿ���
		 *
		 * �汾 >= 1
		 */
		var $strIcsonStockNo; //std::string

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cBdealCode_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cBusinessBdealId_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cSiteId_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cDealCouponFee_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cCashScore_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cPromotionScore_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cRecvRegionCodeExt_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cDealDigest_u; //uint8_t

		/**
		 * ��Ѹ���ͷ�ʽUFlag
		 *
		 * �汾 >= 1
		 */
		var $cIcsonShippingType_u; //uint8_t

		/**
		 * ��Ѹ֧����ʽUFlag
		 *
		 * �汾 >= 1
		 */
		var $cIcsonPayType_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonAccount_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonMasterLs_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonRate_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonBankRate_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonShopId_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonShopGuideId_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonShopGuideCost_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonShopGuideName_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonSubsidyType_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonSubsidyName_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonSubsidyIdCard_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSOrderOperatorId_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSOrderOperatorName_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceCompanyName_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceCompanyAddr_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceCompanyPhone_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceCompanyTaxNo_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceCompanyBankNo_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceCompanyBankName_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceRecvName_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceRecvAddr_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceRecvRegionId_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceRecvMobile_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceRecvTel_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceRecvZip_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceShipType_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceShipFee_u; //uint8_t

		/**
		 * ��Ѹ����flag
		 *
		 * �汾 >= 1
		 */
		var $cIcsonDealFlag_u; //uint8_t

		/**
		 * ��Ѹ���������ֿ���
		 *
		 * �汾 >= 1
		 */
		var $cIcsonStockNo_u; //uint8_t

		/**
		 * �������ֽ��
		 *
		 * �汾 >= 2
		 */
		var $dwIcsonDealCashBack; //uint32_t

		/**
		 * �������ֽ��UFlag
		 *
		 * �汾 >= 2
		 */
		var $cIcsonDealCashBack_u; //uint8_t

		/**
		 * ��Ѹ�����ţ���10��ͷ
		 *
		 * �汾 >= 3
		 */
		var $strIcsonDealCode; //std::string

		/**
		 * �������ֽ��UFlag
		 *
		 * �汾 >= 3
		 */
		var $cIcsonDealCode_u; //uint8_t

		/**
		 * ��Ѹ��Ʊ����ֿ�id
		 *
		 * �汾 >= 4
		 */
		var $strIcsonInvoiceStockNo; //std::string

		/**
		 * ��Ѹ��Ʊ�����վid
		 *
		 * �汾 >= 4
		 */
		var $strIcsonInvoiceSiteId; //std::string

		/**
		 * 
		 *
		 * �汾 >= 4
		 */
		var $cIcsonInvoiceStockNo_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 4
		 */
		var $cIcsonInvoiceSiteId_u; //uint8_t

		/**
		 * ��Ѹ��Ӫ�̼�id
		 *
		 * �汾 >= 5
		 */
		var $ddwSellerCorpId; //uint64_t

		/**
		 * ��Ѹ��Ӫ���
		 *
		 * �汾 >= 5
		 */
		var $strLmsVolume; //std::string

		/**
		 * ��Ѹ��Ӫ����
		 *
		 * �汾 >= 5
		 */
		var $strLmsWeight; //std::string

		/**
		 * ��Ѹ��Ӫ���
		 *
		 * �汾 >= 5
		 */
		var $strLmsLongest; //std::string

		/**
		 * 
		 *
		 * �汾 >= 5
		 */
		var $cSellerCorpId_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 5
		 */
		var $cLmsVolume_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 5
		 */
		var $cLmsWeight_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 5
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushString($this->strDealId); // ���л�������ţ���ʽ:�������XXXXYYYY����:101041051509351702 ����Ϊstd::string
			$bs->pushUint64_t($this->ddwDealId64); // ���л��������ţ�ͳһƽ̨�ڲ����� ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwBdealId); // ���л����׵��ţ�������һ�ν�����Ϊ���� ����Ϊuint64_t
			$bs->pushString($this->strBusinessDealId); // ���л�ҵ�񶩵���ţ��������йܶ��� ����Ϊstd::string
			$bs->pushUint64_t($this->ddwBuyerId); // ���л����ID ����Ϊuint64_t
			$bs->pushString($this->strBuyerAccount); // ���л�����ʺ� ����Ϊstd::string
			$bs->pushString($this->strBuyerNickName); // ���л�������� ����Ϊstd::string
			$bs->pushString($this->strBuyerNick); // ���л�����ǳ� ����Ϊstd::string
			$bs->pushUint64_t($this->ddwSellerId); // ���л��̼�ID ����Ϊuint64_t
			$bs->pushString($this->strSellerTitle); // ���л��̼���ʵ���� ����Ϊstd::string
			$bs->pushString($this->strSellerNick); // ���л������ǳ� ����Ϊstd::string
			$bs->pushUint32_t($this->dwBusinessId); // ���л�ҵ��ID ����Ϊuint32_t
			$bs->pushUint8_t($this->cDealType); // ���л��������� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwDealSource); // ���л��µ�������1��ҵ����վ��2���ƶ�app��3���ƶ�wap ����Ϊuint32_t
			$bs->pushUint8_t($this->cDealPayType); // ���л�֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6��������� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwDealState); // ���л�����״̬ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPreDealState); // ���л�����ǰһ��״̬ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealProperty); // ���л���������ֵ��ͨ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealProperty1); // ���л���������ֵ��ҵ��1��չ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealProperty2); // ���л���������ֵ��ҵ��2��չ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealProperty3); // ���л���������ֵ��ҵ��3��չ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealProperty4); // ���л���������ֵ��ҵ��4��չ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRefundState); // ���л��˿�״̬, ���ӵ��˿�״̬�Ļ���, 0:���˿�,1:�˿���,2:�˿���� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwEvalState); // ���л���������״̬ ����Ϊuint32_t
			$bs->pushString($this->strItemSkuidList); // ���л���ƷskuID�б� ����Ϊstd::string
			$bs->pushString($this->strItemTitleList); // ���л���Ʒ�����б� ����Ϊstd::string
			$bs->pushUint32_t($this->dwDealTotalFee); // ���л������ܽ��,�µ���� ����Ϊuint32_t
			$bs->pushInt32_t($this->nDealAdjustFee); // ���л����۽�� ����Ϊint
			$bs->pushUint32_t($this->dwDealPayment); // ���л�ʵ���ܽ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealDownPayment); // ���л�C2BԤ�۶����� ����Ϊuint32_t
			$bs->pushInt32_t($this->nDealDiscountTotal); // ���л��Ż��ܽ�� ����Ϊint
			$bs->pushUint32_t($this->dwDealItemTotalFee); // ���л���Ʒ�ܽ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealWhoPayShippingFee); // ���л�˭֧���ʷѣ�1�����ң�2����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealShippingFee); // ���л��ʷѽ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealWhoPayCodFee); // ���л�˭�е�COD�����ѣ�1�����ҳе���2����ң�3��ƽ̨�е� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealCodFee); // ���л�COD������ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealWhoPayInsuranceFee); // ���л�˭֧�����շѣ�1���������ͣ�2����ң�3��ƽ̨�е� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealInsuranceFee); // ���л��˷ѱ��շ� ����Ϊuint32_t
			$bs->pushInt32_t($this->nDealSysAdjustFee); // ���л�ϵͳ���۽���������COD���ҵ��۽������ڴ�����COD�Żݽ�� ����Ϊint
			$bs->pushUint32_t($this->dwDealRefundTotalFee); // ���л��˿��ܽ��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayScore); // ���л�����֧��ֵ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwObtainScore); // ���л���û���ֵ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealGenTime); // ���л���Ʒ������ʱ�� ����Ϊuint32_t
			$bs->pushString($this->strSendFromDesc); // ���л��������������� ����Ϊstd::string
			$bs->pushUint64_t($this->ddwDealSeq); // ���л��µ�ʱ��� ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwDealMd5); // ���л��µ�md5 ����Ϊuint64_t
			$bs->pushString($this->strDealIp); // ���л��µ�IP ����Ϊstd::string
			$bs->pushString($this->strDealRefer); // ���л�refer ����Ϊstd::string
			$bs->pushString($this->strDealVisitKey); // ���л�visitkey ����Ϊstd::string
			$bs->pushString($this->strPromotionDesc); // ���л�����������Ϣ���� ����Ϊstd::string
			$bs->pushString($this->strRecvName); // ���л��ջ��� ����Ϊstd::string
			$bs->pushUint32_t($this->dwRecvRegionCode); // ���л��������� ����Ϊuint32_t
			$bs->pushString($this->strRecvAddress); // ���л���ַ ����Ϊstd::string
			$bs->pushString($this->strRecvPostCode); // ���л��ʱ� ����Ϊstd::string
			$bs->pushString($this->strRecvPhone); // ���л��绰 ����Ϊstd::string
			$bs->pushUint64_t($this->ddwRecvMobile); // ���л��ֻ� ����Ϊuint64_t
			$bs->pushUint32_t($this->dwExpectRecvTime); // ���л������ջ�ʱ��,�� ����Ϊuint32_t
			$bs->pushString($this->strExpectRecvTimeSpan); // ���л������ջ�ʱ�� ����Ϊstd::string
			$bs->pushString($this->strRecvRemark); // ���л��ջ����� ����Ϊstd::string
			$bs->pushUint32_t($this->dwRecvMask); // ���л��ջ�����ֵ ����Ϊuint32_t
			$bs->pushUint8_t($this->cExpressType); // ���л����ͷ�ʽ��1��ƽ�ʣ�2����ݣ�3��EMS��4��B2C�Խ�������5���û����͵����� ����Ϊuint8_t
			$bs->pushString($this->strExpressCompanyID); // ���л�������˾ID ����Ϊstd::string
			$bs->pushString($this->strExpressCompanyName); // ���л�������˾���� ����Ϊstd::string
			$bs->pushString($this->strExpressDealID); // ���л�������˾������ ����Ϊstd::string
			$bs->pushUint16_t($this->wExpectArriveDays); // ���л�Ԥ�Ƶ������� ����Ϊuint16_t
			$bs->pushString($this->strWuliuDealId); // ���л����������ţ�����ϵͳ������ ����Ϊstd::string
			$bs->pushUint8_t($this->cInvoiceType); // ���л���Ʊ���� ����Ϊuint8_t
			$bs->pushString($this->strInvoiceHead); // ���л���Ʊ̧ͷ ����Ϊstd::string
			$bs->pushString($this->strInvoiceContent); // ���л���Ʊ���� ����Ϊstd::string
			$bs->pushString($this->strPayAccount); // ���л�֧���ʺ� ����Ϊstd::string
			$bs->pushString($this->strCftDealId); // ���л�Cft֧������ ����Ϊstd::string
			$bs->pushUint32_t($this->dwDealPayTime); // ���л��������ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealPayReturnTime); // ���л������ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealCheckTime); // ���л����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealCheckVersion); // ���л���˰汾�� ����Ϊuint32_t
			$bs->pushString($this->strDealCheckDesc); // ���л�������� ����Ϊstd::string
			$bs->pushUint32_t($this->dwDealSellerSendTime); // ���л��̼ҷ���ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealConsignTime); // ���л���Ƿ���ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealConfirmRecvTime); // ���л�ǩ��ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealEndTime); // ���л�����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealRecvFeeTime); // ���л�������ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealRecvFeeReturnTime); // ���л�����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealBuyerRecvFee); // ���л��������ܽ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealSellerRecvFee); // ���л���������ܽ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealPayCash); // ���л�֧���ֽ��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealPayTicket); // ���л�֧���Ƹ�ȯ��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealPayCredit); // ���л�֧�����ֽ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealPayOther); // ���л�����֧����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDelayConfirmDays); // ���л��ӳ�ȷ���ջ����� ����Ϊuint32_t
			$bs->pushUint8_t($this->cBuyerTag); // ���л���ұ�� ����Ϊuint8_t
			$bs->pushString($this->strBuyerNote); // ���л���ұ�ע ����Ϊstd::string
			$bs->pushUint8_t($this->cSellerTag); // ���л����ұ�� ����Ϊuint8_t
			$bs->pushString($this->strSellerNote); // ���л����ұ�ע ����Ϊstd::string
			$bs->pushUint32_t($this->dwDataVersion); // ���л����ݰ汾�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDelFlag); // ���л�������Ч��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwVisibleState); // ���л��ɼ���ʶ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // ���л�������ʱ�� ����Ϊuint32_t
			$bs->pushObject($this->oTradeInfoList,'TradePoList'); // ���л���Ʒ�ӵ��б� ����Ϊecc::deal::po::CTradePoList
			$bs->pushObject($this->oPayInfoList,'PayInfoPoList'); // ���л�֧����Ϣ�� ����Ϊecc::deal::po::CPayInfoPoList
			$bs->pushObject($this->oWuliuInfoList,'DealWuliuPoList'); // ���л�������Ϣ�� ����Ϊecc::deal::po::CDealWuliuPoList
			$bs->pushObject($this->oRecvFeeInfoList,'RecvFeePoList'); // ���л������Ϣ�� ����Ϊecc::deal::po::CRecvFeePoList
			$bs->pushObject($this->oRefundInfoList,'DealRefundPoList'); // ���л��˿���Ϣ�� ����Ϊecc::deal::po::CDealRefundPoList
			$bs->pushObject($this->oActionLogInfoList,'DealActionLogPoList'); // ���л���ˮ��־�� ����Ϊecc::deal::po::CDealActionLogPoList
			$bs->pushObject($this->mmapDealExtInfoMap,'stl_multimap'); // ���л�������չ��Ϣ  ����Ϊstd::multimap<uint32_t,std::string> 
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId64_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBdealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBusinessDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerAccount_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerNickName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerNick_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerTitle_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerNick_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBusinessId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealSource_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealPayType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPreDealState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealProperty_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealProperty1_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealProperty2_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealProperty3_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealProperty4_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cEvalState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemSkuidList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemTitleList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealTotalFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealAdjustFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealPayment_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealDownPayment_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealDiscountTotal_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealItemTotalFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealWhoPayShippingFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealShippingFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealWhoPayCodFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealCodFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealWhoPayInsuranceFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealInsuranceFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealSysAdjustFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealRefundTotalFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayScore_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cObtainScore_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealGenTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSendFromDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealSeq_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealMd5_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealIp_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealRefer_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealVisitKey_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPromotionDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvRegionCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvAddress_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvPostCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvPhone_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvMobile_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExpectRecvTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExpectRecvTimeSpan_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvRemark_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvMask_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExpressType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExpressCompanyID_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExpressCompanyName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExpressDealID_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExpectArriveDays_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cWuliuDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cInvoiceType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cInvoiceHead_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cInvoiceContent_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayAccount_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cCftDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealPayTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealPayReturnTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealCheckTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealCheckVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealCheckDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealSellerSendTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealConsignTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealConfirmRecvTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealEndTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealRecvFeeTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealRecvFeeReturnTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealBuyerRecvFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealSellerRecvFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealPayCash_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealPayTicket_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealPayCredit_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealPayOther_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDelayConfirmDays_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerTag_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerNote_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerTag_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerNote_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDataVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDelFlag_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cVisibleState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeInfoList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayInfoList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cWuliuInfoList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvFeeInfoList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundInfoList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cActionLogInfoList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealExtInfoMap_u); // ���л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strBdealCode); // ���л����׵���ţ����ַ�����ʽ�Ľ��׵��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strBusinessBdealId); // ���л�ҵ���׵��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwSiteId); // ���л���վID ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushInt32_t($this->nDealCouponFee); // ���л��Ż�ȯ��� ����Ϊint
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwCashScore); // ���л��ֽ����֧��ֵ ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwPromotionScore); // ���л���������֧��ֵ ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strRecvRegionCodeExt); // ���л���չ�������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strDealDigest); // ���л�����ժҪ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonShippingType); // ���л���Ѹ���ͷ�ʽ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonPayType); // ���л���Ѹ֧����ʽ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonAccount); // ���л���Ѹ�ڲ��ʺ�ID ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonMasterLs); // ���л���Ѹ������Ϣ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonRate); // ���л���Ѹƽ����� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonBankRate); // ���л���Ѹ�������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonShopId); // ���л���Ѹ����id ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonShopGuideId); // ���л���Ѹ���̵���id ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonShopGuideCost); // ���л���Ѹ���̵������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonShopGuideName); // ���л���Ѹ���̵������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonSubsidyType); // ���л���Ѹ���ܲ������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonSubsidyName); // ���л���Ѹ���ܲ������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonSubsidyIdCard); // ���л���Ѹ���ܲ������֤ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSOrderOperatorId); // ���л���Ѹ�ͷ��µ�����ԱID ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSOrderOperatorName); // ���л���Ѹ�ͷ��µ�����Ա���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceCompanyName); // ���л���Ѹ��Ʊ��˾���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceCompanyAddr); // ���л���Ѹ��Ʊ��˾��ַ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceCompanyPhone); // ���л���Ѹ��Ʊ��˾�绰 ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceCompanyTaxNo); // ���л���Ѹ��Ʊ��˾˰�� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceCompanyBankNo); // ���л���Ѹ��Ʊ��˾�����˻� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceCompanyBankName); // ���л���Ѹ��Ʊ��˾�������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceRecvName); // ���л���Ѹ��Ʊ�ջ��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceRecvAddr); // ���л���Ѹ��Ʊ�ջ���ַ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceRecvRegionId); // ���л���Ѹ��Ʊ�ջ���ַID ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceRecvMobile); // ���л���Ѹ��Ʊ�ջ��ֻ� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceRecvTel); // ���л���Ѹ��Ʊ�ջ��绰 ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceRecvZip); // ���л���Ѹ��Ʊ�ջ��ʱ� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceShipType); // ���л���Ѹ��Ʊ���ͷ�ʽ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceShipFee); // ���л���Ѹ��Ʊ���ͷ��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonDealFlag); // ���л���Ѹ����flag ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonStockNo); // ���л���Ѹ���������ֿ��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cBdealCode_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cBusinessBdealId_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cSiteId_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cDealCouponFee_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cCashScore_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cPromotionScore_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cRecvRegionCodeExt_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cDealDigest_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonShippingType_u); // ���л���Ѹ���ͷ�ʽUFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonPayType_u); // ���л���Ѹ֧����ʽUFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonAccount_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonMasterLs_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonRate_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonBankRate_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonShopId_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonShopGuideId_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonShopGuideCost_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonShopGuideName_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonSubsidyType_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonSubsidyName_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonSubsidyIdCard_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSOrderOperatorId_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSOrderOperatorName_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceCompanyName_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceCompanyAddr_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceCompanyPhone_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceCompanyTaxNo_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceCompanyBankNo_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceCompanyBankName_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceRecvName_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceRecvAddr_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceRecvRegionId_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceRecvMobile_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceRecvTel_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceRecvZip_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceShipType_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceShipFee_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonDealFlag_u); // ���л���Ѹ����flag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonStockNo_u); // ���л���Ѹ���������ֿ��� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwIcsonDealCashBack); // ���л��������ֽ�� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cIcsonDealCashBack_u); // ���л��������ֽ��UFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 3 ){
				$bs->pushString($this->strIcsonDealCode); // ���л���Ѹ�����ţ���10��ͷ ����Ϊstd::string
			}
			if(  $this->wVersion >= 3 ){
				$bs->pushUint8_t($this->cIcsonDealCode_u); // ���л��������ֽ��UFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 4 ){
				$bs->pushString($this->strIcsonInvoiceStockNo); // ���л���Ѹ��Ʊ����ֿ�id ����Ϊstd::string
			}
			if(  $this->wVersion >= 4 ){
				$bs->pushString($this->strIcsonInvoiceSiteId); // ���л���Ѹ��Ʊ�����վid ����Ϊstd::string
			}
			if(  $this->wVersion >= 4 ){
				$bs->pushUint8_t($this->cIcsonInvoiceStockNo_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 4 ){
				$bs->pushUint8_t($this->cIcsonInvoiceSiteId_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 5 ){
				$bs->pushUint64_t($this->ddwSellerCorpId); // ���л���Ѹ��Ӫ�̼�id ����Ϊuint64_t
			}
			if(  $this->wVersion >= 5 ){
				$bs->pushString($this->strLmsVolume); // ���л���Ѹ��Ӫ��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 5 ){
				$bs->pushString($this->strLmsWeight); // ���л���Ѹ��Ӫ���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 5 ){
				$bs->pushString($this->strLmsLongest); // ���л���Ѹ��Ӫ��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 5 ){
				$bs->pushUint8_t($this->cSellerCorpId_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 5 ){
				$bs->pushUint8_t($this->cLmsVolume_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 5 ){
				$bs->pushUint8_t($this->cLmsWeight_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 5 ){
				$bs->pushUint8_t($this->cLmsLongest_u); // ���л� ����Ϊuint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->strDealId = $bs->popString(); // �����л�������ţ���ʽ:�������XXXXYYYY����:101041051509351702 ����Ϊstd::string
			$this->ddwDealId64 = $bs->popUint64_t(); // �����л��������ţ�ͳһƽ̨�ڲ����� ����Ϊuint64_t
			$this->ddwBdealId = $bs->popUint64_t(); // �����л����׵��ţ�������һ�ν�����Ϊ���� ����Ϊuint64_t
			$this->strBusinessDealId = $bs->popString(); // �����л�ҵ�񶩵���ţ��������йܶ��� ����Ϊstd::string
			$this->ddwBuyerId = $bs->popUint64_t(); // �����л����ID ����Ϊuint64_t
			$this->strBuyerAccount = $bs->popString(); // �����л�����ʺ� ����Ϊstd::string
			$this->strBuyerNickName = $bs->popString(); // �����л�������� ����Ϊstd::string
			$this->strBuyerNick = $bs->popString(); // �����л�����ǳ� ����Ϊstd::string
			$this->ddwSellerId = $bs->popUint64_t(); // �����л��̼�ID ����Ϊuint64_t
			$this->strSellerTitle = $bs->popString(); // �����л��̼���ʵ���� ����Ϊstd::string
			$this->strSellerNick = $bs->popString(); // �����л������ǳ� ����Ϊstd::string
			$this->dwBusinessId = $bs->popUint32_t(); // �����л�ҵ��ID ����Ϊuint32_t
			$this->cDealType = $bs->popUint8_t(); // �����л��������� ����Ϊuint8_t
			$this->dwDealSource = $bs->popUint32_t(); // �����л��µ�������1��ҵ����վ��2���ƶ�app��3���ƶ�wap ����Ϊuint32_t
			$this->cDealPayType = $bs->popUint8_t(); // �����л�֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6��������� ����Ϊuint8_t
			$this->dwDealState = $bs->popUint32_t(); // �����л�����״̬ ����Ϊuint32_t
			$this->dwPreDealState = $bs->popUint32_t(); // �����л�����ǰһ��״̬ ����Ϊuint32_t
			$this->dwDealProperty = $bs->popUint32_t(); // �����л���������ֵ��ͨ�� ����Ϊuint32_t
			$this->dwDealProperty1 = $bs->popUint32_t(); // �����л���������ֵ��ҵ��1��չ�� ����Ϊuint32_t
			$this->dwDealProperty2 = $bs->popUint32_t(); // �����л���������ֵ��ҵ��2��չ�� ����Ϊuint32_t
			$this->dwDealProperty3 = $bs->popUint32_t(); // �����л���������ֵ��ҵ��3��չ�� ����Ϊuint32_t
			$this->dwDealProperty4 = $bs->popUint32_t(); // �����л���������ֵ��ҵ��4��չ�� ����Ϊuint32_t
			$this->dwRefundState = $bs->popUint32_t(); // �����л��˿�״̬, ���ӵ��˿�״̬�Ļ���, 0:���˿�,1:�˿���,2:�˿���� ����Ϊuint32_t
			$this->dwEvalState = $bs->popUint32_t(); // �����л���������״̬ ����Ϊuint32_t
			$this->strItemSkuidList = $bs->popString(); // �����л���ƷskuID�б� ����Ϊstd::string
			$this->strItemTitleList = $bs->popString(); // �����л���Ʒ�����б� ����Ϊstd::string
			$this->dwDealTotalFee = $bs->popUint32_t(); // �����л������ܽ��,�µ���� ����Ϊuint32_t
			$this->nDealAdjustFee = $bs->popInt32_t(); // �����л����۽�� ����Ϊint
			$this->dwDealPayment = $bs->popUint32_t(); // �����л�ʵ���ܽ�� ����Ϊuint32_t
			$this->dwDealDownPayment = $bs->popUint32_t(); // �����л�C2BԤ�۶����� ����Ϊuint32_t
			$this->nDealDiscountTotal = $bs->popInt32_t(); // �����л��Ż��ܽ�� ����Ϊint
			$this->dwDealItemTotalFee = $bs->popUint32_t(); // �����л���Ʒ�ܽ�� ����Ϊuint32_t
			$this->dwDealWhoPayShippingFee = $bs->popUint32_t(); // �����л�˭֧���ʷѣ�1�����ң�2����� ����Ϊuint32_t
			$this->dwDealShippingFee = $bs->popUint32_t(); // �����л��ʷѽ�� ����Ϊuint32_t
			$this->dwDealWhoPayCodFee = $bs->popUint32_t(); // �����л�˭�е�COD�����ѣ�1�����ҳе���2����ң�3��ƽ̨�е� ����Ϊuint32_t
			$this->dwDealCodFee = $bs->popUint32_t(); // �����л�COD������ ����Ϊuint32_t
			$this->dwDealWhoPayInsuranceFee = $bs->popUint32_t(); // �����л�˭֧�����շѣ�1���������ͣ�2����ң�3��ƽ̨�е� ����Ϊuint32_t
			$this->dwDealInsuranceFee = $bs->popUint32_t(); // �����л��˷ѱ��շ� ����Ϊuint32_t
			$this->nDealSysAdjustFee = $bs->popInt32_t(); // �����л�ϵͳ���۽���������COD���ҵ��۽������ڴ�����COD�Żݽ�� ����Ϊint
			$this->dwDealRefundTotalFee = $bs->popUint32_t(); // �����л��˿��ܽ��� ����Ϊuint32_t
			$this->dwPayScore = $bs->popUint32_t(); // �����л�����֧��ֵ ����Ϊuint32_t
			$this->dwObtainScore = $bs->popUint32_t(); // �����л���û���ֵ ����Ϊuint32_t
			$this->dwDealGenTime = $bs->popUint32_t(); // �����л���Ʒ������ʱ�� ����Ϊuint32_t
			$this->strSendFromDesc = $bs->popString(); // �����л��������������� ����Ϊstd::string
			$this->ddwDealSeq = $bs->popUint64_t(); // �����л��µ�ʱ��� ����Ϊuint64_t
			$this->ddwDealMd5 = $bs->popUint64_t(); // �����л��µ�md5 ����Ϊuint64_t
			$this->strDealIp = $bs->popString(); // �����л��µ�IP ����Ϊstd::string
			$this->strDealRefer = $bs->popString(); // �����л�refer ����Ϊstd::string
			$this->strDealVisitKey = $bs->popString(); // �����л�visitkey ����Ϊstd::string
			$this->strPromotionDesc = $bs->popString(); // �����л�����������Ϣ���� ����Ϊstd::string
			$this->strRecvName = $bs->popString(); // �����л��ջ��� ����Ϊstd::string
			$this->dwRecvRegionCode = $bs->popUint32_t(); // �����л��������� ����Ϊuint32_t
			$this->strRecvAddress = $bs->popString(); // �����л���ַ ����Ϊstd::string
			$this->strRecvPostCode = $bs->popString(); // �����л��ʱ� ����Ϊstd::string
			$this->strRecvPhone = $bs->popString(); // �����л��绰 ����Ϊstd::string
			$this->ddwRecvMobile = $bs->popUint64_t(); // �����л��ֻ� ����Ϊuint64_t
			$this->dwExpectRecvTime = $bs->popUint32_t(); // �����л������ջ�ʱ��,�� ����Ϊuint32_t
			$this->strExpectRecvTimeSpan = $bs->popString(); // �����л������ջ�ʱ�� ����Ϊstd::string
			$this->strRecvRemark = $bs->popString(); // �����л��ջ����� ����Ϊstd::string
			$this->dwRecvMask = $bs->popUint32_t(); // �����л��ջ�����ֵ ����Ϊuint32_t
			$this->cExpressType = $bs->popUint8_t(); // �����л����ͷ�ʽ��1��ƽ�ʣ�2����ݣ�3��EMS��4��B2C�Խ�������5���û����͵����� ����Ϊuint8_t
			$this->strExpressCompanyID = $bs->popString(); // �����л�������˾ID ����Ϊstd::string
			$this->strExpressCompanyName = $bs->popString(); // �����л�������˾���� ����Ϊstd::string
			$this->strExpressDealID = $bs->popString(); // �����л�������˾������ ����Ϊstd::string
			$this->wExpectArriveDays = $bs->popUint16_t(); // �����л�Ԥ�Ƶ������� ����Ϊuint16_t
			$this->strWuliuDealId = $bs->popString(); // �����л����������ţ�����ϵͳ������ ����Ϊstd::string
			$this->cInvoiceType = $bs->popUint8_t(); // �����л���Ʊ���� ����Ϊuint8_t
			$this->strInvoiceHead = $bs->popString(); // �����л���Ʊ̧ͷ ����Ϊstd::string
			$this->strInvoiceContent = $bs->popString(); // �����л���Ʊ���� ����Ϊstd::string
			$this->strPayAccount = $bs->popString(); // �����л�֧���ʺ� ����Ϊstd::string
			$this->strCftDealId = $bs->popString(); // �����л�Cft֧������ ����Ϊstd::string
			$this->dwDealPayTime = $bs->popUint32_t(); // �����л��������ʱ�� ����Ϊuint32_t
			$this->dwDealPayReturnTime = $bs->popUint32_t(); // �����л������ʱ�� ����Ϊuint32_t
			$this->dwDealCheckTime = $bs->popUint32_t(); // �����л����ʱ�� ����Ϊuint32_t
			$this->dwDealCheckVersion = $bs->popUint32_t(); // �����л���˰汾�� ����Ϊuint32_t
			$this->strDealCheckDesc = $bs->popString(); // �����л�������� ����Ϊstd::string
			$this->dwDealSellerSendTime = $bs->popUint32_t(); // �����л��̼ҷ���ʱ�� ����Ϊuint32_t
			$this->dwDealConsignTime = $bs->popUint32_t(); // �����л���Ƿ���ʱ�� ����Ϊuint32_t
			$this->dwDealConfirmRecvTime = $bs->popUint32_t(); // �����л�ǩ��ʱ�� ����Ϊuint32_t
			$this->dwDealEndTime = $bs->popUint32_t(); // �����л�����ʱ�� ����Ϊuint32_t
			$this->dwDealRecvFeeTime = $bs->popUint32_t(); // �����л�������ʱ�� ����Ϊuint32_t
			$this->dwDealRecvFeeReturnTime = $bs->popUint32_t(); // �����л�����ʱ�� ����Ϊuint32_t
			$this->dwDealBuyerRecvFee = $bs->popUint32_t(); // �����л��������ܽ�� ����Ϊuint32_t
			$this->dwDealSellerRecvFee = $bs->popUint32_t(); // �����л���������ܽ�� ����Ϊuint32_t
			$this->dwDealPayCash = $bs->popUint32_t(); // �����л�֧���ֽ��� ����Ϊuint32_t
			$this->dwDealPayTicket = $bs->popUint32_t(); // �����л�֧���Ƹ�ȯ��� ����Ϊuint32_t
			$this->dwDealPayCredit = $bs->popUint32_t(); // �����л�֧�����ֽ�� ����Ϊuint32_t
			$this->dwDealPayOther = $bs->popUint32_t(); // �����л�����֧����� ����Ϊuint32_t
			$this->dwDelayConfirmDays = $bs->popUint32_t(); // �����л��ӳ�ȷ���ջ����� ����Ϊuint32_t
			$this->cBuyerTag = $bs->popUint8_t(); // �����л���ұ�� ����Ϊuint8_t
			$this->strBuyerNote = $bs->popString(); // �����л���ұ�ע ����Ϊstd::string
			$this->cSellerTag = $bs->popUint8_t(); // �����л����ұ�� ����Ϊuint8_t
			$this->strSellerNote = $bs->popString(); // �����л����ұ�ע ����Ϊstd::string
			$this->dwDataVersion = $bs->popUint32_t(); // �����л����ݰ汾�� ����Ϊuint32_t
			$this->dwDelFlag = $bs->popUint32_t(); // �����л�������Ч��� ����Ϊuint32_t
			$this->dwVisibleState = $bs->popUint32_t(); // �����л��ɼ���ʶ ����Ϊuint32_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // �����л�������ʱ�� ����Ϊuint32_t
			$this->oTradeInfoList = $bs->popObject('TradePoList'); // �����л���Ʒ�ӵ��б� ����Ϊecc::deal::po::CTradePoList
			$this->oPayInfoList = $bs->popObject('PayInfoPoList'); // �����л�֧����Ϣ�� ����Ϊecc::deal::po::CPayInfoPoList
			$this->oWuliuInfoList = $bs->popObject('DealWuliuPoList'); // �����л�������Ϣ�� ����Ϊecc::deal::po::CDealWuliuPoList
			$this->oRecvFeeInfoList = $bs->popObject('RecvFeePoList'); // �����л������Ϣ�� ����Ϊecc::deal::po::CRecvFeePoList
			$this->oRefundInfoList = $bs->popObject('DealRefundPoList'); // �����л��˿���Ϣ�� ����Ϊecc::deal::po::CDealRefundPoList
			$this->oActionLogInfoList = $bs->popObject('DealActionLogPoList'); // �����л���ˮ��־�� ����Ϊecc::deal::po::CDealActionLogPoList
			$this->mmapDealExtInfoMap = $bs->popObject('stl_multimap<uint32_t,stl_string>'); // �����л�������չ��Ϣ  ����Ϊstd::multimap<uint32_t,std::string> 
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId64_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBdealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBusinessDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerAccount_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerNickName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerNick_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerTitle_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerNick_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBusinessId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealSource_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealPayType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPreDealState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealProperty_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealProperty1_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealProperty2_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealProperty3_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealProperty4_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cEvalState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemSkuidList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemTitleList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealTotalFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealAdjustFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealPayment_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealDownPayment_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealDiscountTotal_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealItemTotalFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealWhoPayShippingFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealShippingFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealWhoPayCodFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealCodFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealWhoPayInsuranceFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealInsuranceFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealSysAdjustFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealRefundTotalFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayScore_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cObtainScore_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealGenTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSendFromDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealSeq_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealMd5_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealIp_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealRefer_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealVisitKey_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPromotionDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvRegionCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvAddress_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvPostCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvPhone_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvMobile_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExpectRecvTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExpectRecvTimeSpan_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvRemark_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvMask_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExpressType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExpressCompanyID_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExpressCompanyName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExpressDealID_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExpectArriveDays_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cWuliuDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cInvoiceType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cInvoiceHead_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cInvoiceContent_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayAccount_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cCftDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealPayTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealPayReturnTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealCheckTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealCheckVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealCheckDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealSellerSendTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealConsignTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealConfirmRecvTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealEndTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealRecvFeeTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealRecvFeeReturnTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealBuyerRecvFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealSellerRecvFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealPayCash_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealPayTicket_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealPayCredit_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealPayOther_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDelayConfirmDays_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerTag_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerNote_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerTag_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerNote_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDataVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDelFlag_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cVisibleState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cWuliuInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvFeeInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cActionLogInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealExtInfoMap_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$this->strBdealCode = $bs->popString(); // �����л����׵���ţ����ַ�����ʽ�Ľ��׵��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strBusinessBdealId = $bs->popString(); // �����л�ҵ���׵��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->dwSiteId = $bs->popUint32_t(); // �����л���վID ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->nDealCouponFee = $bs->popInt32_t(); // �����л��Ż�ȯ��� ����Ϊint
			}
			if(  $this->wVersion >= 1 ){
				$this->dwCashScore = $bs->popUint32_t(); // �����л��ֽ����֧��ֵ ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->dwPromotionScore = $bs->popUint32_t(); // �����л���������֧��ֵ ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->strRecvRegionCodeExt = $bs->popString(); // �����л���չ�������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strDealDigest = $bs->popString(); // �����л�����ժҪ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonShippingType = $bs->popString(); // �����л���Ѹ���ͷ�ʽ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonPayType = $bs->popString(); // �����л���Ѹ֧����ʽ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonAccount = $bs->popString(); // �����л���Ѹ�ڲ��ʺ�ID ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonMasterLs = $bs->popString(); // �����л���Ѹ������Ϣ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonRate = $bs->popString(); // �����л���Ѹƽ����� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonBankRate = $bs->popString(); // �����л���Ѹ�������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonShopId = $bs->popString(); // �����л���Ѹ����id ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonShopGuideId = $bs->popString(); // �����л���Ѹ���̵���id ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonShopGuideCost = $bs->popString(); // �����л���Ѹ���̵������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonShopGuideName = $bs->popString(); // �����л���Ѹ���̵������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonSubsidyType = $bs->popString(); // �����л���Ѹ���ܲ������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonSubsidyName = $bs->popString(); // �����л���Ѹ���ܲ������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonSubsidyIdCard = $bs->popString(); // �����л���Ѹ���ܲ������֤ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSOrderOperatorId = $bs->popString(); // �����л���Ѹ�ͷ��µ�����ԱID ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSOrderOperatorName = $bs->popString(); // �����л���Ѹ�ͷ��µ�����Ա���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceCompanyName = $bs->popString(); // �����л���Ѹ��Ʊ��˾���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceCompanyAddr = $bs->popString(); // �����л���Ѹ��Ʊ��˾��ַ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceCompanyPhone = $bs->popString(); // �����л���Ѹ��Ʊ��˾�绰 ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceCompanyTaxNo = $bs->popString(); // �����л���Ѹ��Ʊ��˾˰�� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceCompanyBankNo = $bs->popString(); // �����л���Ѹ��Ʊ��˾�����˻� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceCompanyBankName = $bs->popString(); // �����л���Ѹ��Ʊ��˾�������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceRecvName = $bs->popString(); // �����л���Ѹ��Ʊ�ջ��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceRecvAddr = $bs->popString(); // �����л���Ѹ��Ʊ�ջ���ַ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceRecvRegionId = $bs->popString(); // �����л���Ѹ��Ʊ�ջ���ַID ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceRecvMobile = $bs->popString(); // �����л���Ѹ��Ʊ�ջ��ֻ� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceRecvTel = $bs->popString(); // �����л���Ѹ��Ʊ�ջ��绰 ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceRecvZip = $bs->popString(); // �����л���Ѹ��Ʊ�ջ��ʱ� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceShipType = $bs->popString(); // �����л���Ѹ��Ʊ���ͷ�ʽ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceShipFee = $bs->popString(); // �����л���Ѹ��Ʊ���ͷ��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonDealFlag = $bs->popString(); // �����л���Ѹ����flag ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonStockNo = $bs->popString(); // �����л���Ѹ���������ֿ��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cBdealCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cBusinessBdealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cSiteId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cDealCouponFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cCashScore_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cPromotionScore_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cRecvRegionCodeExt_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cDealDigest_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonShippingType_u = $bs->popUint8_t(); // �����л���Ѹ���ͷ�ʽUFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonPayType_u = $bs->popUint8_t(); // �����л���Ѹ֧����ʽUFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonAccount_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonMasterLs_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonRate_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonBankRate_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonShopId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonShopGuideId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonShopGuideCost_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonShopGuideName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonSubsidyType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonSubsidyName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonSubsidyIdCard_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSOrderOperatorId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSOrderOperatorName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceCompanyName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceCompanyAddr_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceCompanyPhone_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceCompanyTaxNo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceCompanyBankNo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceCompanyBankName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceRecvName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceRecvAddr_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceRecvRegionId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceRecvMobile_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceRecvTel_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceRecvZip_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceShipType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceShipFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonDealFlag_u = $bs->popUint8_t(); // �����л���Ѹ����flag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonStockNo_u = $bs->popUint8_t(); // �����л���Ѹ���������ֿ��� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwIcsonDealCashBack = $bs->popUint32_t(); // �����л��������ֽ�� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cIcsonDealCashBack_u = $bs->popUint8_t(); // �����л��������ֽ��UFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 3 ){
				$this->strIcsonDealCode = $bs->popString(); // �����л���Ѹ�����ţ���10��ͷ ����Ϊstd::string
			}
			if(  $this->wVersion >= 3 ){
				$this->cIcsonDealCode_u = $bs->popUint8_t(); // �����л��������ֽ��UFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 4 ){
				$this->strIcsonInvoiceStockNo = $bs->popString(); // �����л���Ѹ��Ʊ����ֿ�id ����Ϊstd::string
			}
			if(  $this->wVersion >= 4 ){
				$this->strIcsonInvoiceSiteId = $bs->popString(); // �����л���Ѹ��Ʊ�����վid ����Ϊstd::string
			}
			if(  $this->wVersion >= 4 ){
				$this->cIcsonInvoiceStockNo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 4 ){
				$this->cIcsonInvoiceSiteId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 5 ){
				$this->ddwSellerCorpId = $bs->popUint64_t(); // �����л���Ѹ��Ӫ�̼�id ����Ϊuint64_t
			}
			if(  $this->wVersion >= 5 ){
				$this->strLmsVolume = $bs->popString(); // �����л���Ѹ��Ӫ��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 5 ){
				$this->strLmsWeight = $bs->popString(); // �����л���Ѹ��Ӫ���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 5 ){
				$this->strLmsLongest = $bs->popString(); // �����л���Ѹ��Ӫ��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 5 ){
				$this->cSellerCorpId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 5 ){
				$this->cLmsVolume_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 5 ){
				$this->cLmsWeight_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 5 ){
				$this->cLmsLongest_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}

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


//source idl: com.ecc.deal.idl.DealPo.java

if (!class_exists('PayInfoPoList')) {
class PayInfoPoList
{
		/**
		 * �汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ֧�����б�
		 *
		 * �汾 >= 0
		 */
		var $vecPayInfoList; //std::vector<ecc::deal::po::CPayInfoPo> 

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л��汾�� ����Ϊuint16_t
			$bs->pushObject($this->vecPayInfoList,'stl_vector'); // ���л�֧�����б� ����Ϊstd::vector<ecc::deal::po::CPayInfoPo> 
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayInfoList_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л��汾�� ����Ϊuint16_t
			$this->vecPayInfoList = $bs->popObject('stl_vector<PayInfoPo>'); // �����л�֧�����б� ����Ϊstd::vector<ecc::deal::po::CPayInfoPo> 
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.ecc.deal.idl.PayInfoPoList.java

if (!class_exists('PayInfoPo')) {
class PayInfoPo
{
		/**
		 * �汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ֧����DB�������ͣ�0:Insert 1:Update
		 *
		 * �汾 >= 0
		 */
		var $dwControl; //uint32_t

		/**
		 * ֧����ID
		 *
		 * �汾 >= 0
		 */
		var $ddwPayId; //uint64_t

		/**
		 * ������ţ���ʽ:�������XXXXYYYY����:101041051509351702
		 *
		 * �汾 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * �������ţ�ͳһƽ̨�ڲ�����
		 *
		 * �汾 >= 0
		 */
		var $ddwDealId64; //uint64_t

		/**
		 * ���׵��ţ�������һ�ν�����Ϊ����
		 *
		 * �汾 >= 0
		 */
		var $ddwBdealId; //uint64_t

		/**
		 * ���ID
		 *
		 * �汾 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * ����ǳ�
		 *
		 * �汾 >= 0
		 */
		var $strBuyerNickName; //std::string

		/**
		 * �̼�ID
		 *
		 * �汾 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * �̼�����
		 *
		 * �汾 >= 0
		 */
		var $strSellerTitle; //std::string

		/**
		 * ��Ʒ�����б�
		 *
		 * �汾 >= 0
		 */
		var $strItemTitleList; //std::string

		/**
		 * ֧���ܽ��
		 *
		 * �汾 >= 0
		 */
		var $dwPayTotalFee; //uint32_t

		/**
		 * ����������������Ʒʵ�����+������
		 *
		 * �汾 >= 0
		 */
		var $dwPayDealTotalFee; //uint32_t

		/**
		 * �ʷѽ��
		 *
		 * �汾 >= 0
		 */
		var $dwPayShippingFee; //uint32_t

		/**
		 * ֧���ʺ�
		 *
		 * �汾 >= 0
		 */
		var $strPayAccount; //std::string

		/**
		 * ֧����״̬��1��δ֧����2��֧�����
		 *
		 * �汾 >= 0
		 */
		var $dwPayState; //uint32_t

		/**
		 * ֧�������
		 *
		 * �汾 >= 0
		 */
		var $dwPayProperty; //uint32_t

		/**
		 * ֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6���������
		 *
		 * �汾 >= 0
		 */
		var $cPayType; //uint8_t

		/**
		 * ֧������
		 *
		 * �汾 >= 0
		 */
		var $cPayChannel; //uint8_t

		/**
		 * ֧������ID
		 *
		 * �汾 >= 0
		 */
		var $strPayBank; //std::string

		/**
		 * ֧���������
		 *
		 * �汾 >= 0
		 */
		var $strPayDealId; //std::string

		/**
		 * ֧��������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwPayGenTime; //uint32_t

		/**
		 * ֧������Ч��ʼʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwPayEnableBeginTime; //uint32_t

		/**
		 * ֧������Ч����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwPayEnableEndTime; //uint32_t

		/**
		 * ֧�����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwPayFinishTime; //uint32_t

		/**
		 * ֧������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwPayReturnTime; //uint32_t

		/**
		 * ������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwRecvFeeFinishTime; //uint32_t

		/**
		 * ����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwRecvFeeReturnTime; //uint32_t

		/**
		 * �������ܽ��
		 *
		 * �汾 >= 0
		 */
		var $dwPayBuyerRecvFee; //uint32_t

		/**
		 * ��������ܽ��
		 *
		 * �汾 >= 0
		 */
		var $dwPaySellerRecvFee; //uint32_t

		/**
		 * �Ƹ�ͨ��������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwCftDealGenTime; //uint32_t

		/**
		 * �ֽ�֧�����
		 *
		 * �汾 >= 0
		 */
		var $dwPayCashFee; //uint32_t

		/**
		 * �ֽ�ȯ֧�����
		 *
		 * �汾 >= 0
		 */
		var $dwPayTicketFee; //uint32_t

		/**
		 * ����֧�����
		 *
		 * �汾 >= 0
		 */
		var $dwPayCreditFee; //uint32_t

		/**
		 * ����֧�����
		 *
		 * �汾 >= 0
		 */
		var $dwPayOthersFee; //uint32_t

		/**
		 * ֧��������
		 *
		 * �汾 >= 0
		 */
		var $dwPayServiceFee; //uint32_t

		/**
		 * ˭�е�COD�����ѣ�1�����ҳе���2����ң�3��ƽ̨�е�
		 *
		 * �汾 >= 0
		 */
		var $dwWhoPayCodFee; //uint32_t

		/**
		 * COD�Ƹ�֧ͨ��������
		 *
		 * �汾 >= 0
		 */
		var $dwPayCodCftServiceFee; //uint32_t

		/**
		 * CODPaipai֧��������
		 *
		 * �汾 >= 0
		 */
		var $dwPayCodPaipaiServiceFee; //uint32_t

		/**
		 * COD�����ѵ��۽��
		 *
		 * �汾 >= 0
		 */
		var $nPayCodServiceAdjustFee; //int

		/**
		 * CODPaipaiǩ��ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwPayCodPaipaiConsignTime; //uint32_t

		/**
		 * COD����֧��������
		 *
		 * �汾 >= 0
		 */
		var $dwPayCodWuliuServiceFee; //uint32_t

		/**
		 * COD���������
		 *
		 * �汾 >= 0
		 */
		var $dwPayCodWuliuRecvFee; //uint32_t

		/**
		 * COD���Ҵ����
		 *
		 * �汾 >= 0
		 */
		var $dwPayCodSellerRecvFee; //uint32_t

		/**
		 * COD����ǩ��ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwPayCodWuliuConsignTime; //uint32_t

		/**
		 * COD�������ջ���
		 *
		 * �汾 >= 0
		 */
		var $dwPayCodWuliuCollectionMoney; //uint32_t

		/**
		 * COD����SPID
		 *
		 * �汾 >= 0
		 */
		var $strPayCodWuliuSpid; //std::string

		/**
		 * ���ڸ�������
		 *
		 * �汾 >= 0
		 */
		var $strPayInstallmentBank; //std::string

		/**
		 * ���ڸ�������
		 *
		 * �汾 >= 0
		 */
		var $wPayInstallmentNum; //uint16_t

		/**
		 * ���ڸ���ÿ�ڽ��
		 *
		 * �汾 >= 0
		 */
		var $dwPayInstallmentPayment; //uint32_t

		/**
		 * ������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cControl_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId64_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBdealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerNickName_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerTitle_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemTitleList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayTotalFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayDealTotalFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayShippingFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayAccount_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayProperty_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayChannel_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayBank_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayGenTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayEnableBeginTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayEnableEndTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayFinishTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayReturnTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvFeeFinishTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvFeeReturnTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayBuyerRecvFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPaySellerRecvFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cCftDealGenTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayCashFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayTicketFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayCreditFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayOthersFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayServiceFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cWhoPayCodFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayCodCftServiceFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayCodPaipaiServiceFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayCodServiceAdjustFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayCodPaipaiConsignTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayCodWuliuServiceFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayCodWuliuRecvFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayCodSellerRecvFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayCodWuliuConsignTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayCodWuliuCollectionMoney_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayCodWuliuSpid_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayInstallmentBank_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayInstallmentNum_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayInstallmentPayment_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t

		/**
		 * ֧��ҵ�񵥺�, ֧��ϵͳ��ҵ�񶩵���
		 *
		 * �汾 >= 1
		 */
		var $strPayBusinessId; //std::string

		/**
		 * ֧��ҵ�񵥺�, ֧��ϵͳ��ҵ�񶩵���
		 *
		 * �汾 >= 1
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
			$bs->pushUint16_t($this->wVersion); // ���л��汾�� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwControl); // ���л�֧����DB�������ͣ�0:Insert 1:Update ����Ϊuint32_t
			$bs->pushUint64_t($this->ddwPayId); // ���л�֧����ID ����Ϊuint64_t
			$bs->pushString($this->strDealId); // ���л�������ţ���ʽ:�������XXXXYYYY����:101041051509351702 ����Ϊstd::string
			$bs->pushUint64_t($this->ddwDealId64); // ���л��������ţ�ͳһƽ̨�ڲ����� ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwBdealId); // ���л����׵��ţ�������һ�ν�����Ϊ���� ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwBuyerId); // ���л����ID ����Ϊuint64_t
			$bs->pushString($this->strBuyerNickName); // ���л�����ǳ� ����Ϊstd::string
			$bs->pushUint64_t($this->ddwSellerId); // ���л��̼�ID ����Ϊuint64_t
			$bs->pushString($this->strSellerTitle); // ���л��̼����� ����Ϊstd::string
			$bs->pushString($this->strItemTitleList); // ���л���Ʒ�����б� ����Ϊstd::string
			$bs->pushUint32_t($this->dwPayTotalFee); // ���л�֧���ܽ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayDealTotalFee); // ���л�����������������Ʒʵ�����+������ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayShippingFee); // ���л��ʷѽ�� ����Ϊuint32_t
			$bs->pushString($this->strPayAccount); // ���л�֧���ʺ� ����Ϊstd::string
			$bs->pushUint32_t($this->dwPayState); // ���л�֧����״̬��1��δ֧����2��֧����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayProperty); // ���л�֧������� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPayType); // ���л�֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6��������� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayChannel); // ���л�֧������ ����Ϊuint8_t
			$bs->pushString($this->strPayBank); // ���л�֧������ID ����Ϊstd::string
			$bs->pushString($this->strPayDealId); // ���л�֧��������� ����Ϊstd::string
			$bs->pushUint32_t($this->dwPayGenTime); // ���л�֧��������ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayEnableBeginTime); // ���л�֧������Ч��ʼʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayEnableEndTime); // ���л�֧������Ч����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayFinishTime); // ���л�֧�����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayReturnTime); // ���л�֧������ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRecvFeeFinishTime); // ���л�������ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRecvFeeReturnTime); // ���л�����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayBuyerRecvFee); // ���л��������ܽ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPaySellerRecvFee); // ���л���������ܽ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwCftDealGenTime); // ���л��Ƹ�ͨ��������ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayCashFee); // ���л��ֽ�֧����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayTicketFee); // ���л��ֽ�ȯ֧����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayCreditFee); // ���л�����֧����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayOthersFee); // ���л�����֧����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayServiceFee); // ���л�֧�������� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwWhoPayCodFee); // ���л�˭�е�COD�����ѣ�1�����ҳе���2����ң�3��ƽ̨�е� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayCodCftServiceFee); // ���л�COD�Ƹ�֧ͨ�������� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayCodPaipaiServiceFee); // ���л�CODPaipai֧�������� ����Ϊuint32_t
			$bs->pushInt32_t($this->nPayCodServiceAdjustFee); // ���л�COD�����ѵ��۽�� ����Ϊint
			$bs->pushUint32_t($this->dwPayCodPaipaiConsignTime); // ���л�CODPaipaiǩ��ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayCodWuliuServiceFee); // ���л�COD����֧�������� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayCodWuliuRecvFee); // ���л�COD��������� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayCodSellerRecvFee); // ���л�COD���Ҵ���� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayCodWuliuConsignTime); // ���л�COD����ǩ��ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayCodWuliuCollectionMoney); // ���л�COD�������ջ��� ����Ϊuint32_t
			$bs->pushString($this->strPayCodWuliuSpid); // ���л�COD����SPID ����Ϊstd::string
			$bs->pushString($this->strPayInstallmentBank); // ���л����ڸ������� ����Ϊstd::string
			$bs->pushUint16_t($this->wPayInstallmentNum); // ���л����ڸ������� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwPayInstallmentPayment); // ���л����ڸ���ÿ�ڽ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // ���л�������ʱ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cControl_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId64_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBdealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerNickName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerTitle_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemTitleList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayTotalFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayDealTotalFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayShippingFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayAccount_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayProperty_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayChannel_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayBank_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayGenTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayEnableBeginTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayEnableEndTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayFinishTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayReturnTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvFeeFinishTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvFeeReturnTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayBuyerRecvFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPaySellerRecvFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cCftDealGenTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayCashFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayTicketFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayCreditFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayOthersFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayServiceFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cWhoPayCodFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayCodCftServiceFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayCodPaipaiServiceFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayCodServiceAdjustFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayCodPaipaiConsignTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayCodWuliuServiceFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayCodWuliuRecvFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayCodSellerRecvFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayCodWuliuConsignTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayCodWuliuCollectionMoney_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayCodWuliuSpid_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayInstallmentBank_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayInstallmentNum_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayInstallmentPayment_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // ���л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strPayBusinessId); // ���л�֧��ҵ�񵥺�, ֧��ϵͳ��ҵ�񶩵��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cPayBusinessId_u); // ���л�֧��ҵ�񵥺�, ֧��ϵͳ��ҵ�񶩵��� ����Ϊuint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л��汾�� ����Ϊuint16_t
			$this->dwControl = $bs->popUint32_t(); // �����л�֧����DB�������ͣ�0:Insert 1:Update ����Ϊuint32_t
			$this->ddwPayId = $bs->popUint64_t(); // �����л�֧����ID ����Ϊuint64_t
			$this->strDealId = $bs->popString(); // �����л�������ţ���ʽ:�������XXXXYYYY����:101041051509351702 ����Ϊstd::string
			$this->ddwDealId64 = $bs->popUint64_t(); // �����л��������ţ�ͳһƽ̨�ڲ����� ����Ϊuint64_t
			$this->ddwBdealId = $bs->popUint64_t(); // �����л����׵��ţ�������һ�ν�����Ϊ���� ����Ϊuint64_t
			$this->ddwBuyerId = $bs->popUint64_t(); // �����л����ID ����Ϊuint64_t
			$this->strBuyerNickName = $bs->popString(); // �����л�����ǳ� ����Ϊstd::string
			$this->ddwSellerId = $bs->popUint64_t(); // �����л��̼�ID ����Ϊuint64_t
			$this->strSellerTitle = $bs->popString(); // �����л��̼����� ����Ϊstd::string
			$this->strItemTitleList = $bs->popString(); // �����л���Ʒ�����б� ����Ϊstd::string
			$this->dwPayTotalFee = $bs->popUint32_t(); // �����л�֧���ܽ�� ����Ϊuint32_t
			$this->dwPayDealTotalFee = $bs->popUint32_t(); // �����л�����������������Ʒʵ�����+������ ����Ϊuint32_t
			$this->dwPayShippingFee = $bs->popUint32_t(); // �����л��ʷѽ�� ����Ϊuint32_t
			$this->strPayAccount = $bs->popString(); // �����л�֧���ʺ� ����Ϊstd::string
			$this->dwPayState = $bs->popUint32_t(); // �����л�֧����״̬��1��δ֧����2��֧����� ����Ϊuint32_t
			$this->dwPayProperty = $bs->popUint32_t(); // �����л�֧������� ����Ϊuint32_t
			$this->cPayType = $bs->popUint8_t(); // �����л�֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6��������� ����Ϊuint8_t
			$this->cPayChannel = $bs->popUint8_t(); // �����л�֧������ ����Ϊuint8_t
			$this->strPayBank = $bs->popString(); // �����л�֧������ID ����Ϊstd::string
			$this->strPayDealId = $bs->popString(); // �����л�֧��������� ����Ϊstd::string
			$this->dwPayGenTime = $bs->popUint32_t(); // �����л�֧��������ʱ�� ����Ϊuint32_t
			$this->dwPayEnableBeginTime = $bs->popUint32_t(); // �����л�֧������Ч��ʼʱ�� ����Ϊuint32_t
			$this->dwPayEnableEndTime = $bs->popUint32_t(); // �����л�֧������Ч����ʱ�� ����Ϊuint32_t
			$this->dwPayFinishTime = $bs->popUint32_t(); // �����л�֧�����ʱ�� ����Ϊuint32_t
			$this->dwPayReturnTime = $bs->popUint32_t(); // �����л�֧������ʱ�� ����Ϊuint32_t
			$this->dwRecvFeeFinishTime = $bs->popUint32_t(); // �����л�������ʱ�� ����Ϊuint32_t
			$this->dwRecvFeeReturnTime = $bs->popUint32_t(); // �����л�����ʱ�� ����Ϊuint32_t
			$this->dwPayBuyerRecvFee = $bs->popUint32_t(); // �����л��������ܽ�� ����Ϊuint32_t
			$this->dwPaySellerRecvFee = $bs->popUint32_t(); // �����л���������ܽ�� ����Ϊuint32_t
			$this->dwCftDealGenTime = $bs->popUint32_t(); // �����л��Ƹ�ͨ��������ʱ�� ����Ϊuint32_t
			$this->dwPayCashFee = $bs->popUint32_t(); // �����л��ֽ�֧����� ����Ϊuint32_t
			$this->dwPayTicketFee = $bs->popUint32_t(); // �����л��ֽ�ȯ֧����� ����Ϊuint32_t
			$this->dwPayCreditFee = $bs->popUint32_t(); // �����л�����֧����� ����Ϊuint32_t
			$this->dwPayOthersFee = $bs->popUint32_t(); // �����л�����֧����� ����Ϊuint32_t
			$this->dwPayServiceFee = $bs->popUint32_t(); // �����л�֧�������� ����Ϊuint32_t
			$this->dwWhoPayCodFee = $bs->popUint32_t(); // �����л�˭�е�COD�����ѣ�1�����ҳе���2����ң�3��ƽ̨�е� ����Ϊuint32_t
			$this->dwPayCodCftServiceFee = $bs->popUint32_t(); // �����л�COD�Ƹ�֧ͨ�������� ����Ϊuint32_t
			$this->dwPayCodPaipaiServiceFee = $bs->popUint32_t(); // �����л�CODPaipai֧�������� ����Ϊuint32_t
			$this->nPayCodServiceAdjustFee = $bs->popInt32_t(); // �����л�COD�����ѵ��۽�� ����Ϊint
			$this->dwPayCodPaipaiConsignTime = $bs->popUint32_t(); // �����л�CODPaipaiǩ��ʱ�� ����Ϊuint32_t
			$this->dwPayCodWuliuServiceFee = $bs->popUint32_t(); // �����л�COD����֧�������� ����Ϊuint32_t
			$this->dwPayCodWuliuRecvFee = $bs->popUint32_t(); // �����л�COD��������� ����Ϊuint32_t
			$this->dwPayCodSellerRecvFee = $bs->popUint32_t(); // �����л�COD���Ҵ���� ����Ϊuint32_t
			$this->dwPayCodWuliuConsignTime = $bs->popUint32_t(); // �����л�COD����ǩ��ʱ�� ����Ϊuint32_t
			$this->dwPayCodWuliuCollectionMoney = $bs->popUint32_t(); // �����л�COD�������ջ��� ����Ϊuint32_t
			$this->strPayCodWuliuSpid = $bs->popString(); // �����л�COD����SPID ����Ϊstd::string
			$this->strPayInstallmentBank = $bs->popString(); // �����л����ڸ������� ����Ϊstd::string
			$this->wPayInstallmentNum = $bs->popUint16_t(); // �����л����ڸ������� ����Ϊuint16_t
			$this->dwPayInstallmentPayment = $bs->popUint32_t(); // �����л����ڸ���ÿ�ڽ�� ����Ϊuint32_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // �����л�������ʱ�� ����Ϊuint32_t
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cControl_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId64_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBdealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerNickName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerTitle_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemTitleList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayTotalFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayDealTotalFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayShippingFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayAccount_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayProperty_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayChannel_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayBank_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayGenTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayEnableBeginTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayEnableEndTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayFinishTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayReturnTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvFeeFinishTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvFeeReturnTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayBuyerRecvFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPaySellerRecvFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cCftDealGenTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayCashFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayTicketFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayCreditFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayOthersFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayServiceFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cWhoPayCodFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayCodCftServiceFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayCodPaipaiServiceFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayCodServiceAdjustFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayCodPaipaiConsignTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayCodWuliuServiceFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayCodWuliuRecvFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayCodSellerRecvFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayCodWuliuConsignTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayCodWuliuCollectionMoney_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayCodWuliuSpid_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayInstallmentBank_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayInstallmentNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayInstallmentPayment_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$this->strPayBusinessId = $bs->popString(); // �����л�֧��ҵ�񵥺�, ֧��ϵͳ��ҵ�񶩵��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cPayBusinessId_u = $bs->popUint8_t(); // �����л�֧��ҵ�񵥺�, ֧��ϵͳ��ҵ�񶩵��� ����Ϊuint8_t
			}

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


//source idl: com.ecc.deal.idl.DealPo.java

if (!class_exists('DealActionLogPoList')) {
class DealActionLogPoList
{
		/**
		 * �汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ��ˮ�б�
		 *
		 * �汾 >= 0
		 */
		var $vecDealActionLogInfoList; //std::vector<ecc::deal::po::CDealActionLogPo> 

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л��汾�� ����Ϊuint16_t
			$bs->pushObject($this->vecDealActionLogInfoList,'stl_vector'); // ���л���ˮ�б� ����Ϊstd::vector<ecc::deal::po::CDealActionLogPo> 
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealActionLogInfoList_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л��汾�� ����Ϊuint16_t
			$this->vecDealActionLogInfoList = $bs->popObject('stl_vector<DealActionLogPo>'); // �����л���ˮ�б� ����Ϊstd::vector<ecc::deal::po::CDealActionLogPo> 
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealActionLogInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.ecc.deal.idl.DealActionLogPoList.java

if (!class_exists('DealActionLogPo')) {
class DealActionLogPo
{
		/**
		 * �汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ������ˮID
		 *
		 * �汾 >= 0
		 */
		var $dwDealLogId; //uint32_t

		/**
		 * ������ţ���ʽ:�������XXXXYYYY����:101041051509351702
		 *
		 * �汾 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * �������ţ�ͳһƽ̨�ڲ�����
		 *
		 * �汾 >= 0
		 */
		var $ddwDealId64; //uint64_t

		/**
		 * ��Ʒ��ID
		 *
		 * �汾 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * ���ID
		 *
		 * �汾 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * �̼�ID
		 *
		 * �汾 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * �������������
		 *
		 * �汾 >= 0
		 */
		var $wOperatorType; //uint16_t

		/**
		 * ��ˮ����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * ��ˮ��������
		 *
		 * �汾 >= 0
		 */
		var $wOperationType; //uint16_t

		/**
		 * ��ˮ��������
		 *
		 * �汾 >= 0
		 */
		var $strOperationDesc; //std::string

		/**
		 * ����ǰ״̬
		 *
		 * �汾 >= 0
		 */
		var $dwFromState; //uint32_t

		/**
		 * ������״̬
		 *
		 * �汾 >= 0
		 */
		var $dwToState; //uint32_t

		/**
		 * ������ԴIP
		 *
		 * �汾 >= 0
		 */
		var $strOperateIP; //std::string

		/**
		 * ������ע
		 *
		 * �汾 >= 0
		 */
		var $strOperationRemark; //std::string

		/**
		 * MachineKey
		 *
		 * �汾 >= 0
		 */
		var $strMachineKey; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealLogId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId64_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperatorType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperateTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperationType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperationDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cFromState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cToState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperateIP_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperationRemark_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cMachineKey_u; //uint8_t

		/**
		 * ��ˮ����
		 *
		 * �汾 >= 1
		 */
		var $dwLogType; //uint32_t

		/**
		 * 
		 *
		 * �汾 >= 1
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
			$bs->pushUint16_t($this->wVersion); // ���л��汾�� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwDealLogId); // ���л�������ˮID ����Ϊuint32_t
			$bs->pushString($this->strDealId); // ���л�������ţ���ʽ:�������XXXXYYYY����:101041051509351702 ����Ϊstd::string
			$bs->pushUint64_t($this->ddwDealId64); // ���л��������ţ�ͳһƽ̨�ڲ����� ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwTradeId); // ���л���Ʒ��ID ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwBuyerId); // ���л����ID ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwSellerId); // ���л��̼�ID ����Ϊuint64_t
			$bs->pushUint16_t($this->wOperatorType); // ���л�������������� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwOperateTime); // ���л���ˮ����ʱ�� ����Ϊuint32_t
			$bs->pushUint16_t($this->wOperationType); // ���л���ˮ�������� ����Ϊuint16_t
			$bs->pushString($this->strOperationDesc); // ���л���ˮ�������� ����Ϊstd::string
			$bs->pushUint32_t($this->dwFromState); // ���л�����ǰ״̬ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwToState); // ���л�������״̬ ����Ϊuint32_t
			$bs->pushString($this->strOperateIP); // ���л�������ԴIP ����Ϊstd::string
			$bs->pushString($this->strOperationRemark); // ���л�������ע ����Ϊstd::string
			$bs->pushString($this->strMachineKey); // ���л�MachineKey ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealLogId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId64_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperatorType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperationType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperationDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cFromState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cToState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperateIP_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperationRemark_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cMachineKey_u); // ���л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwLogType); // ���л���ˮ���� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cLogType_u); // ���л� ����Ϊuint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л��汾�� ����Ϊuint16_t
			$this->dwDealLogId = $bs->popUint32_t(); // �����л�������ˮID ����Ϊuint32_t
			$this->strDealId = $bs->popString(); // �����л�������ţ���ʽ:�������XXXXYYYY����:101041051509351702 ����Ϊstd::string
			$this->ddwDealId64 = $bs->popUint64_t(); // �����л��������ţ�ͳһƽ̨�ڲ����� ����Ϊuint64_t
			$this->ddwTradeId = $bs->popUint64_t(); // �����л���Ʒ��ID ����Ϊuint64_t
			$this->ddwBuyerId = $bs->popUint64_t(); // �����л����ID ����Ϊuint64_t
			$this->ddwSellerId = $bs->popUint64_t(); // �����л��̼�ID ����Ϊuint64_t
			$this->wOperatorType = $bs->popUint16_t(); // �����л�������������� ����Ϊuint16_t
			$this->dwOperateTime = $bs->popUint32_t(); // �����л���ˮ����ʱ�� ����Ϊuint32_t
			$this->wOperationType = $bs->popUint16_t(); // �����л���ˮ�������� ����Ϊuint16_t
			$this->strOperationDesc = $bs->popString(); // �����л���ˮ�������� ����Ϊstd::string
			$this->dwFromState = $bs->popUint32_t(); // �����л�����ǰ״̬ ����Ϊuint32_t
			$this->dwToState = $bs->popUint32_t(); // �����л�������״̬ ����Ϊuint32_t
			$this->strOperateIP = $bs->popString(); // �����л�������ԴIP ����Ϊstd::string
			$this->strOperationRemark = $bs->popString(); // �����л�������ע ����Ϊstd::string
			$this->strMachineKey = $bs->popString(); // �����л�MachineKey ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealLogId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId64_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperatorType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperationType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperationDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cFromState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cToState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperateIP_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperationRemark_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cMachineKey_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$this->dwLogType = $bs->popUint32_t(); // �����л���ˮ���� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cLogType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}

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


//source idl: com.ecc.deal.idl.DealPo.java

if (!class_exists('TradePoList')) {
class TradePoList
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ��Ʒ���б�
		 *
		 * �汾 >= 0
		 */
		var $vecTradeInfoList; //std::vector<ecc::deal::po::CTradePo> 

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushObject($this->vecTradeInfoList,'stl_vector'); // ���л���Ʒ���б� ����Ϊstd::vector<ecc::deal::po::CTradePo> 
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeInfoList_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->vecTradeInfoList = $bs->popObject('stl_vector<TradePo>'); // �����л���Ʒ���б� ����Ϊstd::vector<ecc::deal::po::CTradePo> 
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.ecc.deal.idl.TradePoList.java

if (!class_exists('TradePo')) {
class TradePo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ������ţ���ʽ:�������XXXXYYYY����:101041051509351702
		 *
		 * �汾 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * �������ţ�ͳһƽ̨�ڲ�����
		 *
		 * �汾 >= 0
		 */
		var $ddwDealId64; //uint64_t

		/**
		 * ���׵��ţ�������һ�ν�����Ϊ����
		 *
		 * �汾 >= 0
		 */
		var $ddwBdealId; //uint64_t

		/**
		 * ��Ʒ������
		 *
		 * �汾 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * ��ID
		 *
		 * �汾 >= 0
		 */
		var $ddwRecvFeeId; //uint64_t

		/**
		 * ���ID
		 *
		 * �汾 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * ����ǳ�
		 *
		 * �汾 >= 0
		 */
		var $strBuyerNickName; //std::string

		/**
		 * �̼�ID
		 *
		 * �汾 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * �̼�����
		 *
		 * �汾 >= 0
		 */
		var $strSellerTitle; //std::string

		/**
		 * ҵ��ID
		 *
		 * �汾 >= 0
		 */
		var $dwBusinessId; //uint32_t

		/**
		 * ��������
		 *
		 * �汾 >= 0
		 */
		var $cTradeType; //uint8_t

		/**
		 * �µ�������1��ҵ����վ��2���ƶ�app��3���ƶ�wap
		 *
		 * �汾 >= 0
		 */
		var $dwTradeSource; //uint32_t

		/**
		 * ֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6���������
		 *
		 * �汾 >= 0
		 */
		var $cTradePayType; //uint8_t

		/**
		 * ���Token������������Ʒ��
		 *
		 * �汾 >= 0
		 */
		var $strToken; //std::string

		/**
		 * ���DrawId������������Ʒ��
		 *
		 * �汾 >= 0
		 */
		var $strDrawId; //std::string

		/**
		 * �˷�ģ��ID
		 *
		 * �汾 >= 0
		 */
		var $strShippingfeeTemplateId; //std::string

		/**
		 * �˷�����
		 *
		 * �汾 >= 0
		 */
		var $strShippingfeeDesc; //std::string

		/**
		 * ��Ʒ�˷�
		 *
		 * �汾 >= 0
		 */
		var $dwItemShippingfee; //uint32_t

		/**
		 * ��Ʒ���ͣ�1����ͨ��Ʒ��2���ײ�����Ʒ��3���ײ͸���Ʒ��4����Ʒ����Ʒ��5����Ʒ����Ʒ; 6:���
		 *
		 * �汾 >= 0
		 */
		var $dwItemType; //uint32_t

		/**
		 * Ʒ�ࣨ��Ŀ��ID
		 *
		 * �汾 >= 0
		 */
		var $dwItemClassId; //uint32_t

		/**
		 * ��Ʒ����
		 *
		 * �汾 >= 0
		 */
		var $strItemTitle; //std::string

		/**
		 * ��Ʒ�������Ա���
		 *
		 * �汾 >= 0
		 */
		var $strItemAttrCode; //std::string

		/**
		 * ��Ʒ������������
		 *
		 * �汾 >= 0
		 */
		var $strItemAttr; //std::string

		/**
		 * ��ƷID����ҵ����
		 *
		 * �汾 >= 0
		 */
		var $strItemId; //std::string

		/**
		 * ��ƷSKUID
		 *
		 * �汾 >= 0
		 */
		var $ddwItemSkuId; //uint64_t

		/**
		 * ��Ʒ�̼ұ��ر���
		 *
		 * �汾 >= 0
		 */
		var $strItemLocalCode; //std::string

		/**
		 * ��Ʒ�̼ұ��ؿ�����
		 *
		 * �汾 >= 0
		 */
		var $strItemLocalStockCode; //std::string

		/**
		 * ��Ʒ������
		 *
		 * �汾 >= 0
		 */
		var $strItemBarCode; //std::string

		/**
		 * ��ƷSPUID
		 *
		 * �汾 >= 0
		 */
		var $ddwItemSpuId; //uint64_t

		/**
		 * ��Ʒ���ID
		 *
		 * �汾 >= 0
		 */
		var $ddwItemStockId; //uint64_t

		/**
		 * ��Ʒ�ֿ�ID
		 *
		 * �汾 >= 0
		 */
		var $dwItemStoreHouseId; //uint32_t

		/**
		 * ��Ʒ���������
		 *
		 * �汾 >= 0
		 */
		var $strItemPhyisicalStorage; //std::string

		/**
		 * ��ƷͼƬLogo
		 *
		 * �汾 >= 0
		 */
		var $strItemLogo; //std::string

		/**
		 * ��Ʒ���հ汾��
		 *
		 * �汾 >= 0
		 */
		var $dwItemSnapVersion; //uint32_t

		/**
		 * ��Ʒ����ʱ���
		 *
		 * �汾 >= 0
		 */
		var $dwItemResetTime; //uint32_t

		/**
		 * ��Ʒ����
		 *
		 * �汾 >= 0
		 */
		var $dwItemWeight; //uint32_t

		/**
		 * ��Ʒ���
		 *
		 * �汾 >= 0
		 */
		var $dwItemVolume; //uint32_t

		/**
		 * ��Ʒ�ײ�����ƷID
		 *
		 * �汾 >= 0
		 */
		var $ddwMainItemId; //uint64_t

		/**
		 * ��Ʒ����˵��
		 *
		 * �汾 >= 0
		 */
		var $strItemAccessoryDesc; //std::string

		/**
		 * ��Ʒ�ɱ���
		 *
		 * �汾 >= 0
		 */
		var $dwItemCostPrice; //uint32_t

		/**
		 * ��Ʒ�г���
		 *
		 * �汾 >= 0
		 */
		var $dwItemOriginPrice; //uint32_t

		/**
		 * ��Ʒ���۵���
		 *
		 * �汾 >= 0
		 */
		var $dwItemSoldPrice; //uint32_t

		/**
		 * ��ӪB2C�г�
		 *
		 * �汾 >= 0
		 */
		var $strItemB2CMarket; //std::string

		/**
		 * ��ӪB2CPM
		 *
		 * �汾 >= 0
		 */
		var $strItemB2CPM; //std::string

		/**
		 * ��ӪB2C�Ƿ�ռ�����
		 *
		 * �汾 >= 0
		 */
		var $cItemUseVirtualStock; //uint8_t

		/**
		 * ��Ʒ�ɽ���
		 *
		 * �汾 >= 0
		 */
		var $dwBuyPrice; //uint32_t

		/**
		 * ��Ʒ�ɽ�����
		 *
		 * �汾 >= 0
		 */
		var $dwBuyNum; //uint32_t

		/**
		 * ��Ʒ���ܽ��,�µ����
		 *
		 * �汾 >= 0
		 */
		var $dwTradeTotalFee; //uint32_t

		/**
		 * ��Ʒ�����۽��
		 *
		 * �汾 >= 0
		 */
		var $nTradeAdjustFee; //int

		/**
		 * ʵ���ܽ��
		 *
		 * �汾 >= 0
		 */
		var $dwTradePayment; //uint32_t

		/**
		 * �Ż��ܽ��
		 *
		 * �汾 >= 0
		 */
		var $nTradeDiscountTotal; //int

		/**
		 * Paipai���ʹ�ý��
		 *
		 * �汾 >= 0
		 */
		var $dwTradePaipaiHongbaoUsed; //uint32_t

		/**
		 * ����֧��ֵ
		 *
		 * �汾 >= 0
		 */
		var $dwPayScore; //uint32_t

		/**
		 * ��Ʒ������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwTradeGenTime; //uint32_t

		/**
		 * ��Ʒ�����������к�
		 *
		 * �汾 >= 0
		 */
		var $wTradeOpSerialNo; //uint16_t

		/**
		 * ��û���ֵ
		 *
		 * �汾 >= 0
		 */
		var $dwObtainScore; //uint32_t

		/**
		 * ��Ʒ��״̬
		 *
		 * �汾 >= 0
		 */
		var $dwTradeState; //uint32_t

		/**
		 * ��Ʒ��ǰһ��״̬
		 *
		 * �汾 >= 0
		 */
		var $dwPreTradeState; //uint32_t

		/**
		 * ��Ʒ������ֵ
		 *
		 * �汾 >= 0
		 */
		var $dwTradeProperty; //uint32_t

		/**
		 * ��Ʒ������ֵ1
		 *
		 * �汾 >= 0
		 */
		var $dwTradeProperty1; //uint32_t

		/**
		 * ��Ʒ������ֵ2
		 *
		 * �汾 >= 0
		 */
		var $dwTradeProperty2; //uint32_t

		/**
		 * ��Ʒ������ֵ3
		 *
		 * �汾 >= 0
		 */
		var $dwTradeProperty3; //uint32_t

		/**
		 * ��Ʒ������ֵ4
		 *
		 * �汾 >= 0
		 */
		var $dwTradeProperty4; //uint32_t

		/**
		 * �˿�״̬, ���˿�Ļ���״̬, 0:���˿�,1:�˿���,2:�˿����
		 *
		 * �汾 >= 0
		 */
		var $dwRefundState; //uint32_t

		/**
		 * �����˿���˿�״̬������ͬ������ʹ��
		 *
		 * �汾 >= 0
		 */
		var $dwRefundDetailState; //uint32_t

		/**
		 * �����˿�״̬, ����DealDo�ϵ�ֵ, ���ӵ��˿�״̬�Ļ���, 0:���˿�,1:�˿���,2:�˿����
		 *
		 * �汾 >= 0
		 */
		var $dwDealRefundState; //uint32_t

		/**
		 * ��������״̬
		 *
		 * �汾 >= 0
		 */
		var $dwEvalState; //uint32_t

		/**
		 * ����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwTradePayTime; //uint32_t

		/**
		 * ���ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwTradeCheckTime; //uint32_t

		/**
		 * ��Ƿ���ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwTradeConsignTime; //uint32_t

		/**
		 * ���ȱ��ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwTradeMarkNoStockTime; //uint32_t

		/**
		 * �ӳ�ȷ���ջ�����
		 *
		 * �汾 >= 0
		 */
		var $dwDelayConfirmDays; //uint32_t

		/**
		 * ǩ��ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwTradeConfirmRecvTime; //uint32_t

		/**
		 * ����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwTradeEndTime; //uint32_t

		/**
		 * ���ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwTradeRecvFeeTime; //uint32_t

		/**
		 * ����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwTradeRecvFeeReturnTime; //uint32_t

		/**
		 * ��Ʒȱ���ܼ���
		 *
		 * �汾 >= 0
		 */
		var $dwStockoutNum; //uint32_t

		/**
		 * �����ܼ���
		 *
		 * �汾 >= 0
		 */
		var $dwRefuseNum; //uint32_t

		/**
		 * ʵ�ʳɽ�����
		 *
		 * �汾 >= 0
		 */
		var $dwDoneNum; //uint32_t

		/**
		 * �����ر�ԭ������
		 *
		 * �汾 >= 0
		 */
		var $cCloseReasonType; //uint8_t

		/**
		 * �����ر�ԭ������
		 *
		 * �汾 >= 0
		 */
		var $strCloseReasonDesc; //std::string

		/**
		 * ���ҵ����ܽ��
		 *
		 * �汾 >= 0
		 */
		var $dwSellerTotalRecvFee; //uint32_t

		/**
		 * ��ҵ����ܽ��
		 *
		 * �汾 >= 0
		 */
		var $dwBuyerTotalRecvFee; //uint32_t

		/**
		 * ��Ʒ��ʱ��ʶ
		 *
		 * �汾 >= 0
		 */
		var $dwItemTimeoutFlag; //uint32_t

		/**
		 * ������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * ��Ʒ��б�
		 *
		 * �汾 >= 0
		 */
		var $oActiveInfoList; //ecc::deal::po::CTradeActivePoList

		/**
		 * ������չ��Ϣ 
		 *
		 * �汾 >= 0
		 */
		var $mmapDealExtInfoMap; //std::multimap<uint32_t,std::string> 

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId64_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBdealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvFeeId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerNickName_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerTitle_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBusinessId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeSource_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradePayType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cToken_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDrawId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cShippingfeeTemplateId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cShippingfeeDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemShippingfee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemClassId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemTitle_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemAttrCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemAttr_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemSkuId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemLocalCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemLocalStockCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemBarCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemSpuId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemStockId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemStoreHouseId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemPhyisicalStorage_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemLogo_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemSnapVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemResetTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemWeight_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemVolume_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cMainItemId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemAccessoryDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemCostPrice_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemOriginPrice_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemSoldPrice_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemB2CMarket_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemB2CPM_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemUseVirtualStock_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyPrice_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyNum_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeTotalFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeAdjustFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradePayment_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeDiscountTotal_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradePaipaiHongbaoUsed_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayScore_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeGenTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeOpSerialNo_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cObtainScore_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPreTradeState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeProperty_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeProperty1_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeProperty2_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeProperty3_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeProperty4_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundDetailState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealRefundState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cEvalState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradePayTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeCheckTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeConsignTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeMarkNoStockTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDelayConfirmDays_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeConfirmRecvTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeEndTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeRecvFeeTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeRecvFeeReturnTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cStockoutNum_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefuseNum_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDoneNum_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cCloseReasonType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cCloseReasonDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerTotalRecvFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerTotalRecvFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemTimeoutFlag_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cActiveInfoList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealExtInfoMap_u; //uint8_t

		/**
		 * ��Ƿ���ʱ��
		 *
		 * �汾 >= 1
		 */
		var $dwTradeSellerSendTime; //uint32_t

		/**
		 * ��������
		 *
		 * �汾 >= 1
		 */
		var $strWarranty; //std::string

		/**
		 * ��Ʒid
		 *
		 * �汾 >= 1
		 */
		var $ddwProductId; //uint64_t

		/**
		 * ��Ʒid����
		 *
		 * �汾 >= 1
		 */
		var $strProductCode; //std::string

		/**
		 * ��Ѹedm����
		 *
		 * �汾 >= 1
		 */
		var $strIcsonEdmCode; //std::string

		/**
		 * ��ѸOTag
		 *
		 * �汾 >= 1
		 */
		var $strIcsonOTag; //std::string

		/**
		 * ��Ѹ���̵�������
		 *
		 * �汾 >= 1
		 */
		var $strIcsonTradeShopGuideCost; //std::string

		/**
		 * ��Ѹ���ƻ�����
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneType; //std::string

		/**
		 * ��Ѹ���ƻ���Ӫ��
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneOperator; //std::string

		/**
		 * ��Ѹ���ƻ�����
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneNumber; //std::string

		/**
		 * ��Ѹ���ƻ�������
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneArea; //std::string

		/**
		 * ��Ѹ���ƻ��ײ�id
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhonePackageId; //std::string

		/**
		 * ��Ѹ���ƻ��û�����
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneUserName; //std::string

		/**
		 * ��Ѹ���ƻ��û���ַ
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneUserAddr; //std::string

		/**
		 * ��Ѹ���ƻ��û���ϵ�ֻ�
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneUserMobile; //std::string

		/**
		 * ��Ѹ���ƻ��û���ϵ�绰
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneUserTel; //std::string

		/**
		 * ��Ѹ���ƻ����֤����
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneIdCardNo; //std::string

		/**
		 * ��Ѹ���ƻ����֤��ַ
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneIdCardAddr; //std::string

		/**
		 * ��Ѹ���ƻ����֤��Ч��
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneIdCardDate; //std::string

		/**
		 * ��Ѹ���ƻ���������
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneZipCode; //std::string

		/**
		 * ��Ѹ���ƻ����۸�
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneCardPrice; //std::string

		/**
		 * ��Ѹ���ƻ��ײͼ۸�
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhonePackagePrice; //std::string

		/**
		 * ��Ѹ��Ʒ�ӵ�flag
		 *
		 * �汾 >= 1
		 */
		var $strIcsonTradeFlag; //std::string

		/**
		 * ��Ѹ���ֶһ�����
		 *
		 * �汾 >= 1
		 */
		var $strIcsonPointType; //std::string

		/**
		 * ��Ѹ��Ʒ�ӵ��ײ�id
		 *
		 * �汾 >= 1
		 */
		var $strIcsonPackageIds; //std::string

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cTradeSellerSendTime_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cWarranty_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cProductId_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cProductCode_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonEdmCode_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonOTag_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonTradeShopGuideCost_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneType_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneOperator_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneNumber_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneArea_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhonePackageId_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneUserName_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneUserAddr_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneUserMobile_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneUserTel_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneIdCardNo_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneIdCardAddr_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneIdCardDate_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneZipCode_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneCardPrice_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhonePackagePrice_u; //uint8_t

		/**
		 * ��Ѹ��Ʒ�ӵ�flag
		 *
		 * �汾 >= 1
		 */
		var $cIcsonTradeFlag_u; //uint8_t

		/**
		 * ��Ѹ���ֶһ�����
		 *
		 * �汾 >= 1
		 */
		var $cIcsonPointType_u; //uint8_t

		/**
		 * ��Ѹ��Ʒ�ӵ��ײ�id
		 *
		 * �汾 >= 1
		 */
		var $cIcsonPackageIds_u; //uint8_t

		/**
		 * �ӵ����ֽ��
		 *
		 * �汾 >= 2
		 */
		var $dwIcsonTradeCashBack; //uint32_t

		/**
		 * �ӵ����ֽ��UFlag
		 *
		 * �汾 >= 2
		 */
		var $cIcsonTradeCashBack_u; //uint8_t

		/**
		 * ȥ˰��ɱ�
		 *
		 * �汾 >= 3
		 */
		var $strIcsonUnitCostInvoice; //std::string

		/**
		 * ȥ˰��ɱ�UFlag
		 *
		 * �汾 >= 3
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushString($this->strDealId); // ���л�������ţ���ʽ:�������XXXXYYYY����:101041051509351702 ����Ϊstd::string
			$bs->pushUint64_t($this->ddwDealId64); // ���л��������ţ�ͳһƽ̨�ڲ����� ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwBdealId); // ���л����׵��ţ�������һ�ν�����Ϊ���� ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwTradeId); // ���л���Ʒ������ ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwRecvFeeId); // ���л���ID ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwBuyerId); // ���л����ID ����Ϊuint64_t
			$bs->pushString($this->strBuyerNickName); // ���л�����ǳ� ����Ϊstd::string
			$bs->pushUint64_t($this->ddwSellerId); // ���л��̼�ID ����Ϊuint64_t
			$bs->pushString($this->strSellerTitle); // ���л��̼����� ����Ϊstd::string
			$bs->pushUint32_t($this->dwBusinessId); // ���л�ҵ��ID ����Ϊuint32_t
			$bs->pushUint8_t($this->cTradeType); // ���л��������� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwTradeSource); // ���л��µ�������1��ҵ����վ��2���ƶ�app��3���ƶ�wap ����Ϊuint32_t
			$bs->pushUint8_t($this->cTradePayType); // ���л�֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6��������� ����Ϊuint8_t
			$bs->pushString($this->strToken); // ���л����Token������������Ʒ�� ����Ϊstd::string
			$bs->pushString($this->strDrawId); // ���л����DrawId������������Ʒ�� ����Ϊstd::string
			$bs->pushString($this->strShippingfeeTemplateId); // ���л��˷�ģ��ID ����Ϊstd::string
			$bs->pushString($this->strShippingfeeDesc); // ���л��˷����� ����Ϊstd::string
			$bs->pushUint32_t($this->dwItemShippingfee); // ���л���Ʒ�˷� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwItemType); // ���л���Ʒ���ͣ�1����ͨ��Ʒ��2���ײ�����Ʒ��3���ײ͸���Ʒ��4����Ʒ����Ʒ��5����Ʒ����Ʒ; 6:��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwItemClassId); // ���л�Ʒ�ࣨ��Ŀ��ID ����Ϊuint32_t
			$bs->pushString($this->strItemTitle); // ���л���Ʒ���� ����Ϊstd::string
			$bs->pushString($this->strItemAttrCode); // ���л���Ʒ�������Ա��� ����Ϊstd::string
			$bs->pushString($this->strItemAttr); // ���л���Ʒ������������ ����Ϊstd::string
			$bs->pushString($this->strItemId); // ���л���ƷID����ҵ���� ����Ϊstd::string
			$bs->pushUint64_t($this->ddwItemSkuId); // ���л���ƷSKUID ����Ϊuint64_t
			$bs->pushString($this->strItemLocalCode); // ���л���Ʒ�̼ұ��ر��� ����Ϊstd::string
			$bs->pushString($this->strItemLocalStockCode); // ���л���Ʒ�̼ұ��ؿ����� ����Ϊstd::string
			$bs->pushString($this->strItemBarCode); // ���л���Ʒ������ ����Ϊstd::string
			$bs->pushUint64_t($this->ddwItemSpuId); // ���л���ƷSPUID ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwItemStockId); // ���л���Ʒ���ID ����Ϊuint64_t
			$bs->pushUint32_t($this->dwItemStoreHouseId); // ���л���Ʒ�ֿ�ID ����Ϊuint32_t
			$bs->pushString($this->strItemPhyisicalStorage); // ���л���Ʒ��������� ����Ϊstd::string
			$bs->pushString($this->strItemLogo); // ���л���ƷͼƬLogo ����Ϊstd::string
			$bs->pushUint32_t($this->dwItemSnapVersion); // ���л���Ʒ���հ汾�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwItemResetTime); // ���л���Ʒ����ʱ��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwItemWeight); // ���л���Ʒ���� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwItemVolume); // ���л���Ʒ��� ����Ϊuint32_t
			$bs->pushUint64_t($this->ddwMainItemId); // ���л���Ʒ�ײ�����ƷID ����Ϊuint64_t
			$bs->pushString($this->strItemAccessoryDesc); // ���л���Ʒ����˵�� ����Ϊstd::string
			$bs->pushUint32_t($this->dwItemCostPrice); // ���л���Ʒ�ɱ��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwItemOriginPrice); // ���л���Ʒ�г��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwItemSoldPrice); // ���л���Ʒ���۵��� ����Ϊuint32_t
			$bs->pushString($this->strItemB2CMarket); // ���л���ӪB2C�г� ����Ϊstd::string
			$bs->pushString($this->strItemB2CPM); // ���л���ӪB2CPM ����Ϊstd::string
			$bs->pushUint8_t($this->cItemUseVirtualStock); // ���л���ӪB2C�Ƿ�ռ����� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwBuyPrice); // ���л���Ʒ�ɽ��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwBuyNum); // ���л���Ʒ�ɽ����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeTotalFee); // ���л���Ʒ���ܽ��,�µ���� ����Ϊuint32_t
			$bs->pushInt32_t($this->nTradeAdjustFee); // ���л���Ʒ�����۽�� ����Ϊint
			$bs->pushUint32_t($this->dwTradePayment); // ���л�ʵ���ܽ�� ����Ϊuint32_t
			$bs->pushInt32_t($this->nTradeDiscountTotal); // ���л��Ż��ܽ�� ����Ϊint
			$bs->pushUint32_t($this->dwTradePaipaiHongbaoUsed); // ���л�Paipai���ʹ�ý�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayScore); // ���л�����֧��ֵ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeGenTime); // ���л���Ʒ������ʱ�� ����Ϊuint32_t
			$bs->pushUint16_t($this->wTradeOpSerialNo); // ���л���Ʒ�����������к� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwObtainScore); // ���л���û���ֵ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeState); // ���л���Ʒ��״̬ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPreTradeState); // ���л���Ʒ��ǰһ��״̬ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeProperty); // ���л���Ʒ������ֵ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeProperty1); // ���л���Ʒ������ֵ1 ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeProperty2); // ���л���Ʒ������ֵ2 ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeProperty3); // ���л���Ʒ������ֵ3 ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeProperty4); // ���л���Ʒ������ֵ4 ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRefundState); // ���л��˿�״̬, ���˿�Ļ���״̬, 0:���˿�,1:�˿���,2:�˿���� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRefundDetailState); // ���л������˿���˿�״̬������ͬ������ʹ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealRefundState); // ���л������˿�״̬, ����DealDo�ϵ�ֵ, ���ӵ��˿�״̬�Ļ���, 0:���˿�,1:�˿���,2:�˿���� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwEvalState); // ���л���������״̬ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradePayTime); // ���л�����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeCheckTime); // ���л����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeConsignTime); // ���л���Ƿ���ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeMarkNoStockTime); // ���л����ȱ��ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDelayConfirmDays); // ���л��ӳ�ȷ���ջ����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeConfirmRecvTime); // ���л�ǩ��ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeEndTime); // ���л�����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeRecvFeeTime); // ���л����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeRecvFeeReturnTime); // ���л�����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwStockoutNum); // ���л���Ʒȱ���ܼ��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRefuseNum); // ���л������ܼ��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDoneNum); // ���л�ʵ�ʳɽ����� ����Ϊuint32_t
			$bs->pushUint8_t($this->cCloseReasonType); // ���л������ر�ԭ������ ����Ϊuint8_t
			$bs->pushString($this->strCloseReasonDesc); // ���л������ر�ԭ������ ����Ϊstd::string
			$bs->pushUint32_t($this->dwSellerTotalRecvFee); // ���л����ҵ����ܽ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwBuyerTotalRecvFee); // ���л���ҵ����ܽ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwItemTimeoutFlag); // ���л���Ʒ��ʱ��ʶ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // ���л�������ʱ�� ����Ϊuint32_t
			$bs->pushObject($this->oActiveInfoList,'TradeActivePoList'); // ���л���Ʒ��б� ����Ϊecc::deal::po::CTradeActivePoList
			$bs->pushObject($this->mmapDealExtInfoMap,'stl_multimap'); // ���л�������չ��Ϣ  ����Ϊstd::multimap<uint32_t,std::string> 
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId64_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBdealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvFeeId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerNickName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerTitle_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBusinessId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeSource_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradePayType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cToken_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDrawId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cShippingfeeTemplateId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cShippingfeeDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemShippingfee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemClassId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemTitle_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemAttrCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemAttr_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemSkuId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemLocalCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemLocalStockCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemBarCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemSpuId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemStockId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemStoreHouseId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemPhyisicalStorage_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemLogo_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemSnapVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemResetTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemWeight_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemVolume_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cMainItemId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemAccessoryDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemCostPrice_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemOriginPrice_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemSoldPrice_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemB2CMarket_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemB2CPM_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemUseVirtualStock_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyPrice_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyNum_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeTotalFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeAdjustFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradePayment_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeDiscountTotal_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradePaipaiHongbaoUsed_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayScore_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeGenTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeOpSerialNo_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cObtainScore_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPreTradeState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeProperty_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeProperty1_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeProperty2_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeProperty3_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeProperty4_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundDetailState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealRefundState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cEvalState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradePayTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeCheckTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeConsignTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeMarkNoStockTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDelayConfirmDays_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeConfirmRecvTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeEndTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeRecvFeeTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeRecvFeeReturnTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cStockoutNum_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefuseNum_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDoneNum_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cCloseReasonType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cCloseReasonDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerTotalRecvFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerTotalRecvFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemTimeoutFlag_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cActiveInfoList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealExtInfoMap_u); // ���л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwTradeSellerSendTime); // ���л���Ƿ���ʱ�� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strWarranty); // ���л��������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint64_t($this->ddwProductId); // ���л���Ʒid ����Ϊuint64_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strProductCode); // ���л���Ʒid���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonEdmCode); // ���л���Ѹedm���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonOTag); // ���л���ѸOTag ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonTradeShopGuideCost); // ���л���Ѹ���̵������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneType); // ���л���Ѹ���ƻ����� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneOperator); // ���л���Ѹ���ƻ���Ӫ�� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneNumber); // ���л���Ѹ���ƻ����� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneArea); // ���л���Ѹ���ƻ������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhonePackageId); // ���л���Ѹ���ƻ��ײ�id ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneUserName); // ���л���Ѹ���ƻ��û����� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneUserAddr); // ���л���Ѹ���ƻ��û���ַ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneUserMobile); // ���л���Ѹ���ƻ��û���ϵ�ֻ� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneUserTel); // ���л���Ѹ���ƻ��û���ϵ�绰 ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneIdCardNo); // ���л���Ѹ���ƻ����֤���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneIdCardAddr); // ���л���Ѹ���ƻ����֤��ַ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneIdCardDate); // ���л���Ѹ���ƻ����֤��Ч�� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneZipCode); // ���л���Ѹ���ƻ��������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneCardPrice); // ���л���Ѹ���ƻ����۸� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhonePackagePrice); // ���л���Ѹ���ƻ��ײͼ۸� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonTradeFlag); // ���л���Ѹ��Ʒ�ӵ�flag ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonPointType); // ���л���Ѹ���ֶһ����� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonPackageIds); // ���л���Ѹ��Ʒ�ӵ��ײ�id ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cTradeSellerSendTime_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cWarranty_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cProductId_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cProductCode_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonEdmCode_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonOTag_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonTradeShopGuideCost_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneType_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneOperator_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneNumber_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneArea_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhonePackageId_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneUserName_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneUserAddr_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneUserMobile_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneUserTel_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneIdCardNo_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneIdCardAddr_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneIdCardDate_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneZipCode_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneCardPrice_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhonePackagePrice_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonTradeFlag_u); // ���л���Ѹ��Ʒ�ӵ�flag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonPointType_u); // ���л���Ѹ���ֶһ����� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonPackageIds_u); // ���л���Ѹ��Ʒ�ӵ��ײ�id ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwIcsonTradeCashBack); // ���л��ӵ����ֽ�� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cIcsonTradeCashBack_u); // ���л��ӵ����ֽ��UFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 3 ){
				$bs->pushString($this->strIcsonUnitCostInvoice); // ���л�ȥ˰��ɱ� ����Ϊstd::string
			}
			if(  $this->wVersion >= 3 ){
				$bs->pushUint8_t($this->cIcsonUnitCostInvoice_u); // ���л�ȥ˰��ɱ�UFlag ����Ϊuint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->strDealId = $bs->popString(); // �����л�������ţ���ʽ:�������XXXXYYYY����:101041051509351702 ����Ϊstd::string
			$this->ddwDealId64 = $bs->popUint64_t(); // �����л��������ţ�ͳһƽ̨�ڲ����� ����Ϊuint64_t
			$this->ddwBdealId = $bs->popUint64_t(); // �����л����׵��ţ�������һ�ν�����Ϊ���� ����Ϊuint64_t
			$this->ddwTradeId = $bs->popUint64_t(); // �����л���Ʒ������ ����Ϊuint64_t
			$this->ddwRecvFeeId = $bs->popUint64_t(); // �����л���ID ����Ϊuint64_t
			$this->ddwBuyerId = $bs->popUint64_t(); // �����л����ID ����Ϊuint64_t
			$this->strBuyerNickName = $bs->popString(); // �����л�����ǳ� ����Ϊstd::string
			$this->ddwSellerId = $bs->popUint64_t(); // �����л��̼�ID ����Ϊuint64_t
			$this->strSellerTitle = $bs->popString(); // �����л��̼����� ����Ϊstd::string
			$this->dwBusinessId = $bs->popUint32_t(); // �����л�ҵ��ID ����Ϊuint32_t
			$this->cTradeType = $bs->popUint8_t(); // �����л��������� ����Ϊuint8_t
			$this->dwTradeSource = $bs->popUint32_t(); // �����л��µ�������1��ҵ����վ��2���ƶ�app��3���ƶ�wap ����Ϊuint32_t
			$this->cTradePayType = $bs->popUint8_t(); // �����л�֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6��������� ����Ϊuint8_t
			$this->strToken = $bs->popString(); // �����л����Token������������Ʒ�� ����Ϊstd::string
			$this->strDrawId = $bs->popString(); // �����л����DrawId������������Ʒ�� ����Ϊstd::string
			$this->strShippingfeeTemplateId = $bs->popString(); // �����л��˷�ģ��ID ����Ϊstd::string
			$this->strShippingfeeDesc = $bs->popString(); // �����л��˷����� ����Ϊstd::string
			$this->dwItemShippingfee = $bs->popUint32_t(); // �����л���Ʒ�˷� ����Ϊuint32_t
			$this->dwItemType = $bs->popUint32_t(); // �����л���Ʒ���ͣ�1����ͨ��Ʒ��2���ײ�����Ʒ��3���ײ͸���Ʒ��4����Ʒ����Ʒ��5����Ʒ����Ʒ; 6:��� ����Ϊuint32_t
			$this->dwItemClassId = $bs->popUint32_t(); // �����л�Ʒ�ࣨ��Ŀ��ID ����Ϊuint32_t
			$this->strItemTitle = $bs->popString(); // �����л���Ʒ���� ����Ϊstd::string
			$this->strItemAttrCode = $bs->popString(); // �����л���Ʒ�������Ա��� ����Ϊstd::string
			$this->strItemAttr = $bs->popString(); // �����л���Ʒ������������ ����Ϊstd::string
			$this->strItemId = $bs->popString(); // �����л���ƷID����ҵ���� ����Ϊstd::string
			$this->ddwItemSkuId = $bs->popUint64_t(); // �����л���ƷSKUID ����Ϊuint64_t
			$this->strItemLocalCode = $bs->popString(); // �����л���Ʒ�̼ұ��ر��� ����Ϊstd::string
			$this->strItemLocalStockCode = $bs->popString(); // �����л���Ʒ�̼ұ��ؿ����� ����Ϊstd::string
			$this->strItemBarCode = $bs->popString(); // �����л���Ʒ������ ����Ϊstd::string
			$this->ddwItemSpuId = $bs->popUint64_t(); // �����л���ƷSPUID ����Ϊuint64_t
			$this->ddwItemStockId = $bs->popUint64_t(); // �����л���Ʒ���ID ����Ϊuint64_t
			$this->dwItemStoreHouseId = $bs->popUint32_t(); // �����л���Ʒ�ֿ�ID ����Ϊuint32_t
			$this->strItemPhyisicalStorage = $bs->popString(); // �����л���Ʒ��������� ����Ϊstd::string
			$this->strItemLogo = $bs->popString(); // �����л���ƷͼƬLogo ����Ϊstd::string
			$this->dwItemSnapVersion = $bs->popUint32_t(); // �����л���Ʒ���հ汾�� ����Ϊuint32_t
			$this->dwItemResetTime = $bs->popUint32_t(); // �����л���Ʒ����ʱ��� ����Ϊuint32_t
			$this->dwItemWeight = $bs->popUint32_t(); // �����л���Ʒ���� ����Ϊuint32_t
			$this->dwItemVolume = $bs->popUint32_t(); // �����л���Ʒ��� ����Ϊuint32_t
			$this->ddwMainItemId = $bs->popUint64_t(); // �����л���Ʒ�ײ�����ƷID ����Ϊuint64_t
			$this->strItemAccessoryDesc = $bs->popString(); // �����л���Ʒ����˵�� ����Ϊstd::string
			$this->dwItemCostPrice = $bs->popUint32_t(); // �����л���Ʒ�ɱ��� ����Ϊuint32_t
			$this->dwItemOriginPrice = $bs->popUint32_t(); // �����л���Ʒ�г��� ����Ϊuint32_t
			$this->dwItemSoldPrice = $bs->popUint32_t(); // �����л���Ʒ���۵��� ����Ϊuint32_t
			$this->strItemB2CMarket = $bs->popString(); // �����л���ӪB2C�г� ����Ϊstd::string
			$this->strItemB2CPM = $bs->popString(); // �����л���ӪB2CPM ����Ϊstd::string
			$this->cItemUseVirtualStock = $bs->popUint8_t(); // �����л���ӪB2C�Ƿ�ռ����� ����Ϊuint8_t
			$this->dwBuyPrice = $bs->popUint32_t(); // �����л���Ʒ�ɽ��� ����Ϊuint32_t
			$this->dwBuyNum = $bs->popUint32_t(); // �����л���Ʒ�ɽ����� ����Ϊuint32_t
			$this->dwTradeTotalFee = $bs->popUint32_t(); // �����л���Ʒ���ܽ��,�µ���� ����Ϊuint32_t
			$this->nTradeAdjustFee = $bs->popInt32_t(); // �����л���Ʒ�����۽�� ����Ϊint
			$this->dwTradePayment = $bs->popUint32_t(); // �����л�ʵ���ܽ�� ����Ϊuint32_t
			$this->nTradeDiscountTotal = $bs->popInt32_t(); // �����л��Ż��ܽ�� ����Ϊint
			$this->dwTradePaipaiHongbaoUsed = $bs->popUint32_t(); // �����л�Paipai���ʹ�ý�� ����Ϊuint32_t
			$this->dwPayScore = $bs->popUint32_t(); // �����л�����֧��ֵ ����Ϊuint32_t
			$this->dwTradeGenTime = $bs->popUint32_t(); // �����л���Ʒ������ʱ�� ����Ϊuint32_t
			$this->wTradeOpSerialNo = $bs->popUint16_t(); // �����л���Ʒ�����������к� ����Ϊuint16_t
			$this->dwObtainScore = $bs->popUint32_t(); // �����л���û���ֵ ����Ϊuint32_t
			$this->dwTradeState = $bs->popUint32_t(); // �����л���Ʒ��״̬ ����Ϊuint32_t
			$this->dwPreTradeState = $bs->popUint32_t(); // �����л���Ʒ��ǰһ��״̬ ����Ϊuint32_t
			$this->dwTradeProperty = $bs->popUint32_t(); // �����л���Ʒ������ֵ ����Ϊuint32_t
			$this->dwTradeProperty1 = $bs->popUint32_t(); // �����л���Ʒ������ֵ1 ����Ϊuint32_t
			$this->dwTradeProperty2 = $bs->popUint32_t(); // �����л���Ʒ������ֵ2 ����Ϊuint32_t
			$this->dwTradeProperty3 = $bs->popUint32_t(); // �����л���Ʒ������ֵ3 ����Ϊuint32_t
			$this->dwTradeProperty4 = $bs->popUint32_t(); // �����л���Ʒ������ֵ4 ����Ϊuint32_t
			$this->dwRefundState = $bs->popUint32_t(); // �����л��˿�״̬, ���˿�Ļ���״̬, 0:���˿�,1:�˿���,2:�˿���� ����Ϊuint32_t
			$this->dwRefundDetailState = $bs->popUint32_t(); // �����л������˿���˿�״̬������ͬ������ʹ�� ����Ϊuint32_t
			$this->dwDealRefundState = $bs->popUint32_t(); // �����л������˿�״̬, ����DealDo�ϵ�ֵ, ���ӵ��˿�״̬�Ļ���, 0:���˿�,1:�˿���,2:�˿���� ����Ϊuint32_t
			$this->dwEvalState = $bs->popUint32_t(); // �����л���������״̬ ����Ϊuint32_t
			$this->dwTradePayTime = $bs->popUint32_t(); // �����л�����ʱ�� ����Ϊuint32_t
			$this->dwTradeCheckTime = $bs->popUint32_t(); // �����л����ʱ�� ����Ϊuint32_t
			$this->dwTradeConsignTime = $bs->popUint32_t(); // �����л���Ƿ���ʱ�� ����Ϊuint32_t
			$this->dwTradeMarkNoStockTime = $bs->popUint32_t(); // �����л����ȱ��ʱ�� ����Ϊuint32_t
			$this->dwDelayConfirmDays = $bs->popUint32_t(); // �����л��ӳ�ȷ���ջ����� ����Ϊuint32_t
			$this->dwTradeConfirmRecvTime = $bs->popUint32_t(); // �����л�ǩ��ʱ�� ����Ϊuint32_t
			$this->dwTradeEndTime = $bs->popUint32_t(); // �����л�����ʱ�� ����Ϊuint32_t
			$this->dwTradeRecvFeeTime = $bs->popUint32_t(); // �����л����ʱ�� ����Ϊuint32_t
			$this->dwTradeRecvFeeReturnTime = $bs->popUint32_t(); // �����л�����ʱ�� ����Ϊuint32_t
			$this->dwStockoutNum = $bs->popUint32_t(); // �����л���Ʒȱ���ܼ��� ����Ϊuint32_t
			$this->dwRefuseNum = $bs->popUint32_t(); // �����л������ܼ��� ����Ϊuint32_t
			$this->dwDoneNum = $bs->popUint32_t(); // �����л�ʵ�ʳɽ����� ����Ϊuint32_t
			$this->cCloseReasonType = $bs->popUint8_t(); // �����л������ر�ԭ������ ����Ϊuint8_t
			$this->strCloseReasonDesc = $bs->popString(); // �����л������ر�ԭ������ ����Ϊstd::string
			$this->dwSellerTotalRecvFee = $bs->popUint32_t(); // �����л����ҵ����ܽ�� ����Ϊuint32_t
			$this->dwBuyerTotalRecvFee = $bs->popUint32_t(); // �����л���ҵ����ܽ�� ����Ϊuint32_t
			$this->dwItemTimeoutFlag = $bs->popUint32_t(); // �����л���Ʒ��ʱ��ʶ ����Ϊuint32_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // �����л�������ʱ�� ����Ϊuint32_t
			$this->oActiveInfoList = $bs->popObject('TradeActivePoList'); // �����л���Ʒ��б� ����Ϊecc::deal::po::CTradeActivePoList
			$this->mmapDealExtInfoMap = $bs->popObject('stl_multimap<uint32_t,stl_string>'); // �����л�������չ��Ϣ  ����Ϊstd::multimap<uint32_t,std::string> 
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId64_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBdealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvFeeId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerNickName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerTitle_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBusinessId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeSource_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradePayType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cToken_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDrawId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cShippingfeeTemplateId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cShippingfeeDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemShippingfee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemClassId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemTitle_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemAttrCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemAttr_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemSkuId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemLocalCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemLocalStockCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemBarCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemSpuId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemStockId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemStoreHouseId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemPhyisicalStorage_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemLogo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemSnapVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemResetTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemWeight_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemVolume_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cMainItemId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemAccessoryDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemCostPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemOriginPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemSoldPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemB2CMarket_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemB2CPM_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemUseVirtualStock_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeTotalFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeAdjustFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradePayment_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeDiscountTotal_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradePaipaiHongbaoUsed_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayScore_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeGenTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeOpSerialNo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cObtainScore_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPreTradeState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeProperty_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeProperty1_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeProperty2_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeProperty3_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeProperty4_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundDetailState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealRefundState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cEvalState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradePayTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeCheckTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeConsignTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeMarkNoStockTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDelayConfirmDays_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeConfirmRecvTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeEndTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeRecvFeeTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeRecvFeeReturnTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cStockoutNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefuseNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDoneNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cCloseReasonType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cCloseReasonDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerTotalRecvFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerTotalRecvFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemTimeoutFlag_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cActiveInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealExtInfoMap_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$this->dwTradeSellerSendTime = $bs->popUint32_t(); // �����л���Ƿ���ʱ�� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->strWarranty = $bs->popString(); // �����л��������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->ddwProductId = $bs->popUint64_t(); // �����л���Ʒid ����Ϊuint64_t
			}
			if(  $this->wVersion >= 1 ){
				$this->strProductCode = $bs->popString(); // �����л���Ʒid���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonEdmCode = $bs->popString(); // �����л���Ѹedm���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonOTag = $bs->popString(); // �����л���ѸOTag ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonTradeShopGuideCost = $bs->popString(); // �����л���Ѹ���̵������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneType = $bs->popString(); // �����л���Ѹ���ƻ����� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneOperator = $bs->popString(); // �����л���Ѹ���ƻ���Ӫ�� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneNumber = $bs->popString(); // �����л���Ѹ���ƻ����� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneArea = $bs->popString(); // �����л���Ѹ���ƻ������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhonePackageId = $bs->popString(); // �����л���Ѹ���ƻ��ײ�id ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneUserName = $bs->popString(); // �����л���Ѹ���ƻ��û����� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneUserAddr = $bs->popString(); // �����л���Ѹ���ƻ��û���ַ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneUserMobile = $bs->popString(); // �����л���Ѹ���ƻ��û���ϵ�ֻ� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneUserTel = $bs->popString(); // �����л���Ѹ���ƻ��û���ϵ�绰 ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneIdCardNo = $bs->popString(); // �����л���Ѹ���ƻ����֤���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneIdCardAddr = $bs->popString(); // �����л���Ѹ���ƻ����֤��ַ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneIdCardDate = $bs->popString(); // �����л���Ѹ���ƻ����֤��Ч�� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneZipCode = $bs->popString(); // �����л���Ѹ���ƻ��������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneCardPrice = $bs->popString(); // �����л���Ѹ���ƻ����۸� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhonePackagePrice = $bs->popString(); // �����л���Ѹ���ƻ��ײͼ۸� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonTradeFlag = $bs->popString(); // �����л���Ѹ��Ʒ�ӵ�flag ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonPointType = $bs->popString(); // �����л���Ѹ���ֶһ����� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonPackageIds = $bs->popString(); // �����л���Ѹ��Ʒ�ӵ��ײ�id ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cTradeSellerSendTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cWarranty_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cProductId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cProductCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonEdmCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonOTag_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonTradeShopGuideCost_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneOperator_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneNumber_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneArea_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhonePackageId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneUserName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneUserAddr_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneUserMobile_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneUserTel_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneIdCardNo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneIdCardAddr_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneIdCardDate_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneZipCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneCardPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhonePackagePrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonTradeFlag_u = $bs->popUint8_t(); // �����л���Ѹ��Ʒ�ӵ�flag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonPointType_u = $bs->popUint8_t(); // �����л���Ѹ���ֶһ����� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonPackageIds_u = $bs->popUint8_t(); // �����л���Ѹ��Ʒ�ӵ��ײ�id ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwIcsonTradeCashBack = $bs->popUint32_t(); // �����л��ӵ����ֽ�� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cIcsonTradeCashBack_u = $bs->popUint8_t(); // �����л��ӵ����ֽ��UFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 3 ){
				$this->strIcsonUnitCostInvoice = $bs->popString(); // �����л�ȥ˰��ɱ� ����Ϊstd::string
			}
			if(  $this->wVersion >= 3 ){
				$this->cIcsonUnitCostInvoice_u = $bs->popUint8_t(); // �����л�ȥ˰��ɱ�UFlag ����Ϊuint8_t
			}

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


//source idl: com.ecc.deal.idl.TradePo.java

if (!class_exists('TradeActivePoList')) {
class TradeActivePoList
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ��Ʒ����б�
		 *
		 * �汾 >= 0
		 */
		var $vecTradeActiveInfoList; //std::vector<ecc::deal::po::CTradeActivePo> 

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushObject($this->vecTradeActiveInfoList,'stl_vector'); // ���л���Ʒ����б� ����Ϊstd::vector<ecc::deal::po::CTradeActivePo> 
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeActiveInfoList_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->vecTradeActiveInfoList = $bs->popObject('stl_vector<TradeActivePo>'); // �����л���Ʒ����б� ����Ϊstd::vector<ecc::deal::po::CTradeActivePo> 
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeActiveInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.ecc.deal.idl.TradeActivePoList.java

if (!class_exists('TradeActivePo')) {
class TradeActivePo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ��¼id
		 *
		 * �汾 >= 0
		 */
		var $ddwId; //uint64_t

		/**
		 * ��Ʒ�������
		 *
		 * �汾 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * ������ţ���ʽ:�������XXXXYYYY����:101041051509351702
		 *
		 * �汾 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * �������ţ�ͳһƽ̨�ڲ�����
		 *
		 * �汾 >= 0
		 */
		var $ddwDealId64; //uint64_t

		/**
		 * ���׶������
		 *
		 * �汾 >= 0
		 */
		var $ddwBdealId; //uint64_t

		/**
		 * ���ID
		 *
		 * �汾 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * �̼�ID
		 *
		 * �汾 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * ����ͣ�ƽ̨ͳһ����.1:VIP�� 2:����  3:���� 4:������ 5:�Ż�ȯ 
		 *
		 * �汾 >= 0
		 */
		var $wActiveType; //uint16_t

		/**
		 * ����
		 *
		 * �汾 >= 0
		 */
		var $ddwActiveNo; //uint64_t

		/**
		 * ����й�����
		 *
		 * �汾 >= 0
		 */
		var $dwActiveRuleId; //uint32_t

		/**
		 * �����
		 *
		 * �汾 >= 0
		 */
		var $strActiveDesc; //std::string

		/**
		 * ���۽���Ʒ���ۼ�¼�ã������
		 *
		 * �汾 >= 0
		 */
		var $nAdjustFee; //int

		/**
		 * �ǰ����Ʒ�������
		 *
		 * �汾 >= 0
		 */
		var $dwPreActiveFee; //uint32_t

		/**
		 * �����Ʒ�����Żݽ�������ʾ�Żݣ�������ʾ��Ǯ
		 *
		 * �汾 >= 0
		 */
		var $nFavorFee; //int

		/**
		 * �����1
		 *
		 * �汾 >= 0
		 */
		var $dwActiveParam1; //uint32_t

		/**
		 * �����2
		 *
		 * �汾 >= 0
		 */
		var $dwActiveParam2; //uint32_t

		/**
		 * �����3
		 *
		 * �汾 >= 0
		 */
		var $dwActiveParam3; //uint32_t

		/**
		 * �����4
		 *
		 * �汾 >= 0
		 */
		var $dwActiveParam4; //uint32_t

		/**
		 * �����5
		 *
		 * �汾 >= 0
		 */
		var $ddwActiveParam5; //uint64_t

		/**
		 * �����6
		 *
		 * �汾 >= 0
		 */
		var $ddwActiveParam6; //uint64_t

		/**
		 * �����7
		 *
		 * �汾 >= 0
		 */
		var $strActiveParam7; //std::string

		/**
		 * �����8
		 *
		 * �汾 >= 0
		 */
		var $strActiveParam8; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId64_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBdealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cActiveNo_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cActiveType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cActiveRuleId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cActiveDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cAdjustFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPreActiveFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cFavorFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cActiveParam1_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cActiveParam2_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cActiveParam3_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cActiveParam4_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cActiveParam5_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cActiveParam6_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cActiveParam7_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushUint64_t($this->ddwId); // ���л���¼id ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwTradeId); // ���л���Ʒ������� ����Ϊuint64_t
			$bs->pushString($this->strDealId); // ���л�������ţ���ʽ:�������XXXXYYYY����:101041051509351702 ����Ϊstd::string
			$bs->pushUint64_t($this->ddwDealId64); // ���л��������ţ�ͳһƽ̨�ڲ����� ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwBdealId); // ���л����׶������ ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwBuyerId); // ���л����ID ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwSellerId); // ���л��̼�ID ����Ϊuint64_t
			$bs->pushUint16_t($this->wActiveType); // ���л�����ͣ�ƽ̨ͳһ����.1:VIP�� 2:����  3:���� 4:������ 5:�Ż�ȯ  ����Ϊuint16_t
			$bs->pushUint64_t($this->ddwActiveNo); // ���л����� ����Ϊuint64_t
			$bs->pushUint32_t($this->dwActiveRuleId); // ���л�����й����� ����Ϊuint32_t
			$bs->pushString($this->strActiveDesc); // ���л������ ����Ϊstd::string
			$bs->pushInt32_t($this->nAdjustFee); // ���л����۽���Ʒ���ۼ�¼�ã������ ����Ϊint
			$bs->pushUint32_t($this->dwPreActiveFee); // ���л��ǰ����Ʒ������� ����Ϊuint32_t
			$bs->pushInt32_t($this->nFavorFee); // ���л������Ʒ�����Żݽ�������ʾ�Żݣ�������ʾ��Ǯ ����Ϊint
			$bs->pushUint32_t($this->dwActiveParam1); // ���л������1 ����Ϊuint32_t
			$bs->pushUint32_t($this->dwActiveParam2); // ���л������2 ����Ϊuint32_t
			$bs->pushUint32_t($this->dwActiveParam3); // ���л������3 ����Ϊuint32_t
			$bs->pushUint32_t($this->dwActiveParam4); // ���л������4 ����Ϊuint32_t
			$bs->pushUint64_t($this->ddwActiveParam5); // ���л������5 ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwActiveParam6); // ���л������6 ����Ϊuint64_t
			$bs->pushString($this->strActiveParam7); // ���л������7 ����Ϊstd::string
			$bs->pushString($this->strActiveParam8); // ���л������8 ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId64_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBdealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cActiveNo_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cActiveType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cActiveRuleId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cActiveDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cAdjustFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPreActiveFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cFavorFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cActiveParam1_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cActiveParam2_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cActiveParam3_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cActiveParam4_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cActiveParam5_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cActiveParam6_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cActiveParam7_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cActiveParam8_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->ddwId = $bs->popUint64_t(); // �����л���¼id ����Ϊuint64_t
			$this->ddwTradeId = $bs->popUint64_t(); // �����л���Ʒ������� ����Ϊuint64_t
			$this->strDealId = $bs->popString(); // �����л�������ţ���ʽ:�������XXXXYYYY����:101041051509351702 ����Ϊstd::string
			$this->ddwDealId64 = $bs->popUint64_t(); // �����л��������ţ�ͳһƽ̨�ڲ����� ����Ϊuint64_t
			$this->ddwBdealId = $bs->popUint64_t(); // �����л����׶������ ����Ϊuint64_t
			$this->ddwBuyerId = $bs->popUint64_t(); // �����л����ID ����Ϊuint64_t
			$this->ddwSellerId = $bs->popUint64_t(); // �����л��̼�ID ����Ϊuint64_t
			$this->wActiveType = $bs->popUint16_t(); // �����л�����ͣ�ƽ̨ͳһ����.1:VIP�� 2:����  3:���� 4:������ 5:�Ż�ȯ  ����Ϊuint16_t
			$this->ddwActiveNo = $bs->popUint64_t(); // �����л����� ����Ϊuint64_t
			$this->dwActiveRuleId = $bs->popUint32_t(); // �����л�����й����� ����Ϊuint32_t
			$this->strActiveDesc = $bs->popString(); // �����л������ ����Ϊstd::string
			$this->nAdjustFee = $bs->popInt32_t(); // �����л����۽���Ʒ���ۼ�¼�ã������ ����Ϊint
			$this->dwPreActiveFee = $bs->popUint32_t(); // �����л��ǰ����Ʒ������� ����Ϊuint32_t
			$this->nFavorFee = $bs->popInt32_t(); // �����л������Ʒ�����Żݽ�������ʾ�Żݣ�������ʾ��Ǯ ����Ϊint
			$this->dwActiveParam1 = $bs->popUint32_t(); // �����л������1 ����Ϊuint32_t
			$this->dwActiveParam2 = $bs->popUint32_t(); // �����л������2 ����Ϊuint32_t
			$this->dwActiveParam3 = $bs->popUint32_t(); // �����л������3 ����Ϊuint32_t
			$this->dwActiveParam4 = $bs->popUint32_t(); // �����л������4 ����Ϊuint32_t
			$this->ddwActiveParam5 = $bs->popUint64_t(); // �����л������5 ����Ϊuint64_t
			$this->ddwActiveParam6 = $bs->popUint64_t(); // �����л������6 ����Ϊuint64_t
			$this->strActiveParam7 = $bs->popString(); // �����л������7 ����Ϊstd::string
			$this->strActiveParam8 = $bs->popString(); // �����л������8 ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId64_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBdealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cActiveNo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cActiveType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cActiveRuleId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cActiveDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cAdjustFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPreActiveFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cFavorFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cActiveParam1_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cActiveParam2_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cActiveParam3_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cActiveParam4_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cActiveParam5_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cActiveParam6_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cActiveParam7_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cActiveParam8_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.ecc.deal.idl.DealPo.java

if (!class_exists('RecvFeePoList')) {
class RecvFeePoList
{
		/**
		 * �汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ���б�
		 *
		 * �汾 >= 0
		 */
		var $vecRecvFeeInfoList; //std::vector<ecc::deal::po::CRecvFeePo> 

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л��汾�� ����Ϊuint16_t
			$bs->pushObject($this->vecRecvFeeInfoList,'stl_vector'); // ���л����б� ����Ϊstd::vector<ecc::deal::po::CRecvFeePo> 
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvFeeInfoList_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л��汾�� ����Ϊuint16_t
			$this->vecRecvFeeInfoList = $bs->popObject('stl_vector<RecvFeePo>'); // �����л����б� ����Ϊstd::vector<ecc::deal::po::CRecvFeePo> 
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvFeeInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.ecc.deal.idl.RecvFeePoList.java

if (!class_exists('RecvFeePo')) {
class RecvFeePo
{
		/**
		 * �汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ��DB�������ͣ�0:Insert 1:Update
		 *
		 * �汾 >= 0
		 */
		var $dwControl; //uint32_t

		/**
		 * �˿ID
		 *
		 * �汾 >= 0
		 */
		var $ddwRecvFeeId; //uint64_t

		/**
		 * ������ţ���ʽ:�������XXXXYYYY����:101041051509351702
		 *
		 * �汾 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * �������ţ�ͳһƽ̨�ڲ�����
		 *
		 * �汾 >= 0
		 */
		var $ddwDealId64; //uint64_t

		/**
		 * ֧����ID
		 *
		 * �汾 >= 0
		 */
		var $ddwPayId; //uint64_t

		/**
		 * �Ƹ�ͨ����ID
		 *
		 * �汾 >= 0
		 */
		var $strCftDealId; //std::string

		/**
		 * ����ʶ
		 *
		 * �汾 >= 0
		 */
		var $strDrawId; //std::string

		/**
		 * ���token
		 *
		 * �汾 >= 0
		 */
		var $strDrawToken; //std::string

		/**
		 * ���ID
		 *
		 * �汾 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * ����ʺ�
		 *
		 * �汾 >= 0
		 */
		var $strBuyerAccount; //std::string

		/**
		 * ����յ����
		 *
		 * �汾 >= 0
		 */
		var $dwBuyerRecvFee; //uint32_t

		/**
		 * �̼�ID
		 *
		 * �汾 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * �̼��ʺ�
		 *
		 * �汾 >= 0
		 */
		var $strSellerAccount; //std::string

		/**
		 * �����յ����
		 *
		 * �汾 >= 0
		 */
		var $dwSellerRecvFee; //uint32_t

		/**
		 * ��Ʒ�����б�
		 *
		 * �汾 >= 0
		 */
		var $strItemTitleList; //std::string

		/**
		 * ��״̬��1���ѷ����2��������
		 *
		 * �汾 >= 0
		 */
		var $dwRecvFeeState; //uint32_t

		/**
		 * �����ͣ�1ȷ���ջ����  2ȫ���˿��� 3�ۺ��� 4�ٲú���
		 *
		 * �汾 >= 0
		 */
		var $dwRecvFeeType; //uint32_t

		/**
		 * ������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwRecvFeeFinishTime; //uint32_t

		/**
		 * ����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwRecvFeeReturnTime; //uint32_t

		/**
		 * ����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwRecvFeeGenTime; //uint32_t

		/**
		 * ������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cControl_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvFeeId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId64_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cCftDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDrawId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDrawToken_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerAccount_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerRecvFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerAccount_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerRecvFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemTitleList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvFeeState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvFeeType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvFeeFinishTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvFeeReturnTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvFeeGenTime_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л��汾�� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwControl); // ���л���DB�������ͣ�0:Insert 1:Update ����Ϊuint32_t
			$bs->pushUint64_t($this->ddwRecvFeeId); // ���л��˿ID ����Ϊuint64_t
			$bs->pushString($this->strDealId); // ���л�������ţ���ʽ:�������XXXXYYYY����:101041051509351702 ����Ϊstd::string
			$bs->pushUint64_t($this->ddwDealId64); // ���л��������ţ�ͳһƽ̨�ڲ����� ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwPayId); // ���л�֧����ID ����Ϊuint64_t
			$bs->pushString($this->strCftDealId); // ���л��Ƹ�ͨ����ID ����Ϊstd::string
			$bs->pushString($this->strDrawId); // ���л�����ʶ ����Ϊstd::string
			$bs->pushString($this->strDrawToken); // ���л����token ����Ϊstd::string
			$bs->pushUint64_t($this->ddwBuyerId); // ���л����ID ����Ϊuint64_t
			$bs->pushString($this->strBuyerAccount); // ���л�����ʺ� ����Ϊstd::string
			$bs->pushUint32_t($this->dwBuyerRecvFee); // ���л�����յ���� ����Ϊuint32_t
			$bs->pushUint64_t($this->ddwSellerId); // ���л��̼�ID ����Ϊuint64_t
			$bs->pushString($this->strSellerAccount); // ���л��̼��ʺ� ����Ϊstd::string
			$bs->pushUint32_t($this->dwSellerRecvFee); // ���л������յ���� ����Ϊuint32_t
			$bs->pushString($this->strItemTitleList); // ���л���Ʒ�����б� ����Ϊstd::string
			$bs->pushUint32_t($this->dwRecvFeeState); // ���л���״̬��1���ѷ����2�������� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRecvFeeType); // ���л������ͣ�1ȷ���ջ����  2ȫ���˿��� 3�ۺ��� 4�ٲú��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRecvFeeFinishTime); // ���л�������ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRecvFeeReturnTime); // ���л�����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRecvFeeGenTime); // ���л�����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // ���л�������ʱ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cControl_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvFeeId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId64_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cCftDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDrawId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDrawToken_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerAccount_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerRecvFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerAccount_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerRecvFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemTitleList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvFeeState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvFeeType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvFeeFinishTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvFeeReturnTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvFeeGenTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л��汾�� ����Ϊuint16_t
			$this->dwControl = $bs->popUint32_t(); // �����л���DB�������ͣ�0:Insert 1:Update ����Ϊuint32_t
			$this->ddwRecvFeeId = $bs->popUint64_t(); // �����л��˿ID ����Ϊuint64_t
			$this->strDealId = $bs->popString(); // �����л�������ţ���ʽ:�������XXXXYYYY����:101041051509351702 ����Ϊstd::string
			$this->ddwDealId64 = $bs->popUint64_t(); // �����л��������ţ�ͳһƽ̨�ڲ����� ����Ϊuint64_t
			$this->ddwPayId = $bs->popUint64_t(); // �����л�֧����ID ����Ϊuint64_t
			$this->strCftDealId = $bs->popString(); // �����л��Ƹ�ͨ����ID ����Ϊstd::string
			$this->strDrawId = $bs->popString(); // �����л�����ʶ ����Ϊstd::string
			$this->strDrawToken = $bs->popString(); // �����л����token ����Ϊstd::string
			$this->ddwBuyerId = $bs->popUint64_t(); // �����л����ID ����Ϊuint64_t
			$this->strBuyerAccount = $bs->popString(); // �����л�����ʺ� ����Ϊstd::string
			$this->dwBuyerRecvFee = $bs->popUint32_t(); // �����л�����յ���� ����Ϊuint32_t
			$this->ddwSellerId = $bs->popUint64_t(); // �����л��̼�ID ����Ϊuint64_t
			$this->strSellerAccount = $bs->popString(); // �����л��̼��ʺ� ����Ϊstd::string
			$this->dwSellerRecvFee = $bs->popUint32_t(); // �����л������յ���� ����Ϊuint32_t
			$this->strItemTitleList = $bs->popString(); // �����л���Ʒ�����б� ����Ϊstd::string
			$this->dwRecvFeeState = $bs->popUint32_t(); // �����л���״̬��1���ѷ����2�������� ����Ϊuint32_t
			$this->dwRecvFeeType = $bs->popUint32_t(); // �����л������ͣ�1ȷ���ջ����  2ȫ���˿��� 3�ۺ��� 4�ٲú��� ����Ϊuint32_t
			$this->dwRecvFeeFinishTime = $bs->popUint32_t(); // �����л�������ʱ�� ����Ϊuint32_t
			$this->dwRecvFeeReturnTime = $bs->popUint32_t(); // �����л�����ʱ�� ����Ϊuint32_t
			$this->dwRecvFeeGenTime = $bs->popUint32_t(); // �����л�����ʱ�� ����Ϊuint32_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // �����л�������ʱ�� ����Ϊuint32_t
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cControl_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvFeeId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId64_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cCftDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDrawId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDrawToken_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerAccount_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerRecvFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerAccount_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerRecvFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemTitleList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvFeeState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvFeeType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvFeeFinishTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvFeeReturnTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvFeeGenTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.ecc.deal.idl.DealPo.java

if (!class_exists('DealWuliuPoList')) {
class DealWuliuPoList
{
		/**
		 * �汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * �������б�
		 *
		 * �汾 >= 0
		 */
		var $vecWuliuInfoList; //std::vector<ecc::deal::po::CDealWuliuPo> 

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л��汾�� ����Ϊuint16_t
			$bs->pushObject($this->vecWuliuInfoList,'stl_vector'); // ���л��������б� ����Ϊstd::vector<ecc::deal::po::CDealWuliuPo> 
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cWuliuInfoList_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л��汾�� ����Ϊuint16_t
			$this->vecWuliuInfoList = $bs->popObject('stl_vector<DealWuliuPo>'); // �����л��������б� ����Ϊstd::vector<ecc::deal::po::CDealWuliuPo> 
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cWuliuInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.ecc.deal.idl.DealWuliuPoList.java

if (!class_exists('DealWuliuPo')) {
class DealWuliuPo
{
		/**
		 * �汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ������DB�������ͣ�0:Insert 1:Update
		 *
		 * �汾 >= 0
		 */
		var $dwControl; //uint32_t

		/**
		 * ������ţ���ʽ:�������XXXXYYYY����:101041051509351702
		 *
		 * �汾 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * �������ţ�ͳһƽ̨�ڲ�����
		 *
		 * �汾 >= 0
		 */
		var $ddwDealId64; //uint64_t

		/**
		 * ͳһƽ̨�ڲ���������
		 *
		 * �汾 >= 0
		 */
		var $ddwInnerWuliuId; //uint64_t

		/**
		 * ���ID
		 *
		 * �汾 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * ����ǳ�
		 *
		 * �汾 >= 0
		 */
		var $strBuyerNickName; //std::string

		/**
		 * �̼�ID
		 *
		 * �汾 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * �̼�����
		 *
		 * �汾 >= 0
		 */
		var $strSellerTitle; //std::string

		/**
		 * ���������ţ�����ϵͳά��
		 *
		 * �汾 >= 0
		 */
		var $strWuliuDealId; //std::string

		/**
		 * ���ͷ�ʽ��1��ƽ�ʣ�2����ݣ�3��EMS��4��B2C�Խ�������5���û����͵�����
		 *
		 * �汾 >= 0
		 */
		var $cExpressType; //uint8_t

		/**
		 * ������˾ID
		 *
		 * �汾 >= 0
		 */
		var $strExpressCompanyID; //std::string

		/**
		 * ������˾����
		 *
		 * �汾 >= 0
		 */
		var $strExpressCompanyName; //std::string

		/**
		 * ������˾������
		 *
		 * �汾 >= 0
		 */
		var $strExpressDealID; //std::string

		/**
		 * Ԥ�Ƶ�������
		 *
		 * �汾 >= 0
		 */
		var $wExpectArriveDays; //uint16_t

		/**
		 * ��Ʒ����Ϣ�б�TradeId1:����1;TradeId2:����2..
		 *
		 * �汾 >= 0
		 */
		var $strTradeInfoList; //std::string

		/**
		 * ��Ʒ�����б�
		 *
		 * �汾 >= 0
		 */
		var $strItemTitleList; //std::string

		/**
		 * �ջ�������
		 *
		 * �汾 >= 0
		 */
		var $strRecvName; //std::string

		/**
		 * �ջ���������
		 *
		 * �汾 >= 0
		 */
		var $dwRecvRegionCode; //uint32_t

		/**
		 * �ջ���ַ
		 *
		 * �汾 >= 0
		 */
		var $strRecvAddress; //std::string

		/**
		 * �ʱ�
		 *
		 * �汾 >= 0
		 */
		var $strRecvPostCode; //std::string

		/**
		 * �ջ��˵绰
		 *
		 * �汾 >= 0
		 */
		var $strRecvPhone; //std::string

		/**
		 * �ջ����ֻ�
		 *
		 * �汾 >= 0
		 */
		var $ddwRecvMobile; //uint64_t

		/**
		 * �����ջ�����
		 *
		 * �汾 >= 0
		 */
		var $dwRecvExpectDate; //uint32_t

		/**
		 * �����ջ�ʱ���
		 *
		 * �汾 >= 0
		 */
		var $strRecvExpectTimeSpan; //std::string

		/**
		 * �ջ�����
		 *
		 * �汾 >= 0
		 */
		var $strRecvRemark; //std::string

		/**
		 * �ջ�����
		 *
		 * �汾 >= 0
		 */
		var $dwRecvMask; //uint32_t

		/**
		 * �̼ҷ�������
		 *
		 * �汾 >= 0
		 */
		var $strSellerConsignNote; //std::string

		/**
		 * ����ȡ����ַ
		 *
		 * �汾 >= 0
		 */
		var $strWuliuGetItemAddr; //std::string

		/**
		 * ��������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwWuliuSendTime; //uint32_t

		/**
		 * �����ջ�ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwWuliuRecvTime; //uint32_t

		/**
		 * ����������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwWuliuGenTime; //uint32_t

		/**
		 * ��¼����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cControl_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId64_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cInnerWuliuId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerNickName_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerTitle_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cWuliuDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExpressType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExpressCompanyID_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExpressCompanyName_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExpressDealID_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExpectArriveDays_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeInfoList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemTitleList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvName_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvRegionCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvAddress_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvPostCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvPhone_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvMobile_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvExpectDate_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvExpectTimeSpan_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvRemark_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvMask_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerConsignNote_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cWuliuGetItemAddr_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cWuliuSendTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cWuliuRecvTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cWuliuGenTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t

		/**
		 * ��չ��������
		 *
		 * �汾 >= 1
		 */
		var $strRecvRegionCodeExt; //std::string

		/**
		 * ��չ��������UFlag
		 *
		 * �汾 >= 1
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
			$bs->pushUint16_t($this->wVersion); // ���л��汾�� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwControl); // ���л�������DB�������ͣ�0:Insert 1:Update ����Ϊuint32_t
			$bs->pushString($this->strDealId); // ���л�������ţ���ʽ:�������XXXXYYYY����:101041051509351702 ����Ϊstd::string
			$bs->pushUint64_t($this->ddwDealId64); // ���л��������ţ�ͳһƽ̨�ڲ����� ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwInnerWuliuId); // ���л�ͳһƽ̨�ڲ��������� ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwBuyerId); // ���л����ID ����Ϊuint64_t
			$bs->pushString($this->strBuyerNickName); // ���л�����ǳ� ����Ϊstd::string
			$bs->pushUint64_t($this->ddwSellerId); // ���л��̼�ID ����Ϊuint64_t
			$bs->pushString($this->strSellerTitle); // ���л��̼����� ����Ϊstd::string
			$bs->pushString($this->strWuliuDealId); // ���л����������ţ�����ϵͳά�� ����Ϊstd::string
			$bs->pushUint8_t($this->cExpressType); // ���л����ͷ�ʽ��1��ƽ�ʣ�2����ݣ�3��EMS��4��B2C�Խ�������5���û����͵����� ����Ϊuint8_t
			$bs->pushString($this->strExpressCompanyID); // ���л�������˾ID ����Ϊstd::string
			$bs->pushString($this->strExpressCompanyName); // ���л�������˾���� ����Ϊstd::string
			$bs->pushString($this->strExpressDealID); // ���л�������˾������ ����Ϊstd::string
			$bs->pushUint16_t($this->wExpectArriveDays); // ���л�Ԥ�Ƶ������� ����Ϊuint16_t
			$bs->pushString($this->strTradeInfoList); // ���л���Ʒ����Ϣ�б�TradeId1:����1;TradeId2:����2.. ����Ϊstd::string
			$bs->pushString($this->strItemTitleList); // ���л���Ʒ�����б� ����Ϊstd::string
			$bs->pushString($this->strRecvName); // ���л��ջ������� ����Ϊstd::string
			$bs->pushUint32_t($this->dwRecvRegionCode); // ���л��ջ��������� ����Ϊuint32_t
			$bs->pushString($this->strRecvAddress); // ���л��ջ���ַ ����Ϊstd::string
			$bs->pushString($this->strRecvPostCode); // ���л��ʱ� ����Ϊstd::string
			$bs->pushString($this->strRecvPhone); // ���л��ջ��˵绰 ����Ϊstd::string
			$bs->pushUint64_t($this->ddwRecvMobile); // ���л��ջ����ֻ� ����Ϊuint64_t
			$bs->pushUint32_t($this->dwRecvExpectDate); // ���л������ջ����� ����Ϊuint32_t
			$bs->pushString($this->strRecvExpectTimeSpan); // ���л������ջ�ʱ��� ����Ϊstd::string
			$bs->pushString($this->strRecvRemark); // ���л��ջ����� ����Ϊstd::string
			$bs->pushUint32_t($this->dwRecvMask); // ���л��ջ����� ����Ϊuint32_t
			$bs->pushString($this->strSellerConsignNote); // ���л��̼ҷ������� ����Ϊstd::string
			$bs->pushString($this->strWuliuGetItemAddr); // ���л�����ȡ����ַ ����Ϊstd::string
			$bs->pushUint32_t($this->dwWuliuSendTime); // ���л���������ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwWuliuRecvTime); // ���л������ջ�ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwWuliuGenTime); // ���л�����������ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // ���л���¼����ʱ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cControl_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId64_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cInnerWuliuId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerNickName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerTitle_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cWuliuDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExpressType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExpressCompanyID_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExpressCompanyName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExpressDealID_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExpectArriveDays_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeInfoList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemTitleList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvRegionCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvAddress_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvPostCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvPhone_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvMobile_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvExpectDate_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvExpectTimeSpan_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvRemark_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvMask_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerConsignNote_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cWuliuGetItemAddr_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cWuliuSendTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cWuliuRecvTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cWuliuGenTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // ���л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strRecvRegionCodeExt); // ���л���չ�������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cRecvRegionCodeExt_u); // ���л���չ��������UFlag ����Ϊuint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л��汾�� ����Ϊuint16_t
			$this->dwControl = $bs->popUint32_t(); // �����л�������DB�������ͣ�0:Insert 1:Update ����Ϊuint32_t
			$this->strDealId = $bs->popString(); // �����л�������ţ���ʽ:�������XXXXYYYY����:101041051509351702 ����Ϊstd::string
			$this->ddwDealId64 = $bs->popUint64_t(); // �����л��������ţ�ͳһƽ̨�ڲ����� ����Ϊuint64_t
			$this->ddwInnerWuliuId = $bs->popUint64_t(); // �����л�ͳһƽ̨�ڲ��������� ����Ϊuint64_t
			$this->ddwBuyerId = $bs->popUint64_t(); // �����л����ID ����Ϊuint64_t
			$this->strBuyerNickName = $bs->popString(); // �����л�����ǳ� ����Ϊstd::string
			$this->ddwSellerId = $bs->popUint64_t(); // �����л��̼�ID ����Ϊuint64_t
			$this->strSellerTitle = $bs->popString(); // �����л��̼����� ����Ϊstd::string
			$this->strWuliuDealId = $bs->popString(); // �����л����������ţ�����ϵͳά�� ����Ϊstd::string
			$this->cExpressType = $bs->popUint8_t(); // �����л����ͷ�ʽ��1��ƽ�ʣ�2����ݣ�3��EMS��4��B2C�Խ�������5���û����͵����� ����Ϊuint8_t
			$this->strExpressCompanyID = $bs->popString(); // �����л�������˾ID ����Ϊstd::string
			$this->strExpressCompanyName = $bs->popString(); // �����л�������˾���� ����Ϊstd::string
			$this->strExpressDealID = $bs->popString(); // �����л�������˾������ ����Ϊstd::string
			$this->wExpectArriveDays = $bs->popUint16_t(); // �����л�Ԥ�Ƶ������� ����Ϊuint16_t
			$this->strTradeInfoList = $bs->popString(); // �����л���Ʒ����Ϣ�б�TradeId1:����1;TradeId2:����2.. ����Ϊstd::string
			$this->strItemTitleList = $bs->popString(); // �����л���Ʒ�����б� ����Ϊstd::string
			$this->strRecvName = $bs->popString(); // �����л��ջ������� ����Ϊstd::string
			$this->dwRecvRegionCode = $bs->popUint32_t(); // �����л��ջ��������� ����Ϊuint32_t
			$this->strRecvAddress = $bs->popString(); // �����л��ջ���ַ ����Ϊstd::string
			$this->strRecvPostCode = $bs->popString(); // �����л��ʱ� ����Ϊstd::string
			$this->strRecvPhone = $bs->popString(); // �����л��ջ��˵绰 ����Ϊstd::string
			$this->ddwRecvMobile = $bs->popUint64_t(); // �����л��ջ����ֻ� ����Ϊuint64_t
			$this->dwRecvExpectDate = $bs->popUint32_t(); // �����л������ջ����� ����Ϊuint32_t
			$this->strRecvExpectTimeSpan = $bs->popString(); // �����л������ջ�ʱ��� ����Ϊstd::string
			$this->strRecvRemark = $bs->popString(); // �����л��ջ����� ����Ϊstd::string
			$this->dwRecvMask = $bs->popUint32_t(); // �����л��ջ����� ����Ϊuint32_t
			$this->strSellerConsignNote = $bs->popString(); // �����л��̼ҷ������� ����Ϊstd::string
			$this->strWuliuGetItemAddr = $bs->popString(); // �����л�����ȡ����ַ ����Ϊstd::string
			$this->dwWuliuSendTime = $bs->popUint32_t(); // �����л���������ʱ�� ����Ϊuint32_t
			$this->dwWuliuRecvTime = $bs->popUint32_t(); // �����л������ջ�ʱ�� ����Ϊuint32_t
			$this->dwWuliuGenTime = $bs->popUint32_t(); // �����л�����������ʱ�� ����Ϊuint32_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // �����л���¼����ʱ�� ����Ϊuint32_t
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cControl_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId64_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cInnerWuliuId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerNickName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerTitle_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cWuliuDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExpressType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExpressCompanyID_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExpressCompanyName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExpressDealID_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExpectArriveDays_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemTitleList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvRegionCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvAddress_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvPostCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvPhone_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvMobile_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvExpectDate_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvExpectTimeSpan_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvRemark_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvMask_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerConsignNote_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cWuliuGetItemAddr_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cWuliuSendTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cWuliuRecvTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cWuliuGenTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$this->strRecvRegionCodeExt = $bs->popString(); // �����л���չ�������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cRecvRegionCodeExt_u = $bs->popUint8_t(); // �����л���չ��������UFlag ����Ϊuint8_t
			}

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


//source idl: com.ecc.deal.idl.DealPo.java

if (!class_exists('DealRefundPoList')) {
class DealRefundPoList
{
		/**
		 * �汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * �˿�б�
		 *
		 * �汾 >= 0
		 */
		var $vecDealRefundInfoList; //std::vector<ecc::deal::po::CDealRefundPo> 

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л��汾�� ����Ϊuint16_t
			$bs->pushObject($this->vecDealRefundInfoList,'stl_vector'); // ���л��˿�б� ����Ϊstd::vector<ecc::deal::po::CDealRefundPo> 
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealRefundInfoList_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л��汾�� ����Ϊuint16_t
			$this->vecDealRefundInfoList = $bs->popObject('stl_vector<DealRefundPo>'); // �����л��˿�б� ����Ϊstd::vector<ecc::deal::po::CDealRefundPo> 
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealRefundInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.ecc.deal.idl.DealRefundPoList.java

if (!class_exists('DealRefundPo')) {
class DealRefundPo
{
		/**
		 * �汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * �˿DB�������ͣ�0:Insert 1:Update
		 *
		 * �汾 >= 0
		 */
		var $dwControl; //uint32_t

		/**
		 * �˿ID
		 *
		 * �汾 >= 0
		 */
		var $ddwRefundDetailId; //uint64_t

		/**
		 * ������ţ���ʽ:�������XXXXYYYY����:101041051509351702
		 *
		 * �汾 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * �������ţ�ͳһƽ̨�ڲ�����
		 *
		 * �汾 >= 0
		 */
		var $ddwDealId64; //uint64_t

		/**
		 * ��Ʒ��ID
		 *
		 * �汾 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * ��ƷskuID�б�
		 *
		 * �汾 >= 0
		 */
		var $strItemSkuidList; //std::string

		/**
		 * ��Ʒ�����б�
		 *
		 * �汾 >= 0
		 */
		var $strItemTitleList; //std::string

		/**
		 * ���ID
		 *
		 * �汾 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * ����ʺ�
		 *
		 * �汾 >= 0
		 */
		var $strBuyerAccount; //std::string

		/**
		 * ����ǳ�
		 *
		 * �汾 >= 0
		 */
		var $strBuyerNickName; //std::string

		/**
		 * �̼�ID
		 *
		 * �汾 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * �̼�����
		 *
		 * �汾 >= 0
		 */
		var $strSellerTitle; //std::string

		/**
		 * �˿��֧����ʽ
		 *
		 * �汾 >= 0
		 */
		var $cDealPayType; //uint8_t

		/**
		 * �˿����
		 *
		 * �汾 >= 0
		 */
		var $cRefundType; //uint8_t

		/**
		 * ������Ʒ�ɽ�����
		 *
		 * �汾 >= 0
		 */
		var $dwItemBuyPrice; //uint32_t

		/**
		 * ������Ʒ�������������Ʒ���˿���Ч
		 *
		 * �汾 >= 0
		 */
		var $dwItemBuyNum; //uint32_t

		/**
		 * �˿���Ʒ����������Ʒ���˿���Ч
		 *
		 * �汾 >= 0
		 */
		var $dwRefundItemNum; //uint32_t

		/**
		 * �˿���ܽ��
		 *
		 * �汾 >= 0
		 */
		var $dwRefundDealTotalFee; //uint32_t

		/**
		 * �˿���Ʒ�ܽ��
		 *
		 * �汾 >= 0
		 */
		var $dwRefundItemTotalFee; //uint32_t

		/**
		 * �˿���Ʒ�Ż��ܽ��
		 *
		 * �汾 >= 0
		 */
		var $nRefundItemDiscountTotalFee; //int

		/**
		 * �˿���Ʒռ�Ż��б�
		 *
		 * �汾 >= 0
		 */
		var $strRefundItemActiveDesc; //std::string

		/**
		 * �˿���Ʒ�����ܽ��
		 *
		 * �汾 >= 0
		 */
		var $nRefundItemAdjustTotalFee; //int

		/**
		 * �˿���Ʒ�ʷ��ܽ��
		 *
		 * �汾 >= 0
		 */
		var $dwRefundShippingFee; //uint32_t

		/**
		 * �˿�ܽ��
		 *
		 * �汾 >= 0
		 */
		var $dwRefundTotalFee; //uint32_t

		/**
		 * �˿�����յ����
		 *
		 * �汾 >= 0
		 */
		var $dwRefundSellerRecvFee; //uint32_t

		/**
		 * �˿����յ����
		 *
		 * �汾 >= 0
		 */
		var $dwRefundBuyerRecvFee; //uint32_t

		/**
		 * �˿״̬, �ο�UNPDealState_E���й��˿�ĸ���״ֵ̬
		 *
		 * �汾 >= 0
		 */
		var $dwRefundState; //uint32_t

		/**
		 * �˿ǰһ��״̬
		 *
		 * �汾 >= 0
		 */
		var $dwPreRefundState; //uint32_t

		/**
		 * �˿����
		 *
		 * �汾 >= 0
		 */
		var $ddwRefundProperty; //uint64_t

		/**
		 * �˿����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwRefundGenTime; //uint32_t

		/**
		 * �˿�����ʱ�䣬���
		 *
		 * �汾 >= 0
		 */
		var $dwRefundApplyTime; //uint32_t

		/**
		 * �˿������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwRefundRecvFeeTime; //uint32_t

		/**
		 * �˿����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwRefundRecvFeeReturnTime; //uint32_t

		/**
		 * �˿����ʱ�䣬�˿�Э����
		 *
		 * �汾 >= 0
		 */
		var $dwRefundFinishTime; //uint32_t

		/**
		 * ��ҷ����˻�ʱ�䣬���˻�ʱ��Ч
		 *
		 * �汾 >= 0
		 */
		var $dwItemReturnSendTime; //uint32_t

		/**
		 * ��ҷ����˻�������Ϣ�����˻�ʱ��Ч
		 *
		 * �汾 >= 0
		 */
		var $strItemReturnWuliuInfo; //std::string

		/**
		 * ����˻����������˻�ʱ��Ч
		 *
		 * �汾 >= 0
		 */
		var $strItemReturnDesc; //std::string

		/**
		 * �˻��ջ�״̬�����˻�ʱ��Ч��1���յ�����2��δ�յ���
		 *
		 * �汾 >= 0
		 */
		var $cItemReturnTradeState; //uint8_t

		/**
		 * �˿�ԭ������
		 *
		 * �汾 >= 0
		 */
		var $cRefundReasonType; //uint8_t

		/**
		 * �˿�ԭ������
		 *
		 * �汾 >= 0
		 */
		var $strRefundReasonDesc; //std::string

		/**
		 * ����ͬ���˿�ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwSellerAgreeRefundTime; //uint32_t

		/**
		 * ����ͬ���˻�ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwSellerAgreeItemReturnTime; //uint32_t

		/**
		 * ���Ҿܾ��˿�ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwSellerRefuseRefundTime; //uint32_t

		/**
		 * �����˻���ַ
		 *
		 * �汾 >= 0
		 */
		var $strSellerItemReturnAddress; //std::string

		/**
		 * ���Ҵ����˿��
		 *
		 * �汾 >= 0
		 */
		var $strSellerProcessRefundMsg; //std::string

		/**
		 * ���Ҵ����˻�����
		 *
		 * �汾 >= 0
		 */
		var $strSellerProcessItemReturnMsg; //std::string

		/**
		 * �˿���ID
		 *
		 * �汾 >= 0
		 */
		var $ddwRecvFeeId; //uint64_t

		/**
		 * ��������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealCreateTime; //uint32_t

		/**
		 * ��ʱ��ʶ
		 *
		 * �汾 >= 0
		 */
		var $dwTimeoutFlag; //uint32_t

		/**
		 * ��¼����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cControl_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundDetailId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId64_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemSkuidList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemTitleList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerAccount_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerNickName_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerTitle_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealPayType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemBuyPrice_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemBuyNum_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundItemNum_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundDealTotalFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundItemTotalFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundItemDiscountTotalFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundItemActiveDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundItemAdjustTotalFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundShippingFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundTotalFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundSellerRecvFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundBuyerRecvFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPreRefundState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundProperty_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundGenTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundApplyTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundRecvFeeTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundRecvFeeReturnTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundFinishTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemReturnSendTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemReturnWuliuInfo_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemReturnDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemReturnTradeState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundReasonType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundReasonDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerAgreeRefundTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerAgreeItemReturnTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerRefuseRefundTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerItemReturnAddress_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerProcessRefundMsg_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerProcessItemReturnMsg_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvFeeId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealCreateTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTimeoutFlag_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t

		/**
		 * ҵ���˿��
		 *
		 * �汾 >= 1
		 */
		var $strBusinessRefundId; //std::string

		/**
		 * 
		 *
		 * �汾 >= 1
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
			$bs->pushUint16_t($this->wVersion); // ���л��汾�� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwControl); // ���л��˿DB�������ͣ�0:Insert 1:Update ����Ϊuint32_t
			$bs->pushUint64_t($this->ddwRefundDetailId); // ���л��˿ID ����Ϊuint64_t
			$bs->pushString($this->strDealId); // ���л�������ţ���ʽ:�������XXXXYYYY����:101041051509351702 ����Ϊstd::string
			$bs->pushUint64_t($this->ddwDealId64); // ���л��������ţ�ͳһƽ̨�ڲ����� ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwTradeId); // ���л���Ʒ��ID ����Ϊuint64_t
			$bs->pushString($this->strItemSkuidList); // ���л���ƷskuID�б� ����Ϊstd::string
			$bs->pushString($this->strItemTitleList); // ���л���Ʒ�����б� ����Ϊstd::string
			$bs->pushUint64_t($this->ddwBuyerId); // ���л����ID ����Ϊuint64_t
			$bs->pushString($this->strBuyerAccount); // ���л�����ʺ� ����Ϊstd::string
			$bs->pushString($this->strBuyerNickName); // ���л�����ǳ� ����Ϊstd::string
			$bs->pushUint64_t($this->ddwSellerId); // ���л��̼�ID ����Ϊuint64_t
			$bs->pushString($this->strSellerTitle); // ���л��̼����� ����Ϊstd::string
			$bs->pushUint8_t($this->cDealPayType); // ���л��˿��֧����ʽ ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundType); // ���л��˿���� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwItemBuyPrice); // ���л�������Ʒ�ɽ����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwItemBuyNum); // ���л�������Ʒ�������������Ʒ���˿���Ч ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRefundItemNum); // ���л��˿���Ʒ����������Ʒ���˿���Ч ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRefundDealTotalFee); // ���л��˿���ܽ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRefundItemTotalFee); // ���л��˿���Ʒ�ܽ�� ����Ϊuint32_t
			$bs->pushInt32_t($this->nRefundItemDiscountTotalFee); // ���л��˿���Ʒ�Ż��ܽ�� ����Ϊint
			$bs->pushString($this->strRefundItemActiveDesc); // ���л��˿���Ʒռ�Ż��б� ����Ϊstd::string
			$bs->pushInt32_t($this->nRefundItemAdjustTotalFee); // ���л��˿���Ʒ�����ܽ�� ����Ϊint
			$bs->pushUint32_t($this->dwRefundShippingFee); // ���л��˿���Ʒ�ʷ��ܽ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRefundTotalFee); // ���л��˿�ܽ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRefundSellerRecvFee); // ���л��˿�����յ���� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRefundBuyerRecvFee); // ���л��˿����յ���� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRefundState); // ���л��˿״̬, �ο�UNPDealState_E���й��˿�ĸ���״ֵ̬ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPreRefundState); // ���л��˿ǰһ��״̬ ����Ϊuint32_t
			$bs->pushUint64_t($this->ddwRefundProperty); // ���л��˿���� ����Ϊuint64_t
			$bs->pushUint32_t($this->dwRefundGenTime); // ���л��˿����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRefundApplyTime); // ���л��˿�����ʱ�䣬��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRefundRecvFeeTime); // ���л��˿������ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRefundRecvFeeReturnTime); // ���л��˿����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRefundFinishTime); // ���л��˿����ʱ�䣬�˿�Э���� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwItemReturnSendTime); // ���л���ҷ����˻�ʱ�䣬���˻�ʱ��Ч ����Ϊuint32_t
			$bs->pushString($this->strItemReturnWuliuInfo); // ���л���ҷ����˻�������Ϣ�����˻�ʱ��Ч ����Ϊstd::string
			$bs->pushString($this->strItemReturnDesc); // ���л�����˻����������˻�ʱ��Ч ����Ϊstd::string
			$bs->pushUint8_t($this->cItemReturnTradeState); // ���л��˻��ջ�״̬�����˻�ʱ��Ч��1���յ�����2��δ�յ��� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundReasonType); // ���л��˿�ԭ������ ����Ϊuint8_t
			$bs->pushString($this->strRefundReasonDesc); // ���л��˿�ԭ������ ����Ϊstd::string
			$bs->pushUint32_t($this->dwSellerAgreeRefundTime); // ���л�����ͬ���˿�ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwSellerAgreeItemReturnTime); // ���л�����ͬ���˻�ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwSellerRefuseRefundTime); // ���л����Ҿܾ��˿�ʱ�� ����Ϊuint32_t
			$bs->pushString($this->strSellerItemReturnAddress); // ���л������˻���ַ ����Ϊstd::string
			$bs->pushString($this->strSellerProcessRefundMsg); // ���л����Ҵ����˿�� ����Ϊstd::string
			$bs->pushString($this->strSellerProcessItemReturnMsg); // ���л����Ҵ����˻����� ����Ϊstd::string
			$bs->pushUint64_t($this->ddwRecvFeeId); // ���л��˿���ID ����Ϊuint64_t
			$bs->pushUint32_t($this->dwDealCreateTime); // ���л���������ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTimeoutFlag); // ���л���ʱ��ʶ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // ���л���¼����ʱ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cControl_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundDetailId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId64_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemSkuidList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemTitleList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerAccount_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerNickName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerTitle_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealPayType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemBuyPrice_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemBuyNum_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundItemNum_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundDealTotalFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundItemTotalFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundItemDiscountTotalFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundItemActiveDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundItemAdjustTotalFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundShippingFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundTotalFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundSellerRecvFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundBuyerRecvFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPreRefundState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundProperty_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundGenTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundApplyTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundRecvFeeTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundRecvFeeReturnTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundFinishTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemReturnSendTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemReturnWuliuInfo_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemReturnDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemReturnTradeState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundReasonType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundReasonDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerAgreeRefundTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerAgreeItemReturnTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerRefuseRefundTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerItemReturnAddress_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerProcessRefundMsg_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerProcessItemReturnMsg_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvFeeId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealCreateTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTimeoutFlag_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // ���л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strBusinessRefundId); // ���л�ҵ���˿�� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cBusinessRefundId_u); // ���л� ����Ϊuint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л��汾�� ����Ϊuint16_t
			$this->dwControl = $bs->popUint32_t(); // �����л��˿DB�������ͣ�0:Insert 1:Update ����Ϊuint32_t
			$this->ddwRefundDetailId = $bs->popUint64_t(); // �����л��˿ID ����Ϊuint64_t
			$this->strDealId = $bs->popString(); // �����л�������ţ���ʽ:�������XXXXYYYY����:101041051509351702 ����Ϊstd::string
			$this->ddwDealId64 = $bs->popUint64_t(); // �����л��������ţ�ͳһƽ̨�ڲ����� ����Ϊuint64_t
			$this->ddwTradeId = $bs->popUint64_t(); // �����л���Ʒ��ID ����Ϊuint64_t
			$this->strItemSkuidList = $bs->popString(); // �����л���ƷskuID�б� ����Ϊstd::string
			$this->strItemTitleList = $bs->popString(); // �����л���Ʒ�����б� ����Ϊstd::string
			$this->ddwBuyerId = $bs->popUint64_t(); // �����л����ID ����Ϊuint64_t
			$this->strBuyerAccount = $bs->popString(); // �����л�����ʺ� ����Ϊstd::string
			$this->strBuyerNickName = $bs->popString(); // �����л�����ǳ� ����Ϊstd::string
			$this->ddwSellerId = $bs->popUint64_t(); // �����л��̼�ID ����Ϊuint64_t
			$this->strSellerTitle = $bs->popString(); // �����л��̼����� ����Ϊstd::string
			$this->cDealPayType = $bs->popUint8_t(); // �����л��˿��֧����ʽ ����Ϊuint8_t
			$this->cRefundType = $bs->popUint8_t(); // �����л��˿���� ����Ϊuint8_t
			$this->dwItemBuyPrice = $bs->popUint32_t(); // �����л�������Ʒ�ɽ����� ����Ϊuint32_t
			$this->dwItemBuyNum = $bs->popUint32_t(); // �����л�������Ʒ�������������Ʒ���˿���Ч ����Ϊuint32_t
			$this->dwRefundItemNum = $bs->popUint32_t(); // �����л��˿���Ʒ����������Ʒ���˿���Ч ����Ϊuint32_t
			$this->dwRefundDealTotalFee = $bs->popUint32_t(); // �����л��˿���ܽ�� ����Ϊuint32_t
			$this->dwRefundItemTotalFee = $bs->popUint32_t(); // �����л��˿���Ʒ�ܽ�� ����Ϊuint32_t
			$this->nRefundItemDiscountTotalFee = $bs->popInt32_t(); // �����л��˿���Ʒ�Ż��ܽ�� ����Ϊint
			$this->strRefundItemActiveDesc = $bs->popString(); // �����л��˿���Ʒռ�Ż��б� ����Ϊstd::string
			$this->nRefundItemAdjustTotalFee = $bs->popInt32_t(); // �����л��˿���Ʒ�����ܽ�� ����Ϊint
			$this->dwRefundShippingFee = $bs->popUint32_t(); // �����л��˿���Ʒ�ʷ��ܽ�� ����Ϊuint32_t
			$this->dwRefundTotalFee = $bs->popUint32_t(); // �����л��˿�ܽ�� ����Ϊuint32_t
			$this->dwRefundSellerRecvFee = $bs->popUint32_t(); // �����л��˿�����յ���� ����Ϊuint32_t
			$this->dwRefundBuyerRecvFee = $bs->popUint32_t(); // �����л��˿����յ���� ����Ϊuint32_t
			$this->dwRefundState = $bs->popUint32_t(); // �����л��˿״̬, �ο�UNPDealState_E���й��˿�ĸ���״ֵ̬ ����Ϊuint32_t
			$this->dwPreRefundState = $bs->popUint32_t(); // �����л��˿ǰһ��״̬ ����Ϊuint32_t
			$this->ddwRefundProperty = $bs->popUint64_t(); // �����л��˿���� ����Ϊuint64_t
			$this->dwRefundGenTime = $bs->popUint32_t(); // �����л��˿����ʱ�� ����Ϊuint32_t
			$this->dwRefundApplyTime = $bs->popUint32_t(); // �����л��˿�����ʱ�䣬��� ����Ϊuint32_t
			$this->dwRefundRecvFeeTime = $bs->popUint32_t(); // �����л��˿������ʱ�� ����Ϊuint32_t
			$this->dwRefundRecvFeeReturnTime = $bs->popUint32_t(); // �����л��˿����ʱ�� ����Ϊuint32_t
			$this->dwRefundFinishTime = $bs->popUint32_t(); // �����л��˿����ʱ�䣬�˿�Э���� ����Ϊuint32_t
			$this->dwItemReturnSendTime = $bs->popUint32_t(); // �����л���ҷ����˻�ʱ�䣬���˻�ʱ��Ч ����Ϊuint32_t
			$this->strItemReturnWuliuInfo = $bs->popString(); // �����л���ҷ����˻�������Ϣ�����˻�ʱ��Ч ����Ϊstd::string
			$this->strItemReturnDesc = $bs->popString(); // �����л�����˻����������˻�ʱ��Ч ����Ϊstd::string
			$this->cItemReturnTradeState = $bs->popUint8_t(); // �����л��˻��ջ�״̬�����˻�ʱ��Ч��1���յ�����2��δ�յ��� ����Ϊuint8_t
			$this->cRefundReasonType = $bs->popUint8_t(); // �����л��˿�ԭ������ ����Ϊuint8_t
			$this->strRefundReasonDesc = $bs->popString(); // �����л��˿�ԭ������ ����Ϊstd::string
			$this->dwSellerAgreeRefundTime = $bs->popUint32_t(); // �����л�����ͬ���˿�ʱ�� ����Ϊuint32_t
			$this->dwSellerAgreeItemReturnTime = $bs->popUint32_t(); // �����л�����ͬ���˻�ʱ�� ����Ϊuint32_t
			$this->dwSellerRefuseRefundTime = $bs->popUint32_t(); // �����л����Ҿܾ��˿�ʱ�� ����Ϊuint32_t
			$this->strSellerItemReturnAddress = $bs->popString(); // �����л������˻���ַ ����Ϊstd::string
			$this->strSellerProcessRefundMsg = $bs->popString(); // �����л����Ҵ����˿�� ����Ϊstd::string
			$this->strSellerProcessItemReturnMsg = $bs->popString(); // �����л����Ҵ����˻����� ����Ϊstd::string
			$this->ddwRecvFeeId = $bs->popUint64_t(); // �����л��˿���ID ����Ϊuint64_t
			$this->dwDealCreateTime = $bs->popUint32_t(); // �����л���������ʱ�� ����Ϊuint32_t
			$this->dwTimeoutFlag = $bs->popUint32_t(); // �����л���ʱ��ʶ ����Ϊuint32_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // �����л���¼����ʱ�� ����Ϊuint32_t
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cControl_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundDetailId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId64_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemSkuidList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemTitleList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerAccount_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerNickName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerTitle_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealPayType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemBuyPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemBuyNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundItemNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundDealTotalFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundItemTotalFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundItemDiscountTotalFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundItemActiveDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundItemAdjustTotalFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundShippingFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundTotalFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundSellerRecvFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundBuyerRecvFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPreRefundState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundProperty_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundGenTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundApplyTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundRecvFeeTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundRecvFeeReturnTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundFinishTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemReturnSendTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemReturnWuliuInfo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemReturnDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemReturnTradeState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundReasonType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundReasonDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerAgreeRefundTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerAgreeItemReturnTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerRefuseRefundTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerItemReturnAddress_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerProcessRefundMsg_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerProcessItemReturnMsg_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvFeeId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealCreateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTimeoutFlag_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$this->strBusinessRefundId = $bs->popString(); // �����л�ҵ���˿�� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cBusinessRefundId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}

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


//source idl: com.ecc.deal.idl.UserQueryDealReq.java

if (!class_exists('DealQueryBo')) {
class DealQueryBo
{
		/**
		 * �汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ����id
		 *
		 * �汾 >= 0
		 */
		var $ddwDealId; //uint64_t

		/**
		 * �ӵ�id
		 *
		 * �汾 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * ����id
		 *
		 * �汾 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * ���id
		 *
		 * �汾 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * ��������
		 *
		 * �汾 >= 0
		 */
		var $strDealCode; //std::string

		/**
		 * �ӵ�����
		 *
		 * �汾 >= 0
		 */
		var $strTradeCode; //std::string

		/**
		 * ҵ�񶩵���
		 *
		 * �汾 >= 0
		 */
		var $strBusinessDealId; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBusinessDealId_u; //uint8_t

		/**
		 * ���׵�id
		 *
		 * �汾 >= 1
		 */
		var $ddwBdealId; //uint64_t

		/**
		 * ���׵�����
		 *
		 * �汾 >= 1
		 */
		var $strBdealCode; //std::string

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cBdealId_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
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
			$bs->pushUint16_t($this->wVersion); // ���л��汾�� ����Ϊuint16_t
			$bs->pushUint64_t($this->ddwDealId); // ���л�����id ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwTradeId); // ���л��ӵ�id ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwSellerId); // ���л�����id ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwBuyerId); // ���л����id ����Ϊuint64_t
			$bs->pushString($this->strDealCode); // ���л��������� ����Ϊstd::string
			$bs->pushString($this->strTradeCode); // ���л��ӵ����� ����Ϊstd::string
			$bs->pushString($this->strBusinessDealId); // ���л�ҵ�񶩵��� ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBusinessDealId_u); // ���л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushUint64_t($this->ddwBdealId); // ���л����׵�id ����Ϊuint64_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strBdealCode); // ���л����׵����� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cBdealId_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cBdealCode_u); // ���л� ����Ϊuint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л��汾�� ����Ϊuint16_t
			$this->ddwDealId = $bs->popUint64_t(); // �����л�����id ����Ϊuint64_t
			$this->ddwTradeId = $bs->popUint64_t(); // �����л��ӵ�id ����Ϊuint64_t
			$this->ddwSellerId = $bs->popUint64_t(); // �����л�����id ����Ϊuint64_t
			$this->ddwBuyerId = $bs->popUint64_t(); // �����л����id ����Ϊuint64_t
			$this->strDealCode = $bs->popString(); // �����л��������� ����Ϊstd::string
			$this->strTradeCode = $bs->popString(); // �����л��ӵ����� ����Ϊstd::string
			$this->strBusinessDealId = $bs->popString(); // �����л�ҵ�񶩵��� ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBusinessDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$this->ddwBdealId = $bs->popUint64_t(); // �����л����׵�id ����Ϊuint64_t
			}
			if(  $this->wVersion >= 1 ){
				$this->strBdealCode = $bs->popString(); // �����л����׵����� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cBdealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cBdealCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}

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


//source idl: com.ecc.deal.idl.UserQueryBdealResp.java

if (!class_exists('BdealPo')) {
class BdealPo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ���׵��ţ�������һ�ν�����Ϊ����
		 *
		 * �汾 >= 0
		 */
		var $ddwBdealId; //uint64_t

		/**
		 * ���׵���ţ����ַ�����ʽ�Ľ��׵���
		 *
		 * �汾 >= 0
		 */
		var $strBdealCode; //std::string

		/**
		 * ҵ�񶩵���ţ��������йܶ���
		 *
		 * �汾 >= 0
		 */
		var $strBusinessDealId; //std::string

		/**
		 * ���ID
		 *
		 * �汾 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * ����ʺ�
		 *
		 * �汾 >= 0
		 */
		var $strBuyerAccount; //std::string

		/**
		 * �������
		 *
		 * �汾 >= 0
		 */
		var $strBuyerNickName; //std::string

		/**
		 * ����ǳ�
		 *
		 * �汾 >= 0
		 */
		var $strBuyerNick; //std::string

		/**
		 * �̼�ID
		 *
		 * �汾 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * �̼���ʵ����
		 *
		 * �汾 >= 0
		 */
		var $strSellerTitle; //std::string

		/**
		 * �����ǳ�
		 *
		 * �汾 >= 0
		 */
		var $strSellerNick; //std::string

		/**
		 * ҵ��ID: 1:����ҵ��Ա��2:��Ѹҵ��
		 *
		 * �汾 >= 0
		 */
		var $dwBusinessId; //uint32_t

		/**
		 * ���׵����ͣ�1�����ﳵ��2��һ�ڼۣ�3��������4��������5��Ԥ��
		 *
		 * �汾 >= 0
		 */
		var $cBdealType; //uint8_t

		/**
		 * �µ�������1��ҵ����վ��2���ƶ�app��3���ƶ�wap
		 *
		 * �汾 >= 0
		 */
		var $dwBdealSource; //uint32_t

		/**
		 * ֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6���������
		 *
		 * �汾 >= 0
		 */
		var $cBdealPayType; //uint8_t

		/**
		 * ���׵�״̬
		 *
		 * �汾 >= 0
		 */
		var $dwBdealState; //uint32_t

		/**
		 * ���׵�ǰһ��״̬
		 *
		 * �汾 >= 0
		 */
		var $dwPreBdealState; //uint32_t

		/**
		 * ��Ʒ�����б�
		 *
		 * �汾 >= 0
		 */
		var $strItemTitleList; //std::string

		/**
		 * ��ƷskuID�б�
		 *
		 * �汾 >= 0
		 */
		var $strItemSkuidList; //std::string

		/**
		 * ���׵��ܽ�ֻ��¼�µ�ʱ�Ľ������ļ۲���䣬������Ϊ����۸�����
		 *
		 * �汾 >= 0
		 */
		var $dwBdealTotalFee; //uint32_t

		/**
		 * ʵ���ܽ����׵�����ʵ֧��������۸������
		 *
		 * �汾 >= 0
		 */
		var $dwBdealPayment; //uint32_t

		/**
		 * refer
		 *
		 * �汾 >= 0
		 */
		var $strBdealRefer; //std::string

		/**
		 * �µ�IP
		 *
		 * �汾 >= 0
		 */
		var $strBdealIp; //std::string

		/**
		 * ������Ϣ����
		 *
		 * �汾 >= 0
		 */
		var $strPromotionDesc; //std::string

		/**
		 * ���׵�����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwBdealGenTime; //uint32_t

		/**
		 * ���׵�����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwBdealPayTime; //uint32_t

		/**
		 * ���׵�����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwBdealEndTime; //uint32_t

		/**
		 * �ջ���
		 *
		 * �汾 >= 0
		 */
		var $strRecvName; //std::string

		/**
		 * ��������
		 *
		 * �汾 >= 0
		 */
		var $dwRecvRegionCode; //uint32_t

		/**
		 * ��չ��������
		 *
		 * �汾 >= 0
		 */
		var $strRecvRegionCodeExt; //std::string

		/**
		 * ��ַ
		 *
		 * �汾 >= 0
		 */
		var $strRecvAddress; //std::string

		/**
		 * �ʱ�
		 *
		 * �汾 >= 0
		 */
		var $strRecvPostCode; //std::string

		/**
		 * �绰
		 *
		 * �汾 >= 0
		 */
		var $strRecvPhone; //std::string

		/**
		 * �ֻ�
		 *
		 * �汾 >= 0
		 */
		var $ddwRecvMobile; //uint64_t

		/**
		 * ���׵����
		 *
		 * �汾 >= 0
		 */
		var $dwBdealFlag; //uint32_t

		/**
		 * ������Ч���
		 *
		 * �汾 >= 0
		 */
		var $dwDelFlag; //uint32_t

		/**
		 * �ɼ���ʶ
		 *
		 * �汾 >= 0
		 */
		var $dwVisibleState; //uint32_t

		/**
		 * ���׵�ժҪ
		 *
		 * �汾 >= 0
		 */
		var $strBdealDigest; //std::string

		/**
		 * ������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * �����б�
		 *
		 * �汾 >= 0
		 */
		var $oDealInfoList; //ecc::deal::po::CDealPoList

		/**
		 * ֧����Ϣ��
		 *
		 * �汾 >= 0
		 */
		var $oPayInfoList; //ecc::deal::po::CPayInfoPoList

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBdealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBdealCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBusinessDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerAccount_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerNickName_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerNick_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerTitle_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerNick_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBusinessId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBdealType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBdealSource_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBdealPayType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBdealState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPreBdealState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemTitleList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemSkuidList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBdealTotalFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBdealPayment_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBdealRefer_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBdealIp_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPromotionDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBdealGenTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBdealPayTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBdealEndTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvName_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvRegionCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvRegionCodeExt_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvAddress_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvPostCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvPhone_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvMobile_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBdealFlag_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDelFlag_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cVisibleState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBdealDigest_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealInfoList_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushUint64_t($this->ddwBdealId); // ���л����׵��ţ�������һ�ν�����Ϊ���� ����Ϊuint64_t
			$bs->pushString($this->strBdealCode); // ���л����׵���ţ����ַ�����ʽ�Ľ��׵��� ����Ϊstd::string
			$bs->pushString($this->strBusinessDealId); // ���л�ҵ�񶩵���ţ��������йܶ��� ����Ϊstd::string
			$bs->pushUint64_t($this->ddwBuyerId); // ���л����ID ����Ϊuint64_t
			$bs->pushString($this->strBuyerAccount); // ���л�����ʺ� ����Ϊstd::string
			$bs->pushString($this->strBuyerNickName); // ���л�������� ����Ϊstd::string
			$bs->pushString($this->strBuyerNick); // ���л�����ǳ� ����Ϊstd::string
			$bs->pushUint64_t($this->ddwSellerId); // ���л��̼�ID ����Ϊuint64_t
			$bs->pushString($this->strSellerTitle); // ���л��̼���ʵ���� ����Ϊstd::string
			$bs->pushString($this->strSellerNick); // ���л������ǳ� ����Ϊstd::string
			$bs->pushUint32_t($this->dwBusinessId); // ���л�ҵ��ID: 1:����ҵ��Ա��2:��Ѹҵ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cBdealType); // ���л����׵����ͣ�1�����ﳵ��2��һ�ڼۣ�3��������4��������5��Ԥ�� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwBdealSource); // ���л��µ�������1��ҵ����վ��2���ƶ�app��3���ƶ�wap ����Ϊuint32_t
			$bs->pushUint8_t($this->cBdealPayType); // ���л�֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6��������� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwBdealState); // ���л����׵�״̬ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPreBdealState); // ���л����׵�ǰһ��״̬ ����Ϊuint32_t
			$bs->pushString($this->strItemTitleList); // ���л���Ʒ�����б� ����Ϊstd::string
			$bs->pushString($this->strItemSkuidList); // ���л���ƷskuID�б� ����Ϊstd::string
			$bs->pushUint32_t($this->dwBdealTotalFee); // ���л����׵��ܽ�ֻ��¼�µ�ʱ�Ľ������ļ۲���䣬������Ϊ����۸����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwBdealPayment); // ���л�ʵ���ܽ����׵�����ʵ֧��������۸������ ����Ϊuint32_t
			$bs->pushString($this->strBdealRefer); // ���л�refer ����Ϊstd::string
			$bs->pushString($this->strBdealIp); // ���л��µ�IP ����Ϊstd::string
			$bs->pushString($this->strPromotionDesc); // ���л�������Ϣ���� ����Ϊstd::string
			$bs->pushUint32_t($this->dwBdealGenTime); // ���л����׵�����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwBdealPayTime); // ���л����׵�����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwBdealEndTime); // ���л����׵�����ʱ�� ����Ϊuint32_t
			$bs->pushString($this->strRecvName); // ���л��ջ��� ����Ϊstd::string
			$bs->pushUint32_t($this->dwRecvRegionCode); // ���л��������� ����Ϊuint32_t
			$bs->pushString($this->strRecvRegionCodeExt); // ���л���չ�������� ����Ϊstd::string
			$bs->pushString($this->strRecvAddress); // ���л���ַ ����Ϊstd::string
			$bs->pushString($this->strRecvPostCode); // ���л��ʱ� ����Ϊstd::string
			$bs->pushString($this->strRecvPhone); // ���л��绰 ����Ϊstd::string
			$bs->pushUint64_t($this->ddwRecvMobile); // ���л��ֻ� ����Ϊuint64_t
			$bs->pushUint32_t($this->dwBdealFlag); // ���л����׵���� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDelFlag); // ���л�������Ч��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwVisibleState); // ���л��ɼ���ʶ ����Ϊuint32_t
			$bs->pushString($this->strBdealDigest); // ���л����׵�ժҪ ����Ϊstd::string
			$bs->pushUint32_t($this->dwLastUpdateTime); // ���л�������ʱ�� ����Ϊuint32_t
			$bs->pushObject($this->oDealInfoList,'DealPoList'); // ���л������б� ����Ϊecc::deal::po::CDealPoList
			$bs->pushObject($this->oPayInfoList,'PayInfoPoList'); // ���л�֧����Ϣ�� ����Ϊecc::deal::po::CPayInfoPoList
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBdealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBdealCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBusinessDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerAccount_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerNickName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerNick_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerTitle_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerNick_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBusinessId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBdealType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBdealSource_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBdealPayType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBdealState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPreBdealState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemTitleList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemSkuidList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBdealTotalFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBdealPayment_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBdealRefer_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBdealIp_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPromotionDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBdealGenTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBdealPayTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBdealEndTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvRegionCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvRegionCodeExt_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvAddress_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvPostCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvPhone_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvMobile_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBdealFlag_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDelFlag_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cVisibleState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBdealDigest_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealInfoList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayInfoList_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->ddwBdealId = $bs->popUint64_t(); // �����л����׵��ţ�������һ�ν�����Ϊ���� ����Ϊuint64_t
			$this->strBdealCode = $bs->popString(); // �����л����׵���ţ����ַ�����ʽ�Ľ��׵��� ����Ϊstd::string
			$this->strBusinessDealId = $bs->popString(); // �����л�ҵ�񶩵���ţ��������йܶ��� ����Ϊstd::string
			$this->ddwBuyerId = $bs->popUint64_t(); // �����л����ID ����Ϊuint64_t
			$this->strBuyerAccount = $bs->popString(); // �����л�����ʺ� ����Ϊstd::string
			$this->strBuyerNickName = $bs->popString(); // �����л�������� ����Ϊstd::string
			$this->strBuyerNick = $bs->popString(); // �����л�����ǳ� ����Ϊstd::string
			$this->ddwSellerId = $bs->popUint64_t(); // �����л��̼�ID ����Ϊuint64_t
			$this->strSellerTitle = $bs->popString(); // �����л��̼���ʵ���� ����Ϊstd::string
			$this->strSellerNick = $bs->popString(); // �����л������ǳ� ����Ϊstd::string
			$this->dwBusinessId = $bs->popUint32_t(); // �����л�ҵ��ID: 1:����ҵ��Ա��2:��Ѹҵ�� ����Ϊuint32_t
			$this->cBdealType = $bs->popUint8_t(); // �����л����׵����ͣ�1�����ﳵ��2��һ�ڼۣ�3��������4��������5��Ԥ�� ����Ϊuint8_t
			$this->dwBdealSource = $bs->popUint32_t(); // �����л��µ�������1��ҵ����վ��2���ƶ�app��3���ƶ�wap ����Ϊuint32_t
			$this->cBdealPayType = $bs->popUint8_t(); // �����л�֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6��������� ����Ϊuint8_t
			$this->dwBdealState = $bs->popUint32_t(); // �����л����׵�״̬ ����Ϊuint32_t
			$this->dwPreBdealState = $bs->popUint32_t(); // �����л����׵�ǰһ��״̬ ����Ϊuint32_t
			$this->strItemTitleList = $bs->popString(); // �����л���Ʒ�����б� ����Ϊstd::string
			$this->strItemSkuidList = $bs->popString(); // �����л���ƷskuID�б� ����Ϊstd::string
			$this->dwBdealTotalFee = $bs->popUint32_t(); // �����л����׵��ܽ�ֻ��¼�µ�ʱ�Ľ������ļ۲���䣬������Ϊ����۸����� ����Ϊuint32_t
			$this->dwBdealPayment = $bs->popUint32_t(); // �����л�ʵ���ܽ����׵�����ʵ֧��������۸������ ����Ϊuint32_t
			$this->strBdealRefer = $bs->popString(); // �����л�refer ����Ϊstd::string
			$this->strBdealIp = $bs->popString(); // �����л��µ�IP ����Ϊstd::string
			$this->strPromotionDesc = $bs->popString(); // �����л�������Ϣ���� ����Ϊstd::string
			$this->dwBdealGenTime = $bs->popUint32_t(); // �����л����׵�����ʱ�� ����Ϊuint32_t
			$this->dwBdealPayTime = $bs->popUint32_t(); // �����л����׵�����ʱ�� ����Ϊuint32_t
			$this->dwBdealEndTime = $bs->popUint32_t(); // �����л����׵�����ʱ�� ����Ϊuint32_t
			$this->strRecvName = $bs->popString(); // �����л��ջ��� ����Ϊstd::string
			$this->dwRecvRegionCode = $bs->popUint32_t(); // �����л��������� ����Ϊuint32_t
			$this->strRecvRegionCodeExt = $bs->popString(); // �����л���չ�������� ����Ϊstd::string
			$this->strRecvAddress = $bs->popString(); // �����л���ַ ����Ϊstd::string
			$this->strRecvPostCode = $bs->popString(); // �����л��ʱ� ����Ϊstd::string
			$this->strRecvPhone = $bs->popString(); // �����л��绰 ����Ϊstd::string
			$this->ddwRecvMobile = $bs->popUint64_t(); // �����л��ֻ� ����Ϊuint64_t
			$this->dwBdealFlag = $bs->popUint32_t(); // �����л����׵���� ����Ϊuint32_t
			$this->dwDelFlag = $bs->popUint32_t(); // �����л�������Ч��� ����Ϊuint32_t
			$this->dwVisibleState = $bs->popUint32_t(); // �����л��ɼ���ʶ ����Ϊuint32_t
			$this->strBdealDigest = $bs->popString(); // �����л����׵�ժҪ ����Ϊstd::string
			$this->dwLastUpdateTime = $bs->popUint32_t(); // �����л�������ʱ�� ����Ϊuint32_t
			$this->oDealInfoList = $bs->popObject('DealPoList'); // �����л������б� ����Ϊecc::deal::po::CDealPoList
			$this->oPayInfoList = $bs->popObject('PayInfoPoList'); // �����л�֧����Ϣ�� ����Ϊecc::deal::po::CPayInfoPoList
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBdealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBdealCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBusinessDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerAccount_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerNickName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerNick_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerTitle_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerNick_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBusinessId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBdealType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBdealSource_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBdealPayType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBdealState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPreBdealState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemTitleList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemSkuidList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBdealTotalFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBdealPayment_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBdealRefer_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBdealIp_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPromotionDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBdealGenTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBdealPayTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBdealEndTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvRegionCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvRegionCodeExt_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvAddress_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvPostCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvPhone_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvMobile_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBdealFlag_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDelFlag_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cVisibleState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBdealDigest_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.ecc.deal.idl.BdealPo.java

if (!class_exists('DealPoList')) {
class DealPoList
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * �����б�
		 *
		 * �汾 >= 0
		 */
		var $vecDealInfoList; //std::vector<ecc::deal::po::CDealPo> 

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushObject($this->vecDealInfoList,'stl_vector'); // ���л������б� ����Ϊstd::vector<ecc::deal::po::CDealPo> 
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealInfoList_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->vecDealInfoList = $bs->popObject('stl_vector<DealPo>'); // �����л������б� ����Ϊstd::vector<ecc::deal::po::CDealPo> 
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.ecc.deal.idl.SyncRefundReq.java

if (!class_exists('EventParamsBaseBo')) {
class EventParamsBaseBo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ���id
		 *
		 * �汾 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * ����id
		 *
		 * �汾 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * �¼�id,����ϵͳ����
		 *
		 * �汾 >= 0
		 */
		var $dwEventId; //uint32_t

		/**
		 * �����߽�ɫ
		 *
		 * �汾 >= 0
		 */
		var $dwOperatorRole; //uint32_t

		/**
		 * �¼���Դ��ҵ��������д���÷��������ļ���
		 *
		 * �汾 >= 0
		 */
		var $strEventSource; //std::string

		/**
		 * ����id
		 *
		 * �汾 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * �ӵ�id
		 *
		 * �汾 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * ��Դip
		 *
		 * �汾 >= 0
		 */
		var $strClientIp; //std::string

		/**
		 * ������
		 *
		 * �汾 >= 0
		 */
		var $strMachineKey; //std::string

		/**
		 * ������
		 *
		 * �汾 >= 0
		 */
		var $strOperatorName; //std::string

		/**
		 * �����ֶ�
		 *
		 * �汾 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cEventId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperatorRole_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cEventSource_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cClientIp_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cMachineKey_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperatorName_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * ���׵���
		 *
		 * �汾 >= 1
		 */
		var $strBdealId; //std::string

		/**
		 * 
		 *
		 * �汾 >= 1
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushUint64_t($this->ddwBuyerId); // ���л����id ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwSellerId); // ���л�����id ����Ϊuint64_t
			$bs->pushUint32_t($this->dwEventId); // ���л��¼�id,����ϵͳ���� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwOperatorRole); // ���л������߽�ɫ ����Ϊuint32_t
			$bs->pushString($this->strEventSource); // ���л��¼���Դ��ҵ��������д���÷��������ļ��� ����Ϊstd::string
			$bs->pushString($this->strDealId); // ���л�����id ����Ϊstd::string
			$bs->pushUint64_t($this->ddwTradeId); // ���л��ӵ�id ����Ϊuint64_t
			$bs->pushString($this->strClientIp); // ���л���Դip ����Ϊstd::string
			$bs->pushString($this->strMachineKey); // ���л������� ����Ϊstd::string
			$bs->pushString($this->strOperatorName); // ���л������� ����Ϊstd::string
			$bs->pushString($this->strReserve); // ���л������ֶ� ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cEventId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperatorRole_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cEventSource_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cClientIp_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cMachineKey_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperatorName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cReserve_u); // ���л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strBdealId); // ���л����׵��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cBdealId_u); // ���л� ����Ϊuint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->ddwBuyerId = $bs->popUint64_t(); // �����л����id ����Ϊuint64_t
			$this->ddwSellerId = $bs->popUint64_t(); // �����л�����id ����Ϊuint64_t
			$this->dwEventId = $bs->popUint32_t(); // �����л��¼�id,����ϵͳ���� ����Ϊuint32_t
			$this->dwOperatorRole = $bs->popUint32_t(); // �����л������߽�ɫ ����Ϊuint32_t
			$this->strEventSource = $bs->popString(); // �����л��¼���Դ��ҵ��������д���÷��������ļ��� ����Ϊstd::string
			$this->strDealId = $bs->popString(); // �����л�����id ����Ϊstd::string
			$this->ddwTradeId = $bs->popUint64_t(); // �����л��ӵ�id ����Ϊuint64_t
			$this->strClientIp = $bs->popString(); // �����л���Դip ����Ϊstd::string
			$this->strMachineKey = $bs->popString(); // �����л������� ����Ϊstd::string
			$this->strOperatorName = $bs->popString(); // �����л������� ����Ϊstd::string
			$this->strReserve = $bs->popString(); // �����л������ֶ� ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cEventId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperatorRole_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cEventSource_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cClientIp_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cMachineKey_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperatorName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cReserve_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$this->strBdealId = $bs->popString(); // �����л����׵��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cBdealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}

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


//source idl: com.ecc.deal.idl.SyncRefundReq.java

if (!class_exists('EventParamsCorpSyncRefundBo')) {
class EventParamsCorpSyncRefundBo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ������id
		 *
		 * �汾 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * �ӵ�id
		 *
		 * �汾 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * ��Ʒskuid, ���û���ӵ�����Ʒ��ά����Ϣ���ɲ���
		 *
		 * �汾 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * ����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * �˿�״̬, 1-��ʼ;2-�ͷ������;3-���˿�;4-���������;5-���񲵻س�ʼ;6-����
		 *
		 * �汾 >= 0
		 */
		var $dwRefundState; //uint32_t

		/**
		 * ����
		 *
		 * �汾 >= 0
		 */
		var $strDesc; //std::string

		/**
		 * �����ֶ�
		 *
		 * �汾 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperateTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * ҵ���˿id
		 *
		 * �汾 >= 1
		 */
		var $strBusinessRefundId; //std::string

		/**
		 * 
		 *
		 * �汾 >= 1
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushString($this->strDealId); // ���л�������id ����Ϊstd::string
			$bs->pushUint64_t($this->ddwTradeId); // ���л��ӵ�id ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwSkuId); // ���л���Ʒskuid, ���û���ӵ�����Ʒ��ά����Ϣ���ɲ��� ����Ϊuint64_t
			$bs->pushUint32_t($this->dwOperateTime); // ���л�����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRefundState); // ���л��˿�״̬, 1-��ʼ;2-�ͷ������;3-���˿�;4-���������;5-���񲵻س�ʼ;6-���� ����Ϊuint32_t
			$bs->pushString($this->strDesc); // ���л����� ����Ϊstd::string
			$bs->pushString($this->strReserve); // ���л������ֶ� ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSkuId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cReserve_u); // ���л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strBusinessRefundId); // ���л�ҵ���˿id ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cBusinessRefundId_u); // ���л� ����Ϊuint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->strDealId = $bs->popString(); // �����л�������id ����Ϊstd::string
			$this->ddwTradeId = $bs->popUint64_t(); // �����л��ӵ�id ����Ϊuint64_t
			$this->ddwSkuId = $bs->popUint64_t(); // �����л���Ʒskuid, ���û���ӵ�����Ʒ��ά����Ϣ���ɲ��� ����Ϊuint64_t
			$this->dwOperateTime = $bs->popUint32_t(); // �����л�����ʱ�� ����Ϊuint32_t
			$this->dwRefundState = $bs->popUint32_t(); // �����л��˿�״̬, 1-��ʼ;2-�ͷ������;3-���˿�;4-���������;5-���񲵻س�ʼ;6-���� ����Ϊuint32_t
			$this->strDesc = $bs->popString(); // �����л����� ����Ϊstd::string
			$this->strReserve = $bs->popString(); // �����л������ֶ� ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSkuId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cReserve_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$this->strBusinessRefundId = $bs->popString(); // �����л�ҵ���˿id ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cBusinessRefundId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}

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


//source idl: com.ecc.deal.idl.SyncPickingReq.java

if (!class_exists('EventParamsPickBo')) {
class EventParamsPickBo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * ���״̬: 1-��ʼ;2-���;3-ʧ��;
		 *
		 * �汾 >= 0
		 */
		var $dwPickState; //uint32_t

		/**
		 * ����
		 *
		 * �汾 >= 0
		 */
		var $strPickDesc; //std::string

		/**
		 * �����ֶ�
		 *
		 * �汾 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperateTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPickState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPickDesc_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwOperateTime); // ���л�����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPickState); // ���л����״̬: 1-��ʼ;2-���;3-ʧ��; ����Ϊuint32_t
			$bs->pushString($this->strPickDesc); // ���л����� ����Ϊstd::string
			$bs->pushString($this->strReserve); // ���л������ֶ� ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPickState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPickDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cReserve_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->dwOperateTime = $bs->popUint32_t(); // �����л�����ʱ�� ����Ϊuint32_t
			$this->dwPickState = $bs->popUint32_t(); // �����л����״̬: 1-��ʼ;2-���;3-ʧ��; ����Ϊuint32_t
			$this->strPickDesc = $bs->popString(); // �����л����� ����Ϊstd::string
			$this->strReserve = $bs->popString(); // �����л������ֶ� ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPickState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPickDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cReserve_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.ecc.deal.idl.SyncDealActionReq.java

if (!class_exists('SyncDealActionBo')) {
class SyncDealActionBo
{
		/**
		 * �汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ������ţ���ʽ:�������XXXXYYYY����:101041051509351702
		 *
		 * �汾 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * ��Ʒ�ӵ�ID����Ʒ�ӵ�ά�Ȳ���ʱ��д������ά�Ȳ����ɲ���
		 *
		 * �汾 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * ����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * ����ʱ�Ķ���״̬
		 *
		 * �汾 >= 0
		 */
		var $dwCurState; //uint32_t

		/**
		 * ��������: 101-������Ϣͬ��;102-ǩ��;103-��ǩ;...������ҵ�񷽲���
		 *
		 * �汾 >= 0
		 */
		var $wOperationType; //uint16_t

		/**
		 * �����ߣ����EventParamsBaseBo�е�OperatorNmae��д��ͬ
		 *
		 * �汾 >= 0
		 */
		var $strOperatorName; //std::string

		/**
		 * ���������:1-���;2-����(�ͷ�);3-ϵͳ;4-BOSS;5-֧��ϵͳ;6-API;
		 *
		 * �汾 >= 0
		 */
		var $wOperatorType; //uint16_t

		/**
		 * ���������Ƿ�ǰ̨�ɼ������OperationDescʹ�ã�ȡֵ:0-���ɼ�;1-�ɼ�
		 *
		 * �汾 >= 0
		 */
		var $cIsCanSeen; //uint8_t

		/**
		 * �������������IsCanSeenΪ�ɼ�������������ǰ����վ��ˮ��չʾ�����ܳ���1024����
		 *
		 * �汾 >= 0
		 */
		var $strOperationDesc; //std::string

		/**
		 * ϵͳ�ڲ�������ǰ̨���ɼ������ܳ���128����
		 *
		 * �汾 >= 0
		 */
		var $strSysRemark; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperateTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cCurState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperationType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperatorName_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperatorType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIsCanSeen_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperationDesc_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л��汾�� ����Ϊuint16_t
			$bs->pushString($this->strDealId); // ���л�������ţ���ʽ:�������XXXXYYYY����:101041051509351702 ����Ϊstd::string
			$bs->pushUint64_t($this->ddwTradeId); // ���л���Ʒ�ӵ�ID����Ʒ�ӵ�ά�Ȳ���ʱ��д������ά�Ȳ����ɲ��� ����Ϊuint64_t
			$bs->pushUint32_t($this->dwOperateTime); // ���л�����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwCurState); // ���л�����ʱ�Ķ���״̬ ����Ϊuint32_t
			$bs->pushUint16_t($this->wOperationType); // ���л���������: 101-������Ϣͬ��;102-ǩ��;103-��ǩ;...������ҵ�񷽲��� ����Ϊuint16_t
			$bs->pushString($this->strOperatorName); // ���л������ߣ����EventParamsBaseBo�е�OperatorNmae��д��ͬ ����Ϊstd::string
			$bs->pushUint16_t($this->wOperatorType); // ���л����������:1-���;2-����(�ͷ�);3-ϵͳ;4-BOSS;5-֧��ϵͳ;6-API; ����Ϊuint16_t
			$bs->pushUint8_t($this->cIsCanSeen); // ���л����������Ƿ�ǰ̨�ɼ������OperationDescʹ�ã�ȡֵ:0-���ɼ�;1-�ɼ� ����Ϊuint8_t
			$bs->pushString($this->strOperationDesc); // ���л��������������IsCanSeenΪ�ɼ�������������ǰ����վ��ˮ��չʾ�����ܳ���1024���� ����Ϊstd::string
			$bs->pushString($this->strSysRemark); // ���л�ϵͳ�ڲ�������ǰ̨���ɼ������ܳ���128���� ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cCurState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperationType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperatorName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperatorType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIsCanSeen_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperationDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSysRemark_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л��汾�� ����Ϊuint16_t
			$this->strDealId = $bs->popString(); // �����л�������ţ���ʽ:�������XXXXYYYY����:101041051509351702 ����Ϊstd::string
			$this->ddwTradeId = $bs->popUint64_t(); // �����л���Ʒ�ӵ�ID����Ʒ�ӵ�ά�Ȳ���ʱ��д������ά�Ȳ����ɲ��� ����Ϊuint64_t
			$this->dwOperateTime = $bs->popUint32_t(); // �����л�����ʱ�� ����Ϊuint32_t
			$this->dwCurState = $bs->popUint32_t(); // �����л�����ʱ�Ķ���״̬ ����Ϊuint32_t
			$this->wOperationType = $bs->popUint16_t(); // �����л���������: 101-������Ϣͬ��;102-ǩ��;103-��ǩ;...������ҵ�񷽲��� ����Ϊuint16_t
			$this->strOperatorName = $bs->popString(); // �����л������ߣ����EventParamsBaseBo�е�OperatorNmae��д��ͬ ����Ϊstd::string
			$this->wOperatorType = $bs->popUint16_t(); // �����л����������:1-���;2-����(�ͷ�);3-ϵͳ;4-BOSS;5-֧��ϵͳ;6-API; ����Ϊuint16_t
			$this->cIsCanSeen = $bs->popUint8_t(); // �����л����������Ƿ�ǰ̨�ɼ������OperationDescʹ�ã�ȡֵ:0-���ɼ�;1-�ɼ� ����Ϊuint8_t
			$this->strOperationDesc = $bs->popString(); // �����л��������������IsCanSeenΪ�ɼ�������������ǰ����վ��ˮ��չʾ�����ܳ���1024���� ����Ϊstd::string
			$this->strSysRemark = $bs->popString(); // �����л�ϵͳ�ڲ�������ǰ̨���ɼ������ܳ���128���� ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cCurState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperationType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperatorName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperatorType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIsCanSeen_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperationDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSysRemark_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.ecc.deal.idl.RefuseDealReq.java

if (!class_exists('EventParamsCorpSignBo')) {
class EventParamsCorpSignBo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ǩ��(��ǩ)ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwSignTime; //uint32_t

		/**
		 * ǩ��(��ǩ)����
		 *
		 * �汾 >= 0
		 */
		var $strSignDesc; //std::string

		/**
		 * ��ǩ���ӵ��б������ӵ���ǩʱ��д������ǩ�ջ�������ǩʱ�ɲ���
		 *
		 * �汾 >= 0
		 */
		var $vecRefuseTradeList; //std::vector<uint64_t> 

		/**
		 * �����ֶ�
		 *
		 * �汾 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSignTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSignDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefuseTradeList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * ��ǩ���ӵ��б������ӵ���ǩʱ��д������ǩ�ջ�������ǩʱ�ɲ���
		 *
		 * �汾 >= 1
		 */
		var $oReturnList; //ecc::deal::bo::CEventParamsCorpModifyTradeBo

		/**
		 * 
		 *
		 * �汾 >= 1
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwSignTime); // ���л�ǩ��(��ǩ)ʱ�� ����Ϊuint32_t
			$bs->pushString($this->strSignDesc); // ���л�ǩ��(��ǩ)���� ����Ϊstd::string
			$bs->pushObject($this->vecRefuseTradeList,'stl_vector'); // ���л���ǩ���ӵ��б������ӵ���ǩʱ��д������ǩ�ջ�������ǩʱ�ɲ��� ����Ϊstd::vector<uint64_t> 
			$bs->pushString($this->strReserve); // ���л������ֶ� ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSignTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSignDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefuseTradeList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cReserve_u); // ���л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushObject($this->oReturnList,'EventParamsCorpModifyTradeBo'); // ���л���ǩ���ӵ��б������ӵ���ǩʱ��д������ǩ�ջ�������ǩʱ�ɲ��� ����Ϊecc::deal::bo::CEventParamsCorpModifyTradeBo
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwReturnList_u); // ���л� ����Ϊuint32_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->dwSignTime = $bs->popUint32_t(); // �����л�ǩ��(��ǩ)ʱ�� ����Ϊuint32_t
			$this->strSignDesc = $bs->popString(); // �����л�ǩ��(��ǩ)���� ����Ϊstd::string
			$this->vecRefuseTradeList = $bs->popObject('stl_vector<uint64_t>'); // �����л���ǩ���ӵ��б������ӵ���ǩʱ��д������ǩ�ջ�������ǩʱ�ɲ��� ����Ϊstd::vector<uint64_t> 
			$this->strReserve = $bs->popString(); // �����л������ֶ� ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSignTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSignDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefuseTradeList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cReserve_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$this->oReturnList = $bs->popObject('EventParamsCorpModifyTradeBo'); // �����л���ǩ���ӵ��б������ӵ���ǩʱ��д������ǩ�ջ�������ǩʱ�ɲ��� ����Ϊecc::deal::bo::CEventParamsCorpModifyTradeBo
			}
			if(  $this->wVersion >= 1 ){
				$this->dwReturnList_u = $bs->popUint32_t(); // �����л� ����Ϊuint32_t
			}

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


//source idl: com.ecc.deal.idl.EventParamsCorpSignBo.java

if (!class_exists('EventParamsCorpModifyTradeBo')) {
class EventParamsCorpModifyTradeBo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * �ӵ�id
		 *
		 * �汾 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * �ӵ�skuid
		 *
		 * �汾 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * ��Ʒ�ӵ��ɱ��ۣ�������CostPrice_u����1ʱ����Ч
		 *
		 * �汾 >= 0
		 */
		var $dwCostPrice; //uint32_t

		/**
		 * �����ֶ�
		 *
		 * �汾 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cCostPrice_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * �˻�������������ReturnNum_u����1ʱ����Ч
		 *
		 * �汾 >= 1
		 */
		var $dwReturnNum; //uint32_t

		/**
		 * 
		 *
		 * �汾 >= 1
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushUint64_t($this->ddwTradeId); // ���л��ӵ�id ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwSkuId); // ���л��ӵ�skuid ����Ϊuint64_t
			$bs->pushUint32_t($this->dwCostPrice); // ���л���Ʒ�ӵ��ɱ��ۣ�������CostPrice_u����1ʱ����Ч ����Ϊuint32_t
			$bs->pushString($this->strReserve); // ���л������ֶ� ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSkuId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cCostPrice_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cReserve_u); // ���л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwReturnNum); // ���л��˻�������������ReturnNum_u����1ʱ����Ч ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cReturnNum_u); // ���л� ����Ϊuint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->ddwTradeId = $bs->popUint64_t(); // �����л��ӵ�id ����Ϊuint64_t
			$this->ddwSkuId = $bs->popUint64_t(); // �����л��ӵ�skuid ����Ϊuint64_t
			$this->dwCostPrice = $bs->popUint32_t(); // �����л���Ʒ�ӵ��ɱ��ۣ�������CostPrice_u����1ʱ����Ч ����Ϊuint32_t
			$this->strReserve = $bs->popString(); // �����л������ֶ� ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSkuId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cCostPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cReserve_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$this->dwReturnNum = $bs->popUint32_t(); // �����л��˻�������������ReturnNum_u����1ʱ����Ч ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cReturnNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}

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


//source idl: com.ecc.deal.idl.OperateGoodsReq.java

if (!class_exists('EventParamsModifyDealPriceBo')) {
class EventParamsModifyDealPriceBo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * �Ƿ��޸��˷ѣ��޸���1��������0�����NewShipFeeʹ��
		 *
		 * �汾 >= 0
		 */
		var $cIsShipFeeModify; //uint8_t

		/**
		 * �����˷ѣ�IsShipFeeModify���ú����
		 *
		 * �汾 >= 0
		 */
		var $dwNewShipFee; //uint32_t

		/**
		 * �Ƿ��޸Ķ������޸���1��������0�����DealAdjustFeeʹ��
		 *
		 * �汾 >= 0
		 */
		var $cIsDealFeeModify; //uint8_t

		/**
		 * ����������������ʾ�Ӽۣ�������ʾ���ۣ�IsDealFeeModify���ú����
		 *
		 * �汾 >= 0
		 */
		var $nDealAdjustFee; //int

		/**
		 * �ӵ�����޸���Ϣ
		 *
		 * �汾 >= 0
		 */
		var $vecTradePriceList; //std::vector<ecc::deal::bo::CEventParamsModifyTradePriceBo> 

		/**
		 * ���¶����ܽ�����
		 *
		 * �汾 >= 0
		 */
		var $dwNewDealTotalFee; //uint32_t

		/**
		 * ����
		 *
		 * �汾 >= 0
		 */
		var $strOperateDesc; //std::string

		/**
		 * ��������
		 *
		 * �汾 >= 0
		 */
		var $dwOrderType; //uint32_t

		/**
		 * �����ֶ�
		 *
		 * �汾 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperateTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIsShipFeeModify_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cNewShipFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIsDealFeeModify_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealAdjustFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradePriceList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cNewDealTotalFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperateDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOrderType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * ���¶����ۿ۽��
		 *
		 * �汾 >= 1
		 */
		var $dwDealDiscountAmt; //uint32_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cDealDiscountAmt_u; //uint8_t

		/**
		 * ���۽��
		 *
		 * �汾 >= 2
		 */
		var $dwSoldAmount; //uint32_t

		/**
		 * ��û���ֵ���������ͻ���
		 *
		 * �汾 >= 2
		 */
		var $dwPointObtain; //uint32_t

		/**
		 * �˷ѱ��շѣ�����
		 *
		 * �汾 >= 2
		 */
		var $dwInsuranceFee; //uint32_t

		/**
		 * ֧�����֣���λ�Ƿ�
		 *
		 * �汾 >= 2
		 */
		var $dwPointPay; //uint32_t

		/**
		 * �ֽ���֣���λ�Ƿ�
		 *
		 * �汾 >= 2
		 */
		var $dwCashScore; //uint32_t

		/**
		 * �������֣���λ�Ƿ�
		 *
		 * �汾 >= 2
		 */
		var $dwPromotionScore; //uint32_t

		/**
		 * ������
		 *
		 * �汾 >= 2
		 */
		var $dwSettlementFee; //uint32_t

		/**
		 * ֧�������ѣ���Ҫ���ڷ��ڸ��
		 *
		 * �汾 >= 2
		 */
		var $dwPayProcedure; //uint32_t

		/**
		 * �˷��Ż�
		 *
		 * �汾 >= 2
		 */
		var $dwShipFeeDiscount; //uint32_t

		/**
		 * �Ƿ���Ҫװ�����񣨼�������ˣ�
		 *
		 * �汾 >= 2
		 */
		var $cHasServiceProduct; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 2
		 */
		var $cSoldAmount_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 2
		 */
		var $cPointObtain_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 2
		 */
		var $cInsuranceFee_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 2
		 */
		var $cPointPay_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 2
		 */
		var $cCashScore_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 2
		 */
		var $cPromotionScore_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 2
		 */
		var $cSettlementFee_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 2
		 */
		var $cPayProcedure_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 2
		 */
		var $cShipFeeDiscount_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 2
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwOperateTime); // ���л�����ʱ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cIsShipFeeModify); // ���л��Ƿ��޸��˷ѣ��޸���1��������0�����NewShipFeeʹ�� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwNewShipFee); // ���л������˷ѣ�IsShipFeeModify���ú���� ����Ϊuint32_t
			$bs->pushUint8_t($this->cIsDealFeeModify); // ���л��Ƿ��޸Ķ������޸���1��������0�����DealAdjustFeeʹ�� ����Ϊuint8_t
			$bs->pushInt32_t($this->nDealAdjustFee); // ���л�����������������ʾ�Ӽۣ�������ʾ���ۣ�IsDealFeeModify���ú���� ����Ϊint
			$bs->pushObject($this->vecTradePriceList,'stl_vector'); // ���л��ӵ�����޸���Ϣ ����Ϊstd::vector<ecc::deal::bo::CEventParamsModifyTradePriceBo> 
			$bs->pushUint32_t($this->dwNewDealTotalFee); // ���л����¶����ܽ����� ����Ϊuint32_t
			$bs->pushString($this->strOperateDesc); // ���л����� ����Ϊstd::string
			$bs->pushUint32_t($this->dwOrderType); // ���л��������� ����Ϊuint32_t
			$bs->pushString($this->strReserve); // ���л������ֶ� ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIsShipFeeModify_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cNewShipFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIsDealFeeModify_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealAdjustFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradePriceList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cNewDealTotalFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperateDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOrderType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cReserve_u); // ���л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwDealDiscountAmt); // ���л����¶����ۿ۽�� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cDealDiscountAmt_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwSoldAmount); // ���л����۽�� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwPointObtain); // ���л���û���ֵ���������ͻ��� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwInsuranceFee); // ���л��˷ѱ��շѣ����� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwPointPay); // ���л�֧�����֣���λ�Ƿ� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwCashScore); // ���л��ֽ���֣���λ�Ƿ� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwPromotionScore); // ���л��������֣���λ�Ƿ� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwSettlementFee); // ���л������� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwPayProcedure); // ���л�֧�������ѣ���Ҫ���ڷ��ڸ�� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwShipFeeDiscount); // ���л��˷��Ż� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cHasServiceProduct); // ���л��Ƿ���Ҫװ�����񣨼�������ˣ� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cSoldAmount_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cPointObtain_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cInsuranceFee_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cPointPay_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cCashScore_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cPromotionScore_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cSettlementFee_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cPayProcedure_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cShipFeeDiscount_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cHasServiceProduct_u); // ���л� ����Ϊuint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->dwOperateTime = $bs->popUint32_t(); // �����л�����ʱ�� ����Ϊuint32_t
			$this->cIsShipFeeModify = $bs->popUint8_t(); // �����л��Ƿ��޸��˷ѣ��޸���1��������0�����NewShipFeeʹ�� ����Ϊuint8_t
			$this->dwNewShipFee = $bs->popUint32_t(); // �����л������˷ѣ�IsShipFeeModify���ú���� ����Ϊuint32_t
			$this->cIsDealFeeModify = $bs->popUint8_t(); // �����л��Ƿ��޸Ķ������޸���1��������0�����DealAdjustFeeʹ�� ����Ϊuint8_t
			$this->nDealAdjustFee = $bs->popInt32_t(); // �����л�����������������ʾ�Ӽۣ�������ʾ���ۣ�IsDealFeeModify���ú���� ����Ϊint
			$this->vecTradePriceList = $bs->popObject('stl_vector<EventParamsModifyTradePriceBo>'); // �����л��ӵ�����޸���Ϣ ����Ϊstd::vector<ecc::deal::bo::CEventParamsModifyTradePriceBo> 
			$this->dwNewDealTotalFee = $bs->popUint32_t(); // �����л����¶����ܽ����� ����Ϊuint32_t
			$this->strOperateDesc = $bs->popString(); // �����л����� ����Ϊstd::string
			$this->dwOrderType = $bs->popUint32_t(); // �����л��������� ����Ϊuint32_t
			$this->strReserve = $bs->popString(); // �����л������ֶ� ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIsShipFeeModify_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cNewShipFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIsDealFeeModify_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealAdjustFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradePriceList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cNewDealTotalFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperateDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOrderType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cReserve_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$this->dwDealDiscountAmt = $bs->popUint32_t(); // �����л����¶����ۿ۽�� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cDealDiscountAmt_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwSoldAmount = $bs->popUint32_t(); // �����л����۽�� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwPointObtain = $bs->popUint32_t(); // �����л���û���ֵ���������ͻ��� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwInsuranceFee = $bs->popUint32_t(); // �����л��˷ѱ��շѣ����� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwPointPay = $bs->popUint32_t(); // �����л�֧�����֣���λ�Ƿ� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwCashScore = $bs->popUint32_t(); // �����л��ֽ���֣���λ�Ƿ� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwPromotionScore = $bs->popUint32_t(); // �����л��������֣���λ�Ƿ� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwSettlementFee = $bs->popUint32_t(); // �����л������� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwPayProcedure = $bs->popUint32_t(); // �����л�֧�������ѣ���Ҫ���ڷ��ڸ�� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwShipFeeDiscount = $bs->popUint32_t(); // �����л��˷��Ż� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cHasServiceProduct = $bs->popUint8_t(); // �����л��Ƿ���Ҫװ�����񣨼�������ˣ� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cSoldAmount_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cPointObtain_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cInsuranceFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cPointPay_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cCashScore_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cPromotionScore_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cSettlementFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cPayProcedure_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cShipFeeDiscount_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cHasServiceProduct_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}

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


//source idl: com.ecc.deal.idl.EventParamsModifyDealPriceBo.java

if (!class_exists('EventParamsModifyTradePriceBo')) {
class EventParamsModifyTradePriceBo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * �ӵ�id
		 *
		 * �汾 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * �ӵ�skuid
		 *
		 * �汾 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * �Ƿ��޸���Ʒ�������޸���1��������0�����NewBuyNumʹ��
		 *
		 * �汾 >= 0
		 */
		var $cIsBuyNumModify; //uint8_t

		/**
		 * ������Ʒ������IsBuyNumModify���ú����
		 *
		 * �汾 >= 0
		 */
		var $dwNewBuyNum; //uint32_t

		/**
		 * �Ƿ��޸��ӵ����޸���1��������0�����TradeAdjustFeeʹ��
		 *
		 * �汾 >= 0
		 */
		var $cIsTradeFeeModify; //uint8_t

		/**
		 * ����������������ʾ�Ӽۣ�������ʾ���ۣ�IsTradeFeeModify���ú����
		 *
		 * �汾 >= 0
		 */
		var $nTradeAdjustFee; //int

		/**
		 * �����ӵ��ܽ�����
		 *
		 * �汾 >= 0
		 */
		var $dwNewTradeTotalFee; //uint32_t

		/**
		 * �����ֶ�
		 *
		 * �汾 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIsBuyNumModify_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cNewBuyNum_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIsTradeFeeModify_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeAdjustFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cNewTradeTotalFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * ��Ʒ�۸񣬱���
		 *
		 * �汾 >= 1
		 */
		var $dwPrice; //uint32_t

		/**
		 * �ɱ��ۣ�����
		 *
		 * �汾 >= 1
		 */
		var $dwCostPrice; //uint32_t

		/**
		 * �ۿ۽��
		 *
		 * �汾 >= 1
		 */
		var $dwTradeDiscountAmt; //uint32_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cPrice_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cCostPrice_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushUint64_t($this->ddwTradeId); // ���л��ӵ�id ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwSkuId); // ���л��ӵ�skuid ����Ϊuint64_t
			$bs->pushUint8_t($this->cIsBuyNumModify); // ���л��Ƿ��޸���Ʒ�������޸���1��������0�����NewBuyNumʹ�� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwNewBuyNum); // ���л�������Ʒ������IsBuyNumModify���ú���� ����Ϊuint32_t
			$bs->pushUint8_t($this->cIsTradeFeeModify); // ���л��Ƿ��޸��ӵ����޸���1��������0�����TradeAdjustFeeʹ�� ����Ϊuint8_t
			$bs->pushInt32_t($this->nTradeAdjustFee); // ���л�����������������ʾ�Ӽۣ�������ʾ���ۣ�IsTradeFeeModify���ú���� ����Ϊint
			$bs->pushUint32_t($this->dwNewTradeTotalFee); // ���л������ӵ��ܽ����� ����Ϊuint32_t
			$bs->pushString($this->strReserve); // ���л������ֶ� ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSkuId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIsBuyNumModify_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cNewBuyNum_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIsTradeFeeModify_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeAdjustFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cNewTradeTotalFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cReserve_u); // ���л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwPrice); // ���л���Ʒ�۸񣬱��� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwCostPrice); // ���л��ɱ��ۣ����� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwTradeDiscountAmt); // ���л��ۿ۽�� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cPrice_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cCostPrice_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cTradeDiscountAmt_u); // ���л� ����Ϊuint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->ddwTradeId = $bs->popUint64_t(); // �����л��ӵ�id ����Ϊuint64_t
			$this->ddwSkuId = $bs->popUint64_t(); // �����л��ӵ�skuid ����Ϊuint64_t
			$this->cIsBuyNumModify = $bs->popUint8_t(); // �����л��Ƿ��޸���Ʒ�������޸���1��������0�����NewBuyNumʹ�� ����Ϊuint8_t
			$this->dwNewBuyNum = $bs->popUint32_t(); // �����л�������Ʒ������IsBuyNumModify���ú���� ����Ϊuint32_t
			$this->cIsTradeFeeModify = $bs->popUint8_t(); // �����л��Ƿ��޸��ӵ����޸���1��������0�����TradeAdjustFeeʹ�� ����Ϊuint8_t
			$this->nTradeAdjustFee = $bs->popInt32_t(); // �����л�����������������ʾ�Ӽۣ�������ʾ���ۣ�IsTradeFeeModify���ú���� ����Ϊint
			$this->dwNewTradeTotalFee = $bs->popUint32_t(); // �����л������ӵ��ܽ����� ����Ϊuint32_t
			$this->strReserve = $bs->popString(); // �����л������ֶ� ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSkuId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIsBuyNumModify_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cNewBuyNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIsTradeFeeModify_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeAdjustFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cNewTradeTotalFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cReserve_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$this->dwPrice = $bs->popUint32_t(); // �����л���Ʒ�۸񣬱��� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->dwCostPrice = $bs->popUint32_t(); // �����л��ɱ��ۣ����� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->dwTradeDiscountAmt = $bs->popUint32_t(); // �����л��ۿ۽�� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cCostPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cTradeDiscountAmt_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}

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


//source idl: com.ecc.deal.idl.OperateGoodsReq.java

if (!class_exists('EventParamsOperGoodsBo')) {
class EventParamsOperGoodsBo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * ������Ʒ�б�
		 *
		 * �汾 >= 0
		 */
		var $vecAddList; //std::vector<ecc::deal::bo::CEventParamsAddGoodsBo> 

		/**
		 * ɾ����Ʒ�б�
		 *
		 * �汾 >= 0
		 */
		var $vecRemoveList; //std::vector<ecc::deal::bo::CEventParamsRemoveGoodsBo> 

		/**
		 * ����
		 *
		 * �汾 >= 0
		 */
		var $strOperateDesc; //std::string

		/**
		 * �����ֶ�
		 *
		 * �汾 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperateTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cAddList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRemoveList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperateDesc_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwOperateTime); // ���л�����ʱ�� ����Ϊuint32_t
			$bs->pushObject($this->vecAddList,'stl_vector'); // ���л�������Ʒ�б� ����Ϊstd::vector<ecc::deal::bo::CEventParamsAddGoodsBo> 
			$bs->pushObject($this->vecRemoveList,'stl_vector'); // ���л�ɾ����Ʒ�б� ����Ϊstd::vector<ecc::deal::bo::CEventParamsRemoveGoodsBo> 
			$bs->pushString($this->strOperateDesc); // ���л����� ����Ϊstd::string
			$bs->pushString($this->strReserve); // ���л������ֶ� ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cAddList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRemoveList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperateDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cReserve_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->dwOperateTime = $bs->popUint32_t(); // �����л�����ʱ�� ����Ϊuint32_t
			$this->vecAddList = $bs->popObject('stl_vector<EventParamsAddGoodsBo>'); // �����л�������Ʒ�б� ����Ϊstd::vector<ecc::deal::bo::CEventParamsAddGoodsBo> 
			$this->vecRemoveList = $bs->popObject('stl_vector<EventParamsRemoveGoodsBo>'); // �����л�ɾ����Ʒ�б� ����Ϊstd::vector<ecc::deal::bo::CEventParamsRemoveGoodsBo> 
			$this->strOperateDesc = $bs->popString(); // �����л����� ����Ϊstd::string
			$this->strReserve = $bs->popString(); // �����л������ֶ� ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cAddList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRemoveList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperateDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cReserve_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.ecc.deal.idl.EventParamsOperGoodsBo.java

if (!class_exists('EventParamsAddGoodsBo')) {
class EventParamsAddGoodsBo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ��Ʒ���ͣ�1����ͨ��Ʒ��2���ײ�����Ʒ��3���ײ͸���Ʒ��4����Ʒ����Ʒ��5����Ʒ����Ʒ��6�����
		 *
		 * �汾 >= 0
		 */
		var $dwItemType; //uint32_t

		/**
		 * Ʒ�ࣨ��Ŀ��ID
		 *
		 * �汾 >= 0
		 */
		var $dwItemClassId; //uint32_t

		/**
		 * ��Ʒ����
		 *
		 * �汾 >= 0
		 */
		var $strItemTitle; //std::string

		/**
		 * ��Ʒ�������Ա���
		 *
		 * �汾 >= 0
		 */
		var $strItemAttrCode; //std::string

		/**
		 * ��Ʒ������������
		 *
		 * �汾 >= 0
		 */
		var $strItemAttr; //std::string

		/**
		 * ��Ʒ��ʾID����ҵ����
		 *
		 * �汾 >= 0
		 */
		var $strItemId; //std::string

		/**
		 * ��ƷSKUID
		 *
		 * �汾 >= 0
		 */
		var $ddwItemSkuId; //uint64_t

		/**
		 * ��Ʒ�̼ұ��ر���
		 *
		 * �汾 >= 0
		 */
		var $strItemLocalCode; //std::string

		/**
		 * ��Ʒ�̼ұ��ؿ�����
		 *
		 * �汾 >= 0
		 */
		var $strItemLocalStockCode; //std::string

		/**
		 * ��Ʒ������
		 *
		 * �汾 >= 0
		 */
		var $strItemBarCode; //std::string

		/**
		 * ��Ʒ���ID
		 *
		 * �汾 >= 0
		 */
		var $ddwItemStockId; //uint64_t

		/**
		 * ��Ʒ�ֿ�ID
		 *
		 * �汾 >= 0
		 */
		var $dwItemStoreHouseId; //uint32_t

		/**
		 * ��Ʒ���������
		 *
		 * �汾 >= 0
		 */
		var $strItemPhyisicalStorage; //std::string

		/**
		 * ��ƷͼƬLogo��ҵ���Զ���
		 *
		 * �汾 >= 0
		 */
		var $strItemLogo; //std::string

		/**
		 * ��Ʒ���հ汾��
		 *
		 * �汾 >= 0
		 */
		var $dwItemSnapVersion; //uint32_t

		/**
		 * ��Ʒ����ʱ���
		 *
		 * �汾 >= 0
		 */
		var $dwItemResetTime; //uint32_t

		/**
		 * ��Ʒ����
		 *
		 * �汾 >= 0
		 */
		var $dwItemWeight; //uint32_t

		/**
		 * ��Ʒ���
		 *
		 * �汾 >= 0
		 */
		var $dwItemVolume; //uint32_t

		/**
		 * ��Ʒ�ײ�����ƷID
		 *
		 * �汾 >= 0
		 */
		var $ddwMainItemId; //uint64_t

		/**
		 * ��Ʒ����˵��
		 *
		 * �汾 >= 0
		 */
		var $strItemAccessoryDesc; //std::string

		/**
		 * ��Ʒ�ɱ���
		 *
		 * �汾 >= 0
		 */
		var $dwItemCostPrice; //uint32_t

		/**
		 * ��Ʒ�г���
		 *
		 * �汾 >= 0
		 */
		var $dwItemOriginPrice; //uint32_t

		/**
		 * ��Ʒ���۵���
		 *
		 * �汾 >= 0
		 */
		var $dwItemSoldPrice; //uint32_t

		/**
		 * ��ӪB2C�г�
		 *
		 * �汾 >= 0
		 */
		var $strItemB2CMarket; //std::string

		/**
		 * ��ӪB2CPM
		 *
		 * �汾 >= 0
		 */
		var $strItemB2CPM; //std::string

		/**
		 * ��ӪB2C�Ƿ�ռ�����
		 *
		 * �汾 >= 0
		 */
		var $cItemUseVirtualStock; //uint8_t

		/**
		 * ��Ʒ�ɽ���
		 *
		 * �汾 >= 0
		 */
		var $dwBuyPrice; //uint32_t

		/**
		 * ��Ʒ�ɽ�����
		 *
		 * �汾 >= 0
		 */
		var $dwBuyNum; //uint32_t

		/**
		 * ��Ʒ���ܽ��,�µ����
		 *
		 * �汾 >= 0
		 */
		var $dwTradeTotalFee; //uint32_t

		/**
		 * ��Ʒ�����۽��
		 *
		 * �汾 >= 0
		 */
		var $nTradeAdjustFee; //int

		/**
		 * ʵ���ܽ��
		 *
		 * �汾 >= 0
		 */
		var $dwTradePayment; //uint32_t

		/**
		 * �Ż��ܽ��
		 *
		 * �汾 >= 0
		 */
		var $nTradeDiscountTotal; //int

		/**
		 * ����֧��ֵ
		 *
		 * �汾 >= 0
		 */
		var $dwPayScore; //uint32_t

		/**
		 * ��Ʒ�����������к�
		 *
		 * �汾 >= 0
		 */
		var $wTradeOpSerialNo; //uint16_t

		/**
		 * ��û���ֵ
		 *
		 * �汾 >= 0
		 */
		var $dwObtainScore; //uint32_t

		/**
		 * ͨ������ֵ
		 *
		 * �汾 >= 0
		 */
		var $dwTradeCommProperty; //uint32_t

		/**
		 * ҵ������ֵ
		 *
		 * �汾 >= 0
		 */
		var $dwTradeBusinessProperty; //uint32_t

		/**
		 * ��������
		 *
		 * �汾 >= 0
		 */
		var $strWarranty; //std::string

		/**
		 * ��Ѹedm����
		 *
		 * �汾 >= 0
		 */
		var $strIcsonEdmCode; //std::string

		/**
		 * ��ѸOTag
		 *
		 * �汾 >= 0
		 */
		var $strIcsonOTag; //std::string

		/**
		 * ��Ѹ���̵�������
		 *
		 * �汾 >= 0
		 */
		var $strIcsonTradeShopGuideCost; //std::string

		/**
		 * ��Ѹ���ƻ�����
		 *
		 * �汾 >= 0
		 */
		var $strIcsonCSPhoneType; //std::string

		/**
		 * ��Ѹ���ƻ���Ӫ��
		 *
		 * �汾 >= 0
		 */
		var $strIcsonCSPhoneOperator; //std::string

		/**
		 * ��Ѹ���ƻ�����
		 *
		 * �汾 >= 0
		 */
		var $strIcsonCSPhoneNumber; //std::string

		/**
		 * ��Ѹ���ƻ�������
		 *
		 * �汾 >= 0
		 */
		var $strIcsonCSPhoneArea; //std::string

		/**
		 * ��Ѹ���ƻ��ײ�id
		 *
		 * �汾 >= 0
		 */
		var $strIcsonCSPhonePackageId; //std::string

		/**
		 * ��Ѹ���ƻ��û�����
		 *
		 * �汾 >= 0
		 */
		var $strIcsonCSPhoneUserName; //std::string

		/**
		 * ��Ѹ���ƻ��û���ַ
		 *
		 * �汾 >= 0
		 */
		var $strIcsonCSPhoneUserAddr; //std::string

		/**
		 * ��Ѹ���ƻ��û���ϵ�ֻ�
		 *
		 * �汾 >= 0
		 */
		var $strIcsonCSPhoneUserMobile; //std::string

		/**
		 * ��Ѹ���ƻ��û���ϵ�绰
		 *
		 * �汾 >= 0
		 */
		var $strIcsonCSPhoneUserTel; //std::string

		/**
		 * ��Ѹ���ƻ����֤����
		 *
		 * �汾 >= 0
		 */
		var $strIcsonCSPhoneIdCardNo; //std::string

		/**
		 * ��Ѹ���ƻ����֤��ַ
		 *
		 * �汾 >= 0
		 */
		var $strIcsonCSPhoneIdCardAddr; //std::string

		/**
		 * ��Ѹ���ƻ����֤��Ч��
		 *
		 * �汾 >= 0
		 */
		var $strIcsonCSPhoneIdCardDate; //std::string

		/**
		 * ��Ѹ���ƻ���������
		 *
		 * �汾 >= 0
		 */
		var $strIcsonCSPhoneZipCode; //std::string

		/**
		 * ��Ѹ���ƻ����۸�
		 *
		 * �汾 >= 0
		 */
		var $strIcsonCSPhoneCardPrice; //std::string

		/**
		 * ��Ѹ���ƻ��ײͼ۸�
		 *
		 * �汾 >= 0
		 */
		var $strIcsonCSPhonePackagePrice; //std::string

		/**
		 * �����ֶ�
		 *
		 * �汾 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemClassId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemTitle_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemAttrCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemAttr_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemSkuId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemLocalCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemLocalStockCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemBarCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemStockId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemStoreHouseId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemPhyisicalStorage_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemLogo_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemSnapVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemResetTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemWeight_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemVolume_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cMainItemId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemAccessoryDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemCostPrice_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemOriginPrice_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemSoldPrice_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemB2CMarket_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemB2CPM_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemUseVirtualStock_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyPrice_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyNum_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeTotalFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeAdjustFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradePayment_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeDiscountTotal_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayScore_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeOpSerialNo_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cObtainScore_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeCommProperty_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeBusinessProperty_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cWarranty_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIcsonEdmCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIcsonOTag_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIcsonTradeShopGuideCost_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIcsonCSPhoneType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIcsonCSPhoneOperator_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIcsonCSPhoneNumber_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIcsonCSPhoneArea_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIcsonCSPhonePackageId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIcsonCSPhoneUserName_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIcsonCSPhoneUserAddr_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIcsonCSPhoneUserMobile_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIcsonCSPhoneUserTel_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIcsonCSPhoneIdCardNo_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIcsonCSPhoneIdCardAddr_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIcsonCSPhoneIdCardDate_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIcsonCSPhoneZipCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIcsonCSPhoneCardPrice_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cIcsonCSPhonePackagePrice_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * ��Ʒid
		 *
		 * �汾 >= 1
		 */
		var $ddwProductId; //uint64_t

		/**
		 * ��Ʒid����
		 *
		 * �汾 >= 1
		 */
		var $strProductCode; //std::string

		/**
		 * ��Ѹ��Ʒ�ӵ�flag
		 *
		 * �汾 >= 1
		 */
		var $strIcsonTradeFlag; //std::string

		/**
		 * ��Ѹ���ֶһ�����
		 *
		 * �汾 >= 1
		 */
		var $strIcsonPointType; //std::string

		/**
		 * �ӵ����ֽ��
		 *
		 * �汾 >= 1
		 */
		var $dwIcsonTradeCashBack; //uint32_t

		/**
		 * ȥ˰��ɱ�
		 *
		 * �汾 >= 1
		 */
		var $strIcsonUnitCostInvoice; //std::string

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cProductId_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cProductCode_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonTradeFlag_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonPointType_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonTradeCashBack_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwItemType); // ���л���Ʒ���ͣ�1����ͨ��Ʒ��2���ײ�����Ʒ��3���ײ͸���Ʒ��4����Ʒ����Ʒ��5����Ʒ����Ʒ��6����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwItemClassId); // ���л�Ʒ�ࣨ��Ŀ��ID ����Ϊuint32_t
			$bs->pushString($this->strItemTitle); // ���л���Ʒ���� ����Ϊstd::string
			$bs->pushString($this->strItemAttrCode); // ���л���Ʒ�������Ա��� ����Ϊstd::string
			$bs->pushString($this->strItemAttr); // ���л���Ʒ������������ ����Ϊstd::string
			$bs->pushString($this->strItemId); // ���л���Ʒ��ʾID����ҵ���� ����Ϊstd::string
			$bs->pushUint64_t($this->ddwItemSkuId); // ���л���ƷSKUID ����Ϊuint64_t
			$bs->pushString($this->strItemLocalCode); // ���л���Ʒ�̼ұ��ر��� ����Ϊstd::string
			$bs->pushString($this->strItemLocalStockCode); // ���л���Ʒ�̼ұ��ؿ����� ����Ϊstd::string
			$bs->pushString($this->strItemBarCode); // ���л���Ʒ������ ����Ϊstd::string
			$bs->pushUint64_t($this->ddwItemStockId); // ���л���Ʒ���ID ����Ϊuint64_t
			$bs->pushUint32_t($this->dwItemStoreHouseId); // ���л���Ʒ�ֿ�ID ����Ϊuint32_t
			$bs->pushString($this->strItemPhyisicalStorage); // ���л���Ʒ��������� ����Ϊstd::string
			$bs->pushString($this->strItemLogo); // ���л���ƷͼƬLogo��ҵ���Զ��� ����Ϊstd::string
			$bs->pushUint32_t($this->dwItemSnapVersion); // ���л���Ʒ���հ汾�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwItemResetTime); // ���л���Ʒ����ʱ��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwItemWeight); // ���л���Ʒ���� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwItemVolume); // ���л���Ʒ��� ����Ϊuint32_t
			$bs->pushUint64_t($this->ddwMainItemId); // ���л���Ʒ�ײ�����ƷID ����Ϊuint64_t
			$bs->pushString($this->strItemAccessoryDesc); // ���л���Ʒ����˵�� ����Ϊstd::string
			$bs->pushUint32_t($this->dwItemCostPrice); // ���л���Ʒ�ɱ��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwItemOriginPrice); // ���л���Ʒ�г��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwItemSoldPrice); // ���л���Ʒ���۵��� ����Ϊuint32_t
			$bs->pushString($this->strItemB2CMarket); // ���л���ӪB2C�г� ����Ϊstd::string
			$bs->pushString($this->strItemB2CPM); // ���л���ӪB2CPM ����Ϊstd::string
			$bs->pushUint8_t($this->cItemUseVirtualStock); // ���л���ӪB2C�Ƿ�ռ����� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwBuyPrice); // ���л���Ʒ�ɽ��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwBuyNum); // ���л���Ʒ�ɽ����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeTotalFee); // ���л���Ʒ���ܽ��,�µ���� ����Ϊuint32_t
			$bs->pushInt32_t($this->nTradeAdjustFee); // ���л���Ʒ�����۽�� ����Ϊint
			$bs->pushUint32_t($this->dwTradePayment); // ���л�ʵ���ܽ�� ����Ϊuint32_t
			$bs->pushInt32_t($this->nTradeDiscountTotal); // ���л��Ż��ܽ�� ����Ϊint
			$bs->pushUint32_t($this->dwPayScore); // ���л�����֧��ֵ ����Ϊuint32_t
			$bs->pushUint16_t($this->wTradeOpSerialNo); // ���л���Ʒ�����������к� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwObtainScore); // ���л���û���ֵ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeCommProperty); // ���л�ͨ������ֵ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeBusinessProperty); // ���л�ҵ������ֵ ����Ϊuint32_t
			$bs->pushString($this->strWarranty); // ���л��������� ����Ϊstd::string
			$bs->pushString($this->strIcsonEdmCode); // ���л���Ѹedm���� ����Ϊstd::string
			$bs->pushString($this->strIcsonOTag); // ���л���ѸOTag ����Ϊstd::string
			$bs->pushString($this->strIcsonTradeShopGuideCost); // ���л���Ѹ���̵������� ����Ϊstd::string
			$bs->pushString($this->strIcsonCSPhoneType); // ���л���Ѹ���ƻ����� ����Ϊstd::string
			$bs->pushString($this->strIcsonCSPhoneOperator); // ���л���Ѹ���ƻ���Ӫ�� ����Ϊstd::string
			$bs->pushString($this->strIcsonCSPhoneNumber); // ���л���Ѹ���ƻ����� ����Ϊstd::string
			$bs->pushString($this->strIcsonCSPhoneArea); // ���л���Ѹ���ƻ������� ����Ϊstd::string
			$bs->pushString($this->strIcsonCSPhonePackageId); // ���л���Ѹ���ƻ��ײ�id ����Ϊstd::string
			$bs->pushString($this->strIcsonCSPhoneUserName); // ���л���Ѹ���ƻ��û����� ����Ϊstd::string
			$bs->pushString($this->strIcsonCSPhoneUserAddr); // ���л���Ѹ���ƻ��û���ַ ����Ϊstd::string
			$bs->pushString($this->strIcsonCSPhoneUserMobile); // ���л���Ѹ���ƻ��û���ϵ�ֻ� ����Ϊstd::string
			$bs->pushString($this->strIcsonCSPhoneUserTel); // ���л���Ѹ���ƻ��û���ϵ�绰 ����Ϊstd::string
			$bs->pushString($this->strIcsonCSPhoneIdCardNo); // ���л���Ѹ���ƻ����֤���� ����Ϊstd::string
			$bs->pushString($this->strIcsonCSPhoneIdCardAddr); // ���л���Ѹ���ƻ����֤��ַ ����Ϊstd::string
			$bs->pushString($this->strIcsonCSPhoneIdCardDate); // ���л���Ѹ���ƻ����֤��Ч�� ����Ϊstd::string
			$bs->pushString($this->strIcsonCSPhoneZipCode); // ���л���Ѹ���ƻ��������� ����Ϊstd::string
			$bs->pushString($this->strIcsonCSPhoneCardPrice); // ���л���Ѹ���ƻ����۸� ����Ϊstd::string
			$bs->pushString($this->strIcsonCSPhonePackagePrice); // ���л���Ѹ���ƻ��ײͼ۸� ����Ϊstd::string
			$bs->pushString($this->strReserve); // ���л������ֶ� ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemClassId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemTitle_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemAttrCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemAttr_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemSkuId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemLocalCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemLocalStockCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemBarCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemStockId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemStoreHouseId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemPhyisicalStorage_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemLogo_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemSnapVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemResetTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemWeight_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemVolume_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cMainItemId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemAccessoryDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemCostPrice_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemOriginPrice_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemSoldPrice_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemB2CMarket_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemB2CPM_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemUseVirtualStock_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyPrice_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyNum_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeTotalFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeAdjustFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradePayment_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeDiscountTotal_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayScore_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeOpSerialNo_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cObtainScore_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeCommProperty_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeBusinessProperty_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cWarranty_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIcsonEdmCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIcsonOTag_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIcsonTradeShopGuideCost_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneOperator_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneNumber_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneArea_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIcsonCSPhonePackageId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneUserName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneUserAddr_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneUserMobile_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneUserTel_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneIdCardNo_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneIdCardAddr_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneIdCardDate_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneZipCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIcsonCSPhoneCardPrice_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cIcsonCSPhonePackagePrice_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cReserve_u); // ���л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushUint64_t($this->ddwProductId); // ���л���Ʒid ����Ϊuint64_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strProductCode); // ���л���Ʒid���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonTradeFlag); // ���л���Ѹ��Ʒ�ӵ�flag ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonPointType); // ���л���Ѹ���ֶһ����� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwIcsonTradeCashBack); // ���л��ӵ����ֽ�� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonUnitCostInvoice); // ���л�ȥ˰��ɱ� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cProductId_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cProductCode_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonTradeFlag_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonPointType_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonTradeCashBack_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonUnitCostInvoice_u); // ���л� ����Ϊuint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->dwItemType = $bs->popUint32_t(); // �����л���Ʒ���ͣ�1����ͨ��Ʒ��2���ײ�����Ʒ��3���ײ͸���Ʒ��4����Ʒ����Ʒ��5����Ʒ����Ʒ��6����� ����Ϊuint32_t
			$this->dwItemClassId = $bs->popUint32_t(); // �����л�Ʒ�ࣨ��Ŀ��ID ����Ϊuint32_t
			$this->strItemTitle = $bs->popString(); // �����л���Ʒ���� ����Ϊstd::string
			$this->strItemAttrCode = $bs->popString(); // �����л���Ʒ�������Ա��� ����Ϊstd::string
			$this->strItemAttr = $bs->popString(); // �����л���Ʒ������������ ����Ϊstd::string
			$this->strItemId = $bs->popString(); // �����л���Ʒ��ʾID����ҵ���� ����Ϊstd::string
			$this->ddwItemSkuId = $bs->popUint64_t(); // �����л���ƷSKUID ����Ϊuint64_t
			$this->strItemLocalCode = $bs->popString(); // �����л���Ʒ�̼ұ��ر��� ����Ϊstd::string
			$this->strItemLocalStockCode = $bs->popString(); // �����л���Ʒ�̼ұ��ؿ����� ����Ϊstd::string
			$this->strItemBarCode = $bs->popString(); // �����л���Ʒ������ ����Ϊstd::string
			$this->ddwItemStockId = $bs->popUint64_t(); // �����л���Ʒ���ID ����Ϊuint64_t
			$this->dwItemStoreHouseId = $bs->popUint32_t(); // �����л���Ʒ�ֿ�ID ����Ϊuint32_t
			$this->strItemPhyisicalStorage = $bs->popString(); // �����л���Ʒ��������� ����Ϊstd::string
			$this->strItemLogo = $bs->popString(); // �����л���ƷͼƬLogo��ҵ���Զ��� ����Ϊstd::string
			$this->dwItemSnapVersion = $bs->popUint32_t(); // �����л���Ʒ���հ汾�� ����Ϊuint32_t
			$this->dwItemResetTime = $bs->popUint32_t(); // �����л���Ʒ����ʱ��� ����Ϊuint32_t
			$this->dwItemWeight = $bs->popUint32_t(); // �����л���Ʒ���� ����Ϊuint32_t
			$this->dwItemVolume = $bs->popUint32_t(); // �����л���Ʒ��� ����Ϊuint32_t
			$this->ddwMainItemId = $bs->popUint64_t(); // �����л���Ʒ�ײ�����ƷID ����Ϊuint64_t
			$this->strItemAccessoryDesc = $bs->popString(); // �����л���Ʒ����˵�� ����Ϊstd::string
			$this->dwItemCostPrice = $bs->popUint32_t(); // �����л���Ʒ�ɱ��� ����Ϊuint32_t
			$this->dwItemOriginPrice = $bs->popUint32_t(); // �����л���Ʒ�г��� ����Ϊuint32_t
			$this->dwItemSoldPrice = $bs->popUint32_t(); // �����л���Ʒ���۵��� ����Ϊuint32_t
			$this->strItemB2CMarket = $bs->popString(); // �����л���ӪB2C�г� ����Ϊstd::string
			$this->strItemB2CPM = $bs->popString(); // �����л���ӪB2CPM ����Ϊstd::string
			$this->cItemUseVirtualStock = $bs->popUint8_t(); // �����л���ӪB2C�Ƿ�ռ����� ����Ϊuint8_t
			$this->dwBuyPrice = $bs->popUint32_t(); // �����л���Ʒ�ɽ��� ����Ϊuint32_t
			$this->dwBuyNum = $bs->popUint32_t(); // �����л���Ʒ�ɽ����� ����Ϊuint32_t
			$this->dwTradeTotalFee = $bs->popUint32_t(); // �����л���Ʒ���ܽ��,�µ���� ����Ϊuint32_t
			$this->nTradeAdjustFee = $bs->popInt32_t(); // �����л���Ʒ�����۽�� ����Ϊint
			$this->dwTradePayment = $bs->popUint32_t(); // �����л�ʵ���ܽ�� ����Ϊuint32_t
			$this->nTradeDiscountTotal = $bs->popInt32_t(); // �����л��Ż��ܽ�� ����Ϊint
			$this->dwPayScore = $bs->popUint32_t(); // �����л�����֧��ֵ ����Ϊuint32_t
			$this->wTradeOpSerialNo = $bs->popUint16_t(); // �����л���Ʒ�����������к� ����Ϊuint16_t
			$this->dwObtainScore = $bs->popUint32_t(); // �����л���û���ֵ ����Ϊuint32_t
			$this->dwTradeCommProperty = $bs->popUint32_t(); // �����л�ͨ������ֵ ����Ϊuint32_t
			$this->dwTradeBusinessProperty = $bs->popUint32_t(); // �����л�ҵ������ֵ ����Ϊuint32_t
			$this->strWarranty = $bs->popString(); // �����л��������� ����Ϊstd::string
			$this->strIcsonEdmCode = $bs->popString(); // �����л���Ѹedm���� ����Ϊstd::string
			$this->strIcsonOTag = $bs->popString(); // �����л���ѸOTag ����Ϊstd::string
			$this->strIcsonTradeShopGuideCost = $bs->popString(); // �����л���Ѹ���̵������� ����Ϊstd::string
			$this->strIcsonCSPhoneType = $bs->popString(); // �����л���Ѹ���ƻ����� ����Ϊstd::string
			$this->strIcsonCSPhoneOperator = $bs->popString(); // �����л���Ѹ���ƻ���Ӫ�� ����Ϊstd::string
			$this->strIcsonCSPhoneNumber = $bs->popString(); // �����л���Ѹ���ƻ����� ����Ϊstd::string
			$this->strIcsonCSPhoneArea = $bs->popString(); // �����л���Ѹ���ƻ������� ����Ϊstd::string
			$this->strIcsonCSPhonePackageId = $bs->popString(); // �����л���Ѹ���ƻ��ײ�id ����Ϊstd::string
			$this->strIcsonCSPhoneUserName = $bs->popString(); // �����л���Ѹ���ƻ��û����� ����Ϊstd::string
			$this->strIcsonCSPhoneUserAddr = $bs->popString(); // �����л���Ѹ���ƻ��û���ַ ����Ϊstd::string
			$this->strIcsonCSPhoneUserMobile = $bs->popString(); // �����л���Ѹ���ƻ��û���ϵ�ֻ� ����Ϊstd::string
			$this->strIcsonCSPhoneUserTel = $bs->popString(); // �����л���Ѹ���ƻ��û���ϵ�绰 ����Ϊstd::string
			$this->strIcsonCSPhoneIdCardNo = $bs->popString(); // �����л���Ѹ���ƻ����֤���� ����Ϊstd::string
			$this->strIcsonCSPhoneIdCardAddr = $bs->popString(); // �����л���Ѹ���ƻ����֤��ַ ����Ϊstd::string
			$this->strIcsonCSPhoneIdCardDate = $bs->popString(); // �����л���Ѹ���ƻ����֤��Ч�� ����Ϊstd::string
			$this->strIcsonCSPhoneZipCode = $bs->popString(); // �����л���Ѹ���ƻ��������� ����Ϊstd::string
			$this->strIcsonCSPhoneCardPrice = $bs->popString(); // �����л���Ѹ���ƻ����۸� ����Ϊstd::string
			$this->strIcsonCSPhonePackagePrice = $bs->popString(); // �����л���Ѹ���ƻ��ײͼ۸� ����Ϊstd::string
			$this->strReserve = $bs->popString(); // �����л������ֶ� ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemClassId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemTitle_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemAttrCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemAttr_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemSkuId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemLocalCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemLocalStockCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemBarCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemStockId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemStoreHouseId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemPhyisicalStorage_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemLogo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemSnapVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemResetTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemWeight_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemVolume_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cMainItemId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemAccessoryDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemCostPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemOriginPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemSoldPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemB2CMarket_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemB2CPM_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemUseVirtualStock_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeTotalFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeAdjustFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradePayment_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeDiscountTotal_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayScore_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeOpSerialNo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cObtainScore_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeCommProperty_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeBusinessProperty_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cWarranty_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIcsonEdmCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIcsonOTag_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIcsonTradeShopGuideCost_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIcsonCSPhoneType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIcsonCSPhoneOperator_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIcsonCSPhoneNumber_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIcsonCSPhoneArea_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIcsonCSPhonePackageId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIcsonCSPhoneUserName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIcsonCSPhoneUserAddr_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIcsonCSPhoneUserMobile_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIcsonCSPhoneUserTel_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIcsonCSPhoneIdCardNo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIcsonCSPhoneIdCardAddr_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIcsonCSPhoneIdCardDate_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIcsonCSPhoneZipCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIcsonCSPhoneCardPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cIcsonCSPhonePackagePrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cReserve_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$this->ddwProductId = $bs->popUint64_t(); // �����л���Ʒid ����Ϊuint64_t
			}
			if(  $this->wVersion >= 1 ){
				$this->strProductCode = $bs->popString(); // �����л���Ʒid���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonTradeFlag = $bs->popString(); // �����л���Ѹ��Ʒ�ӵ�flag ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonPointType = $bs->popString(); // �����л���Ѹ���ֶһ����� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->dwIcsonTradeCashBack = $bs->popUint32_t(); // �����л��ӵ����ֽ�� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonUnitCostInvoice = $bs->popString(); // �����л�ȥ˰��ɱ� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cProductId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cProductCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonTradeFlag_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonPointType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonTradeCashBack_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonUnitCostInvoice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}

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


//source idl: com.ecc.deal.idl.EventParamsOperGoodsBo.java

if (!class_exists('EventParamsRemoveGoodsBo')) {
class EventParamsRemoveGoodsBo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * �ӵ�id
		 *
		 * �汾 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * �ӵ�skuid
		 *
		 * �汾 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * �����ֶ�
		 *
		 * �汾 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * ɾ������
		 *
		 * �汾 >= 1
		 */
		var $dwNum; //uint32_t

		/**
		 * 
		 *
		 * �汾 >= 1
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushUint64_t($this->ddwTradeId); // ���л��ӵ�id ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwSkuId); // ���л��ӵ�skuid ����Ϊuint64_t
			$bs->pushString($this->strReserve); // ���л������ֶ� ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSkuId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cReserve_u); // ���л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwNum); // ���л�ɾ������ ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cNum_u); // ���л� ����Ϊuint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->ddwTradeId = $bs->popUint64_t(); // �����л��ӵ�id ����Ϊuint64_t
			$this->ddwSkuId = $bs->popUint64_t(); // �����л��ӵ�skuid ����Ϊuint64_t
			$this->strReserve = $bs->popString(); // �����л������ֶ� ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSkuId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cReserve_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$this->dwNum = $bs->popUint32_t(); // �����л�ɾ������ ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}

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


//source idl: com.ecc.deal.idl.NotifyDealPaymentReq.java

if (!class_exists('EventParamsPayBo')) {
class EventParamsPayBo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * �ֽ�֧�����
		 *
		 * �汾 >= 0
		 */
		var $dwFeeCash; //uint32_t

		/**
		 * �Ƹ�ͨ�ֽ�ȯ֧�����
		 *
		 * �汾 >= 0
		 */
		var $dwFeeTicket; //uint32_t

		/**
		 * �ۿ�ȯ֧�����
		 *
		 * �汾 >= 0
		 */
		var $dwFeeVFee; //uint32_t

		/**
		 * ����֧�����
		 *
		 * �汾 >= 0
		 */
		var $dwFeeScore; //uint32_t

		/**
		 * �ʱ�֧�����
		 *
		 * �汾 >= 0
		 */
		var $dwFeeCaibei; //uint32_t

		/**
		 * ����֧�����
		 *
		 * �汾 >= 0
		 */
		var $dwFeeOther; //uint32_t

		/**
		 * ���������ѣ�������֧��ƽ̨������֧��ʱ����
		 *
		 * �汾 >= 0
		 */
		var $dwProcedureFee; //uint32_t

		/**
		 * ֧��ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwPayTime; //uint32_t

		/**
		 * ֧�����ţ�ͳһ������̨��֧����id��û���򲻴�
		 *
		 * �汾 >= 0
		 */
		var $ddwPayId; //uint64_t

		/**
		 * ֧�������ţ���Ƹ�ͨ���ţ�֧�������ŵ�
		 *
		 * �汾 >= 0
		 */
		var $strPayDealId; //std::string

		/**
		 * ��������
		 *
		 * �汾 >= 0
		 */
		var $strBankType; //std::string

		/**
		 * ���˴����ʺ�
		 *
		 * �汾 >= 0
		 */
		var $strOtherPayAccount; //std::string

		/**
		 * ���˻�
		 *
		 * �汾 >= 0
		 */
		var $strBindAccount; //std::string

		/**
		 * ֧��ҵ�񵥺ţ�֧��ϵͳ��ҵ�񶩵���
		 *
		 * �汾 >= 0
		 */
		var $strPayBusinessId; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cFeeCash_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cFeeTicket_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cFeeVFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cFeeScore_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cFeeCaibei_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cFeeOther_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cProcedureFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBankType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOtherPayAccount_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBindAccount_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayBusinessId_u; //uint8_t

		/**
		 * ͳһ֧��ƽ̨��֧������
		 *
		 * �汾 >= 1
		 */
		var $strPaySeqId; //std::string

		/**
		 * 
		 *
		 * �汾 >= 1
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwFeeCash); // ���л��ֽ�֧����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwFeeTicket); // ���л��Ƹ�ͨ�ֽ�ȯ֧����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwFeeVFee); // ���л��ۿ�ȯ֧����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwFeeScore); // ���л�����֧����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwFeeCaibei); // ���л��ʱ�֧����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwFeeOther); // ���л�����֧����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwProcedureFee); // ���л����������ѣ�������֧��ƽ̨������֧��ʱ���� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayTime); // ���л�֧��ʱ�� ����Ϊuint32_t
			$bs->pushUint64_t($this->ddwPayId); // ���л�֧�����ţ�ͳһ������̨��֧����id��û���򲻴� ����Ϊuint64_t
			$bs->pushString($this->strPayDealId); // ���л�֧�������ţ���Ƹ�ͨ���ţ�֧�������ŵ� ����Ϊstd::string
			$bs->pushString($this->strBankType); // ���л��������� ����Ϊstd::string
			$bs->pushString($this->strOtherPayAccount); // ���л����˴����ʺ� ����Ϊstd::string
			$bs->pushString($this->strBindAccount); // ���л����˻� ����Ϊstd::string
			$bs->pushString($this->strPayBusinessId); // ���л�֧��ҵ�񵥺ţ�֧��ϵͳ��ҵ�񶩵��� ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cFeeCash_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cFeeTicket_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cFeeVFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cFeeScore_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cFeeCaibei_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cFeeOther_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cProcedureFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBankType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOtherPayAccount_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBindAccount_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayBusinessId_u); // ���л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strPaySeqId); // ���л�ͳһ֧��ƽ̨��֧������ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cPaySeqId_u); // ���л� ����Ϊuint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->dwFeeCash = $bs->popUint32_t(); // �����л��ֽ�֧����� ����Ϊuint32_t
			$this->dwFeeTicket = $bs->popUint32_t(); // �����л��Ƹ�ͨ�ֽ�ȯ֧����� ����Ϊuint32_t
			$this->dwFeeVFee = $bs->popUint32_t(); // �����л��ۿ�ȯ֧����� ����Ϊuint32_t
			$this->dwFeeScore = $bs->popUint32_t(); // �����л�����֧����� ����Ϊuint32_t
			$this->dwFeeCaibei = $bs->popUint32_t(); // �����л��ʱ�֧����� ����Ϊuint32_t
			$this->dwFeeOther = $bs->popUint32_t(); // �����л�����֧����� ����Ϊuint32_t
			$this->dwProcedureFee = $bs->popUint32_t(); // �����л����������ѣ�������֧��ƽ̨������֧��ʱ���� ����Ϊuint32_t
			$this->dwPayTime = $bs->popUint32_t(); // �����л�֧��ʱ�� ����Ϊuint32_t
			$this->ddwPayId = $bs->popUint64_t(); // �����л�֧�����ţ�ͳһ������̨��֧����id��û���򲻴� ����Ϊuint64_t
			$this->strPayDealId = $bs->popString(); // �����л�֧�������ţ���Ƹ�ͨ���ţ�֧�������ŵ� ����Ϊstd::string
			$this->strBankType = $bs->popString(); // �����л��������� ����Ϊstd::string
			$this->strOtherPayAccount = $bs->popString(); // �����л����˴����ʺ� ����Ϊstd::string
			$this->strBindAccount = $bs->popString(); // �����л����˻� ����Ϊstd::string
			$this->strPayBusinessId = $bs->popString(); // �����л�֧��ҵ�񵥺ţ�֧��ϵͳ��ҵ�񶩵��� ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cFeeCash_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cFeeTicket_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cFeeVFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cFeeScore_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cFeeCaibei_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cFeeOther_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cProcedureFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBankType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOtherPayAccount_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBindAccount_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayBusinessId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$this->strPaySeqId = $bs->popString(); // �����л�ͳһ֧��ƽ̨��֧������ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cPaySeqId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}

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


//source idl: com.ecc.deal.idl.ModifyValueAddedTaxInvoiceReq.java

if (!class_exists('SyncValueAddedTaxInvoiceBo')) {
class SyncValueAddedTaxInvoiceBo
{
		/**
		 * �汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * ��������
		 *
		 * �汾 >= 0
		 */
		var $strOperationDesc; //std::string

		/**
		 * ��˾����
		 *
		 * �汾 >= 0
		 */
		var $strCompanyName; //std::string

		/**
		 * ��˾��ַ
		 *
		 * �汾 >= 0
		 */
		var $strCompanyAddr; //std::string

		/**
		 * ��˾�绰
		 *
		 * �汾 >= 0
		 */
		var $strCompanyPhone; //std::string

		/**
		 * ˰��
		 *
		 * �汾 >= 0
		 */
		var $strCompanyTaxNo; //std::string

		/**
		 * �����˻�
		 *
		 * �汾 >= 0
		 */
		var $strBankAccount; //std::string

		/**
		 * ������Ϣ
		 *
		 * �汾 >= 0
		 */
		var $strBankInfo; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperateTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperationDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cCompanyName_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cCompanyAddr_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cCompanyPhone_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cCompanyTaxNo_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBankAccount_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л��汾�� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwOperateTime); // ���л�����ʱ�� ����Ϊuint32_t
			$bs->pushString($this->strOperationDesc); // ���л��������� ����Ϊstd::string
			$bs->pushString($this->strCompanyName); // ���л���˾���� ����Ϊstd::string
			$bs->pushString($this->strCompanyAddr); // ���л���˾��ַ ����Ϊstd::string
			$bs->pushString($this->strCompanyPhone); // ���л���˾�绰 ����Ϊstd::string
			$bs->pushString($this->strCompanyTaxNo); // ���л�˰�� ����Ϊstd::string
			$bs->pushString($this->strBankAccount); // ���л������˻� ����Ϊstd::string
			$bs->pushString($this->strBankInfo); // ���л�������Ϣ ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperationDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cCompanyName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cCompanyAddr_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cCompanyPhone_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cCompanyTaxNo_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBankAccount_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBankInfo_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л��汾�� ����Ϊuint16_t
			$this->dwOperateTime = $bs->popUint32_t(); // �����л�����ʱ�� ����Ϊuint32_t
			$this->strOperationDesc = $bs->popString(); // �����л��������� ����Ϊstd::string
			$this->strCompanyName = $bs->popString(); // �����л���˾���� ����Ϊstd::string
			$this->strCompanyAddr = $bs->popString(); // �����л���˾��ַ ����Ϊstd::string
			$this->strCompanyPhone = $bs->popString(); // �����л���˾�绰 ����Ϊstd::string
			$this->strCompanyTaxNo = $bs->popString(); // �����л�˰�� ����Ϊstd::string
			$this->strBankAccount = $bs->popString(); // �����л������˻� ����Ϊstd::string
			$this->strBankInfo = $bs->popString(); // �����л�������Ϣ ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperationDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cCompanyName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cCompanyAddr_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cCompanyPhone_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cCompanyTaxNo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBankAccount_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBankInfo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.ecc.deal.idl.ModifySeparateInvoiceReq.java

if (!class_exists('SyncSeparateInvoiceBo')) {
class SyncSeparateInvoiceBo
{
		/**
		 * �汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * ��������
		 *
		 * �汾 >= 0
		 */
		var $strOperationDesc; //std::string

		/**
		 * ���ͷ�ʽ
		 *
		 * �汾 >= 0
		 */
		var $dwShipType; //uint32_t

		/**
		 * �ջ���ַid
		 *
		 * �汾 >= 0
		 */
		var $dwRecvRegionId; //uint32_t

		/**
		 * �ջ���ַ
		 *
		 * �汾 >= 0
		 */
		var $strRecvAddr; //std::string

		/**
		 * �ջ���
		 *
		 * �汾 >= 0
		 */
		var $strRecvName; //std::string

		/**
		 * �ջ����ֻ�
		 *
		 * �汾 >= 0
		 */
		var $strRecvMobile; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperateTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperationDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cShipType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvRegionId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvAddr_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvName_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л��汾�� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwOperateTime); // ���л�����ʱ�� ����Ϊuint32_t
			$bs->pushString($this->strOperationDesc); // ���л��������� ����Ϊstd::string
			$bs->pushUint32_t($this->dwShipType); // ���л����ͷ�ʽ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRecvRegionId); // ���л��ջ���ַid ����Ϊuint32_t
			$bs->pushString($this->strRecvAddr); // ���л��ջ���ַ ����Ϊstd::string
			$bs->pushString($this->strRecvName); // ���л��ջ��� ����Ϊstd::string
			$bs->pushString($this->strRecvMobile); // ���л��ջ����ֻ� ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperationDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cShipType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvRegionId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvAddr_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvMobile_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л��汾�� ����Ϊuint16_t
			$this->dwOperateTime = $bs->popUint32_t(); // �����л�����ʱ�� ����Ϊuint32_t
			$this->strOperationDesc = $bs->popString(); // �����л��������� ����Ϊstd::string
			$this->dwShipType = $bs->popUint32_t(); // �����л����ͷ�ʽ ����Ϊuint32_t
			$this->dwRecvRegionId = $bs->popUint32_t(); // �����л��ջ���ַid ����Ϊuint32_t
			$this->strRecvAddr = $bs->popString(); // �����л��ջ���ַ ����Ϊstd::string
			$this->strRecvName = $bs->popString(); // �����л��ջ��� ����Ϊstd::string
			$this->strRecvMobile = $bs->popString(); // �����л��ջ����ֻ� ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperationDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cShipType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvRegionId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvAddr_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvMobile_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.ecc.deal.idl.ModifyScoreReq.java

if (!class_exists('EventParamsModifyScoreBo')) {
class EventParamsModifyScoreBo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * ʹ�û���ֵ��ָ���ǻ��ֶһ�����λΪ��
		 *
		 * �汾 >= 0
		 */
		var $dwPayScore; //uint32_t

		/**
		 * ����
		 *
		 * �汾 >= 0
		 */
		var $strOperateDesc; //std::string

		/**
		 * �����ֶ�
		 *
		 * �汾 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperateTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayScore_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperateDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * �ֽ���֣���λ�Ƿ�
		 *
		 * �汾 >= 1
		 */
		var $dwCashScore; //uint32_t

		/**
		 * �������֣���λ�Ƿ�
		 *
		 * �汾 >= 1
		 */
		var $dwPromotionScore; //uint32_t

		/**
		 * ��û���
		 *
		 * �汾 >= 1
		 */
		var $dwPointObtain; //uint32_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $dwCashScore_u; //uint32_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $dwPromotionScore_u; //uint32_t

		/**
		 * 
		 *
		 * �汾 >= 1
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwOperateTime); // ���л�����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayScore); // ���л�ʹ�û���ֵ��ָ���ǻ��ֶһ�����λΪ�� ����Ϊuint32_t
			$bs->pushString($this->strOperateDesc); // ���л����� ����Ϊstd::string
			$bs->pushString($this->strReserve); // ���л������ֶ� ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayScore_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperateDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cReserve_u); // ���л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwCashScore); // ���л��ֽ���֣���λ�Ƿ� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwPromotionScore); // ���л��������֣���λ�Ƿ� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwPointObtain); // ���л���û��� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwCashScore_u); // ���л� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwPromotionScore_u); // ���л� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cPointObtain_u); // ���л� ����Ϊuint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->dwOperateTime = $bs->popUint32_t(); // �����л�����ʱ�� ����Ϊuint32_t
			$this->dwPayScore = $bs->popUint32_t(); // �����л�ʹ�û���ֵ��ָ���ǻ��ֶһ�����λΪ�� ����Ϊuint32_t
			$this->strOperateDesc = $bs->popString(); // �����л����� ����Ϊstd::string
			$this->strReserve = $bs->popString(); // �����л������ֶ� ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayScore_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperateDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cReserve_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$this->dwCashScore = $bs->popUint32_t(); // �����л��ֽ���֣���λ�Ƿ� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->dwPromotionScore = $bs->popUint32_t(); // �����л��������֣���λ�Ƿ� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->dwPointObtain = $bs->popUint32_t(); // �����л���û��� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->dwCashScore_u = $bs->popUint32_t(); // �����л� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->dwPromotionScore_u = $bs->popUint32_t(); // �����л� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cPointObtain_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}

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


//source idl: com.ecc.deal.idl.ModifyReceiveInfoReq.java

if (!class_exists('EventParamsModifyRecvInfoBo')) {
class EventParamsModifyRecvInfoBo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * �ջ���ַ����id(����:��������)
		 *
		 * �汾 >= 0
		 */
		var $dwRegionCodeGB; //uint32_t

		/**
		 * �ջ���ַ����id(����ϸ��:��Ѹ)
		 *
		 * �汾 >= 0
		 */
		var $dwRegionCodeGBD; //uint32_t

		/**
		 * �ջ���ַ
		 *
		 * �汾 >= 0
		 */
		var $strRecvAddress; //std::string

		/**
		 * �ʱ�
		 *
		 * �汾 >= 0
		 */
		var $strRecvPostcode; //std::string

		/**
		 * ��ϵ��
		 *
		 * �汾 >= 0
		 */
		var $strRecvName; //std::string

		/**
		 * ��ϵ�ֻ�
		 *
		 * �汾 >= 0
		 */
		var $ddwRecvMobile; //uint64_t

		/**
		 * ��ϵ�绰
		 *
		 * �汾 >= 0
		 */
		var $strRecvPhone; //std::string

		/**
		 * ����
		 *
		 * �汾 >= 0
		 */
		var $strOperateDesc; //std::string

		/**
		 * �����ֶ�
		 *
		 * �汾 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperateTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRegionCodeGB_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRegionCodeGBD_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvAddress_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvPostcode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvName_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvMobile_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvPhone_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperateDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * ҵ��������ͷ�ʽ������Ѹ���ͷ�ʽ��
		 *
		 * �汾 >= 1
		 */
		var $dwBizShipType; //uint32_t

		/**
		 * ͳһ�������ͷ�ʽ��ͳһ��������
		 *
		 * �汾 >= 1
		 */
		var $dwUnpShipType; //uint32_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cBizShipType_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwOperateTime); // ���л�����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRegionCodeGB); // ���л��ջ���ַ����id(����:��������) ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRegionCodeGBD); // ���л��ջ���ַ����id(����ϸ��:��Ѹ) ����Ϊuint32_t
			$bs->pushString($this->strRecvAddress); // ���л��ջ���ַ ����Ϊstd::string
			$bs->pushString($this->strRecvPostcode); // ���л��ʱ� ����Ϊstd::string
			$bs->pushString($this->strRecvName); // ���л���ϵ�� ����Ϊstd::string
			$bs->pushUint64_t($this->ddwRecvMobile); // ���л���ϵ�ֻ� ����Ϊuint64_t
			$bs->pushString($this->strRecvPhone); // ���л���ϵ�绰 ����Ϊstd::string
			$bs->pushString($this->strOperateDesc); // ���л����� ����Ϊstd::string
			$bs->pushString($this->strReserve); // ���л������ֶ� ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRegionCodeGB_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRegionCodeGBD_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvAddress_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvPostcode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvMobile_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvPhone_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperateDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cReserve_u); // ���л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwBizShipType); // ���л�ҵ��������ͷ�ʽ������Ѹ���ͷ�ʽ�� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwUnpShipType); // ���л�ͳһ�������ͷ�ʽ��ͳһ�������� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cBizShipType_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cUnpShipType_u); // ���л� ����Ϊuint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->dwOperateTime = $bs->popUint32_t(); // �����л�����ʱ�� ����Ϊuint32_t
			$this->dwRegionCodeGB = $bs->popUint32_t(); // �����л��ջ���ַ����id(����:��������) ����Ϊuint32_t
			$this->dwRegionCodeGBD = $bs->popUint32_t(); // �����л��ջ���ַ����id(����ϸ��:��Ѹ) ����Ϊuint32_t
			$this->strRecvAddress = $bs->popString(); // �����л��ջ���ַ ����Ϊstd::string
			$this->strRecvPostcode = $bs->popString(); // �����л��ʱ� ����Ϊstd::string
			$this->strRecvName = $bs->popString(); // �����л���ϵ�� ����Ϊstd::string
			$this->ddwRecvMobile = $bs->popUint64_t(); // �����л���ϵ�ֻ� ����Ϊuint64_t
			$this->strRecvPhone = $bs->popString(); // �����л���ϵ�绰 ����Ϊstd::string
			$this->strOperateDesc = $bs->popString(); // �����л����� ����Ϊstd::string
			$this->strReserve = $bs->popString(); // �����л������ֶ� ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRegionCodeGB_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRegionCodeGBD_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvAddress_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvPostcode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvMobile_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvPhone_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperateDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cReserve_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$this->dwBizShipType = $bs->popUint32_t(); // �����л�ҵ��������ͷ�ʽ������Ѹ���ͷ�ʽ�� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->dwUnpShipType = $bs->popUint32_t(); // �����л�ͳһ�������ͷ�ʽ��ͳһ�������� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cBizShipType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cUnpShipType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}

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


//source idl: com.ecc.deal.idl.ModifyPayTypeReq.java

if (!class_exists('EventParamsModifyPayTypeBo')) {
class EventParamsModifyPayTypeBo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * ֧����ʽ
		 *
		 * �汾 >= 0
		 */
		var $dwPayType; //uint32_t

		/**
		 * ֧����ʽ����
		 *
		 * �汾 >= 0
		 */
		var $strPayTypeName; //std::string

		/**
		 * ����
		 *
		 * �汾 >= 0
		 */
		var $strOperateDesc; //std::string

		/**
		 * �����ֶ�
		 *
		 * �汾 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperateTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayTypeName_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperateDesc_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwOperateTime); // ���л�����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayType); // ���л�֧����ʽ ����Ϊuint32_t
			$bs->pushString($this->strPayTypeName); // ���л�֧����ʽ���� ����Ϊstd::string
			$bs->pushString($this->strOperateDesc); // ���л����� ����Ϊstd::string
			$bs->pushString($this->strReserve); // ���л������ֶ� ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayTypeName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperateDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cReserve_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->dwOperateTime = $bs->popUint32_t(); // �����л�����ʱ�� ����Ϊuint32_t
			$this->dwPayType = $bs->popUint32_t(); // �����л�֧����ʽ ����Ϊuint32_t
			$this->strPayTypeName = $bs->popString(); // �����л�֧����ʽ���� ����Ϊstd::string
			$this->strOperateDesc = $bs->popString(); // �����л����� ����Ϊstd::string
			$this->strReserve = $bs->popString(); // �����л������ֶ� ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayTypeName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperateDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cReserve_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.ecc.deal.idl.ModifyInvoiceReq.java

if (!class_exists('EventParamsModifyInvoiceBo')) {
class EventParamsModifyInvoiceBo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ����ʱ�䣬����
		 *
		 * �汾 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * ��Ʊ���ͣ�����
		 *
		 * �汾 >= 0
		 */
		var $cInvoiceType; //uint8_t

		/**
		 * ��Ʊ̧ͷ
		 *
		 * �汾 >= 0
		 */
		var $strInvoiceHead; //std::string

		/**
		 * ��Ʊ����
		 *
		 * �汾 >= 0
		 */
		var $strInvoiceContent; //std::string

		/**
		 * ����
		 *
		 * �汾 >= 0
		 */
		var $strOperateDesc; //std::string

		/**
		 * �����ֶ�
		 *
		 * �汾 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperateTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cInvoiceType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cInvoiceHead_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cInvoiceContent_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperateDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * �Ƿ�ģ����Ʊ������
		 *
		 * �汾 >= 1
		 */
		var $cIsBlurry; //uint8_t

		/**
		 * �Ƿ��Զ���Ʊ������
		 *
		 * �汾 >= 1
		 */
		var $cIsVat; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIsBlurry_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwOperateTime); // ���л�����ʱ�䣬���� ����Ϊuint32_t
			$bs->pushUint8_t($this->cInvoiceType); // ���л���Ʊ���ͣ����� ����Ϊuint8_t
			$bs->pushString($this->strInvoiceHead); // ���л���Ʊ̧ͷ ����Ϊstd::string
			$bs->pushString($this->strInvoiceContent); // ���л���Ʊ���� ����Ϊstd::string
			$bs->pushString($this->strOperateDesc); // ���л����� ����Ϊstd::string
			$bs->pushString($this->strReserve); // ���л������ֶ� ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cInvoiceType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cInvoiceHead_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cInvoiceContent_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperateDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cReserve_u); // ���л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIsBlurry); // ���л��Ƿ�ģ����Ʊ������ ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIsVat); // ���л��Ƿ��Զ���Ʊ������ ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIsBlurry_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIsVat_u); // ���л� ����Ϊuint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->dwOperateTime = $bs->popUint32_t(); // �����л�����ʱ�䣬���� ����Ϊuint32_t
			$this->cInvoiceType = $bs->popUint8_t(); // �����л���Ʊ���ͣ����� ����Ϊuint8_t
			$this->strInvoiceHead = $bs->popString(); // �����л���Ʊ̧ͷ ����Ϊstd::string
			$this->strInvoiceContent = $bs->popString(); // �����л���Ʊ���� ����Ϊstd::string
			$this->strOperateDesc = $bs->popString(); // �����л����� ����Ϊstd::string
			$this->strReserve = $bs->popString(); // �����л������ֶ� ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cInvoiceType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cInvoiceHead_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cInvoiceContent_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperateDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cReserve_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$this->cIsBlurry = $bs->popUint8_t(); // �����л��Ƿ�ģ����Ʊ������ ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIsVat = $bs->popUint8_t(); // �����л��Ƿ��Զ���Ʊ������ ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIsBlurry_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIsVat_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}

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


//source idl: com.ecc.deal.idl.ModifyCouponReq.java

if (!class_exists('EventParamsModifyCouponBo')) {
class EventParamsModifyCouponBo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwOperateTime; //uint32_t

		/**
		 * �Ż�����
		 *
		 * �汾 >= 0
		 */
		var $dwCouponType; //uint32_t

		/**
		 * �Żݽ��
		 *
		 * �汾 >= 0
		 */
		var $dwCouponFee; //uint32_t

		/**
		 * ����id
		 *
		 * �汾 >= 0
		 */
		var $dwRuleId; //uint32_t

		/**
		 * ���ţ���������
		 *
		 * �汾 >= 0
		 */
		var $ddwActiveNo; //uint64_t

		/**
		 * �Ż�ȯ����
		 *
		 * �汾 >= 0
		 */
		var $strCouponCode; //std::string

		/**
		 * ����
		 *
		 * �汾 >= 0
		 */
		var $strOperateDesc; //std::string

		/**
		 * �����ֶ�
		 *
		 * �汾 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperateTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cCouponType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cCouponFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRuleId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cActiveNo_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cCouponCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperateDesc_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwOperateTime); // ���л�����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwCouponType); // ���л��Ż����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwCouponFee); // ���л��Żݽ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRuleId); // ���л�����id ����Ϊuint32_t
			$bs->pushUint64_t($this->ddwActiveNo); // ���л����ţ��������� ����Ϊuint64_t
			$bs->pushString($this->strCouponCode); // ���л��Ż�ȯ���� ����Ϊstd::string
			$bs->pushString($this->strOperateDesc); // ���л����� ����Ϊstd::string
			$bs->pushString($this->strReserve); // ���л������ֶ� ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperateTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cCouponType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cCouponFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRuleId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cActiveNo_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cCouponCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperateDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cReserve_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->dwOperateTime = $bs->popUint32_t(); // �����л�����ʱ�� ����Ϊuint32_t
			$this->dwCouponType = $bs->popUint32_t(); // �����л��Ż����� ����Ϊuint32_t
			$this->dwCouponFee = $bs->popUint32_t(); // �����л��Żݽ�� ����Ϊuint32_t
			$this->dwRuleId = $bs->popUint32_t(); // �����л�����id ����Ϊuint32_t
			$this->ddwActiveNo = $bs->popUint64_t(); // �����л����ţ��������� ����Ϊuint64_t
			$this->strCouponCode = $bs->popString(); // �����л��Ż�ȯ���� ����Ϊstd::string
			$this->strOperateDesc = $bs->popString(); // �����л����� ����Ϊstd::string
			$this->strReserve = $bs->popString(); // �����л������ֶ� ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cCouponType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cCouponFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRuleId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cActiveNo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cCouponCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperateDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cReserve_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.ecc.deal.idl.MarkShipReq.java

if (!class_exists('EventParamsCorpShipBo')) {
class EventParamsCorpShipBo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ���������⣩ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwSendTime; //uint32_t

		/**
		 * ������˾id
		 *
		 * �汾 >= 0
		 */
		var $strWuliuCompanyId; //std::string

		/**
		 * ������˾����
		 *
		 * �汾 >= 0
		 */
		var $strWuliuCompanyName; //std::string

		/**
		 * �����˵���
		 *
		 * �汾 >= 0
		 */
		var $strWuliuCode; //std::string

		/**
		 * ���ͷ�ʽ
		 *
		 * �汾 >= 0
		 */
		var $dwShipType; //uint32_t

		/**
		 * ���������⣩����
		 *
		 * �汾 >= 0
		 */
		var $strSendDesc; //std::string

		/**
		 * �޸ĳɱ��ۣ�������漰�޸ĳɱ��ۣ��뽫vector�ÿ�
		 *
		 * �汾 >= 0
		 */
		var $vecModifyCostPriceList; //std::vector<ecc::deal::bo::CEventParamsCorpModifyTradeBo> 

		/**
		 * �����ֶ�
		 *
		 * �汾 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSendTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cWuliuCompanyId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cWuliuCompanyName_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cWuliuCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cShipType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSendDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cModifyCostPriceList_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwSendTime); // ���л����������⣩ʱ�� ����Ϊuint32_t
			$bs->pushString($this->strWuliuCompanyId); // ���л�������˾id ����Ϊstd::string
			$bs->pushString($this->strWuliuCompanyName); // ���л�������˾���� ����Ϊstd::string
			$bs->pushString($this->strWuliuCode); // ���л������˵��� ����Ϊstd::string
			$bs->pushUint32_t($this->dwShipType); // ���л����ͷ�ʽ ����Ϊuint32_t
			$bs->pushString($this->strSendDesc); // ���л����������⣩���� ����Ϊstd::string
			$bs->pushObject($this->vecModifyCostPriceList,'stl_vector'); // ���л��޸ĳɱ��ۣ�������漰�޸ĳɱ��ۣ��뽫vector�ÿ� ����Ϊstd::vector<ecc::deal::bo::CEventParamsCorpModifyTradeBo> 
			$bs->pushString($this->strReserve); // ���л������ֶ� ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSendTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cWuliuCompanyId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cWuliuCompanyName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cWuliuCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cShipType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSendDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cModifyCostPriceList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cReserve_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->dwSendTime = $bs->popUint32_t(); // �����л����������⣩ʱ�� ����Ϊuint32_t
			$this->strWuliuCompanyId = $bs->popString(); // �����л�������˾id ����Ϊstd::string
			$this->strWuliuCompanyName = $bs->popString(); // �����л�������˾���� ����Ϊstd::string
			$this->strWuliuCode = $bs->popString(); // �����л������˵��� ����Ϊstd::string
			$this->dwShipType = $bs->popUint32_t(); // �����л����ͷ�ʽ ����Ϊuint32_t
			$this->strSendDesc = $bs->popString(); // �����л����������⣩���� ����Ϊstd::string
			$this->vecModifyCostPriceList = $bs->popObject('stl_vector<EventParamsCorpModifyTradeBo>'); // �����л��޸ĳɱ��ۣ�������漰�޸ĳɱ��ۣ��뽫vector�ÿ� ����Ϊstd::vector<ecc::deal::bo::CEventParamsCorpModifyTradeBo> 
			$this->strReserve = $bs->popString(); // �����л������ֶ� ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSendTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cWuliuCompanyId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cWuliuCompanyName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cWuliuCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cShipType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSendDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cModifyCostPriceList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cReserve_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.ecc.deal.idl.CreateRefundReq.java

if (!class_exists('EventParamsCorpCreateRefundBo')) {
class EventParamsCorpCreateRefundBo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ����id
		 *
		 * �汾 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * �ӵ�id, ���û���ӵ�����Ʒ��ά����Ϣ���ɲ���
		 *
		 * �汾 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * ��Ʒskuid, ���û���ӵ�����Ʒ��ά����Ϣ���ɲ���
		 *
		 * �汾 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * �˿�����
		 *
		 * �汾 >= 0
		 */
		var $dwRefundType; //uint32_t

		/**
		 * �˿�ԭ������
		 *
		 * �汾 >= 0
		 */
		var $dwRefundReasonType; //uint32_t

		/**
		 * �˿�ԭ������
		 *
		 * �汾 >= 0
		 */
		var $strRefundReasonDesc; //std::string

		/**
		 * �˿����ҽ��
		 *
		 * �汾 >= 0
		 */
		var $dwBuyerRefundFee; //uint32_t

		/**
		 * �����ֶ�
		 *
		 * �汾 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundReasonType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRefundReasonDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerRefundFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cReserve_u; //uint8_t

		/**
		 * ҵ���˿id
		 *
		 * �汾 >= 1
		 */
		var $strBusinessRefundId; //std::string

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cBusinessRefundId_u; //uint8_t

		/**
		 * �˿�/�˻�����
		 *
		 * �汾 >= 2
		 */
		var $dwNum; //uint32_t

		/**
		 * 
		 *
		 * �汾 >= 2
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushString($this->strDealId); // ���л�����id ����Ϊstd::string
			$bs->pushUint64_t($this->ddwTradeId); // ���л��ӵ�id, ���û���ӵ�����Ʒ��ά����Ϣ���ɲ��� ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwSkuId); // ���л���Ʒskuid, ���û���ӵ�����Ʒ��ά����Ϣ���ɲ��� ����Ϊuint64_t
			$bs->pushUint32_t($this->dwRefundType); // ���л��˿����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwRefundReasonType); // ���л��˿�ԭ������ ����Ϊuint32_t
			$bs->pushString($this->strRefundReasonDesc); // ���л��˿�ԭ������ ����Ϊstd::string
			$bs->pushUint32_t($this->dwBuyerRefundFee); // ���л��˿����ҽ�� ����Ϊuint32_t
			$bs->pushString($this->strReserve); // ���л������ֶ� ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSkuId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundReasonType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRefundReasonDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerRefundFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cReserve_u); // ���л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strBusinessRefundId); // ���л�ҵ���˿id ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cBusinessRefundId_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwNum); // ���л��˿�/�˻����� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cNum_u); // ���л� ����Ϊuint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->strDealId = $bs->popString(); // �����л�����id ����Ϊstd::string
			$this->ddwTradeId = $bs->popUint64_t(); // �����л��ӵ�id, ���û���ӵ�����Ʒ��ά����Ϣ���ɲ��� ����Ϊuint64_t
			$this->ddwSkuId = $bs->popUint64_t(); // �����л���Ʒskuid, ���û���ӵ�����Ʒ��ά����Ϣ���ɲ��� ����Ϊuint64_t
			$this->dwRefundType = $bs->popUint32_t(); // �����л��˿����� ����Ϊuint32_t
			$this->dwRefundReasonType = $bs->popUint32_t(); // �����л��˿�ԭ������ ����Ϊuint32_t
			$this->strRefundReasonDesc = $bs->popString(); // �����л��˿�ԭ������ ����Ϊstd::string
			$this->dwBuyerRefundFee = $bs->popUint32_t(); // �����л��˿����ҽ�� ����Ϊuint32_t
			$this->strReserve = $bs->popString(); // �����л������ֶ� ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSkuId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundReasonType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRefundReasonDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerRefundFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cReserve_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$this->strBusinessRefundId = $bs->popString(); // �����л�ҵ���˿id ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cBusinessRefundId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwNum = $bs->popUint32_t(); // �����л��˿�/�˻����� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}

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


//source idl: com.ecc.deal.idl.CreateDealReq.java

if (!class_exists('OrderPo')) {
class OrderPo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ������ţ���ʽ:�������XXXXYYYY����:101041051509351702����Ϊ��
		 *
		 * �汾 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * �������ţ����Ķ���ͬ����ʹ�ã���Ϊ��
		 *
		 * �汾 >= 0
		 */
		var $ddwDealId64; //uint64_t

		/**
		 * ���׵��ţ���Ϊ��
		 *
		 * �汾 >= 0
		 */
		var $ddwBdealId; //uint64_t

		/**
		 * ҵ�񶩵���ţ��������йܶ���
		 *
		 * �汾 >= 0
		 */
		var $strBusinessDealId; //std::string

		/**
		 * ���ID
		 *
		 * �汾 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * ����ʺ�
		 *
		 * �汾 >= 0
		 */
		var $strBuyerAccount; //std::string

		/**
		 * �������
		 *
		 * �汾 >= 0
		 */
		var $strBuyerNickName; //std::string

		/**
		 * ����ǳ�
		 *
		 * �汾 >= 0
		 */
		var $strBuyerNick; //std::string

		/**
		 * �̼�ID
		 *
		 * �汾 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * �̼���ʵ����
		 *
		 * �汾 >= 0
		 */
		var $strSellerTitle; //std::string

		/**
		 * �����ǳ�
		 *
		 * �汾 >= 0
		 */
		var $strSellerNick; //std::string

		/**
		 * ҵ��ID
		 *
		 * �汾 >= 0
		 */
		var $dwBusinessId; //uint32_t

		/**
		 * ��������
		 *
		 * �汾 >= 0
		 */
		var $cDealType; //uint8_t

		/**
		 * �µ�������1��ҵ����վ��2���ƶ�app��3���ƶ�wap
		 *
		 * �汾 >= 0
		 */
		var $dwDealSource; //uint32_t

		/**
		 * ֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6���������
		 *
		 * �汾 >= 0
		 */
		var $cDealPayType; //uint8_t

		/**
		 * ����״̬
		 *
		 * �汾 >= 0
		 */
		var $dwDealState; //uint32_t

		/**
		 * ��������ֵ��ͨ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealProperty; //uint32_t

		/**
		 * ��������ֵ��ҵ��1��չ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealProperty1; //uint32_t

		/**
		 * ��������ֵ��ҵ��2��չ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealProperty2; //uint32_t

		/**
		 * ��������ֵ��ҵ��3��չ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealProperty3; //uint32_t

		/**
		 * ��������ֵ��ҵ��4��չ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealProperty4; //uint32_t

		/**
		 * ��ƷskuID�б�
		 *
		 * �汾 >= 0
		 */
		var $strItemSkuidList; //std::string

		/**
		 * ��Ʒ�����б�
		 *
		 * �汾 >= 0
		 */
		var $strItemTitleList; //std::string

		/**
		 * �����ܽ��,�µ����
		 *
		 * �汾 >= 0
		 */
		var $dwDealTotalFee; //uint32_t

		/**
		 * ���۽��
		 *
		 * �汾 >= 0
		 */
		var $nDealAdjustFee; //int

		/**
		 * ʵ���ܽ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealPayment; //uint32_t

		/**
		 * C2BԤ�۶�����
		 *
		 * �汾 >= 0
		 */
		var $dwDealDownPayment; //uint32_t

		/**
		 * �Ż��ܽ��; ��б��Żݽ�����
		 *
		 * �汾 >= 0
		 */
		var $nDealDiscountTotal; //int

		/**
		 * ��Ʒ�ӵ��ܽ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealItemTotalFee; //uint32_t

		/**
		 * ˭֧���ʷѣ�1�����ң�2�����
		 *
		 * �汾 >= 0
		 */
		var $dwDealWhoPayShippingFee; //uint32_t

		/**
		 * �ʷѽ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealShippingFee; //uint32_t

		/**
		 * ˭�е�COD�����ѣ�1�����ҳе���2����ң�3��ƽ̨�е�
		 *
		 * �汾 >= 0
		 */
		var $dwDealWhoPayCodFee; //uint32_t

		/**
		 * COD������
		 *
		 * �汾 >= 0
		 */
		var $dwDealCodFee; //uint32_t

		/**
		 * ˭֧�����շѣ�1���������ͣ�2����ң�3��ƽ̨�е�
		 *
		 * �汾 >= 0
		 */
		var $dwDealWhoPayInsuranceFee; //uint32_t

		/**
		 * �˷ѱ��շ�
		 *
		 * �汾 >= 0
		 */
		var $dwDealInsuranceFee; //uint32_t

		/**
		 * ϵͳ���۽���������COD���ҵ��۽������ڴ�����COD�Żݽ��
		 *
		 * �汾 >= 0
		 */
		var $nDealSysAdjustFee; //int

		/**
		 * ����֧��ֵ
		 *
		 * �汾 >= 0
		 */
		var $dwPayScore; //uint32_t

		/**
		 * ��û���ֵ
		 *
		 * �汾 >= 0
		 */
		var $dwObtainScore; //uint32_t

		/**
		 * ��������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwDealGenTime; //uint32_t

		/**
		 * ��������������
		 *
		 * �汾 >= 0
		 */
		var $strSendFromDesc; //std::string

		/**
		 * �µ�ʱ���
		 *
		 * �汾 >= 0
		 */
		var $ddwDealSeq; //uint64_t

		/**
		 * �µ�md5
		 *
		 * �汾 >= 0
		 */
		var $ddwDealMd5; //uint64_t

		/**
		 * �µ�IP
		 *
		 * �汾 >= 0
		 */
		var $strDealIp; //std::string

		/**
		 * refer
		 *
		 * �汾 >= 0
		 */
		var $strDealRefer; //std::string

		/**
		 * visitkey
		 *
		 * �汾 >= 0
		 */
		var $strDealVisitKey; //std::string

		/**
		 * ����������Ϣ����
		 *
		 * �汾 >= 0
		 */
		var $strPromotionDesc; //std::string

		/**
		 * �ջ���
		 *
		 * �汾 >= 0
		 */
		var $strRecvName; //std::string

		/**
		 * ��������
		 *
		 * �汾 >= 0
		 */
		var $dwRecvRegionCode; //uint32_t

		/**
		 * ��ַ
		 *
		 * �汾 >= 0
		 */
		var $strRecvAddress; //std::string

		/**
		 * �ʱ�
		 *
		 * �汾 >= 0
		 */
		var $strRecvPostCode; //std::string

		/**
		 * �绰
		 *
		 * �汾 >= 0
		 */
		var $strRecvPhone; //std::string

		/**
		 * �ֻ�
		 *
		 * �汾 >= 0
		 */
		var $ddwRecvMobile; //uint64_t

		/**
		 * �����ջ�ʱ��,��
		 *
		 * �汾 >= 0
		 */
		var $dwExpectRecvTime; //uint32_t

		/**
		 * �����ջ�ʱ��
		 *
		 * �汾 >= 0
		 */
		var $strExpectRecvTimeSpan; //std::string

		/**
		 * �ջ�����
		 *
		 * �汾 >= 0
		 */
		var $strRecvRemark; //std::string

		/**
		 * �ջ�����ֵ
		 *
		 * �汾 >= 0
		 */
		var $dwRecvMask; //uint32_t

		/**
		 * ���ͷ�ʽ��1��ƽ�ʣ�2����ݣ�3��EMS��4��B2C�Խ�������5���û����͵�����
		 *
		 * �汾 >= 0
		 */
		var $cExpressType; //uint8_t

		/**
		 * ������˾ID
		 *
		 * �汾 >= 0
		 */
		var $strExpressCompanyID; //std::string

		/**
		 * ������˾����
		 *
		 * �汾 >= 0
		 */
		var $strExpressCompanyName; //std::string

		/**
		 * ��Ʊ����
		 *
		 * �汾 >= 0
		 */
		var $cInvoiceType; //uint8_t

		/**
		 * ��Ʊ̧ͷ
		 *
		 * �汾 >= 0
		 */
		var $strInvoiceHead; //std::string

		/**
		 * ��Ʊ����
		 *
		 * �汾 >= 0
		 */
		var $strInvoiceContent; //std::string

		/**
		 * Cft֧������
		 *
		 * �汾 >= 0
		 */
		var $strCftDealId; //std::string

		/**
		 * ������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * ��Ʒ�ӵ��б�
		 *
		 * �汾 >= 0
		 */
		var $oTradeInfoList; //ecc::deal::po::COrderTradePoList

		/**
		 * ֧����Ϣ��
		 *
		 * �汾 >= 0
		 */
		var $oPayInfoList; //ecc::deal::po::COrderPayInfoPoList

		/**
		 * ��ˮ��־��
		 *
		 * �汾 >= 0
		 */
		var $oActionLogInfoList; //ecc::deal::po::CDealActionLogPoList

		/**
		 * ������չ��Ϣ 
		 *
		 * �汾 >= 0
		 */
		var $mmapDealExtInfoMap; //std::multimap<uint32_t,std::string> 

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId64_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBdealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBusinessDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerAccount_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerNickName_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerNick_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerTitle_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerNick_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBusinessId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealSource_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealPayType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealProperty_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealProperty1_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealProperty2_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealProperty3_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealProperty4_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemSkuidList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemTitleList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealTotalFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealAdjustFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealPayment_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealDownPayment_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealDiscountTotal_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealItemTotalFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealWhoPayShippingFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealShippingFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealWhoPayCodFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealCodFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealWhoPayInsuranceFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealInsuranceFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealSysAdjustFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayScore_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cObtainScore_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealGenTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSendFromDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealSeq_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealMd5_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealIp_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealRefer_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealVisitKey_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPromotionDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvName_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvRegionCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvAddress_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvPostCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvPhone_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvMobile_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExpectRecvTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExpectRecvTimeSpan_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvRemark_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cRecvMask_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExpressType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExpressCompanyID_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cExpressCompanyName_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cInvoiceType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cInvoiceHead_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cInvoiceContent_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cCftDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeInfoList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayInfoList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cActionLogInfoList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealExtInfoMap_u; //uint8_t

		/**
		 * ���׵���ţ����ַ�����ʽ�Ľ��׵��ţ���Ϊ��
		 *
		 * �汾 >= 1
		 */
		var $strBdealCode; //std::string

		/**
		 * ҵ���׵��ţ���Ϊ��
		 *
		 * �汾 >= 1
		 */
		var $strBusinessBdealId; //std::string

		/**
		 * ��վID
		 *
		 * �汾 >= 1
		 */
		var $dwSiteId; //uint32_t

		/**
		 * �Ż�ȯ���
		 *
		 * �汾 >= 1
		 */
		var $nDealCouponFee; //int

		/**
		 * �ֽ����֧��ֵ
		 *
		 * �汾 >= 1
		 */
		var $dwCashScore; //uint32_t

		/**
		 * ��������֧��ֵ
		 *
		 * �汾 >= 1
		 */
		var $dwPromotionScore; //uint32_t

		/**
		 * ��չ��������
		 *
		 * �汾 >= 1
		 */
		var $strRecvRegionCodeExt; //std::string

		/**
		 * ����ժҪ
		 *
		 * �汾 >= 1
		 */
		var $strDealDigest; //std::string

		/**
		 * ���ڸ�������
		 *
		 * �汾 >= 1
		 */
		var $strPayInstallmentBank; //std::string

		/**
		 * ���ڸ�������
		 *
		 * �汾 >= 1
		 */
		var $wPayInstallmentNum; //uint16_t

		/**
		 * ���ڸ���ÿ�ڽ��
		 *
		 * �汾 >= 1
		 */
		var $dwPayInstallmentPayment; //uint32_t

		/**
		 * ��Ѹ���ͷ�ʽ
		 *
		 * �汾 >= 1
		 */
		var $strIcsonShippingType; //std::string

		/**
		 * ��Ѹ֧����ʽ
		 *
		 * �汾 >= 1
		 */
		var $strIcsonPayType; //std::string

		/**
		 * ��Ѹ�ڲ��ʺ�ID
		 *
		 * �汾 >= 1
		 */
		var $strIcsonAccount; //std::string

		/**
		 * ��Ѹ������Ϣ
		 *
		 * �汾 >= 1
		 */
		var $strIcsonMasterLs; //std::string

		/**
		 * ��Ѹƽ�����
		 *
		 * �汾 >= 1
		 */
		var $strIcsonRate; //std::string

		/**
		 * ��Ѹ��������
		 *
		 * �汾 >= 1
		 */
		var $strIcsonBankRate; //std::string

		/**
		 * ��Ѹ����id
		 *
		 * �汾 >= 1
		 */
		var $strIcsonShopId; //std::string

		/**
		 * ��Ѹ���̵���id
		 *
		 * �汾 >= 1
		 */
		var $strIcsonShopGuideId; //std::string

		/**
		 * ��Ѹ���̵�������
		 *
		 * �汾 >= 1
		 */
		var $strIcsonShopGuideCost; //std::string

		/**
		 * ��Ѹ���̵�������
		 *
		 * �汾 >= 1
		 */
		var $strIcsonShopGuideName; //std::string

		/**
		 * ��Ѹ���ܲ�������
		 *
		 * �汾 >= 1
		 */
		var $strIcsonSubsidyType; //std::string

		/**
		 * ��Ѹ���ܲ�������
		 *
		 * �汾 >= 1
		 */
		var $strIcsonSubsidyName; //std::string

		/**
		 * ��Ѹ���ܲ������֤
		 *
		 * �汾 >= 1
		 */
		var $strIcsonSubsidyIdCard; //std::string

		/**
		 * ��Ѹ�ͷ��µ�����ԱID
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSOrderOperatorId; //std::string

		/**
		 * ��Ѹ�ͷ��µ�����Ա����
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSOrderOperatorName; //std::string

		/**
		 * ��Ѹ��Ʊ��˾����
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceCompanyName; //std::string

		/**
		 * ��Ѹ��Ʊ��˾��ַ
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceCompanyAddr; //std::string

		/**
		 * ��Ѹ��Ʊ��˾�绰
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceCompanyPhone; //std::string

		/**
		 * ��Ѹ��Ʊ��˾˰��
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceCompanyTaxNo; //std::string

		/**
		 * ��Ѹ��Ʊ��˾�����˻�
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceCompanyBankNo; //std::string

		/**
		 * ��Ѹ��Ʊ��˾��������
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceCompanyBankName; //std::string

		/**
		 * ��Ѹ��Ʊ�ջ���
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceRecvName; //std::string

		/**
		 * ��Ѹ��Ʊ�ջ���ַ
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceRecvAddr; //std::string

		/**
		 * ��Ѹ��Ʊ�ջ���ַID
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceRecvRegionId; //std::string

		/**
		 * ��Ѹ��Ʊ�ջ��ֻ�
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceRecvMobile; //std::string

		/**
		 * ��Ѹ��Ʊ�ջ��绰
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceRecvTel; //std::string

		/**
		 * ��Ѹ��Ʊ�ջ��ʱ�
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceRecvZip; //std::string

		/**
		 * ��Ѹ��Ʊ���ͷ�ʽ
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceShipType; //std::string

		/**
		 * ��Ѹ��Ʊ���ͷ���
		 *
		 * �汾 >= 1
		 */
		var $strIcsonInvoiceShipFee; //std::string

		/**
		 * ��Ѹ����flag
		 *
		 * �汾 >= 1
		 */
		var $strIcsonDealFlag; //std::string

		/**
		 * ��Ѹ���������ֿ���
		 *
		 * �汾 >= 1
		 */
		var $strIcsonStockNo; //std::string

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cBdealCode_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cBusinessBdealId_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cSiteId_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cDealCouponFee_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cCashScore_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cPromotionScore_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cRecvRegionCodeExt_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cDealDigest_u; //uint8_t

		/**
		 * ���ڸ�������UFlag
		 *
		 * �汾 >= 1
		 */
		var $cPayInstallmentBank_u; //uint8_t

		/**
		 * ���ڸ�������UFlag
		 *
		 * �汾 >= 1
		 */
		var $cPayInstallmentNum_u; //uint8_t

		/**
		 * ���ڸ���ÿ�ڽ��UFlag
		 *
		 * �汾 >= 1
		 */
		var $cPayInstallmentPayment_u; //uint8_t

		/**
		 * ��Ѹ���ͷ�ʽUFlag
		 *
		 * �汾 >= 1
		 */
		var $cIcsonShippingType_u; //uint8_t

		/**
		 * ��Ѹ֧����ʽUFlag
		 *
		 * �汾 >= 1
		 */
		var $cIcsonPayType_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonAccount_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonMasterLs_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonRate_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonBankRate_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonShopId_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonShopGuideId_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonShopGuideCost_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonShopGuideName_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonSubsidyType_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonSubsidyName_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonSubsidyIdCard_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSOrderOperatorId_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSOrderOperatorName_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceCompanyName_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceCompanyAddr_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceCompanyPhone_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceCompanyTaxNo_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceCompanyBankNo_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceCompanyBankName_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceRecvName_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceRecvAddr_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceRecvRegionId_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceRecvMobile_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceRecvTel_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceRecvZip_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceShipType_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonInvoiceShipFee_u; //uint8_t

		/**
		 * ��Ѹ����flag
		 *
		 * �汾 >= 1
		 */
		var $cIcsonDealFlag_u; //uint8_t

		/**
		 * ��Ѹ���������ֿ���
		 *
		 * �汾 >= 1
		 */
		var $cIcsonStockNo_u; //uint8_t

		/**
		 * ֧������
		 *
		 * �汾 >= 2
		 */
		var $cPayChannel; //uint8_t

		/**
		 * ֧��������
		 *
		 * �汾 >= 2
		 */
		var $dwPayServiceFee; //uint32_t

		/**
		 * �������ֽ��
		 *
		 * �汾 >= 2
		 */
		var $dwIcsonDealCashBack; //uint32_t

		/**
		 * ֧������UFlag
		 *
		 * �汾 >= 2
		 */
		var $cPayChannel_u; //uint8_t

		/**
		 * ֧��������UFlag
		 *
		 * �汾 >= 2
		 */
		var $cPayServiceFee_u; //uint8_t

		/**
		 * �������ֽ��UFlag
		 *
		 * �汾 >= 2
		 */
		var $cIcsonDealCashBack_u; //uint8_t

		/**
		 * ���ڸ���������
		 *
		 * �汾 >= 3
		 */
		var $dwPayInstallmentFee; //uint32_t

		/**
		 * ���ڸ���������UFlag
		 *
		 * �汾 >= 3
		 */
		var $cPayInstallmentFee_u; //uint8_t

		/**
		 * ��Ѹ�����ţ���10��ͷ
		 *
		 * �汾 >= 4
		 */
		var $strIcsonDealCode; //std::string

		/**
		 * �������ֽ��UFlag
		 *
		 * �汾 >= 4
		 */
		var $cIcsonDealCode_u; //uint8_t

		/**
		 * ��Ѹ��Ʊ����ֿ�id
		 *
		 * �汾 >= 5
		 */
		var $strIcsonInvoiceStockNo; //std::string

		/**
		 * ��Ѹ��Ʊ�����վid
		 *
		 * �汾 >= 5
		 */
		var $strIcsonInvoiceSiteId; //std::string

		/**
		 * 
		 *
		 * �汾 >= 5
		 */
		var $cIcsonInvoiceStockNo_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 5
		 */
		var $cIcsonInvoiceSiteId_u; //uint8_t

		/**
		 * ��Ѹ��Ӫ�̼�id
		 *
		 * �汾 >= 6
		 */
		var $ddwSellerCorpId; //uint64_t

		/**
		 * ��Ѹ��Ӫ���
		 *
		 * �汾 >= 6
		 */
		var $strLmsVolume; //std::string

		/**
		 * ��Ѹ��Ӫ����
		 *
		 * �汾 >= 6
		 */
		var $strLmsWeight; //std::string

		/**
		 * ��Ѹ��Ӫ���
		 *
		 * �汾 >= 6
		 */
		var $strLmsLongest; //std::string

		/**
		 * 
		 *
		 * �汾 >= 6
		 */
		var $cSellerCorpId_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 6
		 */
		var $cLmsVolume_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 6
		 */
		var $cLmsWeight_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 6
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushString($this->strDealId); // ���л�������ţ���ʽ:�������XXXXYYYY����:101041051509351702����Ϊ�� ����Ϊstd::string
			$bs->pushUint64_t($this->ddwDealId64); // ���л��������ţ����Ķ���ͬ����ʹ�ã���Ϊ�� ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwBdealId); // ���л����׵��ţ���Ϊ�� ����Ϊuint64_t
			$bs->pushString($this->strBusinessDealId); // ���л�ҵ�񶩵���ţ��������йܶ��� ����Ϊstd::string
			$bs->pushUint64_t($this->ddwBuyerId); // ���л����ID ����Ϊuint64_t
			$bs->pushString($this->strBuyerAccount); // ���л�����ʺ� ����Ϊstd::string
			$bs->pushString($this->strBuyerNickName); // ���л�������� ����Ϊstd::string
			$bs->pushString($this->strBuyerNick); // ���л�����ǳ� ����Ϊstd::string
			$bs->pushUint64_t($this->ddwSellerId); // ���л��̼�ID ����Ϊuint64_t
			$bs->pushString($this->strSellerTitle); // ���л��̼���ʵ���� ����Ϊstd::string
			$bs->pushString($this->strSellerNick); // ���л������ǳ� ����Ϊstd::string
			$bs->pushUint32_t($this->dwBusinessId); // ���л�ҵ��ID ����Ϊuint32_t
			$bs->pushUint8_t($this->cDealType); // ���л��������� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwDealSource); // ���л��µ�������1��ҵ����վ��2���ƶ�app��3���ƶ�wap ����Ϊuint32_t
			$bs->pushUint8_t($this->cDealPayType); // ���л�֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6��������� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwDealState); // ���л�����״̬ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealProperty); // ���л���������ֵ��ͨ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealProperty1); // ���л���������ֵ��ҵ��1��չ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealProperty2); // ���л���������ֵ��ҵ��2��չ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealProperty3); // ���л���������ֵ��ҵ��3��չ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealProperty4); // ���л���������ֵ��ҵ��4��չ�� ����Ϊuint32_t
			$bs->pushString($this->strItemSkuidList); // ���л���ƷskuID�б� ����Ϊstd::string
			$bs->pushString($this->strItemTitleList); // ���л���Ʒ�����б� ����Ϊstd::string
			$bs->pushUint32_t($this->dwDealTotalFee); // ���л������ܽ��,�µ���� ����Ϊuint32_t
			$bs->pushInt32_t($this->nDealAdjustFee); // ���л����۽�� ����Ϊint
			$bs->pushUint32_t($this->dwDealPayment); // ���л�ʵ���ܽ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealDownPayment); // ���л�C2BԤ�۶����� ����Ϊuint32_t
			$bs->pushInt32_t($this->nDealDiscountTotal); // ���л��Ż��ܽ��; ��б��Żݽ����� ����Ϊint
			$bs->pushUint32_t($this->dwDealItemTotalFee); // ���л���Ʒ�ӵ��ܽ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealWhoPayShippingFee); // ���л�˭֧���ʷѣ�1�����ң�2����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealShippingFee); // ���л��ʷѽ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealWhoPayCodFee); // ���л�˭�е�COD�����ѣ�1�����ҳе���2����ң�3��ƽ̨�е� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealCodFee); // ���л�COD������ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealWhoPayInsuranceFee); // ���л�˭֧�����շѣ�1���������ͣ�2����ң�3��ƽ̨�е� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealInsuranceFee); // ���л��˷ѱ��շ� ����Ϊuint32_t
			$bs->pushInt32_t($this->nDealSysAdjustFee); // ���л�ϵͳ���۽���������COD���ҵ��۽������ڴ�����COD�Żݽ�� ����Ϊint
			$bs->pushUint32_t($this->dwPayScore); // ���л�����֧��ֵ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwObtainScore); // ���л���û���ֵ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwDealGenTime); // ���л���������ʱ�� ����Ϊuint32_t
			$bs->pushString($this->strSendFromDesc); // ���л��������������� ����Ϊstd::string
			$bs->pushUint64_t($this->ddwDealSeq); // ���л��µ�ʱ��� ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwDealMd5); // ���л��µ�md5 ����Ϊuint64_t
			$bs->pushString($this->strDealIp); // ���л��µ�IP ����Ϊstd::string
			$bs->pushString($this->strDealRefer); // ���л�refer ����Ϊstd::string
			$bs->pushString($this->strDealVisitKey); // ���л�visitkey ����Ϊstd::string
			$bs->pushString($this->strPromotionDesc); // ���л�����������Ϣ���� ����Ϊstd::string
			$bs->pushString($this->strRecvName); // ���л��ջ��� ����Ϊstd::string
			$bs->pushUint32_t($this->dwRecvRegionCode); // ���л��������� ����Ϊuint32_t
			$bs->pushString($this->strRecvAddress); // ���л���ַ ����Ϊstd::string
			$bs->pushString($this->strRecvPostCode); // ���л��ʱ� ����Ϊstd::string
			$bs->pushString($this->strRecvPhone); // ���л��绰 ����Ϊstd::string
			$bs->pushUint64_t($this->ddwRecvMobile); // ���л��ֻ� ����Ϊuint64_t
			$bs->pushUint32_t($this->dwExpectRecvTime); // ���л������ջ�ʱ��,�� ����Ϊuint32_t
			$bs->pushString($this->strExpectRecvTimeSpan); // ���л������ջ�ʱ�� ����Ϊstd::string
			$bs->pushString($this->strRecvRemark); // ���л��ջ����� ����Ϊstd::string
			$bs->pushUint32_t($this->dwRecvMask); // ���л��ջ�����ֵ ����Ϊuint32_t
			$bs->pushUint8_t($this->cExpressType); // ���л����ͷ�ʽ��1��ƽ�ʣ�2����ݣ�3��EMS��4��B2C�Խ�������5���û����͵����� ����Ϊuint8_t
			$bs->pushString($this->strExpressCompanyID); // ���л�������˾ID ����Ϊstd::string
			$bs->pushString($this->strExpressCompanyName); // ���л�������˾���� ����Ϊstd::string
			$bs->pushUint8_t($this->cInvoiceType); // ���л���Ʊ���� ����Ϊuint8_t
			$bs->pushString($this->strInvoiceHead); // ���л���Ʊ̧ͷ ����Ϊstd::string
			$bs->pushString($this->strInvoiceContent); // ���л���Ʊ���� ����Ϊstd::string
			$bs->pushString($this->strCftDealId); // ���л�Cft֧������ ����Ϊstd::string
			$bs->pushUint32_t($this->dwLastUpdateTime); // ���л�������ʱ�� ����Ϊuint32_t
			$bs->pushObject($this->oTradeInfoList,'OrderTradePoList'); // ���л���Ʒ�ӵ��б� ����Ϊecc::deal::po::COrderTradePoList
			$bs->pushObject($this->oPayInfoList,'OrderPayInfoPoList'); // ���л�֧����Ϣ�� ����Ϊecc::deal::po::COrderPayInfoPoList
			$bs->pushObject($this->oActionLogInfoList,'DealActionLogPoList'); // ���л���ˮ��־�� ����Ϊecc::deal::po::CDealActionLogPoList
			$bs->pushObject($this->mmapDealExtInfoMap,'stl_multimap'); // ���л�������չ��Ϣ  ����Ϊstd::multimap<uint32_t,std::string> 
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId64_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBdealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBusinessDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerAccount_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerNickName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerNick_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerTitle_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerNick_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBusinessId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealSource_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealPayType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealProperty_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealProperty1_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealProperty2_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealProperty3_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealProperty4_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemSkuidList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemTitleList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealTotalFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealAdjustFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealPayment_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealDownPayment_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealDiscountTotal_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealItemTotalFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealWhoPayShippingFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealShippingFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealWhoPayCodFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealCodFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealWhoPayInsuranceFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealInsuranceFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealSysAdjustFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayScore_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cObtainScore_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealGenTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSendFromDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealSeq_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealMd5_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealIp_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealRefer_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealVisitKey_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPromotionDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvRegionCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvAddress_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvPostCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvPhone_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvMobile_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExpectRecvTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExpectRecvTimeSpan_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvRemark_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cRecvMask_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExpressType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExpressCompanyID_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cExpressCompanyName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cInvoiceType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cInvoiceHead_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cInvoiceContent_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cCftDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeInfoList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayInfoList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cActionLogInfoList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealExtInfoMap_u); // ���л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strBdealCode); // ���л����׵���ţ����ַ�����ʽ�Ľ��׵��ţ���Ϊ�� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strBusinessBdealId); // ���л�ҵ���׵��ţ���Ϊ�� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwSiteId); // ���л���վID ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushInt32_t($this->nDealCouponFee); // ���л��Ż�ȯ��� ����Ϊint
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwCashScore); // ���л��ֽ����֧��ֵ ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwPromotionScore); // ���л���������֧��ֵ ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strRecvRegionCodeExt); // ���л���չ�������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strDealDigest); // ���л�����ժҪ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strPayInstallmentBank); // ���л����ڸ������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint16_t($this->wPayInstallmentNum); // ���л����ڸ������� ����Ϊuint16_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint32_t($this->dwPayInstallmentPayment); // ���л����ڸ���ÿ�ڽ�� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonShippingType); // ���л���Ѹ���ͷ�ʽ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonPayType); // ���л���Ѹ֧����ʽ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonAccount); // ���л���Ѹ�ڲ��ʺ�ID ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonMasterLs); // ���л���Ѹ������Ϣ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonRate); // ���л���Ѹƽ����� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonBankRate); // ���л���Ѹ�������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonShopId); // ���л���Ѹ����id ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonShopGuideId); // ���л���Ѹ���̵���id ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonShopGuideCost); // ���л���Ѹ���̵������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonShopGuideName); // ���л���Ѹ���̵������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonSubsidyType); // ���л���Ѹ���ܲ������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonSubsidyName); // ���л���Ѹ���ܲ������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonSubsidyIdCard); // ���л���Ѹ���ܲ������֤ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSOrderOperatorId); // ���л���Ѹ�ͷ��µ�����ԱID ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSOrderOperatorName); // ���л���Ѹ�ͷ��µ�����Ա���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceCompanyName); // ���л���Ѹ��Ʊ��˾���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceCompanyAddr); // ���л���Ѹ��Ʊ��˾��ַ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceCompanyPhone); // ���л���Ѹ��Ʊ��˾�绰 ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceCompanyTaxNo); // ���л���Ѹ��Ʊ��˾˰�� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceCompanyBankNo); // ���л���Ѹ��Ʊ��˾�����˻� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceCompanyBankName); // ���л���Ѹ��Ʊ��˾�������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceRecvName); // ���л���Ѹ��Ʊ�ջ��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceRecvAddr); // ���л���Ѹ��Ʊ�ջ���ַ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceRecvRegionId); // ���л���Ѹ��Ʊ�ջ���ַID ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceRecvMobile); // ���л���Ѹ��Ʊ�ջ��ֻ� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceRecvTel); // ���л���Ѹ��Ʊ�ջ��绰 ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceRecvZip); // ���л���Ѹ��Ʊ�ջ��ʱ� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceShipType); // ���л���Ѹ��Ʊ���ͷ�ʽ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonInvoiceShipFee); // ���л���Ѹ��Ʊ���ͷ��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonDealFlag); // ���л���Ѹ����flag ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonStockNo); // ���л���Ѹ���������ֿ��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cBdealCode_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cBusinessBdealId_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cSiteId_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cDealCouponFee_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cCashScore_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cPromotionScore_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cRecvRegionCodeExt_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cDealDigest_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cPayInstallmentBank_u); // ���л����ڸ�������UFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cPayInstallmentNum_u); // ���л����ڸ�������UFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cPayInstallmentPayment_u); // ���л����ڸ���ÿ�ڽ��UFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonShippingType_u); // ���л���Ѹ���ͷ�ʽUFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonPayType_u); // ���л���Ѹ֧����ʽUFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonAccount_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonMasterLs_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonRate_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonBankRate_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonShopId_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonShopGuideId_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonShopGuideCost_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonShopGuideName_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonSubsidyType_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonSubsidyName_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonSubsidyIdCard_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSOrderOperatorId_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSOrderOperatorName_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceCompanyName_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceCompanyAddr_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceCompanyPhone_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceCompanyTaxNo_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceCompanyBankNo_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceCompanyBankName_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceRecvName_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceRecvAddr_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceRecvRegionId_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceRecvMobile_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceRecvTel_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceRecvZip_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceShipType_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonInvoiceShipFee_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonDealFlag_u); // ���л���Ѹ����flag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonStockNo_u); // ���л���Ѹ���������ֿ��� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cPayChannel); // ���л�֧������ ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwPayServiceFee); // ���л�֧�������� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwIcsonDealCashBack); // ���л��������ֽ�� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cPayChannel_u); // ���л�֧������UFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cPayServiceFee_u); // ���л�֧��������UFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cIcsonDealCashBack_u); // ���л��������ֽ��UFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 3 ){
				$bs->pushUint32_t($this->dwPayInstallmentFee); // ���л����ڸ��������� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 3 ){
				$bs->pushUint8_t($this->cPayInstallmentFee_u); // ���л����ڸ���������UFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 4 ){
				$bs->pushString($this->strIcsonDealCode); // ���л���Ѹ�����ţ���10��ͷ ����Ϊstd::string
			}
			if(  $this->wVersion >= 4 ){
				$bs->pushUint8_t($this->cIcsonDealCode_u); // ���л��������ֽ��UFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 5 ){
				$bs->pushString($this->strIcsonInvoiceStockNo); // ���л���Ѹ��Ʊ����ֿ�id ����Ϊstd::string
			}
			if(  $this->wVersion >= 5 ){
				$bs->pushString($this->strIcsonInvoiceSiteId); // ���л���Ѹ��Ʊ�����վid ����Ϊstd::string
			}
			if(  $this->wVersion >= 5 ){
				$bs->pushUint8_t($this->cIcsonInvoiceStockNo_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 5 ){
				$bs->pushUint8_t($this->cIcsonInvoiceSiteId_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 6 ){
				$bs->pushUint64_t($this->ddwSellerCorpId); // ���л���Ѹ��Ӫ�̼�id ����Ϊuint64_t
			}
			if(  $this->wVersion >= 6 ){
				$bs->pushString($this->strLmsVolume); // ���л���Ѹ��Ӫ��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 6 ){
				$bs->pushString($this->strLmsWeight); // ���л���Ѹ��Ӫ���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 6 ){
				$bs->pushString($this->strLmsLongest); // ���л���Ѹ��Ӫ��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 6 ){
				$bs->pushUint8_t($this->cSellerCorpId_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 6 ){
				$bs->pushUint8_t($this->cLmsVolume_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 6 ){
				$bs->pushUint8_t($this->cLmsWeight_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 6 ){
				$bs->pushUint8_t($this->cLmsLongest_u); // ���л� ����Ϊuint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->strDealId = $bs->popString(); // �����л�������ţ���ʽ:�������XXXXYYYY����:101041051509351702����Ϊ�� ����Ϊstd::string
			$this->ddwDealId64 = $bs->popUint64_t(); // �����л��������ţ����Ķ���ͬ����ʹ�ã���Ϊ�� ����Ϊuint64_t
			$this->ddwBdealId = $bs->popUint64_t(); // �����л����׵��ţ���Ϊ�� ����Ϊuint64_t
			$this->strBusinessDealId = $bs->popString(); // �����л�ҵ�񶩵���ţ��������йܶ��� ����Ϊstd::string
			$this->ddwBuyerId = $bs->popUint64_t(); // �����л����ID ����Ϊuint64_t
			$this->strBuyerAccount = $bs->popString(); // �����л�����ʺ� ����Ϊstd::string
			$this->strBuyerNickName = $bs->popString(); // �����л�������� ����Ϊstd::string
			$this->strBuyerNick = $bs->popString(); // �����л�����ǳ� ����Ϊstd::string
			$this->ddwSellerId = $bs->popUint64_t(); // �����л��̼�ID ����Ϊuint64_t
			$this->strSellerTitle = $bs->popString(); // �����л��̼���ʵ���� ����Ϊstd::string
			$this->strSellerNick = $bs->popString(); // �����л������ǳ� ����Ϊstd::string
			$this->dwBusinessId = $bs->popUint32_t(); // �����л�ҵ��ID ����Ϊuint32_t
			$this->cDealType = $bs->popUint8_t(); // �����л��������� ����Ϊuint8_t
			$this->dwDealSource = $bs->popUint32_t(); // �����л��µ�������1��ҵ����վ��2���ƶ�app��3���ƶ�wap ����Ϊuint32_t
			$this->cDealPayType = $bs->popUint8_t(); // �����л�֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6��������� ����Ϊuint8_t
			$this->dwDealState = $bs->popUint32_t(); // �����л�����״̬ ����Ϊuint32_t
			$this->dwDealProperty = $bs->popUint32_t(); // �����л���������ֵ��ͨ�� ����Ϊuint32_t
			$this->dwDealProperty1 = $bs->popUint32_t(); // �����л���������ֵ��ҵ��1��չ�� ����Ϊuint32_t
			$this->dwDealProperty2 = $bs->popUint32_t(); // �����л���������ֵ��ҵ��2��չ�� ����Ϊuint32_t
			$this->dwDealProperty3 = $bs->popUint32_t(); // �����л���������ֵ��ҵ��3��չ�� ����Ϊuint32_t
			$this->dwDealProperty4 = $bs->popUint32_t(); // �����л���������ֵ��ҵ��4��չ�� ����Ϊuint32_t
			$this->strItemSkuidList = $bs->popString(); // �����л���ƷskuID�б� ����Ϊstd::string
			$this->strItemTitleList = $bs->popString(); // �����л���Ʒ�����б� ����Ϊstd::string
			$this->dwDealTotalFee = $bs->popUint32_t(); // �����л������ܽ��,�µ���� ����Ϊuint32_t
			$this->nDealAdjustFee = $bs->popInt32_t(); // �����л����۽�� ����Ϊint
			$this->dwDealPayment = $bs->popUint32_t(); // �����л�ʵ���ܽ�� ����Ϊuint32_t
			$this->dwDealDownPayment = $bs->popUint32_t(); // �����л�C2BԤ�۶����� ����Ϊuint32_t
			$this->nDealDiscountTotal = $bs->popInt32_t(); // �����л��Ż��ܽ��; ��б��Żݽ����� ����Ϊint
			$this->dwDealItemTotalFee = $bs->popUint32_t(); // �����л���Ʒ�ӵ��ܽ�� ����Ϊuint32_t
			$this->dwDealWhoPayShippingFee = $bs->popUint32_t(); // �����л�˭֧���ʷѣ�1�����ң�2����� ����Ϊuint32_t
			$this->dwDealShippingFee = $bs->popUint32_t(); // �����л��ʷѽ�� ����Ϊuint32_t
			$this->dwDealWhoPayCodFee = $bs->popUint32_t(); // �����л�˭�е�COD�����ѣ�1�����ҳе���2����ң�3��ƽ̨�е� ����Ϊuint32_t
			$this->dwDealCodFee = $bs->popUint32_t(); // �����л�COD������ ����Ϊuint32_t
			$this->dwDealWhoPayInsuranceFee = $bs->popUint32_t(); // �����л�˭֧�����շѣ�1���������ͣ�2����ң�3��ƽ̨�е� ����Ϊuint32_t
			$this->dwDealInsuranceFee = $bs->popUint32_t(); // �����л��˷ѱ��շ� ����Ϊuint32_t
			$this->nDealSysAdjustFee = $bs->popInt32_t(); // �����л�ϵͳ���۽���������COD���ҵ��۽������ڴ�����COD�Żݽ�� ����Ϊint
			$this->dwPayScore = $bs->popUint32_t(); // �����л�����֧��ֵ ����Ϊuint32_t
			$this->dwObtainScore = $bs->popUint32_t(); // �����л���û���ֵ ����Ϊuint32_t
			$this->dwDealGenTime = $bs->popUint32_t(); // �����л���������ʱ�� ����Ϊuint32_t
			$this->strSendFromDesc = $bs->popString(); // �����л��������������� ����Ϊstd::string
			$this->ddwDealSeq = $bs->popUint64_t(); // �����л��µ�ʱ��� ����Ϊuint64_t
			$this->ddwDealMd5 = $bs->popUint64_t(); // �����л��µ�md5 ����Ϊuint64_t
			$this->strDealIp = $bs->popString(); // �����л��µ�IP ����Ϊstd::string
			$this->strDealRefer = $bs->popString(); // �����л�refer ����Ϊstd::string
			$this->strDealVisitKey = $bs->popString(); // �����л�visitkey ����Ϊstd::string
			$this->strPromotionDesc = $bs->popString(); // �����л�����������Ϣ���� ����Ϊstd::string
			$this->strRecvName = $bs->popString(); // �����л��ջ��� ����Ϊstd::string
			$this->dwRecvRegionCode = $bs->popUint32_t(); // �����л��������� ����Ϊuint32_t
			$this->strRecvAddress = $bs->popString(); // �����л���ַ ����Ϊstd::string
			$this->strRecvPostCode = $bs->popString(); // �����л��ʱ� ����Ϊstd::string
			$this->strRecvPhone = $bs->popString(); // �����л��绰 ����Ϊstd::string
			$this->ddwRecvMobile = $bs->popUint64_t(); // �����л��ֻ� ����Ϊuint64_t
			$this->dwExpectRecvTime = $bs->popUint32_t(); // �����л������ջ�ʱ��,�� ����Ϊuint32_t
			$this->strExpectRecvTimeSpan = $bs->popString(); // �����л������ջ�ʱ�� ����Ϊstd::string
			$this->strRecvRemark = $bs->popString(); // �����л��ջ����� ����Ϊstd::string
			$this->dwRecvMask = $bs->popUint32_t(); // �����л��ջ�����ֵ ����Ϊuint32_t
			$this->cExpressType = $bs->popUint8_t(); // �����л����ͷ�ʽ��1��ƽ�ʣ�2����ݣ�3��EMS��4��B2C�Խ�������5���û����͵����� ����Ϊuint8_t
			$this->strExpressCompanyID = $bs->popString(); // �����л�������˾ID ����Ϊstd::string
			$this->strExpressCompanyName = $bs->popString(); // �����л�������˾���� ����Ϊstd::string
			$this->cInvoiceType = $bs->popUint8_t(); // �����л���Ʊ���� ����Ϊuint8_t
			$this->strInvoiceHead = $bs->popString(); // �����л���Ʊ̧ͷ ����Ϊstd::string
			$this->strInvoiceContent = $bs->popString(); // �����л���Ʊ���� ����Ϊstd::string
			$this->strCftDealId = $bs->popString(); // �����л�Cft֧������ ����Ϊstd::string
			$this->dwLastUpdateTime = $bs->popUint32_t(); // �����л�������ʱ�� ����Ϊuint32_t
			$this->oTradeInfoList = $bs->popObject('OrderTradePoList'); // �����л���Ʒ�ӵ��б� ����Ϊecc::deal::po::COrderTradePoList
			$this->oPayInfoList = $bs->popObject('OrderPayInfoPoList'); // �����л�֧����Ϣ�� ����Ϊecc::deal::po::COrderPayInfoPoList
			$this->oActionLogInfoList = $bs->popObject('DealActionLogPoList'); // �����л���ˮ��־�� ����Ϊecc::deal::po::CDealActionLogPoList
			$this->mmapDealExtInfoMap = $bs->popObject('stl_multimap<uint32_t,stl_string>'); // �����л�������չ��Ϣ  ����Ϊstd::multimap<uint32_t,std::string> 
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId64_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBdealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBusinessDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerAccount_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerNickName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerNick_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerTitle_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerNick_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBusinessId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealSource_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealPayType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealProperty_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealProperty1_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealProperty2_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealProperty3_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealProperty4_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemSkuidList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemTitleList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealTotalFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealAdjustFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealPayment_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealDownPayment_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealDiscountTotal_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealItemTotalFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealWhoPayShippingFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealShippingFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealWhoPayCodFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealCodFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealWhoPayInsuranceFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealInsuranceFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealSysAdjustFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayScore_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cObtainScore_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealGenTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSendFromDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealSeq_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealMd5_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealIp_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealRefer_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealVisitKey_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPromotionDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvRegionCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvAddress_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvPostCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvPhone_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvMobile_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExpectRecvTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExpectRecvTimeSpan_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvRemark_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cRecvMask_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExpressType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExpressCompanyID_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cExpressCompanyName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cInvoiceType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cInvoiceHead_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cInvoiceContent_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cCftDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cActionLogInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealExtInfoMap_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$this->strBdealCode = $bs->popString(); // �����л����׵���ţ����ַ�����ʽ�Ľ��׵��ţ���Ϊ�� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strBusinessBdealId = $bs->popString(); // �����л�ҵ���׵��ţ���Ϊ�� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->dwSiteId = $bs->popUint32_t(); // �����л���վID ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->nDealCouponFee = $bs->popInt32_t(); // �����л��Ż�ȯ��� ����Ϊint
			}
			if(  $this->wVersion >= 1 ){
				$this->dwCashScore = $bs->popUint32_t(); // �����л��ֽ����֧��ֵ ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->dwPromotionScore = $bs->popUint32_t(); // �����л���������֧��ֵ ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->strRecvRegionCodeExt = $bs->popString(); // �����л���չ�������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strDealDigest = $bs->popString(); // �����л�����ժҪ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strPayInstallmentBank = $bs->popString(); // �����л����ڸ������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->wPayInstallmentNum = $bs->popUint16_t(); // �����л����ڸ������� ����Ϊuint16_t
			}
			if(  $this->wVersion >= 1 ){
				$this->dwPayInstallmentPayment = $bs->popUint32_t(); // �����л����ڸ���ÿ�ڽ�� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonShippingType = $bs->popString(); // �����л���Ѹ���ͷ�ʽ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonPayType = $bs->popString(); // �����л���Ѹ֧����ʽ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonAccount = $bs->popString(); // �����л���Ѹ�ڲ��ʺ�ID ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonMasterLs = $bs->popString(); // �����л���Ѹ������Ϣ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonRate = $bs->popString(); // �����л���Ѹƽ����� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonBankRate = $bs->popString(); // �����л���Ѹ�������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonShopId = $bs->popString(); // �����л���Ѹ����id ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonShopGuideId = $bs->popString(); // �����л���Ѹ���̵���id ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonShopGuideCost = $bs->popString(); // �����л���Ѹ���̵������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonShopGuideName = $bs->popString(); // �����л���Ѹ���̵������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonSubsidyType = $bs->popString(); // �����л���Ѹ���ܲ������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonSubsidyName = $bs->popString(); // �����л���Ѹ���ܲ������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonSubsidyIdCard = $bs->popString(); // �����л���Ѹ���ܲ������֤ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSOrderOperatorId = $bs->popString(); // �����л���Ѹ�ͷ��µ�����ԱID ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSOrderOperatorName = $bs->popString(); // �����л���Ѹ�ͷ��µ�����Ա���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceCompanyName = $bs->popString(); // �����л���Ѹ��Ʊ��˾���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceCompanyAddr = $bs->popString(); // �����л���Ѹ��Ʊ��˾��ַ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceCompanyPhone = $bs->popString(); // �����л���Ѹ��Ʊ��˾�绰 ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceCompanyTaxNo = $bs->popString(); // �����л���Ѹ��Ʊ��˾˰�� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceCompanyBankNo = $bs->popString(); // �����л���Ѹ��Ʊ��˾�����˻� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceCompanyBankName = $bs->popString(); // �����л���Ѹ��Ʊ��˾�������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceRecvName = $bs->popString(); // �����л���Ѹ��Ʊ�ջ��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceRecvAddr = $bs->popString(); // �����л���Ѹ��Ʊ�ջ���ַ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceRecvRegionId = $bs->popString(); // �����л���Ѹ��Ʊ�ջ���ַID ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceRecvMobile = $bs->popString(); // �����л���Ѹ��Ʊ�ջ��ֻ� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceRecvTel = $bs->popString(); // �����л���Ѹ��Ʊ�ջ��绰 ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceRecvZip = $bs->popString(); // �����л���Ѹ��Ʊ�ջ��ʱ� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceShipType = $bs->popString(); // �����л���Ѹ��Ʊ���ͷ�ʽ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonInvoiceShipFee = $bs->popString(); // �����л���Ѹ��Ʊ���ͷ��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonDealFlag = $bs->popString(); // �����л���Ѹ����flag ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonStockNo = $bs->popString(); // �����л���Ѹ���������ֿ��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cBdealCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cBusinessBdealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cSiteId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cDealCouponFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cCashScore_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cPromotionScore_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cRecvRegionCodeExt_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cDealDigest_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cPayInstallmentBank_u = $bs->popUint8_t(); // �����л����ڸ�������UFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cPayInstallmentNum_u = $bs->popUint8_t(); // �����л����ڸ�������UFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cPayInstallmentPayment_u = $bs->popUint8_t(); // �����л����ڸ���ÿ�ڽ��UFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonShippingType_u = $bs->popUint8_t(); // �����л���Ѹ���ͷ�ʽUFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonPayType_u = $bs->popUint8_t(); // �����л���Ѹ֧����ʽUFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonAccount_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonMasterLs_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonRate_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonBankRate_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonShopId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonShopGuideId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonShopGuideCost_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonShopGuideName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonSubsidyType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonSubsidyName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonSubsidyIdCard_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSOrderOperatorId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSOrderOperatorName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceCompanyName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceCompanyAddr_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceCompanyPhone_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceCompanyTaxNo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceCompanyBankNo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceCompanyBankName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceRecvName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceRecvAddr_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceRecvRegionId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceRecvMobile_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceRecvTel_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceRecvZip_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceShipType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonInvoiceShipFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonDealFlag_u = $bs->popUint8_t(); // �����л���Ѹ����flag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonStockNo_u = $bs->popUint8_t(); // �����л���Ѹ���������ֿ��� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cPayChannel = $bs->popUint8_t(); // �����л�֧������ ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwPayServiceFee = $bs->popUint32_t(); // �����л�֧�������� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwIcsonDealCashBack = $bs->popUint32_t(); // �����л��������ֽ�� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cPayChannel_u = $bs->popUint8_t(); // �����л�֧������UFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cPayServiceFee_u = $bs->popUint8_t(); // �����л�֧��������UFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cIcsonDealCashBack_u = $bs->popUint8_t(); // �����л��������ֽ��UFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 3 ){
				$this->dwPayInstallmentFee = $bs->popUint32_t(); // �����л����ڸ��������� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 3 ){
				$this->cPayInstallmentFee_u = $bs->popUint8_t(); // �����л����ڸ���������UFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 4 ){
				$this->strIcsonDealCode = $bs->popString(); // �����л���Ѹ�����ţ���10��ͷ ����Ϊstd::string
			}
			if(  $this->wVersion >= 4 ){
				$this->cIcsonDealCode_u = $bs->popUint8_t(); // �����л��������ֽ��UFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 5 ){
				$this->strIcsonInvoiceStockNo = $bs->popString(); // �����л���Ѹ��Ʊ����ֿ�id ����Ϊstd::string
			}
			if(  $this->wVersion >= 5 ){
				$this->strIcsonInvoiceSiteId = $bs->popString(); // �����л���Ѹ��Ʊ�����վid ����Ϊstd::string
			}
			if(  $this->wVersion >= 5 ){
				$this->cIcsonInvoiceStockNo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 5 ){
				$this->cIcsonInvoiceSiteId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 6 ){
				$this->ddwSellerCorpId = $bs->popUint64_t(); // �����л���Ѹ��Ӫ�̼�id ����Ϊuint64_t
			}
			if(  $this->wVersion >= 6 ){
				$this->strLmsVolume = $bs->popString(); // �����л���Ѹ��Ӫ��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 6 ){
				$this->strLmsWeight = $bs->popString(); // �����л���Ѹ��Ӫ���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 6 ){
				$this->strLmsLongest = $bs->popString(); // �����л���Ѹ��Ӫ��� ����Ϊstd::string
			}
			if(  $this->wVersion >= 6 ){
				$this->cSellerCorpId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 6 ){
				$this->cLmsVolume_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 6 ){
				$this->cLmsWeight_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 6 ){
				$this->cLmsLongest_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}

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


//source idl: com.ecc.deal.idl.OrderPo.java

if (!class_exists('OrderTradePoList')) {
class OrderTradePoList
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ��Ʒ���б�
		 *
		 * �汾 >= 0
		 */
		var $vecTradeInfoList; //std::vector<ecc::deal::po::COrderTradePo> 

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushObject($this->vecTradeInfoList,'stl_vector'); // ���л���Ʒ���б� ����Ϊstd::vector<ecc::deal::po::COrderTradePo> 
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeInfoList_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->vecTradeInfoList = $bs->popObject('stl_vector<OrderTradePo>'); // �����л���Ʒ���б� ����Ϊstd::vector<ecc::deal::po::COrderTradePo> 
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.ecc.deal.idl.OrderTradePoList.java

if (!class_exists('OrderTradePo')) {
class OrderTradePo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ������ţ���Ϊ��
		 *
		 * �汾 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * �������ţ����Ķ���ͬ����ʹ�ã���Ϊ��
		 *
		 * �汾 >= 0
		 */
		var $ddwDealId64; //uint64_t

		/**
		 * ���׵��ţ���Ϊ��
		 *
		 * �汾 >= 0
		 */
		var $ddwBdealId; //uint64_t

		/**
		 * ��Ʒ�����ţ����Ķ���ͬ����ʹ�ã���Ϊ��
		 *
		 * �汾 >= 0
		 */
		var $ddwTradeId; //uint64_t

		/**
		 * ���ID
		 *
		 * �汾 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * ����ǳ�
		 *
		 * �汾 >= 0
		 */
		var $strBuyerNickName; //std::string

		/**
		 * �̼�ID
		 *
		 * �汾 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * �̼�����
		 *
		 * �汾 >= 0
		 */
		var $strSellerTitle; //std::string

		/**
		 * ҵ��ID
		 *
		 * �汾 >= 0
		 */
		var $dwBusinessId; //uint32_t

		/**
		 * ��������
		 *
		 * �汾 >= 0
		 */
		var $cTradeType; //uint8_t

		/**
		 * �µ�������1��ҵ����վ��2���ƶ�app��3���ƶ�wap
		 *
		 * �汾 >= 0
		 */
		var $dwTradeSource; //uint32_t

		/**
		 * ֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6���������
		 *
		 * �汾 >= 0
		 */
		var $cTradePayType; //uint8_t

		/**
		 * �˷�ģ��ID
		 *
		 * �汾 >= 0
		 */
		var $strShippingfeeTemplateId; //std::string

		/**
		 * �˷�����
		 *
		 * �汾 >= 0
		 */
		var $strShippingfeeDesc; //std::string

		/**
		 * ��Ʒ�˷�,����������㣬ֻ��չʾ����Ʒϵͳ����
		 *
		 * �汾 >= 0
		 */
		var $dwItemShippingfee; //uint32_t

		/**
		 * ��Ʒ���ͣ�1����ͨ��Ʒ��2���ײ�����Ʒ��3���ײ͸���Ʒ��4����Ʒ����Ʒ��5����Ʒ����Ʒ; 6: ���
		 *
		 * �汾 >= 0
		 */
		var $dwItemType; //uint32_t

		/**
		 * Ʒ�ࣨ��Ŀ��ID
		 *
		 * �汾 >= 0
		 */
		var $dwItemClassId; //uint32_t

		/**
		 * ��Ʒ����
		 *
		 * �汾 >= 0
		 */
		var $strItemTitle; //std::string

		/**
		 * ��Ʒ�������Ա���
		 *
		 * �汾 >= 0
		 */
		var $strItemAttrCode; //std::string

		/**
		 * ��Ʒ������������
		 *
		 * �汾 >= 0
		 */
		var $strItemAttr; //std::string

		/**
		 * ��ƷID����ҵ����
		 *
		 * �汾 >= 0
		 */
		var $strItemId; //std::string

		/**
		 * ��ƷSKUID
		 *
		 * �汾 >= 0
		 */
		var $ddwItemSkuId; //uint64_t

		/**
		 * ��Ʒ�̼ұ��ر���
		 *
		 * �汾 >= 0
		 */
		var $strItemLocalCode; //std::string

		/**
		 * ��Ʒ�̼ұ��ؿ�����
		 *
		 * �汾 >= 0
		 */
		var $strItemLocalStockCode; //std::string

		/**
		 * ��Ʒ������
		 *
		 * �汾 >= 0
		 */
		var $strItemBarCode; //std::string

		/**
		 * ��ƷSPUID
		 *
		 * �汾 >= 0
		 */
		var $ddwItemSpuId; //uint64_t

		/**
		 * ��Ʒ���ID
		 *
		 * �汾 >= 0
		 */
		var $ddwItemStockId; //uint64_t

		/**
		 * ��Ʒ�ֿ�ID
		 *
		 * �汾 >= 0
		 */
		var $dwItemStoreHouseId; //uint32_t

		/**
		 * ��Ʒ���������
		 *
		 * �汾 >= 0
		 */
		var $strItemPhyisicalStorage; //std::string

		/**
		 * ��ƷͼƬLogo
		 *
		 * �汾 >= 0
		 */
		var $strItemLogo; //std::string

		/**
		 * ��Ʒ���հ汾��
		 *
		 * �汾 >= 0
		 */
		var $dwItemSnapVersion; //uint32_t

		/**
		 * ��Ʒ����ʱ���
		 *
		 * �汾 >= 0
		 */
		var $dwItemResetTime; //uint32_t

		/**
		 * ��Ʒ����
		 *
		 * �汾 >= 0
		 */
		var $dwItemWeight; //uint32_t

		/**
		 * ��Ʒ���
		 *
		 * �汾 >= 0
		 */
		var $dwItemVolume; //uint32_t

		/**
		 * ��Ʒ�ײ�����ƷID
		 *
		 * �汾 >= 0
		 */
		var $ddwMainItemId; //uint64_t

		/**
		 * ��Ʒ����˵��
		 *
		 * �汾 >= 0
		 */
		var $strItemAccessoryDesc; //std::string

		/**
		 * ��Ʒ�ɱ���
		 *
		 * �汾 >= 0
		 */
		var $dwItemCostPrice; //uint32_t

		/**
		 * ��Ʒ�г���
		 *
		 * �汾 >= 0
		 */
		var $dwItemOriginPrice; //uint32_t

		/**
		 * ��Ʒ���۵���
		 *
		 * �汾 >= 0
		 */
		var $dwItemSoldPrice; //uint32_t

		/**
		 * ��ӪB2C�г�
		 *
		 * �汾 >= 0
		 */
		var $strItemB2CMarket; //std::string

		/**
		 * ��ӪB2CPM
		 *
		 * �汾 >= 0
		 */
		var $strItemB2CPM; //std::string

		/**
		 * ��ӪB2C�Ƿ�ռ�����
		 *
		 * �汾 >= 0
		 */
		var $cItemUseVirtualStock; //uint8_t

		/**
		 * ��Ʒ�ɽ���
		 *
		 * �汾 >= 0
		 */
		var $dwBuyPrice; //uint32_t

		/**
		 * ��Ʒ�ɽ�����
		 *
		 * �汾 >= 0
		 */
		var $dwBuyNum; //uint32_t

		/**
		 * ��Ʒ���ܽ��,�µ����
		 *
		 * �汾 >= 0
		 */
		var $dwTradeTotalFee; //uint32_t

		/**
		 * ��Ʒ�����۽��
		 *
		 * �汾 >= 0
		 */
		var $nTradeAdjustFee; //int

		/**
		 * ʵ���ܽ��
		 *
		 * �汾 >= 0
		 */
		var $dwTradePayment; //uint32_t

		/**
		 * �Ż��ܽ��
		 *
		 * �汾 >= 0
		 */
		var $nTradeDiscountTotal; //int

		/**
		 * Paipai���ʹ�ý��
		 *
		 * �汾 >= 0
		 */
		var $dwTradePaipaiHongbaoUsed; //uint32_t

		/**
		 * ����֧��ֵ
		 *
		 * �汾 >= 0
		 */
		var $dwPayScore; //uint32_t

		/**
		 * ��Ʒ������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwTradeGenTime; //uint32_t

		/**
		 * ��Ʒ�����������к�
		 *
		 * �汾 >= 0
		 */
		var $wTradeOpSerialNo; //uint16_t

		/**
		 * ��û���ֵ
		 *
		 * �汾 >= 0
		 */
		var $dwObtainScore; //uint32_t

		/**
		 * ��Ʒ��״̬
		 *
		 * �汾 >= 0
		 */
		var $dwTradeState; //uint32_t

		/**
		 * ��Ʒ������ֵ
		 *
		 * �汾 >= 0
		 */
		var $dwTradeProperty; //uint32_t

		/**
		 * ��Ʒ������ֵ1
		 *
		 * �汾 >= 0
		 */
		var $dwTradeProperty1; //uint32_t

		/**
		 * ��Ʒ������ֵ2
		 *
		 * �汾 >= 0
		 */
		var $dwTradeProperty2; //uint32_t

		/**
		 * ��Ʒ������ֵ3
		 *
		 * �汾 >= 0
		 */
		var $dwTradeProperty3; //uint32_t

		/**
		 * ��Ʒ������ֵ4
		 *
		 * �汾 >= 0
		 */
		var $dwTradeProperty4; //uint32_t

		/**
		 * ��Ʒ��ʱ��ʶ
		 *
		 * �汾 >= 0
		 */
		var $dwItemTimeoutFlag; //uint32_t

		/**
		 * ������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * ��Ʒ��б�
		 *
		 * �汾 >= 0
		 */
		var $oActiveInfoList; //ecc::deal::po::CTradeActivePoList

		/**
		 * ������չ��Ϣ 
		 *
		 * �汾 >= 0
		 */
		var $mmapDealExtInfoMap; //std::multimap<uint32_t,std::string> 

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId64_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBdealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerNickName_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerTitle_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBusinessId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeSource_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradePayType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cShippingfeeTemplateId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cShippingfeeDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemShippingfee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemClassId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemTitle_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemAttrCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemAttr_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemSkuId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemLocalCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemLocalStockCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemBarCode_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemSpuId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemStockId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemStoreHouseId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemPhyisicalStorage_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemLogo_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemSnapVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemResetTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemWeight_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemVolume_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cMainItemId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemAccessoryDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemCostPrice_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemOriginPrice_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemSoldPrice_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemB2CMarket_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemB2CPM_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemUseVirtualStock_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyPrice_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyNum_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeTotalFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeAdjustFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradePayment_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeDiscountTotal_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradePaipaiHongbaoUsed_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayScore_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeGenTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeOpSerialNo_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cObtainScore_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeProperty_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeProperty1_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeProperty2_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeProperty3_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeProperty4_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemTimeoutFlag_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cActiveInfoList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealExtInfoMap_u; //uint8_t

		/**
		 * ��������
		 *
		 * �汾 >= 1
		 */
		var $strWarranty; //std::string

		/**
		 * ��Ʒid
		 *
		 * �汾 >= 1
		 */
		var $ddwProductId; //uint64_t

		/**
		 * ��Ʒid����
		 *
		 * �汾 >= 1
		 */
		var $strProductCode; //std::string

		/**
		 * ��Ѹedm����
		 *
		 * �汾 >= 1
		 */
		var $strIcsonEdmCode; //std::string

		/**
		 * ��ѸOTag
		 *
		 * �汾 >= 1
		 */
		var $strIcsonOTag; //std::string

		/**
		 * ��Ѹ���̵�������
		 *
		 * �汾 >= 1
		 */
		var $strIcsonTradeShopGuideCost; //std::string

		/**
		 * ��Ѹ���ƻ�����
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneType; //std::string

		/**
		 * ��Ѹ���ƻ���Ӫ��
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneOperator; //std::string

		/**
		 * ��Ѹ���ƻ�����
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneNumber; //std::string

		/**
		 * ��Ѹ���ƻ�������
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneArea; //std::string

		/**
		 * ��Ѹ���ƻ��ײ�id
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhonePackageId; //std::string

		/**
		 * ��Ѹ���ƻ��û�����
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneUserName; //std::string

		/**
		 * ��Ѹ���ƻ��û���ַ
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneUserAddr; //std::string

		/**
		 * ��Ѹ���ƻ��û���ϵ�ֻ�
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneUserMobile; //std::string

		/**
		 * ��Ѹ���ƻ��û���ϵ�绰
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneUserTel; //std::string

		/**
		 * ��Ѹ���ƻ����֤����
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneIdCardNo; //std::string

		/**
		 * ��Ѹ���ƻ����֤��ַ
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneIdCardAddr; //std::string

		/**
		 * ��Ѹ���ƻ����֤��Ч��
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneIdCardDate; //std::string

		/**
		 * ��Ѹ���ƻ���������
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneZipCode; //std::string

		/**
		 * ��Ѹ���ƻ����۸�
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhoneCardPrice; //std::string

		/**
		 * ��Ѹ���ƻ��ײͼ۸�
		 *
		 * �汾 >= 1
		 */
		var $strIcsonCSPhonePackagePrice; //std::string

		/**
		 * ��Ѹ��Ʒ�ӵ�flag
		 *
		 * �汾 >= 1
		 */
		var $strIcsonTradeFlag; //std::string

		/**
		 * ��Ѹ���ֶһ�����
		 *
		 * �汾 >= 1
		 */
		var $strIcsonPointType; //std::string

		/**
		 * ��Ѹ��Ʒ�ӵ��ײ�id
		 *
		 * �汾 >= 1
		 */
		var $strIcsonPackageIds; //std::string

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cWarranty_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cProductId_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cProductCode_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonEdmCode_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonOTag_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonTradeShopGuideCost_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneType_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneOperator_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneNumber_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneArea_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhonePackageId_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneUserName_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneUserAddr_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneUserMobile_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneUserTel_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneIdCardNo_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneIdCardAddr_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneIdCardDate_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneZipCode_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhoneCardPrice_u; //uint8_t

		/**
		 * 
		 *
		 * �汾 >= 1
		 */
		var $cIcsonCSPhonePackagePrice_u; //uint8_t

		/**
		 * ��Ѹ��Ʒ�ӵ�flag
		 *
		 * �汾 >= 1
		 */
		var $cIcsonTradeFlag_u; //uint8_t

		/**
		 * ��Ѹ���ֶһ�����
		 *
		 * �汾 >= 1
		 */
		var $cIcsonPointType_u; //uint8_t

		/**
		 * ��Ѹ��Ʒ�ӵ��ײ�id
		 *
		 * �汾 >= 1
		 */
		var $cIcsonPackageIds_u; //uint8_t

		/**
		 * �ӵ����ֽ��
		 *
		 * �汾 >= 2
		 */
		var $dwIcsonTradeCashBack; //uint32_t

		/**
		 * �ӵ����ֽ��UFlag
		 *
		 * �汾 >= 2
		 */
		var $cIcsonTradeCashBack_u; //uint8_t

		/**
		 * ȥ˰��ɱ�
		 *
		 * �汾 >= 3
		 */
		var $strIcsonUnitCostInvoice; //std::string

		/**
		 * ȥ˰��ɱ�UFlag
		 *
		 * �汾 >= 3
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushString($this->strDealId); // ���л�������ţ���Ϊ�� ����Ϊstd::string
			$bs->pushUint64_t($this->ddwDealId64); // ���л��������ţ����Ķ���ͬ����ʹ�ã���Ϊ�� ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwBdealId); // ���л����׵��ţ���Ϊ�� ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwTradeId); // ���л���Ʒ�����ţ����Ķ���ͬ����ʹ�ã���Ϊ�� ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwBuyerId); // ���л����ID ����Ϊuint64_t
			$bs->pushString($this->strBuyerNickName); // ���л�����ǳ� ����Ϊstd::string
			$bs->pushUint64_t($this->ddwSellerId); // ���л��̼�ID ����Ϊuint64_t
			$bs->pushString($this->strSellerTitle); // ���л��̼����� ����Ϊstd::string
			$bs->pushUint32_t($this->dwBusinessId); // ���л�ҵ��ID ����Ϊuint32_t
			$bs->pushUint8_t($this->cTradeType); // ���л��������� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwTradeSource); // ���л��µ�������1��ҵ����վ��2���ƶ�app��3���ƶ�wap ����Ϊuint32_t
			$bs->pushUint8_t($this->cTradePayType); // ���л�֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6��������� ����Ϊuint8_t
			$bs->pushString($this->strShippingfeeTemplateId); // ���л��˷�ģ��ID ����Ϊstd::string
			$bs->pushString($this->strShippingfeeDesc); // ���л��˷����� ����Ϊstd::string
			$bs->pushUint32_t($this->dwItemShippingfee); // ���л���Ʒ�˷�,����������㣬ֻ��չʾ����Ʒϵͳ���� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwItemType); // ���л���Ʒ���ͣ�1����ͨ��Ʒ��2���ײ�����Ʒ��3���ײ͸���Ʒ��4����Ʒ����Ʒ��5����Ʒ����Ʒ; 6: ��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwItemClassId); // ���л�Ʒ�ࣨ��Ŀ��ID ����Ϊuint32_t
			$bs->pushString($this->strItemTitle); // ���л���Ʒ���� ����Ϊstd::string
			$bs->pushString($this->strItemAttrCode); // ���л���Ʒ�������Ա��� ����Ϊstd::string
			$bs->pushString($this->strItemAttr); // ���л���Ʒ������������ ����Ϊstd::string
			$bs->pushString($this->strItemId); // ���л���ƷID����ҵ���� ����Ϊstd::string
			$bs->pushUint64_t($this->ddwItemSkuId); // ���л���ƷSKUID ����Ϊuint64_t
			$bs->pushString($this->strItemLocalCode); // ���л���Ʒ�̼ұ��ر��� ����Ϊstd::string
			$bs->pushString($this->strItemLocalStockCode); // ���л���Ʒ�̼ұ��ؿ����� ����Ϊstd::string
			$bs->pushString($this->strItemBarCode); // ���л���Ʒ������ ����Ϊstd::string
			$bs->pushUint64_t($this->ddwItemSpuId); // ���л���ƷSPUID ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwItemStockId); // ���л���Ʒ���ID ����Ϊuint64_t
			$bs->pushUint32_t($this->dwItemStoreHouseId); // ���л���Ʒ�ֿ�ID ����Ϊuint32_t
			$bs->pushString($this->strItemPhyisicalStorage); // ���л���Ʒ��������� ����Ϊstd::string
			$bs->pushString($this->strItemLogo); // ���л���ƷͼƬLogo ����Ϊstd::string
			$bs->pushUint32_t($this->dwItemSnapVersion); // ���л���Ʒ���հ汾�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwItemResetTime); // ���л���Ʒ����ʱ��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwItemWeight); // ���л���Ʒ���� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwItemVolume); // ���л���Ʒ��� ����Ϊuint32_t
			$bs->pushUint64_t($this->ddwMainItemId); // ���л���Ʒ�ײ�����ƷID ����Ϊuint64_t
			$bs->pushString($this->strItemAccessoryDesc); // ���л���Ʒ����˵�� ����Ϊstd::string
			$bs->pushUint32_t($this->dwItemCostPrice); // ���л���Ʒ�ɱ��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwItemOriginPrice); // ���л���Ʒ�г��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwItemSoldPrice); // ���л���Ʒ���۵��� ����Ϊuint32_t
			$bs->pushString($this->strItemB2CMarket); // ���л���ӪB2C�г� ����Ϊstd::string
			$bs->pushString($this->strItemB2CPM); // ���л���ӪB2CPM ����Ϊstd::string
			$bs->pushUint8_t($this->cItemUseVirtualStock); // ���л���ӪB2C�Ƿ�ռ����� ����Ϊuint8_t
			$bs->pushUint32_t($this->dwBuyPrice); // ���л���Ʒ�ɽ��� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwBuyNum); // ���л���Ʒ�ɽ����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeTotalFee); // ���л���Ʒ���ܽ��,�µ���� ����Ϊuint32_t
			$bs->pushInt32_t($this->nTradeAdjustFee); // ���л���Ʒ�����۽�� ����Ϊint
			$bs->pushUint32_t($this->dwTradePayment); // ���л�ʵ���ܽ�� ����Ϊuint32_t
			$bs->pushInt32_t($this->nTradeDiscountTotal); // ���л��Ż��ܽ�� ����Ϊint
			$bs->pushUint32_t($this->dwTradePaipaiHongbaoUsed); // ���л�Paipai���ʹ�ý�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayScore); // ���л�����֧��ֵ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeGenTime); // ���л���Ʒ������ʱ�� ����Ϊuint32_t
			$bs->pushUint16_t($this->wTradeOpSerialNo); // ���л���Ʒ�����������к� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwObtainScore); // ���л���û���ֵ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeState); // ���л���Ʒ��״̬ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeProperty); // ���л���Ʒ������ֵ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeProperty1); // ���л���Ʒ������ֵ1 ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeProperty2); // ���л���Ʒ������ֵ2 ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeProperty3); // ���л���Ʒ������ֵ3 ����Ϊuint32_t
			$bs->pushUint32_t($this->dwTradeProperty4); // ���л���Ʒ������ֵ4 ����Ϊuint32_t
			$bs->pushUint32_t($this->dwItemTimeoutFlag); // ���л���Ʒ��ʱ��ʶ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // ���л�������ʱ�� ����Ϊuint32_t
			$bs->pushObject($this->oActiveInfoList,'TradeActivePoList'); // ���л���Ʒ��б� ����Ϊecc::deal::po::CTradeActivePoList
			$bs->pushObject($this->mmapDealExtInfoMap,'stl_multimap'); // ���л�������չ��Ϣ  ����Ϊstd::multimap<uint32_t,std::string> 
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId64_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBdealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerNickName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerTitle_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBusinessId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeSource_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradePayType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cShippingfeeTemplateId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cShippingfeeDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemShippingfee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemClassId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemTitle_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemAttrCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemAttr_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemSkuId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemLocalCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemLocalStockCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemBarCode_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemSpuId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemStockId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemStoreHouseId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemPhyisicalStorage_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemLogo_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemSnapVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemResetTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemWeight_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemVolume_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cMainItemId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemAccessoryDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemCostPrice_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemOriginPrice_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemSoldPrice_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemB2CMarket_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemB2CPM_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemUseVirtualStock_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyPrice_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyNum_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeTotalFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeAdjustFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradePayment_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeDiscountTotal_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradePaipaiHongbaoUsed_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayScore_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeGenTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeOpSerialNo_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cObtainScore_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeProperty_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeProperty1_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeProperty2_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeProperty3_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeProperty4_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemTimeoutFlag_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cActiveInfoList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealExtInfoMap_u); // ���л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strWarranty); // ���л��������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint64_t($this->ddwProductId); // ���л���Ʒid ����Ϊuint64_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strProductCode); // ���л���Ʒid���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonEdmCode); // ���л���Ѹedm���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonOTag); // ���л���ѸOTag ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonTradeShopGuideCost); // ���л���Ѹ���̵������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneType); // ���л���Ѹ���ƻ����� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneOperator); // ���л���Ѹ���ƻ���Ӫ�� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneNumber); // ���л���Ѹ���ƻ����� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneArea); // ���л���Ѹ���ƻ������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhonePackageId); // ���л���Ѹ���ƻ��ײ�id ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneUserName); // ���л���Ѹ���ƻ��û����� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneUserAddr); // ���л���Ѹ���ƻ��û���ַ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneUserMobile); // ���л���Ѹ���ƻ��û���ϵ�ֻ� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneUserTel); // ���л���Ѹ���ƻ��û���ϵ�绰 ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneIdCardNo); // ���л���Ѹ���ƻ����֤���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneIdCardAddr); // ���л���Ѹ���ƻ����֤��ַ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneIdCardDate); // ���л���Ѹ���ƻ����֤��Ч�� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneZipCode); // ���л���Ѹ���ƻ��������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhoneCardPrice); // ���л���Ѹ���ƻ����۸� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonCSPhonePackagePrice); // ���л���Ѹ���ƻ��ײͼ۸� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonTradeFlag); // ���л���Ѹ��Ʒ�ӵ�flag ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonPointType); // ���л���Ѹ���ֶһ����� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushString($this->strIcsonPackageIds); // ���л���Ѹ��Ʒ�ӵ��ײ�id ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cWarranty_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cProductId_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cProductCode_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonEdmCode_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonOTag_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonTradeShopGuideCost_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneType_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneOperator_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneNumber_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneArea_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhonePackageId_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneUserName_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneUserAddr_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneUserMobile_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneUserTel_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneIdCardNo_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneIdCardAddr_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneIdCardDate_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneZipCode_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhoneCardPrice_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonCSPhonePackagePrice_u); // ���л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonTradeFlag_u); // ���л���Ѹ��Ʒ�ӵ�flag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonPointType_u); // ���л���Ѹ���ֶһ����� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonPackageIds_u); // ���л���Ѹ��Ʒ�ӵ��ײ�id ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwIcsonTradeCashBack); // ���л��ӵ����ֽ�� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cIcsonTradeCashBack_u); // ���л��ӵ����ֽ��UFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 3 ){
				$bs->pushString($this->strIcsonUnitCostInvoice); // ���л�ȥ˰��ɱ� ����Ϊstd::string
			}
			if(  $this->wVersion >= 3 ){
				$bs->pushUint8_t($this->cIcsonUnitCostInvoice_u); // ���л�ȥ˰��ɱ�UFlag ����Ϊuint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->strDealId = $bs->popString(); // �����л�������ţ���Ϊ�� ����Ϊstd::string
			$this->ddwDealId64 = $bs->popUint64_t(); // �����л��������ţ����Ķ���ͬ����ʹ�ã���Ϊ�� ����Ϊuint64_t
			$this->ddwBdealId = $bs->popUint64_t(); // �����л����׵��ţ���Ϊ�� ����Ϊuint64_t
			$this->ddwTradeId = $bs->popUint64_t(); // �����л���Ʒ�����ţ����Ķ���ͬ����ʹ�ã���Ϊ�� ����Ϊuint64_t
			$this->ddwBuyerId = $bs->popUint64_t(); // �����л����ID ����Ϊuint64_t
			$this->strBuyerNickName = $bs->popString(); // �����л�����ǳ� ����Ϊstd::string
			$this->ddwSellerId = $bs->popUint64_t(); // �����л��̼�ID ����Ϊuint64_t
			$this->strSellerTitle = $bs->popString(); // �����л��̼����� ����Ϊstd::string
			$this->dwBusinessId = $bs->popUint32_t(); // �����л�ҵ��ID ����Ϊuint32_t
			$this->cTradeType = $bs->popUint8_t(); // �����л��������� ����Ϊuint8_t
			$this->dwTradeSource = $bs->popUint32_t(); // �����л��µ�������1��ҵ����վ��2���ƶ�app��3���ƶ�wap ����Ϊuint32_t
			$this->cTradePayType = $bs->popUint8_t(); // �����л�֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6��������� ����Ϊuint8_t
			$this->strShippingfeeTemplateId = $bs->popString(); // �����л��˷�ģ��ID ����Ϊstd::string
			$this->strShippingfeeDesc = $bs->popString(); // �����л��˷����� ����Ϊstd::string
			$this->dwItemShippingfee = $bs->popUint32_t(); // �����л���Ʒ�˷�,����������㣬ֻ��չʾ����Ʒϵͳ���� ����Ϊuint32_t
			$this->dwItemType = $bs->popUint32_t(); // �����л���Ʒ���ͣ�1����ͨ��Ʒ��2���ײ�����Ʒ��3���ײ͸���Ʒ��4����Ʒ����Ʒ��5����Ʒ����Ʒ; 6: ��� ����Ϊuint32_t
			$this->dwItemClassId = $bs->popUint32_t(); // �����л�Ʒ�ࣨ��Ŀ��ID ����Ϊuint32_t
			$this->strItemTitle = $bs->popString(); // �����л���Ʒ���� ����Ϊstd::string
			$this->strItemAttrCode = $bs->popString(); // �����л���Ʒ�������Ա��� ����Ϊstd::string
			$this->strItemAttr = $bs->popString(); // �����л���Ʒ������������ ����Ϊstd::string
			$this->strItemId = $bs->popString(); // �����л���ƷID����ҵ���� ����Ϊstd::string
			$this->ddwItemSkuId = $bs->popUint64_t(); // �����л���ƷSKUID ����Ϊuint64_t
			$this->strItemLocalCode = $bs->popString(); // �����л���Ʒ�̼ұ��ر��� ����Ϊstd::string
			$this->strItemLocalStockCode = $bs->popString(); // �����л���Ʒ�̼ұ��ؿ����� ����Ϊstd::string
			$this->strItemBarCode = $bs->popString(); // �����л���Ʒ������ ����Ϊstd::string
			$this->ddwItemSpuId = $bs->popUint64_t(); // �����л���ƷSPUID ����Ϊuint64_t
			$this->ddwItemStockId = $bs->popUint64_t(); // �����л���Ʒ���ID ����Ϊuint64_t
			$this->dwItemStoreHouseId = $bs->popUint32_t(); // �����л���Ʒ�ֿ�ID ����Ϊuint32_t
			$this->strItemPhyisicalStorage = $bs->popString(); // �����л���Ʒ��������� ����Ϊstd::string
			$this->strItemLogo = $bs->popString(); // �����л���ƷͼƬLogo ����Ϊstd::string
			$this->dwItemSnapVersion = $bs->popUint32_t(); // �����л���Ʒ���հ汾�� ����Ϊuint32_t
			$this->dwItemResetTime = $bs->popUint32_t(); // �����л���Ʒ����ʱ��� ����Ϊuint32_t
			$this->dwItemWeight = $bs->popUint32_t(); // �����л���Ʒ���� ����Ϊuint32_t
			$this->dwItemVolume = $bs->popUint32_t(); // �����л���Ʒ��� ����Ϊuint32_t
			$this->ddwMainItemId = $bs->popUint64_t(); // �����л���Ʒ�ײ�����ƷID ����Ϊuint64_t
			$this->strItemAccessoryDesc = $bs->popString(); // �����л���Ʒ����˵�� ����Ϊstd::string
			$this->dwItemCostPrice = $bs->popUint32_t(); // �����л���Ʒ�ɱ��� ����Ϊuint32_t
			$this->dwItemOriginPrice = $bs->popUint32_t(); // �����л���Ʒ�г��� ����Ϊuint32_t
			$this->dwItemSoldPrice = $bs->popUint32_t(); // �����л���Ʒ���۵��� ����Ϊuint32_t
			$this->strItemB2CMarket = $bs->popString(); // �����л���ӪB2C�г� ����Ϊstd::string
			$this->strItemB2CPM = $bs->popString(); // �����л���ӪB2CPM ����Ϊstd::string
			$this->cItemUseVirtualStock = $bs->popUint8_t(); // �����л���ӪB2C�Ƿ�ռ����� ����Ϊuint8_t
			$this->dwBuyPrice = $bs->popUint32_t(); // �����л���Ʒ�ɽ��� ����Ϊuint32_t
			$this->dwBuyNum = $bs->popUint32_t(); // �����л���Ʒ�ɽ����� ����Ϊuint32_t
			$this->dwTradeTotalFee = $bs->popUint32_t(); // �����л���Ʒ���ܽ��,�µ���� ����Ϊuint32_t
			$this->nTradeAdjustFee = $bs->popInt32_t(); // �����л���Ʒ�����۽�� ����Ϊint
			$this->dwTradePayment = $bs->popUint32_t(); // �����л�ʵ���ܽ�� ����Ϊuint32_t
			$this->nTradeDiscountTotal = $bs->popInt32_t(); // �����л��Ż��ܽ�� ����Ϊint
			$this->dwTradePaipaiHongbaoUsed = $bs->popUint32_t(); // �����л�Paipai���ʹ�ý�� ����Ϊuint32_t
			$this->dwPayScore = $bs->popUint32_t(); // �����л�����֧��ֵ ����Ϊuint32_t
			$this->dwTradeGenTime = $bs->popUint32_t(); // �����л���Ʒ������ʱ�� ����Ϊuint32_t
			$this->wTradeOpSerialNo = $bs->popUint16_t(); // �����л���Ʒ�����������к� ����Ϊuint16_t
			$this->dwObtainScore = $bs->popUint32_t(); // �����л���û���ֵ ����Ϊuint32_t
			$this->dwTradeState = $bs->popUint32_t(); // �����л���Ʒ��״̬ ����Ϊuint32_t
			$this->dwTradeProperty = $bs->popUint32_t(); // �����л���Ʒ������ֵ ����Ϊuint32_t
			$this->dwTradeProperty1 = $bs->popUint32_t(); // �����л���Ʒ������ֵ1 ����Ϊuint32_t
			$this->dwTradeProperty2 = $bs->popUint32_t(); // �����л���Ʒ������ֵ2 ����Ϊuint32_t
			$this->dwTradeProperty3 = $bs->popUint32_t(); // �����л���Ʒ������ֵ3 ����Ϊuint32_t
			$this->dwTradeProperty4 = $bs->popUint32_t(); // �����л���Ʒ������ֵ4 ����Ϊuint32_t
			$this->dwItemTimeoutFlag = $bs->popUint32_t(); // �����л���Ʒ��ʱ��ʶ ����Ϊuint32_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // �����л�������ʱ�� ����Ϊuint32_t
			$this->oActiveInfoList = $bs->popObject('TradeActivePoList'); // �����л���Ʒ��б� ����Ϊecc::deal::po::CTradeActivePoList
			$this->mmapDealExtInfoMap = $bs->popObject('stl_multimap<uint32_t,stl_string>'); // �����л�������չ��Ϣ  ����Ϊstd::multimap<uint32_t,std::string> 
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId64_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBdealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerNickName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerTitle_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBusinessId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeSource_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradePayType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cShippingfeeTemplateId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cShippingfeeDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemShippingfee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemClassId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemTitle_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemAttrCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemAttr_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemSkuId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemLocalCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemLocalStockCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemBarCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemSpuId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemStockId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemStoreHouseId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemPhyisicalStorage_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemLogo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemSnapVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemResetTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemWeight_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemVolume_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cMainItemId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemAccessoryDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemCostPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemOriginPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemSoldPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemB2CMarket_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemB2CPM_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemUseVirtualStock_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeTotalFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeAdjustFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradePayment_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeDiscountTotal_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradePaipaiHongbaoUsed_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayScore_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeGenTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeOpSerialNo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cObtainScore_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeProperty_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeProperty1_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeProperty2_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeProperty3_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeProperty4_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemTimeoutFlag_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cActiveInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealExtInfoMap_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			if(  $this->wVersion >= 1 ){
				$this->strWarranty = $bs->popString(); // �����л��������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->ddwProductId = $bs->popUint64_t(); // �����л���Ʒid ����Ϊuint64_t
			}
			if(  $this->wVersion >= 1 ){
				$this->strProductCode = $bs->popString(); // �����л���Ʒid���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonEdmCode = $bs->popString(); // �����л���Ѹedm���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonOTag = $bs->popString(); // �����л���ѸOTag ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonTradeShopGuideCost = $bs->popString(); // �����л���Ѹ���̵������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneType = $bs->popString(); // �����л���Ѹ���ƻ����� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneOperator = $bs->popString(); // �����л���Ѹ���ƻ���Ӫ�� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneNumber = $bs->popString(); // �����л���Ѹ���ƻ����� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneArea = $bs->popString(); // �����л���Ѹ���ƻ������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhonePackageId = $bs->popString(); // �����л���Ѹ���ƻ��ײ�id ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneUserName = $bs->popString(); // �����л���Ѹ���ƻ��û����� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneUserAddr = $bs->popString(); // �����л���Ѹ���ƻ��û���ַ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneUserMobile = $bs->popString(); // �����л���Ѹ���ƻ��û���ϵ�ֻ� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneUserTel = $bs->popString(); // �����л���Ѹ���ƻ��û���ϵ�绰 ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneIdCardNo = $bs->popString(); // �����л���Ѹ���ƻ����֤���� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneIdCardAddr = $bs->popString(); // �����л���Ѹ���ƻ����֤��ַ ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneIdCardDate = $bs->popString(); // �����л���Ѹ���ƻ����֤��Ч�� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneZipCode = $bs->popString(); // �����л���Ѹ���ƻ��������� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhoneCardPrice = $bs->popString(); // �����л���Ѹ���ƻ����۸� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonCSPhonePackagePrice = $bs->popString(); // �����л���Ѹ���ƻ��ײͼ۸� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonTradeFlag = $bs->popString(); // �����л���Ѹ��Ʒ�ӵ�flag ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonPointType = $bs->popString(); // �����л���Ѹ���ֶһ����� ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->strIcsonPackageIds = $bs->popString(); // �����л���Ѹ��Ʒ�ӵ��ײ�id ����Ϊstd::string
			}
			if(  $this->wVersion >= 1 ){
				$this->cWarranty_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cProductId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cProductCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonEdmCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonOTag_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonTradeShopGuideCost_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneOperator_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneNumber_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneArea_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhonePackageId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneUserName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneUserAddr_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneUserMobile_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneUserTel_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneIdCardNo_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneIdCardAddr_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneIdCardDate_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneZipCode_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhoneCardPrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonCSPhonePackagePrice_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonTradeFlag_u = $bs->popUint8_t(); // �����л���Ѹ��Ʒ�ӵ�flag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonPointType_u = $bs->popUint8_t(); // �����л���Ѹ���ֶһ����� ����Ϊuint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cIcsonPackageIds_u = $bs->popUint8_t(); // �����л���Ѹ��Ʒ�ӵ��ײ�id ����Ϊuint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwIcsonTradeCashBack = $bs->popUint32_t(); // �����л��ӵ����ֽ�� ����Ϊuint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cIcsonTradeCashBack_u = $bs->popUint8_t(); // �����л��ӵ����ֽ��UFlag ����Ϊuint8_t
			}
			if(  $this->wVersion >= 3 ){
				$this->strIcsonUnitCostInvoice = $bs->popString(); // �����л�ȥ˰��ɱ� ����Ϊstd::string
			}
			if(  $this->wVersion >= 3 ){
				$this->cIcsonUnitCostInvoice_u = $bs->popUint8_t(); // �����л�ȥ˰��ɱ�UFlag ����Ϊuint8_t
			}

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


//source idl: com.ecc.deal.idl.OrderPo.java

if (!class_exists('OrderPayInfoPoList')) {
class OrderPayInfoPoList
{
		/**
		 * �汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ֧�����б�
		 *
		 * �汾 >= 0
		 */
		var $vecPayInfoList; //std::vector<ecc::deal::po::COrderPayInfoPo> 

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л��汾�� ����Ϊuint16_t
			$bs->pushObject($this->vecPayInfoList,'stl_vector'); // ���л�֧�����б� ����Ϊstd::vector<ecc::deal::po::COrderPayInfoPo> 
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayInfoList_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л��汾�� ����Ϊuint16_t
			$this->vecPayInfoList = $bs->popObject('stl_vector<OrderPayInfoPo>'); // �����л�֧�����б� ����Ϊstd::vector<ecc::deal::po::COrderPayInfoPo> 
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.ecc.deal.idl.OrderPayInfoPoList.java

if (!class_exists('OrderPayInfoPo')) {
class OrderPayInfoPo
{
		/**
		 * �汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ֧����ID�����Ķ���ͬ����ʹ�ã���Ϊ��
		 *
		 * �汾 >= 0
		 */
		var $ddwPayId; //uint64_t

		/**
		 * ������ţ���Ϊ��
		 *
		 * �汾 >= 0
		 */
		var $strDealId; //std::string

		/**
		 * �������ţ����Ķ���ͬ����ʹ�ã���Ϊ��
		 *
		 * �汾 >= 0
		 */
		var $ddwDealId64; //uint64_t

		/**
		 * ���׵��ţ���Ϊ��
		 *
		 * �汾 >= 0
		 */
		var $ddwBdealId; //uint64_t

		/**
		 * ���ID
		 *
		 * �汾 >= 0
		 */
		var $ddwBuyerId; //uint64_t

		/**
		 * ����ǳ�
		 *
		 * �汾 >= 0
		 */
		var $strBuyerNickName; //std::string

		/**
		 * �̼�ID
		 *
		 * �汾 >= 0
		 */
		var $ddwSellerId; //uint64_t

		/**
		 * �̼�����
		 *
		 * �汾 >= 0
		 */
		var $strSellerTitle; //std::string

		/**
		 * ��Ʒ�����б�
		 *
		 * �汾 >= 0
		 */
		var $strItemTitleList; //std::string

		/**
		 * ֧���ܽ��
		 *
		 * �汾 >= 0
		 */
		var $dwPayTotalFee; //uint32_t

		/**
		 * ����������������Ʒʵ�����+������
		 *
		 * �汾 >= 0
		 */
		var $dwPayDealTotalFee; //uint32_t

		/**
		 * �ʷѽ��
		 *
		 * �汾 >= 0
		 */
		var $dwPayShippingFee; //uint32_t

		/**
		 * ֧���ʺ�
		 *
		 * �汾 >= 0
		 */
		var $strPayAccount; //std::string

		/**
		 * ֧����״̬��1��δ֧����2��֧�����
		 *
		 * �汾 >= 0
		 */
		var $dwPayState; //uint32_t

		/**
		 * ֧�������
		 *
		 * �汾 >= 0
		 */
		var $dwPayProperty; //uint32_t

		/**
		 * ֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6���������
		 *
		 * �汾 >= 0
		 */
		var $cPayType; //uint8_t

		/**
		 * ֧������
		 *
		 * �汾 >= 0
		 */
		var $cPayChannel; //uint8_t

		/**
		 * ֧������ID
		 *
		 * �汾 >= 0
		 */
		var $strPayBank; //std::string

		/**
		 * ֧���������
		 *
		 * �汾 >= 0
		 */
		var $strPayDealId; //std::string

		/**
		 * ֧��������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwPayGenTime; //uint32_t

		/**
		 * ֧������Ч��ʼʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwPayEnableBeginTime; //uint32_t

		/**
		 * ֧������Ч����ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwPayEnableEndTime; //uint32_t

		/**
		 * ֧��������
		 *
		 * �汾 >= 0
		 */
		var $dwPayServiceFee; //uint32_t

		/**
		 * ˭�е�COD�����ѣ�1�����ҳе���2����ң�3��ƽ̨�е�
		 *
		 * �汾 >= 0
		 */
		var $dwWhoPayCodFee; //uint32_t

		/**
		 * COD�Ƹ�֧ͨ��������
		 *
		 * �汾 >= 0
		 */
		var $dwPayCodCftServiceFee; //uint32_t

		/**
		 * CODPaipai֧��������
		 *
		 * �汾 >= 0
		 */
		var $dwPayCodPaipaiServiceFee; //uint32_t

		/**
		 * COD�����ѵ��۽��
		 *
		 * �汾 >= 0
		 */
		var $nPayCodServiceAdjustFee; //int

		/**
		 * COD����֧��������
		 *
		 * �汾 >= 0
		 */
		var $dwPayCodWuliuServiceFee; //uint32_t

		/**
		 * ���ڸ�������
		 *
		 * �汾 >= 0
		 */
		var $strPayInstallmentBank; //std::string

		/**
		 * ���ڸ�������
		 *
		 * �汾 >= 0
		 */
		var $wPayInstallmentNum; //uint16_t

		/**
		 * ���ڸ���ÿ�ڽ��
		 *
		 * �汾 >= 0
		 */
		var $dwPayInstallmentPayment; //uint32_t

		/**
		 * ������ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cDealId64_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBdealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cBuyerNickName_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cSellerTitle_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cItemTitleList_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayTotalFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayDealTotalFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayShippingFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayAccount_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayState_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayProperty_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayChannel_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayBank_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayDealId_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayGenTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayEnableBeginTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayEnableEndTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayServiceFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cWhoPayCodFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayCodCftServiceFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayCodPaipaiServiceFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayCodServiceAdjustFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayCodWuliuServiceFee_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayInstallmentBank_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayInstallmentNum_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cPayInstallmentPayment_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л��汾�� ����Ϊuint16_t
			$bs->pushUint64_t($this->ddwPayId); // ���л�֧����ID�����Ķ���ͬ����ʹ�ã���Ϊ�� ����Ϊuint64_t
			$bs->pushString($this->strDealId); // ���л�������ţ���Ϊ�� ����Ϊstd::string
			$bs->pushUint64_t($this->ddwDealId64); // ���л��������ţ����Ķ���ͬ����ʹ�ã���Ϊ�� ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwBdealId); // ���л����׵��ţ���Ϊ�� ����Ϊuint64_t
			$bs->pushUint64_t($this->ddwBuyerId); // ���л����ID ����Ϊuint64_t
			$bs->pushString($this->strBuyerNickName); // ���л�����ǳ� ����Ϊstd::string
			$bs->pushUint64_t($this->ddwSellerId); // ���л��̼�ID ����Ϊuint64_t
			$bs->pushString($this->strSellerTitle); // ���л��̼����� ����Ϊstd::string
			$bs->pushString($this->strItemTitleList); // ���л���Ʒ�����б� ����Ϊstd::string
			$bs->pushUint32_t($this->dwPayTotalFee); // ���л�֧���ܽ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayDealTotalFee); // ���л�����������������Ʒʵ�����+������ ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayShippingFee); // ���л��ʷѽ�� ����Ϊuint32_t
			$bs->pushString($this->strPayAccount); // ���л�֧���ʺ� ����Ϊstd::string
			$bs->pushUint32_t($this->dwPayState); // ���л�֧����״̬��1��δ֧����2��֧����� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayProperty); // ���л�֧������� ����Ϊuint32_t
			$bs->pushUint8_t($this->cPayType); // ���л�֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6��������� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayChannel); // ���л�֧������ ����Ϊuint8_t
			$bs->pushString($this->strPayBank); // ���л�֧������ID ����Ϊstd::string
			$bs->pushString($this->strPayDealId); // ���л�֧��������� ����Ϊstd::string
			$bs->pushUint32_t($this->dwPayGenTime); // ���л�֧��������ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayEnableBeginTime); // ���л�֧������Ч��ʼʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayEnableEndTime); // ���л�֧������Ч����ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayServiceFee); // ���л�֧�������� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwWhoPayCodFee); // ���л�˭�е�COD�����ѣ�1�����ҳе���2����ң�3��ƽ̨�е� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayCodCftServiceFee); // ���л�COD�Ƹ�֧ͨ�������� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwPayCodPaipaiServiceFee); // ���л�CODPaipai֧�������� ����Ϊuint32_t
			$bs->pushInt32_t($this->nPayCodServiceAdjustFee); // ���л�COD�����ѵ��۽�� ����Ϊint
			$bs->pushUint32_t($this->dwPayCodWuliuServiceFee); // ���л�COD����֧�������� ����Ϊuint32_t
			$bs->pushString($this->strPayInstallmentBank); // ���л����ڸ������� ����Ϊstd::string
			$bs->pushUint16_t($this->wPayInstallmentNum); // ���л����ڸ������� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwPayInstallmentPayment); // ���л����ڸ���ÿ�ڽ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // ���л�������ʱ�� ����Ϊuint32_t
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cDealId64_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBdealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cBuyerNickName_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cSellerTitle_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cItemTitleList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayTotalFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayDealTotalFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayShippingFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayAccount_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayState_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayProperty_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayChannel_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayBank_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayDealId_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayGenTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayEnableBeginTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayEnableEndTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayServiceFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cWhoPayCodFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayCodCftServiceFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayCodPaipaiServiceFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayCodServiceAdjustFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayCodWuliuServiceFee_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayInstallmentBank_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayInstallmentNum_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cPayInstallmentPayment_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л��汾�� ����Ϊuint16_t
			$this->ddwPayId = $bs->popUint64_t(); // �����л�֧����ID�����Ķ���ͬ����ʹ�ã���Ϊ�� ����Ϊuint64_t
			$this->strDealId = $bs->popString(); // �����л�������ţ���Ϊ�� ����Ϊstd::string
			$this->ddwDealId64 = $bs->popUint64_t(); // �����л��������ţ����Ķ���ͬ����ʹ�ã���Ϊ�� ����Ϊuint64_t
			$this->ddwBdealId = $bs->popUint64_t(); // �����л����׵��ţ���Ϊ�� ����Ϊuint64_t
			$this->ddwBuyerId = $bs->popUint64_t(); // �����л����ID ����Ϊuint64_t
			$this->strBuyerNickName = $bs->popString(); // �����л�����ǳ� ����Ϊstd::string
			$this->ddwSellerId = $bs->popUint64_t(); // �����л��̼�ID ����Ϊuint64_t
			$this->strSellerTitle = $bs->popString(); // �����л��̼����� ����Ϊstd::string
			$this->strItemTitleList = $bs->popString(); // �����л���Ʒ�����б� ����Ϊstd::string
			$this->dwPayTotalFee = $bs->popUint32_t(); // �����л�֧���ܽ�� ����Ϊuint32_t
			$this->dwPayDealTotalFee = $bs->popUint32_t(); // �����л�����������������Ʒʵ�����+������ ����Ϊuint32_t
			$this->dwPayShippingFee = $bs->popUint32_t(); // �����л��ʷѽ�� ����Ϊuint32_t
			$this->strPayAccount = $bs->popString(); // �����л�֧���ʺ� ����Ϊstd::string
			$this->dwPayState = $bs->popUint32_t(); // �����л�֧����״̬��1��δ֧����2��֧����� ����Ϊuint32_t
			$this->dwPayProperty = $bs->popUint32_t(); // �����л�֧������� ����Ϊuint32_t
			$this->cPayType = $bs->popUint8_t(); // �����л�֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6��������� ����Ϊuint8_t
			$this->cPayChannel = $bs->popUint8_t(); // �����л�֧������ ����Ϊuint8_t
			$this->strPayBank = $bs->popString(); // �����л�֧������ID ����Ϊstd::string
			$this->strPayDealId = $bs->popString(); // �����л�֧��������� ����Ϊstd::string
			$this->dwPayGenTime = $bs->popUint32_t(); // �����л�֧��������ʱ�� ����Ϊuint32_t
			$this->dwPayEnableBeginTime = $bs->popUint32_t(); // �����л�֧������Ч��ʼʱ�� ����Ϊuint32_t
			$this->dwPayEnableEndTime = $bs->popUint32_t(); // �����л�֧������Ч����ʱ�� ����Ϊuint32_t
			$this->dwPayServiceFee = $bs->popUint32_t(); // �����л�֧�������� ����Ϊuint32_t
			$this->dwWhoPayCodFee = $bs->popUint32_t(); // �����л�˭�е�COD�����ѣ�1�����ҳе���2����ң�3��ƽ̨�е� ����Ϊuint32_t
			$this->dwPayCodCftServiceFee = $bs->popUint32_t(); // �����л�COD�Ƹ�֧ͨ�������� ����Ϊuint32_t
			$this->dwPayCodPaipaiServiceFee = $bs->popUint32_t(); // �����л�CODPaipai֧�������� ����Ϊuint32_t
			$this->nPayCodServiceAdjustFee = $bs->popInt32_t(); // �����л�COD�����ѵ��۽�� ����Ϊint
			$this->dwPayCodWuliuServiceFee = $bs->popUint32_t(); // �����л�COD����֧�������� ����Ϊuint32_t
			$this->strPayInstallmentBank = $bs->popString(); // �����л����ڸ������� ����Ϊstd::string
			$this->wPayInstallmentNum = $bs->popUint16_t(); // �����л����ڸ������� ����Ϊuint16_t
			$this->dwPayInstallmentPayment = $bs->popUint32_t(); // �����л����ڸ���ÿ�ڽ�� ����Ϊuint32_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // �����л�������ʱ�� ����Ϊuint32_t
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cDealId64_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBdealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cBuyerNickName_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cSellerTitle_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cItemTitleList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayTotalFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayDealTotalFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayShippingFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayAccount_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayState_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayProperty_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayChannel_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayBank_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayDealId_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayGenTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayEnableBeginTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayEnableEndTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayServiceFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cWhoPayCodFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayCodCftServiceFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayCodPaipaiServiceFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayCodServiceAdjustFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayCodWuliuServiceFee_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayInstallmentBank_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayInstallmentNum_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cPayInstallmentPayment_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.ecc.deal.idl.CreateBuyDealReq.java

if (!class_exists('OrderPoList')) {
class OrderPoList
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * �����б�
		 *
		 * �汾 >= 0
		 */
		var $vecOrderInfoList; //std::vector<ecc::deal::po::COrderPo> 

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushObject($this->vecOrderInfoList,'stl_vector'); // ���л������б� ����Ϊstd::vector<ecc::deal::po::COrderPo> 
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOrderInfoList_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->vecOrderInfoList = $bs->popObject('stl_vector<OrderPo>'); // �����л������б� ����Ϊstd::vector<ecc::deal::po::COrderPo> 
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOrderInfoList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.ecc.deal.idl.CloseDealReq.java

if (!class_exists('EventParamsCloseDealBo')) {
class EventParamsCloseDealBo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * �رն�������: 1-�ͷ��ر�;2-ϵͳ�ر�;3-�ͷ����û��ر�;4-����(����)�ر�
		 *
		 * �汾 >= 0
		 */
		var $dwOperateScene; //uint32_t

		/**
		 * �ر�ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwCloseTime; //uint32_t

		/**
		 * �ر�ԭ��
		 *
		 * �汾 >= 0
		 */
		var $dwCloseReasonType; //uint32_t

		/**
		 * ������Ϣ
		 *
		 * �汾 >= 0
		 */
		var $strCloseReasonDesc; //std::string

		/**
		 * �ӵ��б������ӵ��ر�ʱ��д�������������ر�
		 *
		 * �汾 >= 0
		 */
		var $vecTradeList; //std::vector<uint64_t> 

		/**
		 * �����ֶ�
		 *
		 * �汾 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cOperateScene_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cCloseTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cCloseReasonType_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cCloseReasonDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cTradeList_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwOperateScene); // ���л��رն�������: 1-�ͷ��ر�;2-ϵͳ�ر�;3-�ͷ����û��ر�;4-����(����)�ر� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwCloseTime); // ���л��ر�ʱ�� ����Ϊuint32_t
			$bs->pushUint32_t($this->dwCloseReasonType); // ���л��ر�ԭ�� ����Ϊuint32_t
			$bs->pushString($this->strCloseReasonDesc); // ���л�������Ϣ ����Ϊstd::string
			$bs->pushObject($this->vecTradeList,'stl_vector'); // ���л��ӵ��б������ӵ��ر�ʱ��д�������������ر� ����Ϊstd::vector<uint64_t> 
			$bs->pushString($this->strReserve); // ���л������ֶ� ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cOperateScene_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cCloseTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cCloseReasonType_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cCloseReasonDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cTradeList_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cReserve_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->dwOperateScene = $bs->popUint32_t(); // �����л��رն�������: 1-�ͷ��ر�;2-ϵͳ�ر�;3-�ͷ����û��ر�;4-����(����)�ر� ����Ϊuint32_t
			$this->dwCloseTime = $bs->popUint32_t(); // �����л��ر�ʱ�� ����Ϊuint32_t
			$this->dwCloseReasonType = $bs->popUint32_t(); // �����л��ر�ԭ�� ����Ϊuint32_t
			$this->strCloseReasonDesc = $bs->popString(); // �����л�������Ϣ ����Ϊstd::string
			$this->vecTradeList = $bs->popObject('stl_vector<uint64_t>'); // �����л��ӵ��б������ӵ��ر�ʱ��д�������������ر� ����Ϊstd::vector<uint64_t> 
			$this->strReserve = $bs->popString(); // �����л������ֶ� ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cOperateScene_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cCloseTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cCloseReasonType_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cCloseReasonDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cTradeList_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cReserve_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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


//source idl: com.ecc.deal.idl.AuditDealReq.java

if (!class_exists('EventParamsAuditDealBo')) {
class EventParamsAuditDealBo
{
		/**
		 * Э��汾��
		 *
		 * �汾 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * ���ʱ��
		 *
		 * �汾 >= 0
		 */
		var $dwAuditTime; //uint32_t

		/**
		 * �������,������128����
		 *
		 * �汾 >= 0
		 */
		var $strAuditDesc; //std::string

		/**
		 * ��˽��: 1-���ͨ��;2-ȡ�����;
		 *
		 * �汾 >= 0
		 */
		var $dwAuditResult; //uint32_t

		/**
		 * �����ֶ�
		 *
		 * �汾 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * �汾 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cAuditTime_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cAuditDesc_u; //uint8_t

		/**
		 * �汾 >= 0
		 */
		var $cAuditResult_u; //uint8_t

		/**
		 * �汾 >= 0
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
			$bs->pushUint16_t($this->wVersion); // ���л�Э��汾�� ����Ϊuint16_t
			$bs->pushUint32_t($this->dwAuditTime); // ���л����ʱ�� ����Ϊuint32_t
			$bs->pushString($this->strAuditDesc); // ���л��������,������128���� ����Ϊstd::string
			$bs->pushUint32_t($this->dwAuditResult); // ���л���˽��: 1-���ͨ��;2-ȡ�����; ����Ϊuint32_t
			$bs->pushString($this->strReserve); // ���л������ֶ� ����Ϊstd::string
			$bs->pushUint8_t($this->cVersion_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cAuditTime_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cAuditDesc_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cAuditResult_u); // ���л� ����Ϊuint8_t
			$bs->pushUint8_t($this->cReserve_u); // ���л� ����Ϊuint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // �����л�Э��汾�� ����Ϊuint16_t
			$this->dwAuditTime = $bs->popUint32_t(); // �����л����ʱ�� ����Ϊuint32_t
			$this->strAuditDesc = $bs->popString(); // �����л��������,������128���� ����Ϊstd::string
			$this->dwAuditResult = $bs->popUint32_t(); // �����л���˽��: 1-���ͨ��;2-ȡ�����; ����Ϊuint32_t
			$this->strReserve = $bs->popString(); // �����л������ֶ� ����Ϊstd::string
			$this->cVersion_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cAuditTime_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cAuditDesc_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cAuditResult_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t
			$this->cReserve_u = $bs->popUint8_t(); // �����л� ����Ϊuint8_t

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