<?php
require_once(PHPLIB_ROOT . 'inc/district.inc.php');
require_once(PHPLIB_ROOT . 'inc/ship.inc.php');
/**
	900:目的地编码不合法
	901:目的地没有父城市id
	902:运送方式不合法
	903:使用优惠卷的用户id不合法
	904:优惠券编码不合法
	905:支付方式不合法
	906:优惠券不可用
	907:订单金额不足以使用优惠券
	908:积分数量不合法
	909:用户不存在
	910:用户积分不足
*/
class IWPreOrder {
	public static $errCode = 0;
	public static $errMsg = '';
	public static $logMsg = '';

	// 根据用户类型，支付方式会稍有不同
	const USER_TYPE_ALI = 'ali'; //支付宝普通
	const USER_TYPE_ALI_GOLDEN = 'ali_golden'; //支付宝金账户
	const USER_TYPE_SHCAR = 'shcar'; //上汽

	//以下几个特殊配置，需跟线上保持一致，不然会出问题
	public static $PAYTYPE_ALI_ONLY = array(17,18,19,20,21); //支付宝用户只有这几个
	public static $PAYTYPE_ALI_GOLDEN_ONLY = array(21); //支付宝金账户只有这1个
	public static $PAYTYPE_SHCAR_ONLY = array(73); //仅供上汽用户

	public static $testuid = array(
		2252412,
		30558076
	);

    //$product_id_wireless: 如果传入合法值，代表是无线一键购买
    public static function getShippingTypeNotAviable($uid, $destination, $wh_id=1, $product_id_wireless = -1) {
        if (!isset($uid) || $uid <= 0) {
            self::$errCode = 101;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
            return false;
        }
        if (!isset($destination) || $destination <= 0) {
            self::$errCode = 105;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "destination($destination) is invalid";
            return false;
        }

        if ($product_id_wireless > 0) {
            $items = array(0 => array( 'product_id' => $product_id_wireless));
        }
        else {
            $items = IShoppingCart::get($uid);
            if (false === $items) {
                self::$errCode = IShoppingCart::$errCode;
                self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IShoppingCart failed]' . IShoppingCart::$errMsg;
                return false;
            }
        }

        $productIds = array();
        foreach ($items as $key => $item) {
            if ($item['product_id'] > 0) {
                $productIds[] = $item['product_id'];
            }
            else {
                $deleteProductIds[] = $item['product_id'];
                unset($items[$key]);
            }
        }

