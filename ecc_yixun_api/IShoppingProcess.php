<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sheldonshi
 * Date: 13-4-24
 * Time: 下午4:02
 * To change this template use File | Settings | File Templates.
 * Ps: 文件中接口仅供易迅网站侧购物流程调用，其他调用须提前告知，否则接口调整修改不做周知
 */
if(!defined("PHPLIB_ROOT")) {
    define('PHPLIB_ROOT', '/data/release/PHPLIB/');
}
require_once(PHPLIB_ROOT . 'inc/special.constant.inc.php');
require_once(PHPLIB_ROOT . 'inc/district.inc.php');
require_once(PHPLIB_ROOT . 'inc/ship.inc.php');
require_once(PHPLIB_ROOT . 'lib/Config.php');
require_once(PHPLIB_ROOT . 'api/appplatform/shoppingprocess/shoppingprocess.class.php');
require_once(PHPLIB_ROOT . 'api/appplatform/shoppingprocess/shoppingprocess.monitor.inc.php');

//套餐
//itil id 作用改变，统计商品在TTC中存在，商品系统不存在的数量
define('PID_SKUVIEW_NOTEXIST_TTC_EXIST_QUIRE',629507);

//宏定义
define("PRODUCT_TYING_EASY_MATCH", 1);
//请求来源
if (!defined('SCENE_SHOPPING_CART')) {
    define("SCENE_SHOPPING_CART", "cart");
}
if (!defined('SCENE_SHOPPING_PROCESS')) {
    define("SCENE_SHOPPING_PROCESS", "process");
}
if (!defined('SCENE_SHOPPING_ORDER')) {
    define("SCENE_SHOPPING_ORDER", "order");
}

class IShoppingProcess
{
    public static $errCode = 0;
    public static $errMsg = '';
    public static $logMsg = '';

    CONST ICSON_BOOKING_TYPE_DELAY_DAYS = 10; //正常延迟几天

    /**
     * 获取用户购物车商品信息列表
     * @param $uid              用户uid
     * @param $whId             分站ID
     * @param $offLineParams    离线购物车信息
     * @return array   items    商品id
     *                 packageids  套餐规则id
     *                 packagebuycount   套餐规则id的购买buy_count
     */
    private static function _getItemsList($uid, $whId, $offLineParams, $scene = SCENE_SHOPPING_CART)
    {
        global $shoppingProcessItil;
        $items = array();
        if($offLineParams['type'] != IShoppingCartV2::ONLINE_CART)
        {   //离线购物车，包括节能补贴，无线一键购买
            if(empty($offLineParams['items']) || !is_array($offLineParams['items'])) {
                self::$errCode = -1;
                self::$errMsg = "您的购物车商品列表为空";
                self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:离线购物车商品列表为空";
                return false;
            }
            foreach($offLineParams['items'] as $item) {
                if(empty($item['product_id'])) {
                    self::$errCode = -1;
                    self::$errMsg = "您的购物车商品列表为空";
                    self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:离线购物车格式错误";
                    return false;
                }
                if($item['product_id'] < 0) {
                    continue;
                }

                $items[] = array(
                    'product_id'      => $item['product_id'],
                    'buy_count'       => !empty($item['buy_count']) ? $item['buy_count'] : 1,
                    'main_product_id' => !empty($item['main_product_id']) ? $item['main_product_id'] : 0,
                    'price_id'        => !empty($item['price_id']) ? $item['price_id'] : 0,
                    'OTag'            => !empty($item['OTag']) ? $item['OTag'] : "",
                    'type'            => !empty($item['type']) ? $item['type'] : IShoppingCart::ITEM_NORMAL,
                    'package_id'      => IShoppingCartV2::NOT_BELONG_PACKAGE,
                    'chid'            => !empty($item['chid']) ? $item['chid'] : "",
                    'item_total_cut'  => 0,
                );
            }
        }
        else
        {   // 在线购物车需要检查用户ID
            if(!isset($uid) || $uid <= 0)
            {
                self::$errCode = 101;
                self::$errMsg = "用户ID非法";
                self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:uid($uid) is invalid";
                return false;
            }
            ItilReport::itil_report($shoppingProcessItil[$scene]['shoppingcart']['req']);
            $ret = IShoppingCartV2::get($uid);
            if(false === $ret)
            {
                ItilReport::itil_report($shoppingProcessItil[$scene]['shoppingcart']['failed']);
                self::$errCode = IShoppingCartV2::$errCode;
                self::$errMsg = "查找购物车失败";
                self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg: 查找({$uid})购物车失败" . IShoppingCartV2::$errMsg;
                return false;
            }
            ItilReport::itil_report($shoppingProcessItil[$scene]['shoppingcart']['succ']);

            foreach($ret as $it) {
                if($it['product_id'] < 0) {
                    continue;
                }
                $items[] = $it;
            }
        }

        $pkgBuycount = array();
        $package_ids = array();

        reset($items);
        foreach($items as $key => $it) {
            if($it['type'] == IShoppingCartV2::ITEM_PACKAGE) { //套餐
                $pkgBuycount[$it['product_id']] = $it['buy_count'];
                $package_ids[] = $it['product_id'];
                unset($items[$key]);
            } else if($it['type'] == IShoppingCartV2::ITEM_NORMAL) { //商品
                //普通商品 package_id 设置为 NOT_BELONG_PACKAGE，表示不属于任何套餐
                $items[$key]['package_id'] = IShoppingCartV2::NOT_BELONG_PACKAGE;
                $items[$key]['unique_id'] = "{$it['product_id']}";
                $items[$key]['item_total_cut'] = 0;
            }
        }
        $result = array(
            'normalItems' => $items,
            'packageIds' => $package_ids,
            'pkgBuycount'=> $pkgBuycount
        );
        // 将信息进行返回
        return $result;
    }

   /*
    * 获取赠品的商品信息
    * @param $giftids  赠品的商品id
    * @param $whId
    * @param int $district 三级地区id
    * @return array
    * */

    private static function _getGiftProductInfo($giftIds , $whId ,  $district = 0,  $uid = 0 ,$needCostPrice = false, $scene = SCENE_SHOPPING_CART)
    {
        //获取商品信息
        $giftsInfo = self::_getProductsInfo($giftIds, $whId, $district, $uid, $scene);
        if(false === $giftsInfo)
        {
            self::$errCode = 101;
            self::$errMsg = "商品信息获取失败";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg: 商品信息获取失败";
            return false;
        }
        //获取库存信息
        $inventoryInfo = self::_getInventoryInfo($giftIds, $whId, $giftsInfo, $district, $uid, $scene);
        if(false === $inventoryInfo) //将商品的库存信息进行设置
        {
            //遍历商品信息将库存进行设置
            foreach($giftsInfo as $key => $wi) {
                $giftsInfo[$key]['virtual_num'] = 0;
                $giftsInfo[$key]['num_available'] = 0;
                $giftsInfo[$key]['psystock'] = $whId;
                $giftsInfo[$key]['status'] = PRODUCT_STATUS_VALID;
            }
        }
        else
        {
            $giftsInfo = $inventoryInfo['productsInfo'];
        }

        //数据整理三级类目id进行转换
        $forbidList = array();
        $now = time();
        global $_StockTips, $_RestrictedTransType;
        foreach($giftsInfo as $key => $value) {
            $giftsInfo[$key]['is_install'] = in_array($value['c3_ids'], array(736, 739)) ? true : false;
            $giftsInfo[$key]['show_price'] = $value['price'] + $value['cash_back'];

            if($value['virtual_num'] + $value['num_available'] > 0)
            {
                if($value['num_available'] > 0)
                {
                    $giftsInfo[$key]['stock'] = $_StockTips['available'];
                }
                else if($value['arrival_days'] == VIRTUAL_STOCK_ARRAY_1_3DAYS)
                {
                    $giftsInfo[$key]['stock'] = $_StockTips['arrival1-3'];
                }
                else if($value['arrival_days'] == VIRTUAL_STOCK_ARRAY_2_7DAYS)
                {
                    $giftsInfo[$key]['stock'] = $_StockTips['arrival2-7'];
                }
                else
                {
                    $giftsInfo[$key]['stock'] = $_StockTips['not_available'];
                }
            }
            else
            {
                $giftsInfo[$key]['stock'] = $_StockTips['not_available'];
            }

            if($now < $value['promotion_start'] || $now > $value['promotion_end'])
            {
                $giftsInfo[$key]['promotion_word'] = "";
            }
            $giftsInfo[$key]['restricted_trans_desc'] = isset($_RestrictedTransType[$value['restricted_trans_type']]) ? $_RestrictedTransType[$value['restricted_trans_type']] : '';
            $giftsInfo[$key]['restricted_trans_type'] = $value['restricted_trans_type'];
            $giftsInfo[$key]['lowest_num'] = !empty($value['lowest_num']) ? $value['lowest_num'] : 1;

            if($needCostPrice === false) {
                unset($giftsInfo[$key]['cost_price']);
                unset($giftsInfo[$key]['virtual_num']);
                unset($giftsInfo[$key]['num_available']);
            }
        }

        return $giftsInfo;
    }


    /**
     * 获取商品赠品信息
     * @param $productIds   商品ID
     * @param $whId         分站ID
     * @param int $district 三级地区ID
     * @return array
     */
    private static function _getItemsGiftInfo($items, $products, $whId, $district = 0, $uid=0, $scene = SCENE_SHOPPING_CART)
    {

        $productsIds = self::_getItemsProductIds($products);
        if(empty($productsIds))
        {
            return array(
                'items' => array(),
                'products' => array(),
            );
        }
        //global $shoppingProcessItil;
        //ItilReport::itil_report($shoppingProcessItil[$scene]['tyingGift']['req']);
        $ret = AttachmentOperator::GetGift($whId, $district, $productsIds, $uid, $scene);
        if($ret['code'] == -1 )
        {
            //ItilReport::itil_report($shoppingProcessItil[$scene]['tyingGift']['failed']);
            self::$errCode = $ret['code'];
            self::$errMsg = $ret['msg'];
            self::$logMsg = "AttachmentOperator GetGift invoke Failed![errCode:{$ret['code']}][errmsg{$ret['msg']}]";
            return false;
        }
        else if($ret['code'] != 0)
        {
            //ItilReport::itil_report($shoppingProcessItil[$scene]['tyingGift']['failed']);
            self::$errCode = $ret['code'];
            self::$errMsg = $ret['msg'];
            self::$logMsg = "AttachmentOperator GetGift invoke Error![errCode:{$ret['code']}][errmsg{$ret['msg']}]";
            return false;
        }
        //ItilReport::itil_report($shoppingProcessItil[$scene]['tyingGift']['succ']);

        $giftsInfo = $ret['data']['mapMainIdGift'];
        $giftIds = array();
        foreach($items as $key => $item)
        {
            if(isset($giftsInfo[$item['product_id']]))
            {
                $giftData = $giftsInfo[$item['product_id']];
                foreach($giftData as $gift)
                {
                    if(GIFT_STATUS_OK != $gift['status'] && COMPONENT_TYPE != $gift['type'])
                    {
                        continue;
                    }
                    $giftids[] = $gift['giftId'];
                    $items[$key]['gift'][$gift['giftId']]['product_id'] = $gift['giftId'];
                    $items[$key]['gift'][$gift['giftId']]['name'] = $gift['name'];
                    $items[$key]['gift'][$gift['giftId']]['num'] = $gift['num'];
                    $items[$key]['gift'][$gift['giftId']]['product_char_id'] = $gift['productCharId'];
                    $items[$key]['gift'][$gift['giftId']]['type'] = $gift['type'];
                    $items[$key]['gift'][$gift['giftId']]['stock_num'] = $gift['stockNum'];
                    $items[$key]['gift'][$gift['giftId']]['weight'] = $gift['weight'];
                }
                if(!isset($items[$key]['gift']))
                {
                    $items[$key]['gift'] = array();
                }
            } else {
                $items[$key]['gift'] = array();
            }
        }

        /*
         * 将赠品信息放到商品信息当中来 这里返回为GiftInfo字段进行数据组装
         * */


        foreach($products as $key => $product)
        {
            if(isset($giftsInfo[$product['product_id']]))
            {
                $giftData = $giftsInfo[$product['product_id']];
                foreach($giftData as $gift)
                {
                    $products[$key]['gifts'][$gift['giftId']]['product_id'] = $gift['giftId'];
                    $products[$key]['gifts'][$gift['giftId']]['name'] = $gift['name'];
                    $products[$key]['gifts'][$gift['giftId']]['num'] = $gift['num'];
                    $products[$key]['gifts'][$gift['giftId']]['product_char_id'] = $gift['productCharId'];
                    $products[$key]['gifts'][$gift['giftId']]['type'] = $gift['type'];
                    $products[$key]['gifts'][$gift['giftId']]['stock_num'] = $gift['stockNum'];
                    $products[$key]['gifts'][$gift['giftId']]['weight'] = $gift['weight'];
                }
            } else {
                $products[$key]['gifts'] = array();
            }
        }


        return array(
            'items' => $items,
            'products' => $products,
            'giftIds' => $giftids,
        );
    }

    /**
     * 获取单品赠券信息
     * @param $productIds   商品ID
     * @param $whId         分站ID
     * @param int $district 三级地区ID
     * @return array
     */
    private static function _getItemsSingleCouponInfo($items, $whId, $district = 0, $uid = 0, $scene = SCENE_SHOPPING_CART)
    {
        $productsIds = self::_getItemsProductIds($items);
        if(empty($productsIds))
        {
            return array(
                'coupons' => array(),
            );
        }
        //global $shoppingProcessItil;
        //ItilReport::itil_report($shoppingProcessItil[$scene]['singleCoupon']['req']);
        $ret = AttachmentOperator::GetSingleProCoupon($whId, $district, $productsIds, $uid, $scene);
        if($ret['code'] == -1)
        {
            //ItilReport::itil_report($shoppingProcessItil[$scene]['singleCoupon']['failed']);
            self::$errCode = $ret['code'];
            self::$errMsg = $ret['msg'];
            self::$logMsg = "AttachmentOperator GetSingleProCoupon invoke Failed![errCode:{$ret['code']}][errmsg{$ret['msg']}]";
            return false;
        }
        else if($ret['code'] != 0)
        {
            //ItilReport::itil_report($shoppingProcessItil[$scene]['singleCoupon']['failed']);
            self::$errCode = $ret['code'];
            self::$errMsg = $ret['msg'];
            self::$logMsg = "AttachmentOperator GetSingleProCoupon invoke Error![errCode:{$ret['code']}][errmsg{$ret['msg']}]";
            return false;
        }
        //ItilReport::itil_report($shoppingProcessItil[$scene]['singleCoupon']['succ']);
        $coupons = $ret['data'];
        $couponsData = $coupons['promotion'];
        $couponsInfo = array();
        foreach($couponsData as $key => $coupon) {
                if(isset($coupon['vecMainIdCoupon']) && !empty($coupon['vecMainIdCoupon']))
                {
                    $couponInfo = $coupon['vecMainIdCoupon'][0];
                    $cInfo = array();
                    $cInfo['id'] = $couponInfo['ruleId'];
                    $cInfo['name'] = $couponInfo['promotionName'];
                    $cInfo['wh_id'] = $couponInfo['whId'];
                    $cInfo['join_limit'] = $couponInfo['joinLimit'];
                    $cInfo['pid_list'] = $couponInfo['vecPidList'];
                    $cInfo['accounting_type'] = $couponInfo['accountType'];
                    $cInfo['status'] = 1;
                    $cInfo['url'] = $couponInfo['url'];
                    $cInfo['time_begin'] = $couponInfo['beginTime'];
                    $cInfo['time_end'] = $couponInfo['endTime'];
                    $cInfo['comment'] = $couponInfo['comment'];
                    $cInfo['coupon_list'][0]['batch'] = $couponInfo['vecCouponInfo'][0]['batch'];
                    $cInfo['coupon_list'][0]['coupon_name'] = $couponInfo['vecCouponInfo'][0]['name'];
                    $cInfo['coupon_list'][0]['coupon_amt'] = $couponInfo['vecCouponInfo'][0]['amt'];
                    $couponsInfo[$key] = $cInfo;
                 }
        }

        return  array(
            'coupons' => $couponsInfo,
        );
    }

