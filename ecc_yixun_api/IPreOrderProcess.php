<?php
/**
 * Created by JetBrains PhpStorm.
 * User: hedyhe sheldonshi
 * Date: 13-5-1
 * Time: 下午4:02
 * To change this template use File | Settings | File Templates.
 * Ps: 文件中接口仅供易迅网站侧购物流程调用，其他调用须提前告知，否则接口调整修改不做周知
 */

if(!defined("PHPLIB_ROOT")) {
    define('PHPLIB_ROOT', '/data/release/PHPLIB/');
}
require_once(PHPLIB_ROOT . 'inc/district.inc.php');
require_once(PHPLIB_ROOT . 'inc/ship.inc.php');
require_once(PHPLIB_ROOT . 'inc/special.constant.inc.php');
require_once(PHPLIB_ROOT . 'api/IShoppingProcess.php');

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
class IPreOrderProcess
{
    public static $errCode = 0;
    public static $errMsg = '';
    public static $logMsg = '';
    public static $innerErrMsg = "";

    // 根据用户类型，支付方式会稍有不同
    const USER_TYPE_ALI = 'ali'; //支付宝普通
    const USER_TYPE_ALI_GOLDEN = 'ali_golden'; //支付宝金账户
    const USER_TYPE_SHCAR = 'shcar'; //上汽

    //以下几个特殊配置，需跟线上保持一致，不然会出问题
    public static $PAYTYPE_ALI_ONLY = array(17, 18, 19, 20, 21); //支付宝用户只有这几个
    public static $PAYTYPE_ALI_GOLDEN_ONLY = array(21); //支付宝金账户只有这1个
    public static $PAYTYPE_SHCAR_ONLY = array(73); //仅供上汽用户

    //DIY类商品  TAPD 5484733
    public static $DIY_SERVICE_IDS = array( 5978, 7599, 293523, ); //“上门安装”服务类商品ID
    public static $DIY_PRODUCT_C3_IDS = array( 92,100,111,132,138,146,148,149,152,159,166,212,297,325, ); //DIY 类商品小类ID
    public static $DIY_PRODUCT_STOCK_MAP = array( //仓储验证表
        SITE_SH => array(STOCK_SH_1), //上海
        SITE_SZ => array(STOCK_SZ_1001), //广东
        SITE_BJ => array(STOCK_BJ_2001), //北京
        SITE_WH => array(STOCK_WH_3001), //武汉
        SITE_CQ => array(STOCK_CQ_4001), //重庆
        SITE_XA => array(STOCK_XA_5001), //西安
    );
    //分期付款
    public static $_installmentPayType = array(28, 63);
    //$product_id_wireless: 如果传入合法值，代表是无线一键购买
    public static function getShippingTypeNotAviable($uid, $destination, $wh_id = 1, $product_id_wireless = -1)
    {
        // 目前这个函数仅在无线端使用，拆分出单独的文件，此处保留接口调用，以后会去除 TODO
        $ret = IWPreOrder::getShippingTypeNotAviable($uid, $destination, $wh_id, $product_id_wireless);
        if (false === $ret) {
            self::$errMsg = IWPreOrder::$errMsg;
            self::$errCode = IWPreOrder::$errCode;
            return false;
        }

        return $ret;
    }

    public static function getForbidenShippingType($forbidenShipArr, $province, $city, $district, $wh_id = 1)
    {
        $ret = IShipping::getForbidenShippingType($forbidenShipArr, $province, $city, $district, $wh_id);
        if (false === $ret) {
            self::$errMsg = IShipping::$errMsg;
            self::$errCode = IShipping::$errCode;
            return false;
        }

        return $ret;
    }

    //  $payAmt: 为用户需要支付的金额(手续费除外)
    public static function getProcFee($payAmt, $payType, $wh_id = 1)
    {
        if (!isset($payAmt) || $payAmt < 0) {
            self::$errCode = 101;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "payAmt($payAmt) is invalid";
            return false;
        }
        global $_PAY_MODE;
        if ($payType < 0 || !isset($_PAY_MODE[$wh_id][$payType])) {
            self::$errCode = 102;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "payType($payType) is invalid";
            return false;
        }
        return ceil(bcmul($payAmt, $_PAY_MODE[$wh_id][$payType]['PayRate'], 6));
    }

    /**
     * $products 商品的基本信息，包括 num_available, virtual_num, type, flag
     * $item 购买商品的基本信息，包括 buy_count, product_id
     */
    public static function isVirtualOrder($products, $items)
    {
        $wh_id = IUser::getSiteId();
        foreach ($items as $item) {
            $product = $products[$item['product_id']];
            if (($product['num_available'] + $product['virtual_num'] >= $item['buy_count'])
                || (($wh_id == 1) && ($product['flag'] & FORBID_SET_VIRTUAL) != FORBID_SET_VIRTUAL && $product['type'] == PRODUCT_TYPE_NORMAL)
            ) {

                if ($product['num_available'] < $item['buy_count']) { //实际库存不足够
                    return true;
                }
            }
        }
        return false;
    }

    /**
    商品详情链接，或者加入购物车连接后面带上   edm=xxxxxx，则需要记录该串，并传入到此
    格式"code1_productid1,code2_productid2"

    $rule_id :  如果用户在购物车页面选择了促销规则，则需要传入其选择的促销规则id
    $apply_times:如果促销规则是换购，或者赠送商品，则需要传入apply_times：规则累计次数
    $product_id_wilreless: 如果传入此参数，说明是来自无线的一键购买
    $buy_count_wireless:  无线一键购买，购买商品的数量
     */
    public static function getItemsInShoppingCart($uid, $wh_id = 1, $open_id = '', $rule_id = 0, $apply_times = 999, $product_id_wilreless = -1, $buy_count_wireless = 0, $is_es = false, $esitems = array(), $wire_less_para = array())
    {
        // 目前这个函数仅在无线端使用，拆分出单独的文件，此处保留接口调用，以后会去除 TODO
        $ret = IWPreOrder::getItemsInShoppingCart($uid, $wh_id, $open_id, $rule_id, $apply_times, $product_id_wilreless, $buy_count_wireless, $is_es, $esitems, $wire_less_para);
        if ($ret === false) {
            self::$errMsg = IWPreOrder::$errMsg;
            self::$errCode = IWPreOrder::$errCode;
        }
        return $ret;
    }

