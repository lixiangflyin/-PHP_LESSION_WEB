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

class IBShoppingCart {

	public static $errCode = 0;
	public static $errMsg = '';

	//�ͻ��л�վ�㣬��Ҫ�����ﳵ�У����·�վ�����۵���Ʒ
	//$productIdArr = array(pid1,pid2,pid3)
	public static function removeProducts($uid, $productIds) {
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}

		foreach ($productIds as $pid) {
			$item = IBShoppingCartTTC::remove($uid, array('product_id'=>$pid));
			if (false === $item) {
				continue;
			}
		}
		return true;
	}

	/**
	 * �����Ʒ�����ﳵ��
	 * @param int $uid �û�ID
	 * @param int $product_id ��ƷID
	 * @param int $num ��Ʒ����
	 * @param int $wh_id ��վID
	 * @param int $main_product_id ����������ƷID������Լ۸����Ӱ�죩
	 * @param array $multiPriceInfo ��۸���������ȡ��Ѹ�ۣ�����Դ���
	 * 		$multiPriceInfo = array(
	 * 			'from_cart_nologin' => true, //�����Ƿ��ǰѷǵ�¼̬���ﳵת�Ƶ���¼̬���ﳵ������ǣ�����У���۸��Ƿ�����У��㣨��Ϊ����ǵ�¼̬���ﳵ�Ѿ������ˣ�
	 * 			'price_id' => xxx, //$price_id�� ���빺�ﳵȡ��Ʒ����һ���۸�ԭ��Ϊ0�������۸�Ϊ1-64ȡֵ
	 * 			//�������У����Ϣ
	 *	    $otag : ����·��������
	 * 		)
	*/
	public static function add($uid, $product_id, $num=1, $wh_id=1, $main_product_id=0, $price_id, $otag = '') {
		
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

		//��ȡ��Ʒ�ֲ���Ϣ
		$product = IProductInfoTTC::get($product_id, array('wh_id'=>$wh_id));
		if (false === $product) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
			return false;
		}

		if (count($product) < 1) {
			self::$errCode = 107;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '��Ʒ��Ϣ������';
			return false;
		}
		if ($product[0]['status'] != PRODUCT_STATUS_NORMAL) {
			self::$errCode = 110;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '��Ʒ�ݲ�����';
			return false;
		}
		$product = $product[0];

		//ixiuzeng��ӻ�ȡ��Ʒ�Ŀ��
		$productInventoryInfo = IProductInventory::getProductInventeory($product_id, $wh_id);
		if(false === $productInventoryInfo)
		{
			self::$errCode = IProductInventory::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[getProductInventeory failed]' . IProductInventory::$errMsg;
			Logger::err("errCode(" . self::$errCode . ")" . self::$errMsg);

			$product['virtual_num'] = 0;
			$product['num_available'] = 0;
			$product['psystock'] = -1;

		}
		else
		{
			$product['virtual_num'] = $productInventoryInfo['virtual_num'];
			$product['num_available'] = $productInventoryInfo['num_available'];
			$product['psystock'] = $productInventoryInfo['supply_stock_id'];
		}


		// �����������Ʒ�����ƻ��ͽ��ܲ�������ֱ�Ӽ��빺�ﳵ
		if ( IProduct::isCanNotAddToNormalCart($product) ) {
			return array();
		}

		//��ȡ���ﳵ��������Ϣ
		$items = IBShoppingCartTTC::get($uid, array(), array('product_id', 'buy_count', 'main_product_id'));
		if (false === $items) {
			self::$errCode = IBShoppingCartTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IBShoppingCartTTC failed]' . IBShoppingCartTTC::$errMsg;
			return false;
		}

		$exist = false;
		$isMainProduct = false;
		$isMatchProduct = false;

		foreach ($items as $key => $item) {
			if ($item['product_id'] == $product_id) {
				$exist = true;
				$existItemNum = $item['buy_count'];
				if ($main_product_id == 0) {
					break;
				}
			}

			if ($product_id == $item['main_product_id'] ) { //$product_id ��Ϊ������Ʒ�������䲻���Ѿ�������Ʒ
				$isMainProduct = true;
			}
			if ($main_product_id > 0 && $main_product_id == $item['product_id'] && $item['main_product_id'] > 0) {//$product_id ��Ϊ����Ʒ�������䲻���Ѿ��Ǹ�����Ʒ
				$isMatchProduct = true;
			}
		}
		if ($isMainProduct || $isMatchProduct) {
			$main_product_id = 0;
		}
		$existItemCount = count($items);
		//�������ﳵ�������ƣ�ɾ�����ϵļ�¼
		if (false === $exist && $existItemCount > MAX_SHOPPING_CART_ITEM) {
			IBShoppingCartTTC::remove($uid, array('product_id'=> $items[$existItemCount-1]['product_id']));
		}
		unset($items);

		//������������Ϣ��ȡһ����ͼ۸���û�
