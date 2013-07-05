<?php
class IMycentRecommend {
	public static $errCode = 0;
	public static $errMsg = '';

	private static function setERR($code, $msg){
		self::$errCode = $code;
		self::$errMsg = $msg;
	}

	private static function clearERR(){
		self::setERR(0, '');
	}
	
	/**
	 * 获取我的推荐列表
	 * @param int 用户ID $uid
	 */
	public static function getSettings($uid){
		self::clearERR();

		$uid -= 0;
		
		//$uid = 15026;
		$msdb = Config::getMSDB("ERP_1");
		$date = date('Y-m-d', strtotime("-30 day"));
		if($msdb === false){
			self::setERR(8701, "init DB failed, code: " . Config::$errCode . "; msg: " . Config::$errMsg);
			return false;
		}

		$recomendList = $msdb->getRows("select Customer.CustomerID,Customer.Email,case when  Customer.EmailStatus = 1 then '是' else '否' end as emailstatus,"
						." Customer.RegisterTime,(select  COUNT(sysno)  from   SO_Master(nolock)"
						." where SO_Master.Status = 4 "
						." and SO_Master.CustomerSysNo = Customer.SysNo"
						." and SO_Master.OrderDate >= '$date'  ) as num from Customer(nolock)"
						." where Customer.RefCustomerSysNo = $uid");
		if($recomendList === false){
			self::setERR(8702, "getRows failed, code: " . $msdb->errCode . "; msg: " . $msdb->errMsg);
			return false;
		}
		
		return $recomendList;
	}
}

// End Of Script