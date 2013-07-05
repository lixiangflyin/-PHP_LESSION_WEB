<?php
require_once('MSSQL.php');
require_once('TTC.php');
require_once('Logger.php');
require_once('ISyncLog.php');

class IUserInvoiceSyn
{

	private static $WEB_ERP_PAIR_COMMON_INVOICE = array(
		'uid'        => 'CustomerSysNo',
		'title'      => 'InvoiceName',
		'type'       => 'BuyerType',
		'updatetime' => 'rowCreateDate',
		'createtime' => 'rowModifyDate',
	);

	private static $WEB_ERP_PAIR_VAT = array(
		'uid'        => 'CustomerSysNo',
		'name'       => 'CompanyName',
		'taxno'      => 'TaxNum',
		'addr'       => 'CompanyAddress',
		'phone'      => 'CompanyPhone',
		'bankname'   => 'BankInfo',
		'bankno'     => 'BankAccount',
		'status'     => 'Status',
		'updatetime' => 'rowModifyDate',
	);
	public static $errMsg = "";
	public static $errCode = 0;

	/**
	 * Insert the user info into ERP
	 */
	public static function add($item_)
	{
		if ($item_['type'] == INVOICE_TYPE_RETAIL_COMPANY) {
			$item_['type'] = 2;
			$ret = self::addCommonInvoice($item_);
		} else if ($item_['type'] == INVOICE_TYPE_RETAIL_PERSONAL) {
			$item_['type'] = 1;
			$ret = self::addCommonInvoice($item_);
		} else {
			$ret = self::addVAT($item_);
		}
		if ($ret == false)
			ISyncLog::saveSyncLog($item_['uid'], 7, $item_['iid']);

		return $ret;
	}

	/**
	 * Insert the user info into ERP
	 */
	public static function update($item_)
	{
		if (!isset($item_['type'])) {
			$ret = IUserInvoiceBookTTC::get($item_['uid'], array('iid' => $item_['iid']));
			if (false === $ret) {
				self::$errCode = IUserInvoiceBookTTC::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[get INVOICE :" . IUserInvoiceBookTTC::$errMsg . "]";
				return false;
			} else if (1 === count($ret)) {
				$item_['type'] = $ret[0]['type'];
			} else {
				return false;
			}
		}
		if ($item_['type'] == INVOICE_TYPE_RETAIL_COMPANY) {
			$item_['type'] = 2;
			$ret = self::updateCommonInvoice($item_);
		} else if ($item_['type'] == INVOICE_TYPE_RETAIL_PERSONAL) {
			$item_['type'] = 1;
			$ret = self::updateCommonInvoice($item_);
		} else {
			$ret = self::updateVAT($item_);
		}

		return $ret;
	}

	/**
	 * delete the user info into ERP
	 */
	public static function delete($item_)
	{
		if (!isset($item_['type'])) {
			$ret = IUserInvoiceBookTTC::get($item_['uid'], array('iid' => $item_['iid']));
			if (false === $ret) {
				self::$errCode = IUserInvoiceBookTTC::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[get INVOICE :" . IUserInvoiceBookTTC::$errMsg . "]";
				return false;
			} else if (1 === count($ret)) {
				$item_['type'] = $ret[0]['type'];
			} else {
				return false;
			}
		}

		if ($item_['type'] == INVOICE_TYPE_RETAIL_COMPANY) {
			$item_['type'] = 2;
			$ret = self::delCommonInvoice($item_);
		} else if ($item_['type'] == INVOICE_TYPE_RETAIL_PERSONAL) {
			$item_['type'] = 1;
			$ret = self::delCommonInvoice($item_);
		} else {
			$ret = self::delVAT($item_);
		}

		return $ret;
	}