//		if (isset($multiPriceInfo['from_cart_nologin']) && $multiPriceInfo['from_cart_nologin'] && isset($multiPriceInfo['price_id']) && $multiPriceInfo['price_id'] > 0) {
//			$price_id = $multiPriceInfo['price_id']; //����Ǵӷǵ�¼̬���ﳵ��ת�룬���ټ��
//		}
//		else {
//			$userLevel = -1;
//			$isTrader = 0;
//			$userInfo = IUsersTTC::get($uid, array(), array('type', 'level','retailerLevel'));
//			if (isset($userInfo[0])) {
//				$userLevel = $userInfo[0]['level'];
//				$isTrader = $userInfo[0]['retailerLevel'];
//			}
//
//			$price_id = isset($multiPriceInfo['price_id']) ? $multiPriceInfo['price_id'] : 0;
//			$multiPrice = IMultiPrice::getListPrices(array(
//									'product_id'=>$product_id,
//									'wh_id'=>$wh_id,
//									'uid'=>$uid,
//									'level'=>$userLevel,
//									'IsTrader'=>$isTrader,
//									'price_id'=>$price_id,
//									'multiPriceType'=>$product['multiprice_type'],
//								));
//
//			$price_id = 0; //Ĭ��ȡԭ�ۣ���������͵ļ۸�
//			$minPrice = $product['price'];
//			if (isset($multiPrice['Prices'])) {
//				foreach ($multiPrice['Prices'] as $pkey=>$mp) {
//					if (isset($mp['isSatisfy']) && $mp['isSatisfy'] == false) {
//						continue;
//					}
//
//					if ($mp['count_type'] == MP_COUNT_BY_DISCOUNT) { //�ۿ�
//						 $tmp = 10 * bcdiv($product['price'] * $mp['price'], 1000, 0);
//						 if ($tmp < $minPrice) {
//						 	$minPrice = $tmp;
//						 	$price_id = $pkey;
//						 }
//					}
//					else if ($mp['count_type'] == MP_COUNT_BY_PRICE) {
//						if ($mp['price'] < $minPrice) {
//							$minPrice = $mp['price'];
//							$price_id = $pkey;
//						}
//					}
//				}
//			}
//		}

		$numNeed = $num;
		if (true === $exist) {
			$numNeed = $num + $existItemNum;
		}
		if ($numNeed > MAX_COUNT_PER_ITEM) {
			$numNeed =  MAX_COUNT_PER_ITEM;
		}

		//�����Ʒ�Ƿ��޹�
		if ($product['num_limit'] <= 0) { //���޹�
			$product['num_limit'] = 999;
		}

		//�޹�����С�ڿ��
