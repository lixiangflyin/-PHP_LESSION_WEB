<?php
require_once(PHPLIB_ROOT . 'inc/constant.inc.php');

/*错误码定义*/
/*
 1000: MSSQL类错误
 1000: 无法找到数据库
 1001: 数据插入失败
 1002: 数据查询为空
 1003: 查询数据失败
 1004: 更新数据失败
 1005: sql语句参数丢失错误
 1006: 开启事务错误
 1007: 结束事务错误
 */
define('MP_ERROR_DB_GET_FAIL',				'1000');
define('MP_ERROR_DB_SELECT_NULL',			'1101');
define('MP_ERROR_DB_SELECT_FAIL',			'1102');
define('MP_ERROR_DB_INSERT_FAIL',			'1201');
define('MP_ERROR_DB_INSERT_EXIST',			'1202');
define('MP_ERROR_DB_UPDATE_FAIL',			'1301');
define('MP_ERROR_DB_PARAM_MISS',			'1901');
define('MP_ERROR_DB_TRANSACTION_FAIL',		'1902');
define('MP_ERROR_DB_COMMIT_FAIL',			'1903');

/*
2000: ttc类错误
2101: ttc查找数据为空
2102: ttc查找错误
2103: ttc查找数据不唯一
2201: ttc插入错误
2202: ttc插入数据已存在
2301: ttc更新错误
2401: ttc删除数据为空
2402: ttc删除数据错误
*/
define('MP_ERROR_TTC_SELECT_NULL',			'2101');
define('MP_ERROR_TTC_SELECT_FAIL',			'2102');
define('MP_ERROR_TTC_UNIQUESELECT_FAIL',	'2103');
define('MP_ERROR_TTC_INSERT_FAIL',			'2201');
define('MP_ERROR_TTC_INSERT_EXIST',			'2202');
define('MP_ERROR_TTC_UPDATE_FAIL',			'2301');
define('MP_ERROR_TTC_DEL_NULL',				'2401');
define('MP_ERROR_TTC_DEL_FAIL',				'2402');

/*
 9000: 参数类错误
 9001: 参数丢失
 9002: 所有bigint位都不可用
 9003: 未能找到对应价格
 9999: 其它错误
 */
define('MP_ERROR_PARAM_MISS',				'9001');
define('MP_ERROR_ALL_BITNUM_INVALID',		'9002');
define('MP_ERROR_GET_PRICES_FAIL',			'9003');
define('MP_ERROR_OTHERS',					'9999');

/*价格定义*/
define('MP_ALL_BIGINT_NUM',					'63');	//标识位位数bigint最大值共2^63-1

//价格状态
define('MP_STATUS_INVALID',					'-1'); 	//作废状态
define('MP_STATUS_INIT',					'0');  	//初始化状态
define('MP_STATUS_VALID',					'1');	//生效状态
define('MP_STATUS_APPROVAL',				'2');  	//待审核状态
define('MP_STATUS_LOCKED',					'3');	//锁定状态

//价格price_id定义
define('MP_ICSON_PRICE',					'0');	//原价
define('MP_FLASHSALE_PRICE',				'1');	//限时抢购价
define('MP_QQ_PRICE',						'4');	//qq用户价
define('MP_PROM_PRICE',						'5');	//内网活动特价
define('MP_QQTUAN_PRICE',					'6');	//qq团购价
define('MP_TIPS_PRICE',						'7');	//TIPS特价
define('MP_NEWUSER_PRICE',					'8');	//新用户特价
define('MP_Ali_PRICE',						'9');	//支付宝用户价
define('MP_QQVIP_PRICE',					'22');	//QQ会员专享价
define('MP_QQLvZ_PRICE',					'23');	//QQ绿钻专享价

//10-16为会员价格
define('MP_VIP_PRICE',						'998');	//会员价标识，price_id无此选项
define('MP_VIP0_PRICE',						'10');	//土星会员价
define('MP_VIP1_PRICE',						'11');	//铜盾会员价
define('MP_VIP2_PRICE',						'12');	//银盾会员价
define('MP_VIP3_PRICE',						'13');	//金盾会员价
define('MP_VIP4_PRICE',						'14');	//钻石会员价
define('MP_VIP5_PRICE',						'15');	//皇冠会员价
define('MP_VIP6_PRICE',						'16');	//易金鲸会员价

//18-21为经销商会员价格
define('MP_TRADER_PRICE',					'997');	//经销商会员价标识，price_id无此选项
define('MP_TRADER1_PRICE',					'18');	//一级经销商会员价
define('MP_TRADER2_PRICE',					'19');	//二级经销商会员价
define('MP_TRADER3_PRICE',					'20');	//三级经销商会员价
define('MP_TRADER4_PRICE',					'21');	//四级经销商会员价

//40-42为给移动终端
define('MP_MOBILE0_PRICE', 					'40'); 	//移动终端价格类型标识
define('MP_MOBILE1_PRICE', 					'41'); 	//移动终端价格类型标识
define('MP_MOBILE2_PRICE', 					'42'); 	//移动终端价格类型标识
define('MP_MAX_FIX_PRICE',						'43');  //固定价格类型最大价格，43到63动态分配价格id
define('MP_OTHER_PRICE',						'999'); //自定义价格类型标识

//价格计算类型
define('MP_COUNT_BY_PRICE',					'1');   //按价格计算
define('MP_COUNT_BY_DISCOUNT',		'2');	//按折扣计算
define('MP_COUNT_BY_SUBTRACT',			'3');	//按低易迅价*元计算

//价格验证定义
define('MP_PRICETYPE_UNIQUE',							'1');	//价格唯一
define('MP_PRICESCOPE_UNIQUE',						'2');	//价格范围唯一
define('MP_PRICE_NORMAL',								'3'); 	//价格无范围限制 (但不包括规则类限制)

define('MP_PRICE_NAME_INDEX',							'0');	//价格名称索引
define('MP_PRICE_KEYWORD_INDEX',					'1');	//价格需要验证的关键字
define('MP_PRICE_DEFAULT_KEYWORD_INDEX',	'2');	//价格默认需要验证的关键字
define('MP_PRICE_DEFAULTNAME_INDEX',			'3');	//价格默认名称
define('MP_PRICE_UNIQUE_INDEX',						'4'); 	//价格范围限制

$_MP_VIP_PRICE = array(
MP_VIP0_PRICE	 => '土星会员价',
MP_VIP1_PRICE	 => '铜盾会员价',
MP_VIP2_PRICE	 => '银盾会员价',
MP_VIP3_PRICE	 => '金盾会员价',
MP_VIP4_PRICE	 => '钻石会员价',
MP_VIP5_PRICE	 => '皇冠会员价',
MP_VIP6_PRICE	 => '易金鲸会员价'
);

$_MP_TRADER_PRICE = array(
MP_TRADER1_PRICE => '一级经销商会员价',
MP_TRADER2_PRICE => '二级经销商会员价',
MP_TRADER3_PRICE => '三级经销商会员价',
MP_TRADER4_PRICE => '四级经销商会员价'
);

//价格状态代码
$_Price_Status = array(
MP_STATUS_INVALID	 => '无效中',
MP_STATUS_INIT		 => '初始化',
MP_STATUS_VALID	 	 => '生效中',
MP_STATUS_APPROVAL	 => '待审核',
MP_STATUS_LOCKED	 => '锁定中'
);

//价格计算类型
$_Price_Count_Type = array(
MP_COUNT_BY_DISCOUNT => '折扣',
MP_COUNT_BY_PRICE 	 => '价格',
MP_COUNT_BY_SUBTRACT => '立减'
);

//价格类型
//		price_id=> array(	价格名称索引				可选验证的关键字	默认验证规则 	默认名称			范围限制)
global $_Price_Type;
$_Price_Type = array(
	MP_VIP_PRICE		=> array('会员价',			'',					'',			'会员价',		MP_PRICE_NORMAL),
	MP_FLASHSALE_PRICE	=> array('限时抢购',			'Tel,Mail',			'',			'限时抢购',		MP_PRICETYPE_UNIQUE),
	MP_QQ_PRICE			=> array('QQ用户特价',		'Tel,Mail',			'QQ_',		'QQ用户特价',	MP_PRICETYPE_UNIQUE),
	MP_Ali_PRICE		=> array('支付宝用户特价',	'Tel,Mail',			'Ali_',		'支付宝用户特价',MP_PRICETYPE_UNIQUE),
	MP_TRADER_PRICE		=> array('经销商会员价',		'',					'',			'经销商会员价',	MP_PRICE_NORMAL),
	MP_QQVIP_PRICE		=> array('QQ会员专享价',		'Tel,Mail',			'QQVip_',	'QQ会员专享价',	MP_PRICETYPE_UNIQUE),
	MP_QQLvZ_PRICE		=> array('QQ绿钻专享价',		'Tel,Mail',			'QQLvZ_',	'QQ绿钻专享价',	MP_PRICETYPE_UNIQUE),
	//	MP_PROM_PRICE		=> array('内网活动特价',		'Prom,Tel,Mail',	'',			'活动特价',		MP_PRICESCOPE_UNIQUE),
	//	MP_QQTUAN_PRICE		=> array('QQ团购',			'TQQ,Tel,Mail',		'',			'QQ团购特价',		MP_PRICESCOPE_UNIQUE),
	//	MP_TIPS_PRICE		=> array('QQTips特价',		'Tips,QQ,Tel,Mail',	'',			'Tips特价',		MP_PRICESCOPE_UNIQUE),
	MP_NEWUSER_PRICE	=> array('新用户特价',			'Tel,Mail',		'New_',		'新用户特价',		MP_PRICETYPE_UNIQUE),
	MP_MOBILE0_PRICE	=> array('移动终端价1',			'',				'',			'移动终端价1',		MP_PRICETYPE_UNIQUE),
	MP_MOBILE1_PRICE	=> array('移动终端价2',			'',				'',			'移动终端价2',		MP_PRICETYPE_UNIQUE),
	MP_MOBILE2_PRICE	=> array('移动终端价3',			'',				'',			'移动终端价3',		MP_PRICETYPE_UNIQUE),
	MP_OTHER_PRICE		=> array('其他条件触发特价',	'other_conditions',	'',			'活动价',			MP_PRICE_NORMAL)
);

