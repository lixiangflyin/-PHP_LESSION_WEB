<?php
/**
 * 易迅购物流程AO调用接口封装
 * ps：该文件中接口只用作易迅网站购物流程，
 *     其他业务如有使用请与sheldonshi联系，
 *     否则变更不作通知
 */

if(!defined("PHPLIB_ROOT")) {
    define('PHPLIB_ROOT', '/data/release/PHPLIB/');
}
require_once (PHPLIB_ROOT."api/appplatform/shoppingprocess/inc/attachmentao_php5_stub.php");
require_once (PHPLIB_ROOT."api/appplatform/shoppingprocess/inc/dashousellao_php5_stub.php");
require_once (PHPLIB_ROOT."api/appplatform/shoppingprocess/inc/paytypeao_php5_stub.php");
require_once (PHPLIB_ROOT."api/appplatform/productinventorydao_php5_stub.php");
require_once (PHPLIB_ROOT."api/appplatform/shoppingprocess/inc/shippingao_php5_stub.php");
require_once (PHPLIB_ROOT."api/appplatform/detailviewao_php5_stub.php");
require_once (PHPLIB_ROOT."api/appplatform/skuorderao_php5_stub.php");
require_once (PHPLIB_ROOT."api/appplatform/pointsaccountao_php5_stub.php");

//服务调用超时
if (!defined('WEB_STUB_TIME_OUT')) {
    define('WEB_STUB_TIME_OUT',3);
}

if (!defined('SCENE_SHOPPING_CART')) {
    define("SCENE_SHOPPING_CART", "cart");
}
if (!defined('SCENE_SHOPPING_PROCESS')) {
    define("SCENE_SHOPPING_PROCESS", "process");
}
if (!defined('SCENE_SHOPPING_ORDER')) {
    define("SCENE_SHOPPING_ORDER", "order");
}

define('ICSON_BOOKING_TYPE_SPECIFIC_DATE',11); //bookingtype 下指定的bookingvalue为字符串
define('SHOPPING_PROCESS_INVENTORY_SCENE_ID', 10008);

class AttachmentOperator{
    /*根据规则Id列表货套餐*/
    public  static function GetPackageByRules($whId, $districtId, $rulesId, $uid = 0, $scene = SCENE_SHOPPING_CART)
    {
        global $shoppingProcessItil;
        $itilId = $shoppingProcessItil[$scene]['tyinPackage']['succ']."|".$shoppingProcessItil[$scene]['tyinPackage']['failed']."|".$shoppingProcessItil[$scene]['tyinPackage']['timeout'];
        $uin = $uid;
        if($uin == 0 ) {
            $uin = rand(0,1000);
        }
        //调用php5
        $req = array(
            "stationId"  => $whId,
            "areaId"     => $districtId,
            "rulesId"    => $rulesId,
            "reserveIn"  => "",
            "machineKey" => __FILE__,
            "sceneId"    => 0,
        );
        $opt = array(
            'uin'       => $uin,
            'operator'  => $uin,
            'caller'    => "yx_shoppingprocess_" . $scene,
            'itil'      => $itilId,//填写申请的itil Id(对应setItilId:success|fail|timeout)注意：使用此项需载入itil.so扩展，否则会报错。
            'timeout'   => WEB_STUB_TIME_OUT,
        );
        ItilReport::itil_report($shoppingProcessItil[$scene]['tyinPackage']['req']);
        $pkgRet = WebStubCntl2::request('icson\deal\ao\attachment\GetPackageByRuleIds', array("opt" => $opt, "req" => $req));
        tmplog::Log("GetPackageByRuleIds==" .ToolUtil::gbJsonEncode($pkgRet));
        return $pkgRet;
    }
    /*根据主商品id列表获取赠品和组件*/
    public  static function GetGift($whId, $districtId, $productIds ,$uid = 0, $scene = SCENE_SHOPPING_CART)
    {
        global $shoppingProcessItil;
        $itilId = $shoppingProcessItil[$scene]['tyingGift']['succ']."|".$shoppingProcessItil[$scene]['tyingGift']['failed']."|".$shoppingProcessItil[$scene]['tyingGift']['timeout'];
        $uin = $uid;
        if($uin == 0 ) {
            $uin = rand(0,1000);
        }

        $req = array(
            "stationId"     => $whId,
            "areaId"        => $districtId,
            "mainproduct"   => array(
                                    "version"           => 0,
                                    "mainProductIdList" => $productIds,
                                ),
            "reserveIn"     => "",
            "machineKey"    => __FILE__,
            "sceneId"       => 0,
        );
        $opt = array(
            'uin'       => $uin,
            'operator'  => $uin,
            'caller'    => "yx_shoppingprocess_" . $scene,
            'itil'      => $itilId,//填写申请的itil Id(对应setItilId:success|fail|timeout)注意：使用此项需载入itil.so扩展，否则会报错。
            'timeout'   => WEB_STUB_TIME_OUT,
        );
        ItilReport::itil_report($shoppingProcessItil[$scene]['tyingGift']['req']);
        $giftRet = WebStubCntl2::request('icson\deal\ao\attachment\GetGift', array("opt" => $opt, "req" => $req));
        tmplog::Log("GetGift==" .ToolUtil::gbJsonEncode($giftRet));
        return $giftRet;
    }

    /*根据主商品id列表获取单品赠券*/
    public  static function GetSingleProCoupon($whId, $districtId, $productIds, $uid = 0, $scene = SCENE_SHOPPING_CART)
    {
        global $shoppingProcessItil;
        $itilId = $shoppingProcessItil[$scene]['singleCoupon']['succ']."|".$shoppingProcessItil[$scene]['singleCoupon']['failed']."|".$shoppingProcessItil[$scene]['singleCoupon']['timeout'];
        $uin = $uid;
        if($uin == 0 ) {
            $uin = rand(0,1000);
        }

        $req = array(
            "stationId"     => $whId,
            "areaId"        => $districtId,
            "mainproduct"   => array(
                "version"           => 0,
                "mainProductIdList" => $productIds,
            ),
            "reserveIn"     => "",
            "machineKey"    => __FILE__,
            "sceneId"       => 0,
        );
        $opt = array(
            'uin'       => $uin,
            'operator'  => $uin,
            'caller'    => "yx_shoppingprocess_" . $scene,
            'itil'      => $itilId,//填写申请的itil Id(对应setItilId:success|fail|timeout)注意：使用此项需载入itil.so扩展，否则会报错。
            'timeout'   => WEB_STUB_TIME_OUT,
        );
        ItilReport::itil_report($shoppingProcessItil[$scene]['singleCoupon']['req']);
        $singleRet = WebStubCntl2::request('icson\deal\ao\attachment\GetPromotion', array("opt" => $opt, "req" => $req));
        tmplog::Log("GetPromotion==" .ToolUtil::gbJsonEncode($singleRet));
        return $singleRet;
    }
}

