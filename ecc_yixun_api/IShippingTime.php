<?php
require_once(PHPLIB_ROOT . "lib/Config.php");
require_once(PHPLIB_ROOT . 'inc/ship.inc.php');
require_once(PHPLIB_ROOT . 'inc/orderlimitdata.inc.php');
require_once(PHPLIB_ROOT . 'inc/orderlimitconf.inc.php');
/**
 * ��װ�ͻ�ʱ�����
 */
class IShippingTime
{
	public static $errCode = 0;
	public static $errMsg = '';

	public static $timeSpan = array('1' => '����', '2' => '����', '3' => '����', '4' => "");
	public static $weekDays = array('1' => '����һ', '2' => '���ڶ�', '3' => '������', '4' => '������', '5' => '������', '6' => '������', '7' => '������');
	public static $stopTime = array(
		MORNING => "00:30",
		NOON => "11:00",
		NIGHT => "15:00",
	);

	// ʱ��״̬���
	CONST NORMAL = 0; // ������ʱ���
	CONST EXPIRE = -1; // ������ڵ�ʱ���
	CONST LIMITED = -2; // �޵���ʱ���

	CONST ONE_DAY = 86400; // 24*60*60 ÿ�������
	CONST DAY_LIMIT = 7; // ����7���ʱ���


	// ����ӳ���������
	public static $vStockDelay = array(
		IProduct::VIRTUAL_STOCK_TYPE_1 => 2, // ����1�ӳ�2��
		IProduct::VIRTUAL_STOCK_TYPE_2 => 5, // ����2�ӳ�5��
		IProduct::VIRTUAL_STOCK_TYPE_3 => 9, // ����3�ӳ�9��
		IProduct::VIRTUAL_STOCK_TYPE_4 => 20, // ����4�ӳ�20��
		IProduct::VIRTUAL_STOCK_TYPE_5 => 21, // ����4�ӳ�21��
		IProduct::VIRTUAL_STOCK_TYPE_6 => 30, // ����4�ӳ�30��
	);


	// Ԥ���ӳ���������
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
	 * ����û������������ʱ���б�ֻ��ѡ������
	 * @param whid          �ֿ����
	 * @param district    ��������
	 * @param isVirtual   �Ƿ�������
	 * @param isAmLimit   �����Ƿ��޵�
	 * @param isDayLimit  ȫ���Ƿ��޵�
	 */
	public static function getCarryTimeList($delivery_info, $whid, $district, $isVirtual = false)
	{
		self::clearErr();
		$nTime = time();

		//��������
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
		// �����Ͻӿڣ��Ժ���Ҫ�Ƴ� TODO
		$delivery_info = array(
			'delivery_time' => 1,
			'shipping_id'   => SELF_DELIVERY_SH,
		);
		return self::getCarryTimeList($delivery_info, $whid, $district, $isVirtual);
	}

	public static function getCarryTimeList2($whid, $district, $isVirtual = false, $isAmLimit = false, $isDayLimit = false)
	{
		// �����Ͻӿڣ��Ժ���Ҫ�Ƴ� TODO
		$delivery_info = array(
			'delivery_time' => 2,
			'shipping_id'   => SELF_DELIVERY_SH,
		);
		return self::getCarryTimeList($delivery_info, $whid, $district, $isVirtual);
	}