//		if ($product['num_limit'] <= $product['num_available'] + $product['virtual_num']) {
//			if ($numNeed > $product['num_limit']) {
//				self::$errCode = 108;
//				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '�����޹�������';
//				$numNeed =  $product['num_limit'];
//			}
//
//			if ($exist) {
//				if ($main_product_id > 0) {
//					if ($otag != '') {
//						$ret = IBShoppingCartTTC::update(array('uid'=>$uid, 'buy_count'=>$numNeed, 'wh_id' => 0, 'main_product_id'=> $main_product_id, 'price_id'=>$price_id, 'OTag'=>$otag), array('product_id'=>$product_id));
//					}else
//					{
//						$ret = IBShoppingCartTTC::update(array('uid'=>$uid, 'buy_count'=>$numNeed, 'wh_id' => 0, 'main_product_id'=> $main_product_id, 'price_id'=>$price_id ), array('product_id'=>$product_id));
//					}
//				}
//				else {
//					if ($otag != '') {
//						$ret = IBShoppingCartTTC::update(array('uid'=>$uid, 'buy_count'=>$numNeed, 'wh_id' => 0,  'price_id'=>$price_id, 'OTag'=>$otag), array('product_id'=>$product_id));
//					}else
//					{
//						$ret = IBShoppingCartTTC::update(array('uid'=>$uid, 'buy_count'=>$numNeed, 'wh_id' => 0, 'price_id'=>$price_id), array('product_id'=>$product_id));
//					}
//				}
//			}
//			else {
//				$param = array('uid'=>$uid, 'buy_count'=>$numNeed,'product_id'=>$product_id,  'main_product_id'=> $main_product_id, 'wh_id'=>0, 'price_id'=>$price_id, 'OTag'=>$otag);
//				$ret = IBShoppingCartTTC::insert($param);
//				
//			}
//
//			if (false === $ret) {
//				self::$errCode = IBShoppingCartTTC::$errCode;
//				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[update or insert IBShoppingCartTTC failed]' . IBShoppingCartTTC::$errMsg;
//				return false;
//			}
//
//			return true;
//		}
//		else { //���С���޹�����
			if ($numNeed > $product['num_available'] + $product['virtual_num']) {
				if ((( $wh_id != 1) || (($product['flag'] & FORBID_SET_VIRTUAL) == FORBID_SET_VIRTUAL) || ($product['type'] != PRODUCT_TYPE_NORMAL))
					/*$product['type'] != PRODUCT_TYPE_NORMAL || $product['price'] <= $product['cost_price'] */) {
					self::$errCode = 109;
					self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '�����������';
//					$numNeed =  $product['num_available'] + $product['virtual_num'];
//					if ($numNeed <= 0) {
//						return false;
//					}
					return false;
				}
			}

			$main_product_id = ($main_product_id > 0? $main_product_id : 0);

			if ($exist) {
				if ($main_product_id > 0) {
					if ($otag != '') {
						$ret = IBShoppingCartTTC::update(array('uid'=>$uid, 'buy_count'=>$numNeed, 'wh_id' => 0, 'main_product_id'=> $main_product_id, 'price_id'=>$price_id, 'OTag'=>$otag), array('product_id'=>$product_id));
					}else
					{
						$ret = IBShoppingCartTTC::update(array('uid'=>$uid, 'buy_count'=>$numNeed, 'wh_id' => 0, 'main_product_id'=> $main_product_id, 'price_id'=>$price_id ), array('product_id'=>$product_id));
					}
				}
				else {
					if ($otag != '') {
						$ret = IBShoppingCartTTC::update(array('uid'=>$uid, 'buy_count'=>$numNeed, 'wh_id' => 0,  'price_id'=>$price_id, 'OTag'=>$otag), array('product_id'=>$product_id));
					}else
					{
						$ret = IBShoppingCartTTC::update(array('uid'=>$uid, 'buy_count'=>$numNeed, 'wh_id' => 0, 'price_id'=>$price_id), array('product_id'=>$product_id));
					}
				}
			}
			else {
				$param = array('uid'=>$uid, 'buy_count'=>$numNeed,'product_id'=>$product_id,  'main_product_id'=> $main_product_id, 'wh_id'=>0, 'price_id'=>$price_id, 'OTag'=>$otag);
				$ret = IBShoppingCartTTC::insert($param);
			
			}

			if (false === $ret) {
				self::$errCode = IBShoppingCartTTC::$errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[update or insert IBShoppingCartTTC failed]' . IBShoppingCartTTC::$errMsg;
				return false;
			}

			return true;
//		}
	}

	public static function setNum($uid, $product_id, $num=1, $wh_id=1)
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


		//��ȡ��Ʒ�ֲ���Ϣ
		$product = IProductInfoTTC::get($product_id, array('wh_id'=>$wh_id));
		if (false === $product) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
			return false;
		}

		if (count($product) < 1) {
			self::$errCode = 107;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '��Ʒ������';
			return false;
		}
		if ($product[0]['status'] != PRODUCT_STATUS_NORMAL) {
			self::$errCode = 110;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '��Ʒ�ݲ�����';
			return false;
		}

		$product = $product[0];

		//ixiuzeng��ӻ�ȡ��Ʒ�Ŀ��
		$productInventoryInfo = IProductInventory::getProductInventeory($product_id, $wh_id);
		if(false === $productInventoryInfo)
		{
			self::$errCode = IProductInventory::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[getProductInventeory failed]' . IProductInventory::$errMsg;
			Logger::err("errCode(" . self::$errCode . ")" . self::$errMsg);

			$product['virtual_num'] = 0;
			$product['num_available'] = 0;
			$product['psystock'] = -1;

		}
		else
		{
			$product['virtual_num'] = $productInventoryInfo['virtual_num'];
			$product['num_available'] = $productInventoryInfo['num_available'];
			$product['psystock'] = $productInventoryInfo['supply_stock_id'];
		}


		//�����Ʒ�Ƿ��޹�
		if ($product['num_limit'] <= 0) { //���޹�
			$product['num_limit'] = 999;
		}

		$numNeed = $num;
		if ($numNeed > MAX_COUNT_PER_ITEM) {
			$numNeed =  MAX_COUNT_PER_ITEM;
		}