class ProductInventoryOperator{
    /*根据商品Id 获取商品信息*/
    public static function GetProductInfo($whId, $productIds, $uid = 0, $scene = SCENE_SHOPPING_CART)
    {
        global $shoppingProcessItil;
        $itilId = $shoppingProcessItil[$scene]['product']['succ']."|".$shoppingProcessItil[$scene]['product']['failed']."|".$shoppingProcessItil[$scene]['product']['timeout'];
        $uin = $uid;
        if($uin == 0 ) {
            $uin = rand(0,1000);
        }
        $req = array(
            "source"        => __FILE__,
            "productParam"   => array(
                "version"           => 0,
                "productIdList" => $productIds,
                "whId"          => $whId,
            ),
            "reserveIn"     => "",
        );
        $opt = array(
            'uin'       => $uin,
            'operator'  => $uin,
            'caller'    => "yx_shoppingprocess_" . $scene,//调用方名字，用于模调(对应setCallerName)
            'itil'      => $itilId,//填写申请的itil Id(对应setItilId:success|fail|timeout)注意：使用此项需载入itil.so扩展，否则会报错。
            'timeout'   => WEB_STUB_TIME_OUT,
        );
        ItilReport::itil_report($shoppingProcessItil[$scene]['product']['req']);
        $productsRet = WebStubCntl2::request('icson\deal\dao\productinventory\GetProductInfo', array("opt" => $opt, "req" => $req));
        tmplog::Log("GetProductInfo==" .ToolUtil::gbJsonEncode($productsRet));
        return $productsRet;
    }

    /*获取库存*/
    public static function GetInventory($whId, $districtId, $productIds, $uid = 0, $scene = SCENE_SHOPPING_CART)
    {
        global $shoppingProcessItil;
        $itilId = $shoppingProcessItil[$scene]['inventory']['succ']."|".$shoppingProcessItil[$scene]['inventory']['failed']."|".$shoppingProcessItil[$scene]['inventory']['timeout'];
        $uin = $uid;
        if($uin == 0 ) {
            $uin = rand(0,1000);
        }

        $req = array(
            "source"         => __FILE__,
            "inventoryParam" => array(
                "version"           => 0,
                "productIdList" => $productIds,
                "districtId"    => $districtId,
                "whId"          => $whId,
                "stockId"       => $whId,
            ),
            "reserveIn"      => "",
        );
        $opt = array(
            'uin'       => $uin,
            'operator'  => $uin,
            'caller'    => "yx_shoppingprocess_" . $scene,
            'itil'      => $itilId,//填写申请的itil Id(对应setItilId:success|fail|timeout)注意：使用此项需载入itil.so扩展，否则会报错。
            'timeout'   => WEB_STUB_TIME_OUT,
        );
        ItilReport::itil_report($shoppingProcessItil[$scene]['inventory']['req']);
        $inventoryRet = WebStubCntl2::request('icson\deal\dao\productinventory\GetInventeoryInfo', array("opt" => $opt, "req" => $req));
        tmplog::Log("GetInventeoryInfo==" .ToolUtil::gbJsonEncode($inventoryRet));
        return $inventoryRet;
    }
}

class SkuViewOperator{
    /**
     * 获取商品信息--调用商品系统AO
     * @param $productIds	商品id数组
     * @param $whId			分站ID
     * @param $areaId		国标地域ID
     * @param $uid 			用户uid
     * @return array
     */
    public static function GetSkuListInfo4ShopCart($productIds, $whId, $areaId = 0, $uid = 0, $scene = SCENE_SHOPPING_CART)
    {
        global $shoppingProcessItil;
        $itilId = $shoppingProcessItil[$scene]['uniproduct']['succ']."|".$shoppingProcessItil[$scene]['uniproduct']['failed']."|".$shoppingProcessItil[$scene]['uniproduct']['timeout'];
        $uin = $uid;
        if($uin == 0 ) {
            $uin = rand(0,1000);
        }

        $skuListFilterArr = array();
        foreach ($productIds as $pid)
        {
            $skuFilterPo = array();
            $skuFilterPo['version']       = 0;
            $skuFilterPo['version_u']     = 1;
            $skuFilterPo['commodityId']   = "icson-".$pid;
            $skuFilterPo['commodityId_u'] = 1;

            $skuListFilterArr[] = $skuFilterPo;
        }
        $req = array(
            "machineKey"    => "shopcart",
            "source"        => __FILE__,
            "sceneId"       => 0x8001,
            "skuListFilter" => $skuListFilterArr,
            "areaId"        => $areaId,
        );
        $opt = array(
            'uin'       => $uin,
            'operator'  => $uin,
            'caller'    => "yx_shoppingprocess_" . $scene,
            'itil'      => $itilId,//填写申请的itil Id(对应setItilId:success|fail|timeout)注意：使用此项需载入itil.so扩展，否则会报错。
            'timeout'   => WEB_STUB_TIME_OUT,
        );

        $skuListRet = WebStubCntl2::request('b2b2c\sku\ao\FetchSkuListInfo4ShopCart', array("opt" => $opt, "req" => $req));
        tmplog::Log("FetchSkuListInfo4ShopCart==" .ToolUtil::gbJsonEncode($skuListRet));
        return $skuListRet;
    }
}

