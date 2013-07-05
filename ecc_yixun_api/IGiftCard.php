<?php
require_once('Config.php');

/**
 * ��Ʒ����ؽӿ�
 * @author flycgu
 */

//�����붨�壺
//1����ȡֵΪ��
//-1����ȡֵʧ��
//-2���������ݴ���
class IGiftCard {
	public static $errMsg = "";
	public static $errCode = 0;
	//�¿ͷ�ϵͳ192.168.2.14,�����м��λ��
	public static $DB_SO_ITEM = 'SO';
	public static $TABLE_SO_ITEM = 'SO_Item';
	public static $TABLE_SO_MASTER = 'SO_Master';
	//192.168.2.88,�Ϻ�ias
	public static $DB_SO_ITEM_PO = 'ERP_1';
	public static $TABLE_SO_ITEM_PO = 'SO_Item_PO';

	public static $CMEM_KEY = 'giftcard_pncode';

	//private static $_amount_limit = 10000;//ÿ��ÿ�˻��������
	//private static $_count_limit = 10;//ÿ��ÿ�˻���������

	/**
	 * ʹ����Ѹ������ֵ����
	 * @param int $uid
	 * @param string $code
	 * @param string $password
	 * @param string $check_code
	 */
	public static function useCard ($uid, $code, $password, $check_code) {
		//�������
		if (!isset($code)|| $code == '') {
			self::$errCode = -2;
			self::$errMsg = "IGiftCard getCardInfo Param code error : {$code}";
			EL_Flow::getInstance('giftcard')->append(self::$errMsg . " : " . $code);
			return array('errno' => -1,'data' => "�������ݴ���");
		}
		if (!isset($uid)|| !is_numeric($uid)) {
			self::$errCode = -2;
			self::$errMsg = "IGiftCard getCardInfo Param uid error : {$uid}";
			EL_Flow::getInstance('giftcard')->append(self::$errMsg . " : " . $uid);
			return array('errno' => -1,'data' => "�������ݴ���");
		}
		if (!isset($password)|| $password == '') {
			self::$errCode = -2;
			self::$errMsg = "IGiftCard getCardInfo Param  password error : {$password}";
			EL_Flow::getInstance('giftcard')->append(self::$errMsg . " : " . $password);
			return array('errno' => -1,'data' => "�������ݴ���");
		}
		if (!isset($check_code)|| $check_code == '') {
			self::$errCode = -2;
			self::$errMsg = "IGiftCard getCardInfo Param check_code error : {$check_code}";
			EL_Flow::getInstance('giftcard')->append(self::$errMsg . " : " . $check_code);
			return array('errno' => -1,'data' => "�������ݴ���");
		}

		$info = self::getCardInfo($code);
		if (false === $info) {
			EL_Flow::getInstance('giftcard')->append("IGiftCard useCard error :" . self::$errMsg . " : " . $code);
			return array('errno' => -2,'data' => "���ݲ��Ҵ���");
		}
		if (empty($info)) {
			return array('errno' => 1,'data' => "����ʧ�ܣ��ÿ���Ϣ������");
		}

		//�ÿ���Ϣ
		if ($info['is_used'] == 1) {
			return array('errno' => 2,'data' => "����ʧ�ܣ��ÿ��ѱ�ʹ��");
		}
		if ($info['card_status'] == 1) {
			return array('errno' => 2,'data' => "����ʧ�ܣ��ÿ��ѱ�����");
		}
		if ($info['card_status'] == 2) {
			return array('errno' => 2,'data' => "����ʧ�ܣ��ÿ��ѱ�����");
		}

		//��������Ϣ
		if ($info['status'] == 0) {
			return array('errno' => 3,'data' => "����ʧ�ܣ��ÿ����λ�δ����");
		}
		else if ($info['status'] == 2) {
			return array('errno' => 3,'data' => "����ʧ�ܣ��ÿ������ѱ�����");
		}
		else if ($info['status'] == 3) {
			return array('errno' => 4,'data' => "����ʧ�ܣ��ÿ������ѱ�����");
		}

		$now = time();
		if ($now < $info['valid_time_from']) {
			return array('errno' => 5,'data' => "����ʧ�ܣ��ÿ���δ�ܿ�ʼʹ��");
		}
		if ($now > $info['valid_time_to']) {
			return array('errno' => 6,'data' => "����ʧ�ܣ��ÿ��ѹ���Ч��");
		}
		if (md5($password) != $info['password']) {
			return array('errno' => 7,'data' => "����ʧ�ܣ�������������ɴ�д��ĸ��������ɣ���ע���飺��ĸG/����6����ĸO/����0����ĸV/��ĸY����ĸB/����8����ĸI/����1����ĸS/����5");
		}
		if ($check_code != $info['check_code']) {
			return array('errno' => 7,'data' => "����ʧ�ܣ�У�������");
		}

		//���
		$uid = intval($uid);
		$check = self::_checkLimit($uid, $info['amount']);
		if ($check['errno'] == -1) {
			EL_Flow::getInstance('giftcard')->append(self::$errMsg);
			return array('errno' => -1,'data' => "���ݴ��ݴ���");
		}
		else if ($check['errno'] == -2) {
			EL_Flow::getInstance('giftcard')->append(self::$errMsg);
			return array('errno' => -2,'data' => "���ݲ��Ҵ���");
		}
		else if ($check['errno'] == 1) {
			EL_Flow::getInstance('giftcard')->append(self::$errMsg);
			return array('errno' => 8,'data' => "����ʧ�ܣ����ռ������Ѵ�����");
		}
		else if ($check['errno'] == 2) {
			EL_Flow::getInstance('giftcard')->append(self::$errMsg);
			return array('errno' => 9,'data' => "����ʧ�ܣ����ռ�������Ѵ�����");
		}

		//�ȱ�ǿ�״̬Ϊ�Ѿ�ʹ��
		$param = array(
			'code' => $code,
			'is_used' => 1,
			'use_account' => $uid,
			'use_time' => $now,
		);
		$ret = IGiftCardTTC::update($param);
		if (false === $ret) {
			EL_Flow::getInstance('giftcard')->append(IGiftCardTTC::$errMsg);
			return array('errno' => -4, 'data' => "����ʧ��");
		}

		//�����ӻ���
		global $_SCORE_TYPE;
		EL_Flow::getInstance('giftcard')->append("addScore Start");
		$ret = IScore::addScore( $uid, $_SCORE_TYPE['GIFT_CARD']['id'], $info['amount']*10, "�����{$info['code']}��û���", '', 0 , $info['amount']*10 );
		EL_Flow::getInstance('giftcard')->append(var_export($ret,true));
		if (false === $ret) {
			EL_Flow::getInstance('giftcard')->append("addScore failed " . IScore::$errMsg . " ����: " . $code);

			//�����ֵ����ʧ�ܣ����Ի�ԭ��״̬
			$param = array(
				'code' => $code,
				'is_used' => 0,
				'use_account' => 0,
				'use_time' => 0,
			);
			$ret_card = IGiftCardTTC::update($param);
			if ($ret_card === false) {
				EL_Flow::getInstance('giftcard')->append("���ÿ�ʧ��" . IGiftCardTTC::$errMsg . " ����: " . $code);
				return array('errno' => -3,'data' => "����ʧ�ܣ�����ϵ�ͷ�");
			}
			return array('errno' => -3,'data' => "����ʧ��");
		}

		//���ӻ��ֳɹ���д��ֵ��¼
		$param = array(
			'code' => $code,
			'batch' => $info['batch'],
			'amount' => $info['amount'],
			'uid' => $uid,
			'use_time' => $now,
		);
		$ret = IGiftCardUserTTC::insert($param);
		if (false === $ret) {
			EL_Flow::getInstance('giftcard')->append("�����¼ʧ�ܣ�" . IGiftCardUserTTC::$errMsg . var_export($param,true));
		}

		return array('errno' => 0,'data' => $info['amount']);
	}

