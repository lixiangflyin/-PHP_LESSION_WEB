<?php
require_once('Config.php');

/**
 * 礼品卡相关接口
 * @author flycgu
 */

//错误码定义：
//1：获取值为空
//-1：获取值失败
//-2：参数传递错误
class IGiftCard {
	public static $errMsg = "";
	public static $errCode = 0;
	//新客服系统192.168.2.14,订单中间表位置
	public static $DB_SO_ITEM = 'SO';
	public static $TABLE_SO_ITEM = 'SO_Item';
	public static $TABLE_SO_MASTER = 'SO_Master';
	//192.168.2.88,上海ias
	public static $DB_SO_ITEM_PO = 'ERP_1';
	public static $TABLE_SO_ITEM_PO = 'SO_Item_PO';

	public static $CMEM_KEY = 'giftcard_pncode';

	//private static $_amount_limit = 10000;//每日每账户金额限制
	//private static $_count_limit = 10;//每日每账户张数限制

	/**
	 * 使用易迅卡，充值积分
	 * @param int $uid
	 * @param string $code
	 * @param string $password
	 * @param string $check_code
	 */
	public static function useCard ($uid, $code, $password, $check_code) {
		//参数检查
		if (!isset($code)|| $code == '') {
			self::$errCode = -2;
			self::$errMsg = "IGiftCard getCardInfo Param code error : {$code}";
			EL_Flow::getInstance('giftcard')->append(self::$errMsg . " : " . $code);
			return array('errno' => -1,'data' => "参数传递错误");
		}
		if (!isset($uid)|| !is_numeric($uid)) {
			self::$errCode = -2;
			self::$errMsg = "IGiftCard getCardInfo Param uid error : {$uid}";
			EL_Flow::getInstance('giftcard')->append(self::$errMsg . " : " . $uid);
			return array('errno' => -1,'data' => "参数传递错误");
		}
		if (!isset($password)|| $password == '') {
			self::$errCode = -2;
			self::$errMsg = "IGiftCard getCardInfo Param  password error : {$password}";
			EL_Flow::getInstance('giftcard')->append(self::$errMsg . " : " . $password);
			return array('errno' => -1,'data' => "参数传递错误");
		}
		if (!isset($check_code)|| $check_code == '') {
			self::$errCode = -2;
			self::$errMsg = "IGiftCard getCardInfo Param check_code error : {$check_code}";
			EL_Flow::getInstance('giftcard')->append(self::$errMsg . " : " . $check_code);
			return array('errno' => -1,'data' => "参数传递错误");
		}

		$info = self::getCardInfo($code);
		if (false === $info) {
			EL_Flow::getInstance('giftcard')->append("IGiftCard useCard error :" . self::$errMsg . " : " . $code);
			return array('errno' => -2,'data' => "数据查找错误");
		}
		if (empty($info)) {
			return array('errno' => 1,'data' => "激活失败，该卡信息不存在");
		}

		//该卡信息
		if ($info['is_used'] == 1) {
			return array('errno' => 2,'data' => "激活失败，该卡已被使用");
		}
		if ($info['card_status'] == 1) {
			return array('errno' => 2,'data' => "激活失败，该卡已被冻结");
		}
		if ($info['card_status'] == 2) {
			return array('errno' => 2,'data' => "激活失败，该卡已被作废");
		}

		//卡批次信息
		if ($info['status'] == 0) {
			return array('errno' => 3,'data' => "激活失败，该卡批次还未激活");
		}
		else if ($info['status'] == 2) {
			return array('errno' => 3,'data' => "激活失败，该卡批次已被冻结");
		}
		else if ($info['status'] == 3) {
			return array('errno' => 4,'data' => "激活失败，该卡批次已被作废");
		}

		$now = time();
		if ($now < $info['valid_time_from']) {
			return array('errno' => 5,'data' => "激活失败，该卡还未能开始使用");
		}
		if ($now > $info['valid_time_to']) {
			return array('errno' => 6,'data' => "激活失败，该卡已过有效期");
		}
		if (md5($password) != $info['password']) {
			return array('errno' => 7,'data' => "激活失败，密码错误。密码由大写字母和数字组成，请注意检查：字母G/数字6，字母O/数字0，字母V/字母Y，字母B/数字8，字母I/数字1，字母S/数字5");
		}
		if ($check_code != $info['check_code']) {
			return array('errno' => 7,'data' => "激活失败，校验码错误");
		}

		//检查
		$uid = intval($uid);
		$check = self::_checkLimit($uid, $info['amount']);
		if ($check['errno'] == -1) {
			EL_Flow::getInstance('giftcard')->append(self::$errMsg);
			return array('errno' => -1,'data' => "数据传递错误");
		}
		else if ($check['errno'] == -2) {
			EL_Flow::getInstance('giftcard')->append(self::$errMsg);
			return array('errno' => -2,'data' => "数据查找错误");
		}
		else if ($check['errno'] == 1) {
			EL_Flow::getInstance('giftcard')->append(self::$errMsg);
			return array('errno' => 8,'data' => "激活失败，今日激活金额已达上限");
		}
		else if ($check['errno'] == 2) {
			EL_Flow::getInstance('giftcard')->append(self::$errMsg);
			return array('errno' => 9,'data' => "激活失败，今日激活次数已达上限");
		}

		//先标记卡状态为已经使用
		$param = array(
			'code' => $code,
			'is_used' => 1,
			'use_account' => $uid,
			'use_time' => $now,
		);
		$ret = IGiftCardTTC::update($param);
		if (false === $ret) {
			EL_Flow::getInstance('giftcard')->append(IGiftCardTTC::$errMsg);
			return array('errno' => -4, 'data' => "激活失败");
		}

		//再增加积分
		global $_SCORE_TYPE;
		EL_Flow::getInstance('giftcard')->append("addScore Start");
		$ret = IScore::addScore( $uid, $_SCORE_TYPE['GIFT_CARD']['id'], $info['amount']*10, "您激活卡{$info['code']}获得积分", '', 0 , $info['amount']*10 );
		EL_Flow::getInstance('giftcard')->append(var_export($ret,true));
		if (false === $ret) {
			EL_Flow::getInstance('giftcard')->append("addScore failed " . IScore::$errMsg . " 卡号: " . $code);

			//如果充值积分失败，尝试还原卡状态
			$param = array(
				'code' => $code,
				'is_used' => 0,
				'use_account' => 0,
				'use_time' => 0,
			);
			$ret_card = IGiftCardTTC::update($param);
			if ($ret_card === false) {
				EL_Flow::getInstance('giftcard')->append("重置卡失败" . IGiftCardTTC::$errMsg . " 卡号: " . $code);
				return array('errno' => -3,'data' => "激活失败，请联系客服");
			}
			return array('errno' => -3,'data' => "激活失败");
		}

		//增加积分成功，写充值记录
		$param = array(
			'code' => $code,
			'batch' => $info['batch'],
			'amount' => $info['amount'],
			'uid' => $uid,
			'use_time' => $now,
		);
		$ret = IGiftCardUserTTC::insert($param);
		if (false === $ret) {
			EL_Flow::getInstance('giftcard')->append("激活记录失败：" . IGiftCardUserTTC::$errMsg . var_export($param,true));
		}

		return array('errno' => 0,'data' => $info['amount']);
	}