class StockDCWhOperator{
    //根据仓Id获取站
    public  static function  GetSiteByStock($stockIds, $uid = 0, $scene = SCENE_SHOPPING_CART)
    {
        $uin = $uid;
        if($uin == 0 ) {
            $uin = rand(0,1000);
        }

        $req = array(
            "source"   => __FILE__,
            "stockId"  => $stockIds,
        );
        $opt = array(
            'uin'       => $uin,
            'operator'  => $uin,
            'caller'    => "yx_shoppingprocess_" . $scene,
            //'itil' => '611512|611513|611514',//填写申请的itil Id(对应setItilId:success|fail|timeout)注意：使用此项需载入itil.so扩展，否则会报错。
            'timeout'   => WEB_STUB_TIME_OUT,
        );
        $siteRet = WebStubCntl2::request('icson\deal\dao\productinventory\GetSiteByStock', array("opt" => $opt, "req" => $req));

        return $siteRet;
    }

    // 根据三级地址及分站id，获取对应的DC
    public static function GetDCByDistrictAndSite($districtId, $siteId, $uid = 0, $scene = SCENE_SHOPPING_CART)
    {
        $uin = $uid;
        if($uin == 0 ) {
            $uin = rand(0,1000);
        }
        $req = array(
            "source"      => __FILE__,
            "districtId"  => $districtId,
            "siteId"      => $siteId,
        );
        $opt = array(
            'uin'       => $uin,
            'operator'  => $uin,
            'caller'    => "yx_shoppingprocess_" . $scene,
            //'itil' => '611512|611513|611514',//填写申请的itil Id(对应setItilId:success|fail|timeout)注意：使用此项需载入itil.so扩展，否则会报错。
            'timeout'   => WEB_STUB_TIME_OUT,
        );
        $dcRet = WebStubCntl2::request('icson\deal\dao\productinventory\GetDCByDistrictAndSite', array("opt" => $opt, "req" => $req));

        return $dcRet;
    }
}

class ShippingOperator{

    private static function _getShippingParam($inputitems, $inventorys){
        $productList = array();
        $items = array();
        foreach($inputitems as $value) {
            if( !isset($items[$value['product_id']] )) {
                $items[$value['product_id']] = $value;
                $items[$value['product_id']]['price'] = $value['price'] * $value['buy_count'];
            } else {
                $items[$value['product_id']]['price'] += ($value['price'] * $value['buy_count'] ) ;
                $items[$value['product_id']]['buy_count'] += $value['buy_count'] ;
            }
        }

        foreach ($items as $key => $item) {
            //库存信息
            $productid =  $item['product_id'];
            $inventoryInfo = array();
            $inventoryInfo['version']       = 0;
            $inventoryInfo['productId']     = $inventorys[ $productid ]['productId'];
            $inventoryInfo['saleStockId']   = $inventorys[ $productid ]['saleStockId'];
            $inventoryInfo['supplyStockId'] = $inventorys[ $productid ]['supplyStockId'];
            $inventoryInfo['availableNum']  = $inventorys[ $productid ]['availableNum'];
            $inventoryInfo['virtualNum']    = $inventorys[$productid ]['virtualNum'];
            $inventoryInfo['accountNum']    = $inventorys[ $productid ]['accountNum'];
            //赠品信息
            $arrGiftInfo = array();
            foreach($item['gift'] as $giftid => $giftvalue ) {
                $giftinfo = array();
                $giftinfo['version']    = 1;
                $giftinfo['giftWeight'] = $giftvalue['weight'];
                $giftinfo['stockNum']   = $giftvalue['stock_num'];
                $giftinfo['giftNum']    = $giftvalue['num'];

                $giftUnitPo = array();
                $giftUnitPo['productSysno']     = $giftid;
                $giftUnitPo['productSysno_u']   = 1;
                $giftUnitPo['productNum']       = $giftvalue['num'];
                $giftUnitPo['productNum_u']     = 1;
                $giftUnitPo['productWidth']     = $giftvalue['weight'];
                $giftUnitPo['productWeight_u']  = 1;
                $giftinfo['sizeInfo']    = $giftUnitPo;
                $giftinfo['sizeInfo_u']  = 1;

                $arrGiftInfo[] = $giftinfo;
            }

            $shippParam = array();
            $shippParam['version']      = 1;
            $shippParam['version_u']    = 1;
            $shippParam['productId']    = $productid;
            $shippParam['productId_u']  = 1;
            $shippParam['bookingType']  = $item['booking_type'];
            $shippParam['bookingType_u']= 1;
            if(ICSON_BOOKING_TYPE_SPECIFIC_DATE == $item['booking_type']) { //这种情况下booking_value为日期的字符串
                $shippParam['bookingValue'] = strtotime($item['booking_value']);
            } else {
                $shippParam['bookingValue'] = $item['booking_value'];
            }
            $shippParam['bookingValue_u']   = 1;

            if($item['restricted_trans_type'] > 0) {
                $shippParam['restrictedTransType']   = $item['restricted_trans_type'];
                $shippParam['restrictedTransType_u'] = 1;
            }
            $shippParam['inventoryInfo']    = $inventoryInfo; //库存信息的填充
            $shippParam['inventoryInfo_u']  = 1;
            $shippParam['sellerId']         = $item['seller_id']; //卖家的id
            $shippParam['sellerId_u']       = 1;
            $shippParam['sellerStockId']    = $item['seller_address_id'];
            $shippParam['sellerStockId_u']  = 1;
            $shippParam['flag']             = $item['flag'];
            $shippParam['price']            = $item['price'];
            $shippParam['weight']           = $item['weight'];
            $shippParam['buyCount']         = $item['buy_count'];
            $shippParam['buyCount_u']       = 1;
            $shippParam['cashBack']         = $item['cash_back'];
            $shippParam['c3Ids']            = $item['c3_ids'];
            $shippParam['giftList']         = $arrGiftInfo; //赠品的信息
            $shippParam['type']             = $item['type'];
            $shippParam['type_u']           = 1;

            $productUnitPo = array();
            $productUnitPo['productSysno']   = $productid;
            $productUnitPo['productSysno_u'] = 1;
            $productUnitPo['productNum']     = $item['buy_count'];
            $productUnitPo['productNum_u']   = 1;
            $productUnitPo['productWidth']   = $item['weight'];
            $productUnitPo['productWidth_u'] = 1;
            $shippParam['sizeInfo']         = $productUnitPo;
            $shippParam['sizeInfo_u']       = 1;

            $productList[$productid] = $shippParam;
        }

        return $productList;
    }

