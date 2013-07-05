<?php
require_once(PHPLIB_ROOT.'api/distribution/ShipConst.php');
require_once(PHPLIB_ROOT.'api/distribution/District.php');
require_once(PHPLIB_ROOT.'api/distribution/ShippingPrice.php');
/**
 * ��װ�ͻ�ʱ�����
 */
class LIB_ShippingTime
{
	public static $errCode = 0;
	public static $errMsg = '';

	private static $timeSpan = array('1' => '����', '2' => '����', '3' => '����', '4' => "");
	private static $weekDays = array('1' => '����һ', '2' => '���ڶ�', '3' => '������', '4' => '������', '5' => '������', '6' => '������', '7' => '������');

	// ʱ��״̬���
	CONST NORMAL = 0; // ������ʱ���
	CONST EXPIRE = -1; // ������ڵ�ʱ���
	CONST LIMITED = -2; // �޵���ʱ���

	CONST ONE_DAY = 86400; // 24*60*60 ÿ�������
	CONST DAY_LIMIT = 7; // ����7���ʱ���

	CONST MORNING =  1;
	CONST NOON =  2;
	CONST NIGHT =  3;
	CONST ALLDAY =  4;
	CONST VIRTUAL_STOCK_TYPE_1 = 1; // �������1
	CONST VIRTUAL_STOCK_TYPE_2 = 2; // �������2
	CONST VIRTUAL_STOCK_TYPE_3 = 3; // �������3
	CONST VIRTUAL_STOCK_TYPE_4 = 4; // �������4
	CONST VIRTUAL_STOCK_TYPE_5 = 5; // �������4
	CONST VIRTUAL_STOCK_TYPE_6 = 6; // �������4
	// ����ӳ���������
	public static $vStockDelay = array(
		self::VIRTUAL_STOCK_TYPE_1 => 2, // ����1�ӳ�2��
		self::VIRTUAL_STOCK_TYPE_2 => 5, // ����2�ӳ�5��
		self::VIRTUAL_STOCK_TYPE_3 => 9, // ����3�ӳ�9��
		self::VIRTUAL_STOCK_TYPE_4 => 20, // ����4�ӳ�20��
		self::VIRTUAL_STOCK_TYPE_5 => 21, // ����4�ӳ�21��
		self::VIRTUAL_STOCK_TYPE_6 => 30, // ����4�ӳ�30��
	);


	// Ԥ���ӳ���������
	public static $bookingDelay = array(
		10,//LIB_Product::BOOKING_TYPE_SPECIFIC_DELAY,
		11,//LIB_Product::BOOKING_TYPE_SPECIFIC_DATE,
		12,//LIB_Product::BOOKING_TYPE_NOSPECIFIC_DATE,
	);

