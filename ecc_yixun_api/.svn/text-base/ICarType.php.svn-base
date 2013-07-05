<?php
class ICarType
{
	public static $errMsg = "";
	public static $errCode = 0; 
	
	
	public static function getCarType($SysNo)
	{
		if (!isset($SysNo) || $SysNo <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . "|" . __FILE__ . 'SysNo is null';
			return false;
		}
		
		$ret = ICarTypeTTC::get($SysNo);
		if (false === $ret) {
			self::$errCode = ICarType::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . "|" . __LINE__ . "[get cartype :]" . ICarType::$errMsg . "]";
		}
		return  $ret;
	}
	
	
	public static  function addCarType($NewCarType)
	{
		if (!isset($NewCarType['SysNo']) || $NewCarType['SysNo']<= 0) {
			self::$errCode = 46;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'SysNo is null';
			return  false;
		}
		
		if (!isset($NewCarType['TypeId']) || $NewCarType['TypeId']<= 0) {
			self::$errCode = 47;
			self::$errMsg = basename(__FILE__, '.php') . "|" . __LINE__ . 'TypeId is invalid';
			return  false;
		}
		
		if (!isset($NewCarType['TypeInfo']) || $NewCarType['TypeInfo']<= 0) {
			self::$errCode = 48;
			self::$errMsg = basename(__FILE__, '.php') . "|" . __LINE__ . 'TypeInfo is invalid';
			return  false;
		}
		
		if (!isset($NewCarType['TypeFather']) || $NewCarType['TypeFather']<= 0) {
			self::$errCode = 49;
			self::$errMsg = basename(__FILE__, '.php') . "|" . __LINE__ . 'TypeFather is invalid';
			return  false;
		}
		
		if (!isset($NewCarType['TypeIdq']) || $NewCarType['TypeIdq']<= 0) {
			self::$errCode = 50;
			self::$errMsg = basename(__FILE__, '.php') . "|" . __LINE__ . 'TypeId is invalid';
			return  false;
		}
		
		if (!isset($NewCarType['Status']) || $NewCarType['Status']<= 0) {
			self::$errCode = 51;
			self::$errMsg = basename(__FILE__, '.php') . "|" . __LINE__ . 'Status is invalid';
			return  false;
		}
		
		if (!isset($NewCarType['rowCreateDate']) || $NewCarType['rowCreateDate']<= 0) {
			self::$errCode = 52;
			self::$errMsg = basename(__FILE__, '.php') . "|" . __LINE__ . 'rowCreateDate is invalid';
			return  false;
		}
		
		if (!isset($NewCarType['rowModifyDate']) || $NewCarType['rowModifyDate']<= 0) {
			self::$errCode = 53;
			self::$errMsg = basename(__FILE__, '.php') . "|" . __LINE__ . 'rowModifyDate is invalid';
			return  false;
		}
		
		$now = time();
		$newInvoice['rowCreateDate'] = $now;
		$newInvoice['rowModifyDate'] = $now;
		
		$ret = ICarTypeTTC::insert($NewCarType);
		if (false === $ret) {
			self::$errCode = ICarTypeTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . "|" . __LINE__ . "[insert new CatTypr to ICarTypeTTC failed:" . ICarTypeTTC::$errMsg . "]";
			return  false;
		}
	}
	
	
	public static function delCarType($SysNo)
	{
		if (!isset($SysNo) || $SysNo <= 0) {
		   self::$errCode =  54;
		   self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'SysNo is null';
		   return  false;
		}

		$ret = ICarTypeTTC::remove($SysNo);
		if (false === $ret) {
			self::$errCode = IUserInvoiceBookTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[delete CarType($SysNo) from ICarTypeTTC failed:" . ICarTypeTTC::$errMsg . "]";
			return  false;
		}

		$lines = ICarTypeTTC::getTTCAffectRows();
		if (1 != $lines) {
			self::$errCode = 55;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[modify CarType($SysNo) affect $lines rows";
			return  false;
		}
		return  true;
	}
}