	public static function getOrderLimitState($whid)
	{
		// �����Ͻӿڣ��Ժ���Ҫ�Ƴ� TODO
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
	 * ���һ��һ�͵�ʱ���б�
	 * @param whid          �ֿ���
	 * @param district    ��������
	 * @param isVirtual   �Ƿ����
	 */
	public static function getShipMode1List(&$delivery_info, $whid, $district, $isVirtual)
	{
		// �����Ͻӿڣ��Ժ���Ҫ�Ƴ� TODO
		self::clearErr();
		$nTime = time();

		//��������
		if ($isVirtual) {
			$nTime = self::setDelay($nTime, $isVirtual);
		}

		if (date('H') >= 23) {
			$nTime += self::ONE_DAY;
		}

		// ���������ӳ�ʱ��
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
	 * ����û���ѡ�ͻ�ʱ���б�
	 * @param whid          �ֿ����
	 * @param district      ��������
	 * @param isVirtual     �Ƿ�������
	 * @param isAmLimit     �����Ƿ��޵�
	 * @param isDayLimit    ȫ���Ƿ��޵�
	 */
	public static function getShipTimeList($whid, $stock_num, $district, $isVirtual = false, $isAmLimit = false, $isDayLimit = false)
	{
		// �����Ͻӿڣ��Ժ���Ҫ�Ƴ� TODO
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

	// �������ʹ�����ȡ����ʱ��
	public static function getShipTimeListIcson($delivery_info, $whid, $district, $isVirtual = false, $isAmLimit = false)
	{
		// �����Ͻӿڣ��Ժ���Ҫ�Ƴ� TODO
		// ����������ʹ���
		if (!isset($delivery_info['delivery_time'])) {
			self::$errMsg = "delivery_time1 is not set";
			return false;
		}

		// ������������ֲ�
		if (!isset($delivery_info['stock_num'])) {
			self::$errMsg = "stock_num is not set";
			return false;
		}

		// ���ʹ���ֻ����1��2��3����֮һ
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
	 * �������ݵ�����������
	 * @param whid        �ֿ���
	 * @param district    ��������
	 * @param isVirtual   �Ƿ�������
	 * @param isAmLimit   �����Ƿ��޵�
	 */
	public static function setSuzhouStatus($list, $nTime)
	{
		// ���������
		$today = date("Ymd", $nTime);
		$tomorrow = date("Ymd", $nTime + self::ONE_DAY);
		$time_0_0 = strtotime($today . " 00:00:00");
		$time_0_30 = strtotime($today . " 00:30:00");
		$time_23_00 = strtotime($today . " 23:00:00");
		$time_23_59 = strtotime($today . " 23:59:59");

		if ($nTime >= $time_0_0 && $nTime <= $time_0_30) {
			// ����ڵ����00:00�㵽00:30��֮�䣬��Ҫ�޳������������ʱ���

			foreach ($list as $key => $it) {
				if ($it['ship_date'] == $today && $it['time_span'] == MORNING) {
					$list[$key]['status'] = IShippingTime::EXPIRE;
					break;
				}
			}
		} else if ($nTime >= $time_23_00 && $nTime <= $time_23_59) {
			// ����ڵ����23:00�㵽24:00��֮�䣬��Ҫ�޳��ڶ����������ʱ���

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
		// ����������ʹ���
		if (!isset($delivery_info['delivery_time'])) {
			self::$errMsg = "delivery_time is not set";
			return false;
		}

		// ������������ֲ�
		if (!isset($delivery_info['stock_num'])) {
			self::$errMsg = "stock_num is not set";
			return false;
		}

		// ����������ͷ�ʽID
		if (!isset($delivery_info['shipping_id'])) {
			self::$errMsg = "shipping_id is not set";
			return false;
		}
		return true;
	}

	public static function get($delivery_info, $whid, $district, $isVirtual)
	{
		//Logger::info(var_export($delivery_info,true));
		// ����
		if (in_array($delivery_info['shipping_id'], IShipping::$shipType_SELF)) {
			return self::getCarryTimeList($delivery_info, $whid, $district, $isVirtual);
		}
		// ������
		return self::getShipModeList($delivery_info, $whid, $district, $isVirtual);
	}

	private static function getShipModeList($delivery_info, $whid, $district, $isVirtual)
	{
		// ��� $delivery_info ����
		$ret = self::checkDeliveryInfo($delivery_info);
		if (false == $ret)
			return false;

		self::clearErr();
		$nTime = time();

		//��������
		if ($isVirtual) {
			$nTime = self::setDelay($nTime, $isVirtual);
		}

		// ���������ӳ�ʱ��
		$nTime = self::transitDelay($delivery_info, $nTime, $whid, $district);
		if (false === $nTime)
			return false;

		// ��ȡÿ�����͵Ĵ�����ʱ��
		$list = self::getTimeList($delivery_info, $nTime);
		if (false === $list)
			return false;

		// ���ù��ڵ�ʱ���״̬
		$list = self::setExpireStatus($nTime, $list);
		if (false === $list)
			return false;

		// �����޵������ã���������ʱ���״̬
		$list = self::setOrderLimitStatus($delivery_info, $whid, $list);
		if (false === $list)
			return false;

		if ($delivery_info['shipping_id'] != ICSON_DELIVERY) {
//			Logger::info(var_export($list,true));
			$list = self::getNormalDeliveryHint($list);
		}

		// ���ݵ�������ҵ�������������ޣ��ڶ�������Ķ�����Ҫ������23��֮ǰ
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
			// �����ֻ�������
			$virtual_type = $virtual;
			$virtual_value = 5;
		}
		else
		{
			// ��վ��
			// �ӳ�����
			$virtual_type = intval($virtual['type']);

			// �ӳ���ֵ
			$virtual_value = $virtual['value'];
		}


		Logger::info(var_export($virtual, true));

		// ����̶���������
		if (in_array($virtual_type, self::$bookingDelay,true)) {
			// Ԥ������
			switch ($virtual_type) {
				/* �̶��ӳ�����
				 * $virtual = array(
				 *      'type' => IProduct::BOOKING_TYPE_SPECIFIC_DELAY,
				 *	    'value' => 3,// ��ʾ�Ӻ�3��
				 * )
				 * */
				case IProduct::BOOKING_TYPE_SPECIFIC_DELAY:
					// ���������������ǿ��Ϊ0
					if (!is_numeric($virtual_value))
						$virtual_value = 0;
					$nTime += $virtual_value * self::ONE_DAY;
					break;


				/*
				 * �̶�����, $virtual_value ֵΪָ��������
				 * $virtual = array(
				 *      'type' => IProduct::BOOKING_TYPE_SPECIFIC_DELAY,
				 *		'value' => "2013-02-11",// ��ʾ2013��2��11�Ų�����
				 *	)
				 */
				case IProduct::BOOKING_TYPE_SPECIFIC_DATE:
					// TODO ����������ڣ���ǿ��Ϊ0
					$due_date = strtotime($virtual_value);
					Logger::info($due_date);
					$N = IShippingTime::getDiffDays(time(), $due_date);
					Logger::info($N);
					$nTime += ($N + 1) * self::ONE_DAY;
					break;

				/* �̶��ӳ�����
				 * $virtual = array(
				 *      'type' => IProduct::BOOKING_TYPE_SPECIFIC_DELAY,
				 *	    'value' => N,// ��ʾ�Ӻ�N�죬NΪϵͳ�趨��һ��Ĭ��ֵ����ܴ�
				 * )
				 * */
				case IProduct::BOOKING_TYPE_NOSPECIFIC_DATE:
					$nTime += $virtual_value * self::ONE_DAY;
					break;
			}
		} else if ( $virtual_type == false) {
			// �ֻ��� ����� ���� empty;
		} else if ( $virtual_type == IProduct::VIRTUAL_STOCK_TYPE_1 or $virtual_type === true) {
			// �������⣬��������ʱ��˳��2����Ȼ��,��5 15�㵽24��˳��3�������� ��5 15���Ժ������6 ��7˳�ӵ�����2
			// �����ӳ�ʱ��
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

	// ���������ӳ�ʱ��
	private static function transitDelay($delivery_info, $nTime, $whid, $district_id)
	{
		global $_StockToDCTransitDays;
		if (!isset($_StockToDCTransitDays[$delivery_info['stock_num']])) {
			self::$errMsg = "û�����÷ֲֵ���վ��������ʱ!";
			return false;
		}

		$des_dc = IProductInventory::getDCFromDistrict($district_id, $whid);
		$transit_days = isset($_StockToDCTransitDays[$delivery_info['stock_num']][$des_dc]) ? $_StockToDCTransitDays[$delivery_info['stock_num']][$des_dc] : 0;
		$nTime += $transit_days * self::ONE_DAY;
		return $nTime;
	}

	private static function getTimeList($delivery_info, $baseTime)
	{
		// ��ȡÿ�����͵Ĵ�����ʱ��
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

		// �������ʹ��������� 7���ڵ�����ʱ���
		for ($i = 0; $i < self::DAY_LIMIT; $i++) {
			/*
				"name" : "2012-10-16 ���ڶ�����",
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
				// name = ���� + ���ڼ� + ʱ���
				$item["name"] = $name . self::$timeSpan[$span];
				$item['time_span'] = "{$span}";
				$timeList[] = $item;
			}
		}

		return $timeList;
	}

	/**
	 * ���һ�����͵�ʱ������
	 * �������� 1:���� 2:���� 3:���� 4:ȫ��
	 * @param whid          �ֿ���
	 * @param isAmLimit   �����Ƿ��޵�
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
	 * ���������ȡ��ʱ������
	 * �������� 1:���� 2:���� 4:�ڶ�������
	 * @param whid          �ֿ���
	 * @param isAmLimit   �����Ƿ��޵�
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


	// ���ù���ʱ���
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

	// �����޵���������������ʱ���״̬
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
				// û������
				continue;
			}
			$limit_num = $_ORDER_LIMIT_CONF[$stock_id][$shipping_id][$ship_date][$time_span];
			if ($limit_num < 0) {
				// ����ʱ���û�����ƴ���
				continue;
			} else if ($limit_num > 0) {
				if (!isset($_ORDER_LIMIT_DATA[$stock_id][$shipping_id][$ship_date][$time_span])) {
					// ��������δ���ɵ������ļ��У�����û�����ƴ���
					continue;
				}
				$order_num = $_ORDER_LIMIT_DATA[$stock_id][$shipping_id][$ship_date][$time_span];
				$limited = ($order_num >= $limit_num) ? true : false;
			} else {
				// ��ʱ $limit_num = 0
				$limited = true;
			}

			if ($item['status'] == self::NORMAL && $limited) {
				// ���������ڵ����޵������Ѹ�ʱ���״̬��Ϊ�޵�״̬
				$list[$key]['status'] = self::LIMITED;
			}
		}
		return $list;
	}

	// ��ȡ����ʱ��κ�����
	private static function getDependValue($expect_time, $stock_id, $whid, $ship_type)
	{
		global $_StockToStation;
		$stock_whid = $_StockToStation[$stock_id];
		$N = 2;
		$T = $expect_time['expect_ship_date'];
		$now = time();
		if ($ship_type == ICSON_DELIVERY) {
			// ��Ѹ���
			if ($stock_whid == $whid) {
				// �ǿ��
				if ($expect_time['expect_time_span'] == NOON or $expect_time['expect_time_span'] == NIGHT) {
					// T ���������͵��޵�ֵ = T �����緢���޵�ֵ
					// T ���������͵��޵�ֵ = T �����緢���޵�ֵ
					$ship_date = $T;
					$time_span = self::$dependMap[$expect_time['expect_time_span']];
				} else {
					// T ���������͵��޵�ֵ = T-1 ��ҹ�䷢���޵�ֵ
					// T �����͵��޵�ֵ = T-1 ��ҹ�䷢���޵�ֵ
					$ship_date = date("Ymd", strtotime("{$T} -1 day"));
					$time_span = self::$dependMap[$expect_time['expect_time_span']];
				}
			} else {
				/*
				    ��� ȫ������ T-N�� ҹ����޵�ֵ
				    T ���������͵��޵�ֵ = T-N��ʵ�ʷ����ֵ�ҹ�䷢���޵�ֵ
				    T ���������͵��޵�ֵ = T-N��ʵ�ʷ����ֵ�ҹ�䷢���޵�ֵ
				    T ���������͵��޵�ֵ = T-N��ʵ�ʷ����ֵ�ҹ�䷢���޵�ֵ
				    T �����͵��޵�ֵ = T-N��ʵ�ʷ����ֵ�ҹ�䷢���޵�ֵ
				  ��ֶ������ۼ��ֿ��޵���ȵ����ڣ�ȡ�������������� - 5���롾�µ����ڡ�������
			    */
				$tmp = max(strtotime("{$T} -{$N} day"), $now);
				$ship_date = date("Ymd", $tmp);
				$time_span = NIGHT;
			}
		} else {
			// ����Ѹ��ݣ����� �µ����� ȫ����޵�ֵ
			$ship_date = $expect_time['expect_ship_date'];
			$time_span = ALLDAY;
		}

		// ���صļ�¼ʱ��
		$result = array(
			"ship_date" => $ship_date,
			"time_span" => $time_span,
		);
		return $result;
	}

	private static function getNormalDeliveryHint($list)
	{
		// �������ͨ�Ŀ�ݣ�ֻ��Ҫ���ص�һ�����õ�ʱ��Σ�����ǰ����ʾ
		$result = array();
		foreach ($list as $l) {
			if ($l['status'] == self::NORMAL) {
				$result[] = $l;
				break;
			}
		}
		return $result;
	}

	// ������������ʱ��ȥ��¼����ʱ��ε��µ�����, $order_num ��ʾ+1����-1
	public static function orderRecording($orderstosyn, $order_num = 1)
	{
		Logger::info("\n-------------start-------------\n");
//		Logger::info(var_export($orderstosyn,true));
		if (count($orderstosyn) > 0) {
			// �޵����ݿ�������Ӽ�¼��
			$limitOrderDB = Config::getDB("icson_core");
			if (false === $limitOrderDB) {
				Logger::err(Config::$errMsg);
				return false;
			}

			$sql = "begin";
			$ret = $limitOrderDB->execSql($sql);
			if ($ret === false) {
				Logger::err("�޵���¼����������ʧ��!" . $limitOrderDB->errMsg);
				return false;
			}

			foreach ($orderstosyn as $oid => $orderInfo) {
				/**
				if($orderInfo['status'] != 0 && $order_num > 0)
				{
				// ����û��Ѿ�ȡ���Ķ�����ͬ����ERP���򲻼�¼
				continue;
				}
				 **/
				$ship_type = $orderInfo['shipping_type'];
				$stock_id = $orderInfo['stockNo'];
				$wh_id = $orderInfo['hw_id'];

				// �û������������� �� �û���������ʱ���
				// ���û��ѡ��ʱ��Σ����¼Ϊ order_date���µ����ڣ� allday��ȫ�죩 ��Ҫ��!empty������isset����Ϊ���������expect_dly_date��expect_dly_time_spanΪ0
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
		// ��������ʱ���֮��Ĳ�ֵ����λ�� ��
		$diff_days = intval(($t2 - $t1) / self::ONE_DAY);

		// ���������������0�����Ƴ�N��
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
			self::$errMsg = "�����ݲ��ṩ���ͷ���лл���Ĺ�ע";
			return false;
		}
		else
		{
			$isExpect = false;
			if(!isset($icson_delivery_info['expect_ship_date']) || !isset($icson_delivery_info['expect_time_span']))
			{
				self::$errCode = -11;
				self::$errMsg = "û����������ʱ��";
				return false;
			}
			$expect_ship_date = $icson_delivery_info['expect_ship_date'];
			$expect_time_span = $icson_delivery_info['expect_time_span'];
			// �������ʱ���Ƿ��ڿ��õ�����ʱ���ڣ�Ĭ�ϲ���ȷ

			foreach ($timeAvailable as $span) {
				if (strtotime($span['ship_date']) == strtotime($expect_ship_date) && $span['time_span'] == $expect_time_span ) // ���µ�ʱ��δ���
				{
					// �ҵ����û���ѡ��ʱ�䣬���ݵ�ǰ״̬����ʾ
					$s = IShippingTime::$timeSpan[$span['time_span']];
					$selected_time = date("n��j��{$s}",strtotime($span['ship_date']));
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
							self::$errMsg = "�����ᵥʱ��{$stop}����ѡ���\"{$selected_time}\"�Ѳ����ã�����ȷ��������ѡ��";
							break;
						case IShippingTime::LIMITED:
							$isExpect = false;
							self::$errCode = -11;
							self::$errMsg = "��ѡ���\"{$selected_time}\"�����������������ȷ��������ѡ��";
							break;
						default;
							break;
					}
					return $isExpect;
				}
			}
		}
		self::$errCode = -11;
		self::$errMsg = "���ύ������ʱ�䲻��ȷ������ȷ��������ѡ��";
		return false;
	}
}