    public static function getShippingforOrder($whId, $destinationId, $dc, $items, $inventorys, $couponPrice = 0, $uid = 0, $userLevel=0, $sceneId = 0, $scene = SCENE_SHOPPING_PROCESS)
    {
        global $shoppingProcessItil;
        $itilId = $shoppingProcessItil[$scene]['delivery']['succ']."|".$shoppingProcessItil[$scene]['delivery']['failed']."|".$shoppingProcessItil[$scene]['delivery']['timeout'];
        $uin = $uid;
        if($uin == 0 ) {
            $uin = rand(0,1000);
        }

        $productList = self::_getShippingParam($items, $inventorys);
        $req = array(
            "whId"          => $whId,
            "destination"   => $destinationId,
            "dc"            => $dc,
            "userLevel"     => $userLevel,
            "productList"   => $productList,
            "couponPrice"   => $couponPrice,
            "extIn"         => array(),
            "sceneId"       => $sceneId,
            "source"        => __FILE__,
            "machineKey"    => __FILE__,
            "reserveIn"     => '',
        );

        $opt = array(
            'uin'       => $uin,
            'operator'  => $uin,
            'caller'    => "yx_shoppingprocess_" . $scene,
            'itil'      => $itilId,//填写申请的itil Id(对应setItilId:success|fail|timeout)注意：使用此项需载入itil.so扩展，否则会报错。
            'timeout'   => WEB_STUB_TIME_OUT,
        );
        ItilReport::itil_report($shoppingProcessItil[$scene]['delivery']['req']);
        $shippingRet = WebStubCntl2::request('icson\deal\ao\shipping\getShippingInfo4Order', array("opt" => $opt, "req" => $req));
        tmplog::Log("getShippingInfo4Order==" .ToolUtil::gbJsonEncode($shippingRet));
        return $shippingRet;
    }

    public static function getShippingOrsforOrder($whId,$destinationId,$dc,$items,$inventorys,$couponPrice=0,$uid =0,$userLevel=0,$sceneId = 0, $isOrder = "0", $scene = SCENE_SHOPPING_CART)
    {
        global $shoppingProcessItil;
        $itilId = $shoppingProcessItil[$scene]['deliveryOrs']['succ']."|".$shoppingProcessItil[$scene]['deliveryOrs']['failed']."|".$shoppingProcessItil[$scene]['deliveryOrs']['timeout'];
        $uin = $uid;
        if($uin == 0 ) {
            $uin = rand(0,1000);
        }
        $productList = self::_getShippingParam($items, $inventorys);
        $req = array(
            "whId"          => $whId,
            "destination"   => $destinationId,
            "dc"            => $dc,
            "userLevel"     => $userLevel,
            "userId"        => intval($uid),
            "productList"   => $productList,
            "couponPrice"   => $couponPrice,
            "extIn"         => array("isPlaceOrder" => $isOrder),
            "sceneId"       => $sceneId,
            "source"        => __FILE__,
            "machineKey"    => __FILE__,
            "reserveIn"     => '',
        );

        $opt = array(
            'uin'       => $uin,
            'operator'  => $uin,
            'caller'    => "yx_shoppingprocess_" . $scene,
            'itil'      => $itilId,//填写申请的itil Id(对应setItilId:success|fail|timeout)注意：使用此项需载入itil.so扩展，否则会报错。
            'timeout'   => WEB_STUB_TIME_OUT,
        );
        ItilReport::itil_report($shoppingProcessItil[$scene]['deliveryOrs']['req']);
        $shippingRet = WebStubCntl2::request('icson\deal\ao\shipping\getShippingOrsOrders', array("opt" => $opt, "req" => $req));
        tmplog::Log("getShippingOrsOrders==" .ToolUtil::gbJsonEncode($shippingRet));
        return $shippingRet;
    }

    public static function getShippingforCart($whId, $destinationId, $dc, $inputitems, $inventorys, $uid = 0, $userLevel = 0,$sceneId = 0, $scene = SCENE_SHOPPING_CART)
    {
        global $shoppingProcessItil;
        $itilId = $shoppingProcessItil[$scene]['delivery']['succ']."|".$shoppingProcessItil[$scene]['delivery']['failed']."|".$shoppingProcessItil[$scene]['delivery']['timeout'];
        $uin = $uid;
        if($uin == 0 ) {
            $uin = rand(0,1000);
        }

        $arrShippSmallParam = array();
        $items = array();
        foreach($inputitems as $value)
        {
            if( !isset($items[$value['product_id']] )) {
                $items[$value['product_id']] = $value;
                $items[$value['product_id']]['price'] = $value['price'] * $value['buy_count'];
            } else {
                $items[$value['product_id']]['price'] += ($value['price'] * $value['buy_count'] ) ;
                $items[$value['product_id']]['buy_count'] += $value['buy_count'] ;
            }
        }
        foreach ($items as $key => $item)
        {
            $productid =  $item['product_id'];
            //库存信息
            $inventoryInfo = array();
            $inventoryInfo['version']       = 0;
            $inventoryInfo['productId']     = $inventorys[$productid]['productId'];
            $inventoryInfo['saleStockId']   = $inventorys[$productid]['saleStockId'];
            $inventoryInfo['supplyStockId'] = $inventorys[$productid]['supplyStockId'];
            $inventoryInfo['availableNum']  = $inventorys[$productid]['availableNum'];
            $inventoryInfo['virtualNum']    = $inventorys[$productid]['virtualNum'];
            $inventoryInfo['accountNum']    = $inventorys[$productid]['accountNum'];

            $ShippSmallParam = array();
            $ShippSmallParam['version']       = 1;
            $ShippSmallParam['version_u']     = 1;
            $ShippSmallParam['productId']     = $productid ;
            $ShippSmallParam['productId_u']   = 1;
            $ShippSmallParam['sellerId']      = $item['seller_id'];
            $ShippSmallParam['sellerId_u']    = 1;
            $ShippSmallParam['bookingType']   = $item['booking_type'];
            $ShippSmallParam['bookingType_u'] = 1;
            if(ICSON_BOOKING_TYPE_SPECIFIC_DATE == $item['booking_type']) { //这种情况下booking_value为日期的字符串
                $ShippSmallParam['bookingValue'] = strtotime($item['booking_value']);
            } else {
                $ShippSmallParam['bookingValue'] = $item['booking_value'];
            }
            $ShippSmallParam['bookingValue_u'] = 1;

            if($item['restricted_trans_type'] > 0) {
                $ShippSmallParam['restrictedTransType']   = $item['restricted_trans_type'];
                $ShippSmallParam['restrictedTransType_u'] = 1;
            }

            $ShippSmallParam['buyCount']        = $item['buy_count'];
            $ShippSmallParam['buyCount_u']      = 1;
            $ShippSmallParam['inventoryInfo']   = $inventoryInfo; //库存信息的填充
            $ShippSmallParam['inventoryInfo_u'] = 1;

            $ShippSmallParam['flag']            = $item['flag'];
            $ShippSmallParam['flag_u']          = 1;
            $ShippSmallParam['type']            = $item['type'];
            $ShippSmallParam['type_u']          = 1;

            $arrShippSmallParam[$productid ] = $ShippSmallParam;
        }
        $req = array(
            "whId"              => $whId,
            "shippingParamList" => $arrShippSmallParam,
            "destination"   => $destinationId,
            "dc"            => $dc,
            "extIn"         => array(),
            "sceneId"       => $sceneId,
            "source"        => __FILE__,
            "machineKey"    => __FILE__,
            "reserveIn"     => '',
        );

        $opt = array(
            'uin'       => $uin,
            'operator'  => $uin,
            'caller'    => "yx_shoppingprocess_" . $scene,
            'itil'      => $itilId,//填写申请的itil Id(对应setItilId:success|fail|timeout)注意：使用此项需载入itil.so扩展，否则会报错。
            'timeout'   => WEB_STUB_TIME_OUT,
        );
        ItilReport::itil_report($shoppingProcessItil[$scene]['delivery']['req']);
        $shippingRet = WebStubCntl2::request('icson\deal\ao\shipping\getShippingInfo4Cart', array("opt" => $opt, "req" => $req));
        tmplog::Log("getShippingInfo4Cart==" .ToolUtil::gbJsonEncode($shippingRet));
        return $shippingRet;
    }


