<?php
class IMynotify {
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
	 * 拉取我的到货通知列表
	 * @param int $uid  用户id
	 * @return array
	 */
	public static function getnotifyList($uid){
		self::clearERR();

		$uid -= 0;
		$msdb = Config::getMSDB("ERP_1");
		if($msdb === false){
			self::setERR(8701, "init DB failed, code: " . Config::$errCode . "; msg: " . Config::$errMsg);
			return false;
		}

		$sql = "select sysno as notifysysno, status as notifystatus,"
            ." productsysno as ProductSysNo"
            ." from product_notify(nolock)"
            ." where customersysno = {$uid}"
            ." order by CreateTime desc";
		$notifyList = $msdb->getRows($sql);
		if($notifyList === false){
			self::setERR(8702, "getRows failed, code: " . $msdb->errCode . "; msg: " . $msdb->errMsg);
			return false;
		}
		if (!empty($notifyList)){
            $msdb = ToolUtil::getMSDBObj("Product");
            if($msdb === false){
                self::setERR(8701, "init DB failed, code: " . Config::$errCode . "; msg: " . Config::$errMsg);
                return false;
            }
            foreach($notifyList as $k => $notify){
                $sql = "select status"
                    ." from Product_SubStation(nolock)"
                    ." where ProductSysNo = " . $notify['ProductSysNo']
                    ." and status = 1 and SubStationSysNo = 1";
                $notify_filter = $msdb->getRows($sql);
                if($notify_filter === false){
                    self::setERR(8702, "getRows failed, code: " . $msdb->errCode . "; msg: " . $msdb->errMsg);
                    return false;
                }
                if(empty($notify_filter)){
                    unset($notifyList[$k]);
                }
            }

        }
		return $notifyList;
	}
	
	/**
	 *删除到货通知
	 * @param array $sysNoArray
	 * * @return bool
	 */
	public static function delnotify($sysNoArray){
		self::clearERR();

		if(empty($sysNoArray)){
			self::setERR(8710, "param is empty");
			return false;
		}

		$time = date('Y-m-d H:i:s');
		$msdb = Config::getMSDB("ERP_1");
		if($msdb === false){
			self::setERR(8703, "init DB failed, code: " . Config::$errCode . "; msg: " . Config::$errMsg);
			return false;
		}

		$sysNo =implode(',', $sysNoArray);
		$sql = "insert into product_notify_delete(SysNo ,rowCreateDate)"
			  ." select SysNo, '{$time}' from product_notify"
			  ." where sysno in  ({$sysNo});"
			  ." delete from product_notify where sysno in ({$sysNo})";
		$bool = $msdb->execSql($sql);
		if($bool === false){
			self::setERR(8704, "execSql failed, code: " . $msdb->errCode . "; msg: " . $msdb->errMsg);
			return false;
		}
		
		return true;
	}
	
	/**
	 *继续通知
	 * @param int $sysNo
	 * * @return bool
	 */
	public static function continueNotify($sysNo){
		self::clearERR();

		$time = date('Y-m-d H:i:s');
		$msdb = Config::getMSDB("ERP_1");
		if($msdb === false){
			self::setERR(8705, "init DB failed, code: " . Config::$errCode . "; msg: " . Config::$errMsg);
			return false;
		}

		$data =array(
			'rowModifyDate' => $time
		);
		$bool = $msdb->update("product_notify", $data, "SysNo in ({$sysNo})");
		if($bool === false){
			self::setERR(8706, "update failed, code: " . $msdb->errCode . "; msg: " . $msdb->errMsg);
			return false;
		}
		
		return true;
	}
	
	//添加我的到货通知
	public static function addNotify($uid, $productSysNo, $email){
		self::clearERR();

		$uid -= 0;
		$notifyTime = '';
		$sysno = IIdGenerator::getNewId("product_notify_sequence");
		if($sysno === false){
			self::setERR(8706, "IIdGenerator::getNewId failed, code: " . IIdGenerator::$errCode . "; msg: " . IIdGenerator::$errMsg);
			return false;
		}

		$msdb = Config::getMSDB("ERP_1");
		if($msdb === false){
			self::setERR(8707, "init DB failed, code: " . Config::$errCode . "; msg: " . Config::$errMsg);
			return false;
		}

		$newNotify = array(
			'SysNo' => $sysno,
			'CustomerSysNo'	=> $uid,
			'ProductSysNo'	=> $productSysNo,
			'Email'	=> $email,
			'CreateTime'	=> date('Y-m-d H:i:s', time()),
			'NotifyTime'	=> $notifyTime,
			'Status'	=> 0
		);
		$rs = $msdb->insert("Product_Notify",$newNotify);
		if($rs === false){
			self::setERR(8708, "insert failed, code: " . $msdb->errCode . "; msg: " . $msdb->errMsg);
			return false;
		}
		
		return true;
	}
	
	//是否提交过到货通知
	public static function HasReplyNotify($productSysNo, $uid){
		self::clearERR();

		$uid -= 0;
		$msdb = Config::getMSDB("ERP_1");
		if($msdb === false){
			self::setERR(8701, "init DB failed, code: " . Config::$errCode . "; msg: " . Config::$errMsg);
			return false;
		}
		
		$sql ="select SysNo from product_notify"
			  ." where productsysno='{$productSysNo}'"
			  ." and customersysno = '{$uid}'";
			  
	    $count = $msdb->getRows($sql);
		if($count === false){
			self::setERR(8709, "getRows failed, code: " . $msdb->errCode . "; msg: " . $msdb->errMsg);
			return false;
		}
		return count($count);
	}
}

// End Of Script