//会员价格类型
global $_VIP_Type;
$_VIP_Type = array(
MP_VIP0_PRICE		=> array('土星会员价',		'Tel,Mail',			'L_0',		'土星会员价',	MP_PRICESCOPE_UNIQUE),
MP_VIP1_PRICE		=> array('铜盾会员价',		'Tel,Mail',			'L_1',		'铜盾会员价',	MP_PRICESCOPE_UNIQUE),
MP_VIP2_PRICE		=> array('银盾会员价',		'Tel,Mail',			'L_2',		'银盾会员价',	MP_PRICESCOPE_UNIQUE),
MP_VIP3_PRICE		=> array('金盾会员价',		'Tel,Mail',			'L_3',		'金盾会员价',	MP_PRICESCOPE_UNIQUE),
MP_VIP4_PRICE		=> array('钻石会员价',		'Tel,Mail',			'L_4',		'钻石会员价',	MP_PRICESCOPE_UNIQUE),
MP_VIP5_PRICE		=> array('皇冠会员价',		'Tel,Mail',			'L_5',		'皇冠会员价',	MP_PRICESCOPE_UNIQUE),
MP_VIP6_PRICE		=> array('易金鲸会员价',		'Tel,Mail',			'L_6',		'易金鲸会员价',	MP_PRICESCOPE_UNIQUE)
);

//经销商会员价格类型
global $_TRADER_Type;
$_TRADER_Type = array(
MP_TRADER1_PRICE	=> array('一级经销商会员价',	'Tel,Mail',			'TRD_1',		'一级经销商会员价',	MP_PRICESCOPE_UNIQUE),
MP_TRADER2_PRICE	=> array('二级经销商会员价',	'Tel,Mail',			'TRD_2',		'二级经销商会员价',	MP_PRICESCOPE_UNIQUE),
MP_TRADER3_PRICE	=> array('三级经销商会员价',	'Tel,Mail',			'TRD_3',		'三级经销商会员价',	MP_PRICESCOPE_UNIQUE),
MP_TRADER4_PRICE	=> array('四级经销商会员价',	'Tel,Mail',			'TRD_4',		'四级经销商会员价',	MP_PRICESCOPE_UNIQUE)
);
//所有价格类型

global $_All_Price_Type;
$_All_Price_Type = array(
	MP_VIP0_PRICE		=> array('土星会员价',		'Tel,Mail',			'L_0',	'土星会员价',	MP_PRICESCOPE_UNIQUE),
	MP_VIP1_PRICE		=> array('铜盾会员价',		'Tel,Mail',			'L_1',	'铜盾会员价',	MP_PRICESCOPE_UNIQUE),
	MP_VIP2_PRICE		=> array('银盾会员价',		'Tel,Mail',			'L_2',	'银盾会员价',	MP_PRICESCOPE_UNIQUE),
	MP_VIP3_PRICE		=> array('金盾会员价',		'Tel,Mail',			'L_3',	'金盾会员价',	MP_PRICESCOPE_UNIQUE),
	MP_VIP4_PRICE		=> array('钻石会员价',		'Tel,Mail',			'L_4',	'钻石会员价',	MP_PRICESCOPE_UNIQUE),
	MP_VIP5_PRICE		=> array('皇冠会员价',		'Tel,Mail',			'L_5',	'皇冠会员价',	MP_PRICESCOPE_UNIQUE),
	MP_VIP6_PRICE		=> array('易金鲸会员价',		'Tel,Mail',			'L_6',	'易金鲸会员价',	MP_PRICESCOPE_UNIQUE),
	MP_TRADER1_PRICE	=> array('一级经销商会员价',	'Tel,Mail',			'TRD_1','一级经销商会员价',	MP_PRICESCOPE_UNIQUE),
	MP_TRADER2_PRICE	=> array('二级经销商会员价',	'Tel,Mail',			'TRD_2','二级经销商会员价',	MP_PRICESCOPE_UNIQUE),
	MP_TRADER3_PRICE	=> array('三级经销商会员价',	'Tel,Mail',			'TRD_3','三级经销商会员价',	MP_PRICESCOPE_UNIQUE),
	MP_TRADER4_PRICE	=> array('四级经销商会员价',	'Tel,Mail',			'TRD_4','四级经销商会员价',	MP_PRICESCOPE_UNIQUE),
	MP_QQVIP_PRICE		=> array('QQ会员专享价',		'Tel,Mail',			'QQVip_','QQ会员专享价',	MP_PRICETYPE_UNIQUE),
	MP_QQLvZ_PRICE		=> array('QQ绿钻专享价',		'Tel,Mail',			'QQLvZ_','QQ绿钻专享价',	MP_PRICETYPE_UNIQUE),
	MP_FLASHSALE_PRICE	=> array('限时抢购',			'Tel,Mail',			'',		'限时抢购',		MP_PRICETYPE_UNIQUE),
	MP_QQ_PRICE			=> array('QQ用户特价',		'Tel,Mail',			'QQ_',	'QQ用户特价',	MP_PRICETYPE_UNIQUE),
	MP_Ali_PRICE		=> array('支付宝用户',		'Tel,Mail',			'Ali_',	'支付宝用户特价',MP_PRICETYPE_UNIQUE),
	//	MP_PROM_PRICE		=> array('内网活动特价',		'Prom,Tel,Mail',	'',		'活动特价',		MP_PRICESCOPE_UNIQUE),
	//	MP_QQTUAN_PRICE		=> array('QQ团购',			'TQQ,Tel,Mail',		'',		'QQ团购特价',		MP_PRICESCOPE_UNIQUE),
	//	MP_TIPS_PRICE		=> array('QQTips特价',		'Tips,QQ,Tel,Mail',	'',		'Tips特价',		MP_PRICESCOPE_UNIQUE),
	MP_NEWUSER_PRICE	=> array('新用户特价',		'Tel,Mail',			'New_',	'新用户特价',	MP_PRICETYPE_UNIQUE),
	MP_MOBILE0_PRICE	=> array('移动终端价1',			'',				'',			'移动终端价1',		MP_PRICETYPE_UNIQUE),
	MP_MOBILE1_PRICE	=> array('移动终端价2',			'',				'',			'移动终端价2',		MP_PRICETYPE_UNIQUE),
	MP_MOBILE2_PRICE	=> array('移动终端价3',			'',				'',			'移动终端价3',		MP_PRICETYPE_UNIQUE),
	MP_OTHER_PRICE		=> array('其他条件触发特价',	'other_conditions',	'',		'活动价',			MP_PRICE_NORMAL),
);

//list默认拉取的价格类型
global $_List_Price_Type;
$_List_Price_Type = array(
	MP_FLASHSALE_PRICE,
	MP_VIP0_PRICE,
	MP_VIP1_PRICE,
	MP_VIP2_PRICE,
	MP_VIP3_PRICE,
	MP_VIP4_PRICE,
	MP_VIP5_PRICE,
	MP_VIP6_PRICE,
	MP_QQ_PRICE,
	MP_QQVIP_PRICE,
	MP_QQLvZ_PRICE,
	MP_Ali_PRICE,
	//	MP_PROM_PRICE,
	//	MP_QQTUAN_PRICE,
	//	MP_TIPS_PRICE,
	MP_NEWUSER_PRICE,
	MP_MOBILE0_PRICE,
	MP_MOBILE1_PRICE,
	MP_MOBILE2_PRICE,
);

//价格验证点
global $_Price_VerifyPoint;
$_Price_VerifyPoint = array(
//  价格验证点标识		后台管理系统显示的价格验证点名称 添加价格时验证的数据类型
	'FSALE'		=>	array('限时抢购',		'') ,
	'L'			=>	array('会员用户范围:',	'vip_level'),
	'New'		=>	array('新用户',			''),
//	'Tips'		=>	array('Tips用户',		'string'),
	'QQ'		=>	array('QQ用户',			''),
	'Ali'		=>	array('支付宝用户',	 	''),
	'QQVip'		=>	array('QQ会员用户',	 	''),
	'QQLvZ'		=>	array('QQ绿钻用户',	 	''),
	'Tuan'		=>	array('来自易迅团购',	''),
	'TRD'		=>	array('经销商用户范围',	'trader_level'),
//	'TQQ'		=>	array('QQ团购',			''),
//	'Prom'		=>	array('内网活动编号:',	'number'),
	'Tel'		=> 	array('需手机验证',		''),
	'Mail'		=>	array('需邮箱验证',		'')
);

//价格验证点对应的函数函数点
global $_Verifyfunc;
$_Verifyfunc = array(
	'FSALE'		=>	'verify_FSALE',
	'L'			=>	'verify_L',
	'New'		=>	'verify_New',
	'Tips'		=>	'verify_Tips',
	'QQ'		=>	'verify_QQ',
	'TRD'		=>	'verify_TRD',
	'QQVip'		=>	'verify_QQVip',
	'QQLvZ'		=>	'verify_QQLvz',
	'Tuan'		=>	'verify_Tuan',
	'TQQ'		=>	'verify_TQQ',
	'Prom'		=>	'verify_Prom',
	'Tel'		=>	'verify_Tel',
	'Mail'		=>	'verify_Mail',
	'Ali'		=>	'verify_Ali',
);


class IMultiPrice
{
	public static $errCode 		= 0;
	public static $errMsg 		= '';

	public static $dbName 		= 'product_multiprice_';
	public static $tableName 	= 't_product_multiprice_';

	public static $dbNum 		= 10;
	public static $tableNum 	= 100;