    public static function getShippingforPlaceOrder($whId,$destinationId,$dc,$items,$inventorys,$orderPrice=0,$uid =0,$userLevel=0,$sceneId = 0, $isOrder = "0", $scene = SCENE_SHOPPING_ORDER)
    {
        global $shoppingProcessItil;
        $itilId = $shoppingProcessItil[$scene]['delivery']['succ']."|".$shoppingProcessItil[$scene]['delivery']['failed']."|".$shoppingProcessItil[$scene]['delivery']['timeout'];
        $uin = $uid;
        if($uin == 0 ) {
            $uin = rand(0,1000);
        }

        $productList = self::_getShippingParam($items, $inventorys);
        $req = array(
            "whId"          => $whId,
            "destination"   => $destinationId,
            "dc"            => $dc,
            "userLevel"     => $userLevel,
            "productList"   => $productList,
            "orderPrice"    => $orderPrice,
            "extIn"         => array(),
            "sceneId"       => $sceneId,
            "source"        => __FILE__,
            "machineKey"    => __FILE__,
            "reserveIn"     => '',
        );

        $opt = array(
            'uin'       => $uin,
            'operator'  => $uin,
            'caller'    => "yx_shoppingprocess_" . $scene,
            'itil'      => $itilId,//填写申请的itil Id(对应setItilId:success|fail|timeout)注意：使用此项需载入itil.so扩展，否则会报错。
            'timeout'   => WEB_STUB_TIME_OUT,
        );
        ItilReport::itil_report($shoppingProcessItil[$scene]['delivery']['req']);
        $shippingRet = WebStubCntl2::request('icson\deal\ao\shipping\getShippingInfo4PlaceOrder', array("opt" => $opt, "req" => $req));
        tmplog::Log("getShippingInfo4PlaceOrder==" .ToolUtil::gbJsonEncode($shippingRet));
        return $shippingRet;
    }


    public static function getShippingPack($whId, $destinationId, $dc, $items, $inventorys, $orderPrice = 0, $uid = 0, $sceneId = 0, $scene = SCENE_SHOPPING_ORDER)
    {
        $uin = $uid;
        if($uin == 0 ) {
            $uin = rand(0,1000);
        }
        $productList = self::_getShippingParam($items, $inventorys);
        $req = array(
            "whId"              => $whId,
            "destination"   => $destinationId,
            "dc"            => $dc,
            "productList"   => $productList,
            "extIn"         => array(),
            "sceneId"       => $sceneId,
            "source"        => __FILE__,
            "machineKey"    => __FILE__,
            "reserveIn"     => '',
        );

        $opt = array(
            'uin'       => $uin,
            'operator'  => $uin,
            'caller'    => "yx_shoppingprocess_" . $scene,
            //'itil' => '611512|611513|611514',//填写申请的itil Id(对应setItilId:success|fail|timeout)注意：使用此项需载入itil.so扩展，否则会报错。
            'timeout'   => WEB_STUB_TIME_OUT,
        );
        $shippingRet = WebStubCntl2::request('icson\deal\ao\shipping\getPackages', array("opt" => $opt, "req" => $req));
        tmplog::Log("getPackages==" .ToolUtil::gbJsonEncode($shippingRet));
        return $shippingRet;
    }
}

