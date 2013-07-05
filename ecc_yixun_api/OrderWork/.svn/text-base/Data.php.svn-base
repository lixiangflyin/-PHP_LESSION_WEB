<?php
class EA_OrderWork_Data
{
	public $debug = false;

	//是否开发票
	const HAS_INVOICE = 1;
	const NO_INVOICE = 0;

	public $uid;
	public $user_info;
	public $site_id;
	public $now_date;
	public $now_time;

	public $parent_order_char_id; //字符串的主订单ID
	public $order_data; //用户提交的下单数据
	public $order_products = array(); //订单 => 商品基本信息 映射
	public $order_records = array(); //订单 => 订单标记、价格、商品ID列表等信息 映射
	public $items_in_promotion = array(); //订单中促销的商品
	public $coupon_info = array(); //订单相关的优惠券信息
	public $product_list = array(); //订单相关的商品数据
	public $order_items = array(); //订单记录关联的所有商品记录
	public $order_ship_price;
	public $product_cash;

	private $item_id_seed;
	private	$match_id_seed;

	private $ms_transaction;
	private $coupon_db;

	public $app_link_source = array(
		'--mobile--',
		'--android--',
		'--androidpad--',
		'--iphone--',
		'--ipad--',
		'--winphone--',
		'--winpad--'
	);

	public function __construct($user, $site_id)
	{
		$this->uid = $user['uid'];
		$this->site_id = $site_id;
		$this->user_info = $user;

		$this->now_time = time();
		$this->now_date = date('Y-m-d H:i:s', $this->now_time);

		$this->ms_transaction = new EL_MssqlTransaction();
		$this->order_db_table_index = $this->ms_transaction->getTableIndex('ICSON_ORDER_CORE', $this->uid);
	}

	public function getCartInfo()
	{
		$post_order_items = array();
		$shopping_cart_type = IShoppingCart::ONLINE_CART;

		//如果是无线一键购买、节能补贴商品、分销导购，则从suborders中取商品
		if (!empty($this->order_data['buy_one_key']) || (isset($this->order_data['ism']) && $this->order_data['ism'] == 2) || $this->order_data['isDistribution']) {
			foreach ($this->order_data['suborders'] as $node) {
				foreach ($node['items'] as $it) {
					$item_tmp = array();
					$item_tmp['product_id'] = $it['product_id'];
					$item_tmp['buy_count'] = $it['num'];
					$item_tmp['main_product_id'] = !empty($it['main_product_id']) ? $it['main_product_id'] : 0;
					$item_tmp['price_id'] = !empty($it['price_id']) ? ($it['price_id'] === "thh" ? 1 : 0 ) : 0;
					$item_tmp['OTag'] = !empty($it['OTag']) ? $it['OTag'] : "";

					$post_order_items[] = $item_tmp;
				}
			}

			$shopping_cart_type = IShoppingCart::OFFLINE_CART;
		}

		//从购物车中取商品和套餐信息
		$offline_params = array(
			'type' => $shopping_cart_type,
			'items' => $post_order_items,
		);

		$result = IPreOrder::getItemList($this->uid, $this->site_id, $offline_params);
		if (false === $result) {
			EL_Errors::err(IPreOrder::$errCode, IPreOrder::$errMsg . ",uid({$this->uid}) getItemList failed");
			return array('errCode'=>-11001, 'errMsg'=>"您的购物车中没有商品，请选购！");
		}

		//为手机端过滤掉套餐
		if (in_array($this->order_data['ls'], $this->app_link_source) ) {
			$result['items'] = IShoppingCart::filterPackageItems($result['items']);
		}

		return array(
			'items' => $result['items'], //购物车中的商品
			'suiteInfo' => $result['suiteInfo'], //商品中的套餐信息
		);
	}

	public function checkReceiverAddr()
	{
		global $_District;

		//开始检查收获地址
		if (!isset($this->order_data['receiver']) || strlen($this->order_data['receiver']) == 0 || strlen($this->order_data['receiver']) > 20) {
			EL_Errors::err(-2001, "[receiver] is empty");
			return false;
		}

		global $_District;
		if (!isset($this->order_data['receiveAddrId']) || !isset($_District[$this->order_data['receiveAddrId']])) {
			EL_Errors::err(-2002, "[receiveAddrId] is invalid");
			return false;
		}

		if (!isset($this->order_data['receiveAddrDetail']) || strlen($this->order_data['receiveAddrDetail']) == 0) {
			EL_Errors::err(-2003, "[receiveAddrDetail] is empty");
			return false;
		}

		if ((!isset($this->order_data['receiverTel']) || strlen($this->order_data['receiverTel']) == 0)
			&& (!isset($this->order_data['receiverMobile']) || strlen($this->order_data['receiverMobile']) == 0)
		) {
			EL_Errors::err(-2004, "[receiverTel and receiverMobile] is empty");
			return false;
		}

		if (!isset($this->order_data['zipCode'])) {
			$this->order_data['zipCode'] = '';
		}

		return true;
	}

	public function checkShippingType()
	{
		global $_LGT_MODE, $_WhidToRegion, $_District;
		if (!isset($this->order_data['shipType']) || !isset($_LGT_MODE[$this->order_data['shipType']])) {
			EL_Errors::err(-2005, "[{$this->order_data['shipType']}] is invalid");
			return false;
		}

		//运送方式不可用
		if ($_LGT_MODE[$this->order_data['shipType']]['IsOnlineShow'] == 0) {
			EL_Errors::err(-2006, "[shipType] is avaible");
			return false;
		}


		//判断该物流方式能否到达该目的地，商品禁运放在检查商品的时候进行
		$destination = $this->order_data['receiveAddrId'];
		$source_region = $_WhidToRegion[$this->site_id];
		$shippingTypeAva = IShippingRegionTTC::gets(
			array($destination,
				$_District[$destination]['city_id'],
				$_District[$destination]['province_id']
			),
			array(
				'wh_id'  => $source_region,
				'status' => 0
			)
		);

		if (false === $shippingTypeAva) {
			EL_Errors::err(IShippingRegionTTC::$errCode, '[get IShippingRegionTTC failed],' . IShippingRegionTTC::$errMsg);

			return false;
		}

		// 初始值表示不可达
		$is_Reach = false;
		foreach ($shippingTypeAva as $sp) {
			if ($sp['shipping_id'] == $this->order_data['shipType']) {
				// 找到这种运送方式则为可达
				$is_Reach = true;
			}
		}

		if (false === $is_Reach) {
			// 找不到这种运送方式，则为不可达
			EL_Errors::err(-2006, " {$this->order_data['shipType']} can not shipping to $destination");
			Logger::err(var_export($shippingTypeAva, true));
			return false;
		}

		if (!isset($this->order_data['expectDate'])) {
			$this->order_data['expectDate'] = 0;
		}

		if (!isset($this->order_data['expectSpan'])) {
			$this->order_data['expectSpan'] = 0;
		}

		if (!isset($this->order_data['arrived_limit_time'])) {
			$this->order_data['arrived_limit_time'] = '';
		}

		return true;
	}

	public function checkPayType()
	{
		global $_PAY_MODE;
		global $_LGT_PAY;

		if (!isset($this->order_data['payType']) || !isset($_PAY_MODE[$this->site_id][$this->order_data['payType']])) {
			EL_Errors::err(-2007, "[payType] is invalid");
			return false;
		}

		if ($_PAY_MODE[$this->site_id][$this->order_data['payType']]['IsOnlineShow'] == 0) {
			EL_Errors::err(-2007, "[payType] is invalid");
			return false;
		}

		foreach ($_LGT_PAY[$this->site_id] as $lgt) {
			if ($lgt['ShipTypeSysNo'] == $this->order_data['shipType'] && $lgt['PayTypeSysNo'] == $this->order_data['payType']) {
				EL_Errors::err(-2008, "paytype is not support by shiptype");
				return false;
			}
		}

		return true;
	}

	public function checkInvoice()
	{
		$this->order_data['isVat'] = isset($this->order_data['isVat']) ? $this->order_data['isVat'] : 1;
		if (0 == $this->order_data['isVat']) //如果不需要开发票，则不用验证发票
		{
			return true;
		}

		if (!isset($this->order_data['invoiceType']) ||
			($this->order_data['invoiceType'] != INVOICE_TYPE_RETAIL_COMPANY &&
				$this->order_data['invoiceType'] != INVOICE_TYPE_RETAIL_PERSONAL &&
				$this->order_data['invoiceType'] != INVOICE_TYPE_VAT &&
				$this->order_data['invoiceType'] != INVOICE_TYPE_TITLE &&
				$this->order_data['invoiceType'] != INVOICE_TYPE_VAT_NORMAL)
		) {
			EL_Errors::err(-2009, "invoiceType is invalid");
			return false;
		}

		if (!isset($this->order_data['invoiceTitle']) || $this->order_data['invoiceTitle'] == '' || strlen($this->order_data['invoiceTitle']) > MAX_TITLE_LEN) {
			EL_Errors::err(-2010, "invoice invoiceTitle is invalid");
			return false;
		}

		if (!isset($this->order_data['invoiceId']) || $this->order_data['invoiceId'] <= 0) {
			EL_Errors::err(-2017, " invoiceId is invalid");
			return false;
		}

		//商业零售发票
		if ($this->order_data['invoiceType'] == INVOICE_TYPE_VAT) {
			if (!isset($this->order_data['invoiceCompanyName']) || $this->order_data['invoiceCompanyName'] == '' || strlen($this->order_data['invoiceCompanyName']) > MAX_COMPANY_LEN) {
				EL_Errors::err(-2011, "invoiceCompanyName is invalid");
				return false;
			}
			if (!isset($this->order_data['invoiceCompanyAddr']) || $this->order_data['invoiceCompanyAddr'] == '' || strlen($this->order_data['invoiceCompanyAddr']) > MAX_ADDR_LEN) {
				EL_Errors::err(-2012, "invoiceCompanyAddr is invalid");
				return false;
			}
			if (!isset($this->order_data['invoiceCompanyTel']) || $this->order_data['invoiceCompanyTel'] == '' || strlen($this->order_data['invoiceCompanyTel']) > MAX_PHONE_LEN) {
				EL_Errors::err(-2013, "invoiceCompanyTel is invalid");
				return false;
			}
			if (!isset($this->order_data['invoiceTaxno']) || $this->order_data['invoiceTaxno'] == '' || strlen($this->order_data['invoiceTaxno']) > MAX_TAXNO_LEN) {
				EL_Errors::err(-2014, "invoiceTaxno is invalid");
				return false;
			}
			if (!isset($this->order_data['invoiceBankNo']) || $this->order_data['invoiceBankNo'] == '' || strlen($this->order_data['invoiceBankNo']) > MAX_BANK_NO_LEN) {
				EL_Errors::err(-2015, "invoiceBankNo is invalid");
				return false;
			}
			if (!isset($this->order_data['invoiceBankName']) || $this->order_data['invoiceBankName'] == '' || strlen($this->order_data['invoiceBankName']) > MAX_BANK_NAME_LEN) {
				EL_Errors::err(-2016, "invoiceBankName is invalid");
				return false;
			}
			if (!isset($this->order_data['invoiceContent'])) {
				$this->order_data['invoiceNote'] = '';
			}
		}

		//对于非分销订单,需要校验传入的发票id是否属于该用户
		if (!isset($this->order_data['shopGuideId'])) {
			$invoice = IUserInvoiceBookTTC::get($this->uid, array('iid'=> $this->order_data['invoiceId']));
			if (false === $invoice) {
				EL_Errors::err(IUserInvoiceBookTTC::$errCode, '[get IUserInvoiceBookTTC failed]' . IUserInvoiceBookTTC::$errMsg);
				return false;
			}
			if (1 != count($invoice)) {
				EL_Errors::err(-2018, "invoice id is not exist or not belong to this uid");
				return false;
			}
		}

		return true;
	}

