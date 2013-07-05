<?php
/**
 * 下单工作流模块 积分
 *
 * @author flycgu
 */
class EA_OrderWork_Promotion extends EA_OrderWork_Abstract
{
	public function filter($base_params)
	{
		$promotion = $base_params['promotion'];
		$items_map_in_cart = $base_params['items_map_in_cart'];

		//通过活动促销规则信息 获取抵扣额
		$rule_discount = $this->data->getDiscount($promotion);

		//如果使用了促销规则，换成优惠券
		if (isset($promotion['benefit_type'])) {
			$this->data->benefitToCoupon($promotion, $rule_discount, $items_map_in_cart);
		}

		return array(
			'rule_discount' => $rule_discount,
		);
	}

	public function execute($base_params, $module_params)
	{
		$rule_discount = $module_params['rule_discount'];

		$promotion = $base_params['promotion'];
		$order_id_info = $base_params['order_id_info'];

		//如果使用了促销规则，扣减筹码
		if (isset($promotion['benefit_type'])) {
			$ret = $this->updateOrderBenifit($promotion, $rule_discount);
			if ($ret === false) {
				return false;
			}
		}

		//更新优惠券
		if (!empty($this->data->order_data['couponCode'])) {
			$ret = $this->updateCoupon($order_id_info['sub_ids']);
			if ($ret === false) {
				return array('errCode'=>-985, 'errMsg'=>'抱歉，您的订单提交失败');
			}
		}

		return true;
	}

	public function rollback()
	{
		return true;
	}

	private function updateOrderBenifit($promotion, $rule_discount)
	{
		if ($promotion['benefit_type'] == IPromotionRule::$BenfitType['BENEFIT_TYPE_COUPON']) {
			$sql = "update t_promotion_source set benfit_used=benfit_used+{$promotion['benefit_times']} where source_id={$promotion['source_id']} and status=0 and benfit_total >= (benfit_used +{$promotion['benefit_times']})";
		}
		else {
			$sql = "update t_promotion_source set benfit_used=benfit_used+{$rule_discount} where source_id={$promotion['source_id']} and status=0 and benfit_total >= (benfit_used +$rule_discount)";
		}

		$ret = $this->data->ms_transaction->execute('ICSON_CORE', $sql, true);
		if (false === $ret) {
			EL_Errors::err(-989, "code:{$this->data->ms_transaction->code},msg:{$this->data->ms_transaction->msg}");
			return false;
		}

		if ($this->data->ms_transaction->getAffectedRows('ICSON_CORE') < 1) {
			EL_Errors::err(-987, '抱歉，您参加的活动已结束或终止，请您返回购物车重新操作');
			return false;
		}

		//如果是送积分，优惠券，还需要执行向用户帐号里发放积分，优惠券
		if (IPromotionRule::$BenfitType['BENEFIT_TYPE_POINT'] == $promotion['benefit_type']) {
			//
		}
		elseif (IPromotionRule::$BenfitType['BENEFIT_TYPE_COUPON'] == $promotion['benefit_type']) {
			$couponFetch = array();
			$batches = explode(',', $promotion['discount']);
			foreach ($batches as $batch) {
				$couponFetch[$batch] = $promotion['benefit_times'];
			}

			//get coupon transaction
			$coupon_db = $this->data->getCouponTransaction();
			if (false === $coupon_db) {
				return false;
			}

			$ret = ICoupon::fetchCoupons($this->data->uid, $couponFetch, $coupon_db, (isset($this->data->user_info['level']) ? $this->data->user_info['level'] : -1) );
			if (false === $ret) {
				if (ICoupon::$errCode == -106) {
					EL_Errors::tmp(-987, '抱歉，您参加的活动已结束或终止，请您返回购物车重新操作');
					return false;
				}

				EL_Errors::err(ICoupon::$errCode, ICoupon::$errMsg);
				return false;
			}

			$couponids = '';
			foreach ($ret as $promotionCode) {
				$couponids .= implode(',', $promotionCode) . ',';
			}

			if (!empty($couponids) ) {
				$_item = array('rule_benefit'=>$couponids);
				$ret = $this->data->ms_transaction->update('ICSON_ORDER_CORE', "t_orders_{$this->data->order_db_table_index}", $_item, "order_char_id='{$this->data->parent_order_char_id}' and uid={$this->data->uid}", false, $this->data->uid);
				if (false === $ret) {
					EL_Errors::err(-2055, "code:{$this->data->ms_transaction->code},msg:{$this->data->ms_transaction->msg}");
					return false;
				}
			}
		}

		return true;
	}

	private function updateCoupon($order_ids)
	{
		//get coupon transaction
		$coupon_db = $this->data->getCouponTransaction();
		if (false === $coupon_db) {
			return false;
		}

		$ret = ICoupon::useCoupon($this->data->uid, $this->data->coupon_info, implode(',', $order_ids), $coupon_db, (isset($this->data->user_info['level'])? $this->data->user_info['level'] : -1), $this->data->site_id);
		if (false === $ret) {
			EL_Errors::err(ICoupon::$errCode, ICoupon::$errMsg);
			return false;
		}

		return true;
	}
}