	/**
	 * ��ȡ����Ϣ
	 * @param String $code
	 * @return false/array $info
	 */
	public static function getCardInfo ($code) {
		//�������
		if (!isset($code)|| $code == '') {
			self::$errCode = -2;
			self::$errMsg = "IGiftCard getCardInfo Param error : {$code}";
			EL_Flow::getInstance('giftcard')->append(self::$errMsg . " : " . $code);
			return false;
		}

		//��ÿ���Ϣ
		$ret_card = IGiftCardTTC::get($code);
		if (false === $ret_card) {
			self::$errCode = -1;
			self::$errMsg = "IGiftCardTTC get error";
			EL_Flow::getInstance('giftcard')->append("IGiftCard getCardInfo " . self::$errMsg . " : " . $code);
			return false;
		}
		else if (empty($ret_card)) {
			self::$errCode = 1;
			self::$errMsg = "IGiftCardTTC get empty";
			return array();
		}

		//��ÿ�������Ϣ
		$ret_batch = IGiftCardBatchTTC::get($ret_card[0]['batch']);
		if (false === $ret_batch) {
			self::$errCode = -1;
			self::$errMsg = "IGiftCardBatchTTC get error";
			EL_Flow::getInstance('giftcard')->append("IGiftCard getCardInfo " . self::$errMsg . " : " . $ret_card[0]['batch']);
			return false;
		}
		else if (empty($ret_batch)) {
			self::$errCode = 1;
			self::$errMsg = "IGiftCardBatchTTC get empty";
			EL_Flow::getInstance('giftcard')->append("IGiftCard getCardInfo empty " . self::$errMsg . " : " . $ret_card[0]['batch']);
			return false;
		}

		//�ϲ���Ϣ����
		$info = array_merge($ret_card[0], $ret_batch[0]);
		return $info;
	}

