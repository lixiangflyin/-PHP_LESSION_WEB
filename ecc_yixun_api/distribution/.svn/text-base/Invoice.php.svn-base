<?php

class LIB_Invoice {
    
    //发票类型
    const    INVOICE_TYPE_RETAIL_PERSONAL  = 1;    //商业零售发票(个人)
    const	 INVOICE_TYPE_VAT	           = 2;    //增值税发票
    const    INVOICE_TYPE_RETAIL_COMPANY   = 3;    //商业零售发票(公司)
    const    INVOICE_TYPE_VAT_NORMAL       = 4;	   //增值税普通发票
    const	 INVOICE_TYPE_TITLE            = 9;    //冠名发票
    
    //发票的状态
    const    INVOICE_STATUS_APPROVED	   =1;
    const	 INVOICE_STATUS_OK	           = 0;
    const    INVOICE_STATUS_INVALID	       =-1;
    const	 INVOICE_STATUS_DELETED	       = -2;
    
    //一些字段最大长度定义
    const	 MAX_COMPANY_LEN	= 128;
    const    MAX_ADDR_LEN       = 256;
    const	 MAX_PHONE_LEN	    = 64;
    const    MAX_TAXNO_LEN	    = 20;
    const	 MAX_BANK_NO_LEN	= 32;
    const    MAX_BANK_NAME_LEN	= 128;
    const    MAX_TITLE_LEN      = 128;
    
    
    const    MAX_ADDR_NAME_LEN	= 32;
    const	 MAX_ZIPCODE_LEN    = 16;
    const	 MAX_ACCOUNT_LEN	= 100;
    const    MAX_PASS_LEN	    = 32;
    const	 MIN_PASS_LEN	    = 6;
    const    MAX_VATNAME_LEN	= 25;

    
    public static $errCode = 0;

    /**
     * 错误信息
     */
    public static $errMsg = '';
    
