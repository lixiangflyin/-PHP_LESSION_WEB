<?php
require_once(PHPLIB_ROOT . "lib/Config.php");
require_once(PHPLIB_ROOT . 'inc/ship.inc.php');
require_once(PHPLIB_ROOT . 'inc/orderlimitdata.inc.php');
require_once(PHPLIB_ROOT . 'inc/orderlimitconf.inc.php');
/**
 * 封装送货时间的类
 */
class IShippingTime
{
	public static $errCode = 0;
	public static $errMsg = '';

	public static $timeSpan = array('1' => '上午', '2' => '下午', '3' => '晚上', '4' => "");
	public static $weekDays = array('1' => '星期一', '2' => '星期二', '3' => '星期三', '4' => '星期四', '5' => '星期五', '6' => '星期六', '7' => '星期日');
	public static $stopTime = array(
		MORNING => "00:30",
		NOON => "11:00",
		NIGHT => "15:00",
	);

	// 时间状态标记
	CONST NORMAL = 0; // 正常的时间段
	CONST EXPIRE = -1; // 当天过期的时间段
	CONST LIMITED = -2; // 限单的时间段

	CONST ONE_DAY = 86400; // 24*60*60 每天的秒数
	CONST DAY_LIMIT = 7; // 生成7天的时间段


	// 虚库延迟天数定义
	public static $vStockDelay = array(
		IProduct::VIRTUAL_STOCK_TYPE_1 => 2, // 类型1延迟2天
		IProduct::VIRTUAL_STOCK_TYPE_2 => 5, // 类型2延迟5天
		IProduct::VIRTUAL_STOCK_TYPE_3 => 9, // 类型3延迟9天
		IProduct::VIRTUAL_STOCK_TYPE_4 => 20, // 类型4延迟20天
		IProduct::VIRTUAL_STOCK_TYPE_5 => 21, // 类型4延迟21天
		IProduct::VIRTUAL_STOCK_TYPE_6 => 30, // 类型4延迟30天
	);


	// 预购延迟天数定义
	public static $bookingDelay = array(
		IProduct::BOOKING_TYPE_SPECIFIC_DELAY,
		IProduct::BOOKING_TYPE_SPECIFIC_DATE,
		IProduct::BOOKING_TYPE_NOSPECIFIC_DATE,
	);

