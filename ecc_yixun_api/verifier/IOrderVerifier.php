<?php

require_once PHPLIB_ROOT . 'api/IVerifyConfig.inc.php';

class IOrderVerifier {
	
	const PAY_TYPE_ONLINE = 1; // 在线支付
	const PAY_TYPE_COD = 2; // 货到付款
	
	private $uid = 0;
	private $params = null;
	private $order = null;
	private $isUsed = false;
	private $isPayed = false;
	
	public function __construct($params = array()) {
		$this->params = $params;
		
		if(isset($params['uid'])) {
			$this->uid = $params['uid'];
		} else {
			$this->uid = IUser::getLoginUid();
		}
		
		if(!empty($this->uid) && isset($params['order_id'])) {
			$order_id = $params['order_id'];
			
			$act_type = $params['ACT_TYPE'];
			$act_id = $params['ACT_ID'];
			$sub_id = $params['SUB_ID'];
			if(IVerifyConfig::checkVerifyObjectMap($act_type, $act_id, OBJECT_TYPE_ORDER, $order_id)) {
				$this->order = IOrder::getOneOrder($this->uid, $order_id);
				if(!empty($this->order)) {
					$this->isPayed = $this->checkOrderStatus();
				}
			} else {
				$this->isUsed = true;
			}
		}
		
	}
	
	public function verifyOrderMoney($config = array()) {
		if($this->isUsed) {
			return 5;
		}
		
		if(!$this->order) {
			return 1;
		}
		
		if(!$this->isPayed) {
			return 2;
		}
		
		if(isset($config['min_money'])) {
			$min_money = intval($config['min_money']);
			if($min_money > 0 && $this->order['order_cost'] < $min_money) {
				return 3;
			}
		}
		
		if(isset($config['max_money'])) {
			$max_money = intval($config['max_money']);
			if($max_money > 0 && $this->order['order_cost'] > $max_money) {
				return 4;
			}
		}
		
		return true;
	}
	
	public function verifyOrderTime($config = array()) {
		if($this->isUsed) {
			return 5;
		}

		if(!$this->order) {
			return 1;
		}
		
		if(!$this->isPayed) {
			return 2;
		}
		
		if(isset($config['start_time'])) {
			$start_time = intval($config['start_time']);
			if($start_time > 0 && $this->order['order_date'] < $start_time) {
				return 3;
			}
		}
		
		if(isset($config['end_time'])) {
			$end_time = intval($config['end_time']);
			if($end_time > 0 && $this->order['order_date'] > $end_time) {
				return 4;
			}
		}
		
		return true;
	}
	
	public function verifyPayType($config = array()) {
		if($this->isUsed) {
			return 5;
		}
		
		if(!$this->order) {
			return 1;
		}
		
		if(!$this->isPayed) {
			return 2;
		}
		
		if(!isset($config['type'])) {
			throw new BaseException(101, "Unexpected verify configuration.");
		}
		
		$isOnline = self::checkIsOnlinePay();
		if($config['type'] == self::PAY_TYPE_ONLINE) {
			if($isOnline) {
				return true;
			} else {
				return 3;
			}
		} else if($config['type'] == self::PAY_TYPE_COD) {
			if(!$isOnline) {
				return true;
			} else {
				return 3;
			}
		} else {
			throw new BaseException(101, "Unexpected verify configuration.");
		}
	}
	
	public function  verifyOrderProduct($config = array()) {
		if($this->isUsed) {
			return 5;
		}

		if(!$this->order) {
			return 1;
		}

		if(!$this->isPayed) {
			return 2;
		}

		if(!isset($config['contain_type'])) {
			throw new BaseException(101, "Unexpected verify configuration.");
		}

		if(!isset($config['product_id']) || !is_array($config['product_id']) || empty($config['product_id'])) {
			throw new BaseException(101, "Unexpected verify configuration.");
		}
		
		$products = IOrder::getOrderItems($this->uid, $this->order['order_char_id']);
		if($products === false) {
			throw new BaseException(IOrder::$errCode, IOrder::$errMsg);
		}

		if($config['contain_type'] == '1') {
			foreach ($products as $p) {
				if(in_array($p['product_char_id'], $config['product_id'])) {
					return true;
				}
			}

			//第二种逻辑
			/*$product_idInfos = array();
			foreach ($products as $p) {
				$product_idInfos[] = $p['product_char_id'];
			}

			foreach ($config['product_id'] as $user_input_productId) {
				if (!in_array($user_input_productId, $product_idInfos)) {
					return 3;
				}
			}*/

		}else if ($config['contain_type'] == '2') {
			//取得商品id
			$productIds = array();
			foreach ($products as $p) {
				array_push($productIds, $p['product_id']);
			}

			//取得商品信息
			$productInfos = IProductCommonInfoTTC::gets($productIds);

			if($productInfos === false) {
				throw new BaseException(IProductCommonInfoTTC::$errCode, IProductCommonInfoTTC::$errMsg);
			}

			//var_dump($config['product_id']);

			//判断用户输入的订单中是否包含指定小类的商品
			foreach ($productInfos as $pi) {
				//var_dump($pi['c3_ids']);
				if(in_array($pi['c3_ids'], $config['product_id'])) {
					return true;
				}	
			}

			//得到当前订单所有小类id集合
			/*$c3_idInfos = array();
			foreach ($productInfos as $pi) {
				$c3_idInfos[] = $pi['c3_ids'];
			}

			foreach ($config['product_id'] as $user_input_c3id) {
				if (!in_array($user_input_c3id, $c3_idInfos)) {
					return 4;
				}
			}*/
		}
		

		if ($config['contain_type'] == '2') {
			return 4;
		}

		return 3;

		/*return true;*/
	}
	
	public function verifyOrderDaily() {
		if($this->isUsed) {
			return 5;
		}
		
		if(!$this->order) {
			return 1;
		}
		
		if(!$this->isPayed) {
			return 2;
		}
		
		$today = date('Y-m-d');
		$order_day = date('Y-m-d', $this->order['order_date']);
		
		if($today != $order_day) {
			return 3;
		}
		
		return true;
	}
	
	private function checkOrderStatus() {
		if (self::checkIsOnlinePay($this->order)) {
			if ($this->order['isPayed']) {
				return true;
			}  else 
				return false;
		} else {
			$orderStatus = $this->order['status'];
			Global $_OrderState;
			if($orderStatus == $_OrderState['OutStock']['value'])
				return true;
			else 
				return false;
		}
	}
	
	private function checkIsOnlinePay() {
		global $_PAY_MODE;
        return $_PAY_MODE[$this->order['hw_id']][$this->order['pay_type']]['IsNet'];
	}
}