class TyingOperator{
    //将输入的item转换为以MainProductId 为key的数组 这里是否要剔除掉套餐数据
    private static function _getmapMain($inputItems)
    {
        $mapitem = array();
        $matchitem = array();
        foreach($inputItems as $item) {
            if( ($item['main_product_id'] >0 ) && ($item['package_id'] == 0) ) {
                $findflag =0;
                $mainproduct = $item['main_product_id'] ;
                foreach($inputItems as $value )
                {
                    //剔除掉套餐添加进来的商品
                    if( ($mainproduct == $value['product_id']) && ($value['package_id'] == 0) )
                    {
                        $findflag = 1;
                        if( !array_key_exists( $mainproduct , $mapitem ) )
                        {
                            $mapitem[$mainproduct]['product_id'] = $mainproduct;
                            $mapitem[$mainproduct]['type'] = 0; //普通商品的类型
                            $mapitem[$mainproduct]['buy_count'] =  $value['buy_count'];
                            $mapitem[$mainproduct]['prodcut'] = array();
                        }

                        break;

                    }
                }
                if( 0 == $findflag )
                {
                    continue;
                }
                $product = $item['product_id'] ;
                if( array_key_exists( $mainproduct , $mapitem ) )
                {
                    if( array_key_exists( $product , $mapitem[$mainproduct]['prodcut'] ) )
                    {
                        // 这里处理是否合理？
                        $mapitem[$mainproduct]['product'][$product]['buy_count'] =  $mapitem[$mainproduct][$product]['buy_count'] + $item['buy_count'];
                    }
                    else
                    {
                        $mapitem[$mainproduct]['product'][$product] =  $item;
                    }
                    $matchitem[$product] = 1;
                }
                else
                {
                    $mapitem[$mainproduct]['product'][$product] =  $item;
                }
                $matchitem[$mainproduct] = 1;
            }
        }
        //这里将没有添加到这个列表中的所有其他商品也进行添加.
        foreach($inputItems as $value)
        {
            if( !array_key_exists($value['product_id'] , $matchitem))
            {
                if($value['package_id'] == 0 ) {
                    $mapitem[$value['product_id']]['type'] = 0; //普通商品的类型
                    $mapitem[$value['product_id']]['buy_count'] = $value['buy_count'];
                    $mapitem[$value['product_id']]['product_id'] = $value['product_id'];
                    $mapitem[$value['product_id']]['product'] = array();

                }
            }
        }
        return $mapitem;
    }



    private static function _getInputTogetherSell($inputitems)
    {
        $mapItem =self::_getmapMain($inputitems);

        //组装入参
        $inputParam = array();

        $SellCheck = array();
        foreach($mapItem as $key => $item)
        {
            $arrRule = array();
            foreach($item['product'] as $id => $it)
            {
                $rule = array();
                $rule['version']        = 0;
                $rule['version_u']      = 1;
                $rule['ruleType']       = 1; //1 表示随心配
                $rule['ruleType_u']     = 1;
                $rule['subProductId']   = $id;
                $rule['subProductId_u'] = 1;
                $rule['buyNum']         = $it['buy_count'];
                $rule['buyNum_u']       = 1;

                $arrRule[] = $rule;
            }

            $sellbo = array();
            $sellbo['version']          = 0;
            $sellbo['version_u']        = 1;
            $sellbo['type']             = $item['type'];  //商品类型
            $sellbo['type_u']           = 1;
            $sellbo['mainProductId']    = $key;
            $sellbo['mainProductId_u']  = 1;
            $sellbo['mainBuyNum']       = $item['buy_count'];
            $sellbo['mainBuyNum_u']     = 1;
            $sellbo['rulesChecked']     = $arrRule;
            $sellbo['rulesChecked_u']   = 1;
            $SellCheck[] = $sellbo;
        }

        $inputParam['version']                = 0 ;
        $inputParam['version_u']              = 1;
        $inputParam['togetherSellCheckVec']   = $SellCheck;
        $inputParam['togetherSellCheckVec_u'] = 1;

        return $inputParam;
    }

    public static function GetTying($inputitems, $whId, $desinationId, $uid = 0, $scene = SCENE_SHOPPING_CART)
    {
        global $shoppingProcessItil;
        $itilId = $shoppingProcessItil[$scene]['tyingMind']['succ']."|".$shoppingProcessItil[$scene]['tyingMind']['failed']."|".$shoppingProcessItil[$scene]['tyingMind']['timeout'];
        $uin = $uid;
        if($uin == 0 ) {
            $uin = rand(0,1000);
        }

        $inputParam = self::_getInputTogetherSell($inputitems);
        $req = array(
            "machineKey"              => __FILE__,
            "source"   => __FILE__,
            "sceneId"            => 1000000,
            "whId"   => $whId,
            "regionId"         => $desinationId,
            "uid"       => intval($uid),
            "checkParam"        => $inputParam,
            "reserveIn"    => '',
        );

        $opt = array(
            'uin'       => $uin,
            'operator'  => $uin,
            'caller'    => "yx_shoppingprocess_" . $scene,
            'itil'      => $itilId,//填写申请的itil Id(对应setItilId:success|fail|timeout)注意：使用此项需载入itil.so扩展，否则会报错。
            'timeout'   => WEB_STUB_TIME_OUT,
        );
        ItilReport::itil_report($shoppingProcessItil[$scene]['tyingMind']['req']);
        $tyingRet = WebStubCntl2::request('icson\dashou\ao\dashousell\CheckTogetherSell', array("opt" => $opt, "req" => $req));
        tmplog::Log("CheckTogetherSell==" .ToolUtil::gbJsonEncode($tyingRet));
        return $tyingRet;
    }
}

