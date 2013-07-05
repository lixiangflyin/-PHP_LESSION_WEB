<?php 
require_once(PHPLIB_ROOT . 'inc/virtualPayType.inc.php');
/**
 * 虚拟充值
 * @author robinguo
 * @version 1.0
 * @updated 22-三月-2012 15:56:54
 */

//开发者手机号码，同步失败次数超过上限报警
define('VP_DEV_MOBILE',						'18605898269');
//财务人员手机号码，余额不足告警
define('VP_FINANCIAL_MOBILE',				'13761774309');
 

define('VP_PAIPAI_API_URL',					'http://api.paipai.com');
define('VP_PAIPAI_MOBILE_SUBMIT_URL',		'/vb2c/vsaleMobileSubmit.xhtml');
define('VP_PAIPAI_MOBILE_QUERY_URL',		'/vb2c/vsaleMobileQuery.xhtml');

define('VP_PAIPAI_UID',						'2285038846');
define('VP_PAIPAI_SPID',					'29230000ea03aa00684f800af261b662');
define('VP_PAIPAI_TOKEN',					'feec32880f27aa00684fcc8688730ccf');
define('VP_PAIPAI_SECRETKEY',				'0x8n9obe5rw1u8w6gd8hxcwa58kzqx9w');


define("VP_REQUEST_LIMIT_TIMECOUNT",		"300");//拍拍api平台请求限制每5分钟1000次 
define("VP_REQUEST_LIMIT",					"1000");//拍拍api平台请求限制每5分钟1000次

//虚拟订单类型
define('VP_ORDER_TYPE_MOBILE',				'1');//手机充值
define('VP_ORDER_TYPE_QQ',					'2');//Q币
define('VP_ORDER_TYPE_GAME',				'3');//网游订单

$_VP_Order_Type = array(
	VP_ORDER_TYPE_MOBILE 	=> '手机充值',
    VP_ORDER_TYPE_QQ 		=> 'Q币',
	VP_ORDER_TYPE_GAME		=> '网游'
);  

//订单同步标志位
define('VP_ORDER_SYN_YES',					'1');//需要同步
define('VP_ORDER_SYN_NO',					'0');//不需要同步
define('VP_ORDER_SYN_ALERT_LIMIT',			'20');//同步失败报警上限
 



//订单状态
define('VP_STATUS_INVALID',					'-1');//已作废
define('VP_STATUS_INIT',					'0');//初始化，未支付
define('VP_STATUS_USERPAID',				'1');//用户已支付，未充值
define('VP_STATUS_ICSONPAY_SUCCESS',		'2');//易迅账户已扣款成功
define('VP_STATUS_ICSONPAY_FAIL',			'3');//易迅账户扣款失败
define('VP_STATUS_ONCHARGE',				'4');//充值中
define('VP_STATUS_SUCCESS',					'5');//充值成功
define('VP_STATUS_CHARGE_FAIL',				'6');//充值失败
define('VP_STATUS_ICSONPAY_REFUND',			'7');//易迅账户退款中
define('VP_STATUS_ICSONPAY_REFUND_SUCCESS',	'8');//易迅账户退款成功
define('VP_STATUS_USER_REFUND_SUCCESS',		'9');//用户账户退款成功(终止状态)

//拍拍侧订单状态 
define('VP_PAIPAI_STATUS_INIT',					'1');//订单创建成功，支付中 对应 VP_STATUS_USERPAID
define('VP_PAIPAI_STATUS_INVAID',				'7');//订单已取消(原因:支付失败) 对应 VP_STATUS_ICSONPAY_FAIL
define('VP_PAIPAI_STATUS_ICSONPAY_TELSEND',		'2');//下单并支付成功，通知发货中 对应 VP_STATUS_ICSONPAY_SUCCESS
define('VP_PAIPAI_STATUS_ICSONPAY_ONSEND',		'3');//订单发货中(说明:支付成功，正在发货) 对应 VP_STATUS_ONCHARGE
define('VP_PAIPAI_STATUS_CHARGE_FAIL',			'4');//订单退款中(说明:支付成功，充值失败) 对应 VP_STATUS_CHARGE_FAIL 
																							//VP_STATUS_ICSONPAY_REFUND
define('VP_PAIPAI_STATUS_REFUND_SUCCESS',		'6');//订单已退款(说明:支付成功，充值失败) 对应 VP_STATUS_ICSONPAY_REFUND_SUCCESS
define('VP_PAIPAI_STATUS_CHARGE_SUCCESS',		'5');//订单已充值到账(说明:支付成功，充值成功) 对应 VP_STATUS_SUCCESS

//手机充值订单状态 [0]为用户侧展示状态 [1]为网站后台展示状态
$_VP_MobileOrderState = array(	
	VP_STATUS_INVALID => 				array('已作废','已作废'),
	VP_STATUS_INIT => 					array('待支付','初始化，未支付'),
	VP_STATUS_USERPAID => 				array('充值中','用户已支付，未充值'),
	VP_STATUS_ICSONPAY_SUCCESS => 		array('充值中','易迅账户扣款成功'),
	VP_STATUS_ICSONPAY_FAIL =>	 		array('充值失败退款','易迅账户扣款失败'),
	VP_STATUS_ONCHARGE => 				array('充值中','充值中'),
	VP_STATUS_SUCCESS => 				array('充值成功','充值成功'),
	VP_STATUS_CHARGE_FAIL => 			array('充值失败退款','充值失败'),
	VP_STATUS_ICSONPAY_REFUND => 		array('充值失败退款','易迅账户退款中'),
	VP_STATUS_ICSONPAY_REFUND_SUCCESS =>array('充值失败退款','易迅账户退款成功'),
	VP_STATUS_USER_REFUND_SUCCESS => 	array('已退款','用户账户退款成功')
);

$_LS_SALESMAN = array(
    '--android--' => 888888,
	'--mobile--' => 666666,
	'--iphone--' => 999999
);


class IVirtualPay
{
	public static $dbName ='ICSON_CORE'; 
	public static $tableName = 't_virtualpay_order';
	public static $old_TableName = 't_virtualpay_order_old';
	public static $priceTableName = 't_virtualpay_price';
	
	public static $ERPDBName ='ERP_1';
	public static $ERPSoDBName = 'SO';
	public static $ERPFinanceDBName = 'Icson_Finance';
	public static $ERPflowTableName = 'SOFinance_VirtualPay';
	
	/**
	 * 错误码
	 */
	public static $errCode = 0;
	/**
	 * 错误信息
	 */
	public static $errMsg = '';
 
	/**
	 * 创建虚拟支付订单，现只支持手机，可以写其他的预留
	 * 
	 * @param array newOrder = array(
			'uid'			=> XXX,
			'payType' 		=> XXX,
			'type' 			=> XXX,
			'targetId' 		=> XXX,
			'chargeMoney' 	=> XXX,
			'payMoney' 		=> XXX,
			'hasPaidMoney' 	=> XXX,
			'operator' 		=> XXX,
			'area' 			=> XXX, 
			'desc' 			=> XXX

		)	 
		正确返回 array('errCode' => 0, 'errMsg' => array('order_char_id' => 订单号,
													   'payType' => 支付方式,
													   'targetId' => 充值帐号));
		错误返回 array('errCode' => 错误码, 'errMsg' => '错误信息');
	 */  
	public static function createOrder($newOrder)
	{	
		// ITIL上报
		itil_report(635182); 
		//校验数据 
		if (!is_array($newOrder) || empty($newOrder)) {
			// ITIL上报
			itil_report(635208);
		
			self::$errCode = -2000;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newOrder is empty";
			Logger::err(self::$errMsg);
			return array('errNo' => -2000, 'errMsg' => '订单数据为空!');
		}

		if (!isset($newOrder['uid']) || $newOrder['uid'] <= 0) {
			// ITIL上报
			itil_report(635208);

			self::$errCode = -2001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newOrder[uid] is empty";
			Logger::err(self::$errMsg);
			return array('errNo' => -2001, 'errMsg' => '用户id为空!');
		}
		
		//检查充值信息
		if (false === self::_checkChargeInfo($newOrder)) {
			// ITIL上报
			itil_report(635208);

			return false;
		}
		
		//检查支付方式
		if (false === self::_checkPayType($newOrder)) {
			// ITIL上报
			itil_report(635208);

			return false;
		}
		
		if(VP_ORDER_TYPE_MOBILE == $newOrder['type'])
		{
			return self::_createMobileOrder($newOrder);
		}
		// ITIL上报
		itil_report(635208);
		return array('errNo' => 11, 'errMsg' => '充值类型不正确!');
	}
	
	/**
	 * 获取一个新订单id
	 * 
	 * 正确返回订单号，错误返回false
	 */
	private static function _newOrderId()
	{
		$newId = IIdGenerator::getNewId('so_sequence');
		if (false === $newId || $newId <= 0) {
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return  false;
		} 
		return $newId;
	}
	

	/**
	 * 检测支付类型
	 * 输入订单信息 array(
						'payType' 		=> XXX,
					);
	 
	 * 正确返回true 错误返回false
	 */	
	private static function _checkPayType(&$newOrder)
	{ 
		global $_PAY_MODE;  
		$payType = $_PAY_MODE[1];
		
		if (!isset($newOrder['payType']) || !isset($payType[$newOrder['payType']])) {
			self::$errCode = -2002;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "支付方式不正确";
			Logger::err(self::$errMsg);
			return false;
		}

		if ($payType[$newOrder['payType']]['IsOnlineShow'] == 0) {
			self::$errCode = -2003;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "不是在线支付方式";
			Logger::err(self::$errMsg);
			return false;
		} 
		return true;
	}
	
	/**
	 * 检测充值信息合法性
	 * 
	 * 输入订单信息
	 
		正确返回true 错误返回false
	 */	
	private static function _checkChargeInfo(&$newOrder)
	{
		global $_VP_Card_Price;
		global $_VP_Card_Category;
		//检测充值帐号
		
		//检测uid
		$userInfo = IUsersTTC::get($newOrder['uid'],array());
		
		if (!is_array($userInfo)) { 
			self::$errCode = -2004;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "用户id不正确!";
			Logger::err(self::$errMsg);
			return false;
		}
		
		if(VP_ORDER_TYPE_MOBILE == $newOrder['type'])
		{//手机充值  
			$mobileRegExp = '/^((\(\d{3}\))|(\d{3}\-))?1\d{10}$/';
			//检测运营商和地区充值面值充值金额
			if(!isset($_VP_Card_Price[$newOrder['operator']]))
			{
				self::$errCode = -2005;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "运营商信息不正确";
				Logger::err(self::$errMsg);
				return false;			
			}
			else if(!isset($_VP_Card_Category[$newOrder['chargeMoney']][1]) || $_VP_Card_Category[$newOrder['chargeMoney']][1] != $newOrder['productId'])
			{
				self::$errCode = -2006;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "充值卡商品id不正确";
				Logger::err(self::$errMsg);
				return false;			
			}
			else if(!isset($_VP_Card_Price[$newOrder['operator']][$newOrder['area']]))
			{
				self::$errCode = -2007;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "充值区域不正确";
				Logger::err(self::$errMsg);
				return false;			
			}
			else if(!isset($_VP_Card_Price[$newOrder['operator']][$newOrder['area']][$newOrder['chargeMoney']]))
			{
				self::$errCode = -2008;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "充值金额不正确";
				Logger::err(self::$errMsg);
				return false;			
			}
			else if($_VP_Card_Price[$newOrder['operator']][$newOrder['area']][$newOrder['chargeMoney']] != $newOrder['payMoney'])
			{
				// 96折直将活动
				if($newOrder['actid'] == '51buy96' && $newOrder['chargeMoney'] == 100 && $newOrder['payMoney'] == 96){
					return true;
				}
				self::$errCode = -2009;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "支付金额不正确";
				Logger::err(self::$errMsg);
				return false;			
			}			
			
			//检测手机号
			if(!preg_match($mobileRegExp,$newOrder['targetId']))
			{
				self::$errCode = -2010;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "充值号码不正确";
				Logger::err(self::$errMsg);
				return false;				
			}		
		} 
		return true;
	}
	