	public function createItemsMapInCart($items_in_cart)
	{
		$map = array();
		foreach ($items_in_cart as $item) {
			if (isset($item['product_saving_amount'])) {
				unset($item['product_saving_amount']);
			}

			$pid = $item['product_id'];
			if (array_key_exists($pid, $map)) {
				$map[$pid]['buy_count'] += $item['buy_count'];
				$map[$pid]['cash_back'] += (isset($item['cash_back']) ? $item['cash_back'] : 0) * $item['buy_count'];
				$map[$pid]['package_id'] .= ','.$item['package_id'];
			}
			else {
				$map[$pid] = $item;
				$map[$pid]['cash_back'] = (isset($item['cash_back']) ? $item['cash_back'] : 0) * $item['buy_count'];
			}
		}

		return $map;
	}

	public function getEventPromotion($items_map_in_cart)
	{
		if (!isset($this->order_data['applytimes']) || $this->order_data['applytimes'] < 0) {
			return array('errCode'=>-991, 'errMsg'=>'抱歉，您参加的活动已结束或终止，请您返回购物车重新操作');
		}

		$promotion_rule = IPromotionRule::checkRuleForOrder($items_map_in_cart, $this->site_id, $this->uid, $this->order_data['rule_id'], $this->order_data['applytimes']);
		if (false === $promotion_rule) {
			EL_Errors::err(-992, "IPromotionRule::checkRuleForOrder failed,code:" . IPromotionRule::$errCode . ",msg:" . IPromotionRule::$errMsg);
			return false;
		}

		$promotion_rule = json_decode($promotion_rule, true);
		if (!is_array($promotion_rule)) {
			EL_Errors::err(-841, "json_decode promotionrule failed");
			return false;
		}

		if ($promotion_rule['errCode'] == -2007 || $promotion_rule['errCode'] == -2008 || $promotion_rule['errCode'] == -2006) {
			return array('errCode'=>-991, 'errMsg'=>'抱歉，您参加的活动已结束或终止，请您返回购物车重新操作');
		}

		//拉取促销规则失败
		if ($promotion_rule['errCode'] != 0 || !isset($promotion_rule['rules'][0])) {
			EL_Errors::err($promotion_rule['errCode'], $promotion_rule['errMsg']);
			return false;
		}

		$promotion = $promotion_rule['rules'][0];

		//还需要检测该用户已经使用该规则的次数
		if ($promotion['apply_time_peruser'] < 999) {
			$join_rule_count = $this->ms_transaction->count('ICSON_ORDER_CORE', 't_orders_' . $this->order_db_table_index, "uid={$this->uid} and coupon_code='rule_{$this->order_data['rule_id']}' and status >=0", $this->uid);
			if ($join_rule_count === false) {
				return array('errCode'=>-993, 'errMsg'=>"读取活动促销信息失败");
			}

			if ($join_rule_count >= $promotion['apply_time_peruser']) {
				return array('errCode'=>-992, 'errMsg'=>"抱歉，您已到达【{$promotion['desc']}活动】参与的次数上限，不能再参加该活动");
			}
		}

		if ($this->order_data['applytimes'] != $promotion['benefit_times']) {
			return array('errCode'=>-993, 'errMsg'=>"抱歉，您参加的活动已结束或终止，请您返回购物车重新操作");
		}

		return $promotion_rule['rules'][0];
	}

	/**
	 * 下单频率限制
	 *
	 * @return boolean 访问频率超过限制
	 */
	public function checkVisitFrequency()
	{
		$bNeedCheck = false;
		foreach ($this->product_list as $p_info) {
			if (($p_info['flag'] & OTHER_TIME_LIMITED_RUSHING_BUY) == OTHER_TIME_LIMITED_RUSHING_BUY) { //发现抢购商品，限制下单频率
				$bNeedCheck = true;
				break;
			}
		}

		if ($bNeedCheck) {
			$ret = IFreqLimit::checkAndAdd($this->uid, 5);
			if ($ret > 0) { //下单频率过快
				EL_Errors::err(-6001, basename(__FILE__, '.php') . " |" . __LINE__ . '[freqlimit] visit frequency too high');
				return false;
			}
		}

		return true;
	}

	public function resetDistribution()
	{
		foreach ($this->order_data['suborders'] as $suborder) {
			foreach ($suborder['items'] as $p_item) {
				foreach ($this->product_list as $_product) {
					if ($_product['product_id'] == $p_item['product_id']) {
						$this->product_list[$_product['product_id']]['price'] = $p_item['price'];
						$this->product_list[$_product['product_id']]['shopPrice'] = $p_item['shopPrice'];
					}
				}
			}
		}
	}

	/**
	 * 检查前台传入的商品列表 与 购物车中商品列表是否一致, 同时检查商品，赠品，组件的状态，按禁运类型归类商品
	 *
	 * @param array $items_map_in_cart
	 *
	 * return mixed
	 */
	public function getInfoByClientOrders($client_orders, $items_map_in_cart)
	{
		$all_pids = array();
		$unshipping_pids = array();
		$can_vat_invoice = true; //能否模糊开票，开增值发票
		$order_products = array(); //订单记录集
		$c3ids = array();

		foreach ($client_orders as $order_key => $client_order) {
			$order_info = array();
			foreach ($client_order['items'] as $p_item) {
				$exist = false;
				foreach ($items_map_in_cart as $item_in_cart) {
					if ($p_item['product_id'] == $item_in_cart['product_id'] ) {
						//订购数量不一致
						if ($p_item['num'] != $item_in_cart['buy_count']) {
							return array('errCode'=>-1, 'errMsg'=>"购物车中商品" . $this->product_list[$item_in_cart['product_id']]['name'] . "订购数量不正确，请返回购物车修改数量");
						}

						//商品基本信息不存在
						if (!isset($this->product_list[$p_item['product_id']])) {
							return array('errCode'=>-2, 'errMsg'=>"购物车中商品" . $this->product_list[$item_in_cart['product_id']]['name'] . "暂不销售，请返回购物车删除");
						}

						//商品状态不合法
						if (isset($this->product_list[$p_item['product_id']]['status']) && $this->product_list[$p_item['product_id']]['status'] != PRODUCT_STATUS_NORMAL) {
							return array('errCode'=>-3, 'errMsg'=>"购物车中商品" . $this->product_list[$item_in_cart['product_id']]['name'] . "暂不销售，请返回购物车删除");
						}

						if ($this->product_list[$p_item['product_id']]['psystock'] != $order_key) {
							return array('errCode'=>-3, 'errMsg'=>"购物车中商品" . $this->product_list[$item_in_cart['product_id']]['name'] . "信息已经改变，请刷新页面");
						}

						if (!isset($order_info[$item_in_cart['product_id']]) ) {
							$order_info[$item_in_cart['product_id']] = array();
						}

						$order_info[$item_in_cart['product_id']]['product_id'] = $item_in_cart['product_id'];
						$order_info[$item_in_cart['product_id']]['OTag'] = $item_in_cart['OTag'];
						$order_info[$item_in_cart['product_id']]['buy_count'] += $item_in_cart['buy_count'];
						$order_info[$item_in_cart['product_id']]['main_product_id'] = $item_in_cart['main_product_id'];
						$order_info[$item_in_cart['product_id']]['type'] = SHOPPING_CART_PRODUCT_TYPE_NORMAL;

						$_unhipping_type = $this->product_list[$p_item['product_id']]['restricted_trans_type'];
						$unshipping_pids[$_unhipping_type][] = $p_item['product_id'];

						if ($this->product_list[$item_in_cart['product_id']]['flag'] & CAN_VAT_INVOICE == 0) {
							$can_vat_invoice = false;
						}

						$c3ids[] = $this->product_list[$item_in_cart['product_id']]['c3_ids'];
						$all_pids[] = $item_in_cart['product_id'];

						$exist = true;
						break;
					}
				}

				if (!$exist) {
					$product_name = isset($this->product_list[$p_item['product_id']]) ? $this->product_list[$p_item['product_id']]['name'] : $p_item['product_id'];
					return array('errCode'=>-4, 'errMsg'=>"购物车中商品" . $product_name . "不存在，请返回购物车删除该商品");
				}

				//查看该商品附送的赠品&配件是否匹配
				foreach ($p_item['gift'] as $gift_pid) {
					if (!isset($this->product_list[$p_item['product_id']]['gifts'][$gift_pid])) {
						return array('errCode'=>-5, 'errMsg'=>"购物车中赠品/组件" . $this->product_list[$p_item['product_id']]['gifts'][$gift_pid]['name'] . "暂时无货，请返回购物车删除");
					}

					//商品状态不合法
					if (isset($this->product_list[$p_item['product_id']]['gifts'][$gift_pid]['status']) &&  $this->product_list[$p_item['product_id']]['gifts'][$gift_pid]['status'] == PRODUCT_STATUS_NORMAL) {
						return array('errCode'=>-6, 'errMsg'=>"购物车中赠品/组件" . $this->product_list[$p_item['product_id']]['gifts'][$gift_pid]['name'] . "暂时无货，请返回购物车删除");
					}

					if (!isset($order_info[$item_in_cart['product_id']]) ) {
						$order_info[$item_in_cart['product_id']] = array();
					}

					$order_info[$gift_pid]['product_id'] = $gift_pid;
					$order_info[$gift_pid]['buy_count'] += $p_item['num'] * $this->product_list[$p_item['product_id']]['gifts'][$gift_pid]['num'];
					$order_info[$gift_pid]['OTag'] = '';
					$order_info[$gift_pid]['main_product_id'] = 0;
					$order_info[$gift_pid]['belongto_product_id'] = $p_item['product_id'];

					if ($this->product_list[$p_item['product_id']]['gifts'][$gift_pid]['type'] == 1) {
						$order_info[$gift_pid]['type'] = SHOPPING_CART_PRODUCT_TYPE_ZUJIAN ;
					}
					else {
						$order_info[$gift_pid]['type'] = SHOPPING_CART_PRODUCT_TYPE_GIFT ;
					}

					$_unhipping_type = $this->product_list[$p_item['product_id']]['gifts'][$gift_pid]['restricted_trans_type'];
					$unshipping_pids[$_unhipping_type][] = $gift_pid;

					$all_pids[] = $gift_pid;
				}
			}

			$order_products[$order_key] = $order_info;
		}

		//删除禁运类型0（不限运）
		if (isset($unshipping_pids[0])) {
			unset($unshipping_pids[0]);
		}

		return array(
			'unshipping_pids' => $unshipping_pids, //{unshipping type => [pid0, pid1, pid2,...], ...}
			'all_pids' => $all_pids,
			'c3ids' => $c3ids,
			'can_vat_invoice' => $can_vat_invoice, //能否模糊开票，开增值发票
			'order_products' => $order_products,
		);
	}

