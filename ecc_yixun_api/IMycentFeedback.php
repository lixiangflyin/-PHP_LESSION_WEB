<?php
class IMycentFeedback {
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
	 * ��ȡ�ҵķ����б�
	 * @param int $uid  �û�id
	 * @return array
	 */
	public static function getFeedbackList($wid, $uid, $currentPage, $pagesize){
		self::clearERR();

		$uid -= 0;
		$currentPage -= 0;
		$pagesize -= 0;
		//���˷�վ�߼�
		$msdb = Config::getMSDB("ERP_{$wid}");
		//$msdb = Config::getMSDB("ERP_1");
		//$date = date('Y-m-d', strtotime("-30 day"));
		if($msdb === false){
			self::setERR(8701, "init DB failed, code: " . Config::$errCode . "; msg: " . Config::$errMsg);
			return false;
		}

		$sql = "select * from ("
					."select OldSysNo,CustomerSysNo, Subject, Suggest, NickName,"
					."Email, Phone, Memo, Note, convert(nvarchar, CreateTime, 20) as CreateTime,"
					."UpdateTime, Status, SOSysNo, UpdateUserSysNo, "
					."rowCreateDate, rowModifyDate, SysNo, "
					."row_number() over (order by CreateTime desc) rn "
					."from FeedBack where CustomerSysNo = {$uid} and Status <> -1 "
				.") tmpres "
				."where rn > ($currentPage * $pagesize) and rn <= (($currentPage + 1) * $pagesize) ";
		$feedBackList = $msdb->getRows($sql);
		if($feedBackList === false){
			self::setERR(8702, "getRows failed, code: " . $msdb->errCode . "; msg: " . $msdb->errMsg);
			return false;
		}
		
		return $feedBackList;
	}
	
	/**
	 * ��ȡ�����һ���ҵķ���
	 * @param int $uid  �û�id
	 * @param int $oid  ����id
	 * @return array  �÷�����ʱû���õ�
	 */
	public  static function getOneFeedback($uid , $sysno){
		self::clearERR();

		$uid -= 0;
		$sysno -= 0;
		$msdb = Config::getMSDB("ERP_1");
		$date = date('Y-m-d', strtotime("-30 day"));
		if($msdb === false){
			self::setERR(8703, "init DB failed, code: " . Config::$errCode . "; msg: " . Config::$errMsg);
			return false;
		}

		$OnefeedBack = $msdb->getRows("select OldSysNo,CustomerSysNo, Subject, Suggest, NickName,"
									."Email, Phone, Memo, Note, convert(nvarchar, CreateTime, 20) as CreateTime,"
									."UpdateTime, Status, SOSysNo, UpdateUserSysNo,"
									."rowCreateDate, rowModifyDate, SysNo"
		 							." from FeedBack where CustomerSysNo = {$uid} and SysNo = {$sysno} and Status <> -1");
		if($OnefeedBack === false){
			self::setERR(8704, "getRows failed, code: " . $msdb->errCode . "; msg: " . $msdb->errMsg);
			return false;
		}
		
		return $OnefeedBack;
	}
	
	
	/**
	 * ���һ���ҵķ���
	 * @return bool
	 */
	public static  function addFeedback($wid, $uid, $sosysno, $subject, $suggest, $nickName, $email, $phone){
		self::clearERR();

		$uid -= 0;
		$sysno = IIdGenerator::getNewId("feedback_sequence");
		if($sysno === false){
			self::setERR(8705, "IIdGenerator::getNewId failed, code: " . IIdGenerator::$errCode . "; msg: " . IIdGenerator::$errMsg);
			return false;
		}
		
	    //���˷�վ�߼�
		$msdb = Config::getMSDB("ERP_{$wid}");
		//$msdb = Config::getMSDB("ERP_1");
		if($msdb === false){
			self::setERR(8706, "init DB failed, code: " . Config::$errCode . "; msg: " . Config::$errMsg);
			return false;
		}
		$newFeedBack = array(
			'CustomerSysNo'	=> $uid,
			'Subject'	=> $subject,
			'Suggest'	=> $suggest,
			'NickName'	=> $nickName,
			'Email'	=> $email,
			'Phone'	=> $phone,
			'CreateTime'	=> date('Y-m-d H:i:s', time()),
			'Status'	=> 0,
			'SOSysNo'	=> $sosysno,
			'SysNo'	=> $sysno
		);
		$rs = $msdb->insert("FeedBack",$newFeedBack);
		if($rs === false){
			self::setERR(8707, "insert failed, code: " . $msdb->errCode . "; msg: " . $msdb->errMsg);
			return false;
		}
		
		return true;
	
	}
	
	/**
	 * ɾ��ĳ���ҵķ���
	 * @param int $uid  �û�id
	 * @return bool
	 */
	public  static  function delFeedback($wid, $uid ,$sysno){
		self::clearERR();

		$uid -= 0;
		$sysno -= 0;
	    //���˷�վ�߼�
		$msdb = Config::getMSDB("ERP_{$wid}");
		//$msdb = Config::getMSDB("ERP_1");
		if($msdb === false){
			self::setERR(8708, "init DB failed, code: " . Config::$errCode . "; msg: " . Config::$errMsg);
			return false;
		}
		
		$time = date('Y-m-d H:i:s', time());
		$data = array(
			'Status'	=> -1,
			'rowModifyDate'	=> date('Y-m-d H:i:s', time())
			
		);
		$rs = $msdb->update("FeedBack", $data, "SysNo=$sysno AND CustomerSysNo=$uid");
		if($rs === false){
			self::setERR(8709, "update failed, code: " . $msdb->errCode . "; msg: " . $msdb->errMsg);
			return false;
		}
		
		return true;
	}
	
	/**
	 * ��ѯ�ҵķ���������
	 * @param int $uid  �û�id
	 * @return $count
	 */
	public static function getFeedBackCount($wid, $uid){
		self::clearERR();

		$uid -= 0;
		//���˷�վ�߼�
		$msdb = Config::getMSDB("ERP_{$wid}");
		//$msdb = Config::getMSDB("ERP_1");
		if($msdb === false){
			self::setERR(8703, "init DB failed, code: " . Config::$errCode . "; msg: " . Config::$errMsg);
			return false;
		}

		$sql = "select count(SysNo) from FeedBack where CustomerSysNo = {$uid} and Status <> -1 ";
		$count = $msdb->getRows($sql);
		if($count === false){
			self::setERR(8710, "getRows failed, code: " . $msdb->errCode . "; msg: " . $msdb->errMsg);
			return false;
		}
		return $count;
	} 
	
	
}

// End Of Script