<?php
/**
 * 下单工作流模块 积分
 *
 * @author ixiuzeng
 */
class EA_OrderWork_Score extends EA_OrderWork_Abstract
{
	public function filter()
	{
		return array();
	}

	public function execute($base_params)
	{
		$order_id_info = $base_params['order_id_info'];
		$score_use = $base_params['score_use'];

		//扣减积分
		if ($this->data->order_data['point'] > 0) {
			$ret = $this->updateScore($order_id_info['last_id'], $score_use['cash'], $score_use['promotion']);
			if (!$ret) {
				return array('errCode'=>-986, 'errMsg'=>'抱歉，您的订单因使用积分异常导致提交订单失败，您可以稍后重新下单或在提交订单时暂不使用积分');
			}

			$this->rollback_data = array(
				'order_id' => $order_id_info['last_id'],
				'cash' => $score_use['cash'],
				'promotion' => $score_use['promotion'],
			);
		}

		return true;
	}

	public function rollback()
	{
		//失败时，如果使用了积分，则回滚
		if ($this->data->order_data['point'] > 0) {
			$item = array();
			$item['order_id'] = $this->rollback_data['order_id'];
			$item['uid'] = $this->data->uid;
			$item['type'] = ERROR_COMMIT_ORDER;
			$item['cash_point'] = $this->rollback_data['cash'];
			$item['promotion_point'] = $this->rollback_data['promotion'];

			IScore::insertBackData($item);
		}

		return true;
	}

	//扣减积分
	private function updateScore($score_order_id, $cash_point_used, $promotion_point_used)
	{
		global $_SCORE_TYPE;

		//积分是记录在最后一个子单上的
		//ERP积分表是按元来记的 这里的1元=订单表中的10积分
		$ret = IScore::addScore($this->data->uid, $_SCORE_TYPE['CREATE_ORDER']['id'], -1 * $this->data->order_data['point'] / 10,  "您下单10" . $score_order_id . "消费积分", '', -1 * $cash_point_used / 10, -1 * $promotion_point_used / 10);
		if (false === $ret) {
			EL_Errors::err(IScore::$errCode, basename(__FILE__, '.php') . " |" . __LINE__ . "add score flow:insert score flow faild(uid={$this->data->order_data['uid']},order_id=$score_order_id,point={$this->data->order_data['point']})" . IScore::$errMsg);
			return false;
		}

		return true;
	}
}