	/**
	 * 检查预约
	 *
	 * @param array $all_pids
	 * @author ixiuzeng
	 *
	 * @return mix
	 */
	public function checkBooking($all_pids)
	{
		global $PreOrderProduct;

		//检查购物车中的商品是否有需要输入预约号的商品
		$pre_order_products = array_intersect($all_pids, $PreOrderProduct['items']);
		if (empty($pre_order_products) ) {
			return true;
		}

		//如果存在预约商品那么需要验证优惠券
		if (isset($this->order_data['couponCode']) && $this->order_data['couponCode'] != "" ) {
			//如果有预约券号，需要验证批次号是否正确
			$couponret = ICouponTTC::get($this->order_data['couponCode']);
			if (!in_array($couponret[0]['batchno'], $PreOrderProduct['batchno'])) {
				EL_Errors::err(-18, "您输入的预购券号不正确，请重新输入");
				return array('errCode' => -18, 'errMsg' => "您输入的预购券号不正确，请重新输入");
			}
		}
		else {
			//如果没有传递预约优惠券的代码，需要提示错误信息。
			EL_Errors::err(-18, "您的订单中含有预购商品，请使用预购券购买");
			return array('errCode' => -18, 'errMsg' => "您的订单中含有预购商品，请使用预购券购买");
		}

		return true;
	}

	public function checkCoupon($items_map_in_cart)
	{
		$this->coupon_info = array('amt'=>0, 'code'=>'', 'type'=>0);
		if (isset($this->order_data['couponCode']) && $this->order_data['couponCode'] != "" ) {
			if ((isset($this->order_data['ls'])) && ( in_array($this->order_data['ls'], array('--android--','--iphone--') ) ) ) {
				$this->coupon_info = ICoupon::checkAppCoupon($this->uid, $this->order_data['couponCode'], $this->order_data['receiveAddrId'], $this->order_data['payType'] ,$this->site_id, $items_map_in_cart);
			}
			elseif (in_array($this->order_data['ls'], array('--mobile--'))){
				$this->coupon_info = ICoupon::checkCoupon($this->uid, $this->order_data['couponCode'], $this->order_data['receiveAddrId'], $this->order_data['payType'] ,$this->site_id, 1);
			}
			else {
				$this->coupon_info = ICoupon::checkCoupon($this->uid, $this->order_data['couponCode'], $this->order_data['receiveAddrId'], $this->order_data['payType'] ,$this->site_id, 0);
			}

			if (false === $this->coupon_info) {
				EL_Errors::err(ICoupon::$errCode, ICoupon::$errMsg);
				return array('errCode' => -11002, 'errMsg' => '获取优惠券信息失败');
			}
		}

		return true;
	}

	public function checkShippingLimit()
	{
		global $_OrderState;

		$limited_products = array();
		foreach ($this->order_products as $order_key => $_products) {
			foreach ($_products as $item) {
				if ($item['type'] != SHOPPING_CART_PRODUCT_TYPE_NORMAL) {
					continue;
				}

				if (!isset($this->product_list[$item['product_id']])) {
					return array('errCode'=>-9, 'errMsg'=>"购物车中商品" . $this->product_list[$item['product_id']]['name'] . "暂不销售，请返回购物车删除");
				}

				$p_detail = $this->product_list[$item['product_id']];

				//该商品限购,分销订单不需要检查限购
				if (false === $this->order_data['isDistribution']) {
					if ($p_detail['num_limit'] > 0 && $p_detail['num_limit'] < 999) {
						if ($p_detail['num_limit'] < $item['buy_count']) {
							return array('errCode'=>-8, 'errMsg'=>"购物车中商品" . $this->product_list[$item['product_id']]['name'] . "超过限购数量" . $p_detail['num_limit']);
						}
						$limited_products[$p_detail['product_id']]= $order_key;
					}
				}
			}
		}

		//如果购物车中商品有限购商品，则查询该用户当天的订单
		//这里部署外网需要修改分库分表的问题
		if (!empty($limited_products)) {
			$timestamp = mktime(0,0,0,date('m'), date('d'), date('Y') );

			$sql = "select product_id, sum(buy_num) as buy_num from
			t_order_items_{$this->order_db_table_index} ot,
			t_orders_{$this->order_db_table_index} o
			where o.order_char_id=ot.order_char_id".
				" and o.status<>". $_OrderState['ManagerCancel']['value'] .
				" and o.status<>". $_OrderState['CustomerCancel']['value'].
				" and o.status<>". $_OrderState['EmployeeCancel']['value']." and ot.uid=" . $this->uid. " and create_time > " . $timestamp .
				" and product_id in(" . implode(',', array_keys($limited_products)) . ") group by product_id";

			$user_orders = $this->ms_transaction->selectBySql('ICSON_ORDER_CORE', $sql, $this->uid);
			if (false === $user_orders) {
				EL_Errors::err($this->ms_transaction->code, $this->ms_transaction->msg);
				return false;
			}

			//分销订单不需要检查限购
			if (!$this->order_data['isDistribution']) {
				if (!empty($user_orders)) {
					foreach ($user_orders as $order) {
						if ($order['buy_num'] >= $this->product_list[$order['product_id']]['num_limit']) {
							return array('errCode'=>-11, 'errMsg'=>"购物车中商品" . $this->product_list[$order['product_id']]['name'] . "是限购商品，您今日购买数量已经超过限购数量");
						}
						elseif ($order['buy_num'] + $this->order_products[$limited_products[$order['product_id']]][$order['product_id']]['buy_count'] > $this->product_list[$order['product_id']]['num_limit']) {
							return array('errCode'=>-12, 'errMsg'=>"购物车中商品" . $this->product_list[$order['product_id']]['name'] .
								"是限购商品，您今日还能购买" . ($this->product_list[$order['product_id']]['num_limit'] - $order['buy_num']) . "个" );
						}
					}
				}
			}
		}
		//检查限购完毕

		return true;
	}

	public function checkShippingForbiden($unshipping_pids)
	{
		global $_District;

		$shipTypeNotAva = IShipping::getForbidenShippingType($unshipping_pids, $_District[$this->order_data['receiveAddrId']]['province_id'], $_District[$this->order_data['receiveAddrId']]['city_id'], $this->order_data['receiveAddrId'], $this->site_id);
		if (false === $shipTypeNotAva) {
			EL_Errors::err(-2031, '获取禁运类型->运送方式失败');
			return false;
		}

		//检查禁运类型失败
		if (in_array($this->order_data['shipType'], array_keys($shipTypeNotAva))) {
			return array('errCode'=>-17, 'errMsg'=>"购物车中有商品不支持您选择的运送方式");
		}

		return true;
	}

	public function getStocks($all_pids)
	{
		if (empty($all_pids)) {
			return array();
		}

		$condition = 'ProductSysNo in (' . implode(',', $all_pids) . ')';
		$product_stocks = $this->ms_transaction->select('Inventory_Manager', 'Inventory_Stock', $condition, 'SysNo, ProductSysNo, StockSysNo, AvailableQty, VirtualQty, OrderQty');
		if ($product_stocks === false) {
			EL_Errors::err(-995, "code:{$this->ms_transaction->code},msg:{$this->ms_transaction->msg}");
			return array('errCode'=>-995, 'errMsg'=>"读取库存信息失败");
		}

		return $product_stocks;
	}

	public function checkStock($product_stocks)
	{
		$giftLackOfStock = array();
		$lackGiftAndIgnore = false;
		$orders_has_virtual = array();

		foreach ($this->order_products as $order_key => $_products) {
			foreach ($_products as $kk => $p_info) {
				$exist = false;
				$p_detail = $this->product_list[$p_info['product_id']];
				foreach ($product_stocks as $pstock) {
					if ($p_info['product_id'] == $pstock['ProductSysNo'] && $order_key == $pstock['StockSysNo']) {
						$exist = true;
						if (($pstock['AvailableQty'] + $pstock['VirtualQty'] <= 0) && $p_info['type'] != SHOPPING_CART_PRODUCT_TYPE_GIFT) {
							$_stock_item = array(
								'product_id'=>$p_info['product_id'],
								'num_available'=>$pstock['AvailableQty'],
								'virtual_num'=> $pstock['VirtualQty']
							);
							IInventoryStockTTC::update($_stock_item, array('sys_no'=>$pstock['SysNo']));

							if ($p_info['type'] == SHOPPING_CART_PRODUCT_TYPE_ZUJIAN) {
								return array('errCode'=>-15, 'errMsg'=>'组件'.$this->product_list[$p_info['belongto_product_id']]['gifts'][$p_info['product_id']]['name']."库存不足,请联系客服");
							}

							return array('errCode'=>-14, 'errMsg'=>'商品'.$p_detail['name']."库存不足");
						}

						if ($p_info['type'] == SHOPPING_CART_PRODUCT_TYPE_GIFT) { //赠品
							if ($pstock['AvailableQty'] + $pstock['VirtualQty'] < $p_info['buy_count']) {
								$_stock_item = array(
									'product_id'=>$p_info['product_id'],
									'num_available'=>$pstock['AvailableQty'],
									'virtual_num'=> $pstock['VirtualQty']
								);
								IInventoryStockTTC::update($_stock_item, array('sys_no'=>$pstock['SysNo']));

								if (!isset($this->order_data['ingoreLackOfGift'])) { //如果第一次提交订单
									$giftLackOfStock[$p_info['product_id']] = $this->product_list[$p_info['belongto_product_id']]['gifts'][$p_info['product_id']]['name'];
								}
								elseif ($this->order_data['ingoreLackOfGift'] == 1) {
									//用户接受缺少礼品
									$this->order_products[$order_key][$kk]['buy_count'] = $pstock['AvailableQty'] + $pstock['VirtualQty'];
									if ($this->order_products[$order_key][$kk]['buy_count'] <= 0) {
										unset($this->order_products[$order_key][$kk]);
									}
									$lackGiftAndIgnore = true;
								}
								else //用户不接受，则拒绝下单
								{
									return array('errCode'=>-13, 'errMsg'=>'赠品'.$this->product_list[$p_info['belongto_product_id']]['gifts'][$p_info['product_id']]['name']."库存不足");
								}
							}
						}
						elseif ($p_info['type'] == SHOPPING_CART_PRODUCT_TYPE_ZUJIAN) { //组件
							if ($pstock['AvailableQty'] + $pstock['VirtualQty'] < $p_info['buy_count']) {
								return array('errCode'=>-15, 'errMsg'=>'组件'.$this->product_list[$p_info['belongto_product_id']]['gifts'][$p_info['product_id']]['name']."库存不足,请联系客服");
							}
						}
						else { //主商品
							if ($pstock['AvailableQty'] < $p_info['buy_count']){
								$orders_has_virtual[$order_key] = true;
							}

							if (($pstock['AvailableQty'] + $pstock['VirtualQty'] < $p_info['buy_count'])
								&&	(($this->site_id != 1) || ($p_detail['flag'] & FORBID_SET_VIRTUAL) == FORBID_SET_VIRTUAL || $p_detail['type'] != PRODUCT_TYPE_NORMAL)
								) {
								return array('errCode'=>-15, 'errMsg'=>'商品'.$p_detail['name']."库存不足");
							}
						}

						$this->product_list[$p_info['product_id']]['AvailableQty'] = $pstock['AvailableQty'];
						$this->product_list[$p_info['product_id']]['VirtualQty'] = $pstock['VirtualQty'];
						break;
					}
				}

				if (false === $exist) {
					return array('errCode'=>-16, 'errMsg'=>'商品'.$p_detail['name']."暂不销售");
				}

			}
		}

		if (count($giftLackOfStock) != 0) {
			$errMsg = "购物车中赠品:";
			foreach ($giftLackOfStock as $name)
			{
				$errMsg .= $name . "库存不足,";//仅剩下" . $num ."件,";
			}
			$errMsg .= "是否继续下单?";
			return array('errCode'=>-100, 'errMsg'=>$errMsg);
		}

		// 添加提示
		if ($lackGiftAndIgnore){
			$this->order_data['comment'] .= "\n系统自动备注：用户已接受缺货赠品库存不足。";
		}

		return array(
			'orders_has_virtual' => $orders_has_virtual,
		);
	}