	/**
	 * ����ֵ������޺ʹ�������
	 * @param int $uid
	 * @param int $amount
	 * @return mixed false/true/array('errno'=>XX,'data'=>XX)
	 */
	private static function _checkLimit ($uid, $amount) {
		if (!isset($uid)|| !is_numeric($uid)) {
			self::$errCode = -2;
			self::$errMsg = "IGiftCard getCardInfo Param uid error : {$uid}";
			EL_Flow::getInstance('giftcard')->append(self::$errMsg . " : " . $uid);
			return array('errno' => -1,'data' => "�������ݴ���");
		}
		if (!isset($amount)|| !is_numeric($amount)) {
			self::$errCode = -2;
			self::$errMsg = "IGiftCard getCardInfo Param $amount error : {$amount}";
			EL_Flow::getInstance('giftcard')->append(self::$errMsg . " : " . $amount);
			return array('errno' => -1,'data' => "�������ݴ���");
		}


		$ret = IGiftCardUserTTC::get($uid);
		if (false === $ret) {
			self::$errMsg = "IGiftCardUserTTC get error:" . IGiftCardUserTTC::$errMsg;
			EL_Flow::getInstance('giftcard')->append(self::$errMsg);
			return array('errno' => -2,'data' =>"���ݲ��Ҵ���");
		}
		if (empty($ret)) {
			return array('errno' => 0,'data' =>"");
		}

		$_amount_already = 0;
		$_count_already = 0;
		$today = date("Y-m-d", time());
		foreach ($ret as $re) {
			$use_day = date("Y-m-d", $re['use_time']);
			if ($use_day == $today) {
				$_amount_already += $re['amount'];
				$_count_already ++;
			}
		}
		if (($_amount_already+$amount) > _AMOUNT_LIMIT ) {
			return array('errno' => 1,'data' =>"���ռ������Ѵ�����");
		}
		if ($_count_already >= _COUNT_LIMIT) {
			return array('errno' => 2,'data' =>"���ռ�������Ѵ�����");
		}
		return array('errno' => 0,'data' =>"");
	}