	/**
	 * 创建手机虚拟充值订单
	 * 
		正确返回true 错误返回false
	 */
	private static function _createMobileOrder(&$newOrder)
	{
		
		//生成订单id
		$orderId = self::_newOrderId();
		if(false === $orderId)
		{	
			// ITIL上报
			itil_report(635208);
			self::$errCode = -3001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "获取订单号失败";
			Logger::error(__FILE__ . '.php' . '|' . __LINE__ . " 获取订单号失败" . self::$errCode . '|' . self::$errMsg);
			return false;
		}

		$soitemID = IIdGenerator::getNewId('So_Item_Sequence');
		$financeSysNo = IIdGenerator::getNewId('Finance_NetPay_sequence');
		
		global $_LS_SALESMAN;
		//插入订单数据库
		$order = array();
		$order['uid'] = $newOrder['uid']; 
		$order['orderId'] = $orderId;
		$order['order_char_id'] = sprintf("%s%09d", "1", $orderId % 1000000000);
		$order['payType'] = $newOrder['payType'];
		$order['type'] = $newOrder['type'];
		$order['targetId'] = $newOrder['targetId'];
		$order['productId'] = $newOrder['productId'];
		$order['wh_id'] = $newOrder['wh_id'];
		$order['soitemID'] = $soitemID;
		$order['financeSysNo'] = $financeSysNo;
		$order['chargeMoney'] = $newOrder['chargeMoney'] * 100;
		$order['payMoney'] = $newOrder['payMoney'] * 100;
		$order['operator'] = $newOrder['operator'];
		$order['area'] = $newOrder['area'];
		$order['orderTime'] = time(); 
		$order['status'] = VP_STATUS_INIT;
		$order['salesman'] =  isset($newOrder['ls']) ? $_LS_SALESMAN[$newOrder['ls']] : '';
		$order['synFlag'] = VP_ORDER_SYN_NO; //支付完成后才同步状态  		
		 
		$orderDb = ToolUtil::getMSDBObj(self::$dbName);
		if (empty($orderDb)) {
			// ITIL上报
			itil_report(635208);
			self::$errCode = -4000;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "get OrderDB failed" . $orderDb->errMsg;  
			Logger::err(self::$errMsg);
			return  false;
		}
		
		if(false === $orderDb->insert(self::$tableName,$order))
		{
			// ITIL上报
			itil_report(635208);
			self::$errCode = -4002;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "insert OrderDB failed". $orderDb->errMsg;
			Logger::err(self::$errMsg); 
			return  false;			
		}
	  
		return array('errCode' => 0, 'errMsg' => array('order_char_id' => $order['order_char_id'],
													   'uid' => $order['uid'],
													   'payType' => $order['payType'],
													   'targetId' => $order['targetId'])); 
	}
		
	/**
	 * 调用查询待充值订单 订单状态 充值中或易迅账户扣款成功
	 */
	public static function CallSysOrderScript()
	{
		///该函数没有使用者了
		$orderDb = ToolUtil::getMSDBObj(self::$dbName);
		if (empty($orderDb)) {
			self::$errCode = -4000;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "get OrderDB failed" . $orderDb->errMsg;
			Logger::err(self::$errMsg); 
			return  false;
		}  
		$sql = 'SELECT [orderId]
					  ,[order_char_id]
					  ,[uid]
					  ,[payType] as pay_type
					  ,[type]
					  ,[targetId]
					  ,[productId] 
					  ,[wh_id] as hw_id
					  ,[chargeMoney]
					  ,[payMoney] as cash
					  ,[hasPaidMoney]
					  ,[operator]
					  ,[area]
					  ,[orderTime]
					  ,[payTime]
					  ,[icsonPayTime]
					  ,[successTime]
					  ,[refuncTime]
					  ,[payFlow]
					  ,[orderFlow]
					  ,[synFlag]
					  ,[status]
					  ,[desc] FROM ' . self::$tableName . ' WHERE OR status=' . VP_STATUS_ONCHARGE . ' OR status=' . VP_STATUS_ICSONPAY_SUCCESS;		
		if(false === $orders)
		{
			self::$errCode = -4001;
			self::$errMsg .= basename(__FILE__, '.php') . " |" . __LINE__ . "select OrderDB failed"; 
			return  false;			
		}  
		return $orders;			
	}

	/**
	 * 根据拍拍状态写入订单状态
	 */
	public static function getChargeStatus(&$data)
	{  
		// ITIL上报
		itil_report(635183); 
		if(isset($data['errorCode']) && $data['errorCode'] != 0)
		{ 
			if('1217' == $data['errorCode'])
			{//商品缺货,通知退款
				$ret = self::setIcsonPayFail($data);
				//对应 VP_STATUS_ICSONPAY_FAIL 更新状态表 是否需要报警
				self::$errCode = -1001;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " 拍拍商品缺货 " . $data['errorCode'] . $data['errorMessage'] . self::$errMsg;
				if(false === $ret)
				{
					self::$errCode = -1000;
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " 更新订单状态失败 " . self::$errMsg;
					Logger::err(self::$errMsg); 
					return false;
				}   
				//修改订单状态，进入退款流程
				return true;				
			}
			if('1096' == $data['errorCode'])
			{//财付通余额不足，通知打钱，前台端口封闭
				self::$errCode = -1002;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " 财付通余额不足 " . $data['errorCode'] . $data['errorMessage'];
				Logger::err(self::$errMsg);
				//发送告警短信
				$message = "易迅虚拟充值财付通帐号余额不足，请充值!";
				$ret = IMessage::sendSMSMessage(VP_FINANCIAL_MOBILE,$message);
				if(false === $ret)
				{ 
					$logger = new Logger('sysVirtualPayFlow');
					$logger->err('send message failed: ' . $message); 
				}
				return false;				
			} 
			if('12290' == $data['errorCode'])
			{//sign校验失败
				self::$errCode = -1003;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "拍拍校验码错误 " . $data['errorCode'] . $data['errorMessage']; 
				Logger::err(self::$errMsg);
				return false;				
			} 
			self::$errCode = -1004;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "拍拍状态错误 " . $data['errorCode'] . $data['errorMessage'];
			Logger::err(self::$errMsg);
			//这里同步错误是否要添加同步次数
			return false;			
		}
		if(!isset($data['dealState']))
		{//先查看是否有订单状态
			self::$errCode = -1005;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " 拍拍订单状态为空 " . $data['errorCode'] . $data['errorMessage']; 
			Logger::err(self::$errMsg);
			return false;		
		}
		else
		{ 
			if(VP_PAIPAI_STATUS_INIT == $data['dealState'])
			{
				//拍拍订单创建成功，支付中 对应 VP_STATUS_USERPAID
				//不更新虚拟表订单
				return true;
			}
			if(VP_PAIPAI_STATUS_INVAID == $data['dealState'])
			{	//订单已取消(原因:支付失败)
			
				//更新状态易迅付款失败
				$ret = self::setIcsonPayFail($data);
				//对应 VP_STATUS_ICSONPAY_FAIL 更新状态表 是否需要报警
				if(false === $ret)
				{
					self::$errCode = -1006;
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " 更新订单状态失败 " . self::$errMsg; 
					Logger::err(self::$errMsg);
					return false;
				} 
				return true;
			}
			if(VP_PAIPAI_STATUS_ICSONPAY_TELSEND == $data['dealState'])
			{	//下单并支付成功，通知发货中  
				$ret = self::setIcsonPaySuccess($data);
				//对应 VP_STATUS_ICSONPAY_SUCCESS 更新订单状态，写入易迅支付时间
				if(false === $ret)
				{
					self::$errCode = -1006;
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " 更新订单状态失败 " . self::$errMsg; 
					Logger::err(self::$errMsg);
					return false;
				} 
				return true;
			}
			if(VP_PAIPAI_STATUS_ICSONPAY_ONSEND == $data['dealState'])
			{
				//订单发货中(说明:支付成功，正在发货)  
				
				$ret = self::setUserOnCharge($data); 
				if(false === $ret)
				{
					self::$errCode = -1006;
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " 更新订单状态失败 " . self::$errMsg; 
					Logger::err(self::$errMsg);
					return false;
				}
				return true;
			}
			if(VP_PAIPAI_STATUS_CHARGE_FAIL == $data['dealState'])
			{
				//订单退款中(说明:支付成功，充值失败)
				$ret = self::setUserChargeFail($data); 
				if(false === $ret)
				{
					self::$errCode = -1006;
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " 更新订单状态失败 " . self::$errMsg; 
					Logger::err(self::$errMsg);
					return false;
				}
				return true;
			}
			if(VP_PAIPAI_STATUS_REFUND_SUCCESS == $data['dealState'])
			{
				//订单已退款(说明:支付成功，充值失败)  
				$ret = self::setIcsonRefundSuccess($data);
				//对应 VP_STATUS_ICSONPAY_REFUND_SUCCESS 写入退款时间 状态 更新订单状态，退款时间，向财务更新，向erp更新
				if(false === $ret)
				{
					self::$errCode = -1006;
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " 更新订单状态失败 " . self::$errMsg; 
					Logger::err(self::$errMsg);
					return false;
				}
				return true;
			}
			if(VP_PAIPAI_STATUS_CHARGE_SUCCESS == $data['dealState'])
			{	
				//订单已充值到账(说明:支付成功，充值成功)  
				$ret = self::setChargeSuccess($data);//更新订单状态，成功时间，向财务更新，向erp更新
				if(false === $ret)
				{
					self::$errCode = -1006;
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " 更新订单状态失败 " . self::$errMsg; 
					Logger::err(self::$errMsg);
					return false;
				}
				return true;
			}
		}
		self::$errCode = -1007;
		self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " 拍拍状态未知 " . self::$errMsg; 
		Logger::err(self::$errMsg);
		return false;
	}

	/**
	 * 查询已支付但未充值的订单,调用接口请求充值,订单状态 用户已支付，未充值
	 */
	public static function SearchNeedRequestOrder()
	{
		// ITIL上报
		itil_report(635184); 
		$orderDb = ToolUtil::getMSDBObj(self::$dbName);
		if (empty($orderDb)) {
			self::$errCode = -4000;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "get OrderDB failed" . $orderDb->errMsg; 
			Logger::err(self::$errMsg);
			return  false;
		}  
		$sql = 'SELECT [orderId]
					  ,[order_char_id]
					  ,[uid] 
					  ,[payType] as pay_type
					  ,[type]
					  ,[targetId]
					  ,[productId] 
					  ,[wh_id] as hw_id
					  ,[chargeMoney] 
					  ,[payMoney] as cash
					  ,[hasPaidMoney]
					  ,[operator]
					  ,[area]
					  ,[orderTime]
					  ,[payTime]
					  ,[icsonPayTime]
					  ,[successTime]
					  ,[refuncTime]
					  ,[payFlow]
					  ,[orderFlow]
					  ,[synFlag]
					  ,[status]
					  ,[desc] FROM ' . self::$tableName . ' WHERE status=' . VP_STATUS_ONCHARGE . ' OR status=' . VP_STATUS_ICSONPAY_SUCCESS . ' OR status=' . VP_STATUS_CHARGE_FAIL . ' OR status=' . VP_STATUS_ICSONPAY_REFUND . ' OR status=' . VP_STATUS_USERPAID;
		$orders = $orderDb->getRows($sql);  
		if(false === $orders)
		{
			self::$errCode = -4001;
			self::$errMsg .= basename(__FILE__, '.php') . " |" . __LINE__ . "select OrderDB failed"; 
			return  false;			
		}  
		return $orders;				
	}

