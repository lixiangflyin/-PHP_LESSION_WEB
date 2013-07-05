<?php

require_once('inc/IShoppingCartTTC.php');

class IPromotionRule
{
	public static $errMsg='';
	public static $errCode=0;	
	public static $BenfitType = array(
	'BENEFIT_TYPE_POINT' => 1,   //积分
	'BENEFIT_TYPE_CASH'  => 2,   //立减
	'BENEFIT_TYPE_DISCOUNT' => 3, //折扣
	'BENEFIT_TYPE_PRODUCT' => 4,  //送商品
	'BENEFIT_TYPE_HUANGOU' => 5,  //换购商品
	'BENEFIT_TYPE_COUPON' => 6,   //送优惠券
	);
	
	public static $RuleType = array(
	'RULE_TYPE_NULL' => 0, //无条件
	'RULE_TYPE_CASH_AMT'  => 1,  //满金额
	'RULE_TYPE_BUY_NUM' =>2, //满数量
	'RULE_TYPE_CERTAIN_BUY_NUM' =>3, //特定商品满特定数量
	);

	private static $RuleTypeName = array(
		0	=> '下单',
		1	=> '满{_cash_amt_}',
		2	=> '满{_buy_num_}件',
		3	=> '满{_buy_num_}件',
	);

	private static $BenfitTypeName = array(
		1	=> '立送{_point_}积分',
		2	=> '立减{_cash_}',
		3	=> '立享{_discount_name_}',
		4	=> '立送商品',
		5	=> '换购商品',
		6	=> '立送优惠券',
	);

	/*
	$product_ids = array(10,20,30,40)
	*/
	public static function getRuleForProducts($product_ids, $wh_id)
	{
		
		
		$ip = Config::getIP('promotion');
		if (null == $ip)
		{
			self::$errCode = 18;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[getip(promotion) failed]";
			return  false;
		}
		$addr = explode(":", $ip);

		$pids = '';
		foreach ($product_ids as $pid)
		{
			$pids .= $pid . "_1,";
		}

		$cmd = "cmd=500&wh_id=$wh_id&pids=" . substr($pids, 0, strlen($pids)-1) . "\r\n";
		$rspStr = NetUtil::tcpCmd($addr[0], $addr[1], $cmd, 1,  1, 0, "\n");
		if (false == $rspStr) {
			self::$errCode = 19;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[send package to promotion svr timeout]";
			return  false;
		}
		return $rspStr;
	}
	public static function getRuleForProduct($product_id, $wh_id)
	{
		
		
		$ip = Config::getIP('promotion');
		if (null == $ip)
		{
			self::$errCode = 18;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[getip(promotion) failed]";
			return  false;
		}
		$addr = explode(":", $ip);
			
		$cmd = "cmd=400&wh_id=" . $wh_id . "&pids=" .$product_id .  "_1\r\n";
		$rspStr = NetUtil::tcpCmd($addr[0], $addr[1], $cmd, 1,  1, 0, "\n");
		if (false == $rspStr) {
			self::$errCode = 19;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[send package to promotion svr timeout]";
			return  false;
		}
		return $rspStr;
	}

	/**
	 * items = array(0=>array('product_id'=>xxx, 'buy_count'=>xxxx));
	 * @return array 正确的结果包含
	 * 	array(
	 * 		errCode
	 * 		errMsg
	 * 		rules
	 * 		rules_if_login
	 * 		rules_buy_more
	 * )
	*/
	public static function getRuleForShoppingCart($items, $wh_id, $uid=0)
	{
		if (!is_array($items) || count($items) == 0 ) {
			return "";
		}
		
		
		$ip = Config::getIP('promotion');
		if (null == $ip)
		{
			self::$errCode = 18;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[getip(promotion) failed]";
			return  false;
		}
		$addr = explode(":", $ip);		
		$pids = '';
		foreach ($items as $it)
		{
			$pids .= "{$it['product_id']}_{$it['buy_count']},";
		}
			
		$cmd = "cmd=100&wh_id=$wh_id&uid=$uid&pids=" . substr($pids, 0, strlen($pids)-1) . "\r\n";
		$rspStr = NetUtil::tcpCmd($addr[0], $addr[1], $cmd, 1,  1, 0, "\n");
		if (false == $rspStr) {
			self::$errCode = 19;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[send package to promotion svr timeout]";
			return  false;
		}
		return $rspStr;
	}
	
	public static function checkRuleForOrder($items, $wh_id, $uid, $rule_id, $apply_times = 1)
	{
		if (!is_array($items) || count($items) == 0 ) {
			return "";
		}
		
		
		$ip = Config::getIP('promotion');
		if (null == $ip)
		{
			self::$errCode = 18;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[getip(promotion) failed]";
			return  false;
		}
		$addr = explode(":", $ip);		
		$pids = '';
		foreach ($items as $it)
		{
			$pids .= "{$it['product_id']}_{$it['buy_count']},";
		}
			
		$cmd = "cmd=200&wh_id=$wh_id&uid=$uid&rule=$rule_id&apply_times=$apply_times&pids=" . substr($pids, 0, strlen($pids)-1) . "\r\n";
		$rspStr = NetUtil::tcpCmd($addr[0], $addr[1], $cmd, 1,  1, 0, "\n");
		if (false == $rspStr) {
			self::$errCode = 19;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[send package to promotion svr timeout]";
			return  false;
		}
		return $rspStr;
	}

	/**
	 * 补充促销规则类型简称
	 * @param array $ruleInfo
	 */
	public static function appendNameOfRule(&$ruleInfo){
		if(!empty($ruleInfo) && !empty($ruleInfo['rule_type']) && !empty($ruleInfo['rule_type']) && !empty($ruleInfo['benefit_type'])
			&& isset(self::$RuleTypeName[$ruleInfo['rule_type']]) && isset(self::$BenfitTypeName[$ruleInfo['benefit_type']])){

			$ruleTypeName = self::$RuleTypeName[$ruleInfo['rule_type']];
			if($ruleInfo['rule_type'] == 1){
				$amt = sprintf("%d", $ruleInfo['condition']/100);
				if($amt <= 10) $amt .= '元';
				$ruleTypeName = str_replace("{_cash_amt_}", $amt, $ruleTypeName);
			} else if($ruleInfo['rule_type'] == 2 || $ruleInfo['rule_type'] == 3){
				$ruleTypeName = str_replace("{_buy_num_}", $ruleInfo['condition'], $ruleTypeName);
			}

			$benfitTypeName = self::$BenfitTypeName[$ruleInfo['benefit_type']];
			if($ruleInfo['benefit_type'] == 1){
				$benfitTypeName = str_replace("{_point_}", $ruleInfo['benefit_per_time'], $benfitTypeName);
			} else if($ruleInfo['benefit_type'] == 2){
				$cash = sprintf("%d", $ruleInfo['benefit_per_time']/100);
				if($cash <= 10) $cash .= '元';
				$benfitTypeName = str_replace("{_cash_}", $cash, $benfitTypeName);
			} else if($ruleInfo['benefit_type'] == 3){
				$discountName = '';
				if($ruleInfo['benefit_per_time'] % 10 == 0){
					$discountName = $ruleInfo['benefit_per_time'] / 10;
				} else {
					$discountName = $ruleInfo['benefit_per_time'];
				}
				$discountName .= '折';
				$benfitTypeName = str_replace("{_discount_name_}", $discountName, $benfitTypeName);
			}

			$ruleInfo['name'] = $ruleTypeName . $benfitTypeName;
		}
	}
}

