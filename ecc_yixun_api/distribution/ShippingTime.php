<?php
require_once(PHPLIB_ROOT.'api/distribution/ShipConst.php');
require_once(PHPLIB_ROOT.'api/distribution/District.php');
require_once(PHPLIB_ROOT.'api/distribution/ShippingPrice.php');
/**
 * 封装送货时间的类
 */
class LIB_ShippingTime
{
	public static $errCode = 0;
	public static $errMsg = '';

	private static $timeSpan = array('1' => '上午', '2' => '下午', '3' => '晚上', '4' => "");
	private static $weekDays = array('1' => '星期一', '2' => '星期二', '3' => '星期三', '4' => '星期四', '5' => '星期五', '6' => '星期六', '7' => '星期日');

	// 时间状态标记
	CONST NORMAL = 0; // 正常的时间段
	CONST EXPIRE = -1; // 当天过期的时间段
	CONST LIMITED = -2; // 限单的时间段

	CONST ONE_DAY = 86400; // 24*60*60 每天的秒数
	CONST DAY_LIMIT = 7; // 生成7天的时间段

	CONST MORNING =  1;
	CONST NOON =  2;
	CONST NIGHT =  3;
	CONST ALLDAY =  4;
	CONST VIRTUAL_STOCK_TYPE_1 = 1; // 虚库类型1
	CONST VIRTUAL_STOCK_TYPE_2 = 2; // 虚库类型2
	CONST VIRTUAL_STOCK_TYPE_3 = 3; // 虚库类型3
	CONST VIRTUAL_STOCK_TYPE_4 = 4; // 虚库类型4
	CONST VIRTUAL_STOCK_TYPE_5 = 5; // 虚库类型4
	CONST VIRTUAL_STOCK_TYPE_6 = 6; // 虚库类型4
	// 虚库延迟天数定义
	public static $vStockDelay = array(
		self::VIRTUAL_STOCK_TYPE_1 => 2, // 类型1延迟2天
		self::VIRTUAL_STOCK_TYPE_2 => 5, // 类型2延迟5天
		self::VIRTUAL_STOCK_TYPE_3 => 9, // 类型3延迟9天
		self::VIRTUAL_STOCK_TYPE_4 => 20, // 类型4延迟20天
		self::VIRTUAL_STOCK_TYPE_5 => 21, // 类型4延迟21天
		self::VIRTUAL_STOCK_TYPE_6 => 30, // 类型4延迟30天
	);


	// 预购延迟天数定义
	public static $bookingDelay = array(
		10,//LIB_Product::BOOKING_TYPE_SPECIFIC_DELAY,
		11,//LIB_Product::BOOKING_TYPE_SPECIFIC_DATE,
		12,//LIB_Product::BOOKING_TYPE_NOSPECIFIC_DATE,
	);

	// 仓库到分站的物流运输延时
	public static $_StockToWhidTransitDays = array(
			STOCK_SH_1    => array( // 上海一号仓
					SITE_SH => 0,
					SITE_SZ => 3,
					SITE_BJ => 3,
					SITE_WH => 1,
					SITE_CQ => 3,
					SITE_XA => 3,
			),
			STOCK_SH_5    => array( // 上海五号仓
					SITE_SH => 0,
					SITE_SZ => 100,
					SITE_BJ => 100,
					SITE_WH => 100,
					SITE_CQ => 100,
					SITE_XA => 100,
			),
			STOCK_SH_6    => array( // 上海五号仓
					SITE_SH => 0,
					SITE_SZ => 100,
					SITE_BJ => 100,
					SITE_WH => 100,
					SITE_CQ => 100,
					SITE_XA => 100,
			),
			STOCK_SZ_1001 => array(
					SITE_SH => 100,
					SITE_SZ => 0,
					SITE_BJ => 100,
					SITE_WH => 100,
					SITE_CQ => 100,
					SITE_XA => 100,
			),
			STOCK_SZ_1004 => array(
					SITE_SH => 100,
					SITE_SZ => 0,
					SITE_BJ => 100,
					SITE_WH => 100,
					SITE_CQ => 100,
					SITE_XA => 100,
			),
			STOCK_BJ_2001 => array(
					SITE_SH => 100,
					SITE_SZ => 100,
					SITE_BJ => 0,
					SITE_WH => 100,
					SITE_CQ => 100,
					SITE_XA => 100,
			),
			STOCK_WH_3001 => array(
					SITE_SH => 100,
					SITE_SZ => 100,
					SITE_BJ => 100,
					SITE_WH => 0,
					SITE_CQ => 100,
					SITE_XA => 100,
			),
			STOCK_CQ_4001 => array(
			SITE_SH => 100,
			SITE_SZ => 100,
			SITE_BJ => 100,
			SITE_WH => 100,
			SITE_CQ => 0,
			SITE_XA => 100,
			),
			STOCK_XA_5001 => array(
			SITE_SH => 100,
			SITE_SZ => 100,
			SITE_BJ => 100,
			SITE_WH => 100,
			SITE_CQ => 100,
			SITE_XA => 0,
			)
	);
	private static $dependMap = array(
		self::MORNING => self::NIGHT,
		self::NOON    => self::MORNING,
		self::NIGHT   => self::NOON,
		self::ALLDAY  => self::NIGHT,
	);