	/**
	 * 查询已支付的处于用户已支付状态的订单
	 */
	public static function SearchUserPaidOrder()
	{
		// ITIL上报
		itil_report(635185);
		$orderDb = ToolUtil::getMSDBObj(self::$dbName);
		if (empty($orderDb)) {
			self::$errCode = -4000;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "get OrderDB failed" . $orderDb->errMsg; 
			Logger::err(self::$errMsg);
			return  false;
		}  
		$sql = 'SELECT [orderId]
					  ,[order_char_id]
					  ,[uid]
					  ,[payType] as pay_type
					  ,[type]
					  ,[targetId]
					  ,[productId]
					  ,[wh_id] as hw_id
					  ,[chargeMoney]
					  ,[payMoney] as cash
					  ,[hasPaidMoney]
					  ,[operator]
					  ,[area]
					  ,[orderTime]
					  ,[payTime]
					  ,[icsonPayTime]
					  ,[successTime]
					  ,[refuncTime]
					  ,[payFlow]
					  ,[orderFlow]
					  ,[synFlag]
					  ,[status]
					  ,[desc] FROM ' . self::$tableName . ' WHERE status=' . VP_STATUS_USERPAID;	
		$orders = $orderDb->getRows($sql);  
		if(false === $orders)
		{
			self::$errCode = -4001;
			self::$errMsg .= basename(__FILE__, '.php') . " |" . __LINE__ . "select OrderDB failed"; 
			return  false;			
		}  
		return $orders;				
	}
	
	/**
	 * 按条件查看虚拟充值的订单列表
	 */
	public static function getVirtualOrdersLists($data)
	{		
		// ITIL上报
		itil_report(635186);
		$orderDb = ToolUtil::getMSDBObj(self::$dbName);
		if (empty($orderDb)) {
			self::$errCode = -4000;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "get OrderDB failed". $orderDb->errMsg; 
			Logger::err(self::$errMsg);  
			return  false;
		}  
		$sql = 'SELECT  [orderId]
						,[order_char_id]
						,[uid]
						,[payType]
						,[type]
						,[targetId]
						,[productId]
						,[wh_id]
						,[chargeMoney]
						,[payMoney]
						,[hasPaidMoney]
						,[soitemID]
						,[financeSysNo]
						,[operator]
						,[area]
						,[orderTime]
						,[payTime]
						,[icsonPayTime]
						,[successTime]
						,[refuncTime]
						,[payFlow]
						,[orderFlow]
						,[synFlag]
						,[status] 
						,[icsonPaidMoney]
					    ,[payType] as pay_type
					    ,[wh_id] as hw_id
					    ,[payMoney] as cash FROM ' . self::$tableName . ' WHERE orderId!=0 ';
		if (isset($data['uid'])) 
		{
			$sql .=  " AND uid=" . $data['uid'];
		}
		if (isset($data['payType'])) 
		{
			$sql .=  " AND payType=" . $data['payType'];
		}
		if (isset($data['operator']))
		{
			$sql .= " AND operator like '%" . str_replace(' ','%',$data['operator']) . "%' ";
		}
		if (isset($data['area']))
		{
			$sql .= " AND area like '%" . str_replace(' ','%',$data['area']) . "%' ";
		}
		if (isset($data['valid_time_from']) && isset($data['valid_time_to'])) 
		{
			$sql .= " AND orderTime>=" . $data['valid_time_from'] . " AND orderTime<=" . $data['valid_time_to'];		
		}
		if (isset($data['status'])) 
		{
			$sql .=  " AND status=" . $data['status'];
		}
		if (isset($data['orderId'])) 
		{
			$sql .=  " AND orderId=" . $data['orderId'];
		}
		if (isset($data['order_char_id'])) 
		{
			$sql .=  " AND order_char_id=" . $data['order_char_id'];
		}
		if (isset($data['type'])) 
		{
			$sql .=  " AND type=" . $data['type'];
		}
		if (isset($data['targetId'])) 
		{
			$sql .=  " AND targetId=" . $data['targetId'];
		}  
		if (isset($data['chargeMoney'])) 
		{
			$sql .=  " AND chargeMoney=" . $data['chargeMoney'];
		}        
		if (isset($data['orderFlow'])) 
		{
			$sql .=  " AND orderFlow=" . $data['orderFlow'];
		}    
		 
		$orders = $orderDb->getRows($sql); 
		if(false === $orders)
		{
			self::$errCode = -4001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "select OrderDB failed" . $orderDb->errMsg; 
			return  false;			
		}  
		return $orders;		
	}

	/**
	 * 按条件查询虚拟充值价格信息
	 */
	public static function getVirtualPayPrice($data = array())
	{		
		// ITIL上报
		itil_report(635187);
		$priceDb = ToolUtil::getMSDBObj(self::$dbName);
		if (empty($priceDb)) {
			self::$errCode = -4000;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "get priceDb failed". $priceDb->errMsg; 
			Logger::err(self::$errMsg);  
			return  false;
		}  
		$sql = 'SELECT [productId]
					  ,[chargeMoney]
					  ,[payMoney]
					  ,[wh_id]
					  ,[operator]
					  ,[area]
					  ,[synTime]
					  ,[editUser]
					  ,[price_desc]
				FROM ' . self::$priceTableName . ' WHERE productId!=0 ';
		if (isset($data['productId'])) 
		{
			$sql .=  " AND productId=" . $data['productId'];
		} 
		if (isset($data['operator']))
		{
			$sql .= " AND operator like '%" . str_replace(' ','%',$data['operator']) . "%' ";
		}
		if (isset($data['area']))
		{
			$sql .= " AND area like '%" . str_replace(' ','%',$data['area']) . "%' ";
		}
		 
		$prices = $priceDb->getRows($sql); 
		if(false === $prices)
		{
			self::$errCode = -4001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "select priceDb failed" . $priceDb->errMsg; 
			return  false;			
		}  
		return $prices;		
	}
	
	/**
	 * 按条件查询虚拟充值价格信息
	 */
	public static function _updatePrice($data)
	{	
		$condition = " productId!=0 ";
		if (isset($data['productId'])) 
		{
			$condition .=  " AND productId=" . $data['productId'];
		} 
		if (isset($data['area'])) 
		{
			$condition .=  " AND area='" . $data['area'] . "'";
		} 
		if (isset($data['operator'])) 
		{
			$condition .=  " AND operator='" . $data['operator'] . "'";
		}  
		$updateData = array();
		if (isset($data['payMoney']))
		{
			$updateData['payMoney'] = $data['payMoney'];
		}	
		if (isset($data['editUser']))
		{
			$updateData['editUser'] = $data['editUser'];
		}	
		if (isset($data['synTime']))
		{
			$updateData['synTime'] = $data['synTime'];
		}	
		$priceDb = ToolUtil::getMSDBObj(self::$dbName);
		if (empty($priceDb)) {
			self::$errCode = -4000;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "get priceDb failed". $priceDb->errMsg; 
			Logger::err(self::$errMsg);  
			return  false;
		}   
		
        $ret = $priceDb->update(self::$priceTableName,$updateData,$condition); 
		if (false === $ret) {
			self::$errCode = $priceDb->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $priceDb->errMsg;
			Logger::err(self::$errMsg);
			return false;
		} 	
		return true;		
	}
	
	/**
	 * 	查询用户订单
	输入：
		uid;用户id 
		page： 第几页，从0开始
		pagesize：每页记录数

	输出：
	total :总结果条数
	orders:订单数组
		order_char_id：订单id
		targetId：充值帐号
		status ： 订单状态 
		pay_type：支付方式
		cash ： 现金支付
	*/ 
	public static function getUserOrdersInOneMonth($uid, $page, $pageSize)
	{
		// ITIL上报
		itil_report(635188);
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -2001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";  
			Logger::err(self::$errMsg);
			return false;
		}		
		$orderDb = ToolUtil::getMSDBObj(self::$dbName);
		if (empty($orderDb)) {
			self::$errCode = -4000;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "get OrderDB failed" . $orderDb->errMsg;
			Logger::err(self::$errMsg);
			return  false;
		}  

