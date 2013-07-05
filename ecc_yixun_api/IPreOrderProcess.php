<?php
/**
 * Created by JetBrains PhpStorm.
 * User: hedyhe sheldonshi
 * Date: 13-5-1
 * Time: ����4:02
 * To change this template use File | Settings | File Templates.
 * Ps: �ļ��нӿڽ�����Ѹ��վ�๺�����̵��ã�������������ǰ��֪������ӿڵ����޸Ĳ�����֪
 */

if(!defined("PHPLIB_ROOT")) {
    define('PHPLIB_ROOT', '/data/release/PHPLIB/');
}
require_once(PHPLIB_ROOT . 'inc/district.inc.php');
require_once(PHPLIB_ROOT . 'inc/ship.inc.php');
require_once(PHPLIB_ROOT . 'inc/special.constant.inc.php');
require_once(PHPLIB_ROOT . 'api/IShoppingProcess.php');

/**
900:Ŀ�ĵر��벻�Ϸ�
901:Ŀ�ĵ�û�и�����id
902:���ͷ�ʽ���Ϸ�
903:ʹ���Żݾ���û�id���Ϸ�
904:�Ż�ȯ���벻�Ϸ�
905:֧����ʽ���Ϸ�
906:�Ż�ȯ������
907:����������ʹ���Ż�ȯ
908:�����������Ϸ�
909:�û�������
910:�û����ֲ���
 */
class IPreOrderProcess
{
    public static $errCode = 0;
    public static $errMsg = '';
    public static $logMsg = '';
    public static $innerErrMsg = "";

    // �����û����ͣ�֧����ʽ�����в�ͬ
    const USER_TYPE_ALI = 'ali'; //֧������ͨ
    const USER_TYPE_ALI_GOLDEN = 'ali_golden'; //֧�������˻�
    const USER_TYPE_SHCAR = 'shcar'; //����

    //���¼����������ã�������ϱ���һ�£���Ȼ�������
    public static $PAYTYPE_ALI_ONLY = array(17, 18, 19, 20, 21); //֧�����û�ֻ���⼸��
    public static $PAYTYPE_ALI_GOLDEN_ONLY = array(21); //֧�������˻�ֻ����1��
    public static $PAYTYPE_SHCAR_ONLY = array(73); //���������û�

