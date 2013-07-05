<?php

// 组件类型
define('ACT_TYPE_COUPON', 1);
define('ACT_TYPE_LOTTERY', 2);
define('ACT_TYPE_APPOINT', 3);
define('ACT_TYPE_COMPONENT', 4);
	
// 验证关联对象类型
define('OBJECT_TYPE_ORDER', 1);
	
// 用户信息验证
define('VERIFY_TYPE_NEW_USER', 1);
define('VERIFY_TYPE_OLD_USER', 2);
define('VERIFY_TYPE_USER_LEVEL', 3);
define('VERIFY_TYPE_BIND_MOBILE', 4);
define('VERIFY_TYPE_BIND_EMAIL', 5);
define('VERIFY_TYPE_APPOINT', 6);

// QQ相关验证
define('VERIFY_TYPE_QQ', 41);
define('VERIFY_TYPE_VIP', 42);
define('VERIFY_TYPE_VIP_YEAR', 43);
define('VERIFY_TYPE_YELLOW', 44);
define('VERIFY_TYPE_YELLOW_YEAR', 45);
define('VERIFY_TYPE_BLUE', 46);
define('VERIFY_TYPE_BLUE_YEAR', 47);
define('VERIFY_TYPE_GREEN', 48);
define('VERIFY_TYPE_MP_VIP', 49);
	
// 订单相关验证
define('VERIFY_TYPE_ORDER_MONEY', 80);
define('VERIFY_TYPE_ORDER_TIME', 81);
define('VERIFY_TYPE_PAY_TYPE', 82);
define('VERIFY_TYPE_ORDER_PRODUCT', 83);
define('VERIFY_TYPE_ORDER_DAILY', 84);
	
global $_VERIFIER; 
$_VERIFIER = array(
	VERIFY_TYPE_NEW_USER => array('IUserVerifier', 'verifyNewUser'),
	VERIFY_TYPE_OLD_USER => array('IUserVerifier', 'verifyOldUser'),
	VERIFY_TYPE_USER_LEVEL => array('IUserVerifier', 'verifyLevel'),
	VERIFY_TYPE_BIND_MOBILE => array('IUserVerifier', 'verifyBindMobile'),
	VERIFY_TYPE_BIND_EMAIL => array('IUserVerifier', 'verifyBindEmail'),
	VERIFY_TYPE_APPOINT => array('IUserVerifier', 'verifyAppoint'),
	VERIFY_TYPE_QQ => array('IQQVerifier', 'verifyQQ'),
	VERIFY_TYPE_VIP => array('IQQVerifier', 'verifyVip'),
	VERIFY_TYPE_VIP_YEAR => array('IQQVerifier', 'verifyVipYear'),
	VERIFY_TYPE_YELLOW => array('IQQVerifier', 'verifyYellow'),
	VERIFY_TYPE_YELLOW_YEAR => array('IQQVerifier', 'verifyYellowYear'),
	VERIFY_TYPE_BLUE => array('IQQVerifier', 'verifyBlue'),
	VERIFY_TYPE_BLUE_YEAR => array('IQQVerifier', 'verifyBlueYear'),
	VERIFY_TYPE_GREEN => array('IQQVerifier', 'verifyGreen'),
	VERIFY_TYPE_MP_VIP => array('IQQVerifier', 'verifyMPVip'),
	VERIFY_TYPE_ORDER_MONEY => array('IOrderVerifier', 'verifyOrderMoney'),
	VERIFY_TYPE_ORDER_TIME => array('IOrderVerifier', 'verifyOrderTime'),
	VERIFY_TYPE_PAY_TYPE => array('IOrderVerifier', 'verifyPayType'),
	VERIFY_TYPE_ORDER_PRODUCT => array('IOrderVerifier', 'verifyOrderProduct'),
	VERIFY_TYPE_ORDER_DAILY => array('IOrderVerifier', 'verifyOrderDaily')
);

global $_VERIFIER_NAME; 
$_VERIFIER_NAME = array(
	VERIFY_TYPE_NEW_USER => '新用户',
	VERIFY_TYPE_OLD_USER => '老用户',
	VERIFY_TYPE_USER_LEVEL => '等级限制',
	VERIFY_TYPE_BIND_MOBILE => '绑定手机',
	VERIFY_TYPE_BIND_EMAIL => '绑定邮箱',
	VERIFY_TYPE_APPOINT => '预约用户',
	VERIFY_TYPE_QQ => 'QQ用户',
	VERIFY_TYPE_VIP => 'QQ会员',
	VERIFY_TYPE_VIP_YEAR => 'QQ年费会员',
	VERIFY_TYPE_YELLOW => '黄钻会员',
	VERIFY_TYPE_YELLOW_YEAR => '黄钻年费会员',
	VERIFY_TYPE_BLUE => '蓝钻会员',
	VERIFY_TYPE_BLUE_YEAR => '蓝钻年费会员',
	VERIFY_TYPE_GREEN => '绿钻会员',
	VERIFY_TYPE_MP_VIP => 'MP开通QQ会员',
	VERIFY_TYPE_ORDER_MONEY => '订单金额限制',
	VERIFY_TYPE_ORDER_TIME => '订单时间限制',
	VERIFY_TYPE_PAY_TYPE => '支付方式限制',
	VERIFY_TYPE_ORDER_PRODUCT => '订单商品限制',
	VERIFY_TYPE_ORDER_DAILY => '当日订单限制',
);