	private static function addCommonInvoice($item_)
	{
		$ret = true;
		$data = array();
		$MSSQL = Config::getMSDB('Customer');
		if (false === $MSSQL) {
			Logger::err('connect to msserveer failed[]' . $MSSQL->errMsg);
			self::$errCode = $MSSQL->errCode;
			self::$errMsg = $MSSQL->errMsg;
			return false;
		}

		$sql = "SELECT CustomerSysNo FROM Customer_GeneralInvoiceInfo WHERE sysNo = {$item_['iid']}";
		$result = $MSSQL->getRows($sql);

		if (false === $result) {
			self::$errCode = $MSSQL->errCode;
			self::$errMsg = $MSSQL->errMsg;
			return false;
		} else if (0 == count($result)) {
			$data['SysNo'] = $item_['iid'];
			foreach (self::$WEB_ERP_PAIR_COMMON_INVOICE AS $web => $erp) {
				if (isset($item_[$web])) {
					$data[$erp] = self::translate($web, $item_, $MSSQL);
				}
			}

			$ret = $MSSQL->insert("Customer_GeneralInvoiceInfo", $data);
			if (false === $ret) {
				Logger::err("insert invoice_id({$item_['iid']} into ms sql fails )" . $MSSQL->errMsg);
				self::$errCode = $MSSQL->errCode;
				self::$errMsg = $MSSQL->errMsg;
				return false;
			}
		} else {
			$ret = false;
		}

		return $ret;
	}

	private static function updateCommonInvoice($item_)
	{
		$ret = true;
		$data = array();
		$MSSQL = Config::getMSDB('Customer');
		if (false === $MSSQL) {
			Logger::err('connect to msserveer failed[]' . $MSSQL->errMsg);
			self::$errCode = $MSSQL->errCode;
			self::$errMsg = $MSSQL->errMsg;
			return false;
		}

		$sql = "SELECT CustomerSysNo FROM Customer_GeneralInvoiceInfo WHERE sysNo = {$item_['iid']}";
		$result = $MSSQL->getRows($sql);
		if (false === $result) {
			$ret = false;
		} else if (1 == count($result)) {
			foreach (self::$WEB_ERP_PAIR_COMMON_INVOICE AS $web => $erp) {
				if (isset($item_[$web])) {
					$data[$erp] = self::translate($web, $item_, $MSSQL);
				}
			}

			$ret = $MSSQL->update("Customer_GeneralInvoiceInfo", $data, "SysNo={$item_['iid']}");
			if (false === $ret) {
				Logger::err("insert invoice_id({$item_['iid']} into ms sql fails )" . $MSSQL->errMsg);
				self::$errCode = $MSSQL->errCode;
				self::$errMsg = $MSSQL->errMsg;
				return false;
			}
		} else {
			$ret = false;
		}

		return $ret;
	}

	private static function delCommonInvoice($item_)
	{
		$ret = true;
		$MSSQL = Config::getMSDB('Customer');
		if (false === $MSSQL) {
			Logger::err('connect to msserveer failed[]' . $MSSQL->errMsg);
			self::$errCode = $MSSQL->errCode;
			self::$errMsg = $MSSQL->errMsg;
			return false;
		}

		$ret = $MSSQL->remove('Customer_GeneralInvoiceInfo', "sysNo = {$item_['iid']}");
		if (false === $ret) {
			Logger::err("delete invoice_id({$item_['iid']} from ms sql fails )" . $MSSQL->errMsg);
			self::$errCode = $MSSQL->errCode;
			self::$errMsg = $MSSQL->errMsg;
			return false;
		} else {
			$sql = "SELECT sysno FROM Customer_GeneralInvoiceInfo_delete WHERE sysNo = {$item_['iid']}";
			$result = $MSSQL->getRows($sql);
			if (false === $result) {
				self::$errCode = $MSSQL->errCode;
				self::$errMsg = $MSSQL->errMsg;
				return false;
			} else if (0 === count($result)) {
				$ret = $MSSQL->insert("Customer_GeneralInvoiceInfo_delete", array('sysNo'=> $item_['iid'], 'CustomerSysNo' => $item_['uid'], 'rowCreateDate' => date('Y-m-d H:i:s', time())));
				if (false === $ret) {
					Logger::err("insert the delete items of invoice_id({$item_['iid']} into ms sql fails )" . $MSSQL->errMsg);
					self::$errCode = $MSSQL->errCode;
					self::$errMsg = $MSSQL->errMsg;
					return false;
				}
			}
		}

		return true;
	}

