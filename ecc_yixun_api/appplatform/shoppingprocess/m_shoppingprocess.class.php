<?php
/**
 * Created by handywu.
 * User: handywu
 * Date: 13-6-13
 * Time: 上午10:46
 * To change this template use File | Settings | File Templates.
 */

if(!defined("PHPLIB_ROOT")) {
    define('PHPLIB_ROOT', '/data/release/PHPLIB/');
}

define('ICSON_BOOKING_TYPE_SPECIFIC_DATE',11); //bookingtype 下指定的bookingvalue为字符串
define('WEB_STUB_TIME_OUT',3);
define('SHOPPING_PROCESS_INVENTORY_SCENE_ID', 10008);

require_once PHPLIB_ROOT."api/appplatform/shoppingprocess/include/productinventorydao_stub4php.php";
require_once PHPLIB_ROOT."api/appplatform/shoppingprocess/include/shippingao_stub4php.php";
require_once PHPLIB_ROOT."api/appplatform/shoppingprocess/include/shippingao_xxo.php";

require_once PHPLIB_ROOT."api/appplatform/platform/web_stub_cntl.php";
require_once PHPLIB_ROOT."api/appplatform/platform/lang_util.php";
class MWebCntl{
    public static function initCntl($uid)
    {
        $_cntl = new WebStubCntl();
        $sPassport = "0123456789";
        $_cntl->setDwOperatorId($uid);
        $_cntl->setSPassport($sPassport);
        $_cntl->setDwSerialNo(10002);
        $_cntl->setDwUin($uid);
        $_cntl->setWVersion(2);
        $_cntl->setCallerName("ICSON_shoppingprocess");
        return $_cntl;
    }
}


class MStockDCWhOperator{
    //根据仓Id获取站
    public  static function  GetSiteByStock($stockIds,$uid=0) {

		if($uid == 0 ) {
            $uid = rand(0,1000);
        }
        $vecStock = new stl_vector();
        $vecStock->setType('uint32_t');
        $vecStock->setValue($stockIds);



        $req = new GetSiteByStockReq;
        $resp = new GetSiteByStockResp;

        $req->stockId = $vecStock;
        $req->source = __FILE__;


        $cntl = MWebCntl::initCntl($uid);

        $ret = $cntl->invoke($req, $resp, WEB_STUB_TIME_OUT);
        //return (array('resp'=>$resp, 'ret'=>$ret));
		if($ret != 0 ) {
            return array(
                'code' => $ret,
                'msg'  =>'invoke err'
            );
        }
        return (array(
            'code' => $ret,
            'msg'  =>'',
            'data' => array(
                     'result' => $resp -> result,
                     'stockToSite' => $resp->stockToSite->getValue(),
                     'errmsg' => $resp -> errMsg
                     )
        ));
    }
    
	
	// 根据三级地址及分站id，获取对应的DC
    public static function GetDCByDistrictAndSite($district,$siteId,$uid=0) {
       
		if($uid == 0 ) {
            $uid = rand(0,1000);
        }

        $req = new GetDCByDistrictAndSiteReq;
        $resp = new GetDCByDistrictAndSiteResp;

        $req->districtId =  $district;
		$req->siteId =  $siteId;
        $req->source = __FILE__;


        $cntl = MWebCntl::initCntl($uid);

        $ret = $cntl->invoke($req, $resp, WEB_STUB_TIME_OUT);
        //return (array('resp'=>$resp, 'ret'=>$ret));
		if($ret != 0 ) {
            return array(
                'code' => $ret,
                'msg'  =>'invoke err'
            );
        }
        return (array(
            'code' => $ret,
            'msg'  =>'',
            'data' => array(
                     'result' => $resp -> result,
                     'dcId' => $resp->dcId,
                     'errmsg' => $resp -> errMsg
                     )
        ));
    }
}

class MShippingOperator{