class UniInventoryOperator{
    private static function _parameterHash($fixupInfoPo)
    {
        $paraHash  = $fixupInfoPo['productSysno']      . "|";
        $paraHash .= $fixupInfoPo['stockSysno']        . "|";
        $paraHash .= $fixupInfoPo['orderToken']        . "|";
        $paraHash .= $fixupInfoPo['orderSequence']     . "|";
        $paraHash .= $fixupInfoPo['orderSysno']        . "|";
        $paraHash .= $fixupInfoPo['userNo']            . "|";
        $paraHash .= "0|";
        $paraHash .= $fixupInfoPo['orderDecreasedNum'] . "|";
        $paraHash .= "0|0|0|0|";

        return $paraHash;
    }
    private static function _parameterFactory($uid, $modifyType, $inventroyData)
    {
        Logger::info("_parameterFactory ==". ToolUtil::gbJsonEncode($inventroyData));
        $fixupInfoPo = array();
        $fixupInfoPo['version']             = 0;
        $fixupInfoPo['version_u']           = 1;
        $fixupInfoPo['productSysno']        = $inventroyData['product_id'];
        $fixupInfoPo['productSysno_u']      = 1;
        $fixupInfoPo['stockSysno']          = $inventroyData['sys_stock'];
        $fixupInfoPo['stockSysno_u']         = 1;
        $fixupInfoPo['orderToken']          = $inventroyData['order_id'];
        $fixupInfoPo['orderToken_u']        = 1;
        $fixupInfoPo['orderSequence']       = $inventroyData['order_creat_time'];
        $fixupInfoPo['orderSequence_u']     = 1;
        $fixupInfoPo['orderSysno']          = $inventroyData['order_id'];
        $fixupInfoPo['orderSysno_u']        = 1;
        $fixupInfoPo['userNo']              = $uid;
        $fixupInfoPo['userNo_u']            = 1;
        $fixupInfoPo['platform']            = 1;
        $fixupInfoPo['platform_u']          = 1;
        $fixupInfoPo['orderDecreasedNum']   = $inventroyData['buy_count'];
        $fixupInfoPo['orderDecreasedNum_u'] = 1;
        $fixupInfoPo['orderSource']         = 7;
        $fixupInfoPo['orderSource_u']       = 1;
        $fixupInfoPo['orderType']           = $inventroyData['order_type'];
        $fixupInfoPo['orderType_u']         = 1;
        $fixupInfoPo['fixupHash']           = self::_parameterHash($fixupInfoPo);
        $fixupInfoPo['fixupHash_u'] = 0;

        $event4AppPo = array();
        $event4AppPo['version']             = 0;
        $event4AppPo['version_u']           = 1;
        $event4AppPo['eventId']             = $inventroyData['order_id'];
        $event4AppPo['eventId_u']           = 1;
        $event4AppPo['eventType']           = 1;
        $event4AppPo['eventType_u']         = 1;
        $event4AppPo['eventSourceId']       = 1;
        $event4AppPo['eventSourceId_u']     = 1;
        $event4AppPo['eventModifyType']     = $modifyType;
        $event4AppPo['eventModifyType_u']   = 1;
        $event4AppPo['eventCreateTime']     = $inventroyData['order_creat_time'];
        $event4AppPo['eventCreateTime_u']   = 1;
        $event4AppPo['eventExcuteTime']     = time();
        $event4AppPo['eventExcuteTime_u']   = 1;
        $event4AppPo['operatorId']          = $uid;
        $event4AppPo['operatorId_u']        = 1;
        $event4AppPo['operatorClientIp']    = ToolUtil::getClientIP(true);
        $event4AppPo['operatorClientIp_u']  = 1;

        Logger::info("_parameterFactory" . ToolUtil::gbJsonEncode($fixupInfoPo));
        Logger::info("_parameterFactory111" . ToolUtil::gbJsonEncode($event4AppPo));
        return array(
            'fixupInfoPo' => $fixupInfoPo,
            'event4AppPo' => $event4AppPo,
        );
    }

    /**
     * 统一库存后台调用接口--库存锁定
     * @param $uid                  用户UID
     * @param $inventroyData        库存锁定相关信息
     * @return array
     */
    public static function LockProductInventory($uid, $inventroyData, $scene = SCENE_SHOPPING_ORDER)
    {
        IShoppingProcess::Log("LockProductInventory Start: " . ToolUtil::gbJsonEncode($inventroyData), true, "uniinventory");
        global $shoppingProcessItil;
        $itilId = $shoppingProcessItil[$scene]['uniInventoryLock']['succ']."|".$shoppingProcessItil[$scene]['uniInventoryLock']['failed']."|".$shoppingProcessItil[$scene]['uniInventoryLock']['timeout'];
        $inputPara = self::_parameterFactory($uid, 1, $inventroyData);
        $req = array(
            "machineKey"  => __FILE__,
            "source"      => __FILE__,
            "sceneId"     => SHOPPING_PROCESS_INVENTORY_SCENE_ID,
            "lockType"    => 0,
            "fixupInfoPo" => $inputPara['fixupInfoPo'],
            "eventPo"     => $inputPara['event4AppPo'],
        );

        $opt = array(
            'uin'       => $uid,
            'operator'  => $uid,
            'caller'    => "yx_shoppingprocess_" . $scene,
            'itil'      => $itilId,//填写申请的itil Id(对应setItilId:success|fail|timeout)注意：使用此项需载入itil.so扩展，否则会报错。
            'timeout'   => WEB_STUB_TIME_OUT,
        );
        ItilReport::itil_report($shoppingProcessItil[$scene]['uniInventoryLock']['req']);
        $inventroyRet = WebStubCntl2::request('b2b2c\skuorder\ao\LockProduct', array("opt" => $opt, "req" => $req));
        IShoppingProcess::Log("LockProductInventory Finish: " . ToolUtil::gbJsonEncode($inventroyRet), true, "uniinventory");
        tmplog::Log("LockProduct==" .ToolUtil::gbJsonEncode($inventroyRet));
        return $inventroyRet;
    }

    /**
     * 统一库存后台调用接口--库存解锁
     * @param $uid                      用户UID
     * @param $inventroyData            库存锁定相关信息
     * @return array
     */
    public static function UnlockProductInventory($uid, $inventroyData, $scene = SCENE_SHOPPING_ORDER)
    {
        IShoppingProcess::Log("UnlockProductInventory Start: " . ToolUtil::gbJsonEncode($inventroyData), true, "uniinventory");
        global $shoppingProcessItil;
        $itilId = $shoppingProcessItil[$scene]['uniInventoryUnlock']['succ']."|".$shoppingProcessItil[$scene]['uniInventoryUnlock']['failed']."|".$shoppingProcessItil[$scene]['uniInventoryUnlock']['timeout'];
        $inputPara = self::_parameterFactory($uid, 1, $inventroyData);
        $req = array(
            "machineKey"  => __FILE__,
            "source"      => __FILE__,
            "sceneId"     => SHOPPING_PROCESS_INVENTORY_SCENE_ID,
            "fixupInfoPo" => $inputPara['fixupInfoPo'],
            "eventPo"     => $inputPara['event4AppPo'],
        );

        $opt = array(
            'uin'       => $uid,
            'operator'  => $uid,
            'caller'    => "yx_shoppingprocess_" . $scene,
            'itil'      => $itilId,//填写申请的itil Id(对应setItilId:success|fail|timeout)注意：使用此项需载入itil.so扩展，否则会报错。
            'timeout'   => WEB_STUB_TIME_OUT,
        );
        ItilReport::itil_report($shoppingProcessItil[$scene]['uniInventoryUnlock']['req']);
        $inventroyRet = WebStubCntl2::request('b2b2c\skuorder\ao\UnlockProduct', array("opt" => $opt, "req" => $req));
        IShoppingProcess::Log("UnlockProductInventory Finish: " . ToolUtil::gbJsonEncode($inventroyRet), true, "uniinventory");
        tmplog::Log("UnlockProduct==" .ToolUtil::gbJsonEncode($inventroyRet));
        return $inventroyRet;
    }
}