	static function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg = '';
	}

	/**
	 * 获得用户可上门提货的时间列表，只可选择日期
	 * @param whid          仓库编码
	 * @param district    地区编码
	 * @param isVirtual   是否虚拟库存
	 * @param isAmLimit   上午是否限单
	 * @param isDayLimit  全天是否限单
	 */
	public static function getCarryTimeList($delivery_info, $whid, $district, $isVirtual = false)
	{
		self::clearErr();
		$nTime = time();

		//如果有虚库
		if ($isVirtual) {
			$nTime = self::setDelay($nTime, $isVirtual);
		}

		$list = self::getTimeList($delivery_info, $nTime);
		if (false === $list)
			return false;

		return $list;
	}

	public static function getCarryTimeList1($whid, $district, $isVirtual = false, $isAmLimit = false, $isDayLimit = false)
	{
		// 兼容老接口，以后需要移除 TODO
		$delivery_info = array(
			'delivery_time' => 1,
			'shipping_id'   => SELF_DELIVERY_SH,
		);
		return self::getCarryTimeList($delivery_info, $whid, $district, $isVirtual);
	}

	public static function getCarryTimeList2($whid, $district, $isVirtual = false, $isAmLimit = false, $isDayLimit = false)
	{
		// 兼容老接口，以后需要移除 TODO
		$delivery_info = array(
			'delivery_time' => 2,
			'shipping_id'   => SELF_DELIVERY_SH,
		);
		return self::getCarryTimeList($delivery_info, $whid, $district, $isVirtual);
	}


	public static function getOrderLimitState($whid)
	{
		// 兼容老接口，以后需要移除 TODO
		$nDate = date('Ymd', time());
		return array(
			"limit_date"  => $nDate,
			"am_limit"    => "0",
			"day_limit"   => "0",
			"am_limit_n"  => "0",
			"day_limit_n" => "0"
		);
	}

	/**
	 * 获得一日一送的时间列表
	 * @param whid          仓库编号
	 * @param district    地区编码
	 * @param isVirtual   是否虚库
	 */
	public static function getShipMode1List(&$delivery_info, $whid, $district, $isVirtual)
	{
		// 兼容老接口，以后需要移除 TODO
		self::clearErr();
		$nTime = time();

		//如果有虚库
		if ($isVirtual) {
			$nTime = self::setDelay($nTime, $isVirtual);
		}

		if (date('H') >= 23) {
			$nTime += self::ONE_DAY;
		}

		// 干线物流延迟时间
		$nTime = self::transitDelay($delivery_info, $nTime, $whid);
		if (false === $nTime)
			return false;

		$nDate = date('Ymd', $nTime);

		$sql = "select distinct ship_date, name, week_day from t_shipping_time " ; 
		$where = " where wh_id=$whid AND ship_date>{$nDate} AND ship_state=1 ORDER BY ship_date ASC limit 0,10";
		

		$DB = Config::getDB("icson_core");
		
		$rows = $DB->getRows($sql.$where);
		if ($rows === false) {
			self::$errCode = $DB->errCode;
			self::$errMsg =  $DB->errMsg;
			Logger::err('icson_core t_shipping_time 查询失败 sql' . $sql . $where);
			return false;
		}

		return $rows;
	}


	/**
	 * 获得用户可选送货时间列表
	 * @param whid          仓库编码
	 * @param district      地区编码
	 * @param isVirtual     是否虚拟库存
	 * @param isAmLimit     上午是否限单
	 * @param isDayLimit    全天是否限单
	 */
	public static function getShipTimeList($whid, $stock_num, $district, $isVirtual = false, $isAmLimit = false, $isDayLimit = false)
	{
		// 兼容老接口，以后需要移除 TODO
		self::clearErr();
		if ($isDayLimit === true) {
			self::$errMsg = 'all day limit order';
			return false;
		}

		$source_region = LIB_Shipping::$_WhidToRegion[$whid];
		$delivery_info = IShippingRegionTTC::get($district, array('wh_id' => $source_region, 'shipping_id' => ICSON_DELIVERY, 'status' => 0));

		if (false === $delivery_info || count($delivery_info) == 0) {
			self::$errMsg = " [IShippingRegionTTC get error :" . IShippingRegionTTC::$errMsg . ",line:" . __LINE__ . ",count:" . count($delivery_info) . "] ";
			return false;
		}

		$delivery_info[0]['stock_num'] = $stock_num;
		return self::getShipTimeListIcson($delivery_info[0], $whid, $district, $isVirtual, $isAmLimit);
	}

	// 根据配送次数获取配送时间
	public static function getShipTimeListIcson($delivery_info, $whid, $district, $isVirtual = false, $isAmLimit = false)
	{
		// 兼容老接口，以后需要移除 TODO
		// 必须包含配送次数
		if (!isset($delivery_info['delivery_time'])) {
			self::$errMsg = "delivery_time1 is not set";
			return false;
		}

		// 必须包含发货分仓
		if (!isset($delivery_info['stock_num'])) {
			self::$errMsg = "stock_num is not set";
			return false;
		}

		// 配送次数只能是1，2，3其中之一
		if ($delivery_info['delivery_time'] != 1
			&& $delivery_info['delivery_time'] != 2
			&& $delivery_info['delivery_time'] != 3
		) {
			self::$errMsg = 'icson shipping not support, line:' . __LINE__;
			return false;
		}

		return self::getShipModeList($delivery_info, $whid, $district, $isVirtual);
		}

	/**
	 * 设置苏州地区配送限制
	 * @param whid        仓库编号
	 * @param district    地区编码
	 * @param isVirtual   是否虚拟库存
	 * @param isAmLimit   上午是否限单
	 */
	public static function setSuzhouStatus($list, $nTime)
	{
		// 今天的日期
		$today = date("Ymd", $nTime);
		$tomorrow = date("Ymd", $nTime + self::ONE_DAY);
		$time_0_0 = strtotime($today . " 00:00:00");
		$time_0_30 = strtotime($today . " 00:30:00");
		$time_23_00 = strtotime($today . " 23:00:00");
		$time_23_59 = strtotime($today . " 23:59:59");

		if ($nTime >= $time_0_0 && $nTime <= $time_0_30) {
			// 如果在当天的00:00点到00:30点之间，需要剔除当天上午这个时间段

			foreach ($list as $key => $it) {
				if ($it['ship_date'] == $today && $it['time_span'] == self::MORNING) {
					$list[$key]['status'] = LIB_ShippingTime::EXPIRE;
					break;
				}
			}
		} else if ($nTime >= $time_23_00 && $nTime <= $time_23_59) {
			// 如果在当天的23:00点到24:00点之间，需要剔除第二天上午这个时间段

			foreach ($list as $key => $it) {
				if ($it['ship_date'] == $tomorrow && $it['time_span'] == self::MORNING) {
					$list[$key]['status'] = LIB_ShippingTime::EXPIRE;
					break;
				}
			}
		}

		return $list;
	}


	private static function checkDeliveryInfo(&$delivery_info)
	{
		// 必须包含配送次数
		if (!isset($delivery_info['delivery_time'])) {
			self::$errMsg = "delivery_time is not set";
			return false;
		}

		// 必须包含发货分仓
		if (!isset($delivery_info['stock_num'])) {
			self::$errMsg = "stock_num is not set";
			return false;
		}

		// 必须包含配送方式ID
		if (!isset($delivery_info['shipping_id'])) {
			self::$errMsg = "shipping_id is not set";
			return false;
		}
		return true;
	}

	public static function get($delivery_info, $whid, $district, $isVirtual)
	{
//ELFlow::getInstance("test_shipping")->append(var_export($delivery_info,true));
		//Logger::info(var_export($delivery_info,true));
		// 自提
		if (in_array($delivery_info['shipping_id'], LIB_Shipping::$shipType_SELF)) {
			return self::getCarryTimeList($delivery_info, $whid, $district, $isVirtual);
		}
		// 非自提
		$ret = self::getShipModeList($delivery_info, $whid, $district, $isVirtual);
		//ELFlow::getInstance("shipping")->append(var_export($ret,true));
		ELFlow::getInstance("shipping")->append(var_export(self::$errMsg,true));
		return $ret;
	}

	private static function getShipModeList($delivery_info, $whid, $district, $isVirtual)
	{
		// 检查 $delivery_info 参数
		$ret = self::checkDeliveryInfo($delivery_info);
		if (false == $ret)
			return false;

		self::clearErr();
		$nTime = time();

		//如果有虚库
		if ($isVirtual) {
			$nTime = self::setDelay($nTime, $isVirtual);
		}

		// 干线物流延迟时间
		$nTime = self::transitDelay($delivery_info, $nTime, $whid);
		if (false === $nTime)
			return false;

		// 获取每日配送的次数和时间
		$list = self::getTimeList($delivery_info, $nTime);
		if (false === $list)
			return false;

		// 设置过期的时间段状态
		$list = self::setExpireStatus($nTime, $list);
		if (false === $list)
			return false;

		// 根据限单的配置，设置配送时间的状态
		$list = self::setOrderLimitStatus($delivery_info, $whid, $list);
		if (false === $list)
			return false;

		if ($delivery_info['shipping_id'] != ICSON_DELIVERY) {
//			Logger::info(var_export($list,true));
			$list = self::getNormalDeliveryHint($list);
		}

		// 苏州地区由于业务配送能力有限，第二天上午的订单需要截至在23点之前
		
		if (District::$District[$district]['city_id'] == 1692) {
			$list = self::setSuzhouStatus($list, $nTime);
		}

		return $list;
	}

	private static function setDelay($nTime, $virtual)
	{

		if(is_bool($virtual))
		{
			// 处理手机侧请求
			$virtual_type = $virtual;
			$virtual_value = 2;
		}
		else
		{
			// 网站侧
			// 延迟类型
			$virtual_type = intval($virtual['type']);

			// 延迟数值
			$virtual_value = $virtual['value'];
		}


		Logger::info(var_export($virtual, true));

		// 特殊固定延期类型
		if (in_array($virtual_type, self::$bookingDelay,true)) {
			// 预购延期
			switch ($virtual_type) {
				/* 固定延迟天数
				 * $virtual = array(
				 *      'type' => LIB_Product::BOOKING_TYPE_SPECIFIC_DELAY,
				 *	    'value' => 3,// 表示延后3天
				 * )
				 * */
				case 10 : //LIB_Product::BOOKING_TYPE_SPECIFIC_DELAY:
					// 如果不是整数，则强制为0
					if (!is_numeric($virtual_value))
						$virtual_value = 0;
					$nTime += $virtual_value * self::ONE_DAY;
					break;


				/*
				 * 固定日期, $virtual_value 值为指定的日期
				 * $virtual = array(
				 *      'type' => LIB_Product::BOOKING_TYPE_SPECIFIC_DELAY,
				 *		'value' => "2013-02-11",// 表示2013年2月11号才能卖
				 *	)
				 */
				case 11://LIB_Product::BOOKING_TYPE_SPECIFIC_DATE:
					// TODO 如果不是日期，则强制为0
					$due_date = strtotime($virtual_value);
					Logger::info($due_date);
					$N = LIB_ShippingTime::getDiffDays(time(), $due_date);
					Logger::info($N);
					$nTime += ($N + 1) * self::ONE_DAY;
					break;

				/* 固定延迟天数
				 * $virtual = array(
				 *      'type' => LIB_Product::BOOKING_TYPE_SPECIFIC_DELAY,
				 *	    'value' => N,// 表示延后N天，N为系统设定的一个默认值，会很大
				 * )
				 * */
				case 12://LIB_Product::BOOKING_TYPE_NOSPECIFIC_DATE:
					$nTime += $virtual_value * self::ONE_DAY;
					break;
			}
		} else if ( $virtual_type == false) {
			// 手机端 非虚库 参数 empty;
		} else if ( $virtual_type == self::VIRTUAL_STOCK_TYPE_1 or $virtual_type === true) {
			// 如果有虚库，上门自提时间顺延2个自然日,周5 15点到24点顺延3个工作日 周5 15点以后或者周6 周7顺延到下周2
			// 基本延迟时间
			$base = $virtual_value;
			if (date('N') == 5 && date('H') >= 15) {
				$nTime += ($base + 2) * self::ONE_DAY;
			} else if (date('N') == 6) {
				$nTime += ($base + 1) * self::ONE_DAY;
			} else if (date('N') == 7) {
				$nTime += $base * self::ONE_DAY;
			} else {
				$nTime += $base * self::ONE_DAY;
			}
		} else {
			 // empty
		}


		return $nTime;
	}

	// 干线物流延迟时间
	private static function transitDelay($delivery_info, $nTime, $whid)
	{
		if (!isset(self::$_StockToWhidTransitDays[$delivery_info['stock_num']])) {
			self::$errMsg = "没有设置分仓到分站的运输延时!";
			return false;
		}
		$transit_days = self::$_StockToWhidTransitDays[$delivery_info['stock_num']][$whid];
		$nTime += $transit_days * self::ONE_DAY;
		return $nTime;
	}

	private static function getTimeList($delivery_info, $baseTime)
	{
		// 获取每日配送的次数和时间
		$timeList = array();
		switch ($delivery_info['delivery_time']) {
			case 1:
				$spanList = array(
					self::ALLDAY
				);
				break;
			case 2:
				$spanList = array(
					self::MORNING,
					self::NOON
				);
				break;
			case 3:
				$spanList = array(
					self::MORNING,
					self::NOON,
					self::NIGHT
				);
				break;
			default:
				self::$errMsg = "ShippingTime delivery_time error!";
				return false;
				break;
		}

		// 根据配送次数，生成 7日内的所有时间段
		for ($i = 0; $i < self::DAY_LIMIT; $i++) {
			/*
				"name" : "2012-10-16 星期二晚上",
				"ship_date" : "20121016",
				"time_span" : "3",
				"week_day" : "2"
			*/

			$now = $baseTime + $i * self::ONE_DAY;
			$ship_date = date('Ymd', $now);
			$week_day = date('N', $now);
			$name = date('Y-m-d', $now) . " " . self::$weekDays[$week_day];

			$item = array(
				"name"      => "{$name}",
				"ship_date" => "{$ship_date}",
				"week_day"  => "{$week_day}",
				"time_span" => "",
				"status"    => self::NORMAL,
			);

			foreach ($spanList as $span) {
				// name = 日期 + 星期几 + 时间段
				$item["name"] = $name . self::$timeSpan[$span];
				$item['time_span'] = "{$span}";
				$timeList[] = $item;
			}
		}

		return $timeList;
	}

	/**
	 * 获得一日三送的时间区间
	 * 返回数字 1:上午 2:下午 3:晚上 4:全天
	 * @param whid          仓库编号
	 * @param isAmLimit   上午是否限单
	 */
	static private function getTimeSpan()
	{
		$nTime = time();
		$weekDay = date('N', $nTime);
		$shipDate = date('Y-m-d', $nTime);
		$items = ShipConst::$_ShipTime[$weekDay];
		foreach ($items as $v) {
			$tmp = $shipDate . ' ' . $v[0];
			$val = strtotime($tmp);
			if ($nTime > $val)
				continue;
			return $v[1];
		}
		return 4;
	}

	/**
	 * 获得上门自取的时间区间
	 * 返回数字 1:上午 2:下午 4:第二天上午
	 * @param whid          仓库编号
	 * @param isAmLimit   上午是否限单
	 */
	static private function getSelfTimeSpan()
	{
		$nTime = time();
		$weekDay = date('N', $nTime);
		$shipDate = date('Y-m-d', $nTime);
		$items = ShipConst::$_SelfShipTime[$weekDay];
		foreach ($items as $v) {
			$tmp = $shipDate . ' ' . $v[0];
			$val = strtotime($tmp);
			if ($nTime > $val)
				continue;
			return $v[1];
		}
		return 4;
	}


	// 设置过期时间段
	private static function setExpireStatus($nTime, $list)
	{
		$nDate = date("Ymd", $nTime);
		$span = self::getTimeSpan();
		reset($list);
		
		foreach ($list as $key => $l) {
			if ($l['ship_date'] == $nDate && ($l['time_span'] == self::ALLDAY || $l['time_span'] < $span)) {
				$list[$key]['status'] = self::EXPIRE;
			}
		}
		
		reset($list);
		//获取设置默认值
// 		$ret = TTC_RetailerParam::get('delivery_time');
// 		if (is_array($ret) && count($ret) == 1){
// 			$paramDate = $ret[0]['param1'] -1;
// 			$paramTime = $ret[0]['param2'];
// 			$nowDate = date('Ymd', time());
// 			$ship_date = date("Ymd", strtotime("{$nowDate} + " . $paramDate ." day"));
	
// 			foreach ($list as $key => $l) {
// 				if ($list[$key]['status'] == self::EXPIRE){
// 					continue;
// 				}
// 				if ($l['ship_date'] < $ship_date) {
// 					$list[$key]['status'] = self::EXPIRE;
// 				}
// 				else if ($l['ship_date'] == $ship_date && $l['time_span']<$paramTime){
// 					$list[$key]['status'] = self::EXPIRE;
// 				}
// 			}
// 		}

		return $list;
	}

	// 根据限单的配置设置配送时间的状态
	private static function setOrderLimitStatus($delivery_info, $wh_id, $list)
	{

		return $list;
	}

	// 获取依赖时间段和日期
	private static function getDependValue($expect_time, $stock_id, $whid, $ship_type)
	{
		global $_StockToStation;
		$stock_whid = $_StockToStation[$stock_id];
		$N = 5; //$_StockToWhidTransitDays[$stock_id][$whid];
		$T = $expect_time['expect_ship_date'];
		$now = time();
		if ($ship_type == ICSON_DELIVERY) {
			// 易迅快递
			if ($stock_whid == $whid) {
				// 非跨仓
				if ($expect_time['expect_time_span'] == self::NOON or $expect_time['expect_time_span'] == self::NIGHT) {
					// T 日下午配送的限单值 = T 日上午发货限单值
					// T 日晚上配送的限单值 = T 日下午发货限单值
					$ship_date = $T;
					$time_span = self::$dependMap[$expect_time['expect_time_span']];
				} else {
					// T 日上午配送的限单值 = T-1 日夜间发货限单值
					// T 日配送的限单值 = T-1 日夜间发货限单值
					$ship_date = date("Ymd", strtotime("{$T} -1 day"));
					$time_span = self::$dependMap[$expect_time['expect_time_span']];
				}
			} else {
				/*
				    跨仓 全部依赖 T-N日 夜间的限单值
				    T 日上午配送的限单值 = T-N日实际发货仓的夜间发货限单值
				    T 日下午配送的限单值 = T-N日实际发货仓的夜间发货限单值
				    T 日晚上配送的限单值 = T-N日实际发货仓的夜间发货限单值
				    T 日配送的限单值 = T-N日实际发货仓的夜间发货限单值
				  跨仓订单，扣减仓库限单额度的日期，取【期望配送日期 - 5】与【下单日期】中最大的
			    */
				$tmp = max(strtotime("{$T} -{$N} day"), $now);
				$ship_date = date("Ymd", $tmp);
				$time_span = self::NIGHT;
			}
		} else {
			// 非易迅快递，依赖 下单日期 全天的限单值
			$ship_date = $expect_time['expect_ship_date'];
			$time_span = self::ALLDAY;
		}

		// 返回的记录时间
		$result = array(
			"ship_date" => $ship_date,
			"time_span" => $time_span,
		);
		return $result;
	}

	private static function getNormalDeliveryHint($list)
	{
		// 如果是普通的快递，只需要返回第一个可用的时间段，用于前端提示
		$result = array();
		foreach ($list as $l) {
			if ($l['status'] == self::NORMAL) {
				$result[] = $l;
				break;
			}
		}
		return $result;
	}

	public static function getDiffDays($t1, $t2)
	{
		// 计算两个时间点之间的差值，单位是 天
		$diff_days = intval(($t2 - $t1) / self::ONE_DAY);

		// 如果相差的天数大于0，则推迟N天
		$N = $diff_days > 0 ? $diff_days : 0;
		return $N;
	}
}

