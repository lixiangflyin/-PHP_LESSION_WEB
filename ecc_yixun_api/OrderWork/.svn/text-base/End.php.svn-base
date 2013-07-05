<?php
/**
 * 下单工作流模块 - 订单提交结束后处理的逻辑
 *
 * @author bennylin
 */
class EA_OrderWork_End extends EA_OrderWork_Abstract
{
	public function filter()
	{
		return array();
	}

	public function execute($base_params)
	{
		//提交事务
		$ret = $this->data->commitAll();
		if (!$ret) {
			//失败时，如果使用了积分，则回滚
			if ($this->data->order_data['point'] > 0) {
				return array('errCode'=>-988, 'errMsg'=>'抱歉，您的订单提交失败，本单使用的积分将在1个小时内返还到您的账户');
			}

			return array('errCode'=>-988, 'errMsg'=>'抱歉，您的订单提交失败');
		}

		//commit success
		$this->onSubmitSuccess($base_params['order_id_info']['sub_ids']);

		//format response data
		return $this->getResponseData($base_params);
	}

	private function onSubmitSuccess($order_ids)
	{
		// 上报促销规则使用记录
		if (isset($this->data->order_data['rule_id']) && $this->data->order_data['rule_id']> 0) {
			foreach ($order_ids as $_order_id) {
				DataReport::report(3001, DATA_TYPE_1DAY, array($this->data->site_id, $_order_id, $this->data->order_data['rule_id'], $this->data->user_info['level'],$this->data->uid));
			}
		}

		//写下用户购买单品赠券信息
		if (isset($this->data->order_data['send_coupon_record_info']) && $this->data->order_data['send_coupon_record_info'] != ''){
			$ret = EA_Promotion::setUserJoinedRecord($this->data->uid, $this->data->now_time, $this->data->order_data['send_coupon_record_info'], $this->data->items_in_promotion);
		}

		// 上报百度sem数据
		if (isset($_COOKIE['mediav_data']) && $_COOKIE['mediav_data'] != '') {
			$mediv_data = explode('|', $_COOKIE['mediav_data']);

			// 分隔符前面为sem数据
			$sem_data = $mediv_data[0];

			// 分隔符后面为用户进入网站的时间
			$sem_time = $mediv_data[1];

			// 与现在间隔时间小于7天的才上报
			if ($this->data->now_time - $sem_time  < 7*24*60*60 ) {
				foreach ($this->data->order_records as $stockNo=>$o) {
					// 上报所有订单
					DataReport::report(3201, DATA_TYPE_1DAY, array($this->data->site_id, $o['orderId'], $stockNo, $sem_data));
				}
			}
		}

		//删除购物车
		if (!(isset($this->data->order_data['buy_one_key']) && true === $this->data->order_data['buy_one_key'])) {
			if (!$this->data->debug) {
				IShoppingCart::clear($this->data->uid);
			}
		}

		//更新用户地址信息中默认支付方式，默认发票
		IUserAddressBookTTC::update(
			array(
				'uid'=>$this->data->uid,
				'default_shipping'=>$this->data->order_data['shipType'],
				'default_pay_type'=>$this->data->order_data['payType'],
				'last_use_time'=> $this->data->now_time,
				'iid'=>$this->data->order_data['invoiceId']
			),
			array('aid'=>$this->data->order_data['aid'])
		);

		//发送短信通知
		if ($this->data->order_data['point'] > 1000) {
			$info = IUsersTTC::get($this->data->uid);
			if ($info === false){
				EL_Errors::err(1, "发送短信：获取用户信息失败");
			}
			elseif (!empty($info[0]['mobile'])){
				$mobile = $info[0]['mobile'];
				$time = date("Y-m-d H:i:s");
				$ret = IMessage::sendSMSMessage($mobile, "您的易迅网账户于" . $time ."下单并使用积分" . $this->data->order_data['point']/10 ."个。订单号" . $this->data->parent_order_char_id ."。如有疑问请致电400-828-1878");
				if (false === $ret) {
					EL_Errors::err(1, "发送短信：发送信息失败：" . IMessage::$errMsg);
				}
			}
		}
	}

	private function getResponseData($params)
	{
		global $_PAY_MODE;

		$order_id_info = $params['order_id_info'];
		$orders_count = $params['orders_count'];
		$costs = $params['costs'];

		$resp_data = array(
			'errCode' => 0,
			'uid' => $this->data->uid,
			'orderId' => $this->data->parent_order_char_id,
			'orderAmt' => $this->data->order_ship_price + $costs['order_price'] - $this->data->order_data['point'] - $this->data->coupon_info['amt'],
			'payType' => $this->data->order_data['payType'],
			'payTypeIsOnline' => $_PAY_MODE[$this->data->site_id][$this->data->order_data['payType']]['IsNet'],
			'payTypeName' => $_PAY_MODE[$this->data->site_id][$this->data->order_data['payType']]['PayTypeName'],
			'orderTotalAmt' => $this->data->order_ship_price + $costs['order_price'], //订单总金额
			'payGoodsAmt' => $this->data->product_cash, //订单客户支付的金额（去掉运费和享受到的其它优惠后的用户实际支付金额）
			'orderCreateTime' => $this->data->now_time,
			'isParentOrder' => $orders_count > 1 ? true : false,
			'isVATInvoice' => ($this->data->order_data['invoiceType'] == INVOICE_TYPE_VAT) ? true : false,
			'order_items' => $this->data->order_items, //CPS 需要用到
			'subOrderIdStr' => implode(',', $order_id_info['sub_ids']), //传出去 CPS 跟单
			'subOrders' => $this->data->order_records, //传出去 CPS 跟单
		);

		return $resp_data;
	}

	public function rollback()
	{
		return true;
	}
}