	/**
	 * ͨ�������Ż�ȡ��Ʒ����Ϣ
	 * @param $order_id
	 * @return array|bool
	 */
	public static function getCardInfoByOrderId($order_id) {
		if (empty($order_id)) {
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__;
			EL_Flow::getInstance('giftcard')->append(__CLASS__ . '|' . __FUNCTION__ . "|param NULL");
			return false;
		}
		//��ͨ��SO_ITEM���SOSysNo�鵽SysNo��
		$DB_SO_Item = ToolUtil::getMSDBObj(self::$DB_SO_ITEM);
		if (empty($DB_SO_Item)) {
			self::$errCode = -4000;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "get DB_SO_Item failed". $DB_SO_Item->errMsg;
			EL_Flow::getInstance('giftcard')->append(__CLASS__ . '|' . __FUNCTION__ . "get error");
			return  false;
		}
		//����SO_Master��,����״̬���µ�ʱ�䣬�������
		$sql = "SELECT Status,OrderDate,SOAmt FROM " . self::$TABLE_SO_MASTER . " WHERE SysNo = $order_id";
		$order = $DB_SO_Item->getRows($sql);
		if(false === $order)
		{
			self::$errCode = -4001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "select order_Master failed" . $DB_SO_Item->errMsg;
			EL_Flow::getInstance('giftcard')->append(__CLASS__ . '|' . __FUNCTION__ . "get error" . self::$errMsg);
			return  false;
		}
		else if(empty($order)){
			return array();
		}
		//����SO_Item��,�ҵ�SysNoȥ����PO��SOSysNoΪ������
		$sql = "SELECT * FROM " . self::$TABLE_SO_ITEM . " WHERE SOSysNo = $order_id";
		$order_items = $DB_SO_Item->getRows($sql);
		if(false === $order_items)
		{
			self::$errCode = -4001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "select order_items failed" . $DB_SO_Item->errMsg;
			EL_Flow::getInstance('giftcard')->append(__CLASS__ . '|' . __FUNCTION__ . "get error" . self::$errMsg);
			return  false;
		}
		else if(empty($order_items)){
			return array();
		}
		//ͨ��SysNo�ҵ�PN��
		$DB_SO_ITEM_PO = ToolUtil::getMSDBObj(self::$DB_SO_ITEM_PO);
		if (empty($DB_SO_ITEM_PO)) {
			self::$errCode = -4000;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "get DB_SO_ITEM_PO failed". $DB_SO_ITEM_PO->errMsg;
			EL_Flow::getInstance('giftcard')->append(__CLASS__ . '|' . __FUNCTION__ . "get error" . self::$errMsg);
			return  false;
		}

		$result = array();
		foreach($order_items as $item){
			$sql = "SELECT * FROM " . self::$TABLE_SO_ITEM_PO . " WHERE SOItemSysNo = " . $item['SysNo'];
			$PNs = $DB_SO_ITEM_PO->getRows($sql);
			if(false === $PNs)
			{
				self::$errCode = -4001;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "select PNs failed" . $DB_SO_ITEM_PO->errMsg;
				EL_Flow::getInstance('giftcard')->append(__CLASS__ . '|' . __FUNCTION__ . "get error" . self::$errMsg);
				return  false;
			}
			if(empty($PNs)){
				continue;
			}
			foreach($PNs as $PN){
				$pn = $item['ProductSysNo'] . "_" . $PN['ProductIDSysNo'];
				$temp = self::getSingleCardInfoByPnCode($pn);
				if(false === $temp){
					EL_Flow::getInstance('giftcard')->append(__CLASS__ . '|' . __FUNCTION__ . "get error" . self::$errMsg);
					return false;
				}
				if(empty($temp)){
					continue;
				}
				//ƴ�ӷ���ֵ
				$result[$temp['code']] = $temp;
				$result[$temp['code']]['order_status'] = $order[0]['Status'];
				$result[$temp['code']]['order_amt'] = $order[0]['SOAmt'];
				$result[$temp['code']]['order_date'] = $order[0]['OrderDate'];
			}
		}
		return $result;
	}

	/**
	 * ����pn���ȡ��������Ϣ
	 * @param string $card_code
	 *
	 * @return array/false
	 */
	public static function getSingleCardInfoByPnCode($pnCode) {
		if ($pnCode === '') {
			EL_Flow::getInstance('giftcard')->append(__CLASS__ . '::' . __FUNCTION__ . ", param ERROR");
			return false;
		}

		$card_code = EL_SimpleCmem::get(IGiftCard::$CMEM_KEY, $pnCode); //��ȡCMEM
		if (false === $card_code) {
			self::$errMsg = __CLASS__ . '::' . __FUNCTION__ . "EL_SimpleCmem::get error with " . $pnCode;
			EL_Flow::getInstance('giftcard')->append(__CLASS__ . '::' . __FUNCTION__ . ", EL_SimpleCmem::get failed");
			return false;
		}
		if (empty($card_code)){
			return array();
		}
		//else go through
		$info = IGiftCard::getCardInfo($card_code);
		if ($info === false) {
			self::$errMsg = "IGiftCardDao::getCardSysnoInfo() IGiftCard getCardInfo error :" . IGiftCard::$errMsg;
			EL_Flow::getInstance('giftcard')->append(self::$errMsg);
			return false;
		}
		if (empty($info)) {
			return array();
		}

		if ($info['status'] == 3) {
			$info['card_status'] = 2;
		}
		return $info;
	}
}