	private function addVAT($item_)
	{
		$t1 = time();
		$ret = true;
		$data = array();
		$MSSQL = Config::getMSDB('Customer');
		if (false === $MSSQL) {
			Logger::err('connect to msserveer failed[]' . $MSSQL->errMsg);
			self::$errCode = $MSSQL->errCode;
			self::$errMsg = $MSSQL->errMsg;
			return false;
		}
		$t2 = time();
		$sql = "SELECT CustomerSysNo FROM Customer_VATInfo WHERE sysNo = {$item_['iid']}";
		$result = $MSSQL->getRows($sql);
		$t3 = time();
		if (false === $result) {
			self::$errCode = $MSSQL->errCode;
			self::$errMsg = $MSSQL->errMsg;
			return false;
		} else if (0 == count($result)) {
			$data['SysNo'] = $item_['iid'];
			foreach (self::$WEB_ERP_PAIR_VAT AS $web => $erp) {
				if (isset($item_[$web])) {
					$data[$erp] = self::translate($web, $item_, $MSSQL);
				}
			}
			$data['IsDefault'] = 0;
			$data['rowCreateDate'] = $data['rowModifyDate'];
			$data['CreateTime'] = $data['rowCreateDate'];
			$ret = $MSSQL->insert("Customer_VATInfo", $data);
			if (false === $ret) {
				Logger::err("insert invoice_id({$item_['iid']} into ms sql fails )" . $MSSQL->errMsg);
				self::$errCode = $MSSQL->errCode;
				self::$errMsg = $MSSQL->errMsg;
				return false;
			}
		} else {
			$ret = false;
		}
		$t4 = time();
		$diff = $t4 - $t1;
		if ($diff > 1) {
			$diff1 = $t2 - $t1;
			$diff2 = $t3 - $t2;
			$diff3 = $t4 - $t3;
			Logger::warn("addVAT OT $diff,($diff1,$diff2,$diff3)," . var_export($item_, true));
		}
		return $ret;
	}

	private function updateVAT($item_)
	{
		$t1 = time();
		$ret = true;
		$data = array();
		$MSSQL = Config::getMSDB('Customer');
		if (false === $MSSQL) {
			Logger::err('connect to msserveer failed[]' . $MSSQL->errMsg);
			self::$errCode = $MSSQL->errCode;
			self::$errMsg = $MSSQL->errMsg;
			return false;
		}
		$t2 = time();
		$sql = "SELECT CustomerSysNo FROM Customer_VATInfo WHERE sysNo = {$item_['iid']}";
		$result = $MSSQL->getRows($sql);
		$t3 = time();
		if (false === $result) {
			self::$errCode = $MSSQL->errCode;
			self::$errMsg = $MSSQL->errMsg;
			return false;
		} else if (1 == count($result)) {
			foreach (self::$WEB_ERP_PAIR_VAT AS $web => $erp) {
				if (isset($item_[$web])) {
					$data[$erp] = self::translate($web, $item_, $MSSQL);
				}
			}

			$ret = $MSSQL->update("Customer_VATInfo", $data, "SysNo={$item_['iid']}");
			if (false === $ret) {
				Logger::err("insert invoice_id({$item_['iid']} into ms sql fails )" . $MSSQL->errMsg);
				self::$errCode = $MSSQL->errCode;
				self::$errMsg = $MSSQL->errMsg;
				return false;
			}
		} else {
			$ret = false;
		}
		$t4 = time();
		$diff = $t4 - $t1;
		if ($diff > 1) {
			$diff1 = $t2 - $t1;
			$diff2 = $t3 - $t2;
			$diff3 = $t4 - $t3;
			Logger::warn("updateVAT OT $diff,($diff1,$diff2,$diff3)," . var_export($item_, true));
		}
		return $ret;
	}