    // 查看用户可用积分的范围
    public static function getPointUseArange($uid, $destinationId, $wh_id = 1, $post = array())
    {
        if (!isset($uid) || $uid <= 0) {
            self::$errCode = 903;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
            return false;
        }

        //$userInfo = IUsersTTC::get($uid);
        $userInfo = IUser::getUserInfo($uid);
        if (false === $userInfo) {
            self::$errCode = IUser::$errCode;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[get IUser failed]' . IUser::$errMsg;
            return false;
        }
        /*
        if (0 == count($userInfo)) {
            self::$errCode = 909;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '用户不存在';
            return false;
        }

        $userInfo = &$userInfo[0];
        $userPoint = $userInfo['valid_point'];
        */

        $userPoint = IShoppingProcess::getUserPoint($uid);
        if($userPoint === false)
        {
            $userPoint = 0;
        }
        else
        {
            $userPoint = $userPoint['point'];
        }

        $pointMin = 0;
        $pointMax = 0;
        if(!empty($post) && $post['version'] == 1)
        {
            $version = $post['version'];
            $newOrder['suborders'] = isset($post['suborders']) && !empty($post['suborders']) ? ToolUtil::gbJsonDecode($post['suborders']) : array();
            $newOrder['suiteInfo'] = $post['suiteInfo'];
            $result = IShoppingProcess::getAllCartItemsInfo($uid, $wh_id, $destinationId, array(), true , true, SCENE_SHOPPING_ORDER, $newOrder, $version);
            if(false === $result)
            {
                self::$errCode = IShoppingProcess::$errCode;
                self::$errMsg = IShoppingProcess::$errMsg . ",uid({$uid}) getItemList failed";
                Logger::err("getPointUseArange getAllCartItemsInfo Failed!". IShoppingProcess::$errCode);
                return false;
            }
            //返回数据
            $orderItems = $result['items'];
            $product_prices = $result['products'];
            foreach ($orderItems as $key=>$item) {
                if(isset($product_prices[$item['product_id']]))
                {
                    $price = $product_prices[$item['product_id']];
                    if ($price['point_type'] != PRODUCT_CASH_PAY_ONLY) {
                        $pointMax += $price['price'] * $item['buy_count'];
                    }
                    if ($price['point_type'] == PRODUCT_POINT_PAY_ONLY) {
                        $pointMin += $price['price'] * $item['buy_count'];
                    }
                }
            }
        }
        else
        {
            //拉取购物车中商品
            $orderItems = IShoppingCartV2::get($uid);
            if (false === $orderItems) {
                self::$errCode = IShoppingCart::$errCode;
                self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[get IShoppingCart failed]' . IShoppingCart::$errMsg;
                return false;
            }

            $product_ids = array();
            foreach ($orderItems as $item) {
                $product_ids[] = $item['product_id'];
            }

            //拉取商品的价格信息(积分支付信息)
            $product_prices = IProductInfoTTC::gets($product_ids, array('wh_id' => $wh_id, 'status' => PRODUCT_STATUS_NORMAL), array('product_id', 'point_type', 'price'));
            if (false === $product_prices) {
                self::$errCode = IProductPriceTTC::$errCode;
                self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[get IProductPriceTTC failed]' . IProductPriceTTC::$errMsg;
                return false;
            }
            foreach ($orderItems as $key=>$item) {
                foreach ($product_prices as $price) {
                    if ($item['product_id'] == $price['product_id']) {
                        $orderItems[$key]['price'] = $price['price'];
                        if ($price['point_type'] != PRODUCT_CASH_PAY_ONLY) {
                            $pointMax += $price['price'] * $item['buy_count'];
                        }
                        if ($price['point_type'] == PRODUCT_POINT_PAY_ONLY) {
                            $pointMin += $price['price'] * $item['buy_count'];
                        }
                        break;
                    }
                }
            }

        }
        //拉取随心配
        //getTyingInfo($items, $whId, $destinationId,  $uid = 0)
        reset($orderItems);
        $tyingRet = IShoppingProcess::getTyingInfo($orderItems, $wh_id, $destinationId, $uid);

        if(false === $tyingRet)
        {
            Logger::info("可用积分范围获取随心配失败[whid:{$wh_id}][destinationId:{$destinationId}][uid:{$uid}][item:" . ToolUtil::gbJsonEncode($orderItems));
        }
        else
        {
            $orderItems = $tyingRet['items'];
            foreach($orderItems as $ooi)
            {
                if($ooi['match_num'] > 0)
                {
                    $pointMax -= $ooi['match_num'] * intval($ooi['match_cut']);
                }
            }
        }
        $pointMax /= 10;
        $pointMax = $userPoint < $pointMax ? $userPoint : $pointMax;

        //获取用户手机号码以及绑定状态
        /*
        $userInfo = IUser::getUserInfo($uid);
        if ($userInfo === false) {
            Logger::err(__LINE__ . "获取用户可用积分范围是，获取用户信息失败");
            $mobile = array();
        } else {
            $mobile = array(
                'mobile' => $userInfo['mobile'],
                'isBind' => $userInfo['bindMobile']
            );
        }
        */
        $mobile = array(
            'mobile' => $userInfo['mobile'],
            'isBind' => $userInfo['bindMobile']
        );
        return array('minPoint' => $pointMin / 10, 'maxPoint' => ceil($pointMax), 'userPoint' => $userPoint, 'userMobile' => $mobile);
    }

    public static function checkCouponCanUse($uid, $couponCode, $destination, $payType, $wh_id = 1, $clientType = 0, $version = 0)
    {
        if($version == 1)
        {
            //checkCouponForOrder($uid, $couponCode, $destination, $payType, $orderItems, $products, $packages, $wh_id=1, $clientType=0, $cpInfo = null)
            //获取商品用户商品信息
            $newOrder['suborders'] = isset($_POST['suborders']) && !empty($_POST['suborders']) ? ToolUtil::gbJsonDecode($_POST['suborders']) : array();
            $newOrder['suiteInfo'] = $_POST['suiteInfo'];
            $result = IShoppingProcess::getAllCartItemsInfo($uid, $wh_id, $destination, array(), true , true, SCENE_SHOPPING_ORDER, $newOrder, $version);
            if(false === $result)
            {
                self::$errCode = IShoppingProcess::$errCode;
                self::$errMsg = IShoppingProcess::$errMsg . ",uid({$uid}) getItemList failed";
                Logger::err("checkCouponCanUse getAllCartItemsInfo Failed!". IShoppingProcess::$errCode);
                return false;
            }
            //返回数据
            $orderItems = $result['items'];
            $products = $result['products'];
            $packages = $newOrder['suborders'];
            $promotionRule = IPromotionRuleV2::checkRuleForOrder($orderItems, $wh_id, $uid, 0, 1, SCENE_SHOPPING_PROCESS);
            if(false === $promotionRule)
            {
                self::$errCode = IPromotionRuleV2::$errCode;
                self::$errMsg = IPromotionRuleV2::$errMsg;
                Logger::err("checkRuleForOrder Failed!:errCode" . self::$errCode . ";errMsg:" . self::$errMsg);
                return false;
            }
            $orderItems = $promotionRule['items'];
            $ret = ICouponV2::checkCouponForOrder($uid, $couponCode, $destination, $payType, $orderItems, $products, $packages, $wh_id, $clientType);
            if (false === $ret) {
                self::$errCode = ICouponV2::$errCode;
                self::$errMsg = ICouponV2::$errMsg;
                return false;
            }
        }
        else
        {
            $ret = ICouponV2::checkCoupon($uid, $couponCode, $destination, $payType, $wh_id, $clientType);
            if (false === $ret) {
                self::$errCode = ICouponV2::$errCode;
                self::$errMsg = ICouponV2::$errMsg;
                return false;
            }
        }

        return $ret;
    }

    public static function getUserCoupon($uid, $wh_id = 1)
    {
        $ret = ICoupon::getUserCoupon($uid, $wh_id);
        if (false === $ret) {
            self::$errMsg = ICoupon::$errMsg;
            self::$errCode = ICoupon::$errCode;
            return false;
        }

        return $ret;
    }

    /**
     * 多分仓版的 getShippingTypeByDestination
     */
    public static function getShippingTypeByDestination($destination, $orderPrice = 0, $isVirtual = array(), $orderWeight = array(), $wh_id = 1, $user_level=0)
    {
        $ret = IShipping::getShippingTypeByDestination($destination, $orderPrice, $isVirtual, $orderWeight, $wh_id, $user_level);
        if (false === $ret) {
            self::$errMsg = IShipping::$errMsg;
            self::$errCode = IShipping::$errCode;
            return false;
        }

        return $ret;
    }