    /**
     * 获取套餐信息
     * @param $packageIds
     * @param $pkgBuycount
     * @param $whId
     * @param int $district
     * @param int $uid
     * @return array|bool
     */
    private static function _getItemsPackageInfo($packageIds, $pkgBuycount, $whId, $district=0, $uid = 0, $scene = SCENE_SHOPPING_CART)
{
       // 如果为空，则直接返回 items
        if(empty($packageIds)) {
           return array(
               'pkgsItems' => array(),
               'suiteInfo' => array(),
           );
        }
        //获取套餐信息
        //global $shoppingProcessItil;
        //ItilReport::itil_report($shoppingProcessItil[$scene]['tyinPackage']['req']);
        $ret = AttachmentOperator::GetPackageByRules($whId, $district, $packageIds, $uid, $scene);
        if($ret['code'] == -1)
        {
           //服务错误
           //ItilReport::itil_report($shoppingProcessItil[$scene]['tyinPackage']['failed']);
           self::$errCode = $ret['code'];
           self::$errMsg = $ret['msg'];
           self::$logMsg = "AttachmentOperator GetPackageByRules invoke Failed![errCode:{$ret['code']}][errmsg{$ret['msg']}]";
           return false;
        }
        else if($ret['code'] != 0)
        {
           //业务错误
           //ItilReport::itil_report($shoppingProcessItil[$scene]['tyinPackage']['failed']);
           self::$errCode = $ret['code'];
           self::$errMsg = $ret['msg'];
            self::$logMsg = "AttachmentOperator GetPackageByRules Error![errCode:{$ret['code']}][errmsg{$ret['msg']}]";
           return false;
        }
        //ItilReport::itil_report($shoppingProcessItil[$scene]['tyinPackage']['succ']);

        $maprulPackage =  $ret['data']['mapMRuleIdPackage'];
        $pkgsData = array();
        foreach ($maprulPackage as $key => $value)
        {
            $product = array();
            foreach ($value['vecPackageInfo'] as $pacInfoVale) {
                $product[] = array(
                    'productId'       => $pacInfoVale['productId'],
                    'name'            =>  $pacInfoVale['name'],
                    'productCharId'   =>  $pacInfoVale['productCharId'],
                    'price'           =>  $pacInfoVale['price'],
                    'packageCashBack' =>  $pacInfoVale['packageCashBack'],
                );
            }
            $pkgsData[$key] = array(
                'version'        => $value['version'],
                'promotionName'  => $value['promotionName'],
                'ruleId'         => $value['ruleId'],
                'vecPackageInfo' => $product
            );
        }
        $pkgsItems = array();
        foreach($pkgsData as $key =>$value) {
           $pkgInfo[$key]['name'] = $value['promotionName'];
           $pkgInfo[$key]['pid'] = $value['ruleId'];
           $pkgInfo[$key]['product_list'] = array();
           $total_product_saving_amount = 0;
           foreach($value['vecPackageInfo'] as $product) {
               $pkgInfo[$key]['product_list'][ $product['productId']]['product_id'] = $product['productId'];
               $pkgInfo[$key]['product_list'][ $product['productId']]['product_name'] = $product['name'];
               $pkgInfo[$key]['product_list'][ $product['productId']]['product_char_id'] =  $product['productCharId'];
               $pkgInfo[$key]['product_list'][ $product['productId']]['product_amount'] =  $product['price'];
               $pkgInfo[$key]['product_list'][ $product['productId']]['product_saving_amount'] = intval($product['packageCashBack']) * $pkgBuycount[$key];
               $total_product_saving_amount +=  intval($product['packageCashBack']) * $pkgBuycount[$key];


               $pkgsItems[] = array(
                   'product_id'      => $product['productId'],
                   'buy_count'       =>  $pkgBuycount[$key],
                   'main_product_id' => $product['productId'],
                   'price_id'        => 0,
                   'OTag'            => "",
                   'type'            => IShoppingCartV2::ITEM_NORMAL,
                   'package_id'      => $key,
                   'unique_id'       => $product['productId'] . "_" . $key,
                   'pkg_cash_back'   => intval($product['packageCashBack']),
                   'item_total_cut'  => intval($product['packageCashBack']) * $pkgBuycount[$key], //每个商品的总的返现金额
               );
           }
           $pkgInfo[$key]['product_saving_amount'] =  $total_product_saving_amount;
           $pkgInfo[$key]['buy_count']= $pkgBuycount[$key];
        }

        $result = array(
           'pkgsItems'     => $pkgsItems,   //套餐商品信息
           'suiteInfo' => $pkgInfo,    // 套餐信息
        );
        return $result;
   }

	/**
     * 获取商品信息---双读
     * @param $items        商品
     * @param $whId         分站ID
     * @param int $district 三级地区ID
     * @return array
     */
    private static function _getProductsInfo($productsIds, $whId, $district = 0, $uid = 0, $scene = SCENE_SHOPPING_CART)
	{
		if(empty($productsIds))
        {
            Logger::err('_getProductsInfo productsIds empty!');
            return  false;
        }
		
        //global $shoppingProcessItil;
        //ItilReport::itil_report($shoppingProcessItil[$scene]['product']['req']);
		//接入商品系统开关start，这里算特殊处理，全部接商品系统后会去掉
		global $_USE_SKUVIEW_PRODUCTINFO_SWITCH;
		if(!$_USE_SKUVIEW_PRODUCTINFO_SWITCH)
		{
			Logger::info("_USE_SKUVIEW_PRODUCTINFO_SWITCH close,using ttc product data");
			$productInfo_ttc = IShoppingProcess::_getProductsInfoFromTTC($productsIds, $whId, $district, $uid, $scene);
			if(false === $productInfo_ttc)
			{
				 Logger::err("_getProductsInfoFromTTC error.");
				 //ItilReport::itil_report($shoppingProcessItil[$scene]['product']['failed']);
				 return false;
			}
			Logger::info("IShoppingProcess::_getProductsInfoFromTTC productInfo_ttc:" . ToolUtil::gbJsonEncode($productInfo_ttc));
			//ItilReport::itil_report($shoppingProcessItil[$scene]['product']['succ']);
			return $productInfo_ttc;
		}
		else
		{
			Logger::info("_USE_SKUVIEW_PRODUCTINFO_SWITCH open,using ao product data");
		}
		//接入商品系统开关end
		
		$productInfo_ao = IShoppingProcess::_getSkuListInfo4ShopCart($productsIds, $whId, $district, $uid, $scene);
		if(false === $productInfo_ao)
		{
			 Logger::err("_getSkuListInfo4ShopCart error.");
			 
			 $productInfo_ao = array();
			 /*ItilReport::itil_report($shoppingProcessItil[$scene]['product']['failed']);
			 return false;*/
		}
		Logger::info("IShoppingProcess::_getSkuListInfo4ShopCart productInfo_ao:" . ToolUtil::gbJsonEncode($productInfo_ao));
		
		$productInfo_ttc = IShoppingProcess::_getProductsInfoFromTTC($productsIds, $whId, $district, $uid, $scene);
		if(false === $productInfo_ttc)
		{
			 Logger::err("_getProductsInfoFromTTC error.");
			 $productInfo_ttc = array();
			 /*ItilReport::itil_report($shoppingProcessItil[$scene]['product']['failed']);
			 return false;*/
		}
		Logger::info("IShoppingProcess::_getProductsInfoFromTTC productInfo_ttc:" . ToolUtil::gbJsonEncode($productInfo_ttc));	
		
		foreach($productInfo_ao as $pid => $product)
		{
			if(isset($productInfo_ttc[$pid]) && !empty($productInfo_ttc[$pid]))
			{
				foreach($productInfo_ttc[$pid] as $k => $v)
				{
					if(!isset($productInfo_ao[$pid][$k]))
					{
						$productInfo_ao[$pid][$k] = $productInfo_ttc[$pid][$k];
					}
				}
			}
			else
			{
				$initProductInfo = array();
				$initProductInfo['product_id'] = 0;
				$initProductInfo['c3_ids'] = 0;
				$initProductInfo['product_char_id'] = 0;
				$initProductInfo['mode'] = 0;
				$initProductInfo['name'] = "";
				$initProductInfo['weight'] = 0;
				$initProductInfo['pic_num'] = 0;
				$initProductInfo['barcode'] = 0;
				$initProductInfo['color'] = 0;
				$initProductInfo['size'] = 0;
				$initProductInfo['manufacturer'] = 0;
				$initProductInfo['warranty'] = "";
				$initProductInfo['masterid'] = 0;
				$initProductInfo['wh_id'] = 1;
				$initProductInfo['flag'] = 0;
				$initProductInfo['type'] = 0;
				$initProductInfo['type2'] = 0;
				$initProductInfo['status'] = 0;
				$initProductInfo['restricted_trans_type'] = 0;
				$initProductInfo['onshelf_time'] = 0;
				$initProductInfo['promotion_word'] = 0;
				$initProductInfo['promotion_start'] = 0;
				$initProductInfo['promotion_end'] = 0;
				$initProductInfo['num_available'] = 0;
				$initProductInfo['virtual_num'] = 0;
				$initProductInfo['arrival_days'] = 0;
				$initProductInfo['market_price'] = 0;
				$initProductInfo['price'] = 0;
				$initProductInfo['cash_back'] = 0;
				$initProductInfo['cost_price'] = 0;
				$initProductInfo['num_limit'] = 0;
				$initProductInfo['is_clear_wh'] = 0;
				$initProductInfo['point_type'] = 0;
				$initProductInfo['point'] = 0;
				$initProductInfo['vip_price'] = 0;
				$initProductInfo['psystock'] = 0;
				$initProductInfo['multiprice_type'] = 0;
				$initProductInfo['product_sale_type'] = 0;
				$initProductInfo['business_unit_cost_price'] = 0;
				$initProductInfo['sale_model'] = 0;
				$initProductInfo['lowest_num'] = 0;
				$initProductInfo['booking_type'] = 0;
				$initProductInfo['booking_value'] = 0;
				$initProductInfo['master_id'] = 0;
				$initProductInfo['seller_id'] = 0;
				$initProductInfo['seller_address_id'] = 0;
				
				foreach($initProductInfo as $k => $v)
				{
					if(!isset($productInfo_ao[$pid][$k]))
					{
						$productInfo_ao[$pid][$k] = $initProductInfo[$k];
					}
				}
				
				$productInfo_ao[$pid]['status'] = -1;
				
				//ao中有返回，TTC中没有,做特殊处理，仍然返回商品信息，固定设置商品状态为无效
				//返回商品信息，不可销售
			}
		}
		//以下针对商品系统不存在，TTC存在是商品做容错处理start
		global $_SKUVIEW_NOTEXIST_USE_TTCDATA_SWITCH;
		if($_SKUVIEW_NOTEXIST_USE_TTCDATA_SWITCH)
		{
			Logger::info("_SKUVIEW_NOTEXIST_USE_TTCDATA_SWITCH open");
			foreach($productInfo_ttc as $pid => $product)
			{
				if(!isset($productInfo_ao[$pid]) || empty($productInfo_ao[$pid]))
				{
					$productInfo_ao[$pid] = $productInfo_ttc[$pid];
					ItilReport::itil_report(PID_SKUVIEW_NOTEXIST_TTC_EXIST_QUIRE);
					Logger::info("SKUVIEW NOT EXIST ,USE TTC DATA, [pid:{$pid}][whid:{$whId}][district:{$district}]		$pid");
				}
			}
		}
		else
		{
			Logger::info("_SKUVIEW_NOTEXIST_USE_TTCDATA_SWITCH close");
		}
		//容错end
		
		if(empty($productInfo_ao))
		{
			 Logger::err("_getProductsInfo empty.");
			 //ItilReport::itil_report($shoppingProcessItil[$scene]['product']['failed']);
			 return false;
		}
		
		Logger::info("IShoppingProcess::_getProductsInfo result:" . ToolUtil::gbJsonEncode($productInfo_ao));
		//ItilReport::itil_report($shoppingProcessItil[$scene]['product']['succ']);
		return $productInfo_ao;
	}
	
	/**
	* 获取商品信息--从商品系统AO
	* @param $items        商品
	* @param $whId         分站ID
	* @param int $district 三级地区ID--icson
	* @return array
	*/
    private static function _getSkuListInfo4ShopCart($productsIds, $whId, $district = 0, $uid = 0, $scene = SCENE_SHOPPING_CART)
    {
		//参数校验
		//三级地址国标转换
		//转换失败，根据分站id获取容错的国标地址id
		//调ao接口
		//字段映射
	
        if(empty($productsIds))
        {
            Logger::err('_getSkuListInfo4ShopCart productsIds empty!');
            return  false;
        }

		//以下调用转国标地域接口转换三级地址,$areaId为国标
		//暂时不需要精确的国标地址，分站默认一个
		global $_WhidToArea_GB;
		$areaId = 0;
		if(isset($_WhidToArea_GB) && isset($_WhidToArea_GB[$whId]))
		{
			$areaId = $_WhidToArea_GB[$whId];
		}

		Logger::info("SkuViewOperator::GetSkuListInfo4ShopCart req param:[whid:{$whId}][areaId:{$areaId}][uid:{$uid}]productsIds:" . ToolUtil::gbJsonEncode($productsIds));
		
		$skuListInfo = SkuViewOperator::GetSkuListInfo4ShopCart($productsIds, $whId, $areaId, $uid, $scene);
        if($skuListInfo['code'] == -1 )
		{
			Logger::err("SkuViewOperator::GetSkuListInfo4ShopCart invoke Failed![errcode:{$skuListInfo['code']}][whid:{$whId}][areaId:{$areaId}][uid:{$uid}]productsIds:" . ToolUtil::gbJsonEncode($productsIds));
			self::$errCode = $skuListInfo['code'];
			self::$errMsg =	$skuListInfo['msg'];
			return false;
		}
        else if($skuListInfo['code'] != 0)
        {
            Logger::err("SkuViewOperator::GetSkuListInfo4ShopCart Error![errcode:{$skuListInfo['code']}][whid:{$whId}][areaId:{$areaId}][uid:{$uid}]productsIds:" . ToolUtil::gbJsonEncode($productsIds));
            self::$errCode = $skuListInfo['code'];
            self::$errMsg =	$skuListInfo['msg'];
            return false;
        }

		if(!isset($skuListInfo['data']['viewSpu']) || empty($skuListInfo['data']['viewSpu']))
		{
			//商品信息为空
			Logger::err("SkuViewOperator::GetSkuListInfo4ShopCart viewSpu empty![whid:{$whId}][areaId:{$areaId}][uid:{$uid}]productsIds:" . ToolUtil::gbJsonEncode($productsIds));
			//待确认错误码
			self::$errCode = -1;
			self::$errMsg =	"viewSpu empty";
			return false;
		}
		
		foreach($skuListInfo['data']['viewSpu'] as $strPid => $spuPo)
		{
			$pid = substr($strPid, 6);//"icson-41199"
			
			$skupo =array();
			$stockpo =array();
			
			foreach($spuPo['viewSkuPo'] as $sizecolor => $skulist)
			{
				foreach($skulist as $k => $sku)
				{
					if($sku['cooperatorSkuCode'] == $pid)
					{
						$skupo = $sku;
						break;
					}
				}
			}
			if(empty($skupo))
			{
				//未查到sku信息
				//log
				Logger::err("skuListInfo Failed,skupo empty![whid:{$whId}][areaId:{$areaId}][uid:{$uid}][pid:{$pid}]");
				//skupo不存在，跳过该商品
				continue;
			}
			
			$productInfo[$pid]['product_id'] = $pid;
			$productInfo[$pid]['c3_ids'] = $skupo['icsonInfoPo']['c3SysNo'];
			$productInfo[$pid]['product_char_id'] = $skupo['icsonInfoPo']['productId'];
			$productInfo[$pid]['name'] = iconv('utf-8', 'gbk', $skupo['skuTitle']);
			$productInfo[$pid]['weight'] = $skupo['skuNetWeight'];//商品系统dwSkuWeight为毛重，目前数据不全;dwSkuNetWeight为净重，原TTC为净重,这里使用净重
			$productInfo[$pid]['pic_num'] = $skupo['icsonInfoPo']['showPicCount'];
			$productInfo[$pid]['color'] = $skupo['icsonInfoPo']['productColor'];
			$productInfo[$pid]['size'] = $skupo['icsonInfoPo']['productSize'];
			$productInfo[$pid]['manufacturer'] = $skupo['icsonInfoPo']['manufacturerSysNo'];
			$productInfo[$pid]['seller_id'] = $skupo['viewCooperatorBasePo']['icsonCooperatorId'] != 0 ? $skupo['viewCooperatorBasePo']['icsonCooperatorId'] : $skupo['icsonInfoPo']['skuOwner'];
			$productInfo[$pid]['type'] = $skupo['skuType'];
			$productInfo[$pid]['market_price'] = $skupo['skuReferPrice'];
			$productInfo[$pid]['sale_model'] = $skupo['skuOperationModel'];
		
			$productInfo[$pid]['wh_id'] = $whId;
					
			foreach($skupo['viewStockPo'] as $k => $stock)
			{
				if($stock['storeHouseCode'] == $whId)
				{
					$stockpo = $stock;
					break;
				}
			}
			
			if(empty($stockpo))
			{
				//未查到stockpo信息,stockpo上的使用默认值，状态置无效，sku上的基本信息返回
				//log
				Logger::info("skuListInfo Failed,stockpo empty![whid:{$whId}][areaId:{$areaId}][uid:{$uid}][pid:{$pid}]");
				$productInfo[$pid]['status'] = 0;
				$productInfo[$pid]['restricted_trans_type'] = 0;
				$productInfo[$pid]['cost_price'] = 0;
				$productInfo[$pid]['num_limit'] = 0;
				$productInfo[$pid]['lowest_num'] = 0;
			}
			else
			{
				/*
				目前TTC中数据共有三个状态：
				无效状态：-1
				有效但网站不展示：0
				正常出售状态：1
				商品系统共有如下三个状态：
				在售：0
				售完：1
				下架：2
				其中在售及售完均表示正常状态，只是有货没货的差别
				下架表示商品状态无效
				故可做如下映射：
				商品系统0或1，映射为原TTC 1
				商品系统2，映射为原TTC 0
				*/
				//大于2表示无效，skustate和stockstate有一个无效就无效
				$productInfo[$pid]['status'] = $skupo['skuState'] >= 2 || $stockpo['stockState'] >= 2 ? 0 : 1;
				$productInfo[$pid]['restricted_trans_type'] = $stockpo['stockLimitCode'];
				$productInfo[$pid]['cost_price'] = $stockpo['stockCostPrice'];
				$productInfo[$pid]['num_limit'] = $stockpo['stockMaxBuyCount'] < 0 ? 999 : $stockpo['stockMaxBuyCount'];
				$productInfo[$pid]['lowest_num'] = $stockpo['stockMinBuyCount'];
			}
			
			//$productInfo[$pid]['warranty'] = $skupo['oIcsonInfoPo']['strProductMode'];//该字段不在该接口提供
			//$productInfo[$pid]['flag'] = $product['flag'];//部分flag没有
			//--$productInfo[$pid]['type2'] = $product['type2'];//购物流程需要，商品系统不提供
			//$productInfo[$pid]['price'] = $stockpo['dwStockPrice'];//不走商品系统，走多价
			//$productInfo[$pid]['point_type'] = $product['pointType'];//不提供
			//$productInfo[$pid]['booking_type'] = $product['bookingType'];
			//$productInfo[$pid]['booking_value'] = $product['bookingValue'];
			//$productInfo[$pid]['seller_address_id'] = $product['selleraddressid'];
		}
		return $productInfo;
    }
    /**
     * 获取商品信息---原TTC
     * @param $items        商品
     * @param $whId         分站ID
     * @param int $district 三级地区ID
     * @return array
     */
    private static function _getProductsInfoFromTTC($productsIds, $whId, $district = 0, $uid = 0, $scene = SCENE_SHOPPING_CART)
    {
        if(empty($productsIds))
        {
            Logger::err('_getProductsInfoFromTTC productsIds empty!');
            return  false;
        }
        $ret = ProductInventoryOperator::GetProductInfo($whId, $productsIds, $uid, $scene);
         if($ret['code'] == -1) {
            self::$errCode = $ret['code'];
            self::$errMsg =$ret['msg'];
            Logger::err('_getProductsInfoFromTTC ProductInventoryOperator GetProductInfo invoke !ErrCode:'. $ret['code']);
            return false;
        }
        else if($ret['code'] != 0 && isset($ret['data']['productInfoList']) && !empty($ret['data']['productInfoList']))
        {
            self::$errCode = $ret['code'];
            self::$errMsg = $ret['msg'];
            Logger::err('_getProductsInfoFromTTC ProductInventoryOperator GetProductInfo error but not empty  !ErrCode:'. $ret['code']);
            //return false;
        }
        else if($ret['code'] != 0 && (!isset($ret['data']['productInfoList']) || empty($ret['data']['productInfoList'])))
        {
            self::$errCode = $ret['code'];
            self::$errMsg = $ret['msg'];
            Logger::err('_getProductsInfoFromTTC ProductInventoryOperator GetProductInfo return empty  !ErrCode:'.$ret['code']);
            return false;
        }

        /**
         * 商品信息获取失败需要做不同的处理
         * 如果返回的商品信息列表不为空，则可以继续走下去，把那个商品剔除掉
         */
        //if($productsData['result'] != 0)

        $productsData = $ret['data']['productInfoList'];
        $productInfo = array();
        foreach($productsData as $key => $product)
        {
            //对商品信息设置
            $productInfo[$key]['product_id'] = $key;
            $productInfo[$key]['c3_ids'] = $product['c3Ids'];
            $productInfo[$key]['product_char_id'] = $product['productCharId'];
            $productInfo[$key]['mode'] = $product['mode'];
            $productInfo[$key]['name'] = $product['name'];
            $productInfo[$key]['weight'] = $product['weight'];
            $productInfo[$key]['pic_num'] = $product['picNum'];
            $productInfo[$key]['barcode'] = $product['barcode'];
            $productInfo[$key]['color'] = $product['color'];
            $productInfo[$key]['size'] = $product['productSize'];
            $productInfo[$key]['manufacturer'] = $product['manufacturer'];
            $productInfo[$key]['warranty'] = $product['warranty'];
            $productInfo[$key]['masterid'] = $product['masterid'];
            $productInfo[$key]['wh_id'] = $product['whId'];
            $productInfo[$key]['flag'] = $product['flag'];
            $productInfo[$key]['type'] = $product['type'];
            $productInfo[$key]['type2'] = $product['type2'];
            $productInfo[$key]['status'] = $product['status'];
            $productInfo[$key]['restricted_trans_type'] = $product['restrictedTransType'];
            $productInfo[$key]['onshelf_time'] = $product['onShelfTime'];
            $productInfo[$key]['promotion_word'] = $product['promotionWord'];
            $productInfo[$key]['promotion_start'] = $product['promotionStart'];
            $productInfo[$key]['promotion_end'] = $product['promotionEnd'];
            $productInfo[$key]['num_available'] = $product['availableNum'];
            $productInfo[$key]['virtual_num'] = $product['virtualNum'];
            $productInfo[$key]['arrival_days'] = $product['arrivalDays'];
            $productInfo[$key]['market_price'] = $product['marketPrice'];
            $productInfo[$key]['price'] = $product['price'];
            $productInfo[$key]['cash_back'] = $product['cashBack'];
            $productInfo[$key]['cost_price'] = $product['costPrice'];
            $productInfo[$key]['num_limit'] = $product['numLimit'] < 0 ? 999 : $product['numLimit'];
            $productInfo[$key]['is_clear_wh'] = $product['isClearWh'];
            $productInfo[$key]['point_type'] = $product['pointType'];
            $productInfo[$key]['point'] = $product['point'];
            $productInfo[$key]['vip_price'] = $product['vipPrice'];
            $productInfo[$key]['psystock'] = $product['psyStock'];
            $productInfo[$key]['multiprice_type'] = $product['multiPriceType'];
            $productInfo[$key]['product_sale_type'] = $product['productSaleType'];
            $productInfo[$key]['business_unit_cost_price'] = $product['businessUnitCostPrice'];
            $productInfo[$key]['sale_model'] = $product['saleModel'];
            $productInfo[$key]['lowest_num'] = $product['lowestNum'];
            $productInfo[$key]['booking_type'] = $product['bookingType'];
            $productInfo[$key]['booking_value'] = $product['bookingValue'];
            $productInfo[$key]['master_id'] = $product['masterid'];
            $productInfo[$key]['seller_id'] = $product['sellerId'];
            $productInfo[$key]['seller_address_id'] = $product['sellerAddressId'];
        }

        return $productInfo;
    }