	public static $errArray = array(
		MP_ERROR_DB_GET_FAIL						=>'数据库连接错误!',
		MP_ERROR_DB_INSERT_FAIL				=>'数据库插入错误!',
		MP_ERROR_DB_INSERT_EXIST				=>'待插入数据已经存在!',
		MP_ERROR_DB_SELECT_NULL				=>'数据库查找数据为空!',
		MP_ERROR_DB_SELECT_FAIL				=>'数据库查找错误!',
		MP_ERROR_DB_UPDATE_FAIL				=>'数据库更新错误!',
		MP_ERROR_DB_PARAM_MISS				=>'数据库参数错误!',
		MP_ERROR_DB_TRANSACTION_FAIL 	=>'启动事务错误!',
		MP_ERROR_DB_COMMIT_FAIL				=>'提交事务错误!',
		MP_ERROR_TTC_SELECT_NULL				=>'TTC查找数据为空!',
		MP_ERROR_TTC_SELECT_FAIL				=>'TTC查找失败!',
		MP_ERROR_TTC_UNIQUESELECT_FAIL	=>'TTC查找结果不唯一!',
		MP_ERROR_TTC_INSERT_FAIL				=>'TTC插入失败!',
		MP_ERROR_TTC_INSERT_EXIST				=>'TTC插入数据已存在!',
		MP_ERROR_TTC_UPDATE_FAIL				=>'TTC更新失败!',
		MP_ERROR_TTC_DEL_NULL					=>'TTC删除数据为空!',
		MP_ERROR_TTC_DEL_FAIL					=>'TTC删除数据失败!',
		MP_ERROR_PARAM_MISS					=>'参数错误',
		MP_ERROR_ALL_BITNUM_INVALID		=>'价格字段全部使用中',
		MP_ERROR_GET_PRICES_FAIL				=>'未能找到对应价格',
		MP_ERROR_OTHERS								=>'其他错误',
	);

	/**
	 * 设置错误标识
	 */
	private function setERR($line, $code, $msg='')
	{
		self::clearERR();

		self::$errCode = $code;

		$_append = isset(self::$errArray[$code]) ? self::$errArray[$code] : $code;
		$_append .= ( empty($msg) ? '' : "|{$msg}" );
		self::$errMsg = basename(__FILE__, '.php')  . "{$line} | {$_append}";

		if (!empty(self::$errMsg)) {
			Logger::err(self::$errMsg);
		}
	}