	private static $dependMap = array(
		MORNING => NIGHT,
		NOON    => MORNING,
		NIGHT   => NOON,
		ALLDAY  => NIGHT,
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
		$nTime = self::transitDelay($delivery_info, $nTime, $whid, $district);
		if (false === $nTime)
			return false;

		$nDate = date('Ymd', $nTime);


		$where = "wh_id=$whid AND ship_date>{$nDate} AND ship_state=1 ORDER BY ship_date ASC";
		$fields = array('distinct ship_date', 'name', 'week_day');

		$rows = IShippingTimeDao::getRows($fields, $where, 0, 10);
		if ($rows === false) {
			self::$errCode = IShippingTimeDao::$errCode;
			self::$errMsg = IShippingTimeDao::$errMsg;
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

		global $_WhidToRegion;
		$source_region = $_WhidToRegion[$whid];
		$delivery_info = IShippingRegionTTC::get($district, array('wh_id' => $source_region, 'shipping_id' => ICSON_DELIVERY, 'status' => 0, 'size_type'=> 1 ));

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
				if ($it['ship_date'] == $today && $it['time_span'] == MORNING) {
					$list[$key]['status'] = IShippingTime::EXPIRE;
					break;
				}
			}
		} else if ($nTime >= $time_23_00 && $nTime <= $time_23_59) {
			// 如果在当天的23:00点到24:00点之间，需要剔除第二天上午这个时间段

			foreach ($list as $key => $it) {
				if ($it['ship_date'] == $tomorrow && $it['time_span'] == MORNING) {
					$list[$key]['status'] = IShippingTime::EXPIRE;
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
		//Logger::info(var_export($delivery_info,true));
		// 自提
		if (in_array($delivery_info['shipping_id'], IShipping::$shipType_SELF)) {
			return self::getCarryTimeList($delivery_info, $whid, $district, $isVirtual);
		}
		// 非自提
		return self::getShipModeList($delivery_info, $whid, $district, $isVirtual);
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
		$nTime = self::transitDelay($delivery_info, $nTime, $whid, $district);
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
		global $_District;
		if ($_District[$district]['city_id'] == 1692) {
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
			$virtual_value = 5;
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
				 *      'type' => IProduct::BOOKING_TYPE_SPECIFIC_DELAY,
				 *	    'value' => 3,// 表示延后3天
				 * )
				 * */
				case IProduct::BOOKING_TYPE_SPECIFIC_DELAY:
					// 如果不是整数，则强制为0
					if (!is_numeric($virtual_value))
						$virtual_value = 0;
					$nTime += $virtual_value * self::ONE_DAY;
					break;


				/*
				 * 固定日期, $virtual_value 值为指定的日期
				 * $virtual = array(
				 *      'type' => IProduct::BOOKING_TYPE_SPECIFIC_DELAY,
				 *		'value' => "2013-02-11",// 表示2013年2月11号才能卖
				 *	)
				 */
				case IProduct::BOOKING_TYPE_SPECIFIC_DATE:
					// TODO 如果不是日期，则强制为0
					$due_date = strtotime($virtual_value);
					Logger::info($due_date);
					$N = IShippingTime::getDiffDays(time(), $due_date);
					Logger::info($N);
					$nTime += ($N + 1) * self::ONE_DAY;
					break;

				/* 固定延迟天数
				 * $virtual = array(
				 *      'type' => IProduct::BOOKING_TYPE_SPECIFIC_DELAY,
				 *	    'value' => N,// 表示延后N天，N为系统设定的一个默认值，会很大
				 * )
				 * */
				case IProduct::BOOKING_TYPE_NOSPECIFIC_DATE:
					$nTime += $virtual_value * self::ONE_DAY;
					break;
			}
		} else if ( $virtual_type == false) {
			// 手机端 非虚库 参数 empty;
		} else if ( $virtual_type == IProduct::VIRTUAL_STOCK_TYPE_1 or $virtual_type === true) {
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
	private static function transitDelay($delivery_info, $nTime, $whid, $district_id)
	{
		global $_StockToDCTransitDays;
		if (!isset($_StockToDCTransitDays[$delivery_info['stock_num']])) {
			self::$errMsg = "没有设置分仓到分站的运输延时!";
			return false;
		}

		$des_dc = IProductInventory::getDCFromDistrict($district_id, $whid);
		$transit_days = isset($_StockToDCTransitDays[$delivery_info['stock_num']][$des_dc]) ? $_StockToDCTransitDays[$delivery_info['stock_num']][$des_dc] : 0;
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
					ALLDAY
				);
				break;
			case 2:
				$spanList = array(
					MORNING,
					NOON
				);
				break;
			case 3:
				$spanList = array(
					MORNING,
					NOON,
					NIGHT
				);
				break;
			default:
				self::$errMsg = "IShippingTime delivery_time error!";
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
		global $_ShipTime;
		$nTime = time();
		$weekDay = date('N', $nTime);
		$shipDate = date('Y-m-d', $nTime);
		$items = $_ShipTime[$weekDay];
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
		global $_SelfShipTime;
		$nTime = time();
		$weekDay = date('N', $nTime);
		$shipDate = date('Y-m-d', $nTime);
		$items = $_SelfShipTime[$weekDay];
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
			if ($l['ship_date'] == $nDate && ($l['time_span'] == ALLDAY || $l['time_span'] < $span)) {
				$list[$key]['status'] = self::EXPIRE;
			}
		}
		return $list;
	}