    /**
     * 获取商品库存信息
     * @param $items        商品
     * @param $whId         分站ID
     * @param int $district 三级地区ID
     * @return array
     */
    private static function _getItemsInventoryInfo($productsIds, $whId, $district = 0, $uid = 0, $scene = SCENE_SHOPPING_CART)
    {
        //global $shoppingProcessItil;
        //ItilReport::itil_report($shoppingProcessItil[$scene]['inventory']['req']);
        $ret = ProductInventoryOperator::GetInventory($whId, $district, $productsIds, $uid, $scene);
        if($ret['code'] == -1) {
            //ItilReport::itil_report($shoppingProcessItil[$scene]['inventory']['failed']);
            self::$errCode = $ret['code'];
            self::$errMsg =$ret['msg'];
            return false;
        }
        else if($ret['code'] != 0)
        {
            //ItilReport::itil_report($shoppingProcessItil[$scene]['inventory']['failed']);
            self::$errCode = $ret['code'];
            self::$errMsg = $ret['msg'];
            return false;
        }

        //ItilReport::itil_report($shoppingProcessItil[$scene]['inventory']['succ']);
        $inventoryInfo = $ret['data']['inventoryInfoList'];

        return $inventoryInfo;
    }

    private static function _getItemsProductIds($items)
    {
        $productsIds = array();
        //var_dump($items);
        reset($items);
        foreach($items as $key => $it)
        {
            $productsIds[] = $it['product_id'];
        }
        return $productsIds;
    }
    private static function _getMainItemsInfo($items, $whId, $products, $district, $uid = 0)
    {
        global $_ColorList, $_PROD_SIZE_2, $_NewJointOperation;
        $productIds = array();
        $forbidList = array();
        $deleteProducts = array();
        $notEnoughPkgId = array();
        $delPkgId = array();
        foreach($items as $key => $item)
        {
            $items[$key]['buy_num'] = $item['buy_count'];
            if(!isset($products[$item['product_id']]))
            {
                unset($items[$key]);
                $deleteProducts[] = $item['product_id'];
                if($item['package_id'] > 0 && !in_array($item['package_id'], $delPkgId))
                {
                    $delPkgId[] = $item['package_id'];
                }
                continue;
            }
            $product = $products[$item['product_id']];
            //限运商品
            if($product['restricted_trans_type'] > 0)
            {
                $forbidList[$product['restricted_trans_type']][] = $product['product_id'];
            }
            $items[$key]['restricted_trans_type'] = $product['restricted_trans_type'];
            $items[$key]['name'] = $product['name'];
            $items[$key]['size'] = isset($_PROD_SIZE_2[$product["size"]]) ? $_PROD_SIZE_2[$product["size"]] : "";
            $items[$key]['color'] = isset($_ColorList[$product["color"]]) ? $_ColorList[$product["color"]] : "";
            $items[$key]['product_char_id'] = $product['product_char_id'];
            $items[$key]['pic_num'] = $product['pic_num'];
            $items[$key]['weight'] = $product['weight'];
            $items[$key]['type'] = $product['type'];
            $items[$key]['flag'] = $product['flag'];
            $items[$key]['c3_ids'] = $product['c3_ids'];
            $items[$key]['market_price'] = $product['market_price'];
            $items[$key]['psystock'] = $product['psystock'];
            $items[$key]['canAddToWireLessCart'] = ($whId == 1 && $product['psystock'] == 1);
            $items[$key]['rushing_buy'] = ($product['flag'] & OTHER_TIME_LIMITED_RUSHING_BUY) == OTHER_TIME_LIMITED_RUSHING_BUY; //抢购
            $items[$key]['canVAT'] = ($product['flag'] & CAN_VAT_INVOICE) == CAN_VAT_INVOICE;
            $items[$key]['canUseCoupon'] = ($product['flag'] & COUPON_PRODUCT) != COUPON_PRODUCT;
            //$items[$key]['cash_back'] = isset($items[$key]['pkg_cash_back']) ? $items[$key]['pkg_cash_back'] + $product['cash_back'] : $product['cash_back'];
            $items[$key]['cash_back'] = isset($items[$key]['pkg_cash_back']) ? $items[$key]['pkg_cash_back'] : 0;
            //$items[$key]['price'] = $product['price'] + $items[$key]['cash_back'];
            $items[$key]['price'] = $product['price'];
            $items[$key]['discount_p_name'] = "";
            // 默认不是虚库商品
            $items[$key]['isVirtual'] = IProduct::NO_DELAY;
            $items[$key]['lowest_num'] = !empty($product['lowest_num']) ? $product['lowest_num'] : 1;
            $items[$key]['delay_days'] = 0;
            $items[$key]['point'] = $product['point'];
            $items[$key]['booking_type'] = $product['booking_type'];
            $items[$key]['booking_value'] = $product['booking_value'];
            $items[$key]['sale_model'] = $product['sale_model'];
            $items[$key]['match_num'] = 0;
            $items[$key]['match_cut'] = 0;
            $items[$key]['status'] = $product['status'];

            //临时修改节能补贴商品num_limit信息-99999
            $items[$key]['num_limit'] = $product['num_limit'] < 0 ? 999 : $product['num_limit'];
            // 库存状态描述
            //订单确认页改版
            //$total_stock_num = $product['num_available'] + $product['virtual_num'];
            $total_stock_num = $product['total_stock_num'];
            if($product['status'] != PRODUCT_STATUS_NORMAL)
            {
                $items[$key]['can_buy_count'] = 0;
                $items[$key]['stock_desc'] = IProductInventory::$_StockTips['not_sale'];
                $items[$key]['stock_status'] = IProductInventory::$_StockStatus['not_sale'];
            }
            else if($product['price'] == 99999900)
            {
                $items[$key]['can_buy_count'] = 0;
                $items[$key]['stock_desc'] = IProductInventory::$_StockTips['invalid_price'];
                $items[$key]['stock_status'] = IProductInventory::$_StockStatus['invalid_price'];
            }
            else if($total_stock_num == 0)
            {
                $items[$key]['stock_desc'] = IProductInventory::$_StockTips['not_available'];
                $items[$key]['stock_status'] = IProductInventory::$_StockStatus['not_available'];
            }
            else if(($total_stock_num > 0 && $total_stock_num >= $item['buy_count']) ||
                (($whId == SITE_SH) && ($product['flag'] & FORBID_SET_VIRTUAL) != FORBID_SET_VIRTUAL && $product['type'] == PRODUCT_TYPE_NORMAL)
            )
            {
                // 库存延迟，包括虚库和跨仓
                /*
                $items[$key] = self::_setStockDelay($items[$key], $product, $whId, $district, $uid);
                // 预购延迟，如果判断为有预购延迟，则会覆盖虚库延迟逻辑
                $items[$key] = self::_setBookingDelayType($items[$key], $product);
                // $productIds 为有货的主商品，查找赠品的时候需要用到
                //$productIds[$item['product_id']] = $item['product_id'];
                */
                if(in_array($item['package_id'], $notEnoughPkgId))
                {
                    $items[$key]['can_buy_count'] = 0;
                    $items[$key]['stock_desc'] = IProductInventory::$_StockTips['not_enough'];
                    $items[$key]['stock_status'] = IProductInventory::$_StockStatus['not_enough'];
                }
                else
                {
                    $items[$key]['can_buy_count'] = $item['buy_count'];
                    $items[$key]['stock_desc'] = IProductInventory::$_StockTips['available'];
                    $items[$key]['stock_status'] = IProductInventory::$_StockStatus['available'];
                    $products[$item['product_id']]['total_stock_num'] -= $item['buy_count'];
                }

                $productIds[] = $item['product_id'];
            }
            else
            {
                $items[$key]['stock_desc'] = IProductInventory::$_StockTips['not_enough'];
                $items[$key]['stock_status'] = IProductInventory::$_StockStatus['not_enough'];
                if($total_stock_num > 0 && $item['package_id'] == 0)
                {
                    $items[$key]['can_buy_count'] = $total_stock_num;
                    $products[$item['product_id']]['total_stock_num'] = 0;
                }
                else
                {
                    $notEnoughPkgId[] = $item['package_id'];
                    $items[$key]['can_buy_count'] = 0;
                }
            }
            //新联营加入字段
            $items[$key]['master_id'] = $product['master_id'];
            $items[$key]['seller_id'] = $product['seller_id'];
            $items[$key]['seller_address_id'] = $product['seller_address_id'];
            //这里加入个灰度的处理
            if(isset($_NewJointOperation['flag']) && $_NewJointOperation['flag'])
            {
                if($product['seller_id'] != 0)
                {
                    if(!isset($_NewJointOperation['sellerId'][$product['seller_id']]))
                    {
                        $items[$key]['seller_id'] = 0;
                        $items[$key]['seller_address_id'] = 0;
                    }
                    else
                    {
                        $items[$key]['booking_type'] = self::ICSON_BOOKING_TYPE_DELAY_DAYS;
                        $items[$key]['booking_value'] = $_NewJointOperation['sellerId'][$product['seller_id']];
                    }
                }
            }
        }
        //这里做个处理，如果商品是套餐商品，如果套餐商品其中有一个不可售或者库存不足都需要把can_buy_count去掉
        reset($items);
        foreach($items as $key => $item)
        {
            if($item['package_id'] != 0 && in_array($item['package_id'], $notEnoughPkgId) && $item['can_buy_count'] != 0)
            {
               $items[$key]['can_buy_count'] = 0;
            }
        }
        $productIds = array_unique($productIds);
        //这里是临时处理的，后续需要考虑合理的处理
        reset($items);
        foreach($items as $key => $item)
        {
            if($item['package_id'] != 0 && in_array($item['package_id'], $delPkgId))
            {
                unset($items[$key]);
                $deleteProducts[] = $item['product_id'];
                reset($productIds);
                foreach($productIds as $k => $productId)
                {
                    if($productId == $item['product_id'])
                    {
                        unset($productIds[$k]);
                        break;
                    }
                }
            }
        }
        $resulst = array(
            'pids'           => array_unique($productIds), // 有货的商品ID集合
            'forbidList'     => $forbidList, //  限运商品
            'items'          => $items, // 所有商品的信息
            'deleteProducts' => $deleteProducts,
            'delPkgId'       => $delPkgId,
        );
        return $resulst;
    }
    /**
     * @param $items
     * @param $whId
     * @param int $district
     * @return array|bool
     */
    private static function _getItemsInfo($items, $whId, $district = 0, $uid = 0,$needCostPrice = false, $scene = SCENE_SHOPPING_CART, $mlog = false)
    {
        global $shoppingProcessModuleCall;
        $retItemInfo = array(
            'items' => array(),              //全部有货商品
            'pids' => array(),         //全部有货商品ID
            'forbidList' => array(),    //限运商品
            'products' => array(),
            'inventory' => array(),      //库存
            'delPkgId'  => array(),
        );
        if(empty($items))
        {
            Logger::err('_getItemsInfo items empty');
            return $retItemInfo;
        }
        $productsIds = self::_getItemsProductIds($items);
        if(empty($productsIds))
        {
            Logger::err('_getItemsProductIds _getItemsProductIds productsIds empty!');
            return $retItemInfo;
        }
        //获取商品信息
        if($mlog !== false)
        {
            $mlog->start();
        }
        $productsInfo = self::_getProductsInfo($productsIds, $whId, $district, $uid, $scene);
        if(false === $productsInfo)
        {
            self::$errCode = 101;
            self::$errMsg = "商品信息获取失败";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg: 商品信息获取失败";
            if($mlog !== false)
            {
                $mlog->report($shoppingProcessModuleCall['passiveMID'], $shoppingProcessModuleCall['passive']['_GETPRODUCTSINFO'], self::$errCode, 1, LocalServerIP, LocalServerIP);
            }
            return false;
        }
        if($mlog !== false)
        {
            $mlog->report($shoppingProcessModuleCall['passiveMID'], $shoppingProcessModuleCall['passive']['_GETPRODUCTSINFO'], 0, 0, LocalServerIP, LocalServerIP);
            $mlog->start();
        }
        //获取库存信息
        $inventoryInfo = self::_getInventoryInfo($productsIds, $whId, $productsInfo, $district, $uid, $scene);
        if(false === $inventoryInfo) //将商品的库存信息进行设置
        {
            if($mlog !== false)
            {
                $mlog->report($shoppingProcessModuleCall['passiveMID'], $shoppingProcessModuleCall['passive']['_GETINVENTORYINFO'], 0, 1, LocalServerIP, LocalServerIP);
            }
           //遍历商品信息将库存进行设置
           foreach($productsInfo as $key => $wi) {
               $productsInfo[$key]['virtual_num'] = 0;
               $productsInfo[$key]['num_available'] = 0;
               $productsInfo[$key]['total_stock_num'] = 0;
               $productsInfo[$key]['psystock'] = $whId;
               $productsInfo[$key]['status'] = PRODUCT_STATUS_VALID;
           }
        }
        else
        {
            if($mlog !== false)
            {
                $mlog->report($shoppingProcessModuleCall['passiveMID'], $shoppingProcessModuleCall['passive']['_GETINVENTORYINFO'], 0, 0, LocalServerIP, LocalServerIP);
            }
            $productsInfo = $inventoryInfo['productsInfo'];
            $inventory = $inventoryInfo['inventoryInfo'];
        }

        //数据整理三级类目id进行转换
        $forbidList = array();
        $now = time();
        global $_StockTips, $_RestrictedTransType;
        foreach($productsInfo as $key => $value) {
            $productsInfo[$key]['is_install'] = in_array($value['c3_ids'], array(736, 739)) ? true : false;
            $productsInfo[$key]['show_price'] = $value['price'] + $value['cash_back'];

            if($value['virtual_num'] + $value['num_available'] > 0)
            {
                if($value['num_available'] > 0)
                {
                    $productsInfo[$key]['stock'] = $_StockTips['available'];
                }
                else
                {
                    $productsInfo[$key]['stock'] = $_StockTips['not_available'];
                }
            }
            else
            {
                $productsInfo[$key]['stock'] = $_StockTips['not_available'];
            }

            if($now < $value['promotion_start'] || $now > $value['promotion_end'])
            {
                $productsInfo[$key]['promotion_word'] = "";
            }

            $productsInfo[$key]['restricted_trans_desc'] = isset($_RestrictedTransType[$value['restricted_trans_type']]) ? $_RestrictedTransType[$value['restricted_trans_type']] : '';
            $productsInfo[$key]['restricted_trans_type'] = $value['restricted_trans_type'];
            $productsInfo[$key]['lowest_num'] = !empty($value['lowest_num']) ? $value['lowest_num'] : 1;

            if($needCostPrice === false) {
                unset($productsInfo[$key]['cost_price']);
                //???
                unset($productsInfo[$key]['virtual_num']);
                unset($productsInfo[$key]['num_available']);
            }
        }

        $itemsRet = self::_getMainItemsInfo($items, $whId, $productsInfo, $district, $uid);
        $items = $itemsRet['items'];
        $productsIds = $itemsRet['pids'];
        $forbidList = $itemsRet['forbidList'];
        $deleteProducts = $itemsRet['deleteProducts'];
        $delPkgId = $itemsRet['delPkgId'];

        $result = array(
            'items'         => $items,              //全部有货商品
            'pids'          => $productsIds,         //全部有货商品ID
            'forbidList'    => $forbidList,    //限运商品
            'products'      => $productsInfo,    //商品信息
            'inventory'     => $inventory,      //库存
            'deleteProducts'=> $deleteProducts, //商品信息不存在的商品
            'delPkgId'      => $delPkgId,
        );
        return $result;
    }
    private static function _getInventoryInfo($productsIds, $whId, $productsInfo, $district = 0, $uid = 0, $scene = SCENE_SHOPPING_CART)
    {
        $result = array(
            'productsInfo' => array(),
            'inventoryInfo' => array(),
        );
        if(!is_array($productsIds) || empty($productsIds)
            || !is_array($productsInfo) || empty($productsInfo))
        {
            Logger::err('_getInventoryInfo productsIds empty!');
            return $result;
        }
        //获取库存信息
        $inventoryInfo = self::_getItemsInventoryInfo($productsIds, $whId, $district, $uid, $scene);
        if(false === $inventoryInfo) //将商品的库存信息进行设置
        {
            //遍历商品信息将库存进行设置
            foreach($productsInfo as $key => $wi) {
                $productsInfo[$key]['virtual_num'] = 0;
                $productsInfo[$key]['num_available'] = 0;
                $productsInfo[$key]['psystock'] = $whId;
                $productsInfo[$key]['status'] = PRODUCT_STATUS_VALID;

                $inventoryInfo[$key]['productId'] = $key;
                $inventoryInfo[$key]['virtualNum'] = 0;
                $inventoryInfo[$key]['availableNum'] = 0;
                $inventoryInfo[$key]['supplyStockId'] = $whId;
                $inventoryInfo[$key]['saleStockId'] = $whId;
                $inventoryInfo[$key]['accountNum'] = 0;
            }
        }
        else
        {
            //这块需要确定返回的数据类型是什么样子的
            foreach($productsInfo as $key => $wi) {
                if(isset($inventoryInfo[$key]))
                {
                    $productsInfo[$key]['virtual_num'] = $inventoryInfo[$key]['virtualNum'];
                    $productsInfo[$key]['num_available'] = $inventoryInfo[$key]['availableNum'];
                    $productsInfo[$key]['total_stock_num'] = $inventoryInfo[$key]['virtualNum'] + $inventoryInfo[$key]['availableNum'];
                    $productsInfo[$key]['psystock'] = $inventoryInfo[$key]['supplyStockId'];
                }
                else
                {
                    $productsInfo[$key]['virtual_num'] = 0;
                    $productsInfo[$key]['num_available'] = 0;
                    $productsInfo[$key]['total_stock_num'] = 0;
                    $productsInfo[$key]['psystock'] = $whId;
                    $productsInfo[$key]['status'] = PRODUCT_STATUS_VALID;
                }
            }
        }

        $result = array(
            'productsInfo' => $productsInfo,
            'inventoryInfo' => $inventoryInfo,
        );
        return $result;
    }

