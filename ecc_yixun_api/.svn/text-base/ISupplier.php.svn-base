<?php
class ISupplier
{
	public static $errCode = 0;
	public static $errMsg = '';

	public static function addSupplier($newSupplier)
	{
		if (!isset($newSupplier['SupplierName'])) {
			self::$errCode = 903;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "SupplierName: {$newSupplier['SupplierName']} is invalid";
			return false;
		}
		if (!isset($newSupplier['AreaSysno'])) {
			self::$errCode = 904;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "AreaSysno: {$newSupplier['AreaSysno']} is invalid";
			return false;
		}
		if (!isset($newSupplier['Address'])) {
			self::$errCode = 905;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "Address: {$newSupplier['Address']} is invalid";
			return false;
		}
		if (!isset($newSupplier['ContactPerson'])) {
			self::$errCode = 906;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "ContactPerson: {$newSupplier['ContactPerson']} is invalid";
			return false;
		}
		if (!isset($newSupplier['Phone'])) {
			self::$errCode = 908;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "Phone: {$newSupplier['Phone']} is invalid";
			return false;
		}

		if (!isset($newSupplier['Email'])) {
			self::$errCode = 910;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "Email: {$newSupplier['Email']} is invalid";
			return false;
		}
		if (!isset($newSupplier['AgentLevel'])) {
			self::$errCode = 911;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "AgentLevel: {$newSupplier['AgentLevel']} is invalid";
			return false;
		}
		if (!isset($newSupplier['RegisteredCapital'])) {
			self::$errCode = 912;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "RegisteredCapital: {$newSupplier['RegisteredCapital']} is invalid";
			return false;
		}
		if (!isset($newSupplier['SalesYear'])) {
			self::$errCode = 913;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "SalesYear: {$newSupplier['SalesYear']} is invalid";
			return false;
		}
		if (!isset($newSupplier['Partners'])) {
			self::$errCode = 914;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "Partners: {$newSupplier['Partners']} is invalid";
			return false;
		}
		if (!isset($newSupplier['Remark'])) {
			self::$errCode = 915;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "Remark: {$newSupplier['Remark']} is invalid";
			return false;
		}
		if (!isset($newSupplier['BrandName'])) {
			self::$errCode = 917;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "BrandName: {$newSupplier['BrandName']} is invalid";
			return false;
		}

		$msdb = Config::getMSDB('ERP_1');
		if (empty($msdb)) {
			self::$errCode = Config::$errCode;
			self::$errMsg = "init ms db failed" . Config::$errMsg;
			return false;
		}

		$SupplierName = ToolUtil::transXSSContent($newSupplier['SupplierName']);
		//检查该供应商是否已经提交过资料
		$sql = "select count(*) as c from SupplierInfo where SupplierName='" . $msdb->msEscapeStr($SupplierName) . "'";
		$exist = $msdb->getRows($sql);
		if (false === $exist) {
			self::$errCode = $msdb->errCode;
			self::$errMsg = "query ms db failed" . $msdb->errMsg;
			return false;
		}
		if ($exist[0]['c'] >= 1) {
			self::$errCode = 916;
			self::$errMsg = "您已经提交过申请，请毋重复提交";
			return false;
		}

		$id = IIdGenerator::getNewId('supplierinfo_sequence');
		if (false === $id) {
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return false;
		}

		$newSupplier = array(
		'SysNo' => $id,
		'SupplierName' => $SupplierName,
		'AreaSysno' => ToolUtil::transXSSContent($newSupplier['AreaSysno']),
		'Address' => ToolUtil::transXSSContent($newSupplier['Address']),
		'ContactPerson' => ToolUtil::transXSSContent($newSupplier['ContactPerson']),
		'Phone' => ToolUtil::transXSSContent($newSupplier['Phone']),
		'CellPhone' => ToolUtil::transXSSContent($newSupplier['CellPhone']),
		'Email' => ToolUtil::transXSSContent($newSupplier['Email']),
		'AgentLevel' => ToolUtil::transXSSContent($newSupplier['AgentLevel']),
		'RegisteredCapital' => ToolUtil::transXSSContent($newSupplier['RegisteredCapital']),
		'SalesYear' => ToolUtil::transXSSContent($newSupplier['SalesYear']),
		'BrandName' => ToolUtil::transXSSContent($newSupplier['BrandName']),
		'Partners' => ToolUtil::transXSSContent($newSupplier['Partners']),
		'Remark' => ToolUtil::transXSSContent($newSupplier['Remark']),
		'IsSee' => 1,
		'RowCreatedate' => date('Y-m-d H:i:s', time())
		);

		$ret = $msdb->insert('SupplierInfo', $newSupplier);
		if (false === $ret) {
			self::$errCode = $msdb->errCode;
			self::$errMsg = "insert ms db failed" . $msdb->errMsg;
			return false;
		}

		return true;
	}
}