	// 根据限单的配置设置配送时间的状态
	private static function setOrderLimitStatus($delivery_info, $wh_id, $list)
	{
		global $_ORDER_LIMIT_CONF, $_ORDER_LIMIT_DATA;

		$stock_id = $delivery_info['stock_num'];
		$shipping_id = $delivery_info['shipping_id'];

		reset($list);
		foreach ($list as $key => $item) {
			$expect_ship_date = $item['ship_date'];
			$expect_time_span = $item['time_span'];

			$limited = false;
			$expect_time = array(
				'expect_ship_date' => $expect_ship_date,
				'expect_time_span' => $expect_time_span,
			);

			$result = self::getDependValue($expect_time, $stock_id, $wh_id, $shipping_id);

			$ship_date = $result['ship_date'];
			$time_span = $result['time_span'];

			if (!isset($_ORDER_LIMIT_CONF[$stock_id][$shipping_id][$ship_date][$time_span])) {
				// 没有限制
				continue;
			}
			$limit_num = $_ORDER_LIMIT_CONF[$stock_id][$shipping_id][$ship_date][$time_span];
			if ($limit_num < 0) {
				// 当成时间段没有限制处理
				continue;
			} else if ($limit_num > 0) {
				if (!isset($_ORDER_LIMIT_DATA[$stock_id][$shipping_id][$ship_date][$time_span])) {
					// 订单数量未生成到配置文件中，当作没有限制处理
					continue;
				}
				$order_num = $_ORDER_LIMIT_DATA[$stock_id][$shipping_id][$ship_date][$time_span];
				$limited = ($order_num >= $limit_num) ? true : false;
			} else {
				// 此时 $limit_num = 0
				$limited = true;
			}

			if ($item['status'] == self::NORMAL && $limited) {
				// 订单数大于等于限单数，把该时间的状态改为限单状态
				$list[$key]['status'] = self::LIMITED;
			}
		}
		return $list;
	}