//		//�޹�����С�ڿ��
//		if ($product['num_limit'] <= $product['num_available'] + $product['virtual_num']) {
//			if ($numNeed > $product['num_limit']) {
//				self::$errCode = 108;
//				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '�����޹�����';
//				$numNeed =  $product['num_limit'];
//			}
//
//			$ret = IBShoppingCartTTC::update(array('uid'=>$uid, 'buy_count'=>$numNeed), array('product_id'=>$product_id));
//			if (false === $ret) {
//				self::$errCode = IBShoppingCartTTC::$errCode;
//				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[update or insert IBShoppingCartTTC failed]' . IBShoppingCartTTC::$errMsg;
//				return false;
//			}
//			return true;
//		}
//		else { //���С���޹�����
			if ($numNeed > $product['num_available'] + $product['virtual_num']) {
				if ((( $wh_id != 1) || ($product['flag'] & FORBID_SET_VIRTUAL) == FORBID_SET_VIRTUAL || $product['type'] != PRODUCT_TYPE_NORMAL)
					/*$product['type'] != PRODUCT_TYPE_NORMAL || $product['price'] <= $product['cost_price']*/) {
					self::$errCode = 109;
					self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '�������������';
					return false;
				}
			}

			$ret = IBShoppingCartTTC::update(array('uid'=>$uid, 'buy_count'=>$numNeed), array('product_id'=>$product_id));
			if (false === $ret) {
				self::$errCode = IBShoppingCartTTC::$errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[update or insert IBShoppingCartTTC failed]' . IBShoppingCartTTC::$errMsg;
				return false;
			}

			return true;
