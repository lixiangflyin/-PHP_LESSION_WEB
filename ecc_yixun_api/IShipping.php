<?php
require_once(PHPLIB_ROOT . 'inc/district.inc.php');
require_once(PHPLIB_ROOT . 'inc/ship.inc.php');
require_once(PHPLIB_ROOT . 'inc/ShipRestrice.inc.php');
/*错误码定义
500:地区编码不合法
501：运送方式不合法
502：商品重量不合法
*/

class IShipping
{
	// 需要返回时间列表的快递方式
	public static $shipType_TL = array(
		ICSON_DELIVERY,
		SELF_DELIVERY_SH,

	);

	// 自提快递方式
	public static $shipType_SELF = array(
		SELF_DELIVERY_SH
	);

	public static $errCode = 0;
	public static $errMsg = '';


	public static function getDistrictInfo($district)
	{
		global $_District, $_City, $_Province;
		if (!isset($_District[$district]['city_id']) && !isset($_District[$district]['province_id'])) {
			self::$errCode = -1;
			self::$errMsg = "三级地区ID错误,无需检查";
			return false;
		}

		$result['district_name'] = $_District[$district]['name'];
		$result['province_id'] = $_District[$district]['province_id'];
		$result['city_id'] = $_District[$district]['city_id'];
		$result['region_id'] = $district;


		$city_id = $_District[$district]['city_id'];
		$province_id = $_District[$district]['province_id'];

		if (!isset($_City[$city_id]['name']) && !isset($_Province[$province_id]['name'])) {
			self::$errCode = -2;
			self::$errMsg = "省市ID错误,无需检查";
			return false;
		}

		$result['city_name'] = $_City[$city_id]['name'];
		$result['province_name'] = $_Province[$province_id];


		return $result;
	}

	public static function getShippingTypeByRegion($regionId)
	{
		if (!isset($regionId) || $regionId <= 0) {
			self::$errCode = 500;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "regionId($regionId) is invalid";
			return false;
		}

		$item = IShippingRegionTTC::get($regionId, array('size_type'=> 1 ));
		if (false === $item) {
			self::$errCode = IShippingRegionTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[update IShippingRegionTTC failed]' . IShippingRegionTTC::$errMsg;
			return false;
		}

		return $item;
	}

	//需要确定运费计算规则，以及运费减免规则
	public static function calcShippingPrice($shippingType, $regionId, $weight)
	{
		if (!isset($regionId) || $regionId <= 0) {
			self::$errCode = 500;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "regionId($regionId) is invalid";
			return false;
		}

		if (!isset($shippingType) || $shippingType <= 0) {
			self::$errCode = 501;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "shippingType($shippingType) is invalid";
			return false;
		}

		if (!isset($weight) || $weight <= 0) {
			self::$errCode = 502;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "weight($weight) is invalid";
			return false;
		}

		$item = IShippingPriceTTC::get($shippingType, array('addr'=>$regionId));
		if (false === $item) {
			self::$errCode = IShippingPriceTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[update IShippingPriceTTC failed]' . IShippingPriceTTC::$errMsg;
			return false;
		}

		//按规则计算运费

		return 0;
	}

	// 根据目的地址，获取易迅快递配送信息，如果该地区不支持易迅快递则返回false
	public static function getIcsonDeliveryInfoByRegion($dest_region,$wh_id = -1)
	{
		// 根据分站id，获得该分站对应的发货地区
		global $_DCToRegion,$_District;
		if($wh_id == -1 )
			$wh_id = IUser::getSiteId();

		$des_dc = IProductInventory::getDCFromDistrict($dest_region, $wh_id); //根据用户的三级地址和站id获得对应DC
		if(empty($des_dc))
		{
			//如果找不到DC，需要记录
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[get dcsysno error]';
			return false;
		}
		$source_region = $_DCToRegion[$des_dc];
		$dest_region_array = array(
			$dest_region,
			$_District[$dest_region]['city_id'],
			$_District[$dest_region]['province_id']
		);
		$delivery_info = IShippingRegionTTC::gets($dest_region_array, array('wh_id' => $source_region, 'shipping_id' => ICSON_DELIVERY, 'size_type'=> 1 ));

		//Logger::info(var_export($delivery_info,true));

		// 结果只能有一个

		if( false === $delivery_info )
		{
			self::$errMsg = basename(__FILE__, '.php') . " IShippingRegionTTC get error :".IShippingRegionTTC::$errMsg.",line:". __LINE__ ;
			return false;
		}
		//此处如果结果集$delivery_info为空数组的话，$delivery_info[0]会报Notice  add by derongzeng
		$delivery_info = $delivery_info[0];
		$timespan = array();
		switch($delivery_info['delivery_time'])
		{
			case 1:
				break;
			case 2:
				$timespan = array(1,2);
				break;
			case 3:
				$timespan = array(1,2,3);
				break;
			default:
				IShipping::$errMsg = "getIcsonDeliveryInfoByRegion delivery_time error!";
				return false;
				break;
		}

		$delivery_info['time_span'] = $timespan;
		return $delivery_info;
	}