		$sql = 'select count(*) as total_num from ' . self::$tableName . ' where uid=' . $uid;
		$total =  $orderDb->getRows($sql);
		if (false === $total) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			Logger::err(self::$errMsg);			
			return false;
		}
		$total = $total[0]['total_num'];
		if ($total == 0) {
			return array('total'=>$total, 'orders'=>array());
		}
		$sql = 'SELECT * FROM (
								SELECT [orderId]
									  ,[order_char_id]
									  ,[uid]
									  ,[payType]
									  ,[type]
									  ,[targetId]
									  ,[productId]
									  ,[wh_id]
									  ,[chargeMoney]
									  ,[payMoney] as cash
									  ,[hasPaidMoney]
									  ,[operator]
									  ,[area]
									  ,[orderTime]
									  ,[payTime]
									  ,[icsonPayTime]
									  ,[successTime]
									  ,[refuncTime]
									  ,[status]
									  ,row_number() OVER (ORDER BY orderTime DESC) rn
									  FROM  ' . self::$tableName . '  where uid=' . $uid . ') tmpres
		WHERE rn >' .  $page*$pageSize . ' AND rn<=' .($page+1)*$pageSize ;
		$orders =  $orderDb->getRows($sql);
		if (false === $orders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			Logger::err(self::$errMsg);
			return false;
		}
		if (count($orders) == 0) {
		 	return array('total'=>$total, 'orders'=>$orders);
		 }
		return array('total'=>$total, 'orders'=>$orders);
	}
	/**
	 * 	查询用户订单
	输入：
		uid;用户id 
		page： 第几页，从0开始
		pagesize：每页记录数

	输出：
	total :总结果条数
	orders:订单数组
		order_char_id：订单id
		targetId：充值帐号
		status ： 订单状态 
		pay_type：支付方式
		cash ： 现金支付
	*/ 
	public static function getUserOrdersOneMonthAgo($uid, $page, $pageSize)
	{
		// ITIL上报
		itil_report(635189);
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -2001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";  
			Logger::err(self::$errMsg);
			return false;
		}		
		$orderDb = ToolUtil::getMSDBObj(self::$dbName);
		if (empty($orderDb)) {
			self::$errCode = -4000;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "get OrderDB failed" . $orderDb->errMsg;
			Logger::err(self::$errMsg);
			return  false;
		}  

		$sql = 'select count(*) as total_num from ' . self::$old_TableName . ' where uid=' . $uid;
		$total =  $orderDb->getRows($sql);
		if (false === $total) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			Logger::err(self::$errMsg);			
			return false;
		}
		$total = $total[0]['total_num'];
		if ($total == 0) {
			return array('total'=>$total, 'orders'=>array());
		}
		$sql = 'SELECT * FROM (
								SELECT [orderId]
									  ,[order_char_id]
									  ,[uid]
									  ,[payType]
									  ,[type]
									  ,[targetId]
									  ,[productId]
									  ,[wh_id]
									  ,[chargeMoney]
									  ,[payMoney] as cash
									  ,[hasPaidMoney]
									  ,[operator]
									  ,[area]
									  ,[orderTime]
									  ,[payTime]
									  ,[icsonPayTime]
									  ,[successTime]
									  ,[refuncTime]
									  ,[status]
									  ,row_number() OVER (ORDER BY orderTime DESC) rn
									  FROM  ' . self::$old_TableName . '  where uid=' . $uid . ') tmpres
		WHERE rn >' .  $page*$pageSize . ' AND rn<=' .($page+1)*$pageSize ;
		$orders =  $orderDb->getRows($sql);
		if (false === $orders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			Logger::err(self::$errMsg);
			return false;
		}
		if (count($orders) == 0) {
		 	return array('total'=>$total, 'orders'=>$orders);
		 }
		return array('total'=>$total, 'orders'=>$orders);
	}	 
	
	/**
	 * 查询单一虚拟充值订单信息
	 *  
	 */
	public static function getVirtualOrder($uid,$order_char_id)
	{		
		// ITIL上报
		itil_report(635190);
		$orderDb = ToolUtil::getMSDBObj(self::$dbName);
		if (empty($orderDb)) {
			self::$errCode = -4000;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "get OrderDB failed" . $orderDb->errMsg;
			Logger::err(self::$errMsg); 
			return  false;
		} 
		$sql = 'SELECT [orderId]
					  ,[order_char_id]
					  ,[uid]
					  ,[payType]
					  ,[type]
					  ,[targetId]
					  ,[productId]
					  ,[wh_id]
					  ,[chargeMoney]
					  ,[payMoney]
					  ,[hasPaidMoney]
					  ,[operator]
					  ,[area]
					  ,[orderTime]
					  ,[payTime]
					  ,[icsonPayTime]
					  ,[successTime]
					  ,[refuncTime]
					  ,[payFlow]
					  ,[orderFlow]
					  ,[synFlag]
					  ,[status]
					  ,[desc] FROM ' . self::$tableName . ' WHERE [uid]=' . $uid . ' AND [order_char_id]=' . $order_char_id;
		$order = $orderDb->getRows($sql); 
		if(false === $order)
		{
			self::$errCode = -4001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "select OrderDB failed";
			Logger::err(__FILE__ . '.php' . '|' . __LINE__ . " 插入数据库失败" . $orderDb->errCode . '|' . $orderDb->errMsg); 
			return  false;			
		}  

		if (0 >=  count($order)) {
			self::$errCode = -4002;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "no such orders";
			return false;
		}
		return $order[0];
	}
    /**
     * 根据订单号获取来源分区
     *
     */
    public static function getSalesmanByOrderid($order_char_id)
    {
    	// ITIL上报
		itil_report(635191);
        $orderDb = ToolUtil::getMSDBObj(self::$dbName);
        if (empty($orderDb)) {
            self::$errCode = -4000;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "get OrderDB failed" . $orderDb->errMsg;
            Logger::err(self::$errMsg);
            return  false;
        }
        $sql = 'SELECT [salesman] FROM ' . self::$tableName . ' WHERE [order_char_id]='.$order_char_id;
        $order = $orderDb->getRows($sql);
        if(false === $order)
        {
            self::$errCode = -4001;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "select OrderDB failed";
            Logger::err(__FILE__ . '.php' . '|' . __LINE__ . " 插入数据库失败" . $orderDb->errCode . '|' . $orderDb->errMsg);
            return  false;
        }

        if (0 >=  count($order)) {
            self::$errCode = -4002;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "no such orders";
            return false;
        }
        return $order[0];
    }
	/**
	 * 查询虚拟充值订单信息并转换成支付所需数据格式
	 *  
	 */
	public static function getVirtualOrderToPay($uid,$order_char_id)
	{		
		// ITIL上报
		itil_report(635192);
		$orderDb = ToolUtil::getMSDBObj(self::$dbName);
		if (empty($orderDb)) {
			self::$errCode = -4000;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "get OrderDB failed";  
			return  false;
		}  
		$sql = 'SELECT [orderId]
					  ,[order_char_id]
					  ,[uid]
					  ,[payType] as pay_type
					  ,[type]
					  ,[targetId]
					  ,[productId]
					  ,[wh_id] as hw_id
					  ,[chargeMoney]
					  ,[payMoney] as cash
					  ,[hasPaidMoney]
					  ,[operator]
					  ,[area]
					  ,[orderTime]
					  ,[orderTime] as order_date
					  ,[payTime]
					  ,[icsonPayTime]
					  ,[successTime]
					  ,[refuncTime]
					  ,[payFlow]
					  ,[orderFlow]
					  ,[synFlag]
					  ,[status]
					  ,[desc] FROM ' . self::$tableName . ' WHERE [uid]=' . $uid . ' AND [order_char_id]=' . $order_char_id;
		$order = $orderDb->getRows($sql); 
		if(false === $order)
		{
			self::$errCode = -4001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "select OrderDB failed";
			Logger::err(__FILE__ . '.php' . '|' . __LINE__ . " 插入数据库失败" . $orderDb->errCode . '|' . $orderDb->errMsg); 
			return  false;			
		} 
		if(0 === count($order))
		{
			self::$errCode = -4003;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "select OrderDB null";
			return false;
		}  
		if($order[0]['hasPaidMoney'] != $order[0]['cash'])
		{
			$order[0]['isPayed'] = 0;		
		}
		else
		{
			$order[0]['isPayed'] = 1;			
		}
		return $order[0];
	}	
	
	/**
	 * 在线支付完成后修改订单状态
	 *  
	 */
	public static function setOrderPayed($uid, $order_char_id, $cash, $payFlow)
	{	
		// ITIL上报
		itil_report(635193);
		// 支付成功后记录支付成功通知关键信息
		Logger::info('[Pay Success and Change Order State] [' . basename(__FILE__, '.php') . '] [ ' . __LINE__ . ' ] | [uid=' . $uid . '] [order_char_id=' . $order_char_id . '] [cash=' . $cash . '] [payFlow=' . $payFlow . ']');

		// 参数校验
		if (!isset($order_char_id) || $order_char_id == "") {
			// ITIL上报
			itil_report(635207);
			self::$errCode = -2000;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_char_id[$order_char_id] is empty";
			Logger::err(self::$errMsg);
			return false;
		}

		if (!isset($uid) || $uid <= 0) {
			// ITIL上报
			itil_report(635207);
			self::$errCode = -2001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";
			Logger::err(self::$errMsg);
			return false;
		}

		if (!isset($cash) || $cash <= 0) {
			// ITIL上报
			itil_report(635207);
			self::$errCode = -2020;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[$cash] is empty";
			Logger::err(self::$errMsg);
			return false;
		}
		
		if (!isset($payFlow)) {
			// ITIL上报
			itil_report(635207);
			self::$errCode = -2021;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[$payFlow] is empty";
			Logger::err(self::$errMsg);
			return false;
		}
		$orderDb = ToolUtil::getMSDBObj(self::$dbName);
		if (empty($orderDb)) {
			// ITIL上报
			itil_report(635207);
			self::$errCode = $orderDb->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $orderDb->errMsg; 
			Logger::err(self::$errMsg); 
			return  false;
		}   
 		// 查询订单数据
		$sql = 'SELECT [orderId]
					  ,[order_char_id]
					  ,[uid]
					  ,[payType]
					  ,[type]
					  ,[targetId]
					  ,[productId]
					  ,[wh_id]
					  ,[chargeMoney]
					  ,[payMoney]
					  ,[hasPaidMoney]
					  ,[soitemID]
					  ,[financeSysNo]
					  ,[operator]
					  ,[area]
					  ,[orderTime]
					  ,[payTime]
					  ,[payFlow]
					  ,[synFlag]
					  ,[status]
					  ,[salesman]
					  FROM ' . self::$tableName . ' WHERE [uid]=' . $uid . ' AND [order_char_id]=' . $order_char_id;
		$orders = $orderDb->getRows($sql);
		if (false === $orders) {
			// ITIL上报
			itil_report(635207);
			self::$errCode = $orderDb->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $orderDb->errMsg; 
			Logger::err(self::$errMsg);
			return false;
		}

		if (0 >= count($orders)) {
			// ITIL上报
			itil_report(635207);
			self::$errCode = -4002;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "no such orders"; 
			Logger::err(self::$errMsg);
			return false;
		}
		$order = &$orders[0];
		// 订单数据校验
        if (bccomp($cash, $order['payMoney'], 0)) {
        		// ITIL上报
				itil_report(635207);
                self::$errCode = -1008;
                self::$errMsg = "用户支付 $cash 金额不等于应支付金额 ({$order['payMoney']})"; 
				Logger::err(self::$errMsg);
                return false;
        }
        // 可重入校验
        if ($order['status'] != VP_STATUS_INIT && $order['status'] != VP_STATUS_INVALID) {
            return true;
        }
		
		// 以下事务相关代码设计上有问题，暂时注释，稳定后删除 - hongfuguan
		//起事务，更新数据库
		/*$sql = "begin transaction";
		$ret = $orderDb->execSql($sql);
		if (false === $ret) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg='开启virtualPay orderdb事务失败'  . $orderDb->errMsg;
			Logger::err(self::$errMsg);
			return  false;
		}*/	

		// 更新订单状态
		$now = time();
        
        $sql = 'update ' . self::$tableName . ' set 
						status=' . VP_STATUS_USERPAID . ',
						payTime=' . $now . ',
						payFlow=\'' . $payFlow . '\',
						hasPaidMoney=' . $order['payMoney'] . ' 
						where uid=' . $uid . ' and order_char_id=\'' . $order_char_id . '\'';
        $ret = $orderDb->execSql($sql); 
		if (false === $ret || $orderDb->getAffectedRows() != 1) {
			// ITIL上报
			itil_report(635207);
			if (1 != $orderDb->getAffectedRows()) {
				self::$errCode = -2013;
				self::$errMsg = "用户对应订单不存在(" . $data['order_char_id'] . ") blongs to user" . $data['uid']. $orderDb->errMsg;  
				Logger::err(self::$errMsg);
			}
			else
			{
				self::$errCode = $orderDb->errCode;
				self::$errMsg = $orderDb->errMsg;
				Logger::err(self::$errMsg);
			}
			/*$sql = "rollback"; 
			$orderDb->execSql($sql); */
			return false;
		} 
		
		$order['payTime'] = $now;
		$order['status'] = VP_STATUS_USERPAID;
		$order['payFlow'] = $payFlow;
		$order['hasPaidMoney'] = $order['payMoney'];
		unset($order['hw_id']);
		unset($order['pay_type']);
		
		
		//插入erp数据库
		$erpDb = ToolUtil::getMSDBObj(self::$ERPSoDBName);
		if(false === $erpDb->insert(self::$tableName,$order))
		{
			// ITIL上报
			itil_report(635205);
			self::$errCode = -4002;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "insert ERPOrderDB failed". $erpDb->errMsg;
			Logger::err(self::$errMsg);
			/*$sql = "rollback"; 
			$orderDb->execSql($sql);*/ 
			//return  false;			
		}		
		
		if(false === self::_updateERP($order))
		{
			// ITIL上报
			itil_report(635205); 
			/*$sql = "rollback"; 
			$orderDb->execSql($sql); */
			//return false;
		}
	
		/*$sql = "commit";
		$orderDb->execSql($sql);   */
		  
		//调用接口向拍拍发送下单请求,并更新状态 
		$ret = self::sendOrderToPaiPai($order); 
		return true;
	}
	 
	//生成cmdid
	/*
	 *例如：http://api.paipai.com/item/addItem.xhtml，其requestURLPath="/item/addItem.xhtml "，对应的cmdid="item.addItem"。
	 *又如：http://api.paipai.com/deal/getDeal.xhtml，其requestURLPath="/deal/getDeal.xhtml "，对应的cmdid="deal.getDeal"。
	*/
	static public function _paipaiCreateCmdid($requestURLPath)
	{	
		if(strlen($requestURLPath)==0)return false;
		if($requestURLPath{0} != '/')return false;
		if(strpos($requestURLPath,'/')===false)return false;
		if(strpos($requestURLPath,'.')===false)return false;
		$pos_start = 1;
		$pos_end = strpos($requestURLPath,'.');
		$cmd = substr($requestURLPath,$pos_start,$pos_end-1);
		$cmd = str_replace('/','.',$cmd);
		return $cmd;
		
	} 
	 
	/**
	 * 生成签名
	 * @param $paramArr：api参数数组
	 * @return $sign
	 */
	static private function _paipaiCreateSign ($paramArr,$cmdid='') {
		ksort($paramArr);
		$sign = $cmdid;
		foreach ($paramArr as $key => $val) {
			if ($key !='' && $val !='') {
				$sign .= $key.$val;
			}
		}
		$sign .= VP_PAIPAI_SECRETKEY;
		$sign = md5($sign);
		return $sign;
	}
	
	/**
	 * 生成字符串参数 
	 * @param $paramArr：api参数数组
	 * @return $strParam
	 */
	static private function _paipaiCreateStrParam ($paramArr) {
		$strParam = '';
		foreach ($paramArr as $key => $val) {
			if ($key != '' && $val !='') {
				$strParam .= $key.'='.urlencode($val).'&';
			}
		}
		return $strParam;
	}
	
	/*
		向拍拍发送下订单请求
	*/
	public static function sendOrderToPaiPai(&$data)
	{   
		// ITIL上报
		itil_report(635194);
		$requestURLPath = VP_PAIPAI_MOBILE_SUBMIT_URL;
		
		$paipaiParamArr = array(
			'uin' => VP_PAIPAI_UID,
			'token' => VP_PAIPAI_TOKEN,
			'spid' => VP_PAIPAI_SPID,
		);

        //增加来源分区
        $vb2ctag = '';
        $order_char_id = $data['order_char_id'];
        $result = self::getSalesmanByOrderid($order_char_id);
        if(($result['salesman']==999999) || ($result['salesman']==999998))
        {
            $vb2ctag = '4_2018_3_945_60';
        }elseif(($result['salesman']==888888) || ($result['salesman']==888886)){
            $vb2ctag = '4_2017_3_944_60';
        }else{
            $vb2ctag = '3_1007_1_162_18';
        }
		//API用户参数
		$userParamArr = array(
			'amount' => $data['chargeMoney'], 
			'format' => 'json', 
			'mobile' => $data['targetId'], 
			'mobileArea' => $data['area'], 
			'mobileProvider' => $data['operator'],
			'pureData' => '1', 
			'spDealId' => $data['order_char_id'],
            		'vb2ctag'  => $vb2ctag
		);

		//总参数数组
		$paramArr = $paipaiParamArr + $userParamArr; 
		
		//组织参数
		$cmdid = self::_paipaiCreateCmdid($requestURLPath);
		if(false === $cmdid)
		{
			self::$errCode = -4000;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "get Url Cmd id error "; 
			Logger::err(self::$errMsg);
			return false;		
		}
		$sign = self::_paipaiCreateSign($paramArr,$cmdid);
		$strParam = self::_paipaiCreateStrParam($paramArr);
		$strParam .= 'sign='.$sign;
		$strParam = VP_PAIPAI_API_URL .$requestURLPath.'?'.$strParam;


///写订单流水日志，上线后删除		
self::_setVritualPayFlow($strParam);
//写订单流水日志，上线后删除					 
				 
		$res = NetUtil:: cURLHTTPGet($strParam, 15); 
		if (false === $res) {
			self::setOrderSysFlag($data['uid'],$data['order_char_id'],$data['synFlag']);
			self::$errCode =NetUtil::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "send mobile request to paipai error " . NetUtil::$errMsg; 
			Logger::err(self::$errMsg);
			return false; 
		} 
		else
		{
			self::setOrderSysFlag($data['uid'],$data['order_char_id'],$data['synFlag'],true);		
		}		
/*写订单流水日志，上线后删除*/		
self::_setVritualPayFlow($res);
/*写订单流水日志，上线后删除*/	
		//拍拍api平台bug，不能返回正确的json数组，需要去除末尾逗号后解析
		$resNow = str_replace(",
}", "}", $res); 	
		if($resNow == $res)
		{ 
			$resNow = str_replace(",\n}", "}", $res);
			if($resNow == $res)
			{
				$lastPos = strrpos($res,","); 
				$resNow = substr_replace($res,"",$lastPos,1);
			}
		}
		$res = $resNow;

		$res = ToolUtil::gbJsonDecode($res);
		$res['order_char_id'] = $data['order_char_id'];
		$res['uid'] = $data['uid'];
		$res['mobile'] = $data['targetId'];
		$res['dealId'] = isset($res['dealId'])?$res['dealId']:0;		 
		
