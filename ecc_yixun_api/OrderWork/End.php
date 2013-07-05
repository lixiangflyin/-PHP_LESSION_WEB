<?php
/**
 * �µ�������ģ�� - �����ύ����������߼�
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
		//�ύ����
		$ret = $this->data->commitAll();
		if (!$ret) {
			//ʧ��ʱ�����ʹ���˻��֣���ع�
			if ($this->data->order_data['point'] > 0) {
				return array('errCode'=>-988, 'errMsg'=>'��Ǹ�����Ķ����ύʧ�ܣ�����ʹ�õĻ��ֽ���1��Сʱ�ڷ����������˻�');
			}

			return array('errCode'=>-988, 'errMsg'=>'��Ǹ�����Ķ����ύʧ��');
		}

		//commit success
		$this->onSubmitSuccess($base_params['order_id_info']['sub_ids']);

		//format response data
		return $this->getResponseData($base_params);
	}

	private function onSubmitSuccess($order_ids)
	{
		// �ϱ���������ʹ�ü�¼
		if (isset($this->data->order_data['rule_id']) && $this->data->order_data['rule_id']> 0) {
			foreach ($order_ids as $_order_id) {
				DataReport::report(3001, DATA_TYPE_1DAY, array($this->data->site_id, $_order_id, $this->data->order_data['rule_id'], $this->data->user_info['level'],$this->data->uid));
			}
		}

		//д���û�����Ʒ��ȯ��Ϣ
		if (isset($this->data->order_data['send_coupon_record_info']) && $this->data->order_data['send_coupon_record_info'] != ''){
			$ret = EA_Promotion::setUserJoinedRecord($this->data->uid, $this->data->now_time, $this->data->order_data['send_coupon_record_info'], $this->data->items_in_promotion);
		}

		// �ϱ��ٶ�sem����
		if (isset($_COOKIE['mediav_data']) && $_COOKIE['mediav_data'] != '') {
			$mediv_data = explode('|', $_COOKIE['mediav_data']);

			// �ָ���ǰ��Ϊsem����
			$sem_data = $mediv_data[0];

			// �ָ�������Ϊ�û�������վ��ʱ��
			$sem_time = $mediv_data[1];

			// �����ڼ��ʱ��С��7��Ĳ��ϱ�
			if ($this->data->now_time - $sem_time  < 7*24*60*60 ) {
				foreach ($this->data->order_records as $stockNo=>$o) {
					// �ϱ����ж���
					DataReport::report(3201, DATA_TYPE_1DAY, array($this->data->site_id, $o['orderId'], $stockNo, $sem_data));
				}
			}
		}

		//ɾ�����ﳵ
		if (!(isset($this->data->order_data['buy_one_key']) && true === $this->data->order_data['buy_one_key'])) {
			if (!$this->data->debug) {
				IShoppingCart::clear($this->data->uid);
			}
		}

		//�����û���ַ��Ϣ��Ĭ��֧����ʽ��Ĭ�Ϸ�Ʊ
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

		//���Ͷ���֪ͨ
		if ($this->data->order_data['point'] > 1000) {
			$info = IUsersTTC::get($this->data->uid);
			if ($info === false){
				EL_Errors::err(1, "���Ͷ��ţ���ȡ�û���Ϣʧ��");
			}
			elseif (!empty($info[0]['mobile'])){
				$mobile = $info[0]['mobile'];
				$time = date("Y-m-d H:i:s");
				$ret = IMessage::sendSMSMessage($mobile, "������Ѹ���˻���" . $time ."�µ���ʹ�û���" . $this->data->order_data['point']/10 ."����������" . $this->data->parent_order_char_id ."�������������µ�400-828-1878");
				if (false === $ret) {
					EL_Errors::err(1, "���Ͷ��ţ�������Ϣʧ�ܣ�" . IMessage::$errMsg);
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
			'orderTotalAmt' => $this->data->order_ship_price + $costs['order_price'], //�����ܽ��
			'payGoodsAmt' => $this->data->product_cash, //�����ͻ�֧���Ľ�ȥ���˷Ѻ����ܵ��������Żݺ���û�ʵ��֧����
			'orderCreateTime' => $this->data->now_time,
			'isParentOrder' => $orders_count > 1 ? true : false,
			'isVATInvoice' => ($this->data->order_data['invoiceType'] == INVOICE_TYPE_VAT) ? true : false,
			'order_items' => $this->data->order_items, //CPS ��Ҫ�õ�
			'subOrderIdStr' => implode(',', $order_id_info['sub_ids']), //����ȥ CPS ����
			'subOrders' => $this->data->order_records, //����ȥ CPS ����
		);

		return $resp_data;
	}

	public function rollback()
	{
		return true;
	}
}