    // 多分仓版的限运逻辑
    public static function getForbidenShippingType($forbidenShipArr, $province, $city, $district, $wh_id=1)
    {
        if (empty($forbidenShipArr)) {
            return array();
        }
        global $_LGT_MODE;
		global $shipLimit;
        $shipNotAva = array();

        foreach($forbidenShipArr as $ship=>$products)
        {

        	/** flycgu
        	  * $shipLimit = array(
        	 * 		'wh_id' => array(
        	 * 			'ship' => array(
        	 * 				'0' => array(),只能选择**快递方式
        	 * 				'1' => array(),不能选择**快递方式
        	 * 				'2' => array(  不在**地区无法使用**快递方式
        	 * 					'province' =>array(),省
        	 * 					'city' =>array(),市
        	 * 					'district' => array(),区
        	 * 					'delivery' =>array(),快递方式
        	 * 				),
        	 * 				'3' => array(  在**地区无法使用**快递方式
        	 * 					'province' =>array(),省
        	 * 					'city' =>array(),市
        	 * 					'district' => array(),区
        	 * 					'delivery' =>array(),快递方式
        	 * 				),
        	 * 			),
        	 * 			...
        	 * 		),
        	 * 		...
        	 * )
        	 ***/

			if ( !empty($shipLimit[$wh_id][$ship]) )
			{
				//第一种语义，只能选择**快递方式
				if ( !empty($shipLimit[$wh_id][$ship]['0']) )
				{
					foreach ($_LGT_MODE as $l){
						$tmp = 1;
						foreach ($shipLimit[$wh_id][$ship]['0'] as $delivery)
						{
							if ($l['SysNo'] == $delivery)
							{
								$tmp = 0;
							}
						}
						if ($tmp == 1)
						{
							if (!isset($shipNotAva[$l['SysNo']]))
							{
								$shipNotAva[$l['SysNo']] = array();
							}
							$shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
						}
					}
				}
				//第二种语义，不能选择**快递方式
				if ( !empty($shipLimit[$wh_id][$ship]['1']) )
				{
					foreach ($shipLimit[$wh_id][$ship]['1'] as $delivery)
					{
						if (!isset($shipNotAva[$delivery]))
						{
							$shipNotAva[$delivery] = array();
						}
						$shipNotAva[$delivery] = array_merge($shipNotAva[$delivery], $products);
					}
				}
				//第三种语义，不在**地区无法使用**快递方式，即在这些
				if ( !empty($shipLimit[$wh_id][$ship]['2']) ){
					foreach ($shipLimit[$wh_id][$ship]['2'] as $k => $limit){
						if (empty($limit['province'])){
							$limit['province'] = array();
						}
						if (empty($limit['city'])){
							$limit['city'] = array();
						}
						if (empty($limit['district'])){
							$limit['district'] = array();
						}
						if ( (!in_array($province,$limit['province'])) && (!in_array($city, $limit['city'])) && (!in_array($district, $limit['district'])) )
						{
							if (empty($limit['delivery']))
							{
								foreach($_LGT_MODE as $l)
								{
									if (!isset($shipNotAva[$l['SysNo']]))
									{
										$shipNotAva[$l['SysNo']] = array();
									}
									$shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
								}
							}
							else {
								foreach ($limit['delivery'] as $delivery)
								{
									if (!isset($shipNotAva[$delivery]))
									{
										$shipNotAva[$delivery] = array();
									}
									$shipNotAva[$delivery] = array_merge($shipNotAva[$delivery], $products);
								}
							}
						}
					}
				}
				//第四种语义，在**地区无法使用**快递方式
				if ( !empty($shipLimit[$wh_id][$ship]['3']) ){
                    foreach ($shipLimit[$wh_id][$ship]['3'] as $k => $limit){
                        if (empty($limit['province'])){
                            $limit['province'] = array();
                        }
                        if (empty($limit['city'])){
                            $limit['city'] = array();
                        }
                        if (empty($limit['district'])){
                            $limit['district'] = array();
                        }
                        if ( in_array($province, $limit['province']) || in_array($city, $limit['city']) || in_array($district, $limit['district']) )
                        {
                            foreach ($limit['delivery'] as $delivery)
                            {
                                if (!isset($shipNotAva[$delivery]))
                                {
                                    $shipNotAva[$delivery] = array();
                                }
                                $shipNotAva[$delivery] = array_merge($shipNotAva[$delivery], $products);
                            }
                        }
                    }
				}
			}


            /*
            if ($wh_id == SITE_SH)
            {
                if ($ship == 4)
                {
                    //仅限易迅快递
                    foreach($_LGT_MODE as $l)
                    {
                        // 45为全峰快递
                        if ($l['SysNo'] != ICSON_DELIVERY
                            && $l['SysNo'] != ICSON_DELIVERY_QF
                            && $l['SysNo'] != ICSON_DELIVERY_YJ
                            && $l['SysNo'] != ICSON_DELIVERY_GZTL
                            && $l['SysNo'] != ICSON_DELIVERY_BJSC
                            && $l['SysNo'] != ICSON_DELIVERY_SZMDM
                            && $l['SysNo'] != ICSON_DELIVERY_SHSAD
                            && $l['SysNo'] != ICSON_DELIVERY_WHFY
                            && $l['SysNo'] != ICSON_DELIVERY_HZABX
                            && $l['SysNo'] != ICSON_DELIVERY_30812
                            && $l['SysNo'] != ICSON_DELIVERY_30821
                        )
                        {
                            if (!isset($shipNotAva[$l['SysNo']]))
                            {
                                $shipNotAva[$l['SysNo']] = array();
                            }
                            $shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
                        }
                    }
                }
                else if ($ship == 5)
                {
                    //EMS限运、航空限运
                    foreach($_LGT_MODE as $l)
                    {
                        if ($l['SysNo'] != ICSON_DELIVERY
                            && $l['SysNo'] != YT_DELIVERY
                            && $l['SysNo'] != SELF_DELIVERY_SH
                            && $l['SysNo'] != ICSON_DELIVERY_QF
                            && $l['SysNo'] != EYB_DELIVERY
                            && $l['SysNo'] != ICSON_DELIVERY_YJ
                            && $l['SysNo'] != ICSON_DELIVERY_GZTL
                            && $l['SysNo'] != ICSON_DELIVERY_BJSC
                            && $l['SysNo'] != ICSON_DELIVERY_SZMDM
                            && $l['SysNo'] != ICSON_DELIVERY_SHSAD
                            && $l['SysNo'] != ICSON_DELIVERY_WHFY
                            && $l['SysNo'] != ICSON_DELIVERY_HZABX
                            && $l['SysNo'] != ICSON_DELIVERY_30812
                            && $l['SysNo'] != ICSON_DELIVERY_30821
                        )
                        {
                            if (!isset($shipNotAva[$l['SysNo']])) {
                                $shipNotAva[$l['SysNo']] = array();
                            }
                            $shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
                        }
                    }

                    // 如果不在下列区域，是不能使用圆通快递的
                    $dis_array = array(131,201,403,814,1323,1454,1591,2329,2621,1718,1,1144,2490,3225);
                    if (!in_array($province, $dis_array))
                    {
                        if (!isset($shipNotAva[YT_DELIVERY])) {
                            $shipNotAva[YT_DELIVERY] = array();
                        }
                        $shipNotAva[YT_DELIVERY] = array_merge($shipNotAva[YT_DELIVERY], $products);
                    }
                }
                else if ($ship == 6)
                {
                    //江浙沪皖以外区域无法配送
                    $dis_array = array(1, 1591, 3225, 2621);
                    foreach($_LGT_MODE as $l) {
                        if (!in_array($province, $dis_array)) {
                            if (!isset($shipNotAva[$l['SysNo']])) {
                                $shipNotAva[$l['SysNo']] = array();
                            }
                            $shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
                        }
                    }
                }
                else if ($ship == 8)
                {
                    //易迅快递无法配送
                    if (!isset($shipNotAva[ICSON_DELIVERY])) {
                        $shipNotAva[ICSON_DELIVERY] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);

                    if (!isset($shipNotAva[ICSON_DELIVERY_QF])) {
                        $shipNotAva[ICSON_DELIVERY_QF] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_QF] = array_merge($shipNotAva[ICSON_DELIVERY_QF], $products);

                    if (!isset($shipNotAva[ICSON_DELIVERY_YJ])) {
                        $shipNotAva[ICSON_DELIVERY_YJ] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_YJ] = array_merge($shipNotAva[ICSON_DELIVERY_YJ], $products);

                    if (!isset($shipNotAva[ICSON_DELIVERY_GZTL])) {
                        $shipNotAva[ICSON_DELIVERY_GZTL] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_GZTL] = array_merge($shipNotAva[ICSON_DELIVERY_GZTL], $products);

                    if (!isset($shipNotAva[ICSON_DELIVERY_BJSC])) {
                        $shipNotAva[ICSON_DELIVERY_BJSC] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_BJSC] = array_merge($shipNotAva[ICSON_DELIVERY_BJSC], $products);


                    if (!isset($shipNotAva[ICSON_DELIVERY_SZMDM])) {
                        $shipNotAva[ICSON_DELIVERY_SZMDM] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_SZMDM] = array_merge($shipNotAva[ICSON_DELIVERY_SZMDM], $products);


                    if (!isset($shipNotAva[ICSON_DELIVERY_SHSAD])) {
                        $shipNotAva[ICSON_DELIVERY_SHSAD] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_SHSAD] = array_merge($shipNotAva[ICSON_DELIVERY_SHSAD], $products);

                    if (!isset($shipNotAva[ICSON_DELIVERY_WHFY])) {
                        $shipNotAva[ICSON_DELIVERY_WHFY] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_WHFY] = array_merge($shipNotAva[ICSON_DELIVERY_WHFY], $products);

                    if (!isset($shipNotAva[ICSON_DELIVERY_HZABX])) {
                        $shipNotAva[ICSON_DELIVERY_HZABX] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_HZABX] = array_merge($shipNotAva[ICSON_DELIVERY_HZABX], $products);


                    if (!isset($shipNotAva[ICSON_DELIVERY_30812])) {
                        $shipNotAva[ICSON_DELIVERY_30812] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_30812] = array_merge($shipNotAva[ICSON_DELIVERY_30812], $products);


                    if (!isset($shipNotAva[ICSON_DELIVERY_30821])) {
                        $shipNotAva[ICSON_DELIVERY_30821] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_30821] = array_merge($shipNotAva[ICSON_DELIVERY_30821], $products);
                }
                else if ($ship == 10)
                {
                    //仅限上海自提
                    foreach($_LGT_MODE as $l) {
                        if ($l['SysNo'] != SELF_DELIVERY_SH) {
                            if (!isset($shipNotAva[$l['SysNo']])) {
                                $shipNotAva[$l['SysNo']] = array();
                            }
                            $shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
                        }
                    }
                }
                else if ($ship == 11)
                {
                    //仅限上海易迅快递
                    foreach($_LGT_MODE as $l)
                    {
                        if ( $l['SysNo'] != ICSON_DELIVERY )
                        {
                            if (!isset($shipNotAva[$l['SysNo']]))
                            {
                                $shipNotAva[$l['SysNo']] = array();
                            }
                            $shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
                        }
                    }

                    if (!in_array($province, array(2621)))
                    {
                        if (!isset($shipNotAva[ICSON_DELIVERY]))
                        {
                            $shipNotAva[ICSON_DELIVERY] = array();
                        }
                        $shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);
                    }
                }
                else if ($ship == 19)
                {
                    //仅限上海、南京、苏州易迅快递（昆山常熟除外）
                    $dis_array = array(1693, 1694, 3485, 3696, 3486, 1695, 1697,1598, 1600 ,1601 ,1602 ,1603 ,1604  );
                    foreach($_LGT_MODE as $l)
                    {
                        if ( $l['SysNo'] != ICSON_DELIVERY )
                        {
                            if (!isset($shipNotAva[$l['SysNo']])) {
                                $shipNotAva[$l['SysNo']] = array();
                            }
                            $shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
                        }
                    }

                    if (!in_array($province, array(2621)) && !in_array($district, $dis_array))
                    {
                        if (!isset($shipNotAva[ICSON_DELIVERY])) {
                            $shipNotAva[ICSON_DELIVERY] = array();
                        }
                        $shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);
                    }
                }
                else if (24 == $ship) //仅限上海易迅快递外环以内
                {
                    foreach($_LGT_MODE as $l)
                    {
                        if ($l['SysNo'] != ICSON_DELIVERY)
                        {
                            if (!isset($shipNotAva[$l['SysNo']])) {
                                $shipNotAva[$l['SysNo']] = array();
                            }
                            $shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
                        }
                    }

                    $dis_array = array(3329, 3333, 2624, 2625, 2626, 2627, 2628, 2629, 2630, 2631, 2632, 2633, 2637, 2638, 3525);
                    if (!in_array($district, $dis_array))
                    {
                        if (!isset($shipNotAva[ICSON_DELIVERY])) {
                            $shipNotAva[ICSON_DELIVERY] = array();
                        }
                        $shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);
                    }
                }
            }
            //以下深圳有效
            else if ($wh_id == SITE_SZ)
            {
                if ($ship == 13) { //普通快递无法配送,不能使用配送方式（圆通快递，申通快递）
                    if (!isset($shipNotAva[YT_DELIVERY])) {
                        $shipNotAva[YT_DELIVERY] = array();
                    }
                    $shipNotAva[YT_DELIVERY] = array_merge($shipNotAva[YT_DELIVERY], $products);
                }
                else if ($ship == 14)
                {
                    //仅限易迅快递
                    foreach($_LGT_MODE as $l)
                    {
                        if ($l['SysNo'] != ICSON_DELIVERY
                            && $l['SysNo'] != ICSON_DELIVERY_QF
                            && $l['SysNo'] != ICSON_DELIVERY_YJ
                            && $l['SysNo'] != ICSON_DELIVERY_GZTL
                            && $l['SysNo'] != ICSON_DELIVERY_BJSC
                            && $l['SysNo'] != ICSON_DELIVERY_SZMDM
                            && $l['SysNo'] != ICSON_DELIVERY_SHSAD
                            && $l['SysNo'] != ICSON_DELIVERY_WHFY
                            && $l['SysNo'] != ICSON_DELIVERY_HZABX
                            && $l['SysNo'] != ICSON_DELIVERY_30812
                            && $l['SysNo'] != ICSON_DELIVERY_30821
                        )
                        {
                            if (!isset($shipNotAva[$l['SysNo']])) {
                                $shipNotAva[$l['SysNo']] = array();
                            }
                            $shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
                        }
                    }
                }
                else if ($ship == 15)
                {
                    //易迅快递无法配送
                    if (!isset($shipNotAva[ICSON_DELIVERY])) {
                        $shipNotAva[ICSON_DELIVERY] = array();
                    }
                    @$shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);

                    //易迅全峰快递无法配送
                    if (!isset($shipNotAva[ICSON_DELIVERY_QF])) {
                        $shipNotAva[ICSON_DELIVERY_QF] = array();
                    }
                    @$shipNotAva[ICSON_DELIVERY_QF] = array_merge($shipNotAva[ICSON_DELIVERY_QF], $products);


                    //银捷快递无法配送
                    if (!isset($shipNotAva[ICSON_DELIVERY_YJ])) {
                        $shipNotAva[ICSON_DELIVERY_YJ] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_YJ] = array_merge($shipNotAva[ICSON_DELIVERY_YJ], $products);

                    if (!isset($shipNotAva[ICSON_DELIVERY_GZTL])) {
                        $shipNotAva[ICSON_DELIVERY_GZTL] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_GZTL] = array_merge($shipNotAva[ICSON_DELIVERY_GZTL], $products);

                    if (!isset($shipNotAva[ICSON_DELIVERY_BJSC])) {
                        $shipNotAva[ICSON_DELIVERY_BJSC] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_BJSC] = array_merge($shipNotAva[ICSON_DELIVERY_BJSC], $products);


                    if (!isset($shipNotAva[ICSON_DELIVERY_SZMDM])) {
                        $shipNotAva[ICSON_DELIVERY_SZMDM] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_SZMDM] = array_merge($shipNotAva[ICSON_DELIVERY_SZMDM], $products);


                    if (!isset($shipNotAva[ICSON_DELIVERY_SHSAD])) {
                        $shipNotAva[ICSON_DELIVERY_SHSAD] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_SHSAD] = array_merge($shipNotAva[ICSON_DELIVERY_SHSAD], $products);

                     if (!isset($shipNotAva[ICSON_DELIVERY_WHFY])) {
                        $shipNotAva[ICSON_DELIVERY_WHFY] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_WHFY] = array_merge($shipNotAva[ICSON_DELIVERY_WHFY], $products);

                    if (!isset($shipNotAva[ICSON_DELIVERY_HZABX])) {
                        $shipNotAva[ICSON_DELIVERY_HZABX] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_HZABX] = array_merge($shipNotAva[ICSON_DELIVERY_HZABX], $products);


                    if (!isset($shipNotAva[ICSON_DELIVERY_30812])) {
                        $shipNotAva[ICSON_DELIVERY_30812] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_30812] = array_merge($shipNotAva[ICSON_DELIVERY_30812], $products);


                    if (!isset($shipNotAva[ICSON_DELIVERY_30821])) {
                        $shipNotAva[ICSON_DELIVERY_30821] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_30821] = array_merge($shipNotAva[ICSON_DELIVERY_30821], $products);
                }
                else if ($ship == 16)
                {
                    //深圳邮政EMS无法配送
                    if (!isset($shipNotAva[EMS_DELIVERY])) {
                        $shipNotAva[EMS_DELIVERY] = array();
                    }
                    @$shipNotAva[EMS_DELIVERY] = array_merge($shipNotAva[EMS_DELIVERY], $products);
                }
                else if ($ship == 18)
                {

                    //EMS限运、航空限运
                    foreach($_LGT_MODE as $l)
                    {

                        if ($l['SysNo'] != ICSON_DELIVERY
                            && $l['SysNo'] != ICSON_DELIVERY_QF
                            && $l['SysNo'] != YT_DELIVERY
                            && $l['SysNo'] != EYB_DELIVERY
                            && $l['SysNo'] != ICSON_DELIVERY_YJ
                            && $l['SysNo'] != ICSON_DELIVERY_GZTL
                            && $l['SysNo'] != ICSON_DELIVERY_BJSC
                            && $l['SysNo'] != ICSON_DELIVERY_SZMDM
                            && $l['SysNo'] != ICSON_DELIVERY_SHSAD
                            && $l['SysNo'] != ICSON_DELIVERY_WHFY
                            && $l['SysNo'] != ICSON_DELIVERY_HZABX
                            && $l['SysNo'] != ICSON_DELIVERY_30812
                            && $l['SysNo'] != ICSON_DELIVERY_30821
                        )
                        {
                            if (!isset($shipNotAva[$l['SysNo']])) {
                                $shipNotAva[$l['SysNo']] = array();
                            }
                            $shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
                        }
                    }

                    $prov_array = array(131, 201, 403, 814, 1323, 1454, 1591, 2329, 2621, 1718, 1, 1144, 2490, 3225);
                    if ( !in_array($province,$prov_array) )
                    {
                        if (!isset($shipNotAva[YT_DELIVERY])) {
                            $shipNotAva[YT_DELIVERY] = array();
                        }
                        $shipNotAva[YT_DELIVERY] = array_merge($shipNotAva[YT_DELIVERY], $products);
                    }

                }
                //ixiuzeng添加增加23号限运逻辑/仅限深圳易迅快递
                else if (23 == $ship)
                {
                    foreach($_LGT_MODE as $l)
                    {
                        if ($l['SysNo'] != ICSON_DELIVERY )
                        {
                            if (!isset($shipNotAva[$l['SysNo']])) {
                                $shipNotAva[$l['SysNo']] = array();
                            }
                            $shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
                        }
                    }

                    if ( !in_array($city,array(420)) )
                    {
                        //易迅快递无法配送
                        if (!isset($shipNotAva[ICSON_DELIVERY])) {
                            $shipNotAva[ICSON_DELIVERY] = array();
                        }
                        @$shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);
                    }
                }
            }

            //以下北京有效
            else if ($wh_id == SITE_BJ)
            {
                if ($ship == 20)
                {
                    //北京易迅快递无法配送
                    if (!isset($shipNotAva[ICSON_DELIVERY])) {
                        $shipNotAva[ICSON_DELIVERY] = array();
                    }
                    @$shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);
                }
                else if ($ship == 21)
                {
                    //EMS限运、航空限运
                    foreach($_LGT_MODE as $l)
                    {
                        if ($l['SysNo'] != ICSON_DELIVERY
                            && $l['SysNo'] != ICSON_DELIVERY_QF
                            && $l['SysNo'] != YT_DELIVERY
                            && $l['SysNo'] != EYB_DELIVERY
                            && $l['SysNo'] != ICSON_DELIVERY_YJ
                            && $l['SysNo'] != ICSON_DELIVERY_GZTL
                            && $l['SysNo'] != ICSON_DELIVERY_BJSC
                            && $l['SysNo'] != ICSON_DELIVERY_SZMDM
                            && $l['SysNo'] != ICSON_DELIVERY_SHSAD
                            && $l['SysNo'] != ICSON_DELIVERY_WHFY
                            && $l['SysNo'] != ICSON_DELIVERY_HZABX
                            && $l['SysNo'] != ICSON_DELIVERY_30812
                            && $l['SysNo'] != ICSON_DELIVERY_30821
                        )
                        {
                            if (!isset($shipNotAva[$l['SysNo']])) {
                                $shipNotAva[$l['SysNo']] = array();
                            }
                            $shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
                        }
                    }

                    $prov_array = array(131, 201, 403, 814, 1323, 1454, 1591, 2329, 2621, 1718, 1, 1144, 2490, 3225);
                    if (!in_array($province, $prov_array))
                    {
                        if (!isset($shipNotAva[YT_DELIVERY])) {
                            $shipNotAva[YT_DELIVERY] = array();
                        }
                        $shipNotAva[YT_DELIVERY] = array_merge($shipNotAva[YT_DELIVERY], $products);
                    }
                }
                else if ($ship == 22)
                {
                    //仅限北京易迅快递
                    foreach($_LGT_MODE as $l)
                    {
                        if ($l['SysNo'] != ICSON_DELIVERY) {
                            if (!isset($shipNotAva[$l['SysNo']])) {
                                $shipNotAva[$l['SysNo']] = array();
                            }
                            $shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
                        }
                    }

                    if (!in_array($province, array(131)))
                    {
                        if (!isset($shipNotAva[ICSON_DELIVERY])) {
                            $shipNotAva[ICSON_DELIVERY] = array();
                        }
                        $shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);
                    }
                }
            }

            //以下重庆有效
            else if ( $wh_id == SITE_CQ )
            {
                if ($ship == 25)
                {
                    // 重庆易迅快递无法配送
                    if (!isset($shipNotAva[ICSON_DELIVERY])) {
                        $shipNotAva[ICSON_DELIVERY] = array();
                    }
                    @$shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);

                    if (!isset($shipNotAva[ICSON_DELIVERY_QF])) {
                        $shipNotAva[ICSON_DELIVERY_QF] = array();
                    }
                    @$shipNotAva[ICSON_DELIVERY_QF] = array_merge($shipNotAva[ICSON_DELIVERY_QF], $products);


                    if (!isset($shipNotAva[ICSON_DELIVERY_YJ])) {
                        $shipNotAva[ICSON_DELIVERY_YJ] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_YJ] = array_merge($shipNotAva[ICSON_DELIVERY_YJ], $products);

                    if (!isset($shipNotAva[ICSON_DELIVERY_GZTL])) {
                        $shipNotAva[ICSON_DELIVERY_GZTL] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_GZTL] = array_merge($shipNotAva[ICSON_DELIVERY_GZTL], $products);

                    if (!isset($shipNotAva[ICSON_DELIVERY_BJSC])) {
                        $shipNotAva[ICSON_DELIVERY_BJSC] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_BJSC] = array_merge($shipNotAva[ICSON_DELIVERY_BJSC], $products);


                    if (!isset($shipNotAva[ICSON_DELIVERY_SZMDM])) {
                        $shipNotAva[ICSON_DELIVERY_SZMDM] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_SZMDM] = array_merge($shipNotAva[ICSON_DELIVERY_SZMDM], $products);


                    if (!isset($shipNotAva[ICSON_DELIVERY_SHSAD])) {
                        $shipNotAva[ICSON_DELIVERY_SHSAD] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_SHSAD] = array_merge($shipNotAva[ICSON_DELIVERY_SHSAD], $products);

                    if (!isset($shipNotAva[ICSON_DELIVERY_WHFY])) {
                        $shipNotAva[ICSON_DELIVERY_WHFY] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_WHFY] = array_merge($shipNotAva[ICSON_DELIVERY_WHFY], $products);

                    if (!isset($shipNotAva[ICSON_DELIVERY_HZABX])) {
                        $shipNotAva[ICSON_DELIVERY_HZABX] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_HZABX] = array_merge($shipNotAva[ICSON_DELIVERY_HZABX], $products);


                    if (!isset($shipNotAva[ICSON_DELIVERY_30812])) {
                        $shipNotAva[ICSON_DELIVERY_30812] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_30812] = array_merge($shipNotAva[ICSON_DELIVERY_30812], $products);


                    if (!isset($shipNotAva[ICSON_DELIVERY_30821])) {
                        $shipNotAva[ICSON_DELIVERY_30821] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_30821] = array_merge($shipNotAva[ICSON_DELIVERY_30821], $products);
                }
                else if ($ship == 26)
                {
                    //EMS限运、航空限运
                    foreach($_LGT_MODE as $l)
                    {
                        if ($l['SysNo'] != ICSON_DELIVERY
                            && $l['SysNo'] != ICSON_DELIVERY_QF
                            && $l['SysNo'] != YT_DELIVERY
                            && $l['SysNo'] != EYB_DELIVERY
                            && $l['SysNo'] != ICSON_DELIVERY_YJ
                            && $l['SysNo'] != ICSON_DELIVERY_GZTL
                            && $l['SysNo'] != ICSON_DELIVERY_BJSC
                            && $l['SysNo'] != ICSON_DELIVERY_SZMDM
                            && $l['SysNo'] != ICSON_DELIVERY_SHSAD
                            && $l['SysNo'] != ICSON_DELIVERY_WHFY
                            && $l['SysNo'] != ICSON_DELIVERY_HZABX
                            && $l['SysNo'] != ICSON_DELIVERY_30812
                            && $l['SysNo'] != ICSON_DELIVERY_30821
                        )
                        {
                            if (!isset($shipNotAva[$l['SysNo']])) {
                                $shipNotAva[$l['SysNo']] = array();
                            }
                            $shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
                        }
                    }

                    $prov_array = array(131, 201, 403, 814, 1323, 1454, 1591, 2329, 2621, 1718, 1, 1144, 2490, 3225, 2652, 158);
                    if (!in_array($province, $prov_array))
                    {
                        if (!isset($shipNotAva[YT_DELIVERY])) {
                            $shipNotAva[YT_DELIVERY] = array();
                        }
                        $shipNotAva[YT_DELIVERY] = array_merge($shipNotAva[YT_DELIVERY], $products);
                    }
                }
                else if ($ship == 27)
                {
                    // 仅限重庆易迅快递
                    foreach($_LGT_MODE as $l)
                    {
                        if ($l['SysNo'] != ICSON_DELIVERY)
                        {
                            if (!isset($shipNotAva[$l['SysNo']])) {
                                $shipNotAva[$l['SysNo']] = array();
                            }
                            $shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
                        }
                    }

                    if (!in_array($province, array(158)))
                    {
                        if (!isset($shipNotAva[ICSON_DELIVERY]))
                        {
                            $shipNotAva[ICSON_DELIVERY] = array();
                        }
                        $shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);
                    }
                }
                else if ($ship == 28)
                {
                    // 仅限易迅快递
                    foreach($_LGT_MODE as $l)
                    {
                        if ( $l['SysNo'] != ICSON_DELIVERY
                            && $l['SysNo'] != ICSON_DELIVERY_QF
                            && $l['SysNo'] != ICSON_DELIVERY_YJ
                            && $l['SysNo'] != ICSON_DELIVERY_GZTL
                            && $l['SysNo'] != ICSON_DELIVERY_BJSC
                            && $l['SysNo'] != ICSON_DELIVERY_SZMDM
                            && $l['SysNo'] != ICSON_DELIVERY_SHSAD
                            && $l['SysNo'] != ICSON_DELIVERY_WHFY
                            && $l['SysNo'] != ICSON_DELIVERY_HZABX
                            && $l['SysNo'] != ICSON_DELIVERY_30812
                            && $l['SysNo'] != ICSON_DELIVERY_30821
                        )
                        {
                            if (!isset($shipNotAva[$l['SysNo']])) {
                                $shipNotAva[$l['SysNo']] = array();
                            }
                            $shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
                        }
                    }

                }
            }

        //以下西安有效
            else if ( $wh_id == SITE_XA )
            {
                if ($ship == 32)
                {
                    //西安易迅快递无法配送
                    if (!isset($shipNotAva[ICSON_DELIVERY])) {
                        $shipNotAva[ICSON_DELIVERY] = array();
                    }
                    @$shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);

                    if (!isset($shipNotAva[ICSON_DELIVERY_QF])) {
                        $shipNotAva[ICSON_DELIVERY_QF] = array();
                    }
                    @$shipNotAva[ICSON_DELIVERY_QF] = array_merge($shipNotAva[ICSON_DELIVERY_QF], $products);


                    if (!isset($shipNotAva[ICSON_DELIVERY_YJ])) {
                        $shipNotAva[ICSON_DELIVERY_YJ] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_YJ] = array_merge($shipNotAva[ICSON_DELIVERY_YJ], $products);

                    if (!isset($shipNotAva[ICSON_DELIVERY_GZTL])) {
                        $shipNotAva[ICSON_DELIVERY_GZTL] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_GZTL] = array_merge($shipNotAva[ICSON_DELIVERY_GZTL], $products);

                    if (!isset($shipNotAva[ICSON_DELIVERY_BJSC])) {
                        $shipNotAva[ICSON_DELIVERY_BJSC] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_BJSC] = array_merge($shipNotAva[ICSON_DELIVERY_BJSC], $products);


                    if (!isset($shipNotAva[ICSON_DELIVERY_SZMDM])) {
                        $shipNotAva[ICSON_DELIVERY_SZMDM] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_SZMDM] = array_merge($shipNotAva[ICSON_DELIVERY_SZMDM], $products);


                    if (!isset($shipNotAva[ICSON_DELIVERY_SHSAD])) {
                        $shipNotAva[ICSON_DELIVERY_SHSAD] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_SHSAD] = array_merge($shipNotAva[ICSON_DELIVERY_SHSAD], $products);

                    if (!isset($shipNotAva[ICSON_DELIVERY_WHFY])) {
                        $shipNotAva[ICSON_DELIVERY_WHFY] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_WHFY] = array_merge($shipNotAva[ICSON_DELIVERY_WHFY], $products);

                    if (!isset($shipNotAva[ICSON_DELIVERY_HZABX])) {
                        $shipNotAva[ICSON_DELIVERY_HZABX] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_HZABX] = array_merge($shipNotAva[ICSON_DELIVERY_HZABX], $products);

                    if (!isset($shipNotAva[ICSON_DELIVERY_30812])) {
                        $shipNotAva[ICSON_DELIVERY_30812] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_30812] = array_merge($shipNotAva[ICSON_DELIVERY_30812], $products);

                     if (!isset($shipNotAva[ICSON_DELIVERY_30821])) {
                        $shipNotAva[ICSON_DELIVERY_30821] = array();
                    }
                    $shipNotAva[ICSON_DELIVERY_30821] = array_merge($shipNotAva[ICSON_DELIVERY_30821], $products);
                }
                else if ($ship == 33)
                {
                    //EMS限运、航空限运
                    foreach($_LGT_MODE as $l)
                    {
                        if ($l['SysNo'] != ICSON_DELIVERY
                            && $l['SysNo'] != ICSON_DELIVERY_QF
                            && $l['SysNo'] != YT_DELIVERY
                            && $l['SysNo'] != EYB_DELIVERY
                            && $l['SysNo'] != ICSON_DELIVERY_YJ
                            && $l['SysNo'] != ICSON_DELIVERY_GZTL
                            && $l['SysNo'] != ICSON_DELIVERY_BJSC
                            && $l['SysNo'] != ICSON_DELIVERY_SZMDM
                            && $l['SysNo'] != ICSON_DELIVERY_SHSAD
                            && $l['SysNo'] != ICSON_DELIVERY_WHFY
                            && $l['SysNo'] != ICSON_DELIVERY_HZABX
                            && $l['SysNo'] != ICSON_DELIVERY_30812
                            && $l['SysNo'] != ICSON_DELIVERY_30821
                        )
                        {
                            if (!isset($shipNotAva[$l['SysNo']])) {
                                $shipNotAva[$l['SysNo']] = array();
                            }
                            $shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
                        }
                    }

                    $prov_array = array(131, 201, 403, 814, 1454, 1591, 2329, 2621, 1718, 1, 1144, 2490, 3225, 2652, 2213);
                    if (!in_array($province, $prov_array))
                    {
                        if (!isset($shipNotAva[YT_DELIVERY])) {
                            $shipNotAva[YT_DELIVERY] = array();
                        }
                        $shipNotAva[YT_DELIVERY] = array_merge($shipNotAva[YT_DELIVERY], $products);
                    }
                }
                else if ($ship == 34)
                {
                    // 仅限西安易迅快递
                    foreach($_LGT_MODE as $l)
                    {
                        if ($l['SysNo'] != ICSON_DELIVERY)
                        {
                            if (!isset($shipNotAva[$l['SysNo']])) {
                                $shipNotAva[$l['SysNo']] = array();
                            }
                            $shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
                        }
                    }

                    if (!in_array($city, array(2213)))
                    {
                        if (!isset($shipNotAva[ICSON_DELIVERY]))
                        {
                            $shipNotAva[ICSON_DELIVERY] = array();
                        }
                        $shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);
                    }
                }
            }
			//以下武汉站有效
            else if ( $wh_id == SITE_WH )
            {
                //武汉易迅快递无法配送
                if ($ship == 29)
                {
                    foreach($_LGT_MODE as $l) {
                        if ($l['SysNo'] != ICSON_DELIVERY
                            && $l['SysNo'] != ICSON_DELIVERY_QF
                            && $l['SysNo'] != ICSON_DELIVERY_YJ
                            && $l['SysNo'] != ICSON_DELIVERY_GZTL
                            && $l['SysNo'] != ICSON_DELIVERY_BJSC
                            && $l['SysNo'] != ICSON_DELIVERY_SZMDM
                            && $l['SysNo'] != ICSON_DELIVERY_SHSAD
                            && $l['SysNo'] != ICSON_DELIVERY_WHFY
                            && $l['SysNo'] != ICSON_DELIVERY_HZABX
                            && $l['SysNo'] != ICSON_DELIVERY_30812
                            && $l['SysNo'] != ICSON_DELIVERY_30821
                        )
                        {
                            if (!isset($shipNotAva[$l['SysNo']])) {
                                $shipNotAva[$l['SysNo']] = array();
                            }
                            $shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
                        }
                    }
                }
                else if ($ship == 30)
                {
                    //EMS限运、航空限运

                    foreach($_LGT_MODE as $l)
                    {
                        if ($l['SysNo'] != ICSON_DELIVERY
                            && $l['SysNo'] != YT_DELIVERY
                            && $l['SysNo'] != ICSON_DELIVERY_QF
                            && $l['SysNo'] != EYB_DELIVERY
                            && $l['SysNo'] != ICSON_DELIVERY_YJ
                            && $l['SysNo'] != ICSON_DELIVERY_GZTL
                            && $l['SysNo'] != ICSON_DELIVERY_BJSC
                            && $l['SysNo'] != ICSON_DELIVERY_SZMDM
                            && $l['SysNo'] != ICSON_DELIVERY_SHSAD
                            && $l['SysNo'] != ICSON_DELIVERY_WHFY
                            && $l['SysNo'] != ICSON_DELIVERY_HZABX
                            && $l['SysNo'] != ICSON_DELIVERY_30812
                            && $l['SysNo'] != ICSON_DELIVERY_30821
                        )
                        {
                            if (!isset($shipNotAva[$l['SysNo']])) {
                                $shipNotAva[$l['SysNo']] = array();
                            }
                            $shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
                        }
                    }

                    // 如果不在下列区域，是不能使用圆通快递的
                    $prov_array = array(131,201,403,814,1323,1454,1591,2329,2621,1718,1,1144,2490,3225,2652,158);
                    if (!in_array($province, $prov_array))
                    {
                        if (!isset($shipNotAva[YT_DELIVERY])) {
                            $shipNotAva[YT_DELIVERY] = array();
                        }
                        $shipNotAva[YT_DELIVERY] = array_merge($shipNotAva[YT_DELIVERY], $products);
                    }
                }
                else if ($ship == 31)
                {
                    foreach($_LGT_MODE as $l) {
                        if ($l['SysNo'] != ICSON_DELIVERY ) {
                            if (!isset($shipNotAva[$l['SysNo']])) {
                                $shipNotAva[$l['SysNo']] = array();
                            }
                            $shipNotAva[$l['SysNo']] = array_merge($shipNotAva[$l['SysNo']], $products);
                        }
                    }

                    $dis_array = array(1324);
                    if (!in_array($district, $dis_array))
                    {
                        if (!isset($shipNotAva[YT_DELIVERY])) {
                            $shipNotAva[YT_DELIVERY] = array();
                        }
                        $shipNotAva[YT_DELIVERY] = array_merge($shipNotAva[YT_DELIVERY], $products);
                    }
                }
            }
            */
        }


        foreach($shipNotAva as $key=> $value) {
            $shipNotAva[$key] = array_unique($value);
        }
        return $shipNotAva;

    }


