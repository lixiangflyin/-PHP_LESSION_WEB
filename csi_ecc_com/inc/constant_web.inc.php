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
define('AUTH_COMPLAINT_DELETE',		1009);	//评论删除

$_AUTH_CFG = array(
		AUTH_SERVICE_REPLY			=> '工单回复',
		AUTH_SERVICE_REASSGIN		=> '转单',
		AUTH_SERVICE_SET			=> '设为典型工单',
		AUTH_SERVICE_CLOSE_BATCH	=> '批量关单',
		AUTH_MEMBER_ADMIN			=> '成员管理',
		AUTH_GROUP_ADMIN			=> '分组管理',
		AUTH_ROLE_ADMIN				=> '角色管理',
		AUTH_QA						=> '质检',
		AUTH_COMPLAINT_DELETE		=> '评论删除'
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

/*
 * 评论导入功能配置
 */
define("REIVEW_FILTER_REQUEST_TEMPLATE", 'uid=%d&cmd=%d&id=%d-%d-%d&ip=%s&content=%s');
define("REIVEW_REQUEST_TEMPLATE",
"cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=0\r\n");
define("REIVEW_WITH_FLAG_REQUEST_TEMPLATE",
"cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=0&flag=%d\r\n");
define("SYN_REIVEW_REQUEST_TEMPLATE",
"cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d\r\n");
define('TOP_USERS_NUMBER', 5);

$_REVIEW_CMD = array(
        "ADD"    => 1,
        "GET"    => 2,
        "DELETE" => 3,
        "UPDATE" => 4,
);
/**
  01  商品评论
  02  商品咨询
  03  评论回复
  04  商品评论统计
  05  商品咨询统计
  06  评论属性
  30  发送的站内消息
  31  接收到站`内消息
  32  站内消息
  33  发送站内消息统计
  34  接受站内消息统计
  35  发送站内消息属性
  36  接受站内消息属性
 */
$_REVIEW_CATEGORY = array(
        "PRODUCT_REVIEW"             => 1,
        "PRODUCT_ASKING"             => 2,
        "REVIEW_REPLY"               => 3,
        "STATISTIC_REVIEW"           => 4,
        "STATISTIC_ASKING"           => 5,
        "REVIEW_ATTRIBUTE"           => 6,
        "ICSON_REPLY"                => 7,
        "USER_REVIEW"                => 8,
        "USER_ASKING"                => 9,
        "REPLY_ATTRIBUTE"            => 10,
        "SEND_MESSAGE"               => 30,
        "RECEIVE_MESSAGE"            => 31,
        "SHORT_MESSAGE"              => 32,
        "STATISTIC_SEND_MESSAGE"     => 33,
        "STATISTIC_RECEIVE_MESSAGE"  => 34,
        "ATTRIBUTE_SEND_MESSAGE"     => 35,
        "ATTRIBUTE_RECEIVE_MESSAGE"  => 36,
        "DIY_REVIEW"                 => 40,
        "STATISTIC_DIY"              => 41,
        "PROMOTION_REVIEW"           => 50,
        "STATISTIC_PROMOTION"        => 51,
);

/**
  001  满意商品
  002  一般
  003  不满意商品
  004  讨论
  005  商品咨询
  006  配送/支付
  007  发票/保修
  008  商品满意度
  009  前5位评价者
  010  全部
  011  全部评论属性
  030  系统消息
  031  用户消息
  032  未读消息
 */
$_REVIEW_SUB_CATEGORY = array(
        "SATISFIED"       => 1,
        "GENERAL"         => 2,
        "UNSATISFIED"     => 3,
        "DISCUSSION"      => 4,
        "ASKING"          => 5,
        "TRANSPORT"       => 6,
        "INVOICE"         => 7,
        "SATISFACTION"    => 8,
        "TOPREVIEWS"      => 9,
        "ALL"             => 10,
        "ALL_REVIEWS"     => 11,
        "BATCH"           => 12,
        "SYSTEM_MESSAGE"  => 30,
        "USER_MESSAGE"    => 31,
        "UNREVIEW"        => 32,
        "DIY"             => 40,
        "PROMOTION"       => 50,
);

$_REVIEW_ATTRIBUTE_TYPE = array(
        "TOP"               => 1,
        "BEST"              => 2,
        "LIKE"              => 3,
        "UNLIKE"            => 4,
        "APPROVED"          => 5,
        "REJECTED"          => 6,
        "PENDING"           => 7,
        "DELETED"           => 8,
        "REVIEWED"          => 9,
        "UNTOP"             => 10,
        "UNBEST"            => 11,
);