    /**
     * 根据三级地域id、站id 获取对应的DC
     * @param $uid              用户uid
     * @param $district         三级地域ID
     * @param $whId             站ID
     * @return string $DC       DC
     */
    private static function _getDCByDistrictAndSite($district, $whId, $uid = 0, $scene = SCENE_SHOPPING_CART){
        if(($district <= 0 ) || ($whId <= 0 )) {
            return false;
        }
        $result = StockDCWhOperator::GetDCByDistrictAndSite($district, $whId, $uid, $scene);
        if($result['code'] == -1 ) {
            self::$errCode = $result['code'];
            self::$errMsg = $result['msg'];
            return false;
        }
        else if($result['code'] != 0) {
            self::$errCode = $result['code'];
            self::$errMsg = $result['msg'];
            return false;
        }

        $data = $result['data'];
        return $data['dcId'];
    }

    private static function _setStockDelay($item, $product, $whId, $district, $uid = 0)
    {
        global $_StockToDCTransitDays, $_StockID_Name;
        if($product['num_available'] < $item['buy_count'])
        {
            // 虚库延迟两天
            $item['stock_desc'] = IProductInventory::$_StockTips['arrival1-3'];
            $item['stock_status'] = IProductInventory::$_StockStatus['arrival1-3'];
            $item['isVirtual'] = IProduct::VIRTUAL_STOCK_TYPE_1;
            $item['vValue'] = IShippingTime::$vStockDelay[IProduct::VIRTUAL_STOCK_TYPE_1];
        }
        else
        {
            $des_dc = self::_getDCByDistrictAndSite($district, $whId, $uid);

            //这里$des_dc没有处理返回值是否有问题？
            //实际库存足够
            if(!isset($_StockToDCTransitDays[$product['psystock']][$des_dc])
                || $_StockToDCTransitDays[$product['psystock']][$des_dc] == 0)
            {
                $item['stock_desc'] = IProductInventory::$_StockTips['available'];
                $item['stock_status'] = IProductInventory::$_StockStatus['available'];
                $item['isVirtual'] = IProduct::NO_DELAY;
                $item['vValue'] = 0;
            }
            else
            {
                $item['stock_desc'] = "有货，待{$_StockID_Name[$product['psystock']]}调拨，{$_StockToDCTransitDays[$product['psystock']][$des_dc]}天后配送";
                $item['stock_status'] = IProductInventory::$_StockStatus['arrivalN'];
                $item['isVirtual'] = IProduct::NO_DELAY;
                $item['vValue'] = $_StockToDCTransitDays[$product['psystock']][$des_dc];
            }
        }

        return $item;
    }

    private static function _setBookingDelayType($item, $product)
    {
        if($item['isVirtual'] == IProduct::CROSS_STOCK_DELAY)
        {
            // 如果之前的延迟类型是 跨仓延迟，则累加
            $baseDelay = $item['vValue'];
        }
        else
        {
            // 如果之前的延迟类型是 其他，则不累加
            $baseDelay = 0;
        }

        switch($product['booking_type'])
        {
            case IProduct::BOOKING_TYPE_SPECIFIC_DELAY:
                $N = $baseDelay + $product['booking_value'];
                $item['stock_desc'] = "现在下单，{$N}天后为您发货";
                $item['stock_status'] = IProductInventory::$_StockStatus['bookingN'];
                $item['isVirtual'] = $product['booking_type'];
                $item['vValue'] = $product['booking_value'];
                break;
            case IProduct::BOOKING_TYPE_SPECIFIC_DATE:
                $N = $product['booking_value'];
                $date = date("Ymd", strtotime("{$N} +{$baseDelay} day"));
                $t1 = strtotime($date);
                // 如果没有过期
                if(IShippingTime::getDiffDays(time(), $t1) > 0) {
                    $N = date("m月d日", $t1);
                    $item['stock_desc'] = "现在下单，{$N}后为您发货";
                    $item['stock_status'] = IProductInventory::$_StockStatus['bookingDate'];
                    $item['isVirtual'] = $product['booking_type'];
                    $item['vValue'] = $product['booking_value'];
                }
                break;
            case IProduct::BOOKING_TYPE_NOSPECIFIC_DATE:
                $item['stock_desc'] = "商品待备货";
                $item['stock_status'] = IProductInventory::$_StockStatus['bookingNoDate'];
                $item['isVirtual'] = $product['booking_type'];
                $item['vValue'] = $product['booking_value'];
                break;
        }

        return $item;
    }

    /**
     * @param $package1
     * @param $package2
     * @return bool true 相同 false 不同
     * 判断分单后的两个包裹是否分单相同
     */
    private static function _checkDividedOrder($package1, $package2)
    {
        if(count($package1) != count($package2))
        {

            return false;
        }
        else
        {
            foreach($package1 as $key => $pack)
            {
                $package1[] = array_keys($pack['items']);
            }
            foreach($package2 as $key => $pack)
            {
                $package2[] = array_keys($pack['items']);
            }
            //比较两个数组是否相同
            foreach($package1 as $key1=>$value1)
            {
                foreach($package2 as $key2=>$value2)
                {
                    if(count($value1) == count($value2))
                    {
                        $diff = array_diff($value1, $value2);
                        if(empty($diff))
                        {
                            unset($package1[$key1]);
                            unset($package2[$key2]);
                            break;
                        }
                    }
                }
            }
            if(empty($package1) && empty($package2))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }

    /**
     * 商品信息合并
     * @param $nomalItems
     * @param $pkgItems
     * @return array
     */
    private static function _mergeItemsInfo($nomalItems, $pkgItems)
    {
        if(empty($nomalItems))
        {
            return $pkgItems;
        }
        else if(empty($pkgItems))
        {
            return $nomalItems;
        }
        $items = array_merge($pkgItems, $nomalItems);

        return $items;
    }

    /**
     * 结构化支付列表
     * @param $payTypeList
     */
    private static function _getFormatPayType($payTypeList)
    {
        $formatPayType = array();
        foreach($payTypeList as $key => $payType)
        {
            $payTypeId = $payType['payTypeId'];
            $formatPayType[$payTypeId]['pay_type'] = $payTypeId;
            $formatPayType[$payTypeId]['PayTypeName'] = iconv("utf8", "gbk//IGNORE", $payType['payTypeName']);
            $formatPayType[$payTypeId]['IsNetBank'] = $payType['isNetBank'];
            $formatPayType[$payTypeId]['IsNet'] = $payType['isNet'];
            $formatPayType[$payTypeId]['IsInstallment'] = $payType['isInstallment'];
            $formatPayType[$payTypeId]['PayTypeDesc'] = iconv("utf8", "gbk//IGNORE", $payType['payTypeDesc']);
            $formatPayType[$payTypeId]['OrderNumber'] = $payType['orderNumber'];

            if (bccomp($payType['payRate'], "0.000000", 6) == 0)
            {
                $formatPayType[$payTypeId]['needPrcdFee'] = 0;
            }
            else
            {
                $formatPayType[$payTypeId]['needPrcdFee'] = 1;
            }
        }
        return $formatPayType;
    }

    /**
     * 结构化分期付款信息
     * @param $installmentConfigList
     */
    private static function _getFormatInstallment($installmentConfigList)
    {
        $installmentConfigData = array();
        if(count($installmentConfigList) > 0)
        {
            foreach($installmentConfigList as $key => $installment)
            {
                $payTypeId = $installment['payTypeId'];
                $installmentConfigData[$payTypeId]['pay_type'] = $payTypeId;
                $installmentConfigData[$payTypeId]['BankName'] = iconv("utf8", "gbk//IGNORE", $installment['bankName']);
                foreach($installment['installmentTermList'] as $k => $v)
                {
                    $termNum = $v['termNum'];
                    $installmentConfigData[$payTypeId]['installments'][$termNum]['TermNum'] = $termNum;
                    $installmentConfigData[$payTypeId]['installments'][$termNum]['MinPrice'] = $v['minPrice'];
                    $installmentConfigData[$payTypeId]['installments'][$termNum]['MaxPrice'] = $v['maxPrice'];
                    $installmentConfigData[$payTypeId]['installments'][$termNum]['Rate'] = intval($v['rate']) / 1000000;
                    $installmentConfigData[$payTypeId]['installments'][$termNum]['BackRate'] = intval($v['backRate']) / 1000000;
                    $installmentConfigData[$payTypeId]['installments'][$termNum]['BankSynNo'] = $v['bankSynNo'];
                }
            }
        }
        return $installmentConfigData;
    }
    /**
     * 获取购物车商品信息
     * 包括：商品、套餐、库存、赠品、单品赠券信息
     * @param $uid              用户uid
     * @param $whId             分站ID
     * @param $district         三级地址ID
     * @param $offLineParams    离线购物车信息
     * @return array items      全部商品信息
     * @return array packages   套餐信息
     */
    public static function getAllCartItemsInfo($uid, $whId, $district, $offLineParams, $needGift = false, $needLog = false, $scene = SCENE_SHOPPING_CART, $newData = array(), $version = 0)
    {
        global $shoppingProcessModuleCall;
        //$activeModuleId = $shoppingProcessModuleCall['active'][$scene];
        $activeModuleId = $shoppingProcessModuleCall['passiveMID'];
        $mlog =	new CLoggerWrap($shoppingProcessModuleCall['active'][$scene]);
        $mlog->start();

        if($needLog)
        {
            Logger::info("getAllCartItemsInfo start[uid:{$uid}][whid:{$whId}][district:{$district}][offLineParams:".ToolUtil::gbJsonEncode($offLineParams) ."][scene:{$scene}][version:{$version}][newData:" . ToolUtil::gbJsonEncode($newData) . "]" );
        }
         /**
         * 设置购物车类型, 0表示正常购物车
         */
        $shoppingCartType = !empty($offLineParams['type']) ? $offLineParams['type'] : IShoppingCartV2::ONLINE_CART;

        $items = array();
        $normalItems = array();
        $pkgItems = array();
        $suiteInfo = array();
        //获取用户购物车商品列表
        $ret = self::_getItemsList($uid, $whId, $offLineParams, $scene);
        if($needLog)
        {
            Logger::info('_getItemsList ret=>'.ToolUtil::gbJsonEncode($ret));
        }
        if(false === $ret)
        {
            self::$errCode = self::$errCode;
            self::$errMsg = self::$errMsg;
            self::$logMsg = self::$logMsg;
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['_GETITEMSLIST'], self::$errCode, 1, LocalServerIP, LocalServerIP);
            Logger::err("_getItemsList ret Failed!=>".self::$logMsg . ",[uid:{$uid}][whid:{$whId}][district:{$district}]".ToolUtil::gbJsonEncode($offLineParams));
            return false;
        }
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['_GETITEMSLIST'], 0, 0, LocalServerIP, LocalServerIP);
        $normalItems = $ret['normalItems'];       //购物车中的普通商品
        $pkgIds = $ret['packageIds'];       //购物车中套餐id
        $pkgBuycount = $ret['pkgBuycount']; //购物车中的套餐购买数量

