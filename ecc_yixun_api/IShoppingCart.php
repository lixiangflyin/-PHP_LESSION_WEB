<?php
if (!defined('MAX_SHOPPING_CART_ITEM')) {
	define('MAX_SHOPPING_CART_ITEM', 100);
}
if (!defined('MAX_COUNT_PER_ITEM')) {
	define('MAX_COUNT_PER_ITEM', 99);
}


/*�����붨��
 100:��Ʒ���벻�Ϸ�
 101:uid���Ϸ�
 102:��Ʒ�������Ϸ�
 103:û�е�¼
 104:��Ʒ��id���Ϸ�
 105:��Ʒ�������Ϸ�
 106���ֿ�id���Ϸ�
 107:��Ʒ������
 108:�����޹�����
 109�������������

 110:��Ʒ״̬���Ϸ�
 111:��Ʒ����Ϊ��
 */

class IShoppingCart
{
	public static $errCode = 0;
	public static $errMsg = '';
	public static $buyNeedNum = 0;

	const ITEM_NORMAL = 0; // ��ͨ��Ʒ
	const ITEM_PACKAGE = 1; // �ײ���Ʒ
	const NOT_BELONG_PACKAGE = 0; // ��ʾ��Ʒ�������κ��ײ�

	// ��Ʒ��������
	const MAX_SHOPPING_CART_ITEM = 50;

	// ÿ����Ʒ�ĸ�������
	const MAX_COUNT_PER_ITEM = 99;

	// ��Ʒ�ַ�����󳤶�
	const MAX_ITEM_LENGTH = 10000;

	// ���ﳵ���
	const ONLINE_CART = 0; //��������TTC���ﳵ
	const INSTALLMENT_CART = 1; //���ڸ���
	const ES_CART = 2; // ���ܲ���
	const OFFLINE_CART = 3; // �������߹��ﳵ

	private static $default = array(
		'buy_count' => 1,
		'price_id'  => 0,
		'OTag'      => '',
		'type'      => self::ITEM_NORMAL,
		'wh_id'     => SITE_SH
	);