	public function checkEasyMatch($suite_info)
	{
		//拉取随心配
		//ixiuzeng添加，广东站的随心配从广东站获取，上海和北京的随心配依然从上海获取
		$wh_id_temp = 1;
		if (1001 == $this->site_id){
			$wh_id_temp = 1001;
		}

		$easy_match_pids = array();
		foreach ($this->order_products as $order_key => $products_in_order) {
			foreach ($products_in_order as $p_info) {
				//获取随心配商品的主商品
				if ($p_info['type'] === SHOPPING_CART_PRODUCT_TYPE_NORMAL && $p_info['main_product_id'] != 0) {
					$easy_match_pids[] = $p_info['main_product_id'];
				}
			}
		}

		$easy_match_items = array();
		if (!empty($easy_match_items)) {
			$easy_match_items = IProductRelativityTTC::gets($easy_match_pids, array('type'=>PRODUCT_BY_MIND, 'status'=>1, 'wh_id' => $wh_id_temp));
			if (false === $easy_match_items) {
				EL_Errors::err(IProductRelativityTTC::$errCode, basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProductRelativityTTC failed]' . IProductRelativityTTC::$errMsg);
				return false;
			}
		}

		//套餐中商品的个数
		$product_counts_in_suite = array();
		foreach ($suite_info as $su) {
			foreach ($su['product_list'] as $p_info) {
				$pid = $p_info['product_id'];

				if (empty($product_counts_in_suite[$pid]) ) {
					$product_counts_in_suite[$pid] = 0;
				}

				$product_counts_in_suite[$pid] += $su['buy_count'];
			}
		}

		//拉取随心配商品结束
		//计算随心配应该优惠的价格&套数
		foreach ($this->order_products as $order_key => $products_in_order) {
			foreach ($products_in_order as $p_info) {
				if ($p_info['type'] != SHOPPING_CART_PRODUCT_TYPE_NORMAL) {
					continue;
				}

				if (empty($p_info['main_product_id'] ) ) {
					continue;
				}

				$mainProductGroup = isset($this->product_list[$p_info['main_product_id']])? $this->product_list[$p_info['main_product_id']]['psystock'] : -1;
				if (isset($this->order_products[$mainProductGroup][$p_info['main_product_id']])) {
					$buy_in_suite = isset($product_counts_in_suite[$p_info['product_id']]) ? $product_counts_in_suite[$p_info['product_id']] : 0;
					$buy_count_tmp = $p_info['buy_count'] - $buy_in_suite;

					$buy_in_suite2 = isset($product_counts_in_suite[$p_info['main_product_id']]) ? $product_counts_in_suite[$p_info['main_product_id']] : 0;
					$mp_count = $this->order_products[$mainProductGroup][$p_info['main_product_id']]['buy_count'] - $buy_in_suite2;

					$matchItems = min($buy_count_tmp, $mp_count);
				}
				else {
					$matchItems = 0;
				}

				$this->order_products[$order_key][$p_info['product_id']]['matchNum'] = $matchItems;
				$this->order_products[$order_key][$p_info['product_id']]['cashCutPerItem'] = 0;
				foreach ($easy_match_items as $em) {
					if ($em['product_id'] == $p_info['main_product_id'] && $em['relative_id'] == $p_info['product_id']) {
						$cashCut = intval($em['property']) > 0? intval($em['property']) : 0;
						//这里需要和随心配商品的成本价比较么？ 不比较太危险了
						$this->order_products[$order_key][$p_info['product_id']]['cashCutPerItem'] = $cashCut;
						break;
					}
				}
			}
		}
		//随心配检查完成

		return true;
	}

	public function calculateCosts($items_map_in_cart)
	{
		global $_PAY_MODE, $_ProductType, $ProductForNongHang;

		$is_energy_subsidy_order = false;
		$has_service = false;
		$order_price = 0;
		$total_cut = 0;
		$point_max = 0;
		$point_min = 0;

		foreach ($this->order_products as $order_key => $_products) {
			foreach ($_products as $p_info) {
				$p_detail = $this->product_list[$p_info['product_id']];

				$this->order_records[$order_key]['product_ids'][] = $p_info['product_id']; //clark 记录商品ID

				//可使用的最大积分
				if ($p_detail['point_type'] != PRODUCT_CASH_PAY_ONLY) {
					$point_max += $p_detail['price'] * $this->order_products[$order_key][$p_detail['product_id']]['buy_count'];
				}

				//可使用的最小积分
				if ($p_detail['point_type'] == PRODUCT_POINT_PAY_ONLY) {
					$point_min += $p_detail['price'] * $this->order_products[$order_key][$p_detail['product_id']]['buy_count'];
				}

				if (!isset($this->order_records[$order_key]['totalWeight']) ) {
					$this->order_records[$order_key]['totalWeight'] = 0;
				}
				$this->order_records[$order_key]['totalWeight'] += $p_info['buy_count'] * $p_detail['weight'];

				if (!isset($this->order_records[$order_key]['flag'])) {
					$this->order_records[$order_key]['flag'] = 0;
				}

				if ($p_detail['type'] == $_ProductType['Service']) {
					$this->order_records[$order_key]['flag'] |= ORDER_HAS_SERVICE;   //记录订单中是否有服务类商品
					$has_service = true;
				}

				if (in_array($p_info['product_id'], $ProductForNongHang)) {
					$this->order_records[$order_key]['flag'] |= ORDER_NONGHANG; //订单中包含农行商品
				}

				if (isset($this->user_info['type'])) {
					global $_USER_TYPE;
					if ($_USER_TYPE['EnterpriseUser'] == $this->user_info['type']) {
						$this->order_records[$order_key]['flag'] |= ORDER_ENTERPRISE_USER;
					}
					elseif ($_USER_TYPE['ChaohuoUser'] == $this->user_info['type'])
					{
						$this->order_records[$order_key]['flag'] |= ORDER_CHAOHUO_USER;
					}
					elseif ($_USER_TYPE['WholeSalerUser'] == $this->user_info['type'])
					{
						$this->order_records[$order_key]['flag'] |= ORDER_WHOLESALER_USER;
					}
					elseif ($_USER_TYPE['RetailersUser'] == $this->user_info['type'])
					{
						$this->order_records[$order_key]['flag'] |= ORDER_RETAILERS_USER;
					}
				}

				if ($p_info['type'] != SHOPPING_CART_PRODUCT_TYPE_NORMAL) {
					continue;
				}

				if (!isset($this->order_records[$order_key]['orderPrice']) ) {
					$this->order_records[$order_key]['orderPrice'] = 0;
				}

				$this->order_records[$order_key]['orderPrice'] += $p_detail['price'] * $p_info['buy_count'];
				$order_price += $p_detail['price'] * $p_info['buy_count'];

				if ($p_info['main_product_id'] > 0 && $p_info['matchNum'] > 0) {
					$order_price -= $p_info['matchNum'] * $p_info['cashCutPerItem'];
					$this->order_records[$order_key]['orderPrice'] -= $p_info['matchNum'] * $p_info['cashCutPerItem'];

					if (!isset($this->order_records[$order_key]['totalCut']) ) {
						$this->order_records[$order_key]['totalCut'] = 0;
					}
					$total_cut += $p_info['matchNum'] * $p_info['cashCutPerItem'];
					$this->order_records[$order_key]['totalCut'] += $p_info['matchNum'] * $p_info['cashCutPerItem'];
				}

				//ixiuzeng添加，订单中含有套餐时，优惠价格计入返现值
				if (isset($items_map_in_cart[$p_info['product_id']]))
				{
					$order_price -= $items_map_in_cart[$p_info['product_id']]['cash_back'];
					$this->order_records[$order_key]['orderPrice'] -= $items_map_in_cart[$p_info['product_id']]['cash_back'];

					if (!isset($this->order_records[$order_key]['totalCut']) ) {
						$this->order_records[$order_key]['totalCut'] = 0;
					}
					$total_cut += $items_map_in_cart[$p_info['product_id']]['cash_back'];
					$this->order_records[$order_key]['totalCut'] += $items_map_in_cart[$p_info['product_id']]['cash_back'];
				}

				//ixiuzeng添加,订单中含有限时抢购或者二手商品，增加一个标志位
				if ( ( TIME_LIMITED_RUSHING_BUY == ($p_detail['flag'] & TIME_LIMITED_RUSHING_BUY)
					|| OTHER_TIME_LIMITED_RUSHING_BUY == ($p_detail['flag'] & OTHER_TIME_LIMITED_RUSHING_BUY)
					|| ($p_detail['type'] == $_ProductType['SecondHand']) )
					&& $_PAY_MODE[$this->site_id][$this->order_data['payType']]['IsNet'] == 1 ) {

					if (! isset($this->order_records[$order_key]['flag'])) {
						$this->order_records[$order_key]['flag'] = ORDER_RUSHING_BUY_ONLINE_PAY;
					}
					else {
						$this->order_records[$order_key]['flag'] = $this->order_records[$order_key]['flag'] | ORDER_RUSHING_BUY_ONLINE_PAY;
					}
				}

				// 如果是节能补贴商品，而且补贴身份信息完整，则判定为节能补贴订单
				if ( PRODUCT_ENERGY_SUBSIDY == ($p_detail['flag'] & PRODUCT_ENERGY_SUBSIDY )
					&& !empty($this->order_data['rule_id'])
					&& isset($this->order_data['ism'])
					&& 2 == $this->order_data['ism']
					&& isset($this->order_data['es_type'])
					&& !empty($this->order_data['es_name'])) {

					$is_energy_subsidy_order = true;
					if (!isset($this->order_records[$order_key]['flag'])) {
						$this->order_records[$order_key]['flag'] = ORDER_ENERGY_SUBSIDY;
					}
					else {
						$this->order_records[$order_key]['flag'] = $this->order_records[$order_key]['flag'] | ORDER_ENERGY_SUBSIDY;
					}
				}
			}
		}

		//如果包含服务类订单，则将所有的子订单的flag都置为此类订单
		if ($has_service) {
			foreach ($this->order_records as $key => $so) {
				$this->order_records[$key]['flag'] |= ORDER_HAS_SERVICE;
			}
		}

		//货到付款抹去分
		if ($this->order_data['payType'] == 1) {
			$order_price = 0;
			foreach ($this->order_records as $order_key => $so) {
				$this->order_records[$order_key]['orderPrice'] = 10 * bcdiv($this->order_records[$order_key]['orderPrice'], 10 , 0);
				$order_price += $this->order_records[$order_key]['orderPrice'];
			}
		}

		if (bccomp($order_price, $this->order_data['Price'], 0) != 0) {
			EL_Errors::err(-2031, $order_price . '计算的订单价格与前台订单价格不一致' . $this->order_data['Price']);
			return false;
		}

		foreach ($this->order_records as $order_key=>$so) {
			if (bccomp($so['orderPrice'], $this->order_data['suborders'][$order_key]['price'], 0) != 0) {
				EL_Errors::err(-2030, '计算的订单价格与前台订单价格不一致' );
				return false;
			}
		}

		$point_max -= $total_cut;
		$point_max /= 10;
		$point_max = ceil($point_max < $order_price ? $point_max : $order_price);
		$point_max *= 10;
		$point_min = ceil($point_min);

		return array(
			'order_price' => $order_price,
			'total_cut' => $total_cut,
			'is_energy_subsidy_order' => $is_energy_subsidy_order,
			'point_max' => $point_max,
			'point_min' => $point_min,
		);
	}