        //购物车中存在有套餐 获取套餐数据
        if(!empty($pkgIds))
        {
            //获取套餐的信息
            $mlog->start();
            $pkgRet = self::_getItemsPackageInfo($pkgIds, $pkgBuycount, $whId, $district, $uid, $scene);
            if($needLog)
            {
                Logger::info('_getItemsPackageInfo ret=>'.ToolUtil::gbJsonEncode($pkgRet));
            }
            if(false === $pkgRet)
            {
                self::$errCode = self::$errCode;
                self::$errMsg = self::$errMsg;
                self::$logMsg = self::$logMsg . self::$errCode;
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['_GETITEMSPACKAGEINFO'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                Logger::err("_getItemsPackageInfo ret Failed!=>".self::$logMsg . ",[uid:{$uid}][whid:{$whId}][district:{$district}]".ToolUtil::gbJsonEncode($offLineParams));
                return  false;
            }
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['_GETITEMSPACKAGEINFO'], 0, 0, LocalServerIP, LocalServerIP);
            //suitinfo 为套餐的信息。 packitems 是套餐中商品的数据
            $pkgItems = $pkgRet['pkgsItems'];
            $suiteInfo = $pkgRet['suiteInfo'];
        }
        //新版生成订单需要处理前端传来的数据 S sheldonshi
        if($scene == SCENE_SHOPPING_ORDER && $version == 1)
        {
            $postSuiteInfo = isset($newData['suiteInfo']) && !empty($newData['suiteInfo'])
                                    ? ToolUtil::gbJsonDecode($newData['suiteInfo']) : array();
            $postItemInfo = $newData['suborders'];
            $postItems = array();
            while (FALSE != ($subOrder = current($postItemInfo)))
            {
                next($postItemInfo);
                $postItems = array_merge($postItems, $subOrder['items']);
            }
            //处理套餐数据
            foreach($pkgItems as $key => $item)
            {
                if(!array_key_exists($item['package_id'], $postSuiteInfo))
                {
                    //如果后端查到的套餐商品不在前端传来的套餐列表里，说明这个是无货或其他不可售的状态
                    unset($pkgItems[$key]);
                }
                else
                {
                    //根据前端设置套餐商品的购买数量
                    $pkgItems[$key]['buy_count'] = $postSuiteInfo[$item['package_id']]['buy_count'];
                    $pkgItems[$key]['item_total_cut'] = $pkgItems[$key]['packageCashBack'] * $pkgItems[$key]['buy_count'];
                }
            }
            //这里的处理会出现一定的风险，套餐内部商品的数量不一致，但是应该可以保证的。
            reset($pkgItems);
            foreach($postItems as $key => $item)
            {
                foreach($pkgItems as $k => $it)
                {
                    if($it['product_id'] == $item['product_id'])
                    {
                        $postItems[$key]['num'] -= $it['buy_count'];
                    }
                }
            }
            //$postItems当前为可以购买的普通商品
            foreach($normalItems as $key => $item)
            {
                reset($postItems);
                $exist = false;
                foreach($postItems as $k => $it)
                {
                    if($item['product_id'] == $it['product_id'])
                    {
                        if($it['num'] > 0)
                        {
                            $exist = true;
                            $normalItems[$key]['buy_count'] = $it['num'];
                            break;
                        }
                        else
                        {
                            break;
                        }
                    }
                }
                if(!$exist)
                {
                    unset($normalItems[$key]);
                }
            }
        }
        //新版生成订单需要处理前端传来的数据 E sheldonshi
        //合并普通商品和赠品
        $items = self::_mergeItemsInfo($normalItems, $pkgItems);
        //获取全部商品ID
        $productIds = self::_getItemsProductIds($items);
        //获取获取全部商品信息
        $itemsRet = self::_getItemsInfo($items, $whId, $district, $uid, true, $scene, $mlog);
        if($needLog)
        {
            Logger::info('_getItemsInfo ret=>'.ToolUtil::gbJsonEncode($itemsRet));
        }
        if(false === $itemsRet)
        {
            self::$errCode = self::$errCode;
            self::$errMsg = self::$errMsg;
            self::$logMsg = self::$logMsg;
            Logger::err("_getItemsInfo ret Failed!=>".self::$logMsg . ",[uid:{$uid}][whid:{$whId}][district:{$district}]".ToolUtil::gbJsonEncode($offLineParams));
            return false;
        }
        $items = $itemsRet['items'];
        $pIds = $itemsRet['pids'];              //有货的商品ID
        $forbidList = $itemsRet['forbidList'];
        $products = $itemsRet['products'];
        $inventory = $itemsRet['inventory'];
        $deleteProducts = $itemsRet['deleteProducts'];
        $delPkgId = $itemsRet['delPkgId'];
        //删除商品信息中没有的商品的套餐信息
        foreach($delPkgId as $key => $pkgId)
        {
            unset($suiteInfo[$pkgId]);
        }
        //获取赠品信息
        $mlog->start();
        $giftRet = self::_getItemsGiftInfo($items, $products, $whId, $district, $uid, $scene);
        if($needLog)
        {
            Logger::info('_getItemsGiftInfo ret=>'.ToolUtil::gbJsonEncode($giftRet));
        }
        if(false === $giftRet)
        {
            self::$errCode = self::$errCode;
            self::$errMsg = self::$errMsg;
            self::$logMsg = self::$logMsg;
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['_GETITEMSGIFTINFO'], self::$errCode, 1, LocalServerIP, LocalServerIP);
            Logger::err("_getItemsGiftInfo ret Failed!=>".self::$logMsg . ",[uid:{$uid}][whid:{$whId}][district:{$district}]".ToolUtil::gbJsonEncode($offLineParams));
            return false;
        }
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['_GETITEMSGIFTINFO'], 0, 0, LocalServerIP, LocalServerIP);
        $items = $giftRet['items'];             //含有赠品的商品信息
        $products = $giftRet['products'];       //含有赠品的商品信息
        $giftProducts = array();
        if(true === $needGift) {
            $giftids = $giftRet['giftIds'];
            //获取赠品的商品信息
            if(!empty($giftids)) {
                $giftProducts = self::_getGiftProductInfo($giftids , $whId , $district , $uid , true, $scene);
                if( false === $giftProducts)
                {
                    self::$errCode = self::$errCode;
                    self::$errMsg = self::$errMsg;
                    self::$logMsg = self::$logMsg;
                    Logger::err("_getGiftProductInfo ret Failed!=>".self::$logMsg . ",[uid:{$uid}][whid:{$whId}][district:{$district}]".ToolUtil::gbJsonEncode($offLineParams));
                    return false;
                }
              //  $products = array_merge($products , $giftProducts);
                foreach($giftProducts  as $gid => $ginfo ) {
                    $products[ $gid ] =  $ginfo ;
                }
            }
        }

        //获取单品赠券
        $promoCoupon = array();
        if($shoppingCartType != IShoppingCartV2::INSTALLMENT_CART) {
            $mlog->start();
            $couponRet = self::_getItemsSingleCouponInfo($items, $whId, $district, $uid, $scene);
            if($needLog)
            {
                Logger::info('_getItemsSingleCouponInfo ret=>'.ToolUtil::gbJsonEncode($couponRet));
            }
            if(false === $couponRet)
            {
                self::$errCode = self::$errCode;
                self::$errMsg = self::$errMsg;
                self::$logMsg = self::$logMsg;
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['_GETITEMSSINGLECOUPONINFO'], self::$errCode, 1, LocalServerIP, LocalServerIP);
                Logger::err("_getItemsSingleCouponInfo ret Failed!=>".self::$logMsg . ",[uid:{$uid}][whid:{$whId}][district:{$district}]".ToolUtil::gbJsonEncode($offLineParams));
                return false;
            }
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['_GETITEMSSINGLECOUPONINFO'], 0, 0, LocalServerIP, LocalServerIP);
            $promoCoupon = $couponRet['coupons'];
       }

       $result = array(
            'suiteInfo' => $suiteInfo,                //套餐的信息
            'promoCoupon' => $promoCoupon,            //单品赠券
            'items' => $items,                        //商品信息
            'productIds' => $productIds,              //全部商品ID
            'forbidList' => $forbidList,
            'products' => $products,
            'pkgIds' => $pkgIds,
            'inventory' => $inventory,
            'deleteProducts' => $deleteProducts,
        );
        if($needLog)
        {
            Logger::info("getAllCartItemsInfo Finis=".ToolUtil::gbJsonEncode($result));
        }

        return $result;
    }

    /** 获取商品信息及库存
     * @param $productsIds          商品ID
     * @param $whId                 分站ID
     * @param int $district         三级地区ID
     * @param int $uid              用户ID
     * @return array|bool           返回商品信息
     */
    public static function getProductsInfo($productsIds, $whId, $district = 0, $uid = 0, $scene = SCENE_SHOPPING_CART)
    {
        if(!is_array($productsIds) || empty($productsIds))
        {
            return false;
        }
        //获取商品信息
        $productsInfo = self::_getProductsInfo($productsIds, $whId, $district, $uid, $scene);
        if(false === $productsInfo)
        {
            self::$errCode = 101;
            self::$errMsg = "商品信息获取失败";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg: 商品信息获取失败";
            return false;
        }
        //获取库存信息
        $inventoryInfo = self::_getInventoryInfo($productsIds, $whId, $productsInfo, $district, $uid, $scene);
        if(false === $inventoryInfo) //将商品的库存信息进行设置
        {
            //遍历商品信息将库存进行设置
            foreach($productsInfo as $key => $wi) {
                $productsInfo[$key]['virtual_num'] = 0;
                $productsInfo[$key]['num_available'] = 0;
                $productsInfo[$key]['psystock'] = $whId;
                $productsInfo[$key]['status'] = PRODUCT_STATUS_VALID;
            }
        }
        else
        {
            $productsInfo = $inventoryInfo['productsInfo'];
            $inventory = $inventoryInfo['inventoryInfo'];
        }

        return array(
            'productsInfo' => $productsInfo,
            'inventory' => $inventory,      //库存
        );
    }

    /** 获取商品信息及
     * @param $productsIds          商品ID
     * @param $whId                 分站ID
     * @param int $district         三级地区ID
     * @param int $uid              用户ID
     * @return array|bool           返回商品信息
     */
    public static function getProductInfo($productsIds, $whId, $district = 0, $uid = 0)
    {
        if(!is_array($productsIds) || empty($productsIds))
        {
            return false;
        }
        //获取商品信息
        $productsInfo = self::_getProductsInfo($productsIds, $whId, $district, $uid);
        if(false === $productsInfo)
        {
            self::$errCode = 101;
            self::$errMsg = "商品信息获取失败";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg: 商品信息获取失败";
            return false;
        }
        return array(
            'productsInfo' => $productsInfo,
        );
    }
    /**获取套餐信息
     * @param $pkgId        套餐ID
     * @param $whId         分站ID
     * @param $district     三级地区ID
     * @param int $uid      用户UID
     * @return array|bool
     */
    public static function getPackageInfo($pkgId, $whId, $district, $uid = 0)
    {
        //检测参数传递情况
        if (is_null($pkgId) || !is_numeric($pkgId)) {
            self::setErr(1001, "rule_id参数传递错误");
            return false;
        }
        if (is_null($whId) || !is_numeric($whId)) {
            self::setErr(1002, "wh_id参数传递错误");
            return false;
        }

        $pkgId = array($pkgId);
        //获取套餐信息
        $ret = AttachmentOperator::GetPackageByRules($whId, $district, $pkgId, $uid);
        if($ret['code'] != 0 ) {
            self::$errCode = $ret['code'];
            self::$errMsg =$ret['errmsg'];
            return false;
        }
        $pkgs = $ret['data'];
        if($pkgs['result'] != 0) {
            self::$errCode = $ret['result'];
            self::$errMsg = $ret['errmsg'];
            return false;
        }
        $pkgsData = $pkgs['mapMRuleIdPackage'];
        $pkgsItems = array();
        $pkgInfo = array();
        foreach($pkgsData as $key =>$value) {
            $pkg = array();
            $pkg['id'] = $value['ruleId'];
            $pkg['name'] = $value['promotionName'];
            foreach($value['vecPackageInfo'] as $product) {
                $pkg['pid_list'][] = $product['productId'];
            }
            $pkgInfo[] = $pkg;
        }

        return array(
            'pkgsItems'     => $pkgsItems,   //套餐商品信息
            'suiteInfo' => $pkgInfo,    // 套餐信息
        );

    }

    /**根据仓ID来获取对应分站地址
     * @param $stockId          仓ID
     * @param int $uid          用户UID
     * @return bool|int|string
     */
    public static function getSiteByStock($stockId, $uid=0, $scene = SCENE_SHOPPING_CART)
    {
       if($stockId <= 0 )
       {
           return false;
       }
        $vecStock = array($stockId);
        $result = StockDCWhOperator::GetSiteByStock($vecStock,$uid, $scene);
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
        $whId = 1;
        foreach( $data['stockToSite'] as $key => $value) {
            $whId = $value;
        }
        return $whId;
    }

    public static function getDeliveryInfo4Cart($items, $inventorys, $whId, $destinationId, $uid =0, $userLevel = 0, $scene = SCENE_SHOPPING_CART)
    {
        //遍历去掉商品status不可销售的商品再调用配送
        $deliveryItems = array();
        foreach($items as $key => $item)
        {
            if($item['status'] == PRODUCT_STATUS_NORMAL && $item['price'] != 99999900)
            {
                //商品暂不销售,不传给配送
                $deliveryItems[] = $item;
            }
        }
        if(empty($deliveryItems))
        {
            Logger::err("getDeliveryInfo4Cart items empty![whid:{$whId}][destinationId:{$destinationId}][uid;{$uid}][userLevel:{$userLevel}]items:" . ToolUtil::gbJsonEncode($items)."inventory".ToolUtil::gbJsonEncode($inventorys));
            return false;
        }
        if(empty($inventorys))
        {
            Logger::err("getDeliveryInfo4Cart inventory empty![whid:{$whId}][destinationId:{$destinationId}][uid;{$uid}][userLevel:{$userLevel}]items:" . ToolUtil::gbJsonEncode($items)."inventory".ToolUtil::gbJsonEncode($inventorys));
            return false;
        }

        $dc = self::_getDCByDistrictAndSite($destinationId, $whId, $uid, $scene);
        if(false === $dc)
        {
            Logger::err("getDeliveryInfo4Cart _getDCByDistrictAndSite Failed![whid:{$whId}][destinationId:{$destinationId}][uid;{$uid}][userLevel:{$userLevel}]items:" . ToolUtil::gbJsonEncode($items)."inventory".ToolUtil::gbJsonEncode($inventorys));
            return false;
        }
        //global $shoppingProcessItil;
        //ItilReport::itil_report($shoppingProcessItil[$scene]['delivery']['req']);
        $deliveryRet = ShippingOperator::getShippingforCart($whId, $destinationId, $dc, $deliveryItems, $inventorys, $uid, $userLevel);
        if($deliveryRet['code'] == -1)
        {
            //ItilReport::itil_report($shoppingProcessItil[$scene]['delivery']['failed']);
            self::$errCode = $deliveryRet['code'];
            self::$errMsg = $deliveryRet['msg'];
            Logger::err("getDeliveryInfo4Cart getShippingforCart Failed![errCode:{$deliveryRet['code']}][whid:{$whId}][destinationId:{$destinationId}][uid;{$uid}][userLevel:{$userLevel}]items:" . ToolUtil::gbJsonEncode($items)."inventory".ToolUtil::gbJsonEncode($inventorys).",deliveryRet:".ToolUtil::gbJsonEncode($deliveryRet));
            return false;
        }
        else if($deliveryRet['code'] != 0)
        {
            //ItilReport::itil_report($shoppingProcessItil[$scene]['delivery']['failed']);
            self::$errCode = $deliveryRet['code'];
            self::$errMsg = $deliveryRet['msg'];
            Logger::err("getDeliveryInfo4Cart getShippingforCart Error![errCode:{$deliveryRet['code']}][whid:{$whId}][destinationId:{$destinationId}][uid;{$uid}][userLevel:{$userLevel}]items:" . ToolUtil::gbJsonEncode($items)."inventory".ToolUtil::gbJsonEncode($inventorys).",deliveryRet:".ToolUtil::gbJsonEncode($deliveryRet));
            return false;
        }
        //ItilReport::itil_report($shoppingProcessItil[$scene]['delivery']['succ']);

        $shippingInfo = $deliveryRet['data']['baseShippingInfoList'];
        reset($items);
        foreach($items as $key => $item)
        {
            if(isset($shippingInfo[$item['product_id']])
                && $shippingInfo[$item['product_id']]['stockDesc_u'] == 1
                && $shippingInfo[$item['product_id']]['stockStatus_u'] == 1
            )
            {
                $shipping = $shippingInfo[$item['product_id']];
                $items[$key]['stock_desc'] = iconv("utf8", "gbk//IGNORE", $shipping['stockDesc']);
                $items[$key]['stock_status'] = $shipping['stockStatus'];
                $items[$key]['vValue'] = $shipping['delay']['delayValue'];
            }
            //seller_id seller_address_id数据不一致的容错处理
            if(($item['seller_id'] == 0 && $item['seller_address_id'] != 0)
                || ($item['seller_id'] != 0 && $item['seller_address_id'] == 0)
            )
            {
                $items[$key]['stock_desc'] = IProductInventory::$_StockTips['not_sale'];
                $items[$key]['stock_status'] = IProductInventory::$_StockStatus['not_sale'];
            }
        }
        $result = array(
            'items' => $items,
        );
        return $result;
    }

    public static function getDeliveryInfo4Order($items, $inventorys, $whId, $destinationId, $uid, $userLevel = 0, $scene = SCENE_SHOPPING_PROCESS)
    {
        $dc = self::_getDCByDistrictAndSite($destinationId, $whId, $uid, $scene);
        if(false === $dc)
        {
            Logger::err("getDeliveryInfo4Order _getDCByDistrictAndSite Error![whid:{$whId}][destinationId:{$destinationId}][uid;{$uid}][userLevel:{$userLevel}]items:" . ToolUtil::gbJsonEncode($items)."inventory".ToolUtil::gbJsonEncode($inventorys));
            return false;
        }
        //global $shoppingProcessItil;
        //ItilReport::itil_report($shoppingProcessItil[$scene]['delivery']['req']);
        $deliveryRet = ShippingOperator::getShippingforOrder($whId, $destinationId, $dc, $items, $inventorys, 0, $uid, $userLevel);
        if($deliveryRet['code'] == -1)
        {
            //ItilReport::itil_report($shoppingProcessItil[$scene]['delivery']['failed']);
            self::$errCode = $deliveryRet['code'];
            self::$errMsg = $deliveryRet['msg'];
            Logger::err("getDeliveryInfo4Order getShippingforOrder Failed![whid:{$whId}][destinationId:{$destinationId}][uid;{$uid}][userLevel:{$userLevel}]items:" . ToolUtil::gbJsonEncode($items)."inventory".ToolUtil::gbJsonEncode($inventorys).",deliveryRet".ToolUtil::gbJsonEncode($deliveryRet));
            return false;
        }
        else if($deliveryRet['code'] != 0)
        {
            //ItilReport::itil_report($shoppingProcessItil[$scene]['delivery']['failed']);
            self::$errCode = $deliveryRet['code'];
            self::$errMsg = $deliveryRet['msg'];
            Logger::err("getDeliveryInfo4Order getShippingforOrder Error![whid:{$whId}][destinationId:{$destinationId}][uid;{$uid}][userLevel:{$userLevel}]items:" . ToolUtil::gbJsonEncode($items)."inventory".ToolUtil::gbJsonEncode($inventorys).",deliveryRet".ToolUtil::gbJsonEncode($deliveryRet));
            return false;
        }
        //ItilReport::itil_report($shoppingProcessItil[$scene]['delivery']['succ']);
        $deliveryRet = $deliveryRet['data'];
        $delivery = $deliveryRet['orderShipping'];
        $packageInfo = $delivery['packageList'];
        $delayInfo = $delivery['delayList'];
        $shipinfo = $delivery['shipinfo'];
        $isCanVATInvoice = $delivery['isCanVAT'] == 0 ? false : true;
        $hasNoteBook = $delivery['hasNoteBook'];
        $totalWeight = $delivery['totalWeight'];
        $totalCut = 0;
        $totalAmt = 0;
        $c3Ids = array();
        $packages = array();
        $shippingType = array();
        foreach($packageInfo as $subKey => $pack)
        {
            $packages[$subKey]['stock_wh_id'] = $pack['stockWhId'];
            $packages[$subKey]['psystock'] = $pack['psyStockId'];
            $packages[$subKey]['wh_id'] = $whId;
            $packages[$subKey]['cross_stock'] = $pack['isCrossStock'];
            $packages[$subKey]['totalWeight'] = isset($pack['sizeInfo']['orderWeight']) ? $pack['sizeInfo']['orderWeight'] : 0;
            $packages[$subKey]['order_size'] = isset($pack['sizeInfo']['orderSize']) ? $pack['sizeInfo']['orderSize'] : 0;
            $packages[$subKey]['order_volume'] = isset($pack['sizeInfo']['orderVolume']) ? $pack['sizeInfo']['orderVolume'] : 0;
            $packages[$subKey]['order_longest'] = isset($pack['sizeInfo']['orderMaxlength']) ? $pack['sizeInfo']['orderMaxlength'] : 0;
            $packages[$subKey]['items'] = array();
            $packItmes = $pack['dwItems'];
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
                            $pkgItems[$pid]['buy_num'] += isset($item['buy_num']) ? $item['buy_num'] : $item['buy_count'];
                            $pkgItems[$pid]['buy_flag'] = (isset($item['buy_flag']) &&  $item['buy_flag'] == 1) ? $item['buy_flag'] : $pkgItems[$pid]['buy_flag'];
                            $pkgItems[$pid]['unit_price'] += $item['total_price_after'];
                            $pkgItems[$pid]['cash_back'] = $pkgItems[$pid]['cash_back'] == 0 ? $item['cash_back'] : $pkgItems[$pid]['cash_back'];
                            $pkgItems[$pid]['item_total_cut'] += $item['item_total_cut'];
                        }
                        else
                        {
                            $pkgItems[$pid] = $item;
                            $pkgItems[$pid]['buy_count'] = $item['buy_count'];
                            $pkgItems[$pid]['buy_num'] = isset($item['buy_num']) ? $item['buy_num'] : $item['buy_count'];
                            $pkgItems[$pid]['buy_flag'] = isset($item['buy_flag']) ? $item['buy_flag'] : 0;
                            $pkgItems[$pid]['unit_price'] = $item['total_price_after'];
                        }
                        $packages[$subKey]['totalAmt'] += $item['total_price_after'];
                        //$packages[$subKey]['totalCut'] += $item['buy_count'] * $item['cash_back'];
                       // $totalCut += $item['buy_count'] * $item['cash_back'];


                        //商品的返现金额的叠加修改 2013-05-22
                        $packages[$subKey]['totalCut'] += $item['item_total_cut'];
                        $totalCut +=$item['item_total_cut'];

                        $totalAmt += $item['total_price_after'];
                        $c3Ids[] = $item['c3_ids'];
                        $item['stock_desc'] = isset($pack['strItems'][$pid]['stockDesc'])
                                              && !empty($pack['strItems'][$pid]['stockDesc']) ? $pack['strItems'][$pid]['stockDesc'] : $item['stock_desc'];
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
            $shippingType[$key]['SysNo'] = $ship['sysNo'];
            $shippingType[$key]['ShipTypeID'] = $ship['shipTypeID'];
            $shippingType[$key]['ShipTypeName'] = iconv("utf8", "gbk//IGNORE", $ship['shipTypeName']);
            $shippingType[$key]['ShipTypeDesc'] = iconv("utf8", "gbk//IGNORE", $ship['shipTypeDesc']);
            $shippingType[$key]['PremiumRate'] = $ship['premiumRate'];
            $shippingType[$key]['Status'] = $ship['status'];
            $shippingType[$key]['StatusQueryType'] = $ship['statusQueryType'];
            $shippingType[$key]['StatusQueryUrl'] = $ship['statusQueryUrl'];
            $shippingType[$key]['IsOnlineShow'] = $ship['isOnlineShow'];
            $shippingType[$key]['ShippingId'] = $ship['shippingId'];
            $shippingType[$key]['isCOD'] = $ship['isCOD'];
            $shippingType[$key]['delivery_time'] = $ship['deliveryTime'];
            $shippingType[$key]['shippingPrice'] = $ship['shippingPrice'];
            $shippingType[$key]['shippingPriceCut'] = $ship['shippingCut'];
            $shippingType[$key]['shippingCost'] = $ship['shippingCost'];
            $shippingType[$key]['free_type'] = $ship['shippingFreeType'];
            $shippingType[$key]['free_price_limit'] = $ship['shippingFreeLimit'];
            $shippingType[$key]['is_free'] = $ship['isFree'];
            $subOrder = array();
            foreach($ship['subShipping'] as $sub => $subShip)
            {
                $subOrder[$sub]['shippingPrice'] = $subShip['shippingPrice'];
                $subOrder[$sub]['shippingPriceCut'] = $subShip['shippingPriceCut'];
                $subOrder[$sub]['shippingCost'] = $subShip['shippingPriceCost'];
                $subOrder[$sub]['isArrivedLimitTime'] = $subShip['isArrivedLimitTime'];
                //随心送
                $subOrder[$sub]['isCanXpress'] = $subShip['isCanXpress'];
                $timeAvaiable = array();
                foreach($subShip['calendar'] as $calKey => $calendar)
                {
                    $timeAvaiable[$calKey]['name'] = iconv("utf8", "gbk//IGNORE", $calendar['name']);
                    $timeAvaiable[$calKey]['ship_date'] = $calendar['shipDate'];
                    $timeAvaiable[$calKey]['week_day'] = $calendar['weekDay'];
                    $timeAvaiable[$calKey]['time_span'] = $calendar['timeSpan'];
                    $timeAvaiable[$calKey]['status'] = $calendar['status'];
                }
                $subOrder[$sub]['timeAvaiable'] = $timeAvaiable;
            }
            $shippingType[$key]['subOrder'] = $subOrder;
        }

        $availableInvoices = array(
            'isCanVAT'    => $isCanVATInvoice,
            //如果购物车中有笔记本类商品，需要提示以公司开普通发票，无法保修
            'hasNoteBook' => $hasNoteBook,
            //拉取商品三级分类，判断是否能模糊开票
            'contentOpt'  => self::getInvoicesContentOpt($c3Ids, $whId),
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
        //Logger::info("getDeliveryInfo4Order result:" . ToolUtil::gbJsonEncode($result));
        return $result;
    }

    public static function getDeliveryInfoOrs4Order($items, $inventorys, $whId, $destinationId, $orderPrice, $uid, $userLevel = 0, $scene = SCENE_SHOPPING_PROCESS)
    {
        $dc = self::_getDCByDistrictAndSite($destinationId, $whId, $uid, $scene);
        if(false === $dc)
        {
            Logger::err("getDeliveryInfo4Order _getDCByDistrictAndSite Error![whid:{$whId}][destinationId:{$destinationId}][uid;{$uid}][userLevel:{$userLevel}]items:" . ToolUtil::gbJsonEncode($items)."inventory".ToolUtil::gbJsonEncode($inventorys));
            return false;
        }
        //global $shoppingProcessItil;
        //ItilReport::itil_report($shoppingProcessItil[$scene]['deliveryOrs']['req']);

        $isOrder = "0";
        if(strncmp(SCENE_SHOPPING_ORDER, $scene, 5) == 0)
        {
            $isOrder = "1";
        }
        $deliveryRet = ShippingOperator::getShippingOrsforOrder($whId, $destinationId, $dc, $items, $inventorys, $orderPrice, $uid, $userLevel, 0, $isOrder, $scene);
        if($deliveryRet['code'] == -1)
        {
            //ItilReport::itil_report($shoppingProcessItil[$scene]['deliveryOrs']['failed']);
            self::$errCode = $deliveryRet['code'];
            self::$errMsg = $deliveryRet['msg'];
            Logger::err("getDeliveryInfo4Order getShippingOrsforOrder invoke Failed![whid:{$whId}][destinationId:{$destinationId}][uid;{$uid}][userLevel:{$userLevel}]items:" . ToolUtil::gbJsonEncode($items)."inventory".ToolUtil::gbJsonEncode($inventorys).",deliveryRet".ToolUtil::gbJsonEncode($deliveryRet));
            return false;
        }
        else if($deliveryRet['code'] != 0)
        {
            //ItilReport::itil_report($shoppingProcessItil[$scene]['deliveryOrs']['failed']);
            self::$errCode = $deliveryRet['code'];
            self::$errMsg = $deliveryRet['msg'];
            Logger::err("getDeliveryInfo4Order getShippingOrsforOrder Error![whid:{$whId}][destinationId:{$destinationId}][uid;{$uid}][userLevel:{$userLevel}]items:" . ToolUtil::gbJsonEncode($items)."inventory".ToolUtil::gbJsonEncode($inventorys).",deliveryRet".ToolUtil::gbJsonEncode($deliveryRet));
            return false;
        }
        //ItilReport::itil_report($shoppingProcessItil[$scene]['deliveryOrs']['succ']);
        $deliveryRet = $deliveryRet['data'];
        $orderShipping = $deliveryRet['orderShipping'];
        $orsResult = array();
        foreach($orderShipping as $orsKey => $delivery)
        {
            $packageInfo = $delivery['packageList'];
            $delayInfo = $delivery['delayList'];
            $shipinfo = $delivery['shipinfo'];
            $isCanVATInvoice = $delivery['isCanVAT'] == 0 ? false : true;
            $hasNoteBook = $delivery['hasNoteBook'];
            $totalWeight = $delivery['totalWeight'];
            $totalCut = 0;
            $totalAmt = 0;
            $c3Ids = array();
            $packages = array();
            $shippingType = array();
            foreach($packageInfo as $subKey => $pack)
            {
                $packages[$subKey]['stock_wh_id'] = $pack['stockWhId'];
                $packages[$subKey]['psystock'] = $pack['psyStockId'];
                $packages[$subKey]['wh_id'] = $whId;
                $packages[$subKey]['cross_stock'] = $pack['isCrossStock'];
                $packages[$subKey]['totalWeight'] = isset($pack['sizeInfo']['orderWeight']) ? $pack['sizeInfo']['orderWeight'] : 0;
                $packages[$subKey]['order_size'] = isset($pack['sizeInfo']['orderSize']) ? $pack['sizeInfo']['orderSize'] : 0;
                $packages[$subKey]['order_volume'] = isset($pack['sizeInfo']['orderVolume']) ? $pack['sizeInfo']['orderVolume'] : 0;
                $packages[$subKey]['order_longest'] = isset($pack['sizeInfo']['orderMaxlength']) ? $pack['sizeInfo']['orderMaxlength'] : 0;
                $packages[$subKey]['items'] = array();
                $packItmes = $pack['dwItems'];
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
                                $pkgItems[$pid]['buy_num'] += isset($item['buy_num']) ? $item['buy_num'] : $item['buy_count'];
                                $pkgItems[$pid]['buy_flag'] = (isset($item['buy_flag']) &&  $item['buy_flag'] == 1) ? $item['buy_flag'] : $pkgItems[$pid]['buy_flag'];
                                $pkgItems[$pid]['unit_price'] += $item['total_price_after'];
                                $pkgItems[$pid]['cash_back'] = $pkgItems[$pid]['cash_back'] == 0 ? $item['cash_back'] : $pkgItems[$pid]['cash_back'];
                                $pkgItems[$pid]['item_total_cut'] += $item['item_total_cut'];
                            }
                            else
                            {
                                $pkgItems[$pid] = $item;
                                $pkgItems[$pid]['buy_count'] = $item['buy_count'];
                                $pkgItems[$pid]['buy_num'] = isset($item['buy_num']) ? $item['buy_num'] : $item['buy_count'];
                                $pkgItems[$pid]['buy_flag'] = isset($item['buy_flag']) ? $item['buy_flag'] : 0;
                                $pkgItems[$pid]['unit_price'] = $item['total_price_after'];
                            }
                            $packages[$subKey]['totalAmt'] += $item['total_price_after'];

                            //商品的返现金额的叠加修改 2013-05-22
                            $packages[$subKey]['totalCut'] += $item['item_total_cut'];
                            $totalCut +=$item['item_total_cut'];

                            $totalAmt += $item['total_price_after'];
                            $c3Ids[] = $item['c3_ids'];
                            $item['stock_desc'] = isset($pack['strItems'][$pid]['stockDesc'])
                                && !empty($pack['strItems'][$pid]['stockDesc']) ? $pack['strItems'][$pid]['stockDesc'] : $item['stock_desc'];
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
                $shippingType[$key]['SysNo'] = $ship['sysNo'];
                $shippingType[$key]['ShipTypeID'] = $ship['shipTypeID'];
                $shippingType[$key]['ShipTypeName'] = iconv("utf8", "gbk//IGNORE", $ship['shipTypeName']);
                $shippingType[$key]['ShipTypeDesc'] = iconv("utf8", "gbk//IGNORE", $ship['shipTypeDesc']);
                $shippingType[$key]['PremiumRate'] = $ship['premiumRate'];
                $shippingType[$key]['Status'] = $ship['status'];
                $shippingType[$key]['StatusQueryType'] = $ship['statusQueryType'];
                $shippingType[$key]['StatusQueryUrl'] = $ship['statusQueryUrl'];
                $shippingType[$key]['IsOnlineShow'] = $ship['isOnlineShow'];
                $shippingType[$key]['ShippingId'] = $ship['shippingId'];
                $shippingType[$key]['isCOD'] = $ship['isCOD'];
                $shippingType[$key]['delivery_time'] = $ship['deliveryTime'];
                $shippingType[$key]['shippingPrice'] = $ship['shippingPrice'];
                $shippingType[$key]['shippingPriceCut'] = $ship['shippingCut'];
                $shippingType[$key]['shippingCost'] = $ship['shippingCost'];
                $shippingType[$key]['free_type'] = $ship['shippingFreeType'];
                $shippingType[$key]['free_price_limit'] = $ship['shippingFreeLimit'];
                $shippingType[$key]['is_free'] = $ship['isFree'];
                $subOrder = array();
                foreach($ship['subShipping'] as $sub => $subShip)
                {
                    $subOrder[$sub]['shippingPrice'] = $subShip['shippingPrice'];
                    $subOrder[$sub]['shippingPriceCut'] = $subShip['shippingPriceCut'];
                    $subOrder[$sub]['shippingCost'] = $subShip['shippingPriceCost'];
                    $subOrder[$sub]['isArrivedLimitTime'] = $subShip['isArrivedLimitTime'];
                    $subOrder[$sub]['isCanXpress'] = $subShip['isCanXpress'];
                    $timeAvaiable = array();
                    foreach($subShip['calendar'] as $calKey => $calendar)
                    {
                        $timeAvaiable[$calKey]['name'] = iconv("utf8", "gbk//IGNORE", $calendar['name']);
                        $timeAvaiable[$calKey]['ship_date'] = $calendar['shipDate'];
                        $timeAvaiable[$calKey]['week_day'] = $calendar['weekDay'];
                        $timeAvaiable[$calKey]['time_span'] = $calendar['timeSpan'];
                        $timeAvaiable[$calKey]['status'] = $calendar['status'];
                    }
                    $subOrder[$sub]['timeAvaiable'] = $timeAvaiable;
                }
                $shippingType[$key]['subOrder'] = $subOrder;
            }

            $availableInvoices = array(
                'isCanVAT'    => $isCanVATInvoice,
                //如果购物车中有笔记本类商品，需要提示以公司开普通发票，无法保修
                'hasNoteBook' => $hasNoteBook,
                //拉取商品三级分类，判断是否能模糊开票
                'contentOpt'  => self::getInvoicesContentOpt($c3Ids, $whId),
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

            $orsResult[$orsKey] = $result;
        }
        //Logger::info("getDeliveryInfoOrs4Order result====:" . ToolUtil::gbJsonEncode($orsResult));
        return $orsResult;
    }

    public static function getDeliveryInfo4PlaceOrder($items, $inventorys, $whId, $destinationId, $orderPrice, $uid, $userLevel = 0, $scene = SCENE_SHOPPING_ORDER)
    {
        //Logger::info("getDeliveryInfo4PlaceOrder start![whid:{$whId}][destinationId:{$destinationId}][orderPrice:{$orderPrice}][uid;{$uid}][userLevel:{$userLevel}]items:" . ToolUtil::gbJsonEncode($items)."inventory".ToolUtil::gbJsonEncode($inventorys));
        $dc = self::_getDCByDistrictAndSite($destinationId, $whId, $uid, $scene);
        if(false === $dc)
        {
            Logger::err("getDeliveryInfo4PlaceOrder _getDCByDistrictAndSite Failed![whid:{$whId}][destinationId:{$destinationId}][orderPrice:{$orderPrice}][uid;{$uid}][userLevel:{$userLevel}]items:" . ToolUtil::gbJsonEncode($items)."inventory".ToolUtil::gbJsonEncode($inventorys));
            return false;
        }
        $isOrder = "0";
        if(strncmp(SCENE_SHOPPING_ORDER, $scene, 5) == 0)
        {
            $isOrder = "1";
        }
        //global $shoppingProcessItil;
        //ItilReport::itil_report($shoppingProcessItil[$scene]['delivery']['req']);
        
        $deliveryRet = ShippingOperator::getShippingforPlaceOrder($whId, $destinationId, $dc, $items, $inventorys, $orderPrice, $uid, $userLevel, 0, $isOrder);
        if($deliveryRet['code'] == -1)
        {
            //ItilReport::itil_report($shoppingProcessItil[$scene]['delivery']['failed']);
            self::$errCode = $deliveryRet['code'];
            self::$errMsg = $deliveryRet['msg'];
            Logger::err("getDeliveryInfo4PlaceOrder getShippingforPlaceOrder invoke Failed![whid:{$whId}][destinationId:{$destinationId}][orderPrice:{$orderPrice}][uid;{$uid}][userLevel:{$userLevel}]items:" . ToolUtil::gbJsonEncode($items)."inventory".ToolUtil::gbJsonEncode($inventorys).",deliveryRet:".ToolUtil::gbJsonEncode($deliveryRet));
            return false;
        }
        else if($deliveryRet['code'] != 0)
        {
            //ItilReport::itil_report($shoppingProcessItil[$scene]['delivery']['failed']);
            self::$errCode = $deliveryRet['code'];
            self::$errMsg = $deliveryRet['msg'];
            Logger::err("getDeliveryInfo4PlaceOrder getShippingforPlaceOrder invoke Error![whid:{$whId}][destinationId:{$destinationId}][orderPrice:{$orderPrice}][uid;{$uid}][userLevel:{$userLevel}]items:" . ToolUtil::gbJsonEncode($items)."inventory".ToolUtil::gbJsonEncode($inventorys).",deliveryRet:".ToolUtil::gbJsonEncode($deliveryRet));
            return false;
        }

        //ItilReport::itil_report($shoppingProcessItil[$scene]['delivery']['succ']);
        $deliveryRet = $deliveryRet['data'];
        $delivery = $deliveryRet['orderShipping'];
        $packageInfo = $delivery['packageList'];
        $delayInfo = $delivery['delayList'];
        $shipinfo = $delivery['shipinfo'];
        $isCanVATInvoice = $delivery['isCanVAT'] == 0 ? false : true;
        $hasNoteBook = $delivery['hasNoteBook'];
        $totalWeight = $delivery['totalWeight'];
        $totalCut = 0;
        $totalAmt = 0;
        $c3Ids = array();
        $packages = array();
        $shippingType = array();
        foreach($packageInfo as $subKey => $pack)
        {
            $packages[$subKey]['stock_wh_id'] = $pack['stockWhId'];
            $packages[$subKey]['psystock'] = $pack['psyStockId'];
            $packages[$subKey]['wh_id'] = $whId;
            $packages[$subKey]['cross_stock'] = $pack['isCrossStock'];
            $packages[$subKey]['sale_mode'] = $pack['sellMode'];
            $packages[$subKey]['seller_id'] = $pack['sellerId'];
            $packages[$subKey]['seller_stock_id'] = $pack['sellerStockId'];
            $packages[$subKey]['totalWeight'] = isset($pack['sizeInfo']['orderWeight']) ? $pack['sizeInfo']['orderWeight'] : 0;
            $packages[$subKey]['order_size'] = isset($pack['sizeInfo']['orderSize']) ? $pack['sizeInfo']['orderSize'] : 0;
            $packages[$subKey]['order_volume'] = isset($pack['sizeInfo']['orderVolume']) ? $pack['sizeInfo']['orderVolume'] : 0;
            $packages[$subKey]['order_longest'] = isset($pack['sizeInfo']['orderMaxlength']) ? $pack['sizeInfo']['orderMaxlength'] : 0;

            $packages[$subKey]['items'] = array();
            $packItmes = $pack['dwItems'];
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
                            $pkgItems[$pid]['buy_num'] += isset($item['buy_num']) ? $item['buy_num'] : $item['buy_count'];
                            $pkgItems[$pid]['buy_flag'] = (isset($item['buy_flag']) &&  $item['buy_flag'] == 1) ? $item['buy_flag'] : $pkgItems[$pid]['buy_flag'];
                            $pkgItems[$pid]['unit_price'] += $item['total_price_after'];
                            $pkgItems[$pid]['cash_back'] = $pkgItems[$pid]['cash_back'] == 0 ? $item['cash_back'] : $pkgItems[$pid]['cash_back'];
                        }
                        else
                        {
                            $pkgItems[$pid] = $item;
                            $pkgItems[$pid]['buy_count'] = $item['buy_count'];
                            $pkgItems[$pid]['buy_num'] = isset($item['buy_num']) ? $item['buy_num'] : $item['buy_count'];
                            $pkgItems[$pid]['buy_flag'] = isset($item['buy_flag']) ? $item['buy_flag'] : 0;
                            $pkgItems[$pid]['unit_price'] = $item['total_price_after'];
                        }
                        $packages[$subKey]['totalAmt'] += $item['total_price_after'];
                        $packages[$subKey]['totalCut'] += $item['buy_count'] * $item['cash_back'];
                        $totalCut += $item['buy_count'] * $item['cash_back'];
                        $totalAmt += $item['total_price_after'];
                        $c3Ids[] = $item['c3_ids'];
                        $item['stock_desc'] = isset($pack['strItems'][$pid]['stockDesc'])
                            && !empty($pack['strItems'][$pid]['stockDesc']) ? $pack['strItems'][$pid]['stockDesc'] : $item['stock_desc'];
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
            $shippingType[$key]['SysNo'] = $ship['sysNo'];
            $shippingType[$key]['ShipTypeID'] = $ship['shipTypeID'];
            $shippingType[$key]['ShipTypeName'] = iconv("utf8", "gbk//IGNORE", $ship['shipTypeName']);
            $shippingType[$key]['ShipTypeDesc'] = iconv("utf8", "gbk//IGNORE", $ship['shipTypeDesc']);
            $shippingType[$key]['PremiumRate'] = $ship['premiumRate'];
            $shippingType[$key]['Status'] = $ship['status'];
            $shippingType[$key]['StatusQueryType'] = $ship['statusQueryType'];
            $shippingType[$key]['StatusQueryUrl'] = $ship['statusQueryUrl'];
            $shippingType[$key]['IsOnlineShow'] = $ship['isOnlineShow'];
            $shippingType[$key]['ShippingId'] = $ship['shippingId'];
            $shippingType[$key]['isCOD'] = $ship['isCOD'];
            $shippingType[$key]['delivery_time'] = $ship['deliveryTime'];
            $shippingType[$key]['shippingPrice'] = $ship['shippingPrice'];
            $shippingType[$key]['shippingPriceCut'] = $ship['shippingCut'];
            $shippingType[$key]['shippingCost'] = $ship['shippingCost'];
            $shippingType[$key]['free_type'] = $ship['shippingFreeType'];
            $shippingType[$key]['free_price_limit'] = $ship['shippingFreeLimit'];
            $shippingType[$key]['is_free'] = $ship['isFree'];
            $subOrder = array();
            foreach($ship['subShipping'] as $sub => $subShip)
            {
                $subOrder[$sub]['shippingPrice'] = $subShip['shippingPrice'];
                $subOrder[$sub]['shippingPriceCut'] = $subShip['shippingPriceCut'];
                $subOrder[$sub]['shippingCost'] = $subShip['shippingPriceCost'];
                $subOrder[$sub]['isArrivedLimitTime'] = $subShip['isArrivedLimitTime'];
                $subOrder[$sub]['isCanXpress'] = $subShip['isCanXpress'];
                $timeAvaiable = array();
                foreach($subShip['calendar'] as $calKey => $calendar)
                {
                    $timeAvaiable[$calKey]['name'] = iconv("utf8", "gbk//IGNORE", $calendar['name']);
                    $timeAvaiable[$calKey]['ship_date'] = $calendar['shipDate'];
                    $timeAvaiable[$calKey]['week_day'] = $calendar['weekDay'];
                    $timeAvaiable[$calKey]['time_span'] = $calendar['timeSpan'];
                    $timeAvaiable[$calKey]['status'] = $calendar['status'];
                }
                $subOrder[$sub]['timeAvaiable'] = $timeAvaiable;
            }
            $shippingType[$key]['subOrder'] = $subOrder;
        }

        $availableInvoices = array(
            'isCanVAT'    => $isCanVATInvoice,
            //如果购物车中有笔记本类商品，需要提示以公司开普通发票，无法保修
            'hasNoteBook' => $hasNoteBook,
            //拉取商品三级分类，判断是否能模糊开票
            'contentOpt'  => self::getInvoicesContentOpt($c3Ids, $whId),
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
        Logger::info("getDeliveryInfo4PlaceOrder Result!". ToolUtil::gbJsonEncode($result));
        return $result;
    }

    /**
     * @param $delivery
     * @param $deliveryOrs
     *
     * ?	Ors、前端返回结果全部相同，展示前端默认拆单结果
     * ?	时效最优=最少包裹！=默认；则展示时效最优结果
     * ?	默认=时效最优！=最少包裹或者默认=最少包裹！=时效最优
     *      ?	若最少包裹数>1，则展示时效最优结果
     *      ?	若最少包裹数=1
     *          ?	若时效最优包裹数=1，则展示时效最优结果。
     *          ?	若时效最优包裹数！=1，则默认展示时效最优结果，且展示checkbox，checkbox默认不勾选，
     *                  用户勾选后刷新包裹拆分信息展示最少包裹，取消勾选时恢复展示为时效最优结果。
     *
     */
    public static function getRealDeliveryInfo4Order($delivery, $deliveryOrs)
    {
        if(!isset($deliveryOrs['distance_first'])
            || !isset($deliveryOrs['distance_first']['packages'])
            || !isset($deliveryOrs['split_num_first'])
            || !isset($deliveryOrs['split_num_first']['packages'])
        )
        {
            return array("default" => $delivery);
        }
        $defaultPkg = $delivery['packages'];
        $distanceFirstPkg = $deliveryOrs['distance_first']['packages'];
        $splitNumFirstPkg = $deliveryOrs['split_num_first']['packages'];

        $orsPkgDiff = self::_checkDividedOrder($distanceFirstPkg, $splitNumFirstPkg);
        if($orsPkgDiff)
        {
            /*
            if(self::_checkDividedOrder($defaultPkg, $distanceFirstPkg))
            {
                return array("default" => $delivery);
            }
            else
            {
                return array("distance_first" => $deliveryOrs['distance_first']);
            }
            */
            return array("distance_first" => $deliveryOrs['distance_first']);
        }
        else
        {
            if(count($splitNumFirstPkg) > 1)
            {
                return array("distance_first" => $deliveryOrs['distance_first']);
            }
            if(count($splitNumFirstPkg) == 1)
            {
                if(count($distanceFirstPkg) == 1)
                {
                    return array("distance_first" => $deliveryOrs['distance_first']);
                }
                else
                {
                    return array(
                        "distance_first" => $deliveryOrs['distance_first'],
                        "split_num_first" => $deliveryOrs['split_num_first'],
                    );
                }
            }
        }

        //不会走到这里，返回默认吧
        return array($delivery);
    }

    /**分单逻辑
     * @param $items            商品列表
     * @param $inventorys       库存信息
     * @param $whId             分站ID
     * @param $destinationId    三级地区ID
     * @param int $uid
     * @return array|bool
     */
    public static function setOrderDivide($items, $whId, $destinationId, $uid = 0, $scene = SCENE_SHOPPING_ORDER)
    {
        $dc = self::_getDCByDistrictAndSite($destinationId, $whId, $uid, $scene);
        if(false === $dc)
        {
            Logger::err("setOrderDivide _getDCByDistrictAndSite Failed![whid:{$whId}][destinationId:{$destinationId}][uid;{$uid}],items:" . ToolUtil::gbJsonEncode($items));
            return false;
        }
        //获取商品信息
        $productsIds = self::_getItemsProductIds($items);
        $productsRet = self::getProductsInfo($productsIds, $whId, $destinationId, $uid, $scene);
        if(false == $productsRet)
        {
            Logger::err("setOrderDivide getProductsInfo Failed![whid:{$whId}][destinationId:{$destinationId}][uid;{$uid}],items:" . ToolUtil::gbJsonEncode($items));
            return false;
        }
        $inventorys = $productsRet['inventory'];
        $packRet = ShippingOperator::getShippingPack($whId, $destinationId, $dc, $items, $inventorys, 0, $uid);
        if($packRet['code'] == -1)
        {
            self::$errCode = $packRet['code'];
            self::$errMsg = $packRet['msg'];
            Logger::err("setOrderDivide getShippingPack Failed![whid:{$whId}][destinationId:{$destinationId}][uid;{$uid}],items:" . ToolUtil::gbJsonEncode($items).",packRet:".ToolUtil::gbJsonEncode($packRet));
            return false;
        }
        else if($packRet['code'] != 0)
        {
            self::$errCode = $packRet['code'];
            self::$errMsg = $packRet['msg'];
            Logger::err("setOrderDivide getShippingPack Error![whid:{$whId}][destinationId:{$destinationId}][uid;{$uid}],items:" . ToolUtil::gbJsonEncode($items).",packRet:".ToolUtil::gbJsonEncode($packRet));
            return false;
        }

        $packageInfo = $packRet['data']['packages'];
        $packages = array();
        foreach($packageInfo as $subKey => $pack)
        {
            $packages[$subKey]['items'] = array();
            $packages[$subKey]['psystock'] = $pack['psyStockId'];
            $packItmes = $pack['dwItems'];
            $pkgItems = array();
            foreach($packItmes as $pid => $pItem)
            {
                reset($items);
                foreach($items as $key => $item)
                {
                    if($pid == $item['product_id'])
                    {
                        if(isset($pkgItems[$pid]))
                        {
                            $pkgItems[$pid]['buy_count'] += $item['buy_count'];
                            $pkgItems[$pid]['unit_price'] += $item['total_price_after'];
                        }
                        else
                        {
                            $pkgItems[$pid] = $item;
			                $pkgItems[$pid]['buy_count'] = $item['buy_count'];
                            $pkgItems[$pid]['unit_price'] = $item['total_price_after'];
                        }
                        $packages[$subKey]['totalAmt'] += $item['total_price_after'];
                        $packages[$subKey]['totalCut'] += $item['buy_count'] * $item['cash_back'];
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
        reset($items);
        $result = array(
            "packages" => $packages,
            "items"   => $items,
        );
        return $result;
    }

    public static function getTyingInfo($items, $whId, $destinationId,  $uid = 0, $scene = SCENE_SHOPPING_CART)
    {
        if(empty($items) || is_null($whId) || !is_numeric($whId) || is_null($destinationId) || !is_numeric($destinationId))
        {
            Logger::err("ERR:getTyingInfo para Error![whid:{$whId}][destinationId:{$destinationId}][items:" . ToolUtil::gbJsonEncode($items) . "]");
        }
        //global $shoppingProcessItil;
        //ItilReport::itil_report($shoppingProcessItil[$scene]['tyingMind']['req']);
        $tyingRet = TyingOperator::GetTying($items, $whId, $destinationId, $uid, $scene);
        if($tyingRet['code'] == -1)
        {
            //ItilReport::itil_report($shoppingProcessItil[$scene]['tyingMind']['failed']);
            self::$errCode = $tyingRet['code'];
            self::$errMsg = "随心配接口GetTying调用失败！[errCode:" . self::$errCode ."]";
            Logger::err("getTyingInfo  GetTying invoke Failed![ret:{$tyingRet['code']}][whid:{$whId}][destinationId:{$destinationId}][items:" . ToolUtil::gbJsonEncode($items) . "]");
            return false;
        }
        else if($tyingRet['code'] != 0)
        {
            //ItilReport::itil_report($shoppingProcessItil[$scene]['tyingMind']['failed']);
            self::$errCode = $tyingRet['code'];
            self::$errMsg = "随心配接口GetTying返回错误！[errCode:" . self::$errCode ."]";
            Logger::err("getTyingInfo GetTying Error![result:{$tyingRet['code']}][whid:{$whId}][destinationId:{$destinationId}][items:" . ToolUtil::gbJsonEncode($items) . "]");
            return false;
        }
        //ItilReport::itil_report($shoppingProcessItil[$scene]['tyingMind']['succ']);
        $tyingRet = $tyingRet['data']['checkResult'];
        $tyingEasyMatch = $tyingRet['validTogetherSellMatched'];

        foreach($items as $key => $item)
        {
            if(isset($items[$key]['match_cut']) || $items[$key]['match_num'])
            {
                $items[$key]['item_total_cut'] -= intval($items[$key]['match_cut'])*intval($items[$key]['match_num']);
            }
            $items[$key]['match_cut'] = 0;
            $items[$key]['match_num'] = 0;
        }
        reset($items);
        foreach($items as $key => $item)
        {
            if ($item['main_product_id'] > 0)
            {
                reset($tyingEasyMatch);
                foreach ($tyingEasyMatch as $tyingEM)
                {
                    $matchFlag = false;
                    // 更新商品的 match_cut 字段
                    if ($item['main_product_id'] == $tyingEM['mainProductId'])
                    {
                        //$items[$key]['matchNum']
                        $tyingNum = $tyingEM['mainBuyNum'];
                        $tyingItems = $tyingEM['rulesChecked'];
                        foreach($tyingItems as $tyingItem)
                        {
                            if($item['product_id'] == $tyingItem['subProductId']
                                && $tyingItem['ruleType'] == PRODUCT_TYING_EASY_MATCH
                            )
                            {
                                $cut = intval($tyingItem['discount']);
                                $cut = $cut > 0 ? $cut : 0;
                                if($cut > $item['price'])
                                {
                                    $cut = 0;
                                    Logger::warn("warnning!商品{$item['product_id']}]随心配优惠金额[{$cut}]大于商品价格[{$item['price']}]");
                                }
                                $items[$key]['match_cut'] = $cut;
                                $items[$key]['match_num'] = intval($tyingItem['buyNum']);
                                $matchFlag = true;
                                break;
                            }
                        }
                        if($matchFlag)
                        {
                            break;
                        }
                    }
                }
            }
            //给商品一个统一的返现金额
            $items[$key]['item_total_cut'] += ($items[$key]['match_cut'] * $items[$key]['match_num']) ;
        }
        //Logger::info("getTyingInfo " .ToolUtil::gbJsonEncode($items));
        $result = array(
            "items" => $items
        );
        return $result;
    }

    public static function setLockInventory($uid, $inventorysAllData)
    {
        global $_UIN_INVENTORY_WHITE_LIST;
        if(!$_UIN_INVENTORY_WHITE_LIST['flag'])
        {
            return true;
        }
        $lockedInventory = array();
        foreach($inventorysAllData as $inventoryData)
        {
            $inventoryRet = UniInventoryOperator::LockProductInventory($uid, $inventoryData);
            if($inventoryRet['code'] == -1)
            {
                //库存锁定失败
                self::$errCode = $inventoryRet['code'];
                self::$errMsg = $inventoryRet['msg'];
                $result = array(
                    'errCode' => $inventoryRet['ret'],
                    'lockedInventory' => $lockedInventory,
                );
                self::Log("setLockInventory failed[time out][lockedInventory:" . ToolUtil::gbJsonEncode($lockedInventory) . "]", false, "uniinventory");
                Logger::err("setLockInventory LockProductInventory time out![resp:" . ToolUtil::gbJsonEncode($inventoryRet));
                return $result;
            }
            else if($inventoryRet['code'] != 0)
            {
                //库存锁定失败
                self::$errCode = $inventoryRet['code'];
                self::$errMsg = $inventoryRet['msg'];
                $result = array(
                    'errCode' => self::$errCode,
                    'lockedInventory' => $lockedInventory,
                );
                self::Log("setLockInventory failed![error][lockedInventory:" . ToolUtil::gbJsonEncode($lockedInventory) . "]", false, "uniinventory");
                Logger::err("setLockInventory LockProductInventory error![resp:" . ToolUtil::gbJsonEncode($inventoryRet));
                return $result;
            }
            $lockedInventory[] = $inventoryData;
        }

        $result = array(
            'errCode' => 0,
            'lockedInventory' => $lockedInventory,
        );
    }

    public static function setUnlockInventory($uid, $inventorysAllData)
    {
        global $_UIN_INVENTORY_WHITE_LIST;
        if(!$_UIN_INVENTORY_WHITE_LIST['flag'])
        {
            return true;
        }
        if(empty($inventorysAllData))
        {
            return true;
        }
        foreach($inventorysAllData as $key => $inventoryData)
        {
            $inventoryRet = UniInventoryOperator::UnlockProductInventory($uid, $inventoryData);
            if($inventoryRet['code'] == -1)
            {
                //库存锁定失败
                self::$errCode = $inventoryRet['code'];
                self::$errMsg = $inventoryRet['msg'];
                self::Log("setUnlockInventory failed![time out][unlockedInventory:" . ToolUtil::gbJsonEncode($inventorysAllData) ."]", false, "uniinventory");
                Logger::err("setLockInventory setUnlockInventory failed![resp:" . ToolUtil::gbJsonEncode($inventoryRet));
                return false;
            }
            else if($inventoryRet['code'] != 0)
            {
                //库存锁定失败
                self::$errCode = $inventoryRet['code'];
                self::$errMsg = $inventoryRet['msg'];
                self::Log("setUnlockInventory failed![error][unlockedInventory:" . ToolUtil::gbJsonEncode($inventorysAllData) ."]", false, "uniinventory");
                Logger::err("setLockInventory setUnlockInventory error![resp:" . ToolUtil::gbJsonEncode($inventoryRet));
                return false;
            }
            unset($inventorysAllData[$key]);
        }

        return true;
    }

    /**
     * 获取所有支付方式
     * @param $shippingType
     * @param $wh_id
     * @param $productidArr
     * @param $userType
     * @param $cartType
     * @param $uid
     */
    public static function getAllPayTypeInfo($shippingType, $wh_id, $productidArr, $userType, $cartType, $uid)
    {
        $payTypeRet = PayTypeOperator::GetAllPayTypeInfo($shippingType, $wh_id, $productidArr, $userType, $cartType, $uid);
        if($payTypeRet['code'] == -1)
        {
            //获取支付超时
            self::$errCode = $payTypeRet['code'];
            self::$errMsg = $payTypeRet['msg'];
            Logger::err("PayTypeOperator GetAllPayTypeInfo invoke Failed![payTypeRet:" . ToolUtil::gbJsonEncode($payTypeRet));
            return false;
        }
        else if($payTypeRet['code'] != 0)
        {
            //获取支付失败
            self::$errCode = $payTypeRet['code'];
            self::$errMsg = $payTypeRet['msg'];
            Logger::err("PayTypeOperator GetAllPayTypeInfo invoke Error![payTypeRet:" . ToolUtil::gbJsonEncode($payTypeRet));
            return false;
        }
        //处理支付返回的数据
        $payTypeInfo = $payTypeRet['data']['payTypeInfo'];
        $payTypeList = $payTypeInfo['payTypeList'];
        $installmentConfigList = $payTypeInfo['installmentConfigList'];

        $formatPayType = self::_getFormatPayType($payTypeList);
        $formatInstallment = self::_getFormatInstallment($installmentConfigList);

        $data['payTypeData'] = $formatPayType;
        global $_INSTALLMENT_SWITCH;
        $data['installmentConfigData'] = array();
        if($_INSTALLMENT_SWITCH && count($productidArr) < 2 || !$_INSTALLMENT_SWITCH)
        {
            $data['installmentConfigData'] = $formatInstallment;
        }

        return array(
            'errCode'	=> 0,
            'errMsg'	=> '',
            'data'	=> $data,
        );
    }
    //GetPayTypeInfo($payTypeId, $shippingType, $whId = 1, $productidArr = array(), $userType = false, $cartType = 0, $uid = 0) {
    public static function getPayTypeInfo($payTypeId, $shippingType, $whId, $productidArr = array(), $userType = false, $cartType = 0, $uid = 0)
    {
        $payTypeRet = PayTypeOperator::GetPayTypeInfo($payTypeId, $shippingType, $whId, $productidArr, $userType, $cartType, $uid);
        if($payTypeRet['code'] == -1)
        {
            //获取支付超时
            self::$errCode = $payTypeRet['code'];
            self::$errMsg = $payTypeRet['msg'];
            Logger::err("PayTypeOperator GetPayTypeInfo invoke Failed![ret:" . ToolUtil::gbJsonEncode($payTypeRet));
            return false;
        }
        else if($payTypeRet['code'] != 0)
        {
            //获取支付失败
            self::$errCode = $payTypeRet['code'];
            self::$errMsg = $payTypeRet['msg'];
            Logger::err("PayTypeOperator GetPayTypeInfo invoke Error![ret:" . ToolUtil::gbJsonEncode($payTypeRet));
            return array(
                'errCode'	=> $payTypeRet['code'],
                'errMsg'	=> '',
                'data'	=> array(),
            );
        }
        //处理支付数据
        $payTypeInfo = $payTypeRet['data']['payTypeInfo'];
        $payTypeList = $payTypeInfo['payTypeList'];
        $installmentConfigList = $payTypeInfo['installmentConfigList'];

        $formatPayType = self::_getFormatPayType($payTypeList);
        $formatInstallment = self::_getFormatInstallment($installmentConfigList);
        $data['payTypeData'] = $formatPayType;
        $data['installmentConfigData'] = $formatInstallment;

        return array(
            'errCode'	=> 0,
            'errMsg'	=> '',
            'data'	=> $data,
        );
    }


    public static function getUserPoint($uid)
    {
        if(is_null($uid) || !is_numeric($uid))
        {
            Logger::err("getUserPoint Para Error!");
            return false;
        }
        $pointRet = PointOperator::GetUserPoints($uid);
        if($pointRet['code'] == -1)
        {
            self::$errCode = $pointRet['code'];
            self::$errMsg = $pointRet['msg'];
            Logger::err("getUserPoint invoke failed![time out][uid:{$uid}][piontRet:" . ToolUtil::gbJsonEncode($pointRet));
            return false;
        }
        else if($pointRet['code'] != 0)
        {
            self::$errCode = $pointRet['code'];
            self::$errMsg = $pointRet['msg'];
            Logger::err("getUserPoint invoke Error![error][uid:{$uid}][piontRet:" . ToolUtil::gbJsonEncode($pointRet));
            return false;
        }

        $pointRet = $pointRet['data']['pointsAccountPo'];
        $userPoint = array(
            'cash_point'        => intval($pointRet['cashPoints']),
            'promotion_point'   => intval($pointRet['promotionPoints']),
            'point'             => intval($pointRet['totalAvailablePoints']),
            'valid_point'       => intval($pointRet['totalAvailablePoints']),
        );

        return $userPoint;
    }

    public static function getInvoicesContentOpt($c3ids, $wh_id)
    {
        $contentOpt = array('1'); //默认值
        $isCanFuzzyInvoice = true;

        if ($wh_id == SITE_SH || $wh_id == SITE_BJ) {
            $c3Info = ICategoryTTC::gets($c3ids, array('level' => 3, 'status' => 0), array('parent_id', 'flag')); //获取小类ID
            if (is_array($c3Info)) { //成功
                $c2ids = array();
                foreach ($c3Info as $c3) {
                    if (($c3['flag'] & FUZZY_INVOICE) != FUZZY_INVOICE) { //不可以模糊开票
                        $isCanFuzzyInvoice = false;
                        break;
                    }
                    else {
                        $c2ids[] = $c3['parent_id'];
                    }
                }

                if ($isCanFuzzyInvoice && (! empty($c2ids))) {
                    $c2ids = array_unique($c2ids);
                    $c2Info = ICategoryTTC::gets($c2ids, array('level' => 2, 'status' => 0), array('parent_id'));
                    if (is_array($c2Info)) {
                        $_FuzzyInvoiceConf = EA_Invoice::$_FuzzyInvoiceConf;
                        foreach ($c2Info as $c2) {
                            if (isset($_FuzzyInvoiceConf[intval($c2['parent_id'])])) {
                                $contentOpt = array_merge($contentOpt, $_FuzzyInvoiceConf[intval($c2['parent_id'])]);
                            }
                        }
                    }
                    $contentOpt = array_unique($contentOpt);
                }
            }
        }

        // contentOpt 中可能有重复的元素被unique删除了，需要重新排序，否则json返回的时候用的是key-value的格式，在ios上会出错
        sort($contentOpt);

        $ret = array();
        foreach($contentOpt as $k) {
            if (isset(EA_Invoice::$_FuzzyInvoiceMap[$k])) {
                $ret[] = EA_Invoice::$_FuzzyInvoiceMap[$k];
            }
        }

        return $ret;
    }

    /**预约机信息检查
     * @param $items            商品列表
     * @param $whId             分站ID
     * @param $products         商品信息列表
     * @return bool
     * ps：此次更新时，把名称首字母改成小写
     */
    public static function SetAppoint($items, $whId, $products) {
        //Logger::info(var_export($products, true));
        $now = time();
        // 获取带有预购属性的商品
        $appointProducts = array(); //IPreOrderV2::$appointProduct;

        foreach($products as $p) {
            if(($p['flag'] & APPOINT_PRODUCT) == APPOINT_PRODUCT) {
                $appointProducts[] = $p['product_id'];
            }
        }
        if(empty($appointProducts))
        {
            return $items;
        }
        // TODO
        $appointInfos = EA_Promotion::getAppointInfo($appointProducts, $whId);
        if(false === $appointInfos) {
            self::$errCode = EA_Promotion::$errCode;
            self::$errMsg = EA_Promotion::$errMsg;
            return false;
        }
        foreach($items as $key=> $item) {
            $pid = $item['product_id'];
            if(!isset($appointInfos[$pid])) {
                continue;
            }

            $appinfo = $appointInfos[$pid];
            $event_id = $appinfo["eventid"];
            $items[$key]['event_id'] = $event_id;

            // 可预约时间段
            $items[$key]['order_time_from'] = $appinfo['order_time_from'];
            $items[$key]['order_time_to'] = $appinfo['order_time_to'];

            // 可购买的时间段
            $items[$key]['buy_time_from'] = $appinfo['buy_time_from'];
            $items[$key]['buy_time_to'] = $appinfo['buy_time_to'];


            // 库存描述
            $items[$key]['stock_desc'] = $items[$key]['stock_desc'] . "(预购)";
        }

        return $items;
    }

    /** 限购统一处理逻辑
     * @param $items
     * @param $products
     * @param $order
     * @param int $uid
     * @return bool
     * ps:这里将原有的两种限购逻辑统一在一起处理
     */
    public static function checklimitProduct($items,$products, $order,$uid=0){
        $limitedProduct = array();
        $limitedProuductName = "";
        $isLimited = false;
        foreach($items as $key =>$value)
        {
            //检查商品限购
            if(isset($value['num_limit']) ) {
                $stockLimit = ($value['num_limit'] <= 0) ? IShoppingCartV2::MAX_COUNT_PER_ITEM : (int) $value['num_limit'];
                if($value['buy_count'] > $stockLimit) {
                    $isLimited = true;
                    $limitedProuductName = $value['name'];
                    $limitedProuductNum = $stockLimit;
                    break;
                }
            }

            //检查多价限购
            if(isset($value['price_buy_limit_flag']) && isset($value['mult_limit_num'])) {
                if(1 == $value['price_buy_limit_flag'] &&($value['buy_count'] >$value['mult_limit_num'])) {
                    $isLimited = true;
                    $limitedProuductName = $value['name'];
                    $limitedProuductNum = $value['mult_limit_num'];
                    break;
                }
            }

            if($value['num_limit'] > 0 && $value['num_limit']< IShoppingCartV2::MAX_COUNT_PER_ITEM) {
                $limitedProduct[] = $value['product_id'];
            }
        }
        //已经被限购住了
        if(true == $isLimited) {
            self::$errMsg = "购物车中商品{$limitedProuductName}，超过限购数量{$limitedProuductNum}，请返回购物车修改您的产品购买数量。";
            self::$errCode = 101;
            return false;

        }
        //如果购物车中商品有限购商品，则查询该用户当天的订单
        if($uid > 0) {
            $ret = IOrder::checkLimitOrder($uid, $limitedProduct, $order['items']);
            if($ret === false) {
                self::$errMsg = IOrder::$errMsg;
                self::$errCode = IOrder::$errCode;
                self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ",errMsg:查询限购信息失败，" . IOrder::$errMsg;
                return false;
            }
        }
        return true;
    }

    public static function checklimitProductNew($items, $products, $uid=0){
        $limitedProduct = array();
        foreach($items as $key =>$value)
        {
            //检查商品限购
            if(isset($value['num_limit']) )
            {
                $stockLimit = ($value['num_limit'] <= 0) ? IShoppingCartV2::MAX_COUNT_PER_ITEM : (int) $value['num_limit'];
                if($value['buy_count'] > $stockLimit) {
                    $items[$key]['buy_count'] = $stockLimit;
                    $items[$key]['buy_flag'] = 1;
                }
            }

            //检查多价限购
            if(isset($value['price_buy_limit_flag']) && isset($value['mult_limit_num'])) {
                if(1 == $value['price_buy_limit_flag'] &&($value['buy_count'] >$value['mult_limit_num'])) {
                    $items[$key]['buy_count'] = $value['mult_limit_num'];
                    $items[$key]['buy_flag'] = 1;
                }
            }

            if($value['num_limit'] > 0 && $value['num_limit']< IShoppingCartV2::MAX_COUNT_PER_ITEM) {
                $limitedProduct[] = $value['product_id'];
            }
        }

        //如果购物车中商品有限购商品，则查询该用户当天的订单
        if($uid > 0) {
            reset($items);
            $ret = self::checkLimitOrder($uid, $limitedProduct, $items);
            if($ret === false) {
                return array("items" => $items);
            }
            $items = $ret['items'];
        }
        return array("items" => $items, "limitedProduct" => $limitedProduct);;
    }

    public static function checkLimitOrder($uid, $limitedProduct, $items)
    {
        // 如果限单的商品为空，则不检查
        if (empty($limitedProduct))
        {
            return array("items" => $items);
        }
        global $_OrderState;
        $timestamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');

        $sql = "SELECT product_id, sum(buy_num) as buy_num
						FROM t_order_items_{$db_tab_index['table']} ot, t_orders_{$db_tab_index['table']} o
						WHERE o.order_char_id = ot.order_char_id
							AND o.status <> {$_OrderState['ManagerCancel']['value']}
							AND o.status <> {$_OrderState['CustomerCancel']['value']}
							AND o.status <> {$_OrderState['EmployeeCancel']['value']}
							AND ot.uid = {$uid}
							AND create_time > {$timestamp}
							AND product_id in(" . implode(',', $limitedProduct) . ")
				GROUP BY product_id";

        $orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
        $userOrder = $orderDb->getRows($sql);
        if (false === $userOrder) {
            self::$errCode = $orderDb->errCode;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[query order db failed]' . $orderDb->errMsg;
            return false;
        }

        if (!empty($userOrder)) {
            foreach ($userOrder as $order) {
                foreach ($items as $key=>$item) {
                    if ($item['product_id'] == $order['product_id']) {
                        if ($item['buy_count'] + $order['buy_num'] > $item['num_limit']) {
                            $items[$key]['buy_count'] = ($item['num_limit'] - $order['buy_num']) > 0 ? ($item['num_limit'] - $order['buy_num']) : 0;
                            $items[$key]['buy_flag'] = 1;
                        }
                        break;
                    }
                }
            }
        }

        return array("items" => $items);
    }
    /**
     * 设置错误码和错误信息
     * @param mixed $mix error code or class name
     * @param string $msg
     * @return null
     */
    private static function setErr($mix, $msg = '')
    {
        if (is_numeric($mix)) {
            self::$errCode = $mix;
            self::$errMsg = $msg;
        } else if (class_exists($mix)) {
            $vars = get_class_vars($mix);
            if (isset($vars['errCode'])) {
                self::$errCode = $vars['errCode'];
                self::$errMsg = $vars['errMsg'];
            }
        }
    }

    /**
     * @param $str 下单记录日志
     * @param string $folder 记录到的文件夹，默认为order，在机器上的路径为 /data/logs/order/，里面的文件按日期命名，没有后缀
     * @param bool $backtrace 是否需要跟踪路径，默认true
     */
    /**
     * @param $str  日志信息
     * @param bool $backtrace 是否需要跟踪路径，默认true
     * @param string $folder 记录到的文件夹，默认为order，在机器上的路径为 /data/logs/shoppingprocess/，里面的文件按日期命名，没有后缀
     */
    public static function Log($str, $backtrace = true, $folder = "shoppingprocess")
    {
        EL_Flow::getInstance("{$folder}")->append($str, $backtrace);
    }
}

class ItilReport{
    /**
     * 累加型上报ITIL接口
     * @param $attId 申请的累加型Itil接口
     * @param $increase 统计增量
     * @param $shmKey 要挂载的共享内存key
     *
     * @return true/false
     *         1：打开共享内存失败
     *         2: 解析数据出错
     *         3：共享内存占满
     */
    public static function itil_report($attId, $increase = 1)
    {
        if(function_exists('exd_Attr_API2'))
        {
            if(!is_null($attId) && is_numeric($attId))
            {
                $dataTemp = exd_Attr_API2($attId, $increase);
                return ($dataTemp != 0 ) ? false : true;
            }
        }
        return true;
    }
}
