<?php
/*错误码定义
500:地区编码不合法
501：运送方式不合法
502：商品重量不合法
*/
//define('ICSON_DELIVERY', 1); // 易迅快递编号
//define('SELF_DELIVERY_SH', 8); // 客户上门提货(上海)
require_once(PHPLIB_ROOT.'api/distribution/ShippingPrice.php');
require_once('Config.php');
require_once(PHPLIB_ROOT.'api/distribution/ShipConst.php');
require_once(PHPLIB_ROOT.'api/distribution/ShippingTime.php');
require_once(PHPLIB_ROOT.'api/distribution/District.php');
class LIB_Shipping
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

	public static $_WhidToRegion = array(
				SITE_SH  => 2621,
				SITE_SZ  => 420,
				SITE_BJ  => 131,
				SITE_WH  => 1324,
				SITE_CQ  => 158,
				SITE_XA  => 2213,
			);

	public static	$_RegionToWhid = array(
			2621 => SITE_SH,
			420  => SITE_SZ,
			131  => SITE_BJ,
			158  => SITE_CQ,
			1324 => SITE_WH,
			2213 => SITE_XA,
		);
	public static $_DCToRegion = array(
			'SHDC'  => 2621,
			'NJDC'  => 1592,
			'HZDC'  => 3226,
			'SZDC'  => 420,
			'GZDC'  => 404,
			'FZDC'  => 202,
			'BJDC'  => 131,
			'QDDC'  => 2341,
			'JNDC'  => 2330,
			'WHDC'  => 1324,
			'CSDC'  => 1455,
			'ZZDC'  => 1145,
			'CQDC'  => 158,
			'CDDC'  => 2653,
			'XADC'  => 2213,
			//	'SYDC'  => 1901,
	);
	public static  $_Whid_To_DC = array(
			SITE_SH => 'SHDC',
			SITE_SZ => 'SZDC',
			SITE_BJ => 'BJDC',
			SITE_WH => 'WHDC',
			SITE_CQ => 'CQDC',
			SITE_XA => 'XADC',
	);
	
	public static $errCode = 0;
	public static $errMsg = '';
	
	public static function getShippingTypeByRegion($regionId)
	{
		if (!isset($regionId) || $regionId <= 0) {
			self::$errCode = 500;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "regionId($regionId) is invalid";
			return false;
		}
		
		$item = IShippingRegionTTC::get($regionId);
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
	public static function getIcsonDeliveryInfoByRegion($dest_region,$wh_id = 1)
	{
		// 根据分站id，获得该分站对应的发货地区
// 		if($wh_id == -1 )
// 			$wh_id = IUser::getSiteId();
		
		$source_region = self::$_WhidToRegion[$wh_id];
		
		$dest_region_array = array( 
			$dest_region,
			District::$District[$dest_region]['city_id'],
			District::$District[$dest_region]['province_id']
		);
		$delivery_info = IShippingRegionTTC::gets($dest_region_array, array('wh_id' => $source_region, 'shipping_id' => ICSON_DELIVERY ));
		
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
				LIB_Shipping::$errMsg = "getIcsonDeliveryInfoByRegion delivery_time error!";
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

	
        $shipNotAva = array();

        foreach($forbidenShipArr as $ship=>$products)
        {

        	/** flycgu
        	  * ShipConst::$shipLimit = array(
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
			
			if ( !empty(ShipConst::$shipLimit[$wh_id][$ship]) )
			{
				//第一种语义，只能选择**快递方式
				if ( !empty(ShipConst::$shipLimit[$wh_id][$ship]['0']) )
				{
					foreach (ShipConst::$_LGT_MODE as $l){
						$tmp = 1;
						foreach (ShipConst::$shipLimit[$wh_id][$ship]['0'] as $delivery)
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
				if ( !empty(ShipConst::$shipLimit[$wh_id][$ship]['1']) )
				{
					foreach (ShipConst::$shipLimit[$wh_id][$ship]['1'] as $delivery)
					{
						if (!isset($shipNotAva[$delivery])) 
						{
							$shipNotAva[$delivery] = array();
						}
						$shipNotAva[$delivery] = array_merge($shipNotAva[$delivery], $products);
					}
				}
				//第三种语义，不在**地区无法使用**快递方式，即在这些
				if ( !empty(ShipConst::$shipLimit[$wh_id][$ship]['2']) ){
					foreach (ShipConst::$shipLimit[$wh_id][$ship]['2'] as $k => $limit){
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
								foreach(ShipConst::$_LGT_MODE as $l) 
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
				if ( !empty(ShipConst::$shipLimit[$wh_id][$ship]['3']) ){
                    foreach (ShipConst::$shipLimit[$wh_id][$ship]['3'] as $k => $limit){
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
        }
        

        foreach($shipNotAva as $key=> $value) {
            $shipNotAva[$key] = array_unique($value);
        }
        return $shipNotAva;

    }

/**
 * TTC_Orders.stockNo
 * $isVirtual = array(1=>0);
 * $isVirtual = array(5=>0); 
 */
    public static function getShippingTypeByDestination($destination, $orderPrice,$orderSize=array(), $isVirtual = array(), $orderWeight = array(), $wh_id = 1) {
       
        if (!isset($destination) || $destination <= 0) {
            self::$errCode = 900;
            self::$errMsg = basename( __FILE__, '.php') . " |" . __LINE__ . "destination($destination) is invalid";
            return false;
        }

        $des_dc = self::getDCFromDistrict($destination, $wh_id); //根据用户的三级地址和站id获得对应DC
        
        if (!isset(District::$District[$destination])) {
            self::$errCode = 901;
            self::$errMsg = basename( __FILE__, '.php') . " |" . __LINE__ . "destination($destination) has no parent city";
            return false;
        }

        if ( !isset($wh_id) || !is_numeric($wh_id) || $wh_id <= 0 ) {
            self::$errCode = 902;
            self::$errMsg = basename( __FILE__, '.php') . " | ". __LINE__ . "wh_id($wh_id) is invalid";
            return false;
        }
        if ( !isset(self::$_WhidToRegion[$wh_id]) ) {
            self::$errCode = 903;
            self::$errMsg = basename( __FILE__, '.php') . " | ". __LINE__ . "wh_id($wh_id) has no stock id";
            return false;
        }

	    if(empty($orderWeight))
	    {
		    self::$errCode = 904;
		    self::$errMsg = basename( __FILE__, '.php') . " | ". __LINE__ . "orderWeight($orderWeight) is empty";
		    return false;
	    }

        // 得到起始分站对应的仓库ID
        $source_region = self::$_DCToRegion[$des_dc];
        $source_region = self::$_DCToRegion[$des_dc];
	    if (!in_array($source_region,array(1592,3226))) $source_region = 2621; 
        // IShippingRegionTTC 中 get 到从 $source_region 到 $destination 的所有支持的快递（包括可用和不可用的）
        $dest_array = array( $destination,
            District::$District[$destination]['city_id'],
            District::$District[$destination]['province_id']
        );

        $shippingTypeAll = IShippingRegionTTC::gets(
            $dest_array,
            array('wh_id' => $source_region, 'status' => 0) //获取小件的配送时间
        );

        if ( false === $shippingTypeAll ) {
            self::$errMsg = IShippingRegionTTC::$errMsg;
            self::$errCode = IShippingRegionTTC::$errCode;
            return false;
        }

        $shippingType = array();

        foreach ($shippingTypeAll as $sp_type) {
            if ( !isset( ShipConst::$_LGT_MODE[$sp_type['shipping_id']] ) ) {
                continue;
            }

            // 从_LGT_MODE 中拉取该快递的基本信息
            $sp_type_info = ShipConst::$_LGT_MODE[$sp_type['shipping_id']];


            if ($sp_type_info['IsOnlineShow'] == 0 )
                continue;
            if ($sp_type_info['ShipTypeID'] == '008' )
            	continue;
            // 如果当前可以在线展示，则加入到shippingType中，附加上配送方式
            $shippingType[$sp_type_info['SysNo']] = $sp_type_info;
            $shippingType[$sp_type_info['SysNo']]['ShippingId'] = $sp_type_info['SysNo'];
            $shippingType[$sp_type_info['SysNo']]['isCOD'] = $sp_type['is_cod'];
            $shippingType[$sp_type_info['SysNo']]['delivery_time'] = $sp_type['delivery_time'];
	 		  break;       
 		}

		//ELFlow::getInstance("test_shipping")->append(var_export($shippingType,true));
        // 计算运费
		$shipInfo = array(
			'wh_id'       => $wh_id, //起始站点
			'destination' => $destination, //收获地区
			'order_price' => $orderPrice, //订单总金额
		);
		foreach ($orderWeight as $subOrderIndex => $totalWeight)
		{
			$shipInfo['order_info'][$subOrderIndex]['weight'] = $totalWeight;
		}
		
        foreach ($shippingType as $spkey => $spt) 
		{
			$shipInfo['shipping_id'] = $spt['ShippingId'];
			Logger::err(var_export($shipInfo,true));
			$shipPriceInfo = LIB_ShippingPrice::get($shipInfo);
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
	    
		//计算配送时间
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
				 else if ( $subOrderIndex == STOCK_SH_5 && $wh_id == SITE_SH && in_array($shipping_id, self::$shipType_SELF ))
				 {
					 // 上海大件仓自提，一日一送
					 $delivery_info['delivery_time'] = 1;
				 }
				 else
				 {
					 // 其余的按照读取的配置来计算
				 }
				 // 按照orderSize来计算配送次数
				 if (is_array($orderSize) && isset($orderSize['data'])){
				 	foreach ($orderSize['data'] AS $ordersz){
				 		if ($ordersz['sailStockId'] == $subOrderIndex){
				 			if ($ordersz['orderSize'] > 1){
				 				$delivery_info['delivery_time'] = 1;
				 				break;
				 			}
				 		}
				 	}
				 }
				 
				 $shippingType[$shipping_id]['subOrder'][$subOrderIndex]['timeAvaiable'] = IShippingTime::get($delivery_info, $wh_id, $destination, $v);

				 //ixiuzeng添加。采用易迅快递且属于限时达地区，10-17 去掉该逻辑，直接设为false
				 $shippingType[$shipping_id]['subOrder'][$subOrderIndex]['isArrivedLimitTime'] = false;

			 }
		}

        return $shippingType;
    }
    
    /*
     * 该方法根据提供的三级地址id，以及站id，获得最终对应的DC
    *
    */
    public static function getDCFromDistrict($district_id, $wh_id)
    {	
    	$city_id = isset(District::$District[$district_id]['city_id']) ? District::$District[$district_id]['city_id'] : 0;
    	$province_id = isset(District::$District[$district_id]['province_id']) ? District::$District[$district_id]['province_id'] : 0;
    
    	if(isset(ShipConst::$_ADDRESS_DC_MODE[$district_id]))
    	{
    		$des_dc = ShipConst::$_ADDRESS_DC_MODE[$district_id];
    	}
    	else if(isset(ShipConst::$_ADDRESS_DC_MODE[$city_id]))
    	{
    		$des_dc = ShipConst::$_ADDRESS_DC_MODE[$city_id];
    	}
    	else if(isset(ShipConst::$_ADDRESS_DC_MODE[$province_id]))
    	{
    		$des_dc = ShipConst::$_ADDRESS_DC_MODE[$province_id];
    	}
    	else
    	{
    		$des_dc = isset(self::$_Whid_To_DC[$wh_id]) ? self::$_Whid_To_DC[$wh_id] : false;
    	}
    
    	return $des_dc;
    }
    
    /*
     * 调用spp服务获取订单大小件信息从而确定配送时间的选择
     *
     * 大件一日一送、中小件上海一日三送
     * "items":{
	     "5":{
	     "items":{},
     */	     
    public static function getOrderSize($order) {

    	$ip = Config::getIP ( 'OrderManager' );
    	$addr = explode(":", $ip);
    	if ((false === $addr) || !is_array($addr) || (count($addr) < 2)) {
    		self::$errCode = 100;
    		self::$errMsg = 'get order spp ip config failed';
    		return false;
    	}
    	//构造请求包
    	$newreq = array();
    	$newreq['cmd'] = 32;
    	$newreq['products'] = array();
    	 
    	$myp = array();
    	foreach ($order['packages'] AS $key => $subOrder){
    		$myp['stockNo'] = $key;
    		$myp['items'] = array();
    		foreach($subOrder['items'] AS  $pid=>$info){
    			$its = array( 'product_id' => $pid,
    					'buy_count'  => intval($info['buy_count']));
    			array_push($myp['items'],$its);
    		}
    		array_push($newreq['products'],$myp);
    	}
    	
    	$newreqstr = ToolUtil::gbJsonEncode($newreq);
    	Logger::info(var_export($newreqstr,true));
   
    	if (strlen($newreqstr) >= (2 << 18) ){
    		self::$errCode = 101;
    		self::$errMsg = 'request str is too long';
    		return false;
    	}
    	
    	$rspStr = NetUtil::tcpCmd($addr[0], $addr[1],$newreqstr. "\r\n" , 3,3);
    	Logger::info(var_export($rspStr,true));
    	if (false == $rspStr) {
    		self::$errCode = 19;
    		self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[send package to order svr timeout]";
    		Logger::err(self::$errMsg);
    		self::$errMsg = '系统忙，请稍后重试';
    		return false;
    	}
    
    	$ret = ToolUtil::gbJsonDecode($rspStr);
    	if (is_array($ret) && $ret['errCode'] != 0) {
    		self::$errCode = $ret['errCode'];
    		self::$errMsg =  $ret['errMsg'];
    		return false;
    	}
    
    	return $ret;
    }

}