	// �ֿ⵽��վ������������ʱ
	public static $_StockToWhidTransitDays = array(
			STOCK_SH_1    => array( // �Ϻ�һ�Ų�
					SITE_SH => 0,
					SITE_SZ => 3,
					SITE_BJ => 3,
					SITE_WH => 1,
					SITE_CQ => 3,
					SITE_XA => 3,
			),
			STOCK_SH_5    => array( // �Ϻ���Ų�
					SITE_SH => 0,
					SITE_SZ => 100,
					SITE_BJ => 100,
					SITE_WH => 100,
					SITE_CQ => 100,
					SITE_XA => 100,
			),
			STOCK_SH_6    => array( // �Ϻ���Ų�
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
			Logger::err('icson_core t_shipping_time ��ѯʧ�� sql' . $sql . $where);
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

		$source_region = LIB_Shipping::$_WhidToRegion[$whid];
		$delivery_info = IShippingRegionTTC::get($district, array('wh_id' => $source_region, 'shipping_id' => ICSON_DELIVERY, 'status' => 0));

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
				if ($it['ship_date'] == $today && $it['time_span'] == self::MORNING) {
					$list[$key]['status'] = LIB_ShippingTime::EXPIRE;
					break;
				}
			}
		} else if ($nTime >= $time_23_00 && $nTime <= $time_23_59) {
			// ����ڵ����23:00�㵽24:00��֮�䣬��Ҫ�޳��ڶ����������ʱ���

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
//ELFlow::getInstance("test_shipping")->append(var_export($delivery_info,true));
		//Logger::info(var_export($delivery_info,true));
		// ����
		if (in_array($delivery_info['shipping_id'], LIB_Shipping::$shipType_SELF)) {
			return self::getCarryTimeList($delivery_info, $whid, $district, $isVirtual);
		}
		// ������
		$ret = self::getShipModeList($delivery_info, $whid, $district, $isVirtual);
		//ELFlow::getInstance("shipping")->append(var_export($ret,true));
		ELFlow::getInstance("shipping")->append(var_export(self::$errMsg,true));
		return $ret;
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
		$nTime = self::transitDelay($delivery_info, $nTime, $whid);
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
		
		if (District::$District[$district]['city_id'] == 1692) {
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
			$virtual_value = 2;
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
				 *      'type' => LIB_Product::BOOKING_TYPE_SPECIFIC_DELAY,
				 *	    'value' => 3,// ��ʾ�Ӻ�3��
				 * )
				 * */
				case 10 : //LIB_Product::BOOKING_TYPE_SPECIFIC_DELAY:
					// ���������������ǿ��Ϊ0
					if (!is_numeric($virtual_value))
						$virtual_value = 0;
					$nTime += $virtual_value * self::ONE_DAY;
					break;


				/*
				 * �̶�����, $virtual_value ֵΪָ��������
				 * $virtual = array(
				 *      'type' => LIB_Product::BOOKING_TYPE_SPECIFIC_DELAY,
				 *		'value' => "2013-02-11",// ��ʾ2013��2��11�Ų�����
				 *	)
				 */
				case 11://LIB_Product::BOOKING_TYPE_SPECIFIC_DATE:
					// TODO ����������ڣ���ǿ��Ϊ0
					$due_date = strtotime($virtual_value);
					Logger::info($due_date);
					$N = LIB_ShippingTime::getDiffDays(time(), $due_date);
					Logger::info($N);
					$nTime += ($N + 1) * self::ONE_DAY;
					break;

				/* �̶��ӳ�����
				 * $virtual = array(
				 *      'type' => LIB_Product::BOOKING_TYPE_SPECIFIC_DELAY,
				 *	    'value' => N,// ��ʾ�Ӻ�N�죬NΪϵͳ�趨��һ��Ĭ��ֵ����ܴ�
				 * )
				 * */
				case 12://LIB_Product::BOOKING_TYPE_NOSPECIFIC_DATE:
					$nTime += $virtual_value * self::ONE_DAY;
					break;
			}
		} else if ( $virtual_type == false) {
			// �ֻ��� ����� ���� empty;
		} else if ( $virtual_type == self::VIRTUAL_STOCK_TYPE_1 or $virtual_type === true) {
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
	private static function transitDelay($delivery_info, $nTime, $whid)
	{
		if (!isset(self::$_StockToWhidTransitDays[$delivery_info['stock_num']])) {
			self::$errMsg = "û�����÷ֲֵ���վ��������ʱ!";
			return false;
		}
		$transit_days = self::$_StockToWhidTransitDays[$delivery_info['stock_num']][$whid];
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
	 * ���������ȡ��ʱ������
	 * �������� 1:���� 2:���� 4:�ڶ�������
	 * @param whid          �ֿ���
	 * @param isAmLimit   �����Ƿ��޵�
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


	// ���ù���ʱ���
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
		//��ȡ����Ĭ��ֵ
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

	// �����޵���������������ʱ���״̬
	private static function setOrderLimitStatus($delivery_info, $wh_id, $list)
	{

		return $list;
	}

	// ��ȡ����ʱ��κ�����
	private static function getDependValue($expect_time, $stock_id, $whid, $ship_type)
	{
		global $_StockToStation;
		$stock_whid = $_StockToStation[$stock_id];
		$N = 5; //$_StockToWhidTransitDays[$stock_id][$whid];
		$T = $expect_time['expect_ship_date'];
		$now = time();
		if ($ship_type == ICSON_DELIVERY) {
			// ��Ѹ���
			if ($stock_whid == $whid) {
				// �ǿ��
				if ($expect_time['expect_time_span'] == self::NOON or $expect_time['expect_time_span'] == self::NIGHT) {
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
				$time_span = self::NIGHT;
			}
		} else {
			// ����Ѹ��ݣ����� �µ����� ȫ����޵�ֵ
			$ship_date = $expect_time['expect_ship_date'];
			$time_span = self::ALLDAY;
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

	public static function getDiffDays($t1, $t2)
	{
		// ��������ʱ���֮��Ĳ�ֵ����λ�� ��
		$diff_days = intval(($t2 - $t1) / self::ONE_DAY);

		// ���������������0�����Ƴ�N��
		$N = $diff_days > 0 ? $diff_days : 0;
		return $N;
	}
}