//		}
	}

	/*
	�����Ϣ�����ȡ��Ѹ�ۣ�����Դ���
	$multiPriceInfo = array(
		'price_id' => xxx, //$price_id�� ���빺�ﳵȡ��Ʒ����һ���۸�ԭ��Ϊ0�������۸�Ϊ1-64ȡֵ
		//�������У����Ϣ
	)
	*/
	public static function addToShoppingCartNoLogin($product_id, $num=1, $wh_id=1, $multiPriceInfo = array()) {
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
		if (!isset($wh_id) || $wh_id <= 0) {
			self::$errCode = 106;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "wh_id($wh_id) is invalid";
			return false;
		}

		//��ȡ��Ʒ�ֲ���Ϣ
		$product = IProductInfoTTC::get($product_id, array('wh_id'=>$wh_id));
		if (false === $product) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
			return false;
		}
		if (count($product) < 1) {
			self::$errCode = 107;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '��Ʒ������';
			return false;
		}
		if ($product[0]['status'] != PRODUCT_STATUS_NORMAL) {
			self::$errCode = 110;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '��Ʒ�ݲ�����';
			return false;
		}

		$product = $product[0];

		// �����������Ʒ�����ƻ��ͽ��ܲ�������ֱ�Ӽ��빺�ﳵ
		if ( IProduct::isCanNotAddToNormalCart($product) ) {
			return array();
		}

		//ixiuzeng��ӻ�ȡ��Ʒ�Ŀ��
		$productInventoryInfo = IProductInventory::getProductInventeory($product_id, $wh_id);
		if (false === $productInventoryInfo) {
			$msg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[getProductInventeory failed]' . IProductInventory::$errMsg;
			Logger::err("errCode(" . IProductInventory::$errCode . ")" . $msg);

			$product['virtual_num'] = 0;
			$product['num_available'] = 0;
			$product['psystock'] = -1;
		}
		else {
			$product['virtual_num'] = $productInventoryInfo['virtual_num'];
			$product['num_available'] = $productInventoryInfo['num_available'];
			$product['psystock'] = $productInventoryInfo['supply_stock_id'];
		}

		//�����Ʒ�Ƿ��޹�
		if ($product['num_limit'] <= 0) { //���޹�
			$product['num_limit'] = 999;
		}

		$numNeed = $num;
		if ($numNeed > MAX_COUNT_PER_ITEM) {
			$numNeed =  MAX_COUNT_PER_ITEM;
		}

		if ($product['num_limit'] <= $product['num_available'] + $product['virtual_num']) { //�޹�����С�ڿ��
			if ($numNeed > $product['num_limit']) {
				$numNeed = $product['num_limit'];
			}
		}
		else { //���С���޹�����
			if ($numNeed > $product['num_available'] + $product['virtual_num']) {
				if ((( $wh_id != 1) || ($product['flag'] & FORBID_SET_VIRTUAL) == FORBID_SET_VIRTUAL || $product['type'] != PRODUCT_TYPE_NORMAL)) {
					$numNeed =  $product['num_available'] + $product['virtual_num'];
					if ($numNeed <= 0) {
						self::$errCode = 109;
						self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '��治�㣬Ϊ����';
						return false;
					}
				}
			}
		}

		$price_id = isset($multiPriceInfo['price_id']) ? $multiPriceInfo['price_id'] : 0;
		$needToLogin = false;

		//������ȡ��۸���Ϣ�����Ƿ��л�Ա���Լ��Ƿ���������۸�У�����������л�Ա�ۣ��򷵻ش���ǰ����ʾ�û���¼
		$multiPrice = IMultiPrice::getListPrices(array(
																		'product_id'=>$product_id,
																		'wh_id'=>$wh_id,
																		'uid'=>0,
																		'level'=>0,
																		'IsTrader'=>false,
																		'price_id'=>$price_id,
																		'multiPriceType'=>$product['multiprice_type'],
																	));
		if (isset($multiPrice['hasVip']) && $multiPrice['hasVip'] == true) {
			$needToLogin = true;
		}

		$mPrice = null;
		if ($price_id > 0 && isset($multiPrice['Prices'][$price_id]) && $multiPrice['Prices'][$price_id]['isSatisfy'] == true) {
			$mPrice = $multiPrice['Prices'][$price_id]; //����Ч�ġ���۸񡱷��أ�����ǰ̨��ʾ
		}
		else {
			$price_id = 0;
		}

		return array (
			'product_id'		=> $product_id,
			'num'				=> $numNeed,
			'need_to_login'	=> $needToLogin,
			'price_id'			=> $price_id,
			'price' 				=> $mPrice,
		);
	}

	/**
	 * չʾָ���û�id�Ĺ��ﳵ�е���Ϣ
	 * @param $uid
	 * @param $wh_id
	 * @param $reqFromWireless
	 * @return mixed �ɹ��Ƿ���array
	 * array(
	 * 		discount_price //��۸���
	 * 		discount_p_name //��۸�����
	 * )
	 *
	 */
	public static function view($uid , $wh_id, $reqFromWireless = false) {
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}

		$items = IBShoppingCartTTC::get($uid, array(), array('product_id', 'buy_count', 'main_product_id', 'price_id'));
		if (false === $items) {
			self::$errCode = IBShoppingCartTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IBShoppingCartTTC failed]' . IBShoppingCartTTC::$errMsg;
			return false;
		}
		if (count($items) == 0) {
			return  array();
		}

		$deleteProductIds = array();
		$productIds = array();
		//$multiPriceProduct = array();
		foreach ($items as $key => $item) {
			if ($item['product_id'] > 0) {
				$productIds[] = $item['product_id'];
				if ($item['price_id'] > 0) { //�����ȡ����۸�
				//	$multiPriceProduct[$item['product_id']]['price_id'] = $item['price_id'];
				//	$multiPriceProduct[$item['product_id']]['multiPriceType'] = 0; //Ĭ�϶�û������۸�
				}
			}
			else {
				$deleteProductIds[] = $item['product_id'];
				unset($items[$key]);
			}
		}
        $dprice = IBProduct::getProductDistributionPrice($uid, $productIds);
        if (false === $dprice)
        {
        	self::$errCode = IBProduct::$errCode;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[invoke IBProduct::getProductDistributionPrice() failed]' . IBProduct::$errMsg;
            return false;
        }
      
		//��ȡ��Ʒ�ֲ���Ϣ
		$products = IProductCommonInfoTTC::gets($productIds);
		if (false === $products) {
			self::$errCode = IProductCommonInfoTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductCommonInfoTTC failed]' . IProductCommonInfoTTC::$errMsg;
			return false;
		}
		if (count($products) == 0) {
			return  array();
		}

		//�޳�û����Ʒ������Ϣ����Ʒ
		$productIds = array();

		global $_ColorList, $_PROD_SIZE_2;
		foreach ($items as $key => $item) {
			$exist = false;
			foreach ($products as $product) {
				if ( $item['product_id'] == $product['product_id']) {
					$items[$key]['name'] = $product['name'];
					$items[$key]['size'] = isset($_PROD_SIZE_2[$product["size"]])? $_PROD_SIZE_2[$product["size"]] : "";
					$items[$key]['color'] = isset($_ColorList[$product["color"]]) ? $_ColorList[$product["color"]] : "";
					$items[$key]['product_char_id'] = $product['product_char_id'];
					$items[$key]['pic_num'] = $product['pic_num'];
					$items[$key]['weight'] = $product['weight'];
					
					$productIds[] = $item['product_id'];
					$exist = true;
					break;
				}
			}
			if (false == $exist) {
				unset($items[$key]);
				$deleteProductIds[] = $item['product_id'];
			}
		}
		unset($products);

		//��ȡ��Ʒ�ֲּ۸�
		$productWhInfo = IProductInfoTTC::gets($productIds, array('wh_id'=>$wh_id));
		if (false === $productWhInfo) {
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
			return false;
		}

		//ixiuzeng��ӻ�ȡ�����Ʒ�Ŀ��
		$productsInventoryInfo = IProductInventory::getProductsInventeory($productIds, $wh_id);
		if (false === $productsInventoryInfo)
		{
			self::$errCode = IProductInventory::$errCode;
			self::$errMsg = IProductInventory::$errMsg;
			Logger::err("errCode(" . self::$errCode . ")" . self::$errMsg);

			foreach ($productWhInfo as $key => $wi)
			{
				$productWhInfo[$key]['virtual_num'] = 0;
				$productWhInfo[$key]['num_available'] = 0;
				$productWhInfo[$key]['psystock'] = -1;
			}
		}
		else
		{
			foreach ($productWhInfo as $key => $wi)
			{
				foreach ($productsInventoryInfo as $psii)
				{
					if ($psii['product_id'] == $wi['product_id'])
					{
						$productWhInfo[$key]['virtual_num'] = $psii['virtual_num'];
						$productWhInfo[$key]['num_available'] = $psii['num_available'];
						$productWhInfo[$key]['psystock'] = $psii['supply_stock_id'];
						break;
					}
				}
			}
		}

		$productIds = array();
		global  $_StockTips;
		//�޳��޼۸���Ϣ����Ʒ
		global $_StockToWhidTransitDays;
		global $_Wh_id;
		global $_StockToStation;
		foreach ($items as $key => $item) {
			$exist = false;
			foreach ($productWhInfo as $pwinfo) {
				if ($pwinfo['product_id'] == $item['product_id']) {

					if ($wh_id == 1 && $reqFromWireless == true && $pwinfo['psystock'] != 1) { //��������ֻ֧��1�Ųֵ���Ʒ
						unset($items[$key]);
						IBShoppingCartTTC::remove($uid, array('product_id'=>$item['product_id']));
						continue;
					}

					$items[$key]['market_price'] = $pwinfo['market_price'];
					$items[$key]['price'] = $dprice[$item['product_id']];
					//$items[$key]['price'] = $pwinfo['price'] + $pwinfo['cash_back'];
					$items[$key]['cash_back'] = $pwinfo['cash_back'];
					$items[$key]['point'] = $pwinfo['point'];
					$items[$key]['num_limit'] = $pwinfo['num_limit'];
					$items[$key]['type'] = $pwinfo['type'];
					$items[$key]['psystock'] = $pwinfo['psystock'];

//					if (isset($multiPriceProduct[$item['product_id']])) {
//						$multiPriceProduct[$item['product_id']]['multiPriceType'] = $pwinfo['multiprice_type'];
//					}

					if (($pwinfo['num_available'] + $pwinfo['virtual_num'] >=  $item['buy_count'])
						|| (( $wh_id == 1) && ($pwinfo['flag'] & FORBID_SET_VIRTUAL) != FORBID_SET_VIRTUAL && $pwinfo['type'] == PRODUCT_TYPE_NORMAL)
							  /* ($items[$key]['type'] == PRODUCT_TYPE_NORMAL && $pwinfo['price'] > $pwinfo['cost_price'])*/) {
						if ($pwinfo['num_available'] >= $item['buy_count']) { //ʵ�ʿ���㹻
							if(!isset($_StockToWhidTransitDays[$pwinfo['psystock']][$wh_id]) || $_StockToWhidTransitDays[$pwinfo['psystock']][$wh_id] == 0)
							{
								$items[$key]['array_days'] = $_StockTips['available'];
							}else
							{
								$items[$key]['array_days'] = "�л�����{$_Wh_id[$_StockToStation[$pwinfo['psystock']]]}�ֵ�����{$_StockToWhidTransitDays[$pwinfo['psystock']][$wh_id]}�������";
							}
						}
						else if ($pwinfo['arrival_days'] == VIRTUAL_STOCK_ARRAY_1_3DAYS) {
							$items[$key]['array_days'] = $_StockTips['arrival1-3'];
						}
						else {
							$items[$key]['array_days'] = $_StockTips['arrival2-7'];
						}
					}
					else {
						$items[$key]['array_days'] = $_StockTips['not_available'];
					}

					$productIds[] = $item['product_id'];
					$exist = true;
					break;
				}
			}

			if (false === $exist) {
				$deleteProductIds[] = $item['product_id'];
				unset($items[$key]);
			}
		}