/*写订单流水日志，上线后删除*/		
self::_setVritualPayFlow($res);
/*写订单流水日志，上线后删除*/				
		
		if(false === self::getChargeStatus($res))
		{		
			self::$errCode = -4000;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "getChargeStatus error " . self::$errMsg; 
			Logger::err(self::$errMsg);
			return false;
		}
		return true;
	}
	
	/*
	
	向拍拍发送查询订单请求
	
	*/	
	public static function queryOrderToPaiPai(&$data)
	{   
		// ITIL上报
		itil_report(635195);

		$requestURLPath = VP_PAIPAI_MOBILE_QUERY_URL;
		
		$paipaiParamArr = array(
			'uin' => VP_PAIPAI_UID,
			'token' => VP_PAIPAI_TOKEN,
			'spid' => VP_PAIPAI_SPID,
		);

		//API用户参数
		$userParamArr = array(
			'format' => 'json', 
			'pureData' => '1', 
			'spDealId' => $data['order_char_id']
		); 

		//总参数数组
		$paramArr = $paipaiParamArr + $userParamArr; 
		
		//组织参数
		$cmdid = self::_paipaiCreateCmdid($requestURLPath);
		if(false === $cmdid)
		{
			self::$errCode = -4000;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "get Url Cmd id error "; 
			Logger::err(self::$errMsg);
			return false;		
		}
		$sign = self::_paipaiCreateSign($paramArr,$cmdid);
		$strParam = self::_paipaiCreateStrParam($paramArr);
		$strParam .= 'sign='.$sign;
		$strParam = VP_PAIPAI_API_URL .$requestURLPath.'?'.$strParam;
		 
///写订单流水日志，上线后删除		
self::_setVritualPayFlow($strParam);
//写订单流水日志，上线后删除	
		$res = NetUtil:: cURLHTTPGet($strParam, 15);  
		if (false === $res) {
			self::setOrderSysFlag($data['uid'],$data['order_char_id'],$data['synFlag']);
			self::$errCode =NetUtil::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "send mobile request to paipai error " . NetUtil::$errMsg; 
			Logger::err(self::$errMsg);
			return false; 
		}
		else
		{
			self::setOrderSysFlag($data['uid'],$data['order_char_id'],$data['synFlag'],true);		
		}  
///写订单流水日志，上线后删除		
self::_setVritualPayFlow($res);
//写订单流水日志，上线后删除	
		//拍拍api平台bug，不能返回正确的json数组，需要去除末尾逗号后解析
		$resNow = str_replace(",
}", "}", $res); 	
		if($resNow == $res)
		{ 
			$resNow = str_replace(",\n}", "}", $res);
		}
		$res = $resNow;
		
///写订单流水日志，上线后删除		
self::_setVritualPayFlow($res);
//写订单流水日志，上线后删除	
		$res = ToolUtil::gbJsonDecode($res);
		$res['order_char_id'] = $data['order_char_id'];
		$res['uid'] = $data['uid'];
		$res['mobile'] = $data['targetId'];
		$res['dealId'] = isset($res['dealId'])?$res['dealId']:0;
		 
		
