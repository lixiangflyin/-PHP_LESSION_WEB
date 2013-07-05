<?php
/**
 * 下单工作流模块 - 订单记录
 *
 * @author clydechang
 */
class EA_OrderWork_Order extends EA_OrderWork_Abstract
{
	public function filter($base_params)
	{
		$score_use = $base_params['score_use'];
		$costs = $base_params['costs'];
		$orders_stock_info = $base_params['orders_stock_info'];

		//检查实际支付金额
		$product_cash = $costs['order_price'] - $this->data->order_data['point'] - $this->data->coupon_info['amt'];
		if ( bccomp( $product_cash, 0, 0 ) < 0 ) {
			EL_Errors::err(-2040, '用户实际需要支付的货款金额为负数');
			return false;
		}

		//运费
		//开始计算运费，调用计算运费接口
		$ship_info = array(
			'shipping_id' => $this->data->order_data['shipType'], //配送方式id
			'wh_id'	   => $this->data->site_id, //起始站点
			'destination' => $this->data->order_data['receiveAddrId'], //收货地区
			'order_price' => $product_cash, //订单实际需支付的金额
			'is_mobile'   => isset($this->data->order_data['ls']) && in_array($this->data->order_data['ls'], $this->data->app_link_source), //是否为手机订单
		);
		$order_ship_price = $this->data->getShippingPrice($ship_info);
		if ($order_ship_price === false) {
			return false;
		}

		//校验送货时间
		$ret = $this->data->checkShippingTime($orders_stock_info['orders_has_virtual']);
		if ($ret !== true) {
			return $ret;
		}

		//分摊
		$this->data->divide($score_use['cash'], $costs['order_price']);

		$this->data->order_ship_price = $order_ship_price;
		$this->data->product_cash = $product_cash;

		return array();
	}

	public function execute($base_params, $module_params)
	{
		$exec_result = $this->_execute($base_params, $module_params);
		if (!$exec_result || !empty($exec_result['errCode']) ) {
			if ($this->data->debug) {
				echo "EA_OrderWork_Order rollback..\n";
			}

			$this->data->rollbackAll();
		}

		return $exec_result;
	}

	private function _execute($base_params, $module_params)
	{
		$costs = $base_params['costs'];
		$score_use = $base_params['score_use'];
		$product_stocks = $base_params['product_stocks'];
		$items_map_in_cart = $base_params['items_map_in_cart'];
		$order_id_info = $base_params['order_id_info'];
		$orders_count = $base_params['orders_count'];

		//开始下单，先起事务， 插入orderdb，扣库存，commit事务 或 rollback事务

		//获取订单发票id
		$invoice_id_seed = IIdGenerator::getNewId('so_valueadded_invoice_sequence', $orders_count);
		if (!$invoice_id_seed) {
			EL_Errors::err(IIdGenerator::$errCode, IIdGenerator::$errMsg);
			return false;
		}

		$ret = $this->data->makeItemAndFreeMatchFeed();
		if (!$ret) {
			return false;
		}

		//如果发生了拆单，插入父订单
		if ($orders_count > 1) {
			$cash = $this->data->order_ship_price + $this->data->product_cash;
			$ret = $this->data->addParentOrderRecord($order_id_info['parent_id'], $orders_count, $cash, $this->data->order_ship_price, $costs['order_price'], $costs['total_cut'], $score_use['promotion'], $score_use['cash']);
			if (false === $ret) {
				return false;
			}
		}

		//记录符合单品赠券的商品的信息
		$products_rules = array();
		if (!empty($this->data->order_data['send_coupon_success_info'])) {
			foreach ($this->data->order_data['send_coupon_success_info'] as $key => $rules) {
				$products_rules[$key] =  $rules;
			}
		}

		//插入子订单
		$order_id_cursor = 0;
		foreach ($this->data->order_products as $order_key => $products_in_order) {
			$order_id = $order_id_info['sub_ids'][$order_id_cursor];
			$ret = $this->data->addSubOrderRecord($order_id, $invoice_id_seed, $products_in_order, $product_stocks, $order_key, $items_map_in_cart, $products_rules);
			if (false === $ret) {
				return array('errCode'=>-2051, 'errMsg'=>'抱歉，您的订单提交失败');
			}

			$order_id_cursor++;
			$invoice_id_seed++;
		}

		//如果是节能补贴订单，则将节能补贴申请信息插入对应的表
		if ($costs['is_energy_subsidy_order']) {
			$ret = $this->data->addEnergySubsidyData($order_id_info['last_id']);
			if ($ret === false) {
				return array('errCode'=>-983, 'errMsg'=>'抱歉，您的订单提交失败');
			}
		}

		return true;
	}

	public function rollback()
	{
		return true;
	}
}