	public function checkUseScore($point_min, $point_max)
	{
		//检查积分使用情况
		if ($this->order_data['point'] < $point_min || $this->order_data['point'] > $point_max ) {
			return array('errCode'=>-10, 'errMsg'=>"您本次订单最少需使用" . ($point_min / 10) . "个积分,最多能使用" . ($point_max/10) . "个积分" );
		}

		//拉取用户积分，确保用户使用的积分不超过其拥有的积分, 并计算分别需要的现金积分和促销积分，优先使用现金积分
		$cash_point_used = 0;
		$promotion_point_used = 0;
		if ($this->order_data['point'] > 0 ) {
			if ($this->order_data['point'] / 10 < $this->user_info['cash_point']
				|| $this->order_data['point'] / 10 == $this->user_info['cash_point']) {
				$cash_point_used = $this->order_data['point'];
			}
			elseif ($this->order_data['point'] / 10 > $this->user_info['cash_point']
				&& (($this->order_data['point'] / 10 < ($this->user_info['cash_point']+$this->user_info['promotion_point']) )
				|| ($this->order_data['point'] / 10 == ($this->user_info['cash_point']+$this->user_info['promotion_point']) ) ) ) {
				$cash_point_used = ($this->user_info['cash_point'] <0) ? 0 : $this->user_info['cash_point'] * 10;
				$promotion_point_used = $this->order_data['point'] - $cash_point_used;
			}
			else {
				return array('errCode'=>-34, 'errMsg'=>"您账户积分总额为{$this->user_info['valid_point']}，最多只能使用{$this->user_info['valid_point']}个积分");
			}
		}

		return array(
			'cash' => $cash_point_used,
			'promotion' => $promotion_point_used,
		);
	}

