<?php
require_once(PHPLIB_ROOT . 'inc/district.inc.php');
require_once(PHPLIB_ROOT . 'inc/ship.inc.php');
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
class IPreOrder
{
	public static $errCode = 0;
	public static $errMsg = '';
	public static $logMsg = '';

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
        $userPoint = $userInfo['point'];
		//��ȡ���ﳵ����Ʒ
		$orderItems = IShoppingCart::get($uid);
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
		//��ȡ������
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
			//ixiuzeng��ӣ��㶫վ��������ӹ㶫վ��ȡ���Ϻ��ͱ�������������Ȼ���Ϻ���ȡ
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
							//	var_dump("id={$em['relative_id']} , $pointMax -= {$oi['matchNum']} * intval({$em['property']})");
						}
					}
				}
			}
		}
		$pointMax /= 10;
		$pointMax = $userPoint < $pointMax ? $userPoint : $pointMax;

		//��ȡ�û��ֻ������Լ���״̬
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

		return array('minPoint' => $pointMin / 10, 'maxPoint' => ceil($pointMax), 'userPoint' => $userPoint, 'userMobile' => $mobile);
	}

	public static function checkCouponCanUse($uid, $couponCode, $destination, $payType, $wh_id = 1, $clientType = 0)
	{
		$ret = ICoupon::checkCoupon($uid, $couponCode, $destination, $payType, $wh_id, $clientType);
		if (false === $ret) {
			self::$errCode = ICoupon::$errCode;
			self::$errMsg = ICoupon::$errMsg;
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

	/*
	* ����˵��
	* $offLine_params ����Ҫ������������ type��items��type��ʾ���ﳵ���ͣ�
	* �����0�����ʾ�������ﳵ�����û���uid��Ӧ�Ĺ��ﳵTTC��ȡ����
	* �������0�����ʾ���߹��ﳵ����ʱ��Ʒ��Ϣ��items������,items��ʽΪjson��ʾ��
		 {"192244" : {
				 "product_id" : 192244,
				 "buy_count" : 1,
				 "main_product_id" : 0,
				 "price_id" : 0,
				 "OTag" : ""
			 },
			 "187912" : {
				 "product_id" : 187912,
				 "buy_count" : 1,
				 "main_product_id" : 0,
				 "price_id" : 0,
				 "OTag" : ""
		 }}
    */
	public static function listPackageInShoppingCart($uid, $wh_id, $district, $rules = array(), $offLine_params = array())
	{
		$conflict = NULL; //TAPD 5484733 ��ͻ���

		// ����Ĭ�ϲ���
		$rule_id = isset($rules['rule_id']) ? $rules['rule_id'] : 0;
		$apply_times = isset($rules['apply_times']) ? $rules['apply_times'] : 999;

		// �û���Ϣ
		$userInfo = IUser::getUserInfo($uid);
		if ($userInfo === false) {
			self::$errCode = IUser::$errCode;
			self::$errMsg = "��ȡ�û���Ϣ����";
			self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:��ȡ�û���Ϣ����" . IUser::$errMsg;
			return false;
		}

		// 0��ʾ�������ﳵ
		$shopping_cart_type = !empty($offLine_params['type']) ? $offLine_params['type'] : IShoppingCart::ONLINE_CART;

		// ��ȡ���ﳵ�е���Ʒ��������ƷID������������
		$ret = self::getItemList($uid, $wh_id, $offLine_params); //��ȡ���ﳵ
		if (false === $ret) {
			return false;
		}

		$items = $ret['items'];
		$suiteInfo = $ret['suiteInfo'];

		//��ȡ����������Ϊ�п��ܴ���������������Ʒ�����߻����������빺�ﳵ��������Ʒһ��������߼�
		$promotion = array();
		if ($rule_id > 0 && $shopping_cart_type != IShoppingCart::INSTALLMENT_CART) {
			$ret = IPreOrder::checkPromotionRule($uid, $rule_id, $apply_times, $items, $wh_id);
			if ($ret !== false) {
				$promotion = $ret['promotion'];
				$items = $ret['items'];
			}
			// ��ʹ����Ҳ�����ش��󣬵�û�ô���������
		}

		$productIds = array();
		foreach ($items as $it) {
			$productIds[] = $it['product_id'];
		}

		// ��ȡ��Ʒ������Ϣ
		$products = IProduct::getProductsInfo($productIds, $wh_id, true, false, $district);
		if (false === $products) {
			self::$errCode = IProduct::$errCode;
			self::$errMsg = "��ȡ���ﳵ��Ʒ��Ϣʧ��";
			self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ", errMsg:��ȥ��Ʒ��Ϣ����" . IProduct::$errMsg;
			return false;
		}

		$conflict = self::diyProductStcokCheck($products, $wh_id);

		//�����۸���Ϣ
		$ret_mpi = self::getMultiPriceInfo($items, $wh_id, $products, $suiteInfo);

		// ���ж�۸���Ϣ����Ʒ������Ϣ
		$product_mpi = $ret_mpi['products_mpi'];

		// ���ж�۸���Ϣ���ײ���Ϣ
		$suiteInfo_mpi = $ret_mpi['suiteInfo_mpi'];

		// ���� edm �۸�ר���ֶ�
		$products = self::getEDMInfo($userInfo, $wh_id, $product_mpi);
		if (false === $products) {
			return false;
		}

		// ����վ�㣬��Ʒ��������Ϣ��items�������Ʒ��Ϣ��Ҫ�仯
		$ret = self::getItemInfo($items, $wh_id, $products, $district);
		if (false === $ret) {
			return false;
		}

		$items = $ret['items'];
		$forbidList = $ret['forbidList'];
		$limitedProduct = $ret['limitedProduct'];

		if (!empty($suiteInfo_mpi)) {
			$ret = self::splitSuiteItems($items, $suiteInfo_mpi);
			$items = $ret['items'];
		}


		// ��ֶ���
		$orders = self::DivideOrder($items, $wh_id, $promotion);
		if (false === $orders) {
			return false;
		}

		// �����İ�����Ϣ��������⣬����������İ�����Ϣ�ȵ�
		$order = $orders['order'];
		$itemsForConflict = $orders['itemsForConflict'];
		$order['user_level'] = $userInfo['level'];

		if ($uid > 0) {
			//������ﳵ����Ʒ���޹���Ʒ�����ѯ���û�����Ķ���
			$ret = IOrder::checkLimitOrder($uid, $limitedProduct, $order['items']);
			if ($ret === false) {
				self::$errMsg = IOrder::$errMsg;
				self::$errCode = IOrder::$errCode;
				self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ",errMsg:��ѯ�޹���Ϣʧ�ܣ�" . IOrder::$errMsg;
				return false;
			}
		}

		$deliveryInfo = IPreOrder::getOrderDeliveryInfo($order, $district, $wh_id, $products, $forbidList);
		if ($deliveryInfo === false) {
			return false;
		}

		//ixiuzeng��ӣ���鶩�����Ƿ�Ϊ��Ԥ����Ʒ
		global $PreOrderProduct;
		foreach ($deliveryInfo['packages'] as $psystock => $pack) {
			foreach ($pack['items'] as $pid => $pinfo) {
				$deliveryInfo['packages'][$psystock]['items'][$pid]['isHuaWeiIShare'] = in_array($pack['items'][$pid]['product_id'], $PreOrderProduct['items']);
			}
		}

		$items = $deliveryInfo['items'];

		//����ȡpid���м�Ĳ������̣����ܰ�ĳЩpid��ɾ�����ˣ����Է�������items�����仯�Ĺ��̣�������֮ǰ����
		$productIds_final = array();
		foreach ($items as $it) {
			$productIds_final[] = $it['product_id'];
		}

		//��ȡ��Ʒ���õķ�ȯ
		$promoCoupon = array();
		if ($shopping_cart_type != IShoppingCart::INSTALLMENT_CART) {
			$promoCoupon = EA_Promotion::getPromotionRulesBatch($productIds_final, $wh_id, true);
			if (false === $promoCoupon) {
				self::$errCode = EA_Promotion::$errCode;
				self::$errMsg = EA_Promotion::$errMsg;
				self::$logMsg = basename(__FILE__) . "line:" . __LINE__ . ",errMsg:��ѯ���õķ�ȯ��Ϣʧ�ܣ�" . EA_Promotion::$errMsg;
			}
		}

		if ($shopping_cart_type == IShoppingCart::ONLINE_CART) {
			$deleteProductIds = array_diff($productIds, $productIds_final);
			self::delItemInvalid($uid, $deleteProductIds);
		}

		$conflictProducts = IDIYInfo::checkProductsMatch($itemsForConflict);
		$isDealer = isset($userInfo['type']) ? ($userInfo['type'] == USER_IS_DEALER) : false;

		return array(
			'invoice'          => $orders['availableInvoices'],
			'totalCut'         => $orders['totalCut'],
			'totalAmt'         => $orders['totalAmt'],
			'totalWeight'      => $orders['totalWeight'],
			'suiteInfo'        => $suiteInfo_mpi, //�ײ͵���Ϣ
			'packageList'      => $deliveryInfo['packages'], // �𵥵İ�����Ϣ
			'shipList'         => $deliveryInfo['shippingType'],
			'conflict' => $conflict, //TAPD 5484733 ��ͻ���
			'conflictProducts' => $conflictProducts,
			'promotion'        => $promotion,
			'promoCoupon'      => $promoCoupon,
			'userIsDealer'     => $isDealer,
		);
	}

	/**
	 * ��ȡ��Ʒ��Ϣ������������Ϣ����������(cart)
	 * @param int $uid �û�ID
	 * @param int $wh_id ��վID
	 * @param int $district ���ڵ���ID
	 * @param array $offLine_params ���߹��ﳵ����
	 */
	public static function listProductsInfo($uid, $wh_id, $district, $offLine_params) {
		$conflicts = NULL;

		// 0��ʾ�������ﳵ
		$shopping_cart_type = !empty($offLine_params['type']) ? $offLine_params['type'] : 0;

		// ������Ʒ
		$ret = self::getItemList($uid, $wh_id, $offLine_params); //��ȡ���ﳵ
		if (false === $ret) {
			return false;
		}

		$items = $ret['items'];
		$suiteInfo = $ret['suiteInfo'];
		if (empty($items)) {
			return array(
				'items'     => array(),
				'suiteInfo' => array(),
				'promoRule' => array(),
				'coupons'   => array(),
			);
		}

		// ������������������
		$ret = self::getEasyMatch($items, $wh_id);
		if (false === $ret) { //��ȡʧ��
			return false;
		}

		$productIds = array();
		foreach ($items as $it) {
			$productIds[] = $it['product_id'];
		}

		$items = $ret['items'];
		//��ȡ��Ʒ��Ϣ
		$products = IProduct::getProductsInfo($productIds, $wh_id, true , false, $district);
		if (false === $products) {
			self::$errCode = IProduct::$errCode;
			self::$errMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:��ȡ��Ʒ��Ϣʧ��" . IProduct::$logMsg;
			return false;
		}

		//�����۸���Ϣ,��������ȡ��Ʒ��Ϣ֮��
		$ret_mpi = self::getMultiPriceInfo($items, $wh_id, $products, $suiteInfo);

		// ���ж�۸���Ϣ����Ʒ������Ϣ
		$products = $ret_mpi['products_mpi'];

		// ���ж�۸���Ϣ���ײ���Ϣ
		$suiteInfo = $ret_mpi['suiteInfo_mpi'];

		//����վ�㣬��Ʒ��������Ϣ��items�������Ʒ��Ϣ��Ҫ�仯
		$ret = self::getItemInfo($items, $wh_id, $products, $district);
		if (false === $ret) {
			return false;
		}

		$items = $ret['items'];
		$forbidList = $ret['forbidList'];
		$limitedProduct = $ret['limitedProduct'];

		// ��ֶ���
		$divideOrder = self::DivideOrder($items, $wh_id);
		if (false === $divideOrder) {
			return false;
		}

		// �����İ�����Ϣ��������⣬����������İ�����Ϣ�ȵ�
		$order = $divideOrder['order'];
		$deliveryInfo = IPreOrder::getOrderDeliveryInfo($order, $district, $wh_id, $products, $forbidList);
		if ($deliveryInfo === false) {
			return false;
		}
		$items = $deliveryInfo['items'];

		//��������Ʒ��ּ���߼� TAPD 5484733
		$conflictCheck = false;
		foreach($items as $_key => $item) {
			if ($item['stock_desc'] == '�޷�����' || $item['stock_desc'] == '��ʱ�޻�') {
				$conflictCheck = true;
				break;
			}
		}
		$conflicts = $conflictCheck ? array() : self::diyProductStcokCheck($products, $wh_id);

		//�ײͲ��֣� �ײ������Żݼۣ��ܼ�
		if (!empty($suiteInfo)) {
			$ret = self::splitSuiteItems($items, $suiteInfo);
			$items = $ret['items'];
		}

		// ���»�ȡpid���м�����в���ɾ������
		$productIds_final = array();
		foreach ($items as $it) {
			$productIds_final[] = $it['product_id'];
		}

		if ($shopping_cart_type == IShoppingCart::ONLINE_CART) {
			// ɾ����ǰ�汻 unset ����Ʒ
			$deleteProductIds = array_diff($productIds, $productIds_final);
			self::delItemInvalid($uid, $deleteProductIds);
		}

		$promoRule = array();
		$coupons = array();
		if ($shopping_cart_type != IShoppingCart::INSTALLMENT_CART) {
			$promoRule = self::getPromotionRules($items, $wh_id);
			$coupons = EA_Promotion::getPromotionRulesBatch($productIds_final, $wh_id, true);
		}

		return array(
			'items' => $items, // ��Ʒ�б�
			'suiteInfo' => $suiteInfo, //�ײ���Ϣ
			'promoRule' => $promoRule,
			'coupons' => $coupons,
			'conflict' => $conflicts, //��ͻ����
		);
	}

	/**
	 * ��ȡ�����Ļ�ô����������
	 * @param array $promoItems ������Ʒ�������޸ģ��������ã�
	 * @param int $whId ��վID
	 * @param int $uid �û�ID
	 * @return mixed array ��������false ��ȡʧ��
	 */
	public static function getPromotionRules(&$promoItems, $whId, $uid = 0)
	{
		$promoRule = IPromotionRule::getRuleForShoppingCart($promoItems, $whId, $uid);
		if ($promoRule === false) {
			Logger::warn('IPromotionRule::getRuleForShoppingCart failed-' . IPromotionRule::$errCode . '-' . IPromotionRule::$errMsg);
			$promoRule = array();
		} else {
			$promoRule = empty($promoRule) ? array() : ToolUtil::gbJsonDecode($promoRule);
			if (isset($promoRule['errCode'])) { //��ȥ����Ҫ��ʾ��ǰ�˵���Ϣ
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


	/* ��ȡ������������Ϣ
	 * ����˵��
	 * $order = array(
			'items' => array()
			'isVirtual' => array(),
			'weight' => array(),
			'packages' => array(),

		);
	 * */

	public static function getOrderDeliveryInfo($order, $district, $wh_id, $productInfo, $forbidList) {
		global $_District, $_SelfFetchProductids;

		if (!isset($order['packages']) || !is_array($order['packages'])) {
			self::$errCode = -1;
			self::$errMsg = "��ȡ������Ϣʧ��";
			self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg: package s������ʽ����";
			return false;
		}

		if (!isset($order['isVirtual']) || !is_array($order['isVirtual'])) {
			self::$errCode = -2;
			self::$errMsg = "��ȡ������Ϣʧ��";
			self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg: isVirtual ������ʽ����";
			return false;
		}

		if (!isset($order['weight']) || !is_array($order['weight'])) {
			self::$errCode = -3;
			self::$errMsg = "��ȡ������Ϣʧ��";
			self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg: weight ������ʽ����";
			return false;
		}

		if (!isset($order['items']) || !is_array($order['items'])) {
			self::$errCode = -4;
			self::$errMsg = "��ȡ������Ϣʧ��";
			self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg: items ������ʽ����";
			return false;
		}

		$packages = $order['packages'];
		$isVirtual = $order['isVirtual'];
		$weight = $order['weight'];
		$items = $order['items'];
		$user_level = empty($order['user_level']) ? 0 : $order['user_level'];

		$productIds = array_keys($productInfo);
		// ������ͷ�ʽ
		$orderPrice = 0;
		foreach ($packages as $p) { //�����ܽ��
			$orderPrice += $p['totalAmt'];
		}
		$shippingType = IPreOrder::getShippingTypeByDestination($district, $orderPrice, $isVirtual, $weight, $wh_id, $user_level);
		if ($shippingType === false) {
			return false;
		}

		// �����߼����
		$shipNotAvailable = array();
		if (!empty($forbidList)) {
			$shipNotAvailable = IShipping::getForbidenShippingType($forbidList, $_District[$district]['province_id'], $_District[$district]['city_id'], $district, $wh_id);
		}

		// ȥ�������õ����ͷ�ʽ
		$shipForbidProducts = array();
		$isEffect = false;
		foreach ($shippingType as $key => $shipping) {
			if (isset($shipNotAvailable[$key])) {

				// ��¼ ��Ч������ ��ʽ ��Ӧ����Ʒ
				$shipForbidProducts = array_merge($shipNotAvailable[$key], $shipForbidProducts);

				// �� ���õ����ͷ�ʽ �� ȥ�������˵�
				unset($shippingType[$key]);

				if (count($shippingType) == 0)
					$isEffect = true;
			}
		}

		//�����������Щ������Ʒ����Ҫ�޳�����
		$bothExist = array_intersect($_SelfFetchProductids, $productIds);
		if (count($bothExist) == 0) {
			foreach ($shippingType as $key => $it) {
				// ��������ܶ��֣���̨������ʱ����ӣ�������û�б�ǵ�����£����ַ����жϱȽϺ�
				if (false === strpos($it['ShipTypeName'], '�������')) {
					continue;
				}
				unset($shippingType[$key]);
			}
		}

		// û�п��õ����ͷ�ʽ
		if (count($shippingType) == 0) {
			//������������������ͷ�ʽΪ��
			if ($isEffect) {
				// ����Щ��Ʒ�� �޹�״̬���� ���ǵ����״̬����
				foreach ($shipForbidProducts as $pid) {
					// ���°����е���Ʒ����������
					foreach ($packages as $psystock => $pack) {
						if (!isset($pack['items'][$pid]))
							continue;

						$packages[$psystock]['items'][$pid]['stock_desc'] = "�޷�����";
						$packages[$psystock]['items'][$pid]['stock_status'] = $productInfo[$pid]['restricted_trans_type'];

						foreach ($items as $_key => $_item) {
							if ($_item['product_id'] == $pid) {
								$items[$_key]['stock_desc'] = "�޷�����";
								$items[$_key]['stock_status'] = $productInfo[$pid]['restricted_trans_type'];
							}
						}

						break;
					}
				}
			}
			else { // ����������
				foreach ($packages as $psystock => $pack) {
					foreach ($pack['items'] as $pid => $it) {
						$packages[$psystock]['items'][$pid]['stock_desc'] = "�޷�����";
						$packages[$psystock]['items'][$pid]['stock_status'] = 99;

						foreach ($items as $_key => $_item) {
							if ($_item['product_id'] == $pid) {
								$items[$_key]['stock_desc'] = "�޷�����";
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
						self::$errMsg = "������Դ����";
						self::$logMsg = basename(__FILE__) . "line," . __LINE__ . ",������Դ����" . $promotionRule['errMsg'];
						return false;
					} else if ($promotionRule['errCode'] != 0 || !isset($promotionRule['rules'][0])) { //��ȡ��������ʧ��
						self::$errCode = $promotionRule['errCode'];
						self::$errMsg = $promotionRule['errMsg'];
						self::$logMsg = basename(__FILE__) . "line," . __LINE__ . ",������Դ����" . $promotionRule['errMsg'];
						return false;
					} else {
						//����Ҫ�����û��Ѿ�ʹ�øù���Ĵ���
						if ($promotionRule['rules'][0]['apply_time_peruser'] < 999) {
							$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
							$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
							if (!empty($orderDb)) {
								$sql = "select order_char_id from t_orders_{$db_tab_index['table']} where uid=$uid and coupon_code='rule_{$rule_id}' and status >= 0";
								$count = $orderDb->getRows($sql);
								if (is_array($count) && count($count) >= $promotionRule['rules'][0]['apply_time_peruser']) {
									self::$errCode = -992;
									self::$errMsg = "���Ѿ��μӹ��δ����Ż�" . count($count) . "�Σ������ٲμ�";
									return false;
								}
							}
							$promotion = $promotionRule['rules'][0];
						} else {
							$promotion = $promotionRule['rules'][0];
						}

						$promotion['benefits'] = 0;
						//����ǻ�����������Ʒ������Ҫ��items���һ����¼
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
	 * ��ȡ��ѡ�ķ�Ʊ����
	 */
	public static function getInvoicesContentOpt($c3ids, $wh_id) {
		$contentOpt = array('1'); //Ĭ��ֵ
		$isCanFuzzyInvoice = true;

		if ($wh_id == SITE_SH || $wh_id == SITE_BJ) {
			$c3Info = ICategoryTTC::gets($c3ids, array('level' => 3, 'status' => 0), array('parent_id', 'flag')); //��ȡС��ID
			if (is_array($c3Info)) { //�ɹ�
				$c2ids = array();
				foreach ($c3Info as $c3) {
					if (($c3['flag'] & FUZZY_INVOICE) != FUZZY_INVOICE) { //������ģ����Ʊ
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

		// contentOpt �п������ظ���Ԫ�ر�uniqueɾ���ˣ���Ҫ�������򣬷���json���ص�ʱ���õ���key-value�ĸ�ʽ����ios�ϻ����
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
		// ���� edm �۸�ר���ֶ�
		$needToCheckVIP = false;
		$edmCodeToProduct = array();
		if (isset($_COOKIE['edm']) && $_COOKIE['edm'] != '') {
			$edmArr = explode(",", $_COOKIE['edm']);
			foreach ($edmArr as $ll) {
				$tmp = explode('_', $ll);
				if (isset($tmp[0]) && isset($tmp[1])) {
					if ($tmp[0] == 'ttpgn' //������tips��֤����EDM����
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
			//��ȡedmר��۸�
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

				$products[$ei['ProductSysNo']]['price'] = $ei['EDMPrice'] * 100;
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

		//��ȡ������,ͬʱ����Ƿ��ܿ���Ʊ���ܷ�ģ����Ʊ
		$matchPids = array();
		$totalAmt = 0;
		$totalWeight = 0;
		$totalCut = 0;
		$isCanVATInvoice = true;
		$c3ids = array();
		$rule_total_amt = 0;

		//��ʼ������Ʒ��������ִ���
		$packages = array();
		$isVirtual = array();
		$weight = array();
		$itemsForConflict = array();
		foreach ($items as $key => $item) {
			if (!isset($packages[$item['psystock']]['items'][$item['product_id']])) {
				// TODO: item����Ϣ̫�࣬����һ����
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

				// ����ж�۸����ƣ� ����� discount_p_name
				if (isset($item['discount_p_name'])) {
					$itemMin['discount_p_name'] = $item['discount_p_name'];
				}
				//������ִ����Ӷ���
				$packages[$item['psystock']]['items'][$item['product_id']] = $itemMin;
			} else {
				$packages[$item['psystock']]['items'][$item['product_id']]['buy_count'] += $item['buy_count'];
				$packages[$item['psystock']]['items'][$item['product_id']]['cash_back'] += $item['cash_back'];
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
			if (0 == ($item['flag'] & CAN_VAT_INVOICE)) { //��ֵ��Ʊ
				$isCanVATInvoice = false;
			}

			$c3ids[] = $item['c3_ids'];

			if ($item['main_product_id'] > 0) {
				$matchPids[] = $item['main_product_id'];
			}
			@$packages[$item['psystock']]['totalAmt'] += $item['price'] * $item['buy_count'];
			@$packages[$item['psystock']]['totalCut'] += $item['buy_count'] * $item['cash_back'];
			@$packages[$item['psystock']]['totalWeight'] += $item['buy_count'] * $item['weight'];

			if (isset($promotion['benefit_type']) && $promotion['benefits'] > 0) {
				if (in_array($item['product_id'], $promotion['pids'])) { //����ÿ���ӵ�����������������Ʒ���ܼ۸񣬱������ӵ�֮���̯�����ɱ�
					@$packages[$item['psystock']]['rule_total_amt'] += $item['price'] * $item['buy_count'];
					$rule_total_amt += $item['price'] * $item['buy_count'];
				}
			}

			$totalAmt += ($item['price']) * $item['buy_count'];
			$totalWeight += $item['buy_count'] * $item['weight'];
			$totalCut += $item['buy_count'] * $item['cash_back'];
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
			// ������������ȡ
			$weight[$item['psystock']] = $packages[$item['psystock']]['totalWeight'];
		}

		//��̯���������ڸ����Ӷ����ķ�̯���
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
		} else { //������ rule_benefits �ֶ�, ����ǰ̨����
			foreach ($packages as $subKey => $subOrder)
				$packages[$subKey]['rule_benefits'] = 0;
		}

		// ������������������
		$ret = self::getEasyMatch($items, $wh_id, $packages);
		if (false === $ret)
			return false;

		$items = $ret['items'];
		$packages = $ret['packages'];

		$totalCut += $ret['totalCut'];
		$availableInvoices = array(
			'isCanVAT'    => $isCanVATInvoice,
			//������ﳵ���бʼǱ�����Ʒ����Ҫ��ʾ�Թ�˾����ͨ��Ʊ���޷�����
			'hasNoteBook' => in_array(234, $c3ids) ? 1 : 0,
			//��ȡ��Ʒ�������࣬�ж��Ƿ���ģ����Ʊ
			'contentOpt'  => IPreOrder::getInvoicesContentOpt($c3ids, $wh_id),
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
	 * @static ������Ʒ�ͷ�վ��Ϣ��ȷ��Ҫ�ش�����Ʒ
	 * @param $items
	 * @param $wh_id
	 * @param $products
	 * @return array|bool
	 */
	public static function getItemInfo($items, $wh_id, $products, $district_id=0)
	{
		// ��ȡ����Ʒ����Ϣ
		$ret = self::getMainItemsInfo($items, $wh_id, $products, $district_id);
		if ($ret === false)
			return false;

		$items = $ret['items'];
		$productIds = $ret['productIds'];
		$limitedProduct = $ret['limitedProduct'];
		$forbidList = $ret['forbidList'];


		// ��ȡ�л�������Ʒ��Ӧ����Ʒ��Ϣ
		$ret = self::getGiftItemsInfo($items, $productIds, $products);
		if ($ret === false)
			return false;

		$items = $ret;


		// ����ԤԼ��Ʒ������
		$ret = self::setAppointInfo($items, $wh_id, $products);

		$items = $ret;

		return array(
			'items'          => $items,
			'forbidList'     => $forbidList,
			'limitedProduct' => $limitedProduct
		);
	}


	/**
	 * @static ��ȡ����Ʒ����Ϣ
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

			// ��������˶�۸�
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
			$items[$key]['rushing_buy'] = ($product['flag'] & OTHER_TIME_LIMITED_RUSHING_BUY) == OTHER_TIME_LIMITED_RUSHING_BUY; //����
			$items[$key]['canVAT'] = ($product['flag'] & CAN_VAT_INVOICE) == CAN_VAT_INVOICE;
			$items[$key]['canUseCoupon'] = ($product['flag'] & COUPON_PRODUCT) != COUPON_PRODUCT;
			$items[$key]['cash_back'] = isset($items[$key]['cash_back']) ? $items[$key]['cash_back'] + $product['cash_back'] : $product['cash_back'];
			$items[$key]['price'] = $product['price'] + $items[$key]['cash_back'];


			// Ĭ�ϲ��������Ʒ
			$items[$key]['isVirtual'] = IProduct::NO_DELAY;
			$items[$key]['lowest_num'] = !empty($product['lowest_num']) ? $product['lowest_num'] : 1;
			$items[$key]['delay_days'] = 0;
			if (isset($promotion['benefit_type'])) {
				if ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_HUANGOU']
					&& $item['product_id'] == $promotion['discount']
				) { //����

					$dis = ($product['price'] - $promotion['plus_con']) > 0 ? ($product['price'] - $promotion['plus_con']) : 0;
					$promotion['benefits'] = $dis * $promotion['benefit_times'] * $promotion['benefit_per_time'];
				} else if ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_PRODUCT']
					&& $item['product_id'] == $promotion['discount']
				) { //������Ʒ

					$promotion['benefits'] = $product['price'] * $promotion['benefit_times'] * $promotion['benefit_per_time'];
				}
			}

			$items[$key]['point'] = $product['point'];
			$items[$key]['num_limit'] = $product['num_limit'];
			if ($product['num_limit'] > 0 && $product['num_limit'] < 999) {
				$limitedProduct[] = $product['product_id'];
			}

			// ���״̬����
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

				// ����ӳ٣��������Ϳ��
				$items[$key] = self::setStockDelay($items[$key], $product, $wh_id, $district_id);

				// Ԥ���ӳ٣�����ж�Ϊ��Ԥ���ӳ٣���Ḳ������ӳ��߼�
				$items[$key] = self::setBookingDelayType($items[$key], $product);

				// $productIds Ϊ�л�������Ʒ��������Ʒ��ʱ����Ҫ�õ�
				$productIds[$item['product_id']] = $item['product_id'];
			} else {
				$items[$key]['stock_desc'] = IProductInventory::$_StockTips['not_enough'];
				$items[$key]['stock_status'] = IProductInventory::$_StockStatus['not_enough'];
			}
		}

		$resulst = array(
			'productIds'     => $productIds, // �л�����ƷID����
			'forbidList'     => $forbidList, //  ������Ʒ
			'limitedProduct' => $limitedProduct, // �޹���Ʒ
			'items'          => $items, // ������Ʒ����Ϣ
		);

		return $resulst;
	}


	/**
	 * @static ��ȡ�л�������Ʒ��Ӧ����Ʒ��Ϣ
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

		//�޳���������Ʒ����һ������ֲ�

		$products_psy = array();
		$giftsValid = array();
		$products_gifts_type = array();
		foreach ($products as $pwinfo) {
			$products_psy[$pwinfo['product_id']] = $pwinfo['psystock'];
			// TODO:�Ż�����
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

		//�ֱ��޳���ÿ����Ʒ������û�п�����Ʒ
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

		//��ȡ��Ʒ��Ʒ�Ļ�����Ϣ
		$gift_base_info = IProductCommonInfoTTC::gets(array_unique($gifts_final_ids), array(), array('name', 'product_char_id', 'weight', 'pic_num'));
		if (false === $gift_base_info) {
			self::$errCode = IProductCommonInfoTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductCommonInfoTTC failed]' . IProductCommonInfoTTC::$errMsg;
			return false;
		}

		//�޳�������Ϣ�����ڵ���Ʒ
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

		//��ȡ��Ʒ���ڸ����ֲֵ�װ��,��Ʒ�����״̬�������ǳ���״̬
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

		//����Ʒ�����Ӧ������Ʒ���а�

		foreach ($items as $key => $item) {
			$items[$key]['gift'] = array();
			foreach ($giftValidInventory as $gift) {
				$gift_status = isset($gifts_status[$gift['gift_id']][$_StockToStation[$gift['stock_id']]]) ? $gifts_status[$gift['gift_id']][$_StockToStation[$gift['stock_id']]] : false;
				if (($gift['product_id'] == $item['product_id']) && ($_StockToStation[$gift['stock_id']] == $_StockToStation[$item['psystock']])
					&& ($gift_status !== false && $gift_status != PRODUCT_STATUS_NORMAL)
				) { //��Ʒ�����״̬�������ǳ���״̬

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
			// ��۸�ȡ��ͨ��Ʒ�ļ۸�id���ײ���Ʒ�ļ۸�id����
			if ($item['type'] != IShoppingCart::ITEM_NORMAL) {
				continue;
			}

			//�����ȡû�м۸񣬻��߼۸�IDΪ0������
			if (empty($item['price_id'])) {
				continue;
			}

			$multiPriceProduct[$item['product_id']]['price_id'] = $item['price_id'];
			$multiPriceProduct[$item['product_id']]['multiPriceType'] = 0; //Ĭ�϶�û������۸�
		}

		// $multiPriceProductΪ�� ����Ҫ������۸���Ϣ
		if (count($multiPriceProduct) > 0) {
			foreach ($multiPriceProduct as $pid => $mp) {
				if (isset($products[$pid])) {
					$multiPriceProduct[$pid]['multiPriceType'] = $products[$pid]['multiprice_type'];
				}
			}

			$multiPriceInfo = IMultiPrice::getCartPrices(array('wh_id' => $wh_id, 'product' => $multiPriceProduct));
			if (isset($multiPriceInfo['Prices']) && is_array($multiPriceInfo['Prices'])) {
				foreach ($multiPriceInfo['Prices'] as $pid => $mp) {
					if ($mp['isSatisfy'] == true && isset($products[$pid])) { //��������Ϣ
						if ($mp['count_type'] == MP_COUNT_BY_DISCOUNT) { //�ۿ�
							$products[$pid]['price'] = 10 * bcdiv($products[$pid]['price'] * $mp['price'], 1000, 0);
						} else if ($mp['count_type'] == MP_COUNT_BY_PRICE) {
							$products[$pid]['price'] = $mp['price'];
						}
						$products[$pid]['discount_p_name'] = $mp['price_name'];

						// ���ײ���Ϣ����Ӷ�۸���Ϣ
						reset($suitInfo);
						foreach ($suitInfo as $key => $suit) {
							foreach ($suit['product_list'] as $p => $pInfo) {
								// �ҵ�ÿһ���ײ��а����Ķ�۸����Ʒ
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

	// �����߻������߹��ﳵ�л�ȡ��Ʒ�б�
	public static function getItemList($uid, $wh_id, $offLine_params)
	{
		// ���ﳵ����
		$items = array();

		if ($offLine_params['type'] != IShoppingCart::ONLINE_CART) { //���߹��ﳵ���������ܲ���������һ������
			if (empty($offLine_params['items']) || !is_array($offLine_params['items'])) {
				self::$errCode = -1;
				self::$errMsg = "���Ĺ��ﳵ��Ʒ�б�Ϊ��";
				self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:���߹��ﳵ��Ʒ�б�Ϊ��";
				return false;
			}

			foreach ($offLine_params['items'] as $item) {
				if (empty($item['product_id'])) {
					self::$errCode = -1;
					self::$errMsg = "���Ĺ��ﳵ��Ʒ�б�Ϊ��";
					self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:���߹��ﳵ��ʽ����";
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
				);
			}
		} else { // ���߹��ﳵ��Ҫ����û�ID
			if (!isset($uid) || $uid <= 0) {
				self::$errCode = 101;
				self::$errMsg = "�û�ID�Ƿ�";
				self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:uid($uid) is invalid";
				return false;
			}

			$ret = IShoppingCart::get($uid);
			if (false === $ret) {
				self::$errCode = IShoppingCart::$errCode;
				self::$errMsg = "���ҹ��ﳵʧ��";
				self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg: ����({$uid})���ﳵʧ��" . IShoppingCart::$errMsg;
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
		//���ʹ�õ������߹��ﳵ����ɾ�����Ϸ��Ĺ��ﳵ��Ʒ
		foreach ($deleteProductIds as $pid) {
			IShoppingCart::remove($uid, $pid);
		}
	}

	/**
	 * ������������������
	 * @param array $items
	 * @param int $wh_id
	 * @param array $packages
	 */
	public static function getEasyMatch($items, $wh_id, $packages = array()) {
		//����������
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

		//��ȡ������
		//ixiuzeng��ӣ��㶫վ��������ӹ㶫վ��ȡ���Ϻ��ͱ�������������Ȼ���Ϻ���ȡ
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
						// ������Ʒ�� match_cut �ֶ�
						if ($item['main_product_id'] == $em['product_id'] && $em['type'] == PRODUCT_BY_MIND && $item['product_id'] == $em['relative_id']) {
							$cut = intval($em['property']);
							$cut = $cut > 0 ? $cut : 0;
							$items[$key]['match_cut'] = $cut;

							// ����ж�������Ҫ���¶����� $totalCut
							if (!empty($packages)) {
								$packages[$item['psystock']]['items'][$item['product_id']]['priceCutByMatch'] = intval($em['property']);
								$totalCut += $item['matchNum'] * $packages[$item['psystock']]['items'][$item['product_id']]['priceCutByMatch'];
								$packages[$item['psystock']]['totalCut'] += $item['matchNum'] * $packages[$item['psystock']]['items'][$item['product_id']]['priceCutByMatch'];
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

	// ����ײ��е���Ʒ
	private static function transPackageToItems($items, $wh_id)
	{
		$package_buycount = array();
		$package_ids = array();

		reset($items);
		foreach ($items as $key => $it) {
			if ($it['type'] == IShoppingCart::ITEM_PACKAGE) { //�ײ�
				$package_buycount[$it['product_id']] = $it['buy_count'];
				$package_ids[] = $it['product_id'];
				unset($items[$key]);
			}
			else if ($it['type'] == IShoppingCart::ITEM_NORMAL) { //��Ʒ
				//��ͨ��Ʒ package_id ����Ϊ NOT_BELONG_PACKAGE����ʾ�������κ��ײ�
				$items[$key]['package_id'] = IShoppingCart::NOT_BELONG_PACKAGE;
				$items[$key]['unique_id'] = "{$it['product_id']}";
			}
		}

		// ���Ϊ�գ���ֱ�ӷ��� items
		if (empty($package_ids)) {
			return array(
				'items'     => $items,
				'suiteInfo' => array(),
			);
		}

		//����ײ͵�get������ͨ���ײ�id����ȡ�ײ͵���Ʒ��Ϣ������ pid��buy_count��price_id
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
				);
				// �ַ���ת����
				$pkgs[$key]['product_list'][$pid]['product_saving_amount'] = intval($product['product_saving_amount']);

				// ÿ���ײ��ܵķ��ֽ��
				$total_product_saving_amount += intval($product['product_saving_amount']);
			}

			foreach ($package_buycount as $pkgid => $bc) {
				if ($pkgid == $pkg['pid']) {
					$pkgs[$key]['buy_count'] = $bc;
					// ÿ���ײ��ܵķ��ֽ��ַ���ת����
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
			// �����Ʒ�������ײͣ�����ӵ���ͨ��Ʒ�б�
			if (!isset($item['package_id']) || $item['package_id'] == IShoppingCart::NOT_BELONG_PACKAGE) {
				$normal_items[] = $item;
				continue;
			}

			// ��Ʒ���� $it['package_id'] ����ײͣ�����Ҫ���ײ���Ϣ�ϲ�����Ʒ�б����Ϣ��
			foreach ($suiteInfo as &$pkg) {
				if ($pkg['pid'] == $item['package_id']) {
					// ��ӵ��ײ���Ʒ�б�
					$product_id = $item['product_id'];
					$pk = $pkg['product_list'][$product_id];
					$pk['product_saving_amount'] = intval($pk['product_saving_amount']);

					// �Żݼ۸��¼product_saving_amount �ۼӵ� ����cash_back����
					$items[$key]['cash_back'] = isset($items[$key]['cash_back']) ? $items[$key]['cash_back'] + $pk['product_saving_amount'] : $pk['product_saving_amount'];
					$items[$key]['product_amount'] = $pk['product_amount'];
					$items[$key]['product_saving_amount'] = $pk['product_saving_amount'];
					$pkg_items[] = $items[$key];
					break;
				}
			}
		}
		return array(
			'pkg_items'    => $pkg_items, // �ײ���Ʒ
			'normal_items' => $normal_items, // ��ͨ��Ʒ
			'items'        => $items, // ������Ʒ
		);
	}

	private static function setBookingDelayType($item, $product)
	{

		if ($item['isVirtual'] == IProduct::CROSS_STOCK_DELAY) {
			// ���֮ǰ���ӳ������� ����ӳ٣����ۼ�
			$baseDelay = $item['vValue'];
		} else {
			// ���֮ǰ���ӳ������� ���������ۼ�
			$baseDelay = 0;
		}

		switch ($product['booking_type']) {
			case IProduct::BOOKING_TYPE_SPECIFIC_DELAY:
				$N = $baseDelay + $product['booking_value'];
				$item['stock_desc'] = "�����µ���{$N}���Ϊ������";
				$item['stock_status'] = IProductInventory::$_StockStatus['bookingN'];
				$item['isVirtual'] = $product['booking_type'];
				$item['vValue'] = $product['booking_value'];
				break;
			case IProduct::BOOKING_TYPE_SPECIFIC_DATE:
				$N = $product['booking_value'];
				$date = date("Ymd", strtotime("{$N} +{$baseDelay} day"));
				$t1 = strtotime($date);
				// ���û�й���
				if (IShippingTime::getDiffDays(time(), $t1) > 0) {
					$N = date("m��d��", $t1);
					$item['stock_desc'] = "�����µ���{$N}��Ϊ������";
					$item['stock_status'] = IProductInventory::$_StockStatus['bookingDate'];
					$item['isVirtual'] = $product['booking_type'];
					$item['vValue'] = $product['booking_value'];
				}
				break;
			case IProduct::BOOKING_TYPE_NOSPECIFIC_DATE:
				$item['stock_desc'] = "��Ʒ������";
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

			// ����ӳ�����
			$item['stock_desc'] = IProductInventory::$_StockTips['arrival1-3'];
			$item['stock_status'] = IProductInventory::$_StockStatus['arrival1-3'];
			$item['isVirtual'] = IProduct::VIRTUAL_STOCK_TYPE_1;
			$item['vValue'] = IShippingTime::$vStockDelay[IProduct::VIRTUAL_STOCK_TYPE_1];

		} else {
			$des_dc = IProductInventory::getDCFromDistrict($district, $wh_id);

			//ʵ�ʿ���㹻
			if (!isset($_StockToDCTransitDays[$product['psystock']][$des_dc]) || $_StockToDCTransitDays[$product['psystock']][$des_dc] == 0) {
				$item['stock_desc'] = IProductInventory::$_StockTips['available'];
				$item['stock_status'] = IProductInventory::$_StockStatus['available'];
				$item['isVirtual'] = IProduct::NO_DELAY;
				$item['vValue'] = 0;
			} else {
				$item['stock_desc'] = "�л�����{$_StockID_Name[$product['psystock']]}������{$_StockToDCTransitDays[$product['psystock']][$des_dc]}�������";
				$item['stock_status'] = IProductInventory::$_StockStatus['arrivalN'];
				$item['isVirtual'] = IProduct::NO_DELAY;
				$item['vValue'] = $_StockToDCTransitDays[$product['psystock']][$des_dc];
			}
		}
		return $item;
	}

	/**
	 * @static ����Ԥ������
	 * @param $items
	 * @param $wh_id
	 * @param $products
	 */
	private static function setAppointInfo($items, $wh_id, $products)
	{
		Logger::info(var_export($products, true));
		$now = time();
		// ��ȡ����Ԥ�����Ե���Ʒ
		$appointProducts = array(); //IPreOrder::$appointProduct;

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

			// ��ԤԼʱ���
			$items[$key]['order_time_from'] = $appinfo['order_time_from'];
			$items[$key]['order_time_to'] = $appinfo['order_time_to'];

			// �ɹ����ʱ���
			$items[$key]['buy_time_from'] = $appinfo['buy_time_from'];
			$items[$key]['buy_time_to'] = $appinfo['buy_time_to'];

			// �������
			$items[$key]['stock_desc'] = $items[$key]['stock_desc'] . "(Ԥ��)";
			/*if ($now < $items[$key]['buy_time_from']) {
				$date = date("Y-m-d H:i:s", $items[$key]['buy_time_from']);
				$items[$key]['stock_desc'] = $items[$key]['stock_desc'] . "(������{$date}��ʼ����ԤԼ�û������ĵȴ�)";
			} else if ($now < $items[$key]['buy_time_to']) {
				$items[$key]['stock_desc'] = $items[$key]['stock_desc'] . "(��������У��μ�Ԥ����û����ܹ���)";
			} else {
				$date = date("Y-m-d H:i:s", $items[$key]['buy_time_to']);
				$items[$key]['stock_desc'] = $items[$key]['stock_desc'] . "(������{$date}������лл���Ĺ�ע)";
			}*/
		}

		return $items;
	}

	/**
	 * ��������Ʒ��ּ���߼� TAPD 5484733
	 * @param array $products ��Ʒ��Ϣ����
	 * @param int $whid ��ǰ��վID
	 * @return array �Ƿ�ͨ�����
	 */
	public static function diyProductStcokCheck($products, $whid) {
		$ret = array();

		$pids = array_keys($products);
		$cal = array_intersect($pids, self::$DIY_SERVICE_IDS);
		if (! empty($cal)) { //���ﳵ������������Ʒ
			foreach($products as $pid => &$product) {
				if (in_array($pid, self::$DIY_SERVICE_IDS)) { //��������Ʒֱ���ų�
					continue;
				}

				if (! isset($product['c3_ids'])) { //���γ����޷����
					Logger::warn(__FUNCTION__ . ' cannot be execute! c3_ids missing!');
				}
				else if (in_array($product['c3_ids'], self::$DIY_PRODUCT_C3_IDS)) { //��������ID
					if (! isset($product['psystock'])) { //���γ����޷����
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
}

