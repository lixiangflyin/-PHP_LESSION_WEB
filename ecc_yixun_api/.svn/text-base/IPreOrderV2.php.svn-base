<?php
require_once(PHPLIB_ROOT . 'inc/district.inc.php');
require_once(PHPLIB_ROOT . 'inc/ship.inc.php');
require_once(PHPLIB_ROOT . 'inc/special.constant.inc.php');
require_once PHPLIB_ROOT."api/appplatform/pointsaccountao_stub4php.php";
require_once PHPLIB_ROOT."api/appplatform/platform/web_stub_cntl.php";
require_once PHPLIB_ROOT."api/appplatform/platform/lang_util.php";

Logger::init();

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
class IPreOrderV2
{
    public static $errCode = 0;
    public static $errMsg = '';
    public static $logMsg = '';

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
    public static function getPointUseArange($uid, $wh_id = 1)
    {
        if (!isset($uid) || $uid <= 0) {
            self::$errCode = 903;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
            return false;
        }

        //$userInfo = IUsersTTC::get($uid);
        $userInfo = IUser::getUserInfo($uid, true);
        if (false === $userInfo) {
            self::$errCode = IUser::$errCode;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[get IUser failed]' . IUser::$errMsg;
            Logger::err(__LINE__ . "获取用户可用积分范围是，获取用户信息失败");
            return false;
        }
        /*
        if (0 == count($userInfo)) {
            self::$errCode = 909;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '用户不存在';
            return false;
        }
        */

        //$userInfo = &$userInfo[0];
        //$userPoint = $userInfo['valid_point'];
        $userPoint = $userInfo['point'];

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

        $pointMin = 0;
        $pointMax = 0;
        foreach ($orderItems as $item) {
            foreach ($product_prices as $price) {
                if ($item['product_id'] == $price['product_id']) {
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
        //拉取随心配
        $easyIds = array();
        foreach ($orderItems as &$oi) {
            if ($oi['main_product_id'] > 0) {
                $exist = false;
                foreach ($orderItems as $ooi) {
                    if ($oi['main_product_id'] == $ooi['product_id']) {
                        $oi['matchNum'] = $oi['buy_count'] < $ooi['buy_count'] ? $oi['buy_count'] : $ooi['buy_count'];
                        $easyIds[] = $oi['main_product_id'];
                        $exist = true;
                        break;
                    }
                }
                if (false === $exist) {
                    $oi['main_product_id'] = 0;
                }
            }
        }
        if (count($easyIds) > 0) {
            //ixiuzeng添加，广东站的随心配从广东站获取，上海和北京的随心配依然从上海获取
            $wh_id_temp = NULL;
            if (1001 == $wh_id) {
                $wh_id_temp = 1001;
            } else {
                $wh_id_temp = 1;
            }

            $easyMatch = IProductRelativityTTC::gets($easyIds, array('type' => PRODUCT_BY_MIND, 'status' => 1, 'wh_id' => $wh_id_temp));

            if (is_array($easyMatch)) {
                foreach ($orderItems as $ooi) {
                    if ($ooi['main_product_id'] <= 0) {
                        continue;
                    }
                    foreach ($easyMatch as $em) {
                        //var_dump("{$ooi['main_product_id']} == {$em['product_id']} && {$ooi['product_id']} == {$em['relative_id']}");
                        if ($ooi['main_product_id'] == $em['product_id'] && $ooi['product_id'] == $em['relative_id'] && $em['type'] == PRODUCT_BY_MIND) {
                            $pointMax -= $ooi['matchNum'] * intval($em['property']);
                            //    var_dump("id={$em['relative_id']} , $pointMax -= {$oi['matchNum']} * intval({$em['property']})");
                        }
                    }
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

    public static function checkCouponCanUse($uid, $couponCode, $destination, $payType, $wh_id = 1, $clientType = 0)
    {
		$ret = ICouponV2::checkCoupon($uid, $couponCode, $destination, $payType, $wh_id, $clientType);
        if (false === $ret) {
            self::$errCode = ICouponV2::$errCode;
            self::$errMsg = ICouponV2::$errMsg;
            return false;
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
        $ret = IShipping::getShippingTypeByDestination($destination, $orderPrice, $isVirtual, $orderWeight, $wh_id, $user_level, true);
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
            if ($pay_type['IsOnlineShow'] == 0) { //线上不显示
                continue;
            }

            /**
             * 微信支付灰度策略 - START
             */
			global $_WeixinPaymentWhiteList;
            if (isset($pay_type['SysNo']) && (502 == $pay_type['SysNo'])) {
                $uid = IUser::getLoginUid();
                if (!in_array($uid, $_WeixinPaymentWhiteList)) {
                    continue;
                }
            }
            /**
             * 微信支付灰度策略 - END
             */

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
		$conflict = NULL; //TAPD 5484733 冲突检查
        /**
         * 验证用户信息.
         */
        $userInfo = IUser::getUserInfo($uid);
        if ($userInfo === false) {
            self::$errCode = IUser::$errCode;
            self::$errMsg = "获取用户信息错误";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:获取用户信息错误：" . IUser::$errMsg;
            return false;
        }

        /**
         * 设置促销规则, 促销时间和购物车类型.
         */
        $rule_id     = isset($rules['rule_id']) ? $rules['rule_id'] : 0;
        $apply_times = isset($rules['apply_times']) ? $rules['apply_times'] : 999;
        $shopping_cart_type = !empty($offLine_params['type'])
                            ? $offLine_params['type'] : IShoppingCart::ONLINE_CART; //购物车参数, 0表示正常购物车

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

        $ret = IShoppingProcess::getAllCartItemsInfo($uid,$wh_id,$district,$offLine_params);
        if(false  === $ret) {
            self::$errCode = IShoppingProcess::$errCode;
            self::$errMsg = IShoppingProcess::$errMsg;
            return false;
        }
		$items = $ret['items'];
		$suiteInfo = $ret['suiteInfo'];
		$promoCoupon = $ret['promoCoupon'];
		$products = $ret['products'];
		$productIds = $ret['productIds'];
        $forbidList = $ret['forbidList'];
        if (empty($items) && !empty($ret['pkgIds']))
        {
            self::$errCode = -8001;
            self::$errMsg = "抱歉，您选择的套餐在该地址暂不销售，请选择其他商品";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:抱歉，您的购物车商品列表中有套餐在该地址暂不销售，请选择其他商品";
            return false;
        }
        //无线侧新增新联营卖家的条件判断
        $hasNewJointOperation = false;
        foreach($items as $key => $item)
        {
            if($item['seller_id'] != 0 || $item['seller_address_id'] != 0)
            {
                $hasNewJointOperation = true;
                break;
            }
        }
        /*
         // 获取购物车中的商品列表，包括商品ID，购买数量.

        $ret = self::getItemList($uid, $wh_id, $offLine_params);
        if (false === $ret) {
            return false;
        } else {
            $items     = $ret['items'];
            $suiteInfo = $ret['suiteInfo'];
        }


         // 拉取商品基本信息

        $productIds = array();
        foreach ($items as $it) {
            $productIds[] = $it['product_id'];
        }

        $products = IProduct::getProductsInfo($productIds, $wh_id, true, false, $district);
        if (false === $products) {
            self::$errCode = IProduct::$errCode;
            self::$errMsg = "获取购物车商品信息失败";
            self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ", errMsg:拉去商品信息错误，" . IProduct::$errMsg;
            return false;
        }
		*/

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
		/*
		$forbidList = array();
		foreach($products as $key => $value) {
			if ($value['restricted_trans_type'] > 0) {
				$forbidList[$value['restricted_trans_type']][] = $value['product_id'];
			}
		}*/
        
		// * 根据站点，赠品，库存的信息
         //* 处理items里面的商品信息, 返回限购限运等信息.  是否进行这个整合
        /*$ret = self::getItemInfo($items, $wh_id, $products, $district);
        if (false === $ret) {
            return false;
        } else {
            //限购逻辑. 
            $items          = $ret['items'];
            $forbidList     = $ret['forbidList'];
            $limitedProduct = $ret['limitedProduct'];
        }*/

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

        $ret = IPromotionRuleV2::checkRuleForOrder(
            $items, $wh_id, $uid, $rule_id, $isEnergySavingType
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
            return false;
        } else {
            $promotion = $ret['promotion'];
            $items     = $ret['items'];
        }
        
        /**
		 *  接入服务化 hedyhe 将校验限购的逻辑统一到一处
		 *	
         //限购检查逻辑. 
         
        if (false === self::_checkProductsLimitation($items)) {
            return false;            
        }
		*/

        /**
         * 合并分拆为普通商品, 套餐商品和所有商品3个节点数组. 
         */
        /*
        $ret = self::splitSuiteItems($items, $suiteInfo);
        $items = $ret['items'];
        */

        /**
         * 拆分订单逻辑. 
         */
        $orders = self::DivideOrder($items, $wh_id, $promotion);
        if (false === $orders) {
            return false;
        } else {
            //订单的包裹信息，包括虚库，重量，具体的包裹信息等等
            $order = $orders['order'];
            $itemsForConflict = $orders['itemsForConflict'];
            $order['user_level'] = $userInfo['level'];
        }



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

       
		/*
        //如果购物车中商品有限购商品，则查询该用户当天的订单
        if ($uid > 0) {
            $ret = IOrder::checkLimitOrder($uid, $limitedProduct, $order['items']);
            if ($ret === false) {
                self::$errMsg = IOrder::$errMsg;
                self::$errCode = IOrder::$errCode;
                self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ",errMsg:查询限购信息失败，" . IOrder::$errMsg;
                return false;
            }
        }
		*/
		
        /**
         * 获取订单配送信息
         */
        $deliveryInfo = IPreOrderV2::getOrderDeliveryInfo($order, $district, $wh_id, $products, $forbidList);
        if ($deliveryInfo === false) {
            return false;
        }

        /**
         * 检查订单中是否华为有预购商品
         * @ixiuzeng添加
         */
        global $PreOrderProduct;
        foreach ($deliveryInfo['packages'] as $psystock => $pack) {
            foreach ($pack['items'] as $pid => $pinfo) {
                $deliveryInfo['packages'][$psystock]['items'][$pid]['isHuaWeiIShare'] = in_array($pack['items'][$pid]['product_id'], $PreOrderProduct['items']);
            }
        }
        $items = $deliveryInfo['items'];
        /**
         * 重新取pid，中间的操作过程，可能把某些pid给删除掉了，
         * 凡是引起items发生变化的过程，请在这之前调用
         */
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
        $conflictProducts = IDIYInfo::checkProductsMatch($itemsForConflict);
        $isDealer = isset($userInfo['type']) ? ($userInfo['type'] == USER_IS_DEALER) : false;

        return array(
            'invoice'          => $orders['availableInvoices'],
            'totalCut'         => $orders['totalCut'],
            'totalAmt'         => $orders['totalAmt'],
            'totalWeight'      => $orders['totalWeight'],
            'suiteInfo'        => $suiteInfo,                    //套餐的信息
            'packageList'      => $deliveryInfo['packages'],     //拆单的包裹信息
            'shipList'         => $deliveryInfo['shippingType'],
			'conflict'         => $conflict, //TAPD 5484733 冲突检查
            'conflictProducts' => $conflictProducts,
            'promotion'        => $promotion,
            'promoCoupon'      => $coupon,
            'userIsDealer'     => $isDealer,
            'hasNewJointOperation' => $hasNewJointOperation,
        );
    }

    /**
     * listPackageInShoppingCartV2()
     *
     * 订单确认页(前端cmd参数为602的请求.)
     * 获取商品列表信息, 配送信息, 促销信息(多价系统), 拆单信息等.

     * 拆单、配送使用AO接口
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
    public static function listPackageInShoppingCartV2($uid, $wh_id, $district, $rules = array(), $offLine_params = array())
    {
        $conflict = NULL; //TAPD 5484733 冲突检查
        /**
         * 验证用户信息.
         */
        $userInfo = IUser::getUserInfo($uid);
        if ($userInfo === false) {
            self::$errCode = IUser::$errCode;
            self::$errMsg = "获取用户信息错误";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:获取用户信息错误：" . IUser::$errMsg;
            return false;
        }

        /**
         * 设置促销规则, 促销时间和购物车类型.
         */
        $rule_id     = isset($rules['rule_id']) ? $rules['rule_id'] : 0;
        $apply_times = isset($rules['apply_times']) ? $rules['apply_times'] : 999;
        $shopping_cart_type = !empty($offLine_params['type'])
                            ? $offLine_params['type'] : IShoppingCart::ONLINE_CART; //购物车参数, 0表示正常购物车

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

        $ret = IShoppingProcess::getAllCartItemsInfo($uid,$wh_id,$district,$offLine_params);
        if(false  === $ret) {
            self::$errCode = IShoppingProcess::$errCode;
            self::$errMsg = IShoppingProcess::$errMsg;
            return false;
        }
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
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:抱歉，您的购物车商品列表中有套餐在该地址暂不销售，请选择其他商品";
            return false;
        }
        //无线侧新增新联营卖家的条件判断
        $hasNewJointOperation = false;
        foreach($items as $key => $item)
        {
            if($item['seller_id'] != 0 || $item['seller_address_id'] != 0)
            {
                $hasNewJointOperation = true;
                break;
            }
        }
        /*
         // 获取购物车中的商品列表，包括商品ID，购买数量.

        $ret = self::getItemList($uid, $wh_id, $offLine_params);
        if (false === $ret) {
            return false;
        } else {
            $items     = $ret['items'];
            $suiteInfo = $ret['suiteInfo'];
        }


         // 拉取商品基本信息

        $productIds = array();
        foreach ($items as $it) {
            $productIds[] = $it['product_id'];
        }

        $products = IProduct::getProductsInfo($productIds, $wh_id, true, false, $district);
        if (false === $products) {
            self::$errCode = IProduct::$errCode;
            self::$errMsg = "获取购物车商品信息失败";
            self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ", errMsg:拉去商品信息错误，" . IProduct::$errMsg;
            return false;
        }
        */

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
        /*
        $forbidList = array();
        foreach($products as $key => $value) {
            if ($value['restricted_trans_type'] > 0) {
                $forbidList[$value['restricted_trans_type']][] = $value['product_id'];
            }
        }*/
        
        // * 根据站点，赠品，库存的信息
         //* 处理items里面的商品信息, 返回限购限运等信息.  是否进行这个整合
        /*$ret = self::getItemInfo($items, $wh_id, $products, $district);
        if (false === $ret) {
            return false;
        } else {
            //限购逻辑. 
            $items          = $ret['items'];
            $forbidList     = $ret['forbidList'];
            $limitedProduct = $ret['limitedProduct'];
        }*/

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

        $ret = IPromotionRuleV2::checkRuleForOrder(
            $items, $wh_id, $uid, $rule_id, $isEnergySavingType
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
            return false;
        } else {
            $promotion = $ret['promotion'];
            $items     = $ret['items'];
        }
        
        /**
         *  接入服务化 hedyhe 将校验限购的逻辑统一到一处
         *  
         //限购检查逻辑. 
         
        if (false === self::_checkProductsLimitation($items)) {
            return false;            
        }
        */

        /**
         * 合并分拆为普通商品, 套餐商品和所有商品3个节点数组. 
         */
        /*
        $ret = self::splitSuiteItems($items, $suiteInfo);
        $items = $ret['items'];
        */

        /**
         *拆分订单逻辑. 

        $orders = self::DivideOrder($items, $wh_id, $promotion);
        if (false === $orders) {
            return false;
        } else {
            //订单的包裹信息，包括虚库，重量，具体的包裹信息等等
            $order = $orders['order'];
            $itemsForConflict = $orders['itemsForConflict'];
            $order['user_level'] = $userInfo['level'];
        }
        */

        /*
         * 配送服务化接入
         * 
         *
         * */
        $delivery4order = MShoppingProcess::getDeliveryInfo4Order($items, $inventorys, $wh_id,$district ,  $uid ,$userInfo['level']);
        if(false === $delivery4order) {
            self::$errCode = -8001;
            self::$errMsg = "抱歉，您选择的商品在该地址无法配送，请选择其他商品";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:抱歉，您的购物车商品列表中有商品在该地址无法配送，请选择其他商品";
            return false;
        }

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

       
        /*
        //如果购物车中商品有限购商品，则查询该用户当天的订单
        if ($uid > 0) {
            $ret = IOrder::checkLimitOrder($uid, $limitedProduct, $order['items']);
            if ($ret === false) {
                self::$errMsg = IOrder::$errMsg;
                self::$errCode = IOrder::$errCode;
                self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ",errMsg:查询限购信息失败，" . IOrder::$errMsg;
                return false;
            }
        }
        */
        
        /*
         // 获取订单配送信息
         
        $deliveryInfo = IPreOrderV2::getOrderDeliveryInfo($order, $district, $wh_id, $products, $forbidList);
        if ($deliveryInfo === false) {
            return false;
        }
        */

        /**
         * 检查订单中是否华为有预购商品
         * @ixiuzeng添加
         */
        global $PreOrderProduct;
        foreach ($delivery4order['packages'] as $psystock => $pack) {
            foreach ($pack['items'] as $pid => $pinfo) {
                $delivery4order['packages'][$psystock]['items'][$pid]['isHuaWeiIShare'] = in_array($pack['items'][$pid]['product_id'], $PreOrderProduct['items']);
            }
        }
        $items = $delivery4order['items'];
        /**
         * 重新取pid，中间的操作过程，可能把某些pid给删除掉了，
         * 凡是引起items发生变化的过程，请在这之前调用
         */
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
        $conflictProducts = IDIYInfo::checkProductsMatch($productIds_final);
        $isDealer = isset($userInfo['type']) ? ($userInfo['type'] == USER_IS_DEALER) : false;

        return array(
            'invoice'          => $delivery4order['availableInvoices'],
            'totalCut'         => $delivery4order['totalCut'],
            'totalAmt'         => $delivery4order['totalAmt'],
            'totalWeight'      => $delivery4order['totalWeight'],
            'suiteInfo'        => $suiteInfo,                    //套餐的信息
            'packageList'      => $delivery4order['packages'],     //拆单的包裹信息
            'shipList'         => $delivery4order['shippingType'],
            'conflict'         => $conflict, //TAPD 5484733 冲突检查
            'conflictProducts' => $conflictProducts,
            'promotion'        => $promotion,
            'promoCoupon'      => $coupon,
            'userIsDealer'     => $isDealer,
            'hasNewJointOperation' => $hasNewJointOperation,
        );
    }


    /**
     * listProductsInfo()
     *
     * 订单确认页(前端cmd参数为603的请求.)
     * 获取商品列表信息, 配送信息, 促销信息(多价系统), 拆单信息等.
     *
     * 促销2.0修改逻辑.
     * 去掉原逻辑中的随心配和EDM专享价, 价格经由多价系统处理.
     * 调用多价系统的IPromotionRuleV2::getRuleForShoppingCart()
     * 
     * @param (int) $uid, 用户ID.
     * @param (int) $wh_id, 分站ID.
     * @param (int) $district, 三级地区ID.
     * @param (array) $offLine_params, 离线购物车参数.
     *        包括$offLine_params['type']购物车类型和$offLine_params['items'], 
     *        $offLine_params['type']: 0为正常购物车, 非0为离线购物车.
     *        $offLine_params['items'], 离线购物车时商品信息保存在该参数中, json格式.
     * @return (array) 返回数组包括商品列表, 套餐信息, 促销规则, 配送信息等.
     *
     * @Date: 2013.3(bluexchen)
     */
    public static function listProductsInfo($uid, $wh_id, $district, $offLine_params)
    {
		$conflicts = NULL;
        /**
         * 设置购物车类型, 0表示正常购物车
         */
        $shopping_cart_type = !empty($offLine_params['type'])
                            ? $offLine_params['type'] : IShoppingCartV2::ONLINE_CART;

       

		/* 接入套餐赠品随心配和商品库存服务化之后的调整
         * hedyhe
         * */
        $ret = IShoppingProcess::getAllCartItemsInfo($uid,$wh_id,$district,$offLine_params);
        if(false  === $ret) {
            self::$errCode = IShoppingProcess::$errCode;
            self::$errMsg = IShoppingProcess::$errMsg;
            return false;
        }
		$items = $ret['items'];
		$suiteInfo = $ret['suiteInfo'];
        $promoCoupon = $ret['promoCoupon'];
		$products = $ret['products'];
        $productIds = $ret['productIds'];
        $forbidList = $ret['forbidList'];
        if(empty($items))
        {
            return array(
                'items'     => array(),
                'suiteInfo' => array(),
                'promoRule' => array(),
                'coupons'   => array(),
            );
        }
        //无线侧新增新联营卖家的条件判断
        $hasNewJointOperation = false;
        foreach($items as $key => $item)
        {
            if($item['seller_id'] != 0 || $item['seller_address_id'] != 0)
            {
                $hasNewJointOperation = true;
                break;
            }
        }
		//获取预约商品的信息 hedyhe 2013-04-27  套餐赠品随心配商品信息库存服务化接入
		$ret = IShoppingProcess:: SetAppoint($items, $wh_id, $products);
		if(false === $ret) {
            self::$errCode = IShoppingProcess::$errCode;
            self::$errMsg = IShoppingProcess::$errMsg;
			return false;
		} else {
		  $items = $ret;  // 待确认
		}

        $strItems = ToolUtil::gbJsonEncode($items);
      //  Logger::info("getItemInfo result:{$strItems}");
		
        /**
         * 促销2.0改版, 获取多价和批价信息.
         *
         * 多价统一IPreOrderV2::getRuleForShoppingCartNew方法. (该方法内部时序应该为先处理"多价", 再处理"批价")
         */
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

        $promotionRules = IPromotionRuleV2::getRuleForShoppingCart(
            $items, $wh_id, $isEnergySavingType, $uid
        );
        if (false === $promotionRules) {
            self::$errMsg = '获取多价信息失败.';
            self::$errCode = 99;
            self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ",errMsg:获取多价信息失败.";
            return false;
        } else {
            $promotion = $promotionRules['rules'];
            $items     = $promotionRules['items'];
            unset($promotionRules['rules'], $promotionRules['items']);
        }
        /**
         * 合并分拆为普通商品, 套餐商品和所有商品3个节点数组. 
         */
        /*
        $ret = self::splitSuiteItems($items, $suiteInfo);
        $items = $ret['items'];
        $strItems = ToolUtil::gbJsonEncode($items);
        Logger::info("splitSuiteItems result:{$strItems}");
        */

        /**
         * 拆分订单逻辑. 
         */
        $divideOrder = self::DivideOrder($items, $wh_id);
        if (false === $divideOrder) {
            return false;
        } else {
            // 订单的包裹信息，包括虚库，重量，具体的包裹信息等等
            $order = $divideOrder['order'];
        }
        $strItems = ToolUtil::gbJsonEncode($items);
        //Logger::info("DivideOrder result:{$strItems}");
        /**
         * 获取订单配送信息
         */
        $deliveryInfo = IPreOrderV2::getOrderDeliveryInfo($order, $district, $wh_id, $products, $forbidList);
        if ($deliveryInfo === false) {
            return false;
        } else {
            $items = $deliveryInfo['items'];
        }
		//服务类商品跨仓检查逻辑 TAPD 5484733
		$conflictCheck = false;
		foreach($items as $_key => $item) {
			if ($item['stock_desc'] == '无法配送' || $item['stock_desc'] == '暂时无货') {
				$conflictCheck = true;
				break;
			}
		}
		
		$conflicts = $conflictCheck ? array() : self::diyProductStcokCheck($products, $wh_id);
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

       

        $result = array(
            'items'     => $items,      //商品列表
            'suiteInfo' => $suiteInfo,  //套餐信息
            'promoRule' => $promotion,  //促销规则
            'coupons'   => $promoCoupon,    //优惠卷
			'conflict' => $conflicts, //冲突数据
            'hasNewJointOperation' => $hasNewJointOperation,
        );

        /**
         * 返回时, 把IPromotionRuleV2::getRuleForShoppingCart中关
         * 于促销规则的一同合并返回. 
         */
        return array_merge($result, (array) $promotionRules);
    }


    /**
     * 抽取公共的获得促销规则代码
     * @param array $promoItems 促销商品（不会修改，传入引用）
     * @param int $whId 分站ID
     * @param int $uid 用户ID
     * @return mixed array 促销规则；false 获取失败
     */
    public static function getPromotionRules(&$promoItems, $whId, $uid = 0)
    {
        $promoRule = IPromotionRule::getRuleForShoppingCart($promoItems, $whId, $uid);
        if ($promoRule === false) {
            Logger::warn('IPromotionRule::getRuleForShoppingCart failed-' . IPromotionRule::$errCode . '-' . IPromotionRule::$errMsg);
            $promoRule = array();
        } else {
            $promoRule = empty($promoRule) ? array() : ToolUtil::gbJsonDecode($promoRule);
            if (isset($promoRule['errCode'])) { //除去不需要显示到前端的信息
                unset($promoRule['errCode']);
                unset($promoRule['errMsg']);
            }
        }

        if (isset($promoRule['rules']) && is_array($promoRule['rules'])) {
            foreach ($promoRule['rules'] as $i => &$rule) {
                IPromotionRule::appendNameOfRule($rule);
            }
        }
        return $promoRule;
    }


    /* 获取订单的配送信息
     * 参数说明
     * $order = array(
            'items' => array()
            'isVirtual' => array(),
            'weight' => array(),
            'packages' => array(),

        );
     * */

    public static function getOrderDeliveryInfo($order, $district, $wh_id, $productInfo, $forbidList)
    {
        global $_District, $_SelfFetchProductids;

        if (!isset($order['packages']) || !is_array($order['packages'])) {
            self::$errCode = -1;
            self::$errMsg = "获取订单信息失败";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg: package s参数格式错误";
            return false;
        }

        if (!isset($order['isVirtual']) || !is_array($order['isVirtual'])) {
            self::$errCode = -2;
            self::$errMsg = "获取订单信息失败";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg: isVirtual 参数格式错误";
            return false;
        }

        if (!isset($order['weight']) || !is_array($order['weight'])) {
            self::$errCode = -3;
            self::$errMsg = "获取订单信息失败";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg: weight 参数格式错误";
            return false;
        }

        if (!isset($order['items']) || !is_array($order['items'])) {
            self::$errCode = -4;
            self::$errMsg = "获取订单信息失败";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg: items 参数格式错误";
            return false;
        }

        $packages = $order['packages'];
        $isVirtual = $order['isVirtual'];
        $weight = $order['weight'];
        $items = $order['items'];
        $user_level = empty($order['user_level']) ? 0 : $order['user_level'];

        $productIds = array_keys($productInfo);
        // 获得配送方式
        $orderPrice = 0;
        foreach ($packages as $p) { //计算总金额
            $orderPrice += $p['totalAmt'];
        }
        $shippingType = IPreOrderV2::getShippingTypeByDestination($district, $orderPrice, $isVirtual, $weight, $wh_id, $user_level);
        if ($shippingType === false) {
            return false;
        }

        // 限运逻辑检查
        $shipNotAvailable = array();
        if (!empty($forbidList)) {
            $shipNotAvailable = IShipping::getForbidenShippingType($forbidList, $_District[$district]['province_id'], $_District[$district]['city_id'], $district, $wh_id);
        }

        // 去除不可用的配送方式
        $shipForbidProducts = array();
        $isEffect = false;
        foreach ($shippingType as $key => $shipping) {
            if (isset($shipNotAvailable[$key])) {

                // 记录 生效的限运 方式 对应的商品
                $shipForbidProducts = array_merge($shipNotAvailable[$key], $shipForbidProducts);

                // 从 可用的配送方式 中 去除被限运的
                unset($shippingType[$key]);

                if (count($shippingType) == 0)
                    $isEffect = true;
            }
        }

        //如果不包含这些特殊商品，需要剔除自提
        $bothExist = array_intersect($_SelfFetchProductids, $productIds);
        if (count($bothExist) == 0) {
            foreach ($shippingType as $key => $it) {
                // 自提包括很多种，后台可能随时会添加，在现有没有标记的情况下，用字符来判断比较好
                if (false === strpos($it['ShipTypeName'], '上门提货')) {
                    continue;
                }
                unset($shippingType[$key]);
            }
        }


        // 没有可用的配送方式，
        if (count($shippingType) == 0) {
            //是由于限运引起的配送方式为空
            if ($isEffect) {
                // 把这些商品的 限购状态描述 覆盖到库存状态描述
                foreach ($shipForbidProducts as $pid) {
                    // 更新包裹中的商品的限运描述
                    foreach ($packages as $psystock => $pack) {
                        if (!isset($pack['items'][$pid]))
                            continue;

                        $packages[$psystock]['items'][$pid]['stock_desc'] = "无法配送";
                        $packages[$psystock]['items'][$pid]['stock_status'] = $productInfo[$pid]['restricted_trans_type'];

                        foreach ($items as $_key => $_item) {
                            if ($_item['product_id'] == $pid) {
                                $items[$_key]['stock_desc'] = "无法配送";
                                $items[$_key]['stock_status'] = $productInfo[$pid]['restricted_trans_type'];
                            }
                        }

                        break;
                    }
                }
            } else {
                // 不可以配送
                foreach ($packages as $psystock => $pack) {
                    foreach ($pack['items'] as $pid => $it) {
                        $packages[$psystock]['items'][$pid]['stock_desc'] = "无法配送";
                        $packages[$psystock]['items'][$pid]['stock_status'] = 99;

                        //$items[$pid]['stock_desc'] = "无法配送";;
                        //$items[$pid]['stock_status'] = 99;
                        foreach ($items as $_key => $_item) {
                            if ($_item['product_id'] == $pid) {
                                $items[$_key]['stock_desc'] = "无法配送";
                                $items[$_key]['stock_status'] = 99;
                            }
                        }
                    }
                }
            }
        }

        return array(
            'items'        => $items,
            'packages'     => $packages,
            'shippingType' => $shippingType,
        );
    }


    private static function checkPromotionRule($uid, $rule_id, $apply_times, $items, $wh_id)
    {
        $promotion = array();
        if ($apply_times <= 0) {
            self::$errCode = -990;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[Promotion Rule apply_times($apply_times) is invalid]";
        } else {
            $promotionRule = IPromotionRule::checkRuleForOrder($items, $wh_id, $uid, $rule_id, $apply_times);
            if (false === $promotionRule) {
                Logger::err("checkRuleForOrder failed:" . IPromotionRule::$errMsg);
            } else {
                $promotionRule = json_decode($promotionRule, true);
                if (is_array($promotionRule)) {
                    if ($promotionRule['errCode'] == -2007) {
                        self::$errCode = -991;
                        self::$errMsg = "促销资源不足";
                        self::$logMsg = basename(__FILE__) . "line," . __LINE__ . ",促销资源不足" . $promotionRule['errMsg'];
                        return false;
                    } else if ($promotionRule['errCode'] != 0 || !isset($promotionRule['rules'][0])) { //拉取促销规则失败
                        self::$errCode = $promotionRule['errCode'];
                        self::$errMsg = $promotionRule['errMsg'];
                        self::$logMsg = basename(__FILE__) . "line," . __LINE__ . ",促销资源不足" . $promotionRule['errMsg'];
                        return false;
                    } else {
                        //还需要检测该用户已经使用该规则的次数
                        if ($promotionRule['rules'][0]['apply_time_peruser'] < 999) {
                            $db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
                            $orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
                            if (!empty($orderDb)) {
                                $sql = "select order_char_id from t_orders_{$db_tab_index['table']} where uid=$uid and coupon_code='rule_{$rule_id}' and status >= 0";
                                $count = $orderDb->getRows($sql);
                                if (is_array($count) && count($count) >= $promotionRule['rules'][0]['apply_time_peruser']) {
                                    self::$errCode = -992;
                                    self::$errMsg = "您已经参加过次促销优惠" . count($count) . "次，不能再参加";
                                    return false;
                                }
                            }
                            $promotion = $promotionRule['rules'][0];
                        } else {
                            $promotion = $promotionRule['rules'][0];
                        }

                        $promotion['benefits'] = 0;
                        //如果是换购，赠送商品，则需要在items添加一条记录
                        if ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_HUANGOU'] ||
                            $promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_PRODUCT']
                        ) {
                            $promotionGiftProduct = array(
                                'product_id'      => $promotion['discount'],
                                'buy_count'       => $promotion['benefit_per_time'] * $promotion['benefit_times'],
                                'main_product_id' => 0,
                                'createtime'      => 0,
                                'isPromotionGift' => true,
                            );
                            $items[] = $promotionGiftProduct;
                        } else if ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_CASH']) {
                            $promotion['benefits'] = $promotion['benefit_times'] * $promotion['benefit_per_time'];
                        } else if ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_DISCOUNT']) {
                            $promotion['benefits'] = $promotion['discount'];
                        }
                    }
                }
            }
        }

        return array(
            'promotion' => $promotion,
            'items'     => $items
        );
    }

    /**
     * 获取可选的发票种类
     */
    public static function getInvoicesContentOpt($c3ids, $wh_id) {
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

    public static function getEDMInfo($userInfo, $wh_id, $products)
    {
        global $_EmailStat, $_MobileStat;
        $uid = $userInfo['uid'];
        // 解析 edm 价格专享字段
        $needToCheckVIP = false;
        $edmCodeToProduct = array();
        if (isset($_COOKIE['edm']) && $_COOKIE['edm'] != '') {
            $edmArr = explode(",", $_COOKIE['edm']);
            foreach ($edmArr as $ll) {
                $tmp = explode('_', $ll);
                if (isset($tmp[0]) && isset($tmp[1])) {
                    if ($tmp[0] == 'ttpgn' //功能性tips验证特殊EDM代码
                        && (!isset($_COOKIE['edm_key'])
                            || !isset($_COOKIE['new_u'])
                            || (substr(md5($userInfo['openID'] . "icson@qq"), 0, 6) != $_COOKIE['edm_key'])
                            || $_COOKIE['new_u'] != '1')
                    ) {

                        continue;
                    }

                    $edmCodeToProduct[] = array('code' => $tmp[0], 'product_id' => $tmp[1]);
                    if ($tmp[0] == 'QQVIP0326') {
                        $needToCheckVIP = true;
                    }
                }
            }
        }
        if (count($edmCodeToProduct) > 0) {
            $isVip = false;
            if ($needToCheckVIP === true) {
                $isVip = IUser::checkQQVipByIcsonID($userInfo['icsonid']);
            }
            //拉取edm专享价格
            $MSDB = ToolUtil::getMSDBObj('ERP_' . $wh_id);
            if (false === $MSDB) {
                self::$errCode = ToolUtil::$errCode;
                self::$errMsg = ToolUtil::$errMsg;
                self::$logMsg = ToolUtil::$errMsg;
                return false;
            }
            $now = date('Y-m-d H:i:s');
            $sql = "SELECT EDMCode, ProductSysNo,
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
                self::$logMsg = $MSDB->errMsg;
                return false;
            }
            $isEmailVerify = 0;
            $isTelVerify = 0;
            $needLevel = 0;
            foreach ($edmItems as $key => $ei) {
                $exist = false;

                foreach ($edmCodeToProduct as $ep) {
                    if ($ep['code'] == $ei['EDMCode'] && $ep['product_id'] == $ei['ProductSysNo']) {
                        $isEmailVerify == 0 ? ($isEmailVerify = $ei['IsEmailVerification']) : '';
                        $isTelVerify == 0 ? ($isTelVerify = $ei['IsMobileVerification']) : '';
                        if ($needLevel == 0 && $ei['MemberLevelRange'] != '') {
                            $needLevel = 1;
                        }
                        $exist = true;
                        break;
                    }
                }
                if (false === $exist) {
                    Logger::info("unset {$key}");
                    unset($edmItems[$key]);
                }
            }

            $userBindEmail = 0;
            $userBindMobile = 0;
            if ($isEmailVerify == 1 || $isTelVerify == 1 || $needLevel == 1) {

                if (1 == $isEmailVerify && '' != $userInfo['email']) {
                    $userEmailInfo = IEmailLoginTTC::get($userInfo['email'], array('uid' => $uid), array('status'));
                    if (isset($userEmailInfo[0])) {

                        $userBindEmail = $userEmailInfo[0]['status'] == $_EmailStat['bound'] ? 1 : 0;
                    }
                }
                if (1 == $isTelVerify && '' != $userInfo['mobile']) {
                    $userMobileInfo = ITelLoginTTC::get($userInfo['mobile'], array('uid' => $uid), array('status'));
                    if (isset($userMobileInfo[0])) {

                        $userBindMobile = $userMobileInfo[0]['status'] == $_MobileStat['bound'] ? 1 : 0;
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
                if ($ei['MemberLevelRange'] != '' && !in_array($userInfo['level'], explode(',', $ei['MemberLevelRange']))) {
                    continue;
                }

                //促销2.0, 价格从多价中取, 注释掉价格处理逻辑. 
                //$products[$ei['ProductSysNo']]['price'] = $ei['EDMPrice'] * 100;
                $products[$ei['ProductSysNo']]['edm'] = $ei['EDMCode'];
                ;
            }
        }
        return $products;
    }


    public static function DivideOrder($items, $wh_id, $promotion = array())
    {
        global $_StockToStation;
        $result = array();
        $limitedProduct = array();

        //拉取随心配,同时检查是否能开赠票，能否模糊开票
        $matchPids = array();
        $totalAmt = 0;
        $totalWeight = 0;
        $totalCut = 0;
        $isCanVATInvoice = true;
        $c3ids = array();
        $rule_total_amt = 0;

        //开始根据商品所在物理仓储拆单
        $packages = array();
        $isVirtual = array();
        $weight = array();
        $itemsForConflict = array();
        

        foreach ($items as $key => $item) {
            if (!isset($packages[$item['psystock']]['items'][$item['product_id']])) {
                /**
                 * 这里把多价信息均去除掉了. 
                 * 暂时注释精简操作.
                 */
                $itemMin = $item;
                // TODO: item中信息太多，精简一部分
                /*
                $itemMin = array(
                    'product_id'           => $item['product_id'],
                    'buy_count'            => $item['buy_count'],
                    'main_product_id'      => $item['main_product_id'],
                    'price_id'             => $item['price_id'],
                    'size'                 => $item['size'],
                    'color'                => $item['color'],
                    'name'                 => $item['name'],
                    'product_char_id'      => $item['product_char_id'],
                    'type'                 => $item['type'],
                    'flag'                 => $item['flag'],
                    'canAddToWireLessCart' => $item['canAddToWireLessCart'],
                    'rushing_buy'          => $item['rushing_buy'],
                    'canUseCoupon'         => $item['canUseCoupon'],
                    'price'                => $item['price'],
                    'cash_back'            => $item['cash_back'],
                    'point'                => $item['point'],
                    'num_limit'            => $item['num_limit'],
                    'stock_status'         => $item['stock_status'],
                    'stock_desc'           => $item['stock_desc'],
                    'gift'                 => $item['gift'],
                    'lowest_num'           => $item['lowest_num'],
                    'package_id'           => isset($item['package_id']) ? $item['package_id'] : 0,
                    'product_amount'       => isset($item['product_amount']) ? $item['product_amount'] : $item['price'],
                );
                */

                // 如果有多价格名称， 则添加 discount_p_name
                #if (isset($item['discount_p_name'])) {
                #    $itemMin['discount_p_name'] = $item['discount_p_name'];
                #}
                //按物理仓储分子订单
                $packages[$item['psystock']]['items'][$item['product_id']] = $itemMin;

                /**
                 * unit_price
                 *
                 * 单价计算: 等于该商品的所有价格之和除以购买总数量. 
                 */
                $packages[$item['psystock']]['items'][$item['product_id']]['unit_price'] = $item['price'] * $item['buy_count'];
            } else {
                $packages[$item['psystock']]['items'][$item['product_id']]['buy_count'] += $item['buy_count'];
                $packages[$item['psystock']]['items'][$item['product_id']]['cash_back'] += $item['cash_back'];

                 //单价计算: 等于该商品的所有价格之和除以购买总数量. 
                $packages[$item['psystock']]['items'][$item['product_id']]['unit_price'] += ($item['price'] * $item['buy_count']);
            }

            if (!isset($packages[$item['psystock']]['isVirtual'])) {
                $packages[$item['psystock']]['isVirtual'] = 0;
                $packages[$item['psystock']]['vValue'] = 0;
            }

            if ($packages[$item['psystock']]['isVirtual'] < $item['isVirtual']) {
                $packages[$item['psystock']]['isVirtual'] = $item['isVirtual'];
                $packages[$item['psystock']]['vValue'] = $item['vValue'];
            }

            $isVirtual[$item['psystock']] = array(
                'type'  => $packages[$item['psystock']]['isVirtual'],
                'value' => $packages[$item['psystock']]['vValue'],
            );
            $itemsForConflict[] = $item['product_id'];
            if (0 == ($item['flag'] & CAN_VAT_INVOICE)) { //增值发票
                $isCanVATInvoice = false;
            }

            $c3ids[] = $item['c3_ids'];

            if ($item['main_product_id'] > 0) {
                $matchPids[] = $item['main_product_id'];
            }
            //@$packages[$item['psystock']]['totalAmt'] += $item['price'] * $item['buy_count'];
            @$packages[$item['psystock']]['totalAmt'] += $item['total_price_after'];
            @$packages[$item['psystock']]['totalCut'] += $item['buy_count'] * $item['cash_back'];
            @$packages[$item['psystock']]['totalWeight'] += $item['buy_count'] * $item['weight'];

            if (isset($promotion['benefit_type']) && $promotion['benefit_type'] == IPromotionRuleV2::$BenfitTypeNew['BENEFIT_TYPE_CASH'] && $promotion['benefits'] > 0)
            {
                if (isset($item['product_id'], $promotion['pids']) && in_array($item['product_id'], $promotion['pids'])) { //计算每个子单中满足促销规则的商品的总价格，便于在子单之间分摊促销成本
                    @$packages[$item['psystock']]['rule_total_amt'] += $item['price'] * $item['buy_count'];
                    $rule_total_amt += $item['price'] * $item['buy_count'];
                }
            }

            //$totalAmt += ($item['price']) * $item['buy_count'];
            //$totalWeight += $item['buy_count'] * $item['weight'];
            //$totalCut += $item['buy_count'] * $item['cash_back'];

            /**
             * 促销2.0处理逻辑. 
             * 价格处理改为由多价返回字段处理. 
             */
            $totalAmt += $item['total_price_after'];
            $totalWeight += $item['buy_count'] * $item['weight'];
            $totalCut += ($item['buy_count'] * $item['cash_back']);
            
            foreach ($item['gift'] as $g) {
                @$packages[$item['psystock']]['totalWeight'] += (($item['buy_count'] * $g['num']) <= $g['stock_num'] ? ($item['buy_count'] * $g['num']) : $g['stock_num']) * $g['weight'];
                $totalWeight += (($item['buy_count'] * $g['num']) <= $g['stock_num'] ? ($item['buy_count'] * $g['num']) : $g['stock_num']) * $g['weight'];
            }

            if (isset($_StockToStation[$item['psystock']])) {
                $packages[$item['psystock']]['stock_wh_id'] = intval($_StockToStation[$item['psystock']]);
            } else {
                $packages[$item['psystock']]['stock_wh_id'] = 0;
            }
            $packages[$item['psystock']]['stock_wh_id'] = intval($_StockToStation[$item['psystock']]);
            $packages[$item['psystock']]['wh_id'] = intval($wh_id);
            $packages[$item['psystock']]['cross_stock'] = $packages[$item['psystock']]['wh_id'] !== $packages[$item['psystock']]['stock_wh_id'] ? 1 : 0;
            // 重量放在最后获取
            $weight[$item['psystock']] = $packages[$item['psystock']]['totalWeight'];
        }


        /**
         * unit_price
         *
         * 单价计算: 等于该商品的所有价格之和除以购买总数量. 
         * 避免3重循环, 用判断key是否存在然后直取的方式计算unit_price. 
         * (foreach循环使用引用方式)
         *
         * $packages数组结构大致如下: 
         * $packages = array(
         *     '分仓ID' = array(
         *         '物品ID' = array('一系列的值'),
         *         '物品ID' = array('一系列的值'),
         *     }
         *     '分仓ID' = array(
         *         '物品ID' = array('一系列的值'),
         *         '物品ID' = array('一系列的值'),
         *     }
         * )
         *
         */
        
        foreach ($packages as &$stockPackage) {
            if (!isset($stockPackage['items'])) {
                continue;
            }
            $stockPackageItems = &$stockPackage['items'];
            foreach ($stockPackageItems as &$stockPackageItem) {
                if ($stockPackageItem['buy_count'] > 0) {
                    $stockPackageItem['unit_price'] = $stockPackageItem['unit_price']
                                                    / $stockPackageItem['buy_count'];
                }
            }
        }
        unset($stockPackage, $stockPackageItem);
        
        //分摊促销规则在各个子订单的分摊金额
/*
        if (isset($promotion['benefit_type']) && $promotion['benefits'] > 0) {
            $last = 0;
            ksort($packages);
            $remain = $promotion['benefits'];
            foreach ($packages as $subKey => $subOrder) {
                if (isset($subOrder['rule_total_amt'])) {
                    $tmp = 10 * bcdiv($subOrder['rule_total_amt'] * $promotion['benefits'], $rule_total_amt * 10, 0);
                    $packages[$subKey]['rule_benefits'] = $tmp;
                    $remain -= $tmp;
                    $last = $subKey;
                } else {
                    $packages[$subKey]['rule_benefits'] = 0;
                }
            }
            
            if (0 != $remain) {
                $packages[$last]['rule_benefits'] += $remain;
            }

        } else { //都返回 rule_benefits 字段, 方便前台计算
            foreach ($packages as $subKey => $subOrder)
                $packages[$subKey]['rule_benefits'] = 0;
        }
        */
        // 计算随心配搭配的数量
        $ret = self::getEasyMatch($items, $wh_id, $packages);
        if (false === $ret)
            return false;

        $items = $ret['items'];
        $packages = $ret['packages'];
        //不需要计算从随心配中出来的价格. 
        //$totalCut += $ret['totalCut'];
        $availableInvoices = array(
            'isCanVAT'    => $isCanVATInvoice,
            //如果购物车中有笔记本类商品，需要提示以公司开普通发票，无法保修
            'hasNoteBook' => in_array(234, $c3ids) ? 1 : 0,
            //拉取商品三级分类，判断是否能模糊开票
            'contentOpt'  => IPreOrderV2::getInvoicesContentOpt($c3ids, $wh_id),
        );
        $result['availableInvoices'] = $availableInvoices;

        $order = array(
            'isVirtual' => $isVirtual,
            'weight'    => $weight,
            'packages'  => $packages,
            'items'     => $items,
        );

        $result['order'] = $order;
        $result['totalCut'] = $totalCut;
        $result['totalAmt'] = $totalAmt;
        $result['totalWeight'] = $totalWeight;
        $result['itemsForConflict'] = $itemsForConflict;
        $result['limitedProduct'] = $limitedProduct;

        return $result;
    }


    /**
     * @static 根据商品和分站信息，确定要回传的商品
     * @param $items
     * @param $wh_id
     * @param $products
     * @return array|bool
     */
    public static function getItemInfo($items, $wh_id, $products, $district_id=0)
    {
        // 获取主商品的信息
        $ret = self::getMainItemsInfo($items, $wh_id, $products, $district_id);
        if ($ret === false)
            return false;

        $items = $ret['items'];
        $productIds = $ret['productIds'];
        $limitedProduct = $ret['limitedProduct'];
        $forbidList = $ret['forbidList'];


        // 获取有货的主商品对应的赠品信息
        $ret = self::getGiftItemsInfo($items, $productIds, $products);
        if ($ret === false)
            return false;

        $items = $ret;


        // 设置预约商品的属性
        $ret = self::setAppointInfo($items, $wh_id, $products);

        $items = $ret;

        return array(
            'items'          => $items,
            'forbidList'     => $forbidList,
            'limitedProduct' => $limitedProduct
        );
    }


    /**
     * @static 获取主商品的信息
     * @param $items
     * @param $wh_id
     * @param $products
     * @return array
     */
    private static function getMainItemsInfo($items, $wh_id, $products, $district_id)
    {
        global $_ColorList, $_PROD_SIZE_2;

        $productIds = array();
        $forbidList = array();
        $limitedProduct = array();

        foreach ($items as $key => $item) {
            //$exist =  isset($products[$item['product_id']]) ? true : false;
            if (!isset($products[$item['product_id']])) {
                unset($items[$key]);
                //$deleteProductIds[] = $item['product_id'];
                continue;
            }
            $product = $products[$item['product_id']];


            if ($product['restricted_trans_type'] > 0)
                $forbidList[$product['restricted_trans_type']][] = $product['product_id'];

            // 如果设置了多价格
            if (isset($product['discount_p_name'])) {
                $items[$key]['discount_p_name'] = $product['discount_p_name'];
            }

            //$items[$key]['discount_p_name'] = isset($product['discount_p_name']) ? $product['discount_p_name'] : "";
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
            $items[$key]['canAddToWireLessCart'] = ($wh_id == 1 && $product['psystock'] == 1);
            $items[$key]['rushing_buy'] = ($product['flag'] & OTHER_TIME_LIMITED_RUSHING_BUY) == OTHER_TIME_LIMITED_RUSHING_BUY; //抢购
            $items[$key]['canVAT'] = ($product['flag'] & CAN_VAT_INVOICE) == CAN_VAT_INVOICE;
            $items[$key]['canUseCoupon'] = ($product['flag'] & COUPON_PRODUCT) != COUPON_PRODUCT;
            $items[$key]['cash_back'] = isset($items[$key]['cash_back']) ? $items[$key]['cash_back'] + $product['cash_back'] : $product['cash_back'];
            $items[$key]['price'] = $product['price'] + $items[$key]['cash_back'];
			$items[$key]['price'] = $product['price'];// + $items[$key]['cash_back'];


            // 默认不是虚库商品
            $items[$key]['isVirtual'] = IProduct::NO_DELAY;
            $items[$key]['lowest_num'] = !empty($product['lowest_num']) ? $product['lowest_num'] : 1;
            $items[$key]['delay_days'] = 0;
            if (isset($promotion['benefit_type'])) {
                if ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_HUANGOU']
                    && $item['product_id'] == $promotion['discount']
                ) { //换购

                    $dis = ($product['price'] - $promotion['plus_con']) > 0 ? ($product['price'] - $promotion['plus_con']) : 0;
                    $promotion['benefits'] = $dis * $promotion['benefit_times'] * $promotion['benefit_per_time'];
                } else if ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_PRODUCT']
                    && $item['product_id'] == $promotion['discount']
                ) { //赠送商品

                    $promotion['benefits'] = $product['price'] * $promotion['benefit_times'] * $promotion['benefit_per_time'];
                }
            }

            $items[$key]['point'] = $product['point'];

            //临时修改节能补贴商品num_limit信息-99999
            $items[$key]['num_limit'] = $product['num_limit'] < 0 ? 999 : $product['num_limit'];
			// 这里有个限购的要处理
            if ($product['num_limit'] > 0 && $product['num_limit'] < 999) {
                $limitedProduct[] = $product['product_id'];
            }

            // 库存状态描述
            $total_stock_num = $product['num_available'] + $product['virtual_num'];

            if ($product['status'] != PRODUCT_STATUS_NORMAL) {
                $items[$key]['stock_desc'] = IProductInventory::$_StockTips['not_sale'];
                $items[$key]['stock_status'] = IProductInventory::$_StockStatus['not_sale'];
            } else if ($product['price'] == 99999900) {
                $items[$key]['stock_desc'] = IProductInventory::$_StockTips['invalid_price'];
                $items[$key]['stock_status'] = IProductInventory::$_StockStatus['invalid_price'];
            } else if ($total_stock_num == 0) {
                $items[$key]['stock_desc'] = IProductInventory::$_StockTips['not_available'];
                $items[$key]['stock_status'] = IProductInventory::$_StockStatus['not_available'];
            } else if (($total_stock_num > 0 && $total_stock_num >= $item['buy_count']) ||
                (($wh_id == SITE_SH) && ($product['flag'] & FORBID_SET_VIRTUAL) != FORBID_SET_VIRTUAL && $product['type'] == PRODUCT_TYPE_NORMAL)
            ) {

                // 库存延迟，包括虚库和跨仓
                    $items[$key] = self::setStockDelay($items[$key], $product, $wh_id, $district_id);

                // 预购延迟，如果判断为有预购延迟，则会覆盖虚库延迟逻辑
                $items[$key] = self::setBookingDelayType($items[$key], $product);

                // $productIds 为有货的主商品，查找赠品的时候需要用到
                $productIds[$item['product_id']] = $item['product_id'];
            } else {
                $items[$key]['stock_desc'] = IProductInventory::$_StockTips['not_enough'];
                $items[$key]['stock_status'] = IProductInventory::$_StockStatus['not_enough'];
            }
        }

        $resulst = array(
            'productIds'     => $productIds, // 有货的商品ID集合
            'forbidList'     => $forbidList, //  限运商品
            'limitedProduct' => $limitedProduct, // 限购商品
            'items'          => $items, // 所有商品的信息
        );

        return $resulst;
    }


    /**
     * @static 拉取有货的主商品对应的赠品信息
     * @param $items
     * @param $productIds
     * @param $products
     * @return array|bool
     */
    private static function getGiftItemsInfo($items, $productIds, $products)
    {
        global $_StockToStation;

        $gifts = IGiftNewTTC::gets(array_unique($productIds), array('status' => GIFT_STATUS_OK));
        if (false === $gifts) {
            self::$errCode = IGiftNewTTC::$errCode;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[query IGiftNewTTC failed]' . IGiftNewTTC::$errMsg;
            return false;
        }

        //剔除掉与主商品不在一个物理分仓

        $products_psy = array();
        $giftsValid = array();
        $products_gifts_type = array();
        foreach ($products as $pwinfo) {
            $products_psy[$pwinfo['product_id']] = $pwinfo['psystock'];
            // TODO:优化代码
            foreach ($gifts as $gi) {
                if (($pwinfo['product_id'] == $gi['product_id']) && ($_StockToStation[$pwinfo['psystock']] == $gi['stock_id'])) {
                    $giftsValid[] = $gi;
                    $products_gifts_type[$gi['product_id']][$gi['gift_id']][$gi['stock_id']] = $gi['type'];
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
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[query IInventoryStockTTC failed]' . IInventoryStockTTC::$errMsg;
            return false;
        }

        $giftValidInventory = array();
        foreach ($giftsValid as $gv) {
            foreach ($giftsInventorys as $gsi) {
                if (($gv['gift_id'] == $gsi['product_id']) && ($products_psy[$gv['product_id']] == $gsi['stock_id'])
                    && (($gsi['num_available'] + $gsi['virtual_num'] > 0) || COMPONENT_TYPE == $products_gifts_type[$gv['product_id']][$gv['gift_id']][$gv['stock_id']])
                ) {

                    $gv['num_available'] = $gsi['num_available'];
                    $gv['virtual_num'] = $gsi['virtual_num'];
                    $giftValidInventory[] = $gv;
                    break;
                }
            }
        }

        $gifts_final_ids = array();
        foreach ($giftValidInventory as $gvi) {
            $gifts_final_ids[] = $gvi['gift_id'];
        }

        //拉取礼品商品的基本信息
        $gift_base_info = IProductCommonInfoTTC::gets(array_unique($gifts_final_ids), array(), array('name', 'product_char_id', 'weight', 'pic_num'));
        if (false === $gift_base_info) {
            self::$errCode = IProductCommonInfoTTC::$errCode;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductCommonInfoTTC failed]' . IProductCommonInfoTTC::$errMsg;
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
                    $giftValidInventory[$key]['weight'] = $g_base['weight'];
                    $giftValidInventory[$key]['stock_num'] = $gift['num_available'] + $gift['virtual_num'];
                    break;
                }
            }

            if (false === $exist) {
                unset($giftValidInventory[$key]);
            }
        }

        //拉取礼品的在各个分仓的装填,赠品组件的状态不可能是出售状态
        $gift_wh_info = IProductInfoTTC::gets(array_unique($gifts_final_ids), array(), array('product_id', 'wh_id', 'status'));
        $gifts_status = array();
        if (false === $gift_wh_info) {
            self::$errCode = IProductInfoTTC::$errCode;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
            return false;
        }

        foreach ($gift_wh_info as $gwi) {
            $gifts_status[$gwi['product_id']][$gwi['wh_id']] = $gwi['status'];
        }

        //将赠品与其对应的主商品进行绑定

        foreach ($items as $key => $item) {
            $items[$key]['gift'] = array();
            foreach ($giftValidInventory as $gift) {
                $gift_status = isset($gifts_status[$gift['gift_id']][$_StockToStation[$gift['stock_id']]]) ? $gifts_status[$gift['gift_id']][$_StockToStation[$gift['stock_id']]] : false;
                if (($gift['product_id'] == $item['product_id']) && ($_StockToStation[$gift['stock_id']] == $_StockToStation[$item['psystock']])
                    && ($gift_status !== false && $gift_status != PRODUCT_STATUS_NORMAL)
                ) { //赠品组件的状态不可能是出售状态

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

        sort($items);
        return $items;
    }

    /**
     * Enter description here ...
     * @param  $items
     * @param  $wh_id
     * @param  $products
     * @param  $suitInfo
     * @param array $params
     */
    public static function getMultiPriceInfo($items, $wh_id, $products, $suitInfo)
    {
        $multiPriceProduct = array();
        foreach ($items as $item) {
            // 多价格取普通商品的价格id，套餐商品的价格id忽略
            if ($item['type'] != IShoppingCart::ITEM_NORMAL) {
                continue;
            }

            //如果是取没有价格，或者价格ID为0，忽略
            if (empty($item['price_id'])) {
                continue;
            }

            $multiPriceProduct[$item['product_id']]['price_id'] = $item['price_id'];
            $multiPriceProduct[$item['product_id']]['multiPriceType'] = 0; //默认都没有特殊价格
        }

        // $multiPriceProduct为空 则不需要处理过价格信息
        if (count($multiPriceProduct) > 0) {
            foreach ($multiPriceProduct as $pid => $mp) {
                if (isset($products[$pid])) {
                    $multiPriceProduct[$pid]['multiPriceType'] = $products[$pid]['multiprice_type'];
                }
            }

            $multiPriceInfo = IMultiPrice::getCartPrices(array('wh_id' => $wh_id, 'product' => $multiPriceProduct));
            if (isset($multiPriceInfo['Prices']) && is_array($multiPriceInfo['Prices'])) {
                foreach ($multiPriceInfo['Prices'] as $pid => $mp) {
                    if ($mp['isSatisfy'] == true && isset($products[$pid])) { //满足多价信息
                        if ($mp['count_type'] == MP_COUNT_BY_DISCOUNT) { //折扣
                            $products[$pid]['price'] = 10 * bcdiv($products[$pid]['price'] * $mp['price'], 1000, 0);
                        } else if ($mp['count_type'] == MP_COUNT_BY_PRICE) {
                            $products[$pid]['price'] = $mp['price'];
                        }
                        $products[$pid]['discount_p_name'] = $mp['price_name'];

                        // 在套餐信息中添加多价格信息
                        reset($suitInfo);
                        foreach ($suitInfo as $key => $suit) {
                            foreach ($suit['product_list'] as $p => $pInfo) {
                                // 找到每一个套餐中包含的多价格的商品
                                if ($p == $pid) {
                                    $suitInfo[$key]['product_list'][$p]['discount_p_name'] = $products[$pid]['discount_p_name'];
                                    $suitInfo[$key]['product_list'][$p]['product_amount'] = $products[$pid]['price'];
                                }
                            }
                        }
                    }
                }
            }
        }
        return array(
            'products_mpi'  => $products,
            'suiteInfo_mpi' => $suitInfo
        );
    }

    // 从在线或者离线购物车中获取商品列表
    public static function getItemList($uid, $wh_id, $offLine_params)
    {
        // 购物车类型
        $items = array();

        if ($offLine_params['type'] != IShoppingCart::ONLINE_CART) { //离线购物车，包括节能补贴，无线一键购买
            if (empty($offLine_params['items']) || !is_array($offLine_params['items'])) {
                self::$errCode = -1;
                self::$errMsg = "您的购物车商品列表为空";
                self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:离线购物车商品列表为空";
                return false;
            }

            foreach ($offLine_params['items'] as $item) {
                if (empty($item['product_id'])) {
                    self::$errCode = -1;
                    self::$errMsg = "您的购物车商品列表为空";
                    self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:离线购物车格式错误";
                    return false;
                }
                if ($item['product_id'] < 0) {
                    continue;
                }

                $items[] = array(
                    'product_id'      => $item['product_id'],
                    'buy_count'       => !empty($item['buy_count']) ? $item['buy_count'] : 1,
                    'main_product_id' => !empty($item['main_product_id']) ? $item['main_product_id'] : 0,
                    'price_id'        => !empty($item['price_id']) ? $item['price_id'] : 0,
                    'OTag'            => !empty($item['OTag']) ? $item['OTag'] : "",
                    'type'            => !empty($item['type']) ? $item['type'] : IShoppingCart::ITEM_NORMAL,
                    'package_id'      => IShoppingCart::NOT_BELONG_PACKAGE,
                    'chid'            => !empty($item['chid']) ? $item['chid'] : "",
                );
            }
        } else { // 在线购物车需要检查用户ID
            if (!isset($uid) || $uid <= 0) {
                self::$errCode = 101;
                self::$errMsg = "用户ID非法";
                self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:uid($uid) is invalid";
                return false;
            }

            $ret = IShoppingCartV2::get($uid);
            if (false === $ret) {
                self::$errCode = IShoppingCart::$errCode;
                self::$errMsg = "查找购物车失败";
                self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg: 查找({$uid})购物车失败" . IShoppingCart::$errMsg;
                return false;
            }

            foreach ($ret as $it) {
                if ($it['product_id'] < 0) {
                    continue;
                }

                $items[] = $it;
            }
        }

        $result = self::transPackageToItems($items, $wh_id);
        if (false === $result) {
            return false;
        }

        return $result;
    }

    private static function delItemInvalid($uid, $deleteProductIds)
    {
        //如果使用的是在线购物车，则删除不合法的购物车商品
        foreach ($deleteProductIds as $pid) {
            IShoppingCart::remove($uid, $pid);
        }
    }

	/**
	 * 计算随心配搭配的数量
	 * @param array $items
	 * @param int $wh_id
	 * @param array $packages
	 */
	public static function getEasyMatch($items, $wh_id, $packages = array()) {
        //处理随心配
        $easyMainProduct = array();
        foreach ($items as $key => $item) {
            if ($item['main_product_id'] > 0) {
                $mainProductExist = false;
                foreach ($items as $ii) {
                    if ($ii['product_id'] == $item['main_product_id']) {
                        $mainProductExist = true;
                        $items[$key]['matchNum'] = $ii['buy_count'] < $item['buy_count'] ? $ii['buy_count'] : $item['buy_count'];
                        break;
                    }
                }

                if (false === $mainProductExist) {
                    $items[$key]['main_product_id'] = 0;
                } else {
                    $easyMainProduct[$item['main_product_id']] = $item['main_product_id'];
                }
            }
        }

        //拉取随心配
        //ixiuzeng添加，广东站的随心配从广东站获取，上海和北京的随心配依然从上海获取
        $wh_id_easy_match = ($wh_id == SITE_SZ) ? SITE_SZ : SITE_SH;
        $easyMatch = IProductRelativityTTC::gets($easyMainProduct, array('type' => PRODUCT_BY_MIND, 'status' => 1, 'wh_id' => $wh_id_easy_match));
        if (false === $easyMainProduct) {
            self::$errCode = IProductRelativityTTC::$errCode;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductRelativityTTC failed]' . IProductRelativityTTC::$errMsg;
            return false;
        }

        $totalCut = 0;
        $results = array();
        if (count($easyMatch) > 0) {
            foreach ($items as $key => $item) {
                if ($item['main_product_id'] > 0) {
                    foreach ($easyMatch as $em) {
                        // 更新商品的 match_cut 字段
                        if ($item['main_product_id'] == $em['product_id'] && $em['type'] == PRODUCT_BY_MIND && $item['product_id'] == $em['relative_id']) {
                            $cut = intval($em['property']);
                            $cut = $cut > 0 ? $cut : 0;
                            //$items[$key]['match_cut'] = $cut;

                            // 如果有订单，需要更新订单的 $totalCut
                            if (!empty($packages)) {
                                $packages[$item['psystock']]['items'][$item['product_id']]['priceCutByMatch'] = intval($em['property']);

                                //去掉随心配价格处理逻辑.
                                //$totalCut += $item['matchNum'] * $packages[$item['psystock']]['items'][$item['product_id']]['priceCutByMatch'];

                                //$packages[$item['psystock']]['totalCut'] += $item['matchNum'] * $packages[$item['psystock']]['items'][$item['product_id']]['priceCutByMatch'];
                            }
                        }
                    }
                }
            }
        }

        $results['packages'] = $packages;
        $results['totalCut'] = $totalCut;
        $results['items'] = $items;
        return $results;
    }

    // 获得套餐中的商品
    private static function transPackageToItems($items, $wh_id)
    {
        $package_buycount = array();
        $package_ids = array();

        reset($items);
        foreach ($items as $key => $it) {
            if ($it['type'] == IShoppingCart::ITEM_PACKAGE) { //套餐
                $package_buycount[$it['product_id']] = $it['buy_count'];
                $package_ids[] = $it['product_id'];
                unset($items[$key]);
            } else if ($it['type'] == IShoppingCart::ITEM_NORMAL) { //商品
                //普通商品 package_id 设置为 NOT_BELONG_PACKAGE，表示不属于任何套餐
                $items[$key]['package_id'] = IShoppingCart::NOT_BELONG_PACKAGE;
                $items[$key]['unique_id'] = "{$it['product_id']}";
            }
        }

        // 如果为空，则直接返回 items
        if (empty($package_ids)) {
            return array(
                'items'     => $items,
                'suiteInfo' => array(),
            );
        }

        //完成套餐的get函数，通过套餐id，获取套餐的商品信息，包括 pid，buy_count，price_id
        $pkgs = EA_Promotion::getPackageInfoForCart($package_ids, $wh_id);
        if (false === $pkgs) {
            self::$errCode = EA_Promotion::$errCode;
            self::$errMsg = EA_Promotion::$errMsg;
            self::$logMsg = EA_Promotion::$errMsg;
            return false;
        }


        $total_product_saving_amount = 0;
        foreach ($pkgs as $key => $pkg) {
            foreach ($pkg['product_list'] as $pid => $product) {
                $items[] = array(
                    'product_id'      => $product['product_id'],
                    'buy_count'       => $package_buycount[$pkg['pid']],
                    'main_product_id' => $product['product_id'],
                    'price_id'        => 0,
                    'OTag'            => "",
                    'type'            => IShoppingCart::ITEM_NORMAL,
                    'package_id'      => $pkg['pid'],
                    'unique_id'       => $product['product_id'] . "_" . $pkg['pid'],
                    'pkg_cash_back' => intval($product['product_saving_amount']),
                );
                // 字符串转整形
                $pkgs[$key]['product_list'][$pid]['product_saving_amount'] = intval($product['product_saving_amount']);

                // 每个套餐总的返现金额
                $total_product_saving_amount += intval($product['product_saving_amount']);
            }

            foreach ($package_buycount as $pkgid => $bc) {
                if ($pkgid == $pkg['pid']) {
                    $pkgs[$key]['buy_count'] = $bc;
                    // 每个套餐总的返现金额，字符串转整形
                    $pkgs[$key]['product_saving_amount'] = intval($total_product_saving_amount);
                    break;
                }
            }
        }

        return array(
            'items'     => $items,
            'suiteInfo' => $pkgs,
        );
    }

    public static function splitSuiteItems($items, $suiteInfo)
    {
        $pkg_items = array();
        $normal_items = array();
        foreach ($items as $key => $item) {
            // 如果商品不属于套餐，则添加到普通商品列表
            if (!isset($item['package_id']) || $item['package_id'] == IShoppingCart::NOT_BELONG_PACKAGE) {
                $normal_items[] = $item;
                continue;
            }

            // 商品属于 $it['package_id'] 这个套餐，则需要把套餐信息合并到商品列表的信息中
            foreach ($suiteInfo as &$pkg) {
                if ($pkg['pid'] == $item['package_id']) {
                    // 添加到套餐商品列表
                    $product_id = $item['product_id'];
                    $pk = $pkg['product_list'][$product_id];
                    $pk['product_saving_amount'] = intval($pk['product_saving_amount']);

                    // 优惠价格记录product_saving_amount 累加到 返现cash_back里面
                    $items[$key]['cash_back'] = isset($items[$key]['cash_back']) ? $items[$key]['cash_back'] + $pk['product_saving_amount'] : $pk['product_saving_amount'];
                    $items[$key]['product_amount'] = $pk['product_amount'];
                    $items[$key]['product_saving_amount'] = $pk['product_saving_amount'];
                    $pkg_items[] = $items[$key];
                    break;
                }
            }
        }
        return array(
            'pkg_items'    => $pkg_items, // 套餐商品
            'normal_items' => $normal_items, // 普通商品
            'items'        => $items, // 所有商品
        );
    }

    private static function setBookingDelayType($item, $product)
    {

        if ($item['isVirtual'] == IProduct::CROSS_STOCK_DELAY) {
            // 如果之前的延迟类型是 跨仓延迟，则累加
            $baseDelay = $item['vValue'];
        } else {
            // 如果之前的延迟类型是 其他，则不累加
            $baseDelay = 0;
        }

        switch ($product['booking_type']) {
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
                if (IShippingTime::getDiffDays(time(), $t1) > 0) {
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


    private static function setStockDelay($item, $product, $wh_id, $district)
    {
        global $_StockToDCTransitDays, $_StockID_Name;
        if ($product['num_available'] < $item['buy_count']) {

            // 虚库延迟两天
            $item['stock_desc'] = IProductInventory::$_StockTips['arrival1-3'];
            $item['stock_status'] = IProductInventory::$_StockStatus['arrival1-3'];
            $item['isVirtual'] = IProduct::VIRTUAL_STOCK_TYPE_1;
            $item['vValue'] = IShippingTime::$vStockDelay[IProduct::VIRTUAL_STOCK_TYPE_1];

        } else {
			$des_dc = IProductInventory::getDCFromDistrict($district, $wh_id);
            //实际库存足够
            if (!isset($_StockToDCTransitDays[$product['psystock']][$des_dc]) || $_StockToDCTransitDays[$product['psystock']][$des_dc] == 0) {
                $item['stock_desc'] = IProductInventory::$_StockTips['available'];
                $item['stock_status'] = IProductInventory::$_StockStatus['available'];
                $item['isVirtual'] = IProduct::NO_DELAY;
                $item['vValue'] = 0;
            } else {
                $item['stock_desc'] = "有货，待{$_StockID_Name[$product['psystock']]}调拨，{$_StockToDCTransitDays[$product['psystock']][$des_dc]}天后配送";
                $item['stock_status'] = IProductInventory::$_StockStatus['arrivalN'];
                $item['isVirtual'] = IProduct::NO_DELAY;
                $item['vValue'] = $_StockToDCTransitDays[$product['psystock']][$des_dc];
            }
        }
        return $item;
    }

    /**
     * @static 设置预购属性
     * @param $items
     * @param $wh_id
     * @param $products
     */
    private static function setAppointInfo($items, $wh_id, $products)
    {
        Logger::info(var_export($products, true));
        $now = time();
        // 获取带有预购属性的商品
        $appointProducts = array(); //IPreOrderV2::$appointProduct;

        foreach ($products as $p) {
            if (($p['flag'] & APPOINT_PRODUCT) == APPOINT_PRODUCT) {
                $appointProducts[] = $p['product_id'];
            }
        }

        if (empty($appointProducts))
            return $items;

        // TODO
        $appointInfos = EA_Promotion::getAppointInfo($appointProducts, $wh_id);
        if (false === $appointInfos) {
            self::$errCode = EA_Promotion::$errCode;
            self::$errMsg = EA_Promotion::$errMsg;
            return false;
        }


        foreach ($items as $key=> $item) {
            $pid = $item['product_id'];
            if (!isset($appointInfos[$pid])) {
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
            /*if ($now < $items[$key]['buy_time_from']) {
                $date = date("Y-m-d H:i:s", $items[$key]['buy_time_from']);
                $items[$key]['stock_desc'] = $items[$key]['stock_desc'] . "(购买将于{$date}开始，已预约用户请耐心等待)";
            } else if ($now < $items[$key]['buy_time_to']) {
                $items[$key]['stock_desc'] = $items[$key]['stock_desc'] . "(购买进行中，参加预购活动用户方能购买)";
            } else {
                $date = date("Y-m-d H:i:s", $items[$key]['buy_time_to']);
                $items[$key]['stock_desc'] = $items[$key]['stock_desc'] . "(购买活动于{$date}结束，谢谢您的关注)";
            }*/
        }

        return $items;
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

				if (! isset($product['c3_ids'])) { //传参出错，无法检查
					Logger::warn(__FUNCTION__ . ' cannot be execute! c3_ids missing!');
				}
				else if (in_array($product['c3_ids'], self::$DIY_PRODUCT_C3_IDS)) { //检查出货仓ID
					if (! isset($product['psystock'])) { //传参出错，无法检查
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
     * _checkProductsLimitation()
     *
     * 订单确认页调用检查商品列表是否限购. 
     * 检查商品列表信息中的库存购物: num_limit, buy_count, 
     * 检查多价限购字段: price_buy_limit_flag, mult_limit_num.
     *
     * @param (array) $products, 商品列表信息.
     * @return (mixed) true/false.
     *
     * @Date: 2013.3(bluexchen)
     */
    private static function _checkProductsLimitation(array $products = array())
    {
        if (empty($products)) {
            return;
        }

        $isLimited = false;
        $limitedProuductName = "";
        $limitedProuductNum = 0;
        foreach ($products as $key => $value) {
            //检查商品限购
            if (isset($value['num_limit']) && isset($value['buy_count'])) {
                $stockLimit = ($value['num_limit'] <= 0)
                            ? IShoppingCartV2::MAX_COUNT_PER_ITEM
                            : (int) $value['num_limit'];
                if ($value['buy_count'] > $stockLimit) {
                    $isLimited = true;
                    $limitedProuductName = $value['name'];
                    $limitedProuductNum = $stockLimit;
                    break;
                }
            }

            //检查多价限购
            if (isset($value['price_buy_limit_flag']) && isset($value['mult_limit_num'])) {
                if (1 == $value['price_buy_limit_flag']) {
                    $isLimited = true;
                    $limitedProuductName = $value['name'];
                    $limitedProuductNum = $value['mult_limit_num'];
                    break;
                }
            }
        }
        if (true === $isLimited) {
            self::$errMsg = "购物车中商品{$limitedProuductName}，超过限购数量{$limitedProuductNum}，请返回购物车修改您的产品购买数量。";
            self::$errCode = 101;
            self::$logMsg = basename(__FILE__) . "line:" . __LINE__ 
                          . ",errMsg: 购物车中商品{$limitedProuductName}，超过限购数量{$limitedProuductNum}。";
            return false;
        }
        return true;
    }
    /**
     * 服务类商品跨仓检查逻辑 TAPD 5484733
     * @param array $products 商品信息数组
     * @param int $whid 当前分站ID
     * @return array 是否通过检查
     */
    public static function diyProductStcokCheck($products, $whid) {
        $ret = array();

        $pids = array_keys($products);
        $cal = array_intersect($pids, self::$DIY_SERVICE_IDS);
        if (! empty($cal)) { //购物车包含服务类商品
            foreach($products as $pid => &$product) {
                if (in_array($pid, self::$DIY_SERVICE_IDS)) { //服务类商品直接排除
                    continue;
                }

                if (! isset($product['c3_ids'])) { //传参出错，无法检查
                    Logger::warn(__FUNCTION__ . ' cannot be execute! c3_ids missing!');
                }
                else if (in_array($product['c3_ids'], self::$DIY_PRODUCT_C3_IDS)) { //检查出货仓ID
                    if (! isset($product['psystock'])) { //传参出错，无法检查
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

    //获取用户积分
    public static function getUserPoint($uid)
    {
        if(is_null($uid) || !is_numeric($uid))
        {
            Logger::err("getUserPoint Para Error!");
            return false;
        }
        $req = new GetPointsAccountReq();
        $resp = new GetPointsAccountResp();

        $req->source = __FILE__;
        $req->machineKey = ToolUtil::getClientIP();
        $req->sceneId = 0;
        $req->icsonUid = $uid;
        $_cntl = new WebStubCntl();
        $sPassport = "0123456789";
        $_cntl->setDwOperatorId($uid);
        $_cntl->setSPassport($sPassport);
        $_cntl->setDwSerialNo(10002);
        $_cntl->setDwUin($uid);
        $_cntl->setWVersion(2);
        $_cntl->setCallerName("ICSON_IPREORDERV2");
        $ret = $_cntl->invoke($req, $resp, WEB_STUB_TIME_OUT);

        $json_resp = json_encode($resp);
        $pointRet = array(
            'ret' => $ret,
            'resp' => json_decode($json_resp,true),
        );

        if($pointRet['ret'] != 0)
        {
            //库存锁定失败
            self::$errCode = $pointRet['ret'];
            self::$errMsg = "PointOperator GetUserPoints invoke Failed!";
            Logger::err("getUserPoint failed![time out][uid:{$uid}][piontRet:" . ToolUtil::gbJsonEncode($pointRet));
            return false;
        }
        if($pointRet['resp']['result'] != 0)
        {
            //库存锁定失败
            self::$errCode = $pointRet['resp']['result'];
            self::$errMsg = "UniInventoryOperator UnlockProductInventory invoke return Error!";
            Logger::err("getUserPoint failed![error][uid:{$uid}][piontRet:" . ToolUtil::gbJsonEncode($pointRet));
            return false;
        }
        $pointRet = $pointRet['resp']['pointsAccountPo'];
        $userPoint = array(
            'cash_point'        => $pointRet['dwCashPoints'],
            'promotion_point'   => $pointRet['dwPromotionPoints'],
            'point'             => $pointRet['dwTotalAvailablePoints'],
            'valid_point'       => $pointRet['dwTotalAvailablePoints'],
        );

        return $userPoint;
    }
}