//		//��ȡ�����Ϣ
//		if (count($multiPriceProduct) > 0) {
//			$multiPriceInfo = IMultiPrice::getCartPrices(array('wh_id'=>$wh_id, 'product'=>$multiPriceProduct));
//			if (isset($multiPriceInfo['Prices']) && is_array($multiPriceInfo['Prices'])) {
//				foreach ($multiPriceInfo['Prices'] as $pid => $mp) {
//					if ($mp['isSatisfy'] == true) { //��������Ϣ
//						foreach ($items as $key=>$item) {
//							if ($item['product_id'] == $pid) {
//								if ($mp['count_type'] == MP_COUNT_BY_DISCOUNT) { //�ۿ�
//									 $items[$key]['discount_price'] = 10 * bcdiv($items[$key]['price'] * $mp['price'], 1000, 0) + $items[$key]['cash_back'];
//								}
//								else if ($mp['count_type'] == MP_COUNT_BY_PRICE) {
//									 $items[$key]['discount_price'] = $mp['price'] + $items[$key]['cash_back'];
//								}
//								$items[$key]['discount_p_name'] = $mp['price_name'];
//							}
//						}
//					}
//				}
//			}
//		}

		//ixiuzeng�޸ģ���ȡ��Ʒ��Ϣ
		$gifts = IGiftNewTTC::gets(array_unique($productIds), array('status'=>GIFT_STATUS_OK));
		if (false === $gifts)
		{
			self::$errCode = IGiftNewTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IGiftNewTTC failed]' . IGiftNewTTC::$errMsg;
			return false;
		}

		//�޳���������Ʒ����һ������ֲ�
		$giftsValid = array();
		$products_gifts_type = array();
		foreach($productWhInfo as $pwinfo)
		{
			foreach($gifts as $gi)
			{
				if(($pwinfo['product_id'] == $gi['product_id']) && ($pwinfo['psystock'] == $gi['stock_id']))
				{
					$giftsValid[] = $gi;
					$products_gifts_type[$gi['product_id']][$gi['gift_id']][$gi['stock_id']]=$gi['type'];
				}
			}
		}
		unset($gifts);

		$gifts_ids = array();
		foreach ($giftsValid as $g)
		{
			$gifts_ids[] = $g['gift_id'];
		}

		//�ֱ��޳���ÿ����Ʒ������û�п�����Ʒ
		$giftsInventorys = IInventoryStockTTC::gets(array_unique($gifts_ids), array('status' => 0));
		if (false === $giftsInventorys)
		{
			self::$errCode = IInventoryStockTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IInventoryStockTTC failed]' . IInventoryStockTTC::$errMsg;
			return false;
		}


		$giftValidInventory = array();
		foreach($giftsValid as $gv)
		{
			foreach($giftsInventorys as $gsi)
			{
				if(($gv['gift_id'] == $gsi['product_id']) && ($gv['stock_id'] == $gsi['stock_id']) && 
				   (($gsi['num_available'] + $gsi['virtual_num'] > 0) || COMPONENT_TYPE==$products_gifts_type[$gv['product_id']][$gv['gift_id']][$gv['stock_id']]))
				{
					$giftValidInventory[] =  $gv;
					break;
				}
			}
		}

		$gifts_final_ids = array();
		foreach($giftValidInventory as $gvi)
		{
			$gifts_final_ids[] = $gvi['gift_id'];
		}

		//��ȡ��Ʒ��Ʒ�Ļ�����Ϣ
		$gift_base_info = IProductCommonInfoTTC::gets(array_unique($gifts_final_ids), array(), array('name', 'product_char_id', 'weight', 'pic_num'));
		if (false === $gift_base_info) {
			self::$errCode = IProductCommonInfoTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductCommonInfoTTC failed]' . IProductCommonInfoTTC::$errMsg;
			return false;
		}

		//�޳�������Ϣ�����ڵ���Ʒ
		$gift_ids_baseinfo = array();
		foreach ($giftValidInventory as $key => $gift) {
			$exist = false;
			foreach ($gift_base_info as $g_base) {
				if ($g_base['product_id'] == $gift['gift_id']) {
					$gift_ids_baseinfo[] = $gift['gift_id'];
					$exist = true;
					$giftValidInventory[$key]['name'] = $g_base['name'];
					$giftValidInventory[$key]['product_char_id'] = $g_base['product_char_id'];
					$giftValidInventory[$key]['weight'] = $g_base['weight'];;
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
		$gift_wh_info = IProductInfoTTC::gets(array_unique($gifts_final_ids), array(),array('product_id','wh_id','status'));
		$gifts_status = array();
		if (false === $gift_wh_info) 
		{
			self::$errCode = IProductInfoTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
			return false;
		}
		foreach($gift_wh_info as $gwi)
		{
			$gifts_status[$gwi['product_id']][$gwi['wh_id']] = $gwi['status'];
		}
		
		//����Ʒ�����Ӧ������Ʒ���а�
		global $_StockToStation;
		foreach ($items as $key => $item)
		{
			$items[$key]['gift'] = array();
			foreach ($giftValidInventory as $gift)
			{
				if (($gift['product_id'] == $item['product_id']) && ($gift['stock_id'] == $item['psystock']) && 
					($gifts_status[$gift['gift_id']][$_StockToStation[$gift['stock_id']]] != PRODUCT_STATUS_NORMAL)) //��Ʒ�����״̬�������ǳ���״̬
				{
					$items[$key]['gift'][$gift['gift_id']]['name'] = $gift['name'];
					$items[$key]['gift'][$gift['gift_id']]['product_id'] = $gift['gift_id'];
					$items[$key]['gift'][$gift['gift_id']]['product_char_id'] = $gift['product_char_id'];
					$items[$key]['gift'][$gift['gift_id']]['type'] = $gift['type'];
					$items[$key]['gift'][$gift['gift_id']]['weight'] = $gift['weight'];
					$items[$key]['gift'][$gift['gift_id']]['pic_num'] = $gift['pic_num'];
					$items[$key]['gift'][$gift['gift_id']]['num'] = $gift['gift_num'];
				}
			}
		}

		//����������
		$easyMainProduct = array();
		foreach ($items as $key=>$item) {
			if ($item['main_product_id'] > 0 ) {
				$mainProductExist = false;
				foreach ($items as $ii) {
					if ($ii['product_id'] == $item['main_product_id'] ) {
							$mainProductExist = true;
							$items[$key]['matchNum'] = $ii['buy_count'] < $item['buy_count'] ? $ii['buy_count'] : $item['buy_count'];
							break;
						}
				}

				if (false === $mainProductExist) {
					$items[$key]['main_product_id'] = 0;
				}
				else {
					$easyMainProduct[$item['main_product_id']] = $item['main_product_id'];
				}
			}
		}

		//��ȡ������
		//ixiuzeng��ӣ��㶫վ��������ӹ㶫վ��ȡ���Ϻ��ͱ�������������Ȼ���Ϻ���ȡ
		$wh_id_temp = null;
		if (1001 == $wh_id) {
			$wh_id_temp = 1001;
		}
		else {
			$wh_id_temp = 1;
		}

		$easyMatch = IProductRelativityTTC::gets($easyMainProduct, array('type'=>PRODUCT_BY_MIND, 'status'=>1, 'wh_id' => $wh_id_temp));
		if (false === $easyMainProduct) {
			self::$errCode = IProductRelativityTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductRelativityTTC failed]' . IProductRelativityTTC::$errMsg;
			return false;
		}

		if (count($easyMatch) > 0) {
			foreach ($items as $key => $item) {
				if ($item['main_product_id'] > 0) {
					foreach ($easyMatch as $em) {
						if ($item['main_product_id'] == $em['product_id'] && $em['type'] == PRODUCT_BY_MIND && $item['product_id'] == $em['relative_id']) {
							$cut = intval($em['property']);
							$cut = $cut > 0? $cut : 0;
							$items[$key]['match_cut'] = $cut;
						}
					}
				}
			}
		}

		//ɾ�����Ϸ��Ĺ��ﳵ��Ʒ
		foreach ($deleteProductIds as $id) {
			IBShoppingCartTTC::remove($uid, array('product_id'=>$id));
		}
		return $items;
	}

	public static function clear($uid , $wh_id =1) {
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}
		$ret = IBShoppingCartTTC::remove($uid);
		if (false === $ret) {
			self::$errCode = IBShoppingCartTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IBShoppingCartTTC failed]' . IBShoppingCartTTC::$errMsg;
			return false;
		}
		return true;
	}

	public static  function remove($uid,$product_id, $wh_id)
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


		$item = IBShoppingCartTTC::remove($uid, array('product_id'=>$product_id));
		if (false === $item) {
			self::$errCode = IBShoppingCartTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IBShoppingCartTTC failed]' . IBShoppingCartTTC::$errMsg;
			return false;
		}
	}

	public static function getCountAndPrice($uid, $wh_id=1)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid) is invalid";
			return false;
		}

		$items = IBShoppingCartTTC::get($uid);
		if (false === $items) {
			self::$errCode = IBShoppingCartTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IBShoppingCartTTC failed]' . IBShoppingCartTTC::$errMsg;
			return false;
		}
		$totalItem = 0;
		foreach ($items as &$item)
		{
			$totalItem += $item['buy_count'];
		}
			return array('uid' => $uid, 'totalnum' => $totalItem);
	}

}