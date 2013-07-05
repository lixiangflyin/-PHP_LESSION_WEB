<?php
/**
 * Created by handywu.
 * User: handywu
 * Date: 13-6-13
 * Time: 11:58
 * To change this template use File | Settings | File Templates.
 * Ps: 文件中接口仅供易迅无线侧购物流程调用
 */
if(!defined("PHPLIB_ROOT")) {
    define('PHPLIB_ROOT', '/data/release/PHPLIB/');
}
require_once(PHPLIB_ROOT . 'inc/special.constant.inc.php');
//require_once(PHPLIB_ROOT . 'api/appplatform/shoppingprocess/shoppingprocess.itil.inc.php');
/*
//套餐
define('PACKAGE_QUIRE',629507);
define('PACKAGE_SUCC',629508);
define('PACKAGE_FAILED',629509);
//赠品组件
define('GIFT_QUIRE',629510);
define('GIFT_SUCC',629511);
define('GIFT_FAILED',629512);
//单品赠券
define('SINGLECOUPON_QUIRE',629513);
define('SINGLECOUPON_SUCC',629514);
define('SINGLECOUPON_FAILED',629515);

//商品信息
define('PRODUCTINFO_QUIRE',629519);
define('PRODUCTINFO_SUCC',629520);
define('PRODUCTINFO_FAILED',629521);
//库存
define('INVENTORY_QUIRE',629522);
define('INVENTORY_SUCC',629523);
define('INVENTORY_FAILED',629524);
//配送
define('DISTRIBUTE_QUIRE',629525);
define('DISTRIBUTE_SUCC',629526);
define('DISTRIBUTE_FAILED',629527);

//宏定义
define("PRODUCT_TYING_EASY_MATCH", 1);
//请求来源
define("SCENE_SHOPPING_CART", "cart");
define("SCENE_SHOPPING_PROCESS", "process");
define("SCENE_SHOPPING_ORDER", "order");
*/

require_once(PHPLIB_ROOT . 'inc/district.inc.php');
require_once(PHPLIB_ROOT . 'inc/ship.inc.php');
require_once(PHPLIB_ROOT . 'lib/Config.php');
require_once(PHPLIB_ROOT . 'api/appplatform/shoppingprocess/m_shoppingprocess.class.php');
//require_once(PHPLIB_ROOT . 'api/appplatform/shoppingprocess/shoppingprocess.itil.inc.php');


class MShoppingProcess
{
    public static $errCode = 0;
    public static $errMsg = '';
    public static $logMsg = '';

    CONST ICSON_BOOKING_TYPE_DELAY_DAYS = 10; //正常延迟几天

    /**
     * 根据三级地域id、站id 获取对应的DC
     * @param $uid              用户uid
     * @param $district         三级地域ID
     * @param $whId             站ID
     * @return string $DC       DC
     */
    private static function _getDCByDistrictAndSite($district,$whId,$uid=0){
        if(($district <= 0 ) || ($whId <= 0 )) {
            return false;
        }
        $result = MStockDCWhOperator::GetDCByDistrictAndSite($district,$whId,$uid);
        if($result['code'] != 0 ) {
            self::$errCode = $result['code'];
            self::$errMsg =$result['errmsg'];
            return false;
        }
        $data = $result['data'];
        if($data['result'] != 0) {
            self::$errCode = $data['result'];
            self::$errMsg =$data['errmsg'];
            return false;
        }
        return $data['dcId'];
    }