        //拉取商品信息
        $products = IProductInfoTTC::gets($productIds, array('status'=>PRODUCT_STATUS_NORMAL, 'wh_id'=>$wh_id),array('product_id','restricted_trans_type'));
        if (false === $products) {
            self::$errCode = IProductTTC::$errCode;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductTTC failed]' . IProductTTC::$errMsg;
            return false;
        }
        $forbidenShip = array();
        $deleteProductIds = array();
        foreach ($items as $key => $item) {
            $exist = false;
            foreach ($products as $product) {
                if ($item['product_id'] == $product['product_id']) {
                    $exist = true;
                    $forbidenShip[$product['restricted_trans_type']][] = $product['product_id'];
                    break;
                }
            }
            if (false === $exist) {
                $deleteProductIds[] = $item['product_id'];
            }
        }


        $shipNotAvaialbe = array();
        if (!empty($forbidenShip)) {
            global $_District;
            $shipNotAvaialbe = IShipping::getForbidenShippingType($forbidenShip, $_District[$destination]['province_id'],  $_District[$destination]['city_id'],$destination, $wh_id);
        }

        //如果不包含这些特殊商品，需要剔除自提
        global $_SelfFetchProductids;
        $bothExist = array_intersect($_SelfFetchProductids, $productIds);
        if (count($bothExist) == 0) {
            global $_LGT_MODE;
            foreach ($_LGT_MODE as $lgt) {
                if (false === strpos($lgt['ShipTypeName'], '上门提货')) {
                    continue;
                }
                if (isset($shipNotAvaialbe[$lgt['SysNo']])) {
                    continue;
                }
                $shipNotAvaialbe[$lgt['SysNo']] = array();
            }
        }

        //删除不合法的购物车商品
        foreach ($deleteProductIds as $id) {
            if ($product_id_wireless == -1) {
                //IShoppingCart::removeCart($uid, array('product_id'=>$id));
                IShoppingCart::remove($uid,$id);
            }
        }
        return $shipNotAvaialbe;
    }

    /*
    商品详情链接，或者加入购物车连接后面带上   edm=xxxxxx，则需要记录该串，并传入到此
    格式"code1_productid1,code2_productid2"

    $rule_id :  如果用户在购物车页面选择了促销规则，则需要传入其选择的促销规则id
    $apply_times:如果促销规则是换购，或者赠送商品，则需要传入apply_times：规则累计次数
    $product_id_wilreless: 如果传入此参数，说明是来自无线的一键购买
    $buy_count_wireless:  无线一键购买，购买商品的数量
     */
    public static function getItemsInShoppingCart($uid , $wh_id=1, $open_id='', $rule_id=0, $apply_times=999, $product_id_wilreless = -1, $buy_count_wireless=0,$is_es=false, $esitems=array(),$wire_less_para = array()) {
        if (!isset($uid) || $uid <= 0) {
            self::$errCode = 101;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
            return false;
        }
        $items = array();
        if ($product_id_wilreless > 0 && $buy_count_wireless > 0) {  //无线一键购买
            $items = array (
                0 => array (
                    'product_id' => $product_id_wilreless,
                    'buy_count' => $buy_count_wireless,
                    'main_product_id' => !empty($wire_less_para['main_product_id']) ? $wire_less_para['main_product_id'] : 0,
                    'price_id' => !empty($wire_less_para['price_id']) ? $wire_less_para['price_id'] : 0,
                )
            );
        }
        else if ( $is_es && !empty($esitems) ) { // 节能补贴商品
            foreach($esitems as $item) {
                $items[] = array (
                    'product_id' => $item['product_id'],
                    'buy_count' => 1,
                    'main_product_id'=> 0,
                    'price_id'=> 0,
	                'type' => 0,
                );
            }
        }
        else {
            $items = IShoppingCart::get($uid);
            if (false === $items) {
                self::$errCode = IShoppingCart::$errCode;
                self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IShoppingCart failed]' . IShoppingCart::$errMsg;
                return false;
            }
        }

	    $items = IShoppingCart::filterPackageItems($items);

        //拉取促销规则，因为有可能促销规则是赠送商品，或者换购，可以与购物车中其他商品一起检查库存等逻辑
        $promotion = array();
        if ($rule_id > 0) {
            if ($apply_times <= 0) {
                self::$errCode = -990;
                self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "[Promotion Rule apply_times($apply_times) is invalid]";
            }
            else {
                $promotionRule = IPromotionRule::checkRuleForOrder($items,$wh_id, $uid, $rule_id, $apply_times);
                if (false === $promotionRule ) {
                    Logger::err("checkRuleForOrder failed:" . IPromotionRule::$errMsg);
                }
                else {
                    $promotionRule = json_decode($promotionRule, true);
                    if (is_array($promotionRule)) {
                        if ($promotionRule['errCode'] == -2007) {
                            self::$errCode = -991;
                            self::$errMsg = "促销资源不足";
                        }
                        else if ($promotionRule['errCode'] != 0 || !isset($promotionRule['rules'][0])) {//拉取促销规则失败
                            self::$errCode = $promotionRule['errCode'];
                            self::$errMsg = $promotionRule['errMsg'];
                        }
                        else {
                            //还需要检测该用户已经使用该规则的次数
                            if ( $promotionRule['rules'][0]['apply_time_peruser'] < 999) {
                                $db_tab_index = ToolUtil::getMSDBTableIndex($uid,'ICSON_ORDER_CORE');
                                $orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
                                if (!empty($orderDb)) {
                                    $sql = "select order_char_id from t_orders_{$db_tab_index['table']} where uid=$uid and coupon_code='rule_{$rule_id}' and status >= 0";
                                    $count = $orderDb->getRows($sql);
                                    if (is_array($count) && count($count) >= $promotionRule['rules'][0]['apply_time_peruser']) {
                                        self::$errCode = -992;
                                        self::$errMsg = "您已经参加过次促销优惠" . count($count) . "次，不能再参加";
                                    }
                                    else {
                                        $promotion = $promotionRule['rules'][0];
                                    }
                                }

                                $promotion = $promotionRule['rules'][0];
                            }
                            else {
                                $promotion = $promotionRule['rules'][0];
                            }

                            $promotion['benefits'] = 0;
                            //如果是换购，赠送商品，则需要在items添加一条记录
                            if ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_HUANGOU'] ||
                                $promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_PRODUCT']) {
                                $promotionGiftProduct = array(
                                    'product_id'=>$promotion['discount'],
                                    'buy_count' => $promotion['benefit_per_time'] * $promotion['benefit_times'],
                                    'main_product_id' => 0,
                                    'createtime' => 0,
                                    'isPromotionGift'=>true,
                                );
                                $items[] = $promotionGiftProduct;
                            }
                            else if ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_CASH']) {
                                $promotion['benefits'] = $promotion['benefit_times'] * $promotion['benefit_per_time'];
                            }
                            else if ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_DISCOUNT']) {
                                $promotion['benefits'] = $promotion['discount'];
                            }
                        }
                    }
                }
            }
        }

        // 计算随心配搭配的数量
        foreach ($items as &$it) {
            $it['matchNum'] = 0;
            if ($it['main_product_id'] == 0) {
                continue;
            }

            $mainProductExist = false;
            foreach ($items as $iit) {
                if ($iit['product_id'] == $it['main_product_id']) {
                    $mainProductExist = true;
                    $it['matchNum'] = $it['buy_count'] < $iit['buy_count']?  $it['buy_count'] : $iit['buy_count'];
                }
            }
            if (false === $mainProductExist) {
                $it['main_product_id'] = 0;
            }
        }

        $deleteProductIds = array();
        $productIds = array();
        $multiPriceProduct = array();
        foreach ($items as $key => $item) {
            if ($item['product_id'] > 0) {
                $productIds[] = $item['product_id'];
                if ($item['price_id'] > 0) {   //如果是取特殊价格
                    $multiPriceProduct[$item['product_id']]['price_id'] = $item['price_id'];
                    $multiPriceProduct[$item['product_id']]['multiPriceType'] = 0; //默认都没有特殊价格
                }
            }
            else {
                $deleteProductIds[] = $item['product_id'];
                unset($items[$key]);
            }
        }

        // 拉取商品信息
        $products = IProduct::getProductsInfo($productIds, $wh_id, true);
        if (false === $products) {
            self::$errCode = IProduct::$errCode;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProduct failed]' . IProduct::$errMsg;
            return false;
        }

        //处理多价格信息
        if (count($multiPriceProduct) > 0) {
            foreach ($multiPriceProduct as $pid => $mp) {
                if (isset($products[$pid])) {
                    $multiPriceProduct[$pid]['multiPriceType'] = $products[$pid]['multiprice_type'];
                }
            }

            $multiPriceInfo = IMultiPrice::getCartPrices(array('wh_id'=>$wh_id, 'product'=>$multiPriceProduct));
            if (isset($multiPriceInfo['Prices']) && is_array($multiPriceInfo['Prices'])) {
                foreach ($multiPriceInfo['Prices'] as $pid => $mp) {
                    if ($mp['isSatisfy'] == true && isset($products[$pid])) { //满足多价信息
                        if ($mp['count_type'] == MP_COUNT_BY_DISCOUNT) {  //折扣
                            $products[$pid]['price'] = 10 * bcdiv($products[$pid]['price'] * $mp['price'], 1000,0);
                        }
                        else if ($mp['count_type'] == MP_COUNT_BY_PRICE) {
                            $products[$pid]['price'] = $mp['price'];
                        }
                    }
                }
            }
        }

        // 解析 edm 价格专享字段
        $needToCheckVIP = false;
        $edmCodeToProduct = array();
        $userInfo = array();
        if (isset($_COOKIE['edm']) && $_COOKIE['edm'] != '') {
            $edmArr = explode(",",$_COOKIE['edm']);
            foreach ($edmArr as $ll) {
                $tmp = explode('_', $ll);
                if (isset($tmp[0]) && isset($tmp[1])) {
                    if ($tmp[0] == 'ttpgn'  //功能性tips验证特殊EDM代码
                        && (!isset($_COOKIE['edm_key'])
                            || !isset($_COOKIE['new_u'])
                            || (substr(md5($open_id . "icson@qq"), 0 , 6) != $_COOKIE['edm_key'])
                            || $_COOKIE['new_u'] != '1' ))  {

                        continue;
                    }

                    $edmCodeToProduct[] = array('code'=>$tmp[0], 'product_id'=>$tmp[1]);
                    if ($tmp[0] == 'QQVIP0326') {
                        $needToCheckVIP = true;
                    }
                }
            }
        }

        if (count($edmCodeToProduct) > 0) {
            $isVip = false;
            if ($needToCheckVIP === true) {
                $isVip = IUser::checkQQVip($uid);
            }

            //拉取edm专享价格
            $MSDB = Config::getMSDB('ERP_' . $wh_id);
            if (false === $MSDB) {
                self::$errCode = Config::$errCode;
                self::$errMsg = Config::$errMsg;
                return false;
            }

            $now = date('Y-m-d H:i:s');
            $sql = "SELECT EDMCode,
									ProductSysNo,
									EDMPrice,
									IsMobileVerification,
									IsEmailVerification,
									MemberLevelRange
						FROM EDM_Privileges
						WHERE EDMStatus=1
							AND StartDate <='{$now}'
							AND EndDate >='{$now}'
							AND ProductSysNo in(-1";
            foreach ($edmCodeToProduct as $ep) {
                if ($needToCheckVIP === true && $isVip === false && $ep['code'] == 'QQVIP0326') {
                    continue;
                }
                $sql .= "," . $ep['product_id'];
            }
            $sql .= ")";

            $edmItems = $MSDB->getRows($sql);
            if (false === $edmItems) {
                self::$errCode = $MSDB->errCode;
                self::$errMsg = $MSDB->errMsg;
                return false;
            }

            $isEmailVerify = 0;
            $isTelVerify = 0;
            $needLevel = 0;
            foreach ($edmItems as $key => $ei) {
                $exist = false;

                foreach ($edmCodeToProduct as $ep) {
                    if ($ep['code'] == $ei['EDMCode'] && $ep['product_id'] == $ei['ProductSysNo']) {
                        $isEmailVerify == 0? ($isEmailVerify = $ei['IsEmailVerification']) : '';
                        $isTelVerify == 0? ($isTelVerify = $ei['IsMobileVerification']) : '';
                        if ($needLevel == 0 && $ei['MemberLevelRange'] != '') {
                            $needLevel = 1;
                        }
                        $exist = true;
                        break;
                    }
                }
                if (false === $exist) {
                    unset($edmItems[$key]);
                }
            }

            $userLevel = 0;
            $userBindEmail = 0;
            $userBindMobile = 0;
            if ($isEmailVerify == 1 || $isTelVerify ==1 || $needLevel == 1) {
                $userInfo = IUsersTTC::get($uid,array(), array('email', 'mobile', 'level', 'type'));
                if (false === $userInfo || count($userInfo) != 1) {
                    self::$errCode = IUsersTTC::$errCode;
                    self::$errMsg = IUsersTTC::$errMsg;
                    return false;
                }
                $userInfo = $userInfo[0];
                $userLevel = $userInfo['level'];

                if (1 == $isEmailVerify && '' != $userInfo['email']) {
                    $userEmailInfo = IEmailLoginTTC::get($userInfo['email'], array('uid'=>$uid), array('status'));
                    if (isset($userEmailInfo[0])) {
                        global $_EmailStat;
                        $userBindEmail = $userEmailInfo[0]['status'] == $_EmailStat['bound'] ? 1 : 0;
                    }
                }
                if (1 == $isTelVerify && '' != $userInfo['mobile']) {
                    $userMobileInfo = ITelLoginTTC::get($userInfo['mobile'], array('uid'=>$uid), array('status'));
                    if (isset($userMobileInfo[0])) {
                        global $_MobileStat;
                        $userBindMobile = $userMobileInfo[0]['status'] == $_MobileStat['bound']? 1: 0;
                    }
                }
            }

            foreach ($edmItems as $ei) {
                if ($ei['IsEmailVerification'] == 1 && $userBindEmail != 1) {
                    continue;
                }
                if ($ei['IsMobileVerification'] == 1 && $userBindMobile != 1) {
                    continue;
                }
                if ($ei['MemberLevelRange'] != '' && !in_array($userLevel, explode(',',$ei['MemberLevelRange']))) {
                    continue;
                }

                $products[$ei['ProductSysNo']]['price'] = $ei['EDMPrice'] * 100;
            }
        }

        // 处理邮件专享价格完毕
        // 剔除商品状态不处于正常状态的商品 && 剔除没有商品基本信息的商品
        $productIds = array();
        $limitedProduct = array();
        $virtualStockPids = array();
        global $_StockTips, $_ColorList, $_PROD_SIZE_2;
        global $_StockToWhidTransitDays;
        global $_Wh_id;
        global $_StockToStation;

        foreach ($items as $key => $item) {
            $exist =  isset($products[$item['product_id']]) ? true : false;
            if (false == $exist) {
                unset($items[$key]);
                $deleteProductIds[] = $item['product_id'];
                continue;
            }

            $product = $products[$item['product_id']];
            if ($product['status'] != PRODUCT_STATUS_NORMAL) {
                unset($items[$key]);
                $deleteProductIds[] = $item['product_id'];
            }
            else {
                $items[$key]['name'] = $product['name'];
                $items[$key]['size'] = isset($_PROD_SIZE_2[$product["size"]])? $_PROD_SIZE_2[$product["size"]] : "";
                $items[$key]['color'] = isset($_ColorList[$product["color"]]) ? $_ColorList[$product["color"]] : "";
                $items[$key]['product_char_id'] = $product['product_char_id'];
                $items[$key]['pic_num'] = $product['pic_num'];
                $items[$key]['weight'] = $product['weight'];
                $items[$key]['type'] = $product['type'];
                $items[$key]['flag'] = $product['flag'];
                $items[$key]['c3_ids'] = $product['c3_ids'];
                $items[$key]['restricted_trans_type'] = $product['restricted_trans_type'];
                $items[$key]['market_price'] = $product['market_price'];
                $items[$key]['psystock'] = $product['psystock'];
                $items[$key]['canAddToWireLessCart'] = ($wh_id == 1 && $product['psystock'] == 1);
                $items[$key]['rushing_buy'] = ($product['flag'] & OTHER_TIME_LIMITED_RUSHING_BUY) == OTHER_TIME_LIMITED_RUSHING_BUY; //抢购
                $items[$key]['canVAT'] = ($product['flag'] & CAN_VAT_INVOICE) == CAN_VAT_INVOICE;
                $items[$key]['canUseCoupon'] = ($product['flag'] & COUPON_PRODUCT) != COUPON_PRODUCT;
                $items[$key]['price'] = $product['price'] + $product['cash_back'];
                $items[$key]['cash_back'] = $product['cash_back'];

                if (isset($promotion['benefit_type'])) {
                    if ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_HUANGOU']
                        && $item['product_id'] == $promotion['discount']) { //换购

                        $dis = ($product['price'] - $promotion['plus_con']) > 0 ? ($product['price'] - $promotion['plus_con']) : 0;
                        $promotion['benefits'] = $dis * $promotion['benefit_times'] * $promotion['benefit_per_time'];
                    }
                    else if ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_PRODUCT']
                        && $item['product_id'] == $promotion['discount']) { //赠送商品

                        $promotion['benefits'] = $product['price'] * $promotion['benefit_times'] * $promotion['benefit_per_time'];
                    }
                }

                //$items[$key]['cost_price'] = $product['cost_price'];
                $items[$key]['point'] = $product['point'];
                $items[$key]['num_limit'] = $product['num_limit'];
                if ($product['num_limit'] > 0 && $product['num_limit'] < 999) {
                    $limitedProduct[] = $product['product_id'];
                }

                if (($product['num_available'] + $product['virtual_num'] >=  $item['buy_count']) ||
                    (( $wh_id == 1) && ($product['flag'] & FORBID_SET_VIRTUAL) != FORBID_SET_VIRTUAL && $product['type'] == PRODUCT_TYPE_NORMAL)
                    /* ($product['type'] == PRODUCT_TYPE_NORMAL && $product['price'] > $product['cost_price'])*/) {

                    if ($product['num_available']  >= $item['buy_count']) { //实际库存足够
                        if (!isset($_StockToWhidTransitDays[$product['psystock']][$wh_id]) || $_StockToWhidTransitDays[$product['psystock']][$wh_id] == 0) {
                            $items[$key]['array_days'] = $_StockTips['available'];
                        }
                        else {
                            $items[$key]['array_days'] = "有货，待{$_Wh_id[$_StockToStation[$product['psystock']]]}仓调拨，{$_StockToWhidTransitDays[$product['psystock']][$wh_id]}天后配送";
                        }
                    }
                    else {
                        if ($product['arrival_days'] == VIRTUAL_STOCK_ARRAY_1_3DAYS) {
                            $items[$key]['array_days'] = $_StockTips['arrival1-3'];
                            $virtualStockPids[] = $item['product_id'];
                        }else
                        {
                            $items[$key]['array_days'] = $_StockTips['arrival2-7'];
                            $virtualStockPids[] = $item['product_id'];
                        }
                    }
                    $productIds[$item['product_id']] = $item['product_id'];
                }
                else {
                    unset($items[$key]);
                    $deleteProductIds[] = $item['product_id'];
                }
            }
        }

        //ixiuzeng修改，拉取赠品信息
        $gifts = IGiftNewTTC::gets(array_unique($productIds), array('status'=>GIFT_STATUS_OK));
        if (false === $gifts) {
            self::$errCode = IGiftNewTTC::$errCode;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IGiftNewTTC failed]' . IGiftNewTTC::$errMsg;
            return false;
        }

        //剔除掉与主商品不在一个物理分仓
        global $_StockToStation;
        $products_psy = array();
        $giftsValid = array();
        $products_gifts_type = array();
        foreach($products as $pwinfo) {
            $products_psy[$pwinfo['product_id']] = $pwinfo['psystock'];
            foreach($gifts as $gi) {
                if (($pwinfo['product_id'] == $gi['product_id']) && ($_StockToStation[$pwinfo['psystock']] == $gi['stock_id'])) {
                    $giftsValid[] = $gi;
                    $products_gifts_type[$gi['product_id']][$gi['gift_id']][$gi['stock_id']]=$gi['type'];
                }
            }
        }
        unset($gifts);

        $gifts_ids = array();
        foreach ($giftsValid as $g) {
            $gifts_ids[] = $g['gift_id'];
        }

        //分别剔除掉每个商品中所有没有库存的赠品
        $giftsInventorys = IInventoryStockTTC::gets(array_unique($gifts_ids), array('status' => 0));
        if (false === $giftsInventorys) {
            self::$errCode = IInventoryStockTTC::$errCode;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IInventoryStockTTC failed]' . IInventoryStockTTC::$errMsg;
            return false;
        }

        $giftValidInventory = array();
        foreach($giftsValid as $gv) {
            foreach($giftsInventorys as $gsi) {
                if (($gv['gift_id'] == $gsi['product_id']) && ($products_psy[$gv['product_id']] == $gsi['stock_id'])
                    && (($gsi['num_available'] + $gsi['virtual_num'] > 0) || COMPONENT_TYPE == $products_gifts_type[$gv['product_id']][$gv['gift_id']][$gv['stock_id']])) {

                    $gv['num_available'] = $gsi['num_available'];
                    $gv['virtual_num'] = $gsi['virtual_num'];
                    $giftValidInventory[] = $gv;
                    break;
                }
            }
        }

        $gifts_final_ids = array();
        foreach($giftValidInventory as $gvi) {
            $gifts_final_ids[] = $gvi['gift_id'];
        }

        //拉取礼品商品的基本信息
        $gift_base_info = IProductCommonInfoTTC::gets(array_unique($gifts_final_ids), array(), array('name', 'product_char_id', 'weight', 'pic_num'));
        if (false === $gift_base_info) {
            self::$errCode = IProductCommonInfoTTC::$errCode;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductCommonInfoTTC failed]' . IProductCommonInfoTTC::$errMsg;
            return false;
        }

        //剔除基本信息不存在的礼品
        foreach ($giftValidInventory as $key => $gift) {
            $exist = false;
            foreach ($gift_base_info as $g_base) {
                if ($g_base['product_id'] == $gift['gift_id']) {
                    $exist = true;
                    $giftValidInventory[$key]['name'] = $g_base['name'];
                    $giftValidInventory[$key]['product_char_id'] = $g_base['product_char_id'];
                    $giftValidInventory[$key]['weight'] = $g_base['weight'];;
                    $giftValidInventory[$key]['stock_num'] = $gift['num_available'] + $gift['virtual_num'] ;
                    break;
                }
            }

            if (false === $exist) {
                unset($giftValidInventory[$key]);
            }
        }

        //拉取礼品的在各个分仓的装填,赠品组件的状态不可能是出售状态
        $gift_wh_info = IProductInfoTTC::gets(array_unique($gifts_final_ids), array(),array('product_id','wh_id','status'));
        $gifts_status = array();
        if (false === $gift_wh_info) {
            self::$errCode = IProductInfoTTC::$errCode;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
            return false;
        }
        foreach($gift_wh_info as $gwi) {
            $gifts_status[$gwi['product_id']][$gwi['wh_id']] = $gwi['status'];
        }

        //将赠品与其对应的主商品进行绑定
        global $_StockToStation;
        foreach ($items as $key => $item) {
            $items[$key]['gift'] = array();
            foreach ($giftValidInventory as $gift) {
                if (($gift['product_id'] == $item['product_id']) && ($_StockToStation[$gift['stock_id']] == $_StockToStation[$item['psystock']])
                    && ($gifts_status[$gift['gift_id']][$_StockToStation[$gift['stock_id']]] != PRODUCT_STATUS_NORMAL)) { //赠品组件的状态不可能是出售状态

                    $items[$key]['gift'][$gift['gift_id']]['name'] = $gift['name'];
                    $items[$key]['gift'][$gift['gift_id']]['product_id'] = $gift['gift_id'];
                    $items[$key]['gift'][$gift['gift_id']]['product_char_id'] = $gift['product_char_id'];
                    $items[$key]['gift'][$gift['gift_id']]['type'] = $gift['type'];
                    $items[$key]['gift'][$gift['gift_id']]['weight'] = $gift['weight'];
                    $items[$key]['gift'][$gift['gift_id']]['num'] = $gift['gift_num'];
                    $items[$key]['gift'][$gift['gift_id']]['stock_num'] = $gift['stock_num'];
                }
            }
        }

        //删除不合法的购物车商品
        foreach ($deleteProductIds as $id) {
            if ($product_id_wilreless == -1 && $buy_count_wireless == 0) {
                //IShoppingCart::removeCart($uid, array('product_id'=>$id));
                IShoppingCart::remove($uid,$id);
            }
        }

        //拉取随心配,同时检查是否能开赠票，能否模糊开票
        $matchPids = array();
        $totalAmt = 0;
        $totalWeight = 0;
        $totalCut = 0;
        $isCanVATInvoice = true;
        $c3ids = array();
        $rule_total_amt = 0;

        //开始根据商品所在物理仓储拆单
        global $_StockToStation;
        $itemGroups = array();
        $itemsForConflit = array();
        foreach ($items as $key=>$item) {
            //按物理仓储分子订单
            $itemGroups[$item['psystock']]['items'][$item['product_id']] = $item;
            $itemGroups[$item['psystock']]['isVirtual'] = !empty($itemGroups[$item['psystock']]['isVirtual']) ? $itemGroups[$item['psystock']]['isVirtual'] : false;

            // 判断是否在虚库商品列表中
            if ( !$itemGroups[$item['psystock']]['isVirtual'] && in_array($item['product_id'], $virtualStockPids)) {
                $itemGroups[$item['psystock']]['isVirtual'] = true;
            }

            $itemsForConflit[] = $item['product_id'];
            if (0 == ($item['flag'] & CAN_VAT_INVOICE)) { //增值发票
                $isCanVATInvoice = false;
            }

            $c3ids[] = $item['c3_ids'];

            if ($item['main_product_id'] > 0) {
                $matchPids[] = $item['main_product_id'];
            }
            @$itemGroups[$item['psystock']]['totalAmt'] += $item['price']  * $item['buy_count'];
            @$itemGroups[$item['psystock']]['totalCut'] += $item['buy_count'] * $item['cash_back'];
            @$itemGroups[$item['psystock']]['totalWeight'] +=  $item['buy_count'] * $item['weight'];

            if (isset($promotion['benefit_type']) && $promotion['benefits'] > 0) {
                if (in_array($item['product_id'], $promotion['pids'])) { //计算每个子单中满足促销规则的商品的总价格，便于在子单之间分摊促销成本
                    @$itemGroups[$item['psystock']]['rule_total_amt'] += $item['price'] * $item['buy_count'];
                    $rule_total_amt +=  $item['price'] * $item['buy_count'];
                }
            }

            $totalAmt += ( $item['price'] )  * $item['buy_count'];
            $totalWeight += $item['buy_count'] * $item['weight'];
            $totalCut += $item['buy_count'] * $item['cash_back'];
            foreach ($item['gift'] as $g) {
                @$itemGroups[$item['psystock']]['totalWeight'] +=  (($item['buy_count'] * $g['num']) <= $g['stock_num']? ($item['buy_count'] * $g['num']) : $g['stock_num']) * $g['weight'];
                $totalWeight += (($item['buy_count'] * $g['num']) <= $g['stock_num'] ? ($item['buy_count'] * $g['num']) : $g['stock_num']) * $g['weight'];
            }

            if (isset($_StockToStation[$item['psystock']])) {
                $itemGroups[$item['psystock']]['stock_wh_id'] = intval($_StockToStation[$item['psystock']]);
            }
            else {
                $itemGroups[$item['psystock']]['stock_wh_id'] = 0;
            }
            $itemGroups[$item['psystock']]['stock_wh_id'] = intval($_StockToStation[$item['psystock']]);
            $itemGroups[$item['psystock']]['wh_id'] = intval($wh_id);
            $itemGroups[$item['psystock']]['cross_stock'] = $itemGroups[$item['psystock']]['wh_id'] !== $itemGroups[$item['psystock']]['stock_wh_id'] ? 1 : 0;
        }

        //分摊促销规则在各个子订单的分摊金额
        if (isset($promotion['benefit_type']) && $promotion['benefits'] > 0) {
            $last = 0;
            ksort($itemGroups);
            $remain = $promotion['benefits'];
            foreach($itemGroups as $subKey => $subOrder) {
                if (isset($subOrder['rule_total_amt'])) {
                    $tmp =  10 * bcdiv($subOrder['rule_total_amt'] * $promotion['benefits']  , $rule_total_amt * 10 , 0);
                    $itemGroups[$subKey]['rule_benefits'] = $tmp;
                    $remain -= $tmp;
                    $last = $subKey;
                }
                else {
                    $itemGroups[$subKey]['rule_benefits'] = 0;
                }
            }
            if (0 != $remain) {
                $itemGroups[$last]['rule_benefits'] += $remain;
            }
        }
        else { //都返回 rule_benefits 字段, 方便前台计算
            foreach($itemGroups as $subKey => $subOrder)
                $itemGroups[$subKey]['rule_benefits'] = 0;
        }

        if (!empty($matchPids)) {
            //ixiuzeng添加，广东站的随心配从广东站获取，上海和北京的随心配依然从上海获取
            $wh_id_temp = null;
            if (1001 == $wh_id) {
                $wh_id_temp = 1001;
            }
            else {
                $wh_id_temp = 1;
            }

            $matchItems = IProductRelativityTTC::gets($matchPids, array('type'=>PRODUCT_BY_MIND, 'status'=>1, 'wh_id'=>$wh_id_temp));
            if (is_array($matchItems) && count($matchItems) > 0) {
                foreach ($items as &$it) {
                    if ($it['main_product_id'] == 0 ) {
                        continue;
                    }
                    foreach ($matchItems as $mait) {
                        if ($it['main_product_id'] == $mait['product_id'] && $it['product_id'] == $mait['relative_id'] && $mait['type'] == PRODUCT_BY_MIND) {
                            $itemGroups[$it['psystock']]['items'][$it['product_id']]['priceCutByMatch'] =  intval($mait['property']);
                            $totalCut += $it['matchNum'] * $itemGroups[$it['psystock']]['items'][$it['product_id']]['priceCutByMatch'];
                            $itemGroups[$it['psystock']]['totalCut'] += $it['matchNum'] * $itemGroups[$it['psystock']]['items'][$it['product_id']]['priceCutByMatch'];
                            break;
                        }
                    }
                }
            }
        }

        //拉取商品三级分类，判断是否能模糊开票
        $isCanFuzzyInvoice = true;
        $availableInvoices = array (
            'isCanVAT' => $isCanVATInvoice,
            'hasNoteBook'=>0,
            'contentOpt' => array('商品明细'),
        );

        //如果购物车中有笔记本类商品，需要提示以公司开普通发票，无法保修
        if (in_array(234, $c3ids)) {
            $availableInvoices['hasNoteBook'] = 1;
        }
        if ($wh_id == 1 || $wh_id == 2001) {
            $c3Info = ICategoryTTC::gets($c3ids, array('level'=>3, 'status'=>0), array('parent_id', 'flag'));

            if (is_array($c3Info)) {
                $c2ids = array();
                foreach ($c3Info as $c3) {
                    if (($c3['flag'] & FUZZY_INVOICE) != FUZZY_INVOICE) { //不可以模糊开票
                        $isCanFuzzyInvoice = false;
                        break;
                    }
                    $c2ids[] = $c3['parent_id'];
                }
                if (true == $isCanFuzzyInvoice) {
                    $c2ids = array_unique($c2ids);
                    $c2Info = ICategoryTTC::gets($c2ids, array('level'=>2, 'status'=>0), array('parent_id'));
                    if (is_array($c2Info)) {
                        global $_FuzzyInvoiceConf;
                        foreach ($c2Info as $c2) {
                            if (isset($_FuzzyInvoiceConf[intval($c2['parent_id'])])) {
                                $availableInvoices['contentOpt'] = array_merge($availableInvoices['contentOpt'], $_FuzzyInvoiceConf[intval($c2['parent_id'])]);
                            }
                        }
                    }
                }
            }
        }


        $availableInvoices['contentOpt'] = array_unique($availableInvoices['contentOpt']);
        sort($availableInvoices['contentOpt']);

        //检查限购
        //如果购物车中商品有限购商品，则查询该用户当天的订单
        //这里部署外网需要修改分库分表的问题
        if (!empty($limitedProduct)) {
            global $_OrderState;
            $timestamp = mktime(0,0,0,date('m'), date('d'), date('Y') );

            $db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');

            $sql = "SELECT product_id,
									sum(buy_num) as buy_num
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
                self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query order db failed]' . $orderDb->errMsg;
                return false;
            }

            if (!empty($userOrder)) {
                self::$errMsg = "您购买的";
                foreach ($userOrder as $order) {
                    foreach ($items as $item) {
                        if ($item['product_id'] == $order['product_id']) {
                            if ($item['buy_count'] + $order['buy_num'] > $item['num_limit']) {
                                self::$errCode = 999;
                                self::$errMsg .= $item['name'] . "限购{$item['num_limit']}件，您今日已购{$order['buy_num']}件;";
                            }
                            break;
                        }
                    }
                    self::$errMsg .= "请您返回购物车修改购买数量";
                }
            }
        }

        //检查限购完毕
        if (self::$errCode === 999) {
            return false;
        }

        //拉取用户是否属于特殊用户
        if (empty($userInfo)) {
            $userInfo = IUsersTTC::get($uid,array(), array('email', 'mobile', 'level', 'type'));
            if (isset($userInfo[0])) {
                $userInfo = $userInfo[0];
            }
        }

        //拉取商品试用的返券
        $promoCoupon = EA_Promotion::getPromotionRulesBatch($productIds, $wh_id, true);
        if (false === $promoCoupon) {
            Logger::warn('EA_Promotion::getPromotionRulesBatch FAILED, code: ' . EA_Promotion::$errCode . ', msg: ' . EA_Promotion::$errMsg);
        }

        return array (
            'invoice' => $availableInvoices,
            'items' => $itemGroups,
            'totalCut' => $totalCut,
            'totalAmt' => $totalAmt,
            'totalWeight' => $totalWeight,
            'conflictProducts'=>IDIYInfo::checkProductsMatch($itemsForConflit),
            'promotion' => $promotion,
            'promoCoupon' => $promoCoupon,
            'userIsDealer' => isset($userInfo['type']) ? ($userInfo['type'] == USER_IS_DEALER) : false,
        );
    }
}