	private static function delVAT($item_)
	{
		$ret = true;
		$MSSQL = Config::getMSDB('Customer');
		if (false === $MSSQL) {
			Logger::err('connect to msserveer failed[]' . $MSSQL->errMsg);
			self::$errCode = $MSSQL->errCode;
			self::$errMsg = $MSSQL->errMsg;
			return false;
		}

		$ret = $MSSQL->remove('Customer_VATInfo', "sysNo = {$item_['iid']}");
		if (false === $ret) {
			Logger::err("delete invoice_id({$item_['iid']} from ms sql fails )" . $MSSQL->errMsg);
			self::$errCode = $MSSQL->errCode;
			self::$errMsg = $MSSQL->errMsg;
			return false;
		} else {
			$sql = "SELECT sysno FROM Customer_VATInfo_delete WHERE sysNo = {$item_['iid']}";
			$result = $MSSQL->getRows($sql);
			if (false === $result) {
				self::$errCode = $MSSQL->errCode;
				self::$errMsg = $MSSQL->errMsg;
				return false;
			} else if (0 === count($result)) {
				$ret = $MSSQL->insert("Customer_VATInfo_delete", array('sysNo'=> $item_['iid'], 'CustomerSysNo' => $item_['uid'], 'rowCreateDate' => date('Y-m-d H:i:s', time())));
				if (false === $ret) {
					Logger::err("insert the delete items of invoice_id({$item_['iid']} into ms sql fails )" . $MSSQL->errMsg);
					self::$errCode = $MSSQL->errCode;
					self::$errMsg = $MSSQL->errMsg;
					return false;
				}
			}
		}

		return true;
	}

	private static function translate($name_, $item_, $MSSQL_)
	{
		if ('title' === $name_ || 'type' === $name_ || 'name' === $name_ || 'taxno' === $name_
			|| 'addr' === $name_ || 'phone' === $name_ || 'bankname' === $name_ || 'bankno' === $name_
			|| 'status' === $name_
		) {
			return $MSSQL_->msEscapeStr($item_[$name_]);
		}
		if ('regtime' === $name_ || 'updatetime' === $name_ || 'createtime' === $name_) {
			return date('Y-m-d H:i:s', $item_[$name_]);
		}

		return $item_[$name_];
	}


	public static function setVATDefault($uid, $iid)
	{
		$ret = true;
		$MSSQL = Config::getMSDB('Customer');
		if (false === $MSSQL) {
			Logger::err('connect to msserveer failed[]' . $MSSQL->errMsg);
			self::$errCode = $MSSQL->errCode;
			self::$errMsg = $MSSQL->errMsg;
			return false;
		}

		$sql = "SELECT IsDefault FROM Customer_VATInfo WHERE sysNo = {$iid} AND customersysno = {$uid}";
		$result = $MSSQL->getRows($sql);
		if (false === $result) {
			self::$errCode = $MSSQL->errCode;
			self::$errMsg = $MSSQL->errMsg;
			return false;
		} else if (1 == count($result)) {
			$ret = $MSSQL->update("Customer_VATInfo", array('IsDefault' => 0), "customersysno={$uid}");
			if (false === $ret) {
				Logger::err("update the IsDefault of VAT of user ({$uid} into ms sql fails )" . $MSSQL->errMsg);
				self::$errCode = $MSSQL->errCode;
				self::$errMsg = $MSSQL->errMsg;
				return false;
			}

			$ret = $MSSQL->update("Customer_VATInfo", array('IsDefault' => 1), "sysno={$iid}");
			if (false === $ret) {
				Logger::err("update the IsDefault of VAT id ({$iid} into ms sql fails )" . $MSSQL->errMsg);
				self::$errCode = $MSSQL->errCode;
				self::$errMsg = $MSSQL->errMsg;
				return false;
			}
		} else {
			$ret = false;
		}

		return $ret;
	}
}