    private static function _getShippingParam($inputitems,$inventorys){
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
            $inventoryInfo = new InventoryInfo();
            $productid =  $item['product_id'];
            $inventoryInfo -> dwVersion = $inventorys[ $productid ]['version'];
            $inventoryInfo -> dwProductId = $inventorys[ $productid ]['productId'];
            $inventoryInfo -> dwSaleStockId = $inventorys[ $productid ]['saleStockId'];
            $inventoryInfo -> dwSupplyStockId = $inventorys[ $productid ]['supplyStockId'];
            $inventoryInfo -> nAvailableNum = $inventorys[ $productid ]['availableNum'];
            $inventoryInfo -> nVirtualNum = $inventorys[$productid ]['virtualNum'];
            $inventoryInfo -> nAccountNum = $inventorys[ $productid ]['accountNum'];

            //赠品信息

            $arrGiftInfo = array();
            foreach($item['gift'] as $giftid => $giftvalue ) {
                $giftinfo =  new GiftInfo4Shipping();
                $giftinfo -> dwVersion = 1;
                $giftinfo -> dwGiftWeight = $giftvalue['weight'];
                $giftinfo -> dwStockNum = $giftvalue['stock_num'];
                $giftinfo -> dwGiftNum = $giftvalue['num'];

                $giftUnitPo = new ProductUnitPo();
                $giftUnitPo -> ddwProductSysno = $giftid;
                $giftUnitPo -> cProductSysno_u = 1;
                $giftUnitPo -> dwProductNum = $giftvalue['num'];
                $giftUnitPo -> cProductNum_u = 1;
                $giftUnitPo -> dwProductWeight = $giftvalue['weight'];
                $giftUnitPo ->cProductWeight_u = 1;
                $giftinfo -> oSizeInfo = $giftUnitPo;
                $giftinfo -> cSizeInfo_u = 1;

                $arrGiftInfo[] = $giftinfo;
            }

            $vecGiftInfo = new stl_vector();
            $vecGiftInfo->setType(GiftInfo4Shipping);
            $vecGiftInfo->setValue($arrGiftInfo);

            $shippParam = new ShippingParam();
            $shippParam -> dwVersion = 1;
            $shippParam -> cVersion_u = 1;
            $shippParam -> dwProductId = $productid;
            $shippParam -> cProductId_u = 1;
            $shippParam -> dwBookingType = $item['booking_type'];
            $shippParam -> cBookingType_u = 1;
            if(ICSON_BOOKING_TYPE_SPECIFIC_DATE == $item['booking_type']) { //这种情况下booking_value为日期的字符串
                $shippParam -> dwBookingValue = strtotime($item['booking_value']);
            } else {
                $shippParam -> dwBookingValue = $item['booking_value'];
            }
            $shippParam -> cBookingValue_u = 1;
           
            if($item['restricted_trans_type'] > 0) {
				$shippParam -> dwRestrictedTransType = $item['restricted_trans_type'];
                $shippParam -> cRestrictedTransType_u = 1;
            }
            $shippParam -> oInventoryInfo = $inventoryInfo; //库存信息的填充
            $shippParam -> cInventoryInfo_u = 1;
            $shippParam -> dwSellerId = $item['seller_id']; //卖家的id
            $shippParam -> cSellerId_u = 1;
            $shippParam -> dwSellerStockId  = $item['seller_address_id'];
            $shippParam -> cSellerStockId_u = 1;
            $shippParam -> dwFlag = $item['flag'];
            $shippParam -> dwPrice = $item['price'];
            $shippParam -> dwWeight = $item['weight'];
            $shippParam -> dwBuyCount = $item['buy_count'];
            $shippParam -> cBuyCount_u = 1;
            $shippParam -> dwCashBack = $item['cash_back'];
            $shippParam -> dwC3Ids = $item['c3_ids'];
            $shippParam -> vecGiftList = $vecGiftInfo; //赠品的信息
            $shippParam -> dwType = $item['type'];
            $shippParam -> cType_u = 1;

            $productUnitPo = new ProductUnitPo();
            $productUnitPo -> ddwProductSysno = $productid;
            $productUnitPo -> cProductSysno_u = 1;
            $productUnitPo -> dwProductNum = $item['buy_count'];
            $productUnitPo -> cProductNum_u = 1;
            $productUnitPo -> dwProductWeight = $item['weight'];
            $productUnitPo -> cProductWeight_u = 1;
            $shippParam -> oSizeInfo = $productUnitPo;
            $shippParam -> cSizeInfo_u = 1;

            $productList[$productid] = $shippParam;
        }


        $mapProduct = new stl_map();
        $mapProduct->setType(uint32_t,ShippingParam);
        $mapProduct->setValue($productList);
        return $mapProduct;
    }

    public static function getShippingforOrder($whId,$destinationId,$dc,$items,$inventorys,$couponPrice=0,$uid =0,$userLevel=0,$sceneId = 0){
        if (0 == $uid) {
            $uid = rand(0,1000);
        }
        $req = new getShippingInfo4OrderReq;
        $resp = new getShippingInfo4OrderResp;
       // Map < uint32_t, ShippingParam > productList;


        $mapProduct = self::_getShippingParam($items,$inventorys);
        $mapExt = new stl_map();
        $mapExt->setType(string,string);
        $mapExt -> setValue( array() );

        $req -> whId = $whId;
        $req -> destination = $destinationId;
        $req -> dc = $dc ;
        $req -> userLevel =  $userLevel;
        $req -> productList = $mapProduct;
        $req -> couponPrice = $couponPrice;
        $req -> extIn = $mapExt;
        $req -> sceneId = $sceneId;
        $req -> source = __FILE__;
        $req -> machineKey = __FILE__;
        $req -> ReserveIn = '';
      // print_r($req);
       // Logger::info("getshippinginfo  req ===". print_r($req,true));
        $cntl = MWebCntl::initCntl($uid);

        $ret = $cntl->invoke($req, $resp, WEB_STUB_TIME_OUT);
       // print_r("getshippingOrder\n");
        $json_resp = json_encode($resp);
        return array(
            'ret' => $ret,
            'resp' => json_decode($json_resp,true),
        );
    }
}


