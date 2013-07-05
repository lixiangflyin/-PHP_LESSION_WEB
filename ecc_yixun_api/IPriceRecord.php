<?php
/**
 *
 * 价格流水相关
 *
 * 1. 价格流水记录
 * 2. 价格流水归档
 * 3. 价格流水最低价查询
 *	  CREATE TABLE `t_product_record` (
 *		 `id` bigint(20) NOT NULL AUTO_INCREMENT,
 *		 `product_id` int(11) NOT NULL,
 *		 `product_price` int(11) NOT NULL,
 *		 `valid_time_from` int(11) NOT NULL,
 *		 `valid_time_to` int(11) NOT NULL,
 *		 `modify_time` int(11) NOT NULL,
 *		 `verify_type` varchar(255) DEFAULT NULL,
 *		 `wh_id` int(11) NOT NULL,
 *		 PRIMARY KEY (`id`),
 *		 KEY `th_index1` (`product_id`,`modify_time`,`wh_id`)
 * 	  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 *
 * @author rongxu
*/
class IPriceRecord {

	public static $errMsg = '';

	public static $errCode = 0;

	private static $table = 't_product_record';

	private static $tableHistory = 't_product_history_';

	//记录流水
	//array('product_id', 'product_price', 'modify_time', 'price_type', 'wh_id')
	public static function insertToRecord($params) {
		if (!is_array($params) || ($params['product_price'] <= 0)) {
			self::$errMsg = 'cant insert price 0 to record';
			self::$errCode = 100;
			return false;
		}

		$db = Config::getDB('icson_event');

		$newParams = array();
		foreach ($params as $key => &$pm) {
			if ($key == 'verify_type') {
				$newParams[$key] = strval($pm);
			}else{
				$newParams[$key] = intval($pm);
			}
		}

		$rs = $db->insert(self::$table, $newParams);
		if (!$rs) {
			self::$errMsg = $db->errMsg;
			self::$errCode = $db->errCode;
			return false;
		}

		return true;
	}

	// array('product_id', 'modify_time', 'wh_id')
	public static function deleteRecord($params) {
		$db = Config::getDB('icson_event');

		$newParams = array();
		foreach ($params as $key => &$pm) {
			$newParams[$key] = intval($pm);
		}

		$product_id = $newParams['product_id'];
		$modify_time = $newParams['modify_time'];
		$wh_id = $newParams['wh_id'];
		if ($modify_time == 0) {
			$condition = "product_id = $product_id AND wh_id = $wh_id";
		}else {
			$condition = "product_id = $product_id AND modify_time = $modify_time AND wh_id = $wh_id";
		}

		$rs = $db->remove(self::$table, $condition);
		if (!$rs) {
			self::$errMsg = $db->errMsg;
			self::$errCode = $db->errCode;
			return false;
		}

		return true;
	}

	//流水归档
	public static function insertToHistory($params) {
		$ext = date("Ym", time());

		//按月归档
		$tableName = self::$tableHistory . $ext;

		$db = Config::getDB('icson_event');
		$sql = "CREATE TABLE IF NOT EXIST $tableName (
				  product_id INT NOT NULL,
				  product_price INT NOT NULL,
				  valid_time_from INT NOT NULL,
				  valid_time_to INT NOT NULL,
				  modify_time INT NOT NULL,
				  price_type INT NOT NULL,
				  verify_type VARCHAR DEFAULT NULL,
				  wh_id INT NOT NULL,
				  INDEX th_index1(product_id, modify_time, wh_id)
				);";
		$rs = $db->getRow($sql);

		if (!$rs) {
			self::$errMsg = $db->errMsg;
			self::$errCode = $db->errCode;
			return false;
		}

		//每天归档，24小时之前的0点之前的数据，与48小时之前的0点之后的数据
		$startTs = date("Y-m-d 00:00:00", time() - 48*60*60);
		$endTs = date("Y-m-d 00:00:00", time() - 24*60*60);
		$sql = "INSERT INTO $tableName (SELECT * FROM self::$table WHERE modify_time >= $startTs AND modify_time < $endTs )";
		$rs = $db->getRows($sql);
		if (!$rs) {
			self::$errMsg = $db->errMsg;
			self::$errCode = $db->errCode;
			return false;
		}

