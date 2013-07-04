<?php

$biz_list = array(
	"admin",
	'service',
	'internal'
);


//默认管理员ID
$_ADMIN_CFG = array(
	'96667486',
	'66084',
	'5020481'
);

//时间戳
define('TIMESTAMP', time());

//用户最长未操作时间
define('KF_NOT_ACTIVE_TIME', 6 * 3600);	//超过此时间将被强制登出 且不会被分单

//分单配置
define('ASSIGN_KF_HANDLE_COUNT', 999);	//客服同时可处理最大单量
define('ASSIGN_KF_PROCESSING_COUNT', 999);	//客服同时处理中的单量

//权限配置
define('AUTH_SERVICE_REPLY',		1001);	//工单回复
define('AUTH_SERVICE_REASSGIN',		1002);	//转单
define('AUTH_SERVICE_SET',			1003);	//设为典型工单
define('AUTH_SERVICE_CLOSE_BATCH',	1004);	//批量关闭
define('AUTH_MEMBER_ADMIN',			1005);	//成员管理
define('AUTH_GROUP_ADMIN',			1006);	//分组管理
define('AUTH_ROLE_ADMIN',			1007);	//角色管理
define('AUTH_QA',					1008);	//质检

$_AUTH_CFG = array(
		AUTH_SERVICE_REPLY			=> '工单回复',
		AUTH_SERVICE_REASSGIN		=> '转单',
		AUTH_SERVICE_SET			=> '设为典型工单',
		AUTH_SERVICE_CLOSE_BATCH	=> '批量关单',
		AUTH_MEMBER_ADMIN			=> '成员管理',
		AUTH_GROUP_ADMIN			=> '分组管理',
		AUTH_ROLE_ADMIN				=> '角色管理',
		AUTH_QA						=> '质检'
);



//业务配置
define('BIZ_SERVICE_ORDER_URGE',		1);
define('BIZ_SERVICE_ORDER_MODIFY',		2);
define('BIZ_SERVICE_ORDER_CANCEL',		3);
define('BIZ_SERVICE_COMPLAINT',			4);
define('BIZ_SERVICE_QUESTION',		    5);
define('BIZ_SERVICE_SUGGEST',		    6);
//define('BIZ_SERVICE_PRAISE',		    7);
define('BIZ_SERVICE_VIP_USER',		    8);
define('BIZ_SERVICE_COMMENT',		    9);

$_BIZ_CFG = array(
		BIZ_SERVICE_ORDER_URGE		=> '订单催办',
		BIZ_SERVICE_ORDER_MODIFY	=> '订单修改',
		BIZ_SERVICE_ORDER_CANCEL	=> '订单取消',
		BIZ_SERVICE_COMPLAINT		=> '投诉',
		BIZ_SERVICE_QUESTION		=> '问题咨询',
		BIZ_SERVICE_SUGGEST	   		=> '建议表扬',
		//BIZ_SERVICE_PRAISE			=> '表扬',
		BIZ_SERVICE_VIP_USER		=> '预约服务',
		BIZ_SERVICE_COMMENT			=> '评论导入'
);

$_SERVICE_SUBTYPE = array(
	1 => array(),
	2 => array(
		201 => '修改收货信息',
		202 => '修改发票抬头',
		203 => '修改收货时间'
	),
	3 => array(),
	4 => array(
		401 => '商品问题',
		402 => '订单问题',
		403 => '物流问题',
		404 => '售后问题',
		405 => '活动问题',
		406 => '投诉客服',
		407 => '其它'
	),
	5 => array(
		501 => '活动咨询',
		502 => '其它'
	),
	6 => array(
		601 => '建议',
		602 => '表扬'
	),
	9	=> array(
		902	=> '一般满意',
		903	=> '不满意'
	)
);