	/**
	 * 清除错误标识，在每个函数调用前调用 this->clearERR();
	 */
	private function clearERR()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}

	/**
	 * 创建价格
	 * @param array data 要插入的价格数据
	 * 	格式:
	 * 	array(
	 * 		'product_id'		=>  XXX,
	 * 		'wh_id' 			=>  XXX,
	 * 		'price' 			=>  XXX,
	 * 		'valid_time_from' 	=>	XXX,
	 * 		'valid_time_to' 	=>  XXX,
	 * 		'status' 			=>	XXX,
	 * 		'price_desc' 		=> 	'XXX',
	 * 		'create_user' 		=> 	'XXX',
	 * 		'create_time' 		=> 	XXX,
	 * 		'audit_user' 		=> 	'XXX',
	 * 		'audit_time'		=> 	XXX,
	 * 		'verify_type' 		=>	XXX,
	 *		''
	 *      )
	 * 返回值：正确true，错误返回false
	 */
	public static function addPrice($data)
	{
		global $_Wh_id; //获得可用的价格字段,如果设置了价格字段，就检测一下当前价格是否可以用，如未设置价格或设置的是自定义价格，则从后向前分配price_id

		if (isset($data['price_id']))
		{
			$ret = self::getSpecifyPrice($data['product_id'], $data['price_id'], $data['wh_id']);
			if (count($ret) != 0 && $ret != false)
			{ //存在价格，看是否已经作废,已经作废，将旧价格放入流水表
				if ($ret['status'] == MP_STATUS_INVALID)
				{
					self::addToPriceFlow($ret);
					self::delPrice($data['product_id'], $data['price_id'], $data['wh_id']);
				}
				else
				{
					self::setERR(__LINE__, MP_ERROR_DB_INSERT_EXIST);
					return false;
				}
			}
		}
		else
		{ //程序分配price_id
			$ret = self::getValidPriceId($data['product_id'], $data['wh_id']);
			if ($ret == false)
			{
				self::setERR(__LINE__, MP_ERROR_OTHERS, '分配价格id错误!');
				return false;
			}

			//存入数据字段待插入
			$data['price_id'] = $ret;
		}

		//如果价格已存在且是作废状态，则先删除后插入
		$oldPrice = self::getSpecifyPrice($data['product_id'], $data['price_id'], $data['wh_id']);
		if ($oldPrice != false && $oldPrice['status'] == MP_STATUS_INVALID)
		{
			self::delPrice($data['product_id'], $data['price_id'], $data['wh_id']);
		}

		//如果分配的价格id在64位之上，则不同步到商品表中
		if (intval($data['price_id']) <= MP_ALL_BIGINT_NUM)
		{
			//把价格字段转换成二进制位
			$multiprice_type = self::price_idToBinary(intval($data['price_id']));
			//获取商品表字段
			$product_InfoType = self::getProductBigInt($data['product_id'], $data['wh_id']);
			if ($product_InfoType == false )
			{
				self::setERR(__LINE__, MP_ERROR_TTC_SELECT_FAIL, IProductInfoTTC::$errCode . '_' . IProductInfoTTC::$errMsg);
				return false;
			}
			//做位或操作
			$product_InfoType['multiprice_type'] = $product_InfoType['multiprice_type'] | $multiprice_type;

			//插入多价表
			$ret = IMultiPriceTTC::insert($data);
			if ($ret == false)
			{
				self::setERR(__LINE__, MP_ERROR_TTC_INSERT_FAIL, IMultiPriceTTC::$errCode . '_' . IMultiPriceTTC::$errMsg);
				return false;
			}

			//更新商品表多价字段
			$productInfoData = array(
												'product_id' 		=> $product_InfoType['product_id'],
												'wh_id' 			=> $product_InfoType['wh_id'],
												'multiprice_type' 	=> $product_InfoType['multiprice_type'],
											);
			$ret = IProductInfoTTC::update($productInfoData,array('wh_id' => $data['wh_id']));
			if ($ret == false )
			{
				//插入错误删除之前的字段?
				self::setERR(__LINE__, MP_ERROR_TTC_INSERT_FAIL, IProductInfoTTC::$errCode . '_' . IProductInfoTTC::$errMsg);
				return false;
			}
		}
		else
		{
			//插入多价表
			$ret = IMultiPriceTTC::insert($data);
			if ($ret == false)
			{
				self::setERR(__LINE__, MP_ERROR_TTC_INSERT_FAIL, IMultiPriceTTC::$errCode . '_' . IMultiPriceTTC::$errMsg);
				return false;
			}
		}
		return true;
	}

	/**
	 * 删除价格
	 * @param int product_id 要删除的商品编号
	 * @param string price_id 	要删除的价格编号
	 * @param int wh_id 		要删除的分仓编号
	 *
	 * 返回值：正确true，错误返回false
	 */
	public static function delPrice($product_id, $price_id, $wh_id)
	{
		global $_Wh_id;

		//查询是否存在待删除数据
		$multiPriceInfo = self::getSpecifyPrice($product_id, $price_id, $wh_id);
		if ($multiPriceInfo == false)
		{
			self::setERR(__LINE__, MP_ERROR_TTC_SELECT_FAIL, IMultiPriceTTC::$errCode . '_' . IMultiPriceTTC::$errMsg);
			return false;
		}
		if (count($multiPriceInfo) == 0)
		{
			self::setERR(__LINE__, MP_ERROR_TTC_DEL_NULL, IMultiPriceTTC::$errCode . '_' . IMultiPriceTTC::$errMsg);
			return false;
		}

		$multiprice_type = self::price_idToBinary($multiPriceInfo['price_id']);

		//删除多价格表数据
		$ret = IMultiPriceTTC::remove($product_id, array('price_id' => $price_id,'wh_id' => $wh_id));
		if ($ret == false)
		{
			self::setERR(__LINE__, MP_ERROR_TTC_INSERT_FAIL, IMultiPriceTTC::$errCode . '_' . IMultiPriceTTC::$errMsg);
			return false;
		}
		//如果分配的价格id在64位之上，则不同步到商品表中
		if ($price_id <= MP_ALL_BIGINT_NUM)
		{
			//取商品表多价位字段,清空对应位
			$product_InfoType = self::getProductBigInt($product_id, $wh_id);
			$product_InfoType['multiprice_type']  = $product_InfoType['multiprice_type'] & ~($multiprice_type);

			//更新商品表多价字段
			$ret = self::updateProductBigInt($product_id, $product_InfoType['multiprice_type'], $wh_id);
			if ($ret == false)
			{
				self::setERR(__LINE__, MP_ERROR_DB_UPDATE_FAIL, IMultiPriceTTC::$errCode . '_' . IMultiPriceTTC::$errMsg);
				return false;
			}
		}
		return true;
	}

	/**
	 * 获得单个商品指定价格信息
	 * @param string ProductSysNo 	商品编号
	 * @param string Price_id 		价格编号
	 * @param int wh_id 			分仓号
	 *
	 * 返回值：正确返回数据，错误返回false
	 * 	格式:
	 * 	array(
	 * 		'product_id'		=>  XXX,
	 * 		'price_id'			=>  XXX,
	 * 		'wh_id' 			=>  XXX,
	 * 		'price' 			=>  XXX,
	 * 		'valid_time_from' 	=>	XXX,
	 * 		'valid_time_to' 	=>  XXX,
	 * 		'status' 			=>	XXX,
	 * 		'price_desc' 		=> 	'XXX',
	 * 		'create_user' 		=> 	'XXX',
	 * 		'create_time' 		=> 	XXX,
	 * 		'audit_user' 		=> 	'XXX',
	 * 		'audit_time'		=> 	XXX,
	 * 		'verify_type' 		=>	XXX
	 *      )
	 */
	public static function getSpecifyPrice($ProductSysNo, $Price_id, $wh_id = 1)
	{
		$ret = IMultiPriceTTC::get($ProductSysNo, array('price_id' => $Price_id, 'wh_id' => $wh_id));

		if ($ret == false)
		{
			self::setERR(__LINE__, MP_ERROR_TTC_SELECT_FAIL, IMultiPriceTTC::$errCode . '_' . IMultiPriceTTC::$errMsg);
			return false;
		}
		return $ret[0];
	}

	/**
	 * 获得单个商品非作废的指定价格信息
	 * @param string ProductSysNo 	商品编号
	 * @param string Price_id 		价格编号
	 * @param int wh_id 			分仓号
	 *
	 * 返回值：正确返回数据，错误返回false
	 * 	格式:
	 * 	array(
	 * 		'product_id'		=>  XXX,
	 * 		'price_id'			=>  XXX,
	 * 		'wh_id' 			=>  XXX,
	 * 		'price' 			=>  XXX,
	 * 		'valid_time_from' 	=>	XXX,
	 * 		'valid_time_to' 	=>  XXX,
	 * 		'status' 			=>	XXX,
	 * 		'price_desc' 		=> 	'XXX',
	 * 		'create_user' 		=> 	'XXX',
	 * 		'create_time' 		=> 	XXX,
	 * 		'audit_user' 		=> 	'XXX',
	 * 		'audit_time'		=> 	XXX,
	 * 		'verify_type' 		=>	XXX
	 *      )
	 */
	public static function getSpecifyValidPrice($ProductSysNo, $Price_id, $wh_id = 1)
	{
		$ret = IMultiPriceTTC::get($ProductSysNo,array('price_id' => $Price_id,'wh_id' =>  $wh_id));
		if ($ret == false)
		{
			self::setERR(__LINE__, MP_ERROR_TTC_SELECT_FAIL, IMultiPriceTTC::$errCode . '_' . IMultiPriceTTC::$errMsg);
			return false;
		}

		if ($ret[0]['status'] == MP_STATUS_INVALID)
		{
			return false;
		}
		return $ret[0];
	}

	/**
	 * 获得单个商品有效状态的指定价格信息
	 * @param string product_id 	商品编号
	 * @param string Price_id 		价格编号
	 * @param int wh_id 			分仓号
	 * @param string nowTime 		当前时间
	 *
	 * 返回值：正确返回数据，错误返回false
	 * 	格式:
	 * 	array(
	 * 		'product_id'		=>  XXX,
	 * 		'price_id'			=>  XXX,
	 * 		'wh_id' 			=>  XXX,
	 * 		'price' 			=>  XXX,
	 * 		'price_name' 		=> 	XXX,
	 * 		'count_type' 		=> 	XXX,
	 * 		'valid_time_from' 	=>	XXX,
	 * 		'valid_time_to' 	=>  XXX
	 *      )
	 */
	public static function getPrice($product_id, $price_id, $nowTime, $wh_id = 1)
	{
		$price = self::getPriceOnly($product_id, $price_id, $wh_id);
		if ($price == false || self::checkTime($nowTime, $price) == false)
		{
			return false;
		}

		return $price;
	}

	/**
	 * 检查是否在有效期内
	 * @param string nowTime 		当前时间
	 * @param array  pirce 			价格信息
	 * @param int    wh_id 			分仓号
	 *
	 * 返回值：有效期内返回true，否则返回false
	 */
	public static function checkTime($nowTime, $pirce)
	{
		//未生效
		if ($nowTime < $pirce['valid_time_from'])
		{
			return false;
		}

		//已过期，自动作废
		if ($nowTime > $pirce['valid_time_to'])
		{
			self::invalidatePrice($pirce['product_id'], $pirce['price_id'], $pirce['wh_id']);
			return false;
		}
		return true;
	}

	/**
	 * 获得单个商品有效状态的指定价格信息
	 * @param string product_id 	商品编号
	 * @param string Price_id 		价格编号
	 * @param int wh_id 			分仓号
	 *
	 * 返回值：正确返回数据，错误返回false
	 * 	格式:
	 * 	array(
	 * 		'product_id'		=>  XXX,
	 * 		'price_id'			=>  XXX,
	 * 		'wh_id' 			=>  XXX,
	 * 		'price' 			=>  XXX,
	 * 		'price_name' 		=> 	XXX,
	 * 		'count_type' 		=> 	XXX,
	 * 		'valid_time_from' 	=>	XXX,
	 * 		'valid_time_to' 	=>  XXX
	 *      )
	 */
	public static function getPriceOnly($product_id, $price_id, $wh_id = 1)
	{
		$ret = IMultiPriceTTC::get($product_id, array('price_id' => $price_id, 'wh_id' =>  $wh_id));

		if ($ret == false)
		{
			self::setERR(__LINE__, MP_ERROR_TTC_SELECT_FAIL, IMultiPriceTTC::$errCode . '_' . IMultiPriceTTC::$errMsg);
			return false;
		}
		if ($ret[0]['status'] != MP_STATUS_VALID)
		{
			return false;
		}

		return array(
			'product_id'			=> $ret[0]['product_id'],
			'price_id'				=> $ret[0]['price_id'],
			'wh_id' 					=> $ret[0]['wh_id'],
			'price' 					=> $ret[0]['price'],
			'price_name' 		=> $ret[0]['price_name'],
			'count_type'			=> $ret[0]['count_type'],
			'valid_time_from'	=> $ret[0]['valid_time_from'],
			'valid_time_to'		=> $ret[0]['valid_time_to'],
		);
	}

	/**
	 * 按条件查询单个商品所有多价格信息
	 * @param string product_id 	商品编号
	 *
	 * @param array	 filter 		条件字段
	 * 	格式:
	 * 	array(
	 * 			'condtion1'			=>  XXX,
	 * 			'condtion2'			=>  XXX,
	 * 			'condtion3'			=>  XXX
	 *      )
	 * 返回值：正确返回数据，错误返回false
	 * 	格式:
	 * 	array(
	 *		'0' => array(
	 * 						'product_id' =>  	XXX,
	 * 						'price_id' =>  		XXX,
	 * 						'wh_id' =>  		XXX,
	 * 						'price' =>  		XXX,
	 * 						'valid_time_from' =>XXX,
	 * 						'valid_time_to' =>  XXX,
	 * 						'status' =>  		XXX,
	 * 						'price_desc' => 	'XXX',
	 * 						'create_user' => 	'XXX',
	 * 						'create_time' =>  	XXX,
	 * 						'audit_user' => 	'XXX',
	 *				 		'audit_time' =>  	XXX,
	 *				 		'verify_type' =>	XXX,
	 *   				   ),
	 *		'1' => array(
	 * 						'product_id' =>  	XXX,
	 * 						'price_id' =>  		XXX,
	 * 						'wh_id' =>  		XXX,
	 * 						'price' =>  		XXX,
	 * 						'valid_time_from' =>XXX,
	 * 						'valid_time_to' =>  XXX,
	 * 						'status' =>  		XXX,
	 * 						'price_desc' => 	'XXX',
	 * 						'create_user' => 	'XXX',
	 * 						'create_time' =>  	XXX,
	 * 						'audit_user' => 	'XXX',
	 *				 		'audit_time' =>  	XXX,
	 *				 		'verify_type' =>XXX,
	 *   				   )
	 *		);
	 */
	public static function getPrices($product_id, $filter = array())
	{
		$ret = IMultiPriceTTC::get($product_id, $filter);

		if ($ret == false)
		{
			self::setERR(__LINE__, MP_ERROR_TTC_SELECT_FAIL, IMultiPriceTTC::$errCode . '_' . IMultiPriceTTC::$errMsg);
			return false;
		}
		return $ret;
	}

	/**
	 * 按条件查询单个商品所有可用多价格信息
	 * @param string ProductSysNo 	商品编号
	 *
	 * @param array	 filter 		条件字段
	 * 	格式:
	 * 	array(
	 * 			'condtion1'			=>  XXX,
	 * 			'condtion2'			=>  XXX,
	 * 			'condtion3'			=>  XXX
	 *      )
	 * 返回值：正确返回数据，错误返回false
	 * 	格式:
	 * 	array(
	 *		'0' => array(
	 * 						'product_id' =>  	XXX,
	 * 						'price_id' =>  		XXX,
	 * 						'wh_id' =>  		XXX,
	 * 						'price' =>  		XXX,
	 * 						'valid_time_from' =>XXX,
	 * 						'valid_time_to' =>  XXX,
	 * 						'status' =>  		XXX,
	 * 						'price_desc' => 	'XXX',
	 * 						'create_user' => 	'XXX',
	 * 						'create_time' =>  	XXX,
	 * 						'audit_user' => 	'XXX',
	 *				 		'audit_time' =>  	XXX,
	 *				 		'verify_type' =>XXX,
	 *   				   ),
	 *		'1' => array(
	 * 						'product_id' =>  	XXX,
	 * 						'price_id' =>  		XXX,
	 * 						'wh_id' =>  		XXX,
	 * 						'price' =>  		XXX,
	 * 						'valid_time_from' =>XXX,
	 * 						'valid_time_to' =>  XXX,
	 * 						'status' =>  		XXX,
	 * 						'price_desc' => 	'XXX',
	 * 						'create_user' => 	'XXX',
	 * 						'create_time' =>  	XXX,
	 * 						'audit_user' => 	'XXX',
	 *				 		'audit_time' =>  	XXX,
	 *				 		'verify_type' =>XXX,
	 *   				   )
	 *		);
	 */
	public static function getValidPrices($ProductSysNo, $filter = array())
	{
		$Prices = IMultiPriceTTC::get($ProductSysNo, $filter);
		$nowTime = time();
		foreach ($Prices  as $k =>$p)
		{
			if (($p['valid_time_from'] != '') && ($p['valid_time_to']!=''))
			{
				if (($nowTime < $p['valid_time_from'] || $nowTime > $p['valid_time_to']))
				{
					unset($Prices[$k]);
					continue;
				}
			}
			if ($p['status'] == MP_STATUS_INVALID)
			{
				unset($Prices[$k]);
				continue;
			}
		}

		if ($Prices == false || empty($Prices) || count($Prices) == 0)
		{
			self::setERR(__LINE__, MP_ERROR_TTC_SELECT_FAIL, IMultiPriceTTC::$errCode . '_' . IMultiPriceTTC::$errMsg);
			return false;
		}
		return $Prices;
	}


	/**
	 * 按条件查询多个商品的价格信息
	 * @param array productList 	商品编号列表
	 * @param array fliter	 		过滤条件
	 *
	 * 返回值：正确返回数据，错误返回false
	 * 	格式:
	 * 	array(
	 *		product_id => array(
	 *							price_id =>	array(
	 * 												'product_id' =>  	XXX,
	 * 												'price_id' =>  		XXX,
	 * 												'wh_id' =>  		XXX,
	 * 												'price' =>  		XXX,
	 * 												'valid_time_from' =>XXX,
	 * 												'valid_time_to' =>  XXX,
	 * 												'status' =>  		XXX,
	 * 												'price_desc' => 	'XXX',
	 * 												'create_user' => 	'XXX',
	 * 												'create_time' =>  	XXX,
	 * 												'audit_user' => 	'XXX',
	 *				 								'audit_time' =>  	XXX,
	 *				 								'verify_type' =>XXX,
	 *   				  						 ),
	 *							price_id =>	array(
	 * 												'product_id' =>  	XXX,
	 * 												'price_id' =>  		XXX,
	 * 												'wh_id' =>  		XXX,
	 * 												'price' =>  		XXX,
	 * 												'valid_time_from' =>XXX,
	 * 												'valid_time_to' =>  XXX,
	 * 												'status' =>  		XXX,
	 * 												'price_desc' => 	'XXX',
	 * 												'create_user' => 	'XXX',
	 * 												'create_time' =>  	XXX,
	 * 												'audit_user' => 	'XXX',
	 *				 								'audit_time' =>  	XXX,
	 *				 								'verify_type' =>XXX,
	 *   				  						 ),
	 *   				  		)
	 *		);
	 */
	public static function getMultiPrices($productList, $fliter, $nowTime = -1)
	{
		$ret = IMultiPriceTTC::gets($productList, $fliter);
		if ($ret === false) {
			self::setERR(__LINE__, MP_ERROR_TTC_SELECT_FAIL, IMultiPriceTTC::$errCode . '_' . IMultiPriceTTC::$errMsg);
			return false;
		}

		$price_list = array();
		foreach($ret as $k => $v) {
			if ($nowTime > 0 && $ret[$k]['valid_time_from'] < $nowTime && $ret[$k]['valid_time_to'] > $nowTime) {
				continue;
			}
			if (!isset($price_list[$v['product_id']])) {
				$price_list[$v['product_id']] = array();
			}
			$price_list[$v['product_id']][$v['price_id']] = $v;
		}

		if (count($price_list) == 0) {
			return false;
		}

		return $price_list;
	}

	/**
	 * 按条件查询多个商品多价格
	 * @param array productList 	商品编号价格编号列表
	 * 			array（
	 *					product_id => price_id,
	 *					product_id => price_id,
	 *					product_id => price_id,
	 *					product_id => price_id,
	 *					product_id => price_id
	 *				)
	 *
	 * @param array fliter	 		过滤条件
	 *			array (
	 *					价格状态、分站等等)
	 *
	 * 返回值：正确返回数据，错误返回false
	 * 	格式:
	 * 	array(
	 *		product_id => array(
	 * 												'product_id' =>  	XXX,
	 * 												'price_id' =>  		XXX,
	 * 												'wh_id' =>  		XXX,
	 * 												'price' =>  		XXX,
	 * 												'valid_time_from' =>XXX,
	 * 												'valid_time_to' =>  XXX,
	 * 												'status' =>  		XXX,
	 * 												'price_desc' => 	'XXX',
	 * 												'create_user' => 	'XXX',
	 * 												'create_time' =>  	XXX,
	 * 												'audit_user' => 	'XXX',
	 *				 								'audit_time' =>  	XXX,
	 *				 								'verify_type' =>XXX,
	 *   				  		)，
	 *		product_id => array(
	 * 												'product_id' =>  	XXX,
	 * 												'price_id' =>  		XXX,
	 * 												'wh_id' =>  		XXX,
	 * 												'price' =>  		XXX,
	 * 												'valid_time_from' =>XXX,
	 * 												'valid_time_to' =>  XXX,
	 * 												'status' =>  		XXX,
	 * 												'price_desc' => 	'XXX',
	 * 												'create_user' => 	'XXX',
	 * 												'create_time' =>  	XXX,
	 * 												'audit_user' => 	'XXX',
	 *				 								'audit_time' =>  	XXX,
	 *				 								'verify_type' =>XXX,
	 *   				  		)，
	 *		);
	 */
	public static function getMultiPricesByPid($productList, $fliter)
	{
		$allPrices = self::getMultiPrices($productList, $fliter);
		if (false === $allPrices && count($allPrices) == 0)
		{
			return false;
		}
		else
		{
			$retPrices = array();
			foreach($productList as $k => $v)
			{
				if (isset($allPrices[$k][$v]))
				{
					$retPrices[$k] = $allPrices[$k][$v];
				}
			}
			return $retPrices;
		}
	}
	/**
	 * 按条件查询多个商品相同价格
	 * @param array productList 	商品编号价格编号列表
	 * 			array（
	 *					product_id ,
	 *					product_id ,
	 *					product_id ,
	 *					product_id ,
	 *					product_id
	 *				)
	 *
	 * @param array fliter	 		过滤条件
	 *			array (
	 *					价格id,价格状态、分站等等)
	 *
	 * 返回值：正确返回数据，错误返回false
	 * 	格式:
	 * 	array(
	 *		product_id => array(
	 * 												'product_id' =>  	XXX,
	 * 												'price_id' =>  		XXX,
	 * 												'wh_id' =>  		XXX,
	 * 												'price' =>  		XXX,
	 * 												'valid_time_from' =>XXX,
	 * 												'valid_time_to' =>  XXX,
	 * 												'status' =>  		XXX,
	 * 												'price_desc' => 	'XXX',
	 * 												'create_user' => 	'XXX',
	 * 												'create_time' =>  	XXX,
	 * 												'audit_user' => 	'XXX',
	 *				 								'audit_time' =>  	XXX,
	 *				 								'verify_type' =>XXX,
	 *   				  		)，
	 *		product_id => array(
	 * 												'product_id' =>  	XXX,
	 * 												'price_id' =>  		XXX,
	 * 												'wh_id' =>  		XXX,
	 * 												'price' =>  		XXX,
	 * 												'valid_time_from' =>XXX,
	 * 												'valid_time_to' =>  XXX,
	 * 												'status' =>  		XXX,
	 * 												'price_desc' => 	'XXX',
	 * 												'create_user' => 	'XXX',
	 * 												'create_time' =>  	XXX,
	 * 												'audit_user' => 	'XXX',
	 *				 								'audit_time' =>  	XXX,
	 *				 								'verify_type' =>XXX,
	 *   				  		)，
	 *		);
	 */
	public static function getMultiPricesByProduct($productList, $fliter)
	{
		$allPrices = self::getMultiPrices($productList, $fliter);
		if (false === $allPrices && count($allPrices) == 0)
		{
			return false;
		}
		else
		{
			return $allPrices;
		}
	}
	/**
	 * 更新价格信息
	 * @param array Price_data 要更新的价格数据
	 * 	格式:
	 * 	array(
	 * 		'product_id'		=>  XXX,	必选
	 * 		'price_id'			=>  XXX,	必选
	 * 		'wh_id' 			=>  XXX,	必选
	 * 		'price' 			=>  XXX,
	 * 		'valid_time_from' 	=>	XXX,
	 * 		'valid_time_to' 	=>  XXX,
	 * 		'status' 			=>	XXX,
	 * 		'price_desc' 		=> 	'XXX',
	 * 		'create_user' 		=> 	'XXX',
	 * 		'create_time' 		=> 	XXX,
	 * 		'audit_user' 		=> 	'XXX',
	 * 		'audit_time'		=> 	XXX,
	 * 		'verify_type' 		=>	XXX
	 *      )
	 * 返回值：正确true，错误返回false
	 */
	public static function updatePrice($data)
	{
		$filter = array(
			'price_id' 	=>  $data['price_id'],
			'wh_id' 	=>  $data['wh_id'],
		);

		$ret = IMultiPriceTTC::update($data, $filter);
		if ($ret == false)
		{
			self::setERR(__LINE__, MP_ERROR_TTC_UPDATE_FAIL, IMultiPriceTTC::$errCode . '_' . IMultiPriceTTC::$errMsg);
			return false;
		}

		if (intval($data['price_id']) <= MP_ALL_BIGINT_NUM)
		{
			//把价格字段转换成二进制位
			$multiprice_type = self::price_idToBinary(intval($data['price_id']));

			//获取商品表字段
			$product_InfoType = self::getProductBigInt($data['product_id'], $data['wh_id']);
			if ($product_InfoType == false )
			{
				self::setERR(__LINE__, MP_ERROR_TTC_SELECT_FAIL, IProductInfoTTC::$errCode . '_' . IProductInfoTTC::$errMsg);
				return false;
			}

			//如果是激活就同步标识位到价格表
			if ($data['status'] == MP_STATUS_VALID)
			{
				$product_InfoType['multiprice_type'] = $product_InfoType['multiprice_type'] | $multiprice_type;
			}
			else if ($data['status'] == MP_STATUS_INVALID)
			{ //如果是作废，就删除标识位到价格表
				$product_InfoType['multiprice_type']  = $product_InfoType['multiprice_type'] & ~($multiprice_type);
			}
			if ($data['status'] == MP_STATUS_VALID || $data['status'] == MP_STATUS_INVALID)
			{
				//更新商品表多价字段
				$productInfoData = array(
													'product_id' 			=> $product_InfoType['product_id'],
													'wh_id' 					=> $product_InfoType['wh_id'],
													'multiprice_type' 	=> $product_InfoType['multiprice_type'],
												);
				$ret = IProductInfoTTC::update($productInfoData,array('wh_id' => $data['wh_id']));
				if ($ret == false )
				{
					self::setERR(__LINE__, MP_ERROR_TTC_INSERT_FAIL, IProductInfoTTC::$errCode . '_' . IProductInfoTTC::$errMsg);
					return false;
				}
			}
		}

		// 当审核通过时记录流水
		if (isset($data['status']) && (MP_STATUS_VALID == $data['status'])) {
			self::insertToRecord($data);
		}

		return true;
	}

	/**
	 * 清除商品表价格字段
	 * @param int product_id 			商品编号
	 * @param bigint price_id		 	待更新的价格字段
	 * @param int wh_id 				分仓号
	 *
	 * 返回值：正确返回true，错误返回false
	 */

	function clearProductBigInt($product_id, $price_id, $wh_id)
	{
		$product_InfoType = self::getProductBigInt($product_id, $wh_id);
		$product_InfoType['multiprice_type']  = $product_InfoType['multiprice_type'] & ~($price_id);

		//更新商品表多价字段
		$ret = self::updateProductBigInt($product_id, $product_InfoType['multiprice_type'], $wh_id);
		if ($ret == false)
		{
			self::setERR(__LINE__, MP_ERROR_TTC_UPDATE_FAIL, IMultiPriceTTC::$errCode . '_' . IMultiPriceTTC::$errMsg);
			return false;
		}
		return true;
	}

	/**
	 * 更新商品表价格字段
	 * @param int product_id 			商品编号
	 * @param bigint multiprice_type 	待更新的多价字段
	 * @param int wh_id 				分仓号
	 *
	 * 返回值：正确返回true，错误返回false
	 */
	public static function updateProductBigInt($product_id, $multiprice_type, $wh_id = 1)
	{
		$productData = array(
									'product_id'			=>	$product_id,
									'multiprice_type'	=>	$multiprice_type,
									'wh_id'					=>	$wh_id,
								);
		$ret = IProductInfoTTC::update($productData,array('wh_id' => $productData['wh_id']));
		if ($ret == false )
		{
			self::setERR(__LINE__, MP_ERROR_TTC_UPDATE_FAIL, IProductInfoTTC::$errCode . '_' . IProductInfoTTC::$errMsg);
			return false;
		}

		return true;
	}

	/**
	 * 获得商品表价格字段信息
	 *
	 * @param int product_id 			商品编号
	 * @param int wh_id 				分仓号
	 *
	 * 返回值：正确返回商品价格数据，错误返回false
	 *
	 * 数据格式:
	 * 	array(
	 * 		'product_id' =>  XXX,
	 * 		'wh_id' =>  XXX,
	 * 		'multiprice_type' =>  XXX,
	 * 		)
	 */
	public static function getProductBigInt($Product_id, $wh_id = 1)
	{
		$ret = IProductInfoTTC::gets(array('product_id' => $Product_id), array('wh_id' => $wh_id), array('wh_id', 'multiprice_type'));
		if ($ret == false || count($ret) != 1)
		{
			self::setERR(__LINE__, MP_ERROR_TTC_SELECT_NULL, IProductInfoTTC::$errCode . '_' . IProductInfoTTC::$errMsg);
			return false;
		}
		return  array(
						'product_id' 			=> $ret[0]['product_id'],
						'wh_id' 					=> $ret[0]['wh_id'],
						'multiprice_type' 	=> $ret[0]['multiprice_type'],
					);
	}

	/**
	 * 自定义价格字段获得当前可用的price_id
	 */
	public static function getValidPriceId($Product_id, $wh_id = 1)
	{
		global $_Wh_id;
		$i = 0;
		$invalidPriceId = -1;
		//从高到低取最大的可用值,如果全部占用，则去取作废字段，如果作废字段也全部占用，则取63以上字段，但这是不同步到product表中
		//这里效率可以考虑先取出全部，然后再做分析     $prices = self::getPrices($product_id, $wh_id);
		for($i = MP_ALL_BIGINT_NUM; $i>MP_MAX_FIX_PRICE; --$i)
		{
			$ret = self::getSpecifyPrice($Product_id, $i, $wh_id);
			if ($ret == false)
			{
				return $i;
			}
			else if ($ret['status'] == MP_STATUS_INVALID)
			{//存储作废规则id
				if ($invalidPriceId == -1)
				{
					$invalidPriceId = $i;
				}
			}
		}

		if ($invalidPriceId == -1)
		{//取63以上未占用字段
			$priceIndex = MP_ALL_BIGINT_NUM + 1;
			do
			{
				$ret = self::getSpecifyPrice($Product_id, $priceIndex, $wh_id);
				if ($ret == false)
				{
					return $priceIndex;
				}
				++$priceIndex;
			}while($ret != false);
		}
		else
		{
			return $invalidPriceId;
		}

		self::setERR(__LINE__, MP_ERROR_ALL_BITNUM_INVALID);
		return false;
	}

	/**
	 * 作废价格
	 * 更新商品表价格字段
	 * @param string ProductSysNo 			商品编号
	 * @param string multiprice_type 		待更新的多价字段
	 * @param int wh_id 					分仓号
	 *
	 * 返回值：正确返回true，错误返回false
	 */
	public static function invalidatePrice($ProductSysNo, $Price_id, $wh_id = 1)
	{
		$productData = array(
									'product_id' 	=> $ProductSysNo,
									'price_id' 		=> $Price_id,
									'wh_id'			=> $wh_id,
									'status' 			=> MP_STATUS_INVALID,
								);
		$ret = self::updatePrice($productData);
		if ($ret == false )
		{
			self::setERR(__LINE__, MP_ERROR_TTC_UPDATE_FAIL, IMultiPriceTTC::$errCode . '_' . IMultiPriceTTC::$errMsg);
			return false;
		}

		return true;
	}

	/**
	 * 激活价格
	 * 更新商品表价格字段
	 * @param string ProductSysNo 			商品编号
	 * @param string multiprice_type 		待更新的多价字段
	 * @param int wh_id 					分仓号
	 *
	 * 返回值：正确返回true，错误返回false
	 */
	public static function activePrice($ProductSysNo, $Price_id, $wh_id = 1)
	{
		$productData = array(
									'product_id' 	=> $ProductSysNo,
									'price_id' 		=> $Price_id,
									'wh_id' 			=> $wh_id,
									'status' 			=> MP_STATUS_VALID,
								);

		$ret = self::updatePrice($productData);
		if ($ret == false )
		{
			self::setERR(__LINE__, MP_ERROR_TTC_UPDATE_FAIL, IMultiPriceTTC::$errCode . '_' . IMultiPriceTTC::$errMsg);
			return false;
		}
		return true;
	}

	/**
	 * 把price_id号转换成对应的二进制码
	 * 更新商品表价格字段
	 * @param string price_id	 			价格编号
	 *
	 * 返回值：返回二进制字符串对应的十进制数
	 */
	public static function price_idToBinary($price_id)
	{
		return 1 << $price_id;
	}

	/**
	 * 根据传入的经销商等级拉需要的经销商价格id,写入多价格数组
	 * @param string level	 价格id
	 *
	 * 返回值：返回价格id数组
	 */
	public static function _TraderPriceId($level,&$priceArray)
	{
		global $_TRADER_Type;
		if ($level > 0)
		{
			foreach($_TRADER_Type as $k => $v)
			{
				$priceArray[$k] = $k;
				$level--;
				if ($level <= 0)
				{
					break;
				}
			}
		}
	}

	/**
	 * 显示List页展示价
	 * @param array data
	 * 格式：
	 * array(
	 *			'product_id'=> XXX,
	 *			'wh_id'		=> XXX,
	 *			'uid' 		=> XXX,
	 *			'level' 	=> XXX,
	 * 			'price_id'	=> XXX,
	 *			'IsTrader'	=> XXX, 如果有则传入经销商价格
	 *			'multiPriceType' => XXX
	 *		)
	 *
	 * 返回值：正确返回数据，错误返回false
	 * 	格式:
	 *	Array｛
	 *			'product_id' 	=> XXX,
	 * 			'wh_id' 		=> XXX,
	 *			'hasVip' 		=> XXX,
	 *			'Prices' => array(
	 *								'0' => array(
	 * 												'price_id' 	=> XXX,
	 * 												'price' 	=> XXX,
	 *												'price_name'=> XXX,
	 *				 								'count_type' => XXX,
	 *				 								'isSatisfy' => XXX
	 *   				  						 ),
	 *								'1' => array(
	 * 												'price_id' 	=> XXX,
	 * 												'price' 	=> XXX,
	 *												'price_name'=> XXX,
	 *				 								'count_type' => XXX,
	 *				 								'isSatisfy' => XXX
	 *   				  						 ),
	 *   				  		  ),
	 *   	  )
	 */
	public static function getListPrices($data) {
		if (!isset($data['uid']) || $data['uid'] <= 0) { //如果没有uid则传出所有存在的固定价
			$prices = self::getNoUidListPrice($data);
			if (false === $prices) {
				self::setERR(__LINE__, MP_ERROR_GET_PRICES_FAIL, IMultiPriceTTC::$errCode . '_' . IMultiPriceTTC::$errMsg);
				return false;
			}
		}
		else { //如果有uid则传出对应符合的价格
			$prices = self::getUidListPrice($data);
			if (false === $prices) {
				self::setERR(__LINE__, MP_ERROR_GET_PRICES_FAIL, IMultiPriceTTC::$errCode . '_' . IMultiPriceTTC::$errMsg);
				return false;
			}
		}
		return array(
						'product_id' 	=> $data['product_id'],
						'wh_id' 			=> $data['wh_id'],
						'hasVip' 		=> $prices['hasVip'],
						'Prices' 			=> $prices['Prices'],
					);
	}

	/**
	 * 查询无uid状态下默认list所有有效的展示价格
	 * @param array data
	 * 格式：
	 * array(
	 *			'product_id'=> XXX,
	 *			'wh_id'		=> XXX,
	 *			'uid' 		=> XXX,
	 *			'level' 	=> XXX,
	 *			'multiPriceType' => XXX
	 *		)
	 *
	 *	传入 商品id 分站id 用户id(如果有则查询vip价是否满足，没有则vip价全不满足) big位 用户等级(如果有则传入) 需要传出的价格
	 * 返回值：正确返回数据，错误返回false
	 * 	格式:  array(
	 *								price_id => array(
	 * 												'price_id' 	=> XXX,
	 * 												'price' 	=> XXX,
	 *												'price_name'=> XXX,
	 *												'valid_time_to'=> XXX,
	 *												'count_type'=> XXX,
	 *				 								'isSatisfy' => XXX,
	 *   				  						 ),
	 *								price_id => array(
	 * 												'price_id' 	=> XXX,
	 * 												'price' 	=> XXX,
	 *												'price_name'=> XXX,
	 *												'valid_time_to'=> XXX,
	 *												'count_type'=> XXX,
	 *				 								'isSatisfy' => XXX,
	 *   				  						 ),
	 *   				  		  )
	 */
	private static function getNoUidListPrice($data) {
		//获取所有该商品的价格条目
		$allPrices = self::getPrices($data['product_id'], array('wh_id' => $data['wh_id'], 'status' => MP_STATUS_VALID, ));
		if (false === $allPrices) {
			self::setERR(__LINE__, MP_ERROR_GET_PRICES_FAIL, IMultiPriceTTC::$errCode . '_' . IMultiPriceTTC::$errMsg);
			return false;
		}

		global $_List_Price_Type, $_VIP_Type, $_TRADER_Type;

		$Vip_Type = $_VIP_Type;
		$price_Type = $_List_Price_Type;

		$newPrices = array();
		foreach($allPrices as $k => $v) {
			$newPrices[$v['price_id']] = $v;
		}
		$allPrices = $newPrices;

		if (isset($data['price_id']) && $data['price_id'] >= 0) {
			$price_Type[] = $data['price_id'];
		}

		//添加经销商价格
		if (isset($data['IsTrader']) && $data['IsTrader'] > 0) {
			self::_TraderPriceId($data['IsTrader'], $price_Type);
			$hasTraderPrice = false;
			$_TRADER_Type_New = array();
			foreach($_TRADER_Type as $kt => $vt) {
				array_unshift($_TRADER_Type_New, $kt);
			}

			foreach($_TRADER_Type_New as $kt => $vt) {
				if ($hasTraderPrice && isset($allPrices[$vt])) {
					unset($allPrices[$vt]);
				}
				if (isset($allPrices[$vt])) {
					$hasTraderPrice = true;
				}
			}
		}

		$hasVip = false;
		$prices = array();
		$userInfo = array();
		$nowTime = $_SERVER['REQUEST_TIME'];
		foreach($price_Type as $v) {
			if (($data['multiPriceType'] & self::price_idToBinary($v)) && isset($allPrices[$v])) {
				$isSatisfy = false;

				if ($nowTime < $allPrices[$v]['valid_time_from']) { //未生效
					continue;
				}
				if ($nowTime > $allPrices[$v]['valid_time_to']) { //已过期，自动作废
					self::invalidatePrice($data['product_id'], $v, $data['wh_id']);
					continue;
				}

				if (isset($Vip_Type[$v])) {
					$hasVip = true;
					$isSatisfy = false;
				}
				else {
					$isSatisfy = self::verify($userInfo, $allPrices[$v]['verify_type']);
				}
				$prices[$allPrices[$v]['price_id']] = array (
																		'price_id'			=> $allPrices[$v]['price_id'],
																		'price' 				=> $allPrices[$v]['price'],
																		'price_name' 	=> $allPrices[$v]['price_name'],
																		'valid_time_to'	=> $allPrices[$v]['valid_time_to'],
																		'count_type'		=> $allPrices[$v]['count_type'],
																		'isSatisfy' 			=> $isSatisfy,
																	);
			}
		}

		return array(
					'hasVip' => $hasVip,
					'Prices' => $prices,
				);
	}


	/**
	 * 查询有uid状态下默认list所有有效的展示价格
	 * @param array data
	 * 格式：
	 * array(
	 *			'product_id'=> XXX,
	 *			'wh_id'		=> XXX,
	 *			'uid' 		=> XXX,
	 *			'level' 	=> XXX,
	 *			'IsTrader' => XXX,  存在而且大于零代表经销商等级
	 *			'multiPriceType' => XXX
	 *		)
	 *
	 *	传入 商品id 分站id 用户id(如果有则查询vip价是否满足，没有则vip价全不满足) big位 用户等级(如果有则传入) 需要传出的价格
	 * 返回值：正确返回数据，错误返回false
	 * 	格式:  array(
	 *								price_id => array(
	 * 												'price_id' 	=> XXX,
	 * 												'price' 	=> XXX,
	 *												'price_name'=> XXX,
	 *												'valid_time_to'=> XXX,
	 *												'count_type'=> XXX,
	 *				 								'isSatisfy' => XXX,
	 *   				  						 ),
	 *								price_id => array(
	 * 												'price_id' 	=> XXX,
	 * 												'price' 	=> XXX,
	 *												'price_name'=> XXX,
	 *												'valid_time_to'=> XXX,
	 *												'count_type'=> XXX,
	 *				 								'isSatisfy' => XXX,
	 *   				  						 ),
	 *   				  		  )
	 */
	private static function getUidListPrice($data) {
		global $_List_Price_Type, $_VIP_Type, $_TRADER_Type;
		$Vip_Type = $_VIP_Type;
		$price_Type = $_List_Price_Type;

		$isSatisfy = false;
		$hasVip = false;

		$MP_ICSON_PRICE = -1;
		$nowTime = $_SERVER['REQUEST_TIME'];

		$userInfo = array(
			'uid' => $data['uid']
		);
		if (isset($data['level'])) {
			$userInfo['level'] = $data['level'];
		}
		if (isset($data['exp'])) {
			$userInfo['exp'] = $data['exp'];
		}

		//获取所有该商品的价格条目
		$allPrices = self::getPrices($data['product_id'], array('wh_id' => $data['wh_id'], 'status' => MP_STATUS_VALID));
		if ($allPrices == false) {
			self::setERR(__LINE__, MP_ERROR_GET_PRICES_FAIL);
			return false;
		}

		$tmp = array();
		foreach($allPrices as $k => $v) {
			$tmp[ $v['price_id'] ] = $v;
		}
		$allPrices = $tmp;

		if (isset($data['price_id']) && $data['price_id'] >= 0) {
			$price_Type[] = $data['price_id'];
		}

		//添加经销商价格
		if (isset($data['IsTrader']) && $data['IsTrader'] > 0) {
			self::_TraderPriceId($data['IsTrader'], $price_Type);
			$hasTraderPrice = false;

			$_TRADER_Type_New = array();
			foreach($_TRADER_Type as $kt => $vt) {
				array_unshift($_TRADER_Type_New, $kt);
			}

			foreach($_TRADER_Type_New as $kt => $vt) {
				if ($hasTraderPrice && isset($allPrices[$vt])) {
					unset($allPrices[$vt]);
				}
				if (isset($allPrices[$vt])) {
					$hasTraderPrice = true;
				}
			}
		}

		$prices = array();
		foreach($price_Type as $v) {
			if (($data['multiPriceType'] & self::price_idToBinary($v)) && isset($allPrices[$v])) {
				if ($nowTime < $allPrices[$v]['valid_time_from']) { //未生效
					continue;
				}
				if ($nowTime > $allPrices[$v]['valid_time_to']) { //已过期，自动作废
					self::invalidatePrice($data['product_id'], $v, $data['wh_id']);
					continue;
				}
				if (isset($Vip_Type[$v])) { //是会员价
					$hasVip = true;
				}

				$isSatisfy = self::verify($userInfo, $allPrices[$v]['verify_type']);
				if ($isSatisfy === true) {
					$prices[$allPrices[$v]['price_id']] = array(
						'price_id'			=> $allPrices[$v]['price_id'],
						'price' 				=> $allPrices[$v]['price'],
						'price_name' 	=> $allPrices[$v]['price_name'],
						'valid_time_to'	=> $allPrices[$v]['valid_time_to'],
						'count_type'		=> $allPrices[$v]['count_type'],
						'isSatisfy' 			=> $isSatisfy,
					);
				}
			}
		}

		return array(
						'hasVip' => $hasVip,
						'Prices' => $prices,
					);
	}

	/**
	 * 获得购物车价格验证信息
	 * @param array data
	 * 格式：
	 * array(
	 *			'wh_id'		=> XXX,
	 * 			'product'	=> array(
	 *								product_id => array(
	 *														'price_id'		 => price_id
	 *														'multiPriceType' => multiPriceType
	 *													),
	 *								product_id => array(
	 *														'price_id' 		 => price_id
	 *														'multiPriceType' => multiPriceType
	 *													)
	 *							)
	 *		)
	 *
	 * 返回值：正确返回数据，错误返回false
	 * 	格式:
	 *	Array｛
	 * 			'wh_id' 		=> XXX,
	 *			'isOK'			=> XXX,
	 *			'Prices' 		=> array(
	 *								product_id => array(
	 *				 								'isSatisfy' => false
	 * 												'price_id' 	=> XXX,
	 *   				  						 ),
	 *								product_id => array(
	 *				 								'isSatisfy' => true
	 * 												'price_id' 	=> XXX,
	 * 												'price' 	=> XXX,
	 *												'price_name'=> XXX,
	 *				 								'count_type' => XXX,
	 *   				  						 ),
	 *   				  		  ),
	 *   	  )
	 */
	public static function getCartPrices($data) {
		$nowTime = $_SERVER['REQUEST_TIME'];

		$isSatisfy = false;
		$isOK = true;

		$Prices = array();
		$productList = array();

		foreach($data['product'] as $k => $v) {
			if ($v['multiPriceType'] & self::price_idToBinary($v['price_id'])) {
				$productList[] = $k;
			}
			else {
				$Prices[$k] = array(
					'isSatisfy' =>	false,
					'price_id'	=>	$v['price_id']
				);
			}
		}

		if (count($productList) == 0) {
			return array(
							'wh_id'	 => $data['wh_id'],
							'isOK'	 => false,
							'Prices' => $Prices,
						);
		}

		$fliter = array(
			'wh_id' => $data['wh_id'],
			'status'=> MP_STATUS_VALID
		);
		$allPrices = self::getMultiPrices($productList, $fliter);
		foreach($data['product'] as $pid => $mp_info) {
			$isSatisfy = false;

			if (! isset($allPrices[ $pid ][ $mp_info['price_id'] ])) { //没有查询到该价格
				$isOK = false;
				$Prices[$pid] = array(
					'isSatisfy' =>	$isSatisfy,
					'price_id'	=>	$mp_info['price_id'],
				);
			}
			else if ($nowTime < $allPrices[$pid][$mp_info['price_id']]['valid_time_from']) { //价格未生效
				$isOK = false;
				$Prices[$pid] = array(
					'isSatisfy' =>	$isSatisfy,
					'price_id'	=>	$mp_info['price_id'],
				);
			}
			else if ($nowTime > $allPrices[$pid][$mp_info['price_id']]['valid_time_to']) { //已过期，自动作废
				$isOK = false;
				$Prices[$pid] = array(
					'isSatisfy' =>	$isSatisfy,
					'price_id'	=>	$mp_info['price_id'],
				);
				self::invalidatePrice($pid, $mp_info['price_id'], $data['wh_id']);
			}
			else { //生效
				//不再做更多检查
				if (is_numeric($mp_info['price_id'])) {
					$Prices[$pid] = array(
						'isSatisfy' 		=> true,
						'price_id'		=> $mp_info['price_id'],
						'price'			=> $allPrices[ $pid ][ $mp_info['price_id'] ]['price'],
						'price_name' => $allPrices[ $pid ][ $mp_info['price_id'] ]['price_name'],
						'count_type' => $allPrices[ $pid ][ $mp_info['price_id'] ]['count_type'],
					);
				}
			}
		}

		return array(
						'wh_id'	 => $data['wh_id'],
						'isOK'	 => $isOK,
						'Prices' => $Prices,
		);
	}

	//已修改或作废价格先加入价格流水表中
	function addToPriceFlow($data)
	{
		return true;
	}

	// 将多价变动计入价格流水，用于自动价保
	function insertToRecord($data)
	{
		$priceRecord = self::getSpecifyPrice($data['product_id'], $data['price_id'], $data['wh_id']);
		if ((false === $priceRecord) || ($priceRecord['count_type'] == 2)) { // 不记录折扣流水
			return false;
		}

		$recordParams = array('product_id' => $priceRecord['product_id'],
							'product_price' => $priceRecord['price'],
							'valid_time_from' => $priceRecord['valid_time_from'],
							'valid_time_to' => $priceRecord['valid_time_to'],
							'modify_time' => time(),
							'price_type' => $priceRecord['price_id'],
							'verify_type' => $priceRecord['verify_type'],
							'wh_id' => $priceRecord['wh_id'],
						);

		$ret = IPriceRecord::insertToRecord($recordParams);

		Logger::err('insert multiprice record ' . ($ret ? 'success' : 'failed') . ' : ' . var_export($priceRecord, true));

		return $ret;
	}

	// 封装一个供外部使用的验证接口
	public static function verifyUser($uid, $verifyStr) {
		return self::verify(array('uid' => $uid), $verifyStr);
	}

	/*
		根据验证字符串验证用户是否符合价格信息
		*/
	private static function verify($userInfo, $verifyStr) {
		global $_Verifyfunc;
		if ($verifyStr != '') {
			$verifyPoints = explode('|', $verifyStr);

			foreach($verifyPoints as $k => $v) {
				$vHead = substr($v, 0, strpos($v, "_"));
				$param = substr($v,strpos($v, "_") + 1);
				$verify_func = $_Verifyfunc[$vHead];
				$ret = self::$verify_func($userInfo, $param);
				if ($ret == false) {
					return false;
				}
			}
		}

		return true;
	}

	private static function verify_FSALE($userInfo)
	{
		return true;
	}