	/**
	 * 获取卡信息
	 * @param String $code
	 * @return false/array $info
	 */
	public static function getCardInfo ($code) {
		//参数检查
		if (!isset($code)|| $code == '') {
			self::$errCode = -2;
			self::$errMsg = "IGiftCard getCardInfo Param error : {$code}";
			EL_Flow::getInstance('giftcard')->append(self::$errMsg . " : " . $code);
			return false;
		}

		//获得卡信息
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

		//获得卡批次信息
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

		//合并信息返回
		$info = array_merge($ret_card[0], $ret_batch[0]);
		return $info;
	}

	/**
	 * 检查充值金额上限和次数上限
	 * @param int $uid
	 * @param int $amount
	 * @return mixed false/true/array('errno'=>XX,'data'=>XX)
	 */
	private static function _checkLimit ($uid, $amount) {
		if (!isset($uid)|| !is_numeric($uid)) {
			self::$errCode = -2;
			self::$errMsg = "IGiftCard getCardInfo Param uid error : {$uid}";
			EL_Flow::getInstance('giftcard')->append(self::$errMsg . " : " . $uid);
			return array('errno' => -1,'data' => "参数传递错误");
		}
		if (!isset($amount)|| !is_numeric($amount)) {
			self::$errCode = -2;
			self::$errMsg = "IGiftCard getCardInfo Param $amount error : {$amount}";
			EL_Flow::getInstance('giftcard')->append(self::$errMsg . " : " . $amount);
			return array('errno' => -1,'data' => "参数传递错误");
		}


		$ret = IGiftCardUserTTC::get($uid);
		if (false === $ret) {
			self::$errMsg = "IGiftCardUserTTC get error:" . IGiftCardUserTTC::$errMsg;
			EL_Flow::getInstance('giftcard')->append(self::$errMsg);
			return array('errno' => -2,'data' =>"数据查找错误");
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
			return array('errno' => 1,'data' =>"今日激活金额已达上限");
		}
		if ($_count_already >= _COUNT_LIMIT) {
			return array('errno' => 2,'data' =>"今日激活次数已达上限");
		}
		return array('errno' => 0,'data' =>"");
	}

	/**
	 * 通过订单号获取礼品卡信息
	 * @param $order_id
	 * @return array|bool
	 */
	public static function getCardInfoByOrderId($order_id) {
		if (empty($order_id)) {
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__;
			EL_Flow::getInstance('giftcard')->append(__CLASS__ . '|' . __FUNCTION__ . "|param NULL");
			return false;
		}
		//先通过SO_ITEM表的SOSysNo查到SysNo号
		$DB_SO_Item = ToolUtil::getMSDBObj(self::$DB_SO_ITEM);
		if (empty($DB_SO_Item)) {
			self::$errCode = -4000;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "get DB_SO_Item failed". $DB_SO_Item->errMsg;
			EL_Flow::getInstance('giftcard')->append(__CLASS__ . '|' . __FUNCTION__ . "get error");
			return  false;
		}
		//先找SO_Master表,订单状态，下单时间，订单金额
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
		//再找SO_Item表,找到SysNo去关联PO表，SOSysNo为订单号
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
		//通过SysNo找到PN码
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
				//拼接返回值
				$result[$temp['code']] = $temp;
				$result[$temp['code']]['order_status'] = $order[0]['Status'];
				$result[$temp['code']]['order_amt'] = $order[0]['SOAmt'];
				$result[$temp['code']]['order_date'] = $order[0]['OrderDate'];
			}
		}
		return $result;
	}

	/**
	 * 依据pn码获取单个卡信息
	 * @param string $card_code
	 *
	 * @return array/false
	 */
	public static function getSingleCardInfoByPnCode($pnCode) {
		if ($pnCode === '') {
			EL_Flow::getInstance('giftcard')->append(__CLASS__ . '::' . __FUNCTION__ . ", param ERROR");
			return false;
		}

		$card_code = EL_SimpleCmem::get(IGiftCard::$CMEM_KEY, $pnCode); //获取CMEM
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