    public static function addInvoice($uid, $newInvoice)
	{
		$ret = self::insert($uid, $newInvoice);
	    if (FALSE === $ret) {
			//self::$errCode = 1001;
			//self::$errMsg  = "添加发票失败！";
			return false;
           // throw new BaseException(LIB_Invoice::$errCode, LIB_Invoice::$errMsg);
        }
		return $ret;
	}
	
/**
	 * @static 根据类型检查发票所必须的字段，以及长度限制
	 * @param $newInvoice 发票内容
	 * @return bool
	 */
	private static function checkFieldByType($newInvoice)
	{

		if (isset($newInvoice['type'])
			&& ($newInvoice['type'] != self::INVOICE_TYPE_RETAIL_COMPANY
				&& $newInvoice['type'] != self::INVOICE_TYPE_RETAIL_PERSONAL
				&& $newInvoice['type'] != self::INVOICE_TYPE_VAT
				&& $newInvoice['type'] != self::INVOICE_TYPE_TITLE //冠名发票 @Tellenji Modify 2022/09/05
				&& $newInvoice['type'] != self::INVOICE_TYPE_VAT_NORMAL)
		) 
	    {
			self::$errCode = 47;
			self::$errMsg  = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice type is invalid';
            return false;
        }
        
		//增值税发票，则需要检查更多参数
		if ($newInvoice['type'] == self::INVOICE_TYPE_VAT) { // 2
			if (!isset($newInvoice['name']) || '' == $newInvoice['name'])
    		{
				self::$errCode = 50;
				self::$errMsg  = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice name is invalid';
                return false;
            }

			if (strlen($newInvoice['name']) > self::MAX_COMPANY_LEN) 
		    {
				self::$errCode = 51;
				self::$errMsg  = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice name len is invalid';
                return false;
            }

			if (!isset($newInvoice['addr']) || '' == $newInvoice['addr']) 
		    {
				self::$errCode = 52;
				self::$errMsg  = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice addr is invalid';
                return false;
            }

			if (strlen($newInvoice['addr']) > self::MAX_ADDR_LEN)
		    {
				self::$errCode = 53;
				self::$errMsg  = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice addr len  is invalid';
                return false;
            }

			if (!isset($newInvoice['phone']) || '' == $newInvoice['phone'])
		    {
				self::$errCode = 54;
				self::$errMsg  = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice phone is invalid';
                return false;
            }
			if (strlen($newInvoice['phone']) > self::MAX_PHONE_LEN) 
		    {
				self::$errCode = 55;
				self::$errMsg  = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice phone len is invalid';
                return false;
            }

			if (!isset($newInvoice['taxno']) || '' == $newInvoice['taxno']) 
		    {
				self::$errCode = 56;
				self::$errMsg  = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice taxno is invalid';
                return false;
            }
			if (strlen($newInvoice['taxno']) > self::MAX_TAXNO_LEN) 
		    {
				self::$errCode = 57;
				self::$errMsg  = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice taxno len  is invalid';
                return false;
            }

			if (!isset($newInvoice['bankno']) || '' == $newInvoice['bankno']) 
		    {
				self::$errCode = 58;
				self::$errMsg  = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice bankno is invalid';
                return false;
            }
			if (strlen($newInvoice['bankno']) > self::MAX_BANK_NO_LEN)
		    {
				self::$errCode = 59;
				self::$errMsg  = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice bankno len is invalid';
                return false;
            }

			if (!isset($newInvoice['bankname']) || '' == $newInvoice['bankname']) 
		    {
				self::$errCode = 60;
				self::$errMsg  = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice bankname is invalid';
                return false;
            }
			if (strlen($newInvoice['bankname']) > self::MAX_BANK_NAME_LEN)
		    {
				self::$errCode = 61;
				self::$errMsg  = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice bankname lenis invalid';
                return false;
            }
		    } else if ($newInvoice['type'] == self::INVOICE_TYPE_VAT_NORMAL) { //4
			if (!isset($newInvoice['title']) || '' == $newInvoice['title']) 
		    {
				self::$errCode = 48;
				self::$errMsg  = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice title is invalid';
                return false;
            }            
			if (strlen($newInvoice['title']) > self::MAX_TITLE_LEN) 
		    {
				self::$errCode = 49;
				self::$errMsg  = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice title len is invalid';
                return false;
            }
		} else {
			if (!isset($newInvoice['title']) || '' == $newInvoice['title']) 
		    {
				self::$errCode = 48;
				self::$errMsg  = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice title is invalid';
                return false;
            }
			if (strlen($newInvoice['title']) >self::MAX_TITLE_LEN) 
		    {
				self::$errCode = 49;
				self::$errMsg  = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice title len is invalid';
                return false;
            }
		}
		return true;
	}
	
	/**
	 * 检查发票内容字段是否有不允许出现的字符
	 * @param string $text
	 * @return boolean 合法则为true / 不法则为则为false
	 */
	private static function checkIsValidInvoiceString($text)
	{
		$chars = array('`', '~', '!', '@', '#', '$', '^', '&', '*', '=', '|', '{', '}', ':', ';', '\\', '[', ']', '<', '>', '~', '！', '@', '#', '￥', '…', '＆', '*', '&mdash;', '|', '{', '}', '【', '】', '‘',);

		foreach ($chars as $char) {
			$pos = strpos($text, $char);
			if ($pos !== false) {
				return false;
			}
		}

		return true;
	}
	
//根据分销商uid获取信息
	public static function getRetailers($data)
	{
	    $retailers=TTC_Retailer::get($data['uid']);
	    if (FALSE === $retailers) {
			self::$errCode = TTC_Retailer::$errCode;
			self::$errMsg  = TTC_Retailer::$errMsg;
            return false;
        }	
		return $retailers;
	}
	