global $_VERIFIER_PARAMS;
$_VERIFIER_PARAMS = array(
	VERIFY_TYPE_ORDER_MONEY => array( 'order_id' ),
	VERIFY_TYPE_ORDER_TIME => array( 'order_id' ),
	VERIFY_TYPE_PAY_TYPE => array( 'order_id' ),
	VERIFY_TYPE_ORDER_PRODUCT => array( 'order_id' ),
	VERIFY_TYPE_ORDER_DAILY => array( 'order_id' ),
);

global $_VERIFY_ERR_MSG;
$_VERIFY_ERR_MSG = array(
	VERIFY_TYPE_NEW_USER => array(
		1 => '获取用户信息失败',
		2 => '不是新用户'
	),
	VERIFY_TYPE_OLD_USER => array(
		1 => '获取用户信息失败',
		2 => '不是老用户'
	),
	VERIFY_TYPE_USER_LEVEL => array(
		1 => '获取用户信息失败',
		2 => '用户等级不符合'
	),
	VERIFY_TYPE_BIND_MOBILE => array(
		1 => '获取用户信息失败',
		2 => '未设置手机号',
		3 => '手机未绑定'
	),
	VERIFY_TYPE_BIND_EMAIL => array(
		1 => '获取用户信息失败',
		2 => '未设置邮箱帐号',
		3 => '邮箱未绑定'
	),
	VERIFY_TYPE_APPOINT => array(
		1 => '获取用户信息失败',
		2 => '未预约用户'
	),
	VERIFY_TYPE_QQ => array(
		1 => '获取用户信息失败',
		2 => '不是QQ用户'
	),
	VERIFY_TYPE_VIP => array(
		1 => '获取用户信息失败',
		2 => '不是QQ用户',
		3 => '不是QQ会员'
	),
	VERIFY_TYPE_VIP_YEAR => array(
		1 => '获取用户信息失败',
		2 => '不是QQ用户',
		3 => '不是QQ年费会员'
	),
	VERIFY_TYPE_YELLOW => array(
		1 => '获取用户信息失败',
		2 => '不是QQ用户',
		3 => '不是黄钻会员'
	),
	VERIFY_TYPE_YELLOW_YEAR => array(
		1 => '获取用户信息失败',
		2 => '不是QQ用户',
		3 => '不是黄钻年费会员'
	),
	VERIFY_TYPE_BLUE => array(
		1 => '获取用户信息失败',
		2 => '不是QQ用户',
		3 => '不是蓝钻会员'
	),
	VERIFY_TYPE_BLUE_YEAR => array(
		1 => '获取用户信息失败',
		2 => '不是QQ用户',
		3 => '不是蓝钻年费会员'
	),
	VERIFY_TYPE_GREEN => array(
		1 => '获取用户信息失败',
		2 => '不是QQ用户',
		3 => '不是绿钻会员'
	),
	VERIFY_TYPE_MP_VIP => array(
		1 => '获取用户信息失败',
		2 => '不是QQ用户',
		3 => '不是MP开通QQ会员'
	),
	VERIFY_TYPE_ORDER_MONEY => array(
		1 => '获取订单信息失败',
		2 => '订单未付款',
		3 => '订单金额低于下限',
		4 => '订单金额高于上限',
		5 => '订单已被使用'
	),
	VERIFY_TYPE_ORDER_TIME => array(
		1 => '获取订单信息失败',
		2 => '订单未付款',
		3 => '订单时间过早',
		4 => '订单时间太晚',
		5 => '订单已被使用'
	),
	VERIFY_TYPE_PAY_TYPE => array(
		1 => '获取订单信息失败',
		2 => '订单未付款',
		3 => '支付方式不符合',
		5 => '订单已被使用'
	),
	VERIFY_TYPE_ORDER_PRODUCT => array(
		1 => '获取订单信息失败',
		2 => '订单未付款',
		3 => '未包含指定商品',
		4 => '未包含指定小类',
		5 => '订单已被使用'
	),
	VERIFY_TYPE_ORDER_DAILY => array(
		1 => '获取订单信息失败',
		2 => '订单未付款',
		3 => '不是当日订单',
		5 => '订单已被使用'
	),
);