    /**
     * 根据配送方式（分站ID，商品ID，用户类型）获取支付方式
     * @param int $shippingType 指定的配送方式
     * @param int $wh_id 分站ID
     * @param array $productidArr 商品ID数组
     * @param string $userType 用户类型
     * @param string $cartType 购物车类型
     * @return mixed false 失败；array 成功
     */
    public static function getPayTypeByShippingType($shippingType, $wh_id = 1, $productidArr = array(), $userType = false, $cartType = 0)
    {
        if (!isset($shippingType) || $shippingType <= 0) {
            self::$errCode = 902;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "shippingType($shippingType) is invalid";
            return false;
        }

        global $_LGT_MODE;
        if (!isset($_LGT_MODE[$shippingType])) {
            self::$errCode = 902;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "shippingType($shippingType) is not exist";
            return false;
        }

        global $_PAY_MODE;
        global $_LGT_PAY;

        $result = array();
        foreach ($_PAY_MODE[$wh_id] as $pay_type) { //过滤设置的支付类型
            /**
             * 微信支付灰度策略 - START
             */
            global $_WeixinPaymentWhiteList;
            if (isset($pay_type['SysNo']) && (502 == $pay_type['SysNo'])) {
                $uid = IUser::getLoginUid();
                if (!in_array($uid, $_WeixinPaymentWhiteList)) {
                    continue;
                }
                $pay_type['IsOnlineShow'] = 1;
                $pay_type['IsNet'] = 1;
            }
            /**
             * 微信支付灰度策略 - END
             */

            if ($pay_type['IsOnlineShow'] == 0) { //线上不显示
                continue;
            }


            //差异化处理开始
            if (false !== $userType && $pay_type['IsNet'] == 1) {
                if ($userType == self::USER_TYPE_ALI_GOLDEN && (!in_array($pay_type['SysNo'], self::$PAYTYPE_ALI_GOLDEN_ONLY))) {
                    continue; //在线支付, 但是不直属于支付宝金账户
                } else if ($userType == self::USER_TYPE_ALI && (!in_array($pay_type['SysNo'], self::$PAYTYPE_ALI_ONLY))) {
                    continue; //在线支付, 但是不直属于支付宝
                }
            }

            if (in_array($pay_type['SysNo'], self::$PAYTYPE_SHCAR_ONLY)) { //上汽专享支付方式
                if ($userType != self::USER_TYPE_SHCAR || $cartType == IShoppingCart::ES_CART) { //非上汽用户 or 节能补贴订单
                    continue; //不显示“通联支付”
                }
            }
            //差异化处理结束

            $exist = false;
            foreach ($_LGT_PAY[$wh_id] as $pay_type_not_ava) {
                if ($pay_type_not_ava['PayTypeSysNo'] == $pay_type['SysNo'] && $pay_type_not_ava['ShipTypeSysNo'] == $shippingType) {
                    $exist = true;
                    break;
                }
            }
            if (false === $exist) {
                $result[$pay_type['SysNo']]['pay_type'] = $pay_type['SysNo'];
                $result[$pay_type['SysNo']]['PayTypeName'] = $pay_type['PayTypeName'];
                $result[$pay_type['SysNo']]['IsNetBank'] = $pay_type['IsNetBank'];
                $result[$pay_type['SysNo']]['IsNet'] = $pay_type['IsNet'];
                $result[$pay_type['SysNo']]['PayTypeDesc'] = $pay_type['PayTypeDesc'];
                $result[$pay_type['SysNo']]['OrderNumber'] = $pay_type['OrderNumber'];

                if (bccomp($pay_type['PayRate'], "0.000000", 6) == 0) {
                    $result[$pay_type['SysNo']]['needPrcdFee'] = 0;
                } else {
                    $result[$pay_type['SysNo']]['needPrcdFee'] = 1;
                }
            }
        }

        //选择整机安装，不能选择货到付款
        global $_NotPayWhenArrive;
        $bothExist = array_intersect($_NotPayWhenArrive, $productidArr);
        if (count($bothExist) != 0) {
            foreach ($_PAY_MODE[$wh_id] as $pay_type) {
                if ($pay_type['PayTypeName'] == '货到付款') {
                    if (isset($result[$pay_type['SysNo']])) {
                        unset($result[$pay_type['SysNo']]);
                    }
                    break;
                }
            }
        }


        return $result;
    }

    /**
     * 根据配送方式（分站ID，商品ID，用户类型）获取所有可用支付方式
     * @param int $shippingType 指定的配送方式
     * @param int $wh_id 分站ID
     * @param array $productidArr 商品ID数组
     * @param string $userType 用户类型
     * @param int $cartType 购物车类型
     * @param int $uid 用户uid
     * @return mixed false 失败；array 成功
     */
    public static function getAvailablePayType($shippingType, $whId = 1, $productidArr = array(), $userType = false, $cartType = 0, $uid = 0)
    {
        if (!isset($shippingType) || $shippingType <= 0) {
            self::$errCode = 902;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "shippingType($shippingType) is invalid";
            return false;
        }

        $result = IShoppingProcess::getAllPayTypeInfo($shippingType, $whId, $productidArr, $userType, $cartType, $uid);

        return $result;
    }

    /**
     * 根据支付方式id，配送方式（分站ID，商品ID，用户类型）获取支付方式
     * @param int $payTypeId 指定的支付方式id
     * @param int $shippingType 指定的配送方式
     * @param int $wh_id 分站ID
     * @param array $productidArr 商品ID数组
     * @param string $userType 用户类型
     * @param int $cartType 购物车类型
     * @param int $uid 用户uid
     * @return mixed false 失败；array 成功
     */
    public static function getOnePayType($payTypeId, $shippingType, $whId = 1, $productidArr = array(), $userType = false, $cartType = 0, $uid = 0)
    {
        if (!isset($payTypeId) || $payTypeId <= 0) {
            self::$errCode = 902;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "payTypeId($payTypeId) is invalid";
            return false;
        }

        if (!isset($shippingType) || $shippingType <= 0) {
            self::$errCode = 902;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "shippingType($shippingType) is invalid";
            return false;
        }

        $result = IShoppingProcess::getPayTypeInfo($payTypeId, $shippingType, $whId, $productidArr, $userType, $cartType, $uid);

        return $result;
    }

    /**
     * 获取可选的发票种类
     */
    public static function getInvoicesContentOpt($c3ids, $wh_id) {
        $ret = IShoppingProcess::getInvoicesContentOpt($c3ids, $wh_id);

        return $ret;
    }
    private static function delItemInvalid($uid, $deleteProductIds)
    {
        //如果使用的是在线购物车，则删除不合法的购物车商品
        foreach ($deleteProductIds as $pid) {
            IShoppingCart::remove($uid, $pid);
        }
    }

    /**
     * 服务类商品跨仓检查逻辑 TAPD 5484733
     * @param array $products 商品信息数组
     * @param int $whid 当前分站ID
     * @return array 是否通过检查
     */
    public static function diyProductStockCheck($products, $whid) {
        $ret = array();

        $pids = array_keys($products);
        $cal = array_intersect($pids, self::$DIY_SERVICE_IDS);
        if (! empty($cal)) { //购物车包含服务类商品
            foreach($products as $pid => &$product) {
                if (in_array($pid, self::$DIY_SERVICE_IDS)) { //服务类商品直接排除
                    continue;
                }

                if (! isset($product['c3_ids']))
                { //传参出错，无法检查
                    Logger::warn(__FUNCTION__ . ' cannot be execute! c3_ids missing!');
                }
                else if (in_array($product['c3_ids'], self::$DIY_PRODUCT_C3_IDS))
                { //检查出货仓ID
                    if (! isset($product['psystock']))
                    { //传参出错，无法检查
                        Logger::warn(__FUNCTION__ . ' cannot be execute! psystock missing!');
                    }
                    else if (in_array($product['psystock'], self::$DIY_PRODUCT_STOCK_MAP[ $whid ])) { //出货仓映射关系正确
                        continue;
                    }
                    else { //不允许出货
                        $ret[] = $product;
                    }
                }
            }
        }

        return $ret;
    }