    //DIY����Ʒ  TAPD 5484733
    public static $DIY_SERVICE_IDS = array( 5978, 7599, 293523, ); //�����Ű�װ����������ƷID
    public static $DIY_PRODUCT_C3_IDS = array( 92,100,111,132,138,146,148,149,152,159,166,212,297,325, ); //DIY ����ƷС��ID
    public static $DIY_PRODUCT_STOCK_MAP = array( //�ִ���֤��
        SITE_SH => array(STOCK_SH_1), //�Ϻ�
        SITE_SZ => array(STOCK_SZ_1001), //�㶫
        SITE_BJ => array(STOCK_BJ_2001), //����
        SITE_WH => array(STOCK_WH_3001), //�人
        SITE_CQ => array(STOCK_CQ_4001), //����
        SITE_XA => array(STOCK_XA_5001), //����
    );
    //���ڸ���
    public static $_installmentPayType = array(28, 63);
    //$product_id_wireless: �������Ϸ�ֵ������������һ������
    public static function getShippingTypeNotAviable($uid, $destination, $wh_id = 1, $product_id_wireless = -1)
    {
        // Ŀǰ��������������߶�ʹ�ã���ֳ��������ļ����˴������ӿڵ��ã��Ժ��ȥ�� TODO
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

    //  $payAmt: Ϊ�û���Ҫ֧���Ľ��(�����ѳ���)
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
     * $products ��Ʒ�Ļ�����Ϣ������ num_available, virtual_num, type, flag
     * $item ������Ʒ�Ļ�����Ϣ������ buy_count, product_id
     */
    public static function isVirtualOrder($products, $items)
    {
        $wh_id = IUser::getSiteId();
        foreach ($items as $item) {
            $product = $products[$item['product_id']];
            if (($product['num_available'] + $product['virtual_num'] >= $item['buy_count'])
                || (($wh_id == 1) && ($product['flag'] & FORBID_SET_VIRTUAL) != FORBID_SET_VIRTUAL && $product['type'] == PRODUCT_TYPE_NORMAL)
            ) {

                if ($product['num_available'] < $item['buy_count']) { //ʵ�ʿ�治�㹻
                    return true;
                }
            }
        }
        return false;
    }

    /**
    ��Ʒ�������ӣ����߼��빺�ﳵ���Ӻ������   edm=xxxxxx������Ҫ��¼�ô��������뵽��
    ��ʽ"code1_productid1,code2_productid2"

    $rule_id :  ����û��ڹ��ﳵҳ��ѡ���˴�����������Ҫ������ѡ��Ĵ�������id
    $apply_times:������������ǻ���������������Ʒ������Ҫ����apply_times�������ۼƴ���
    $product_id_wilreless: �������˲�����˵�����������ߵ�һ������
    $buy_count_wireless:  ����һ�����򣬹�����Ʒ������
     */
    public static function getItemsInShoppingCart($uid, $wh_id = 1, $open_id = '', $rule_id = 0, $apply_times = 999, $product_id_wilreless = -1, $buy_count_wireless = 0, $is_es = false, $esitems = array(), $wire_less_para = array())
    {
        // Ŀǰ��������������߶�ʹ�ã���ֳ��������ļ����˴������ӿڵ��ã��Ժ��ȥ�� TODO
        $ret = IWPreOrder::getItemsInShoppingCart($uid, $wh_id, $open_id, $rule_id, $apply_times, $product_id_wilreless, $buy_count_wireless, $is_es, $esitems, $wire_less_para);
        if ($ret === false) {
            self::$errMsg = IWPreOrder::$errMsg;
            self::$errCode = IWPreOrder::$errCode;
        }
        return $ret;
    }

    // �鿴�û����û��ֵķ�Χ
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
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '�û�������';
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
            //��������
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
            //��ȡ���ﳵ����Ʒ
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

            //��ȡ��Ʒ�ļ۸���Ϣ(����֧����Ϣ)
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
        //��ȡ������
        //getTyingInfo($items, $whId, $destinationId,  $uid = 0)
        reset($orderItems);
        $tyingRet = IShoppingProcess::getTyingInfo($orderItems, $wh_id, $destinationId, $uid);

        if(false === $tyingRet)
        {
            Logger::info("���û��ַ�Χ��ȡ������ʧ��[whid:{$wh_id}][destinationId:{$destinationId}][uid:{$uid}][item:" . ToolUtil::gbJsonEncode($orderItems));
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

        //��ȡ�û��ֻ������Լ���״̬
        /*
        $userInfo = IUser::getUserInfo($uid);
        if ($userInfo === false) {
            Logger::err(__LINE__ . "��ȡ�û����û��ַ�Χ�ǣ���ȡ�û���Ϣʧ��");
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
            //��ȡ��Ʒ�û���Ʒ��Ϣ
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
            //��������
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
     * ��ְֲ�� getShippingTypeByDestination
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
     * �������ͷ�ʽ����վID����ƷID���û����ͣ���ȡ֧����ʽ
     * @param int $shippingType ָ�������ͷ�ʽ
     * @param int $wh_id ��վID
     * @param array $productidArr ��ƷID����
     * @param string $userType �û�����
     * @param string $cartType ���ﳵ����
     * @return mixed false ʧ�ܣ�array �ɹ�
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
        foreach ($_PAY_MODE[$wh_id] as $pay_type) { //�������õ�֧������
            /**
             * ΢��֧���ҶȲ��� - START
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
             * ΢��֧���ҶȲ��� - END
             */

            if ($pay_type['IsOnlineShow'] == 0) { //���ϲ���ʾ
                continue;
            }


            //���컯����ʼ
            if (false !== $userType && $pay_type['IsNet'] == 1) {
                if ($userType == self::USER_TYPE_ALI_GOLDEN && (!in_array($pay_type['SysNo'], self::$PAYTYPE_ALI_GOLDEN_ONLY))) {
                    continue; //����֧��, ���ǲ�ֱ����֧�������˻�
                } else if ($userType == self::USER_TYPE_ALI && (!in_array($pay_type['SysNo'], self::$PAYTYPE_ALI_ONLY))) {
                    continue; //����֧��, ���ǲ�ֱ����֧����
                }
            }

            if (in_array($pay_type['SysNo'], self::$PAYTYPE_SHCAR_ONLY)) { //����ר��֧����ʽ
                if ($userType != self::USER_TYPE_SHCAR || $cartType == IShoppingCart::ES_CART) { //�������û� or ���ܲ�������
                    continue; //����ʾ��ͨ��֧����
                }
            }
            //���컯�������

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

        //ѡ��������װ������ѡ���������
        global $_NotPayWhenArrive;
        $bothExist = array_intersect($_NotPayWhenArrive, $productidArr);
        if (count($bothExist) != 0) {
            foreach ($_PAY_MODE[$wh_id] as $pay_type) {
                if ($pay_type['PayTypeName'] == '��������') {
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
     * �������ͷ�ʽ����վID����ƷID���û����ͣ���ȡ���п���֧����ʽ
     * @param int $shippingType ָ�������ͷ�ʽ
     * @param int $wh_id ��վID
     * @param array $productidArr ��ƷID����
     * @param string $userType �û�����
     * @param int $cartType ���ﳵ����
     * @param int $uid �û�uid
     * @return mixed false ʧ�ܣ�array �ɹ�
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
     * ����֧����ʽid�����ͷ�ʽ����վID����ƷID���û����ͣ���ȡ֧����ʽ
     * @param int $payTypeId ָ����֧����ʽid
     * @param int $shippingType ָ�������ͷ�ʽ
     * @param int $wh_id ��վID
     * @param array $productidArr ��ƷID����
     * @param string $userType �û�����
     * @param int $cartType ���ﳵ����
     * @param int $uid �û�uid
     * @return mixed false ʧ�ܣ�array �ɹ�
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
     * ��ȡ��ѡ�ķ�Ʊ����
     */
    public static function getInvoicesContentOpt($c3ids, $wh_id) {
        $ret = IShoppingProcess::getInvoicesContentOpt($c3ids, $wh_id);

        return $ret;
    }
    private static function delItemInvalid($uid, $deleteProductIds)
    {
        //���ʹ�õ������߹��ﳵ����ɾ�����Ϸ��Ĺ��ﳵ��Ʒ
        foreach ($deleteProductIds as $pid) {
            IShoppingCart::remove($uid, $pid);
        }
    }

    /**
     * ��������Ʒ��ּ���߼� TAPD 5484733
     * @param array $products ��Ʒ��Ϣ����
     * @param int $whid ��ǰ��վID
     * @return array �Ƿ�ͨ�����
     */
    public static function diyProductStockCheck($products, $whid) {
        $ret = array();

        $pids = array_keys($products);
        $cal = array_intersect($pids, self::$DIY_SERVICE_IDS);
        if (! empty($cal)) { //���ﳵ������������Ʒ
            foreach($products as $pid => &$product) {
                if (in_array($pid, self::$DIY_SERVICE_IDS)) { //��������Ʒֱ���ų�
                    continue;
                }

                if (! isset($product['c3_ids']))
                { //���γ����޷����
                    Logger::warn(__FUNCTION__ . ' cannot be execute! c3_ids missing!');
                }
                else if (in_array($product['c3_ids'], self::$DIY_PRODUCT_C3_IDS))
                { //��������ID
                    if (! isset($product['psystock']))
                    { //���γ����޷����
                        Logger::warn(__FUNCTION__ . ' cannot be execute! psystock missing!');
                    }
                    else if (in_array($product['psystock'], self::$DIY_PRODUCT_STOCK_MAP[ $whid ])) { //������ӳ���ϵ��ȷ
                        continue;
                    }
                    else { //���������
                        $ret[] = $product;
                    }
                }
            }
        }

        return $ret;
    }

    /**
     * ��ȡ�û�����
     * @param $userInfo
     */
    public static function getUserType($userInfo)
    {
        $userType = false;
        $userBits = ($userInfo['status_bits'] & (1 << ALI_GOLDEN_USER)) == (1 << ALI_GOLDEN_USER) ? 1 : 0;
        if (1 == $userBits) {
            $userType = IPreOrderProcess::USER_TYPE_ALI_GOLDEN; //֧�������˻��û�
        }
        else if (isset($userInfo['icsonid'])) {
            if (false !== strpos($userInfo['icsonid'], ALIPAY_ACCOUNT_PRE)) { //֧�������ϵ�¼
                $userType = IPreOrderProcess::USER_TYPE_ALI;
            }
            else if (false !== strpos($userInfo['icsonid'], SHAUTO_ACCOUNT_PRE)) { //�����û����ϵ�¼
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
     * ����ȷ��ҳ(ǰ��cmd����Ϊ602������.)
     * ��ȡ��Ʒ�б���Ϣ, ������Ϣ, ������Ϣ(���ϵͳ), ����Ϣ��.
     *
     * ����2.0�޸��߼�.
     * ȥ��ԭ�߼��е��������EDMר���, �۸��ɶ��ϵͳ����.
     * ���ö��ϵͳ��IPromotionRuleV2::checkRuleForOrder()
     *
     * @param (int) $uid, �û�ID.
     * @param (int) $wh_id, ��վID.
     * @param (int) $district, ��������ID.
     * @param (array) $rules, �����������.
     *        ����$rules['rule_id']����ID��$rules['apply_times']����ʱ��.
     * @param (array) $offLine_params, ���߹��ﳵ����.
     *        ����$offLine_params['type']���ﳵ���ͺ�$offLine_params['items'],
     *        $offLine_params['type']: 0Ϊ�������ﳵ, ��0Ϊ���߹��ﳵ.
     *        $offLine_params['items'], ���߹��ﳵʱ��Ʒ��Ϣ�����ڸò�����, json��ʽ.
     * @return (array) �������������Ʒ�۸��ܼ�, �ײ���Ϣ, ������Ϣ, ������Ϣ��.
     *
     * @Date: 2013.3(bluexchen)
     *
     *
     *
     *
     * �ײ���Ʒ���������Ʒ��Ϣ�����񻯽���
     * IShoppingProcess.php�е�getAllCartItemsInfo������ͨ�����������ȡ������������Ҫ�õ�����Ʒ��Ϣ
     * �����Ϣ���ײ���Ϣ����Ʒ/�����Ϣ����Ʒ��ȯ��Ϣ�����ݼ��ϡ�
     *
     * Date:2013.4.25 hedyhe
     *
     *
     */
    public static function listPackageInShoppingCart($uid, $wh_id, $district, $rules = array(), $offLine_params = array())
    {
        self::$innerErrMsg = "";
        $conflict = NULL; //TAPD 5484733 ��ͻ���
        /**
         * ��֤�û���Ϣ.
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
            self::$errMsg = "��ȡ�û���Ϣ����";
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETUSERINFO'], self::$errCode, 1, LocalServerIP, LocalServerIP);
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:��ȡ�û���Ϣ����" . IUser::$errMsg;
            return false;
        }
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETUSERINFO'], 0, 0, LocalServerIP, LocalServerIP);
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['user']['succ']);

        /**
         * ���ô�������, ����ʱ��͹��ﳵ����.
         */
        $rule_id     = isset($rules['rule_id']) ? $rules['rule_id'] : 0;
        //$apply_times = isset($rules['apply_times']) ? $rules['apply_times'] : 999;
        $shopping_cart_type = !empty($offLine_params['type'])
            ? $offLine_params['type'] : IShoppingCartV2::ONLINE_CART; //���ﳵ����, 0��ʾ�������ﳵ

        /*
         * �����ײ���Ʒ���������Ʒ������֮��ĵ���
         * �ú�����װ�� ��Ʒ��Ϣ��ȡ���ײ���Ϣ��ȡ����Ʒ��Ϣ��ȡ
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
            self::$errMsg = "��Ǹ����ѡ����ײ��ڸõ�ַ�ݲ����ۣ���ѡ��������Ʒ";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:��Ǹ�����Ĺ��ﳵ��Ʒ�б������ײ��ڸõ�ַ�ݲ����ۣ���ѡ��������Ʒ[whid{$wh_id}]" . ToolUtil::gbJsonEncode($ret['pkgIds']);
            Logger::err(self::$logMsg);
            return false;
        }
        if (empty($items))
        {
            self::$errCode = -8001;
            self::$errMsg = "��Ǹ����ѡ�����Ʒ�ڸõ�ַ�ݲ����ۻ��߹��ﳵΪ�գ���ѡ��������Ʒ";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:��Ǹ�����Ĺ��ﳵ��Ʒ�б�����Ʒ�ڸõ�ַ�ݲ����ۻ����ﳵΪ�գ���ѡ��������Ʒ[whid{$wh_id}]" . ToolUtil::gbJsonEncode($products);
            Logger::err(self::$logMsg);
            return false;
        }
        //seller_id seller_address_id���ݲ�һ�µ��ݴ���
        foreach($items as $key => $item)
        {
            //seller_id seller_address_id���ݲ�һ�µ��ݴ���
            if(($item['seller_id'] == 0 && $item['seller_address_id'] != 0)
                || ($item['seller_id'] != 0 && $item['seller_address_id'] == 0)
            )
            {
                self::$errCode = -8001;
                self::$errMsg = "��Ǹ�����Ĺ��ﳵ�к����ݲ����۵���Ʒ����ȷ�ϣ�";
                self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:��Ǹ�����Ĺ��ﳵ�к����ݲ����۵���Ʒ����ȷ�ϣ�[whid{$wh_id}]" . ToolUtil::gbJsonEncode($items);
                Logger::err(self::$logMsg);
                return false;
            }
        }
        reset($items);
        //  ��������Ʒ��ּ���߼�
        $conflict = self::diyProductStockCheck($products, $wh_id);

        //��ȡԤԼ��Ʒ����Ϣ hedyhe 2013-04-27  �ײ���Ʒ��������Ʒ��Ϣ�����񻯽���
        $ret = IShoppingProcess::SetAppoint($items, $wh_id, $products);
        if(false === $ret) {
            self::$errCode = IShoppingProcess::$errCode;
            self::$errMsg = IShoppingProcess::$errMsg;
            return false;
        } else {
            $items = $ret;  // ��ȷ��
        }

        /*2013-05-21 ��������񻯽���*/
        $mlog->start();
        $tyingRet = IShoppingProcess::getTyingInfo($items,$wh_id,$district,$uid, SCENE_SHOPPING_PROCESS);
        if($tyingRet == false)
        {
            self::$errMsg = '��ȡ������ʧ��. '.IShoppingProcess::$errCode ;
            self::$errCode = IShoppingProcess::$errCode;
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETTYINGINFO'], self::$errCode, 1, LocalServerIP, LocalServerIP);
            self::$logMsg =  basename(__FILE__) . "line:" . __LINE__ . ",errMsg:�������Ϣʧ��.".IShoppingProcess::$errCode;
            //return false;
            Logger::err(self::$logMsg);
        }
        else
        {
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETTYINGINFO'], 0, 0, LocalServerIP, LocalServerIP);
            $items = $tyingRet['items'];
        }

        /**
         * ����2.0�İ�, ��ȡ��ۺ�������Ϣ.
         *
         * ���ͳһIPreOrderV2::checkRuleForOrder����. (�÷����ڲ�ʱ��Ӧ��Ϊ�ȴ���"���", �ٴ���"����")
         */
        $promotion = array();

        //�ж��Ƿ�Ϊ���ܲ���, ���ܲ���ʱ,$isEnergySavingTypeֵΪ2, ����Ϊ1
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

        //���ڴ���2.0�д����������Ƶ���ʾ  ����2.0֮���У��
        if (false === $ret) {
            if(IPromotionRuleV2::$errCode == IPromotionRuleV2::$ERROR_RESTRICT)
            {
                self::$errMsg = '��Ǹ�����μӵĴ����Żݻ�ѳ����������������ƣ��뷵�ع��ﳵ����ѡ��';
                self::$errCode = IPromotionRuleV2::$ERROR_RESTRICT;
                self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ",errMsg:���μӵĴ����Żݻ�ѳ����������������ƣ��뷵�ع��ﳵ����ѡ��.";
            }
            else
            {
                self::$errMsg = '�������Ϣʧ��.';
                self::$errCode = 98;
                self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ",errMsg:�������Ϣʧ��.";
            }
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['CHECKRULEFORORDER'], IPromotionRuleV2::$errCod, 1, LocalServerIP, LocalServerIP);
            return false;
        } else {
            $promotion = $ret['promotion'];
            $items     = $ret['items'];
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['CHECKRULEFORORDER'], 0, 0, LocalServerIP, LocalServerIP);
        }

        /*
         * ���ͷ��񻯽���
         * 2013-5-7 hedyhe
         *
         * */
        $mlog->start();
        $delivery4order = IShoppingProcess::getDeliveryInfo4Order($items, $inventorys, $wh_id,$district ,  $uid ,$userInfo['level'], SCENE_SHOPPING_PROCESS);
        if(false === $delivery4order) {
            self::$errCode = -8001;
            self::$errMsg = "��Ǹ����ѡ�����Ʒ�ڸõ�ַ�޷����ͣ���ѡ��������Ʒ";
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETDELIVERYINFO4ORDER'], IShoppingProcess::$errCode, 1, LocalServerIP, LocalServerIP);
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:��Ǹ�����Ĺ��ﳵ��Ʒ�б�������Ʒ�ڸõ�ַ�޷����ͣ���ѡ��������Ʒ";
            return false;
        }
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETDELIVERYINFO4ORDER'], 0, 0, LocalServerIP, LocalServerIP);
        $order['items'] = $delivery4order['items'];

        //����޹�
        if($uid > 0) {
            $ret = IShoppingProcess::checklimitProduct($items,$products, $order,$uid);
            if ($ret === false) {
                self::$errMsg = IShoppingProcess::$errMsg;
                self::$errCode = IShoppingProcess::$errCode;
                self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ",errMsg:��ѯ�޹���Ϣʧ�ܣ�" . IShoppingProcess::$errMsg;
                return false;
            }
        }

        /**
         * ����ȡpid���м�Ĳ������̣����ܰ�ĳЩpid��ɾ�����ˣ�
         * ��������items�����仯�Ĺ��̣�������֮ǰ����
         */
        $items = $delivery4order['items'];
        $productIds_final = array();
        foreach ($items as $it) {
            $productIds_final[] = $it['product_id'];
        }

        //�Ե�Ʒ��ȯ���й���  ����
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
         * ��Ʒ���Ƿ�ƥ���߼�
         */
        $conflictProducts = IDIYInfo::checkProductsMatch($productIds_final);   // $itemsForConflict
        $isDealer = isset($userInfo['type']) ? ($userInfo['type'] == USER_IS_DEALER) : false;
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['process']['succ']);
        return array(
            'invoice'          => $delivery4order['availableInvoices'],
            'totalCut'         => $delivery4order['totalCut'],
            'totalAmt'         => $delivery4order['totalAmt'],
            'totalWeight'      => $delivery4order['totalWeight'],
            'suiteInfo'        => $suiteInfo,                    //�ײ͵���Ϣ
            'packageList'      => $delivery4order['packages'],     //�𵥵İ�����Ϣ
            'shipList'         => $delivery4order['shippingType'],
            'conflict'         => $conflict,
            'conflictProducts' => $conflictProducts,
            'promotion'        => $promotion,
            'promoCoupon'      => $coupon,
            'userIsDealer'     => $isDealer,
        );
    }


    /**
     * ��Ѹ���������ﳵcgi
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
         * ���ù��ﳵ����, 0��ʾ�������ﳵ
         */
        $shopping_cart_type = !empty($offLine_params['type'])
            ? $offLine_params['type'] : IShoppingCartV2::ONLINE_CART;



        /* �����ײ���Ʒ���������Ʒ������֮��ĵ���
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
        //��ȡԤԼ��Ʒ����Ϣ hedyhe 2013-04-27  �ײ���Ʒ��������Ʒ��Ϣ�����񻯽���
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
            $items = $ret;  // ��ȷ��
        }

        $strItems = ToolUtil::gbJsonEncode($items);

        /*2013-05-21 ��������񻯽���*/
        $mlog->start();
        $tyingRet = IShoppingProcess::getTyingInfo($items,$wh_id,$district,$uid, SCENE_SHOPPING_CART);
        if($tyingRet == false) {
            self::$errMsg = '��ȡ������ʧ��. '.IShoppingProcess::$errCode ;
            self::$errCode = 4001;
            self::$logMsg =  basename(__FILE__) . "line:" . __LINE__ . ",errMsg:��ȡ������ʧ��.".IShoppingProcess::$errCode;
            self::$innerErrMsg =  self::$innerErrMsg . '��ȡ������ʧ��. ' . IShoppingProcess::$errCode;
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETTYINGINFO'], IShoppingProcess::$errCode, 1, LocalServerIP, LocalServerIP);
            Logger::err(self::$innerErrMsg);
        } else {
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETTYINGINFO'], 0, 0, LocalServerIP, LocalServerIP);
            $items = $tyingRet['items'];
        }

        //��� �������۽ӿ�
        $promotion = array();

        //�ж��Ƿ�Ϊ���ܲ���,���ܲ���ʱ, $isEnergySavingTypeֵΪ2, ����Ϊ1
        //����Ӧ�����ж�����Ƿ��ǽ��ܲ������ﳵ���ǵĻ����ж�������˵��������жϻ�������
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
            self::$errMsg = '��ȡ�����Ϣʧ��. errcode = '.IPromotionRuleV2::$errCode;
            self::$errCode = 99;
            self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ",errMsg:��ȡ�����Ϣʧ��.";
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
            //�������������Ϣʧ�ܣ�������Ϣչʾ �ݲ�����
            reset($items);
            foreach($items as $key=>$item)
            {
                $items[$key]['stock_desc'] = IProductInventory::$_StockTips['not_sale'];
                $items[$key]['stock_status'] = IProductInventory::$_StockStatus['not_sale'];
            }
            $result = array(
                'items'     => $items,      //��Ʒ�б�
                'suiteInfo' => $suiteInfo,  //�ײ���Ϣ
                'promoRule' => $promotion,  //��������
                'coupons'   => $promoCoupon,    //�Żݾ�
                'conflict' => array(), //��ͻ����
            );
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETDELIVERYINFO4CART'], IShoppingProcess::$errCode, 1, LocalServerIP, LocalServerIP);
            return $result;
        }
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETDELIVERYINFO4CART'], 0, 0, LocalServerIP, LocalServerIP);
        $items = $result['items'];

        //��������Ʒ��ּ���߼�
        $conflicts = self::diyProductStockCheck($products, $wh_id);
        /**
         * ����ȡpid���м�Ĳ������̣����ܰ�ĳЩpid��ɾ�����ˣ�
         * ��������items�����仯�Ĺ��̣�������֮ǰ����
         */
        $productIds_final = array();
        foreach ($items as $it) {
            $productIds_final[] = $it['product_id'];
        }

        //ɾ����ǰ�汻unset����Ʒ
        if ($shopping_cart_type == IShoppingCartV2::ONLINE_CART) {
            $deleteProductIds = array_diff($productIds, $productIds_final);
            self::delItemInvalid($uid, $deleteProductIds);
        }
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_CART]['cart']['succ']);

        return array(
            'items'     => $items,      //��Ʒ�б�
            'suiteInfo' => $suiteInfo,  //�ײ���Ϣ
            'promoRule' => $promotion,  //��������
            'coupons'   => $promoCoupon,    //�Żݾ�
            'conflict' => $conflicts, //��ͻ����
            'rules_buy_more' => $promotionRules['rules_buy_more'],
            'rules_if_login' => $promotionRules['rules_if_login'],
        );
    }

    /**
     * listPackageInShoppingCartNew �°涩��ȷ��ҳcgi
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
            self::$errMsg = "��ȡ�û���Ϣ����";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . "errCode:" . IUser::$errCode . ",errMsg:��ȡ�û���Ϣ����" . IUser::$errMsg;
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETUSERINFO'], IUser::$errCode, 1, LocalServerIP, LocalServerIP);
            return false;
        }
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETUSERINFO'], 0, 0, LocalServerIP, LocalServerIP);
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['user']['succ']);
        //��ȡ�û�����������
        $isDealer = isset($userInfo['type']) ? ($userInfo['type'] == USER_IS_DEALER) : false;

        //����ѡ��Ĵ������򣬹��ﳵ����
        $rule_id = isset($rules['rule_id']) ? $rules['rule_id'] : 0;
        $shopping_cart_type = !empty($offLine_params['type']) ? $offLine_params['type'] : IShoppingCartV2::ONLINE_CART;

        $items = array();
        $suiteInfo = array();
        $promoCoupon = array();
        $products = array();
        $productIds = array();
        $mlog->start();
        $ret = IShoppingProcess::getAllCartItemsInfo($uid, $wh_id, $district, $offLine_params, false, false, SCENE_SHOPPING_PROCESS);
        Logger::info('[����ȷ��ҳ]��ȡ���ﳵ��Ʒ�б�getAllCartItemsInfo:'. ToolUtil::gbJsonEncode($ret));
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
        //���������������е�����
        if(empty($items) && !empty($ret['pkgIds']))
        {
            self::$errCode = -8001;
            self::$errMsg = "��Ǹ����ѡ����ײ��ڸõ�ַ�ݲ����ۣ���ѡ��������Ʒ";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:��Ǹ�����Ĺ��ﳵ��Ʒ�б������ײ��ڸõ�ַ�ݲ����ۣ���ѡ��������Ʒ[whid{$wh_id}]" . ToolUtil::gbJsonEncode($ret['pkgIds']);
            Logger::err(self::$logMsg);
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['process']['failed']);
            return false;
        }
        if(empty($items))
        {
            self::$errCode = -8001;
            self::$errMsg = "��Ǹ����ѡ�����Ʒ�ڸõ�ַ�ݲ����ۻ��߹��ﳵΪ�գ���ѡ��������Ʒ";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:��Ǹ�����Ĺ��ﳵ��Ʒ�б�����Ʒ�ڸõ�ַ�ݲ����ۻ����ﳵΪ�գ���ѡ��������Ʒ[whid{$wh_id}]" . ToolUtil::gbJsonEncode($products);
            Logger::err(self::$logMsg);
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['process']['failed']);
            return false;
        }
        $deleteItems = array();
        $deletePkgsId = array();
        $deletePkgs = array();
        foreach($items as $key => $item)
        {
            //����Ҫ�޳�����Ʒ
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
                //�ɹ�������Ϊ0����Ʒ�϶������Թ��򣬻��ǿ�治�㣬����������������

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
        //��������Ʒ��ּ���߼�,����п�֣����װ�������޳���
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
        //����Ҫ�ж�����Ʒ�б��Ƿ�Ϊ��
        if(empty($items))
        {
            //����ķ��ش�ȷ��
            return array(
                'invoice'          => array(),
                'totalCut'         => 0,
                'totalAmt'         => 0,
                'totalWeight'      => 0,
                'suiteInfo'        => array(),                           //�ײ͵���Ϣ
                'packageList'      => array(),                         //�𵥵İ�����Ϣ
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
        //��ȡԤԼ��Ʒ����Ϣ
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['appoint']['req']);
        $appointRet = IShoppingProcess::SetAppoint($items, $wh_id, $products);
        if(false === $appointRet)
        {
            self::$errCode = IShoppingProcess::$errCode;
            self::$errMsg = IShoppingProcess::$errMsg;
            Logger::err("����ȷ��ҳ����ȡ��ƷԤԼʧ�ܣ�errCode:" . self::$errCode . "; errMsg:" . self::$errMsg);
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['appoint']['failed']);
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['process']['failed']);
            return false;
        }
        else
        {
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['appoint']['succ']);
            $items = $appointRet;
        }

        //��ȡ������
        $mlog->start();
        $tyingRet = IShoppingProcess::getTyingInfo($items, $wh_id, $district, $uid, SCENE_SHOPPING_PROCESS);
        if($tyingRet == false)
        {
            self::$errMsg = '��ȡ������ʧ��. '.IShoppingProcess::$errCode ;
            self::$errCode = 4001;
            self::$logMsg =  basename(__FILE__) . "line:" . __LINE__ . ",errMsg:�������Ϣʧ��.".IShoppingProcess::$errCode;
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETTYINGINFO'], IShoppingProcess::$errCode, 1, LocalServerIP, LocalServerIP);
            Logger::err("����ȷ��ҳ����ȡ��������Ϣʧ�ܣ�errCode:" . self::$errCode . ",errMsg:" . self::$errMsg);
        }
        else
        {
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETTYINGINFO'], 0, 0, LocalServerIP, LocalServerIP);
            $items = $tyingRet['items'];
        }
        //��ȡ��ۡ���������
        $promotion = array();
        //�ж��Ƿ�Ϊ���ܲ���, ���ܲ���ʱ,$isEnergySavingTypeֵΪ2, ����Ϊ1
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
        //���ڴ���2.0�д����������Ƶ���ʾ  ����2.0֮���У��
        if (false === $ret)
        {
            if(IPromotionRuleV2::$errCode == IPromotionRuleV2::$ERROR_RESTRICT)
            {
                self::$errMsg = '��Ǹ�����μӵĴ����Żݻ�ѳ����������������ƣ��뷵�ع��ﳵ����ѡ��';
                self::$errCode = IPromotionRuleV2::$ERROR_RESTRICT;
                self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ",errMsg:���μӵĴ����Żݻ�ѳ����������������ƣ��뷵�ع��ﳵ����ѡ��.";
            }
            else
            {
                ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['process']['failed']);
                self::$errMsg = '�����Ʒ�����Ϣ����';
                self::$errCode = IPromotionRuleV2::$errCode;
                self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ",errMsg:�������Ϣʧ��.";
            }
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['CHECKRULEFORORDER'], IPromotionRuleV2::$errCode, 1, LocalServerIP, LocalServerIP);
            return false;
        }
        else
        {
            $promotion = $ret['promotion'];
            $items     = $ret['items'];
        }

        //����޹�

        $ret = IShoppingProcess::checklimitProductNew($items, $products, $uid);
        if ($ret === false)
        {
            self::$errMsg = IShoppingProcess::$errMsg;
            self::$errCode = IShoppingProcess::$errCode;
            self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ",errMsg:��ѯ�޹���Ϣʧ�ܣ�" . IShoppingProcess::$errMsg;
            Logger::err("����ȷ��ҳ������޹���Ϣʧ�ܣ�errCode:" . self::$errCode . "; errMsg:" . self::$errMsg);
            //return false;
        }
        else
        {
            $items = $ret['items'];
        }
        //���ж���Ʒ�Ƿ����޹���������޹�����Ϊ�ײ���Ʒ�����ײ�id��¼��Ȼ���ڱ�����Ʒ������ɾ�����ײ͵�item unset
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
            //����ķ��ش�ȷ��
            return array(
                'invoice'          => array(),
                'totalCut'         => 0,
                'totalAmt'         => 0,
                'totalWeight'      => 0,
                'suiteInfo'        => array(),                           //�ײ͵���Ϣ
                'packageList'      => array(),                         //�𵥵İ�����Ϣ
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
                self::$errMsg = '��ȡ������ʧ��. '.IShoppingProcess::$errCode ;
                self::$errCode = 4001;
                self::$logMsg =  basename(__FILE__) . "line:" . __LINE__ . ",errMsg:�������Ϣʧ��.".IShoppingProcess::$errCode;
                Logger::err("����ȷ��ҳ����ȡ��������Ϣʧ�� again��errCode:" . self::$errCode . ",errMsg:" . self::$errMsg);
            }
            else
            {
                $items = $tyingRet['items'];
            }
            $ret = IPromotionRuleV2::checkRuleForOrder($items, $wh_id, $uid, $rule_id, $isEnergySavingType, SCENE_SHOPPING_PROCESS);
            //���ڴ���2.0�д����������Ƶ���ʾ  ����2.0֮���У��
            if (false === $ret)
            {
                if(IPromotionRuleV2::$errCode == IPromotionRuleV2::$ERROR_RESTRICT)
                {
                    self::$errMsg = '��Ǹ�����μӵĴ����Żݻ�ѳ����������������ƣ��뷵�ع��ﳵ����ѡ��';
                    self::$errCode = IPromotionRuleV2::$ERROR_RESTRICT;
                    self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ",errMsg:���μӵĴ����Żݻ�ѳ����������������ƣ��뷵�ع��ﳵ����ѡ��.";
                }
                else
                {
                    self::$errMsg = '�����Ʒ�����Ϣ����';
                    self::$errCode = IPromotionRuleV2::$errCode;
                    self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ",errMsg:�������Ϣʧ��.";
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

        //��ȡ������Ϣ
        $mlog->start();
        $delivery4order = IShoppingProcess::getDeliveryInfo4Order($items, $inventorys, $wh_id,$district ,  $uid ,$userInfo['level'], SCENE_SHOPPING_PROCESS);
        if(false === $delivery4order)
        {
            self::$errCode = -1;
            self::$errMsg = "��Ǹ����ѡ�����Ʒ�ڸõ�ַ�޷����ͣ���ѡ��������Ʒ";
            self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:��Ǹ�����Ĺ��ﳵ��Ʒ�б�������Ʒ�ڸõ�ַ�޷����ͣ���ѡ��������Ʒ";
            Logger::err("����ȷ��ҳ����ȡ������Ϣʧ�ܣ�errCode:" . IShoppingProcess::$errCode . ", errMsg:" . self::$errMsg);
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETDELIVERYINFO4ORDER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
            ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['process']['failed']);
            return false;
        }
        $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETDELIVERYINFO4ORDER'], 0, 0, LocalServerIP, LocalServerIP);
        //��ȡors�ֵ�������Ϣ
        $mlog->start();
        $deliveryOrs4order = IShoppingProcess::getDeliveryInfoOrs4Order($items, $inventorys, $wh_id,$district , 0, $uid ,$userInfo['level'], SCENE_SHOPPING_PROCESS);
        if(false === $deliveryOrs4order)
        {
            self::$errCode = IShoppingProcess::$errCode;
            self::$errMsg = "IShoppingProcess getDeliveryInfoOrs4Order";
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETDELIVERYINFOORS4ORDER'], self::$errCode, 1, LocalServerIP, LocalServerIP);
            Logger::err("����ȷ��ҳ����ȡORS�ֵ�������Ϣʧ�ܣ�errCode:" . self::$errCode . ", errMsg:" . self::$errMsg);

            $realDeliveryRet = array("default" => $delivery4order);
        }
        else
        {
            $mlog->report($activeModuleId, $shoppingProcessModuleCall['passive']['GETDELIVERYINFOORS4ORDER'], 0, 0, LocalServerIP, LocalServerIP);
            $realDeliveryRet = IShoppingProcess::getRealDeliveryInfo4Order($delivery4order, $deliveryOrs4order);
        }
        //Logger::info("����ȷ��ҳ���ص����շֵ����ͽ����" . ToolUtil::gbJsonEncode($realDeliveryRet));
        $packageList = array();
        $shipList = array();
        foreach($realDeliveryRet as $key => $rDelivery)
        {
            $packageList[$key] = $rDelivery['packages'];
            $shipList[$key] = $rDelivery['shippingType'];
        }
        //$order['items'] = $delivery4order['items'];
        $items = $delivery4order['items'];
        //��ȡ���յ���ƷID
        $productIds_final = array();
        foreach ($items as $it) {
            $productIds_final[] = $it['product_id'];
        }

        //�Ե�Ʒ��ȯ���й���  ����
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
        //��ȡװ�������Լ��
        $conflictProducts = IDIYInfo::checkProductsMatch($productIds_final);
        ItilReport::itil_report($shoppingProcessItil[SCENE_SHOPPING_PROCESS]['process']['succ']);
        return array(
            'invoice'          => $delivery4order['availableInvoices'],
            'totalCut'         => $delivery4order['totalCut'],
            'totalAmt'         => $delivery4order['totalAmt'],
            'totalWeight'      => $delivery4order['totalWeight'],
            'suiteInfo'        => $suiteInfo,                           //�ײ͵���Ϣ
            'packageList'      => $packageList,                         //�𵥵İ�����Ϣ
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
