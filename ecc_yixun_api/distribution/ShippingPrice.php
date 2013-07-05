<?php
/**
 * @brief 前台运费计算模块
 */

require_once(PHPLIB_ROOT.'api/distribution/ShipConst.php');
require_once(PHPLIB_ROOT.'api/distribution/ShippingTime.php');
require_once(PHPLIB_ROOT.'api/distribution/District.php');
class LIB_ShippingPrice
{
	private static $errCode = 0;
	private static $errMsg = '';
	private static $IcsonShip = array(1,92,30612,30761,30762,30752,30753,30804,30790,30812,30821);
	public  static $_WhidToRegion = array(
				SITE_SH  => 2621,
				SITE_SZ  => 420,
				SITE_BJ  => 131,
				SITE_WH  => 1324,
				SITE_CQ  => 158,
				SITE_XA  => 2213,
		);	
	
	public  static $_RegionToWhid = array(
				2621 => SITE_SH,
				420 => SITE_SZ,
				131 => SITE_BJ,
				158 => SITE_CQ,
				1324 => SITE_WH,
				2213 => SITE_XA,
		);
	
	/**
	 * 对外提供的服务接口，可以返回订单最终的运费
	 * $data = array(
	 * 	'shipping_id' => 1,		//配送方式id
	 *  'wh_id' => 1,			//起始站点
	 *  'destination' => 2306,	//收获地区
	 *  'order_price' => 100,	//订单实际需支付的金额
	 *  'order_info'=> array(
	 *  	1 => array(
	 *  		'weight' => 20, 
	 *  	),
	 *  	1001 => array(
	 *  		'weight' => 40,
	 *  	),
	 *  ),
	 * )
	 */
	public static function get($data)
	{
		$shipInfo = array();
		$orderInfo = array();
		
		//检查传入的参数是否齐全
		if(empty($data['shipping_id']))
		{
			self::$errCode = 1001;
			self::$errMsg =  basename(__FILE__, '.php') . " | " . __LINE__ . " shippingId is empty";
			return array('errCode'=> self::$errCode, 'errMsg' => self::$errMsg);
		}
		else 
		{
			$shipInfo['shipping_id'] = $data['shipping_id'];
		}
		
		if(empty($data['wh_id']))
		{
			self::$errCode = 1002;
			self::$errMsg =  basename(__FILE__, '.php') . " | " . __LINE__ . " whId is empty";
			return array('errCode'=> self::$errCode, 'errMsg' => self::$errMsg);
		}
		else 
		{
			$shipInfo['wh_id'] = $data['wh_id'];
		}
		
		if(empty($data['destination']))
		{
			self::$errCode = 1003;
			self::$errMsg =  basename(__FILE__, '.php') . " | " . __LINE__ . " destination is empty";
			return array('errCode'=> self::$errCode, 'errMsg' => self::$errMsg);
		}
		else 
		{
			$shipInfo['destination'] = $data['destination'];
		}
		
		if(empty($data['order_info']))
		{
			self::$errCode = 1004;
			self::$errMsg =  basename(__FILE__, '.php') . " | " . __LINE__ . " order_info is empty";
			return array('errCode'=> self::$errCode, 'errMsg' => self::$errMsg);
		}
		else
		{
			foreach($data['order_info'] as $stock_id => $index)
			{
				$shipInfo['order_weight'][$stock_id] = $index['weight'];
			}
		}
		$shipInfo['order_price'] = empty($data['order_price']) ? 0 : $data['order_price'];
		$shipInfo['is_mobile'] = empty($data['is_mobile']) ? false : $data['is_mobile'];
		$shipInfo['is_installment'] = empty($data['is_installment']) ? false : $data['is_installment'];
		$shipInfo['is_customerphone'] = empty($data['is_customerphone']) ? false : $data['is_customerphone'];
		
		
		//计算所需运费		
		$shipCost = self::calShipCost($shipInfo);
		Logger::err(var_export($shipCost,true));
		//检查是否符合免运费的规则
		$is_free = self::checkIsFree($shipInfo);
		if(true === $is_free['is_free'])
		{
			$shipCost['shippingCost'] = $shipCost['shippingPrice'];
			$shipCost['shippingPrice'] = 0;
			foreach ($data['order_info'] as $subOrderIndex => $suborder) 
			{
				$shipCost['subShipPrice'][$subOrderIndex]['shippingCost'] = $shipCost['subShipPrice'][$subOrderIndex]['shippingPrice'];
				$shipCost['subShipPrice'][$subOrderIndex]['shippingPrice'] = 0;
			}
		}
		else {
			if (in_array($shipInfo['shipping_id'], self::$IcsonShip)){
				if(bccomp($data['orderPrice'], 9900, 0) < 0){
					if ($shipCost['shippingPrice'] == 0){
						$shipCost['shippingCost'] = 500;
						$shipCost['shippingPrice'] = 500;
						foreach ($data['order_info'] as $subOrderIndex => $suborder)
						{
							$shipCost['subShipPrice'][$subOrderIndex]['shippingCost'] = $shipCost['subShipPrice'][$subOrderIndex]['shippingPrice'];
							$shipCost['subShipPrice'][$subOrderIndex]['shippingPrice'] = 500;
							break;
						}	
					}
				}
			}
			
		}
		$result['shippingPrice'] = 0;
		$result['shippingPriceCut'] = 0;
		$shipCost['free_price_limit'] = $is_free['free_price_limit'];
		$shipCost['free_type'] = $is_free['free_type'];
		return $shipCost;
	}

	
	/**
	 * 该函数用于计算订单的配送费用
	 * 输入：$shipInfo()
	 * 
	 */
	public static function calShipCost(&$shipInfo)
	{
	
		$result = array();
		
		$shippingId = $shipInfo['shipping_id'];
		$wh_id = $shipInfo['wh_id'];
		$destination = $shipInfo['destination'];
		$orderWeight = $shipInfo['order_weight'];
		
		if ( ! isset(self::$_WhidToRegion[$wh_id]) ) {
			self::$errCode = 1006;
			self::$errMsg = '没有设置分站（$wh_id）到区域的映射';
			return array('errCode'=> self::$errCode, 'errMsg' => self::$errMsg);
		}
		$source_region = self::$_WhidToRegion[$wh_id];	//起始区域
		$dest_array = array($destination,			//目的区域
            District::$District[$destination]['city_id'],
            District::$District[$destination]['province_id']
		);	
		$toDistrictKey = -1;
		$toCityKey = -1;
		$toProvinceKey = -1;

		
		//从 $wh_id 出发到 $destination 的运送方式配置可能配到省，或市，或区中任何一个，以配置的数据里最精确的一级为准
		$shippingPrice = IShippingPriceTTC::gets(
			$dest_array,
			array('wh_id' => $source_region, 'status' => 0 )
		);

		if (false === $shippingPrice)
		{
			self::$errCode = IShippingPriceTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[get IShippingPriceTTC failed]' . IShippingPriceTTC::$errMsg;
			return array('errCode'=> self::$errCode, 'errMsg' => self::$errMsg);
		}
		
		//决定是用省，市，还是区来计算运费
		foreach ($shippingPrice as $k => $spp)
		{
			if ($spp['shipping_id'] == $shippingId  && $spp['destination'] == $destination)
			{
				$toDistrictKey = $k;
				break;
			}
			else if ($spp['shipping_id'] == $shippingId && $spp['destination'] == District::$District[$destination]['city_id'])
			{
				$toCityKey = $k;
			}
			else if ($spp['shipping_id'] == $shippingId && $spp['destination'] == District::$District[$destination]['province_id'])
			{
				$toProvinceKey = $k;
			}
		}
		
		Logger::err($toDistrictKey . " " .$toCityKey . "　　". $toProvinceKey);
		//开始计算运费
		if (-1 != $toDistrictKey)
		{

			$result['shippingPrice'] = 0;
			$result['shippingPriceCut'] = 0;
			foreach ($shippingPrice as $spp)
			{
				if ($spp['shipping_id'] == $shippingId && $spp['destination'] == $destination)
				{
					foreach ($orderWeight as $subOrderIndex => $totalWeight)
					{
						$result['subShipPrice'][$subOrderIndex]['shippingPriceCut'] = 0;
						if ($totalWeight > $spp['max_weight'])
						{
							$tmp = ceil(($spp['max_weight'] - $spp['base_weight']) / $spp['unit_weight']) * $spp['unit_weight_price'];
							@$result['subShipPrice'][$subOrderIndex]['shippingPrice'] += $tmp;
							$result['shippingPrice'] += $tmp;
						}
						
						else if ($totalWeight > $spp['base_weight'])
						{
							$tmp = ceil(($totalWeight - $spp['base_weight']) / $spp['unit_weight']) * $spp['unit_weight_price'];
							@$result['subShipPrice'][$subOrderIndex]['shippingPrice'] += $tmp;
							$result['shippingPrice'] += $tmp;
						}
						else
						{
							@$result['subShipPrice'][$subOrderIndex]['shippingPrice'] += 0;
						}
					}
				}
			}
		}
		else if (-1 != $toCityKey)
		{
			$result['shippingPrice'] = 0;
			$result['shippingPriceCut'] = 0;
			foreach ($shippingPrice as $spp)
			{
				if ($spp['shipping_id'] == $shippingId && $spp['destination'] == District::$District[$destination]['city_id']) 
				{
					foreach ($orderWeight as $subOrderIndex => $totalWeight)
					{
		
						$result['subShipPrice'][$subOrderIndex]['shippingPriceCut'] = 0;
						if ($totalWeight > $spp['max_weight'])
						{
							$tmp = ceil(($spp['max_weight'] - $spp['base_weight']) / $spp['unit_weight']) * $spp['unit_weight_price'];
							@$result['subShipPrice'][$subOrderIndex]['shippingPrice'] += $tmp;
							$result['shippingPrice'] += $tmp;

						}
						
						else if ($totalWeight > $spp['base_weight'])
						{
							$tmp = ceil(($totalWeight - $spp['base_weight']) / $spp['unit_weight']) * $spp['unit_weight_price'];
							@$result['subShipPrice'][$subOrderIndex]['shippingPrice'] += $tmp;
							$result['shippingPrice'] += $tmp;
						}
						else
						{
							@$result['subShipPrice'][$subOrderIndex]['shippingPrice'] += 0;
						}
					}
				}
			}
		}
		else if (-1 != $toProvinceKey)
		{

			$result['shippingPrice'] = 0;
			$result['shippingPriceCut'] = 0;
			foreach ($shippingPrice as $spp)
			{
				if ($spp['shipping_id'] == $shippingId && $spp['destination'] == District::$District[$destination]['province_id']) 
				{

					foreach ($orderWeight as $subOrderIndex => $totalWeight)
					{
						$result['subShipPrice'][$subOrderIndex]['shippingPriceCut'] = 0;
						if ($totalWeight > $spp['max_weight'])
						{
							$tmp = ceil(($spp['max_weight'] - $spp['base_weight']) / $spp['unit_weight']) * $spp['unit_weight_price'];
							@$result['subShipPrice'][$subOrderIndex]['shippingPrice'] += $tmp;
							$result['shippingPrice'] += $tmp;
						}
						else if ($totalWeight > $spp['base_weight'])
						{
							$tmp = ceil(($totalWeight - $spp['base_weight']) / $spp['unit_weight']) * $spp['unit_weight_price'];
							@$result['subShipPrice'][$subOrderIndex]['shippingPrice'] += $tmp;
							$result['shippingPrice'] += $tmp;
						}
						else
						{
							@$result['subShipPrice'][$subOrderIndex]['shippingPrice'] += 0;
						}
					}
				}
			}
		}
		else 
		{

			foreach ($orderWeight as $subOrderIndex => $totalWeight) 
			{
				$result['subShipPrice'][$subOrderIndex]['shippingPrice'] = 0;
				$result['subShipPrice'][$subOrderIndex]['shippingPriceCut'] = 0;
			}
			$result['shippingPrice'] = 0;
			$result['shippingPriceCut'] = 0;
		}
		//ixiuzeng,对于易迅快递(易迅第三方快递)且拆单的运费，只保留一个子订单的运费。涉及到选择哪个子订单的运费为总运费
		if(in_array($shippingId, self::$IcsonShip))
		{
			$subOrderNum = count($orderWeight);
			if( 0 != $subOrderNum )
			{
				foreach($orderWeight as $subOrderIndex => $totalWeight)
				{
					if($subOrderNum == 1)
					{
						break;
					}
					$result['shippingPrice'] -= $result['subShipPrice'][$subOrderIndex]['shippingPrice'];
					$result['subShipPrice'][$subOrderIndex]['shippingPrice'] = 0;
					$subOrderNum--;
				}	
			}
		}

		//记录实际的运费
		foreach ($orderWeight as $subOrderIndex => $totalWeight)
		{
			$result['subShipPrice'][$subOrderIndex]['shippingCost'] = $result['subShipPrice'][$subOrderIndex]['shippingPrice'];
		}
		$result['shippingCost'] = $result['shippingPrice'];
		
		return $result;
	}
	
	/**
	 * 该函数用于判断订单是否符合免运费的各种规则
	 * 返回值：true表示邮费全免
	 */
	public static function checkIsFree(&$orderInfo)
	{
		$shippingId = $orderInfo['shipping_id'];
		$whId = $orderInfo['wh_id'];
		$orderPrice = $orderInfo['order_price'];
		$result = array('is_free'=>false, 'free_type' => 0, 'free_price_limit' => 0);
		
		//易迅快递含第三方 则免运费
		//if (in_array($shippingId, self::$IcsonShip)){
			$is_meet_price = !(bccomp($orderPrice, 9900, 0) < 0);
	
			$result['is_free'] = $is_meet_price;
			return $result;
		//}
			
		return $result;
	}
}