/*写订单流水日志，上线后删除*/		
self::_setVritualPayFlow($res);
/*写订单流水日志，上线后删除*/	
		if(false === self::getChargeStatus($res)) 
		{		
			self::$errCode = -4000;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "getChargeStatus error " . self::$errMsg;
			Logger::err(self::$errMsg); 
			return false;
		}
		return true;
	}
	
	/**
	 * 拍拍充值易迅账户扣款失败
	 *  
	 */
	public static function setIcsonPayFail(&$data)
	{//对应 VP_STATUS_ICSONPAY_FAIL 更新状态表 是否需要报警
		// ITIL上报
		itil_report(635196);
		 
		//报警 易迅账户加钱? 
		//通知成功返回
		if (!isset($data['order_char_id'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_char_id is empty";
			Logger::err(self::$errMsg);
			return false;
		}	
		if (!isset($data['uid'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid is empty";
			Logger::err(self::$errMsg);
			return false;
		}
		if (!isset($data['mobile'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "mobile is empty";
			Logger::err(self::$errMsg);
			return false;
		}
		if (!isset($data['dealId'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "dealId is empty";
			Logger::err(self::$errMsg);
			return false;
		}
		$orderDb = ToolUtil::getMSDBObj(self::$dbName);
		if (empty($orderDb)) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $orderDb->errMsg;  
			Logger::err(self::$errMsg);
			return  false;
		}   
		$now = time();
		$order_char_id = $data['order_char_id'];
		$uid = $data['uid'];
		
		//先查询状态是否已经更新,如果未更新直接退出
		$sql = 'SELECT [orderId]
					  ,[order_char_id]
					  ,[uid] 
					  ,[orderFlow] 
					  ,[status] FROM ' . self::$tableName . ' WHERE uid=' . $data['uid'] . ' and order_char_id=\'' . $data['order_char_id'] . '\'';		
		$orders = $orderDb->getRows($sql);		
		
		if (false === $orders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $orderDb->errMsg; 
			Logger::err(self::$errMsg);
			return false;
		}

		if (0 >= count($orders)) {
			self::$errCode = -4002;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "no such orders"; 
			Logger::err(self::$errMsg);
			return false;
		}
		$order = $orders[0];
		
		if(VP_STATUS_ICSONPAY_FAIL == $order['status'])
		{
			if($data['dealId'] != $order['orderFlow'])
			{
				self::$errCode = -1009;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " 拍拍订单号错误";
				Logger::err(self::$errMsg); 
				return false;					
			}
			else
			{ 
				//状态和数据已更新,无需再次更新
				return true;			
			}		
		}
		
		//起事务，更新数据库
		$sql = "begin transaction";
		$ret = $orderDb->execSql($sql);
		if (false === $ret) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg='开启virtualPay orderdb事务失败'  . $orderDb->errMsg;
			Logger::err(self::$errMsg);
			return  false;
		}
		
		
		$now = time();
        
        $sql = 'update ' . self::$tableName . ' set 
						status=' . VP_STATUS_ICSONPAY_FAIL . ', 
						orderFlow=' . $data['dealId'] . ',
						icsonPayTime=' . $now . ' 
						where uid=' . $data['uid'] . ' and order_char_id=\'' . $data['order_char_id'] . '\'';
        $ret = $orderDb->execSql($sql); 
		if (false === $ret || $orderDb->getAffectedRows() != 1) {
			if (1 != $orderDb->getAffectedRows()) {
				self::$errCode = -2013;
				self::$errMsg = "用户对应订单不存在(" . $data['order_char_id'] . ") blongs to user" . $data['uid']; 
				Logger::err(self::$errMsg); 
			}
			else
			{
				self::$errCode = $orderDb->errCode;
				self::$errMsg = $orderDb->errMsg;
				Logger::err(self::$errMsg);
			}
			$sql = "rollback"; 
			$orderDb->execSql($sql); 
			return false;
		} 
		
		$order['orderFlow'] = $data['dealId'];
		$order['icsonPayTime'] = $now;
		$order['status'] = VP_STATUS_ICSONPAY_FAIL;
		 
		$erpData = array(					
			'SOSysNo' => $order['orderId'],
			'TradeTime' => $now,
			'TradeAmt' => $data['payFee'],
			'PaiPaiNo' => $data['dealId'],
			'VirtualStatus' => VP_STATUS_ICSONPAY_FAIL 
		);
		
		if(false === self::_updateERP($order,$erpData))
		{ 
			// ITIL上报
			itil_report(635205);
			$sql = "rollback"; 
			$orderDb->execSql($sql); 
			return false;
		}
	
		$sql = "commit";
		$orderDb->execSql($sql);  
		return true; 
	}	
	
	/**
	 * 拍拍向易迅账户退款成功
	 *  
	 */
	public static function setIcsonRefundSuccess(&$data)
	{
		// ITIL上报
		itil_report(635197);
		
		//对应 VP_STATUS_ICSONPAY_REFUND_SUCCESS 写入退款时间 状态 更新订单状态，退款时间，向财务更新，向erp更新
		if (!isset($data['order_char_id'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_char_id is empty";
			Logger::err(self::$errMsg);
			return false;
		}	
		if (!isset($data['uid'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid is empty";
			Logger::err(self::$errMsg);
			return false;
		}
		if (!isset($data['mobile'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "mobile is empty";
			Logger::err(self::$errMsg);
			return false;
		}
		if (!isset($data['dealId'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "dealId is empty";
			Logger::err(self::$errMsg);
			return false;
		}
		$orderDb = ToolUtil::getMSDBObj(self::$dbName);
		if (empty($orderDb)) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $orderDb->errMsg; 
			Logger::err(self::$errMsg); 
			return  false;
		}   
		$now = time();
		
		$data['dealPayTime'] = strtotime($data['dealPayTime']); 		
		$data['dealSuccessTime'] = strtotime($data['dealSuccessTime']); 

		
		//先查询状态是否已经更新,如果未更新直接退出
		$sql = 'SELECT [orderId]
					  ,[order_char_id]
					  ,[uid] 
					  ,[orderFlow] 
					  ,[status] FROM ' . self::$tableName . ' WHERE uid=' . $data['uid'] . ' and order_char_id=\'' . $data['order_char_id'] . '\'';		
		$orders = $orderDb->getRows($sql);		
		
		if (false === $orders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $orderDb->errMsg; 
			Logger::err(self::$errMsg);
			return false;
		}

		if (0 >= count($orders)) {
			self::$errCode = -4002;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "no such orders"; 
			Logger::err(self::$errMsg);
			return false;
		}
		$order = &$orders[0];
		
		if(VP_STATUS_ICSONPAY_REFUND_SUCCESS == $order['status'])
		{
			if($data['dealId'] != $order['orderFlow'])
			{
				self::$errCode = -1009;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " 拍拍订单号错误"; 
				Logger::err(self::$errMsg);
				return false;					
			}
			else
			{  
				//状态和数据已更新,无需再次更新
				return true;			
			}		
		}

		
		//起事务，更新数据库
		$sql = "begin transaction";
		$ret = $orderDb->execSql($sql);
		if (false === $ret) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg='开启virtualPay orderdb事务失败'  . $orderDb->errMsg;
			Logger::err(self::$errMsg);
			return  false;
		}
        
        $sql = 'update ' . self::$tableName . ' set 
						status=' . VP_STATUS_ICSONPAY_REFUND_SUCCESS . ', 
						orderFlow=' . $data['dealId'] . ' , 
						icsonPayTime=' . $data['dealPayTime'] . ',
						successTime=' . $data['dealSuccessTime'] . ',
						refuncTime=' . $now . ' ,
						icsonPaidMoney=' . $data['payFee'] . '  
						where uid=' . $data['uid'] . ' and order_char_id=\'' . $data['order_char_id'] . '\'';
        $ret = $orderDb->execSql($sql); 
		if (false === $ret || $orderDb->getAffectedRows() != 1) {
			if (1 != $orderDb->getAffectedRows()) {
				self::$errCode = -2013;
				self::$errMsg = "用户对应订单不存在(" . $data['order_char_id'] . ") blongs to user" . $data['uid']; 
				Logger::err(self::$errMsg); 
			}
			else
			{
				self::$errCode = $orderDb->errCode;
				self::$errMsg = $orderDb->errMsg;
				Logger::err(self::$errMsg);
			}
			$sql = "rollback"; 
			$orderDb->execSql($sql); 
			return false;
		} 
		
		
		$order['status'] = VP_STATUS_ICSONPAY_REFUND_SUCCESS; 
		$order['orderFlow'] = $data['dealId'];
		$order['icsonPayTime'] = $data['dealPayTime'];
		$order['successTime'] = $data['dealSuccessTime'];
		$order['refuncTime'] = $now;
		$order['icsonPaidMoney'] = $data['payFee'];
		
		$erpData = array(		
			'SOSysNo' => $order['orderId'],
			'TradeTime' => time(),
			'TradeAmt' => $data['payFee'],
			'PaiPaiNo' => $data['dealId'],
			'VirtualStatus' => VP_STATUS_ICSONPAY_REFUND_SUCCESS
		);
		
		if(false === self::_updateERP($order,$erpData))
		{ 
			// ITIL上报
			itil_report(635205);
			$sql = "rollback"; 
			$orderDb->execSql($sql); 
			return false;
		}
	
		$sql = "commit";
		$orderDb->execSql($sql);   
		return true;		
	}

	
	/**
	 * 易迅向用户退款成功
	 *  
	 */
	public static function setUserRefundSuccess(&$data)
	{ 
		// ITIL上报
		itil_report(635198);
		
		if (!isset($data['order_char_id'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_char_id is empty";
			Logger::err(self::$errMsg);
			return false;
		}	
		if (!isset($data['uid'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid is empty";
			Logger::err(self::$errMsg);
			return false;
		}
		$orderDb = ToolUtil::getMSDBObj(self::$dbName);
		if (empty($orderDb)) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $orderDb->errMsg;  
			Logger::err(self::$errMsg);
			return  false;
		}   
		$now = time();

		//先查询状态是否已经更新,如果未更新直接退出
		$sql = 'SELECT [order_char_id]
					  ,[uid] 
					  ,[orderFlow] 
					  ,[status] FROM ' . self::$tableName . ' WHERE uid=' . $data['uid'] . ' and order_char_id=\'' . $data['order_char_id'] . '\'';		
		$orders = $orderDb->getRows($sql);		
		
		if (false === $orders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $orderDb->errMsg; 
			Logger::err(self::$errMsg);
			return false;
		}

		if (0 >= count($orders)) {
			self::$errCode = -4002;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "no such orders"; 
			Logger::err(self::$errMsg);
			return false;
		}
		$order = &$orders[0];
		
				
		if(VP_STATUS_USER_REFUND_SUCCESS == $order['status'])
		{ 
			//状态和数据已更新,无需再次更新
			return true; 
		}
		
        $sql = 'update ' . self::$tableName . ' set 
						status=' . VP_STATUS_USER_REFUND_SUCCESS . ' 
						where uid=' . $data['uid'] . ' and order_char_id=\'' . $data['order_char_id'] . '\'';
        $ret = $orderDb->execSql($sql);
        if (false === $ret) {
                self::$errCode = $orderDb->errCode;
                self::$errMsg = $orderDb->errMsg; 
				Logger::err(self::$errMsg);
                return false;
        }

        if (1 != $orderDb->getAffectedRows()) {
                self::$errCode = -2013;
                self::$errMsg = "用户对应订单不存在(" . $data['order_char_id'] . ") blongs to user" . $data['uid']; 
				Logger::err(self::$errMsg);
                return false;
        }
		return true;		
	}
	/**
	 * 拍拍充值易迅账户扣款成功
	 *  
	 */
	public static function setIcsonPaySuccess(&$data)
	{//对应 VP_STATUS_ICSONPAY_SUCCESS 更新状态表
		// ITIL上报
		itil_report(635199);
		
		if (!isset($data['order_char_id'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_char_id is empty";
			Logger::err(self::$errMsg);
			return false;
		}	
		if (!isset($data['uid'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid is empty";
			Logger::err(self::$errMsg);
			return false;
		}
		if (!isset($data['mobile'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "mobile is empty";
			Logger::err(self::$errMsg);
			return false;
		}
		if (!isset($data['dealId'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "dealId is empty";
			Logger::err(self::$errMsg);
			return false;
		}
		$orderDb = ToolUtil::getMSDBObj(self::$dbName);
		if (empty($orderDb)) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $orderDb->errMsg;  
			Logger::err(self::$errMsg);
			return  false;
		}   
		$data['dealPayTime'] = strtotime($data['dealPayTime']); 


		//先查询状态是否已经更新,如果未更新直接退出
		$sql = 'SELECT [order_char_id]
					  ,[uid] 
					  ,[orderFlow] 
					  ,[icsonPaidMoney] 
					  ,[status] FROM ' . self::$tableName . ' WHERE uid=' . $data['uid'] . ' and order_char_id=\'' . $data['order_char_id'] . '\'';		
		$orders = $orderDb->getRows($sql);		
		
		if (false === $orders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $orderDb->errMsg; 
			Logger::err(self::$errMsg);
			return false;
		}

		if (0 >= count($orders)) {
			self::$errCode = -4002;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "no such orders"; 
			Logger::err(self::$errMsg);
			return false;
		}
		$order = &$orders[0];
		
		if(VP_STATUS_ICSONPAY_SUCCESS == $order['status'])
		{
			if($data['dealId'] != $order['orderFlow'])
			{
				self::$errCode = -1009;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " 拍拍订单号错误"; 
				Logger::err(self::$errMsg);
				return false;					
			}
			else
			{  
				//状态和数据已更新,无需再次更新
				return true;			
			}		
		} 
		
        $sql = 'update ' . self::$tableName . ' set 
						status=' . VP_STATUS_ICSONPAY_SUCCESS . ', 
						orderFlow=' . $data['dealId'] . ',
						icsonPayTime=' . $data['dealPayTime'] . ',
						icsonPaidMoney=' . $data['payFee'] . '  
						where uid=' . $data['uid'] . ' and order_char_id=\'' . $data['order_char_id'] . '\'';
        $ret = $orderDb->execSql($sql);
        if (false === $ret) {
                self::$errCode = $orderDb->errCode;
                self::$errMsg = $orderDb->errMsg; 
				Logger::err(self::$errMsg);
                return false;
        } 

        if (1 != $orderDb->getAffectedRows()) {
                self::$errCode = -2013;
                self::$errMsg = "用户对应订单不存在(" . $data['order_char_id'] . ") blongs to user" . $data['uid']; 
				Logger::err(self::$errMsg);
                return false;
        }
		return true;		
	}	
	
	/**
	 * 充值成功，修改充值成功状态
	 *  
	 */
	public static function setChargeSuccess(&$data)
	{//对应 VP_STATUS_ICSONPAY_SUCCESS 更新状态表  
		// ITIL上报
		itil_report(635200);
		
		if (!isset($data['order_char_id'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_char_id is empty";
			Logger::err(self::$errMsg);
			return false;
		}	
		if (!isset($data['uid'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid is empty";
			Logger::err(self::$errMsg);
			return false;
		}
		if (!isset($data['mobile'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "mobile is empty";
			Logger::err(self::$errMsg);
			return false;
		}
		if (!isset($data['dealId'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "dealId is empty";
			Logger::err(self::$errMsg);
			return false;
		}
		if (!isset($data['dealPayTime'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "dealPayTime is empty";
			Logger::err(self::$errMsg);
			return false;
		}
		if (!isset($data['dealSuccessTime'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "dealSuccessTime is empty";
			Logger::err(self::$errMsg);
			return false;
		}
		$orderDb = ToolUtil::getMSDBObj(self::$dbName);
		if (empty($orderDb)) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $orderDb->errMsg;  
			Logger::err(self::$errMsg);
			return  false;
		}    
 
		$data['dealPayTime'] = strtotime($data['dealPayTime']); 		
		$data['dealSuccessTime'] = strtotime($data['dealSuccessTime']); 

		
		//先查询状态是否已经更新,如果未更新直接退出
		$sql = 'SELECT [orderId]
					  ,[order_char_id]
					  ,[uid] 
					  ,[orderFlow]
					  ,[icsonPaidMoney] 
					  ,[status] FROM ' . self::$tableName . ' WHERE uid=' . $data['uid'] . ' and order_char_id=\'' . $data['order_char_id'] . '\'';		
		$orders = $orderDb->getRows($sql);		
		
		if (false === $orders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $orderDb->errMsg; 
			Logger::err(self::$errMsg);
			return false;
		}

		if (0 >= count($orders)) {
			self::$errCode = -4002;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "no such orders"; 
			Logger::err(self::$errMsg);
			return false;
		}
		$order = &$orders[0]; 
				
		if(VP_PAIPAI_STATUS_CHARGE_SUCCESS == $order['status'])
		{
			if($data['dealId'] != $order['orderFlow'])
			{
				self::$errCode = -1009;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " 拍拍订单号错误"; 
				Logger::err(self::$errMsg);
				return false;					
			}
			else
			{ 
				//状态和数据已更新,无需再次更新
				return true;			
			}		
		}
		
		//起事务，更新数据库
		$sql = "begin transaction";
		$ret = $orderDb->execSql($sql);
		if (false === $ret) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg='开启virtualPay orderdb事务失败'  . $orderDb->errMsg;
			Logger::err(self::$errMsg);
			return  false;
		}
         
        $sql = 'update ' . self::$tableName . ' set 
						status=' . VP_PAIPAI_STATUS_CHARGE_SUCCESS . ', 
						orderFlow=' . $data['dealId'] . ',
						icsonPayTime=' . $data['dealPayTime'] . ',
						successTime=' . $data['dealSuccessTime'] . ',
						icsonPaidMoney=' . $data['payFee'] . '  
						where uid=' . $data['uid'] . ' and order_char_id=\'' . $data['order_char_id'] . '\'';
		$ret = $orderDb->execSql($sql);						
		if (false === $ret || $orderDb->getAffectedRows() != 1) {
			if (1 != $orderDb->getAffectedRows()) {
				self::$errCode = -2013;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "用户对应订单不存在(" . $data['order_char_id'] . ") blongs to user" . $data['uid'] . $orderDb->errMsg;   
				Logger::err(self::$errMsg);
			}
			else
			{
				self::$errCode = $orderDb->errCode;
				self::$errMsg = $orderDb->errMsg;
				Logger::err(self::$errMsg);
			} 
			$sql = "rollback"; 
			$orderDb->execSql($sql); 
			return false;
		}  
		
		$order['status'] = VP_PAIPAI_STATUS_CHARGE_SUCCESS; 
		$order['orderFlow'] = $data['dealId'];
		$order['icsonPayTime'] = $data['dealPayTime'];
		$order['successTime'] = $data['dealSuccessTime']; 
		$order['icsonPaidMoney'] = $data['payFee'];
		
		$erpData = array(		
			'SOSysNo' => $order['orderId'],
			'TradeTime' => $data['dealSuccessTime'],
			'TradeAmt' => $data['payFee'],
			'PaiPaiNo' => $data['dealId'],
			'VirtualStatus' => VP_PAIPAI_STATUS_CHARGE_SUCCESS
		);
		
		if(false === self::_updateERP($order,$erpData))
		{ 
			// ITIL上报
			itil_report(635205);
			$sql = "rollback"; 
			$orderDb->execSql($sql); 
			return false;
		}
	
		$sql = "commit";
		$orderDb->execSql($sql);   
		return true;	
	}	
	/**
	 * 拍拍充值易迅账户扣款失败
	 *  
	 */
	public static function setUserOnCharge(&$data)
	{//订单发货中(说明:支付成功，正在发货)  
     //对应 VP_STATUS_ONCHARGE 更新订单状态 
		// ITIL上报
		itil_report(635201);
		
		if (!isset($data['order_char_id'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_char_id is empty";
			Logger::err(self::$errMsg);
			return false;
		}	
		if (!isset($data['uid'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid is empty";
			Logger::err(self::$errMsg);
			return false;
		}
		if (!isset($data['mobile'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "mobile is empty";
			Logger::err(self::$errMsg);
			return false;
		}
		if (!isset($data['dealPayTime'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "dealPayTime is empty";
			Logger::err(self::$errMsg);
			return false;
		} 
		$data['dealPayTime'] = strtotime($data['dealPayTime']);
		$orderDb = ToolUtil::getMSDBObj(self::$dbName);
		if (empty($orderDb)) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $orderDb->errMsg;  
			Logger::err(self::$errMsg);
			return  false;
		}   
		
		//先查询状态是否已经更新,如果未更新直接退出
		$sql = 'SELECT [order_char_id]
					  ,[uid] 
					  ,[orderFlow] 
					  ,[status] FROM ' . self::$tableName . ' WHERE uid=' . $data['uid'] . ' and order_char_id=\'' . $data['order_char_id'] . '\'';		
		$orders = $orderDb->getRows($sql);		
		
		if (false === $orders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $orderDb->errMsg; 
			Logger::err(self::$errMsg);
			return false;
		}

		if (0 >= count($orders)) {
			self::$errCode = -4002;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "no such orders"; 
			Logger::err(self::$errMsg);
			return false;
		}
		$order = &$orders[0];
				
		if(VP_STATUS_ONCHARGE == $order['status'])
		{
			if($data['dealId'] != $order['orderFlow'])
			{
				self::$errCode = -1009;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " 拍拍订单号错误"; 
				Logger::err(self::$errMsg);
				return false;					
			}
			else
			{ 
				//状态和数据已更新,无需再次更新
				return true;			
			}		
		}

        $sql = 'update ' . self::$tableName . ' set 
						status=' . VP_STATUS_ONCHARGE . ',
						icsonPayTime=' . $data['dealPayTime'] . ', 
						orderFlow=' . $data['dealId'] . ' ,
						icsonPaidMoney=' . $data['payFee'] . '  
						where uid=' . $data['uid'] . ' and order_char_id=\'' . $data['order_char_id'] . '\'';
        $ret = $orderDb->execSql($sql);
        if (false === $ret) {
                self::$errCode = $orderDb->errCode;
                self::$errMsg = $orderDb->errMsg; 
                return false;
        }

        if (1 != $orderDb->getAffectedRows()) {
                self::$errCode = -2013;
                self::$errMsg = "用户对应订单不存在(" . $data['order_char_id'] . ") blongs to user" . $data['uid']; 
				Logger::err(self::$errMsg);
                return false;
        }
		return true;		
	}		
	
	/**
	 * 用户账户充值失败，退款中
	 *  
	 */
	public static function setUserChargeFail(&$data)
	{	//订单退款中(说明:支付成功，充值失败) 
		//对应 VP_STATUS_CHARGE_FAIL VP_STATUS_ICSONPAY_REFUND 写入失败时间 状态
		// ITIL上报
		itil_report(635202);
		
		if (!isset($data['order_char_id'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_char_id is empty";
			Logger::err(self::$errMsg);
			return false;
		}	
		if (!isset($data['uid'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid is empty";
			Logger::err(self::$errMsg);
			return false;
		}
		if (!isset($data['mobile'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "mobile is empty";
			Logger::err(self::$errMsg);
			return false;
		}
		if (!isset($data['dealPayTime'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "paipai dealPayTime is null";
			Logger::err(self::$errMsg);
			return false;
		}
		if (!isset($data['payFee'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "paipai payFee is null";
			Logger::err(self::$errMsg);
			return false;
		} 
		if (!isset($data['dealSuccessTime'])) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "paipai dealFailTime is null";
			Logger::err(self::$errMsg);
			return false;
		} 
		$data['dealPayTime'] = strtotime($data['dealPayTime']);
		$data['dealSuccessTime'] = strtotime($data['dealSuccessTime']);
		$orderDb = ToolUtil::getMSDBObj(self::$dbName);
		if (empty($orderDb)) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $orderDb->errMsg;  
			Logger::err(self::$errMsg);
			return  false;
		}    

		//先查询状态是否已经更新,如果未更新直接退出
		$sql = 'SELECT [orderId]
					  ,[order_char_id]
					  ,[uid] 
					  ,[orderFlow] 
					  ,[status] FROM ' . self::$tableName . ' WHERE uid=' . $data['uid'] . ' and order_char_id=\'' . $data['order_char_id'] . '\'';		
		$orders = $orderDb->getRows($sql);		
		
		if (false === $orders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $orderDb->errMsg; 
			Logger::err(self::$errMsg);
			return false;
		}

		if (0 >= count($orders)) {
			self::$errCode = -4002;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "no such orders"; 
			Logger::err(self::$errMsg);
			return false;
		}
		$order = &$orders[0];
				
		if(VP_STATUS_CHARGE_FAIL == $order['status'])
		{
			if($data['dealId'] != $order['orderFlow'])
			{
				self::$errCode = -1009;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " 拍拍订单号错误"; 
				Logger::err(self::$errMsg);
				return false;					
			} 
			else
			{ 
				//状态和数据已更新,无需再次更新
				return true;			
			}		
		}
		
		
		//起事务，更新数据库
		$sql = "begin transaction";
		$ret = $orderDb->execSql($sql);
		if (false === $ret) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg='开启virtualPay orderdb事务失败'  . $orderDb->errMsg;
			Logger::err(self::$errMsg);
			return  false;
		}
        
        $sql = 'update ' . self::$tableName . ' set 
						status=' . VP_STATUS_CHARGE_FAIL . ',
						icsonPayTime=' . $data['dealPayTime'] . ',
						successTime=' . $data['dealSuccessTime'] . ', 
						orderFlow=' . $data['dealId'] . ' 
						where uid=' . $data['uid'] . ' and order_char_id=\'' . $data['order_char_id'] . '\'';
        $ret = $orderDb->execSql($sql); 
		if (false === $ret || $orderDb->getAffectedRows() != 1) {
			if (1 != $orderDb->getAffectedRows()) {
				self::$errCode = -2013;
				self::$errMsg = "用户对应订单不存在(" . $data['order_char_id'] . ") blongs to user" . $data['uid']; 
				Logger::err(self::$errMsg); 
			}
			else
			{
				self::$errCode = $orderDb->errCode;
				self::$errMsg = $orderDb->errMsg;
				Logger::err(self::$errMsg);
			}
			$sql = "rollback"; 
			$orderDb->execSql($sql); 
			return false;
		} 
				
		$order['status'] = VP_STATUS_CHARGE_FAIL; 
		$order['orderFlow'] = $data['dealId'];
		$order['icsonPayTime'] = $data['dealPayTime'];
		$order['successTime'] = $data['dealSuccessTime'];  
		
		$erpData = array(		
			'SOSysNo' => $order['orderId'],
			'TradeTime' => time(),
			'TradeAmt' => $data['payFee'],
			'PaiPaiNo' => $data['dealId'],
			'VirtualStatus' => VP_STATUS_CHARGE_FAIL
		);
		
		if(false === self::_updateERP($order,$erpData))
		{ 
			// ITIL上报
			itil_report(635205);
			$sql = "rollback"; 
			$orderDb->execSql($sql); 
			return false;
		}
	
		$sql = "commit";
		$orderDb->execSql($sql);  
		return true;  
	}	
	/**
	 * 用户支付完成后修改订单状态
	 *  
	 */
	public static function setOrderCharged($uid, $order_char_id, $card, $payFlow)
	{		
		// ITIL上报
		itil_report(635203);
		
		if (!isset($order_char_id) || $order_char_id == "") {
			self::$errCode = -2000;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "订单id为空";
			Logger::err(self::$errMsg);
			return false;
		}

		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -2001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "用户id为空";
			Logger::err(self::$errMsg);
			return false;
		}

		if (!isset($cash) || $cash <= 0) {
			self::$errCode = -2011;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "支付金额cash为空";
			Logger::err(self::$errMsg);
			return false;
		}
		
		if (!isset($payFlow)) {
			self::$errCode = -2012;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "支付流水号为空";
			Logger::err(self::$errMsg);
			return false;
		}
		$orderDb = ToolUtil::getMSDBObj(self::$dbName);
		if (empty($orderDb)) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $orderDb->errMsg;  
			Logger::err(self::$errMsg);
			return  false;
		}   
 
		$sql = 'SELECT [order_char_id]
					  ,[uid]
					  ,[payType] as pay_type
					  ,[type]
					  ,[wh_id] as hw_id
					  ,[chargeMoney]
					  ,[payMoney]
					  ,[hasPaidMoney]
					  ,[payTime]
					  ,[status] FROM ' . self::$tableName . ' WHERE [uid]=' . $uid . ' AND [order_char_id]=' . $order_char_id;
		$orders = $orderDb->getRows($sql);
		if (false === $orders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $orderDb->errMsg; 
			Logger::err(self::$errMsg);
			return false;
		}

		if (0 >= count($orders)) {
			self::$errCode = -4002;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " 订单号查找失败"; 
			Logger::err(self::$errMsg);
			return false;
		}
		$order = &$orders[0];

        if (bccomp($cash, $order['payMoney'], 0)) {
                self::$errCode = -1008;
                self::$errMsg = "用户支付 $cash 金额不等于应支付金额 ({$order['payMoney']})"; 
				Logger::err(self::$errMsg);
                return false;
        }

        if ($order['status'] != VP_STATUS_INIT) {
            return true;
        }

		$now = time();

        $sql = 'update ' . self::$tableName . ' set 
						status=' . VP_STATUS_USERPAID . ',
						payTime=' . $now . ',
						payFlow=\'' . $payFlow . '\',
						hasPaidMoney=' . $order['payMoney'] . ',
						synFlag=' . VP_ORDER_SYN_YES . ' 
						where uid=' . $uid . ' and order_char_id=\'' . $order_char_id . '\'';
        $ret = $orderDb->execSql($sql);
        if (false === $ret) {
                self::$errCode = $orderDb->errCode;
                self::$errMsg = $orderDb->errMsg; 
				Logger::err(self::$errMsg);
                return false;
        }

        if (1 != $orderDb->getAffectedRows()) {
                self::$errCode = -2013;
                self::$errMsg = "用户($uid)对应订单($order_char_id) 不存在";
				Logger::err(self::$errMsg); 
                return false;
        }
		
		return true;
	}
	
	
	/**
	 * 更新订单同步次数
	 * 
	 * @param clear    是false同步次数加一，true清除同步标志，false加一
	 */
	public static function setOrderSysFlag($uid, $order_char_id,$nowSysNo,$clear = false)
	{	
		// ITIL上报
		itil_report(635204);
		 
		if($clear && $nowSysNo <= VP_ORDER_SYN_YES)
		{//不更新同步标志位
			return true;
		}
		else
		{ 
			$orderDb = ToolUtil::getMSDBObj(self::$dbName);
			if (empty($orderDb)) {
				self::$errCode = $orderDb->errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $orderDb->errMsg; 
				Logger::err(self::$errMsg); 
				return  false;
			}   
			if($clear)
			{//清除同步标志位
				$sql = 'update ' . self::$tableName . ' set 
							synFlag=' . VP_ORDER_SYN_NO . ' 
							where uid=' . $uid . ' and order_char_id=\'' . $order_char_id . '\''; 
				$ret = $orderDb->execSql($sql);		
				if (false === $ret) {
						self::$errCode = $orderDb->errCode;
						self::$errMsg = $orderDb->errMsg; 
						Logger::err(self::$errMsg);
						return false;
				}
			}
			else
			{//先查询同步次数是否超过上限，如果超过则报警   
				++$nowSysNo;
				if(VP_ORDER_SYN_ALERT_LIMIT <= $nowSysNo)
				{ 
					$message = 'VritualPay orderId:' . $order_char_id . ' uid:' . $uid . ' ' . self::$errMsg;
					$ret = IMessage::sendSMSMessage(VP_DEV_MOBILE,$message);
					if(false === $ret)
					{ 
						$logger = new Logger('sysVirtualPayFlow');
						$logger->err('send message failed: ' . $message); 
					}
					return true;
				}
				else
				{
					$sql = 'update ' . self::$tableName . ' set 
							synFlag=synFlag+1  
							where uid=' . $uid . ' and order_char_id=\'' . $order_char_id . '\''; 
					$ret = $orderDb->execSql($sql);		
					if (false === $ret) {
							self::$errCode = $orderDb->errCode;
							self::$errMsg = $orderDb->errMsg; 
							return false;
					}
				}						
			}
		}
		return true;
	}
	
	/**
	 * 同步erp订单数据表，同步流水表
	 *  
	 */
	private static function _updateERP($virtualPayOrder,$flowData=false)
	{	 	
		$erpDb = ToolUtil::getMSDBObj(self::$ERPSoDBName);
		//起事务，更新数据库
		$sql = "begin transaction";
		$ret = $erpDb->execSql($sql);
		if (false === $ret) {
			self::$errCode = $erpDb->errCode;
			self::$errMsg= basename(__FILE__, '.php') . " |" . __LINE__ . '开启erpDb事务失败'  . $erpDb->errMsg; 
			Logger::err(self::$errMsg);
			return  false;
		}

		$erpFinanceDb = ToolUtil::getMSDBObj(self::$ERPFinanceDBName);
		$ret = $erpFinanceDb->execSql($sql);
		if(false === $ret)
		{
			self::$errCode = $erpFinanceDb->errCode;
			self::$errMsg= basename(__FILE__, '.php') . " |" . __LINE__ . '开启erpFinanceDb事务失败'  . $erpFinanceDb->errMsg;
			$sql = "rollback";
			$erpDb->execSql($sql);
			Logger::err(self::$errMsg);
			return  false;
		}


        $ret = $erpDb->update(self::$tableName,$virtualPayOrder,' orderId=' . $virtualPayOrder['orderId']); 
		if (false === $ret || $erpDb->getAffectedRows() != 1) {
			if (1 != $erpDb->getAffectedRows()) { 
				self::$errCode = -2013;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "erpDB用户对应订单不存在(" . $virtualPayOrder['orderId'] . ") blongs to user" . $virtualPayOrder['uid'] . $erpDb->errMsg; 
				Logger::err(self::$errMsg); 
			}
			else
			{
				self::$errCode = $erpDb->errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $erpDb->errMsg;
				Logger::err(self::$errMsg);
			}
			$sql = "rollback"; 
			$erpDb->execSql($sql);
			$erpFinanceDb->execSql($sql);
			return false;
		} 	

		if($flowData != false)
		{						
			$sql = 'INSERT INTO ' . self::$ERPflowTableName . '
			   ([SOSysNo]
			   ,[TradeTime]
			   ,[TradeAmt]
			   ,[PaiPaiNo]
			   ,[VirtualStatus])
		 VALUES
			   (' . $flowData['SOSysNo'] . '
			   ,\'' . date('Y-m-d H:i:s',$flowData['TradeTime']) . '\'
			   ,\'' . $flowData['TradeAmt']/100 . '\'
			   ,\'' . $flowData['PaiPaiNo'] . '\'
			   ,\'' . $flowData['VirtualStatus'] . '\')';  
			if(false === $erpFinanceDb->execSql($sql))
			{
				self::$errCode = -4002;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "insert erpFinanceDb failed" . $erpFinanceDb->errMsg;
				Logger::err(self::$errMsg);
				$sql = "rollback"; 
				$erpDb->execSql($sql);
				$erpFinanceDb->execSql($sql);
				return  false;			
			} 
		}
		$sql = "commit";
		$erpDb->execSql($sql);
		$erpFinanceDb->execSql($sql);
		return true;
	}
	 
	/**
	 * 插入erp流水表 
	 *  
	 */
	private static function _insertERPFlow($data)
	{	 
		$erpDb = ToolUtil::getMSDBObj(self::$ERPFinanceDBName);
		if (empty($erpDb)) {
			// ITIL上报
			itil_report(635206);
			self::$errCode = $erpDb->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . $erpDb->errMsg; 
			Logger::err(self::$errMsg); 
			return  false;
		}   
				
		$sql = 'INSERT INTO ' . self::$ERPflowTableName . '
           ([SOSysNo]
           ,[TradeTime]
           ,[TradeAmt]
           ,[PaiPaiNo]
           ,[VirtualStatus])
     VALUES
           (' . $data['SOSysNo'] . '
           ,\'' . date('Y-m-d H:i:s',$data['TradeTime']) . '\'
           ,\'' . $data['TradeAmt']/100 . '\'
           ,\'' . $data['PaiPaiNo'] . '\'
           ,\'' . $data['VirtualStatus'] . '\')';  
		if(false === $erpDb->execSql($sql)) 
		{
			// ITIL上报
			itil_report(635206);
			self::$errCode = -4002;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "insert erpDb failed" . $erpDb->errMsg;   
			Logger::err(self::$errMsg); 
			return  false;			
		}
		return true;
	}
	
	/**
	 * 写入拍拍支付流水日志文件,上线后删除
	 *  
	 */
	public static function _setVritualPayFlow($data)
	{	/* 
		if(is_array($data))
		{ 
			$log = '';
			foreach($data as $k => $v)
			{
				$log .= ' (' . $k . ' ; ' . $v . ') ';
			}
			Logger::warn($log);		
		}
		else
		{
			Logger::warn($data);			
		}*/
	}
	/**
	 * 初始化数据库数据
	 *  
	 */ 
	public static function _initPriceDB()
	{    	 
		$priceDb = ToolUtil::getMSDBObj(self::$dbName);
		if (empty($priceDb)) {
			self::$errCode = -4000;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "get priceDb failed". $priceDb->errMsg; 
			Logger::err(self::$errMsg);  
			return  false;
		}  
		$sql = 'SELECT [productId]
				,[chargeMoney]
				,[payMoney]
				,[wh_id]
				,[operator]
				,[area]
				,[synTime]
				,[price_desc]
				FROM ' . self::$priceTableName . ' WHERE productId!=0 ';
		$prices = $priceDb->getRows($sql); 
		if(false === $prices)
		{
			self::$errCode = -4001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "select priceDb failed" . $priceDb->errMsg; 
			return  false;			
		}   	
		global $_VP_Card_Price;
		global $_VP_Card_Category;
		$sql = 'INSERT INTO t_virtualpay_price ([productId],[chargeMoney],[payMoney],[wh_id],[operator],[area],[synTime]) VALUES';
		$insertCount = 0;
		foreach($_VP_Card_Price as $ok => $ov)
		{
			foreach($ov as $ak => $av)
			{ 
				foreach($av as $ck => $cv)
				{	 
					$hasExist = false;
					foreach($prices as $k => $v)
					{ 
						if($v['operator'] == $ok && $v['area'] == $ak && $v['chargeMoney'] == ($k * 100))
						{
							$hasExist = true; 
						}
					}
					if(!$hasExist)
					{ 
						$insertCount++;
						if(!isset($_VP_Card_Price[$ok][$ak][$ck]) || $_VP_Card_Price[$ok][$ak][$ck] == '无货')
						{
							$tempSql = '( \'' . $_VP_Card_Category[$ck][1] . '\',\'' .  ($ck*100) . '\',\'无货\',\'1\',\'' . $ok . '\',\'' . $ak  . '\',\'' . time() . '\'),'; 
						}
						else
						{
							$priceTemp = $_VP_Card_Price[$ok][$ak][$ck]*100;
							if( $priceTemp == '0')
							{
								 $priceTemp = '无货';
							}
							$tempSql = '( \'' . $_VP_Card_Category[$ck][1] . '\',\'' .  ($ck*100) . '\',\'' . $priceTemp . '\',\'1\',\'' . $ok . '\',\'' . $ak  . '\',\'' . time() . '\'),'; 
						}
						$sql .= $tempSql;
					}  
				}
			}
		}  
		$sql = preg_replace( "/,$/", "", $sql );
		if($insertCount != 0)
		{
			if(false === $priceDb->execSql($sql))
			{
				self::$errCode = -4002;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "insert priceDB failed". $priceDb->errMsg;
				Logger::err(self::$errMsg);   
				return false;
			}			
		}
		return true;

	}  
} 
// ITIL上报函数
function itil_report($attId, $increase = 1){
    if(function_exists('exd_Attr_API2')){
        $dataTemp = exd_Attr_API2($attId, $increase);
        return ($dataTemp != 0 ) ? false : true;
    }
    return true;
}