<?php
class IMailOrder {
	public static $errCode = 0;
	public static $errMsg = '';

	private static $defaultSettings = array( // 开关字段
		"OrderNotice"	=> 1,
		"saleNotice1"	=> 1,
		"saleNotice2"	=> 1,
		"saleNotice3"	=> 1,
		"saleNotice4"	=> 1,
		"saleNotice5"	=> 1,
		"saleNotice6"	=> 1,
	);

	private static function setERR($code, $msg){
		self::$errCode = $code;
		self::$errMsg = $msg;
	}

	private static function clearERR(){
		self::setERR(0, '');
	}

	public static function getSettings($uid){
		self::clearERR();

		$uid -= 0;
		$msdb = Config::getMSDB("ERP_1");
		if($msdb === false){
			self::setERR(8701, "init DB failed, code: " . Config::$errCode . "; msg: " . Config::$errMsg);
			return false;
		}

		$mailOrder = $msdb->getRows("SELECT CustomerSysNo, OrderNotice, SaleNotice, CreateDate, Updatetime, Status, rowCreateDate, rowModifyDate, SysNo FROM customer_mailorder WHERE customersysno=$uid");
		if($mailOrder === false){
			self::setERR(8702, "getRows failed, code: " . $msdb->errCode . "; msg: " . $msdb->errMsg);
			return false;
		}

		if(count($mailOrder) == 0){
			return self::$defaultSettings;
		}

		$mailOrder = $mailOrder[0];
		$saleNotice = explode(",", $mailOrder['SaleNotice']);
		for($i = 1; $i <= 6; $i ++){
			$saleNotice[$i-1] = isset($saleNotice[$i-1]) ? trim($saleNotice[$i-1]) : 0;
			$mailOrder['saleNotice' . $i] = empty($saleNotice[$i-1]) ? 0 : 1;
		}

		unset($mailOrder['SaleNotice']);
		return $mailOrder;
	}

	public static function setSettings($uid, $settings = array()){
		if(!is_array($settings)){
			self::setERR(8703, "settings is illegal");
			return false;
		}

		$uid -= 0;

		$msdb = Config::getMSDB("ERP_1");
		if($msdb === false){
			self::setERR(8704, "init DB failed, code: " . Config::$errCode . "; msg: " . Config::$errMsg);
			return false;
		}

		$mailOrder = $msdb->getRows("SELECT CustomerSysNo, OrderNotice, SaleNotice, CreateDate, Updatetime, Status, rowCreateDate, rowModifyDate, SysNo FROM customer_mailorder WHERE customersysno=$uid");
		if($mailOrder === false){
			self::setERR(8706, "getRows failed, code: " . $msdb->errCode . "; msg: " . $msdb->errMsg);
			return false;
		}

		if(count($mailOrder) < 1){
			$oldSettigs = self::$defaultSettings;
		} else {
			$oldSettigs = $mailOrder[0];
			$saleNotice = explode(",", $oldSettigs['SaleNotice']);
			for($i = 1; $i <= 6; $i ++){
				$saleNotice[$i-1] = isset($saleNotice[$i-1]) ? trim($saleNotice[$i-1]) : 0;
				$oldSettigs['saleNotice' . $i] = empty($saleNotice[$i-1]) ? 0 : 1;
			}
	
			unset($oldSettigs['saleNotice']);
		}

		$nSettings = array();
		foreach (self::$defaultSettings as $k => $dValue){
			if(!isset($settings[$k])){
				$nSettings[$k] = $oldSettigs[$k];
			} else {
				$nSettings[$k] = $settings[$k] == 1 ? 1 : 0;
			}
		}

		$nSettings['saleNotice'] = array();
		for($i = 1; $i <= 6; $i ++){
			$nSettings['saleNotice'][] = $nSettings['saleNotice' . $i];
			unset($nSettings['saleNotice' . $i]); // 去掉，以保证nsettings属于数据库字段
		}
		$nSettings['saleNotice'] = implode(",", $nSettings['saleNotice']);

		if(count($mailOrder) < 1){
			$sysNo = IIdGenerator::getNewId("customer_mailorder_sequence");
			if($sysNo === false){
				self::setERR(8707, "IIdGenerator::getNewId failed, code: " . IIdGenerator::$errCode . "; msg: " . IIdGenerator::$errMsg);
				return false;
			}
			$update = $msdb->execSql("INSERT INTO customer_mailorder (SysNo, CustomerSysNo, OrderNotice, SaleNotice, CreateDate, Updatetime, Status, rowCreateDate, rowModifyDate) 
						VALUES($sysNo, $uid, {$nSettings['OrderNotice']}, '{$nSettings['saleNotice']}', getdate(), getdate(), 1, getdate(), getdate())");
		} else {
			$update = $msdb->execSql("UPDATE customer_mailorder SET OrderNotice={$nSettings['OrderNotice']}, SaleNotice='{$nSettings['saleNotice']}', Updatetime=getdate(), rowModifyDate=getdate() WHERE customerSysno={$uid}");
			if($update === false){
				self::setERR(8705, "update failed, code: " . $msdb->errCode . "; msg: " . $msdb->errMsg);
				return false;
			}
		}
		return true;
	}
}

// End Of Script