	/**
	 * ���ô�����ʹ�����Ϣ
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

	//�ͻ��л�վ�㣬��Ҫ�����ﳵ�У����·�վ�����۵���Ʒ
	//$productIdArr = array(pid1,pid2,pid3)
	public static function tryJumpToAnotherSubSiteNoLogin($productIds, $new_wh_id)
	{
		//��ȡ��Ʒ�ֲ���Ϣ
		$products = IProductInfoTTC::gets($productIds, array('wh_id' => $new_wh_id), array('product_id', 'status'));
		if (false === $products) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
			return false;
		}
		if (count($products) == 0) {
			return array();
		}

		$returnArr = array();
		$productIds = array();
		foreach ($products as $p) {
			if ($p['status'] != PRODUCT_STATUS_NORMAL) {
				$returnArr[$p['product_id']] = "";
				$productIds[] = $p['product_id'];
			}
		}
		if (count($productIds) == 0) {
			return array();
		}

		//��ȡ���۵���Ʒ����
		$productCommon = IProductCommonInfoTTC::gets($productIds, array(), array('product_id', 'name'));
		if (false === $productCommon) {
			//TTC error
		} else {
			foreach ($productCommon as $pc) {
				$returnArr[$pc['product_id']] = $pc['name'];
			}
		}

		return $returnArr;
	}

	//�ͻ��л�վ�㣬 ��Ҫ�����ﳵ�У� ���·�վ�����۵���Ʒ
	public static function tryJumpToAnotherSubSite($uid, $new_wh_id)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}

		$items = self::get($uid);
		if (false === $items) {
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query get failed]' . self::$errMsg;
			return false;
		}
		if (count($items) == 0) {
			return array();
		}

		$productIds = array();
		foreach ($items as $key => $item) {
			$productIds[] = $item['product_id'];
		}
		//��ȡ��Ʒ�ֲ���Ϣ
		$products = IProductInfoTTC::gets($productIds, array('wh_id' => $new_wh_id), array('product_id', 'status'));
		if (false === $products) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
			return false;
		}
		if (count($products) == 0) {
			return array();
		}

		$returnArr = array();
		$productIds = array();
		foreach ($products as $p) {
			if ($p['status'] != PRODUCT_STATUS_NORMAL) {
				$returnArr[$p['product_id']] = "";
				$productIds[] = $p['product_id'];
			}
		}

		if (count($productIds) == 0) {
			return array();
		}

		//��ȡ���۵���Ʒ����
		$productCommon = IProductCommonInfoTTC::gets($productIds, array(), array('product_id', 'name'));
		if (false === $productCommon) {
			//TTC error
		} else {
			foreach ($productCommon as $pc) {
				$returnArr[$pc['product_id']] = $pc['name'];
			}
		}

		return $returnArr;
	}


	/**
	 * ��ӵ�������Ʒ/�ײ͡������ﳵ��
	 * @param int $uid �û�ID
	 * @param array $productNew ����Ʒ/�ײ͡���Ϣ
	���������ֶΣ�
	 * 'product_id' => $pid,
	 * 'buy_count' => $pnum,
	 * 'wh_id' => $whId,
	 * 'main_product_id' => $main_product_id,
	 * 'price_id' => $price_id,
	 * 'type' => $type,
	 * 'OTag' => $otag
	 * 'reqFromMobile' => $bool
	 * @return mixed
	 */
	public static function add($uid, $productNew)
	{
		$productNew['uid'] = $uid;
		$productNew = self::checkParam($productNew);
		if (false === $productNew) {
			return false;
		}

		$product_id = $productNew['product_id'];
		$num = $productNew['buy_count'];
		$wh_id = $productNew['wh_id'];
		$otag = $productNew['OTag'];
		$main_product_id = $productNew['main_product_id'];
		$type = $productNew['type'];
		$reqFromMobile = isset($productNew['reqFromMobile']) ? (bool)$productNew['reqFromMobile'] : false; //false by default
		$district_id = isset($productNew['prid']) ? $productNew['prid'] : 0;//��id


		//��ȡ���ﳵ��������Ϣ
		$items = self::get($uid);
		if (false === $items) {
			return false;
		}

		switch ($type) {
			case IShoppingCart::ITEM_NORMAL: //��Ʒ
				$product = IProductInfoTTC::get($product_id, array('wh_id' => $wh_id)); //��ȡ��Ʒ�ֲ���Ϣ
				if (false === $product) {
					self::setErr('IProductInfoTTC');
					return false;
				} else if (count($product) < 1) {
					self::setErr(107, basename(__FILE__, '.php') . " |" . __LINE__ . '��Ʒ��Ϣ������');
					return false;
				} else if ($product[0]['status'] != PRODUCT_STATUS_NORMAL) {
					self::setErr(110, basename(__FILE__, '.php') . " |" . __LINE__ . '��Ʒ�ݲ�����');
					return false;
				}

				// �����������Ʒ�����ƻ��ͽ��ܲ�������ֱ�Ӽ��빺�ﳵ
				if (IProduct::isCanNotAddToNormalCart($product[0])) {
					return array();
				}

				//��ӻ�ȡ�����Ʒ�Ŀ��@ixiuzeng
				$result = IProductInventory::setProductsInventoryInfo(array($product_id), $wh_id, $product,$district_id);
				if (false === $result) {
					self::setErr('IProductInventory');
					return false;
				}
				$productInventoryInfo = $result['inventoryInfo'];
				$product = $result['productWhInfo'][0];

				$exist = false;
				$isMainProduct = false;
				$isMatchProduct = false;
				$existItemNum = 0;
				foreach ($items as $key => $item) {
					if ($product_id == $item['product_id']) { //���ﳵ�����е�ǰ��Ʒ
						$exist = true;
						$existItemNum = $item['buy_count'];
						if ($main_product_id == 0) {
							break;
						}
					}

					if ($item['main_product_id'] > 0) {
						if ($product_id == $item['main_product_id']) { //$product_id ��Ϊ������Ʒ�������䲻���Ѿ�������Ʒ
							$isMainProduct = true;
						}
						if ($main_product_id > 0 && $main_product_id == $item['product_id']) { //$product_id ��Ϊ����Ʒ�������䲻���Ѿ��Ǹ�����Ʒ
							$isMatchProduct = true;
						}
					}
				}
				if ($isMainProduct || $isMatchProduct) {
					$main_product_id = 0;
				}

				//�������ﳵ�������ƣ�ɾ�����ϵļ�¼
				$existItemCount = count($items);
				if (false === $exist && $existItemCount > self::MAX_SHOPPING_CART_ITEM) {
					self::removeCart($uid, array('product_id' => $items[$existItemCount - 1]['product_id']));
				}

				//�������� $numNeed ����
				$numNeed = min($num + $existItemNum, self::MAX_COUNT_PER_ITEM);
				$numNeed = self::checkProductNumLimit($numNeed, $product_id, $wh_id,$district_id);
				if (false === $numNeed) {
					return false;
				}

				// ��۴���
				// TODO �ⲿ�ֶ�۴��룬��Ҫ��ȡ��ȥ
				if (isset($productNew['price_id']) && $productNew['price_id'] > 0 /*price_id ��Ч*/
					&& isset($productNew['from_cart_nologin']) && $productNew['from_cart_nologin'] /*�ֶ���꣬ǿ�Ƽ���*/
				) {

					$price_id = $productNew['price_id']; //����Ǵӷǵ�¼̬���ﳵ��ת�룬���ټ��
				} else { //������������Ϣ��ȡһ����ͼ۸���û�
					$userLevel = -1;
					$isTrader = 0;
					$userInfo = IUsersTTC::get($uid, array(), array('type', 'level', 'retailerLevel'));
					if (isset($userInfo[0])) {
						$userLevel = $userInfo[0]['level'];
						$isTrader = $userInfo[0]['retailerLevel'];
					}

					$price_id = isset($productNew['price_id']) ? $productNew['price_id'] : 0;
					if ($price_id > 0) {
						$multiPrice = IMultiPrice::getListPrices(array(
							'product_id'     => $product_id,
							'wh_id'          => $wh_id,
							'uid'            => $uid,
							'level'          => $userLevel,
							'IsTrader'       => $isTrader,
							'price_id'       => $price_id,
							'multiPriceType' => $product['multiprice_type'],
						));

						$price_id = 0; //Ĭ��ȡԭ�ۣ���������͵ļ۸�
						$minPrice = $product['price'];
						if (isset($multiPrice['Prices'])) {
							foreach ($multiPrice['Prices'] as $pkey => $mp) {
								if (isset($mp['isSatisfy']) && $mp['isSatisfy'] == false) {
									continue;
								} else if (!$reqFromMobile && in_array($pkey, range(40, 42))) {
									continue; //�����ֻ�������ʹ��40��42
								}

								if ($mp['count_type'] == MP_COUNT_BY_DISCOUNT) { //�ۿ�
									$tmp = 10 * bcdiv($product['price'] * $mp['price'], 1000, 0);
									if ($tmp < $minPrice) {
										$minPrice = $tmp;
										$price_id = $pkey;
									}
								} else if ($mp['count_type'] == MP_COUNT_BY_PRICE) {
									if ($mp['price'] < $minPrice) {
										$minPrice = $mp['price'];
										$price_id = $pkey;
									}
								}
							}
						}
					}
				}

				//������� TTC
				$baseAry = array(
					'uid'       => $uid,
					'buy_count' => $numNeed,
					'wh_id'     => $wh_id,
					'price_id'  => $price_id,
					'type'      => IShoppingCart::ITEM_NORMAL,
				);
				if ($exist) { //����
					if ($main_product_id > 0) {
						$baseAry['main_product_id'] = $main_product_id;
					}
					if ($otag != '') {
						$baseAry['OTag'] = $otag;
					}

					$ret = self::updateCart($baseAry, array('product_id' => $product_id, 'type' => $type));
				} else { //����
					$baseAry['product_id'] = $product_id;
					$baseAry['main_product_id'] = $main_product_id;
					$baseAry['OTag'] = $otag;
					$ret = self::insertCart($baseAry);
				}
				if (false === $ret) {
					self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [update or insert ShoppingCartTTC failed]' . self::$errMsg;
					return false;
				}
				break;

			case IShoppingCart::ITEM_PACKAGE: //�ײ�
				$exist = false;

				$baseAry = array();
				foreach ($items as $key => $item) {
					if ($item['product_id'] == $product_id) { // ��Ʒ�Ѵ��ڣ��ۼӸ���
						$exist = true;

						$baseAry = $item;
						$baseAry['buy_count'] += $num;
						$baseAry['OTag'] = !empty($otag) ? $otag : $items[$key]['OTag'];
						break;
					}
				}

				if ($exist && !empty($baseAry)) { //����
					$ret = self::updateCart($baseAry, array('product_id' => $product_id, 'type' => $type));
				} else { //���� TTC
					$baseAry = array(
						'product_id' => $product_id,
						'uid'        => $uid,
						'buy_count'  => $num,
						'wh_id'      => $wh_id,
						'OTag'       => $otag,
						'type'       => IShoppingCart::ITEM_PACKAGE,
					);
					$ret = self::insertCart($baseAry);
				}
				if (false === $ret) {
					self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [update or insert ShoppingCartTTC failed]' . self::$errMsg;
					return false;
				}
				break;

			default:
				self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' �Ƿ���Ʒ����';
				return false;
		}

		return true;
	}