    public static function getShippingTypeByDestination($destination, $orderPrice, $isVirtual = array(), $orderWeight = array(), $wh_id = 1, $user_level = 0, $size_type_need = false) {
        global $_District, $_DCToRegion;
	    $des_dc = IProductInventory::getDCFromDistrict($destination, $wh_id); //根据用户的三级地址和站id获得对应DC
	    if(empty($des_dc))
	    {
		    //如果找不到DC，需要记录
		    self::$errMsg = 905;
		    self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[get dcsysno error]';
		    return false;
	    }

        if (!isset($destination) || $destination <= 0) {
            self::$errCode = 900;
            self::$errMsg = basename( __FILE__, '.php') . " |" . __LINE__ . "destination($destination) is invalid";
            return false;
        }

        if (!isset($_District[$destination])) {
            self::$errCode = 901;
            self::$errMsg = basename( __FILE__, '.php') . " |" . __LINE__ . "destination($destination) has no parent city";
            return false;
        }

        if ( !isset($wh_id) || !is_numeric($wh_id) || $wh_id <= 0 ) {
            self::$errCode = 902;
            self::$errMsg = basename( __FILE__, '.php') . " | ". __LINE__ . "wh_id($wh_id) is invalid";
            return false;
        }
        if ( !isset($_DCToRegion[$des_dc]) ) {
            self::$errCode = 903;
            self::$errMsg = basename( __FILE__, '.php') . " | ". __LINE__ . "order has no dcToregoin";
            return false;
        }

	    if(empty($orderWeight))
	    {
		    self::$errCode = 904;
		    self::$errMsg = basename( __FILE__, '.php') . " | ". __LINE__ . "orderWeight($orderWeight) is empty";
		    return false;
	    }

        // 得到起始分站对应的仓库ID


	    $source_region = $_DCToRegion[$des_dc];
        // IShippingRegionTTC 中 get 到从 $source_region 到 $destination 的所有支持的快递（包括可用和不可用的）
        $dest_array = array( $destination,
            $_District[$destination]['city_id'],
            $_District[$destination]['province_id']
        );
        $filter = $size_type_need == true ? array('wh_id' => $source_region, 'status' => 0, 'size_type'=> 1) : array('wh_id' => $source_region, 'status' => 0);
        $shippingTypeAll = IShippingRegionTTC::gets(
            $dest_array,
            $filter
        );

        if ( false === $shippingTypeAll ) {
            self::$errMsg = IShippingRegionTTC::$errMsg;
            self::$errCode = IShippingRegionTTC::$errCode;
            return false;
        }

        global $_LGT_MODE;
        $shippingType = array();


        foreach ($shippingTypeAll as $sp_type) {
            if ( !isset( $_LGT_MODE[$sp_type['shipping_id']] ) ) {
                continue;
            }

            // 从_LGT_MODE 中拉取该快递的基本信息
            $sp_type_info = $_LGT_MODE[$sp_type['shipping_id']];


            if ($sp_type_info['IsOnlineShow'] == 0 )
                continue;

            // 如果当前可以在线展示，则加入到shippingType中，附加上配送方式
            $shippingType[$sp_type_info['SysNo']] = $sp_type_info;
            $shippingType[$sp_type_info['SysNo']]['ShippingId'] = $sp_type_info['SysNo'];
            $shippingType[$sp_type_info['SysNo']]['isCOD'] = $sp_type['is_cod'];
            $shippingType[$sp_type_info['SysNo']]['delivery_time'] = $sp_type['delivery_time'];
        }

        // 计算运费
		$shipInfo = array(
			'wh_id'       => $wh_id, //起始站点
			'destination' => $destination, //收获地区
			'order_price' => $orderPrice, //订单总金额
			'user_level'  => $user_level, //记录用户的等级
		);
		foreach ($orderWeight as $subOrderIndex => $totalWeight)
		{
			$shipInfo['order_info'][$subOrderIndex]['weight'] = $totalWeight;
		}
		$shipInfo['is_mobile'] =  ToolUtil::is_mobile();
        foreach ($shippingType as $spkey => $spt)
		{
			$shipInfo['shipping_id'] = $spt['ShippingId'];
			$shipPriceInfo = EA_ShippingPrice::get($shipInfo);
			if (!empty($shipPriceInfo['errCode']))
			{
				self::$errCode = $shipPriceInfo['errCode'];
				self::$errMsg = $shipPriceInfo['errMsg'];
				return false;
			}

			$shippingType[$spkey]['shippingPrice'] = $shipPriceInfo['shippingPrice'];
			$shippingType[$spkey]['shippingPriceCut'] = $shipPriceInfo['shippingPriceCut']; //此处为了兼容以前的旧字段
			$shippingType[$spkey]['shippingCost'] = $shipPriceInfo['shippingCost'];
			$shippingType[$spkey]['free_type'] = $shipPriceInfo['free_type'];
			$shippingType[$spkey]['free_price_limit'] = $shipPriceInfo['free_price_limit'];
			foreach($shipPriceInfo['subShipPrice'] as $subIndex => $subInfo)
			{
				$shippingType[$spkey]['subOrder'][$subIndex]['shippingPrice'] = $subInfo['shippingPrice'];
				$shippingType[$spkey]['subOrder'][$subIndex]['shippingPriceCut'] = $subInfo['shippingPriceCut']; //此处为了兼容以前的旧字段
				$shippingType[$spkey]['subOrder'][$subIndex]['shippingCost'] = $subInfo['shippingCost'];
			}
        }
	    //计算运费结束

		foreach($shippingType as $shipping_id=>$shipInfo)
		{
			 foreach ($isVirtual as $subOrderIndex => $v)
			 {
				 $delivery_info = array(
					 'delivery_time' => $shipInfo['delivery_time'],
					 'shipping_id' => $shipping_id,
					 'stock_num' => $subOrderIndex,// 发货仓库
				 );

				 if ($subOrderIndex == STOCK_SH_5 && $shipping_id == ICSON_DELIVERY )
				 {
					 // 上海大件仓，易迅快递按一日一送获取时间
					//$delivery_info['delivery_time'] = 1;
				 }
				 else if ( $shipping_id != ICSON_DELIVERY )
				 {
					 // 非易迅快递，一日一送
					 $delivery_info['delivery_time'] = 1;
				 }
				 else if ( $subOrderIndex == STOCK_SH_5 && $wh_id == SITE_SH && in_array($shipping_id, IShipping::$shipType_SELF ))
				 {
					 // 上海大件仓自提，一日一送
					 $delivery_info['delivery_time'] = 1;
				 }
				 else
				 {
					 // 其余的按照读取的配置来计算
				 }

				 $shippingType[$shipping_id]['subOrder'][$subOrderIndex]['timeAvaiable'] = IShippingTime::get($delivery_info, $wh_id, $destination, $v);

				 //ixiuzeng添加。采用易迅快递且属于限时达地区，10-17 去掉该逻辑，直接设为false
				 $shippingType[$shipping_id]['subOrder'][$subOrderIndex]['isArrivedLimitTime'] = false;

			 }
		}

        return $shippingType;
    }

}