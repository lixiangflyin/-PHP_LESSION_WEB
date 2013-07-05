<?php

class ShipConst {

  

static $_LGT_MODE = array (
  63 => 
  array (
    'SysNo' => 63,
    'ShipTypeID' => '056',
    'ShipTypeName' => '联邦快递',
    'ShipTypeDesc' => '联邦快递',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 0,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 0,
  ),
  43 => 
  array (
    'SysNo' => 43,
    'ShipTypeID' => '022',
    'ShipTypeName' => '易迅第三方快递',
    'ShipTypeDesc' => '支持<font class=strong>现金货到付款</font>（暂不支持POS机刷卡）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 0,
    'StatusQueryType' => 3,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 0,
  ),
  55 => 
  array (
    'SysNo' => 55,
    'ShipTypeID' => '50',
    'ShipTypeName' => '自行送修',
    'ShipTypeDesc' => '奉贤送修,RMA部门送修使用',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 0,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 0,
  ),
  46 => 
  array (
    'SysNo' => 46,
    'ShipTypeID' => '023',
    'ShipTypeName' => '张家港自提',
    'ShipTypeDesc' => '客户上门自提，当面付款后验货，支持现金、POS机刷卡（<a href="http://st.51buy.com/help/3-4-userpick.htm" target=_blank>查看详细说明</a>）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 0,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 0,
  ),
  47 => 
  array (
    'SysNo' => 47,
    'ShipTypeID' => '024',
    'ShipTypeName' => '邮政文件',
    'ShipTypeDesc' => '邮政文件,给财务寄发票用',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 0,
  ),
  92 => 
  array (
    'SysNo' => 92,
    'ShipTypeID' => '025',
    'ShipTypeName' => '全峰快递',
    'ShipTypeDesc' => '支持<font class=strong>货到付款及POS机刷卡</font>（刷卡用户请在订单备注中注明；<font class=strong>货到付款请认准全峰快递，付款前请先打开易迅包装检验</font> ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 1,
  ),
  112 => 
  array (
    'SysNo' => 112,
    'ShipTypeID' => '057',
    'ShipTypeName' => '恒路物流',
    'ShipTypeDesc' => '干线物流承包商',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 0,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 0,
  ),
  1 => 
  array (
    'SysNo' => 1,
    'ShipTypeID' => '001',
    'ShipTypeName' => '易迅快递',
    'ShipTypeDesc' => '支持<font class=strong>货到付款及POS机刷卡</font>（<a href="http://st.icson.com/help/3-1-icson_delivery.htm" target="_blank">查看配送区域及说明</a>）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 0,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 1,
  ),
  2 => 
  array (
    'SysNo' => 2,
    'ShipTypeID' => '002',
    'ShipTypeName' => '邮政EMS',
    'ShipTypeDesc' => '覆盖地区广',
    'PremiumRate' => '0.010000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 2,
    'StatusQueryUrl' => 'http://www.ems.com.cn/qcgzOutQueryAction.do?reqCode=gotoSearch',
    'IsOnlineShow' => 1,
  ),
  3 => 
  array (
    'SysNo' => 3,
    'ShipTypeID' => '003',
    'ShipTypeName' => '邮局普通包裹',
    'ShipTypeDesc' => '含3元注册费,2元包装费(此配送方式时间比较长,建议尽量使用快递)',
    'PremiumRate' => '0.010000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 4,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 0,
  ),
  4 => 
  array (
    'SysNo' => 4,
    'ShipTypeID' => '004',
    'ShipTypeName' => '韵达快递',
    'ShipTypeDesc' => '2-5天内送达，价格便宜服务质量一般',
    'PremiumRate' => '0.010000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => ' ',
    'IsOnlineShow' => 0,
  ),
  5 => 
  array (
    'SysNo' => 5,
    'ShipTypeID' => '005',
    'ShipTypeName' => '申通快递',
    'ShipTypeDesc' => '申通快递配送效率高，可以在线查询配送状态，全面支持支付宝付款!',
    'PremiumRate' => '0.030000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 3,
    'StatusQueryUrl' => 'http://www.sto.cn?',
    'IsOnlineShow' => 0,
  ),
  6 => 
  array (
    'SysNo' => 6,
    'ShipTypeID' => '006',
    'ShipTypeName' => '厂商直送',
    'ShipTypeDesc' => '供应商送货',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => ' ',
    'IsOnlineShow' => 0,
  ),
  7 => 
  array (
    'SysNo' => 7,
    'ShipTypeID' => '7',
    'ShipTypeName' => '普通快递',
    'ShipTypeDesc' => '圆通快递，江浙沪地区效率高、质量好、费用低',
    'PremiumRate' => '0.050000',
    'PremiumBase' => 1500,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 3,
    'StatusQueryUrl' => 'http://www.yto.net.cn?',
    'IsOnlineShow' => 1,
  ),
  8 => 
  array (
    'SysNo' => 8,
    'ShipTypeID' => '008',
    'ShipTypeName' => '客户上门提货(上海)',
    'ShipTypeDesc' => '客户上门自提，当面付款后验货，支持现金、POS机刷卡',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 1,
  ),
  9 => 
  array (
    'SysNo' => 9,
    'ShipTypeID' => '009',
    'ShipTypeName' => '客户上门提货(杭州)',
    'ShipTypeDesc' => '客户在当天下午6点之前的订单显示已出库状态，将于第二个工作日下午由工作人员电话通知，前去指定地点提货；客户在当天下午6点之前的订单显示待出库状态，即您订单中某件产品目前暂缺货，将于第三个工作下午由我们工作人员电话通知，前去指定地点提货；以上订单均是指已通过易迅网审核的有效订单，如果顾客没有在易迅网下单，而直接上门自提的客户将无法拿到货品；客户接到工作人员提货电话通知后，请在3个工作日内提货地点提货，否则我们将作废您的订单，谢谢配合；提货地址为：杭州市西湖区黄姑山路23号西溪软件园4号楼108室，提货电话：0571-56891610，<font color=red>可刷卡</font>。<a href="http://www.icson.com/Service/delivery.aspx#sp_hz" target=_blank>查看详细说明</a>',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 4,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 0,
  ),
  10 => 
  array (
    'SysNo' => 10,
    'ShipTypeID' => '010',
    'ShipTypeName' => '客户上门提货(扬州)',
    'ShipTypeDesc' => '客户在当天下午6点之前的订单显示已出库状态，将于第二个工作日下午由工作人员电话通知，前去指定地点提货；客户在当天下午6点之前的订单显示待出库状态，即您订单中某件产品目前暂缺货，将于第三个工作下午由我们工作人员电话通知，前去指定地点提货；以上订单均是指已通过易迅网审核的有效订单，如果顾客没有在易迅网下单，而直接上门自提的客户将无法拿到货品；客户接到工作人员提货电话通知后，请在3个工作日内提货地点提货，否则我们将作废您的订单，谢谢配合；提货地址为：扬州市文昌西路公元国际大厦10A07室，提货电话：0514-87957129，<font color=red>可刷卡</font>。<a href="http://www.icson.com/Service/delivery.aspx#sp_yz" target=_blank>查看详细说明</a>',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 0,
  ),
  11 => 
  array (
    'SysNo' => 11,
    'ShipTypeID' => '011',
    'ShipTypeName' => '客户上门提货(苏州)',
    'ShipTypeDesc' => '客户在当天下午6点之前的订单显示已出库状态，将于第二个工作日下午由工作人员电话通知，前去指定地点提货；客户在当天下午6点之前的订单显示待出库状态，即您订单中某件产品目前暂缺货，将于第三个工作下午由我们工作人员电话通知，前去指定地点提货；以上订单均是指已通过易迅网审核的有效订单，如果顾客没有在易迅网下单，而直接上门自提的客户将无法拿到货品；客户接到工作人员提货电话通知后，请在3个工作日内提货地点提货，否则我们将作废您的订单，谢谢配合；提货地址为：苏州市金阊区阊胥路483号创元科技创业园（又名金阊软件园，石路友通数码港向北50米）7102室，提货电话：0512-65564586，0512-65564587，<font color=red>可刷卡</font>
。<a href="http://www.icson.com/Service/delivery.aspx#sp_sz" target=_blank>查看详细说明</a>',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 0,
  ),
  12 => 
  array (
    'SysNo' => 12,
    'ShipTypeID' => '012',
    'ShipTypeName' => '顺丰快递',
    'ShipTypeDesc' => '顺丰快递配送效率高,可以在线查询配送状态!
<font color="red">顺丰快递不参加任何免运费活动！</font><a href="http://www.icson.com/Service/Delivery.aspx#sf" target="_blank">查看详细说明</a>',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 2,
    'StatusQueryUrl' => 'http://www.sf-express.com/',
    'IsOnlineShow' => 0,
  ),
  13 => 
  array (
    'SysNo' => 13,
    'ShipTypeID' => '013',
    'ShipTypeName' => '客户上门提货(南京)',
    'ShipTypeDesc' => '客户在当天下午6点之前的订单显示已出库状态，将于第二个工作日下午由工作人员电话通知，前去指定地点提货；客户在当天下午6点之前的订单显示待出库状态，即您订单中某件产品目前暂缺货，将于第三个工作下午由我们工作人员电话通知，前去指定地点提货；以上订单均是指已通过易迅网审核的有效订单，如果顾客没有在易迅网下单，而直接上门自提的客户将无法拿到货品；上门自提的客户暂不提供刷卡服务；客户接到工作人员提货电话通知后，请在3个工作日内提货地点提货，否则我们将作废您的订单，谢谢配合；提货地址为：南京市珠江路350号银鸿商务大厦A座905室，提货电话：025-86982541 025-86982542
。<a href="http://www.icson.com/Service/delivery.aspx#sp_nj" target=_blank>查看详细说明</a>',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 0,
  ),
  14 => 
  array (
    'SysNo' => 14,
    'ShipTypeID' => '014',
    'ShipTypeName' => '申通结算',
    'ShipTypeDesc' => '申通结算',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 0,
  ),
  15 => 
  array (
    'SysNo' => 15,
    'ShipTypeID' => '015',
    'ShipTypeName' => '圆通物品结算',
    'ShipTypeDesc' => '圆通物品结算',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 0,
  ),
  16 => 
  array (
    'SysNo' => 16,
    'ShipTypeID' => '016',
    'ShipTypeName' => '圆通资料结算',
    'ShipTypeDesc' => '圆通资料结算',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 0,
  ),
  17 => 
  array (
    'SysNo' => 17,
    'ShipTypeID' => '017',
    'ShipTypeName' => '高校代理配送',
    'ShipTypeDesc' => '浙江大学校区的高校代理配送',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 0,
  ),
  19 => 
  array (
    'SysNo' => 19,
    'ShipTypeID' => '019',
    'ShipTypeName' => 'EMS上海结算',
    'ShipTypeDesc' => 'EMS结算',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 0,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 0,
  ),
  20 => 
  array (
    'SysNo' => 20,
    'ShipTypeID' => '020',
    'ShipTypeName' => '永升送修',
    'ShipTypeDesc' => '永升大厦送修,RMA部门送修使用',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 0,
  ),
  21 => 
  array (
    'SysNo' => 21,
    'ShipTypeID' => '021',
    'ShipTypeName' => '供应商上门',
    'ShipTypeDesc' => '供应商上门，售后返修件需要',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 0,
  ),
  42 => 
  array (
    'SysNo' => 42,
    'ShipTypeID' => '1005',
    'ShipTypeName' => '圆通资料结算',
    'ShipTypeDesc' => '圆通资料结算',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 0,
  ),
  52 => 
  array (
    'SysNo' => 52,
    'ShipTypeID' => '1006',
    'ShipTypeName' => '深圳圆通物品结算',
    'ShipTypeDesc' => '深圳圆通物品结算',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 0,
  ),
  45 => 
  array (
    'SysNo' => 45,
    'ShipTypeID' => '1007',
    'ShipTypeName' => '全峰快递',
    'ShipTypeDesc' => '支持<font class=strong>货到付款及POS机刷卡</font>（刷卡用户请在订单备注中注明；<font class=strong>货到付款请认准全峰快递，付款前请先打开易迅包装检验</font> ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 1,
  ),
  72 => 
  array (
    'SysNo' => 72,
    'ShipTypeID' => '1008',
    'ShipTypeName' => '申通快递',
    'ShipTypeDesc' => '申通快递',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 0,
  ),
  82 => 
  array (
    'SysNo' => 82,
    'ShipTypeID' => '1009',
    'ShipTypeName' => '申通资料结算',
    'ShipTypeDesc' => '申通资料结算',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 0,
  ),
  22 => 
  array (
    'SysNo' => 22,
    'ShipTypeID' => '1001',
    'ShipTypeName' => '华南易迅快递',
    'ShipTypeDesc' => '支持<font class=strong>货到付款及POS机刷卡，深圳市部分地区一日三送</font> <a href="http://st.icson.com/help/3-1-icson_delivery.htm#sz" target="_blank">查看配送区域及说明</a>',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => -1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 1,
  ),
  23 => 
  array (
    'SysNo' => 23,
    'ShipTypeID' => '1002',
    'ShipTypeName' => '圆通快递',
    'ShipTypeDesc' => '圆通快递，效率高、质量好、费用低。<font class=strong>广东省内1-2日送达，广东省外3-4日送达</font> <a href="http://st.icson.com/help/3-2-normal_delivery.htm" target="_blank">查看配送区域及说明</a>',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 1,
  ),
  32 => 
  array (
    'SysNo' => 32,
    'ShipTypeID' => '1003',
    'ShipTypeName' => '邮政EMS',
    'ShipTypeDesc' => '覆盖地区广 <a href="http://st.icson.com/help/3-3-EMS.htm" target="_blank">查看配送区域及说明</a>',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 0,
  ),
  33 => 
  array (
    'SysNo' => 33,
    'ShipTypeID' => '1004',
    'ShipTypeName' => '厂商直送',
    'ShipTypeDesc' => '厂商直送',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 0,
  ),
  83 => 
  array (
    'SysNo' => 83,
    'ShipTypeID' => '1010',
    'ShipTypeName' => '申通物品结算',
    'ShipTypeDesc' => '申通物品结算',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 0,
  ),
  56 => 
  array (
    'SysNo' => 56,
    'ShipTypeID' => '2003',
    'ShipTypeName' => '圆通资料结算',
    'ShipTypeDesc' => '圆通资料结算',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 0,
  ),
  57 => 
  array (
    'SysNo' => 57,
    'ShipTypeID' => '2005',
    'ShipTypeName' => '圆通物品结算',
    'ShipTypeDesc' => '圆通物品结算',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 0,
  ),
  44 => 
  array (
    'SysNo' => 44,
    'ShipTypeID' => '2001',
    'ShipTypeName' => '华北易迅快递',
    'ShipTypeDesc' => '支持货到付款及POS机刷卡，北京市区一日两送 查看配送区域及说明',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => -1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 1,
  ),
  53 => 
  array (
    'SysNo' => 53,
    'ShipTypeID' => '2004',
    'ShipTypeName' => '厂商直送',
    'ShipTypeDesc' => '厂商直送',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 0,
  ),
  54 => 
  array (
    'SysNo' => 54,
    'ShipTypeID' => '2002',
    'ShipTypeName' => '普通快递',
    'ShipTypeDesc' => '圆通快递，效率高、质量好、费用低。北京市内1-2日送达，北京市外2-4日送达 <a href="http://st.icson.com/help/3-2-normal_delivery.htm" target="_blank">查看配送区域及说明</a>',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 1,
  ),
  62 => 
  array (
    'SysNo' => 62,
    'ShipTypeID' => '2006',
    'ShipTypeName' => '邮政EMS',
    'ShipTypeDesc' => '邮政EMS',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 0,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 0,
  ),
  102 => 
  array (
    'SysNo' => 102,
    'ShipTypeID' => '2007',
    'ShipTypeName' => '全峰快递',
    'ShipTypeDesc' => '支持<font class=strong>货到付款及POS机刷卡</font>（刷卡用户请在订单备注中注明；<font class=strong>货到付款请认准全峰快递，付款前请先打开易迅包装检验</font> ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => '',
    'IsOnlineShow' => 1,
  ),
  122 => 
  array (
    'SysNo' => 122,
    'ShipTypeID' => '162',
    'ShipTypeName' => 'EMS北京结算',
    'ShipTypeDesc' => 'EMS结算',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => -1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 0,
  ),
  30612 => 
  array (
    'SysNo' => 30612,
    'ShipTypeID' => '2008',
    'ShipTypeName' => '易迅第三方-银捷快递',
    'ShipTypeDesc' => '支持<font class=strong>货到付款及POS机刷卡</font>（刷卡用户请在订单备注中注明；<font class=strong>货到付款请认准银捷快递，付款前请先打开易迅包装检验</font> ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 0,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 1,
  ),
  30761 => 
  array (
    'SysNo' => 30761,
    'ShipTypeID' => '2009',
    'ShipTypeName' => '易迅第三方_广州通路',
    'ShipTypeDesc' => '支持<font class=strong>货到付款及POS机刷卡</font>（刷卡用户请在订单备注中注明；<font class=strong>货到付款请认准广州通路，付款前请先打开易迅包装检验</font> ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 0,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 1,
  ),
  30762 => 
  array (
    'SysNo' => 30762,
    'ShipTypeID' => '2010',
    'ShipTypeName' => '易迅第三方_北京尚橙',
    'ShipTypeDesc' => '支持<font class=strong>货到付款及POS机刷卡</font>（刷卡用户请在订单备注中注明；<font class=strong>货到付款请认准北京尚橙，付款前请先打开易迅包装检验</font> ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 0,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 1,
  ),
  30752 => 
  array (
    'SysNo' => 30752,
    'ShipTypeID' => '2011',
    'ShipTypeName' => '易迅第三方_苏州门对门',
    'ShipTypeDesc' => '支持<font class=strong>货到付款及POS机刷卡</font>（刷卡用户请在订单备注中注明；<font class=strong>货到付款请认准苏州门对门，付款前请先打开易迅包装检验</font> ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 0,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 1,
  ),
  30753 => 
  array (
    'SysNo' => 30753,
    'ShipTypeID' => '2012',
    'ShipTypeName' => '易迅第三方_上海赛澳递',
    'ShipTypeDesc' => '支持<font class=strong>货到付款及POS机刷卡</font>（刷卡用户请在订单备注中注明；<font class=strong>货到付款请认准上海赛澳递，付款前请先打开易迅包装检验</font> ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 0,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 1,
  ),
  30790 => 
  array (
    'SysNo' => 30790,
    'ShipTypeID' => '2013',
    'ShipTypeName' => '易迅第三方_杭州爱彼西',
    'ShipTypeDesc' => '支持<font class=strong>货到付款及POS机刷卡</font>（刷卡用户请在订单备注中注明；<font class=strong>货到付款请认准杭州爱彼西，付款前请先打开易迅包装检验</font> ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 0,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 1,
  ),
  30804 => 
  array (
    'SysNo' => 30804,
    'ShipTypeID' => '2014',
    'ShipTypeName' => '易迅第三方_武汉飞远',
    'ShipTypeDesc' => '支持<font class=strong>货到付款及POS机刷卡</font>（刷卡用户请在订单备注中注明；<font class=strong>货到付款请认准武汉飞远，付款前请先打开易迅包装检验</font> ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 0,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 1,
  ),
  30812 => 
  array (
    'SysNo' => 30812,
    'ShipTypeID' => '2015',
    'ShipTypeName' => '易迅第三方_福建飞远',
    'ShipTypeDesc' => '支持<font class=strong>货到付款及POS机刷卡</font>（刷卡用户请在订单备注中注明；<font class=strong>货到付款请认准福建飞远，付款前请先打开易迅包装检验</font> ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 0,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 1,
  ),
  30821 => 
  array (
    'SysNo' => 30821,
    'ShipTypeID' => '2016',
    'ShipTypeName' => '易迅第三方_重庆华宇',
    'ShipTypeDesc' => '支持<font class=strong>货到付款及POS机刷卡</font>（刷卡用户请在订单备注中注明；<font class=strong>货到付款请认准重庆华宇，付款前请先打开易迅包装检验</font> ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 0,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 1,
  ),
  31478 => 
  array (
    'SysNo' => 31478,
    'ShipTypeID' => '2018',
    'ShipTypeName' => '易迅第三方_D',
    'ShipTypeDesc' => '支持<font class=strong>货到付款及POS机刷卡</font>（刷卡用户请在订单备注中注明；<font class=strong>货到付款请认准杭州爱彼西，付款前请先打开易迅包装检验</font> ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => -1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 0,
  ),
  31485 => 
  array (
    'SysNo' => 31485,
    'ShipTypeID' => '2019',
    'ShipTypeName' => '易迅第三方_E',
    'ShipTypeDesc' => '支持货到付款及POS机刷卡（刷卡用户请在订单备注中注明；货到付款请认准杭州爱彼西，付款前请先打开易迅包装检验 ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => -1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 0,
  ),
  50077 => 
  array (
    'SysNo' => 50077,
    'ShipTypeID' => '2020',
    'ShipTypeName' => '易迅第三方_F',
    'ShipTypeDesc' => '支持货到付款及POS机刷卡（刷卡用户请在订单备注中注明；货到付款请认准杭州爱彼西，付款前请先打开易迅包装检验 ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => -1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 0,
  ),
  50083 => 
  array (
    'SysNo' => 50083,
    'ShipTypeID' => '2026',
    'ShipTypeName' => '易迅第三方_L',
    'ShipTypeDesc' => '支持货到付款及POS机刷卡（刷卡用户请在订单备注中注明；货到付款请认准杭州爱彼西，付款前请先打开易迅包装检验 ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => -1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 0,
  ),
  30800 => 
  array (
    'SysNo' => 30800,
    'ShipTypeID' => '163',
    'ShipTypeName' => 'E邮宝',
    'ShipTypeDesc' => 'E邮宝',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 0,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 1,
  ),
  50078 => 
  array (
    'SysNo' => 50078,
    'ShipTypeID' => '2021',
    'ShipTypeName' => '易迅第三方_G',
    'ShipTypeDesc' => '支持货到付款及POS机刷卡（刷卡用户请在订单备注中注明；货到付款请认准杭州爱彼西，付款前请先打开易迅包装检验 ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => -1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 0,
  ),
  50079 => 
  array (
    'SysNo' => 50079,
    'ShipTypeID' => '2022',
    'ShipTypeName' => '易迅第三方_H',
    'ShipTypeDesc' => '支持货到付款及POS机刷卡（刷卡用户请在订单备注中注明；货到付款请认准杭州爱彼西，付款前请先打开易迅包装检验 ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => -1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 0,
  ),
  50080 => 
  array (
    'SysNo' => 50080,
    'ShipTypeID' => '2023',
    'ShipTypeName' => '易迅第三方_I',
    'ShipTypeDesc' => '支持货到付款及POS机刷卡（刷卡用户请在订单备注中注明；货到付款请认准杭州爱彼西，付款前请先打开易迅包装检验 ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => -1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 0,
  ),
  50082 => 
  array (
    'SysNo' => 50082,
    'ShipTypeID' => '2025',
    'ShipTypeName' => '易迅第三方_K',
    'ShipTypeDesc' => '支持货到付款及POS机刷卡（刷卡用户请在订单备注中注明；货到付款请认准杭州爱彼西，付款前请先打开易迅包装检验 ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => -1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 0,
  ),
  31484 => 
  array (
    'SysNo' => 31484,
    'ShipTypeID' => '2017',
    'ShipTypeName' => '易迅第三方_成都立即送',
    'ShipTypeDesc' => '支持<font class=strong>货到付款及POS机刷卡</font>（刷卡用户请在订单备注中注明；<font class=strong>货到付款请认准成都立即送，付款前请先打开易迅包装检验</font> ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => 0,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 1,
  ),
  50084 => 
  array (
    'SysNo' => 50084,
    'ShipTypeID' => '2027',
    'ShipTypeName' => '易迅第三方_M',
    'ShipTypeDesc' => '支持货到付款及POS机刷卡（刷卡用户请在订单备注中注明；货到付款请认准杭州爱彼西，付款前请先打开易迅包装检验 ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => -1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 0,
  ),
  50081 => 
  array (
    'SysNo' => 50081,
    'ShipTypeID' => '2024',
    'ShipTypeName' => '易迅第三方_J',
    'ShipTypeDesc' => '支持货到付款及POS机刷卡（刷卡用户请在订单备注中注明；货到付款请认准杭州爱彼西，付款前请先打开易迅包装检验 ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => -1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 0,
  ),
  50085 => 
  array (
    'SysNo' => 50085,
    'ShipTypeID' => '2028',
    'ShipTypeName' => '易迅第三方_N',
    'ShipTypeDesc' => '支持货到付款及POS机刷卡（刷卡用户请在订单备注中注明；货到付款请认准杭州爱彼西，付款前请先打开易迅包装检验 ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => -1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 0,
  ),
  50086 => 
  array (
    'SysNo' => 50086,
    'ShipTypeID' => '2029',
    'ShipTypeName' => '易迅第三方_O',
    'ShipTypeDesc' => '支持货到付款及POS机刷卡（刷卡用户请在订单备注中注明；货到付款请认准杭州爱彼西，付款前请先打开易迅包装检验 ）',
    'PremiumRate' => '0.000000',
    'PremiumBase' => 0,
    'FreeShipBase' => 0,
    'Status' => -1,
    'StatusQueryType' => 1,
    'StatusQueryUrl' => NULL,
    'IsOnlineShow' => 0,
  ),
);

