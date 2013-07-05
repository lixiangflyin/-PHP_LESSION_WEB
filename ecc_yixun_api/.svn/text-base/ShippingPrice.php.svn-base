<?php

require_once(PHPLIB_ROOT . 'inc/constant.inc.php');
require_once(PHPLIB_ROOT . 'inc/district.inc.php');
require_once(PHPLIB_ROOT . 'inc/ship.inc.php');
require_once(PHPLIB_ROOT . 'inc/privilegeForShipPrice.inc.php');


class EA_ShippingPrice
{
	private static $errCode = 0;
	private static $errMsg = '';
	private static $IcsonShip = array(1,2,7,30800,92,30612,30761,30762,30752,30753,30804,30790,30812,30821,31478,31485,31484,50077,50078,50079,50080,50081,50082,50083,50084,50085,50086);
	
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
		$shipInfo['user_level'] = empty($data['user_level']) ? 0 : $data['user_level'];
		$shipInfo['order_date'] = empty($data['order_date']) ? date("Y-m-d") : $data['order_date'];
		
		//计算所需运费		
		$shipCost = self::calShipCost($shipInfo);
		
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
		$shipCost['free_price_limit'] = $is_free['free_price_limit'];
		$shipCost['free_type'] = $is_free['free_type'];
		return $shipCost;
	}

	
	/**
	 * 该函数用于计算订单的配送费用
	 * 输入：$shipInfo()
	 * 
	 */
	private function calShipCost(&$shipInfo)
	{
		global $_DCToRegion , $_District;
		$result = array();
		
		$shippingId = $shipInfo['shipping_id'];
		$wh_id = $shipInfo['wh_id'];
		$destination = $shipInfo['destination'];
		$orderWeight = $shipInfo['order_weight'];

		$des_dc = IProductInventory::getDCFromDistrict($destination, $wh_id);
		if ( ! isset($_DCToRegion[$des_dc]) ) {
			self::$errCode = 1006;
			self::$errMsg = '没有设置分站（$wh_id）到区域的映射';
			return array('errCode'=> self::$errCode, 'errMsg' => self::$errMsg);
		}
		$source_region = $_DCToRegion[$des_dc];	//起始区域
		$dest_array = array($destination,			//目的区域
            $_District[$destination]['city_id'],
            $_District[$destination]['province_id']
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
			else if ($spp['shipping_id'] == $shippingId && $spp['destination'] == $_District[$destination]['city_id'])
			{
				$toCityKey = $k;
			}
			else if ($spp['shipping_id'] == $shippingId && $spp['destination'] == $_District[$destination]['province_id'])
			{
				$toProvinceKey = $k;
			}
		}
		
		
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
				if ($spp['shipping_id'] == $shippingId && $spp['destination'] == $_District[$destination]['city_id']) 
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
				if ($spp['shipping_id'] == $shippingId && $spp['destination'] == $_District[$destination]['province_id']) 
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
	private function checkIsFree(&$orderInfo)
	{
		$shippingId = $orderInfo['shipping_id'];
		$whId = $orderInfo['wh_id'];
		$orderPrice = $orderInfo['order_price'];
		$result = array('is_free'=>false, 'free_type' => 0, 'free_price_limit' => 0);
		
		//目前网站端购物流程中，以下分支需要特殊处理，该逻辑只为配合这些特殊逻辑
		if((!empty($orderInfo['is_installment'])) || (!empty($orderInfo['is_customerphone'])))//分期付款订单，合约机订单
		{
			$result['is_free'] = true;
			return $result;
		}
		
		global $_PrivilegeList;
		foreach ($_PrivilegeList as $p)
		{
			if(1 == $p['type']) //满XX元免运费
			{
				//判断金额是否不合要求
				if(true === $orderInfo['is_mobile'])
				{
					$is_meet_price = !(bccomp($orderPrice, $p['conditon']['wareless_limit'][$whId], 0) < 0);
					$free_price_limit = $p['conditon']['wareless_limit'][$whId];
				}
				else
				{
					$is_meet_price = !(bccomp($orderPrice, $p['conditon']['pc_limit'][$whId], 0) < 0);
					$free_price_limit = $p['conditon']['pc_limit'][$whId];
				}

				if(true === $is_meet_price && in_array($shippingId, $p['shiptype_limit']))
				{
					$result['is_free'] = true;
					$result['free_type'] = $p['type']; //返回免运费的使用的规则id
					$result['free_price_limit'] = $free_price_limit;
				}
			}
			
			if(2 === $p['type']) //根据用户等级判断是否免运费，存在下单前后用户等级不一致的情况，此处无法解决。
			{
				if(true === $orderInfo['is_mobile'])
				{
					$is_meet_level = (!($orderInfo['user_level'] < $p['condition']['wareless_limit'])) ? true : false;
				}
				else
				{
					$is_meet_level = (!($orderInfo['user_level'] < $p['condition']['pc_limit'])) ? true : false;
				}

				if(true === $is_meet_level)
				{
					$result['is_free'] = true;
					$result['free_type'] = $p['type']; //返回免运费的使用的规则id
					$result['free_price_limit'] = 0;
					break;
				}
			}

			if(3 === $p['type'])
			{
				//规则明细：每个月8号(会员日)，0点-24点，铜盾及以上用户全场免运费
				if( ($p['time'] == date('d',strtotime($orderInfo['order_date']))) && (!($orderInfo['user_level'] < $p['level'])) )
				{
					$result['is_free'] = true;
					$result['free_type'] = 3; //3月8号铜盾及以上用户全场免运费
					$result['free_price_limit'] = 0;
					break;
				}
			}
		}

		return $result;
	}
}