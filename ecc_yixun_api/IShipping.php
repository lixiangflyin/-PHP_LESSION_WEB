<?php
require_once(PHPLIB_ROOT . 'inc/district.inc.php');
require_once(PHPLIB_ROOT . 'inc/ship.inc.php');
require_once(PHPLIB_ROOT . 'inc/ShipRestrice.inc.php');
/*�����붨��
500:�������벻�Ϸ�
501�����ͷ�ʽ���Ϸ�
502����Ʒ�������Ϸ�
*/

class IShipping
{
	// ��Ҫ����ʱ���б�Ŀ�ݷ�ʽ
	public static $shipType_TL = array(
		ICSON_DELIVERY,
		SELF_DELIVERY_SH,

	);

	// �����ݷ�ʽ
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
			self::$errMsg = "��������ID����,������";
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
			self::$errMsg = "ʡ��ID����,������";
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

	//��Ҫȷ���˷Ѽ�������Լ��˷Ѽ������
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

		//����������˷�

		return 0;
	}

	// ����Ŀ�ĵ�ַ����ȡ��Ѹ���������Ϣ������õ�����֧����Ѹ����򷵻�false
	public static function getIcsonDeliveryInfoByRegion($dest_region,$wh_id = -1)
	{
		// ���ݷ�վid����ø÷�վ��Ӧ�ķ�������
		global $_DCToRegion,$_District;
		if($wh_id == -1 )
			$wh_id = IUser::getSiteId();

		$des_dc = IProductInventory::getDCFromDistrict($dest_region, $wh_id); //�����û���������ַ��վid��ö�ӦDC
		if(empty($des_dc))
		{
			//����Ҳ���DC����Ҫ��¼
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

		// ���ֻ����һ��

		if( false === $delivery_info )
		{
			self::$errMsg = basename(__FILE__, '.php') . " IShippingRegionTTC get error :".IShippingRegionTTC::$errMsg.",line:". __LINE__ ;
			return false;
		}
		//�˴���������$delivery_infoΪ������Ļ���$delivery_info[0]�ᱨNotice  add by derongzeng
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


    // ��ְֲ�������߼�
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
        	 * 				'0' => array(),ֻ��ѡ��**��ݷ�ʽ
        	 * 				'1' => array(),����ѡ��**��ݷ�ʽ
        	 * 				'2' => array(  ����**�����޷�ʹ��**��ݷ�ʽ
        	 * 					'province' =>array(),ʡ
        	 * 					'city' =>array(),��
        	 * 					'district' => array(),��
        	 * 					'delivery' =>array(),��ݷ�ʽ
        	 * 				),
        	 * 				'3' => array(  ��**�����޷�ʹ��**��ݷ�ʽ
        	 * 					'province' =>array(),ʡ
        	 * 					'city' =>array(),��
        	 * 					'district' => array(),��
        	 * 					'delivery' =>array(),��ݷ�ʽ
        	 * 				),
        	 * 			),
        	 * 			...
        	 * 		),
        	 * 		...
        	 * )
        	 ***/

			if ( !empty($shipLimit[$wh_id][$ship]) )
			{
				//��һ�����壬ֻ��ѡ��**��ݷ�ʽ
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
				//�ڶ������壬����ѡ��**��ݷ�ʽ
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
				//���������壬����**�����޷�ʹ��**��ݷ�ʽ��������Щ
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
				//���������壬��**�����޷�ʹ��**��ݷ�ʽ
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
                    //������Ѹ���
                    foreach($_LGT_MODE as $l)
                    {
                        // 45Ϊȫ����
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
                    //EMS���ˡ���������
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

                    // ����������������ǲ���ʹ��Բͨ��ݵ�
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
                    //���㻦�����������޷�����
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
                    //��Ѹ����޷�����
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
                    //�����Ϻ�����
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
                    //�����Ϻ���Ѹ���
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
                    //�����Ϻ����Ͼ���������Ѹ��ݣ���ɽ������⣩
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
                else if (24 == $ship) //�����Ϻ���Ѹ����⻷����
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
            //����������Ч
            else if ($wh_id == SITE_SZ)
            {
                if ($ship == 13) { //��ͨ����޷�����,����ʹ�����ͷ�ʽ��Բͨ��ݣ���ͨ��ݣ�
                    if (!isset($shipNotAva[YT_DELIVERY])) {
                        $shipNotAva[YT_DELIVERY] = array();
                    }
                    $shipNotAva[YT_DELIVERY] = array_merge($shipNotAva[YT_DELIVERY], $products);
                }
                else if ($ship == 14)
                {
                    //������Ѹ���
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
                    //��Ѹ����޷�����
                    if (!isset($shipNotAva[ICSON_DELIVERY])) {
                        $shipNotAva[ICSON_DELIVERY] = array();
                    }
                    @$shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);

                    //��Ѹȫ�����޷�����
                    if (!isset($shipNotAva[ICSON_DELIVERY_QF])) {
                        $shipNotAva[ICSON_DELIVERY_QF] = array();
                    }
                    @$shipNotAva[ICSON_DELIVERY_QF] = array_merge($shipNotAva[ICSON_DELIVERY_QF], $products);


                    //���ݿ���޷�����
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
                    //��������EMS�޷�����
                    if (!isset($shipNotAva[EMS_DELIVERY])) {
                        $shipNotAva[EMS_DELIVERY] = array();
                    }
                    @$shipNotAva[EMS_DELIVERY] = array_merge($shipNotAva[EMS_DELIVERY], $products);
                }
                else if ($ship == 18)
                {

                    //EMS���ˡ���������
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
                //ixiuzeng�������23�������߼�/����������Ѹ���
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
                        //��Ѹ����޷�����
                        if (!isset($shipNotAva[ICSON_DELIVERY])) {
                            $shipNotAva[ICSON_DELIVERY] = array();
                        }
                        @$shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);
                    }
                }
            }

            //���±�����Ч
            else if ($wh_id == SITE_BJ)
            {
                if ($ship == 20)
                {
                    //������Ѹ����޷�����
                    if (!isset($shipNotAva[ICSON_DELIVERY])) {
                        $shipNotAva[ICSON_DELIVERY] = array();
                    }
                    @$shipNotAva[ICSON_DELIVERY] = array_merge($shipNotAva[ICSON_DELIVERY], $products);
                }
                else if ($ship == 21)
                {
                    //EMS���ˡ���������
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
                    //���ޱ�����Ѹ���
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

            //����������Ч
            else if ( $wh_id == SITE_CQ )
            {
                if ($ship == 25)
                {
                    // ������Ѹ����޷�����
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
                    //EMS���ˡ���������
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
                    // ����������Ѹ���
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
                    // ������Ѹ���
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

        //����������Ч
            else if ( $wh_id == SITE_XA )
            {
                if ($ship == 32)
                {
                    //������Ѹ����޷�����
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
                    //EMS���ˡ���������
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
                    // ����������Ѹ���
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
			//�����人վ��Ч
            else if ( $wh_id == SITE_WH )
            {
                //�人��Ѹ����޷�����
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
                    //EMS���ˡ���������

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

                    // ����������������ǲ���ʹ��Բͨ��ݵ�
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
	    $des_dc = IProductInventory::getDCFromDistrict($destination, $wh_id); //�����û���������ַ��վid��ö�ӦDC
	    if(empty($des_dc))
	    {
		    //����Ҳ���DC����Ҫ��¼
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

        // �õ���ʼ��վ��Ӧ�Ĳֿ�ID


	    $source_region = $_DCToRegion[$des_dc];
        // IShippingRegionTTC �� get ���� $source_region �� $destination ������֧�ֵĿ�ݣ��������úͲ����õģ�
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

            // ��_LGT_MODE ����ȡ�ÿ�ݵĻ�����Ϣ
            $sp_type_info = $_LGT_MODE[$sp_type['shipping_id']];


            if ($sp_type_info['IsOnlineShow'] == 0 )
                continue;

            // �����ǰ��������չʾ������뵽shippingType�У����������ͷ�ʽ
            $shippingType[$sp_type_info['SysNo']] = $sp_type_info;
            $shippingType[$sp_type_info['SysNo']]['ShippingId'] = $sp_type_info['SysNo'];
            $shippingType[$sp_type_info['SysNo']]['isCOD'] = $sp_type['is_cod'];
            $shippingType[$sp_type_info['SysNo']]['delivery_time'] = $sp_type['delivery_time'];
        }

        // �����˷�
		$shipInfo = array(
			'wh_id'       => $wh_id, //��ʼվ��
			'destination' => $destination, //�ջ����
			'order_price' => $orderPrice, //�����ܽ��
			'user_level'  => $user_level, //��¼�û��ĵȼ�
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
			$shippingType[$spkey]['shippingPriceCut'] = $shipPriceInfo['shippingPriceCut']; //�˴�Ϊ�˼�����ǰ�ľ��ֶ�
			$shippingType[$spkey]['shippingCost'] = $shipPriceInfo['shippingCost'];
			$shippingType[$spkey]['free_type'] = $shipPriceInfo['free_type'];
			$shippingType[$spkey]['free_price_limit'] = $shipPriceInfo['free_price_limit'];
			foreach($shipPriceInfo['subShipPrice'] as $subIndex => $subInfo)
			{
				$shippingType[$spkey]['subOrder'][$subIndex]['shippingPrice'] = $subInfo['shippingPrice'];
				$shippingType[$spkey]['subOrder'][$subIndex]['shippingPriceCut'] = $subInfo['shippingPriceCut']; //�˴�Ϊ�˼�����ǰ�ľ��ֶ�
				$shippingType[$spkey]['subOrder'][$subIndex]['shippingCost'] = $subInfo['shippingCost'];
			}
        }
	    //�����˷ѽ���

		foreach($shippingType as $shipping_id=>$shipInfo)
		{
			 foreach ($isVirtual as $subOrderIndex => $v)
			 {
				 $delivery_info = array(
					 'delivery_time' => $shipInfo['delivery_time'],
					 'shipping_id' => $shipping_id,
					 'stock_num' => $subOrderIndex,// �����ֿ�
				 );

				 if ($subOrderIndex == STOCK_SH_5 && $shipping_id == ICSON_DELIVERY )
				 {
					 // �Ϻ�����֣���Ѹ��ݰ�һ��һ�ͻ�ȡʱ��
					//$delivery_info['delivery_time'] = 1;
				 }
				 else if ( $shipping_id != ICSON_DELIVERY )
				 {
					 // ����Ѹ��ݣ�һ��һ��
					 $delivery_info['delivery_time'] = 1;
				 }
				 else if ( $subOrderIndex == STOCK_SH_5 && $wh_id == SITE_SH && in_array($shipping_id, IShipping::$shipType_SELF ))
				 {
					 // �Ϻ���������ᣬһ��һ��
					 $delivery_info['delivery_time'] = 1;
				 }
				 else
				 {
					 // ����İ��ն�ȡ������������
				 }

				 $shippingType[$shipping_id]['subOrder'][$subOrderIndex]['timeAvaiable'] = IShippingTime::get($delivery_info, $wh_id, $destination, $v);

				 //ixiuzeng��ӡ�������Ѹ�����������ʱ�������10-17 ȥ�����߼���ֱ����Ϊfalse
				 $shippingType[$shipping_id]['subOrder'][$subOrderIndex]['isArrivedLimitTime'] = false;

			 }
		}

        return $shippingType;
    }

}