    public static function getDeliveryInfo4Order($items, $inventorys, $whId, $destinationId, $uid, $userLevel = 0, $scene = SCENE_SHOPPING_CART)
    {
        $dc = self::_getDCByDistrictAndSite($destinationId, $whId, $uid);
        if(false === $dc)
        {
            Logger::err("getDeliveryInfo4Order _getDCByDistrictAndSite Error![whid:{$whId}][destinationId:{$destinationId}][uid;{$uid}][userLevel:{$userLevel}]items:" . ToolUtil::gbJsonEncode($items)."inventory".ToolUtil::gbJsonEncode($inventorys));
            return false;
        }
        $deliveryRet = MShippingOperator::getShippingforOrder($whId, $destinationId, $dc, $items, $inventorys, 0, $uid, $userLevel);
        if($deliveryRet['ret'] != 0 )
        {
            self::$errCode = $deliveryRet['ret'];
            Logger::err("getDeliveryInfo4Order getShippingforOrder Failed![whid:{$whId}][destinationId:{$destinationId}][uid;{$uid}][userLevel:{$userLevel}]items:" . ToolUtil::gbJsonEncode($items)."inventory".ToolUtil::gbJsonEncode($inventorys).",deliveryRet".ToolUtil::gbJsonEncode($deliveryRet));
            return false;
        }
        if(0 != $deliveryRet['resp']['result'])
        {
            self::$errCode = $deliveryRet['resp']['result'];
            Logger::err("getDeliveryInfo4Order getShippingforOrder Error![whid:{$whId}][destinationId:{$destinationId}][uid;{$uid}][userLevel:{$userLevel}]items:" . ToolUtil::gbJsonEncode($items)."inventory".ToolUtil::gbJsonEncode($inventorys).",deliveryRet".ToolUtil::gbJsonEncode($deliveryRet));
            return false;
        }
        $deliveryRet = $deliveryRet['resp'];
        $delivery = $deliveryRet['orderShipping'];
        $packageInfo = $delivery['mapPackageList'];
        $delayInfo = $delivery['mapDelayList'];
        $shipinfo = $delivery['vecShipinfo'];
        $isCanVATInvoice = $delivery['dwIsCanVAT'] == 0 ? false : true;
        $hasNoteBook = $delivery['dwHasNoteBook'];
        $totalWeight = $delivery['dwTotalWeight'];
        $totalCut = 0;
        $totalAmt = 0;
        $c3Ids = array();
        $packages = array();
        $shippingType = array();
        foreach($packageInfo as $subKey => $pack)
        {
            $packages[$subKey]['stock_wh_id'] = $pack['dwStockWhId'];
            $packages[$subKey]['psystock'] = $pack['dwPsyStockId'];
            $packages[$subKey]['wh_id'] = $whId;
            $packages[$subKey]['cross_stock'] = $pack['dwIsCrossStock'];
            $packages[$subKey]['sale_mode'] = $pack['dwSellMode'];
            $packages[$subKey]['seller_id'] = $pack['dwSellerId'];
            $packages[$subKey]['seller_stock_id'] = $pack['dwSellerStockId'];
            $packages[$subKey]['totalWeight'] = isset($pack['oSizeInfo']['ddwOrderWeight']) ? $pack['oSizeInfo']['ddwOrderWeight'] : 0;
            $packages[$subKey]['order_size'] = isset($pack['oSizeInfo']['dwOrderSize']) ? $pack['oSizeInfo']['dwOrderSize'] : 0;
            $packages[$subKey]['order_volume'] = isset($pack['oSizeInfo']['ddwOrderVolume']) ? $pack['oSizeInfo']['ddwOrderVolume'] : 0;
            $packages[$subKey]['order_longest'] = isset($pack['oSizeInfo']['ddwOrderMaxlength']) ? $pack['oSizeInfo']['ddwOrderMaxlength'] : 0;
            $packages[$subKey]['items'] = array();
            $packItmes = $pack['mapDwItems'];
            $pkgItems = array();
            foreach($packItmes as $pid => $pItem)
            {
                reset($items);
                foreach($items as $key=>$item)
                {
                    if($pid == $item['product_id'])
                    {
                        if(isset($pkgItems[$pid]))
                        {
                            $pkgItems[$pid]['buy_count'] += $item['buy_count'];
                            $pkgItems[$pid]['unit_price'] += $item['total_price_after'];
                            $pkgItems[$pid]['cash_back'] = $pkgItems[$pid]['cash_back'] == 0 ? $item['cash_back'] : $pkgItems[$pid]['cash_back'];
                        }
                        else
                        {
                            $pkgItems[$pid] = $item;
                            $pkgItems[$pid]['buy_count'] = $item['buy_count'];
                            $pkgItems[$pid]['unit_price'] = $item['total_price_after'];
                        }
                        $packages[$subKey]['totalAmt'] += $item['total_price_after'];
                        $packages[$subKey]['totalCut'] += $item['buy_count'] * $item['cash_back'];
                        $totalCut += $item['buy_count'] * $item['cash_back'];

                        $totalAmt += $item['total_price_after'];
                        $c3Ids[] = $item['c3_ids'];
                        $item['stock_desc'] = isset($pack['mapStrItems'][$pid]['stockDesc'])
                                              && !empty($pack['mapStrItems'][$pid]['stockDesc']) ? $pack['mapStrItems'][$pid]['stockDesc'] : $item['stock_desc'];
                        if (!isset($packages[$subKey]['isVirtual']))
                        {
                            $packages[$subKey]['isVirtual'] = 0;
                            $packages[$subKey]['vValue'] = 0;
                        }

                        if ($packages[$subKey]['isVirtual'] < $item['isVirtual'])
                        {
                            $packages[$subKey]['isVirtual'] = $item['isVirtual'];
                            $packages[$subKey]['vValue'] = $item['vValue'];
                        }
                        //给商品上新增一个分单的字段
                        $items[$key]['divide_id'] = $subKey;
                    }
                }
            }
            reset($pkgItems);
            foreach($pkgItems as $pid => $pkgItem)
            {
                $pkgItems[$pid]['price'] = $pkgItems[$pid]['unit_price'] / $pkgItems[$pid]['buy_count'];
                $pkgItems[$pid]['unit_price'] = $pkgItems[$pid]['price'];
            }
            reset($pkgItems);
            $packages[$subKey]['items'] = $pkgItems;
        }
        foreach($shipinfo as $key => $ship)
        {
            $key = $ship['dwShippingId'];   //无线格式和网站不一样，key从index转成shippingId
            $shippingType[$key]['SysNo'] = $ship['dwSysNo'];
            $shippingType[$key]['ShipTypeID'] = $ship['dwShipTypeID'];
            $shippingType[$key]['ShipTypeName'] = iconv("utf8", "gbk//IGNORE", $ship['strShipTypeName']);
            $shippingType[$key]['ShipTypeDesc'] = iconv("utf8", "gbk//IGNORE", $ship['strShipTypeDesc']);
            $shippingType[$key]['PremiumRate'] = $ship['strPremiumRate'];
            $shippingType[$key]['Status'] = $ship['dwStatus'];
            $shippingType[$key]['StatusQueryType'] = $ship['dwStatusQueryType'];
            $shippingType[$key]['StatusQueryUrl'] = $ship['strStatusQueryUrl'];
            $shippingType[$key]['IsOnlineShow'] = $ship['dwIsOnlineShow'];
            $shippingType[$key]['ShippingId'] = $ship['dwShippingId'];
            $shippingType[$key]['isCOD'] = $ship['dwIsCOD'];
            $shippingType[$key]['delivery_time'] = $ship['dwDeliveryTime'];
            $shippingType[$key]['shippingPrice'] = $ship['dwShippingPrice'];
            $shippingType[$key]['shippingPriceCut'] = $ship['dwShippingCut'];
            $shippingType[$key]['shippingCost'] = $ship['dwShippingCost'];
            $shippingType[$key]['free_type'] = $ship['dwShippingFreeType'];
            $shippingType[$key]['free_price_limit'] = $ship['dwShippingFreeLimit'];
            $shippingType[$key]['is_free'] = $ship['dwIsFree'];
            $subOrder = array();
            foreach($ship['mapSubShipping'] as $sub => $subShip)
            {
                $subOrder[$sub]['shippingPrice'] = $subShip['dwShippingPrice'];
                $subOrder[$sub]['shippingPriceCut'] = $subShip['dwShippingPriceCut'];
                $subOrder[$sub]['shippingCost'] = $subShip['dwShippingPriceCost'];
                $subOrder[$sub]['isArrivedLimitTime'] = $subShip['dwIsArrivedLimitTime'];
                //随心送
                $subOrder[$sub]['isCanXpress'] = $subShip['dwIsCanXpress'];
                $timeAvaiable = array();
                foreach($subShip['vecCalendar'] as $calKey => $calendar)
                {
                    $timeAvaiable[$calKey]['name'] = iconv("utf8", "gbk//IGNORE", $calendar['strName']);
                    $timeAvaiable[$calKey]['ship_date'] = $calendar['strShipDate'];
                    $timeAvaiable[$calKey]['week_day'] = $calendar['dwWeekDay'];
                    $timeAvaiable[$calKey]['time_span'] = $calendar['dwTimeSpan'];
                    $timeAvaiable[$calKey]['status'] = $calendar['dwStatus'];
                }
                $subOrder[$sub]['timeAvaiable'] = $timeAvaiable;
            }
            $shippingType[$key]['subOrder'] = $subOrder;
        }

        /*
        // 重新计算运费
        $shipInfo = array(
            'wh_id'       => $wh_id, //起始站点
            'destination' => $destinationId, //收获地区
            'order_price' => $totalAmt, //订单总金额
            'user_level'  => $user_level, //记录用户的等级
        );
        foreach ($packages as $subPackIndex => $pack)
        {
            $shipInfo['order_info'][$subPackIndex]['weight'] = $pack['totalWeight'];
        }
        
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
        //重新计算运费结束
        */

        $availableInvoices = array(
            'isCanVAT'    => $isCanVATInvoice,
            //如果购物车中有笔记本类商品，需要提示以公司开普通发票，无法保修
            'hasNoteBook' => $hasNoteBook,
            //拉取商品三级分类，判断是否能模糊开票
            'contentOpt'  => IPreOrderV2::getInvoicesContentOpt($c3Ids, $whId),
        );

        $result =  array(
            'items'        => $items,
            'packages'     => $packages,
            'shippingType' => $shippingType,
            'totalCut'     => $totalCut,
            'totalAmt'     => $totalAmt,
            'totalWeight'  => $totalWeight,
            'availableInvoices' => $availableInvoices,
        );
        Logger::info("getDeliveryInfo4Order result:" . ToolUtil::gbJsonEncode($result));
        return $result;
    }
}