		return true;
	}

	// 过滤不希望参与价格比对的商品
	// 返回值：TRUE 过滤掉，不参与比对；FALSE 不过滤，参与比对
	private static function filterProduct($priceType) {
		// 价格保护自动赔付第一期，多价系统仅支持身份价
		$priceTypeList = array(
			'0',	//易迅价
			'4',	//qq用户价
			'8',	//新用户特价
			'9',	//支付宝用户价
			'22',	//QQ会员专享价
			'23',	//QQ绿钻专享价
			'10',	//土星会员价
			'11',	//铜盾会员价
			'12',	//银盾会员价
			'13',	//金盾会员价
			'14',	//钻石会员价
			'15',	//皇冠会员价
			'16',	//易金鲸会员价
		);
		return !in_array($priceType, $priceTypeList);
	}

	//查询某时间段的某用户，某商品的最低价
	// ERP价格流水通过修改时间获取；admin多价流水通过起止时间获取
	public static function getLowestPrice($whId, $uid,  $pid, $startTs, $endTs = false) {
		$table = self::$table;

		if (!$endTs) {
			 $endTs = $startTs + 24 *60 * 60;
		}
		$db = Config::getDB('icson_event');

		// 先获取ERP价格流水
		$sql = "SELECT min(product_price) as price, price_type, verify_type, modify_time FROM $table WHERE product_id = $pid AND valid_time_from = 0 AND valid_time_to = 0 AND modify_time >= $startTs AND modify_time < $endTs AND wh_id = $whId GROUP BY price_type";

		$rs1 = $db->getRows($sql);

		$sql = "SELECT min(product_price) as price, price_type, verify_type, modify_time FROM $table WHERE product_id = $pid AND $startTs < valid_time_to AND $endTs > valid_time_from AND wh_id = $whId GROUP BY price_type";

		$rs2 = $db->getRows($sql);
		
		if (!$rs1 && !$rs2) {
			self::$errMsg = 'no price record';
			self::$errCode = 100;
			return false;
		}

		$rs = array_merge($rs1, $rs2);

		if ($uid > 0) {
			$prices = array();
			$rst = array();
			foreach ($rs as $r) {
				$priceType = $r['price_type'];

				$isExclude = self::filterProduct($priceType);
				if ($isExclude) {
					continue;
				}

				if ($priceType > 0) {
					//判断身份 TODO
					$is = IMultiPrice::verifyUser($uid, $r['verify_type']);
					/*
					if ($priceType == 2) {//qq会员
						$is = IUser::checkQQVip($uid);
					} else if ($priceType == 3) {//qq会员年费
						$is = IUser::checkQQVipIsYear($uid);
					} else if ($priceType == 4) {//qq绿钻
						$is = IUser::checkQQGreen($uid);
					} else if ($priceType == 5) {//qq蓝钻
						$blue = IUser::checkQQBlue($uid);
						$is = $blue['isBlue'];
					} else if ($priceType == 6) {//qq蓝钻年费
						$blue = IUser::checkQQBlue($uid);
						$is = $blue['isYearBlue'];
					} else if ($priceType == 7) {//qq黄钻
						$yellow = IUser::checkQQYellow($uid);
						$is = $yellow['vip'];
					} else if ($priceType == 8) {//qq黄钻年费
						$yellow = IUser::checkQQYellow($uid);
						$is = $yellow['is_yellow_year_vip'];
					} 
					*/
					if ($is) {
						$prices[] = $r['price'];
						$rst[$r['price']] = $r;
					}
				} else {
					$prices[] = $r['price'];
					$rst[$r['price']] = $r;
				}
			}

			sort($prices);
			$minPrice = $prices[0];
			
			// start 早市、天黑黑、限时抢购、团购、周末清仓等多价需要返回
			$multi_prices = array();
			$multi_rst = array();
			$priceTypeList = array( // 多价id参考IIndex.php
				'10000',	//天黑黑-限时抢购
				'10001',	//周末清仓
				'10003',	//首页抢购
				'10004',	//早市-限时抢购
				'10005',	//List页团购
				'10006',	//早市-特价秒杀
				'10007',	//早市-爆款热卖
				'10008',	//湖北站-首页抢购
				'10009',	//湖北站-早市-特价秒杀
				'10010',	//湖北站-早市-爆款热卖
				'10011',	//湖北站-早市-限时抢购
				'10012'		//天黑黑-爆款热卖
			);
			foreach ($rs as $r) {
				$priceType = $r['price_type'];
				if( in_array($priceType, $priceTypeList) ){
					$multi_prices[] = $r['price'];
					$multi_rst[$r['price']] = $r;
				}
			}
			sort($multi_prices);
			$minMultiPrice = $multi_prices[0];
			// end 早市、天黑黑、限时抢购、团购、周末清仓等多价需要返回
			
			return array(
						'price' => $rst[$minPrice],
						'multi_price' => $multi_rst[$minMultiPrice]
					);
		}

		return false;
	}

	// 从新促销系统获取 某时间段的某用户，某商品的最低价
	public static function getLowestPriceFromPromotionSystem($whId, $uid,  $pid, $startTs, $endTs = false) {
		// 促销多价系统切换的时候需要调用此接口
		
		return false;
	}

	//查询销量
	public static function getSales($whId, $pids, $startTs, $endTs = false, $bak = false) {
		if (!$endTs) {
			$endTs = $startTs + 24 * 60 * 60;
		}

		$start = date("Y-m-d H:i:s", $startTs);
		$end = date("Y-m-d H:i:s", $endTs);

		$dbName = 'ERP_' . $whId;
		if ($bak) {
			$dbName = 'ERP_BAK_' . $whId;
		}
		IIndex::setDatabase($dbName);

		$i = 0;
		do {
			if ($i > 9) break;
			if ($i > 0) sleep(20);
			$lists = IIndex::getBuyCount(array($pids), $start, $end, true);
			$i++;
		} while ($lists === false);

		if( false === $lists){
			return false;
		}

		$sales = array();
		foreach ($lists as $list) {
			$sales[$list['product_id']] = $list['total'];
		}
		return $sales;
	}

	//查询商品的差价金额
	//array('pid' => 'price')
	public static function getCompensateMoney($whId, $pidsPrices, $startTs, $endTs = false, $bak = false) {

		$pids = array();
		foreach ($pidsPrices as $key => $price) {
			$pids[] = $key;
		}
		$sales = self::getSales($whId, $pids, $startTs, $endTs = false, $bak = false);

		$compensateMoney = array();
		foreach ($pids as $pid) {
			$compensateMoney[$pid][] = $sales[$pid] * $pidsPrices[$pid];
		}

		return $compensateMoney;
	}

}