    /**
     * 获取用户类型
     * @param $userInfo
     */
    public static function getUserType($userInfo)
    {
        $userType = false;
        $userBits = ($userInfo['status_bits'] & (1 << ALI_GOLDEN_USER)) == (1 << ALI_GOLDEN_USER) ? 1 : 0;
        if (1 == $userBits) {
            $userType = IPreOrderProcess::USER_TYPE_ALI_GOLDEN; //支付宝金账户用户
        }
        else if (isset($userInfo['icsonid'])) {
            if (false !== strpos($userInfo['icsonid'], ALIPAY_ACCOUNT_PRE)) { //支付宝联合登录
                $userType = IPreOrderProcess::USER_TYPE_ALI;
            }
            else if (false !== strpos($userInfo['icsonid'], SHAUTO_ACCOUNT_PRE)) { //上汽用户联合登录
                $userType = IPreOrderProcess::USER_TYPE_SHCAR;
            }
        }
        else {
            //orther condition, keep $userType false
        }

        return $userType;
    }

    /**
     * listPackageInShoppingCart()
     *
     * 订单确认页(前端cmd参数为602的请求.)
     * 获取商品列表信息, 配送信息, 促销信息(多价系统), 拆单信息等.
     *
     * 促销2.0修改逻辑.
     * 去掉原逻辑中的随心配和EDM专享价, 价格经由多价系统处理.
     * 调用多价系统的IPromotionRuleV2::checkRuleForOrder()
     *
     * @param (int) $uid, 用户ID.
     * @param (int) $wh_id, 分站ID.
     * @param (int) $district, 三级地区ID.
     * @param (array) $rules, 促销规则参数.
     *        包括$rules['rule_id']促销ID和$rules['apply_times']促销时间.
     * @param (array) $offLine_params, 离线购物车参数.
     *        包括$offLine_params['type']购物车类型和$offLine_params['items'],
     *        $offLine_params['type']: 0为正常购物车, 非0为离线购物车.
     *        $offLine_params['items'], 离线购物车时商品信息保存在该参数中, json格式.
     * @return (array) 返回数组包括商品价格总计, 套餐信息, 包裹信息, 配送信息等.
     *
     * @Date: 2013.3(bluexchen)
     *
     *
     *
     *
     * 套餐赠品随心配和商品信息库存服务化接入
     * IShoppingProcess.php中的getAllCartItemsInfo函数将通过输入参数获取购物流程中需要用到的商品信息
     * 库存信息、套餐信息、赠品/组件信息、单品赠券信息的数据集合。
     *
     * Date:2013.4.25 hedyhe
     *
     *
     */
    public static function listPackageInShoppingCart($uid, $wh_id, $district, $rules = array(), $offLine_params = array())
    {
        self::$innerErrMsg = "";
        $conflict = NULL; //TAPD 5484733 冲突检查
        /**
         * 验证用户信息.
         */
        global $shoppingProcessItil, $shoppingProcessModuleCall;
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['process']['req']);
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['user']['req']);
        //$activeModuleId = $shoppingProcessModuleCall['active']['process'];
        $activeModuleId = $shoppingProcessModuleCall['passiveMID'];
        $mlog =	new CLoggerWrap($shoppingProcessModuleCall['active']['process']);
        $mlog->start();
        $userInfo = IUser::getUserInfo($uid);
        if ($userInfo === false) {

            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['user']['failed']);
            self::$errCode = IUser::$errCode;
            self::$errMsg = "获取用户信息错误";
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETUSERINFO'], self::$errCode, 1, LocalServerIP, LocalServerIP);
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:获取用户信息错误：" . IUser::$errMsg;
            return false;
        }
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETUSERINFO'], 0, 0, LocalServerIP, LocalServerIP);
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['user']['succ']);

        /**
         * 设置促销规则, 促销时间和购物车类型.
         */
        $rule_id     = isset($rules['rule_id']) ? $rules['rule_id'] : 0;
        //$apply_times = isset($rules['apply_times']) ? $rules['apply_times'] : 999;
        $shopping_cart_type = !empty($offLine_params['type'])
            ? $offLine_params['type'] : IShoppingCartV2::ONLINE_CART; //购物车参数, 0表示正常购物车

        /*
         * 接入套餐赠品随心配和商品库存服务化之后的调整
         * 该函数封装了 商品信息获取、套餐信息获取、赠品信息获取
         * hedyhe
         * */
        $items = array();
        $suiteInfo = array();
        $promoCoupon = array();
        $products = array();
        $productIds = array();
        $forbidList = array();
        $mlog->start();
        $ret = IShoppingProcess::getAllCartItemsInfo($uid,$wh_id,$district,$offLine_params, false, false, SCENE_SHOPPING_PROCESS);
        Logger::info('getAllCartItemsInfo'. ToolUtil::gbJsonEncode($ret));
        if(false  === $ret) {
            self::$errCode = IShoppingProcess::$errCode;
            self::$errMsg = IShoppingProcess::$errMsg;
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETALLCARTITEMSINFO'], self::$errCode, 1, LocalServerIP, LocalServerIP);
            return false;
        }
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETALLCARTITEMSINFO'], 0, 0, LocalServerIP, LocalServerIP);
        $items = $ret['items'];
        $suiteInfo = $ret['suiteInfo'];
        $promoCoupon = $ret['promoCoupon'];
        $products = $ret['products'];
        $productIds = $ret['productIds'];
        $forbidList = $ret['forbidList'];
        $inventorys = $ret['inventory'];
        if (empty($items) && !empty($ret['pkgIds']))
        {
            self::$errCode = -8001;
            self::$errMsg = "抱歉，您选择的套餐在该地址暂不销售，请选择其他商品";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:抱歉，您的购物车商品列表中有套餐在该地址暂不销售，请选择其他商品[whid{$wh_id}]" . ToolUtil::gbJsonEncode($ret['pkgIds']);
            Logger::err(self::$logMsg);
            return false;
        }
        if (empty($items))
        {
            self::$errCode = -8001;
            self::$errMsg = "抱歉，您选择的商品在该地址暂不销售或者购物车为空，请选择其他商品";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:抱歉，您的购物车商品列表中商品在该地址暂不销售货购物车为空，请选择其他商品[whid{$wh_id}]" . ToolUtil::gbJsonEncode($products);
            Logger::err(self::$logMsg);
            return false;
        }
        //seller_id seller_address_id数据不一致的容错处理
        foreach($items as $key => $item)
        {
            //seller_id seller_address_id数据不一致的容错处理
            if(($item['seller_id'] == 0 && $item['seller_address_id'] != 0)
                || ($item['seller_id'] != 0 && $item['seller_address_id'] == 0)
            )
            {
                self::$errCode = -8001;
                self::$errMsg = "抱歉，您的购物车中含有暂不销售的商品，请确认！";
                self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:抱歉，您的购物车中含有暂不销售的商品，请确认！[whid{$wh_id}]" . ToolUtil::gbJsonEncode($items);
                Logger::err(self::$logMsg);
                return false;
            }
        }
        reset($items);
        //  服务类商品跨仓检查逻辑
        $conflict = self::diyProductStockCheck($products, $wh_id);

        //获取预约商品的信息 hedyhe 2013-04-27  套餐赠品随心配商品信息库存服务化接入
        $ret = IShoppingProcess::SetAppoint($items, $wh_id, $products);
        if(false === $ret) {
            self::$errCode = IShoppingProcess::$errCode;
            self::$errMsg = IShoppingProcess::$errMsg;
            return false;
        } else {
            $items = $ret;  // 待确认
        }

        /*2013-05-21 随心配服务化接入*/
        $mlog->start();
        $tyingRet = IShoppingProcess::getTyingInfo($items,$wh_id,$district,$uid, SCENE_SHOPPING_PROCESS);
        if($tyingRet == false)
        {
            self::$errMsg = '获取随心配失败. '.IShoppingProcess::$errCode ;
            self::$errCode = IShoppingProcess::$errCode;
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETTYINGINFO'], self::$errCode, 1, LocalServerIP, LocalServerIP);
            self::$logMsg =  basename(__FILE__) . "line:" . __LINE__ . ",errMsg:检查多价信息失败.".IShoppingProcess::$errCode;
            //return false;
            Logger::err(self::$logMsg);
        }
        else
        {
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETTYINGINFO'], 0, 0, LocalServerIP, LocalServerIP);
            $items = $tyingRet['items'];
        }

        /**
         * 促销2.0改版, 获取多价和批价信息.
         *
         * 多价统一IPreOrderV2::checkRuleForOrder方法. (该方法内部时序应该为先处理"多价", 再处理"批价")
         */
        $promotion = array();

        //判断是否为节能补贴, 节能补贴时,$isEnergySavingType值为2, 否则为1
        if(IShoppingCartV2::ES_CART == $shopping_cart_type)
        {
            $isEnergySavingType = isset($items[0]['flag']) && IProduct::isEnergySubsidyProduct($items[0]['flag'], true)
                ? 2 : 1;
        }
        else
        {
            $isEnergySavingType = 1;
        }
        $mlog->start();
        $ret = IPromotionRuleV2::checkRuleForOrder(
            $items, $wh_id, $uid, $rule_id, $isEnergySavingType, SCENE_SHOPPING_PROCESS
        );

        //对于促销2.0中促销规则被限制的提示  促销2.0之后的校验
        if (false === $ret) {
            if(IPromotionRuleV2::$errCode == IPromotionRuleV2::$ERROR_RESTRICT)
            {
                self::$errMsg = '抱歉，您参加的促销优惠活动已超过次数或人数限制，请返回购物车重新选择。';
                self::$errCode = IPromotionRuleV2::$ERROR_RESTRICT;
                self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ",errMsg:您参加的促销优惠活动已超过次数或人数限制，请返回购物车重新选择.";
            }
            else
            {
                self::$errMsg = '检查多价信息失败.';
                self::$errCode = 98;
                self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ",errMsg:检查多价信息失败.";
            }
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['CHECKRULEFORORDER'], IPromotionRuleV2::$errCod, 1, LocalServerIP, LocalServerIP);
            return false;
        } else {
            $promotion = $ret['promotion'];
            $items     = $ret['items'];
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['CHECKRULEFORORDER'], 0, 0, LocalServerIP, LocalServerIP);
        }

        /*
         * 配送服务化接入
         * 2013-5-7 hedyhe
         *
         * */
        $mlog->start();
        $delivery4order = IShoppingProcess::getDeliveryInfo4Order($items, $inventorys, $wh_id,$district ,  $uid ,$userInfo['level'], SCENE_SHOPPING_PROCESS);
        if(false === $delivery4order) {
            self::$errCode = -8001;
            self::$errMsg = "抱歉，您选择的商品在该地址无法配送，请选择其他商品";
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETDELIVERYINFO4ORDER'], IShoppingProcess::$errCode, 1, LocalServerIP, LocalServerIP);
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:抱歉，您的购物车商品列表中有商品在该地址无法配送，请选择其他商品";
            return false;
        }
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETDELIVERYINFO4ORDER'], 0, 0, LocalServerIP, LocalServerIP);
        $order['items'] = $delivery4order['items'];

        //检查限购
        if($uid > 0) {
            $ret = IShoppingProcess::checklimitProduct($items,$products, $order,$uid);
            if ($ret === false) {
                self::$errMsg = IShoppingProcess::$errMsg;
                self::$errCode = IShoppingProcess::$errCode;
                self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ",errMsg:查询限购信息失败，" . IShoppingProcess::$errMsg;
                return false;
            }
        }

        /**
         * 重新取pid，中间的操作过程，可能把某些pid给删除掉了，
         * 凡是引起items发生变化的过程，请在这之前调用
         */
        $items = $delivery4order['items'];
        $productIds_final = array();
        foreach ($items as $it) {
            $productIds_final[] = $it['product_id'];
        }

        //对单品赠券进行过滤  ？？
        $coupon = array();
        foreach($productIds_final as $value ) {
            if(array_key_exists($value,$promoCoupon)) {
                $coupon[] = $promoCoupon[$value];
            }
        }

        if ($shopping_cart_type == IShoppingCartV2::ONLINE_CART) {
            $deleteProductIds = array_diff($productIds, $productIds_final);
            self::delItemInvalid($uid, $deleteProductIds);
        }

        /**
         * 商品组是否匹配逻辑
         */
        $conflictProducts = IDIYInfo::checkProductsMatch($productIds_final);   // $itemsForConflict
        $isDealer = isset($userInfo['type']) ? ($userInfo['type'] == USER_IS_DEALER) : false;
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['process']['succ']);
        return array(
            'invoice'          => $delivery4order['availableInvoices'],
            'totalCut'         => $delivery4order['totalCut'],
            'totalAmt'         => $delivery4order['totalAmt'],
            'totalWeight'      => $delivery4order['totalWeight'],
            'suiteInfo'        => $suiteInfo,                    //套餐的信息
            'packageList'      => $delivery4order['packages'],     //拆单的包裹信息
            'shipList'         => $delivery4order['shippingType'],
            'conflict'         => $conflict,
            'conflictProducts' => $conflictProducts,
            'promotion'        => $promotion,
            'promoCoupon'      => $coupon,
            'userIsDealer'     => $isDealer,
        );
    }


    /**
     * 易迅购物流购物车cgi
     * @param $uid
     * @param $wh_id
     * @param $district
     * @param $offLine_params
     * @return array|bool
     */
    public static function listProductsInfo($uid, $wh_id, $district, $offLine_params)
    {
        global $shoppingProcessItil, $shoppingProcessModuleCall;
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_CART]['cart']['req']);
        $activeModuleId = $shoppingProcessModuleCall['passiveMID'];
        $mlog =	new CLoggerWrap($shoppingProcessModuleCall['active']['cart']);
        $mlog->start();
        self::$innerErrMsg = "";
        $conflicts = NULL;
        /**
         * 设置购物车类型, 0表示正常购物车
         */
        $shopping_cart_type = !empty($offLine_params['type'])
            ? $offLine_params['type'] : IShoppingCartV2::ONLINE_CART;



        /* 接入套餐赠品随心配和商品库存服务化之后的调整
         * hedyhe
         *
         */

        $ret = IShoppingProcess::getAllCartItemsInfo($uid,$wh_id,$district,$offLine_params, false, false, SCENE_SHOPPING_CART);
        if(false  === $ret) {
            self::$errCode = IShoppingProcess::$errCode;
            self::$errMsg = IShoppingProcess::$errMsg;
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETALLCARTITEMSINFO'], self::$errCode, 1, LocalServerIP, LocalServerIP);
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_CART]['cart']['failed']);
            return false;
        }
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETALLCARTITEMSINFO'], 0,0, LocalServerIP, LocalServerIP);
        $items = $ret['items'];
        $suiteInfo = $ret['suiteInfo'];
        $promoCoupon = $ret['promoCoupon'];
        $products = $ret['products'];
        $productIds = $ret['productIds'];
        $forbidList = $ret['forbidList'];
        $inventorys  = $ret['inventory'];
        if(empty($items))
        {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_CART]['cart']['failed']);
            return array(
                'items'     => array(),
                'suiteInfo' => array(),
                'promoRule' => array(),
                'coupons'   => array(),
            );
        }
        //获取预约商品的信息 hedyhe 2013-04-27  套餐赠品随心配商品信息库存服务化接入
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_CART]['appoint']['req']);
        $ret = IShoppingProcess:: SetAppoint($items, $wh_id, $products);
        if(false === $ret) {
            self::$errCode = IShoppingProcess::$errCode;
            self::$errMsg = IShoppingProcess::$errMsg;
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_CART]['appoint']['failed']);
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_CART]['cart']['failed']);
            return false;
        } else {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_CART]['appoint']['succ']);
            $items = $ret;  // 待确认
        }

        $strItems = ToolUtil::gbJsonEncode($items);

        /*2013-05-21 随心配服务化接入*/
        $mlog->start();
        $tyingRet = IShoppingProcess::getTyingInfo($items,$wh_id,$district,$uid, SCENE_SHOPPING_CART);
        if($tyingRet == false) {
            self::$errMsg = '获取随心配失败. '.IShoppingProcess::$errCode ;
            self::$errCode = 4001;
            self::$logMsg =  basename(__FILE__) . "line:" . __LINE__ . ",errMsg:获取随心配失败.".IShoppingProcess::$errCode;
            self::$innerErrMsg =  self::$innerErrMsg . '获取随心配失败. ' . IShoppingProcess::$errCode;
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETTYINGINFO'], IShoppingProcess::$errCode, 1, LocalServerIP, LocalServerIP);
            Logger::err(self::$innerErrMsg);
        } else {
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETTYINGINFO'], 0, 0, LocalServerIP, LocalServerIP);
            $items = $tyingRet['items'];
        }

        //多价 促销批价接口
        $promotion = array();

        //判断是否为节能补贴,节能补贴时, $isEnergySavingType值为2, 否则为1
        //这里应该先判断这个是否是节能补贴购物车，是的话再判断这里，不了单纯这样判断会有问题
        if(IShoppingCartV2::ES_CART == $shopping_cart_type)
        {
            $isEnergySavingType = isset($items[0]['flag']) && IProduct::isEnergySubsidyProduct($items[0]['flag'], true)
                ? 2 : 1;
        }
        else
        {
            $isEnergySavingType = 1;
        }

        $mlog->start();
        $promotionRules = IPromotionRuleV2::getRuleForShoppingCart(
            $items, $wh_id, $isEnergySavingType, $uid, SCENE_SHOPPING_CART
        );
        if (false === $promotionRules) {
            self::$errMsg = '获取多价信息失败. errcode = '.IPromotionRuleV2::$errCode;
            self::$errCode = 99;
            self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ",errMsg:获取多价信息失败.";
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETRULEFORSHOPPINGCART'], IPromotionRuleV2::$errCode, 1, LocalServerIP, LocalServerIP);
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_CART]['cart']['failed']);
            return false;
        } else {
            $promotion = $promotionRules['rules'];
            $items     = $promotionRules['items'];
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETRULEFORSHOPPINGCART'], 0, 0, LocalServerIP, LocalServerIP);
            unset($promotionRules['rules'], $promotionRules['items']);
        }
        $mlog->start();
        $result = IShoppingProcess::getDeliveryInfo4Cart($items, $inventorys, $wh_id, $district, $uid, 0, SCENE_SHOPPING_CART);
        if( false === $result) {
            //如果调用配送信息失败，配送信息展示 暂不销售
            reset($items);
            foreach($items as $key=>$item)
            {
                $items[$key]['stock_desc'] = IProductInventory::$_StockTips['not_sale'];
                $items[$key]['stock_status'] = IProductInventory::$_StockStatus['not_sale'];
            }
            $result = array(
                'items'     => $items,      //商品列表
                'suiteInfo' => $suiteInfo,  //套餐信息
                'promoRule' => $promotion,  //促销规则
                'coupons'   => $promoCoupon,    //优惠卷
                'conflict' => array(), //冲突数据
            );
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETDELIVERYINFO4CART'], IShoppingProcess::$errCode, 1, LocalServerIP, LocalServerIP);
            return $result;
        }
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETDELIVERYINFO4CART'], 0, 0, LocalServerIP, LocalServerIP);
        $items = $result['items'];

        //服务类商品跨仓检查逻辑
        $conflicts = self::diyProductStockCheck($products, $wh_id);
        /**
         * 重新取pid，中间的操作过程，可能把某些pid给删除掉了，
         * 凡是引起items发生变化的过程，请在这之前调用
         */
        $productIds_final = array();
        foreach ($items as $it) {
            $productIds_final[] = $it['product_id'];
        }

        //删除掉前面被unset的商品
        if ($shopping_cart_type == IShoppingCartV2::ONLINE_CART) {
            $deleteProductIds = array_diff($productIds, $productIds_final);
            self::delItemInvalid($uid, $deleteProductIds);
        }
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_CART]['cart']['succ']);

        return array(
            'items'     => $items,      //商品列表
            'suiteInfo' => $suiteInfo,  //套餐信息
            'promoRule' => $promotion,  //促销规则
            'coupons'   => $promoCoupon,    //优惠卷
            'conflict' => $conflicts, //冲突数据
            'rules_buy_more' => $promotionRules['rules_buy_more'],
            'rules_if_login' => $promotionRules['rules_if_login'],
        );
    }

    /**
     * listPackageInShoppingCartNew 新版订单确认页cgi
     * @param $uid
     * @param $wh_id
     * @param $district
     * @param array $rules
     * @param array $offLine_params
     * @return array|bool
     */
    public static function listPackageInShoppingCartNew($uid, $wh_id, $district, $rules = array(), $offLine_params = array())
    {
        self::$innerErrMsg = "";
        $conflict = NULL;
        global $shoppingProcessItil, $shoppingProcessModuleCall;
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['process']['req']);
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['user']['req']);
        $activeModuleId = $shoppingProcessModuleCall['passiveMID'];
        $mlog =	new CLoggerWrap($shoppingProcessModuleCall['active']['process']);
        $mlog->start();

        $userInfo = IUser::getUserInfo($uid);
        if($userInfo === false)
        {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['user']['failed']);
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['process']['failed']);
            self::$errCode = 9701;
            self::$errMsg = "获取用户信息错误";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . "errCode:" . IUser::$errCode . ",errMsg:获取用户信息错误：" . IUser::$errMsg;
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETUSERINFO'], IUser::$errCode, 1, LocalServerIP, LocalServerIP);
            return false;
        }
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETUSERINFO'], 0, 0, LocalServerIP, LocalServerIP);
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['user']['succ']);
        //获取用户炒货商属性
        $isDealer = isset($userInfo['type']) ? ($userInfo['type'] == USER_IS_DEALER) : false;

        //设置选择的促销规则，购物车类型
        $rule_id = isset($rules['rule_id']) ? $rules['rule_id'] : 0;
        $shopping_cart_type = !empty($offLine_params['type']) ? $offLine_params['type'] : IShoppingCartV2::ONLINE_CART;

        $items = array();
        $suiteInfo = array();
        $promoCoupon = array();
        $products = array();
        $productIds = array();
        $mlog->start();
        $ret = IShoppingProcess::getAllCartItemsInfo($uid, $wh_id, $district, $offLine_params, false, false, SCENE_SHOPPING_PROCESS);
        Logger::info('[订单确认页]获取购物车商品列表：getAllCartItemsInfo:'. ToolUtil::gbJsonEncode($ret));
        if(false === $ret) {
            self::$errCode = IShoppingProcess::$errCode;
            self::$errMsg = IShoppingProcess::$errMsg;
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETALLCARTITEMSINFO'], self::$errCode, 1, LocalServerIP, LocalServerIP);
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['process']['failed']);
            return false;
        }
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETALLCARTITEMSINFO'], 0, 0, LocalServerIP, LocalServerIP);
        $items = $ret['items'];
        $suiteInfo = $ret['suiteInfo'];
        $promoCoupon = $ret['promoCoupon'];
        $products = $ret['products'];
        $productIds = $ret['productIds'];
        $forbidList = $ret['forbidList'];
        $inventorys = $ret['inventory'];
        //这里的两个处理会有点问题
        if(empty($items) && !empty($ret['pkgIds']))
        {
            self::$errCode = -8001;
            self::$errMsg = "抱歉，您选择的套餐在该地址暂不销售，请选择其他商品";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:抱歉，您的购物车商品列表中有套餐在该地址暂不销售，请选择其他商品[whid{$wh_id}]" . ToolUtil::gbJsonEncode($ret['pkgIds']);
            Logger::err(self::$logMsg);
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['process']['failed']);
            return false;
        }
        if(empty($items))
        {
            self::$errCode = -8001;
            self::$errMsg = "抱歉，您选择的商品在该地址暂不销售或者购物车为空，请选择其他商品";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:抱歉，您的购物车商品列表中商品在该地址暂不销售货购物车为空，请选择其他商品[whid{$wh_id}]" . ToolUtil::gbJsonEncode($products);
            Logger::err(self::$logMsg);
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['process']['failed']);
            return false;
        }
        $deleteItems = array();
        $deletePkgsId = array();
        $deletePkgs = array();
        foreach($items as $key => $item)
        {
            //调整要剔除的商品
            $items[$key]['buy_flag'] = 0;
            if(($item['seller_id'] == 0 && $item['seller_address_id'] != 0)
                || ($item['seller_id'] != 0 && $item['seller_address_id'] == 0)
            )
            {
                $items[$key]['stock_desc'] = IProductInventory::$_StockTips['not_available'];
                $items[$key]['stock_status'] = IProductInventory::$_StockStatus['not_available'];
                $items[$key]['can_buy_count'] = 0;
                $items[$key]['buy_num'] = $item['buy_count'];
                $deleteItems[] = $item;
                if($item['package_id'] != 0)
                {
                    $deletePkgsId[] = $item['package_id'];
                }
                unset($items[$key]);
                continue;
            }
            if($item['can_buy_count'] == 0)
            {
                //可购买数量为0，商品肯定不可以购买，或是库存不足，或是其他不能销售

                $deleteItems[] = $item;
                if($item['package_id'] != 0)
                {
                    $deletePkgsId[] = $item['package_id'];
                }
                unset($items[$key]);
                continue;
            }
            else
            {
                $items[$key]['buy_num'] = $item['buy_count'];
                $items[$key]['buy_count'] = $item['can_buy_count'];
            }
        }
        $deletePkgsId = array_unique($deletePkgsId);
        foreach($deletePkgsId as $key => $pkgId)
        {
            $deletePkgs[$pkgId] = $suiteInfo[$pkgId];
            unset($suiteInfo[$pkgId]);
        }
        reset($items);
        foreach($items as $key => $item)
        {
            if($item['package_id'] != 0 && array_key_exists($item['package_id'], $deletePkgs))
            {
                $items[$key]["can_buy_count"] = 0;
                $items[$key]["buy_count"] = 0;
                $deleteItems[] = $item;
                unset($items[$key]);
            }
        }
        reset($items);
        //服务类商品跨仓检查逻辑,如果有跨仓，则把装机服务剔除掉
        $conflict = self::diyProductStockCheck($products, $wh_id);
        if(!empty($conflict))
        {
            foreach($items as $key => $item)
            {
                if(in_array($item['product_id'], self::$DIY_SERVICE_IDS))
                {
                    $deleteItems[] = $item;
                    unset($items[$key]);
                }
            }
        }
        //这里要判断下商品列表是否为空
        if(empty($items))
        {
            //这里的返回待确认
            return array(
                'invoice'          => array(),
                'totalCut'         => 0,
                'totalAmt'         => 0,
                'totalWeight'      => 0,
                'suiteInfo'        => array(),                           //套餐的信息
                'packageList'      => array(),                         //拆单的包裹信息
                'shipList'         => array(),
                'conflict'         => $conflict,
                'conflictProducts' => array(),
                'delItems'         => $deleteItems,
                'delPkgs'          => $deletePkgs,
                'promotion'        => array(),
                'promoCoupon'      => array(),
                'userIsDealer'     => $isDealer,
            );
        }
        //获取预约商品的信息
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['appoint']['req']);
        $appointRet = IShoppingProcess::SetAppoint($items, $wh_id, $products);
        if(false === $appointRet)
        {
            self::$errCode = IShoppingProcess::$errCode;
            self::$errMsg = IShoppingProcess::$errMsg;
            Logger::err("订单确认页，获取商品预约失败！errCode:" . self::$errCode . "; errMsg:" . self::$errMsg);
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['appoint']['failed']);
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['process']['failed']);
            return false;
        }
        else
        {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['appoint']['succ']);
            $items = $appointRet;
        }

        //获取随心配
        $mlog->start();
        $tyingRet = IShoppingProcess::getTyingInfo($items, $wh_id, $district, $uid, SCENE_SHOPPING_PROCESS);
        if($tyingRet == false)
        {
            self::$errMsg = '获取随心配失败. '.IShoppingProcess::$errCode ;
            self::$errCode = 4001;
            self::$logMsg =  basename(__FILE__) . "line:" . __LINE__ . ",errMsg:检查多价信息失败.".IShoppingProcess::$errCode;
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETTYINGINFO'], IShoppingProcess::$errCode, 1, LocalServerIP, LocalServerIP);
            Logger::err("订单确认页，获取随心配信息失败！errCode:" . self::$errCode . ",errMsg:" . self::$errMsg);
        }
        else
        {
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETTYINGINFO'], 0, 0, LocalServerIP, LocalServerIP);
            $items = $tyingRet['items'];
        }
        //获取多价、促销批价
        $promotion = array();
        //判断是否为节能补贴, 节能补贴时,$isEnergySavingType值为2, 否则为1
        if(IShoppingCartV2::ES_CART == $shopping_cart_type)
        {
            $isEnergySavingType = isset($items[0]['flag']) && IProduct::isEnergySubsidyProduct($items[0]['flag'], true)
                ? 2 : 1;
        }
        else
        {
            $isEnergySavingType = 1;
        }
        $mlog->start();
        $ret = IPromotionRuleV2::checkRuleForOrder($items, $wh_id, $uid, $rule_id, $isEnergySavingType, SCENE_SHOPPING_PROCESS);
        //对于促销2.0中促销规则被限制的提示  促销2.0之后的校验
        if (false === $ret)
        {
            if(IPromotionRuleV2::$errCode == IPromotionRuleV2::$ERROR_RESTRICT)
            {
                self::$errMsg = '抱歉，您参加的促销优惠活动已超过次数或人数限制，请返回购物车重新选择。';
                self::$errCode = IPromotionRuleV2::$ERROR_RESTRICT;
                self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ",errMsg:您参加的促销优惠活动已超过次数或人数限制，请返回购物车重新选择.";
            }
            else
            {
                ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['process']['failed']);
                self::$errMsg = '检查商品多价信息错误！';
                self::$errCode = IPromotionRuleV2::$errCode;
                self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ",errMsg:检查多价信息失败.";
            }
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['CHECKRULEFORORDER'], IPromotionRuleV2::$errCode, 1, LocalServerIP, LocalServerIP);
            return false;
        }
        else
        {
            $promotion = $ret['promotion'];
            $items     = $ret['items'];
        }

        //检查限购

        $ret = IShoppingProcess::checklimitProductNew($items, $products, $uid);
        if ($ret === false)
        {
            self::$errMsg = IShoppingProcess::$errMsg;
            self::$errCode = IShoppingProcess::$errCode;
            self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ",errMsg:查询限购信息失败，" . IShoppingProcess::$errMsg;
            Logger::err("订单确认页，检查限购信息失败！errCode:" . self::$errCode . "; errMsg:" . self::$errMsg);
            //return false;
        }
        else
        {
            $items = $ret['items'];
        }
        //先判断商品是否有限购，如果有限购，且为套餐商品，把套餐id记录，然后在遍历商品，把已删除的套餐的item unset
        $needRePromotion = false;
        foreach($items as $key => $item)
        {
            if($item['buy_flag'] == 1)
            {
                if($item['package_id'] != 0)
                {
                    $deletePkgsId[] = $item['package_id'];
                    $items[$key]["can_buy_count"] = 0;
                    $items[$key]["buy_count"] = 0;
                    $deleteItems[] = $item;
                    unset($items[$key]);
                }
                else if($item['buy_count'] == 0)
                {
                    $items[$key]["can_buy_count"] = 0;
                    $items[$key]["buy_count"] = 0;
                    $deleteItems[] = $item;
                    unset($items[$key]);
                }
                $needRePromotion = true;
            }
        }
        $deletePkgsId = array_unique($deletePkgsId);
        foreach($deletePkgsId as $key => $pkgId)
        {
            if(isset($suiteInfo[$pkgId]))
            {
                $deletePkgs[$pkgId] = $suiteInfo[$pkgId];
                unset($suiteInfo[$pkgId]);
            }
        }
        reset($items);
        foreach($items as $key => $item)
        {
            if($item['package_id'] != 0 && array_key_exists($item['package_id'], $deletePkgs))
            {
                $items[$key]["can_buy_count"] = 0;
                $items[$key]["buy_count"] = 0;
                $deleteItems[] = $item;
                unset($items[$key]);
            }
        }

        if(empty($items))
        {
            //这里的返回待确认
            return array(
                'invoice'          => array(),
                'totalCut'         => 0,
                'totalAmt'         => 0,
                'totalWeight'      => 0,
                'suiteInfo'        => array(),                           //套餐的信息
                'packageList'      => array(),                         //拆单的包裹信息
                'shipList'         => array(),
                'conflict'         => $conflict,
                'conflictProducts' => array(),
                'delItems'         => $deleteItems,
                'delPkgs'          => $deletePkgs,
                'promotion'        => array(),
                'promoCoupon'      => array(),
                'userIsDealer'     => $isDealer,
            );
        }
        if($needRePromotion)
        {
            reset($items);
            $tyingRet = IShoppingProcess::getTyingInfo($items, $wh_id, $district, $uid, SCENE_SHOPPING_PROCESS);
            if($tyingRet == false)
            {
                self::$errMsg = '获取随心配失败. '.IShoppingProcess::$errCode ;
                self::$errCode = 4001;
                self::$logMsg =  basename(__FILE__) . "line:" . __LINE__ . ",errMsg:检查多价信息失败.".IShoppingProcess::$errCode;
                Logger::err("订单确认页，获取随心配信息失败 again！errCode:" . self::$errCode . ",errMsg:" . self::$errMsg);
            }
            else
            {
                $items = $tyingRet['items'];
            }
            $ret = IPromotionRuleV2::checkRuleForOrder($items, $wh_id, $uid, $rule_id, $isEnergySavingType, SCENE_SHOPPING_PROCESS);
            //对于促销2.0中促销规则被限制的提示  促销2.0之后的校验
            if (false === $ret)
            {
                if(IPromotionRuleV2::$errCode == IPromotionRuleV2::$ERROR_RESTRICT)
                {
                    self::$errMsg = '抱歉，您参加的促销优惠活动已超过次数或人数限制，请返回购物车重新选择。';
                    self::$errCode = IPromotionRuleV2::$ERROR_RESTRICT;
                    self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ",errMsg:您参加的促销优惠活动已超过次数或人数限制，请返回购物车重新选择.";
                }
                else
                {
                    self::$errMsg = '检查商品多价信息错误！';
                    self::$errCode = IPromotionRuleV2::$errCode;
                    self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ",errMsg:检查多价信息失败.";
                    ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['process']['failed']);
                }
                $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['CHECKRULEFORORDER'], IPromotionRuleV2::$errCode, 1, LocalServerIP, LocalServerIP);
                return false;
            }
            else
            {
                $promotion = $ret['promotion'];
                $items     = $ret['items'];
            }
        }

        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['CHECKRULEFORORDER'], 0, 0, LocalServerIP, LocalServerIP);

        //获取配送信息
        $mlog->start();
        $delivery4order = IShoppingProcess::getDeliveryInfo4Order($items, $inventorys, $wh_id,$district ,  $uid ,$userInfo['level'], SCENE_SHOPPING_PROCESS);
        if(false === $delivery4order)
        {
            self::$errCode = -1;
            self::$errMsg = "抱歉，您选择的商品在该地址无法配送，请选择其他商品";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:抱歉，您的购物车商品列表中有商品在该地址无法配送，请选择其他商品";
            Logger::err("订单确认页，获取配送信息失败！errCode:" . IShoppingProcess::$errCode . ", errMsg:" . self::$errMsg);
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETDELIVERYINFO4ORDER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['process']['failed']);
            return false;
        }
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETDELIVERYINFO4ORDER'], 0, 0, LocalServerIP, LocalServerIP);
        //获取ors分单配送信息
        $mlog->start();
        $deliveryOrs4order = IShoppingProcess::getDeliveryInfoOrs4Order($items, $inventorys, $wh_id,$district , 0, $uid ,$userInfo['level'], SCENE_SHOPPING_PROCESS);
        if(false === $deliveryOrs4order)
        {
            self::$errCode = IShoppingProcess::$errCode;
            self::$errMsg = "IShoppingProcess getDeliveryInfoOrs4Order";
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETDELIVERYINFOORS4ORDER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
            Logger::err("订单确认页，获取ORS分单配送信息失败！errCode:" . self::$errCode . ", errMsg:" . self::$errMsg);

            $realDeliveryRet = array("default" => $delivery4order);
        }
        else
        {
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETDELIVERYINFOORS4ORDER'], 0, 0, LocalServerIP, LocalServerIP);
            $realDeliveryRet = IShoppingProcess::getRealDeliveryInfo4Order($delivery4order, $deliveryOrs4order);
        }
        //Logger::info("订单确认页返回的最终分单配送结果：" . ToolUtil::gbJsonEncode($realDeliveryRet));
        $packageList = array();
        $shipList = array();
        foreach($realDeliveryRet as $key => $rDelivery)
        {
            $packageList[$key] = $rDelivery['packages'];
            $shipList[$key] = $rDelivery['shippingType'];
        }
        //$order['items'] = $delivery4order['items'];
        $items = $delivery4order['items'];
        //获取最终的商品ID
        $productIds_final = array();
        foreach ($items as $it) {
            $productIds_final[] = $it['product_id'];
        }

        //对单品赠券进行过滤  ？？
        $coupon = array();
        foreach($productIds_final as $value ) {
            if(array_key_exists($value,$promoCoupon)) {
                $coupon[] = $promoCoupon[$value];
            }
        }

        /*
        if ($shopping_cart_type == IShoppingCartV2::ONLINE_CART) {
            $deleteProductIds = array_diff($productIds, $productIds_final);
            self::delItemInvalid($uid, $deleteProductIds);
        }
        */
        //获取装机兼容性检查
        $conflictProducts = IDIYInfo::checkProductsMatch($productIds_final);
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['process']['succ']);
        return array(
            'invoice'          => $delivery4order['availableInvoices'],
            'totalCut'         => $delivery4order['totalCut'],
            'totalAmt'         => $delivery4order['totalAmt'],
            'totalWeight'      => $delivery4order['totalWeight'],
            'suiteInfo'        => $suiteInfo,                           //套餐的信息
            'packageList'      => $packageList,                         //拆单的包裹信息
            'shipList'         => $shipList,
            'conflict'         => $conflict,
            'conflictProducts' => $conflictProducts,
            'delItems'         => $deleteItems,
            'delPkgs'          => $deletePkgs,
            'promotion'        => $promotion,
            'promoCoupon'      => $coupon,
            'userIsDealer'     => $isDealer,
        );
    }
}