 static $shipLimit = array (
  1 => 
  array (
    4 => 
    array (
      0 => 
      array (
        0 => 1,
        1 => 43,
        2 => 46,
        3 => 92,
        4 => 112,
        5 => 30612,
        6 => 30752,
        7 => 30753,
        8 => 30761,
        9 => 30762,
        10 => 30790,
        11 => 30804,
        12 => 30812,
      ),
    ),
    5 => 
    array (
      0 => 
      array (
        0 => 1,
        1 => 7,
        2 => 8,
        3 => 43,
        4 => 46,
        5 => 92,
        6 => 112,
        7 => 30612,
        8 => 30752,
        9 => 30753,
        10 => 30761,
        11 => 30762,
        12 => 30790,
        13 => 30804,
        14 => 112,
        15 => 31484,
        16 => 30812,
        17 => 30821,
        18 => 2,
      ),
      2 => 
      array (
        7 => 
        array (
          'province' => 
          array (
            0 => 1,
            1 => 131,
            2 => 201,
            3 => 403,
            4 => 814,
            5 => 1144,
            6 => 1323,
            7 => 1454,
            8 => 1591,
            9 => 1718,
            10 => 2329,
            11 => 2490,
            12 => 2621,
          ),
          'delivery' => 
          array (
            0 => 7,
          ),
        ),
        2 => 
        array (
          'province' => 
          array (
            0 => 3225,
          ),
          'delivery' => 
          array (
            0 => 2,
          ),
        ),
      ),
    ),
    6 => 
    array (
      2 => 
      array (
        '' => 
        array (
          'province' => 
          array (
            0 => 1,
            1 => 1591,
            2 => 2621,
            3 => 3225,
          ),
        ),
      ),
    ),
    8 => 
    array (
      1 => 
      array (
        0 => 1,
        1 => 43,
        2 => 46,
        3 => 30612,
        4 => 30752,
        5 => 30753,
        6 => 30761,
        7 => 30762,
        8 => 30790,
        9 => 30804,
      ),
    ),
    10 => 
    array (
      0 => 
      array (
        0 => 8,
      ),
    ),
    11 => 
    array (
      2 => 
      array (
        1 => 
        array (
          'province' => 
          array (
            0 => 2621,
          ),
          'delivery' => 
          array (
            0 => 1,
          ),
        ),
      ),
      0 => 
      array (
        0 => 1,
      ),
    ),
    19 => 
    array (
      2 => 
      array (
        1 => 
        array (
          'district' => 
          array (
            0 => 1598,
            1 => 1600,
            2 => 1601,
            3 => 1602,
            4 => 1603,
            5 => 1604,
            6 => 1693,
            7 => 1694,
            8 => 1695,
            9 => 1697,
            10 => 3485,
            11 => 3486,
            12 => 3622,
            13 => 3696,
            14 => 4122,
            15 => 4102,
            16 => 3227,
            17 => 3232,
            18 => 3231,
            19 => 3738,
            20 => 3229,
            21 => 4104,
          ),
          'delivery' => 
          array (
            0 => 1,
          ),
          'province' => 
          array (
            0 => 2621,
          ),
        ),
      ),
      0 => 
      array (
        0 => 1,
      ),
    ),
    24 => 
    array (
      2 => 
      array (
        1 => 
        array (
          'district' => 
          array (
            0 => 2624,
            1 => 2625,
            2 => 2626,
            3 => 2627,
            4 => 2628,
            5 => 2629,
            6 => 2630,
            7 => 2631,
            8 => 2632,
            9 => 2633,
            10 => 2637,
            11 => 2638,
            12 => 3329,
            13 => 3333,
            14 => 3525,
          ),
          'delivery' => 
          array (
            0 => 1,
          ),
        ),
      ),
      0 => 
      array (
        0 => 1,
      ),
    ),
  ),
  1001 => 
  array (
    13 => 
    array (
      1 => 
      array (
        0 => 5,
        1 => 7,
        2 => 23,
        3 => 72,
      ),
    ),
    14 => 
    array (
      2 => 
      array (
        1 => 
        array (
          'city' => 
          array (
            0 => 420,
          ),
          'delivery' => 
          array (
            0 => 1,
          ),
          'district' => 
          array (
            0 => 3763,
            1 => 418,
            2 => 3764,
            3 => 3842,
            4 => 413,
            5 => 3765,
            6 => 412,
            7 => 481,
          ),
        ),
        30612 => 
        array (
          'district' => 
          array (
            0 => 4282,
          ),
          'delivery' => 
          array (
            0 => 30612,
          ),
        ),
      ),
      0 => 
      array (
        0 => 1,
        1 => 45,
        2 => 92,
        3 => 112,
        4 => 30612,
      ),
      1 => 
      array (
        0 => 30812,
        1 => 30761,
        2 => 30800,
      ),
    ),
    15 => 
    array (
      1 => 
      array (
        0 => 1,
        1 => 22,
        2 => 45,
        3 => 92,
        4 => 30612,
        5 => 30761,
      ),
    ),
    16 => 
    array (
      1 => 
      array (
        0 => 2,
        1 => 32,
      ),
    ),
    18 => 
    array (
      0 => 
      array (
        0 => 1,
        1 => 5,
        2 => 7,
        3 => 22,
        4 => 23,
        5 => 45,
        6 => 72,
        7 => 92,
        8 => 30612,
        9 => 30761,
        10 => 30800,
        11 => 112,
        12 => 30812,
      ),
      2 => 
      array (
        5 => 
        array (
          'province' => 
          array (
            0 => 1,
            1 => 131,
            2 => 201,
            3 => 403,
            4 => 814,
            5 => 1144,
            6 => 1323,
            7 => 1454,
            8 => 1591,
            9 => 1718,
            10 => 2329,
            11 => 2490,
            12 => 2621,
            13 => 3225,
          ),
          'delivery' => 
          array (
            0 => 5,
          ),
        ),
        7 => 
        array (
          'province' => 
          array (
            0 => 1,
            1 => 131,
            2 => 201,
            3 => 403,
            4 => 814,
            5 => 1144,
            6 => 1323,
            7 => 1454,
            8 => 1591,
            9 => 1718,
            10 => 2329,
            11 => 2490,
            12 => 2621,
            13 => 3225,
          ),
          'delivery' => 
          array (
            0 => 7,
          ),
        ),
        23 => 
        array (
          'province' => 
          array (
            0 => 1,
            1 => 131,
            2 => 201,
            3 => 403,
            4 => 814,
            5 => 1144,
            6 => 1323,
            7 => 1454,
            8 => 1591,
            9 => 1718,
            10 => 2329,
            11 => 2490,
            12 => 2621,
            13 => 3225,
          ),
          'delivery' => 
          array (
            0 => 23,
          ),
        ),
        72 => 
        array (
          'province' => 
          array (
            0 => 1,
            1 => 131,
            2 => 201,
            3 => 403,
            4 => 814,
            5 => 1144,
            6 => 1323,
            7 => 1454,
            8 => 1591,
            9 => 1718,
            10 => 2329,
            11 => 2490,
            12 => 2621,
            13 => 3225,
          ),
          'delivery' => 
          array (
            0 => 72,
          ),
        ),
      ),
    ),
    35 => 
    array (
      0 => 
      array (
        0 => 30612,
        1 => 30812,
        2 => 1,
        3 => 112,
        4 => 30761,
      ),
    ),
    36 => 
    array (
      2 => 
      array (
        1 => 
        array (
          'city' => 
          array (
            0 => 420,
          ),
          'delivery' => 
          array (
            0 => 1,
          ),
        ),
      ),
      0 => 
      array (
        0 => 1,
      ),
    ),
  ),
  2001 => 
  array (
    20 => 
    array (
      1 => 
      array (
        0 => 1,
        1 => 44,
        2 => 92,
        3 => 102,
        4 => 30762,
      ),
    ),
    21 => 
    array (
      0 => 
      array (
        0 => 1,
        1 => 7,
        2 => 44,
        3 => 54,
        4 => 92,
        5 => 102,
        6 => 30762,
        7 => 112,
      ),
      2 => 
      array (
        7 => 
        array (
          'province' => 
          array (
            0 => 1,
            1 => 131,
            2 => 201,
            3 => 403,
            4 => 814,
            5 => 1144,
            6 => 1323,
            7 => 1454,
            8 => 1591,
            9 => 1718,
            10 => 2329,
            11 => 2490,
            12 => 2621,
            13 => 3225,
          ),
          'delivery' => 
          array (
            0 => 7,
          ),
        ),
        54 => 
        array (
          'province' => 
          array (
            0 => 1,
            1 => 131,
            2 => 201,
            3 => 403,
            4 => 814,
            5 => 1144,
            6 => 1323,
            7 => 1454,
            8 => 1591,
            9 => 1718,
            10 => 2329,
            11 => 2490,
            12 => 2621,
            13 => 3225,
          ),
          'delivery' => 
          array (
            0 => 54,
          ),
        ),
      ),
    ),
    23 => 
    array (
      0 => 
      array (
        0 => 1,
        1 => 30762,
        2 => 112,
      ),
    ),
    22 => 
    array (
      0 => 
      array (
        0 => 112,
        1 => 1,
        2 => 30762,
      ),
      2 => 
      array (
        1 => 
        array (
          'district' => 
          array (
            0 => 4082,
            1 => 3781,
            2 => 3793,
            3 => 3779,
            4 => 3803,
            5 => 3962,
            6 => 3801,
            7 => 4005,
            8 => 3795,
            9 => 4003,
            10 => 3802,
            11 => 3822,
            12 => 3794,
            13 => 3780,
            14 => 3811,
            15 => 3804,
            16 => 3985,
            17 => 3796,
            18 => 3792,
            19 => 4006,
            20 => 3810,
            21 => 3812,
          ),
          'delivery' => 
          array (
            0 => 1,
          ),
        ),
        30762 => 
        array (
          'district' => 
          array (
            0 => 3983,
            1 => 4007,
          ),
          'delivery' => 
          array (
            0 => 30762,
          ),
        ),
      ),
    ),
  ),
  4001 => 
  array (
    25 => 
    array (
      1 => 
      array (
        0 => 1,
        1 => 92,
      ),
    ),
    26 => 
    array (
      0 => 
      array (
        0 => 1,
        1 => 7,
        2 => 92,
        3 => 112,
        4 => 30821,
        5 => 31484,
      ),
      2 => 
      array (
        7 => 
        array (
          'province' => 
          array (
            0 => 1,
            1 => 131,
            2 => 158,
            3 => 201,
            4 => 403,
            5 => 814,
            6 => 1144,
            7 => 1323,
            8 => 1454,
            9 => 1591,
            10 => 1718,
            11 => 2329,
            12 => 2490,
            13 => 2621,
            14 => 2652,
            15 => 3225,
          ),
          'delivery' => 
          array (
            0 => 7,
          ),
        ),
      ),
    ),
    27 => 
    array (
      0 => 
      array (
        0 => 1,
        1 => 92,
      ),
      2 => 
      array (
        92 => 
        array (
          'province' => 
          array (
            0 => 158,
          ),
          'delivery' => 
          array (
            0 => 92,
          ),
        ),
      ),
    ),
    28 => 
    array (
      2 => 
      array (
        1 => 
        array (
          'province' => 
          array (
            0 => 158,
          ),
          'delivery' => 
          array (
            0 => 1,
          ),
        ),
      ),
      0 => 
      array (
        0 => 1,
      ),
    ),
  ),
  3001 => 
  array (
    29 => 
    array (
      1 => 
      array (
        0 => 1,
        1 => 92,
        2 => 30804,
      ),
    ),
    30 => 
    array (
      0 => 
      array (
        0 => 1,
        1 => 7,
        2 => 92,
        3 => 30804,
        4 => 112,
      ),
      2 => 
      array (
        7 => 
        array (
          'province' => 
          array (
            0 => 1,
            1 => 131,
            2 => 201,
            3 => 403,
            4 => 814,
            5 => 1144,
            6 => 1323,
            7 => 1454,
            8 => 1591,
            9 => 1718,
            10 => 2329,
            11 => 2490,
            12 => 2621,
            13 => 2652,
            14 => 3225,
          ),
          'delivery' => 
          array (
            0 => 7,
          ),
        ),
      ),
    ),
    31 => 
    array (
      2 => 
      array (
        1 => 
        array (
          'city' => 
          array (
            0 => 1324,
          ),
          'delivery' => 
          array (
            0 => 1,
          ),
        ),
        92 => 
        array (
          'city' => 
          array (
            0 => 1324,
          ),
          'delivery' => 
          array (
            0 => 92,
          ),
        ),
      ),
      0 => 
      array (
        0 => 1,
        1 => 92,
        2 => 30804,
      ),
    ),
    37 => 
    array (
      2 => 
      array (
        1 => 
        array (
          'city' => 
          array (
            0 => 1324,
          ),
          'delivery' => 
          array (
            0 => 1,
          ),
        ),
      ),
      0 => 
      array (
        0 => 1,
      ),
    ),
  ),
  5001 => 
  array (
    32 => 
    array (
      1 => 
      array (
        0 => 1,
        1 => 92,
      ),
    ),
    33 => 
    array (
      0 => 
      array (
        0 => 1,
        1 => 7,
        2 => 92,
        3 => 12,
        4 => 112,
      ),
      2 => 
      array (
        7 => 
        array (
          'province' => 
          array (
            0 => 1,
            1 => 131,
            2 => 201,
            3 => 403,
            4 => 814,
            5 => 1144,
            6 => 1454,
            7 => 1591,
            8 => 1718,
            9 => 2329,
            10 => 2490,
            11 => 2621,
            12 => 2652,
            13 => 3225,
          ),
          'delivery' => 
          array (
            0 => 7,
          ),
          'city' => 
          array (
            0 => 2213,
          ),
        ),
      ),
    ),
    34 => 
    array (
      0 => 
      array (
        0 => 1,
        1 => 92,
      ),
    ),
  ),
);
 
 
 static $_ShipTime = array(
	 1 => array(array('00:30:00',1),array('11:00:00',2),array('15:00:00',3),array('23:59:59',4)),
	 2=> array(array('00:30:00',1),array('11:00:00',2),array('15:00:00',3),array('23:59:59',4)),
	 3=> array(array('00:30:00',1),array('11:00:00',2),array('15:00:00',3),array('23:59:59',4)),
	 4=> array(array('00:30:00',1),array('11:00:00',2),array('15:00:00',3),array('23:59:59',4)),
	 5=> array(array('00:30:00',1),array('11:00:00',2),array('15:00:00',3),array('23:59:59',4)),
	 6=> array(array('00:30:00',1),array('11:00:00',2),array('15:00:00',3),array('23:59:59',4)),
	 7=> array(array('00:30:00',1),array('11:00:00',2),array('15:00:00',3),array('23:59:59',4)),
 );
 static $_ShipLimitTime = array(
	 1=> array(array('00:30:00',2),array('11:00:00',3),array('15:00:00',3),array('23:59:59',4)),
	 2=> array(array('00:30:00',2),array('11:00:00',3),array('15:00:00',3),array('23:59:59',4)),
	 3=> array(array('00:30:00',2),array('11:00:00',3),array('15:00:00',3),array('23:59:59',4)),
	 4=> array(array('00:30:00',2),array('11:00:00',3),array('15:00:00',3),array('23:59:59',4)),
	 5=> array(array('00:30:00',2),array('11:00:00',3),array('15:00:00',3),array('23:59:59',4)),
	 6=> array(array('00:30:00',2),array('11:00:00',3),array('15:00:00',3),array('23:59:59',4)),
	 7=> array(array('00:30:00',2),array('11:00:00',3),array('15:00:00',3),array('23:59:59',4)),
 );
 //上门提取 1:上午 2:下午 4:下一个工作日上午
static  $_SelfShipTime = array(
	1=> array(array('00:30:00',1),array('11:00:00',2),array('23:59:59',4)),
	2=> array(array('00:30:00',1),array('11:00:00',2),array('23:59:59',4)),
	3=> array(array('00:30:00',1),array('11:00:00',2),array('23:59:59',4)),
	4=> array(array('00:30:00',1),array('11:00:00',2),array('23:59:59',4)),
	5=> array(array('00:30:00',1),array('11:00:00',2),array('23:59:59',4)),
	6=> array(array('00:30:00',1),array('11:00:00',2),array('23:59:59',4)),
	7=> array(array('00:30:00',1),array('11:00:00',2),array('23:59:59',4)),
);
static $_SelfShipLimitTime = array(
	 1=> array(array('00:30:00',2),array('11:00:00',4),array('23:59:59',4)),
	 2=> array(array('00:30:00',2),array('11:00:00',4),array('23:59:59',4)),
	 3=> array(array('00:30:00',2),array('11:00:00',4),array('23:59:59',4)),
	 4=> array(array('00:30:00',2),array('11:00:00',4),array('23:59:59',4)),
	 5=> array(array('00:30:00',2),array('11:00:00',4),array('23:59:59',4)),
	 6=> array(array('00:30:00',2),array('11:00:00',4),array('23:59:59',4)),
	 7=> array(array('00:30:00',2),array('11:00:00',4),array('23:59:59',4)),
 );

static $_ADDRESS_DC_MODE = array (
  480 => 'SZDC',
  469 => 'SZDC',
  432 => 'SZDC',
  556 => 'SZDC',
  1 => 'SHDC',
  2329 => 'BJDC',
  131 => 'BJDC',
  999 => 'BJDC',
  1900 => 'BJDC',
  2490 => 'BJDC',
  1323 => 'WHDC',
  1454 => 'WHDC',
  1718 => 'WHDC',
  158 => 'CQDC',
  2996 => 'CQDC',
  693 => 'CQDC',
  2212 => 'XADC',
  2878 => 'XADC',
  2130 => 'XADC',
  2160 => 'XADC',
  540 => 'SZDC',
  544 => 'SZDC',
  460 => 'SZDC',
  475 => 'SZDC',
  420 => 'SZDC',
  201 => 'SZDC',
  789 => 'SZDC',
  2621 => 'SHDC',
  814 => 'BJDC',
  2016 => 'BJDC',
  1830 => 'BJDC',
  3077 => 'CQDC',
  299 => 'XADC',
  453 => 'SZDC',
  2858 => 'BJDC',
  1144 => 'WHDC',
  2655 => 'CQDC',
  2660 => 'CQDC',
  2762 => 'CQDC',
  2772 => 'CQDC',
  2727 => 'CQDC',
  2777 => 'CQDC',
  2786 => 'CQDC',
  2732 => 'CQDC',
  2751 => 'CQDC',
  2688 => 'CQDC',
  5073 => 'CDDC',
  2654 => 'CQDC',
  2657 => 'CQDC',
  2658 => 'CQDC',
  2659 => 'CQDC',
  2661 => 'CQDC',
  2665 => 'CQDC',
  2672 => 'CQDC',
  2674 => 'CQDC',
  5078 => 'CQDC',
  2819 => 'CQDC',
  2824 => 'CQDC',
  2832 => 'CQDC',
  2839 => 'CQDC',
  2744 => 'CQDC',
  2675 => 'CQDC',
  2682 => 'CQDC',
  2694 => 'CQDC',
  2702 => 'CQDC',
  2709 => 'CQDC',
  2719 => 'CQDC',
  2800 => 'CQDC',
  5076 => 'CDDC',
  5077 => 'CDDC',
  5080 => 'CDDC',
  5081 => 'CDDC',
  5074 => 'CQDC',
  2656 => 'CQDC',
  2662 => 'CQDC',
  2663 => 'CQDC',
  2664 => 'CQDC',
  2671 => 'CQDC',
  5075 => 'CQDC',
  492 => 'GZDC',
  428 => 'GZDC',
  482 => 'GZDC',
  522 => 'GZDC',
  505 => 'GZDC',
  550 => 'GZDC',
  499 => 'GZDC',
  441 => 'GZDC',
  531 => 'GZDC',
  515 => 'GZDC',
  484 => 'GZDC',
  404 => 'GZDC',
  1674 => 'SHDC',
  1682 => 'SHDC',
  1667 => 'SHDC',
  3464 => 'SHDC',
  1692 => 'SHDC',
  1608 => 'SHDC',
  1593 => 'NJDC',
  1595 => 'NJDC',
  1598 => 'NJDC',
  1600 => 'NJDC',
  1601 => 'NJDC',
  1602 => 'NJDC',
  1603 => 'NJDC',
  1604 => 'NJDC',
  1605 => 'NJDC',
  3682 => 'NJDC',
  3683 => 'NJDC',
  3685 => 'NJDC',
  3686 => 'NJDC',
  1597 => 'SHDC',
  3622 => 'SHDC',
  3702 => 'SHDC',
  3684 => 'SHDC',
  3704 => 'SHDC',
  3703 => 'SHDC',
  1607 => 'SHDC',
  1596 => 'SHDC',
  3642 => 'SHDC',
  1649 => 'SHDC',
  1620 => 'SHDC',
  1657 => 'SHDC',
  1705 => 'SHDC',
  1712 => 'SHDC',
  1629 => 'SHDC',
  1639 => 'SHDC',
  5082 => 'CDDC',
  5088 => 'CDDC',
  5079 => 'CDDC',
  5089 => 'CDDC',
  5090 => 'CDDC',
  5091 => 'CDDC',
  4104 => 'HZDC',
  4122 => 'HZDC',
  3232 => 'HZDC',
  4123 => 'SHDC',
  3237 => 'SHDC',
  3238 => 'SHDC',
  3296 => 'SHDC',
  3301 => 'SHDC',
  3322 => 'SHDC',
  3463 => 'SHDC',
  3466 => 'SHDC',
  3264 => 'SHDC',
  3272 => 'SHDC',
  4102 => 'HZDC',
  3738 => 'HZDC',
  3735 => 'SHDC',
  3233 => 'SHDC',
  3240 => 'SHDC',
  3737 => 'SHDC',
  3230 => 'SHDC',
  3235 => 'SHDC',
  3252 => 'SHDC',
  3227 => 'HZDC',
  3229 => 'HZDC',
  3231 => 'HZDC',
  3734 => 'SHDC',
  3739 => 'SHDC',
  3736 => 'SHDC',
  4103 => 'SHDC',
  3472 => 'SHDC',
  3228 => 'SHDC',
  3234 => 'SHDC',
  3236 => 'SHDC',
  3239 => 'SHDC',
  3279 => 'SHDC',
  3289 => 'SHDC',
  3311 => 'SHDC',
);
}

?>