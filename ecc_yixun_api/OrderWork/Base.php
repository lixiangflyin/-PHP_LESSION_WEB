<?php
/**
 * 下单工作流模块 - 基本逻辑
 *
 * @author bennylin
 */
class EA_OrderWork_Base extends EA_OrderWork_Abstract
{
	public function filter()
	{
		$this->data->order_data = EL_Request::post(array(
			'Price' => EL_Request::T_INT,
			'aid' => EL_Request::T_INT,
			'applytimes' => EL_Request::T_INT,
			'buy_one_key' => EL_Request::T_ESCAPE_HTML,
			'comment' => EL_Request::T_ESCAPE_HTML,
			'couponCode' => EL_Request::T_ESCAPE_HTML,
			'cpsinfo' => EL_Request::T_ESCAPE_HTML,
			'es_idCard' => EL_Request::T_ESCAPE_HTML,
			'es_name' => EL_Request::T_ESCAPE_HTML,
			'es_type' => EL_Request::T_INT,
			'ingoreLackOfGift' => EL_Request::T_INT,
			'invoiceBankName' => EL_Request::T_ESCAPE_HTML,
			'invoiceBankNo' => EL_Request::T_ESCAPE_HTML,
			'invoiceCompanyAddr' => EL_Request::T_ESCAPE_HTML,
			'invoiceCompanyName' => EL_Request::T_ESCAPE_HTML,
			'invoiceCompanyTel' => EL_Request::T_ESCAPE_HTML,
			'invoiceContent' => EL_Request::T_ESCAPE_HTML,
			'invoiceId' => EL_Request::T_ESCAPE_HTML,
			'invoiceReceiveAddrDetail' => EL_Request::T_ESCAPE_HTML,
			'invoiceReceiveAddrId' => EL_Request::T_ESCAPE_HTML,
			'invoiceReceiver' => EL_Request::T_ESCAPE_HTML,
			'invoiceReceiverMobile' => EL_Request::T_ESCAPE_HTML,
			'invoiceReceiverTel' => EL_Request::T_ESCAPE_HTML,
			'invoiceTaxno' => EL_Request::T_ESCAPE_HTML,
			'invoiceTitle' => EL_Request::T_ESCAPE_HTML,
			'invoiceType' => EL_Request::T_INT,
			'invoicezipCode' => EL_Request::T_ESCAPE_HTML,
			'isDistribution' => EL_Request::T_BOOL,
			'isVat' => EL_Request::T_INT,
			'ism' => EL_Request::T_INT,
			'ls' => EL_Request::T_ESCAPE_HTML,
			'payType' => EL_Request::T_INT,
			'point' => EL_Request::T_INT,
			'receiveAddrDetail' => EL_Request::T_ESCAPE_HTML,
			'receiveAddrId' => EL_Request::T_ESCAPE_HTML,
			'receiver' => EL_Request::T_ESCAPE_HTML,
			'receiverMobile' => EL_Request::T_ESCAPE_HTML,
			'receiverTel' => EL_Request::T_ESCAPE_HTML,
			'rule_id' => EL_Request::T_INT,
			'send_coupon_record_info' => EL_Request::T_RAW,
			'send_coupon_success_info' => EL_Request::T_RAW,
			'separateInvoice' => EL_Request::T_INT,
			'shipType' => EL_Request::T_INT,
			'shippingPrice' => EL_Request::T_INT,
			'shopGuideId' => EL_Request::T_INT,
			'shopGuideName' => EL_Request::T_ESCAPE_HTML,
			'shopId' => EL_Request::T_INT,
			'shopPrice' => EL_Request::T_INT,
			'sign_by_other' => EL_Request::T_ESCAPE_HTML,
			'suborders' => EL_Request::T_STRING, //json
			//'uid' => EL_Request::T_INT,
			'verifycode' => EL_Request::T_ESCAPE_HTML,
			'visitkey' => EL_Request::T_ESCAPE_HTML,
			'zipCode' => EL_Request::T_INT,
		));

		if (isset($this->data->order_data['comment']) && strlen($this->data->order_data['comment']) > 800) {
			return array('errCode'=>10, 'errMsg'=>"您填写的订单备注过长，请返回修改！");
		}

		//如果使用优惠券，判断用户是否为经销商，若是，则不允许使用优惠券
		global $_USER_TYPE;
		if ($this->data->user_info['type'] == $_USER_TYPE['Dealer'] && isset($this->data->order_data['couponCode']) && $this->data->order_data['couponCode'] != '') {
			return array('errCode'=>15, 'errMsg'=>"您属于分销用户，不能使用优惠券。");
		}

		if (empty($this->data->order_data['suborders'])) {
			EL_Errors::err(10111, "suborders is empty");
			return array('errCode'=>10, 'errMsg'=>"您的购物车中没有商品，请选购！");
		}

		//decode orders
		if (!is_array($this->data->order_data['suborders']) ) {
			$this->data->order_data['suborders'] = json_decode($this->data->order_data['suborders'], true);
		}

		if ($this->data->order_data['suborders'] === false) {
			EL_Errors::err(10112, "suborders json_decode failed");
			return array('errCode'=>10, 'errMsg'=>"您的购物车中没有商品，请选购！");
		}

		if (empty($this->data->order_data['suborders'])) {
			return array('errCode'=>10, 'errMsg'=>"您的购物车中没有商品，请选购！");
		}

		//检查提交的数据 统计客户端提交的商品数量
		$post_items_count = 0;
		foreach ($this->data->order_data['suborders'] as $node) {
			if (!isset($node['items'])) {
				return array('errCode'=>10, 'errMsg'=>"您提交的订单数据有误，请检查！");
			}

			$post_items_count += count($node['items']);
		}

		//先判断优惠券与促销规则不能同时使用
		if (isset($this->order_data['rule_id']) && isset($this->order_data['couponCode']) && $this->order_data['rule_id'] > 0 && $this->order_data['couponCode'] != '') {
			return array('errCode'=> 15, 'errMsg'=> "促销规则与优惠券不能同时使用");
		}
		if (isset($this->order_data['rule_id']) && ($this->order_data['rule_id'] <= 0)) {
			return array('errCode'=> 16, 'errMsg'=> "您提交的促销规则信息不正确，请返回购物车重新选择");
		}

		//检查收货地址
		if (false === $this->data->checkReceiverAddr()) {
			return false;
		}

		//检查运送方式
		if (false === $this->data->checkShippingType()) {
			return false;
		}

		//检查支付方式
		if (false === $this->data->checkPayType()) {
			return false;
		}

		//检查发票
		if (false === $this->data->checkInvoice()) {
			return false;
		}

		//处理单引号等特殊字符 避免SQL注入
		foreach ($this->data->order_data as $k => $no) {
			if (!$no || $k == 'suborders' || $k == 'buy_one_key' || $k == 'send_coupon_success_info' || $k == 'send_coupon_record_info' || is_array($no)) {
				continue;
			}

			$this->data->order_data[$k] = addslashes($no);
		}

		//购物车中获取商品和套餐信息
		$cart_info = $this->data->getCartInfo();
		if (false === $cart_info || !empty($cart_info['errCode']) ) {
			return $cart_info;
		}
		if (empty($cart_info['items']) ) {
			return array('errCode'=>10, 'errMsg'=>"您的购物车中没有商品，请选购！");
		}

		//获取购物车中添加了套餐等信息后的商品信息
		$grouped_items = IPreOrder::splitSuiteItems($cart_info['items'], $cart_info['suiteInfo']);
		if ($grouped_items === false) {
			return array('errCode'=>10, 'errMsg'=>"服务器忙，请稍后再试");
		}

		//建立 pid => 商品信息 MAP
		$items_map_in_cart = $this->data->createItemsMapInCart($grouped_items['items']);

		//如果没有套餐，判断购物车中商品与前台展示的商品数量是一致的
		if (empty($cart_info['suiteInfo'])) {
			if (count($items_map_in_cart) != $post_items_count) {
				EL_Errors::err(-2021, "items count in shoppingcart is not equal to post items count");
				return false;
			}
		}

		//活动促销
		if (isset($this->data->order_data['rule_id'])) {
			$promotion = $this->data->getEventPromotion($items_map_in_cart);
			if ($promotion === false || !empty($promotion['errCode']) ) {
				return $promotion;
			}

			//如果是换购，赠送商品，则需要在items添加一条记录
			if ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_HUANGOU'] || $promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_PRODUCT']) {
				//这里的逻辑需确定是否有使用
				if (!empty($promotion['product_id']) ) {
					$items_map_in_cart[$promotion['product_id']] = array (
						//'product_id' => $promotion['discount'], //这里是不是写错了？
						'product_id' => $promotion['product_id'], //这里原来是discount
						'buy_count' => $promotion['benefit_per_time'] * $promotion['benefit_times'],
						'main_product_id' => 0,
						'createtime' => 0,
						'isPromotionGift'=>true
					);
				}
			}
		}

		//拉取商品信息
		$pids = array();
		foreach ($items_map_in_cart as $item) {
			$pids[] = $item['product_id'];
		}

		$this->data->product_list = IProduct::getProductsInfo($pids, $this->data->site_id, true, true);
		if (!$this->data->product_list) {
			EL_Errors::err(IProduct::$errCode, 'IProduct getProductsInfo failed,msg' . IProduct::$errMsg);
			return false;
		}

		//抢购商品下单频率检查
		$visit_frequency = $this->data->checkVisitFrequency();
		if ($visit_frequency === false || !empty($visit_frequency['errCode']) ) {
			return $visit_frequency;
		}

		//处理多价格信息 这个接口里面有问题，没有任何异常处理
		$ret_mpi = IPreOrder::getMultiPriceInfo($grouped_items['items'], $this->data->site_id, $this->data->product_list, $cart_info['suiteInfo']);
		$this->data->product_list = $ret_mpi['products_mpi']; //含有多价格信息的商品基本信息

		//分销的价格重置
		if ($this->data->order_data['isDistribution']) {
			$this->data->resetDistribution();
		}

		//获取商品&赠品&配件信息结束

		//检查前台传入的商品列表 与 购物车中商品列表是否一致 , 同时检查商品，赠品，组件的状态，禁运类型
		$buy_info = $this->data->getInfoByClientOrders($this->data->order_data['suborders'], $items_map_in_cart);
		if ($buy_info === false || !empty($buy_info['errCode']) ) {
			return $buy_info;
		}
		$all_pids = $buy_info['all_pids'];
		$unshipping_pids = $buy_info['unshipping_pids'];
		$c3ids = $buy_info['c3ids'];
		$can_vat_invoice = $buy_info['can_vat_invoice']; //能否模糊开票，开增值发票
		$this->data->order_products = $buy_info['order_products'];

		//如果是分销订单，不需要验证是否可以开增值税发票
		if (!$this->data->order_data['isDistribution']) {
			if ($can_vat_invoice === false && $this->data->order_data['invoiceType'] == INVOICE_TYPE_VAT) {
				return array('errCode'=>-20, 'errMsg'=>'您的订单中有商品不能开增值税发票');
			}
		}

		//android 深圳站订单发票转换
		if (in_array($this->data->order_data['ls'], array('--android--')) && $this->data->site_id == SITE_SZ ) {
			if ($this->data->order_data['invoiceType'] == INVOICE_TYPE_RETAIL_COMPANY || $this->data->order_data['invoiceType'] == INVOICE_TYPE_RETAIL_PERSONAL) {
				$this->data->order_data['invoiceType'] = INVOICE_TYPE_VAT_NORMAL;
			}
		}

		//如果选择整机服务，不能选择货到付款
		global $_PAY_MODE;
		if ($_PAY_MODE[$this->data->site_id][$this->data->order_data['payType']]['PayTypeName'] == '货到付款') {
			global $_NotPayWhenArrive;
			$bothExist = array_intersect($_NotPayWhenArrive, $all_pids);
			if (count($bothExist) != 0) {
				return array('errCode'=>-22, 'errMsg'=>'您选择了整机安装服务，不能选择货到付款支付方式');
			}
		}

		//如果选择的是上门自提方式，需要检测购物车中存在特定商品
		//检测某些特殊不包含在购物车中，则不能选择自提点
		//如果不包含这些特殊商品，需要剔除自提
		global $_SelfFetchProductids;
		global $_LGT_MODE;
		if (false !== strpos($_LGT_MODE[$this->data->order_data['shipType']]['ShipTypeName'], '上门提货')) {
			$bothExist = array_intersect($_SelfFetchProductids, $all_pids);
			if (count($bothExist) == 0) {
				return array('errCode'=>-29, 'errMsg'=>'对不起，您所购买的商品不能选择上门提货');
			}
		}

		//检查发票可选类型
		if ($this->data->order_data['isVat'] == EA_OrderWork_Data::HAS_INVOICE) {
			$invoinceContent = EA_Invoice::getInvoicesContentOpt($c3ids, $this->data->site_id);
			if (!in_array($this->data->order_data['invoiceContent'], $invoinceContent)) {
				return array('errCode'=>-21, 'errMsg'=>'您提交发票内容不合法');
			}

			// 发票分站
			$whInvoice = EA_Invoice::getInvoicesWhType($this->data->site_id);
			if (!in_array($this->data->order_data['invoiceType'], $whInvoice)) {
				return array('errCode'=> -21, 'errMsg'=> '您提交发票类型不合法');
			}
		}
		//检查前台传入的购物车内容 与 后台购物车内容 一致完毕

		//检查预约 ixiuzeng
		$booking = $this->data->checkBooking($all_pids);
		if ($booking === false || !empty($booking['errCode']) ) {
			return $booking;
		}

		//优惠券检测
		$check_coupon = $this->data->checkCoupon($items_map_in_cart);
		if ($check_coupon === false || !empty($check_coupon['errCode']) ) {
			return $check_coupon;
		}

		//开始计算EDM专享
		//先判断EDM是否需要校验
		$this->data->product_list = IPreOrder::getEDMInfo($this->data->user_info, $this->data->site_id, $this->data->product_list);
		if (false === $this->data->product_list) {
			EL_Errors::err(IPreOrder::$errCode, IPreOrder::$errMsg);
			return false;
		}
		//处理邮件专享价格完毕

		//检查限运规则（放在一切通过之后检查，因为后续检查可能会要求用户返回购物车删除一些商品，导致商品减少）
		$shipping_limit = $this->data->checkShippingLimit();
		if ($shipping_limit === false || !empty($shipping_limit['errCode']) ) {
			return $shipping_limit;
		}

		//检查禁运类型
		$shipping_forbiden = $this->data->checkShippingForbiden($unshipping_pids);
		if ($shipping_forbiden === false || !empty($shipping_forbiden['errCode']) ) {
			return $shipping_forbiden;
		}

		//获取库存信息
		$product_stocks = $this->data->getStocks($all_pids);
		if ($product_stocks === false || !empty($product_stocks['errCode']) ) {
			return $product_stocks;
		}

		//检查库存 得到随心配、组件等
		$orders_stock_info = $this->data->checkStock($product_stocks);
		if ($orders_stock_info === false || !empty($orders_stock_info['errCode']) ) {
			return $orders_stock_info;
		}

		//检查随心配
		$ease_match = $this->data->checkEasyMatch($cart_info['suiteInfo']);
		if ($ease_match === false || !empty($ease_match['errCode']) ) {
			return $ease_match;
		}

		//计算价格
		$costs = $this->data->calculateCosts($items_map_in_cart);
		if ($costs === false || !empty($costs['errCode']) ) {
			return $costs;
		}

		//预处理特殊发票信息
		$this->data->checkSpecialInvoice();

		//积分
		$score_use = $this->data->checkUseScore($costs['point_min'], $costs['point_max']);
		if ($score_use === false || !empty($score_use['errCode']) ) {
			return $score_use;
		}

		//获取新订单号
		$orders_count = count($this->data->order_records);
		$order_id_info = $this->data->getNewOrderIds($orders_count);
		if (!$order_id_info) {
			return false;
		}

		$this->data->parent_order_char_id = sprintf("%s%09d", "1", $order_id_info['parent_id'] % 1000000000);

		return array(
			//'order_ship_price' => $order_ship_price,
			//'product_cash' => $product_cash,
			'costs' => $costs,
			'score_use' => $score_use,
			'product_stocks' => $product_stocks,
			'items_map_in_cart' => $items_map_in_cart,
			'promotion' => $promotion,
			//'rule_discount' => $rule_discount,
			'order_id_info' => $order_id_info,
			'orders_count' => $orders_count,
			'orders_stock_info' => $orders_stock_info,
		);
	}

	public function execute()
	{
		return true;
	}

	public function rollback()
	{
		//回滚所有事务
		return $this->data->rollbackAll();
	}
}