	/**
	 * �޸Ĺ��ﳵ����Ʒ������
	 * @param int $uid
	 * @param int $product_id
	 * @param int $num
	 * @param int $wh_id
	 * @return mixed false �޸�ʧ�ܣ�
	 */
	public static function setNum($uid, $product_id, $num = 1, $wh_id = 1, $type = IShoppingCart::ITEM_NORMAL, $district_id = 0)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}
		if (!isset($product_id) || $product_id <= 0) {
			self::$errCode = 100;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id) is invalid";
			return false;
		}
		if (!isset($num) || $num <= 0 || $num > 99) {
			self::$errCode = 105;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "num($num) is invalid";
			return false;
		}
		if (!isset($wh_id) || $wh_id < 0) {
			self::$errCode = 106;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "wh_id($wh_id) is invalid";
			return false;
		}


		if ($type == IShoppingCart::ITEM_NORMAL) {

			$numNeed = self::checkProductNumLimit($num, $product_id, $wh_id,$district_id);
			if (false === $numNeed)
				return false;
		} else if ($type == IShoppingCart::ITEM_PACKAGE) {
			$ret = self::checkSuitNumLimit($num, $product_id, $wh_id, $district_id);
			if (false === $ret)
				return false;
			$numNeed = $ret['numNeedMin'];
		} else {
			self::$errCode = 111;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "��Ʒ����{$type}����ȷ";
			return false;
		}

		$ret = self::updateCart(
			array(
				'uid'       => $uid,
				'buy_count' => $numNeed
			),
			array(
				'product_id' => $product_id,
				'type'       => $type
			)
		);

		if (false === $ret) {
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [update or updateCart failed]' . self::$errMsg;
			return false;
		}
		return true;
	}

	/*
	 �����Ϣ�����ȡ��Ѹ�ۣ�����Դ���
	 $multiPriceInfo = array(
		'price_id' => xxx, //$price_id�� ���빺�ﳵȡ��Ʒ����һ���۸�ԭ��Ϊ0�������۸�Ϊ1-64ȡֵ
		//�������У����Ϣ
		)
		*/
	/**
	 * ������ӵ�������Ʒ��/���ײ͡������ﳵ
	 * @param array $productNew
	 * @return mixed
	 */
	public static function addToShoppingCartNoLogin($productNew)
	{
		$productNew = self::checkParam($productNew, self::OFFLINE_CART);
		if (false === $productNew) {
			return false;
		}

		$product_id = $productNew['product_id']; //��Ʒ / �ײ� ID
		$wh_id = $productNew['wh_id'];
		$num = $productNew['buy_count'];
		$type = $productNew['type'];
		$district_id = isset($productNew['prid']) ? $productNew['prid'] : 0;

		switch ($type) {
			case IShoppingCart::ITEM_NORMAL:

				//��ȡ��Ʒ�ֲ���Ϣ
				$product = IProductInfoTTC::get($product_id, array('wh_id' => $wh_id));
				if (false === $product) {
					self::$errCode = IProductInfoTTC::$errCode;
					self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
					return false;
				}
				if (count($product) < 1) {
					self::$errCode = 107;
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '��Ʒ������';
					return false;
				}
				if ($product[0]['status'] != PRODUCT_STATUS_NORMAL) {
					self::$errCode = 110;
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '��Ʒ�ݲ�����';
					return false;
				}

				// �����������Ʒ�����ƻ��ͽ��ܲ�������ֱ�Ӽ��빺�ﳵ
				if (IProduct::isCanNotAddToNormalCart($product[0])) {
					return array();
				}

				//ixiuzeng��ӻ�ȡ�����Ʒ�Ŀ��
				$result = IProductInventory::setProductsInventoryInfo(array($product_id), $wh_id, $product, $district_id);
				if (false === $result) {
					self::$errCode = IProductInventory::$errCode;
					self::$errMsg = IProductInventory::$errMsg;
					return false;
				}

				$productInventoryInfo = $result['inventoryInfo'];
				$product = $result['productWhInfo'][0];

				$numNeed = min($num, self::MAX_COUNT_PER_ITEM);
				$numNeed = self::checkProductNumLimit($numNeed, $product_id, $wh_id,$district_id);
				if (false === $numNeed) {
					return false;
				}

				$price_id = isset($productNew['price_id']) ? $productNew['price_id'] : 0;
				$needToLogin = false;

				//������ȡ��۸���Ϣ�����Ƿ��л�Ա���Լ��Ƿ���������۸�У�����������л�Ա�ۣ��򷵻ش���ǰ����ʾ�û���¼
				$multiPrice = IMultiPrice::getListPrices(array(
					'product_id'     => $product_id,
					'wh_id'          => $wh_id,
					'uid'            => 0,
					'level'          => 0,
					'IsTrader'       => false,
					'price_id'       => $price_id,
					'multiPriceType' => $product['multiprice_type'],
				));

				if (isset($multiPrice['hasVip']) && $multiPrice['hasVip'] == true) {
					$needToLogin = true;
				}

				$mPrice = 0;
				if ($price_id > 0 && isset($multiPrice['Prices'][$price_id]) && $multiPrice['Prices'][$price_id]['isSatisfy'] == true) {
					$mPrice = $multiPrice['Prices'][$price_id]; //����Ч�ġ���۸񡱷��أ�����ǰ̨��ʾ
				} else {
					$price_id = 0;
				}

				return array(
					'product_id'    => $product_id,
					'num'           => $numNeed,
					'need_to_login' => $needToLogin,
					'price_id'      => $price_id,
					'price'         => $mPrice,
				);
			// IShoppingCart::ITEM_PRODUCT end

			case IShoppingCart::ITEM_PACKAGE:
				$ret = self::checkSuitNumLimit($num, $product_id, $wh_id, $district_id);
				if (false === $ret)
					return false;

				return $ret['suiteInfo'];
			// IShoppingCart::ITEM_PACKAGE end
			default:
				self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' �Ƿ���Ʒ����';
				return false;

		} //end of switch
	}

	/**
	 * չʾָ���û�id�Ĺ��ﳵ�е���Ϣ
	 * @param $uid
	 * @param $wh_id
	 * @param $reqFromWireless
	 * @return mixed �ɹ��Ƿ���array
	 * array(
	 *         discount_price //��۸���
	 *         discount_p_name //��۸�����
	 * )

	 */
	public static function view($uid, $wh_id, $reqFromWireless = false) {
		if (!isset($uid) || $uid <= 0) {
			self::setErr(101, basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid");
			return false;
		}

		$items = self::get($uid);
		if (false === $items) {
			self::setErr(IShoppingCartTTC::$errCode, basename(__FILE__, '.php') . " |" . __LINE__ . '[query IShoppingCartTTC failed]' . IShoppingCartTTC::$errMsg);
			return false;
		}

		return self::_view($login=true, $items, $wh_id, $reqFromWireless);
	}

	// չʾ���ﳵ�е���Ϣ��û�е�¼��
	//items: array('product_id', 'buy_count', 'main_product_id', 'price_id')
	public static function viewNoLogin($items, $wh_id=1, $reqFromWireless = false) {
		if (count($items) == 0) {
			return array();
		}

		return self::_view($login=false, $items, $wh_id, $reqFromWireless);
	}

	/**
	 * �ϲ�����ȡԭ�� view �� viewNoLogin ���ִ��롣
	 * @param bool $login ��¼״̬
	 * @param array $items �����
	 * @param int $wh_id ��վid
	 * @param bool $reqFromWireless �����ֻ���
	 * @return mixed array �����; false ʧ��
	 */
	private static function _view($login, &$items, $wh_id, $reqFromWireless = false) {
		if ($reqFromWireless) { //Ϊ�ֻ��˹��˵��ײ�
			$items = IShoppingCart::filterPackageItems($items);
			if (count($items) == 0) {
				return array();
			}
		}

		$productIds = array();
		$deleteProductIds = array();
		$multiPriceProduct = array(); //�����Ʒ
		foreach ($items as $key => &$item) {
			if ($item['product_id'] > 0) {
				$productIds[] = $item['product_id'];

				if (isset($item['price_id']) && $item['price_id'] > 0) { //�����ȡ��۸�
					$multiPriceProduct[$item['product_id']]['price_id'] = $item['price_id'];
					$multiPriceProduct[$item['product_id']]['multiPriceType'] = 0; //Ĭ�϶�û������۸�
				}
			} else {
				$deleteProductIds[] = $item['product_id'];
				unset($items[$key]);
			}
		}

		//��ȡ��Ʒ�ֲ���Ϣ
		$products = IProductCommonInfoTTC::gets(array_unique($productIds));
		if (false === $products) {
			self::$errCode = IProductCommonInfoTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IProductCommonInfoTTC failed]' . IProductCommonInfoTTC::$errMsg;
			return false;
		}
		if (count($products) == 0) {
			return array();
		}

		//�޳�û����Ʒ������Ϣ����Ʒ
		global $_ColorList, $_PROD_SIZE_2;
		foreach ($items as $key => &$item) {
			$exist = false;

			foreach ($products as &$product) {
				if ($item['product_id'] == $product['product_id']) {
					$exist = true;
					$productIds[] = $item['product_id'];

					$item['color'] = isset($_ColorList[$product['color']]) ? $_ColorList[$product['color']] : '';
					$item['pic_num'] = $product['pic_num'];
					$item['product_char_id'] = $product['product_char_id'];
					$item['size'] = isset($_PROD_SIZE_2[$product['size']]) ? $_PROD_SIZE_2[$product['size']] : '';
					$item['name'] = $product['name'];
					$item['weight'] = $product['weight'];

					break;
				}
			}

			if (false == $exist) {
				$deleteProductIds[] = $item['product_id'];
				unset($items[$key]);
			}
		}
		unset($products);
		$productIds = array_unique($productIds);

		//��ȡ��Ʒ�ֲּ۸�
		$productWhInfo = IProductInfoTTC::gets($productIds, array('wh_id' => $wh_id));
		if (false === $productWhInfo) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
			return false;
		}
		//��ȡ�����Ʒ�Ŀ��@ixiuzeng
		$result = IProductInventory::setProductsInventoryInfo($productIds, $wh_id, $productWhInfo);
		if (false === $result) {
			self::$errCode = IProductInventory::$errCode;
			self::$errMsg = IProductInventory::$errMsg;
			return false;
		}
		$productsInventoryInfo = $result['inventoryInfo'];
		$productWhInfo = $result['productWhInfo'];

		$productIds = array(); //reset

		global $_Wh_id;
		global $_StockStatus, $_StockToStation;
		global $_StockTips, $_StockToWhidTransitDays;
		//�޳��޼۸���Ϣ����Ʒ
		foreach ($items as $key => &$item) {
			$exist = false;

			foreach ($productWhInfo as &$pwinfo) {
				if ($pwinfo['product_id'] == $item['product_id']) {
					/*
					if ($reqFromWireless && $wh_id == 1 && $pwinfo['psystock'] != 1) { //��������ֻ֧��1�Ųֵ���Ʒ
						$deleteProductIds[] = $item['product_id'];
						unset($items[$key]);
						continue;
					}
					*/

					$exist = true;
					$productIds[] = $item['product_id'];

					self::extendProductStockStatus($wh_id, $item, $pwinfo); //������չ
					if (isset($multiPriceProduct[$item['product_id']])) {
						$multiPriceProduct[$item['product_id']]['multiPriceType'] = $pwinfo['multiprice_type'];
					}

					break;
				}
			} //end foreach

			if (false === $exist) {
				$deleteProductIds[] = $item['product_id'];
				unset($items[$key]);
			}
		}

		if (!empty($productIds)) {
			$productIds = array_unique($productIds);

			//��ȡ��Ʒ��Ϣ@ixiuzeng
			$gifts = IGiftNewTTC::gets($productIds, array('status' => GIFT_STATUS_OK));
			if (false === $gifts) {
				self::$errCode = IGiftNewTTC::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IGiftNewTTC failed]' . IGiftNewTTC::$errMsg;
				return false;
			}
			if (!empty($gifts)) {
				//�޳���������Ʒ����һ������ֲֵ���Ʒ
				$giftsValid = array();
				$gifts_ids = array();

				$products_psy = array();
				$products_gifts_type = array();
				foreach ($productWhInfo as &$pwinfo) {
					$products_psy[$pwinfo['product_id']] = $pwinfo['psystock'];

					foreach ($gifts as &$gi) {
						if (($pwinfo['product_id'] == $gi['product_id']) && ($_StockToStation[$pwinfo['psystock']] == $gi['stock_id'])) {
							$giftsValid[] = $gi;
							$gifts_ids[] = $gi['gift_id'];
							$products_gifts_type[$gi['product_id']][$gi['gift_id']][$gi['stock_id']] = $gi['type'];
						}
					}
				}
				unset($gifts);

				//������Ʒ
				if (!empty($gifts_ids)) {
					//�ֱ��޳���ÿ����Ʒ������û�п�����Ʒ
					$giftsInventorys = IInventoryStockTTC::gets(array_unique($gifts_ids), array('status' => 0));
					if (false === $giftsInventorys) {
						self::$errCode = IInventoryStockTTC::$errCode;
						self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IInventoryStockTTC failed]' . IInventoryStockTTC::$errMsg;
						return false;
					}

					$gifts_final_ids = array();
					$giftValidInventory = array();
					foreach ($giftsValid as $gv) {
						foreach ($giftsInventorys as $gsi) {
							if (($gv['gift_id'] == $gsi['product_id']) && ($products_psy[$gv['product_id']] == $gsi['stock_id'])
								&& (($gsi['num_available'] + $gsi['virtual_num'] > 0) || COMPONENT_TYPE == $products_gifts_type[$gv['product_id']][$gv['gift_id']][$gv['stock_id']]) ) {

								$giftValidInventory[] = $gv;
								$gifts_final_ids[] = $gv['gift_id'];
								break;
							}
						}
					}

					//��ȡ��Ʒ��Ʒ�Ļ�����Ϣ
					$gift_base_info = IProductCommonInfoTTC::gets(array_unique($gifts_final_ids), array(), array('name', 'product_char_id', 'weight', 'pic_num'));
					if (false === $gift_base_info) {
						self::$errCode = IProductCommonInfoTTC::$errCode;
						self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IProductCommonInfoTTC failed]' . IProductCommonInfoTTC::$errMsg;
						return false;
					}

					//�޳�������Ϣ�����ڵ���Ʒ
					$gift_ids_baseinfo = array();
					foreach ($giftValidInventory as $key => $gift) {
						$exist = false;
						foreach ($gift_base_info as $g_base) {
							if ($g_base['product_id'] == $gift['gift_id']) {
								$exist = true;
								$gift_ids_baseinfo[] = $gift['gift_id'];

								$giftValidInventory[$key]['name'] = $g_base['name'];
								$giftValidInventory[$key]['product_char_id'] = $g_base['product_char_id'];
								$giftValidInventory[$key]['weight'] = $g_base['weight'];
								$giftValidInventory[$key]['pic_num'] = $g_base['pic_num'];
								break;
							}
						}

						if (false === $exist) {
							unset($giftValidInventory[$key]);
							continue;
						}
					}

					//��ȡ��Ʒ���ڸ����ֲֵ�װ��,��Ʒ�����״̬�������ǳ���״̬
					$gift_wh_info = IProductInfoTTC::gets(array_unique($gifts_final_ids), array(), array('product_id', 'wh_id', 'status'));
					$gifts_status = array();
					if (false === $gift_wh_info) {
						self::$errCode = IProductInfoTTC::$errCode;
						self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
						return false;
					}
					foreach ($gift_wh_info as $gwi) {
						$gifts_status[$gwi['product_id']][$gwi['wh_id']] = $gwi['status'];
					}

					//����Ʒ�����Ӧ������Ʒ���а�
					foreach ($items as $key => &$item) {
						$items[$key]['gift'] = array();

						foreach ($giftValidInventory as $gift) {
							if (($gift['product_id'] == $item['product_id']) && ($_StockToStation[$gift['stock_id']] == $_StockToStation[$item['psystock']]) /* ��Ʒ������Ʒͬһ������ֲ� */
								&& ($gifts_status[$gift['gift_id']][$_StockToStation[$gift['stock_id']]] != PRODUCT_STATUS_NORMAL) /*��Ʒ�����״̬�������ǳ���״̬*/ ) {

								$items[$key]['gift'][$gift['gift_id']] = array(
									'name'            => $gift['name'],
									'product_id'      => $gift['gift_id'],
									'product_char_id' => $gift['product_char_id'],
									'type'            => $gift['type'],
									'weight'          => $gift['weight'],
									'pic_num'         => $gift['pic_num'],
									'num'             => $gift['gift_num'],
								);
							}
						}
					}
				}
			}

			//����������
			$easyMainProduct = array();
			foreach ($items as $key => &$item) {
				if ($item['main_product_id'] > 0) {
					$mainProductExist = false;

					foreach ($items as $ii) {
						if ($ii['product_id'] == $item['main_product_id']) {
							$mainProductExist = true;
							$items[$key]['matchNum'] = $ii['buy_count'] < $item['buy_count'] ? $ii['buy_count'] : $item['buy_count'];
							break;
						}
					}

					if ($mainProductExist) {
						$easyMainProduct[$item['main_product_id']] = $item['main_product_id'];
					} else {
						$item['main_product_id'] = 0;
					}
				}
			}

			if (!empty($easyMainProduct)) {
				//��ȡ������@ixiuzeng
				$wh_id_alter = (1001 == $wh_id) ? $wh_id : 1; //�㶫վ��������ӹ㶫վ��ȡ�������Ĵ��Ϻ�վ��ȡ
				$easyMatch = IProductRelativityTTC::gets($easyMainProduct, array('type' => PRODUCT_BY_MIND, 'status' => 1, 'wh_id' => $wh_id_alter));
				if (false === $easyMainProduct) {
					self::$errCode = IProductRelativityTTC::$errCode;
					self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IProductRelativityTTC failed]' . IProductRelativityTTC::$errMsg;
					return false;
				}

				if (count($easyMatch) > 0) {
					foreach ($items as $key => &$item) {
						if ($item['main_product_id'] > 0) {
							foreach ($easyMatch as $em) {
								if ($item['main_product_id'] == $em['product_id'] && $item['product_id'] == $em['relative_id'] && $em['type'] == PRODUCT_BY_MIND) {
									$cut = intval($em['property']);
									$items[$key]['match_cut'] = $cut > 0 ? $cut : 0;
									break;
								}
							}
						}
					}
				}
			}

			//��ȡ�����Ϣ
			if (count($multiPriceProduct) > 0) {
				$multiPriceInfo = IMultiPrice::getCartPrices(array(
						'wh_id' 		=> $wh_id,
						'product' 	=> $multiPriceProduct,
					)
				);

				if (false === $multiPriceInfo) {
					Logger::warn(__CLASS__ . '|' . __FUNCTION__ . ' IMultiPrice::getCartPrices FAILED');
				}
				else {
					if (isset($multiPriceInfo['Prices']) && is_array($multiPriceInfo['Prices'])) {
						foreach ($multiPriceInfo['Prices'] as $pid => $mp) {
							if ($mp['isSatisfy']) { //��������Ϣ
								foreach ($items as $key => &$item) {
									if ($item['product_id'] == $pid) {
										$item['discount_p_name'] = $mp['price_name'];

										if ($mp['count_type'] == MP_COUNT_BY_DISCOUNT) { //�ۿ�
											$item['discount_price'] = 10 * bcdiv($item['price'] * $mp['price'], 1000, 0) + $item['cash_back'];
										}
										else if ($mp['count_type'] == MP_COUNT_BY_PRICE) {
											$item['discount_price'] = $mp['price'] + $item['cash_back'];
										}
									}
								}
							}
						}
					}
				}
			}
		}

		if ($login) { //ɾ�����Ϸ��Ĺ��ﳵ��Ʒ
			if (!empty($deleteProductIds) && (!$reqFromWireless)) { //�ֻ������ɾ�����ﳵ
				$deleteProductIds = array_unique($deleteProductIds);
				Logger::info('REMOVE from shoppingcart ' . implode(',', $deleteProductIds));
				self::removeCart($uid, array_unique($deleteProductIds));
			}
		}

		// ��֤$items�����ֻ�����Ҫ
		sort($items);
		return $items;
	}

	// ����ӿڣ�����û����ﳵ
	public static function clear($uid, $wh_id = 1)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}

		$ret = self::removeCart($uid);
		if (false === $ret) {
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query removeCart failed]' . self::$errMsg;
			return false;
		}

		return true;
	}

	// ����ӿڣ�ɾ�����ﳵ������Ʒ��
	public static function remove($uid, $product_id, $wh_id = 1)
	{
		if (!isset($product_id) || $product_id <= 0) {
			self::$errCode = 100;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id) is invalid";
			return false;
		}
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}

		$item = self::removeCart($uid, array($product_id));
		if (false === $item) {
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query removeCart failed]' . self::$errMsg;
			return false;
		}

		return true;
	}

	// ����ӿڣ�ɾ�����ﳵ�еĶ����Ʒ
	public static function removeProducts($uid, $productIds)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}

		return self::removeCart($uid, $productIds);
	}

	public static function getCountAndPrice($uid, $wh_id = 1)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}

		$items = self::get($uid);
		if (false === $items) {
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query get failed]' . self::$errMsg;
			return false;
		}
		$totalItem = 0;
		foreach ($items as &$item) {
			$totalItem += $item['buy_count'];
		}
		return array('uid' => $uid, 'totalnum' => $totalItem);
	}

	//��ȡ���ﳵ��Ʒ��װ����
	public static function get($uid)
	{
		$items = IShoppingCartTTCNew::get($uid);
		if (false === $items) {
			self::setErr('IShoppingCartTTCNew');
			return false;
		}

		$result = isset($items[0]['info']) ? json_decode($items[0]['info'], true) : array();
		if (count($result) > 0) {
			foreach ($result as $k => &$ret) {
				$ret = self::extendKey($ret, $uid);
			}
		} else if (count($result) == 0) {
			/*
			$result = self::dataConvert($uid);
			if ($result == false) { // �������˵���ϵ�TTC���������⣬ֱ�ӷ��ؿ����ݣ����ñ���
				return array();
			}*/
			return array();
		}

		return $result;
	}

	/**
	 * ��鹺�ﳵ����
	 * @param array $param
	 * @param string $cart_type
	 * @return boolean
	 */
	public static function checkParam($param, $cart_type = self::ONLINE_CART)
	{
		if ($cart_type == self::ONLINE_CART && (!isset($param['uid']) || $param['uid'] <= 0)) { // �������ﳵ����uid
			self::setErr(101, basename(__FILE__, '.php') . " |" . __LINE__ . "uid({$param['uid']}) is invalid");
			return false;
		}
		if (!isset($param['product_id']) || $param['product_id'] <= 0) {
			self::setErr(100, basename(__FILE__, '.php') . " |" . __LINE__ . "product_id({$param['product_id']}) is invalid");
			return false;
		}

		// ����Ĭ��ֵ
		if (!isset($param['main_product_id']) || $param['main_product_id'] < 0) {
			$param['main_product_id'] = 0;
		}
		foreach (self::$default as $key => $val) {
			if (!isset($param[$key]) && isset(self::$default[$key])) {
				$param[$key] = self::$default[$key];
			}
		}
		return $param;
	}

	// ��Ҫ��֤json���ĳ��Ȳ��������ֵ����Ʒ����������Ҳ���ܳ������ֵ
	private function itemJsonEncode($data)
	{
		if (count($data) > self::MAX_SHOPPING_CART_ITEM) {
			self::$errCode = -1;
			self::$errMsg = basename(__FILE__) . " | " . __LINE__ . " [������Ʒ���೬�����ֵ]";
			return false;
		}

		foreach ($data as $key => $val) {
			// buy_count �� ������������
			if ($val['buy_count'] > self::MAX_COUNT_PER_ITEM) {
				self::$errCode = -1;
				self::$errMsg = basename(__FILE__) . " | " . __LINE__ . " [{$val['pid']} ������Ʒ�����������ֵ]";
				return false;
			}
			$data[$key] = self::shortenKey($val);
		}

		sort($data);
		$result_json = json_encode($data);
		if (strlen($result_json) > self::MAX_ITEM_LENGTH) {
			self::$errCode = -2;
			self::$errMsg = basename(__FILE__) . " | " . __LINE__ . " [������Ʒ���೬�����ֵ]";
			return false;
		}

		return $result_json;
	}

	// ���ݲ㣬���빺�ﳵ��װ������������ݵ�����Դ��
	private static function insertCart($arr)
	{
		// ��鴫�����
		$arr = self::checkParam($arr);
		if (false == $arr)
			return false;

		//��ʹ�÷�װ��get��������û����ﳵ��Ϣ
		$result = self::get($arr['uid']);
		if (false === $result) {
			self::$errCode = IShoppingCartTTCNew::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IShoppingCartTTCNew failed]' . IShoppingCartTTCNew::$errMsg;
			return false;
		}

		//���Ϊ��������һ����¼
		if (empty($result)) {
			// ���ݴ��޵��У��¼�һ��Ԫ�أ�����Ҫ0�±�
			$result[0] = $arr;
			$result_json = self::itemJsonEncode($result);
			if ($result_json === false)
				return false;

			$ret = IShoppingCartTTCNew::insert(array('uid' => $arr['uid'], 'info' => $result_json));
			if (false === $ret) {
				self::$errCode = IShoppingCartTTCNew::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IShoppingCartTTCNew failed]' . IShoppingCartTTCNew::$errMsg;
				return false;
			}
		} else {

			$result = array_merge($result, array($arr));
			$result_json = self::itemJsonEncode($result);
			if ($result_json === false)
				return false;

			$ret = IShoppingCartTTCNew::update(array('uid' => $arr['uid'], 'info' => $result_json));
			if (false === $ret) {
				self::$errCode = IShoppingCartTTCNew::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IShoppingCartTTCNew failed]' . IShoppingCartTTCNew::$errMsg;
				return false;
			}
		}
		return true;
	}

	// ���ݲ㣬ɾ�����ﳵ��Ʒ��װ������������Դ��ɾ������
	private static function removeCart($uid, $arr = array())
	{
		$result = array();
		if (!empty($arr)) {
			$result = self::get($uid); //�Ȼ���û����ﳵ��Ϣ
			if (false === $result) {
				self::$errCode = IShoppingCartTTCNew::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IShoppingCartTTCNew failed]' . IShoppingCartTTCNew::$errMsg;
				return false;
			}

			$pids = array_values($arr);
			foreach ($result as $k => $ret) {
				if (in_array($ret['product_id'], $pids)) {
					unset($result[$k]);
				}
			}
		}

		if (empty($result)) { //ֱ����չ��ﳵ
			$ret = IShoppingCartTTCNew::remove($uid);
			if (false === $ret) {
				self::$errCode = IShoppingCartTTCNew::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IShoppingCartTTCNew failed]' . IShoppingCartTTCNew::$errMsg;
				return false;
			}

			IShoppingCartTTC::remove($uid);
		} else { //���¹��ﳵ
			$result_json = self::itemJsonEncode($result);
			if ($result_json === false) {
				return false;
			}

			$ret = IShoppingCartTTCNew::update(array('uid' => $uid, 'info' => $result_json));
			if (false === $ret) {
				self::$errCode = IShoppingCartTTCNew::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IShoppingCartTTCNew failed]' . IShoppingCartTTCNew::$errMsg;
				return false;
			}
		}

		return true;
	}

	// ���ݲ㣬���¹��ﳵ��Ʒ��װ��������������Դ�е�����
	private static function updateCart($info = array(), $filter = array())
	{
		if (empty($info['uid'])) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid({$info['uid']}) is invalid";
			return false;
		}

		//��ʹ�÷�װ��get��������û����ﳵ��Ϣ
		$result = self::get($info['uid']);
		if (false === $result) {
			self::$errCode = IShoppingCartTTCNew::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IShoppingCartTTCNew failed]' . IShoppingCartTTCNew::$errMsg;
			return false;
		}

		//���Ϊ���򷵻�
		if (empty($result)) {
			self::$errCode = 111;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "IShoppingCartTTCNew update :no information for the uid to update";
			return false;
		}

		foreach ($result as $k => $ret) {
			$tm = array_merge($ret, $filter);
			if ($ret == $tm) {
				$result[$k] = array_merge($result[$k], $info);
			}
		}

		$result_json = self::itemJsonEncode($result);
		if ($result_json === false)
			return false;

		$ret = IShoppingCartTTCNew::update(array('uid' => $info['uid'], 'info' => $result_json));
		if (false === $ret) {
			self::$errCode = IShoppingCartTTCNew::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IShoppingCartTTCNew failed]' . IShoppingCartTTCNew::$errMsg;
			return false;
		}

		return true;
	}

	private static function shortenKey($item)
	{
		$result = array(
			'pid'  => $item['product_id'],
			'whid' => $item['wh_id'],
			'bc'   => $item['buy_count'],
			'prid' => $item['price_id'],
			'mpid' => $item['main_product_id'],
			'ot'   => $item['OTag'],
			'type' => $item['type']
		);

		if (isset($item['uid'])) {
			//$result['uid'] = $item['uid'];
			unset($result['uid']); // = $item['uid'];
		}

		return $result;
	}

	/**
	 * Enter description here ...
	 * @param array $item
	 * @param int $uid
	 * @return array
	 */
	private static function extendKey($item, $uid)
	{
		return array(
			'uid'                         => $uid,
			'product_id'                  => $item['pid'],
			'buy_count'                   => $item['bc'],
			'main_product_id'             => $item['mpid'],
			'type'                        => $item['type'],
			'wh_id'                       => $item['whid'],
			'price_id'                    => $item['prid'],
			'OTag'                        => $item['ot'],
		);
	}

	// �����Ʒ�޹�
	public static function checkProductNumLimit($num, $product_id, $wh_id,$district_id = 0)
	{
		//��ȡ��Ʒ�ֲ���Ϣ
		$product = IProductInfoTTC::get($product_id, array('wh_id' => $wh_id));
		if (false === $product) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
			return false;
		} else if (count($product) < 1) {
			self::$errCode = 107;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '��Ʒ������';
			return false;
		} else if ($product[0]['status'] != PRODUCT_STATUS_NORMAL) {
			self::$errCode = 110;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '��Ʒ�ݲ�����';
			return false;
		}

		//ixiuzeng��ӻ�ȡ�����Ʒ�Ŀ��
		$result = IProductInventory::setProductsInventoryInfo(array($product_id), $wh_id, $product,$district_id);
		if (false === $result) {
			self::$errCode = IProductInventory::$errCode;
			self::$errMsg = IProductInventory::$errMsg;
			return false;
		}

		//$productInventoryInfo = $result['inventoryInfo'];
		$product = $result['productWhInfo'][0];

		$numNeed = self::checkNumLimit($num, $product, $wh_id);
		if (false === $numNeed)
			return false;

		return $numNeed;
	}

	// ����ײ��޹�
	public static function checkSuitNumLimit($num, $pkgid, $wh_id, $district_id=0)
	{
		$suiteInfo = EA_Promotion::getPackageInfo($pkgid, $wh_id);
		$product_ids = $suiteInfo['pid_list'];

		$products = IProductInfoTTC::gets($product_ids, array('wh_id' => $wh_id));
		if (false === $products) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
			return false;
		}

		$result = IProductInventory::setProductsInventoryInfo($product_ids, $wh_id, $products,$district_id);
		if (false === $result) {
			self::$errCode = IProductInventory::$errCode;
			self::$errMsg = IProductInventory::$errMsg;
			return false;
		}

		$products = $result['productWhInfo'];


		// �ײ͵��޹�ֵ Ϊ �ײ������е���Ʒ�޹�ֵ����Сֵ
		$numNeedMin = IShoppingCart::MAX_COUNT_PER_ITEM;
		foreach ($products as $product) {
			$numNeed = self::checkNumLimit($num, $product, $wh_id);
			if (false === $numNeed)
				return false;

			$numNeedMin = min($numNeed, $numNeedMin);
		}

		return array(
			'numNeedMin' => $numNeedMin,
			'suiteInfo'  => $suiteInfo,
		);
	}

	public static function checkNumLimit($numNeed, $product, $wh_id)
	{
		//�����Ʒ�Ƿ��޹�
		if ($product['num_limit'] <= 0) { //���޹�
			$product['num_limit'] = self::MAX_COUNT_PER_ITEM;
		}

		if ($numNeed > $product['num_limit']) {
			self::$errCode = 109;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '�����޹�����';
			self::$buyNeedNum = $product['num_limit'];
			return false;
		}

		//�޹�����С�ڿ��
		if ($product['num_limit'] <= $product['num_available'] + $product['virtual_num']) {
			$numNeed = min($numNeed, $product['num_limit']);
		} else {
			//���С���޹�����
			if ($numNeed > $product['num_available'] + $product['virtual_num']) {
				if (($wh_id != SITE_SH) || ($product['flag'] & FORBID_SET_VIRTUAL) == FORBID_SET_VIRTUAL || $product['type'] != PRODUCT_TYPE_NORMAL) {
					self::$errCode = 109;
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '�����������';
					self::$buyNeedNum = $product['num_available'] + $product['virtual_num'];
					return false;
				}
			}
		}
		return $numNeed;
	}

	/**
	 * Enter description here ...
	 * @param unknown_type $uid
	 */
	private static function dataConvert($uid)
	{
		// ��������ת������û�в鵽�����ݵ�����£������ϵ�����Դ������У�����ϵ�����Դ��ȡ�����ݲ�ת��
		$result = IShoppingCartTTC::get($uid);
		if (false === $result) {
			self::$errCode = IShoppingCartTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IShoppingCartTTC failed]' . IShoppingCartTTC::$errMsg;
			Logger::info(self::$errMsg);
			return false;
		}

		if (!empty($result)) {
			foreach ($result as $key => $ret) {
				$result[$key] = self::checkParam($ret);
			}

			if ($result == false)
				return array();

			$result_json = self::itemJsonEncode($result);
			if ($result_json === false)
				return array();

			$ret = IShoppingCartTTCNew::insert(array('uid' => $uid, 'info' => $result_json));
			if (false === $ret) {
				self::$errCode = IShoppingCartTTCNew::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " | " . __LINE__ . ' [query IShoppingCartTTCNew failed]' . IShoppingCartTTCNew::$errMsg;
				return array();
			}

			IShoppingCartTTC::remove($uid);
		}

		return $result;
	}

	/**
	 * Ϊ�ֻ��˹��˵��ײ���Ʒ
	 * @param array $items
	 * @return null
	 */
	public static function filterPackageItems(&$items)
	{
		foreach ($items as $key => $item) {
			if ($item['type'] == IShoppingCart::ITEM_PACKAGE) {
				unset($items[$key]);
			}
		}
		sort($items);

		return $items;
	}

	/**
	 * ������Ʒ��Ϣ�������Ϣ��Ϊ��Ʒ��Ӽ���Ŀ�桢������Ϣ
	 * @param int $wh_id ��վid
	 * @param array $item ��Ʒ��Ϣ
	 * @param array $pwinfo ����վ��Ϣ
	 * @return null
	 */
	private static function extendProductStockStatus($wh_id, &$item, &$pwinfo)
	{
		$item['cash_back'] = $pwinfo['cash_back'];
		$item['market_price'] = $pwinfo['market_price'];
		$item['num_limit'] = $pwinfo['num_limit'];
		$item['point'] = $pwinfo['point'];
		$item['price'] = $pwinfo['price'] + $pwinfo['cash_back'];
		$item['psystock'] = $pwinfo['psystock'];
		$item['type'] = $pwinfo['type'];

		global $_StockTips, $_StockStatus, $_StockID_Name, $_StockToWhidTransitDays;

		if (($pwinfo['num_available'] + $pwinfo['virtual_num'] >= $item['buy_count']) //�����������㹻
			|| (($wh_id == 1) && ($pwinfo['flag'] & FORBID_SET_VIRTUAL) != FORBID_SET_VIRTUAL && $pwinfo['type'] == PRODUCT_TYPE_NORMAL) /*�Ϻ�����ͨ��Ʒδ��ֹ������*/
		) {

			if ($pwinfo['num_available'] >= $item['buy_count']) { //ʵ�ʿ���㹻
				if (!isset($_StockToWhidTransitDays[$pwinfo['psystock']][$wh_id]) || $_StockToWhidTransitDays[$pwinfo['psystock']][$wh_id] == 0) {
					$item['array_days'] = $_StockTips['available'];
					$item['stock_desc'] = $_StockTips['available'];
					$item['stock_status'] = $_StockStatus['available'];
				} else {
					$item['array_days'] = "�л�����{$_StockID_Name[$pwinfo['psystock']]}������{$_StockToWhidTransitDays[$pwinfo['psystock']][$wh_id]}�������";
					$item['stock_desc'] = "�л�����{$_StockID_Name[$pwinfo['psystock']]}������{$_StockToWhidTransitDays[$pwinfo['psystock']][$wh_id]}�������";
					$item['stock_status'] = $_StockStatus['available'];
				}
			} else if ($pwinfo['arrival_days'] == VIRTUAL_STOCK_ARRAY_1_3DAYS) {
				$item['array_days'] = $_StockTips['arrival1-3'];
				$item['stock_desc'] = $_StockTips['arrival1-3'];
				$item['stock_status'] = $_StockStatus['arrival1-3'];
			} else {
				$item['array_days'] = $_StockTips['arrival2-7'];
				$item['stock_desc'] = $_StockTips['arrival2-7'];
				$item['stock_status'] = $_StockStatus['arrival2-7'];
			}
		} else {
			$item['array_days'] = $_StockTips['not_available'];
			$item['stock_desc'] = $_StockTips['not_available'];
			$item['stock_status'] = $_StockStatus['not_available'];
		}
	}
}