	public function getDiscount($promotion)
	{
		$rule_discount = 0;
		if (isset($promotion['benefit_type'])) {
			//换购
			if ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_HUANGOU'] &&
				isset($this->product_list[$promotion['discount']])){
				$dis = ($this->product_list[$promotion['discount']]['price'] >= $promotion['plus_con'])? ($this->product_list[$promotion['discount']]['price'] - $promotion['plus_con']) : 0;
				$rule_discount = $promotion['benefit_times'] * $promotion['benefit_per_time'] * $dis;
			}
			//赠送商品
			elseif ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_PRODUCT'] &&
				isset($this->product_list[$promotion['discount']])) {
				$rule_discount = $this->product_list[$promotion['discount']]['price'] * $promotion['benefit_times'] * $promotion['benefit_per_time'];
			}
			elseif ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_CASH']) {
				$rule_discount = $promotion['benefit_times'] * $promotion['benefit_per_time'];
			}
			elseif ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_DISCOUNT']) {
				$rule_discount = $promotion['discount'];
			}
		}

		return $rule_discount;
	}

	public function benefitToCoupon($promotion, $rule_discount, $items_map_in_cart)
	{
		$this->coupon_info['code'] = "rule_{$promotion['rule_id']}";
		$this->coupon_info['type'] = $promotion['account_type'];
		$this->coupon_info['amt'] = $rule_discount;
		$this->coupon_info['subOrders'] = array();
		//将符合促销规则的商品按子订单分组

		$promotionAmt = 0;
		foreach ($items_map_in_cart as $item) {
			if (isset($item['isPromotionGift']) && $item['isPromotionGift'] === true) {
				continue;
			}
			if (in_array($item['product_id'], $promotion['pids'])) {
				$promotionAmt += $this->product_list[$item['product_id']]['price'] * $item['buy_count'];
				$psystock = $this->product_list[$item['product_id']]['psystock'];
				$this->coupon_info['subOrders'][$psystock]['orderAmt'] += $this->product_list[$item['product_id']]['price'] * $item['buy_count'];
				$this->coupon_info['subOrders'][$psystock]['pids'][] = $item['product_id'];
			}
		}

		//分摊优惠券金额到各个子单
		if ($this->coupon_info['amt'] == 0) {
			foreach ($this->coupon_info['subOrders'] as $key=>$so) {
				$this->coupon_info['subOrders'][$key]['coupon_amt'] =0;
			}
		}
		else {
			$remain = $this->coupon_info['amt'];
			ksort($this->coupon_info['subOrders']);

			foreach ($this->coupon_info['subOrders'] as $key=>$so) {
				$tmp = 10 * bcdiv($so['orderAmt'] * $this->coupon_info['amt'] , 10 * $promotionAmt, 0);
				$this->coupon_info['subOrders'][$key]['coupon_amt'] = $tmp;
				$remain -= $tmp;
			}

			if (0 != $remain) {
				$this->coupon_info['subOrders'][$key]['coupon_amt'] += $remain;
			}
		}
	}

	public function getShippingPrice($ship_info)
	{
		//获取购物车中商品总重量
		foreach ($this->order_records as $order_key => $so) {
			$ship_info['order_info'][$order_key]['weight'] = $so['totalWeight'];
		}

		$ship_price_info = EA_ShippingPrice::get($ship_info);
		if (!empty($ship_price_info['errCode'])) {
			EL_Errors::err(-2037, "code:{$ship_price_info['errCode']},msg:{$ship_price_info['errMsg']}");
			return false;
		}

		//如果是手机侧订单，运费为前台传过来的值，短暂兼容手机不同版本的问题，后续次特殊处理需要去掉
		if ($ship_info['is_mobile']) {
			$order_ship_price = $this->order_data['shippingPrice'];
		}
		else {
			$order_ship_price = $ship_price_info['shippingPrice'];
		}

		foreach ($this->order_records as $order_key => $so) {
			if ($ship_info['is_mobile']) {
				$this->order_records[$order_key]['orderShipPrice'] = $this->order_data['suborders'][$order_key]['shipPrice'];
			}
			else {
				$this->order_records[$order_key]['orderShipPrice'] = $ship_price_info['subShipPrice'][$order_key]['shippingPrice'];
			}
		}
		//运费计算结束

		if (bccomp($this->order_data['shippingPrice'] , $order_ship_price, 0) != 0) {
			EL_Errors::err(-2038, 'web传入的运费:' . $this->order_data['shippingPrice'] . '后台重新计算的运费:' . $order_ship_price . '计算的订单运费价格与前台订单运费价格不一致');
			return false;
		}

		//货票分离增加运费, 前台过滤掉拆单情况
		if ($this->order_data['separateInvoice'] == 1){
			$order_ship_price += 1000;
			foreach ($this->order_records as $order_key => $so) {
				$this->order_records[$order_key]['orderShipPrice'] += 1000;
			}
		}

		foreach ($this->order_records as $order_key => $so) {
			if ($so['orderShipPrice'] < 0) {
				EL_Errors::err(-2044, '订单运费计算失败');
				return false;
			}
		}

		return $order_ship_price;
	}

	public function divide($cash_point_used, $order_price)
	{
		//开始分摊优惠券&积分
		if ($this->order_data['point'] > 0) {
			ksort($this->order_records);
		}

		//分摊优惠券到商品
		if ($this->coupon_info['amt'] > 0) {
			foreach ($this->order_records as $order_key => $so) {
				$this->order_records[$order_key]['couponamt'] = $this->coupon_info['subOrders'][$order_key]['coupon_amt'];
			}

			foreach ($this->coupon_info['subOrders'] as $subKey=>$so) {
				$remain = $so['coupon_amt'];
				foreach ($so['pids'] as $pid) {
					$this->coupon_info['subOrders'][$subKey]['apport'][$pid] = 10 * bcdiv($so['coupon_amt'] * $this->order_products[$subKey][$pid]['buy_count'] * $this->product_list[$pid]['price'], 10 * $so['orderAmt'], 0);
					$remain -= $this->coupon_info['subOrders'][$subKey]['apport'][$pid];
				}

				if ($remain > 0) {
					$this->coupon_info['subOrders'][$subKey]['apport'][$pid] += $remain;
				}
			}
		}

		//分摊积分
		$temp_cash_point = $cash_point_used;
		$i = 1;
		if ($this->order_data['point'] > 0) {
			$remain = $this->order_data['point'];
			foreach ($this->order_records as $order_key => $so) {
				$tmp = 10 * bcdiv($so['orderPrice'] * $this->order_data['point'], $order_price * 10, 0);
				$this->order_records[$order_key]['point'] = $tmp;
				$remain -= $tmp;
			}

			//继续分摊不能整除剩下的部分
			foreach ($this->order_records as $order_key => $so) {
				$tmp = $so['orderPrice'] - $so['couponamt'] - $so['point'];
				if ($tmp > 0) {
					$this->order_records[$order_key]['point'] += ($tmp < $remain? $tmp : $remain);
					$remain -= ($tmp < $remain? $tmp : $remain);
				}

				if ($remain <= 0) {
					break;
				}
			}

			//分摊现金积分和促销积分
			$orders_count = count($this->order_records);
			foreach ($this->order_records as $order_key => $so)
			{
				if ($i != $orders_count)
				{
					$this->order_records[$order_key]['cash_point'] = 10 * bcdiv($cash_point_used * $this->order_records[$order_key]['point']/10, $this->order_data['point'], 0);
					$this->order_records[$order_key]['promotion_point'] = $this->order_records[$order_key]['point'] - $this->order_records[$order_key]['cash_point'];
					$temp_cash_point -= $this->order_records[$order_key]['cash_point'];
				}
				else
				{
					$this->order_records[$order_key]['cash_point'] = $temp_cash_point;
					$this->order_records[$order_key]['promotion_point'] = $this->order_records[$order_key]['point'] - $this->order_records[$order_key]['cash_point'];
				}
				$i++;
			}
		}
	}

	public function checkShippingTime($orders_has_virtual)
	{
		if ( ICSON_DELIVERY != $this->order_data['shipType'] ) {
			return true;
		}

		//如果可以采用易迅快递，校验送货时间
		$icson_delivery_info = IShipping::getIcsonDeliveryInfoByRegion($this->order_data['receiveAddrId'], $this->site_id);
		if ( false === $icson_delivery_info ) {
			EL_Errors::err(IShipping::$errCode, IShipping::$errMsg);
			return false;
		}

		$limitOrder = IShippingTime::getOrderLimitState($this->site_id);

		$orders_product_keys = array_keys($this->order_products);
		foreach ($orders_product_keys as $order_key) {
			$old_delivery_time = $icson_delivery_info['delivery_time'];
			if ($this->site_id == SITE_SH && $order_key == 5) {
				//如果是上海的大件仓，则直接规定是一日一送的逻辑
				$icson_delivery_info['delivery_time'] = 1;
			}

			// 发货仓号
			$icson_delivery_info['stock_num'] = $order_key;
			$v = isset($orders_has_virtual[$order_key]) ? $orders_has_virtual[$order_key] : false;
			$timeAvaiable = IShippingTime::getShipTimeListIcson($icson_delivery_info, $this->site_id, $this->order_data['receiveAddrId'], $v, $limitOrder['am_limit'], $limitOrder['day_limit']);
			$icson_delivery_info['delivery_time'] = $old_delivery_time;

			if ( !is_array($timeAvaiable) || count($timeAvaiable) == 0) {
				EL_Errors::err(-987, "verify get expect dly date failed, Error:".IShippingTime::$errMsg);
				return false;
			}
			else {
				$timeAvaiable = $timeAvaiable[0];
				$date = $timeAvaiable['ship_date'];
				if (strtotime($date) > strtotime($this->order_data['suborders'][$order_key]['expectDate'])
					|| ( isset($timeAvaiable['time_span'] )
						&& strtotime($date) == strtotime($this->order_data['suborders'][$order_key]['expectDate'])
						&& $timeAvaiable['time_span'] > $this->order_data['suborders'][$order_key]['expectSpan'])) {

					return array('errCode'=>-11, 'errMsg'=>"您选择的期望配送时间不正确，请重新选择" );
				}
			}

			//ixiuzeng添加
			//如果选择的是易迅快递，检查收获地址是否为限时达
			//来自 wap 和 mobile app 的订单，不做验证
			global $_ArrivedLimitTime;
			if (!isset($this->order_data['ls']) || !in_array($this->order_data['ls'], $this->app_link_source) ) {
				if (isset($_ArrivedLimitTime[$this->order_data['receiveAddrId']])) {
					//如果是限时达，需要检查arrived_time_span字段是否有数据。
					if ( !isset($this->order_data['suborders'][$order_key]['arrived_limit_time']) || empty($this->order_data['suborders'][$order_key]['arrived_limit_time']) ) {
						return array('errCode'=>-11, 'errMsg'=>"您没有选择的配送时间，请进行选择");
					}
				}
			}
		}

		return true;
	}

	public function checkSpecialInvoice()
	{
		global $ProductForNongHang;

		//订单中包含农行商品
		foreach ($this->order_products as $_products) {
			foreach ($_products as $p_info) {
				if (in_array($p_info['product_id'], $ProductForNongHang)) {
					$this->order_data['isVat'] = self::NO_INVOICE; //则不开发票
				}
			}
		}

		if (0 == $this->order_data['isVat']) { //如果不需要开发票，那么其他字段也置为空
			$this->order_data['invoiceType'] = '';
			$this->order_data['invoiceTitle'] = '';
			$this->order_data['invoiceContent'] = '';
		}

		if ($this->order_data['invoiceType'] != INVOICE_TYPE_VAT) {
			$this->order_data['invoiceCompanyName'] = '';
			$this->order_data['invoiceCompanyAddr'] = '';
			$this->order_data['invoiceCompanyTel'] = '';
			$this->order_data['invoiceTaxno'] = '';
			$this->order_data['invoiceBankNo'] = '';
			$this->order_data['invoiceBankName'] = '';
		}
		else {
			$this->order_data['invoiceTitle'] = $this->order_data['invoiceCompanyName'];
		}
	}

	public function getNewOrderIds($num)
	{
		$generate_count = $num > 1 ? $num + 1 : 1;

		$id_seed = IIdGenerator::getNewId('so_sequence', $generate_count);
		if (!$id_seed || $id_seed <= 0) {
			EL_Errors::err(IIdGenerator::$errCode, IIdGenerator::$errMsg);
			return false;
		}

		$parent_id = $id_seed; //parent order id
		$sub_ids = array(); //sub orders id

		if ($num > 1) {
			//multiple orders
			for ($i = 1; $i <= $num; $i++) {
				$sub_ids[] = $parent_id + $i;
			}

			$last_id = $parent_id + $num;
		}
		else {
			//single order
			$sub_ids[] = $parent_id;
			$last_id = $parent_id;
		}

		return array(
			'parent_id' => $parent_id,
			'sub_ids' => $sub_ids,
			'last_id' => $last_id,
		);
	}

	public function addParentOrderRecord($_order_id, $orders_count, $cash, $order_ship_price, $order_price, $total_cut, $promotion_point_used, $cash_point_used)
	{
		$isPayed = $cash <= 0 ? 1 : 0;
		$new_item = array (
			'order_char_id'=> $this->parent_order_char_id,
			'order_id'=> $_order_id,
			'status'=> 0,
			'flag'=> 0,
			'uid'=> $this->uid,
			'hw_id'=> $this->site_id,
			'order_date'=> $this->now_time,
			'source'=> 0,
			'type'=> 0,
			'shipping_cost'=> $order_ship_price,
			'premium_cost'=> 0,
			'shipping_type'=> $this->order_data['shipType'],
			'pay_time'=> 0,
			'pay_type'=> $this->order_data['payType'],
			'prcd_cost'=> 0, //手续费
			'order_cost'=> $order_ship_price + $order_price + $total_cut, //运费+商品总价+（随心配）
			'price_cut'=> $total_cut,
			'coupon_type'=> $this->coupon_info['type'],
			'coupon_code'=> $this->coupon_info['code'],
			'coupon_amt'=> $this->coupon_info['amt'],
			'point'=> 0,
			'point_pay'=> $this->order_data['point'],
			'promotion_point'=> $promotion_point_used,
			'cash_point'=> $cash_point_used,
			'cash'=> $cash,
			'receiver'=> $this->order_data['receiver'],
			'receiver_tel'=> $this->order_data['receiverTel'],
			'receiver_mobile'=> $this->order_data['receiverMobile'],
			'receiver_zip'=> $this->order_data['zipCode'],
			'receiver_addr_id'=> $this->order_data['receiveAddrId'],
			'receiver_addr'=> $this->order_data['receiveAddrDetail'],
			'expect_dly_date'=> 0,
			'expect_dly_time_span'=> 0,
			'deliveryMemo'=> '',
			'comment'=> $this->order_data['comment'],
			'update_time'=> $this->now_time,
			'isPayed'=> $isPayed,
			'out_time' => 0,
			'sign_by_other' => $this->order_data['sign_by_other'],
			'ls' => isset($this->order_data['ls'])? $this->order_data['ls'] : '',
			'cpsinfo' => isset($this->order_data['cpsinfo'])? $this->order_data['cpsinfo'] : '',
			'synFlag' => 0, //父订单不同步给ERP
			'visitkey'=>$this->order_data['visitkey'],
			'pOrderId' => $this->parent_order_char_id,
			'subOrderNum' => $orders_count,
			'stockNo' => 0,
			'shop_guide_id' => isset($this->order_data['shopGuideId'])? $this->order_data['shopGuideId'] : 0,
			'shop_guide_name' => isset($this->order_data['shopGuideName']) ? $this->order_data['shopGuideName'] : '',
			'shop_guide_cost' => isset($this->order_data['shopPrice']) ? $this->order_data['shopPrice'] : 0,
			'shop_id' => isset($this->order_data['shopId'])? $this->order_data['shopId'] : 0,
			'is_vat' => $this->order_data['isVat'],
		);

		$ret = $this->ms_transaction->insert('ICSON_ORDER_CORE', "t_orders_{$this->order_db_table_index}", $new_item, false, $this->uid);
		if (false === $ret) {
			EL_Errors::err(-2033, "code:{$this->ms_transaction->code},msg:{$this->ms_transaction->msg}");
			return false;
		}

		return true;
	}

	public function makeItemAndFreeMatchFeed()
	{
		//获取随心配id
		//插入随心配表
		$match_count = 0;
		$items_count = 0;
		foreach ($this->order_products as $_products) {
			foreach ($_products as $p_info) {
				$items_count++;
				if ($p_info['type'] != SHOPPING_CART_PRODUCT_TYPE_NORMAL || $p_info['main_product_id'] == 0) {
					continue;
				}
				$match_count++;
			}
		}

		if ($match_count > 0) {
			$this->match_id_seed = IIdGenerator::getNewId('SO_SaleRule_Sequence', $match_count);
			if (!$this->match_id_seed) {
				EL_Errors::err(-2036, '获取订单随心配seq失败' . IIdGenerator::$errMsg);
				return false;
			}
		}

		//获取订单商品的seqid
		$this->item_id_seed = IIdGenerator::getNewId('So_Item_Sequence', $items_count);
		if (!$this->item_id_seed) {
			EL_Errors::err(-2047, '获取订单商品id失败' . IIdGenerator::$errMsg);
			return false;
		}

		return true;
	}

	public function addSubOrderRecord($_order_id, $_invoice_id, $order_products, $product_stocks, $order_key, $items_map_in_cart, $products_rules)
	{
		global $_StockToStation;

		$this->order_records[$order_key]['orderId'] = $_order_id; //clark记录订单ID

		$order_char_id = sprintf("%s%09d", "1", $_order_id % 1000000000);

		//计算每个订单中使用的单品促销的规则以及次数
		$single_promotion_info = '';
		foreach ($order_products as $p_info) {
			if (!empty($products_rules[$p_info['product_id']]) ) {
				//开始组装$single_promotion_info的值
				$rule_info = $products_rules[$p_info['product_id']];
				foreach ($rule_info['coupons_name'] as $name) {
					$single_promotion_info = $single_promotion_info . $name . " x " . $rule_info['count'] . "张;" ;
				}
			}
		}

		//货票分离
		$bits = 0;
		if ($this->order_data['separateInvoice'] == 1) {
			$bits = $bits | ORDER_SEPARATE_GOODS_INVOICE;
			$ret = $this->addSeparateInvoice($_order_id, $order_char_id, $order_key);
			if (!$ret) {
				return false;
			}
		}

		//订单基本信息
		$ret = $this->addSubOrderBaseInfo($_order_id, $order_char_id, $order_key, $this->order_records[$order_key], $single_promotion_info, $bits);
		if (!$ret) {
			return false;
		}

		//发票
		$ret = $this->addOrderInvoice($order_char_id, $_invoice_id);
		if (!$ret) {
			return false;
		}

		$_inserter = $this->getInserter();
		foreach ($order_products as $p_info) {
			$p_detail = $this->product_list[$p_info['product_id']];

			//如果是随心配 插入随心配
			if ($p_info['type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL && $p_info['main_product_id'] != 0) {
				$ret = $this->addFreeMatch($this->match_id_seed, $_order_id, $p_info);
				if (!$ret) {
					return false;
				}
				$this->match_id_seed++;
			}

			$buy_count_positive = $p_info['buy_count'];
			$buy_count_negative = $p_info['buy_count'] * (-1);
			foreach ($product_stocks as $pstock) {
				if ($order_key != $pstock['StockSysNo']) {
					continue;
				}

				if ($p_info['product_id'] == $pstock['ProductSysNo']) {
					if ($pstock['AvailableQty'] + $pstock['VirtualQty'] >= $p_info['buy_count']) {	//可用大于购买数量
						$ret = $this->updateStock($_order_id, $order_key, $p_info, $buy_count_negative, $buy_count_positive, $_inserter);
						if (!$ret) {
							return false;
						}
					}
					//上海站普通正常商品允许建虚库
					elseif (($this->site_id == 1) && (($p_detail['flag'] & FORBID_SET_VIRTUAL) != FORBID_SET_VIRTUAL) && ($p_detail['type'] == PRODUCT_TYPE_NORMAL) && $_StockToStation[$order_key] == $this->site_id) {
						$ret = $this->updateVirtualStock($_order_id, $order_char_id, $order_key, $p_info, $buy_count_negative, $buy_count_positive, $_inserter);
						if (!$ret) {
							return false;
						}
					}
					else {
						//深圳，北京暂不支持建虚库
						EL_Errors::err(-2099, '商品'.$p_detail['name']."库存不足");
						return array('errCode'=>-15, 'errMsg'=>"抱歉，{$p_detail['name']}商品库存不足，请减少购买数量");
					}

					//插入订单-商品映射表
					$ret = $this->addProductItem($order_char_id, $this->item_id_seed, $items_map_in_cart, $p_info, $order_key, $pstock);
					if (!$ret) {
						return false;
					}

					$this->item_id_seed++;

					if (!empty($products_rules[$p_info['product_id']])) {
						$product_rule = $products_rules[$p_info['product_id']];
						$this->items_in_promotion[$order_char_id][$p_info['product_id']]['count'] = $product_rule['count'];
						$this->items_in_promotion[$order_char_id][$p_info['product_id']]['rule_id'] = $product_rule['rule_id'];
					}

					break;
				}
			}
		}

		return true;
	}

	public function addSeparateInvoice($_order_id, $order_char_id, $order_key)
	{
		$newInvAddr = array(
			'order_char_id'	=> $order_char_id,
			'order_id'		 => $_order_id,
			'uid'			  => $this->uid,
			'receiver'		 => $this->order_data['invoiceReceiver'],
			'receiver_tel'	 => $this->order_data['invoiceReceiverTel'],
			'receiver_mobile'  => $this->order_data['invoiceReceiverMobile'],
			'receiver_zip'	 => $this->order_data['invoicezipCode'],
			'receiver_addr_id' => $this->order_data['invoiceReceiveAddrId'],
			'receiver_addr'	=> $this->order_data['invoiceReceiveAddrDetail'],
			'shipping_type'	=> YT_DELIVERY, //目前只支持圆通
			'shipping_cost'	=> 1000, //分为单位
			'order_date'	   => $this->now_time,
			'wh_id'			=> $this->site_id,
			'stockNo'		  => $order_key,
		);

		$ret = $this->ms_transaction->insert('ICSON_ORDER_CORE', "t_order_invoice_address_{$this->order_db_table_index}", $newInvAddr, false, $this->uid);
		if (false === $ret) {
			EL_Errors::err(-2050, "code:{$this->ms_transaction->code},msg:{$this->ms_transaction->msg}");
			return false;
		}

		return true;
	}

	public function addSubOrderBaseInfo($_order_id, $order_char_id, $order_key, $order_item, $single_promotion_info, $bits)
	{
		$cash = $order_item['orderPrice']
			+ $order_item['orderShipPrice']
			- (isset($order_item['couponamt']) ? $order_item['couponamt'] : 0)
			- (isset($order_item['point']) ? $order_item['point'] : 0);
		$isPayed = ($cash <= 0 ? 1:0);

		$new_item = array(
			'order_char_id'=> $order_char_id,
			'order_id'=> $_order_id,
			'status'=> 0,
			'flag'=> isset($order_item['flag']) ? $order_item['flag'] : 0,
			'uid'=> $this->uid,
			'hw_id'=> $this->site_id,
			'order_date'=> $this->now_time,
			'source'=> 0,
			'type'=> 0,
			'shipping_cost'=> $order_item['orderShipPrice'],
			'premium_cost'=> 0,
			'shipping_type'=> $this->order_data['shipType'],
			'pay_time'=> 0,
			'pay_type'=> $this->order_data['payType'],
			'prcd_cost'=> 0, //手续费
			'order_cost'=> $order_item['orderPrice'] + $order_item['orderShipPrice'] + (isset($order_item['totalCut'])?$order_item['totalCut']:0),//运费+商品总价+（随心配）
			'price_cut'=> isset($order_item['totalCut'])?$order_item['totalCut']:0,
			'coupon_type'=> $this->coupon_info['type'],
			'coupon_code'=> $this->coupon_info['code'],
			'coupon_amt'=> isset($order_item['couponamt']) ? $order_item['couponamt'] : 0,
			'point'=> 0,
			'point_pay'=> isset($order_item['point']) ? $order_item['point'] : 0,
			'cash_point'=> isset($order_item['cash_point']) ? $order_item['cash_point'] : 0,
			'promotion_point'=> isset($order_item['promotion_point']) ? $order_item['promotion_point'] : 0,
			'cash'=> $cash,
			'receiver'=> $this->order_data['receiver'],
			'receiver_tel'=> $this->order_data['receiverTel'],
			'receiver_mobile'=> $this->order_data['receiverMobile'],
			'receiver_zip'=> $this->order_data['zipCode'],
			'receiver_addr_id'=> $this->order_data['receiveAddrId'],
			'receiver_addr'=> $this->order_data['receiveAddrDetail'],
			'expect_dly_date'=> strtotime($this->order_data['suborders'][$order_key]['expectDate']),
			'expect_dly_time_span'=> $this->order_data['suborders'][$order_key]['expectSpan'],
			'deliveryMemo'=> isset($this->order_data['suborders'][$order_key]['arrived_limit_time']) ? $this->order_data['suborders'][$order_key]['arrived_limit_time'] : '',
			'comment'=> $this->order_data['comment'],
			'update_time'=> $this->now_time,
			'isPayed'=> $isPayed,
			'out_time' => 0,
			'sign_by_other' => $this->order_data['sign_by_other'],
			'ls' => isset($this->order_data['ls']) ? $this->order_data['ls'] : '',
			'cpsinfo' => isset($this->order_data['cpsinfo']) ? $this->order_data['cpsinfo'] : '',
			'synFlag' => 1,
			'visitkey'=>isset($this->order_data['visitkey']) ? $this->order_data['visitkey'] : '',
			'pOrderId' => $this->parent_order_char_id,
			'subOrderNum' => 0,
			'stockNo' => $order_key,
			'shop_guide_id' => isset($this->order_data['shopGuideId']) ? $this->order_data['shopGuideId'] : 0,
			'shop_guide_name' => isset($this->order_data['shopGuideName']) ? $this->order_data['shopGuideName'] : '',
			'shop_guide_cost' => isset($this->order_data['suborders'][$order_key]['shopPrice']) ? $this->order_data['suborders'][$order_key]['shopPrice'] : 0,
			'shop_id' => isset($this->order_data['shopId']) ? $this->order_data['shopId'] : 0,
			'customer_ip' => ToolUtil::getClientIP(),
			'is_vat' => $this->order_data['isVat'],
			'single_promotion_info' => $single_promotion_info,
			'bits' => $bits,
		);

		$ret = $this->ms_transaction->insert('ICSON_ORDER_CORE', "t_orders_{$this->order_db_table_index}", $new_item, false, $this->uid);
		if (false === $ret) {
			EL_Errors::err(-2033, "code:{$this->ms_transaction->code},msg:{$this->ms_transaction->msg}");
			return false;
		}

		return true;
	}

	public function addOrderInvoice($order_char_id, $_invoice_id)
	{
		$newInvoice = array(
			'user_invoice_id'=> $this->order_data['invoiceId'],
			'order_char_id'=> $order_char_id,
			'uid'=> $this->uid,
			'type'=> $this->order_data['invoiceType'],
			'title'=> $this->order_data['invoiceTitle'],
			'name'=> $this->order_data['invoiceCompanyName'],
			'addr'=> $this->order_data['invoiceCompanyAddr'],
			'phone'=> $this->order_data['invoiceCompanyTel'],
			'taxno'=> $this->order_data['invoiceTaxno'],
			'bankno'=> $this->order_data['invoiceBankNo'],
			'bankname'=> $this->order_data['invoiceBankName'],
			'content'=> $this->order_data['invoiceContent'],
			'updatetime'=> $this->now_time,
			'wh_id' => $this->site_id,
			'auto_id'=> $_invoice_id,
		);

		$ret = $this->ms_transaction->insert('ICSON_ORDER_CORE', "t_order_invoice_{$this->order_db_table_index}", $newInvoice, false, $this->uid);
		if (false === $ret) {
			EL_Errors::err(-2050, "code:{$this->ms_transaction->code},msg:{$this->ms_transaction->msg}");
			return false;
		}

		return true;
	}

	public function addFreeMatch($match_id, $_order_id, $p_info)
	{
		$sql = "insert into t_order_match_{$this->order_db_table_index} values($match_id, '{$_order_id}', {$p_info['product_id']}, {$p_info['main_product_id']},{$p_info['matchNum']}, {$p_info['cashCutPerItem']}, $this->now_time, $this->site_id )";

		$ret = $this->ms_transaction->execute('ICSON_ORDER_CORE', $sql, false, $this->uid);
		if (false === $ret) {
			EL_Errors::err(-2036, "code:{$this->ms_transaction->code},msg:{$this->ms_transaction->msg}");
			return false;
		}

		return true;
	}

	public function updateStock($_order_id, $order_key, $p_info, $buy_count_negative, $buy_count_positive, $_inserter)
	{
		$sql = "update Inventory_stock set AvailableQty = AvailableQty - {$p_info['buy_count']}, OrderQty = OrderQty + {$p_info['buy_count']}, rowModifydate='{$this->now_date}' where AvailableQty+VirtualQty>={$p_info['buy_count']} AND ProductSysNo={$p_info['product_id']} and StockSysNo=$order_key";

		$ret = $this->ms_transaction->execute('Inventory_Manager', $sql, true);
		$cnt = $this->ms_transaction->getAffectedRows('Inventory_Manager');
		if ((false === $ret) || (1 != $cnt)) {
			EL_Errors::err(-2047, "扣减ms sql库存失败({$p_info['product_id'] }),code:{$this->ms_transaction->code},msg:{$this->ms_transaction->msg}");
			return false;
		}

		//ixiuzeng添加，将Inventroy_Stock的库存修改记录插入到Inventory_Flow表中
		$sql = "insert into Inventory_Flow values
				($order_key, {$p_info['product_id']}, 1, $_order_id, 2, $buy_count_negative,'$this->now_date', '$this->now_date',$_inserter),
				($order_key, {$p_info['product_id']}, 1, $_order_id, 4, $buy_count_positive,'$this->now_date', '$this->now_date',$_inserter)";

		$ret = $this->ms_transaction->execute('Inventory_Manager', $sql, true);
		if (false === $ret) {
			EL_Errors::err(-2046, "插入ms sql-Inventory_Flow表失败({$p_info['product_id'] }),code:{$this->ms_transaction->code},msg:{$this->ms_transaction->msg}");
			return false;
		}

		return true;
	}

	public function updateVirtualStock($_order_id, $order_char_id, $order_key, $p_info, $buy_count_negative, $buy_count_positive, $_inserter)
	{
		//扣库存
		$sql = "update Inventory_stock set AvailableQty = AvailableQty - {$p_info['buy_count']}, VirtualQty=VirtualQty + {$p_info['buy_count']}, OrderQty = OrderQty + {$p_info['buy_count']} , rowModifydate='{$this->now_date}' where ProductSysNo={$p_info['product_id']} and StockSysNo=$order_key";

		$ret = $this->ms_transaction->execute('Inventory_Manager', $sql, true);
		$cnt = $this->ms_transaction->getAffectedRows('Inventory_Manager');
		if ((false === $ret) || (1 != $cnt)) {
			EL_Errors::err(-2048, "扣减ms sql库存失败({$p_info['product_id'] }),code:{$this->ms_transaction->code},msg:{$this->ms_transaction->msg}");
			return false;
		}

		//ixiuzeng 添加，将 Inventroy_Stock 的库存修改记录插入到 Inventory_Flow 表中
		$sql = "insert into Inventory_Flow values
				($order_key, {$p_info['product_id']}, 1, $_order_id, 2, $buy_count_negative,'$this->now_date', '$this->now_date',$_inserter),
				($order_key, {$p_info['product_id']}, 1, $_order_id, 4, $buy_count_positive,'$this->now_date', '$this->now_date',$_inserter),
				($order_key, {$p_info['product_id']}, 1, $_order_id, 5, $buy_count_positive,'$this->now_date', '$this->now_date',$_inserter)";

		$ret = $this->ms_transaction->execute('Inventory_Manager', $sql, true);
		if (false === $ret) {
			EL_Errors::err(-2045, "插入ms sql-Inventory_Flow表失败({$p_info['product_id'] }),code:{$this->ms_transaction->code},msg:{$this->ms_transaction->msg}");
			return false;
		}

		//插入虚库表
		$virtual_stock_id_seed = IIdGenerator::getNewId('SO_ProductVirtue_Sequence');
		if (!$virtual_stock_id_seed) {
			EL_Errors::err(-2089, '获取订单虚库记录sql失败' . IIdGenerator::$errMsg);
			return false;
		}

		//插入虚库单 导单时导入ERP ERP会处理
		$sql = "insert into t_order_virtual_stock_{$this->order_db_table_index} values($virtual_stock_id_seed, '$order_char_id', {$p_info['product_id']}, {$p_info['buy_count']}, 0, $this->now_time, $this->site_id)";

		$ret = $this->ms_transaction->execute('ICSON_ORDER_CORE', $sql, false, $this->uid);
		if (false === $ret) {
			EL_Errors::err(-2049, "code:{$this->ms_transaction->code},msg:{$this->ms_transaction->msg}");
			return false;
		}

		return true;
	}

	public function addProductItem($order_char_id, $item_id, $items_map_in_cart, $p_info, $order_key, $pstock)
	{
		$p_detail = $this->product_list[$p_info['product_id']];
		$point_type = isset($p_detail['point_type']) ? $p_detail['point_type'] : 0;
		$point = isset($p_detail['point']) ? $p_detail['point'] : 0;
		$cost_price = isset($p_detail['cost_price']) ? $p_detail['cost_price'] : 0;
		$price = isset($p_detail['price']) ? $p_detail['price'] : 0;

		$cash_back = empty($items_map_in_cart[$p_info['product_id']]['cash_back']) ? 0 : $items_map_in_cart[$p_info['product_id']]['cash_back'];
		$useVirtualStock = $pstock['AvailableQty'] + $pstock['VirtualQty'] >= $p_info['buy_count'] ? 0 : 1;
		$discount = intval( ( ( ($p_info['type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL && $p_info['main_product_id'] > 0)? $p_info['matchNum'] * $p_info['cashCutPerItem'] : 0) + $cash_back) / $p_info['buy_count']);

		$_item = array(
			'item_id' => $item_id,
			'order_char_id' => $order_char_id,
			'wh_id' => $this->site_id,
			'product_id' => $p_info['product_id'],
			'product_char_id' => $p_detail['product_char_id'],
			'uid' => $this->uid,
			'name' => $p_detail['name'],
			'flag' => $p_detail['flag'],
			'type' => $p_detail['type'],
			'type2' => $p_detail['type2'],
			'weight' => $p_detail['weight'],
			'buy_num' => $p_info['buy_count'],
			'points' => $point * $p_info['buy_count'],
			'points_pay' => 0,
			'point_type' => $point_type,
			'price' => ($p_info['type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL) ? $price : 0,
			'discount' => $discount,
			'cash_back' => (($p_info['main_product_id'] > 0 && $p_info['type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL)? $p_info['cashCutPerItem']:0) + $cash_back,
			'cost' => $cost_price,
			'warranty' => $p_detail['warranty'],
			'expect_num' => 0,
			'create_time' => $this->now_time,
			'product_type' => $p_info['type'], //0:主商品 1：组件 2：赠品
			'use_virtual_stock' => $useVirtualStock,
			'main_product_id' => isset($p_info['belongto_product_id']) ? $p_info['belongto_product_id']: 0,
			'updatetime' => $this->now_time,
			'edm_code' => isset( $p_detail['edm'])?$p_detail['edm']: '',
			'apportToPm'=>$this->coupon_info['type']==1? (isset($this->coupon_info['subOrders'][$order_key]['apport'][$p_info['product_id']])? ($this->coupon_info['subOrders'][$order_key]['apport'][$p_info['product_id']]) : 0) : 0,
			'apportToMkt' => (isset($this->coupon_info['subOrders'][$order_key]['apport'][$p_info['product_id']])? ($this->coupon_info['subOrders'][$order_key]['apport'][$p_info['product_id']]) : 0),
			'shop_guide_cost' => isset($p_detail['shopPrice']) ? $p_detail['shopPrice'] : 0,
			'OTag' => isset($p_info['OTag'])? $p_info['OTag'] : '',
			'package_ids' => isset($items_map_in_cart[$p_info['product_id']]) ? $items_map_in_cart[$p_info['product_id']]['package_id']: '',
		);

		$ret = $this->ms_transaction->insert('ICSON_ORDER_CORE', "t_order_items_{$this->order_db_table_index}", $_item, false, $this->uid);
		if (false === $ret) {
			EL_Errors::err(-2039, "code:{$this->ms_transaction->code},msg:{$this->ms_transaction->msg}");
			return false;
		}

		//CPS用
		$this->order_items[] = $_item;

		return true;
	}

	/**
	 * 节能补贴申请信息
	 *
	 * @param int $last_order_id
	 *
	 * @return mix
	 */
	public function addEnergySubsidyData($last_order_id)
	{
		$item = array(
			'order_id'   => $last_order_id,
			'type'	  => intval($this->order_data['es_type']),
			'name'	  => $this->order_data['es_name'],
			'idCard'	=> $this->order_data['es_idCard'],
			'timestamp' => $this->now_time,
			'hw_id'	 => $this->site_id,
			'stockNo'   => current(array_keys($this->order_products))
		);

		$ret = $this->ms_transaction->insert('ICSON_CORE', 't_order_energy_subsidy', $item);
		if ((false === $ret) ) {
			EL_Errors::err(-990, "code:{$this->ms_transaction->code},msg:{$this->ms_transaction->msg}");
			return false;
		}

		return true;
	}

	public function commitAll()
	{
		if ($this->coupon_db) {
			$ret = $this->coupon_db->execSql('commit');
			if (!$ret) {
				EL_Errors::err(-11207, 'commit coupon_db failed');
				return false;
			}
		}

		$ret = $this->ms_transaction->commit();
		if (!$ret) {
			EL_Errors::err(-11206, 'commit failed');
			return false;
		}

		return true;
	}

	public function rollbackAll()
	{
		if ($this->coupon_db) {
			$this->coupon_db->execSql('rollback');
			$this->coupon_db = null;
		}

		return $this->ms_transaction->rollback();
	}

	public function getInserter()
	{
		static $_inserter;

		if (!$_inserter) {
			$_local_ip = ToolUtil::getLocalIp(0);
			$_local_ip = explode('.', $_local_ip);
			$_inserter = empty($_local_ip[3]) ? 7 : intval($_local_ip[3]);
		}

		return $_inserter;
	}

	public function getCouponTransaction()
	{
		if (!$this->coupon_db) {
			$instance = ToolUtil::getDBObj('coupon', 0);
			if (empty($instance) ) {
				EL_Errors::err(Config::$errCode, Config::$errMsg);
				return false;
			}

			$ret = $instance->execSql('start transaction');
			if (false === $ret) {
				EL_Errors::err($instance->errCode, $instance->errMsg);
				return false;
			}

			$this->coupon_db = $instance;
		}

		return $this->coupon_db;
	}
}