//验证会员等级
	private static function verify_L($userInfo, $levelStr)
	{
		if (isset($userInfo['uid']) && $userInfo['uid'] > 0)
		{
			if (!isset($userInfo['level']))
			{//未传入等级参数则先获取
				$ret = IUser::getUserInfo($userInfo['uid']);
				if ($ret == false)
				{
					return false;
				}
				else if (!empty($ret))
				{
					$userLevel = $ret['level'];
				}
			}
			else
			{
				$userLevel = $userInfo['level'];
			}

			if ($levelStr == $userLevel)
			{ //只有一个等级
				return true;
			}
			else
			{ //有多个等级用逗号分隔
				$levelArray = explode(',', $levelStr);
				foreach($levelArray as $k => $v)
				{
					$v = intval($v);
					if ($userLevel == $v)
					{
						return true;
					}
				}
			}
		}

		return false;
	}

	/**
	 * 新用户特价验证
	 * @param array $userInfo 用户信息
	 * @return boolean
	 */
	private static function verify_New($userInfo) {
		if (isset($userInfo['uid']) && $userInfo['uid'] > 0) {
			$userExp = false;

			if (! isset($userInfo['exp_point'])) { //未传入等级参数则先获取
				$ret = IUser::getUserInfo($userInfo['uid']);
				if ($ret == false) {
					return false;
				}
				else if (!empty($ret) && isset($ret['exp_point'])) {
					$userExp = $ret['exp_point'];
				}
			}
			else {
				$userExp = $userInfo['exp_point'];
			}

			if (is_numeric($userExp) && 1 >= $userExp) {
				return true;
			}
		}

		return false;
	}

	private static function verify_Tips($userInfo)
	{
		//TODO
		return true;
	}

	//验证是否是qq用户
	private static function verify_QQ($userInfo)
	{
		if (isset($userInfo['uid']) && $userInfo['uid'] > 0)
		{
			$ret = IUser::getUserInfo($userInfo['uid']);
			if ($ret == false)
			{
				return false;
			}
			else if (!empty($ret))
			{
				$userid = $ret['icsonid'];
				if (strncmp('Login_QQ_', $userid, 9) == 0)
				{
					return true;
				}
			}
		}

		return false;
	}

	//验证是否是经销商用户
	private static function verify_TRD($userInfo, $levelStr)
	{
		if (isset($userInfo['uid']) && $userInfo['uid'] > 0)
		{
			$ret = IUser::getUserInfo($userInfo['uid']);
			if ($ret == false)
			{
				return false;
			}
			else if (!empty($ret))
			{
				$level = $ret['retailerLevel'];
				if ($level > 0)
				{
					return true;
				}
			}
		}

		return false;
	}

	//验证是否是qq会员用户
	private static function verify_QQVip($userInfo)
	{
		if (isset($userInfo['uid']) && $userInfo['uid'] > 0)
		{
			$ret = IUser::checkQQVip($userInfo['uid']);
			return $ret;
		}

		return false;
	}

	/**
	 * 验证用户是不是QQ绿钻用户
	 * @param array $userInfo
	 * @return bool
	 */
	private static function verify_QQLvz($userInfo)
	{
		if (isset($userInfo['uid']) && $userInfo['uid'] > 0)
		{
			$ret = IUser::checkQQGreen($userInfo['uid']);
			return $ret;
		}

		return false;
	}

	//验证是否是从团购来源
	private static function verify_Tuan($userInfo)
	{
		return ITuan::checkTuanSn();
	}

	//验证是否是支付宝用户
	private static function verify_Ali($userInfo)
	{
		if (isset($userInfo['uid']) && $userInfo['uid'] > 0)
		{
			$ret = IUser::getUserInfo($userInfo['uid']);
			if ($ret == false)
			{
				return false;
			}
			else if (!empty($ret))
			{
				$userid = $ret['icsonid'];
				if (strncmp('Login_Alipay_', $userid, 13) == 0)
				{
					return true;
				}
			}
		}
		return false;
	}

	//验证是否是手机用户
	private static function verify_Tel($userInfo)
	{
		if (isset($userInfo['uid']) && $userInfo['uid'] > 0)
		{
			$user = IUser::getUserInfo($userInfo['uid']);
			if ($user == false)
			{
				return false;
			}
			else if (!empty($user))
			{
				$phone = $user['mobile'];
				$ret = ITelLoginTTC::get($phone);
				if ($ret == false)
				{
					return false;
				}
				else if (count($ret) != 0)
				{
					foreach($ret as $k => $v)
					{
						if ($v['mobile'] != '0' && $v['mobile'] != '' && $v['uid'] == $userInfo['uid'] && $v['status'] == 1)
						{
							return true;
						}
					}
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		return false;
	}

	//验证是否是邮箱用户
	private static function verify_Mail($userInfo)
	{
		if (isset($userInfo['uid']) && $userInfo['uid'] > 0)
		{
			$ret = IUser::getUserInfo($userInfo['uid']);
			if ($ret == false)
			{
				return false;
			}
			else if (!empty($ret))
			{
				$email = $ret['email'];
			}
			else
			{
				return false;
			}
			if ($email != '0' && $email != '')
			{
				return true;
			}
		}
		return false;
	}

	//QQ团验证
	private static function verify_TQQ($userInfo)
	{
		return false;
	}

	//内网活动验证
	private static function verify_Prom($userInfo)
	{
		return false;
	}
}

//End Of Script
