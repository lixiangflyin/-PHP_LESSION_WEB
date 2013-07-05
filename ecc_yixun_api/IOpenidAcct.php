<?php
// �������ˣ�����ȷ�ϣ�����Ҫ����ʱ���openid�ֶ�
/**
 * ��Ϊopenid��acct��ת������
 * �ڵ�ǰQQ�û�����openid��Ϊkey������£�ʹ��һ��openid��acct�Ķ�Ӧ��
 * ���̣�
 *   ���ȸ���Openid��ȡuid��Ȼ����Ի�ȡһ��openid��acct
 * @author myforchen
 *
 */
class IOpenidAcct {
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
	 * �洢ĳ�û���openid��acct
	 * ���û���ת������¼���ǿ��Ի�ȡ��uid�ģ���ʱ����ø÷����洢
	 * @param int $uid �û�ID
	 * @param string $openid �ϵ�openidֵ
	 * @param string $acct �µ�acctֵ
	 */
	public static function saveOpenidAcct($uid, $openid, $acct){
		self::clearERR();

		if(empty($uid) || empty($openid) || empty($acct)){
			self::setERR(8601, "param is not correct");
			return false;
		}

		$openidAcct = IOpenidAcctTTC::get($uid);
		if($openidAcct === false){
			self::setERR(8602, "IOpenidAcctTTC::get failed, code: " . IOpenidAcctTTC::$errCode . ", msg: " . IOpenidAcctTTC::$errMsg);
			return false;
		}

		$params = array(
			'uid'		=> $uid,
			'openid'	=> $openid,
			'acct'		=> $acct,
			'update_time'	=> time()
		);
		if(count($openidAcct) > 0){
			$ret = IOpenidAcctTTC::update($params);
			if($ret === false){
				self::setERR(8603, "IOpenidAcctTTC::update failed, code: " . IOpenidAcctTTC::$errCode . ", msg: " . IOpenidAcctTTC::$errMsg);
				return false;
			}
		} else {
			$ret = IOpenidAcctTTC::insert($params);
			if($ret === false){
				self::setERR(8604, "IOpenidAcctTTC::update failed, code: " . IOpenidAcctTTC::$errCode . ", msg: " . IOpenidAcctTTC::$errMsg);
				return false;
			}
		}

		return true;
	}

	/**
	 * ��ȡĳuid�û���acct
	 * @param int $uid �û�ID
	 */
	public static function getAcctOfUid($uid){
		self::clearERR();

		if(empty($uid)){
			self::setERR(8605, "param is not correct");
			return false;
		}

		$openidAcct = IOpenidAcctTTC::get($uid);
		if($openidAcct === false){
			self::setERR(8606, "IOpenidAcctTTC::get failed, code: " . IOpenidAcctTTC::$errCode . ", msg: " . IOpenidAcctTTC::$errMsg);
			return false;
		}

		if(count($openidAcct) == 0){
			self::setERR(8611, "no record found");
			return false;
		}

		return $openidAcct[0]['acct'];
	}

	/**
	 * ��ȡĳuid�û���openid
	 * @param int $uid �û�ID
	 */
	public static function getOpenidOfUid($uid){
		self::clearERR();

		if(empty($uid)){
			self::setERR(8607, "param is not correct");
			return false;
		}
	
		$openidAcct = IOpenidAcctTTC::get($uid);
		if($openidAcct === false){
			self::setERR(8608, "IOpenidAcctTTC::get failed, code: " . IOpenidAcctTTC::$errCode . ", msg: " . IOpenidAcctTTC::$errMsg);
			return false;
		}

		if(count($openidAcct) == 0){
			self::setERR(8611, "no record found");
			return false;
		}

		return $openidAcct[0]['openid'];
	}
}

// End Of Script