class PayTypeOperator{
    //根据所有可用的支付方式信息
    public static function GetAllPayTypeInfo($shippingType, $wh_id = 1, $productidArr = array(), $userType = false, $cartType = 0, $uid = 0, $scene = SCENE_SHOPPING_PROCESS)
    {
        global $shoppingProcessItil;
        $itilId = $shoppingProcessItil[$scene]['allpay']['succ']."|".$shoppingProcessItil[$scene]['allpay']['failed']."|".$shoppingProcessItil[$scene]['allpay']['timeout'];
        $uin = $uid;
        if($uin == 0 ) {
            $uin = rand(0,1000);
        }

        $payTypeParam = array();
        $payTypeParam['version']         = 0;
        $payTypeParam['shipTypeId']      = $shippingType;
        $payTypeParam['shipTypeId_u']    = 1;
        $payTypeParam['whId']            = $wh_id;
        $payTypeParam['whId_u']          = 1;
        $payTypeParam['uid']             = $uid;
        $payTypeParam['uid_u']           = 1;
        $payTypeParam['userType']        = $userType;
        $payTypeParam['userType_u']      = 1;
        $payTypeParam['cartType']        = $cartType;
        $payTypeParam['cartType_u']      = 1;
        $payTypeParam['productIdList']   = $productidArr;
        $payTypeParam['productIdList_u'] = 1;

        $req = array(
            "source"       => __FILE__,
            "payTypeParam" => $payTypeParam,
            "reserveIn"    => '',
        );

        $opt = array(
            'uin'       => $uin,
            'operator'  => $uin,
            'caller'    => "yx_shoppingprocess_" . $scene,
            'itil'      => $itilId,//填写申请的itil Id(对应setItilId:success|fail|timeout)注意：使用此项需载入itil.so扩展，否则会报错。
            'timeout'   => WEB_STUB_TIME_OUT,
        );
        $payTypeRet = WebStubCntl2::request('icson\deal\ao\paytype\GetAllPayTypeInfo', array("opt" => $opt, "req" => $req));
        tmplog::Log("GetAllPayTypeInfo==" .ToolUtil::gbJsonEncode($payTypeRet));
        return $payTypeRet;
    }

    //根据指定的支付方式信息
    public static function GetPayTypeInfo($payTypeId, $shippingType, $whId = 1, $productidArr = array(), $userType = false, $cartType = 0, $uid = 0, $scene = SCENE_SHOPPING_ORDER)
    {
        global $shoppingProcessItil;
        $itilId = $shoppingProcessItil[$scene]['pay']['succ']."|".$shoppingProcessItil[$scene]['pay']['failed']."|".$shoppingProcessItil[$scene]['pay']['timeout'];
        $uin = $uid;
        if($uin == 0 ) {
            $uin = rand(0,1000);
        }

        $payTypeParam = array();
        $payTypeParam['version']         = 0;
        $payTypeParam['payTypeId']       = $payTypeId;
        $payTypeParam['payTypeId_u']     = 1;
        $payTypeParam['shipTypeId']      = $shippingType;
        $payTypeParam['shipTypeId_u']    = 1;
        $payTypeParam['whId']            = $whId;
        $payTypeParam['whId_u']          = 1;
        $payTypeParam['uid']             = $uid;
        $payTypeParam['uid_u']           = 1;
        $payTypeParam['userType']        = $userType;
        $payTypeParam['userType_u']      = 1;
        $payTypeParam['cartType']        = $cartType;
        $payTypeParam['cartType_u']      = 1;
        $payTypeParam['productIdList']   = $productidArr;
        $payTypeParam['productIdList_u'] = 1;

        $req = array(
            "source"       => __FILE__,
            "payTypeParam" => $payTypeParam,
            "reserveIn"    => '',
        );

        $opt = array(
            'uin'       => $uin,
            'operator'  => $uin,
            'caller'    => "yx_shoppingprocess_" . $scene,
            'itil'      => $itilId,//填写申请的itil Id(对应setItilId:success|fail|timeout)注意：使用此项需载入itil.so扩展，否则会报错。
            'timeout'   => WEB_STUB_TIME_OUT,
        );
        $payTypeRet = WebStubCntl2::request('icson\deal\ao\paytype\GetPayTypeInfo', array("opt" => $opt, "req" => $req));
        tmplog::Log("GetPayTypeInfo==" .ToolUtil::gbJsonEncode($payTypeRet));
        return $payTypeRet;
    }
}

class PointOperator{
    public static function GetUserPoints($uid)
    {
        global $shoppingProcessOtherItil;
        $itilId = $shoppingProcessOtherItil['userpoint']['succ']."|".$shoppingProcessOtherItil['userpoint']['failed']."|".$shoppingProcessOtherItil['userpoint']['timeout'];
        $req = array(
            "source"     => __FILE__,
            "machineKey" => ToolUtil::getClientIP(),
            "sceneId"    => 0,
            "icsonUid"   => intval($uid),
        );
        $opt = array(
            'uin'       => $uid,
            'operator'  => $uid,    //操作者ID，一般填写用户QQ（对应setDwOperatorId）
            'itil'      => $itilId,
            'timeout'   => WEB_STUB_TIME_OUT,       //超时时间，以秒为单位，特殊情况下可以调大
        );
        ItilReport::itil_report($shoppingProcessOtherItil['userpoint']['req']);
        $pointRet = WebStubCntl2::request('b2b2c\account\ao\GetPointsAccount', array("opt" => $opt, "req" => $req));
        tmplog::Log("GetPointsAccount==" .ToolUtil::gbJsonEncode($pointRet));
        return $pointRet;
    }
}

class tmplog
{
    public static function Log($str, $backtrace = true, $folder = "shoppingprocess")
    {
        EL_Flow::getInstance("{$folder}")->append($str, $backtrace);
    }
}