	// 获取依赖时间段和日期
	private static function getDependValue($expect_time, $stock_id, $whid, $ship_type)
	{
		global $_StockToStation;
		$stock_whid = $_StockToStation[$stock_id];
		$N = 2;
		$T = $expect_time['expect_ship_date'];
		$now = time();
		if ($ship_type == ICSON_DELIVERY) {
			// 易迅快递
			if ($stock_whid == $whid) {
				// 非跨仓
				if ($expect_time['expect_time_span'] == NOON or $expect_time['expect_time_span'] == NIGHT) {
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
				$time_span = NIGHT;
			}
		} else {
			// 非易迅快递，依赖 下单日期 全天的限单值
			$ship_date = $expect_time['expect_ship_date'];
			$time_span = ALLDAY;
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

	// 按订单的配送时间去记录各个时间段的下单数量, $order_num 表示+1或者-1
	public static function orderRecording($orderstosyn, $order_num = 1)
	{
		Logger::info("\n-------------start-------------\n");
//		Logger::info(var_export($orderstosyn,true));
		if (count($orderstosyn) > 0) {
			// 限单数据库里面添加记录数
			$limitOrderDB = Config::getDB("icson_core");
			if (false === $limitOrderDB) {
				Logger::err(Config::$errMsg);
				return false;
			}

			$sql = "begin";
			$ret = $limitOrderDB->execSql($sql);
			if ($ret === false) {
				Logger::err("限单记录，开启事务失败!" . $limitOrderDB->errMsg);
				return false;
			}

			foreach ($orderstosyn as $oid => $orderInfo) {
				/**
				if($orderInfo['status'] != 0 && $order_num > 0)
				{
				// 如果用户已经取消的订单，同步到ERP，则不记录
				continue;
				}
				 **/
				$ship_type = $orderInfo['shipping_type'];
				$stock_id = $orderInfo['stockNo'];
				$wh_id = $orderInfo['hw_id'];

				// 用户期望配送日期 和 用户期望配送时间段
				// 如果没有选择时间段，则记录为 order_date（下单日期） allday（全天） 需要用!empty不能用isset，因为第三方快递expect_dly_date和expect_dly_time_span为0
				$expect_ship_date = !empty($orderInfo['expect_dly_date']) ? date('Ymd', $orderInfo['expect_dly_date']) : date('Ymd', $orderInfo['order_date']);
				$expect_time_span = !empty($orderInfo['expect_dly_time_span']) ? $orderInfo['expect_dly_time_span'] : ALLDAY;

				$expect_time = array(
					'expect_ship_date' => $expect_ship_date,
					'expect_time_span' => $expect_time_span,
				);

				$result = self::getDependValue($expect_time, $stock_id, $wh_id, $ship_type);

				$record_date = $result['ship_date'];
				$time_span = $result['time_span'];

				$sql = "update t_order_limit_data set order_num=order_num+{$order_num} where stock_id={$stock_id} and ship_type={$ship_type} and time_span={$time_span} and record_date='{$record_date}' -- {$oid}";
				$ret = $limitOrderDB->execSql($sql);
				if ($ret === false) {
					Logger::err($limitOrderDB->errMsg);
				} else {
					Logger::info($oid . ":" . $sql);
				}

				if ($limitOrderDB->getAffectedRows() == 0) {
					$data = array(
						"stock_id"    => $stock_id,
						"ship_type"   => $ship_type,
						"time_span"   => $time_span,
						"record_date" => $record_date,
						"order_num"   => $order_num,
					);
					$ret = $limitOrderDB->insert("t_order_limit_data", $data);
					if ($ret === false) {
						Logger::err($limitOrderDB->errMsg);
					} else {
						Logger::info("{$oid}, $stock_id, $wh_id, $ship_type," . var_export($expect_time, true) . "\n{$oid}:sql:" . $limitOrderDB->getInsertString("t_order_limit_data", $data));
					}
				} else {
					Logger::info("{$oid}, $stock_id, $wh_id, $ship_type," . var_export($expect_time, true) . "\n{$oid}:sql:" . $sql);
				}
			}
			$limitOrderDB->execSql("commit");
		}
		Logger::info("\n-------------end-------------\n");
		return true;
	}

	public static function getDiffDays($t1, $t2)
	{
		// 计算两个时间点之间的差值，单位是 天
		$diff_days = intval(($t2 - $t1) / self::ONE_DAY);

		// 如果相差的天数大于0，则推迟N天
		$N = $diff_days > 0 ? $diff_days : 0;
		return $N;
	}

	/**
	 * @static
	 *
	 */
	public static function verifyExpectDateSpan($icson_delivery_info, $wh_id, $destination, $isVirtual)
	{
		$timeAvailable = IShippingTime::get($icson_delivery_info, $wh_id, $destination, $isVirtual);
		IOrder::Log(ToolUtil::gbJsonEncode($timeAvailable));
		if (!is_array($timeAvailable) || count($timeAvailable) == 0) {
			self::$errCode = -11;
			self::$errMsg = "本周暂不提供配送服务，谢谢您的关注";
			return false;
		}
		else
		{
			$isExpect = false;
			if(!isset($icson_delivery_info['expect_ship_date']) || !isset($icson_delivery_info['expect_time_span']))
			{
				self::$errCode = -11;
				self::$errMsg = "没有期望配送时间";
				return false;
			}
			$expect_ship_date = $icson_delivery_info['expect_ship_date'];
			$expect_time_span = $icson_delivery_info['expect_time_span'];
			// 检查配送时间是否在可用的配送时间内，默认不正确

			foreach ($timeAvailable as $span) {
				if (strtotime($span['ship_date']) == strtotime($expect_ship_date) && $span['time_span'] == $expect_time_span ) // 且下单时间段存在
				{
					// 找到了用户的选择时间，根据当前状态来提示
					$s = IShippingTime::$timeSpan[$span['time_span']];
					$selected_time = date("n月j日{$s}",strtotime($span['ship_date']));
					$stop = IShippingTime::$stopTime[$span['time_span']];

					global $_District;
					if ($_District[$destination]['city_id'] == 1692 && $span['time_span'] == MORNING) {
						 $stop = "23:00";
					}

					switch($span['status'])
					{
						case IShippingTime::NORMAL:
							$isExpect = true;
							break;
						case IShippingTime::EXPIRE:
							$isExpect = false;
							self::$errCode = -11;
							self::$errMsg = "超过结单时间{$stop}，您选择的\"{$selected_time}\"已不可用，请点击确定后重新选择";
							break;
						case IShippingTime::LIMITED:
							$isExpect = false;
							self::$errCode = -11;
							self::$errMsg = "您选择的\"{$selected_time}\"订单配额已满，请点击确定后重新选择";
							break;
						default;
							break;
					}
					return $isExpect;
				}
			}
		}
		self::$errCode = -11;
		self::$errMsg = "您提交的配送时间不正确，请点击确定后重新选择";
		return false;
	}
}