	/**
	 * @static 修改发票
	 * @param $uid
	 * @param $iid
	 * @param $newInvoice
	 * @return bool
	 */
	public static function modifyInvoice($uid, $iid, $newInvoice)
	{
		$newInvoice['uid'] = $uid;
		$ret = self::update($newInvoice, array('iid'=> $iid));
		if (false === $ret) {
			self::$errCode = IRetailerInvoiceTTC::$errCode;
			self::$errMsg  = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[modify user invoice($iid) from IRetailerInvoiceTTC failed:" . IRetailerInvoiceTTC::$errMsg . "]";
			return false;
		}
		return true;
	}
	
/**
	 * @static 逻辑层，更新发票
	 * @param $newInvoice 发票内容
	 * @param $filter 过滤条件
	 * @return bool
	 */
	public static function update($newInvoice, $filter)
	{

		if (!isset($filter['iid']) || $filter['iid'] <= 0) {
			self::$errCode = 62;
			self::$errMsg  = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'iid is null';
			return false;
		}
		$iid = $filter['iid'];

		if (!isset($newInvoice) || count($newInvoice) == 0) {
			self::$errCode = 65;
			self::$errMsg  = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'new invoice is null';
			return false;
		}

		$newInvoice['updatetime'] = time();

		// 检查必备的字段
		if (!self::checkFieldByType($newInvoice))
			return false;

		// 检查非法字符
		if (!self::checkIsValidInvoiceData($newInvoice)) {
			self::$errCode = 101;
			self::$errMsg  = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice data is null';
			return false;
		}

		// 更新发票
		if (!self::_updateInvoice($newInvoice, $filter)) {
			self::$errCode = IRetailerInvoiceTTC::$errCode;
			self::$errMsg  = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[modify user invoice($iid) from IRetailerInvoiceTTC failed:" . IRetailerInvoiceTTC::$errMsg . "]";
			return false;
		}

		$lines = self::_getAffectRows();
		if (1 != $lines) {
			self::$errCode = 65;
			self::$errMsg  = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[modify user invoice($iid) affect $lines rows";
			return false;
		}

		$newInvoice['iid'] = $iid;
		IUserInvoiceSyn::update($newInvoice);
		return true;
	}
	
	/**
	 * @static 获得数据源操作影响的行数
	 * @return int
	 */
	private static function _getAffectRows()
	{
		return IRetailerInvoiceTTC::getTTCAffectRows();
	}
	
	
	/**
	 * @static 数据层，更新数据源
	 * @param       $newInvoice
	 * @param array $filter
	 * @return bool
	 */
	private static function _updateInvoice($newInvoice, $filter = array())
	{
		$ret = IRetailerInvoiceTTC::update($newInvoice, $filter);
		if (false === $ret) {
			self::$errCode = IRetailerInvoiceTTC::$errCode;
			self::$errMsg  = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[update user invoice failed:" . var_export($newInvoice, true) . ",filter:" . var_export($filter, true) . IRetailerInvoiceTTC::$errMsg . "]";	
		    return false;
		}
		return $ret;
	}
	
/**
	 * 检查是否合法的发票数据
	 * @param array $data
	 * @param array $numberFields
	 * @param array $stringFields
	 * @param array $phoneFields
	 * @return boolean 合法则为true / 不法则为则为false
	 */
	private static function checkIsValidInvoiceData($data, $blockNotChecked = false)
	{
		$numberFields = array('type', 'bankno', 'iid', 'taxno');
		$stringFields = array('addr', 'bankname', 'name', 'title', 'vat_normal_name', 'sid');
		$phoneFields = array('phone');

		foreach ($numberFields as $field) {
			if (!empty($data[$field]) && !is_numeric($data[$field])) {
				Logger::info(var_export($data[$field], true));
				return false;
			}
		}

		foreach ($stringFields as $field) {
			if (!empty($data[$field]) && !self::checkIsValidInvoiceString($data[$field])) {
				Logger::info(var_export($data[$field], true));
				return false;
			}
		}

		foreach ($phoneFields as $field) {
			if (!empty($data[$field]) && !preg_match('/^[0-9\-]{5,25}$/', $data[$field])) {
				Logger::info(var_export($data[$field], true));
				return false;
			}
		}

		//block not checked ?
		if ($blockNotChecked) {
			$all_fields = array_keys($data);
			$not_checked = array_diff($all_fields, array_merge($numberFields, $stringFields, $phoneFields));
			if (!empty($not_checked)) {
				Logger::info(var_export($data, true));
				return false;
			}
		}

		return true;
	}
	
/**
	 * 获取全局ID
	 * @param string $bizName
	 * @param int $need
	 * @return 连续的ID，返回第一个，之后自增即可。
	 */
     public static function getNewId($bizName, $need=1, $time=0) {
		$index = rand(0, 1);
		//$ip = Config_IP::$IDGenerator[$index];
		$ip = Config::getIP('IDGenerator_' . $index);
		if (null == $ip)
		{
			self::$errCode = 1800;
			self::$errMsg  = 'getip(IDGenerator) failed';
		}

		$addr = explode(":", $ip);
		$cmd = "cmd=100&bizid=" . $bizName . "&need=" .$need .  "\r\n";
		$rspStr = NetUtil::tcpCmd($addr[0], $addr[1], $cmd, 1, 1);
		if (false == $rspStr || "" == $rspStr) {
			if ($time < 3)
			{
				return self::getNewId($bizName, $need, $time++);
			}
			else
			{
				self::$errCode = 1801;
				self::$errMsg  = 'IDGenerator svr timeout';
		    }
		}

		$rspArr = array();
		parse_str($rspStr, $rspArr);
		if (!isset($rspArr['id'])) {
			self::$errCode = 1802;
			self::$errMsg  = 'IDGenerator failed';
		}

		return intval($rspArr['id']);
	}
	
	
	/**
	 * @static
	 * @return bool|int
	 */
	private static function getInvoiceId()
	{
		//获取一个新id
		$newId = self::getNewId('Invoice_Sequence');
		if (false === $newId || $newId <= 0) {
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return false;
		}
		return $newId;
	}
	
    private static function _insertInvoice($newInvoice)
	{
	    $ret= IRetailerInvoiceTTC::insert($newInvoice);
		if (false === $ret) 
    	{
			self::$errCode = IRetailerInvoiceTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[insert new invoice to IRetailerInvoiceTTC failed:" . IRetailerInvoiceTTC::$errMsg . "]";
            return false;
        }
		return $ret;
	}
	
	
/**
	 * @static
	 * @param $uid 用户id
	 * @param $newInvoice 发票内容
	 * @return bool|int
	 */
	public static function insert($uid, $newInvoice)
	{

		if (!self::checkFieldByType($newInvoice))
			return false;


		// 检查非法字符
		if (!self::checkIsValidInvoiceData($newInvoice)) 
	    {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'invoice title data is invalid';
            return false;
        }


		$newId = self::getInvoiceId();
		if (false === $newId)
			return false;


		//默认为正常状态
		$now = time();
		$newInvoice['status'] = self::INVOICE_STATUS_APPROVED;
		$newInvoice['sortfactor'] = 0;
		$newInvoice['iid'] = $newId;
		$newInvoice['uid'] = $uid;
		$newInvoice['updatetime'] = $now;
		$newInvoice['createtime'] = $now;


		$ret = self::_insertInvoice($newInvoice);
		if (false === $ret) 
    	{
			self::$errCode = LIB_Invoice::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[insert new invoice to _insertInvoice failed:" . LIB_Invoice::$errMsg . "]";
            return false;
        }


		// insert modify time for asyn to ERP
		$ret = IUserInvoiceSyn::add($newInvoice);
		return $ret;
	}
	
    public static function delInvoice($uid, $iid)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'uid is null';
			return false;
		}

		if (!isset($iid) || $iid <= 0) {
			self::$errCode = 62;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'aid is null';
			return false;
		}

		$newInvoice['uid'] = $uid;
		$newInvoice['status'] = self::INVOICE_STATUS_DELETED;
		$newInvoice['updatetime'] = time();

		$ret = IRetailerInvoiceTTC::update($newInvoice, array('iid' => $iid));
		if (false === $ret) {
			self::$errCode = IRetailerInvoiceTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[delete user invoice($iid) from IUserInvoiceBookTTC failed:" . IRetailerInvoiceTTC::$errMsg . "]";
			return false;
		}

		$lines = IRetailerInvoiceTTC::getTTCAffectRows();
		if (1 != $lines) {
			self::$errCode = 65;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[modify user invoice($iid) affect $lines rows";
			return false;
		}

		// delete modify time for asyn to ERP
		IUserInvoiceSyn::delete(array('uid' => $uid, 'iid' => $iid));
		return true;
	}
    
    
}