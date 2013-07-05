<?php
class IMyinform {
	public static $errCode = 0;
	public static $errMsg = '';

	private static function setERR($code, $msg){
		self::$errCode = $code;
		self::$errMsg = $msg;
	}

	private static function clearERR(){
		self::setERR(0, '');
	}

	public static $ERPName_Product = "Product";
	/**
	 * 拉取我的价格举报列表
	 * SubStationSysNo = 1 代表上海站
	 * @param int $uid  用户id
	 * @return array
	 */
	public static function getinformList($uid, $begin, $quantity){
		self::clearERR();

		$uid -= 0;
		$begin -= 0;
		$quantity -= 0;
		$msdb = ToolUtil::getMSDBObj(self::$ERPName_Product);
		if($msdb === false){
			self::setERR(8701, "init DB failed, code: " . Config::$errCode . "; msg: " . Config::$errMsg);
			return false;
		}

		$sql = "select * from (
					select *,convert(nvarchar,ReportTime,20) as ReportTimeStr,
					row_number() over (order by ReportTime desc) rn
					from price_report with(nolock)
					where CustomerSysNo = '{$uid}'
					and SubStationSysNo = 1
				)as TEMP
				where rn > ({$begin} * {$quantity}) and rn <= (({$begin} + 1) * {$quantity})
				order by ReportTimeStr desc";
		$informList = $msdb->getRows($sql);
		if($informList === false){
			self::setERR(8702, "getRows failed, code: " . $msdb->errCode . "; msg: " . $msdb->errMsg);
			return false;
		}
		return $informList;
	}

	/**
	 * 提交我的价格举报
	 * @param $productSysNo  商品号
	 * @param $currentPrice  易迅价
	 * @param $competitorPrice  据报价
	 * @param $competitorUrl  销售网址
	 * @param $uid 用户ID
	 * @param $nickName 用户昵称
	 * @param $email  用户邮箱
	 * @param $customerMemo  用户举报留言
	 */
	public static function replyInform($productSysNo, $currentPrice, $competitorPrice, $competitorUrl, $uid, $nickName, $email, $customerMemo){
		self::clearERR();

		$uid -= 0;
		$notifyTime = '';
		$time = date('Y-m-d H:i:s');
		$sysno = IIdGenerator::getNewId("Price_Report_sequence");
		$customerIP = ToolUtil::getClientIP();
		if($sysno === false){
			self::setERR(8703, "IIdGenerator::getNewId failed, code: " . IIdGenerator::$errCode . "; msg: " . IIdGenerator::$errMsg);
			return false;
		}

		$msdb = ToolUtil::getMSDBObj(self::$ERPName_Product);
		if($msdb === false){
			self::setERR(8704, "init DB failed, code: " . Config::$errCode . "; msg: " . Config::$errMsg);
			return false;
		}

		$newInform = array(
			'ProductSysNo' => $productSysNo,
			'CurrentPrice' => $currentPrice,
			'CompetitorPrice' => $competitorPrice,
			'CompetitorUrl' => ToolUtil::transXSSContent($competitorUrl),
			'CustomerSysNo'	=> $uid,
			'NickName' =>  $nickName,
			'Email'	=> ToolUtil::transXSSContent($email),
			'CustomerMemo' => ToolUtil::transXSSContent($customerMemo),
			'ReportTime' => $time,
			'CustomerIP' => $customerIP,
			'Status'	=> 0,
			'SysNo' => $sysno,
			'SubStationSysNo' => 1,
		);
		$rs = $msdb->insert("Price_Report",$newInform);
		if($rs === false){
			self::setERR(8705, "insert failed, code: " . $msdb->errCode . "; msg: " . $msdb->errMsg);
			return false;
		}

		return true;
	}

	public static function HasReplyInform($productSysNo, $uid){
		self::clearERR();
		$productSysNo = intval($productSysNo);
		$uid = intval($uid);
		$msdb = ToolUtil::getMSDBObj(self::$ERPName_Product);
		if($msdb === false){
			self::setERR(8706, "init DB failed, code: " . Config::$errCode . "; msg: " . Config::$errMsg);
			return false;
		}

		$sql ="select SysNo from price_report
			where productsysno='{$productSysNo}'
			and customersysno = '{$uid}'
			and SubStationSysNo = 1
			and Status <> -1";

	    $count = $msdb->getRows($sql);
		if($count === false){
			self::setERR(8707, "getRows failed, code: " . $msdb->errCode . "; msg: " . $msdb->errMsg);
			return false;
		}

		return count($count);
	}

	/**
	 *add by allenzhou 2011-12-19
	 * Enter description here ...
	 * @param unknown_type $uid 用户IE
	 * return 评论总数
	 */
	public static function getReplyCount($uid){
		self::clearERR();

		$uid = intval($uid);
		$msdb = ToolUtil::getMSDBObj(self::$ERPName_Product);
		if($msdb === false){
			self::setERR(8708, "init DB failed, code: " . Config::$errCode . "; msg: " . Config::$errMsg);
			return false;
		}

		$sql = "select count(SysNo) as report_count from price_report where CustomerSysNo = '{$uid}' and SubStationSysNo = 1";
	    $count = $msdb->getRows($sql);
		if($count === false){
			self::setERR(8709, "getRows failed, code: " . $msdb->errCode . "; msg: " . $msdb->errMsg);
			return false;
		}

		return $count;
	}

}

// End Of Script